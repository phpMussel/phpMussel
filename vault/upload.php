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
 * This file: Upload handler (last modified: 2019.06.07).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Initialise an error handler. */
$phpMussel['InitialiseErrorHandler']();

/** Create an array for our working data. */
$phpMussel['upload'] = [];

/**
 * We need to count the number of elements contained by the $_FILES array, to
 * know if there are any file uploads to be scanned during execution of the
 * script.
 */
$phpMussel['upload']['count'] = empty($_FILES) ? 0 : count($_FILES);

/** Only continue if there are uploads to deal with. */
if ($phpMussel['upload']['count'] > 0 && !$phpMussel['Config']['general']['maintenance_mode']) {

    /**
     * Whenever something is detected in a file being scanned, a human-readable
     * description of what has been detected is appended to
     * $phpMussel['whyflagged']; This variable contains the "Detected ... !"
     * message you see on the "Upload Denied!" page generated whenever a file
     * upload has been blocked.
     *
     * The $phpMussel['killdata'] variable contains hashes referencing every
     * file upload blocked and every file where something has been detected in
     * that file, in the form of "HASH:FILESIZE:FILENAME".
     *
     * If the file being scanned happens to be a PE file, in addition to the
     * information appended to $phpMussel['whyflagged'] and
     * $phpMussel['killdata'], reconstructed references to the PE sections of
     * that PE file will be appended to the $phpMussel['PEData'] variable.
     *
     * If logging is enabled, the information contained by these three
     * variables will all be logged as per the specified by the logging-related
     * directives of the phpMussel configuration file.
     */
    $phpMussel['whyflagged'] = $phpMussel['killdata'] = $phpMussel['PEData'] = '';

    /** Process the hash cache. */
    $phpMussel['PrepareHashCache']();

    /** File upload scan start time. */
    $phpMussel['InstanceCache']['start_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

    /** Create an array for normalising the $_FILES data. */
    $phpMussel['upload']['FilesData'] = [];

    /** Generate "HONEYPOT EVENT" header (if "honeypot_mode" is enabled). */
    if ($phpMussel['Config']['general']['honeypot_mode']) {
        $phpMussel['InstanceCache']['Handle'] = ['qdata' =>
            "== HONEYPOT EVENT ==\nDATE: " . $phpMussel['TimeFormat'](
                $phpMussel['InstanceCache']['start_time'],
                $phpMussel['Config']['general']['timeFormat']
            ) . "\nIP ADDRESS: " . ($phpMussel['Config']['legal']['pseudonymise_ip_addresses'] ? $phpMussel['Pseudonymise-IP'](
                $_SERVER[$phpMussel['IPAddr']]
            ) : $_SERVER[$phpMussel['IPAddr']]) . "\n"
        ];
    }

    foreach ($_FILES as $phpMussel['ThisFileKey'] => $phpMussel['ThisFileData']) {
        if (!isset($phpMussel['ThisFileData']['error'])) {
            continue;
        }
        /** Normalise the structure of the uploads array. */
        if (!is_array($phpMussel['ThisFileData']['error'])) {
            $phpMussel['upload']['FilesData']['FileSet'] = [
                'name' => [$phpMussel['ThisFileData']['name']],
                'type' => [$phpMussel['ThisFileData']['type']],
                'tmp_name' => [$phpMussel['ThisFileData']['tmp_name']],
                'error' => [$phpMussel['ThisFileData']['error']],
                'size' => [$phpMussel['ThisFileData']['size']]
            ];
        } else {
            $phpMussel['upload']['FilesData']['FileSet'] = $phpMussel['ThisFileData'];
        }
        $phpMussel['ThisFilesCount'] = count($phpMussel['upload']['FilesData']['FileSet']['error']);

        for (
            $phpMussel['ThisIter'] = 0, $phpMussel['SkipSerial'] = true;
            $phpMussel['ThisIter'] < $phpMussel['ThisFilesCount'];
            $phpMussel['ThisIter']++
        ) {
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']])) {
                $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['type'][$phpMussel['ThisIter']])) {
                $phpMussel['upload']['FilesData']['FileSet']['type'][$phpMussel['ThisIter']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']])) {
                $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['ThisIter']])) {
                $phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['ThisIter']] = 0;
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['ThisIter']])) {
                $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['ThisIter']] = 0;
            }

            unset($phpMussel['upload']['ThisError']);
            $phpMussel['upload']['ThisError'] = &$phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['ThisIter']];

            /** Handle upload errors. */
            if ($phpMussel['upload']['ThisError'] > 0) {
                if (
                    $phpMussel['Config']['compatibility']['ignore_upload_errors'] ||
                    $phpMussel['upload']['ThisError'] > 8 ||
                    $phpMussel['upload']['ThisError'] === 5
                ) {
                    continue;
                }
                $phpMussel['killdata'] .= sprintf(
                    "---------UPLOAD-ERROR-%d---------:%d:%s\n",
                    $phpMussel['upload']['ThisError'],
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['ThisIter']],
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']]
                );
                $phpMussel['whyflagged'] .= $phpMussel['L10N']->getString((
                    $phpMussel['upload']['ThisError'] === 3 || $phpMussel['upload']['ThisError'] === 4
                ) ? 'upload_error_34' : 'upload_error_' . $phpMussel['upload']['ThisError']);
                if (
                    ($phpMussel['upload']['ThisError'] === 1 || $phpMussel['upload']['ThisError'] === 2) &&
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]) &&
                    is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']])
                ) {
                    unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]);
                }
                continue;
            }

            /** Protection against upload spoofing. */
            if (!is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']])) {
                $phpMussel['killdata'] .= sprintf(
                    "UNAUTHORISED-FILE-UPLOAD-NO-HASH:%d:%s\n",
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['ThisIter']],
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']]
                );
                $phpMussel['whyflagged'] .= sprintf($phpMussel['L10N']->getString('_exclamation'), sprintf(
                    '%s (%s)',
                    $phpMussel['L10N']->getString('scan_unauthorised_upload'),
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']]
                ));
            } elseif (
                !$phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']] ||
                !$phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]
            ) {
                $phpMussel['killdata'] .= "-UNAUTHORISED-UPLOAD-MISCONFIG-:?:?\n";
                $phpMussel['whyflagged'] .= $phpMussel['L10N']->getString('scan_unauthorised_upload_or_misconfig');
            } else {

                /** Honeypot code. */
                if (
                    $phpMussel['Config']['general']['honeypot_mode'] &&
                    $phpMussel['Config']['general']['quarantine_key']
                ) {
                    $phpMussel['ReadFile-For-Honeypot'](
                        $phpMussel['InstanceCache']['Handle'],
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]
                    );
                }

                /** Process this block if the number of files being uploaded exceeds "max_uploads". */
                if (
                    $phpMussel['upload']['count'] > $phpMussel['Config']['files']['max_uploads'] &&
                    $phpMussel['Config']['files']['max_uploads'] >= 1
                ) {
                    $phpMussel['KillAndUnlink']();
                    continue;
                }

                /** Used for serialised logging. */
                if ($phpMussel['ThisIter'] === ($phpMussel['ThisFilesCount'] - 1)) {
                    unset($phpMussel['SkipSerial']);
                }

                /** Execute the scan! */
                try {
                    $phpMussel['r'] = $phpMussel['Scan'](
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']],
                        true,
                        true,
                        0,
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']]
                    );
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

            }
        }
    }
    /** Cleanup. */
    unset($phpMussel['r'], $phpMussel['ThisIter'], $phpMussel['ThisFilesCount'], $phpMussel['ThisFileKey'], $phpMussel['ThisFileData']);

    /** Honeypot code. */
    if (
        $phpMussel['Config']['general']['honeypot_mode'] &&
        $phpMussel['Config']['general']['scan_kills'] &&
        is_array($phpMussel['InstanceCache']['Handle'])
    ) {
        $phpMussel['InstanceCache']['Handle']['File'] = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills']);
        $phpMussel['InstanceCache']['Handle']['WriteMode'] = (
            !file_exists($phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File']) || (
                $phpMussel['Config']['general']['truncate'] > 0 &&
                filesize($phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
            )
        ) ? 'w' : 'a';
        if (!file_exists($phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File'])) {
            $phpMussel['InstanceCache']['Handle']['qdata'] = $phpMussel['safety'] . "\n\n" . $phpMussel['InstanceCache']['Handle']['qdata'];
        }
        if ($phpMussel['BuildLogPath']($phpMussel['InstanceCache']['Handle']['File'])) {
            $phpMussel['InstanceCache']['Handle']['Stream'] = fopen(
                $phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File'],
                $phpMussel['InstanceCache']['Handle']['WriteMode']
            );
            fwrite($phpMussel['InstanceCache']['Handle']['Stream'], $phpMussel['InstanceCache']['Handle']['qdata']);
            fclose($phpMussel['InstanceCache']['Handle']['Stream']);
            if ($phpMussel['InstanceCache']['Handle']['WriteMode'] === 'w') {
                $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_kills']);
            }
        }
        $phpMussel['InstanceCache']['Handle'] = '';
    }

    /** Update the hash cache. */
    if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0 && !empty($phpMussel['HashCache']['Data']) && is_array($phpMussel['HashCache']['Data'])) {

        $phpMussel['HashCache']['Data'] = array_map(function ($Item) {
            return is_array($Item) ? implode(':', $Item) . ';' : $Item;
        }, $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Data'] = implode('', $phpMussel['HashCache']['Data']);

        /** Update hash cache. */
        $phpMussel['HashCache']['Data'] = $phpMussel['SaveCache'](
            'HashCache',
            $phpMussel['Time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
            $phpMussel['HashCache']['Data']
        );
        unset($phpMussel['HashCache']);

    }

    /** File upload scan finish time. */
    $phpMussel['InstanceCache']['end_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

    /** Trim trailing whitespace. */
    $phpMussel['whyflagged'] = trim($phpMussel['whyflagged']);

    /** Begin processing file upload detections. */
    if ($phpMussel['whyflagged']) {

        /** A fix for correctly displaying LTR/RTL text. */
        if ($phpMussel['L10N']->getString('Text Direction') !== 'rtl') {
            $phpMussel['lang']['Text Direction'] = 'ltr';
        }

        /** Merging parsable variables for the template data. */
        $phpMussel['TemplateData'] = $phpMussel['lang'] + $phpMussel['Config']['template_data'];
        $phpMussel['TemplateData']['detected'] = $phpMussel['whyflagged'];
        $phpMussel['TemplateData']['phpmusselversion'] = $phpMussel['ScriptIdent'];
        $phpMussel['TemplateData']['favicon'] = $phpMussel['favicon'];
        $phpMussel['TemplateData']['xmlLang'] = $phpMussel['Config']['general']['lang'];

        /** Determine which template file to use, if this hasn't already been determined. */
        if (!isset($phpMussel['InstanceCache']['template_file'])) {
            $phpMussel['InstanceCache']['template_file'] = !$phpMussel['Config']['template_data']['css_url'] ?
                'template_' . $phpMussel['Config']['template_data']['theme'] . '.html' : 'template_custom.html';
        }

        /** Fallback for themes without default template files. */
        if (
            $phpMussel['Config']['template_data']['theme'] !== 'default' &&
            !$phpMussel['Config']['template_data']['css_url'] &&
            !file_exists($phpMussel['Vault'] . $phpMussel['InstanceCache']['template_file'])
        ) {
            $phpMussel['InstanceCache']['template_file'] = 'template_default.html';
        }

        /** Log "scan_kills" data. */
        if ($phpMussel['Config']['general']['scan_kills'] && !empty($phpMussel['killdata'])) {
            $phpMussel['InstanceCache']['Handle'] = [
                'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills'])
            ];
            $phpMussel['InstanceCache']['Handle']['WriteMode'] = (
                !file_exists($phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File']) || (
                    $phpMussel['Config']['general']['truncate'] > 0 &&
                    filesize($phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
                )
            ) ? 'w' : 'a';
            $phpMussel['InstanceCache']['Handle']['Data'] = file_exists(
                $phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File']
            ) ? '' : $phpMussel['safety'] . "\n\n";
            $phpMussel['InstanceCache']['Handle']['Data'] .= sprintf(
                "%s: %s\n%s: %s\n== %s ==\n%s\n== %s ==\n%s",
                $phpMussel['L10N']->getString('field_date'),
                $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['timeFormat']),
                $phpMussel['L10N']->getString('field_ip_address'),
                ($phpMussel['Config']['legal']['pseudonymise_ip_addresses'] ? $phpMussel['Pseudonymise-IP'](
                    $_SERVER[$phpMussel['IPAddr']]
                ) : $_SERVER[$phpMussel['IPAddr']]),
                $phpMussel['L10N']->getString('field_header_scan_results_why_flagged'),
                $phpMussel['whyflagged'],
                $phpMussel['L10N']->getString('field_header_hash_reconstruction'),
                $phpMussel['killdata']
            );
            if ($phpMussel['PEData']) {
                $phpMussel['InstanceCache']['Handle']['Data'] .= sprintf(
                    "== %s ==\n%s",
                    $phpMussel['L10N']->getString('field_header_pe_reconstruction'),
                    $phpMussel['PEData']
                );
            }
            $phpMussel['InstanceCache']['Handle']['Data'] .= "\n";
            if ($phpMussel['BuildLogPath']($phpMussel['InstanceCache']['Handle']['File'])) {
                $phpMussel['InstanceCache']['Handle']['Stream'] = fopen(
                    $phpMussel['Vault'] . $phpMussel['InstanceCache']['Handle']['File'],
                    $phpMussel['InstanceCache']['Handle']['WriteMode']
                );
                fwrite($phpMussel['InstanceCache']['Handle']['Stream'], $phpMussel['InstanceCache']['Handle']['Data']);
                fclose($phpMussel['InstanceCache']['Handle']['Stream']);
                if ($phpMussel['InstanceCache']['Handle']['WriteMode'] === 'w') {
                    $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_kills']);
                }
            }
            $phpMussel['InstanceCache']['Handle'] = '';
        }

        /** Fallback to use if the HTML template file is missing. */
        if (!file_exists($phpMussel['Vault'] . $phpMussel['InstanceCache']['template_file'])) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['L10N']->getString('denied') . ' ' . $phpMussel['TemplateData']['detected']);
        }

        /** Send a 403 FORBIDDEN status code to the client if "forbid_on_block" is enabled. */
        if ($phpMussel['Config']['general']['forbid_on_block']) {
            header('HTTP/1.0 403 Forbidden');
            header('HTTP/1.1 403 Forbidden');
            header('Status: 403 Forbidden');
        }

        /** Include privacy policy. */
        $phpMussel['TemplateData']['pp'] = empty(
            $phpMussel['Config']['legal']['privacy_policy']
        ) ? '' : '<br /><a href="' . $phpMussel['Config']['legal']['privacy_policy'] . '">' . $phpMussel['L10N']->getString('PrivacyPolicy') . '</a>';

        /** Generate HTML output. */
        $phpMussel['HTML'] = $phpMussel['ParseVars'](
            $phpMussel['TemplateData'],
            $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['InstanceCache']['template_file'], 0, true)
        );

        /** Plugin hook: "before_html_out". */
        $phpMussel['Execute_Hook']('before_html_out');

        /** Handle webfonts. */
        if (empty($phpMussel['Config']['general']['disable_webfonts'])) {
            $phpMussel['HTML'] = str_replace(['<!-- WebFont Begin -->', '<!-- WebFont End -->'], '', $phpMussel['HTML']);
        } else {
            $phpMussel['WebFontPos'] = [
                'Begin' => strpos($phpMussel['HTML'], '<!-- WebFont Begin -->'),
                'End' => strpos($phpMussel['HTML'], '<!-- WebFont End -->')
            ];
            if ($phpMussel['WebFontPos']['Begin'] !== false && $phpMussel['WebFontPos']['End'] !== false) {
                $phpMussel['HTML'] = (
                    substr($phpMussel['HTML'], 0, $phpMussel['WebFontPos']['Begin']) .
                    substr($phpMussel['HTML'], $phpMussel['WebFontPos']['End'] + 20)
                );
            }
            unset($phpMussel['WebFontPos']);
        }

        /** Send HTML output and the kill the script. */
        die($phpMussel['HTML']);

    }

}

/** Exit the upload handler cleanly. */
unset($phpMussel['upload']);

/** Restores default error handler. */
$phpMussel['RestoreErrorHandler']();
