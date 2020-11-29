<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 */

// Prevent running tests outside of Composer (if the package is deployed
// somewhere live with this file still intact, useful to prevent hammering and
// cycles being needlessly wasted).
if (!isset($_SERVER['COMPOSER_BINARY'])) {
    die;
}

// Suppress unexpected errors from output and exit early as a failure when encountered.
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    exit(1);
});

// Path to the test files.
$Testfiles = __DIR__ . DIRECTORY_SEPARATOR . '_testfiles' . DIRECTORY_SEPARATOR;

// Path to the test path.
$TestPath = __DIR__ . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR;

// Path to the vault.
$Vault = __DIR__ . DIRECTORY_SEPARATOR . 'vault' . DIRECTORY_SEPARATOR;

// Fetch the signatures needed for testing the scanner.
$ZipObj = new \ZipArchive();
if ($ZipObj->open($TestPath . 'signatures.zip') === TRUE) {
    $ZipObj->extractTo($Vault . 'signatures' . DIRECTORY_SEPARATOR);
    $ZipObj->close();
    unset($ZipObj);
} else {
    exit(3);
}

if (!is_readable(__DIR__ . DIRECTORY_SEPARATOR . 'loader.php') || !is_readable($Vault . 'config.ini.RenameMe')) {
    exit(2);
}

// Fetch phpMussel configuration.
$phpMussel_Config = parse_ini_file($Vault . 'config.ini.RenameMe', true);
$phpMussel_Config['files']['filetype_blacklist'] = '';
$phpMussel_Config['general']['disable_cli'] = true;
$phpMussel_Config['general']['cleanup'] = false;
$phpMussel_Config['signatures']['Active'] = 'phpmussel.cedb,phpmussel.db,phpmussel.fdb,phpmussel.hdb,phpmussel.htdb,phpmussel.mdb,phpmussel.medb,phpmussel.ndb,phpmussel_elf.db,phpmussel_email.db,phpmussel_email_regex.db,phpmussel_exe.db,phpmussel_exe_regex.db,phpmussel_graphics.db,phpmussel_graphics_regex.db,phpmussel_ole.db,phpmussel_ole_regex.db,phpmussel_pdf.db,phpmussel_regex.db,phpmussel_regex.htdb,phpmussel_regex.ndb,phpmussel_swf.db,phpmussel_swf_regex.db';
$phpMussel_Config['supplementary_cache_options']['enable_apcu'] = true;

// Load the loader. :-)
require __DIR__ . DIRECTORY_SEPARATOR . 'loader.php';

// Expected results.
$Expected = [
    "-> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: c4f668fa):\n--> Detected phpMussel-Testfile.ASCII.Standard!\n",
    "-> Checking 'coex_testfile.rtf' (FN: b0e404dc; FD: c44e0020):\n--> Detected phpMussel-Testfile.CoEx!\n",
    "-> Checking 'exe_standard_testfile.exe' (FN: bc2b0816; FD: 0133b2e1):\n--> Detected phpMussel-Testfile.EXE.Standard!\n",
    "-> Checking 'general_standard_testfile.txt' (FN: e0a8291b; FD: 2c0f6de1):\n--> Detected phpMussel-Testfile.General.Standard!\n",
    "-> Checking 'graphics_standard_testfile.gif' (FN: fa02d6a4; FD: 31dcb0b4):\n--> Detected phpMussel-Testfile.Graphics.Standard!\n",
    "-> Checking 'hash_testfile_md5.txt' (FN: 7207cc85; FD: e983902b):\n--> Detected phpMussel-Testfile.HASH.MD5!\n",
    "-> Checking 'hash_testfile_sha1.txt' (FN: c2eb70ba; FD: 6061c089):\n--> Detected phpMussel-Testfile.HASH.SHA1!\n",
    "-> Checking 'hash_testfile_sha256.txt' (FN: 2bd41253; FD: 36e7c5a4):\n--> Detected phpMussel-Testfile.HASH.SHA256!\n",
    "-> Checking 'html_standard_testfile.html' (FN: 20df694f; FD: 48e4ea2b):\n--> Detected phpMussel-Testfile.HTML.Standard!\n",
    "-> Checking 'ole_testfile.ole' (FN: 1d191026; FD: 1b9c711f):\n--> No problems found.\n-> Checking 'ole_testfile.ole>ole_testfile.bin' (FN: ff64aeb8; FD: b6da61cd):\n--> Detected phpMussel-Testfile.OLE.Standard!\n",
    "-> Checking 'pdf_standard_testfile.pdf' (FN: 6d1c7c10; FD: 8c05e37f):\n--> Detected phpMussel-Testfile.PDF.Standard!\n",
    "-> Checking 'pe_sectional_testfile.exe' (FN: 51114ec6; FD: f93ee86b):\n--> Detected phpMussel-Testfile.PE.Sectional!\n",
    "-> Checking 'swf_standard_testfile.swf' (FN: 1c2de39d; FD: e0cfb75b):\n--> Detected phpMussel-Testfile.SWF.Standard!\n"
];

// Test scanning against the standard phpMussel test samples.
$Actual = $phpMussel['Scan']($Testfiles, true, false);
sort($Actual, SORT_STRING);
if ($Actual !== $Expected) {
    exit(5);
}

restore_error_handler();

// All tests passed.
exit(0);
