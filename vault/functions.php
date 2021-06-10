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
 * This file: Functions file (last modified: 2021.06.10).
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

/** Instantiate events orchestrator in order to allow malleable logging and etc. */
$phpMussel['Events'] = new \Maikuolan\Common\Events();

/**
 * Registers plugin closures/functions to their intended hooks.
 *
 * @param string $What The name of the closure/function to execute.
 * @param string $Where Where to execute it (the designated "plugin hook").
 * @return bool True on success; False on failure.
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
 * @return bool True on success; False on failure.
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
 * @param array $Needles An array containing replacement values.
 * @param string $Haystack The string to work with.
 * @return string The string with its encapsulated substrings replaced.
 */
$phpMussel['ParseVars'] = function (array $Needles, $Haystack) {
    if (empty($Haystack)) {
        return '';
    }
    foreach ($Needles as $Key => $Value) {
        if (!is_array($Value)) {
            $Haystack = str_replace('{' . $Key . '}', $Value, $Haystack);
        }
    }
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
            if (
                function_exists($phpMussel['Function']('GZ')) &&
                $c = preg_match_all('/(' . $phpMussel['Function']('GZ') . '\s*\(\s*["\'])(.{1,4096})(,\d)?(["\']\s*\))/i', $str, $matches)
            ) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . $phpMussel['Function']('GZ', $phpMussel['substrbl']($phpMussel['substraf']($matches[0][$i], $matches[1][$i]), $matches[4][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(' . $phpMussel['Function']('B64') . '|decode_base64|base64\.b64decode|atob|Base64\.decode64)(\s*' .
                '\(\s*["\'\`])([\da-z+\/]{4})*([\da-z+\/]{4}|[\da-z+\/]{3}=|[\da-z+\/]{2}==)(["\'\`]' .
                '\s*\))/i',
                $str,
                $matches
            )) {
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
                $str,
                $matches
            )) {
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
                $str,
                $matches
            )) {
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
                $str,
                $matches
            )) {
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
 * @param int $Size Number of blocks to read from the file (optional).
 * @return string The file's contents (an empty string on failure).
 */
$phpMussel['ReadFile'] = function ($File, $Size = 0) {
    if (!is_file($File) || !is_readable($File)) {
        return '';
    }

    /** Default blocksize (128KB). */
    static $Blocksize = 131072;

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
    return $Data;
};

/**
 * A simple file() wrapper that checks for the existence of files before
 * attempting to read them, in order to avoid warnings about non-existent
 * files, with a normalised return value.
 *
 * @param string $Filename Refer to the description for file().
 * @param int $Flags Refer to the description for file().
 * @param resource|null $Context Refer to the description for file().
 * @return array The file's contents or an empty array on failure.
 */
$phpMussel['ReadFileAsArray'] = function ($Filename, $Flags = 0, $Context = null) {
    /** Guard. */
    if (!is_file($Filename) || !is_readable($Filename) || !$Filesize = filesize($Filename)) {
        return [];
    }

    if (!is_resource($Context)) {
        $Output = !$Flags ? file($Filename) : file($Filename, $Flags);
    } else {
        $Output = file($Filename, $Flags, $Context);
    }
    return is_array($Output) ? $Output : [];
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
                    $CacheFiles[$FileKey] = $phpMussel['ReadFile']($phpMussel['cachePath'] . $FileKey . '.tmp');
                }
                while (strpos($CacheFiles[$FileKey], $ThisData[0] . ':') !== false) {
                    $CacheFiles[$FileKey] = str_ireplace($ThisData[0] . ':' . $phpMussel['substrbf'](
                        $phpMussel['substraf']($CacheFiles[$FileKey], $ThisData[0] . ':'),
                        ';'
                    ) . ';', '', $CacheFiles[$FileKey]);
                }
                $ThisData = '';
                continue;
            }
            $ThisData = $ThisData[0] . ':' . $ThisData[1];
        }
        $FileData = str_replace(';;', ';', implode(';', array_filter($FileData)) . ';');
        if ($FileDataOld !== $FileData) {
            $Handle = fopen($FileIndex, 'wb');
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
        $Handle = fopen($phpMussel['cachePath'] . $CacheEntryKey . '.tmp', 'wb');
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
    if (!$FileData = $phpMussel['ReadFile']($File)) {
        return '';
    }
    if (!$Item = strpos($FileData, $Entry . ':') !== false ? $Entry . ':' . $phpMussel['substrbf'](
        $phpMussel['substraf']($FileData, $Entry . ':'),
        ';'
    ) . ';' : '') {
        return '';
    }
    $Expiry = $phpMussel['substrbf']($phpMussel['substraf']($Item, $Entry . ':'), ':');
    if ($Expiry > 0 && $phpMussel['Time'] > $Expiry) {
        while (strpos($FileData, $Entry . ':') !== false) {
            $FileData = str_ireplace($Item, '', $FileData);
        }
        $Handle = fopen($File, 'wb');
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
 * @return bool True on success; False on failure.
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
    $Data .= $Entry . ':' . $Expiry . ':' . bin2hex(gzdeflate($ItemData, 9)) . ';';
    $Handle = fopen($File, 'wb');
    fwrite($Handle, $Data);
    fclose($Handle);
    $IndexFile = $phpMussel['cachePath'] . 'index.dat';
    $IndexNewData = $IndexData = $phpMussel['ReadFile']($IndexFile) ?: '';
    while (strpos($IndexNewData, $Entry . ':') !== false) {
        $IndexNewData = str_ireplace($Entry . ':' . $phpMussel['substrbf']($phpMussel['substraf']($IndexNewData, $Entry . ':'), ';') . ';', '', $IndexNewData);
    }
    $IndexNewData .= $Entry . ':' . $Expiry . ';';
    if ($IndexNewData !== $IndexData) {
        $IndexHandle = fopen($IndexFile, 'wb');
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
 * Quarantines file uploads by bitshifting the input string (the uploaded
 * file's content) on the basis of your quarantine key, appending a header
 * with an explanation of what the bitshifted data is, along with an MD5
 * hash checksum of the original data, and then saves it all to a QFU file,
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
 * @return bool True on success; False on failure.
 */
$phpMussel['Quarantine'] = function ($In, $Key, $IP, $ID) use (&$phpMussel) {
    /** Guard against missing quarantine directory. */
    if (!$phpMussel['BuildPath']($phpMussel['qfuPath'], false)) {
        return false;
    }

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
    $Head = "\xa1phpMussel\x21" . $phpMussel['HexSafe'](hash('md5', $In)) . pack('l*', $FileSize) . "\1";
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
            $Out .= ($L === false ? "\0" : $L) ^ ($R === false ? "\0" : $R);
        }
    }
    $Out =
        "\x2f\x3d\x3d phpMussel Quarantined File Upload \x3d\x3d\x5c\n\x7c Time\x2fDate Uploaded\x3a " .
        str_pad($phpMussel['Time'], 18, ' ') .
        "\x7c\n\x7c Uploaded From\x3a " . str_pad($IP, 22, ' ') .
        " \x7c\n\x5c" . str_repeat("\x3d", 39) . "\x2f\n\n\n" . $Head . $Out;
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
    $Handle = fopen($phpMussel['qfuPath'] . $ID . '.qfu', 'ab');
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
 *      Omit or set to 0 to avoid deleting files.
 * @return array Contains two integer elements: `Size`: The actual, total
 *      memory used by the target directory. `Count`: The total number of files
 *      found in the target directory by the time of closure exit.
 */
$phpMussel['MemoryUse'] = function ($Path, $Delete = 0, $DeleteFiles = 0) {
    $Offset = strlen($Path);
    $Files = [];
    $List = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($Path), \RecursiveIteratorIterator::SELF_FIRST);
    foreach ($List as $Item => $List) {
        $File = str_replace("\\", '/', substr($Item, $Offset));
        if ($File && strtolower(substr($Item, -4)) === '.qfu' && is_file($Item) && !is_link($Item) && is_readable($Item)) {
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
            $Haystack,
            $Needle
        ) : levenshtein(
            strtolower($Haystack),
            strtolower($Needle)
        );
    } else {
        $lv = $case ? levenshtein(
            $Haystack,
            $Needle,
            $cost_ins,
            $cost_rep,
            $cost_del
        ) : levenshtein(
            strtolower($Haystack),
            strtolower($Needle),
            $cost_ins,
            $cost_rep,
            $cost_del
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
 *      if the request is malformed or if there aren't any URLs to look up; 401
 *      if the API key is missing or isn't authorised; 503 if the service is
 *      unavailable (e.g., if it's been throttled).
 */
$phpMussel['SafeBrowseLookup'] = function (array $URLs, array $URLsNoLookup = [], array $DomainsNoLookup = []) use (&$phpMussel) {
    /** Guard against missing API key. */
    if (empty($phpMussel['Config']['urlscanner']['google_api_key'])) {
        return 401;
    }

    /** Count URLs and exit early if there aren't any. */
    if (!$Count = count($URLs)) {
        return 400;
    }

    for ($Iterant = 0; $Iterant < $Count; $Iterant++) {
        $Domain = (strpos($URLs[$Iterant], '/') !== false) ? $phpMussel['substrbf']($URLs[$Iterant], '/') : $URLs[$Iterant];
        if (!empty($URLsNoLookup[$URLs[$Iterant]]) || !empty($DomainsNoLookup[$Domain])) {
            unset($URLs[$Iterant]);
            continue;
        }
        $URLs[$Iterant] = ['url' => $URLs[$Iterant]];
    }
    sort($URLs);

    /** After preparing URLs, prepare JSON array. */
    $Arr = json_encode([
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

    /** Generate a reference for the cache entry for this lookup. */
    $cacheRef = hash('md5', $Arr) . ':' . $Count . ':' . strlen($Arr) . ':';

    /** Check if this lookup has already been performed. */
    while (strpos($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef) !== false) {
        $Response = $phpMussel['substrbf']($phpMussel['substral']($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef), ';');

        /** Safety mechanism. */
        if (!$Response || strpos($phpMussel['InstanceCache']['urlscanner_google'], $cacheRef . $Response . ';') === false) {
            $Response = '';
            break;
        }

        $Expiry = $phpMussel['substrbf']($Response, ':');
        if ($Expiry > $phpMussel['Time']) {
            $Response = $phpMussel['substraf']($Response, ':');
            break;
        }
        $phpMussel['InstanceCache']['urlscanner_google'] = str_ireplace(
            $cacheRef . $Response . ';',
            '',
            $phpMussel['InstanceCache']['urlscanner_google']
        );
        $Response = '';
    }

    /** If this lookup has already been performed, return the results. */
    if (!empty($Response)) {
        /** Potentially harmful URL detected. */
        if ($Response === '200') {
            return 200;
        }

        /** Potentially harmful URL *NOT* detected. */
        if ($Response === '204') {
            return 204;
        }

        /** Malformed request. */
        if ($Response === '400') {
            return 400;
        }

        /** Unauthorised (most likely an invalid API key used). */
        if ($Response === '401') {
            return 401;
        }

        /** Service unavailable. */
        if ($Response === '503') {
            return 503;
        }

        /** Other, unknown problem (in theory, this should never be reached). */
        if ($Response === '999') {
            return 999;
        }
    }

    /** Perform lookup. */
    $Response = $phpMussel['Request'](
        'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $phpMussel['Config']['urlscanner']['google_api_key'],
        $Arr,
        $phpMussel['Request']->DefaultTimeout,
        ['Content-type: application/json']
    );
    $phpMussel['LookupCount']++;

    /** Generate new cache expiry time. */
    $newExpiry = $phpMussel['Time'] + $phpMussel['Config']['urlscanner']['cache_time'];

    /** Potentially harmful URL detected. */
    if (strpos($Response, '"matches":') !== false) {
        $returnVal = 200;
    } else {
        /**
         * Other possible problem detected.
         * @link https://developers.google.com/safe-browsing/v4/status-codes
         */
        if (isset($phpMussel['Request']->MostRecentStatusCode) && $phpMussel['Request']->MostRecentStatusCode !== 200) {
            /**
             * Malformed request detected (e.g., invalid argument, invalid
             * request payload, etc).
             */
            if ($phpMussel['Request']->MostRecentStatusCode === '400') {
                $returnVal = 400;
            }

            /**
             * Unauthorised (most likely an invalid API key used). Returning
             * the same message for 401 and 403 because the returned message is
             * suitable either way.
             */
            elseif ($phpMussel['Request']->MostRecentStatusCode >= '401' && $phpMussel['Request']->MostRecentStatusCode <= 403) {
                $returnVal = 401;
            }

            /**
             * Service unavailable or internal server error. Returning the same
             * message for 429, 500, 503, 504 alike because, for our purpose,
             * the returned message is suitable in any case.
             */
            elseif ($phpMussel['Request']->MostRecentStatusCode >= '429') {
                $returnVal = 503;
            }

            /**
             * Fallback for other error codes (in theory, this shouldn't ever
             * be reached, but adding it here just in case).
             */
            else {
                $returnVal = 999;
            }

            /**
             * Enforce an additional 24 hours (the maximum computable back-off
             * period, so as to play it safe) onto the expiry time for cached
             * failed lookups.
             * @link https://developers.google.com/safe-browsing/v4/request-frequency#back-off-mode
             */
            $newExpiry += 86400;
        } else {
            /** Potentially harmful URL *NOT* detected, and no other problems detected. */
            $returnVal = 204;
        }
    }

    /** Update the cache entry for Google Safe Browsing. */
    $phpMussel['InstanceCache']['urlscanner_google'] .= $cacheRef . ':' . $newExpiry . ':' . $returnVal . ';';
    $phpMussel['SaveCache']('urlscanner_google', $newExpiry, $phpMussel['InstanceCache']['urlscanner_google']);

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
 * Detection trigger closure (appends detection information).
 *
 * @param array $Heuristic
 * @param string $Indentation
 * @param string $VN
 * @param string $OriginalFilename
 * @param string $OriginalFilenameSafe
 * @param string $Out
 * @param bool $Flagged
 * @param string $Checksum
 * @param int $StringLength
 */
$phpMussel['Detected'] = function (
    &$Heuristic,
    &$Indentation,
    &$VN,
    &$OriginalFilename,
    &$OriginalFilenameSafe,
    &$Out,
    &$Flagged,
    &$Checksum,
    &$StringLength
) use (&$phpMussel) {
    if (!$Flagged) {
        $phpMussel['killdata'] .= $Checksum . ':' . $StringLength . ':' . $OriginalFilename . "\n";
        $Flagged = true;
    }
    $Heuristic['detections']++;
    $phpMussel['InstanceCache']['detections_count']++;
    if ($phpMussel['InstanceCache']['weighted']) {
        $Heuristic['weight']++;
        $Heuristic['cli'] .= $Indentation . sprintf(
            $phpMussel['L10N']->getString('_exclamation_final'),
            sprintf($phpMussel['L10N']->getString('detected'), $VN)
        ) . "\n";
        $Heuristic['web'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $OriginalFilenameSafe . ')'
        );
        return;
    }
    $Out .= $Indentation . sprintf(
        $phpMussel['L10N']->getString('_exclamation_final'),
        sprintf($phpMussel['L10N']->getString('detected'), $VN)
    ) . "\n";
    $phpMussel['whyflagged'] .= sprintf(
        $phpMussel['L10N']->getString('_exclamation'),
        sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $OriginalFilenameSafe . ')'
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
 * Match a variable referenced by a signature file (guards against some obscure
 * referencing and typecasting problems).
 *
 * @param mixed $Actual The actual data found in the signature file.
 * @param mixed $Expected The expected data to be matched against.
 * @return bool True when they match; False when they don't.
 */
$phpMussel['MatchVarInSigFile'] = function ($Actual, $Expected) {
    $LCActual = strtolower($Actual);
    if ($LCActual === '0' || $LCActual === 'false') {
        if ($Expected === 0 || $Expected === false) {
            return true;
        }
    }
    if ($LCActual === '1' || $LCActual === 'true') {
        if ($Expected === 1 || $Expected === true) {
            return true;
        }
    }
    $Actual = (string)$Actual;
    $Expected = (string)$Expected;
    return $Actual === $Expected;
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
 * @param string $OriginalFilename Represents the "original filename" of the file being
 *      scanned (in this context, referring to the name supplied by the upload
 *      client or CLI operator, as opposed to the temporary filename assigned
 *      by the server or anything else).
 * @return array|bool Returns an array containing the results of the scan as
 *      both an integer (the first element) and as human-readable text (the
 *      second element), or returns false if any problems occur preventing the
 *      data handler from completing its normal process.
 */
$phpMussel['DataHandler'] = function ($str = '', $dpt = 0, $OriginalFilename = '') use (&$phpMussel) {

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
    if (!$StringLength = strlen($str)) {
        return [1, ''];
    }

    /** Generate hash variables. */
    foreach (['md5', 'sha1', 'sha256', 'crc32b'] as $Algo) {
        $$Algo = hash($Algo, $str);
    }

    /** Scan target has no name? That's a little suspicious. */
    if (!$OriginalFilename) {
        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ":\n";
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

    /** $fourcc: First four bytes of the scan target in hexadecimal notation. */
    $fourcc = strtolower(bin2hex(substr($str, 0, 4)));

    /** $twocc: First two bytes of the scan target in hexadecimal notation. */
    $twocc = substr($fourcc, 0, 4);

    /**
     * $CoExMeta: Contains metadata pertaining to the scan target, intended to
     * be used by the "complex extended" signatures.
     */
    $CoExMeta =
        '$OriginalFilename:' . $OriginalFilename . ';$StringLength:' . $StringLength .
        ';$md5:' . $md5 . ';$sha1:' . $sha1 . ';$sha256:' . $sha256 .
        ';$crc32b:' . $crc32b . ';$fourcc:' . $fourcc . ';$twocc:' . $twocc . ';';

    /** Indicates whether a signature is considered a "weighted" signature. */
    $phpMussel['InstanceCache']['weighted'] = false;

    /** Variables used for weighted signatures and for heuristic analysis. */
    $heur = ['detections' => 0, 'weight' => 0, 'cli' => '', 'web' => ''];

    /** URL-encoded version of the scan target name. */
    $OriginalFilenameSafe = urlencode($OriginalFilename);

    /** Generate cache ID. */
    $phpMussel['HashCacheData'] = $md5 . hash('md5', $OriginalFilename);

    /** Register object scanned. */
    if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] === 'cli_scan') {
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
            $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                'Filename' => $OriginalFilename,
                'FromCache' => true,
                'Depth' => $dpt,
                'Size' => $StringLength,
                'MD5' => $md5,
                'SHA1' => $sha1,
                'SHA256' => $sha256,
                'CRC32B' => $crc32b,
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
        if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] === 'cli_scan') {
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
        $StringLength > $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold'])
    ) {
        $StringLength = $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['scannable_threshold']);
        $str = substr($str, 0, $StringLength);
        $str_cut = 1;
    } else {
        $str_cut = 0;
    }

    /** Indicates whether we need to decode the contents of the scan target. */
    $decode_or_not = ((
        $phpMussel['Config']['attack_specific']['decode_threshold'] > 0 &&
        $StringLength > $phpMussel['ReadBytes']($phpMussel['Config']['attack_specific']['decode_threshold'])
    ) || $StringLength < 16) ? 0 : 1;

    /** These are sometimes used by the "CoEx" ("complex extended") signatures. */
    $len_kb = ($StringLength > 1024) ? 1 : 0;
    $len_hmb = ($StringLength > 524288) ? 1 : 0;
    $len_mb = ($StringLength > 1048576) ? 1 : 0;
    $len_hgb = ($StringLength > 536870912) ? 1 : 0;
    $phase = $phpMussel['InstanceCache']['phase'];
    $container = $phpMussel['InstanceCache']['container'];
    $pdf_magic = ($fourcc === '25504446');

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
    list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($OriginalFilename);

    $CoExMeta .= '$xt:' . $xt . ';$xts:' . $xts . ';';

    /** Input ($str) as hexadecimal data. */
    $str_hex = bin2hex($str);
    $str_hex_len = $StringLength * 2;

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
        $str_hex
    ) || preg_match('/0a2d2d.{32}(?:2d2d)?(?:0d)?0a/i', $str_hex));

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
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ":\n";
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
                $lv_haystack = substr($Fragment[1], 1);
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
                                strpos("\1" . substr($str_hex, 0, $Fragment[3] * 2), "\1" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', substr($str_hex, 0, $Fragment[3] * 2))
                            ) || (
                                $Fragment[0] === 'FD-NORM' &&
                                strpos("\1" . substr($str_hex_norm, 0, $Fragment[3] * 2), "\1" . $Fragment[1]) === false
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
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', $OriginalFilename)
                            ) || (
                                $Fragment[0] === 'FD' &&
                                strpos("\1" . $str_hex, "\1" . $Fragment[1]) === false
                            ) || (
                                $Fragment[0] === 'FD-RX' &&
                                !preg_match('/\A(?:' . $Fragment[1] . ')/i', $str_hex)
                            ) || (
                                $Fragment[0] === 'FD-NORM' &&
                                strpos("\1" . $str_hex_norm, "\1" . $Fragment[1]) === false
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
                ($Fragment[0] === 'FN' && !preg_match('/(?:' . $Fragment[1] . ')/i', $OriginalFilename)) ||
                ($Fragment[0] === 'FS-MIN' && $StringLength < $Fragment[1]) ||
                ($Fragment[0] === 'FS-MAX' && $StringLength > $Fragment[1]) ||
                ($Fragment[0] === 'FD' && strpos($str_hex, $Fragment[1]) === false) ||
                ($Fragment[0] === 'FD-RX' && !preg_match('/(?:' . $Fragment[1] . ')/i', $str_hex)) ||
                ($Fragment[0] === 'FD-NORM' && strpos($str_hex_norm, $Fragment[1]) === false) ||
                ($Fragment[0] === 'FD-NORM-RX' && !preg_match('/(?:' . $Fragment[1] . ')/i', $str_hex_norm))
            ) {
                continue 2;
            } elseif (substr($Fragment[0], 0, 1) === '$') {
                $VarInSigFile = substr($Fragment[0], 1);
                if (!isset($$VarInSigFile) || is_array($$VarInSigFile) || $$VarInSigFile != $Fragment[1]) {
                    continue 2;
                }
            } elseif (substr($Fragment[0], 0, 2) === '!$') {
                $VarInSigFile = substr($Fragment[0], 2);
                if (!isset($$VarInSigFile) || is_array($$VarInSigFile) || $$VarInSigFile == $Fragment[1]) {
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

    $PEFileDescription = '';
    $PEFileVersion = '';
    $PEProductName = '';
    $PEProductVersion = '';
    $PECopyright = '';
    $PEOriginalFilename = '';
    $PECompanyName = '';
    if (
        !empty($phpMussel['InstanceCache']['PE_Sectional']) ||
        !empty($phpMussel['InstanceCache']['PE_Extended']) ||
        $phpMussel['Config']['attack_specific']['corrupted_exe']
    ) {
        $PEArr = ['SectionArr' => []];
        if ($twocc === '4d5a') {
            $PEArr['Offset'] = $phpMussel['UnpackSafe']('S', substr($str, 60, 4));
            $PEArr['Offset'] = isset($PEArr['Offset'][1]) ? $PEArr['Offset'][1] : 0;
            while (true) {
                $PEArr['DoScan'] = true;
                if ($PEArr['Offset'] < 1 || $PEArr['Offset'] > 16384 || $PEArr['Offset'] > $StringLength) {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['Magic'] = substr($str, $PEArr['Offset'], 2);
                if ($PEArr['Magic'] !== 'PE') {
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
                        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                        $phpMussel['L10N']->getString('corrupted') . ' (' . $OriginalFilenameSafe . ')'
                    );
                }
            } else {
                $is_pe = true;
                $asciiable = false;
                $PEArr['OptHdrSize'] = $phpMussel['UnpackSafe']('S', substr($str, $PEArr['Offset'] + 20, 2));
                $PEArr['OptHdrSize'] = $PEArr['OptHdrSize'][1];
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    $PEArr['SectionArr'][$PEArr['k']] = [
                        'SectionHead' => substr($str, $PEArr['Offset'] + 24 + $PEArr['OptHdrSize'] + ($PEArr['k'] * 40), $NumOfSections * 40)
                    ];
                    $PEArr['SectionArr'][$PEArr['k']]['SectionName'] =
                        str_ireplace("\0", '', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 0, 8));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 8, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 12, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'][1];
                    $SizeOfRawData = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 16, 4));
                    $SizeOfRawData = $SizeOfRawData[1];
                    $PointerToRawData = $phpMussel['UnpackSafe']('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 20, 4));
                    $PointerToRawData = $PointerToRawData[1];
                    $PEArr['SectionArr'][$PEArr['k']]['SectionData'] = substr($str, $PointerToRawData, $SizeOfRawData);
                    $SectionOffsets[$PEArr['k']] = [$PointerToRawData, $SizeOfRawData];
                    foreach (['md5', 'sha1', 'sha256'] as $TryHash) {
                        $PEArr['SectionArr'][$PEArr['k']][$TryHash] = hash($TryHash, $PEArr['SectionArr'][$PEArr['k']]['SectionData']);
                    }
                    $phpMussel['PEData'] .=
                        $SizeOfRawData . ':' .
                        $PEArr['SectionArr'][$PEArr['k']]['sha256'] . ':' . $OriginalFilename . '-' .
                        $PEArr['SectionArr'][$PEArr['k']]['SectionName'] . "\n";
                    $CoExMeta .= sprintf(
                        'SectionName:%s;VirtualSize:%s;VirtualAddress:%s;SizeOfRawData:%s;SHA256:%s;',
                        $PEArr['SectionArr'][$PEArr['k']]['SectionName'],
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'],
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'],
                        $SizeOfRawData,
                        $PEArr['SectionArr'][$PEArr['k']]['sha256']
                    );
                    $PEArr['SectionArr'][$PEArr['k']] = [
                        $SizeOfRawData . ':' . $PEArr['SectionArr'][$PEArr['k']]['md5'] . ':',
                        $SizeOfRawData . ':' . $PEArr['SectionArr'][$PEArr['k']]['sha1'] . ':',
                        $SizeOfRawData . ':' . $PEArr['SectionArr'][$PEArr['k']]['sha256'] . ':'
                    ];
                }
                if (strpos($str, "V\0a\0r\0F\0i\0l\0e\0I\0n\0f\0o\0\0\0\0\0\x24") !== false) {
                    $PEArr['Parts'] = $phpMussel['substral']($str, "V\0a\0r\0F\0i\0l\0e\0I\0n\0f\0o\0\0\0\0\0\x24");
                    $PEArr['FINFO'] = [];
                    foreach ([
                        ["F\0i\0l\0e\0D\0e\0s\0c\0r\0i\0p\0t\0i\0o\0n\0\0\0", 'PEFileDescription'],
                        ["F\0i\0l\0e\0V\0e\0r\0s\0i\0o\0n\0\0\0", 'PEFileVersion'],
                        ["P\0r\0o\0d\0u\0c\0t\0N\0a\0m\0e\0\0\0", 'PEProductName'],
                        ["P\0r\0o\0d\0u\0c\0t\0V\0e\0r\0s\0i\0o\0n\0\0\0", 'PEProductVersion'],
                        ["L\0e\0g\0a\0l\0C\0o\0p\0y\0r\0i\0g\0h\0t\0\0\0", 'PECopyright'],
                        ["O\0r\0i\0g\0i\0n\0a\0l\0F\0i\0l\0e\0n\0a\0m\0e\0\0\0", 'PEOriginalFilename'],
                        ["C\0o\0m\0p\0a\0n\0y\0N\0a\0m\0e\0\0\0", 'PECompanyName'],
                    ] as $PEVars) {
                        if (strpos($PEArr['Parts'], $PEVars[0]) !== false && (
                            ${$PEVars[1]} = trim(str_ireplace("\0", '', $phpMussel['substrbf'](
                                $phpMussel['substral']($PEArr['Parts'], $PEVars[0]),
                                "\0\0\0"
                            )))
                        )) {
                            foreach (['md5', 'sha1', 'sha256'] as $TryHash) {
                                $PEArr['FINFO'][] = sprintf(
                                    '$%s:%s:%d:',
                                    $PEVars[1],
                                    $TryHash = hash($TryHash, ${$PEVars[1]}),
                                    strlen(${$PEVars[1]})
                                );
                            }
                        }
                    }
                    unset($PEVars, $PEArr['Parts']);
                }
                unset($PointerToRawData, $SizeOfRawData);
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
            'Filename' => $OriginalFilename,
            'FromCache' => false,
            'Depth' => $dpt,
            'Size' => $StringLength,
            'MD5' => $md5,
            'SHA1' => $sha1,
            'SHA256' => $sha256,
            'CRC32B' => $crc32b,
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
        !empty($phpMussel['Config']['urlscanner']['google_api_key'])
    ) {
        $phpMussel['LookupCount'] = 0;
        $URLScanner = [
            'FixedSource' => preg_replace('~(data|f(ile|tps?)|https?|sftp):~i', "\x01\\1:", str_replace("\\", '/', $str_norm)) . "\1",
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
                $ThisURL = hash('md5', $ThisURL) . ':' . strlen($ThisURL) . ':';
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
                $URLScanner['This'] = hash('md5', $ThisURL) . ':' . strlen($ThisURL) . ':';
                $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                $URLScanner['URLParts'][$URLScanner['Iterable']] = $ThisURL;
                $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                $URLScanner['Iterable']++;
                if (preg_match('/[^\da-z.-]$/i', $ThisURL)) {
                    $URLScanner['x'] = preg_replace('/[^\da-z.-]+$/i', '', $ThisURL);
                    $URLScanner['This'] = hash('md5', $URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
                    $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                    $URLScanner['URLParts'][$URLScanner['Iterable']] = $URLScanner['x'];
                    $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                    $URLScanner['Iterable']++;
                }
                if (strpos($ThisURL, '?') !== false) {
                    $URLScanner['x'] = $phpMussel['substrbf']($ThisURL, '?');
                    $URLScanner['This'] = hash('md5', $URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
                    $URLScanner['URLsNoLookup'][$URLScanner['Iterable']] = 'URL-NOLOOKUP:' . $URLScanner['This'];
                    $URLScanner['URLParts'][$URLScanner['Iterable']] = $URLScanner['x'];
                    $URLScanner['URLs'][$URLScanner['Iterable']] = 'URL:' . $URLScanner['This'];
                    $URLScanner['x'] = $phpMussel['substraf']($ThisURL, '?');
                    $URLScanner['Queries'][$URLScanner['Iterable']] = 'QUERY:' . hash('md5', $URLScanner['x']) . ':' . strlen($URLScanner['x']) . ':';
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

            if (empty($phpMussel['InstanceCache'][$SigFile])) {
                $phpMussel['InstanceCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ":\n";
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
                            $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                            $phpMussel['L10N']->getString('scan_command_injection') . ', \'' . $phpMussel['HexSafe']($ItemCSV) . '\' (' . $OriginalFilenameSafe . ')'
                        );
                    }
                }
                unset($ItemCSV, $ArrayCSV);
            } elseif ($ThisConf[1] === 1) {
                foreach ([$md5, $sha1, $sha256] as $CheckThisHash) {
                    if (strpos($phpMussel['InstanceCache'][$SigFile], "\n" . $CheckThisHash . ':' . $StringLength . ':') !== false) {
                        $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], "\n" . $CheckThisHash . ':' . $StringLength . ':');
                        if (strpos($xSig, "\n") !== false) {
                            $xSig = $phpMussel['substrbf']($xSig, "\n");
                        }
                        $xSig = $phpMussel['vn_shorthand']($xSig);
                        if (
                            strpos($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') === false &&
                            empty($phpMussel['InstanceCache']['ignoreme'])
                        ) {
                            $phpMussel['Detected']($heur, $lnap, $xSig, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
                        }
                    }
                }
            } elseif ($ThisConf[1] === 2) {
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    if (!isset($PEArr['SectionArr'][$PEArr['k']]) || !is_array($PEArr['SectionArr'][$PEArr['k']])) {
                        continue;
                    }
                    foreach ($PEArr['SectionArr'][$PEArr['k']] as $TryThis) {
                        if (strpos($phpMussel['InstanceCache'][$SigFile], $TryThis) !== false) {
                            $xSig = $phpMussel['substraf']($phpMussel['InstanceCache'][$SigFile], $TryThis);
                            if (strpos($xSig, "\n") !== false) {
                                $xSig = $phpMussel['substrbf']($xSig, "\n");
                            }
                            $xSig = $phpMussel['vn_shorthand']($xSig);
                            if (
                                strpos($phpMussel['InstanceCache']['greylist'], ',' . $xSig . ',') === false &&
                                empty($phpMussel['InstanceCache']['ignoreme'])
                            ) {
                                $phpMussel['Detected']($heur, $lnap, $xSig, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
                            }
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
                                $phpMussel['Detected']($heur, $lnap, $xSig, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
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
                                $phpMussel['Detected']($heur, $lnap, $xSig, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
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
                    'crc32b',
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
                    'sha1',
                    'sha256',
                    'StringLength',
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
                                        if ($ThisSigPart[2] === 'A') {
                                            if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                                $ThisSigPart[0] === 'FD' &&
                                                strpos("\1" . substr($str_hex, 0, $ThisSigPart[3] * 2), "\1" . $ThisSigPart[1]) === false
                                            ) || (
                                                $ThisSigPart[0] === 'FD-RX' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, 0, $ThisSigPart[3] * 2))
                                            ) || (
                                                $ThisSigPart[0] === 'FD-NORM' &&
                                                strpos("\1" . substr($str_hex_norm, 0, $ThisSigPart[3] * 2), "\1" . $ThisSigPart[1]) === false
                                            ) || (
                                                $ThisSigPart[0] === 'FD-NORM-RX' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, 0, $ThisSigPart[3] * 2))
                                            ) || (
                                                $ThisSigPart[0] === 'META' &&
                                                !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, 0, $ThisSigPart[3] * 2))
                                            )) {
                                                continue 2;
                                            }
                                            continue;
                                        }
                                        if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                            $ThisSigPart[0] === 'FD' &&
                                            strpos(substr($str_hex, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2), $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] === 'FD-RX' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        ) || (
                                            $ThisSigPart[0] === 'FD-NORM' &&
                                            strpos(substr($str_hex_norm, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2), $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] === 'FD-NORM-RX' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        ) || (
                                            $ThisSigPart[0] === 'META' &&
                                            !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, $ThisSigPart[2] * 2, $ThisSigPart[3] * 2))
                                        )) {
                                            continue 2;
                                        }
                                        continue;
                                    }
                                    if ($ThisSigPart[2] === 'A') {
                                        if (strpos(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                            $ThisSigPart[0] === 'FN' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $OriginalFilename)
                                        ) || (
                                            $ThisSigPart[0] === 'FD' &&
                                            strpos("\1" . $str_hex, "\1" . $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] === 'FD-RX' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $str_hex)
                                        ) || (
                                            $ThisSigPart[0] === 'FD-NORM' &&
                                            strpos("\1" . $str_hex_norm, "\1" . $ThisSigPart[1]) === false
                                        ) || (
                                            $ThisSigPart[0] === 'FD-NORM-RX' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $str_hex_norm)
                                        ) || (
                                            $ThisSigPart[0] === 'META' &&
                                            !preg_match('/\A(?:' . $ThisSigPart[1] . ')/i', $CoExMeta)
                                        )) {
                                            continue 2;
                                        }
                                        continue;
                                    }
                                    if (strpos(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $ThisSigPart[0] . ',') === false || (
                                        $ThisSigPart[0] === 'FD' &&
                                        strpos(substr($str_hex, $ThisSigPart[2] * 2), $ThisSigPart[1]) === false
                                    ) || (
                                        $ThisSigPart[0] === 'FD-RX' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex, $ThisSigPart[2] * 2))
                                    ) || (
                                        $ThisSigPart[0] === 'FD-NORM' &&
                                        strpos(substr($str_hex_norm, $ThisSigPart[2] * 2), $ThisSigPart[1]) === false
                                    ) || (
                                        $ThisSigPart[0] === 'FD-NORM-RX' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($str_hex_norm, $ThisSigPart[2] * 2))
                                    ) || (
                                        $ThisSigPart[0] === 'META' &&
                                        !preg_match('/(?:' . $ThisSigPart[1] . ')/i', substr($CoExMeta, $ThisSigPart[2] * 2))
                                    )) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if ((
                                    $ThisSigPart[0] === 'FN' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $OriginalFilename)
                                ) || (
                                    $ThisSigPart[0] === 'FS-MIN' &&
                                    $StringLength < $ThisSigPart[1]
                                ) || (
                                    $ThisSigPart[0] === 'FS-MAX' &&
                                    $StringLength > $ThisSigPart[1]
                                ) || (
                                    $ThisSigPart[0] === 'FD' &&
                                    strpos($str_hex, $ThisSigPart[1]) === false
                                ) || (
                                    $ThisSigPart[0] === 'FD-RX' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $str_hex)
                                ) || (
                                    $ThisSigPart[0] === 'FD-NORM' &&
                                    strpos($str_hex_norm, $ThisSigPart[1]) === false
                                ) || (
                                    $ThisSigPart[0] === 'FD-NORM-RX' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $str_hex_norm)
                                ) || (
                                    $ThisSigPart[0] === 'META' &&
                                    !preg_match('/(?:' . $ThisSigPart[1] . ')/i', $CoExMeta)
                                )) {
                                    continue 2;
                                }
                                if (substr($ThisSigPart[0], 0, 1) === '$') {
                                    $VarInSigFile = substr($ThisSigPart[0], 1);
                                    if (!isset($$VarInSigFile) || is_array($$VarInSigFile) || $$VarInSigFile != $ThisSigPart[1]) {
                                        continue 2;
                                    }
                                    continue;
                                }
                                if (substr($ThisSigPart[0], 0, 2) === '!$') {
                                    $VarInSigFile = substr($ThisSigPart[0], 2);
                                    if (!isset($$VarInSigFile) || is_array($$VarInSigFile) || $$VarInSigFile == $ThisSigPart[1]) {
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
                                $phpMussel['Detected']($heur, $lnap, $SigName, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
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

            if (empty($phpMussel['InstanceCache'][$SigFile])) {
                $phpMussel['InstanceCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ":\n";
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
                if (substr($ThisSig, 0, 1) === '>') {
                    $ThisSig = explode('>', $ThisSig, 4);
                    if (!isset($ThisSig[1], $ThisSig[2], $ThisSig[3])) {
                        break;
                    }
                    $ThisSig[3] = (int)$ThisSig[3];
                    if ($ThisSig[1] === 'FN') {
                        if (!preg_match('/(?:' . $ThisSig[2] . ')/i', $OriginalFilename)) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] === 'FS-MIN') {
                        if ($StringLength < $ThisSig[2]) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] === 'FS-MAX') {
                        if ($StringLength > $ThisSig[2]) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] === 'FD') {
                        if (strpos($$DataSource, $ThisSig[2]) === false) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif ($ThisSig[1] === 'FD-RX') {
                        if (!preg_match('/(?:' . $ThisSig[2] . ')/i', $$DataSource)) {
                            if ($ThisSig[3] <= $SigNum) {
                                break;
                            }
                            $SigNum = $ThisSig[3] - 1;
                        }
                    } elseif (substr($ThisSig[1], 0, 1) === '$') {
                        $VarInSigFile = substr($ThisSig[1], 1);
                        if (isset($$VarInSigFile) && is_scalar($$VarInSigFile)) {
                            if (!$phpMussel['MatchVarInSigFile']($ThisSig[2], $$VarInSigFile)) {
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
                    } elseif (substr($ThisSig[1], 0, 2) === '!$') {
                        $VarInSigFile = substr($ThisSig[1], 2);
                        if (isset($$VarInSigFile) && is_scalar($$VarInSigFile)) {
                            if ($phpMussel['MatchVarInSigFile']($ThisSig[2], $$VarInSigFile)) {
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
                            if (preg_match('/(?:' . $ThisSig . ')/i', $OriginalFilename)) {
                                $phpMussel['Detected']($heur, $lnap, $VN, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
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
                        ))) {
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
                                    $ThisString = "\1" . $ThisString;
                                    $ThisSig[0] = "\1" . $ThisSig[0];
                                }
                                if ($xstrt === 'Z') {
                                    $ThisString .= "\1";
                                    $ThisSig[$ThisSigCount - 1] .= "\1";
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
                            $phpMussel['Detected']($heur, $lnap, $VN, $OriginalFilename, $OriginalFilenameSafe, $Out, $flagged, $md5, $StringLength);
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

        $URLScanner['URLsCount'] = count($URLScanner['URLParts']);

        /** Codeblock for performing Google Safe Browsing API lookups. */
        if ($phpMussel['Config']['urlscanner']['google_api_key'] && $URLScanner['URLsCount']) {
            $URLScanner['URLsChunked'] = (
                $URLScanner['URLsCount'] > 500
            ) ? array_chunk($URLScanner['URLParts'], 500) : [$URLScanner['URLParts']];
            $URLScanner['URLChunks'] = count($URLScanner['URLsChunked']);
            for ($i = 0; $i < $URLScanner['URLChunks']; $i++) {

                /** Maximum API lookups reached; abort accordingly. */
                if (
                    $phpMussel['Config']['urlscanner']['maximum_api_lookups'] > 0 &&
                    $phpMussel['LookupCount'] > $phpMussel['Config']['urlscanner']['maximum_api_lookups']
                ) {
                    if ($phpMussel['Config']['urlscanner']['maximum_api_lookups_response']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
                            $flagged = true;
                        }
                        $Out .= $lnap . sprintf(
                            $phpMussel['L10N']->getString('_exclamation_final'),
                            $phpMussel['L10N']->getString('too_many_urls')
                        ) . "\n";
                        $phpMussel['whyflagged'] .= sprintf(
                            $phpMussel['L10N']->getString('_exclamation'),
                            $phpMussel['L10N']->getString('too_many_urls') . ' (' . $OriginalFilenameSafe . ')'
                        );
                    }
                    break;
                }

                /** Perform safe browsing API lookup (v4). */
                $URLScanner['SafeBrowseLookup'] = $phpMussel['SafeBrowseLookup'](
                    $URLScanner['URLsChunked'][$i],
                    $URLScanner['URLPartsNoLookup'],
                    $URLScanner['DomainPartsNoLookup']
                );

                /** Bad URLs found; Flag accordingly. */
                if ($URLScanner['SafeBrowseLookup'] !== 204) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                        $URLScanner['L10N'] . ' (' . $OriginalFilenameSafe . ')'
                    );

                    /** Prevent further lookups in case of wrong API key used, malformed query, etc. */
                    if ($URLScanner['SafeBrowseLookup'] !== 200) {
                        break;
                    }
                }
            }
        }
    }

    /** URL scanner data cleanup. */
    unset($URLScanner);

    /** Plugin hook: "before_chameleon_detections". */
    $phpMussel['Execute_Hook']('before_chameleon_detections');

    /** Chameleon attack bypasses for Mac OS X thumbnails and screenshots. */
    $ThumbnailBypass = (
        substr($OriginalFilename, 0, 2) === '._' &&
        !preg_match('~[^\x00-\x1f]~', substr($str, 0, 8)) &&
        substr($str, 8, 8) === 'Mac OS X'
    );

    /** PHP chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_from_php']) {
        if ($phpMussel['ContainsMustAssert']([
            $phpMussel['Config']['attack_specific']['can_contain_php_file_extensions'],
            $phpMussel['Config']['attack_specific']['archive_file_extensions']
        ], [$xts, $gzxts, $xt, $gzxt]) && strpos($str_hex_norm, '3c3f706870') !== false) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PHP') . ' (' . $OriginalFilenameSafe . ')'
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
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon) . ' (' . $OriginalFilenameSafe . ')'
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
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $Chameleon) . ' (' . $OriginalFilenameSafe . ')'
            );
        }
    }

    /** Office document chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_doc']) {
        if (strpos(',doc,dot,pps,ppt,xla,xls,wiz,', ',' . $xt . ',') !== false) {
            if ($fourcc !== 'd0cf11e0') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                    sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'Office') . ' (' . $OriginalFilenameSafe . ')'
                );
            }
        }
    }

    /** Image chameleon attack detection. */
    if (!$ThumbnailBypass && $phpMussel['Config']['attack_specific']['chameleon_to_img']) {
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
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), $phpMussel['L10N']->getString('image')) . ' (' . $OriginalFilenameSafe . ')'
            );
        }
    }

    /** PDF chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_pdf']) {
        if ($xt === 'pdf' && !$pdf_magic) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                sprintf($phpMussel['L10N']->getString('scan_chameleon'), 'PDF') . ' (' . $OriginalFilenameSafe . ')'
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
                $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
                $flagged = true;
            }
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('detected_control_characters') . ' (' . $OriginalFilenameSafe . ')'
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
                    $VTParams,
                    12
                );
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
                                        $phpMussel['killdata'] .= $sha256 . ':' . $StringLength . ':' . $OriginalFilename . "\n";
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
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $OriginalFilenameSafe . ')'
                                        );
                                    } else {
                                        $Out .= $lnap . sprintf(
                                            $phpMussel['L10N']->getString('_exclamation_final'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN)
                                        ) . "\n";
                                        $phpMussel['whyflagged'] .= sprintf(
                                            $phpMussel['L10N']->getString('_exclamation'),
                                            sprintf($phpMussel['L10N']->getString('detected'), $VN) . ' (' . $OriginalFilenameSafe . ')'
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
        if (isset($phpMussel['cli_args'][1]) && $phpMussel['cli_args'][1] === 'cli_scan') {
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
 * @param string $Checksum A hash for the content, inherited from the parent.
 */
$phpMussel['MetaDataScan'] = function (&$x, &$r, $Indent, $ItemRef, $Filename, &$Data, $Depth, $Checksum) use (&$phpMussel) {

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
        $phpMussel['killdata'] .= $Checksum . ':' . $Filesize . ':' . $ItemRef . "\n";
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
            $phpMussel['InstanceCache']['blacklist_triggered'] = true;
            $r = 2;
            $phpMussel['killdata'] .= $Checksum . ':' . $Filesize . ':' . $ItemRef . "\n";
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
            $phpMussel['killdata'] .= $Checksum . ':' . $Filesize . ':' . $ItemRef . "\n";
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
        strtolower(substr($Filename, -14)) === 'vbaproject.bin' ||
        preg_match('~^\xd0\xcf|\x00Attribut|\x01CompObj|\x05Document~', $Data)
    );

    /** Handle macro detection and blocking. */
    if ($phpMussel['Config']['attack_specific']['block_macros'] && $phpMussel['InstanceCache']['file_is_macro']) {
        $r = 2;
        $phpMussel['killdata'] .= $Checksum . ':' . $Filesize . ':' . $ItemRef . "\n";
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
        unset($CompressionObject);
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
            'pm|s[dp])|s(id|v[ag])|tga|w(bmp?|ebp|mp)|x(cf|bmp))$/',
            $Ext
        ) ||
        preg_match(
            '/^(?:0000000c6a502020|25504446|38425053|424d|474946383[79]61|57454250|67696d7020786366|89504e47|ffd8ff)/',
            $Head
        )
    );
};

