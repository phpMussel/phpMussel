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
 * This file: Front-end handler (last modified: 2017.03.05).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Set page selector if not already set. */
if (empty($phpMussel['QueryVars']['phpmussel-page'])) {
    $phpMussel['QueryVars']['phpmussel-page'] = '';
}

/** Populate common front-end variables. */
$phpMussel['FE'] = array(
    'PIP_Left' => 'R0lGODlhCAAIAIABAJkCAP///yH5BAEKAAEALAAAAAAIAAgAAAINjH+ga6vJIEDh0UmzKQA7',
    'PIP_Right' => 'R0lGODlhCAAIAIABAJkCAP///yH5BAEKAAEALAAAAAAIAAgAAAINjH+gmwvoUGBSSfOuKQA7',
    'PIP_Key' => 'R0lGODlhBwAJAIABAJkAAP///yH5BAEKAAEALAAAAAAHAAkAAAINjH+gyaaAAkQrznRbKAA7',
    'Template' => $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/frontend.html'),
    'DefaultPassword' => '$2y$10$FPF5Im9MELEvF5AYuuRMSO.QKoYVpsiu1YU9aDClgrU57XtLof/dK',
    'FE_Lang' => $phpMussel['Config']['general']['lang'],
    'DateTime' => date('r', $phpMussel['Time']),
    'ScriptIdent' => $phpMussel['ScriptIdent'],
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
);

/** Traversal detection. */
$phpMussel['Traverse'] = function ($Path) {
    return !preg_match("\x01" . '(?:[\./]{2}|[\x01-\x1f\[-^`?*$])' . "\x01i", str_replace("\\", '/', $Path));
};

/** A fix for correctly displaying LTR/RTL text. */
if (empty($phpMussel['lang']['textDir']) || $phpMussel['lang']['textDir'] !== 'rtl') {
    $phpMussel['lang']['textDir'] = 'ltr';
    $phpMussel['FE']['FE_Align'] = 'left';
    $phpMussel['FE']['FE_Align_Reverse'] = 'right';
    $phpMussel['FE']['PIP_Input'] = $phpMussel['FE']['PIP_Right'];
} else {
    $phpMussel['FE']['FE_Align'] = 'right';
    $phpMussel['FE']['FE_Align_Reverse'] = 'left';
    $phpMussel['FE']['PIP_Input'] = $phpMussel['FE']['PIP_Left'];
}

