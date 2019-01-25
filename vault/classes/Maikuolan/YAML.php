<?php
/**
 * YAML handler (last modified: 2019.01.25).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis
 * (Maikuolan). Earliest iteration and deployment of "YAML handler" COPYRIGHT
 * 2016 and beyond by Caleb Mazalevskis (Maikuolan).
 *
 * Note: The YAML handler is intended to adequately serve the needs of the
 * packages and projects where it is implemented, but isn't a complete YAML
 * solution, instead supporting the YAML specification only to the bare minimum
 * required by those packages and projects known to implement it.
 */

namespace Maikuolan\Common;

class YAML
{
    /** An array to contain all the data processed by the handler. */
    public $Data = [];

    /**
     * Can optionally begin processing data as soon as the object is
     * instantiated, or just instantiate first, and manually make any needed
     * calls afterwards (though the former is recommended over the latter).
     *
     * @param string $In The data to process.
     */
    public function __construct($In = false)
    {
        if ($In) {
            $this->process($In, $this->Data);
        }
    }

    /**
     * Normalises values defined by the YAML closure.
     *
     * @param string|int|bool $Value The value to be normalised.
     * @param int $ValueLen The length of the value to be normalised.
     * @param string|int|bool $ValueLow The value to be normalised, lowercased.
     */
    private function normaliseValue(&$Value, $ValueLen, $ValueLow)
    {
        if (substr($Value, 0, 1) === '"' && substr($Value, $ValueLen - 1) === '"') {
            $Value = substr($Value, 1, $ValueLen - 2);
        } elseif (substr($Value, 0, 1) === '\'' && substr($Value, $ValueLen - 1) === '\'') {
            $Value = substr($Value, 1, $ValueLen - 2);
        } elseif ($ValueLow === 'true' || $ValueLow === 'y') {
            $Value = true;
        } elseif ($ValueLow === 'false' || $ValueLow === 'n') {
            $Value = false;
        } elseif (substr($Value, 0, 2) === '0x' && ($HexTest = substr($Value, 2)) && !preg_match('/[^\da-f]/i', $HexTest) && !($ValueLen % 2)) {
            $Value = hex2bin($HexTest);
        } else {
            $ValueInt = (int)$Value;
            if (strlen($ValueInt) === $ValueLen && $Value == $ValueInt && $ValueLen > 1) {
                $Value = $ValueInt;
            }
        }
        if (!$Value) {
            $Value = false;
        }
    }

