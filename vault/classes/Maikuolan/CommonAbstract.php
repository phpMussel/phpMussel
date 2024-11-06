<?php
/**
 * Common abstract for the common classes package (last modified: 2024.09.20).
 *
 * This file is a part of the "common classes package", utilised by a number of
 * packages and projects, including CIDRAM and phpMussel.
 * @link https://github.com/Maikuolan/Common
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * "COMMON CLASSES PACKAGE" COPYRIGHT 2019 and beyond by Caleb Mazalevskis.
 */

namespace Maikuolan\Common;

abstract class CommonAbstract
{
    /**
     * @var string Common Classes Package tag/release version.
     * @link https://github.com/Maikuolan/Common/tags
     */
    public const VERSION = '2.12.3';

    /**
     * Traverse data path.
     *
     * @param mixed $Data The data to traverse.
     * @param string|array $Path The path to traverse.
     * @param bool $AllowNonScalar Whether to allow non-scalar returns.
     * @param bool $AllowMethodCalls Whether to allow method calls.
     * @return mixed The traversed data, or an empty string on failure.
     */
    public function dataTraverse(&$Data, $Path = [], bool $AllowNonScalar = false, bool $AllowMethodCalls = false)
    {
        if (!is_array($Path)) {
            $Path = preg_split('~(?<!\\\\)\\.~', $Path) ?: [];
        }
        $Segment = array_shift($Path);
        if ($Segment === null || strlen($Segment) === 0) {
            return $AllowNonScalar || is_scalar($Data) ? $Data : '';
        }
        $Segment = str_replace('\.', '.', $Segment);
        if (is_array($Data)) {
            return isset($Data[$Segment]) ? $this->dataTraverse($Data[$Segment], $Path, $AllowNonScalar, $AllowMethodCalls) : '';
        }
        if (is_object($Data)) {
            if (property_exists($Data, $Segment)) {
                return $this->dataTraverse($Data->$Segment, $Path, $AllowNonScalar, $AllowMethodCalls);
            }
            if ($AllowMethodCalls && method_exists($Data, $Segment)) {
                $Working = $Data->{$Segment}(...$Path);
                return $this->dataTraverse($Working, [], $AllowNonScalar);
            }
        }
        if (is_string($Data)) {
            if (preg_match('~^(?:trim|str(?:tolower|toupper|len))\\(\\)~i', $Segment)) {
                $Segment = substr($Segment, 0, -2);
                $Data = $Segment($Data);
            }
        }
        return $this->dataTraverse($Data, $Path, $AllowNonScalar, $AllowMethodCalls);
    }
}