/** A simple passthru for the front-end CSS. */
if ($phpMussel['QueryVars']['phpmussel-page'] === 'css') {
    header('Content-Type: text/css');
    echo $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/frontend.css')
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
$phpMussel['FE']['FormTarget'] = (empty($_POST['phpmussel-form-target'])) ? '' : $_POST['phpmussel-form-target'];

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
                $phpMussel['FE']['ThisSession'] =
                    $phpMussel['FE']['User'] . ',' .
                    password_hash($phpMussel['FE']['SessionKey'], PASSWORD_DEFAULT) . ',' .
                    ($phpMussel['Time'] + 604800) . "\n";
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
            $phpMussel['Config']['general']['FrontEndLog'] = $phpMussel['Time2Logfile'](
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
        $phpMussel['FE']['state_msg'] = $phpMussel['WrapRedText']($phpMussel['FE']['state_msg']);
    } elseif ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['FrontEndLog'] .= ' - ' . $phpMussel['lang']['state_logged_in'] . "\n";
    }
    if ($phpMussel['Config']['general']['FrontEndLog']) {
        $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['Config']['general']['FrontEndLog'], 'a');
        fwrite($phpMussel['Handle'], $phpMussel['FrontEndLog']);
        fclose($phpMussel['Handle']);
        unset($phpMussel['FrontEndLog']);
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
            $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_nav_complete_access.html')
        );

    /** If the user has logs access only. */
    } elseif ($phpMussel['FE']['Permissions'] === 2) {

        $phpMussel['FE']['nav'] = $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'],
            $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_nav_logs_access_only.html')
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
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_login.html')
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

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_home']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_home.html')
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

        /** Fetch file manager icons data. */
        if (file_exists($phpMussel['Vault'] . 'icons.php') && is_readable($phpMussel['Vault'] . 'icons.php')) {
            require $phpMussel['Vault'] . 'icons.php';
        }

        header('Content-Type: image/gif');
        if (!empty($phpMussel['Icons'][$phpMussel['QueryVars']['icon']])) {
            echo gzinflate(base64_decode($phpMussel['Icons'][$phpMussel['QueryVars']['icon']]));
        } else {
            echo gzinflate(base64_decode($phpMussel['Icons']['unknown']));
        }
    }

    die;

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

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_accounts'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_accounts']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['AccountsRow'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_accounts_row.html');
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

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_accounts.html')
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
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_config']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['ConfigRow'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_config_row.html');

    /** Generate entries for display and regenerate configuration if any changes were submitted. */
    reset($phpMussel['Config']['Config Defaults']);
    $phpMussel['FE']['ConfigFields'] = $phpMussel['RegenerateConfig'] = '';
    $phpMussel['ConfigModified'] = (!empty($phpMussel['QueryVars']['updated']) && $phpMussel['QueryVars']['updated'] === 'true');
    foreach ($phpMussel['Config']['Config Defaults'] as $phpMussel['CatKey'] => $phpMussel['CatValue']) {
        if (!is_array($phpMussel['CatValue'])) {
            continue;
        }
        $phpMussel['RegenerateConfig'] .= '[' . $phpMussel['CatKey'] . "]\r\n\r\n";
        foreach ($phpMussel['CatValue'] as $phpMussel['DirKey'] => $phpMussel['DirValue']) {
            $phpMussel['ThisDir'] = array('FieldOut' => '');
            if (empty($phpMussel['DirValue']['type']) || !isset($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']])) {
                continue;
            }
            $phpMussel['ThisDir']['DirLangKey'] = 'config_' . $phpMussel['CatKey'] . '_' . $phpMussel['DirKey'];
            $phpMussel['ThisDir']['DirName'] = $phpMussel['CatKey'] . '->' . $phpMussel['DirKey'];
            $phpMussel['ThisDir']['DirLang'] =
                !empty($phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']]) ? $phpMussel['lang'][$phpMussel['ThisDir']['DirLangKey']] : $phpMussel['lang']['response_error'];
            $phpMussel['RegenerateConfig'] .= '; ' . wordwrap(strip_tags($phpMussel['ThisDir']['DirLang']), 77, "\r\n; ") . "\r\n";
            if (isset($_POST[$phpMussel['ThisDir']['DirLangKey']])) {
                if ($phpMussel['DirValue']['type'] === 'string' || $phpMussel['DirValue']['type'] === 'int' || $phpMussel['DirValue']['type'] === 'bool') {
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
            } elseif ($phpMussel['DirValue']['type'] === 'int') {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . '=' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . "\r\n\r\n";
            } else {
                $phpMussel['RegenerateConfig'] .= $phpMussel['DirKey'] . '=\'' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . "'\r\n\r\n";
            }
            if (isset($phpMussel['DirValue']['choices'])) {
                $phpMussel['ThisDir']['FieldOut'] = '<select name="'. $phpMussel['ThisDir']['DirLangKey'] . '">';
                foreach ($phpMussel['DirValue']['choices'] as $phpMussel['ChoiceKey'] => $phpMussel['ChoiceValue']) {
                    $phpMussel['ThisDir']['FieldOut'] .= ($phpMussel['ChoiceKey'] === $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']]) ?
                        '<option value="' . $phpMussel['ChoiceKey'] . '" selected>' . $phpMussel['ChoiceValue'] . '</option>'
                    :
                        '<option value="' . $phpMussel['ChoiceKey'] . '">' . $phpMussel['ChoiceValue'] . '</option>';
                }
                $phpMussel['ThisDir']['FieldOut'] .= '</select>';
            } elseif ($phpMussel['DirValue']['type'] === 'bool') {
                if ($phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']]) {
                    $phpMussel['ThisDir']['FieldOut'] =
                        '<select name="'. $phpMussel['ThisDir']['DirLangKey'] . '">' .
                        '<option value="true" selected>True</option><option value="false">False</option>' .
                        '</select>';
                } else {
                    $phpMussel['ThisDir']['FieldOut'] =
                        '<select name="'. $phpMussel['ThisDir']['DirLangKey'] . '">' .
                        '<option value="true">True</option><option value="false" selected>False</option>' .
                        '</select>';
                }
            } elseif ($phpMussel['DirValue']['type'] === 'int') {
                $phpMussel['ThisDir']['FieldOut'] = '<input type="number" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" value="' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '" />';
            } elseif ($phpMussel['DirValue']['type'] === 'string') {
                $phpMussel['ThisDir']['FieldOut'] = '<textarea class="half" name="'. $phpMussel['ThisDir']['DirLangKey'] . '">' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '</textarea>';
            } else {
                $phpMussel['ThisDir']['FieldOut'] = '<input type="text" name="'. $phpMussel['ThisDir']['DirLangKey'] . '" value="' . $phpMussel['Config'][$phpMussel['CatKey']][$phpMussel['DirKey']] . '" />';
            }
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
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_config.html')
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Updates. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'updates' && $phpMussel['FE']['Permissions'] === 1) {

    $phpMussel['FE']['UpdatesFormTarget'] = 'phpmussel-page=updates';
    $phpMussel['FE']['UpdatesFormTargetControls'] = '';
    $phpMussel['QueryTemp'] = array('Switched' => false);
    foreach (array('hide-non-outdated', 'hide-unused') as $phpMussel['QueryTemp']['Param']) {
        $phpMussel['QueryTemp']['Switch'] = (
            !empty($_POST['updates-form-target-selecter']) &&
            $_POST['updates-form-target-selecter'] === $phpMussel['QueryTemp']['Param']
        );
        if (empty($phpMussel['QueryVars'][$phpMussel['QueryTemp']['Param']])) {
            $phpMussel['FE'][$phpMussel['QueryTemp']['Param']] = false;
        } else {
            $phpMussel['FE'][$phpMussel['QueryTemp']['Param']] = (
                ($phpMussel['QueryVars'][$phpMussel['QueryTemp']['Param']] === 'true' && !$phpMussel['QueryTemp']['Switch']) ||
                ($phpMussel['QueryVars'][$phpMussel['QueryTemp']['Param']] !== 'true' && $phpMussel['QueryTemp']['Switch'])
            );
        }
        if ($phpMussel['QueryTemp']['Switch']) {
            $phpMussel['QueryTemp']['Switched'] = true;
        }
        if ($phpMussel['FE'][$phpMussel['QueryTemp']['Param']]) {
            $phpMussel['FE']['UpdatesFormTarget'] .= '&' . $phpMussel['QueryTemp']['Param'] . '=true';
            $phpMussel['QueryTemp']['LangOpt'] = 'switch-' . $phpMussel['QueryTemp']['Param'] . '-set-false';
        } else {
            $phpMussel['FE']['UpdatesFormTarget'] .= '&' . $phpMussel['QueryTemp']['Param'] . '=false';
            $phpMussel['QueryTemp']['LangOpt'] = 'switch-' . $phpMussel['QueryTemp']['Param'] . '-set-true';
        }
        $phpMussel['FE']['UpdatesFormTargetControls'] .=
            '<option value="' . $phpMussel['QueryTemp']['Param'] . '">' . $phpMussel['lang'][$phpMussel['QueryTemp']['LangOpt']] . '</option>';
    }
    if ($phpMussel['QueryTemp']['Switched']) {
        header('Location: ?' . $phpMussel['FE']['UpdatesFormTarget']);
        die;
    }
    unset($phpMussel['QueryTemp']);

    /** Prepare components metadata working array. */
    $phpMussel['Components'] = array('Meta' => array(), 'RemoteMeta' => array());

    /** Fetch components lists. */
    $phpMussel['Components']['Files'] = new DirectoryIterator($phpMussel['Vault']);

    /** Count files; Prepare to search for components metadata. */
    foreach ($phpMussel['Components']['Files'] as $phpMussel['ThisFile']) {
        if (!empty($phpMussel['ThisFile']) && preg_match('/\.(?:dat|inc|yaml)$/i', $phpMussel['ThisFile'])) {
            $phpMussel['ThisData'] = $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['ThisFile']);
            if (substr($phpMussel['ThisData'], 0, 4) === "---\n" && ($phpMussel['EoYAML']= strpos($phpMussel['ThisData'], "\n\n")) !== false) {
                $phpMussel['YAML'](substr($phpMussel['ThisData'], 4, $phpMussel['EoYAML'] - 4), $phpMussel['Components']['Meta']);
            }
        }
    }

    /** Search cleanup. */
    unset($phpMussel['EoYAML'], $phpMussel['ThisData'], $phpMussel['ThisFile'], $phpMussel['Components']['Files']);

    /** A form has been submitted. */
    if ($phpMussel['FE']['FormTarget'] === 'updates' && !empty($_POST['do'])) {

        /** Update a component. */
        if (
            $_POST['do'] === 'update-component' &&
            !empty($_POST['ID']) &&
            isset($phpMussel['Components']['Meta'][$_POST['ID']]['Remote'])
        ) {
            $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'] = $phpMussel['FECacheGet'](
                $phpMussel['FE']['Cache'],
                $phpMussel['Components']['Meta'][$_POST['ID']]['Remote']
            );
            if (!$phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData']) {
                $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'] =
                    $phpMussel['Request']($phpMussel['Components']['Meta'][$_POST['ID']]['Remote']);
                if (
                    strtolower(substr($phpMussel['Components']['Meta'][$_POST['ID']]['Remote'], -2)) === 'gz' &&
                    substr($phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'], 0, 2) === "\x1f\x8b"
                ) {
                    $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'] =
                        gzdecode($phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData']);
                }
                if (empty($phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'])) {
                    $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'] = '-';
                }
                $phpMussel['FECacheAdd'](
                    $phpMussel['FE']['Cache'],
                    $phpMussel['FE']['Rebuild'],
                    $phpMussel['Components']['Meta'][$_POST['ID']]['Remote'],
                    $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'],
                    $phpMussel['Time'] + 3600
                );
            }
            if (
                substr($phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'], 0, 4) === "---\n" &&
                ($phpMussel['Components']['EoYAML'] = strpos(
                    $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'], "\n\n"
                )) !== false &&
                $phpMussel['YAML'](
                    substr($phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData'], 4, $phpMussel['Components']['EoYAML'] - 4),
                    $phpMussel['Components']['RemoteMeta']
                ) &&
                !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Minimum Required']) &&
                !$phpMussel['VersionCompare'](
                    $phpMussel['ScriptVersion'],
                    $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Minimum Required']
                ) &&
                (
                    empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Minimum Required PHP']) ||
                    !$phpMussel['VersionCompare'](PHP_VERSION, $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Minimum Required PHP'])
                ) &&
                !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From']) &&
                !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['To']) &&
                !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Reannotate']) &&
                $phpMussel['Traverse']($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Reannotate']) &&
                file_exists($phpMussel['Vault'] . $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Reannotate']) &&
                ($phpMussel['Components']['OldMeta'] = $phpMussel['ReadFile'](
                    $phpMussel['Vault'] . $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Reannotate']
                )) &&
                preg_match(
                    "\x01(\n" . preg_quote($_POST['ID']) . ":?)(\n [^\n]*)*\n\x01i",
                    $phpMussel['Components']['OldMeta'],
                    $phpMussel['Components']['OldMetaMatches']
                ) &&
                ($phpMussel['Components']['OldMetaMatches'] = $phpMussel['Components']['OldMetaMatches'][0]) &&
                ($phpMussel['Components']['NewMeta'] = $phpMussel['Components']['Meta'][$_POST['ID']]['RemoteData']) &&
                preg_match(
                    "\x01(\n" . preg_quote($_POST['ID']) . ":?)(\n [^\n]*)*\n\x01i",
                    $phpMussel['Components']['NewMeta'],
                    $phpMussel['Components']['NewMetaMatches']
                ) &&
                ($phpMussel['Components']['NewMetaMatches'] = $phpMussel['Components']['NewMetaMatches'][0])
            ) {
                $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']);
                $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From']);
                $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['To']);
                if (!empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum'])) {
                    $phpMussel['Arrayify']($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum']);
                }
                $phpMussel['Components']['NewMeta'] = str_replace(
                    $phpMussel['Components']['OldMetaMatches'],
                    $phpMussel['Components']['NewMetaMatches'],
                    $phpMussel['Components']['OldMeta']
                );
                $phpMussel['Count'] = count($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From']);
                $phpMussel['RemoteFiles'] = array();
                for (
                    $phpMussel['Iterate'] = 0;
                    $phpMussel['Iterate'] < $phpMussel['Count'];
                    $phpMussel['Iterate']++
                ) {
                    if (empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['To'][$phpMussel['Iterate']])) {
                        continue;
                    }
                    $phpMussel['ThisFileName'] = $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['To'][$phpMussel['Iterate']];
                    $phpMussel['RemoteFiles'][$phpMussel['ThisFileName']] = true;
                    if (
                        (
                            !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']]) &&
                            !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']]) && (
                                $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']] ===
                                $phpMussel['Components']['Meta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']]
                            )
                        ) ||
                        empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From'][$phpMussel['Iterate']]) ||
                        !($phpMussel['ThisFile'] = $phpMussel['Request'](
                            $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From'][$phpMussel['Iterate']]
                        ))
                    ) {
                        continue;
                    }
                    if (
                        strtolower(substr(
                            $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['From'][$phpMussel['Iterate']], -2
                        )) === 'gz' &&
                        strtolower(substr($phpMussel['ThisFileName'], -2)) !== 'gz' &&
                        substr($phpMussel['ThisFile'], 0, 2) === "\x1f\x8b"
                    ) {
                        $phpMussel['ThisFile'] = gzdecode($phpMussel['ThisFile']);
                    }
                    if (
                        !empty($phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']]) &&
                            $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Files']['Checksum'][$phpMussel['Iterate']] !==
                            md5($phpMussel['ThisFile']) . ':' . strlen($phpMussel['ThisFile'])
                    ) {
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
                    $phpMussel['Handle'] = fopen($phpMussel['Vault'] . $phpMussel['ThisFileName'], 'w');
                    fwrite($phpMussel['Handle'], $phpMussel['ThisFile']);
                    fclose($phpMussel['Handle']);
                    $phpMussel['ThisFile'] = '';
                }
                if (
                    !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To']) &&
                    is_array($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'])
                ) {
                    array_walk($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                        if (
                            !empty($ThisFile) &&
                            !isset($phpMussel['RemoteFiles'][$ThisFile]) &&
                            file_exists($phpMussel['Vault'] . $ThisFile) &&
                            $phpMussel['Traverse']($ThisFile)
                        ) {
                            unlink($phpMussel['Vault'] . $ThisFile);
                            while (strrpos($ThisFile, '/') !== false || strrpos($ThisFile, "\\") !== false) {
                                $Separator = (strrpos($ThisFile, '/') !== false) ? '/' : "\\";
                                $ThisFile = substr($ThisFile, 0, strrpos($ThisFile, $Separator));
                                if (
                                    is_dir($phpMussel['Vault'] . $ThisFile) &&
                                    $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $ThisFile)
                                ) {
                                    rmdir($phpMussel['Vault'] . $ThisFile);
                                } else {
                                    break;
                                }
                            }
                        }
                    });
                }
                $phpMussel['Handle'] =
                    fopen($phpMussel['Vault'] . $phpMussel['Components']['RemoteMeta'][$_POST['ID']]['Reannotate'], 'w');
                fwrite($phpMussel['Handle'], $phpMussel['Components']['NewMeta']);
                fclose($phpMussel['Handle']);
                $phpMussel['FE']['state_msg'] =
                    (
                        empty($phpMussel['Components']['Meta'][$_POST['ID']]['Version']) &&
                        empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files'])
                    ) ?
                    $phpMussel['lang']['response_component_successfully_installed'] :
                    $phpMussel['lang']['response_component_successfully_updated'];
                $phpMussel['Components']['Meta'][$_POST['ID']] =
                    $phpMussel['Components']['RemoteMeta'][$_POST['ID']];
            } else {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_update_error'];
            }
        }

        /** Uninstall a component. */
        if ($_POST['do'] === 'uninstall-component' && !empty($_POST['ID'])) {
            $phpMussel['ComponentFunctionUpdatePrep']();
            if (
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To']) &&
                !empty($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['InUse']) &&
                ($_POST['ID'] !== 'l10n/' . $phpMussel['Config']['general']['lang']) &&
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
                        array(
                            "/\n Files:(\n  [^\n]*)*\n/i",
                            "/\n Version: [^\n]*\n/i",
                        ),
                        "\n",
                        $phpMussel['Components']['OldMetaMatches']
                    ),
                    $phpMussel['Components']['OldMeta']
                );
                array_walk($phpMussel['Components']['Meta'][$_POST['ID']]['Files']['To'], function ($ThisFile) use (&$phpMussel) {
                    if (
                        !empty($ThisFile) &&
                        file_exists($phpMussel['Vault'] . $ThisFile) &&
                        $phpMussel['Traverse']($ThisFile)
                    ) {
                        unlink($phpMussel['Vault'] . $ThisFile);
                        while (strrpos($ThisFile, '/') !== false || strrpos($ThisFile, "\\") !== false) {
                            $Separator = (strrpos($ThisFile, '/') !== false) ? '/' : "\\";
                            $ThisFile = substr($ThisFile, 0, strrpos($ThisFile, $Separator));
                            if (
                                is_dir($phpMussel['Vault'] . $ThisFile) &&
                                $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $ThisFile)
                            ) {
                                rmdir($phpMussel['Vault'] . $ThisFile);
                            } else {
                                break;
                            }
                        }
                    }
                });
                $phpMussel['Handle'] =
                    fopen($phpMussel['Vault'] . $phpMussel['Components']['Meta'][$_POST['ID']]['Reannotate'], 'w');
                fwrite($phpMussel['Handle'], $phpMussel['Components']['NewMeta']);
                fclose($phpMussel['Handle']);
                $phpMussel['Components']['Meta'][$_POST['ID']]['Version'] = false;
                $phpMussel['Components']['Meta'][$_POST['ID']]['Files'] = false;
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_successfully_uninstalled'];
            } else {
                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_component_uninstall_error'];
            }
        }

        /** Activate a component. */
        if ($_POST['do'] === 'activate-component' && !empty($_POST['ID'])) {
            $phpMussel['Activation'] = array(
                'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . 'config.ini'),
                'Active' => $phpMussel['Config']['signatures']['Active'],
                'Modified' => false
            );
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
            }
            unset($phpMussel['Activation']);
        }

        /** Deactivate a component. */
        if ($_POST['do'] === 'deactivate-component' && !empty($_POST['ID'])) {
            $phpMussel['Deactivation'] = array(
                'Config' => $phpMussel['ReadFile']($phpMussel['Vault'] . 'config.ini'),
                'Active' => $phpMussel['Config']['signatures']['Active'],
                'Modified' => false
            );
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
            }
            unset($phpMussel['Deactivation']);
        }

    }

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_updates'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_updates']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    $phpMussel['FE']['UpdatesRow'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_updates_row.html');

    $phpMussel['Components'] = array(
        'Meta' => $phpMussel['Components']['Meta'],
        'RemoteMeta' => $phpMussel['Components']['RemoteMeta'],
        'Remotes' => array(),
        'Out' => array()
    );

    reset($phpMussel['Components']['Meta']);
    /** Prepare installed component metadata and options for display. */
    foreach ($phpMussel['Components']['Meta'] as $phpMussel['Components']['Key'] => &$phpMussel['Components']['ThisComponent']) {
        if (empty($phpMussel['Components']['ThisComponent']['Name'])) {
            $phpMussel['Components']['ThisComponent'] = '';
            continue;
        }
        if (is_array($phpMussel['Components']['ThisComponent']['Name'])) {
            $phpMussel['IsolateL10N'](
                $phpMussel['Components']['ThisComponent']['Name'],
                $phpMussel['Config']['general']['lang']
            );
        }
        if (empty($phpMussel['Components']['ThisComponent']['Extended Description'])) {
            $phpMussel['Components']['ThisComponent']['Extended Description'] = '';
        }
        if (is_array($phpMussel['Components']['ThisComponent']['Extended Description'])) {
            $phpMussel['IsolateL10N'](
                $phpMussel['Components']['ThisComponent']['Extended Description'],
                $phpMussel['Config']['general']['lang']
            );
        }
        $phpMussel['Components']['ThisComponent']['ID'] = $phpMussel['Components']['Key'];
        $phpMussel['Components']['ThisComponent']['Options'] = '';
        $phpMussel['Components']['ThisComponent']['StatusOptions'] = '';
        $phpMussel['Components']['ThisComponent']['StatClass'] = '';
        if (empty($phpMussel['Components']['ThisComponent']['Version'])) {
            if (empty($phpMussel['Components']['ThisComponent']['Files']['To'])) {
                $phpMussel['Components']['ThisComponent']['RowClass'] = 'h2';
                $phpMussel['Components']['ThisComponent']['Version'] =
                    $phpMussel['lang']['response_updates_not_installed'];
                $phpMussel['Components']['ThisComponent']['StatClass'] = 'txtRd';
                $phpMussel['Components']['ThisComponent']['StatusOptions'] =
                    $phpMussel['lang']['response_updates_not_installed'];
            } else {
                $phpMussel['Components']['ThisComponent']['Version'] =
                    $phpMussel['lang']['response_updates_unable_to_determine'];
                $phpMussel['Components']['ThisComponent']['StatClass'] = 's';
            }
        }
        if (empty($phpMussel['Components']['ThisComponent']['Remote'])) {
            $phpMussel['Components']['ThisComponent']['RemoteData'] =
                $phpMussel['lang']['response_updates_unable_to_determine'];
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
            if (!$phpMussel['Components']['ThisComponent']['StatClass']) {
                if (
                    !empty($phpMussel['Components']['ThisComponent']['Latest']) &&
                    $phpMussel['VersionCompare'](
                        $phpMussel['Components']['ThisComponent']['Version'],
                        $phpMussel['Components']['ThisComponent']['Latest']
                    )
                ) {
                    $phpMussel['Components']['ThisComponent']['Outdated'] = true;
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
                            array('V' => $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']),
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
                    if ($phpMussel['Components']['Key'] === 'Bypasses') {
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
            $phpMussel['Components']['ThisComponent']['Latest'] =
                $phpMussel['lang']['response_updates_unable_to_determine'];
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
                    array('V' => $phpMussel['Components']['RemoteMeta'][$phpMussel['Components']['Key']]['Minimum Required PHP']),
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
                '<select name="do" class="half">' .
                $phpMussel['Components']['ThisComponent']['Options'] .
                '</select><input class="half" type="submit" value="' . $phpMussel['lang']['field_ok'] . '" />'
            );
            $phpMussel['Components']['ThisComponent']['Options'] = '';
        }
        $phpMussel['Components']['ThisComponent']['Changelog'] =
            empty($phpMussel['Components']['ThisComponent']['Changelog']) ? '' :
            '<br /><a href="' . $phpMussel['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        $phpMussel['Components']['ThisComponent']['Filename'] = (
            empty($phpMussel['Components']['ThisComponent']['Files']['To']) ||
            count($phpMussel['Components']['ThisComponent']['Files']['To']) !== 1
        ) ? '' : '<br />' . $phpMussel['lang']['field_filename'] . $phpMussel['Components']['ThisComponent']['Files']['To'][0];
        if (
            !($phpMussel['FE']['hide-non-outdated'] && empty($phpMussel['Components']['ThisComponent']['Outdated'])) &&
            !($phpMussel['FE']['hide-unused'] && empty($phpMussel['Components']['ThisComponent']['Files']['To']))
        ) {
            if (empty($phpMussel['Components']['ThisComponent']['RowClass'])) {
                $phpMussel['Components']['ThisComponent']['RowClass'] = 'h1';
            }
            $phpMussel['Components']['Out'][$phpMussel['Components']['Key']] = $phpMussel['ParseVars'](
                $phpMussel['lang'] + $phpMussel['ArrayFlatten']($phpMussel['Components']['ThisComponent']) + $phpMussel['ArrayFlatten']($phpMussel['FE']),
                $phpMussel['FE']['UpdatesRow']
            );
        }
    }

    reset($phpMussel['Components']['RemoteMeta']);
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
            array(
                "/\n Files:(\n  [^\n]*)*\n/i",
                "/\n Version: [^\n]*\n/i",
            ),
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
        $phpMussel['ThisOffset'] = array(0 => array());
        $phpMussel['ThisOffset'][1] = preg_match(
            '/(\n+)$/',
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']],
            $phpMussel['ThisOffset'][0]
        );
        $phpMussel['ThisOffset'] = strlen($phpMussel['ThisOffset'][0][0]) * -1;
        $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']] = substr(
            $phpMussel['Components']['Remotes'][$phpMussel['Components']['ReannotateThis']], 0, $phpMussel['ThisOffset']
        ) . $phpMussel['Components']['RemoteDataThis'] . "\n";
        if (is_array($phpMussel['Components']['ThisComponent']['Name'])) {
            $phpMussel['IsolateL10N'](
                $phpMussel['Components']['ThisComponent']['Name'],
                $phpMussel['Config']['general']['lang']
            );
        }
        if (empty($phpMussel['Components']['ThisComponent']['Extended Description'])) {
            $phpMussel['Components']['ThisComponent']['Extended Description'] = '';
        }
        if (is_array($phpMussel['Components']['ThisComponent']['Extended Description'])) {
            $phpMussel['IsolateL10N'](
                $phpMussel['Components']['ThisComponent']['Extended Description'],
                $phpMussel['Config']['general']['lang']
            );
        }
        $phpMussel['Components']['ThisComponent']['ID'] = $phpMussel['Components']['Key'];
        $phpMussel['Components']['ThisComponent']['Latest'] =
            $phpMussel['Components']['ThisComponent']['Version'];
        $phpMussel['Components']['ThisComponent']['Version'] =
            $phpMussel['lang']['response_updates_not_installed'];
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
            array('V' => $phpMussel['Components']['ThisComponent']['Minimum Required PHP']),
            $phpMussel['lang']['response_updates_not_installed_php']
        ) :
            $phpMussel['lang']['response_updates_not_installed'] .
            '<br /><select name="do" class="half"><option value="update-component">' .
            $phpMussel['lang']['field_install'] .
            '</option></select><input class="half" type="submit" value="' .
            $phpMussel['lang']['field_ok'] . '" />';
        $phpMussel['Components']['ThisComponent']['Changelog'] =
            empty($phpMussel['Components']['ThisComponent']['Changelog']) ? '' :
            '<br /><a href="' . $phpMussel['Components']['ThisComponent']['Changelog'] . '">Changelog</a>';
        $phpMussel['Components']['ThisComponent']['Filename'] = '';
        if (!$phpMussel['FE']['hide-unused']) {
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
    uksort($phpMussel['Components']['Out'], function ($A, $B) {
        $CheckA = preg_match('/^l10n/i', $A);
        $CheckB = preg_match('/^l10n/i', $B);
        if (($CheckA && !$CheckB) || ($A === 'phpMussel' && $B !== 'phpMussel')) {
            return -1;
        }
        if (($CheckB && !$CheckA) || ($B === 'phpMussel' && $A !== 'phpMussel')) {
            return 1;
        }
        if ($A < $B) {
            return -1;
        }
        if ($A > $B) {
            return 1;
        }
        return 0;
    });
    $phpMussel['FE']['Components'] = implode('', $phpMussel['Components']['Out']);
    unset($phpMussel['Components'], $phpMussel['Count'], $phpMussel['Iterate']);

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_updates.html')
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** File Manager. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'file-manager' && $phpMussel['FE']['Permissions'] === 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_file_manager'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_file_manager']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

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
        if (
            $phpMussel['SafeToContinue'] &&
            file_exists($phpMussel['Vault'] . $_FILES['upload-file']['name']) &&
            is_readable($phpMussel['Vault'] . $_FILES['upload-file']['name'])
        ) {
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
        file_exists($phpMussel['Vault'] . $_POST['filename']) &&
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
                while (strrpos($_POST['filename'], '/') !== false || strrpos($_POST['filename'], "\\") !== false) {
                    $phpMussel['Separator'] = (strrpos($_POST['filename'], '/') !== false) ? '/' : "\\";
                    $_POST['filename'] = substr($_POST['filename'], 0, strrpos($_POST['filename'], $phpMussel['Separator']));
                    if (
                        is_dir($phpMussel['Vault'] . $_POST['filename']) &&
                        $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $_POST['filename'])
                    ) {
                        rmdir($phpMussel['Vault'] . $_POST['filename']);
                    } else {
                        break;
                    }
                }

                $phpMussel['FE']['state_msg'] = $phpMussel['lang']['response_file_deleted'];
            }

        /** Rename a file. */
        } elseif ($_POST['do'] === 'rename-file' && isset($_POST['filename'])) {

            if (isset($_POST['filename_new'])) {

                /** Check whether safe. */
                $phpMussel['SafeToContinue'] = (
                    $phpMussel['FileManager-PathSecurityCheck']($_POST['filename']) &&
                    $phpMussel['FileManager-PathSecurityCheck']($_POST['filename_new'])
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
                        while (strrpos($_POST['filename'], '/') !== false || strrpos($_POST['filename'], "\\") !== false) {
                            $phpMussel['Separator'] = (strrpos($_POST['filename'], '/') !== false) ? '/' : "\\";
                            $_POST['filename'] = substr($_POST['filename'], 0, strrpos($_POST['filename'], $phpMussel['Separator']));
                            if (
                                is_dir($phpMussel['Vault'] . $_POST['filename']) &&
                                $phpMussel['FileManager-IsDirEmpty']($phpMussel['Vault'] . $_POST['filename'])
                            ) {
                                rmdir($phpMussel['Vault'] . $_POST['filename']);
                            } else {
                                break;
                            }
                        }

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
                    $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_files_rename.html')
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
                    $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_files_edit.html')
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
    $phpMussel['FE']['FilesRow'] = $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_files_row.html');

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_files.html')
    );

    /** Initialise files data variable. */
    $phpMussel['FE']['FilesData'] = '';

    /** Fetch files data. */
    $phpMussel['FilesArray'] = $phpMussel['FileManager-RecursiveList']($phpMussel['Vault']);

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
                '<input class="half" type="submit" value="' . $phpMussel['lang']['field_ok'] . '" />';
        }
        $phpMussel['FE']['FilesData'] .= $phpMussel['ParseVars'](
            $phpMussel['lang'] + $phpMussel['FE'] + $ThisFile, $phpMussel['FE']['FilesRow']
        );
    });

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Upload Test. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'upload-test' && $phpMussel['FE']['Permissions'] === 1) {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_upload_test'];

    $phpMussel['FE']['MaxFilesize'] = $phpMussel['Config']['files']['filesize_limit'] * 1024;

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_upload_test']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_upload_test.html')
    );

    /** Send output. */
    echo $phpMussel['ParseVars']($phpMussel['lang'] + $phpMussel['FE'], $phpMussel['FE']['Template']);

}

