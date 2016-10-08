<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Front-end handler (last modified: 2016.10.08).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Set page selector if not already set. */
if (empty($phpMussel['QueryVars']['phpmussel-page'])) {
    $phpMussel['QueryVars']['phpmussel-page'] = '';
}

$phpMussel['Now'] = time() + ($phpMussel['Config']['general']['timeOffset'] * 60);

/** Populate common front-end variables. */
$phpMussel['FE'] = array(
    'Template' => $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/frontend.html'),
    'DateTime' => date('r', $phpMussel['Now']),
    'ScriptIdent' => $phpMussel['ScriptIdent'],
    'UserList' => "\n",
    'SessionList' => "\n",
    'UserState' => 0,
    'UserRaw' => '',
    'UserLevel' => 0,
    'state_msg' => '',
    'ThisSession' => '',
    'bNav' => '&nbsp;',
    'FE_Title' => ''
);

/** Fetch user list and sessions list. */
if (file_exists($phpMussel['vault'] . 'fe_assets/frontend.dat')) {
    $phpMussel['FE']['FrontEndData'] = $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/frontend.dat');
    $phpMussel['FE']['Rebuild'] = false;
} else {
    $phpMussel['FE']['FrontEndData'] = "USERS\n-----\nYWRtaW4=,\$2y\$10\$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK,1\n\nSESSIONS\n--------\n";
    $phpMussel['FE']['Rebuild'] = true;
}
$phpMussel['FE']['UserListPos'] = strpos($phpMussel['FE']['FrontEndData'], "USERS\n-----\n");
$phpMussel['FE']['SessionListPos'] = strpos($phpMussel['FE']['FrontEndData'], "SESSIONS\n--------\n");
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
        $phpMussel['FE']['SessionListPos'] + 17
    );
}

/** Clear expired sessions. */
$phpMussel['ClearExpired']($phpMussel['FE']['SessionList'], $phpMussel['FE']['Rebuild']);

/** A fix for correctly displaying LTR/RTL text. */
if (empty($phpMussel['Config']['lang']['textDir']) || $phpMussel['Config']['lang']['textDir'] !== 'rtl') {
    $phpMussel['Config']['lang']['textDir'] = 'ltr';
    $phpMussel['FE']['FE_Align'] = 'left';
} else {
    $phpMussel['FE']['FE_Align'] = 'right';
}

