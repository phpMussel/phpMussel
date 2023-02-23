<?php
/**
 * Demojibakefier (last modified: 2023.02.23).
 *
 * Intended to normalise the character encoding of a given string to a
 * preferred character encoding when the given string's byte sequences don't
 * match the expectations of the preferred character encoding. Useful in cases
 * where a block of data might conceivably be composed of several different
 * unspecified, unknown encodings. Note that the class isn't intended to test
 * the intelligibility of a string, nor to consider the wider context of its
 * implementation. Also, it mightn't yet always behave reliably, intuitively,
 * or as desired by the implementation. It should only be used as a last
 * resort, when everything else has already failed.
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE", as well as the earliest iteration and deployment
 * of this class, COPYRIGHT 2019 and beyond by Caleb Mazalevskis (Maikuolan).
 */

namespace Maikuolan\Common;

class Demojibakefier
{
    /**
     * @var string Supplied to the class at object instantiation or thereafter.
     */
    public $NormaliseTo = 'UTF-8';

    /**
     * @var string Encoding of the most recent chosen string character encoding candidate.
     */
    public $Last = '';

    /**
     * @var int Length of the string most recently supplied to normalise.
     */
    public $Len = -1;

    /**
     * @var int Maximum number of segments allowed within a string to be normalised.
     */
    public $Segments = 65536;

    /**
     * @var string Some early control characters (w/o tabs, CR, or LF).
     */
    const CTRL0 = '\x00-\x08\x0B\x0C\x0E-\x1F';

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.9.5';

    /**
     * Constructor.
     *
     * @param string $NormaliseTo The encoding to normalise to (defaults to UTF-8).
     * @return void
     */
    public function __construct($NormaliseTo = '')
    {
        if ($NormaliseTo !== '' && in_array($NormaliseTo, $this->supported())) {
            $this->NormaliseTo = $NormaliseTo;
        }
    }

    /**
     * Returns an array of the encoding types that the class supports (in the recommended order of precedence).
     *
     * @return array An array of the encoding types that the class supports.
     */
    public function supported()
    {
        return [
            'UTF-8',
            'UTF-16BE',
            'UTF-16LE',
            'ISO-8859-1',
            'CP1252',
            'ISO-8859-2',
            'ISO-8859-3',
            'ISO-8859-4',
            'ISO-8859-5',
            'ISO-8859-6',
            'ISO-8859-7',
            'ISO-8859-8',
            'ISO-8859-9',
            'ISO-8859-10',
            'ISO-8859-11',
            'ISO-8859-13',
            'ISO-8859-14',
            'ISO-8859-15',
            'ISO-8859-16',
            'CP1250',
            'CP1251',
            'CP1253',
            'CP1254',
            'CP1255',
            'CP1256',
            'CP1257',
            'CP1258',
            'GB18030',
            'GB2312',
            'BIG5',
            'SHIFT-JIS',
            'JOHAB',
            'UCS-2',
            'UTF-32BE',
            'UTF-32LE',
            'UCS-4',
            'CP437',
            'CP737',
            'CP775',
            'CP850',
            'CP852',
            'CP855',
            'CP857',
            'CP860',
            'CP861',
            'CP862',
            'CP863',
            'CP864',
            'CP865',
            'CP866',
            'CP869',
            'CP874',
            'KOI8-RU',
            'KOI8-R',
            'KOI8-U',
            'KOI8-F',
            'KOI8-T',
            'CP037',
            'CP500',
            'CP858',
            'CP875',
            'CP1026'
        ];
    }

