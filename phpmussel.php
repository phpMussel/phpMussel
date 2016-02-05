<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

 Thank you for using phpMussel, a PHP script designed to detect trojans,
 viruses, malware and other threats within files uploaded to your system
 wherever the script is hooked, based on the signatures of ClamAV and others.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).

 This script is free software; you can redistribute it and/or modify it under
 the terms of the GNU General Public License as published by the Free Software
 Foundation; either version 2 of the License, or (at your option) any later
 version. This script is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 details, located in the "LICENSE" file within the "_docs" directory of the
 associated package and repository for this file and available also from:
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>.

 Special thanks to ClamAV for both project inspiration and for the signatures
 that this script utilises, without which, the script would likely not exist,
 or at best, would have very limited value <http://www.clamav.net/>.

 Special thanks to Sourceforge and GitHub for hosting the project files, to
 Spambot Security for hosting the phpMussel discussion forums, located at
 <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, and to the
 additional sources of a number of the signatures utilised by phpMussel:
 SecuriteInfo.com <http://www.securiteinfo.com/>, PhishTank
 <http://www.phishtank.com/>, NLNetLabs <http://nlnetlabs.nl/> and others, and
 special thanks to all those supporting the project, to anyone else that I may
 have otherwise forgotten to mention, and to you, for using the script.

 This document and its associated package can be downloaded for free from:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~
 This file: phpMussel v0.9.2 (5th February 2016) loader file.
 <%phpMussel%/phpmussel.php>

                                     ~ ~ ~
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

/**
 * phpMussel: A PHP script designed to detect trojans, viruses, malware and other threats within files uploaded to your
 * system wherever the script is hooked, based on the signatures of ClamAV and others.
 *
 * This file: Loader file, responsible for initialising phpMussel and for loading everything that could needed (this is
 * the file that you hook into your CMS and/or website).
 *
 * @package Maikuolan/phpMussel
 */

/**
 * Determines the location of the "vault" directory of phpMussel and saves this information to the $vault variable,
 * required by phpMussel in order to call, read, write, delete, etc, its files (signatures, includes, logs, etc).
 */
$vault=@(__DIR__==='__DIR__')?dirname(__FILE__).'/vault/':__DIR__.'/vault/';

if(!function_exists('plaintext_echo_die'))
    {
    /**
     * Function serves as a quick-and-lazy way to render some text as plain-text to the page output (for browsers) and to
     * then kill the script. Nothing special; Just means that we can do this with one function call rather than three
     * different calls (header, echo, die), to save time.
     *
     * @param string $out The text to be rendered.
     */
    function plaintext_echo_die($out)
        {
        header('Content-Type: text/plain');
        echo $out;
        die;
        }
    }

if(!function_exists('phpMussel_Register_Hook'))
    {
    /**
     * The `phpMussel_Register_Hook` function is used to register plugin functions to their intended hooks.
     *
     * @since v0.9.0
     * @param string $what The name of the chosen function to execute at the desired point in the script.
     * @param string $where Instructs the function which "hook" your chosen function should be registered to.
     * @param string|array $with Represents the variables that need to be parsed to your function from the scope in which it'll be executed from (optional).
     * @return bool
     */
    function phpMussel_Register_Hook($what,$where,$with='')
        {
        if(!isset($GLOBALS['MusselPlugins']['hooks'])||!isset($GLOBALS['MusselPlugins']['hookcounts']))return false;
        if(!isset($GLOBALS['MusselPlugins']['hooks'][$where]))$GLOBALS['MusselPlugins']['hooks'][$where]=array();
        if(!isset($GLOBALS['MusselPlugins']['hookcounts'][$where]))$GLOBALS['MusselPlugins']['hookcounts'][$where]=0;
        $GLOBALS['MusselPlugins']['hooks'][$where][$what]=$with;
        $GLOBALS['MusselPlugins']['hookcounts'][$where]++;
        return true;
        }
    }

if(!function_exists('phpMusselV'))
    {
    /**
     * This is a specialised search-and-replace function, designed to replace encapsulated substrings within a given
     * input string based upon the elements of a given input array. The function accepts two input parameters: The
     * first, the input array, and the second, the input string. The function searches for any instances of each array
     * key, encapsulated by curly brackets, as substrings within the input string, and replaces any instances found
     * with the array element content corresponding to the array key associated with each instance found.
     *
     * This function is used extensively throughout phpMussel, to parse its language data and to parse any messages
     * related to any detections found during the scan process and any other related processes.
     *
     * @since v0.6j
     * @param array $v The input array.
     * @param string $b The input string.
     * @return string The results of the function are returned directly to the calling scope as a string.
     */
    function phpMusselV($v,$b)
        {
        if(!is_array($v)||empty($b))return '';
        $c=count($v);
        reset($v);
        for($i=0;$i<$c;$i++)
            {
            $k=key($v);
            $b=str_replace('{'.$k.'}',$v[$k],$b);
            next($v);
            }
        return $b;
        }
    }

