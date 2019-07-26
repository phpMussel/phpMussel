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
 * This file: Configuration handler (last modified: 2019.07.24).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** phpMussel version number (SemVer). */
$phpMussel['ScriptVersion'] = '1.11.0';

/** phpMussel version identifier (complete notation). */
$phpMussel['ScriptIdent'] = 'phpMussel v' . $phpMussel['ScriptVersion'];

/** phpMussel User Agent (for external requests). */
$phpMussel['ScriptUA'] = $phpMussel['ScriptIdent'] . ' (https://phpmussel.github.io/)';

/** Default timeout (for external requests). */
$phpMussel['Timeout'] = 12;

/** Determine PHP path. */
$phpMussel['Mussel_PHP'] = defined('PHP_BINARY') ? PHP_BINARY : '';

/** Fetch domain segment of HTTP_HOST (needed for writing cookies safely). */
$phpMussel['HTTP_HOST'] = empty($_SERVER['HTTP_HOST']) ? '' : (
    strpos($_SERVER['HTTP_HOST'], ':') === false ? $_SERVER['HTTP_HOST'] : substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], ':'))
);

/** phpMussel favicon. */
$phpMussel['favicon'] =
    'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABmJLR0QA/wD/AP+gvaeTAAA' .
    'ACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH4AoZABIBssLx0wAAAs9JREFUOMt9kl1IU2' .
    'EYx//vOTtnLJinydTY2BKZadlNEnTKPjCo7EOlujPow7JCkT6oiz5uK4KI9C7NbSZWZJCld' .
    'aNZ3kj0MSFormaFO27WINbGcaszz3m7GFublc/d+z6//5/nz/MQ/KeqqzcfSibnjieTSkEi' .
    'kZAikUh/Q8O+jqtXr8xmc+Rf4jVrxFZCSDshqTYhBIqiIBgMomJlxcrhoaH3aZaZLxZFcfm' .
    '9e3fbS0pKAAAsy8JoNILjODgcDnzw+V5n838ZCMJiS3FxMcxmMzRNQ1PTEQwODsBkMkFRfq' .
    'GsrNxQU7P9WE6EU6fPnGAYZjYcDnt7brvH1q5d56eUOggh4HkeRUVFkCQJgiBgx46dcLm62' .
    'sbHx08CgM5qsRorKytv2Gw2gBDU19fD7/drL54/RywWhaIokCQJAGCxWGC3LwXDsL5MBLGq' .
    'SsjLy4PJZII5Px+lpaWora1lVFXNiaaqKjZu3IQ7d3pRWFj47OChxpSBntdzLMumIE0DpRS' .
    'yLEPTtBwDc0EBWIbF1NSXV4SQp26XM2Ugy7FfqqqB5/kMLMsyYrFo5k0pRc227eh70If16z' .
    'fsmlNVLhPh8aNH4VgsCo7TgVIKAAgEAjMsk7ugZFLB9HTg5N49e452dnYks9c4FwwGZ5DSg' .
    'ud5hEKha7xefz8N6XQ6TE764fF42gyLDC2fP31yX7585c8dyLJ8SdM0MAyD0dFRXLxw7rog' .
    'CEvSE/F6HpIk/QSAiQnf6mg05jp//lzqDhobD0OlEERR/AFKNY/H4/B//LjbarU+/vp1pio' .
    'en3WzLAe73SbH4/GH/f0P92dH0zmdXQAQ5XS65bc6b/oAYMuWreXLljke9Pb2dNfV7X4biX' .
    'xvlmX5zbdweAWllCWEqFigiNfr9Q0MPDkAAGNjLzMNl8s12dzSumohMbq7e86OjIw4HY5Sw' .
    '/ze0PDwu1AolACwKP33G4ncJFWmwHSnAAAAAElFTkSuQmCC';

/** Checks whether the phpMussel configuration file is readable. */
if (!is_readable($phpMussel['Vault'] . 'config.ini')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Can\'t read the configuration file! Please reconfigure phpMussel.');
}

/** Checks whether the phpMussel configuration defaults file is readable. */
if (!is_readable($phpMussel['Vault'] . 'config.yaml')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Can\'t read the configuration defaults file! Please reconfigure phpMussel.');
}

/** Attempts to parse the phpMussel configuration file. */
$phpMussel['Config'] = parse_ini_file($phpMussel['Vault'] . 'config.ini', true);

