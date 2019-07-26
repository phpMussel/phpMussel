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
 * This file: Functions file (last modified: 2019.07.24).
 */

/**
 * Extends compatibility with phpMussel to PHP 5.4.x by introducing some simple
 * polyfills for functions introduced with newer versions of PHP.
 */
if (substr(PHP_VERSION, 0, 4) === '5.4.') {
    require $phpMussel['Vault'] . 'php5.4.x.php';
}

/** Autoloader for phpMussel classes. */
spl_autoload_register(function ($Class) {
    $Vendor = (($Pos = strpos($Class, "\\", 1)) === false) ? '' : substr($Class, 0, $Pos);
    $File = __DIR__ . '/classes/' . ((!$Vendor || $Vendor === 'phpMussel') ? '' : $Vendor . '/') . (
        (($Pos = strrpos($Class, "\\")) === false) ? $Class : substr($Class, $Pos + 1)
    ) . '.php';
    if (is_readable($File)) {
        require $File;
    }
});

/** Instantiate YAML object for accessing data reconstruction and processing various YAML files. */
$phpMussel['YAML'] = new \Maikuolan\Common\YAML();

/**
 * Registers plugin closures/functions to their intended hooks.
 *
 * @param string $What The name of the closure/function to execute.
 * @param string $Where Where to execute it (the designated "plugin hook").
 * @return bool Execution failed(false)/succeeded(true).
 */
$phpMussel['Register_Hook'] = function ($What, $Where) use (&$phpMussel) {
    if (!isset($phpMussel['MusselPlugins']['hooks'], $phpMussel['MusselPlugins']['closures']) || !$What || !$Where) {
        return false;
    }
    if (!isset($phpMussel['MusselPlugins']['hooks'][$Where])) {
        $phpMussel['MusselPlugins']['hooks'][$Where] = [];
    }
    $phpMussel['MusselPlugins']['hooks'][$Where][] = $What;
    if (!function_exists($What) && isset($GLOBALS[$What]) && is_object($GLOBALS[$What])) {
        $phpMussel['MusselPlugins']['closures'][] = $What;
    }
    return true;
};

/**
 * Executes plugin closures/functions.
 *
 * @param string $HookID Where to execute it (the designated "plugin hook").
 * @return bool Execution failed(false)/succeeded(true).
 */
$phpMussel['Execute_Hook'] = function ($HookID) use (&$phpMussel) {
    if (!isset($phpMussel['MusselPlugins']['hooks'][$HookID])) {
        return false;
    }
    foreach ($phpMussel['MusselPlugins']['hooks'][$HookID] as $Registered) {
        if (isset($GLOBALS[$Registered]) && is_object($GLOBALS[$Registered])) {
            $GLOBALS[$Registered]();
        } elseif (function_exists($Registered)) {
            call_user_func($Registered);
        }
    }
    return true;
};

/**
 * Replaces encapsulated substrings within a string using the values of the
 * corresponding elements within an array.
 *
 * @param array $Needle An array containing replacement values.
 * @param string $Haystack The string to work with.
 * @return string The string with its encapsulated substrings replaced.
 */
$phpMussel['ParseVars'] = function (array $Needle, $Haystack) {
    if (empty($Haystack)) {
        return '';
    }
    array_walk($Needle, function ($Value, $Key) use (&$Haystack) {
        if (!is_array($Value)) {
            $Haystack = str_replace('{' . $Key . '}', $Value, $Haystack);
        }
    });
    return $Haystack;
};

/**
 * Implodes multidimensional arrays.
 *
 * @param array $Arr An array to implode.
 * @return string The imploded array.
 */
$phpMussel['implode_md'] = function (array $Arr) use (&$phpMussel) {
    foreach ($Arr as &$Key) {
        if (is_array($Key)) {
            $Key = $phpMussel['implode_md']($Key);
        }
    }
    return implode($Arr);
};

/**
 * Does some simple decoding work on strings.
 *
 * @param string $str The string to be decoded.
 * @return string The decoded string.
 */
$phpMussel['prescan_decode'] = function ($str) use (&$phpMussel) {
    $nstr = html_entity_decode(urldecode(str_ireplace('&amp;#', '&#', str_ireplace('&amp;amp;', '&amp;', $str))));
    if ($nstr !== $str) {
        $nstr = $phpMussel['prescan_decode']($nstr);
    }
    return $nstr;
};

/**
 * Some simple obfuscation for potentially blocked functions; We need this to
 * avoid triggering false positives for some potentially overzealous
 * server-based security solutions that would usually flag this file as
 * malicious when they detect it containing the names of suspect functions.
 *
 * @param string $n An alias for the function that we want to call.
 * @param string $str Some data to parse to the function being called.
 * @return string The parsed data and/or decoded string (if $str is empty, the
 *      the resolved alias will be returned instead).
 */
$phpMussel['Function'] = function ($n, $str = '') {
    static $x = 'abcdefghilnorstxz12346_';
    $fList = [
        'GZ' =>
            $x[6] . $x[16] . $x[8] . $x[10] . $x[5] . $x[9] . $x[0] . $x[14] . $x[4],
        'R13' =>
            $x[13] . $x[14] . $x[12] . $x[22] . $x[12] . $x[11] . $x[14] . $x[17] . $x[19],
        'B64' =>
            $x[1] . $x[0] . $x[13] . $x[4] . $x[21] . $x[20] . $x[22] . $x[3] . $x[4] . $x[2] . $x[11] . $x[3] . $x[4],
        'HEX' =>
            $x[7] . $x[4] . $x[15] . $x[18] . $x[1] . $x[8] . $x[10]
    ];
    if (!isset($fList[$n])) {
        return '';
    }
    if (!$str || !function_exists($fList[$n])) {
        return $fList[$n];
    }
    try {
        $Return = $fList[$n]($str);
    } catch (\Exception $e) {
        $Return = '';
    }
    return $Return;
};

/**
 * Does some more complex decoding and normalisation work on strings.
 *
 * @param string $str The string to be decoded/normalised.
 * @param bool $html If true, "style" and "script" tags will be stripped from
 *      the input string (optional; defaults to false).
 * @param bool $decode If false, the input string will be normalised, but not
 *      decoded; If true, the input string will be normalised *and* decoded.
 *      Optional; Defaults to false.
 * @return string The decoded/normalised string.
 */
$phpMussel['prescan_normalise'] = function ($str, $html = false, $decode = false) use (&$phpMussel) {
    $ostr = '';
    if ($decode) {
        $ostr .= $str;
        while (true) {
            if (function_exists($phpMussel['Function']('GZ'))) {
                if ($c = preg_match_all(
                    '/(' . $phpMussel['Function']('GZ') . '\s*\(\s*["\'])(.{1,4096})(,\d)?(["\']\s*\))/i',
                $str, $matches)) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . $phpMussel['Function']('GZ', $phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i]), $matches[4][$i])) . '"',
                            $str
                        );
                    }
                    continue;
                }
            }
            if ($c = preg_match_all(
                '/(' . $phpMussel['Function']('B64') . '|decode_base64|base64\.b64decode|atob|Base64\.decode64)(\s*' .
                '\(\s*["\'\`])([\da-z+\/]{4})*([\da-z+\/]{4}|[\da-z+\/]{3}=|[\da-z+\/]{2}==)(["\'\`]' .
                '\s*\))/i',
            $str, $matches)) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . $phpMussel['Function']('B64', $phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i] . $matches[2][$i]), $matches[5][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(' . $phpMussel['Function']('R13') . '\s*\(\s*["\'])([^\'"\(\)]{1,4096})(["\']\s*\))/i',
            $str, $matches)) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . $phpMussel['Function']('R13', $phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(' . $phpMussel['Function']('HEX') . '\s*\(\s*["\'])([\da-f]{1,4096})(["\']\s*\))/i',
            $str, $matches )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . $phpMussel['HexSafe']($phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/([Uu][Nn][Pp][Aa][Cc][Kk]\s*\(\s*["\']\s*H\*\s*["\']\s*,\s*["\'])([\da-fA-F]{1,4096})(["\']\s*\))/',
            $str, $matches)) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_replace($matches[0][$i], '"' . $phpMussel['HexSafe']($phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"', $str);
                }
                continue;
            }
            break;
        }
    }
    $str = preg_replace('/[^\x21-\x7e]/', '', strtolower($phpMussel['prescan_decode']($str . $ostr)));
    unset($ostr);
    if ($html) {
        $str = preg_replace([
            '@<script[^>]*?>.*?</script>@si',
            '@<[\/\!]*?[^<>]*?>@si',
            '@<style[^>]*?>.*?</style>@siU',
            '@<![\s\S]*?--[ \t\n\r]*>@'
        ], '', $str);
    }
    return trim($str);
};

/**
 * Gets substring from haystack prior to the first occurrence of needle.
 *
 * @param string $h The haystack.
 * @param string $n The needle.
 * @return string The substring.
 */
$phpMussel['substrbf'] = function ($h, $n) {
    return !$n ? '' : substr($h, 0, strpos($h, $n));
};

/**
 * Gets substring from haystack after the first occurrence of needle.
 *
 * @param string $h The haystack.
 * @param string $n The needle.
 * @return string The substring.
 */
$phpMussel['substraf'] = function ($h, $n) {
    return !$n ? '' : substr($h, strpos($h, $n) + strlen($n));
};

/**
 * Gets substring from haystack prior to the last occurrence of needle.
 *
 * @param string $h The haystack.
 * @param string $n The needle.
 * @return string The substring.
 */
$phpMussel['substrbl'] = function ($h, $n) {
    return !$n ? '' : substr($h, 0, strrpos($h, $n));
};

/**
 * Gets substring from haystack after the last occurrence of needle.
 *
 * @param string $h The haystack.
 * @param string $n The needle.
 * @return string The substring.
 */
$phpMussel['substral'] = function ($h, $n) {
    return !$n ? '' : substr($h, strrpos($h, $n) + strlen($n));
};

/**
 * This function reads files and returns the contents of those files.
 *
 * @param string $File Path and filename of the file to read.
 * @param int $s Number of blocks to read from the file (optional; can be
 *      manually specified, but it's best to just ignore it and let the
 *      function work it out for itself).
 * @param bool $PreChecked When false, checks that the file exists and is
 *      writable. Defaults to false.
 * @param int $Blocks The total size of a single block in kilobytes (optional;
 *      defaults to 128, i.e., 128KB or 131072 bytes). This can be modified by
 *      developers as per their individual needs. Generally, a smaller value
 *      will increase stability but decrease performance, whereas a larger
 *      value will increase performance but decrease stability.
 * @return string|bool Content of the file returned by the function (or false
 *      on failure).
 */
$phpMussel['ReadFile'] = function ($File, $Size = 0, $PreChecked = false, $Blocks = 128) {
    if (!$PreChecked && (!is_file($File) || !is_readable($File))) {
        return false;
    }
    /** Blocksize to bytes. */
    $Blocksize = $Blocks * 1024;
    $Filesize = filesize($File);
    if (!$Size) {
        $Size = ($Filesize && $Blocksize) ? ceil($Filesize / $Blocksize) : 0;
    }
    $Data = '';
    if ($Size > 0) {
        $Handle = fopen($File, 'rb');
        $r = 0;
        while ($r < $Size) {
            $Data .= fread($Handle, $Blocksize);
            $r++;
        }
        fclose($Handle);
    }
    return $Data ?: false;
};

/**
 * A very simple wrapper for file() that checks for the existence of files
 * before attempting to read them, in order to avoid warnings about
 * non-existent files.
 *
 * @param string $Filename Refer to the description for file().
 * @param int $Flags Refer to the description for file().
 * @param resource $Context Refer to the description for file().
 * @return array|bool Same as with file(), but won't trigger warnings.
 */
$phpMussel['ReadFileAsArray'] = function ($Filename, $Flags = 0, $Context = null) {
    if (!is_readable($Filename)) {
        return false;
    }
    if (!is_resource($Context)) {
        return !$Flags ? file($Filename) : file($Filename, $Flags);
    }
    return file($Filename, $Flags, $Context);
};

/**
 * Deletes expired cache entries and regenerates cache files.
 *
 * @param string $Delete Forcibly delete a specific cache entry (optional).
 * @return bool Operation succeeded (true) or failed (false).
 */
$phpMussel['CleanCache'] = function ($Delete = '') use (&$phpMussel) {
    if (!empty($phpMussel['InstanceCache']['CacheCleaned'])) {
        return true;
    }
    $phpMussel['InstanceCache']['CacheCleaned'] = true;
    $CacheFiles = [];
    $FileIndex = $phpMussel['cachePath'] . 'index.dat';
    if (!is_readable($FileIndex)) {
        return false;
    }
    $FileDataOld = $FileData = $phpMussel['ReadFile']($FileIndex);
    if (strpos($FileData, ';') !== false) {
        $FileData = explode(';', $FileData);
        foreach ($FileData as &$ThisData) {
            if (strpos($ThisData, ':') === false) {
                $ThisData = '';
                continue;
            }
            $ThisData = explode(':', $ThisData, 3);
            if (($Delete && $Delete === $ThisData[0]) || ($ThisData[1] > 0 && $phpMussel['Time'] > $ThisData[1])) {
                $FileKey = bin2hex(substr($ThisData[0], 0, 1));
                if (!isset($CacheFiles[$FileKey])) {
                    $CacheFiles[$FileKey] = !is_readable(
                        $phpMussel['cachePath'] . $FileKey . '.tmp'
                    ) ? '' : $phpMussel['ReadFile']($phpMussel['cachePath'] . $FileKey . '.tmp', 0, true);
                }
                while (strpos($CacheFiles[$FileKey], $ThisData[0] . ':') !== false) {
                    $CacheFiles[$FileKey] = str_ireplace($ThisData[0] . ':' . $phpMussel['substrbf'](
                        $phpMussel['substraf']($CacheFiles[$FileKey], $ThisData[0] . ':'), ';'
                    ) . ';', '', $CacheFiles[$FileKey]);
                }
                $ThisData = '';
                continue;
            }
            $ThisData = $ThisData[0] . ':' . $ThisData[1];
        }
        $FileData = str_replace(';;', ';', implode(';', array_filter($FileData)) . ';');
        if ($FileDataOld !== $FileData) {
            $Handle = fopen($FileIndex, 'w');
            fwrite($Handle, $FileData);
            fclose($Handle);
        }
    }
    foreach ($CacheFiles as $CacheEntryKey => $CacheEntryValue) {
        if (strlen($CacheEntryValue) < 2) {
            if (file_exists($phpMussel['cachePath'] . $CacheEntryKey . '.tmp')) {
                unlink($phpMussel['cachePath'] . $CacheEntryKey . '.tmp');
            }
            continue;
        }
        $Handle = fopen($phpMussel['cachePath'] . $CacheEntryKey . '.tmp', 'w');
        fwrite($Handle, $CacheEntryValue);
        fclose($Handle);
    }
    return true;
};

/**
 * Retrieves cache entries.
 *
 * @param string|array $Entry The name of the cache entry/entries to retrieve;
 *      Can be a string to specify a single entry, or an array of strings to
 *      specify multiple entries.
 * @return string|array Contents of the cache entry/entries.
 */
$phpMussel['FetchCache'] = function ($Entry = '') use (&$phpMussel) {
    $phpMussel['CleanCache']();
    $phpMussel['InitialiseCache']();

    /** Override if using a different preferred caching mechanism. */
    if ($phpMussel['Cache']->Using) {
        if (is_array($Entry)) {
            $Out = [];
            foreach ($Entry as $ThisKey => $ThisEntry) {
                $Out[$ThisKey] = $phpMussel['Cache']->getEntry($ThisEntry);
            }
            return $Out;
        }
        return $phpMussel['Cache']->getEntry($Entry);
    }

    /** Default process. */
    if (!$Entry) {
        return '';
    }
    if (is_array($Entry)) {
        $Out = [];
        array_walk($Entry, function ($Value, $Key) use (&$phpMussel, &$Out) {
            $Out[$Key] = $phpMussel['FetchCache']($Value);
        });
        return $Out;
    }
    $File = $phpMussel['cachePath'] . bin2hex(substr($Entry, 0, 1)) . '.tmp';
    if (!is_readable($File) || !$FileData = $phpMussel['ReadFile']($File, 0, true)) {
        return '';
    }
    if (!$Item = strpos($FileData, $Entry . ':') !== false ? $Entry . ':' . $phpMussel['substrbf'](
        $phpMussel['substraf']($FileData, $Entry . ':'), ';'
    ) . ';' : '') {
        return '';
    }
    $Expiry = $phpMussel['substrbf']($phpMussel['substraf']($Item, $Entry . ':'), ':');
    if ($Expiry > 0 && $phpMussel['Time'] > $Expiry) {
        while (strpos($FileData, $Entry . ':') !== false) {
            $FileData = str_ireplace($Item, '', $FileData);
        }
        $Handle = fopen($File, 'w');
        fwrite($Handle, $FileData);
        fclose($Handle);
        return '';
    }
    if (!$ItemData = $phpMussel['substrbf']($phpMussel['substraf']($Item, $Entry . ':' . $Expiry . ':'), ';')) {
        return '';
    }
    return $phpMussel['Function']('GZ', $phpMussel['HexSafe']($ItemData)) ?: '';
};

/**
 * Creates cache entry and saves it to the cache.
 *
 * @param string $Entry Name of the cache entry to create.
 * @param int $Expiry Unix time until the cache entry expires.
 * @param string $ItemData Contents of the cache entry.
 * @return bool This should always return true, unless something goes wrong.
 */
$phpMussel['SaveCache'] = function ($Entry = '', $Expiry = 0, $ItemData = '') use (&$phpMussel) {
    $phpMussel['CleanCache']();
    $phpMussel['InitialiseCache']();

    /** Override if using a different preferred caching mechanism. */
    if ($phpMussel['Cache']->Using) {
        if ($Expiry <= 0) {
            $Expiry = 0;
        } elseif ($Expiry > $phpMussel['Time']) {
            $Expiry = $Expiry - $phpMussel['Time'];
        }
        return $phpMussel['Cache']->setEntry($Entry, $ItemData, $Expiry);
    }

    /** Default process. */
    if (!$Entry || !$ItemData) {
        return false;
    }
    if (!$Expiry) {
        $Expiry = $phpMussel['Time'];
    }
    $File = $phpMussel['cachePath'] . bin2hex($Entry[0]) . '.tmp';
    $Data = $phpMussel['ReadFile']($File) ?: '';
    while (strpos($Data, $Entry . ':') !== false) {
        $Data = str_ireplace($Entry . ':' . $phpMussel['substrbf']($phpMussel['substraf']($Data, $Entry . ':'), ';') . ';', '', $Data);
    }
    $Data .= $Entry . ':' . $Expiry . ':' . bin2hex(gzdeflate($ItemData,9)) . ';';
    $Handle = fopen($File, 'w');
    fwrite($Handle, $Data);
    fclose($Handle);
    $IndexFile = $phpMussel['cachePath'] . 'index.dat';
    $IndexNewData = $IndexData = $phpMussel['ReadFile']($IndexFile) ?: '';
    while (strpos($IndexNewData, $Entry . ':') !== false) {
        $IndexNewData = str_ireplace($Entry . ':' . $phpMussel['substrbf']($phpMussel['substraf']($IndexNewData, $Entry . ':'), ';') . ';', '', $IndexNewData);
    }
    $IndexNewData .= $Entry . ':' . $Expiry . ';';
    if ($IndexNewData !== $IndexData) {
        $IndexHandle = fopen($IndexFile, 'w');
        fwrite($IndexHandle, $IndexNewData);
        fclose($IndexHandle);
    }
    return true;
};

/** Reads and prepares cached hash data. */
$phpMussel['PrepareHashCache'] = function () use (&$phpMussel) {
    if (!isset($phpMussel['HashCache'])) {
        $phpMussel['HashCache'] = [];
    }
    if ($phpMussel['HashCache']['Data'] = (
        $phpMussel['Config']['general']['scan_cache_expiry'] > 0
    ) ? $phpMussel['FetchCache']('HashCache') : '') {
        $phpMussel['HashCache']['Data'] = explode(';', $phpMussel['HashCache']['Data']);
        $Build = [];
        foreach ($phpMussel['HashCache']['Data'] as $CacheItem) {
            if (strpos($CacheItem, ':') !== false) {
                $CacheItem = explode(':', $CacheItem, 4);
                if ($CacheItem[1] > $phpMussel['Time']) {
                    $Build[$CacheItem[0]] = $CacheItem;
                }
            }
        }
        $phpMussel['HashCache']['Data'] = $Build;
    }
};

/**
 * Quarantines file uploads by using a key generated from your quarantine key
 * to bitshift the input string (the file uploads), appending a header with an
 * explanation of what the bitshifted data is, along with an MD5 hash checksum
 * of its non-quarantined counterpart, and then saves it all to a QFU file,
 * storing these QFU files in your quarantine directory.
 *
 * This isn't hardcore encryption, but it should be sufficient to prevent
 * accidental execution of quarantined files and to allow safe handling of
 * those files, which is the whole point of quarantining them in the first
 * place. Improvements might be made in the future.
 *
 * @param string $In The input string (the file upload / source data).
 * @param string $Key Your quarantine key.
 * @param string $IP Data origin (usually, the IP address of the uploader).
 * @param string $ID The QFU filename to use (calculated beforehand).
 * @return bool This should always return true, unless something goes wrong.
 */
$phpMussel['Quarantine'] = function ($In, $Key, $IP, $ID) use (&$phpMussel) {
    if (!$In || !$Key || !$IP || !$ID || !function_exists('gzdeflate') || (
        strlen($Key) < 128 &&
        !$Key = $phpMussel['HexSafe'](hash('sha512', $Key) . hash('whirlpool', $Key))
    )) {
        return false;
    }
    if ($phpMussel['Config']['legal']['pseudonymise_ip_addresses']) {
        $IP = $phpMussel['Pseudonymise-IP']($IP);
    }
    $k = strlen($Key);
    $FileSize = strlen($In);
    $Head = "\xa1phpMussel\x21" . $phpMussel['HexSafe'](md5($In)) . pack('l*', $FileSize) . "\x01";
    $In = gzdeflate($In, 9);
    $Out = '';
    $i = 0;
    while ($i < $FileSize) {
        for ($j = 0; $j < $k; $j++, $i++) {
            if (strlen($Out) >= $FileSize) {
                break 2;
            }
            $L = substr($In, $i, 1);
            $R = substr($Key, $j, 1);
            $Out .= ($L === false ? "\x00" : $L) ^ ($R === false ? "\x00" : $R);
        }
    }
    $Out =
        "\x2f\x3d\x3d\x20phpMussel\x20Quarantined\x20File\x20Upload\x20\x3d" .
        "\x3d\x5c\n\x7c\x20Time\x2fDate\x20Uploaded\x3a\x20" .
        str_pad($phpMussel['Time'], 18, ' ') .
        "\x7c\n\x7c\x20Uploaded\x20From\x3a\x20" . str_pad($IP, 22, ' ') .
        "\x20\x7c\n\x5c" . str_repeat("\x3d", 39) . "\x2f\n\n\n" . $Head . $Out;
    $UsedMemory = $phpMussel['MemoryUse']($phpMussel['qfuPath']);
    $UsedMemory['Size'] += strlen($Out);
    $UsedMemory['Count']++;
    if ($DeductBytes = $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_usage'])) {
        $DeductBytes = $UsedMemory['Size'] - $DeductBytes;
        $DeductBytes = ($DeductBytes > 0) ? $DeductBytes : 0;
    }
    if ($DeductFiles = $phpMussel['Config']['general']['quarantine_max_files']) {
        $DeductFiles = $UsedMemory['Count'] - $DeductFiles;
        $DeductFiles = ($DeductFiles > 0) ? $DeductFiles : 0;
    }
    if ($DeductBytes > 0 || $DeductFiles > 0) {
        $UsedMemory = $phpMussel['MemoryUse']($phpMussel['qfuPath'], $DeductBytes, $DeductFiles);
    }
    $Handle = fopen($phpMussel['qfuPath'] . $ID . '.qfu', 'a');
    fwrite($Handle, $Out);
    fclose($Handle);
    if (!$phpMussel['EOF']) {
        $phpMussel['Stats-Increment']('Web-Quarantined', 1);
    }
    return true;
};

/**
 * Calculates the total memory used by a directory, and optionally enforces
 * memory usage and number of files limits on that directory. Should be
 * regarded as part of the phpMussel quarantine functionality.
 *
 * @param string $Path The path of the directory to be checked.
 * @param int $Delete How many bytes to delete from the target directory; Omit
 *      or set to 0 to avoid deleting files on the basis of total bytes.
 * @param int $DeleteFiles How many files to delete from the target directory;
        Omit or set to 0 to avoid deleting files.
 * @return array Contains two integer elements: `Size`: The actual, total
 *      memory used by the target directory. `Count`: The total number of files
 *      found in the target directory by the time of closure exit.
 */
$phpMussel['MemoryUse'] = function ($Path, $Delete = 0, $DeleteFiles = 0) {
    $Offset = strlen($Path);
    $Files = [];
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Path), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        $File = str_replace("\\", '/', substr($Item, $Offset));
        if ($File && preg_match('~\.qfu$~i', $Item) && is_file($Item) && !is_link($Item) && is_readable($Item)) {
            $Files[$File] = filemtime($Item);
        }
    }
    unset($Item, $List, $Offset);
    $Arr = ['Size' => 0, 'Count' => 0];
    asort($Files, SORT_NUMERIC);
    foreach ($Files as $File => $Modified) {
        $File = $Path . $File;
        $Size = filesize($File);
        if (($Delete > 0 || $DeleteFiles > 0) && unlink($File)) {
            $DeleteFiles--;
            $Delete -= $Size;
            continue;
        }
        $Arr['Size'] += $Size;
        $Arr['Count']++;
    }
    return $Arr;
};

/**
 * Checks if $Needle (string) matches (is equal or identical to) $Haystack
 * (string), or a specific substring of $Haystack, to within a specific
 * threshold of the levenshtein distance between the $Needle and the $Haystack
 * or the $Haystack substring specified.
 *
 * This function is useful for expressing the differences between two strings
 * as an integer value and for then determining whether a specific value as per
 * those differences is met.
 *
 * @param string $Needle The needle (will be matched against the $Haystack, or,
 *      if substring positions are specified, against the $Haystack substring
 *      specified).
 * @param string $Haystack The haystack (will be matched against the $Needle).
 *      Note that for the purposes of calculating the levenshtein distance, it
 *      doesn't matter which string is a $Needle and which is a $Haystack (the
 *      value should be the same if the two were reversed). However, when
 *      specifying substring positions, those substring positions are applied
 *      to the $Haystack, and not the $Needle. Note, too, that if the $Needle
 *      length is greater than the $Haystack length (after having applied the
 *      substring positions to the $Haystack), $Needle and $Haystack will be
 *      switched.
 * @param int $pos_A The initial position of the $Haystack to use for the
 *      substring, if using a substring (optional; defaults to `0`; `0` is the
 *      beginning of the $Haystack).
 * @param int $pos_Z The final position of the $Haystack to use for the
 *      substring, if using a substring (optional; defaults to `0`; `0` will
 *      instruct the function to continue to the end of the $Haystack, and
 *      thus, if both $pos_A and $pos_Z are `0`, the entire $Haystack will be
 *      used).
 * @param int $min The threshold minimum (the minimum levenshtein distance
 *      required in order for the two strings to be considered a match).
 *      Optional; Defaults to `0`. If `0` or less is specified, there is no
 *      minimum, and so, any and all strings should always match, as long as
 *      the levenshtein distance doesn't surpass the threshold maximum.
 * @param int $max The threshold maximum (the maximum levenshtein distance
 *      allowed for the two strings to be considered a match). Optional;
 *      Defaults to `-1`. If exactly `-1` is specified, there is no maximum,
 *      and so, any and all strings should always match, as long as the
 *      threshold minimum is met.
 * @param bool $bool Specifies to the function whether to return the
 *      levenshtein distance of the two strings (as an integer) or to return
 *      the results of the match (as a boolean; true for match success, false
 *      for match failure). Optional; Defaults to true. If true is specified,
 *      the function will return a boolean value (the results of the match),
 *      and if false is specified, the levenshtein distance will be returned.
 * @param bool $case Specifies to the function whether to treat the two strings
 *      as case-sensitive (when true is specified) or case-insensitive (when
 *      false is specified) when calculating the levenshtein distance.
 *      Optional; Defaults to false.
 * @param int $cost_ins The cost to apply for character/byte insertions for
 *      when calculating the levenshtein distance. Optional; Defaults to 1.
 * @param int $cost_rep The cost to apply for character/byte replacements for
 *      when calculating the levenshtein distance. Optional; Defaults to 1.
 * @param int $cost_del The cost to apply for character/byte deletions for when
 *      calculating the levenshtein distance. Optional; Defaults to 1.
 * @return bool|int The function will return either a boolean or an integer,
 *      depending on the state of $bool (but will also return false whenever an
 *      error occurs).
 */
$phpMussel['lv_match'] = function ($Needle, $Haystack, $pos_A = 0, $pos_Z = 0, $min = 0, $max = -1, $bool = true, $case = false, $cost_ins = 1, $cost_rep = 1, $cost_del = 1) {
    if (!function_exists('levenshtein') || is_array($Needle) || is_array($Haystack)) {
        return false;
    }
    $nlen = strlen($Needle);
    $pos_A = (int)$pos_A;
    $pos_Z = (int)$pos_Z;
    $min = (int)$min;
    $max = (int)$max;
    if ($pos_A !== 0 || $pos_Z !== 0) {
        $Haystack = (
            $pos_Z === 0
        ) ? substr($Haystack, $pos_A) : substr($Haystack, $pos_A, $pos_Z);
    }
    $hlen = strlen($Haystack);
    if ($nlen < 1 || $hlen < 1) {
        return $bool ? false : 0;
    }
    if ($nlen > $hlen) {
        $x = [$Needle, $nlen, $Haystack, $hlen];
        $Haystack = $x[0];
        $hlen = $x[1];
        $Needle = $x[2];
        $nlen = $x[3];
    }
    if ($cost_ins === 1 && $cost_rep === 1 && $cost_del === 1) {
        $lv = $case ? levenshtein(
            $Haystack, $Needle
        ) : levenshtein(
            strtolower($Haystack), strtolower($Needle)
        );
    } else {
        $lv = $case ? levenshtein(
            $Haystack, $Needle, $cost_ins, $cost_rep, $cost_del
        ) : levenshtein(
            strtolower($Haystack), strtolower($Needle), $cost_ins, $cost_rep, $cost_del
        );
    }
    return $bool ? (($min === 0 || $lv >= $min) && ($max === -1 || $lv <= $max)) : $lv;
};

/**
 * Returns the high and low nibbles corresponding to the first byte of the
 * input string.
 *
 * @param string $Input The input string.
 * @return array Contains two elements, both standard decimal integers; The
 *      first is the high nibble of the input string, and the second is the low
 *      nibble of the input string.
 */
$phpMussel['split_nibble'] = function ($Input) {
    $Input = bin2hex($Input);
    return [hexdec(substr($Input, 0, 1)), hexdec(substr($Input, 1, 1))];
};

/**
 * Returns a string representing the binary bits of its input, whereby each
 * byte of the output is either one or zero.
 * Output can be reversed with `$phpMussel['implode_bits']()`.
 *
 * @param string $Input The input string (see closure description above).
 * @return string The output string (see closure description above).
 */
$phpMussel['explode_bits'] = function ($Input) {
    $Out = '';
    $Len = strlen($Input);
    for ($Byte = 0; $Byte < $Len; $Byte++) {
        $Out .= str_pad(decbin(ord($Input[$Byte])), 8, '0', STR_PAD_LEFT);
    }
    return $Out;
};

/**
 * The reverse of `$phpMussel['explode_bits']()`.
 *
 * @param string $Input The input string (see closure description above).
 * @return string The output string (see closure description above).
 */
$phpMussel['implode_bits'] = function ($Input) {
    $Chunks = str_split($Input, 8);
    $Count = count($Chunks);
    for ($Out = '', $Chunk = 0; $Chunk < $Count; $Chunk++) {
        $Out .= chr(bindec($Chunks[$Chunk]));
    }
    return $Out;
};

/**
 * Expands phpMussel detection shorthand to complete identifiers, makes some
 * determinations based on those identifiers against the package
 * configuration (e.g., whether specific signatures should be weighted or
 * ignored based on those identifiers), and returns a complete signature name
 * containing all relevant identifiers.
 *
 * Originally, this function was created to allow phpMussel to partially
 * compress its signatures without jeopardising speed, performance or
 * efficiency, because by allowing phpMussel to partially compress its
 * signatures, the total signature file footprint could be reduced, thus
 * allowing the inclusion of a greater number of signatures without causing
 * excessive footprint bloat. Its purpose has expanded since then though.
 *
 * @param string $VN The signature name WITH identifiers compressed (i.e.,
 *      the shorthand version of the signature name).
 * @return string The signature name WITHOUT identifiers compressed (i.e., the
 *      identifiers have been decompressed/expanded), or the input verbatim.
 */
$phpMussel['vn_shorthand'] = function ($VN) use (&$phpMussel) {

    /** Determine whether the signature is weighted. */
    $phpMussel['InstanceCache']['weighted'] = false;

    /** Determine whether the signature should be ignored due to package configuration. */
    $phpMussel['InstanceCache']['ignoreme'] = false;

    /** Byte 0 confirms whether the signature name uses shorthand. */
    if ($VN[0] !== "\x1a") {
        return $VN;
    }

    /** Check whether shorthand data has been fetched. If it hasn't, fetch it. */
    if (!isset($phpMussel['shorthand.yaml'])) {
        if (!file_exists($phpMussel['Vault'] . 'shorthand.yaml') || !is_readable($phpMussel['Vault'] . 'shorthand.yaml')) {
            return $VN;
        }
        $phpMussel['shorthand.yaml'] = (new \Maikuolan\Common\YAML($phpMussel['ReadFile']($phpMussel['Vault'] . 'shorthand.yaml')))->Data;
    }

    /** Will be populated by the signature name. */
    $Out = '';

    /** Byte 1 contains vendor name and signature metadata information. */
    $Nibbles = $phpMussel['split_nibble']($VN[1]);

    /** Populate vendor name. */
    if (
        !empty($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]]) &&
        is_array($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]]) &&
        !empty($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]][$Nibbles[1]]) &&
        is_string($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]][$Nibbles[1]])
    ) {
        $SkipMeta = true;
        $Out .= $phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]][$Nibbles[1]] . '-';
    } elseif (
        !empty($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]]) &&
        is_string($phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]])
    ) {
        $Out .= $phpMussel['shorthand.yaml']['Vendor Shorthand'][$Nibbles[0]] . '-';
    }

    /** Populate weight options. */
    if ((
        !empty($phpMussel['shorthand.yaml']['Vendor Weight Options'][$Nibbles[0]][$Nibbles[1]]) &&
        $phpMussel['shorthand.yaml']['Vendor Weight Options'][$Nibbles[0]][$Nibbles[1]] === 'Weighted'
    ) || (
        !empty($phpMussel['shorthand.yaml']['Vendor Weight Options'][$Nibbles[0]]) &&
        $phpMussel['shorthand.yaml']['Vendor Weight Options'][$Nibbles[0]] === 'Weighted'
    )) {
        $phpMussel['InstanceCache']['weighted'] = true;
    }

    /** Populate signature metadata information. */
    if (empty($SkipMeta) && !empty($phpMussel['shorthand.yaml']['Metadata Shorthand'][$Nibbles[1]])) {
        $Out .= $phpMussel['shorthand.yaml']['Metadata Shorthand'][$Nibbles[1]] . '.';
    }

    /** Byte 2 contains vector information. */
    $Nibbles = $phpMussel['split_nibble']($VN[2]);

    /** Populate vector information. */
    if (!empty($phpMussel['shorthand.yaml']['Vector Shorthand'][$Nibbles[0]][$Nibbles[1]])) {
        $Out .= $phpMussel['shorthand.yaml']['Vector Shorthand'][$Nibbles[0]][$Nibbles[1]] . '.';
    }

    /** Byte 3 contains malware type information. */
    $Nibbles = $phpMussel['split_nibble']($VN[3]);

    /** Populate malware type information. */
    if (!empty($phpMussel['shorthand.yaml']['Malware Type Shorthand'][$Nibbles[0]][$Nibbles[1]])) {
        $Out .= $phpMussel['shorthand.yaml']['Malware Type Shorthand'][$Nibbles[0]][$Nibbles[1]] . '.';
    }

    /** Populate ignore options. */
    if (!empty($phpMussel['shorthand.yaml']['Malware Type Ignore Options'][$Nibbles[0]][$Nibbles[1]])) {
        $IgnoreOption = $phpMussel['shorthand.yaml']['Malware Type Ignore Options'][$Nibbles[0]][$Nibbles[1]];
        if (isset($phpMussel['Config']['signatures'][$IgnoreOption]) && !$phpMussel['Config']['signatures'][$IgnoreOption]) {
            $phpMussel['InstanceCache']['ignoreme'] = true;
        }
    }

    /** Return the signature name and exit the closure. */
    return $Out . substr($VN, 4);

};