    /**
     * @param string $In The data to be processed.
     * @param array $Arr Where to store the processed data.
     * @param int $Depth Tab depth (inherited through recursion; ignore it).
     * @return bool True when entire process completes successfully. False to exit early.
     */
    public function process($In, &$Arr, $Depth = 0)
    {
        if (!is_string($In) || strpos($In, "\n") === false) {
            return false;
        }
        if (!is_array($Arr)) {
            $Arr = [];
        }
        $In = str_replace("\r", '', $In);
        $Key = $Value = $SendTo = '';
        $TabLen = $SoL = 0;
        while ($SoL !== false) {
            $ThisLine = (
                ($EoL = strpos($In, "\n", $SoL)) === false
            ) ? substr($In, $SoL) : substr($In, $SoL, $EoL - $SoL);
            $SoL = ($EoL === false) ? false : $EoL + 1;
            $ThisLine = preg_replace(['/#.*$/', '/\s+$/'], '', $ThisLine);
            if (empty($ThisLine) || $ThisLine === "\n") {
                continue;
            }
            $ThisTab = 0;
            while (($Chr = substr($ThisLine, $ThisTab, 1)) && ($Chr === ' ' || $Chr === "\t")) {
                $ThisTab++;
            }
            if ($ThisTab > $Depth) {
                if ($TabLen === 0) {
                    $TabLen = $ThisTab;
                }
                $SendTo .= $ThisLine . "\n";
                continue;
            } elseif ($ThisTab < $Depth) {
                return false;
            } elseif (!empty($SendTo)) {
                if (empty($Key)) {
                    return false;
                }
                if (!isset($Arr[$Key])) {
                    $Arr[$Key] = false;
                }
                if (!$this->process($SendTo, $Arr[$Key], $TabLen)) {
                    return false;
                }
                $SendTo = '';
            }
            if (!$this->processLine($ThisLine, $ThisTab, $Key, $Value, $Arr)) {
                return false;
            }
        }
        if (!empty($SendTo) && !empty($Key)) {
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = [];
            }
            if (!$this->process($SendTo, $Arr[$Key], $TabLen)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Process a single line of YAML input.
     *
     * @param string $ThisLine The line to be processed.
     * @param string $ThisTab Size of the line indentation.
     * @param string|int $Key Line key.
     * @param string|int|bool $Value Line value.
     * @param array $Arr Where to store the data.
     * @return bool True when entire process completes successfully. False to exit early.
     */
    private function processLine(&$ThisLine, &$ThisTab, &$Key, &$Value, &$Arr)
    {
        if (substr($ThisLine, -1) === ':') {
            $Key = substr($ThisLine, $ThisTab, -1);
            $KeyLen = strlen($Key);
            $KeyLow = strtolower($Key);
            $this->normaliseValue($Key, $KeyLen, $KeyLow);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = false;
            }
        } elseif (substr($ThisLine, $ThisTab, 2) === '- ') {
            $Value = substr($ThisLine, $ThisTab + 2);
            $ValueLen = strlen($Value);
            $ValueLow = strtolower($Value);
            $this->normaliseValue($Value, $ValueLen, $ValueLow);
            if ($ValueLen > 0) {
                $Arr[] = $Value;
            }
        } elseif (($DelPos = strpos($ThisLine, ': ')) !== false) {
            $Key = substr($ThisLine, $ThisTab, $DelPos - $ThisTab);
            $KeyLen = strlen($Key);
            $KeyLow = strtolower($Key);
            $this->normaliseValue($Key, $KeyLen, $KeyLow);
            if (!$Key) {
                if (substr($ThisLine, $ThisTab, $DelPos - $ThisTab + 2) !== '0: ') {
                    return false;
                }
                $Key = 0;
            }
            $Value = substr($ThisLine, $ThisTab + $KeyLen + 2);
            $ValueLen = strlen($Value);
            $ValueLow = strtolower($Value);
            $this->normaliseValue($Value, $ValueLen, $ValueLow);
            if ($ValueLen > 0) {
                $Arr[$Key] = $Value;
            }
        } elseif (strpos($ThisLine, ':') === false && strlen($ThisLine) > 1) {
            $Key = $ThisLine;
            $KeyLen = strlen($Key);
            $KeyLow = strtolower($Key);
            $this->normaliseValue($Key, $KeyLen, $KeyLow);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = false;
            }
        }
        return true;
    }

    /**
     * Reconstruct an inner level of YAML (shouldn't be called directly).
     *
     * @param array $Arr The array to reconstruct from.
     * @param string $Out The reconstructed YAML.
     * @param int $Depth The level depth.
     */
    private function processInner($Arr, &$Out, $Depth = 0)
    {
        foreach ($Arr as $Key => $Value) {
            if ($Key === '---' && $Value === false) {
                $Out .= "---\n";
                continue;
            }
            if (!isset($List)) {
                $List = ($Key === 0);
            }
            $Out .= str_repeat(' ', $Depth) . (($List && is_int($Key)) ? '-' : $Key . ':');
            if (is_array($Value)) {
                $Depth++;
                $Out .= "\n";
                $this->processInner($Value, $Out, $Depth);
                $Depth--;
                continue;
            }
            if ($Value === true) {
                $Out .= ' true';
            } elseif ($Value === false) {
                $Out .= ' false';
            } else {
                $Out .= ' ' . $Value;
            }
            $Out .= "\n";
        }
    }

    /**
     * Reconstruct YAML.
     *
     * @param array $Arr The array to reconstruct from.
     * @return string The reconstructed YAML.
     */
    public function reconstruct($Arr)
    {
        $Out = '';
        $this->processInner($Arr, $Out);
        return $Out . "\n";
    }

}
