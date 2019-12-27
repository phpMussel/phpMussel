<?php
/**
 * Delayed file IO class (last modified: 2019.12.26).
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
    /** Old data for the files being read/written. */
    private $OldData = [];

    /** New data for the files being read/written. */
    private $NewData = [];

    /** Whether the files should be locked when read/written. */
    private $Locked = [];

    /** Size of each data block to read per iteration (131072 = 128KB). */
    const BLOCKSIZE = 131072;

    /** How many seconds until an attempt to lock the handle should time-out. */
    const LOCK_TIMEOUT = 5;

    /**
     * Read a file, or fetch from object memory if already read before.
     *
     * @param string $File The file to read.
     * @param int $Lock Lock mask for when attempting to read from the file.
     * @return string The file's content, or an empty string on failure.
     */
    public function readFile($File = '', $Lock = 0)
    {
        if (empty($File) || !is_string($File) || !is_int($Lock)) {
            return '';
        }
        if (isset($this->NewData[$File])) {
            return $this->NewData[$File];
        }
        if (!is_file($File) || !is_readable($File) || !($Size = filesize($File))) {
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
        $Iterations = ceil($Size / self::BLOCKSIZE) ?: 0;
        $Data = '';
        $Current = 0;
        while ($Current < $Iterations) {
            $Data .= fread($Handle, self::BLOCKSIZE);
            $Current++;
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
    public function writeFile($File = '', $Data = '', $Lock = 0)
    {
        if (empty($File) || !is_string($File) || !is_writable($File) || !is_string($Data) || !is_int($Lock)) {
            return false;
        }
        $this->NewData[$File] = $Data;
        $this->Locked[$File] = $Lock;
        if (!isset($this->OldData[$File])) {
            $this->OldData[$File] = '';
        }
        return true;
    }

    /**
     * All pending modified files are written at object destruction.
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
}