/**
 * Used for performing lookups to the Google Safe Browsing API (v4).
 * @link https://developers.google.com/safe-browsing/v4/lookup-api
 *
 * @param array $URLs An array of the URLs to lookup.
 * @param array $URLsNoLookup An optional array of URLs to NOT lookup.
 * @param array $DomainsNoLookup An optional array of domains to NOT lookup.
 * @return int The results of the lookup. 200 if AT LEAST ONE of the queried
 *      URLs are listed on any of Google Safe Browsing lists; 204 if NONE of
 *      the queried URLs are listed on any of Google Safe Browsing lists; 400
 *      if the request is malformed; 401 if the API key is missing or isn't
 *      authorised; 503 if the service is unavailable (e.g., if it's been
 *      throttled); 999 if something unexpected occurs (such as, for example,
 *      if a programmatic error is encountered).
 */
$phpMussel['SafeBrowseLookup'] = function (array $URLs, array $URLsNoLookup = [], array $DomainsNoLookup = []) use (&$phpMussel) {
    if (empty($phpMussel['Config']['urlscanner']['google_api_key'])) {
        return 401;
    }
    /** Count and prepare the URLs. */
    if (!$c = count($URLs)) {
        return 400;
    }
    for ($i = 0; $i < $c; $i++) {
        $Domain = (strpos($URLs[$i], '/') !== false) ? $phpMussel['substrbf']($URLs[$i], '/') : $URLs[$i];
        if (!empty($URLsNoLookup[$URLs[$i]]) || !empty($DomainsNoLookup[$Domain])) {
            unset($URLs[$i]);
            continue;
        }
        $URLs[$i] = ['url' => $URLs[$i]];
    }
    sort($URLs);
    /** After we've prepared the URLs, we prepare our JSON array. */
    $arr = json_encode([
        'client' => [
            'clientId' => 'phpMussel',
            'clientVersion' => $phpMussel['ScriptVersion']
        ],
        'threatInfo' => [
            'threatTypes' => [
                'THREAT_TYPE_UNSPECIFIED',
                'MALWARE',
                'SOCIAL_ENGINEERING',
                'UNWANTED_SOFTWARE',
                'POTENTIALLY_HARMFUL_APPLICATION'
            ],
            'platformTypes' => ['ANY_PLATFORM'],
            'threatEntryTypes' => ['URL'],
            'threatEntries' => $URLs
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    /** Fetch the cache entry for Google Safe Browsing, if it doesn't already exist. */
    if (!isset($phpMussel['InstanceCache']['urlscanner_google'])) {
        $phpMussel['InstanceCache']['urlscanner_google'] = $phpMussel['FetchCache']('urlscanner_google');
    }
    /** Generate new cache expiry time. */
    $newExpiry = $phpMussel['Time'] + $phpMussel['Config']['urlscanner']['cache_time'];
    /** Generate a reference for the cache entry for this lookup. */
    $cacheRef = md5($arr) . ':' . $c . ':' . strlen($arr) . ':';
    /** This will contain the lookup response. */
    $Response = '';
    /** Check if this lookup has already been performed. */
    while (strpos($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef) !== false) {
        $Response = $phpMussel['substrbf']($phpMussel['substral']($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef), ';');
        /** Safety mechanism. */
        if (!$Response || strpos($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef . $Response . ';') === false) {
            $Response = '';
            break;
        }
        $expiry = $phpMussel['substrbf']($Response, ':');
        if ($expiry > $phpMussel['Time']) {
            $Response = $phpMussel['substraf']($Response, ':');
            break;
        }
        $phpMussel['InstanceCache']['urlscanner_google'] =
            str_ireplace($cacheRef . $Response . ';', '', $phpMussel['InstanceCache']['urlscanner_google']);
        $Response = '';
    }
    /** If this lookup has already been performed, return the results without repeating it. */
    if ($Response) {
        /** Update the cache entry for Google Safe Browsing. */
        $newExpiry = $phpMussel['SaveCache']('urlscanner_google', $newExpiry, $phpMussel['InstanceCache']['urlscanner_google']);
        if ($Response === '200') {
            /** Potentially harmful URL detected. */
            return 200;
        } elseif ($Response === '204') {
            /** Potentially harmful URL *NOT* detected. */
            return 204;
        } elseif ($Response === '400') {
            /** Bad/malformed request. */
            return 400;
        } elseif ($Response === '401') {
            /** Unauthorised (possibly a bad API key). */
            return 401;
        } elseif ($Response === '503') {
            /** Service unavailable. */
            return 503;
        }
        /** Something bad/unexpected happened. */
        return 999;
    }

    /** Prepare the URL to use with cURL. */
    $uri =
        'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' .
        $phpMussel['Config']['urlscanner']['google_api_key'];

    /** cURL stuff here. */
    $Request = curl_init($uri);
    curl_setopt($Request, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($Request, CURLOPT_HEADER, false);
    curl_setopt($Request, CURLOPT_POST, true);
    /** Ensure it knows we're sending JSON data. */
    curl_setopt($Request, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    /** The Google Safe Browsing API requires HTTPS+SSL (there's no way around this). */
    curl_setopt($Request, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
    curl_setopt($Request, CURLOPT_RETURNTRANSFER, true);
    /*
     * Setting "CURLOPT_SSL_VERIFYPEER" to false can be somewhat risky due to man-in-the-middle attacks, but lookups
     * seemed to always fail when it was set to true during testing, so, for the sake of this actually working at all,
     * I'm setting it as false, but we should try to fix this in the future at some point.
     */
    curl_setopt($Request, CURLOPT_SSL_VERIFYPEER, false);
    /* We don't want to leave the client waiting for *too* long. */
    curl_setopt($Request, CURLOPT_TIMEOUT, $phpMussel['Timeout']);
    curl_setopt($Request, CURLOPT_USERAGENT, $phpMussel['ScriptUA']);
    curl_setopt($Request, CURLOPT_POSTFIELDS, $arr);

    /** Execute and get the response. */
    $Response = curl_exec($Request);
    $phpMussel['LookupCount']++;

    /** Check for errors and print to the screen if there were any. */
    if (!$Response) {
        throw new \Exception(curl_error($Request));
    }

    /** Close the cURL session. */
    curl_close($Request);

    if (strpos($Response, '"matches":') !== false) {
        /** Potentially harmful URL detected. */
        $returnVal = 200;
    } else {
        /** Potentially harmful URL *NOT* detected. */
        $returnVal = 204;
    }

    /** Update the cache entry for Google Safe Browsing. */
    $phpMussel['InstanceCache']['urlscanner_google'] .= $cacheRef . ':' . $newExpiry . ':' . $returnVal . ';';
    $newExpiry = $phpMussel['SaveCache']('urlscanner_google', $newExpiry, $phpMussel['InstanceCache']['urlscanner_google']);

    return $returnVal;
};

/**
 * Checks whether signature length is confined within an acceptable limit.
 *
 * @param int $Length
 * @return bool
 */
$phpMussel['ConfineLength'] = function ($Length) {
    return ($Length < 4 || $Length > 1024);
};

/**
 * Detection trigger closure (appends detection information). Generally called
 * from within the data handler. When as a method, should treat as private.
 */
$phpMussel['Detected'] = function (&$heur, &$lnap, &$VN, &$ofn, &$ofnSafe, &$out, &$flagged, &$MD5, &$str_len) use (&$phpMussel) {
    if (!$flagged) {
        $phpMussel['killdata'] .= $MD5 . ':' . $str_len . ':' . $ofn . "\n";
        $flagged = true;
    }
    $heur['detections']++;
    $phpMussel['InstanceCache']['detections_count']++;
    if ($phpMussel['InstanceCache']['weighted']) {
        $heur['weight']++;
        $heur['cli'] .= $lnap . sprintf(
            $phpMussel['L10N']->getString('_exclamation_final'),
            sprintf($phpMussel['L10N']->getString('detected'), $VN)
        ) . "\n";
        $heur['web'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $ofnSafe . ')'
        );
        return;
    }
    $out .= $lnap . sprintf(
        $phpMussel['L10N']->getString('_exclamation_final'),
        sprintf($phpMussel['L10N']->getString('detected'), $VN)
    ) . "\n";
    $phpMussel['whyflagged'] .= sprintf(
        $phpMussel['L10N']->getString('_exclamation'),
        sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $ofnSafe . ')'
    );
};

/**
 * All needles must assert as the assert state being instances of haystacks.
 *
 * @param array $Haystacks The haystacks.
 * @param array $Needles The needles.
 * @param string $Padding An optional string to pad haystacks and needles.
 * @param bool $AssertState MUST (true) or must NOT (false) be an instance of.
 * @param bool $Mode ALL (false) or ANY (true) must assert.
 * @return bool True if requirement conforms; False otherwise.
 */
$phpMussel['ContainsMustAssert'] = function (array $Haystacks, array $Needles, $Padding = ',', $AssertState = false, $Mode = false) {
    foreach ($Haystacks as $Haystack) {
        $Haystack = $Padding . $Haystack . $Padding;
        foreach ($Needles as $Needle) {
            $Needle = $Padding . $Needle . $Padding;
            if (!$Mode) {
                if (!is_bool(strpos($Haystack, $Needle)) !== $AssertState) {
                    return false;
                }
                continue;
            }
            if (!is_bool(strpos($Haystack, $Needle)) === $AssertState) {
                return true;
            }
        }
    }
    return !$Mode;
};

/**
 * Confines a string boundary as per rules specified by parameters.
 *
 * @param string $Data The string.
 * @param string|int $Initial The start of the boundary or string initial offset value.
 * @param string|int $Terminal The end of the boundary or string terminal offset value.
 * @param array $SectionOffsets Section offset values.
 */
$phpMussel['DataConfineByOffsets'] = function (&$Data, &$Initial, &$Terminal, array &$SectionOffsets) {
    if ($Initial === '*' && $Terminal === '*') {
        return;
    }
    if (substr($Initial, 0, 2) === 'SE') {
        $SectionNum = (int)substr($Initial, 2);
        $Initial = '*';
        $Terminal = '*';
        if (isset($SectionOffsets[$SectionNum][0])) {
            $Data = substr($Data, $SectionOffsets[$SectionNum][0] * 2);
        }
        if (isset($SectionOffsets[$SectionNum][1])) {
            $Data = substr($Data, 0, $SectionOffsets[$SectionNum][1] * 2);
        }
    } elseif (substr($Initial, 0, 2) === 'SL') {
        $Remainder = strlen($Initial) > 3 && substr($Initial, 2, 1) === '+' ? (substr($Initial, 3) ?: 0) : 0;
        $Initial = '*';
        $Final = count($SectionOffsets);
        if ($Final > 0 && isset($SectionOffsets[$Final - 1][0])) {
            $Data = substr($Data, ($SectionOffsets[$Final - 1][0] + $Remainder) * 2);
        }
        if ($Terminal !== '*' && $Terminal !== 'Z') {
            $Data = substr($Data, 0, $Terminal * 2);
            $Terminal = '*';
        }
    } elseif (substr($Initial, 0, 1) === 'S') {
        if (($PlusPos = strpos($Initial, '+')) !== false) {
            $SectionNum = substr($Initial, 1, $PlusPos - 1) ?: 0;
            $Remainder = substr($Initial, $PlusPos + 1) ?: 0;
        } else {
            $SectionNum = substr($Initial, 1) ?: 0;
            $Remainder = 0;
        }
        $Initial = '*';
        if (isset($SectionOffsets[$SectionNum][0])) {
            $Data = substr($Data, ($SectionOffsets[$SectionNum][0] + $Remainder) * 2);
        }
        if ($Terminal !== '*' && $Terminal !== 'Z') {
            $Data = substr($Data, 0, $Terminal * 2);
            $Terminal = '*';
        }
    } else {
        if ($Initial !== '*' && $Initial !== 'A') {
            $Data = substr($Data, $Initial * 2);
            $Initial = '*';
        }
        if ($Terminal !== '*' && $Terminal !== 'Z') {
            $Data = substr($Data, 0, $Terminal * 2);
            $Terminal = '*';
        }
    }
};

/**
 * Responsible for handling any data fed to it from the recursor. It shouldn't
 * be called manually nor from any other contexts. It takes the data given to
 * it from the recursor and checks that data against the various signatures of
 * phpMussel, before returning the results of those checks back to the
 * recursor.
 *
 * @param string $str Raw binary data to be checked, supplied by the parent
 *      closure (generally, the contents of the files to be scanned).
 * @param int $dpt Represents the current depth of recursion from which the
 *      closure has been called, used for determining how far to indent any
 *      entries generated for logging and for the display of scan results in
 *      CLI.
 * @param string $ofn Represents the "original filename" of the file being
 *      scanned (in this context, referring to the name supplied by the upload
 *      client or CLI operator, as opposed to the temporary filename assigned
 *      by the server or anything else).
 * @return array|bool Returns an array containing the results of the scan as
 *      both an integer (the first element) and as human-readable text (the
 *      second element), or returns false if any problems occur preventing the
 *      data handler from completing its normal process.
 */
$phpMussel['DataHandler'] = function ($str = '', $dpt = 0, $ofn = '') use (&$phpMussel) {
    /** If the memory cache isn't set at this point, something has gone very wrong. */
    if (!isset($phpMussel['InstanceCache'])) {
        throw new \Exception($phpMussel['L10N']->getString(
            'required_variables_not_defined'
        ) ?: '[phpMussel] Required variables aren\'t defined: Can\'t continue.');
    }

    /** Plugin hook: "DataHandler_start". */
    $phpMussel['Execute_Hook']('DataHandler_start');

    /** Identifies whether the scan target has been flagged for any reason yet. */
    $flagged = false;

    /** Increment scan depth. */
    $dpt++;

    /** Controls indenting relating to scan depth for normal logging and for CLI-mode scanning. */
    $lnap = str_pad('> ', ($dpt + 1), '-', STR_PAD_LEFT);

    /** Output variable (for when the output is a string). */
    $Out = '';

    /** There's no point bothering to scan zero-byte files. */
    if (!$str_len = strlen($str)) {
        return [1, ''];
    }

    $md5 = md5($str);
    $sha = sha1($str);
    $sha256 = hash('sha256', $str);
    $crc = hash('crc32b', $str);
    /** $fourcc: First four bytes of the scan target in hexadecimal notation. */
    $fourcc = strtolower(bin2hex(substr($str, 0, 4)));
    /** $twocc: First two bytes of the scan target in hexadecimal notation. */
    $twocc = substr($fourcc, 0, 4);
    /**
     * $CoExMeta: Contains metadata pertaining to the scan target, intended to
     * be used by the "complex extended" signatures.
     */
    $CoExMeta =
        '$ofn:' . $ofn . ';md5($ofn):' . md5($ofn) . ';$dpt:' . $dpt .
        ';$str_len:' . $str_len . ';$md5:' . $md5 . ';$sha:' . $sha .
        ';$crc:' . $crc . ';$fourcc:' . $fourcc . ';$twocc:' . $twocc . ';';

    /** Indicates whether a signature is considered a "weighted" signature. */
    $phpMussel['InstanceCache']['weighted'] = false;

    /** Variables used for weighted signatures and for heuristic analysis. */
    $heur = ['detections' => 0, 'weight' => 0, 'cli' => '', 'web' => ''];

    /** Scan target has no name? That's a little suspicious. */
    if (!$ofn) {
        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
        $phpMussel['InstanceCache']['detections_count']++;
        $Out .= $lnap . sprintf(
            $phpMussel['L10N']->getString('_exclamation_final'),
            $phpMussel['L10N']->getString('scan_missing_filename')
        ) . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('scan_missing_filename')
        );
        return [2, $Out];
    }
    /** URL-encoded version of the scan target name. */
    $ofnSafe = urlencode($ofn);

    /** Generate cache ID. */
    $phpMussel['HashCacheData'] = $md5 . md5($ofn);

    /** Register object scanned. */
    if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] == 'cli_scan') {
        $phpMussel['Stats-Increment']('CLI-Scanned', 1);
    } else {
        $phpMussel['Stats-Increment']($phpMussel['EOF'] ? 'API-Scanned' : 'Web-Scanned', 1);
    }

    /**
     * Check for the existence of a cache entry corresponding to the file
     * being scanned, and if it exists, use it instead of scanning the file.
     */
    if (isset($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']])) {
        if (!$phpMussel['EOF']) {
            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
        }
        if (!empty($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][2])) {
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $phpMussel['HexSafe']($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][2]);
            if (!empty($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][3])) {
                $phpMussel['whyflagged'] .= $phpMussel['HexSafe']($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][3]);
            }
        }

        /** Set debug values, if this has been enabled. */
        if (isset($phpMussel['DebugArr'])) {
            $phpMussel['DebugArrKey'] = count($phpMussel['DebugArr']);
            $phpMussel['DebugArr'][$phpMussel['DebugArrKey']] = [
                'Filename' => $ofn,
                'FromCache' => true,
                'Depth' => $dpt,
                'Size' => $str_len,
                'MD5' => $md5,
                'SHA1' => $sha,
                'SHA256' => $sha256,
                'CRC32B' => $crc,
                '2CC' => $twocc,
                '4CC' => $fourcc,
                'ScanPhase' => $phpMussel['InstanceCache']['phase'],
                'Container' => $phpMussel['InstanceCache']['container'],
                'Results' => !$Out ? 1 : 2,
                'Output' => $Out
            ];
        }

        /** Object not flagged. */
        if (!$Out) {
            return [1, ''];
        }
        /** Register object flagged. */
        if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] == 'cli_scan') {
            $phpMussel['Stats-Increment']('CLI-Flagged', 1);
        } else {
            $phpMussel['Stats-Increment']($phpMussel['EOF'] ? 'API-Flagged' : 'Web-Blocked', 1);
        }
        /** Object flagged. */
        return [2, $Out];
    }

    /** Indicates whether we're in CLI-mode. */
    $climode = ($phpMussel['Mussel_sapi'] && $phpMussel['Mussel_PHP']) ? 1 : 0;

    if (
        $phpMussel['Config']['attack_specific']['scannable_threshold'] > 0 &&
        $str_len > $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold'])
    ) {
        $str_len = $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold']);
        $str = substr($str, 0, $str_len);
        $str_cut = 1;
    } else {
        $str_cut = 0;
    }

    /** Indicates whether we need to decode the contents of the scan target. */
    $decode_or_not = ((
        $phpMussel['Config']['attack_specific']['decode_threshold'] > 0 &&
        $str_len > $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['decode_threshold'])
    ) || $str_len < 16) ? 0 : 1;

    /** These are sometimes used by the "CoEx" ("complex extended") signatures. */
    $len_kb = ($str_len > 1024) ? 1 : 0;
    $len_hmb = ($str_len > 524288) ? 1 : 0;
    $len_mb = ($str_len > 1048576) ? 1 : 0;
    $len_hgb = ($str_len > 536870912) ? 1 : 0;
    $phase = $phpMussel['InstanceCache']['phase'];
    $container = $phpMussel['InstanceCache']['container'];
    $pdf_magic = ($fourcc == '25504446');

    /** CoEx flags for configuration directives related to signatures. */
    foreach ([
        'detect_adware',
        'detect_joke_hoax',
        'detect_pua_pup',
        'detect_packer_packed',
        'detect_shell',
        'detect_deface',
        'detect_encryption'
    ] as $Flag) {
        $$Flag = $phpMussel['Config']['signatures'][$Flag] ? 1 : 0;
    }

    /** Cleanup. */
    unset($Flag);

    /** Available if the file is a Chrome extension. */
    $CrxPubKey = empty($phpMussel['CrxPubKey']) ? '' : $phpMussel['CrxPubKey'];
    $CrxSig = empty($phpMussel['CrxSig']) ? '' : $phpMussel['CrxSig'];

    /** Get file extensions. */
    list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($ofn);

    $CoExMeta .= '$xt:' . $xt . ';$xts:' . $xts . ';';

    /** Input ($str) as hexadecimal data. */
    $str_hex = bin2hex($str);
    $str_hex_len = $str_len * 2;

    /** Input ($str) normalised. */
    $str_norm = $phpMussel['prescan_normalise']($str, false, $decode_or_not);
    $str_norm_len = strlen($str_norm);

    /** Normalised input ($str_norm) as hexadecimal data. */
    $str_hex_norm = bin2hex($str_norm);
    $str_hex_norm_len = $str_norm_len * 2;

    /** Input ($str) normalised for HTML. */
    $str_html = $phpMussel['prescan_normalise']($str, true, $decode_or_not);
    $str_html_len = strlen($str_html);

    /** HTML normalised input ($str_html) as hexadecimal data. */
    $str_hex_html = bin2hex($str_html);
    $str_hex_html_len = $str_html_len * 2;

    /** Look for potential Linux/ELF indicators. */
    $is_elf = ($fourcc === '7f454c46' || $xt === 'elf');

    /** Look for potential graphics/image indicators. */
    $is_graphics = empty($str) ? false : $phpMussel['Indicator-Image']($xt, substr($str_hex, 0, 32));

    /** Look for potential HTML indicators. */
    $is_html = (strpos(
        ',asp*,dht*,eml*,hta*,htm*,jsp*,php*,sht*,',
        ',' . $xts . ','
    ) !== false || preg_match(
        '/3c(?:21646f6374797065|6(?:120|26f6479|8656164|8746d6c|96672616d65|96d67|f626a656374)|7(?:36372697074|461626c65|469746c65))/i',
        $str_hex_norm
    ) || preg_match(
        '/(?:6(?:26f6479|8656164|8746d6c)|7(?:36372697074|461626c65|469746c65))3e/i',
        $str_hex_norm
    ));

    /** Look for potential email indicators. */
    $is_email = (strpos(
        ',htm*,ema*,eml*,',
        ',' . $xts . ','
    ) !== false || preg_match(
        '/0a(?:4(?:36f6e74656e742d54797065|4617465|6726f6d|d6573736167652d4944|d4' .
        '94d452d56657273696f6e)|5(?:265706c792d546f|2657475726e2d50617468|3656e64' .
        '6572|375626a656374|46f|82d4d61696c6572))3a20/i',
    $str_hex) || preg_match('/0a2d2d.{32}(?:2d2d)?(?:0d)?0a/i', $str_hex));

    /** Look for potential Mach-O indicators. */
    $is_macho = preg_match('/^(?:cafe(?:babe|d00d)|c[ef]faedfe|feedfac[ef])$/', $fourcc);

    /** Look for potential PDF indicators. */
    $is_pdf = ($pdf_magic || $xt === 'pdf');

    /** Look for potential Shockwave/SWF indicators. */
    $is_swf = (
        strpos(',435753,465753,5a5753,', ',' . substr($str_hex, 0, 6) . ',') !== false ||
        strpos(',swf,swt,', ',' . $xt . ',') !== false
    );

    /** "Infectable"? Used by ClamAV General and ClamAV ASCII signatures. */
    $infectable = true;

    /** "Asciiable"? Used by all ASCII signatures. */
    $asciiable = (bool)$str_hex_norm_len;

    /** Used to identify whether to check against OLE signatures. */
    $is_ole = !empty($phpMussel['InstanceCache']['file_is_ole']) && (
        !empty($phpMussel['InstanceCache']['file_is_macro']) ||
        strpos(',bin,ole,xml,rels,', ',' . $xt . ',') !== false
    );

    /** Worked by the switch file. */
    $fileswitch = 'unassigned';
    if (!isset($phpMussel['InstanceCache']['switch.dat'])) {
        $phpMussel['InstanceCache']['switch.dat'] = $phpMussel['ReadFileAsArray']($phpMussel['sigPath'] . 'switch.dat', FILE_IGNORE_NEW_LINES);
    }
    if (!$phpMussel['InstanceCache']['switch.dat']) {
        $phpMussel['InstanceCache']['scan_errors']++;
        if (!$phpMussel['Config']['signatures']['fail_silently']) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
            }
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (switch.dat)'
            );
            return [-3, $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (switch.dat)'
            ) . "\n"];
        }
    }
    foreach ($phpMussel['InstanceCache']['switch.dat'] as $ThisRule) {
        $Switch = (strpos($ThisRule, ';') === false) ? $ThisRule : $phpMussel['substral']($ThisRule, ';');
        if (strpos($Switch, '=') === false) {
            continue;
        }
        $Switch = explode('=', preg_replace('/[^\x20-\xff]/', '', $Switch));
        if (empty($Switch[0])) {
            continue;
        }
        if (empty($Switch[1])) {
            $Switch[1] = false;
        }
        $theSwitch = $Switch[0];
        $ThisRule = (strpos($ThisRule, ';') === false) ? [$ThisRule] : explode(';', $phpMussel['substrbl']($ThisRule, ';'));
        foreach ($ThisRule as $Fragment) {
            $Fragment = (strpos($Fragment, ':') === false) ? false : $phpMussel['SplitSigParts']($Fragment, 7);
            if (empty($Fragment[0])) {
                continue 2;
            }
            if ($Fragment[0] === 'LV') {
                if (!isset($Fragment[1]) || substr($Fragment[1], 0, 1) !== '$') {
                    continue 2;
                }
                $lv_haystack = substr($Fragment[1],1);
                if (!isset($$lv_haystack) || is_array($$lv_haystack)) {
                    continue 2;
                }
                $lv_haystack = $$lv_haystack;
                if ($climode) {
                    $lv_haystack = $phpMussel['substral']($phpMussel['substral']($lv_haystack, '/'), "\\");
                }
                $lv_needle = isset($Fragment[2]) ? $Fragment[2] : '';
                $pos_A = isset($Fragment[3]) ? $Fragment[3] : 0;
                $pos_Z = isset($Fragment[4]) ? $Fragment[4] : 0;
                $lv_min = isset($Fragment[5]) ? $Fragment[5] : 0;
                $lv_max = isset($Fragment[6]) ? $Fragment[6] : -1;
                if (!$phpMussel['lv_match']($lv_needle, $lv_haystack, $pos_A, $pos_Z, $lv_min, $lv_max)) {
                    continue 2;
                }
            } elseif (isset($Fragment[2])) {
                if (isset($Fragment[3])) {
                    if ($Fragment[2] === 'A') {
                        if (
                            strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $Fragment[0] . ',') === false || (
                                $Fragment[0] === 'FD' &&
                                strpos("\x01" . substr($str_hex, 0, $Fragment[3] * 2), "\x01" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', substr($str_hex, 0, $Fragment[3] * 2))
                            ) || (
                                $Fragment[0] === 'FD-NORM' &&
                                strpos("\x01" . substr($str_hex_norm, 0, $Fragment[3] * 2), "\x01" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-NORM-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', substr($str_hex_norm, 0, $Fragment[3] * 2))
                            )
                        ) {
                            continue 2;
                        }
                    } elseif (
                        strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $Fragment[0] . ',') === false || (
                            $Fragment[0] === 'FD' &&
                            strpos(substr($str_hex, $Fragment[2] * 2, $Fragment[3] * 2), $Fragment[1]) === false
                        ) || (
                            $Fragment[0] === 'FD-RX' &&
                            !preg_match('/(?:' . $Fragment[1] . ')/i', substr($str_hex, $Fragment[2] * 2, $Fragment[3]*2))
                        ) || (
                            $Fragment[0] === 'FD-NORM' &&
                            strpos(substr($str_hex_norm, $Fragment[2] * 2, $Fragment[3] * 2), $Fragment[1]) === false
                        ) || (
                            $Fragment[0] === 'FD-NORM-RX' &&
                            !preg_match('/(?:' . $Fragment[1] . ')/i', substr($str_hex_norm, $Fragment[2] * 2, $Fragment[3]*2))
                        )
                    ) {
                        continue 2;
                    }
                } else {
                    if ($Fragment[2] === 'A') {
                        if (
                            strpos(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $Fragment[0] . ',') === false || (
                                $Fragment[0] === 'FN' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', $ofn)
                            ) || (
                                $Fragment[0] === 'FD' &&
                                strpos("\x01" . $str_hex, "\x01" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', $str_hex)
                            ) || (
                                $Fragment[0] === 'FD-NORM' &&
                                strpos("\x01" . $str_hex_norm, "\x01" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-NORM-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', $str_hex_norm)
                            )
                        ) {
                            continue 2;
                        }
                    } elseif (
                        strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $Fragment[0] . ',') === false || (
                            $Fragment[0] === 'FD' &&
                            strpos(substr($str_hex, $Fragment[2] * 2), $Fragment[1]) === false
                        ) || (
                            $Fragment[0] === 'FD-RX' &&
                            !preg_match('/(?:' . $Fragment[1] . ')/i', substr($str_hex, $Fragment[2] * 2))
                        ) || (
                            $Fragment[0] === 'FD-NORM' &&
                            strpos(substr($str_hex_norm, $Fragment[2] * 2), $Fragment[1]) === false
                        ) || (
                            $Fragment[0] === 'FD-NORM-RX' &&
                            !preg_match('/(?:' . $Fragment[1] . ')/i', substr($str_hex_norm, $Fragment[2] * 2))
                        )
                    ) {
                        continue 2;
                    }
                }
            } elseif (
                ($Fragment[0] === 'FN' && !preg_match('/(?:' . $Fragment[1] . ')/i', $ofn)) ||
                ($Fragment[0] === 'FS-MIN' && $str_len < $Fragment[1]) ||
                ($Fragment[0] === 'FS-MAX' && $str_len > $Fragment[1]) ||
                ($Fragment[0] === 'FD' && strpos($str_hex, $Fragment[1]) === false) ||
                ($Fragment[0] === 'FD-RX' && !preg_match('/(?:' . $Fragment[1] . ')/i', $str_hex)) ||
                ($Fragment[0] === 'FD-NORM' && strpos($str_hex_norm, $Fragment[1]) === false) ||
                ($Fragment[0] === 'FD-NORM-RX' && !preg_match('/(?:' . $Fragment[1] . ')/i', $str_hex_norm))
            ) {
                continue 2;
            } elseif (substr($Fragment[0], 0, 1) === '$') {
                $vf = substr($Fragment[0], 1);
                if (!isset($$vf) || is_array($$vf) || $$vf != $Fragment[1]) {
                    continue 2;
                }
            } elseif (substr($Fragment[0], 0, 2) === '!$') {
                $vf = substr($Fragment[0], 2);
                if (!isset($$vf) || is_array($$vf) || $$vf == $Fragment[1]) {
                    continue 2;
                }
            } elseif (strpos(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $Fragment[0] . ',') === false) {
                continue 2;
            }
        }
        if (count($Switch) > 1) {
            if ($Switch[1] === 'true') {
                $$theSwitch = true;
                continue;
            }
            if ($Switch[1] === 'false') {
                $$theSwitch = false;
                continue;
            }
            $$theSwitch = $Switch[1];
        } else {
            if (!isset($$theSwitch)) {
                $$theSwitch = true;
                continue;
            }
            $$theSwitch = (!$$theSwitch);
        }
    }
    unset($theSwitch, $Switch, $ThisRule);

    /** Section offsets. */
    $SectionOffsets = [];

    /** Confirmation of whether or not the file is a valid PE file. */
    $is_pe = false;

    /** Number of PE sections in the file. */
    $NumOfSections = 0;

    $PEFileDescription =
    $PEFileVersion =
    $PEProductName =
    $PEProductVersion =
    $PECopyright =
    $PEOriginalFilename =
    $PECompanyName = '';
    if (
        !empty($phpMussel['InstanceCache']['PE_Sectional']) ||
        !empty($phpMussel['InstanceCache']['PE_Extended']) ||
        $phpMussel['Config']['attack_specific']['corrupted_exe']
    ) {
        $PEArr = [];
        $PEArr['SectionArr'] = [];
        if ($twocc === '4d5a') {
            $PEArr['Offset'] = $phpMussel['UnpackSafe']('S', substr($str, 60, 4));
            $PEArr['Offset'] = $PEArr['Offset'][1];
            while (true) {
                $PEArr['DoScan'] = true;
                if ($PEArr['Offset'] < 1 || $PEArr['Offset'] > 16384 || $PEArr['Offset'] > $str_len) {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['Magic'] = substr($str, $PEArr['Offset'], 2);
                if ($PEArr['Magic']!=='PE') {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['Proc'] = $phpMussel['UnpackSafe']('S', substr($str, $PEArr['Offset'] + 4, 2));
                $PEArr['Proc'] = $PEArr['Proc'][1];
                if ($PEArr['Proc'] != 0x14c && $PEArr['Proc'] != 0x8664) {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['NumOfSections'] = $phpMussel['UnpackSafe']('S', substr($str, $PEArr['Offset'] + 6, 2));
                $NumOfSections = $PEArr['NumOfSections'] = $PEArr['NumOfSections'][1];
                $CoExMeta .= 'PE_Offset:' . $PEArr['Offset'] . ';PE_Proc:' . $PEArr['Proc'] . ';NumOfSections:' . $NumOfSections . ';';
                if ($NumOfSections < 1 || $NumOfSections > 40) {
                    $PEArr['DoScan'] = false;
                }
                break;
            }
            if (!$PEArr['DoScan']) {
                if ($phpMussel['Config']['attack_specific']['corrupted_exe']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                        $flagged = true;
                    }
                    $heur['detections']++;
                    $phpMussel['InstanceCache']['detections_count']++;
                    $Out .= $lnap . sprintf(
                        $phpMussel['L10N']->getString('_exclamation_final'),
                        $phpMussel['L10N']->getString('corrupted')
                    ) . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('corrupted') . ' (' . $ofnSafe . ')'
                    );
                }
            } else {
                $is_pe = true;
                $asciiable = false;
                $PEArr['OptHdrSize'] = $phpMussel['UnpackSafe']('S', substr($str, $PEArr['Offset'] + 20, 2));
                $PEArr['OptHdrSize'] = $PEArr['OptHdrSize'][1];
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    $PEArr['SectionArr'][$PEArr['k']] = [];
                    $PEArr['SectionArr'][$PEArr['k']]['SectionHead'] =
                        substr($str, $PEArr['Offset'] + 24 + $PEArr['OptHdrSize'] + ($PEArr['k'] * 40), $NumOfSections * 40);
                    $PEArr['SectionArr'][$PEArr['k']]['SectionName'] =
                        str_ireplace("\x00", '', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 0, 8));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 8, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 12, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 16, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] =
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 20, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'] =
                        $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['SectionData'] = substr(
                        $str,
                        $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'],
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData']
                    );
                    $SectionOffsets[$PEArr['k']] = [
                        $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'],
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData']
                    ];
                    $PEArr['SectionArr'][$PEArr['k']]['MD5'] = md5(
                        $PEArr['SectionArr'][$PEArr['k']]['SectionData']
                    );
                    $phpMussel['PEData'] .=
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] . ':' .
                        $PEArr['SectionArr'][$PEArr['k']]['MD5'] . ':' . $ofn . '-' .
                        $PEArr['SectionArr'][$PEArr['k']]['SectionName'] . "\n";
                    $CoExMeta .=
                        'SectionName:' . $PEArr['SectionArr'][$PEArr['k']]['SectionName'] .
                        ';VirtualSize:' . $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] .
                        ';VirtualAddress:' . $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] .
                        ';SizeOfRawData:' . $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] .
                        ';MD5:' . $PEArr['SectionArr'][$PEArr['k']]['MD5'] . ';';
                    $PEArr['SectionArr'][$PEArr['k']] =
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] . ':' .
                        $PEArr['SectionArr'][$PEArr['k']]['MD5'] . ':';
                }
                if (strpos($str, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24") !== false) {
                    $PEArr['Parts'] = $phpMussel['substral']($str, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24");
                    $PEArr['FINFO'] = [];
                    foreach ([
                        ["F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00", 'PEFileDescription'],
                        ["F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00", 'PEFileVersion'],
                        ["P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00", 'PEProductName'],
                        ["P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00", 'PEProductVersion'],
                        ["L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00", 'PECopyright'],
                        ["O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00", 'PEOriginalFilename'],
                        ["C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00", 'PECompanyName'],
                    ] as $PEVars) {
                        if (strpos($PEArr['Parts'], $PEVars[0]) !== false && (
                            ${$PEVars[1]} = trim(str_ireplace("\x00", '', $phpMussel['substrbf'](
                                $phpMussel['substral']($PEArr['Parts'], $PEVars[0]),
                                "\x00\x00\x00"
                            )))
                        )) {
                            $PEArr['FINFO'][] = '$' . $PEVars[1] . ':' . md5(${$PEVars[1]}) . ':' . strlen(${$PEVars[1]}) . ':';
                        }
                    }
                    unset($PEVars, $PEArr['Parts']);
                }
            }
        }
    }

    /** Look for potential indicators of not being HTML. */
    $is_not_html = (!$is_html && ($is_macho || $is_elf || $is_pe));

    /** Look for potential indicators of not being PHP. */
    $is_not_php = ((
        strpos(',phar,', ',' . $xt . ',') === false &&
        strpos(',php*,', ',' . $xts . ',') === false &&
        strpos(',phar,', ',' . $gzxt . ',') === false &&
        strpos(',php*,', ',' . $gzxts . ',') === false &&
        strpos($str_hex_norm, '3c3f706870') === false
    ) || $is_pe);

    /** Set debug values, if this has been enabled. */
    if (isset($phpMussel['DebugArr'])) {
        $phpMussel['DebugArrKey'] = count($phpMussel['DebugArr']);
        $phpMussel['DebugArr'][$phpMussel['DebugArrKey']] = [
            'Filename' => $ofn,
            'FromCache' => false,
            'Depth' => $dpt,
            'Size' => $str_len,
            'MD5' => $md5,
            'SHA1' => $sha,
            'SHA256' => $sha256,
            'CRC32B' => $crc,
            '2CC' => $twocc,
            '4CC' => $fourcc,
            'ScanPhase' => $phase,
            'Container' => $container,
            'FileSwitch' => $fileswitch,
            'Is_ELF' => $is_elf,
            'Is_Graphics' => $is_graphics,
            'Is_HTML' => $is_html,
            'Is_Email' => $is_email,
            'Is_MachO' => $is_macho,
            'Is_PDF' => $is_pdf,
            'Is_SWF' => $is_swf,
            'Is_PE' => $is_pe,
            'Is_Not_HTML' => $is_not_html,
            'Is_Not_PHP' => $is_not_php
        ];
        if ($is_pe) {
            $phpMussel['DebugArr'][$phpMussel['DebugArrKey']] += [
                'NumOfSections' => $NumOfSections,
                'PEFileDescription' => $PEFileDescription,
                'PEFileVersion' => $PEFileVersion,
                'PEProductName' => $PEProductName,
                'PEProductVersion' => $PEProductVersion,
                'PECopyright' => $PECopyright,
                'PEOriginalFilename' => $PEOriginalFilename,
                'PECompanyName' => $PECompanyName
            ];
        }
    }

    /** Plugin hook: "during_scan". */
    $phpMussel['Execute_Hook']('during_scan');

    /** Begin URL scanner. */
    if (
        isset($phpMussel['InstanceCache']['URL_Scanner']) ||
        !empty($phpMussel['Config']['urlscanner']['lookup_hphosts']) ||
        !empty($phpMussel['Config']['urlscanner']['google_api_key'])
    ) {
        $phpMussel['LookupCount'] = 0;
        $URLScanner = [
            'FixedSource' => preg_replace('~(data|f(ile|tps?)|https?|sftp):~i', "\x01\\1:", str_replace("\\", '/', $str_norm)) . "\x01",
            'DomainsNoLookup' => [],
            'DomainsCount' => 0,
            'Domains' => [],
            'DomainPartsNoLookup' => [],
            'DomainParts' => [],
            'Queries' => [],
            'URLsNoLookup' => [],
            'URLsCount' => 0,
            'URLs' => [],
            'URLPartsNoLookup' => [],
            'URLParts' => [],
            'TLDs' => [],
            'Iterable' => 0,
            'Matches' => []
        ];
        if (preg_match_all(
            '~(?:data|f(?:ile|tps?)|https?|sftp)://(?:www\d{0,3}\.)?([\da-z.-]{1,512})[^\da-z.-]~i',
            $URLScanner['FixedSource'],
            $URLScanner['Matches']
        )) {
            foreach ($URLScanner['Matches'][1] as $ThisURL) {
                $URLScanner['DomainParts'][$URLScanner['Iterable']] = $ThisURL;
                if (strpos($URLScanner['DomainParts'][$URLScanner['Iterable']], '.') !== false) {
                    $URLScanner['TLDs'][$URLScanner['Iterable']] = 'TLD:' . $phpMussel['substral'](
                        $URLScanner['DomainParts'][$URLScanner['Iterable']],
                        '.'
                    ) . ':';
                }
                $ThisURL = md5($ThisURL) . ':' . strlen($ThisURL) . ':';
                $URLScanner['Domains'][$URLScanner['Iterable']] = 'DOMAIN:' . $ThisURL;
                $URLScanner['DomainsNoLookup'][$URLScanner['Iterable']] = 'DOMAIN-NOLOOKUP:' . $ThisURL;
                $URLScanner['Iterable']++;
            }
        }
        $URLScanner['DomainsNoLookup'] = array_unique($URLScanner['DomainsNoLookup']);
        $URLScanner['Domains'] = array_unique($URLScanner['Domains']);
        $URLScanner['DomainParts'] = array_unique($URLScanner['DomainParts']);
        $URLScanner['TLDs'] = array_unique($URLScanner['TLDs']);
        sort($URLScanner['DomainsNoLookup']);
        sort($URLScanner['Domains']);
        sort($URLScanner['DomainParts']);
        sort($URLScanner['TLDs']);
        $URLScanner['Iterable'] = 0;
        $URLScanner['Matches'] = '';
        if (preg_match_all(
            '~(?:data|f(?:ile|tps?)|https?|sftp)://(?:www\d{0,3}\.)?([!#$&-;=?@-\[\]_a-z\~]+)[^!#$&-;=?@-\[\]_a-z\~]~i',
            $URLScanner['FixedSource'],
            $URLScanner['Matches']
        )) {
            foreach ($URLScanner['Matches'][1] as $ThisURL) {
                if (strlen($ThisURL) > 4096) {
                    $ThisURL = substr($ThisURL, 0, 4096);
                }
                $URLScanner['This'] = md5($ThisURL) . ':' . strlen($ThisURL) . ':';
                $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                $URLScanner['URLParts'][$URLScanner['Iterable']] = $ThisURL;
                $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                $URLScanner['Iterable']++;
                if (preg_match('/[^\da-z.-]$/i', $ThisURL)) {
                    $URLScanner['x'] = preg_replace('/[^\da-z.-]+$/i', '', $ThisURL);
                    $URLScanner['This'] = md5($URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
                    $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                    $URLScanner['URLParts'][$URLScanner['Iterable']] = $URLScanner['x'];
                    $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                    $URLScanner['Iterable']++;
                }
                if (strpos($ThisURL, '?') !== false) {
                    $URLScanner['x'] = $phpMussel['substrbf']($ThisURL, '?');
                    $URLScanner['This'] = md5($URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
                    $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                    $URLScanner['URLParts'][$URLScanner['Iterable']] = $URLScanner['x'];
                    $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                    $URLScanner['x'] = $phpMussel['substraf']($ThisURL, '?');
                    $URLScanner['Queries'][$URLScanner['Iterable']] = 'QUERY:' . md5($URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
                    $URLScanner['Iterable']++;
                }
            }
            unset($URLScanner['x'], $URLScanner['This']);
        }
        unset($ThisURL, $URLScanner['Matches']);
        $URLScanner['URLsNoLookup'] = array_unique($URLScanner['URLsNoLookup']);
        $URLScanner['URLs'] = array_unique($URLScanner['URLs']);
        $URLScanner['URLParts'] = array_unique($URLScanner['URLParts']);
        $URLScanner['Queries'] = array_unique($URLScanner['Queries']);
        sort($URLScanner['URLsNoLookup']);
        sort($URLScanner['URLs']);
        sort($URLScanner['URLParts']);
        sort($URLScanner['Queries']);
    }

    /** Process non-mappable signatures. */
    foreach ([
        ['General_Command_Detections', 0],
        ['Hash', 1],
        ['PE_Sectional', 2],
        ['PE_Extended', 3],
        ['URL_Scanner', 4],
        ['Complex_Extended', 5]
    ] as $ThisConf) {

        /** Plugin hook: "new_sigfile_type". */
        $phpMussel['Execute_Hook']('new_sigfile_type');

        $SigFiles = isset($phpMussel['InstanceCache'][$ThisConf[0]]) ? explode(',', $phpMussel['InstanceCache'][$ThisConf[0]]) : [];
        foreach ($SigFiles as $SigFile) {
            if (!$SigFile) {
                continue;
            }
            if (!isset($phpMussel['InstanceCache'][$SigFile])) {
                $phpMussel['InstanceCache'][$SigFile] = $phpMussel['ReadFile']($phpMussel['sigPath'] . $SigFile);
            }

            /** Plugin hook: "new_sigfile". */
            $phpMussel['Execute_Hook']('new_sigfile');

            if (!$phpMussel['InstanceCache'][$SigFile]) {
                $phpMussel['InstanceCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (' . $SigFile . ')'
                    );
                    return [-3, $lnap . sprintf(
                        $phpMussel['L10N']->getString('_exclamation_final'),
                        $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (' . $SigFile . ')'
                    ) . "\n"];
                }
            } elseif ($ThisConf[1] === 0) {
                if (substr($phpMussel['InstanceCache'][$SigFile], 0, 9) === 'phpMussel') {
                    $phpMussel['InstanceCache'][$SigFile] = substr($phpMussel['InstanceCache'][$SigFile], 11, -1);
                }
                $ArrayCSV = explode(',', $phpMussel['InstanceCache'][$SigFile]);
                foreach ($ArrayCSV as $ItemCSV) {
                    if (strpos($str_hex_norm, $ItemCSV) !== false) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                            $flagged = true;
                        }
                        $heur['detections']++;
                        $phpMussel['InstanceCache']['detections_count']++;
                        $Out .= $lnap . sprintf(
                            $phpMussel['L10N']->getString('_exclamation'),
                            $phpMussel['L10N']->getString('scan_command_injection')
                        ) . "\n";
                        $phpMussel['whyflagged'] .= sprintf(
                            $phpMussel['L10N']->getString('_exclamation'),
                            $phpMussel['L10N']->getString('scan_command_injection') . ', \'' . $phpMussel['HexSafe']($ItemCSV) . '\' (' . $ofnSafe . ')'
                        );
                    }
                }
                unset($ItemCSV, $ArrayCSV);
            } elseif ($ThisConf[1] === 1) {
                foreach ([$md5, $sha, $sha256] as $CheckThisHash) {
                    if (strpos($phpMussel['InstanceCache'][$SigFile], "\n" . $CheckThisHash . ':' . $str_len . ':') !== false) {
                        $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], "\n" . $CheckThisHash . ':' . $str_len . ':');
                        if (strpos($xSig, "\n") !== false) {
                            $xSig = $phpMussel['substrbf']($xSig, "\n");
                        }
                        $xSig = $phpMussel['vn_shorthand']($xSig);
                        if (
                            strpos($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') === false &&
                            empty($phpMussel['InstanceCache']['ignoreme'])
                        ) {
                            $phpMussel['Detected']($heur, $lnap, $xSig, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                        }
                    }
                }
            } elseif ($ThisConf[1] === 2) {
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    if (strpos($phpMussel['InstanceCache'][$SigFile], $PEArr['SectionArr'][$PEArr['k']]) !== false) {
                        $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], $PEArr['SectionArr'][$PEArr['k']]);
                        if (strpos($xSig, "\n") !== false) {
                            $xSig = $phpMussel['substrbf']($xSig, "\n");
                        }
                        $xSig = $phpMussel['vn_shorthand']($xSig);
                        if (
                            strpos($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') === false &&
                            empty($phpMussel['InstanceCache']['ignoreme'])
                        ) {
                            $phpMussel['Detected']($heur, $lnap, $xSig, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                        }
                    }
                }
            } elseif ($ThisConf[1] === 3) {
                if (!empty($PEArr['FINFO'])) {
                    foreach ($PEArr['FINFO'] as $PEArr['ThisPart']) {
                        if (substr_count($phpMussel['InstanceCache'][$SigFile], $PEArr['ThisPart'])) {
                            $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], $PEArr['ThisPart']);
                            if (strpos($xSig, "\n") !== false) {
                                $xSig = $phpMussel['substrbf']($xSig, "\n");
                            }
                            $xSig = $phpMussel['vn_shorthand']($xSig);
                            if (
                                !substr_count($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') &&
                                empty($phpMussel['InstanceCache']['ignoreme'])
                            ) {
                                $phpMussel['Detected']($heur, $lnap, $xSig, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                            }
                        }
                    }
                }
            } elseif ($ThisConf[1] === 4) {
                foreach ([$URLScanner['DomainsNoLookup'], $URLScanner['URLsNoLookup']] as $URLScanner['ThisArr']) {
                    foreach ($URLScanner['ThisArr'] as $URLScanner['This']) {
                        if (strpos($phpMussel['InstanceCache'][$SigFile], $URLScanner['This']) !== false) {
                            $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], $URLScanner['This']);
                            if (strpos($xSig, "\n") !== false) {
                                $xSig = $phpMussel['substrbf']($xSig, "\n");
                            }
                            if (substr($URLScanner['This'], 0, 15) === 'DOMAIN-NOLOOKUP') {
                                $URLScanner['DomainPartsNoLookup'][$xSig] = true;
                                continue;
                            }
                            $URLScanner['URLPartsNoLookup'][$xSig] = true;
                        }
                    }
                }
                foreach ([
                    $URLScanner['TLDs'],
                    $URLScanner['Domains'],
                    $URLScanner['URLs'],
                    $URLScanner['Queries']
                ] as $URLScanner['ThisArr']) {
                    foreach ($URLScanner['ThisArr'] as $URLScanner['This']) {
                        if (substr_count($phpMussel['InstanceCache'][$SigFile], $URLScanner['This'])) {
                            $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], $URLScanner['This']);
                            if (strpos($xSig, "\n") !== false) {
                                $xSig = $phpMussel['substrbf']($xSig, "\n");
                            }
                            if (
                                ($xSig = $phpMussel['vn_shorthand']($xSig)) &&
                                !substr_count($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') &&
                                empty($phpMussel['InstanceCache']['ignoreme'])
                            ) {
                                $phpMussel['Detected']($heur, $lnap, $xSig, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                            }
                        }
                    }
                }
            } elseif ($ThisConf[1] === 5) {
                $SigName = '';
                foreach ([
                    'NumOfSections',
                    'PECompanyName',
                    'PECopyright',
                    'PEFileDescription',
                    'PEFileVersion',
                    'PEOriginalFilename',
                    'PEProductName',
                    'PEProductVersion',
                    'container',
                    'crc',
                    'fileswitch',
                    'fourcc',
                    'is_elf',
                    'is_email',
                    'is_graphics',
                    'is_html',
                    'is_macho',
                    'is_not_html',
                    'is_not_php',
                    'is_ole',
                    'is_pdf',
                    'is_pe',
                    'is_swf',
                    'md5',
                    'phase',
                    'sha',
                    'sha256',
                    'str_len',
                    'twocc',
                    'xt',
                    'xts'
                ] as $ThisCheckFor) {
                    if (!isset($$ThisCheckFor)) {
                        continue;
                    }
                    $ThisCheckValue = "\n$" . $ThisCheckFor . ':' . (
                        substr($ThisCheckFor, 0, 3) !== 'is_' ? $$ThisCheckFor : ($$ThisCheckFor ? '1' : '0')
                    ) . ';';
                    if (strpos($phpMussel['InstanceCache'][$SigFile], $ThisCheckValue) === false) {
                        continue;
                    }
                    $xSig = explode($ThisCheckValue, $phpMussel['InstanceCache'][$SigFile]);
                    $xSigCount = count($xSig);
                    if (isset($xSig[0])) {
                        $xSig[0] = '';
                    }
                    if ($xSigCount > 0) {
                        for ($xIter = 1; $xIter < $xSigCount; $xIter++) {
                            if (strpos($xSig[$xIter], "\n") !== false) {
                                $xSig[$xIter] = $phpMussel['substrbf']($xSig[$xIter], "\n");
                            }
                            if (strpos($xSig[$xIter], ';') !== false) {
                                if (strpos($xSig[$xIter], ':') === false) {
                                    continue;
                                }
                                $SigName = $phpMussel['vn_shorthand']($phpMussel['substral']($xSig[$xIter], ';'));
                                $xSig[$xIter] = explode(';', $phpMussel['substrbl']($xSig[$xIter], ';'));
                            } else {
                                $SigName = $phpMussel['vn_shorthand']($xSig[$xIter]);
                                $xSig[$xIter] = [];
                            }
                            foreach ($xSig[$xIter] as $ThisSigPart) {
                                if (empty($ThisSigPart)) {
                                    continue 2;
                                }
                                $ThisSigPart = $phpMussel['SplitSigParts']($ThisSigPart, 7);
                                if ($ThisSigPart[0] === 'LV') {
                                    if (!isset($ThisSigPart[1]) || substr($ThisSigPart[1], 0, 1) !== '$') {
                                        continue 2;
                                    }
                                    $lv_haystack = substr($ThisSigPart[1], 1);
                                    if (!isset($$lv_haystack) || is_array($$lv_haystack)) {
                                        continue 2;
                                    }
                                    $lv_haystack = $$lv_haystack;
                                    if ($climode) {
                                        $lv_haystack = $phpMussel['substral']($phpMussel['substral']($lv_haystack, '/'), "\\");
                                    }
                                    $lv_needle = (isset($ThisSigPart[2])) ? $ThisSigPart[2] : '';
                                    $pos_A = (isset($ThisSigPart[3])) ? $ThisSigPart[3] : 0;
                                    $pos_Z = (isset($ThisSigPart[4])) ? $ThisSigPart[4] : 0;
                                    $lv_min = (isset($ThisSigPart[5])) ? $ThisSigPart[5] : 0;
                                    $lv_max = (isset($ThisSigPart[6])) ? $ThisSigPart[6] : -1;
                                    if (!$phpMussel['lv_match']($lv_needle, $lv_haystack, $pos_A, $pos_Z, $lv_min, $lv_max)) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if (isset($ThisSigPart[2])) {
                                    if (isset($ThisSigPart[3])) {
                                        if ($ThisSigPart[2] == 'A') {
                                            if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                                $ThisSigPart[0] == 'FD' &&
                                                strpos("\x01" . substr($str_hex, 0, $ThisSigPart[3] * 2), "\x01" . $ThisSigPart[1]) === false
                                            ) || (
                                                $ThisSigPart[0] == 'FD-RX' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, 0, $ThisSigPart[3] * 2))
                                            ) || (
                                                $ThisSigPart[0] == 'FD-NORM' &&
                                                strpos("\x01" . substr($str_hex_norm, 0, $ThisSigPart[3] * 2), "\x01" . $ThisSigPart[1]) === false
                                            ) || (
                                                $ThisSigPart[0] == 'FD-NORM-RX' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, 0, $ThisSigPart[3] * 2))
                                            ) || (
                                                $ThisSigPart[0] == 'META' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, 0, $ThisSigPart[3] * 2))
                                            )) {
                                                continue 2;
                                            }
                                            continue;
                                        }
                                        if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                            $ThisSigPart[0] == 'FD' &&
                                            strpos(substr($str_hex, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2), $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] == 'FD-RX' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        ) || (
                                            $ThisSigPart[0] == 'FD-NORM' &&
                                            strpos(substr($str_hex_norm, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2), $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] == 'FD-NORM-RX' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        ) || (
                                            $ThisSigPart[0] == 'META' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        )) {
                                            continue 2;
                                        }
                                        continue;
                                    }
                                    if ($ThisSigPart[2] == 'A') {
                                        if (strpos(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                            $ThisSigPart[0] == 'FN' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $ofn)
                                        ) || (
                                            $ThisSigPart[0] == 'FD' &&
                                            strpos("\x01" . $str_hex, "\x01" . $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] == 'FD-RX' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $str_hex)
                                        ) || (
                                            $ThisSigPart[0] == 'FD-NORM' &&
                                            strpos("\x01" . $str_hex_norm, "\x01" . $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] == 'FD-NORM-RX' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $str_hex_norm)
                                        ) || (
                                            $ThisSigPart[0] == 'META' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $CoExMeta)
                                        )) {
                                            continue 2;
                                        }
                                        continue;
                                    }
                                    if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                        $ThisSigPart[0] == 'FD' &&
                                        strpos(substr($str_hex, $ThisSigPart[2] * 2), $ThisSigPart[1]) === false
                                    ) || (
                                        $ThisSigPart[0] == 'FD-RX' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, $ThisSigPart[2] * 2))
                                    ) || (
                                        $ThisSigPart[0] == 'FD-NORM' &&
                                        strpos(substr($str_hex_norm, $ThisSigPart[2] * 2), $ThisSigPart[1]) === false
                                    ) || (
                                        $ThisSigPart[0] == 'FD-NORM-RX' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, $ThisSigPart[2] * 2))
                                    ) || (
                                        $ThisSigPart[0] == 'META' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, $ThisSigPart[2] * 2))
                                    )) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if ((
                                    $ThisSigPart[0] == 'FN' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $ofn)
                                ) || (
                                    $ThisSigPart[0] == 'FS-MIN' &&
                                    $str_len < $ThisSigPart[1]
                                ) || (
                                    $ThisSigPart[0] == 'FS-MAX' &&
                                    $str_len > $ThisSigPart[1]
                                ) || (
                                    $ThisSigPart[0] == 'FD' &&
                                    strpos($str_hex, $ThisSigPart[1]) === false
                                ) || (
                                    $ThisSigPart[0] == 'FD-RX' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $str_hex)
                                ) || (
                                    $ThisSigPart[0] == 'FD-NORM' &&
                                    strpos($str_hex_norm, $ThisSigPart[1]) === false
                                ) || (
                                    $ThisSigPart[0] == 'FD-NORM-RX' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $str_hex_norm)
                                ) || (
                                    $ThisSigPart[0] == 'META' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $CoExMeta)
                                )) {
                                    continue 2;
                                }
                                if (substr($ThisSigPart[0], 0, 1) === '$') {
                                    $vf = substr($ThisSigPart[0], 1);
                                    if (!isset($$vf) || is_array($$vf) || $$vf != $ThisSigPart[1]) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if (substr($ThisSigPart[0], 0, 2) === '!$') {
                                    $vf = substr($ThisSigPart[0], 2);
                                    if (!isset($$vf) || is_array($$vf) || $$vf == $ThisSigPart[1]) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if (strpos(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false) {
                                    continue 2;
                                }
                            }
                            if (
                                $SigName &&
                                strpos($phpMussel['InstanceCache']['greylist'], ',' . $SigName . ',') === false &&
                                empty($phpMussel['InstanceCache']['ignoreme'])
                            ) {
                                $phpMussel['Detected']($heur, $lnap, $SigName, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                            }
                        }
                    }
                }

                /** Cleanup. */
                unset($SigName, $xIter, $xSigCount, $xSig, $ThisSigPart, $ThisCheckValue, $ThisCheckFor);
            }
        }
    }

    /** Process mappable signatures. */
    foreach ([
        ['Filename', 'str_hex', 'str_hex_len', 2],
        ['Standard', 'str_hex', 'str_hex_len', 0],
        ['Normalised', 'str_hex_norm', 'str_hex_norm_len', 0],
        ['HTML', 'str_hex_html', 'str_hex_html_len', 0],
        ['Standard_RegEx', 'str_hex', 'str_hex_len', 1],
        ['Normalised_RegEx', 'str_hex_norm', 'str_hex_norm_len', 1],
        ['HTML_RegEx', 'str_hex_html', 'str_hex_html_len', 1]
    ] as $ThisConf) {
        $DataSource = $ThisConf[1];
        $DataSourceLen = $ThisConf[2];

        /** Plugin hook: "new_sigfile_type". */
        $phpMussel['Execute_Hook']('new_sigfile_type');

        $SigFiles = isset($phpMussel['InstanceCache'][$ThisConf[0]]) ? explode(',', $phpMussel['InstanceCache'][$ThisConf[0]]) : [];
        foreach ($SigFiles as $SigFile) {
            if (!$SigFile) {
                continue;
            }
            if (!isset($phpMussel['InstanceCache'][$SigFile])) {
                $phpMussel['InstanceCache'][$SigFile] = $phpMussel['ReadFileAsArray']($phpMussel['sigPath'] . $SigFile, FILE_IGNORE_NEW_LINES);
            }

            /** Plugin hook: "new_sigfile". */
            $phpMussel['Execute_Hook']('new_sigfile');

            if (!$phpMussel['InstanceCache'][$SigFile]) {
                $phpMussel['InstanceCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (' . $SigFile . ')'
                    );
                    return [-3, $lnap . sprintf(
                        $phpMussel['L10N']->getString('_exclamation_final'),
                        $phpMussel['L10N']->getString('scan_signature_file_missing') . ' (' . $SigFile . ')'
                    ) . "\n"];
                }
                continue;
            }
            $NumSigs = count($phpMussel['InstanceCache'][$SigFile]);
            for ($SigNum = 0; $SigNum < $NumSigs; $SigNum++) {
                if (!$ThisSig = $phpMussel['InstanceCache'][$SigFile][$SigNum]) {
                    continue;
                }
                if (substr($ThisSig, 0, 1) == '>') {
                    $ThisSig = explode('>', $ThisSig, 4);
                    if (!isset($ThisSig[1], $ThisSig[2], $ThisSig[3])) {
                        break;
                    }
                    $ThisSig[3] = (int)$ThisSig[3];
                    if ($ThisSig[1] == 'FN') {
                        if (!preg_match('/(?:' . $ThisSig[2] . ')/i', $ofn)) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] == 'FS-MIN') {
                        if ($str_len < $ThisSig[2]) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] == 'FS-MAX') {
                        if ($str_len > $ThisSig[2]) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] == 'FD') {
                        if (strpos($$DataSource, $ThisSig[2]) === false) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] == 'FD-RX') {
                        if (!preg_match('/(?:' . $ThisSig[2] . ')/i', $$DataSource)) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif (substr($ThisSig[1], 0, 1) == '$') {
                        $vf = substr($ThisSig[1], 1);
                        if (isset($$vf) && !is_array($$vf)) {
                            if ($$vf != $ThisSig[2]) {
                                if ($ThisSig[3] <= $SigNum) {
                                    break;
                                }
                                $SigNum = $ThisSig[3] - 1;
                            }
                            continue;
                        }
                        if ($ThisSig[3] <= $SigNum) {
                            break;
                        }
                        $SigNum = $ThisSig[3] - 1;
                    } elseif (substr($ThisSig[1], 0, 2) == '!$') {
                        $vf = substr($ThisSig[1], 2);
                        if (isset($$vf) && !is_array($$vf)) {
                            if ($$vf == $ThisSig[2]) {
                                if ($ThisSig[3] <= $SigNum) {
                                    break;
                                }
                                $SigNum = $ThisSig[3] - 1;
                            }
                            continue;
                        }
                        if ($ThisSig[3] <= $SigNum) {
                            break;
                        }
                        $SigNum = $ThisSig[3] - 1;
                    } else {
                        break;
                    }
                    continue;
                }
                if (strpos($ThisSig, ':') !== false) {
                    $VN = $phpMussel['SplitSigParts']($ThisSig);
                    if (!isset($VN[1]) || !strlen($VN[1])) {
                        continue;
                    }
                    if ($ThisConf[3] === 2) {
                        $ThisSig = preg_split('/[\x00-\x1f]+/', $VN[1], -1, PREG_SPLIT_NO_EMPTY);
                        $ThisSig = ($ThisSig === false) ? '' : implode('', $ThisSig);
                        $VN = $phpMussel['vn_shorthand']($VN[0]);
                        if (
                            $ThisSig &&
                            strpos($phpMussel['InstanceCache']['greylist'], ',' . $VN . ',') === false &&
                            empty($phpMussel['InstanceCache']['ignoreme'])
                        ) {
                            if (preg_match('/(?:' . $ThisSig . ')/i', $ofn)) {
                                $phpMussel['Detected']($heur, $lnap, $VN, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                            }
                        }
                    } elseif ($ThisConf[3] === 0 || $ThisConf[3] === 1) {
                        $ThisSig = preg_split((
                            $ThisConf[3] === 0 ? '/[^\da-f>]+/i' : '/[\x00-\x1f]+/'
                        ), $VN[1], -1, PREG_SPLIT_NO_EMPTY);
                        $ThisSig = ($ThisSig === false ? '' : implode('', $ThisSig));
                        $ThisSigLen = strlen($ThisSig);
                        if ($phpMussel['ConfineLength']($ThisSigLen)) {
                            continue;
                        }
                        $xstrf = isset($VN[2]) ? $VN[2] : '*';
                        $xstrt = isset($VN[3]) ? $VN[3] : '*';
                        $VN = $phpMussel['vn_shorthand']($VN[0]);
                        $VNLC = strtolower($VN);
                        if (($is_not_php && (
                                strpos($VNLC, '-php') !== false || strpos($VNLC, '.php') !== false
                        )) || ($is_not_html && (
                                strpos($VNLC, '-htm') !== false || strpos($VNLC, '.htm') !== false
                        )) || $$DataSourceLen < $ThisSigLen) {
                            continue;
                        }
                        if (
                            strpos($phpMussel['InstanceCache']['greylist'], ',' . $VN . ',') === false &&
                            empty($phpMussel['InstanceCache']['ignoreme'])
                        ) {
                            if ($ThisConf[3] === 0) {
                                $ThisSig = strpos($ThisSig, '>') !== false ? explode('>', $ThisSig) : [$ThisSig];
                                $ThisSigCount = count($ThisSig);
                                $ThisString = $$DataSource;
                                $phpMussel['DataConfineByOffsets']($ThisString, $xstrf, $xstrt, $SectionOffsets);
                                if ($xstrf === 'A') {
                                    $ThisString = "\x01" . $ThisString;
                                    $ThisSig[0] = "\x01" . $ThisSig[0];
                                }
                                if ($xstrt === 'Z') {
                                    $ThisString .= "\x01";
                                    $ThisSig[$ThisSigCount - 1] .= "\x01";
                                }
                                for ($ThisSigi = 0; $ThisSigi < $ThisSigCount; $ThisSigi++) {
                                    if (strpos($ThisString, $ThisSig[$ThisSigi]) === false) {
                                        continue 2;
                                    }
                                    if ($ThisSigCount > 1 && strpos($ThisString, $ThisSig[$ThisSigi]) !== false) {
                                        $ThisString = $phpMussel['substraf']($ThisString, $ThisSig[$ThisSigi]);
                                    }
                                }
                            } else {
                                $ThisString = $$DataSource;
                                $phpMussel['DataConfineByOffsets']($ThisString, $xstrf, $xstrt, $SectionOffsets);
                                if ($xstrf === 'A') {
                                    if ($xstrt === 'Z') {
                                        if (!preg_match('/\A(?:' . $ThisSig . ')$/i', $ThisString)) {
                                            continue;
                                        }
                                    } elseif (!preg_match('/\A(?:' . $ThisSig . ')/i', $ThisString)) {
                                        continue;
                                    }
                                } else {
                                    if ($xstrt === 'Z') {
                                        if (!preg_match('/(?:' . $ThisSig . ')$/i', $ThisString)) {
                                            continue;
                                        }
                                    } elseif (!preg_match('/(?:' . $ThisSig . ')/i', $ThisString)) {
                                        continue;
                                    }
                                }
                            }
                            $phpMussel['Detected']($heur, $lnap, $VN, $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                        }
                    }
                }
            }
        }
    }

    /** Plugin hook: "before_domains_api_lookup". */
    $phpMussel['Execute_Hook']('before_domains_api_lookup');

    /** Perform API lookups for domains. */
    if (isset($URLScanner) && !$Out) {

        $URLScanner['DomainsCount'] = count($URLScanner['DomainParts']);

        /** Codeblock for performing hpHosts API lookups. */
        if ($phpMussel['Config']['urlscanner']['lookup_hphosts'] && $URLScanner['DomainsCount']) {
            /** Fetch the cache entry for hpHosts, if it doesn't already exist. */
            if (!isset($phpMussel['InstanceCache']['urlscanner_domains'])) {
                $phpMussel['InstanceCache']['urlscanner_domains'] = $phpMussel['FetchCache']('urlscanner_domains');
            }
            $URLScanner['y'] = $phpMussel['Time'] + $phpMussel['Config']['urlscanner']['cache_time'];
            $URLScanner['ScriptIdentEncoded'] = urlencode($phpMussel['ScriptIdent']);
            $URLScanner['classes'] = [
                'EMD' => "\x1a\x82\x10\x1bXXX",
                'EXP' => "\x1a\x82\x10\x16XXX",
                'GRM' => "\x1a\x82\x10\x32XXX",
                'HFS' => "\x1a\x82\x10\x32XXX",
                'PHA' => "\x1a\x82\x10\x32XXX",
                'PSH' => "\x1a\x82\x10\x31XXX"
            ];
            for ($i = 0; $i < $URLScanner['DomainsCount']; $i++) {
                if (!empty($URLScanner['DomainPartsNoLookup'][$URLScanner['DomainParts'][$i]])) {
                    continue;
                }
                if (
                    $phpMussel['Config']['urlscanner']['maximum_api_lookups'] > 0 &&
                    $phpMussel['LookupCount'] > $phpMussel['Config']['urlscanner']['maximum_api_lookups']
                ) {
                    if ($phpMussel['Config']['urlscanner']['maximum_api_lookups_response']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                            $flagged = true;
                        }
                        $Out .= $lnap . sprintf(
                            $phpMussel['L10N']->getString('_exclamation_final'),
                            $phpMussel['L10N']->getString('too_many_urls')
                        ) . "\n";
                        $phpMussel['whyflagged'] .= sprintf(
                            $phpMussel['L10N']->getString('_exclamation'),
                            $phpMussel['L10N']->getString('too_many_urls') . ' (' . $ofnSafe . ')'
                        );
                    }
                    break;
                }
                $URLScanner['This'] = md5($URLScanner['DomainParts'][$i]) . ':' . strlen($URLScanner['DomainParts'][$i]) . ':';
                while (substr_count($phpMussel['InstanceCache']['urlscanner_domains'], $URLScanner['This'])) {
                    $URLScanner['Class'] =
                        $phpMussel['substrbf']($phpMussel['substral']($phpMussel['InstanceCache']['urlscanner_domains'], $URLScanner['This']), ';');
                    if (!substr_count($phpMussel['InstanceCache']['urlscanner_domains'], $URLScanner['This'] . ':' . $URLScanner['Class'] . ';')) {
                        break;
                    }
                    $URLScanner['Expiry'] = (int)$phpMussel['substrbf']($URLScanner['Class'], ':');
                    if ($URLScanner['Expiry'] > $phpMussel['Time']) {
                        $URLScanner['Class'] = $phpMussel['substraf']($URLScanner['Class'], ':');
                        if (!$URLScanner['Class']) {
                            continue 2;
                        }
                        $URLScanner['Class'] = $phpMussel['vn_shorthand']($URLScanner['Class']);
                        $phpMussel['Detected']($heur, $lnap, $URLScanner['Class'], $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                    }
                    $phpMussel['InstanceCache']['urlscanner_domains'] =
                        str_ireplace($URLScanner['This'] . $URLScanner['Class'] . ';', '', $phpMussel['InstanceCache']['urlscanner_domains']);
                }
                $URLScanner['req'] =
                    'v=' . $URLScanner['ScriptIdentEncoded'] .
                    '&s=' . $URLScanner['DomainParts'][$i] .
                    '&class=true';
                $URLScanner['req_result'] = $phpMussel['Request'](
                    'https://verify.hosts-file.net/?' . $URLScanner['req'],
                    ['v' => $URLScanner['ScriptIdentEncoded'], 's' => $URLScanner['DomainParts'][$i], 'Class' => true],
                    12
                );
                $phpMussel['LookupCount']++;
                if (substr($URLScanner['req_result'], 0, 6) == "Listed") {
                    $URLScanner['Class'] = substr($URLScanner['req_result'], 7, 3);
                    $URLScanner['Class'] = isset($URLScanner['classes'][$URLScanner['Class']]) ?
                        $URLScanner['classes'][$URLScanner['Class']] : "\x1a\x82\x10\x3fXXX";
                    $phpMussel['InstanceCache']['urlscanner_domains'] .=
                        $URLScanner['This'] .
                        $URLScanner['y'] . ':' .
                        $URLScanner['Class'] . ';';
                    $URLScanner['Class'] = $phpMussel['vn_shorthand']($URLScanner['Class']);
                    $phpMussel['Detected']($heur, $lnap, $URLScanner['Class'], $ofn, $ofnSafe, $Out, $flagged, $md5, $str_len);
                }
                $phpMussel['InstanceCache']['urlscanner_domains'] .= $URLScanner['Domains'][$i] . $URLScanner['y'] . ':;';
            }
            $phpMussel['SaveCache']('urlscanner_domains', $URLScanner['y'], $phpMussel['InstanceCache']['urlscanner_domains']);
        }

        $URLScanner['URLsCount'] = count($URLScanner['URLParts']);

        /** Codeblock for performing Google Safe Browsing API lookups. */
        if ($phpMussel['Config']['urlscanner']['google_api_key'] && $URLScanner['URLsCount']) {
            $URLScanner['URLsChunked'] = (
                $URLScanner['URLsCount'] > 500
            ) ? array_chunk($URLScanner['URLParts'], 500) : [$URLScanner['URLParts']];
            $URLScanner['URLChunks'] = count($URLScanner['URLsChunked']);
            for ($i = 0; $i < $URLScanner['URLChunks']; $i++) {
                if (
                    $phpMussel['Config']['urlscanner']['maximum_api_lookups'] > 0 &&
                    $phpMussel['LookupCount'] > $phpMussel['Config']['urlscanner']['maximum_api_lookups']
                ) {
                    if ($phpMussel['Config']['urlscanner']['maximum_api_lookups_response']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                            $flagged = true;
                        }
                        $Out .= $lnap . sprintf(
                            $phpMussel['L10N']->getString('_exclamation_final'),
                            $phpMussel['L10N']->getString('too_many_urls')
                        ) . "\n";
                        $phpMussel['whyflagged'] .= sprintf(
                            $phpMussel['L10N']->getString('_exclamation'),
                            $phpMussel['L10N']->getString('too_many_urls') . ' (' . $ofnSafe . ')'
                        );
                    }
                    break;
                }
                try {
                    $URLScanner['SafeBrowseLookup'] = $phpMussel['SafeBrowseLookup'](
                        $URLScanner['URLsChunked'][$i],
                        $URLScanner['URLPartsNoLookup'],
                        $URLScanner['DomainPartsNoLookup']
                    );
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
                if ($URLScanner['SafeBrowseLookup'] !== 204) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                        $flagged = true;
                    }
                    $URLScanner['L10N'] = $phpMussel['L10N']->getString(
                        'SafeBrowseLookup_' . $URLScanner['SafeBrowseLookup']
                    ) ?: $phpMussel['L10N']->getString('SafeBrowseLookup_999');
                    $Out .= $lnap . sprintf(
                        $phpMussel['L10N']->getString('_exclamation_final'),
                        $URLScanner['L10N']
                    ) . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $URLScanner['L10N'] . ' (' . $ofnSafe . ')'
                    );
                }
            }
        }

    }

    /** URL scanner data cleanup. */
    unset($URLScanner);

    /** Plugin hook: "before_chameleon_detections". */
    $phpMussel['Execute_Hook']('before_chameleon_detections');

    /** PHP chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_from_php']) {
        if ($phpMussel['ContainsMustAssert']([
            $phpMussel['Config']['attack_specific']['can_contain_php_file_extensions'],
            $phpMussel['Config']['attack_specific']['archive_file_extensions']
        ], [$xts, $gzxts, $xt, $gzxt]) && strpos($str_hex_norm, '3c3f706870') !== false) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PHP')
            ) . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PHP') . ' (' . $ofnSafe . ')'
            );
        }
    }

    /** Executable chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_from_exe']) {
        $Chameleon = '';
        if (strpos(',acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,', ',' . $xt . ',') !== false) {
            if ($twocc !== '4d5a') {
                $Chameleon = 'EXE';
            }
        } elseif ($twocc === '4d5a') {
            $Chameleon = 'EXE';
        }
        if ($xt === 'elf') {
            if ($fourcc !== '7f454c46') {
                $Chameleon = 'ELF';
            }
        } elseif ($fourcc === '7f454c46') {
            $Chameleon = 'ELF';
        }
        if ($xt === 'lnk') {
            if (substr($str_hex, 0, 16) !== '4c00000001140200') {
                $Chameleon = 'LNK';
            }
        } elseif (substr($str_hex, 0, 16) === '4c00000001140200') {
            $Chameleon = 'LNK';
        }
        if ($xt === 'msi' && substr($str_hex, 0, 16) !== 'd0cf11e0a1b11ae1') {
            $Chameleon = 'MSI';
        }
        if ($Chameleon) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon)
            ) . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon) . ' (' . $ofnSafe . ')'
            );
        }
    }

    /** Archive chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_archive']) {
        $Chameleon = '';
        if ($xts === 'zip*' && $twocc !== '504b') {
            $Chameleon = 'Zip';
        } elseif ($xt === 'rar' && ($fourcc !== '52617221' && $fourcc !== '52457e5e')) {
            $Chameleon = 'Rar';
        } elseif ($xt === 'gz' && $twocc !== '1f8b') {
            $Chameleon = 'Gzip';
        } elseif ($xt === 'bz2' && substr($str_hex, 0, 6) !== '425a68') {
            $Chameleon = 'Bzip2';
        }
        if ($Chameleon) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon)
            ) . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon) . ' (' . $ofnSafe . ')'
            );
        }
    }

    /** Office document chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_doc']) {
        if (strpos(',doc,dot,pps,ppt,xla,xls,wiz,', ',' . $xt . ',') !== false) {
            if ($fourcc !== 'd0cf11e0') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['InstanceCache']['detections_count']++;
                $Out .= $lnap . sprintf(
                    $phpMussel['L10N']->getString('_exclamation_final'),
                    sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'Office')
                ) . "\n";
                $phpMussel['whyflagged'] .= sprintf(
                    $phpMussel['L10N']->getString('_exclamation'),
                    sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'Office') . ' (' . $ofnSafe . ')'
                );
            }
        }
    }

    /** Image chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_img']) {
        $Chameleon = '';
        if (
            (($xt === 'bmp' || $xt === 'dib') && $twocc !== '424d') ||
            ($xt === 'gif' && (substr($str_hex, 0, 12) !== '474946383761' && substr($str_hex, 0, 12) !== '474946383961')) ||
            (preg_match('~j(?:fif?|if|peg?|pg)~', $xt) && substr($str_hex, 0, 6) !== 'ffd8ff') ||
            ($xt === 'jp2' && substr($str_hex, 0, 16) !== '0000000c6a502020') ||
            (($xt === 'pdd' || $xt === 'psd') && $fourcc !== '38425053') ||
            ($xt === 'png' && $fourcc !== '89504e47') ||
            ($xt === 'webp' && ($fourcc !== '52494646' || substr($str, 8, 4) !== 'WEBP')) ||
            ($xt === 'xcf' && substr($str, 0, 8) !== 'gimp xcf')
        ) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $phpMussel['L10N']->getString('image'))
            ) . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $phpMussel['L10N']->getString('image')) . ' (' . $ofnSafe . ')'
            );
        }
    }

    /** PDF chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_pdf']) {
        if ($xt === 'pdf' && !$pdf_magic) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PDF')
            ) . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PDF') . ' (' . $ofnSafe . ')'
            );
        }
    }

    /** Control character detection. */
    if ($phpMussel['Config']['attack_specific']['block_control_characters']) {
        if (preg_match('/[\x00-\x08\x0b\x0c\x0e\x1f\x7f]/i', $str)) {
            $Out .= $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('detected_control_characters')
            ) . "\n";
            $heur['detections']++;
            $phpMussel['InstanceCache']['detections_count']++;
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('detected_control_characters') . ' (' . $ofnSafe . ')'
            );
        }
    }

    /**
     * If the heuristic weight of the current scan iteration exceeds the
     * heuristic threshold defined by the configuration, or if outs has already
     * been filled, dump all heuristic detections and non-heuristic detections
     * together into outs and regard the iteration as flagged.
     */
    if (
        $heur['weight'] >= $phpMussel['Config']['heuristic']['threshold'] ||
        $Out
    ) {
        $Out .= $heur['cli'];
        $phpMussel['whyflagged'] .= $heur['web'];
    }

    /** Plugin hook: "before_vt". */
    $phpMussel['Execute_Hook']('before_vt');

    /** Virus Total API integration. */
    if (
        !$Out &&
        !empty($phpMussel['Config']['virustotal']['vt_public_api_key'])
    ) {
        $DoScan = false;
        $phpMussel['Config']['virustotal']['vt_suspicion_level'] =
            (int)$phpMussel['Config']['virustotal']['vt_suspicion_level'];
        if ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 0) {
            $DoScan = ($heur['weight'] > 0);
        } elseif ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 1) {
            $DoScan = (
                $heur['weight'] > 0 ||
                $is_pe ||
                $fileswitch === 'chrome' ||
                $fileswitch === 'java' ||
                $fileswitch === 'docfile' ||
                $fileswitch === 'vt_interest'
            );
        } elseif ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 2) {
            $DoScan = true;
        }
        if ($DoScan) {
            $VTWeight = ['weight' => 0, 'cli' => '', 'web' => ''];
            if (!isset($phpMussel['InstanceCache']['vt_quota'])) {
                $phpMussel['InstanceCache']['vt_quota'] = $phpMussel['FetchCache']('vt_quota');
            }
            $x = 0;
            if (!empty($phpMussel['InstanceCache']['vt_quota'])) {
                $phpMussel['InstanceCache']['vt_quota'] = explode(';', $phpMussel['InstanceCache']['vt_quota']);
                foreach ($phpMussel['InstanceCache']['vt_quota'] as &$phpMussel['ThisQuota']) {
                    if ($phpMussel['ThisQuota'] > $phpMussel['Time']) {
                        $x++;
                    } else {
                        $phpMussel['ThisQuota'] = '';
                    }
                }
                unset($phpMussel['ThisQuota']);
                $phpMussel['InstanceCache']['vt_quota'] =
                    implode(';', $phpMussel['InstanceCache']['vt_quota']);
            }
            if ($x < $phpMussel['Config']['virustotal']['vt_quota_rate']) {
                $VTParams = [
                    'apikey' => $phpMussel['Config']['virustotal']['vt_public_api_key'],
                    'resource' => $md5
                ];
                $VTRequest = $phpMussel['Request'](
                    'https://www.virustotal.com/vtapi/v2/file/report?apikey=' .
                    urlencode($phpMussel['Config']['virustotal']['vt_public_api_key']) .
                    '&resource=' . $md5,
                $VTParams, 12);
                $VTJSON = json_decode($VTRequest, true);
                $y = $phpMussel['Time'] + ($phpMussel['Config']['virustotal']['vt_quota_time'] * 60);
                $phpMussel['InstanceCache']['vt_quota'] .= $y . ';';
                while (substr_count($phpMussel['InstanceCache']['vt_quota'], ';;')) {
                    $phpMussel['InstanceCache']['vt_quota'] = str_ireplace(';;', ';', $phpMussel['InstanceCache']['vt_quota']);
                }
                $phpMussel['SaveCache']('vt_quota', $y + 60, $phpMussel['InstanceCache']['vt_quota']);
                if (isset($VTJSON['response_code'])) {
                    $VTJSON['response_code'] = (int)$VTJSON['response_code'];
                    if (
                        isset($VTJSON['scans']) &&
                        $VTJSON['response_code'] === 1 &&
                        is_array($VTJSON['scans'])
                    ) {
                        foreach ($VTJSON['scans'] as $VTKey => $VTValue) {
                            if ($VTValue['detected'] && $VTValue['result']) {
                                $VN = $VTKey . '(VirusTotal)-' . $VTValue['result'];
                                if (
                                    strpos($phpMussel['InstanceCache']['greylist'], ',' . $VN . ',') === false &&
                                    empty($phpMussel['InstanceCache']['ignoreme'])
                                ) {
                                    if (!$flagged) {
                                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                        $flagged = true;
                                    }
                                    $heur['detections']++;
                                    $phpMussel['InstanceCache']['detections_count']++;
                                    if ($phpMussel['Config']['virustotal']['vt_weighting'] > 0) {
                                        $VTWeight['weight']++;
                                        $VTWeight['web'] .= $lnap . sprintf(
                                            $phpMussel['L10N']->getString('_exclamation'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN)
                                        ) . "\n";
                                        $VTWeight['cli'] .= sprintf(
                                            $phpMussel['L10N']->getString('_exclamation'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $ofnSafe . ')'
                                        );
                                    } else {
                                        $Out .= $lnap . sprintf(
                                            $phpMussel['L10N']->getString('_exclamation_final'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN)
                                        ) . "\n";
                                        $phpMussel['whyflagged'] .= sprintf(
                                            $phpMussel['L10N']->getString('_exclamation'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $ofnSafe . ')'
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
                if (
                    $VTWeight['weight'] > 0 &&
                    $VTWeight['weight'] >= $phpMussel['Config']['virustotal']['vt_weighting']
                ) {
                    $Out .= $VTWeight['web'];
                    $phpMussel['whyflagged'] .= $VTWeight['cli'];
                }
            }
        }
    }

    /** Plugin hook: "after_vt". */
    $phpMussel['Execute_Hook']('after_vt');

    if (
        isset($phpMussel['HashCacheData']) &&
        !isset($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']]) &&
        $phpMussel['Config']['general']['scan_cache_expiry'] > 0
    ) {
        if (empty($phpMussel['HashCache']['Data']) || !is_array($phpMussel['HashCache']['Data'])) {
            $phpMussel['HashCache']['Data'] = [];
        }
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']] = [
            $phpMussel['HashCacheData'],
            $phpMussel['Time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
            (empty($Out) ? '' : bin2hex($Out)),
            (empty($phpMussel['whyflagged']) ? '' : bin2hex($phpMussel['whyflagged']))
        ];
    }

    /** Set final debug values, if this has been enabled. */
    if (isset($phpMussel['DebugArr'], $phpMussel['DebugArrKey'])) {
        $phpMussel['DebugArr'][$phpMussel['DebugArrKey']]['Results'] = !$Out ? 1 : 2;
        $phpMussel['DebugArr'][$phpMussel['DebugArrKey']]['Output'] = $Out;
    }

    if ($Out) {
        /** Register object flagged. */
        if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] == 'cli_scan') {
            $phpMussel['Stats-Increment']('CLI-Flagged', 1);
        } else {
            $phpMussel['Stats-Increment']($phpMussel['EOF'] ? 'API-Flagged' : 'Web-Blocked', 1);
        }
    }

    /** Exit data handler. */
    return !$Out ? [1, ''] : [2, $Out];
};

/**
 * Splits a signature into its constituent parts (name, pattern, etc).
 *
 * @param string $Sig The signature.
 * @param int $Max The maximum number of parts to return (optional).
 * @return array The parts.
 */
$phpMussel['SplitSigParts'] = function ($Sig, $Max = -1) {
    return preg_split('~(?<!\?|\<)\:~', $Sig, $Max, PREG_SPLIT_NO_EMPTY);
};

/**
 * Handles scanning for files contained within archives.
 *
 * @param string $x Scan results inherited from parent in the form of a string.
 * @param int $r Scan results inherited from parent in the form of an integer.
 * @param string $Indent Line padding for the scan results.
 * @param string $ItemRef A reference to the path and original filename of the
 *      item being scanned in relation to its container and/or its hierarchy
 *      within the scan process.
 * @param string $Filename The original filename of the item being scanned.
 * @param string $Data The data to be scanned.
 * @param int $Depth The depth of the item being scanned in relation to its
 *      container and/or its hierarchy within the scan process.
 * @param string $MD5 A hash for the content, inherited from the parent.
 */
$phpMussel['MetaDataScan'] = function (&$x, &$r, $Indent, $ItemRef, $Filename, &$Data, $Depth, $MD5) use (&$phpMussel) {

    /** Plugin hook: "MetaDataScan_start". */
    $phpMussel['Execute_Hook']('MetaDataScan_start');

    /** Data is empty. Nothing to scan. Exit early. */
    if (!$Filesize = strlen($Data)) {
        return;
    }

    /** Filesize thresholds. */
    if (
        $phpMussel['Config']['files']['filesize_archives'] &&
        $phpMussel['Config']['files']['filesize_limit'] > 0 &&
        $Filesize > $phpMussel['ReadBytes']($phpMussel['Config']['files']['filesize_limit'])
    ) {
        if (!$phpMussel['Config']['files']['filesize_response']) {
            $x .=
                $Indent . $phpMussel['L10N']->getString('ok') . ' (' .
                $phpMussel['L10N']->getString('filesize_limit_exceeded') . ").\n";
            return;
        }
        $r = 2;
        $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ItemRef . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('filesize_limit_exceeded') . ' (' . $ItemRef . ')'
        );
        $x .=
            $Indent . $phpMussel['L10N']->getString('filesize_limit_exceeded') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
        return;
    }

    /** Process filetype blacklisting, whitelisting, and greylisting. */
    if ($phpMussel['Config']['files']['filetype_archives']) {
        list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($Filename);
        if ($phpMussel['ContainsMustAssert']([
            $phpMussel['Config']['files']['filetype_whitelist']
        ], [$xt, $xts], ',', true, true)) {
            $x .= $Indent . $phpMussel['L10N']->getString('scan_no_problems_found') . "\n";
            return;
        }
        if ($phpMussel['ContainsMustAssert']([
            $phpMussel['Config']['files']['filetype_blacklist']
        ], [$xt, $xts], ',', true, true)) {
            $r = 2;
            $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ItemRef . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $ItemRef . ')'
            );
            $x .=
                $Indent . $phpMussel['L10N']->getString('filetype_blacklisted') .
                $phpMussel['L10N']->getString('_fullstop_final') . "\n";
            return;
        }
        if (!empty($phpMussel['Config']['files']['filetype_greylist']) && $phpMussel['ContainsMustAssert']([
            $phpMussel['Config']['files']['filetype_greylist']
        ], [$xt, $xts])) {
            $r = 2;
            $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ItemRef . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $ItemRef . ')'
            );
            $x .=
                $Indent . $phpMussel['L10N']->getString('filetype_blacklisted') .
                $phpMussel['L10N']->getString('_fullstop_final') . "\n";
            return;
        }
    }

    /** Determine whether the file being scanned is a macro. */
    $phpMussel['InstanceCache']['file_is_macro'] = (
        preg_match('~vbaProject\.bin$~i', $Filename) ||
        preg_match('~^\xd0\xcf|\x00Attribut|\x01CompObj|\x05Document~', $Data)
    );

    /** Handle macro detection and blocking. */
    if ($phpMussel['Config']['attack_specific']['block_macros'] && $phpMussel['InstanceCache']['file_is_macro']) {
        $r = 2;
        $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ItemRef . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('macros_not_permitted') . ' (' . $ItemRef . ')'
        );
        $x .= $Indent . $phpMussel['L10N']->getString('macros_not_permitted') . $phpMussel['L10N']->getString('_fullstop_final') . "\n";
        return;
    }

    /** Increment objects scanned count. */
    $phpMussel['InstanceCache']['objects_scanned']++;

    /** Send the scan target to the data handler. */
    try {
        $Scan = $phpMussel['DataHandler']($Data, $Depth, $Filename);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }

    /**
     * Check whether the file is compressed. If it's compressed, attempt to
     * decompress it, and then scan the decompressed version of the file. We'll
     * only bother doing this if the file hasn't already been flagged though.
     */
    if ($Scan[0] === 1) {

        /** Create a new compression object. */
        $CompressionObject = new \phpMussel\CompressionHandler\CompressionHandler($Data);

        /** Now we'll try to decompress the file. */
        if (!$CompressionResults = $CompressionObject->TryEverything()) {

            /** Success! Now we'll send it to the data handler. */
            try {
                $Scan = $phpMussel['DataHandler']($CompressionObject->Data, $Depth, $phpMussel['DropTrailingCompressionExtension']($Filename));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }

            /**
             * Replace originally scanned data with decompressed data in case
             * needed by the archive handler.
             */
            $Data = $CompressionObject->Data;

        }

        /** Cleanup. */
        unset($CompressionResults, $CompressionObject);

    }

    /** Destroy item-specific metadata set by the archive handler instance. */
    unset($phpMussel['CrxPubKey'], $phpMussel['CrxSig']);

    /** Update the results if anything bad was found and then exit. */
    if ($Scan[0] !== 1) {
        $r = $Scan[0];
        $x .= '-' . $Scan[1];
        return;
    }

    /** Or, if nothing bad was found for this entry, make a note of it. */
    $x .= $Indent . $phpMussel['L10N']->getString('scan_no_problems_found') . "\n";

};

/**
 * Looks for indicators of image files (i.e., attempts to determine whether a
 * file is an image file).
 *
 * @param string $Ext The file extension.
 * @param string $Head The file header.
 * @return bool True: Indicators found. False: Indicators not found.
 */
$phpMussel['Indicator-Image'] = function ($Ext, $Head) {
    return (
        preg_match(
            '/^(?:bm[2p]|c(d5|gm)|d(ib|w[fg]|xf)|ecw|fits|gif|img|j(f?if?|p[2s]|pe?g?2?|xr)|p(bm|cx|dd|gm|ic|n[gms]|' .
            'pm|s[dp])|s(id|v[ag])|tga|w(bmp?|ebp|mp)|x(cf|bmp))$/'
        , $Ext) ||
        preg_match(
            '/^(?:0000000c6a502020|25504446|38425053|424d|474946383[79]61|57454250|67696d7020786366|89504e47|ffd8ff)/'
        , $Head)
    );
};

/**
 * Fetches extensions data from filenames.
 *
 * @param string $ofn The original filename.
 * @return array The extensions data.
 */
$phpMussel['FetchExt'] = function ($ofn) {
    $decPos = strrpos($ofn, '.');
    $ofnLen = strlen($ofn);
    if ($decPos === false || $decPos === ($ofnLen - 1)) {
        return ['-', '-', '-', '-'];
    }
    $xt = strtolower(substr($ofn, ($decPos + 1)));
    $xts = substr($xt, 0, 3) . '*';
    if (strtolower(substr($ofn, -3)) === '.gz') {
        $ofnNoGZ = substr($ofn, 0, ($ofnLen - 3));
        $decPosNoGZ = strrpos($ofnNoGZ, '.');
        if ($decPosNoGZ !== false && $decPosNoGZ !== (strlen($ofnNoGZ) - 1)) {
            $gzxt = strtolower(substr($ofnNoGZ, ($decPosNoGZ + 1)));
            $gzxts = substr($gzxt, 0, 3) . '*';
        }
    } else {
        $gzxts = $gzxt = '-';
    }
    return [$xt, $xts, $gzxt, $gzxts];
};

/**
 * Remove occurrence of $A from leading substring of $B.
 */
$phpMussel['RemoveLeadMatch'] = function ($A, $B) {
    $LenA = strlen($A);
    $LenB = strlen($B);
    for ($Iter = 0; $Iter < $LenA && $Iter < $LenB; $Iter++) {
        $CharA = substr($A, $Iter, 1);
        $CharB = substr($B, $Iter, 1);
        if ($CharA !== $CharB) {
            break;
        }
    }
    return ($Iter === $LenB) ? '' : substr($B, $Iter);
};

/**
 * Get substring of string after final slash.
 */
$phpMussel['SubstrAfterFinalSlash'] = function ($String) {
    return strpos($String, '/') !== false ? substr($String, strrpos($String, '/') + 1) : (
        strpos($String, "\\") !== false ? substr($String, strrpos($String, "\\") + 1) : $String
    );
};

/**
 * Responsible for recursing through any files given to it to be scanned, which
 * may be necessary for the case of archives and directories. It performs the
 * preparations necessary for scanning files using the "data handler" and the
 * "meta data scan" closures. Additionally, it performs some necessary
 * whitelist, blacklist and greylist checks, filesize and file extension
 * checks, and handles the processing and extraction of files from archives,
 * fetching the files contained in archives being scanned in order to process
 * those contained files as so that they, too, may be scanned.
 *
 * When phpMussel is instructed to scan a directory or an array of multiple
 * files, the recursor is the closure function responsible for iterating
 * through that directory and/or array queued for scanning, and if necessary,
 * will recurse itself (such as for when scanning a directory containing
 * sub-directories or when scanning a multidimensional array of multiple files
 * and/or directories).
 *
 * @param string|array $f In the context of the initial file upload scanning
 *      that phpMussel performs when operating via a server, this parameter (a
 *      string) represents the "temporary filename" of the file being scanned
 *      (the temporary filename, in this context, referring to the name
 *      temporarily assigned to the file by the server upon the file being
 *      uploaded to the temporary uploads location assigned to the server).
 *      When operating in the context of CLI mode, both $f and $ofn represent
 *      the scan target, as per specified by the CLI operator; The only
 *      difference between the two is when the scan target is a directory,
 *      rather than a single file; $f will represent the full path to the file
 *      (so, directory plus filename), whereas $ofn will represent only the
 *      filename. This parameter can also accept an array of filenames.
 * @param bool $n This optional parameter is a boolean (defaults to false, but
 *      set to true during the initial scan of file uploads), indicating the
 *      format for returning the scan results. False instructs the function to
 *      return results as an integer; True instructs the function to return
 *      results as human readable text (refer to Section 3A of the README
 *      documentation, "HOW TO USE (FOR WEB SERVERS)", for more information).
 * @param bool $zz This optional parameter is a boolean (defaults to false, but
 *      set to true during the initial scan of file uploads), indicating to the
 *      function whether or not arrayed results should be imploded prior to
 *      being returned to the calling function. False instructs the function to
 *      return the arrayed results as verbatim; True instructs the function to
 *      return the arrayed results as an imploded string.
 * @param int $dpt Represents the current depth of recursion from which the
 *      function has been called. This information is used for determining how
 *      far to indent any entries generated for logging and for the display of
 *      scan results in CLI (you should never manually set this parameter
 *      yourself).
 * @param string $ofn For the file upload scanning that phpMussel normally
 *      performs by default, this parameter represents the "original filename"
 *      of the file being scanned (the original filename, in this context,
 *      referring to the name supplied by the upload client, as opposed to the
 *      temporary filename assigned by the server or anything else).
 *      When operating in the context of CLI mode, both $f and $ofn represent
 *      the scan target, as per specified by the CLI operator; The only
 *      difference between the two is when the scan target is a directory,
 *      rather than a single file; $f will represent the full path to the file
 *      (so, directory plus filename), whereas $ofn will represent only the
 *      filename.
 * @return int|string|array The scan results, returned as an array when the $f
 *      parameter is an array and when $n and/or $zz is/are false, and
 *      otherwise returned as per described by the README documentation. The
 *      function may also die the script and return nothing, if something goes
 *      wrong, such as if the function is triggered in the absence of the
 *      required $phpMussel['InstanceCache'] variable being set.
 */
$phpMussel['Recursor'] = function ($f = '', $n = false, $zz = false, $dpt = 0, $ofn = '') use (&$phpMussel) {
    if (!isset($phpMussel['InstanceCache'])) {
        throw new \Exception($phpMussel['L10N']->getString(
            'required_variables_not_defined'
        ) ?: '[phpMussel] Required variables aren\'t defined: Can\'t continue.');
    }

    /** Plugin hook: "Recursor_start". */
    $phpMussel['Execute_Hook']('Recursor_start');

    /** Prepare signature files for the scan process. */
    if (empty($phpMussel['InstanceCache']['OrganisedSigFiles'])) {
        $phpMussel['OrganiseSigFiles']();
        $phpMussel['InstanceCache']['OrganisedSigFiles'] = true;
    }

    if ($phpMussel['EOF']) {
        $phpMussel['whyflagged'] = $phpMussel['killdata'] = $phpMussel['PEData'] = '';
        if ($dpt === 0 || !isset(
            $phpMussel['InstanceCache']['objects_scanned'],
            $phpMussel['InstanceCache']['detections_count'],
            $phpMussel['InstanceCache']['scan_errors']
        )) {
            $phpMussel['InstanceCache']['objects_scanned'] = 0;
            $phpMussel['InstanceCache']['detections_count'] = 0;
            $phpMussel['InstanceCache']['scan_errors'] = 0;
        }
    } else {
        if (!isset($phpMussel['killdata'])) {
            $phpMussel['killdata'] = '';
        }
        if (!isset($phpMussel['whyflagged'])) {
            $phpMussel['whyflagged'] = '';
        }
        if (!isset($phpMussel['PEData'])) {
            $phpMussel['PEData'] = '';
        }
        if (!isset(
            $phpMussel['InstanceCache']['objects_scanned'],
            $phpMussel['InstanceCache']['detections_count'],
            $phpMussel['InstanceCache']['scan_errors']
        )) {
            $phpMussel['InstanceCache']['objects_scanned'] = 0;
            $phpMussel['InstanceCache']['detections_count'] = 0;
            $phpMussel['InstanceCache']['scan_errors'] = 0;
        }
    }

    /** Increment scan depth. */
    $dpt++;
    /** Controls indenting relating to scan depth for normal logging and for CLI-mode scanning. */
    $lnap = str_pad('> ', ($dpt + 1), '-', STR_PAD_LEFT);

    /**
     * If the scan target is an array, iterate through the array and recurse
     * the recursor with each array element.
     */
    if (is_array($f)) {
        foreach ($f as &$Current) {
            try {
                $Current = $phpMussel['Recursor']($Current, $n, false, $dpt, $Current);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return ($n && $zz) ? $phpMussel['implode_md']($f) : $f;
    }

    $ofn = $phpMussel['prescan_decode']($ofn);
    $ofnSafe = urlencode($ofn);

    /**
     * If the scan target is a directory, iterate through the directory
     * contents and recurse the recursor with these contents.
     */
    if (is_dir($f)) {
        if (!is_readable($f)) {
            $phpMussel['InstanceCache']['scan_errors']++;
            return !$n ? 0 : $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('failed_to_access'), $ofn)
            ) . "\n";
        }
        $Dir = $phpMussel['DirectoryRecursiveList']($f);
        foreach ($Dir as &$Sub) {
            try {
                $Sub = $phpMussel['Recursor']($f . '/' . $Sub, $n, false, $dpt, $Sub);
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
        return ($n && $zz) ? $phpMussel['implode_md']($Dir) : $Dir;
    }

    /** Define file phase. */
    $phpMussel['InstanceCache']['phase'] = 'file';

    /** Indicates whether the scan target is a part of a container. */
    $phpMussel['InstanceCache']['container'] = 'none';

    /** Indicates whether the scan target is an OLE object. */
    $phpMussel['InstanceCache']['file_is_ole'] = false;

    /** Fetch the greylist if it hasn't already been fetched. */
    if (!isset($phpMussel['InstanceCache']['greylist'])) {
        if (!file_exists($phpMussel['Vault'] . 'greylist.csv')) {
            $phpMussel['InstanceCache']['greylist'] = ',';
            $Handle = fopen($phpMussel['Vault'] . 'greylist.csv', 'a');
            fwrite($Handle, ',');
            fclose($Handle);
        } else {
            $phpMussel['InstanceCache']['greylist'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'greylist.csv');
        }
    }

    /** Plugin hook: "before_scan". */
    $phpMussel['Execute_Hook']('before_scan');

    $fnCRC = hash('crc32b', $ofn);

    /** Kill it here if the scan target isn't a valid file. */
    if (!$f || !$d = is_file($f)) {
        return (!$n) ? 0 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                $phpMussel['L10N']->getString('invalid_file')
            ) . "\n";
    }

    $fS = filesize($f);
    if ($phpMussel['Config']['files']['filesize_limit'] > 0) {
        if ($fS > $phpMussel['ReadBytes']($phpMussel['Config']['files']['filesize_limit'])) {
            if (!$phpMussel['Config']['files']['filesize_response']) {
                return (!$n) ? 1 :
                    $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
                    $ofn . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
                    $phpMussel['L10N']->getString('ok') . ' (' .
                    $phpMussel['L10N']->getString('filesize_limit_exceeded') . ").\n";
            }
            $phpMussel['killdata'] .= '--FILESIZE-LIMIT--------NO-HASH-:' . $fS . ':' . $ofn . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('filesize_limit_exceeded') . ' (' . $ofnSafe . ')'
            );
            if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
                unlink($f);
            }
            return (!$n) ? 2 :
                $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $ofn .
                '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
                $phpMussel['L10N']->getString('filesize_limit_exceeded') .
                $phpMussel['L10N']->getString('_fullstop_final') . "\n";
        }
    }
    if (!$phpMussel['Config']['attack_specific']['allow_leading_trailing_dots'] && (
        substr($ofn, 0, 1) === '.' || substr($ofn, -1) === '.'
    )) {
        $phpMussel['killdata'] .= '--FILENAME-MANIPULATION-NO-HASH-:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('scan_filename_manipulation_detected') . ' (' . $ofnSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                $phpMussel['L10N']->getString('scan_filename_manipulation_detected')
            ) . "\n";
    }

    /** Get file extensions. */
    list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($ofn);

    /** Process filetype whitelisting. */
    if ($phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_whitelist']
    ], [$xt, $xts, $gzxt, $gzxts], ',', true, true)) {
        return (!$n) ? 1 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['L10N']->getString('scan_no_problems_found') . "\n";
    }

    /** Process filetype blacklisting. */
    if ($phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_blacklist']
    ], [$xt, $xts, $gzxt, $gzxts], ',', true, true)) {
        $phpMussel['killdata'] .= '--FILETYPE-BLACKLISTED--NO-HASH-:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $ofnSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $ofn . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['L10N']->getString('filetype_blacklisted') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
    }

    /** Process filetype greylisting (when relevant). */
    if (!empty($phpMussel['Config']['files']['filetype_greylist']) && $phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_greylist']
    ], [$xt, $xts, $gzxt, $gzxts])) {
        $phpMussel['killdata'] .= '----FILETYPE--NOT-GREYLISTED----:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $ofnSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $ofn . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['L10N']->getString('filetype_blacklisted') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
    }

    /** Read in the file to be scanned. */
    $in = $phpMussel['ReadFile']($f, (
        $phpMussel['Config']['attack_specific']['scannable_threshold'] > 0 &&
        $fS > $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold'])
    ) ? $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold']) : $fS, true);

    /** Generate CRC for the file to be scanned. */
    $fdCRC = hash('crc32b', $in);

    /** Check for non-image items. */
    if (!empty($in) && $phpMussel['Config']['compatibility']['only_allow_images'] && !$phpMussel['Indicator-Image']($xt, bin2hex(substr($in, 0, 16)))) {
        $phpMussel['killdata'] .= md5($in) . ':' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('only_allow_images') . ' (' . $ofnSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $ofn . '\' (FN: ' . $fnCRC . '; FD: ' . $fdCRC . "):\n-" .
            $lnap . $phpMussel['L10N']->getString('only_allow_images') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
    }

    /** Increment objects scanned count. */
    $phpMussel['InstanceCache']['objects_scanned']++;

    /** Send the scan target to the data handler. */
    try {
        $z = $phpMussel['DataHandler']($in, $dpt, $ofn);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }

    /**
     * Check whether the file is compressed. If it's compressed, attempt to
     * decompress it, and then scan the decompressed version of the file. We'll
     * only bother doing this if the file hasn't already been flagged though.
     */
    if ($z[0] === 1) {

        /** Create a new compression object. */
        $CompressionObject = new \phpMussel\CompressionHandler\CompressionHandler($in);

        /** Now we'll try to decompress the file. */
        if (!$CompressionResults = $CompressionObject->TryEverything()) {

            /** Success! Now we'll send it to the data handler. */
            try {
                $z = $phpMussel['DataHandler']($CompressionObject->Data, $dpt, $phpMussel['DropTrailingCompressionExtension']($ofn));
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }

            /**
             * Replace originally scanned data with decompressed data in case
             * needed by the archive handler.
             */
            $in = $CompressionObject->Data;

        }

        /** Cleanup. */
        unset($CompressionResults, $CompressionObject);

    }

    /** Executed if there were any problems or if anything was detected. */
    if ($z[0] !== 1) {

        /** Quarantine if necessary. */
        if ($z[0] === 2) {
            if (
                $phpMussel['Config']['general']['quarantine_key'] &&
                !$phpMussel['Config']['general']['honeypot_mode'] &&
                strlen($in) < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
            ) {
                $qfu =
                    $phpMussel['Time'] .
                    '-' .
                    md5($phpMussel['Config']['general']['quarantine_key'] . $fdCRC . $phpMussel['Time']);
                $phpMussel['Quarantine'](
                    $in,
                    $phpMussel['Config']['general']['quarantine_key'],
                    $_SERVER[$phpMussel['IPAddr']],
                    $qfu
                );
                $phpMussel['killdata'] .= sprintf($phpMussel['L10N']->getString('quarantined_as'), $qfu) . "\n";
            }
        }

        /** Delete if necessary. */
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }

        /** Exit. */
        return !$n ? $z[0] : sprintf(
            '%s%s \'%s\' (FN: %s; FD: %s):%s%s',
            $lnap,
            $phpMussel['L10N']->getString('scan_checking'),
            $ofn,
            $fnCRC,
            $fdCRC,
            "\n",
            $z[1]
        );

    }

    $x = sprintf(
        '%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s-%1$s%7$s%6$s',
        $lnap,
        $phpMussel['L10N']->getString('scan_checking'),
        $ofn,
        $fnCRC,
        $fdCRC,
        "\n",
        $phpMussel['L10N']->getString('scan_no_problems_found')
    );

    /** Results. */
    $r = 1;

    /**
     * Begin archive phase.
     * Note: Archive phase will only occur when "check_archives" is enabled and
     * when no problems were detected with the scan target by this point.
     */
    if (
        $phpMussel['Config']['files']['check_archives'] &&
        !empty($in) &&
        $phpMussel['Config']['files']['max_recursion'] > 1
    ) {

        /** Define archive phase. */
        $phpMussel['InstanceCache']['phase'] = 'archive';

        /** In case there's any temporary files we need to delete afterwards. */
        $phpMussel['InstanceCache']['tempfilesToDelete'] = [];

        /** Begin processing archives. */
        $phpMussel['ArchiveRecursor']($x, $r, $in, (isset($CompressionResults) && !$CompressionResults) ? '' : $f, 0, urlencode($ofn));

        /** Begin deleting any temporary files that snuck through. */
        foreach ($phpMussel['InstanceCache']['tempfilesToDelete'] as $DeleteThis) {
            if (file_exists($DeleteThis)) {
                unlink($DeleteThis);
            }
        }

    }

    /** Quarantine if necessary. */
    if ($r === 2) {
        if (
            $phpMussel['Config']['general']['quarantine_key'] &&
            !$phpMussel['Config']['general']['honeypot_mode'] &&
            strlen($in) < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
        ) {
            $qfu = $phpMussel['Time'] . '-' . md5(
                $phpMussel['Config']['general']['quarantine_key'] . $fdCRC . $phpMussel['Time']
            );
            $phpMussel['Quarantine'](
                $in,
                $phpMussel['Config']['general']['quarantine_key'],
                $_SERVER[$phpMussel['IPAddr']],
                $qfu
            );
            $phpMussel['killdata'] .= sprintf($phpMussel['L10N']->getString('quarantined_as'), $qfu);
        }
    }

    /** Delete if necessary. */
    if ($r !== 1 && $phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
        unlink($f);
    }

    /** Exit. */
    return !$n ? $r : $x;
};