/**
 * Kills the script if $vault isn't defined or if it isn't a valid directory.
 */
if(!is_dir($vault))plaintext_echo_die('[phpMussel] Vault directory not correctly set: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.');

if(!defined('phpMussel'))
    {
    define('phpMussel',true);
    $display_errors=error_reporting(0);
    $MusselConfig=@(!file_exists($vault.'phpmussel.ini'))?false:parse_ini_file($vault.'phpmussel.ini',true);
    if(!is_array($MusselConfig))plaintext_echo_die('[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.');
    if(!file_exists($vault.'lang.inc'))plaintext_echo_die('[phpMussel] Language data file missing! Please reinstall phpMussel.');
    require $vault.'lang.inc';
    if(!isset($MusselConfig['general']))$MusselConfig['general']=array();
    if(!isset($MusselConfig['general']['cleanup']))$MusselConfig['general']['cleanup']=true;
    if(!$disable_lock=file_exists($vault.'disable.lck'))
        {
        $update_timer=time();
        while(file_exists($vault.'update.lck'))
            {
            sleep(2);
            if((time()-$update_timer)>12)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['update_lock_detected']);
            }
        unset($update_timer);
        }
    if(!isset($MusselConfig['general']['enable_plugins']))$MusselConfig['general']['enable_plugins']=true;
    $x='';
    $MusselPlugins=array();
    $MusselPlugins['hooks']=array();
    $MusselPlugins['hookcounts']=array();
    if($MusselConfig['general']['enable_plugins'])
        {
        if(!is_dir($vault.'plugins'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['plugins_directory_nonexistent']);
        $MusselPlugins['tempdata']=array();
        if($MusselPlugins['tempdata']['d']=@opendir($vault.'plugins'))while(false!==($MusselPlugins['tempdata']['f']=readdir($MusselPlugins['tempdata']['d'])))
            {
            if($MusselPlugins['tempdata']['f']!=='.'&&$MusselPlugins['tempdata']['f']!=='..'&&is_dir($vault.'plugins/'.$MusselPlugins['tempdata']['f']))if(file_exists($vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php')&&!is_link($vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php'))
                {
                require_once $vault.'plugins/'.$MusselPlugins['tempdata']['f'].'/plugin.php';
                }
            }
        closedir($MusselPlugins['tempdata']['d']);
        $MusselPlugins['tempdata']=array();
        }
    if(!file_exists($vault.'controls.lck'))
        {
        parse_str($_SERVER['QUERY_STRING'],$query);
        $phpmussel=(!empty($_POST['phpmussel']))?$_POST['phpmussel']:((!empty($query['phpmussel']))?$query['phpmussel']:'');
        $pword=(!empty($_POST['pword']))?$_POST['pword']:((!empty($query['pword']))?$query['pword']:'');
        $logspword=(!empty($_POST['logspword']))?$_POST['logspword']:((!empty($query['logspword']))?$query['logspword']:'');
        $musselvar=(!empty($_POST['musselvar']))?$_POST['musselvar']:((!empty($query['musselvar']))?$query['musselvar']:'');
        if(!isset($MusselConfig['general']['logs_password']))$MusselConfig['general']['logs_password']='';
        if(!empty($MusselConfig['general']['logs_password'])&&!empty($phpmussel)&&!empty($logspword))
            {
            if($logspword!==$MusselConfig['general']['logs_password'])plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['wrong_password']);
            if($phpmussel=='scan_log')
                {
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'];
                if(file_exists($vault.$MusselConfig['general']['scan_log']))
                    {
                    echo $MusselConfig['general']['scan_log'].":\n\n".implode(file($vault.$MusselConfig['general']['scan_log']));
                    die;
                    }
                echo $MusselConfig['general']['scan_log'].' '.$MusselConfig['lang']['x_does_not_exist'].$MusselConfig['lang']['_exclamation_final'];
                die;
                }
            if($phpmussel=='scan_kills')
                {
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'];
                if(file_exists($vault.$MusselConfig['general']['scan_kills']))
                    {
                    echo $MusselConfig['general']['scan_kills'].":\n\n".implode(file($vault.$MusselConfig['general']['scan_kills']));
                    die;
                    }
                echo $MusselConfig['general']['scan_kills'].' '.$MusselConfig['lang']['x_does_not_exist'].$MusselConfig['lang']['_exclamation_final'];
                die;
                }
            if($phpmussel=='controls_lockout')
                {
                $controls_lockout=fopen($vault.'controls.lck','a');
                fwrite($controls_lockout,'');
                fclose($controls_lockout);
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['controls_lockout']);
                }
            if(isset($MusselPlugins['hookcounts']['browser_log_commands']))if($MusselPlugins['hookcounts']['browser_log_commands']>0)
                {
                reset($MusselPlugins['hooks']['browser_log_commands']);
                for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['browser_log_commands'];$MusselPlugins['tempdata']['i']++)
                    {
                    $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['browser_log_commands']);
                    if(!is_array($MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['varsfeed']=array();
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=$MusselPlugins['hooks']['browser_log_commands'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                        if($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                        }
                    $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                    if(is_array($MusselPlugins['tempdata']['out']))
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
        if(!isset($MusselConfig['general']['script_password']))$MusselConfig['general']['script_password']='';
        if(!empty($MusselConfig['general']['script_password'])&&!empty($phpmussel)&&!empty($pword))
            {
            if($pword!==$MusselConfig['general']['script_password'])plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['wrong_password']);
            if($phpmussel=='disable')
                {
                if(!$disable_lock)
                    {
                    $disable_lock=fopen($vault.'disable.lck','a');
                    fwrite($disable_lock,'');
                    fclose($disable_lock);
                    plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_disabled']);
                    }
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_disabled_already']);
                }
            if($phpmussel=='enable')
                {
                if(!$disable_lock)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_enabled_already']);
                $disable_lock=@unlink($vault.'disable.lck');
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['phpmussel_enabled']);
                }
            if($phpmussel=='update')
                {
                if(!file_exists($vault.'update.inc'))plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['update_scriptfile_missing']);
                require $vault.'update.inc';
                die;
                }
            if($phpmussel=='greylist')
                {
                if(!empty($musselvar))
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
            if($phpmussel=='greylist_clear')
                {
                $greylistf=fopen($vault.'greylist.csv','a');
                ftruncate($greylistf,0);
                fwrite($greylistf,',');
                fclose($greylistf);
                unset($greylistf,$greylist);
                plaintext_echo_die('[phpMussel]'.$MusselConfig['lang']['greylist_cleared']);
                }
            if($phpmussel=='greylist_show')
                {
                if(!file_exists($vault.'greylist.csv'))plaintext_echo_die('[phpMussel] greylist.csv '.$MusselConfig['lang']['x_does_not_exist'].'!');
                header('Content-Type: text/plain');
                echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2']."greylist.csv:\n\n".implode("\n",explode(',',implode(file($vault.'greylist.csv'))));
                die;
                }
            if($phpmussel=='controls_lockout')
                {
                $controls_lockout=fopen($vault.'controls.lck','a');
                fwrite($controls_lockout,'');
                fclose($controls_lockout);
                plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['controls_lockout']);
                }
            if(isset($MusselPlugins['hookcounts']['browser_commands']))if($MusselPlugins['hookcounts']['browser_commands']>0)
                {
                reset($MusselPlugins['hooks']['browser_commands']);
                for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['browser_commands'];$MusselPlugins['tempdata']['i']++)
                    {
                    $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['browser_commands']);
                    if(!is_array($MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['varsfeed']=array();
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=$MusselPlugins['hooks']['browser_commands'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                        if($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                        }
                    $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                    if(is_array($MusselPlugins['tempdata']['out']))
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
    if(!$disable_lock)
        {
        if(isset($MusselPlugins['hookcounts']['before_phpmussel']))if($MusselPlugins['hookcounts']['before_phpmussel']>0)
            {
            reset($MusselPlugins['hooks']['before_phpmussel']);
            for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['before_phpmussel'];$MusselPlugins['tempdata']['i']++)
                {
                $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['before_phpmussel']);
                if(!is_array($MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['varsfeed']=array();
                for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                    {
                    $x=$MusselPlugins['hooks']['before_phpmussel'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                    if($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                    }
                $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                if(is_array($MusselPlugins['tempdata']['out']))
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
        if(!file_exists($vault.'phpmussel.inc'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['core_scriptfile_missing']);
        require $vault.'phpmussel.inc';
        if(isset($MusselPlugins['hookcounts']['after_phpmussel']))if($MusselPlugins['hookcounts']['after_phpmussel']>0)
            {
            reset($MusselPlugins['hooks']['after_phpmussel']);
            for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['after_phpmussel'];$MusselPlugins['tempdata']['i']++)
                {
                $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['after_phpmussel']);
                if(!is_array($MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']]);
                $MusselPlugins['tempdata']['varsfeed']=array();
                for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                    {
                    $x=$MusselPlugins['hooks']['after_phpmussel'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
                    if($x)$MusselPlugins['tempdata']['varsfeed'][$MusselPlugins['tempdata']['ki']]=(isset($$x))?$$x:$x;
                    }
                $MusselPlugins['tempdata']['out']=call_user_func($MusselPlugins['tempdata']['k'],$MusselPlugins['tempdata']['varsfeed']);
                if(is_array($MusselPlugins['tempdata']['out']))
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
    if($MusselConfig['general']['cleanup'])unset($musselvar,$logspword,$pword,$phpmussel,$x,$MusselPlugins,$MusselConfig,$disable_lock,$display_errors,$vault);
    }
else (!isset($MusselConfig['lang']['instance_already_active']))?plaintext_echo_die('[phpMussel] Instance already active! Please double-check your hooks.'):plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['instance_already_active']);
