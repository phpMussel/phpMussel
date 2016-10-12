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
 * This file: Front-end handler (last modified: 2016.10.12).
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
    'DefaultPassword' => '$2y$10$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK',
    'FE_Lang' => $phpMussel['Config']['general']['lang'],
    'DateTime' => date('r', $phpMussel['Now']),
    'ScriptIdent' => $phpMussel['ScriptIdent'],
    'Traverse' => "\x01(?:^\.|\.\.|[\x01-\x1f\[-`/\?\*\$])\x01i",
    'UserList' => "\n",
    'SessionList' => "\n",
    'UserState' => 0,
    'UserRaw' => '',
    'Permissions' => 0,
    'state_msg' => '',
    'ThisSession' => '',
    'bNav' => '&nbsp;',
    'FE_Title' => ''
);

/** A fix for correctly displaying LTR/RTL text. */
if (empty($phpMussel['lang']['textDir']) || $phpMussel['lang']['textDir'] !== 'rtl') {
    $phpMussel['lang']['textDir'] = 'ltr';
    $phpMussel['FE']['FE_Align'] = 'left';
} else {
    $phpMussel['FE']['FE_Align'] = 'right';
}

/** A simple passthru for the front-end CSS. */
if ($phpMussel['QueryVars']['phpmussel-page'] === 'css') {
    header('Content-Type: text/css');
    echo $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/frontend.css')
    );
    die;
}

/** Set form target if not already set. */
$phpMussel['FE']['FormTarget'] = (empty($_POST['phpmussel-form-target'])) ? '' : $_POST['phpmussel-form-target'];

/** Fetch user list and sessions list. */
if (file_exists($phpMussel['vault'] . 'fe_assets/frontend.dat')) {
    $phpMussel['FE']['FrontEndData'] = $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/frontend.dat');
    $phpMussel['FE']['Rebuild'] = false;
} else {
    $phpMussel['FE']['FrontEndData'] = "USERS\n-----\nYWRtaW4=," . $phpMussel['FE']['DefaultPassword'] . ",1\n\nSESSIONS\n--------\n";
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

/** Attempt to log in the user. */
if ($phpMussel['FE']['FormTarget'] === 'login') {
    if (!empty($_POST['username']) && empty($_POST['password'])) {
        $phpMussel['FE']['UserState'] = -1;
        $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['lang']['response_login_password_field_empty']);
    } elseif (empty($_POST['username']) && !empty($_POST['password'])) {
        $phpMussel['FE']['UserState'] = -1;
        $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['lang']['response_login_username_field_empty']);
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
                $phpMussel['FE']['Permissions'] = 0;
                $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['lang']['response_login_invalid_password']);
            }
        } else {
            $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['lang']['response_login_invalid_username']);
        }

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
        setcookie('PHPMUSSEL-ADMIN', '', -1, '/', (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '', false, true);

    } else {

        /** Generate default tooltip for the user ("Hello, {username}"). */
        $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
            array('username' => $phpMussel['FE']['UserRaw']),
            $phpMussel['lang']['tip_hello']
        );

    }

    /** If the user has complete access. */
    if ($phpMussel['FE']['Permissions'] === 1) {

        $phpMussel['FE']['nav'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_nav_complete_access.html')
        );

    /** If the user has logs access only. */
    } elseif ($phpMussel['FE']['Permissions'] === 2) {

        $phpMussel['FE']['nav'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_nav_logs_access_only.html')
        );

    }

}