    /**
     * Checks for byte sequences that shouldn't normally appear in a specified character encoding as a means of roughly
     * guessing whether the string likely conforms to the specified character encoding.
     *
     * @param string $String The string to check.
     * @param string $Encoding The encoding to check against (defaults to NormaliseTo).
     * @return bool True if the string conforms (per specs), or false otherwise.
     */
    public function checkConformity($String, $Encoding = '')
    {
        if ($Encoding === '') {
            $Encoding = $this->NormaliseTo;
        }
        /**
         * @link https://tools.ietf.org/html/rfc3629#section-4
         * @link https://stackify.dev/253347-regex-to-detect-invalid-utf-8-string
         */
        if ($Encoding === 'UTF-8') {
            return !preg_match(
                '~[' . self::CTRL0 . '\x7F\xC0\xC1\xF5-\xFF]|' .
                '[\xC2-\xDF](?![\x80-\xBF])|' .
                '\xE0(?![\xA0-\xBF][\x80-\xBF])|' .
                '[\xE1-\xEC](?![\x80-\xBF]{2})|' .
                '\xED(?![\x80-\x9F][\x80-\xBF])|' .
                '\xF0(?![\x90-\xBF][\x80-\xBF]{2})|' .
                '[\xF1-\xF3](?![\x80-\xBF]{3})|' .
                '\xF4(?![\x80-\x8F][\x80-\xBF]{2})|' .
                '(?<=[\x00-\x7F\xF5-\xFF])[\x80-\xBF]|' .
                '(?<=[\xE0-\xEF])[\x80-\xBF](?![\x80-\xBF])|' .
                '(?<=[\xF0-\xF4])[\x80-\xBF](?![\x80-\xBF]{2})|' .
                '(?<=[\xF0-\xF4][\x80-\xBF])[\x80-\xBF](?![\x80-\xBF])~',
                $String
            );
        }
        /**
         * @link https://en.wikipedia.org/wiki/UTF-16
         * @link https://unicode.org/faq/utf_bom.html
         */
        if ($Encoding === 'UTF-16BE') {
            return !(strlen($String) % 2) && !preg_match(
                '~[\xD8-\xDB][\x00-\xFF](?![\xDC-\xDF][\x00-\xFF])|(?<![\xD8-\xDB][\x00-\xFF])[\xDC-\xDF][\x00-\xFF]~',
                $String
            );
        }
        /**
         * @link https://en.wikipedia.org/wiki/UTF-16
         * @link https://unicode.org/faq/utf_bom.html
         */
        if ($Encoding === 'UTF-16LE') {
            return !(strlen($String) % 2) && !preg_match(
                '~[\x00-\xFF][\xDC-\xDF](?![\x00-\xFF][\xD8-\xDB])|(?<![\x00-\xFF][\xDC-\xDF])[\x00-\xFF][\xD8-\xDB]~',
                $String
            );
        }
        if (preg_match('~^ISO-8859-(?:[12459]|1[03456])$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\x9F\xAD]~', $String);
        }
        if ($Encoding === 'ISO-8859-3') {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\x9F\xA5\xAD\xAE\xBE\xC3\xD0\xE3\xF0]~', $String);
        }
        if ($Encoding === 'ISO-8859-6') {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\xA3\xA5-\xAB\xAD-\xBA\xBC-\xBE\xC0\xDB-\xDF\xF3-\xFF]~', $String);
        }
        if ($Encoding === 'ISO-8859-7') {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\x9F\xA4\xA5\xAA\xAD\xAE\xD2\xFF]~', $String);
        }
        if ($Encoding === 'ISO-8859-8') {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\x9F\xA1\xAD\xBF-\xDE\xFB-\xFF]~', $String);
        }
        if ($Encoding === 'ISO-8859-11') {
            return !preg_match('~[' . self::CTRL0 . '\X7F-\xA0\xDB-\xDE\xFC-\xFF]~', $String);
        }
        if ($Encoding === 'CP1250') { // Windows-1250
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x83\x88\x98\xAD]~', $String);
        }
        if ($Encoding === 'CP1251') { // Windows-1251
            return !preg_match('~[' . self::CTRL0 . '\x7F\x98\xAD]~', $String);
        }
        if ($Encoding === 'CP1252') { // Windows-1252
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x8D\x8F\x90\x9D\xAD]~', $String);
        }
        if ($Encoding === 'CP1253') { // Windows-1253
            return !preg_match('~[' . self::CTRL0 . '\X7F\x81\x88\x8A\x8C-\x8F\x90\x98\x9A\x9C-\x9F\xAA\xAD\xD2\xFF]~', $String);
        }
        if ($Encoding === 'CP1254') { // Windows-1254
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x8D-\x8F\x90\x9D\x9E\xAD]~', $String);
        }
        if ($Encoding === 'CP1255') { // Windows-1255
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x8A\x8C-\x8F\x90\x9A\x9C-\x9F\xAD\xCA\xD9-\xDF\xFB\xFC\xFF]~', $String);
        }
        if ($Encoding === 'CP1256') { // Windows-1256
            return !preg_match('~[' . self::CTRL0 . '\x7F\xAD]~', $String);
        }
        if ($Encoding === 'CP1257') { // Windows-1257
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x83\x88\x8A\x8C\x90\x98\x9A\x9C\x9F\xA1\xA5\xAD]~', $String);
        }
        if ($Encoding === 'CP1258') { // Windows-1258
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81\x8A\x8D-\x8F\x90\x9A\x9D\x9E\xAD]~', $String);
        }
        if (preg_match('~^GB(?:18030|2312)$~', $Encoding)) { // GB18030 supersedes GB2312
            return !preg_match('~[' . self::CTRL0 . '\xFF]$~', $String);
        }
        if ($Encoding === 'BIG5') {
            return !preg_match('~[' . self::CTRL0 . '\xFF]|(?<![\xA1-\xF9])[\x80-\xA0]~', $String);
        }
        if ($Encoding === 'SHIFT-JIS') {
            return !preg_match(
                '~[' . self::CTRL0 . '\x7F\xFD-\xFF]|' .
                '[\x81-\xE9](?![\x40-\xFC])|' .
                '\xEA(?![\x40-\xA4])|' .
                '(?<![\x81-\xEA])\x80|' .
                '[\xEA-\xFC]{2}~',
                $String
            );
        }
        if ($Encoding === 'JOHAB') {
            return !preg_match('~[' . self::CTRL0 . '\x7F\xFF]|(?<![\x84-\xD3\xD8-\xDE\xE0-\xF9])[\xD4-\xD7\xDF\xFA-\xFE]~', $String);
        }
        /**
         * @link https://en.wikipedia.org/wiki/Universal_Coded_Character_Set
         */
        if ($Encoding === 'UCS-2') {
            return !(strlen($String) % 2);
        }
        /**
         * @link https://en.wikipedia.org/wiki/Universal_Coded_Character_Set
         * @link https://en.wikipedia.org/wiki/UTF-32
         */
        if (preg_match('~^UCS-4|UTF-32[BL]E$~', $Encoding)) {
            return !(strlen($String) % 4);
        }
        if (preg_match('~^CP(?:[47]37|86[012356])$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7F\xFF]~', $String);
        }
        if (preg_match('~^CP(?:775|85[0258])$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7F\xF0\xFF]~', $String);
        }
        if ($Encoding === 'CP857') {
            return !preg_match('~[' . self::CTRL0 . '\x7F\xD5\xE7\xF0\xF2\xFF]~', $String);
        }
        if ($Encoding === 'CP864') {
            return !preg_match('~[' . self::CTRL0 . '\x7F\x9B\x9C\x9F\xA1\xA6\xA7\xFF]~', $String);
        }
        if ($Encoding === 'CP869') {
            return !preg_match('~[' . self::CTRL0 . '\x7F-\x85\x87\x93\x94\xF0\xFF]~', $String);
        }
        if ($Encoding === 'CP874') {
            return !preg_match('~[' . self::CTRL0 . '\x7F\x81-\x84\x86-\x90\x98-\x9F\xDB-\xDE\xFC-\xFF]~', $String);
        }
        if (preg_match('~^KOI8-(?:[RUF]|RU)$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7F]~', $String);
        }
        if ($Encoding === 'KOI8-T') {
            return !preg_match('~[' . self::CTRL0 . '\x7F\x88\x8F\x98\x9A\x9C-\x9F\xA8-\xAA\xAF\xB4\xB8\xBA\xBC-\xBE]~', $String);
        }
        if (preg_match('~^CP(?:037|500)$~', $Encoding)) {
            return !preg_match('~[\x00-\x3F\xCA\xFF]~', $String);
        }
        if ($Encoding === 'CP875') {
            return !preg_match('~[\x00-\x3F\x74\xCA\xFF]~', $String);
        }
        if ($Encoding === 'CP1026') {
            return !preg_match('~[\x00-\x3F\xFF]~', $String);
        }

        /** Encoding not recognised; Assuming non-conformant and returning false accordingly. */
        return false;
    }

    /**
     * Calculate the shannon entropy of a string.
     * @link https://en.wikipedia.org/wiki/Entropy_(information_theory)
     *
     * @param string $String The string to check.
     * @return float|int The shannon entropy of the string.
     */
    public function shannonEntropy($String)
    {
        if (!$Len = strlen($String)) {
            return 0;
        }
        $Chars = [];
        for ($Pos = 0; $Pos < $Len; $Pos++) {
            $Char = substr($String, $Pos, 1);
            if (!isset($Chars[$Char])) {
                $Chars[$Char] = 0;
            }
            $Chars[$Char]++;
        }
        $Total = 0;
        foreach ($Chars as $Char) {
            $Total += abs(($Char / $Len) * log(($Char / $Len), 2));
        }
        return $Total;
    }

    /**
     * Attempts to normalise a string.
     *
     * @param string $String The string to normalise.
     * @return string The normalised string (could be the same as the input, if there isn't anything to normalise).
     */
    public function normalise($String)
    {
        $this->Last = '';
        $this->Len = strlen($String);

        /** Return early if the string is empty. */
        if ($this->Len === 0) {
            return $String;
        }

        /** Potential valid candidates will be populated here. */
        $Valid = [];

        /** Suppress errors (because every failed normalisation attempt will generate errors and fill logs otherwise). */
        set_error_handler(function ($errno) {
            return;
        });

        /** Cycle through supported encodings and attempt to generate valid candidates. */
        foreach ($this->supported() as $Encoding) {
            if (!$this->checkConformity($String, $Encoding)) {
                continue;
            }
            $Attempt = iconv($Encoding, $this->NormaliseTo, $String);
            if ($Attempt === false || !$this->checkConformity($Attempt, $this->NormaliseTo)) {
                continue;
            }
            if (strcmp(iconv($this->NormaliseTo, $Encoding, $Attempt), $String) === 0) {
                $Valid[$Encoding] = $Attempt;
                if ($Encoding === $this->NormaliseTo) {
                    break;
                }
            }
        }

        /** We're done.. Restore the error handler. */
        restore_error_handler();

        /** If the string conforms to our desired encoding, and can be reversed to it, we'll go with that. */
        if (isset($Valid[$this->NormaliseTo])) {
            $this->Last = $this->NormaliseTo;
            return $Valid[$this->NormaliseTo];
        }

        /** Okay.. Doesn't conform or can't be reversed. Time to apply weighting and some fuzzy heuristic guesswork. */
        foreach ($Valid as $Key => $Value) {
            $Valid[$Key] = ['String' => $Value, 'Weight' => 0];
        }
        $this->weigh($String, $Valid);

        /** Sort weights from highest to lowest and attempt to reduce candidates by the largest weight. */
        uasort($Valid, function ($A, $B) {
            return $A['Weight'] === $B['Weight'] ? 0 : ($A['Weight'] < $B['Weight'] ? 1 : -1);
        });

        $this->dropVariants($Valid);
        $Copy = $Valid;
        $Current = key($Valid);
        foreach ($Copy as $Key => $Value) {
            if ($Value['Weight'] < $Valid[$Current]['Weight']) {
                unset($Valid[$Key]);
            }
        }
        unset($Copy);

        /** Check whether we can return a single possible value. */
        if (($Count = count($Valid)) === 1) {
            $this->Last = $Current;
            return $Valid[$Current]['String'];
        }

        /**
         * Let's try splitting the string into parts and "demojibakefying" the individual parts, in case we have
         * a little better luck doing it that way (this may be the case if the string contains multiple encodings).
         */
        $Length = $this->Len;
        $Last = $this->Last;
        foreach ([
            "\xEF\xBF\xBD",
            "\0\0\0\0",
            "\0\r\0\n",
            "\r\0\n\0",
            "\r\n",
            "\0\r",
            "\r\0",
            "\0\n",
            "\n\0",
            "\0\0",
            "\0\t",
            "\t\0",
            "\r",
            "\n",
            "\t",
            "\x0A",
            "\x0B",
            "\x0C",
            "\x15",
            ': ',
            "\xEF\xBC\x9A",
            "\x85"
        ] as $Delimiter) {
            if (($Count = substr_count($String, $Delimiter)) && $Count < $this->Segments) {
                $Segments = explode($Delimiter, $String);
                foreach ($Segments as &$Segment) {
                    $Segment = $this->normalise($Segment);
                }
                $NewString = implode($Delimiter, $Segments);
                $this->Len = $Length;
                if ($NewString !== $String) {
                    $this->Last = 'Mixed';
                }
                return $NewString;
            }
        }

        /** If we haven't decided on a particular candidate by this point, we'll just return the original string. */
        return $String;
    }

    /**
     * Checks if the class requirements are met. If met, then calls checkConformity. If the string is non-conformant,
     * then calls normalise. If the class requirements aren't met, or if the string is already conformant, return the
     * original string immediately.
     *
     * @param string $String The string to normalise.
     * @return string The normalised string (could be the same as the input, if there isn't anything to normalise).
     */
    public function guard($String)
    {
        return !function_exists('iconv') || $this->checkConformity($String, $this->NormaliseTo) ? $String : $this->normalise($String);
    }

    /**
     * Attempts to apply weighting to potential candidates based on the frequency/occurrence of specific byte sequences
     * and lack thereof, and on whatever other means of rough guesswork I can think of (feel free to suggest changes if
     * you think anything here is wrong, or if you can think of possible improvements).
     *
     * @param string $String The originally supplied string.
     * @param array $Arr An array of potential candidates.
     * @return void
     */
    private function weigh($String, array &$Arr)
    {
        /** For when it really, really looks like UTF-8 (easier to detect in isolation than other encodings). */
        if (isset($Arr['UTF-8']['Weight']) && preg_match(
            '~\xE0[\xA0-\xBF][\x80-\xBF]|
            [\xE1-\xEC][\x80-\xBF]{2}|
            \xED[\x80-\x9F][\x80-\xBF]|
            \xF0[\x90-\xBF][\x80-\xBF]{2}|
            [\xF0-\xF3][\x80-\xBF]{3}|
            \xF4[\x80-\x9F][\x80-\xBF]~',
            $String
        )) {
            $Arr['UTF-8']['Weight'] += 5;
        }

        /** For when it (..kinda sorta maybe) looks like SHIFT-JIS. */
        if (isset($Arr['SHIFT-JIS']['Weight']) && preg_match('~[\x81-\xE9][\x40-\xFC]|\xEA[\x40-\xA4]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\x81-\xE9][\x40-\xFC]|\xEA[\x40-\xA4]~', '', $String);
            $Arr['SHIFT-JIS']['Weight'] += strlen($TestElse) ? 2 : 1;
        }

        /** For when it (..kinda sorta maybe) looks like JOHAB. */
        if (isset($Arr['JOHAB']['Weight']) && preg_match('~[\x84-\xD3][\x41-\x7E\x81-\xFE]|[\xD8-\xDE\xE0-\xF9][\x31-\x7E\x91-\xFE]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\x84-\xD3][\x41-\x7E\x81-\xFE]|[\xD8-\xDE\xE0-\xF9][\x31-\x7E\x91-\xFE]~', '', $String);
            $Arr['JOHAB']['Weight'] += strlen($TestElse) ? 2 : 1;
        }

        /** For when it (..kinda sorta maybe) looks like BIG5. */
        if (isset($Arr['BIG5']['Weight']) && preg_match('~[\xA1-\xF9][\x80-\xA0]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\xA1-\xF9][\x80-\xA0]~', '', $String);
            $Arr['BIG5']['Weight'] += strlen($TestElse) ? 2 : 1;
        }

        /** For when it (..kinda sorta maybe) looks like UTF-16BE. */
        if (isset($Arr['UTF-16BE']['Weight']) && preg_match('~\0[\x20-\x7E]|[\xD8-\xDB][\x00-\xFF][\xDC-\xDF][\x00-\xFF]|[\xD8-\xDB][\x00-\xFF][\xDC-\xDF][\x00-\xFF]~', $String)) {
            $Arr['UTF-16BE']['Weight']++;
        }

        /** For when it (..kinda sorta maybe) looks like UTF-16LE. */
        if (isset($Arr['UTF-16LE']['Weight']) && preg_match('~[\x20-\x7E]\0|[\x00-\xFF][\xDC-\xDF][\x00-\xFF][\xD8-\xDB]|[\x00-\xFF][\xDC-\xDF][\x00-\xFF][\xD8-\xDB]~', $String)) {
            $Arr['UTF-16LE']['Weight']++;
        }

        /** Commonly found in UCS-2. */
        if (isset($Arr['UCS-2']['Weight']) && strpos($String, "\x1B") !== false) {
            $Arr['UCS-2']['Weight']++;
        }

        /** Commonly found in UCS-4/UTF-32. */
        if (preg_match('~\0\0|\x1B~', $String)) {
            foreach (['UCS-4', 'UTF-32BE', 'UTF-32LE'] as $Frequent) {
                if (isset($Arr[$Frequent]['Weight'])) {
                    $Arr[$Frequent]['Weight']++;
                }
            }
        }

        /** Probably English, or at least, some western European language, compatible with ASCII. Let's try ISO-8859-1. */
        if (isset($Arr['ISO-8859-1']['Weight']) && preg_match('~[\x20-\x7E]~', $String) && !preg_match('~[^\x20-\x7E\xE0-\xF6\xF8-\xFD]~', $String)) {
            $Arr['ISO-8859-1']['Weight'] += !preg_match('~[^\x20-\x7e]~', $String) ? 2 : 1;
        }

        /** There are some other encodings, too, that are used more frequently than others. Should account for these. */
        foreach (['CP1252', 'SHIFT-JIS', 'GB18030', 'GB2312'] as $Frequent) {
            if (isset($Arr[$Frequent]['Weight'])) {
                $Arr[$Frequent]['Weight']++;
            }
        }

        /** Compare frequency of byte sequences to try to adjust GB18030. */
        if (isset($Arr['GB18030']['Weight'])) {
            $With = (preg_match_all('~[\x81-\xFE][\x30-\x39]~', $String) / 2) + preg_match_all('~[\x81-\xFE][\x40-\x7E\x80-\xFE]~', $String);
            $Without = preg_match_all('~(?<![\x30-\x39])[\x81-\xFE](?![\x30-\x39])~', $String) + preg_match_all('~[\x81-\xFE](?![\x40-\x7E\x80-\xFE])~', $String);
            if ($With !== $Without) {
                $Arr['GB18030']['Weight'] += ($With > $Without) ? 0.5 : -0.5;
            }
        }

        /** GB18030 supersedes GB2312 and should be weighted accordingly. */
        if (isset($Arr['GB18030']['Weight'], $Arr['GB2312']['Weight']) && $Arr['GB18030']['Weight'] === $Arr['GB2312']['Weight'] && $Arr['GB18030']['Weight'] > 0) {
            $Arr['GB2312']['Weight']--;
        }

        $RateAZ = preg_match_all('~[\x41-\x5A\x61-\x7A]~', $String) / $this->Len;
        $EntrAZ = round(abs($RateAZ * log($RateAZ, 2)), 2);

        /** More common versus less common byte sequences in 1-byte encodings. */
        foreach ([
            'ISO-8859-5' => '[\xA1-\xAC\xAE-\xFF]',
            'ISO-8859-6' => '[\xA4\xAC\xBB\xBF\xC1-\xDA\xE0-\xF2]',
            'ISO-8859-7' => '[\xB4-\xD1\xD3-\xFE]',
            'ISO-8859-8' => '[\xE0-\xFA]',
            'ISO-8859-11' => '[\xA1-\xDA\xDF-\xFB]',
            'CP1251' => '[\x80-\x84\x8A-\x94\x9A-\x9F\xA1-\xAC\xAF\xB2-\xB4\xB8-\xFF]',
            'CP1253' => '[\xA1\xA2\xAB\xB8-\xBC\xBE-\xD1\xD3-\xFE]',
            'CP1255' => '[\xA4\xC0-\xC9\xCB-\xD8\xE0-\xFA\xFD\xFE]',
            'CP1256' => '[\x81\x8A\x8D-\x94\x98\x9A\x9D-\x9F\xA1\xAA\xBA\xBF-\xFF]',
            'CP737' => '[\x80-\xAF\xE0-\xF0]',
            'CP855' => '[\x80-\xAF\xB5-\xB8\xBC\xBE\xC6\xC7\xD0-\xD8\xDE\xE0-\xEF\xF1-\xFC]',
            'CP862' => '[\x80-\x9A]',
            'CP864' => '[\x99\x9A\x9D\x9E\xA2\xA4\xA5\xA8-\xFD]',
            'CP866' => '[\x80-\xAF\xE0-\xFA]',
            'CP869' => '[\x86\x8B-\x92\x95\x96\x98\x9B-\xAA\xAC-\xAD\xB5-\xB8\xBD\xBE\xC6\xC7\xCF-\xD8\xDD\xDE\xE0-\xEF\xF2-\xFD]',
            'CP874' => '[\xA1-\xDA\xDF-\xFB]',
            'KOI8-RU' => '[\xA3\xA4\xA6\xA7\xAD\xAE\xB3\xB4\xB6\xB7\xBD\xBE\xC0-\xFF]',
            'KOI8-R' => '[\xA3\xB3\xC0-\xFF]',
            'KOI8-U' => '[\xA3\xA4\xA6\xA7\xB3\xB4\xB6\xB7\xC0-\xFF]',
            'KOI8-F' => '[\xA1-\xAF\xB1-\xFF]',
            'KOI8-T' => '[\x80\x81\x83\x8A\x8C-\x8E\x90\xA1-\xA3\xA5\xB3\xB5\xC0-\xFF]'
        ] as $Encoding => $Bytes) {
            if (isset($Arr[$Encoding]['Weight'])) {
                $RateThis = preg_match_all('~' . $Bytes . '~', $String) / $this->Len;
                $EntrThis = round(abs($RateThis * log($RateThis, 2)), 2);
                if ($EntrThis !== $EntrAZ) {
                    $Arr[$Encoding]['Weight'] += ($EntrThis > $EntrAZ) ? 0.5 : -0.5;
                }
            }
        }

        /** If both UTF-16BE and UTF-16LE seem thus far valid and equally weighted, we'll try to dig a little deeper. */
        if (isset($Arr['UTF-16BE']['Weight'], $Arr['UTF-16LE']['Weight']) && $Arr['UTF-16BE']['Weight'] === $Arr['UTF-16LE']['Weight'] && $this->Len < 65536) {
            $Split = str_split($String, 2);
            $WeightBE = 0;
            $WeightLE = 0;
            foreach ($Split as $Pair) {
                if (preg_match('~^(?:[\x00-\x0F].|[\xD8-\xDB][\xDC-\xDF])$~', $Pair)) {
                    $WeightBE++;
                }
                if (preg_match('~^(?:.[\x00-\x0F]|[\xDC-\xDF][\xD8-\xDB])$~', $Pair)) {
                    $WeightLE++;
                }
            }
            if ($WeightBE !== $WeightLE) {
                if ($WeightBE > $WeightLE) {
                    $Arr['UTF-16BE']['Weight'] += 0.5;
                    $Arr['UTF-16LE']['Weight'] -= 0.5;
                } else {
                    $Arr['UTF-16BE']['Weight'] -= 0.5;
                    $Arr['UTF-16LE']['Weight'] += 0.5;
                }
            }

            /** Check for private use and high range byte sequences. Could indicate between BE/LE one being more likely than the other. */
            $WeightBE = 0;
            $WeightLE = 0;
            foreach ($Split as $Pair) {
                $BEPUC = preg_match('~^\xDB[\x80-\xFF]$~', $Pair);
                $LEPUC = preg_match('~^[\x80-\xFF]\xDB$~', $Pair);
                if ($BEPUC && !$LEPUC) {
                    $WeightBE++;
                } elseif (!$BEPUC && $LEPUC) {
                    $WeightLE++;
                }
            }
            if ($WeightBE !== $WeightLE) {
                if ($WeightBE > $WeightLE) {
                    $Arr['UTF-16BE']['Weight'] += 0.5;
                    $Arr['UTF-16LE']['Weight'] -= 0.5;
                } else {
                    $Arr['UTF-16BE']['Weight'] -= 0.5;
                    $Arr['UTF-16LE']['Weight'] += 0.5;
                }
            }
        }

        /** Favour UTF-16 more than UCS-2. */
        foreach (['UTF-16BE', 'UTF-16LE'] as $Frequent) {
            if (isset($Arr[$Frequent]['Weight'], $Arr['UCS-2']['Weight']) && $Arr[$Frequent]['Weight'] === $Arr['UCS-2']['Weight'] && $Arr['UCS-2']['Weight'] > 0) {
                $Arr['UCS-2']['Weight']--;
            }
        }

        /** If both UTF-32BE and UTF-32LE seem thus far valid and equally weighted, we'll try to dig a little deeper. */
        if (isset($Arr['UTF-32BE']['Weight'], $Arr['UTF-32LE']['Weight']) && $Arr['UTF-32BE']['Weight'] === $Arr['UTF-32LE']['Weight'] && $this->Len < 65536) {
            $Split = str_split($String, 4);
            $WeightBE = 0;
            $WeightLE = 0;
            foreach ($Split as $Pair) {
                if (preg_match('~^\0\0..$~', $Pair)) {
                    $WeightBE++;
                }
                if (preg_match('~^..\0\0$~', $Pair)) {
                    $WeightLE++;
                }
            }
            if ($WeightBE !== $WeightLE) {
                if ($WeightBE > $WeightLE) {
                    $Arr['UTF-32BE']['Weight'] += 0.5;
                    $Arr['UTF-32LE']['Weight'] -= 0.5;
                } else {
                    $Arr['UTF-32BE']['Weight'] -= 0.5;
                    $Arr['UTF-32LE']['Weight'] += 0.5;
                }
            }
        }

        /** Favour UTF-32 more than UCS-4. */
        foreach (['UTF-32BE', 'UTF-32LE'] as $Frequent) {
            if (isset($Arr[$Frequent]['Weight'], $Arr['UCS-4']['Weight']) && $Arr[$Frequent]['Weight'] === $Arr['UCS-4']['Weight'] && $Arr['UCS-4']['Weight'] > 0) {
                $Arr['UCS-4']['Weight']--;
            }
        }

        /** Slightly favour more complex encodings over simper encodings, when both are valid and otherwise equally weighted. */
        $ComplexArr = ['UTF-8', 'UTF-32BE', 'UTF-32LE', 'UTF-16BE', 'UTF-16LE', 'GB18030', 'SHIFT-JIS', 'JOHAB', 'BIG5'];
        $SimpleDone = [];
        foreach ($ComplexArr as $Complex) {
            foreach ($this->supported() as $Simple) {
                if (
                    !in_array($Simple, $ComplexArr) &&
                    !isset($SimpleDone[$Simple]) &&
                    isset($Arr[$Complex]['Weight'], $Arr[$Simple]['Weight']) &&
                    $Arr[$Complex]['Weight'] === $Arr[$Simple]['Weight'] &&
                    $Arr[$Simple]['Weight'] > 0
                ) {
                    $Arr[$Simple]['Weight']--;
                    $SimpleDone[$Simple] = true;
                }
            }
        }
    }

    /**
     * Drop candidates belonging to encodings that are outdated subsets or variants of other encodings with valid
     * candidates.
     *
     * @param array $Arr An array of potential candidates.
     * @return void
     */
    private function dropVariants(array &$Arr)
    {
        if (isset($Arr['GB18030'], $Arr['GB2312'])) {
            unset($Arr['GB2312']);
        }
        if (isset($Arr['UCS-2']) && (isset($Arr['UTF-16BE']) || isset($Arr['UTF-16LE']))) {
            unset($Arr['UCS-2']);
        }
        if (isset($Arr['UCS-4']) && (isset($Arr['UTF-32BE']) || isset($Arr['UTF-32LE']))) {
            unset($Arr['UCS-4']);
        }
        if (
            isset($Arr['UTF-8']) ||
            isset($Arr['UTF-16BE']) ||
            isset($Arr['UTF-16LE']) ||
            isset($Arr['UCS-2']) ||
            isset($Arr['UTF-32BE']) ||
            isset($Arr['UTF-32LE']) ||
            isset($Arr['UCS-4']) ||
            isset($Arr['GB18030']) ||
            isset($Arr['GB2312']) ||
            isset($Arr['BIG5']) ||
            isset($Arr['SHIFT-JIS']) ||
            isset($Arr['JOHAB']) ||
            isset($Arr['UCS-4'])
        ) {
            foreach ($Arr as $Key => $Value) {
                if (!preg_match('~^(?:UTF|UCS|GB|BIG5|SHIFT-JIS|JOHAB)~', $Key)) {
                    unset($Arr[$Key]);
                }
            }
        }
    }
}
