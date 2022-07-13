<?php
/**
 * Matrix handler (last modified: 2022.07.13).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis.
 * *This particular class*, COPYRIGHT 2020 and beyond by Caleb Mazalevskis.
 */

namespace Maikuolan\Common;

class Matrix
{
    /**
     * @var array The actual matrix data.
     */
    public $Matrix = [];

    /**
     * @var int The number of dimensions possessed by the matrix.
     */
    public $Dimensions = 1;

    /**
     * @var array|int The magnitude possessed by each vector.
     */
    public $Magnitude = 1;

    /**
     * @var mixed The default data to be used to populate each coordinate.
     */
    public $Data = [];

    /**
     * @var string The tag/release the version of this file belongs to (might
     *      be needed by some implementations to ensure compatibility).
     * @link https://github.com/Maikuolan/Common/tags
     */
    public const VERSION = '2.9.1';

    /**
     * Create the matrix.
     *
     * @param int $Dimensions The dimensions of the matrix.
     * @param array|int $Magnitude The magnitude of each direction. Int if all
     *      the same, or an array to specify for each dimension.
     * @param mixed $Data The data that each coordinate should contain.
     * @return void
     */
    public function createMatrix(int $Dimensions, $Magnitude, $Data): void
    {
        $this->Dimensions = $Dimensions;
        $this->Magnitude = $Magnitude;
        $this->Data = $Data;
        $this->populateVector($this->Matrix, 0);
    }

    /**
     * Iterate a callback function over the specified coordinates.
     *
     * @param string|int $Description The coordinates to iterate over.
     * @param callable $Callback The callback function to iterate.
     * @param array $Data Other data optionally passed to the callback.
     * @return mixed The return value from the callback function (defaults to
     *      just returning the coordinate value verbatim).
     */
    public function iterateCallback($Description, ?callable $Callback = null, ...$Data)
    {
        /** Guard. */
        if (!is_string($Description) && !is_int($Description)) {
            return;
        }

        /** Set default callback for when omitted (just returning the value verbatim). */
        if (!is_callable($Callback)) {
            $Callback = function ($Value) {
                return $Value;
            };
        }

        /** Results from the callback function (if provided by the callback). */
        $Out = [];

        $Description = explode(',', $Description);
        $Dimension = 0;
        $Indexes = [];

        /** Build ranges. */
        foreach ($Description as $Descriptor) {
            $Range = explode('-', $Descriptor);
            if (count($Range) === 2 && is_numeric($Range[0]) && is_numeric($Range[1]) && $Range[0] <= $Range[1]) {
                $First = $Range[0];
                $Last = $Range[1];
            } elseif (count($Range) === 1) {
                $First = $Range[0];
                $Last = $Range[0];
            } else {
                $First = 0;
                if (is_int($this->Magnitude)) {
                    $Last = $this->Magnitude - 1;
                } elseif (is_array($this->Magnitude) && isset($this->Magnitude[$Dimension]) && is_int($this->Magnitude[$Dimension])) {
                    $Last = $this->Magnitude[$Dimension] - 1;
                } else {
                    $Last = -1;
                }
            }
            $Indexes[] = ['First' => (int)$First, 'Last' => (int)$Last];
            $Dimension++;
        }

        /** Exception: Number of indexes doesn't match number of dimensions. */
        if (($IndexCount = count($Indexes)) !== $this->Dimensions) {
            throw new \Exception(sprintf('iterateCallback() expects %d dimensions, but %d were given', $this->Dimensions, $IndexCount));
            return;
        }

        /** Perform iteration. */
        foreach ($this->iterateCallbackGenerator($Indexes, $Callback, $Data) as $Key => $Value) {
            if ($Value === null) {
                continue;
            }
            $Set = &$Out;
            while (($DPos = strpos($Key, ',')) !== false) {
                $KeyPart = substr($Key, 0, $DPos);
                $Key = substr($Key, $DPos + 1);
                if (!isset($Set[$KeyPart])) {
                    $Set[$KeyPart] = [];
                }
                $Set = &$Set[$KeyPart];
            }
            $Set[$Key] = $Value;
        }

        /** Exit. */
        return $Out;
    }

