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
 * This file: Archive handler (last modified: 2020.11.19).
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
    public function EntryRead(int $Bytes = -1);

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
    public function EntryIsDirectory(): bool;

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted(): bool;

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
    public function EntryNext(): bool;
}

/**
 * Defines common members that should be utilised by all archive handler
 * classes. Each member should be commented with its purpose and usage.
 */
abstract class ArchiveHandler implements ArchiveHandlerInterface
{
    /**
     * @var int The instance's error state (in case something goes wrong).
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
    /**
     * @var \ZipArchive The zip object.
     */
    private $ZipObject;

    /**
     * @var int The number of files in the archive.
     */
    private $NumFiles = 0;

    /**
     * @var int The current entry index.
     */
    private $Index = -1;

    /**
     * @var array The current entry's attributes.
     */
    private $StatIndex = [];

    /**
     * Construct the zip archive object.
     *
     * @param string $Pointer
     */
    public function __construct($Pointer)
    {
        /** Zip class requirements guard. */
        if (!class_exists('\ZipArchive')) {
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
     * @return string The entry's content or an empty string.
     */
    public function EntryRead(int $Bytes = -1)
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
    public function EntryIsDirectory(): bool
    {
        return (!$this->EntryActualSize() && !$this->EntryCompressedSize() && substr($this->EntryName(), -1) === '/');
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted(): bool
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
    public function EntryNext(): bool
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
    /**
     * @var int Archive seek offset.
     */
    private $Offset = 0;

    /**
     * @var int The total size of the archive.
     */
    private $TotalSize = 0;

    /**
     * @var string The archive's actual content.
     */
    private $Data = '';

    /**
     * @var bool Whether we've initialised an entry yet.
     */
    private $Initialised = false;

    /**
     * Construct the tar archive object.
     *
     * @param string $File
     */
    public function __construct($File)
    {
        /** Guard against the wrong type of file being used as pointer. */
        if (substr($File, 257, 6) !== "ustar\0") {
            $this->ErrorState = 2;
            return;
        }

        /** Set total size. */
        $this->TotalSize = strlen($File);

        /** Set archive data. */
        $this->Data = $File;

        /** All is good. */
        $this->ErrorState = 0;
    }

    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     * @return string The entry's content or an empty string.
     */
    public function EntryRead(int $Bytes = -1)
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
    public function EntryIsDirectory(): bool
    {
        $Name = $this->EntryName();
        $Separator = substr($Name, -1, 1);
        return (($Separator === "\\" || $Separator === '/') && $this->EntryActualSize() === 0);
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return false Tar doesn't use encryption.
     */
    public function EntryIsEncrypted(): bool
    {
        return false;
    }

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     *
     * @return false Tar doesn't provide internal CRCs.
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
    public function EntryNext(): bool
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
    /**
     * @var \RarArchive The rar object.
     */
    private $RarObject;

    /**
     * @var string A copy of the original pointer used.
     */
    private $PointerSelf;

    /**
     * @var \RarEntry|false The current rar entry.
     */
    private $RarEntry;

    /**
     * @var array|false A list of all Rar entries.
     */
    private $RarEntries;

    /**
     * Construct the rar archive object.
     *
     * @param string $Pointer
     */
    public function __construct($Pointer)
    {
        /** Rar class requirements guard. */
        if (!class_exists('\RarArchive') || !class_exists('\RarEntry')) {
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
     * @return string The entry's content or an empty string.
     */
    public function EntryRead(int $Bytes = -1)
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
    public function EntryIsDirectory(): bool
    {
        return is_object($this->RarEntry) ? $this->RarEntry->isDirectory() : false;
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return bool True = Is encrypted. False = Isn't encrypted.
     */
    public function EntryIsEncrypted(): bool
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
    public function EntryNext(): bool
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

class PdfHandler extends ArchiveHandler
{
    /**
     * @var string The PDF format version used.
     */
    private $PDFVersion = '';

    /**
     * @var array The document's object tree.
     */
    private $Objects = [];

    /**
     * @var int The currently selected object (starts at -1).
     */
    private $Index = -1;

    /**
     * Needed to decode Ascii85 data (since PDF files sometimes use this).
     * This method adapted from the base85 class authored by Scott Baker.
     * @link https://bitbucket.org/scottchiefbaker/php-base85/src/master/
     * @license https://bitbucket.org/scottchiefbaker/php-base85/src/master/LICENSE GNU/GPLv3
     *
     * @param string $In The data to be decoded.
     * @return string The decoded data.
     */
    public function base85_decode(string $In): string
    {
        $In = str_replace(["\t", "\r", "\n", "\f", '/z/', '/y/'], ['', '', '', '', '!!!!!', '+<VdL/'], $In);
        $Len = strlen($In);
        $Padding = ($Len % 5 === 0) ? 0 : 5 - ($Len % 5);
        $In .= str_repeat('u', $Padding);
        $Num = 0;
        $Out = '';
        while ($Chunk = substr($In, $Num * 5, 5)) {
            $Char = 0;
            foreach (unpack('C*', $Chunk) as $ThisChar) {
                $Char *= 85;
                $Char += $ThisChar - 33;
            }
            $Out .= pack('N', $Char);
            $Num++;
        }
        return substr($Out, 0, strlen($Out) - $Padding);
    }

    /**
     * Construct the instance.
     *
     * @param string $File
     */
    public function __construct(string $File)
    {
        /** Guard against the wrong type of file being used as pointer. */
        if (substr($File, 0, 4) !== "\x25PDF") {
            $this->ErrorState = 2;
            return;
        }

        /** Determine format version. */
        if (substr($File, 4, 1) === '-' && ($EoL = strpos($File, "\n", 5)) !== false) {
            $this->PDFVersion = preg_replace('~[^\d\.]~', '', substr($File, 5, $EoL - 5));
        }

        /** Data offset for building the object tree. */
        $Offset = 0;

        /**
         * Since there's a high probability of errors occurring here due to the
         * risk of non-PDF files or bad data being supplied here, we'll
         * temporarily suppress those errors.
         */
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            return;
        });

        /** Building object tree. */
        $Tree = [];
        $Check = preg_match_all('~\n(\d+) (\d+) obj ?\r?\n(.+?) ?\r?\nendobj ?\r?\n~s', $File, $Matches);
        if ($Check && isset($Matches, $Matches[0], $Matches[0][0])) {
            $Count = count($Matches[0]);
            for ($Iterator = 0; $Iterator < $Count; $Iterator++) {
                $Tree[$Iterator] = [
                    'Object Number' => $Matches[1][$Iterator],
                    'Generation Number' => $Matches[2][$Iterator],
                    'Data' => $Matches[3][$Iterator]
                ];
                if (preg_match('~(.*)stream ?\r?\n(.+) ?\r?\nendstream~s', $Tree[$Iterator]['Data'], $SubMatches)) {
                    $Tree[$Iterator]['Stream'] = trim($SubMatches[2]);
                    $Tree[$Iterator]['Data'] = trim($SubMatches[1]);
                }
                if (preg_match('~<<\s*(.*)\s*>>~s', $Tree[$Iterator]['Data'], $SubMatches)) {
                    $Tree[$Iterator]['Data'] = $SubMatches[1];
                }
                $Params = [];
                $Offset = 0;
                while (($SPos = strpos($Tree[$Iterator]['Data'], '/', $Offset)) !== false) {
                    $Offset = $SPos + 1;
                    $NextSPos = strpos($Tree[$Iterator]['Data'], '/', $Offset);
                    foreach ([['[[', ']]'], ['{{', '}}'], ['((', '))'], ['<<', '>>']] as $Boundary) {
                        $BoundaryOpen = strpos($Tree[$Iterator]['Data'], $Boundary[0], $Offset);
                        $BoundaryWidth = strlen($Boundary[1]);
                        $BoundaryClose = strpos($Tree[$Iterator]['Data'], $Boundary[1], $Offset);
                        $BoundaryOffset = $BoundaryOpen + $BoundaryWidth;
                        while (
                            ($Working = substr($Tree[$Iterator]['Data'], $BoundaryOffset, $BoundaryClose - $BoundaryOffset)) &&
                            ($RPos = strpos($Working, $Boundary[0])) !== false &&
                            ($Try = strpos($Tree[$Iterator]['Data'], $Boundary[1], $BoundaryClose + $BoundaryWidth)) !== false
                        ) {
                            $BoundaryOffset += $RPos + $BoundaryWidth;
                            $BoundaryClose = $Try;
                        }
                        if (
                            $BoundaryOpen !== false &&
                            $BoundaryClose !== false &&
                            $BoundaryClose > $BoundaryOpen &&
                            ($NextSPos === false || (
                                $BoundaryOpen < $NextSPos &&
                                trim(substr($Tree[$Iterator]['Data'], $BoundaryClose + $BoundaryWidth, $NextSPos - $BoundaryClose - $BoundaryWidth)) === ''
                            )
                        )) {
                            $Label = trim(substr($Tree[$Iterator]['Data'], $Offset, $BoundaryOpen - $Offset));
                            $Property = trim(substr($Tree[$Iterator]['Data'], $BoundaryOpen + $BoundaryWidth, $BoundaryClose - $BoundaryOpen - $BoundaryWidth));
                            if (strlen($Label)) {
                                $Params[$Label] = $Property;
                            }
                            $Offset = $BoundaryClose + $BoundaryWidth;
                            continue 2;
                        }
                    }
                    foreach ([' '] as $Boundary) {
                        $BPos = strpos($Tree[$Iterator]['Data'], $Boundary, $Offset);
                        if ($BPos !== false) {
                            $Label = trim(substr($Tree[$Iterator]['Data'], $Offset, $BPos - $Offset));
                            if ($NextSPos === false) {
                                $Property = trim(substr($Tree[$Iterator]['Data'], $BPos + 1));
                                if (strlen($Label)) {
                                    $Params[$Label] = $Property;
                                }
                            } elseif ($BPos > $NextSPos) {
                                continue;
                            } else {
                                $Property = trim(substr($Tree[$Iterator]['Data'], $BPos + 1, $NextSPos - $BPos - 1));
                                if (strlen($Label)) {
                                    $Params[$Label] = $Property;
                                }
                            }
                            continue 2;
                        }
                    }
                    if ($NextSPos === false) {
                        $Label = trim(substr($Tree[$Iterator]['Data'], $Offset));
                        if (strlen($Label)) {
                            $Params[$Label] = '';
                        }
                        continue;
                    }
                    $Label = trim(substr($Tree[$Iterator]['Data'], $Offset, $NextSPos - $Offset));
                    if (strlen($Label)) {
                        $Params[$Label] = '';
                    }
                }
                $FirstEmpty = '';
                foreach ($Params as $ParamKey => $ParamValue) {
                    if ($ParamValue === '') {
                        if ($FirstEmpty === '') {
                            $FirstEmpty = $ParamKey;
                        } else {
                            $Params[$FirstEmpty] .= '/' . $ParamKey;
                            unset($Params[$ParamKey]);
                        }
                        continue;
                    } else {
                        $FirstEmpty = '';
                    }
                    while (true) {
                        $Changed = false;
                        foreach ([['[', ']'], ['{', '}'], ['((', ')'], ['<', '>']] as $Boundary) {
                            if (substr($ParamValue, 0, 1) === $Boundary[0] && substr($ParamValue, -1) === $Boundary[1]) {
                                $ParamValue = substr($ParamValue, 1, -1);
                                $Changed = true;
                            }
                        }
                        if ($Changed === false) {
                            break;
                        }
                    }
                    $Params[$ParamKey] = $ParamValue;
                }

                /**
                 * See: 7.4 Filters - Table 6 - Standard filters
                 * @link https://www.adobe.com/content/dam/acom/en/devnet/pdf/pdfs/PDF32000_2008.pdf
                 */
                if (!empty($Params['Filter']) && !empty($Tree[$Iterator]['Stream'])) {
                    while (true) {
                        $Changed = false;
                        if (substr($Params['Filter'], 0, 12) === '/FlateDecode') {
                            $Params['Filter'] = trim(substr($Params['Filter'], 12));
                            $Try = gzuncompress($Tree[$Iterator]['Stream']);
                            if ($Try !== false) {
                                $Tree[$Iterator]['Stream'] = $Try;
                                $Changed = true;
                            } else {
                                break;
                            }
                        }
                        if (substr($Params['Filter'], 0, 15) === '/ASCIIHexDecode') {
                            $Params['Filter'] = trim(substr($Params['Filter'], 15));
                            $Try = hex2bin(preg_replace('~[^a-f0-9]~i', '', $Tree[$Iterator]['Stream']));
                            if ($Try !== false) {
                                $Tree[$Iterator]['Stream'] = $Try;
                                $Changed = true;
                            } else {
                                break;
                            }
                        }
                        if (substr($Params['Filter'], 0, 14) === '/ASCII85Decode') {
                            $Params['Filter'] = trim(substr($Params['Filter'], 14));
                            $Tree[$Iterator]['Stream'] = $this->base85_decode($Tree[$Iterator]['Stream']);
                            $Changed = true;
                        }
                        if (substr($Params['Filter'], 0, 10) === '/LZWDecode') {
                            $Params['Filter'] = trim(substr($Params['Filter'], 10));
                            if (function_exists('lzf_decompress')) {
                                $Try = lzf_decompress($Tree[$Iterator]['Stream']);
                                if ($Try !== false) {
                                    $Tree[$Iterator]['Stream'] = $Try;
                                    $Changed = true;
                                } else {
                                    break;
                                }
                            }
                        }
                        if ($Changed === false) {
                            break;
                        }
                    }
                }

                /** Normalise types. */
                if (isset($Params['Type']) && strpos($Params['Type'], '#') !== false) {
                    while (($HPos = strpos($Params['Type'], '#')) !== false) {
                        $Bytes = substr($Params['Type'], $HPos + 1, 2);
                        $Len = strlen($Bytes);
                        if (!$Len || preg_match('/[^\da-f]/i', $Bytes) || ($Len % 2)) {
                            break;
                        }
                        $Params['Type'] = substr($Params['Type'], 0, $HPos) . chr(hexdec($Bytes)) . substr($Params['Type'], $HPos + 3);
                    }
                }

                $Tree[$Iterator]['Data'] = empty($Params) ? [] : $Params;
            }
        }

        /** Total objects. */
        $Counts = count($Tree);

        /** Build references. */
        for ($Iterator = 0; $Iterator < $Counts; $Iterator++) {
            if (isset($Tree[$Iterator]['Data']) && is_array($Tree[$Iterator]['Data'])) {
                foreach ($Tree[$Iterator]['Data'] as $ParamKey => $ParamValue) {
                    $Check = preg_match('~^(\d+) (\d+) R$~', $ParamValue, $Matches);
                    if ($Check) {
                        $Matches[1] = $Matches[1] - 1;
                        $Matches[2] = (int)$Matches[2];
                        if (
                            isset($Tree[$Matches[1]], $Tree[$Matches[1]]['Object Number'], $Tree[$Matches[1]]['Generation Number']) &&
                            $Matches[1] === ($Tree[$Matches[1]]['Object Number'] - 1) &&
                            $Matches[2] === (int)$Tree[$Matches[1]]['Generation Number']
                        ) {
                            if (
                                isset($Tree[$Matches[1]]['Data']['Type'], $Tree[$Matches[1]]['Data']['Count']) &&
                                $Tree[$Matches[1]]['Data']['Type'] === '/' . $ParamKey
                            ) {
                                $Tree[$Iterator]['Data'][$ParamKey] = &$Tree[$Matches[1]]['Data']['Count'];
                            } elseif (isset($Tree[$Matches[1]]['Data']['Length'], $Tree[$Matches[1]]['Stream'])) {
                                $Tree[$Iterator]['Data'][$ParamKey] = &$Tree[$Matches[1]]['Stream'];
                            }
                        }
                    }
                }
            }
        }

        /** Export scannables to final object tree. */
        for ($Iterator = 0; $Iterator < $Counts; $Iterator++) {
            if (isset($Tree[$Iterator]['Data']) && is_array($Tree[$Iterator]['Data'])) {
                if (
                    isset($Tree[$Iterator]['Data']['Type'], $Tree[$Iterator]['Stream']) &&
                    $Tree[$Iterator]['Data']['Type'] === '/EmbeddedFile'
                ) {
                    $Object = [];
                    if (isset($Tree[$Iterator]['Data']['Length'])) {
                        $Object['EntryCompressedSize'] = (int)$Tree[$Iterator]['Data']['Length'];
                    }
                    $Object['EntryActualSize'] = strlen($Tree[$Iterator]['Stream']);
                    $Object['Data'] = $Tree[$Iterator]['Stream'];
                    $this->Objects[] = $Object;
                }
            }
        }

        /** Restore the previous error handler. */
        restore_error_handler();

        /** All is good. */
        $this->ErrorState = 0;
    }

    /**
     * Return the actual entry in the archive at the current entry pointer.
     *
     * @param int $Bytes Optionally, how many bytes to read from the entry.
     * @return string The entry's content or an empty string.
     */
    public function EntryRead(int $Bytes = -1): string
    {
        if ($Bytes > -1) {
            return isset($this->Objects[$this->Index]['Data']) ? substr($this->Objects[$this->Index]['Data'], 0, $Bytes) : '';
        }
        return $this->Objects[$this->Index]['Data'] ?? '';
    }

    /**
     * Return the compressed size of the entry at the current entry pointer.
     *
     * @return int
     */
    public function EntryCompressedSize(): int
    {
        return $this->Objects[$this->Index]['EntryCompressedSize'] ?? 0;
    }

    /**
     * Return the actual size of the entry at the current entry pointer.
     *
     * @return int
     */
    public function EntryActualSize(): int
    {
        return $this->Objects[$this->Index]['EntryActualSize'] ?? 0;
    }

    /**
     * Return whether the entry at the current entry pointer is a directory.
     *
     * @return false Embedded files aren't directories.
     */
    public function EntryIsDirectory(): bool
    {
        return false;
    }

    /**
     * Return whether the entry at the current entry pointer is encrypted.
     *
     * @return false Pdf encrypts at the document level, not per individual embed.
     */
    public function EntryIsEncrypted(): bool
    {
        return false;
    }

    /**
     * Return the reported internal CRC hash for the entry, if it exists.
     *
     * @return false Pdf doesn't provide internal CRCs.
     */
    public function EntryCRC(): bool
    {
        return false;
    }

    /**
     * Return the name of the entry at the current entry pointer.
     *
     * @return string
     */
    public function EntryName(): string
    {
        return $this->Objects[$this->Index]['EntryName'] ?? 'PDFStream';
    }

    /**
     * Move the entry pointer ahead.
     *
     * @return bool False if there aren't any more entries.
     */
    public function EntryNext(): bool
    {
        $this->Index++;
        return isset($this->Objects[$this->Index]);
    }
}
