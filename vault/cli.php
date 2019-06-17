<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: CLI handler (last modified: 2019.06.17).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Prevents execution from outside of CLI-mode. */
if (!$phpMussel['Mussel_sapi'] || !$phpMussel['Mussel_PHP']) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Initialise an error handler. */
$phpMussel['InitialiseErrorHandler']();

/** If CLI-mode is disabled, nothing here should be executed. */
if (!$phpMussel['Config']['general']['disable_cli'] && !$phpMussel['Config']['general']['maintenance_mode']) {

    /** Check if any arguments have been parsed via CLI. */
    $phpMussel['cli_args'] = [
        isset($argv[0]) ? $argv[0] : '',
        isset($argv[1]) ? $argv[1] : '',
        isset($argv[2]) ? $argv[2] : '',
        isset($argv[3]) ? $argv[3] : ''
    ];

    /** Triggered by the forked child process in CLI-mode. */
    if ($phpMussel['cli_args'][1] == 'cli_scan') {
        /** Fetch the command. **/
        $phpMussel['cmd'] = strtolower($phpMussel['substrbf']($phpMussel['cli_args'][2], ' ') ?: $phpMussel['cli_args'][2]);

        /** Scan a file or directory. **/
        if ($phpMussel['cmd'] === 'scan') {
            if ($phpMussel['Config']['general']['scan_cache_expiry']) {
                $phpMussel['PrepareHashCache']();
            }
            try {
                /** Initialise statistics if they've been enabled. */
                $phpMussel['Stats-Initialise']();
                /** Register scan event. */
                $phpMussel['Stats-Increment']('CLI-Events', 1);
                /** Call recursor. */
                echo $phpMussel['Recursor'](substr($phpMussel['cli_args'][2], 5), true, true, 0, $phpMussel['cli_args'][3]);
                /** Update statistics. */
                if ($phpMussel['CacheModified']) {
                    $phpMussel['Statistics'] = $phpMussel['SaveCache']('Statistics', -1, serialize($phpMussel['Statistics']));
                }
            } catch (\Exception $e) {
                die($e->getMessage());
            }
            if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0 && is_array($phpMussel['HashCache']['Data'])) {
                foreach ($phpMussel['HashCache']['Data'] as &$phpMussel['HashCache']['ThisData']) {
                    if (is_array($phpMussel['HashCache']['ThisData'])) {
                        $phpMussel['HashCache']['ThisData'] = implode(':', $phpMussel['HashCache']['ThisData']) . ';';
                    }
                }
                unset($phpMussel['HashCache']['ThisData']);
                $phpMussel['HashCache']['Data'] = implode('', $phpMussel['HashCache']['Data']);
                $phpMussel['HashCache']['Data'] = $phpMussel['SaveCache'](
                    'HashCache',
                    $phpMussel['Time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
                    $phpMussel['HashCache']['Data']
                );
            }
            die;
        }

        /** Generate a hash signature using a file or directory. **/
        if ($phpMussel['cmd'] === 'md5_file' || $phpMussel['cmd'] === 'm' || $phpMussel['cmd'] === 'sha1_file' || substr($phpMussel['cmd'], 0, 10) === 'hash_file:') {
            if ($phpMussel['cmd'] === 'md5_file' || $phpMussel['cmd'] === 'm') {
                $phpMussel['ThisAlgo'] = 'md5';
            } elseif ($phpMussel['cmd'] === 'sha1_file') {
                $phpMussel['ThisAlgo'] = 'sha1';
            } else {
                $phpMussel['ThisAlgo'] = substr($phpMussel['cmd'], 10);
            }
            if (in_array($phpMussel['ThisAlgo'], hash_algos())) {
                echo $phpMussel['CLI-RecursiveCommand']($phpMussel['cli_args'][2], function ($Params) use (&$phpMussel) {
                    $HashMe = $phpMussel['ReadFile']($Params, 0, true);
                    return hash($phpMussel['ThisAlgo'], $HashMe) . ':' . strlen($HashMe) . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                });
            } else {
                echo $phpMussel['L10N']->getString('cli_algo_not_supported') . "\n";
            }
        }

        /** Generate a CoEx signature using a file. **/
        if ($phpMussel['cmd'] === 'coex_file') {
            echo $phpMussel['CLI-RecursiveCommand']($phpMussel['cli_args'][2], function ($Params) use (&$phpMussel) {
                $HashMe = $phpMussel['ReadFile']($Params, 0, true);
                return
                    '$md5:' . md5($HashMe) . ';' .
                    '$sha:' . sha1($HashMe) . ';' .
                    '$str_len:' . strlen($HashMe) . ';' .
                    $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
            });
        }

        /** Fetch PE metadata. **/
        if ($phpMussel['cmd'] === 'pe_meta') {
            echo $phpMussel['CLI-RecursiveCommand']($phpMussel['cli_args'][2], function ($Params) use (&$phpMussel) {
                $Data = $phpMussel['ReadFile']($Params, 0, true);
                $Returnable = '';
                if (substr($Data, 0, 2) !== 'MZ') {
                    return $phpMussel['L10N']->getString('cli_pe1') . "\n";
                }
                $PEArr = ['Len' => strlen($Data)];
                $PEArr['Offset'] = $phpMussel['UnpackSafe']('S', substr($Data, 60, 4));
                $PEArr['Offset'] = $PEArr['Offset'][1];
                while (true) {
                    $PEArr['DoScan'] = true;
                    if ($PEArr['Offset'] < 1 || $PEArr['Offset'] > 16384 || $PEArr['Offset'] > $PEArr['Len']) {
                        $PEArr['DoScan'] = false;
                        break;
                    }
                    $PEArr['Magic'] = substr($Data, $PEArr['Offset'], 2);
                    if ($PEArr['Magic'] !== 'PE') {
                        $PEArr['DoScan'] = false;
                        break;
                    }
                    $PEArr['Proc'] = $phpMussel['UnpackSafe']('S', substr($Data, $PEArr['Offset'] + 4, 2));
                    $PEArr['Proc'] = $PEArr['Proc'][1];
                    if ($PEArr['Proc'] != 0x14c && $PEArr['Proc'] != 0x8664) {
                        $PEArr['DoScan'] = false;
                        break;
                    }
                    $PEArr['NumOfSections'] = $phpMussel['UnpackSafe']('S', substr($Data, $PEArr['Offset'] + 6, 2));
                    $PEArr['NumOfSections'] = $PEArr['NumOfSections'][1];
                    if ($PEArr['NumOfSections'] < 1 || $PEArr['NumOfSections'] > 40) {
                        $PEArr['DoScan'] = false;
                    }
                    break;
                }
                if (!$PEArr['DoScan']) {
                    return $phpMussel['L10N']->getString('cli_pe1') . "\n";
                }
                $PEArr['OptHdrSize'] = $phpMussel['UnpackSafe']('S', substr($Data, $PEArr['Offset'] + 20, 2));
                $PEArr['OptHdrSize'] = $PEArr['OptHdrSize'][1];
                $Returnable .= $phpMussel['L10N']->getString('cli_pe2') . "\n";
                for ($PEArr['k'] = 0; $PEArr['k'] < $PEArr['NumOfSections']; $PEArr['k']++) {
                    $PEArr['SectionHead'] = substr($Data, $PEArr['Offset'] + 24 + $PEArr['OptHdrSize'] + ($PEArr['k'] * 40), $PEArr['NumOfSections'] * 40);
                    $PEArr['SectionName'] = str_ireplace("\x00", '', substr($PEArr['SectionHead'], 0, 8));
                    $PEArr['VirtualSize'] = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionHead'], 8, 4));
                    $PEArr['VirtualSize'] = $PEArr['VirtualSize'][1];
                    $PEArr['VirtualAddress'] = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionHead'], 12, 4));
                    $PEArr['VirtualAddress'] = $PEArr['VirtualAddress'][1];
                    $PEArr['SizeOfRawData'] = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionHead'], 16, 4));
                    $PEArr['SizeOfRawData'] = $PEArr['SizeOfRawData'][1];
                    $PEArr['PointerToRawData'] = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionHead'], 20, 4));
                    $PEArr['PointerToRawData'] = $PEArr['PointerToRawData'][1];
                    $PEArr['SectionData'] = substr($Data, $PEArr['PointerToRawData'], $PEArr['SizeOfRawData']);
                    $PEArr['MD5'] = md5($PEArr['SectionData']);
                    $Returnable .= $PEArr['SizeOfRawData'] . ':' . $PEArr['MD5'] . ':' . $PEArr['SectionName'] . "\n";
                }
                $Returnable .= "\n";
                if (strpos($Data, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24") !== false) {
                    $PEArr['Parts'] = $phpMussel['substral']($Data, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24");
                    $PEArr['FINFO'] = [];
                    foreach ([
                        ["F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00", 'PEFileDescription'],
                        ["F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00", 'PEFileVersion'],
                        ["P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00", 'PEProductName'],
                        ["P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00", 'PEProductVersion'],
                        ["L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00", 'PECopyright'],
                        ["O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00", 'PEOriginalFilename'],
                        ["C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00", 'PECompanyName'],
                    ] as $PEVars) {
                        if (strpos($PEArr['Parts'], $PEVars[0]) !== false && (
                            $PEArr['ThisData'] = trim(str_ireplace("\x00", '', $phpMussel['substrbf'](
                                $phpMussel['substral']($PEArr['Parts'], $PEVars[0]),
                                "\x00\x00\x00"
                            )))
                        )) {
                            $Returnable .= '$' . $PEVars[1] . ':' . md5($PEArr['ThisData']) . ':' . strlen($PEArr['ThisData']) . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                        }
                    }
                }
                return $Returnable;
            });
        }

        /** Die child process back to parent. */
        die;
    }

    /** Echo the ASCII header art and CLI-mode information. */
    echo $phpMussel['L10N']->getString('cli_ln1') . "\n" . $phpMussel['L10N']->getString('cli_ln2') . "\n\n" . $phpMussel['L10N']->getString('cli_ln3');

    /** Open STDIN. */
    $phpMussel['stdin_handle'] = fopen('php://stdin', 'r');

    while (true) {

        /** Set CLI process title (PHP => 5.5.0). */
        if (function_exists('cli_set_process_title')) {
            cli_set_process_title($phpMussel['ScriptIdent']);
        }

        /** Echo the CLI-mode prompt. */
        echo "\n\n>> ";

        /** Wait for user input. */
        $phpMussel['stdin_clean'] = trim(fgets($phpMussel['stdin_handle']));

        /** Set CLI process title with "working" notice (PHP => 5.5.0). */
        if (function_exists('cli_set_process_title')) {
            cli_set_process_title($phpMussel['ScriptIdent'] . ' - ' . $phpMussel['L10N']->getString('cli_working') . '...');
        }

        /** Fetch the command. **/
        $phpMussel['cmd'] = strtolower($phpMussel['substrbf']($phpMussel['stdin_clean'], ' ') ?: $phpMussel['stdin_clean']);

        /** Exit CLI-mode. **/
        if ($phpMussel['cmd'] === 'quit' || $phpMussel['cmd'] === 'q' || $phpMussel['cmd'] === 'exit') {
            die;
        }

        /** Generate a hash signature using a file or directory. **/
        if ($phpMussel['cmd'] === 'md5_file' || $phpMussel['cmd'] === 'm' || $phpMussel['cmd'] === 'sha1_file' || substr($phpMussel['cmd'], 0, 10) === 'hash_file:') {
            if ($phpMussel['cmd'] === 'md5_file' || $phpMussel['cmd'] === 'm') {
                $phpMussel['ThisAlgo'] = 'md5';
            } elseif ($phpMussel['cmd'] === 'sha1_file') {
                $phpMussel['ThisAlgo'] = 'sha1';
            } else {
                $phpMussel['ThisAlgo'] = substr($phpMussel['cmd'], 10);
            }
            if (in_array($phpMussel['ThisAlgo'], hash_algos())) {
                echo "\n" . $phpMussel['CLI-RecursiveCommand']($phpMussel['stdin_clean'], function ($Params) use (&$phpMussel) {
                    $HashMe = $phpMussel['ReadFile']($Params, 0, true);
                    return hash($phpMussel['ThisAlgo'], $HashMe) . ':' . strlen($HashMe) . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                });
            } else {
                echo "\n" . $phpMussel['L10N']->getString('cli_algo_not_supported') . "\n";
            }
        }

        /** Generate a CoEx signature using a file. **/
        elseif ($phpMussel['cmd'] === 'coex_file') {
            echo "\n" . $phpMussel['CLI-RecursiveCommand']($phpMussel['stdin_clean'], function ($Params) use (&$phpMussel) {
                $HashMe = $phpMussel['ReadFile']($Params, 0, true);
                return
                    '$md5:' . md5($HashMe) . ';' .
                    '$sha:' . sha1($HashMe) . ';' .
                    '$str_len:' . strlen($HashMe) . ';' .
                    $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
            });
        }

        /** Fetch PE metadata. **/
        elseif ($phpMussel['cmd'] === 'pe_meta') {
            echo "\n" . $phpMussel['CLI-RecursiveCommand']($phpMussel['stdin_clean'], function ($Params) use (&$phpMussel) {
                return $phpMussel['Fork']($phpMussel['cmd'] . ' ' . $Params, $Params) . "\n";
            });
        }

        /** Generate a hash signature using a string. **/
        elseif ($phpMussel['cmd'] === 'md5' || $phpMussel['cmd'] === 'sha1' || substr($phpMussel['cmd'], 0, 5) === 'hash:') {
            $phpMussel['ThisAlgo'] = (
                $phpMussel['cmd'] === 'md5' || $phpMussel['cmd'] === 'sha1'
            ) ? $phpMussel['cmd'] : substr($phpMussel['cmd'], 5);
            if (in_array($phpMussel['ThisAlgo'], hash_algos())) {
                $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
                echo "\n" . hash($phpMussel['ThisAlgo'], $phpMussel['TargetData']) . ':' . strlen($phpMussel['TargetData']) . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
            } else {
                echo "\n" . $phpMussel['L10N']->getString('cli_algo_not_supported') . "\n";
            }
        }

        /** Generate a URL scanner signature from a URL. **/
        elseif ($phpMussel['cmd'] === 'url_sig') {
            echo "\n";
            $phpMussel['stdin_clean'] = $phpMussel['prescan_normalise'](substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1));
            $phpMussel['URL'] = ['avoidme' => '', 'forthis' => ''];
            if (
                !preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www\d{0,3}\.)?([\da-z.-]{1,512})/i', $phpMussel['stdin_clean'], $phpMussel['URL']['domain']) ||
                !preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www\d{0,3}\.)?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4000})/i', $phpMussel['stdin_clean'], $phpMussel['URL']['url'])
            ) {
                echo $phpMussel['L10N']->getString('invalid_url') . "\n";
            } else {
                echo 'DOMAIN:' . md5($phpMussel['URL']['domain'][3][0]) . ':' . strlen($phpMussel['URL']['domain'][3][0]) . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                $phpMussel['URL']['forthis'] = md5($phpMussel['URL']['url'][3][0]) . ':' . strlen($phpMussel['URL']['url'][3][0]);
                $phpMussel['URL']['avoidme'] .= ',' . $phpMussel['URL']['forthis'] . ',';
                echo 'URL:' . $phpMussel['URL']['forthis'] . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                if (preg_match('/[^\da-z.-]$/i', $phpMussel['URL']['url'][3][0])) {
                    $phpMussel['URL']['x'] = preg_replace('/[^\da-z.-]+$/i', '', $phpMussel['URL']['url'][3][0]);
                    $phpMussel['URL']['forthis'] = md5($phpMussel['URL']['x']) . ':' . strlen($phpMussel['URL']['x']);
                    if (strpos($phpMussel['URL']['avoidme'], $phpMussel['URL']['forthis']) === false) {
                        $phpMussel['URL']['avoidme'] .= ',' . $phpMussel['URL']['forthis'] . ',';
                        echo 'URL:' . $phpMussel['URL']['forthis'] . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                    }
                }
                if (strpos($phpMussel['URL']['url'][3][0], '?') !== false) {
                    $phpMussel['URL']['x'] = $phpMussel['substrbf']($phpMussel['URL']['url'][3][0], '?');
                    $phpMussel['URL']['forthis'] = md5($phpMussel['URL']['x']) . ':' . strlen($phpMussel['URL']['x']);
                    if (strpos($phpMussel['URL']['avoidme'], $phpMussel['URL']['forthis']) === false) {
                        $phpMussel['URL']['avoidme'] .= ',' . $phpMussel['URL']['forthis'] . ',';
                        echo 'URL:' . $phpMussel['URL']['forthis'] . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                    }
                    $phpMussel['URL']['x'] = $phpMussel['substraf']($phpMussel['URL']['url'][3][0], '?');
                    $phpMussel['URL']['forthis'] = md5($phpMussel['URL']['x']) . ':' . strlen($phpMussel['URL']['x']);
                    if (
                        strpos($phpMussel['URL']['avoidme'], $phpMussel['URL']['forthis']) === false &&
                        $phpMussel['URL']['forthis'] != 'd41d8cd98f00b204e9800998ecf8427e:0'
                    ) {
                        $phpMussel['URL']['avoidme'] .= ',' . $phpMussel['URL']['forthis'] . ',';
                        echo 'QUERY:' . $phpMussel['URL']['forthis'] . ':' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
                    }
                }
            }
            unset($phpMussel['URL']);
        }

        /** Generate a CoEx signature using a string. **/
        elseif ($phpMussel['cmd'] === 'coex') {
            $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo "\n\$md5:" . md5($phpMussel['TargetData']) . ';$sha:' . sha1($phpMussel['TargetData']) . ';$str_len:' . strlen($phpMussel['TargetData']) . ';' . $phpMussel['L10N']->getString('cli_signature_placeholder') . "\n";
        }

        /** Convert a binary string to a hexadecimal. **/
        elseif ($phpMussel['cmd'] === 'hex_encode' || $phpMussel['cmd'] === 'x') {
            $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo "\n" . bin2hex($phpMussel['TargetData']) . "\n";
        }

        /** Convert a hexadecimal to a binary string. **/
        elseif ($phpMussel['cmd'] === 'hex_decode') {
            $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo "\n" . ($phpMussel['HexSafe']($phpMussel['TargetData']) ?: $phpMussel['L10N']->getString('invalid_data')) . "\n";
        }

        /** Convert a binary string to a base64 string. **/
        elseif ($phpMussel['cmd'] === 'base64_encode' || $phpMussel['cmd'] === 'b') {
            $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo "\n" . base64_encode($phpMussel['TargetData']) . "\n";
        }

        /** Convert a base64 string to a binary string. **/
        elseif ($phpMussel['cmd'] === 'base64_decode') {
            $phpMussel['TargetData'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo "\n" . (base64_decode($phpMussel['TargetData']) ?: $phpMussel['L10N']->getString('invalid_data')) . "\n";
        }

        /** Scan a file or directory. **/
        elseif ($phpMussel['cmd'] === 'scan' || $phpMussel['cmd'] === 's') {
            echo "\n";
            $phpMussel['stdin_clean'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            $Out = $r = '';
            $phpMussel['InstanceCache']['start_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
            $phpMussel['InstanceCache']['start_time_2822'] = $phpMussel['TimeFormat']($phpMussel['InstanceCache']['start_time'], $phpMussel['Config']['general']['timeFormat']);
            echo $s = $phpMussel['InstanceCache']['start_time_2822'] . ' ' . $phpMussel['L10N']->getString('started') . $phpMussel['L10N']->getString('_fullstop_final') . "\n";
            if (is_dir($phpMussel['stdin_clean'])) {
                if (!is_readable($phpMussel['stdin_clean'])) {
                    $Out = '> ' . sprintf($phpMussel['L10N']->getString('failed_to_access'), $phpMussel['stdin_clean']) . "\n";
                } else {
                    $Terminal = $phpMussel['stdin_clean'][strlen($phpMussel['stdin_clean']) - 1];
                    if ($Terminal !== "\\" && $Terminal !== '/') {
                        $phpMussel['stdin_clean'] .= '/';
                    }
                    $List = $phpMussel['DirectoryRecursiveList']($phpMussel['stdin_clean']);
                    $Total = count($List);
                    $Current = 0;
                    foreach ($List as $Item) {
                        $Percent = round(($Current / $Total) * 100, 2) . '%';
                        echo $Percent . ' ' . $phpMussel['L10N']->getString('scan_complete') . $phpMussel['L10N']->getString('_fullstop_final');
                        $Out = $phpMussel['Fork']('scan ' . $phpMussel['stdin_clean'] . $Item, $Item);
                        if (!$Out) {
                            $Out = '> ' . sprintf(
                                $phpMussel['L10N']->getString('_exclamation_final'),
                                $phpMussel['L10N']->getString('cli_failed_to_complete') . ' (' . $Item . ')'
                            ) . "\n";
                        }
                        $r .= $Out;
                        echo "\r" . $phpMussel['prescan_decode']($Out);
                        $Out = '';
                    }
                }
            } elseif (is_file($phpMussel['stdin_clean'])) {
                $Out = $phpMussel['Fork']('scan ' . $phpMussel['stdin_clean'], $phpMussel['stdin_clean']);
                if (!$Out) {
                    $Out = '> ' . sprintf(
                        $phpMussel['L10N']->getString('_exclamation_final'),
                        $phpMussel['L10N']->getString('cli_failed_to_complete')
                    ) . "\n";
                }
            } elseif (!$Out) {
                $Out = '> ' . sprintf($phpMussel['L10N']->getString('cli_is_not_a'), $phpMussel['stdin_clean']) . "\n";
            }
            $r .= $Out;
            if ($Out) {
                echo $phpMussel['prescan_decode']($Out);
                $Out = '';
            }
            $phpMussel['InstanceCache']['end_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
            $phpMussel['InstanceCache']['end_time_2822'] = $phpMussel['TimeFormat']($phpMussel['InstanceCache']['end_time'], $phpMussel['Config']['general']['timeFormat']);
            $r = $s . $r;
            $s = $phpMussel['InstanceCache']['end_time_2822'] . ' ' . $phpMussel['L10N']->getString('finished') . $phpMussel['L10N']->getString('_fullstop_final') . "\n";
            echo $s;
            $r .= $s;
            $phpMussel['WriteScanLog']($r);
            $phpMussel['WriteSerial']($phpMussel['InstanceCache']['start_time'], $phpMussel['InstanceCache']['end_time']);
            unset($r, $s);
        }

        /** Add an entry to the greylist. **/
        elseif ($phpMussel['cmd'] === 'greylist' || $phpMussel['cmd'] === 'g') {
            echo "\n";
            $phpMussel['stdin_clean'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            if (!empty($phpMussel['stdin_clean'])) {
                $Greylist = file_exists($phpMussel['Vault'] . 'greylist.csv') ? $phpMussel['stdin_clean'] . ',' : ',' . $phpMussel['stdin_clean'] . ',';
                $Handle = fopen($phpMussel['Vault'] . 'greylist.csv', 'a');
                fwrite($Handle, $Greylist);
                fclose($Handle);
                unset($Handle, $Greylist);
                echo $phpMussel['L10N']->getString('greylist_updated');
            }
        }

        /** Clear the greylist. **/
        elseif ($phpMussel['cmd'] === 'greylist_clear' || $phpMussel['cmd'] === 'gc') {
            echo "\n";
            $Handle = fopen($phpMussel['Vault'] . 'greylist.csv', 'a');
            ftruncate($Handle, 0);
            fwrite($Handle, ',');
            fclose($Handle);
            unset($Handle, $Greylist);
            echo $phpMussel['L10N']->getString('greylist_cleared');
        }

        /** Show the greylist. **/
        elseif ($phpMussel['cmd'] === 'greylist_show' || $phpMussel['cmd'] === 'gs') {
            $phpMussel['stdin_clean'] = substr($phpMussel['stdin_clean'], strlen($phpMussel['cmd']) + 1);
            echo file_exists(
                $phpMussel['Vault'] . 'greylist.csv'
            ) ? "\n greylist.csv:\n" . implode("\n ", explode(',', $phpMussel['ReadFile'](
                $phpMussel['Vault'] . 'greylist.csv'
            ))) : "\n " . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('x_does_not_exist'), 'greylist.csv')
            );
        }

        /** Print the command list. **/
        elseif ($phpMussel['cmd'] === 'c') {
            echo $phpMussel['L10N']->getString('cli_commands');
        }

        /** Print a list of supported algorithms. **/
        elseif ($phpMussel['cmd'] === 'algo') {
            $Algos = hash_algos();
            $Pos = 1;
            foreach ($Algos as $Algo) {
                if ($Pos === 1) {
                    echo ' ';
                }
                echo $Algo;
                $Pos += 16;
                if ($Pos < 76) {
                    echo str_repeat(' ', 16 - strlen($Algo));
                } else {
                    $Pos = 1;
                    echo "\n";
                }
            }
            echo "\n";
        }

        /** Bad command notice. */
        else {
            echo "\n" . $phpMussel['L10N']->getString('bad_command') . "\n";
        }

    }

    die;
}

/** Restores default error handler (assuming we somehow reach this far). */
$phpMussel['RestoreErrorHandler']();