/**
 * Quine detection for the archive handler.
 *
 * @param int $ScanDepth The current scan depth.
 * @param string $ParentHash Parent data hash.
 * @param int $ParentLen Parent data length.
 * @param string $ChildHash Child data hash.
 * @param int $ChildLen Child data length.
 * @return bool True when a quine is detected; False otherwise.
 */
$phpMussel['QuineDetector'] = function ($ScanDepth, $ParentHash, $ParentLen, $ChildHash, $ChildLen) use (&$phpMussel) {
    $phpMussel['Quine'][$ScanDepth - 1] = [$ParentHash, $ParentLen];
    for ($Iterate = 0; $Iterate < $ScanDepth; $Iterate++) {
        if ($phpMussel['Quine'][$Iterate][0] === $ChildHash && $phpMussel['Quine'][$Iterate][1] === $ChildLen) {
            return true;
        }
    }
    return false;
};

/**
 * Convert Chrome Extension data to standard Zip data.
 *
 * @param string $Data Referenced via the archive recursor.
 * @return bool True when conversion succeeds; False otherwise (e.g., not Crx).
 */
$phpMussel['ConvertCRX'] = function (&$Data) use (&$phpMussel) {
    if (substr($Data, 0, 4) !== 'Cr24' || strlen($Data) <= 16) {
        return false;
    }
    $CRX = ['Version' => unpack('i*', substr($Data, 4, 4))];
    if ($CRX['Version'][1] === 2) {
        $CRX['PubKeyLen'] = unpack('i*', substr($Data, 8, 4));
        $CRX['SigLen'] = unpack('i*', substr($Data, 12, 4));
        $ZipBegin = 16 + $CRX['PubKeyLen'][1] + $CRX['SigLen'][1];
        if (substr($Data, $ZipBegin, 2) === 'PK') {
            $phpMussel['CrxPubKey'] = bin2hex(substr($Data, 16, $CRX['PubKeyLen'][1]));
            $phpMussel['CrxSig'] = bin2hex(substr($Data, 16 + $CRX['PubKeyLen'][1], $CRX['SigLen'][1]));
            $Data = substr($Data, $ZipBegin);
            return true;
        }
    }
    return false;
};

