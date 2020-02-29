<?php

class LoaderCest
{
    public function _before(UnitTester $I)
    {
        $GLOBALS['phpMussel_Config'] = parse_ini_file('tests/_support/config/config.ini', true);
        require 'loader.php';
    }

    // tests if there are no errors when requiring loader.php
    public function testNoErrors(UnitTester $I)
    {
        $I->assertNull(error_get_last(), 'Errors were reported.');
    }
}
