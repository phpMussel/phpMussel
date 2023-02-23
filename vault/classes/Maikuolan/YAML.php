<?php
/**
 * YAML handler (last modified: 2023.02.23).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
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
     * @var string Default indent to use when reconstructing YAML data.
     */
    public $Indent = ' ';

    /**
     * @var string Last indent used when processing YAML data.
     */
    public $LastIndent = '';

    /**
     * @var string Captured header comments from the YAML data.
     */
    public $CapturedHeader = '';

    /**
     * @var int Single line to folded multi-line string length limit.
     */
    public $FoldedAt = 120;

    /**
     * @var array Used to cache any anchors found in the document.
     * @link https://yaml.org/spec/1.2.2/#692-node-anchors
     */
    public $Anchors = [];

    /**
     * @var bool Whether to escape according to the YAML specification.
     * @link https://yaml.org/spec/1.2.2/#57-escaped-characters
     */
    public $EscapeBySpec = false;

    /**
     * @var string The preferred style of quotes to use for strings.
     */
    public $Quotes = '"';

    /**
     * @var string Which PHP string functions tag coercion can leverage.
     */
    public $AllowedStringTagsPattern = '~^(?:addslashes|bin2hex|hex2bin|html(?:_entity_decode|entities|specialchars(?:_decode)?)|lcfirst|nl2br|ord|quotemeta|str(?:_rot13|_shuffle|ip(?:_tags|c?slashes)|len|rev|tolower|toupper)|ucfirst|ucwords)$~';

    /**
     * @var string Which numeric PHP functions tag coercion can leverage.
     */
    public $AllowedNumericTagsPattern = '~^(?:a(?:bs|cosh?|sinh?|tanh?)|ceil|chr|cosh?|dec(?:bin|hex|oct)|deg2rad|exp(?:m1)?|floor|log1[0p]|rad2deg|round|sinh?|tanh?|sqrt)$~';

    /**
     * @var int The depth at which flows will be rebuilt.
     */
    public $FlowRebuildDepth = 32;

    /**
     * @var bool Whether to quote keys.
     */
    public $QuoteKeys = false;

    /**
     * @var bool Whether to render multi-line values.
     */
    private $MultiLine = false;

    /**
     * @var bool Whether to render folded multi-line values.
     */
    private $MultiLineFolded = false;

    /**
     * @var string Whether to use chomping for the current multiline block.
     */
    private $Chomp = '';

    /**
     * @var array Used to determine which anchors have been reconstructed.
     */
    private $AnchorsDone = [];

    /**
     * @var bool Whether to try reconstructing anchors during reconstruction.
     */
    private $DoWithAnchors = false;

    /**
     * @var string Encoding used by the most recent process input.
     */
    private $LastInputEncoding = '';

    /**
     * @var \Maikuolan\Common\Demojibakefier Used to support various encodings.
     */
    private $Demojibakefier = null;

    /**
     * @var string Used for coercing blocks.
     */
    private $LastResolvedTag = '';

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    const VERSION = '1.9.5';

    /**
     * Can optionally begin processing data as soon as the object is
     * instantiated, or just instantiate first, and manually make any needed
     * calls afterwards if preferred.
     *
     * @param string $In The data to process.
     * @return void
     */
    public function __construct($In = '')
    {
        if ($In) {
            $this->process($In, $this->Data, 0, true);
        }
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

    /**
     * Process YAML data.
     *
     * @param string $In The data to be processed.
     * @param array $Arr Where to store the processed data.
     * @param int $Depth Tab depth (inherited through recursion; ignore it).
     * @param bool $Refs Whether to set refs for inline variables.
     * @return bool True when entire process completes successfully. False to exit early.
     */
    public function process($In, array &$Arr, $Depth = 0, $Refs = false)
    {
        /** Type guard. */
        if (!is_string($In)) {
            return false;
        }

        /** Assign refs array for inline variables. */
        if ($Refs) {
            $this->Refs = &$Arr;
        }

        /** Things to do at the beginning of the process execution. */
        if ($Depth === 0) {
            $this->MultiLine = false;
            $this->MultiLineFolded = false;
            $this->LastIndent = '';
            $this->CapturedHeader = '';
            $Captured = [];

            /** Support various encodings. */
            if (class_exists('\Maikuolan\Common\Demojibakefier')) {
                $this->Demojibakefier = new \Maikuolan\Common\Demojibakefier();

                /**
                 * Attempt to determine input encoding.
                 * @link https://yaml.org/spec/1.2.2/#52-character-encodings
                 */
                if (preg_match('~^\0\0(?:\0|\xFE\xFF)~', $In)) {
                    $In = substr($In, 4);
                    $this->LastInputEncoding = 'UTF-32BE';
                } elseif (preg_match('~^(?:\xFF\xFE|.\0)\0\0~', $In)) {
                    $In = substr($In, 4);
                    $this->LastInputEncoding = 'UTF-32LE';
                } elseif (preg_match('~^(?:\xFE\xFF|\0)~', $In)) {
                    $In = substr($In, 2);
                    $this->LastInputEncoding = 'UTF-16BE';
                } elseif (preg_match('~^(?:\xFF\xFE|.\0)~', $In)) {
                    $In = substr($In, 2);
                    $this->LastInputEncoding = 'UTF-16LE';
                } else {
                    if (substr($In, 0, 3) === "\xEF\xBB\xBF") {
                        $In = substr($In, 3);
                    }
                    $this->LastInputEncoding = 'UTF-8';
                }

                /** Fail if non-compliant. */
                if (!$this->Demojibakefier->checkConformity($In, $this->LastInputEncoding)) {
                    return false;
                }

                /** Attempt to normalise encoding if not already UTF-8. */
                if ($this->LastInputEncoding !== 'UTF-8') {
                    /** Suppress errors to avoid potentially flooding logs. */
                    set_error_handler(function ($errno) {
                        return;
                    });

                    $Attempt = iconv($this->LastInputEncoding, 'UTF-8', $In);
                    if (
                        $Attempt === false ||
                        !$this->Demojibakefier->checkConformity($Attempt, 'UTF-8') ||
                        strcmp(iconv('UTF-8', $this->LastInputEncoding, $Attempt), $In) !== 0
                    ) {
                        return false;
                    }
                    $In = $Attempt;

                    /** We're done.. Restore the error handler. */
                    restore_error_handler();
                }
            }

            /** Attempt to capture header comments. */
            if (preg_match('~^(##\\\\(?:\n#[^\n]*)+\n##/\n\n|(?:#[^\n]*\n)+\n)~m', $In, $Captured)) {
                $this->CapturedHeader = $Captured[0];
            }
        }

        $In = str_replace("\r", '', $Depth === 0 ? trim($In) : $In);
        $Key = '';
        $Value = '';
        $SendTo = '';

        /** In case of processing JSON data, or YAML data contained entirely by flow collections. */
        foreach ([['[', ']'], ['{', '}']] as $Braces) {
            if (substr($In, 0, 1) === $Braces[0] && substr($In, -1) === $Braces[1]) {
                return $this->flowControl($In, $Arr, $Braces[0]);
            }
        }

        $TabLen = 0;
        $SoL = 0;

        /** Continues until there aren't any new lines to process remaining. */
        while ($SoL !== false) {
            /** @var int|false End position of the current line. */
            $EoL = strpos($In, "\n", $SoL);

            /** @var string The current line. */
            $ThisLine = ($EoL === false) ? substr($In, $SoL) : substr($In, $SoL, $EoL - $SoL);

            /** @var int|false Start position of the next line. */
            $SoL = ($EoL === false) ? false : $EoL + 1;

            /** Strip comments and whitespace. */
            if (!($ThisLine = preg_replace(['/(?<!\\\)#.*$/', '/\s+$/'], '', $ThisLine))) {
                /** Line preservation for multiline and folded blocks. .*/
                if (($this->MultiLine || $this->MultiLineFolded) && strlen($SendTo)) {
                    $SendTo .= "\n";
                }

                /** Skip ahead if line is empty. */
                continue;
            }

            $ThisTab = 0;

            /** Determine the indent of the current line. */
            while (($Chr = substr($ThisLine, $ThisTab, 1)) && ($Chr === ' ' || $Chr === "\t")) {
                $ThisTab++;
            }

            /** Used for reconstruction. */
            if ($this->LastIndent === '') {
                $this->LastIndent = str_repeat(substr($ThisLine, 0, 1), $ThisTab);
            }

            /**
             * Data indented further than the current depth can be gathered to
             * be processed recursively (e.g., sequences, multiline data, etc).
             */
            if ($ThisTab > $Depth) {
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
            }

            /**
             * Data indentation less than the current depth should be
             * impossible. It could suggest bad data, or an error, so we'll
             * exit here immediately.
             */
            if ($ThisTab < $Depth) {
                return false;
            }

            /** Process here any data gathered to be processed recursively. */
            if ($SendTo) {
                /** Guard. */
                if (!isset($Key) || ($Key !== 0 && $Key !== '' && empty($Key))) {
                    return false;
                }

                $Success = true;
                if (!$this->MultiLine && !$this->MultiLineFolded) {
                    if (!isset($Arr[$Key]) || !is_array($Arr[$Key])) {
                        $Arr[$Key] = [];
                    }
                    $Success = $this->process(preg_replace('~\n$~m', '', $SendTo), $Arr[$Key], $TabLen);
                } else {
                    $this->tryStringDataTraverseByRef($SendTo);
                    if ($this->Chomp === '-') {
                        $SendTo = preg_replace('~[\r\n]+$~m', '', $SendTo);
                    } elseif ($this->Chomp === '') {
                        $SendTo = preg_replace('~([\r\n])[\r\n]+$~m', '\1', $SendTo);
                    }
                    $Arr[$Key] = $SendTo;
                }
                $HasMerged = false;
                if (isset($ThisBlockTag) && $ThisBlockTag !== '') {
                    if ($ThisBlockTag === '!merge' && is_array($Arr[$Key])) {
                        $MergeData = $Arr[$Key];
                        unset($Arr[$Key]);
                        $Arr += $this->merge($MergeData);
                        $HasMerged = true;
                    } else {
                        $Arr[$Key] = $this->coerce($Arr[$Key], false, $ThisBlockTag);
                    }
                }
                if (!$HasMerged && $Key === '<<' && is_array($Arr[$Key])) {
                    $MergeData = $Arr[$Key];
                    unset($Arr[$Key]);
                    $Arr += $this->merge($MergeData);
                }
                if (!$Success) {
                    return false;
                }
                $SendTo = '';
            }

            /** Process the current line of the data at the current depth. */
            if (!$this->processLine($ThisLine, $ThisTab, $Key, $Value, $Arr)) {
                return false;
            }

            /** Needed for non-scalar coercion (sequences, merges, etc). */
            $ThisBlockTag = $this->LastResolvedTag;
        }

        $Success = true;

        /** Needed for processing any remaining data. */
        if ($SendTo && !empty($Key)) {
            if (!$this->MultiLine && !$this->MultiLineFolded) {
                if (!isset($Arr[$Key]) || !is_array($Arr[$Key])) {
                    $Arr[$Key] = [];
                }
                $Success = $this->process(preg_replace('~\n$~m', '', $SendTo), $Arr[$Key], $TabLen);
            } else {
                $this->tryStringDataTraverseByRef($SendTo);
                if ($this->Chomp === '-') {
                    $SendTo = preg_replace('~[\r\n]+$~m', '', $SendTo);
                } elseif ($this->Chomp === '') {
                    $SendTo = preg_replace('~([\r\n])[\r\n]+$~m', '\1', $SendTo);
                }
                $Arr[$Key] = $SendTo;
            }
            $HasMerged = false;
            if (isset($ThisBlockTag) && $ThisBlockTag !== '') {
                if ($ThisBlockTag === '!merge' && is_array($Arr[$Key])) {
                    $MergeData = $Arr[$Key];
                    unset($Arr[$Key]);
                    $Arr += $this->merge($MergeData);
                    $HasMerged = true;
                } else {
                    $Arr[$Key] = $this->coerce($Arr[$Key], false, $ThisBlockTag);
                }
            }
            if (!$HasMerged && $Key === '<<' && is_array($Arr[$Key])) {
                $MergeData = $Arr[$Key];
                unset($Arr[$Key]);
                $Arr += $this->merge($MergeData);
            }
        }

        /** Exit. */
        return $Success;
    }

    /**
     * Reconstruct YAML.
     *
     * @param array $Arr The array to reconstruct from.
     * @param bool $UseCaptured Whether to use captured values.
     * @param bool $DoWithAnchors Whether to try reconstructing anchors.
     * @return string The reconstructed YAML.
     */
    public function reconstruct(array $Arr, $UseCaptured = false, $DoWithAnchors = false)
    {
        $Out = '';
        $this->DoWithAnchors = (count($this->Anchors) && $DoWithAnchors);
        if ($UseCaptured) {
            if ($this->LastIndent !== '') {
                $this->Indent = $this->LastIndent;
            }
            if ($this->CapturedHeader !== '') {
                $Out .= $this->CapturedHeader;
            }
        }
        $this->processInner($Arr, $Out);
        $this->AnchorsDone = [];
        $this->DoWithAnchors = false;
        return $Out;
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
    public function tryStringDataTraverseByRef(&$Data)
    {
        if (
            empty($this->Refs) ||
            !is_string($Data) ||
            !preg_match_all('~\{\{ ?([^\r\n{}]+) ?\}\}~', $Data, $VarMatches) ||
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

    /**
     * Normalises the values defined by the processLine method.
     *
     * @param string $Value The value to be normalised.
     * @param bool $EnforceScalar Whether to enforce using scalar data.
     * @return void
     */
    private function normaliseValue(&$Value, $EnforceScalar = false)
    {
        /** Avoid mistyping due to excess whitespace. */
        $Value = trim($Value);

        /** Resolve tags. */
        if (preg_match('~^!([!\dA-Za-z_:,-]+)(?: (.*))?$~', $Value, $Resolved)) {
            $Tag = strtolower($Resolved[1]);
            if (!$EnforceScalar) {
                $this->LastResolvedTag = $Tag;
            }
            $Value = isset($Resolved[2]) ? $Resolved[2] : '';
            if ($Value === '|' || $Value === '') {
                return;
            }
        } else {
            $Tag = '';
        }

        /** Not executed for keys. */
        if (!$EnforceScalar) {
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

            /** In case of processing JSON data or flow collections. */
            foreach ([['[', ']'], ['{', '}']] as $Braces) {
                if (substr($Value, 0, 1) === $Braces[0] && substr($Value, -1) === $Braces[1]) {
                    $NewArr = [];
                    $this->flowControl($Value, $NewArr, $Braces[0]);
                    $Value = $NewArr;
                    if ($Tag !== '') {
                        $Value = $this->coerce($Value, $EnforceScalar, $Tag);
                    }
                    return;
                }
            }
        }

        $ValueLen = strlen($Value);

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
                $Value = $this->unescape($Value, $Wrapper[0]);
                if ($Tag !== '') {
                    $Value = $this->coerce($Value, $EnforceScalar, $Tag);
                }
                return;
            }
        }

        /** Executed only for keys. */
        if ($EnforceScalar) {
            $Value = trim($Value);
            if ($Tag !== '') {
                $Value = $this->coerce($Value, $EnforceScalar, $Tag);
            } elseif (preg_match('~^\d+$~', $Value)) {
                $Value = (int)$Value;
            }
            return;
        }

        if ($Tag !== '') {
            $Value = $this->coerce($Value, $EnforceScalar, $Tag);
            return;
        }

        $ValueLow = strtolower($Value);
        if ($ValueLow === 'true' || $ValueLow === 'on' || $ValueLow === 'y' || $ValueLow === 'yes' || $Value === '+') {
            $Value = true;
        } elseif ($ValueLow === 'false' || $ValueLow === 'n' || $ValueLow === 'no' || $ValueLow === 'off' || $Value === '-' || $ValueLen === 0) {
            $Value = false;
        } elseif ($ValueLow === 'null' || $Value === '~') {
            $Value = null;
        } elseif ($ValueLow === '.inf') {
            $Value = INF;
        } elseif ($ValueLow === '-.inf') {
            $Value = -INF;
        } elseif ($ValueLow === '.nan') {
            $Value = NAN;
        } elseif (preg_match('~^0x[\dA-Fa-f]+$~', $Value)) {
            $Value = hexdec(str_replace('_', '', substr($Value, 2)));
        } elseif (preg_match('~^0o[0-8]+$~', $Value)) {
            $Value = octdec(str_replace('_', '', substr($Value, 2)));
        } elseif (preg_match('~^0b[01]+$~', $Value)) {
            $Value = bindec(str_replace('_', '', substr($Value, 2)));
        } elseif (preg_match('~^\d+$~', $Value)) {
            $Value = (int)str_replace('_', '', $Value);
        } elseif (preg_match('~^(?:\d+\.\d+|\d+(?:\.\d+)?[Ee][-+]\d+)$~', $Value)) {
            $Value = (float)str_replace('_', '', $Value);
        }
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
        /** Reset last resolved tag. */
        $this->LastResolvedTag = '';

        if ($ThisLine === '---') {
            $Key = '---';
            $Value = null;
            $Arr[$Key] = $Value;
        } elseif ($ThisLine === '...') {
            $Key = '...';
            $Value = null;
            $Arr[$Key] = $Value;
        } elseif (substr($ThisLine, -1) === ':' && strpos($ThisLine, ': ') === false) {
            $Key = substr($ThisLine, $ThisTab, -1);
            $this->normaliseValue($Key, true);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = null;
            }
            $Value = null;
        } elseif (substr($ThisLine, $ThisTab, 2) === '? ') {
            $Key = substr($ThisLine, $ThisTab + 2);
            $this->normaliseValue($Key, true);
            $Value = null;
            $Arr[$Key] = null;
        } elseif (substr($ThisLine, $ThisTab, 2) === '- ') {
            $Value = substr($ThisLine, $ThisTab + 2);
            $ValueLen = strlen($Value);
            $this->normaliseValue($Value);
            if ($ValueLen > 0) {
                if ($this->LastResolvedTag === '!merge' && is_array($Value)) {
                    $Arr += $this->merge($Value);
                } else {
                    $Arr[] = $Value;
                }
            }
            $Key = $this->arrayKeyLast($Arr);
        } elseif (substr($ThisLine, $ThisTab) === '-') {
            $Value = null;
            $Arr[] = $Value;
            $Key = $this->arrayKeyLast($Arr);
        } elseif (($DelPos = strpos($ThisLine, ': ')) !== false) {
            $Key = substr($ThisLine, $ThisTab, $DelPos - $ThisTab);
            $KeyLen = strlen($Key);
            $this->normaliseValue($Key, true);
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
                if (($this->LastResolvedTag === '!merge' || $Key === '<<') && is_array($Value)) {
                    $Arr += $this->merge($Value);
                } else {
                    $Arr[$Key] = $Value;
                }
            }
        } elseif (strpos($ThisLine, ':') === false && strlen($ThisLine) > 1) {
            $Key = $ThisLine;
            $this->normaliseValue($Key, true);
            if (!isset($Arr[$Key])) {
                $Arr[$Key] = null;
            }
            $Value = null;
        }

        /**
         * Chomping.
         * @link https://yaml.org/spec/1.2.2/#8112-block-chomping-indicator
         */
        if (is_string($Value) && strlen($Value) === 2) {
            $Chomp = substr($Value, -1);
            if ($Chomp === '-') {
                $this->Chomp = '-';
                $Value = substr($Value, 0, 1);
            } elseif ($Chomp === '+') {
                $this->Chomp = '+';
                $Value = substr($Value, 0, 1);
            } else {
                $this->Chomp = '';
            }
        } else {
            $this->Chomp = '';
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
        $NullSet = $this->isNullSet($Arr);
        if ($Depth >= $this->FlowRebuildDepth) {
            $Out .= $Sequential ? '[' : '{';
            $First = true;
            foreach ($Arr as $Key => $Value) {
                if ($First) {
                    $First = false;
                } else {
                    $Out .= ',';
                }
                if (!$Sequential) {
                    $Out .= ($this->QuoteKeys ? $this->scalarToString($Key) : $Key) . ':';
                }
                if (is_array($Value)) {
                    $this->processInner($Value, $Out, $Depth + 1);
                    continue;
                }
                $ToAdd = $this->scalarToString($Value);
                if ($this->DoWithAnchors) {
                    foreach ($this->Anchors as $Name => $Data) {
                        if ($Data === $ToAdd) {
                            if (empty($this->AnchorsDone[$Name])) {
                                $ToAdd = '&' . $Name . ' ' . $ToAdd;
                                $this->AnchorsDone[$Name] = true;
                            } else {
                                $ToAdd = '*' . $Name;
                            }
                            break;
                        }
                    }
                }
                $Out .= $ToAdd;
            }
            $Out .= $Sequential ? ']' : '}';
            if ($Depth === $this->FlowRebuildDepth) {
                $Out .= "\n";
            }
            return;
        }
        foreach ($Arr as $Key => $Value) {
            if ($Key === '---' && $Value === null) {
                $Out .= "---\n";
                continue;
            }
            if ($Key === '...' && $Value === null) {
                $Out .= "...\n";
                continue;
            }
            $ThisDepth = str_repeat($this->Indent, $Depth);
            if ($NullSet && !$Sequential) {
                $Out .= $ThisDepth . '?';
                $Value = $Key;
            } else {
                $Out .= $ThisDepth . ($Sequential ? '-' : ($this->QuoteKeys ? $this->scalarToString($Key) : $Key) . ':');
            }
            if (is_array($Value)) {
                if ($Depth < $this->FlowRebuildDepth - 1) {
                    $Out .= "\n";
                }
                $this->processInner($Value, $Out, $Depth + 1);
                continue;
            }
            $Out .= ' ';
            if (is_string($Value)) {
                $HasHash = strpos($Value, '#') !== false;
                if (!$HasHash && strpos($Value, "\n") !== false) {
                    if (preg_match('~\n{2,}$~m', $Value)) {
                        $ToAdd = "|+\n" . $ThisDepth . $this->Indent;
                    } else {
                        $ToAdd = "|\n" . $ThisDepth . $this->Indent;
                    }
                    $ToAdd .= preg_replace('~\n(?=[^\n])~m', "\n" . $ThisDepth . $this->Indent, $Value);
                } elseif (!$HasHash && $this->FoldedAt > 0 && strpos($Value, ' ') !== false && strlen($Value) >= $this->FoldedAt) {
                    $ToAdd = ">\n" . $ThisDepth . $this->Indent . wordwrap(
                        $Value,
                        $this->FoldedAt,
                        "\n" . $ThisDepth . $this->Indent
                    );
                } else {
                    $ToAdd = $this->Quotes . $this->escape($Value) . $this->Quotes;
                }
            } else {
                $ToAdd = $this->scalarToString($Value);
            }
            if ($this->DoWithAnchors) {
                foreach ($this->Anchors as $Name => $Data) {
                    if ($Data === $ToAdd) {
                        if (empty($this->AnchorsDone[$Name])) {
                            $ToAdd = '&' . $Name . ' ' . $ToAdd;
                            $this->AnchorsDone[$Name] = true;
                        } else {
                            $ToAdd = '*' . $Name;
                        }
                        break;
                    }
                }
            }
            $Out .= $ToAdd . "\n";
        }
    }

    /**
     * Escape according to the YAML specification.
     *
     * @param string $Value The string to escape.
     * @param bool $Newlines Whether to escape newlines.
     * @return string The escaped string.
     */
    private function escape($Value = '', $Newlines = true)
    {
        if ($this->Quotes === "'") {
            return str_replace("'", "''", $Value);
        }
        if ($this->Quotes !== '"') {
            return $Value;
        }
        $Value = str_replace("\\", "\\\\", $Value);
        if ($Newlines) {
            $Value = str_replace("\n", '\n', $Value);
        }
        $Value = str_replace(
            ['#', "\0", "\7", "\8", "\t", "\x0B", "\x0C", "\x0D", "\x1B", "\xC2\x85", "\xC2\xA0", "\xE2\x80\xA8", "\xE2\x80\xA9"],
            ['\#', '\0', '\a', '\b', '\t', '\v', '\f', '\r', '\e', '\N', '\_', '\L', '\P'],
            $Value
        );
        $Value = preg_replace_callback([
            '~[\x01-\x06\x0E\x0F\x10-\x1A\x1C-\x1F\x7F\xC0\xC1\xF5-\xFF]~',
            '~[\xC2-\xDF](?![\x80-\xBF])~',
            '~\xE0(?![\xA0-\xBF][\x80-\xBF])~',
            '~[\xE1-\xEC](?![\x80-\xBF]{2})~',
            '~\xED(?![\x80-\x9F][\x80-\xBF])~',
            '~\xF0(?![\x90-\xBF][\x80-\xBF]{2})~',
            '~[\xF1-\xF3](?![\x80-\xBF]{3})~',
            '~\xF4(?![\x80-\x8F][\x80-\xBF]{2})~',
            '~(?<=[\x00-\x7F\xF5-\xFF])[\x80-\xBF]~',
            '~(?<=[\xE0-\xEF])[\x80-\xBF](?![\x80-\xBF])~',
            '~(?<=[\xF0-\xF4])[\x80-\xBF](?![\x80-\xBF]{2})~',
            '~(?<=[\xF0-\xF4][\x80-\xBF])[\x80-\xBF](?![\x80-\xBF])~'
        ], function ($Match) {
            return '\\x' . bin2hex($Match[0]);
        }, $Value);
        if ($this->EscapeBySpec) {
            $Value = str_replace(['"', '/'], ['\"', '\/'], $Value);
        }
        return $Value;
    }

    /**
     * Unescape according to the YAML specification.
     *
     * @param string $Value The string to unescape.
     * @param string $Style The quote style used.
     * @return string The unescaped string.
     */
    private function unescape($Value = '', $Style = '"')
    {
        if ($Style === '"' || $Style === "\xe2\x80\x9c" || $Style === "\x91") {
            $Value = str_replace(
                ['\#', '\0', '\a', '\b', '\t', '\n', '\v', '\f', '\r', '\e', '\"', '\/', '\N', '\_', '\L', '\P', "\\\\"],
                ['#', "\0", "\x07", "\x08", "\t", "\n", "\x0B", "\x0C", "\x0D", "\x1B", '"', '/', "\xC2\x85", "\xC2\xA0", "\xE2\x80\xA8", "\xE2\x80\xA9", "\\"],
                $Value
            );
            $Captured = [];
            if (preg_match_all('~\\\\x([\dA-Fa-f]{2})~', $Value, $Captured)) {
                $Captured = array_unique($Captured[1]);
                foreach ($Captured as $Bytes) {
                    $Value = str_replace('\\x' . $Bytes, hex2bin($Bytes), $Value);
                }
            }
            $Captured = [];
            if (preg_match_all('~\\\\u([\dA-Fa-f]{4})~', $Value, $Captured)) {
                set_error_handler(function ($errno) {
                    return;
                });
                $Captured = array_unique($Captured[1]);
                foreach ($Captured as $Bytes) {
                    $Decoded = hex2bin($Bytes);
                    $Attempt = iconv('UTF-16BE', 'UTF-8', $Decoded);
                    $Reversed = $Attempt === false ? '' : iconv('UTF-8', 'UTF-16BE', $Attempt);
                    if ($Attempt !== false && strcmp($Reversed, $Decoded) === 0) {
                        $Decoded = $Attempt;
                    }
                    $Value = str_replace('\\u' . $Bytes, $Decoded, $Value);
                }
                restore_error_handler();
            }
            $Captured = [];
            if (preg_match_all('~\\\\U([\dA-Fa-f]{8})~', $Value, $Captured)) {
                set_error_handler(function ($errno) {
                    return;
                });
                $Captured = array_unique($Captured[1]);
                foreach ($Captured as $Bytes) {
                    $Decoded = hex2bin($Bytes);
                    $Attempt = iconv('UTF-32BE', 'UTF-8', $Decoded);
                    $Reversed = $Attempt === false ? '' : iconv('UTF-8', 'UTF-32BE', $Attempt);
                    if ($Attempt !== false && strcmp($Reversed, $Decoded) === 0) {
                        $Decoded = $Attempt;
                    }
                    $Value = str_replace('\\U' . $Bytes, $Decoded, $Value);
                }
                restore_error_handler();
            }
            return $Value;
        }
        if ($Style === "'" || $Style === "\xe2\x80\x98" || $Style === "\x93") {
            return str_replace("''", "'", $Value);
        }
        return $Value;
    }

    /**
     * Check whether an array is a null set.
     *
     * @param array $Arr The array.
     * @return bool True for null set; False otherwise.
     */
    private function isNullSet(array $Arr)
    {
        foreach ($Arr as $Value) {
            if ($Value !== null) {
                return false;
            }
        }
        return true;
    }

    /**
     * Coerces a value according to the specified tag.
     *
     * @param mixed $Value The value to be coerced.
     * @param bool $EnforceScalar Whether to enforce using scalar data.
     * @param string $Tag The resolved tag.
     * @return mixed The coerced value.
     */
    private function coerce($Value, $EnforceScalar, $Tag)
    {
        /**
         * @link https://yaml.org/type/null.html
         */
        if ($Tag === '!null') {
            return null;
        }

        /** Not executed for keys. */
        if (!$EnforceScalar) {
            /**
             * A "map" in YAML <-> An "associative array" in PHP.
             * Because PHP arrays always have an "order" (i.e., a key index), I
             * see no effective difference between !!map and !!omap in the
             * context of a YAML handler written for PHP.
             * @link https://yaml.org/type/map.html
             * @link https://yaml.org/type/omap.html
             */
            if ($Tag === '!map' || $Tag === '!omap') {
                if (!is_array($Value)) {
                    if (is_string($Value)) {
                        $this->normaliseValue($Value);
                    }
                    return [$Value];
                }
                $Arr = [];
                foreach ($Value as $ThisKey => $ThisValue) {
                    if (is_string($ThisKey)) {
                        $this->normaliseValue($ThisKey, true);
                    }
                    if (is_string($ThisValue)) {
                        $this->normaliseValue($ThisValue);
                    }
                    $Arr[$ThisKey] = $ThisValue;
                }
                return $Arr;
            }

            /**
             * A "sequence" in YAML <-> A "numeric array" in PHP.
             * @link https://yaml.org/type/seq.html
             */
            if ($Tag === '!seq') {
                if (!is_array($Value)) {
                    if (is_string($Value)) {
                        $this->normaliseValue($Value);
                    }
                    return [$Value];
                }
                $Arr = [];
                foreach ($Value as $ThisValue) {
                    if (is_string($ThisValue)) {
                        $this->normaliseValue($ThisValue);
                    }
                    $Arr[] = $ThisValue;
                }
                return $Arr;
            }

            /**
             * A "set" in YAML <-> Equivalent to an array with all null values.
             * @link https://yaml.org/type/set.html
             */
            if ($Tag === '!set') {
                if (!is_array($Value)) {
                    return [$Value => null];
                }
                $Arr = [];
                foreach ($Value as $ThisValue) {
                    if (!is_scalar($ThisValue)) {
                        continue;
                    }
                    $Arr[$ThisValue] = null;
                }
                return $Arr;
            }

            /** For extending with other non-scalar coercion. */
            if (method_exists($this, $Tag . 'TagNonScalar')) {
                return $this->{$Tag . 'TagNonScalar'}($Value);
            }
        }

        if (is_string($Value)) {
            $ValueLen = strlen($Value);
            $ValueLow = strtolower($Value);
        } else {
            if (is_array($Value)) {
                $ValueLen = count($Value);
            } else {
                $ValueLen = empty($Value) ? 0 : 1;
            }
            $ValueLow = '';
        }

        /**
         * @link https://yaml.org/type/bool.html
         */
        if ($Tag === '!bool') {
            if (is_bool($Value)) {
                return $Value;
            }
            if (!is_scalar($Value)) {
                return $ValueLen > 0;
            }
            if ($ValueLow === 'false' || $ValueLow === 'n' || $ValueLow === 'no' || $ValueLow === 'off' || $Value === '-' || $ValueLen === 0 || $ValueLow === 'null' || $Value === '~') {
                return false;
            }
            return (bool)$Value;
        }

        /**
         * @link https://yaml.org/type/float.html
         */
        if ($Tag === '!float') {
            if (is_float($Value)) {
                return $Value;
            }
            if (!is_scalar($Value)) {
                return (float)$ValueLen;
            }
            if ($ValueLow === 'true' || $ValueLow === 'on' || $ValueLow === 'y' || $ValueLow === 'yes' || $Value === '+') {
                return 1.0;
            }
            return (float)str_replace('_', '', $Value);
        }

        /**
         * @link https://yaml.org/type/int.html
         */
        if ($Tag === '!int') {
            if (is_int($Value)) {
                return $Value;
            }
            if (!is_scalar($Value)) {
                return $ValueLen;
            }
            if ($ValueLow === 'true' || $ValueLow === 'on' || $ValueLow === 'y' || $ValueLow === 'yes' || $Value === '+') {
                return 1;
            }
            return (int)str_replace('_', '', $Value);
        }

        /**
         * @link https://yaml.org/type/str.html
         */
        if ($Tag === '!str') {
            if ($Value === null) {
                return 'null';
            }
            if ($Value === true) {
                return 'true';
            }
            if ($Value === false) {
                return 'false';
            }
            if (is_string($Value)) {
                return $Value;
            }
            return is_scalar($Value) ? (string)$Value : '';
        }

        /**
         * @link https://yaml.org/type/binary.html
         */
        if ($Tag === '!binary') {
            if ($Value === '' || !is_string($Value)) {
                return '';
            }
            return base64_decode(preg_replace('~\s~', '', $Value));
        }

        /** For extending with other scalar coercion. */
        if (method_exists($this, $Tag . 'Tag')) {
            return $this->{$Tag . 'Tag'}($Value);
        }

        /** Tags intended for working with strings only. */
        if (is_string($Value)) {
            /** Hash functions. */
            if (substr($Tag, 0, 5) === 'hash:') {
                $Algo = substr($Tag, 5);
                if (in_array($Algo, hash_algos(), true)) {
                    return hash($Algo, $Value);
                }
            }

            /** Permitted PHP string functions. */
            if (preg_match($this->AllowedStringTagsPattern, $Tag) && function_exists($Tag)) {
                /** Needed to ensure that older PHP versions are consistent with PHP 8.1's behaviour. */
                if (preg_match('~^(?:html(?:_entity_decode|entities|specialchars(?:_decode)?))$~', $Tag)) {
                    return $Tag($Value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
                }

                /** Default function invocation. */
                return $Tag($Value);
            }
        }

        /** Permitted numeric PHP functions. */
        if (is_numeric($Value) && preg_match($this->AllowedNumericTagsPattern, $Tag) && function_exists($Tag)) {
            return $Tag($Value);
        }

        /** The specified tag isn't supported. Return the value verbatim. */
        return $Value;
    }

    /**
     * Prepares an array to be merged according to spec.
     * @link https://yaml.org/type/merge.html
     *
     * @param array $Arr The array to be merged.
     * @return array The prepared array.
     */
    private function merge(array $Arr)
    {
        /** Reset last resolved tag. */
        $this->LastResolvedTag = '';

        $NewArr = [];
        foreach ($Arr as $Key => $Value) {
            if (is_int($Key)) {
                if (is_array($Value)) {
                    $NewArr += $this->merge($Value);
                }
                continue;
            }
            $NewArr[$Key] = $Value;
        }
        return $NewArr;
    }

    /**
     * Attempts to process flow collections and JSON data.
     * @link https://yaml.org/spec/1.2.2/#74-flow-collection-styles
     *
     * @param string $In The raw data to be processed.
     * @param array $Arr Where to process that data.
     * @param string $Brace The type of bracing used (determines whether the
     *      data should be processed as a flow sequence or as flow mappings).
     * @return bool True for process success. False for process failure.
     */
    private function flowControl($In, array &$Arr, $Brace)
    {
        /** Reset the array where we're processing the data. */
        $Arr = [];

        /** Flow sequence. */
        if ($Brace === '[') {
            $Split = explode(',', substr($In, 1, -1));
            $Segment = '';
            $SequenceDepth = 0;
            $MappingDepth = 0;

            /**
             * Iterate through each split. Merge segments together if recursive
             * sequences or mappings are detected.
             */
            foreach ($Split as $Try) {
                $Trimmed = trim($Try);
                $Start = substr($Trimmed, 0, 1);
                $End = substr($Trimmed, -1);
                $Segment = ($SequenceDepth < 1 && $MappingDepth < 1) ? $Try : $Segment . ',' . $Try;
                $this->flowControlDepth($Start, $End, $SequenceDepth, $MappingDepth);
                if ($SequenceDepth < 1 && $MappingDepth < 1) {
                    $Arr[] = $Segment;
                }
            }

            /** Fail if braces aren't balanced. */
            if ($SequenceDepth > 0 || $MappingDepth > 0) {
                return false;
            }

            foreach ($Arr as &$Working) {
                $this->normaliseValue($Working);
            }
            return true;
        }

        /** Flow mappings. */
        if ($Brace === '{') {
            $Split = explode(',', substr($In, 1, -1));
            $Segment = '';
            $SequenceDepth = 0;
            $MappingDepth = 0;

            /**
             * Iterate through each split. Merge segments together if recursive
             * sequences or mappings are detected.
             */
            foreach ($Split as $Try) {
                if ($SequenceDepth < 1 && $MappingDepth < 1) {
                    if (($CPos = strpos($Try, ':')) === false) {
                        if (strlen($Key) && isset($Arr[$Key])) {
                            $Trimmed = trim($Arr[$Key]);
                            $First = substr($Trimmed, 0, 1);
                            $Last = substr($Trimmed, -1);

                            /** Might belong to the previous entry, in case the value contains commas. */
                            if (($First === '"' && $Last !== '"') || ($First === "'" && $Last !== "'")) {
                                $Arr[$Key] .= ',' . $Try;
                                continue;
                            }
                        }

                        /** Fail immediately if the mapping entry isn't valid. */
                        return false;
                    }

                    $Key = trim(substr($Try, 0, $CPos));

                    /** Fail immediately if the key is empty. */
                    if (strlen($Key) < 1) {
                        return false;
                    }

                    $Value = substr($Try, $CPos + 1);
                } else {
                    $Value = $Try;
                }
                $Trimmed = trim($Value);
                $Start = substr($Trimmed, 0, 1);
                $End = substr($Trimmed, -1);
                $Segment = ($SequenceDepth < 1 && $MappingDepth < 1) ? $Value : $Segment . ',' . $Try;
                $this->flowControlDepth($Start, $End, $SequenceDepth, $MappingDepth);
                if ($SequenceDepth < 1 && $MappingDepth < 1) {
                    $Arr[$Key] = $Segment;
                }
            }

            /** Fail if braces aren't balanced. */
            if ($SequenceDepth > 0 || $MappingDepth > 0) {
                return false;
            }

            $NewArr = [];
            foreach ($Arr as $Key => $Value) {
                $this->normaliseValue($Key, true);
                $this->normaliseValue($Value);
                $NewArr[$Key] = $Value;
            }
            $Arr = $NewArr;
            return true;
        }

        /** Unknown brace type used. Report failure. */
        return false;
    }

    /**
     * Determine recursion depth within flow control operation.
     *
     * @param string $Start The start character.
     * @param string $End The end character.
     * @param int $SequenceDepth Current depth for flow sequences.
     * @param int $MappingDepth Current depth for flow mappings.
     * @return void
     */
    private function flowControlDepth($Start, $End, &$SequenceDepth, &$MappingDepth)
    {
        if ($SequenceDepth > 0) {
            if ($Start === '[') {
                $SequenceDepth++;
            }
            if ($End === ']') {
                $SequenceDepth--;
            }
        } elseif ($MappingDepth > 0) {
            if ($Start === '{') {
                $MappingDepth++;
            }
            if ($End === '}') {
                $MappingDepth--;
            }
        } elseif ($SequenceDepth < 1 && $MappingDepth < 1) {
            if ($Start === '[') {
                $SequenceDepth++;
                if ($End === ']') {
                    $SequenceDepth--;
                }
            } elseif ($Start === '{') {
                $MappingDepth++;
                if ($End === '}') {
                    $MappingDepth--;
                }
            }
        }
    }

    /**
     * Polyfill for array_key_last (we can ditch this at the next major
     * version, when/if we increase the minimum required PHP version).
     *
     * @param array $Arr The array.
     * @return mixed The last key of the array.
     */
    private function arrayKeyLast(array &$Arr)
    {
        if (function_exists('array_key_last')) {
            return array_key_last($Arr);
        }
        end($Arr);
        $Key = key($Arr);
        reset($Arr);
        return $Key;
    }

    /**
     * Flattens an array.
     *
     * @param mixed $In The array.
     * @return mixed The flatten array (if it's an array).
     */
    private function flattenTagNonScalar($In)
    {
        /** Return the input verbatim if it isn't an array. */
        if (!is_array($In)) {
            return $In;
        }

        $NewArr = [];
        foreach ($In as $Key => $Value) {
            if (is_array($Value)) {
                $NewArr = array_merge($NewArr, $this->flattenTagNonScalar($Value));
                continue;
            }
            $NewArr[$Key] = $Value;
        }
        return $NewArr;
    }

    /**
     * Convert various scalars to strings.
     *
     * @param mixed $In The scalar.
     * @return string The string.
     */
    private function scalarToString($In)
    {
        if ($In === true) {
            return 'true';
        }
        if ($In === false) {
            return 'false';
        }
        if ($In === null) {
            return 'null';
        }
        if ($In === INF) {
            return '.inf';
        }
        if ($In === -INF) {
            return '-.inf';
        }
        if (is_float($In) && is_nan($In)) {
            return '.nan';
        }
        if (is_string($In)) {
            return $this->Quotes . $this->escape($In) . $this->Quotes;
        }
        if (is_object($In)) {
            if (method_exists($In, '__toString')) {
                return $this->Quotes . $this->escape((string)$In) . $this->Quotes;
            }
            throw new \Error('Non-stringable object detected while attempting to reconstruct YAML data');
        }
        return $In;
    }
}
