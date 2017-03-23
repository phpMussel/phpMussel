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
 * This file: Language handler (last modified: 2016.12.14).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Create the language data array. */
$phpMussel['lang'] = array();

/** phpMussel CLI-mode ASCII art. */
$phpMussel['lang']['cli_ln1'] =
    "      _____  _     _  _____  _______ _     _ _______ _______ _______           \n" .
    " <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n" .
    "     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";

/** phpMussel CLI-mode prompt. */
$phpMussel['lang']['cli_prompt'] = "\n\n>> ";

/**
 * Kills the script if the language data file corresponding to the language
 * directive (%phpMussel%/vault/lang/lang.%%.php) doesn't exist.
 */
if (!file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.php')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');
}

/** Load the necessary language data. */
require $phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.php';

/** Load front-end language data if necessary. */
if (
    !$phpMussel['Config']['general']['disable_frontend'] &&
    file_exists($phpMussel['Vault'] . 'frontend.php') &&
    file_exists($phpMussel['Vault'] . 'fe_assets/frontend.html') &&
    $phpMussel['Direct']
) {
    /**
     * Kill the script if the front-end language data file corresponding to
     * the language directive (%phpMussel%/vault/lang/lang.%%.fe.php) doesn't
     * exist.
     */
    if (!file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.fe.php')) {
        header('Content-Type: text/plain');
        die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');
    }
    /** Load the necessary language data. */
    require $phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.fe.php';
}