/**
 * Archive recursor.
 *
 * This is where we recurse through archives during the scan.
 *
 * @param string $x Scan results inherited from parent in the form of a string.
 * @param int $r Scan results inherited from parent in the form of an integer.
 * @param string $Data The data to be scanned (preferably an archive).
 * @param string $File A path to the file, to be able to access it directly if
 *      needed (because the zip and rar classes require a file pointer).
 * @param int $ScanDepth The current scan depth (supplied during recursion).
 * @param string $ItemRef A reference to the parent container (for logging).
 */
$phpMussel['ArchiveRecursor'] = function (&$x, &$r, $Data, $File = '', $ScanDepth = 0, $ItemRef = '') use (&$phpMussel) {

    /** Plugin hook: "ArchiveRecursor_start". */
    $phpMussel['Execute_Hook']('ArchiveRecursor_start');

    /** Create quine detection array. */
    if (!$ScanDepth || !isset($phpMussel['Quine'])) {
        $phpMussel['Quine'] = [];
    }

    /** Count recursion depth. */
    $ScanDepth++;

    /** Used for CLI and logging. */
    $Indent = str_pad('> ', $ScanDepth + 1, '-', STR_PAD_LEFT);

    /** Reset container definition. */
    $phpMussel['InstanceCache']['container'] = 'none';

    /** The class to use to handle the data to be scanned. */
    $Handler = '';

    /** The type of container to be scanned (mostly just for logging). */
    $ConType = '';

    /** Check whether Crx, and convert if necessary. */
    if ($phpMussel['ConvertCRX']($Data)) {
        /** Reset the file pointer (because the content has been modified anyway). */
        $File = '';
    }

    /** Get file extensions. */
    if ($File) {
        list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($File);
    } elseif ($Exts = $phpMussel['substral']($ItemRef, '.')) {
        list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($Exts);
    } else {
        $xt = $xts = $gzxt = $gzxts = '';
    }

    /** Set appropriate container definitions and specify handler class. */
    if (substr($Data, 0, 2) === 'PK') {
        $Handler = 'ZipHandler';
        if ($xt === 'ole') {
            $ConType = 'OLE';
        } elseif ($xt === 'crx') {
            $ConType = 'Crx';
        } elseif ($xt === 'smpk') {
            $ConType = 'SMPTE';
        } elseif ($xt === 'xpi') {
            $ConType = 'XPInstall';
        } elseif ($xts === 'app*') {
            $ConType = 'App';
        } elseif (strpos(
            ',docm,docx,dotm,dotx,potm,potx,ppam,ppsm,ppsx,pptm,pptx,xlam,xlsb,xlsm,xlsx,xltm,xltx,',
            ',' . $xt . ','
        ) !== false) {
            $ConType = 'OpenXML';
        } elseif (strpos(
            ',odc,odf,odg,odm,odp,ods,odt,otg,oth,otp,ots,ott,',
            ',' . $xt . ','
        ) !== false || $xts === 'fod*') {
            $ConType = 'OpenDocument';
        } elseif (strpos(',opf,epub,', ',' . $xt . ',') !== false) {
            $ConType = 'EPUB';
        } else {
            $ConType = 'ZIP';
            $phpMussel['InstanceCache']['container'] = 'zipfile';
        }
        if ($ConType !== 'ZIP') {
            $phpMussel['InstanceCache']['file_is_ole'] = true;
            $phpMussel['InstanceCache']['container'] = 'pkfile';
        }
    } elseif (
        substr($Data, 257, 6) === "ustar\x00" ||
        strpos(',tar,tgz,tbz,tlz,tz,', ',' . $xt . ',') !== false
    ) {
        $Handler = 'TarHandler';
        $ConType = 'TarFile';
        $phpMussel['InstanceCache']['container'] = 'tarfile';
    } elseif (substr($Data, 0, 4) === 'Rar!' || substr($Data, 0, 4) === "\x52\x45\x7e\x5e") {
        $Handler = 'RarHandler';
        $ConType = 'RarFile';
        $phpMussel['InstanceCache']['container'] = 'rarfile';
    }

    /** Not an archive. Exit early. */
    if (!$Handler) {
        return;
    }

    /** Call the archive handler. */
    if (!class_exists('\phpMussel\ArchiveHandler\ArchiveHandler')) {
        require $phpMussel['Vault'] . 'classes/ArchiveHandler.php';
    }

    /** Hash the current input data. */
    $DataHash = md5($Data);

    /** Fetch length of current input data. */
    $DataLen = strlen($Data);

    /** Handle zip files. */
    if ($Handler === 'ZipHandler') {
        /**
         * Encryption guard.
         * See: https://pkware.cachefly.net/webdocs/casestudies/APPNOTE.TXT
         */
        if ($phpMussel['Config']['files']['block_encrypted_archives']) {
            $Bits = $phpMussel['explode_bits'](substr($Data, 6, 2));
            if ($Bits && $Bits[7]) {
                $r = -4;
                $phpMussel['killdata'] .= $DataHash . ':' . $DataLen . ':' . $ItemRef . "\n";
                $phpMussel['whyflagged'] .= sprintf(
                    $phpMussel['L10N']->getString('_exclamation'),
                    $phpMussel['L10N']->getString('encrypted_archive') . ' (' . $ItemRef . ')'
                );
                $x .= sprintf(
                    '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                    $Indent,
                    $phpMussel['L10N']->getString('scan_checking'),
                    $ItemRef,
                    hash('crc32b', $File),
                    hash('crc32b', $Data),
                    "\n",
                    $phpMussel['L10N']->getString('encrypted_archive'),
                    $phpMussel['L10N']->getString('_fullstop_final')
                );
                return;
            }
        }

        /** Guard. */
        if (!class_exists('ZipArchive')) {
            if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                $r = -1;
                $phpMussel['killdata'] .= $DataHash . ':' . $DataLen . ':' . $ItemRef . "\n";
                $phpMussel['whyflagged'] .= $phpMussel['L10N']->getString('scan_extensions_missing') . ' (Zip)';
                $x .= sprintf(
                    '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%6$s',
                    $Indent,
                    $phpMussel['L10N']->getString('scan_checking'),
                    $ItemRef,
                    hash('crc32b', $File),
                    hash('crc32b', $Data),
                    "\n",
                    $phpMussel['L10N']->getString('scan_extensions_missing') . ' (Zip)'
                );
                return;
            }
        }

        /** ZipHandler needs a file pointer. */
        if (!$File || !is_readable($File)) {
            /**
             * File pointer not available. Probably already inside an
             * archive. Let's create a temporary file for this.
             */
            $PointerObject = new \phpMussel\TemporaryFileHandler\TemporaryFileHandler($Data, $phpMussel['cachePath']);
            $Pointer = &$PointerObject->Filename;
            $phpMussel['InstanceCache']['tempfilesToDelete'][] = $Pointer;
        } else {
            /** File pointer available. Let's reference it. */
            $Pointer = &$File;
        }

        /** We have a valid a pointer. Let's instantiate the object. */
        if ($Pointer) {
            $ArchiveObject = new \phpMussel\ArchiveHandler\ZipHandler($Pointer);
        }
    }

    /** Handle tar files. */
    if ($Handler === 'TarHandler') {
        /** TarHandler can work with data directly. */
        $ArchiveObject = new \phpMussel\ArchiveHandler\TarHandler($Data);
    }

    /** Handle rar files. */
    if ($Handler === 'RarHandler') {

        /** Guard. */
        if (!class_exists('RarArchive') || !class_exists('RarEntry')) {
            if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                $r = -1;
                $phpMussel['killdata'] .= $DataHash . ':' . $DataLen . ':' . $ItemRef . "\n";
                $phpMussel['whyflagged'] .= $phpMussel['L10N']->getString('scan_extensions_missing') . ' (Rar)';
                $x .= sprintf(
                    '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%6$s',
                    $Indent,
                    $phpMussel['L10N']->getString('scan_checking'),
                    $ItemRef,
                    hash('crc32b', $File),
                    hash('crc32b', $Data),
                    "\n",
                    $phpMussel['L10N']->getString('scan_extensions_missing') . ' (Rar)'
                );
                return;
            }
        }

        /** RarHandler needs a file pointer. */
        if (!$File || !is_readable($File)) {
            /**
             * File pointer not available. Probably already inside an
             * archive. Let's create a temporary file for this.
             */
            $PointerObject = new \phpMussel\TemporaryFileHandler\TemporaryFileHandler($Data, $phpMussel['cachePath']);
            $Pointer = &$PointerObject->Filename;
            $phpMussel['InstanceCache']['tempfilesToDelete'][] = $Pointer;
        } else {
            /** File pointer available. Let's reference it. */
            $Pointer = &$File;
        }

        /** We have a valid a pointer. Let's instantiate the object. */
        if ($Pointer) {
            $ArchiveObject = new \phpMussel\ArchiveHandler\RarHandler($Pointer);
        }
    }

    /** Archive object has been instantiated. Let's proceed. */
    if (isset($ArchiveObject) && is_object($ArchiveObject)) {

        /** No errors reported. Let's try checking its contents. */
        if ($ArchiveObject->ErrorState === 0) {

            /** Used to count the number of entries processed. */
            $Processed = 0;

            /** Iterate through the archive's contents. */
            while ($ArchiveObject->EntryNext()) {

                /** Flag the archive if it exceeds the "max_files_in_archives" limit and return. */
                if (
                    $phpMussel['Config']['files']['max_files_in_archives'] > 0 &&
                    $Processed > $phpMussel['Config']['files']['max_files_in_archives']
                ) {
                    $r = 2;
                    $phpMussel['killdata'] .= $DataHash . ':' . $DataLen . ':' . $ItemRef . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('too_many_files_in_archive') . ' (' . $ItemRef . ')'
                    );
                    $x .= sprintf(
                        '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                        $Indent,
                        $phpMussel['L10N']->getString('scan_checking'),
                        $ItemRef,
                        hash('crc32b', $File),
                        hash('crc32b', $Data),
                        "\n",
                        $phpMussel['L10N']->getString('too_many_files_in_archive'),
                        $phpMussel['L10N']->getString('_fullstop_final')
                    );
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                $Processed++;

                /** Encryption guard. */
                if ($phpMussel['Config']['files']['block_encrypted_archives'] && $ArchiveObject->EntryIsEncrypted()) {
                    $r = -4;
                    $phpMussel['killdata'] .= $DataHash . ':' . $DataLen . ':' . $ItemRef . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('encrypted_archive') . ' (' . $ItemRef . ')'
                    );
                    $x .= sprintf(
                        '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                        $Indent,
                        $phpMussel['L10N']->getString('scan_checking'),
                        $ItemRef,
                        hash('crc32b', $File),
                        hash('crc32b', $Data),
                        "\n",
                        $phpMussel['L10N']->getString('encrypted_archive'),
                        $phpMussel['L10N']->getString('_fullstop_final')
                    );
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                /** Fetch and prepare filename. */
                if ($Filename = $ArchiveObject->EntryName()) {
                    if (strpos($Filename, "\\") !== false) {
                        $Filename = $phpMussel['substral']($Filename, "\\");
                    }
                    if (strpos($Filename, '/') !== false) {
                        $Filename = $phpMussel['substral']($Filename, '/');
                    }
                }

                /** Fetch filesize. */
                $Filesize = $ArchiveObject->EntryActualSize();

                /** Fetch content and build hashes. */
                $Content = $ArchiveObject->EntryRead($Filesize);
                $MD5 = md5($Content);
                $NameCRC32 = hash('crc32b', $Filename);
                $DataCRC32 = hash('crc32b', $Content);
                $InternalCRC = $ArchiveObject->EntryCRC();
                $ThisItemRef = $ItemRef . '>' . urlencode($Filename);

                /** Verify filesize, integrity, etc. Exit early in case of problems. */
                if ($Filesize !== strlen($Content) || ($InternalCRC &&
                    preg_replace('~^0+~', '', $DataCRC32) !== preg_replace('~^0+~', '', $InternalCRC)
                )) {
                    $r = 2;
                    $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ThisItemRef . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('scan_tampering') . ' (' . $ThisItemRef . ')'
                    );
                    $x .= sprintf(
                        '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                        $Indent,
                        $phpMussel['L10N']->getString('scan_checking'),
                        $ThisItemRef,
                        $NameCRC32,
                        $DataCRC32,
                        "\n",
                        $phpMussel['L10N']->getString('recursive'),
                        $phpMussel['L10N']->getString('_fullstop_final')
                    );
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                /** Executed if the recursion depth limit has been exceeded. */
                if ($ScanDepth > $phpMussel['Config']['files']['max_recursion']) {
                    $r = 2;
                    $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ThisItemRef . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        $phpMussel['L10N']->getString('recursive') . ' (' . $ThisItemRef . ')'
                    );
                    $x .= sprintf(
                        '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                        $Indent,
                        $phpMussel['L10N']->getString('scan_checking'),
                        $ThisItemRef,
                        $NameCRC32,
                        $DataCRC32,
                        "\n",
                        $phpMussel['L10N']->getString('recursive'),
                        $phpMussel['L10N']->getString('_fullstop_final')
                    );
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                /** Quine detection. */
                if ($phpMussel['QuineDetector']($ScanDepth, $DataHash, $DataLen, $MD5, $Filesize)) {
                    $r = 2;
                    $phpMussel['killdata'] .= $MD5 . ':' . $Filesize . ':' . $ThisItemRef . "\n";
                    $phpMussel['whyflagged'] .= sprintf(
                        $phpMussel['L10N']->getString('_exclamation'),
                        sprintf($phpMussel['L10N']->getString('detected'), 'Quine') . ' (' . $ThisItemRef . ')'
                    );
                    $x .= sprintf(
                        '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s--%1$s%7$s%8$s%6$s',
                        $Indent,
                        $phpMussel['L10N']->getString('scan_checking'),
                        $ThisItemRef,
                        $NameCRC32,
                        $DataCRC32,
                        "\n",
                        sprintf($phpMussel['L10N']->getString('detected'), 'Quine'),
                        $phpMussel['L10N']->getString('_fullstop_final')
                    );
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                /** Ready to check the entry. */
                $x .= sprintf(
                    '-%1$s%2$s \'%3$s\' (FN: %4$s; FD: %5$s):%6$s',
                    $Indent,
                    $phpMussel['L10N']->getString('scan_checking'),
                    $ThisItemRef,
                    $NameCRC32,
                    $DataCRC32,
                    "\n"
                );

                /** Scan the entry. */
                try {
                    $phpMussel['MetaDataScan'](
                        $x,
                        $r,
                        '--' . $Indent,
                        $ThisItemRef,
                        $Filename,
                        $Content,
                        $ScanDepth,
                        $MD5
                    );
                } catch (\Exception $e) {
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    throw new \Exception($e->getMessage());
                }

                /** If we've already found something bad, we can exit early to save time. */
                if ($r !== 1) {
                    unset($ArchiveObject, $Pointer, $PointerObject);
                    return;
                }

                /** Finally, check whether the archive entry is an archive. */
                $phpMussel['ArchiveRecursor']($x, $r, $Content, '', $ScanDepth, $ThisItemRef);

            }

        }

    }

    /** Unset order is important for temporary files to be able to be deleted properly. */
    unset($ArchiveObject, $Pointer, $PointerObject);

};

