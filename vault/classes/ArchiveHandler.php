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
 * This file: Archive handler (last modified: 2018.10.13).
 */

namespace phpMussel\ArchiveHandler;

/**
 * Defines the methods that the archive handler expects should exist within all
 * archive handler classes. Anyone wanting to build new archive handler classes
 * or extend functionality should check this over.
 */
interface ArchiveHandlerInterface
{
    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     */
    public function EntryRead($Bytes = -1);

    /**
     * Return the compressed size of the entry at the current entry pointer.
     */
    public function EntryCompressedSize();

    /**
     * Return the actual size of the entry at the current entry pointer.
     */
    public function EntryActualSize();

    /**
     * Return the name of the entry at the current entry pointer.
     */
    public function EntryName();

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext();
}

/**
 * Defines common members that should be utilised by all archive handler
 * classes. Each member should be commented with its purpose and usage.
 */
abstract class ArchiveHandler implements ArchiveHandlerInterface
{
    /**
     * Object construct error state (to help us determine the reason, when
     * something goes wrong).
     *
     * -1: Object not constructed (default state; shouldn't normally be seen).
     * 0: Object constructed successfully. No problems, as far we as know.
     * 1: Necessary prerequisites/extensions aren't installed/available.
     * 2: Pointer isn't valid, isn't accessible, or failed to open/stream.
     */
    public $ErrorState = -1;
}

class ZipHandler extends ArchiveHandler
{
    /** Archive resource ID. */
    private $ArchiveResID = '';

    /** Archive entry resource ID. */
    private $EntryResID = '';

    /** Construct the Zip archive object. */
    public function __construct($Pointer)
    {
        /** Zip class requirements guard. */
        if (!function_exists('zip_open')) {
            $this->ErrorState = 1;
            return;
        }

        /** Bad pointer guard. */
        if (!is_readable($Pointer)) {
            $this->ErrorState = 2;
            return;
        }

        $this->ArchiveResID = zip_open($Pointer);
        $this->ErrorState = is_resource($this->ArchiveResID) ? 0 : 2;
    }

    /** Destruct the Zip archive object. */
    public function __destruct()
    {
        if (is_resource($this->ArchiveResID)) {
            zip_close($this->ArchiveResID);
        }
    }

    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     */
    public function EntryRead($Bytes = -1)
    {
        $Actual = $this->EntryActualSize();
        if ($Bytes < 0 || $Bytes > $Actual) {
            $Bytes = $Actual;
        }
        $Output = '';
        if ($Bytes > 0 && zip_entry_open($this->ArchiveResID, $this->EntryResID, 'rb')) {
            $Output = zip_entry_read($this->EntryResID, $Bytes);
            zip_entry_close($this->EntryResID);
        }
        return $Output;
    }

    /**
     * Return the compressed size of the entry at the current entry pointer.
     */
    public function EntryCompressedSize()
    {
        return is_resource($this->EntryResID) ? zip_entry_compressedsize($this->EntryResID) : false;
    }

    /**
     * Return the actual size of the entry at the current entry pointer.
     */
    public function EntryActualSize()
    {
        return is_resource($this->EntryResID) ? zip_entry_filesize($this->EntryResID) : false;
    }

    /**
     * Return the name of the entry at the current entry pointer.
     */
    public function EntryName()
    {
        return is_resource($this->EntryResID) ? zip_entry_name($this->EntryResID) : false;
    }

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext()
    {
        $this->EntryResID = zip_read($this->ArchiveResID);
        return is_resource($this->EntryResID);
    }
}

class TarHandler extends ArchiveHandler
{
    /** Archive seek offset. */
    private $Offset = 0;

    /** Total size of the archive. */
    private $TotalSize = 0;

    /** The actual archive content. */
    private $Data = '';

    /** Whether we've initialised an entry yet. */
    private $Initialised = false;