/**
 * Fetches extensions data from filenames.
 *
 * @param string $OriginalFilename The original filename.
 * @return array The extensions data.
 */
$phpMussel['FetchExt'] = function ($OriginalFilename) {
    $decPos = strrpos($OriginalFilename, '.');
    $OriginalFilenameLen = strlen($OriginalFilename);
    if ($decPos === false || $decPos === ($OriginalFilenameLen - 1)) {
        return ['-', '-', '-', '-'];
    }
    $xt = strtolower(substr($OriginalFilename, ($decPos + 1)));
    $xts = substr($xt, 0, 3) . '*';
    if (strtolower(substr($OriginalFilename, -3)) === '.gz') {
        $OriginalFilenameNoGZ = substr($OriginalFilename, 0, ($OriginalFilenameLen - 3));
        $decPosNoGZ = strrpos($OriginalFilenameNoGZ, '.');
        if ($decPosNoGZ !== false && $decPosNoGZ !== (strlen($OriginalFilenameNoGZ) - 1)) {
            $gzxt = strtolower(substr($OriginalFilenameNoGZ, ($decPosNoGZ + 1)));
            $gzxts = substr($gzxt, 0, 3) . '*';
        }
    } else {
        $gzxts = $gzxt = '-';
    }
    return [$xt, $xts, $gzxt, $gzxts];
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
 *      When operating in the context of CLI mode, both $f and $OriginalFilename represent
 *      the scan target, as per specified by the CLI operator; The only
 *      difference between the two is when the scan target is a directory,
 *      rather than a single file; $f will represent the full path to the file
 *      (so, directory plus filename), whereas $OriginalFilename will represent only the
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
 * @param string $OriginalFilename For the file upload scanning that phpMussel normally
 *      performs by default, this parameter represents the "original filename"
 *      of the file being scanned (the original filename, in this context,
 *      referring to the name supplied by the upload client, as opposed to the
 *      temporary filename assigned by the server or anything else).
 *      When operating in the context of CLI mode, both $f and $OriginalFilename represent
 *      the scan target, as per specified by the CLI operator; The only
 *      difference between the two is when the scan target is a directory,
 *      rather than a single file; $f will represent the full path to the file
 *      (so, directory plus filename), whereas $OriginalFilename will represent only the
 *      filename.
 * @return int|string|array The scan results, returned as an array when the $f
 *      parameter is an array and when $n and/or $zz is/are false, and
 *      otherwise returned as per described by the README documentation. The
 *      function may also die the script and return nothing, if something goes
 *      wrong, such as if the function is triggered in the absence of the
 *      required $phpMussel['InstanceCache'] variable being set.
 */
$phpMussel['Recursor'] = function ($f = '', $n = false, $zz = false, $dpt = 0, $OriginalFilename = '') use (&$phpMussel) {
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

    $OriginalFilename = $phpMussel['prescan_decode']($OriginalFilename);
    $OriginalFilenameSafe = urlencode($OriginalFilename);

    /**
     * If the scan target is a directory, iterate through the directory
     * contents and recurse the recursor with these contents.
     */
    if (is_dir($f)) {
        if (!is_readable($f)) {
            $phpMussel['InstanceCache']['scan_errors']++;
            return !$n ? 0 : $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                sprintf($phpMussel['L10N']->getString('failed_to_access'), $OriginalFilename)
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
            $Handle = fopen($phpMussel['Vault'] . 'greylist.csv', 'ab');
            fwrite($Handle, ',');
            fclose($Handle);
        } else {
            $phpMussel['InstanceCache']['greylist'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'greylist.csv');
        }
    }

    /** Plugin hook: "before_scan". */
    $phpMussel['Execute_Hook']('before_scan');

    $fnCRC = hash('crc32b', $OriginalFilename);

    /** Kill it here if the scan target isn't a valid file. */
    if (!$f || !$d = is_file($f)) {
        return (!$n) ? 0 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $OriginalFilename .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap . $phpMussel['L10N']->getString('invalid_file') . "\n";
    }

    $fS = filesize($f);
    if ($phpMussel['Config']['files']['filesize_limit'] > 0) {
        if ($fS > $phpMussel['ReadBytes']($phpMussel['Config']['files']['filesize_limit'])) {
            if (!$phpMussel['Config']['files']['filesize_response']) {
                return (!$n) ? 1 :
                    $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
                    $OriginalFilename . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
                    $phpMussel['L10N']->getString('ok') . ' (' .
                    $phpMussel['L10N']->getString('filesize_limit_exceeded') . ").\n";
            }
            $phpMussel['killdata'] .= str_repeat('-', 64) . ':' . $fS . ':' . $OriginalFilename . "\n";
            $phpMussel['whyflagged'] .= sprintf(
                $phpMussel['L10N']->getString('_exclamation'),
                $phpMussel['L10N']->getString('filesize_limit_exceeded') . ' (' . $OriginalFilenameSafe . ')'
            );
            if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
                unlink($f);
            }
            return (!$n) ? 2 :
                $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $OriginalFilename .
                '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
                $phpMussel['L10N']->getString('filesize_limit_exceeded') .
                $phpMussel['L10N']->getString('_fullstop_final') . "\n";
        }
    }
    if (!$phpMussel['Config']['attack_specific']['allow_leading_trailing_dots'] && (
        substr($OriginalFilename, 0, 1) === '.' || substr($OriginalFilename, -1) === '.'
    )) {
        $phpMussel['killdata'] .= str_repeat('-', 64) . ':' . $fS . ':' . $OriginalFilename . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('scan_filename_manipulation_detected') . ' (' . $OriginalFilenameSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $OriginalFilename .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap . sprintf(
                $phpMussel['L10N']->getString('_exclamation_final'),
                $phpMussel['L10N']->getString('scan_filename_manipulation_detected')
            ) . "\n";
    }

    /** Get file extensions. */
    list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($OriginalFilename);

    /** Process filetype whitelisting. */
    if ($phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_whitelist']
    ], [$xt, $xts, $gzxt, $gzxts], ',', true, true)) {
        return (!$n) ? 1 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' . $OriginalFilename .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['L10N']->getString('scan_no_problems_found') . "\n";
    }

    /** Process filetype blacklisting. */
    if ($phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_blacklist']
    ], [$xt, $xts, $gzxt, $gzxts], ',', true, true)) {
        $phpMussel['InstanceCache']['blacklist_triggered'] = true;
        $phpMussel['killdata'] .= str_repeat('-', 64) . ':' . $fS . ':' . $OriginalFilename . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $OriginalFilenameSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $OriginalFilename . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['L10N']->getString('filetype_blacklisted') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
    }

    /** Process filetype greylisting (when relevant). */
    if (!empty($phpMussel['Config']['files']['filetype_greylist']) && $phpMussel['ContainsMustAssert']([
        $phpMussel['Config']['files']['filetype_greylist']
    ], [$xt, $xts, $gzxt, $gzxts])) {
        $phpMussel['killdata'] .= str_repeat('-', 64) . ':' . $fS . ':' . $OriginalFilename . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('filetype_blacklisted') . ' (' . $OriginalFilenameSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $OriginalFilename . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
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
        $phpMussel['killdata'] .= hash('sha256', $in) . ':' . $fS . ':' . $OriginalFilename . "\n";
        $phpMussel['whyflagged'] .= sprintf(
            $phpMussel['L10N']->getString('_exclamation'),
            $phpMussel['L10N']->getString('only_allow_images') . ' (' . $OriginalFilenameSafe . ')'
        );
        if ($phpMussel['Config']['general']['delete_on_sight'] && is_readable($f)) {
            unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['L10N']->getString('scan_checking') . ' \'' .
            $OriginalFilename . '\' (FN: ' . $fnCRC . '; FD: ' . $fdCRC . "):\n-" .
            $lnap . $phpMussel['L10N']->getString('only_allow_images') .
            $phpMussel['L10N']->getString('_fullstop_final') . "\n";
    }

    /** Increment objects scanned count. */
    $phpMussel['InstanceCache']['objects_scanned']++;

    /** Send the scan target to the data handler. */
    try {
        $z = $phpMussel['DataHandler']($in, $dpt, $OriginalFilename);
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
                $z = $phpMussel['DataHandler']($CompressionObject->Data, $dpt, $phpMussel['DropTrailingCompressionExtension']($OriginalFilename));
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
        unset($CompressionObject);
    }

    /** Executed if there were any problems or if anything was detected. */
    if ($z[0] !== 1) {
        /** Quarantine if necessary. */
        if ($z[0] === 2) {
            if (
                $phpMussel['Config']['general']['quarantine_key'] &&
                strlen($in) < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
            ) {
                /** Note: "qfu" = "Quarantined File Upload". */
                $qfu = $phpMussel['Time'] . '-' . hash('md5', $phpMussel['Config']['general']['quarantine_key'] . $fdCRC . $phpMussel['Time']);
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
            $OriginalFilename,
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
        $OriginalFilename,
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
        $phpMussel['ArchiveRecursor']($x, $r, $in, (isset($CompressionResults) && !$CompressionResults) ? '' : $f, 0, urlencode($OriginalFilename));

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
            strlen($in) < $phpMussel['ReadBytes']($phpMussel['Config']['general']['quarantine_max_filesize'])
        ) {
            /** Note: "qfu" = "Quarantined File Upload". */
            $qfu = $phpMussel['Time'] . '-' . hash('md5', $phpMussel['Config']['general']['quarantine_key'] . $fdCRC . $phpMussel['Time']);
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
    list($xt, $xts, $gzxt, $gzxts) = $phpMussel['FetchExt']($ItemRef);

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
        substr($Data, 257, 6) === "ustar\0" ||
        strpos(',tar,tgz,tbz,tlz,tz,', ',' . $xt . ',') !== false
    ) {
        $Handler = 'TarHandler';
        $ConType = 'TarFile';
        $phpMussel['InstanceCache']['container'] = 'tarfile';
    } elseif (substr($Data, 0, 4) === 'Rar!' || substr($Data, 0, 4) === 'RE~^') {
        $Handler = 'RarHandler';
        $ConType = 'RarFile';
        $phpMussel['InstanceCache']['container'] = 'rarfile';
    } elseif (substr($Data, 0, 4) === "\x25PDF") {
        $Handler = 'PdfHandler';
        $ConType = 'PdfFile';
        $phpMussel['InstanceCache']['container'] = 'pdffile';
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
    $DataHash = hash('md5', $Data);

    /** Fetch length of current input data. */
    $DataLen = strlen($Data);

    /** Handle zip files. */
    if ($Handler === 'ZipHandler') {
        /**
         * Encryption guard.
         * @link https://pkware.cachefly.net/webdocs/casestudies/APPNOTE.TXT
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
        if (!class_exists('\ZipArchive')) {
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
        if (!class_exists('\RarArchive') || !class_exists('\RarEntry')) {
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

    /** Handle PDF files. */
    if ($Handler === 'PdfHandler') {
        /** Encryption guard. */
        if ($phpMussel['Config']['files']['block_encrypted_archives']) {
            if (($XPos = strrpos($Data, "\nxref")) !== false && strpos($Data, "\n/Encrypt", $XPos + 5) !== false) {
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

        /** PdfHandler can work with data directly. */
        $ArchiveObject = new \phpMussel\ArchiveHandler\PdfHandler($Data);
    }

    /** Archive object has been instantiated. Let's proceed. */
    if (isset($ArchiveObject) && is_object($ArchiveObject)) {
        /** No errors reported. Let's try checking its contents. */
        if ($ArchiveObject->ErrorState === 0) {

            /** Used to count the number of entries processed. */
            $Processed = 0;

            /** Iterate through the archive's contents. */
            while ($ArchiveObject->EntryNext()) {

                /** Skip directories (useless for scanning here). */
                if ($ArchiveObject->EntryIsDirectory()) {
                    continue;
                }

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
                $Hash = hash('sha256', $Content);
                $NameCRC32 = hash('crc32b', $Filename);
                $DataCRC32 = hash('crc32b', $Content);
                $InternalCRC = $ArchiveObject->EntryCRC();
                $ThisItemRef = $ItemRef . '>' . urlencode($Filename);

                /** Verify filesize, integrity, etc. Exit early in case of problems. */
                if ($Filesize !== strlen($Content) || (
                    $InternalCRC &&
                    preg_replace('~^0+~', '', $DataCRC32) !== preg_replace('~^0+~', '', $InternalCRC)
                )) {
                    $r = 2;
                    $phpMussel['killdata'] .= $Hash . ':' . $Filesize . ':' . $ThisItemRef . "\n";
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
                    $phpMussel['killdata'] .= $Hash . ':' . $Filesize . ':' . $ThisItemRef . "\n";
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
                if ($phpMussel['QuineDetector']($ScanDepth, $DataHash, $DataLen, $Hash, $Filesize)) {
                    $r = 2;
                    $phpMussel['killdata'] .= $Hash . ':' . $Filesize . ':' . $ThisItemRef . "\n";
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
                        $Hash
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
 * @param string $Item The name of the item to be scanned w/ its path.
 * @param string $OriginalFilename The name of the item to be scanned w/o its path.
 * @return string The scan results to pipe back to the parent.
 */
$phpMussel['Fork'] = function ($Item = '', $OriginalFilename = '') use (&$phpMussel) {
    $ProcessHandle = popen(
        $phpMussel['Mussel_PHP'] . ' "' . $phpMussel['Vault'] .
        '../loader.php" "cli_scan" "' . $Item . '" "' . $OriginalFilename . '"',
        'rb'
    );
    $Output = '';
    while ($Data = fgets($ProcessHandle)) {
        $Output .= $Data;
    }
    pclose($ProcessHandle);
    return $Output;
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
 * The main scan closure, responsible for initialising most scan events. Should
 * generally be called whenever phpMussel is leveraged by CMS, frameworks, etc.
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
 * @param string $OriginalFilename For the file upload scanning that phpMussel normally
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
$phpMussel['Scan'] = function ($f = '', $n = false, $zz = false, $dpt = 0, $OriginalFilename = '') use (&$phpMussel) {
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
    if (!$OriginalFilename) {
        $OriginalFilename = $f;
    }

    $phpMussel['InstanceCache']['start_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
    $phpMussel['InstanceCache']['start_time_2822'] = $phpMussel['TimeFormat'](
        $phpMussel['InstanceCache']['start_time'],
        $phpMussel['Config']['general']['timeFormat']
    );
    try {
        $r = $phpMussel['Recursor']($f, $n, $zz, $dpt, $OriginalFilename);
    } catch (\Exception $e) {
        throw new \Exception($e->getMessage());
    }
    $phpMussel['InstanceCache']['end_time'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);
    $phpMussel['InstanceCache']['end_time_2822'] = $phpMussel['TimeFormat'](
        $phpMussel['InstanceCache']['end_time'],
        $phpMussel['Config']['general']['timeFormat']
    );

    /** Plugin hook: "after_scan". */
    $phpMussel['Execute_Hook']('after_scan');

    if ($n && !is_array($r)) {
        $r = sprintf(
            "%s %s%s\n%s%s %s%s\n",
            $phpMussel['InstanceCache']['start_time_2822'],
            $phpMussel['L10N']->getString('started'),
            $phpMussel['L10N']->getString('_fullstop_final'),
            $r,
            $phpMussel['InstanceCache']['end_time_2822'],
            $phpMussel['L10N']->getString('finished'),
            $phpMussel['L10N']->getString('_fullstop_final')
        );
        $phpMussel['Events']->fireEvent('writeToScanLog', $r);
    }
    if (!isset($phpMussel['SkipSerial'])) {
        $phpMussel['Events']->fireEvent('writeToSerialLog');
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
 * A simple closure for replacing date/time placeholders with corresponding
 * date/time information. Used by the logfiles and some timestamps.
 *
 * @param int $Time A unix timestamp.
 * @param string|array $In An input or an array of inputs to manipulate.
 * @return string|array The adjusted input(/s).
 */
$phpMussel['TimeFormat'] = function ($Time, $In) use (&$phpMussel) {
    /** Guard. */
    if (!is_array($In) && (strpos($In, '{') === false || strpos($In, '}') === false)) {
        return $In;
    }

    $Time = date('dmYHisDMP', $Time);
    $Values = [
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
    $Values['d'] = (int)$Values['dd'];
    $Values['m'] = (int)$Values['mm'];
    return is_array($In) ? array_map(function ($Item) use (&$Values, &$phpMussel) {
        return $phpMussel['ParseVars']($Values, $Item);
    }, $In) : $phpMussel['ParseVars']($Values, $In);
};

/**
 * Fix incorrect typecasting for some for some variables that sometimes default
 * to strings instead of booleans or integers.
 *
 * @param mixed $Var The variable to fix (passed by reference).
 * @param string $Type The type (or pseudo-type) to cast the variable to.
 * @return void
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
 * @return void
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
            if (isset($DData['value_preg_filter']) && is_array($DData['value_preg_filter'])) {
                foreach ($DData['value_preg_filter'] as $FilterKey => $FilterValue) {
                    $Dir = preg_replace($FilterKey, $FilterValue, $Dir);
                }
            }
            if (isset($DData['type'])) {
                $phpMussel['AutoType']($Dir, $DData['type']);
            }
        }
    }
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
        return;
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
 * @return array The unpacked data (or an empty array upon failure).
 */
$phpMussel['UnpackSafe'] = function ($Format, $Data) {
    if (!is_string($Format) || !is_string($Data) || strlen($Data) < 1) {
        return [];
    }
    return unpack($Format, $Data) ?: [];
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
    $List = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($Base), \RecursiveIteratorIterator::SELF_FIRST);
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
    return is_file($Params) || filter_var($Params, FILTER_VALIDATE_URL) ? $Callable($Params) : sprintf($phpMussel['L10N']->getString('cli_is_not_a'), $Params) . "\n";
};

/**
 * Increments statistics if they've been enabled.
 *
 * @param string $Statistic The statistic to increment.
 * @param int $Amount The amount to increment it by.
 */
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
        $Handle = fopen($File, 'wb');
        fwrite($Handle, $Data);
        fclose($Handle);
    }
    $IndexFile = $phpMussel['cachePath'] . 'index.dat';
    $IndexNewData = $IndexData = $phpMussel['ReadFile']($IndexFile) ?: '';
    while (strpos($IndexNewData, 'HashCache:') !== false) {
        $IndexNewData = str_ireplace('HashCache:' . $phpMussel['substrbf']($phpMussel['substraf']($IndexNewData, 'HashCache:'), ';') . ';', '', $IndexNewData);
    }
    if ($IndexNewData !== $IndexData) {
        $IndexHandle = fopen($IndexFile, 'wb');
        fwrite($IndexHandle, $IndexNewData);
        fclose($IndexHandle);
    }
    return true;
};

/**
 * Build any missing parts of the given path, apply date/time replacements, and
 * check whether the path is writable.
 *
 * @param string $Path The path we're building for.
 * @param bool $PointsToFile Whether the path ultimately points to a file or a
 *      directory.
 * @return string If all missing parts were successfully built and the final
 *      rebuilt path is writable, returns the final rebuilt path. Otherwise,
 *      returns an empty string.
 */
$phpMussel['BuildPath'] = function ($Path, $PointsToFile = true) use (&$phpMussel) {
    /** Input guard. */
    if (!is_string($Path) || !strlen($Path)) {
        return '';
    }

    /** Applies time/date replacements. */
    $Path = $phpMussel['TimeFormat']($phpMussel['Time'], $Path);

    /** We'll skip is_dir/mkdir calls if open_basedir is populated (to avoid PHP bug #69240). */
    $Restrictions = strlen(ini_get('open_basedir')) > 0;

    /** Split path into steps. */
    $Steps = preg_split('~[\\\/]~', $Path, -1, PREG_SPLIT_NO_EMPTY);

    /** Separate file from path. */
    $File = $PointsToFile ? array_pop($Steps) : '';

    /** Build directories. */
    foreach ($Steps as $Step) {
        if (!isset($Rebuilt)) {
            $Rebuilt = preg_match('~^[\\\/]~', $Path) ? DIRECTORY_SEPARATOR . $Step : $Step;
        } else {
            $Rebuilt .= DIRECTORY_SEPARATOR . $Step;
        }
        if (preg_match('~^\.+$~', $Step)) {
            continue;
        }
        if (!$Restrictions && !is_dir($Rebuilt) && !mkdir($Rebuilt)) {
            return '';
        }
    }

    /** Ensure rebuilt is defined. */
    if (!isset($Rebuilt)) {
        $Rebuilt = '';
    }

    /** Return an empty string if the final rebuilt path isn't writable. */
    if (!is_writable($Rebuilt)) {
        return '';
    }

    /** Append file. */
    if ($File) {
        $Rebuilt .= ($Rebuilt ? DIRECTORY_SEPARATOR : '') . $File;
    }

    /** Return the final rebuilt path. */
    return $Rebuilt;
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
 * @return bool True on success; False on failure.
 */
$phpMussel['GZCompressFile'] = function ($File) {
    /** Guard. */
    if (!is_file($File) || !is_readable($File)) {
        return false;
    }

    /** Default blocksize (128KB). */
    static $Blocksize = 131072;

    $Handle = fopen($File, 'rb');
    if (!is_resource($Handle)) {
        return false;
    }
    $HandleGZ = gzopen($File . '.gz', 'wb');
    if (!is_resource($HandleGZ)) {
        return false;
    }
    while (!feof($Handle)) {
        $Data = fread($Handle, $Blocksize);
        gzwrite($HandleGZ, $Data);
    }
    gzclose($HandleGZ);
    fclose($Handle);
    return true;
};

/**
 * Log rotation.
 *
 * @param string $Pattern What to identify logfiles by (should be supplied via the relevant logging directive).
 * @return bool False when log rotation is disabled or errors occur; True otherwise.
 */
$phpMussel['LogRotation'] = function ($Pattern) use (&$phpMussel) {
    $Limit = empty($phpMussel['Config']['general']['log_rotation_limit']) ? 0 : $phpMussel['Config']['general']['log_rotation_limit'];
    $Action = empty($phpMussel['Config']['general']['log_rotation_action']) ? '' : $phpMussel['Config']['general']['log_rotation_action'];
    if ($Limit < 1 || ($Action !== 'Delete' && $Action !== 'Archive')) {
        return false;
    }
    $Pattern = $phpMussel['BuildLogPattern']($Pattern);
    $Arr = [];
    $Offset = strlen($phpMussel['Vault']);
    $List = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($phpMussel['Vault']), \RecursiveIteratorIterator::SELF_FIRST);
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
    return $Err === 0;
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

/**
 * Initialise the cache.
 */
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

    /** Guard against missing cache directory. */
    if (!$phpMussel['Cache']->Using && !$phpMussel['BuildPath']($phpMussel['cachePath'], false)) {
        die('[phpMussel] Unable to write to the cache.');
    }
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
        if ($phpMussel['Events']->assigned('error')) {
            $phpMussel['Events']->fireEvent('error', serialize([$errno, $errstr, $errfile, $errline]));
        }
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

/** Make sure the vault is defined so that tests don't break. */
if (isset($phpMussel['Vault'])) {
    /** Load all default event handlers. */
    require $phpMussel['Vault'] . 'event_handlers.php';
}
