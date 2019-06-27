<?php
/**
 * Number formatter (last modified: 2019.06.27).
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

class NumberFormatter
{
    /** Identifies the conversion set to use. */
    public $ConversionSet = 'Western';

    /** Identifies the separator to use for separating number groups. */
    public $GroupSeparator = ',';

    /** Identifies the group size to use for separating number groups. */
    public $GroupSize = 3;

    /** Identifies the offset to use when counting the size of number groups. */
    public $GroupOffset = 0;

    /** Identifies the decimal separator to use. */
    public $DecimalSeparator = '.';

    /** Identifies the base system of the target format. */
    public $Base = 10;

    /**
     * Conversion set for Hindu-Arabic or Western Arabic numerals (an empty
     * array, because.. that's the default, meaning.. we don't need to convert
     * anything anyway, but.. keeping it here, so that we can be explicit).
     */
    private $Western = [];

    /** Conversion set for Eastern Arabic numerals. */
    private $Eastern = [
        '0' => '٠',
        '1' => '١',
        '2' => '٢',
        '3' => '٣',
        '4' => '٤',
        '5' => '٥',
        '6' => '٦',
        '7' => '٧',
        '8' => '٨',
        '9' => '٩'
    ];

    /** Conversion set for Persian/Urdu numerals (Eastern Arabic variant). */
    private $Persian = [
        '0' => '۰',
        '1' => '۱',
        '2' => '۲',
        '3' => '۳',
        '4' => '۴',
        '5' => '۵',
        '6' => '۶',
        '7' => '۷',
        '8' => '۸',
        '9' => '۹'
    ];

    /** Conversion set for Nagari/Bengali/Bangla numerals. */
    private $Nagari = [
        '0' => '০',
        '1' => '১',
        '2' => '২',
        '3' => '৩',
        '4' => '৪',
        '5' => '৫',
        '6' => '৬',
        '7' => '৭',
        '8' => '৮',
        '9' => '৯'
    ];

    /** Conversion set for Devanagari numerals (used by Hindi, Marathi, etc). */
    private $Devanagari = [
        '0' => '०',
        '1' => '१',
        '2' => '२',
        '3' => '३',
        '4' => '४',
        '5' => '५',
        '6' => '६',
        '7' => '७',
        '8' => '८',
        '9' => '९'
    ];

    /** Conversion set for Gujarati numerals. */
    private $Gujarati = [
        '0' => '૦',
        '1' => '૧',
        '2' => '૨',
        '3' => '૩',
        '4' => '૪',
        '5' => '૫',
        '6' => '૬',
        '7' => '૭',
        '8' => '૮',
        '9' => '૯'
    ];

    /** Conversion set for Gurmukhi/Punjabi numerals. */
    private $Gurmukhi = [
        '0' => '੦',
        '1' => '੧',
        '2' => '੨',
        '3' => '੩',
        '4' => '੪',
        '5' => '੫',
        '6' => '੬',
        '7' => '੭',
        '8' => '੮',
        '9' => '੯'
    ];

    /** Conversion set for Kannada numerals. */
    private $Kannada = [
        '0' => '೦',
        '1' => '೧',
        '2' => '೨',
        '3' => '೩',
        '4' => '೪',
        '5' => '೫',
        '6' => '೬',
        '7' => '೭',
        '8' => '೮',
        '9' => '೯'
    ];

    /** Conversion set for Telugu numerals. */
    private $Telugu = [
        '0' => '౦',
        '1' => '౧',
        '2' => '౨',
        '3' => '౩',
        '4' => '౪',
        '5' => '౫',
        '6' => '౬',
        '7' => '౭',
        '8' => '౮',
        '9' => '౯'
    ];

    /** Conversion set for Burmese numerals. */
    private $Burmese = [
        '0' => '၀',
        '1' => '၁',
        '2' => '၂',
        '3' => '၃',
        '4' => '၄',
        '5' => '၅',
        '6' => '၆',
        '7' => '၇',
        '8' => '၈',
        '9' => '၉'
    ];

    /** Conversion set for Khmer numerals. */
    private $Khmer = [
        '0' => '០',
        '1' => '១',
        '2' => '២',
        '3' => '៣',
        '4' => '៤',
        '5' => '៥',
        '6' => '៦',
        '7' => '៧',
        '8' => '៨',
        '9' => '៩'
    ];

    /** Conversion set for Thai numerals. */
    private $Thai = [
        '0' => '๐',
        '1' => '๑',
        '2' => '๒',
        '3' => '๓',
        '4' => '๔',
        '5' => '๕',
        '6' => '๖',
        '7' => '๗',
        '8' => '๘',
        '9' => '๙'
    ];

    /** Conversion set for Lao numerals. */
    private $Lao = [
        '0' => '໐',
        '1' => '໑',
        '2' => '໒',
        '3' => '໓',
        '4' => '໔',
        '5' => '໕',
        '6' => '໖',
        '7' => '໗',
        '8' => '໘',
        '9' => '໙'
    ];

    /**
     * Conversion set for Mayan numerals (unlikely to ever be practical, but a
     * nice kind of "easter egg", per se, to demonstrate what the class can do.
     */
    private $Mayan = [
        '0' => '𝋠',
        '1' => '𝋡',
        '2' => '𝋢',
        '3' => '𝋣',
        '4' => '𝋤',
        '5' => '𝋥',
        '6' => '𝋦',
        '7' => '𝋧',
        '8' => '𝋨',
        '9' => '𝋩',
        'a' => '𝋪',
        'b' => '𝋫',
        'c' => '𝋬',
        'd' => '𝋭',
        'e' => '𝋮',
        'f' => '𝋯',
        'g' => '𝋰',
        'h' => '𝋱',
        'i' => '𝋲',
        'j' => '𝋳',
    ];

    /**
     * @param string $Format Can use this to quickly set commonly used
     *      definitions during object instantiation.
     */
    public function __construct($Format = '')
    {
        if ($Format === '' || $Format === 'Latin-1') {
            return;
        }
        if ($Format === 'NoSep-1') {
            $this->GroupSeparator = '';
            return;
        }
        if ($Format === 'NoSep-2') {
            $this->GroupSeparator = '';
            $this->DecimalSeparator = ',';
            return;
        }
        if ($Format === 'Latin-2') {
            $this->GroupSeparator = ' ';
            return;
        }
        if ($Format === 'Latin-3') {
            $this->GroupSeparator = '.';
            $this->DecimalSeparator = ',';
            return;
        }
        if ($Format === 'Latin-4') {
            $this->GroupSeparator = ' ';
            $this->DecimalSeparator = ',';
            return;
        }
        if ($Format === 'Latin-5') {
            $this->DecimalSeparator = '·';
            return;
        }
        if ($Format === 'China-1') {
            $this->GroupSize = 4;
            return;
        }
        if ($Format === 'India-1') {
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'India-2' || $Format === 'Devanagari') {
            $this->ConversionSet = 'Devanagari';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'India-3' || $Format === 'Gujarati') {
            $this->ConversionSet = 'Gujarati';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'India-4' || $Format === 'Gurmukhi') {
            $this->ConversionSet = 'Gurmukhi';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'India-5' || $Format === 'Kannada') {
            $this->ConversionSet = 'Kannada';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'India-6' || $Format === 'Telugu') {
            $this->ConversionSet = 'Telugu';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'Arabic-1') {
            $this->ConversionSet = 'Eastern';
            $this->GroupSeparator = '';
            $this->DecimalSeparator = '٫';
            return;
        }
        if ($Format === 'Arabic-2') {
            $this->ConversionSet = 'Eastern';
            $this->GroupSeparator = '٬';
            $this->DecimalSeparator = '٫';
            return;
        }
        if ($Format === 'Arabic-3' || $Format === 'Persian') {
            $this->ConversionSet = 'Persian';
            $this->GroupSeparator = '٬';
            $this->DecimalSeparator = '٫';
            return;
        }
        if ($Format === 'Arabic-4' || $Format === 'Urdu') {
            $this->ConversionSet = 'Persian';
            $this->GroupSeparator = '٬';
            $this->DecimalSeparator = '٫';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'Bengali-1' || $Format === 'Nagari') {
            $this->ConversionSet = 'Nagari';
            $this->GroupSize = 2;
            $this->GroupOffset = -1;
            return;
        }
        if ($Format === 'Burmese-1') {
            $this->ConversionSet = 'Burmese';
            $this->GroupSeparator = '';
            return;
        }
        if ($Format === 'Khmer-1') {
            $this->ConversionSet = 'Khmer';
            $this->GroupSeparator = '.';
            $this->DecimalSeparator = ',';
            return;
        }
        if ($Format === 'Lao-1') {
            $this->ConversionSet = 'Lao';
            $this->GroupSeparator = '';
            return;
        }
        if ($Format === 'Thai-1') {
            $this->ConversionSet = 'Thai';
            return;
        }
        if ($Format === 'Thai-2') {
            $this->ConversionSet = 'Thai';
            $this->GroupSeparator = '';
            return;
        }
        if ($Format === 'Base-12') {
            $this->GroupSeparator = '';
            $this->Base = 12;
            return;
        }
        if ($Format === 'Base-16') {
            $this->GroupSeparator = '';
            $this->Base = 16;
            return;
        }
        if ($Format === 'Mayan') {
            $this->ConversionSet = 'Mayan';
            $this->GroupSeparator = '';
            $this->Base = 20;
            return;
        }
    }

    /**
     * Formats the supplied number according to definitions.
     *
     * @param mixed $Number The number to format (int, float, string, etc).
     * @param int $Decimals The number of decimal places (optional).
     * @return string The formatted number.
     */
    public function format($Number, $Decimals = 0)
    {
        $CSet = $this->{$this->ConversionSet};
        $DecPos = strpos($Number, '.') ?: strlen($Number);
        if ($Decimals > 0 && $this->DecimalSeparator) {
            $Fraction = substr($Number, $DecPos + 1) ?: '';
            if ($Fraction && $this->Base !== 10 && $this->Base > 1 && $this->Base <= 36) {
                $Len = strlen($Fraction);
                $Fraction = (float)('0.' . $Fraction);
                $NewFraction = '';
                for ($Pos = 0; $Pos < $Decimals; $Pos++) {
                    $Fraction *= 10;
                    $Part = floor($Fraction > 0 ? ($this->Base / (10 / $Fraction)) : $Fraction);
                    $Fraction -= $Part ? (10 / ($this->Base / $Part)) : 0;
                    $NewFraction .= (string)($Part ? base_convert($Part, 10, $this->Base) : $Part);
                }
                $Fraction = $NewFraction;
            }
            if ($Fraction) {
                $Fraction = substr($Fraction, 0, $Decimals);
            }
            $Len = strlen($Fraction);
            if ($Len < $Decimals) {
                $Fraction .= str_repeat('0', $Decimals - $Len);
            }
        }
        $Number = (string)(int)substr($Number, 0, $DecPos);
        if ($this->Base !== 10 && $this->Base > 1 && $this->Base <= 36) {
            $Number = base_convert($Number, 10, $this->Base);
        }
        $DecPos = strlen($Number);
        for ($Formatted = '', $ThouPos = $this->GroupOffset, $Pos = $DecPos - 1; $Pos > -1; $Pos--) {
            if ($ThouPos >= $this->GroupSize) {
                $ThouPos = 1;
                $Formatted = $this->GroupSeparator . $Formatted;
            } else {
                $ThouPos++;
            }
            $ThisChar = substr($Number, $Pos, 1);
            $Formatted = isset($CSet[$ThisChar]) ? $CSet[$ThisChar] . $Formatted : $ThisChar . $Formatted;
        }
        if ($Decimals && $this->DecimalSeparator) {
            $Formatted .= $this->DecimalSeparator;
            for ($Len = strlen($Fraction), $Pos = 0; $Pos < $Len; $Pos++) {
                $Formatted .= isset($CSet[$Fraction[$Pos]]) ? $CSet[$Fraction[$Pos]] : $Fraction[$Pos];
            }
        }
        return $Formatted;
    }

}
