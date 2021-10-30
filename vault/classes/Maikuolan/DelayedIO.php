<?php
/**
 * Delayed file IO class (last modified: 2021.10.30).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * Source: https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE", as well as the earliest iteration and deployment
 * of this class, COPYRIGHT 2019 and beyond by Caleb Mazalevskis (Maikuolan).
 */

namespace Maikuolan\Common;

class DelayedIO
{
    /**
     * @var array Old data for the files being read/written.
     */
    private $OldData = [];

    /**
     * @var array New data for the files being read/written.
     */
    private $NewData = [];

    /**
     * @var array Whether the files should be locked when read/written.
     */
    private $Locked = [];

    /**
     * @var int Size of each data block to read per iteration (131072 = 128KB).
     */
    public const BLOCKSIZE = 131072;

    /**
     * @var int How many seconds until an attempt to lock the handle should time-out.
     */
    public const LOCK_TIMEOUT = 5;

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    public const VERSION = '2.7.0';

    /**
     * All pending modified files are written at object destruction.
     *
     * @return void
     */
    public function __destruct()
    {
        foreach ($this->NewData as $File => $NewData) {
            if ($NewData === $this->OldData[$File]) {
                continue;
            }
            $Handle = fopen($File, 'wb');
            if (!is_resource($Handle)) {
                continue;
            }
            if ($this->Locked[$File]) {
                $Locked = false;
                $Time = time();
                while (!$Locked) {
                    $Locked = flock($Handle, $this->Locked[$File]);
                    if (!$Locked && (time() - $Time) >= self::LOCK_TIMEOUT) {
                        break;
                    }
                }
                if (!$Locked) {
                    fclose($Handle);
                    continue;
                }
            }
            fwrite($Handle, $NewData);
            fclose($Handle);
        }
    }

    /**
     * Read a file, or fetch from object memory if already read before.
     *
     * @param string $File The file to read.
     * @param int $Lock Lock mask for when attempting to read from the file.
     * @return string The file's content, or an empty string on failure.
     */
    public function readFile(string $File = '', int $Lock = 0): string
    {
        if ($File === '') {
            return '';
        }
        if (isset($this->NewData[$File])) {
            return $this->NewData[$File];
        }
        if (!is_file($File) || !is_readable($File) || !filesize($File)) {
            return '';
        }
        $Handle = fopen($File, 'rb');
        if (!is_resource($Handle)) {
            return '';
        }
        $Locked = false;
        if ($Lock) {
            $Time = time();
            while (!$Locked) {
                $Locked = flock($Handle, $Lock);
                if (!$Locked && (time() - $Time) >= self::LOCK_TIMEOUT) {
                    break;
                }
            }
            if (!$Locked) {
                fclose($Handle);
                return '';
            }
        }
        $Data = '';
        while (!feof($Handle)) {
            $Data .= fread($Handle, self::BLOCKSIZE);
        }
        if ($Locked) {
            $Time = time();
            $Unlocked = false;
            while (!$Unlocked) {
                $Unlocked = flock($Handle, LOCK_UN);
                if (!$Unlocked && (time() - $Time) >= self::LOCK_TIMEOUT) {
                    break;
                }
            }
        }
        fclose($Handle);
        $this->Locked[$File] = 0;
        return $this->NewData[$File] = $this->OldData[$File] = $Data;
    }

    /**
     * Prepare data to be written to a file.
     *
     * @param string $File The file/path to be written.
     * @param string $Data The data to be written.
     * @param int $Lock Lock mask for when attempting to write to the file.
     * @return bool True if the file/path is writable; False if not writable.
     */
    public function writeFile(string $File = '', string $Data = '', int $Lock = 0): bool
    {
        if (empty($File) || !is_writable($File)) {
            return false;
        }
        $this->NewData[$File] = $Data;
        $this->Locked[$File] = $Lock;
        if (!isset($this->OldData[$File])) {
            $this->OldData[$File] = '';
        }
        return true;
    }
}
