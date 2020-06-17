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
 * This file: Event handlers file (last modified: 2020.06.17).
 */

/**
 * Writes to the serialized logfile upon scan completion.
 *
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToSerialLog', function () use (&$phpMussel) {

    /** Guard. */
    if (
        !$phpMussel['Config']['general']['scan_log_serialized'] ||
        !($File = $phpMussel['BuildPath']($phpMussel['Vault'] . $phpMussel['Config']['general']['scan_log_serialized']))
    ) {
        return false;
    }

    /** Determine SAPI/origin. */
    if ($phpMussel['Mussel_sapi']) {
        $Origin = 'CLI';
    } elseif ($phpMussel['Config']['legal']['pseudonymise_ip_addresses']) {
        $Origin = $phpMussel['Pseudonymise-IP']($_SERVER[$phpMussel['IPAddr']]);
    } else {
        $Origin = $_SERVER[$phpMussel['IPAddr']];
    }

    $ScanData = empty($phpMussel['whyflagged']) ? $phpMussel['L10N']->getString('data_not_available') : trim($phpMussel['whyflagged']);
    if (!isset($phpMussel['InstanceCache']['objects_scanned'])) {
        $phpMussel['InstanceCache']['objects_scanned'] = 0;
    }
    if (!isset($phpMussel['InstanceCache']['detections_count'])) {
        $phpMussel['InstanceCache']['detections_count'] = 0;
    }
    if (!isset($phpMussel['InstanceCache']['scan_errors'])) {
        $phpMussel['InstanceCache']['scan_errors'] = 1;
    }
    $Data = serialize([
        'start_time' => isset($phpMussel['InstanceCache']['start_time']) ? $phpMussel['InstanceCache']['start_time'] : '-',
        'end_time' => isset($phpMussel['InstanceCache']['end_time']) ? $phpMussel['InstanceCache']['end_time'] : '-',
        'origin' => $Origin,
        'objects_scanned' => isset($phpMussel['InstanceCache']['objects_scanned']) ? $phpMussel['InstanceCache']['objects_scanned'] : 0,
        'detections_count' => isset($phpMussel['InstanceCache']['detections_count']) ? $phpMussel['InstanceCache']['detections_count'] : 0,
        'scan_errors' => isset($phpMussel['InstanceCache']['scan_errors']) ? $phpMussel['InstanceCache']['scan_errors'] : 0,
        'detections' => $ScanData
    ]) . "\n";
    $WriteMode = (!file_exists($File) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) ? 'w' : 'a';

    $Stream = fopen($File, $WriteMode);
    fwrite($Stream, $Data);
    fclose($Stream);
    if ($WriteMode === 'w') {
        $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log_serialized']);
    }
    return true;
});

/**
 * Writes to the standard scan log upon scan completion.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToScanLog', function ($Data) use (&$phpMussel) {

    /** Guard. */
    if (
        !$phpMussel['Config']['general']['scan_log'] ||
        !($File = $phpMussel['BuildPath']($phpMussel['Vault'] . $phpMussel['Config']['general']['scan_log']))
    ) {
        return false;
    }

    if (!file_exists($File)) {
        $Data = $phpMussel['safety'] . "\n" . $Data;
        $WriteMode = 'w';
    } else {
        $WriteMode = (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        ) ? 'w' : 'a';
    }

    $Handle = fopen($File, 'a');
    fwrite($Handle, $Data);
    fclose($Handle);
    if ($WriteMode === 'w') {
        $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log']);
    }
    return true;
});

/**
 * Writes to the scan kills log.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToScanKillsLog', function ($Data) use (&$phpMussel) {

    /** Guard. */
    if (
        empty($phpMussel['killdata']) ||
        !$phpMussel['Config']['general']['scan_kills'] ||
        !($File = $phpMussel['BuildPath']($phpMussel['Vault'] . $phpMussel['Config']['general']['scan_kills']))
    ) {
        return false;
    }

    if (!file_exists($File)) {
        $Data = $phpMussel['safety'] . "\n\n" . $Data;
        $WriteMode = 'w';
    } else {
        $WriteMode = (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        ) ? 'w' : 'a';
    }

    $Stream = fopen($File, $WriteMode);
    fwrite($Stream, $Data);
    fclose($Stream);
    if ($WriteMode === 'w') {
        $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_kills']);
    }
    return true;
});

/**
 * Prepares any caught errors for writing to the default error log.
 *
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('error', function ($Data) use (&$phpMussel) {

    /** Guard. */
    if (!$phpMussel['Config']['general']['error_log']) {
        return false;
    }

    if (!isset($phpMussel['Pending-Error-Log-Data'])) {
        $phpMussel['Pending-Error-Log-Data'] = '';
    }
    $Data = unserialize($Data);
    $Message = sprintf(
        '[%s] Error at %s:L%d (error code %d)%s.',
        date('c', time()),
        empty($Data[2]) ? '?' : $Data[2],
        empty($Data[3]) ? 0 : $Data[3],
        empty($Data[0]) ? 0 : $Data[0],
        empty($Data[1]) ? '' : ': "' . $Data[1] . '"'
    );
    $phpMussel['Pending-Error-Log-Data'] .= $Message . "\n";
    return true;
});

/**
 * Writes to the default error log.
 *
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('final', function () use (&$phpMussel) {

    /** Guard. */
    if (
        !isset($phpMussel['Pending-Error-Log-Data']) ||
        !$phpMussel['Config']['general']['error_log'] ||
        !($File = $phpMussel['BuildPath']($phpMussel['Vault'] . $phpMussel['Config']['general']['error_log']))
    ) {
        return false;
    }

    if (!file_exists($File) || !filesize($File) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) {
        $WriteMode = 'w';
        $Data = $phpMussel['L10N']->getString('error_log_header') . "\n=====\n" . $phpMussel['Pending-Error-Log-Data'];
    } else {
        $WriteMode = 'a';
        $Data = $phpMussel['Pending-Error-Log-Data'];
    }

    $Handle = fopen($File, $WriteMode);
    fwrite($Handle, $Data);
    fclose($Handle);
    if ($WriteMode === 'w') {
        $phpMussel['LogRotation']($phpMussel['Config']['general']['error_log']);
    }
    return true;
});

/**
 * Writes to the PHPMailer event log.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToPHPMailerEventLog', function ($Data) use (&$phpMussel) {

    /** Guard. */
    if (
        !$phpMussel['Config']['PHPMailer']['event_log'] ||
        !($EventLog = $phpMussel['BuildPath']($phpMussel['Vault'] . $phpMussel['Config']['PHPMailer']['event_log']))
    ) {
        return false;
    }

    $WriteMode = (!file_exists($EventLog) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($EventLog) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) ? 'w' : 'a';

    $Handle = fopen($EventLog, $WriteMode);
    fwrite($Handle, $Data);
    fclose($Handle);
    if ($WriteMode === 'w') {
        $phpMussel['LogRotation']($phpMussel['Config']['PHPMailer']['EventLog']);
    }
    return true;
});