/**
 * Drops trailing extensions from filenames if the extension matches that of a
 * compression format supported by the compression handler.
 *
 * @param string $Filename The filename.
 * @return string The filename sans compression extension.
 */
$phpMussel['DropTrailingCompressionExtension'] = function ($Filename) {
    return preg_replace(['~\.t[gbl]?z[\da-z]?$~i', '~\.(?:bz2?|gz|lha|lz[fhowx])$~i'], ['.tar', ''], $Filename);
};

/**
 * Forks the PHP process when scanning in CLI mode. This ensures that if PHP
 * crashes during scanning, phpMussel can continue to scan any remaining items
 * queued for scanning (because if the parent process handles the scan queue
 * and the child process handles the actual scanning of each item queued for
 * scanning, if the child process crashes, the parent process can simply create
 * a new child process to continue iterating through the queue).
 *
 * There are some additional benefits to be had by scanning in this way, such
 * as the ability to kill a child process, responsible for the actual scanning,
 * and yet still have the results of this scanning logged (which, if killed in
 * this way prior to completing the scan, would likely involve some type of
 * error).
 *
 * @param string $f The name of the item to be scanned, with path included.
 * @param string $ofn The name of the item to be scanned, without any path
 *      included (so, just the name by itself).
 * @return string The scan results, piped back to the parent from the child
 *      process and returned to the calling function as a string.
 */
