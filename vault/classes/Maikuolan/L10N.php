<?php
/**
 * L10N handler (last modified: 2021.10.30).
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

class L10N
{
    /**
     * @var array All relevant L10N data.
     */
    public $Data = [];

    /**
     * @var array All relevant fallback L10N data.
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
    const VERSION = '1.7.0';

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
        if (!empty($Data['IntegerRule']) && method_exists($this, $Data['IntegerRule'])) {
            $this->IntegerRule = $Data['IntegerRule'];
        }
        if (!empty($Data['FractionRule']) && method_exists($this, $Data['FractionRule'])) {
            $this->FractionRule = $Data['FractionRule'];
        }
        if (is_array($Fallback)) {
            if (!empty($Fallback['IntegerRule']) && method_exists($this, $Fallback['IntegerRule'])) {
                $this->FallbackIntegerRule = $Fallback['IntegerRule'];
            }
            if (!empty($Fallback['FractionRule']) && method_exists($this, $Fallback['FractionRule'])) {
                $this->FallbackFractionRule = $Fallback['FractionRule'];
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
        } elseif (isset($this->Fallback[$String])) {
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
     * Two grammatical numbers, type one. For e.g., Tagalog.
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
     * French, Hindi, Marathi, Zulu.
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
     * Three grammatical numbers, type three. For e.g., Cornish, Inuktitut.
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
        $Tail2 = $Int % 100;
        if ($Int < 20 || ($Tail2 > 0 && $Tail2 < 20)) {
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
     * Two fraction forms, type two. For e.g., Amharic, Bangla, Hindi, Marathi.
     *
     * @param float $Fraction The fraction of things.
     * @return int 0: Singular form. 1: Other form.
     */
    private function fraction2Type2($Fraction)
    {
        return ($Fraction >= 1) ? 1 : 0;
    }
}
