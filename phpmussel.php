<?php
/*
      _____  _     _  _____  _______ _     _ _______ _______ _______   v0.1    
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    
 Thank you for using phpMussel, a php-based script based upon ClamAV signatures
     designed to detect trojans, viruses, malware and etcetera within files    
             uploaded to your system wherever the script is hooked.            
                PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2                
 Please be aware, however, that this script (at least, at the time the version 
   you are currently using was released) is still UNDER CONSTRUCTION, NOT YET  
    COMPLETE, and thus comes with NO WARRANTY. Keep an eye out for updates.    
                                  ~ ~ ~                                        
 phpMussel version 0.1 (main script by Maikuolan, signatures by ClamAV).
 Last Updated (phpMussel, this version): 18th September 2013.
 
 Special thanks to ClamAV for both project inspiration and for the signature
 files that this script utilises, without which, the script would simply not
 exist, or at best, would have very limited value.
 Default signatures included with this version of phpMussel derived from
 mainlined signatures version 55 ("main.cvd"), released 17th September 2013.
 Both ClamAV and the latest copy of its (unmodified) signatures can be
 found at:
  http://www.clamav.net/lang/en/
 
 Special thanks to Zaphod and Spambot Security for giving the project a home via
 hosting and forums.
  http://www.spambotsecurity.com/forum/index.php
 
 Special thanks to all those supporting the project, and to you, for using the script.
 
 Also.. To anyone else that I should be mentioning that I haven't. I felt that
 I should probably include something like this (special thanks notice) in the
 script, but I don't have much experience and kind of suck at them, I'm not
 entirely sure what I should and shouldn't write here, so, whatever. Maybe I'll
 improve it with future versions or something. :)
 
 For help or support with the script (if you need it), you can find and contact
 me at Spambot Security or Game Jaunt.
  http://www.spambotsecurity.com/forum/memberlist.php?mode=viewprofile&u=516
  http://www.gamejaunt.com/contact.php - http://www.gamejaunt.com/profile/Maikuolan/
                                  ~ ~ ~                                        

 The only part of this script that you should need to modify in order for it to
 work on your CMS or website is the $vault variable.
 
 Please modify the string between the quotation marks next to $vault to match the
 exact true location of the "vault" directory of phpMussel.
 
 For everything else, refer to "readme.txt".
 (This should get easier once I get around to writing up proper documentation
  and a proper installer).
 
 Regards,
 Maikuolan.
*/

$vault="/your_user/public_html/some_dir/phpmussel/vault/";
$phpmusselversion="phpMussel v0.1";
@ini_set('display_errors',0);
$linebreak=chr(13).chr(10);

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

if(!function_exists("strtoarray"))
	{
	function strtoarray($s)
		{
		if(is_array($s))return $s;
		if(!$c=strlen($s))return false;
		$ar=array();
		for($i=0;$i<$c;$i++)
			{
			$ar[$i]=$s[$i];
			}
		return $ar;
		}
	}

if(!function_exists("xhex"))
	{
	function xhex($in)
		{
		$in=strtoarray($in);
		$x="";
		$c=count($in);
		$ord=0;
		for($i=0;$i<$c;$i++)
			{
			$ord=ord($in[$i]);
			if(($ord>=48&&$ord<=57)||($ord>=65&&$ord<=70)||($ord>=97&&$ord<=102))$x.=$in[$i];
			}
		return $x;
		}
	}

if(!function_exists("substr_compare_hex"))
	{
	function substr_compare_hex($str=0,$st=0,$l=0,$x=0,$p=0)
		{
		if(is_array($str))return false;
		if(!$l)$l=@strlen($str);
		if(!$x||!$l)return false;
		$str=@substr($str,$st,$l);
		$y="";
		for($i=0;$i<$l;$i++)
			{
			$y.=dechex(ord($str[$i]));
			}
		if(!$p)return (substr_count($y,strtolower($x))>0)?true:false;
		return ($y===strtolower($x))?true:false;
		}
	}

