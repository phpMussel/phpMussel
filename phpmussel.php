<?php
/*
      _____  _     _  _____  _______ _     _ _______ _______ _______   v0.2a   
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
 phpMussel version 0.2a (main script by Maikuolan, signatures by ClamAV).
 Last Updated (phpMussel, this version): 1st October 2013.
 
 Special thanks to ClamAV for both project inspiration and for the signature
 files that this script utilises, without which, the script would simply not
 exist, or at best, would have very limited value.
 Default signatures included with this version of phpMussel derived from
 mainlined signatures version 55 ("main.cvd"), released 17th September 2013.
 Both ClamAV and the latest copy of its (unmodified) signatures can be
 found at:
  http://www.clamav.net/lang/en/
 
 Special thanks to Zaphod and Spambot Security for giving the project a home
 via hosting and forums.
  http://www.spambotsecurity.com/forum/index.php
 
 Special thanks to all those supporting the project, and to you, for using
 the script.
 
 Also.. To anyone else that I should be mentioning that I haven't. I felt that
 I should probably include something like this (special thanks notice) in the
 script, but I don't have much experience and kind of suck at them, I'm not
 entirely sure what I should and shouldn't write here, so, whatever. Maybe I'll
 improve it with future versions or something. :)
 
 For help or support with the script (if you need it), you can find and contact
 me at Spambot Security or Game Jaunt.
  http://www.spambotsecurity.com/forum/memberlist.php?mode=viewprofile&u=516
  http://www.gamejaunt.com/contact.php
  http://www.gamejaunt.com/profile/Maikuolan/
                                  ~ ~ ~                                        

 The only part of this script that you should need to modify in order for it to
 work on your CMS or website is the $vault variable.
 
 Please refer to "readme.txt" for specific installation instructions and for
 instructions on how to correctly use phpMussel.
 
 Regards,
 Maikuolan.
*/

$vault="/your_user/public_html/some_dir/phpmussel/vault/";

