<?php
/**
 * Demojibakefier (last modified: 2021.05.22).
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
 * Source: https://github.com/Maikuolan/Common
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
    const CTRL0 = '\x00-\x08\x0b\x0c\x0e-\x1f';

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.6.1';

    /**
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
         */
        if ($Encoding === 'UTF-8') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\xc0\xc1\xf5-\xff]|[\xc2-\xdf](?![\x80-\xbf])|\xe0(?![\xa0-\xbf][\x80-\xbf])|[\xe1-\xec](?![\x80-\xbf]{2})|\xed(?![\x80-\x9f][\x80-\xbf])|\xf0(?![\x90-\xbf][\x80-\xbf]{2})[\xf0-\xf3](?![\x80-\xbf]{3})\xf4(?![\x80-\x9f][\x80-\xbf]{2})~', $String);
        }
        /**
         * @link https://en.wikipedia.org/wiki/UTF-16
         * @link https://unicode.org/faq/utf_bom.html
         */
        if ($Encoding === 'UTF-16BE') {
            return !(strlen($String) % 2) && !preg_match('~[\xd8-\xdb][\x00-\xff](?![\xdc-\xdf][\x00-\xff])|(?<![\xd8-\xdb][\x00-\xff])[\xdc-\xdf][\x00-\xff]~', $String);
        }
        /**
         * @link https://en.wikipedia.org/wiki/UTF-16
         * @link https://unicode.org/faq/utf_bom.html
         */
        if ($Encoding === 'UTF-16LE') {
            return !(strlen($String) % 2) && !preg_match('~[\x00-\xff][\xdc-\xdf](?![\x00-\xff][\xd8-\xdb])|(?<![\x00-\xff][\xdc-\xdf])[\x00-\xff][\xd8-\xdb]~', $String);
        }
        if (preg_match('~^ISO-8859-(?:[12459]|1[03456])$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\x9f\xad]~', $String);
        }
        if ($Encoding === 'ISO-8859-3') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\x9f\xa5\xad\xae\xbe\xc3\xd0\xe3\xf0]~', $String);
        }
        if ($Encoding === 'ISO-8859-6') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\xa3\xa5-\xab\xad-\xba\xbc-\xbe\xc0\xdb-\xdf\xf3-\xff]~', $String);
        }
        if ($Encoding === 'ISO-8859-7') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\x9f\xa4\xa5\xaa\xad\xae\xd2\xff]~', $String);
        }
        if ($Encoding === 'ISO-8859-8') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\x9f\xa1\xad\xbf-\xde\xfb-\xff]~', $String);
        }
        if ($Encoding === 'ISO-8859-11') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\xa0\xdb-\xde\xfc-\xff]~', $String);
        }
        if ($Encoding === 'CP1250') { // Windows-1250
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x83\x88\x98\xad]~', $String);
        }
        if ($Encoding === 'CP1251') { // Windows-1251
            return !preg_match('~[' . self::CTRL0 . '\x7f\x98\xad]~', $String);
        }
        if ($Encoding === 'CP1252') { // Windows-1252
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x8d\x8f\x90\x9d\xad]~', $String);
        }
        if ($Encoding === 'CP1253') { // Windows-1253
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x88\x8a\x8c-\x8f\x90\x98\x9a\x9c-\x9f\xaa\xad\xd2\xff]~', $String);
        }
        if ($Encoding === 'CP1254') { // Windows-1254
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x8d-\x8f\x90\x9d\x9e\xad]~', $String);
        }
        if ($Encoding === 'CP1255') { // Windows-1255
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x8a\x8c-\x8f\x90\x9a\x9c-\x9f\xad\xca\xd9-\xdf\xfb\xfc\xff]~', $String);
        }
        if ($Encoding === 'CP1256') { // Windows-1256
            return !preg_match('~[' . self::CTRL0 . '\x7f\xad]~', $String);
        }
        if ($Encoding === 'CP1257') { // Windows-1257
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x83\x88\x8a\x8c\x90\x98\x9a\x9c\x9f\xa1\xa5\xad]~', $String);
        }
        if ($Encoding === 'CP1258') { // Windows-1258
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81\x8a\x8d-\x8f\x90\x9a\x9d\x9e\xad]~', $String);
        }
        if (preg_match('~^GB(?:18030|2312)$~', $Encoding)) { // GB18030 supersedes GB2312
            return !preg_match('~[' . self::CTRL0 . '\xff]$~', $String);
        }
        if ($Encoding === 'BIG5') {
            return !preg_match('~[' . self::CTRL0 . '\xff]|(?<![\xa1-\xf9])[\x80-\xa0]~', $String);
        }
        if ($Encoding === 'SHIFT-JIS') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\xfd-\xff]|[\x81-\xe9](?![\x40-\xfc])|\xea(?![\x40-\xa4])|(?<![\x81-\xea])\x80|[\xea-\xfc]{2}~', $String);
        }
        if ($Encoding === 'JOHAB') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\xff]|(?<![\x84-\xd3\xd8-\xde\xe0-\xf9])[\xd4-\xd7\xdf\xfa-\xfe]~', $String);
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
            return !preg_match('~[' . self::CTRL0 . '\x7f\xff]~', $String);
        }
        if (preg_match('~^CP(?:775|85[0258])$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7f\xf0\xff]~', $String);
        }
        if ($Encoding === 'CP857') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\xd5\xe7\xf0\xf2\xff]~', $String);
        }
        if ($Encoding === 'CP864') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\x9b\x9c\x9f\xa1\xa6\xa7\xff]~', $String);
        }
        if ($Encoding === 'CP869') {
            return !preg_match('~[' . self::CTRL0 . '\x7f-\x85\x87\x93\x94\xf0\xff]~', $String);
        }
        if ($Encoding === 'CP874') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\x81-\x84\x86-\x90\x98-\x9f\xdb-\xde\xfc-\xff]~', $String);
        }
        if (preg_match('~^KOI8-(?:[RUF]|RU)$~', $Encoding)) {
            return !preg_match('~[' . self::CTRL0 . '\x7f]~', $String);
        }
        if ($Encoding === 'KOI8-T') {
            return !preg_match('~[' . self::CTRL0 . '\x7f\x88\x8f\x98\x9a\x9c-\x9f\xa8-\xaa\xaf\xb4\xb8\xba\xbc-\xbe]~', $String);
        }
        if (preg_match('~^CP(?:037|500)$~', $Encoding)) {
            return !preg_match('~[\x00-\x3f\xca\xff]~', $String);
        }
        if ($Encoding === 'CP875') {
            return !preg_match('~[\x00-\x3f\x74\xca\xff]~', $String);
        }
        if ($Encoding === 'CP1026') {
            return !preg_match('~[\x00-\x3f\xff]~', $String);
        }
        /** Encoding not recognised; Assuming non-conformant and returning false accordingly. */
        return false;
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
        if (isset($Arr['UTF-8']['Weight']) && preg_match('~\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xec][\x80-\xbf]{2}|\xed[\x80-\x9f][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf]{2}|[\xf0-\xf3][\x80-\xbf]{3}|\xf4[\x80-\x9f][\x80-\xbf]~', $String)) {
            $Arr['UTF-8']['Weight'] += 5;
        }
        /** For when it (..kinda sorta maybe) looks like SHIFT-JIS. */
        if (isset($Arr['SHIFT-JIS']['Weight']) && preg_match('~[\x81-\xe9][\x40-\xfc]|\xea[\x40-\xa4]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\x81-\xe9][\x40-\xfc]|\xea[\x40-\xa4]~', '', $String);
            $Arr['SHIFT-JIS']['Weight'] += strlen($TestElse) ? 2 : 1;
        }
        /** For when it (..kinda sorta maybe) looks like JOHAB. */
        if (isset($Arr['JOHAB']['Weight']) && preg_match('~[\x84-\xd3][\x41-\x7e\x81-\xfe]|[\xd8-\xde\xe0-\xf9][\x31-\x7e\x91-\xfe]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\x84-\xd3][\x41-\x7e\x81-\xfe]|[\xd8-\xde\xe0-\xf9][\x31-\x7e\x91-\xfe]~', '', $String);
            $Arr['JOHAB']['Weight'] += strlen($TestElse) ? 2 : 1;
        }
        /** For when it (..kinda sorta maybe) looks like BIG5. */
        if (isset($Arr['BIG5']['Weight']) && preg_match('~[\xa1-\xf9][\x80-\xa0]~', $String)) {
            $TestElse = preg_replace('~[\x00-\x20]|[\xa1-\xf9][\x80-\xa0]~', '', $String);
            $Arr['BIG5']['Weight'] += strlen($TestElse) ? 2 : 1;
        }
        /** For when it (..kinda sorta maybe) looks like UTF-16BE. */
        if (isset($Arr['UTF-16BE']['Weight']) && preg_match('~\x00[\x20-\x7e]|[\xd8-\xdb][\x00-\xff][\xdc-\xdf][\x00-\xff]|[\xd8-\xdb][\x00-\xff][\xdc-\xdf][\x00-\xff]~', $String)) {
            $Arr['UTF-16BE']['Weight']++;
        }
        /** For when it (..kinda sorta maybe) looks like UTF-16LE. */
        if (isset($Arr['UTF-16LE']['Weight']) && preg_match('~[\x20-\x7e]\x00|[\x00-\xff][\xdc-\xdf][\x00-\xff][\xd8-\xdb]|[\x00-\xff][\xdc-\xdf][\x00-\xff][\xd8-\xdb]~', $String)) {
            $Arr['UTF-16LE']['Weight']++;
        }
        /** Commonly found in UCS-2. */
        if (isset($Arr['UCS-2']['Weight']) && strpos($String, "\x1b") !== false) {
            $Arr['UCS-2']['Weight']++;
        }
        /** Commonly found in UCS-4/UTF-32. */
        if (preg_match('~\x00{2}|\x1b~', $String)) {
            foreach (['UCS-4', 'UTF-32BE', 'UTF-32LE'] as $Frequent) {
                if (isset($Arr[$Frequent]['Weight'])) {
                    $Arr[$Frequent]['Weight']++;
                }
            }
        }
        /** Probably English, or at least, some western European language, compatible with ASCII. Let's try ISO-8859-1. */
        if (isset($Arr['ISO-8859-1']['Weight']) && preg_match('~[\x20-\x7e]~', $String) && !preg_match('~[^\x20-\x7e\xe0-\xf6\xf8-\xfd]~', $String)) {
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
            $With = (preg_match_all('~[\x81-\xfe][\x30-\x39]~', $String) / 2) + preg_match_all('~[\x81-\xfe][\x40-\x7e\x80-\xfe]~', $String);
            $Without = preg_match_all('~(?<![\x30-\x39])[\x81-\xfe](?![\x30-\x39])~', $String) + preg_match_all('~[\x81-\xfe](?![\x40-\x7e\x80-\xfe])~', $String);
            if ($With !== $Without) {
                $Arr['GB18030']['Weight'] += ($With > $Without) ? 0.5 : -0.5;
            }
        }
        /** GB18030 supersedes GB2312 and should be weighted accordingly. */
        if (isset($Arr['GB18030']['Weight'], $Arr['GB2312']['Weight']) && $Arr['GB18030']['Weight'] === $Arr['GB2312']['Weight'] && $Arr['GB18030']['Weight'] > 0) {
            $Arr['GB2312']['Weight']--;
        }
        $RateAZ = preg_match_all('~[\x41-\x5a\x61-\x7a]~', $String) / $this->Len;
        $EntrAZ = round(abs($RateAZ * log($RateAZ, 2)), 2);
        /** More common versus less common byte sequences in 1-byte encodings. */
        foreach ([
            'ISO-8859-5' => '[\xa1-\xac\xae-\xff]',
            'ISO-8859-6' => '[\xa4\xac\xbb\xbf\xc1-\xda\xe0-\xf2]',
            'ISO-8859-7' => '[\xb4-\xd1\xd3-\xfe]',
            'ISO-8859-8' => '[\xe0-\xfa]',
            'ISO-8859-11' => '[\xa1-\xda\xdf-\xfb]',
            'CP1251' => '[\x80-\x84\x8a-\x94\x9a-\x9f\xa1-\xac\xaf\xb2-\xb4\xb8-\xff]',
            'CP1253' => '[\xa1\xa2\xab\xb8-\xbc\xbe-\xd1\xd3-\xfe]',
            'CP1255' => '[\xa4\xc0-\xc9\xcb-\xd8\xe0-\xfa\xfd\xfe]',
            'CP1256' => '[\x81\x8a\x8d-\x94\x98\x9a\x9d-\x9f\xa1\xaa\xba\xbf-\xff]',
            'CP737' => '[\x80-\xaf\xe0-\xf0]',
            'CP855' => '[\x80-\xaf\xb5-\xb8\xbc\xbe\xc6\xc7\xd0-\xd8\xde\xe0-\xef\xf1-\xfc]',
            'CP862' => '[\x80-\x9a]',
            'CP864' => '[\x99\x9a\x9d\x9e\xa2\xa4\xa5\xa8-\xfd]',
            'CP866' => '[\x80-\xaf\xe0-\xfa]',
            'CP869' => '[\x86\x8b-\x92\x95\x96\x98\x9b-\xaa\xac-\xad\xb5-\xb8\xbd\xbe\xc6\xc7\xcf-\xd8\xdd\xde\xe0-\xef\xf2-\xfd]',
            'CP874' => '[\xa1-\xda\xdf-\xfb]',
            'KOI8-RU' => '[\xa3\xa4\xa6\xa7\xad\xae\xb3\xb4\xb6\xb7\xbd\xbe\xc0-\xff]',
            'KOI8-R' => '[\xa3\xb3\xc0-\xff]',
            'KOI8-U' => '[\xa3\xa4\xa6\xa7\xb3\xb4\xb6\xb7\xc0-\xff]',
            'KOI8-F' => '[\xa1-\xaf\xb1-\xff]',
            'KOI8-T' => '[\x80\x81\x83\x8a\x8c-\x8e\x90\xa1-\xa3\xa5\xb3\xb5\xc0-\xff]'
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
                if (preg_match('~^(?:[\x00-\x0f].|[\xd8-\xdb][\xdc-\xdf])$~', $Pair)) {
                    $WeightBE++;
                }
                if (preg_match('~^(?:.[\x00-\x0f]|[\xdc-\xdf][\xd8-\xdb])$~', $Pair)) {
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
                $BEPUC = preg_match('~^\xdb[\x80-\xff]$~', $Pair);
                $LEPUC = preg_match('~^[\x80-\xff]\xdb$~', $Pair);
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
                if (preg_match('~^\x00\x00..$~', $Pair)) {
                    $WeightBE++;
                }
                if (preg_match('~^..\x00\x00$~', $Pair)) {
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
            "\xef\xbf\xbd",
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
            "\x0a",
            "\x0b",
            "\x0c",
            "\x15",
            ': ',
            "\xef\xbc\x9a",
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
}
