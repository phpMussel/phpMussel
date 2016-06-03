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
 * This file: Controls handler (last modified: 2016.06.03).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Create an array for our working data. */
$phpMussel['controls'] = array();

/** Fetch and parse query components. */
parse_str($_SERVER['QUERY_STRING'], $phpMussel['controls']['query']);

/** Check for and try to fetch any commands submitted by the client. */
$phpMussel['controls']['command'] =
    (!empty($_POST['phpmussel'])) ? $_POST['phpmussel'] : (
        (!empty($phpMussel['controls']['query']['phpmussel'])) ? $phpMussel['controls']['query']['phpmussel'] : ''
    );

/** Check for and try to fetch any command password submitted by the client. */
$phpMussel['controls']['pword'] =
    (!empty($_POST['pword'])) ? $_POST['pword'] : (
        (!empty($phpMussel['controls']['query']['pword'])) ? $phpMussel['controls']['query']['pword'] : ''
    );

/** Check for and try to fetch any logs password submitted by the client. */
$phpMussel['controls']['logspword'] =
    (!empty($_POST['logspword'])) ? $_POST['logspword'] : (
        (!empty($phpMussel['controls']['query']['logspword'])) ? $phpMussel['controls']['query']['logspword'] : ''
    );

/** Check for and try to fetch any optional parameters submitted by the client. */
$phpMussel['controls']['musselvar'] =
    (!empty($_POST['musselvar'])) ? $_POST['musselvar'] : (
        (!empty($phpMussel['controls']['query']['musselvar'])) ? $phpMussel['controls']['query']['musselvar'] : ''
    );

/** Commands requiring the logs password. */
if (
    !empty($phpMussel['Config']['general']['logs_password']) &&
    !empty($phpMussel['controls']['command']) &&
    !empty($phpMussel['controls']['logspword'])
) {

    /** If the logs password is incorrect, kill the script. */
    if ($phpMussel['controls']['logspword'] !== $phpMussel['Config']['general']['logs_password']) {
        header('Content-Type: text/plain');
        die('[phpMussel] ' . $phpMussel['Config']['lang']['wrong_password']);
    }

    /** Plugin hook: "browser_log_commands". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['browser_log_commands']) &&
        $phpMussel['MusselPlugins']['hookcounts']['browser_log_commands'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['browser_log_commands']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['browser_log_commands'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $HookID = key($phpMussel['MusselPlugins']['hooks']['during_scan']);
            if (isset($GLOBALS[$HookID]) && is_object($GLOBALS[$HookID])) {
                $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'closure';
            } elseif (function_exists($HookID)) {
                $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'function';
            } else {
                continue;
            }
            if (!is_array($phpMussel['MusselPlugins']['hooks']['browser_log_commands'][$HookID])) {
                $phpMussel['MusselPlugins']['hooks']['browser_log_commands'][$HookID] =
                    array($phpMussel['MusselPlugins']['hooks']['browser_log_commands'][$HookID]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['browser_log_commands'][$HookID]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['browser_log_commands'][$HookID][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][] = (isset($$x)) ? $$x : $x;
                }
            }
            if ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'closure') {
                $x = $GLOBALS[$HookID]($phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            } elseif ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'function') {
                $x = call_user_func($HookID, $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            }
            if (is_array($x)) {
                $phpMussel['MusselPlugins']['tempdata']['out'] = $x;
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($x);
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
            next($phpMussel['MusselPlugins']['hooks']['browser_log_commands']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    /** Command results presented using plain-text (this may change in the future). */
    header('Content-Type: text/plain');

    /** Print the scan_log file. */
    if ($phpMussel['controls']['command'] == 'scan_log') {
        $phpMussel['ReturnLogfile']('scan_log');
        die;
    }

    /** Print the scan_log_serialized file. */
    if ($phpMussel['controls']['command'] == 'scan_log_serialized') {
        $phpMussel['ReturnLogfile']('scan_log_serialized');
        die;
    }

    /** Print the scan_kills file. */
    if ($phpMussel['controls']['command'] == 'scan_kills') {
        $phpMussel['ReturnLogfile']('scan_kills');
        die;
    }

    /** Engages the controls lock, disabling all browser-based controls. */
    if ($phpMussel['controls']['command'] == 'controls_lockout') {
        $phpMussel['controls']['handle'] = fopen($phpMussel['vault'] . 'controls.lck', 'a');
        fwrite($phpMussel['controls']['handle'], '');
        fclose($phpMussel['controls']['handle']);
        die('[phpMussel] ' . $phpMussel['Config']['lang']['controls_lockout']);
    }

    /** Do this if we don't understand the command from the client. */
    die('[phpMussel] ' . $phpMussel['Config']['lang']['bad_command']);

}

