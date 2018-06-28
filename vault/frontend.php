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
 * This file: Front-end handler (last modified: 2018.06.28).
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

    /** Main front-end HTML template file. */
    'Template' => $phpMussel['ReadFile']($phpMussel['GetAssetPath']('frontend.html')),

    /** Populated by front-end JavaScript data as per needed. */
    'JS' => '',

    /** Default password hash ("password"). */
    'DefaultPassword' => '$2y$10$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK',

    /** Current default language. */
    'FE_Lang' => $phpMussel['Config']['general']['lang'],

    /** Font magnification. */
    'Magnification' => $phpMussel['Config']['template_data']['Magnification'],

    /** Warns if maintenance mode is enabled. */
    'MaintenanceWarning' => (
        $phpMussel['Config']['general']['maintenance_mode']
    ) ? "\n<div class=\"center\"><span class=\"txtRd\">" . $phpMussel['lang']['state_maintenance_mode'] . '</span></div><hr />' : '',

    /** Define active configuration file. */
    'ActiveConfigFile' => !empty($phpMussel['Overrides']) ? $phpMussel['Domain'] . '.config.ini' : 'config.ini',

    /** Current time and date. */
    'DateTime' => $phpMussel['TimeFormat']($phpMussel['Time'], $phpMussel['Config']['general']['timeFormat']),

    /** How the script identifies itself. */
    'ScriptIdent' => $phpMussel['ScriptIdent'],

    /** Current default theme. */
    'theme' => $phpMussel['Config']['template_data']['theme'],

    /** List of front-end users will be populated here. */
    'UserList' => "\n",

    /** List of front-end sessions will be populated here. */
    'SessionList' => "\n",

    /** Cache data will be populated here. */
    'Cache' => "\n",

    /** The current user state (0 = Not logged in; 1 = Logged in; -1 = Attempted and failed to log in). */
    'UserState' => 0,

    /** Taken from either $_POST['username'] or $_COOKIE['PHPMUSSEL-ADMIN'] (the username claimed by the client). */
    'UserRaw' => '',

    /** User permissions (0 = Not logged in; 1 = Complete access; 2 = Logs access only; 3 = Cronable). */
    'Permissions' => 0,

    /** Will be populated by messages reflecting the current request state. */
    'state_msg' => '',

    /** Will be populated by the current session data. */
    'ThisSession' => '',

    /** Will be populated by either [Log Out] or [Home | Log Out] links. */
    'bNav' => '&nbsp;',

    /** State reflecting whether the current request is cronable. */
    'CronMode' => !empty($_POST['CronMode']),

    /** The user agent of the current request. */
    'UA' => empty($_SERVER['HTTP_USER_AGENT']) ? '' : $_SERVER['HTTP_USER_AGENT'],

    /** The IP address of the current request. */
    'YourIP' => empty(
        $_SERVER[$phpMussel['Config']['general']['ipaddr']]
    ) ? '' : $_SERVER[$phpMussel['Config']['general']['ipaddr']],

    /** Asynchronous mode. */
    'ASYNC' => !empty($_POST['ASYNC']),

    /** Will be populated by the page title. */
    'FE_Title' => ''

];

/** Plugin hook: "frontend_before". */
$phpMussel['Execute_Hook']('frontend_before');

/** Fetch pips data. */
$phpMussel['Pips_Path'] = $phpMussel['GetAssetPath']('pips.php', true);
if (!empty($phpMussel['Pips_Path']) && is_readable($phpMussel['Pips_Path'])) {
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
        !preg_match('~[^\da-z._]~i', $phpMussel['QueryVars']['phpmussel-asset'])
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
if ($phpMussel['FE']['FormTarget'] === 'login' || $phpMussel['FE']['CronMode']) {
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
                if (($phpMussel['FE']['Permissions'] === 3 && (
                    !$phpMussel['FE']['CronMode'] || substr($phpMussel['FE']['UA'], 0, 10) !== 'Cronable v'
                )) || !($phpMussel['FE']['Permissions'] > 0 && $phpMussel['FE']['Permissions'] <= 3)) {
                    $phpMussel['FE']['Permissions'] = 0;
                    $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_wrong_endpoint'];
                } else {
                    $phpMussel['FE']['UserState'] = 1;
                    if (!$phpMussel['FE']['CronMode']) {
                        $phpMussel['FE']['SessionKey'] = md5($phpMussel['GenerateSalt']());
                        $phpMussel['FE']['Cookie'] = $_POST['username'] . $phpMussel['FE']['SessionKey'];
                        setcookie('PHPMUSSEL-ADMIN', $phpMussel['FE']['Cookie'], $phpMussel['Time'] + 604800, '/', $phpMussel['HTTP_HOST'], false, true);
                        $phpMussel['FE']['ThisSession'] = $phpMussel['FE']['User'] . ',' . password_hash(
                            $phpMussel['FE']['SessionKey'], $phpMussel['DefaultAlgo']
                        ) . ',' . ($phpMussel['Time'] + 604800) . "\n";
                        $phpMussel['FE']['SessionList'] .= $phpMussel['FE']['ThisSession'];
                    }
                    $phpMussel['FE']['Rebuild'] = true;
                }
            } else {
                $phpMussel['FE']['Permissions'] = 0;
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_invalid_password'];
            }
        } else {
            $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_login_invalid_username'];
        }

    }

    $phpMussel['FrontEndLogFile'] = '';
    if ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['FrontEndLogFile'] = (strpos($phpMussel['Config']['general']['FrontEndLog'], '{') !== false) ? $phpMussel['TimeFormat'](
            $phpMussel['Now'],
            $phpMussel['Config']['general']['FrontEndLog']
        ) : $phpMussel['Config']['general']['FrontEndLog'];
        $phpMussel['FrontEndLog'] = (
            $phpMussel['Config']['legal']['pseudonymise_ip_addresses']
        ) ? $phpMussel['Pseudonymise-IP']($_SERVER[$phpMussel['IPAddr']]) : $_SERVER[$phpMussel['IPAddr']];
        $phpMussel['FrontEndLog'] .= ' - ' . $phpMussel['FE']['DateTime'] . ' - ' . (empty($_POST['username']) ? '""' : '"' . $_POST['username'] . '"');
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
        if (!$phpMussel['FE']['CronMode']) {
            $phpMussel['FE']['state_msg'] = '<div class="txtRd">' . $phpMussel['FE']['state_msg'] . '<br /><br /></div>';
        }
    } elseif ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['FrontEndLog'] .= ' - ' . $phpMussel['lang']['state_logged_in'] . "\n";
    }
    if ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['WriteMode'] = (
            !file_exists($phpMussel['Vault'] . $phpMussel['FrontEndLogFile']) || (
                $phpMussel['Config']['general']['truncate'] > 0 &&
                filesize($phpMussel['Vault'] . $phpMussel['FrontEndLogFile']) >= $phpMussel['ReadBytes']($phpMussel['Config']['general']['truncate'])
            )
        ) ? 'w' : 'a';
        if ($phpMussel['BuildLogPath']($phpMussel['FrontEndLogFile'])) {
            $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['FrontEndLogFile'], $phpMussel['WriteMode']);
            fwrite($phpMussel['Handle'], $phpMussel['FrontEndLog']);
            fclose($phpMussel['Handle']);
            if ($phpMussel['WriteMode'] === 'w') {
                $phpMussel['LogRotation']($phpMussel['Config']['general']['FrontEndLog']);
            }
        }
        unset($phpMussel['WriteMode'], $phpMussel['FrontEndLog'], $phpMussel['FrontEndLogFile']);
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