if(!function_exists("phpMusselD"))
	{
	function phpMusselD($str="",$n=0,$dpt=0,$fn="",$ofn="")
		{
		$fm=($n==2)?1:0;
		$dpt++;
		$lnap="";
		for($i=0;$i<($dpt-1);$i++)
			{
			$lnap.="-";
			}
		$lnap.="> ";
		if(!$str_len=strlen($str))return false;
		$out="";
		$md5=md5($str);
		if($GLOBALS['MusselConfig']['clamav']['md5'])
			{
			if(!isset($GLOBALS['memCache']['md5.cvd']))$GLOBALS['memCache']['md5.cvd']=@implode_md(file($GLOBALS['vault']."md5.cvd"));
			if(!$GLOBALS['memCache']['md5.cvd'])return (!$n)?-3:$lnap."Signature file missing (md5.cvd)!".$GLOBALS['linebreak'];
			if(substr_count($GLOBALS['memCache']['md5.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5.cvd'],2);
				$xsig=explode($GLOBALS['linebreak'],$xsig[1],2);
				$xsig=explode(":",$xsig[0],2);
				if($xsig[0]==$str_len)
					{
					$out.=$lnap."Detected ".$xsig[1]."!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Detected ".$xsig[1]." (".$ofn.")! ";
					}
				$xsig="";
				}
			if(!isset($GLOBALS['memCache']['md5.custom.cvd']))$GLOBALS['memCache']['md5.custom.cvd']=@implode_md(file($GLOBALS['vault']."md5.custom.cvd"));
			if(!$GLOBALS['memCache']['md5.custom.cvd'])return (!$n)?-3:$lnap."Signature file missing (md5.custom.cvd)!".$GLOBALS['linebreak'];
			if(substr_count($GLOBALS['memCache']['md5.custom.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5.custom.cvd'],2);
				$xsig=explode($GLOBALS['linebreak'],$xsig[1],2);
				$xsig=explode(":",$xsig[0],2);
				if($xsig[0]==$str_len)
					{
					$out.=$lnap."Detected ".$xsig[1]."!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Detected ".$xsig[1]." (".$ofn.")! ";
					}
				$xsig="";
				}
			}
		if($GLOBALS['MusselConfig']['clamav']['basic'])
			{
			if(!isset($GLOBALS['memCache']['basic.cvd']))$GLOBALS['memCache']['basic.cvd']=@file($GLOBALS['vault']."basic.cvd");
			if(!$GLOBALS['memCache']['basic.cvd'])return (!$n)?-3:$lnap."Signature file missing (basic.cvd)!".$GLOBALS['linebreak'];
			$c=count($GLOBALS['memCache']['basic.cvd']);
			if($c<1)return (!$n)?-3:$lnap."Signature file corrupted (basic.cvd)!".$GLOBALS['linebreak'];
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['basic.cvd'][$i];
				$vs="";
				if((substr_count($xsig,"=")>0)&&!(substr_count($xsig,"?")>0)&&!(substr_count($xsig,"*")>0))
					{
					$vn=@explode("=",$xsig);
					$xsig=@xhex($vn[1]);
					$vn=$vn[0];
					$l=@strlen($xsig);
					$xsig=strtoarray($xsig);
					$ng=false;
					for($x=0;$x<$l;$x++)
						{
						$ng=(!$ng)?true:false;
						if($ng)
							{
							$z=$x+1;
							$vs.=@chr(hexdec($xsig[$x].$xsig[$z]));
							}
						}
					$vsl=strlen($vs);
					if($vsl<=$str_len)if(substr_count($str,$vs)>0)
						{
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
						}
					}
				}
			if(!isset($GLOBALS['memCache']['basic.custom.cvd']))$GLOBALS['memCache']['basic.custom.cvd']=@file($GLOBALS['vault']."basic.custom.cvd");
			if(!$GLOBALS['memCache']['basic.custom.cvd'])return (!$n)?-3:$lnap."Signature file missing (basic.custom.cvd)!".$GLOBALS['linebreak'];
			$c=count($GLOBALS['memCache']['basic.custom.cvd']);
			if($c<1)return (!$n)?-3:$lnap."Signature file corrupted (basic.custom.cvd)!".$GLOBALS['linebreak'];
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['basic.custom.cvd'][$i];
				$vs="";
				if((substr_count($xsig,"=")>0)&&!(substr_count($xsig,"?")>0)&&!(substr_count($xsig,"*")>0))
					{
					$vn=@explode("=",$xsig);
					$xsig=@xhex($vn[1]);
					$vn=$vn[0];
					$l=@strlen($xsig);
					$xsig=strtoarray($xsig);
					$ng=false;
					for($x=0;$x<$l;$x++)
						{
						$ng=(!$ng)?true:false;
						if($ng)
							{
							$z=$x+1;
							$vs.=@chr(hexdec($xsig[$x].$xsig[$z]));
							}
						}
					$vsl=strlen($vs);
					if($vsl<=$str_len)if(substr_count($str,$vs)>0)
						{
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
						}
					}
				}
			}
		$xt=explode(".",$ofn);
		$xts=substr(strtolower($xt[count($xt)-1]),0,3)."*";
		$xt=strtolower($xt[count($xt)-1]);
		if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_php'])
			{
			if(!(substr_count("php*,",$xts.",")>0||substr_count($GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].",",$xts.",")>0||substr_count($GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].",",$xt.",")>0))
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
			if(substr_count("exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",$xt.",")>0)
				{
				if(!substr_compare_hex($str,0,2,"4d5a"))
					{
					$out.=$lnap."EXE chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="EXE chameleon attack detected (".$ofn.")! ";
					}
				}
			else
				{
				if(substr_compare_hex($str,0,2,"4d5a"))
					{
					$out.=$lnap."EXE chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="EXE chameleon attack detected (".$ofn.")! ";
					}
				}
			if($xt=="elf")
				{
				if(!substr_compare_hex($str,0,4,"7f454c46"))
					{
					$out.=$lnap."ELF chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="ELF chameleon attack detected (".$ofn.")! ";
					}
				}
			else
				{
				if(substr_compare_hex($str,0,4,"7f454c46"))
					{
					$out.=$lnap."ELF chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="ELF chameleon attack detected (".$ofn.")! ";
					}
				}
			}
		if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_archive'])
			{
			if($xts=="zip*")
				{
				if(!substr_compare_hex($str,0,2,"504b"))
					{
					$out.=$lnap."ZIP chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="ZIP chameleon attack detected (".$ofn.")! ";
					}
				}
			if($xt=="rar")
				{
				if(!substr_compare_hex($str,0,4,"52617221"))
					{
					$out.=$lnap."RAR chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="RAR chameleon attack detected (".$ofn.")! ";
					}
				}
			}
		if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_doc'])
			{
			if($xt=="doc")
				{
				if(!substr_compare_hex($str,0,4,"d0cf11e0"))
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
				if(!substr_compare_hex($str,0,2,"424d"))
					{
					$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
					}
				}
		/* Wrote it, tested it, didn't work. Commented out until fixed. Not sure what's up. Will fix it later. Remainder seem okay though. -Maik.
			if($xt=="png")
				{
				if(!substr_compare_hex($str,1,3,"504e47"))
					{
					$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
					}
				}
			if($xt=="jpg"||$xt=="jpeg")
				{
				if(!substr_compare_hex($str,0,6,"c3bfc398c3bf")&&!substr_compare_hex($str,0,4,"ffd8ffe0"))
					{
					$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
					}
				}
		*/
			if($xt=="gif")
				{
				if(!substr_compare_hex($str,0,6,"474946383761")&&!substr_compare_hex($str,0,6,"474946383961"))
					{
					$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
					}
				}
			if($xt=="xcf")
				{
				if(!substr_compare_hex($str,0,8,"67696d7020786366"))
					{
					$out.=$lnap."Image chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Image chameleon attack detected (".$ofn.")! ";
					}
				}
			if($xt=="psd"||$xt=="pdd")
				{
				if(!substr_compare_hex($str,0,4,"38425053"))
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
				if(!substr_compare_hex($str,0,4,"25504446"))
					{
					$out.=$lnap."PDF chameleon attack detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="PDF chameleon attack detected (".$ofn.")! ";
					}
				}
			}
		if($GLOBALS['MusselConfig']['attack_specific']['general_commands'])
			{
			if(!isset($GLOBALS['memCache']['hex_general_commands.csv']))$GLOBALS['memCache']['hex_general_commands.csv']=@explode(",",implode_md(file($GLOBALS['vault']."hex_general_commands.csv")));
			if(!$GLOBALS['memCache']['hex_general_commands.csv'])return (!$n)?-3:$lnap."Signature file missing (hex_general_commands.csv)!".$GLOBALS['linebreak'];
			$c=count($GLOBALS['memCache']['hex_general_commands.csv']);
			if($c<1)return (!$n)?-3:$lnap."Signature file corrupted (hex_general_commands.csv)!".$GLOBALS['linebreak'];
			if(!isset($str_norm))$str_norm=strtolower(str_replace("\t","",str_replace("\n","",str_replace("\r","",str_replace(" ","",$str)))));
			for($i=0;$i<$c;$i++)
				{
				$xgc=$GLOBALS['memCache']['hex_general_commands.csv'][$i];
				$xgcn="";
				$xgcl=strlen($xgc);
				$xng=false;
				for($xgci=0;$xgci<$xgcl;$xgci++)
					{
					$xng=(!$xng)?true:false;
					if($xng)
						{
						$xgcz=$xgci+1;
						$xgcn.=@chr(hexdec($xgc[$xgci].$xgc[$xgcz]));
						}
					}
				if(substr_count($str_norm,$xgcn)>0)
					{
					$out.=$lnap."Command injection attempt detected!".$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
					if($fm)$GLOBALS['xfm'].="Command injection attempt detected, '".urlencode($xgcn)."' (".$ofn.")! ";
					}
				}
			}
		if(!$out)return 1;
		return (!$n)?2:$out;
		}
	}

