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
 * This file: Language handler (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Swaps two variables (in PHP7: "[$First, $Second] = [$Second, $First];"). */
$phpMussel['Swap'] = function(&$First, &$Second) {
    $Working = $First;
    $First = $Second;
    $Second = $Working;
};

/** Default language plurality rule. */
$phpMussel['Plural-Rule'] = function($Num) {
    return $Num === 1 ? 0 : 1;
};

/** Select string based on plural rule. */
$phpMussel['Plural'] = function($Num, $String) use (&$phpMussel) {
    if (!is_array($String)) {
        return $String;
    }
    $Choice = $phpMussel['Plural-Rule']($Num);
    if (!empty($String[$Choice])) {
        return $String[$Choice];
    }
    return empty($String[0]) ? '' : $String[0];
};

/** If the language directive is empty, default to English. */
if (empty($phpMussel['Config']['general']['lang'])) {
    $phpMussel['Config']['general']['lang'] = 'en';
}

/** Create the language data array. */
$phpMussel['lang'] = [];

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

/** Will remove later (temporary variable). */
$phpMussel['Config']['general']['lang_override'] = false;

/** Load user language overrides if possible and enabled. */
if ($phpMussel['Config']['general']['lang_override'] && !empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $phpMussel['lang_user'] = $phpMussel['lang'];
    $phpMussel['user_lang'] = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    if (($phpMussel['lang_pos'] = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',')) !== false) {
        $phpMussel['user_lang'] = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, $phpMussel['lang_pos']);
    }
    if (
        empty($phpMussel['Config']['Config Defaults']['general']['lang']['choices'][$phpMussel['user_lang']]) &&
        ($phpMussel['lang_pos'] = strpos($phpMussel['user_lang'], '-')) !== false
    ) {
        $phpMussel['user_lang'] = substr($phpMussel['user_lang'], 0, $phpMussel['lang_pos']);
        if (empty($phpMussel['Config']['Config Defaults']['general']['lang']['choices'][$phpMussel['user_lang']])) {
            $phpMussel['user_lang'] = '';
        }
    }

    /** Load the necessary language data. */
    if (
        $phpMussel['user_lang'] &&
        $phpMussel['user_lang'] !== $phpMussel['Config']['general']['lang'] &&
        file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['user_lang'] . '.php')
    ) {
        require $phpMussel['langPath'] . 'lang.' . $phpMussel['user_lang'] . '.php';
    }

    $phpMussel['Swap']($phpMussel['lang_user'], $phpMussel['lang']);
    unset($phpMussel['user_lang'], $phpMussel['lang_pos']);
} else {
    $phpMussel['lang_user'] = &$phpMussel['lang'];
}
