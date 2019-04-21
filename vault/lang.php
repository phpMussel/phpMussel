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
 * This file: Language handler (last modified: 2019.04.21).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** If the language directive is empty, default to English. */
if (empty($phpMussel['Config']['general']['lang'])) {
    $phpMussel['Config']['general']['lang'] = 'en';
}

/** L10N data. */
$phpMussel['L10N'] = ['Configured' => [], 'ConfiguredData' => '', 'Fallbacks' => [], 'FallbackData' => ''];

/** If the language directive is set to English, don't bother about fallbacks. */
if ($phpMussel['Config']['general']['lang'] === 'en') {

    /** Standard L10N data. */
    $phpMussel['L10N']['Configured'][] = $phpMussel['langPath'] . 'lang.en.yaml';
    if (
        !$phpMussel['Config']['general']['disable_frontend'] &&
        file_exists($phpMussel['Vault'] . 'frontend.php') &&
        file_exists($phpMussel['Vault'] . 'fe_assets/frontend.html') &&
        ($phpMussel['Direct']() || !empty($phpMussel['Alternate']))
    ) {
        /** Front-end L10N data. */
        $phpMussel['L10N']['Configured'][] = $phpMussel['langPath'] . 'lang.en.fe.yaml';
    }

/** If the language directive isn't set to English, we'll use English as the fallback. */
} else {

    /** Standard L10N data. */
    $phpMussel['L10N']['Configured'][] = $phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.yaml';
    $phpMussel['L10N']['Fallbacks'][] = $phpMussel['langPath'] . 'lang.en.yaml';
    if (
        !$phpMussel['Config']['general']['disable_frontend'] &&
        file_exists($phpMussel['Vault'] . 'frontend.php') &&
        file_exists($phpMussel['Vault'] . 'fe_assets/frontend.html') &&
        ($phpMussel['Direct']() || !empty($phpMussel['Alternate']))
    ) {
        /** Front-end L10N data. */
        $phpMussel['L10N']['Configured'][] = $phpMussel['langPath'] . 'lang.' . $phpMussel['Config']['general']['lang'] . '.fe.yaml';
        $phpMussel['L10N']['Fallbacks'][] = $phpMussel['langPath'] . 'lang.en.fe.yaml';
    }

}

/** Load the L10N data. */
foreach ($phpMussel['L10N']['Configured'] as $phpMussel['L10N']['ThisConfigured']) {
    $phpMussel['L10N']['ConfiguredData'] .= $phpMussel['ReadFile']($phpMussel['L10N']['ThisConfigured']);
}

/** Parse the L10N data. */
$phpMussel['L10N']['ConfiguredData'] = (new \Maikuolan\Common\YAML($phpMussel['L10N']['ConfiguredData']))->Data;

/** Load the L10N fallback data. */
foreach ($phpMussel['L10N']['Fallbacks'] as $phpMussel['L10N']['ThisFallback']) {
    $phpMussel['L10N']['FallbackData'] .= $phpMussel['ReadFile']($phpMussel['L10N']['ThisFallback']);
}

/** Parse the L10N fallback data. */
$phpMussel['L10N']['FallbackData'] = (new \Maikuolan\Common\YAML($phpMussel['L10N']['FallbackData']))->Data;

/** Build final L10N object. */
$phpMussel['L10N'] = new \Maikuolan\Common\L10N($phpMussel['L10N']['ConfiguredData'], $phpMussel['L10N']['FallbackData']);

/** Reference L10N object's contained data to ensure things don't break until we can properly implement the new object. */
$phpMussel['lang'] = &$phpMussel['L10N']->Data;

/** Temporary hotfix for missing textDir variable. */
$phpMussel['lang']['textDir'] = (isset($phpMussel['lang']['Text Direction']) && $phpMussel['lang']['Text Direction'] === 'rtl') ? 'rtl' : 'ltr';

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
        // rewrite this!!!
        require $phpMussel['langPath'] . 'lang.' . $phpMussel['user_lang'] . '.php';
    }

    $phpMussel['Swap']($phpMussel['lang_user'], $phpMussel['lang']);
    unset($phpMussel['user_lang'], $phpMussel['lang_pos']);
} else {
    $phpMussel['lang_user'] = &$phpMussel['lang'];
}
