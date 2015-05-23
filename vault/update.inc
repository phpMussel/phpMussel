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
 can email me via <phpmussel@gamejaunt.com>, contact me via my website contact 
 form located at <http://www.gamejaunt.com/contact.php> or participate in the  
 community discussion forums for phpMussel hosted by Spambot Security at       
 <http://www.spambotsecurity.com/forum/viewtopic.php?f=57>. :-)                

                                     ~ ~ ~                                     
 This script is free software; you can redistribute it and/or modify it under  
 the terms of the GNU General Public License as published by the Free Software 
 Foundation; either version 2 of the License, or (at your option) any later    
 version. This script is distributed in the hope that it will be useful, but   
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or 
 FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 details. <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>     

                                     ~ ~ ~                                     
 This File: phpMussel v0.4c (28th August 2014) Update Script

 The latest version and future updates can be obtained from the phpMussel
 SourceForge page located at <http://sourceforge.net/projects/phpmussel/>

                                     ~ ~ ~                                     
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

if(!defined('phpMussel'))
	{
	die("[phpMussel] This should not be accessed directly.");
	}

while(true)
	{
	$phpmusselversion=array();
	$phpmusselversion['is_cli']=@(isset($is_cli))?$is_cli:false;
	if($phpmusselversion['is_cli'])
		{
		if(!file_exists($vault."update.dat"))
			{
			echo "Failed to update: 'update.dat' missing. Reinstall or update manually.";
			break;
			}
		}
	else
		{
		if(!file_exists($vault."update.dat"))plaintext_echo_die("[phpMussel] Failed to update: 'update.dat' missing. Reinstall or update manually.");
		}
	$phpmusselversion['raw']=implode(file($vault."update.dat"));
	$phpmusselversion['current_time']=time();
	$phpmusselversion['crc']=array();
	$phpmusselversion['fdata']=array();
	$phpmusselversion['do_not_check_before']=trim(substr($phpmusselversion['raw'],48,16));
	if($phpmusselversion['current_time']>$phpmusselversion['do_not_check_before']||$musselvar=="forcedupdate")
		{
		$phpmusselversion['update_addresses']=array();
		$phpmusselversion['update_addresses_count']=0;
		$phpmusselversion['update_instructions']=substr($phpmusselversion['raw'],64);
		$phpmusselversion['update_instructions']=@(substr_count($phpmusselversion['update_instructions'],";")>0)?explode(";",$phpmusselversion['update_instructions']):array(0=>$phpmusselversion['update_instructions']);
		$phpmusselversion['update_instructions_count']=count($phpmusselversion['update_instructions']);
		for($i=0;$i<$phpmusselversion['update_instructions_count'];$i++)
			{
			$phpmusselversion['update_instructions'][$i]=@(substr_count($phpmusselversion['update_instructions'][$i],":")>0)?explode(":",$phpmusselversion['update_instructions'][$i]):array(0=>$phpmusselversion['update_instructions'][$i]);
			if($phpmusselversion['update_instructions'][$i][0]=="updates")
				{
				if($phpmusselversion['update_instructions'][$i][2]>$phpmusselversion['current_time'])
					{
					$phpmusselversion['update_addresses'][$phpmusselversion['update_addresses_count']]=$phpmusselversion['update_instructions'][$i][1];
					$phpmusselversion['update_addresses_count']++;
					}
				}
			}
		if($phpmusselversion['is_cli'])
			{
			if($phpmusselversion['update_addresses_count']<1)
				{
				echo "Failed to update: 'update.dat' does not contain any valid update sources. Please update manually.";
				break;
				}
			}
		else
			{
			if($phpmusselversion['update_addresses_count']<1)plaintext_echo_die("[phpMussel] Failed to update: 'update.dat' does not contain any valid update sources. Please update manually.");
			}
		$phpmusselversion['script_version']=trim(substr($phpmusselversion['raw'],16,16));
		$phpmusselversion['first_compatible']=trim(substr($phpmusselversion['script_version'],strpos($phpmusselversion['script_version']," ")));
		$phpmusselversion['script_version']=trim(substr($phpmusselversion['script_version'],0,strpos($phpmusselversion['script_version']," ")));
		$phpmusselversion['phpmussel_ua']="phpMussel v".$phpmusselversion['script_version']." (".crc32($_SERVER['SERVER_ADDR'])."-".crc32($_SERVER['HTTP_HOST']).")";
		if(!$phpmusselversion['is_cli'])header("Content-Type: text/plain");
		echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'].$MusselConfig['lang']['update_']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n\n";
		$phpmusselversion['request_status']=false;
		for($i=0;$i<$phpmusselversion['update_addresses_count'];$i++)
			{
			echo $MusselConfig['lang']['update_fetch']." http://".substr($phpmusselversion['update_addresses'][$i],0,(strlen($phpmusselversion['update_addresses'][$i])-strpos($phpmusselversion['update_addresses'][$i],"/"))*-1)."/ ... ";
			$phpmusselversion['stream']=stream_context_create(array("http"=>array("method"=>"POST","header"=>"Content-type: application/x-www-form-urlencoded; charset=iso-8859-1","user_agent"=>$phpmusselversion['phpmussel_ua'],"content"=>"x=ver","timeout"=>59)));
			$phpmusselversion['request']=file_get_contents("http://".$phpmusselversion['update_addresses'][$i],false,$phpmusselversion['stream']);
			if(trim(substr($phpmusselversion['request'],0,16))!=="¡phpMussel!")
				{
				echo $MusselConfig['lang']['update_failed']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				$phpmusselversion['update_addresses'][$i]="";
				continue;
				}
			$phpmusselversion['request_status']=true;
			echo $MusselConfig['lang']['update_success']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
			break;
			}
		if(!$phpmusselversion['request_status'])
			{
			echo $MusselConfig['lang']['update_no_source']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
			$phpmusselversion['raw']=str_replace(substr($phpmusselversion['raw'],48,16),str_pad((time()+3600),16),$phpmusselversion['raw']);
			$phpmusselversion['df']=fopen($vault."update.dat","w");
			fwrite($phpmusselversion['df'],$phpmusselversion['raw']);
			fclose($phpmusselversion['df']);
			continue;
			}
		$phpmusselversion['update_dat_rebuild']=substr($phpmusselversion['request'],0,64);
		$phpmusselversion['remote_script_version']=trim(substr($phpmusselversion['request'],16,16));
		$phpmusselversion['remote_first_compatible']=trim(substr($phpmusselversion['remote_script_version'],strpos($phpmusselversion['remote_script_version']," ")));
		$phpmusselversion['remote_script_version']=trim(substr($phpmusselversion['remote_script_version'],0,strpos($phpmusselversion['remote_script_version']," ")));
		$phpmusselversion['compare']="";
		echo "\n\n===\n";
		echo $MusselConfig['lang']['update_version_yours'].": phpMussel v".$phpmusselversion['script_version']."; ".$MusselConfig['lang']['update_version_latest'].": phpMussel v".$phpmusselversion['remote_script_version'].";\n";
		if($phpmusselversion['first_compatible']===$phpmusselversion['remote_first_compatible'])
			{
			if($phpmusselversion['script_version']===$phpmusselversion['remote_script_version'])
				{
				echo $MusselConfig['lang']['update_not_available']."\n\n";
				}
			else
				{
				echo $MusselConfig['lang']['update_available']."\n\n";
				$phpmusselversion['compare']=(!function_exists("gzinflate"))?"script":"scriptgz";
				}
			$phpmusselversion['signatures_version']=trim(substr($phpmusselversion['raw'],32,16));
			$phpmusselversion['signatures_version_human']=explode(" ",$phpmusselversion['signatures_version']);
			$phpmusselversion['signatures_version_human']="ClamAV main signatures #".$phpmusselversion['signatures_version_human'][0].", ClamAV daily signatures #".$phpmusselversion['signatures_version_human'][1].", phpMussel (not from ClamAV) signatures #".$phpmusselversion['signatures_version_human'][2].".";
			$phpmusselversion['remote_signatures_version']=trim(substr($phpmusselversion['request'],32,16));
			$phpmusselversion['remote_signatures_version_human']=explode(" ",$phpmusselversion['remote_signatures_version']);
			$phpmusselversion['remote_signatures_version_human']="ClamAV main signatures #".$phpmusselversion['remote_signatures_version_human'][0].", ClamAV daily signatures #".$phpmusselversion['remote_signatures_version_human'][1].", phpMussel (not from ClamAV) signatures #".$phpmusselversion['remote_signatures_version_human'][2].".";
			echo $MusselConfig['lang']['update_signatures_yours'].": ".$phpmusselversion['signatures_version_human']."\n".$MusselConfig['lang']['update_signatures_latest'].": ".$phpmusselversion['remote_signatures_version_human']."\n";
			if($phpmusselversion['signatures_version']===$phpmusselversion['remote_signatures_version'])
				{
				echo $MusselConfig['lang']['update_signatures_not_available']."\n";
				}
			else
				{
				echo $MusselConfig['lang']['update_signatures_available']."\n";
				if(!function_exists("gzinflate"))
					{
					$phpmusselversion['compare']=($phpmusselversion['compare']=="script")?"all":"sigs";
					}
				else
					{
					$phpmusselversion['compare']=($phpmusselversion['compare']=="scriptgz")?"allgz":"sigsgz";
					}
				}
			}
		else
			{
			echo $MusselConfig['lang']['update_not_possible']."\n";
			}
		echo "===\n\n";
		if($phpmusselversion['compare'])
			{
			$phpmusselversion['request_status']=false;
			for($i=0;$i<$phpmusselversion['update_addresses_count'];$i++)
				{
				if($phpmusselversion['update_addresses'][$i])
					{
					echo $MusselConfig['lang']['update_fetch']." http://".substr($phpmusselversion['update_addresses'][$i],0,(strlen($phpmusselversion['update_addresses'][$i])-strpos($phpmusselversion['update_addresses'][$i],"/"))*-1)."/ ... ";
					$phpmusselversion['stream']=stream_context_create(array("http"=>array("method"=>"POST","header"=>"Content-type: application/x-www-form-urlencoded; charset=iso-8859-1","user_agent"=>$phpmusselversion['phpmussel_ua'],"content"=>"x=".$phpmusselversion['compare'],"timeout"=>59)));
					$phpmusselversion['request']=file_get_contents("http://".$phpmusselversion['update_addresses'][$i],false,$phpmusselversion['stream']);
					if(trim(substr($phpmusselversion['request'],0,16))!=="¡phpMussel!")
						{
						echo $MusselConfig['lang']['update_failed']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						continue;
						}
					$phpmusselversion['request_status']=true;
					echo $MusselConfig['lang']['update_success']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
					break;
					}
				}
			if(!$phpmusselversion['request_status'])
				{
				echo $MusselConfig['lang']['update_no_source']." (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				$phpmusselversion['raw']=str_replace(substr($phpmusselversion['raw'],48,16),str_pad((time()+3600),16),$phpmusselversion['raw']);
				$phpmusselversion['df']=fopen($vault."update.dat","w");
				fwrite($phpmusselversion['df'],$phpmusselversion['raw']);
				fclose($phpmusselversion['df']);
				break;
				}
			$phpmusselversion['update_dat_rebuild']=substr($phpmusselversion['request'],0,64);
			$phpmusselversion['remote_update_instructions']=substr($phpmusselversion['request'],64);
			$phpmusselversion['remote_update_instructions']=@(substr_count($phpmusselversion['remote_update_instructions'],";")>0)?explode(";",$phpmusselversion['remote_update_instructions']):array(0=>$phpmusselversion['remote_update_instructions']);
			$phpmusselversion['remote_update_instructions_count']=count($phpmusselversion['remote_update_instructions']);
			$phpmusselversion['remote_hack_detected']=false;
			for($i=0;$i<$phpmusselversion['remote_update_instructions_count'];$i++)
				{
				$phpmusselversion['itype']=substr($phpmusselversion['remote_update_instructions'][$i],0,5);
				if($phpmusselversion['itype']=="delet"||$phpmusselversion['itype']=="patch")
					{
					if(preg_match("/2f2f|5c5c|2e(2e|2f|5c|62|646c|65|67|68|6a|70|73)/i",bin2hex(strtolower($phpmusselversion['remote_update_instructions'][$i]))))
						{
						$phpmusselversion['remote_hack_detected']=true;
						break;
						}
					}
				if($phpmusselversion['itype']=="updat")$phpmusselversion['update_dat_rebuild'].=$phpmusselversion['remote_update_instructions'][$i].";";
				$phpmusselversion['remote_update_instructions'][$i]=@(substr_count($phpmusselversion['remote_update_instructions'][$i],":")>0)?explode(":",$phpmusselversion['remote_update_instructions'][$i]):array(0=>$phpmusselversion['remote_update_instructions'][$i]);
				}
			if($phpmusselversion['remote_hack_detected'])
				{
				echo "Possible hack or forgery detected in the update instructions supplied by the update source; Source may possibly be compromised. Please notify the script author. Updating manually is recommended. (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				$phpmusselversion['raw']=str_replace(substr($phpmusselversion['raw'],48,16),str_pad((time()+99999999),16),$phpmusselversion['raw']);
				$phpmusselversion['df']=fopen($vault."update.dat","w");
				fwrite($phpmusselversion['df'],$phpmusselversion['raw']);
				fclose($phpmusselversion['df']);
				break;
				}
			for($i=0;$i<$phpmusselversion['remote_update_instructions_count'];$i++)
				{
				if($phpmusselversion['remote_update_instructions'][$i][0]=="crc")
					{
					$phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]]=$phpmusselversion['remote_update_instructions'][$i][2];
					$phpmusselversion['remote_update_instructions'][$i]="";
					continue;
					}
				if($phpmusselversion['remote_update_instructions'][$i][0]=="fdata")
					{
					$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]=@base64_decode($phpmusselversion['remote_update_instructions'][$i][2]);
					$phpmusselversion['remote_update_instructions'][$i]="";
					continue;
					}
				if($phpmusselversion['remote_update_instructions'][$i][0]=="delete")
					{
					if(file_exists($vault.$phpmusselversion['remote_update_instructions'][$i][1]))
						{
						@unlink($vault.$phpmusselversion['remote_update_instructions'][$i][1]);
						echo "File '".$phpmusselversion['remote_update_instructions'][$i][1]."' ".$MusselConfig['lang']['update_deleted'].". (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						continue;
						}
					}
				if($phpmusselversion['remote_update_instructions'][$i][0]=="patch"||$phpmusselversion['remote_update_instructions'][$i][0]=="patchgz")
					{
					$phpmusselversion['adj_word']=(file_exists($vault.$phpmusselversion['remote_update_instructions'][$i][1]))?$MusselConfig['lang']['update_patched']:$MusselConfig['lang']['update_created'];
					if(!isset($phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]]))
						{
						echo "File '".$phpmusselversion['remote_update_instructions'][$i][1]."' ".$MusselConfig['lang']['update_not']." ".$phpmusselversion['adj_word'].": Source CRC32 missing! (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						continue;
						}
					if(!isset($phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]))
						{
						echo "File '".$phpmusselversion['remote_update_instructions'][$i][1]."' ".$MusselConfig['lang']['update_not']." ".$phpmusselversion['adj_word'].": Source data missing! (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						continue;
						}
					if($phpmusselversion['remote_update_instructions'][$i][0]=="patchgz")
						{
						$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]=@gzinflate($phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]);
						}
					if(crc32($phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]])!=$phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]])
						{
						echo "File '".$phpmusselversion['remote_update_instructions'][$i][1]."' ".$MusselConfig['lang']['update_not']." ".$phpmusselversion['adj_word'].": CRC32 did not match! (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						continue;
						}
					$phpmusselversion['df']=fopen($vault.$phpmusselversion['remote_update_instructions'][$i][1],"w");
					fwrite($phpmusselversion['df'],$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]);
					fclose($phpmusselversion['df']);
					echo "File '".$phpmusselversion['remote_update_instructions'][$i][1]."' ".$phpmusselversion['adj_word']." ".$MusselConfig['lang']['update_successfully'].". (".(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
					continue;
					}
				}
			$phpmusselversion['df']=fopen($vault."update.dat","w");
			fwrite($phpmusselversion['df'],trim($phpmusselversion['update_dat_rebuild'],";"));
			fclose($phpmusselversion['df']);
			}
		else
			{
			$phpmusselversion['raw']=str_replace(substr($phpmusselversion['raw'],48,16),str_pad((time()+86400),16),$phpmusselversion['raw']);
			$phpmusselversion['df']=fopen($vault."update.dat","w");
			fwrite($phpmusselversion['df'],$phpmusselversion['raw']);
			fclose($phpmusselversion['df']);
			}
		echo $MusselConfig['lang']['update_complete'];
		}
	else
		{
		if($phpmusselversion['is_cli'])
			{
			echo "Not updated: Next update check not due until ".date("r",$phpmusselversion['do_not_check_before']).".";
			break;
			}
		plaintext_echo_die("[phpMussel] Not updated: Next update check not due until ".date("r",$phpmusselversion['do_not_check_before']).".");
		}
	break;
	}

if(!$phpmusselversion['is_cli'])die;
?>