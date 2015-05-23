<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

 Thank you for using phpMussel, a PHP script designed to detect trojans,
 viruses, malware and other threats within files uploaded to your system
 wherever the script is hooked, based on the signatures of ClamAV and others.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan).

 This script is free software; you can redistribute it and/or modify it under
 the terms of the GNU General Public License as published by the Free Software
 Foundation; either version 2 of the License, or (at your option) any later
 version. This script is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
 details <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>.

 Special thanks to ClamAV for both project inspiration and for the signatures
 that this script utilises, without which, the script would likely not exist,
 or at best, would have very limited value <http://www.clamav.net/>.

 Special thanks to Sourceforge for hosting the project files, located at
 <http://sourceforge.net/projects/phpmussel/>, to Spambot Security for hosting
 the phpMussel discussions forums, located at
 <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, and to the
 additional sources of a number of the signatures utilised by phpMussel:
 SecuriteInfo.com <http://www.securiteinfo.com/>, PhishTank
 <http://www.phishtank.com/>, NLNetLabs <http://nlnetlabs.nl/> and others, and
 special thanks to all those supporting the project, to anyone else that I may
 have otherwise forgotten to mention, and to you, for using the script.

 This document and its associated package can be downloaded for free from
 Sourceforge <http://sourceforge.net/projects/phpmussel/>.

                                     ~ ~ ~
 This File: phpMussel v0.6f (9th March 2015) Core Script.

 The latest version and future updates can be obtained from the phpMussel
 SourceForge page located at <http://sourceforge.net/projects/phpmussel/>.

                                     ~ ~ ~
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

if(!defined('phpMussel'))die("[phpMussel] This should not be accessed directly.");

$phpmusselversion="phpMussel v0.6f";
$linebreak=chr(10);
if(!isset($MusselConfig['general']['ipaddr']))$MusselConfig['general']['ipaddr']="REMOTE_ADDR";
if(!isset($_SERVER[$MusselConfig['general']['ipaddr']]))$_SERVER[$MusselConfig['general']['ipaddr']]="";
$inidefaults=array();
$inidefaults['display_errors']=@ini_get("display_errors");
@ini_set("display_errors","1");
$inidefaults['backtrack_limit']=@ini_get("pcre.backtrack_limit");
@ini_set("pcre.backtrack_limit","4K");
$inidefaults['user_agent']=@ini_get("user_agent");
@ini_set("user_agent",$phpmusselversion." (".crc32($_SERVER['SERVER_ADDR'])."-".crc32($_SERVER['HTTP_HOST']).")");
if(!function_exists("implode_md"))
	{
	function implode_md($ar,$j="",$i=0,$e=1)
		{
		if(!is_array($ar))return $ar;
		$c=count($ar);
		if(is_array($i)||!$c)return false;
		if(is_array($j))
			{
			if(!$x=$j[$i])return false;
			}
		else
			{
			$x=$j;
			}
		$out="";
		while($c>0)
			{
			$key=key($ar);
			if(is_array($ar[$key]))
				{
				$i++;
				$ar[$key]=implode_md($ar[$key],$j,$i);
				$i--;
				}
			if(!$out)
				{
				$out=$ar[$key];
				}
			else if(!(!$e&&!$ar[$key]))$out.=$x.$ar[$key];
			next($ar);
			$c--;
			}
		return $out;
		}
	}
if(!function_exists("str_split"))
	{
	function str_split($s)
		{
		return @preg_split("//",$s,-1,PREG_SPLIT_NO_EMPTY);
		}
	}
function substr_compare_hex($str=0,$st=0,$l=0,$x=0,$p=0)
	{
	if(!$l)$l=strlen($str);
	if(!$x||!$l)return false;
	$str=@substr($str,$st,$l);
	$y="";
	for($i=0;$i<$l;$i++)
		{
		$z=@dechex(ord($str[$i]));
		if(strlen($z)===1)$z="0".$z;
		$y.=$z;
		}
	if(!$p)return (substr_count($y,strtolower($x))>0)?true:false;
	return ($y===strtolower($x))?true:false;
	}
if(!function_exists("bin2hex"))
	{
	function bin2hex($str)
		{
		$l=strlen($str);
		$y="";
		for($i=0;$i<$l;$i++)
			{
			$z=@dechex(ord($str[$i]));
			if(strlen($z)===1)$z="0".$z;
			$y.=$z;
			}
		return $y;
		}
	}
if(!function_exists("hex2bin"))
	{
	function hex2bin($str)
		{
		$n="";
		$l=strlen($str);
		$x=false;
		for($i=0;$i<$l;$i++)
			{
			$x=(!$x)?true:false;
			if($x)
				{
				$z=$i+1;
				$n.=@chr(hexdec($str[$i].$str[$z]));
				}
			}
		return $n;
		}
	}
function prescan_decode($str)
	{
	$nstr=html_entity_decode(urldecode(str_ireplace("&amp;#","&#",str_ireplace("&amp;amp;","&amp;",$str))));
	if($nstr!==$str)$nstr=prescan_decode($nstr);
	return $nstr;
	}
function prescan_normalise($str,$html=false,$decode=false)
	{
	$ostr="";
	if($decode)
		{
		$ostr.=$str;
		while(true)
			{
			if(function_exists("gzinflate"))
				{
				$found=preg_match_all("/(gzinflate\s*\(\s*str_rot13\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".gzinflate(str_rot13(base64_decode(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[4][$im]))))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(gzinflate\s*\(\s*base64_decode\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".gzinflate(base64_decode(str_rot13(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im]))))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(str_rot13\s*\(\s*gzinflate\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".str_rot13(gzinflate(base64_decode(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[4][$im]))))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(base64_decode\s*\(\s*gzinflate\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".base64_decode(gzinflate(str_rot13(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im]))))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(gzinflate\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".gzinflate(base64_decode(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[4][$im])))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(gzinflate\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".gzinflate(str_rot13(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im])))."\"",$str);
						}
					continue;
					}
				$found=preg_match_all("/(gzinflate\s*\(\s*[\"\'])(.+)(,[0-9])?([\"\']\s*\))/i",$str,$matches);
				if($found)
					{
					$cm=count($matches[0]);
					for($im=0;$cm>$im;$im++)
						{
						$str=str_ireplace($matches[0][$im],"\"".gzinflate(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[4][$im]))."\"",$str);
						}
					continue;
					}
				}
			$found=preg_match_all("/(str_rot13\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_ireplace($matches[0][$im],"\"".str_rot13(base64_decode(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[4][$im])))."\"",$str);
					}
				continue;
				}
			$found=preg_match_all("/(base64_decode\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_ireplace($matches[0][$im],"\"".base64_decode(str_rot13(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im])))."\"",$str);
					}
				continue;
				}
			$found=preg_match_all("/(base64_decode|decode_base64|base64\.b64decode|atob|Base64\.decode64)(\s*\(\s*[\"\'\`])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\'\`]\s*\))/i",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_ireplace($matches[0][$im],"\"".base64_decode(substrbl(substraf($matches[0][$im],$matches[1][$im].$matches[2][$im]),$matches[5][$im]))."\"",$str);
					}
				continue;
				}
			$found=preg_match_all("/(str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\))/i",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_ireplace($matches[0][$im],"\"".str_rot13(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im]))."\"",$str);
					}
				continue;
				}
			$found=preg_match_all("/(hex2bin\s*\(\s*[\"\'])([a-fA-F0-9]+)([\"\']\s*\))/i",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_ireplace($matches[0][$im],"\"".hex2bin(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im]))."\"",$str);
					}
				continue;
				}
			$found=preg_match_all("/([Uu][Nn][Pp][Aa][Cc][Kk]\s*\(\s*[\"\']\s*H\*\s*[\"\']\s*,\s*[\"\'])([a-fA-F0-9]+)([\"\']\s*\))/",$str,$matches);
			if($found)
				{
				$cm=count($matches[0]);
				for($im=0;$cm>$im;$im++)
					{
					$str=str_replace($matches[0][$im],"\"".hex2bin(substrbl(substraf($matches[0][$im],$matches[1][$im]),$matches[3][$im]))."\"",$str);
					}
				continue;
				}
			break;
			}
		}
	$str=@preg_replace("/[^\x21-\x7e]/","",strtolower(prescan_decode($str.$ostr)));
	$ostr=false;
	if($html)$str=@preg_replace(array("@<script[^>]*?>.*?</script>@si","@<[\/\!]*?[^<>]*?>@si","@<style[^>]*?>.*?</style>@siU","@<![\s\S]*?--[ \t\n\r]*>@"),"",$str);
	return trim($str);
	}
function prescan_xmlxdp($str,$md5=false,$pdf=false)
	{
	if($md5)
		{
		if(!isset($GLOBALS['memCache']['xmlxdp']))$GLOBALS['memCache']['xmlxdp']=array();
		if(!isset($GLOBALS['memCache']['xmlxdp'][$md5]))$GLOBALS['memCache']['xmlxdp'][$md5]=array();
		}
	$nstr=@preg_replace("/[^\x21-\x7e]/","",prescan_decode($str));
	$chunks=$chunki="";
	$i=0;
	while(true)
		{
		$found=preg_match_all("/<chunk>(.+)<\/chunk>/i",$nstr,$matches);
		if($found)
			{
			$cm=count($matches[0]);
			for($im=0;$cm>$im;$im++)
				{
				$chunki=@base64_decode($matches[1][$im]);
				if($chunki)
					{
					$nstr=@str_replace($matches[0][$im],"",$nstr);
					$chunks.=$chunki;
					if($md5)
						{
						$GLOBALS['memCache']['xmlxdp'][$md5][$i]=md5($chunki).":".strlen($chunki).":";
						$i++;
						}
					}
				}
			continue;
			}
		$chunki="";
		break;
		}
	if($pdf)$chunks=$nstr.$chunks;
	return $chunks;
	}
if(!function_exists("substrbf"))
	{
	function substrbf($h,$n)
		{
		return @substr($h,0,strpos($h,$n));
		}
	}
if(!function_exists("substraf"))
	{
	function substraf($h,$n)
		{
		return @substr($h,strpos($h,$n)+strlen($n));
		}
	}
if(!function_exists("substrbl"))
	{
	function substrbl($h,$n)
		{
		return @substr($h,0,strrpos($h,$n));
		}
	}
if(!function_exists("substral"))
	{
	function substral($h,$n)
		{
		return @substr($h,strrpos($h,$n)+strlen($n));
		}
	}
function phpMusselFile($f,$s=0,$c=0)
	{
	if(!$c)
		{
		$d=@is_file($f);
		if(!$d)return false;
		}
	if(!$s)$s=@ceil(filesize($f)/1024);
	$d="";
	if($s>0)
		{
		$fh=fopen($f,"rb");
		$r=0;
		while($r<$s)
			{
			$d.=fread($fh,1024);
			$r++;
			}
		fclose($fh);
		}
	if(!empty($d))return $d;
	return false;
	}
function phpMusselQ($s,$key,$ip,$id)
	{
	if(!$s||!$key||!$ip||!$id||!function_exists('gzdeflate'))return false;
	if(strlen($key)<128)if(!$key=@hex2bin(hash('sha512',$key).hash('whirlpool',$key)))return false;
	$h="\xa1phpMussel\x21".hex2bin(md5($s)).pack("l*",strlen($s))."\x01";
	$s=gzdeflate($s,9);
	$o="";
	$i=0;
	$c=strlen($s);
	$k=strlen($key);
	while($i<$c)for($j=0;$j<$k;$j++,$i++)$o.=@$s{$i}^$key{$j};
	$o="\x2f\x3d\x3d\x20phpMussel\x20Quarantined\x20File\x20Upload\x20\x3d\x3d\x5c\n\x7c\x20Time\x2fDate\x20Uploaded\x3a\x20".str_pad(time(),18,"\x20")."\x7c\n\x7c\x20Uploaded\x20From\x3a\x20".str_pad($ip,22,"\x20")."\x20\x7c\n\x5c".str_repeat("\x3d",39)."\x2f\n\n\n".$h.$o;
	$u=@phpMusselMemUse($GLOBALS['vault']."quarantine/");
	$u=$u['s']+strlen($o);
	if($u>($GLOBALS['MusselConfig']['general']['quarantine_max_usage']*1024))$u=@phpMusselMemUse($GLOBALS['vault']."quarantine/",$u-($GLOBALS['MusselConfig']['general']['quarantine_max_usage']*1024));
	$xf=fopen($GLOBALS['vault']."quarantine/".$id.".qfu","a");
	fwrite($xf,$o);
	fclose($xf);
	return true;
	}
function phpMusselMemUse($p,$d=0)
	{
	$t=array("s"=>0,"c"=>0,"dc"=>0,"d"=>$d);
	if(is_dir($p))if($h=@opendir($p))while(false!==($f=readdir($h)))
		{
		if($f!='.'&&$f!='..'&&!is_link($np=$p.'/'.$f))
			{
			if(is_dir($np))
				{
				$t['dc']++;
				$r=phpMusselMemUse($np,$t['d']);
				$t['s']+=$r['s'];
				$t['c']+=$r['c'];
				$t['dc']+=$r['dc'];
				$t['d']-=$r['d'];
				}
			else if(is_file($np))
				{
				$ns=filesize($np);
				if($t['d']>0&&substr_count($np."\x01",".qfu\x01")>0)
					{
					@unlink($np);
					$t['d']-=$ns;
					}
				else
					{
					$t['s']+=$ns;
					$t['c']++;
					}
				}
			}
		}
	closedir($h);
	return $t;
	}
if(!function_exists("scandir"))
	{
	function scandir($r,$x=false)
		{
		if(!is_dir($r))return false;
		$d=array();
		$i=0;
		if($h=@opendir($r))while(false!==($f=readdir($h)))
			{
			if($f!='.'&&$f!='..'&&!is_link($np=$p.'/'.$f))
				{
				$d[$i]=$np;
				$i++;
				}
			}
		closedir($h);
		return $d;
		}
	}
function split_nibble($n)
	{
	$n=@bin2hex($n);
	$h=hexdec(isset($n[0])?$n[0]:"0");
	$l=hexdec(isset($n[1])?$n[1]:"0");
	return array($h,$l);
	}
function vn_shorthand($vn)
	{
	if($vn[0]!=="\x1a")return $vn;
	$n=split_nibble($vn[1]);
	$out="";
	if($n[0]===2)$out.="ClamAV-";
	else if($n[0]===3)$out.="phpMussel-";
	else if($n[0]===4)$out.="SecuriteInfo-";
	else if($n[0]===5)$out.="ZBB-";
	else if($n[0]===6)$out.="NLNetLabs-";
	else if($n[0]===7)$out.="FoxIT-";
	else if($n[0]===8)$out.="phpMussel-PhishTank.Derivitive.";
	if($n[1]===1)$out.="Testfile.";
	else if($n[1]===2)$out.="FN.";
	else if($n[1]===3)$out.="VT.";
	else if($n[1]===4)$out.="META.";
	else if($n[1]===5)$out.="Chameleon.";
	else if($n[1]===6)$out.="Werewolf.";
	else if($n[1]===7)$out.="Suspect.";
	else if($n[1]===8)$out.="Fake.";
	else if($n[1]===9)$out.="CVE.";
	else if($n[1]===15)$out.="Heuristic.";
	$n=split_nibble($vn[2]);
	if($n[0]===1)
		{
		if($n[1]===1)$out.="Win.";
		else if($n[1]===2)$out.="W32.";
		else if($n[1]===3)$out.="W64.";
		else if($n[1]===4)$out.="ELF.";
		else if($n[1]===5)$out.="OSX.";
		else if($n[1]===6)$out.="Android.";
		else if($n[1]===7)$out.="Email.";
		else if($n[1]===8)$out.="JS.";
		else if($n[1]===9)$out.="Java.";
		else if($n[1]===10)$out.="XXE.";
		else if($n[1]===11)$out.="Graphics.";
		else if($n[1]===12)$out.="OLE.";
		else if($n[1]===13)$out.="HTML.";
		}
	if($n[0]===2)
		{
		if($n[1]===0)$out.="PHP.";
		else if($n[1]===1)$out.="XML.";
		else if($n[1]===2)$out.="ASP.";
		else if($n[1]===3)$out.="VBS.";
		else if($n[1]===4)$out.="BAT.";
		else if($n[1]===5)$out.="PDF.";
		else if($n[1]===6)$out.="SWF.";
		else if($n[1]===7)$out.="W97M.";
		else if($n[1]===8)$out.="X97M.";
		else if($n[1]===9)$out.="O97M.";
		else if($n[1]===10)$out.="ASCII.";
		else if($n[1]===11)$out.="Unix.";
		}
	$n=split_nibble($vn[3]);
	if($n[0]===1)
		{
		if($n[1]===1)$out.="Worm.";
		else if($n[1]===2)$out.="Trojan.";
		else if($n[1]===3)$out.="Adware.";
		else if($n[1]===4)$out.="Flooder.";
		else if($n[1]===5)$out.="IRC.";
		else if($n[1]===6)$out.="Exploit.";
		else if($n[1]===7)$out.="VirTool.";
		else if($n[1]===8)$out.="Dialer.";
		else if($n[1]===9)$out.="Joke.";
		else if($n[1]===10)$out.="PUA.";
		else if($n[1]===11)$out.="Malware.";
		else if($n[1]===12)$out.="Riskware.";
		else if($n[1]===13)$out.="Rootkit.";
		else if($n[1]===14)$out.="Backdoor.";
		else if($n[1]===15)$out.="Hacktool.";
		}
	if($n[0]===2)
		{
		if($n[1]===0)$out.="Keylogger.";
		else if($n[1]===1)$out.="Ransomware.";
		else if($n[1]===2)$out.="Spyware.";
		else if($n[1]===3)$out.="Virus.";
		else if($n[1]===4)$out.="Dropper.";
		else if($n[1]===5)$out.="Dropped.";
		else if($n[1]===6)$out.="Downloader.";
		else if($n[1]===7)$out.="Obfuscation.";
		else if($n[1]===8)$out.="Obfuscator.";
		else if($n[1]===9)$out.="Obfuscated.";
		else if($n[1]===10)$out.="Packer.";
		else if($n[1]===11)$out.="Packed.";
		else if($n[1]===12)$out.="PUP.";
		else if($n[1]===13)$out.="Shell.";
		else if($n[1]===14)$out.="Defacer.";
		else if($n[1]===15)$out.="Defacement.";
		}
	return $out.substr($vn,4);
	}