$phpMussel['Fork'] = function ($f = '', $ofn = '') use (&$phpMussel) {
    $pf = popen(
        $phpMussel['Mussel_PHP'] . ' "' . $phpMussel['Vault'] .
        '../loader.php" "cli_scan" "' . $f . '" "' . $ofn . '"',
        'r'
    );
    $s = '';
    while ($x = fgets($pf)) {
        $s .= $x;
    }
    pclose($pf);
    return $s;
};

/** Assigns an array to use for dumping scan debug information (optional). */
$phpMussel['Set-Scan-Debug-Array'] = function (&$Var) use (&$phpMussel) {
    if (isset($phpMussel['DebugArr'])) {
        unset($phpMussel['DebugArr']);
    }
    if (!is_array($Var)) {
        $Var = [];
    }
    $phpMussel['DebugArr'] = &$Var;
};

/** Destroys the scan debug array (optional). */
$phpMussel['Destroy-Scan-Debug-Array'] = function (&$Var) use (&$phpMussel) {
    unset($phpMussel['DebugArrKey'], $phpMussel['DebugArr']);
    $Var = null;
};

/**
 * The main scan closure, responsible for initialising scans in most
 * circumstances. Should generally be called whenever phpMussel is
 * required by external scripts, apps, CMS, etc.
 *
 * Please refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB
 * SERVERS)", for more information.
 *
 * @param string|array $f Indicates which file, files, directory, or
 *      directories to scan (can be a string, an array, or a multidimensional
 *      array).
 * @param bool $n A boolean, indicating the format for the scan results to be
 *      returned as. False instructs the function to return the results as an
 *      integer; True instructs the function to return the results as human
 *      readable text. Optional; Defaults to false.
 * @param bool $zz A boolean, indicating to the function whether or not arrayed
 *      results should be imploded prior to being returned to the calling
 *      function. False instructs the function to return the arrayed results as
 *      verbatim; True instructs the function to return the arrayed results as
 *      an imploded string. Optional; Defaults to false.
 * @param int $dpt Represents the current depth of recursion from which the
 *      function has been called. This information is used for determining how
 *      far to indent any entries generated for logging (you should never
 *      manually set this parameter yourself).
 * @param string $ofn For the file upload scanning that phpMussel normally
 *      performs by default, this parameter represents the "original filename"
 *      of the file being scanned (the original filename, in this context,
 *      referring to the name supplied by the upload client, as opposed to the
 *      temporary filename assigned by the server or anything else).
 * @return bool|int|string|array The scan results, returned as an array when
 *      the $f parameter is an array and when $n and/or $zz is/are false, and
 *      otherwise returned as per described by the README documentation. The
 *      function may also die the script and return nothing, if something goes
 *      wrong, such as if the function is triggered in the absence of the
 *      required $phpMussel['InstanceCache'] variable being set, and may also return
 *      false, in the absence of the required $phpMussel['HashCache']['Data']
 *      variable being set.
 */
