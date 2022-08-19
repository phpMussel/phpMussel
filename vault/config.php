<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Configuration handler (last modified: 2022.08.20).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** phpMussel version number (SemVer). */
$phpMussel['ScriptVersion'] = '2.4.3';

/** phpMussel version identifier (complete notation). */
$phpMussel['ScriptIdent'] = 'phpMussel v' . $phpMussel['ScriptVersion'];

/** phpMussel User Agent (for external requests). */
$phpMussel['ScriptUA'] = $phpMussel['ScriptIdent'] . ' (https://phpmussel.github.io/)';

/** Determine PHP path. */
$phpMussel['Mussel_PHP'] = defined('PHP_BINARY') ? PHP_BINARY : '';

/** Fetch domain segment of HTTP_HOST (needed for writing cookies safely). */
$phpMussel['HTTP_HOST'] = empty($_SERVER['HTTP_HOST']) ? '' : (
    strpos($_SERVER['HTTP_HOST'], ':') === false ? $_SERVER['HTTP_HOST'] : substr($_SERVER['HTTP_HOST'], 0, strpos($_SERVER['HTTP_HOST'], ':'))
);

/** Allow post override of HTTP_HOST (assists with proxied front-end pages). */
$phpMussel['HostnameOverride'] = $_POST['hostname'] ?? '';

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
if (!isset($GLOBALS['phpMussel_Config']) && !is_readable($phpMussel['Vault'] . 'config.ini')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Can\'t read the configuration file! Please reconfigure phpMussel.');
}

/** Checks whether the phpMussel configuration defaults file is readable. */
if (!is_readable($phpMussel['Vault'] . 'config.yaml')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Can\'t read the configuration defaults file! Please reconfigure phpMussel.');
}

if (isset($GLOBALS['phpMussel_Config'])) {
    /** Provides a means of running tests with configuration values specific to those tests. */
    $phpMussel['Config'] = $GLOBALS['phpMussel_Config'];
} else {
    /** Attempts to parse the standard phpMussel configuration file. */
    $phpMussel['Config'] = parse_ini_file($phpMussel['Vault'] . 'config.ini', true);
}

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
    /** Attempts to parse the overrides file found (this is configuration specific to the requested domain). */
    if ($phpMussel['Overrides'] = parse_ini_file($phpMussel['Vault'] . $phpMussel['Domain'] . '.config.ini', true)) {
        array_walk($phpMussel['Overrides'], function ($Keys, $Category) use (&$phpMussel): void {
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
$phpMussel['YAML']->process($phpMussel['ReadFile']($phpMussel['Vault'] . 'config.yaml'), $phpMussel['Config'], 0, true);

/** Kills the script if parsing the configuration defaults file fails. */
if (empty($phpMussel['Config']['Config Defaults'])) {
    header('Content-Type: text/plain');
    die('[phpMussel] Configuration defaults file is corrupt! Please reinstall phpMussel.');
}

/** Perform fallbacks and autotyping for missing configuration directives. */
$phpMussel['Fallback']($phpMussel['Config']['Config Defaults'], $phpMussel['Config']);

/** Fetch the IP address of the current request. */
$phpMussel['IPAddr'] = (new \Maikuolan\Common\IPHeader($phpMussel['Config']['general']['ipaddr']))->Resolution;

/** Adjusted present time. */
$phpMussel['Time'] = time() + ($phpMussel['Config']['general']['time_offset'] * 60);

/** Set timezone. */
if (!empty($phpMussel['Config']['general']['timezone']) && $phpMussel['Config']['general']['timezone'] !== 'SYSTEM') {
    date_default_timezone_set($phpMussel['Config']['general']['timezone']);
}

/** Determine whether operating in CLI-mode. */
$phpMussel['Mussel_sapi'] = (
    empty($_SERVER['REQUEST_METHOD']) ||
    substr(php_sapi_name(), 0, 3) === 'cli' || (
        empty($phpMussel['IPAddr']) &&
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
) ? constant($phpMussel['Config']['general']['default_algo']) : PASSWORD_DEFAULT;

/** Used just for the current, specific request instance. */
$phpMussel['InstanceCache'] = [];

/** Revert script ident if "hide_version" is true. */
if (!empty($phpMussel['Config']['general']['hide_version'])) {
    $phpMussel['ScriptIdent'] = 'phpMussel';
}

/** Instantiate the request class. */
$phpMussel['Request'] = new \Maikuolan\Common\Request();
$phpMussel['Request']->DefaultTimeout = $phpMussel['Config']['general']['default_timeout'];
$phpMussel['ChannelsDataArray'] = [];
$phpMussel['YAML']->process($phpMussel['ReadFile']($phpMussel['Vault'] . 'channels.yaml'), $phpMussel['ChannelsDataArray']);
$phpMussel['Request']->Channels = $phpMussel['ChannelsDataArray'] ?: [];
unset($phpMussel['ChannelsDataArray']);
if (!isset($phpMussel['Request']->Channels['Triggers'])) {
    $phpMussel['Request']->Channels['Triggers'] = [];
}
$phpMussel['Request']->Disabled = $phpMussel['Config']['general']['disabled_channels'];
$phpMussel['Request']->UserAgent = $phpMussel['ScriptUA'];
$phpMussel['Request']->SendToOut = (defined('DEV_DEBUG_MODE') && DEV_DEBUG_MODE === true);