function phpMusselD($str="",$n=0,$dpt=0,$ofn="")
	{
	$fm=($n==2)?1:0;
	$xskd=false;
	$dpt++;
	$lnap="";
	for($i=0;$i<($dpt-1);$i++)
		{
		$lnap.="-";
		}
	$lnap.="> ";
	$out="";
	$str_len=strlen($str);
	$md5=md5($str);
	$sha=sha1($str);
	$crc=@hash("crc32b",$str);
	$fourcc=strtolower(bin2hex(substr($str,0,4)));
	$twocc=strtolower(bin2hex(substr($str,0,2)));
	$CoExMeta="\$ofn:".$ofn.";md5(\$ofn):".md5($ofn).";\$dpt:".$dpt.";\$str_len:".$str_len.";\$md5:".$md5.";\$sha:".$sha.";\$crc:".$crc.";\$fourcc:".$fourcc.";\$twocc:".$twocc.";";
	if(!$ofn)
		{
		$out.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_missing_filename']."!".$GLOBALS['linebreak'];
		if($fm)if(!$xskd)
			{
			$GLOBALS['xsk'].=$md5.":".$str_len.":".$GLOBALS['linebreak'];
			$xskd=true;
			}
		if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_missing_filename']."! ";
		return (!$n)?2:$out;
		}
	$climode=(function_exists("phpMusselFork")&&strlen(mussel_php)>0&&mussel_os=="WIN"&&mussel_sapi=="cli")?1:0;
	$decode_or_not=(($GLOBALS['MusselConfig']['attack_specific']['decode_threshold']>0&&$str_len>($GLOBALS['MusselConfig']['attack_specific']['decode_threshold']*1024))||$str_len<16)?0:1;
	$len_kb=($str_len>1024)?1:0;
	$len_hmb=($str_len>524288)?1:0;
	$len_mb=($str_len>1048576)?1:0;
	$len_hgb=($str_len>536870912)?1:0;
	$phase=$GLOBALS['memCache']['phase'];
	$file_is_ole=$GLOBALS['memCache']['file_is_ole'];
	$pdf_magic=($fourcc=="25504446")?true:false;
	$xt=$xts=$gzxt=$gzxts="-";
	if(substr_count($ofn,".")>0)
		{
		$xt=explode(".",strtolower($ofn));
		$xts=substr($xt[count($xt)-1],0,3)."*";
		$xt=$xt[count($xt)-1];
		if(strlen($xt)<1)$xt=$xts="-";
		}
	if(substr_count($ofn,".")>1)
		{
		$gzxt=explode(".",str_replace(".gz","",strtolower($ofn)));
		$gzxts=substr($gzxt[count($gzxt)-1],0,3)."*";
		$gzxt=strtolower($gzxt[count($gzxt)-1]);
		if(strlen($gzxt)<1)$gzxt=$gzxts="-";
		}
	$CoExMeta.="\$xt:".$xt.";\$xts:".$xts.";";
	if($GLOBALS['MusselConfig']['signatures']['filenames_clamav'])
		{
		if(!isset($GLOBALS['memCache']['filenames_clamav.cvd']))$GLOBALS['memCache']['filenames_clamav.cvd']=@file($GLOBALS['vault']."filenames_clamav.cvd");
		if(!$GLOBALS['memCache']['filenames_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (filenames_clamav.cvd)!".$GLOBALS['linebreak'];
			$c=0;
			}
		else
			{
			$c=@count($GLOBALS['memCache']['filenames_clamav.cvd']);
			}
		$vn="";
		$i=0;
		while($i<$c)
			{
			$xsig=$GLOBALS['memCache']['filenames_clamav.cvd'][$i];
			if(substr($xsig,0,1)==">")
				{
				$xsig=explode(">",$xsig,4);
				$xsig[3]=($xsig[3]*-1)*-1;
				if($xsig[1]=="FN")
					{
					if(!preg_match("/".$xsig[2]."/i",$ofn))
						{
						if($xsig[3]<=$i)break;
						$i=$xsig[3];
						continue;
						}
					}
				else if(substr($xsig[1],0,1)=="\$")
					{
					$vf=substr($xsig[1],1);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf!=$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				else if(substr($xsig[1],0,2)=="!\$")
					{
					$vf=substr($xsig[1],2);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf==$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				$i++;
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
				$xsig=($xsig===false?"":implode("",$xsig));
				$xlen=strlen($xsig);
				if($xlen<$GLOBALS['MusselConfig']['signatures']['fn_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['fn_siglen_max'])
					{
					$i++;
					continue;
					}
				$vn=$vn[0];
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
					{
					if(preg_match("/".$xsig."/i",$ofn))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			$i++;
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['filenames_custom'])
		{
		if(!isset($GLOBALS['memCache']['filenames_custom.cvd']))$GLOBALS['memCache']['filenames_custom.cvd']=@file($GLOBALS['vault']."filenames_custom.cvd");
		if(!$GLOBALS['memCache']['filenames_custom.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (filenames_custom.cvd)!".$GLOBALS['linebreak'];
			$c=0;
			}
		else
			{
			$c=@count($GLOBALS['memCache']['filenames_custom.cvd']);
			}
		$vn="";
		$i=0;
		while($i<$c)
			{
			$xsig=$GLOBALS['memCache']['filenames_custom.cvd'][$i];
			if(substr($xsig,0,1)==">")
				{
				$xsig=explode(">",$xsig,4);
				$xsig[3]=($xsig[3]*-1)*-1;
				if($xsig[1]=="FN")
					{
					if(!preg_match("/".$xsig[2]."/i",$ofn))
						{
						if($xsig[3]<=$i)break;
						$i=$xsig[3];
						continue;
						}
					}
				else if(substr($xsig[1],0,1)=="\$")
					{
					$vf=substr($xsig[1],1);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf!=$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				else if(substr($xsig[1],0,2)=="!\$")
					{
					$vf=substr($xsig[1],2);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf==$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				$i++;
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
				$xsig=($xsig===false?"":implode("",$xsig));
				$xlen=strlen($xsig);
				if($xlen<$GLOBALS['MusselConfig']['signatures']['fn_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['fn_siglen_max'])
					{
					$i++;
					continue;
					}
				$vn=$vn[0];
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
					{
					if(preg_match("/".$xsig."/i",$ofn))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			$i++;
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['filenames_mussel'])
		{
		if(!isset($GLOBALS['memCache']['filenames_mussel.cvd']))$GLOBALS['memCache']['filenames_mussel.cvd']=@file($GLOBALS['vault']."filenames_mussel.cvd");
		if(!$GLOBALS['memCache']['filenames_mussel.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (filenames_mussel.cvd)!".$GLOBALS['linebreak'];
			$c=0;
			}
		else
			{
			$c=@count($GLOBALS['memCache']['filenames_mussel.cvd']);
			}
		$vn="";
		$i=0;
		while($i<$c)
			{
			$xsig=$GLOBALS['memCache']['filenames_mussel.cvd'][$i];
			if(substr($xsig,0,1)==">")
				{
				$xsig=explode(">",$xsig,4);
				$xsig[3]=($xsig[3]*-1)*-1;
				if($xsig[1]=="FN")
					{
					if(!preg_match("/".$xsig[2]."/i",$ofn))
						{
						if($xsig[3]<=$i)break;
						$i=$xsig[3];
						continue;
						}
					}
				else if(substr($xsig[1],0,1)=="\$")
					{
					$vf=substr($xsig[1],1);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf!=$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				else if(substr($xsig[1],0,2)=="!\$")
					{
					$vf=substr($xsig[1],2);
					if(isset($$vf))if(!is_array($$vf))
						{
						if($$vf==$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3];
							continue;
							}
						$i++;
						continue;
						}
					if($xsig[3]<=$i)break;
					$i=$xsig[3]-1;
					continue;
					}
				$i++;
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
				$xsig=($xsig===false?"":implode("",$xsig));
				$xlen=strlen($xsig);
				if($xlen<$GLOBALS['MusselConfig']['signatures']['fn_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['fn_siglen_max'])
					{
					$i++;
					continue;
					}
				$vn=$vn[0];
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
					{
					if(preg_match("/".$xsig."/i",$ofn))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			$i++;
			}
		}
	if(!$str_len)return 1;
	$whitelist=array();
	if($GLOBALS['MusselConfig']['signatures']['whitelist_clamav'])
		{
		if(!isset($GLOBALS['memCache']['whitelist_clamav.cvd']))$GLOBALS['memCache']['whitelist_clamav.cvd']=@implode_md(file($GLOBALS['vault']."whitelist_clamav.cvd"));
		if(!$GLOBALS['memCache']['whitelist_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (whitelist_clamav.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['whitelist_clamav.cvd'],$md5.":".$str_len.":"));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":".$str_len.":",$GLOBALS['memCache']['whitelist_clamav.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$whitelist[$xsig[0]]=true;
					$xsig="";
					}
				}
			$xmatches="";
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['whitelist_custom'])
		{
		if(!isset($GLOBALS['memCache']['whitelist_custom.cvd']))$GLOBALS['memCache']['whitelist_custom.cvd']=@implode_md(file($GLOBALS['vault']."whitelist_custom.cvd"));
		if(!$GLOBALS['memCache']['whitelist_custom.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (whitelist_custom.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['whitelist_custom.cvd'],$md5.":".$str_len.":"));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":".$str_len.":",$GLOBALS['memCache']['whitelist_custom.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$whitelist[$xsig[0]]=true;
					$xsig="";
					}
				}
			$xmatches="";
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['whitelist_mussel'])
		{
		if(!isset($GLOBALS['memCache']['whitelist_mussel.cvd']))$GLOBALS['memCache']['whitelist_mussel.cvd']=@implode_md(file($GLOBALS['vault']."whitelist_mussel.cvd"));
		if(!$GLOBALS['memCache']['whitelist_mussel.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (whitelist_mussel.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['whitelist_mussel.cvd'],$md5.":".$str_len.":"));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":".$str_len.":",$GLOBALS['memCache']['whitelist_mussel.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$whitelist[$xsig[0]]=true;
					$xsig="";
					}
				}
			$xmatches="";
			}
		}
	$str_norm=@bin2hex(prescan_normalise($str,false,$decode_or_not));
	$str_norm_len=strlen($str_norm);
	if($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$str_norm_len>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048))
		{
		$str_norm_len=$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048;
		$str_norm=substr($str_norm,0,$str_norm_len);
		}
	$str_xmlxdp=$str_xmlxdp_norm=false;
	$str_xmlxdp_len=$str_xmlxdp_norm_len=0;
	if($decode_or_not)if(preg_match("/3c6368756e6b3e.{2,4000}3c2f6368756e6b3e/i",$str_norm))$str_xmlxdp=@prescan_xmlxdp($str,$md5,$pdf_magic);
	if($str_xmlxdp)
		{
		$str_xmlxdp=@bin2hex($str_xmlxdp);
		$str_xmlxdp_norm=@bin2hex(prescan_normalise($str_xmlxdp,false,$decode_or_not));
		$str_xmlxdp_len=strlen($str_xmlxdp);
		$str_xmlxdp_norm_len=strlen($str_xmlxdp_norm);
		}
	if($GLOBALS['MusselConfig']['signatures']['md5_clamav'])
		{
		if(!isset($GLOBALS['memCache']['md5_clamav.cvd']))$GLOBALS['memCache']['md5_clamav.cvd']=@implode_md(file($GLOBALS['vault']."md5_clamav.cvd"));
		if(!$GLOBALS['memCache']['md5_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (md5_clamav.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_clamav.cvd'],$md5.":".$str_len.":"))
				{
				$xsig=substraf($GLOBALS['memCache']['md5_clamav.cvd'],$md5.":".$str_len.":");
				if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
					{
					$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
					if($fm)if(!$xskd)
						{
						$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						$xskd=true;
						}
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
					}
				if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))if(is_array($GLOBALS['memCache']['xmlxdp'][$md5]))
					{
					$c=count($GLOBALS['memCache']['xmlxdp'][$md5]);
					for($i=0;$i<$c;$i++)
						{
						$xsig=substraf($GLOBALS['memCache']['md5_clamav.cvd'],$GLOBALS['memCache']['xmlxdp'][$md5][$i]);
						if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
							{
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$GLOBALS['memCache']['xmlxdp'][$md5][$i].$ofn." (XMLXDP CHUNK #".$i.")".$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
							}
						}
					}
				$xsig="";
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['md5_custom'])
		{
		if(!isset($GLOBALS['memCache']['md5_custom.cvd']))$GLOBALS['memCache']['md5_custom.cvd']=@implode_md(file($GLOBALS['vault']."md5_custom.cvd"));
		if(!$GLOBALS['memCache']['md5_custom.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (md5_custom.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_custom.cvd'],$md5.":".$str_len.":"))
				{
				$xsig=substraf($GLOBALS['memCache']['md5_custom.cvd'],$md5.":".$str_len.":");
				if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
					{
					$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
					if($fm)if(!$xskd)
						{
						$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						$xskd=true;
						}
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
					}
				if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))if(is_array($GLOBALS['memCache']['xmlxdp'][$md5]))
					{
					$c=count($GLOBALS['memCache']['xmlxdp'][$md5]);
					for($i=0;$i<$c;$i++)
						{
						$xsig=substraf($GLOBALS['memCache']['md5_custom.cvd'],$GLOBALS['memCache']['xmlxdp'][$md5][$i]);
						if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
							{
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$GLOBALS['memCache']['xmlxdp'][$md5][$i].$ofn." (XMLXDP CHUNK #".$i.")".$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
							}
						}
					}
				$xsig="";
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['md5_mussel'])
		{
		if(!isset($GLOBALS['memCache']['md5_mussel.cvd']))$GLOBALS['memCache']['md5_mussel.cvd']=@implode_md(file($GLOBALS['vault']."md5_mussel.cvd"));
		if(!$GLOBALS['memCache']['md5_mussel.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (md5_mussel.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_mussel.cvd'],$md5.":".$str_len.":"))
				{
				$xsig=substraf($GLOBALS['memCache']['md5_mussel.cvd'],$md5.":".$str_len.":");
				if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
				if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
					{
					$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
					if($fm)if(!$xskd)
						{
						$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						$xskd=true;
						}
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
					}
				if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))if(is_array($GLOBALS['memCache']['xmlxdp'][$md5]))
					{
					$c=count($GLOBALS['memCache']['xmlxdp'][$md5]);
					for($i=0;$i<$c;$i++)
						{
						$xsig=substraf($GLOBALS['memCache']['md5_mussel.cvd'],$GLOBALS['memCache']['xmlxdp'][$md5][$i]);
						if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
							{
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$GLOBALS['memCache']['xmlxdp'][$md5][$i].$ofn." (XMLXDP CHUNK #".$i.")".$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
							}
						}
					}
				$xsig="";
				}
			}
		}
	if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))unset($GLOBALS['memCache']['xmlxdp'][$md5]);
	$is_html=false;
	if(!isset($whitelist['HTML'])&&($GLOBALS['MusselConfig']['signatures']['html_clamav']||$GLOBALS['MusselConfig']['signatures']['html_custom']||$GLOBALS['MusselConfig']['signatures']['html_mussel']))
		{
		$chkmagic=false;
		if(!$chkmagic)if(substr_count($str_norm,"3c21646f6374797065")||substr_count($str_xmlxdp_norm,"3c21646f6374797065"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c6120")||substr_count($str_xmlxdp_norm,"3c6120"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c626f6479")||substr_count($str_xmlxdp_norm,"3c626f6479"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c68656164")||substr_count($str_xmlxdp_norm,"3c68656164"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c68746d6c")||substr_count($str_xmlxdp_norm,"3c68746d6c"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c696672616d65")||substr_count($str_xmlxdp_norm,"3c696672616d65"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c696d67")||substr_count($str_xmlxdp_norm,"3c696d67"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c6f626a656374")||substr_count($str_xmlxdp_norm,"3c6f626a656374"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c736372697074")||substr_count($str_xmlxdp_norm,"3c736372697074"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c7461626c65")||substr_count($str_xmlxdp_norm,"3c7461626c65"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c7469746c65")||substr_count($str_xmlxdp_norm,"3c7469746c65"))$chkmagic=true;
		if($chkmagic)
			{
			$is_html=true;
			$str_html=@bin2hex(prescan_normalise($str,true,$decode_or_not));
			$str_html_len=strlen($str_html);
			if($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$str_html_len>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048))
				{
				$str_html_len=$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048;
				$str_html=substr($str_html,0,$str_html_len);
				}
			$str_xmlxdp_html=false;
			$str_xmlxdp_html_len=0;
			if($str_xmlxdp)
				{
				$str_xmlxdp_html=@bin2hex(prescan_normalise(prescan_xmlxdp($str,false,$pdf_magic),true,$decode_or_not));
				$str_xmlxdp_html_len=strlen($str_xmlxdp_html);
				}
			if($GLOBALS['MusselConfig']['signatures']['html_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_clamav_standard.cvd']))$GLOBALS['memCache']['html_clamav_standard.cvd']=@file($GLOBALS['vault']."html_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['html_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['html_clamav_standard.map']))$GLOBALS['memCache']['html_clamav_standard.map']=@file($GLOBALS['vault']."html_clamav_standard.map");
					if(!$GLOBALS['memCache']['html_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (html_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (html_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						if(substr($GLOBALS['memCache']['html_clamav_standard.map'][$i],0,1)==">")
							{
							$mapcon=explode(">",$GLOBALS['memCache']['html_clamav_standard.map'][$i],4);
							$mapcon[3]=($mapcon[3]*-1)*-1;
							if($mapcon[1]=="FN")
								{
								if(!preg_match("/".$mapcon[2]."/i",$ofn))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FS-MIN")
								{
								if($str_len<$mapcon[2])
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FS-MAX")
								{
								if($str_len>$mapcon[2])
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FD")
								{
								if(!substr_count($str_hex,$mapcon[2]))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FD-RX")
								{
								if(!preg_match("/".$mapcon[2]."/i",$str_hex))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if(substr($mapcon[1],0,1)=="\$")
								{
								$vf=substr($mapcon[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$mapcon[2])
										{
										if($mapcon[3]<=$i)break;
										$i=$mapcon[3]-1;
										}
									continue;
									}
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							else if(substr($mapcon[1],0,2)=="!\$")
								{
								$vf=substr($mapcon[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$mapcon[2])
										{
										if($mapcon[3]<=$i)break;
										$i=$mapcon[3]-1;
										}
									continue;
									}
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						$mapcon=false;
						$map=explode(":",$GLOBALS['memCache']['html_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_html,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['html_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_html_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_html;
										$this_xmlxdp=$str_xmlxdp_html;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$this_xmlxdp="\x01".$this_xmlxdp;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")
											{
											$this_str=substr($this_str,$xstrf*2);
											$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
											}
										if($xstrt!="*")
											{
											$this_str=substr($this_str,0,$xstrt*2);
											$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
											}
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
											if($xsigc>1)
												{
												if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
												if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
												}
											}
										$this_xmlxdp=$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_clamav_regex.cvd']))$GLOBALS['memCache']['html_clamav_regex.cvd']=@file($GLOBALS['vault']."html_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['html_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['html_clamav_regex.map']))$GLOBALS['memCache']['html_clamav_regex.map']=@file($GLOBALS['vault']."html_clamav_regex.map");
					if(!$GLOBALS['memCache']['html_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (html_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (html_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						if(substr($GLOBALS['memCache']['html_clamav_regex.map'][$i],0,1)==">")
							{
							$mapcon=explode(">",$GLOBALS['memCache']['html_clamav_regex.map'][$i],4);
							$mapcon[3]=($mapcon[3]*-1)*-1;
							if($mapcon[1]=="FN")
								{
								if(!preg_match("/".$mapcon[2]."/i",$ofn))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FS-MIN")
								{
								if($str_len<$mapcon[2])
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FS-MAX")
								{
								if($str_len>$mapcon[2])
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FD")
								{
								if(!substr_count($str_hex,$mapcon[2]))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if($mapcon[1]=="FD-RX")
								{
								if(!preg_match("/".$mapcon[2]."/i",$str_hex))
									{
									if($mapcon[3]<=$i)break;
									$i=$mapcon[3]-1;
									}
								}
							else if(substr($mapcon[1],0,1)=="\$")
								{
								$vf=substr($mapcon[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$mapcon[2])
										{
										if($mapcon[3]<=$i)break;
										$i=$mapcon[3]-1;
										}
									continue;
									}
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							else if(substr($mapcon[1],0,2)=="!\$")
								{
								$vf=substr($mapcon[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$mapcon[2])
										{
										if($mapcon[3]<=$i)break;
										$i=$mapcon[3]-1;
										}
									continue;
									}
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						$mapcon=false;
						$map=explode(":",$GLOBALS['memCache']['html_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_html,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['html_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_html)&&!preg_match("/".$xsig."/i",$str_xmlxdp_html))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_html)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_html))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['html_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_custom_standard.cvd']))$GLOBALS['memCache']['html_custom_standard.cvd']=@file($GLOBALS['vault']."html_custom_standard.cvd");
					if(!$GLOBALS['memCache']['html_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['html_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_html_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_html;
								$this_xmlxdp=$str_xmlxdp_html;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_xmlxdp="\x01".$this_xmlxdp;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
										}
									}
								$this_xmlxdp=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_custom_regex.cvd']))$GLOBALS['memCache']['html_custom_regex.cvd']=@file($GLOBALS['vault']."html_custom_regex.cvd");
					if(!$GLOBALS['memCache']['html_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['html_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_html)&&!preg_match("/".$xsig."/i",$str_xmlxdp_html))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_html)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_html))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['html_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_mussel_standard.cvd']))$GLOBALS['memCache']['html_mussel_standard.cvd']=@file($GLOBALS['vault']."html_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['html_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['html_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_html_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_html;
								$this_xmlxdp=$str_xmlxdp_html;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_xmlxdp="\x01".$this_xmlxdp;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
										}
									}
								$this_xmlxdp=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['html_mussel_regex.cvd']))$GLOBALS['memCache']['html_mussel_regex.cvd']=@file($GLOBALS['vault']."html_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['html_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (html_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['html_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['html_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_html)&&!preg_match("/".$xsig."/i",$str_xmlxdp_html))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_html)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_html))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_html,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_html,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_html,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			unset($str_html_len,$str_html,$str_xmlxdp_html_len,$str_xmlxdp_html);
			}
		}
	$str_hex=@bin2hex($str);
	$str_hex_len=strlen($str_hex);
	if($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$str_hex_len>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048))
		{
		$str_hex_len=$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048;
		$str_hex=substr($str_hex,0,$str_hex_len);
		}
	$infectable=true;
	$asciiable=($infectable&&strlen($str_norm));
	$is_pe=false;
	$NumOfSections=0;
	if($GLOBALS['MusselConfig']['signatures']['pe_clamav']||$GLOBALS['MusselConfig']['signatures']['pe_custom']||$GLOBALS['MusselConfig']['signatures']['pe_mussel']||$GLOBALS['MusselConfig']['attack_specific']['corrupted_exe'])
		{
		if(substr($str,0,2)==="MZ")
			{
			$PEArr=array();
			$PEArr['Offset']=@unpack("S",substr($str,60,4));
			$PEArr['Offset']=$PEArr['Offset'][1];
			while(true)
				{
				$PEArr['DoScan']=true;
				if($PEArr['Offset']<1||$PEArr['Offset']>16384||$PEArr['Offset']>$str_len)
					{
					$PEArr['DoScan']=false;
					break;
					}
				$PEArr['Magic']=@substr($str,$PEArr['Offset'],2);
				if($PEArr['Magic']!=="PE")
					{
					$PEArr['DoScan']=false;
					break;
					}
				$PEArr['Proc']=@unpack("S",substr($str,$PEArr['Offset']+4,2));
				$PEArr['Proc']=$PEArr['Proc'][1];
				if($PEArr['Proc']!=0x14c&&$PEArr['Proc']!=0x8664)
					{
					$PEArr['DoScan']=false;
					break;
					}
				$PEArr['NumOfSections']=@unpack("S",substr($str,$PEArr['Offset']+6,2));
				$NumOfSections=$PEArr['NumOfSections']=$PEArr['NumOfSections'][1];
				$CoExMeta.="PE_Offset:".$PEArr['Offset'].";PE_Proc:".$PEArr['Proc'].";NumOfSections:".$PEArr['NumOfSections'].";";
				if($PEArr['NumOfSections']<1||$PEArr['NumOfSections']>40)$PEArr['DoScan']=false;
				break;
				}
			if(!$PEArr['DoScan']&&$GLOBALS['MusselConfig']['attack_specific']['corrupted_exe'])
				{
				$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$GLOBALS['MusselConfig']['lang']['corrupted']." PE!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$GLOBALS['MusselConfig']['lang']['corrupted']." PE (".$ofn.")! ";
				}
			if($PEArr['DoScan']&&($GLOBALS['MusselConfig']['signatures']['pe_clamav']||$GLOBALS['MusselConfig']['signatures']['pe_custom']||$GLOBALS['MusselConfig']['signatures']['pe_mussel']))
				{
				$is_pe=true;
				$asciiable=false;
				$PEArr['OptHdrSize']=@unpack("S",substr($str,$PEArr['Offset']+20,2));
				$PEArr['OptHdrSize']=$PEArr['OptHdrSize'][1];
				$PEArr['Reconstruction']="";
				for($PEArr['k']=0;$PEArr['k']<$PEArr['NumOfSections'];$PEArr['k']++)
					{
					$PEArr['SectionHead']=substr($str,$PEArr['Offset']+24+$PEArr['OptHdrSize']+($PEArr['k']*40),$PEArr['NumOfSections']*40);
					$PEArr['SectionName']=str_ireplace("\x00","",substr($PEArr['SectionHead'],0,8));
					$PEArr['VirtualSize']=@unpack("S",substr($PEArr['SectionHead'],8,4));
					$PEArr['VirtualSize']=$PEArr['VirtualSize'][1];
					$PEArr['VirtualAddress']=@unpack("S",substr($PEArr['SectionHead'],12,4));
					$PEArr['VirtualAddress']=$PEArr['VirtualAddress'][1];
					$PEArr['SizeOfRawData']=@unpack("S",substr($PEArr['SectionHead'],16,4));
					$PEArr['SizeOfRawData']=$PEArr['SizeOfRawData'][1];
					$PEArr['PointerToRawData']=@unpack("S",substr($PEArr['SectionHead'],20,4));
					$PEArr['PointerToRawData']=$PEArr['PointerToRawData'][1];
					$PEArr['SectionData']=@substr($str,$PEArr['PointerToRawData'],$PEArr['SizeOfRawData']);
					$PEArr['MD5']=md5($PEArr['SectionData']);
					$PEArr['Reconstruction'].=$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":".$ofn."-".$PEArr['SectionName'].$GLOBALS['linebreak'];
					$CoExMeta.="SectionName:".$PEArr['SectionName'].";VirtualSize:".$PEArr['VirtualSize'].";VirtualAddress:".$PEArr['VirtualAddress'].";SizeOfRawData:".$PEArr['SizeOfRawData'].";MD5:".$PEArr['MD5'].";";
					if($GLOBALS['MusselConfig']['signatures']['pe_clamav'])
						{
						if(!isset($GLOBALS['memCache']['pe_clamav.cvd']))$GLOBALS['memCache']['pe_clamav.cvd']=@implode_md(file($GLOBALS['vault']."pe_clamav.cvd"));
						if(!$GLOBALS['memCache']['pe_clamav.cvd'])
							{
							if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pe_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						else
							{
							if(substr_count($GLOBALS['memCache']['pe_clamav.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":"))
								{
								$xsig=substraf($GLOBALS['memCache']['pe_clamav.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":");
								if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
								if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
									{
									$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
									if($fm)if(!$xskd)
										{
										$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										$xskd=true;
										}
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
									}
								$xsig="";
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['pe_custom'])
						{
						if(!isset($GLOBALS['memCache']['pe_custom.cvd']))$GLOBALS['memCache']['pe_custom.cvd']=@implode_md(file($GLOBALS['vault']."pe_custom.cvd"));
						if(!$GLOBALS['memCache']['pe_custom.cvd'])
							{
							if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pe_custom.cvd)!".$GLOBALS['linebreak'];
							}
						else
							{
							if(substr_count($GLOBALS['memCache']['pe_custom.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":"))
								{
								$xsig=substraf($GLOBALS['memCache']['pe_custom.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":");
								if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
								if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
									{
									$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
									if($fm)if(!$xskd)
										{
										$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										$xskd=true;
										}
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
									}
								$xsig="";
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['pe_mussel'])
						{
						if(!isset($GLOBALS['memCache']['pe_mussel.cvd']))$GLOBALS['memCache']['pe_mussel.cvd']=@implode_md(file($GLOBALS['vault']."pe_mussel.cvd"));
						if(!$GLOBALS['memCache']['pe_mussel.cvd'])
							{
							if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pe_mussel.cvd)!".$GLOBALS['linebreak'];
							}
						else
							{
							if(substr_count($GLOBALS['memCache']['pe_mussel.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":"))
								{
								$xsig=substraf($GLOBALS['memCache']['pe_mussel.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5'].":");
								if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
								if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
									{
									$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($xsig)."!".$GLOBALS['linebreak'];
									if($fm)if(!$xskd)
										{
										$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										$xskd=true;
										}
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
									}
								$xsig="";
								}
							}
						}
					}
				if($PEArr['Reconstruction'])$GLOBALS['xpe'].=$PEArr['Reconstruction'];
				}
			$PEArr=false;
			}
		}
	if(!isset($whitelist['EXE'])&&($GLOBALS['MusselConfig']['signatures']['exe_clamav']||$GLOBALS['MusselConfig']['signatures']['exe_custom']||$GLOBALS['MusselConfig']['signatures']['exe_mussel']))
		{
		if(substr_count(",acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,",",".$xt.",")>0||substr($str,0,2)==="MZ")
			{
			if($GLOBALS['MusselConfig']['signatures']['exe_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_clamav_standard.cvd']))$GLOBALS['memCache']['exe_clamav_standard.cvd']=@file($GLOBALS['vault']."exe_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['exe_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['exe_clamav_standard.map']))$GLOBALS['memCache']['exe_clamav_standard.map']=@file($GLOBALS['vault']."exe_clamav_standard.map");
					if(!$GLOBALS['memCache']['exe_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (exe_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (exe_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['exe_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['exe_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
										if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
											if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											}
										$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_clamav_regex.cvd']))$GLOBALS['memCache']['exe_clamav_regex.cvd']=@file($GLOBALS['vault']."exe_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['exe_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['exe_clamav_regex.map']))$GLOBALS['memCache']['exe_clamav_regex.map']=@file($GLOBALS['vault']."exe_clamav_regex.map");
					if(!$GLOBALS['memCache']['exe_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (exe_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (exe_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['exe_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['exe_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['exe_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_custom_standard.cvd']))$GLOBALS['memCache']['exe_custom_standard.cvd']=@file($GLOBALS['vault']."exe_custom_standard.cvd");
					if(!$GLOBALS['memCache']['exe_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_custom_regex.cvd']))$GLOBALS['memCache']['exe_custom_regex.cvd']=@file($GLOBALS['vault']."exe_custom_regex.cvd");
					if(!$GLOBALS['memCache']['exe_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['exe_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_mussel_standard.cvd']))$GLOBALS['memCache']['exe_mussel_standard.cvd']=@file($GLOBALS['vault']."exe_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['exe_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['exe_mussel_regex.cvd']))$GLOBALS['memCache']['exe_mussel_regex.cvd']=@file($GLOBALS['vault']."exe_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['exe_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (exe_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	$is_elf=false;
	if(!isset($whitelist['ELF'])&&($GLOBALS['MusselConfig']['signatures']['elf_clamav']||$GLOBALS['MusselConfig']['signatures']['elf_custom']||$GLOBALS['MusselConfig']['signatures']['elf_mussel']))
		{
		if($xt=="elf"||substr($str_hex,0,8)==="7f454c46")
			{
			$is_elf=true;
			if($GLOBALS['MusselConfig']['signatures']['elf_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_clamav_standard.cvd']))$GLOBALS['memCache']['elf_clamav_standard.cvd']=@file($GLOBALS['vault']."elf_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['elf_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['elf_clamav_standard.map']))$GLOBALS['memCache']['elf_clamav_standard.map']=@file($GLOBALS['vault']."elf_clamav_standard.map");
					if(!$GLOBALS['memCache']['elf_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (elf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (elf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['elf_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['elf_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
										if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
											if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											}
										$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_clamav_regex.cvd']))$GLOBALS['memCache']['elf_clamav_regex.cvd']=@file($GLOBALS['vault']."elf_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['elf_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['elf_clamav_regex.map']))$GLOBALS['memCache']['elf_clamav_regex.map']=@file($GLOBALS['vault']."elf_clamav_regex.map");
					if(!$GLOBALS['memCache']['elf_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (elf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (elf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['elf_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['elf_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['elf_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_custom_standard.cvd']))$GLOBALS['memCache']['elf_custom_standard.cvd']=@file($GLOBALS['vault']."elf_custom_standard.cvd");
					if(!$GLOBALS['memCache']['elf_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_custom_regex.cvd']))$GLOBALS['memCache']['elf_custom_regex.cvd']=@file($GLOBALS['vault']."elf_custom_regex.cvd");
					if(!$GLOBALS['memCache']['elf_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['elf_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_mussel_standard.cvd']))$GLOBALS['memCache']['elf_mussel_standard.cvd']=@file($GLOBALS['vault']."elf_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['elf_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['elf_mussel_regex.cvd']))$GLOBALS['memCache']['elf_mussel_regex.cvd']=@file($GLOBALS['vault']."elf_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['elf_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (elf_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	$is_macho=false;
	if(!isset($whitelist['OSX'])&&($GLOBALS['MusselConfig']['signatures']['macho_clamav']||$GLOBALS['MusselConfig']['signatures']['macho_custom']||$GLOBALS['MusselConfig']['signatures']['macho_mussel']))
		{
		if(substr_count(",cafebabe,cafed00d,cefaedfe,cffaedfe,feedface,feedfacf,",",".substr($str_hex,0,8).",")>0)
			{
			$is_macho=true;
			if($GLOBALS['MusselConfig']['signatures']['macho_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_clamav_standard.cvd']))$GLOBALS['memCache']['macho_clamav_standard.cvd']=@file($GLOBALS['vault']."macho_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['macho_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['macho_clamav_standard.map']))$GLOBALS['memCache']['macho_clamav_standard.map']=@file($GLOBALS['vault']."macho_clamav_standard.map");
					if(!$GLOBALS['memCache']['macho_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (macho_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (macho_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['macho_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['macho_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
										if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
											if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											}
										$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_clamav_regex.cvd']))$GLOBALS['memCache']['macho_clamav_regex.cvd']=@file($GLOBALS['vault']."macho_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['macho_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['macho_clamav_regex.map']))$GLOBALS['memCache']['macho_clamav_regex.map']=@file($GLOBALS['vault']."macho_clamav_regex.map");
					if(!$GLOBALS['memCache']['macho_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (macho_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (macho_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['macho_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['macho_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['macho_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_custom_standard.cvd']))$GLOBALS['memCache']['macho_custom_standard.cvd']=@file($GLOBALS['vault']."macho_custom_standard.cvd");
					if(!$GLOBALS['memCache']['macho_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_custom_regex.cvd']))$GLOBALS['memCache']['macho_custom_regex.cvd']=@file($GLOBALS['vault']."macho_custom_regex.cvd");
					if(!$GLOBALS['memCache']['macho_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['macho_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_mussel_standard.cvd']))$GLOBALS['memCache']['macho_mussel_standard.cvd']=@file($GLOBALS['vault']."macho_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['macho_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['macho_mussel_regex.cvd']))$GLOBALS['memCache']['macho_mussel_regex.cvd']=@file($GLOBALS['vault']."macho_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['macho_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (macho_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	$is_not_html=false;
	if(!$is_html)if($is_macho||$is_elf||$is_pe)$is_not_html=true;
	$is_not_php=false;
	if(!(substr_count(",php*,",",".$xts.",")>0||substr_count(",php*,",",".$gzxts.",")>0)&&!substr_count($str_norm,"3c3f706870"))if($is_pe)$is_not_php=true;
	if(!isset($whitelist['General'])&&$GLOBALS['MusselConfig']['signatures']['general_clamav'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_clamav_standard.cvd']))$GLOBALS['memCache']['general_clamav_standard.cvd']=@file($GLOBALS['vault']."general_clamav_standard.cvd");
			if(!$GLOBALS['memCache']['general_clamav_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_clamav_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['general_clamav_standard.map']))$GLOBALS['memCache']['general_clamav_standard.map']=@file($GLOBALS['vault']."general_clamav_standard.map");
			if(!$GLOBALS['memCache']['general_clamav_standard.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (general_clamav_standard.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_clamav_standard.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (general_clamav_standard.map)!".$GLOBALS['linebreak'];
				break;
				}
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				if(substr($GLOBALS['memCache']['general_clamav_standard.map'][$i],0,1)==">")
					{
					$mapcon=explode(">",$GLOBALS['memCache']['general_clamav_standard.map'][$i],4);
					$mapcon[3]=($mapcon[3]*-1)*-1;
					if($mapcon[1]=="FN")
						{
						if(!preg_match("/".$mapcon[2]."/i",$ofn))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MIN")
						{
						if($str_len<$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MAX")
						{
						if($str_len>$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD")
						{
						if(!substr_count($str_hex,$mapcon[2]))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD-RX")
						{
						if(!preg_match("/".$mapcon[2]."/i",$str_hex))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if(substr($mapcon[1],0,1)=="\$")
						{
						$vf=substr($mapcon[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					else if(substr($mapcon[1],0,2)=="!\$")
						{
						$vf=substr($mapcon[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					continue;
					}
				$mapcon=false;
				$map=explode(":",$GLOBALS['memCache']['general_clamav_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['general_clamav_standard.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							$vnlc=strtolower($vn);
							if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
							if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								$this_xmlxdp=$str_xmlxdp;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_xmlxdp="\x01".$this_xmlxdp;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
										}
									}
								$this_xmlxdp=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_clamav_regex.cvd']))$GLOBALS['memCache']['general_clamav_regex.cvd']=@file($GLOBALS['vault']."general_clamav_regex.cvd");
			if(!$GLOBALS['memCache']['general_clamav_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_clamav_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['general_clamav_regex.map']))$GLOBALS['memCache']['general_clamav_regex.map']=@file($GLOBALS['vault']."general_clamav_regex.map");
			if(!$GLOBALS['memCache']['general_clamav_regex.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (general_clamav_regex.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_clamav_regex.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (general_clamav_regex.map)!".$GLOBALS['linebreak'];
				break;
				}
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				if(substr($GLOBALS['memCache']['general_clamav_regex.map'][$i],0,1)==">")
					{
					$mapcon=explode(">",$GLOBALS['memCache']['general_clamav_regex.map'][$i],4);
					$mapcon[3]=($mapcon[3]*-1)*-1;
					if($mapcon[1]=="FN")
						{
						if(!preg_match("/".$mapcon[2]."/i",$ofn))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MIN")
						{
						if($str_len<$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MAX")
						{
						if($str_len>$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD")
						{
						if(!substr_count($str_hex,$mapcon[2]))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD-RX")
						{
						if(!preg_match("/".$mapcon[2]."/i",$str_hex))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if(substr($mapcon[1],0,1)=="\$")
						{
						$vf=substr($mapcon[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					else if(substr($mapcon[1],0,2)=="!\$")
						{
						$vf=substr($mapcon[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					continue;
					}
				$mapcon=false;
				$map=explode(":",$GLOBALS['memCache']['general_clamav_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['general_clamav_regex.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							$vnlc=strtolower($vn);
							if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
							if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					}
				}
			break;
			}
		}
	if(!isset($whitelist['General'])&&$GLOBALS['MusselConfig']['signatures']['general_custom'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_custom_standard.cvd']))$GLOBALS['memCache']['general_custom_standard.cvd']=@file($GLOBALS['vault']."general_custom_standard.cvd");
			if(!$GLOBALS['memCache']['general_custom_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_custom_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_standard.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if($str_hex_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						$this_str=$str_hex;
						$this_xmlxdp=$str_xmlxdp;
						if($xstrf=="A")
							{
							$this_str="\x01".$this_str;
							$this_xmlxdp="\x01".$this_xmlxdp;
							$xsig[0]="\x01".$xsig[0];
							}
						else if($xstrf!="*")
							{
							$this_str=substr($this_str,$xstrf*2);
							$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							}
						if($xstrt!="*")
							{
							$this_str=substr($this_str,0,$xstrt*2);
							$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							}
						for($xsigi=0;$xsigi<$xsigc;$xsigi++)
							{
							if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
							if($xsigc>1)
								{
								if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
								if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							}
						$this_xmlxdp=$this_str=false;
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_custom_regex.cvd']))$GLOBALS['memCache']['general_custom_regex.cvd']=@file($GLOBALS['vault']."general_custom_regex.cvd");
			if(!$GLOBALS['memCache']['general_custom_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_custom_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		}
	if(!isset($whitelist['General'])&&$GLOBALS['MusselConfig']['signatures']['general_mussel'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_mussel_standard.cvd']))$GLOBALS['memCache']['general_mussel_standard.cvd']=@file($GLOBALS['vault']."general_mussel_standard.cvd");
			if(!$GLOBALS['memCache']['general_mussel_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_mussel_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_mussel_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_mussel_standard.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if($str_hex_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						$this_str=$str_hex;
						$this_xmlxdp=$str_xmlxdp;
						if($xstrf=="A")
							{
							$this_str="\x01".$this_str;
							$this_xmlxdp="\x01".$this_xmlxdp;
							$xsig[0]="\x01".$xsig[0];
							}
						else if($xstrf!="*")
							{
							$this_str=substr($this_str,$xstrf*2);
							$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							}
						if($xstrt!="*")
							{
							$this_str=substr($this_str,0,$xstrt*2);
							$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							}
						for($xsigi=0;$xsigi<$xsigc;$xsigi++)
							{
							if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
							if($xsigc>1)
								{
								if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
								if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							}
						$this_xmlxdp=$this_str=false;
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['general_mussel_regex.cvd']))$GLOBALS['memCache']['general_mussel_regex.cvd']=@file($GLOBALS['vault']."general_mussel_regex.cvd");
			if(!$GLOBALS['memCache']['general_mussel_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (general_mussel_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_mussel_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_mussel_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		}
	if(!isset($whitelist['ASCII'])&&$asciiable&&$GLOBALS['MusselConfig']['signatures']['ascii_clamav'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_clamav_standard.cvd']))$GLOBALS['memCache']['ascii_clamav_standard.cvd']=@file($GLOBALS['vault']."ascii_clamav_standard.cvd");
			if(!$GLOBALS['memCache']['ascii_clamav_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_clamav_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['ascii_clamav_standard.map']))$GLOBALS['memCache']['ascii_clamav_standard.map']=@file($GLOBALS['vault']."ascii_clamav_standard.map");
			if(!$GLOBALS['memCache']['ascii_clamav_standard.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (ascii_clamav_standard.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_clamav_standard.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (ascii_clamav_standard.map)!".$GLOBALS['linebreak'];
				break;
				}
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				if(substr($GLOBALS['memCache']['ascii_clamav_standard.map'][$i],0,1)==">")
					{
					$mapcon=explode(">",$GLOBALS['memCache']['ascii_clamav_standard.map'][$i],4);
					$mapcon[3]=($mapcon[3]*-1)*-1;
					if($mapcon[1]=="FN")
						{
						if(!preg_match("/".$mapcon[2]."/i",$ofn))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MIN")
						{
						if($str_len<$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MAX")
						{
						if($str_len>$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD")
						{
						if(!substr_count($str_hex,$mapcon[2]))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD-RX")
						{
						if(!preg_match("/".$mapcon[2]."/i",$str_hex))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if(substr($mapcon[1],0,1)=="\$")
						{
						$vf=substr($mapcon[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					else if(substr($mapcon[1],0,2)=="!\$")
						{
						$vf=substr($mapcon[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					continue;
					}
				$mapcon=false;
				$map=explode(":",$GLOBALS['memCache']['ascii_clamav_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_norm,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['ascii_clamav_standard.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							$vnlc=strtolower($vn);
							if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
							if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
							if($str_norm_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_norm;
								$this_xmlxdp=$str_xmlxdp_norm;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_xmlxdp="\x01".$this_xmlxdp;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
										}
									}
								$this_xmlxdp=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_clamav_regex.cvd']))$GLOBALS['memCache']['ascii_clamav_regex.cvd']=@file($GLOBALS['vault']."ascii_clamav_regex.cvd");
			if(!$GLOBALS['memCache']['ascii_clamav_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_clamav_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['ascii_clamav_regex.map']))$GLOBALS['memCache']['ascii_clamav_regex.map']=@file($GLOBALS['vault']."ascii_clamav_regex.map");
			if(!$GLOBALS['memCache']['ascii_clamav_regex.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (ascii_clamav_regex.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_clamav_regex.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (ascii_clamav_regex.map)!".$GLOBALS['linebreak'];
				break;
				}
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				if(substr($GLOBALS['memCache']['ascii_clamav_regex.map'][$i],0,1)==">")
					{
					$mapcon=explode(">",$GLOBALS['memCache']['ascii_clamav_regex.map'][$i],4);
					$mapcon[3]=($mapcon[3]*-1)*-1;
					if($mapcon[1]=="FN")
						{
						if(!preg_match("/".$mapcon[2]."/i",$ofn))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MIN")
						{
						if($str_len<$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FS-MAX")
						{
						if($str_len>$mapcon[2])
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD")
						{
						if(!substr_count($str_hex,$mapcon[2]))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if($mapcon[1]=="FD-RX")
						{
						if(!preg_match("/".$mapcon[2]."/i",$str_hex))
							{
							if($mapcon[3]<=$i)break;
							$i=$mapcon[3]-1;
							}
						}
					else if(substr($mapcon[1],0,1)=="\$")
						{
						$vf=substr($mapcon[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					else if(substr($mapcon[1],0,2)=="!\$")
						{
						$vf=substr($mapcon[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$mapcon[2])
								{
								if($mapcon[3]<=$i)break;
								$i=$mapcon[3]-1;
								}
							continue;
							}
						if($mapcon[3]<=$i)break;
						$i=$mapcon[3]-1;
						}
					continue;
					}
				$mapcon=false;
				$map=explode(":",$GLOBALS['memCache']['ascii_clamav_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_norm,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['ascii_clamav_regex.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							$vnlc=strtolower($vn);
							if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
							if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_norm)&&!preg_match("/".$xsig."/i",$str_xmlxdp_norm))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_norm)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_norm))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					}
				}
			break;
			}
		}
	if(!isset($whitelist['ASCII'])&&$asciiable&&$GLOBALS['MusselConfig']['signatures']['ascii_custom'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_custom_standard.cvd']))$GLOBALS['memCache']['ascii_custom_standard.cvd']=@file($GLOBALS['vault']."ascii_custom_standard.cvd");
			if(!$GLOBALS['memCache']['ascii_custom_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_custom_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['ascii_custom_standard.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if($str_norm_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						$this_str=$str_norm;
						$this_xmlxdp=$str_xmlxdp_norm;
						if($xstrf=="A")
							{
							$this_str="\x01".$this_str;
							$this_xmlxdp="\x01".$this_xmlxdp;
							$xsig[0]="\x01".$xsig[0];
							}
						else if($xstrf!="*")
							{
							$this_str=substr($this_str,$xstrf*2);
							$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							}
						if($xstrt!="*")
							{
							$this_str=substr($this_str,0,$xstrt*2);
							$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							}
						for($xsigi=0;$xsigi<$xsigc;$xsigi++)
							{
							if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
							if($xsigc>1)
								{
								if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
								if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							}
						$this_xmlxdp=$this_str=false;
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_custom_regex.cvd']))$GLOBALS['memCache']['ascii_custom_regex.cvd']=@file($GLOBALS['vault']."ascii_custom_regex.cvd");
			if(!$GLOBALS['memCache']['ascii_custom_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_custom_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['ascii_custom_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$str_norm)&&!preg_match("/".$xsig."/i",$str_xmlxdp_norm))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$str_norm)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_norm))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		}
	if(!isset($whitelist['ASCII'])&&$asciiable&&$GLOBALS['MusselConfig']['signatures']['ascii_mussel'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_mussel_standard.cvd']))$GLOBALS['memCache']['ascii_mussel_standard.cvd']=@file($GLOBALS['vault']."ascii_mussel_standard.cvd");
			if(!$GLOBALS['memCache']['ascii_mussel_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_mussel_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_mussel_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['ascii_mussel_standard.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if($str_norm_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						$this_str=$str_norm;
						$this_xmlxdp=$str_xmlxdp_norm;
						if($xstrf=="A")
							{
							$this_str="\x01".$this_str;
							$this_xmlxdp="\x01".$this_xmlxdp;
							$xsig[0]="\x01".$xsig[0];
							}
						else if($xstrf!="*")
							{
							$this_str=substr($this_str,$xstrf*2);
							$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							}
						if($xstrt!="*")
							{
							$this_str=substr($this_str,0,$xstrt*2);
							$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							}
						for($xsigi=0;$xsigi<$xsigc;$xsigi++)
							{
							if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
							if($xsigc>1)
								{
								if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
								if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							}
						$this_xmlxdp=$this_str=false;
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['ascii_mussel_regex.cvd']))$GLOBALS['memCache']['ascii_mussel_regex.cvd']=@file($GLOBALS['vault']."ascii_mussel_regex.cvd");
			if(!$GLOBALS['memCache']['ascii_mussel_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ascii_mussel_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['ascii_mussel_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['ascii_mussel_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="FN")
						{
						if(!preg_match("/".$xsig[2]."/i",$ofn))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					else if(substr($xsig[1],0,2)=="!\$")
						{
						$vf=substr($xsig[1],2);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf==$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					$vnlc=strtolower($vn);
					if(substr_count($vnlc,"-php")||substr_count($vnlc,".php"))if($is_not_php)continue;
					if(substr_count($vnlc,"-htm")||substr_count($vnlc,".htm"))if($is_not_html)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$str_norm)&&!preg_match("/".$xsig."/i",$str_xmlxdp_norm))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$str_norm)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp_norm))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp_norm,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
						}
					}
				}
			break;
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_php'])
		{
		if(!(substr_count(",php*,",",".$xts.",")>0||substr_count(",php*,",",".$gzxts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].",",",".$xts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].",",",".$gzxts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].",",",".$gzxt.",")>0))
			{
			if(substr_count($str_norm,"3c3f706870")>0)
				{
				$out.=$lnap."PHP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="PHP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_exe'])
		{
		if(substr_count(",acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,",",".$xt.",")>0)
			{
			if(substr($str,0,2)!=="MZ")
				{
				$out.=$lnap."EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str,0,2)==="MZ")
				{
				$out.=$lnap."EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="elf")
			{
			if(substr($str_hex,0,8)!=="7f454c46")
				{
				$out.=$lnap."ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str_hex,0,8)==="7f454c46")
				{
				$out.=$lnap."ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="lnk")
			{
			if(substr($str_hex,0,16)!=="4c00000001140200")
				{
				$out.=$lnap."LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str_hex,0,16)==="4c00000001140200")
				{
				$out.=$lnap."LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="msi")
			{
			if(substr($str_hex,0,16)!=="d0cf11e0a1b11ae1")
				{
				$out.=$lnap."MSI ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="MSI ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if(!isset($GLOBALS['memCache']['file_is_ole']))$GLOBALS['memCache']['file_is_ole']=false;
	if($GLOBALS['memCache']['file_is_ole'])if(!isset($whitelist['OLE'])&&($GLOBALS['MusselConfig']['signatures']['ole_clamav']||$GLOBALS['MusselConfig']['signatures']['ole_custom']||$GLOBALS['MusselConfig']['signatures']['ole_mussel']))if(!($str_hex_len<1024&&substr_count(",xml,rels,",",".$xt.",")>0))
		{
		if($GLOBALS['MusselConfig']['signatures']['ole_clamav'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_clamav_standard.cvd']))$GLOBALS['memCache']['ole_clamav_standard.cvd']=@file($GLOBALS['vault']."ole_clamav_standard.cvd");
				if(!$GLOBALS['memCache']['ole_clamav_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_clamav_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				if(!isset($GLOBALS['memCache']['ole_clamav_standard.map']))$GLOBALS['memCache']['ole_clamav_standard.map']=@file($GLOBALS['vault']."ole_clamav_standard.map");
				if(!$GLOBALS['memCache']['ole_clamav_standard.map'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (ole_clamav_standard.map)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_clamav_standard.map']);
				if($c<1)
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (ole_clamav_standard.map)!".$GLOBALS['linebreak'];
					break;
					}
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$map=explode(":",$GLOBALS['memCache']['ole_clamav_standard.map'][$i]);
					$map[2]=($map[2]*-1)*-1;
					if(substr_count($str_hex,$map[0])>0)
						{
						for($xind=$map[1];$xind<($map[2]+1);$xind++)
							{
							$xsig=$GLOBALS['memCache']['ole_clamav_standard.cvd'][$xind];
							if(substr_count($xsig,":")>0)
								{
								$vn=@explode(":",$xsig);
								$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
								$xsig=($xsig===false?"":implode("",$xsig));
								$xlen=strlen($xsig);
								if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
								$xstrf=(isset($vn[2]))?$vn[2]:"*";
								$xstrt=(isset($vn[3]))?$vn[3]:"*";
								$vn=$vn[0];
								if($str_hex_len<$xlen)continue;
								if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
									{
									$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
									$xsigc=count($xsig);
									$this_str=$str_hex;
									$this_xmlxdp=$str_xmlxdp;
									if($xstrf=="A")
										{
										$this_str="\x01".$this_str;
										$this_xmlxdp="\x01".$this_xmlxdp;
										$xsig[0]="\x01".$xsig[0];
										}
									else if($xstrf!="*")
										{
										$this_str=substr($this_str,$xstrf*2);
										$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
										}
									if($xstrt!="*")
										{
										$this_str=substr($this_str,0,$xstrt*2);
										$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
										}
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
										if($xsigc>1)
											{
											if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
											}
										}
									$this_xmlxdp=$this_str=false;
									$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
									if($fm)if(!$xskd)
										{
										$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										$xskd=true;
										}
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
									}
								}
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_clamav_regex.cvd']))$GLOBALS['memCache']['ole_clamav_regex.cvd']=@file($GLOBALS['vault']."ole_clamav_regex.cvd");
				if(!$GLOBALS['memCache']['ole_clamav_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_clamav_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				if(!isset($GLOBALS['memCache']['ole_clamav_regex.map']))$GLOBALS['memCache']['ole_clamav_regex.map']=@file($GLOBALS['vault']."ole_clamav_regex.map");
				if(!$GLOBALS['memCache']['ole_clamav_regex.map'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (ole_clamav_regex.map)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_clamav_regex.map']);
				if($c<1)
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (ole_clamav_regex.map)!".$GLOBALS['linebreak'];
					break;
					}
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$map=explode(":",$GLOBALS['memCache']['ole_clamav_regex.map'][$i]);
					$map[2]=($map[2]*-1)*-1;
					if(substr_count($str_hex,$map[0])>0)
						{
						for($xind=$map[1];$xind<($map[2]+1);$xind++)
							{
							$xsig=$GLOBALS['memCache']['ole_clamav_regex.cvd'][$xind];
							if(substr_count($xsig,":")>0)
								{
								$vn=@explode(":",$xsig);
								$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
								$xsig=($xsig===false?"":implode("",$xsig));
								$xlen=strlen($xsig);
								if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
								$xstrf=(isset($vn[2]))?$vn[2]:"*";
								$xstrt=(isset($vn[3]))?$vn[3]:"*";
								$vn=$vn[0];
								if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
									{
									if($xstrf=="*")
										{
										if($xstrt=="*")
											{
											if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
											}
										else
											{
											if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
											}
										}
									else if($xstrf=="A")
										{
										if($xstrt=="*")
											{
											if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
											}
										else
											{
											if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
											}
										}
									else
										{
										if($xstrt=="*")
											{
											if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
											}
										else
											{
											if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
											}
										}
									$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
									if($fm)if(!$xskd)
										{
										$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										$xskd=true;
										}
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
									}
								}
							}
						}
					}
				break;
				}
			}
		if($GLOBALS['MusselConfig']['signatures']['ole_custom'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_custom_standard.cvd']))$GLOBALS['memCache']['ole_custom_standard.cvd']=@file($GLOBALS['vault']."ole_custom_standard.cvd");
				if(!$GLOBALS['memCache']['ole_custom_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_custom_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_custom_standard.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['ole_custom_standard.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if($str_hex_len<$xlen)continue;
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
							$xsigc=count($xsig);
							$this_str=$str_hex;
							$this_xmlxdp=$str_xmlxdp;
							if($xstrf=="A")
								{
								$this_str="\x01".$this_str;
								$this_xmlxdp="\x01".$this_xmlxdp;
								$xsig[0]="\x01".$xsig[0];
								}
							else if($xstrf!="*")
								{
								$this_str=substr($this_str,$xstrf*2);
								$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
								}
							if($xstrt!="*")
								{
								$this_str=substr($this_str,0,$xstrt*2);
								$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
								}
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
								if($xsigc>1)
									{
									if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
									}
								}
							$this_xmlxdp=$this_str=false;
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_custom_regex.cvd']))$GLOBALS['memCache']['ole_custom_regex.cvd']=@file($GLOBALS['vault']."ole_custom_regex.cvd");
				if(!$GLOBALS['memCache']['ole_custom_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_custom_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_custom_regex.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['ole_custom_regex.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							if($xstrf=="*")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else if($xstrf=="A")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
									}
								}
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			}
		if($GLOBALS['MusselConfig']['signatures']['ole_mussel'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_mussel_standard.cvd']))$GLOBALS['memCache']['ole_mussel_standard.cvd']=@file($GLOBALS['vault']."ole_mussel_standard.cvd");
				if(!$GLOBALS['memCache']['ole_mussel_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_mussel_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_mussel_standard.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['ole_mussel_standard.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if($str_hex_len<$xlen)continue;
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
							$xsigc=count($xsig);
							$this_str=$str_hex;
							$this_xmlxdp=$str_xmlxdp;
							if($xstrf=="A")
								{
								$this_str="\x01".$this_str;
								$this_xmlxdp="\x01".$this_xmlxdp;
								$xsig[0]="\x01".$xsig[0];
								}
							else if($xstrf!="*")
								{
								$this_str=substr($this_str,$xstrf*2);
								$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
								}
							if($xstrt!="*")
								{
								$this_str=substr($this_str,0,$xstrt*2);
								$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
								}
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
								if($xsigc>1)
									{
									if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
									}
								}
							$this_xmlxdp=$this_str=false;
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['ole_mussel_regex.cvd']))$GLOBALS['memCache']['ole_mussel_regex.cvd']=@file($GLOBALS['vault']."ole_mussel_regex.cvd");
				if(!$GLOBALS['memCache']['ole_mussel_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (ole_mussel_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['ole_mussel_regex.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['ole_mussel_regex.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							if($xstrf=="*")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else if($xstrf=="A")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
									}
								}
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_archive'])
		{
		if($xts=="zip*")
			{
			if(substr($str,0,2)!=="PK")
				{
				$out.=$lnap."ZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="ZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="rar")
			{
			if(substr($str,0,4)!=="Rar!")
				{
				$out.=$lnap."RAR ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="RAR ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="gz")
			{
			if(substr($str_hex,0,4)!=="1f8b")
				{
				$out.=$lnap."GZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="GZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="bz2")
			{
			if(substr($str_hex,0,6)!=="425a68")
				{
				$out.=$lnap."BZIP2 ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="BZIP2 ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_doc'])
		{
		if(substr_count(",doc,dot,pps,ppt,xla,xls,wiz,",",".$xt.",")>0)
			{
			if(substr($str_hex,0,8)!=="d0cf11e0")
				{
				$out.=$lnap."Office ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Office ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_img'])
		{
		if($xt=="bmp"||$xt=="dib")
			{
			if(substr($str,0,2)!=="BM")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="png")
			{
			if(substr($str_hex,0,8)!=="89504e47")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="jp2")
			{
			if(substr($str_hex,0,16)!=="0000000c6a502020")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="jfi"||$xt=="jfif"||$xt=="jif"||$xt=="jpe"||$xt=="jpeg"||$xt=="jpg")
			{
			if(substr($str_hex,0,6)!=="ffd8ff")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="gif")
			{
			if(substr($str_hex,0,12)!=="474946383761"&&substr($str_hex,0,12)!=="474946383961")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="xcf")
			{
			if(!substr($str,0,8)==="gimp xcf")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="psd"||$xt=="pdd")
			{
			if(!substr($str,0,4)==="8BPS")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)if(!$xskd)
					{
					$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					$xskd=true;
					}
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_pdf'])
		{
		if($xt=="pdf"&&!$pdf_magic)
			{
			$out.=$lnap."PDF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
			if($fm)if(!$xskd)
				{
				$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				$xskd=true;
				}
			if($fm)$GLOBALS['xfm'].="PDF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
			}
		}
	if(!isset($whitelist['Commands'])&&$GLOBALS['MusselConfig']['attack_specific']['general_commands'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['hex_general_commands.csv']))$GLOBALS['memCache']['hex_general_commands.csv']=@explode(",",implode_md(file($GLOBALS['vault']."hex_general_commands.csv")));
			if(!$GLOBALS['memCache']['hex_general_commands.csv'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (hex_general_commands.csv)!".$GLOBALS['linebreak'];
				break;
				}
			$c=count($GLOBALS['memCache']['hex_general_commands.csv']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (hex_general_commands.csv)!".$GLOBALS['linebreak'];
				break;
				}
			for($i=0;$i<$c;$i++)
				{
				if(substr_count($str_norm,$GLOBALS['memCache']['hex_general_commands.csv'][$i])>0)
					{
					$xgc=@hex2bin($GLOBALS['memCache']['hex_general_commands.csv'][$i]);
					$out.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_command_injection']."!".$GLOBALS['linebreak'];
					if($fm)if(!$xskd)
						{
						$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						$xskd=true;
						}
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_command_injection'].", '".urlencode($xgc)."' (".$ofn.")! ";
					}
				}
			break;
			}
		}
	$is_graphics=false;
	if(!isset($whitelist['Graphics'])&&($GLOBALS['MusselConfig']['signatures']['graphics_clamav']||$GLOBALS['MusselConfig']['signatures']['graphics_custom']||$GLOBALS['MusselConfig']['signatures']['graphics_mussel']))
		{
		$chkmagic=false;
		if(!$chkmagic)if(substr($str_hex,0,12)==="474946383761"||substr($str_hex,0,12)==="474946383961")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,16)==="0000000c6a502020")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,8)==="89504e47")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,6)==="ffd8ff")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,8)==="25504446")$chkmagic=true;
		if(!$chkmagic)if(substr($str,0,2)==="BM"||substr($str,0,8)==="gimp xcf"||substr($str,0,4)==="8BPS"||substr($str,0,4)==="WEBP")$chkmagic=true;
		if(substr_count(",bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,",",".$xt.",")>0||$chkmagic)
			{
			$is_graphics=true;
			if($GLOBALS['MusselConfig']['signatures']['graphics_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_clamav_standard.cvd']))$GLOBALS['memCache']['graphics_clamav_standard.cvd']=@file($GLOBALS['vault']."graphics_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['graphics_clamav_standard.map']))$GLOBALS['memCache']['graphics_clamav_standard.map']=@file($GLOBALS['vault']."graphics_clamav_standard.map");
					if(!$GLOBALS['memCache']['graphics_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (graphics_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (graphics_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['graphics_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['graphics_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										$this_norm=$str_norm;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$this_norm="\x01".$this_norm;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")
											{
											$this_str=substr($this_str,$xstrf*2);
											$this_norm=substr($this_norm,$xstrf*2);
											}
										if($xstrt!="*")
											{
											$this_str=substr($this_str,0,$xstrt*2);
											$this_norm=substr($this_norm,0,$xstrt*2);
											}
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_norm,$xsig[$xsigi]))continue 2;
											if($xsigc>1)
												{
												if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
												if(substr_count($this_norm,$xsig[$xsigi]))$this_norm=substraf($this_norm,$xsig[$xsigi].">");
												}
											}
										$this_norm=$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_clamav_regex.cvd']))$GLOBALS['memCache']['graphics_clamav_regex.cvd']=@file($GLOBALS['vault']."graphics_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['graphics_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['graphics_clamav_regex.map']))$GLOBALS['memCache']['graphics_clamav_regex.map']=@file($GLOBALS['vault']."graphics_clamav_regex.map");
					if(!$GLOBALS['memCache']['graphics_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (graphics_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (graphics_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['graphics_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['graphics_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_norm))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_norm))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['graphics_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_custom_standard.cvd']))$GLOBALS['memCache']['graphics_custom_standard.cvd']=@file($GLOBALS['vault']."graphics_custom_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								$this_norm=$str_norm;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_norm="\x01".$this_norm;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_norm=substr($this_norm,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_norm=substr($this_norm,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_norm,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_norm,$xsig[$xsigi]))$this_norm=substraf($this_norm,$xsig[$xsigi].">");
										}
									}
								$this_norm=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_custom_regex.cvd']))$GLOBALS['memCache']['graphics_custom_regex.cvd']=@file($GLOBALS['vault']."graphics_custom_regex.cvd");
					if(!$GLOBALS['memCache']['graphics_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_norm))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_norm))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['graphics_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_mussel_standard.cvd']))$GLOBALS['memCache']['graphics_mussel_standard.cvd']=@file($GLOBALS['vault']."graphics_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								$this_norm=$str_norm;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_norm="\x01".$this_norm;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_norm=substr($this_norm,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_norm=substr($this_norm,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_norm,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_norm,$xsig[$xsigi]))$this_norm=substraf($this_norm,$xsig[$xsigi].">");
										}
									}
								$this_norm=$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['graphics_mussel_regex.cvd']))$GLOBALS['memCache']['graphics_mussel_regex.cvd']=@file($GLOBALS['vault']."graphics_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['graphics_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (graphics_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex)&&!preg_match("/".$xsig."/i",$str_norm))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex)&&!preg_match("/\A".$xsig."/i",$str_norm))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($str_norm,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	if(!isset($whitelist['PDF'])&&($GLOBALS['MusselConfig']['signatures']['pdf_clamav']||$GLOBALS['MusselConfig']['signatures']['pdf_custom']||$GLOBALS['MusselConfig']['signatures']['pdf_mussel']))
		{
		if(substr_count(",pdf,",",".$xt.",")>0||$pdf_magic)
			{
			if($GLOBALS['MusselConfig']['signatures']['pdf_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_clamav_standard.cvd']))$GLOBALS['memCache']['pdf_clamav_standard.cvd']=@file($GLOBALS['vault']."pdf_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['pdf_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['pdf_clamav_standard.map']))$GLOBALS['memCache']['pdf_clamav_standard.map']=@file($GLOBALS['vault']."pdf_clamav_standard.map");
					if(!$GLOBALS['memCache']['pdf_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (pdf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (pdf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['pdf_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['pdf_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
										if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
											if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											}
										$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_clamav_regex.cvd']))$GLOBALS['memCache']['pdf_clamav_regex.cvd']=@file($GLOBALS['vault']."pdf_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['pdf_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['pdf_clamav_regex.map']))$GLOBALS['memCache']['pdf_clamav_regex.map']=@file($GLOBALS['vault']."pdf_clamav_regex.map");
					if(!$GLOBALS['memCache']['pdf_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (pdf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (pdf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['pdf_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['pdf_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['pdf_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_custom_standard.cvd']))$GLOBALS['memCache']['pdf_custom_standard.cvd']=@file($GLOBALS['vault']."pdf_custom_standard.cvd");
					if(!$GLOBALS['memCache']['pdf_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['pdf_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_custom_regex.cvd']))$GLOBALS['memCache']['pdf_custom_regex.cvd']=@file($GLOBALS['vault']."pdf_custom_regex.cvd");
					if(!$GLOBALS['memCache']['pdf_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['pdf_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['pdf_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_mussel_standard.cvd']))$GLOBALS['memCache']['pdf_mussel_standard.cvd']=@file($GLOBALS['vault']."pdf_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['pdf_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['pdf_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['pdf_mussel_regex.cvd']))$GLOBALS['memCache']['pdf_mussel_regex.cvd']=@file($GLOBALS['vault']."pdf_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['pdf_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pdf_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['pdf_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['pdf_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	$is_swf=false;
	if(!isset($whitelist['SWF'])&&($GLOBALS['MusselConfig']['signatures']['swf_clamav']||$GLOBALS['MusselConfig']['signatures']['swf_custom']||$GLOBALS['MusselConfig']['signatures']['swf_mussel']))
		{
		if(substr_count(",435753,465753,5a5753,",",".substr($str_hex,0,6).",")>0||substr_count(",swf,swt,",",".$xt.",")>0)
			{
			$is_swf=true;
			if($GLOBALS['MusselConfig']['signatures']['swf_clamav'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_clamav_standard.cvd']))$GLOBALS['memCache']['swf_clamav_standard.cvd']=@file($GLOBALS['vault']."swf_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['swf_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['swf_clamav_standard.map']))$GLOBALS['memCache']['swf_clamav_standard.map']=@file($GLOBALS['vault']."swf_clamav_standard.map");
					if(!$GLOBALS['memCache']['swf_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (swf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (swf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['swf_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['swf_clamav_standard.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if($str_hex_len<$xlen)continue;
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
										$xsigc=count($xsig);
										$this_str=$str_hex;
										if($xstrf=="A")
											{
											$this_str="\x01".$this_str;
											$xsig[0]="\x01".$xsig[0];
											}
										else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
										if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
										for($xsigi=0;$xsigi<$xsigc;$xsigi++)
											{
											if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
											if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
											}
										$this_str=false;
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_clamav_regex.cvd']))$GLOBALS['memCache']['swf_clamav_regex.cvd']=@file($GLOBALS['vault']."swf_clamav_regex.cvd");
					if(!$GLOBALS['memCache']['swf_clamav_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['swf_clamav_regex.map']))$GLOBALS['memCache']['swf_clamav_regex.map']=@file($GLOBALS['vault']."swf_clamav_regex.map");
					if(!$GLOBALS['memCache']['swf_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing']." (swf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted']." (swf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['swf_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<($map[2]+1);$xind++)
								{
								$xsig=$GLOBALS['memCache']['swf_clamav_regex.cvd'][$xind];
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
									$xstrf=(isset($vn[2]))?$vn[2]:"*";
									$xstrt=(isset($vn[3]))?$vn[3]:"*";
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if($xstrf=="*")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else if($xstrf=="A")
											{
											if($xstrt=="*")
												{
												if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
												}
											else
												{
												if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
												}
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
										if($fm)if(!$xskd)
											{
											$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											$xskd=true;
											}
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
										}
									}
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['swf_custom'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_custom_standard.cvd']))$GLOBALS['memCache']['swf_custom_standard.cvd']=@file($GLOBALS['vault']."swf_custom_standard.cvd");
					if(!$GLOBALS['memCache']['swf_custom_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['swf_custom_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_custom_regex.cvd']))$GLOBALS['memCache']['swf_custom_regex.cvd']=@file($GLOBALS['vault']."swf_custom_regex.cvd");
					if(!$GLOBALS['memCache']['swf_custom_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['swf_custom_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['swf_mussel'])
				{
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_mussel_standard.cvd']))$GLOBALS['memCache']['swf_mussel_standard.cvd']=@file($GLOBALS['vault']."swf_mussel_standard.cvd");
					if(!$GLOBALS['memCache']['swf_mussel_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['swf_mussel_standard.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$str_hex;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")$this_str=substr($this_str,$xstrf*2);
								if($xstrt!="*")$this_str=substr($this_str,0,$xstrt*2);
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
									if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
									}
								$this_str=false;
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				while(true)
					{
					if(!isset($GLOBALS['memCache']['swf_mussel_regex.cvd']))$GLOBALS['memCache']['swf_mussel_regex.cvd']=@file($GLOBALS['vault']."swf_mussel_regex.cvd");
					if(!$GLOBALS['memCache']['swf_mussel_regex.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (swf_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['swf_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['swf_mussel_regex.cvd'][$i];
						if(substr($xsig,0,1)==">")
							{
							$xsig=explode(">",$xsig,4);
							$xsig[3]=($xsig[3]*-1)*-1;
							if($xsig[1]=="FN")
								{
								if(!preg_match("/".$xsig[2]."/i",$ofn))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								}
							else if(substr($xsig[1],0,1)=="\$")
								{
								$vf=substr($xsig[1],1);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf!=$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							else if(substr($xsig[1],0,2)=="!\$")
								{
								$vf=substr($xsig[1],2);
								if(isset($$vf))if(!is_array($$vf))
									{
									if($$vf==$xsig[2])
										{
										if($xsig[3]<=$i)break;
										$i=$xsig[3]-1;
										}
									continue;
									}
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($str_hex,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_hex,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
								if($fm)if(!$xskd)
									{
									$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									$xskd=true;
									}
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
								}
							}
						}
					break;
					}
				}
			}
		}
	if($str_xmlxdp)
		{
		if(!isset($whitelist['XMLXDP'])&&$GLOBALS['MusselConfig']['signatures']['xmlxdp_clamav'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_clamav_standard.cvd']))$GLOBALS['memCache']['xmlxdp_clamav_standard.cvd']=@file($GLOBALS['vault']."xmlxdp_clamav_standard.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_clamav_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_clamav_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_clamav_standard.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_clamav_standard.cvd'][$i];
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if($str_xmlxdp_len<$xlen)continue;
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
							$xsigc=count($xsig);
							$this_xmlxdp=$str_xmlxdp;
							if($xstrf=="A")
								{
								$this_xmlxdp="\x01".$this_xmlxdp;
								$xsig[0]="\x01".$xsig[0];
								}
							else if($xstrf!="*")$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							if($xstrt!="*")$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!substr_count($this_xmlxdp,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
								if($xsigc>1)if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							$this_xmlxdp=false;
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_clamav_regex.cvd']))$GLOBALS['memCache']['xmlxdp_clamav_regex.cvd']=@file($GLOBALS['vault']."xmlxdp_clamav_regex.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_clamav_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_clamav_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_clamav_regex.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_clamav_regex.cvd'][$i];
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							if($xstrf=="*")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else if($xstrf=="A")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
									}
								}
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			}
		if(!isset($whitelist['XMLXDP'])&&$GLOBALS['MusselConfig']['signatures']['xmlxdp_custom'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_custom_standard.cvd']))$GLOBALS['memCache']['xmlxdp_custom_standard.cvd']=@file($GLOBALS['vault']."xmlxdp_custom_standard.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_custom_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_custom_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_custom_standard.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_custom_standard.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if($str_xmlxdp_len<$xlen)continue;
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
							$xsigc=count($xsig);
							$this_xmlxdp=$str_xmlxdp;
							if($xstrf=="A")
								{
								$this_xmlxdp="\x01".$this_xmlxdp;
								$xsig[0]="\x01".$xsig[0];
								}
							else if($xstrf!="*")$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							if($xstrt!="*")$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!substr_count($this_xmlxdp,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
								if($xsigc>1)if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							$this_xmlxdp=false;
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_custom_regex.cvd']))$GLOBALS['memCache']['xmlxdp_custom_regex.cvd']=@file($GLOBALS['vault']."xmlxdp_custom_regex.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_custom_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_custom_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_custom_regex.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_custom_regex.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							if($xstrf=="*")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else if($xstrf=="A")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
									}
								}
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			}
		if(!isset($whitelist['XMLXDP'])&&$GLOBALS['MusselConfig']['signatures']['xmlxdp_mussel'])
			{
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_mussel_standard.cvd']))$GLOBALS['memCache']['xmlxdp_mussel_standard.cvd']=@file($GLOBALS['vault']."xmlxdp_mussel_standard.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_mussel_standard.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_mussel_standard.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_mussel_standard.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_mussel_standard.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if($str_xmlxdp_len<$xlen)continue;
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
							$xsigc=count($xsig);
							$this_xmlxdp=$str_xmlxdp;
							if($xstrf=="A")
								{
								$this_xmlxdp="\x01".$this_xmlxdp;
								$xsig[0]="\x01".$xsig[0];
								}
							else if($xstrf!="*")$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
							if($xstrt!="*")$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!substr_count($this_xmlxdp,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
								if($xsigc>1)if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].">");
								}
							$this_xmlxdp=false;
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			while(true)
				{
				if(!isset($GLOBALS['memCache']['xmlxdp_mussel_regex.cvd']))$GLOBALS['memCache']['xmlxdp_mussel_regex.cvd']=@file($GLOBALS['vault']."xmlxdp_mussel_regex.cvd");
				if(!$GLOBALS['memCache']['xmlxdp_mussel_regex.cvd'])
					{
					if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (xmlxdp_mussel_regex.cvd)!".$GLOBALS['linebreak'];
					break;
					}
				$c=@count($GLOBALS['memCache']['xmlxdp_mussel_regex.cvd']);
				$vn="";
				for($i=0;$i<$c;$i++)
					{
					$xsig=$GLOBALS['memCache']['xmlxdp_mussel_regex.cvd'][$i];
					if(substr($xsig,0,1)==">")
						{
						$xsig=explode(">",$xsig,4);
						$xsig[3]=($xsig[3]*-1)*-1;
						if($xsig[1]=="FN")
							{
							if(!preg_match("/".$xsig[2]."/i",$ofn))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MIN")
							{
							if($str_len<$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FS-MAX")
							{
							if($str_len>$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD")
							{
							if(!substr_count($str_hex,$xsig[2]))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if($xsig[1]=="FD-RX")
							{
							if(!preg_match("/".$xsig[2]."/i",$str_hex))
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							}
						else if(substr($xsig[1],0,1)=="\$")
							{
							$vf=substr($xsig[1],1);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf!=$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						else if(substr($xsig[1],0,2)=="!\$")
							{
							$vf=substr($xsig[1],2);
							if(isset($$vf))if(!is_array($$vf))
								{
								if($$vf==$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									}
								continue;
								}
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						continue;
						}
					if(substr_count($xsig,":")>0)
						{
						$vn=@explode(":",$xsig);
						$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
						$xsig=($xsig===false?"":implode("",$xsig));
						$xlen=strlen($xsig);
						if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
						$xstrf=(isset($vn[2]))?$vn[2]:"*";
						$xstrt=(isset($vn[3]))?$vn[3]:"*";
						$vn=$vn[0];
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
							{
							if($xstrf=="*")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else if($xstrf=="A")
								{
								if($xstrt=="*")
									{
									if(!preg_match("/\A".$xsig."/i",$str_xmlxdp))continue;
									}
								else
									{
									if(!preg_match("/\A".$xsig."/i",substr($str_xmlxdp,0,$xstrt*2)))continue;
									}
								}
							else
								{
								if($xstrt=="*")
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2)))continue;
									}
								else
									{
									if(!preg_match("/".$xsig."/i",substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
									}
								}
							$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."!".$GLOBALS['linebreak'];
							if($fm)if(!$xskd)
								{
								$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								$xskd=true;
								}
							if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)." (".$ofn.")! ";
							}
						}
					}
				break;
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['block_control_characters'])
		{
		if(preg_match("/[\x00-\x08\x0b\x0c\x0e\x1f\x7f]/i",$str))
			{
			$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected_control_characters']."!".$GLOBALS['linebreak'];
			if($fm)if(!$xskd)
				{
				$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				$xskd=true;
				}
			if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected_control_characters']." (".$ofn.")! ";
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['coex_clamav'])
		{
		if(!isset($GLOBALS['memCache']['coex_clamav.cvd']))$GLOBALS['memCache']['coex_clamav.cvd']=@implode_md(file($GLOBALS['vault']."coex_clamav.cvd"));
		if(!$GLOBALS['memCache']['coex_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (coex_clamav.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$coexi=0;
			$signame="";
			while(true)
				{
				$coexi++;
				$xsig=array();
				if($coexi===1)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$md5:".$md5.";"))$xsig=explode($GLOBALS['linebreak']."\$md5:".$md5.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===2)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$str_len:".$str_len.";"))$xsig=explode($GLOBALS['linebreak']."\$str_len:".$str_len.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===3)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$fourcc:".$fourcc.";"))$xsig=explode($GLOBALS['linebreak']."\$fourcc:".$fourcc.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===4)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$twocc:".$twocc.";"))$xsig=explode($GLOBALS['linebreak']."\$twocc:".$twocc.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===5)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$phase:".$phase.";"))$xsig=explode($GLOBALS['linebreak']."\$phase:".$phase.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===6)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$xt:".$xt.";"))$xsig=explode($GLOBALS['linebreak']."\$xt:".$xt.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===7)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$sha:".$sha.";"))$xsig=explode($GLOBALS['linebreak']."\$sha:".$sha.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===8)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$crc:".$crc.";"))$xsig=explode($GLOBALS['linebreak']."\$crc:".$crc.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_html:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:1;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if(!$is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_html:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:0;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_graphics:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:1;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if(!$is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_graphics:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:0;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_pe:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:1;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if(!$is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_pe:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:0;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_macho:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:1;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if(!$is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$is_macho:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:0;",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===13)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$xts:".$xts.";"))$xsig=explode($GLOBALS['linebreak']."\$xts:".$xts.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi===14)if(substr_count($GLOBALS['memCache']['coex_clamav.cvd'],$GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";"))$xsig=explode($GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";",$GLOBALS['memCache']['coex_clamav.cvd']);
				if($coexi>14)break;
				$xc=count($xsig);
				if(isset($xsig[0]))$xsig[0]="";
				if($xc>0)for($xi=1;$xi<$xc;$xi++)
					{
					if(!substr_count($xsig[$xi],$GLOBALS['linebreak'])||!substr_count($xsig[$xi],";")||!substr_count($xsig[$xi],":"))continue;
					$xsig[$xi]=substrbf($xsig[$xi],$GLOBALS['linebreak']);
					$signame=substral($xsig[$xi],";");
					$xsig[$xi]=explode(";",substrbl($xsig[$xi],";"));
					$sxc=count($xsig[$xi]);
					if($sxc>0)for($sxi=0;$sxi<$sxc;$sxi++)
						{
						$xsig[$xi][$sxi]=explode(":",$xsig[$xi][$sxi],4);
						if(isset($xsig[$xi][$sxi][2]))
							{
							if(isset($xsig[$xi][$sxi][3]))
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".substr($str_hex,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_hex,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".substr($str_norm,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_norm,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,0,$xsig[$xi][$sxi][3])))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									}
								}
							else
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".$str_hex,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".$str_norm,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2])))continue 2;
									}
								}
							}
						else
							{
							if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MIN")if($str_len<$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MAX")if($str_len>$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FD")if(!substr_count($str_hex,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count($str_norm,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
							if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
							if(substr($xsig[$xi][$sxi][0],0,1)=="\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],1);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf!=$xsig[$xi][$sxi][1])continue 2;
								}
							else if(substr($xsig[$xi][$sxi][0],0,2)=="!\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],2);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf==$xsig[$xi][$sxi][1])continue 2;
								}
							else if(!substr_count(",FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
							}
						}
					if($signame)if(!substr_count($GLOBALS['memCache']['greylist'],",".$signame.","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$signame."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$signame." (".$ofn.")! ";
						}
					$xsig[$xi]="";
					}
				}
			$sxi=$sxc=$signame=$xi=$xc=$xsig=$coexi="";
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['coex_custom'])
		{
		if(!isset($GLOBALS['memCache']['coex_custom.cvd']))$GLOBALS['memCache']['coex_custom.cvd']=@implode_md(file($GLOBALS['vault']."coex_custom.cvd"));
		if(!$GLOBALS['memCache']['coex_custom.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (coex_custom.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$coexi=0;
			$signame="";
			while(true)
				{
				$coexi++;
				$xsig=array();
				if($coexi===1)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$md5:".$md5.";"))$xsig=explode($GLOBALS['linebreak']."\$md5:".$md5.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===2)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$str_len:".$str_len.";"))$xsig=explode($GLOBALS['linebreak']."\$str_len:".$str_len.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===3)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$fourcc:".$fourcc.";"))$xsig=explode($GLOBALS['linebreak']."\$fourcc:".$fourcc.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===4)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$twocc:".$twocc.";"))$xsig=explode($GLOBALS['linebreak']."\$twocc:".$twocc.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===5)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$phase:".$phase.";"))$xsig=explode($GLOBALS['linebreak']."\$phase:".$phase.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===6)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$xt:".$xt.";"))$xsig=explode($GLOBALS['linebreak']."\$xt:".$xt.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===7)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$sha:".$sha.";"))$xsig=explode($GLOBALS['linebreak']."\$sha:".$sha.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===8)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$crc:".$crc.";"))$xsig=explode($GLOBALS['linebreak']."\$crc:".$crc.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_html:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:1;",$GLOBALS['memCache']['coex_custom.cvd']);
				if(!$is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_html:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:0;",$GLOBALS['memCache']['coex_custom.cvd']);
				if($is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_graphics:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:1;",$GLOBALS['memCache']['coex_custom.cvd']);
				if(!$is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_graphics:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:0;",$GLOBALS['memCache']['coex_custom.cvd']);
				if($is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_pe:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:1;",$GLOBALS['memCache']['coex_custom.cvd']);
				if(!$is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_pe:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:0;",$GLOBALS['memCache']['coex_custom.cvd']);
				if($is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_macho:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:1;",$GLOBALS['memCache']['coex_custom.cvd']);
				if(!$is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$is_macho:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:0;",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===13)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$xts:".$xts.";"))$xsig=explode($GLOBALS['linebreak']."\$xts:".$xts.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi===14)if(substr_count($GLOBALS['memCache']['coex_custom.cvd'],$GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";"))$xsig=explode($GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";",$GLOBALS['memCache']['coex_custom.cvd']);
				if($coexi>14)break;
				$xc=count($xsig);
				if(isset($xsig[0]))$xsig[0]="";
				if($xc>0)for($xi=1;$xi<$xc;$xi++)
					{
					if(!substr_count($xsig[$xi],$GLOBALS['linebreak'])||!substr_count($xsig[$xi],";")||!substr_count($xsig[$xi],":"))continue;
					$xsig[$xi]=substrbf($xsig[$xi],$GLOBALS['linebreak']);
					$signame=substral($xsig[$xi],";");
					$xsig[$xi]=explode(";",substrbl($xsig[$xi],";"));
					$sxc=count($xsig[$xi]);
					if($sxc>0)for($sxi=0;$sxi<$sxc;$sxi++)
						{
						$xsig[$xi][$sxi]=explode(":",$xsig[$xi][$sxi],4);
						if(isset($xsig[$xi][$sxi][2]))
							{
							if(isset($xsig[$xi][$sxi][3]))
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".substr($str_hex,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_hex,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".substr($str_norm,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_norm,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,0,$xsig[$xi][$sxi][3])))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									}
								}
							else
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".$str_hex,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".$str_norm,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2])))continue 2;
									}
								}
							}
						else
							{
							if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MIN")if($str_len<$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MAX")if($str_len>$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FD")if(!substr_count($str_hex,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count($str_norm,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
							if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
							if(substr($xsig[$xi][$sxi][0],0,1)=="\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],1);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf!=$xsig[$xi][$sxi][1])continue 2;
								}
							else if(substr($xsig[$xi][$sxi][0],0,2)=="!\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],2);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf==$xsig[$xi][$sxi][1])continue 2;
								}
							else if(!substr_count(",FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
							}
						}
					if($signame)if(!substr_count($GLOBALS['memCache']['greylist'],",".$signame.","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$signame."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$signame." (".$ofn.")! ";
						}
					$xsig[$xi]="";
					}
				}
			$sxi=$sxc=$signame=$xi=$xc=$xsig=$coexi="";
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['coex_mussel'])
		{
		if(!isset($GLOBALS['memCache']['coex_mussel.cvd']))$GLOBALS['memCache']['coex_mussel.cvd']=@implode_md(file($GLOBALS['vault']."coex_mussel.cvd"));
		if(!$GLOBALS['memCache']['coex_mussel.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (coex_mussel.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$coexi=0;
			$signame="";
			while(true)
				{
				$coexi++;
				$xsig=array();
				if($coexi===1)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$md5:".$md5.";"))$xsig=explode($GLOBALS['linebreak']."\$md5:".$md5.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===2)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$str_len:".$str_len.";"))$xsig=explode($GLOBALS['linebreak']."\$str_len:".$str_len.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===3)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$fourcc:".$fourcc.";"))$xsig=explode($GLOBALS['linebreak']."\$fourcc:".$fourcc.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===4)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$twocc:".$twocc.";"))$xsig=explode($GLOBALS['linebreak']."\$twocc:".$twocc.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===5)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$phase:".$phase.";"))$xsig=explode($GLOBALS['linebreak']."\$phase:".$phase.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===6)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$xt:".$xt.";"))$xsig=explode($GLOBALS['linebreak']."\$xt:".$xt.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===7)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$sha:".$sha.";"))$xsig=explode($GLOBALS['linebreak']."\$sha:".$sha.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===8)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$crc:".$crc.";"))$xsig=explode($GLOBALS['linebreak']."\$crc:".$crc.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_html:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:1;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if(!$is_html&&$coexi===9)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_html:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_html:0;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_graphics:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:1;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if(!$is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_graphics:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_graphics:0;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_pe:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:1;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if(!$is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_pe:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_pe:0;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_macho:1;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:1;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if(!$is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$is_macho:0;"))$xsig=explode($GLOBALS['linebreak']."\$is_macho:0;",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===13)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$xts:".$xts.";"))$xsig=explode($GLOBALS['linebreak']."\$xts:".$xts.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi===14)if(substr_count($GLOBALS['memCache']['coex_mussel.cvd'],$GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";"))$xsig=explode($GLOBALS['linebreak']."\$NumOfSections:".$NumOfSections.";",$GLOBALS['memCache']['coex_mussel.cvd']);
				if($coexi>14)break;
				$xc=count($xsig);
				if(isset($xsig[0]))$xsig[0]="";
				if($xc>0)for($xi=1;$xi<$xc;$xi++)
					{
					if(!substr_count($xsig[$xi],$GLOBALS['linebreak'])||!substr_count($xsig[$xi],";")||!substr_count($xsig[$xi],":"))continue;
					$xsig[$xi]=substrbf($xsig[$xi],$GLOBALS['linebreak']);
					$signame=substral($xsig[$xi],";");
					$xsig[$xi]=explode(";",substrbl($xsig[$xi],";"));
					$sxc=count($xsig[$xi]);
					if($sxc>0)for($sxi=0;$sxi<$sxc;$sxi++)
						{
						$xsig[$xi][$sxi]=explode(":",$xsig[$xi][$sxi],4);
						if(isset($xsig[$xi][$sxi][2]))
							{
							if(isset($xsig[$xi][$sxi][3]))
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".substr($str_hex,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_hex,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".substr($str_norm,0,$xsig[$xi][$sxi][3]),"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($str_norm,0,$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,0,$xsig[$xi][$sxi][3])))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2],$xsig[$xi][$sxi][3])))continue 2;
									}
								}
							else
								{
								if($xsig[$xi][$sxi][2]=="A")
									{
									if(!substr_count(",FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count("\x01".$str_hex,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count("\x01".$str_norm,"\x01".$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/\A".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
									}
								else
									{
									if(!substr_count(",FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
									if($xsig[$xi][$sxi][0]=="FD")if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_hex,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2]),$xsig[$xi][$sxi][1]))continue 2;
									if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($str_norm,$xsig[$xi][$sxi][2])))continue 2;
									if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",substr($CoExMeta,$xsig[$xi][$sxi][2])))continue 2;
									}
								}
							}
						else
							{
							if($xsig[$xi][$sxi][0]=="FN")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$ofn))continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MIN")if($str_len<$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FS-MAX")if($str_len>$xsig[$xi][$sxi][1])continue 2;
							if($xsig[$xi][$sxi][0]=="FD")if(!substr_count($str_hex,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_hex))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM")if(!substr_count($str_norm,$xsig[$xi][$sxi][1]))continue 2;
							if($xsig[$xi][$sxi][0]=="FD-NORM-RX")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$str_norm))continue 2;
							if($xsig[$xi][$sxi][0]=="META")if(!preg_match("/".$xsig[$xi][$sxi][1]."/i",$CoExMeta))continue 2;
							if(substr($xsig[$xi][$sxi][0],0,1)=="\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],1);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf!=$xsig[$xi][$sxi][1])continue 2;
								}
							else if(substr($xsig[$xi][$sxi][0],0,2)=="!\$")
								{
								$vf=substr($xsig[$xi][$sxi][0],2);
								if(!isset($$vf))continue 2;
								if(is_array($$vf))continue 2;
								if($$vf==$xsig[$xi][$sxi][1])continue 2;
								}
							else if(!substr_count(",FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,",",".$xsig[$xi][$sxi][0].","))continue 2;
							}
						}
					if($signame)if(!substr_count($GLOBALS['memCache']['greylist'],",".$signame.","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$signame."!".$GLOBALS['linebreak'];
						if($fm)if(!$xskd)
							{
							$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							$xskd=true;
							}
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$signame." (".$ofn.")! ";
						}
					$xsig[$xi]="";
					}
				}
			$sxi=$sxc=$signame=$xi=$xc=$xsig=$coexi="";
			}
		}
	if(!$out)return 1;
	if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
		{
		if($str_len<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
			{
			$qfu=time()."-".md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$crc.time());
			@phpMusselQ($str,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
			if($fm)$GLOBALS['xsk'].="Quarantined as \"/vault/quarantine/".$qfu.".qfu\".".$GLOBALS['linebreak'];
			}
		}
	return (!$n)?2:$out;
	}
function phpMusselR($f="",$n=0,$zz=0,$dpt=0,$ofn="")
	{
	$fm=($n==2)?1:0;
	$dpt++;
	$lnap="";
	for($i=0;$i<($dpt-1);$i++)
		{
		$lnap.="-";
		}
	$lnap.="> ";
	$ofn=@prescan_decode($ofn);
	$ofnenc=urlencode($ofn);
	if(is_array($f))
		{
		$k=key($f);
		$c=count($f);
		for($i=0;$i<$c;$i++)
			{
			$f[$k]=phpMusselR($f[$k],$n,0,$dpt,$f[$k]);
			next($f);
			}
		if($n&&$zz)return implode_md($f);
		return $f;
		}
	$d=@is_dir($f);
	if($d)
		{
		$d=@scandir($f);
		if(!$d)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['failed_to_access']."'".$ofnenc."'!".$GLOBALS['linebreak'];
		$c=count($d);
		for($i=0;$i<$c;$i++)
			{
			if($d[$i]=="."||$d[$i]=="..")
				{
				unset($d[$i]);
				continue;
				}
			$d[$i]=phpMusselR($f."/".$d[$i],$n,0,$dpt,$d[$i]);
			}
		if($n&&$zz)return implode_md($d);
		return $d;
		}
	$GLOBALS['memCache']['phase']="file";
	if(!isset($GLOBALS['xsk']))$GLOBALS['xsk']="";
	if(!isset($GLOBALS['xfm']))$GLOBALS['xfm']="";
	if(!isset($GLOBALS['xpe']))$GLOBALS['xpe']="";
	$GLOBALS['memCache']['file_is_ole']=false;
	if(!isset($GLOBALS['memCache']['greylist']))
		{
		if(!file_exists($GLOBALS['vault']."greylist.csv"))
			{
			$GLOBALS['memCache']['greylist']=",";
			$glf=fopen($GLOBALS['vault']."greylist.csv","a");
			fwrite($glf,",");
			fclose($glf);
			unset($glf);
			}
		else
			{
			$GLOBALS['memCache']['greylist']=@implode_md(file($GLOBALS['vault']."greylist.csv"));
			}
		}
	$d=@is_file($f);
	$fnCRC=@hash("crc32b",$ofn);
	if(!$d||!$f)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['invalid_file']."!".$GLOBALS['linebreak'];
	$fS=@filesize($f);
	if($GLOBALS['MusselConfig']['files']['filesize_limit']>0)
		{
		if($fS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
			{
			if(!$GLOBALS['MusselConfig']['files']['filesize_response'])return (!$n)?1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['ok']." (".$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].").".$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xsk'].="--FILESIZE-LIMIT--------NO-HASH-:".$fS.":".$ofnenc.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded']." (".$ofnenc.")! ";
			if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].".".$GLOBALS['linebreak'];
			}
		}
	if(substr($ofn,0,1)==="."||substr($ofn,-1)===".")
		{
		if($fm)$GLOBALS['xsk'].="--FILENAME-MANIPULATION-NO-HASH-:".$fS.":".$ofnenc.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected']." (".$ofnenc.")! ";
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected']."!".$GLOBALS['linebreak'];
		}
	$xt=$xts=$gzxt=$gzxts="-";
	if(substr_count($ofn,".")>0)
		{
		$xt=explode(".",strtolower($ofn));
		$xts=substr($xt[count($xt)-1],0,3)."*";
		$xt=$xt[count($xt)-1];
		if(substr_count($ofn,".")>1)
			{
			$gzxt=explode(".",str_replace(".gz","",strtolower($ofn)));
			$gzxts=substr($gzxt[count($gzxt)-1],0,3)."*";
			$gzxt=strtolower($gzxt[count($gzxt)-1]);
			}
		if(strlen($xt)<1)$xt=$xts=$gzxt=$gzxts="-";
		}
	if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xts.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$gzxt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$gzxts.",")>0)return (!$n)?1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
	if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xts.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$gzxt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$gzxts.",")>0)
		{
		if($fm)$GLOBALS['xsk'].="--FILETYPE-BLACKLISTED--NO-HASH-:".$fS.":".$ofnenc.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted']." (".$ofnenc.")! ";
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].".".$GLOBALS['linebreak'];
		}
	if($GLOBALS['MusselConfig']['files']['filetype_greylist'])if(!substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_greylist'].",",",".$xt.",")&&!substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_greylist'].",",",".$xts.",")&&!substr_count($GLOBALS['MusselConfig']['files']['filetype_greylist'].",",$gzxt.",")&&!substr_count($GLOBALS['MusselConfig']['files']['filetype_greylist'].",",$gzxts.","))
		{
		if($fm)$GLOBALS['xsk'].="----FILETYPE--NOT-GREYLISTED----:".$fS.":".$ofnenc.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted']." (".$ofnenc.")! ";
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].".".$GLOBALS['linebreak'];
		}
	$in=@phpMusselFile($f,($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$fS>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*1024))?$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']:$fS,1);
	$fdCRC=@hash("crc32b",$in);
	if($in&&$GLOBALS['MusselConfig']['compatibility']['only_allow_images'])
		{
		$is_img=(substr_count(",bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,",",".$xt.",")>0)?true:false;
		$hh=(!$is_img)?bin2hex(substr($in,0,128)):"";
		if(!$is_img)if(substr($hh,0,12)==="474946383761"||substr($hh,0,12)==="474946383961")$is_img=true;
		if(!$is_img)if(substr($hh,0,16)==="0000000c6a502020")$is_img=true;
		if(!$is_img)if(substr($hh,0,8)==="89504e47")$is_img=true;
		if(!$is_img)if(substr($hh,0,6)==="ffd8ff")$is_img=true;
		if(!$is_img)if(substr($hh,0,8)==="25504446")$is_img=true;
		if(!$is_img)if(substr($str,0,2)==="BM"||substr($str,0,8)==="gimp xcf"||substr($str,0,4)==="8BPS"||substr($str,0,4)==="WEBP")$is_img=true;
		if(!$is_img)
			{
			if($fm)$GLOBALS['xsk'].=md5($in).":".$fS.":".$ofnenc.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['only_allow_images']." (".$ofnenc.")! ";
			if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."; FD: ".$fdCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['only_allow_images'].".".$GLOBALS['linebreak'];
			}
		unset($hh,$is_img);
		}
	$z=phpMusselD($in,$n,$dpt,$ofn);
	if($z!==1)
		{
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?$z:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."; FD: ".$fdCRC."):".$GLOBALS['linebreak'].$z;
		}
	$x=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' (FN: ".$fnCRC."; FD: ".$fdCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
	$r=1;
	if($GLOBALS['MusselConfig']['files']['check_archives']&&!empty($in)&&$GLOBALS['MusselConfig']['files']['max_recursion']>1)
		{
		$GLOBALS['memCache']['phase']="archive";
		$depth=0;
		$eN=$ofn;
		$eS=strlen($in);
		$zCRC=@hash("crc32b",$in);
		while(true)
			{
			if($depth>$GLOBALS['MusselConfig']['files']['max_recursion'])
				{
				$r=2;
				if($fm)$GLOBALS['xsk'].=md5($in).":".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Recursion depth limit exceeded (".$ofnenc.")! ";
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FD: ".$zCRC."):".$GLOBALS['linebreak']."-".$lnap."Recursion depth limit exceeded.".$GLOBALS['linebreak'];
				break;
				}
			$isTar=$zDo=false;
			if(!$zDo&&substr_compare_hex($in,0,2,"1f8b",1))
				{
				if(!function_exists("gzdecode"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
				$in=@gzdecode($in);
				if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
				$zDo=true;
				}
			if(!$zDo&&substr_compare_hex($in,0,3,"425a68",1))
				{
				if(!function_exists("bzdecompress"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
				$in=@bzdecompress($in);
				if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
				$zDo=true;
				}
			$axt=(substr_count($eN,".")>0)?substral($eN,"."):"";
			if(!$zDo&&substr_count(",gz,tgz,",",".$axt.",")>0)
				{
				if(!function_exists("gzdecode"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
				$in=@gzdecode($in);
				if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (GZIP):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
				$zDo=true;
				}
			if(!$zDo&&substr_count(",bz,bz2,tbz,",",".$axt.",")>0)
				{
				if(!function_exists("bzdecompress"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
				$in=@bzdecompress($in);
				if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (BZIP2):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
				$zDo=true;
				}
			if(!$zDo&&substr_count(",lha,lz,lzh,lzo,lzw,lzx,tlz,",",".$axt.",")>0)
				{
				if(!function_exists("lzf_decompress"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (LZF):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
				$in=@lzf_decompress($in);
				if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (LZF):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (LZF):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
				$zDo=true;
				}
			if(substr_count(",tar,tgz,tbz,tlz,",",".$axt.",")>0)
				{
				$isTar=true;
				}
			if($zDo)
				{
				$lnap="-".$lnap;
				$eN=(substr_count($eN,".")>0)?substrbl($eN,"."):$eN;
				$eS=strlen($in);
				$zCRC=@hash("crc32b",$in);
				if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
					{
					if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
						{
						if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
							{
							$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FD: ".$zCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['ok']." (".$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].").".$GLOBALS['linebreak'];
							break;
							}
						$r=2;
						if($fm)$GLOBALS['xsk'].="--FILESIZE-LIMIT--------NO-HASH-:".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded']." (".$ofnenc.")! ";
						$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FD: ".$zCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].".".$GLOBALS['linebreak'];
						break;
						}
					}
				$bad=phpMusselD($in,$n,$dpt,$eN);
				$zmd="";
				if($GLOBALS['MusselConfig']['signatures']['metadata_clamav'])
					{
					if(!isset($GLOBALS['memCache']['metadata_clamav.cvd']))$GLOBALS['memCache']['metadata_clamav.cvd']=@file($GLOBALS['vault']."metadata_clamav.cvd");
					if(!$GLOBALS['memCache']['metadata_clamav.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_clamav.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['metadata_clamav.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_clamav.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['metadata_clamav.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($in).":".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
								}
							}
						}
					}
				if($GLOBALS['MusselConfig']['signatures']['metadata_custom'])
					{
					if(!isset($GLOBALS['memCache']['metadata_custom.cvd']))$GLOBALS['memCache']['metadata_custom.cvd']=@file($GLOBALS['vault']."metadata_custom.cvd");
					if(!$GLOBALS['memCache']['metadata_custom.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_custom.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['metadata_custom.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_custom.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['metadata_custom.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($in).":".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
								}
							}
						}
					}
				if($GLOBALS['MusselConfig']['signatures']['metadata_mussel'])
					{
					if(!isset($GLOBALS['memCache']['metadata_mussel.cvd']))$GLOBALS['memCache']['metadata_mussel.cvd']=@file($GLOBALS['vault']."metadata_mussel.cvd");
					if(!$GLOBALS['memCache']['metadata_mussel.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_mussel.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['metadata_mussel.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_mussel.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['metadata_mussel.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($in).":".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
								}
							}
						}
					}
				if($bad!==1)
					{
					$r=2;
					$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$fnCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak'].$bad.$zmd;
					break;
					}
				if($r===2&&$zmd)
					{
					if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
						{
						if($eS<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
							{
							$qfu=time()."-".md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$zCRC.time());
							@phpMusselQ($in,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
							if($fm)$GLOBALS['xsk'].="Quarantined as \"/vault/quarantine/".$qfu.".qfu\".".$GLOBALS['linebreak'];
							}
						}
					$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$fnCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak'].$zmd;
					break;
					}
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$fnCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
				continue;
				}
			break;
			}
		if($xts=="zip*"||substr($in,0,2)==="PK")
			{
			$ziptype=false;
			if(!$ziptype)if($xt=="ole")$ziptype="OLE";
			if(!$ziptype)if($xt=="smpk")$ziptype="SMPTE";
			if(!$ziptype)if($xt=="xpi")$ziptype="XPInstall";
			if(!$ziptype)if($xts=="app*")$ziptype="App";
			if(!$ziptype)if(substr_count(",docm,docx,dotm,dotx,potm,potx,ppam,ppsm,ppsx,pptm,pptx,xlam,xlsb,xlsm,xlsx,xltm,xltx,",",".$xt.",")>0)$ziptype="OpenXML";
			if(!$ziptype)if(substr_count(",odc,odf,odg,odm,odp,ods,odt,otg,oth,otp,ots,ott,",",".$xt.",")>0||$xts=="fod*")$ziptype="OpenDocument";
			if(!$ziptype)if(substr_count(",opf,epub,",",".$xt.",")>0)$ziptype="EPUB";
			if(!$ziptype)
				{
				$ziptype="ZIP";
				}
			else
				{
				$GLOBALS['memCache']['file_is_ole']=true;
				}
			if(!function_exists("zip_open"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (".$ziptype."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
			$fS=@zip_open($f);
			if(!$fS)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (".$ziptype."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
			$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (".$ziptype."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
			$b=false;
			$lnap="-".$lnap;
			$bi=-1;
			while(!$b)
				{
				$bi++;
				$fD=@zip_read($fS);
				if(!$fD)
					{
					$b=true;
					continue;
					}
				$eN=@zip_entry_name($fD);
				$eS=@zip_entry_filesize($fD);
				$znCRC=@hash("crc32b",$eN);
				if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
					{
					if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
						{
						if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
							{
							$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['ok']." (".$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].").".$GLOBALS['linebreak'];
							continue;
							}
						$r=2;
						if($fm)$GLOBALS['xsk'].="--FILESIZE-LIMIT--------NO-HASH-:".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded']." (".$ofnenc.")! ";
						$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].".".$GLOBALS['linebreak'];
						continue;
						}
					}
				if(substr($eN,0,1)==="."||substr($eN,-1)===".")
					{
					$r=2;
					if($fm)$GLOBALS['xsk'].="--FILENAME-MANIPULATION-NO-HASH-:".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected']." (".$ofnenc.")! ";
					$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected']."!".$GLOBALS['linebreak'];
					continue;
					}
				$xt=$xts="-";
				if(substr_count($eN,".")>0)
					{
					$xt=explode(".",strtolower($eN));
					$xts=substr($xt[count($xt)-1],0,3)."*";
					$xt=$xt[count($xt)-1];
					if(strlen($xt)<1)$xt=$xts="-";
					}
				if($GLOBALS['MusselConfig']['files']['filetype_archives'])
					{
					if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xts.",")>0)
						{
						$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
						continue;
						}
					if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xts.",")>0)
						{
						$r=2;
						if($fm)$GLOBALS['xsk'].="--FILETYPE-BLACKLISTED--NO-HASH-:".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted']." (".$ofnenc.">".$eN.")! ";
						$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].".".$GLOBALS['linebreak'];
						continue;
						}
					if($GLOBALS['MusselConfig']['files']['filetype_greylist'])if(!substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_greylist'].",",",".$xt.",")&&!substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_greylist'].",",",".$xts.","))
						{
						$r=2;
						if($fm)$GLOBALS['xsk'].="----FILETYPE--NOT-GREYLISTED----:".$eS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted']." (".$ofnenc.">".$eN.")! ";
						$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].".".$GLOBALS['linebreak'];
						continue;
						}
					}
				$eD=@zip_entry_read($fD,$eS);
				if(!$eD||!$eS)continue;
				$eFS=strlen($eD);
				$bad=phpMusselD($eD,$n,$dpt,$eN);
				$zmd="";
				$zCRC=@hash("crc32b",$eD);
				if($bi<2)
					{
					if($GLOBALS['MusselConfig']['signatures']['metadata_clamav'])
						{
						if(!isset($GLOBALS['memCache']['metadata_clamav.cvd']))$GLOBALS['memCache']['metadata_clamav.cvd']=@file($GLOBALS['vault']."metadata_clamav.cvd");
						if(!$GLOBALS['memCache']['metadata_clamav.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['metadata_clamav.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['metadata_clamav.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
									}
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['metadata_custom'])
						{
						if(!isset($GLOBALS['memCache']['metadata_custom.cvd']))$GLOBALS['memCache']['metadata_custom.cvd']=@file($GLOBALS['vault']."metadata_custom.cvd");
						if(!$GLOBALS['memCache']['metadata_custom.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_custom.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['metadata_custom.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_custom.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['metadata_custom.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
									}
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['metadata_mussel'])
						{
						if(!isset($GLOBALS['memCache']['metadata_mussel.cvd']))$GLOBALS['memCache']['metadata_mussel.cvd']=@file($GLOBALS['vault']."metadata_mussel.cvd");
						if(!$GLOBALS['memCache']['metadata_mussel.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (metadata_mussel.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['metadata_mussel.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted']." (metadata_mussel.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['metadata_mussel.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofnenc.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$zmds[0]." (".$ofnenc.">".$eN.")! ";
									}
								}
							}
						}
					}
				if($bad!==1)
					{
					$r=2;
					$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak'].$bad.$zmd;
					continue;
					}
				if($r===2&&$zmd)
					{
					if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
						{
						if($eFS<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
							{
							$qfu=time()."-".md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$zCRC.time());
							@phpMusselQ($eD,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
							if($fm)$GLOBALS['xsk'].="Quarantined as \"/vault/quarantine/".$qfu.".qfu\".".$GLOBALS['linebreak'];
							}
						}
					$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak'].$zmd;
					continue;
					}
				$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking']." '".$ofnenc."' > '".$eN."' (FN: ".$znCRC."; FD: ".$zCRC."):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
				}
			}
		if($r===2&&$GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		}
	return (!$n)?$r:$x;
	}
define("mussel_php",defined("PHP_BINARY")?PHP_BINARY:"");
define("mussel_os",strtoupper(substr(PHP_OS,0,3)));
define("mussel_sapi",php_sapi_name());
if(strlen(mussel_php)>0)
	{
	if(mussel_os=="WIN"&&mussel_sapi=="cli")
		{
		function phpMusselFork($f="",$ofn="")
			{
			$pf=popen(mussel_php." \"".$GLOBALS['vault']."../phpmussel.php\" \"cli_win_scan\" \"".$f."\" \"".$ofn."\"","r");
			$s="";
			while($x=fgets($pf))$s.=$x;
			pclose($pf);
			return $s;
			}
		}
	}
$memCache=array();
if(!isset($MusselConfig['general']['scan_log']))$MusselConfig['general']['scan_log']="";
if(!isset($MusselConfig['general']['scan_kills']))$MusselConfig['general']['scan_kills']="";
if(!isset($MusselConfig['general']['forbid_on_block']))$MusselConfig['general']['forbid_on_block']=0;
if(!isset($MusselConfig['general']['delete_on_sight']))$MusselConfig['general']['delete_on_sight']=0;
if(!isset($MusselConfig['general']['quarantine_key']))$MusselConfig['general']['quarantine_key']="";
if(!isset($MusselConfig['general']['quarantine_max_filesize']))$MusselConfig['general']['quarantine_max_filesize']=2048;
if(!isset($MusselConfig['general']['quarantine_max_usage']))$MusselConfig['general']['quarantine_max_usage']=65536;
if(!isset($MusselConfig['general']['honeypot_mode']))$MusselConfig['general']['honeypot_mode']=0;
$memCache['vChkSigs']=array();
foreach(array("md5","general","ascii","html","pe","exe","elf","macho","graphics","metadata","ole","filenames","mail","whitelist","xmlxdp","coex","pdf","swf") as $memCache['vChkSigs']['sigset'])
	{
	$memCache['vChkSigs']['clamav']=$memCache['vChkSigs']['sigset']."_clamav";
	$memCache['vChkSigs']['custom']=$memCache['vChkSigs']['sigset']."_custom";
	$memCache['vChkSigs']['mussel']=$memCache['vChkSigs']['sigset']."_mussel";
	if(isset($MusselConfig['signatures'][$memCache['vChkSigs']['sigset']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=$MusselConfig['signatures'][$memCache['vChkSigs']['sigset']];
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=1;
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']]))$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=1;
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=1;
	}
unset($memCache['vChkSigs']);
if(!isset($MusselConfig['signatures']['fn_siglen_min']))$MusselConfig['signatures']['fn_siglen_min']=2;
if(!isset($MusselConfig['signatures']['fn_siglen_max']))$MusselConfig['signatures']['fn_siglen_max']=512;
if(!isset($MusselConfig['signatures']['rx_siglen_min']))$MusselConfig['signatures']['rx_siglen_min']=4;
if(!isset($MusselConfig['signatures']['rx_siglen_max']))$MusselConfig['signatures']['rx_siglen_max']=1024;
if(!isset($MusselConfig['signatures']['sd_siglen_min']))$MusselConfig['signatures']['sd_siglen_min']=4;
if(!isset($MusselConfig['signatures']['sd_siglen_max']))$MusselConfig['signatures']['sd_siglen_max']=1024;
if(!isset($MusselConfig['signatures']['fail_silently']))$MusselConfig['signatures']['fail_silently']=1;
if(!isset($MusselConfig['files']['max_uploads']))$MusselConfig['files']['max_uploads']=10;
if(!isset($MusselConfig['files']['filesize_limit']))$MusselConfig['files']['filesize_limit']=65536;
if(!isset($MusselConfig['files']['filesize_response']))$MusselConfig['files']['filesize_response']=1;
if(!isset($MusselConfig['files']['filetype_whitelist']))$MusselConfig['files']['filetype_whitelist']="";
if(!isset($MusselConfig['files']['filetype_blacklist']))$MusselConfig['files']['filetype_blacklist']="386,acc*,acm,act*,apk,app,ax,bat,bin,cgi,cmd,com*,cpl,csh,dll,drv,elf,exe,fxp,gad*,hta*,htp*,ico,inf,ins,inx,ipa,isu,job,js,jse,ksh,lnk,msc,msi,msp,mst,net,ocx,ops,org,osx,out,paf,php*,pif,pl,prg,ps1,reg,rgs,rs,run,scr*,sct,shb,shs,sql*,sys,u3p,url,vb,vbe,vbs*,wor*,ws,wsf,xsl";
if(!isset($MusselConfig['files']['filetype_greylist']))$MusselConfig['files']['filetype_greylist']="";
if(!isset($MusselConfig['files']['check_archives']))$MusselConfig['files']['check_archives']=1;
if(!isset($MusselConfig['files']['filesize_archives']))$MusselConfig['files']['filesize_archives']=1;
if(!isset($MusselConfig['files']['filetype_archives']))$MusselConfig['files']['filetype_archives']=0;
if(!isset($MusselConfig['files']['max_recursion']))$MusselConfig['files']['max_recursion']=10;
if(!isset($MusselConfig['attack_specific']['chameleon_from_php']))$MusselConfig['attack_specific']['chameleon_from_php']=1;
if(!isset($MusselConfig['attack_specific']['chameleon_from_exe']))$MusselConfig['attack_specific']['chameleon_from_exe']=1;
if(!isset($MusselConfig['attack_specific']['chameleon_to_archive']))$MusselConfig['attack_specific']['chameleon_to_archive']=1;
if(!isset($MusselConfig['attack_specific']['chameleon_to_doc']))$MusselConfig['attack_specific']['chameleon_to_doc']=1;
if(!isset($MusselConfig['attack_specific']['chameleon_to_img']))$MusselConfig['attack_specific']['chameleon_to_img']=1;
if(!isset($MusselConfig['attack_specific']['chameleon_to_pdf']))$MusselConfig['attack_specific']['chameleon_to_pdf']=1;
if(!isset($MusselConfig['attack_specific']['archive_file_extensions']))$MusselConfig['attack_specific']['archive_file_extensions']="7z,a,ace,alz,apk,app,ar,arc,arj,ba,bh,bz2,dmg,gz,ice,iso,lha,lz,lzh,lzo,lzw,lzx,mar,pak,pck,pea,rar,rz,s7z,sea,sen,sfx,shar,sqx,tar,tgz,tlz,xar,xp3,xz,yz1,z,zz";
if(!isset($MusselConfig['attack_specific']['archive_file_extensions_wc']))$MusselConfig['attack_specific']['archive_file_extensions_wc']="paq*,sit*,tbz*,zip*";
if(!isset($MusselConfig['attack_specific']['general_commands']))$MusselConfig['attack_specific']['general_commands']=0;
if(!isset($MusselConfig['attack_specific']['block_control_characters']))$MusselConfig['attack_specific']['block_control_characters']=0;
if(!isset($MusselConfig['attack_specific']['corrupted_exe']))$MusselConfig['attack_specific']['corrupted_exe']=1;
if(!isset($MusselConfig['attack_specific']['decode_threshold']))$MusselConfig['attack_specific']['decode_threshold']=512;
if(!isset($MusselConfig['attack_specific']['scannable_threshold']))$MusselConfig['attack_specific']['scannable_threshold']=32768;
if(!isset($MusselConfig['compatibility']['ignore_upload_errors']))$MusselConfig['compatibility']['ignore_upload_errors']=0;
if(!isset($MusselConfig['compatibility']['only_allow_images']))$MusselConfig['compatibility']['only_allow_images']=0;
$cli_args=array(isset($argv[0])?$argv[0]:"",isset($argv[1])?$argv[1]:"",isset($argv[2])?$argv[2]:"",isset($argv[3])?$argv[3]:"");
if(function_exists("phpMusselFork"))
	{
	if($cli_args[1]=="cli_win_scan")
		{
		$cmd=@strtolower((substr_count($cli_args[2]," "))?substrbf($cli_args[2]," "):$cli_args[2]);
		if($cmd=="scan")
			{
			echo phpMusselR(substr($cli_args[2],5),1,1,0,$cli_args[3]);
			die;
			}
		if($cmd=="md5_file")
			{
			$stl=substr($cli_args[2],strlen($cmd)+1);
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					echo $GLOBALS['MusselConfig']['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						if($d[$i]=="."||$d[$i]=="..")continue;
						echo phpMusselFork("md5_file ".$stl.$d[$i],$d[$i])."\n";
						}
					}
				}
			else if(@is_file($stl))
				{
				$hashme=@phpMusselFile($stl,0,1);
				echo md5($hashme).":".strlen($hashme).":YOUR-SIGNATURE-NAME";
				}
			else
				{
				echo $stl.$MusselConfig['lang']['cli_is_not_a']."\n";
				}
			}
		if($cmd=="coex_file")
			{
			$stl=substr($cli_args[2],strlen($cmd)+1);
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					echo $GLOBALS['MusselConfig']['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						if($d[$i]=="."||$d[$i]=="..")continue;
						echo phpMusselFork("coex_file ".$stl.$d[$i],$d[$i])."\n";
						}
					}
				}
			else if(@is_file($stl))
				{
				$hashme=@phpMusselFile($stl,0,1);
				echo "\$md5:".md5($hashme).";\$sha:".sha1($hashme).";\$str_len:".strlen($hashme).";YOUR-SIGNATURE-NAME";
				}
			else
				{
				echo $stl.$MusselConfig['lang']['cli_is_not_a']."\n";
				}
			}
		die;
		}
	}
function phpMussel($f="",$n=0,$zz=0,$dpt=0,$ofn="")
	{
	if(!$ofn)$ofn=$f;
	if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0)$s=date("r")." ".$GLOBALS['MusselConfig']['lang']['started'].".".$GLOBALS['linebreak'];
	$r=phpMusselR($f,$n,$zz,$dpt,$ofn);
	if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0&&!is_array($r))
		{
		$r=$s.$r.date("r")." ".$GLOBALS['MusselConfig']['lang']['finished'].".".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		if(!file_exists($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log']))$r="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$r;
		$xf=fopen($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log'],"a");
		fwrite($xf,$r);
		fclose($xf);
		}
	return $r;
	}
function phpMussel_mail($body="")
	{
	$f="";
	if(!$len=strlen($body))return -1;
	if(!isset($GLOBALS['memCache']['greylist']))
		{
		if(!file_exists($GLOBALS['vault']."greylist.csv"))
			{
			$GLOBALS['memCache']['greylist']=",";
			$glf=fopen($GLOBALS['vault']."greylist.csv","a");
			fwrite($glf,",");
			fclose($glf);
			unset($glf);
			}
		else
			{
			$GLOBALS['memCache']['greylist']=@implode_md(file($GLOBALS['vault']."greylist.csv"));
			}
		}
	$hex=@bin2hex($body);
	$hexlc=@bin2hex(strtolower($body));
	$hexlen=strlen($hexlc);
	if($GLOBALS['MusselConfig']['signatures']['mail_clamav'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_clamav_standard.cvd']))$GLOBALS['memCache']['mail_clamav_standard.cvd']=@file($GLOBALS['vault']."mail_clamav_standard.cvd");
			if(!$GLOBALS['memCache']['mail_clamav_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			if(!isset($GLOBALS['memCache']['mail_clamav_standard.map']))$GLOBALS['memCache']['mail_clamav_standard.map']=@file($GLOBALS['vault']."mail_clamav_standard.map");
			if(!$GLOBALS['memCache']['mail_clamav_standard.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_clamav_standard.map']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['mail_clamav_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['mail_clamav_standard.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($hexlen<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$hex;
								$this_strlc=$hexlc;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_strlc="\x01".$this_strlc;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_strlc=substr($this_strlc,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_strlc=substr($this_strlc,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_strlc,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_strlc,$xsig[$xsigi]))$this_strlc=substraf($this_strlc,$xsig[$xsigi].">");
										}
									}
								$this_strlc=$this_str=false;
								$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
								}
							}
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_clamav_regex.cvd']))$GLOBALS['memCache']['mail_clamav_regex.cvd']=@file($GLOBALS['vault']."mail_clamav_regex.cvd");
			if(!$GLOBALS['memCache']['mail_clamav_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			if(!isset($GLOBALS['memCache']['mail_clamav_regex.map']))$GLOBALS['memCache']['mail_clamav_regex.map']=@file($GLOBALS['vault']."mail_clamav_regex.map");
			if(!$GLOBALS['memCache']['mail_clamav_regex.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_clamav_regex.map']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['mail_clamav_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['mail_clamav_regex.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($hexlen<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
										}
									}
								else if($xstrf=="A")
									{
									if($xstrt=="*")
										{
										if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
										}
									else
										{
										if(!preg_match("/\A".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
										}
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
								}
							}
						}
					}
				}
			break;
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['mail_custom'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_custom_standard.cvd']))$GLOBALS['memCache']['mail_custom_standard.cvd']=@file($GLOBALS['vault']."mail_custom_standard.cvd");
			if(!$GLOBALS['memCache']['mail_custom_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_custom_standard.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="STR")
						{
						if(!substr_count($hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					if($hexlen<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						$this_str=$hex;
						$this_strlc=$hexlc;
						if($xstrf=="A")
							{
							$this_str="\x01".$this_str;
							$this_strlc="\x01".$this_strlc;
							$xsig[0]="\x01".$xsig[0];
							}
						else if($xstrf!="*")
							{
							$this_str=substr($this_str,$xstrf*2);
							$this_strlc=substr($this_strlc,$xstrf*2);
							}
						if($xstrt!="*")
							{
							$this_str=substr($this_str,0,$xstrt*2);
							$this_strlc=substr($this_strlc,0,$xstrt*2);
							}
						for($xsigi=0;$xsigi<$xsigc;$xsigi++)
							{
							if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_strlc,$xsig[$xsigi]))continue 2;
							if($xsigc>1)
								{
								if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
								if(substr_count($this_strlc,$xsig[$xsigi]))$this_strlc=substraf($this_strlc,$xsig[$xsigi].">");
								}
							}
						$this_strlc=$this_str=false;
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_custom_regex.cvd']))$GLOBALS['memCache']['mail_custom_regex.cvd']=@file($GLOBALS['vault']."mail_custom_regex.cvd");
			if(!$GLOBALS['memCache']['mail_custom_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_custom_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="STR")
						{
						if(!substr_count($hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					if($hexlen<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
						}
					}
				}
			break;
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['mail_mussel'])
		{
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_mussel_standard.cvd']))$GLOBALS['memCache']['mail_mussel_standard.cvd']=@file($GLOBALS['vault']."mail_mussel_standard.cvd");
			if(!$GLOBALS['memCache']['mail_mussel_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			if(!isset($GLOBALS['memCache']['mail_mussel_standard.map']))$GLOBALS['memCache']['mail_mussel_standard.map']=@file($GLOBALS['vault']."mail_mussel_standard.map");
			if(!$GLOBALS['memCache']['mail_mussel_standard.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_mussel_standard.map']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['mail_mussel_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<($map[2]+1);$xind++)
						{
						$xsig=$GLOBALS['memCache']['mail_mussel_standard.cvd'][$xind];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
							$xstrf=(isset($vn[2]))?$vn[2]:"*";
							$xstrt=(isset($vn[3]))?$vn[3]:"*";
							$vn=$vn[0];
							if($hexlen<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								$this_str=$hex;
								$this_strlc=$hexlc;
								if($xstrf=="A")
									{
									$this_str="\x01".$this_str;
									$this_strlc="\x01".$this_strlc;
									$xsig[0]="\x01".$xsig[0];
									}
								else if($xstrf!="*")
									{
									$this_str=substr($this_str,$xstrf*2);
									$this_strlc=substr($this_strlc,$xstrf*2);
									}
								if($xstrt!="*")
									{
									$this_str=substr($this_str,0,$xstrt*2);
									$this_strlc=substr($this_strlc,0,$xstrt*2);
									}
								for($xsigi=0;$xsigi<$xsigc;$xsigi++)
									{
									if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_strlc,$xsig[$xsigi]))continue 2;
									if($xsigc>1)
										{
										if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].">");
										if(substr_count($this_strlc,$xsig[$xsigi]))$this_strlc=substraf($this_strlc,$xsig[$xsigi].">");
										}
									}
								$this_strlc=$this_str=false;
								$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
								}
							}
						}
					}
				}
			break;
			}
		while(true)
			{
			if(!isset($GLOBALS['memCache']['mail_mussel_regex.cvd']))$GLOBALS['memCache']['mail_mussel_regex.cvd']=@file($GLOBALS['vault']."mail_mussel_regex.cvd");
			if(!$GLOBALS['memCache']['mail_mussel_regex.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_mussel_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_mussel_regex.cvd'][$i];
				if(substr($xsig,0,1)==">")
					{
					$xsig=explode(">",$xsig,4);
					$xsig[3]=($xsig[3]*-1)*-1;
					if($xsig[1]=="STR")
						{
						if(!substr_count($hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							}
						}
					else if(substr($xsig[1],0,1)=="\$")
						{
						$vf=substr($xsig[1],1);
						if(isset($$vf))if(!is_array($$vf))
							{
							if($$vf!=$xsig[2])
								{
								if($xsig[3]<=$i)break;
								$i=$xsig[3]-1;
								}
							continue;
							}
						if($xsig[3]<=$i)break;
						$i=$xsig[3]-1;
						}
					continue;
					}
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
					$xstrf=(isset($vn[2]))?$vn[2]:"*";
					$xstrt=(isset($vn[3]))?$vn[3]:"*";
					$vn=$vn[0];
					if($hexlen<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if($xstrf=="*")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
								}
							}
						else if($xstrf=="A")
							{
							if($xstrt=="*")
								{
								if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
								}
							else
								{
								if(!preg_match("/\A".$xsig."/i",substr($hex,0,$xstrt*2))&&!preg_match("/\A".$xsig."/i",substr($hexlc,0,$xstrt*2)))continue;
								}
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($hex,$xstrf*2,$xstrt*2))&&!preg_match("/".$xsig."/i",substr($hexlc,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".vn_shorthand($vn)."! ";
						}
					}
				}
			break;
			}
		}
	return (!$f)?0:$f;
	}
$c=empty($_FILES)?0:count($_FILES);
$xfm=$xsk=$xpe="";
if($c>0&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
	{
	if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
		{
		if($MusselConfig['general']['scan_log'])$s=date("r")." ".$MusselConfig['lang']['started'].".".$GLOBALS['linebreak'];
		for($i=0;$i<$c;$i++)
			{
			$k=key($_FILES);
			if($MusselConfig['compatibility']['ignore_upload_errors'])
				{
				if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))continue;
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				$xsk.="-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
				$xfm.=$MusselConfig['lang']['upload_limit_exceeded']." (".$_FILES[$k]['name'].")! ";
				if($_FILES[$k]['error']>0)continue;
				if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
				}
			else if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))
				{
				$xsk.="UNAUTHORISED-FILE-UPLOAD--CONFIG:?:?".$GLOBALS['linebreak'];
				$xfm.=$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig'];
				}
			else
				{
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				if($_FILES[$k]['error']==1)
					{
					$xsk.="---------UPLOAD-ERROR-1---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_1'];
					if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($_FILES[$k]['tmp_name']))@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==2)
					{
					$xsk.="---------UPLOAD-ERROR-2---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_2'];
					if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($_FILES[$k]['tmp_name']))@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==3)
					{
					$xsk.="---------UPLOAD-ERROR-3---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_34'];
					}
				else if($_FILES[$k]['error']==4)
					{
					$xsk.="---------UPLOAD-ERROR-4---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_34'];
					}
				else if($_FILES[$k]['error']==6)
					{
					$xsk.="---------UPLOAD-ERROR-6---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_6'];
					}
				else if($_FILES[$k]['error']==7)
					{
					$xsk.="---------UPLOAD-ERROR-7---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_7'];
					}
				else if($_FILES[$k]['error']==8)
					{
					$xsk.="---------UPLOAD-ERROR-8---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_8'];
					}
				else if(!is_uploaded_file($_FILES[$k]['tmp_name']))
					{
					$xsk.="UNAUTHORISED-FILE-UPLOAD-NO-HASH:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['scan_unauthorised_upload']." (".$_FILES[$k]['name'].")! ";
					}
				else
					{
					$xsk.="-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_limit_exceeded']." (".$_FILES[$k]['name'].")! ";
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				}
			}
		if($MusselConfig['general']['scan_log'])
			{
			if(!file_exists($vault.$MusselConfig['general']['scan_log']))$s="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$s;
			$s.="> ".$MusselConfig['lang']['upload_limit_exceeded']."! ".$MusselConfig['lang']['scan_aborted'];
			if($MusselConfig['general']['scan_kills'])$s.=$MusselConfig['lang']['refer_to_scan_kills'];
			$s.=$GLOBALS['linebreak'].date("r")." ".$MusselConfig['lang']['finished'].".".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
			$xf=fopen($vault.$MusselConfig['general']['scan_log'],"a");
			fwrite($xf,$s);
			fclose($xf);
			}
		}
	else
		{
		for($i=0;$i<$c;$i++)
			{
			$k=key($_FILES);
			if($MusselConfig['compatibility']['ignore_upload_errors'])
				{
				if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))continue;
				if($_FILES[$k]['error']>0)continue;
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				$r=phpMussel($_FILES[$k]['tmp_name'],2,1,0,$_FILES[$k]['name']);
				}
			else if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))
				{
				$xsk.="UNAUTHORISED-FILE-UPLOAD--CONFIG:?:?".$GLOBALS['linebreak'];
				$xfm.=$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig'];
				}
			else
				{
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				if($_FILES[$k]['error']==1)
					{
					$xsk.="---------UPLOAD-ERROR-1---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_1'];
					if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($_FILES[$k]['tmp_name']))@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==2)
					{
					$xsk.="---------UPLOAD-ERROR-2---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_2'];
					if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($_FILES[$k]['tmp_name']))@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==3)
					{
					$xsk.="---------UPLOAD-ERROR-3---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_3'];
					}
				else if($_FILES[$k]['error']==4)
					{
					$xsk.="---------UPLOAD-ERROR-4---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_3'];
					}
				else if($_FILES[$k]['error']==6)
					{
					$xsk.="---------UPLOAD-ERROR-6---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_6'];
					}
				else if($_FILES[$k]['error']==7)
					{
					$xsk.="---------UPLOAD-ERROR-7---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_7'];
					}
				else if($_FILES[$k]['error']==8)
					{
					$xsk.="---------UPLOAD-ERROR-8---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['upload_error_8'];
					}
				else if(!is_uploaded_file($_FILES[$k]['tmp_name']))
					{
					$xsk.="UNAUTHORISED-FILE-UPLOAD-NO-HASH:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$MusselConfig['lang']['scan_unauthorised_upload']." (".$_FILES[$k]['name'].")! ";
					}
				else
					{
					$r=phpMussel($_FILES[$k]['tmp_name'],2,1,0,$_FILES[$k]['name']);
					}
				}
			}
		}
	}
else if($c>0&&$MusselConfig['general']['honeypot_mode'])
	{
	$hpd="== HONEYPOT EVENT ==".$GLOBALS['linebreak']."DATE: ".date("r").$GLOBALS['linebreak']."IP ADDRESS: ".$_SERVER[$MusselConfig['general']['ipaddr']].$GLOBALS['linebreak'].$GLOBALS['linebreak'];
	if($MusselConfig['general']['quarantine_key'])for($i=0;$i<$c;$i++)
		{
		$k=key($_FILES);
		if(isset($_FILES[$k]['name'])&&isset($_FILES[$k]['tmp_name'])&&isset($_FILES[$k]['size']))
			{
			if(isset($_FILES[$k]['error']))$_FILES[$k]['error']=0;
			$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
			if($_FILES[$k]['error']===0)if(is_uploaded_file($_FILES[$k]['tmp_name']))
				{
				$str=phpMusselFile($_FILES[$k]['tmp_name']);
				$str_len=str_len($str);
				$crc=@hash("crc32b",$str);
				$qfu=time()."-".md5($MusselConfig['general']['quarantine_key'].$crc.time());
				if($str_len>0&&$str_len<($MusselConfig['general']['quarantine_max_filesize']*1024))@phpMusselQ($str,$MusselConfig['general']['quarantine_key'],$_SERVER[$MusselConfig['general']['ipaddr']],$qfu);
				if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
				$hpd.="TEMP FILENAME: ".$_FILES[$k]['tmp_name'].$GLOBALS['linebreak']."FILENAME: ".$_FILES[$k]['name'].$GLOBALS['linebreak']."FILESIZE: ".$str_len.$GLOBALS['linebreak']."MD5: ".md5($str).$GLOBALS['linebreak']."QUARANTINED AS: \"/vault/quarantine/".$qfu.".qfu\"".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
				}
			}
		}
	if(!file_exists($vault.$MusselConfig['general']['scan_kills']))$hpd="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$hpd;
	$hpf=fopen($vault.$MusselConfig['general']['scan_kills'],"a");
	fwrite($hpf,$hpd);
	fclose($hpf);
	unset($hpf,$qfu,$crc,$str_len,$str,$hpd);
	}
if(strlen($xfm)>0)
	{
	$MusselConfig['template_data']['detected']=$xfm=trim($xfm);
	$MusselConfig['template_data']['phpmusselversion']=$phpmusselversion;
	if($MusselConfig['general']['scan_kills']&&strlen($xsk)>0)
		{
		$skd="";
		if(!file_exists($vault.$MusselConfig['general']['scan_kills']))$skd="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skd.="DATE: ".date("r").$GLOBALS['linebreak']."IP ADDRESS: ".$_SERVER[$MusselConfig['general']['ipaddr']].$GLOBALS['linebreak']."== SCAN RESULTS / REASONS BLOCKED ==".$GLOBALS['linebreak'].$xfm.$GLOBALS['linebreak']."== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==".$GLOBALS['linebreak'].$xsk;
		if($xpe)$skd.="== PE SECTIONAL SIGNATURES RECONSTRUCTION (SECTION-SIZE:SECTION-HASH:FILE-NAME--SECTION-NAME) ==".$GLOBALS['linebreak'].$xpe;
		$skd.=$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skf=fopen($vault.$MusselConfig['general']['scan_kills'],"a");
		fwrite($skf,$skd);
		fclose($skf);
		}
	if(!file_exists($vault."template.html"))plaintext_echo_die("[phpMussel] ".$MusselConfig['lang']['denied']." ".$MusselConfig['template_data']['detected']);
	if($MusselConfig['general']['forbid_on_block'])
		{
		header("HTTP/1.0 403 Forbidden");
		header("HTTP/1.1 403 Forbidden");
		header("Status: 403 Forbidden");
		}
	$html=implode_md(file($vault."template.html"));
	$tc=count($MusselConfig['template_data']);
	reset($MusselConfig['template_data']);
	for($ti=0;$ti<$tc;$ti++)
		{
		$tk=key($MusselConfig['template_data']);
		$html=str_replace("{".$tk."}",$MusselConfig['template_data'][$tk],$html);
		next($MusselConfig['template_data']);
		}
	$tc=count($MusselConfig['lang']);
	reset($MusselConfig['lang']);
	for($ti=0;$ti<$tc;$ti++)
		{
		$tk=key($MusselConfig['lang']);
		$html=str_replace("{".$tk."}",$MusselConfig['lang'][$tk],$html);
		next($MusselConfig['lang']);
		}
	$html=str_replace("\t","",str_replace("\n","",str_replace("\r","",$html)));
	die($html);
	}
if(function_exists("phpMusselFork")&&strlen(mussel_php)>0&&mussel_os=="WIN"&&mussel_sapi=="cli")
	{
	echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'].$MusselConfig['lang']['cli_ln3'];
	$sth=fopen("php://stdin","r");
	while(true)
		{
		if(function_exists("cli_set_process_title"))@cli_set_process_title($phpmusselversion);
		echo $MusselConfig['lang']['cli_prompt'];
		$stl=trim(fgets($sth));
		if(function_exists("cli_set_process_title"))@cli_set_process_title($phpmusselversion." - ".$MusselConfig['lang']['cli_working']."...");
		$cmd=@strtolower((substr_count($stl," "))?substrbf($stl," "):$stl);
		if($cmd=="quit"||$cmd=="q"||$cmd=="exit")die;
		if($cmd=="md5_file"||$cmd=="m")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					echo $MusselConfig['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						if($d[$i]=="."||$d[$i]=="..")continue;
						echo phpMusselFork("md5_file ".$stl.$d[$i],$d[$i])."\n";
						}
					}
				}
			else if(@is_file($stl))
				{
				$hashme=@phpMusselFile($stl,0,1);
				echo md5($hashme).":".strlen($hashme).":YOUR-SIGNATURE-NAME";
				}
			else
				{
				echo $stl.$MusselConfig['lang']['cli_is_not_a']."\n";
				}
			}
		if($cmd=="coex_file")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					echo $MusselConfig['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						if($d[$i]=="."||$d[$i]=="..")continue;
						echo phpMusselFork("coex_file ".$stl.$d[$i],$d[$i])."\n";
						}
					}
				}
			else if(@is_file($stl))
				{
				$hashme=@phpMusselFile($stl,0,1);
				echo "\$md5:".md5($hashme).";\$sha:".sha1($hashme).";\$str_len:".strlen($hashme).";YOUR-SIGNATURE-NAME";
				}
			else
				{
				echo $stl.$MusselConfig['lang']['cli_is_not_a']."\n";
				}
			}
		if($cmd=="md5")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo md5($stl).":".strlen($stl).":YOUR-SIGNATURE-NAME";
			}
		if($cmd=="coex")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo "\$md5:".md5($stl).";\$sha:".sha1($stl).";\$str_len:".strlen($stl).";YOUR-SIGNATURE-NAME";
			}
		if($cmd=="hex_encode"||$cmd=="x")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo @bin2hex($stl)."\n";
			}
		if($cmd=="hex_decode")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo @hex2bin($stl)."\n";
			}
		if($cmd=="base64_encode"||$cmd=="b")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo @base64_encode($stl)."\n";
			}
		if($cmd=="base64_decode")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo @base64_decode($stl)."\n";
			}
		if($cmd=="scan"||$cmd=="s")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			$r="";
			if($MusselConfig['general']['scan_log'])
				{
				$s=date("r")." ".$MusselConfig['lang']['started'].".\n";
				echo $s;
				}
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					if(!$out)$out="> ".$MusselConfig['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						if($d[$i]=="."||$d[$i]=="..")continue;
						$pcent=@round(($i/$c)*100,2)."%";
						echo $pcent." ".$MusselConfig['lang']['scan_complete'].".";
						$out=phpMusselFork("scan ".$stl.$d[$i],$d[$i]);
						if(!$out)$out="> ".$MusselConfig['lang']['cli_failed_to_complete']." (".$d[$i].")!\n";
						$r.=$out;
						echo "\r".prescan_decode($out);
						$out="";
						}
					}
				}
			else if(@is_file($stl))
				{
				$out=phpMusselFork("scan ".$stl,$stl);
				if(!$out)$out="> ".$MusselConfig['lang']['cli_failed_to_complete']."!\n";
				}
			else
				{
				if(!$out)$out="> ".$stl.$MusselConfig['lang']['cli_is_not_a']."\n";
				}
			$r.=$out;
			if($out)
				{
				echo prescan_decode($out);
				$out="";
				}
			if($MusselConfig['general']['scan_log'])
				{
				$r=$s.$r;
				$s=date("r")." ".$MusselConfig['lang']['finished']."."."\n\n";
				echo $s;
				$r=$r.$s;
				if(!file_exists($vault.$MusselConfig['general']['scan_log']))$r="<?php die(); ?>"."\n\n".$r;
				$xf=fopen($vault.$MusselConfig['general']['scan_log'],"a");
				fwrite($xf,$r);
				fclose($xf);
				}
			}
		if($cmd=="update"||$cmd=="u")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			$is_cli=true;
			$phpmusselversion_preserved=$phpmusselversion;
			$musselvar="";
			if(!file_exists($vault."update.inc"))
				{
				echo $MusselConfig['lang']['update_scriptfile_missing'];
				}
			else
				{
				require($vault."update.inc");
				echo "\n\n".$MusselConfig['lang']['cli_update_restart'];
				}
			$phpmusselversion=$phpmusselversion_preserved;
			}
		if($cmd=="forcedupdate"||$cmd=="f")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			$is_cli=true;
			$phpmusselversion_preserved=$phpmusselversion;
			$musselvar="forcedupdate";
			if(!file_exists($vault."update.inc"))
				{
				echo $MusselConfig['lang']['update_scriptfile_missing'];
				}
			else
				{
				require($vault."update.inc");
				echo "\n\n".$MusselConfig['lang']['cli_update_restart'];
				}
			$phpmusselversion=$phpmusselversion_preserved;
			}
		if($cmd=="greylist"||$cmd=="g")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			if(!empty($stl))
				{
				$greylist=(!file_exists($vault."greylist.csv"))?",":"";
				$greylist.=$stl.",";
				$greylistf=fopen($vault."greylist.csv","a");
				fwrite($greylistf,$greylist);
				fclose($greylistf);
				unset($greylistf,$greylist);
				echo " Greylist updated.";
				}
			}
		if($cmd=="greylist_clear"||$cmd=="gc")
			{
			echo "\n\n";
			$greylistf=fopen($vault."greylist.csv","a");
			ftruncate($greylistf,0);
			fwrite($greylistf,",");
			fclose($greylistf);
			unset($greylistf,$greylist);
			echo " Greylist cleared.";
			}
		if($cmd=="greylist_show"||$cmd=="gs")
			{
			echo "\n\n";
			$stl=substr($stl,strlen($cmd)+1);
			echo (file_exists($vault."greylist.csv"))?" greylist.csv:\n\n".implode("\n ",explode(",",phpMusselFile($vault."greylist.csv"))):" greylist.csv ".$MusselConfig['lang']['x_does_not_exist']."!";
			}
		if($cmd=="c")echo $MusselConfig['lang']['cli_commands'];
		}
	die;
	}
@ini_set("display_errors",$inidefaults);
if(strlen($inidefaults['backtrack_limit']))@ini_set("pcre.backtrack_limit",$inidefaults['backtrack_limit']);
@ini_set("user_agent",$inidefaults['user_agent']);
if($MusselConfig['general']['cleanup'])unset($cli_args,$tk,$ti,$tc,$r,$xpe,$xsk,$xfm,$k,$i,$c,$memCache,$inidefaults,$phpmusselversion);

?>