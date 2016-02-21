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
 * This file: phpMussel upload handler (last modified: 2016.02.18).
 *
 * @package Maikuolan/phpMussel
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
        phpMusselCacheGet('HashCache') :
        array();

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
                if (!($phpMussel['time'] > $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']][1])) {
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
    $phpMussel['memCache']['start_time'] = time();

    /** Create an array for normalising the $_FILES data. */
    $phpMussel['upload']['FilesData'] = array();

    /** Generate "HONEYPOT EVENT" header (if "honeypot_mode" is enabled). */
    if ($phpMussel['Config']['general']['honeypot_mode']) {
        $phpMussel['memCache']['handle'] = array();
        $phpMussel['memCache']['handle']['qdata'] =
            "== HONEYPOT EVENT ==\n DATE: " .
            date('r', $phpMussel['memCache']['start_time']) .
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
                        phpMusselFile($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    $phpMussel['memCache']['handle']['len'] = strlen($phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['crc'] = @hash('crc32b', $phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['qfile'] =
                        $phpMussel['time'] . '-' .
                        md5(
                            $phpMussel['Config']['general']['quarantine_key'] .
                            $phpMussel['memCache']['handle']['crc'] .
                            $phpMussel['time']
                        );
                    if (
                        $phpMussel['memCache']['handle']['len'] > 0 &&
                        $phpMussel['memCache']['handle']['len'] < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)
                    ) {
                        phpMusselQ(
                            $phpMussel['memCache']['handle']['odata'],
                            $phpMussel['Config']['general']['quarantine_key'],
                            $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                            $phpMussel['memCache']['handle']['qfile']
                        );
                    }
                    if ($phpMussel['Config']['general']['delete_on_sight']) {
                        @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
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
                        "\nQUARANTINED AS: '/vault/quarantine/" .
                        $phpMussel['memCache']['handle']['qfile'] .
                        ".qfu'\n";
                }

                /** Process this block if the number of files being uploaded exceeds "max_uploads". */
                if (
                    $phpMussel['upload']['count'] > $phpMussel['Config']['files']['max_uploads'] &&
                    $phpMussel['Config']['files']['max_uploads'] >=1
                ) {
                    $phpMussel['killdata'] .=
                        '-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:' .
                        $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ':' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['upload_limit_exceeded'] .
                        ' (' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                        !$phpMussel['Config']['general']['honeypot_mode']
                    ) {
                        @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    next($_FILES);
                    continue;
                }

                /** Execute the scan! */
                $r = phpMussel(
                    $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                    true,
                    true,
                    0,
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                );

            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 1) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-1---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_1'];
                if (
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                }
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 2) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-2---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_2'];
                if (
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                }
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 3) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-3---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_3'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 4) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-4---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_4'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 6) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-6---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_6'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 7) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-7---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_7'];
            } elseif ($phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']] === 8) {
                $phpMussel['killdata'] .=
                    '---------UPLOAD-ERROR-8---------:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['upload_error_8'];
            } elseif (!is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['killdata'] .=
                    'UNAUTHORISED-FILE-UPLOAD-NO-HASH:' .
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ':' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    "\n";
                $phpMussel['whyflagged'] .=
                    $phpMussel['Config']['lang']['scan_unauthorised_upload'] .
                    ' (' .
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                    ')' .
                    $phpMussel['Config']['lang']['_exclamation'];
            } elseif (
                !$phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] ||
                !$phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
            ) {
                $phpMussel['killdata'] .= "-UNAUTHORISED-UPLOAD-MISCONFIG-:?:?\n";
                $phpMussel['whyflagged'] .= $phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'];
            } else {

                /** Honeypot code. */
                if (
                    $phpMussel['Config']['general']['honeypot_mode'] &&
                    $phpMussel['Config']['general']['quarantine_key']
                ) {
                    $phpMussel['memCache']['handle']['odata'] =
                        phpMusselFile($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    $phpMussel['memCache']['handle']['len'] =
                        strlen($phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['crc'] =
                        @hash('crc32b',$phpMussel['memCache']['handle']['odata']);
                    $phpMussel['memCache']['handle']['qfile'] =
                        $phpMussel['time'] .
                        '-' .
                        md5(
                            $phpMussel['Config']['general']['quarantine_key'] .
                            $phpMussel['memCache']['handle']['crc'] .
                            $phpMussel['time']
                        );
                    if (
                        $phpMussel['memCache']['handle']['len'] > 0 &&
                        $phpMussel['memCache']['handle']['len'] < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)
                    ) {
                        phpMusselQ(
                            $phpMussel['memCache']['handle']['odata'],
                            $phpMussel['Config']['general']['quarantine_key'],
                            $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                            $phpMussel['memCache']['handle']['qfile']
                        );
                    }
                    if ($phpMussel['Config']['general']['delete_on_sight']) {
                        @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
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
                        "\nQUARANTINED AS: '/vault/quarantine/" .
                        $phpMussel['memCache']['handle']['qfile'] .
                        ".qfu'\n";
                }

                /** Process this block if the number of files being uploaded exceeds "max_uploads". */
                if (
                    $phpMussel['upload']['count'] > $phpMussel['Config']['files']['max_uploads'] &&
                    $phpMussel['Config']['files']['max_uploads'] >=1
                ) {
                    $phpMussel['killdata'] .=
                        '-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:' .
                        $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ':' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['upload_limit_exceeded'] .
                        ' (' .
                        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']] .
                        ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    if (
                        $phpMussel['Config']['general']['delete_on_sight'] &&
                        !$phpMussel['Config']['general']['honeypot_mode']
                    ) {
                        @unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                    }
                    next($_FILES);
                    continue;
                }

                /** Execute the scan! */
                $r = phpMussel(
                    $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                    true,
                    true,
                    0,
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                );

            }
        }
        next($_FILES);

    }

    if ($phpMussel['Config']['general']['honeypot_mode'] && $phpMussel['Config']['general']['scan_kills']) {
        if (!file_exists($phpMussel['vault'] . $phpMussel['Config']['general']['scan_kills'])) {
            $phpMussel['memCache']['handle']['qdata'] =
                $phpMussel['safety'] . "\n" . $phpMussel['memCache']['handle']['qdata'];
        }
        $phpMussel['memCache']['handle']['logfile'] =
            fopen($phpMussel['vault'] . $phpMussel['Config']['general']['scan_kills'], 'a');
        fwrite($phpMussel['memCache']['handle']['logfile'], $phpMussel['memCache']['handle']['qdata']);
        fclose($phpMussel['memCache']['handle']['logfile']);
        $phpMussel['memCache']['handle'] = '';
    }

    /** Update the hash cache. */
    if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0) {

        /** Reset the hash cache caret. */
        reset($phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Count'] = count($phpMussel['HashCache']['Data']);
        for (
            $phpMussel['HashCache']['Index'] = 0;
            $phpMussel['HashCache']['Index'] < $phpMussel['HashCache']['Count'];
            $phpMussel['HashCache']['Index']++
        ) {
            $phpMussel['HashCache']['Key'] = key($phpMussel['HashCache']['Data']);
            if (is_array($phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']])) {
                $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']]
                    = implode(':', $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']]).';';
            }
            next($phpMussel['HashCache']['Data']);
        }
        $phpMussel['HashCache']['Data'] = implode('', $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Data'] = phpMusselCacheSet(
            'HashCache',
            $phpMussel['time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
            $phpMussel['HashCache']['Data']
        );
        unset($phpMussel['HashCache']);

    }

    /** File upload scan finish time. */
    $phpMussel['memCache']['end_time'] = time();

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
        $phpMussel['memCache']['handle'] = array();
        $phpMussel['memCache']['handle']['s'] = serialize(array(
            'start_time' => $phpMussel['memCache']['start_time'],
            'end_time' => $phpMussel['memCache']['end_time'],
            'origin' => $_SERVER[$phpMussel['Config']['general']['ipaddr']],
            'objects_scanned' => $phpMussel['memCache']['objects_scanned'],
            'detections_count' => $phpMussel['memCache']['detections_count'],
            'scan_errors' => $phpMussel['memCache']['scan_errors'],
            'detections' => $phpMussel['whyflagged']
        )) . "\n";
        $phpMussel['memCache']['handle']['f'] =
            fopen($phpMussel['vault'] . $phpMussel['Config']['general']['scan_log_serialized'], 'a');
        fwrite($phpMussel['memCache']['handle']['f'], $phpMussel['memCache']['handle']['s']);
        fclose($phpMussel['memCache']['handle']['f']);
        $phpMussel['memCache']['handle'] = '';
    }

    /** Reset the $_FILES caret. */
    reset($_FILES);

    /** Begin processing file upload detections. */
    if (!empty($phpMussel['whyflagged'])) {

        $phpMussel['TemplateData'] = $phpMussel['Config']['lang'] + $phpMussel['Config']['template_data'];
        $phpMussel['TemplateData']['detected'] = $phpMussel['whyflagged'];
        $phpMussel['TemplateData']['phpmusselversion'] = $phpMussel['ScriptIdent'];
        $phpMussel['TemplateData']['xmlLang'] = $phpMussel['Config']['general']['lang'];
        $phpMussel['memCache']['template_file'] =
            (!$phpMussel['Config']['template_data']['css_url']) ?
            'template.html' :
            'template_custom.html';

        /** Log "scan_kills" data. */
        if ($phpMussel['Config']['general']['scan_kills'] && !empty($phpMussel['killdata'])) {
            $phpMussel['memCache']['handle'] = array();
            $phpMussel['memCache']['handle']['d'] =
                (!file_exists($phpMussel['vault'] . $phpMussel['Config']['general']['scan_kills'])) ?
                $phpMussel['safety'] . "\n" :
                '';
            $phpMussel['memCache']['handle']['d'] .=
                'DATE: ' . date('r') . "\nIP ADDRESS: " .
                $_SERVER[$phpMussel['Config']['general']['ipaddr']] .
                "\n== SCAN RESULTS / WHY FLAGGED ==\n" .
                $phpMussel['whyflagged'] .
                "\n== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==\n" .
                $phpMussel['killdata'];
            if ($phpMussel['PEData']) {
                $phpMussel['memCache']['handle']['d'] .=
                    "== PE SECTIONAL SIGNATURES RECONSTRUCTION (SECTION-SIZE:SECTION-HASH:FILE-NAME--SECTION-NAME) ==\n" .
                    $phpMussel['PEData'];
            }
            $phpMussel['memCache']['handle']['d'] .= "\n";
            $phpMussel['memCache']['handle']['f'] =
                fopen($phpMussel['vault'] . $phpMussel['Config']['general']['scan_kills'], 'a');
            fwrite($phpMussel['memCache']['handle']['f'], $phpMussel['memCache']['handle']['d']);
            fclose($phpMussel['memCache']['handle']['f']);
            $phpMussel['memCache']['handle'] = '';
        }

        /** Fallback to use if the HTML template file is missing. */
        if (!file_exists($phpMussel['vault'] . $phpMussel['memCache']['template_file'])) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['Config']['lang']['denied'] . ' ' . $phpMussel['TemplateData']['detected']);
        }

        /** Send a 403 FORBIDDEN status code to the client if "forbid_on_block" is enabled. */
        if ($phpMussel['Config']['general']['forbid_on_block']) {
            header('HTTP/1.0 403 Forbidden');
            header('HTTP/1.1 403 Forbidden');
            header('Status: 403 Forbidden');
        }

        /** Generate HTML output. */
        $html = phpMusselV(
            $phpMussel['TemplateData'],
            phpMusselFile($phpMussel['vault'] . $phpMussel['memCache']['template_file'],0,true)
        );

        /** Plugin hook: "before_html_out". */
        if (
            isset($phpMussel['MusselPlugins']['hookcounts']['before_html_out']) &&
            $phpMussel['MusselPlugins']['hookcounts']['before_html_out'] > 0
        ) {
            reset($phpMussel['MusselPlugins']['hooks']['before_html_out']);
            for (
                $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['before_html_out'];
                $phpMussel['MusselPlugins']['tempdata']['i']++
            ) {
                $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['before_html_out']);
                if (!is_array($phpMussel['MusselPlugins']['hooks']['before_html_out'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                    $phpMussel['MusselPlugins']['hooks']['before_html_out'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                        array($phpMussel['MusselPlugins']['hooks']['before_html_out'][$phpMussel['MusselPlugins']['tempdata']['k']]);
                }
                $phpMussel['MusselPlugins']['tempdata']['kc'] =
                    count($phpMussel['MusselPlugins']['hooks']['before_html_out'][$phpMussel['MusselPlugins']['tempdata']['k']]);
                $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = $phpMussel['MusselPlugins']['hooks']['before_html_out'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                    if ($x) {
                        $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                            (isset($$x)) ? $$x : $x;
                    }
                }
                $phpMussel['MusselPlugins']['tempdata']['out'] =
                    call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
                if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                    $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                    for (
                        $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                        $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                        $phpMussel['MusselPlugins']['tempdata']['ki']++
                    ) {
                        $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                        $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                        next($phpMussel['MusselPlugins']['tempdata']['out']);
                    }
                }
                next($phpMussel['MusselPlugins']['hooks']['before_html_out']);
            }
            $phpMussel['MusselPlugins']['tempdata'] = array();
        }

        /** Send HTML output and the kill the script. */
        die($html);

    }

}

/** Exit the upload handler cleanly. */
unset($phpMussel['upload']);