$phpMussel['Scan'] = function ($f = '', $n = false, $zz = false, $dpt = 0, $ofn = '') use (&$phpMussel) {
    if (!isset($phpMussel['InstanceCache'])) {
        throw new \Exception($phpMussel['L10N']->getString(
            'required_variables_not_defined'
        ) ?: '[phpMussel] Required variables aren\'t defined: Can\'t continue.');
    }

    /** Prepare signature files for the scan process. */
    if (empty($phpMussel['InstanceCache']['OrganisedSigFiles'])) {
        $phpMussel['OrganiseSigFiles']();
        $phpMussel['InstanceCache']['OrganisedSigFiles'] = true;
    }

    /** Initialise statistics if they've been enabled. */
    $phpMussel['Stats-Initialise']();

    if ($phpMussel['EOF']) {
        $phpMussel['PrepareHashCache']();
    }
    if (!isset($phpMussel['HashCache']['Data'])) {
        return false;
    }
    if (!$ofn) {
        $ofn = $f;
    }
    $xst = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
    $xst2822 = $phpMussel['TimeFormat']($xst, $phpMussel['Config']['general']['timeFormat']);
    try {
        $r = $phpMussel['Recursor']($f, $n, $zz, $dpt, $ofn);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
    $xet = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
    $xet2822 = $phpMussel['TimeFormat']($xet, $phpMussel['Config']['general']['timeFormat']);

    /** Plugin hook: "after_scan". */
    $phpMussel['Execute_Hook']('after_scan');

    if ($n && !is_array($r)) {
        $r =
            $xst2822 . ' ' . $phpMussel['L10N']->getString('started') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n" .
            $r . $xet2822 . ' ' . $phpMussel['L10N']->getString('finished') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
        $phpMussel['WriteScanLog']($r);
    }
    if (!isset($phpMussel['SkipSerial'])) {
        $phpMussel['WriteSerial']($xst, $xet);
    }
    if ($phpMussel['EOF']) {
        if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0) {
            foreach ($phpMussel['HashCache']['Data'] as &$phpMussel['ThisItem']) {
                if (is_array($phpMussel['ThisItem'])) {
                    $phpMussel['ThisItem'] = implode(':', $phpMussel['ThisItem']) . ';';
                }
            }

            /** Update hash cache. */
            $phpMussel['SaveCache'](
                'HashCache',
                $phpMussel['Time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
                implode('', $phpMussel['HashCache']['Data'])
            );
            unset($phpMussel['ThisItem'], $phpMussel['HashCache']['Data']);
        }
    }

    /** Register scan event. */
    $phpMussel['Stats-Increment']($phpMussel['EOF'] ? 'API-Events' : 'Web-Events', 1);

    /** Update statistics. */
    if (!empty($phpMussel['CacheModified'])) {
        $phpMussel['Statistics'] = $phpMussel['SaveCache']('Statistics', -1, serialize($phpMussel['Statistics']));
    }

    /** Exit scan process. */
    return $r;
};

/**
 * Writes to the serialized logfile upon scan completion.
 *
 * @param string $StartTime When the scan started.
 * @param string $FinishTime When the scan finished.
 * @return bool True on success; False on failure.
 */
$phpMussel['WriteSerial'] = function ($StartTime = '', $FinishTime = '') use (&$phpMussel) {
    if ($phpMussel['Mussel_sapi']) {
        $Origin = 'CLI';
    } else {
        $Origin = $phpMussel['Config']['legal']['pseudonymise_ip_addresses'] ? $phpMussel['Pseudonymise-IP'](
            $_SERVER[$phpMussel['IPAddr']]
        ) : $_SERVER[$phpMussel['IPAddr']];
    }
    $ScanData = empty($phpMussel['whyflagged']) ? $phpMussel['L10N']->getString('data_not_available') : trim($phpMussel['whyflagged']);
    if ($phpMussel['Config']['general']['scan_log_serialized']) {
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
                'start_time' => $StartTime ?: (isset($phpMussel['InstanceCache']['start_time']) ? $phpMussel['InstanceCache']['start_time'] : '-'),
                'end_time' => $FinishTime ?: (isset($phpMussel['InstanceCache']['end_time']) ? $phpMussel['InstanceCache']['end_time'] : '-'),
                'origin' => $Origin,
                'objects_scanned' => $phpMussel['InstanceCache']['objects_scanned'],
                'detections_count' => $phpMussel['InstanceCache']['detections_count'],
                'scan_errors' => $phpMussel['InstanceCache']['scan_errors'],
                'detections' => $ScanData
            ]) . "\n",
            'File' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_log_serialized'])
        ];
        $WriteMode = (!file_exists($phpMussel['Vault'] . $Handle['File']) || (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($phpMussel['Vault'] . $Handle['File']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        )) ? 'w' : 'a';
        if ($phpMussel['BuildLogPath']($Handle['File'])) {
            $Stream = fopen($phpMussel['Vault'] . $Handle['File'], $WriteMode);
            fwrite($Stream, $Handle['Data']);
            fclose($Stream);
            if ($WriteMode === 'w') {
                $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log_serialized']);
            }
            return true;
        }
    }
    return false;
};

/**
 * Writes to the standard scan log upon scan completion.
 *
 * @param string $Data What to write.
 * @return bool True on success; False on failure.
 */
$phpMussel['WriteScanLog'] = function ($Data) use (&$phpMussel) {
    if ($phpMussel['Config']['general']['scan_log']) {
        $File = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['scan_log']);
        if (!file_exists($phpMussel['Vault'] . $File)) {
            $Data = $phpMussel['safety'] . "\n" . $Data;
        }
        $WriteMode = (!file_exists($phpMussel['Vault'] . $File) || (
            $phpMussel['Config']['general']['truncate'] > 0 &&
            filesize($phpMussel['Vault'] . $File) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
        )) ? 'w' : 'a';
        if ($phpMussel['BuildLogPath']($File)) {
            $Handle = fopen($phpMussel['Vault'] . $File, 'a');
            fwrite($Handle, $Data);
            fclose($Handle);
            if ($WriteMode === 'w') {
                $phpMussel['LogRotation']($phpMussel['Config']['general']['scan_log']);
            }
            return true;
        }
    }
    return false;
};

/**
 * A simple closure for replacing date/time placeholders with corresponding
 * date/time information. Used by the logfiles and some timestamps.
 *
 * @param int $Time A unix timestamp.
 * @param string|array $In An input or an array of inputs to manipulate.
 * @return string|array The adjusted input(/s).
 */
$phpMussel['TimeFormat'] = function ($Time, $In) use (&$phpMussel) {
    $Time = date('dmYHisDMP', $Time);
    $values = [
        'dd' => substr($Time, 0, 2),
        'mm' => substr($Time, 2, 2),
        'yyyy' => substr($Time, 4, 4),
        'yy' => substr($Time, 6, 2),
        'hh' => substr($Time, 8, 2),
        'ii' => substr($Time, 10, 2),
        'ss' => substr($Time, 12, 2),
        'Day' => substr($Time, 14, 3),
        'Mon' => substr($Time, 17, 3),
        'tz' => substr($Time, 20, 3) . substr($Time, 24, 2),
        't:z' => substr($Time, 20, 6)
    ];
    $values['d'] = (int)$values['dd'];
    $values['m'] = (int)$values['mm'];
    return is_array($In) ? array_map(function ($Item) use (&$values, &$phpMussel) {
        return $phpMussel['ParseVars']($values, $Item);
    }, $In) : $phpMussel['ParseVars']($values, $In);
};

/**
 * Fix incorrect typecasting for some for some variables that sometimes default
 * to strings instead of booleans or integers.
 *
 * @param mixed $Var The variable to fix (passed by reference).
 * @param string $Type The type (or pseudo-type) to cast the variable to.
 */
$phpMussel['AutoType'] = function (&$Var, $Type = '') use (&$phpMussel) {
    if (in_array($Type, ['string', 'timezone', 'checkbox', 'url', 'email'], true)) {
        $Var = (string)$Var;
    } elseif ($Type === 'int') {
        $Var = (int)$Var;
    } elseif ($Type === 'float') {
        $Var = (float)$Var;
    } elseif ($Type === 'bool') {
        $Var = (strtolower($Var) !== 'false' && $Var);
    } elseif ($Type === 'kb') {
        $Var = $phpMussel['ReadBytes']((string)$Var, 1);
    } else {
        $LVar = strtolower($Var);
        if ($LVar === 'true') {
            $Var = true;
        } elseif ($LVar === 'false') {
            $Var = false;
        } elseif ($Var !== true && $Var !== false) {
            $Var = (int)$Var;
        }
    }
};

/**
 * Check for supplementary configuration.
 *
 * @param string $Source The directive or CSV that we're checking from.
 * @return array An an array of valid supplementary configuration sources.
 */
$phpMussel['Supplementary'] = function ($Source) use (&$phpMussel) {
    $Out = [];
    $Source = explode(',', $Source);
    foreach ($Source as $File) {
        if (($DecPos = strpos($File, '.')) === false) {
            continue;
        }
        $File = substr($File, 0, $DecPos) . '.yaml';
        if (file_exists($phpMussel['Vault'] . $File)) {
            $Out[] = $File;
        }
    }
    return $Out;
};

/**
 * Performs fallbacks and autotyping for missing configuration directives.
 *
 * @param array $Fallbacks Fallback source.
 * @param array $Config Configuration source.
 */
$phpMussel['Fallback'] = function (array $Fallbacks, array &$Config) use (&$phpMussel) {
    foreach ($Fallbacks as $KeyCat => $DCat) {
        if (!isset($Config[$KeyCat])) {
            $Config[$KeyCat] = [];
        }
        if (isset($Cat)) {
            unset($Cat);
        }
        $Cat = &$Config[$KeyCat];
        if (!is_array($DCat)) {
            continue;
        }
        foreach ($DCat as $DKey => $DData) {
            if (!isset($Cat[$DKey]) && isset($DData['default'])) {
                $Cat[$DKey] = $DData['default'];
            }
            if (isset($Dir)) {
                unset($Dir);
            }
            $Dir = &$Cat[$DKey];
            if (isset($DData['type'])) {
                $phpMussel['AutoType']($Dir, $DData['type']);
            }
        }
    }
};

/**
 * Used to send cURL requests.
 *
 * @param string $URI The resource to request.
 * @param array $Params An optional associative array of key-value pairs to
 *      send with the request.
 * @param int $Timeout An optional timeout limit.
 * @param array $Headers An optional array of headers to send with the request.
 * @param int $Depth Recursion depth of the current closure instance.
 * @return string The results of the request, or an empty string upon failure.
 */
