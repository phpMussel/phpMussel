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
 This File: phpMussel v0.4c (28th August 2014) Core Script

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

$phpmusselversion="phpMussel v0.4c";
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
			else
				{
				if(!(!$e&&!$ar[$key]))$out.=$x.$ar[$key];
				}
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
	if(!$l)$l=@strlen($str);
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
function prescan_normalise($str,$html=0)
	{
	$str=@preg_replace("/[^\x21-\x7e]/","",strtolower(prescan_decode($str)));
	if($html)
		{
		$str=@preg_replace(array("@<script[^>]*?>.*?</script>@si","@<[\/\!]*?[^<>]*?>@si","@<style[^>]*?>.*?</style>@siU","@<![\s\S]*?--[ \t\n\r]*>@"),"",$str);
		}
	return trim($str);
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
function phpMusselD($str="",$n=0,$dpt=0,$ofn="")
	{
	$fm=($n==2)?1:0;
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
	if(!$ofn)
		{
		$out.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_missing_filename']."!".$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_missing_filename']."! ";
		return (!$n)?2:$out;
		}
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
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
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
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
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
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			$i++;
			}
		}
	if(!$str_len)return 1;
	if($GLOBALS['MusselConfig']['signatures']['md5_clamav'])
		{
		if(!isset($GLOBALS['memCache']['md5_clamav.cvd']))$GLOBALS['memCache']['md5_clamav.cvd']=@implode_md(file($GLOBALS['vault']."md5_clamav.cvd"));
		if(!$GLOBALS['memCache']['md5_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (md5_clamav.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['md5_clamav.cvd'],$md5));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":",$GLOBALS['memCache']['md5_clamav.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$xsig=explode(":",$xsig[0],2);
					if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]." (".$ofn.")! ";
						}
					$xsig="";
					}
				}
			$xmatches="";
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
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['md5_custom.cvd'],$md5));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":",$GLOBALS['memCache']['md5_custom.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$xsig=explode(":",$xsig[0],2);
					if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]." (".$ofn.")! ";
						}
					$xsig="";
					}
				}
			$xmatches="";
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
			$xmatches=array("c"=>substr_count($GLOBALS['memCache']['md5_mussel.cvd'],$md5));
			if($xmatches['c']>0)
				{
				$xmatches['c']++;
				$xmatches['d']=explode($md5.":",$GLOBALS['memCache']['md5_mussel.cvd']);
				for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
					{
					$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
					$xsig=explode(":",$xsig[0],2);
					if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
						{
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig[1]." (".$ofn.")! ";
						}
					$xsig="";
					}
				}
			$xmatches="";
			}
		}
	$str_hex=@bin2hex($str);
	$str_hex_len=@strlen($str_hex);
	$str_norm=@bin2hex(prescan_normalise($str,0));
	$str_norm_len=@strlen($str_norm);
	if($GLOBALS['MusselConfig']['signatures']['html_clamav']||$GLOBALS['MusselConfig']['signatures']['html_custom']||$GLOBALS['MusselConfig']['signatures']['html_mussel'])
		{
		$chkmagic=false;
		if(!$chkmagic)if(substr_count($str_norm,"3c21646f6374797065"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c68746d6c"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c68656164"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c626f6479"))$chkmagic=true;
		if(!$chkmagic)if(substr_count($str_norm,"3c7469746c65"))$chkmagic=true;
		if($chkmagic)
			{
			$str_html=@bin2hex(prescan_normalise($str,1));
			$str_html_len=@strlen($str_html);
			if($GLOBALS['MusselConfig']['signatures']['html_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
						$map=explode(":",$GLOBALS['memCache']['html_clamav_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_html,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
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
										if($xsigc===1)
											{
											if($xstrf=="*")
												{
												if(!substr_count($str_html,$xsig[0]))continue;
												}
											else
												{
												if($xstrt=="*")
													{
													if(!substr_count(substr($str_html,$xstrf*2),$xsig[0]))continue;
													}
												else
													{
													if(!substr_count(substr($str_html,$xstrf*2,$xstrt*2),$xsig[0]))continue;
													}
												}
											}
										else
											{
											$this_str_html=$str_html;
											for($xsigi=0;$xsigi<$xsigc;$xsigi++)
												{
												if(!($xstrf=="*"||$xsigi>0))$this_str_html=@($xstrt=="*")?substr($this_str_html,$xstrf*2):substr($this_str_html,$xstrf*2,$xstrt*2);
												if(!substr_count($this_str_html,$xsig[$xsigi]))continue 2;
												$this_str_html=substraf($this_str_html,$xsig[$xsigi].">");
												}
											$this_str_html=false;
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
						$map=explode(":",$GLOBALS['memCache']['html_clamav_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_html,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
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
											if(!preg_match("/".$xsig."/i",$str_html))continue;
											}
										else if($xstrf=="A")
											{
											if(!preg_match("/\A".$xsig."/i",$str_html))continue;
											}
										else
											{
											if($xstrt=="*")
												{
												if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2)))continue;
												}
											else
												{
												if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2)))continue;
												}
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['html_custom'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_html,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_html,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_html,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_html=$str_html;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_html=@($xstrt=="*")?substr($this_str_html,$xstrf*2):substr($this_str_html,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_html,$xsig[$xsigi]))continue 2;
										$this_str_html=substraf($this_str_html,$xsig[$xsigi].">");
										}
									$this_str_html=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_html))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_html))continue;
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['html_mussel'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_html,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_html,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_html,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_html=$str_html;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if($xsig[$xsigi])
											{
											if(!($xstrf=="*"||$xsigi>0))$this_str_html=@($xstrt=="*")?substr($this_str_html,$xstrf*2):substr($this_str_html,$xstrf*2,$xstrt*2);
											if(!substr_count($this_str_html,$xsig[$xsigi]))continue 2;
											$this_str_html=substraf($this_str_html,$xsig[$xsigi].">");
											}
										}
									$this_str_html=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_html,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_html))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_html))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_html))continue;
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_html,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			unset($str_html_len,$str_html);
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['general_clamav'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
				$map=explode(":",$GLOBALS['memCache']['general_clamav_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
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
							if($str_hex_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
				$map=explode(":",$GLOBALS['memCache']['general_clamav_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
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
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['general_custom'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($str_hex,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_str_hex=$str_hex;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
								if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
								$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
								}
							$this_str_hex=false;
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$str_hex))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['general_mussel'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($str_hex,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_str_hex=$str_hex;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if($xsig[$xsigi])
									{
									if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
									if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
									$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
									}
								}
							$this_str_hex=false;
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_hex,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$str_hex))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['ascii_clamav'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
				$map=explode(":",$GLOBALS['memCache']['ascii_clamav_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_norm,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
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
							if($str_norm_len<$xlen)continue;
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
								$xsigc=count($xsig);
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_norm,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_norm,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_norm,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_norm=$str_norm;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_norm=@($xstrt=="*")?substr($this_str_norm,$xstrf*2):substr($this_str_norm,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_norm,$xsig[$xsigi]))continue 2;
										$this_str_norm=substraf($this_str_norm,$xsig[$xsigi].">");
										}
									$this_str_norm=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
				$map=explode(":",$GLOBALS['memCache']['ascii_clamav_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_norm,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
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
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if($xstrf=="*")
									{
									if(!preg_match("/".$xsig."/i",$str_norm))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_norm))continue;
									}
								else
									{
									if($xstrt=="*")
										{
										if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
										}
									else
										{
										if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
										}
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['ascii_custom'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
					if($str_norm_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($str_norm,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($str_norm,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($str_norm,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_str_norm=$str_norm;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if(!($xstrf=="*"||$xsigi>0))$this_str_norm=@($xstrt=="*")?substr($this_str_norm,$xstrf*2):substr($this_str_norm,$xstrf*2,$xstrt*2);
								if(!substr_count($this_str_norm,$xsig[$xsigi]))continue 2;
								$this_str_norm=substraf($this_str_norm,$xsig[$xsigi].">");
								}
							$this_str_norm=false;
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$str_norm))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$str_norm))continue;
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['ascii_mussel'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
					if($str_norm_len<$xlen)continue;
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						$xsig=@(substr_count($xsig,">")>0)?explode(">",$xsig):array(0=>$xsig);
						$xsigc=count($xsig);
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($str_norm,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($str_norm,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($str_norm,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_str_norm=$str_norm;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if($xsig[$xsigi])
									{
									if(!($xstrf=="*"||$xsigi>0))$this_str_norm=@($xstrt=="*")?substr($this_str_norm,$xstrf*2):substr($this_str_norm,$xstrf*2,$xstrt*2);
									if(!substr_count($this_str_norm,$xsig[$xsigi]))continue 2;
									$this_str_norm=substraf($this_str_norm,$xsig[$xsigi].">");
									}
								}
							$this_str_norm=false;
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="FS-MIN")
						{
						if($str_len<$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FS-MAX")
						{
						if($str_len>$xsig[2])
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD")
						{
						if(!substr_count($str_norm,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="FD-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$str_norm))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$str_norm))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$str_norm))continue;
							}
						else
							{
							if($xstrt=="*")
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2)))continue;
								}
							else
								{
								if(!preg_match("/".$xsig."/i",substr($str_norm,$xstrf*2,$xstrt*2)))continue;
								}
							}
						$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		}
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
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_php'])
		{
		if(!(substr_count(",php*,",",".$xts.",")>0||substr_count(",php*,",",".$gzxts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].",",",".$xts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].",",",".$gzxts.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].",",",".$gzxt.",")>0))
			{
			if(substr_count($str_norm,"3c3f706870")>0)
				{
				$out.=$lnap."PHP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="PHP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_exe'])
		{
		if(substr_count(",exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",",".$xt.",")>0)
			{
			if(substr($str,0,2)!=="MZ")
				{
				$out.=$lnap."EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str,0,2)==="MZ")
				{
				$out.=$lnap."EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="EXE ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="elf")
			{
			if(substr($str_hex,0,8)!=="7f454c46")
				{
				$out.=$lnap."ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str_hex,0,8)==="7f454c46")
				{
				$out.=$lnap."ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ELF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="lnk")
			{
			if(substr($str_hex,0,16)!=="4c00000001140200")
				{
				$out.=$lnap."LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str_hex,0,16)==="4c00000001140200")
				{
				$out.=$lnap."LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="LNK ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="msi")
			{
			if(substr($str_hex,0,16)!=="d0cf11e0a1b11ae1")
				{
				$out.=$lnap."MSI ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="MSI ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
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
				$PEArr['NumOfSections']=$PEArr['NumOfSections'][1];
				if($PEArr['NumOfSections']<1||$PEArr['NumOfSections']>40)$PEArr['DoScan']=false;
				break;
				}
			if(!$PEArr['DoScan']&&$GLOBALS['MusselConfig']['attack_specific']['corrupted_exe'])
				{
				$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$GLOBALS['MusselConfig']['lang']['corrupted']." PE!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$GLOBALS['MusselConfig']['lang']['corrupted']." PE (".$ofn.")! ";
				}
			if($PEArr['DoScan']&&($GLOBALS['MusselConfig']['signatures']['pe_clamav']||$GLOBALS['MusselConfig']['signatures']['pe_custom']||$GLOBALS['MusselConfig']['signatures']['pe_mussel']))
				{
				$PEArr['OptHdrSize']=@unpack("S",substr($str,$PEArr['Offset']+20,2));
				$PEArr['OptHdrSize']=$PEArr['OptHdrSize'][1];
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
					if($GLOBALS['MusselConfig']['signatures']['pe_clamav'])
						{
						if(!isset($GLOBALS['memCache']['pe_clamav.cvd']))$GLOBALS['memCache']['pe_clamav.cvd']=@implode_md(file($GLOBALS['vault']."pe_clamav.cvd"));
						if(!$GLOBALS['memCache']['pe_clamav.cvd'])
							{
							if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing']." (pe_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						else
							{
							$xmatches=array("c"=>substr_count($GLOBALS['memCache']['pe_clamav.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5']));
							if($xmatches['c']>0)
								{
								$xmatches['c']++;
								$xmatches['d']=explode($PEArr['SizeOfRawData'].":".$PEArr['MD5'].":",$GLOBALS['memCache']['pe_clamav.cvd']);
								for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
									{
									$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],1);
									$xsig=$xsig[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
										{
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
										}
									$xsig="";
									}
								}
							$xmatches="";
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
							$xmatches=array("c"=>substr_count($GLOBALS['memCache']['pe_custom.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5']));
							if($xmatches['c']>0)
								{
								$xmatches['c']++;
								$xmatches['d']=explode($PEArr['SizeOfRawData'].":".$PEArr['MD5'].":",$GLOBALS['memCache']['pe_custom.cvd']);
								for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
									{
									$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],1);
									$xsig=$xsig[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
										{
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
										}
									$xsig="";
									}
								}
							$xmatches="";
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
							$xmatches=array("c"=>substr_count($GLOBALS['memCache']['pe_mussel.cvd'],$PEArr['SizeOfRawData'].":".$PEArr['MD5']));
							if($xmatches['c']>0)
								{
								$xmatches['c']++;
								$xmatches['d']=explode($PEArr['SizeOfRawData'].":".$PEArr['MD5'].":",$GLOBALS['memCache']['pe_mussel.cvd']);
								for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
									{
									$xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],1);
									$xsig=$xsig[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$xsig.","))
										{
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$xsig." (".$ofn.")! ";
										}
									$xsig="";
									}
								}
							$xmatches="";
							}
						}
					}
				}
			$PEArr=false;
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['exe_clamav']||$GLOBALS['MusselConfig']['signatures']['exe_custom']||$GLOBALS['MusselConfig']['signatures']['exe_mussel'])
		{
		if(substr_count(",exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",",".$xt.",")>0||substr($str,0,2)==="MZ")
			{
			if($GLOBALS['MusselConfig']['signatures']['exe_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
										if($xsigc===1)
											{
											if($xstrf=="*")
												{
												if(!substr_count($str_hex,$xsig[0]))continue;
												}
											else
												{
												if($xstrt=="*")
													{
													if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
													}
												else
													{
													if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
													}
												}
											}
										else
											{
											$this_str_hex=$str_hex;
											for($xsigi=0;$xsigi<$xsigc;$xsigi++)
												{
												if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
												if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
												$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
												}
											$this_str_hex=false;
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
											if(!preg_match("/".$xsig."/i",$str_hex))continue;
											}
										else if($xstrf=="A")
											{
											if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['exe_custom'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['exe_mussel'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['elf_clamav']||$GLOBALS['MusselConfig']['signatures']['elf_custom']||$GLOBALS['MusselConfig']['signatures']['elf_mussel'])
		{
		if($xt=="elf"||substr($str_hex,0,8)==="7f454c46")
			{
			if($GLOBALS['MusselConfig']['signatures']['elf_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
										if($xsigc===1)
											{
											if($xstrf=="*")
												{
												if(!substr_count($str_hex,$xsig[0]))continue;
												}
											else
												{
												if($xstrt=="*")
													{
													if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
													}
												else
													{
													if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
													}
												}
											}
										else
											{
											$this_str_hex=$str_hex;
											for($xsigi=0;$xsigi<$xsigc;$xsigi++)
												{
												if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
												if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
												$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
												}
											$this_str_hex=false;
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
											if(!preg_match("/".$xsig."/i",$str_hex))continue;
											}
										else if($xstrf=="A")
											{
											if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['elf_custom'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['elf_mussel'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
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
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="rar")
			{
			if(substr($str,0,4)!=="Rar!")
				{
				$out.=$lnap."RAR ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="RAR ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="gz")
			{
			if(substr($str_hex,0,4)!=="1f8b")
				{
				$out.=$lnap."GZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="GZIP ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="bz2")
			{
			if(substr($str_hex,0,6)!=="425a68")
				{
				$out.=$lnap."BZIP2 ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
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
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
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
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="png")
			{
			if(substr($str_hex,0,16)!=="89504e470d0a1a0a")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="jp2")
			{
			if(substr($str_hex,0,16)!=="0000000c6a502020")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="jfi"||$xt=="jfif"||$xt=="jif"||$xt=="jpe"||$xt=="jpeg"||$xt=="jpg")
			{
			if(substr($str_hex,0,6)!=="ffd8ff")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="gif")
			{
			if(substr($str_hex,0,12)!=="474946383761"&&substr($str_hex,0,12)!=="474946383961")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="xcf")
			{
			if(!substr($str,0,8)==="gimp xcf")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		if($xt=="psd"||$xt=="pdd")
			{
			if(!substr($str,0,4)==="8BPS")
				{
				$out.=$lnap."Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_pdf'])
		{
		if($xt=="pdf")
			{
			if(substr($str_hex,0,8)!=="25504446")
				{
				$out.=$lnap."PDF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']."!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="PDF ".$GLOBALS['MusselConfig']['lang']['scan_chameleon']." (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['general_commands'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['scan_command_injection'].", '".urlencode($xgc)."' (".$ofn.")! ";
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['graphics_clamav']||$GLOBALS['MusselConfig']['signatures']['graphics_custom']||$GLOBALS['MusselConfig']['signatures']['graphics_mussel'])
		{
		$chkmagic=false;
		if(!$chkmagic)if(substr($str_hex,0,6)==="ffd8ff")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,12)==="474946383761"||substr($str_hex,0,12)==="474946383961")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,16)==="89504e470d0a1a0a")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,8)==="25504446")$chkmagic=true;
		if(!$chkmagic)if(substr($str,0,2)==="BM"||substr($str,0,8)==="gimp xcf"||substr($str,0,4)==="8BPS"||substr($str,0,4)==="WEBP")$chkmagic=true;
		if(!$chkmagic)if(substr($str_hex,0,16)==="0000000c6a502020")$chkmagic=true;
		if(substr_count(",avi,bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mov,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,",",".$xt.",")>0||$chkmagic)
			{
			if($GLOBALS['MusselConfig']['signatures']['graphics_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
										if($xsigc===1)
											{
											if($xstrf=="*")
												{
												if(!substr_count($str_hex,$xsig[0]))continue;
												}
											else
												{
												if($xstrt=="*")
													{
													if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
													}
												else
													{
													if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
													}
												}
											}
										else
											{
											$this_str_hex=$str_hex;
											for($xsigi=0;$xsigi<$xsigc;$xsigi++)
												{
												if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
												if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
												$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
												}
											$this_str_hex=false;
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
											if(!preg_match("/".$xsig."/i",$str_hex))continue;
											}
										else if($xstrf=="A")
											{
											if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['graphics_custom'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['graphics_mussel'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['macho_clamav']||$GLOBALS['MusselConfig']['signatures']['macho_custom']||$GLOBALS['MusselConfig']['signatures']['macho_mussel'])
		{
		if(substr_count(",cafebabe,cafed00d,cefaedfe,cffaedfe,feedface,feedfacf,",",".substr($str_hex,0,8).",")>0)
			{
			if($GLOBALS['MusselConfig']['signatures']['macho_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
										if($xsigc===1)
											{
											if($xstrf=="*")
												{
												if(!substr_count($str_hex,$xsig[0]))continue;
												}
											else
												{
												if($xstrt=="*")
													{
													if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
													}
												else
													{
													if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
													}
												}
											}
										else
											{
											$this_str_hex=$str_hex;
											for($xsigi=0;$xsigi<$xsigc;$xsigi++)
												{
												if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
												if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
												$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
												}
											$this_str_hex=false;
											}
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
							for($xind=$map[1];$xind<$map[2];$xind++)
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
											if(!preg_match("/".$xsig."/i",$str_hex))continue;
											}
										else if($xstrf=="A")
											{
											if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
										$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
										if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
										}
									}
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['macho_custom'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			if($GLOBALS['MusselConfig']['signatures']['macho_mussel'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($str_hex,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($str_hex,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($str_hex,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_str_hex=$str_hex;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if(!($xstrf=="*"||$xsigi>0))$this_str_hex=@($xstrt=="*")?substr($this_str_hex,$xstrf*2):substr($this_str_hex,$xstrf*2,$xstrt*2);
										if(!substr_count($this_str_hex,$xsig[$xsigi]))continue 2;
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_str_hex=false;
									}
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
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
									continue;
									}
								}
							else if($xsig[1]=="FS-MIN")
								{
								if($str_len<$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FS-MAX")
								{
								if($str_len>$xsig[2])
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD")
								{
								if(!substr_count($str_hex,$xsig[2]))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
								}
							else if($xsig[1]=="FD-RX")
								{
								if(!preg_match("/".$xsig[2]."/i",$str_hex))
									{
									if($xsig[3]<=$i)break;
									$i=$xsig[3]-1;
									continue;
									}
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
									if(!preg_match("/".$xsig."/i",$str_hex))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$str_hex))continue;
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
								$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn." (".$ofn.")! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['block_control_characters'])
		{
		if(preg_match("/[\x00-\x08\x0b\x0c\x0e\x1f\x7f]/i",$str))
			{
			$out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected_control_characters']."!".$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].=$GLOBALS['MusselConfig']['lang']['detected_control_characters']." (".$ofn.")! ";
			}
		}
	if(!$out)return 1;
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
		if(!$d)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['failed_to_access']."'".$ofnenc."'!";
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
	if(!isset($GLOBALS['xsk']))$GLOBALS['xsk']="";
	if(!isset($GLOBALS['xfm']))$GLOBALS['xfm']="";
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
	$in=@implode(file($f));
	$fdCRC=@hash("crc32b",$in);
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
			$zDo=false;
			$isTar=false;
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
			if(!function_exists("zip_open"))return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
			$fS=@zip_open($f);
			if(!$fS)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
			$x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading']." '".$ofnenc."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
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
$memCache['vChkSigs']=array();
foreach(array("md5","general","ascii","html","pe","exe","elf","macho","graphics","metadata","filenames","mail") as $memCache['vChkSigs']['sigset'])
	{
	$memCache['vChkSigs']['clamav']=$memCache['vChkSigs']['sigset']."_clamav";
	$memCache['vChkSigs']['custom']=$memCache['vChkSigs']['sigset']."_custom";
	$memCache['vChkSigs']['mussel']=$memCache['vChkSigs']['sigset']."_mussel";
	if(isset($MusselConfig['signatures'][$memCache['vChkSigs']['sigset']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=$MusselConfig['signatures'][$memCache['vChkSigs']['sigset']];
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=0;
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']]))$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=0;
	if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=0;
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
if(!isset($MusselConfig['files']['check_archives']))$MusselConfig['files']['check_archives']=1;
if(!isset($MusselConfig['files']['filesize_archives']))$MusselConfig['files']['filesize_archives']=1;
if(!isset($MusselConfig['files']['filetype_archives']))$MusselConfig['files']['filetype_archives']=1;
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
if(!isset($MusselConfig['compatibility']['ignore_upload_errors']))$MusselConfig['compatibility']['ignore_upload_errors']=0;
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
				$hashme=@implode(file($stl));
				echo md5($hashme).":".strlen($hashme).":YOUR-SIGNATURE-NAME";
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
	$hexlen=@strlen($hexlc);
	if($GLOBALS['MusselConfig']['signatures']['mail_clamav'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
					for($xind=$map[1];$xind<$map[2];$xind++)
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
								if($xsigc===1)
									{
									if($xstrf=="*")
										{
										if(!substr_count($hex,$xsig[0])&&!substr_count($hexlc,$xsig[0]))continue;
										}
									else
										{
										if($xstrt=="*")
											{
											if(!substr_count(substr($hex,$xstrf*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2),$xsig[0]))continue;
											}
										else
											{
											if(!substr_count(substr($hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue;
											}
										}
									}
								else
									{
									$this_hex=$hex;
									$this_hexlc=$hexlc;
									for($xsigi=0;$xsigi<$xsigc;$xsigi++)
										{
										if($xstrf=="*")
											{
											if(!substr_count($this_hex,$xsig[0])&&!substr_count($this_hexlc,$xsig[0]))continue 2;
											}
										else
											{
											if($xstrt=="*")
												{
												if(!substr_count(substr($this_hex,$xstrf*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2),$xsig[0]))continue 2;
												}
											else
												{
												if(!substr_count(substr($this_hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue 2;
												}
											}
										$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
										}
									$this_hex=$this_hexlc=false;
									}
								$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
								}
							}
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
					for($xind=$map[1];$xind<$map[2];$xind++)
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
									if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
									}
								else if($xstrf=="A")
									{
									if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
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
								$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['mail_custom'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($hex,$xsig[0])&&!substr_count($hexlc,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($hex,$xstrf*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_hex=$hex;
							$this_hexlc=$hexlc;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if($xstrf=="*")
									{
									if(!substr_count($this_hex,$xsig[0])&&!substr_count($this_hexlc,$xsig[0]))continue 2;
									}
								else
									{
									if($xstrt=="*")
										{
										if(!substr_count(substr($this_hex,$xstrf*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2),$xsig[0]))continue 2;
										}
									else
										{
										if(!substr_count(substr($this_hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue 2;
										}
									}
								$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
								}
							$this_hex=$this_hexlc=false;
							}
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
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
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['mail_mussel'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
			if(!isset($GLOBALS['memCache']['mail_mussel_standard.cvd']))$GLOBALS['memCache']['mail_mussel_standard.cvd']=@file($GLOBALS['vault']."mail_mussel_standard.cvd");
			if(!$GLOBALS['memCache']['mail_mussel_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
				break;
				}
			$c=@count($GLOBALS['memCache']['mail_mussel_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_mussel_standard.cvd'][$i];
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
							continue;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
						if($xsigc===1)
							{
							if($xstrf=="*")
								{
								if(!substr_count($hex,$xsig[0])&&!substr_count($hexlc,$xsig[0]))continue;
								}
							else
								{
								if($xstrt=="*")
									{
									if(!substr_count(substr($hex,$xstrf*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2),$xsig[0]))continue;
									}
								else
									{
									if(!substr_count(substr($hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue;
									}
								}
							}
						else
							{
							$this_hex=$hex;
							$this_hexlc=$hexlc;
							for($xsigi=0;$xsigi<$xsigc;$xsigi++)
								{
								if($xstrf=="*")
									{
									if(!substr_count($this_hex,$xsig[0])&&!substr_count($this_hexlc,$xsig[0]))continue 2;
									}
								else
									{
									if($xstrt=="*")
										{
										if(!substr_count(substr($this_hex,$xstrf*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2),$xsig[0]))continue 2;
										}
									else
										{
										if(!substr_count(substr($this_hex,$xstrf*2,$xstrt*2),$xsig[0])&&!substr_count(substr($this_hexlc,$xstrf*2,$xstrt*2),$xsig[0]))continue 2;
										}
									}
								$this_str_hex=substraf($this_str_hex,$xsig[$xsigi].">");
								}
							$this_hex=$this_hexlc=false;
							}
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
						}
					}
				}
			}
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
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
							continue;
							}
						}
					else if($xsig[1]=="STR-LC")
						{
						if(!substr_count($hexlc,$xsig[2]))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX")
						{
						if(!preg_match("/".$xsig[2]."/i",$hex))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
						}
					else if($xsig[1]=="STR-RX-LC")
						{
						if(!preg_match("/".$xsig[2]."/i",$hexlc))
							{
							if($xsig[3]<=$i)break;
							$i=$xsig[3]-1;
							continue;
							}
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
							if(!preg_match("/".$xsig."/i",$hex)&&!preg_match("/".$xsig."/i",$hexlc))continue;
							}
						else if($xstrf=="A")
							{
							if(!preg_match("/\A".$xsig."/i",$hex)&&!preg_match("/\A".$xsig."/i",$hexlc))continue;
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
						$f.=$GLOBALS['MusselConfig']['lang']['detected']." ".$vn."! ";
						}
					}
				}
			}
		}
	return (!$f)?0:$f;
	}
$c=empty($_FILES)?0:count($_FILES);
$xfm=$xsk="";
if($c>0)
	{
	if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
		{
		if($MusselConfig['general']['scan_log'])$s=date("r")." ".$GLOBALS['MusselConfig']['lang']['started'].".".$GLOBALS['linebreak'];
		for($i=0;$i<$c;$i++)
			{
			$k=key($_FILES);
			if($MusselConfig['compatibility']['ignore_upload_errors'])
				{
				if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))continue;
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				$xsk.="-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
				$xfm.=$GLOBALS['MusselConfig']['lang']['upload_limit_exceeded']." (".$_FILES[$k]['name'].")! ";
				if($_FILES[$k]['error']>0)continue;
				if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
				}
			else if(!isset($_FILES[$k]['name'])||!isset($_FILES[$k]['tmp_name'])||!isset($_FILES[$k]['error'])||!isset($_FILES[$k]['size']))
				{
				$xsk.="UNAUTHORISED-FILE-UPLOAD--CONFIG:?:?".$GLOBALS['linebreak'];
				$xfm.=$GLOBALS['MusselConfig']['lang']['scan_unauthorised_upload_or_misconfig'];
				}
			else
				{
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				if($_FILES[$k]['error']==1)
					{
					$xsk.="---------UPLOAD-ERROR-1---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_1'];
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==2)
					{
					$xsk.="---------UPLOAD-ERROR-2---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_2'];
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==3)
					{
					$xsk.="---------UPLOAD-ERROR-3---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_34'];
					}
				else if($_FILES[$k]['error']==4)
					{
					$xsk.="---------UPLOAD-ERROR-4---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_34'];
					}
				else if($_FILES[$k]['error']==6)
					{
					$xsk.="---------UPLOAD-ERROR-6---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_6'];
					}
				else if($_FILES[$k]['error']==7)
					{
					$xsk.="---------UPLOAD-ERROR-7---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_7'];
					}
				else if($_FILES[$k]['error']==8)
					{
					$xsk.="---------UPLOAD-ERROR-8---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_8'];
					}
				else if(!is_uploaded_file($_FILES[$k]['tmp_name']))
					{
					$xsk.="UNAUTHORISED-FILE-UPLOAD-NO-HASH:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['scan_unauthorised_upload']." (".$_FILES[$k]['name'].")! ";
					}
				else
					{
					$xsk.="-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_limit_exceeded']." (".$_FILES[$k]['name'].")! ";
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				}
			}
		if($MusselConfig['general']['scan_log'])
			{
			if(!file_exists($vault.$MusselConfig['general']['scan_log']))$s="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$s;
			$s.="> ".$GLOBALS['MusselConfig']['lang']['upload_limit_exceeded']."! ".$GLOBALS['MusselConfig']['lang']['scan_aborted'];
			if($MusselConfig['general']['scan_kills'])$s.=$GLOBALS['MusselConfig']['lang']['refer_to_scan_kills'];
			$s.=$GLOBALS['linebreak'].date("r")." ".$GLOBALS['MusselConfig']['lang']['finished'].".".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
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
				$xfm.=$GLOBALS['MusselConfig']['lang']['scan_unauthorised_upload_or_misconfig'];
				}
			else
				{
				$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
				if($_FILES[$k]['error']==1)
					{
					$xsk.="---------UPLOAD-ERROR-1---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_1'];
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==2)
					{
					$xsk.="---------UPLOAD-ERROR-2---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_2'];
					if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
					}
				else if($_FILES[$k]['error']==3)
					{
					$xsk.="---------UPLOAD-ERROR-3---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_3'];
					}
				else if($_FILES[$k]['error']==4)
					{
					$xsk.="---------UPLOAD-ERROR-4---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_3'];
					}
				else if($_FILES[$k]['error']==6)
					{
					$xsk.="---------UPLOAD-ERROR-6---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_6'];
					}
				else if($_FILES[$k]['error']==7)
					{
					$xsk.="---------UPLOAD-ERROR-7---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_7'];
					}
				else if($_FILES[$k]['error']==8)
					{
					$xsk.="---------UPLOAD-ERROR-8---------:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['upload_error_8'];
					}
				else if(!is_uploaded_file($_FILES[$k]['tmp_name']))
					{
					$xsk.="UNAUTHORISED-FILE-UPLOAD-NO-HASH:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
					$xfm.=$GLOBALS['MusselConfig']['lang']['scan_unauthorised_upload']." (".$_FILES[$k]['name'].")! ";
					}
				else
					{
					$r=phpMussel($_FILES[$k]['tmp_name'],2,1,0,$_FILES[$k]['name']);
					}
				}
			}
		}
	}
if(strlen($xfm)>0)
	{
	$MusselConfig['template_data']['detected']=$xfm=trim($xfm);
	$MusselConfig['template_data']['phpmusselversion']=$phpmusselversion;
	if($MusselConfig['general']['scan_kills']&&strlen($xsk)>0)
		{
		$skd="";
		$ipaddr=$_SERVER[$MusselConfig['general']['ipaddr']];
		if(!file_exists($vault.$MusselConfig['general']['scan_kills']))$skd="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skd.="DATE: ".date("r").$GLOBALS['linebreak']."IP ADDRESS: ".$ipaddr.$GLOBALS['linebreak']."== SCAN RESULTS: ==".$GLOBALS['linebreak'].$xfm.$GLOBALS['linebreak']."== RECONSTRUCTED SIGNATURES: ==".$GLOBALS['linebreak'].$xsk.$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skf=fopen($vault.$MusselConfig['general']['scan_kills'],"a");
		fwrite($skf,$skd);
		fclose($skf);
		}
	if(!file_exists($vault."template.html"))
		{
		plaintext_echo_die("[phpMussel] ".$GLOBALS['MusselConfig']['lang']['denied']." ".$MusselConfig['template_data']['detected']);
		}
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
	echo $GLOBALS['MusselConfig']['lang']['cli_ln1'].$GLOBALS['MusselConfig']['lang']['cli_ln2'].$GLOBALS['MusselConfig']['lang']['cli_ln3'];
	$sth=fopen("php://stdin","r");
	while(true)
		{
		if(function_exists("cli_set_process_title"))@cli_set_process_title($phpmusselversion);
		echo $GLOBALS['MusselConfig']['lang']['cli_prompt'];
		$stl=trim(fgets($sth));
		if(function_exists("cli_set_process_title"))@cli_set_process_title($phpmusselversion." - ".$GLOBALS['MusselConfig']['lang']['cli_working']."...");
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
				$hashme=@implode(file($stl));
				echo md5($hashme).":".strlen($hashme).":YOUR-SIGNATURE-NAME";
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
				$s=date("r")." ".$GLOBALS['MusselConfig']['lang']['started'].".\n";
				echo $s;
				}
			if(@is_dir($stl))
				{
				$d=@scandir($stl);
				if(!$d)
					{
					if(!$out)$out="> ".$GLOBALS['MusselConfig']['lang']['failed_to_access']."\"".$stl."\".\n";
					}
				else
					{
					$c=count($d);
					$xsc=$stl[strlen($stl)-1];
					if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
					for($i=0;$i<$c;$i++)
						{
						$pcent=@round(($i/$c)*100,2)."%";
						echo $pcent." Complete.";
						if($d[$i]=="."||$d[$i]=="..")continue;
						$out=phpMusselFork("scan ".$stl.$d[$i],$d[$i]);
						if(!$out)$out="> ".$GLOBALS['MusselConfig']['lang']['cli_failed_to_complete']." (".$d[$i].")!\n";
						$r.=$out;
						echo "\r".prescan_decode($out);
						$out="";
						}
					}
				}
			else if(@is_file($stl))
				{
				$out=phpMusselFork("scan ".$stl,$stl);
				if(!$out)$out="> ".$GLOBALS['MusselConfig']['lang']['cli_failed_to_complete']."!\n";
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
				$s=date("r")." ".$GLOBALS['MusselConfig']['lang']['finished']."."."\n\n";
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
			echo (file_exists($vault."greylist.csv"))?" greylist.csv:\n\n".implode("\n ",explode(",",implode(file($vault."greylist.csv")))):" greylist.csv ".$MusselConfig['lang']['x_does_not_exist']."!";
			}
		if($cmd=="c")echo $MusselConfig['lang']['cli_commands'];
		}
	die;
	}
@ini_set("display_errors",$inidefaults);
if(strlen($inidefaults['backtrack_limit']))@ini_set("pcre.backtrack_limit",$inidefaults['backtrack_limit']);
@ini_set("user_agent",$inidefaults['user_agent']);
if($MusselConfig['general']['cleanup'])unset($cli_args,$tk,$ti,$tc,$r,$xsk,$xfm,$k,$i,$c,$memCache,$inidefaults,$phpmusselversion);

?>