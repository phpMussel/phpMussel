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
 * This file: Upload handler (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Sets default error handler for the upload handler. */
set_error_handler($phpMussel['ErrorHandler_1']);

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
    $phpMussel['HashCache'] = [];

    /** Fetch the hash cache (a record of recently scanned files). */
    $phpMussel['HashCache']['Data'] = (
        $phpMussel['upload']['count'] > 0 && $phpMussel['Config']['general']['scan_cache_expiry'] > 0
    ) ? $phpMussel['FetchCache']('HashCache') : '';

    /** Process the hash cache. */
    if (!empty($phpMussel['HashCache']['Data'])) {
        $phpMussel['HashCache']['Data'] = explode(';', $phpMussel['HashCache']['Data']);
        $phpMussel['HashCache']['Build'] = [];
        foreach ($phpMussel['HashCache']['Data'] as &$phpMussel['HashCache']['This']) {
            if (strpos($phpMussel['HashCache']['This'], ':') !== false) {
                $phpMussel['HashCache']['This'] = explode(':', $phpMussel['HashCache']['This'], 4);
                if ($phpMussel['Time'] <= $phpMussel['HashCache']['This'][1]) {
                    $phpMussel['HashCache']['Build'][$phpMussel['HashCache']['This'][0]] =
                        $phpMussel['HashCache']['This'];
                }
            }
        }
        $phpMussel['HashCache']['Data'] = $phpMussel['HashCache']['Build'];
        unset($phpMussel['HashCache']['This'], $phpMussel['HashCache']['Build']);
    }

    /** Reset the $_FILES caret. */
    reset($_FILES);

    /** File upload scan start time. */
    $phpMussel['memCache']['start_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

    /** Create an array for normalising the $_FILES data. */
    $phpMussel['upload']['FilesData'] = [];

    /** Generate "HONEYPOT EVENT" header (if "honeypot_mode" is enabled). */
    if ($phpMussel['Config']['general']['honeypot_mode']) {
        $phpMussel['memCache']['Handle'] = ['qdata' =>
            "== HONEYPOT EVENT ==\nDATE: " . $phpMussel['TimeFormat'](
                $phpMussel['memCache']['start_time'],
                $phpMussel['Config']['general']['timeFormat']
            ) . "\nIP ADDRESS: " . $_SERVER[$phpMussel['Config']['general']['ipaddr']] . "\n"
        ];
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
            $phpMussel['upload']['FilesData']['FileSet'] = [
                'name' => [$_FILES[$phpMussel['upload']['FilesData']['k']]['name']],
                'type' => [$_FILES[$phpMussel['upload']['FilesData']['k']]['type']],
                'tmp_name' => [$_FILES[$phpMussel['upload']['FilesData']['k']]['tmp_name']],
                'error' => [$_FILES[$phpMussel['upload']['FilesData']['k']]['error']],
                'size' => [$_FILES[$phpMussel['upload']['FilesData']['k']]['size']]
            ];
        } else {
            $phpMussel['upload']['FilesData']['FileSet'] =
                $_FILES[$phpMussel['upload']['FilesData']['k']];
        }
        $phpMussel['upload']['FilesData']['FileSet']['c'] = count(
            $phpMussel['upload']['FilesData']['FileSet']['error']
        );

        for (
            $phpMussel['upload']['FilesData']['FileSet']['i'] = 0, $phpMussel['SkipSerial'] = true;
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

            unset($phpMussel['upload']['ThisError']);
            $phpMussel['upload']['ThisError'] = &$phpMussel['upload']['FilesData']['FileSet']['error'][$phpMussel['upload']['FilesData']['FileSet']['i']];

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
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                );
                $phpMussel['whyflagged'] .= (
                    $phpMussel['upload']['ThisError'] === 3 || $phpMussel['upload']['ThisError'] === 4
                ) ? $phpMussel['lang']['upload_error_34'] : $phpMussel['lang']['upload_error_' . $phpMussel['upload']['ThisError']];
                if (
                    ($phpMussel['upload']['ThisError'] === 1 || $phpMussel['upload']['ThisError'] === 2) &&
                    $phpMussel['Config']['general']['delete_on_sight'] &&
                    is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]) &&
                    is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])
                ) {
                    unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]);
                }
                continue;
            }

            /** Protection against upload spoofing. */
            if (!is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']])) {
                $phpMussel['killdata'] .= sprintf(
                    "UNAUTHORISED-FILE-UPLOAD-NO-HASH:%d:%s\n",
                    $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
                );
                $phpMussel['whyflagged'] .= sprintf(
                    '%s (%s)%s',
                    $phpMussel['lang']['scan_unauthorised_upload'],
                    $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['upload']['FilesData']['FileSet']['i']],
                    $phpMussel['lang']['_exclamation']
                );
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
                    $phpMussel['ReadFile-For-Honeypot'](
                        $phpMussel['memCache']['Handle'],
                        $phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['upload']['FilesData']['FileSet']['i']]
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
                if ($phpMussel['upload']['FilesData']['FileSet']['i'] === ($phpMussel['upload']['FilesData']['FileSet']['c'] - 1)) {
                    unset($phpMussel['SkipSerial']);
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

    /** Honeypot code. */
    if (
        $phpMussel['Config']['general']['honeypot_mode'] &&
        $phpMussel['Config']['general']['scan_kills'] &&
        is_array($phpMussel['memCache']['Handle'])
    ) {
        $phpMussel['memCache']['Handle']['File'] = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills']);
        if (!file_exists($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File'])) {
            $phpMussel['memCache']['Handle']['qdata'] =
                $phpMussel['safety'] . "\n\n" . $phpMussel['memCache']['Handle']['qdata'];
        }
        $phpMussel['memCache']['Handle']['Stream'] =
            fopen($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File'], 'a');
        fwrite($phpMussel['memCache']['Handle']['Stream'], $phpMussel['memCache']['Handle']['qdata']);
        fclose($phpMussel['memCache']['Handle']['Stream']);
        $phpMussel['memCache']['Handle'] = '';
    }

    /** Update the hash cache. */
    if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0 && !empty($phpMussel['HashCache']['Data']) && is_array($phpMussel['HashCache']['Data'])) {

        $phpMussel['HashCache']['Data'] = array_map(function ($Item) {
            return is_array($Item) ? implode(':', $Item) . ';' : $Item;
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

    /** Reset the $_FILES caret. */
    reset($_FILES);

    /** Begin processing file upload detections. */
    if ($phpMussel['whyflagged']) {

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
            $phpMussel['memCache']['Handle'] = [
                'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills'])
            ];
            $phpMussel['memCache']['Handle']['WriteMode'] = (
                !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File']) || (
                    $phpMussel['Config']['general']['truncate'] > 0 &&
                    filesize($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
                )
            ) ? 'w' : 'a';
            $phpMussel['memCache']['Handle']['Data'] =
                !file_exists($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File']) ? $phpMussel['safety'] . "\n\n" : '';
            $phpMussel['memCache']['Handle']['Data'] .=
                'DATE: ' . $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['timeFormat']) .
                "\nIP ADDRESS: " . $_SERVER[$phpMussel['Config']['general']['ipaddr']] .
                "\n== SCAN RESULTS / WHY FLAGGED ==\n" .
                $phpMussel['whyflagged'] .
                "\n== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==\n" .
                $phpMussel['killdata'];
            if ($phpMussel['PEData']) {
                $phpMussel['memCache']['Handle']['Data'] .=
                    "== PE SECTIONAL SIGNATURES RECONSTRUCTION (SECTION-SIZE:SECTION-HASH:FILE-NAME--SECTION-NAME) ==\n" .
                    $phpMussel['PEData'];
            }
            $phpMussel['memCache']['Handle']['Data'] .= "\n";
            $phpMussel['memCache']['Handle']['Stream'] =
                fopen($phpMussel['Vault'] . $phpMussel['memCache']['Handle']['File'], $phpMussel['memCache']['Handle']['WriteMode']);
            fwrite($phpMussel['memCache']['Handle']['Stream'], $phpMussel['memCache']['Handle']['Data']);
            fclose($phpMussel['memCache']['Handle']['Stream']);
            $phpMussel['memCache']['Handle'] = '';
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
        $phpMussel['Execute_Hook']('before_html_out');

        /** Handle webfonts. */
        if (empty($phpMussel['Config']['general']['disable_webfonts'])) {
            $phpMussel['HTML'] = str_replace(['<!-- WebFont Begin -->', '<!-- WebFont End -->'], '', $phpMussel['HTML']);
        } else {
            $phpMussel['WebFontPos'] = [
                'Begin' => strpos($phpMussel['HTML'], '<!-- WebFont Begin -->'),
                'End' => strpos($phpMussel['HTML'], '<!-- WebFont End -->')
            ];
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

/** Restores default error handler. */
restore_error_handler();
