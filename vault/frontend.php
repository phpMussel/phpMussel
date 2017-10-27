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
 * This file: Front-end handler (last modified: 2017.10.27).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Kill the script if the front-end functions file doesn't exist. */
if (!file_exists($phpMussel['Vault'] . 'frontend_functions.php')) {
    header('Content-Type: text/plain');
    die('[phpMussel] Front-end functions file missing! Please reinstall phpMussel.');
}
/** Load the front-end functions file. */
require $phpMussel['Vault'] . 'frontend_functions.php';

/** Set page selector if not already set. */
if (empty($phpMussel['QueryVars']['phpmussel-page'])) {
    $phpMussel['QueryVars']['phpmussel-page'] = '';
}

/** Populate common front-end variables. */
$phpMussel['FE'] = [
    'Template' => $phpMussel['ReadFile']($phpMussel['GetAssetPath']('frontend.html')),
    'DefaultPassword' => '$2y$10$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK',
    'FE_Lang' => $phpMussel['Config']['general']['lang'],
    'Magnification' => $phpMussel['Config']['template_data']['Magnification'],
    'MaintenanceWarning' => $phpMussel['Config']['general']['maintenance_mode'] ?
        "\n<div class=\"center\"><span class=\"txtRd\">" . $phpMussel['lang']['state_maintenance_mode'] . '</span></div><hr />' : '',
    'Number_L10N_JS' => $phpMussel['Number_L10N_JS'](),
    'DateTime' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['timeFormat']),
    'ScriptIdent' => $phpMussel['ScriptIdent'],
    'theme' => $phpMussel['Config']['template_data']['theme'],
    'UserList' => "\n",
    'SessionList' => "\n",
    'Cache' => "\n",
    'UserState' => 0,
    'UserRaw' => '',
    'Permissions' => 0,
    'state_msg' => '',
    'ThisSession' => '',
    'bNav' => '&nbsp;',
    'FE_Title' => ''
];

/** Fetch pips data. */
$phpMussel['Pips_Path'] = $phpMussel['GetAssetPath']('pips.php');
if (is_readable($phpMussel['Pips_Path'])) {
    require $phpMussel['Pips_Path'];
}

/** Handle webfonts. */
if (empty($phpMussel['Config']['general']['disable_webfonts'])) {
    $phpMussel['FE']['Template'] = str_replace(['<!-- WebFont Begin -->', '<!-- WebFont End -->'], '', $phpMussel['FE']['Template']);
} else {
    $phpMussel['WebFontPos'] = [
        'Begin' => strpos($phpMussel['FE']['Template'], '<!-- WebFont Begin -->'),
        'End' => strpos($phpMussel['FE']['Template'], '<!-- WebFont End -->')
    ];
    $phpMussel['FE']['Template'] = substr(
        $phpMussel['FE']['Template'], 0, $phpMussel['WebFontPos']['Begin']
    ) . substr(
        $phpMussel['FE']['Template'], $phpMussel['WebFontPos']['End'] + 20
    );
    unset($phpMussel['WebFontPos']);
}

/** A fix for correctly displaying LTR/RTL text. */
if (empty($phpMussel['lang']['textDir']) || $phpMussel['lang']['textDir'] !== 'rtl') {
    $phpMussel['lang']['textDir'] = 'ltr';
    $phpMussel['FE']['FE_Align'] = 'left';
    $phpMussel['FE']['FE_Align_Reverse'] = 'right';
    $phpMussel['FE']['PIP_Input'] = $phpMussel['FE']['PIP_Right'];
    $phpMussel['FE']['Gradient_Degree'] = 90;
    $phpMussel['FE']['Half_Border'] = 'solid solid none none';
} else {
    $phpMussel['FE']['FE_Align'] = 'right';
    $phpMussel['FE']['FE_Align_Reverse'] = 'left';
    $phpMussel['FE']['PIP_Input'] = $phpMussel['FE']['PIP_Left'];
    $phpMussel['FE']['Gradient_Degree'] = 270;
    $phpMussel['FE']['Half_Border'] = 'solid none none solid';
}

/** A simple passthru for non-private theme images and related data. */
if (!empty($phpMussel['QueryVars']['phpmussel-asset'])) {

    $phpMussel['Success'] = false;

    if (
        $phpMussel['FileManager-PathSecurityCheck']($phpMussel['QueryVars']['phpmussel-asset']) &&
        !preg_match('~[^0-9a-z._]~i', $phpMussel['QueryVars']['phpmussel-asset'])
    ) {
        $phpMussel['ThisAsset'] = $phpMussel['GetAssetPath']($phpMussel['QueryVars']['phpmussel-asset'], true);
        if (
            $phpMussel['ThisAsset'] &&
            is_readable($phpMussel['ThisAsset']) &&
            ($phpMussel['ThisAssetDel'] = strrpos($phpMussel['ThisAsset'], '.')) !== false
        ) {
            $phpMussel['ThisAssetType'] = strtolower(substr($phpMussel['ThisAsset'], $phpMussel['ThisAssetDel'] + 1));
            if ($phpMussel['ThisAssetType'] === 'jpeg') {
                $phpMussel['ThisAssetType'] = 'jpg';
            }
            if (preg_match('/^(gif|jpg|png|webp)$/', $phpMussel['ThisAssetType'])) {
                /** Set asset mime-type (images). */
                header('Content-Type: image/' . $phpMussel['ThisAssetType']);
                $phpMussel['Success'] = true;
            } elseif ($phpMussel['ThisAssetType'] === 'js') {
                /** Set asset mime-type (JavaScript). */
                header('Content-Type: text/javascript');
                $phpMussel['Success'] = true;
            }
            if ($phpMussel['Success']) {
                if (!empty($phpMussel['QueryVars']['theme'])) {
                    /** Prevents needlessly reloading static assets. */
                    header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($phpMussel['ThisAsset'])));
                }
                /** Send asset data. */
                echo $phpMussel['ReadFile']($phpMussel['ThisAsset']);
            }
        }
    }

    if ($phpMussel['Success']) {
        die;
    }
    unset($phpMussel['ThisAssetType'], $phpMussel['ThisAssetDel'], $phpMussel['ThisAsset'], $phpMussel['Success']);

}

/** A simple passthru for the front-end CSS. */
if ($phpMussel['QueryVars']['phpmussel-page'] === 'css') {
    header('Content-Type: text/css');
    echo $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('frontend.css'))
    );
    die;
}

/** A simple passthru for the favicon. */
if ($phpMussel['QueryVars']['phpmussel-page'] === 'favicon') {
    header('Content-Type: image/png');
    echo base64_decode($phpMussel['favicon']);
    die;
}

/** Set form target if not already set. */
$phpMussel['FE']['FormTarget'] = empty($_POST['phpmussel-form-target']) ? '' : $_POST['phpmussel-form-target'];

/** Fetch user list, sessions list and the front-end cache. */
if (file_exists($phpMussel['Vault'] . 'fe_assets/frontend.dat')) {
    $phpMussel['FE']['FrontEndData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/frontend.dat');
    $phpMussel['FE']['Rebuild'] = false;
} else {
    $phpMussel['FE']['FrontEndData'] = "USERS\n-----\nYWRtaW4=," . $phpMussel['FE']['DefaultPassword'] . ",1\n\nSESSIONS\n--------\n\nCACHE\n-----\n";
    $phpMussel['FE']['Rebuild'] = true;
}
$phpMussel['FE']['UserListPos'] = strpos($phpMussel['FE']['FrontEndData'], "USERS\n-----\n");
$phpMussel['FE']['SessionListPos'] = strpos($phpMussel['FE']['FrontEndData'], "SESSIONS\n--------\n");
$phpMussel['FE']['CachePos'] = strpos($phpMussel['FE']['FrontEndData'], "CACHE\n-----\n");
if ($phpMussel['FE']['UserListPos'] !== false) {
    $phpMussel['FE']['UserList'] = substr(
        $phpMussel['FE']['FrontEndData'],
        $phpMussel['FE']['UserListPos'] + 11,
        $phpMussel['FE']['SessionListPos'] - $phpMussel['FE']['UserListPos'] - 12
    );
}
if ($phpMussel['FE']['SessionListPos'] !== false) {
    $phpMussel['FE']['SessionList'] = substr(
        $phpMussel['FE']['FrontEndData'],
        $phpMussel['FE']['SessionListPos'] + 17,
        $phpMussel['FE']['CachePos'] - $phpMussel['FE']['SessionListPos'] - 18
    );
}
if ($phpMussel['FE']['CachePos'] !== false) {
    $phpMussel['FE']['Cache'] = substr(
        $phpMussel['FE']['FrontEndData'],
        $phpMussel['FE']['CachePos'] + 11
    );
}

/** Clear expired sessions. */
$phpMussel['ClearExpired']($phpMussel['FE']['SessionList'], $phpMussel['FE']['Rebuild']);

/** Clear expired cache entries. */
$phpMussel['ClearExpired']($phpMussel['FE']['Cache'], $phpMussel['FE']['Rebuild']);

/** Brute-force security check. */
if (($phpMussel['LoginAttempts'] = (int)$phpMussel['FECacheGet'](
    $phpMussel['FE']['Cache'], 'LoginAttempts' . $_SERVER[$phpMussel['Config']['general']['ipaddr']]
)) && ($phpMussel['LoginAttempts'] >= $phpMussel['Config']['general']['max_login_attempts'])) {
    header('Content-Type: text/plain');
    die('[phpMussel] ' . $phpMussel['lang']['max_login_attempts_exceeded']);
}

/** Attempt to log in the user. */
if ($phpMussel['FE']['FormTarget'] === 'login') {
    if (!empty($_POST['username']) && empty($_POST['password'])) {
        $phpMussel['FE']['UserState'] = -1;
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_password_field_empty'];
    } elseif (empty($_POST['username']) && !empty($_POST['password'])) {
        $phpMussel['FE']['UserState'] = -1;
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_username_field_empty'];
    } elseif (!empty($_POST['username']) && !empty($_POST['password'])) {

        $phpMussel['FE']['UserState'] = -1;
        $phpMussel['FE']['UserRaw'] = $_POST['username'];
        $phpMussel['FE']['User'] = base64_encode($phpMussel['FE']['UserRaw']);
        $phpMussel['FE']['UserPos'] = strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['User'] . ',');

        if ($phpMussel['FE']['UserPos'] !== false) {
            $phpMussel['FE']['UserOffset'] = $phpMussel['FE']['UserPos'] + strlen($phpMussel['FE']['User']) + 2;
            $phpMussel['FE']['Password'] = substr(
                $phpMussel['FE']['UserList'],
                $phpMussel['FE']['UserOffset'],
                strpos($phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['UserOffset']) - $phpMussel['FE']['UserOffset']
            );
            $phpMussel['FE']['Permissions'] = (int)substr($phpMussel['FE']['Password'], -1);
            $phpMussel['FE']['Password'] = substr($phpMussel['FE']['Password'], 0, -2);
            if (password_verify($_POST['password'], $phpMussel['FE']['Password'])) {
                $phpMussel['FECacheRemove'](
                    $phpMussel['FE']['Cache'], $phpMussel['FE']['Rebuild'], 'LoginAttempts' . $_SERVER[$phpMussel['Config']['general']['ipaddr']]
                );
                $phpMussel['FE']['SessionKey'] = md5($phpMussel['GenerateSalt']());
                $phpMussel['FE']['Cookie'] = $_POST['username'] . $phpMussel['FE']['SessionKey'];
                setcookie('PHPMUSSEL-ADMIN', $phpMussel['FE']['Cookie'], $phpMussel['Time'] + 604800, '/', (!empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''), false, true);
                $phpMussel['FE']['UserState'] = 1;
                $phpMussel['FE']['ThisSession'] = $phpMussel['FE']['User'] . ',' . password_hash(
                    $phpMussel['FE']['SessionKey'], $phpMussel['DefaultAlgo']
                ) . ',' . ($phpMussel['Time'] + 604800) . "\n";
                $phpMussel['FE']['SessionList'] .= $phpMussel['FE']['ThisSession'];
                $phpMussel['FE']['Rebuild'] = true;
            } else {
                $phpMussel['FE']['Permissions'] = 0;
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_invalid_password'];
            }
        } else {
            $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_invalid_username'];
        }

    }

    if ($phpMussel['Config']['general']['FrontEndLog']) {
        if (strpos($phpMussel['Config']['general']['FrontEndLog'], '{') !== false) {
            $phpMussel['Config']['general']['FrontEndLog'] = $phpMussel['TimeFormat'](
                $phpMussel['Time'],
                $phpMussel['Config']['general']['FrontEndLog']
            );
        }
        $phpMussel['FrontEndLog'] = $_SERVER[$phpMussel['Config']['general']['ipaddr']] . ' - ' . $phpMussel['FE']['DateTime'] . ' - ';
        $phpMussel['FrontEndLog'] .= empty($_POST['username']) ? '""' : '"' . $_POST['username'] . '"';
    }
    if ($phpMussel['FE']['state_msg']) {
        $phpMussel['LoginAttempts']++;
        $phpMussel['TimeToAdd'] = ($phpMussel['LoginAttempts'] > 4) ? ($phpMussel['LoginAttempts'] - 4) * 86400 : 86400;
        $phpMussel['FECacheAdd'](
            $phpMussel['FE']['Cache'],
            $phpMussel['FE']['Rebuild'],
            'LoginAttempts' . $_SERVER[$phpMussel['Config']['general']['ipaddr']],
            $phpMussel['LoginAttempts'],
            $phpMussel['Time'] + $phpMussel['TimeToAdd']
        );
        if ($phpMussel['Config']['general']['FrontEndLog']) {
            $phpMussel['FrontEndLog'] .= ' - ' . $phpMussel['FE']['state_msg'] . "\n";
        }
        $phpMussel['FE']['state_msg'] = '<div class="txtRd">' . $phpMussel['FE']['state_msg'] . '<br /><br /></div>';
    } elseif ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['FrontEndLog'] .= ' - ' . $phpMussel['lang']['state_logged_in'] . "\n";
    }
    if ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['WriteMode'] = (
            !file_exists($phpMussel['Vault'] . $phpMussel['Config']['general']['FrontEndLog']) || (
                $phpMussel['Config']['general']['truncate'] > 0 &&
                filesize($phpMussel['Vault'] . $phpMussel['Config']['general']['FrontEndLog']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
            )
        ) ? 'w' : 'a';
        $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['Config']['general']['FrontEndLog'], $phpMussel['WriteMode']);
        fwrite($phpMussel['Handle'], $phpMussel['FrontEndLog']);
        fclose($phpMussel['Handle']);
        unset($phpMussel['WriteMode'], $phpMussel['FrontEndLog']);
    }
}

