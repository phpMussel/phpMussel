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
 * This file: Event handlers file (last modified: 2019.09.24).
 */

/**
 * Writes to the serialized logfile upon scan completion.
 *
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToSerialLog', function () use (&$phpMussel): bool {

    /** Guard. */
    if (!$phpMussel['Config']['general']['scan_log_serialized']) {
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
    $Handle = [
        'Data' => serialize([
            'start_time' => $phpMussel['InstanceCache']['start_time'] ?? '-',
            'end_time' => $phpMussel['InstanceCache']['end_time'] ?? '-',
            'origin' => $Origin,
            'objects_scanned' => $phpMussel['InstanceCache']['objects_scanned'] ?? 0,
            'detections_count' => $phpMussel['InstanceCache']['detections_count'] ?? 0,
            'scan_errors' => $phpMussel['InstanceCache']['scan_errors'] ?? 0,
            'detections' => $ScanData
        ]) . "\n",
        'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_log_serialized'])
    ];
    $WriteMode = (!file_exists($phpMussel['Vault'] . $Handle['File']) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($phpMussel['Vault'] . $Handle['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) ? 'w' : 'a';

    /** Build the path to the log and write it. */
    if ($phpMussel['BuildLogPath']($Handle['File'])) {
        $Stream = fopen($phpMussel['Vault'] . $Handle['File'], $WriteMode);
        fwrite($Stream, $Handle['Data']);
        fclose($Stream);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log_serialized']);
        }
        return true;
    }

    return false;
});

/**
 * Writes to the standard scan log upon scan completion.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToScanLog', function (string $Data) use (&$phpMussel): bool {

    /** Guard. */
    if (!$phpMussel['Config']['general']['scan_log']) {
        return false;
    }

    /** Applies formatting for dynamic log filenames. */
    $File = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_log']);

    if (!file_exists($phpMussel['Vault'] . $File)) {
        $Data = $phpMussel['safety'] . "\n" . $Data;
        $WriteMode = 'w';
    } else {
        $WriteMode = (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($phpMussel['Vault'] . $File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        ) ? 'w' : 'a';
    }

    /** Build the path to the log and write it. */
    if ($phpMussel['BuildLogPath']($File)) {
        $Handle = fopen($phpMussel['Vault'] . $File, 'a');
        fwrite($Handle, $Data);
        fclose($Handle);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log']);
        }
        return true;
    }

    return false;
});

/**
 * Writes to the scan kills log.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToScanKillsLog', function (string $Data) use (&$phpMussel): bool {

    /** Guard. */
    if (!$phpMussel['Config']['general']['scan_kills'] || empty($phpMussel['killdata'])) {
        return false;
    }

    /** Applies formatting for dynamic log filenames. */
    $File = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_kills']);

    if (!file_exists($phpMussel['Vault'] . $File)) {
        $Data = $phpMussel['safety'] . "\n\n" . $Data;
        $WriteMode = 'w';
    } else {
        $WriteMode = (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($phpMussel['Vault'] . $File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        ) ? 'w' : 'a';
    }

    /** Build the path to the log. */
    if (!$phpMussel['BuildLogPath']($File)) {
        return false;
    }

    $Stream = fopen($phpMussel['Vault'] . $File, $WriteMode);
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
$phpMussel['Events']->addHandler('error', function (string $Data) use (&$phpMussel): bool {

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
$phpMussel['Events']->addHandler('final', function () use (&$phpMussel): bool {

    /** Guard. */
    if (!$phpMussel['Config']['general']['error_log'] || !isset($phpMussel['Pending-Error-Log-Data'])) {
        return false;
    }

    /** Applies formatting for dynamic log filenames. */
    $File = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['error_log']);

    if (!file_exists($phpMussel['Vault'] . $File) || !filesize($phpMussel['Vault'] . $File) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($phpMussel['Vault'] . $File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) {
        $WriteMode = 'w';
        $Data = $phpMussel['L10N']->getString('error_log_header') . "\n=====\n" . $phpMussel['Pending-Error-Log-Data'];
    } else {
        $WriteMode = 'a';
        $Data = $phpMussel['Pending-Error-Log-Data'];
    }

    /** Build the path to the log and write it. */
    if ($phpMussel['BuildLogPath']($File)) {
        $Handle = fopen($phpMussel['Vault'] . $File, $WriteMode);
        fwrite($Handle, $Data);
        fclose($Handle);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['general']['error_log']);
        }
        return true;
    }

    return false;
});

/**
 * Writes to the PHPMailer event log.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['Events']->addHandler('writeToPHPMailerEventLog', function (string $Data) use (&$phpMussel): bool {

    /** Guard. */
    if (!$phpMussel['Config']['PHPMailer']['event_log']) {
        return false;
    }

    /** Applies formatting for dynamic log filenames. */
    $EventLog = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['PHPMailer']['event_log']);

    $WriteMode = (!file_exists($phpMussel['Vault'] . $EventLog) || (
        $phpMussel['Config']['general']['truncate'] > 0 &&
        filesize($phpMussel['Vault'] . $EventLog) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
    )) ? 'w' : 'a';

    /** Build the path to the log and write it. */
    if ($phpMussel['BuildLogPath']($EventLog)) {
        $Handle = fopen($phpMussel['Vault'] . $EventLog, $WriteMode);
        fwrite($Handle, $Data);
        fclose($Handle);
        if ($WriteMode === 'w') {
            $phpMussel['LogRotation']($phpMussel['Config']['PHPMailer']['event_log']);
        }
        return true;
    }

    return false;
});