    /** Construct the Tar archive object. */
    public function __construct($Pointer)
    {
        /** Guard against wrong type of file used as pointer. */
        if (
            empty($Pointer) ||
            substr($Pointer, 257, 6) !== "ustar\x00"
        ) {
            $this->ErrorState = 2;
            return;
        }

        /** Set total size. */
        $this->TotalSize = strlen($Pointer);

        /** Set archive data. */
        $this->Data = $Pointer;

        /** All is good. */
        $this->ErrorState = 0;
    }

    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     */
    public function EntryRead($Bytes = -1)
    {
        $Actual = $this->EntryActualSize();
        if ($Bytes < 0 || $Bytes > $Actual) {
            $Bytes = $Actual;
        }
        return substr($this->Data, $this->Offset + 512, $Bytes);
    }

    /**
     * Return the compressed size of the entry at the current entry pointer.
     * Note: Tar doesn't compress, so in this case, it's the same as the uncompressed size.
     */
    public function EntryCompressedSize()
    {
        return octdec(preg_replace('/\D/', '', substr($this->Data, $this->Offset + 124, 12))) ?: 0;
    }

    /**
     * Return the actual size of the entry at the current entry pointer.
     */
    public function EntryActualSize()
    {
        return octdec(preg_replace('/\D/', '', substr($this->Data, $this->Offset + 124, 12))) ?: 0;
    }

    /**
     * Return the name of the entry at the current entry pointer.
     */
    public function EntryName()
    {
        return preg_replace('/[^\x20-\xff]/', '', substr($this->Data, $this->Offset, 100));
    }

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext()
    {
        if (($this->Offset + 1024) > $this->TotalSize) {
            return false;
        }
        if (!$this->Initialised) {
            $this->Initialised = true;
            return true;
        }
        $Actual = $this->EntryActualSize();
        $Blocks = $Actual > 0 ? ceil($Actual / 512) + 1 : 1;
        $this->Offset += $Blocks * 512;
        echo $this->Offset."\n";
        return true;
    }
}

class RarHandler extends ArchiveHandler
{
    /** The Rar object. */
    private $RarObject;

    /** Reference to the original pointer used. */
    private $PointerSelf;

    /** The current Rar entry. */
    private $RarEntry;

    /** A list of all Rar entries. */
    private $RarEntries;

    /** Construct the Rar archive object. */
    public function __construct($Pointer)
    {
        /** Rar extension requirements guard. */
        if (!class_exists('RarArchive') || !class_exists('RarEntry')) {
            $this->ErrorState = 1;
            return;
        }

        /** Bad pointer guard. */
        if (!is_readable($Pointer)) {
            $this->ErrorState = 2;
            return;
        }

        $this->RarObject = \RarArchive::open($Pointer);
        $this->ErrorState = is_object($this->RarObject) ? 0 : 2;
        $this->PointerSelf = $Pointer;
    }

    /** Destruct the Rar archive object. */
    public function __destruct()
    {
        if (is_object($this->RarObject)) {
            $this->RarObject->close();
        }
    }

    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     */
    public function EntryRead($Bytes = -1)
    {
        $Actual = $this->EntryActualSize();
        if ($Bytes < 0 || $Bytes > $Actual) {
            $Bytes = $Actual;
        }
        $Output = '';
        if ($Bytes > 0 && ($Stream = $this->RarEntry->getStream())) {
            $Output .= fread($Stream, $this->RarEntry->getUnpackedSize());
            fclose($Stream);
        }
        return $Output;
    }

    /**
     * Return the compressed size of the entry at the current entry pointer.
     */
    public function EntryCompressedSize()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->getPackedSize() : false;
    }

    /**
     * Return the actual size of the entry at the current entry pointer.
     */
    public function EntryActualSize()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->getUnpackedSize() : false;
    }

    /**
     * Return the name of the entry at the current entry pointer.
     */
    public function EntryName()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->getName() : false;
    }

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext()
    {
        if (!is_array($this->RarEntries)) {
            $this->RarEntries = scandir('rar://' . $this->PointerSelf);
        }
        if (is_array($this->RarEntries) && !empty($this->RarEntries)) {
            $this->RarEntry = $this->RarObject->getEntry(array_shift($this->RarEntries));
            return true;
        }
        return false;
    }
}