if(!function_exists("phpMusselR"))
	{
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
		$d=@is_file($f);
		if(!$d||!$f)return (!$n)?0:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Invalid file!".$GLOBALS['linebreak'];
		$fS=@filesize($f);
		if($GLOBALS['MusselConfig']['files']['filesize_limit']>0)
			{
			if($fS>$GLOBALS['MusselConfig']['files']['filesize_limit'])
				{
				if(!$GLOBALS['MusselConfig']['files']['filesize_response'])return (!$n)?1:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."OK (filesize limit exceeded).".$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$fS.":".$ofn.$GLOBALS['linebreak'];
				if($fm)$GLOBALS['xfm'].="Filesize limit exceeded (".$ofn.")! ";
				if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
				return (!$n)?2:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Bad (filesize limit exceeded).".$GLOBALS['linebreak'];
				}
			}
		$xt=explode(".",$ofn);
		$xts=substr(strtolower($xt[count($xt)-1]),0,3)."*";
		$xt=strtolower($xt[count($xt)-1]);
		if(substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$xt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$xts.",")>0)return (!$n)?1:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
		if(substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$xt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$xts.",")>0)
			{
			if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$fS.":".$ofn.$GLOBALS['linebreak'];
			if($fm)$GLOBALS['xfm'].="Blacklisted filetype detected (".$ofn.")! ";
			if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			return (!$n)?2:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."Filetype blacklisted.".$GLOBALS['linebreak'];
			}
		$in=@implode(file($f));
		$z=phpMusselD($in,$n,$dpt,$f,$ofn);
		if($z!==1)
			{
			if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			return (!$n)?$z:$lnap."Checking '".$ofn."':".$GLOBALS['linebreak'].$z;
			}
		$x=$lnap."Checking '".$ofn."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
		$r=1;
		if($GLOBALS['MusselConfig']['files']['check_archives'])
			{
			if($xts=="zip*"||substr($in,0,2)==="PK")
				{
				$lnap="-".$lnap;
				if(!$n)
					{
					$ok=(!function_exists("zip_open"))?false:true;
					if(!$ok)return -1;
					$fS=@zip_open($f);
					if(!$fS)return 0;
					}
				else
					{
					$ok=(!function_exists("zip_open"))?false:true;
					if(!$ok)return $lnap."Reading '".$ofn."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap."Failed (missing required extensions)!".$GLOBALS['linebreak'];
					$fS=@zip_open($f);
					if(!$fS)return $lnap."Reading '".$ofn."' (ZIP Archive):".$GLOBALS['linebreak']."-".$lnap."Failed (empty or not an archive)!".$GLOBALS['linebreak'];
					}
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
					else
						{
						$eN=@zip_entry_name($fD);
						$eS=@zip_entry_filesize($fD);
						if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
							{
							if($eS>$GLOBALS['MusselConfig']['files']['filesize_limit'])
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
						if($GLOBALS['MusselConfig']['files']['filetype_archives'])
							{
							$xt=explode(".",$eN);
							$xts=substr(strtolower($xt[count($xt)-1]),0,3)."*";
							$xt=strtolower($xt[count($xt)-1]);
							if(substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$xt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].",",$xts.",")>0)
								{
								$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."No problems found.".$GLOBALS['linebreak'];
								continue;
								}
							if(substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$xt.",")>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].",",$xts.",")>0)
								{
								$r=2;
								if($fm)$GLOBALS['xsk'].="00000000000000000000000000000000:".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Blacklisted filetype detected (".$ofn.">".$eN.")! ";
								$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Filetype blacklisted.".$GLOBALS['linebreak'];
								continue;
								}
							}
						$eD=@zip_entry_read($fD,$eS);
						if(!$eD||!$eS)
							{
							if($r!==2)$r=-2;
							$x.=$lnap."Checking '".$ofn."' > '".$eN."':".$GLOBALS['linebreak']."-".$lnap."Failed (corrupted data detected)!".$GLOBALS['linebreak'];
							continue;
							}
						$eFS=strlen($eD);
						$bad=phpMusselD($eD,$n,$dpt,$f.">".$eN,$eN);
						$zmd="";
						if($GLOBALS['MusselConfig']['clamav']['zip_metadata']&&$bi<2)
							{
							$zCRC=@hash("crc32b",$eD);
							if(!isset($GLOBALS['memCache']['zip_metadata.cvd']))$GLOBALS['memCache']['zip_metadata.cvd']=@file($GLOBALS['vault']."zip_metadata.cvd");
							if(!$GLOBALS['memCache']['zip_metadata.cvd'])
								{
								if($r!==2)$r=-3;
								$zmd.="-".$lnap."Signature file missing (zip_metadata.cvd)!".$GLOBALS['linebreak'];
								}
							$zmdc=count($GLOBALS['memCache']['zip_metadata.cvd']);
							if($zmdc<1)
								{
								if($r!==2)$r=-3;
								$zmd.="-".$lnap."Signature file corrupted (zip_metadata.cvd)!".$GLOBALS['linebreak'];
								}
							$zmdv="";
							for($zmdi=0;$zmdi<$zmdc;$zmdi++)
								{
								$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata.cvd'][$zmdi]);
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
									}
								}
							if(!isset($GLOBALS['memCache']['zip_metadata.custom.cvd']))$GLOBALS['memCache']['zip_metadata.custom.cvd']=@file($GLOBALS['vault']."zip_metadata.custom.cvd");
							if(!$GLOBALS['memCache']['zip_metadata.custom.cvd'])
								{
								if($r!==2)$r=-3;
								$zmd.="-".$lnap."Signature file missing (zip_metadata.custom.cvd)!".$GLOBALS['linebreak'];
								}
							$zmdc=count($GLOBALS['memCache']['zip_metadata.custom.cvd']);
							if($zmdc<1)
								{
								if($r!==2)$r=-3;
								$zmd.="-".$lnap."Signature file corrupted (zip_metadata.custom.cvd)!".$GLOBALS['linebreak'];
								}
							$zmdv="";
							for($zmdi=0;$zmdi<$zmdc;$zmdi++)
								{
								$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata.custom.cvd'][$zmdi]);
								if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
									{
									$r=2;
									$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
									if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
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
				}
			if($r===2&&$GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			}
		return (!$n)?$r:$x;
		}
	}

