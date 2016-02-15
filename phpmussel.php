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
 * This file: phpMussel loader (last modified: 2016.02.15).
 *
 * @package Maikuolan/phpMussel
 */

/**
 * phpMussel should only be loaded once per PHP instance. To ensure this, we
 * check for the existence of a "phpMussel" constant. If it doesn't exist, we
 * define it and continue loading. If it already exists, we warn the client and
 * kill the script.
 */
if (!defined('phpMussel')) {
    define('phpMussel', true);

    /**
     * Create an array for our working data.
     * @global array $phpMussel
     */
    $phpMussel = array();

    /** Make our array a superglobal. */
    global $phpMussel;

    /** Determine the location of the "vault" directory. */
    $phpMussel['vault'] = __DIR__ . '/vault/';

    /** Kill the script if we can't find the vault directory. */
    if (!is_dir($phpMussel['vault'])) {
        header('Content-Type: text/plain');
        die(
            '[phpMussel] Vault directory not correctly set: Can\'t ' .
            'continue. Refer to documentation if this is a first-time run, ' .
            'and if problems persist, seek assistance.'
        );
    }

    /** Define the location of the "cache" directory. */
    $phpMussel['cachePath'] = $phpMussel['vault'] . 'cache/';

    /** Define the location of the "lang" directory. */
    $phpMussel['langPath'] = $phpMussel['vault'] . 'lang/';

    /** Define the location of the "plugins" directory. */
    $phpMussel['pluginPath'] = $phpMussel['vault'] . 'plugins/';

    /** Define the location of the "quarantine" directory. */
    $phpMussel['qfuPath'] = $phpMussel['vault'] . 'quarantine/';

    /** Define the location of the "signatures" directory. */
    $phpMussel['sigPath'] = $phpMussel['vault'] . 'signatures/';

    /** Check if the configuration handler exists; If it doesn't, kill the script. */
    if (!file_exists($phpMussel['vault'] . 'config.inc')) {
        header('Content-Type: text/plain');
        die('[phpMussel] Configuration handler missing! Please reinstall phpMussel.');
    }
    /** Load the configuration handler. */
    require $phpMussel['vault'] . 'config.inc';

    /** Check if the language handler exists; If it doesn't, kill the script. */
    if (!file_exists($phpMussel['vault'] . 'lang.inc')) {
        header('Content-Type: text/plain');
        die('[phpMussel] Language handler missing! Please reinstall phpMussel.');
    }
    /** Load the language handler. */
    require $phpMussel['vault'] . 'lang.inc';

    /** Halts and/or kills the script if an update is in progress. */
    while (file_exists($phpMussel['vault'] . 'update.lck')) {
        sleep(2);
        if ((time() - $phpMussel['time']) > 12) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['Config']['lang']['update_lock_detected']);
        }
    }

    /** Scrap variable used for processing plugins. */
    $x = '';

    /** Preserve INI defaults for when we exit cleanly. */
    $phpMussel['inidefaults'] = array();
    $phpMussel['inidefaults']['backtrack_limit'] = ini_get('pcre.backtrack_limit');
    $phpMussel['inidefaults']['recursion_limit'] = ini_get('pcre.recursion_limit');
    $phpMussel['inidefaults']['default_charset'] = ini_get('default_charset');
    $phpMussel['inidefaults']['internal_encoding'] = ini_get('mbstring.internal_encoding');
    $phpMussel['inidefaults']['user_agent'] = ini_get('user_agent');

    /**
     * Helps to prevent PCRE from backticking itself and the entire PHP process
     * into oblivion during certain scanning operations.
     */
    ini_set('pcre.backtrack_limit', '4K');

    /**
     * Helps to prevent PCRE from overloading the PHP process via excessive
     * capturing during certain scanning operations.
     */
    ini_set('pcre.recursion_limit', '4K');

    /** We should always use UTF-8. */
    ini_set('default_charset', 'utf-8');

    /** We should always use UTF-8. */
    ini_set('mbstring.internal_encoding', 'UTF-8');

    /** Set the phpMussel User Agent. */
    ini_set('user_agent', $phpMussel['ScriptUA']);

    /**
     * Create an array to use as a temporary memory cache for scanning
     * operations (note: this has nothing to do with the memCache extension of
     * PHP; the variable name is coincidental).
     */
    $phpMussel['memCache'] = array();

    /**
     * Used to determine whether we've reached the end of this file without
     * exiting cleanly (important for rendering scan results correctly).
     */
    $phpMussel['EOF'] = false;

    /** A safety feature for logging. */
    $phpMussel['safety'] = "\x3c\x3fphp die; \x3f\x3e";

    /**
     * If phpMussel is "disabled" (if the "disable lock" is engaged), nothing
     * within this block should execute (thus effectively disabling phpMussel).
     */
    if (!$phpMussel['disable_lock'] = file_exists($phpMussel['vault'] . 'disable.lck')) {

        /** Check if the functions file exists; If it doesn't, kill the script. */
        if (!file_exists($phpMussel['vault'] . 'functions.inc')) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['Config']['lang']['core_scriptfile_missing']);
        }

        /** Load the functions file. */
        require $phpMussel['vault'] . 'functions.inc';

        /** Plugins are detected and processed by phpMussel here. */
        $phpMussel['MusselPlugins'] = array();
        $phpMussel['MusselPlugins']['hooks'] = array();
        $phpMussel['MusselPlugins']['hookcounts'] = array();
        if ($phpMussel['Config']['general']['enable_plugins']) {
            if (!is_dir($phpMussel['vault'] . 'plugins')) {
                header('Content-Type: text/plain');
                die('[phpMussel] ' . $phpMussel['Config']['lang']['plugins_directory_nonexistent']);
            }
            $phpMussel['MusselPlugins']['tempdata'] = array();
            if ($phpMussel['MusselPlugins']['tempdata']['d'] = opendir($phpMussel['vault'] . 'plugins')) {
                while (false !== ($phpMussel['MusselPlugins']['tempdata']['f'] = readdir($phpMussel['MusselPlugins']['tempdata']['d']))) {
                    if (
                        $phpMussel['MusselPlugins']['tempdata']['f'] !== '.' &&
                        $phpMussel['MusselPlugins']['tempdata']['f'] !== '..' &&
                        is_dir($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'])
                    ) {
                        if (
                            file_exists($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php') &&
                            !is_link($phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php')
                        ) {
                            require_once $phpMussel['pluginPath'] . $phpMussel['MusselPlugins']['tempdata']['f'] . '/plugin.php';
                        }
                    }
                }
            }
            closedir($phpMussel['MusselPlugins']['tempdata']['d']);
            $phpMussel['MusselPlugins']['tempdata'] = array();
        }

    }

    /**
     * Check if controls are disabled (if the "controls lock" is engaged); If
     * they are, do nothing; If they aren't, then, check if the controls
     * handler exists; If it exists, load it. Note that the controls handler
     * will likely be superseded by a frontend management system (and thus,
     * removed) in the future. Skip this check if we're in CLI-mode.
     */
    if (!file_exists($phpMussel['vault'] . 'controls.lck')) {
        if ($phpMussel['Mussel_sapi'] !== 'cli') {
            if (file_exists($phpMussel['vault'] . 'controls.inc')) {
                require $phpMussel['vault'] . 'controls.inc';
            }
        }
    }

    /**
     * If phpMussel is "disabled" (if the "disable lock" is engaged), nothing
     * within this block should execute (thus effectively disabling phpMussel).
     */
    if (!$phpMussel['disable_lock'] = file_exists($phpMussel['vault'] . 'disable.lck')) {

        /**
         * Check if the upload handler exists; If it exists, load it.
         * Skip this check if we're in CLI-mode.
         */
        if ($phpMussel['Mussel_sapi'] !== 'cli') {
            if (file_exists($phpMussel['vault'] . 'upload.inc')) {
                require $phpMussel['vault'] . 'upload.inc';
            }
        }

        /**
         * Check if the CLI handler exists; If it exists, load it.
         * Skip this check if we're NOT in CLI-mode.
         */
        if ($phpMussel['Mussel_sapi'] === 'cli') {
            if (file_exists($phpMussel['vault'] . 'cli.inc')) {
                require $phpMussel['vault'] . 'cli.inc';
            }
        }

    }

    /** Restore default User Agent. */
    ini_set('user_agent', $phpMussel['inidefaults']['user_agent']);

    if ($phpMussel['Config']['general']['cleanup']) {

        /** Restore default internal encoding. */
        ini_set('mbstring.internal_encoding', $phpMussel['inidefaults']['internal_encoding']);
        /** Restore default charset. */
        ini_set('default_charset', $phpMussel['inidefaults']['default_charset']);
        /** Restore default PCRE recursion limit. */
        ini_set('pcre.recursion_limit', $phpMussel['inidefaults']['recursion_limit']);
        /** Restore default PCRE backtrack limit. */
        ini_set('pcre.backtrack_limit', $phpMussel['inidefaults']['backtrack_limit']);

        /** Unset our working data so that we can exit cleanly. */
        unset($x, $phpMussel);

    } else {

        /** Let the script know that we haven't exited cleanly. */
        $phpMussel['EOF'] = true;

    }

} else {
    header('Content-Type: text/plain');
    echo
        (!isset($phpMussel['Config']['lang']['instance_already_active'])) ?
        '[phpMussel] Instance already active! Please double-check your hooks.' :
        '[phpMussel] ' . $phpMussel['Config']['lang']['instance_already_active'];
    die;
}