/** Determine whether the user has logged in. */
elseif (!empty($_COOKIE['PHPMUSSEL-ADMIN'])) {

    $phpMussel['FE']['UserState'] = -1;
    $phpMussel['FE']['SessionKey'] = substr($_COOKIE['PHPMUSSEL-ADMIN'], -32);
    $phpMussel['FE']['UserRaw'] = substr($_COOKIE['PHPMUSSEL-ADMIN'], 0, -32);
    $phpMussel['FE']['User'] = base64_encode($phpMussel['FE']['UserRaw']);
    $phpMussel['FE']['SessionOffset'] = 0;

    if (!empty($phpMussel['FE']['SessionKey']) && !empty($phpMussel['FE']['User'])) {
        $phpMussel['FE']['UserLen'] = strlen($phpMussel['FE']['User']);
        while (($phpMussel['FE']['SessionPos'] = strpos(
            $phpMussel['FE']['SessionList'],
            "\n" . $phpMussel['FE']['User'],
            $phpMussel['FE']['SessionOffset']
        )) !== false) {
            $phpMussel['FE']['SessionOffset'] = $phpMussel['FE']['SessionPos'] + $phpMussel['FE']['UserLen'] + 2;
            $phpMussel['FE']['SessionEntry'] = substr(
                $phpMussel['FE']['SessionList'],
                $phpMussel['FE']['SessionOffset'],
                $phpMussel['ZeroMin'](strpos(
                    $phpMussel['FE']['SessionList'], "\n", $phpMussel['FE']['SessionOffset']
                ), $phpMussel['FE']['SessionOffset'] * -1)
            );
            $phpMussel['FE']['SEDelimiter'] = strrpos($phpMussel['FE']['SessionEntry'], ',');
            if ($phpMussel['FE']['SEDelimiter'] !== false) {
                $phpMussel['FE']['Expiry'] = (int)substr($phpMussel['FE']['SessionEntry'], $phpMussel['FE']['SEDelimiter'] + 1);
                $phpMussel['FE']['UserHash'] = substr($phpMussel['FE']['SessionEntry'], 0, $phpMussel['FE']['SEDelimiter']);
            }
            if (
                !empty($phpMussel['FE']['Expiry']) &&
                !empty($phpMussel['FE']['UserHash']) &&
                ($phpMussel['FE']['Expiry'] > $phpMussel['Time']) &&
                password_verify($phpMussel['FE']['SessionKey'], $phpMussel['FE']['UserHash'])
            ) {
                $phpMussel['FE']['UserPos'] = strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['User'] . ',');
                if ($phpMussel['FE']['UserPos'] !== false) {
                    $phpMussel['FE']['ThisSession'] = $phpMussel['FE']['User'] . ',' . $phpMussel['FE']['SessionEntry'] . "\n";
                    $phpMussel['FE']['UserOffset'] = $phpMussel['FE']['UserPos'] + $phpMussel['FE']['UserLen'] + 2;
                    $phpMussel['FE']['Permissions'] = (int)substr(substr(
                        $phpMussel['FE']['UserList'],
                        $phpMussel['FE']['UserOffset'],
                        strpos($phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['UserOffset']) - $phpMussel['FE']['UserOffset']
                    ), -1);
                    $phpMussel['FE']['UserState'] = 1;
                }
                break;
            }
        }
    }

}

/** Only execute this code block for users that are logged in. */
if ($phpMussel['FE']['UserState'] === 1) {

    if ($phpMussel['QueryVars']['phpmussel-page'] === 'logout') {

        /** Log out the user. */
        $phpMussel['FE']['SessionList'] = str_ireplace($phpMussel['FE']['ThisSession'], '', $phpMussel['FE']['SessionList']);
        $phpMussel['FE']['ThisSession'] = '';
        $phpMussel['FE']['Rebuild'] = true;
        $phpMussel['FE']['UserState'] = $phpMussel['FE']['Permissions'] = 0;
        setcookie('PHPMUSSEL-ADMIN', '', -1, '/', (!empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''), false, true);

    }

    /** If the user has complete access. */
    if ($phpMussel['FE']['Permissions'] === 1) {

        $phpMussel['FE']['nav'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_nav_complete_access.html'))
        );

    /** If the user has logs access only. */
    } elseif ($phpMussel['FE']['Permissions'] === 2) {

        $phpMussel['FE']['nav'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_nav_logs_access_only.html'))
        );

    }

    /** Execute hotfixes. */
    if (file_exists($phpMussel['Vault'] . 'hotfixes.php')) {
        require $phpMussel['Vault'] . 'hotfixes.php';
    }

}

$phpMussel['FE']['bNavBR'] = ($phpMussel['FE']['UserState'] === 1) ? '<br /><br />' : '<br />';

/** The user hasn't logged in. Show them the login page. */
if ($phpMussel['FE']['UserState'] !== 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_login'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['lang']['tip_login'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_login.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/**
 * The user has logged in, but hasn't selected anything to view. Show them the
 * front-end home page.
 */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === '') {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_home'];

    /** phpMussel version used. */
    $phpMussel['FE']['ScriptVersion'] = $phpMussel['ScriptVersion'];

    /** PHP version used. */
    $phpMussel['FE']['info_php'] = PHP_VERSION;

    /** SAPI used. */
    $phpMussel['FE']['info_sapi'] = php_sapi_name();

    /** Operating system used. */
    $phpMussel['FE']['info_os'] = php_uname();

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_home']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_logout'];

    /** Where to find remote version information? */
    $phpMussel['RemoteVerPath'] = 'https://raw.githubusercontent.com/Maikuolan/Compatibility-Charts/gh-pages/';

    /** Fetch remote phpMussel version information and cache it if necessary. */
    if (($phpMussel['Remote-YAML-phpMussel'] = $phpMussel['FECacheGet']($phpMussel['FE']['Cache'], 'phpmussel-ver.yaml')) === false) {
        $phpMussel['Remote-YAML-phpMussel'] = $phpMussel['Request']($phpMussel['RemoteVerPath'] . 'phpmussel-ver.yaml', false, 8);
        $phpMussel['FECacheAdd']($phpMussel['FE']['Cache'], $phpMussel['FE']['Rebuild'], 'phpmussel-ver.yaml', $phpMussel['Remote-YAML-phpMussel'] ?: '-', $phpMussel['Time'] + 86400);
    }

    /** Process remote phpMussel version information. */
    if (empty($phpMussel['Remote-YAML-phpMussel'])) {

        /** phpMussel latest stable. */
        $phpMussel['FE']['info_phpmussel_stable'] = $phpMussel['lang']['response_error'];
        /** phpMussel latest unstable. */
        $phpMussel['FE']['info_phpmussel_unstable'] = $phpMussel['lang']['response_error'];
        /** phpMussel branch latest stable. */
        $phpMussel['FE']['info_phpmussel_branch'] = $phpMussel['lang']['response_error'];

    } else {

        $phpMussel['Remote-YAML-phpMussel-Array'] = [];
        $phpMussel['YAML']($phpMussel['Remote-YAML-phpMussel'], $phpMussel['Remote-YAML-phpMussel-Array']);

        /** phpMussel latest stable. */
        $phpMussel['FE']['info_phpmussel_stable'] = empty($phpMussel['Remote-YAML-phpMussel-Array']['Stable']) ?
            $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-phpMussel-Array']['Stable'];
        /** phpMussel latest unstable. */
        $phpMussel['FE']['info_phpmussel_unstable'] = empty($phpMussel['Remote-YAML-phpMussel-Array']['Unstable']) ?
            $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-phpMussel-Array']['Unstable'];
        /** phpMussel branch latest stable. */
        if ($phpMussel['ThisBranch'] = substr($phpMussel['FE']['ScriptVersion'], 0, strpos($phpMussel['FE']['ScriptVersion'], '.') ?: 0)) {
            $phpMussel['ThisBranch'] = 'v' . ($phpMussel['ThisBranch'] ?: 1);
            $phpMussel['FE']['info_phpmussel_branch'] = empty($phpMussel['Remote-YAML-phpMussel-Array']['Branch'][$phpMussel['ThisBranch']]['Latest']) ?
                $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-phpMussel-Array']['Branch'][$phpMussel['ThisBranch']]['Latest'];
        } else {
            $phpMussel['FE']['info_php_branch'] = $phpMussel['lang']['response_error'];
        }

    }

    /** Cleanup. */
    unset($phpMussel['Remote-YAML-phpMussel-Array'], $phpMussel['Remote-YAML-phpMussel']);

    /** Fetch remote PHP version information and cache it if necessary. */
    if (($phpMussel['Remote-YAML-PHP'] = $phpMussel['FECacheGet']($phpMussel['FE']['Cache'], 'php-ver.yaml')) === false) {
        $phpMussel['Remote-YAML-PHP'] = $phpMussel['Request']($phpMussel['RemoteVerPath'] . 'php-ver.yaml', false, 8);
        $phpMussel['FECacheAdd']($phpMussel['FE']['Cache'], $phpMussel['FE']['Rebuild'], 'php-ver.yaml', $phpMussel['Remote-YAML-PHP'] ?: '-', $phpMussel['Time'] + 86400);
    }

    /** Process remote PHP version information. */
    if (empty($phpMussel['Remote-YAML-PHP'])) {

        /** PHP latest stable. */
        $phpMussel['FE']['info_php_stable'] = $phpMussel['lang']['response_error'];
        /** PHP latest unstable. */
        $phpMussel['FE']['info_php_unstable'] = $phpMussel['lang']['response_error'];
        /** PHP branch latest stable. */
        $phpMussel['FE']['info_php_branch'] = $phpMussel['lang']['response_error'];

    } else {

        $phpMussel['Remote-YAML-PHP-Array'] = [];
        $phpMussel['YAML']($phpMussel['Remote-YAML-PHP'], $phpMussel['Remote-YAML-PHP-Array']);

        /** PHP latest stable. */
        $phpMussel['FE']['info_php_stable'] = empty($phpMussel['Remote-YAML-PHP-Array']['Stable']) ?
            $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-PHP-Array']['Stable'];
        /** PHP latest unstable. */
        $phpMussel['FE']['info_php_unstable'] = empty($phpMussel['Remote-YAML-PHP-Array']['Unstable']) ?
            $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-PHP-Array']['Unstable'];
        /** PHP branch latest stable. */
        if ($phpMussel['ThisBranch'] = substr(PHP_VERSION, 0, strpos(PHP_VERSION, '.') ?: 0)) {
            $phpMussel['ThisBranch'] .= substr(PHP_VERSION, strlen($phpMussel['ThisBranch']) + 1, strpos(PHP_VERSION, '.', strlen($phpMussel['ThisBranch'])) ?: 0);
            $phpMussel['ThisBranch'] = 'php' . $phpMussel['ThisBranch'];
            $phpMussel['FE']['info_php_branch'] = empty($phpMussel['Remote-YAML-PHP-Array']['Branch'][$phpMussel['ThisBranch']]['Latest']) ?
                $phpMussel['lang']['response_error'] : $phpMussel['Remote-YAML-PHP-Array']['Branch'][$phpMussel['ThisBranch']]['Latest'];
            $phpMussel['ForceVersionWarning'] = (!empty($phpMussel['Remote-YAML-PHP-Array'][$phpMussel['ThisBranch']]['WarnMin']) && (
                $phpMussel['Remote-YAML-PHP-Array'][$phpMussel['ThisBranch']]['WarnMin'] === '*' ||
                $phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Remote-YAML-PHP-Array'][$phpMussel['ThisBranch']]['WarnMin'])
            ));
        } else {
            $phpMussel['FE']['info_php_branch'] = $phpMussel['lang']['response_error'];
        }

    }

    /** Cleanup. */
    unset($phpMussel['Remote-YAML-PHP-Array'], $phpMussel['Remote-YAML-PHP'], $phpMussel['ThisBranch'], $phpMussel['RemoteVerPath']);

    /** Process warnings. */
    $phpMussel['FE']['Warnings'] = '';
    if (($phpMussel['FE']['VersionWarning'] = $phpMussel['VersionWarning']()) > 0) {
        if ($phpMussel['FE']['VersionWarning'] >= 2) {
            $phpMussel['FE']['VersionWarning'] = $phpMussel['FE']['VersionWarning'] % 2;
            $phpMussel['FE']['Warnings'] .= '<li><a href="https://www.cvedetails.com/version-list/74/128/1/PHP-PHP.html">' . $phpMussel['lang']['warning_php_2'] . '</a></li>';
        }
        if ($phpMussel['FE']['VersionWarning'] >= 1) {
            $phpMussel['FE']['Warnings'] .= '<li><a href="https://secure.php.net/supported-versions.php">' . $phpMussel['lang']['warning_php_1'] . '</a></li>';
        }
    }
    if (empty($phpMussel['Config']['signatures']['Active'])) {
        $phpMussel['FE']['Warnings'] .= '<li>' . $phpMussel['lang']['warning_signatures_1'] . '</li>';
    }
    if ($phpMussel['FE']['Warnings']) {
        $phpMussel['FE']['Warnings'] = '<hr />' . $phpMussel['lang']['warning'] . '<br /><div class="txtRd"><ul>' . $phpMussel['FE']['Warnings'] . '</ul></div>';
    }

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_home.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** A simple passthru for the file manager icons. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'icon' && $phpMussel['FE']['Permissions'] === 1) {

    if (
        !empty($phpMussel['QueryVars']['file']) &&
        $phpMussel['FileManager-PathSecurityCheck']($phpMussel['QueryVars']['file']) &&
        file_exists($phpMussel['Vault'] . $phpMussel['QueryVars']['file']) &&
        is_readable($phpMussel['Vault'] . $phpMussel['QueryVars']['file'])
    ) {
        header('Content-Type: image/x-icon');
        echo $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['QueryVars']['file']);
    }

    elseif (!empty($phpMussel['QueryVars']['icon'])) {

        $phpMussel['Icons_Handler_Path'] = $phpMussel['GetAssetPath']('icons.php');
        if (is_readable($phpMussel['Icons_Handler_Path'])) {

            /** Fetch file manager icons data. */
            require $phpMussel['Icons_Handler_Path'];

            /** Set mime-type. */
            header('Content-Type: image/gif');

            /** Prevents needlessly reloading static assets. */
            if (!empty($phpMussel['QueryVars']['theme'])) {
                header('Last-Modified: ' . gmdate(DATE_RFC1123, filemtime($phpMussel['Icons_Handler_Path'])));
            }

            /** Send icon data. */
            if (!empty($phpMussel['Icons'][$phpMussel['QueryVars']['icon']])) {
                echo gzinflate(base64_decode($phpMussel['Icons'][$phpMussel['QueryVars']['icon']]));
            } elseif (!empty($phpMussel['Icons']['unknown'])) {
                echo gzinflate(base64_decode($phpMussel['Icons']['unknown']));
            }

        }

    }

    die;

}

