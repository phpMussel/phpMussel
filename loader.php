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
 * This file: The loader (last modified: 2021.09.17).
 */

/**
 * phpMussel should only be loaded once per PHP instance. To ensure this, we
 * check for the existence of a "phpMussel" constant. If it doesn't exist, we
 * define it and continue loading. If it already exists, we warn the client and
 * kill the script.
 */
if (defined('phpMussel')) {
    header('Content-Type: text/plain');
    echo '[phpMussel] ' . (
        isset($phpMussel['L10N']) ? $phpMussel['L10N']->getString('instance_already_active') : 'Instance already active! Please double-check your hooks.'
    );
    die;
}
define('phpMussel', true);

if (!version_compare(PHP_VERSION, '5.4.0', '>=')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Not compatible with PHP versions below 5.4.0; Please update PHP in order to use phpMussel.');
}

/** Create an array for our working data. */
$phpMussel = [];

/** Determine the location of the "vault" directory. */
$phpMussel['Vault'] = __DIR__ . '/vault/';

/** Kill the script if we can't find the vault directory. */
if (!is_dir($phpMussel['Vault'])) {
    header('Content-Type: text/plain');
    die('[phpMussel] Vault directory not correctly set: Can\'t continue.');
}

/** Define the location of the "cache" directory. */
$phpMussel['cachePath'] = $phpMussel['Vault'] . 'cache/';

/** Define the location of the "lang" directory. */
$phpMussel['langPath'] = $phpMussel['Vault'] . 'lang/';

/** Define the location of the "plugins" directory. */
$phpMussel['pluginPath'] = $phpMussel['Vault'] . 'plugins/';

/** Define the location of the "quarantine" directory. */
$phpMussel['qfuPath'] = $phpMussel['Vault'] . 'quarantine/';

/** Define the location of the "signatures" directory. */
$phpMussel['sigPath'] = $phpMussel['Vault'] . 'signatures/';

/** Checks whether we're calling phpMussel directly or through a hook. */
$phpMussel['Direct'] = function () {
    return (
        !isset($_SERVER['SCRIPT_FILENAME']) ||
        str_replace("\\", '/', strtolower(realpath($_SERVER['SCRIPT_FILENAME']))) === str_replace("\\", '/', strtolower(__FILE__))
    );
};

/** Checks whether we're calling phpMussel through an alternative pathway (e.g., Cronable). */
$phpMussel['Alternate'] = class_exists('\Maikuolan\Cronable\Cronable');

/** Kill the script if the functions file doesn't exist. */
if (!file_exists($phpMussel['Vault'] . 'functions.php')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Functions file missing! Please reinstall phpMussel.');
}
/** Load the functions file. */
require $phpMussel['Vault'] . 'functions.php';

/** Kill the script if the configuration handler doesn't exist. */
if (!file_exists($phpMussel['Vault'] . 'config.php')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Configuration handler missing! Please reinstall phpMussel.');
}
/** Load the configuration handler. */
require $phpMussel['Vault'] . 'config.php';

/**
 * Check whether the language handler exists; Kill the script if it
 * doesn't.
 */
if (!file_exists($phpMussel['Vault'] . 'lang.php')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Language handler missing! Please reinstall phpMussel.');
}
/** Load the language handler. */
require $phpMussel['Vault'] . 'lang.php';

/**
 * Used to determine whether we've reached the end of this file without
 * exiting cleanly (important for rendering scan results correctly).
 */
$phpMussel['EOF'] = false;

/** A safety feature for logging. */
$phpMussel['safety'] = "\x3c\x3fphp die; \x3f\x3e";

/** Plugins are detected and processed by phpMussel here. */
$phpMussel['MusselPlugins'] = ['hooks' => [], 'closures' => []];
if ($phpMussel['Config']['general']['enable_plugins']) {
    if (!is_dir($phpMussel['Vault'] . 'plugins')) {
        header('Content-Type: text/plain');
        die('[phpMussel] ' . $phpMussel['L10N']->getString('plugins_directory_nonexistent'));
    }
    $phpMussel['MusselPlugins']['tempdata'] = [];
    if ((
        $phpMussel['MusselPlugins']['tempdata']['d'] = opendir($phpMussel['Vault'] . 'plugins')
    ) && is_resource($phpMussel['MusselPlugins']['tempdata']['d'])) {
        while (true) {
            $phpMussel['MusselPlugins']['tempdata']['f'] = readdir($phpMussel['MusselPlugins']['tempdata']['d']);
            if (empty($phpMussel['MusselPlugins']['tempdata']['f'])) {
                break;
            }
            if (
                $phpMussel['MusselPlugins']['tempdata']['f'] !== '.' &&
                $phpMussel['MusselPlugins']['tempdata']['f'] !== '..' &&
                is_dir($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f']) &&
                file_exists($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php') &&
                !is_link($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php')
            ) {
                require_once $phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php';
            }
        }
        closedir($phpMussel['MusselPlugins']['tempdata']['d']);
    }
    unset($phpMussel['MusselPlugins']['tempdata']);
}

/** This code block only executed if we're NOT in CLI mode (or if we're running via Cronable). */
if (!$phpMussel['Mussel_sapi'] || $phpMussel['Alternate']) {
    /**
     * Check whether the upload handler exists and attempt to load it.
     */
    if (file_exists($phpMussel['Vault'] . 'upload.php') && !$phpMussel['Alternate']) {
        require $phpMussel['Vault'] . 'upload.php';
    }

    /**
     * Check whether the front-end handler exists and attempt to load
     * it. Skip this check if front-end access is disabled.
     */
    if (
        !$phpMussel['Config']['general']['disable_frontend'] &&
        file_exists($phpMussel['Vault'] . 'frontend.php') &&
        ($phpMussel['Direct']() || $phpMussel['Alternate'])
    ) {
        require $phpMussel['Vault'] . 'frontend.php';
    }
}

/** This code block only executed if we're in CLI mode. */
elseif (file_exists($phpMussel['Vault'] . 'cli.php')) {
    require $phpMussel['Vault'] . 'cli.php';
}

if ($phpMussel['Config']['general']['cleanup']) {
    /** Destroy unrequired plugin closures. */
    if (isset($phpMussel['MusselPlugins']['closures'])) {
        foreach ($phpMussel['MusselPlugins']['closures'] as $x) {
            if (isset($$x) && is_object($$x)) {
                unset($$x);
            }
        }
    }

    /** Unset our working data so that we can exit cleanly. */
    unset($x, $phpMussel);
} else {
    /** Let the script know that we haven't exited cleanly. */
    $phpMussel['EOF'] = true;
}
