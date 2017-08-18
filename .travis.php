<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Travis CI test file (last modified: 2017.08.18).
 *
 * At this time, our CI tests are very rudimentary; Basically, the package
 * should be executed by each of the relevant applicable PHP versions that we
 * intended for it to be compatible with, and if there's some severe
 * compatibility issue that prevents the package from completing execution, our
 * tests should fail. If all tests pass, we can assume general compatibility
 * with the intended PHP versions (although edge-case compatibility isn't
 * necessarily guaranteed by this nor overall functionality exactly as per is
 * intended). Tests may be expanded upon in the future in order to increase
 * coverage or to provide a better guarantee of overall package efficacy.
 */

define('Via-Travis', true);

require __DIR__ . '/loader.php';

$ClassNames = array('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');
$ClassExists = array(class_exists($ClassNames[0]), class_exists($ClassNames[1]));
if ($ClassExists[0]) {
    if (!$ClassExists[1]) {
        class_alias($ClassNames[0], $ClassNames[1]);
    }
} elseif (!$ClassExists[1]) {
    die('Can\'t continue. PHPUnit not loaded.');
}
unset($ClassExists, $ClassNames);

class Experimental extends \PHPUnit_Framework_TestCase
{
    public function testErrors() {
        $this->assertNull(error_get_last(), 'Errors were reported.');
    }
}