/** Accounts. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'accounts' && $phpMussel['FE']['Permissions'] === 1) {

    /** $_POST overrides for mobile display. */
    if (!empty($_POST['username']) && !empty($_POST['do_mob']) && (!empty($_POST['password_mob']) || $_POST['do_mob'] == 'delete-account')) {
        $_POST['do'] = $_POST['do_mob'];
    }
    if (empty($_POST['username']) && !empty($_POST['username_mob'])) {
        $_POST['username'] = $_POST['username_mob'];
    }
    if (empty($_POST['permissions']) && !empty($_POST['permissions_mob'])) {
        $_POST['permissions'] = $_POST['permissions_mob'];
    }
    if (empty($_POST['password']) && !empty($_POST['password_mob'])) {
        $_POST['password'] = $_POST['password_mob'];
    }

    /** A form has been submitted. */
    if ($phpMussel['FE']['FormTarget'] === 'accounts' && !empty($_POST['do'])) {

        /** Create a new account. */
        if ($_POST['do'] === 'create-account' && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['permissions'])) {
            $phpMussel['FE']['NewUser'] = $_POST['username'];
            $phpMussel['FE']['NewPass'] = password_hash($_POST['password'], $phpMussel['DefaultAlgo']);
            $phpMussel['FE']['NewPerm'] = (int)$_POST['permissions'];
            $phpMussel['FE']['NewUserB64'] = base64_encode($_POST['username']);
            if (strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['NewUserB64'] . ',') !== false) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_already_exists'];
            } else {
                $phpMussel['AccountsArray'] = [
                    'Iterate' => 0,
                    'Count' => 1,
                    'ByName' => [$phpMussel['FE']['NewUser'] =>
                        $phpMussel['FE']['NewUserB64'] . ',' .
                        $phpMussel['FE']['NewPass'] . ',' .
                        $phpMussel['FE']['NewPerm'] . "\n"
                    ]
                ];
                $phpMussel['FE']['NewLineOffset'] = 0;
                while (($phpMussel['FE']['NewLinePos'] = strpos(
                    $phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['NewLineOffset'] + 1
                )) !== false) {
                    $phpMussel['FE']['NewLine'] = substr(
                        $phpMussel['FE']['UserList'],
                        $phpMussel['FE']['NewLineOffset'] + 1,
                        $phpMussel['FE']['NewLinePos'] - $phpMussel['FE']['NewLineOffset']
                    );
                    $phpMussel['RowInfo'] = explode(',', $phpMussel['FE']['NewLine'], 3);
                    $phpMussel['RowInfo'] = base64_decode($phpMussel['RowInfo'][0]);
                    $phpMussel['AccountsArray']['ByName'][$phpMussel['RowInfo']] = $phpMussel['FE']['NewLine'];
                    $phpMussel['FE']['NewLineOffset'] = $phpMussel['FE']['NewLinePos'];
                }
                ksort($phpMussel['AccountsArray']['ByName']);
                $phpMussel['FE']['UserList'] = "\n" . implode('', $phpMussel['AccountsArray']['ByName']);
                $phpMussel['FE']['Rebuild'] = true;
                unset($phpMussel['AccountsArray']);
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_created'];
            }
        }

        /** Delete an account. */
        if ($_POST['do'] === 'delete-account' && !empty($_POST['username'])) {
            $phpMussel['FE']['User64'] = base64_encode($_POST['username']);
            $phpMussel['FE']['UserLinePos'] = strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['User64'] . ',');
            if ($phpMussel['FE']['UserLinePos'] === false) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_doesnt_exist'];
            } else {
                $phpMussel['FE']['UserLineEndPos'] = strpos($phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['UserLinePos'] + 1);
                if ($phpMussel['FE']['UserLineEndPos'] !== false) {
                    $phpMussel['FE']['UserLine'] = substr(
                        $phpMussel['FE']['UserList'],
                        $phpMussel['FE']['UserLinePos'] + 1,
                        $phpMussel['FE']['UserLineEndPos'] - $phpMussel['FE']['UserLinePos']
                    );
                    $phpMussel['FE']['UserList'] = str_replace($phpMussel['FE']['UserLine'], '', $phpMussel['FE']['UserList']);
                    $phpMussel['FE']['Rebuild'] = true;
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_deleted'];
                }
            }
            $phpMussel['FE']['UserLinePos'] = strpos($phpMussel['FE']['SessionList'], "\n" . $phpMussel['FE']['User64'] . ',');
            if ($phpMussel['FE']['UserLinePos'] !== false) {
                $phpMussel['FE']['UserLineEndPos'] = strpos($phpMussel['FE']['SessionList'], "\n", $phpMussel['FE']['UserLinePos'] + 1);
                if ($phpMussel['FE']['UserLineEndPos'] !== false) {
                    $phpMussel['FE']['SessionLine'] = substr(
                        $phpMussel['FE']['SessionList'],
                        $phpMussel['FE']['UserLinePos'] + 1,
                        $phpMussel['FE']['UserLineEndPos'] - $phpMussel['FE']['UserLinePos']
                    );
                    $phpMussel['FE']['SessionList'] = str_replace($phpMussel['FE']['SessionLine'], '', $phpMussel['FE']['SessionList']);
                    $phpMussel['FE']['Rebuild'] = true;
                }
            }
        }

        /** Update an account password. */
        if ($_POST['do'] === 'update-password' && !empty($_POST['username']) && !empty($_POST['password'])) {
            $phpMussel['FE']['User64'] = base64_encode($_POST['username']);
            $phpMussel['FE']['NewPass'] = password_hash($_POST['password'], $phpMussel['DefaultAlgo']);
            $phpMussel['FE']['UserLinePos'] = strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['User64'] . ',');
            if ($phpMussel['FE']['UserLinePos'] === false) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_doesnt_exist'];
            } else {
                $phpMussel['FE']['UserLineEndPos'] = strpos($phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['UserLinePos'] + 1);
                if ($phpMussel['FE']['UserLineEndPos'] !== false) {
                    $phpMussel['FE']['UserLine'] = substr(
                        $phpMussel['FE']['UserList'],
                        $phpMussel['FE']['UserLinePos'] + 1,
                        $phpMussel['FE']['UserLineEndPos'] - $phpMussel['FE']['UserLinePos']
                    );
                    $phpMussel['FE']['UserPerm'] = substr($phpMussel['FE']['UserLine'], -2, 1);
                    $phpMussel['FE']['NewUserLine'] =
                        $phpMussel['FE']['User64'] . ',' .
                        $phpMussel['FE']['NewPass'] . ',' .
                        $phpMussel['FE']['UserPerm'] . "\n";
                    $phpMussel['FE']['UserList'] = str_replace($phpMussel['FE']['UserLine'], $phpMussel['FE']['NewUserLine'], $phpMussel['FE']['UserList']);
                    $phpMussel['FE']['Rebuild'] = true;
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_password_updated'];
                }
            }
        }

    }

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_accounts'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_accounts']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['AccountsRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_accounts_row.html'));
    $phpMussel['FE']['Accounts'] = '';
    $phpMussel['FE']['NewLineOffset'] = 0;

    while (($phpMussel['FE']['NewLinePos'] = strpos(
        $phpMussel['FE']['UserList'], "\n", $phpMussel['FE']['NewLineOffset'] + 1
    )) !== false) {
        $phpMussel['FE']['NewLine'] = substr(
            $phpMussel['FE']['UserList'],
            $phpMussel['FE']['NewLineOffset'] + 1,
            $phpMussel['FE']['NewLinePos'] - $phpMussel['FE']['NewLineOffset'] - 1
        );
        $phpMussel['RowInfo'] = ['DelPos' => strpos($phpMussel['FE']['NewLine'], ','), 'AccWarnings' => ''];
        $phpMussel['RowInfo']['AccUsername'] = substr($phpMussel['FE']['NewLine'], 0, $phpMussel['RowInfo']['DelPos']);
        $phpMussel['RowInfo']['AccPassword'] = substr($phpMussel['FE']['NewLine'], $phpMussel['RowInfo']['DelPos'] + 1);
        $phpMussel['RowInfo']['AccPermissions'] = (
            (int)substr($phpMussel['RowInfo']['AccPassword'], -1) === 1
        ) ? $phpMussel['lang']['state_complete_access'] : $phpMussel['lang']['state_logs_access_only'];
        $phpMussel['RowInfo']['AccPassword'] = substr($phpMussel['RowInfo']['AccPassword'], 0, -2);
        if ($phpMussel['RowInfo']['AccPassword'] === $phpMussel['FE']['DefaultPassword']) {
            $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $phpMussel['lang']['state_default_password'] . '</div>';
        } elseif ((
            strlen($phpMussel['RowInfo']['AccPassword']) !== 60 && strlen($phpMussel['RowInfo']['AccPassword']) !== 96
        ) || (
            strlen($phpMussel['RowInfo']['AccPassword']) === 60 && !preg_match('/^\$2.\$[0-9]{2}\$/', $phpMussel['RowInfo']['AccPassword'])
        ) || (
            strlen($phpMussel['RowInfo']['AccPassword']) === 96 && !preg_match('/^\$argon2i\$/', $phpMussel['RowInfo']['AccPassword'])
        )) {
            $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $phpMussel['lang']['state_password_not_valid'] . '</div>';
        }
        if (strrpos($phpMussel['FE']['SessionList'], "\n" . $phpMussel['RowInfo']['AccUsername'] . ',') !== false) {
            $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtGn">' . $phpMussel['lang']['state_logged_in'] . '</div>';
        }
        $phpMussel['RowInfo']['AccUsername'] = htmlentities(base64_decode($phpMussel['RowInfo']['AccUsername']));
        $phpMussel['FE']['NewLineOffset'] = $phpMussel['FE']['NewLinePos'];
        $phpMussel['FE']['Accounts'] .= $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['RowInfo'], $phpMussel['FE']['AccountsRow']
        );
    }
    unset($phpMussel['RowInfo']);

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_accounts.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Configuration. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'config' && $phpMussel['FE']['Permissions'] === 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_config'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_config']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['ConfigRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_config_row.html'));

    /** Indexes. */
    $phpMussel['FE']['Indexes'] = '            ';

    /** Define active configuration file. */
    $phpMussel['FE']['ActiveConfigFile'] = !empty($phpMussel['Overrides']) ? $phpMussel['Domain'] . '.config.ini' : 'config.ini';

    /** Generate entries for display and regenerate configuration if any changes were submitted. */
    $phpMussel['FE']['ConfigFields'] = $phpMussel['RegenerateConfig'] = '';
    $phpMussel['ConfigModified'] = (!empty($phpMussel['QueryVars']['updated']) && $phpMussel['QueryVars']['updated'] === 'true');
    foreach ($phpMussel['Config']['Config Defaults'] as $phpMussel['CatKey'] => $phpMussel['CatValue']) {
        if (!is_array($phpMussel['CatValue'])) {
            continue;
        }
        $phpMussel['RegenerateConfig'] .= '[' . $phpMussel['CatKey'] . "]\r\n\r\n";
        foreach ($phpMussel['CatValue'] as $phpMussel['DirKey'] => $phpMussel['DirValue']) {
            $phpMussel['ThisDir'] = ['FieldOut' => ''];
            if (empty($phpMussel['DirValue']['type']) || !isset($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']])) {
                continue;
            }
            $phpMussel['ThisDir']['DirLangKey'] = 'config_' . $phpMussel['CatKey'] . '_' . $phpMussel['DirKey'];
            $phpMussel['ThisDir']['DirName'] = $phpMussel['CatKey'] . '->' . $phpMussel['DirKey'];
            $phpMussel['FE']['Indexes'] .= '<a href="#' . $phpMussel['ThisDir']['DirLangKey'] . '">' . $phpMussel['ThisDir']['DirName'] . "</a><br /><br />\n            ";
            $phpMussel['ThisDir']['DirLang'] =
                !empty($phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']]) ? $phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']] : $phpMussel['lang']['response_error'];
            $phpMussel['RegenerateConfig'] .= '; ' . wordwrap(strip_tags($phpMussel['ThisDir']['DirLang']), 77, "\r\n; ") . "\r\n";
            if (isset($_POST[$phpMussel['ThisDir']['DirLangKey']])) {
                if ($phpMussel['DirValue']['type'] === 'kb' || $phpMussel['DirValue']['type'] === 'string' || $phpMussel['DirValue']['type'] === 'timezone' || $phpMussel['DirValue']['type'] === 'int' || $phpMussel['DirValue']['type'] === 'real' || $phpMussel['DirValue']['type'] === 'bool') {
                    $phpMussel['AutoType']($_POST[$phpMussel['ThisDir']['DirLangKey']], $phpMussel['DirValue']['type']);
                }
                if (
                    !preg_match('/[^\x20-\xff"\']/', $_POST[$phpMussel['ThisDir']['DirLangKey']]) && (
                        !isset($phpMussel['DirValue']['choices']) || isset($phpMussel['DirValue']['choices'][$_POST[$phpMussel['ThisDir']['DirLangKey']]])
                    )
                ) {
                    $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] = $_POST[$phpMussel['ThisDir']['DirLangKey']];
                    $phpMussel['ConfigModified'] = true;
                }
            }
            if ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] === true) {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . "=true\r\n\r\n";
            } elseif ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] === false) {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . "=false\r\n\r\n";
            } elseif ($phpMussel['DirValue']['type'] === 'int' || $phpMussel['DirValue']['type'] === 'real') {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . '=' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . "\r\n\r\n";
            } else {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . '=\'' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . "'\r\n\r\n";
            }
            if (isset($phpMussel['DirValue']['preview'])) {
                $phpMussel['ThisDir']['Preview'] = ' = <span id="' . $phpMussel['ThisDir']['DirLangKey'] . '_preview"></span>';
                $phpMussel['ThisDir']['Trigger'] = ' onchange="javascript:' . $phpMussel['ThisDir']['DirLangKey'] . '_function();" onkeyup="javascript:' . $phpMussel['ThisDir']['DirLangKey'] . '_function();"';
                if ($phpMussel['DirValue']['preview'] === 'kb') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var e=document.g' .
                            'etElementById?document.getElementById(\'%1$s_field\').value:document.all' .
                            '&&!document.getElementById?document.all.%1$s_field.value:\'\',z=e.replac' .
                            'e(/o$/i,\'b\').substr(-2).toLowerCase(),y=\'kb\'==z?1:\'mb\'==z?1024:\'g' .
                            'b\'==z?1048576:\'tb\'==z?1073741824:\'b\'==e.substr(-1)?.0009765625:1,e=' .
                            'e.replace(/[^0-9]*$/i,\'\'),e=isNaN(e)?0:e*y,t=0>e?\'0 %2$s\':1>e?nft((1' .
                            '024*e).toFixed(0))+\' %2$s\':1024>e?nft((1*e).toFixed(2))+\' %3$s\':1048' .
                            '576>e?nft((e/1024).toFixed(2))+\' %4$s\':1073741824>e?nft((e/1048576).to' .
                            'Fixed(2))+\' %5$s\':nft((e/1073741824).toFixed(2))+\' %6$s\';document.ge' .
                            'tElementById?document.getElementById(\'%1$s_preview\').innerHTML=t:docum' .
                            'ent.all&&!document.getElementById?document.all.%1$s_preview.innerHTML=t:' .
                            '\'\'};%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['Plural'](0, $phpMussel['lang']['field_size_bytes']),
                        $phpMussel['lang']['field_size_KB'],
                        $phpMussel['lang']['field_size_MB'],
                        $phpMussel['lang']['field_size_GB'],
                        $phpMussel['lang']['field_size_TB']
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'seconds') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=document.getE' .
                            'lementById?document.getElementById(\'%1$s_field\').value:document.all&&!doc' .
                            'ument.getElementById?document.all.%1$s_field.value:\'\',e=isNaN(t)?0:0>t?t*' .
                            '-1:t,n=e?Math.floor(e/31536e3):0,e=e?e-31536e3*n:0,o=e?Math.floor(e/2592e3)' .
                            ':0,e=e-2592e3*o,l=e?Math.floor(e/604800):0,e=e-604800*l,r=e?Math.floor(e/86' .
                            '400):0,e=e-86400*r,d=e?Math.floor(e/3600):0,e=e-3600*d,i=e?Math.floor(e/60)' .
                            ':0,e=e-60*i,f=e?Math.floor(1*e):0,a=nft(n.toString())+\' %2$s – \'+nft(o.to' .
                            'String())+\' %3$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toString())+\' ' .
                            '%5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.toString())+\' %7$s – \'+nft' .
                            '(f.toString())+\' %8$s\';document.getElementById?document.getElementById(\'' .
                            '%1$s_preview\').innerHTML=a:document.all&&!document.getElementById?document' .
                            '.all.%1$s_preview.innerHTML=a:\'\'}%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds']
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'minutes') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=document.getE' .
                            'lementById?document.getElementById(\'%1$s_field\').value:document.all&&!doc' .
                            'ument.getElementById?document.all.%1$s_field.value:\'\',e=isNaN(t)?0:0>t?t*' .
                            '-1:t,n=e?Math.floor(e/525600):0,e=e?e-525600*n:0,o=e?Math.floor(e/43200):0,' .
                            'e=e-43200*o,l=e?Math.floor(e/10080):0,e=e-10080*l,r=e?Math.floor(e/1440):0,' .
                            'e=e-1440*r,d=e?Math.floor(e/60):0,e=e-60*d,i=e?Math.floor(e*1):0,e=e-i,f=e?' .
                            'Math.floor(60*e):0,a=nft(n.toString())+\' %2$s – \'+nft(o.toString())+\' %3' .
                            '$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toString())+\' %5$s – \'+nft(d' .
                            '.toString())+\' %6$s – \'+nft(i.toString())+\' %7$s – \'+nft(f.toString())+' .
                            '\' %8$s\';document.getElementById?document.getElementById(\'%1$s_preview\')' .
                            '.innerHTML=a:document.all&&!document.getElementById?document.all.%1$s_previ' .
                            'ew.innerHTML=a:\'\'}%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds']
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'hours') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=document.getE' .
                            'lementById?document.getElementById(\'%1$s_field\').value:document.all&&!doc' .
                            'ument.getElementById?document.all.%1$s_field.value:\'\',e=isNaN(t)?0:0>t?t*' .
                            '-1:t,n=e?Math.floor(e/8760):0,e=e?e-8760*n:0,o=e?Math.floor(e/720):0,e=e-72' .
                            '0*o,l=e?Math.floor(e/168):0,e=e-168*l,r=e?Math.floor(e/24):0,e=e-24*r,d=e?M' .
                            'ath.floor(e*1):0,e=e-d,i=e?Math.floor(60*e):0,e=e-(i/60),f=e?Math.floor(360' .
                            '0*e):0,a=nft(n.toString())+\' %2$s – \'+nft(o.toString())+\' %3$s – \'+nft(' .
                            'l.toString())+\' %4$s – \'+nft(r.toString())+\' %5$s – \'+nft(d.toString())' .
                            '+\' %6$s – \'+nft(i.toString())+\' %7$s – \'+nft(f.toString())+\' %8$s\';do' .
                            'cument.getElementById?document.getElementById(\'%1$s_preview\').innerHTML=a' .
                            ':document.all&&!document.getElementById?document.all.%1$s_preview.innerHTML' .
                            '=a:\'\'}%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds']
                    );
                }
            } else {
                $phpMussel['ThisDir']['Preview'] = $phpMussel['ThisDir']['Trigger'] = '';
            }
            if ($phpMussel['DirValue']['type'] === 'timezone') {
                $phpMussel['DirValue']['choices'] = ['SYSTEM' => $phpMussel['lang']['field_system_timezone']];
                foreach (array_unique(DateTimeZone::listIdentifiers()) as $phpMussel['DirValue']['ChoiceValue']) {
                    $phpMussel['DirValue']['choices'][$phpMussel['DirValue']['ChoiceValue']] = $phpMussel['DirValue']['ChoiceValue'];
                }
            }
            if (isset($phpMussel['DirValue']['choices'])) {
                $phpMussel['ThisDir']['FieldOut'] = '<select class="auto" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field"' . $phpMussel['ThisDir']['Trigger'] . '>';
                foreach ($phpMussel['DirValue']['choices'] as $phpMussel['ChoiceKey'] => $phpMussel['ChoiceValue']) {
                    if (isset($phpMussel['DirValue']['choice_filter']) && isset($phpMussel[$phpMussel['DirValue']['choice_filter']])) {
                        if (!$phpMussel[$phpMussel['DirValue']['choice_filter']]($phpMussel['ChoiceKey'], $phpMussel['ChoiceValue'])) {
                            continue;
                        }
                    }
                    if (strpos($phpMussel['ChoiceValue'], '{') !== false) {
                        $phpMussel['ChoiceValue'] = $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['ChoiceValue']);
                        if (strpos($phpMussel['ChoiceValue'], '{') !== false) {
                            $phpMussel['ChoiceValue'] = $phpMussel['ParseVars']($phpMussel['lang'], $phpMussel['ChoiceValue']);
                        }
                    }
                    $phpMussel['ThisDir']['FieldOut'] .= ($phpMussel['ChoiceKey'] === $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']]) ?
                        '<option value="' . $phpMussel['ChoiceKey'] . '" selected>' . $phpMussel['ChoiceValue'] . '</option>'
                    :
                        '<option value="' . $phpMussel['ChoiceKey'] . '">' . $phpMussel['ChoiceValue'] . '</option>';
                }
                $phpMussel['ThisDir']['FieldOut'] .= '</select>';
            } elseif ($phpMussel['DirValue']['type'] === 'bool') {
                if ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']]) {
                    $phpMussel['ThisDir']['FieldOut'] =
                        '<select class="auto" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field"' . $phpMussel['ThisDir']['Trigger'] . '>' .
                        '<option value="true" selected>' . $phpMussel['lang']['field_true'] . '</option><option value="false">' . $phpMussel['lang']['field_false'] . '</option>' .
                        '</select>';
                } else {
                    $phpMussel['ThisDir']['FieldOut'] =
                        '<select class="auto" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field"' . $phpMussel['ThisDir']['Trigger'] . '>' .
                        '<option value="true">' . $phpMussel['lang']['field_true'] . '</option><option value="false" selected>' . $phpMussel['lang']['field_false'] . '</option>' .
                        '</select>';
                }
            } elseif ($phpMussel['DirValue']['type'] === 'int' || $phpMussel['DirValue']['type'] === 'real') {
                $phpMussel['ThisDir']['Step'] = isset($phpMussel['DirValue']['step']) ? ' step="' . $phpMussel['DirValue']['step'] . '"' : '';
                $phpMussel['ThisDir']['FieldOut'] = '<input type="number" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field" value="' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '"' . $phpMussel['ThisDir']['Step'] . $phpMussel['ThisDir']['Trigger'] . ' />';
            } elseif ($phpMussel['DirValue']['type'] === 'string') {
                $phpMussel['ThisDir']['FieldOut'] = '<textarea name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field" class="half"' . $phpMussel['ThisDir']['Trigger'] . '>' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '</textarea>';
            } else {
                $phpMussel['ThisDir']['FieldOut'] = '<input type="text" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" id="'. $phpMussel['ThisDir']['DirLangKey'] . '_field" value="' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '"' . $phpMussel['ThisDir']['Trigger'] . ' />';
            }
            $phpMussel['ThisDir']['FieldOut'] .= $phpMussel['ThisDir']['Preview'];
            $phpMussel['FE']['ConfigFields'] .= $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['ThisDir'], $phpMussel['FE']['ConfigRow']
            );
        }
        $phpMussel['RegenerateConfig'] .= "\r\n";
    }

    /** Update the configuration file if any changes were made. */
    if ($phpMussel['ConfigModified']) {
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_configuration_updated'];
        $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'config.ini', 'w');
        fwrite($phpMussel['Handle'], $phpMussel['RegenerateConfig']);
        fclose($phpMussel['Handle']);
        if (empty($phpMussel['QueryVars']['updated'])) {
            header('Location: ?phpmussel-page=config&updated=true');
            die;
        }
    }

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_config.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Updates. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'updates' && $phpMussel['FE']['Permissions'] === 1) {

    $phpMussel['FE']['UpdatesFormTarget'] = 'phpmussel-page=updates';
    $phpMussel['FE']['UpdatesFormTargetControls'] = '';
    $phpMussel['StateModified'] = false;
    $phpMussel['FilterSwitch'](
        ['hide-non-outdated', 'hide-unused'],
        isset($_POST['FilterSelector']) ? $_POST['FilterSelector'] : '',
        $phpMussel['StateModified'],
        $phpMussel['FE']['UpdatesFormTarget'],
        $phpMussel['FE']['UpdatesFormTargetControls']
    );
    if ($phpMussel['StateModified']) {
        header('Location: ?' . $phpMussel['FE']['UpdatesFormTarget']);
        die;
    }
    unset($phpMussel['StateModified']);

    /** Prepare components metadata working array. */
    $phpMussel['Components'] = ['Meta' => [], 'RemoteMeta' => []];

    /** Fetch components lists. */
    $phpMussel['FetchComponentsLists']($phpMussel['Vault'], $phpMussel['Components']['Meta']);

    /** Cleanup. */
    unset($phpMussel['Components']['Files']);

    /** Indexes. */
    $phpMussel['FE']['Indexes'] = [];

    /** A form has been submitted. */
    if ($phpMussel['FE']['FormTarget'] === 'updates' && !empty($_POST['do'])) {

        /** Update a component. */
        if ($_POST['do'] === 'update-component' && !empty($_POST['ID'])) {
            $phpMussel['Components']['Target'] = $_POST['ID'];
            $phpMussel['Arrayify']($phpMussel['Components']['Target']);
            $phpMussel['FileData'] = [];
            $phpMussel['Annotations'] = [];
            foreach ($phpMussel['Components']['Target'] as $phpMussel['Components']['ThisTarget']) {
                if (
                    !isset($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote']) ||
                    !isset($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Reannotate'])
                ) {
                    continue;
                }
                $phpMussel['Components']['BytesAdded'] = 0;
                $phpMussel['Components']['BytesRemoved'] = 0;
                $phpMussel['Components']['TimeRequired'] = microtime(true);
                $phpMussel['Components']['RemoteMeta'] = [];
                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = $phpMussel['FECacheGet'](
                    $phpMussel['FE']['Cache'],
                    $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote']
                );
                if (!$phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']) {
                    $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = $phpMussel['Request'](
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote']
                    );
                    if (
                        strtolower(substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote'], -2)) === 'gz' &&
                        substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 0, 2) === "\x1f\x8b"
                    ) {
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = gzdecode(
                            $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']
                        );
                    }
                    if (empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'])) {
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'] = '-';
                    }
                    $phpMussel['FECacheAdd'](
                        $phpMussel['FE']['Cache'],
                        $phpMussel['FE']['Rebuild'],
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Remote'],
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'],
                        $phpMussel['Time'] + 3600
                    );
                }
                $phpMussel['UpdateFailed'] = false;
                if (
                    substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 0, 4) === "---\n" &&
                    ($phpMussel['Components']['EoYAML'] = strpos(
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], "\n\n"
                    )) !== false &&
                    $phpMussel['YAML'](
                        substr($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'], 4, $phpMussel['Components']['EoYAML'] - 4),
                        $phpMussel['Components']['RemoteMeta']
                    ) &&
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required']) &&
                    !$phpMussel['VersionCompare'](
                        $phpMussel['ScriptVersion'],
                        $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required']
                    ) &&
                    (
                        empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required PHP']) ||
                        !$phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Minimum Required PHP'])
                    ) &&
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']) &&
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']) &&
                    !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
                    $phpMussel['Traverse']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
                    ($phpMussel['ThisReannotate'] = $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Reannotate']) &&
                    file_exists($phpMussel['Vault'] . $phpMussel['ThisReannotate']) &&
                    ((
                        !empty($phpMussel['FileData'][$phpMussel['ThisReannotate']]) &&
                        $phpMussel['Components']['OldMeta'] = $phpMussel['FileData'][$phpMussel['ThisReannotate']]
                    ) || (
                        $phpMussel['FileData'][$phpMussel['ThisReannotate']] = $phpMussel['Components']['OldMeta'] = $phpMussel['ReadFile'](
                            $phpMussel['Vault'] . $phpMussel['ThisReannotate']
                        )
                    )) &&
                    preg_match(
                        "\x01(\n" . preg_quote($phpMussel['Components']['ThisTarget']) . ":?)(\n [^\n]*)*\n\x01i",
                        $phpMussel['Components']['OldMeta'],
                        $phpMussel['Components']['OldMetaMatches']
                    ) &&
                    ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0]) &&
                    ($phpMussel['Components']['NewMeta'] = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData']) &&
                    preg_match(
                        "\x01(\n" . preg_quote($phpMussel['Components']['ThisTarget']) . ":?)(\n [^\n]*)*\n\x01i",
                        $phpMussel['Components']['NewMeta'],
                        $phpMussel['Components']['NewMetaMatches']
                    ) &&
                    ($phpMussel['Components']['NewMetaMatches'] = $phpMussel['Components']['NewMetaMatches'][0])
                ) {
                    $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']);
                    $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']);
                    $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']);
                    if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'])) {
                        $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum']);
                    }
                    $phpMussel['Components']['NewMeta'] = str_replace(
                        $phpMussel['Components']['OldMetaMatches'],
                        $phpMussel['Components']['NewMetaMatches'],
                        $phpMussel['Components']['OldMeta']
                    );
                    $phpMussel['Count'] = count($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From']);
                    $phpMussel['RemoteFiles'] = [];
                    $phpMussel['IgnoredFiles'] = [];
                    $phpMussel['Rollback'] = false;
                    /** Write new and updated files and directories. */
                    for ($phpMussel['Iterate'] = 0; $phpMussel['Iterate'] < $phpMussel['Count']; $phpMussel['Iterate']++) {
                        if (empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'][$phpMussel['Iterate']])) {
                            continue;
                        }
                        $phpMussel['ThisFileName'] = $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'][$phpMussel['Iterate']];
                        /** Rolls back to previous version or uninstalls if an update/install fails. */
                        if ($phpMussel['Rollback']) {
                            if (
                                isset($phpMussel['RemoteFiles'][$phpMussel['ThisFileName']]) &&
                                !isset($phpMussel['IgnoredFiles'][$phpMussel['ThisFileName']]) &&
                                is_readable($phpMussel['Vault'] . $phpMussel['ThisFileName'])
                            ) {
                                $phpMussel['Components']['BytesAdded'] -= filesize($phpMussel['Vault'] . $phpMussel['ThisFileName']);
                                unlink($phpMussel['Vault'] . $phpMussel['ThisFileName']);
                                if (is_readable($phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback')) {
                                    $phpMussel['Components']['BytesRemoved'] -= filesize($phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback');
                                    rename($phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback', $phpMussel['Vault'] . $phpMussel['ThisFileName']);
                                }
                            }
                            continue;
                        }
                        if (
                            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']]) &&
                            !empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']]) && (
                                $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']] ===
                                $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']]
                            )
                        ) {
                            $phpMussel['IgnoredFiles'][$phpMussel['ThisFileName']] = true;
                            continue;
                        }
                        if (
                            empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$phpMussel['Iterate']]) ||
                            !($phpMussel['ThisFile'] = $phpMussel['Request'](
                                $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$phpMussel['Iterate']]
                            ))
                        ) {
                            $phpMussel['Iterate'] = 0;
                            $phpMussel['Rollback'] = true;
                            continue;
                        }
                        if (
                            strtolower(substr(
                                $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['From'][$phpMussel['Iterate']], -2
                            )) === 'gz' &&
                            strtolower(substr($phpMussel['ThisFileName'], -2)) !== 'gz' &&
                            substr($phpMussel['ThisFile'], 0, 2) === "\x1f\x8b"
                        ) {
                            $phpMussel['ThisFile'] = gzdecode($phpMussel['ThisFile']);
                        }
                        if (
                            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']]) &&
                                $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['Checksum'][$phpMussel['Iterate']] !==
                                md5($phpMussel['ThisFile']) . ':' . strlen($phpMussel['ThisFile'])
                        ) {
                            $phpMussel['FE']['state_msg'] .=
                                '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ' .
                                '<code>' . $phpMussel['ThisFileName'] . '</code> – ' .
                                $phpMussel['lang']['response_checksum_error'] . '<br />';
                            if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Checksum Error'])) {
                                $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['On Checksum Error']);
                            }
                            $phpMussel['Iterate'] = 0;
                            $phpMussel['Rollback'] = true;
                            continue;
                        }
                        $phpMussel['ThisName'] = $phpMussel['ThisFileName'];
                        $phpMussel['ThisPath'] = $phpMussel['Vault'];
                        while (strpos($phpMussel['ThisName'], '/') !== false || strpos($phpMussel['ThisName'], "\\") !== false) {
                            $phpMussel['Separator'] = (strpos($phpMussel['ThisName'], '/') !== false) ? '/' : "\\";
                            $phpMussel['ThisDir'] = substr($phpMussel['ThisName'], 0, strpos($phpMussel['ThisName'], $phpMussel['Separator']));
                            $phpMussel['ThisPath'] .= $phpMussel['ThisDir'] . '/';
                            $phpMussel['ThisName'] = substr($phpMussel['ThisName'], strlen($phpMussel['ThisDir']) + 1);
                            if (!file_exists($phpMussel['ThisPath']) || !is_dir($phpMussel['ThisPath'])) {
                                mkdir($phpMussel['ThisPath']);
                            }
                        }
                        if (is_readable($phpMussel['Vault'] . $phpMussel['ThisFileName'])) {
                            $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $phpMussel['ThisFileName']);
                            if (file_exists($phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback')) {
                                unlink($phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback');
                            }
                            rename($phpMussel['Vault'] . $phpMussel['ThisFileName'], $phpMussel['Vault'] . $phpMussel['ThisFileName'] . '.rollback');
                        }
                        $phpMussel['Components']['BytesAdded'] += strlen($phpMussel['ThisFile']);
                        $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['ThisFileName'], 'w');
                        $phpMussel['RemoteFiles'][$phpMussel['ThisFileName']] = fwrite($phpMussel['Handle'], $phpMussel['ThisFile']);
                        $phpMussel['RemoteFiles'][$phpMussel['ThisFileName']] = ($phpMussel['RemoteFiles'][$phpMussel['ThisFileName']] !== false);
                        fclose($phpMussel['Handle']);
                        $phpMussel['ThisFile'] = '';
                    }
                    if ($phpMussel['Rollback']) {
                        /** Prune unwanted empty directories (update/install failure+rollback). */
                        if (
                            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To']) &&
                            is_array($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'])
                        ) {
                            array_walk($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                                if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                                    $phpMussel['DeleteDirectory']($ThisFile);
                                }
                            });
                        }
                        $phpMussel['UpdateFailed'] = true;
                    } else {
                        /** Prune unwanted files and directories (update/install success). */
                        if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['To'])) {
                            $phpMussel['ThisArr'] = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files']['To'];
                            $phpMussel['Arrayify']($phpMussel['ThisArr']);
                            array_walk($phpMussel['ThisArr'], function ($ThisFile) use (&$phpMussel) {
                                if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                                    if (file_exists($phpMussel['Vault'] . $ThisFile . '.rollback')) {
                                        unlink($phpMussel['Vault'] . $ThisFile . '.rollback');
                                    }
                                    if (
                                        !isset($phpMussel['RemoteFiles'][$ThisFile]) &&
                                        !isset($phpMussel['IgnoredFiles'][$ThisFile]) &&
                                        file_exists($phpMussel['Vault'] . $ThisFile)
                                    ) {
                                        $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile);
                                        unlink($phpMussel['Vault'] . $ThisFile);
                                        $phpMussel['DeleteDirectory']($ThisFile);
                                    }
                                }
                            });
                            unset($phpMussel['ThisArr']);
                        }
                        /** Assign updated component annotation. */
                        $phpMussel['FileData'][$phpMussel['ThisReannotate']] = $phpMussel['Components']['NewMeta'];
                        if (!isset($phpMussel['Annotations'][$phpMussel['ThisReannotate']])) {
                            $phpMussel['Annotations'][$phpMussel['ThisReannotate']] = $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['RemoteData'];
                        }
                        $phpMussel['FE']['state_msg'] .= '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ';
                        if (
                            empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Version']) &&
                            empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files'])
                        ) {
                            $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_component_successfully_installed'];
                            if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Succeeds'])) {
                                $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Succeeds']);
                            }
                        } else {
                            $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_component_successfully_updated'];
                            if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Succeeds'])) {
                                $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Succeeds']);
                            }
                        }
                        $phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']] =
                            $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisTarget']];
                    }
                } else {
                    $phpMussel['UpdateFailed'] = true;
                }
                if ($phpMussel['UpdateFailed']) {
                    $phpMussel['FE']['state_msg'] .= '<code>' . $phpMussel['Components']['ThisTarget'] . '</code> – ';
                    if (
                        empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Version']) &&
                        empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['Files'])
                    ) {
                        $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_failed_to_install'];
                        if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Fails'])) {
                            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Install Fails']);
                        }
                    } else {
                        $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_failed_to_update'];
                        if (!empty($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Fails'])) {
                            $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$phpMussel['Components']['ThisTarget']]['When Update Fails']);
                        }
                    }
                }
                $phpMussel['FormatFilesize']($phpMussel['Components']['BytesAdded']);
                $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
                $phpMussel['FE']['state_msg'] .= sprintf(
                    ' <code><span class="txtGn">+%s</span> | <span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code><br />',
                    $phpMussel['Components']['BytesAdded'],
                    $phpMussel['Components']['BytesRemoved'],
                    $phpMussel['Number_L10N'](microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
                );
            }
            /** Update annotations. */
            foreach ($phpMussel['FileData'] as $phpMussel['ThisKey'] => $phpMussel['ThisFile']) {
                /** Remove superfluous metadata. */
                if (!empty($phpMussel['Annotations'][$phpMussel['ThisKey']])) {
                    $phpMussel['ThisFile'] = $phpMussel['Congruency']($phpMussel['ThisFile'], $phpMussel['Annotations'][$phpMussel['ThisKey']]);
                }
                $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['ThisKey'], 'w');
                fwrite($phpMussel['Handle'], $phpMussel['ThisFile']);
                fclose($phpMussel['Handle']);
            }
            /** Cleanup. */
            unset(
                $phpMussel['ThisPath'],
                $phpMussel['ThisName'],
                $phpMussel['ThisKey'],
                $phpMussel['ThisFile'],
                $phpMussel['Annotations'],
                $phpMussel['FileData'],
                $phpMussel['ThisFileName'],
                $phpMussel['Rollback'],
                $phpMussel['IgnoredFiles'],
                $phpMussel['RemoteFiles'],
                $phpMussel['ThisReannotate']
            );
        }

        /** Uninstall a component. */
        if ($_POST['do'] === 'uninstall-component' && !empty($_POST['ID'])) {
            $phpMussel['ComponentFunctionUpdatePrep']();
            $phpMussel['Components']['BytesRemoved'] = 0;
            $phpMussel['Components']['TimeRequired'] = microtime(true);
            if (
                empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['InUse']) &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To']) &&
                ($_POST['ID'] !== 'l10n/' . $phpMussel['Config']['general']['lang']) &&
                ($_POST['ID'] !== 'theme/' . $phpMussel['Config']['template_data']['theme']) &&
                ($_POST['ID'] !== 'phpMussel') &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Reannotate']) &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Uninstallable']) &&
                ($phpMussel['Components']['OldMeta'] = $phpMussel['ReadFile'](
                    $phpMussel['Vault'] . $phpMussel['Components']['Meta'][$_POST['ID']]['Reannotate']
                )) &&
                preg_match(
                    "\x01(\n" . preg_quote($_POST['ID']) . ":?)(\n [^\n]*)*\n\x01i",
                    $phpMussel['Components']['OldMeta'],
                    $phpMussel['Components']['OldMetaMatches']
                ) &&
                ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0])
            ) {
                $phpMussel['Components']['NewMeta'] = str_replace(
                    $phpMussel['Components']['OldMetaMatches'],
                    preg_replace(
                        ["/\n Files:(\n  [^\n]*)*\n/i", "/\n Version: [^\n]*\n/i"],
                        "\n",
                        $phpMussel['Components']['OldMetaMatches']
                    ),
                    $phpMussel['Components']['OldMeta']
                );
                array_walk($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                    if (!empty($ThisFile) && $phpMussel['Traverse']($ThisFile)) {
                        if (file_exists($phpMussel['Vault'] . $ThisFile)) {
                            $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile);
                            unlink($phpMussel['Vault'] . $ThisFile);
                        }
                        if (file_exists($phpMussel['Vault'] . $ThisFile . '.rollback')) {
                            $phpMussel['Components']['BytesRemoved'] += filesize($phpMussel['Vault'] . $ThisFile . '.rollback');
                            unlink($phpMussel['Vault'] . $ThisFile . '.rollback');
                        }
                        $phpMussel['DeleteDirectory']($ThisFile);
                    }
                });
                $phpMussel['Handle'] =
                    fopen($phpMussel['Vault'] . $phpMussel['Components']['Meta'][$_POST['ID']]['Reannotate'], 'w');
                fwrite($phpMussel['Handle'], $phpMussel['Components']['NewMeta']);
                fclose($phpMussel['Handle']);
                $phpMussel['Components']['Meta'][$_POST['ID']]['Version'] = false;
                $phpMussel['Components']['Meta'][$_POST['ID']]['Files'] = false;
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_successfully_uninstalled'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Uninstall Succeeds'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Uninstall Succeeds']);
                }
            } else {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_uninstall_error'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Uninstall Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Uninstall Fails']);
                }
            }
            $phpMussel['FormatFilesize']($phpMussel['Components']['BytesRemoved']);
            $phpMussel['FE']['state_msg'] .= sprintf(
                ' <code><span class="txtRd">-%s</span> | <span class="txtOe">%s</span></code>',
                $phpMussel['Components']['BytesRemoved'],
                $phpMussel['Number_L10N'](microtime(true) - $phpMussel['Components']['TimeRequired'], 3)
            );
        }

        /** Activate a component. */
        if ($_POST['do'] === 'activate-component' && !empty($_POST['ID'])) {
            $phpMussel['Activation'] = [
                'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . 'config.ini'),
                'Active' => $phpMussel['Config']['signatures']['Active'],
                'Modified' => false
            ];
            $phpMussel['ComponentFunctionUpdatePrep']();
            if (
                empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['InUse']) &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'])
            ) {
                $phpMussel['Activation']['Active'] = array_unique(array_filter(
                    explode(',', $phpMussel['Activation']['Active']),
                    function ($Component) use (&$phpMussel) {
                        return ($Component && file_exists($phpMussel['sigPath'] . $Component));
                    }
                ));
                foreach ($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'] as $phpMussel['Activation']['ThisFile']) {
                    if (
                        !empty($phpMussel['Activation']['ThisFile']) &&
                        file_exists($phpMussel['Vault'] . $phpMussel['Activation']['ThisFile']) &&
                        substr($phpMussel['Activation']['ThisFile'], 0, 11) === 'signatures/' &&
                        $phpMussel['Traverse']($phpMussel['Activation']['ThisFile'])
                    ) {
                        $phpMussel['Activation']['Active'][] = substr($phpMussel['Activation']['ThisFile'], 11);
                    }
                }
                if (count($phpMussel['Activation']['Active'])) {
                    sort($phpMussel['Activation']['Active']);
                }
                $phpMussel['Activation']['Active'] = implode(',', $phpMussel['Activation']['Active']);
                if ($phpMussel['Activation']['Active'] !== $phpMussel['Config']['signatures']['Active']) {
                    $phpMussel['Activation']['Modified'] = true;
                }
            }
            if (!$phpMussel['Activation']['Modified'] || !$phpMussel['Activation']['Config']) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_activation_failed'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Activation Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Activation Fails']);
                }
            } else {
                $phpMussel['Activation']['Config'] = str_replace(
                    "\r\nActive='" . $phpMussel['Config']['signatures']['Active'] . "'\r\n",
                    "\r\nActive='" . $phpMussel['Activation']['Active'] . "'\r\n",
                    $phpMussel['Activation']['Config']
                );
                $phpMussel['Config']['signatures']['Active'] = $phpMussel['Activation']['Active'];
                $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'config.ini', 'w');
                fwrite($phpMussel['Handle'], $phpMussel['Activation']['Config']);
                fclose($phpMussel['Handle']);
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_activated'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Activation Succeeds'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Activation Succeeds']);
                }
            }
            unset($phpMussel['Activation']);
        }

        /** Deactivate a component. */
        if ($_POST['do'] === 'deactivate-component' && !empty($_POST['ID'])) {
            $phpMussel['Deactivation'] = [
                'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . 'config.ini'),
                'Active' => $phpMussel['Config']['signatures']['Active'],
                'Modified' => false
            ];
            $phpMussel['ComponentFunctionUpdatePrep']();
            if (
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['InUse']) &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'])
            ) {
                $phpMussel['Deactivation']['Active'] = array_unique(array_filter(
                    explode(',', $phpMussel['Deactivation']['Active']),
                    function ($Component) use (&$phpMussel) {
                        return ($Component && file_exists($phpMussel['sigPath'] . $Component));
                    }
                ));
                if (count($phpMussel['Deactivation']['Active'])) {
                    sort($phpMussel['Deactivation']['Active']);
                }
                $phpMussel['Deactivation']['Active'] = ',' . implode(',', $phpMussel['Deactivation']['Active']) . ',';
                foreach ($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'] as $phpMussel['Deactivation']['ThisFile']) {
                    if (substr($phpMussel['Deactivation']['ThisFile'], 0, 11) === 'signatures/') {
                        $phpMussel['Deactivation']['Active'] =
                            str_replace(',' . substr($phpMussel['Deactivation']['ThisFile'], 11) . ',', ',', $phpMussel['Deactivation']['Active']);
                    }
                }
                $phpMussel['Deactivation']['Active'] = substr($phpMussel['Deactivation']['Active'], 1, -1);
                if ($phpMussel['Deactivation']['Active'] !== $phpMussel['Config']['signatures']['Active']) {
                    $phpMussel['Deactivation']['Modified'] = true;
                }
            }
            if (!$phpMussel['Deactivation']['Modified'] || !$phpMussel['Deactivation']['Config']) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_deactivation_failed'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Deactivation Fails'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Deactivation Fails']);
                }
            } else {
                $phpMussel['Deactivation']['Config'] = str_replace(
                    "\r\nActive='" . $phpMussel['Config']['signatures']['Active'] . "'\r\n",
                    "\r\nActive='" . $phpMussel['Deactivation']['Active'] . "'\r\n",
                    $phpMussel['Deactivation']['Config']
                );
                $phpMussel['Config']['signatures']['Active'] = $phpMussel['Deactivation']['Active'];
                $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'config.ini', 'w');
                fwrite($phpMussel['Handle'], $phpMussel['Deactivation']['Config']);
                fclose($phpMussel['Handle']);
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_deactivated'];
                if (!empty($phpMussel['Components']['Meta'][$_POST['ID']]['When Deactivation Succeeds'])) {
                    $phpMussel['FE_Executor']($phpMussel['Components']['Meta'][$_POST['ID']]['When Deactivation Succeeds']);
                }
            }
            unset($phpMussel['Deactivation']);
        }

    }

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_updates'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_updates']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['UpdatesRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_updates_row.html'));

    $phpMussel['Components'] = [
        'Meta' => $phpMussel['Components']['Meta'],
        'RemoteMeta' => $phpMussel['Components']['RemoteMeta'],
        'Remotes' => [],
        'Dependencies' => [],
        'Outdated' => [],
        'Out' => []
    ];

    /** Prepare installed component metadata and options for display. */
    foreach ($phpMussel['Components']['Meta'] as $phpMussel['Components']['Key'] => &$phpMussel['Components']['ThisComponent']) {
        if (empty($phpMussel['Components']['ThisComponent']['Name']) && empty($phpMussel['lang']['Name: ' . $phpMussel['Components']['Key']])) {
            $phpMussel['Components']['ThisComponent'] = '';
            continue;
        }
        $phpMussel['PrepareName']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
        $phpMussel['PrepareExtendedDescription']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
        $phpMussel['Components']['ThisComponent']['ID'] = $phpMussel['Components']['Key'];
        $phpMussel['Components']['ThisComponent']['Options'] = '';
        $phpMussel['Components']['ThisComponent']['StatusOptions'] = '';
        $phpMussel['Components']['ThisComponent']['StatClass'] = '';
        if (empty($phpMussel['Components']['ThisComponent']['Version'])) {
            if (empty($phpMussel['Components']['ThisComponent']['Files']['To'])) {
                $phpMussel['Components']['ThisComponent']['RowClass'] = 'h2';
                $phpMussel['Components']['ThisComponent']['Version'] = $phpMussel['lang']['response_updates_not_installed'];
                $phpMussel['Components']['ThisComponent']['StatClass'] = 'txtRd';
                $phpMussel['Components']['ThisComponent']['StatusOptions'] = $phpMussel['lang']['response_updates_not_installed'];
            } else {
                $phpMussel['Components']['ThisComponent']['Version'] = $phpMussel['lang']['response_updates_unable_to_determine'];
                $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
            }
        }
        if (empty($phpMussel['Components']['ThisComponent']['Remote'])) {
            $phpMussel['Components']['ThisComponent']['RemoteData'] = $phpMussel['lang']['response_updates_unable_to_determine'];
            if (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
            }
        } else {
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']);
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['To']);
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['From']);
            if (isset($phpMussel['Components']['ThisComponent']['Files']['Checksum'])) {
                $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['Checksum']);
            }
            $phpMussel['FetchRemote']();
            if (
                substr($phpMussel['Components']['ThisComponent']['RemoteData'], 0, 4) === "---\n" &&
                ($phpMussel['Components']['EoYAML'] = strpos(
                    $phpMussel['Components']['ThisComponent']['RemoteData'], "\n\n"
                )) !== false
            ) {
                if (!isset($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']])) {
                    $phpMussel['YAML'](
                        substr($phpMussel['Components']['ThisComponent']['RemoteData'], 4, $phpMussel['Components']['EoYAML'] - 4),
                        $phpMussel['Components']['RemoteMeta']
                    );
                }
                if (isset($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Version'])) {
                    $phpMussel['Components']['ThisComponent']['Latest'] =
                        $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Version'];
                } else {
                    if (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                        $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
                    }
                }
            } elseif (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
            }
            if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Name'])) {
                $phpMussel['Components']['ThisComponent']['Name'] =
                    $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Name'];
                $phpMussel['PrepareName']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
            }
            if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Extended Description'])) {
                $phpMussel['Components']['ThisComponent']['Extended Description'] =
                    $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Extended Description'];
                $phpMussel['PrepareExtendedDescription']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
            }
            if (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                if (
                    !empty($phpMussel['Components']['ThisComponent']['Latest']) &&
                    $phpMussel['VersionCompare'](
                        $phpMussel['Components']['ThisComponent']['Version'],
                        $phpMussel['Components']['ThisComponent']['Latest']
                    )
                ) {
                    $phpMussel['Components']['ThisComponent']['Outdated'] = true;
                    if (
                        $phpMussel['Components']['Key'] === 'l10n/' . $phpMussel['Config']['general']['lang'] ||
                        $phpMussel['Components']['Key'] === 'theme/' . $phpMussel['Config']['template_data']['theme']
                    ) {
                        $phpMussel['Components']['Dependencies'][] = $phpMussel['Components']['Key'];
                    }
                    $phpMussel['Components']['Outdated'][] = $phpMussel['Components']['Key'];
                    $phpMussel['Components']['ThisComponent']['RowClass'] = 'r';
                    $phpMussel['Components']['ThisComponent']['StatClass'] = 'txtRd';
                    if (
                        empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required']) ||
                        $phpMussel['VersionCompare'](
                            $phpMussel['ScriptVersion'],
                            $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required']
                        )
                    ) {
                        $phpMussel['Components']['ThisComponent']['StatusOptions'] =
                            $phpMussel['lang']['response_updates_outdated_manually'];
                    } elseif (
                        !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']) &&
                        $phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP'])
                    ) {
                        $phpMussel['Components']['ThisComponent']['StatusOptions'] = $phpMussel['ParseVars'](
                            ['V' => $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']],
                            $phpMussel['lang']['response_updates_outdated_php_version']
                        );
                    } else {
                        $phpMussel['Components']['ThisComponent']['StatusOptions'] =
                            $phpMussel['lang']['response_updates_outdated'];
                        $phpMussel['Components']['ThisComponent']['Options'] .=
                            '<option value="update-component">' . $phpMussel['lang']['field_update'] . '</option>';
                    }
                } else {
                    $phpMussel['Components']['ThisComponent']['StatClass'] = 'txtGn';
                    $phpMussel['Components']['ThisComponent']['StatusOptions'] =
                        $phpMussel['lang']['response_updates_already_up_to_date'];
                }
            }
            if (!empty($phpMussel['Components']['ThisComponent']['Files']['To'])) {
                $phpMussel['Activable'] = (
                    !empty($phpMussel['Components']['ThisComponent']['Files']['To'][0]) &&
                    substr($phpMussel['Components']['ThisComponent']['Files']['To'][0], 0, 11) === 'signatures/'
                );
                if (
                    ($phpMussel['Components']['Key'] === 'l10n/' . $phpMussel['Config']['general']['lang']) ||
                    ($phpMussel['Components']['Key'] === 'theme/' . $phpMussel['Config']['template_data']['theme']) ||
                    ($phpMussel['Components']['Key'] === 'phpMussel') ||
                    $phpMussel['IsInUse']($phpMussel['Components']['ThisComponent']['Files']['To'])
                ) {
                    $phpMussel['AppendToString']($phpMussel['Components']['ThisComponent']['StatusOptions'], '<hr />',
                        '<div class="txtGn">' . $phpMussel['lang']['state_component_is_active'] . '</div>'
                    );
                    if ($phpMussel['Activable']) {
                        $phpMussel['Components']['ThisComponent']['Options'] .=
                            '<option value="deactivate-component">' . $phpMussel['lang']['field_deactivate'] . '</option>';
                    }
                } else {
                    if ($phpMussel['Activable']) {
                        $phpMussel['Components']['ThisComponent']['Options'] .=
                            '<option value="activate-component">' . $phpMussel['lang']['field_activate'] . '</option>';
                    }
                    if (!empty($phpMussel['Components']['ThisComponent']['Uninstallable'])) {
                        $phpMussel['Components']['ThisComponent']['Options'] .=
                            '<option value="uninstall-component">' . $phpMussel['lang']['field_uninstall'] . '</option>';
                    }
                    if (!empty($phpMussel['Components']['ThisComponent']['Provisional'])) {
                        $phpMussel['AppendToString']($phpMussel['Components']['ThisComponent']['StatusOptions'], '<hr />',
                            '<div class="txtOe">' . $phpMussel['lang']['state_component_is_provisional'] . '</div>'
                        );
                    } else {
                        $phpMussel['AppendToString']($phpMussel['Components']['ThisComponent']['StatusOptions'], '<hr />',
                            '<div class="txtRd">' . $phpMussel['lang']['state_component_is_inactive'] . '</div>'
                        );
                    }
                }
            }
        }
        if (empty($phpMussel['Components']['ThisComponent']['Latest'])) {
            $phpMussel['Components']['ThisComponent']['Latest'] = $phpMussel['lang']['response_updates_unable_to_determine'];
        } elseif (
            empty($phpMussel['Components']['ThisComponent']['Files']['To']) &&
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Files']['To'])
        ) {
            if (
                empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']) ||
                !$phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP'])
            ) {
                $phpMussel['Components']['ThisComponent']['Options'] .=
                    '<option value="update-component">' . $phpMussel['lang']['field_install'] . '</option>';
            } elseif ($phpMussel['Components']['ThisComponent']['StatusOptions'] == $phpMussel['lang']['response_updates_not_installed']) {
                $phpMussel['Components']['ThisComponent']['StatusOptions'] = $phpMussel['ParseVars'](
                    ['V' => $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']],
                    $phpMussel['lang']['response_updates_not_installed_php']
                );
            }
        }
        $phpMussel['Components']['ThisComponent']['VersionSize'] = 0;
        if (
            !empty($phpMussel['Components']['ThisComponent']['Files']['Checksum']) &&
            is_array($phpMussel['Components']['ThisComponent']['Files']['Checksum'])
        ) {
            array_walk($phpMussel['Components']['ThisComponent']['Files']['Checksum'], function ($Checksum) use (&$phpMussel) {
                if (!empty($Checksum) && ($Delimiter = strpos($Checksum, ':')) !== false) {
                    $phpMussel['Components']['ThisComponent']['VersionSize'] +=
                        (int)substr($Checksum, $Delimiter + 1);
                }
            });
        }
        if ($phpMussel['Components']['ThisComponent']['VersionSize'] > 0) {
            $phpMussel['FormatFilesize']($phpMussel['Components']['ThisComponent']['VersionSize']);
            $phpMussel['Components']['ThisComponent']['VersionSize'] =
                '<br />' . $phpMussel['lang']['field_size'] .
                $phpMussel['Components']['ThisComponent']['VersionSize'];
        } else {
            $phpMussel['Components']['ThisComponent']['VersionSize'] = '';
        }
        $phpMussel['Components']['ThisComponent']['LatestSize'] = 0;
        if (
            !empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Files']['Checksum']) &&
            is_array($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Files']['Checksum'])
        ) {
            array_walk($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Files']['Checksum'], function ($Checksum) use (&$phpMussel) {
                if (!empty($Checksum) && ($Delimiter = strpos($Checksum, ':')) !== false) {
                    $phpMussel['Components']['ThisComponent']['LatestSize'] +=
                        (int)substr($Checksum, $Delimiter + 1);
                }
            });
        }
        if ($phpMussel['Components']['ThisComponent']['LatestSize'] > 0) {
            $phpMussel['FormatFilesize']($phpMussel['Components']['ThisComponent']['LatestSize']);
            $phpMussel['Components']['ThisComponent']['LatestSize'] =
                '<br />' . $phpMussel['lang']['field_size'] .
                $phpMussel['Components']['ThisComponent']['LatestSize'];
        } else {
            $phpMussel['Components']['ThisComponent']['LatestSize'] = '';
        }
        if (!empty($phpMussel['Components']['ThisComponent']['Options'])) {
            $phpMussel['AppendToString']($phpMussel['Components']['ThisComponent']['StatusOptions'], '<hr />',
                '<select name="do" class="auto">' . $phpMussel['Components']['ThisComponent']['Options'] .
                '</select><input type="submit" value="' . $phpMussel['lang']['field_ok'] . '" class="auto" />'
            );
            $phpMussel['Components']['ThisComponent']['Options'] = '';
        }
        /** Append changelog. */
        $phpMussel['Components']['ThisComponent']['Changelog'] = empty(
            $phpMussel['Components']['ThisComponent']['Changelog']
        ) ? '' : '<br /><a href="' . $phpMussel['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        /** Append tests. */
        if (!empty($phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['ThisComponent']['ID']]['Tests'])) {
            $phpMussel['AppendTests']($phpMussel['Components']['ThisComponent']);
        }
        /** Append filename. */
        $phpMussel['Components']['ThisComponent']['Filename'] = (
            empty($phpMussel['Components']['ThisComponent']['Files']['To']) ||
            count($phpMussel['Components']['ThisComponent']['Files']['To']) !== 1
        ) ? '' : '<br />' . $phpMussel['lang']['field_filename'] . $phpMussel['Components']['ThisComponent']['Files']['To'][0];
        /** Finalise entry. */
        if (
            !($phpMussel['FE']['hide-non-outdated'] && empty($phpMussel['Components']['ThisComponent']['Outdated'])) &&
            !($phpMussel['FE']['hide-unused'] && empty($phpMussel['Components']['ThisComponent']['Files']['To']))
        ) {
            if (empty($phpMussel['Components']['ThisComponent']['RowClass'])) {
                $phpMussel['Components']['ThisComponent']['RowClass'] = 'h1';
            }
            $phpMussel['FE']['Indexes'][$phpMussel['Components']['ThisComponent']['ID']] =
                '<a href="#' . $phpMussel['Components']['ThisComponent']['ID'] . '">' . $phpMussel['Components']['ThisComponent']['Name'] . "</a><br /><br />\n            ";
            $phpMussel['Components']['Out'][$phpMussel['Components']['Key']] = $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['ArrayFlatten']($phpMussel['Components']['ThisComponent']) + $phpMussel['ArrayFlatten']($phpMussel['FE']),
                $phpMussel['FE']['UpdatesRow']
            );
        }
    }

    /** Prepare newly found component metadata and options for display. */
    foreach ($phpMussel['Components']['RemoteMeta'] as $phpMussel['Components']['Key'] => &$phpMussel['Components']['ThisComponent']) {
        if (
            isset($phpMussel['Components']['Meta'][$phpMussel['Components']['Key']]) ||
            empty($phpMussel['Components']['ThisComponent']['Remote']) ||
            empty($phpMussel['Components']['ThisComponent']['Version']) ||
            empty($phpMussel['Components']['ThisComponent']['Files']['From']) ||
            empty($phpMussel['Components']['ThisComponent']['Files']['To']) ||
            empty($phpMussel['Components']['ThisComponent']['Reannotate']) ||
            !$phpMussel['Traverse']($phpMussel['Components']['ThisComponent']['Reannotate']) ||
            !file_exists($phpMussel['Vault'] . $phpMussel['Components']['ThisComponent']['Reannotate'])
        ) {
            continue;
        }
        $phpMussel['Components']['ReannotateThis'] = $phpMussel['Components']['ThisComponent']['Reannotate'];
        $phpMussel['FetchRemote']();
        if (!preg_match(
            "\x01(\n" . preg_quote($phpMussel['Components']['Key']) . ":?)(\n [^\n]*)*\n\x01i",
            $phpMussel['Components']['ThisComponent']['RemoteData'],
            $phpMussel['Components']['RemoteDataThis']
        )) {
            continue;
        }
        $phpMussel['Components']['RemoteDataThis'] = preg_replace(
            ["/\n Files:(\n  [^\n]*)*\n/i", "/\n Version: [^\n]*\n/i"],
            "\n",
            $phpMussel['Components']['RemoteDataThis'][0]
        );
        if (empty($phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']])) {
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']] =
                $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['Components']['ReannotateThis']);
        }
        if (substr(
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']], -2
        ) !== "\n\n" || substr(
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']], 0, 4
        ) !== "---\n") {
            continue;
        }
        $phpMussel['ThisOffset'] = [0 => []];
        $phpMussel['ThisOffset'][1] = preg_match(
            '/(\n+)$/',
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']],
            $phpMussel['ThisOffset'][0]
        );
        $phpMussel['ThisOffset'] = strlen($phpMussel['ThisOffset'][0][0]) * -1;
        $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']] = substr(
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']], 0, $phpMussel['ThisOffset']
        ) . $phpMussel['Components']['RemoteDataThis'] . "\n";
        $phpMussel['PrepareName']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
        $phpMussel['PrepareExtendedDescription']($phpMussel['Components']['ThisComponent'], $phpMussel['Components']['Key']);
        $phpMussel['Components']['ThisComponent']['ID'] = $phpMussel['Components']['Key'];
        $phpMussel['Components']['ThisComponent']['Latest'] = $phpMussel['Components']['ThisComponent']['Version'];
        $phpMussel['Components']['ThisComponent']['Version'] = $phpMussel['lang']['response_updates_not_installed'];
        $phpMussel['Components']['ThisComponent']['StatClass'] = 'txtRd';
        $phpMussel['Components']['ThisComponent']['RowClass'] = 'h2';
        $phpMussel['Components']['ThisComponent']['VersionSize'] = '';
        $phpMussel['Components']['ThisComponent']['LatestSize'] = 0;
        if (
            !empty($phpMussel['Components']['ThisComponent']['Files']['Checksum']) &&
            is_array($phpMussel['Components']['ThisComponent']['Files']['Checksum'])
        ) {
            foreach ($phpMussel['Components']['ThisComponent']['Files']['Checksum'] as $phpMussel['Components']['ThisChecksum']) {
                if (empty($phpMussel['Components']['ThisChecksum'])) {
                    continue;
                }
                if (($phpMussel['FilesDelimit'] = strpos($phpMussel['Components']['ThisChecksum'], ':')) !== false) {
                    $phpMussel['Components']['ThisComponent']['LatestSize'] +=
                        (int)substr($phpMussel['Components']['ThisChecksum'], $phpMussel['FilesDelimit'] + 1);
                }
            }
        }
        if ($phpMussel['Components']['ThisComponent']['LatestSize'] > 0) {
            $phpMussel['FormatFilesize']($phpMussel['Components']['ThisComponent']['LatestSize']);
            $phpMussel['Components']['ThisComponent']['LatestSize'] =
                '<br />' . $phpMussel['lang']['field_size'] .
                $phpMussel['Components']['ThisComponent']['LatestSize'];
        } else {
            $phpMussel['Components']['ThisComponent']['LatestSize'] = '';
        }
        $phpMussel['Components']['ThisComponent']['StatusOptions'] = (
            !empty($phpMussel['Components']['ThisComponent']['Minimum Required PHP']) &&
            $phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['ThisComponent']['Minimum Required PHP'])
        ) ? $phpMussel['ParseVars'](
            ['V' => $phpMussel['Components']['ThisComponent']['Minimum Required PHP']],
            $phpMussel['lang']['response_updates_not_installed_php']
        ) :
            $phpMussel['lang']['response_updates_not_installed'] .
            '<br /><select name="do" class="auto"><option value="update-component">' .
            $phpMussel['lang']['field_install'] . '</option></select><input type="submit" value="' .
            $phpMussel['lang']['field_ok'] . '" class="auto" />';
        /** Append changelog. */
        $phpMussel['Components']['ThisComponent']['Changelog'] = empty(
            $phpMussel['Components']['ThisComponent']['Changelog']
        ) ? '' : '<br /><a href="' . $phpMussel['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        /** Append tests. */
        if (!empty($phpMussel['Components']['ThisComponent']['Tests'])) {
            $phpMussel['AppendTests']($phpMussel['Components']['ThisComponent']);
        }
        /** Append filename (empty). */
        $phpMussel['Components']['ThisComponent']['Filename'] = '';
        /** Finalise entry. */
        if (!$phpMussel['FE']['hide-unused']) {
            $phpMussel['FE']['Indexes'][$phpMussel['Components']['ThisComponent']['ID']] =
                '<a href="#' . $phpMussel['Components']['ThisComponent']['ID'] . '">' . $phpMussel['Components']['ThisComponent']['Name'] . "</a><br /><br />\n            ";
            $phpMussel['Components']['Out'][$phpMussel['Components']['Key']] = $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['ArrayFlatten']($phpMussel['Components']['ThisComponent']) + $phpMussel['ArrayFlatten']($phpMussel['FE']),
                $phpMussel['FE']['UpdatesRow']
            );
        }
    }
    unset($phpMussel['Components']['ThisComponent']);

    /** Write annotations for newly found component metadata. */
    array_walk($phpMussel['Components']['Remotes'], function ($Remote, $Key) use (&$phpMussel) {
        if (substr($Remote, -2) !== "\n\n" || substr($Remote, 0, 4) !== "---\n") {
            return;
        }
        $Handle = fopen($phpMussel['Vault'] . $Key, 'w');
        fwrite($Handle, $Remote);
        fclose($Handle);
    });

    /** Finalise output and unset working data. */
    uksort($phpMussel['FE']['Indexes'], $phpMussel['UpdatesSortFunc']);
    $phpMussel['FE']['Indexes'] = implode('', $phpMussel['FE']['Indexes']);
    uksort($phpMussel['Components']['Out'], $phpMussel['UpdatesSortFunc']);
    $phpMussel['FE']['Components'] = implode('', $phpMussel['Components']['Out']);

    /** Instructions to update everything at once. */
    if (count($phpMussel['Components']['Outdated'])) {
        $phpMussel['FE']['UpdateAll'] =
            '<hr /><form action="?' . $phpMussel['FE']['UpdatesFormTarget'] .
            '" method="POST"><input name="phpmussel-form-target" type="hidden" value="updates" />' .
            '<input name="do" type="hidden" value="update-component" />';
        foreach ($phpMussel['Components']['Outdated'] as $phpMussel['Components']['ThisOutdated']) {
            $phpMussel['FE']['UpdateAll'] .=
                '<input name="ID[]" type="hidden" value="' .
                $phpMussel['Components']['ThisOutdated'] . '" />';
        }
        $phpMussel['FE']['UpdateAll'] .=
            '<input type="submit" value="' . $phpMussel['lang']['field_update_all'] . '" class="auto" /></form>';
    } else {
        $phpMussel['FE']['UpdateAll'] = '';
    }

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_updates.html'))
    );

    /** Inject dependencies into update instructions for core package component. */
    if (count($phpMussel['Components']['Dependencies'])) {
        $phpMussel['FE']['FE_Content'] = str_replace('<input name="ID" type="hidden" value="phpMussel" />',
            '<input name="ID[]" type="hidden" value="' .
            implode('" /><input name="ID[]" type="hidden" value="', $phpMussel['Components']['Dependencies']) .
            '" /><input name="ID[]" type="hidden" value="phpMussel" />',
        $phpMussel['FE']['FE_Content']);
    }

    /** Cleanup. */
    unset($phpMussel['Components'], $phpMussel['Count'], $phpMussel['Iterate']);

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** File Manager. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'file-manager' && $phpMussel['FE']['Permissions'] === 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_file_manager'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_file_manager']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Load pie chart template file upon request. */
    if (empty($phpMussel['QueryVars']['show'])) {
        $phpMussel['FE']['ChartJSPath'] = $phpMussel['PieFile'] = $phpMussel['PiePath'] = '';
    } else {
        if ($phpMussel['PiePath'] = $phpMussel['GetAssetPath']('_chartjs.html', true)) {
            $phpMussel['PieFile'] = $phpMussel['ReadFile']($phpMussel['PiePath']);
        } else {
            $phpMussel['PieFile'] = '<tr><td class="h4f" colspan="2"><div class="s">{PieChartHTML}</div></td></tr>';
        }
        $phpMussel['FE']['ChartJSPath'] = $phpMussel['GetAssetPath']('Chart.min.js', true) ? '?phpmussel-asset=Chart.min.js&theme=default' : '';
    }

    /** Set vault path for pie chart display. */
    $phpMussel['FE']['VaultPath'] = str_replace("\\", '/', $phpMussel['Vault']) . '*';

    /** Prepare components metadata working array. */
    $phpMussel['Components'] = ['Files', 'Components', 'Names'];

    /** Show/hide pie charts link and etc. */
    if (!$phpMussel['PieFile']) {

        $phpMussel['FE']['FMgrFormTarget'] = 'phpmussel-page=file-manager';
        $phpMussel['FE']['ShowHideLink'] = '<a href="?phpmussel-page=file-manager&show=true">' . $phpMussel['lang']['label_show'] . '</a>';

    } else {

        $phpMussel['FE']['FMgrFormTarget'] = 'phpmussel-page=file-manager&show=true';
        $phpMussel['FE']['ShowHideLink'] = '<a href="?phpmussel-page=file-manager">' . $phpMussel['lang']['label_hide'] . '</a>';

        /** Fetch components lists. */
        $phpMussel['FetchComponentsLists']($phpMussel['Vault'], $phpMussel['Components']['Components']);

        /** Identifying file component correlations. */
        foreach ($phpMussel['Components']['Components'] as $phpMussel['Components']['ThisName'] => &$phpMussel['Components']['ThisData']) {
            if (!empty($phpMussel['Components']['ThisData']['Files']['To'])) {
                $phpMussel['Arrayify']($phpMussel['Components']['ThisData']['Files']['To']);
                foreach ($phpMussel['Components']['ThisData']['Files']['To'] as $phpMussel['Components']['ThisFile']) {
                    $phpMussel['Components']['ThisFile'] = str_replace("\\", '/', $phpMussel['Components']['ThisFile']);
                    $phpMussel['Components']['Files'][$phpMussel['Components']['ThisFile']] = $phpMussel['Components']['ThisName'];
                }
            }
            $phpMussel['PrepareName']($phpMussel['Components']['ThisData'], $phpMussel['Components']['ThisName']);
            if (!empty($phpMussel['Components']['ThisData']['Name'])) {
                $phpMussel['Components']['Names'][$phpMussel['Components']['ThisName']] = $phpMussel['Components']['ThisData']['Name'];
            }
            $phpMussel['Components']['ThisData'] = 0;
        }

    }

    /** Upload a new file. */
    if (isset($_POST['do']) && $_POST['do'] === 'upload-file' && isset($_FILES['upload-file']['name'])) {

        /** Check whether safe. */
        $phpMussel['SafeToContinue'] = (
            basename($_FILES['upload-file']['name']) === $_FILES['upload-file']['name'] &&
            $phpMussel['FileManager-PathSecurityCheck']($_FILES['upload-file']['name']) &&
            isset($_FILES['upload-file']['tmp_name']) &&
            isset($_FILES['upload-file']['error']) &&
            $_FILES['upload-file']['error'] === UPLOAD_ERR_OK &&
            is_uploaded_file($_FILES['upload-file']['tmp_name']) &&
            !is_link($phpMussel['Vault'] . $_FILES['upload-file']['name'])
        );

        /** If the filename already exists, delete the old file before moving the new file. */
        if ($phpMussel['SafeToContinue'] && is_readable($phpMussel['Vault'] . $_FILES['upload-file']['name'])) {
            if (is_dir($phpMussel['Vault'] . $_FILES['upload-file']['name'])) {
                if ($phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $_FILES['upload-file']['name'])) {
                    rmdir($phpMussel['Vault'] . $_FILES['upload-file']['name']);
                } else {
                    $phpMussel['SafeToContinue'] = false;
                }
            } else {
                unlink($phpMussel['Vault'] . $_FILES['upload-file']['name']);
            }
        }

        /** Move the newly uploaded file to the designated location. */
        if ($phpMussel['SafeToContinue']) {
            rename($_FILES['upload-file']['tmp_name'], $phpMussel['Vault'] . $_FILES['upload-file']['name']);
            $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_file_uploaded'];
        } else {
            $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_upload_error'];
        }

    }

    /** A form was submitted. */
    elseif (
        isset($_POST['filename']) &&
        isset($_POST['do']) &&
        is_readable($phpMussel['Vault'] . $_POST['filename']) &&
        $phpMussel['FileManager-PathSecurityCheck']($_POST['filename'])
    ) {

        /** Delete a file. */
        if ($_POST['do'] === 'delete-file') {

            if (is_dir($phpMussel['Vault'] . $_POST['filename'])) {
                if ($phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $_POST['filename'])) {
                    rmdir($phpMussel['Vault'] . $_POST['filename']);
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_directory_deleted'];
                } else {
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_delete_error'];
                }
            } else {
                unlink($phpMussel['Vault'] . $_POST['filename']);

                /** Remove empty directories. */
                $phpMussel['DeleteDirectory']($_POST['filename']);

                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_file_deleted'];
            }

        /** Rename a file. */
        } elseif ($_POST['do'] === 'rename-file' && isset($_POST['filename'])) {

            if (isset($_POST['filename_new'])) {

                /** Check whether safe. */
                $phpMussel['SafeToContinue'] = (
                    $phpMussel['FileManager-PathSecurityCheck']($_POST['filename']) &&
                    $phpMussel['FileManager-PathSecurityCheck']($_POST['filename_new']) &&
                    $_POST['filename'] !== $_POST['filename_new']
                );

                /** If the destination already exists, delete it before renaming the new file. */
                if (
                    $phpMussel['SafeToContinue'] &&
                    file_exists($phpMussel['Vault'] . $_POST['filename_new']) &&
                    is_readable($phpMussel['Vault'] . $_POST['filename_new'])
                ) {
                    if (is_dir($phpMussel['Vault'] . $_POST['filename_new'])) {
                        if ($phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $_POST['filename_new'])) {
                            rmdir($phpMussel['Vault'] . $_POST['filename_new']);
                        } else {
                            $phpMussel['SafeToContinue'] = false;
                        }
                    } else {
                        unlink($phpMussel['Vault'] . $_POST['filename_new']);
                    }
                }

                /** Rename the file. */
                if ($phpMussel['SafeToContinue']) {

                    $phpMussel['ThisName'] = $_POST['filename_new'];
                    $phpMussel['ThisPath'] = $phpMussel['Vault'];

                    /** Add parent directories. */
                    while (strpos($phpMussel['ThisName'], '/') !== false || strpos($phpMussel['ThisName'], "\\") !== false) {
                        $phpMussel['Separator'] = (strpos($phpMussel['ThisName'], '/') !== false) ? '/' : "\\";
                        $phpMussel['ThisDir'] = substr($phpMussel['ThisName'], 0, strpos($phpMussel['ThisName'], $phpMussel['Separator']));
                        $phpMussel['ThisPath'] .= $phpMussel['ThisDir'] . '/';
                        $phpMussel['ThisName'] = substr($phpMussel['ThisName'], strlen($phpMussel['ThisDir']) + 1);
                        if (!file_exists($phpMussel['ThisPath']) || !is_dir($phpMussel['ThisPath'])) {
                            mkdir($phpMussel['ThisPath']);
                        }
                    }

                    if (rename($phpMussel['Vault'] . $_POST['filename'], $phpMussel['Vault'] . $_POST['filename_new'])) {

                        /** Remove empty directories. */
                        $phpMussel['DeleteDirectory']($_POST['filename']);

                        $phpMussel['FE']['state_msg'] = (is_dir($phpMussel['Vault'] . $_POST['filename_new'])) ?
                            $phpMussel['lang']['response_directory_renamed'] : $phpMussel['lang']['response_file_renamed'];

                    }

                } elseif (!$phpMussel['FE']['state_msg']) {
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_rename_error'];
                }

            } else {

                $phpMussel['FE']['FE_Title'] .= ' – ' . $phpMussel['lang']['field_rename_file'] . ' – ' . $_POST['filename'];
                $phpMussel['FE']['filename'] = $_POST['filename'];

                /** Parse output. */
                $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
                    $phpMussel['lang'] + $phpMussel['FE'],
                    $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_files_rename.html'))
                );

                /** Send output. */
                echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

                die;

            }

        /** Edit a file. */
        } elseif ($_POST['do'] === 'edit-file') {

            if (isset($_POST['content'])) {

                $_POST['content'] = str_replace("\r", '', $_POST['content']);
                $phpMussel['OldData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . $_POST['filename']);
                if (substr_count($phpMussel['OldData'], "\r\n") && !substr_count($phpMussel['OldData'], "\n\n")) {
                    $_POST['content'] = str_replace("\n", "\r\n", $_POST['content']);
                }

                $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $_POST['filename'], 'w');
                fwrite($phpMussel['Handle'], $_POST['content']);
                fclose($phpMussel['Handle']);

                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_file_edited'];

            } else {

                $phpMussel['FE']['FE_Title'] .= ' – ' . $_POST['filename'];
                $phpMussel['FE']['filename'] = $_POST['filename'];
                $phpMussel['FE']['content'] = htmlentities($phpMussel['ReadFile']($phpMussel['Vault'] . $_POST['filename']));

                /** Parse output. */
                $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
                    $phpMussel['lang'] + $phpMussel['FE'],
                    $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_files_edit.html'))
                );

                /** Send output. */
                echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

                die;

            }

        /** Download a file. */
        } elseif ($_POST['do'] === 'download-file') {

            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: Binary');
            header('Content-disposition: attachment; filename="' . basename($_POST['filename']) . '"');
            echo $phpMussel['ReadFile']($phpMussel['Vault'] . $_POST['filename']);
            die;

        }

    }

    /** Template for file rows. */
    $phpMussel['FE']['FilesRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_files_row.html'));

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_files.html'))
    );

    /** Initialise files data variable. */
    $phpMussel['FE']['FilesData'] = '';

    /** Total size. */
    $phpMussel['FE']['TotalSize'] = 0;

    /** Fetch files data. */
    $phpMussel['FilesArray'] = $phpMussel['FileManager-RecursiveList']($phpMussel['Vault']);

    if (!$phpMussel['PieFile']) {
        $phpMussel['FE']['PieChart'] = '';
    } else {

        /** Sort pie chart values. */
        arsort($phpMussel['Components']['Components']);

        /** Initialise pie chart values. */
        $phpMussel['FE']['PieChartValues'] = [];

        /** Initialise pie chart labels. */
        $phpMussel['FE']['PieChartLabels'] = [];

        /** Initialise pie chart colours. */
        $phpMussel['FE']['PieChartColours'] = [];

        /** Initialise pie chart legend. */
        $phpMussel['FE']['PieChartHTML'] = '';

        /** Building pie chart values. */
        foreach ($phpMussel['Components']['Components'] as $phpMussel['Components']['ThisName'] => $phpMussel['Components']['ThisData']) {
            if (empty($phpMussel['Components']['ThisData'])) {
                continue;
            }
            $phpMussel['Components']['ThisSize'] = $phpMussel['Components']['ThisData'];
            $phpMussel['FormatFilesize']($phpMussel['Components']['ThisSize']);
            $phpMussel['Components']['ThisName'] .= ' – ' . $phpMussel['Components']['ThisSize'];
            $phpMussel['FE']['PieChartValues'][] = $phpMussel['Components']['ThisData'];
            $phpMussel['FE']['PieChartLabels'][] = $phpMussel['Components']['ThisName'];
            if ($phpMussel['PiePath']) {
                $phpMussel['Components']['ThisColour'] = substr(md5($phpMussel['Components']['ThisName']), 0, 6);
                $phpMussel['Components']['RGB'] =
                    hexdec(substr($phpMussel['Components']['ThisColour'], 0, 2)) . ',' .
                    hexdec(substr($phpMussel['Components']['ThisColour'], 2, 2)) . ',' .
                    hexdec(substr($phpMussel['Components']['ThisColour'], 4, 2));
                $phpMussel['FE']['PieChartColours'][] = '#' . $phpMussel['Components']['ThisColour'];
                $phpMussel['FE']['PieChartHTML'] .=
                    '<span style="background:linear-gradient(90deg,rgba(' .
                    $phpMussel['Components']['RGB'] . ',0.3),rgba(' .
                    $phpMussel['Components']['RGB'] . ',0))"><span style="color:#' .
                    $phpMussel['Components']['ThisColour'] . '">➖</span> ' .
                    $phpMussel['Components']['ThisName'] . "</span><br />\n";
            } else {
                $phpMussel['FE']['PieChartHTML'] .= '➖ ' . $phpMussel['Components']['ThisName'] . "<br />\n";
            }
        }

        /** Finalise pie chart values. */
        $phpMussel['FE']['PieChartValues'] = '[' . implode(', ', $phpMussel['FE']['PieChartValues']) . ']';

        /** Finalise pie chart labels. */
        $phpMussel['FE']['PieChartLabels'] = '["' . implode('", "', $phpMussel['FE']['PieChartLabels']) . '"]';

        /** Finalise pie chart colours. */
        $phpMussel['FE']['PieChartColours'] = '["' . implode('", "', $phpMussel['FE']['PieChartColours']) . '"]';

        /** Finalise pie chart. */
        $phpMussel['FE']['PieChart'] = $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['PieFile']);

    }

    /** Cleanup. */
    unset($phpMussel['PieFile'], $phpMussel['PiePath'], $phpMussel['Components']);

    /** Process files data. */
    array_walk($phpMussel['FilesArray'], function ($ThisFile) use (&$phpMussel) {
        $ThisFile['ThisOptions'] = '';
        if (!$ThisFile['Directory'] || $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $ThisFile['Filename'])) {
            $ThisFile['ThisOptions'] .= '<option value="delete-file">' . $phpMussel['lang']['field_delete_file'] . '</option>';
            $ThisFile['ThisOptions'] .= '<option value="rename-file">' . $phpMussel['lang']['field_rename_file'] . '</option>';
        }
        if ($ThisFile['CanEdit']) {
            $ThisFile['ThisOptions'] .= '<option value="edit-file">' . $phpMussel['lang']['field_edit_file'] . '</option>';
        }
        if (!$ThisFile['Directory']) {
            $ThisFile['ThisOptions'] .= '<option value="download-file">' . $phpMussel['lang']['field_download_file'] . '</option>';
        }
        if ($ThisFile['ThisOptions']) {
            $ThisFile['ThisOptions'] =
                '<select name="do">' . $ThisFile['ThisOptions'] . '</select>' .
                '<input type="submit" value="' . $phpMussel['lang']['field_ok'] . '" class="auto" />';
        }
        $phpMussel['FE']['FilesData'] .= $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'] + $ThisFile, $phpMussel['FE']['FilesRow']
        );
    });

    /** Total size. */
    $phpMussel['FormatFilesize']($phpMussel['FE']['TotalSize']);

    /** Disk free space. */
    $phpMussel['FE']['FreeSpace'] = disk_free_space(__DIR__);

    /** Disk total space. */
    $phpMussel['FE']['TotalSpace'] = disk_total_space(__DIR__);

    /** Disk total usage. */
    $phpMussel['FE']['TotalUsage'] = $phpMussel['FE']['TotalSpace'] - $phpMussel['FE']['FreeSpace'];

    $phpMussel['FormatFilesize']($phpMussel['FE']['FreeSpace']);
    $phpMussel['FormatFilesize']($phpMussel['FE']['TotalSpace']);
    $phpMussel['FormatFilesize']($phpMussel['FE']['TotalUsage']);

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Upload Test. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'upload-test' && $phpMussel['FE']['Permissions'] === 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_upload_test'];

    $phpMussel['FE']['MaxFilesize'] = $phpMussel['ReadBytes']($phpMussel['Config']['files']['filesize_limit']);

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_upload_test']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_upload_test.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Quarantine. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'quarantine') {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_quarantine'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_quarantine']
    );

    /** Display how to enable quarantine if currently disabled. */
    if (!$phpMussel['Config']['general']['quarantine_key']) {
        $phpMussel['FE']['state_msg'] .= '<span class="txtRd">' . $phpMussel['lang']['tip_quarantine_disabled'] . '</span><br />';
    }

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** A form was submitted. */
    if (
        !empty($_POST['qfu']) &&
        !empty($_POST['do']) &&
        !is_dir($phpMussel['qfuPath'] . $_POST['qfu']) &&
        is_readable($phpMussel['qfuPath'] . $_POST['qfu']) &&
        $phpMussel['FileManager-PathSecurityCheck']($_POST['qfu'])
    ) {

        /** Delete a file. */
        if ($_POST['do'] === 'delete-file') {

            $phpMussel['FE']['state_msg'] .= '<code>' . $_POST['qfu'] . '</code> ' . (unlink(
                $phpMussel['qfuPath'] . $_POST['qfu']
            ) ? $phpMussel['lang']['response_file_deleted'] : $phpMussel['lang']['response_delete_error']) . '<br />';

        /** Download or restore a file. */
        } elseif ($_POST['do'] === 'download-file' || $_POST['do'] === 'restore-file') {

            if (empty($_POST['qkey'])) {
                $phpMussel['FE']['state_msg'] .= '<code>' . $_POST['qfu'] . '</code> ' . $phpMussel['lang']['response_restore_error_2'] . '<br />';
            } else {
                /** Attempt to restore the file. */
                $phpMussel['Restored'] = $phpMussel['Quarantine-Restore']($phpMussel['qfuPath'] . $_POST['qfu'], $_POST['qkey']);

                /** Restore success! */
                if (empty($phpMussel['RestoreStatus'])) {

                    /** Download the file. */
                    if ($_POST['do'] === 'download-file') {
                        header('Content-Type: application/octet-stream');
                        header('Content-Transfer-Encoding: Binary');
                        header('Content-disposition: attachment; filename="' . basename($_POST['qfu']) . '.restored"');
                        echo $phpMussel['Restored'];
                        die;
                    }

                    /** Restore the file. */
                    $phpMussel['Handle'] = fopen($phpMussel['qfuPath'] . $_POST['qfu'] . '.restored', 'w');
                    fwrite($phpMussel['Handle'], $phpMussel['Restored']);
                    fclose($phpMussel['Handle']);
                    $phpMussel['FE']['state_msg'] .= '<code>' . $_POST['qfu'] . '.restored</code> ' . $phpMussel['lang']['response_file_restored'] . '<br />';

                }

                /** Corrupted file! */
                elseif ($phpMussel['RestoreStatus'] === 2) {
                    $phpMussel['FE']['state_msg'] .= '<code>' . $_POST['qfu'] . '</code> ' . $phpMussel['lang']['response_restore_error_1'] . '<br />';
                }

                /** Incorrect quarantine key! */
                else {
                    $phpMussel['FE']['state_msg'] .= '<code>' . $_POST['qfu'] . '</code> ' . $phpMussel['lang']['response_restore_error_2'] . '<br />';
                }

                /** Cleanup. */
                unset($phpMussel['RestoreStatus'], $phpMussel['Restored']);
            }

        }

    }

    /** Delete all files in quarantine. */
    $DeleteMode = !empty($_POST['DeleteAll']);

    /** Template for quarantine files row. */
    $phpMussel['FE']['QuarantineRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_quarantine_row.html'));

    /** Fetch quarantine data array. */
    $phpMussel['FilesInQuarantine'] = $phpMussel['Quarantine-RecursiveList']($DeleteMode);

    /** Number of files in quarantine. */
    $phpMussel['FilesInQuarantineCount'] = count($phpMussel['FilesInQuarantine']);

    /** Number of files in quarantine state message. */
    $phpMussel['FE']['state_msg'] .= sprintf(
        $phpMussel['Plural']($phpMussel['FilesInQuarantineCount'], $phpMussel['lang']['state_quarantine']),
        '<span class="txtRd">' . $phpMussel['Number_L10N']($phpMussel['FilesInQuarantineCount']) . '</span>'
    ) . '<br />';

    /** Initialise quarantine data string. */
    $phpMussel['FE']['FilesInQuarantine'] = '';

    /** Process quarantine files data. */
    array_walk($phpMussel['FilesInQuarantine'], function ($ThisFile) use (&$phpMussel) {
        $phpMussel['FE']['FilesInQuarantine'] .= $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'] + $ThisFile, $phpMussel['FE']['QuarantineRow']
        );
    });

    /** Cleanup. */
    unset($phpMussel['FilesInQuarantineCount'], $phpMussel['FilesInQuarantine']);

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_quarantine.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Statistics. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'statistics') {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_statistics'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_statistics']
    );

    /** Display how to enable statistics if currently disabled. */
    if (!$phpMussel['Config']['general']['statistics']) {
        $phpMussel['FE']['state_msg'] .= '<span class="txtRd">' . $phpMussel['lang']['tip_statistics_disabled'] . '</span><br />';
    }

    /** Fetch statistics cache data. */
    if ($phpMussel['Statistics'] = ($phpMussel['FetchCache']('Statistics') ?: [])) {
        $phpMussel['Statistics'] = unserialize($phpMussel['Statistics']) ?: [];
    }

    /** Clear statistics. */
    if (!empty($_POST['ClearStats'])) {
        $phpMussel['SaveCache']('Statistics', 1, '-');
        $phpMussel['Statistics'] = [];
        $phpMussel['FE']['state_msg'] .= $phpMussel['lang']['response_statistics_cleared'] . '<br />';
    }

    /** Statistics have been counted since... */
    if (empty($phpMussel['Statistics']['Other-Since'])) {
        $phpMussel['FE']['Other-Since'] = '<span class="s">-</span>';
    } else {
        $phpMussel['FE']['Other-Since'] = '<span class="s">' . $phpMussel['TimeFormat'](
            $phpMussel['Statistics']['Other-Since'],
            $phpMussel['Config']['general']['timeFormat']
        ) . '</span>';
    }

    /** Fetch and process various statistics. */
    foreach ([
        'Web-Events',
        'Web-Scanned',
        'Web-Blocked',
        'Web-Quarantined',
        'CLI-Events',
        'CLI-Scanned',
        'CLI-Flagged',
        'API-Events',
        'API-Scanned',
        'API-Flagged'
    ] as $phpMussel['TheseStats']) {
        $phpMussel['FE'][$phpMussel['TheseStats']] = '<span class="s">' . $phpMussel['Number_L10N'](
            empty($phpMussel['Statistics'][$phpMussel['TheseStats']]) ? 0 : $phpMussel['Statistics'][$phpMussel['TheseStats']]
        ) . '</span>';
    }

    /** Active signature files. */
    if (empty($phpMussel['Config']['signatures']['Active'])) {
        $phpMussel['FE']['Other-Active'] = '<span class="txtRd">' . $phpMussel['Number_L10N'](0) . '</span>';
    } else {
        $phpMussel['FE']['Other-Active'] = 0;
        $phpMussel['StatWorking'] = explode(',', $phpMussel['Config']['signatures']['Active']);
        array_walk($phpMussel['StatWorking'], function ($SigFile) use (&$phpMussel) {
            if (!empty($SigFile) && is_readable($phpMussel['sigPath'] . $SigFile)) {
                $phpMussel['FE']['Other-Active']++;
            }
        });
        $phpMussel['StatColour'] = $phpMussel['FE']['Other-Active'] ? 'txtGn' : 'txtRd';
        $phpMussel['FE']['Other-Active'] = '<span class="' . $phpMussel['StatColour'] . '">' . $phpMussel['Number_L10N'](
            $phpMussel['FE']['Other-Active']
        ) . '</span>';
    }

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_statistics.html'))
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

    /** Cleanup. */
    unset($phpMussel['StatColour'], $phpMussel['StatWorking'], $phpMussel['Statistics']);

}