/** The user is attempting an asynchronous request without adequate permissions. */
if ($phpMussel['FE']['UserState'] !== 1 && $phpMussel['FE']['ASYNC']) {
    header('HTTP/1.0 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    header('Status: 403 Forbidden');
    die($phpMussel['lang']['state_async_deny']);
}

/** Only execute this code block for users that are logged in. */
if ($phpMussel['FE']['UserState'] === 1 && !$phpMussel['FE']['CronMode']) {

    if ($phpMussel['QueryVars']['phpmussel-page'] === 'logout') {

        /** Log out the user. */
        $phpMussel['FE']['SessionList'] = str_ireplace($phpMussel['FE']['ThisSession'], '', $phpMussel['FE']['SessionList']);
        $phpMussel['FE']['ThisSession'] = '';
        $phpMussel['FE']['Rebuild'] = true;
        $phpMussel['FE']['UserState'] = $phpMussel['FE']['Permissions'] = 0;
        setcookie('PHPMUSSEL-ADMIN', '', -1, '/', $phpMussel['HTTP_HOST'], false, true);

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

}

$phpMussel['FE']['bNavBR'] = ($phpMussel['FE']['UserState'] === 1) ? '<br /><br />' : '<br />';

/** The user hasn't logged in. Show them the login page. */
if ($phpMussel['FE']['UserState'] !== 1 && !$phpMussel['FE']['CronMode']) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_login'], $phpMussel['lang']['tip_login'], false);

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_login.html'))
    );

    /** Send output. */
    echo $phpMussel['SendOutput']();

}

/**
 * The user has logged in, but hasn't selected anything to view. Show them the
 * front-end home page.
 */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === '' && !$phpMussel['FE']['CronMode']) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_home'], $phpMussel['lang']['tip_home'], false);

    /** phpMussel version used. */
    $phpMussel['FE']['ScriptVersion'] = $phpMussel['ScriptVersion'];

    /** PHP version used. */
    $phpMussel['FE']['info_php'] = PHP_VERSION;

    /** SAPI used. */
    $phpMussel['FE']['info_sapi'] = php_sapi_name();

    /** Operating system used. */
    $phpMussel['FE']['info_os'] = php_uname();

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_logout'];

    /** Build repository backup locations information. */
    $phpMussel['FE']['BackupLocations'] = implode(' | ', [
        '<a href="https://bitbucket.org/Maikuolan/phpmussel">BitBucket</a>',
        '<a href="https://sourceforge.net/projects/phpmussel/">SourceForge</a>'
    ]);

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
            $phpMussel['ForceVersionWarning'] = (!empty($phpMussel['Remote-YAML-PHP-Array']['Branch'][$phpMussel['ThisBranch']]['WarnMin']) && (
                $phpMussel['Remote-YAML-PHP-Array']['Branch'][$phpMussel['ThisBranch']]['WarnMin'] === '*' ||
                $phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Remote-YAML-PHP-Array']['Branch'][$phpMussel['ThisBranch']]['WarnMin'])
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
    echo $phpMussel['SendOutput']();

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

    if (!$phpMussel['FE']['ASYNC']) {

        /** Page initial prepwork. */
        $phpMussel['InitialPrepwork']($phpMussel['lang']['title_accounts'], $phpMussel['lang']['tip_accounts']);

        /** Append async globals. */
        $phpMussel['FE']['JS'] .= sprintf(
            'window[%3$s]=\'accounts\';function acc(e,d,i,t){var o=function(e){%4$se)' .
            '},a=function(){%4$s\'%1$s\')};window.username=%2$s(e).value,window.passw' .
            'ord=%2$s(d).value,window.do=%2$s(t).value,\'delete-account\'==window.do&' .
            '&$(\'POST\',\'\',[%3$s,\'username\',\'password\',\'do\'],a,function(e){%' .
            '4$se),hideid(i)},o),\'update-password\'==window.do&&$(\'POST\',\'\',[%3$' .
            's,\'username\',\'password\',\'do\'],a,o,o)}' . "\n",
            $phpMussel['lang']['state_loading'],
            'document.getElementById',
            "'phpmussel-form-target'",
            "w('stateMsg',"
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
            $phpMussel['RowInfo']['AccPermissions'] = (int)substr($phpMussel['RowInfo']['AccPassword'], -1);
            if ($phpMussel['RowInfo']['AccPermissions'] === 1) {
                $phpMussel['RowInfo']['AccPermissions'] = $phpMussel['lang']['state_complete_access'];
            } elseif ($phpMussel['RowInfo']['AccPermissions'] === 2) {
                $phpMussel['RowInfo']['AccPermissions'] = $phpMussel['lang']['state_logs_access_only'];
            } elseif ($phpMussel['RowInfo']['AccPermissions'] === 3) {
                $phpMussel['RowInfo']['AccPermissions'] = 'Cronable';
            } else {
                $phpMussel['RowInfo']['AccPermissions'] = $phpMussel['lang']['response_error'];
            }
            $phpMussel['RowInfo']['AccPassword'] = substr($phpMussel['RowInfo']['AccPassword'], 0, -2);
            if ($phpMussel['RowInfo']['AccPassword'] === $phpMussel['FE']['DefaultPassword']) {
                $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $phpMussel['lang']['state_default_password'] . '</div>';
            } elseif ((
                strlen($phpMussel['RowInfo']['AccPassword']) !== 60 && strlen($phpMussel['RowInfo']['AccPassword']) !== 96
            ) || (
                strlen($phpMussel['RowInfo']['AccPassword']) === 60 && !preg_match('/^\$2.\$\d\d\$/', $phpMussel['RowInfo']['AccPassword'])
            ) || (
                strlen($phpMussel['RowInfo']['AccPassword']) === 96 && !preg_match('/^\$argon2i\$/', $phpMussel['RowInfo']['AccPassword'])
            )) {
                $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtRd">' . $phpMussel['lang']['state_password_not_valid'] . '</div>';
            }
            if (strrpos($phpMussel['FE']['SessionList'], "\n" . $phpMussel['RowInfo']['AccUsername'] . ',') !== false) {
                $phpMussel['RowInfo']['AccWarnings'] .= '<br /><div class="txtGn">' . $phpMussel['lang']['state_logged_in'] . '</div>';
            }
            $phpMussel['RowInfo']['AccID'] = bin2hex($phpMussel['RowInfo']['AccUsername']);
            $phpMussel['RowInfo']['AccUsername'] = htmlentities(base64_decode($phpMussel['RowInfo']['AccUsername']));
            $phpMussel['FE']['NewLineOffset'] = $phpMussel['FE']['NewLinePos'];
            $phpMussel['FE']['Accounts'] .= $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['RowInfo'], $phpMussel['FE']['AccountsRow']
            );
        }
        unset($phpMussel['RowInfo']);

    }

    if ($phpMussel['FE']['ASYNC']) {
        /** Send output (async). */
        echo $phpMussel['FE']['state_msg'];
    } else {

        /** Parse output. */
        $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_accounts.html'))
        );

        /** Send output. */
        echo $phpMussel['SendOutput']();

    }

}