$phpMussel['Request'] = function ($URI, array $Params = [], $Timeout = -1, array $Headers = [], $Depth = 0) use (&$phpMussel) {

    /** Fetch channel information. */
    if (!isset($phpMussel['Channels'])) {
        $phpMussel['Channels'] = (
            $Channels = $phpMussel['ReadFile']($phpMussel['Vault'] . 'channels.yaml')
        ) ? (new \Maikuolan\Common\YAML($Channels))->Data : [];
        if (!isset($phpMussel['Channels']['Triggers'])) {
            $phpMussel['Channels']['Triggers'] = [];
        }
    }

    /** Test channel triggers. */
    foreach ($phpMussel['Channels']['Triggers'] as $TriggerName => $TriggerURI) {
        if (
            !isset($phpMussel['Channels'][$TriggerName]) ||
            !is_array($phpMussel['Channels'][$TriggerName]) ||
            substr($URI, 0, strlen($TriggerURI)) !== $TriggerURI
        ) {
            continue;
        }
        foreach ($phpMussel['Channels'][$TriggerName] as $Channel => $Options) {
            if (!is_array($Options) || !isset($Options[$TriggerName])) {
                continue;
            }
            $Len = strlen($Options[$TriggerName]);
            if (substr($URI, 0, $Len) !== $Options[$TriggerName]) {
                continue;
            }
            unset($Options[$TriggerName]);
            if (empty($Options) || $phpMussel['in_csv'](key($Options), $phpMussel['Config']['general']['disabled_channels'])) {
                continue;
            }
            $AlternateURI = current($Options) . substr($URI, $Len);
            break;
        }
        if ($phpMussel['in_csv']($TriggerName, $phpMussel['Config']['general']['disabled_channels'])) {
            if (isset($AlternateURI)) {
                return $phpMussel['Request']($AlternateURI, $Params, $Timeout, $Headers, $Depth);
            }
            return '';
        }
        break;
    }

    /** Initialise the cURL session. */
    $Request = curl_init($URI);

    $LCURI = strtolower($URI);
    $SSL = (substr($LCURI, 0, 6) === 'https:');

    curl_setopt($Request, CURLOPT_FRESH_CONNECT, true);
    curl_setopt($Request, CURLOPT_HEADER, false);
    if (empty($Params)) {
        curl_setopt($Request, CURLOPT_POST, false);
    } else {
        curl_setopt($Request, CURLOPT_POST, true);
        curl_setopt($Request, CURLOPT_POSTFIELDS, $Params);
    }
    if ($SSL) {
        curl_setopt($Request, CURLOPT_PROTOCOLS, CURLPROTO_HTTPS);
        curl_setopt($Request, CURLOPT_SSL_VERIFYPEER, false);
    }
    curl_setopt($Request, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($Request, CURLOPT_MAXREDIRS, 1);
    curl_setopt($Request, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($Request, CURLOPT_TIMEOUT, ($Timeout > 0 ? $Timeout : $phpMussel['Timeout']));
    curl_setopt($Request, CURLOPT_USERAGENT, $phpMussel['ScriptUA']);
    curl_setopt($Request, CURLOPT_HTTPHEADER, $Headers ?: []);

    /** Execute and get the response. */
    $Response = curl_exec($Request);

    /** Check for problems (e.g., resource not found, server errors, etc). */
    if (($Info = curl_getinfo($Request)) && is_array($Info) && isset($Info['http_code'])) {

        /** Most recent HTTP code flag. */
        $phpMussel['Most-Recent-HTTP-Code'] = $Info['http_code'];

        /** Request failed. Try again using an alternative address. */
        if ($Info['http_code'] >= 400 && isset($AlternateURI) && $Depth < 3) {
            curl_close($Request);
            return $phpMussel['Request']($AlternateURI, $Params, $Timeout, $Headers, $Depth + 1);
        }

    } else {
        /** Most recent HTTP code flag. */
        $phpMussel['Most-Recent-HTTP-Code'] = 200;
    }

    /** Close the cURL session. */
    curl_close($Request);

    /** Return the results of the request. */
    return $Response;

};

/**
 * Used to generate new salts when necessary, which may be occasionally used by
 * some specific optional peripheral features (note: should not be considered
 * cryptographically secure; especially so for versions of PHP < 7).
 *
 * @return string Salt.
 */
$phpMussel['GenerateSalt'] = function () {
    static $MinLen = 32;
    static $MaxLen = 72;
    static $MinChr = 1;
    static $MaxChr = 255;
    $Salt = '';
    if (function_exists('random_int')) {
        try {
            $Length = random_int($MinLen, $MaxLen);
        } catch (\Exception $e) {
            $Length = rand($MinLen, $MaxLen);
        }
    } else {
        $Length = rand($MinLen, $MaxLen);
    }
    if (function_exists('random_bytes')) {
        try {
            $Salt = random_bytes($Length);
        } catch (\Exception $e) {
            $Salt = '';
        }
    }
    if (empty($Salt)) {
        if (function_exists('random_int')) {
            try {
                for ($Index = 0; $Index < $Length; $Index++) {
                    $Salt .= chr(random_int($MinChr, $MaxChr));
                }
            } catch (\Exception $e) {
                $Salt = '';
                for ($Index = 0; $Index < $Length; $Index++) {
                    $Salt .= chr(rand($MinChr, $MaxChr));
                }
            }
        } else {
            for ($Index = 0; $Index < $Length; $Index++) {
                $Salt .= chr(rand($MinChr, $MaxChr));
            }
        }
    }
    return $Salt;
};

/**
 * Clears expired entries from a list.
 *
 * @param string $List The list to clear from.
 * @param bool $Check A flag indicating when changes have occurred.
 */
$phpMussel['ClearExpired'] = function (&$List, &$Check) use (&$phpMussel) {
    if ($List) {
        $End = 0;
        while (true) {
            $Begin = $End;
            if (!$End = strpos($List, "\n", $Begin + 1)) {
                break;
            }
            $Line = substr($List, $Begin, $End - $Begin);
            if ($Split = strrpos($Line, ',')) {
                $Expiry = (int)substr($Line, $Split + 1);
                if ($Expiry < $phpMussel['Time']) {
                    $List = str_replace($Line, '', $List);
                    $End = 0;
                    $Check = true;
                }
            }
        }
    }
};

/** Fetch information about signature files and prepare for use with the scan process. */
$phpMussel['OrganiseSigFiles'] = function () use (&$phpMussel) {

    $LastActive = $phpMussel['FetchCache']('Active') ?: '';
    if (empty($phpMussel['Config']['signatures']['Active'])) {
        if ($LastActive) {
            $phpMussel['ClearHashCache']();
        }
        return false;
    }
    if ($phpMussel['Config']['signatures']['Active'] !== $LastActive) {
        $phpMussel['ClearHashCache']();
        if (isset($phpMussel['Cache']) && $phpMussel['Cache']->Using) {
            $phpMussel['Cache']->deleteEntry('Active');
        } else {
            $phpMussel['SaveCache']('Active', -1, $phpMussel['Config']['signatures']['Active']);
        }
    }

    $Classes = [
        'General_Command_Detections',
        'Filename',
        'Hash',
        'Standard',
        'Standard_RegEx',
        'Normalised',
        'Normalised_RegEx',
        'HTML',
        'HTML_RegEx',
        'PE_Extended',
        'PE_Sectional',
        'Complex_Extended',
        'URL_Scanner'
    ];

    $List = explode(',', $phpMussel['Config']['signatures']['Active']);
    foreach ($List as $File) {
        $File = (strpos($File, ':') === false) ? $File : substr($File, strpos($File, ':') + 1);
        $Handle = fopen($phpMussel['sigPath'] . $File, 'rb');
        if (fread($Handle, 9) !== 'phpMussel') {
            fclose($Handle);
            continue;
        }
        $Class = fread($Handle, 1);
        fclose($Handle);
        $Nibbles = $phpMussel['split_nibble']($Class);
        if (!empty($Classes[$Nibbles[0]])) {
            if (!isset($phpMussel['InstanceCache'][$Classes[$Nibbles[0]]])) {
                $phpMussel['InstanceCache'][$Classes[$Nibbles[0]]] = ',';
            }
            $phpMussel['InstanceCache'][$Classes[$Nibbles[0]]] .= $File . ',';
        }
    }

};

/**
 * A simple safety wrapper for unpack.
 *
 * @param string $Format Anything supported by unpack (usually "S" or "*l").
 * @param string $Data The data to be unpacked.
 * @return mixed The unpacked data.
 */
$phpMussel['UnpackSafe'] = function ($Format, $Data) {
    return (strlen($Data) > 1) ? unpack($Format, $Data) : '';
};

/**
 * A simple safety wrapper for hex2bin.
 *
 * @param string $Data Hexadecimally encoded data.
 * @return string The decoded data.
 */
$phpMussel['HexSafe'] = function ($Data) use (&$phpMussel) {
    return ($Data && !preg_match('/[^\da-f]/i', $Data) && !(strlen($Data) % 2)) ? $phpMussel['Function']('HEX', $Data) : '';
};

/**
 * If input isn't an array, make it so. Remove empty elements.
 *
 * @param mixed $Input
 */
$phpMussel['Arrayify'] = function (&$Input) {
    if (!is_array($Input)) {
        $Input = [$Input];
    }
    $Input = array_filter($Input);
};

/**
 * Read byte value configuration directives as byte values.
 *
 * @param string $In Input.
 * @param int $Mode Operating mode. 0 for true byte values, 1 for validating.
 *      Default is 0.
 * @return string|int Output (return type depends on operating mode).
 */
$phpMussel['ReadBytes'] = function ($In, $Mode = 0) {
    if (preg_match('/[KMGT][oB]$/i', $In)) {
        $Unit = substr($In, -2, 1);
    } elseif (preg_match('/[KMGToB]$/i', $In)) {
        $Unit = substr($In, -1);
    }
    $Unit = isset($Unit) ? strtoupper($Unit) : 'K';
    $In = (float)$In;
    if ($Mode === 1) {
        return $Unit === 'B' || $Unit === 'o' ? $In . 'B' : $In . $Unit . 'B';
    }
    $Multiply = ['K' => 1024, 'M' => 1048576, 'G' => 1073741824, 'T' => 1099511627776];
    return (int)floor($In * (isset($Multiply[$Unit]) ? $Multiply[$Unit] : 1));
};

/**
 * Improved recursive directory iterator for phpMussel.
 *
 * @param string $Base Directory root.
 * @return array Directory tree.
 */
$phpMussel['DirectoryRecursiveList'] = function ($Base) {
    $Arr = [];
    $Offset = strlen($Base);
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($Base), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        if (preg_match('~^(?:/\.\.|./\.|\.{3})$~', str_replace("\\", '/', substr($Item, -3))) || !is_readable($Item)) {
            continue;
        }
        $Arr[] = substr($Item, $Offset);
    }
    return $Arr;
};

/**
 * Duplication avoidance (forking the process via recursive CLI mode commands).
 *
 * @param string $Command Command with parameters for the action to be taken.
 * @param callable $Callable Executed normally when not forking the process.
 * @return string Returnable data to be echoed to the CLI output.
 */
$phpMussel['CLI-RecursiveCommand'] = function ($Command, $Callable) use (&$phpMussel) {
    $Params = substr($Command, strlen($phpMussel['cmd']) + 1);
    if (is_dir($Params)) {
        if (!is_readable($Params)) {
            return sprintf($phpMussel['L10N']->getString('failed_to_access'), $Params) . "\n";
        }
        $Decal = [':-) - (-:', ':-) \\ (-:', ':-) | (-:', ':-) / (-:'];
        $Frame = 0;
        $Terminal = $Params[strlen($Params) - 1];
        if ($Terminal !== "\\" && $Terminal !== '/') {
            $Params .= '/';
        }
        $List = $phpMussel['DirectoryRecursiveList']($Params);
        $Returnable = '';
        foreach ($List as $Item) {
            echo "\r" . $Decal[$Frame];
            $Returnable .= $phpMussel['Fork']($phpMussel['cmd'] . ' ' . $Params . $Item, $Item) . "\n";
            $Frame = $Frame < 3 ? $Frame + 1 : 0;
        }
        echo "\r         ";
        return $Returnable;
    }
    return is_file($Params) ? $Callable($Params) : sprintf($phpMussel['L10N']->getString('cli_is_not_a'), $Params) . "\n";
};

/**
 * Duplication avoidance (some file handling for honeypot functionality).
 *
 * @param array $Array Contains data relating to the file to be read.
 * @param string $File The path to the file to be read.
 */
$phpMussel['ReadFile-For-Honeypot'] = function (array &$Array, $File) use (&$phpMussel) {
    if (!isset($Array['qdata'])) {
        $Array['qdata'] = '';
    }
    $Array['odata'] = $phpMussel['ReadFile']($File);
    $Array['len'] = strlen($Array['odata']);
    $Array['crc'] = hash('crc32b', $Array['odata']);
    $Array['qfile'] = $phpMussel['Time'] . '-' . md5($phpMussel['Config']['general']['quarantine_key'] . $Array['crc'] . $phpMussel['Time']);
    if ($Array['len'] > 0 && $Array['len'] < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])) {
        $phpMussel['Quarantine'](
            $Array['odata'],
            $phpMussel['Config']['general']['quarantine_key'],
            $_SERVER[$phpMussel['IPAddr']],
            $Array['qfile']
        );
    }
    if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($File)) {
        unlink($File);
    }
    $Array['qdata'] .= sprintf(
        'TEMP FILENAME: %1$s%6$sFILENAME: %2$s%6$sFILESIZE: %3$s%6$sMD5: %4$s%6$s%5$s',
        $File,
        urlencode($File),
        $Array['len'],
        md5($Array['odata']),
        sprintf($phpMussel['L10N']->getString('quarantined_as'), $Array['qfile']),
        "\n"
    );
};

/** Duplication avoidance (assigning kill details and unlinking files). */
$phpMussel['KillAndUnlink'] = function () use (&$phpMussel) {
    $phpMussel['killdata'] .=
        '-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:' .
        $phpMussel['upload']['FilesData']['FileSet']['size'][$phpMussel['ThisIter']] . ':' .
        $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']] . "\n";
    $phpMussel['whyflagged'] .= sprintf($phpMussel['L10N']->getString('_exclamation'),
        $phpMussel['L10N']->getString('upload_limit_exceeded') .
        ' (' . $phpMussel['upload']['FilesData']['FileSet']['name'][$phpMussel['ThisIter']] . ')'
    );
    if (
        $phpMussel['Config']['general']['delete_on_sight'] &&
        is_uploaded_file($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]) &&
        is_readable($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]) &&
        !$phpMussel['Config']['general']['honeypot_mode']
    ) {
        unlink($phpMussel['upload']['FilesData']['FileSet']['tmp_name'][$phpMussel['ThisIter']]);
    }
};

/** Increments statistics if they've been enabled. */
$phpMussel['Stats-Increment'] = function ($Statistic, $Amount) use (&$phpMussel) {
    if ($phpMussel['Config']['general']['statistics'] && isset($phpMussel['Statistics'][$Statistic])) {
        $phpMussel['Statistics'][$Statistic] += $Amount;
        $phpMussel['CacheModified'] = true;
    }
};

/** Initialise statistics if they've been enabled. */
$phpMussel['Stats-Initialise'] = function () use (&$phpMussel) {
    if ($phpMussel['Config']['general']['statistics']) {
        $phpMussel['CacheModified'] = false;

        if ($phpMussel['Statistics'] = ($phpMussel['FetchCache']('Statistics') ?: [])) {
            if (is_string($phpMussel['Statistics'])) {
                unserialize($phpMussel['Statistics']) ?: [];
            }
        }

        if (empty($phpMussel['Statistics']['Other-Since'])) {
            $phpMussel['Statistics'] = [
                'Other-Since' => $phpMussel['Time'],
                'Web-Events' => 0,
                'Web-Scanned' => 0,
                'Web-Blocked' => 0,
                'Web-Quarantined' => 0,
                'CLI-Events' => 0,
                'CLI-Scanned' => 0,
                'CLI-Flagged' => 0,
                'API-Events' => 0,
                'API-Scanned' => 0,
                'API-Flagged' => 0
            ];
            $phpMussel['CacheModified'] = true;
        }
    }
};

/** Clears out the hash cache. */
$phpMussel['ClearHashCache'] = function () use (&$phpMussel) {
    $phpMussel['InitialiseCache']();

    /** Override if using a different preferred caching mechanism. */
    if ($phpMussel['Cache']->Using) {
        return $phpMussel['Cache']->deleteEntry('HashCache');
    }

    /** Default process. */
    $File = $phpMussel['cachePath'] . '48.tmp';
    $Data = $phpMussel['ReadFile']($File) ?: '';
    while (strpos($Data, 'HashCache:') !== false) {
        $Data = str_ireplace('HashCache:' . $phpMussel['substrbf']($phpMussel['substraf']($Data, 'HashCache:'), ';') . ';', '', $Data);
    }
    if (strlen($Data) < 2) {
        unset($File);
    } else {
        $Handle = fopen($File, 'w');
        fwrite($Handle, $Data);
        fclose($Handle);
    }
    $IndexFile = $phpMussel['cachePath'] . 'index.dat';
    $IndexNewData = $IndexData = $phpMussel['ReadFile']($IndexFile) ?: '';
    while (strpos($IndexNewData, 'HashCache:') !== false) {
        $IndexNewData = str_ireplace('HashCache:' . $phpMussel['substrbf']($phpMussel['substraf']($IndexNewData, 'HashCache:'), ';') . ';', '', $IndexNewData);
    }
    if ($IndexNewData !== $IndexData) {
        $IndexHandle = fopen($IndexFile, 'w');
        fwrite($IndexHandle, $IndexNewData);
        fclose($IndexHandle);
    }
    return true;
};

/**
 * Build directory path for logfiles.
 *
 * @param string $File The file we're building for.
 * @return bool True on success; False on failure.
 */
$phpMussel['BuildLogPath'] = function ($File) use (&$phpMussel) {
    $ThisPath = $phpMussel['Vault'];
    $File = str_replace("\\", '/', $File);
    while (strpos($File, '/') !== false) {
        $Dir = substr($File, 0, strpos($File, '/'));
        $ThisPath .= $Dir . '/';
        $File = substr($File, strlen($Dir) + 1);
        if (!file_exists($ThisPath) || !is_dir($ThisPath)) {
            if (!mkdir($ThisPath)) {
                return false;
            }
        }
    }
    return true;
};

/**
 * Checks whether the specified directory is empty.
 *
 * @param string $Directory The directory to check.
 * @return bool True if empty; False if not empty.
 */
$phpMussel['IsDirEmpty'] = function ($Directory) {
    return !((new \FilesystemIterator($Directory))->valid());
};

/**
 * Deletes empty directories (used by some front-end functions and log rotation).
 *
 * @param string $Dir The directory to delete.
 */
$phpMussel['DeleteDirectory'] = function ($Dir) use (&$phpMussel) {
    while (strrpos($Dir, '/') !== false || strrpos($Dir, "\\") !== false) {
        $Separator = (strrpos($Dir, '/') !== false) ? '/' : "\\";
        $Dir = substr($Dir, 0, strrpos($Dir, $Separator));
        if (!is_dir($phpMussel['Vault'] . $Dir) || !$phpMussel['IsDirEmpty']($phpMussel['Vault'] . $Dir)) {
            break;
        }
        rmdir($phpMussel['Vault'] . $Dir);
    }
};

/**
 * Convert log file configuration directives to regular expressions.
 *
 * @param string $Str The log file configuration directive to work with.
 * @param bool $GZ Whether to include GZ files in the resulting expression.
 * @return string A corresponding regular expression.
 */
$phpMussel['BuildLogPattern'] = function ($Str, $GZ = false) {
    return '~^' . preg_replace(
        ['~\\\{(?:dd|mm|yy|hh|ii|ss)\\\}~i', '~\\\{yyyy\\\}~i', '~\\\{(?:Day|Mon)\\\}~i', '~\\\{tz\\\}~i', '~\\\{t\\\:z\\\}~i'],
        ['\d{2}', '\d{4}', '\w{3}', '.{1,2}\d{4}', '.{1,2}\d{2}\:\d{2}'],
        preg_quote(str_replace("\\", '/', $Str))
    ) . ($GZ ? '(?:\.gz)?' : '') . '$~i';
};

/**
 * GZ-compress a file (used by log rotation).
 *
 * @param string $File The file to GZ-compress.
 * @return bool True if the file exists and is readable; False otherwise.
 */
$phpMussel['GZCompressFile'] = function ($File) {
    if (!is_file($File) || !is_readable($File)) {
        return false;
    }
    static $Blocksize = 131072;
    $Filesize = filesize($File);
    $Size = ($Filesize && $Blocksize) ? ceil($Filesize / $Blocksize) : 0;
    if ($Size > 0) {
        $Handle = fopen($File, 'rb');
        $HandleGZ = gzopen($File . '.gz', 'wb');
        $Block = 0;
        while ($Block < $Size) {
            $Data = fread($Handle, $Blocksize);
            gzwrite($HandleGZ, $Data);
            $Block++;
        }
        gzclose($HandleGZ);
        fclose($Handle);
    }
    return true;
};

/**
 * Log rotation.
 *
 * @param string $Pattern What to identify logfiles by (should be supplied via the relevant logging directive).
 * @return bool False when log rotation is disabled or errors occur; True otherwise.
 */
$phpMussel['LogRotation'] = function ($Pattern) use (&$phpMussel) {
    $Action = empty($phpMussel['Config']['general']['log_rotation_action']) ? '' : $phpMussel['Config']['general']['log_rotation_action'];
    $Limit = empty($phpMussel['Config']['general']['log_rotation_limit']) ? 0 : $phpMussel['Config']['general']['log_rotation_limit'];
    if (!$Limit || ($Action !== 'Delete' && $Action !== 'Archive')) {
        return false;
    }
    $Pattern = $phpMussel['BuildLogPattern']($Pattern);
    $Arr = [];
    $Offset = strlen($phpMussel['Vault']);
    $List = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($phpMussel['Vault']), RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        $ItemFixed = str_replace("\\", '/', substr($Item, $Offset));
        if ($ItemFixed && preg_match($Pattern, $ItemFixed) && is_readable($Item)) {
            $Arr[$ItemFixed] = filemtime($Item);
        }
    }
    unset($ItemFixed, $List, $Offset);
    $Count = count($Arr);
    $Err = 0;
    if ($Count > $Limit) {
        asort($Arr, SORT_NUMERIC);
        foreach ($Arr as $Item => $Modified) {
            if ($Action === 'Archive') {
                $Err += !$phpMussel['GZCompressFile']($phpMussel['Vault'] . $Item);
            }
            $Err += !unlink($phpMussel['Vault'] . $Item);
            if (strpos($Item, '/') !== false) {
                $phpMussel['DeleteDirectory']($Item);
            }
            $Count--;
            if (!($Count > $Limit)) {
                break;
            }
        }
    }
    return $Err ? false : true;
};

/**
 * Pseudonymise an IP address (reduce IPv4s to /24s and IPv6s to /32s).
 *
 * @param string $IP An IP address.
 * @return string A pseudonymised IP address.
 */
$phpMussel['Pseudonymise-IP'] = function ($IP) {
    if (($CPos = strpos($IP, ':')) !== false) {
        $Parts = [(substr($IP, 0, $CPos) ?: ''), (substr($IP, $CPos +1) ?: '')];
        if (($CPos = strpos($Parts[1], ':')) !== false) {
            $Parts[1] = substr($Parts[1], 0, $CPos) ?: '';
        }
        $Parts = $Parts[0] . ':' . $Parts[1] . '::x';
        return str_replace(':::', '::', $Parts);
    }
    return preg_replace(
        '/^([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])\.([01]?\d{1,2}|2[0-4]\d|25[0-5])$/i',
        '\1.\2.\3.x',
        $IP
    );
};

/** Initialise cache. */
$phpMussel['InitialiseCache'] = function () use (&$phpMussel) {

    /** Exit early if already initialised. */
    if (isset($phpMussel['Cache'])) {
        return;
    }

    /** Create new cache object. */
    $phpMussel['Cache'] = new \Maikuolan\Common\Cache();
    $phpMussel['Cache']->EnableAPCu = $phpMussel['Config']['supplementary_cache_options']['enable_apcu'];
    $phpMussel['Cache']->EnableMemcached = $phpMussel['Config']['supplementary_cache_options']['enable_memcached'];
    $phpMussel['Cache']->EnableRedis = $phpMussel['Config']['supplementary_cache_options']['enable_redis'];
    $phpMussel['Cache']->EnablePDO = $phpMussel['Config']['supplementary_cache_options']['enable_pdo'];
    $phpMussel['Cache']->MemcachedHost = $phpMussel['Config']['supplementary_cache_options']['memcached_host'];
    $phpMussel['Cache']->MemcachedPort = $phpMussel['Config']['supplementary_cache_options']['memcached_port'];
    $phpMussel['Cache']->RedisHost = $phpMussel['Config']['supplementary_cache_options']['redis_host'];
    $phpMussel['Cache']->RedisPort = $phpMussel['Config']['supplementary_cache_options']['redis_port'];
    $phpMussel['Cache']->RedisTimeout = $phpMussel['Config']['supplementary_cache_options']['redis_timeout'];
    $phpMussel['Cache']->PDOdsn = $phpMussel['Config']['supplementary_cache_options']['pdo_dsn'];
    $phpMussel['Cache']->PDOusername = $phpMussel['Config']['supplementary_cache_options']['pdo_username'];
    $phpMussel['Cache']->PDOpassword = $phpMussel['Config']['supplementary_cache_options']['pdo_password'];
    $phpMussel['Cache']->connect();
};

/**
 * Checks for a value within CSV.
 *
 * @param string $Value The value to look for.
 * @param string $CSV The CSV to look in.
 * @return bool True when found; False when not found.
 */
$phpMussel['in_csv'] = function ($Value, $CSV) {
    if (!$Value || !$CSV) {
        return false;
    }
    $Arr = explode(',', $CSV);
    if (strpos($CSV, '"') !== false) {
        foreach ($Arr as &$Item) {
            if (substr($Item, 0, 1) === '"' && substr($Item, -1) === '"') {
                $Item = substr($Item, 1, -1);
            }
        }
    }
    return in_array($Value, $Arr, true);
};

/**
 * Initialises an error handler to catch any errors generated by phpMussel when
 * needed.
 */
$phpMussel['InitialiseErrorHandler'] = function () use (&$phpMussel) {

    /** Stores any errors generated by the error handler. */
    $phpMussel['Errors'] = [];

    /**
     * For a full description of all supported parameters, please see:
     * @link https://php.net/set_error_handler
     *
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @return bool True to end further processing; False to defer processing.
     */
    $phpMussel['PreviousErrorHandler'] = set_error_handler(function ($errno, $errstr, $errfile, $errline) use (&$phpMussel) {
        $VaultLen = strlen($phpMussel['Vault']);
        if (
            strlen($errfile) > $VaultLen &&
            str_replace("\\", '/', substr($errfile, 0, $VaultLen)) === str_replace("\\", '/', $phpMussel['Vault'])
        ) {
            $errfile = substr($errfile, $VaultLen);
        }
        $phpMussel['Errors'][] = [$errno, $errstr, $errfile, $errline];
        return true;
    });
};

/**
 * Restores previous error handler after having initialised an error handler.
 */
$phpMussel['RestoreErrorHandler'] = function () use (&$phpMussel) {

    /** Reset errors array. */
    $phpMussel['Errors'] = [];

    /** Restore previous error handler. */
    restore_error_handler();
};
