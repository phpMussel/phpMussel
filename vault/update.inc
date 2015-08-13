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
 This File: phpMussel v0.7a (13th August 2015) Update Script.
 <%phpMussel%/vault/update.inc>

                                     ~ ~ ~
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

function ReadUpdateFile($f,$s=0)
	{
	if(!file_exists($f))return '';
	$d=@is_file($f);
	if(!$d)return '';
	if(!$s)$s=@ceil(filesize($f)/49152);
	$d='';
	if($s>0)
		{
		$fh=fopen($f,'rb');
		$r=0;
		while($r<$s)
			{
			$d.=fread($fh,49152);
			$r++;
			}
		fclose($fh);
		}
	return (!empty($d))?$d:'';
	}
if(!function_exists('phpMusselV'))
	{
	function phpMusselV($v,$b)
		{
		if(!is_array($v)||!$b)return '';
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
$is_cli=@(isset($is_cli))?$is_cli:false;
while(true)
	{
	$phpmusselversion=array();
	if($is_cli)
		{
		if(!file_exists($vault.'update.dat'))
			{
			echo ' '.$MusselConfig['lang']['update_err1'];
			break;
			}
		}
	else if(!file_exists($vault.'update.dat'))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['update_err1']);
	$phpmusselversion['raw']=implode(file($vault.'update.dat'));
	$phpmusselversion['current_time']=time();
	$phpmusselversion['crc']=array();
	$phpmusselversion['fdata']=array();
	$phpmusselversion['update_addresses']=array();
	$phpmusselversion['update_addresses_count']=0;
	$phpmusselversion['preupdate_instructions']=substr($phpmusselversion['raw'],64);
	$phpmusselversion['preupdate_instructions']=@(substr_count($phpmusselversion['preupdate_instructions'],';')>0)?explode(';',$phpmusselversion['preupdate_instructions']):array(0=>$phpmusselversion['preupdate_instructions']);
	$phpmusselversion['preupdate_instructions_count']=count($phpmusselversion['preupdate_instructions']);
	for($i=0;$i<$phpmusselversion['preupdate_instructions_count'];$i++)
		{
		$phpmusselversion['preupdate_instructions'][$i]=@(substr_count($phpmusselversion['preupdate_instructions'][$i],':')>0)?explode(':',$phpmusselversion['preupdate_instructions'][$i]):array(0=>$phpmusselversion['preupdate_instructions'][$i]);
		if($phpmusselversion['preupdate_instructions'][$i][0]=='updates')
			{
			if($phpmusselversion['preupdate_instructions'][$i][2]>$phpmusselversion['current_time'])
				{
				$phpmusselversion['update_addresses'][$phpmusselversion['update_addresses_count']]=$phpmusselversion['preupdate_instructions'][$i][1];
				$phpmusselversion['update_addresses_count']++;
				}
			}
		}
	if($is_cli)
		{
		if($phpmusselversion['update_addresses_count']<1)
			{
			echo ' '.$MusselConfig['lang']['update_err2'];
			break;
			}
		}
	else if($phpmusselversion['update_addresses_count']<1)plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['update_err2']);
	$phpmusselversion['script_version']=trim(substr($phpmusselversion['raw'],16,16));
	$phpmusselversion['first_compatible']=trim(substr($phpmusselversion['script_version'],strpos($phpmusselversion['script_version'],' ')));
	$phpmusselversion['script_version']=trim(substr($phpmusselversion['script_version'],0,strpos($phpmusselversion['script_version'],' ')));
	if(!$phpmusselversion['server_addr']=(isset($_SERVER['SERVER_ADDR']))?$_SERVER['SERVER_ADDR']:'::1')$phpmusselversion['server_addr']='::1';
	if(!$phpmusselversion['http_host']=(isset($_SERVER['HTTP_HOST']))?$_SERVER['HTTP_HOST']:'localhost')$phpmusselversion['http_host']='localhost';
	$phpmusselversion['phpmussel_ua']=@'phpMussel v'.$phpmusselversion['script_version'].' ('.hash('crc32b',$phpmusselversion['server_addr']).'-'.hash('crc32b',$phpmusselversion['http_host']).')';
	if(!$is_cli)
		{
		header('Content-Type: text/plain');
		echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'];
		}
	echo $MusselConfig['lang']['update_'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n\n";
	$phpmusselversion['request_status']=false;
	$phpmusselversion['gz']=(!function_exists('gzinflate'))?'n':'y';
	$phpmusselversion['request_content']='gz='.$phpmusselversion['gz'].'&files=';
	$phpmusselversion['request_content'].='phpmussel.inc%3A'.md5(ReadUpdateFile($vault.'phpmussel.inc')).'%3B';
	$phpmusselversion['request_content'].='lang.inc%3A'.md5(ReadUpdateFile($vault.'lang.inc')).'%3B';
	$phpmusselversion['request_content'].='update.inc%3A'.md5(ReadUpdateFile($vault.'update.inc')).'%3B';
	$phpmusselversion['request_content'].='switch.dat%3A'.md5(ReadUpdateFile($vault.'switch.dat')).'%3B';
	$phpmusselversion['langCodes']=array('de','en','es','fr','id','it','ja','nl','pt','ru','zh-tw','zh');
	$c=count($phpmusselversion['langCodes']);
	for($i=0;$i<$c;$i++)
		{
		$phpmusselversion['request_content'].='lang/lang.'.$phpmusselversion['langCodes'][$i].'.inc%3A'.md5(ReadUpdateFile($vault.'lang/lang.'.$phpmusselversion['langCodes'][$i].'.inc')).'%3B';
		}
	$SigFileSet=array('ascii_clamav'=>array('ascii_clamav_regex.cvd','ascii_clamav_regex.map','ascii_clamav_standard.cvd','ascii_clamav_standard.map'),'ascii_mussel'=>array('ascii_mussel_regex.cvd','ascii_mussel_standard.cvd'),'coex_clamav'=>array('coex_clamav.cvd'),'coex_mussel'=>array('coex_mussel.cvd'),'elf_clamav'=>array('elf_clamav_regex.cvd','elf_clamav_regex.map','elf_clamav_standard.cvd','elf_clamav_standard.map'),'elf_mussel'=>array('elf_mussel_regex.cvd','elf_mussel_standard.cvd'),'exe_clamav'=>array('exe_clamav_regex.cvd','exe_clamav_regex.map','exe_clamav_standard.cvd','exe_clamav_standard.map'),'exe_mussel'=>array('exe_mussel_regex.cvd','exe_mussel_standard.cvd'),'filenames_clamav'=>array('filenames_clamav.cvd'),'filenames_mussel'=>array('filenames_mussel.cvd'),'general_clamav'=>array('general_clamav_regex.cvd','general_clamav_regex.map','general_clamav_standard.cvd','general_clamav_standard.map'),'general_mussel'=>array('general_mussel_regex.cvd','general_mussel_standard.cvd'),'graphics_clamav'=>array('graphics_clamav_regex.cvd','graphics_clamav_regex.map','graphics_clamav_standard.cvd','graphics_clamav_standard.map'),'graphics_mussel'=>array('graphics_mussel_regex.cvd','graphics_mussel_standard.cvd'),'html_clamav'=>array('html_clamav_regex.cvd','html_clamav_regex.map','html_clamav_standard.cvd','html_clamav_standard.map'),'html_mussel'=>array('html_mussel_regex.cvd','html_mussel_standard.cvd'),'macho_clamav'=>array('macho_clamav_regex.cvd','macho_clamav_regex.map','macho_clamav_standard.cvd','macho_clamav_standard.map'),'macho_mussel'=>array('macho_mussel_regex.cvd','macho_mussel_standard.cvd'),'mail_clamav'=>array('mail_clamav_regex.cvd','mail_clamav_regex.map','mail_clamav_standard.cvd','mail_clamav_standard.map'),'mail_mussel'=>array('mail_mussel_regex.cvd','mail_mussel_standard.cvd','mail_mussel_standard.map'),'md5_clamav'=>array('md5_clamav.cvd'),'md5_mussel'=>array('md5_mussel.cvd'),'metadata_clamav'=>array('metadata_clamav.cvd'),'metadata_mussel'=>array('metadata_mussel.cvd'),'ole_clamav'=>array('ole_clamav_regex.cvd','ole_clamav_regex.map','ole_clamav_standard.cvd','ole_clamav_standard.map'),'ole_mussel'=>array('ole_mussel_regex.cvd','ole_mussel_standard.cvd'),'pdf_clamav'=>array('pdf_clamav_regex.cvd','pdf_clamav_regex.map','pdf_clamav_standard.cvd','pdf_clamav_standard.map'),'pdf_mussel'=>array('pdf_mussel_regex.cvd','pdf_mussel_standard.cvd'),'pe_clamav'=>array('pe_clamav.cvd'),'pe_mussel'=>array('pe_mussel.cvd'),'swf_clamav'=>array('swf_clamav_regex.cvd','swf_clamav_regex.map','swf_clamav_standard.cvd','swf_clamav_standard.map'),'swf_mussel'=>array('swf_mussel_regex.cvd','swf_mussel_standard.cvd'),'whitelist_clamav'=>array('whitelist_clamav.cvd'),'whitelist_mussel'=>array('whitelist_mussel.cvd'),'xmlxdp_clamav'=>array('xmpxdp_clamav_regex.cvd','xmpxdp_clamav_regex.map','xmpxdp_clamav_standard.cvd','xmpxdp_clamav_standard.map'),'xmlxdp_mussel'=>array('xmpxdp_mussel_regex.cvd','xmpxdp_mussel_standard.cvd'));
	$c=count($SigFileSet);
	while($c>0)
		{
		if($k=@key($SigFileSet))if(isset($MusselConfig['signatures'][$k]))
			{
			if(!$MusselConfig['signatures'][$k])
				{
				foreach($SigFileSet[$k] as $SigFile)$phpmusselversion['request_content'].=$SigFile.'%3AIGNORE%3B';
				}
			else foreach($SigFileSet[$k] as $SigFile)$phpmusselversion['request_content'].=$SigFile.'%3A'.md5(ReadUpdateFile($vault.$SigFile)).'%3B';
			}
		next($SigFileSet);
		$c--;
		}
	$c=$k=$SigFile=$SigFileSet=false;
	if(isset($MusselConfig['attack_specific']['general_commands']))
		{
		if(!$MusselConfig['attack_specific']['general_commands'])$phpmusselversion['request_content'].='hex_general_commands.csv%3AIGNORE%3B';
		else $phpmusselversion['request_content'].='hex_general_commands.csv%3A'.md5(ReadUpdateFile($vault.'hex_general_commands.csv')).'%3B';
		}
	$phpmusselversion['request_content'].='update.dat%3A'.md5(ReadUpdateFile($vault.'update.dat')).'%3B';
	for($i=0;$i<$phpmusselversion['update_addresses_count'];$i++)
		{
		echo $MusselConfig['lang']['update_fetch'].' http://'.substr($phpmusselversion['update_addresses'][$i],0,(strlen($phpmusselversion['update_addresses'][$i])-strpos($phpmusselversion['update_addresses'][$i],'/'))*-1).'/ ... ';
		$phpmusselversion['stream']=stream_context_create(array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$phpmusselversion['phpmussel_ua'],'content'=>$phpmusselversion['request_content'],'timeout'=>8)));
		$phpmusselversion['request']=file_get_contents('http://'.$phpmusselversion['update_addresses'][$i],false,$phpmusselversion['stream']);
		if(trim(substr($phpmusselversion['request'],0,16))!=='¡phpMussel!')
			{
			echo $MusselConfig['lang']['update_failed'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
			$phpmusselversion['update_addresses'][$i]='';
			continue;
			}
		$phpmusselversion['request_status']=true;
		echo $MusselConfig['lang']['update_success'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
		break;
		}
	if(!$phpmusselversion['request_status'])
		{
		echo $MusselConfig['lang']['update_no_source'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
		break;
		}
	$phpmusselversion['remote_script_version']=trim(substr($phpmusselversion['request'],16,16));
	$phpmusselversion['remote_first_compatible']=trim(substr($phpmusselversion['remote_script_version'],strpos($phpmusselversion['remote_script_version'],' ')));
	$phpmusselversion['remote_script_version']=trim(substr($phpmusselversion['remote_script_version'],0,strpos($phpmusselversion['remote_script_version'],' ')));
	echo "\n\n===\n".$MusselConfig['lang']['update_version_yours'].":\n   phpMussel v".$phpmusselversion['script_version'].";\n".$MusselConfig['lang']['update_version_latest'].":\n   phpMussel v".$phpmusselversion['remote_script_version'].";\n";
	if($phpmusselversion['first_compatible']===$phpmusselversion['remote_first_compatible'])
		{
		echo ($phpmusselversion['script_version']===$phpmusselversion['remote_script_version'])?$MusselConfig['lang']['update_not_available']."\n\n":$MusselConfig['lang']['update_available']."\n\n";
		$phpmusselversion['signatures_version']=trim(substr($phpmusselversion['raw'],32,16));
		$phpmusselversion['signatures_version_human']=explode(' ',$phpmusselversion['signatures_version']);
		$phpmusselversion['signatures_version_human']='   ClamAV main '.$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['signatures_version_human'][0].",\n   ClamAV daily ".$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['signatures_version_human'][1].",\n   Non-ClamAV/phpMussel ".$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['signatures_version_human'][2].'.';
		$phpmusselversion['remote_signatures_version']=trim(substr($phpmusselversion['request'],32,16));
		$phpmusselversion['remote_signatures_version_human']=explode(' ',$phpmusselversion['remote_signatures_version']);
		$phpmusselversion['remote_signatures_version_human']='   ClamAV main '.$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['remote_signatures_version_human'][0].",\n   ClamAV daily ".$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['remote_signatures_version_human'][1].",\n   Non-ClamAV/phpMussel ".$MusselConfig['lang']['update_wrd1'].' #'.$phpmusselversion['remote_signatures_version_human'][2].'.';
		echo $MusselConfig['lang']['update_signatures_yours'].":\n".$phpmusselversion['signatures_version_human']."\n".$MusselConfig['lang']['update_signatures_latest'].":\n".$phpmusselversion['remote_signatures_version_human']."\n";
		echo ($phpmusselversion['signatures_version']===$phpmusselversion['remote_signatures_version'])?$MusselConfig['lang']['update_signatures_not_available']."\n":$MusselConfig['lang']['update_signatures_available']."\n";
		}
	else echo $MusselConfig['lang']['update_not_possible']."\n";
	echo "===\n\n";
	if($phpmusselversion['remote_update_instructions']=@substr($phpmusselversion['request'],64))
		{
		$phpmusselversion['remote_update_instructions']=@(substr_count($phpmusselversion['remote_update_instructions'],';')>0)?explode(';',$phpmusselversion['remote_update_instructions']):array(0=>$phpmusselversion['remote_update_instructions']);
		$phpmusselversion['remote_update_instructions_count']=count($phpmusselversion['remote_update_instructions']);
		$phpmusselversion['remote_hack_detected']=false;
		for($i=0;$i<$phpmusselversion['remote_update_instructions_count'];$i++)
			{
			$phpmusselversion['itype']=substr($phpmusselversion['remote_update_instructions'][$i],0,5);
			if($phpmusselversion['itype']=='delet'||$phpmusselversion['itype']=='patch')
				{
				if(preg_match("/2e2e|2f2e|5c2e|2f2f|5c5c|2e(2e|2f|5c|62|646c|65|67|68|6a|70|73)/i",bin2hex(strtolower($phpmusselversion['remote_update_instructions'][$i]))))
					{
					$phpmusselversion['remote_hack_detected']=true;
					break;
					}
				}
			$phpmusselversion['remote_update_instructions'][$i]=@(substr_count($phpmusselversion['remote_update_instructions'][$i],':')>0)?explode(':',$phpmusselversion['remote_update_instructions'][$i]):array(0=>$phpmusselversion['remote_update_instructions'][$i]);
			}
		if($phpmusselversion['remote_hack_detected'])
			{
			echo $MusselConfig['lang']['update_err3'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
			break;
			}
		for($i=0;$i<$phpmusselversion['remote_update_instructions_count'];$i++)
			{
			if($phpmusselversion['remote_update_instructions'][$i][0]=='crc')$phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]]=$phpmusselversion['remote_update_instructions'][$i][2];
			else if($phpmusselversion['remote_update_instructions'][$i][0]=='fdata')$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]=@base64_decode($phpmusselversion['remote_update_instructions'][$i][2]);
			else if($phpmusselversion['remote_update_instructions'][$i][0]=='delete')
				{
				if(file_exists($vault.$phpmusselversion['remote_update_instructions'][$i][1]))
					{
					@unlink($vault.$phpmusselversion['remote_update_instructions'][$i][1]);
					echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$MusselConfig['lang']['update_deleted'].$MusselConfig['lang']['update_successfully']),$MusselConfig['lang']['update_was']).'. ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
					}
				}
			else if($phpmusselversion['remote_update_instructions'][$i][0]=='patch'||$phpmusselversion['remote_update_instructions'][$i][0]=='patchgz')
				{
				$phpmusselversion['adj_word']=(file_exists($vault.$phpmusselversion['remote_update_instructions'][$i][1]))?$MusselConfig['lang']['update_patched']:$MusselConfig['lang']['update_created'];
				if(!isset($phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]]))echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpmusselversion['adj_word']),$MusselConfig['lang']['update_not']).': '.$MusselConfig['lang']['update_err4'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				else if(!isset($phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]))echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpmusselversion['adj_word']),$MusselConfig['lang']['update_not']).': '.$MusselConfig['lang']['update_err5'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				else if(!$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]])echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpmusselversion['adj_word']),$MusselConfig['lang']['update_not']).': '.$MusselConfig['lang']['update_err6'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
				else
					{
					if($phpmusselversion['remote_update_instructions'][$i][0]=='patchgz')$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]=@gzinflate($phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]);
					if(@hash('crc32b',$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]])!=$phpmusselversion['crc'][$phpmusselversion['remote_update_instructions'][$i][1]])echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpmusselversion['adj_word']),$MusselConfig['lang']['update_not']).': '.$MusselConfig['lang']['update_err7'].' ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
					else
						{
						$phpmusselversion['df']=fopen($vault.$phpmusselversion['remote_update_instructions'][$i][1],'w');
						fwrite($phpmusselversion['df'],$phpmusselversion['fdata'][$phpmusselversion['remote_update_instructions'][$i][1]]);
						fclose($phpmusselversion['df']);
						echo $MusselConfig['lang']['file'].' \''.$phpmusselversion['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpmusselversion['adj_word'].$MusselConfig['lang']['update_successfully']),$MusselConfig['lang']['update_was']).'. ('.(time()-$phpmusselversion['current_time']).$MusselConfig['lang']['update_seconds_elapsed'].")\n";
						}
					}
				}
			$phpmusselversion['remote_update_instructions'][$i]='';
			}
		}
	echo $MusselConfig['lang']['update_complete'];
	break;
	}

if(!$is_cli)die;
?>