/** Configuration. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'config' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_config'], $phpMussel['lang']['tip_config']);

    /** Append number localisation JS. */
    $phpMussel['FE']['JS'] .= $phpMussel['Number_L10N_JS']() . "\n";

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Directive template. */
    $phpMussel['FE']['ConfigRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_config_row.html'));

    /** Indexes. */
    $phpMussel['FE']['Indexes'] = '            ';

    /** Generate entries for display and regenerate configuration if any changes were submitted. */
    $phpMussel['FE']['ConfigFields'] = $phpMussel['RegenerateConfig'] = '';
    $phpMussel['ConfigModified'] = (!empty($phpMussel['QueryVars']['updated']) && $phpMussel['QueryVars']['updated'] === 'true');
    foreach ($phpMussel['Config']['Config Defaults'] as $phpMussel['CatKey'] => $phpMussel['CatValue']) {
        if (!is_array($phpMussel['CatValue'])) {
            continue;
        }
        $phpMussel['RegenerateConfig'] .= '[' . $phpMussel['CatKey'] . "]\r\n\r\n";
        $phpMussel['FE']['ConfigFields'] .= sprintf(
            '<table><tr><td class="ng2"><div id="%1$s-container" class="s">' .
            '<a id="%1$s-showlink" href="#%1$s-container" onclick="javascript:showid(\'%1$s-hidelink\');showid(\'%1$s-ihidelink\');hideid(\'%1$s-showlink\');hideid(\'%1$s-ishowlink\');show(\'%1$s-index\');show(\'%1$s-row\')">%1$s +</a>' .
            '<a id="%1$s-hidelink" %2$s href="javascript:void(0);" onclick="javascript:showid(\'%1$s-showlink\');showid(\'%1$s-ishowlink\');hideid(\'%1$s-hidelink\');hideid(\'%1$s-ihidelink\');hide(\'%1$s-index\');hide(\'%1$s-row\')">%1$s -</a>' .
            "</div></td></tr></table>\n<span class=\"%1\$s-row\" %2\$s><table>\n",
            $phpMussel['CatKey'],
            'style="display:none"'
        );
        $phpMussel['FE']['Indexes'] .= sprintf(
            '<a id="%1$s-ishowlink" href="#%1$s-container" onclick="javascript:showid(\'%1$s-hidelink\');showid(\'%1$s-ihidelink\');hideid(\'%1$s-showlink\');hideid(\'%1$s-ishowlink\');show(\'%1$s-index\');show(\'%1$s-row\')">%1$s +</a>' .
            '<a id="%1$s-ihidelink" style="display:none" href="javascript:void(0);" onclick="javascript:showid(\'%1$s-showlink\');showid(\'%1$s-ishowlink\');hideid(\'%1$s-hidelink\');hideid(\'%1$s-ihidelink\');hide(\'%1$s-index\');hide(\'%1$s-row\')">%1$s -</a>' .
            "<br /><br />\n            ",
            $phpMussel['CatKey']
        );
        foreach ($phpMussel['CatValue'] as $phpMussel['DirKey'] => $phpMussel['DirValue']) {
            $phpMussel['ThisDir'] = ['FieldOut' => '', 'CatKey' => $phpMussel['CatKey']];
            if (empty($phpMussel['DirValue']['type']) || !isset($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']])) {
                continue;
            }
            $phpMussel['ThisDir']['DirLangKey'] = 'config_' . $phpMussel['CatKey'] . '_' . $phpMussel['DirKey'];
            $phpMussel['ThisDir']['DirName'] = $phpMussel['CatKey'] . '-&gt;' . $phpMussel['DirKey'];
            $phpMussel['FE']['Indexes'] .= '<span class="' . $phpMussel['CatKey'] . '-index" style="display:none"><a href="#' . $phpMussel['ThisDir']['DirLangKey'] . '">' . $phpMussel['ThisDir']['DirName'] . "</a><br /><br /></span>\n            ";
            $phpMussel['ThisDir']['DirLang'] = !empty(
                $phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']]
            ) ? $phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']] : $phpMussel['lang']['response_error'];
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
                            '<script type="text/javascript">function %1$s_function(){var e=%7$s?%7$s(' .
                            '\'%1$s_field\').value:%8$s&&!%7$s?%8$s.%1$s_field.value:\'\',z=e.replace' .
                            '(/o$/i,\'b\').substr(-2).toLowerCase(),y=\'kb\'==z?1:\'mb\'==z?1024:\'gb' .
                            '\'==z?1048576:\'tb\'==z?1073741824:\'b\'==e.substr(-1)?.0009765625:1,e=e' .
                            '.replace(/[^0-9]*$/i,\'\'),e=isNaN(e)?0:e*y,t=0>e?\'0 %2$s\':1>e?nft((10' .
                            '24*e).toFixed(0))+\' %2$s\':1024>e?nft((1*e).toFixed(2))+\' %3$s\':10485' .
                            '76>e?nft((e/1024).toFixed(2))+\' %4$s\':1073741824>e?nft((e/1048576).toF' .
                            'ixed(2))+\' %5$s\':nft((e/1073741824).toFixed(2))+\' %6$s\';%7$s?%7$s(\'' .
                            '%1$s_preview\').innerHTML=t:%8$s&&!%7$s?%8$s.%1$s_preview.innerHTML=t:\'' .
                            '\'};%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['Plural'](0, $phpMussel['lang']['field_size_bytes']),
                        $phpMussel['lang']['field_size_KB'],
                        $phpMussel['lang']['field_size_MB'],
                        $phpMussel['lang']['field_size_GB'],
                        $phpMussel['lang']['field_size_TB'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'seconds') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/31536e3):0,e=e?e-31536e3*n:0,o=e?Math.fl' .
                            'oor(e/2592e3):0,e=e-2592e3*o,l=e?Math.floor(e/604800):0,e=e-604800*l,r=e' .
                            '?Math.floor(e/86400):0,e=e-86400*r,d=e?Math.floor(e/3600):0,e=e-3600*d,i' .
                            '=e?Math.floor(e/60):0,e=e-60*i,f=e?Math.floor(1*e):0,a=nft(n.toString())' .
                            '+\' %2$s – \'+nft(o.toString())+\' %3$s – \'+nft(l.toString())+\' %4$s –' .
                            ' \'+nft(r.toString())+\' %5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.' .
                            'toString())+\' %7$s – \'+nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_pr' .
                            'eview\').innerHTML=a:%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}' .
                            '%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'minutes') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/525600):0,e=e?e-525600*n:0,o=e?Math.floo' .
                            'r(e/43200):0,e=e-43200*o,l=e?Math.floor(e/10080):0,e=e-10080*l,r=e?Math.' .
                            'floor(e/1440):0,e=e-1440*r,d=e?Math.floor(e/60):0,e=e-60*d,i=e?Math.floo' .
                            'r(e*1):0,e=e-i,f=e?Math.floor(60*e):0,a=nft(n.toString())+\' %2$s – \'+n' .
                            'ft(o.toString())+\' %3$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toStr' .
                            'ing())+\' %5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.toString())+\' ' .
                            '%7$s – \'+nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_preview\').innerH' .
                            'TML=a:%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}%1$s_function();<' .
                            '/script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
                    );
                } elseif ($phpMussel['DirValue']['preview'] === 'hours') {
                    $phpMussel['ThisDir']['Preview'] .= sprintf(
                            '<script type="text/javascript">function %1$s_function(){var t=%9$s?%9$s(' .
                            '\'%1$s_field\').value:%10$s&&!%9$s?%10$s.%1$s_field.value:\'\',e=isNaN(t' .
                            ')?0:0>t?t*-1:t,n=e?Math.floor(e/8760):0,e=e?e-8760*n:0,o=e?Math.floor(e/' .
                            '720):0,e=e-720*o,l=e?Math.floor(e/168):0,e=e-168*l,r=e?Math.floor(e/24):' .
                            '0,e=e-24*r,d=e?Math.floor(e*1):0,e=e-d,i=e?Math.floor(60*e):0,e=e-(i/60)' .
                            ',f=e?Math.floor(3600*e):0,a=nft(n.toString())+\' %2$s – \'+nft(o.toStrin' .
                            'g())+\' %3$s – \'+nft(l.toString())+\' %4$s – \'+nft(r.toString())+\' ' .
                            '%5$s – \'+nft(d.toString())+\' %6$s – \'+nft(i.toString())+\' %7$s – \'+' .
                            'nft(f.toString())+\' %8$s\';%9$s?%9$s(\'%1$s_preview\').innerHTML=a:' .
                            '%10$s&&!%9$s?%10$s.%1$s_preview.innerHTML=a:\'\'}%1$s_function();</script>',
                        $phpMussel['ThisDir']['DirLangKey'],
                        $phpMussel['lang']['previewer_years'],
                        $phpMussel['lang']['previewer_months'],
                        $phpMussel['lang']['previewer_weeks'],
                        $phpMussel['lang']['previewer_days'],
                        $phpMussel['lang']['previewer_hours'],
                        $phpMussel['lang']['previewer_minutes'],
                        $phpMussel['lang']['previewer_seconds'],
                        'document.getElementById',
                        'document.all'
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
                $phpMussel['ThisDir']['FieldOut'] = '<select class="auto" name="' . $phpMussel['ThisDir']['DirLangKey'] . '" id="' . $phpMussel['ThisDir']['DirLangKey'] . '_field"' . $phpMussel['ThisDir']['Trigger'] . '>';
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
                    $phpMussel['ThisDir']['FieldOut'] .= '<option value="' . $phpMussel['ChoiceKey'] . '"' . ((
                        $phpMussel['ChoiceKey'] === $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']]
                    ) ? ' selected' : '') . '>' . $phpMussel['ChoiceValue'] . '</option>';
                }
                $phpMussel['ThisDir']['FieldOut'] .= '</select>';
            } elseif ($phpMussel['DirValue']['type'] === 'bool') {
                $phpMussel['ThisDir']['FieldOut'] = sprintf(
                    '<select class="auto" name="%1$s" id="%1$s_field"%2$s>' .
                    '<option value="true"%5$s>%3$s</option><option value="false"%6$s>%4$s</option>' .
                    '</select>',
                    $phpMussel['ThisDir']['DirLangKey'],
                    $phpMussel['ThisDir']['Trigger'],
                    $phpMussel['lang']['field_true'],
                    $phpMussel['lang']['field_false'],
                    ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] ? ' selected' : ''),
                    ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] ? '' : ' selected')
                );
            } elseif ($phpMussel['DirValue']['type'] === 'int' || $phpMussel['DirValue']['type'] === 'real') {
                $phpMussel['ThisDir']['FieldOut'] = sprintf(
                    '<input type="number" name="%1$s" id="%1$s_field" value="%2$s"%3$s%4$s />',
                    $phpMussel['ThisDir']['DirLangKey'],
                    $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']],
                    (isset($phpMussel['DirValue']['step']) ? ' step="' . $phpMussel['DirValue']['step'] . '"' : ''),
                    $phpMussel['ThisDir']['Trigger']
                );
            } elseif ($phpMussel['DirValue']['type'] === 'string') {
                $phpMussel['ThisDir']['FieldOut'] = '<textarea name="' . $phpMussel['ThisDir']['DirLangKey'] . '" id="' . $phpMussel['ThisDir']['DirLangKey'] . '_field" class="half"' . $phpMussel['ThisDir']['Trigger'] . '>' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '</textarea>';
            } else {
                $phpMussel['ThisDir']['FieldOut'] = '<input type="text" name="' . $phpMussel['ThisDir']['DirLangKey'] . '" id="' . $phpMussel['ThisDir']['DirLangKey'] . '_field" value="' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '"' . $phpMussel['ThisDir']['Trigger'] . ' />';
            }
            $phpMussel['ThisDir']['FieldOut'] .= $phpMussel['ThisDir']['Preview'];
            $phpMussel['FE']['ConfigFields'] .= $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['ThisDir'], $phpMussel['FE']['ConfigRow']
            );
        }
        $phpMussel['FE']['ConfigFields'] .= "</table></span>\n";
        $phpMussel['RegenerateConfig'] .= "\r\n";
    }

    /** Update the currently active configuration file if any changes were made. */
    if ($phpMussel['ConfigModified']) {
        $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_configuration_updated'];
        $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['FE']['ActiveConfigFile'], 'w');
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
    echo $phpMussel['SendOutput']();

}