if(!defined('phpMussel'))
	{
	if(!isset($_SERVER['REMOTE_ADDR']))$_SERVER['REMOTE_ADDR']="";
	$phpmusselversion="phpMussel v0.2a";
	$display_errors=error_reporting(0);
	$linebreak=chr(13).chr(10);
	define('phpMussel',true);
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
		if(!$str_len=strlen($str))return false;
		$out="";
		$md5=md5($str);
		if($GLOBALS['MusselConfig']['clamav']['md5'])
			{
			if(!isset($GLOBALS['memCache']['md5_standard.cvd']))$GLOBALS['memCache']['md5_standard.cvd']=@implode_md(file($GLOBALS['vault']."md5_standard.cvd"));
			if(!$GLOBALS['memCache']['md5_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (md5_standard.cvd)!".$GLOBALS['linebreak'];
			if(substr_count($GLOBALS['memCache']['md5_standard.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5_standard.cvd'],2);
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
		if($GLOBALS['MusselConfig']['clamav']['md5_custom'])
			{
			if(!isset($GLOBALS['memCache']['md5_custom.cvd']))$GLOBALS['memCache']['md5_custom.cvd']=@implode_md(file($GLOBALS['vault']."md5_custom.cvd"));
			if(!$GLOBALS['memCache']['md5_custom.cvd'])return (!$n)?-3:$lnap."Signature file missing (md5_custom.cvd)!".$GLOBALS['linebreak'];
			if(substr_count($GLOBALS['memCache']['md5_custom.cvd'],$md5)>0)
				{
				$xsig=explode($md5.":",$GLOBALS['memCache']['md5_custom.cvd'],2);
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
		if($GLOBALS['MusselConfig']['clamav']['general'])
			{
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if(!isset($GLOBALS['memCache']['general_standard.cvd']))$GLOBALS['memCache']['general_standard.cvd']=@file($GLOBALS['vault']."general_standard.cvd");
			if(!$GLOBALS['memCache']['general_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (general_standard.cvd)!".$GLOBALS['linebreak'];
			if(!isset($GLOBALS['memCache']['general_standard.map']))$GLOBALS['memCache']['general_standard.map']=@file($GLOBALS['vault']."general_standard.map");
			if(!$GLOBALS['memCache']['general_standard.map'])return (!$n)?-3:$lnap."Signature map missing (general_standard.map)!".$GLOBALS['linebreak'];
			$c=@count($GLOBALS['memCache']['general_standard.map']);
			if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (general_standard.map)!".$GLOBALS['linebreak'];
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['general_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
						{
						$xsig=$GLOBALS['memCache']['general_standard.cvd'][$xind];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
			if(!isset($GLOBALS['memCache']['general_regex.cvd']))$GLOBALS['memCache']['general_regex.cvd']=@file($GLOBALS['vault']."general_regex.cvd");
			if(!$GLOBALS['memCache']['general_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (general_regex.cvd)!".$GLOBALS['linebreak'];
			if(!isset($GLOBALS['memCache']['general_regex.map']))$GLOBALS['memCache']['general_regex.map']=@file($GLOBALS['vault']."general_regex.map");
			if(!$GLOBALS['memCache']['general_regex.map'])return (!$n)?-3:$lnap."Signature map missing (general_regex.map)!".$GLOBALS['linebreak'];
			$c=@count($GLOBALS['memCache']['general_regex.map']);
			if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (general_regex.map)!".$GLOBALS['linebreak'];
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['general_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($str_hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
						{
						$xsig=$GLOBALS['memCache']['general_regex.cvd'][$xind];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
		if($GLOBALS['MusselConfig']['clamav']['general_custom'])
			{
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if(!isset($GLOBALS['memCache']['general_custom_standard.cvd']))$GLOBALS['memCache']['general_custom_standard.cvd']=@file($GLOBALS['vault']."general_custom_standard.cvd");
			if(!$GLOBALS['memCache']['general_custom_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (general_custom_standard.cvd)!".$GLOBALS['linebreak'];
			$c=@count($GLOBALS['memCache']['general_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_standard.cvd'][$i];
				$vs="";
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$vn=$vn[0];
					if(substr_count($str_hex,$xsig)>0)
						{
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
						}
					}
				}
			if(!isset($GLOBALS['memCache']['general_custom_regex.cvd']))$GLOBALS['memCache']['general_custom_regex.cvd']=@file($GLOBALS['vault']."general_custom_regex.cvd");
			if(!$GLOBALS['memCache']['general_custom_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (general_custom_regex.cvd)!".$GLOBALS['linebreak'];
			$c=@count($GLOBALS['memCache']['general_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['general_custom_regex.cvd'][$i];
				$vs="";
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$vn=$vn[0];
					if(preg_match("/".$xsig."/i",$str_hex))
						{
						$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
						if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
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
		if($GLOBALS['MusselConfig']['clamav']['exe']||$GLOBALS['MusselConfig']['clamav']['exe_custom'])
			{
			if(substr_count(",exe,dll,ocx,acm,ax,cpl,drv,com,scr,rs,sys,",",".$xt.",")>0||substr($str,0,2)==="MZ")
				{
				if(!isset($str_hex))$str_hex=@bin2hex($str);
				if($GLOBALS['MusselConfig']['clamav']['exe'])
					{
					if(!isset($GLOBALS['memCache']['exe_standard.cvd']))$GLOBALS['memCache']['exe_standard.cvd']=@file($GLOBALS['vault']."exe_standard.cvd");
					if(!$GLOBALS['memCache']['exe_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (exe_standard.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['exe_standard.map']))$GLOBALS['memCache']['exe_standard.map']=@file($GLOBALS['vault']."exe_standard.map");
					if(!$GLOBALS['memCache']['exe_standard.map'])return (!$n)?-3:$lnap."Signature map missing (exe_standard.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['exe_standard.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (exe_standard.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['exe_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['exe_standard.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
					if(!isset($GLOBALS['memCache']['exe_regex.cvd']))$GLOBALS['memCache']['exe_regex.cvd']=@file($GLOBALS['vault']."exe_regex.cvd");
					if(!$GLOBALS['memCache']['exe_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (exe_regex.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['exe_regex.map']))$GLOBALS['memCache']['exe_regex.map']=@file($GLOBALS['vault']."exe_regex.map");
					if(!$GLOBALS['memCache']['exe_regex.map'])return (!$n)?-3:$lnap."Signature map missing (exe_regex.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['exe_regex.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (exe_regex.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['exe_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['exe_regex.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
				if($GLOBALS['MusselConfig']['clamav']['exe_custom'])
					{
					if(!isset($GLOBALS['memCache']['exe_custom_standard.cvd']))$GLOBALS['memCache']['exe_custom_standard.cvd']=@file($GLOBALS['vault']."exe_custom_standard.cvd");
					if(!$GLOBALS['memCache']['exe_custom_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (exe_custom_standard.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['exe_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_standard.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(substr_count($str_hex,$xsig)>0)
								{
								$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
								}
							}
						}
					if(!isset($GLOBALS['memCache']['exe_custom_regex.cvd']))$GLOBALS['memCache']['exe_custom_regex.cvd']=@file($GLOBALS['vault']."exe_custom_regex.cvd");
					if(!$GLOBALS['memCache']['exe_custom_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (exe_custom_regex.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['exe_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['exe_custom_regex.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
		if($GLOBALS['MusselConfig']['clamav']['elf']||$GLOBALS['MusselConfig']['clamav']['elf_custom'])
			{
			if(!isset($str_hex))$str_hex=@bin2hex($str);
			if($xt=="elf"||substr_compare_hex($str,0,4,"7f454c46",1))
				{
				if($GLOBALS['MusselConfig']['clamav']['elf'])
					{
					if(!isset($GLOBALS['memCache']['elf_standard.cvd']))$GLOBALS['memCache']['elf_standard.cvd']=@file($GLOBALS['vault']."elf_standard.cvd");
					if(!$GLOBALS['memCache']['elf_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (elf_standard.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['elf_standard.map']))$GLOBALS['memCache']['elf_standard.map']=@file($GLOBALS['vault']."elf_standard.map");
					if(!$GLOBALS['memCache']['elf_standard.map'])return (!$n)?-3:$lnap."Signature map missing (elf_standard.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['elf_standard.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (elf_standard.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['elf_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['elf_standard.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
					if(!isset($GLOBALS['memCache']['elf_regex.cvd']))$GLOBALS['memCache']['elf_regex.cvd']=@file($GLOBALS['vault']."elf_regex.cvd");
					if(!$GLOBALS['memCache']['elf_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (elf_regex.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['elf_regex.map']))$GLOBALS['memCache']['elf_regex.map']=@file($GLOBALS['vault']."elf_regex.map");
					if(!$GLOBALS['memCache']['elf_regex.map'])return (!$n)?-3:$lnap."Signature map missing (elf_regex.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['elf_regex.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (elf_regex.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['elf_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['elf_regex.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
				if($GLOBALS['MusselConfig']['clamav']['elf_custom'])
					{
					if(!isset($GLOBALS['memCache']['elf_custom_standard.cvd']))$GLOBALS['memCache']['elf_custom_standard.cvd']=@file($GLOBALS['vault']."elf_custom_standard.cvd");
					if(!$GLOBALS['memCache']['elf_custom_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (elf_custom_standard.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['elf_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_standard.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(substr_count($str_hex,$xsig)>0)
								{
								$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
								}
							}
						}
					if(!isset($GLOBALS['memCache']['elf_custom_regex.cvd']))$GLOBALS['memCache']['elf_custom_regex.cvd']=@file($GLOBALS['vault']."elf_custom_regex.cvd");
					if(!$GLOBALS['memCache']['elf_custom_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (elf_custom_regex.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['elf_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['elf_custom_regex.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
		if($GLOBALS['MusselConfig']['clamav']['graphics']||$GLOBALS['MusselConfig']['clamav']['graphics_custom'])
			{
			if(substr_count(",avi,bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdr,img,jpeg,jpg,jps,mov,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,webp,wmf,xbm,xbmp,xcf,xvl,",",".$xt.",")>0)
				{
				if(!isset($str_norm))$str_norm=strtolower(str_replace("\t","",str_replace("\n","",str_replace("\r","",str_replace(" ","",$str)))));
				if(!isset($str_hex))$str_hex=@bin2hex($str);
				if($GLOBALS['MusselConfig']['clamav']['graphics'])
					{
					if(!isset($GLOBALS['memCache']['graphics_standard.cvd']))$GLOBALS['memCache']['graphics_standard.cvd']=@file($GLOBALS['vault']."graphics_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (graphics_standard.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['graphics_standard.map']))$GLOBALS['memCache']['graphics_standard.map']=@file($GLOBALS['vault']."graphics_standard.map");
					if(!$GLOBALS['memCache']['graphics_standard.map'])return (!$n)?-3:$lnap."Signature map missing (graphics_standard.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['graphics_standard.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (graphics_standard.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['graphics_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['graphics_standard.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
					if(!isset($GLOBALS['memCache']['graphics_regex.cvd']))$GLOBALS['memCache']['graphics_regex.cvd']=@file($GLOBALS['vault']."graphics_regex.cvd");
					if(!$GLOBALS['memCache']['graphics_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (graphics_regex.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['graphics_regex.map']))$GLOBALS['memCache']['graphics_regex.map']=@file($GLOBALS['vault']."graphics_regex.map");
					if(!$GLOBALS['memCache']['graphics_regex.map'])return (!$n)?-3:$lnap."Signature map missing (graphics_regex.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['graphics_regex.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (graphics_regex.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['graphics_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['graphics_regex.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
				if($GLOBALS['MusselConfig']['clamav']['graphics_custom'])
					{
					if(!isset($GLOBALS['memCache']['graphics_custom_standard.cvd']))$GLOBALS['memCache']['graphics_custom_standard.cvd']=@file($GLOBALS['vault']."graphics_custom_standard.cvd");
					if(!$GLOBALS['memCache']['graphics_custom_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (graphics_custom_standard.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['graphics_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_standard.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(substr_count($str_hex,$xsig)>0)
								{
								$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
								}
							}
						}
					if(!isset($GLOBALS['memCache']['graphics_custom_regex.cvd']))$GLOBALS['memCache']['graphics_custom_regex.cvd']=@file($GLOBALS['vault']."graphics_custom_regex.cvd");
					if(!$GLOBALS['memCache']['graphics_custom_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (graphics_custom_regex.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['graphics_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['graphics_custom_regex.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
		if($GLOBALS['MusselConfig']['clamav']['macho']||$GLOBALS['MusselConfig']['clamav']['macho_custom'])
			{
			if(@preg_match("/(cafebabe)|(cafed00d)|(cefaedfe)|(cffaedfe)|(feedface)|(feedfacf)/i",dechex(substr($str,0,4))))
				{
				if(!isset($str_hex))$str_hex=@bin2hex($str);
				if($GLOBALS['MusselConfig']['clamav']['macho'])
					{
					if(!isset($GLOBALS['memCache']['macho_standard.cvd']))$GLOBALS['memCache']['macho_standard.cvd']=@file($GLOBALS['vault']."macho_standard.cvd");
					if(!$GLOBALS['memCache']['macho_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (macho_standard.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['macho_standard.map']))$GLOBALS['memCache']['macho_standard.map']=@file($GLOBALS['vault']."macho_standard.map");
					if(!$GLOBALS['memCache']['macho_standard.map'])return (!$n)?-3:$lnap."Signature map missing (macho_standard.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['macho_standard.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (macho_standard.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['macho_standard.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['macho_standard.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
					if(!isset($GLOBALS['memCache']['macho_regex.cvd']))$GLOBALS['memCache']['macho_regex.cvd']=@file($GLOBALS['vault']."macho_regex.cvd");
					if(!$GLOBALS['memCache']['macho_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (macho_regex.cvd)!".$GLOBALS['linebreak'];
					if(!isset($GLOBALS['memCache']['macho_regex.map']))$GLOBALS['memCache']['macho_regex.map']=@file($GLOBALS['vault']."macho_regex.map");
					if(!$GLOBALS['memCache']['macho_regex.map'])return (!$n)?-3:$lnap."Signature map missing (macho_regex.map)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['macho_regex.map']);
					if($c<1)return (!$n)?-3:$lnap."Signature map corrupted (macho_regex.map)!".$GLOBALS['linebreak'];
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$map=explode(":",$GLOBALS['memCache']['macho_regex.map'][$i]);
						$map[2]=($map[2]*-1)*-1;
						if(substr_count($str_hex,$map[0])>0)
							{
							for($xind=$map[1];$xind<$map[2];$xind++)
								{
								$xsig=$GLOBALS['memCache']['macho_regex.cvd'][$xind];
								$vs="";
								if(substr_count($xsig,":")>0)
									{
									$vn=@explode(":",$xsig);
									$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
									$xsig=($xsig===false?"":implode("",$xsig));
									$vn=$vn[0];
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
				if($GLOBALS['MusselConfig']['clamav']['macho_custom'])
					{
					if(!isset($GLOBALS['memCache']['macho_custom_standard.cvd']))$GLOBALS['memCache']['macho_custom_standard.cvd']=@file($GLOBALS['vault']."macho_custom_standard.cvd");
					if(!$GLOBALS['memCache']['macho_custom_standard.cvd'])return (!$n)?-3:$lnap."Signature file missing (macho_custom_standard.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['macho_custom_standard.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_standard.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(substr_count($str_hex,$xsig)>0)
								{
								$out.=$lnap."Detected ".$vn."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=$md5.":".$str_len.":".$ofn.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$vn." (".$ofn.")! ";
								}
							}
						}
					if(!isset($GLOBALS['memCache']['macho_custom_regex.cvd']))$GLOBALS['memCache']['macho_custom_regex.cvd']=@file($GLOBALS['vault']."macho_custom_regex.cvd");
					if(!$GLOBALS['memCache']['macho_custom_regex.cvd'])return (!$n)?-3:$lnap."Signature file missing (macho_custom_regex.cvd)!".$GLOBALS['linebreak'];
					$c=@count($GLOBALS['memCache']['macho_custom_regex.cvd']);
					$vn="";
					for($i=0;$i<$c;$i++)
						{
						$xsig=$GLOBALS['memCache']['macho_custom_regex.cvd'][$i];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
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
					if($GLOBALS['MusselConfig']['clamav']['zip_metadata'])
						{
						if(!isset($GLOBALS['memCache']['zip_metadata_standard.cvd']))$GLOBALS['memCache']['zip_metadata_standard.cvd']=@file($GLOBALS['vault']."zip_metadata_standard.cvd");
						if(!$GLOBALS['memCache']['zip_metadata_standard.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file missing (zip_metadata_standard.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['zip_metadata_standard.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file corrupted (zip_metadata_standard.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_standard.cvd'][$zmdi]);
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
								}
							}
						}
					if($GLOBALS['MusselConfig']['clamav']['zip_metadata_custom'])
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
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($fD).":".$eS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
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
					if($GLOBALS['MusselConfig']['clamav']['zip_metadata']&&$bi<2)
						{
						if(!isset($GLOBALS['memCache']['zip_metadata_standard.cvd']))$GLOBALS['memCache']['zip_metadata_standard.cvd']=@file($GLOBALS['vault']."zip_metadata_standard.cvd");
						if(!$GLOBALS['memCache']['zip_metadata_standard.cvd'])
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file missing (zip_metadata_standard.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdc=count($GLOBALS['memCache']['zip_metadata_standard.cvd']);
						if($zmdc<1)
							{
							if($r!==2)$r=-3;
							$zmd.="-".$lnap."Signature file corrupted (zip_metadata_standard.cvd)!".$GLOBALS['linebreak'];
							}
						$zmdv="";
						for($zmdi=0;$zmdi<$zmdc;$zmdi++)
							{
							$zmds=@explode(":",$GLOBALS['memCache']['zip_metadata_standard.cvd'][$zmdi]);
							if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
								{
								$r=2;
								$zmd.="-".$lnap."Detected ".$zmds[0]."!".$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xsk'].=md5($eD).":".$eFS.":".$ofn.">".$eN.$GLOBALS['linebreak'];
								if($fm)$GLOBALS['xfm'].="Detected ".$zmds[0]." (".$ofn.">".$eN.")! ";
								}
							}
						}
					if($GLOBALS['MusselConfig']['clamav']['zip_metadata_custom']&&$bi<2)
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
			if($r===2&&$GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
			}
		return (!$n)?$r:$x;
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
		if(!$len=strlen($body)||!isset($GLOBALS['MusselConfig']['clamav']['mail']))return -1;
		$hex=@bin2hex($body);
		if($GLOBALS['MusselConfig']['clamav']['mail'])
			{
			if(!isset($GLOBALS['memCache']['mail_standard.cvd']))$GLOBALS['memCache']['mail_standard.cvd']=@file($GLOBALS['vault']."mail_standard.cvd");
			if(!$GLOBALS['memCache']['mail_standard.cvd'])return -1;
			if(!isset($GLOBALS['memCache']['mail_standard.map']))$GLOBALS['memCache']['mail_standard.map']=@file($GLOBALS['vault']."mail_standard.map");
			if(!$GLOBALS['memCache']['mail_standard.map'])return -1;
			$c=@count($GLOBALS['memCache']['mail_standard.map']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['mail_standard.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
						{
						$xsig=$GLOBALS['memCache']['mail_standard.cvd'][$xind];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(substr_count($hex,$xsig)>0)$f.="Detected ".$vn."! ";
							}
						}
					}
				}
			if(!isset($GLOBALS['memCache']['mail_regex.cvd']))$GLOBALS['memCache']['mail_regex.cvd']=@file($GLOBALS['vault']."mail_regex.cvd");
			if(!$GLOBALS['memCache']['mail_regex.cvd'])return -1;
			if(!isset($GLOBALS['memCache']['mail_regex.map']))$GLOBALS['memCache']['mail_regex.map']=@file($GLOBALS['vault']."mail_regex.map");
			if(!$GLOBALS['memCache']['mail_regex.map'])return -1;
			$c=@count($GLOBALS['memCache']['mail_regex.map']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$map=explode(":",$GLOBALS['memCache']['mail_regex.map'][$i]);
				$map[2]=($map[2]*-1)*-1;
				if(substr_count($hex,$map[0])>0)
					{
					for($xind=$map[1];$xind<$map[2];$xind++)
						{
						$xsig=$GLOBALS['memCache']['mail_regex.cvd'][$xind];
						$vs="";
						if(substr_count($xsig,":")>0)
							{
							$vn=@explode(":",$xsig);
							$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
							$xsig=($xsig===false?"":implode("",$xsig));
							$vn=$vn[0];
							if(preg_match("/".$xsig."/i",$hex))$f.="Detected ".$vn."! ";
							}
						}
					}
				}
			}
		if($GLOBALS['MusselConfig']['clamav']['mail_custom'])
			{
			if(!isset($GLOBALS['memCache']['mail_custom_standard.cvd']))$GLOBALS['memCache']['mail_custom_standard.cvd']=@file($GLOBALS['vault']."mail_custom_standard.cvd");
			if(!$GLOBALS['memCache']['mail_custom_standard.cvd'])return -1;
			$c=@count($GLOBALS['memCache']['mail_custom_standard.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_custom_standard.cvd'][$i];
				$vs="";
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[^a-fA-F0-9]*/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$vn=$vn[0];
					if(substr_count($hex,$xsig)>0)$f.="Detected ".$vn."! ";
					}
				}
			if(!isset($GLOBALS['memCache']['mail_custom_regex.cvd']))$GLOBALS['memCache']['mail_custom_regex.cvd']=@file($GLOBALS['vault']."mail_custom_regex.cvd");
			if(!$GLOBALS['memCache']['mail_custom_regex.cvd'])return -1;
			$c=@count($GLOBALS['memCache']['mail_custom_regex.cvd']);
			$vn="";
			for($i=0;$i<$c;$i++)
				{
				$xsig=$GLOBALS['memCache']['mail_custom_regex.cvd'][$i];
				$vs="";
				if(substr_count($xsig,":")>0)
					{
					$vn=@explode(":",$xsig);
					$xsig=@preg_split('/[\x00-\x1f]*/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
					$xsig=($xsig===false?"":implode("",$xsig));
					$vn=$vn[0];
					if(preg_match("/".$xsig."/i",$hex))$f.="Detected ".$vn."! ";
					}
				}
			}
		return (!$f)?0:$f;
		}
	if(!is_dir($vault))die("[phpMussel] Vault directory not correctly set: Can\'t continue. Refer to README.TXT if this is a first-time run, or refer to the forums if problems persist.");
	$MusselConfig=parse_ini_file($vault."phpmussel.ini",true);
	if(!is_array($MusselConfig))die("[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to README.TXT if this is a first-time run, or refer to the forums if problems persist.");
	$memCache=array();
	$c=empty($_FILES)?0:count($_FILES);
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
	$display_errors=error_reporting($display_errors);
	if($MusselConfig['general']['cleanup'])unset($tk,$ti,$tc,$r,$xsk,$xfm,$k,$i,$c,$memCache,$MusselConfig,$display_errors,$phpmusselversion,$vault);
	}
else
	{
	die("[phpMussel] Multiple instances active!");
	}

?>