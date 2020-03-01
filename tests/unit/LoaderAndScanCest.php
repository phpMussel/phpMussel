<?php

class LoaderAndScanCest
{
    public function _before(UnitTester $I)
    {
        $GLOBALS['phpMussel_Config'] = parse_ini_file('tests/_support/config/config.ini', true);
        if (!defined('UNIT_TESTING_IN_PROGRESS')) {
            define('UNIT_TESTING_IN_PROGRESS', true);
            define('phpMussel', true);
        }
        require 'loader.php';
        $GLOBALS['phpMussel'] = $phpMussel;
    }

    /**
     * Tests whether any errors occur when requiring loader.php, and tests the
     * possible integer outputs of the "Scan" closure. (Shouldn't generally
     * combine multiple asserts together like this, but Codeception doesn't
     * like it when I try loading the loader multiple times and won't execute
     * all tests that way anyway; at least this way should hopefully work).
     * Can check the raw logs at Travis to see the status of the assertions.
     */
    public function testLoaderAndScan(UnitTester $I)
    {
        global $phpMussel;

        /** Assert for loader errors. */
        $I->assertNull(error_get_last(), 'Errors were reported.');

        /**
         * Tests whether "Scan" returns the correct integer value for when
         * encrypted archives are detected. The sample used (encrypted.zip)
         * contains one plain-text file, containing "Hello World". The password
         * for the sample is "encrypted".
         */
        $Results = $phpMussel['Scan']('tests/_support/samples/encrypted.zip', false, true);
        $I->assertEquals(-4, $Results, 'Failed to return the correct integer value for when encrypted archives are detected.');

        /**
         * Not covered yet:
         * -3 (problems encountered with signatures files).
         * -2 (corrupt data detected).
         * -1 (missing PHP extensions and addons).
         * 2 (problems detected; e.g., viruses, malware, etc).
         */

        /**
         * Tests whether "Scan" returns the correct integer value for erroneous
         * and non-existent files.
         */
        $Results = $phpMussel['Scan']('this/file/path/is/invalid', false, true);
        $I->assertEquals(0, $Results, 'Failed to return the correct integer value for non-existent files.');

        /**
         * Tests whether "Scan" returns the correct integer value for scans
         * where no problems are found (the sample used is just a plain-text
         * file containing "Hello World"; i.e., there's nothing problematic
         * about it).
         */
        $Results = $phpMussel['Scan']('tests/_support/samples/hello.txt', false, true);
        $I->assertEquals(1, $Results, 'Failed to return the correct integer value for when no problems are found.');
    }
}
