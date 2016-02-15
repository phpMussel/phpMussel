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
 * This file: phpMussel language handler (last modified: 2016.02.07).
 *
 * @package Maikuolan/phpMussel
 */

namespace phpMussel; #<- The namespace declaration seems to kill phpMussel in CLI-mode for some reason. I don't know why!! Need to investigate this to figure it out!!

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** If General Configuration is undefined, define it. */
if (!isset($MusselConfig['general'])) {
    $MusselConfig['general']=array();
}

/** If the language directive is undefined, define it. */
if (!isset($MusselConfig['general']['lang'])) {
    $MusselConfig['general']['lang']='';
}

/** If the language directive is empty, default to English. */
if (!$MusselConfig['general']['lang']) {
    $MusselConfig['general']['lang']='en';
}

/** Create the language data array. */
$MusselConfig['lang']=array();

/** phpMussel CLI-mode ASCII art. */
$MusselConfig['lang']['cli_ln1']=
"      _____  _     _  _____  _______ _     _ _______ _______ _______           \n".
" <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n".
"     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";

/** phpMussel CLI-mode prompt. */
$MusselConfig['lang']['cli_prompt']="\n\n>> ";

/** If the lang_override directive is undefined, default to false. */
if (!isset($MusselConfig['general']['lang_override'])) {
    $MusselConfig['general']['lang_override']=false;
}

/**
 * Define the permissible language choices (this is to prevent potential RFI
 * attacks occurring via lang_override).
 */
if (!isset($MusselConfig['lang_acceptable'])) {
    $MusselConfig['lang_acceptable']=',en,ar,de,es,fr,id,it,ja,nl,pt,ru,vi,zh,zh-TW,';
}

/** Ensure HTTP_ACCEPT_LANGUAGE is defined (even if it's empty). */
if (!isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $_SERVER['HTTP_ACCEPT_LANGUAGE']='';
}

/**
 * If lang_override is enabled, and if HTTP_ACCEPT_LANGUAGE matches a
 * permissible language choice, we will override the configuration file defined
 * language directive using the language specified by HTTP_ACCEPT_LANGUAGE.
 */
if ($MusselConfig['general']['lang_override'] && $_SERVER['HTTP_ACCEPT_LANGUAGE']) {
    if (substr_count($MusselConfig['lang_acceptable'], substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5))) {
        $MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 5);
    } elseif (substr_count($MusselConfig['lang_acceptable'], substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2))) {
        $MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }
}

/**
 * Kills the script if language data file corresponding to the language
 * directive (%phpMussel%/vault/lang/lang.%%.inc) doesn't exist.
 */
if (!file_exists($vault.'lang/lang.'.$MusselConfig['general']['lang'].'.inc')) {
    plaintext_echo_die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');
}

/**
 * Load all necessary language data from the language data file corresponding
 * to the language directive using a require statement.
 */
require $vault.'lang/lang.'.$MusselConfig['general']['lang'].'.inc';