if(!function_exists("phpMussel"))
	{
	function phpMussel($f="",$n=0,$zz=0,$dpt=0,$ofn="")
		{
		if(!$ofn)$ofn=@urlencode($f);
		if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0)$s=date("r")." Started.".$GLOBALS['linebreak'];
		$r=phpMusselR($f,$n,$zz,$dpt,$ofn);
		if($GLOBALS['MusselConfig']['general']['scan_log']&&$n!=0&&!is_array($r))
			{
			if(!file_exists($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log']))$r="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'].$r;
			$r=$s.$r.date("r")." Finished.".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
			$xf=fopen($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log'],"a");
			fwrite($xf,$r);
			fclose($xf);
			}
		return $r;
		}
	}

if(!is_dir($vault))die("[phpMussel] Vault directory not correctly set: Can\'t continue. Refer to README.TXT if this is a first-time run, or refer to the forums if problems persist.");
$MusselConfig=parse_ini_file($vault."phpmussel.ini",true);
if(!is_array($MusselConfig))die("[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to README.TXT if this is a first-time run, or refer to the forums if problems persist.");
$memCache=array();
$c=count($_FILES);
$xfm=$xsk="";
if($c>0)
	{
	if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
		{
		if($GLOBALS['MusselConfig']['general']['scan_log'])$s=date("r")." Started.".$GLOBALS['linebreak'];
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
		if($GLOBALS['MusselConfig']['general']['scan_log'])
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
	if($GLOBALS['MusselConfig']['general']['scan_kills']&&strlen($xsk)>0)
		{
		$skd="";
		$ipaddr=(isset($_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']]))?$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']]:$_SERVER['REMOTE_ADDR'];
		if(!file_exists($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_kills']))$skd="<?php die(); ?>".$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skd.="DATE: ".date("r").$GLOBALS['linebreak']."IP ADDRESS: ".$ipaddr.$GLOBALS['linebreak']."== SCAN RESULTS: ==".$GLOBALS['linebreak'].$xfm.$GLOBALS['linebreak']."== RECONSTRUCTED SIGNATURES: ==".$GLOBALS['linebreak'].$xsk.$GLOBALS['linebreak'].$GLOBALS['linebreak'];
		$skf=fopen($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_kills'],"a");
		fwrite($skf,$skd);
		fclose($skf);
		}
	$html=implode_md(file($GLOBALS['vault']."template.html"));
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
if($MusselConfig['general']['cleanup'])unset($tk,$ti,$tc,$r,$xsk,$xfm,$k,$i,$c,$memCache,$MusselConfig,$phpmusselversion,$vault);

?>