/** Attempt to log in the user. */
if (!empty($_POST['username']) && empty($_POST['password'])) {
    $phpMussel['FE']['UserState'] = -1;
    $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['Config']['lang']['error_login_password_field_empty']);
} elseif (empty($_POST['username']) && !empty($_POST['password'])) {
    $phpMussel['FE']['UserState'] = -1;
    $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['Config']['lang']['error_login_username_field_empty']);
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
        $phpMussel['FE']['UserLevel'] = (int)substr($phpMussel['FE']['Password'], -1);
        $phpMussel['FE']['Password'] = substr($phpMussel['FE']['Password'], 0, -2);
        if (password_verify($_POST['password'], $phpMussel['FE']['Password'])) {
            $phpMussel['FE']['SessionKey'] = md5($phpMussel['GenerateSalt']());
            $phpMussel['FE']['Cookie'] = $_POST['username'] . $phpMussel['FE']['SessionKey'];
            setcookie('PHPMUSSEL-ADMIN', $phpMussel['FE']['Cookie'], $phpMussel['Now'] + 604800, '/', (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '', false, true);
            $phpMussel['FE']['UserState'] = 1;
            $phpMussel['FE']['ThisSession'] =
                $phpMussel['FE']['User'] . ',' .
                password_hash($phpMussel['FE']['SessionKey'], PASSWORD_DEFAULT) . ',' .
                ($phpMussel['Now'] + 604800) . "\n";
            $phpMussel['FE']['SessionList'] .= $phpMussel['FE']['ThisSession'];
            $phpMussel['FE']['Rebuild'] = true;
        } else {
            $phpMussel['FE']['UserLevel'] = 0;
            $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['Config']['lang']['error_login_invalid_password']);
        }
    } else {
        $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['Config']['lang']['error_login_invalid_username']);
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
            $phpMussel['FE']['SEDelimiter'] = strpos($phpMussel['FE']['SessionEntry'], ',');
            if ($phpMussel['FE']['SEDelimiter'] !== false) {
                $phpMussel['FE']['Expiry'] = (int)substr($phpMussel['FE']['SessionEntry'], $phpMussel['FE']['SEDelimiter'] + 1);
                $phpMussel['FE']['UserHash'] = substr($phpMussel['FE']['SessionEntry'], 0, $phpMussel['FE']['SEDelimiter']);
            }
            if (
                !empty($phpMussel['FE']['Expiry']) &&
                !empty($phpMussel['FE']['UserHash']) &&
                ($phpMussel['FE']['Expiry'] > $phpMussel['Now']) &&
                password_verify($phpMussel['FE']['SessionKey'], $phpMussel['FE']['UserHash'])
            ) {
                $phpMussel['FE']['UserPos'] = strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['User'] . ',');
                if ($phpMussel['FE']['UserPos'] !== false) {
                    $phpMussel['FE']['ThisSession'] = $phpMussel['FE']['User'] . ',' . $phpMussel['FE']['SessionEntry'] . "\n";
                    $phpMussel['FE']['UserOffset'] = $phpMussel['FE']['UserPos'] + $phpMussel['FE']['UserLen'] + 2;
                    $phpMussel['FE']['UserLevel'] = (int)substr(substr(
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
        $phpMussel['FE']['UserState'] = $phpMussel['FE']['UserLevel'] = 0;
        setcookie('PHPMUSSEL-ADMIN', '', -1, '/', (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '', false, true);

    } else {

        /** Generate default tooltip for the user ("Hello, {username}"). */
        $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
            array('username' => $phpMussel['FE']['UserRaw']),
            $phpMussel['Config']['lang']['tip_hello']
        );

    }
}

/** The user hasn't logged in. Show them the login page. */
if ($phpMussel['FE']['UserState'] !== 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_login'];

    $phpMussel['FE']['FE_Tip'] = $phpMussel['Config']['lang']['tip_login'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_login.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/**
 * The user has logged in, but hasn't selected anything to view. Show them the
 * front-end home page.
 */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === '') {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_home'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_logout'];

    if ($phpMussel['FE']['UserLevel'] === 1) {

        $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
            $phpMussel['Config']['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_home_admin.html')
        );

    } elseif ($phpMussel['FE']['UserLevel'] === 2) {

        $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
            $phpMussel['Config']['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_home_mod.html')
        );

    }

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Accounts. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'accounts' && $phpMussel['FE']['UserLevel'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_accounts'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_accounts.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Configuration. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'config' && $phpMussel['FE']['UserLevel'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_config'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_config.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Greylist. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'greylist' && $phpMussel['FE']['UserLevel'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_greylist'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_greylist.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Updates. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'updates' && $phpMussel['FE']['UserLevel'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_updates'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_updates.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Logs. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'logs') {

    $phpMussel['FE']['FE_Title'] = $phpMussel['Config']['lang']['title_logs'];

    $phpMussel['FE']['FE_Tip'] = $phpMussel['Config']['lang']['tip_logs'];

    $phpMussel['FE']['bNav'] = $phpMussel['Config']['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['Config']['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_logs.html')
    );

    $phpMussel['FE']['LogFiles'] = array(
        'Files' => scandir($phpMussel['vault']),
        'Types' => ',txt,log,',
        'Out' => ''
    );

    if (empty($phpMussel['QueryVars']['logfile'])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['Config']['lang']['logs_no_logfile_selected'];
    } elseif (
        file_exists($phpMussel['vault'] . $phpMussel['QueryVars']['logfile']) &&
        !preg_match("\x01(?:^\.|\.\.|[\x01-\x1f\[-`/\?\*\$])\x01i", $phpMussel['QueryVars']['logfile']) &&
        (strpos(
            $phpMussel['FE']['LogFiles']['Types'],
            strtolower(substr($phpMussel['QueryVars']['logfile'], -3))
        ) !== false)
    ) {
        $phpMussel['FE']['logfileData'] = $phpMussel['ReadFile']($phpMussel['vault'] . $phpMussel['QueryVars']['logfile']);
        $phpMussel['FE']['logfileData'] = str_replace(
            array('<', '>', "\r", "\n"),
            array('&lt;', '&gt;', '', "<br />\n"),
            $phpMussel['FE']['logfileData']
        );
    } else {
        $phpMussel['FE']['logfileData'] = $phpMussel['Config']['lang']['logs_logfile_doesnt_exist'];
    }

    $phpMussel['FE']['LogFiles']['Count'] = count($phpMussel['FE']['LogFiles']['Files']);
    for (
        $phpMussel['FE']['LogFiles']['Iterate'] = 0;
        $phpMussel['FE']['LogFiles']['Iterate'] < $phpMussel['FE']['LogFiles']['Count'];
        $phpMussel['FE']['LogFiles']['Iterate']++
    ) {
        if (strpos(
            $phpMussel['FE']['LogFiles']['Types'],
            strtolower(substr($phpMussel['FE']['LogFiles']['Files'][$phpMussel['FE']['LogFiles']['Iterate']], -3))
        ) !== false) {
            $phpMussel['FE']['LogFiles']['This'] = $phpMussel['FE']['LogFiles']['Files'][$phpMussel['FE']['LogFiles']['Iterate']];
            $phpMussel['FE']['LogFiles']['Filesize'] = filesize($phpMussel['vault'] . $phpMussel['FE']['LogFiles']['This']);
            $phpMussel['FormatFilesize']($phpMussel['FE']['LogFiles']['Filesize']);
            $phpMussel['FE']['LogFiles']['Out'] .= sprintf(
                '            <a href="?phpmussel-page=logs&logfile=%1$s">%1$s</a> – %2$s<br />',
                $phpMussel['FE']['LogFiles']['This'],
                $phpMussel['FE']['LogFiles']['Filesize']
            ) . "\n";
        }
    }
    if (!$phpMussel['FE']['LogFiles'] = $phpMussel['FE']['LogFiles']['Out']) {
        $phpMussel['FE']['LogFiles'] = $phpMussel['Config']['lang']['logs_no_logfiles_available'];
    }

    echo $phpMussel['ParseVars']($phpMussel['Config']['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

if ($phpMussel['FE']['Rebuild']) {
    $phpMussel['FE']['FrontEndData'] = "USERS\n-----" . $phpMussel['FE']['UserList'] . "\nSESSIONS\n--------" . $phpMussel['FE']['SessionList'];
    $phpMussel['FE']['Handle'] = fopen($phpMussel['vault'] . 'fe_assets/frontend.dat', 'w');
    fwrite($phpMussel['FE']['Handle'], $phpMussel['FE']['FrontEndData']);
    fclose($phpMussel['FE']['Handle']);
}

die;