/** The user hasn't logged in. Show them the login page. */
if ($phpMussel['FE']['UserState'] !== 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_login'];

    $phpMussel['FE']['FE_Tip'] = $phpMussel['lang']['tip_login'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_login.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/**
 * The user has logged in, but hasn't selected anything to view. Show them the
 * front-end home page.
 */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === '') {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_home'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_home.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Accounts. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'accounts' && $phpMussel['FE']['Permissions'] === 1) {

    /** A form has been submitted. */
    if ($phpMussel['FE']['FormTarget'] === 'accounts' && !empty($_POST['do'])) {

        /** Create a new account. */
        if ($_POST['do'] === 'create-account' && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['permissions'])) {
            $phpMussel['FE']['NewUser'] = $_POST['username'];
            $phpMussel['FE']['NewPass'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $phpMussel['FE']['NewPerm'] = (int)$_POST['permissions'];
            $phpMussel['FE']['NewUserB64'] = base64_encode($_POST['username']);
            if (strpos($phpMussel['FE']['UserList'], "\n" . $phpMussel['FE']['NewUserB64'] . ',') !== false) {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_accounts_already_exists'];
            } else {
                $phpMussel['FE']['NewAccount'] =
                    $phpMussel['FE']['NewUserB64'] . ',' .
                    $phpMussel['FE']['NewPass'] . ',' .
                    $phpMussel['FE']['NewPerm'] . "\n";
                $phpMussel['AccountsArray'] = array(
                    'Iterate' => 0,
                    'Count' => 1,
                    'ByName' => array($phpMussel['FE']['NewUser'] => $phpMussel['FE']['NewAccount'])
                );
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
            $phpMussel['FE']['NewPass'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_accounts'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['AccountsRow'] = $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_accounts_row.html');
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
        $phpMussel['RowInfo'] = explode(',', $phpMussel['FE']['NewLine'], 3);
        $phpMussel['RowInfo'][3] = (strpos($phpMussel['FE']['SessionList'], "\n" . $phpMussel['RowInfo'][0] . ',') !== false);
        $phpMussel['RowInfo'][0] = htmlentities(base64_decode($phpMussel['RowInfo'][0]));
        if ($phpMussel['RowInfo'][1] === $phpMussel['FE']['DefaultPassword']) {
            $phpMussel['RowInfo'][1] = '<br /><div class="txtRd">' . $phpMussel['lang']['state_default_password'] . '</div>';
        } elseif (strlen($phpMussel['RowInfo'][1]) !== 60 || !preg_match('/^\$2.\$[0-9]{2}\$/', $phpMussel['RowInfo'][1])) {
            $phpMussel['RowInfo'][1] = '<br /><div class="txtRd">' . $phpMussel['lang']['state_password_not_valid'] . '</div>';
        } else {
            $phpMussel['RowInfo'][1] = '';
        }
        if ($phpMussel['RowInfo'][3]) {
            $phpMussel['RowInfo'][1] .= '<br /><div class="txtGn">' . $phpMussel['lang']['state_logged_in'] . '</div>';
        }
        $phpMussel['RowInfo'][2] = (int)$phpMussel['RowInfo'][2];
        $phpMussel['RowInfo'] = array(
            'username' => $phpMussel['RowInfo'][0],
            'warning' => $phpMussel['RowInfo'][1],
            'permissions' =>
                ($phpMussel['RowInfo'][2] === 1) ?
                $phpMussel['lang']['state_complete_access'] :
                $phpMussel['lang']['state_logs_access_only']
        );
        $phpMussel['FE']['NewLineOffset'] = $phpMussel['FE']['NewLinePos'];
        $phpMussel['FE']['Accounts'] .= $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['RowInfo'], $phpMussel['FE']['AccountsRow']
        );
    }
    unset($phpMussel['RowInfo']);

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_accounts.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Configuration. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'config' && $phpMussel['FE']['Permissions'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_config'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_config.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Greylist. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'greylist' && $phpMussel['FE']['Permissions'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_greylist'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_greylist.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Updates. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'updates' && $phpMussel['FE']['Permissions'] === 1) {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_updates'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_updates.html')
    );

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Logs. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'logs') {

    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_logs'];

    $phpMussel['FE']['FE_Tip'] = $phpMussel['lang']['tip_logs'];

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['vault'] . 'fe_assets/_logs.html')
    );

    $phpMussel['FE']['LogFiles'] = array(
        'Files' => scandir($phpMussel['vault']),
        'Types' => ',txt,log,',
        'Out' => ''
    );

    if (empty($phpMussel['QueryVars']['logfile'])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_no_logfile_selected'];
    } elseif (
        file_exists($phpMussel['vault'] . $phpMussel['QueryVars']['logfile']) &&
        !preg_match($phpMussel['FE']['Traverse'], $phpMussel['QueryVars']['logfile']) &&
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
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_logfile_doesnt_exist'];
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
        $phpMussel['FE']['LogFiles'] = $phpMussel['lang']['logs_no_logfiles_available'];
    }

    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

if ($phpMussel['FE']['Rebuild']) {
    $phpMussel['FE']['FrontEndData'] = "USERS\n-----" . $phpMussel['FE']['UserList'] . "\nSESSIONS\n--------" . $phpMussel['FE']['SessionList'];
    $phpMussel['FE']['Handle'] = fopen($phpMussel['vault'] . 'fe_assets/frontend.dat', 'w');
    fwrite($phpMussel['FE']['Handle'], $phpMussel['FE']['FrontEndData']);
    fclose($phpMussel['FE']['Handle']);
}

die;
