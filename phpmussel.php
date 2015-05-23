<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______           
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    
 Thank you for using phpMussel, a php-based script based upon ClamAV signatures
  designed to detect trojans, viruses, malware and other threats within files  
             uploaded to your system wherever the script is hooked.            
     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    

                                  ~ ~ ~                                        
  Special thanks to ClamAV for both project inspiration and for the signatures 
  that this script utilises, without which, the script would likely not exist, 
  or at best, would have very limited value. <http://www.clamav.net/lang/en/>  

                                  ~ ~ ~                                        
 Special thanks to all those supporting the project, to anyone else that I may 
 have otherwise forgotten to mention, and to you, for using the script.        
 For comments, feedback, suggestions, help, technical support or similar, you  
 can email me via <phpmussel@gamejaunt.com> or contact me via my website       
 contact form located at <http://www.gamejaunt.com/contact.php>.               

                                  ~ ~ ~                                        
 This script is free software; you can redistribute it and/or modify it under  
 the terms of the GNU General Public License as published by the Free Software 
 Foundation; either version 2 of the License, or (at your option) any later    
 version. This script is distributed in the hope that it will be useful, but   
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 details. <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>     

                                  ~ ~ ~                                        
 This File: phpMussel Loader v1.0
 This File Last Updated: 18th October 2013

                                  ~ ~ ~                                        
 Please refer to "documentation" for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 In order phpMussel to work effectively on your CMS or website, you must modify
 the $vault variable immediately following this comment section. It should
 match the exact path to the vault directory of phpMussel.

*/

$vault="/your_user/public_html/some_dir/phpmussel/vault/";

if(!function_exists("plaintext_echo_die")){function plaintext_echo_die($out){header("Content-Type: text/plain");echo $out;die();}}

