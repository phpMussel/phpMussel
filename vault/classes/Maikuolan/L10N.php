<?php
/**
 * L10N handler (last modified: 2019.05.10).
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
    /** The pluralisation rule to use for integers. */
    private $IntegerRule = 'int1';

    /** The pluralisation rule to use for fractions. */
    private $FractionRule = 'int1';

    /** The pluralisation rule to use for integers for the fallback. */
    private $FallbackIntegerRule = 'int1';

    /** The pluralisation rule to use for fractions for the fallback. */
    private $FallbackFractionRule = 'int1';

    /** All relevant L10N data. */
    public $Data = [];

    /** All relevant fallback L10N data. */
    public $Fallback = [];

    /** When there aren't multiple forms. */
    private function int1()
    {
        return 0;
    }

    /** For e.g., Tagalog. */
    private function int2Type1($Int)
    {
        $Tail = $Int % 10;
        return ($Tail === 4 || $Tail === 6 || $Tail === 9) ? 1 : 0;
    }

    /** For e.g., Icelandic, Macedonian. */
    private function int2Type2($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        return ($Tail === 1 && $Tail2 !== 11) ? 0 : 1;
    }

    /** For e.g., Armenian, Bangla, French, Hindi, Marathi, Zulu. */
    private function int2Type3($Int)
    {
        return ($Int === 0 || $Int === 1) ? 0 : 1;
    }

    /** For e.g., Bulgarian, Danish, Dutch, English, Estonian, German, Greek, Italian. */
    private function int2Type4($Int)
    {
        return ($Int === 1) ? 0 : 1;
    }

    /** For e.g., Latvian, Prussian. */
    private function int3Type1($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 0 || ($Tail2 >= 10 && $Tail2 <= 20)) {
            return 2;
        }
        return ($Tail === 1) ? 0 : 1;
    }

    /** For e.g., Colognian, Langi. */
    private function int3Type2($Int)
    {
        if ($Int === 0) {
            return 2;
        }
        return ($Int === 1) ? 0 : 1;
    }

    /** For e.g., Cornish, Inuktitut. */
    private function int3Type3($Int)
    {
        if ($Int === 2) {
            return 2;
        }
        return ($Int === 1) ? 0 : 1;
    }

    /** For e.g., Russian, Ukrainian, Bosnian, Croatian, Serbian. */
    private function int3Type4($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 1 && $Tail2 !== 11) {
            return 0;
        }
        return ($Tail >= 2 && $Tail <= 4 && ($Tail2 < 10 || $Tail2 >= 20)) ? 1 : 2;
    }

    /** For e.g., Polish. */
    private function int3Type5($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        return ($Tail >= 2 && $Tail <= 4 && ($Tail2 < 10 || $Tail2 >= 20)) ? 1 : 2;
    }

    /** For e.g., Lithuanian. */
    private function int3Type6($Int)
    {
        $Tail = $Int % 10;
        $Tail2 = $Int % 100;
        if ($Tail === 0 || ($Tail2 >= 10 && $Tail2 <= 20)) {
            return 2;
        }
        return ($Tail === 1) ? 0 : 1;
    }

    /** For e.g., Tachelhit. */
    private function int3Type7($Int)
    {
        if ($Int > 10) {
            return 2;
        }
        return ($Int > 1) ? 1 : 0;
    }

    /** For e.g., Moldavian, Romanian. */
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

    /** For e.g., Czech, Slovak. */
    private function int3Type9($Int)
    {
        if ($Int === 1) {
            return 0;
        }
        return ($Int >= 2 && $Int <= 4) ? 1 : 2;
    }

    /** For e.g., Manx. */
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

    /** For e.g., Gaelic. */
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

    /** For e.g., Breton. */
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

    /** For e.g., Sorbian, Slovenian. */
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

    /** For e.g., Hebrew. */
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

    /** For e.g., Maltese. */
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
            return 3;
        }
        return 1;
    }

    /** For e.g., Irish. */
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

    /** For e.g., Arabic. */
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

    /** For e.g., Welsh. */
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

    /** For e.g., Armenian, Danish, French, Portuguese. */
    private function fraction2Type1($Fraction)
    {
        return ($Fraction >= 2) ? 1 : 0;
    }

    /** For e.g., Amharic, Bangla, Hindi, Marathi. */
    private function fraction2Type2($Fraction)
    {
        return ($Fraction >= 1) ? 1 : 0;
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
        return isset($this->Fallback[$String]) ? $this->Fallback[$String] : '';
    }

    /**
     * @param array $Data The L10N data.
     * @param array $Fallback The fallback L10N data (optional).
     */
    public function __construct(array $Data = [], array $Fallback = [])
    {
        $this->Data = $Data;
        $this->Fallback = $Fallback;
        if (!empty($Data['IntegerRule']) && method_exists($this, $Data['IntegerRule'])) {
            $this->IntegerRule = $Data['IntegerRule'];
        }
        if (!empty($Data['FractionRule']) && method_exists($this, $Data['FractionRule'])) {
            $this->FractionRule = $Data['FractionRule'];
        }
        if (!empty($Fallback['IntegerRule']) && method_exists($this, $Fallback['IntegerRule'])) {
            $this->FallbackIntegerRule = $Fallback['IntegerRule'];
        }
        if (!empty($Fallback['FractionRule']) && method_exists($this, $Fallback['FractionRule'])) {
            $this->FallbackFractionRule = $Fallback['FractionRule'];
        }
    }

}
