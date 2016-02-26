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
 * This file: phpMussel functions file (last modified: 2016.02.26).
 *
 * @package Maikuolan/phpMussel
 *
 * @todo Add support for PHAR, 7z, RAR (github.com/phpMussel/universe/issues/5).
 * @todo Add recursion support for ZIP scanning.
 * @todo Wish list: Icon parsing (github.com/Maikuolan/phpMussel/issues/5).
 * @todo Wish list: Certificate parsing (github.com/Maikuolan/phpMussel/issues/4).
 * @todo Fix client language bug (github.com/Maikuolan/phpMussel/issues/28).
 * @todo Get serialised logging working for CLI mode (github.com/Maikuolan/phpMussel/issues/54).
 * @todo Fix non-ANSI/non-ASCII filenames in CLI mode bug (github.com/Maikuolan/phpMussel/issues/61).
 * @todo Complete Google Safe Browsing integration (github.com/Maikuolan/phpMussel/issues/65).
 * @todo Improve data decoding procedures.
 * @todo PSR (github.com/Maikuolan/phpMussel/issues/80)
 * @todo phpMussel v1.0.0 Transitional Preparations Checklist (github.com/Maikuolan/phpMussel/issues/82)
 */

/**
 * The `phpMussel_Register_Hook` function is used to register plugin functions
 * to their intended hooks.
 *
 * @since v0.9.0
 * @param string $what The name of the chosen function to execute at the
 *      desired point in the script.
 * @param string $where Instructs the function which "hook" your chosen
 *      function should be registered to.
 * @param string|array $with Represents the variables to be parsed to your
 *      function from the scope in which it'll be executed from (optional).
 * @return bool
 */
function phpMussel_Register_Hook($what, $where, $with = '') {
    global $phpMussel;
    if (!isset($phpMussel['MusselPlugins']['hooks']) || !isset($phpMussel['MusselPlugins']['hookcounts'])) {
        return false;
    }
    if (!isset($phpMussel['MusselPlugins']['hooks'][$where])) {
        $phpMussel['MusselPlugins']['hooks'][$where] = array();
    }
    if (!isset($phpMussel['MusselPlugins']['hookcounts'][$where])) {
        $phpMussel['MusselPlugins']['hookcounts'][$where] = 0;
    }
    $phpMussel['MusselPlugins']['hooks'][$where][$what] = $with;
    $phpMussel['MusselPlugins']['hookcounts'][$where]++;
    return true;
}

/**
 * This is a specialised search-and-replace function, designed to replace
 * encapsulated substrings within a given input string based upon the elements
 * of a given input array. The function accepts two input parameters: The
 * first, the input array, and the second, the input string. The function
 * searches for any instances of each array key, encapsulated by curly
 * brackets, as substrings within the input string, and replaces any instances
 * found with the array element content corresponding to the array key
 * associated with each instance found.
 *
 * This function is used extensively throughout phpMussel, to parse its
 * language data and to parse any messages related to any detections found
 * during the scan process and any other related processes.
 *
 * @since v0.6j
 * @param array $v The input array.
 * @param string $b The input string.
 * @return string The results of the function are returned directly to the
 *      calling scope as a string.
 */
function phpMusselV($v, $b) {
    if (!is_array($v) || empty($b)) {
        return '';
    }
    $c = count($v);
    reset($v);
    for ($i = 0; $i < $c; $i++) {
        $k = key($v);
        $b = str_replace('{' . $k . '}', $v[$k], $b);
        next($v);
    }
    return $b;
}

if (!function_exists('implode_md')) {
    /**
     * Implodes multidimensional arrays.
     *
     * @param array $ar The array to be imploded.
     * @param string|array $j A "needle" or "joiner" to use for imploding the
     *      array (optional). If a numeric array is used, an element of the
     *      array corresponding to the recursion depth will be used as the
     *      needle or joiner.
     * @param int $i Used by the function when calling itself recursively, for
     *      the purpose of tracking recursion depth (shouldn't be used outside
     *      the function).
     * @param bool $e When set to false, empty elements will be ignored
     *      (optional).
     * @return string The imploded array.
     */
    function implode_md($ar, $j = '', $i = 0, $e = true) {
        if (!is_array($ar)) {
            return $ar;
        }
        $c = count($ar);
        if (!$c || is_array($i)) {
            return false;
        }
        if (is_array($j)) {
            if (!$x = $j[$i]) {
                return false;
            }
        } else {
            $x = $j;
        }
        $out = '';
        while ($c > 0) {
            $key = key($ar);
            if (is_array($ar[$key])) {
                $i++;
                $ar[$key] = implode_md($ar[$key], $j, $i);
                $i--;
            }
            if (!$out) {
                $out = $ar[$key];
            } elseif (!(!$e && empty($ar[$key]))) {
                $out .= $x . $ar[$key];
            }
            next($ar);
            $c--;
        }
        return $out;
    }
}

if (!function_exists('str_split')) {
    /**
     * A fallback function for `str_split()` (it converts strings to arrays).
     *
     * Fallback functions ensure backwards compatibility between phpMussel and
     * older versions of PHP, whereby phpMussel may require some particular
     * function that isn't support or implemented by some older version of PHP.
     *
     * @deprecated PHP's in-built `str_split()` function was introduced with
     *      PHP 5.0.0-BETA1, and the minimum version of PHP required by
     *      phpMussel according to our "composer.json" file is PHP 5.4.0, and
     *      therefore, this fallback should already no longer be in use. We are
     *      marking this fallback as deprecated, and it will be it removed as
     *      part of the next major version release of phpMussel (1.0.0).
     * @param string $s The string to be converted/split.
     * @return array The converted/split string.
     */
    function str_split($s) {
        return preg_split("//", $s, -1, PREG_SPLIT_NO_EMPTY);
    }
}

if (!function_exists('substr_compare_hex')) {
    /**
     * A function for comparing substrings with hex values.
     *
     * @param string $str The source/raw string to be compared.
     * @param int $st At what point in the source/raw string should the
     *      comparing begin (optional)? The first character of the string
     *      starts at "0".
     * @param int $l For how many bytes of the string, starting from `$st`,
     *      should the comparing occur (optional)? Defaults to the total
     *      length of the string.
     * @param string $x The hexadecimal value to compare the string against.
     * @param bool $p When set to false, the function will return true if the
     *      hexadecimal value can be matched to at least some part of the
     *      substring being compared; When set to true, the function will
     *      return true if the hexadecimal value is an exact match to the
     *      entirety of the substring being compared (optional).
     * @return bool The results of the comparison (true if matched, false if
     *      not matched).
     */
    function substr_compare_hex($str = '', $st = 0, $l = 0, $x = 0, $p = false) {
        if (!$l) {
            $l = strlen($str);
        }
        if (!$x || !$l) {
            return false;
        }
        for ($str = substr($str, $st, $l), $y = '', $i = 0; $i < $l; $i++) {
            $z = dechex(ord($str[$i]));
            if (strlen($z) === 1) {
                $z = '0' . $z;
            }
            $y .= $z;
        }
        if (!$p) {
            return (substr_count($y, strtolower($x)) > 0) ? true : false;
        }
        return ($y === strtolower($x)) ? true : false;
    }
}

if (!function_exists('bin2hex')) {
    /**
     * A fallback function for `bin2hex()` (it converts binary strings to
     * hexadecimal values).
     *
     * Fallback functions ensure backwards compatibility between phpMussel and
     * older versions of PHP, whereby phpMussel may require some particular
     * function that isn't support or implemented by some older version of PHP.
     *
     * @deprecated PHP's in-built `bin2hex()` function was introduced with
     *      PHP4, and the minimum version of PHP required by phpMussel
     *      according to our "composer.json" file is PHP 5.4.0, and therefore,
     *      this fallback should already no longer be in use. We are marking
     *      this fallback as deprecated, and it will be it removed as part of
     *      the next major version release of phpMussel (1.0.0).
     * @param string $str The string to be converted.
     * @return string The converted string.
     */
    function bin2hex($str) {
        $l = strlen($str);
        for ($y = '', $i = 0; $i < $l; $i++) {
            $z = dechex(ord($str[$i]));
            if (strlen($z) === 1) {
                $z = '0' . $z;
            }
            $y .= $z;
        }
        return $y;
    }
}

if (!function_exists('hex2bin')) {
    /**
     * A fallback function for `hex2bin()` (it converts hexadecimal values to
     * binary strings).
     *
     * Fallback functions ensure backwards compatibility between phpMussel and
     * older versions of PHP, whereby phpMussel may require some particular
     * function that isn't support or implemented by some older version of PHP.
     *
     * @deprecated PHP's in-built `hex2bin()` function was introduced with
     *      PHP 5.4.0, and the minimum version of PHP required by phpMussel
     *      according to our "composer.json" file is PHP 5.4.0, and therefore,
     *      this fallback should already no longer be in use. We are marking
     *      this fallback as deprecated, and it will be it removed as part of
     *      the next major version release of phpMussel (1.0.0).
     * @param string $str The string to be converted.
     * @return string The converted string.
     */
    function hex2bin($str) {
        $l = strlen($str);
        for ($n = '', $x = false, $i = 0; $i < $l; $i++) {
            $x = (!$x) ? true : false;
            if ($x) {
                $z = $i + 1;
                $n .= chr(hexdec($str[$i] . $str[$z]));
            }
        }
        return $n;
    }
}

/**
 * A function for doing some very simplistic decoding work on strings prior to
 * their use in various contexts.
 *
 * @param string $str The string to be decoded.
 * @return string The decoded string.
 */
function prescan_decode($str) {
    $nstr = html_entity_decode(urldecode(str_ireplace('&amp;#', '&#', str_ireplace('&amp;amp;', '&amp;', $str))));
    if ($nstr !== $str) {
        $nstr = prescan_decode($nstr);
    }
    return $nstr;
}

/**
 * A function for doing some more complex decoding and normalisation work on
 * strings prior to their use in various contexts.
 *
 * @param string $str The string to be decoded/normalised.
 * @param bool $html If true, "style" and "script" tags will be stripped from
 *      the input string (optional; defaults to false).
 * @param bool $decode If false, the input string will be normalised, but not
 *      decoded; If true, the input string will be normalised -and- decoded
 *      (optional; defaults to false).
 * @return string The decoded/normalised string.
 *
 * @todo There are many common forms of obfuscation and packing that aren't yet
 *      being detected, decoded or normalised by the function; The capabilities
 *      of the function needs to eventually be expanded upon, in order to
 *      resolve this and thus improve upon the defensive capabilities of
 *      phpMussel as a whole.
 */
