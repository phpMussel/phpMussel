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
 This File: phpMussel v0.7a (13th August 2015) Loader file.
 <%phpMussel%/phpmussel.php>

                                     ~ ~ ~
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

$vault=@(__DIR__==='__DIR__')?dirname(__FILE__).'/vault/':__DIR__.'/vault/';

if(!function_exists('plaintext_echo_die')){function plaintext_echo_die($out){header('Content-Type: text/plain');echo $out;die;}}

if(!is_dir($vault))plaintext_echo_die('[phpMussel] Vault directory not correctly set: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.');
if(!defined('phpMussel'))
	{
	define('phpMussel',true);
	$display_errors=error_reporting(0);
	$MusselConfig=@(!file_exists($vault.'phpmussel.ini'))?false:parse_ini_file($vault.'phpmussel.ini',true);
	if(!is_array($MusselConfig))plaintext_echo_die('[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.');
	if(!file_exists($vault.'lang.inc'))plaintext_echo_die('[phpMussel] Language data file missing! Please reinstall phpMussel.');
	require $vault.'lang.inc';
	if(!isset($MusselConfig['general']['cleanup']))$MusselConfig['general']['cleanup']=1;
	$disable_lock=file_exists($vault.'disable.lck');
	if(!$disable_lock)
		{
		$update_lock=file_exists($vault.'update.lck');
		$update_timer=time();
		while($update_lock)
			{
			sleep(2);
			$update_lock=file_exists($vault.'update.lck');
			if((time()-$update_timer)>12)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['update_lock_detected']);
			}
		unset($update_timer,$update_lock);
		}
	if(!file_exists($vault.'controls.lck'))
		{
		parse_str($_SERVER['QUERY_STRING'],$query);
		if(!isset($_POST['phpmussel']))$_POST['phpmussel']=false;
		if(!isset($query['phpmussel']))$query['phpmussel']=false;
		if(!$phpmussel=$_POST['phpmussel'])if(!$phpmussel=$query['phpmussel'])$phpmussel=false;
		if(!isset($_POST['pword']))$_POST['pword']=false;
		if(!isset($query['pword']))$query['pword']=false;
		if(!$pword=$_POST['pword'])if(!$pword=$query['pword'])$pword=false;
		if(!isset($_POST['logspword']))$_POST['logspword']=false;
		if(!isset($query['logspword']))$query['logspword']=false;
		if(!$logspword=$_POST['logspword'])if(!$logspword=$query['logspword'])$logspword=false;
		if(!isset($_POST['musselvar']))$_POST['musselvar']=false;
		if(!isset($query['musselvar']))$query['musselvar']=false;
		if(!$musselvar=$_POST['musselvar'])if(!$musselvar=$query['musselvar'])$musselvar=false;
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
				echo $MusselConfig['general']['scan_log'].' '.$MusselConfig['lang']['x_does_not_exist'].'!';
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
				echo $MusselConfig['general']['scan_kills'].' '.$MusselConfig['lang']['x_does_not_exist'].'!';
				die;
				}
			if($phpmussel=='controls_lockout')
				{
				$controls_lockout=fopen($vault.'controls.lck','a');
				fwrite($controls_lockout,'');
				fclose($controls_lockout);
				plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['controls_lockout']);
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
			plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['bad_command']);
			}
		}
	if(!$disable_lock)
		{
		if(!file_exists($vault.'phpmussel.inc'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['core_scriptfile_missing']);
		require $vault.'phpmussel.inc';
		}
	$display_errors=error_reporting($display_errors);
	if($MusselConfig['general']['cleanup'])unset($musselvar,$logspword,$pword,$phpmussel,$MusselConfig,$disable_lock,$display_errors,$vault);
	}
else (!isset($MusselConfig['lang']['instance_already_active']))?plaintext_echo_die('[phpMussel] Instance already active! Please double-check your hooks.'):plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['instance_already_active']);

?>