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
 * This file: Temporary hotfixes file (last modified: 2017.05.19).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Fetch temporary hotfixes file raw data. */
$phpMussel['ThisFile'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'hotfixes.php');

/** Flag for updating switches. */
$phpMussel['Hotfixed'] = false;

/** Hotfix for missing DAT files. */
if (true) { // switch 170519
    $phpMussel['HotfixData'] = '';

    if (!file_exists($phpMussel['Vault'] . 'components.dat')) {
        if ($phpMussel['HotfixData'] = $phpMussel['Request'](
            'https://raw.githubusercontent.com/Maikuolan/phpMussel/master/vault/components.dat'
        )) {
            $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'components.dat', 'w');
            fwrite($phpMussel['Handle'], $phpMussel['HotfixData']);
            fclose($phpMussel['Handle']);
        }
    }
    if (!file_exists($phpMussel['Vault'] . 'plugins.dat')) {
        if ($phpMussel['HotfixData'] = $phpMussel['Request'](
            'https://raw.githubusercontent.com/Maikuolan/phpMussel/master/vault/plugins.dat'
        )) {
            $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'plugins.dat', 'w');
            fwrite($phpMussel['Handle'], $phpMussel['HotfixData']);
            fclose($phpMussel['Handle']);
        }
    }
    if (!file_exists($phpMussel['Vault'] . 'signatures.dat')) {
        if ($phpMussel['HotfixData'] = $phpMussel['Request'](
            'https://raw.githubusercontent.com/Maikuolan/phpMussel/master/vault/signatures.dat'
        )) {
            $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'signatures.dat', 'w');
            fwrite($phpMussel['Handle'], $phpMussel['HotfixData']);
            fclose($phpMussel['Handle']);
        }
    }
    if (!file_exists($phpMussel['Vault'] . 'themes.dat')) {
        if ($phpMussel['HotfixData'] = $phpMussel['Request'](
            'https://raw.githubusercontent.com/Maikuolan/phpMussel/master/vault/themes.dat'
        )) {
            $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'themes.dat', 'w');
            fwrite($phpMussel['Handle'], $phpMussel['HotfixData']);
            fclose($phpMussel['Handle']);
        }
    }

    /** Update switch. */
    $phpMussel['ThisFile'] = str_replace(
        "\nif (true) { // switch 170519\n",
        "\nif (false) {\n",
        $phpMussel['ThisFile']
    );
    $phpMussel['Hotfixed'] = true;
}

/** Update temporary hotfixes file switches. */
if ($phpMussel['Hotfixed']) {
    $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'hotfixes.php', 'w');
    fwrite($phpMussel['Handle'], $phpMussel['ThisFile']);
    fclose($phpMussel['Handle']);
}