/** Cache data. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'cache-data' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_cache_data'], $phpMussel['lang']['tip_cache_data']);

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    if ($phpMussel['FE']['ASYNC']) {

        /** Perform some function on a cache entry. */
        if (!empty($_POST['cdi']) && !empty($_POST['do'])) {
            if ($_POST['do'] === 'delete') {
                $phpMussel['CleanCache']($_POST['cdi']);
            } elseif ($_POST['do'] === 'show') {
                if ($phpMussel['Output'] = $phpMussel['FetchCache']($_POST['cdi'])) {
                    echo '<textarea readonly>' . str_replace(['<', '>'], ['&lt;', '&gt;'], $phpMussel['Output']) . '</textarea>';
                    if ($_POST['cdi'] === 'HashCache') {
                        foreach (explode(';', $phpMussel['Output']) as $phpMussel['ThisHash']) {
                            if (!$phpMussel['ThisHash']) {
                                continue;
                            }
                            $phpMussel['ThisHash'] = explode(':', $phpMussel['ThisHash']);
                            echo '<small>' . sprintf(
                                '"%1$s"<br />%2$s%3$s<br />%4$s%5$s',
                                $phpMussel['ThisHash'][0],
                                $phpMussel['lang']['label_expires'],
                                ($phpMussel['ThisHash'][1] >= 0 ? $phpMussel['TimeFormat'](
                                    $phpMussel['ThisHash'][1],
                                    $phpMussel['Config']['general']['timeFormat']
                                ) : $phpMussel['lang']['label_never']),
                                '<code>' . ($phpMussel['ThisHash'][2] ? str_replace(['<', '>'], ['&lt;', '&gt;'], $phpMussel['HexSafe']($phpMussel['ThisHash'][2])) : $phpMussel['lang']['scan_no_problems_found']) . '</code><br />',
                                '<code>' . ($phpMussel['ThisHash'][3] ? str_replace(['<', '>'], ['&lt;', '&gt;'], $phpMussel['HexSafe']($phpMussel['ThisHash'][3])) : $phpMussel['lang']['scan_no_problems_found']) . '</code>'
                            ) . '</small><hr />';
                        }
                        unset($phpMussel['ThisHash']);
                    }
                }
            }
        }

        /** Perform some function on a cache entry (the front-end cache). */
        elseif (!empty($_POST['fecdi']) && !empty($_POST['do'])) {
            if ($_POST['do'] === 'delete') {
                $phpMussel['FECacheRemove']($phpMussel['FE']['Cache'], $phpMussel['FE']['Rebuild'], $_POST['fecdi']);
            } elseif ($_POST['do'] === 'show') {
                if ($phpMussel['Output'] = $phpMussel['FECacheGet']($phpMussel['FE']['Cache'], $_POST['fecdi'])) {
                    echo '<textarea readonly>' . str_replace(['<', '>'], ['&lt;', '&gt;'], $phpMussel['Output']) . '</textarea>';
                }
            }
        }

    } else {

        /** Append async globals. */
        $phpMussel['FE']['JS'] .=
            "function cdd(d,n){window.cdi=d,window.do=null==n?'delete':'show',$('POST',''" .
            ",['phpmussel-form-target','cdi','do'],null,function(o){null==n?hideid(d+'Con" .
            "tainer'):(w(d+'ID',r(d+'ID')+o),hideid(d+'SB'))})}window['phpmussel-form-tar" .
            "get']='cache-data';function fecdd(d,n){window.fecdi=d,window.do=null==n?'del" .
            "ete':'show',$('POST','',['phpmussel-form-target','fecdi','do'],null,function" .
            "(o){null==n?hideid(d+'FEContainer'):(w(d+'FEID',r(d+'FEID')+o),hideid(d+'FES" .
            "B'))})}window['phpmussel-form-target']='cache-data';";

        /** To be populated by the cache data. */
        $phpMussel['FE']['CacheData'] = '';

        /** Get cache index data. */
        if ($phpMussel['CacheIndexData'] = $phpMussel['ReadFile']($phpMussel['cachePath'] . 'index.dat')) {
            foreach (explode(';', $phpMussel['CacheIndexData']) as $phpMussel['CacheIndexData']) {
                if (!$phpMussel['CacheIndexData']) {
                    continue;
                }
                $phpMussel['CacheIndexData'] = explode(':', $phpMussel['CacheIndexData']);
                if ($phpMussel['CacheIndexData'][0] > 0 && $phpMussel['Time'] >= $phpMussel['CacheIndexData'][0]) {
                    continue;
                }
                $phpMussel['CacheIndexData'][2] = (
                    $phpMussel['ThisCacheData'] = $phpMussel['FetchCache']($phpMussel['CacheIndexData'][0])
                ) ? strlen($phpMussel['ThisCacheData']) : 0;
                $phpMussel['FormatFilesize']($phpMussel['CacheIndexData'][2]);
                $phpMussel['CacheIndexData'][3] = bin2hex(substr($phpMussel['CacheIndexData'][0], 0, 1)) . '.tmp';
                $phpMussel['FE']['CacheData'] .= sprintf(
                    "\n        " .
                    '<div class="ng1" id="%1$sContainer"><span class="s">"cache/%4$s" -&gt; "%1$s"<br /><small>%7$s%3$s<br />%8$s%2$s</small><div id="%1$sID">' .
                    '<input onclick="javascript:cdd(\'%1$s\')" type="button" value="%6$s" class="auto" /> ' .
                    '<input onclick="javascript:cdd(\'%1$s\',1)" id="%1$sSB" type="button" value="%5$s" class="auto" />' .
                    '</div></span></div>',
                    $phpMussel['CacheIndexData'][0],
                    ($phpMussel['CacheIndexData'][1] >= 0 ? $phpMussel['TimeFormat'](
                        $phpMussel['CacheIndexData'][1],
                        $phpMussel['Config']['general']['timeFormat']
                    ) : $phpMussel['lang']['label_never']),
                    $phpMussel['CacheIndexData'][2],
                    $phpMussel['CacheIndexData'][3],
                    $phpMussel['lang']['label_show'],
                    $phpMussel['lang']['field_delete_file'],
                    $phpMussel['lang']['field_size'],
                    $phpMussel['lang']['label_expires']
                ) . "\n";
            }
        }

        /** Get front-end cache data. */
        if ($phpMussel['CacheIndexData'] = $phpMussel['FE']['Cache']) {
            foreach (explode("\n", $phpMussel['CacheIndexData']) as $phpMussel['CacheIndexData']) {
                if (!$phpMussel['CacheIndexData']) {
                    continue;
                }
                $phpMussel['CacheIndexData'] = explode(',', $phpMussel['CacheIndexData']);
                $phpMussel['CacheIndexData'][0] = base64_decode($phpMussel['CacheIndexData'][0]);
                $phpMussel['CacheIndexData'][3] = strlen(base64_decode($phpMussel['CacheIndexData'][1]));
                $phpMussel['FormatFilesize']($phpMussel['CacheIndexData'][3]);
                $phpMussel['FE']['CacheData'] .= sprintf(
                    "\n        " .
                    '<div class="ng1" id="%1$sFEContainer"><span class="s">"fe_assets/frontend.dat" -&gt; "%1$s"<br /><small>%2$s%3$s<br />%4$s%5$s</small><div id="%1$sFEID">' .
                    '<input onclick="javascript:fecdd(\'%1$s\')" type="button" value="%7$s" class="auto" /> ' .
                    '<input onclick="javascript:fecdd(\'%1$s\',1)" id="%1$sFESB" type="button" value="%6$s" class="auto" />' .
                    '</div></span></div>',
                    $phpMussel['CacheIndexData'][0],
                    $phpMussel['lang']['field_size'],
                    $phpMussel['CacheIndexData'][3],
                    $phpMussel['lang']['label_expires'],
                    ($phpMussel['CacheIndexData'][2] >= 0 ? $phpMussel['TimeFormat'](
                        $phpMussel['CacheIndexData'][2],
                        $phpMussel['Config']['general']['timeFormat']
                    ) : $phpMussel['lang']['label_never']),
                    $phpMussel['lang']['label_show'],
                    $phpMussel['lang']['field_delete_file']
                ) . "\n";
            }
        }

        /** Cache is empty. */
        if (!$phpMussel['FE']['CacheData']) {
            $phpMussel['FE']['CacheData'] = '<div class="ng1"><span class="s">' . $phpMussel['lang']['state_cache_is_empty'] . '</span></div>';
        }

        /** Cleanup. */
        unset($phpMussel['ThisCacheData'], $phpMussel['CacheIndexData']);

        /** Parse output. */
        $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_cache.html'))
        );

        /** Send output. */
        echo $phpMussel['SendOutput']();

    }

}