/** Logs. */
elseif ($phpMussel['QueryVars']['phpmussel-page'] === 'logs') {

    /** Set page title. */
    $phpMussel['FE']['FE_Title'] = $phpMussel['lang']['title_logs'];

    /** Prepare page tooltip/description. */
    $phpMussel['FE']['FE_Tip'] = $phpMussel['ParseVars'](
        array('username' => $phpMussel['FE']['UserRaw']),
        $phpMussel['lang']['tip_logs']
    );

    $phpMussel['FE']['bNav'] = $phpMussel['lang']['bNav_home_logout'];

    /** Parse output. */
    $phpMussel['FE']['FE_Content'] = $phpMussel['ParseVars'](
        $phpMussel['lang'] + $phpMussel['FE'],
        $phpMussel['ReadFile']($phpMussel['Vault'] . 'fe_assets/_logs.html')
    );

    /** Initialise array for fetching logs data. */
    $phpMussel['FE']['LogFiles'] = array(
        'Files' => $phpMussel['Logs-RecursiveList']($phpMussel['Vault']),
        'Out' => ''
    );

    if (empty($phpMussel['QueryVars']['logfile'])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_no_logfile_selected'];
    } elseif (empty($phpMussel['FE']['LogFiles']['Files'][$phpMussel['QueryVars']['logfile']])) {
        $phpMussel['FE']['logfileData'] = $phpMussel['lang']['logs_logfile_doesnt_exist'];
    } else {
        $phpMussel['FE']['logfileData'] = str_replace(
            array('<', '>', "\r", "\n"),
            array('&lt;', '&gt;', '', "<br />\n"),
            $phpMussel['ReadFile']($phpMussel['Vault'] . $phpMussel['QueryVars']['logfile'])
        );
    }

    array_walk($phpMussel['FE']['LogFiles']['Files'], function ($Arr) use (&$phpMussel) {
        $phpMussel['FE']['LogFiles']['Out'] .= sprintf(
            '            <a href="?phpmussel-page=logs&logfile=%1$s">%1$s</a> – %2$s<br />',
            $Arr['Filename'],
            $Arr['Filesize']
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
