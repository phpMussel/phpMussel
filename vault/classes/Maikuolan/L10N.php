<?php
/**
 * L10N handler (last modified: 2022.10.05).
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

class L10N
{
    /**
     * @var array All relevant L10N data.
     */
    public $Data = [];

    /**
     * @var array|\Maikuolan\Common\L10N All relevant fallback L10N data.
     */
    public $Fallback = [];

    /**
     * @var string The pluralisation rule to use for integers.
     */
    private $IntegerRule = 'int1';

    /**
     * @var string The pluralisation rule to use for fractions.
     */
    private $FractionRule = 'int1';

    /**
     * @var string The pluralisation rule to use for integers for the fallback.
     */
    private $FallbackIntegerRule = 'int1';

    /**
     * @var string The pluralisation rule to use for fractions for the fallback.
     */
    private $FallbackFractionRule = 'int1';

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.9.2';

    /**
     * Constructor.
     *
     * @param array $Data The L10N data.
     * @param array|\Maikuolan\Common\L10N $Fallback The fallback L10N data (optional).
     * @return void
     */
    public function __construct(array $Data = [], $Fallback = [])
    {
        $this->Data = $Data;
        if (is_array($Fallback) || $Fallback instanceof \Maikuolan\Common\L10N) {
            $this->Fallback = $Fallback;
        }
        if (!empty($Data['IntegerRule'])) {
            if (method_exists($this, $Data['IntegerRule'])) {
                $this->IntegerRule = $Data['IntegerRule'];
            } else {
                $this->IntegerRule = $this->getIntegerRule($Data['IntegerRule']);
            }
        }
        if (!empty($Data['FractionRule'])) {
            if (method_exists($this, $Data['FractionRule'])) {
                $this->FractionRule = $Data['FractionRule'];
            } else {
                $this->FractionRule = $this->getFractionRule($Data['FractionRule']);
            }
        }
        if (is_array($Fallback)) {
            if (!empty($Fallback['IntegerRule'])) {
                if (method_exists($this, $Fallback['IntegerRule'])) {
                    $this->FallbackIntegerRule = $Fallback['IntegerRule'];
                } else {
                    $this->FallbackIntegerRule = $this->getIntegerRule($Fallback['IntegerRule']);
                }
            }
            if (!empty($Fallback['FractionRule'])) {
                if (method_exists($this, $Fallback['FractionRule'])) {
                    $this->FallbackFractionRule = $Fallback['FractionRule'];
                } else {
                    $this->FallbackFractionRule = $this->getFractionRule($Fallback['FractionRule']);
                }
            }
        }
    }

    /**
     * Fetch an L10N string from a range of possible plural forms.
     *
     * @param int|float $Number The quantity of the subject.
     * @param string $String Which L10N strings we're fetching from.
     * @return string The appropriate plural form as determined.
     */
    public function getPlural($Number, $String)
    {
        if (isset($this->Data[$String])) {
            $Choices = $this->Data[$String];
            $IntegerRule = $this->IntegerRule;
            $FractionRule = $this->FractionRule;
        } elseif ($this->Fallback instanceof \Maikuolan\Common\L10N) {
            return $this->Fallback->getPlural($Number, $String);
        } elseif (is_array($this->Fallback) && isset($this->Fallback[$String])) {
            $Choices = $this->Fallback[$String];
            $IntegerRule = $this->FallbackIntegerRule;
            $FractionRule = $this->FallbackFractionRule;
        } else {
            return '';
        }
        if (!is_array($Choices)) {
            return $Choices;
        }
        if (is_float($Number)) {
            $Choice = $this->{$FractionRule}($Number);
        } elseif (is_int($Number)) {
            $Choice = $this->{$IntegerRule}($Number);
        } else {
            $Choice = 0;
        }
        if (isset($Choices[$Choice])) {
            return $Choices[$Choice];
        }
        return isset($Choices[0]) ? $Choices[0] : '';
    }

    /**
     * Safely fetch an L10N string.
     *
     * @param string $String The L10N string to fetch.
     * @return string The fetched L10N string.
     */
    public function getString($String)
    {
        if (isset($this->Data[$String])) {
            return $this->Data[$String];
        }
        if ($this->Fallback instanceof \Maikuolan\Common\L10N) {
            return $this->Fallback->getString($String);
        }
        return isset($this->Fallback[$String]) ? $this->Fallback[$String] : '';
    }

    /**
     * For when there aren't multiple forms.
     *
     * @return int Always 0, since always the same.
     */
    private function int1()
    {
        return 0;
    }

    /**
     * Two grammatical numbers, type one. For e.g., Cebuano, Filipino, Tagalog.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function int2Type1($Int)
    {
        $Tail = $Int % 10;
        return ($Tail === 4 || $Tail === 6 || $Tail === 9) ? 1 : 0;
    }

    /**
     * Two grammatical numbers, type two. For e.g., Icelandic, Macedonian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function int2Type2($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        return ($Tail === 1 && $Tail2 !== 11) ? 0 : 1;
    }

    /**
     * Two grammatical numbers, type three. For e.g., Armenian, Bangla,
     * French, Gujarati, Hindi, Zulu.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function int2Type3($Int)
    {
        return ($Int === 0 || $Int === 1) ? 0 : 1;
    }

    /**
     * Two grammatical numbers, type four. For e.g., Bulgarian, Danish,
     * Dutch, English, Estonian, German, Greek, Italian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function int2Type4($Int)
    {
        return ($Int === 1) ? 0 : 1;
    }

    /**
     * Three grammatical numbers, type one. For e.g., Latvian, Prussian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form. 2: Zero form.
     */
    private function int3Type1($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 0 || ($Tail2 >= 10 && $Tail2 <= 20)) {
            return 2;
        }
        return ($Tail === 1) ? 0 : 1;
    }

    /**
     * Three grammatical numbers, type two. For e.g., Colognian, Langi.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Other form. 2: Zero form.
     */
    private function int3Type2($Int)
    {
        if ($Int === 0) {
            return 2;
        }
        return ($Int === 1) ? 0 : 1;
    }

    /**
     * Three grammatical numbers, type three. For e.g., Inuktitut.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Other form.
     */
    private function int3Type3($Int)
    {
        if ($Int === 2) {
            return 1;
        }
        return ($Int === 1) ? 0 : 2;
    }

    /**
     * Three grammatical numbers, type four. For e.g., Russian, Ukrainian,
     * Bosnian, Croatian, Serbian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Many form.
     */
    private function int3Type4($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 1 && $Tail2 !== 11) {
            return 0;
        }
        return ($Tail >= 2 && $Tail <= 4 && ($Tail2 < 10 || $Tail2 >= 20)) ? 1 : 2;
    }

    /**
     * Three grammatical numbers, type five. For e.g., Polish.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Many form.
     */
    private function int3Type5($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        return ($Tail >= 2 && $Tail <= 4 && ($Tail2 < 10 || $Tail2 >= 20)) ? 1 : 2;
    }

    /**
     * Three grammatical numbers, type six. For e.g., Lithuanian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Other form.
     */
    private function int3Type6($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 0 || ($Tail2 >= 10 && $Tail2 <= 20)) {
            return 2;
        }
        return ($Tail === 1) ? 0 : 1;
    }

    /**
     * Three grammatical numbers, type seven. For e.g., Tachelhit.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Other form.
     */
    private function int3Type7($Int)
    {
        if ($Int > 10) {
            return 2;
        }
        return ($Int > 1) ? 1 : 0;
    }

    /**
     * Three grammatical numbers, type eight. For e.g., Moldavian, Romanian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Other form.
     */
    private function int3Type8($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        $Tail = $Int % 100;
        if ($Int < 20 || ($Tail > 1 && $Tail < 20)) {
            return 1;
        }
        return 2;
    }

    /**
     * Three grammatical numbers, type nine. For e.g., Czech, Slovak.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Other form.
     */
    private function int3Type9($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        return ($Int >= 2 && $Int <= 4) ? 1 : 2;
    }

    /**
     * Three grammatical numbers, type nine. For e.g., Quenya, Tokelauan.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Other form.
     */
    private function int3Type10($Int)
    {
        if ($Int === 2) {
            return 1;
        }
        return $Int > 2 ? 2 : 0;
    }

    /**
     * Four grammatical numbers, type one. For e.g., Manx.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Other form.
     */
    private function int4Type1($Int)
    {
        $Tail = $Int % 10;
        if ($Tail === 1) {
            return 0;
        }
        if ($Tail === 2) {
            return 1;
        }
        return (($Int % 20) === 0) ? 2 : 3;
    }

    /**
     * Four grammatical numbers, type two. For e.g., Gaelic.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Other form.
     */
    private function int4Type2($Int)
    {
        if ($Int === 0 || $Int > 19) {
            return 3;
        }
        $Tail = $Int % 10;
        if ($Tail === 1) {
            return 0;
        }
        if ($Tail === 2) {
            return 1;
        }
        return 2;
    }

    /**
     * Four grammatical numbers, type three. For e.g., Breton.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Other form.
     */
    private function int4Type3($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail2 < 10 || ($Tail2 > 20 && $Tail2 < 70) || ($Tail2 > 80 && $Tail2 < 90)) {
            if ($Tail === 1) {
                return 0;
            }
            if ($Tail === 2) {
                return 1;
            }
            if ($Tail === 3 || $Tail === 4 || $Tail === 9) {
                return 2;
            }
        }
        return 3;
    }

    /**
     * Four grammatical numbers, type four. For e.g., Sorbian, Slovenian.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Other form.
     */
    private function int4Type4($Int)
    {
        $Tail2 = $Int % 100;
        if ($Tail2 === 1) {
            return 0;
        }
        if ($Tail2 === 2) {
            return 1;
        }
        if ($Tail2 === 3 || $Tail2 === 4) {
            return 2;
        }
        return 3;
    }

    /**
     * Four grammatical numbers, type five. For e.g., Hebrew.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Many form. 3: Other form.
     */
    private function int4Type5($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        if ($Int === 2) {
            return 1;
        }
        if ($Int > 19 && ($Int % 10) === 0) {
            return 2;
        }
        return 3;
    }

    /**
     * Four grammatical numbers, type six. For e.g., Maltese.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Few form. 2: Many form. 3: Other form.
     */
    private function int4Type6($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        $Tail2 = $Int % 100;
        if ($Tail2 > 10 && $Tail2 < 20) {
            return 2;
        }
        if ($Int === 0 || ($Tail2 > 1 && $Tail2 < 11)) {
            return 1;
        }
        return 3;
    }

    /**
     * Four grammatical numbers, type seven. For e.g., Na'vi.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Trial form. 3: Other form.
     */
    private function int4Type7($Int)
    {
        if ($Int === 2) {
            return 1;
        }
        if ($Int === 3) {
            return 2;
        }
        return $Int > 3 ? 3 : 0;
    }

    /**
     * Five grammatical numbers, type one. For e.g., Irish.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Many form. 4: Other form.
     */
    private function int5Type1($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        if ($Int === 2) {
            return 1;
        }
        if ($Int >= 3 && $Int <= 6) {
            return 2;
        }
        if ($Int >= 7 && $Int <= 10) {
            return 3;
        }
        return 4;
    }

    /**
     * Six grammatical numbers, type one. For e.g., Arabic.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Few form. 3: Many form. 4: Other form. 5: Zero form.
     */
    private function int6Type1($Int)
    {
        if ($Int === 0) {
            return 5;
        }
        if ($Int === 1) {
            return 0;
        }
        if ($Int === 2) {
            return 1;
        }
        $Tail2 = $Int % 100;
        if ($Tail2 > 10) {
            return 3;
        }
        if ($Tail2 < 3) {
            return 4;
        }
        return 2;
    }

    /**
     * Six grammatical numbers, type two. For e.g., Welsh.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Trial form. 3: Many form. 4: Other form. 5: Zero form.
     */
    private function int6Type2($Int)
    {
        if ($Int === 0) {
            return 5;
        }
        if ($Int === 1) {
            return 0;
        }
        if ($Int === 2) {
            return 1;
        }
        if ($Int === 3) {
            return 2;
        }
        if ($Int === 6) {
            return 3;
        }
        return 4;
    }

    /**
     * Six grammatical numbers, type three. For e.g., Cornish.
     *
     * @param int $Int The plurality/number of things.
     * @return int 0: Singular form. 1: Dual form. 2: Trial form. 3: Other form. 4: Many form. 5: Zero form.
     */
    private function int6Type3($Int)
    {
        if ($Int === 0) {
            return 5;
        }
        if ($Int === 1) {
            return 0;
        }
        $Tail = $Int % 10;
        if ($Tail === 1) {
            return 4;
        }
        if ($Tail === 2) {
            return 1;
        }
        if ($Tail === 3) {
            return 2;
        }
        return 3;
    }

    /**
     * Two fraction forms, type one. For e.g., Armenian, Danish, French, Portuguese.
     *
     * @param float $Fraction The fraction of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function fraction2Type1($Fraction)
    {
        return ($Fraction >= 2) ? 1 : 0;
    }

    /**
     * Two fraction forms, type two. For e.g., Amharic, Bangla, Hindi.
     *
     * @param float $Fraction The fraction of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function fraction2Type2($Fraction)
    {
        return ($Fraction >= 1) ? 1 : 0;
    }

    /**
     * Attempts to automatically determine an appropriate integer rule to use
     * based upon the specified ISO 639-1/639-2 language code (the former
     * preferred, the latter used if the former isn't available).
     * @link https://www.loc.gov/standards/iso639-2/php/code_list.php
     * @link https://cldr.unicode.org/index/cldr-spec/plural-rules
     * @link https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
     *
     * @param string $Code An ISO 639-1/639-2 language code.
     * @return string An appropriate integer rule to use.
     */
    public function getIntegerRule($Code)
    {
        /** For different rules based on region, country, or dialect. */
        if (($Pos = strpos($Code, '-')) !== false) {
            if ($Code === 'pt-BR') {
                return 'int2Type3';
            }

            /** Try falling back to standard codes. */
            $Code = substr($Code, 0, $Pos);
        }

        if (in_array($Code, [
            'ceb',
            'fil',
            'tl'
        ], true)) {
            return 'int2Type1';
        }

        if (in_array($Code, [
            'is',
            'mk'
        ], true)) {
            return 'int2Type2';
        }

        if (in_array($Code, [
            'ak',
            'am',
            'as',
            'bh',
            'bho',
            'bn',
            'doi',
            'fa',
            'ff',
            'fr',
            'gu',
            'guw',
            'hi',
            'hy',
            'kab',
            'kn',
            'ln',
            'mg',
            'nso',
            'pa',
            'si',
            'ti',
            'tlh',
            'wa',
            'zu'
        ], true)) {
            return 'int2Type3';
        }

        if (in_array($Code, [
            'af',
            'an',
            'asa',
            'ast',
            'az',
            'bal',
            'bem',
            'bez',
            'bg',
            'brx',
            'ca',
            'ce',
            'cgg',
            'chr',
            'da',
            'de',
            'dv',
            'ee',
            'el',
            'en',
            'eo',
            'es',
            'et',
            'eu',
            'fi',
            'fo',
            'fur',
            'fy',
            'gl',
            'gsw',
            'ha',
            'haw',
            'hu',
            'ia',
            'io',
            'it',
            'jgo',
            'jmc',
            'ka',
            'kaj',
            'kcg',
            'kk',
            'kkj',
            'kl',
            'ks',
            'ksb',
            'ku',
            'ky',
            'lb',
            'lg',
            'lij',
            'mas',
            'mgo',
            'mi',
            'ml',
            'mn',
            'mr',
            'nah',
            'nb',
            'nd',
            'ne',
            'nl',
            'nn',
            'nnh',
            'no',
            'nr',
            'ny',
            'nyn',
            'om',
            'or',
            'os',
            'pap',
            'ps',
            'pt',
            'rm',
            'rof',
            'rwk',
            'saq',
            'sc',
            'scn',
            'sco',
            'sd',
            'seh',
            'sjn',
            'sm',
            'sn',
            'so',
            'sq',
            'ss',
            'ssy',
            'st',
            'sv',
            'sw',
            'syr',
            'ta',
            'te',
            'teo',
            'tig',
            'tk',
            'tn',
            'tr',
            'ts',
            'ug',
            'ur',
            'uz',
            've',
            'vo',
            'vun',
            'wae',
            'xh',
            'xog',
            'yi'
        ], true)) {
            return 'int2Type4';
        }

        if (in_array($Code, [
            'lv',
            'prg'
        ], true)) {
            return 'int3Type1';
        }

        if (in_array($Code, [
            'ksh',
            'lag'
        ], true)) {
            return 'int3Type2';
        }

        if (in_array($Code, [
            'fj',
            'iu',
            'naq',
            'sat',
            'se',
            'sma',
            'smj',
            'smn',
            'sms'
        ], true)) {
            return 'int3Type3';
        }

        if (in_array($Code, [
            'be',
            'bs',
            'hr',
            'ru',
            'sh',
            'sr',
            'uk'
        ], true)) {
            return 'int3Type4';
        }

        if (in_array($Code, [
            'pl'
        ], true)) {
            return 'int3Type5';
        }

        if (in_array($Code, [
            'lt'
        ], true)) {
            return 'int3Type6';
        }

        if (in_array($Code, [
            'shi'
        ], true)) {
            return 'int3Type7';
        }

        if (in_array($Code, [
            'ro',
            'mo'
        ], true)) {
            return 'int3Type8';
        }

        if (in_array($Code, [
            'cs',
            'sk'
        ], true)) {
            return 'int3Type9';
        }

        if (in_array($Code, [
            'qya',
            'tkl'
        ], true)) {
            return 'int3Type10';
        }

        if (in_array($Code, [
            'gv'
        ], true)) {
            return 'int4Type1';
        }

        if (in_array($Code, [
            'gd'
        ], true)) {
            return 'int4Type2';
        }

        if (in_array($Code, [
            'br'
        ], true)) {
            return 'int4Type3';
        }

        if (in_array($Code, [
            'dsb',
            'hsb',
            'sl'
        ], true)) {
            return 'int4Type4';
        }

        if (in_array($Code, [
            'he'
        ], true)) {
            return 'int4Type5';
        }

        if (in_array($Code, [
            'mt'
        ], true)) {
            return 'int4Type6';
        }

        if (in_array($Code, [
            'ga'
        ], true)) {
            return 'int5Type1';
        }

        if (in_array($Code, [
            'ar'
        ], true)) {
            return 'int6Type1';
        }

        if (in_array($Code, [
            'cy'
        ], true)) {
            return 'int6Type2';
        }

        if (in_array($Code, [
            'kw'
        ], true)) {
            return 'int6Type3';
        }

        /** Default rule. */
        return 'int1';
    }

    /**
     * Attempts to automatically determine an appropriate fraction rule to use
     * based upon the specified ISO 639-1/639-2 language code (the former
     * preferred, the latter used if the former isn't available).
     * @link https://www.loc.gov/standards/iso639-2/php/code_list.php
     * @link https://cldr.unicode.org/index/cldr-spec/plural-rules
     * @link https://unicode-org.github.io/cldr-staging/charts/latest/supplemental/language_plural_rules.html
     *
     * @param string $Code An ISO 639-1/639-2 language code.
     * @return string An appropriate fraction rule to use.
     */
    public function getFractionRule($Code)
    {
        /** For different rules based on region, country, or dialect. */
        if (($Pos = strpos($Code, '-')) !== false) {
            if ($Code === 'pt-BR') {
                return 'fraction2Type1';
            }

            /** Try falling back to standard codes. */
            $Code = substr($Code, 0, $Pos);
        }

        if (in_array($Code, [
            'da',
            'ff',
            'fr',
            'hy',
            'kab',
            'lag'
        ], true)) {
            return 'fraction2Type1';
        }

        if (in_array($Code, [
            'am',
            'as',
            'bn',
            'doi',
            'fa',
            'gu',
            'hi',
            'kn',
            'shi',
            'zu'
        ], true)) {
            return 'fraction2Type2';
        }

        /** Default rule. */
        return 'int1';
    }

    /**
     * Assign rules automatically.
     *
     * @param string $Code An ISO 639-1/639-2 language code.
     * @param string $FallbackCode An ISO 639-1/639-2 language code.
     * @return void
     */
    public function autoAssignRules($Code, $FallbackCode = '')
    {
        if ($Code) {
            $this->IntegerRule = $this->getIntegerRule($Code);
            $this->FractionRule = $this->getFractionRule($Code);
        }
        if ($FallbackCode) {
            $this->FallbackIntegerRule = $this->getIntegerRule($FallbackCode);
            $this->FallbackFractionRule = $this->getFractionRule($FallbackCode);
        }
    }
}
