<?php
/**
 * YAML handler (last modified: 2021.08.25).
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
     * @var array Used as a data source for inline variables.
     */
    public $Refs = [];

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
    public const VERSION = '2.7.0';

    /**
     * Can optionally begin processing data as soon as the object is
     * instantiated, or just instantiate first, and manually make any needed
     * calls afterwards if preferred.
     *
     * @param string $In The data to process.
     * @return void
     */
    public function __construct(string $In = '')
    {
        if ($In) {
            $this->process($In, $this->Data, 0, true);
        }
    }

    /**
     * Normalises the values defined by the processLine method.
     *
     * @param string|int|bool $Value The value to be normalised.
     * @return void
     */
    private function normaliseValue(&$Value): void
    {
        /** Check for anchors and populate if necessary. */
        $AnchorMatches = [];
        if (
            preg_match('~^&([\dA-Za-z]+) +(.*)$~', $Value, $AnchorMatches) &&
            isset($AnchorMatches[1], $AnchorMatches[2])
        ) {
            $Value = $AnchorMatches[2];
            $this->Anchors[$AnchorMatches[1]] = $Value;
        } elseif (
            preg_match('~^\*([\dA-Za-z]+)$~', $Value, $AnchorMatches) &&
            isset($AnchorMatches[1], $this->Anchors[$AnchorMatches[1]])
        ) {
            $Value = $this->Anchors[$AnchorMatches[1]];
        }

        /** Check for inline variables. */
        $this->tryStringDataTraverseByRef($Value);

        $ValueLen = strlen($Value);
        $ValueLow = strtolower($Value);

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
     * Process YAML data.
     *
     * @param string $In The data to be processed.
     * @param array $Arr Where to store the processed data.
     * @param int $Depth Tab depth (inherited through recursion; ignore it).
     * @param bool $Refs Whether to set refs for inline variables.
     * @return bool True when entire process completes successfully. False to exit early.
     */
    public function process(string $In, array &$Arr, int $Depth = 0, bool $Refs = false): bool
    {
        if (strpos($In, "\n") === false) {
            return false;
        }
        if ($Refs) {
            $this->Refs = &$Arr;
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
                    $this->tryStringDataTraverseByRef($SendTo);
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
                $this->tryStringDataTraverseByRef($SendTo);
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
    private function processLine(string &$ThisLine, int &$ThisTab, &$Key, &$Value, array &$Arr): bool
    {
        if ($ThisLine === '---') {
            $Key = '---';
            $Value = false;
            $Arr[$Key] = $Value;
        } elseif (substr($ThisLine, -1) === ':' && strpos($ThisLine, ': ') === false) {
            $Key = substr($ThisLine, $ThisTab, -1);
            $this->normaliseValue($Key);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = false;
            }
            $Value = false;
        } elseif (substr($ThisLine, $ThisTab, 2) === '- ') {
            $Value = substr($ThisLine, $ThisTab + 2);
            $ValueLen = strlen($Value);
            $this->normaliseValue($Value);
            if ($ValueLen > 0) {
                $Arr[] = $Value;
            }
        } elseif (($DelPos = strpos($ThisLine, ': ')) !== false) {
            $Key = substr($ThisLine, $ThisTab, $DelPos - $ThisTab);
            $KeyLen = strlen($Key);
            $this->normaliseValue($Key);
            if (!$Key) {
                if (substr($ThisLine, $ThisTab, $DelPos - $ThisTab + 2) !== '0: ') {
                    return false;
                }
                $Key = 0;
            }
            $Value = substr($ThisLine, $ThisTab + $KeyLen + 2);
            $ValueLen = strlen($Value);
            $this->normaliseValue($Value);
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
            $this->normaliseValue($Key);
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
    private function processInner(array $Arr, string &$Out, int $Depth = 0): void
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
    public function reconstruct(array $Arr): string
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
    public function __toString(): string
    {
        return $this->reconstruct($this->Data);
    }

    /**
     * Traverse data path.
     *
     * @param mixed $Data The data to traverse.
     * @param string|array $Path The path to traverse.
     * @return mixed The traversed data, or an empty string on failure.
     */
    public function dataTraverse(&$Data, $Path = [])
    {
        if (!is_array($Path)) {
            $Path = preg_split('~(?<!\\\)\.~', $Path) ?: [];
        }
        $Segment = array_shift($Path);
        if ($Segment === null || strlen($Segment) === 0) {
            return is_scalar($Data) ? $Data : '';
        }
        $Segment = str_replace('\.', '.', $Segment);
        if (is_array($Data)) {
            return isset($Data[$Segment]) ? $this->dataTraverse($Data[$Segment], $Path) : '';
        }
        return $this->dataTraverse($Data, $Path);
    }

    /**
     * Attempt string data path traverse by reference.
     *
     * @param mixed $Data The data to traverse.
     * @return void
     */
    public function tryStringDataTraverseByRef(&$Data): void
    {
        if (
            empty($this->Refs) ||
            !is_string($Data) ||
            !preg_match_all('~\{\{ ?([.\dA-Z_a-z]+) ?\}\}~', $Data, $VarMatches) ||
            !isset($VarMatches[0][0], $VarMatches[1][0])
        ) {
            return;
        }
        $MatchCount = count($VarMatches[0]);
        for ($Index = 0; $Index < $MatchCount; $Index++) {
            if (($Extracted = $this->dataTraverse($this->Refs, $VarMatches[1][$Index])) && is_string($Extracted)) {
                $Data = str_replace($VarMatches[0][$Index], $Extracted, $Data);
            }
        }
    }
}