if(!is_dir($vault))plaintext_echo_die("[phpMussel] Vault directory not correctly set: Can't continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.");
if(!defined('phpMussel'))
	{
	define('phpMussel',true);
	$display_errors=error_reporting(0);
	$disable_lock=file_exists($vault."disable.lck");
	if(!$disable_lock)
		{
		$update_lock=file_exists($vault."update.lck");
		$update_timer=time();
		while($update_lock)
			{
			sleep(2);
			$update_lock=file_exists($vault."update.lck");
			if((time()-$update_timer)>9)plaintext_echo_die("[phpMussel] Update lock detected: Can't continue. Check for corrupt updates or try again later.");
			}
		unset($update_timer,$update_lock);
		}
	$MusselConfig=@(!file_exists($vault."phpmussel.ini"))?false:parse_ini_file($vault."phpmussel.ini",true);
	if(!is_array($MusselConfig))plaintext_echo_die("[phpMussel] Could not read phpmussel.ini: Can't continue. Refer to documentation if this is a first-time run, and if problems persist, seek assistance.");
	if(!file_exists($vault."controls.lck"))
		{
		parse_str($_SERVER['QUERY_STRING'],$query);
		if(!$phpmussel=$_POST['phpmussel'])if(!$phpmussel=$query['phpmussel'])$phpmussel=false;
		if(!$pword=$_POST['pword'])if(!$pword=$query['pword'])$pword=false;
		if(!$logspword=$_POST['logspword'])if(!$logspword=$query['logspword'])$logspword=false;
		if(!$musselvar=$_POST['musselvar'])if(!$musselvar=$query['musselvar'])$musselvar=false;
		if(!isset($MusselConfig['general']['script_password']))$MusselConfig['general']['script_password']="";
		if(!empty($MusselConfig['general']['logs_password'])&&!empty($phpmussel)&&!empty($logspword))
			{
			if($logspword!==$MusselConfig['general']['logs_password'])
				{
				plaintext_echo_die("[phpMussel] Wrong password; Action denied.");
				}
			else if($phpmussel=="scan_log")
				{
				header("Content-Type: text/plain");
				echo "      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
				if(file_exists($vault.$MusselConfig['general']['scan_log']))
					{
					echo "Contents of ".$MusselConfig['general']['scan_log'].":\n\n";
					echo implode(file($vault.$MusselConfig['general']['scan_log']));
					}
				else
					{
					echo "File ".$MusselConfig['general']['scan_log']." does not exist.";
					}
				die;
				}
			else if($phpmussel=="scan_kills")
				{
				header("Content-Type: text/plain");
				echo "      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
				if(file_exists($vault.$MusselConfig['general']['scan_kills']))
					{
					echo "Contents of ".$MusselConfig['general']['scan_kills'].":\n\n";
					echo implode(file($vault.$MusselConfig['general']['scan_kills']));
					}
				else
					{
					echo "File ".$MusselConfig['general']['scan_kills']." does not exist.";
					}
				die;
				}
			else if($phpmussel=="controls_lockout")
				{
				$controls_lockout=fopen($vault."controls.lck","a");
				fwrite($controls_lockout,"");
				fclose($controls_lockout);
				plaintext_echo_die("[phpMussel] phpMussel controls lockout enabled.");
				}
			else
				{
				plaintext_echo_die("[phpMussel] I don't understand that command, sorry.");
				}
			}
		if(!empty($MusselConfig['general']['script_password'])&&!empty($phpmussel)&&!empty($pword))
			{
			if($pword!==$MusselConfig['general']['script_password'])
				{
				plaintext_echo_die("[phpMussel] Wrong password; Action denied.");
				}
			else if($phpmussel=="disable")
				{
				if(!$disable_lock)
					{
					$disable_lock=fopen($vault."disable.lck","a");
					fwrite($disable_lock,"");
					fclose($disable_lock);
					$disable_lock=true;
					plaintext_echo_die("[phpMussel] phpMussel disabled.");
					}
				plaintext_echo_die("[phpMussel] phpMussel already disabled.");
				}
			else if($phpmussel=="enable")
				{
				if(!$disable_lock)plaintext_echo_die("[phpMussel] phpMussel already enabled.");
				$disable_lock=@unlink($vault."disable.lck");
				$disable_lock=false;
				plaintext_echo_die("[phpMussel] phpMussel enabled.");
				}
			else if($phpmussel=="update")
				{
				if(!file_exists($vault."update.inc"))plaintext_echo_die("[phpMussel] Update script file missing! Please reinstall phpMussel.");
				require($vault."update.inc");
				}
			else if($phpmussel=="greylist")
				{
				if(!empty($musselvar))
					{
					$greylist=(!file_exists($vault."greylist.csv"))?",":"";
					$greylist.=$musselvar.",";
					$greylistf=fopen($vault."greylist.csv","a");
					fwrite($greylistf,$musselvar.",");
					fclose($greylistf);
					unset($greylistf,$greylist);
					plaintext_echo_die("[phpMussel] Greylist updated.");
					}
				}
			else if($phpmussel=="greylist_clear")
				{
				$greylist=",";
				$greylistf=fopen($vault."greylist.csv","a");
				fwrite($greylistf,$musselvar.",");
				fclose($greylistf);
				unset($greylistf,$greylist);
				plaintext_echo_die("[phpMussel] Greylist cleared.");
				}
			else if($phpmussel=="greylist_show")
				{
				header("Content-Type: text/plain");
				echo "      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
				if(file_exists($vault."greylist.csv"))
					{
					echo "Greylisted:\n\n";
					echo implode("\n",explode(",",implode(file($vault."greylist.csv"))));
					}
				else
					{
					echo "Greylist file missing.";
					}
				die;
				}
			else if($phpmussel=="controls_lockout")
				{
				$controls_lockout=fopen($vault."controls.lck","a");
				fwrite($controls_lockout,"");
				fclose($controls_lockout);
				plaintext_echo_die("[phpMussel] phpMussel controls lockout enabled.");
				}
			else
				{
				plaintext_echo_die("[phpMussel] I don't understand that command, sorry.");
				}
			}
		}
	if(!$disable_lock)
		{
		if(!file_exists($vault."phpmussel.inc"))plaintext_echo_die("[phpMussel] Core script file missing! Please reinstall phpMussel.");
		require($vault."phpmussel.inc");
		}
	$display_errors=error_reporting($display_errors);
	if($MusselConfig['general']['cleanup'])unset($musselvar,$logspword,$pword,$phpmussel,$MusselConfig,$disable_lock,$display_errors,$vault);
	}
else
	{
	plaintext_echo_die("[phpMussel] Instance already active! Please double-check your hooks.");
	}

?>