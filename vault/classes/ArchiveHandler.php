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
 * This file: Archive handler (last modified: 2019.08.06).
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
     * Return whether the entry at the current entry pointer is a directory.
     *
     * @return bool True = Is a directory. False = Isn't a directory.
     */
    public function EntryIsDirectory();

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted();

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     */
    public function EntryCRC();

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
     * 0: Object constructed successfully. No problems, as far as we know.
     * 1: Necessary prerequisites/extensions aren't installed/available.
     * 2: Pointer isn't valid, isn't accessible, or failed to open/stream.
     */
    public $ErrorState = -1;
}

class ZipHandler extends ArchiveHandler
{
    /** The Zip object. */
    private $ZipObject;

    /** Number of files in the archive. */
    private $NumFiles = 0;

    /** Current entry index. */
    private $Index = -1;

    /** Current entry attributes. */
    private $StatIndex = [];

    /** Construct the Zip archive object. */
    public function __construct($Pointer)
    {
        /** Zip class requirements guard. */
        if (!class_exists('ZipArchive')) {
            $this->ErrorState = 1;
            return;
        }

        /** Bad pointer guard. */
        if (!is_readable($Pointer)) {
            $this->ErrorState = 2;
            return;
        }

        $this->ZipObject = new \ZipArchive;
        if (!$this->ZipObject->open($Pointer)) {
            $this->ErrorState = 2;
            return;
        }
        $this->ErrorState = is_object($this->ZipObject) ? 0 : 2;
        $this->NumFiles = $this->ZipObject->numFiles;
    }

    /** Destruct the Zip archive object. */
    public function __destruct()
    {
        if (is_object($this->ZipObject) && $this->ErrorState === 0) {
            $this->ZipObject->close();
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
        return $Bytes > 0 ? $this->ZipObject->getFromIndex($this->Index, $Bytes) : '';
    }

    /**
     * Return the compressed size of the entry at the current entry pointer.
     */
    public function EntryCompressedSize()
    {
        return isset($this->StatIndex['comp_size']) ? $this->StatIndex['comp_size'] : 0;
    }

    /**
     * Return the actual size of the entry at the current entry pointer.
     */
    public function EntryActualSize()
    {
        return isset($this->StatIndex['size']) ? $this->StatIndex['size'] : 0;
    }

    /**
     * Return whether the entry at the current entry pointer is a directory.
     *
     * @return bool True = Is a directory. False = Isn't a directory.
     */
    public function EntryIsDirectory()
    {
        return (!$this->EntryActualSize() && !$this->EntryCompressedSize() && substr($this->EntryName, -1) === '/');
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted()
    {
        return !empty($this->StatIndex['encryption_method']);
    }

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     */
    public function EntryCRC()
    {
        return (isset($this->StatIndex['crc']) && is_int($this->StatIndex['crc'])) ? dechex($this->StatIndex['crc']) : false;
    }

    /**
     * Return the name of the entry at the current entry pointer.
     */
    public function EntryName()
    {
        return isset($this->StatIndex['name']) ? $this->StatIndex['name'] : '';
    }

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext()
    {
        $this->Index++;
        if ($this->Index < $this->NumFiles) {
            $this->StatIndex = $this->ZipObject->statIndex($this->Index);
            return true;
        }
        return false;
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
        if (empty($Pointer) || substr($Pointer, 257, 6) !== "ustar\x00") {
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
     * Return whether the entry at the current entry pointer is a directory.
     *
     * @return bool True = Is a directory. False = Isn't a directory.
     */
    public function EntryIsDirectory()
    {
        $Name = $this->EntryName();
        return ((substr($Name, -1, 1) === "\\" || substr($Name, -1, 1) === '/') && $this->EntryActualSize === 0);
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool Tar doesn't use encryption, therefore always false.
     */
    public function EntryIsEncrypted()
    {
        return false;
    }

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     */
    public function EntryCRC()
    {
        return false;
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
            return ($this->Initialised = true);
        }
        $Actual = $this->EntryActualSize();
        $Blocks = $Actual > 0 ? ceil($Actual / 512) + 1 : 1;
        $this->Offset += $Blocks * 512;
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
        /** Rar class requirements guard. */
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
        if (is_object($this->RarObject) && $this->ErrorState === 0) {
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
     * Return whether the entry at the current entry pointer is a directory.
     *
     * @return bool True = Is a directory. False = Isn't a directory.
     */
    public function EntryIsDirectory()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->isDirectory() : false;
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->isEncrypted() : false;
    }

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     */
    public function EntryCRC()
    {
        return is_object($this->RarEntry) ? $this->RarEntry->getCrc() : false;
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