/** Updates. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'updates' && ($phpMussel['FE']['Permissions'] === 1 || ($phpMussel['FE']['Permissions'] === 3 && $phpMussel['FE']['CronMode']))) {

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
    if (empty($phpMussel['Alternate']) && $phpMussel['FE']['FormTarget'] === 'updates' && !empty($_POST['do']) && !empty($_POST['ID'])) {

        /** Trigger updates handler. */
        $phpMussel['UpdatesHandler']($_POST['do'], $_POST['ID']);

    }

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_updates'], $phpMussel['lang']['tip_updates']);

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['UpdatesRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_updates_row.html'));

    $phpMussel['Components'] = [
        'Meta' => $phpMussel['Components']['Meta'],
        'RemoteMeta' => $phpMussel['Components']['RemoteMeta'],
        'Remotes' => [],
        'Dependencies' => [],
        'Outdated' => [],
        'Verify' => [],
        'Out' => []
    ];

    /** Prepare installed component metadata and options for display. */
    foreach ($phpMussel['Components']['Meta'] as $phpMussel['Components']['Key'] => &$phpMussel['Components']['ThisComponent']) {

        /** Skip if component is malformed. */
        if (empty($phpMussel['Components']['ThisComponent']['Name']) && empty($phpMussel['lang']['Name: ' . $phpMussel['Components']['Key']])) {
            $phpMussel['Components']['ThisComponent'] = '';
            continue;
        }

        /** Execute any necessary preload instructions. */
        if (!empty($phpMussel['Components']['ThisComponent']['When Checking'])) {
            $phpMussel['FE_Executor']($phpMussel['Components']['ThisComponent']['When Checking']);
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
        if (!empty($phpMussel['Components']['ThisComponent']['Files'])) {
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']);
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['To']);
            $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['From']);
            if (isset($phpMussel['Components']['ThisComponent']['Files']['Checksum'])) {
                $phpMussel['Arrayify']($phpMussel['Components']['ThisComponent']['Files']['Checksum']);
            }
        }
        if (empty($phpMussel['Components']['ThisComponent']['Remote'])) {
            $phpMussel['Components']['ThisComponent']['RemoteData'] = $phpMussel['lang']['response_updates_unable_to_determine'];
            if (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
            }
        } else {
            $phpMussel['FetchRemote']();
            if (
                substr($phpMussel['Components']['ThisComponent']['RemoteData'], 0, 4) === "---\n" &&
                ($phpMussel['Components']['EoYAML'] = strpos(
                    $phpMussel['Components']['ThisComponent']['RemoteData'], "\n\n"
                )) !== false
            ) {

                /** Process remote components metadata. */
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
                $phpMussel['Activable'] = $phpMussel['IsActivable']($phpMussel['Components']['ThisComponent']);
                if (
                    ($phpMussel['Components']['Key'] === 'l10n/' . $phpMussel['Config']['general']['lang']) ||
                    ($phpMussel['Components']['Key'] === 'theme/' . $phpMussel['Config']['template_data']['theme']) ||
                    ($phpMussel['Components']['Key'] === 'phpMussel') ||
                    $phpMussel['IsInUse']($phpMussel['Components']['ThisComponent'])
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
            } elseif ($phpMussel['Components']['ThisComponent']['StatusOptions'] === $phpMussel['lang']['response_updates_not_installed']) {
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
            $phpMussel['Components']['ThisComponent']['Options'] .=
                '<option value="verify-component">' . $phpMussel['lang']['field_verify'] . '</option>';
            $phpMussel['Components']['Verify'][] = $phpMussel['Components']['Key'];
            array_walk($phpMussel['Components']['ThisComponent']['Files']['Checksum'], function ($Checksum) use (&$phpMussel) {
                if (!empty($Checksum) && ($Delimiter = strpos($Checksum, ':')) !== false) {
                    $phpMussel['Components']['ThisComponent']['VersionSize'] += (int)substr($Checksum, $Delimiter + 1);
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
                    $phpMussel['Components']['ThisComponent']['LatestSize'] += (int)substr($Checksum, $Delimiter + 1);
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

    /** Update request via Cronable. */
    if (!empty($phpMussel['Alternate']) && !empty($UpdateAll) && !empty($phpMussel['Components']['Outdated'])) {

        /** Trigger updates handler. */
        $phpMussel['UpdatesHandler']('update-component', $phpMussel['Components']['Outdated']);

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
    /** Cleanup. */
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

    $phpMussel['Components']['CountOutdated'] = count($phpMussel['Components']['Outdated']);
    $phpMussel['Components']['CountVerify'] = count($phpMussel['Components']['Verify']);

    /** Preparing for update all and verify all buttons. */
    $phpMussel['FE']['UpdateAll'] = ($phpMussel['Components']['CountOutdated'] || $phpMussel['Components']['CountVerify']) ? '<hr />' : '';

    /** Instructions to update everything at once. */
    if ($phpMussel['Components']['CountOutdated']) {
        $phpMussel['FE']['UpdateAll'] .=
            '<form action="?' . $phpMussel['FE']['UpdatesFormTarget'] .
            '" method="POST" style="display:inline"><input name="phpmussel-form-target" type="hidden" value="updates" />' .
            '<input name="do" type="hidden" value="update-component" />';
        foreach ($phpMussel['Components']['Outdated'] as $phpMussel['Components']['ThisOutdated']) {
            $phpMussel['FE']['UpdateAll'] .= '<input name="ID[]" type="hidden" value="' . $phpMussel['Components']['ThisOutdated'] . '" />';
        }
        $phpMussel['FE']['UpdateAll'] .= '<input type="submit" value="' . $phpMussel['lang']['field_update_all'] . '" class="auto" /></form>';
    }

    /** Instructions to verify everything at once. */
    if ($phpMussel['Components']['CountVerify']) {
        $phpMussel['FE']['UpdateAll'] .=
            '<form action="?' . $phpMussel['FE']['UpdatesFormTarget'] .
            '" method="POST" style="display:inline"><input name="phpmussel-form-target" type="hidden" value="updates" />' .
            '<input name="do" type="hidden" value="verify-component" />';
        foreach ($phpMussel['Components']['Verify'] as $phpMussel['Components']['ThisVerify']) {
            $phpMussel['FE']['UpdateAll'] .= '<input name="ID[]" type="hidden" value="' . $phpMussel['Components']['ThisVerify'] . '" />';
        }
        $phpMussel['FE']['UpdateAll'] .= '<input type="submit" value="' . $phpMussel['lang']['field_verify_all'] . '" class="auto" /></form>';
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

    /** Send output. */
    if (!$phpMussel['FE']['CronMode']) {
        /** Normal page output. */
        echo $phpMussel['SendOutput']();
    } elseif (!empty($UpdateAll)) {
        /** Returned state message for cronable (locally updating). */
        $Results = ['state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $phpMussel['FE']['state_msg'])];
    } elseif (!empty($phpMussel['FE']['state_msg'])) {
        /** Returned state message for cronable. */
        echo json_encode([
            'state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $phpMussel['FE']['state_msg'])
        ]);
    } elseif (!empty($_POST['do']) && $_POST['do'] === 'get-list' && count($phpMussel['Components']['Outdated'])) {
        /** Returned list of outdated components for cronable. */
        echo json_encode([
            'state_msg' => str_ireplace(['<code>', '</code>', '<br />'], ['[', ']', "\n"], $phpMussel['FE']['state_msg']),
            'outdated' => $phpMussel['Components']['Outdated']
        ]);
    }

    /** Cleanup. */
    unset($phpMussel['Components']);

}

/** File Manager. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'file-manager' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_file_manager'], $phpMussel['lang']['tip_file_manager'], false);

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
                if ($phpMussel['IsDirEmpty']($phpMussel['Vault'] . $_FILES['upload-file']['name'])) {
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
                if ($phpMussel['IsDirEmpty']($phpMussel['Vault'] . $_POST['filename'])) {
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
                        if ($phpMussel['IsDirEmpty']($phpMussel['Vault'] . $_POST['filename_new'])) {
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
                echo $phpMussel['SendOutput']();
                die;

            }

        /** Edit a file. */
        } elseif ($_POST['do'] === 'edit-file') {

            if (isset($_POST['content'])) {

                $_POST['content'] = str_replace("\r", '', $_POST['content']);
                $phpMussel['OldData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . $_POST['filename']);
                if (strpos($phpMussel['OldData'], "\r\n") !== false && strpos($phpMussel['OldData'], "\n\n") === false) {
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
                echo $phpMussel['SendOutput']();
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
        if (!$ThisFile['Directory'] || $phpMussel['IsDirEmpty']($phpMussel['Vault'] . $ThisFile['Filename'])) {
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
    echo $phpMussel['SendOutput']();

}

/** Upload Test. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'upload-test' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_upload_test'], $phpMussel['lang']['tip_upload_test'], false);

    $phpMussel['FE']['MaxFilesize'] = $phpMussel['ReadBytes']($phpMussel['Config']['files']['filesize_limit']);

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_upload_test.html'))
    );

    /** Send output. */
    echo $phpMussel['SendOutput']();

}

/** Quarantine. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'quarantine') {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_quarantine'], $phpMussel['lang']['tip_quarantine']);

    /** Display how to enable quarantine if currently disabled. */
    if (!$phpMussel['Config']['general']['quarantine_key']) {
        $phpMussel['FE']['state_msg'] .= '<span class="txtRd">' . $phpMussel['lang']['tip_quarantine_disabled'] . '</span><br />';
    }

    /** Generate confirm button. */
    $phpMussel['FE']['Confirm-DeleteAll'] = $phpMussel['GenerateConfirm']($phpMussel['lang']['field_delete_all'], 'quarantineForm');

    /** Append necessary quarantine JS. */
    $phpMussel['FE']['JS'] .= "function qOpt(e){b=document.getElementById(e+'-S'),'delete-file'==b.value?hideid(e):showid(e)}\n";

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
    echo $phpMussel['SendOutput']();

}

/** Signature information. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'siginfo' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_siginfo'], $phpMussel['lang']['tip_siginfo']);

    /** Append number localisation JS. */
    $phpMussel['FE']['JS'] .= $phpMussel['Number_L10N_JS']() . "\n";

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Template for range rows. */
    $phpMussel['FE']['InfoRow'] = $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_siginfo_row.html'));

    /** Process signature files and fetch relevant values. */
    $phpMussel['FE']['InfoRows'] = $phpMussel['SigInfoHandler'](
        array_unique(explode(',', $phpMussel['Config']['signatures']['Active']))
    );

    /** Calculate and append page load time, and append totals. */
    $phpMussel['FE']['ProcTime'] = '<div class="s">' . sprintf(
        $phpMussel['lang']['state_loadtime'],
        $phpMussel['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3)
    ) . '</div>';

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['GetAssetPath']('_siginfo.html'))
    );

    /** Send output. */
    echo $phpMussel['SendOutput']();

}

/** Statistics. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'statistics' && $phpMussel['FE']['Permissions'] === 1) {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_statistics'], $phpMussel['lang']['tip_statistics'], false);

    /** Display how to enable statistics if currently disabled. */
    if (!$phpMussel['Config']['general']['statistics']) {
        $phpMussel['FE']['state_msg'] .= '<span class="txtRd">' . $phpMussel['lang']['tip_statistics_disabled'] . '</span><br />';
    }

    /** Generate confirm button. */
    $phpMussel['FE']['Confirm-ClearAll'] = $phpMussel['GenerateConfirm']($phpMussel['lang']['field_clear_all'], 'statForm');

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
    echo $phpMussel['SendOutput']();

    /** Cleanup. */
    unset($phpMussel['StatColour'], $phpMussel['StatWorking'], $phpMussel['Statistics']);

}

/** Logs. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'logs') {

    /** Page initial prepwork. */
    $phpMussel['InitialPrepwork']($phpMussel['lang']['title_logs'], $phpMussel['lang']['tip_logs'], false);

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
        if (strtolower(substr($phpMussel['QueryVars']['logfile'], -3)) === '.gz') {
            $phpMussel['GZLogHandler'] = gzopen($phpMussel['Vault'] . $phpMussel['QueryVars']['logfile'], 'rb');
            $phpMussel['FE']['logfileData'] = '';
            if (is_resource($phpMussel['GZLogHandler'])) {
                while (!gzeof($phpMussel['GZLogHandler'])) {
                    $phpMussel['FE']['logfileData'] .= gzread($phpMussel['GZLogHandler'], 131072);
                }
                gzclose($phpMussel['GZLogHandler']);
            }
            unset($phpMussel['GZLogHandler']);
        } else {
            $phpMussel['FE']['logfileData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['QueryVars']['logfile']);
        }
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
    } else {
        $phpMussel['FE']['logfileData'] = '<div class="fW">' . $phpMussel['FE']['logfileData'] . '</div>';
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

    /** Calculate page load time (useful for debugging). */
    $phpMussel['FE']['ProcessTime'] = '<br />' . sprintf($phpMussel['lang']['state_loadtime'], $phpMussel['Number_L10N'](microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3));

    /** Set logfile list or no logfiles available message. */
    $phpMussel['FE']['LogFiles'] = $phpMussel['FE']['LogFiles']['Out'] ?: $phpMussel['lang']['logs_no_logfiles_available'];

    /** Send output. */
    echo $phpMussel['SendOutput']();

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

/** Print Cronable failure state messages here. */
if ($phpMussel['FE']['CronMode'] && $phpMussel['FE']['state_msg'] && $phpMussel['FE']['UserState'] !== 1) {
    if (empty($UpdateAll)) {
        echo json_encode(['state_msg' => $phpMussel['FE']['state_msg']]);
    } else {
        $Results = ['state_msg' => $phpMussel['FE']['state_msg']];
    }
}

/** Exit front-end. */
if (empty($phpMussel['Alternate']) && empty($UpdateAll)) {
    die;
}