if (
    !empty($phpMussel['Config']['general']['script_password']) &&
    !empty($phpMussel['controls']['command']) &&
    !empty($phpMussel['controls']['pword'])
) {

    /** If the command password is incorrect, kill the script. */
    if ($phpMussel['controls']['pword'] !== $phpMussel['Config']['general']['script_password']) {
        header('Content-Type: text/plain');
        die('[phpMussel] ' . $phpMussel['Config']['lang']['wrong_password']);
    }

    /** Plugin hook: "browser_commands". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['browser_commands']) &&
        $phpMussel['MusselPlugins']['hookcounts']['browser_commands'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['browser_commands']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['browser_commands'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $HookID = key($phpMussel['MusselPlugins']['hooks']['during_scan']);
            if (isset($GLOBALS[$HookID]) && is_object($GLOBALS[$HookID])) {
                $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'closure';
            } elseif (function_exists($HookID)) {
                $phpMussel['MusselPlugins']['tempdata']['hookType'] = 'function';
            } else {
                continue;
            }
            if (!is_array($phpMussel['MusselPlugins']['hooks']['browser_commands'][$HookID])) {
                $phpMussel['MusselPlugins']['hooks']['browser_commands'][$HookID] =
                    array($phpMussel['MusselPlugins']['hooks']['browser_commands'][$HookID]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['browser_commands'][$HookID]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['browser_commands'][$HookID][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][] = (isset($$x)) ? $$x : $x;
                }
            }
            if ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'closure') {
                $x = $GLOBALS[$HookID]($phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            } elseif ($phpMussel['MusselPlugins']['tempdata']['hookType'] === 'function') {
                $x = call_user_func($HookID, $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            }
            if (is_array($x)) {
                $phpMussel['MusselPlugins']['tempdata']['out'] = $x;
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($x);
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
            next($phpMussel['MusselPlugins']['hooks']['browser_commands']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    /** Command results presented using plain-text (this may change in the future). */
    header('Content-Type: text/plain');

    /** Engages the disable lock, effectively disabling phpMussel. */
    if ($phpMussel['controls']['command'] == 'disable') {
        if (!$phpMussel['disable_lock']) {
            $phpMussel['disable_lock'] = fopen($phpMussel['vault'] . 'disable.lck', 'a');
            fwrite($phpMussel['disable_lock'], '');
            fclose($phpMussel['disable_lock']);
            die('[phpMussel] ' . $phpMussel['Config']['lang']['phpmussel_disabled']);
        }
        die('[phpMussel] ' . $phpMussel['Config']['lang']['phpmussel_disabled_already']);
    }

    /** Disengages the disable lock, reenabling phpMussel after having been disabled. */
    if ($phpMussel['controls']['command'] == 'enable') {
        if (!$phpMussel['disable_lock']) {
            die('[phpMussel] ' . $phpMussel['Config']['lang']['phpmussel_enabled_already']);
        }
        $phpMussel['disable_lock'] = @unlink($phpMussel['vault'] . 'disable.lck');
        die('[phpMussel] ' . $phpMussel['Config']['lang']['phpmussel_enabled']);
    }

    /** Adds entries to the greylist. */
    if ($phpMussel['controls']['command'] == 'greylist') {
        if (!empty($phpMussel['controls']['musselvar'])) {
            $phpMussel['controls']['greylist'] = (!file_exists($phpMussel['vault'] . 'greylist.csv')) ? ',' : '';
            $phpMussel['controls']['greylist'] .= $phpMussel['controls']['musselvar'] . ',';
            $phpMussel['controls']['handle'] = fopen($phpMussel['vault'] . 'greylist.csv', 'a');
            fwrite($phpMussel['controls']['handle'], $phpMussel['controls']['greylist']);
            fclose($phpMussel['controls']['handle']);
            die('[phpMussel]' . $phpMussel['Config']['lang']['greylist_updated']);
        }
        die('[phpMussel]' . $phpMussel['Config']['lang']['greylist_not_updated']);
    }

    /** Clears the greylist. */
    if ($phpMussel['controls']['command'] == 'greylist_clear') {
        $phpMussel['controls']['handle'] = fopen($phpMussel['vault'] . 'greylist.csv', 'a');
        ftruncate($phpMussel['controls']['handle'], 0);
        fwrite($phpMussel['controls']['handle'], ',');
        fclose($phpMussel['controls']['handle']);
        die('[phpMussel]' . $phpMussel['Config']['lang']['greylist_cleared']);
    }

    /** Shows the greylist. */
    if ($phpMussel['controls']['command'] == 'greylist_show') {
        if (!file_exists($phpMussel['vault'] . 'greylist.csv')) {
            die(
                '[phpMussel] greylist.csv ' .
                $phpMussel['Config']['lang']['x_does_not_exist'] .
                $phpMussel['Config']['lang']['_exclamation_final']
            );
        }
        echo
            $phpMussel['Config']['lang']['cli_ln1'] .
            $phpMussel['Config']['lang']['cli_ln2'] .
            "greylist.csv:\n\n" .
            implode("\n", explode(',', implode(file($phpMussel['vault'] . 'greylist.csv'))));
        die;
    }

    /** Engages the controls lock, disabling all browser-based controls. */
    if ($phpMussel['controls']['command'] == 'controls_lockout') {
        $phpMussel['controls']['handle'] = fopen($phpMussel['vault'] . 'controls.lck', 'a');
        fwrite($phpMussel['controls']['handle'], '');
        fclose($phpMussel['controls']['handle']);
        die('[phpMussel] ' . $phpMussel['Config']['lang']['controls_lockout']);
    }

    /** Do this if we don't understand the command from the client. */
    die('[phpMussel] ' . $phpMussel['Config']['lang']['bad_command']);

}

/** Exit the controls handler cleanly. */
unset($phpMussel['controls']);