/** Logs. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'logs') {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_logs'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        ['username' => $phpMussel['FE']['UserRaw']],
        $phpMussel['lang']['tip_logs']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_logs.html'))
    );

    /** Initialise array for fetching logs data. */
    $phpMussel['FE']['LogFiles'] = [
        'Files' => $phpMussel['Logs-RecursiveList']($phpMussel['Vault']),
        'Out' => ''
    ];

    /** Text mode switch link base. */
    $phpMussel['FE']['TextModeSwitchLink'] = '';

    /** How to display the log data? */
    if (empty($phpMussel['QueryVars']['text-mode']) || $phpMussel['QueryVars']['text-mode'] === 'false') {
        $phpMussel['FE']['TextModeLinks'] = 'false';
        $phpMussel['FE']['TextMode'] = false;
    } else {
        $phpMussel['FE']['TextModeLinks'] = 'true';
        $phpMussel['FE']['TextMode'] = true;
    }

    /** Define log data. */
    if (empty($phpMussel['QueryVars']['logfile'])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_no_logfile_selected'];
    } elseif (empty($phpMussel['FE']['LogFiles']['Files'][$phpMussel['QueryVars']['logfile']])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_logfile_doesnt_exist'];
    } else {
        $phpMussel['FE']['TextModeSwitchLink'] .= '?phpmussel-page=logs&logfile=' . $phpMussel['QueryVars']['logfile'] . '&text-mode=';
        $phpMussel['FE']['logfileData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['QueryVars']['logfile']);
        $phpMussel['FE']['logfileData'] = $phpMussel['FE']['TextMode'] ? str_replace(
            ['<', '>', "\r", "\n"], ['&lt;', '&gt;', '', "<br />\n"], $phpMussel['FE']['logfileData']
        ) : str_replace(
            ['<', '>', "\r"], ['&lt;', '&gt;', ''], $phpMussel['FE']['logfileData']
        );
        $phpMussel['FE']['mod_class_nav'] = ' big';
        $phpMussel['FE']['mod_class_right'] = ' extend';
    }
    if (empty($phpMussel['FE']['mod_class_nav'])) {
        $phpMussel['FE']['mod_class_nav'] = ' extend';
        $phpMussel['FE']['mod_class_right'] = ' big';
    }
    if (empty($phpMussel['FE']['TextModeSwitchLink'])) {
        $phpMussel['FE']['TextModeSwitchLink'] .= '?phpmussel-page=logs&text-mode=';
    }

    /** Text mode switch link formatted. */
    $phpMussel['FE']['TextModeSwitchLink'] = sprintf(
        $phpMussel['lang']['link_textmode'],
        $phpMussel['FE']['TextModeSwitchLink']
    );

    /** Prepare log data formatting. */
    if (!$phpMussel['FE']['TextMode']) {
        $phpMussel['FE']['logfileData'] = '<textarea readonly>' . $phpMussel['FE']['logfileData'] . '</textarea>';
    }

    /** Define logfile list. */
    array_walk($phpMussel['FE']['LogFiles']['Files'], function ($Arr) use (&$phpMussel) {
        $phpMussel['FE']['LogFiles']['Out'] .= sprintf(
            '            <a href="?phpmussel-page=logs&logfile=%1$s&text-mode=%3$s">%1$s</a> – %2$s<br />',
            $Arr['Filename'],
            $Arr['Filesize'],
            $phpMussel['FE']['TextModeLinks']
        ) . "\n";
    });

    if (!$phpMussel['FE']['LogFiles'] = $phpMussel['FE']['LogFiles']['Out']) {
        $phpMussel['FE']['LogFiles'] = $phpMussel['lang']['logs_no_logfiles_available'];
    }

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Rebuild cache. */
if ($phpMussel['FE']['Rebuild']) {
    $phpMussel['FE']['FrontEndData'] =
        "USERS\n-----" . $phpMussel['FE']['UserList'] .
        "\nSESSIONS\n--------" . $phpMussel['FE']['SessionList'] .
        "\nCACHE\n-----" . $phpMussel['FE']['Cache'];
    $phpMussel['Handle'] = fopen($phpMussel['Vault'] . 'fe_assets/frontend.dat', 'w');
    fwrite($phpMussel['Handle'], $phpMussel['FE']['FrontEndData']);
    fclose($phpMussel['Handle']);
}

die;
