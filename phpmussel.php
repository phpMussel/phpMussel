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
 * This file: phpMussel loader file (last modified: 2016.02.07).
 *
 * @package Maikuolan/phpMussel
 */

namespace phpMussel; # <- The namespace declaration seems to kill phpMussel in CLI-mode for some reason. I don't know why!! Need to investigate this to figure it out!!

/**
 * Determines the location of the "vault" directory of phpMussel and saves this
 * information to the $vault variable, required by phpMussel in order to call,
 * read, write, delete, etc, its files (signatures, includes, logs, etc).
 */
$vault = sprintf('%s/vault/', __DIR__);

require_once $vault.'includes/functions.php';

/**
 * Kills the script if $vault isn't defined or if it isn't a valid directory.
 */
if (!is_dir($vault)) {
    header('Content-Type: text/plain');
    echo '[phpMussel] Vault directory not correctly set: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.';
    die;
}

if (!defined('phpMussel')) {
    /** We define this constant here to ensure that we only instantiate once. */
    define('phpMussel',true);
    $display_errors=error_reporting(-1);
    /** Read the phpMussel configuration file and parse its directives to $MusselConfig. */
    $MusselConfig=@(!file_exists($vault.'phpmussel.ini'))?false:parse_ini_file($vault.'phpmussel.ini',true);
    if (!is_array($MusselConfig))plaintext_echo_die('[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.');
    if (!file_exists($vault.'lang.inc'))plaintext_echo_die('[phpMussel] Language data file missing! Please reinstall phpMussel.');
    require $vault.'lang.inc';
    if (!isset($MusselConfig['general']))$MusselConfig['general']=array();
    if (!isset($MusselConfig['general']['cleanup']))$MusselConfig['general']['cleanup']=true;
    if (!$disable_lock=file_exists($vault.'disable.lck'))
        {
        $update_timer=time();
        while(file_exists($vault.'update.lck'))
            {
            sleep(2);
            if ((time()-$update_timer)>12)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['update_lock_detected']);
            }
        unset($update_timer);
        }
    if (!isset($MusselConfig['general']['enable_plugins']))$MusselConfig['general']['enable_plugins']=true;
    $x='';
    $MusselPlugins=array();
    $MusselPlugins['hooks']=array();
    $MusselPlugins['hookcounts']=array();
    if ($MusselConfig['general']['enable_plugins'])
        {
        if (!is_dir($vault.'plugins'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['plugins_directory_nonexistent']);
        $MusselPlugins['tempdata']=array();
        if ($MusselPlugins['tempdata']['d']=@opendir($vault.'plugins'))while(false!==($MusselPlugins['tempdata']['f']=readdir($MusselPlugins['tempdata']['d'])))
            {
            if ($MusselPlugins['tempdata']['f']!=='.'&&$MusselPlugins['tempdata']['f']!=='..'&&is_dir($vault.'plugins/'.$MusselPlugins['tempdata']['f']))if (file_exists($vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php')&&!is_link($vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php'))
                {
                require_once $vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php';
                }
            }
        closedir($MusselPlugins['tempdata']['d']);
        $MusselPlugins['tempdata']=array();
        }
    if (!file_exists($vault.'controls.lck'))
        {
        parse_str($_SERVER['QUERY_STRING'],$query);
        $phpmussel=(!empty($_POST['phpmussel']))?$_POST['phpmussel']:((!empty($query['phpmussel']))?$query['phpmussel']:'');
        $pword=(!empty($_POST['pword']))?$_POST['pword']:((!empty($query['pword']))?$query['pword']:'');
        $logspword=(!empty($_POST['logspword']))?$_POST['logspword']:((!empty($query['logspword']))?$query['logspword']:'');
        $musselvar=(!empty($_POST['musselvar']))?$_POST['musselvar']:((!empty($query['musselvar']))?$query['musselvar']:'');
        if (!isset($MusselConfig['general']['logs_password']))$MusselConfig['general']['logs_password']='';
        if (!empty($MusselConfig['general']['logs_password'])&&!empty($phpmussel)&&!empty($logspword))
            {
            if ($logspword!==$MusselConfig['general']['logs_password'])plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['wrong_password']);
            if ($phpmussel=='scan_log')
                {
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'];
                if (file_exists($vault.$MusselConfig['general']['scan_log']))
                    {
                    echo $MusselConfig['general']['scan_log'].":\n\n".implode(file($vault.$MusselConfig['general']['scan_log']));
                    die;
                    }
                echo $MusselConfig['general']['scan_log'].' '.$MusselConfig['lang']['x_does_not_exist'].$MusselConfig['lang']['_exclamation_final'];
                die;
                }
            if ($phpmussel=='scan_kills')
                {
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'];
                if (file_exists($vault.$MusselConfig['general']['scan_kills']))
                    {
                    echo $MusselConfig['general']['scan_kills'].":\n\n".implode(file($vault.$MusselConfig['general']['scan_kills']));
                    die;
                    }
                echo $MusselConfig['general']['scan_kills'].' '.$MusselConfig['lang']['x_does_not_exist'].$MusselConfig['lang']['_exclamation_final'];
                die;
                }
            if ($phpmussel=='controls_lockout')
                {
                $controls_lockout=fopen($vault.'controls.lck','a');
                fwrite($controls_lockout,'');
                fclose($controls_lockout);
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['controls_lockout']);
                }
            if (isset($MusselPlugins['hookcounts']['browser_log_commands']))if ($MusselPlugins['hookcounts']['browser_log_commands']>0)
                {
                reset($MusselPlugins['hooks']['browser_log_commands']);
                for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['browser_log_commands'];$MusselPlugins['tempdata']['i']++)
                    {
                    $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['browser_log_commands']);
                    if (!is_array($MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['varsfeed']=array();
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                        if ($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                        }
                    $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                    if (is_array($MusselPlugins['tempdata']['out']))
                        {
                        $MusselPlugins['tempdata']['outs']=count($MusselPlugins['tempdata']['out']);
                        for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['outs'];$MusselPlugins['tempdata']['ki']++)
                            {
                            $x=key($MusselPlugins['tempdata']['out']);
                            $$x=$MusselPlugins['tempdata']['out'][$x];
                            next($x);
                            }
                        }
                    next($MusselPlugins['hooks']['browser_log_commands']);
                    }
                $MusselPlugins['tempdata']=array();
                }
            plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['bad_command']);
            }
        if (!isset($MusselConfig['general']['script_password']))$MusselConfig['general']['script_password']='';
        if (!empty($MusselConfig['general']['script_password'])&&!empty($phpmussel)&&!empty($pword))
            {
            if ($pword!==$MusselConfig['general']['script_password'])plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['wrong_password']);
            if ($phpmussel=='disable')
                {
                if (!$disable_lock)
                    {
                    $disable_lock=fopen($vault.'disable.lck','a');
                    fwrite($disable_lock,'');
                    fclose($disable_lock);
                    plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_disabled']);
                    }
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_disabled_already']);
                }
            if ($phpmussel=='enable')
                {
                if (!$disable_lock)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_enabled_already']);
                $disable_lock=@unlink($vault.'disable.lck');
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_enabled']);
                }
            if ($phpmussel=='update')
                {
                if (!file_exists($vault.'update.inc'))plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['update_scriptfile_missing']);
                require $vault.'update.inc';
                die;
                }
            if ($phpmussel=='greylist')
                {
                if (!empty($musselvar))
                    {
                    $greylist=(!file_exists($vault.'greylist.csv'))?',':'';
                    $greylist.=$musselvar.',';
                    $greylistf=fopen($vault.'greylist.csv','a');
                    fwrite($greylistf,$greylist);
                    fclose($greylistf);
                    unset($greylistf,$greylist);
                    plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['greylist_updated']);
                    }
                plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['greylist_not_updated']);
                }
            if ($phpmussel=='greylist_clear')
                {
                $greylistf=fopen($vault.'greylist.csv','a');
                ftruncate($greylistf,0);
                fwrite($greylistf,',');
                fclose($greylistf);
                unset($greylistf,$greylist);
                plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['greylist_cleared']);
                }
            if ($phpmussel=='greylist_show')
                {
                if (!file_exists($vault.'greylist.csv'))plaintext_echo_die('[phpMussel] greylist.csv '.$MusselConfig['lang']['x_does_not_exist'].'!');
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2']."greylist.csv:\n\n".implode("\n",explode(',',implode(file($vault.'greylist.csv'))));
                die;
                }
            if ($phpmussel=='controls_lockout')
                {
                $controls_lockout=fopen($vault.'controls.lck','a');
                fwrite($controls_lockout,'');
                fclose($controls_lockout);
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['controls_lockout']);
                }
            if (isset($MusselPlugins['hookcounts']['browser_commands']))if ($MusselPlugins['hookcounts']['browser_commands']>0)
                {
                reset($MusselPlugins['hooks']['browser_commands']);
                for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['browser_commands'];$MusselPlugins['tempdata']['i']++)
                    {
                    $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['browser_commands']);
                    if (!is_array($MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['varsfeed']=array();
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                        if ($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                        }
                    $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                    if (is_array($MusselPlugins['tempdata']['out']))
                        {
                        $MusselPlugins['tempdata']['outs']=count($MusselPlugins['tempdata']['out']);
                        for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['outs'];$MusselPlugins['tempdata']['ki']++)
                            {
                            $x=key($MusselPlugins['tempdata']['out']);
                            $$x=$MusselPlugins['tempdata']['out'][$x];
                            next($x);
                            }
                        }
                    next($MusselPlugins['hooks']['browser_commands']);
                    }
                $MusselPlugins['tempdata']=array();
                }
            plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['bad_command']);
            }
        }
    if (!$disable_lock)
        {
        if (isset($MusselPlugins['hookcounts']['before_phpmussel']))if ($MusselPlugins['hookcounts']['before_phpmussel']>0)
            {
            reset($MusselPlugins['hooks']['before_phpmussel']);
            for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['before_phpmussel'];$MusselPlugins['tempdata']['i']++)
                {
                $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['before_phpmussel']);
                if (!is_array($MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['varsfeed']=array();
                for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                    {
                    $x=$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                    if ($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                    }
                $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                if (is_array($MusselPlugins['tempdata']['out']))
                    {
                    $MusselPlugins['tempdata']['outs']=count($MusselPlugins['tempdata']['out']);
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['outs'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=key($MusselPlugins['tempdata']['out']);
                        $$x=$MusselPlugins['tempdata']['out'][$x];
                        next($x);
                        }
                    }
                next($MusselPlugins['hooks']['before_phpmussel']);
                }
            $MusselPlugins['tempdata']=array();
            }
        if (!file_exists($vault.'phpmussel.inc'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['core_scriptfile_missing']);
        require $vault.'phpmussel.inc';
        if (isset($MusselPlugins['hookcounts']['after_phpmussel']))if ($MusselPlugins['hookcounts']['after_phpmussel']>0)
            {
            reset($MusselPlugins['hooks']['after_phpmussel']);
            for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['after_phpmussel'];$MusselPlugins['tempdata']['i']++)
                {
                $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['after_phpmussel']);
                if (!is_array($MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['varsfeed']=array();
                for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                    {
                    $x=$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                    if ($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                    }
                $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                if (is_array($MusselPlugins['tempdata']['out']))
                    {
                    $MusselPlugins['tempdata']['outs']=count($MusselPlugins['tempdata']['out']);
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['outs'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=key($MusselPlugins['tempdata']['out']);
                        $$x=$MusselPlugins['tempdata']['out'][$x];
                        next($x);
                        }
                    }
                next($MusselPlugins['hooks']['after_phpmussel']);
                }
            $MusselPlugins['tempdata']=array();
            }
        }
    $display_errors=error_reporting($display_errors);
    if ($MusselConfig['general']['cleanup']) {
        unset($musselvar,$logspword,$pword,$phpmussel,$x,$MusselPlugins,$MusselConfig,$disable_lock,$display_errors,$vault);
    }
} else {
    header('Content-Type: text/plain');
    echo (!isset($MusselConfig['lang']['instance_already_active']))?'[phpMussel] Instance already active! Please double-check your hooks.':'[phpMussel] '.$MusselConfig['lang']['instance_already_active'];
    die;
}
