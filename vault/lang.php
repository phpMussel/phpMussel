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
 * This file: Language handler (last modified: 2022.02.13).
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
$phpMussel['L10N'] = [
    'Configured' => [],
    'ConfiguredData' => '',
    'ConfiguredDataArray' => [],
    'Fallbacks' => [],
    'FallbackData' => '',
    'FallbackDataArray' => []
];

/**
 * If the language directive is set to English, don't bother about fallbacks.
 * If it isn't set to English, we'll use English as the fallback.
 */
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
$phpMussel['YAML']->process($phpMussel['L10N']['ConfiguredData'], $phpMussel['L10N']['ConfiguredDataArray']);

/** Load the L10N fallback data. */
foreach ($phpMussel['L10N']['Fallbacks'] as $phpMussel['L10N']['ThisFallback']) {
    $phpMussel['L10N']['FallbackData'] .= $phpMussel['ReadFile']($phpMussel['L10N']['ThisFallback']);
}

/** Parse the L10N fallback data. */
$phpMussel['YAML']->process($phpMussel['L10N']['FallbackData'], $phpMussel['L10N']['FallbackDataArray']);

/** Build final L10N object. */
$phpMussel['L10N'] = new \Maikuolan\Common\L10N($phpMussel['L10N']['ConfiguredDataArray'], $phpMussel['L10N']['FallbackDataArray']);

/** Assign language rules. */
if ($phpMussel['Config']['general']['lang'] === 'en') {
    $phpMussel['L10N']->autoAssignRules('en');
} else {
    $phpMussel['L10N']->autoAssignRules($phpMussel['Config']['general']['lang'], 'en');
}

/** Load client-specified L10N data if it's possible to do so. */
if (!$phpMussel['Config']['general']['lang_override'] || empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $phpMussel['Client-L10N'] = &$phpMussel['L10N'];
    $phpMussel['L10N-Lang-Attache'] = '';
} else {
    $phpMussel['Client-L10N'] = [];
    $phpMussel['Client-L10N-Accepted'] = preg_replace(
        ['~^([^,]*).*$~', '~[^-a-z]~'],
        ['\1', ''],
        strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'])
    );
    if (
        $phpMussel['Config']['general']['lang'] !== $phpMussel['Client-L10N-Accepted'] &&
        is_readable($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N-Accepted'] . '.yaml')
    ) {
        $phpMussel['Client-L10N']['Data'] = $phpMussel['ReadFile']($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N-Accepted'] . '.yaml');
    }
    if (empty($phpMussel['Client-L10N']['Data'])) {
        $phpMussel['Client-L10N-Accepted'] = preg_replace('~^([^-]*).*$~', '\1', $phpMussel['Client-L10N-Accepted']);
        if (
            $phpMussel['Config']['general']['lang'] !== $phpMussel['Client-L10N-Accepted'] &&
            is_readable($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N-Accepted'] . '.yaml')
        ) {
            $phpMussel['Client-L10N']['Data'] = $phpMussel['ReadFile']($phpMussel['langPath'] . 'lang.' . $phpMussel['Client-L10N-Accepted'] . '.yaml');
        }
    }

    /** Process client-specific L10N data. */
    if (empty($phpMussel['Client-L10N']['Data'])) {
        $phpMussel['L10N-Lang-Attache'] = '';
        $phpMussel['Client-L10N'] = [];
    } else {
        $phpMussel['Client-L10N']['DataArray'] = [];
        $phpMussel['YAML']->process($phpMussel['Client-L10N']['Data'], $phpMussel['Client-L10N']['DataArray']);
        $phpMussel['L10N-Lang-Attache'] = ($phpMussel['Config']['general']['lang'] === $phpMussel['Client-L10N-Accepted']) ? '' : sprintf(
            ' lang="%s" dir="%s"',
            $phpMussel['Client-L10N-Accepted'],
            $phpMussel['Client-L10N']['DataArray']['Text Direction'] ?? 'ltr'
        );
        $phpMussel['Client-L10N'] = $phpMussel['Client-L10N']['DataArray'];
    }

    /** Build final client-specific L10N object. */
    $phpMussel['Client-L10N'] = new \Maikuolan\Common\L10N($phpMussel['Client-L10N'], $phpMussel['L10N']);
    $phpMussel['Client-L10N']->autoAssignRules($phpMussel['Client-L10N-Accepted']);
    unset($phpMussel['Client-L10N-Accepted']);
}
