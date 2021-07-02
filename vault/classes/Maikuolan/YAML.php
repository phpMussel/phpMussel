<?php
/**
 * YAML handler (last modified: 2021.07.02).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * Source: https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis.
 * *This particular class*, COPYRIGHT 2016 and beyond by Caleb Mazalevskis.
 *
 * Note: Some parts of the YAML specification aren't supported by this class.
 * See the included documentation for more information.
 */

namespace Maikuolan\Common;

class YAML
{
    /**
     * @var array An array to contain all the data processed by the handler.
     */
    public $Data = [];

    /**
     * @var bool Whether to render multi-line values.
     */
    private $MultiLine = false;

    /**
     * @var bool Whether to render folded multi-line values.
     */
    private $MultiLineFolded = false;

    /**
     * @var string Default indent to use when reconstructing YAML data.
     */
    public $Indent = ' ';

    /**
     * @var int Single line to folded multi-line string length limit.
     */
    public $FoldedAt = 120;

    /**
     * @var array Used to cache any anchors found in the document.
     */
    public $Anchors = [];

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.6.2';

    /**
     * Can optionally begin processing data as soon as the object is
     * instantiated, or just instantiate first, and manually make any needed
     * calls afterwards (though the former is recommended over the latter).
     *
     * @param string $In The data to process.
     * @return void
     */
    public function __construct($In = '')
    {
        if ($In) {
            $this->process($In, $this->Data);
        }
    }

    /**
     * Normalises the values defined by the processLine method.
     *
     * @param string|int|bool $Value The value to be normalised.
     * @param int $ValueLen The length of the value to be normalised.
     * @param string|int|bool $ValueLow The value to be normalised, lowercased.
     * @return void
     */
    private function normaliseValue(&$Value, $ValueLen, $ValueLow)
    {
        /** Check for anchors and populate if necessary. */
        $AnchorMatches = [];
        if (
            preg_match('~^&([\dA-Za-z]+) +(.*)$~', $Value, $AnchorMatches) &&
            isset($AnchorMatches[1], $AnchorMatches[2])
        ) {
            $Value = $AnchorMatches[2];
            $this->Anchors[$AnchorMatches[1]] = $Value;
            $ValueLen = strlen($Value);
            $ValueLow = strtolower($Value);
        } elseif (
            preg_match('~^\*([\dA-Za-z]+)$~', $Value, $AnchorMatches) &&
            isset($AnchorMatches[1], $this->Anchors[$AnchorMatches[1]])
        ) {
            $Value = $this->Anchors[$AnchorMatches[1]];
            $ValueLen = strlen($Value);
            $ValueLow = strtolower($Value);
        }

        /** Check for string quotes. */
        foreach ([
            ['"', '"', 1],
            ["'", "'", 1],
            ['`', '`', 1],
            ["\x91", "\x92", 1],
            ["\x93", "\x94", 1],
            ["\xe2\x80\x98", "\xe2\x80\x99", 3],
            ["\xe2\x80\x9c", "\xe2\x80\x9d", 3]
        ] as $Wrapper) {
            if (substr($Value, 0, $Wrapper[2]) === $Wrapper[0] && substr($Value, $ValueLen - $Wrapper[2]) === $Wrapper[1]) {
                $Value = substr($Value, $Wrapper[2], $ValueLen - ($Wrapper[2] * 2));
                return;
            }
        }

        if ($ValueLow === 'true' || $ValueLow === 'y' || $Value === '+') {
            $Value = true;
        } elseif ($ValueLow === 'false' || $ValueLow === 'n' || $Value === '-') {
            $Value = false;
        } elseif ($ValueLow === 'null' || $Value === '~') {
            $Value = null;
        } elseif (substr($Value, 0, 2) === '0x' && ($HexTest = substr($Value, 2)) && !preg_match('/[^\da-f]/i', $HexTest) && !($ValueLen % 2)) {
            $Value = hex2bin($HexTest);
        } elseif (preg_match('~^\d+$~', $Value)) {
            $Value = (int)$Value;
        } elseif (preg_match('~^(?:\d+\.\d+|\d+(?:\.\d+)?[Ee][-+]\d+)$~', $Value)) {
            $Value = (float)$Value;
        } elseif (!$ValueLen) {
            $Value = false;
        } else {
            $Value = (string)$Value;
        }
    }

