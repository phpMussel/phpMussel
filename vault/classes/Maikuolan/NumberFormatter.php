<?php
/**
 * Number formatter (last modified: 2020.06.11).
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
    /**
     * @var string Identifies the conversion set to use.
     */
    public $ConversionSet = 'Western';

    /**
     * @var string Identifies the separator to use for separating number groups.
     */
    public $GroupSeparator = ',';

    /**
     * @var int Identifies the group size to use for separating number groups.
     */
    public $GroupSize = 3;

    /**
     * @var int Identifies the offset to use when counting the size of number groups.
     */
    public $GroupOffset = 0;

    /**
     * @var string Identifies the decimal separator to use.
     */
    public $DecimalSeparator = '.';

    /**
     * @var int Identifies the base system of the target format.
     */
    public $Base = 10;

    /**
     * @var array Conversion set for Hindu-Arabic or Western Arabic numerals.
     *      The array here is intentionally empty, because it's our default
     *      "conversion set" to use (keeping it here in order to be explicit).
     */
    private $Western = [];

    /**
     * @var array Conversion set for Eastern Arabic numerals.
     */
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

    /**
     * @var array Conversion set for Persian/Urdu numerals (Eastern Arabic variant).
     */
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

    /**
     * @var array Conversion set for Nagari/Bengali/Bangla numerals.
     */
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

    /**
     * @var array Conversion set for Devanagari numerals (used by Hindi, Marathi, etc).
     */
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

    /**
     * @var array Conversion set for Gujarati numerals.
     */
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

    /**
     * @var array Conversion set for Gurmukhi/Punjabi numerals.
     */
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

    /**
     * @var array Conversion set for Kannada numerals.
     */
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

    /**
     * @var array Conversion set for Telugu numerals.
     */
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

    /**
     * @var array Conversion set for Burmese numerals.
     */
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

    /**
     * @var array Conversion set for Khmer numerals.
     */
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

    /**
     * @var array Conversion set for Thai numerals.
     */
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

    /**
     * @var array Conversion set for Lao numerals.
     */
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
     * @var array Conversion set for Mayan numerals (unlikely to ever be
     *      needed, but serves as an amusing "easter egg" to demonstrate
     *      the capabilities of the class).
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
        'j' => '𝋳'
    ];

    /**
     * @var array Conversion set for Japanese numerals.
     */
    private $Japanese = [
        '0*' => '',
        '1' => '',
        '2' => '二',
        '3' => '三',
        '4' => '四',
        '5' => '五',
        '6' => '六',
        '7' => '七',
        '8' => '八',
        '9' => '九',
        '^0*1' => '一',
        '^1' => '十',
        '^2' => '百',
        '^3' => '千',
        '^4' => '万',
        '^5' => '十万',
        '^6' => '百万',
        '^7' => '千万',
        '^8' => '億',
        '^9' => '十億',
        '^10' => '百億',
        '^11' => '千億',
        '^12' => '兆',
        '^13' => '十兆',
        '^14' => '百兆',
        '^15' => '千兆',
        '^16' => '京',
        '^17' => '十京',
        '^18' => '百京',
        '^19' => '千京',
        '^20' => '垓',
        '^21' => '十垓',
        '^22' => '百垓',
        '^23' => '千垓',
        '^-1' => '分',
        '^-2' => '厘',
        '^-3' => '毛',
        '^-4' => '糸',
        '^-5' => '忽',
        '^-6' => '微',
        '^-7' => '繊',
        '^-8' => '沙',
        '^-9' => '塵',
        '^-10' => '埃'
    ];

    /**
     * @var array Conversion set for Tamil numerals.
     */
    private $Tamil = [
        '0*' => '',
        '1' => '',
        '2' => '௨',
        '3' => '௩',
        '4' => '௪',
        '5' => '௫',
        '6' => '௬',
        '7' => '௭',
        '8' => '௮',
        '9' => '௯',
        '^0*1' => '௧',
        '^1' => '௰',
        '^2' => '௱',
        '^3' => '௲',
        '^4' => '௰௲',
        '^5' => '௱௲',
        '^6' => '௲௲',
        '^7' => '௰௲௲',
        '^8' => '௱௲௲',
        '^9' => '௲௲௲',
        '^10' => '௰௲௲௲',
        '^11' => '௱௲௲௲',
        '^12' => '௲௲௲௲',
        '^13' => '௰௲௲௲௲',
        '^14' => '௱௲௲௲௲',
        '^15' => '௲௲௲௲௲',
        '^16' => '௰௲௲௲௲௲',
        '^17' => '௱௲௲௲௲௲',
        '^18' => '௲௲௲௲௲௲',
        '^19' => '௰௲௲௲௲௲௲',
        '^20' => '௱௲௲௲௲௲௲',
        '^21' => '௲௲௲௲௲௲௲',
        '^22' => '௰௲௲௲௲௲௲௲',
        '^23' => '௱௲௲௲௲௲௲௲'
    ];

    /**
     * @var array Conversion set for Javanese numerals.
     */
    private $Javanese = [
        '0' => '꧐',
        '1' => '꧑',
        '2' => '꧒',
        '3' => '꧓',
        '4' => '꧔',
        '5' => '꧕',
        '6' => '꧖',
        '7' => '꧗',
        '8' => '꧘',
        '9' => '꧙'
    ];

    /**
     * @var array Conversion set for Roman numerals.
     */
    private $Roman = [
        '0' => '',
        '1' => '',
        '2' => '',
        '3' => '',
        '4' => '',
        '5' => '',
        '6' => '',
        '7' => '',
        '8' => '',
        '9' => '',
        '^0*1' => 'I',
        '^0*2' => 'II',
        '^0*3' => 'III',
        '^0*4' => 'IV',
        '^0*5' => 'V',
        '^0*6' => 'VI',
        '^0*7' => 'VII',
        '^0*8' => 'VIII',
        '^0*9' => 'IX',
        '^1*1' => 'X',
        '^1*2' => 'XX',
        '^1*3' => 'XXX',
        '^1*4' => 'XL',
        '^1*5' => 'L',
        '^1*6' => 'LX',
        '^1*7' => 'LXX',
        '^1*8' => 'LXXX',
        '^1*9' => 'XC',
        '^2*1' => 'C',
        '^2*2' => 'CC',
        '^2*3' => 'CCC',
        '^2*4' => 'CD',
        '^2*5' => 'D',
        '^2*6' => 'DC',
        '^2*7' => 'DCC',
        '^2*8' => 'DCCC',
        '^2*9' => 'CM',
        '^3*1' => 'M',
        '^3*2' => 'MM',
        '^3*3' => 'MMM'
    ];

    /**
     * @var array Conversion set for Odia numerals.
     */
    private $Odia = [
        '0' => '୦',
        '1' => '୧',
        '2' => '୨',
        '3' => '୩',
        '4' => '୪',
        '5' => '୫',
        '6' => '୬',
        '7' => '୭',
        '8' => '୮',
        '9' => '୯'
    ];

    /**
     * @var array Conversion set for Tibetan numerals.
     */
    private $Tibetan = [
        '0' => '༠',
        '1' => '༡',
        '2' => '༢',
        '3' => '༣',
        '4' => '༤',
        '5' => '༥',
        '6' => '༦',
        '7' => '༧',
        '8' => '༨',
        '9' => '༩'
    ];

    /**
     * @param string $Format Can use this to quickly set commonly used
     *      definitions during object instantiation.
     */
    public function __construct(string $Format = '')
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
        if ($Format === 'Japanese') {
            $this->ConversionSet = 'Japanese';
            $this->GroupSeparator = '';
            $this->DecimalSeparator = '・';
            return;
        }
        if ($Format === 'Tamil' || $Format === 'Roman') {
            $this->ConversionSet = $Format;
            $this->GroupSeparator = '';
            $this->DecimalSeparator = '';
            return;
        }
        if ($Format === 'Javanese' || $Format === 'Odia' || $Format === 'Tibetan') {
            $this->ConversionSet = $Format;
            $this->GroupSeparator = '';
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
    public function format($Number, int $Decimals = 0): string
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
        for ($Unit = 0, $Formatted = '', $ThouPos = $this->GroupOffset, $Pos = $DecPos - 1; $Pos > -1; $Pos--, $Unit++) {
            if ($ThouPos >= $this->GroupSize) {
                $ThouPos = 1;
                $Formatted = $this->GroupSeparator . $Formatted;
            } else {
                $ThouPos++;
            }
            $Key = substr($Number, $Pos, 1);
            if (isset($CSet[$Key . '*'])) {
                $Formatted = $CSet[$Key . '*'] . $Formatted;
                continue;
            }
            $Add = $CSet[$Key] ?? $Key;
            if (isset($CSet['^' . $Unit . '*' . $Key])) {
                $Add .= $CSet['^' . $Unit . '*' . $Key];
            } elseif (isset($CSet['^' . $Unit])) {
                $Add .= $CSet['^' . $Unit];
            }
            $Formatted = $Add . $Formatted;
        }
        if ($Decimals && $this->DecimalSeparator) {
            $Formatted .= $this->DecimalSeparator;
            for ($Len = strlen($Fraction), $Pos = 0; $Pos < $Len; $Pos++) {
                $Key = substr($Fraction, $Pos, 1);
                if (isset($CSet[$Key . '*'])) {
                    $Formatted .= $CSet[$Key . '*'];
                    continue;
                }
                $Add = $CSet[$Key] ?? $Key;
                $NegUnit = ($Pos * -1) - 1;
                if (isset($CSet['^' . $NegUnit . '*' . $Key])) {
                    $Add .= $CSet['^' . $NegUnit . '*' . $Key];
                } elseif (isset($CSet['^' . $NegUnit])) {
                    $Add .= $CSet['^' . $NegUnit];
                }
                $Formatted .= $Add;
            }
        }
        return $Formatted;
    }

    /**
     * Gets the specified conversion set and returns it as a CSV string.
     *
     * @param string $Set The specified conversion set.
     * @return string A CSV string.
     */
    public function getSetCSV(string $Set = ''): string
    {
        if (!$Set || !isset($this->$Set)) {
            $Set = $this->ConversionSet;
        }
        $CSet = $this->$Set;
        return "'" . implode("','", $CSet) . "'";
    }
}