    /**
     * Populate each vector and recurse forward for each dimension.
     *
     * @param array $Vector The vector we're working on.
     * @param int $Dimension The dimension we're working on.
     * @return void
     */
    private function populateVector(array &$Vector, int $Dimension): void
    {
        /** Fill the coordinate with the specified data and exit. */
        if ($Dimension >= $this->Dimensions) {
            $Vector = $this->Data;
            return;
        }

        /** Determine magnitude for this vector. */
        if (is_int($this->Magnitude)) {
            $ThisMagnitude = $this->Magnitude;
        } elseif (is_array($this->Magnitude) && isset($this->Magnitude[$Dimension]) && is_int($this->Magnitude[$Dimension])) {
            $ThisMagnitude = $this->Magnitude[$Dimension];
        } else {
            $ThisMagnitude = 0;
        }

        /** Populate vector. */
        for ($Current = 0; $Current < $ThisMagnitude; $Current++) {
            $Vector[$Current] = [];
            $this->populateVector($Vector[$Current], $Dimension + 1);
        }
    }

    /**
     * Wrapper for the internal generator for iterateCallback.
     *
     * @param array $Indexes The coordinates to iterate over.
     * @param callable $Callback The callback function to iterate.
     * @param array $Data Other data optionally passed to the callback.
     * @return \Generator
     */
    private function iterateCallbackGenerator(array $Indexes, callable $Callback, array $Data): \Generator
    {
        $Matrix = &$this->Matrix;
        yield from $this->iterateCallbackGeneratorInner($Matrix, $Indexes, 0, '', $Callback, $Data);
    }

    /**
     * Internal generator for iterateCallback.
     *
     * @param array $Matrix The matrix or vector we're currently working from.
     * @param array $Indexes The coordinates to iterate over.
     * @param string $KeyRoot Need to supply the correct key for return values.
     * @param callable $Callback The callback function to iterate.
     * @param array $Data Other data optionally passed to the callback.
     * @return \Generator
     */
    private function iterateCallbackGeneratorInner(array &$Matrix, array &$Indexes, int $Depth, string $KeyRoot, callable $Callback, array $Data): \Generator
    {
        /** Get current indexes. */
        $Index = $Indexes[$Depth];

        /** Mark current depth. */
        $Depth++;

        /** Iterate through ranges. */
        for ($Index['Current'] = $Index['First']; $Index['Current'] <= $Index['Last']; $Index['Current']++) {
            /** Guard. */
            if (!isset($Matrix[$Index['Current']])) {
                continue;
            }

            /** Get current coordinate. */
            $Current = &$Matrix[$Index['Current']];

            /** Determine the current coordinate's key. */
            $Key = $KeyRoot . (strlen($KeyRoot) ? ',' : '') . $Index['Current'];

            if (is_numeric($Index['Current'])) {
                /** Get previous coordinate. */
                if (isset($Matrix[$Index['Current'] - 1])) {
                    $Previous = &$Matrix[$Index['Current'] - 1];
                    $KeyPrevious = $KeyRoot . (strlen($KeyRoot) ? ',' : '') . ($Index['Current'] - 1);
                } else {
                    unset($Previous);
                    $Previous = null;
                    $KeyPrevious = null;
                }

                /** Get next coordinate. */
                if (isset($Matrix[$Index['Current'] + 1])) {
                    $Next = &$Matrix[$Index['Current'] + 1];
                    $KeyNext = $KeyRoot . (strlen($KeyRoot) ? ',' : '') . ($Index['Current'] + 1);
                } else {
                    unset($Next);
                    $Next = null;
                    $KeyNext = null;
                }
            } else {
                unset($Previous, $Next);
                $Previous = null;
                $KeyPrevious = null;
                $Next = null;
                $KeyNext = null;
            }

            /** Execute callback function. */
            if ($Depth >= $this->Dimensions) {
                yield $Key => $Callback($Current, $Key, $Previous, $KeyPrevious, $Next, $KeyNext, $Index['Current'], $Data);
                continue;
            }

            /** Recursively push new inner generators to go deeper. */
            yield from $this->iterateCallbackGeneratorInner($Current, $Indexes, $Depth, $Key, $Callback, $Data);
        }
    }
}
