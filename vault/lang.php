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
 * This file: Language handler (last modified: 2019.08.19).
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

/** Fetch any needed plugin L10N data. */
if ($phpMussel['Config']['general']['enable_plugins']) {
    if ($phpMussel['Config']['general']['lang'] === 'en') {
        foreach ($phpMussel['PluginIterator'](['Configured' => 'lang.en.yaml']) as $phpMussel['Plugin-L10N']) {
            $phpMussel['L10N']['Configured'][] = $phpMussel['Plugin-L10N']['Configured'];
        }
    } else {
        foreach ($phpMussel['PluginIterator']([
            'Configured' => 'lang.' . $phpMussel['Config']['general']['lang'] . '.yaml',
            'Fallbacks' => 'lang.en.yaml'
        ]) as $phpMussel['Plugin-L10N']) {
            if (isset($phpMussel['Plugin-L10N']['Configured'])) {
                $phpMussel['L10N']['Configured'][] = $phpMussel['Plugin-L10N']['Configured'];
            }
            if (isset($phpMussel['Plugin-L10N']['Fallbacks'])) {
                $phpMussel['L10N']['Fallbacks'][] = $phpMussel['Plugin-L10N']['Fallbacks'];
            }
        }
    }
    unset($phpMussel['Plugin-L10N']);
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

/** Load client-specified L10N data if it's possible to do so. */
if (!$phpMussel['Config']['general']['lang_override'] || empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $phpMussel['Client-L10N'] = &$phpMussel['L10N'];
    $phpMussel['L10N-Lang-Attache'] = '';
} else {
    $phpMussel['Client-L10N'] = [
        'Accepted' => preg_replace(['~^([^,]*).*$~', '~[^-a-z]~'], ['\1', ''], strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    ];
    if (
        $phpMussel['Config']['general']['lang'] !== $phpMussel['Client-L10N']['Accepted'] &&
        file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N']['Accepted'] . '.yaml')
    ) {
        $phpMussel['Client-L10N']['Data'] = $phpMussel['ReadFile']($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N']['Accepted'] . '.yaml');
    }
    if (empty($phpMussel['Client-L10N']['Data'])) {
        $phpMussel['Client-L10N']['Accepted'] = preg_replace('~^([^-]*).*$~', '\1', $phpMussel['Client-L10N']['Accepted']);
        if (
            $phpMussel['Config']['general']['lang'] !== $phpMussel['Client-L10N']['Accepted'] &&
            file_exists($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N']['Accepted'] . '.yaml')
        ) {
            $phpMussel['Client-L10N']['Data'] = $phpMussel['ReadFile']($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N']['Accepted'] . '.yaml');
        }
    }

    /** Process client-specific L10N data. */
    if (empty($phpMussel['Client-L10N']['Data'])) {
        $phpMussel['L10N-Lang-Attache'] = '';
        $phpMussel['Client-L10N'] = [];
    } else {
        $phpMussel['Client-L10N']['Data'] = (new \Maikuolan\Common\YAML($phpMussel['Client-L10N']['Data']))->Data ?: [];
        $phpMussel['L10N-Lang-Attache'] = ($phpMussel['Config']['general']['lang'] === $phpMussel['Client-L10N']['Accepted']) ? '' : sprintf(
            ' lang="%s" dir="%s"',
            $phpMussel['Client-L10N']['Accepted'],
            isset($phpMussel['Client-L10N']['Data']['Text Direction']) ? $phpMussel['Client-L10N']['Data']['Text Direction'] : 'ltr'
        );
        $phpMussel['Client-L10N'] = $phpMussel['Client-L10N']['Data'];
    }

    /** Build final client-specific L10N object. */
    $phpMussel['Client-L10N'] = new \Maikuolan\Common\L10N($phpMussel['Client-L10N'], $phpMussel['L10N']);
}