    /**
     * @param string $In The data to be processed.
     * @param array $Arr Where to store the processed data.
     * @param int $Depth Tab depth (inherited through recursion; ignore it).
     * @return bool True when entire process completes successfully. False to exit early.
     */
    public function process($In, array &$Arr, $Depth = 0)
    {
        if (!is_string($In) || strpos($In, "\n") === false) {
            return false;
        }
        if ($Depth === 0) {
            $this->MultiLine = false;
            $this->MultiLineFolded = false;
        }
        $In = str_replace("\r", '', $In);
        $Key = $Value = $SendTo = '';
        $TabLen = $SoL = 0;
        while ($SoL !== false) {
            $ThisLine = (
                ($EoL = strpos($In, "\n", $SoL)) === false
            ) ? substr($In, $SoL) : substr($In, $SoL, $EoL - $SoL);
            $SoL = ($EoL === false) ? false : $EoL + 1;
            if (!($ThisLine = preg_replace(['/(?<!\\\)#.*$/', '/\s+$/'], '', $ThisLine))) {
                continue;
            }
            $ThisLine = str_replace('\#', '#', $ThisLine);
            $ThisTab = 0;
            while (($Chr = substr($ThisLine, $ThisTab, 1)) && ($Chr === ' ' || $Chr === "\t")) {
                $ThisTab++;
            }
            if (($ThisTab > $Depth)) {
                if ($TabLen === 0) {
                    $TabLen = $ThisTab;
                }
                if (!$this->MultiLine && !$this->MultiLineFolded) {
                    $SendTo .= $ThisLine . "\n";
                } else {
                    if ($SendTo) {
                        if ($this->MultiLine) {
                            $SendTo .= "\n";
                        } elseif (substr($ThisLine, $TabLen, 1) !== ' ' && substr($SendTo, -1) !== ' ') {
                            $SendTo .= ' ';
                        }
                    }
                    $SendTo .= substr($ThisLine, $TabLen);
                }
                continue;
            } elseif ($ThisTab < $Depth) {
                return false;
            } elseif ($SendTo) {
                if (empty($Key)) {
                    return false;
                }
                if (!$this->MultiLine && !$this->MultiLineFolded) {
                    if (!isset($Arr[$Key]) || !is_array($Arr[$Key])) {
                        $Arr[$Key] = [];
                    }
                    if (!$this->process($SendTo, $Arr[$Key], $TabLen)) {
                        return false;
                    }
                } else {
                    $Arr[$Key] = $SendTo;
                }
                $SendTo = '';
            }
            if (!$this->processLine($ThisLine, $ThisTab, $Key, $Value, $Arr)) {
                return false;
            }
        }
        if ($SendTo && !empty($Key)) {
            if (!$this->MultiLine && !$this->MultiLineFolded) {
                if (!isset($Arr[$Key]) || !is_array($Arr[$Key])) {
                    $Arr[$Key] = [];
                }
                if (!$this->process($SendTo, $Arr[$Key], $TabLen)) {
                    return false;
                }
            } else {
                $Arr[$Key] = $SendTo;
            }
        }
        return true;
    }

    /**
     * Process a single line of YAML input.
     *
     * @param string $ThisLine The line to be processed.
     * @param int $ThisTab The size of the line indentation.
     * @param string|int $Key Line key.
     * @param string|int|bool $Value Line value.
     * @param array $Arr Where to store the data.
     * @return bool True when entire process completes successfully. False to exit early.
     */
    private function processLine(&$ThisLine, &$ThisTab, &$Key, &$Value, array &$Arr)
    {
        if ($ThisLine === '---') {
            $Key = '---';
            $Value = false;
            $Arr[$Key] = $Value;
        } elseif (substr($ThisLine, -1) === ':' && strpos($ThisLine, ': ') === false) {
            $Key = substr($ThisLine, $ThisTab, -1);
            $KeyLen = strlen($Key);
            $KeyLow = strtolower($Key);
            $this->normaliseValue($Key, $KeyLen, $KeyLow);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = false;
            }
            $Value = false;
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
        } elseif (substr($ThisLine, -1) === '-') {
            $Arr[] = false;
            end($Arr);
            $Key = key($Arr);
            reset($Arr);
            $Value = false;
        } elseif (strpos($ThisLine, ':') === false && strlen($ThisLine) > 1) {
            $Key = $ThisLine;
            $KeyLen = strlen($Key);
            $KeyLow = strtolower($Key);
            $this->normaliseValue($Key, $KeyLen, $KeyLow);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = false;
            }
            $Value = false;
        }
        $this->MultiLine = ($Value === '|');
        $this->MultiLineFolded = ($Value === '>');
        return true;
    }

    /**
     * Reconstruct an inner level of YAML (shouldn't be called directly).
     *
     * @param array $Arr The array to reconstruct from.
     * @param string $Out The reconstructed YAML.
     * @param int $Depth The level depth.
     * @return void
     */
    private function processInner(array $Arr, &$Out, $Depth = 0)
    {
        $Sequential = (array_keys($Arr) === range(0, count($Arr) - 1));
        foreach ($Arr as $Key => $Value) {
            if ($Key === '---' && $Value === false) {
                $Out .= "---\n";
                continue;
            }
            $ThisDepth = str_repeat($this->Indent, $Depth);
            $Out .= $ThisDepth . ($Sequential ? '-' : $Key . ':');
            if (is_array($Value)) {
                $Out .= "\n";
                $this->processInner($Value, $Out, $Depth + 1);
                continue;
            }
            $Out .= $this->Indent;
            if ($Value === true) {
                $Out .= 'true';
            } elseif ($Value === false) {
                $Out .= 'false';
            } elseif ($Value === null) {
                $Out .= 'null';
            } elseif (preg_match('~[^\t\n\r\x20-\x7e\xa0-\xff]~', $Value)) {
                $Out .= '0x' . strtolower(bin2hex($Value));
            } elseif (strpos($Value, "\n") !== false) {
                $Value = str_replace("\n", "\n" . $ThisDepth . $this->Indent, $Value);
                $Out .= "|\n" . $ThisDepth . $this->Indent . $Value;
            } elseif (is_string($Value)) {
                if (strpos($Value, ' ') !== false && strlen($Value) >= $this->FoldedAt) {
                    $Value = wordwrap($Value, $this->FoldedAt, "\n" . $ThisDepth . $this->Indent);
                    $Out .= ">\n" . $ThisDepth . $this->Indent . $Value;
                } else {
                    $Out .= '"' . $Value . '"';
                }
            } else {
                $Out .= $Value;
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
    public function reconstruct(array $Arr)
    {
        $Out = '';
        $this->processInner($Arr, $Out);
        return $Out . "\n";
    }

    /**
     * PHP's magic "__toString" method to act as an alias for "reconstruct".
     *
     * @return string
     */
    public function __toString()
    {
        return $this->reconstruct($this->Data);
    }
}
