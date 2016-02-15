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
 * This file: phpMussel language handler (last modified: 2016.02.14).
 *
 * @package Maikuolan/phpMussel
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Create the language data array. */
$phpMussel['Config']['lang'] = array();

/** phpMussel CLI-mode ASCII art. */
$phpMussel['Config']['lang']['cli_ln1'] =
"      _____  _     _  _____  _______ _     _ _______ _______ _______           \n".
" <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n".
"     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";

/** phpMussel CLI-mode prompt. */
$phpMussel['Config']['lang']['cli_prompt'] = "\n\n>> ";

/** Ensure HTTP_ACCEPT_LANGUAGE is defined (even if it's empty). */
if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = '';
}

/**
 * If lang_override is enabled, and if HTTP_ACCEPT_LANGUAGE matches a
 * permissible language choice, we will override the configuration file defined
 * language directive using the language specified by HTTP_ACCEPT_LANGUAGE.
 */
if ($phpMussel['Config']['general']['lang_override'] && $_SERVER['HTTP_ACCEPT_LANGUAGE']) {
    if (substr_count($phpMussel['Config']['lang_acceptable'], substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5))) {
        $phpMussel['Config']['general']['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    } elseif (substr_count($phpMussel['Config']['lang_acceptable'], substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))) {
        $phpMussel['Config']['general']['lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
}

/**
 * Kills the script if the language data file corresponding to the language
 * directive (%phpMussel%/vault/lang/lang.%%.inc) doesn't exist.
 */
if (!file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.inc')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');
}

/** Load the necessary language data. */
require $phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.inc';
