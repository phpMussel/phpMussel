<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Upload handler (last modified: 2017.05.19).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Create an array for our working data. */
$phpMussel['upload'] = array();

/**
 * We need to count the number of elements contained by the $_FILES array, to
 * know if there are any file uploads to be scanned during execution of the
 * script.
 */
$phpMussel['upload']['count'] = empty($_FILES) ? 0 : count($_FILES);

/** Only continue if there are uploads to deal with. */
if ($phpMussel['upload']['count'] > 0) {

    /**
     * Whenever something is detected in a file being scanned, a human-readable
     * description of what has been detected is appended to
     * $phpMussel['whyflagged']; This variable contains the "Detected ... !"
     * message you see on the "Upload Denied!" page generated whenever a file
     * upload has been blocked.
     *
     * The $phpMussel['killdata'] variable contains a hash reference to every
     * file upload blocked and to every file where something has been detected
     * in that file, in the form of "FILE-MD5-HASH:FILESIZE:FILENAME".
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

    /** Create an array for our hash cache data. */
    $phpMussel['HashCache'] = array();

    /** Fetch the hash cache (a record of recently scanned files). */
    $phpMussel['HashCache']['Data'] =
        ($phpMussel['upload']['count'] > 0 && $phpMussel['Config']['general']['scan_cache_expiry'] > 0) ?
        $phpMussel['FetchCache']('HashCache') :
        '';

    /** Process the hash cache. */
    if (!empty($phpMussel['HashCache']['Data'])) {
        $phpMussel['HashCache']['Data'] = explode(';', $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Build'] = array();
        $phpMussel['HashCache']['Count'] = count($phpMussel['HashCache']['Data']);
        for (
            $phpMussel['HashCache']['Index'] = 0;
            $phpMussel['HashCache']['Index'] < $phpMussel['HashCache']['Count'];
            $phpMussel['HashCache']['Index']++
        ) {
            if (substr_count($phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']], ':')) {
                $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']] =
                    explode(':', $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']], 4);
                if (!($phpMussel['Time'] > $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']][1])) {
                    $phpMussel['HashCache']['Build'][$phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']][0]] =
                        $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']];
                }
            }
        }
        $phpMussel['HashCache']['Data'] = $phpMussel['HashCache']['Build'];
        unset($phpMussel['HashCache']['Build']);
    }

    /** Reset the $_FILES caret. */
    reset($_FILES);

    /** File upload scan start time. */
    $phpMussel['memCache']['start_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

    /** Create an array for normalising the $_FILES data. */
    $phpMussel['upload']['FilesData'] = array();

    /** Generate "HONEYPOT EVENT" header (if "honeypot_mode" is enabled). */
    if ($phpMussel['Config']['general']['honeypot_mode']) {
        $phpMussel['memCache']['handle'] = array();
        $phpMussel['memCache']['handle']['qdata'] =
            "== HONEYPOT EVENT ==\n DATE: " .
            $phpMussel['TimeFormat']($phpMussel['memCache']['start_time'], $phpMussel['Config']['general']['timeFormat']) .
            "\nIP ADDRESS: " .
            $_SERVER[$phpMussel['Config']['general']['ipaddr']] .
            "\n";
    }

    for (
        $phpMussel['upload']['FilesData']['i'] = 0;
        $phpMussel['upload']['FilesData']['i'] < $phpMussel['upload']['count'];
        $phpMussel['upload']['FilesData']['i']++
    ) {
        $phpMussel['upload']['FilesData']['k'] = key($_FILES);
        if (!isset($_FILES[$phpMussel['upload']['FilesData']['k']]['error'])) {
            next($_FILES);
            continue;
        }
        /** Begin normalising the $_FILES data to the "FilesData" array. */
        if (!is_array($_FILES[$phpMussel['upload']['FilesData']['k']]['error'])) {
            $phpMussel['upload']['FilesData']['FileSet'] = array();
            $phpMussel['upload']['FilesData']['FileSet']['name'] =
                array($_FILES[$phpMussel['upload']['FilesData']['k']]['name']);
            $phpMussel['upload']['FilesData']['FileSet']['type'] =
                array($_FILES[$phpMussel['upload']['FilesData']['k']]['type']);
            $phpMussel['upload']['FilesData']['FileSet']['tmp_name'] =
                array($_FILES[$phpMussel['upload']['FilesData']['k']]['tmp_name']);
            $phpMussel['upload']['FilesData']['FileSet']['error'] =
                array($_FILES[$phpMussel['upload']['FilesData']['k']]['error']);
            $phpMussel['upload']['FilesData']['FileSet']['size'] =
                array($_FILES[$phpMussel['upload']['FilesData']['k']]['size']);
        } else {
            $phpMussel['upload']['FilesData']['FileSet'] =
                $_FILES[$phpMussel['upload']['FilesData']['k']];
        }
        $phpMussel['upload']['FilesData']['FileSet']['c'] =
            count($phpMussel['upload']['FilesData']['FileSet']['error']);

        for (
            $phpMussel['upload']['FilesData']['FileSet']['i'] = 0;
            $phpMussel['upload']['FilesData']['FileSet']['i'] < $phpMussel['upload']['FilesData']['FileSet']['c'];
            $phpMussel['upload']['FilesData']['FileSet']['i']++
        ) {
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['type'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['upload']['FilesData']['FileSet']['type'][$phpMussel['upload']['FilesData']['FileSet']['i']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']] = '';
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] = 0;
            }
            if (!isset($phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] = 0;
            }

            if ($phpMussel['Config']['compatibility']['ignore_upload_errors']) {
                if ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] > 0) {
                    next($_FILES);
                    continue;
                }

                /** Honeypot code. */
                if (
                    $phpMussel['Config']['general']['honeypot_mode'] &&
                    $phpMussel['Config']['general']['quarantine_key'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    $phpMussel['memCache']['handle']['odata'] =
                        $phpMussel['ReadFile']($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    $phpMussel['memCache']['handle']['len'] =
                        strlen($phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['crc'] =
                        hash('crc32b', $phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['qfile'] =
                        $phpMussel['Time'] . '-' .
                        md5(
                            $phpMussel['Config']['general']['quarantine_key'] .
                            $phpMussel['memCache']['handle']['crc'] .
                            $phpMussel['Time']
                        );
                    if (
                        $phpMussel['memCache']['handle']['len'] > 0 &&
                        $phpMussel['memCache']['handle']['len'] < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
                    ) {
                        $phpMussel['Quarantine'](
                            $phpMussel['memCache']['handle']['odata'],
                            $phpMussel['Config']['general']['quarantine_key'],
                            $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                            $phpMussel['memCache']['handle']['qfile']
                        );
                    }
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                    ) {
                        unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    $phpMussel['memCache']['handle']['qdata'] .=
                        'TEMP FILENAME: ' .
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\nFILENAME: " .
                        urlencode($phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) .
                        "\nFILESIZE: " .
                        $phpMussel['memCache']['handle']['len'] .
                        "\nMD5: " .
                        md5($phpMussel['memCache']['handle']['odata']) .
                        "\n" . $phpMussel['ParseVars'](
                            array('QFU' => $phpMussel['memCache']['handle']['qfile']),
                            $phpMussel['lang']['quarantined_as']
                        );
                }

                /** Process this block if the number of files being uploaded exceeds "max_uploads". */
                if (
                    $phpMussel['upload']['count'] > $phpMussel['Config']['files']['max_uploads'] &&
                    $phpMussel['Config']['files']['max_uploads'] >= 1
                ) {
                    $phpMussel['killdata'] .=
                        '-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:' .
                        $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ':' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['lang']['upload_limit_exceeded'] .
                        ' (' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ')' .
                        $phpMussel['lang']['_exclamation'];
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                        is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                        !$phpMussel['Config']['general']['honeypot_mode']
                    ) {
                        unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    next($_FILES);
                    continue;
                }

                /** Execute the scan! */
                try {
                    $r = $phpMussel['Scan'](
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                        true,
                        true,
                        0,
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                    );
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 1) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-1---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_1'];
                if (
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                    is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                }
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 2) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-2---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_2'];
                if (
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                    is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                }
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 3) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-3---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_34'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 4) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-4---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_34'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 6) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-6---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_6'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 7) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-7---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_7'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 8) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-8---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['upload_error_8'];
            } elseif (!is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['killdata'] .=
                    'UNAUTHORISED-FILE-UPLOAD-NO-HASH:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .=
                    $phpMussel['lang']['scan_unauthorised_upload'] .
                    ' (' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ')' .
                    $phpMussel['lang']['_exclamation'];
            } elseif (
                !$phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] ||
                !$phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
            ) {
                $phpMussel['killdata'] .= "-UNAUTHORISED-UPLOAD-MISCONFIG-:?:?\n";
                $phpMussel['whyflagged'] .= $phpMussel['lang']['scan_unauthorised_upload_or_misconfig'];
            } else {

                /** Honeypot code. */
                if (
                    $phpMussel['Config']['general']['honeypot_mode'] &&
                    $phpMussel['Config']['general']['quarantine_key']
                ) {
                    $phpMussel['memCache']['handle']['odata'] =
                        $phpMussel['ReadFile']($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    $phpMussel['memCache']['handle']['len'] =
                        strlen($phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['crc'] =
                        hash('crc32b', $phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['qfile'] =
                        $phpMussel['Time'] .
                        '-' .
                        md5(
                            $phpMussel['Config']['general']['quarantine_key'] .
                            $phpMussel['memCache']['handle']['crc'] .
                            $phpMussel['Time']
                        );
                    if (
                        $phpMussel['memCache']['handle']['len'] > 0 &&
                        $phpMussel['memCache']['handle']['len'] < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
                    ) {
                        $phpMussel['Quarantine'](
                            $phpMussel['memCache']['handle']['odata'],
                            $phpMussel['Config']['general']['quarantine_key'],
                            $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                            $phpMussel['memCache']['handle']['qfile']
                        );
                    }
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']] &&
                        is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                    ) {
                        unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    $phpMussel['memCache']['handle']['qdata'] .=
                        'TEMP FILENAME: ' .
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\nFILENAME: " .
                        urlencode($phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) .
                        "\nFILESIZE: " .
                        $phpMussel['memCache']['handle']['len'] .
                        "\nMD5: " .
                        md5($phpMussel['memCache']['handle']['odata']) .
                        "\n" . $phpMussel['ParseVars'](
                            array('QFU' => $phpMussel['memCache']['handle']['qfile']),
                            $phpMussel['lang']['quarantined_as']
                        );
                }

                /** Process this block if the number of files being uploaded exceeds "max_uploads". */
                if (
                    $phpMussel['upload']['count'] > $phpMussel['Config']['files']['max_uploads'] &&
                    $phpMussel['Config']['files']['max_uploads'] >= 1
                ) {
                    $phpMussel['killdata'] .=
                        '-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:' .
                        $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ':' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['lang']['upload_limit_exceeded'] .
                        ' (' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ')' .
                        $phpMussel['lang']['_exclamation'];
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        !$phpMussel['Config']['general']['honeypot_mode'] &&
                        is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                    ) {
                        unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    next($_FILES);
                    continue;
                }

                /** Execute the scan! */
                try {
                    $r = $phpMussel['Scan'](
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                        true,
                        true,
                        0,
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                    );
                } catch (\Exception $e) {
                    die($e->getMessage());
                }

            }
        }
        next($_FILES);

    }

    if ($phpMussel['Config']['general']['honeypot_mode'] && $phpMussel['Config']['general']['scan_kills']) {
        $phpMussel['memCache']['handle'] = array(
            'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills'])
        );
        if (!file_exists($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File'])) {
            $phpMussel['memCache']['handle']['qdata'] =
                $phpMussel['safety'] . "\n" . $phpMussel['memCache']['handle']['qdata'];
        }
        $phpMussel['memCache']['handle']['Stream'] =
            fopen($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File'], 'a');
        fwrite($phpMussel['memCache']['handle']['Stream'], $phpMussel['memCache']['handle']['qdata']);
        fclose($phpMussel['memCache']['handle']['Stream']);
        $phpMussel['memCache']['handle'] = '';
    }

    /** Update the hash cache. */
    if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0 && !empty($phpMussel['HashCache']['Data']) && is_array($phpMussel['HashCache']['Data'])) {

        /** Reset the hash cache caret. */
        $phpMussel['HashCache']['Data'] = array_map(function ($Item) {
            return (is_array($Item)) ? implode(':', $Item) . ';' : $Item;
        }, $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Data'] = implode('', $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Data'] = $phpMussel['SaveCache'](
            'HashCache',
            $phpMussel['Time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
            $phpMussel['HashCache']['Data']
        );
        unset($phpMussel['HashCache']);

    }

    /** File upload scan finish time. */
    $phpMussel['memCache']['end_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

    /** Trim trailing whitespace. */
    $phpMussel['whyflagged'] = trim($phpMussel['whyflagged']);

    /** Log "scan_log_serialized" data. */
    if ($phpMussel['Config']['general']['scan_log_serialized']) {
        if (!isset($phpMussel['memCache']['objects_scanned'])) {
            $phpMussel['memCache']['objects_scanned'] = 0;
        }
        if (!isset($phpMussel['memCache']['detections_count'])) {
            $phpMussel['memCache']['detections_count'] = 0;
        }
        if (!isset($phpMussel['memCache']['scan_errors'])) {
            $phpMussel['memCache']['scan_errors'] = 1;
        }
        $phpMussel['memCache']['handle'] = array(
            'Data' => serialize(array(
                'start_time' => $phpMussel['memCache']['start_time'],
                'end_time' => $phpMussel['memCache']['end_time'],
                'origin' => $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                'objects_scanned' => $phpMussel['memCache']['objects_scanned'],
                'detections_count' => $phpMussel['memCache']['detections_count'],
                'scan_errors' => $phpMussel['memCache']['scan_errors'],
                'detections' => trim($phpMussel['whyflagged'])
            )) . "\n",
            'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_log_serialized'])
        );
        $phpMussel['memCache']['handle']['WriteMode'] = (
            !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File']) || (
                $phpMussel['Config']['general']['truncate'] > 0 &&
                filesize($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
            )
        ) ? 'w' : 'a';
        $phpMussel['memCache']['handle']['Stream'] =
            fopen($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File'], $phpMussel['memCache']['handle']['WriteMode']);
        fwrite($phpMussel['memCache']['handle']['Stream'], $phpMussel['memCache']['handle']['Data']);
        fclose($phpMussel['memCache']['handle']['Stream']);
        $phpMussel['memCache']['handle'] = '';
    }

    /** Reset the $_FILES caret. */
    reset($_FILES);

    /** Begin processing file upload detections. */
    if (!empty($phpMussel['whyflagged'])) {

        /** A fix for correctly displaying LTR/RTL text. */
        if (empty($phpMussel['lang']['textDir']) || $phpMussel['lang']['textDir'] !== 'rtl') {
            $phpMussel['lang']['textDir'] = 'ltr';
        }

        /** Merging parsable variables for the template data. */
        $phpMussel['TemplateData'] = $phpMussel['lang'] + $phpMussel['Config']['template_data'];
        $phpMussel['TemplateData']['detected'] = $phpMussel['whyflagged'];
        $phpMussel['TemplateData']['phpmusselversion'] = $phpMussel['ScriptIdent'];
        $phpMussel['TemplateData']['favicon'] = $phpMussel['favicon'];
        $phpMussel['TemplateData']['xmlLang'] = $phpMussel['Config']['general']['lang'];

        /** Determine which template file to use, if this hasn't already been determined. */
        if (!isset($phpMussel['memCache']['template_file'])) {
            $phpMussel['memCache']['template_file'] = !$phpMussel['Config']['template_data']['css_url'] ?
                'template_' . $phpMussel['Config']['template_data']['theme'] . '.html' : 'template_custom.html';
        }

        /** Fallback for themes without default template files. */
        if (
            $phpMussel['Config']['template_data']['theme'] !== 'default' &&
            !$phpMussel['Config']['template_data']['css_url'] &&
            !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['template_file'])
        ) {
            $phpMussel['memCache']['template_file'] = 'template_default.html';
        }

        /** Log "scan_kills" data. */
        if ($phpMussel['Config']['general']['scan_kills'] && !empty($phpMussel['killdata'])) {
            $phpMussel['memCache']['handle'] = array(
                'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills'])
            );
            $phpMussel['memCache']['handle']['WriteMode'] = (
                !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File']) || (
                    $phpMussel['Config']['general']['truncate'] > 0 &&
                    filesize($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
                )
            ) ? 'w' : 'a';
            $phpMussel['memCache']['handle']['Data'] =
                !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File']) ? $phpMussel['safety'] . "\n" : '';
            $phpMussel['memCache']['handle']['Data'] .=
                'DATE: ' . $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['timeFormat']) .
                "\nIP ADDRESS: " . $_SERVER[$phpMussel['Config']['general']['ipaddr']] .
                "\n== SCAN RESULTS / WHY FLAGGED ==\n" .
                $phpMussel['whyflagged'] .
                "\n== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==\n" .
                $phpMussel['killdata'];
            if ($phpMussel['PEData']) {
                $phpMussel['memCache']['handle']['Data'] .=
                    "== PE SECTIONAL SIGNATURES RECONSTRUCTION (SECTION-SIZE:SECTION-HASH:FILE-NAME--SECTION-NAME) ==\n" .
                    $phpMussel['PEData'];
            }
            $phpMussel['memCache']['handle']['Data'] .= "\n";
            $phpMussel['memCache']['handle']['Stream'] =
                fopen($phpMussel['Vault'] . $phpMussel['memCache']['handle']['File'], $phpMussel['memCache']['handle']['WriteMode']);
            fwrite($phpMussel['memCache']['handle']['Stream'], $phpMussel['memCache']['handle']['Data']);
            fclose($phpMussel['memCache']['handle']['Stream']);
            $phpMussel['memCache']['handle'] = '';
        }

        /** Fallback to use if the HTML template file is missing. */
        if (!file_exists($phpMussel['Vault'] . $phpMussel['memCache']['template_file'])) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['lang']['denied'] . ' ' . $phpMussel['TemplateData']['detected']);
        }

        /** Send a 403 FORBIDDEN status code to the client if "forbid_on_block" is enabled. */
        if ($phpMussel['Config']['general']['forbid_on_block']) {
            header('HTTP/1.0 403 Forbidden');
            header('HTTP/1.1 403 Forbidden');
            header('Status: 403 Forbidden');
        }

        /** Generate HTML output. */
        $phpMussel['HTML'] = $phpMussel['ParseVars'](
            $phpMussel['TemplateData'],
            $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['memCache']['template_file'], 0, true)
        );

        /** Plugin hook: "before_html_out". */
        if (!empty($phpMussel['MusselPlugins']['hookcounts']['before_html_out'])) {
            reset($phpMussel['MusselPlugins']['hooks']['before_html_out']);
            foreach ($phpMussel['MusselPlugins']['hooks']['before_html_out'] as $HookID => $HookVal) {
                if (isset($GLOBALS[$HookID]) && is_object($GLOBALS[$HookID])) {
                    $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'closure';
                } elseif (function_exists($HookID)) {
                    $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'function';
                } else {
                    continue;
                }
                $phpMussel['Arrayify']($phpMussel['MusselPlugins']['hooks']['before_html_out'][$HookID]);
                reset($phpMussel['MusselPlugins']['hooks']['before_html_out'][$HookID]);
                $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
                foreach ($phpMussel['MusselPlugins']['hooks']['before_html_out'][$HookID] as $x => $xv) {
                    if ($x) {
                        $phpMussel['MusselPlugins']['tempdata']['varsfeed'][] = isset($$x) ? $$x : $x;
                    }
                }
                if ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'closure') {
                    $x = $GLOBALS[$HookID]($phpMussel['MusselPlugins']['tempdata']['varsfeed']);
                } elseif ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'function') {
                    $x = call_user_func($HookID, $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
                }
                if (is_array($x)) {
                    $phpMussel['MusselPlugins']['tempdata']['out'] = $x;
                    foreach ($phpMussel['MusselPlugins']['tempdata']['out'] as $x => $xv) {
                        if ($x && $xv) {
                            $$x = $xv;
                        }
                    }
                }
            }
            $phpMussel['MusselPlugins']['tempdata'] = '';
        }

        /** Handle webfonts. */
        if (empty($phpMussel['Config']['general']['disable_webfonts'])) {
            $phpMussel['HTML'] = str_replace(array('<!-- WebFont Begin -->', '<!-- WebFont End -->'), '', $phpMussel['HTML']);
        } else {
            $phpMussel['WebFontPos'] = array(
                'Begin' => strpos($phpMussel['HTML'], '<!-- WebFont Begin -->'),
                'End' => strpos($phpMussel['HTML'], '<!-- WebFont End -->')
            );
            $phpMussel['HTML'] =
                substr($phpMussel['HTML'], 0, $phpMussel['WebFontPos']['Begin']) . substr($phpMussel['HTML'], $phpMussel['WebFontPos']['End'] + 20);
            unset($phpMussel['WebFontPos']);
        }

        /** Send HTML output and the kill the script. */
        die($phpMussel['HTML']);

    }

}

/** Exit the upload handler cleanly. */
unset($phpMussel['upload']);
