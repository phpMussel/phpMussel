<?php
/**
 * Operation handler (last modified: 2021.04.06).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * Source: https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis.
 * *This particular class*, COPYRIGHT 2021 and beyond by Caleb Mazalevskis.
 */

namespace Maikuolan\Common;

class Operation
{
    /**
     * @var array Data sources for operations.
     */
    public $Sources = [];

    /**
     * @var array Caching to optimise operations.
     */
    private $Cache = [];

    /**
     * Operators for version numbers.
     *
     * @param string $Actual The actual value.
     * @param string $Constraint The constraint to meet.
     * @param bool $NextMajor Whether to limit against next major.
     * @param bool $GreaterThan Whether operator is greater than.
     * @param bool $OrEqualTo Whether operator is or equal to.
     * @return bool True if constraint is met; False otherwise.
     */
    public function opVersions(string $Actual, string $Constraint, bool $NextMajor, bool $GreaterThan, bool $OrEqualTo): bool
    {
        $Actual = $this->splitVersionParts($Actual);
        $Constraint = $this->splitVersionParts($Constraint);
        if ($NextMajor && ($Actual[0] !== $Constraint[0])) {
            return false;
        }
        while (true) {
            $ActualPart = array_shift($Actual);
            $ConstraintPart = array_shift($Constraint);
            if ($ActualPart === null && $ConstraintPart === null) {
                break;
            }
            if ($ActualPart === null) {
                $ActualPart = 0;
            }
            if ($ConstraintPart === null) {
                $ConstraintPart = 0;
            }
            if ($ActualPart < $ConstraintPart) {
                return !$GreaterThan;
            }
            if ($ActualPart > $ConstraintPart) {
                return $GreaterThan;
            }
        }
        return $OrEqualTo;
    }

    /**
     * Equal to operator.
     *
     * @param string $Actual The actual value.
     * @param string $Constraint The constraint to meet.
     * @return bool True if constraint is met; False otherwise.
     */
    public function opEqualTo(string $Actual, string $Constraint): bool
    {
        $Actual = $this->splitVersionParts($Actual);
        $Constraint = $this->splitVersionParts($Constraint);
        while (true) {
            $ActualPart = array_shift($Actual);
            $ConstraintPart = array_shift($Constraint);
            if ($ActualPart === null && $ConstraintPart === null) {
                break;
            }
            if ($ActualPart !== $ConstraintPart) {
                return false;
            }
        }
        return true;
    }

    /**
     * Multiple compare operation.
     *
     * @param array $Operand Left-side operands.
     * @param array $Prefix Operations and right-side operands.
     * @return bool Return value of the operation.
     */
    public function multiCompare(array $Operand, array $Prefix): bool
    {
        $Result = false;
        while ($ThisOperand = array_shift($Actual)) {
            $ThisPrefix = array_shift($Actual);
            $Result = $this->singleCompare($ThisOperand, $ThisPrefix);
            if (!$Result) {
                return false;
            }
        }
        return $Result;
    }

    /**
     * Single compare operation.
     *
     * @param string $Operand Left-side operand.
     * @param string $Prefix Operation and right-side operand.
     * @return bool Return value of the operation.
     */
    public function singleCompare(string $Operand, string $Prefix): bool
    {
        if (isset($this->Cache[$Operand . $Prefix])) {
            return $this->Cache[$Operand . $Prefix];
        }
        if ($Prefix === '*') {
            return ($this->Cache[$Operand . $Prefix] = strlen($Operand) > 0);
        }
        $OpOrArr = explode('|', $Prefix);
        $Result = true;
        foreach ($OpOrArr as $OpOr) {
            $OpAndArr = preg_split('~\&| ~', $OpOr, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            foreach ($OpAndArr as $OpAnd) {
                $Initial = substr($OpAnd, 0, 1);
                if ($Initial === '>') {
                    $OpAnd = substr($OpAnd, 1);
                    $Initial = substr($OpAnd, 0, 1);
                    if ($Initial === '=') {
                        $Result = $this->opVersions($Operand, substr($OpAnd, 1), false, true, true);
                    } else {
                        $Result = $this->opVersions($Operand, $OpAnd, false, true, false);
                    }
                } elseif ($Initial === '<') {
                    $OpAnd = substr($OpAnd, 1);
                    $Initial = substr($OpAnd, 0, 1);
                    if ($Initial === '=') {
                        $Result = $this->opVersions($Operand, substr($OpAnd, 1), false, false, true);
                    } else {
                        $Result = $this->opVersions($Operand, $OpAnd, false, false, false);
                    }
                } elseif ($Initial === '^') {
                    $Result = $this->opVersions($Operand, substr($OpAnd, 1), true, true, true);
                } elseif ($Initial === '=') {
                    $Result = $this->opEqualTo($Operand, substr($OpAnd, 1));
                } else {
                    $Result = $this->opEqualTo($Operand, $OpAnd);
                }
                if (!$Result) {
                    continue 2;
                }
            }
            if ($Result) {
                break;
            }
        }
        return ($this->Cache[$Operand . $Prefix] = $Result);
    }

    /**
     * Split version parts.
     *
     * @param string $Version The version to split.
     * @return array The split version.
     */
    public function splitVersionParts(string $Version = ''): array
    {
        $EndTack = preg_split('~[+-]~', strtolower($Version), -1, PREG_SPLIT_NO_EMPTY);
        $Parts = explode('.', strtolower(array_shift($EndTack)));
        if (substr($Parts[0], 0, 1) === 'v') {
            $Parts[0] = substr($Parts[0], 1);
        }
        foreach ($Parts as &$Part) {
            $Part = (int)$Part;
        }
        $PartsPad = 3 - count($Parts);
        while ($PartsPad > 0) {
            $Parts[] = 0;
            $PartsPad--;
        }
        $ByStage = [];
        $Matches = [];
        if (isset($EndTack[0])) {
            preg_match('~^([a-z])?.*?(\d*)?$~', $EndTack[0], $Matches);
            if ($Matches[1] === 'a') {
                $ByStage[] = -3;
            } elseif ($Matches[1] === 'b') {
                $ByStage[] = -2;
            } elseif (strlen($Matches[1]) > 0) {
                $ByStage[] = -1;
            } else {
                $ByStage[] = 0;
            }
            if ($Matches[2] === '') {
                unset($EndTack[0]);
            } else {
                $EndTack[0] = $Matches[2];
            }
        }
        foreach ($EndTack as &$Part) {
            $Part = (int)$Part;
        }
        return array_merge($Parts, $ByStage, $EndTack);
    }
}