function prescan_normalise($str, $html = false, $decode = false) {
    $ostr = '';
    if ($decode) {
        $ostr .= $str;
        while (true) {
            if (function_exists('gzinflate')) {
                if ($c = preg_match_all(
                    '/(gzinflate\s{0,2048}\(\s{0,2048}str_rot13\s{0,2048}\(' .
                    '\s{0,2048}base64_decode\s{0,2048}\(\s{0,2048}["\'])([A-' .
                    'Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[' .
                    'A-Za-z0-9+\/]{2}==)(["\']\s{0,2048}\)\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . gzinflate(str_rot13(base64_decode(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[4][$i])))) . '"',
                            $str
                        );
                    }
                    continue;
                }
                if ($c = preg_match_all(
                    '/(gzinflate\s{0,2048}\(\s{0,2048}base64_decode\s{0,2048' .
                    '}\(\s{0,2048}str_rot13\s{0,2048}\(\s{0,2048}["\'])([^\'' .
                    '"\(\)]{1,4096})(["\']\s{0,2048}\)\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . gzinflate(base64_decode(str_rot13(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i])))) . '"',
                            $str
                        );
                    }
                    continue;
                }
                if ($c = preg_match_all(
                    '/(str_rot13\s{0,2048}\(\s{0,2048}gzinflate\s{0,2048}\(' .
                    '\s{0,2048}base64_decode\s{0,2048}\(\s{0,2048}["\'])([A-' .
                    'Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[' .
                    'A-Za-z0-9+\/]{2}==)(["\']\s{0,2048}\)\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . str_rot13(gzinflate(base64_decode(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[4][$i])))) . '"',
                            $str
                        );
                    }
                    continue;
                }
                if ($c = preg_match_all(
                    '/(base64_decode\s{0,2048}\(\s{0,2048}gzinflate\s{0,2048' .
                    '}\(\s{0,2048}str_rot13\s{0,2048}\(\s{0,2048}["\'])([^\'' .
                    '"\(\)]{1,4096})(["\']\s{0,2048}\)\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . base64_decode(gzinflate(str_rot13(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i])))) . '"',
                            $str
                        );
                    }
                    continue;
                }
                if ($c = preg_match_all(
                    '/(gzinflate\s{0,2048}\(\s{0,2048}base64_decode\s{0,2048' .
                    '}\(\s{0,2048}["\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{' .
                    '4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)(["\']\s{0,20' .
                    '48}\)\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . gzinflate(base64_decode(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[4][$i]))) . '"',
                            $str
                        );
                    }
                continue;
                }
                if ($c = preg_match_all(
                    '/(gzinflate\s{0,2048}\(\s{0,2048}str_rot13\s{0,2048}\(' .
                    '\s{0,2048}["\'])([^\'"\(\)]{1,4096})(["\']\s{0,2048}\)' .
                    '\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . gzinflate(str_rot13(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i]))) . '"',
                            $str
                        );
                    }
                    continue;
                }
                if ($c = preg_match_all(
                    '/(gzinflate\s{0,2048}\(\s{0,2048}["\'])(.{1,4096})(,[0-' .
                    '9])?(["\']\s{0,2048}\))/i',
                    $str,
                    $matches
                )) {
                    for ($i = 0; $c > $i; $i++) {
                        $str = str_ireplace(
                            $matches[0][$i],
                            '"' . gzinflate(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[4][$i])) . '"',
                            $str
                        );
                    }
                continue;
                }
            }
            if ($c = preg_match_all(
                '/(str_rot13\s{0,2048}\(\s{0,2048}base64_decode\s{0,2048}\(' .
                '\s{0,2048}["\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Z' .
                'a-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)(["\']\s{0,2048}\)\s{0,2' .
                '048}\))/i',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . str_rot13(base64_decode(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[4][$i]))) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(base64_decode\s{0,2048}\(\s{0,2048}str_rot13\s{0,2048}\(' .
                '\s{0,2048}["\'])([^\'"\(\)]{1,4096})(["\']\s{0,2048}\)\s{0,' .
                '2048}\))/i',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . base64_decode(str_rot13(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i]))) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(base64_decode|decode_base64|base64\.b64decode|atob|Base64' .
                '\.decode64)(\s{0,2048}\(\s{0,2048}["\'\`])([A-Za-z0-9+\/]{4' .
                '})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}=' .
                '=)(["\'\`]\s{0,2048}\))/i',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . base64_decode(substrbl(substraf($matches[0][$i], $matches[1][$i] . $matches[2][$i]), $matches[5][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(str_rot13\s{0,2048}\(\s{0,2048}["\'])([^\'"\(\)]{1,4096})' .
                '(["\']\s{0,2048}\))/i',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . str_rot13(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/(hex2bin\s{0,2048}\(\s{0,2048}["\'])([a-fA-F0-9]{1,4096})(' .
                '["\']\s{0,2048}\))/i',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_ireplace(
                        $matches[0][$i],
                        '"' . hex2bin(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"',
                        $str
                    );
                }
                continue;
            }
            if ($c = preg_match_all(
                '/([Uu][Nn][Pp][Aa][Cc][Kk]\s{0,2048}\(\s{0,2048}["\']\s{0,2' .
                '048}H\*\s{0,2048}["\']\s{0,2048},\s{0,2048}["\'])([a-fA-F0-' .
                '9]{1,4096})(["\']\s{0,2048}\))/',
                $str,
                $matches
            )) {
                for ($i = 0; $c > $i; $i++) {
                    $str = str_replace($matches[0][$i], '"' . hex2bin(substrbl(substraf($matches[0][$i], $matches[1][$i]), $matches[3][$i])) . '"', $str);
                }
                continue;
            }
            break;
        }
    }
    $str = preg_replace('/[^\x21-\x7e]/', '', strtolower(prescan_decode($str . $ostr)));
    $ostr = false;
    if ($html) {
        $str = preg_replace(array(
            '@<script[^>]*?>.*?</script>@si',
            '@<[\/\!]*?[^<>]*?>@si',
            '@<style[^>]*?>.*?</style>@siU',
            '@<![\s\S]*?--[ \t\n\r]*>@'
        ), '', $str);
    }
    return trim($str);
}

/**
 * This function looks for XML/XDP chunks in the input string, attempts to
 * them, and, if an MD5 hash is supplied to the function (optionally used as an
 * index key for storing additional information about the chunks), the function
 * will construct a record similar to the MD5 signatures of phpMussel, which
 * phpMussel will later use to check those chunks against its MD5 signatures
 * (if this scanning option is enabled). The function will then return the
 * decoded chunks (as a single, merged string) back to the calling scope. If
 * the `$pdf` option is enabled, the original input string, normalised, but
 * non-decoded, will be appended to the beginning of the decoded chunk data to
 * be returned to the calling scope. This data is used by phpMussel in multiple
 * contexts.
 *
 * @param string $str The input string to be checked (generally, the raw binary
 *      data of the files being scanned by phpMussel).
 * @param string $md5 An MD5 hash, optionally used as an index key for storing
 *      additional information about the XML/XDP chunks.
 * @param bool $pdf When set to true, the original input string, normalised,
 *      but non-decoded, will be appended to the beginning of the decoded chunk
 *      data to be returned to the calling scope. This option/parameter should
 *      be true when checking PDF file data, but otherwise should be false.
 * @return string The decoded XML/XDP chunk data to be returned to the calling
 *      scope.
 */
function prescan_xmlxdp($str, $md5 = '', $pdf = false) {
    global $phpMussel;
    if ($md5) {
        if (!isset($phpMussel['memCache']['xmlxdp'])) {
            $phpMussel['memCache']['xmlxdp'] = array();
        }
        if (!isset($phpMussel['memCache']['xmlxdp'][$md5])) {
            $phpMussel['memCache']['xmlxdp'][$md5] = array();
        }
    }
    $nstr = preg_replace('/[^\x21-\x7e]/', '', prescan_decode($str));
    $chunks = $chunki = '';
    $i = 0;
    while (preg_match_all('/<chunk>(.+)<\/chunk>/i', $nstr, $matches)) {
        $c = count($matches[0]);
        for ($im = 0; $c > $im; $im++) {
            if ($chunki = @base64_decode($matches[1][$im])) {
                $nstr = @str_replace($matches[0][$im], '', $nstr);
                $chunks .= $chunki;
                if ($md5) {
                    $phpMussel['memCache']['xmlxdp'][$md5][$i] = md5($chunki) . ':' . strlen($chunki) . ':';
                    $i++;
                }
            }
        }
    }
    if ($pdf) {
        $chunks = $nstr . $chunks;
    }
    return $chunks;
}

if (!function_exists('substrbf')) {
    /**
     * Gets substring from haystack prior to the first occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substrbf($h, $n) {
        return @substr($h, 0, strpos($h, $n));
    }
}

if (!function_exists('substraf')) {
    /**
     * Gets substring from haystack after the first occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substraf($h, $n) {
        return @substr($h, strpos($h, $n) + strlen($n));
    }
}

if (!function_exists('substrbl')) {
    /**
     * Gets substring from haystack prior to the last occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substrbl($h, $n) {
        return @substr($h, 0, strrpos($h, $n));
    }
}

if (!function_exists('substral')) {
    /**
     * Gets substring from haystack after the last occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substral($h, $n) {
        return @substr($h, strrpos($h, $n) + strlen($n));
    }
}

/**
 * This function reads files and returns the contents of those files.
 *
 * @param string $f Path and filename of the file to read.
 * @param int $s Number of 48KB blocks to read from the file (optional; can be
 *      manually specified, but, it's best to just ignore it and let the
 *      function work it out for itself).
 * @param bool $c If false, perform basic safety check prior to reading the
 *      file (check if the file exists); If true, skip check (optional;
 *      defaults to false).
 * @return string|bool Content of the file returned by the function (or false
 *      on failure).
 */
function phpMusselFile($f, $s = 0, $c = false) {
    if (!$c) {
        if (!is_file($f)) {
            return false;
        }
    }
    if (!$s) {
        $s = @ceil(filesize($f) / 49152);
    }
    $d = '';
    if ($s > 0) {
        $fh = fopen($f, 'rb');
        $r = 0;
        while ($r < $s) {
            $d .= fread($fh, 49152);
            $r++;
        }
    fclose($fh);
    }
    return (!empty($d)) ? $d : false;
}

/**
 * Deletes expired cache entries and regenerates cache files.
 */
function phpMusselCacheClean() {
    global $phpMussel;
    if (isset($phpMussel['memCache']['CacheCleaned']) && $phpMussel['memCache']['CacheCleaned']) {
        return true;
    }
    $phpMussel['memCache']['CacheCleaned'] = true;
    $CacheFiles = array();
    $f = $phpMussel['vault'] . 'cache/index.dat';
    $fdata_old = $fdata = phpMusselFile($f);
    if (substr_count($fdata, ';')) {
        $fdata = explode(';', $fdata);
        $c = count($fdata);
        for ($i = 0; $i < $c; $i++) {
            if (substr_count($fdata[$i], ':')) {
                $fdata[$i] = explode(':', $fdata[$i], 3);
                if ($phpMussel['time'] > $fdata[$i][1]) {
                    $xf = bin2hex(substr($fdata[$i][0], 0, 1));
                    if (!isset($CacheFiles[$xf])) {
                        $CacheFiles[$xf] =
                            (!file_exists($phpMussel['cachePath'] . $xf . '.tmp')) ?
                            '' :
                            phpMusselFile($phpMussel['cachePath'] . $xf . '.tmp', 0, true);
                    }
                    while (substr_count($CacheFiles[$xf], $fdata[$i][0] . ':')) {
                        $CacheFiles[$xf] = str_ireplace(
                            $fdata[$i][0] . ':' . substrbf(substraf($CacheFiles[$xf], $fdata[$i][0] . ':'), ';') . ';',
                            '',
                            $CacheFiles[$xf]
                        );
                    }
                    $fdata[$i] = '';
                } else {
                    $fdata[$i] = $fdata[$i][0] . ':' . $fdata[$i][1];
                }
            } else {
                $fdata[$i] = '';
            }
        }
        $fdata = implode(';', $fdata) . ';';
        $fdata = str_ireplace(';;', ';', $fdata);
        if ($fdata_old !== $fdata) {
            $fh = fopen($f, 'w');
            fwrite($fh, $fdata);
            fclose($fh);
        }
    }
    reset($CacheFiles);
    $c = count($CacheFiles);
    for ($i = 0; $i < $c; $i++) {
        $k = key($CacheFiles);
        if (strlen($CacheFiles[$k]) < 2) {
            if (file_exists($phpMussel['cachePath'] . $k . '.tmp')) {
                @unlink($phpMussel['cachePath'] . $k . '.tmp');
            }
        } else {
            $fh = fopen($phpMussel['cachePath'] . $k . '.tmp', 'w');
            fwrite($fh, $CacheFiles[$k]);
            fclose($fh);
        }
        next($CacheFiles);
    }
    return true;
}

/**
 * Retrieves cache entries.
 *
 * @param string|array $entry The name of the cache entry (or entries) to
 *      retrieve (can be a string to specify a single entry, or an array of
 *      strings to specify multiple entries).
 * @return string|array Contents of the cache entry (or entries).
 */
function phpMusselCacheGet($entry = '') {
    $x = phpMusselCacheClean();
    if (!$entry) {
        return '';
    }
    if (is_array($entry)) {
        reset($entry);
        $c = count($entry);
        for ($out = array(), $i = 0; $i < $c; $i++) {
            $k = key($entry);
            $out[$k] = phpMusselCacheGet($entry[$k]);
            next($entry);
        }
        return $out;
    }
    global $phpMussel;
    $f = $phpMussel['cachePath'] . bin2hex($entry[0]) . '.tmp';
    if (!file_exists($f)) {
        return '';
    }
    if (!$d = phpMusselFile($f, 0, true)) {
        return '';
    }
    $item =
        (substr_count($d, $entry . ':')) ?
        $entry . ':' . substrbf(substraf($d, $entry . ':'), ';') . ';' :
        '';
    if (!$item) {
        return '';
    }
    $item_ex = substrbf(substraf($item, $entry . ':'), ':');
    if ($phpMussel['time'] > $item_ex) {
        while (substr_count($d, $entry . ':')) {
            $d = str_ireplace($item, '', $d);
        }
        $fh = fopen($f, 'w');
        fwrite($fh, $d);
        fclose($fh);
        return '';
    }
    $item_data = substrbf(substraf($item, $entry . ':' . $item_ex . ':'), ';');
    if (!$item_data) {
        return '';
    }
    $item_data = @gzinflate(hex2bin(substrbf(substraf($d, $item_ex . ':'), ';')));
    return (!$item_data) ? '' : $item_data;
}

/**
 * Creates cache entry and saves it to the cache.
 *
 * @param string $entry The name of the cache entry to create.
 * @param int $item_ex The time (in unix time) after which the cache entry
 *      should expire.
 * @param string $item_data Contents of the cache entry.
 * @return bool This should always return true, unless something goes wrong.
 */
function phpMusselCacheSet($entry = '', $item_ex = 0, $item_data = '') {
    $x = phpMusselCacheClean();
    if (!$entry || !$item_data) {
        return false;
    }
    global $phpMussel;
    if (!$item_ex) {
        $item_ex = $phpMussel['time'];
    }
    $f = $phpMussel['cachePath'] . bin2hex($entry[0]) . '.tmp';
    $d = (!file_exists($f)) ? '' : phpMusselFile($f, 0, true);
    while (substr_count($d, $entry . ':')) {
        $d = str_ireplace($entry . ':' . substrbf(substraf($d, $entry . ':'), ';') . ';', '', $d);
    }
    $d .= $entry . ':' . $item_ex . ':' . bin2hex(gzdeflate($item_data,9)) . ';';
    $fh = fopen($f, 'w');
    fwrite($fh, $d);
    fclose($fh);
    $idxf = $phpMussel['vault'] . 'cache/index.dat';
    $idxnd = $idxd = (!file_exists($idxf)) ? '' : phpMusselFile($idxf, 0, true);
    while (substr_count($idxnd, $entry . ':')) {
        $idxnd = str_ireplace($entry . ':' . substrbf(substraf($idxnd, $entry . ':'), ';') . ';', '', $idxnd);
    }
    $idxnd .= $entry . ':' . $item_ex . ';';
    if ($idxnd !== $idxd) {
        $idxfh = fopen($idxf, 'w');
        fwrite($idxfh, $idxnd);
        fclose($idxfh);
    }
    return true;
}

/**
 * This function quarantines file uploads.
 *
 * The function uses a key generated from your quarantine key to bitshift the
 * input string, appending a header with an explanation of what the bitshifted
 * data is along with an MD5 hash checksum of the original unquarantined input
 * string to it, and then saves it all to a QFU file, storing these QFU files
 * in your quarantine directory. This isn't hardcore encryption, but it should
 * be sufficient to prevent accidental execution of quarantined files and to
 * allow safe handling of those files, which is the whole point of quarantining
 * them in the first place, and so, should be sufficient. Improvements may be
 * made in the future.
 *
 * @param string $s The input string to be quarantined (usually derived from
 *      malicious files).
 * @param string $key Your quarantine key.
 * @param string $ip Original source of the input string (usually, the IP
 *      address of the uploader of the malicious file).
 * @param string $id Name of the QFU file to save the quarantined input string
 *      into (in the context that this function is used, this is a unique
 *      identifier calculated prior to calling the function).
 * @return bool This should always return true, unless something goes wrong.
 */
function phpMusselQ($s, $key, $ip, $id) {
    if (!$s || !$key || !$ip || !$id || !function_exists('gzdeflate')) {
        return false;
    }
    if (
        strlen($key) < 128 &&
        !$key = @hex2bin(hash('sha512', $key) . hash('whirlpool', $key))
    ) {
        return false;
    }
    global $phpMussel;
    $h = "\xa1phpMussel\x21" . hex2bin(md5($s)) . pack('l*', strlen($s)) . "\x01";
    $s = gzdeflate($s, 9);
    $o = '';
    $i = 0;
    $c = strlen($s);
    $k = strlen($key);
    while ($i < $c) {
        for ($j = 0; $j < $k; $j++, $i++) {
            $o .= @$s{$i} ^ $key{$j};
        }
    }
    $o =
        "\x2f\x3d\x3d\x20phpMussel\x20Quarantined\x20File\x20Upload\x20\x3d" .
        "\x3d\x5c\n\x7c\x20Time\x2fDate\x20Uploaded\x3a\x20" .
        str_pad($phpMussel['time'], 18, "\x20") .
        "\x7c\n\x7c\x20Uploaded\x20From\x3a\x20" . str_pad($ip, 22, "\x20") .
        "\x20\x7c\n\x5c" . str_repeat("\x3d", 39) . "\x2f\n\n\n" . $h . $o;
    $u = phpMusselMemUse($phpMussel['qfuPath']);
    $u = $u['s'] + strlen($o);
    if ($u > ($phpMussel['Config']['general']['quarantine_max_usage'] * 1024)) {
        $u = phpMusselMemUse(
            $phpMussel['qfuPath'],
            $u - ($phpMussel['Config']['general']['quarantine_max_usage']*1024)
        );
    }
    $xf = fopen($phpMussel['qfuPath'] . $id . '.qfu', 'a');
    fwrite($xf, $o);
    fclose($xf);
    return true;
}

/**
 * Calculates the memory usage of a directory, and optionally, enforces a
 * limitation upon the memory usage of that directory by way of deleting the
 * contents of that directory until a specified quota of bytes to be deleted
 * has been met.
 *
 * This function is recursive, and will check (and/or delete from) the
 * specified directory and all subdirectories that it contains; It should be
 * regarded as a subfunction of the quarantine functionality, used by the
 * quarantine functionality to enforce the quarantine memory usage limit.
 *
 * @param string $p The path and name of the directory to be checked.
 * @param int $d A quota for how many bytes should be deleted from the target
 *      directory when the function is executed (omitting this parameter, or
 *      setting it to zero or less, will prevent the deletion of any files).
 * @return array The function will return an array containing four elements,
 *      all integers: `s` is the actual total memory usage of the target
 *      directory, `c` is a count of the total number of objects (files and
 *      subdirectories) detected within the target directory, `dc` is a count
 *      only of the total number of subdirectories detected within the target
 *      directory, and `d` is how much remaining quota there is to be met by
 *      the time the function has finished executing (usually, should be zero
 *      or less).
 */
function phpMusselMemUse($p, $d = 0) {
    $t = array('s' => 0, 'c' => 0, 'dc' => 0, 'd' => $d);
    if (is_dir($p) && $h = @opendir($p)) {
        while (false !== ($f = readdir($h))) {
            if ($f !== '.' && $f !== '..' && !is_link($np = $p . '/' . $f)) {
                if (is_dir($np)) {
                    $t['dc']++;
                    $r = phpMusselMemUse($np, $t['d']);
                    $t['s'] += $r['s'];
                    $t['c'] += $r['c'];
                    $t['dc'] += $r['dc'];
                    $t['d'] -= $r['d'];
                } elseif (is_file($np)) {
                    $ns = filesize($np);
                    if ($t['d'] > 0 && substr_count($np . "\x01", ".qfu\x01") > 0) {
                        @unlink($np);
                        $t['d'] -= $ns;
                    } else {
                        $t['s'] += $ns;
                        $t['c']++;
                    }
                }
            }
        }
    closedir($h);
    return $t;
    }
}

if (!function_exists('scandir')) {
    /**
     * A fallback function for `scandir()` (scans a directory specified by the
     * input and returns a list of its contents as an array).
     *
     * Note: The second and third parameters available to PHP's in-built
     * `scandir()` function don't have equivalents in our fallback function,
     * because phpMussel doesn't require them. As with all our fallback
     * functions, however, we always prefer to use PHP's in-built functions,
     * whenever possible, but will use our fallback functions whenever PHP's
     * in-built functions aren't available (such as for older version of PHP).
     *
     * @deprecated PHP's in-built `scandir()` function was introduced with
     *      PHP 5.0.0, and the minimum version of PHP required by phpMussel
     *      according to our "composer.json" file is PHP 5.4.0, and therefore,
     *      this fallback should already no longer be in use. We are marking
     *      this fallback as deprecated, and it will be it removed as part of
     *      the next major version release of phpMussel (1.0.0).
     * @param string $r The directory to scan.
     * @return array A list of the contents of the directory specified,
     *      returned as a numeric array.
     */
    function scandir($r) {
        if (!is_dir($r)) {
            return false;
        }
        $d = array();
        $i = 0;
        if ($h = @opendir($r)) {
            while (false !== ($f = readdir($h))) {
                if ($f !== '.' && $f !== '..' && !is_link($np = $p . '/' . $f)) {
                    $d[$i] = $np;
                    $i++;
                }
            }
        }
        closedir($h);
        return $d;
    }
}

/**
 * Checks if $needle (string) matches (is equal or identical to) $haystack
 * (string), or a specific substring of $haystack, to within a specific
 * threshold of the levenshtein distance between the $needle and the $haystack
 * or the $haystack substring specified.
 *
 * This function is useful for expressing the differences between two strings
 * as an integer value and for then determining whether a specific value as per
 * those differences is met.
 *
 * @param string $needle The needle (will be matched against the $haystack, or,
 *      if substring positions are specified, against the $haystack substring
 *      specified).
 * @param string $haystack The haystack (will be matched against the $needle).
 *      Note that for the purposes of calculating the levenshtein distance, it
 *      doesn't matter which string is a $needle and which is a $haystack (the
 *      value should be the same if the two were reversed). However, when
 *      specifying substring positions, those substring positions are applied
 *      to the $haystack, and not the $needle. Note, too, that if the $needle
 *      length is greater than the $haystack length (after having applied the
 *      substring positions to the $haystack), $needle and $haystack will be
 *      switched.
 * @param int $pos_A The initial position of the $haystack to use for the
 *      substring, if using a substring (optional; defaults to `0`; `0` is the
 *      beginning of the $haystack).
 * @param int $pos_Z The final position of the $haystack to use for the
 *      substring, if using a substring (optional; defaults to `0`; `0` will
 *      instruct the function to continue to the end of the $haystack, and
 *      thus, if both $pos_A and $pos_Z are `0`, the entire $haystack will be
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
function lv_match($needle, $haystack, $pos_A = 0, $pos_Z = 0, $min = 0, $max = -1, $bool = true, $case = false, $cost_ins = 1, $cost_rep = 1, $cost_del = 1) {
    if (!function_exists('levenshtein') || is_array($needle) || is_array($haystack)) {
        return false;
    }
    $nlen = strlen($needle);
    $pos_A = (int)$pos_A;
    $pos_Z = (int)$pos_Z;
    $min = (int)$min;
    $max = (int)$max;
    if ($pos_A !== 0 || $pos_Z !== 0) {
        $haystack =
            ($pos_Z === 0) ?
            substr($haystack, $pos_A) :
            substr($haystack, $pos_A, $pos_Z);
    }
    $hlen = strlen($haystack);
    if ($nlen < 1 || $hlen < 1) {
        return ($bool) ? false : 0;
    }
    if ($nlen > $hlen) {
        $x = array($needle, $nlen, $haystack, $hlen);
        $haystack = $x[0];
        $hlen = $x[1];
        $needle = $x[2];
        $nlen = $x[3];
    }
    if ($cost_ins === 1 && $cost_rep === 1 && $cost_del === 1) {
        $lv =
            ($case) ?
            levenshtein($haystack, $needle) :
            levenshtein(strtolower($haystack), strtolower($needle));
    } else {
        $lv =
            ($case) ?
            levenshtein($haystack, $needle, $cost_ins, $cost_rep, $cost_del) :
            levenshtein(strtolower($haystack), strtolower($needle), $cost_ins, $cost_rep, $cost_del);
    }
    if ($bool) {
        return (($min === 0 || $lv >= $min) && ($max === -1 || $lv <= $max)) ? true : false;
    }
    return $lv;
}

/**
 * Splits the nibbles of a single byte/character.
 *
 * @param string $n A byte/character to split.
 * @return array Returns an array containing two elements, both integers; The
 *      first, a decimal representation of the high nibble of the input
 *      byte/character, and the second, a decimal representation of the low
 *      nibble of the input byte/character.
 */
function split_nibble($n) {
    $n = bin2hex($n);
    $h = hexdec(isset($n[0]) ? $n[0] : '0');
    $l = hexdec(isset($n[1]) ? $n[1] : '0');
    return array($h, $l);
}

/**
 * Explodes a byte/character or string into an array containing elements
 * representing the individual bits constituting the byte/character or string.
 * Each element is a bool, with "false" representing "0" (or "off") and "true"
 * representing "1" (or "on"). `explode_bits()` is the reverse of
 * `implode_bits()`.
 *
 * @param string $n A byte/character or string to explode.
 * @return array Returns an array containing elements representing the
 *      individual bits constituting the byte/character or string.
 */
function explode_bits($n) {
    if (is_array($n)) {
        return '';
    }
    $c = strlen($n);
    for ($a = array(), $i = 0, $j = 0; $i < $c; $i++, $j += 8) {
        $a[$j] = (bool)(($n[$i] & "\x80") === "\x80");
        $a[$j+1] = (bool)(($n[$i] & "\x40") === "\x40");
        $a[$j+2] = (bool)(($n[$i] & "\x20") === "\x20");
        $a[$j+3] = (bool)(($n[$i] & "\x10") === "\x10");
        $a[$j+4] = (bool)(($n[$i] & "\x08") === "\x08");
        $a[$j+5] = (bool)(($n[$i] & "\x04") === "\x04");
        $a[$j+6] = (bool)(($n[$i] & "\x02") === "\x02");
        $a[$j+7] = (bool)(($n[$i] & "\x01") === "\x01");
    }
    return $a;
}

/**
 * Implodes an array of bits into a byte/character or string reconstituted from
 * those bits. Each element is a bool, with "false" representing "0" (or "off")
 * and "true" representing "1" (or "on"). `implode_bits()` is the reverse of
 * `explode_bits()`.
 *
 * @param array $n An array of bits to implode.
 * @return string Returns a string reconstituted from the input array.
 */
function implode_bits($n) {
    if (!is_array($n)) {
        return '';
    }
    $c = count($n);
    for ($x = '', $i = 0; $i < $c; $i += 8) {
        $a = "\xff";
        if ($n[$i]) {
            $a = $a ^ "\x80";
        }
        if ($n[$i + 1]) {
            $a = $a ^ "\x40";
        }
        if ($n[$i + 2]) {
            $a = $a ^ "\x20";
        }
        if ($n[$i + 3]) {
            $a = $a ^ "\x10";
        }
        if ($n[$i + 4]) {
            $a = $a ^ "\x08";
        }
        if ($n[$i + 5]) {
            $a = $a ^ "\x04";
        }
        if ($n[$i + 6]) {
            $a = $a ^ "\x02";
        }
        if ($n[$i + 7]) {
            $a = $a ^ "\x01";
        }
        $x .= ~$a;
    }
    return $x;
}

/**
 * Translates the virus name/identifier shorthand adopted by phpMussel to
 * proper virus names/identifiers and makes some determinations regarding
 * detections based upon the interpretation and understanding of that shorthand
 * against the phpMussel configuration (for example, whether some certain
 * classifications, such as hoax/joke viruses, adware, etc, should be entirely
 * ignored by the scanner, or should be identified as malicious, and therefore
 * blocked).
 *
 * Originally, this function was created to allow a way for phpMussel to
 * partially compress its signatures without jeopardising speed, performance or
 * processing efficiency, because, by allowing phpMussel to partially compress
 * its signatures, the total footprint of its signature files could be reduced,
 * therefore allowing the inclusion of a greater number of signatures in the
 * signature files without causing an excessive bloat in the total footprint.
 *
 * However, since then, its purpose has expanded, to determining whether a
 * signature should be considered a weighted signature (for more complex
 * detections involving multiple signatures) or a non-weighted signature (for
 * signatures that are detections in their own right, not requiring additional
 * signatures for the detection to occur), and to determining whether or not a
 * signature should be ignored, based upon its classification.
 *
 * The function takes an input string (the shorthand virus name), and if byte 0
 * of the input string is "\x1A" (the substitute character), the input string
 * is a shorthand virus name, and processing continues; If it doesn't begin
 * with "\x1A", it isn't a shorthand virus name, and the input string should be
 * returned to the calling scope unmodified. When processing continues, the
 * function splits the nibbles of bytes 1-2, and uses that information to
 * reconstruct a complete virus name from the shorthand virus name; 1H
 * represents the signature vendor name and 1L optionally provides some
 * additional generic indicators (heuristic, CVE, etc), except when 1H == 8 (in
 * which case, 1L represents the signature vendor name, 1H == 8 being used to
 * access that additional set of allocations), 2H+2L represents the virus
 * target (ie, the file format or system that the virus that the signature is
 * intended to detect is intended to be targeting), and 3H+3L represents the
 * nature of what the signature is intended to detect (ie, whether we should
 * call it a virus, a trojan, adware, ransomware, etc).
 *
 * Warning: When modifying these allocations (such as to include a new vendor
 * or a new type of detection), be very careful to ensure that your choice of
 * allocations won't conflict with the what phpMussel recognises as its
 * delimiters or as special characters (newlines, semicolons, colons, etc), or
 * else your signature files could break very badly, leading either to a
 * failure to properly detect anything or to numerous severe false positives.
 * Generally (but not exclusively), you should avoid: "\x0?" (or any ?H0
 * character/byte), \x3A and \x3B. Also avoid using the null character ("\x00")
 * in particular, because it can severely break things in certain situations.
 *
 * @param string $vn The shorthand virus name.
 * @return string The full-length "translated" virus name.
 */
function vn_shorthand($vn) {
    global $phpMussel;
    $phpMussel['memCache']['weighted'] = false;
    $phpMussel['memCache']['ignoreme'] = false;
    if ($vn[0] !== "\x1a") {
        return $vn;
    }
    $n = split_nibble($vn[1]);
    $out = '';
    if ($n[0] === 2) {
        $out .= 'ClamAV-';
    } elseif ($n[0] === 3) {
        $out .= 'phpMussel-';
    } elseif ($n[0] === 4) {
        $out .= 'SecuriteInfo-';
    } elseif ($n[0] === 5) {
        $out .= 'ZBB-';
    } elseif ($n[0] === 6) {
        $out .= 'NLNetLabs-';
    } elseif ($n[0] === 7) {
        $out .= 'FoxIT-';
    } elseif ($n[0] === 8) {
        if ($n[1] === 0) {
            $out .= 'PhishTank-';
        } elseif ($n[1] === 1) {
            $out .= 'Malc0de-';
        } elseif ($n[1] === 2) {
            $out .= 'hpHosts-';
        } elseif ($n[1] === 3) {
            $out .= 'Spam404-';
        } elseif ($n[1] === 4) {
            $out .= 'Cybercrime.Tracker-';
        }
    } elseif ($n[0] === 9) {
        $phpMussel['memCache']['weighted'] = true;
        $out .= 'phpMussel-';
    } elseif ($n[0] === 15) {
        $phpMussel['memCache']['weighted'] = true;
    }
    if ($n[0] !== 8) {
        if ($n[1] === 1) {
            $out .= 'Testfile.';
        } elseif ($n[1] === 2) {
            $out .= 'FN.';
        } elseif ($n[1] === 3) {
            $out .= 'VT.';
        } elseif ($n[1] === 4) {
            $out .= 'META.';
        } elseif ($n[1] === 5) {
            $out .= 'Chameleon.';
        } elseif ($n[1] === 6) {
            $out .= 'Werewolf.';
        } elseif ($n[1] === 7) {
            $out .= 'Suspect.';
        } elseif ($n[1] === 8) {
            $out .= 'Fake.';
        } elseif ($n[1] === 9) {
            $out .= 'CVE.';
        } elseif ($n[1] === 15) {
            $out .= 'HEUR.';
        }
    }
    $n = split_nibble($vn[2]);
    if ($n[0] === 1) {
        if ($n[1] === 1) {
            $out .= 'Win.';
        } elseif ($n[1] === 2) {
            $out .= 'W32.';
        } elseif ($n[1] === 3) {
            $out .= 'W64.';
        } elseif ($n[1] === 4) {
            $out .= 'ELF.';
        } elseif ($n[1] === 5) {
            $out .= 'OSX.';
        } elseif ($n[1] === 6) {
            $out .= 'Android.';
        } elseif ($n[1] === 7) {
            $out .= 'Email.';
        } elseif ($n[1] === 8) {
            $out .= 'JS.';
        } elseif ($n[1] === 9) {
            $out .= 'Java.';
        } elseif ($n[1] === 10) {
            $out .= 'XXE.';
        } elseif ($n[1] === 11) {
            $out .= 'Graphics.';
        } elseif ($n[1] === 12) {
            $out .= 'OLE.';
        } elseif ($n[1] === 13) {
            $out .= 'HTML.';
        } elseif ($n[1] === 14) {
            $out .= 'RTF.';
        } elseif ($n[1] === 15) {
            $out .= 'Archive.';
        }
    } elseif ($n[0] === 2) {
        if ($n[1] === 0) {
            $out .= 'PHP.';
        } elseif ($n[1] === 1) {
            $out .= 'XML.';
        } elseif ($n[1] === 2) {
            $out .= 'ASP.';
        } elseif ($n[1] === 3) {
            $out .= 'VBS.';
        } elseif ($n[1] === 4) {
            $out .= 'BAT.';
        } elseif ($n[1] === 5) {
            $out .= 'PDF.';
        } elseif ($n[1] === 6) {
            $out .= 'SWF.';
        } elseif ($n[1] === 7) {
            $out .= 'W97M.';
        } elseif ($n[1] === 8) {
            $out .= 'X97M.';
        } elseif ($n[1] === 9) {
            $out .= 'O97M.';
        } elseif ($n[1] === 10) {
            $out .= 'ASCII.';
        } elseif ($n[1] === 11) {
            $out .= 'Unix.';
        } elseif ($n[1] === 12) {
            $out .= 'Python.';
        } elseif ($n[1] === 13) {
            $out .= 'Perl.';
        } elseif ($n[1] === 14) {
            $out .= 'Ruby.';
        } elseif ($n[1] === 15) {
            $out .= 'INF/INI.';
        }
    } elseif ($n[0] === 3) {
        if ($n[1] === 0) {
            $out .= 'CGI.';
        }
    }
    $n = split_nibble($vn[3]);
    if ($n[0] === 1) {
        if ($n[1] === 1) {
            $out .= 'Worm.';
        } elseif ($n[1] === 2) {
            $out .= 'Trojan.';
        } elseif ($n[1] === 3) {
            $out .= 'Adware.';
            if (!$phpMussel['Config']['signatures']['detect_adware']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 4) {
            $out .= 'Flooder.';
        } elseif ($n[1] === 5) {
            $out .= 'IRCBot.';
        } elseif ($n[1] === 6) {
            $out .= 'Exploit.';
        } elseif ($n[1] === 7) {
            $out .= 'VirTool.';
        } elseif ($n[1] === 8) {
            $out .= 'Dialer.';
        } elseif ($n[1] === 9) {
            $out .= 'Joke/Hoax.';
            if (!$phpMussel['Config']['signatures']['detect_joke_hoax']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 11) {
            $out .= 'Malware.';
        } elseif ($n[1] === 12) {
            $out .= 'Riskware.';
        } elseif ($n[1] === 13) {
            $out .= 'Rootkit.';
        } elseif ($n[1] === 14) {
            $out .= 'Backdoor.';
        } elseif ($n[1] === 15) {
            $out .= 'Hacktool.';
        }
    } elseif ($n[0] === 2) {
        if ($n[1] === 0) {
            $out .= 'Keylogger.';
        } elseif ($n[1] === 1) {
            $out .= 'Ransomware.';
        } elseif ($n[1] === 2) {
            $out .= 'Spyware.';
        } elseif ($n[1] === 3) {
            $out .= 'Virus.';
        } elseif ($n[1] === 4) {
            $out .= 'Dropper.';
        } elseif ($n[1] === 5) {
            $out .= 'Dropped.';
        } elseif ($n[1] === 6) {
            $out .= 'Downloader.';
        } elseif ($n[1] === 7) {
            $out .= 'Obfuscation.';
        } elseif ($n[1] === 8) {
            $out .= 'Obfuscator.';
        } elseif ($n[1] === 9) {
            $out .= 'Obfuscated.';
        } elseif ($n[1] === 10) {
            $out .= 'Packer.';
            if (!$phpMussel['Config']['signatures']['detect_packer_packed']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 11) {
            $out .= 'Packed.';
            if (!$phpMussel['Config']['signatures']['detect_packer_packed']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 12) {
            $out .= 'PUA/PUP.';
            if (!$phpMussel['Config']['signatures']['detect_pua_pup']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 13) {
            $out .= 'Shell.';
            if (!$phpMussel['Config']['signatures']['detect_shell']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 14) {
            $out .= 'Defacer.';
            if (!$phpMussel['Config']['signatures']['detect_deface']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        } elseif ($n[1] === 15) {
            $out .= 'Defacement.';
            if (!$phpMussel['Config']['signatures']['detect_deface']) {
                $phpMussel['memCache']['ignoreme'] = true;
            }
        }
    } elseif ($n[0] === 3) {
        if ($n[1] === 0) {
            $out .= 'Cryptor.';
        } elseif ($n[1] === 1) {
            $out .= 'Phish.';
        } elseif ($n[1] === 2) {
            $out .= 'Spam.';
        } elseif ($n[1] === 3) {
            $out .= 'Spammer.';
        } elseif ($n[1] === 4) {
            $out .= 'Scam.';
        } elseif ($n[1] === 5) {
            $out .= 'ZipBomb.';
        } elseif ($n[1] === 6) {
            $out .= 'ForkBomb.';
        } elseif ($n[1] === 7) {
            $out .= 'LogicBomb.';
        } elseif ($n[1] === 8) {
            $out .= 'CyberBomb.';
        } elseif ($n[1] === 9) {
            $out .= 'Malvertisement.';
        } elseif ($n[1] === 15) {
            $out .= 'BadURL.';
        }
    }
    return $out . substr($vn, 4);
}

/**
 * This function (`phpMusselD()`, or, the phpMussel data handler) is one of two
 * sub-functions of the core scanning function of phpMussel (`phpMussel()`).
 *
 * Whereas `phpMusselR()` handles metadata-based and non-signature-based
 * detections, and performs the preparations necessary for scanning files (such
 * as reading the contents of files prior to checking the contents of files
 * against anti-virus signatures), `phpMusselD()` is responsible for handling
 * that data after `phpMusselR()` has read it. `phpMusselD()` is called from
 * `phpMusselR()`, and should never be called in any other contexts or from
 * anywhere else; It takes the data given to it from the calling function,
 * processes it, and then checks it against the various signatures of
 * phpMussel, before returning the results of those checks back to the calling
 * function.
 *
 * @param string $str The raw binary data to be checked, supplied by the
 *      calling function (generally, the contents of files to being scanned).
 * @param bool $n Inherited from the calling function (`phpMusselR()`, which in
 *      turn inherits this parameter from its own calling function,
 *      `phpMussel()`), this optional parameter is a boolean (defaults to
 *      false, but set to true during the initial scan of file uploads),
 *      indicating the format that the scan results should be returned as.
 *      False instructs the function to return results as an integer; True
 *      instructs the function to return results as human readable text (refer
 *      to Section 3A of the README documentation, "HOW TO USE (FOR WEB
 *      SERVERS)", for more information).
 * @param int $dpt Represents the current depth of recursion from which the
 *      function has been called. `phpMusselD()` and `phpMusselR()` use this
 *      information for determining how much they should indent any entries
 *      they generate for logging and for the display of scan results in CLI.
 * @param string $ofn Represents the "original filename" of the file being
 *      scanned (the original filename, in this context, referring to the name
 *      of the file being scanned as per supplied by the upload client or CLI
 *      operator, as opposed to the temporary filename assigned by the server
 *      or any other filename).
 * @return int|string The scan results, as per described by the README
 *      documentation. The function may also die the script and return nothing,
 *      if something goes wrong, such as if the function is triggered in the
 *      absense of the required $phpMussel['memCache'] variable being set.
 */
function phpMusselD($str = '', $n = false, $dpt = 0, $ofn = '') {
    global $phpMussel;
    if (!isset($phpMussel['memCache'])) {
        echo
            (!isset($phpMussel['Config']['lang']['required_variables_not_defined'])) ?
            '[phpMussel] Required variables aren\'t defined: Can\'t continue.' :
            '[phpMussel] ' . $phpMussel['Config']['lang']['required_variables_not_defined'];
        die;
    }
    $flagged = false;
    $dpt++;
    for ($lnap = '', $i = 0; $i < ($dpt - 1); $i++) {
        $lnap .= '-';
    }
    $lnap .= '> ';
    $out = '';

    if (!$str_len = strlen($str)) {
        return 1;
    }

    $md5 = md5($str);
    $sha = sha1($str);
    $crc = @hash('crc32b', $str);
    $fourcc = strtolower(bin2hex(substr($str, 0, 4)));
    $twocc = substr($fourcc, 0, 4);
    $CoExMeta =
        '$ofn:' . $ofn . ';md5($ofn):' . md5($ofn) . ';$dpt:' . $dpt .
        ';$str_len:' . $str_len . ';$md5:' . $md5 . ';$sha:' . $sha .
        ';$crc:' . $crc . ';$fourcc:' . $fourcc . ';$twocc:' . $twocc . ';';
    $phpMussel['memCache']['weighted'] = false;

    $heur = array('detections' => 0, 'weight' => 0, 'cli' => '', 'web' => '');

    if (!$ofn) {
        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
        $phpMussel['memCache']['detections_count']++;
        $out .=
            $lnap . $phpMussel['Config']['lang']['scan_missing_filename'] .
            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
        $phpMussel['whyflagged'] .=
            $phpMussel['Config']['lang']['scan_missing_filename'] .
            $phpMussel['Config']['lang']['_exclamation'];
        return (!$n) ? 2 : $out;
    }
    $ofnSafe = urlencode($ofn);

    $phpMussel['HashCacheData'] = $md5 . md5($ofn);
    if (isset($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']])) {
        if (!$phpMussel['EOF']) {
            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
        }
        if (!empty($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][2])) {
            $phpMussel['memCache']['detections_count']++;
            $out .= hex2bin($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][2]);
        }
        if (!empty($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][3])) {
            $phpMussel['whyflagged'].=hex2bin($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][3]);
        }
        if (!$out) {
            return 1;
        }
        return (!$n) ? 2 : $out;
    }

    $climode = (
        strlen($phpMussel['Mussel_PHP']) &&
        $phpMussel['Mussel_OS'] == 'WIN' &&
        $phpMussel['Mussel_sapi'] == 'cli'
    ) ? 1 : 0;

    if (
        $phpMussel['Config']['attack_specific']['scannable_threshold'] > 0 &&
        $str_len > ($phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024)
    ) {
        $str_len = $phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024;
        $str = substr($str, 0, $str_len);
        $str_cut = 1;
    } else {
        $str_cut = 0;
    }

    $decode_or_not = (
        (
            $phpMussel['Config']['attack_specific']['decode_threshold'] > 0 &&
            $str_len > ($phpMussel['Config']['attack_specific']['decode_threshold'] * 1024)
        ) ||
        $str_len < 16
    ) ? 0 : 1;
    $len_kb = ($str_len > 1024) ? 1 : 0;
    $len_hmb = ($str_len > 524288) ? 1 : 0;
    $len_mb = ($str_len > 1048576) ? 1 : 0;
    $len_hgb = ($str_len > 536870912) ? 1 : 0;
    $phase = $phpMussel['memCache']['phase'];
    $container = $phpMussel['memCache']['container'];
    $pdf_magic = ($fourcc == '25504446');
    $xt = $xts = $gzxt = $gzxts = '-';
    $detect_adware = ($phpMussel['Config']['signatures']['detect_adware']) ? 1 : 0;
    $detect_joke_hoax = ($phpMussel['Config']['signatures']['detect_joke_hoax']) ? 1 : 0;
    $detect_pua_pup = ($phpMussel['Config']['signatures']['detect_pua_pup']) ? 1 : 0;
    $detect_packer_packed = ($phpMussel['Config']['signatures']['detect_packer_packed']) ? 1 : 0;
    $detect_shell = ($phpMussel['Config']['signatures']['detect_shell']) ? 1 : 0;
    $detect_deface = ($phpMussel['Config']['signatures']['detect_deface']) ? 1 : 0;
    if (substr_count($ofn, '.') > 0) {
        $xt = explode('.', strtolower($ofn));
        $xts = substr($xt[count($xt) - 1], 0, 3) . '*';
        $xt = $xt[count($xt) - 1];
        if (strlen($xt) < 1) {
            $xt = $xts = '-';
        }
    }
    if (substr_count($ofn, '.') > 1) {
        $gzxt = explode('.', str_replace('.gz', '', strtolower($ofn)));
        $gzxts = substr($gzxt[count($gzxt) - 1], 0, 3) . '*';
        $gzxt = strtolower($gzxt[count($gzxt) - 1]);
        if (strlen($gzxt) < 1) {
            $gzxt = $gzxts = '-';
        }
    }
    $CoExMeta .= '$xt:' . $xt . ';$xts:' . $xts . ';';

    /** Input ($str) as hexadecimal data. */
    $str_hex = bin2hex($str);
    $str_hex_len = $str_len * 2;

    /** Input ($str) normalised. */
    $str_norm = prescan_normalise($str, false, $decode_or_not);
    $str_norm_len = strlen($str_norm);

    /** Normalised input ($str_norm) as hexadecimal data. */
    $str_hex_norm = bin2hex($str_norm);
    $str_hex_norm_len = $str_norm_len * 2;

    /** Input ($str) normalised for HTML. */
    $str_html = prescan_normalise($str, true, $decode_or_not);
    $str_html_len = strlen($str_html);

    /** HTML normalised input ($str_html) as hexadecimal data. */
    $str_hex_html = bin2hex($str_html);
    $str_hex_html_len = $str_html_len * 2;

    /** Fetch XML/XDP data from input ($str). */
    $str_xmlxdp =
        ($decode_or_not && preg_match('/3c6368756e6b3e.{2,4096}3c2f6368756e6b3e/i', $str_hex_norm)) ?
        prescan_xmlxdp($str, $md5, $pdf_magic) :
        '';

    /** Generate new inputs from XML/XDP data. */
    if ($str_xmlxdp) {
        $str_xmlxdp_len = strlen($str_xmlxdp);
        if (
            $phpMussel['Config']['attack_specific']['scannable_threshold'] > 0 &&
            $str_xmlxdp_len > ($phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024)
        ) {
            $str_xmlxdp_len = $phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024;
            $str_xmlxdp = substr($str_xmlxdp, 0, $str_xmlxdp_len);
        }
        $str_xmlxdp_hex = bin2hex($str_xmlxdp);
        $str_xmlxdp_hex_len = $str_xmlxdp_len * 2;
        $str_xmlxdp_norm = prescan_normalise($str_xmlxdp, false, $decode_or_not);
        $str_xmlxdp_norm_len = strlen($str_xmlxdp_norm);
        $str_xmlxdp_hex_norm = bin2hex($str_xmlxdp_norm);
        $str_xmlxdp_hex_norm_len = $str_xmlxdp_norm_len * 2;
        $str_xmlxdp_html = prescan_normalise($str_xmlxdp, true, $decode_or_not);
        $str_xmlxdp_html_len = strlen($str_xmlxdp_html);
        $str_xmlxdp_hex_html = bin2hex($str_xmlxdp_html);
        $str_xmlxdp_hex_html_len = $str_xmlxdp_html_len * 2;
    } else {
        $str_xmlxdp_len = 0;
        $str_xmlxdp_hex = '';
        $str_xmlxdp_hex_len = 0;
        $str_xmlxdp_norm = '';
        $str_xmlxdp_norm_len = 0;
        $str_xmlxdp_hex_norm = '';
        $str_xmlxdp_hex_norm_len = 0;
        $str_xmlxdp_html = '';
        $str_xmlxdp_html_len = 0;
        $str_xmlxdp_hex_html = '';
        $str_xmlxdp_hex_html_len = 0;
    }

    /** Look for potential Linux/ELF indicators. */
    $is_elf = (
        $fourcc === '7f454c46' ||
        $xt === 'elf'
    );

    /** Look for potential graphics/image indicators. */
    $is_graphics = (
        substr_count(
            ',bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif' .
            ',jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,' .
            'png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,' .
            'wdp,webp,wmf,xbm,xbmp,xcf,xvl,',
        ',' . $xt . ',') ||
        $twocc === '424d' ||
        $fourcc === '25504446' ||
        $fourcc === '38425053' ||
        $fourcc === '57454250' ||
        $fourcc === '89504e47' ||
        substr($str, 0, 8) === 'gimp xcf' ||
        substr($str_hex, 0, 12) === '474946383761' ||
        substr($str_hex, 0, 12) === '474946383961' ||
        substr($str_hex, 0, 16) === '0000000c6a502020' ||
        substr($str_hex, 0, 6) === 'ffd8ff'
    );

    /** Look for potential HTML indicators. */
    $is_html = (
        substr_count(',asp*,dht*,hta,htm*,jsp*,php*,sht*,', ',' . $xts . ',') ||
        substr_count(',eml,hta,', ',' . $xt . ',') ||
        preg_match(
            '/3c(21646f6374797065|6120|626f6479|68656164|68746d6c|696672616d' .
            '65|696d67|6f626a656374|736372697074|7461626c65|7469746c65)/i',
            $str_hex_norm
        ) ||
        preg_match(
            '/3c(21646f6374797065|6120|626f6479|68656164|68746d6c|696672616d' .
            '65|696d67|6f626a656374|736372697074|7461626c65|7469746c65)/i',
            $str_xmlxdp_hex_norm
        ) ||
        preg_match(
            '/(626f6479|68656164|68746d6c|736372697074|7461626c65|7469746c65)3e/i',
            $str_hex_norm
        ) ||
        preg_match(
            '/(626f6479|68656164|68746d6c|736372697074|7461626c65|7469746c65)3e/i',
            $str_xmlxdp_hex_norm
        )
    );

    /** Look for potential Mach-O indicators. */
    $is_macho = (
        $fourcc === 'cafebabe' ||
        $fourcc === 'cafed00d' ||
        $fourcc === 'cefaedfe' ||
        $fourcc === 'cffaedfe' ||
        $fourcc === 'feedface' ||
        $fourcc === 'feedfacf'
    );

    /** Look for potential PDF indicators. */
    $is_pdf = (
        $pdf_magic ||
        $xt === 'pdf'
    );

    /** Look for potential Shockwave/SWF indicators. */
    $is_swf = (
        substr_count(',435753,465753,5a5753,', ',' . substr($str_hex, 0, 6) . ',') ||
        substr_count(',swf,swt,', ',' . $xt . ',')
    );

    /** "Infectable"? Used by ClamAV General and ClamAV ASCII signatures. */
    $infectable = true;

    /** "Asciiable"? Used by all ASCII signatures. */
    $asciiable = (bool)$str_hex_norm_len;

    /**
     * Attempt to confirm/guess whether the data being handled is from an OLE
     * file and whether we'll need to parse it through the OLE signatures.
     */
    $is_ole = (
        !empty($phpMussel['memCache']['file_is_ole']) && (
            $str_hex_len < 49152 ||
            substr_count(',ole,xml,rels,', ',' . $xt . ',')
        )
    );

    /** Worked by the switch file. */
    $fileswitch = 'unassigned';
    if (!isset($phpMussel['memCache']['switch.dat'])) {
        $phpMussel['memCache']['switch.dat'] = @file($phpMussel['sigPath'] . 'switch.dat');
    }
    if (!$phpMussel['memCache']['switch.dat']) {
        $phpMussel['memCache']['scan_errors']++;
        if (!$phpMussel['Config']['signatures']['fail_silently']) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
            }
            $phpMussel['whyflagged'] .=
                $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                ' (switch.dat)' . $phpMussel['Config']['lang']['_exclamation'];
            return (!$n) ? -3 :
                $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                ' (switch.dat)' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
        }
    }
    $c = count($phpMussel['memCache']['switch.dat']);
    for ($i = 0; $i < $c; $i++) {
        $xsig = $phpMussel['memCache']['switch.dat'][$i];
        if (
            strlen($xsig) < 8 ||
            !substr_count($xsig, "\n") ||
            !substr_count($xsig, ';') ||
            !substr_count($xsig, ':')
        ) {
            continue;
        }
        $Switch = @explode('=', preg_replace('/[^\x20-\xff]/', '', substral($xsig, ';')));
        if (!strlen($Switch[0])) {
            continue;
        }
        $theSwitch = $Switch[0];
        $xsig = @explode(';', substrbl($xsig, ';'));
        $sxc = count($xsig);
        if ($sxc > 0) {
            for ($sxi = 0; $sxi < $sxc; $sxi++) {
                $xsig[$sxi] = @explode(':', $xsig[$sxi], 7);
                if (!strlen($xsig[$sxi][0])) {
                    continue 2;
                }
                if ($xsig[$sxi][0] == 'LV') {
                    if (
                        !isset($xsig[$sxi][1]) ||
                        substr($xsig[$sxi][1], 0, 1) !== '$'
                    ) {
                        continue 2;
                    }
                    $lv_haystack = substr($xsig[$sxi][1],1);
                    if (
                        !isset($$lv_haystack) ||
                        is_array($$lv_haystack)
                    ) {
                        continue 2;
                    }
                    $lv_haystack = $$lv_haystack;
                    if ($climode) {
                        $lv_haystack = substral(substral($lv_haystack, "/"), "\\");
                    }
                    $lv_needle = (isset($xsig[$sxi][2])) ? $xsig[$sxi][2] : '';
                    $pos_A = (isset($xsig[$sxi][3])) ? $xsig[$sxi][3] : 0;
                    $pos_Z = (isset($xsig[$sxi][4])) ? $xsig[$sxi][4] : 0;
                    $lv_min = (isset($xsig[$sxi][5])) ? $xsig[$sxi][5] : 0;
                    $lv_max = (isset($xsig[$sxi][6])) ? $xsig[$sxi][6] : -1;
                    if (!lv_match($lv_needle, $lv_haystack, $pos_A, $pos_Z, $lv_min, $lv_max)) {
                        continue 2;
                    }
                } elseif (isset($xsig[$sxi][2])) {
                    if (isset($xsig[$sxi][3])) {
                        if ($xsig[$sxi][2] == 'A') {
                            if (
                                !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $xsig[$sxi][0] . ',') || (
                                    $xsig[$sxi][0] == 'FD' &&
                                    !substr_count("\x01" . substr($str_hex, 0, $xsig[$sxi][3] * 2), "\x01" . $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-RX' &&
                                    !preg_match('/\A' . $xsig[$sxi][1] . '/i', substr($str_hex, 0, $xsig[$sxi][3] * 2))
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM' &&
                                    !substr_count("\x01" . substr($str_hex_norm, 0, $xsig[$sxi][3] * 2), "\x01" . $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM-RX' &&
                                    !preg_match('/\A' . $xsig[$sxi][1] . '/i', substr($str_hex_norm, 0, $xsig[$sxi][3] * 2))
                                )
                            ) {
                                continue 2;
                            }
                        } else {
                            if (
                                !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $xsig[$sxi][0] . ',') || (
                                    $xsig[$sxi][0] == 'FD' &&
                                    !substr_count(substr($str_hex, $xsig[$sxi][2] * 2, $xsig[$sxi][3] * 2), $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-RX' &&
                                    !preg_match('/' . $xsig[$sxi][1] . '/i', substr($str_hex, $xsig[$sxi][2] * 2, $xsig[$sxi][3]*2))
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM' &&
                                    !substr_count(substr($str_hex_norm, $xsig[$sxi][2] * 2, $xsig[$sxi][3] * 2), $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM-RX' &&
                                    !preg_match('/' . $xsig[$sxi][1] . '/i', substr($str_hex_norm, $xsig[$sxi][2] * 2, $xsig[$sxi][3]*2))
                                )
                            ) {
                                continue 2;
                            }
                        }
                    } else {
                        if ($xsig[$sxi][2] == 'A') {
                            if (
                                !substr_count(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $xsig[$sxi][0] . ',') || (
                                    $xsig[$sxi][0] == 'FN' &&
                                    !preg_match('/\A' . $xsig[$sxi][1] . '/i', $ofn)
                                ) || (
                                    $xsig[$sxi][0] == 'FD' &&
                                    !substr_count("\x01" . $str_hex, "\x01" . $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-RX' &&
                                    !preg_match('/\A' . $xsig[$sxi][1] . '/i', $str_hex)
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM' &&
                                    !substr_count("\x01" . $str_hex_norm, "\x01" . $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM-RX' &&
                                    !preg_match('/\A' . $xsig[$sxi][1] . '/i', $str_hex_norm)
                                )
                            ) {
                                continue 2;
                            }
                        } else {
                            if (
                                !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $xsig[$sxi][0] . ',') || (
                                    $xsig[$sxi][0] == 'FD' &&
                                    !substr_count(substr($str_hex, $xsig[$sxi][2] * 2), $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-RX' &&
                                    !preg_match('/' . $xsig[$sxi][1] . '/i', substr($str_hex, $xsig[$sxi][2] * 2))
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM' &&
                                    !substr_count(substr($str_hex_norm, $xsig[$sxi][2] * 2), $xsig[$sxi][1])
                                ) || (
                                    $xsig[$sxi][0] == 'FD-NORM-RX' &&
                                    !preg_match('/' . $xsig[$sxi][1] . '/i', substr($str_hex_norm, $xsig[$sxi][2] * 2))
                                )
                            ) {
                                continue 2;
                            }
                        }
                    }
                } else {
                    if (
                        (
                            $xsig[$sxi][0] == 'FN' &&
                            !preg_match('/' . $xsig[$sxi][1] . '/i', $ofn)
                        ) || (
                            $xsig[$sxi][0] == 'FS-MIN' &&
                            $str_len < $xsig[$sxi][1]
                        ) || (
                            $xsig[$sxi][0] == 'FS-MAX' &&
                            $str_len > $xsig[$sxi][1]
                        ) || (
                            $xsig[$sxi][0] == 'FD' &&
                            !substr_count($str_hex, $xsig[$sxi][1])
                        ) || (
                            $xsig[$sxi][0] == 'FD-RX' &&
                            !preg_match('/' . $xsig[$sxi][1] . '/i', $str_hex)
                        ) || (
                            $xsig[$sxi][0] == 'FD-NORM' &&
                            !substr_count($str_hex_norm, $xsig[$sxi][1])
                        ) || (
                            $xsig[$sxi][0] == 'FD-NORM-RX' &&
                            !preg_match('/' . $xsig[$sxi][1] . '/i', $str_hex_norm)
                        )
                    ) {
                        continue 2;
                    }
                    if (substr($xsig[$sxi][0], 0, 1) == '$') {
                        $vf = substr($xsig[$sxi][0], 1);
                        if (!isset($$vf) || is_array($$vf) || $$vf != $xsig[$sxi][1]) {
                            continue 2;
                        }
                    } elseif (substr($xsig[$sxi][0], 0, 2) == '!$') {
                        $vf = substr($xsig[$sxi][0], 2);
                        if (!isset($$vf) || is_array($$vf) || $$vf == $xsig[$sxi][1]) {
                            continue 2;
                        }
                    } elseif (!substr_count(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,', ',' . $xsig[$sxi][0] . ',')) {
                        continue 2;
                    }
                }
            }
        }
        $sxc = count($Switch);
        if ($sxc > 1) {
            if ($Switch[1] == 'true') {
                $$theSwitch = true;
                continue;
            }
            if ($Switch[1] == 'false') {
                $$theSwitch = false;
                continue;
            }
            $$theSwitch = $Switch[1];
        } else {
            if (!isset($$theSwitch)) {
                $$theSwitch = true;
                continue;
            }
            $$theSwitch = (!$$theSwitch) ? true : false;
        }
        $sxi = $sxc = $theSwitch = $Switch = $xsig = '';
    }

    /** Whitelist array. */
    $whitelist = array();

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
        $phpMussel['Config']['signatures']['pe_clamav'] ||
        $phpMussel['Config']['signatures']['pe_custom'] ||
        $phpMussel['Config']['signatures']['pe_mussel'] ||
        $phpMussel['Config']['signatures']['pex_custom'] ||
        $phpMussel['Config']['signatures']['pex_mussel'] ||
        $phpMussel['Config']['attack_specific']['corrupted_exe']
    ) {
        $PEArr = array();
        $PEArr['SectionArr'] = array();
        if ($twocc === '4d5a') {
            $PEArr['Offset'] = @unpack('S', substr($str, 60, 4));
            $PEArr['Offset'] = $PEArr['Offset'][1];
            while (true) {
                $PEArr['DoScan'] = true;
                if ($PEArr['Offset'] < 1 || $PEArr['Offset'] > 16384 || $PEArr['Offset'] > $str_len) {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['Magic'] = @substr($str, $PEArr['Offset'], 2);
                if ($PEArr['Magic']!=='PE') {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['Proc'] = @unpack('S', substr($str, $PEArr['Offset'] + 4, 2));
                $PEArr['Proc'] = $PEArr['Proc'][1];
                if ($PEArr['Proc'] != 0x14c && $PEArr['Proc'] != 0x8664) {
                    $PEArr['DoScan'] = false;
                    break;
                }
                $PEArr['NumOfSections'] = @unpack('S', substr($str, $PEArr['Offset'] + 6, 2));
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
                    $phpMussel['memCache']['detections_count']++;
                    $out .=
                        $lnap . $phpMussel['Config']['lang']['corrupted'] .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['corrupted'] .
                        ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                }
            } else {
                $is_pe = true;
                $asciiable = false;
                $PEArr['OptHdrSize'] = @unpack('S', substr($str, $PEArr['Offset'] + 20, 2));
                $PEArr['OptHdrSize'] = $PEArr['OptHdrSize'][1];
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    $PEArr['SectionArr'][$PEArr['k']] = array();
                    $PEArr['SectionArr'][$PEArr['k']]['SectionHead'] =
                        substr($str, $PEArr['Offset'] + 24 + $PEArr['OptHdrSize'] + ($PEArr['k'] * 40), $NumOfSections * 40);
                    $PEArr['SectionArr'][$PEArr['k']]['SectionName'] =
                        str_ireplace("\x00", '', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 0, 8));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        @unpack('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 8, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualSize'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        @unpack('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 12, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'] =
                        $PEArr['SectionArr'][$PEArr['k']]['VirtualAddress'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] =
                        @unpack('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 16, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'] =
                        $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'] =
                        @unpack('S', substr($PEArr['SectionArr'][$PEArr['k']]['SectionHead'], 20, 4));
                    $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'] =
                        $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'][1];
                    $PEArr['SectionArr'][$PEArr['k']]['SectionData'] =
                        @substr($str, $PEArr['SectionArr'][$PEArr['k']]['PointerToRawData'], $PEArr['SectionArr'][$PEArr['k']]['SizeOfRawData']);
                    $PEArr['SectionArr'][$PEArr['k']]['MD5'] =
                        md5($PEArr['SectionArr'][$PEArr['k']]['SectionData']);
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
                if (substr_count($str, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24")) {
                    $PEArr['FINFO'] = substral($str, "V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24");
                    if (substr_count($PEArr['FINFO'], "F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00")) {
                        $PEFileDescription = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00")) {
                        $PEFileVersion = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00")) {
                        $PEProductName = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00")) {
                        $PEProductVersion = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00")) {
                        $PECopyright = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00")) {
                        $PEOriginalFilename = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    if (substr_count($PEArr['FINFO'], "C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00")) {
                        $PECompanyName = trim(str_ireplace("\x00", '', substrbf(substral($PEArr['FINFO'], "C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00"), "\x00\x00\x00")));
                    }
                    $PEArr['FINFO'] = array();
                    $PEArr['FINDX'] = 0;
                    if ($PEFileDescription) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PEFileDescription:' . md5($PEFileDescription) . ':' . strlen($PEFileDescription) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PEFileVersion) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PEFileVersion:' . md5($PEFileVersion) . ':' . strlen($PEFileVersion) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PEProductName) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PEProductName:' . md5($PEProductName) . ':' . strlen($PEProductName) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PEProductVersion) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PEProductVersion:' . md5($PEProductVersion) . ':' . strlen($PEProductVersion) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PECopyright) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PECopyright:' . md5($PECopyright) . ':' . strlen($PECopyright) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PEOriginalFilename) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PEOriginalFilename:' . md5($PEOriginalFilename) . ':' . strlen($PEOriginalFilename) . ':';
                        $PEArr['FINDX']++;
                    }
                    if ($PECompanyName) {
                        $PEArr['FINFO'][$PEArr['FINDX']] = '$PECompanyName:' . md5($PECompanyName) . ':' . strlen($PECompanyName) . ':';
                        $PEArr['FINDX']++;
                    }
                }
            }
        }
    }

    /** Look for potential indicators of not being HTML. */
    $is_not_html = (!$is_html && ($is_macho || $is_elf || $is_pe));

    /** Look for potential indicators of not being PHP. */
    $is_not_php = ((
        !substr_count(',phar,', ',' . $xt . ',') &&
        !substr_count(',php*,', ',' . $xts . ',') &&
        !substr_count(',phar,', ',' . $gzxt . ',') &&
        !substr_count(',php*,', ',' . $gzxts . ',') &&
        !substr_count($str_hex_norm, '3c3f706870')
    ) || (
        $is_pe
    ));

    /**
     * Instructions for handling signature files.
     *
     * Config: The configuration directive required to be true in order for the
     *      specified signature file to be processed. Required.
     *
     * ConfigCat: The configuration category containing the directive required
     *      by the specified signature file. Optional (defaults to "signatures"
     *      if not specified).
     *
     * SigMode: The type of processing we'll attempt to use for the specified
     *      signature file. Required. Can be:
     *      - whitelist
     *      - filenames
     *      - md5
     *      - pe
     *      - pex
     *      - coex
     *      - regex-mapped
     *      - regex
     *      - standard-mapped
     *      - standard
     *      - urlscanner
     *
     * SigFile: The signature file to be processed. Required.
     *
     * Switches: An array or a string containing the name or names of all
     *      boolean variables (within the scope of this function) that must
     *      equal true in order for the specified signature file to be
     *      processed. If any equal false, processing won't continue. Optional.
     *
     * Whitelist: A string containing the whitelist designation corresponding
     *      to the specified signature file. If it equals true, processing
     *      won't continue. Optional.
     *
     * SigMap: The signature map corresponding to the specified signature file.
     *      Required for *-mapped SigMode.
     *
     * DataA: Name of the variable containing the primary data source for the
     *      specified signature file to use for pattern matching. Recommended:
     *      - str_hex (Data[AB]Len: str_hex_len)
     *      - str_hex_norm (Data[AB]Len: str_hex_norm_len)
     *      - str_hex_html (Data[AB]Len: str_hex_html_len)
     *      - str_xmlxdp_hex (Data[AB]Len: str_xmlxdp_hex_len)
     *      - str_xmlxdp_hex_norm (Data[AB]Len: str_xmlxdp_hex_norm_len)
     *      - str_xmlxdp_html (Data[AB]Len: str_xmlxdp_html_len)
     *
     * DataALen: Name of the variable specifying the length of the primary data
     *      source (should correspond to the variable cited as containing the
     *      primary data source).
     *
     * DataB: Name of the variable containing an optional secondary data source
     *      for the specified signature file that may optionally be used for
     *      pattern matching (recommendations are the same as that supplied for
     *      "DataA").
     *
     * UseAPI: Boolean value instructing the script whether to trigger related
     *      API functionality after processing the relevant signature file, if
     *      such functionality is supported (currently, only supported by the
     *      urlscanner signature files). Optional; Defaults to true.
     */
    $SigData = array(
        array(
            'Config' => 'whitelist_clamav',
            'SigMode' => 'whitelist',
            'SigFile' => 'whitelist_clamav.cvd'
        ),
        array(
            'Config' => 'whitelist_custom',
            'SigMode' => 'whitelist',
            'SigFile' => 'whitelist_custom.cvd'
        ),
        array(
            'Config' => 'whitelist_mussel',
            'SigMode' => 'whitelist',
            'SigFile' => 'whitelist_mussel.cvd'
        ),
        array(
            'Config' => 'filenames_clamav',
            'SigMode' => 'filenames',
            'SigFile' => 'filenames_clamav.cvd'
        ),
        array(
            'Config' => 'filenames_custom',
            'SigMode' => 'filenames',
            'SigFile' => 'filenames_custom.cvd'
        ),
        array(
            'Config' => 'filenames_mussel',
            'SigMode' => 'filenames',
            'SigFile' => 'filenames_mussel.cvd'
        ),
        array(
            'Config' => 'md5_clamav',
            'SigMode' => 'md5',
            'SigFile' => 'md5_clamav.cvd'
        ),
        array(
            'Config' => 'md5_custom',
            'SigMode' => 'md5',
            'SigFile' => 'md5_custom.cvd'
        ),
        array(
            'Config' => 'md5_mussel',
            'SigMode' => 'md5',
            'SigFile' => 'md5_mussel.cvd'
        ),
        array(
            'Config' => 'pe_clamav',
            'SigMode' => 'pe',
            'SigFile' => 'pe_clamav.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'PE'
        ),
        array(
            'Config' => 'pe_custom',
            'SigMode' => 'pe',
            'SigFile' => 'pe_custom.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'PE'
        ),
        array(
            'Config' => 'pe_mussel',
            'SigMode' => 'pe',
            'SigFile' => 'pe_mussel.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'PE'
        ),
        array(
            'Config' => 'pex_custom',
            'SigMode' => 'pex',
            'SigFile' => 'pex_custom.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'PEX'
        ),
        array(
            'Config' => 'pex_mussel',
            'SigMode' => 'pex',
            'SigFile' => 'pex_mussel.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'PEX'
        ),
        array(
            'Config' => 'coex_clamav',
            'SigMode' => 'coex',
            'SigFile' => 'coex_clamav.cvd'
        ),
        array(
            'Config' => 'coex_custom',
            'SigMode' => 'coex',
            'SigFile' => 'coex_custom.cvd'
        ),
        array(
            'Config' => 'coex_mussel',
            'SigMode' => 'coex',
            'SigFile' => 'coex_mussel.cvd'
        ),
        array(
            'Config' => 'ascii_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'ascii_clamav_regex.cvd',
            'Switches' => array(
                'asciiable',
                'infectable'
            ),
            'Whitelist' => 'ASCII',
            'SigMap' => 'ascii_clamav_regex.map',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'ascii_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'ascii_clamav_standard.cvd',
            'Switches' => array(
                'asciiable',
                'infectable'
            ),
            'Whitelist' => 'ASCII',
            'SigMap' => 'ascii_clamav_standard.map',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'ascii_custom',
            'SigMode' => 'regex',
            'SigFile' => 'ascii_custom_regex.cvd',
            'Switches' => 'asciiable',
            'Whitelist' => 'ASCII',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'ascii_custom',
            'SigMode' => 'standard',
            'SigFile' => 'ascii_custom_standard.cvd',
            'Switches' => 'asciiable',
            'Whitelist' => 'ASCII',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'ascii_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'ascii_mussel_regex.cvd',
            'Switches' => 'asciiable',
            'Whitelist' => 'ASCII',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'ascii_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'ascii_mussel_standard.cvd',
            'Switches' => 'asciiable',
            'Whitelist' => 'ASCII',
            'DataA' => 'str_hex_norm',
            'DataALen' => 'str_hex_norm_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'general_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'general_clamav_regex.cvd',
            'Switches' => 'infectable',
            'Whitelist' => 'General',
            'SigMap' => 'general_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'general_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'general_clamav_standard.cvd',
            'Switches' => 'infectable',
            'Whitelist' => 'General',
            'SigMap' => 'general_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'general_custom',
            'SigMode' => 'regex',
            'SigFile' => 'general_custom_regex.cvd',
            'Whitelist' => 'General',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'general_custom',
            'SigMode' => 'standard',
            'SigFile' => 'general_custom_standard.cvd',
            'Whitelist' => 'General',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'general_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'general_mussel_regex.cvd',
            'Whitelist' => 'General',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'general_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'general_mussel_standard.cvd',
            'Whitelist' => 'General',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'html_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'html_clamav_regex.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'SigMap' => 'html_clamav_regex.map',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'html_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'html_clamav_standard.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'SigMap' => 'html_clamav_standard.map',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'html_custom',
            'SigMode' => 'regex',
            'SigFile' => 'html_custom_regex.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'html_custom',
            'SigMode' => 'standard',
            'SigFile' => 'html_custom_standard.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'html_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'html_mussel_regex.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'html_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'html_mussel_standard.cvd',
            'Switches' => 'is_html',
            'Whitelist' => 'HTML',
            'DataA' => 'str_hex_html',
            'DataALen' => 'str_hex_html_len',
            'DataB' => 'str_xmlxdp_hex_html'
        ),
        array(
            'Config' => 'graphics_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'graphics_clamav_regex.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'SigMap' => 'graphics_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'graphics_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'graphics_clamav_standard.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'SigMap' => 'graphics_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'graphics_custom',
            'SigMode' => 'regex',
            'SigFile' => 'graphics_custom_regex.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'graphics_custom',
            'SigMode' => 'standard',
            'SigFile' => 'graphics_custom_standard.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'graphics_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'graphics_mussel_regex.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'graphics_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'graphics_mussel_standard.cvd',
            'Switches' => 'is_graphics',
            'Whitelist' => 'Graphics',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_hex_norm'
        ),
        array(
            'Config' => 'elf_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'elf_clamav_regex.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'SigMap' => 'elf_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'elf_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'elf_clamav_standard.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'SigMap' => 'elf_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'elf_custom',
            'SigMode' => 'regex',
            'SigFile' => 'elf_custom_regex.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'elf_custom',
            'SigMode' => 'standard',
            'SigFile' => 'elf_custom_standard.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'elf_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'elf_mussel_regex.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'elf_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'elf_mussel_standard.cvd',
            'Switches' => 'is_elf',
            'Whitelist' => 'ELF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'exe_clamav_regex.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'SigMap' => 'exe_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'exe_clamav_standard.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'SigMap' => 'exe_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_custom',
            'SigMode' => 'regex',
            'SigFile' => 'exe_custom_regex.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_custom',
            'SigMode' => 'standard',
            'SigFile' => 'exe_custom_standard.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'exe_mussel_regex.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'exe_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'exe_mussel_standard.cvd',
            'Switches' => 'is_pe',
            'Whitelist' => 'EXE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'macho_clamav_regex.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'SigMap' => 'macho_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'macho_clamav_standard.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'SigMap' => 'macho_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_custom',
            'SigMode' => 'regex',
            'SigFile' => 'macho_custom_regex.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_custom',
            'SigMode' => 'standard',
            'SigFile' => 'macho_custom_standard.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'macho_mussel_regex.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'macho_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'macho_mussel_standard.cvd',
            'Switches' => 'is_macho',
            'Whitelist' => 'OSX',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'pdf_clamav_regex.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'SigMap' => 'pdf_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'pdf_clamav_standard.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'SigMap' => 'pdf_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_custom',
            'SigMode' => 'regex',
            'SigFile' => 'pdf_custom_regex.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_custom',
            'SigMode' => 'standard',
            'SigFile' => 'pdf_custom_standard.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'pdf_mussel_regex.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'pdf_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'pdf_mussel_standard.cvd',
            'Switches' => 'is_pdf',
            'Whitelist' => 'PDF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'swf_clamav_regex.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'SigMap' => 'swf_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'swf_clamav_standard.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'SigMap' => 'swf_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_custom',
            'SigMode' => 'regex',
            'SigFile' => 'swf_custom_regex.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_custom',
            'SigMode' => 'standard',
            'SigFile' => 'swf_custom_standard.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'swf_mussel_regex.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'swf_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'swf_mussel_standard.cvd',
            'Switches' => 'is_swf',
            'Whitelist' => 'SWF',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_clamav',
            'SigMode' => 'regex-mapped',
            'SigFile' => 'ole_clamav_regex.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'SigMap' => 'ole_clamav_regex.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_clamav',
            'SigMode' => 'standard-mapped',
            'SigFile' => 'ole_clamav_standard.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'SigMap' => 'ole_clamav_standard.map',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_custom',
            'SigMode' => 'regex',
            'SigFile' => 'ole_custom_regex.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_custom',
            'SigMode' => 'standard',
            'SigFile' => 'ole_custom_standard.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'ole_mussel_regex.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'ole_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'ole_mussel_standard.cvd',
            'Switches' => 'is_ole',
            'Whitelist' => 'OLE',
            'DataA' => 'str_hex',
            'DataALen' => 'str_hex_len',
            'DataB' => 'str_xmlxdp_hex'
        ),
        array(
            'Config' => 'xmlxdp_clamav',
            'SigMode' => 'regex',
            'SigFile' => 'xmlxdp_clamav_regex.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'xmlxdp_clamav',
            'SigMode' => 'standard',
            'SigFile' => 'xmlxdp_clamav_standard.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'xmlxdp_custom',
            'SigMode' => 'regex',
            'SigFile' => 'xmlxdp_custom_regex.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'xmlxdp_custom',
            'SigMode' => 'standard',
            'SigFile' => 'xmlxdp_custom_standard.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'xmlxdp_mussel',
            'SigMode' => 'regex',
            'SigFile' => 'xmlxdp_mussel_regex.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'xmlxdp_mussel',
            'SigMode' => 'standard',
            'SigFile' => 'xmlxdp_mussel_standard.cvd',
            'Switches' => 'str_xmlxdp_hex_len',
            'Whitelist' => 'XMLXDP',
            'DataA' => 'str_xmlxdp_hex',
            'DataALen' => 'str_xmlxdp_hex_len',
            'DataB' => 'str_xmlxdp_hex_norm'
        ),
        array(
            'Config' => 'urlscanner',
            'ConfigCat' => 'urlscanner',
            'SigMode' => 'urlscanner',
            'SigFile' => 'urlscanner.cvd',
            'Switches' => 'str_hex_norm_len',
            'UseAPI' => true
        )
    );

    /** Plugin hook: "during_scan". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['during_scan']) &&
        $phpMussel['MusselPlugins']['hookcounts']['during_scan'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['during_scan']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['during_scan'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['during_scan']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['during_scan'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['during_scan'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['during_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['during_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['during_scan'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['during_scan']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    $SigCount = count($SigData);

    for ($SigSet = 0; $SigSet < $SigCount; $SigSet++) {
        $ConfigCat =
            (empty($SigData[$SigSet]['ConfigCat'])) ?
            'signatures' :
            $SigData[$SigSet]['ConfigCat'];
        $SigFile =
            (empty($SigData[$SigSet]['SigFile'])) ?
            false :
            $SigData[$SigSet]['SigFile'];
        if (
            !$SigFile ||
            empty($phpMussel['Config'][$ConfigCat]) ||
            empty($phpMussel['Config'][$ConfigCat][$SigData[$SigSet]['Config']]) || (
                !empty($SigData[$SigSet]['Whitelist']) &&
                !empty($whitelist[$SigData[$SigSet]['Whitelist']])
            )
        ) {
            continue;
        }
        $Switches =
            (empty($SigData[$SigSet]['Switches'])) ?
            false :
            $SigData[$SigSet]['Switches'];
        if ($Switches) {
            if (!is_array($Switches)) {
                $Switches = array($Switches);
            }
            foreach ($Switches as $Switch) {
                if (empty($$Switch)) {
                    continue 2;
                }
            }
        }
        $DataA =
            (empty($SigData[$SigSet]['DataA'])) ?
            false :
            $SigData[$SigSet]['DataA'];
        $DataALen =
            (empty($SigData[$SigSet]['DataALen'])) ?
            false :
            $SigData[$SigSet]['DataALen'];
        $DataB =
            (empty($SigData[$SigSet]['DataB'])) ?
            false :
            $SigData[$SigSet]['DataB'];
        if ($SigData[$SigSet]['SigMode'] === 'whitelist') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                $xmatches = array('c' => substr_count($phpMussel['memCache'][$SigFile], $md5 . ':' . $str_len . ':'));
                if ($xmatches['c'] > 0) {
                    $xmatches['c']++;
                    $xmatches['d'] = explode($md5 . ':' . $str_len . ':', $phpMussel['memCache'][$SigFile]);
                    for ($xmatches['i'] = 1; $xmatches['i'] < $xmatches['c']; $xmatches['i']++) {
                        $xsig = explode("\n", $xmatches['d'][$xmatches['i']], 2);
                        $whitelist[$xsig[0]] = true;
                        $xsig = '';
                    }
                }
                $xmatches = '';
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'filenames') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = @file($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            $c = 0;
            } else {
                $c = count($phpMussel['memCache'][$SigFile]);
            }
            for ($i = 0; $i < $c; $i++) {
                $xsig = $phpMussel['memCache'][$SigFile][$i];
                if (substr($xsig, 0, 1) == '>') {
                    $xsig = explode('>', $xsig, 4);
                    $xsig[3] = (int)$xsig[3];
                    if ($xsig[1] == 'FN') {
                        if (!preg_match('/' . $xsig[2] . '/i', $ofn)) {
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                    } elseif ($xsig[1] == 'FS-MIN') {
                        if ($str_len < $xsig[2]) {
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                    } elseif ($xsig[1] == 'FS-MAX') {
                        if ($str_len > $xsig[2]) {
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                    } elseif ($xsig[1] == 'FD') {
                        if (!substr_count($str_hex, $xsig[2])) {
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                    } elseif ($xsig[1] == 'FD-RX') {
                        if (!preg_match('/' . $xsig[2] . '/i', $str_hex)) {
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                    } elseif (substr($xsig[1], 0, 1) == '$') {
                        $vf = substr($xsig[1], 1);
                        if (isset($$vf) && !is_array($$vf)) {
                            if ($$vf != $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                            continue;
                        }
                        if ($xsig[3] <= $i) {
                            break;
                        }
                        $i = $xsig[3] - 1;
                    } elseif (substr($xsig[1], 0, 2) == '!$') {
                        $vf = substr($xsig[1], 2);
                        if (isset($$vf) && !is_array($$vf)) {
                            if ($$vf == $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                            continue;
                        }
                        if ($xsig[3] <= $i) {
                            break;
                        }
                        $i = $xsig[3] - 1;
                    }
                    continue;
                }
                if (substr_count($xsig, ':') > 0) {
                    $vn = @explode(':', $xsig);
                    $xsig = @preg_split('/[\x00-\x1f]+/', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                    $xsig = ($xsig === false ? '' : implode('', $xsig));
                    $xlen = strlen($xsig);
                    if (
                        $xlen < $phpMussel['Config']['signatures']['fn_siglen_min'] ||
                        $xlen > $phpMussel['Config']['signatures']['fn_siglen_max']
                    ) {
                        $i++;
                        continue;
                    }
                    $vn = vn_shorthand($vn[0]);
                    if (
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        if (preg_match('/' . $xsig . '/i', $ofn)) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe.')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                    }
                }
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'md5') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                if (substr_count($phpMussel['memCache'][$SigFile], $md5 . ':' . $str_len . ':')) {
                    $xsig = substraf($phpMussel['memCache'][$SigFile], $md5 . ':' . $str_len . ':');
                    if (substr_count($xsig, "\n")) {
                        $xsig = substrbf($xsig, "\n");
                    }
                    $xsig = vn_shorthand($xsig);
                    if (
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                            $flagged = true;
                        }
                        $heur['detections']++;
                        $phpMussel['memCache']['detections_count']++;
                        $out .= $lnap . phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                        $phpMussel['whyflagged'] .= phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                    }
                    if (isset($phpMussel['memCache']['xmlxdp'][$md5]) && is_array($phpMussel['memCache']['xmlxdp'][$md5])) {
                        $c = count($phpMussel['memCache']['xmlxdp'][$md5]);
                        for ($i = 0; $i < $c; $i++) {
                            $xsig = substraf($phpMussel['memCache'][$SigFile], $phpMussel['memCache']['xmlxdp'][$md5][$i]);
                            if (substr_count($xsig, "\n")) {
                                $xsig = substrbf($xsig, "\n");
                            }
                            $xsig = vn_shorthand($xsig);
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if (!$flagged) {
                                    $phpMussel['killdata'] .=
                                        $phpMussel['memCache']['xmlxdp'][$md5][$i] .
                                        $ofn . ' (XMLXDP CHUNK #' . $i . ")\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                    }
                    $xsig = '';
                }
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'pe') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                for ($PEArr['k'] = 0; $PEArr['k'] < $NumOfSections; $PEArr['k']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], $PEArr['SectionArr'][$PEArr['k']])) {
                        $xsig = substraf($phpMussel['memCache'][$SigFile], $PEArr['SectionArr'][$PEArr['k']]);
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            $out .= $lnap . phpMusselV(
                                array('vn' => $xsig),
                                $phpMussel['Config']['lang']['detected']
                            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                            $phpMussel['whyflagged'] .= phpMusselV(
                                array('vn' => $xsig),
                                $phpMussel['Config']['lang']['detected']
                            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        }
                        $xsig = '';
                    }
                }
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'pex') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                for ($PEArr['PEMDI'] = 0; $PEArr['PEMDI'] < $PEArr['FINDX']; $PEArr['PEMDI']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], $PEArr['FINFO'][$PEArr['PEMDI']])) {
                        $xsig = substraf($phpMussel['memCache'][$SigFile], $PEArr['FINFO'][$PEArr['PEMDI']]);
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                        $xsig = '';
                    }
                }
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'regex-mapped') {
            if (empty($DataA) || empty($$DataA) || empty($DataALen) || empty($$DataALen)) {
                continue;
            }
            $SigMap = (empty($SigData[$SigSet]['SigMap'])) ? false : $SigData[$SigSet]['SigMap'];
            $DataMode = (empty($DataB) || empty($$DataB));
            while (true) {
                if (!isset($phpMussel['memCache'][$SigMap])) {
                    $phpMussel['memCache'][$SigMap] = @file($phpMussel['sigPath'] . $SigMap);
                }
                if (!$phpMussel['memCache'][$SigMap]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_map_missing'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_map_missing'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                if (!isset($phpMussel['memCache'][$SigFile])) {
                    $phpMussel['memCache'][$SigFile] = @file($phpMussel['sigPath'] . $SigFile);
                }
                if (!$phpMussel['memCache'][$SigFile]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigMap]);
                if ($c < 1) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_map_corrupted'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_map_corrupted'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                for ($i = 0; $i < $c; $i++) {
                    if (substr($phpMussel['memCache'][$SigMap][$i], 0, 1) == '>') {
                        $mapcon = explode('>', $phpMussel['memCache'][$SigMap][$i], 4);
                        if (!isset($mapcon[1]) || !isset($mapcon[2]) || !isset($mapcon[3])) {
                            break;
                        }
                        $mapcon[3] = (int)$mapcon[3];
                        if ($mapcon[1] == 'FN') {
                            if (!preg_match('/' . $mapcon[2] . '/i', $ofn)) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FS-MIN') {
                            if ($str_len < $mapcon[2]) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FS-MAX') {
                            if ($str_len > $mapcon[2]) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FD') {
                            if (!substr_count($$DataA, $mapcon[2])) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FD-RX') {
                            if (!preg_match('/' . $mapcon[2] . '/i', $$DataA)) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif (substr($mapcon[1], 0, 1) == '$') {
                            $vf = substr($mapcon[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $mapcon[2]) {
                                    if ($mapcon[3] <= $i) {
                                        break;
                                    }
                                    $i = $mapcon[3] - 1;
                                }
                                continue;
                            }
                            if ($mapcon[3] <= $i) {
                                break;
                            }
                            $i = $mapcon[3] - 1;
                        } elseif (substr($mapcon[1], 0, 2) == '!$') {
                            $vf = substr($mapcon[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $mapcon[2]) {
                                    if ($mapcon[3] <= $i) {
                                        break;
                                    }
                                    $i = $mapcon[3] - 1;
                                }
                                continue;
                            }
                            if ($mapcon[3] <= $i) {
                                break;
                            }
                            $i = $mapcon[3] - 1;
                        } else {
                            break;
                        }
                        continue;
                    }
                    $mapcon = false;
                    $map = explode(':', $phpMussel['memCache'][$SigMap][$i]);
                    $map[2] = (int)$map[2];
                    if (substr_count($$DataA, $map[0]) > 0) {
                        for ($xind = $map[1]; $xind < ($map[2] + 1); $xind++) {
                            $xsig = $phpMussel['memCache'][$SigFile][$xind];
                            if (substr_count($xsig, ':')) {
                                $vn = @explode(':', $xsig);
                                $xsig = @preg_split('/[\x00-\x1f]+/', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                                $xsig = ($xsig === false ? '' : implode('', $xsig));
                                $xlen = strlen($xsig);
                                if (
                                    $xlen < $phpMussel['Config']['signatures']['rx_siglen_min'] ||
                                    $xlen > $phpMussel['Config']['signatures']['rx_siglen_max']
                                ) {
                                    continue;
                                }
                                $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                                $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                                $vn = vn_shorthand($vn[0]);
                                $vnlc = strtolower($vn);
                                if (
                                    ($is_not_php && (
                                        substr_count($vnlc, '-php') ||
                                        substr_count($vnlc, '.php')
                                    )) ||
                                    ($is_not_html && (
                                        substr_count($vnlc, '-htm') ||
                                        substr_count($vnlc, '.htm')
                                    ))
                                ) {
                                    continue;
                                }
                                if ($DataMode) {
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                        !$phpMussel['memCache']['ignoreme']
                                    ) {
                                        if ($xstrf === '*') {
                                            if ($xstrt === '*') {
                                                if (!preg_match('/' . $xsig . '/i', $$DataA)) {
                                                    continue;
                                                }
                                            } elseif (!preg_match('/' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2))) {
                                                continue;
                                            }
                                        } elseif ($xstrf === 'A') {
                                            if ($xstrt === '*') {
                                                if (!preg_match('/\A' . $xsig . '/i', $$DataA)) {
                                                    continue;
                                                }
                                            } elseif (!preg_match('/\A' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2))) {
                                                continue;
                                            }
                                        } else {
                                            if ($xstrt === '*') {
                                                if (!preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2))) {
                                                    continue;
                                                }
                                            } elseif (!preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2, $xstrt * 2))) {
                                                continue;
                                            }
                                        }
                                        if (!$flagged) {
                                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                            $flagged = true;
                                        }
                                        $heur['detections']++;
                                        $phpMussel['memCache']['detections_count']++;
                                        $out .= $lnap . phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['whyflagged'] .= phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ).' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                    }
                                } else {
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                        !$phpMussel['memCache']['ignoreme']
                                    ) {
                                        if ($xstrf === '*') {
                                            if ($xstrt === '*') {
                                                if (
                                                    !preg_match('/' . $xsig . '/i', $$DataA) &&
                                                    !preg_match('/' . $xsig . '/i', $$DataB)
                                                ) {
                                                    continue;
                                                }
                                            } elseif (
                                                !preg_match('/' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2)) &&
                                                !preg_match('/' . $xsig . '/i', substr($$DataB, 0, $xstrt * 2))
                                            ) {
                                                continue;
                                            }
                                        } elseif ($xstrf === 'A') {
                                            if ($xstrt === '*') {
                                                if (
                                                    !preg_match('/\A' . $xsig . '/i', $$DataA) &&
                                                    !preg_match('/\A' . $xsig . '/i', $$DataB)
                                                ) {
                                                    continue;
                                                }
                                            } elseif (
                                                !preg_match('/\A' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2)) &&
                                                !preg_match('/\A' . $xsig . '/i', substr($$DataB, 0, $xstrt * 2))
                                            ) {
                                                continue;
                                            }
                                        } else {
                                            if ($xstrt === '*') {
                                                if (
                                                    !preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2)) &&
                                                    !preg_match('/' . $xsig . '/i', substr($$DataB, $xstrf * 2))
                                                ) {
                                                    continue;
                                                }
                                            } elseif (
                                                !preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2, $xstrt * 2)) &&
                                                !preg_match('/' . $xsig . '/i', substr($$DataB, $xstrf * 2, $xstrt * 2))
                                            ) {
                                                continue;
                                            }
                                        }
                                        if (!$flagged) {
                                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                            $flagged = true;
                                        }
                                        $heur['detections']++;
                                        $phpMussel['memCache']['detections_count']++;
                                        $out .= $lnap . phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['whyflagged'] .= phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ).' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    }
                }
            break;
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'standard-mapped') {
            if (empty($DataA) || empty($$DataA) || empty($DataALen) || empty($$DataALen)) {
                continue;
            }
            $SigMap = (empty($SigData[$SigSet]['SigMap'])) ? false : $SigData[$SigSet]['SigMap'];
            $DataMode = (empty($DataB) || empty($$DataB));
            while (true) {
                if (!isset($phpMussel['memCache'][$SigMap])) {
                    $phpMussel['memCache'][$SigMap] = @file($phpMussel['sigPath'] . $SigMap);
                }
                if (!$phpMussel['memCache'][$SigMap]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_map_missing'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_map_missing'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                if (!isset($phpMussel['memCache'][$SigFile])) {
                    $phpMussel['memCache'][$SigFile] = @file($phpMussel['sigPath'] . $SigFile);
                }
                if (!$phpMussel['memCache'][$SigFile]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigMap]);
                if ($c < 1) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_map_corrupted'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_map_corrupted'] .
                            ' (' . $SigMap . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                for ($i = 0; $i < $c; $i++) {
                    if (substr($phpMussel['memCache'][$SigMap][$i], 0, 1) == '>') {
                        $mapcon = explode('>', $phpMussel['memCache'][$SigMap][$i], 4);
                        if (!isset($mapcon[1]) || !isset($mapcon[2]) || !isset($mapcon[3])) {
                            break;
                        }
                        $mapcon[3] = (int)$mapcon[3];
                        if ($mapcon[1] == 'FN') {
                            if (!preg_match('/' . $mapcon[2] . '/i', $ofn)) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FS-MIN') {
                            if ($str_len < $mapcon[2]) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FS-MAX') {
                            if ($str_len > $mapcon[2]) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FD') {
                            if (!substr_count($$DataA, $mapcon[2])) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif ($mapcon[1] == 'FD-RX') {
                            if (!preg_match('/' . $mapcon[2] . '/i', $$DataA)) {
                                if ($mapcon[3] <= $i) {
                                    break;
                                }
                                $i = $mapcon[3] - 1;
                            }
                        } elseif (substr($mapcon[1], 0, 1) == '$') {
                            $vf = substr($mapcon[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $mapcon[2]) {
                                    if ($mapcon[3] <= $i) {
                                        break;
                                    }
                                    $i = $mapcon[3] - 1;
                                }
                                continue;
                            }
                            if ($mapcon[3] <= $i) {
                                break;
                            }
                            $i = $mapcon[3] - 1;
                        } elseif (substr($mapcon[1], 0, 2) == '!$') {
                            $vf = substr($mapcon[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $mapcon[2]) {
                                    if ($mapcon[3] <= $i) {
                                        break;
                                    }
                                    $i = $mapcon[3] - 1;
                                }
                                continue;
                            }
                            if ($mapcon[3] <= $i) {
                                break;
                            }
                            $i = $mapcon[3] - 1;
                        } else {
                            break;
                        }
                        continue;
                    }
                    $mapcon = false;
                    $map = explode(':', $phpMussel['memCache'][$SigMap][$i]);
                    $map[2] = (int)$map[2];
                    if (substr_count($$DataA, $map[0]) > 0) {
                        for ($xind = $map[1]; $xind < ($map[2] + 1); $xind++) {
                            $xsig = $phpMussel['memCache'][$SigFile][$xind];
                            if (substr_count($xsig, ':')) {
                                $vn = @explode(':', $xsig);
                                $xsig = @preg_split('/[^a-fA-F0-9>]+/i', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                                $xsig = ($xsig === false ? '' : implode('', $xsig));
                                $xlen = strlen($xsig);
                                if (
                                    $xlen < $phpMussel['Config']['signatures']['sd_siglen_min'] ||
                                    $xlen > $phpMussel['Config']['signatures']['sd_siglen_max']
                                ) {
                                    continue;
                                }
                                $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                                $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                                $vn = vn_shorthand($vn[0]);
                                $vnlc = strtolower($vn);
                                if (
                                    ($is_not_php && (
                                        substr_count($vnlc, '-php') ||
                                        substr_count($vnlc, '.php')
                                    )) ||
                                    ($is_not_html && (
                                        substr_count($vnlc, '-htm') ||
                                        substr_count($vnlc, '.htm')
                                    )) ||
                                    ($$DataALen < $xlen)
                                ) {
                                    continue;
                                }
                                if ($DataMode) {
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                        !$phpMussel['memCache']['ignoreme']
                                    ) {
                                        $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                                        $xsigc = count($xsig);
                                        $this_str = $$DataA;
                                        if ($xstrf === 'A') {
                                            $this_str = "\x01" . $this_str;
                                            $xsig[0] = "\x01" . $xsig[0];
                                        } elseif ($xstrf !== '*') {
                                            $this_str = substr($this_str, $xstrf * 2);
                                        }
                                        if ($xstrt !== '*') {
                                            $this_str = substr($this_str, 0, $xstrt * 2);
                                        }
                                        for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                            if (!substr_count($this_str, $xsig[$xsigi])) {
                                                continue 2;
                                            }
                                            if ($xsigc > 1 && substr_count($this_str, $xsig[$xsigi])) {
                                                $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                            }
                                        }
                                        $this_str = false;
                                        if (!$flagged) {
                                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                            $flagged = true;
                                        }
                                        $heur['detections']++;
                                        $phpMussel['memCache']['detections_count']++;
                                        $out .= $lnap . phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['whyflagged'] .= phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                    }
                                } else {
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                        !$phpMussel['memCache']['ignoreme']
                                    ) {
                                        $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                                        $xsigc = count($xsig);
                                        $this_str = $$DataA;
                                        $that_str = $$DataB;
                                        if ($xstrf === 'A') {
                                            $this_str = "\x01" . $this_str;
                                            $that_str = "\x01" . $that_str;
                                            $xsig[0] = "\x01" . $xsig[0];
                                        } elseif ($xstrf !== '*') {
                                            $this_str = substr($this_str, $xstrf * 2);
                                            $that_str = substr($that_str, $xstrf * 2);
                                        }
                                        if ($xstrt !== '*') {
                                            $this_str = substr($this_str, 0, $xstrt * 2);
                                            $that_str = substr($that_str, 0, $xstrt * 2);
                                        }
                                        for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                            if (
                                                !substr_count($this_str, $xsig[$xsigi]) &&
                                                !substr_count($that_str, $xsig[$xsigi])
                                            ) {
                                                continue 2;
                                            }
                                            if ($xsigc > 1) {
                                                if (substr_count($this_str, $xsig[$xsigi])) {
                                                    $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                                }
                                                if (substr_count($that_str, $xsig[$xsigi])) {
                                                    $that_str = substraf($that_str, $xsig[$xsigi] . '>');
                                                }
                                            }
                                        }
                                        $this_str = $that_str = false;
                                        if (!$flagged) {
                                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                            $flagged = true;
                                        }
                                        $heur['detections']++;
                                        $phpMussel['memCache']['detections_count']++;
                                        $out .= $lnap . phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['whyflagged'] .= phpMusselV(
                                            array('vn' => $vn),
                                            $phpMussel['Config']['lang']['detected']
                                        ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    }
                }
            break;
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'regex') {
            if (empty($DataA) || empty($$DataA) || empty($DataALen) || empty($$DataALen)) {
                continue;
            }
            $DataMode = (empty($DataB) || empty($$DataB));
            while (true) {
                if (!isset($phpMussel['memCache'][$SigFile])) {
                    $phpMussel['memCache'][$SigFile] = @file($phpMussel['sigPath'] . $SigFile);
                }
                if (!$phpMussel['memCache'][$SigFile]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigFile]);
                for ($i = 0; $i < $c; $i++) {
                    $xsig = $phpMussel['memCache'][$SigFile][$i];
                    if (substr($xsig, 0, 1) == '>') {
                        $xsig = explode('>', $xsig, 4);
                        $xsig[3] = (int)$xsig[3];
                        if ($xsig[1] == 'FN') {
                            if (!preg_match('/' . $xsig[2] . '/i', $ofn)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FS-MIN') {
                            if ($str_len < $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FS-MAX') {
                            if ($str_len > $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FD') {
                            if (!substr_count($$DataA, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FD-RX') {
                            if (!preg_match('/' . $xsig[2] . '/i', $$DataA)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif (substr($xsig[1], 0, 1) == '$') {
                            $vf = substr($xsig[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        } elseif (substr($xsig[1], 0, 2) == '!$') {
                            $vf = substr($xsig[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                        continue;
                    }
                    if (substr_count($xsig, ':')) {
                        $vn = @explode(':', $xsig);
                        $xsig = @preg_split('/[\x00-\x1f]+/', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                        $xsig = ($xsig === false ? '' : implode('', $xsig));
                        $xlen = strlen($xsig);
                        if (
                            $xlen < $phpMussel['Config']['signatures']['rx_siglen_min'] ||
                            $xlen > $phpMussel['Config']['signatures']['rx_siglen_max']
                        ) {
                            continue;
                        }
                        $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                        $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                        $vn = vn_shorthand($vn[0]);
                        $vnlc = strtolower($vn);
                        if (
                            ($is_not_php && (
                                substr_count($vnlc, '-php') ||
                                substr_count($vnlc, '.php')
                            )) ||
                            ($is_not_html && (
                                substr_count($vnlc, '-htm') ||
                                substr_count($vnlc, '.htm')
                            ))
                        ) {
                            continue;
                        }
                        if ($DataMode) {
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if ($xstrf === '*') {
                                    if ($xstrt === '*') {
                                        if (!preg_match('/' . $xsig . '/i', $$DataA)) {
                                            continue;
                                        }
                                    } elseif (!preg_match('/' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2))) {
                                        continue;
                                    }
                                } elseif ($xstrf === 'A') {
                                    if ($xstrt === '*') {
                                        if (!preg_match('/\A' . $xsig . '/i', $$DataA)) {
                                            continue;
                                        }
                                    } elseif (!preg_match('/\A' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2))) {
                                        continue;
                                    }
                                } else {
                                    if ($xstrt === '*') {
                                        if (!preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2))) {
                                            continue;
                                        }
                                    } elseif (!preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2, $xstrt * 2))) {
                                        continue;
                                    }
                                }
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['memCache']['weighted']) {
                                    $heur['weight']++;
                                    $heur['cli'] .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $heur['web'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                        } else {
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if ($xstrf === '*') {
                                    if ($xstrt === '*') {
                                        if (
                                            !preg_match('/' . $xsig . '/i', $$DataA) &&
                                            !preg_match('/' . $xsig . '/i', $$DataB)
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2)) &&
                                        !preg_match('/' . $xsig . '/i', substr($$DataB, 0, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                } elseif ($xstrf === 'A') {
                                    if ($xstrt === '*') {
                                        if (
                                            !preg_match('/\A' . $xsig . '/i', $$DataA) &&
                                            !preg_match('/\A' . $xsig . '/i', $$DataB)
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/\A' . $xsig . '/i', substr($$DataA, 0, $xstrt * 2)) &&
                                        !preg_match('/\A' . $xsig . '/i', substr($$DataB, 0, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                } else {
                                    if ($xstrt === '*') {
                                        if (
                                            !preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2)) &&
                                            !preg_match('/' . $xsig . '/i', substr($$DataB, $xstrf * 2))
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/' . $xsig . '/i', substr($$DataA, $xstrf * 2, $xstrt * 2)) &&
                                        !preg_match('/' . $xsig . '/i', substr($$DataB, $xstrf * 2, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                }
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['memCache']['weighted']) {
                                    $heur['weight']++;
                                    $heur['cli'] .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $heur['web'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
                break;
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'standard') {
            if (empty($DataA) || empty($$DataA) || empty($DataALen) || empty($$DataALen)) {
                continue;
            }
            $DataMode = (empty($DataB) || empty($$DataB));
            while (true) {
                if (!isset($phpMussel['memCache'][$SigFile])) {
                    $phpMussel['memCache'][$SigFile] = @file($phpMussel['sigPath'] . $SigFile);
                }
                if (!$phpMussel['memCache'][$SigFile]) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                        }
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        return (!$n) ? -3 :
                            $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $SigFile . ')' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigFile]);
                for ($i = 0; $i < $c; $i++) {
                    $xsig = $phpMussel['memCache'][$SigFile][$i];
                    if (substr($xsig, 0, 1) == '>') {
                        $xsig = explode('>', $xsig, 4);
                        if (!isset($xsig[1]) || !isset($xsig[2]) || !isset($xsig[3])) {
                            break;
                        }
                        $xsig[3] = (int)$xsig[3];
                        if ($xsig[1] == 'FN') {
                            if (!preg_match('/' . $xsig[2] . '/i', $ofn)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FS-MIN') {
                            if ($str_len < $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FS-MAX') {
                            if ($str_len > $xsig[2]) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FD') {
                            if (!substr_count($$DataA, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'FD-RX') {
                            if (!preg_match('/' . $xsig[2] . '/i', $$DataA)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif (substr($xsig[1], 0, 1) == '$') {
                            $vf = substr($xsig[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $xsig[2]) {
                                    if ($xsig[3] <= $i)break;
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        } elseif (substr($xsig[1], 0, 2) == '!$') {
                            $vf = substr($xsig[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        } else {
                            break;
                        }
                        continue;
                    }
                    if (substr_count($xsig, ':')) {
                        $vn = @explode(':', $xsig);
                        $xsig = @preg_split('/[^a-fA-F0-9>]+/i', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                        $xsig = ($xsig === false ? '' : implode('', $xsig));
                        $xlen = strlen($xsig);
                        if (
                            $xlen < $phpMussel['Config']['signatures']['sd_siglen_min'] ||
                            $xlen > $phpMussel['Config']['signatures']['sd_siglen_max']
                        ) {
                            continue;
                        }
                        $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                        $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                        $vn = vn_shorthand($vn[0]);
                        $vnlc = strtolower($vn);
                        if (
                            ($is_not_php && (
                                substr_count($vnlc, '-php') ||
                                substr_count($vnlc, '.php')
                            )) ||
                            ($is_not_html && (
                                substr_count($vnlc, '-htm') ||
                                substr_count($vnlc, '.htm')
                            )) ||
                            ($$DataALen < $xlen)
                        ) {
                            continue;
                        }
                        if ($DataMode) {
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                                $xsigc = count($xsig);
                                $this_str = $$DataA;
                                if ($xstrf === 'A') {
                                    $this_str = "\x01" . $this_str;
                                    $xsig[0] = "\x01" . $xsig[0];
                                } elseif ($xstrf !== '*') {
                                    $this_str = substr($this_str, $xstrf * 2);
                                }
                                if ($xstrt !== '*') {
                                    $this_str = substr($this_str, 0, $xstrt * 2);
                                }
                                for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                    if (!substr_count($this_str, $xsig[$xsigi])) {
                                        continue 2;
                                    }
                                    if ($xsigc > 1 && substr_count($this_str, $xsig[$xsigi])) {
                                        $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                    }
                                }
                                $this_str = false;
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['memCache']['weighted']) {
                                    $heur['weight']++;
                                    $heur['cli'] .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $heur['web'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                        } else {
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                                $xsigc = count($xsig);
                                $this_str = $$DataA;
                                $that_str = $$DataB;
                                if ($xstrf === 'A') {
                                    $this_str = "\x01" . $this_str;
                                    $that_str = "\x01" . $that_str;
                                    $xsig[0] = "\x01" . $xsig[0];
                                } elseif ($xstrf !== '*') {
                                    $this_str = substr($this_str, $xstrf * 2);
                                    $that_str = substr($that_str, $xstrf * 2);
                                }
                                if ($xstrt !== '*') {
                                    $this_str = substr($this_str, 0, $xstrt * 2);
                                    $that_str = substr($that_str, 0, $xstrt * 2);
                                }
                                for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                    if (
                                        !substr_count($this_str, $xsig[$xsigi]) &&
                                        !substr_count($that_str, $xsig[$xsigi])
                                    ) {
                                        continue 2;
                                    }
                                    if ($xsigc > 1) {
                                        if (substr_count($this_str, $xsig[$xsigi])) {
                                            $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                        }
                                        if (substr_count($that_str, $xsig[$xsigi])) {
                                            $that_str = substraf($that_str, $xsig[$xsigi] . '>');
                                        }
                                    }
                                }
                                $this_str = $that_str = false;
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['memCache']['weighted']) {
                                    $heur['weight']++;
                                    $heur['cli'] .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $heur['web'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
                break;
            }
        } elseif ($SigData[$SigSet]['SigMode'] === 'urlscanner') {
            $urlscanner = array();
            $urlscanner['req_c'] =
            $urlscanner['domains_c'] =
            $urlscanner['urls_c'] = 0;
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] = phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                $urlscanner['domains_p'] =
                $urlscanner['domains'] =
                $urlscanner['tlds'] = array();
                $urlscanner['z'] = 0;
                $urlscanner['c'] = preg_match_all(
                    '/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,' .
                    '3}\.)?([0-9a-z.-]{1,512})[^0-9a-z.-]/i',
                    $str_norm,
                    $urlscanner['m']
                );
                for ($urlscanner['i'] = 0; $urlscanner['c'] > $urlscanner['i']; $urlscanner['i']++) {
                    $urlscanner['this'] =
                        md5($urlscanner['m'][3][$urlscanner['i']]) . ':' .
                        strlen($urlscanner['m'][3][$urlscanner['i']]) . ':';
                    $urlscanner['domains_nolookup'] =
                        'DOMAIN-NOLOOKUP:' . $urlscanner['this'];
                    if (!substr_count($phpMussel['memCache'][$SigFile], $urlscanner['domains_nolookup'])) {
                        $urlscanner['domains_p'][$urlscanner['z']] = $urlscanner['m'][3][$urlscanner['i']];
                        if (substr_count($urlscanner['domains_p'][$urlscanner['z']], '.')) {
                            $urlscanner['tlds'][$urlscanner['z']] =
                                substral($urlscanner['domains_p'][$urlscanner['z']], '.');
                        }
                        $urlscanner['domains'][$urlscanner['z']] =
                            'DOMAIN:' . $urlscanner['this'];
                        $urlscanner['z']++;
                    }
                }
                $urlscanner['m'] = '';
                $urlscanner['domains_p'] = array_unique($urlscanner['domains_p']);
                $urlscanner['domains'] = array_unique($urlscanner['domains']);
                $urlscanner['tlds'] = array_unique($urlscanner['tlds']);
                sort($urlscanner['domains_p']);
                sort($urlscanner['domains']);
                sort($urlscanner['tlds']);
                $urlscanner['tldc'] = count($urlscanner['tlds']);
                for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['tldc']; $urlscanner['i']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], 'TLD:' . $urlscanner['tlds'][$urlscanner['i']] . ':')) {
                        $xsig =
                            substraf($phpMussel['memCache'][$SigFile], 'TLD:' . $urlscanner['tlds'][$urlscanner['i']] . ':');
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            $xsig &&
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                            break;
                        }
                    }
                }
                $urlscanner['domains_c'] = count($urlscanner['domains']);
                for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['domains_c']; $urlscanner['i']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], $urlscanner['domains'][$urlscanner['i']])) {
                        $xsig =
                            substraf($phpMussel['memCache'][$SigFile], $urlscanner['domains'][$urlscanner['i']]);
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            $xsig &&
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                            break;
                        }
                    }
                }
                $xsig = '';
                $urlscanner['urls_p'] =
                $urlscanner['urls'] =
                $urlscanner['queries'] = array();
                $urlscanner['z'] = 0;
                $urlscanner['c'] = preg_match_all(
                    '/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,' .
                    '3}\.)?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4096})(\&quot;|[;' .
                    '"\'\(\)\[\]\{\}])/i',
                    $str_norm,
                    $urlscanner['m']
                );
                for ($urlscanner['i'] = 0; $urlscanner['c'] > $urlscanner['i']; $urlscanner['i']++) {
                    $urlscanner['this'] =
                        md5($urlscanner['m'][3][$urlscanner['i']]) . ':' .
                        strlen($urlscanner['m'][3][$urlscanner['i']]) . ':';
                    $urlscanner['urls_nolookup'] =
                        'URL-NOLOOKUP:' . $urlscanner['this'];
                    if (!substr_count($phpMussel['memCache'][$SigFile], $urlscanner['urls_nolookup'])) {
                        $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['m'][3][$urlscanner['i']];
                        $urlscanner['urls'][$urlscanner['z']] =
                            'URL:' . $urlscanner['this'];
                        $urlscanner['z']++;
                    }
                    if (preg_match('/[^0-9a-z.-]$/i', $urlscanner['m'][3][$urlscanner['i']])) {
                        $urlscanner['x'] =
                            preg_replace('/[^0-9a-z.-]+$/i', '', $urlscanner['m'][3][$urlscanner['i']]);
                        $urlscanner['this'] =
                            md5($urlscanner['x']) . ':' .
                            strlen($urlscanner['x']) . ':';
                        $urlscanner['urls_nolookup'] =
                            'URL-NOLOOKUP:' . $urlscanner['this'];
                        if (!substr_count($phpMussel['memCache'][$SigFile], $urlscanner['urls_nolookup'])) {
                            $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['x'];
                            $urlscanner['urls'][$urlscanner['z']] =
                                'URL:' . $urlscanner['this'];
                            $urlscanner['z']++;
                        }
                    }
                    if (substr_count($urlscanner['m'][3][$urlscanner['i']], '?')) {
                        $urlscanner['x'] =
                            substrbf($urlscanner['m'][3][$urlscanner['i']], '?');
                        $urlscanner['this'] =
                            md5($urlscanner['x']) . ':' .
                            strlen($urlscanner['x']) . ':';
                        $urlscanner['urls_nolookup'] =
                            'URL-NOLOOKUP:' . $urlscanner['this'];
                        if (!substr_count($phpMussel['memCache'][$SigFile], $urlscanner['urls_nolookup'])) {
                            $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['x'];
                            $urlscanner['urls'][$urlscanner['z']] =
                                'URL:' . $urlscanner['this'];
                        }
                        $urlscanner['x'] =
                            substraf($urlscanner['m'][3][$urlscanner['i']], '?');
                        $urlscanner['queries'][$urlscanner['z']] =
                            'QUERY:' . md5($urlscanner['x']) . ':' .
                            strlen($urlscanner['x']) . ':';
                        $urlscanner['z']++;
                    }
                }
                $urlscanner['m'] = '';
                $urlscanner['urls_p'] = array_unique($urlscanner['urls_p']);
                $urlscanner['urls'] = array_unique($urlscanner['urls']);
                $urlscanner['queries'] = array_unique($urlscanner['queries']);
                sort($urlscanner['urls_p']);
                sort($urlscanner['urls']);
                sort($urlscanner['queries']);
                $urlscanner['urls_c'] = count($urlscanner['urls']);
                for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['urls_c']; $urlscanner['i']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], $urlscanner['urls'][$urlscanner['i']])) {
                        $xsig =
                            substraf($phpMussel['memCache'][$SigFile], $urlscanner['urls'][$urlscanner['i']]);
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            $xsig &&
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                            break;
                        }
                    }
                }
                $urlscanner['queries_c'] = count($urlscanner['queries']);
                for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['queries_c']; $urlscanner['i']++) {
                    if (substr_count($phpMussel['memCache'][$SigFile], $urlscanner['queries'][$urlscanner['i']])) {
                        $xsig =
                            substraf($phpMussel['memCache'][$SigFile], $urlscanner['queries'][$urlscanner['i']]);
                        if (substr_count($xsig, "\n")) {
                            $xsig = substrbf($xsig, "\n");
                        }
                        $xsig = vn_shorthand($xsig);
                        if (
                            $xsig &&
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $heur['detections']++;
                            $phpMussel['memCache']['detections_count']++;
                            if ($phpMussel['memCache']['weighted']) {
                                $heur['weight']++;
                                $heur['cli'] .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $heur['web'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            } else {
                                $out .= $lnap . phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['whyflagged'] .= phpMusselV(
                                    array('vn' => $xsig),
                                    $phpMussel['Config']['lang']['detected']
                                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                            break;
                        }
                    }
                }
                $urlscanner['domains_c'] = count($urlscanner['domains_p']);
            }
            if (
                !$out &&
                $phpMussel['Config']['urlscanner']['lookup_hphosts'] &&
                $urlscanner['domains_c'] &&
                !empty($SigData[$SigSet]['UseAPI'])
            ) {
                if (!isset($phpMussel['memCache']['urlscanner_domains'])) {
                    $phpMussel['memCache']['urlscanner_domains'] =
                        phpMusselCacheGet('urlscanner_domains');
                }
                $urlscanner['y'] =
                    $phpMussel['time'] + $phpMussel['Config']['urlscanner']['cache_time'];
                $urlscanner['req_v'] = urlencode($phpMussel['ScriptIdent']);
                $urlscanner['classes'] = array(
                    'EMD' => "\x1a\x82\x10\x1bXXX",
                    'EXP' => "\x1a\x82\x10\x16XXX",
                    'GRM' => "\x1a\x82\x10\x32XXX",
                    'HFS' => "\x1a\x82\x10\x32XXX",
                    'PHA' => "\x1a\x82\x10\x32XXX",
                    'PSH' => "\x1a\x82\x10\x31XXX"
                );
                for ($i = 0; $i < $urlscanner['domains_c'];$i++) {
                    if (
                        $phpMussel['Config']['urlscanner']['maximum_api_lookups'] > 0 &&
                        $urlscanner['req_c'] > $phpMussel['Config']['urlscanner']['maximum_api_lookups']
                    ) {
                        if ($phpMussel['Config']['urlscanner']['maximum_api_lookups_response']) {
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $out .=
                                $lnap . $phpMussel['Config']['lang']['too_many_urls'] .
                                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['too_many_urls'] .
                                ' (' . $ofnSafe . ')' .
                                $phpMussel['Config']['lang']['_exclamation'];
                        }
                        break;
                    }
                    $urlscanner['this'] =
                        md5($urlscanner['domains_p'][$i]) . ':' .
                        strlen($urlscanner['domains_p'][$i]) . ':';
                    if (substr_count($phpMussel['memCache']['urlscanner_domains'], $urlscanner['this'])) {
                        $urlscanner['class'] =
                            substrbf(substral($phpMussel['memCache']['urlscanner_domains'], $urlscanner['this']), ';');
                        $urlscanner['expiry'] =
                            substrbf($urlscanner['class'],':');
                        if ($urlscanner['expiry'] > $phpMussel['time']) {
                            $urlscanner['class'] =
                                substraf($urlscanner['class'],':');
                            if (!$urlscanner['class']) {
                                continue;
                            }
                            $urlscanner['class'] =
                                vn_shorthand($urlscanner['class']);
                            if (!$flagged) {
                                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                $flagged = true;
                            }
                            $out .= $lnap . phpMusselV(
                                array('vn' => $urlscanner['class']),
                                $phpMussel['Config']['lang']['detected']
                            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                            $phpMussel['whyflagged'] .= phpMusselV(
                                array('vn' => $urlscanner['class']),
                                $phpMussel['Config']['lang']['detected']
                            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            break;
                        }
                    }
                    $urlscanner['req'] =
                        'v=' . $urlscanner['req_v'] .
                        '&s=' . $urlscanner['domains_p'][$i] .
                        '&class=true';
                    $urlscanner['req_context'] = array(
                        'http' => array(
                            'method' => 'POST',
                            'header' => 'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1',
                            'user_agent' => $phpMussel['ScriptUA'],
                            'content' => $urlscanner['req'],
                            'timeout' => 12
                        )
                    );
                    $urlscanner['req_stream'] =
                        stream_context_create($urlscanner['req_context']);
                    $urlscanner['req_result'] = @file_get_contents(
                        'http://verify.hosts-file.net/?' . $urlscanner['req'],
                        false,
                        $urlscanner['req_stream']
                    );
                    $urlscanner['req_c']++;
                    if (substr($urlscanner['req_result'], 0, 6) == "Listed") {
                        $urlscanner['class'] =
                            substr($urlscanner['req_result'], 7, 3);
                        $urlscanner['class'] =
                            (isset($urlscanner['classes'][$urlscanner['class']])) ?
                            $urlscanner['classes'][$urlscanner['class']] :
                            "\x1a\x82\x10\x3fXXX";
                        $phpMussel['memCache']['urlscanner_domains'] .=
                            $urlscanner['this'] .
                            $urlscanner['y'] . ':' .
                            $urlscanner['class'] . ';';
                        $urlscanner['class'] =
                            vn_shorthand($urlscanner['class']);
                        if (!$flagged) {
                            $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                            $flagged = true;
                        }
                        $out .= $lnap . phpMusselV(
                            array('vn' => $urlscanner['class']),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                        $phpMussel['whyflagged'] .= phpMusselV(
                            array('vn' => $urlscanner['class']),
                            $phpMussel['Config']['lang']['detected']
                        ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                    $phpMussel['memCache']['urlscanner_domains'] .=
                        $urlscanner['domains'][$i] . $urlscanner['y'] . ':;';
                }
                $urlscanner['y'] =
                    phpMusselCacheSet('urlscanner_domains', $urlscanner['y'], $phpMussel['memCache']['urlscanner_domains']);
            }
            // $urlscanner['urls_c'] = count($urlscanner['urls_p']);
            if (
                !$out &&
                $phpMussel['Config']['urlscanner']['google_api_key'] &&
                $urlscanner['urls_c'] &&
                !empty($SigData[$SigSet]['UseAPI'])
            ) {
                /* v Incomplete code, doesn't work yet. v
                $urlscanner['req'] =
                    $urlscanner['urls_c'] . "\n" . 'http://' .
                    implode("\n" . 'http://', $urlscanner['urls_p']);
                $urlscanner['req_context'] = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1',
                        'user_agent' => $phpMussel['ScriptUA'],
                        'content' => $urlscanner['req'],
                        'timeout' => 12
                    )
                );
                $urlscanner['req_stream'] =
                    stream_context_create($urlscanner['req_context']);
                $urlscanner['req_result'] = file_get_contents(
                    'https://sb-ssl.google.com/safebrowsing/api/lookup?client=phpMussel&key=' .
                    $phpMussel['Config']['urlscanner']['google_api_key'] .
                    '&appver=' . $phpMussel['ScriptVersion'] .
                    '&pver=3.1',
                    false,
                    $urlscanner['req_stream']
                );
                $urlscanner['req_c']++;
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $out .= $lnap . phpMusselV(
                    array('vn' => $urlscanner['req_result']),
                    $phpMussel['Config']['lang']['detected']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('vn' => $urlscanner['req_result']),
                    $phpMussel['Config']['lang']['detected']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                   ^ Incomplete code, doesn't work yet. ^ */
            }
            $urlscanner = '';
        } elseif ($SigData[$SigSet]['SigMode'] === 'coex') {
            if (!isset($phpMussel['memCache'][$SigFile])) {
                $phpMussel['memCache'][$SigFile] =
                    phpMusselFile($phpMussel['sigPath'] . $SigFile);
            }
            if (!$phpMussel['memCache'][$SigFile]) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (' . $SigFile . ')' .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
            } else {
                $coexi = 0;
                $signame = '';
                while (true) {
                    $coexi++;
                    if (
                        $coexi === 1 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$md5:' . $md5 . ';')
                    ) {
                        $xsig = explode("\n" . '$md5:' . $md5 . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 2 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$str_len:' . $str_len . ';')
                    ) {
                        $xsig = explode("\n" . '$str_len:' . $str_len . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 3 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$fourcc:' . $fourcc . ';')
                    ) {
                        $xsig = explode("\n" . '$fourcc:' . $fourcc . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 4 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$twocc:' . $twocc . ';')
                    ) {
                        $xsig = explode("\n" . '$twocc:' . $twocc . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 5 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$phase:' . $phase . ';')
                    ) {
                        $xsig = explode("\n" . '$phase:' . $phase . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 6 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$xt:' . $xt . ';')
                    ) {
                        $xsig = explode("\n" . '$xt:' . $xt . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 7 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$sha:' . $sha . ';')
                    ) {
                        $xsig = explode("\n" . '$sha:' . $sha . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 8 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$crc:' . $crc . ';')
                    ) {
                        $xsig = explode("\n" . '$crc:' . $crc . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 9 &&
                        $is_html &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_html:1;')
                    ) {
                        $xsig = explode("\n" . '$is_html:1;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 9 &&
                        !$is_html &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_html:0;')
                    ) {
                        $xsig = explode("\n" . '$is_html:0;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 10 &&
                        $is_graphics &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_graphics:1;')
                    ) {
                        $xsig = explode("\n" . '$is_graphics:1;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 10 &&
                        !$is_graphics &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_graphics:0;')
                    ) {
                        $xsig = explode("\n" . '$is_graphics:0;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 11 &&
                        $is_pe &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_pe:1;')
                    ) {
                        $xsig = explode("\n" . '$is_pe:1;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 11 &&
                        !$is_pe &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_pe:0;')
                    ) {
                        $xsig = explode("\n" . '$is_pe:0;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 12 &&
                        $is_macho &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_macho:1;')
                    ) {
                        $xsig = explode("\n" . '$is_macho:1;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 12 &&
                        !$is_macho &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$is_macho:0;')
                    ) {
                        $xsig = explode("\n" . '$is_macho:0;', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 13 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$xts:' . $xts . ';')
                    ) {
                        $xsig = explode("\n" . '$xts:' . $xts . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 14 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$NumOfSections:' . $NumOfSections . ';')
                    ) {
                        $xsig = explode("\n" . '$NumOfSections:' . $NumOfSections . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif (
                        $coexi === 15 &&
                        substr_count($phpMussel['memCache'][$SigFile], "\n" . '$container:' . $container . ';')
                    ) {
                        $xsig = explode("\n" . '$container:' . $container . ';', $phpMussel['memCache'][$SigFile]);
                    } elseif ($coexi > 15) {
                        break;
                    } else {
                        $xsig = array();
                    }
                    $xc = count($xsig);
                    if (isset($xsig[0])) {
                        $xsig[0] = '';
                    }
                    if ($xc > 0) {
                        for ($xi = 1; $xi < $xc; $xi++) {
                            if (substr_count($xsig[$xi], "\n")) {
                                $xsig[$xi] = substrbf($xsig[$xi], "\n");
                            }
                            if (substr_count($xsig[$xi], ';')) {
                                if (!substr_count($xsig[$xi], ':')) {
                                    continue;
                                }
                                $signame = vn_shorthand(substral($xsig[$xi], ';'));
                                $xsig[$xi] = explode(';', substrbl($xsig[$xi], ';'));
                                $sxc = count($xsig[$xi]);
                            } else {
                                $signame = vn_shorthand($xsig[$xi]);
                                $xsig[$xi] = '';
                                $sxc = 0;
                            }
                            if ($sxc > 0) {
                                for ($sxi = 0; $sxi < $sxc; $sxi++) {
                                    $xsig[$xi][$sxi] = explode(':', $xsig[$xi][$sxi], 7);
                                    if ($xsig[$xi][$sxi][0] === 'LV') {
                                        if (!isset($xsig[$xi][$sxi][1]) || substr($xsig[$xi][$sxi][1], 0, 1) !== '$') {
                                            continue 2;
                                        }
                                        $lv_haystack = substr($xsig[$xi][$sxi][1], 1);
                                        if (!isset($$lv_haystack) || is_array($$lv_haystack)) {
                                            continue 2;
                                        }
                                        $lv_haystack = $$lv_haystack;
                                        if ($climode) {
                                            $lv_haystack = substral(substral($lv_haystack, "/"), "\\");
                                        }
                                        $lv_needle = (isset($xsig[$xi][$sxi][2])) ? $xsig[$xi][$sxi][2] : '';
                                        $pos_A = (isset($xsig[$xi][$sxi][3])) ? $xsig[$xi][$sxi][3] : 0;
                                        $pos_Z = (isset($xsig[$xi][$sxi][4])) ? $xsig[$xi][$sxi][4] : 0;
                                        $lv_min = (isset($xsig[$xi][$sxi][5])) ? $xsig[$xi][$sxi][5] : 0;
                                        $lv_max = (isset($xsig[$xi][$sxi][6])) ? $xsig[$xi][$sxi][6] : -1;
                                        if (!lv_match($lv_needle, $lv_haystack, $pos_A, $pos_Z, $lv_min, $lv_max)) {
                                            continue 2;
                                        }
                                    } elseif (isset($xsig[$xi][$sxi][2])) {
                                        if (isset($xsig[$xi][$sxi][3])) {
                                            if ($xsig[$xi][$sxi][2] == 'A') {
                                                if (
                                                    !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $xsig[$xi][$sxi][0] . ',') || (
                                                        $xsig[$xi][$sxi][0] == 'FD' &&
                                                        !substr_count("\x01" . substr($str_hex, 0, $xsig[$xi][$sxi][3] * 2), "\x01" . $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-RX' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex, 0, $xsig[$xi][$sxi][3] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM' &&
                                                        !substr_count("\x01" . substr($str_hex_norm, 0, $xsig[$xi][$sxi][3] * 2), "\x01" . $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM-RX' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex_norm, 0, $xsig[$xi][$sxi][3] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'META' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', substr($CoExMeta, 0, $xsig[$xi][$sxi][3] * 2))
                                                    )
                                                ) {
                                                    continue 2;
                                                }
                                            } else {
                                                if (
                                                    !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $xsig[$xi][$sxi][0] . ',') || (
                                                        $xsig[$xi][$sxi][0] == 'FD' &&
                                                        !substr_count(substr($str_hex, $xsig[$xi][$sxi][2] * 2, $xsig[$xi][$sxi][3] * 2), $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-RX' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex, $xsig[$xi][$sxi][2] * 2, $xsig[$xi][$sxi][3] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM' &&
                                                        !substr_count(substr($str_hex_norm, $xsig[$xi][$sxi][2] * 2, $xsig[$xi][$sxi][3] * 2), $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM-RX' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex_norm, $xsig[$xi][$sxi][2] * 2, $xsig[$xi][$sxi][3] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'META' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($CoExMeta, $xsig[$xi][$sxi][2] * 2, $xsig[$xi][$sxi][3] * 2))
                                                    )
                                                ) {
                                                    continue 2;
                                                }
                                            }
                                        } else {
                                            if ($xsig[$xi][$sxi][2] == 'A') {
                                                if (
                                                    !substr_count(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $xsig[$xi][$sxi][0] . ',') || (
                                                        $xsig[$xi][$sxi][0] == 'FN' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', $ofn)
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD' &&
                                                        !substr_count("\x01" . $str_hex, "\x01" . $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-RX' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', $str_hex)
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM' &&
                                                        !substr_count("\x01" . $str_hex_norm, "\x01" . $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM-RX' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', $str_hex_norm)
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'META' &&
                                                        !preg_match('/\A' . $xsig[$xi][$sxi][1] . '/i', $CoExMeta)
                                                    )
                                                ) {
                                                    continue 2;
                                                }
                                            } else {
                                                if (
                                                    !substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $xsig[$xi][$sxi][0] . ',') || (
                                                        $xsig[$xi][$sxi][0] == 'FD' &&
                                                        !substr_count(substr($str_hex, $xsig[$xi][$sxi][2] * 2), $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-RX' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex, $xsig[$xi][$sxi][2] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM' &&
                                                        !substr_count(substr($str_hex_norm, $xsig[$xi][$sxi][2] * 2), $xsig[$xi][$sxi][1])
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'FD-NORM-RX' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($str_hex_norm, $xsig[$xi][$sxi][2] * 2))
                                                    ) || (
                                                        $xsig[$xi][$sxi][0] == 'META' &&
                                                        !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', substr($CoExMeta, $xsig[$xi][$sxi][2] * 2))
                                                    )
                                                ) {
                                                    continue 2;
                                                }
                                            }
                                        }
                                    } else {
                                        if (
                                            (
                                                $xsig[$xi][$sxi][0] == 'FN' &&
                                                !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', $ofn)
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FS-MIN' &&
                                                $str_len < $xsig[$xi][$sxi][1]
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FS-MAX' &&
                                                $str_len > $xsig[$xi][$sxi][1]
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FD' &&
                                                !substr_count($str_hex, $xsig[$xi][$sxi][1])
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FD-RX' &&
                                                !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', $str_hex)
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FD-NORM' &&
                                                !substr_count($str_hex_norm, $xsig[$xi][$sxi][1])
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'FD-NORM-RX' &&
                                                !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', $str_hex_norm)
                                            ) || (
                                                $xsig[$xi][$sxi][0] == 'META' &&
                                                !preg_match('/' . $xsig[$xi][$sxi][1] . '/i', $CoExMeta)
                                            )
                                        ) {
                                            continue 2;
                                        }
                                        if (substr($xsig[$xi][$sxi][0], 0, 1) == '$') {
                                            $vf = substr($xsig[$xi][$sxi][0], 1);
                                            if (!isset($$vf) || is_array($$vf) || $$vf != $xsig[$xi][$sxi][1]) {
                                                continue 2;
                                            }
                                        } elseif (substr($xsig[$xi][$sxi][0], 0, 2) == '!$') {
                                            $vf = substr($xsig[$xi][$sxi][0], 2);
                                            if (!isset($$vf) || is_array($$vf) || $$vf == $xsig[$xi][$sxi][1]) {
                                                continue 2;
                                            }
                                        } elseif (!substr_count(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,', ',' . $xsig[$xi][$sxi][0] . ',')) {
                                            continue 2;
                                        }
                                    }
                                }
                            }
                            if (
                                $signame &&
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $signame . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['memCache']['weighted']) {
                                    $heur['weight']++;
                                    $heur['cli'] .= $lnap . phpMusselV(
                                        array('vn' => $signame),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $heur['web'] .= phpMusselV(
                                        array('vn' => $signame),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $signame),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $signame),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                            $xsig[$xi] = '';
                        }
                    }
                }
            }
            $sxi = $sxc = $signame = $xi = $xc = $xsig = $coexi = '';
        }
    }

    unset(
        $PEArr,
        $phpMussel['memCache']['xmlxdp'][$md5]
    );

    /** PHP chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_from_php']) {
        if (
            !(
                substr_count(',cvd,inc,md,phar,pzp,tpl,txt,tzt,', ',' . $xt . ',') ||
                substr_count(',php*,', ',' . $xts . ',') ||
                substr_count(',cvd,inc,md,phar,pzp,tpl,txt,tzt,', ',' . $gzxt . ',') ||
                substr_count(',php*,', ',' . $gzxts . ',') ||
                substr_count(',' . $phpMussel['Config']['attack_specific']['archive_file_extensions_wc'] . ',', ',' . $xts . ',') ||
                substr_count(',' . $phpMussel['Config']['attack_specific']['archive_file_extensions_wc'] . ',', ',' . $gzxts . ',') ||
                substr_count(',' . $phpMussel['Config']['attack_specific']['archive_file_extensions'] . ',', ',' . $xt . ',') ||
                substr_count(',' . $phpMussel['Config']['attack_specific']['archive_file_extensions'] . ',', ',' . $gzxt . ',')
            ) &&
            substr_count($str_hex_norm,'3c3f706870')
        ) {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['memCache']['detections_count']++;
            $out .= $lnap . phpMusselV(
                array('x' => 'PHP'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $phpMussel['whyflagged'] .= phpMusselV(
                array('x' => 'PHP'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        }
    }

    /** Executable chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_from_exe']) {
        if (substr_count(',acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,', ',' . $xt . ',')) {
            if ($twocc !== '4d5a') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'EXE'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'EXE'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        } elseif ($twocc === '4d5a') {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['memCache']['detections_count']++;
            $out .= $lnap . phpMusselV(
                array('x' => 'EXE'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $phpMussel['whyflagged'] .= phpMusselV(
                array('x' => 'EXE'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        }
        if ($xt === 'elf') {
            if ($fourcc !== '7f454c46') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'ELF'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'ELF'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        } elseif ($fourcc === '7f454c46') {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['memCache']['detections_count']++;
            $out .= $lnap . phpMusselV(
                array('x' => 'ELF'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $phpMussel['whyflagged'] .= phpMusselV(
                array('x' => 'ELF'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        }
        if ($xt === 'lnk') {
            if (substr($str_hex, 0, 16) !== '4c00000001140200') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'LNK'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'LNK'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        } elseif (substr($str_hex, 0, 16) === '4c00000001140200') {
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $heur['detections']++;
            $phpMussel['memCache']['detections_count']++;
            $out .= $lnap . phpMusselV(
                array('x' => 'LNK'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $phpMussel['whyflagged'] .= phpMusselV(
                array('x' => 'LNK'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        }
        if ($xt === 'msi') {
            if (substr($str_hex, 0, 16) !== 'd0cf11e0a1b11ae1') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'MSI'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'MSI'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
    }

    /** Archive chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_archive']) {
        if ($xts === 'zip*') {
            if ($twocc !== '504b') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'ZIP'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'ZIP'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'rar') {
            if ($fourcc !== '52617221' && $fourcc !== '52457e5e') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'RAR'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'RAR'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'gz') {
            if ($twocc !== '1f8b') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'GZIP'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'GZIP'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'bz2') {
            if (substr($str_hex,0,6) !== '425a68') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'BZIP2'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'BZIP2'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
    }

    /** Office document chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_doc']) {
        if (substr_count(',doc,dot,pps,ppt,xla,xls,wiz,', ',' . $xt . ',')) {
            if ($fourcc !== 'd0cf11e0') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => 'Office'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => 'Office'),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
    }

    /** Image chameleon attack detection. */
    if ($phpMussel['Config']['attack_specific']['chameleon_to_img']) {
        if ($xt === 'bmp' || $xt === 'dib') {
            if ($twocc !== '424d') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'gif') {
            if (substr($str_hex, 0, 12) !== '474946383761' && substr($str_hex, 0, 12) !== '474946383961') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if (
            $xt === 'jfi' ||
            $xt === 'jfif' ||
            $xt === 'jif' ||
            $xt === 'jpe' ||
            $xt === 'jpeg' ||
            $xt === 'jpg'
        ) {
            if (substr($str_hex,0,6) !== 'ffd8ff') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'jp2') {
            if (substr($str_hex, 0, 16) !== '0000000c6a502020') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'pdd' || $xt === 'psd') {
            if ($fourcc !== '38425053') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'png') {
            if ($fourcc !== '89504e47') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'webp') {
            if ($fourcc !== '52494646' || substr($str, 8, 4) !== 'WEBP') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
        }
        if ($xt === 'xcf') {
            if (substr($str,0,8) !== 'gimp xcf') {
                if (!$flagged) {
                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                    $flagged = true;
                }
                $heur['detections']++;
                $phpMussel['memCache']['detections_count']++;
                $out .= $lnap . phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                $phpMussel['whyflagged'] .= phpMusselV(
                    array('x' => $phpMussel['Config']['lang']['image']),
                    $phpMussel['Config']['lang']['scan_chameleon']
                ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            }
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
            $phpMussel['memCache']['detections_count']++;
            $out .= $lnap . phpMusselV(
                array('x' => 'PDF'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $phpMussel['whyflagged'] .= phpMusselV(
                array('x' => 'PDF'),
                $phpMussel['Config']['lang']['scan_chameleon']
            ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        }
    }

    /** General command detection. */
    if (
        !isset($whitelist['Commands']) &&
        $phpMussel['Config']['attack_specific']['general_commands']
    ) {
        while (true) {
            if (!isset($phpMussel['memCache']['hex_general_commands.csv'])) {
                $phpMussel['memCache']['hex_general_commands.csv'] =
                    @explode(',', phpMusselFile($phpMussel['sigPath'] . 'hex_general_commands.csv'));
            }
            if (!$phpMussel['memCache']['hex_general_commands.csv']) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (hex_general_commands.csv)' . $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                        ' (hex_general_commands.csv)' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
                break;
            }
            $c = count($phpMussel['memCache']['hex_general_commands.csv']);
            if ($c < 1) {
                $phpMussel['memCache']['scan_errors']++;
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ":\n";
                    }
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                        ' (hex_general_commands.csv)' . $phpMussel['Config']['lang']['_exclamation'];
                    return (!$n) ? -3 :
                        $lnap . $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                        ' (hex_general_commands.csv)' . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                }
                break;
            }
            for ($i = 0; $i < $c; $i++) {
                if (substr_count($str_hex_norm, $phpMussel['memCache']['hex_general_commands.csv'][$i])) {
                    $xgc = @hex2bin($phpMussel['memCache']['hex_general_commands.csv'][$i]);
                    if (!$flagged) {
                        $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                        $flagged = true;
                    }
                    $heur['detections']++;
                    $phpMussel['memCache']['detections_count']++;
                    $out .=
                        $lnap . $phpMussel['Config']['lang']['scan_command_injection'] .
                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['scan_command_injection'] .
                        ', \'' . $xgc . '\' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                }
            }
            break;
        }
    }

    /** Control character detection. */
    if ($phpMussel['Config']['attack_specific']['block_control_characters']) {
        if (preg_match('/[\x00-\x08\x0b\x0c\x0e\x1f\x7f]/i', $str)) {
            $out .=
                $lnap .
                $phpMussel['Config']['lang']['detected_control_characters'] .
                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
            $heur['detections']++;
            $phpMussel['memCache']['detections_count']++;
            if (!$flagged) {
                $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                $flagged = true;
            }
            $phpMussel['whyflagged'] .=
                $phpMussel['Config']['lang']['detected_control_characters'] .
                ' (' . $ofnSafe . ')' .
                $phpMussel['Config']['lang']['_exclamation'];
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
        $out
    ) {
        $out .= $heur['cli'];
        $phpMussel['whyflagged'] .= $heur['web'];
    }

    /** Virus Total API integration. */
    if (
        !$out &&
        !empty($phpMussel['Config']['virustotal']['vt_public_api_key'])
    ) {
        $DoScan = false;
        $phpMussel['Config']['virustotal']['vt_suspicion_level'] =
            (int)$phpMussel['Config']['virustotal']['vt_suspicion_level'];
        if ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 0) {
            if ($heur['weight'] > 0) {
                $DoScan = true;
            }
        } elseif ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 1) {
            if (
                $heur['weight'] > 0 ||
                $is_pe ||
                $fileswitch === 'chrome' ||
                $fileswitch === 'java' ||
                $fileswitch === 'docfile' ||
                $fileswitch === 'vt_interest'
            ) {
                $DoScan = true;
            }
        } elseif ($phpMussel['Config']['virustotal']['vt_suspicion_level'] === 2) {
            $DoScan = true;
        }
        if ($DoScan) {
            $vt_weight = array(
                'weight' => 0,
                'cli' => '',
                'web' => ''
            );
            if (!isset($phpMussel['memCache']['vt_quota'])) {
                $phpMussel['memCache']['vt_quota'] = phpMusselCacheGet('vt_quota');
            }
            $x = 0;
            if (!empty($phpMussel['memCache']['vt_quota'])) {
                $phpMussel['memCache']['vt_quota'] = explode(';', $phpMussel['memCache']['vt_quota']);
                $c = count($phpMussel['memCache']['vt_quota']);
                for ($i = 0; $i < $c; $i++) {
                    if ($phpMussel['memCache']['vt_quota'][$i] > $phpMussel['time']) {
                        $x++;
                    } else {
                        $phpMussel['memCache']['vt_quota'][$i] = '';
                    }
                }
                $phpMussel['memCache']['vt_quota'] =
                    implode(';', $phpMussel['memCache']['vt_quota']);
            }
            if ($x < $phpMussel['Config']['virustotal']['vt_quota_rate']) {
                $vts =
                    'apikey=' . urlencode($phpMussel['Config']['virustotal']['vt_public_api_key']) .
                    '&resource=' . $md5;
                $vta = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1',
                        'user_agent' => $phpMussel['ScriptUA'],
                        'content' => $vts,
                        'timeout' => 12
                    )
                );
                $vtx = stream_context_create($vta);
                $vt = @json_decode(
                    file_get_contents(
                        'http://www.virustotal.com/vtapi/v2/file/report?apikey=' .
                        urlencode($phpMussel['Config']['virustotal']['vt_public_api_key']) .
                        '&resource=' . $md5,
                        false,
                        $vtx
                    ), true
                );
                $y = $phpMussel['time'] + ($phpMussel['Config']['virustotal']['vt_quota_time'] * 60);
                $phpMussel['memCache']['vt_quota'] .= $y . ';';
                while (substr_count($phpMussel['memCache']['vt_quota'], ';;')) {
                    $phpMussel['memCache']['vt_quota'] =
                        str_ireplace(';;', ';', $phpMussel['memCache']['vt_quota']);
                }
                $y = phpMusselCacheSet('vt_quota', $y + 60, $phpMussel['memCache']['vt_quota']);
                $vt['response_code'] = (int)$vt['response_code'];
                if (
                    isset($vt['response_code']) &&
                    isset($vt['scans']) &&
                    $vt['response_code'] === 1 &&
                    is_array($vt['scans'])
                ) {
                    $c = count($vt['scans']);
                    for ($i = 0; $i < $c; $i++) {
                        $k = key($vt['scans']);
                        if ($vt['scans'][$k]['detected'] && $vt['scans'][$k]['result']) {
                            $vn = $k . '(VirusTotal)-' . $vt['scans'][$k]['result'];
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if (!$flagged) {
                                    $phpMussel['killdata'] .= $md5 . ':' . $str_len . ':' . $ofn . "\n";
                                    $flagged = true;
                                }
                                $heur['detections']++;
                                $phpMussel['memCache']['detections_count']++;
                                if ($phpMussel['Config']['virustotal']['vt_weighting'] > 0) {
                                    $vt_weight['weight']++;
                                    $vt_weight['web'] .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $vt_weight['cli'].=phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                } else {
                                    $out .= $lnap . phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    $phpMussel['whyflagged'] .= phpMusselV(
                                        array('vn' => $vn),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                                }
                            }
                        }
                        next($vt['scans']);
                    }
                }
                if (
                    $vt_weight['weight'] > 0 &&
                    $vt_weight['weight'] >= $phpMussel['Config']['virustotal']['vt_weighting']
                ) {
                    $out .= $vt_weight['web'];
                    $phpMussel['whyflagged'] .= $vt_weight['cli'];
                }
            }
        }
    }

    /** Plugin hook: "after_vt". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['after_vt']) &&
        $phpMussel['MusselPlugins']['hookcounts']['after_vt'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['after_vt']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['after_vt'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['after_vt']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['after_vt'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['after_vt'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['after_vt'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['after_vt'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['after_vt'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['after_vt']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    if (
        isset($phpMussel['HashCacheData']) &&
        !isset($phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']]) &&
        $phpMussel['Config']['general']['scan_cache_expiry'] > 0
    ) {
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']] = array();
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][0] =
            $phpMussel['HashCacheData'];
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][1] =
            $phpMussel['time'] + $phpMussel['Config']['general']['scan_cache_expiry'];
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][2] =
            (empty($out)) ? '' : bin2hex($out);
        $phpMussel['HashCache']['Data'][$phpMussel['HashCacheData']][3] =
            (empty($phpMussel['whyflagged'])) ? '' : bin2hex($phpMussel['whyflagged']);
    }

    if (!$out) {
        return 1;
    }

    if (
        $phpMussel['Config']['general']['quarantine_key'] &&
        !$phpMussel['Config']['general']['honeypot_mode']
    ) {
        if ($str_len < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)) {
            $qfu = $phpMussel['time'] . '-' . md5($phpMussel['Config']['general']['quarantine_key'] . $crc . $phpMussel['time']);
            @phpMusselQ($str, $phpMussel['Config']['general']['quarantine_key'], $_SERVER[$phpMussel['Config']['general']['ipaddr']], $qfu);
            $phpMussel['killdata'] .= 'Quarantined as "/vault/quarantine/' . $qfu . '.qfu".' . "\n";
        }
    }

    return (!$n) ? 2 : $out;
}

/**
 * This function (`phpMusselR()`, or, the phpMussel recursor) is one of two sub-functions of the core scanning function
 * of phpMussel (`phpMussel()`).
 *
 * `phpMusselR()` handles metadata-based and non-signature-based detections, and performs the preparations necessary
 * for scanning files (such as reading the contents of files prior to checking the contents of files against anti-virus
 * signatures). Additionally, it performs all necessary whitelist, blacklist and greylist checks, filesize and file
 * extension-based checks, and handles the processing and extraction of files from archives, fetching the files
 * contained in archives being scanned in order to process those contained files as so that they, too, may be scanned.
 *
 * When phpMussel is instructed to scan a directory or an array of multiple files, the phpMussel recursor is the
 * function responsible for iterating through that directory and/or array in order to scan each object required to be
 * scanned, and if necessary, recurse itself (such as for when scanning a directory containing sub-directories or when
 * scanning a multidimensional array of multiple files and/or directories).
 *
 * @param string|array $f In the context of the initial file upload scanning that phpMussel performs when operating via a server, this parameter (a string) represents the "temporary filename" of the file being scanned (the temporary filename, in this context, referring to the name temporarily assigned to the file by the server upon the file being uploaded to the temporary uploads location assigned to the server). When operating in the context of CLI mode, both $f and $ofn represent the scan target, as per specified by the CLI operator; The only difference between the two is when the scan target is a directory, rather than a single file; $f will represent the full path to the file (so, directory plus filename), whereas $ofn will represent only the filename. This parameter can also accept an array of filenames.
 * @param bool $n Usually inherited from the calling function (`phpMussel()`), this optional parameter is a boolean (defaults to false, but set to true during the initial scan of file uploads), indicating the format that the scan results should be returned as. False instructs the function to return results as an integer; True instructs the function to return results as human readable text (refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB SERVERS)", for more information).
 * @param bool $zz Usually inherited from the calling function (`phpMussel()`), this optional parameter is a boolean (defaults to false, but set to true during the initial scan of file uploads), indicating to the function whether or not arrayed results should be imploded prior to being returned to the calling function. False instructs the function to return the arrayed results as verbatim; True instructs the function to return the arrayed results as an imploded string.
 * @param int $dpt Represents the current depth of recursion from which the function has been called. `phpMusselD()` and `phpMusselR()` use this information for determining how much they should indent any entries they generate for logging and for the display of scan results in CLI mode.
 * @param string $ofn In the context of the initial file upload scanning that phpMussel performs when operating via a server, this parameter (a string) represents the "original filename" of the file being scanned (the original filename, in this context, referring to the name of the file being scanned as per supplied by the upload client, as opposed to the temporary filename assigned by the server or any other filename). When operating in the context of CLI mode, both $f and $ofn represent the scan target, as per specified by the CLI operator; The only difference between the two is when the scan target is a directory, rather than a single file; $f will represent the full path to the file (so, directory plus filename), whereas $ofn will represent only the filename.
 * @return int|string|array The scan results, returned as an array when the $f parameter is an array and when $n and/or $zz is/are false, and otherwise returned as per described by the README documentation. The function may also die the script and return nothing, if something goes wrong, such as if the function is triggered in the absense of the required $phpMussel['memCache'] variable being set.
 */
function phpMusselR($f = '', $n = false, $zz = false, $dpt = 0, $ofn = '') {
    global $phpMussel;
    if (!isset($phpMussel['memCache'])) {
        echo
            (!isset($phpMussel['Config']['lang']['required_variables_not_defined'])) ?
            '[phpMussel] Required variables aren\'t defined: Can\'t continue.' :
            '[phpMussel] ' . $phpMussel['Config']['lang']['required_variables_not_defined'];
        die;
    }
    if ($phpMussel['EOF']) {
        $phpMussel['whyflagged'] =
        $phpMussel['killdata'] =
        $phpMussel['PEData'] = '';
        if (
            $dpt === 0 ||
            !isset($phpMussel['memCache']['objects_scanned']) ||
            !isset($phpMussel['memCache']['detections_count']) ||
            !isset($phpMussel['memCache']['scan_errors'])
        ) {
            $phpMussel['memCache']['objects_scanned'] =
            $phpMussel['memCache']['detections_count'] =
            $phpMussel['memCache']['scan_errors'] = 0;
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
        if (
            !isset($phpMussel['memCache']['objects_scanned']) ||
            !isset($phpMussel['memCache']['detections_count']) ||
            !isset($phpMussel['memCache']['scan_errors'])
        ) {
            $phpMussel['memCache']['objects_scanned'] =
            $phpMussel['memCache']['detections_count'] =
            $phpMussel['memCache']['scan_errors'] = 0;
        }
    }
    $dpt++;
    for ($lnap = '', $i = 0; $i < ($dpt - 1); $i++) {
        $lnap .= '-';
    }
    $lnap .= '> ';
    if (is_array($f)) {
        $k = key($f);
        $c = count($f);
        for ($i = 0; $i < $c; $i++) {
            $f[$k] = phpMusselR($f[$k], $n, false, $dpt, $f[$k]);
            next($f);
        }
        if ($n && $zz) {
            return implode_md($f);
        }
        return $f;
    }
    $ofn = @prescan_decode($ofn);
    $ofnSafe = urlencode($ofn);
    if ($d = is_dir($f)) {
        if (!$d = @scandir($f)) {
            $phpMussel['memCache']['scan_errors']++;
            return (!$n) ? 0 :
                $lnap . $phpMussel['Config']['lang']['failed_to_access'] . '\'' . $ofn . '\'' .
                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
        }
        $c = count($d);
        for ($i = 0; $i < $c; $i++) {
            if ($d[$i] == '.' || $d[$i] == '..') {
                unset($d[$i]);
                continue;
            }
            $d[$i] = phpMusselR($f . '/' . $d[$i], $n, false, $dpt, $d[$i]);
        }
        if ($n && $zz) {
            return implode_md($d);
        }
        return $d;
    }
    $phpMussel['memCache']['objects_scanned']++;
    $phpMussel['memCache']['phase'] = 'file';
    $phpMussel['memCache']['container'] = 'none';
    $phpMussel['memCache']['file_is_ole'] = false;
    if (!isset($phpMussel['memCache']['greylist'])) {
        if (!file_exists($phpMussel['vault'] . 'greylist.csv')) {
            $phpMussel['memCache']['greylist'] = ',';
            $glf = fopen($phpMussel['vault'] . 'greylist.csv', 'a');
            fwrite($glf, ',');
            fclose($glf);
            unset($glf);
        } else {
            $phpMussel['memCache']['greylist'] =
                phpMusselFile($phpMussel['vault'] . 'greylist.csv');
        }
    }

    /** Plugin hook: "before_scan". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['before_scan']) &&
        $phpMussel['MusselPlugins']['hookcounts']['before_scan'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['before_scan']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['before_scan'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['before_scan']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['before_scan'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['before_scan'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['before_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['before_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['before_scan'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['before_scan']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    $d = @is_file($f);
    $fnCRC = @hash('crc32b', $ofn);
    if (!$d || !$f) {
        return (!$n) ? 0 :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['Config']['lang']['invalid_file'] .
            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
    }
    $fS = filesize($f);
    if ($phpMussel['Config']['files']['filesize_limit'] > 0) {
        if ($fS > ($phpMussel['Config']['files']['filesize_limit'] * 1024)) {
            if (!$phpMussel['Config']['files']['filesize_response']) {
                return (!$n)?1:$lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn . '\' (FN: '.$fnCRC. "):\n-" . $lnap . $phpMussel['Config']['lang']['ok'] . ' (' . $phpMussel['Config']['lang']['filesize_limit_exceeded'] . ").\n";
            }
            $phpMussel['killdata'] .=
                '--FILESIZE-LIMIT--------NO-HASH-:' . $fS . ':' . $ofn . "\n";
            $phpMussel['whyflagged'] .=
                $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            if ($phpMussel['Config']['general']['delete_on_sight']) {
                @unlink($f);
            }
            return (!$n) ? 2 :
                $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
                $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
        }
    }
    if (substr($ofn, 0, 1) === '.' || substr($ofn, -1) === '.') {
        $phpMussel['killdata'] .=
            '--FILENAME-MANIPULATION-NO-HASH-:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .=
            $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
            ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        if ($phpMussel['Config']['general']['delete_on_sight']) {
            @unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
    }
    $xt = $xts = $gzxt = $gzxts = '-';
    if (substr_count($ofn, '.')) {
        $xt = explode('.', strtolower($ofn));
        $xts = substr($xt[count($xt) - 1], 0, 3) . '*';
        $xt = $xt[count($xt) - 1];
        if (substr_count($ofn, '.')) {
            $gzxt = explode('.', str_replace('.gz', '', strtolower($ofn)));
            $gzxts = substr($gzxt[count($gzxt) - 1], 0, 3) . '*';
            $gzxt = strtolower($gzxt[count($gzxt) - 1]);
        }
        if (strlen($xt)<1) {
            $xt = $xts = $gzxt = $gzxts = '-';
        }
    }
    if (
        substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xt . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xts . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $gzxt . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $gzxts . ',')
    ) {
        return (!$n) ? 1 :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
            '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
    }
    if (
        substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xt . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xts . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $gzxt . ',') ||
        substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $gzxts . ',')
    ) {
        $phpMussel['killdata'] .=
            '--FILETYPE-BLACKLISTED--NO-HASH-:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .=
            $phpMussel['Config']['lang']['filetype_blacklisted'] .
            ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        if ($phpMussel['Config']['general']['delete_on_sight']) {
            @unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' .
            $ofn . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['Config']['lang']['filetype_blacklisted'] .
            $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
    }
    if (
        $phpMussel['Config']['files']['filetype_greylist'] &&
        !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xt . ',') &&
        !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xts . ',') &&
        !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $gzxt . ',') &&
        !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $gzxts . ',')
    ) {
        $phpMussel['killdata'] .=
            '----FILETYPE--NOT-GREYLISTED----:' . $fS . ':' . $ofn . "\n";
        $phpMussel['whyflagged'] .=
            $phpMussel['Config']['lang']['filetype_blacklisted'] .
            ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
        if ($phpMussel['Config']['general']['delete_on_sight']) {
            @unlink($f);
        }
        return (!$n) ? 2 :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' .
            $ofn . '\' (FN: ' . $fnCRC . "):\n-" . $lnap .
            $phpMussel['Config']['lang']['filetype_blacklisted'] .
            $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
    }
    $in = phpMusselFile($f, (
            $phpMussel['Config']['attack_specific']['scannable_threshold'] > 0 &&
            $fS > ($phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024)
        ) ?
            $phpMussel['Config']['attack_specific']['scannable_threshold'] * 1024 :
            $fS,
        true);
    $fdCRC = @hash('crc32b', $in);
    if ($in && $phpMussel['Config']['compatibility']['only_allow_images']) {
        $is_img = (
            substr_count(
                ',bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,j' .
                'fif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pf' .
                'm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vica' .
                'r,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,', ',' . $xt . ','
            ) ||
            substr($str, 0, 2) === 'BM' ||
            substr($str, 0, 8) === 'gimp xcf' ||
            substr($str, 0, 4) === '8BPS' ||
            substr($str, 0, 4) === 'WEBP' || (
                $hh = bin2hex(substr($in, 0, 128)) && (
                    substr($hh, 0, 12) === '474946383761' ||
                    substr($hh, 0, 12) === '474946383961' ||
                    substr($hh, 0, 16) === '0000000c6a502020' ||
                    substr($hh, 0, 8) === '89504e47' ||
                    substr($hh, 0, 6) === 'ffd8ff' ||
                    substr($hh, 0, 8) === '25504446'
                )
            )
        );
        if (!$is_img) {
            $phpMussel['killdata'] .= md5($in) . ':' . $fS . ':' . $ofn . "\n";
            $phpMussel['whyflagged'] .=
                $phpMussel['Config']['lang']['only_allow_images'] .
                ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
            if ($phpMussel['Config']['general']['delete_on_sight']) {
                @unlink($f);
            }
            return (!$n) ? 2 :
                $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' .
                $ofn . '\' (FN: ' . $fnCRC . '; FD: ' . $fdCRC . "):\n-" .
                $lnap . $phpMussel['Config']['lang']['only_allow_images'] .
                $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
        }
    }
    $z = phpMusselD($in, $n, $dpt, $ofn);
    if ($z !== 1) {
        if ($phpMussel['Config']['general']['delete_on_sight']) {
            @unlink($f);
        }
        return (!$n) ? $z :
            $lnap . $phpMussel['Config']['lang']['scan_checking'] .
            ' \'' . $ofn . '\' (FN: ' . $fnCRC . '; FD: ' . $fdCRC . "):\n" .
            $z;
    }
    $x =
        $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' .
        $ofn . '\' (FN: ' . $fnCRC . '; FD: ' . $fdCRC . "):\n-" .
        $lnap . $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
    $r = 1;
    if (
        $phpMussel['Config']['files']['check_archives'] &&
        !empty($in) &&
        $phpMussel['Config']['files']['max_recursion'] > 1
    ) {
        $phpMussel['memCache']['phase'] = 'archive';
        $depth = 0;
        $eN = $ofn;
        $eNSafe = urlencode($eN);
        $eS = strlen($in);
        $zCRC = @hash('crc32b', $in);
        $lnap = '-' . $lnap;
        $MetaSigArray = array(
            array(
                'Config' => 'metadata_clamav',
                'SigFile' => 'metadata_clamav.cvd',
            ),
            array(
                'Config' => 'metadata_custom',
                'SigFile' => 'metadata_custom.cvd',
            ),
            array(
                'Config' => 'metadata_mussel',
                'SigFile' => 'metadata_mussel.cvd',
            )
        );
        $MetaCnt = count($MetaSigArray);
        while (true) {
            if ($depth > $phpMussel['Config']['files']['max_recursion']) {
                $r = 2;
                $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . '>' . $eN . "\n";
                $phpMussel['whyflagged'] .=
                    $phpMussel['Config']['lang']['recursive'] .
                    ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                    ' \'' . $ofn . '\' > \'' . $eN . '\' (FD: ' . $zCRC . "):\n-" .
                    $lnap . $phpMussel['Config']['lang']['recursive'] .
                    $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                break;
            }
            $zDo = false;
            if (substr_compare_hex($in, 0, 2, '1f8b', true)) {
                if (!function_exists('gzdecode')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' .
                        $ofn . "' (GZIP):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                $in = @gzdecode($in);
                if (!$in) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] .
                        ' \'' . $ofn . "' (GZIP):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                    "' (GZIP):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $zDo = true;
            } elseif (substr_compare_hex($in, 0, 3, '425a68', true)) {
                if (!function_exists('bzdecompress')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (BZIP2):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                $in = @bzdecompress($in);
                if (!$in) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (BZIP2):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                    "' (BZIP2):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $zDo = true;
            }
            $xtt =
                (substr_count($eN, '.')) ?
                array(
                    substr($eN, -3),
                    substr($eN, -4),
                    substr($eN, -7, 4),
                    substr($eN, -8, 4)
                ) :
                false;
            if (
                !empty($xtt) &&
                !$zDo && (
                    substr_count(',.gz,', ',' . $xtt[0] . ',') ||
                    substr_count(',.tgz,', ',' . $xtt[1] . ',')
                )
            ) {
                if (!function_exists('gzdecode')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] .
                        ' \'' . $ofn . "' (GZIP):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                $in = @gzdecode($in);
                if (!$in) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] .
                        ' \'' . $ofn . "' (GZIP):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' .
                    $ofn . "' (GZIP):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $zDo = true;
            } elseif (
                !empty($xtt) &&
                !$zDo && (
                    substr_count(',.bz,', ',' . $xtt[0] . ',') ||
                    substr_count(',.bz2,.tbz,', ',' . $xtt[1] . ',')
                )
            ) {
                if (!function_exists('bzdecompress')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (BZIP2):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                $in = @bzdecompress($in);
                if (!$in) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (BZIP2):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                    "' (BZIP2):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $zDo = true;
            } elseif (
                !empty($xtt) &&
                !$zDo && (
                    substr_count(',.lz,', ',' . $xtt[0] . ',') ||
                    substr_count(',.lha,.lzh,.lzo,.lzw,.lzx,.tlz,', ',' . $xtt[1] . ',')
                )
            ) {
                if (!function_exists('lzf_decompress')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (LZF):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                $in = @lzf_decompress($in);
                if (!$in) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                        "' (LZF):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn .
                    "' (LZF):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $zDo = true;
            }
            if (
                substr($in, 257, 6) === "ustar\x00" || (
                    !empty($xtt) && (
                        substr_count(',.tar,.tgz,.tbz,.tlz,', ',' . $xtt[1] . ',') ||
                        substr_count(',.tar,.tgz,.tbz,.tlz,', ',' . $xtt[2] . ',') ||
                        substr_count(',.tar,.tgz,.tbz,.tlz,', ',' . $xtt[3] . ',')
                    )
                )
            ) {
                $lnap = '-' . $lnap;
                $depth++;
                $phpMussel['memCache']['container'] = 'tarfile';
                if ($zDo) {
                    $eS = strlen($in);
                    $zCRC = @hash('crc32b', $in);
                }
                $TarFile = array();
                // $TarFile['blocksize'] = ceil($eS / 512);
                $TarFile['file'] = array(
                    'filename' => $ofn,
                    'filesize' => $eS,
                    'rawdata' => $in,
                    'crc32' => $zCRC,
                    'fncrc32' => $fnCRC,
                    'md5' => md5($in),
                    'directory' => false
                );
                if (strtolower(substr($TarFile['file']['filename'], -4)) !== '.tar') {
                    $TarFile['file']['filename'] =
                        (substr_count($TarFile['file']['filename'],'.')) ?
                        substrbl($TarFile['file']['filename'], '.') :
                        $TarFile['file']['filename'];
                }
                $TarFile['file']['filename'] =
                    (substr_count($TarFile['file']['filename'], "\x5c")) ?
                    substral($TarFile['file']['filename'], "\x5c") :
                    $TarFile['file']['filename'];
                $TarFile['file']['filename'] =
                    (substr_count($TarFile['file']['filename'], "\x2f")) ?
                    substral($TarFile['file']['filename'], "\x2f") :
                    $TarFile['file']['filename'];
                $TarFile['file']['filenameSafe'] = urlencode($TarFile['file']['filename']);
                $TarFile['offset'] = 0;
                $TarFile['badmetadata'] = false;
                while (true) {
                    if (($TarFile['offset'] + 1024) > $eS) {
                        break;
                    }
                    while (true) {
                        if ($TarFile['file']['directory']) {
                            break;
                        }
                        $x .=
                            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                            '\' > \'' . $TarFile['file']['filename'] . '\' (FN: ' .
                            $TarFile['file']['fncrc32'] . '; FD: ' . $TarFile['file']['crc32'] . "):\n";
                        if (!$TarFile['file']['filename']) {
                            $r = 2;
                            $phpMussel['killdata'] .=
                                $TarFile['file']['md5'] . ':' .
                                $TarFile['file']['filesize'] .
                                ":MISSING-FILENAME\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['scan_missing_filename'] .
                                $phpMussel['Config']['lang']['_exclamation'];
                            $x .=
                                '-' . $lnap . $phpMussel['Config']['lang']['scan_missing_filename'] .
                                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                            break 2;
                        }
                        if (
                            $phpMussel['Config']['files']['filesize_archives'] &&
                            $phpMussel['Config']['files']['filesize_limit'] > 0
                        ) {
                            if ($TarFile['file']['filesize'] > ($phpMussel['Config']['files']['filesize_limit'] * 1024)) {
                                if (!$phpMussel['Config']['files']['filesize_response']) {
                                    $x .=
                                        '-' . $lnap . $phpMussel['Config']['lang']['ok'] . ' (' .
                                        $phpMussel['Config']['lang']['filesize_limit_exceeded'] . ").\n";
                                    break;
                                }
                                $r = 2;
                                $phpMussel['killdata'] .=
                                    $TarFile['file']['md5'] . ':' .
                                    $TarFile['file']['filesize'] . ':' .
                                    $ofn . '>' . $TarFile['file']['filename'] . "\n";
                                $phpMussel['whyflagged'] .=
                                    $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                                    ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                                    $phpMussel['Config']['lang']['_exclamation'];
                                $x .=
                                    '-' . $lnap . $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                                    $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                                break 2;
                            }
                        }
                        if (
                            substr($TarFile['file']['filename'], 0, 1) === '.' ||
                            substr($TarFile['file']['filename'], -1) === '.'
                        ) {
                            $r = 2;
                            $phpMussel['killdata'] .=
                                $TarFile['file']['md5'] . ':' .
                                $TarFile['file']['filesize'] . ':' .
                                $ofn . '>' . $TarFile['file']['filename'] . "\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
                                ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                                $phpMussel['Config']['lang']['_exclamation'];
                            $x .=
                                '-' . $lnap .
                                $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
                                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                            break 2;
                        }
                        if ($phpMussel['Config']['files']['filetype_archives']) {
                            $xt = $xts = '-';
                            if (substr_count($TarFile['file']['filename'],'.')) {
                                $xt = explode('.', strtolower($TarFile['file']['filename']));
                                $xts = substr($xt[count($xt) - 1], 0, 3) . '*';
                                $xt = $xt[count($xt) - 1];
                                if (strlen($xt) < 1) {
                                    $xt = $xts = '-';
                                }
                            }
                            if (
                                substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xt . ',') ||
                                substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xts . ',')
                            ) {
                                $x .=
                                    '-' . $lnap . $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
                                break;
                            }
                            if (
                                substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xt . ',') ||
                                substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xts . ',')
                            ) {
                                $r = 2;
                                $phpMussel['killdata'] .=
                                    $TarFile['file']['md5'] . ':' .
                                    $TarFile['file']['filesize'] . ':' .
                                    $ofn . '>' . $TarFile['file']['filename'] . "\n";
                                $phpMussel['whyflagged'] .=
                                    $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                    ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                                    $phpMussel['Config']['lang']['_exclamation'];
                                $x .=
                                    '-' . $lnap . $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                    $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                                break 2;
                            }
                            if (
                                $phpMussel['Config']['files']['filetype_greylist'] &&
                                !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xt . ',') &&
                                !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xts . ',')
                            ) {
                                $r = 2;
                                $phpMussel['killdata'] .=
                                    $TarFile['file']['md5'] . ':' .
                                    $TarFile['file']['filesize'] . ':' .
                                    $ofn . '>' . $TarFile['file']['filename'] . "\n";
                                $phpMussel['whyflagged'] .=
                                    $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                    ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                                    $phpMussel['Config']['lang']['_exclamation'];
                                $x .=
                                    '-' . $lnap . $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                    $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                                break 2;
                            }
                        }
                        $phpMussel['memCache']['objects_scanned']++;
                        $TarFile['file']['scan'] =
                            phpMusselD($TarFile['file']['rawdata'], $n, $dpt, $TarFile['file']['filename']);
                        if ($TarFile['file']['scan'] !== 1) {
                            $r = 2;
                            $x .= $TarFile['file']['scan'];
                            break 2;
                        }
                        for($MetaItr = 0; $MetaItr < $MetaCnt; $MetaItr++) {
                            $MetaSigConfig = $MetaSigArray[$MetaItr]['Config'];
                            if (!$phpMussel['Config']['signatures'][$MetaSigConfig]) {
                                continue;
                            }
                            $MetaSigFile = $MetaSigArray[$MetaItr]['SigFile'];
                            if (!isset($phpMussel['memCache'][$MetaSigFile])) {
                                $phpMussel['memCache'][$MetaSigFile] =
                                    @file($phpMussel['sigPath'] . $MetaSigFile);
                            }
                            if (!$phpMussel['memCache'][$MetaSigFile]) {
                                $xc = 0;
                                if ($r !== 2) {
                                    $r = -3;
                                }
                                $phpMussel['memCache']['scan_errors']++;
                                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                                    $x .=
                                        '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                                        ' (' . $MetaSigFile . ')' .
                                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    break 2;
                                }
                            } else {
                                $xc = count($phpMussel['memCache'][$MetaSigFile]);
                                if (
                                    $phpMussel['memCache'][$MetaSigFile] &&
                                    $xc < 1
                                ) {
                                    if ($r !== 2) {
                                        $r = -3;
                                    }
                                    $phpMussel['memCache']['scan_errors']++;
                                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                                        $x .=
                                            '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                                            ' (' . $MetaSigFile . ')' .
                                            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        break 2;
                                    }
                                }
                            }
                            if ($xc > 0) {
                                for ($xi = 0; $xi < $xc; $xi++) {
                                    $TarFile['sig'] =
                                        @explode(':', $phpMussel['memCache'][$MetaSigFile][$xi]);
                                    $TarFile['sig'][0] = vn_shorthand($TarFile['sig'][0]);
                                    if (!isset($TarFile['sig'][1])) {
                                        $TarFile['sig'][1] = 0;
                                    }
                                    $TarFile['sig'][2] =
                                        (!isset($TarFile['sig'][2])) ?
                                        '' :
                                        preg_replace('/[^a-z0-9]/', '', $TarFile['sig'][2]);
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $TarFile['sig'][0] . ',') &&
                                        !$phpMussel['memCache']['ignoreme'] &&
                                        $TarFile['sig'][0] &&
                                        $TarFile['sig'][1] &&
                                        $TarFile['sig'][2] &&
                                        $TarFile['sig'][1] == $TarFile['file']['filesize'] &&
                                        $TarFile['sig'][2] == $TarFile['file']['crc32']
                                    ) {
                                        $r = 2;
                                        $TarFile['badmetadata'] = true;
                                        $x .=
                                            '-' . $lnap . phpMusselV(
                                                array('vn' => $TarFile['sig'][0]),
                                                $phpMussel['Config']['lang']['detected']
                                            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['killdata'] .=
                                            md5($TarFile['file']['rawdata']) . ':' .
                                            $TarFile['file']['filesize'] . ':' .
                                            $ofn . '>' . $TarFile['file']['filename'] . "\n";
                                        $phpMussel['whyflagged'] .=
                                            phpMusselV(
                                                array('vn' => $TarFile['sig'][0]),
                                                $phpMussel['Config']['lang']['detected']
                                            ) . ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                                            $phpMussel['Config']['lang']['_exclamation'];
                                        break 3;
                                    }
                                }
                            }
                        }
                        $x .=
                            '-' . $lnap . $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
                        break;
                    }
                    $TarFile['file'] = array();
                    $TarFile['file']['filename'] =
                        preg_replace('/[^\x20-\xff]/', '', substr($in, $TarFile['offset'], 100));
                    $TarFile['file']['filesize'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 124, 12)));
                    $TarFile['file']['directory'] = (
                        substr($TarFile['file']['filename'], -1, 1) === '/' &&
                        $TarFile['file']['filesize'] === 0
                    );
                    /* There's also a bit-check for confirming directory status
                       with POSIX TARs, will add that in later, as well as
                       other bit flags (`typeflag` and etc). */
                    if ($TarFile['file']['filename']) {
                        if (substr_count($TarFile['file']['filename'], "\x5c")) {
                            $TarFile['file']['filename'] =
                                substral($TarFile['file']['filename'], "\x5c") ;
                        }
                        if (substr_count($TarFile['file']['filename'], "\x2f")) {
                            $TarFile['file']['filename'] =
                                substral($TarFile['file']['filename'], "\x2f") ;
                        }
                    }
                    $TarFile['file']['filenameSafe'] = urlencode($TarFile['file']['filename']);
                    if ($TarFile['file']['filesize'] < 0) {
                        $r = 2;
                        $TarFile['badmetadata'] = true;
                        $phpMussel['killdata'] .=
                            $TarFile['file']['md5'] . ':' .
                            $TarFile['file']['filesize'] . ':' .
                            $ofn . '>' . $TarFile['file']['filename'] . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
                            ' (' . $ofnSafe . '>' . $TarFile['file']['filenameSafe'] . ')' .
                            $phpMussel['Config']['lang']['_exclamation'];
                        $x .=
                            '-' . $lnap . $phpMussel['Config']['lang']['scan_tampering'] .
                            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                        break;
                    }
                    /* $TarFile['file']['mode'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 100, 8)));
                    $TarFile['file']['uid'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 108, 8)));
                    $TarFile['file']['gid'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 116, 8)));
                    $TarFile['file']['mtime'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 136, 12)));
                    $TarFile['file']['chksum'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 148, 8)));
                    $TarFile['file']['typeflag'] =
                        substr($in, $TarFile['offset'] + 156, 1);
                    $TarFile['file']['linkname'] =
                        preg_replace('/[^\x20-\xff]/', '', substr($in, $TarFile['offset'] + 157, 100)); */
                    $TarFile['file']['magic'] =
                        preg_replace('/[^\x20-\xff]/', '', substr($in, $TarFile['offset'] + 257, 6));
                    /* $TarFile['file']['version'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 263, 2)));
                    $TarFile['file']['uname'] =
                        preg_replace('/[^\x20-\xff]/', '', substr($in, $TarFile['offset'] + 265, 32));
                    $TarFile['file']['gname'] =
                        preg_replace('/[^\x20-\xff]/', '', substr($in, $TarFile['offset'] + 297, 32));
                    $TarFile['file']['devmajor'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 329, 8)));
                    $TarFile['file']['devminor'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 337, 8)));
                    $TarFile['file']['prefix'] =
                        octdec(preg_replace('/[^0-9]/', '', substr($in, $TarFile['offset'] + 345, 155))); */
                    $TarFile['file']['rawdata'] =
                        substr($in, $TarFile['offset'] + 512, $TarFile['file']['filesize']);
                    $TarFile['file']['crc32'] = hash('crc32b', $TarFile['file']['rawdata']);
                    $TarFile['file']['fncrc32'] = hash('crc32b', $TarFile['file']['filename']);
                    $TarFile['file']['md5'] = md5($TarFile['file']['rawdata']);
                    $TarFile['file']['blocks'] = ceil($TarFile['file']['filesize'] / 512) + 1;
                    $TarFile['offset'] += $TarFile['file']['blocks'] * 512;
                }
                if ($TarFile['badmetadata'] && $r === 2) {
                    if (
                        $phpMussel['Config']['general']['quarantine_key'] &&
                        !$phpMussel['Config']['general']['honeypot_mode'] &&
                        $eS < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)
                    ) {
                        $qfu =
                            $phpMussel['time'] . '-' .
                            md5($phpMussel['Config']['general']['quarantine_key'] . $zCRC . $phpMussel['time']);
                        @phpMusselQ(
                            $in,
                            $phpMussel['Config']['general']['quarantine_key'],
                            $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                            $qfu
                        );
                        $phpMussel['killdata'] .=
                            'Quarantined as "/vault/quarantine/' . $qfu . ".qfu\".\n";
                    }
                }
                $TarFile = '';
                break;
            } elseif ($zDo) {
                $lnap = '-' . $lnap;
                $depth++;
                $phpMussel['memCache']['container'] = 'compressor';
                if (substr_count($eN, '.')) {
                    $eN = substrbl($eN, '.');
                }
                if (substr_count($eN, "\x5c")) {
                    $eN = substral($eN, "\x5c");
                }
                if (substr_count($eN, "\x2f")) {
                    $eN = substral($eN, "\x2f");
                }
                $eNSafe = urlencode($eN);
                $eS = strlen($in);
                $zCRC = @hash('crc32b', $in);
                if (
                    $phpMussel['Config']['files']['filesize_archives'] &&
                    $phpMussel['Config']['files']['filesize_limit'] > 0
                ) {
                    if ($eS > ($phpMussel['Config']['files']['filesize_limit'] * 1024)) {
                        if (!$phpMussel['Config']['files']['filesize_response']) {
                            $x .=
                                $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                                ' \'' . $ofn . '\' > \'' . $eN . '\' (FD: ' . $zCRC . "):\n-" . $lnap .
                                $phpMussel['Config']['lang']['ok'] .
                                ' (' . $phpMussel['Config']['lang']['filesize_limit_exceeded'] . ").\n";
                            break;
                        }
                        $r = 2;
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . '>' . $eN . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                            ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        $x .=
                            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' .
                            $ofn . '\' > \'' . $eN . '\' (FD: ' . $zCRC . "):\n-" . $lnap .
                            $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                            $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                        break;
                    }
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                    '\' > \'' . $eN . '\' (FN: ' . $fnCRC . '; FD: ' . $zCRC . "):\n";
                $phpMussel['memCache']['objects_scanned']++;
                $bad = phpMusselD($in, $n, $dpt, $eN);
                if ($bad !== 1) {
                    $r = 2;
                    $x .= $bad;
                    break;
                }
                for($MetaItr = 0; $MetaItr < $MetaCnt; $MetaItr++) {
                    $MetaSigConfig = $MetaSigArray[$MetaItr]['Config'];
                    if (!$phpMussel['Config']['signatures'][$MetaSigConfig]) {
                        continue;
                    }
                    $MetaSigFile = $MetaSigArray[$MetaItr]['SigFile'];
                    if (!isset($phpMussel['memCache'][$MetaSigFile])) {
                        $phpMussel['memCache'][$MetaSigFile] =
                            @file($phpMussel['sigPath'] . $MetaSigFile);
                    }
                    if (!$phpMussel['memCache'][$MetaSigFile]) {
                        $zmdc = 0;
                        if ($r !== 2) {
                            $r = -3;
                        }
                        $phpMussel['memCache']['scan_errors']++;
                        if (!$phpMussel['Config']['signatures']['fail_silently']) {
                            $phpMussel['killdata'] .= md5($in) . ':' . $eS . ":\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                                ' (' . $MetaSigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        }
                        $x .=
                            '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                            ' (' . $MetaSigFile . ')' .
                            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                    } else {
                        $zmdc = count($phpMussel['memCache'][$MetaSigFile]);
                        if ($zmdc < 1) {
                            if ($r !== 2) {
                                $r = -3;
                            }
                            $phpMussel['memCache']['scan_errors']++;
                            if (!$phpMussel['Config']['signatures']['fail_silently']) {
                                $phpMussel['killdata'] .= md5($in) . ':' . $eS . ":\n";
                                $phpMussel['whyflagged'] .=
                                    $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                                    ' (' . $MetaSigFile . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            }
                            $x .=
                                '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                                ' (' . $MetaSigFile . ')' .
                                $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                        }
                    }
                    if ($zmdc > 0) {
                        for ($zmdi = 0; $zmdi < $zmdc; $zmdi++) {
                            $zmds = @explode(':', $phpMussel['memCache'][$MetaSigFile][$zmdi]);
                            $zmds[0] = vn_shorthand($zmds[0]);
                            if (!isset($zmds[1])) {
                                $zmds[1] = 0;
                            }
                            $zmds[2] = (!isset($zmds[2])) ? '' : preg_replace('/[^a-z0-9]/', '', $zmds[2]);
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $zmds[0] . ',') &&
                                !$phpMussel['memCache']['ignoreme'] &&
                                $zmds[0] &&
                                $zmds[1] &&
                                $zmds[2] &&
                                $zmds[1] == $eS &&
                                $zmds[2] == $zCRC
                            ) {
                                $r = 2;
                                $x .=
                                    '-' . $lnap . phpMusselV(
                                        array('vn' => $zmds[0]),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . '>' . $eN . "\n";
                                $phpMussel['whyflagged'] .=
                                    phpMusselV(
                                        array('vn' => $zmds[0]),
                                        $phpMussel['Config']['lang']['detected']
                                    ) . ' (' . $ofnSafe . '>' . $eNSafe . ')' .
                                    $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                    }
                }
                if ($r === 2) {
                    if (
                        $phpMussel['Config']['general']['quarantine_key'] &&
                        !$phpMussel['Config']['general']['honeypot_mode']
                    ) {
                        if ($eS < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)) {
                            $qfu =
                                $phpMussel['time'] . '-' . md5(
                                    $phpMussel['Config']['general']['quarantine_key'] . $zCRC . $phpMussel['time']
                                );
                            @phpMusselQ(
                                $in,
                                $phpMussel['Config']['general']['quarantine_key'],
                                $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                                $qfu
                            );
                            $phpMussel['killdata'] .=
                                'Quarantined as "/vault/quarantine/' . $qfu . ".qfu\".\n";
                        }
                    }
                    break;
                }
                $x .=
                    '-' . $lnap . $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
                continue;
            }
            break;
        }
        if ($xts === 'zip*' || substr($in, 0, 2) === 'PK') {
            if ($xt === 'ole') {
                $ziptype = 'OLE';
            } elseif ($xt === 'smpk') {
                $ziptype = 'SMPTE';
            } elseif ($xt === 'xpi') {
                $ziptype = 'XPInstall';
            } elseif ($xts === 'app*') {
                $ziptype = 'App';
            } elseif (substr_count(
                ',docm,docx,dotm,dotx,potm,potx,ppam,ppsm,ppsx,pptm,pptx,xla' .
                'm,xlsb,xlsm,xlsx,xltm,xltx,',
                ',' . $xt . ','
            )) {
                $ziptype = 'OpenXML';
            } elseif (substr_count(
                ',odc,odf,odg,odm,odp,ods,odt,otg,oth,otp,ots,ott,',
                ',' . $xt . ','
            ) || $xts === 'fod*') {
                $ziptype = 'OpenDocument';
            } elseif (substr_count(',opf,epub,', ',' . $xt . ',')) {
                $ziptype = 'EPUB';
            } else {
                $ziptype = 'ZIP';
                $phpMussel['memCache']['container'] = 'zipfile';
            }
            if ($ziptype !== 'ZIP') {
                $phpMussel['memCache']['file_is_ole'] = true;
                $phpMussel['memCache']['container'] = 'pkfile';
            }
            /* AAA MORE WORK TO BE DONE, FUTURE ZIP FUNCTIONS TO GO HERE! AAA
               WORKING NOTES: https://pkware.cachefly.net/webdocs/casestudies/APPNOTE.TXT
               $ziphead['version_needed'] = explode_bits(substr($in, 4, 2));
               $ziphead['compression_method'] = explode_bits(substr($in, 8, 2));
               I'm hoping to eventually re-code this whole section. */
            $ziphead = array('passed' => true);
            $ziphead['general_purpose'] = explode_bits(substr($in, 6, 2));
            if ($ziphead['general_purpose'][7]) {
                /** Encryption detected. */
                $ziphead['passed'] = false;
                if ($phpMussel['Config']['files']['block_encrypted_archives']) {
                    $r = 2;
                    $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . '>' . $eN . "\n";
                    $phpMussel['whyflagged'] .=
                        $phpMussel['Config']['lang']['encrypted_archive'] .
                        ' (' . $ofnSafe . '>' . $eNSafe . ')' .
                        $phpMussel['Config']['lang']['_exclamation'];
                    $x .=
                        $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                        ' \'' . $ofn . '\' > \'' . $eN . '\' (FN: ' . $zCRC . "):\n-" .
                        $lnap . $phpMussel['Config']['lang']['encrypted_archive'] .
                        $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                }
            }
            if ($ziphead['passed']) {
                if (!function_exists('zip_open')) {
                    $phpMussel['memCache']['scan_errors']++;
                    if (!$phpMussel['Config']['signatures']['fail_extensions_silently']) {
                        $phpMussel['killdata'] .= md5($in) . ':' . $eS . ':' . $ofn . '>' . $eN . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_extensions_missing'] . ' ';
                    }
                    return (!$n) ? -1 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn . '\' (' .
                        $ziptype. "):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_extensions_missing'] . "\n";
                }
                if (!$fS = @zip_open($f)) {
                    return (!$n) ? 0 :
                        $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn . '\' (' .
                        $ziptype. "):\n-" . $lnap .
                        $phpMussel['Config']['lang']['scan_not_archive'] . "\n";
                }
                $x .=
                    $lnap . $phpMussel['Config']['lang']['scan_reading'] . ' \'' . $ofn . '\' (' .
                    $ziptype. "):\n-" . $lnap .
                    $phpMussel['Config']['lang']['scan_checking_contents'] . "\n";
                $b = false;
                $lnap = '-' . $lnap;
                $bi = -1;
                while (!$b) {
                    $bi++;
                    if (!$fD = @zip_read($fS)) {
                        $b = true;
                        continue;
                    }
                    $eN = @zip_entry_name($fD);
                    $eNSafe = urlencode($eN);
                    $eS = @zip_entry_filesize($fD);
                    $znCRC = @hash('crc32b', $eN);
                    if (
                        $phpMussel['Config']['files']['filesize_archives'] &&
                        $phpMussel['Config']['files']['filesize_limit'] > 0
                    ) {
                        if ($eS > ($phpMussel['Config']['files']['filesize_limit']*1024)) {
                            if (!$phpMussel['Config']['files']['filesize_response']) {
                                $x .=
                                    $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                                    '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                                    $phpMussel['Config']['lang']['ok'] . ' (' .
                                    $phpMussel['Config']['lang']['filesize_limit_exceeded'] . ").\n";
                                continue;
                            }
                            $r = 2;
                            $phpMussel['killdata'] .=
                                '--FILESIZE-LIMIT--------NO-HASH-:' . $eS . ':' . $ofn . '>' . $eN . "\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                                ' (' . $ofnSafe . ')' .
                                $phpMussel['Config']['lang']['_exclamation'];
                            $x .=
                                $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                                ' \'' . $ofn . '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                                $phpMussel['Config']['lang']['filesize_limit_exceeded'] .
                                $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                            continue;
                        }
                    }
                    if (substr($eN, 0, 1) === '.' || substr($eN, -1) === '.') {
                        $r = 2;
                        $phpMussel['killdata'] .=
                            '--FILENAME-MANIPULATION-NO-HASH-:' . $eS . ':' . $ofn . '>' . $eN . "\n";
                        $phpMussel['whyflagged'] .=
                            $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
                            ' (' . $ofnSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                        $x .=
                            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                            '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                            $phpMussel['Config']['lang']['scan_filename_manipulation_detected'] .
                            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                        continue;
                    }
                    if ($phpMussel['Config']['files']['filetype_archives']) {
                        $xt = $xts = '-';
                        if (substr_count($eN, '.')) {
                            $xt = explode('.', strtolower($eN));
                            $xts = substr($xt[count($xt) - 1], 0, 3) . '*';
                            $xt = $xt[count($xt) - 1];
                            if (strlen($xt)) {
                                $xt = $xts = '-';
                            }
                        }
                        if (
                            substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xt . ',') ||
                            substr_count(',' . $phpMussel['Config']['files']['filetype_whitelist'] . ',', ',' . $xts . ',')
                        ) {
                            $x .=
                                $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                                '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                                $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
                            continue;
                        }
                        if (
                            substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xt . ',') ||
                            substr_count(',' . $phpMussel['Config']['files']['filetype_blacklist'] . ',', ',' . $xts . ',')
                        ) {
                            $r = 2;
                            $phpMussel['killdata'] .=
                                '--FILETYPE-BLACKLISTED--NO-HASH-:' . $eS . ':' . $ofn . '>' . $eN . "\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['filetype_blacklisted'] . ' (' . $ofnSafe . '>' .
                                $eNSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            $x .=
                                $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                                '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                                $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                            continue;
                        }
                        if (
                            $phpMussel['Config']['files']['filetype_greylist'] &&
                            !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xt . ',') &&
                            !substr_count(',' . $phpMussel['Config']['files']['filetype_greylist'] . ',', ',' . $xts . ',')
                        ) {
                            $r = 2;
                            $phpMussel['killdata'] .=
                                '----FILETYPE--NOT-GREYLISTED----:' . $eS . ':' . $ofn . '>' . $eN . "\n";
                            $phpMussel['whyflagged'] .=
                                $phpMussel['Config']['lang']['filetype_blacklisted'] . ' (' . $ofnSafe . '>' .
                                $eNSafe . ')' . $phpMussel['Config']['lang']['_exclamation'];
                            $x .=
                                $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                                '\' > \'' . $eN . '\' (FN: ' . $znCRC . "):\n-" . $lnap .
                                $phpMussel['Config']['lang']['filetype_blacklisted'] .
                                $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
                            continue;
                        }
                    }
                    $eD = @zip_entry_read($fD, $eS);
                    if (!$eD || !$eS) {
                        continue;
                    }
                    $eFS = strlen($eD);
                    $phpMussel['memCache']['objects_scanned']++;
                    $bad = phpMusselD($eD, $n, $dpt, $eN);
                    $zmd = '';
                    $zCRC = @hash('crc32b', $eD);
                    if ($bi < 2) {
                        for($MetaItr = 0; $MetaItr < $MetaCnt; $MetaItr++) {
                            $MetaSigConfig = $MetaSigArray[$MetaItr]['Config'];
                            if (!$phpMussel['Config']['signatures'][$MetaSigConfig]) {
                                continue;
                            }
                            $MetaSigFile = $MetaSigArray[$MetaItr]['SigFile'];
                            if (!isset($phpMussel['memCache'][$MetaSigFile])) {
                                $phpMussel['memCache'][$MetaSigFile] =
                                    @file($phpMussel['sigPath'] . $MetaSigFile);
                            }
                            if (!$phpMussel['memCache'][$MetaSigFile]) {
                                $zmdc = 0;
                                if ($r !== 2) {
                                    $r = -3;
                                }
                                $phpMussel['memCache']['scan_errors']++;
                                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                                    $zmd .=
                                        '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_missing'] .
                                        ' (' . $MetaSigFile . ')' .
                                        $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                }
                            } else {
                                $zmdc = count($phpMussel['memCache'][$MetaSigFile]);
                                if ($zmdc < 1) {
                                    if ($r !== 2) {
                                        $r = -3;
                                    }
                                    $phpMussel['memCache']['scan_errors']++;
                                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                                        $zmd .=
                                            '-' . $lnap . $phpMussel['Config']['lang']['scan_signature_file_corrupted'] .
                                            ' (' . $MetaSigFile . ')' .
                                            $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                    }
                                }
                            }
                            if ($zmdc > 0) {
                                for ($zmdi = 0; $zmdi < $zmdc; $zmdi++) {
                                    $zmds = @explode(':', $phpMussel['memCache'][$MetaSigFile][$zmdi]);
                                    $zmds[0] = vn_shorthand($zmds[0]);
                                    if (!isset($zmds[1])) {
                                        $zmds[1] = 0;
                                    }
                                    $zmds[2] = (!isset($zmds[2])) ? '' : preg_replace('/[^a-z0-9]/' ,'', $zmds[2]);
                                    if (
                                        !substr_count($phpMussel['memCache']['greylist'], ',' . $zmds[0] . ',') &&
                                        !$phpMussel['memCache']['ignoreme'] &&
                                        $zmds[0] &&
                                        $zmds[1] &&
                                        $zmds[2] &&
                                        $zmds[1] == $eFS &&
                                        $zmds[2] == $zCRC
                                    ) {
                                        $r = 2;
                                        $zmd .=
                                            '-' . $lnap . phpMusselV(
                                                array('vn' => $zmds[0]),
                                                $phpMussel['Config']['lang']['detected']
                                            ) . $phpMussel['Config']['lang']['_exclamation_final'] . "\n";
                                        $phpMussel['killdata'] .= md5($eD) . ':' . $eFS . ':' . $ofn . '>' . $eN . "\n";
                                        $phpMussel['whyflagged'] .=
                                            phpMusselV(
                                                array('vn' => $zmds[0]),
                                                $phpMussel['Config']['lang']['detected']
                                            ) . ' (' . $ofnSafe . '>' . $eNSafe . ')' .
                                            $phpMussel['Config']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    }
                    if ($bad!==1) {
                        $r = 2;
                        $x .=
                            $lnap . $phpMussel['Config']['lang']['scan_checking'] . ' \'' . $ofn .
                            '\' > \'' . $eN . '\' (FN: ' . $znCRC . '; FD: ' . $zCRC. "):\n" . $bad . $zmd;
                        continue;
                    }
                    if ($r === 2 && $zmd) {
                        if (
                            $phpMussel['Config']['general']['quarantine_key'] &&
                            !$phpMussel['Config']['general']['honeypot_mode'] &&
                            $eFS < ($phpMussel['Config']['general']['quarantine_max_filesize'] * 1024)
                        ) {
                            $qfu =
                                $phpMussel['time'] . '-' . md5(
                                    $phpMussel['Config']['general']['quarantine_key'] . $zCRC . $phpMussel['time']
                                );
                            @phpMusselQ(
                                $eD,
                                $phpMussel['Config']['general']['quarantine_key'],
                                $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                                $qfu
                            );
                            $phpMussel['killdata'] .=
                                'Quarantined as "/vault/quarantine/' . $qfu . ".qfu\".\n";
                        }
                        $x .=
                            $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                            ' \'' . $ofn . '\' > \'' . $eN . '\' (FN: ' . $znCRC . '; FD: ' . $zCRC .
                            "):\n" . $zmd;
                        continue;
                    }
                    $x .=
                        $lnap . $phpMussel['Config']['lang']['scan_checking'] .
                        ' \'' . $ofn . '\' > \'' . $eN . '\' (FN: ' . $znCRC . '; FD: ' . $zCRC .
                        "):\n-" . $lnap . $phpMussel['Config']['lang']['scan_no_problems_found'] . "\n";
                }
                zip_close($fS);
            }
        }
        /**
         * @todo Future RAR functions to go here!
         */
        if (
            $xt === 'rar' ||
            substr($in, 0, 4) === 'Rar!' ||
            bin2hex(substr($in, 0, 4)) === '52457e5e'
        ) {
            // $phpMussel['memCache']['container'] = 'rarfile';
        }
        if ($r === 2 && $phpMussel['Config']['general']['delete_on_sight']) {
            @unlink($f);
        }
    }
    return (!$n) ? $r : $x;
}

/**
 * Used to fork the PHP process when scanning in CLI mode. This so that if PHP
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
function phpMusselFork($f = '', $ofn = '') {
    global $phpMussel;
    $pf = popen(
        $phpMussel['Mussel_PHP'] . ' "' . $phpMussel['vault'] .
        '../phpmussel.php" "cli_win_scan" "' . $f . '" "' . $ofn . '"', 'r'
    );
    $s = '';
    while ($x = fgets($pf)) {
        $s .= $x;
    }
    pclose($pf);
    return $s;
}

/**
 * The main scan function, responsible for initialising scans in most
 * circumstances. It's the function that should generally be called
 * whenever phpMussel is required by external scripts, apps, CMS, etc.
 *
 * Please refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB
 * SERVERS)", for more information.
 *
 * @param string|array $f Indicates which file, files, directory and/or
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
 *      function has been called. `phpMusselD()` and `phpMusselR()` use this
 *      information for determining how much they should indent any entries
 *      they generate for logging and for the display of scan results in CLI
 *      mode (you should never manually set this parameter yourself).
 * @param string $ofn In the context of the initial file upload scanning that
 *      phpMussel performs when operating via a server, this parameter (a
 *      string) represents the "original filename" of the file being scanned
 *      (the original filename, in this context, referring to the name of the
 *      file being scanned as per supplied by the upload client, as opposed to
 *      the temporary filename assigned by the server or any other filename).
 *      When operating in the context of CLI mode, both $f and $ofn represent
 *      the scan target, as per specified by the CLI operator; The only
 *      difference between the two is when the scan target is a directory,
 *      rather than a single file; $f will represent the full path to the file
 *      (so, directory plus filename), whereas $ofn will represent only the
 *      filename.
 * @return bool|int|string|array The scan results, returned as an array when
 *      the $f parameter is an array and when $n and/or $zz is/are false, and
 *      otherwise returned as per described by the README documentation. The
 *      function may also die the script and return nothing, if something goes
 *      wrong, such as if the function is triggered in the absense of the
 *      required $phpMussel['memCache'] variable being set, and may also return
 *      false, in the absense of the required $phpMussel['HashCache']['Data']
 *      variable being set.
 */
function phpMussel($f = '', $n = false, $zz = false, $dpt = 0, $ofn = '') {
    global $phpMussel;
    if (!isset($phpMussel['memCache'])) {
        echo
            (!isset($phpMussel['Config']['lang']['required_variables_not_defined'])) ?
            '[phpMussel] Required variables aren\'t defined: Can\'t continue.' :
            '[phpMussel] ' . $phpMussel['Config']['lang']['required_variables_not_defined'];
        die;
    }
    if ($phpMussel['EOF']) {
        $phpMussel['HashCache']['Data'] =
            ($phpMussel['Config']['general']['scan_cache_expiry'] > 0) ?
            phpMusselCacheGet('HashCache') :
            array();
        if (!empty($phpMussel['HashCache']['Data'])) {
            $phpMussel['HashCache']['Data'] = explode(';', $phpMussel['HashCache']['Data']);
            $phpMussel['HashCache']['Build'] = array();
            $phpMussel['HashCache']['Count'] = count($phpMussel['HashCache']['Data']);
            for (
                $phpMussel['HashCache']['Index'] = 0;
                $phpMussel['HashCache']['Index'] < $phpMussel['HashCache']['Count'];
                $phpMussel['HashCache']['Index']++
            ) {
                if (substr_count($phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']], ':')) {
                    $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']] =
                        explode(':', $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']], 4);
                    if (!($phpMussel['time'] > $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']][1])) {
                        $phpMussel['HashCache']['Build'][$phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']][0]] =
                            $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Index']];
                    }
                }
            }
            $phpMussel['HashCache']['Data'] = $phpMussel['HashCache']['Build'];
            unset($phpMussel['HashCache']['Build']);
        }
    }
    if (!isset($phpMussel['HashCache']['Data'])) {
        return false;
    }
    if (!$ofn) {
        $ofn = $f;
    }
    $xst = time();
    $xst2822 = date('r', $xst);
    $r = phpMusselR($f, $n, $zz, $dpt, $ofn);
    $xet = time();
    $xet2822 = date('r', $xet);

    /** Plugin hook: "after_scan". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['after_scan']) &&
        $phpMussel['MusselPlugins']['hookcounts']['after_scan'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['after_scan']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['after_scan'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['after_scan']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['after_scan'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['after_scan'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['after_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['after_scan'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['after_scan'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['after_scan']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    if (
        $phpMussel['Config']['general']['scan_log'] &&
        $n &&
        !is_array($r)
    ) {
        $r =
            $xst2822 . ' ' . $phpMussel['Config']['lang']['started'] .
            $phpMussel['Config']['lang']['_fullstop_final'] . "\n" .
            $r . $xet2822 . ' ' . $phpMussel['Config']['lang']['finished'] .
            $phpMussel['Config']['lang']['_fullstop_final'] . "\n";
        if (!file_exists($phpMussel['vault'] . $phpMussel['Config']['general']['scan_log'])) {
            $r = $phpMussel['safety'] . "\n" . $r;
        }
        $xf = fopen($phpMussel['vault'] . $phpMussel['Config']['general']['scan_log'], 'a');
        fwrite($xf, $r);
        fclose($xf);
    }
    if ($phpMussel['EOF']) {
        if ($phpMussel['Config']['general']['scan_cache_expiry'] > 0) {
            reset($phpMussel['HashCache']['Data']);
            $phpMussel['HashCache']['Count'] = count($phpMussel['HashCache']['Data']);
            for (
                $phpMussel['HashCache']['Index'] = 0;
                $phpMussel['HashCache']['Index'] < $phpMussel['HashCache']['Count'];
                $phpMussel['HashCache']['Index']++
            ) {
                $phpMussel['HashCache']['Key'] = key($phpMussel['HashCache']['Data']);
                if (is_array($phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']])) {
                    $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']] =
                        implode(':', $phpMussel['HashCache']['Data'][$phpMussel['HashCache']['Key']]) . ';';
                }
                next($phpMussel['HashCache']['Data']);
            }
            $phpMussel['HashCache']['Data'] = implode('', $phpMussel['HashCache']['Data']);
            $phpMussel['HashCache']['Data'] = phpMusselCacheSet(
                'HashCache',
                $phpMussel['time'] + $phpMussel['Config']['general']['scan_cache_expiry'],
                $phpMussel['HashCache']['Data']
            );
            unset($phpMussel['HashCache']['Data']);
        }
        if (
            !empty($phpMussel['whyflagged']) &&
            $phpMussel['Config']['general']['scan_log_serialized']
        ) {
            $handle = array();
            $handle['whyflagged'] = trim($phpMussel['whyflagged']);
            $handle['s'] = serialize(array(
                'start_time' => $xst,
                'end_time' => $xet,
                'origin' => $_SERVER[$phpMussel['Config']['general']['ipaddr']],
                'objects_scanned' => $phpMussel['memCache']['objects_scanned'],
                'detections_count' => $phpMussel['memCache']['detections_count'],
                'scan_errors' => $phpMussel['memCache']['scan_errors'],
                'detections' => $handle['whyflagged']
            )) . "\n";
            $handle['f'] =
                fopen($phpMussel['vault'] . $phpMussel['Config']['general']['scan_log_serialized'], 'a');
            fwrite($handle['f'], $handle['s']);
            fclose($handle['f']);
        }
    }
    return $r;
}

/**
 * An additional scanning function that can be used for scanning email
 * messages, forum posts, contact form messages and etc, and is unrelated to
 * the core scanning function of phpMussel. The function is unused by phpMussel
 * itself, not being called anywhere in any contexts, but exists here for the
 * benefit of those that may wish to use it within their scripts, apps, CMS,
 * etc.
 *
 * Please refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB
 *      SERVERS)", for more information.
 *
 * @param string $body The actual content (email message, forum post, etc) that
 *      you wish to scan (must be a string).
 * @return int|string If any error occurs preventing the function from
 *      completing its scan, a value of -1 (integer) will be returned. If the
 *      function completes its scan and doesn't match anything, a value of 0
 *      (integer) will be returned. If, however, the function does match
 *      something, a string will be returned containing a message citing what
 *      has been matched.
 */
function phpMussel_mail($body = '') {
    global $phpMussel;
    if (!$len = strlen($body)) {
        return -1;
    }
    if (!isset($phpMussel['memCache']['greylist'])) {
        if (!file_exists($phpMussel['vault'] . 'greylist.csv')) {
            $phpMussel['memCache']['greylist'] = ',';
            $glf = fopen($phpMussel['vault'] . 'greylist.csv', 'a');
            fwrite($glf, ',');
            fclose($glf);
            unset($glf);
        } else {
            $phpMussel['memCache']['greylist'] =
                phpMusselFile($phpMussel['vault'] . 'greylist.csv');
        }
    }
    $f = '';
    $hex = bin2hex($body);
    $hexlc = bin2hex(strtolower($body));
    $hexlen = strlen($hexlc);

    /** Plugin hook: "before_scan_mail". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['before_scan_mail']) &&
        $phpMussel['MusselPlugins']['hookcounts']['before_scan_mail'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['before_scan_mail']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['before_scan_mail'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['before_scan_mail']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['before_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['before_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['before_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['before_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['before_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['before_scan_mail']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    if ($phpMussel['Config']['signatures']['mail_clamav']) {
        while (true) {
            if (!isset($phpMussel['memCache']['mail_clamav_standard.cvd'])) {
                $phpMussel['memCache']['mail_clamav_standard.cvd'] =
                    @file($phpMussel['sigPath'] . 'mail_clamav_standard.cvd');
            }
            if (!$phpMussel['memCache']['mail_clamav_standard.cvd']) {
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    return -1;
                }
                break;
            }
            if (!isset($phpMussel['memCache']['mail_clamav_standard.map'])) {
                $phpMussel['memCache']['mail_clamav_standard.map'] =
                    @file($phpMussel['sigPath'] . 'mail_clamav_standard.map');
            }
            if (!$phpMussel['memCache']['mail_clamav_standard.map']) {
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    return -1;
                }
                break;
            }
            $c = count($phpMussel['memCache']['mail_clamav_standard.map']);
            for ($i = 0; $i < $c; $i++) {
                $map = explode(':', $phpMussel['memCache']['mail_clamav_standard.map'][$i]);
                $map[2] = (int)$map[2];
                if (substr_count($hex, $map[0]) > 0) {
                    for ($xind = $map[1]; $xind < ($map[2] + 1); $xind++) {
                        $xsig = $phpMussel['memCache']['mail_clamav_standard.cvd'][$xind];
                        if (substr_count($xsig, ':')) {
                            $vn = @explode(':', $xsig);
                            $xsig = @preg_split('/[^a-fA-F0-9>]+/i', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                            $xsig = ($xsig === false ? '' : implode('', $xsig));
                            $xlen = strlen($xsig);
                            if (
                                $xlen < $phpMussel['Config']['signatures']['sd_siglen_min'] ||
                                $xlen > $phpMussel['Config']['signatures']['sd_siglen_max']
                            ) {
                                continue;
                            }
                            $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                            $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                            $vn = vn_shorthand($vn[0]);
                            if ($hexlen < $xlen) {
                                continue;
                            }
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                                $xsigc = count($xsig);
                                $this_str = $hex;
                                $this_strlc = $hexlc;
                                if ($xstrf === 'A') {
                                    $this_str = "\x01" . $this_str;
                                    $this_strlc = "\x01" . $this_strlc;
                                    $xsig[0] = "\x01" . $xsig[0];
                                } elseif ($xstrf !== '*') {
                                    $this_str = substr($this_str, $xstrf * 2);
                                    $this_strlc = substr($this_strlc, $xstrf * 2);
                                }
                                if ($xstrt !== '*') {
                                    $this_str = substr($this_str, 0, $xstrt * 2);
                                    $this_strlc = substr($this_strlc, 0, $xstrt * 2);
                                }
                                for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                    if (
                                        !substr_count($this_str, $xsig[$xsigi]) &&
                                        !substr_count($this_strlc, $xsig[$xsigi])
                                    ) {
                                        continue 2;
                                    }
                                    if ($xsigc > 1) {
                                        if (substr_count($this_str, $xsig[$xsigi])) {
                                            $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                        }
                                        if (substr_count($this_strlc, $xsig[$xsigi])) {
                                            $this_strlc = substraf($this_strlc, $xsig[$xsigi] . '>');
                                        }
                                    }
                                }
                                $this_str = $this_strlc = false;
                                $f .= phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                    }
                }
            }
            break;
        }
        while (true) {
            if (!isset($phpMussel['memCache']['mail_clamav_regex.cvd'])) {
                $phpMussel['memCache']['mail_clamav_regex.cvd'] =
                    @file($phpMussel['sigPath'] . 'mail_clamav_regex.cvd');
            }
            if (!$phpMussel['memCache']['mail_clamav_regex.cvd']) {
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    return -1;
                }
                break;
            }
            if (!isset($phpMussel['memCache']['mail_clamav_regex.map'])) {
                $phpMussel['memCache']['mail_clamav_regex.map'] =
                    @file($phpMussel['sigPath'] . 'mail_clamav_regex.map');
            }
            if (!$phpMussel['memCache']['mail_clamav_regex.map']) {
                if (!$phpMussel['Config']['signatures']['fail_silently']) {
                    return -1;
                }
                break;
            }
            $c = count($phpMussel['memCache']['mail_clamav_regex.map']);
            for ($i = 0; $i < $c; $i++) {
                $map = explode(':', $phpMussel['memCache']['mail_clamav_regex.map'][$i]);
                $map[2] = (int)$map[2];
                if (substr_count($hex, $map[0]) > 0) {
                    for ($xind = $map[1]; $xind < ($map[2] + 1); $xind++) {
                        $xsig = $phpMussel['memCache']['mail_clamav_regex.cvd'][$xind];
                        if (substr_count($xsig, ':')) {
                            $vn = @explode(':', $xsig);
                            $xsig = @preg_split('/[\x00-\x1f]+/', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                            $xsig = ($xsig === false ? '' : implode('', $xsig));
                            $xlen = strlen($xsig);
                            if (
                                $xlen < $phpMussel['Config']['signatures']['rx_siglen_min'] ||
                                $xlen > $phpMussel['Config']['signatures']['rx_siglen_max']
                            ) {
                                continue;
                            }
                            $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                            $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                            $vn = vn_shorthand($vn[0]);
                            if ($hexlen < $xlen) {
                                continue;
                            }
                            if (
                                !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                                !$phpMussel['memCache']['ignoreme']
                            ) {
                                if ($xstrf == '*') {
                                    if ($xstrt == '*') {
                                        if (
                                            !preg_match('/' . $xsig . '/i', $hex) &&
                                            !preg_match('/' . $xsig . '/i', $hexlc)
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/' . $xsig . '/i', substr($hex, 0, $xstrt * 2)) &&
                                        !preg_match('/' . $xsig . '/i', substr($hexlc, 0, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                } elseif ($xstrf == 'A') {
                                    if ($xstrt == '*') {
                                        if (
                                            !preg_match('/\A' . $xsig . '/i', $hex) &&
                                            !preg_match('/\A' . $xsig . '/i', $hexlc)
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/\A' . $xsig . '/i', substr($hex, 0, $xstrt * 2)) &&
                                        !preg_match('/\A' . $xsig . '/i', substr($hexlc, 0, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                } else {
                                    if ($xstrt == '*') {
                                        if (
                                            !preg_match('/' . $xsig . '/i', substr($hex, $xstrf * 2)) &&
                                            !preg_match('/' . $xsig . '/i', substr($hexlc, $xstrf * 2))
                                        ) {
                                            continue;
                                        }
                                    } elseif (
                                        !preg_match('/' . $xsig . '/i', substr($hex, $xstrf * 2, $xstrt * 2)) &&
                                        !preg_match('/' . $xsig . '/i', substr($hexlc, $xstrf * 2, $xstrt * 2))
                                    ) {
                                        continue;
                                    }
                                }
                                $f .= phpMusselV(
                                    array('vn' => $vn),
                                    $phpMussel['Config']['lang']['detected']
                                ) . $phpMussel['Config']['lang']['_exclamation'];
                            }
                        }
                    }
                }
            }
            break;
        }
    }
    for ($SigSet = 0; $SigSet < 2; $SigSet++) {
        $SigFileRX = $SigFileSD = false;
        if (
            $SigSet === 0 &&
            $phpMussel['Config']['signatures']['mail_custom']
        ) {
            $SigFileSD='mail_custom_standard.cvd';
            $SigFileRX='mail_custom_regex.cvd';
        } elseif (
            $SigSet === 1 &&
            $phpMussel['Config']['signatures']['mail_mussel']
        ) {
            $SigFileSD='mail_mussel_standard.cvd';
            $SigFileRX='mail_mussel_regex.cvd';
        }
        if ($SigFileSD && $SigFileRX) {
            while (true) {
                if (!isset($phpMussel['memCache'][$SigFileSD])) {
                    $phpMussel['memCache'][$SigFileSD] = @file($phpMussel['sigPath'] . $SigFileSD);
                }
                if (!$phpMussel['memCache'][$SigFileSD]) {
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        return -1;
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigFileSD]);
                for ($i = 0; $i < $c; $i++) {
                    $xsig = $phpMussel['memCache'][$SigFileSD][$i];
                    if (substr($xsig, 0, 1) == '>') {
                        $xsig = explode('>', $xsig, 4);
                        $xsig[3] = (int)$xsig[3];
                        if ($xsig[1] == 'STR') {
                            if (!substr_count($hex, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-LC') {
                            if (!substr_count($hexlc, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-RX') {
                            if (!preg_match('/' . $xsig[2] . '/i', $hex)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-RX-LC') {
                            if (!preg_match('/' . $xsig[2] . '/i', $hexlc)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif (substr($xsig[1], 0, 1) == '$') {
                            $vf = substr($xsig[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        } elseif (substr($xsig[1], 0, 2) == '!$') {
                            $vf = substr($xsig[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                        continue;
                    }
                    if (substr_count($xsig, ':')) {
                        $vn = @explode(':', $xsig);
                        $xsig = @preg_split('/[^a-fA-F0-9>]+/i', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                        $xsig = ($xsig === false ? '' : implode('', $xsig));
                        $xlen = strlen($xsig);
                        if (
                            $xlen < $phpMussel['Config']['signatures']['sd_siglen_min'] ||
                            $xlen > $phpMussel['Config']['signatures']['sd_siglen_max']
                        ) {
                            continue;
                        }
                        $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                        $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                        $vn = vn_shorthand($vn[0]);
                        if ($hexlen < $xlen) {
                            continue;
                        }
                        if (
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            $xsig = (substr_count($xsig, '>')) ? explode('>', $xsig) : array($xsig);
                            $xsigc = count($xsig);
                            $this_str = $hex;
                            $this_strlc = $hexlc;
                            if ($xstrf == 'A') {
                                $this_str = "\x01" . $this_str;
                                $this_strlc = "\x01" . $this_strlc;
                                $xsig[0] = "\x01" . $xsig[0];
                            } elseif ($xstrf != '*') {
                                $this_str = substr($this_str, $xstrf * 2);
                                $this_strlc = substr($this_strlc, $xstrf * 2);
                            }
                            if ($xstrt != '*') {
                                $this_str = substr($this_str, 0, $xstrt * 2);
                                $this_strlc = substr($this_strlc, 0, $xstrt * 2);
                            }
                            for ($xsigi = 0; $xsigi < $xsigc; $xsigi++) {
                                if (
                                    !substr_count($this_str, $xsig[$xsigi]) &&
                                    !substr_count($this_strlc, $xsig[$xsigi])
                                ) {
                                    continue 2;
                                }
                                if ($xsigc > 1) {
                                    if (substr_count($this_str, $xsig[$xsigi])) {
                                        $this_str = substraf($this_str, $xsig[$xsigi] . '>');
                                    }
                                    if (substr_count($this_strlc, $xsig[$xsigi])) {
                                        $this_strlc = substraf($this_strlc, $xsig[$xsigi] . '>');
                                    }
                                }
                            }
                            $this_str = $this_strlc = false;
                            $f .= phpMusselV(
                                array('vn' => $vn),
                                $phpMussel['Config']['lang']['detected']
                            ) . $phpMussel['Config']['lang']['_exclamation'];
                        }
                    }
                }
                break;
            }
            while (true) {
                if (!isset($phpMussel['memCache'][$SigFileRX])) {
                    $phpMussel['memCache'][$SigFileRX] =
                        @file($phpMussel['sigPath'] . $SigFileRX);
                }
                if (!$phpMussel['memCache'][$SigFileRX]) {
                    if (!$phpMussel['Config']['signatures']['fail_silently']) {
                        return -1;
                    }
                    break;
                }
                $c = count($phpMussel['memCache'][$SigFileRX]);
                for ($i = 0; $i < $c; $i++) {
                    $xsig = $phpMussel['memCache'][$SigFileRX][$i];
                    if (substr($xsig, 0, 1) == '>') {
                        $xsig = explode('>', $xsig, 4);
                        $xsig[3] = (int)$xsig[3];
                        if ($xsig[1] == 'STR') {
                            if (!substr_count($hex, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-LC') {
                            if (!substr_count($hexlc, $xsig[2])) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-RX') {
                            if (!preg_match('/' . $xsig[2] . '/i', $hex)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif ($xsig[1] == 'STR-RX-LC') {
                            if (!preg_match('/' . $xsig[2] . '/i', $hexlc)) {
                                if ($xsig[3] <= $i) {
                                    break;
                                }
                                $i = $xsig[3] - 1;
                            }
                        } elseif (substr($xsig[1], 0, 1) == '$') {
                            $vf = substr($xsig[1], 1);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf != $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        } elseif (substr($xsig[1], 0, 2) == '!$') {
                            $vf = substr($xsig[1], 2);
                            if (isset($$vf) && !is_array($$vf)) {
                                if ($$vf == $xsig[2]) {
                                    if ($xsig[3] <= $i) {
                                        break;
                                    }
                                    $i = $xsig[3] - 1;
                                }
                                continue;
                            }
                            if ($xsig[3] <= $i) {
                                break;
                            }
                            $i = $xsig[3] - 1;
                        }
                        continue;
                    }
                    if (substr_count($xsig, ':')) {
                        $vn = @explode(':', $xsig);
                        $xsig = @preg_split('/[\x00-\x1f]+/', $vn[1], -1, PREG_SPLIT_NO_EMPTY);
                        $xsig = ($xsig === false ? '' : implode('', $xsig));
                        $xlen = strlen($xsig);
                        if (
                            $xlen < $phpMussel['Config']['signatures']['rx_siglen_min'] ||
                            $xlen > $phpMussel['Config']['signatures']['rx_siglen_max']
                        ) {
                            continue;
                        }
                        $xstrf = (isset($vn[2])) ? $vn[2] : '*';
                        $xstrt = (isset($vn[3])) ? $vn[3] : '*';
                        $vn = vn_shorthand($vn[0]);
                        if ($hexlen < $xlen) {
                            continue;
                        }
                        if (
                            !substr_count($phpMussel['memCache']['greylist'], ',' . $vn . ',') &&
                            !$phpMussel['memCache']['ignoreme']
                        ) {
                            if ($xstrf == '*') {
                                if ($xstrt == '*') {
                                    if (
                                        !preg_match('/' . $xsig . '/i', $hex) &&
                                        !preg_match('/' . $xsig . '/i', $hexlc)
                                    ) {
                                        continue;
                                    }
                                } elseif (
                                    !preg_match('/' . $xsig . '/i', substr($hex, 0, $xstrt * 2)) &&
                                    !preg_match('/' . $xsig . '/i', substr($hexlc, 0, $xstrt * 2))
                                ) {
                                    continue;
                                }
                            } elseif ($xstrf == 'A') {
                                if ($xstrt == '*') {
                                    if (
                                        !preg_match('/\A' . $xsig . '/i', $hex) &&
                                        !preg_match('/\A' . $xsig . '/i', $hexlc)
                                    ) {
                                        continue;
                                    }
                                } elseif (
                                    !preg_match('/\A' . $xsig . '/i', substr($hex, 0, $xstrt * 2)) &&
                                    !preg_match('/\A' . $xsig . '/i', substr($hexlc, 0, $xstrt * 2))
                                ) {
                                    continue;
                                }
                            } else {
                                if ($xstrt == '*') {
                                    if (
                                        !preg_match('/' . $xsig . '/i', substr($hex, $xstrf * 2)) &&
                                        !preg_match('/' . $xsig . '/i', substr($hexlc, $xstrf * 2))
                                    ) {
                                        continue;
                                    }
                                } elseif (
                                    !preg_match('/' . $xsig . '/i', substr($hex, $xstrf * 2, $xstrt * 2)) &&
                                    !preg_match('/' . $xsig . '/i', substr($hexlc, $xstrf * 2, $xstrt * 2))
                                ) {
                                    continue;
                                }
                            }
                            $f .= phpMusselV(
                                array('vn' => $vn),
                                $phpMussel['Config']['lang']['detected']
                            ) . $phpMussel['Config']['lang']['_exclamation'];
                        }
                    }
                }
                break;
            }
        }
    }
    // AAA urlscanner functionality for phpMussel_mail() BEGIN
    if ($phpMussel['Config']['urlscanner']['urlscanner']) {
        $norm = prescan_normalise($body);
        $normlen = strlen($norm);
    } else {
        $normlen = 0;
    }
    if ($normlen) {
        $urlscanner = array();
        $urlscanner['req_c'] =
        $urlscanner['domains_c'] =
        $urlscanner['urls_c'] = 0;
        if (!isset($phpMussel['memCache']['urlscanner.cvd'])) {
            $phpMussel['memCache']['urlscanner.cvd'] = phpMusselFile($phpMussel['sigPath'] . 'urlscanner.cvd');
        }
        if (!$phpMussel['memCache']['urlscanner.cvd']) {
            if (!$phpMussel['Config']['signatures']['fail_silently']) {
                return -1;
            }
        } else {
            $urlscanner['domains_p'] =
            $urlscanner['domains'] =
            $urlscanner['tlds'] = array();
            $urlscanner['z'] = 0;
            $urlscanner['c'] = preg_match_all(
                '/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.' .
                ')?([0-9a-z.-]{1,512})[^0-9a-z.-]/i',
                $norm,
                $urlscanner['m']
            );
            for ($urlscanner['i'] = 0; $urlscanner['c'] > $urlscanner['i']; $urlscanner['i']++) {
                $urlscanner['this'] =
                    md5($urlscanner['m'][3][$urlscanner['i']]) . ':' .
                    strlen($urlscanner['m'][3][$urlscanner['i']]) . ':';
                $urlscanner['domains_nolookup'] =
                    'DOMAIN-NOLOOKUP:' . $urlscanner['this'];
                if (!substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['domains_nolookup'])) {
                    $urlscanner['domains_p'][$urlscanner['z']] = $urlscanner['m'][3][$urlscanner['i']];
                    if (substr_count($urlscanner['domains_p'][$urlscanner['z']], '.')) {
                        $urlscanner['tlds'][$urlscanner['z']] =
                            substral($urlscanner['domains_p'][$urlscanner['z']], '.');
                    }
                    $urlscanner['domains'][$urlscanner['z']] =
                        'DOMAIN:' . $urlscanner['this'];
                    $urlscanner['z']++;
                }
            }
            $urlscanner['m'] = '';
            $urlscanner['domains_p'] = array_unique($urlscanner['domains_p']);
            $urlscanner['domains'] = array_unique($urlscanner['domains']);
            $urlscanner['tlds'] = array_unique($urlscanner['tlds']);
            sort($urlscanner['domains_p']);
            sort($urlscanner['domains']);
            sort($urlscanner['tlds']);
            $urlscanner['tldc'] = count($urlscanner['tlds']);
            for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['tldc']; $urlscanner['i']++) {
                if (substr_count($phpMussel['memCache']['urlscanner.cvd'], 'TLD:' . $urlscanner['tlds'][$urlscanner['i']] . ':')) {
                    $xsig =
                        substraf($phpMussel['memCache']['urlscanner.cvd'], 'TLD:' . $urlscanner['tlds'][$urlscanner['i']] . ':');
                    if (substr_count($xsig, "\n")) {
                        $xsig = substrbf($xsig, "\n");
                    }
                    $xsig = vn_shorthand($xsig);
                    if (
                        $xsig &&
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        $f .= phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                }
            }
            $urlscanner['domains_c'] = count($urlscanner['domains']);
            for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['domains_c']; $urlscanner['i']++) {
                if (substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['domains'][$urlscanner['i']])) {
                    $xsig =
                        substraf($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['domains'][$urlscanner['i']]);
                    if (substr_count($xsig, "\n")) {
                        $xsig = substrbf($xsig, "\n");
                    }
                    $xsig = vn_shorthand($xsig);
                    if (
                        $xsig &&
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        $f .= phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                }
            }
            $xsig = '';
            $urlscanner['urls_p'] =
            $urlscanner['urls'] =
            $urlscanner['queries'] = array();
            $urlscanner['z'] = 0;
            $urlscanner['c'] = preg_match_all(
                '/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.' .
                ')?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4096})(\&quot;|[;"\'\(\)' .
                '\[\]\{\}])/i',
                $norm,
                $urlscanner['m']
            );
            for ($urlscanner['i'] = 0; $urlscanner['c'] > $urlscanner['i']; $urlscanner['i']++) {
                $urlscanner['this'] =
                    md5($urlscanner['m'][3][$urlscanner['i']]) . ':' .
                    strlen($urlscanner['m'][3][$urlscanner['i']]) . ':';
                $urlscanner['urls_nolookup'] =
                    'URL-NOLOOKUP:' . $urlscanner['this'];
                if (!substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['urls_nolookup'])) {
                    $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['m'][3][$urlscanner['i']];
                    $urlscanner['urls'][$urlscanner['z']] =
                        'URL:' . $urlscanner['this'];
                    $urlscanner['z']++;
                }
                if (preg_match('/[^0-9a-z.-]$/i', $urlscanner['m'][3][$urlscanner['i']])) {
                    $urlscanner['x'] =
                        preg_replace('/[^0-9a-z.-]+$/i', '', $urlscanner['m'][3][$urlscanner['i']]);
                    $urlscanner['this'] =
                        md5($urlscanner['x']) . ':' .
                        strlen($urlscanner['x']) . ':';
                    $urlscanner['urls_nolookup'] =
                        'URL-NOLOOKUP:' . $urlscanner['this'];
                    if (!substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['urls_nolookup'])) {
                        $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['x'];
                        $urlscanner['urls'][$urlscanner['z']] =
                            'URL:' . $urlscanner['this'];
                        $urlscanner['z']++;
                    }
                }
                if (substr_count($urlscanner['m'][3][$urlscanner['i']], '?')) {
                    $urlscanner['x'] =
                        substrbf($urlscanner['m'][3][$urlscanner['i']], '?');
                    $urlscanner['this'] =
                        md5($urlscanner['x']) . ':' .
                        strlen($urlscanner['x']) . ':';
                    $urlscanner['urls_nolookup'] =
                        'URL-NOLOOKUP:' . $urlscanner['this'];
                    if (!substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['urls_nolookup'])) {
                        $urlscanner['urls_p'][$urlscanner['z']] = $urlscanner['x'];
                        $urlscanner['urls'][$urlscanner['z']] =
                            'URL:' . $urlscanner['this'];
                    }
                    $urlscanner['x'] =
                        substraf($urlscanner['m'][3][$urlscanner['i']], '?');
                    $urlscanner['queries'][$urlscanner['z']] =
                        'QUERY:' . md5($urlscanner['x']) . ':' .
                        strlen($urlscanner['x']) . ':';
                    $urlscanner['z']++;
                }
            }
            $urlscanner['m'] = '';
            $urlscanner['urls_p'] = array_unique($urlscanner['urls_p']);
            $urlscanner['urls'] = array_unique($urlscanner['urls']);
            $urlscanner['queries'] = array_unique($urlscanner['queries']);
            sort($urlscanner['urls_p']);
            sort($urlscanner['urls']);
            sort($urlscanner['queries']);
            $urlscanner['urls_c'] = count($urlscanner['urls']);
            for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['urls_c']; $urlscanner['i']++) {
                if (substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['urls'][$urlscanner['i']])) {
                    $xsig =
                        substraf($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['urls'][$urlscanner['i']]);
                    if (substr_count($xsig, "\n")) {
                        $xsig = substrbf($xsig, "\n");
                    }
                    $xsig = vn_shorthand($xsig);
                    if (
                        $xsig &&
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        $f .= phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                }
            }
            $urlscanner['queries_c'] = count($urlscanner['queries']);
            for ($urlscanner['i'] = 0; $urlscanner['i'] < $urlscanner['queries_c']; $urlscanner['i']++) {
                if (substr_count($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['queries'][$urlscanner['i']])) {
                    $xsig =
                        substraf($phpMussel['memCache']['urlscanner.cvd'], $urlscanner['queries'][$urlscanner['i']]);
                    if (substr_count($xsig, "\n")) {
                        $xsig = substrbf($xsig, "\n");
                    }
                    $xsig = vn_shorthand($xsig);
                    if (
                        $xsig &&
                        !substr_count($phpMussel['memCache']['greylist'], ',' . $xsig . ',') &&
                        !$phpMussel['memCache']['ignoreme']
                    ) {
                        $f .= phpMusselV(
                            array('vn' => $xsig),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                }
            }
            $urlscanner['domains_c'] = count($urlscanner['domains_p']);
        }
        if (
            !$f &&
            $phpMussel['Config']['urlscanner']['lookup_hphosts'] &&
            $urlscanner['domains_c']
        ) {
            if (!isset($phpMussel['memCache']['urlscanner_domains'])) {
                $phpMussel['memCache']['urlscanner_domains'] =
                    phpMusselCacheGet('urlscanner_domains');
            }
            $urlscanner['y'] =
                $phpMussel['time'] + $phpMussel['Config']['urlscanner']['cache_time'];
            $urlscanner['req_v'] = urlencode($phpMussel['ScriptIdent']);
            $urlscanner['classes'] = array(
                'EMD' => "\x1a\x82\x10\x1bXXX",
                'EXP' => "\x1a\x82\x10\x16XXX",
                'GRM' => "\x1a\x82\x10\x32XXX",
                'HFS' => "\x1a\x82\x10\x32XXX",
                'PHA' => "\x1a\x82\x10\x32XXX",
                'PSH' => "\x1a\x82\x10\x31XXX"
            );
            for ($i = 0; $i < $urlscanner['domains_c'];$i++) {
                if (
                    $phpMussel['Config']['urlscanner']['maximum_api_lookups'] > 0 &&
                    $urlscanner['req_c'] > $phpMussel['Config']['urlscanner']['maximum_api_lookups']
                ) {
                    if ($phpMussel['Config']['urlscanner']['maximum_api_lookups_response']) {
                        $f .=
                            $phpMussel['Config']['lang']['too_many_urls'] .
                            $phpMussel['Config']['lang']['_exclamation'];
                    }
                    break;
                }
                $urlscanner['this'] =
                    md5($urlscanner['domains_p'][$i]) . ':' .
                    strlen($urlscanner['domains_p'][$i]) . ':';
                if (substr_count($phpMussel['memCache']['urlscanner_domains'], $urlscanner['this'])) {
                    $urlscanner['class'] =
                        substrbf(substral($phpMussel['memCache']['urlscanner_domains'], $urlscanner['this']), ';');
                    $urlscanner['expiry'] =
                        substrbf($urlscanner['class'],':');
                    if ($urlscanner['expiry'] > $phpMussel['time']) {
                        $urlscanner['class'] =
                            substraf($urlscanner['class'],':');
                        if (!$urlscanner['class']) {
                            continue;
                        }
                        $urlscanner['class'] =
                            vn_shorthand($urlscanner['class']);
                        $f .= phpMusselV(
                            array('vn' => $urlscanner['class']),
                            $phpMussel['Config']['lang']['detected']
                        ) . $phpMussel['Config']['lang']['_exclamation'];
                        break;
                    }
                }
                $urlscanner['req'] =
                    'v=' . $urlscanner['req_v'] .
                    '&s=' . $urlscanner['domains_p'][$i] .
                    '&class=true';
                $urlscanner['req_context'] = array(
                    'http' => array(
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1',
                        'user_agent' => $phpMussel['ScriptUA'],
                        'content' => $urlscanner['req'],
                        'timeout' => 12
                    )
                );
                $urlscanner['req_stream'] =
                    stream_context_create($urlscanner['req_context']);
                $urlscanner['req_result'] = @file_get_contents(
                    'http://verify.hosts-file.net/?' . $urlscanner['req'],
                    false,
                    $urlscanner['req_stream']
                );
                $urlscanner['req_c']++;
                if (substr($urlscanner['req_result'], 0, 6) == "Listed") {
                    $urlscanner['class'] =
                        substr($urlscanner['req_result'], 7, 3);
                    $urlscanner['class'] =
                        (isset($urlscanner['classes'][$urlscanner['class']])) ?
                        $urlscanner['classes'][$urlscanner['class']] :
                        "\x1a\x82\x10\x3fXXX";
                    $phpMussel['memCache']['urlscanner_domains'] .=
                        $urlscanner['this'] .
                        $urlscanner['y'] . ':' .
                        $urlscanner['class'] . ';';
                    $urlscanner['class'] =
                        vn_shorthand($urlscanner['class']);
                    $f .= phpMusselV(
                        array('vn' => $urlscanner['class']),
                        $phpMussel['Config']['lang']['detected']
                    ) . $phpMussel['Config']['lang']['_exclamation'];
                    break;
                }
                $phpMussel['memCache']['urlscanner_domains'] .=
                    $urlscanner['domains'][$i] . $urlscanner['y'] . ':;';
            }
            $urlscanner['y'] =
                phpMusselCacheSet('urlscanner_domains', $urlscanner['y'], $phpMussel['memCache']['urlscanner_domains']);
        }
        unset($urlscanner);
    }
    // AAA urlscanner functionality for phpMussel_mail() END

    /** Plugin hook: "after_scan_mail". */
    if (
        isset($phpMussel['MusselPlugins']['hookcounts']['after_scan_mail']) &&
        $phpMussel['MusselPlugins']['hookcounts']['after_scan_mail'] > 0
    ) {
        reset($phpMussel['MusselPlugins']['hooks']['after_scan_mail']);
        for (
            $phpMussel['MusselPlugins']['tempdata']['i'] = 0;
            $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['after_scan_mail'];
            $phpMussel['MusselPlugins']['tempdata']['i']++
        ) {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['after_scan_mail']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['after_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']])) {
                $phpMussel['MusselPlugins']['hooks']['after_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']] =
                    array($phpMussel['MusselPlugins']['hooks']['after_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            }
            $phpMussel['MusselPlugins']['tempdata']['kc'] =
                count($phpMussel['MusselPlugins']['hooks']['after_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for (
                $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];
                $phpMussel['MusselPlugins']['tempdata']['ki']++
            ) {
                $x = $phpMussel['MusselPlugins']['hooks']['after_scan_mail'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x) {
                    $phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] =
                        (isset($$x)) ? $$x : $x;
                }
            }
            $phpMussel['MusselPlugins']['tempdata']['out'] =
                call_user_func($phpMussel['MusselPlugins']['tempdata']['k'], $phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for (
                    $phpMussel['MusselPlugins']['tempdata']['ki'] = 0;
                    $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];
                    $phpMussel['MusselPlugins']['tempdata']['ki']++
                ) {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($phpMussel['MusselPlugins']['tempdata']['out']);
                }
            }
            next($phpMussel['MusselPlugins']['hooks']['after_scan_mail']);
        }
        $phpMussel['MusselPlugins']['tempdata'] = array();
    }

    return (!$f) ? 0 : $f;

}