/** Kills the script if parsing the configuration file fails. */
if ($phpMussel['Config'] === false) {
    header('Content-Type: text/plain');
    die('[phpMussel] Configuration file is corrupt! Please reconfigure phpMussel.');
}

/** Checks for the existence of HTTP_HOST configuration overrides file. */
if (
    !empty($_SERVER['HTTP_HOST']) &&
    ($phpMussel['Domain'] = preg_replace('/^www\./', '', strtolower($_SERVER['HTTP_HOST']))) &&
    !preg_match('/[^.\da-z-]/', $phpMussel['Domain']) &&
    is_readable($phpMussel['Vault'] . $phpMussel['Domain'] . '.config.ini')
) {
    /** Attempts to parse the configuration overrides file. */
    if ($phpMussel['Overrides'] = parse_ini_file($phpMussel['Vault'] . $phpMussel['Domain'] . '.config.ini', true)) {
        array_walk($phpMussel['Overrides'], function ($Keys, $Category) use (&$phpMussel) {
            foreach ($Keys as $Directive => $Value) {
                $phpMussel['Config'][$Category][$Directive] = $Value;
            }
        });
        $phpMussel['Overrides'] = true;
    }
}

/** Kills the script if parsing the configuration overrides file fails. */
if (isset($phpMussel['Overrides']) && $phpMussel['Overrides'] === false) {
    header('Content-Type: text/plain');
    die('[phpMussel] Configuration overrides file is corrupt! Can\'t continue until this is resolved.');
}

/** Attempts to parse the phpMussel configuration defaults file. */
$phpMussel['YAML']->process($phpMussel['ReadFile']($phpMussel['Vault'] . 'config.yaml'), $phpMussel['Config']);

/** Kills the script if parsing the configuration defaults file fails. */
if (empty($phpMussel['Config']['Config Defaults'])) {
    header('Content-Type: text/plain');
    die('[phpMussel] Configuration defaults file is corrupt! Please reinstall phpMussel.');
}

/** Perform fallbacks and autotyping for missing configuration directives. */
$phpMussel['Fallback']($phpMussel['Config']['Config Defaults'], $phpMussel['Config']);

/** Failsafe for weird ipaddr configuration. */
$phpMussel['IPAddr'] = (
    $phpMussel['Config']['general']['ipaddr'] !== 'REMOTE_ADDR' && empty($_SERVER[$phpMussel['Config']['general']['ipaddr']])
) ? 'REMOTE_ADDR' : $phpMussel['Config']['general']['ipaddr'];

/** Ensure we have an IP address variable to work with. */
if (!isset($_SERVER[$phpMussel['IPAddr']])) {
    $_SERVER[$phpMussel['IPAddr']] = '';
}

/** Adjusted present time. */
$phpMussel['Time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

/** Set timezone. */
if (!empty($phpMussel['Config']['general']['timezone']) && $phpMussel['Config']['general']['timezone'] !== 'SYSTEM') {
    date_default_timezone_set($phpMussel['Config']['general']['timezone']);
}

/** Determine whether operating in CLI-mode. */
$phpMussel['Mussel_sapi'] = !defined('Via-Travis') && (
    empty($_SERVER['REQUEST_METHOD']) ||
    substr(php_sapi_name(), 0, 3) === 'cli' || (
        empty($_SERVER[$phpMussel['IPAddr']]) &&
        empty($_SERVER['HTTP_USER_AGENT']) &&
        !empty($_SERVER['argc']) &&
        is_numeric($_SERVER['argc']) &&
        $_SERVER['argc'] > 0
    )
);

/** Process the request query and query variables (if any exist). */
if (!empty($_SERVER['QUERY_STRING'])) {
    $phpMussel['Query'] = $_SERVER['QUERY_STRING'];
    parse_str($_SERVER['QUERY_STRING'], $phpMussel['QueryVars']);
} else {
    $phpMussel['Query'] = '';
    $phpMussel['QueryVars'] = [];
}

/** Set default hashing algorithm. */
$phpMussel['DefaultAlgo'] = (
    !empty($phpMussel['Config']['general']['default_algo']) && defined($phpMussel['Config']['general']['default_algo'])
) ? constant($phpMussel['Config']['general']['default_algo']) : 1;

/** Used just for the current, specific request instance. */
$phpMussel['InstanceCache'] = [];
