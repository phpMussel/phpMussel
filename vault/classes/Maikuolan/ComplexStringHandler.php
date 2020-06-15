<?php
/**
 * Complex string handler (last modified: 2020.06.11).
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

class ComplexStringHandler
{
    /**
     * @var string Supplied to the class at object instantiation or thereafter.
     */
    public $Input = '';

    /**
     * @var array The data to be worked upon by the class.
     */
    private $Working = [];

    /**
     * @var array Markers and pattern matches defined by generateMarkers.
     */
    private $Markers = [];

    /**
     * @param string $Data The data supplied to the class at object instantiation.
     * @param string $Pattern An optional pattern to immediately call $this->generateMarkers.
     * @param callable $Closure An optional closure to immediately call $this->iterateClosure.
     */
    public function __construct(string $Data = '', string $Pattern = '', callable $Closure = null)
    {
        if (!empty($Data) && is_string($Data)) {
            $this->Input = $Data;
            if (!empty($Pattern) && is_string($Pattern)) {
                $this->generateMarkers($Pattern);
                if (is_callable($Closure)) {
                    $this->iterateClosure($Closure);
                }
            }
        }
    }

    /**
     * Generate markers and working data.
     *
     * @param string $Pattern The pattern to use to generate the markers.
     */
    public function generateMarkers(string $Pattern)
    {
        preg_match_all($Pattern, $this->Input, $this->Markers, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
        $Start = 0;
        $this->Working = [];
        foreach ($this->Markers as $Marker) {
            if (!is_array($Marker[0]) || !isset($Marker[0][0]) || is_array($Marker[0][0]) || !isset($Marker[0][1])) {
                break;
            }
            $this->Working[] = substr($this->Input, $Start, $Marker[0][1] - $Start);
            $Start = $Marker[0][1] + strlen($Marker[0][0]);
        }
        $this->Working[] = substr($this->Input, $Start);
    }

    /**
     * Iterate over the working data using a given closure.
     *
     * @param callable $Closure
     * @param bool $Glue Whether to work on the markers or the working data.
     */
    public function iterateClosure(callable $Closure, bool $Glue = false)
    {
        if (empty($this->Input)) {
            return;
        }
        if (!$Glue) {
            foreach ($this->Working as &$Segment) {
                $Segment = $Closure($Segment);
            }
            return;
        }
        foreach ($this->Markers as &$Segment) {
            if (isset($Segment[0][0]) && !is_array($Segment[0][0])) {
                $Segment[0][0] = $Closure($Segment[0][0]);
            }
        }
    }

    /** Recompile all data after all work has finished and return it. */
    public function recompile(): string
    {
        $Output = '';
        $Glue = 0;
        foreach ($this->Working as $Segment) {
            $Output .= $Segment;
            if (isset($this->Markers[$Glue][0][0]) && !is_array($this->Markers[$Glue][0][0])) {
                $Output .= $this->Markers[$Glue][0][0];
                $Glue++;
            }
        }
        return $Output;
    }

    /** PHP's magic "__toString" method to act as an alias for "recompile". */
    public function __toString(): string
    {
        return $this->recompile();
    }
}
