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
 This File: phpMussel v0.3b Core Script
 This File Last Updated: 29th November 2013

                                  ~ ~ ~                                        
 Please refer to "documentation" for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order phpMussel to work effectively.

*/

if(!defined('phpMussel'))
	{
	die("[phpMussel] This should not be accessed directly.");
	}

$phpmusselversion="phpMussel v0.3b";
$linebreak=chr(10);
if(!isset($MusselConfig['general']['ipaddr']))$MusselConfig['general']['ipaddr']="REMOTE_ADDR";
if(!isset($_SERVER[$MusselConfig['general']['ipaddr']]))$_SERVER[$MusselConfig['general']['ipaddr']]="";

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
		$out.=$lnap."Missing filename!".$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].="Missing filename! ";
		return (!$n)?2:$out;
		}
	if($GLOBALS['MusselConfig']['signatures']['filenames_clamav'])
		{
		if(!isset($GLOBALS['memCache']['filenames_clamav.cvd']))$GLOBALS['memCache']['filenames_clamav.cvd']=@file($GLOBALS['vault']."filenames_clamav.cvd");
		if(!$GLOBALS['memCache']['filenames_clamav.cvd'])
			{
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (filenames_clamav.cvd)!".$GLOBALS['linebreak'];
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
				$xsig=explode(">",$xsig,3);
				$xsig[2]=($xsig[2]*-1)*-1;
				if($xsig[2]<=$i)break;
				if(preg_match("/".$xsig[1]."/i",$ofn))
					{
					$i++;
					}
				else
					{
					$i=$xsig[2];
					}
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
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
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
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
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (filenames_custom.cvd)!".$GLOBALS['linebreak'];
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
				$xsig=explode(">",$xsig,3);
				$xsig[2]=($xsig[2]*-1)*-1;
				if($xsig[2]<=$i)break;
				if(preg_match("/".$xsig[1]."/i",$ofn))
					{
					$i++;
					}
				else
					{
					$i=$xsig[2];
					}
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
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
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
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
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (filenames_mussel.cvd)!".$GLOBALS['linebreak'];
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
				$xsig=explode(">",$xsig,3);
				$xsig[2]=($xsig[2]*-1)*-1;
				if($xsig[2]<=$i)break;
				if(preg_match("/".$xsig[1]."/i",$ofn))
					{
					$i++;
					}
				else
					{
					$i=$xsig[2];
					}
				continue;
				}
			if(substr_count($xsig,":")>0)
				{
				$vn=@explode(":",$xsig);
				$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
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
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
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
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (md5_clamav.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_clamav.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5_clamav.cvd'],2);
				$xsig=explode($GLOBALS['linebreak'],$xsig[1],2);
				$xsig=explode(":",$xsig[0],2);
				if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
					{
					$out.=$lnap."Detected ".$xsig[1]."!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Detected ".$xsig[1]." (".$ofn.")! ";
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
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (md5_custom.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_custom.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5_custom.cvd'],2);
				$xsig=explode($GLOBALS['linebreak'],$xsig[1],2);
				$xsig=explode(":",$xsig[0],2);
				if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
					{
					$out.=$lnap."Detected ".$xsig[1]."!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Detected ".$xsig[1]." (".$ofn.")! ";
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
			if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (md5_mussel.cvd)!".$GLOBALS['linebreak'];
			}
		else
			{
			if(substr_count($GLOBALS['memCache']['md5_mussel.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5_mussel.cvd'],2);
				$xsig=explode($GLOBALS['linebreak'],$xsig[1],2);
				$xsig=explode(":",$xsig[0],2);
				if($xsig[0]==$str_len&&!substr_count($GLOBALS['memCache']['greylist'],",".$xsig[1].","))
					{
					$out.=$lnap."Detected ".$xsig[1]."!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Detected ".$xsig[1]." (".$ofn.")! ";
					}
				$xsig="";
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['general_clamav'])
		{
		$skipit=false;
		while(!$skipit)
			{
			$skipit=true;
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if(!isset($GLOBALS['memCache']['general_clamav_standard.cvd']))$GLOBALS['memCache']['general_clamav_standard.cvd']=@file($GLOBALS['vault']."general_clamav_standard.cvd");
			if(!$GLOBALS['memCache']['general_clamav_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_clamav_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['general_clamav_standard.map']))$GLOBALS['memCache']['general_clamav_standard.map']=@file($GLOBALS['vault']."general_clamav_standard.map");
			if(!$GLOBALS['memCache']['general_clamav_standard.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (general_clamav_standard.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_clamav_standard.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (general_clamav_standard.map)!".$GLOBALS['linebreak'];
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
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_clamav_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($GLOBALS['memCache']['general_clamav_regex.map']))$GLOBALS['memCache']['general_clamav_regex.map']=@file($GLOBALS['vault']."general_clamav_regex.map");
			if(!$GLOBALS['memCache']['general_clamav_regex.map'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (general_clamav_regex.map)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_clamav_regex.map']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (general_clamav_regex.map)!".$GLOBALS['linebreak'];
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
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if(!isset($GLOBALS['memCache']['general_custom_standard.cvd']))$GLOBALS['memCache']['general_custom_standard.cvd']=@file($GLOBALS['vault']."general_custom_standard.cvd");
			if(!$GLOBALS['memCache']['general_custom_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_custom_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_standard.cvd'][$i];
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(substr_count($str_hex,$xsig)>0)
							{
							$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
							}
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
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_custom_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_regex.cvd'][$i];
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(preg_match("/".$xsig."/i",$str_hex))
							{
							$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
							}
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
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if(!isset($GLOBALS['memCache']['general_mussel_standard.cvd']))$GLOBALS['memCache']['general_mussel_standard.cvd']=@file($GLOBALS['vault']."general_mussel_standard.cvd");
			if(!$GLOBALS['memCache']['general_mussel_standard.cvd'])
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_mussel_standard.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_mussel_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_mussel_standard.cvd'][$i];
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(substr_count($str_hex,$xsig)>0)
							{
							$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
							}
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
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (general_mussel_regex.cvd)!".$GLOBALS['linebreak'];
				break;
				}
			$c=@count($GLOBALS['memCache']['general_mussel_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_mussel_regex.cvd'][$i];
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(preg_match("/".$xsig."/i",$str_hex))
							{
							$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
							if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
							}
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
			if(!isset($str_norm))$str_norm=strtolower(str_replace("\t","",str_replace("\n","",str_replace("\r","",str_replace(" ","",$str)))));
			if(substr_count($str_norm,"<?php")>0)
				{
				$out.=$lnap."PHP chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="PHP chameleon attack detected (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_exe'])
		{
		if(substr_count(",exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",",".$xt.",")>0)
			{
			if(!substr($str,0,2)==="MZ")
				{
				$out.=$lnap."EXE chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="EXE chameleon attack detected (".$ofn.")! ";
				}
			}
		else
			{
			if(substr($str,0,2)==="MZ")
				{
				$out.=$lnap."EXE chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="EXE chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="elf")
			{
			if(!substr_compare_hex($str,0,4,"7f454c46",1))
				{
				$out.=$lnap."ELF chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ELF chameleon attack detected (".$ofn.")! ";
				}
			}
		else
			{
			if(substr_compare_hex($str,0,4,"7f454c46",1))
				{
				$out.=$lnap."ELF chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ELF chameleon attack detected (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['exe_clamav']||$GLOBALS['MusselConfig']['signatures']['exe_custom']||$GLOBALS['MusselConfig']['signatures']['exe_mussel'])
		{
		if(substr_count(",exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",",".$xt.",")>0||substr($str,0,2)==="MZ")
			{
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if($GLOBALS['MusselConfig']['signatures']['exe_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
					if(!isset($GLOBALS['memCache']['exe_clamav_standard.cvd']))$GLOBALS['memCache']['exe_clamav_standard.cvd']=@file($GLOBALS['vault']."exe_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['exe_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['exe_clamav_standard.map']))$GLOBALS['memCache']['exe_clamav_standard.map']=@file($GLOBALS['vault']."exe_clamav_standard.map");
					if(!$GLOBALS['memCache']['exe_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (exe_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (exe_clamav_standard.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(substr_count($str_hex,$xsig)>0)
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['exe_clamav_regex.map']))$GLOBALS['memCache']['exe_clamav_regex.map']=@file($GLOBALS['vault']."exe_clamav_regex.map");
					if(!$GLOBALS['memCache']['exe_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (exe_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (exe_clamav_regex.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(preg_match("/".$xsig."/i",$str_hex))
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_mussel_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (exe_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['exe_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_mussel_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['elf_clamav']||$GLOBALS['MusselConfig']['signatures']['elf_custom']||$GLOBALS['MusselConfig']['signatures']['elf_mussel'])
		{
		if(!isset($str_hex))$str_hex=@bin2hex($str);
		if($xt=="elf"||substr_compare_hex($str,0,4,"7f454c46",1))
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['elf_clamav_standard.map']))$GLOBALS['memCache']['elf_clamav_standard.map']=@file($GLOBALS['vault']."elf_clamav_standard.map");
					if(!$GLOBALS['memCache']['elf_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (elf_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (elf_clamav_standard.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(substr_count($str_hex,$xsig)>0)
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['elf_clamav_regex.map']))$GLOBALS['memCache']['elf_clamav_regex.map']=@file($GLOBALS['vault']."elf_clamav_regex.map");
					if(!$GLOBALS['memCache']['elf_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (elf_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (elf_clamav_regex.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(preg_match("/".$xsig."/i",$str_hex))
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_mussel_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (elf_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['elf_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_mussel_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
			if(!substr($str,0,2)==="PK")
				{
				$out.=$lnap."ZIP chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="ZIP chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="rar")
			{
			if(!substr($str,0,4)==="Rar!")
				{
				$out.=$lnap."RAR chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="RAR chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="gz")
			{
			if(!substr_compare_hex($str,0,2,"1f8b",1))
				{
				$out.=$lnap."GZIP chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="GZIP chameleon attack detected (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_doc'])
		{
		if(substr_count(",doc,dot,pps,ppt,xla,xls,wiz,",",".$xt.",")>0)
			{
			if(!substr_compare_hex($str,0,4,"d0cf11e0",1))
				{
				$out.=$lnap."Office chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Office chameleon attack detected (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_img'])
		{
		if($xt=="bmp"||$xt=="dib")
			{
			if(!substr($str,0,2)==="BM")
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="png")
			{
			if(!substr_compare_hex($str,0,8,"89504e470d0a1a0a",1))
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="jpg"||$xt=="jpeg")
			{
			if(!substr_compare_hex($str,0,3,"ffd8ff",1))
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="gif")
			{
			if(!substr_compare_hex($str,0,6,"474946383761",1)&&!substr_compare_hex($str,0,6,"474946383961",1))
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="xcf")
			{
			if(!substr($str,0,8)==="gimp xcf")
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		if($xt=="psd"||$xt=="pdd")
			{
			if(!substr($str,0,4)==="8BPS")
				{
				$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_pdf'])
		{
		if($xt=="pdf")
			{
			if(!substr_compare_hex($str,0,4,"25504446",1))
				{
				$out.=$lnap."PDF chameleon attack detected!".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="PDF chameleon attack detected (".$ofn.")! ";
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
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (hex_general_commands.csv)!".$GLOBALS['linebreak'];
				break;
				}
			$c=count($GLOBALS['memCache']['hex_general_commands.csv']);
			if($c<1)
				{
				if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file corrupted (hex_general_commands.csv)!".$GLOBALS['linebreak'];
				break;
				}
			if(!isset($str_norm))$str_norm=strtolower(str_replace("\t","",str_replace("\n","",str_replace("\r","",str_replace(" ","",$str)))));
			for($i=0;$i<$c;$i++)
				{
				$xgc=@hex2bin($GLOBALS['memCache']['hex_general_commands.csv'][$i]);
				if(substr_count($str_norm,$xgc)>0)
					{
					$out.=$lnap."Command injection attempt detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Command injection attempt detected, '".urlencode($xgc)."' (".$ofn.")! ";
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['graphics_clamav']||$GLOBALS['MusselConfig']['signatures']['graphics_custom']||$GLOBALS['MusselConfig']['signatures']['graphics_mussel'])
		{
		if(substr_count(",avi,bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdr,img,jpeg,jpg,jps,mov,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,webp,wmf,xbm,xbmp,xcf,xvl,",",".$xt.",")>0)
			{
			if(!isset($str_norm))$str_norm=strtolower(str_replace("\t","",str_replace("\n","",str_replace("\r","",str_replace(" ","",$str)))));
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if($GLOBALS['MusselConfig']['signatures']['graphics_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
					if(!isset($GLOBALS['memCache']['graphics_clamav_standard.cvd']))$GLOBALS['memCache']['graphics_clamav_standard.cvd']=@file($GLOBALS['vault']."graphics_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['graphics_clamav_standard.map']))$GLOBALS['memCache']['graphics_clamav_standard.map']=@file($GLOBALS['vault']."graphics_clamav_standard.map");
					if(!$GLOBALS['memCache']['graphics_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (graphics_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (graphics_clamav_standard.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(substr_count($str_hex,$xsig)>0)
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['graphics_clamav_regex.map']))$GLOBALS['memCache']['graphics_clamav_regex.map']=@file($GLOBALS['vault']."graphics_clamav_regex.map");
					if(!$GLOBALS['memCache']['graphics_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (graphics_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (graphics_clamav_regex.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(preg_match("/".$xsig."/i",$str_hex))
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_mussel_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (graphics_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['graphics_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_mussel_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['signatures']['macho_clamav']||$GLOBALS['MusselConfig']['signatures']['macho_custom']||$GLOBALS['MusselConfig']['signatures']['macho_mussel'])
		{
		if(@preg_match("/(cafebabe)|(cafed00d)|(cefaedfe)|(cffaedfe)|(feedface)|(feedfacf)/i",dechex(substr($str,0,4))))
			{
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if($GLOBALS['MusselConfig']['signatures']['macho_clamav'])
				{
				$skipit=false;
				while(!$skipit)
					{
					$skipit=true;
					if(!isset($GLOBALS['memCache']['macho_clamav_standard.cvd']))$GLOBALS['memCache']['macho_clamav_standard.cvd']=@file($GLOBALS['vault']."macho_clamav_standard.cvd");
					if(!$GLOBALS['memCache']['macho_clamav_standard.cvd'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_clamav_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['macho_clamav_standard.map']))$GLOBALS['memCache']['macho_clamav_standard.map']=@file($GLOBALS['vault']."macho_clamav_standard.map");
					if(!$GLOBALS['memCache']['macho_clamav_standard.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (macho_clamav_standard.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_clamav_standard.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (macho_clamav_standard.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(substr_count($str_hex,$xsig)>0)
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_clamav_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					if(!isset($GLOBALS['memCache']['macho_clamav_regex.map']))$GLOBALS['memCache']['macho_clamav_regex.map']=@file($GLOBALS['vault']."macho_clamav_regex.map");
					if(!$GLOBALS['memCache']['macho_clamav_regex.map'])
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map missing (macho_clamav_regex.map)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_clamav_regex.map']);
					if($c<1)
						{
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature map corrupted (macho_clamav_regex.map)!".$GLOBALS['linebreak'];
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
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$xlen=strlen($xsig);
									if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
										{
										continue;
										}
									$vn=$vn[0];
									if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
										{
										if(preg_match("/".$xsig."/i",$str_hex))
											{
											$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
											if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
											}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_custom_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_custom_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_mussel_standard.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_mussel_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_mussel_standard.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($str_hex,$xsig)>0)
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
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
						if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return (!$n)?-3:$lnap."Signature file missing (macho_mussel_regex.cvd)!".$GLOBALS['linebreak'];
						break;
						}
					$c=@count($GLOBALS['memCache']['macho_mussel_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_mussel_regex.cvd'][$i];
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$str_hex))
									{
									$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
									}
								}
							}
						}
					}
				}
			}
		}
	if($GLOBALS['MusselConfig']['attack_specific']['block_control_characters'])
		{
		if(preg_match("/[\x00-\x09\x0B\x0C\x0e\x1f]/i",$str))
			{
			$out.=$lnap."Detected Control Characters!".$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].="Detected Control Characters (".$ofn.")! ";
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
		if(!$d)return (!$n)?0:$lnap."Failed to access '".$ofn."'!";
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
	if(!$d||!$f)return (!$n)?0:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Invalid file!".$GLOBALS['linebreak'];
	$fS=@filesize($f);
	if($GLOBALS['MusselConfig']['files']['filesize_limit']>0)
		{
		if($fS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
			{
			if(!$GLOBALS['MusselConfig']['files']['filesize_response'])return (!$n)?1:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."OK (filesize limit exceeded).".$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$fS.":".$ofn.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].="Filesize limit exceeded (".$ofn.")! ";
			if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			return (!$n)?2:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Bad (filesize limit exceeded).".$GLOBALS['linebreak'];
			}
		}
	if(substr($ofn,0,1)==="."||substr($ofn,-1)===".")
		{
		if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$fS.":".$ofn.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].="Filename manipulation detected (".$ofn.")! ";
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?2:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Filename manipulation detected!".$GLOBALS['linebreak'];
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
	if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",",".$xts.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$gzxt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$gzxts.",")>0)return (!$n)?1:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
	if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xts.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$gzxt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$gzxts.",")>0)
		{
		if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$fS.":".$ofn.$GLOBALS['linebreak'];
		if($fm)$GLOBALS['xfm'].="Blacklisted filetype detected (".$ofn.")! ";
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?2:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Filetype blacklisted.".$GLOBALS['linebreak'];
		}
	$in=@implode(file($f));
	$z=phpMusselD($in,$n,$dpt,$ofn);
	if($z!==1)
		{
		if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
		return (!$n)?$z:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak'].$z;
		}
	$x=$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
	$r=1;
	if($GLOBALS['MusselConfig']['files']['check_archives'])
		{
		$depth=0;
		if(substr_count(",gz,tgz,",",".$xt.",")>0||substr_compare_hex($in,0,2,"1f8b",1))
			{
			if(!function_exists("gzdecode"))return (!$n)?-1:$lnap."Reading '".$ofn."' (GZIP):".$GLOBALS['linebreak']."-".$lnap."Failed (missing required extensions)!".$GLOBALS['linebreak'];
			$fD=@gzdecode($in);
			if(!$fD)return (!$n)?0:$lnap."Reading '".$ofn."' (GZIP):".$GLOBALS['linebreak']."-".$lnap."Failed (empty or not an archive)!".$GLOBALS['linebreak'];
			$x.=$lnap."Reading '".$ofn."' (GZIP):".$GLOBALS['linebreak']."-".$lnap."Success! Proceeding to check contents.".$GLOBALS['linebreak'];
			$b=false;
			$eN=$ofn;
			while(!$b)
				{
				$lnap="-".$lnap;
				$eN=substr($eN,0,(strlen($eN)-strrpos($eN,"."))*-1);
				$eS=strlen($fD);
				if($depth>$GLOBALS['MusselConfig']['files']['max_recursion'])
						{
						$r=2;
						if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Recursion depth limit exceeded (".$ofn.")! ";
						$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Bad (recursion depth limit exceeded).".$GLOBALS['linebreak'];
						break;
						}
				if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
					{
					if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
						{
						if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
							{
							$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."OK (filesize limit exceeded).".$GLOBALS['linebreak'];
							break;
							}
						$r=2;
						if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Filesize limit exceeded (".$ofn.")! ";
						$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Bad (filesize limit exceeded).".$GLOBALS['linebreak'];
						break;
						}
					}
				$bad=phpMusselD($fD,$n,$dpt,$eN);
				$zmd="";
				$zCRC=@hash("crc32b",$fD);
				if($GLOBALS['MusselConfig']['signatures']['zip_metadata_clamav'])
					{
					if(!isset($GLOBALS['memCache']['zip_metadata_clamav.cvd']))$GLOBALS['memCache']['zip_metadata_clamav.cvd']=@file($GLOBALS['vault']."zip_metadata_clamav.cvd");
					if(!$GLOBALS['memCache']['zip_metadata_clamav.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file missing (zip_metadata_clamav.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['zip_metadata_clamav.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file corrupted (zip_metadata_clamav.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_clamav.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
								}
							}
						}
					}
				if($GLOBALS['MusselConfig']['signatures']['zip_metadata_custom'])
					{
					if(!isset($GLOBALS['memCache']['zip_metadata_custom.cvd']))$GLOBALS['memCache']['zip_metadata_custom.cvd']=@file($GLOBALS['vault']."zip_metadata_custom.cvd");
					if(!$GLOBALS['memCache']['zip_metadata_custom.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file missing (zip_metadata_custom.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['zip_metadata_custom.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file corrupted (zip_metadata_custom.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_custom.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
								}
							}
						}
					}
				if($GLOBALS['MusselConfig']['signatures']['zip_metadata_mussel'])
					{
					if(!isset($GLOBALS['memCache']['zip_metadata_mussel.cvd']))$GLOBALS['memCache']['zip_metadata_mussel.cvd']=@file($GLOBALS['vault']."zip_metadata_mussel.cvd");
					if(!$GLOBALS['memCache']['zip_metadata_mussel.cvd'])
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file missing (zip_metadata_mussel.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdc=count($GLOBALS['memCache']['zip_metadata_mussel.cvd']);
					if($zmdc<1)
						{
						if($r!==2)$r=-3;
						$zmd.="-".$lnap."Signature file corrupted (zip_metadata_mussel.cvd)!".$GLOBALS['linebreak'];
						}
					$zmdv="";
					for($zmdi=0;$zmdi<$zmdc;$zmdi++)
						{
						$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_mussel.cvd'][$zmdi]);
						if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
							{
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
								}
							}
						}
					}
				if($bad!==1)
					{
					$r=2;
					$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak'].$bad.$zmd;
					break;
					}
				if($r===2&&$zmd)
					{
					$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak'].$zmd;
					break;
					}
				if(substr_count("gz,tgz,",substr($eN,(strlen($eN)-strrpos($eN,".")-1)*-1).",")>0||substr_compare_hex($fD,0,2,"1f8b",1))
					{
					$fD=@gzdecode($fD);
					$depth++;
					continue;
					}
				$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
				$b=true;
				}
			}
		else if($xts=="zip*"||substr($in,0,2)==="PK")
			{
			if(!function_exists("zip_open"))return (!$n)?-1:$lnap."Reading '".$ofn."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap."Failed (missing required extensions)!".$GLOBALS['linebreak'];
			$fS=@zip_open($f);
			if(!$fS)return (!$n)?0:$lnap."Reading '".$ofn."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap."Failed (empty or not an archive)!".$GLOBALS['linebreak'];
			$x.=$lnap."Reading '".$ofn."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap."Success! Proceeding to check contents.".$GLOBALS['linebreak'];
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
				if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
					{
					if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
						{
						if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
							{
							$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."OK (filesize limit exceeded).".$GLOBALS['linebreak'];
							continue;
							}
						$r=2;
						if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Filesize limit exceeded (".$ofn.")! ";
						$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Bad (filesize limit exceeded).".$GLOBALS['linebreak'];
						continue;
						}
					}
				if(substr($eN,0,1)==="."||substr($eN,-1)===".")
					{
					$r=2;
					if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Filename manipulation detected (".$ofn.")! ";
					$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Filename manipulation detected!".$GLOBALS['linebreak'];
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
						$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
						continue;
						}
					if(substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xt.",")>0||substr_count(",".$GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",",".$xts.",")>0)
						{
						$r=2;
						if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Blacklisted filetype detected (".$ofn.">".$eN.")! ";
						$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Filetype blacklisted.".$GLOBALS['linebreak'];
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
					if($GLOBALS['MusselConfig']['signatures']['zip_metadata_clamav'])
						{
						if(!isset($GLOBALS['memCache']['zip_metadata_clamav.cvd']))$GLOBALS['memCache']['zip_metadata_clamav.cvd']=@file($GLOBALS['vault']."zip_metadata_clamav.cvd");
						if(!$GLOBALS['memCache']['zip_metadata_clamav.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file missing (zip_metadata_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['zip_metadata_clamav.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file corrupted (zip_metadata_clamav.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_clamav.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
									}
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['zip_metadata_custom'])
						{
						if(!isset($GLOBALS['memCache']['zip_metadata_custom.cvd']))$GLOBALS['memCache']['zip_metadata_custom.cvd']=@file($GLOBALS['vault']."zip_metadata_custom.cvd");
						if(!$GLOBALS['memCache']['zip_metadata_custom.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file missing (zip_metadata_custom.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['zip_metadata_custom.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file corrupted (zip_metadata_custom.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_custom.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
									}
								}
							}
						}
					if($GLOBALS['MusselConfig']['signatures']['zip_metadata_mussel'])
						{
						if(!isset($GLOBALS['memCache']['zip_metadata_mussel.cvd']))$GLOBALS['memCache']['zip_metadata_mussel.cvd']=@file($GLOBALS['vault']."zip_metadata_mussel.cvd");
						if(!$GLOBALS['memCache']['zip_metadata_mussel.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file missing (zip_metadata_mussel.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['zip_metadata_mussel.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file corrupted (zip_metadata_mussel.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_mussel.cvd'][$zmdi]);
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$zmds[0].","))
								{
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
									}
								}
							}
						}
					}
				if($bad!==1)
					{
					$r=2;
					$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak'].$bad.$zmd;
					continue;
					}
					if($r===2&&$zmd)
					{
					$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak'].$zmd;
					continue;
					}
				$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
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
foreach(array("md5","general","exe","elf","macho","graphics","zip_metadata","filenames","mail") as $memCache['vChkSigs']['sigset'])
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
if(!isset($MusselConfig['signatures']['fn_siglen_min']))$MusselConfig['signatures']['fn_siglen_min']=4;
if(!isset($MusselConfig['signatures']['fn_siglen_max']))$MusselConfig['signatures']['fn_siglen_max']=512;
if(!isset($MusselConfig['signatures']['rx_siglen_min']))$MusselConfig['signatures']['rx_siglen_min']=8;
if(!isset($MusselConfig['signatures']['rx_siglen_max']))$MusselConfig['signatures']['rx_siglen_max']=512;
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
$cli_args=array(isset($argv[0])?$argv[0]:"",isset($argv[1])?$argv[1]:"",isset($argv[2])?$argv[2]:"",isset($argv[3])?$argv[3]:"");
if(function_exists("phpMusselFork"))
	{
	if($cli_args[1]=="cli_win_scan")
		{
		echo phpMusselR($cli_args[2],1,1,0,$cli_args[3]);
		die();
		}
	}
function phpMussel($f="",$n=0,$zz=0,$dpt=0,$ofn="")
	{
	if(!$ofn)$ofn=@urlencode($f);
	if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0)$s=date("r")." Started.".$GLOBALS['linebreak'];
	$r=phpMusselR($f,$n,$zz,$dpt,$ofn);
	if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0&&!is_array($r))
		{
		$r=$s.$r.date("r")." Finished.".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
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
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(substr_count($hex,$xsig)>0)$f.="Detected ".$vn."! ";
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
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$xlen=strlen($xsig);
							if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
								{
								continue;
								}
							$vn=$vn[0];
							if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
								{
								if(preg_match("/".$xsig."/i",$hex))$f.="Detected ".$vn."! ";
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
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(substr_count($hex,$xsig)>0)$f.="Detected ".$vn."! ";
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
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(preg_match("/".$xsig."/i",$hex))$f.="Detected ".$vn."! ";
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
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(substr_count($hex,$xsig)>0)$f.="Detected ".$vn."! ";
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
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$xlen=strlen($xsig);
					if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])
						{
						continue;
						}
					$vn=$vn[0];
					if(!substr_count($GLOBALS['memCache']['greylist'],",".$vn.","))
						{
						if(preg_match("/".$xsig."/i",$hex))$f.="Detected ".$vn."! ";
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
		if($MusselConfig['general']['scan_log'])$s=date("r")." Started.".$GLOBALS['linebreak'];
		for($i=0;$i<$c;$i++)
			{
			$k=key($_FILES);
			$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
			if(is_uploaded_file($_FILES[$k]['tmp_name']))
				{
				$xsk.="00000000000000000000000000000000:".$_FILES[$k]['size'].":".$_FILES[$k]['name'].$GLOBALS['linebreak'];
				$xfm.="Upload limit exceeded (".$_FILES[$k]['name'].")! ";
				if($MusselConfig['general']['delete_on_sight'])@unlink($_FILES[$k]['tmp_name']);
				}
			else
				{
				$xfm.="Unauthorised file upload manipulation detected (".$_FILES[$k]['name'].")! ";
				}
			}
		if($MusselConfig['general']['scan_log'])
			{
			if(!file_exists($vault.$MusselConfig['general']['scan_log']))$s="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$s;
			$s=$s."> Upload limit exceeded! Scanning aborted (refer to scan_kills if available)!".$GLOBALS['linebreak'].date("r")." Finished.".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
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
			$_FILES[$k]['name']=@urlencode($_FILES[$k]['name']);
			if(is_uploaded_file($_FILES[$k]['tmp_name']))
				{
				$r=phpMussel($_FILES[$k]['tmp_name'],2,1,0,$_FILES[$k]['name']);
				}
			else
				{
				$xfm.="Unauthorised file upload manipulation detected (".$_FILES[$k]['name'].")! ";
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
		plaintext_echo_die("[phpMussel] Upload Denied! ".$MusselConfig['template_data']['detected']);
		}
	else
		{
		$html=implode_md(file($vault."template.html"));
		$tc=count($MusselConfig['template_data']);
		reset($MusselConfig['template_data']);
		for($ti=0;$ti<$tc;$ti++)
			{
			$tk=key($MusselConfig['template_data']);
			$html=str_replace("{".$tk."}",$MusselConfig['template_data'][$tk],$html);
			next($MusselConfig['template_data']);
			}
		$html=str_replace("\t","",str_replace("\n","",str_replace("\r","",$html)));
		if($MusselConfig['general']['forbid_on_block'])
			{
			header("HTTP/1.0 403 Forbidden");
			header("HTTP/1.1 403 Forbidden");
			header("Status: 403 Forbidden");
			}
		echo $html;
		die();
		}
	}
if(function_exists("phpMusselFork")&&strlen(mussel_php)>0&&mussel_os=="WIN"&&mussel_sapi=="cli")
	{
	echo "      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
	echo " Currently running phpMussel in CLI mode (Command line interface).\n\n What file or directory do you want to scan?  Type the name of the file or\n directory that you want phpMussel to scan and press enter, or type 'q' and\n enter to quit without scanning:\n\n>> ";
	$sth=fopen("php://stdin","r");
	$stl=trim(fgets($sth));
	echo "\n\n";
	if($stl=="q")die();
	$r="";
	if($MusselConfig['general']['scan_log'])
		{
		$s=date("r")." Started.".$linebreak;
		echo $s;
		}
	if(is_dir($stl))
		{
		$d=@scandir($stl);
		if(!$d)
			{
			echo "> Failed to access \"".$stl."\".".$linebreak;
			}
		else
			{
			$c=count($d);
			for($i=0;$i<$c;$i++)
				{
				if($d[$i]=="."||$d[$i]=="..")
					{
					continue;
					}
				$out=phpMusselFork($stl.$d[$i],urlencode($stl.$d[$i]));
				if(!$out)$out="> Failed to complete scanning process (".$d[$i].")!".$linebreak;
				$r.=$out;
				echo $out;
				$out="";
				}
			}
		}
	else
		{
		$out=phpMusselFork($stl,urlencode($stl));
		if(!$out)$out="> Failed to complete scanning process!".$linebreak;
		$r.=$out;
		echo $out;
		$out="";
		}
	if($MusselConfig['general']['scan_log'])
		{
		$r=$s.$r;
		$s=date("r")." Finished.".$linebreak.$linebreak;
		echo $s;
		$r=$r.$s;
		if(!file_exists($vault.$MusselConfig['general']['scan_log']))$r="<?php die(); ?>".$linebreak.$linebreak.$r;
		$xf=fopen($vault.$MusselConfig['general']['scan_log'],"a");
		fwrite($xf,$r);
		fclose($xf);
		}
	echo "\n\n";
	die();
	}
if($MusselConfig['general']['cleanup'])unset($cli_args,$tk,$ti,$tc,$r,$xsk,$xfm,$k,$i,$c,$memCache,$phpmusselversion);

?>