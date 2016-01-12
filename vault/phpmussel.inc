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
 This file: phpMussel v0.9.2 (13th January 2016) core script.
 <%phpMussel%/vault/phpmussel.inc>

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
 * This file: Core phpMussel script (contains all the main functions and etc).
 *
 * @package Maikuolan/phpMussel
 *
 * @todo Archive support should extend to include RAR, SHAR and 7z, if possible (github.com/Maikuolan/phpMussel/issues/2).
 * @todo ZIP support and future support for other archive formats should be made to be recursive.
 * @todo Wish list: Icon parsing (github.com/Maikuolan/phpMussel/issues/5).
 * @todo Wish list: Certificate parsing (github.com/Maikuolan/phpMussel/issues/4).
 * @todo Fix client language bug (github.com/Maikuolan/phpMussel/issues/28).
 * @todo Get serialised logging working for CLI mode (github.com/Maikuolan/phpMussel/issues/54).
 * @todo Fix non-ANSI/non-ASCII filenames in CLI mode bug (github.com/Maikuolan/phpMussel/issues/61).
 * @todo Complete Google Safe Browsing integration (github.com/Maikuolan/phpMussel/issues/65).
 * @todo Improve data decoding procedures.
 */

/**
 * Prevents execution from outside of phpMussel.
 */
if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$phpmusselversion='phpMussel v0.9.2';
$phpmusselversion_int='0.9.2';
$linebreak=chr(10);
$time=time();
if(!isset($MusselConfig['general']['ipaddr']))$MusselConfig['general']['ipaddr']='REMOTE_ADDR';
if(!isset($_SERVER[$MusselConfig['general']['ipaddr']]))$_SERVER[$MusselConfig['general']['ipaddr']]='';
$inidefaults=array();
$inidefaults['display_errors']=@ini_get('display_errors');
@ini_set('display_errors','1');
$inidefaults['backtrack_limit']=@ini_get('pcre.backtrack_limit');
@ini_set('pcre.backtrack_limit','4K');
$inidefaults['recursion_limit']=@ini_get('pcre.recursion_limit');
@ini_set('pcre.recursion_limit','4K');
$inidefaults['default_charset']=@ini_get('default_charset');
@ini_set('default_charset','utf-8');
$inidefaults['internal_encoding']=@ini_get('mbstring.internal_encoding');
@ini_set('mbstring.internal_encoding','UTF-8');
$inidefaults['user_agent']=@ini_get('user_agent');
$phpmusselua=$phpmusselversion.' ('.hash('crc32b',$_SERVER['SERVER_ADDR']).'-'.hash('crc32b',$_SERVER['HTTP_HOST']).')';
@ini_set('user_agent',$phpmusselua);
$memCache=array();
$memCache['eof']=false;
$phpmusselsafety="\x3c\x3f".'php die; '."\x3f\x3e";

if(!function_exists('implode_md'))
    {
    /**
     * A function for imploding multidimensional arrays.
     *
     * @param array $ar The array to be imploded.
     * @param string|array $j A "needle" or "joiner" to use for imploding the array (optional). If a numeric array is used, an element of the array corresponding to the recursion depth will be used as the needle or joiner.
     * @param int $i Used by the function when calling itself recursively, for the purpose of tracking recursion depth (shouldn't be used outside the function).
     * @param bool $e When set to false, empty elements will be ignored (optional).
     * @return string The imploded array.
     */
    function implode_md($ar,$j='',$i=0,$e=true)
        {
        if(!is_array($ar))return $ar;
        $c=count($ar);
        if(is_array($i)||!$c)return false;
        if(is_array($j))
            {
            if(!$x=$j[$i])return false;
            }
        else $x=$j;
        $out='';
        while($c>0)
            {
            $key=key($ar);
            if(is_array($ar[$key]))
                {
                $i++;
                $ar[$key]=implode_md($ar[$key],$j,$i);
                $i--;
                }
            if(!$out)$out=$ar[$key];
            else if(!(!$e&&empty($ar[$key])))$out.=$x.$ar[$key];
            next($ar);
            $c--;
            }
        return $out;
        }
    }

if(!function_exists('str_split'))
    {
    /**
     * A fallback function for `str_split()` (it converts strings to arrays).
     *
     * @param string $s The string to be converted/split.
     * @return array The converted/split string.
     */
    function str_split($s)
        {
        return preg_split("//",$s,-1,PREG_SPLIT_NO_EMPTY);
        }
    }

if(!function_exists('substr_compare_hex'))
    {
    /**
     * A function for comparing substrings with hex values.
     *
     * @param string $str The source/raw string to be compared.
     * @param int $st At what point in the source/raw string should the comparing begin (optional)? The first character of the string starts at "0".
     * @param int $l For how many bytes of the string, starting from `$st`, should the comparing occur (optional)? Defaults to the total length of the string.
     * @param string $x The hexadecimal value to compare the string against.
     * @param bool $p When set to false, the function will return true if the hexadecimal value can be matched to at least some part of the substring being compared; When set to true, the function will return true if the hexadecimal value is an exact match to the entirety of the substring being compared (optional).
     * @return bool The results of the comparison (true if matched, false if not matched).
     */
    function substr_compare_hex($str='',$st=0,$l=0,$x=0,$p=false)
        {
        if(!$l)$l=strlen($str);
        if(!$x||!$l)return false;
        for($str=substr($str,$st,$l),$y='',$i=0;$i<$l;$i++)
            {
            $z=dechex(ord($str[$i]));
            if(strlen($z)===1)$z='0'.$z;
            $y.=$z;
            }
        if(!$p)return (substr_count($y,strtolower($x))>0)?true:false;
        return ($y===strtolower($x))?true:false;
        }
    }

if(!function_exists('bin2hex'))
    {
    /**
     * A fallback function for `bin2hex()` (it converts binary strings to hexadecimal values).
     *
     * @param string $str The string to be converted.
     * @return string The converted string.
     */
    function bin2hex($str)
        {
        $l=strlen($str);
        for($y='',$i=0;$i<$l;$i++)
            {
            $z=dechex(ord($str[$i]));
            if(strlen($z)===1)$z='0'.$z;
            $y.=$z;
            }
        return $y;
        }
    }

if(!function_exists('hex2bin'))
    {
    /**
     * A fallback function for `hex2bin()` (it converts hexadecimal values to binary strings).
     *
     * @param string $str The string to be converted.
     * @return string The converted string.
     */
    function hex2bin($str)
        {
        $l=strlen($str);
        for($n='',$x=false,$i=0;$i<$l;$i++)
            {
            $x=(!$x)?true:false;
            if($x)
                {
                $z=$i+1;
                $n.=chr(hexdec($str[$i].$str[$z]));
                }
            }
        return $n;
        }
    }

if(!function_exists('prescan_decode'))
    {
    /**
     * A function for doing some very simplistic decoding work on strings prior to their use in various contexts.
     *
     * @param string $str The string to be decoded.
     * @return string The decoded string.
     */
    function prescan_decode($str)
        {
        $nstr=html_entity_decode(urldecode(str_ireplace('&amp;#','&#',str_ireplace('&amp;amp;','&amp;',$str))));
        if($nstr!==$str)$nstr=prescan_decode($nstr);
        return $nstr;
        }
    }

if(!function_exists('prescan_normalise'))
    {
    /**
     * A function for doing some more complex decoding and normalisation work on strings prior to their use in various
     * contexts.
     *
     * @param string $str The string to be decoded/normalised.
     * @param bool $html If true, "style" and "script" tags will be stripped from the input string (optional; defaults to false).
     * @param bool $decode If false, the input string will be normalised, but not decoded; If true, the input string will be normalised -and- decoded (optional; defaults to false).
     * @return string The decoded/normalised string.
     *
     * @todo There are many common forms of obfuscation and packing that aren't yet being detected, decoded or normalised by the function; The capabilities of the function needs to eventually be expanded upon, in order to resolve this and thus improve upon the defensive capabilities of phpMussel as a whole.
     */
    function prescan_normalise($str,$html=false,$decode=false)
        {
        $ostr='';
        if($decode)
            {
            $ostr.=$str;
            while(true)
                {
                if(function_exists('gzinflate'))
                    {
                    if($c=preg_match_all("/(gzinflate\s*\(\s*str_rot13\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.gzinflate(str_rot13(base64_decode(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[4][$i])))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(gzinflate\s*\(\s*base64_decode\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.gzinflate(base64_decode(str_rot13(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i])))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(str_rot13\s*\(\s*gzinflate\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.str_rot13(gzinflate(base64_decode(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[4][$i])))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(base64_decode\s*\(\s*gzinflate\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.base64_decode(gzinflate(str_rot13(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i])))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(gzinflate\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.gzinflate(base64_decode(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[4][$i]))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(gzinflate\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.gzinflate(str_rot13(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i]))).'"',$str);
                            }
                        continue;
                        }
                    if($c=preg_match_all("/(gzinflate\s*\(\s*[\"\'])(.+)(,[0-9])?([\"\']\s*\))/i",$str,$matches))
                        {
                        for($i=0;$c>$i;$i++)
                            {
                            $str=str_ireplace($matches[0][$i],'"'.gzinflate(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[4][$i])).'"',$str);
                            }
                        continue;
                        }
                    }
                if($c=preg_match_all("/(str_rot13\s*\(\s*base64_decode\s*\(\s*[\"\'])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\']\s*\)\s*\))/i",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_ireplace($matches[0][$i],'"'.str_rot13(base64_decode(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[4][$i]))).'"',$str);
                        }
                    continue;
                    }
                if($c=preg_match_all("/(base64_decode\s*\(\s*str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\)\s*\))/i",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_ireplace($matches[0][$i],'"'.base64_decode(str_rot13(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i]))).'"',$str);
                        }
                    continue;
                    }
                if($c=preg_match_all("/(base64_decode|decode_base64|base64\.b64decode|atob|Base64\.decode64)(\s*\(\s*[\"\'\`])([A-Za-z0-9+\/]{4})*([A-Za-z0-9+\/]{4}|[A-Za-z0-9+\/]{3}=|[A-Za-z0-9+\/]{2}==)([\"\'\`]\s*\))/i",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_ireplace($matches[0][$i],'"'.base64_decode(substrbl(substraf($matches[0][$i],$matches[1][$i].$matches[2][$i]),$matches[5][$i])).'"',$str);
                        }
                    continue;
                    }
                if($c=preg_match_all("/(str_rot13\s*\(\s*[\"\'])([^\'\"\(\)]+)([\"\']\s*\))/i",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_ireplace($matches[0][$i],'"'.str_rot13(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i])).'"',$str);
                        }
                    continue;
                    }
                if($c=preg_match_all("/(hex2bin\s*\(\s*[\"\'])([a-fA-F0-9]+)([\"\']\s*\))/i",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_ireplace($matches[0][$i],'"'.hex2bin(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i])).'"',$str);
                        }
                    continue;
                    }
                if($c=preg_match_all("/([Uu][Nn][Pp][Aa][Cc][Kk]\s*\(\s*[\"\']\s*H\*\s*[\"\']\s*,\s*[\"\'])([a-fA-F0-9]+)([\"\']\s*\))/",$str,$matches))
                    {
                    for($i=0;$c>$i;$i++)
                        {
                        $str=str_replace($matches[0][$i],'"'.hex2bin(substrbl(substraf($matches[0][$i],$matches[1][$i]),$matches[3][$i])).'"',$str);
                        }
                    continue;
                    }
                break;
                }
            }
        $str=preg_replace('/[^\x21-\x7e]/','',strtolower(prescan_decode($str.$ostr)));
        $ostr=false;
        if($html)$str=preg_replace(array('@<script[^>]*?>.*?</script>@si','@<[\/\!]*?[^<>]*?>@si','@<style[^>]*?>.*?</style>@siU','@<![\s\S]*?--[ \t\n\r]*>@'),'',$str);
        return trim($str);
        }
    }

if(!function_exists('prescan_xmlxdp'))
    {
    /**
     * This function looks for XML/XDP chunks within the input string, and for any chunks found, firstly, decodes them,
     * then, if an MD5 hash is supplied to the function (optionally used as an index key for storing additional
     * information about the chunks), the function will construct a record similar to the MD5 signatures of phpMussel,
     * which phpMussel will then later use to check those chunks against its MD5 signatures (if this scanning option is
     * enabled), and lastly, the function will then return the decoded chunks (as a single, merged string) back to the
     * calling scope. If the `$pdf` option is enabled, the original input string, normalised, but non-decoded, will be
     * appended to the beginning of the decoded chunk data to be returned to the calling scope. This data is used in
     * multiple contexts of the scanning functionality of phpMussel.
     *
     * @param string $str The input string to be checked (generally, the raw binary data of the files being scanned by phpMussel).
     * @param string $md5 An MD5 hash, optionally used as an index key for storing additional information about the XML/XDP chunks.
     * @param bool $pdf When set to true, the original input string, normalised, but non-decoded, will be appended to the beginning of the decoded chunk data to be returned to the calling scope. This option/parameter should be true when checking PDF file data, but otherwise should be false.
     * @return string The decoded XML/XDP chunk data to be returned to the calling scope.
     */
    function prescan_xmlxdp($str,$md5='',$pdf=false)
        {
        if($md5)
            {
            if(!isset($GLOBALS['memCache']['xmlxdp']))$GLOBALS['memCache']['xmlxdp']=array();
            if(!isset($GLOBALS['memCache']['xmlxdp'][$md5]))$GLOBALS['memCache']['xmlxdp'][$md5]=array();
            }
        $nstr=preg_replace('/[^\x21-\x7e]/','',prescan_decode($str));
        $chunks=$chunki='';
        $i=0;
        while(preg_match_all('/<chunk>(.+)<\/chunk>/i',$nstr,$matches))
            {
            $c=count($matches[0]);
            for($im=0;$c>$im;$im++)
                {
                if($chunki=@base64_decode($matches[1][$im]))
                    {
                    $nstr=@str_replace($matches[0][$im],'',$nstr);
                    $chunks.=$chunki;
                    if($md5)
                        {
                        $GLOBALS['memCache']['xmlxdp'][$md5][$i]=md5($chunki).':'.strlen($chunki).':';
                        $i++;
                        }
                    }
                }
            }
        if($pdf)$chunks=$nstr.$chunks;
        return $chunks;
        }
    }

if(!function_exists('substrbf'))
    {
    /**
     * Gets substring from haystack prior to the first occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substrbf($h,$n)
        {
        return @substr($h,0,strpos($h,$n));
        }
    }

if(!function_exists('substraf'))
    {
    /**
     * Gets substring from haystack after the first occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substraf($h,$n)
        {
        return @substr($h,strpos($h,$n)+strlen($n));
        }
    }

if(!function_exists('substrbl'))
    {
    /**
     * Gets substring from haystack prior to the last occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substrbl($h,$n)
        {
        return @substr($h,0,strrpos($h,$n));
        }
    }

if(!function_exists('substral'))
    {
    /**
     * Gets substring from haystack after the last occurrence of needle.
     *
     * @param string $h The haystack.
     * @param string $n The needle.
     * @return string The substring.
     */
    function substral($h,$n)
        {
        return @substr($h,strrpos($h,$n)+strlen($n));
        }
    }

if(!function_exists('phpMusselFile'))
    {
    /**
     * This function reads files and returns the contents of those files.
     *
     * @param string $f Path and filename of the file to read.
     * @param int $s Number of 48KB blocks to read from the file (optional; can be manually specified, but, it's best to just ignore it and let the function work it out for itself).
     * @param bool $c If false, perform basic safety check prior to reading the file (check if the file exists); If true, skip check (optional; defaults to false).
     * @return string Content of the file returned by the function.
     */
    function phpMusselFile($f,$s=0,$c=false)
        {
        if(!$c)
            {
            $d=@is_file($f);
            if(!$d)return false;
            }
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
        return (!empty($d))?$d:false;
        }
    }

if(!function_exists('phpMusselCacheClean'))
    {
    /**
     * Deletes expired cache entries and regenerates cache files.
     */
    function phpMusselCacheClean()
        {
        if(isset($GLOBALS['memCache']['CacheCleaned']))if($GLOBALS['memCache']['CacheCleaned'])return true;
        $GLOBALS['memCache']['CacheCleaned']=true;
        $CacheFiles=array();
        $f=$GLOBALS['vault'].'cache/index.dat';
        $fdata_old=$fdata=(!file_exists($f))?'':phpMusselFile($f,0,true);
        if(substr_count($fdata,';'))
            {
            $fdata=explode(';',$fdata);
            $c=count($fdata);
            for($i=0;$i<$c;$i++)
                {
                if(substr_count($fdata[$i],':'))
                    {
                    $fdata[$i]=explode(':',$fdata[$i],3);
                    if($GLOBALS['time']>$fdata[$i][1])
                        {
                        $xf=bin2hex(substr($fdata[$i][0],0,1));
                        if(!isset($CacheFiles[$xf]))$CacheFiles[$xf]=(!file_exists($GLOBALS['vault'].'cache/'.$xf.'.tmp'))?'':phpMusselFile($GLOBALS['vault'].'cache/'.$xf.'.tmp',0,true);
                        while(substr_count($CacheFiles[$xf],$fdata[$i][0].':'))$CacheFiles[$xf]=str_ireplace($fdata[$i][0].':'.substrbf(substraf($CacheFiles[$xf],$fdata[$i][0].':'),';').';','',$CacheFiles[$xf]);
                        $fdata[$i]='';
                        }
                    else $fdata[$i]=$fdata[$i][0].':'.$fdata[$i][1];
                    }
                else $fdata[$i]='';
                }
            $fdata=implode(';',$fdata).';';
            $fdata=str_ireplace(';;',';',$fdata);
            if($fdata_old!==$fdata)
                {
                $fh=fopen($f,'w');
                fwrite($fh,$fdata);
                fclose($fh);
                }
            }
        reset($CacheFiles);
        $c=count($CacheFiles);
        for($i=0;$i<$c;$i++)
            {
            $k=key($CacheFiles);
            if(strlen($CacheFiles[$k])<2)
                {
                if(file_exists($GLOBALS['vault'].'cache/'.$k.'.tmp'))@unlink($GLOBALS['vault'].'cache/'.$k.'.tmp');
                }
            else
                {
                $fh=fopen($GLOBALS['vault'].'cache/'.$k.'.tmp','w');
                fwrite($fh,$CacheFiles[$k]);
                fclose($fh);
                }
            next($CacheFiles);
            }
        return true;
        }
    }

if(!function_exists('phpMusselCacheGet'))
    {
    /**
     * Retrieves cache entries.
     *
     * @param string|array $entry The name of the cache entry (or entries) to retrieve (can be a string to specify a single entry, or an array of strings to specify multiple entries).
     * @return string|array Contents of the cache entry (or entries).
     */
    function phpMusselCacheGet($entry='')
        {
        $x=phpMusselCacheClean();
        if(!$entry)return '';
        if(is_array($entry))
            {
            reset($entry);
            $c=count($entry);
            for($out=array(),$i=0;$i<$c;$i++)
                {
                $k=key($entry);
                $out[$k]=phpMusselCacheGet($entry[$k]);
                next($entry);
                }
            return $out;
            }
        $f=$GLOBALS['vault'].'cache/'.bin2hex($entry[0]).'.tmp';
        if(!file_exists($f))return '';
        $d=phpMusselFile($f,0,true);
        if(!$d)return '';
        $item=(substr_count($d,$entry.':'))?$entry.':'.substrbf(substraf($d,$entry.':'),';').';':'';
        if(!$item)return '';
        $item_ex=substrbf(substraf($item,$entry.':'),':');
        if($GLOBALS['time']>$item_ex)
            {
            while(substr_count($d,$entry.':'))$d=str_ireplace($item,'',$d);
            $fh=fopen($f,'w');
            fwrite($fh,$d);
            fclose($fh);
            return '';
            }
        $item_data=substrbf(substraf($item,$entry.':'.$item_ex.':'),';');
        if(!$item_data)return '';
        $item_data=@gzinflate(hex2bin(substrbf(substraf($d,$item_ex.':'),';')));
        return (!$item_data)?'':$item_data;
        }
    }

if(!function_exists('phpMusselCacheSet'))
    {
    /**
     * Creates cache entry and saves it to the cache.
     *
     * @param string $entry The name of the cache entry to create.
     * @param int $item_ex The time (in unix time) after which the cache entry should expire.
     * @param string $item_data Contents of the cache entry.
     * @return bool This should always return true, unless something goes wrong.
     */
    function phpMusselCacheSet($entry='',$item_ex=0,$item_data='')
        {
        $x=phpMusselCacheClean();
        if(!$entry||!$item_data)return false;
        if(!$item_ex)$item_ex=$GLOBALS['time'];
        $f=$GLOBALS['vault'].'cache/'.bin2hex($entry[0]).'.tmp';
        $d=(!file_exists($f))?'':phpMusselFile($f,0,true);
        while(substr_count($d,$entry.':'))$d=str_ireplace($entry.':'.substrbf(substraf($d,$entry.':'),';').';','',$d);
        $d.=$entry.':'.$item_ex.':'.bin2hex(gzdeflate($item_data,9)).';';
        $fh=fopen($f,'w');
        fwrite($fh,$d);
        fclose($fh);
        $idxf=$GLOBALS['vault'].'cache/index.dat';
        $idxnd=$idxd=(!file_exists($idxf))?'':phpMusselFile($idxf,0,true);
        while(substr_count($idxnd,$entry.':'))$idxnd=str_ireplace($entry.':'.substrbf(substraf($idxnd,$entry.':'),';').';','',$idxnd);
        $idxnd.=$entry.':'.$item_ex.';';
        if($idxnd!==$idxd)
            {
            $idxfh=fopen($idxf,'w');
            fwrite($idxfh,$idxnd);
            fclose($idxfh);
            }
        return true;
        }
    }

if(!function_exists('phpMusselQ'))
    {
    /**
     * This function quarantines file uploads.
     *
     * The function uses a key generated from your quarantine key to bitshift against the input string, adds a custom
     * quarantine header with an explanation of what the bitshifted data is along with an MD5 hash checksum of the
     * original unquarantined input string, and then saves it all to a QFU file, stored in your quarantine directory.
     * This isn't hardcore encryption, but it should be sufficient to prevent accidental execution of quarantined
     * files and to allow safe handling of those files, which is the whole point of quarantining them in the first
     * place, and so, should be sufficient. Improvements may be made in the future.
     *
     * @param string $s The input string to be quarantined (usually derived from malicious files).
     * @param string $key Your quarantine key.
     * @param string $ip Original source of the input string (usually, the IP address of the uploader of the malicious file).
     * @param string $id Name of the QFU file to save the quarantined input string into (in the context that this function is used, this is a unique identifier calculated prior to calling the function).
     * @return bool This should always return true, unless something goes wrong.
     */
    function phpMusselQ($s,$key,$ip,$id)
        {
        if(!$s||!$key||!$ip||!$id||!function_exists('gzdeflate'))return false;
        if(strlen($key)<128)if(!$key=@hex2bin(hash('sha512',$key).hash('whirlpool',$key)))return false;
        $h="\xa1phpMussel\x21".hex2bin(md5($s)).pack('l*',strlen($s))."\x01";
        $s=gzdeflate($s,9);
        $o='';
        $i=0;
        $c=strlen($s);
        $k=strlen($key);
        while($i<$c)for($j=0;$j<$k;$j++,$i++)$o.=@$s{$i}^$key{$j};
        $o="\x2f\x3d\x3d\x20phpMussel\x20Quarantined\x20File\x20Upload\x20\x3d\x3d\x5c\n\x7c\x20Time\x2fDate\x20Uploaded\x3a\x20".str_pad($GLOBALS['time'],18,"\x20")."\x7c\n\x7c\x20Uploaded\x20From\x3a\x20".str_pad($ip,22,"\x20")."\x20\x7c\n\x5c".str_repeat("\x3d",39)."\x2f\n\n\n".$h.$o;
        $u=phpMusselMemUse($GLOBALS['vault'].'quarantine/');
        $u=$u['s']+strlen($o);
        if($u>($GLOBALS['MusselConfig']['general']['quarantine_max_usage']*1024))$u=phpMusselMemUse($GLOBALS['vault'].'quarantine/',$u-($GLOBALS['MusselConfig']['general']['quarantine_max_usage']*1024));
        $xf=fopen($GLOBALS['vault'].'quarantine/'.$id.'.qfu','a');
        fwrite($xf,$o);
        fclose($xf);
        return true;
        }
    }

if(!function_exists('phpMusselMemUse'))
    {
    /**
     * A function for calculating the memory usage of a directory, and optionally, for enforcing a limitation upon the
     * memory usage of that directory by way of deleting the contents of that directory until a specified quota of bytes
     * to be deleted has been met.
     *
     * This function is recursive, and will check (and/or delete from) the specified directory and all subdirectories
     * that it contains; It should be regarded as a subfunction of the quarantine functionality, used by the quarantine
     * functionality to enforce the quarantine memory usage limit.
     *
     * @param string $p The path and name of the directory to be checked.
     * @param int $d A quota for how many bytes should be deleted from the target directory when the function is executed (omitting this parameter, or setting it to zero or less, will prevent the deletion of any files).
     * @return array The function will return an array containing four elements, all integers: `s` is the actual total memory usage of the target directory, `c` is a count of the total number of objects (files and subdirectories) detected within the target directory, `dc` is a count only of the total number of subdirectories detected within the target directory, and `d` is how much remaining quota there is to be met by the time the function has finished executing (usually, should be zero or less).
     */
    function phpMusselMemUse($p,$d=0)
        {
        $t=array('s'=>0,'c'=>0,'dc'=>0,'d'=>$d);
        if(is_dir($p))if($h=@opendir($p))while(false!==($f=readdir($h)))
            {
            if($f!=='.'&&$f!=='..'&&!is_link($np=$p.'/'.$f))
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
    }

if(!function_exists('scandir'))
    {
    /**
     * A fallback function for `scandir()` (scans a directory specified by the input and returns a list of its contents
     * as an array).
     *
     * Note: The second and third parameters available to PHP's in-built `scandir()` function don't have equivalents in
     * our fallback function, because phpMussel doesn't require them. As with all our fallback functions, however, we
     * always prefer to use PHP's in-built functions, whenever possible, but will use our fallback functions whenever
     * PHP's in-built functions aren't available (such as for older version of PHP).
     *
     * @param string $r The directory to scan.
     * @return array A list of the contents of the directory specified, returned as a numeric array.
     */
    function scandir($r)
        {
        if(!is_dir($r))return false;
        $d=array();
        $i=0;
        if($h=@opendir($r))while(false!==($f=readdir($h)))
            {
            if($f!=='.'&&$f!=='..'&&!is_link($np=$p.'/'.$f))
                {
                $d[$i]=$np;
                $i++;
                }
            }
        closedir($h);
        return $d;
        }
    }

if(!function_exists('lv_match'))
    {
    /**
     * A function to check if $needle (string) matches (is equal or identical to) $haystack (string), or a specific
     * substring of $haystack, to within a specific threshold of the levenshtein distance between the $needle and the
     * $haystack or the $haystack substring specified.
     *
     * This function is useful for expressing the differences between two strings as an integer value and for then
     * determining whether a specific value as per those differences is met.
     *
     * @param string $needle The needle (will be matched against the $haystack, or, if substring positions are specified, against the $haystack substring specified).
     * @param string $haystack The haystack (will be matched against the $needle). Note that for the purposes of calculating the levenshtein distance, it doesn't matter which string is a $needle and which is a $haystack (the value should be the same if the two were reversed). However, when specifying substring positions, those substring positions are applied to the $haystack, and not the $needle. Note, too, that if the $needle length is greater than the $haystack length (after having applied the substring positions to the $haystack), $needle and $haystack will be switched.
     * @param int $pos_A The initial position of the $haystack to use for the substring, if using a substring (optional; defaults to `0`; `0` is the beginning of the $haystack).
     * @param int $pos_Z The final position of the $haystack to use for the substring, if using a substring (optional; defaults to `0`; `0` will instruct the function to continue to the end of the $haystack, and thus, if both $pos_A and $pos_Z are `0`, the entire $haystack will be used).
     * @param int $min The threshold minimum (the minimum levenshtein distance required in order for the two strings to be considered a match). Optional; Defaults to `0`. If `0` or less is specified, there is no minimum, and so, any and all strings should always match, as long as the levenshtein distance doesn't surpass the threshold maximum.
     * @param int $max The threshold maximum (the maximum levenshtein distance allowed for the two strings to be considered a match). Optional; Defaults to `-1`. If exactly `-1` is specified, there is no maximum, and so, any and all strings should always match, as long as the threshold minimum is met.
     * @param bool $bool Specifies to the function whether to return the levenshtein distance of the two strings (as an integer) or to return the results of the match (as a boolean; true for match success, false for match failure). Optional; Defaults to true. If true is specified, the function will return a boolean value (the results of the match), and if false is specified, the levenshtein distance will be returned.
     * @param bool $case Specifies to the function whether to treat the two strings as case-sensitive (when true is specified) or case-insensitive (when false is specified) when calculating the levenshtein distance. Optional; Defaults to false.
     * @param int $cost_ins The cost to apply for character/byte insertions for when calculating the levenshtein distance. Optional; Defaults to 1.
     * @param int $cost_rep The cost to apply for character/byte replacements for when calculating the levenshtein distance. Optional; Defaults to 1.
     * @param int $cost_del The cost to apply for character/byte deletions for when calculating the levenshtein distance. Optional; Defaults to 1.
     * @return bool|int The function will return either a boolean or an integer, depending on the state of $bool (but will also return false whenever an error occurs).
     */
    function lv_match($needle,$haystack,$pos_A=0,$pos_Z=0,$min=0,$max=-1,$bool=true,$case=false,$cost_ins=1,$cost_rep=1,$cost_del=1)
        {
        if(!function_exists('levenshtein')||is_array($needle)||is_array($haystack))return false;
        $nlen=strlen($needle);
        $pos_A=(int)$pos_A;
        $pos_Z=(int)$pos_Z;
        $min=(int)$min;
        $max=(int)$max;
        if($pos_A!==0||$pos_Z!==0)$haystack=($pos_Z===0)?substr($haystack,$pos_A):substr($haystack,$pos_A,$pos_Z);
        $hlen=strlen($haystack);
        if($nlen<1||$hlen<1)return ($bool)?false:0;
        if($nlen>$hlen)
            {
            $x=array($needle,$nlen,$haystack,$hlen);
            $haystack=$x[0];
            $hlen=$x[1];
            $needle=$x[2];
            $nlen=$x[3];
            $x='';
            }
        if($cost_ins===1&&$cost_rep===1&&$cost_del===1)$lv=@($case)?levenshtein($haystack,$needle):levenshtein(strtolower($haystack),strtolower($needle));
        else $lv=@($case)?levenshtein($haystack,$needle,$cost_ins,$cost_rep,$cost_del):levenshtein(strtolower($haystack),strtolower($needle),$cost_ins,$cost_rep,$cost_del);
        if($bool)return (($min===0||$lv>=$min)&&($max===-1||$lv<=$max))?true:false;
        return $lv;
        }
    }

if(!function_exists('split_nibble'))
    {
    /**
     * Splits the nibbles of a single byte/character.
     *
     * @param string $n A byte/character to split.
     * @return array Returns an array containing two elements, both integers; The first, a decimal representation of the high nibble of the input byte/character, and the second, a decimal representation of the low nibble of the input byte/character.
     */
    function split_nibble($n)
        {
        $n=@bin2hex($n);
        $h=hexdec(isset($n[0])?$n[0]:'0');
        $l=hexdec(isset($n[1])?$n[1]:'0');
        return array($h,$l);
        }
    }

if(!function_exists('explode_bits'))
    {
    /**
     * Explodes a byte/character or string into an array containing elements representing the individual bits
     * constituting the byte/character or string. Each element is a bool, with "false" representing "0" (or "off") and
     * "true" representing "1" (or "on"). `explode_bits()` is the reverse of `implode_bits()`.
     *
     * @param string $n A byte/character or string to explode.
     * @return array Returns an array containing elements representing the individual bits constituting the byte/character or string.
     */
    function explode_bits($n)
        {
        if(is_array($n))return '';
        $c=strlen($n);
        for($a=array(),$i=0,$j=0;$i<$c;$i++,$j+=8)
            {
            $a[$j]=(bool)(($n[$i]&"\x80")==="\x80");
            $a[$j+1]=(bool)(($n[$i]&"\x40")==="\x40");
            $a[$j+2]=(bool)(($n[$i]&"\x20")==="\x20");
            $a[$j+3]=(bool)(($n[$i]&"\x10")==="\x10");
            $a[$j+4]=(bool)(($n[$i]&"\x08")==="\x08");
            $a[$j+5]=(bool)(($n[$i]&"\x04")==="\x04");
            $a[$j+6]=(bool)(($n[$i]&"\x02")==="\x02");
            $a[$j+7]=(bool)(($n[$i]&"\x01")==="\x01");
            }
        return $a;
        }
    }

if(!function_exists('implode_bits'))
    {
    /**
     * Implodes an array of bits into a byte/character or string reconstituted from those bits. Each element is a bool,
     * with "false" representing "0" (or "off") and "true" representing "1" (or "on"). `implode_bits()` is the reverse
     * of `explode_bits()`.
     *
     * @param array $n An array of bits to implode.
     * @return string Returns a string reconstituted from the input array.
     */
    function implode_bits($n)
        {
        if(!is_array($n))return '';
        $c=count($n);
        for($x='',$i=0;$i<$c;$i+=8)
            {
            $a="\xff";
            if($n[$i])$a=$a^"\x80";
            if($n[$i+1])$a=$a^"\x40";
            if($n[$i+2])$a=$a^"\x20";
            if($n[$i+3])$a=$a^"\x10";
            if($n[$i+4])$a=$a^"\x08";
            if($n[$i+5])$a=$a^"\x04";
            if($n[$i+6])$a=$a^"\x02";
            if($n[$i+7])$a=$a^"\x01";
            $x.=~$a;
            }
        return $x;
        }
    }

if(!function_exists('vn_shorthand'))
    {
    /**
     * A function to translate the virus name/identifier shorthand adopted by phpMussel to proper virus
     * names/identifiers and to make some determinations regarding detections based upon the interpretation and
     * understanding of that shorthand against the phpMussel configuration (for example, whether some certain
     * classifications, such as hoax/joke viruses, adware, etc, should be entirely ignored by the scanner, or should be
     * identified as malicious, and therefore blocked).
     *
     * Originally, this function was created to allow a way for phpMussel to partially compress its signatures without
     * jeopardising speed, performance or processing efficiency, because, by allowing phpMussel to partially compress
     * its signatures, the total footprint of its signature files could be reduced, therefore allowing the inclusion of
     * a greater number of signatures in the signature files without causing an excessive bloat in the total footprint.
     *
     * However, since then, its purpose has expanded, to determining whether a signature should be considered a
     * weighted signature (for more complex detections involving multiple signatures) or a non-weighted signature (for
     * signatures that are detections in their own right, not requiring additional signatures for the detection to
     * occur), and to determining whether or not a signature should be ignored, based upon its classification.
     *
     * The function takes an input string (the shorthand virus name), and if byte 0 of the input string is "\x1A" (the
     * substitute character), the input string is a shorthand virus name, and processing continues; If it doesn't begin
     * with "\x1A", it isn't a shorthand virus name, and the input string should be returned to the calling scope
     * unmodified. When processing continues, the function splits the nibbles of bytes 1-2, and uses that information
     * to reconstruct a complete virus name from the shorthand virus name; 1H represents the signature vendor name and
     * 1L optionally provides some additional generic indicators (heuristic, CVE, etc), except when 1H == 8 (in which
     * case, 1L represents the signature vendor name, 1H == 8 being used to access that additional set of allocations),
     * 2H+2L represents the virus target (ie, the file format or system that the virus that the signature is intended
     * to detect is intended to be targeting), and 3H+3L represents the nature of what the signature is intended to
     * detect (ie, whether we should call it a virus, a trojan, adware, ransomware, etc).
     *
     * Warning: When modifying these allocations (such as to include a new vendor or a new type of detection), be very
     * careful to ensure that your choice of allocations won't conflict with the what phpMussel recognises as its
     * delimiters or as special characters (newlines, semicolons, colons, etc), or else your signature files could
     * break very badly, leading either to a failure to properly detect anything or to numerous severe false positives.
     * Generally (but not exclusively), you should avoid: "\x0?" (or any ?H0 character/byte), \x3A and \x3B. Also avoid
     * using the null character ("\x00") in particular, because it can severely break things in certain situations.
     *
     * @param string $p The path and name of the directory to be checked.
     * @param int $d A quota for how many bytes should be deleted from the target directory when the function is executed (omitting this parameter, or setting it to zero or less, will prevent the deletion of any files).
     * @return array The function will return an array containing four elements, all integers: `s` is the actual total memory usage of the target directory, `c` is a count of the total number of objects (files and subdirectories) detected within the target directory, `dc` is a count only of the total number of subdirectories detected within the target directory, and `d` is how much remaining quota there is to be met by the time the function has finished executing (usually, should be zero or less).
     */
    function vn_shorthand($vn)
        {
        $GLOBALS['memCache']['weighted']=false;
        $GLOBALS['memCache']['ignoreme']=false;
        if($vn[0]!=="\x1a")return $vn;
        $n=split_nibble($vn[1]);
        $out='';
        if($n[0]===2)$out.='ClamAV-';
        else if($n[0]===3)$out.='phpMussel-';
        else if($n[0]===4)$out.='SecuriteInfo-';
        else if($n[0]===5)$out.='ZBB-';
        else if($n[0]===6)$out.='NLNetLabs-';
        else if($n[0]===7)$out.='FoxIT-';
        else if($n[0]===8)
            {
            if($n[1]===0)$out.='PhishTank-';
            else if($n[1]===1)$out.='Malc0de-';
            else if($n[1]===2)$out.='hpHosts-';
            else if($n[1]===3)$out.='Spam404-';
            }
        else if($n[0]===9)
            {
            $GLOBALS['memCache']['weighted']=true;
            $out.='phpMussel-';
            }
        else if($n[0]===15)$GLOBALS['memCache']['weighted']=true;
        if($n[0]!==8)
            {
            if($n[1]===1)$out.='Testfile.';
            else if($n[1]===2)$out.='FN.';
            else if($n[1]===3)$out.='VT.';
            else if($n[1]===4)$out.='META.';
            else if($n[1]===5)$out.='Chameleon.';
            else if($n[1]===6)$out.='Werewolf.';
            else if($n[1]===7)$out.='Suspect.';
            else if($n[1]===8)$out.='Fake.';
            else if($n[1]===9)$out.='CVE.';
            else if($n[1]===15)$out.='HEUR.';
            }
        $n=split_nibble($vn[2]);
        if($n[0]===1)
            {
            if($n[1]===1)$out.='Win.';
            else if($n[1]===2)$out.='W32.';
            else if($n[1]===3)$out.='W64.';
            else if($n[1]===4)$out.='ELF.';
            else if($n[1]===5)$out.='OSX.';
            else if($n[1]===6)$out.='Android.';
            else if($n[1]===7)$out.='Email.';
            else if($n[1]===8)$out.='JS.';
            else if($n[1]===9)$out.='Java.';
            else if($n[1]===10)$out.='XXE.';
            else if($n[1]===11)$out.='Graphics.';
            else if($n[1]===12)$out.='OLE.';
            else if($n[1]===13)$out.='HTML.';
            else if($n[1]===14)$out.='RTF.';
            else if($n[1]===15)$out.='Archive.';
            }
        if($n[0]===2)
            {
            if($n[1]===0)$out.='PHP.';
            else if($n[1]===1)$out.='XML.';
            else if($n[1]===2)$out.='ASP.';
            else if($n[1]===3)$out.='VBS.';
            else if($n[1]===4)$out.='BAT.';
            else if($n[1]===5)$out.='PDF.';
            else if($n[1]===6)$out.='SWF.';
            else if($n[1]===7)$out.='W97M.';
            else if($n[1]===8)$out.='X97M.';
            else if($n[1]===9)$out.='O97M.';
            else if($n[1]===10)$out.='ASCII.';
            else if($n[1]===11)$out.='Unix.';
            else if($n[1]===12)$out.='Python.';
            else if($n[1]===13)$out.='Perl.';
            else if($n[1]===14)$out.='Ruby.';
            else if($n[1]===15)$out.='INF/INI.';
            }
        if($n[0]===3)
            {
            if($n[1]===0)$out.='CGI.';
            }
        $n=split_nibble($vn[3]);
        if($n[0]===1)
            {
            if($n[1]===1)$out.='Worm.';
            else if($n[1]===2)$out.='Trojan.';
            else if($n[1]===3)
                {
                $out.='Adware.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_adware'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===4)$out.='Flooder.';
            else if($n[1]===5)$out.='IRCBot.';
            else if($n[1]===6)$out.='Exploit.';
            else if($n[1]===7)$out.='VirTool.';
            else if($n[1]===8)$out.='Dialer.';
            else if($n[1]===9)
                {
                $out.='Joke/Hoax.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_joke_hoax'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===11)$out.='Malware.';
            else if($n[1]===12)$out.='Riskware.';
            else if($n[1]===13)$out.='Rootkit.';
            else if($n[1]===14)$out.='Backdoor.';
            else if($n[1]===15)$out.='Hacktool.';
            }
        if($n[0]===2)
            {
            if($n[1]===0)$out.='Keylogger.';
            else if($n[1]===1)$out.='Ransomware.';
            else if($n[1]===2)$out.='Spyware.';
            else if($n[1]===3)$out.='Virus.';
            else if($n[1]===4)$out.='Dropper.';
            else if($n[1]===5)$out.='Dropped.';
            else if($n[1]===6)$out.='Downloader.';
            else if($n[1]===7)$out.='Obfuscation.';
            else if($n[1]===8)$out.='Obfuscator.';
            else if($n[1]===9)$out.='Obfuscated.';
            else if($n[1]===10)
                {
                $out.='Packer.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_packer_packed'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===11)
                {
                $out.='Packed.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_packer_packed'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===12)
                {
                $out.='PUA/PUP.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_pua_pup'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===13)
                {
                $out.='Shell.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_shell'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===14)
                {
                $out.='Defacer.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_deface'])$GLOBALS['memCache']['ignoreme']=true;
                }
            else if($n[1]===15)
                {
                $out.='Defacement.';
                if(!$GLOBALS['MusselConfig']['signatures']['detect_deface'])$GLOBALS['memCache']['ignoreme']=true;
                }
            }
        if($n[0]===3)
            {
            if($n[1]===0)$out.='Cryptor.';
            else if($n[1]===1)$out.='Phish.';
            else if($n[1]===2)$out.='Spam.';
            else if($n[1]===3)$out.='Spammer.';
            else if($n[1]===4)$out.='Scam.';
            else if($n[1]===5)$out.='ZipBomb.';
            else if($n[1]===6)$out.='ForkBomb.';
            else if($n[1]===7)$out.='LogicBomb.';
            else if($n[1]===8)$out.='CyberBomb.';
            else if($n[1]===9)$out.='Malvertisement.';
            else if($n[1]===15)$out.='BadURL.';
            }
        return $out.substr($vn,4);
        }
    }

/**
 * This function (`phpMusselD()`, or, the phpMussel data handler) is one of two sub-functions of the core scanning
 * function of phpMussel (`phpMussel()`).
 *
 * Whereas `phpMusselR()` handles metadata-based and non-signature-based detections, and performs the preparations
 * necessary for scanning files (such as reading the contents of files prior to checking the contents of files
 * against anti-virus signatures), `phpMusselD()` is responsible for handling that data after `phpMusselR()` has read
 * it. `phpMusselD()` is called from `phpMusselR()`, and should never be called in any other contexts or from anywhere
 * else; It takes the data given to it from the calling function, processes it, and then checks it against the various
 * signatures of phpMussel, before returning the results of those checks back to the calling function.
 *
 * @param string $str The raw binary data to be checked, supplied by the calling function (generally, the contents of files to being scanned).
 * @param bool $n Inherited from the calling function (`phpMusselR()`, which in turn inherits this parameter from its own calling function, `phpMussel()`), this optional parameter is a boolean (defaults to false, but set to true during the initial scan of file uploads), indicating the format that the scan results should be returned as. False instructs the function to return results as an integer; True instructs the function to return results as human readable text (refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB SERVERS)", for more information).
 * @param int $dpt Represents the current depth of recursion from which the function has been called. `phpMusselD()` and `phpMusselR()` use this information for determining how much they should indent any entries they generate for logging and for the display of scan results in CLI mode.
 * @param string $ofn Represents the "original filename" of the file being scanned (the original filename, in this context, referring to the name of the file being scanned as per supplied by the upload client or CLI operator, as opposed to the temporary filename assigned by the server or any other filename).
 * @return int|string The scan results, as per described by the README documentation. The function may also die the script and return nothing, if something goes wrong, such as if the function is triggered in the absense of the required $memCache variable being set.
 */
function phpMusselD($str='',$n=false,$dpt=0,$ofn='')
    {
    if(!isset($GLOBALS['memCache']))
        {
        echo (!isset($GLOBALS['MusselConfig']['lang']['required_variables_not_defined']))?'[phpMussel] Required variables aren\'t defined: Can\'t continue.':'[phpMussel] '.$GLOBALS['MusselConfig']['lang']['required_variables_not_defined'];
        die;
        }
    $flagged=false;
    $dpt++;
    for($lnap='',$i=0;$i<($dpt-1);$i++)
        {
        $lnap.='-';
        }
    $lnap.='> ';
    $out='';
    $str_len=strlen($str);
    $md5=md5($str);
    $sha=sha1($str);
    $crc=@hash('crc32b',$str);
    $fourcc=strtolower(bin2hex(substr($str,0,4)));
    $twocc=strtolower(bin2hex(substr($str,0,2)));
    $CoExMeta='$ofn:'.$ofn.';md5($ofn):'.md5($ofn).';$dpt:'.$dpt.';$str_len:'.$str_len.';$md5:'.$md5.';$sha:'.$sha.';$crc:'.$crc.';$fourcc:'.$fourcc.';$twocc:'.$twocc.';';
    $GLOBALS['memCache']['weighted']=false;
    $heur=array('detections'=>0,'weight'=>0,'cli'=>'','web'=>'');
    if(!$ofn)
        {
        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
        $GLOBALS['memCache']['detections_count']++;
        $out.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_missing_filename'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_missing_filename'].$GLOBALS['MusselConfig']['lang']['_exclamation'];
        return (!$n)?2:$out;
        }
    $ofnSafe=urlencode($ofn);
    $HashCacheData=$md5.md5($ofn);
    if(isset($GLOBALS['HashCache'][$HashCacheData]))
        {
        if(!$GLOBALS['memCache']['eof'])$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
        if(!empty($GLOBALS['HashCache'][$HashCacheData][2]))
            {
            $GLOBALS['memCache']['detections_count']++;
            $out.=hex2bin($GLOBALS['HashCache'][$HashCacheData][2]);
            }
        if(!empty($GLOBALS['HashCache'][$HashCacheData][3]))$GLOBALS['whyflagged'].=hex2bin($GLOBALS['HashCache'][$HashCacheData][3]);
        if(!$out)return 1;
        return (!$n)?2:$out;
        }
    $climode=(function_exists('phpMusselFork')&&strlen(mussel_php)>0&&mussel_os=='WIN'&&mussel_sapi=='cli')?1:0;
    $decode_or_not=(($GLOBALS['MusselConfig']['attack_specific']['decode_threshold']>0&&$str_len>($GLOBALS['MusselConfig']['attack_specific']['decode_threshold']*1024))||$str_len<16)?0:1;
    $len_kb=($str_len>1024)?1:0;
    $len_hmb=($str_len>524288)?1:0;
    $len_mb=($str_len>1048576)?1:0;
    $len_hgb=($str_len>536870912)?1:0;
    $phase=$GLOBALS['memCache']['phase'];
    $container=$GLOBALS['memCache']['container'];
    $file_is_ole=$GLOBALS['memCache']['file_is_ole'];
    $pdf_magic=($fourcc=='25504446')?true:false;
    $xt=$xts=$gzxt=$gzxts='-';
    $detect_adware=($GLOBALS['MusselConfig']['signatures']['detect_adware'])?1:0;
    $detect_joke_hoax=($GLOBALS['MusselConfig']['signatures']['detect_joke_hoax'])?1:0;
    $detect_pua_pup=($GLOBALS['MusselConfig']['signatures']['detect_pua_pup'])?1:0;
    $detect_packer_packed=($GLOBALS['MusselConfig']['signatures']['detect_packer_packed'])?1:0;
    $detect_shell=($GLOBALS['MusselConfig']['signatures']['detect_shell'])?1:0;
    $detect_deface=($GLOBALS['MusselConfig']['signatures']['detect_deface'])?1:0;
    if(substr_count($ofn,'.')>0)
        {
        $xt=explode('.',strtolower($ofn));
        $xts=substr($xt[count($xt)-1],0,3).'*';
        $xt=$xt[count($xt)-1];
        if(strlen($xt)<1)$xt=$xts='-';
        }
    if(substr_count($ofn,'.')>1)
        {
        $gzxt=explode('.',str_replace('.gz','',strtolower($ofn)));
        $gzxts=substr($gzxt[count($gzxt)-1],0,3).'*';
        $gzxt=strtolower($gzxt[count($gzxt)-1]);
        if(strlen($gzxt)<1)$gzxt=$gzxts='-';
        }
    $CoExMeta.='$xt:'.$xt.';$xts:'.$xts.';';
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['during_scan']))if($GLOBALS['MusselPlugins']['hookcounts']['during_scan']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['during_scan']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['during_scan'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['during_scan']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['during_scan'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['during_scan'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['during_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['during_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['during_scan'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['during_scan']);
            }
        }
    for($SigSet=0;$SigSet<3;$SigSet++)
        {
        $SigDo=$SigFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['filenames_clamav'])
                {
                $SigFile='filenames_clamav.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['filenames_custom'])
                {
                $SigFile='filenames_custom.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            if($GLOBALS['MusselConfig']['signatures']['filenames_mussel'])
                {
                $SigFile='filenames_mussel.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            if(!isset($GLOBALS['memCache'][$SigFile]))$GLOBALS['memCache'][$SigFile]=@file($GLOBALS['vault'].$SigFile);
            if(!$GLOBALS['memCache'][$SigFile])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    }
                $c=0;
                }
            else $c=@count($GLOBALS['memCache'][$SigFile]);
            for($i=0;$i<$c;$i++)
                {
                $xsig=$GLOBALS['memCache'][$SigFile][$i];
                if(substr($xsig,0,1)=='>')
                    {
                    $xsig=explode('>',$xsig,4);
                    $xsig[3]=(int)$xsig[3];
                    if($xsig[1]=='FN')
                        {
                        if(!preg_match('/'.$xsig[2].'/i',$ofn))
                            {
                            if($xsig[3]<=$i)break;
                            $i=$xsig[3];
                            continue;
                            }
                        }
                    else if(substr($xsig[1],0,1)=='$')
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
                    else if(substr($xsig[1],0,2)=='!$')
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
                if(substr_count($xsig,':')>0)
                    {
                    $vn=@explode(':',$xsig);
                    $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                    $xsig=($xsig===false?'':implode('',$xsig));
                    $xlen=strlen($xsig);
                    if($xlen<$GLOBALS['MusselConfig']['signatures']['fn_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['fn_siglen_max'])
                        {
                        $i++;
                        continue;
                        }
                    $vn=vn_shorthand($vn[0]);
                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(preg_match('/'.$xsig.'/i',$ofn))
                            {
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            }
        }
    if(!$str_len)return 1;
    $whitelist=array();
    for($SigSet=0;$SigSet<3;$SigSet++)
        {
        $SigDo=$SigFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['whitelist_clamav'])
                {
                $SigFile='whitelist_clamav.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['whitelist_custom'])
                {
                $SigFile='whitelist_custom.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            if($GLOBALS['MusselConfig']['signatures']['whitelist_mussel'])
                {
                $SigFile='whitelist_mussel.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            if(!isset($GLOBALS['memCache'][$SigFile]))$GLOBALS['memCache'][$SigFile]=phpMusselFile($GLOBALS['vault'].$SigFile);
            if(!$GLOBALS['memCache'][$SigFile])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    }
                }
            else
                {
                $xmatches=array('c'=>substr_count($GLOBALS['memCache'][$SigFile],$md5.':'.$str_len.':'));
                if($xmatches['c']>0)
                    {
                    $xmatches['c']++;
                    $xmatches['d']=explode($md5.':'.$str_len.':',$GLOBALS['memCache'][$SigFile]);
                    for($xmatches['i']=1;$xmatches['i']<$xmatches['c'];$xmatches['i']++)
                        {
                        $xsig=explode($GLOBALS['linebreak'],$xmatches['d'][$xmatches['i']],2);
                        $whitelist[$xsig[0]]=true;
                        $xsig='';
                        }
                    }
                $xmatches='';
                }
            }
        }
    $str_norm_bin=prescan_normalise($str,false,$decode_or_not);
    $str_norm=@bin2hex($str_norm_bin);
    $str_norm_len=strlen($str_norm);
    if($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$str_norm_len>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048))
        {
        $str_norm_len=$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*2048;
        $str_norm=substr($str_norm,0,$str_norm_len);
        }
    if(!$GLOBALS['MusselConfig']['urlscanner']['urlscanner'])unset($str_norm_bin);
    $str_xmlxdp=$str_xmlxdp_norm=false;
    $str_xmlxdp_len=$str_xmlxdp_norm_len=0;
    if($decode_or_not)if(preg_match('/3c6368756e6b3e.{2,4000}3c2f6368756e6b3e/i',$str_norm))$str_xmlxdp=@prescan_xmlxdp($str,$md5,$pdf_magic);
    if($str_xmlxdp)
        {
        $str_xmlxdp=@bin2hex($str_xmlxdp);
        $str_xmlxdp_norm=@bin2hex(prescan_normalise($str_xmlxdp,false,$decode_or_not));
        $str_xmlxdp_len=strlen($str_xmlxdp);
        $str_xmlxdp_norm_len=strlen($str_xmlxdp_norm);
        }
    for($SigSet=0;$SigSet<3;$SigSet++)
        {
        $SigDo=$SigFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['md5_clamav'])
                {
                $SigFile='md5_clamav.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['md5_custom'])
                {
                $SigFile='md5_custom.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            if($GLOBALS['MusselConfig']['signatures']['md5_mussel'])
                {
                $SigFile='md5_mussel.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            if(!isset($GLOBALS['memCache'][$SigFile]))$GLOBALS['memCache'][$SigFile]=phpMusselFile($GLOBALS['vault'].$SigFile);
            if(!$GLOBALS['memCache'][$SigFile])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    }
                }
            else
                {
                if(substr_count($GLOBALS['memCache'][$SigFile],$md5.':'.$str_len.':'))
                    {
                    $xsig=substraf($GLOBALS['memCache'][$SigFile],$md5.':'.$str_len.':');
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $heur['detections']++;
                        $GLOBALS['memCache']['detections_count']++;
                        $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        }
                    if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))if(is_array($GLOBALS['memCache']['xmlxdp'][$md5]))
                        {
                        $c=count($GLOBALS['memCache']['xmlxdp'][$md5]);
                        for($i=0;$i<$c;$i++)
                            {
                            $xsig=substraf($GLOBALS['memCache'][$SigFile],$GLOBALS['memCache']['xmlxdp'][$md5][$i]);
                            if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                            $xsig=vn_shorthand($xsig);
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$GLOBALS['memCache']['xmlxdp'][$md5][$i].$ofn.' (XMLXDP CHUNK #'.$i.')'.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    $xsig='';
                    }
                }
            }
        }
    if(isset($GLOBALS['memCache']['xmlxdp'][$md5]))unset($GLOBALS['memCache']['xmlxdp'][$md5]);
    $is_html=false;
    if(!isset($whitelist['HTML'])&&($GLOBALS['MusselConfig']['signatures']['html_clamav']||$GLOBALS['MusselConfig']['signatures']['html_custom']||$GLOBALS['MusselConfig']['signatures']['html_mussel']))
        {
        if(!$is_html)if(substr_count($str_norm,'3c21646f6374797065')||substr_count($str_xmlxdp_norm,'3c21646f6374797065'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c6120')||substr_count($str_xmlxdp_norm,'3c6120'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c626f6479')||substr_count($str_xmlxdp_norm,'3c626f6479'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c68656164')||substr_count($str_xmlxdp_norm,'3c68656164'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c68746d6c')||substr_count($str_xmlxdp_norm,'3c68746d6c'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c696672616d65')||substr_count($str_xmlxdp_norm,'3c696672616d65'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c696d67')||substr_count($str_xmlxdp_norm,'3c696d67'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c6f626a656374')||substr_count($str_xmlxdp_norm,'3c6f626a656374'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c736372697074')||substr_count($str_xmlxdp_norm,'3c736372697074'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c7461626c65')||substr_count($str_xmlxdp_norm,'3c7461626c65'))$is_html=true;
        if(!$is_html)if(substr_count($str_norm,'3c7469746c65')||substr_count($str_xmlxdp_norm,'3c7469746c65'))$is_html=true;
        if(substr_count(',dhtml,hta,htm,html,shtml,',','.$xt.',')>0||$is_html)
            {
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
                    if(!isset($GLOBALS['memCache']['html_clamav_standard.cvd']))$GLOBALS['memCache']['html_clamav_standard.cvd']=@file($GLOBALS['vault'].'html_clamav_standard.cvd');
                    if(!$GLOBALS['memCache']['html_clamav_standard.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (html_clamav_standard.cvd)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (html_clamav_standard.cvd)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache']['html_clamav_standard.map']))$GLOBALS['memCache']['html_clamav_standard.map']=@file($GLOBALS['vault'].'html_clamav_standard.map');
                    if(!$GLOBALS['memCache']['html_clamav_standard.map'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (html_clamav_standard.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (html_clamav_standard.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache']['html_clamav_standard.map']);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (html_clamav_standard.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (html_clamav_standard.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        if(substr($GLOBALS['memCache']['html_clamav_standard.map'][$i],0,1)=='>')
                            {
                            $mapcon=explode('>',$GLOBALS['memCache']['html_clamav_standard.map'][$i],4);
                            $mapcon[3]=(int)$mapcon[3];
                            if($mapcon[1]=='FN')
                                {
                                if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FS-MIN')
                                {
                                if($str_len<$mapcon[2])
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FS-MAX')
                                {
                                if($str_len>$mapcon[2])
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FD')
                                {
                                if(!substr_count($str_hex,$mapcon[2]))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if(substr($mapcon[1],0,1)=='$')
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
                            else if(substr($mapcon[1],0,2)=='!$')
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
                        $map=explode(':',$GLOBALS['memCache']['html_clamav_standard.map'][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_html,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache']['html_clamav_standard.cvd'][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if($str_html_len<$xlen)continue;
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                        $xsigc=count($xsig);
                                        $this_str=$str_html;
                                        $this_xmlxdp=$str_xmlxdp_html;
                                        if($xstrf=='A')
                                            {
                                            $this_str="\x01".$this_str;
                                            $this_xmlxdp="\x01".$this_xmlxdp;
                                            $xsig[0]="\x01".$xsig[0];
                                            }
                                        else if($xstrf!='*')
                                            {
                                            $this_str=substr($this_str,$xstrf*2);
                                            $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                            }
                                        if($xstrt!='*')
                                            {
                                            $this_str=substr($this_str,0,$xstrt*2);
                                            $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                            }
                                        for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                            {
                                            if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                            if($xsigc>1)
                                                {
                                                if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                                if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                                }
                                            }
                                        $this_xmlxdp=$this_str=false;
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache']['html_clamav_regex.cvd']))$GLOBALS['memCache']['html_clamav_regex.cvd']=@file($GLOBALS['vault'].'html_clamav_regex.cvd');
                    if(!$GLOBALS['memCache']['html_clamav_regex.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (html_clamav_regex.cvd)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (html_clamav_regex.cvd)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache']['html_clamav_regex.map']))$GLOBALS['memCache']['html_clamav_regex.map']=@file($GLOBALS['vault'].'html_clamav_regex.map');
                    if(!$GLOBALS['memCache']['html_clamav_regex.map'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (html_clamav_regex.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (html_clamav_regex.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache']['html_clamav_regex.map']);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (html_clamav_regex.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (html_clamav_regex.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        if(substr($GLOBALS['memCache']['html_clamav_regex.map'][$i],0,1)=='>')
                            {
                            $mapcon=explode('>',$GLOBALS['memCache']['html_clamav_regex.map'][$i],4);
                            $mapcon[3]=(int)$mapcon[3];
                            if($mapcon[1]=='FN')
                                {
                                if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FS-MIN')
                                {
                                if($str_len<$mapcon[2])
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FS-MAX')
                                {
                                if($str_len>$mapcon[2])
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FD')
                                {
                                if(!substr_count($str_hex,$mapcon[2]))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if($mapcon[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                                    {
                                    if($mapcon[3]<=$i)break;
                                    $i=$mapcon[3]-1;
                                    }
                                }
                            else if(substr($mapcon[1],0,1)=='$')
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
                            else if(substr($mapcon[1],0,2)=='!$')
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
                        $map=explode(':',$GLOBALS['memCache']['html_clamav_regex.map'][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_html,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache']['html_clamav_regex.cvd'][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        if($xstrf=='*')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',$str_html)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp_html))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_html,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,0,$xstrt*2)))continue;
                                            }
                                        else if($xstrf=='A')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/\A'.$xsig.'/i',$str_html)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp_html))continue;
                                                }
                                            else if(!preg_match('/\A'.$xsig.'/i',substr($str_html,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp_html,0,$xstrt*2)))continue;
                                            }
                                        else
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',substr($str_html,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,$xstrf*2)))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_html,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,$xstrf*2,$xstrt*2)))continue;
                                            }
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            for($SigSet=0;$SigSet<2;$SigSet++)
                {
                $SigDo=$SigRegexFile=$SigStandardFile=false;
                if($SigSet===0)
                    {
                    if($GLOBALS['MusselConfig']['signatures']['html_custom'])
                        {
                        $SigStandardFile='html_custom_standard.cvd';
                        $SigRegexFile='html_custom_regex.cvd';
                        $SigDo=true;
                        }
                    }
                else if($SigSet===1)
                    {
                    if($GLOBALS['MusselConfig']['signatures']['html_mussel'])
                        {
                        $SigStandardFile='html_mussel_standard.cvd';
                        $SigRegexFile='html_mussel_regex.cvd';
                        $SigDo=true;
                        }
                    }
                if($SigDo)
                    {
                    while(true)
                        {
                        if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                        if(!$GLOBALS['memCache'][$SigStandardFile])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                }
                            break;
                            }
                        $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                        for($i=0;$i<$c;$i++)
                            {
                            $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                            if(substr($xsig,0,1)=='>')
                                {
                                $xsig=explode('>',$xsig,4);
                                $xsig[3]=(int)$xsig[3];
                                if($xsig[1]=='FN')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MIN')
                                    {
                                    if($str_len<$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MAX')
                                    {
                                    if($str_len>$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD')
                                    {
                                    if(!substr_count($str_html,$xsig[2]))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD-RX')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$str_html))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if(substr($xsig[1],0,1)=='$')
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
                                else if(substr($xsig[1],0,2)=='!$')
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
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if($str_html_len<$xlen)continue;
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                    $xsigc=count($xsig);
                                    $this_str=$str_html;
                                    $this_xmlxdp=$str_xmlxdp_html;
                                    if($xstrf=='A')
                                        {
                                        $this_str="\x01".$this_str;
                                        $this_xmlxdp="\x01".$this_xmlxdp;
                                        $xsig[0]="\x01".$xsig[0];
                                        }
                                    else if($xstrf!='*')
                                        {
                                        $this_str=substr($this_str,$xstrf*2);
                                        $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                        }
                                    if($xstrt!='*')
                                        {
                                        $this_str=substr($this_str,0,$xstrt*2);
                                        $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                        }
                                    for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                        {
                                        if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                        if($xsigc>1)
                                            {
                                            if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                            if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                            }
                                        }
                                    $this_xmlxdp=$this_str=false;
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        break;
                        }
                    while(true)
                        {
                        if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                        if(!$GLOBALS['memCache'][$SigRegexFile])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                }
                            break;
                            }
                        $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                        for($i=0;$i<$c;$i++)
                            {
                            $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                            if(substr($xsig,0,1)=='>')
                                {
                                $xsig=explode('>',$xsig,4);
                                $xsig[3]=(int)$xsig[3];
                                if($xsig[1]=='FN')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MIN')
                                    {
                                    if($str_len<$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MAX')
                                    {
                                    if($str_len>$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD')
                                    {
                                    if(!substr_count($str_html,$xsig[2]))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD-RX')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$str_html))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if(substr($xsig[1],0,1)=='$')
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
                                else if(substr($xsig[1],0,2)=='!$')
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
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($xstrf=='*')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',$str_html)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp_html))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_html,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,0,$xstrt*2)))continue;
                                        }
                                    else if($xstrf=='A')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/\A'.$xsig.'/i',$str_html)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp_html))continue;
                                            }
                                        else if(!preg_match('/\A'.$xsig.'/i',substr($str_html,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp_html,0,$xstrt*2)))continue;
                                        }
                                    else
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',substr($str_html,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,$xstrf*2)))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_html,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_html,$xstrf*2,$xstrt*2)))continue;
                                        }
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        break;
                        }
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
    $asciiable=(strlen($str_norm)>0);
    $fileswitch='unassigned';
    if(!isset($GLOBALS['memCache']['switch.dat']))$GLOBALS['memCache']['switch.dat']=@file($GLOBALS['vault'].'switch.dat');
    if(!$GLOBALS['memCache']['switch.dat'])
        {
        $GLOBALS['memCache']['scan_errors']++;
        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
            {
            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (switch.dat)! ';
            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (switch.dat)!'.$GLOBALS['linebreak'];
            }
        }
    $c=@count($GLOBALS['memCache']['switch.dat']);
    for($i=0;$i<$c;$i++)
        {
        $xsig=$GLOBALS['memCache']['switch.dat'][$i];
        if(strlen($xsig)<8)continue;
        if(!substr_count($xsig,$GLOBALS['linebreak'])||!substr_count($xsig,';')||!substr_count($xsig,':'))continue;
        $switch=@explode('=',preg_replace('/[^\x20-\xff]/','',substral($xsig,';')));
        if(!strlen($switch[0]))continue;
        $theswitch=$switch[0];
        $xsig=@explode(';',substrbl($xsig,';'));
        $sxc=count($xsig);
        if($sxc>0)for($sxi=0;$sxi<$sxc;$sxi++)
            {
            $xsig[$sxi]=@explode(':',$xsig[$sxi],7);
            if(!strlen($xsig[$sxi][0]))continue 2;
            if($xsig[$sxi][0]=='LV')
                {
                if(!isset($xsig[$sxi][1]))continue 2;
                if(substr($xsig[$sxi][1],0,1)!=='$')continue 2;
                $lv_haystack=substr($xsig[$sxi][1],1);
                if(!isset($$lv_haystack))continue 2;
                if(is_array($$lv_haystack))continue 2;
                $lv_haystack=$$lv_haystack;
                if($climode)$lv_haystack=substral(substral($lv_haystack,"/"),"\\");
                $lv_needle=(isset($xsig[$sxi][2]))?$xsig[$sxi][2]:'';
                $pos_A=(isset($xsig[$sxi][3]))?$xsig[$sxi][3]:0;
                $pos_Z=(isset($xsig[$sxi][4]))?$xsig[$sxi][4]:0;
                $lv_min=(isset($xsig[$sxi][5]))?$xsig[$sxi][5]:0;
                $lv_max=(isset($xsig[$sxi][6]))?$xsig[$sxi][6]:-1;
                if(!lv_match($lv_needle,$lv_haystack,$pos_A,$pos_Z,$lv_min,$lv_max))continue 2;
                }
            else if(isset($xsig[$sxi][2]))
                {
                if(isset($xsig[$sxi][3]))
                    {
                    if($xsig[$sxi][2]=='A')
                        {
                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,',','.$xsig[$sxi][0].','))continue 2;
                        if($xsig[$sxi][0]=='FD')if(!substr_count("\x01".substr($str_hex,0,$xsig[$sxi][3]*2),"\x01".$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-RX')if(!preg_match('/\A'.$xsig[$sxi][1].'/i',substr($str_hex,0,$xsig[$sxi][3]*2)))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM')if(!substr_count("\x01".substr($str_norm,0,$xsig[$sxi][3]*2),"\x01".$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM-RX')if(!preg_match('/\A'.$xsig[$sxi][1].'/i',substr($str_norm,0,$xsig[$sxi][3]*2)))continue 2;
                        }
                    else
                        {
                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,',','.$xsig[$sxi][0].','))continue 2;
                        if($xsig[$sxi][0]=='FD')if(!substr_count(substr($str_hex,$xsig[$sxi][2]*2,$xsig[$sxi][3]*2),$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',substr($str_hex,$xsig[$sxi][2]*2,$xsig[$sxi][3]*2)))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM')if(!substr_count(substr($str_norm,$xsig[$sxi][2]*2,$xsig[$sxi][3]*2),$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',substr($str_norm,$xsig[$sxi][2]*2,$xsig[$sxi][3]*2)))continue 2;
                        }
                    }
                else
                    {
                    if($xsig[$sxi][2]=='A')
                        {
                        if(!substr_count(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,',','.$xsig[$sxi][0].','))continue 2;
                        if($xsig[$sxi][0]=='FN')if(!preg_match('/\A'.$xsig[$sxi][1].'/i',$ofn))continue 2;
                        if($xsig[$sxi][0]=='FD')if(!substr_count("\x01".$str_hex,"\x01".$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-RX')if(!preg_match('/\A'.$xsig[$sxi][1].'/i',$str_hex))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM')if(!substr_count("\x01".$str_norm,"\x01".$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM-RX')if(!preg_match('/\A'.$xsig[$sxi][1].'/i',$str_norm))continue 2;
                        }
                    else
                        {
                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,',','.$xsig[$sxi][0].','))continue 2;
                        if($xsig[$sxi][0]=='FD')if(!substr_count(substr($str_hex,$xsig[$sxi][2]*2),$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',substr($str_hex,$xsig[$sxi][2]*2)))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM')if(!substr_count(substr($str_norm,$xsig[$sxi][2]*2),$xsig[$sxi][1]))continue 2;
                        if($xsig[$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',substr($str_norm,$xsig[$sxi][2]*2)))continue 2;
                        }
                    }
                }
            else
                {
                if($xsig[$sxi][0]=='FN')if(!preg_match('/'.$xsig[$sxi][1].'/i',$ofn))continue 2;
                if($xsig[$sxi][0]=='FS-MIN')if($str_len<$xsig[$sxi][1])continue 2;
                if($xsig[$sxi][0]=='FS-MAX')if($str_len>$xsig[$sxi][1])continue 2;
                if($xsig[$sxi][0]=='FD')if(!substr_count($str_hex,$xsig[$sxi][1]))continue 2;
                if($xsig[$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',$str_hex))continue 2;
                if($xsig[$sxi][0]=='FD-NORM')if(!substr_count($str_norm,$xsig[$sxi][1]))continue 2;
                if($xsig[$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$sxi][1].'/i',$str_norm))continue 2;
                if(substr($xsig[$sxi][0],0,1)=='$')
                    {
                    $vf=substr($xsig[$sxi][0],1);
                    if(!isset($$vf))continue 2;
                    if(is_array($$vf))continue 2;
                    if($$vf!=$xsig[$sxi][1])continue 2;
                    }
                else if(substr($xsig[$sxi][0],0,2)=='!$')
                    {
                    $vf=substr($xsig[$sxi][0],2);
                    if(!isset($$vf))continue 2;
                    if(is_array($$vf))continue 2;
                    if($$vf==$xsig[$sxi][1])continue 2;
                    }
                else if(!substr_count(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,',','.$xsig[$sxi][0].','))continue 2;
                }
            }
        $sxc=count($switch);
        if($sxc>1)
            {
            if($switch[1]=='true')
                {
                $$theswitch=true;
                continue;
                }
            if($switch[1]=='false')
                {
                $$theswitch=false;
                continue;
                }
            $$theswitch=$switch[1];
            }
        else
            {
            if(!isset($$theswitch))
                {
                $$theswitch=true;
                continue;
                }
            $$theswitch=(!$$theswitch)?true:false;
            }
        $sxi=$sxc=$theswitch=$switch=$xsig='';
        }
    $is_pe=false;
    $NumOfSections=0;
    $PEFileDescription=$PEFileVersion=$PEProductName=$PEProductVersion=$PECopyright=$PEOriginalFilename=$PECompanyName='';
    if($GLOBALS['MusselConfig']['signatures']['pe_clamav']||$GLOBALS['MusselConfig']['signatures']['pe_custom']||$GLOBALS['MusselConfig']['signatures']['pe_mussel']||$GLOBALS['MusselConfig']['signatures']['pex_custom']||$GLOBALS['MusselConfig']['signatures']['pex_mussel']||$GLOBALS['MusselConfig']['attack_specific']['corrupted_exe'])
        {
        if(substr($str,0,2)==='MZ')
            {
            $PEArr=array();
            $PEArr['Offset']=@unpack('S',substr($str,60,4));
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
                if($PEArr['Magic']!=='PE')
                    {
                    $PEArr['DoScan']=false;
                    break;
                    }
                $PEArr['Proc']=@unpack('S',substr($str,$PEArr['Offset']+4,2));
                $PEArr['Proc']=$PEArr['Proc'][1];
                if($PEArr['Proc']!=0x14c&&$PEArr['Proc']!=0x8664)
                    {
                    $PEArr['DoScan']=false;
                    break;
                    }
                $PEArr['NumOfSections']=@unpack('S',substr($str,$PEArr['Offset']+6,2));
                $NumOfSections=$PEArr['NumOfSections']=$PEArr['NumOfSections'][1];
                $CoExMeta.='PE_Offset:'.$PEArr['Offset'].';PE_Proc:'.$PEArr['Proc'].';NumOfSections:'.$PEArr['NumOfSections'].';';
                if($PEArr['NumOfSections']<1||$PEArr['NumOfSections']>40)$PEArr['DoScan']=false;
                break;
                }
            if(!$PEArr['DoScan']&&$GLOBALS['MusselConfig']['attack_specific']['corrupted_exe'])
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.$GLOBALS['MusselConfig']['lang']['corrupted'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['corrupted'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            if($PEArr['DoScan'])$is_pe=true;
            if($PEArr['DoScan']&&($GLOBALS['MusselConfig']['signatures']['pe_clamav']||$GLOBALS['MusselConfig']['signatures']['pe_custom']||$GLOBALS['MusselConfig']['signatures']['pe_mussel']||$GLOBALS['MusselConfig']['signatures']['pex_custom']||$GLOBALS['MusselConfig']['signatures']['pex_mussel']))
                {
                $asciiable=false;
                $PEArr['OptHdrSize']=@unpack('S',substr($str,$PEArr['Offset']+20,2));
                $PEArr['OptHdrSize']=$PEArr['OptHdrSize'][1];
                for($PEArr['Reconstruction']='',$PEArr['k']=0;$PEArr['k']<$PEArr['NumOfSections'];$PEArr['k']++)
                    {
                    $PEArr['SectionHead']=substr($str,$PEArr['Offset']+24+$PEArr['OptHdrSize']+($PEArr['k']*40),$PEArr['NumOfSections']*40);
                    $PEArr['SectionName']=str_ireplace("\x00",'',substr($PEArr['SectionHead'],0,8));
                    $PEArr['VirtualSize']=@unpack('S',substr($PEArr['SectionHead'],8,4));
                    $PEArr['VirtualSize']=$PEArr['VirtualSize'][1];
                    $PEArr['VirtualAddress']=@unpack('S',substr($PEArr['SectionHead'],12,4));
                    $PEArr['VirtualAddress']=$PEArr['VirtualAddress'][1];
                    $PEArr['SizeOfRawData']=@unpack('S',substr($PEArr['SectionHead'],16,4));
                    $PEArr['SizeOfRawData']=$PEArr['SizeOfRawData'][1];
                    $PEArr['PointerToRawData']=@unpack('S',substr($PEArr['SectionHead'],20,4));
                    $PEArr['PointerToRawData']=$PEArr['PointerToRawData'][1];
                    $PEArr['SectionData']=@substr($str,$PEArr['PointerToRawData'],$PEArr['SizeOfRawData']);
                    $PEArr['MD5']=md5($PEArr['SectionData']);
                    $PEArr['Reconstruction'].=$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':'.$ofn.'-'.$PEArr['SectionName'].$GLOBALS['linebreak'];
                    $CoExMeta.='SectionName:'.$PEArr['SectionName'].';VirtualSize:'.$PEArr['VirtualSize'].';VirtualAddress:'.$PEArr['VirtualAddress'].';SizeOfRawData:'.$PEArr['SizeOfRawData'].';MD5:'.$PEArr['MD5'].';';
                    if($GLOBALS['MusselConfig']['signatures']['pe_clamav'])
                        {
                        if(!isset($GLOBALS['memCache']['pe_clamav.cvd']))$GLOBALS['memCache']['pe_clamav.cvd']=phpMusselFile($GLOBALS['vault'].'pe_clamav.cvd');
                        if(!$GLOBALS['memCache']['pe_clamav.cvd'])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_clamav.cvd)! ';
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_clamav.cvd)!'.$GLOBALS['linebreak'];
                                }
                            }
                        else
                            {
                            if(substr_count($GLOBALS['memCache']['pe_clamav.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':'))
                                {
                                $xsig=substraf($GLOBALS['memCache']['pe_clamav.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':');
                                if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                                $xsig=vn_shorthand($xsig);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                $xsig='';
                                }
                            }
                        }
                    if($GLOBALS['MusselConfig']['signatures']['pe_custom'])
                        {
                        if(!isset($GLOBALS['memCache']['pe_custom.cvd']))$GLOBALS['memCache']['pe_custom.cvd']=phpMusselFile($GLOBALS['vault'].'pe_custom.cvd');
                        if(!$GLOBALS['memCache']['pe_custom.cvd'])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_custom.cvd)! ';
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_custom.cvd)!'.$GLOBALS['linebreak'];
                                }
                            }
                        else
                            {
                            if(substr_count($GLOBALS['memCache']['pe_custom.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':'))
                                {
                                $xsig=substraf($GLOBALS['memCache']['pe_custom.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':');
                                if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                                $xsig=vn_shorthand($xsig);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                $xsig='';
                                }
                            }
                        }
                    if($GLOBALS['MusselConfig']['signatures']['pe_mussel'])
                        {
                        if(!isset($GLOBALS['memCache']['pe_mussel.cvd']))$GLOBALS['memCache']['pe_mussel.cvd']=phpMusselFile($GLOBALS['vault'].'pe_mussel.cvd');
                        if(!$GLOBALS['memCache']['pe_mussel.cvd'])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_mussel.cvd)! ';
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pe_mussel.cvd)!'.$GLOBALS['linebreak'];
                                }
                            }
                        else
                            {
                            if(substr_count($GLOBALS['memCache']['pe_mussel.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':'))
                                {
                                $xsig=substraf($GLOBALS['memCache']['pe_mussel.cvd'],$PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':');
                                if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                                $xsig=vn_shorthand($xsig);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                $xsig='';
                                }
                            }
                        }
                    }
                if($PEArr['Reconstruction'])$GLOBALS['pedata'].=$PEArr['Reconstruction'];
                if(substr_count($str,"V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24"))
                    {
                    $PEArr['FINFO']=substral($str,"V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24");
                    if(substr_count($PEArr['FINFO'],"F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00"))$PEFileDescription=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"))$PEFileVersion=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00"))$PEProductName=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"))$PEProductVersion=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00"))$PECopyright=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00"))$PEOriginalFilename=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                    if(substr_count($PEArr['FINFO'],"C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00"))$PECompanyName=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                    $PEArr['FINFO']=array();
                    $PEArr['FINDX']=0;
                    if($PEFileDescription)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PEFileDescription:'.md5($PEFileDescription).':'.strlen($PEFileDescription).':';
                        $PEArr['FINDX']++;
                        }
                    if($PEFileVersion)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PEFileVersion:'.md5($PEFileVersion).':'.strlen($PEFileVersion).':';
                        $PEArr['FINDX']++;
                        }
                    if($PEProductName)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PEProductName:'.md5($PEProductName).':'.strlen($PEProductName).':';
                        $PEArr['FINDX']++;
                        }
                    if($PEProductVersion)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PEProductVersion:'.md5($PEProductVersion).':'.strlen($PEProductVersion).':';
                        $PEArr['FINDX']++;
                        }
                    if($PECopyright)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PECopyright:'.md5($PECopyright).':'.strlen($PECopyright).':';
                        $PEArr['FINDX']++;
                        }
                    if($PEOriginalFilename)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PEOriginalFilename:'.md5($PEOriginalFilename).':'.strlen($PEOriginalFilename).':';
                        $PEArr['FINDX']++;
                        }
                    if($PECompanyName)
                        {
                        $PEArr['FINFO'][$PEArr['FINDX']]='$PECompanyName:'.md5($PECompanyName).':'.strlen($PECompanyName).':';
                        $PEArr['FINDX']++;
                        }
                    if($GLOBALS['MusselConfig']['signatures']['pex_custom'])
                        {
                        if(!isset($GLOBALS['memCache']['pex_custom.cvd']))$GLOBALS['memCache']['pex_custom.cvd']=phpMusselFile($GLOBALS['vault'].'pex_custom.cvd');
                        if(!$GLOBALS['memCache']['pex_custom.cvd'])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pex_custom.cvd)! ';
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pex_custom.cvd)!'.$GLOBALS['linebreak'];
                                }
                            }
                        else
                            {
                            for($PEArr['PEMDI']=0;$PEArr['PEMDI']<$PEArr['FINDX'];$PEArr['PEMDI']++)
                                {
                                if(substr_count($GLOBALS['memCache']['pex_custom.cvd'],$PEArr['FINFO'][$PEArr['PEMDI']]))
                                    {
                                    $xsig=substraf($GLOBALS['memCache']['pex_custom.cvd'],$PEArr['FINFO'][$PEArr['PEMDI']]);
                                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                                    $xsig=vn_shorthand($xsig);
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        if($GLOBALS['memCache']['weighted'])
                                            {
                                            $heur['weight']++;
                                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                            }
                                        else
                                            {
                                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                            }
                                        }
                                    $xsig='';
                                    }
                                }
                            }
                        }
                    if($GLOBALS['MusselConfig']['signatures']['pex_mussel'])
                        {
                        if(!isset($GLOBALS['memCache']['pex_mussel.cvd']))$GLOBALS['memCache']['pex_mussel.cvd']=phpMusselFile($GLOBALS['vault'].'pex_mussel.cvd');
                        if(!$GLOBALS['memCache']['pex_mussel.cvd'])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pex_mussel.cvd)! ';
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (pex_mussel.cvd)!'.$GLOBALS['linebreak'];
                                }
                            }
                        else
                            {
                            for($PEArr['PEMDI']=0;$PEArr['PEMDI']<$PEArr['FINDX'];$PEArr['PEMDI']++)
                                {
                                if(substr_count($GLOBALS['memCache']['pex_mussel.cvd'],$PEArr['FINFO'][$PEArr['PEMDI']]))
                                    {
                                    $xsig=substraf($GLOBALS['memCache']['pex_mussel.cvd'],$PEArr['FINFO'][$PEArr['PEMDI']]);
                                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                                    $xsig=vn_shorthand($xsig);
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        if($GLOBALS['memCache']['weighted'])
                                            {
                                            $heur['weight']++;
                                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                            }
                                        else
                                            {
                                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                            }
                                        }
                                    $xsig='';
                                    }
                                }
                            }
                        }
                    }
                }
            $PEArr=false;
            }
        }
    for($SigSet=0;$SigSet<5;$SigSet++)
        {
        $SigDo=false;
        if($SigSet===0)
            {
            if(!isset($whitelist['EXE'])&&($GLOBALS['MusselConfig']['signatures']['exe_clamav']||$GLOBALS['MusselConfig']['signatures']['exe_custom']||$GLOBALS['MusselConfig']['signatures']['exe_mussel'])&&(substr_count(',acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,',','.$xt.',')||substr($str,0,2)==='MZ'))
                {
                $SigClamAVOption='exe_clamav';
                $SigClamAVStandard='exe_clamav_standard.cvd';
                $SigClamAVStandardMap='exe_clamav_standard.map';
                $SigClamAVRegex='exe_clamav_regex.cvd';
                $SigClamAVRegexMap='exe_clamav_regex.map';
                $SigCustomOption='exe_custom';
                $SigCustomStandard='exe_custom_standard.cvd';
                $SigCustomRegex='exe_custom_regex.cvd';
                $SigMusselOption='exe_mussel';
                $SigMusselStandard='exe_mussel_standard.cvd';
                $SigMusselRegex='exe_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            $is_elf=false;
            if(!isset($whitelist['ELF'])&&($GLOBALS['MusselConfig']['signatures']['elf_clamav']||$GLOBALS['MusselConfig']['signatures']['elf_custom']||$GLOBALS['MusselConfig']['signatures']['elf_mussel'])&&($xt=='elf'||substr($str_hex,0,8)==='7f454c46'))
                {
                $is_elf=true;
                $SigClamAVOption='elf_clamav';
                $SigClamAVStandard='elf_clamav_standard.cvd';
                $SigClamAVStandardMap='elf_clamav_standard.map';
                $SigClamAVRegex='elf_clamav_regex.cvd';
                $SigClamAVRegexMap='elf_clamav_regex.map';
                $SigCustomOption='elf_custom';
                $SigCustomStandard='elf_custom_standard.cvd';
                $SigCustomRegex='elf_custom_regex.cvd';
                $SigMusselOption='elf_mussel';
                $SigMusselStandard='elf_mussel_standard.cvd';
                $SigMusselRegex='elf_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            $is_macho=false;
            if(!isset($whitelist['OSX'])&&($GLOBALS['MusselConfig']['signatures']['macho_clamav']||$GLOBALS['MusselConfig']['signatures']['macho_custom']||$GLOBALS['MusselConfig']['signatures']['macho_mussel'])&&substr_count(',cafebabe,cafed00d,cefaedfe,cffaedfe,feedface,feedfacf,',','.substr($str_hex,0,8).','))
                {
                $is_macho=true;
                $SigClamAVOption='macho_clamav';
                $SigClamAVStandard='macho_clamav_standard.cvd';
                $SigClamAVStandardMap='macho_clamav_standard.map';
                $SigClamAVRegex='macho_clamav_regex.cvd';
                $SigClamAVRegexMap='macho_clamav_regex.map';
                $SigCustomOption='macho_custom';
                $SigCustomStandard='macho_custom_standard.cvd';
                $SigCustomRegex='macho_custom_regex.cvd';
                $SigMusselOption='macho_mussel';
                $SigMusselStandard='macho_mussel_standard.cvd';
                $SigMusselRegex='macho_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===3)
            {
            if(!isset($whitelist['PDF'])&&($GLOBALS['MusselConfig']['signatures']['pdf_clamav']||$GLOBALS['MusselConfig']['signatures']['pdf_custom']||$GLOBALS['MusselConfig']['signatures']['pdf_mussel']))if(substr_count(',pdf,',','.$xt.',')>0||$pdf_magic)
                {
                $SigClamAVOption='pdf_clamav';
                $SigClamAVStandard='pdf_clamav_standard.cvd';
                $SigClamAVStandardMap='pdf_clamav_standard.map';
                $SigClamAVRegex='pdf_clamav_regex.cvd';
                $SigClamAVRegexMap='pdf_clamav_regex.map';
                $SigCustomOption='pdf_custom';
                $SigCustomStandard='pdf_custom_standard.cvd';
                $SigCustomRegex='pdf_custom_regex.cvd';
                $SigMusselOption='pdf_mussel';
                $SigMusselStandard='pdf_mussel_standard.cvd';
                $SigMusselRegex='pdf_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===4)
            {
            $is_swf=false;
            if(!isset($whitelist['SWF'])&&($GLOBALS['MusselConfig']['signatures']['swf_clamav']||$GLOBALS['MusselConfig']['signatures']['swf_custom']||$GLOBALS['MusselConfig']['signatures']['swf_mussel']))if(substr_count(",435753,465753,5a5753,",",".substr($str_hex,0,6).",")||substr_count(",swf,swt,",",".$xt.","))
                {
                $is_swf=true;
                $SigClamAVOption='swf_clamav';
                $SigClamAVStandard='swf_clamav_standard.cvd';
                $SigClamAVStandardMap='swf_clamav_standard.map';
                $SigClamAVRegex='swf_clamav_regex.cvd';
                $SigClamAVRegexMap='swf_clamav_regex.map';
                $SigCustomOption='swf_custom';
                $SigCustomStandard='swf_custom_standard.cvd';
                $SigCustomRegex='swf_custom_regex.cvd';
                $SigMusselOption='swf_mussel';
                $SigMusselStandard='swf_mussel_standard.cvd';
                $SigMusselRegex='swf_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            if($GLOBALS['MusselConfig']['signatures'][$SigClamAVOption])
                {
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigClamAVStandard]))$GLOBALS['memCache'][$SigClamAVStandard]=@file($GLOBALS['vault'].$SigClamAVStandard);
                    if(!$GLOBALS['memCache'][$SigClamAVStandard])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigClamAVStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigClamAVStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache'][$SigClamAVStandardMap]))$GLOBALS['memCache'][$SigClamAVStandardMap]=@file($GLOBALS['vault'].$SigClamAVStandardMap);
                    if(!$GLOBALS['memCache'][$SigClamAVStandardMap])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' ('.$SigClamAVStandardMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' ('.$SigClamAVStandardMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigClamAVStandardMap]);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' ('.$SigClamAVStandardMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' ('.$SigClamAVStandardMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        $map=explode(':',$GLOBALS['memCache'][$SigClamAVStandardMap][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_hex,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache'][$SigClamAVStandard][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if($str_hex_len<$xlen)continue;
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                        $xsigc=count($xsig);
                                        $this_str=$str_hex;
                                        if($xstrf=='A')
                                            {
                                            $this_str="\x01".$this_str;
                                            $xsig[0]="\x01".$xsig[0];
                                            }
                                        else if($xstrf!='*')$this_str=substr($this_str,$xstrf*2);
                                        if($xstrt!='*')$this_str=substr($this_str,0,$xstrt*2);
                                        for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                            {
                                            if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
                                            if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                            }
                                        $this_str=false;
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigClamAVRegex]))$GLOBALS['memCache'][$SigClamAVRegex]=@file($GLOBALS['vault'].$SigClamAVRegex);
                    if(!$GLOBALS['memCache'][$SigClamAVRegex])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigClamAVRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigClamAVRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache'][$SigClamAVRegexMap]))$GLOBALS['memCache'][$SigClamAVRegexMap]=@file($GLOBALS['vault'].$SigClamAVRegexMap);
                    if(!$GLOBALS['memCache'][$SigClamAVRegexMap])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' ('.$SigClamAVRegexMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' ('.$SigClamAVRegexMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigClamAVRegexMap]);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' ('.$SigClamAVRegexMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' ('.$SigClamAVRegexMap.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        $map=explode(':',$GLOBALS['memCache'][$SigClamAVRegexMap][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_hex,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache'][$SigClamAVRegex][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        if($xstrf=='*')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',$str_hex))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                            }
                                        else if($xstrf=='A')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/\A'.$xsig.'/i',$str_hex))continue;
                                                }
                                            else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                            }
                                        else
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2)))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2)))continue;
                                            }
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            if($GLOBALS['MusselConfig']['signatures'][$SigCustomOption])
                {
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigCustomStandard]))$GLOBALS['memCache'][$SigCustomStandard]=@file($GLOBALS['vault'].$SigCustomStandard);
                    if(!$GLOBALS['memCache'][$SigCustomStandard])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigCustomStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigCustomStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigCustomStandard]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigCustomStandard][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if($str_hex_len<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$str_hex;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')$this_str=substr($this_str,$xstrf*2);
                                if($xstrt!='*')$this_str=substr($this_str,0,$xstrt*2);
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                    }
                                $this_str=false;
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigCustomRegex]))$GLOBALS['memCache'][$SigCustomRegex]=@file($GLOBALS['vault'].$SigCustomRegex);
                    if(!$GLOBALS['memCache'][$SigCustomRegex])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigCustomRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigCustomRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigCustomRegex]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigCustomRegex][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$str_hex))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$str_hex))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2)))continue;
                                    }
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            if($GLOBALS['MusselConfig']['signatures'][$SigMusselOption])
                {
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigMusselStandard]))$GLOBALS['memCache'][$SigMusselStandard]=@file($GLOBALS['vault'].$SigMusselStandard);
                    if(!$GLOBALS['memCache'][$SigMusselStandard])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigMusselStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigMusselStandard.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigMusselStandard]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigMusselStandard][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if($str_hex_len<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$str_hex;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')$this_str=substr($this_str,$xstrf*2);
                                if($xstrt!='*')$this_str=substr($this_str,0,$xstrt*2);
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                    }
                                $this_str=false;
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigMusselRegex]))$GLOBALS['memCache'][$SigMusselRegex]=@file($GLOBALS['vault'].$SigMusselRegex);
                    if(!$GLOBALS['memCache'][$SigMusselRegex])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigMusselRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigMusselRegex.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigMusselRegex]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigMusselRegex][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$str_hex))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$str_hex))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2)))continue;
                                    }
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            }
        }
    unset($SigMusselRegex,$SigMusselStandard,$SigMusselOption,$SigCustomRegex,$SigCustomStandard,$SigCustomOption,$SigClamAVRegexMap,$SigClamAVRegex,$SigClamAVStandardMap,$SigClamAVStandard,$SigClamAVOption);
    $is_not_html=$is_not_php=$SigSet=$SigDo=false;
    if(!$is_html&&($is_macho||$is_elf||$is_pe))$is_not_html=true;
    if(!(substr_count(',php*,',','.$xts.',')>0||substr_count(',php*,',','.$gzxts.',')>0)&&!substr_count($str_norm,'3c3f706870'))if($is_pe)$is_not_php=true;
    if(!isset($whitelist['General'])&&$infectable&&$GLOBALS['MusselConfig']['signatures']['general_clamav'])
        {
        while(true)
            {
            if(!isset($GLOBALS['memCache']['general_clamav_standard.cvd']))$GLOBALS['memCache']['general_clamav_standard.cvd']=@file($GLOBALS['vault'].'general_clamav_standard.cvd');
            if(!$GLOBALS['memCache']['general_clamav_standard.cvd'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (general_clamav_standard.cvd)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (general_clamav_standard.cvd)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            if(!isset($GLOBALS['memCache']['general_clamav_standard.map']))$GLOBALS['memCache']['general_clamav_standard.map']=@file($GLOBALS['vault'].'general_clamav_standard.map');
            if(!$GLOBALS['memCache']['general_clamav_standard.map'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (general_clamav_standard.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (general_clamav_standard.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            $c=@count($GLOBALS['memCache']['general_clamav_standard.map']);
            if($c<1)
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (general_clamav_standard.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (general_clamav_standard.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            for($i=0;$i<$c;$i++)
                {
                if(substr($GLOBALS['memCache']['general_clamav_standard.map'][$i],0,1)=='>')
                    {
                    $mapcon=explode('>',$GLOBALS['memCache']['general_clamav_standard.map'][$i],4);
                    $mapcon[3]=(int)$mapcon[3];
                    if($mapcon[1]=='FN')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MIN')
                        {
                        if($str_len<$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MAX')
                        {
                        if($str_len>$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD')
                        {
                        if(!substr_count($str_hex,$mapcon[2]))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD-RX')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if(substr($mapcon[1],0,1)=='$')
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
                    else if(substr($mapcon[1],0,2)=='!$')
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
                $map=explode(':',$GLOBALS['memCache']['general_clamav_standard.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($str_hex,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['general_clamav_standard.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            $vnlc=strtolower($vn);
                            if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                            if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                            if($str_hex_len<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$str_hex;
                                $this_xmlxdp=$str_xmlxdp;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $this_xmlxdp="\x01".$this_xmlxdp;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')
                                    {
                                    $this_str=substr($this_str,$xstrf*2);
                                    $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                    }
                                if($xstrt!='*')
                                    {
                                    $this_str=substr($this_str,0,$xstrt*2);
                                    $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                    }
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)
                                        {
                                        if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                        if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                        }
                                    }
                                $this_xmlxdp=$this_str=false;
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        while(true)
            {
            if(!isset($GLOBALS['memCache']['general_clamav_regex.cvd']))$GLOBALS['memCache']['general_clamav_regex.cvd']=@file($GLOBALS['vault'].'general_clamav_regex.cvd');
            if(!$GLOBALS['memCache']['general_clamav_regex.cvd'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (general_clamav_regex.cvd)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (general_clamav_regex.cvd)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            if(!isset($GLOBALS['memCache']['general_clamav_regex.map']))$GLOBALS['memCache']['general_clamav_regex.map']=@file($GLOBALS['vault'].'general_clamav_regex.map');
            if(!$GLOBALS['memCache']['general_clamav_regex.map'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (general_clamav_regex.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (general_clamav_regex.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            $c=@count($GLOBALS['memCache']['general_clamav_regex.map']);
            if($c<1)
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (general_clamav_regex.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (general_clamav_regex.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            for($i=0;$i<$c;$i++)
                {
                if(substr($GLOBALS['memCache']['general_clamav_regex.map'][$i],0,1)=='>')
                    {
                    $mapcon=explode('>',$GLOBALS['memCache']['general_clamav_regex.map'][$i],4);
                    $mapcon[3]=(int)$mapcon[3];
                    if($mapcon[1]=='FN')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MIN')
                        {
                        if($str_len<$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MAX')
                        {
                        if($str_len>$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD')
                        {
                        if(!substr_count($str_hex,$mapcon[2]))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD-RX')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if(substr($mapcon[1],0,1)=='$')
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
                    else if(substr($mapcon[1],0,2)=='!$')
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
                $map=explode(':',$GLOBALS['memCache']['general_clamav_regex.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($str_hex,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['general_clamav_regex.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            $vnlc=strtolower($vn);
                            if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                            if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
                                    }
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        }
    for($SigSet=0;$SigSet<2;$SigSet++)
        {
        if(isset($whitelist['General']))break;
        $SigDo=$SigRegexFile=$SigStandardFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['general_custom'])
                {
                $SigStandardFile='general_custom_standard.cvd';
                $SigRegexFile='general_custom_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['general_mussel'])
                {
                $SigStandardFile='general_mussel_standard.cvd';
                $SigRegexFile='general_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                if(!$GLOBALS['memCache'][$SigStandardFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        $vnlc=strtolower($vn);
                        if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                        if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                        if($str_hex_len<$xlen)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                            $xsigc=count($xsig);
                            $this_str=$str_hex;
                            $this_xmlxdp=$str_xmlxdp;
                            if($xstrf=='A')
                                {
                                $this_str="\x01".$this_str;
                                $this_xmlxdp="\x01".$this_xmlxdp;
                                $xsig[0]="\x01".$xsig[0];
                                }
                            else if($xstrf!='*')
                                {
                                $this_str=substr($this_str,$xstrf*2);
                                $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                }
                            if($xstrt!='*')
                                {
                                $this_str=substr($this_str,0,$xstrt*2);
                                $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                }
                            for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                {
                                if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                if($xsigc>1)
                                    {
                                    if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                    if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                    }
                                }
                            $this_xmlxdp=$this_str=false;
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                if(!$GLOBALS['memCache'][$SigRegexFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        $vnlc=strtolower($vn);
                        if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                        if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($xstrf=='*')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                }
                            else if($xstrf=='A')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp))continue;
                                    }
                                else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                }
                            else
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2)))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
                                }
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            }
        }
    if(!isset($whitelist['ASCII'])&&$asciiable&&$infectable&&$GLOBALS['MusselConfig']['signatures']['ascii_clamav'])
        {
        while(true)
            {
            if(!isset($GLOBALS['memCache']['ascii_clamav_standard.cvd']))$GLOBALS['memCache']['ascii_clamav_standard.cvd']=@file($GLOBALS['vault'].'ascii_clamav_standard.cvd');
            if(!$GLOBALS['memCache']['ascii_clamav_standard.cvd'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ascii_clamav_standard.cvd)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ascii_clamav_standard.cvd)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            if(!isset($GLOBALS['memCache']['ascii_clamav_standard.map']))$GLOBALS['memCache']['ascii_clamav_standard.map']=@file($GLOBALS['vault'].'ascii_clamav_standard.map');
            if(!$GLOBALS['memCache']['ascii_clamav_standard.map'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ascii_clamav_standard.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ascii_clamav_standard.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            $c=@count($GLOBALS['memCache']['ascii_clamav_standard.map']);
            if($c<1)
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ascii_clamav_standard.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ascii_clamav_standard.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            for($i=0;$i<$c;$i++)
                {
                if(substr($GLOBALS['memCache']['ascii_clamav_standard.map'][$i],0,1)=='>')
                    {
                    $mapcon=explode('>',$GLOBALS['memCache']['ascii_clamav_standard.map'][$i],4);
                    $mapcon[3]=(int)$mapcon[3];
                    if($mapcon[1]=='FN')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MIN')
                        {
                        if($str_len<$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MAX')
                        {
                        if($str_len>$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD')
                        {
                        if(!substr_count($str_hex,$mapcon[2]))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD-RX')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if(substr($mapcon[1],0,1)=='$')
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
                    else if(substr($mapcon[1],0,2)=='!$')
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
                $map=explode(':',$GLOBALS['memCache']['ascii_clamav_standard.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($str_norm,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['ascii_clamav_standard.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            $vnlc=strtolower($vn);
                            if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                            if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                            if($str_norm_len<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$str_norm;
                                $this_xmlxdp=$str_xmlxdp_norm;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $this_xmlxdp="\x01".$this_xmlxdp;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')
                                    {
                                    $this_str=substr($this_str,$xstrf*2);
                                    $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                    }
                                if($xstrt!='*')
                                    {
                                    $this_str=substr($this_str,0,$xstrt*2);
                                    $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                    }
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)
                                        {
                                        if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                        if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                        }
                                    }
                                $this_xmlxdp=$this_str=false;
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        while(true)
            {
            if(!isset($GLOBALS['memCache']['ascii_clamav_regex.cvd']))$GLOBALS['memCache']['ascii_clamav_regex.cvd']=@file($GLOBALS['vault'].'ascii_clamav_regex.cvd');
            if(!$GLOBALS['memCache']['ascii_clamav_regex.cvd'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ascii_clamav_regex.cvd)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ascii_clamav_regex.cvd)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            if(!isset($GLOBALS['memCache']['ascii_clamav_regex.map']))$GLOBALS['memCache']['ascii_clamav_regex.map']=@file($GLOBALS['vault'].'ascii_clamav_regex.map');
            if(!$GLOBALS['memCache']['ascii_clamav_regex.map'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ascii_clamav_regex.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ascii_clamav_regex.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            $c=@count($GLOBALS['memCache']['ascii_clamav_regex.map']);
            if($c<1)
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ascii_clamav_regex.map)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ascii_clamav_regex.map)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            for($i=0;$i<$c;$i++)
                {
                if(substr($GLOBALS['memCache']['ascii_clamav_regex.map'][$i],0,1)=='>')
                    {
                    $mapcon=explode('>',$GLOBALS['memCache']['ascii_clamav_regex.map'][$i],4);
                    $mapcon[3]=(int)$mapcon[3];
                    if($mapcon[1]=='FN')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$ofn))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MIN')
                        {
                        if($str_len<$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FS-MAX')
                        {
                        if($str_len>$mapcon[2])
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD')
                        {
                        if(!substr_count($str_hex,$mapcon[2]))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if($mapcon[1]=='FD-RX')
                        {
                        if(!preg_match('/'.$mapcon[2].'/i',$str_hex))
                            {
                            if($mapcon[3]<=$i)break;
                            $i=$mapcon[3]-1;
                            }
                        }
                    else if(substr($mapcon[1],0,1)=='$')
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
                    else if(substr($mapcon[1],0,2)=='!$')
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
                $map=explode(':',$GLOBALS['memCache']['ascii_clamav_regex.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($str_norm,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['ascii_clamav_regex.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            $vnlc=strtolower($vn);
                            if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                            if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$str_norm)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp_norm))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_norm,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$str_norm)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp_norm))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($str_norm,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,$xstrf*2,$xstrt*2)))continue;
                                    }
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        }
    if($asciiable)for($SigSet=0;$SigSet<2;$SigSet++)
        {
        if(isset($whitelist['ASCII']))break;
        $SigDo=$SigRegexFile=$SigStandardFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['ascii_custom'])
                {
                $SigStandardFile='ascii_custom_standard.cvd';
                $SigRegexFile='ascii_custom_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['ascii_mussel'])
                {
                $SigStandardFile='ascii_mussel_standard.cvd';
                $SigRegexFile='ascii_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                if(!$GLOBALS['memCache'][$SigStandardFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_norm,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_norm))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        $vnlc=strtolower($vn);
                        if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                        if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                        if($str_norm_len<$xlen)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                            $xsigc=count($xsig);
                            $this_str=$str_norm;
                            $this_xmlxdp=$str_xmlxdp_norm;
                            if($xstrf=='A')
                                {
                                $this_str="\x01".$this_str;
                                $this_xmlxdp="\x01".$this_xmlxdp;
                                $xsig[0]="\x01".$xsig[0];
                                }
                            else if($xstrf!='*')
                                {
                                $this_str=substr($this_str,$xstrf*2);
                                $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                }
                            if($xstrt!='*')
                                {
                                $this_str=substr($this_str,0,$xstrt*2);
                                $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                }
                            for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                {
                                if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                if($xsigc>1)
                                    {
                                    if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                    if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                    }
                                }
                            $this_xmlxdp=$this_str=false;
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                if(!$GLOBALS['memCache'][$SigRegexFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_norm,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_norm))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        $vnlc=strtolower($vn);
                        if(substr_count($vnlc,'-php')||substr_count($vnlc,'.php'))if($is_not_php)continue;
                        if(substr_count($vnlc,'-htm')||substr_count($vnlc,'.htm'))if($is_not_html)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($xstrf=='*')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',$str_norm)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp_norm))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_norm,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
                                }
                            else if($xstrf=='A')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/\A'.$xsig.'/i',$str_norm)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp_norm))continue;
                                    }
                                else if(!preg_match('/\A'.$xsig.'/i',substr($str_norm,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp_norm,0,$xstrt*2)))continue;
                                }
                            else
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,$xstrf*2)))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp_norm,$xstrf*2,$xstrt*2)))continue;
                                }
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_php'])
        {
        if(!(substr_count(',cvd,inc,md,phar,pzp,tpl,txt,tzt,',','.$xt.',')>0||substr_count(',php*,',','.$xts.',')>0||substr_count(',php*,',','.$gzxts.',')>0||substr_count(','.$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].',',','.$xts.',')>0||substr_count(','.$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions_wc'].',',','.$gzxts.',')>0||substr_count(','.$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['attack_specific']['archive_file_extensions'].',',','.$gzxt.',')>0))
            {
            if(substr_count($str_norm,'3c3f706870')>0)
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'PHP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'PHP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_from_exe'])
        {
        if(substr_count(',acm,ax,com,cpl,dll,drv,exe,ocx,rs,scr,sys,',','.$xt.',')>0)
            {
            if(substr($str,0,2)!=='MZ')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'EXE'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'EXE'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        else
            {
            if(substr($str,0,2)==='MZ')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'EXE'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'EXE'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='elf')
            {
            if(substr($str_hex,0,8)!=='7f454c46')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'ELF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'ELF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        else
            {
            if(substr($str_hex,0,8)==='7f454c46')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'ELF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'ELF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='lnk')
            {
            if(substr($str_hex,0,16)!=='4c00000001140200')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'LNK'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'LNK'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        else
            {
            if(substr($str_hex,0,16)==='4c00000001140200')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'LNK'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'LNK'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='msi')
            {
            if(substr($str_hex,0,16)!=='d0cf11e0a1b11ae1')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'MSI'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'MSI'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        }
    if(!isset($GLOBALS['memCache']['file_is_ole']))$GLOBALS['memCache']['file_is_ole']=false;
    if($GLOBALS['memCache']['file_is_ole'])if(!isset($whitelist['OLE'])&&($GLOBALS['MusselConfig']['signatures']['ole_clamav']||$GLOBALS['MusselConfig']['signatures']['ole_custom']||$GLOBALS['MusselConfig']['signatures']['ole_mussel']))if(!($str_hex_len<1024&&substr_count(',xml,rels,',','.$xt.',')>0))
        {
        if($GLOBALS['MusselConfig']['signatures']['ole_clamav'])
            {
            while(true)
                {
                if(!isset($GLOBALS['memCache']['ole_clamav_standard.cvd']))$GLOBALS['memCache']['ole_clamav_standard.cvd']=@file($GLOBALS['vault'].'ole_clamav_standard.cvd');
                if(!$GLOBALS['memCache']['ole_clamav_standard.cvd'])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ole_clamav_standard.cvd)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ole_clamav_standard.cvd)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                if(!isset($GLOBALS['memCache']['ole_clamav_standard.map']))$GLOBALS['memCache']['ole_clamav_standard.map']=@file($GLOBALS['vault'].'ole_clamav_standard.map');
                if(!$GLOBALS['memCache']['ole_clamav_standard.map'])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ole_clamav_standard.map)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ole_clamav_standard.map)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache']['ole_clamav_standard.map']);
                if($c<1)
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ole_clamav_standard.map)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ole_clamav_standard.map)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                for($i=0;$i<$c;$i++)
                    {
                    $map=explode(':',$GLOBALS['memCache']['ole_clamav_standard.map'][$i]);
                    $map[2]=(int)$map[2];
                    if(substr_count($str_hex,$map[0])>0)
                        {
                        for($xind=$map[1];$xind<($map[2]+1);$xind++)
                            {
                            $xsig=$GLOBALS['memCache']['ole_clamav_standard.cvd'][$xind];
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if($str_hex_len<$xlen)continue;
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                    $xsigc=count($xsig);
                                    $this_str=$str_hex;
                                    $this_xmlxdp=$str_xmlxdp;
                                    if($xstrf=='A')
                                        {
                                        $this_str="\x01".$this_str;
                                        $this_xmlxdp="\x01".$this_xmlxdp;
                                        $xsig[0]="\x01".$xsig[0];
                                        }
                                    else if($xstrf!='*')
                                        {
                                        $this_str=substr($this_str,$xstrf*2);
                                        $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                        }
                                    if($xstrt!='*')
                                        {
                                        $this_str=substr($this_str,0,$xstrt*2);
                                        $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                        }
                                    for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                        {
                                        if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                        if($xsigc>1)
                                            {
                                            if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                            if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                            }
                                        }
                                    $this_xmlxdp=$this_str=false;
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    }
                break;
                }
            while(true)
                {
                if(!isset($GLOBALS['memCache']['ole_clamav_regex.cvd']))$GLOBALS['memCache']['ole_clamav_regex.cvd']=@file($GLOBALS['vault'].'ole_clamav_regex.cvd');
                if(!$GLOBALS['memCache']['ole_clamav_regex.cvd'])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ole_clamav_regex.cvd)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (ole_clamav_regex.cvd)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                if(!isset($GLOBALS['memCache']['ole_clamav_regex.map']))$GLOBALS['memCache']['ole_clamav_regex.map']=@file($GLOBALS['vault'].'ole_clamav_regex.map');
                if(!$GLOBALS['memCache']['ole_clamav_regex.map'])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ole_clamav_regex.map)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (ole_clamav_regex.map)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache']['ole_clamav_regex.map']);
                if($c<1)
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ole_clamav_regex.map)! ';
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (ole_clamav_regex.map)!'.$GLOBALS['linebreak'];
                        }
                    break;
                    }
                for($i=0;$i<$c;$i++)
                    {
                    $map=explode(':',$GLOBALS['memCache']['ole_clamav_regex.map'][$i]);
                    $map[2]=(int)$map[2];
                    if(substr_count($str_hex,$map[0])>0)
                        {
                        for($xind=$map[1];$xind<($map[2]+1);$xind++)
                            {
                            $xsig=$GLOBALS['memCache']['ole_clamav_regex.cvd'][$xind];
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($xstrf=='*')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                        }
                                    else if($xstrf=='A')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp))continue;
                                            }
                                        else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                        }
                                    else
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2)))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
                                        }
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    }
                break;
                }
            }
        for($SigSet=0;$SigSet<2;$SigSet++)
            {
            $SigDo=$SigRegexFile=$SigStandardFile=false;
            if($SigSet===0)
                {
                if($GLOBALS['MusselConfig']['signatures']['ole_custom'])
                    {
                    $SigStandardFile='ole_custom_standard.cvd';
                    $SigRegexFile='ole_custom_regex.cvd';
                    $SigDo=true;
                    }
                }
            else if($SigSet===1)
                {
                if($GLOBALS['MusselConfig']['signatures']['ole_mussel'])
                    {
                    $SigStandardFile='ole_mussel_standard.cvd';
                    $SigRegexFile='ole_mussel_regex.cvd';
                    $SigDo=true;
                    }
                }
            if($SigDo)
                {
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                    if(!$GLOBALS['memCache'][$SigStandardFile])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if($str_hex_len<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$str_hex;
                                $this_xmlxdp=$str_xmlxdp;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $this_xmlxdp="\x01".$this_xmlxdp;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')
                                    {
                                    $this_str=substr($this_str,$xstrf*2);
                                    $this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                                    }
                                if($xstrt!='*')
                                    {
                                    $this_str=substr($this_str,0,$xstrt*2);
                                    $this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                                    }
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)
                                        {
                                        if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                        if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                        }
                                    }
                                $this_xmlxdp=$this_str=false;
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                    if(!$GLOBALS['memCache'][$SigRegexFile])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                    for($i=0;$i<$c;$i++)
                        {
                        $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                        if(substr($xsig,0,1)=='>')
                            {
                            $xsig=explode('>',$xsig,4);
                            $xsig[3]=(int)$xsig[3];
                            if($xsig[1]=='FN')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MIN')
                                {
                                if($str_len<$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FS-MAX')
                                {
                                if($str_len>$xsig[2])
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD')
                                {
                                if(!substr_count($str_hex,$xsig[2]))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if($xsig[1]=='FD-RX')
                                {
                                if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                    {
                                    if($xsig[3]<=$i)break;
                                    $i=$xsig[3]-1;
                                    }
                                }
                            else if(substr($xsig[1],0,1)=='$')
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
                            else if(substr($xsig[1],0,2)=='!$')
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
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_xmlxdp))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_xmlxdp))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
                                    }
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['memCache']['weighted'])
                                    {
                                    $heur['weight']++;
                                    $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_archive'])
        {
        if($xts=='zip*')
            {
            if(substr($str,0,2)!=='PK')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'ZIP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'ZIP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='rar')
            {
            if(substr($str,0,4)!=='Rar!'&&substr($str_hex,0,8)!=='52457e5e')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'RAR'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'RAR'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='gz')
            {
            if(substr($str_hex,0,4)!=='1f8b')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'GZIP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'GZIP'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='bz2')
            {
            if(substr($str_hex,0,6)!=='425a68')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'BZIP2'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'BZIP2'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_doc'])
        {
        if(substr_count(',doc,dot,pps,ppt,xla,xls,wiz,',','.$xt.',')>0)
            {
            if(substr($str_hex,0,8)!=='d0cf11e0')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>'Office'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'Office'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_img'])
        {
        if($xt=='bmp'||$xt=='dib')
            {
            if(substr($str,0,2)!=='BM')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='gif')
            {
            if(substr($str_hex,0,12)!=='474946383761'&&substr($str_hex,0,12)!=='474946383961')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='jfi'||$xt=='jfif'||$xt=='jif'||$xt=='jpe'||$xt=='jpeg'||$xt=='jpg')
            {
            if(substr($str_hex,0,6)!=='ffd8ff')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='jp2')
            {
            if(substr($str_hex,0,16)!=='0000000c6a502020')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='pdd'||$xt=='psd')
            {
            if(substr($str,0,4)!=='8BPS')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='png')
            {
            if(substr($str_hex,0,8)!=='89504e47')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='webp')
            {
            if(substr($str,0,4)!=='RIFF'||substr($str,8,4)!=='WEBP')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        if($xt=='xcf')
            {
            if(substr($str,0,8)!=='gimp xcf')
                {
                if(!$flagged)
                    {
                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                    $flagged=true;
                    }
                $heur['detections']++;
                $GLOBALS['memCache']['detections_count']++;
                $out.=$lnap.phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=phpMusselV(array('x'=>$GLOBALS['MusselConfig']['lang']['image']),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['chameleon_to_pdf'])
        {
        if($xt=='pdf'&&!$pdf_magic)
            {
            if(!$flagged)
                {
                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                $flagged=true;
                }
            $heur['detections']++;
            $GLOBALS['memCache']['detections_count']++;
            $out.=$lnap.phpMusselV(array('x'=>'PDF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
            $GLOBALS['whyflagged'].=phpMusselV(array('x'=>'PDF'),$GLOBALS['MusselConfig']['lang']['scan_chameleon']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
            }
        }
    if(!isset($whitelist['Commands'])&&$GLOBALS['MusselConfig']['attack_specific']['general_commands'])
        {
        while(true)
            {
            if(!isset($GLOBALS['memCache']['hex_general_commands.csv']))$GLOBALS['memCache']['hex_general_commands.csv']=@explode(',',phpMusselFile($GLOBALS['vault'].'hex_general_commands.csv'));
            if(!$GLOBALS['memCache']['hex_general_commands.csv'])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (hex_general_commands.csv)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (hex_general_commands.csv)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            $c=count($GLOBALS['memCache']['hex_general_commands.csv']);
            if($c<1)
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (hex_general_commands.csv)! ';
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (hex_general_commands.csv)!'.$GLOBALS['linebreak'];
                    }
                break;
                }
            for($i=0;$i<$c;$i++)
                {
                if(substr_count($str_norm,$GLOBALS['memCache']['hex_general_commands.csv'][$i])>0)
                    {
                    $xgc=@hex2bin($GLOBALS['memCache']['hex_general_commands.csv'][$i]);
                    if(!$flagged)
                        {
                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                        $flagged=true;
                        }
                    $heur['detections']++;
                    $GLOBALS['memCache']['detections_count']++;
                    $out.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_command_injection'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_command_injection'].', \''.$xgc.'\' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    }
                }
            break;
            }
        }
    $is_graphics=false;
    if(!isset($whitelist['Graphics'])&&($GLOBALS['MusselConfig']['signatures']['graphics_clamav']||$GLOBALS['MusselConfig']['signatures']['graphics_custom']||$GLOBALS['MusselConfig']['signatures']['graphics_mussel']))
        {
        if(!$is_graphics)if(substr($str_hex,0,12)==='474946383761'||substr($str_hex,0,12)==='474946383961')$is_graphics=true;
        if(!$is_graphics)if(substr($str_hex,0,16)==='0000000c6a502020')$is_graphics=true;
        if(!$is_graphics)if(substr($str_hex,0,8)==='89504e47')$is_graphics=true;
        if(!$is_graphics)if(substr($str_hex,0,6)==='ffd8ff')$is_graphics=true;
        if(!$is_graphics)if(substr($str_hex,0,8)==='25504446')$is_graphics=true;
        if(!$is_graphics)if(substr($str,0,2)==='BM'||substr($str,0,8)==='gimp xcf'||substr($str,0,4)==='8BPS'||substr($str,0,4)==='WEBP')$is_graphics=true;
        if(!$is_graphics)if(substr_count(',bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,',','.$xt.','))$is_graphics=true;
        if($is_graphics)
            {
            if($GLOBALS['MusselConfig']['signatures']['graphics_clamav'])
                {
                while(true)
                    {
                    if(!isset($GLOBALS['memCache']['graphics_clamav_standard.cvd']))$GLOBALS['memCache']['graphics_clamav_standard.cvd']=@file($GLOBALS['vault'].'graphics_clamav_standard.cvd');
                    if(!$GLOBALS['memCache']['graphics_clamav_standard.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (graphics_clamav_standard.cvd)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (graphics_clamav_standard.cvd)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache']['graphics_clamav_standard.map']))$GLOBALS['memCache']['graphics_clamav_standard.map']=@file($GLOBALS['vault'].'graphics_clamav_standard.map');
                    if(!$GLOBALS['memCache']['graphics_clamav_standard.map'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (graphics_clamav_standard.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (graphics_clamav_standard.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache']['graphics_clamav_standard.map']);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (graphics_clamav_standard.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (graphics_clamav_standard.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        $map=explode(':',$GLOBALS['memCache']['graphics_clamav_standard.map'][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_hex,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache']['graphics_clamav_standard.cvd'][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if($str_hex_len<$xlen)continue;
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                        $xsigc=count($xsig);
                                        $this_str=$str_hex;
                                        $this_norm=$str_norm;
                                        if($xstrf=='A')
                                            {
                                            $this_str="\x01".$this_str;
                                            $this_norm="\x01".$this_norm;
                                            $xsig[0]="\x01".$xsig[0];
                                            }
                                        else if($xstrf!='*')
                                            {
                                            $this_str=substr($this_str,$xstrf*2);
                                            $this_norm=substr($this_norm,$xstrf*2);
                                            }
                                        if($xstrt!='*')
                                            {
                                            $this_str=substr($this_str,0,$xstrt*2);
                                            $this_norm=substr($this_norm,0,$xstrt*2);
                                            }
                                        for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                            {
                                            if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_norm,$xsig[$xsigi]))continue 2;
                                            if($xsigc>1)
                                                {
                                                if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                                if(substr_count($this_norm,$xsig[$xsigi]))$this_norm=substraf($this_norm,$xsig[$xsigi].'>');
                                                }
                                            }
                                        $this_norm=$this_str=false;
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                while(true)
                    {
                    if(!isset($GLOBALS['memCache']['graphics_clamav_regex.cvd']))$GLOBALS['memCache']['graphics_clamav_regex.cvd']=@file($GLOBALS['vault'].'graphics_clamav_regex.cvd');
                    if(!$GLOBALS['memCache']['graphics_clamav_regex.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (graphics_clamav_regex.cvd)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (graphics_clamav_regex.cvd)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    if(!isset($GLOBALS['memCache']['graphics_clamav_regex.map']))$GLOBALS['memCache']['graphics_clamav_regex.map']=@file($GLOBALS['vault'].'graphics_clamav_regex.map');
                    if(!$GLOBALS['memCache']['graphics_clamav_regex.map'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (graphics_clamav_regex.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_missing'].' (graphics_clamav_regex.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    $c=@count($GLOBALS['memCache']['graphics_clamav_regex.map']);
                    if($c<1)
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (graphics_clamav_regex.map)! ';
                            return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_map_corrupted'].' (graphics_clamav_regex.map)!'.$GLOBALS['linebreak'];
                            }
                        break;
                        }
                    for($i=0;$i<$c;$i++)
                        {
                        $map=explode(':',$GLOBALS['memCache']['graphics_clamav_regex.map'][$i]);
                        $map[2]=(int)$map[2];
                        if(substr_count($str_hex,$map[0])>0)
                            {
                            for($xind=$map[1];$xind<($map[2]+1);$xind++)
                                {
                                $xsig=$GLOBALS['memCache']['graphics_clamav_regex.cvd'][$xind];
                                if(substr_count($xsig,':')>0)
                                    {
                                    $vn=@explode(':',$xsig);
                                    $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                    $xsig=($xsig===false?'':implode('',$xsig));
                                    $xlen=strlen($xsig);
                                    if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                    $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                    $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                    $vn=vn_shorthand($vn[0]);
                                    if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                        {
                                        if($xstrf=='*')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_norm))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,0,$xstrt*2)))continue;
                                            }
                                        else if($xstrf=='A')
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_norm))continue;
                                                }
                                            else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_norm,0,$xstrt*2)))continue;
                                            }
                                        else
                                            {
                                            if($xstrt=='*')
                                                {
                                                if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2)))continue;
                                                }
                                            else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2,$xstrt*2)))continue;
                                            }
                                        if(!$flagged)
                                            {
                                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                            $flagged=true;
                                            }
                                        $heur['detections']++;
                                        $GLOBALS['memCache']['detections_count']++;
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    break;
                    }
                }
            for($SigSet=0;$SigSet<2;$SigSet++)
                {
                $SigDo=$SigRegexFile=$SigStandardFile=false;
                if($SigSet===0)
                    {
                    if($GLOBALS['MusselConfig']['signatures']['graphics_custom'])
                        {
                        $SigStandardFile='graphics_custom_standard.cvd';
                        $SigRegexFile='graphics_custom_regex.cvd';
                        $SigDo=true;
                        }
                    }
                else if($SigSet===1)
                    {
                    if($GLOBALS['MusselConfig']['signatures']['graphics_mussel'])
                        {
                        $SigStandardFile='graphics_mussel_standard.cvd';
                        $SigRegexFile='graphics_mussel_regex.cvd';
                        $SigDo=true;
                        }
                    }
                if($SigDo)
                    {
                    while(true)
                        {
                        if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                        if(!$GLOBALS['memCache'][$SigStandardFile])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                }
                            break;
                            }
                        $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                        for($i=0;$i<$c;$i++)
                            {
                            $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                            if(substr($xsig,0,1)=='>')
                                {
                                $xsig=explode('>',$xsig,4);
                                $xsig[3]=(int)$xsig[3];
                                if($xsig[1]=='FN')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MIN')
                                    {
                                    if($str_len<$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MAX')
                                    {
                                    if($str_len>$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD')
                                    {
                                    if(!substr_count($str_hex,$xsig[2]))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD-RX')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if(substr($xsig[1],0,1)=='$')
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
                                else if(substr($xsig[1],0,2)=='!$')
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
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if($str_hex_len<$xlen)continue;
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                    $xsigc=count($xsig);
                                    $this_str=$str_hex;
                                    $this_norm=$str_norm;
                                    if($xstrf=='A')
                                        {
                                        $this_str="\x01".$this_str;
                                        $this_norm="\x01".$this_norm;
                                        $xsig[0]="\x01".$xsig[0];
                                        }
                                    else if($xstrf!='*')
                                        {
                                        $this_str=substr($this_str,$xstrf*2);
                                        $this_norm=substr($this_norm,$xstrf*2);
                                        }
                                    if($xstrt!='*')
                                        {
                                        $this_str=substr($this_str,0,$xstrt*2);
                                        $this_norm=substr($this_norm,0,$xstrt*2);
                                        }
                                    for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                        {
                                        if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_norm,$xsig[$xsigi]))continue 2;
                                        if($xsigc>1)
                                            {
                                            if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                            if(substr_count($this_norm,$xsig[$xsigi]))$this_norm=substraf($this_norm,$xsig[$xsigi].'>');
                                            }
                                        }
                                    $this_norm=$this_str=false;
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        break;
                        }
                    while(true)
                        {
                        if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                        if(!$GLOBALS['memCache'][$SigRegexFile])
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                }
                            break;
                            }
                        $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                        for($i=0;$i<$c;$i++)
                            {
                            $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                            if(substr($xsig,0,1)=='>')
                                {
                                $xsig=explode('>',$xsig,4);
                                $xsig[3]=(int)$xsig[3];
                                if($xsig[1]=='FN')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MIN')
                                    {
                                    if($str_len<$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FS-MAX')
                                    {
                                    if($str_len>$xsig[2])
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD')
                                    {
                                    if(!substr_count($str_hex,$xsig[2]))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if($xsig[1]=='FD-RX')
                                    {
                                    if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                        {
                                        if($xsig[3]<=$i)break;
                                        $i=$xsig[3]-1;
                                        }
                                    }
                                else if(substr($xsig[1],0,1)=='$')
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
                                else if(substr($xsig[1],0,2)=='!$')
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
                            if(substr_count($xsig,':')>0)
                                {
                                $vn=@explode(':',$xsig);
                                $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                                $xsig=($xsig===false?'':implode('',$xsig));
                                $xlen=strlen($xsig);
                                if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                                $xstrf=(isset($vn[2]))?$vn[2]:'*';
                                $xstrt=(isset($vn[3]))?$vn[3]:'*';
                                $vn=vn_shorthand($vn[0]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($xstrf=='*')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',$str_hex)&&!preg_match('/'.$xsig.'/i',$str_norm))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,0,$xstrt*2)))continue;
                                        }
                                    else if($xstrf=='A')
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/\A'.$xsig.'/i',$str_hex)&&!preg_match('/\A'.$xsig.'/i',$str_norm))continue;
                                            }
                                        else if(!preg_match('/\A'.$xsig.'/i',substr($str_hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($str_norm,0,$xstrt*2)))continue;
                                        }
                                    else
                                        {
                                        if($xstrt=='*')
                                            {
                                            if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2)))continue;
                                            }
                                        else if(!preg_match('/'.$xsig.'/i',substr($str_hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($str_norm,$xstrf*2,$xstrt*2)))continue;
                                        }
                                    if(!$flagged)
                                        {
                                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                        $flagged=true;
                                        }
                                    $heur['detections']++;
                                    $GLOBALS['memCache']['detections_count']++;
                                    if($GLOBALS['memCache']['weighted'])
                                        {
                                        $heur['weight']++;
                                        $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    else
                                        {
                                        $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        break;
                        }
                    }
                }
            }
        }
    if($str_xmlxdp)for($SigSet=0;$SigSet<3;$SigSet++)
        {
        if(isset($whitelist['XMLXDP']))break;
        $SigDo=$SigRegexFile=$SigStandardFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['xmlxdp_clamav'])
                {
                $SigStandardFile='xmlxdp_clamav_standard.cvd';
                $SigRegexFile='xmlxdp_clamav_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['xmlxdp_custom'])
                {
                $SigStandardFile='xmlxdp_custom_standard.cvd';
                $SigRegexFile='xmlxdp_custom_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            if($GLOBALS['MusselConfig']['signatures']['xmlxdp_mussel'])
                {
                $SigStandardFile='xmlxdp_mussel_standard.cvd';
                $SigRegexFile='xmlxdp_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigStandardFile]))$GLOBALS['memCache'][$SigStandardFile]=@file($GLOBALS['vault'].$SigStandardFile);
                if(!$GLOBALS['memCache'][$SigStandardFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigStandardFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigStandardFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigStandardFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        if($str_xmlxdp_len<$xlen)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                            $xsigc=count($xsig);
                            $this_xmlxdp=$str_xmlxdp;
                            if($xstrf=='A')
                                {
                                $this_xmlxdp="\x01".$this_xmlxdp;
                                $xsig[0]="\x01".$xsig[0];
                                }
                            else if($xstrf!='*')$this_xmlxdp=substr($this_xmlxdp,$xstrf*2);
                            if($xstrt!='*')$this_xmlxdp=substr($this_xmlxdp,0,$xstrt*2);
                            for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                {
                                if(!substr_count($this_xmlxdp,$xsig[$xsigi])&&!substr_count($this_xmlxdp,$xsig[$xsigi]))continue 2;
                                if($xsigc>1)if(substr_count($this_xmlxdp,$xsig[$xsigi]))$this_xmlxdp=substraf($this_xmlxdp,$xsig[$xsigi].'>');
                                }
                            $this_xmlxdp=false;
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigRegexFile]))$GLOBALS['memCache'][$SigRegexFile]=@file($GLOBALS['vault'].$SigRegexFile);
                if(!$GLOBALS['memCache'][$SigRegexFile])
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                        {
                        if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigRegexFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        }
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigRegexFile]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigRegexFile][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='FN')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$ofn))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MIN')
                            {
                            if($str_len<$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FS-MAX')
                            {
                            if($str_len>$xsig[2])
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD')
                            {
                            if(!substr_count($str_hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='FD-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$str_hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                        else if(substr($xsig[1],0,2)=='!$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($xstrf=='*')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',$str_xmlxdp))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                }
                            else if($xstrf=='A')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/\A'.$xsig.'/i',$str_xmlxdp))continue;
                                    }
                                else if(!preg_match('/\A'.$xsig.'/i',substr($str_xmlxdp,0,$xstrt*2)))continue;
                                }
                            else
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2)))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($str_xmlxdp,$xstrf*2,$xstrt*2)))continue;
                                }
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                break;
                }
            }
        }
    if($GLOBALS['MusselConfig']['attack_specific']['block_control_characters'])
        {
        if(preg_match('/[\x00-\x08\x0b\x0c\x0e\x1f\x7f]/i',$str))
            {
            $out.=$lnap.$GLOBALS['MusselConfig']['lang']['detected_control_characters'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
            $heur['detections']++;
            $GLOBALS['memCache']['detections_count']++;
            if(!$flagged)
                {
                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                $flagged=true;
                }
            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['detected_control_characters'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
            }
        }
    // AAA urlscanner BEGIN
    if($GLOBALS['MusselConfig']['urlscanner']['urlscanner']&&$str_norm_len)
        {
        $urlscanner=array();
        $urlscanner['req_c']=$urlscanner['domains_c']=$urlscanner['urls_c']=0;
        if(!isset($GLOBALS['memCache']['urlscanner.cvd']))$GLOBALS['memCache']['urlscanner.cvd']=phpMusselFile($GLOBALS['vault'].'urlscanner.cvd');
        if(!$GLOBALS['memCache']['urlscanner.cvd'])
            {
            $GLOBALS['memCache']['scan_errors']++;
            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                {
                if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (urlscanner.cvd)! ';
                return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (urlscanner.cvd)!'.$GLOBALS['linebreak'];
                }
            }
        else
            {
            $urlscanner['domains_p']=array();
            $urlscanner['domains']=array();
            $urlscanner['tlds']=array();
            $urlscanner['z']=0;
            $urlscanner['c']=preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([0-9a-z.-]{1,512})[^0-9a-z.-]/i',$str_norm_bin,$urlscanner['m']);
            for($urlscanner['i']=0;$urlscanner['c']>$urlscanner['i'];$urlscanner['i']++)
                {
                $urlscanner['domains_p'][$urlscanner['z']]=$urlscanner['m'][3][$urlscanner['i']];
                if(substr_count($urlscanner['domains_p'][$urlscanner['z']],'.'))$urlscanner['tlds'][$urlscanner['z']]=substral($urlscanner['domains_p'][$urlscanner['z']],'.');
                $urlscanner['domains'][$urlscanner['z']]='DOMAIN:'.md5($urlscanner['m'][3][$urlscanner['i']]).':'.strlen($urlscanner['m'][3][$urlscanner['i']]).':';
                $urlscanner['z']++;
                }
            $urlscanner['m']='';
            $urlscanner['domains_p']=array_unique($urlscanner['domains_p']);
            $urlscanner['domains']=array_unique($urlscanner['domains']);
            $urlscanner['tlds']=array_unique($urlscanner['tlds']);
            sort($urlscanner['domains_p']);
            sort($urlscanner['domains']);
            sort($urlscanner['tlds']);
            $urlscanner['tldc']=count($urlscanner['tlds']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['tldc'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],'TLD:'.$urlscanner['tlds'][$urlscanner['i']].':'))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],'TLD:'.$urlscanner['tlds'][$urlscanner['i']].':');
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $heur['detections']++;
                        $GLOBALS['memCache']['detections_count']++;
                        if($GLOBALS['memCache']['weighted'])
                            {
                            $heur['weight']++;
                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        else
                            {
                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        break;
                        }
                    }
                }
            $urlscanner['domains_c']=count($urlscanner['domains']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['domains_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['domains'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['domains'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $heur['detections']++;
                        $GLOBALS['memCache']['detections_count']++;
                        if($GLOBALS['memCache']['weighted'])
                            {
                            $heur['weight']++;
                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        else
                            {
                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        break;
                        }
                    }
                }
            $xsig='';
            $urlscanner['urls_p']=array();
            $urlscanner['urls']=array();
            $urlscanner['queries']=array();
            $urlscanner['z']=0;
            $urlscanner['c']=preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4000})(\&quot;|[;"\'\(\)\[\]\{\}])/i',$str_norm_bin,$urlscanner['m']);
            for($urlscanner['i']=0;$urlscanner['c']>$urlscanner['i'];$urlscanner['i']++)
                {
                $urlscanner['urls_p'][$urlscanner['z']]=$urlscanner['m'][3][$urlscanner['i']];
                $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['m'][3][$urlscanner['i']]).':'.strlen($urlscanner['m'][3][$urlscanner['i']]).':';
                $urlscanner['z']++;
                if(preg_match('/[^0-9a-z.-]$/i',$urlscanner['m'][3][$urlscanner['i']]))
                    {
                    $urlscanner['x']=preg_replace('/[^0-9a-z.-]+$/i','',$urlscanner['m'][3][$urlscanner['i']]);
                    $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['z']++;
                    }
                if(substr_count($urlscanner['m'][3][$urlscanner['i']],'?'))
                    {
                    $urlscanner['x']=substrbf($urlscanner['m'][3][$urlscanner['i']],'?');
                    $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['x']=substraf($urlscanner['m'][3][$urlscanner['i']],'?');
                    $urlscanner['queries'][$urlscanner['z']]='QUERY:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['z']++;
                    }
                }
            $urlscanner['m']='';
            $urlscanner['urls_p']=array_unique($urlscanner['urls_p']);
            $urlscanner['urls']=array_unique($urlscanner['urls']);
            $urlscanner['queries']=array_unique($urlscanner['queries']);
            sort($urlscanner['urls_p']);
            sort($urlscanner['urls']);
            sort($urlscanner['queries']);
            $urlscanner['urls_c']=count($urlscanner['urls']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['urls_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['urls'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['urls'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $heur['detections']++;
                        $GLOBALS['memCache']['detections_count']++;
                        if($GLOBALS['memCache']['weighted'])
                            {
                            $heur['weight']++;
                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        else
                            {
                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        break;
                        }
                    }
                }
            $urlscanner['queries_c']=count($urlscanner['queries']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['queries_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['queries'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['queries'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $heur['detections']++;
                        $GLOBALS['memCache']['detections_count']++;
                        if($GLOBALS['memCache']['weighted'])
                            {
                            $heur['weight']++;
                            $heur['cli'].=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $heur['web'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        else
                            {
                            $out.=$lnap.phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        break;
                        }
                    }
                }
            }
        if(!$out&&$GLOBALS['MusselConfig']['urlscanner']['lookup_hphosts']&&$urlscanner['domains_c'])
            {
            if(!isset($GLOBALS['memCache']['urlscanner_domains']))$GLOBALS['memCache']['urlscanner_domains']=phpMusselCacheGet('urlscanner_domains');
            $urlscanner['y']=$GLOBALS['time']+$GLOBALS['MusselConfig']['urlscanner']['cache_time'];
            $urlscanner['req_v']=urlencode($GLOBALS['phpmusselversion']);
            $urlscanner['classes']=array('EMD'=>"\x1a\x82\x10\x1bXXX",'EXP'=>"\x1a\x82\x10\x16XXX",'GRM'=>"\x1a\x82\x10\x32XXX",'HFS'=>"\x1a\x82\x10\x32XXX",'PHA'=>"\x1a\x82\x10\x32XXX",'PSH'=>"\x1a\x82\x10\x31XXX");
            for($i=0;$i<$urlscanner['domains_c'];$i++)
                {
                if($GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups']>0&&$urlscanner['req_c']>$GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups'])
                    {
                    if($GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups_response'])
                        {
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $out.=$lnap.$GLOBALS['MusselConfig']['lang']['too_many_urls'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['too_many_urls'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        }
                    break;
                    }
                if(substr_count($GLOBALS['memCache']['urlscanner_domains'],$urlscanner['domains'][$i]))
                    {
                    $urlscanner['class']=substrbf(substral($GLOBALS['memCache']['urlscanner_domains'],$urlscanner['domains'][$i]),';');
                    $urlscanner['expiry']=substrbf($urlscanner['class'],':');
                    if($urlscanner['expiry']>$GLOBALS['time'])
                        {
                        $urlscanner['class']=substraf($urlscanner['class'],':');
                        if(!$urlscanner['class'])continue;
                        $urlscanner['class']=vn_shorthand($urlscanner['class']);
                        if(!$flagged)
                            {
                            $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                            $flagged=true;
                            }
                        $out.=$lnap.phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                $urlscanner['req']='v='.$urlscanner['req_v'].'&s='.$urlscanner['domains_p'][$i].'&class=true';
                $urlscanner['req_context']=array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$GLOBALS['phpmusselua'],'content'=>$urlscanner['req'],'timeout'=>12));
                $urlscanner['req_stream']=stream_context_create($urlscanner['req_context']);
                $urlscanner['req_result']=@file_get_contents('http://verify.hosts-file.net/?'.$urlscanner['req'],false,$urlscanner['req_stream']);
                $urlscanner['req_c']++;
                if(substr($urlscanner['req_result'],0,6)=="Listed")
                    {
                    $urlscanner['class']=substr($urlscanner['req_result'],7,3);
                    $urlscanner['class']=(isset($urlscanner['classes'][$urlscanner['class']]))?$urlscanner['classes'][$urlscanner['class']]:"\x1a\x82\x10\x3fXXX";
                    $GLOBALS['memCache']['urlscanner_domains'].=$urlscanner['domains'][$i].$urlscanner['y'].':'.$urlscanner['class'].';';
                    $urlscanner['class']=vn_shorthand($urlscanner['class']);
                    if(!$flagged)
                        {
                        $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                        $flagged=true;
                        }
                    $out.=$lnap.phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    break;
                    }
                $GLOBALS['memCache']['urlscanner_domains'].=$urlscanner['domains'][$i].$urlscanner['y'].':;';
                }
            $urlscanner['y']=phpMusselCacheSet('urlscanner_domains',$urlscanner['y'],$GLOBALS['memCache']['urlscanner_domains']);
            }
        // $urlscanner['urls_c']=count($urlscanner['urls_p']);
        if(!$out&&$GLOBALS['MusselConfig']['urlscanner']['google_api_key']&&$urlscanner['urls_c'])
            {
            /* Incomplete code, doesn't work yet.
            $urlscanner['req']=$urlscanner['urls_c'].$GLOBALS['linebreak'].'http://'.implode($GLOBALS['linebreak'].'http://',$urlscanner['urls_p']);
            $urlscanner['req_context']=array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$GLOBALS['phpmusselua'],'content'=>$urlscanner['req'],'timeout'=>12));
            $urlscanner['req_stream']=stream_context_create($urlscanner['req_context']);
            $urlscanner['req_result']=file_get_contents('https://sb-ssl.google.com/safebrowsing/api/lookup?client=phpMussel&key='.$GLOBALS['MusselConfig']['urlscanner']['google_api_key'].'&appver='.$GLOBALS['phpmusselversion_int'].'&pver=3.1',false,$urlscanner['req_stream']);
            $urlscanner['req_c']++;
            if(!$flagged)
                {
                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                $flagged=true;
                }
            $out.=$lnap.phpMusselV(array('vn'=>$urlscanner['req_result']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
            $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$urlscanner['req_result']),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
            */
            }
        unset($urlscanner);
        }
    // AAA urlscanner END
    for($coexi=0,$sxi=0,$sxc=0,$SigSet=0;$SigSet<3;$SigSet++)
        {
        $SigDo=$SigFile=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['coex_clamav'])
                {
                $SigFile='coex_clamav.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['coex_custom'])
                {
                $SigFile='coex_custom.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===2)
            {
            if($GLOBALS['MusselConfig']['signatures']['coex_mussel'])
                {
                $SigFile='coex_mussel.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            if(!isset($GLOBALS['memCache'][$SigFile]))$GLOBALS['memCache'][$SigFile]=phpMusselFile($GLOBALS['vault'].$SigFile);
            if(!$GLOBALS['memCache'][$SigFile])
                {
                $GLOBALS['memCache']['scan_errors']++;
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                    {
                    if(!$flagged)$GLOBALS['killdata'].=$md5.':'.$str_len.':'.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    return (!$n)?-3:$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' ('.$SigFile.')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                    }
                }
            else
                {
                $coexi=0;
                $signame='';
                while(true)
                    {
                    $coexi++;
                    $xsig=array();
                    if($coexi===1)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$md5:'.$md5.';'))$xsig=explode($GLOBALS['linebreak'].'$md5:'.$md5.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===2)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$str_len:'.$str_len.';'))$xsig=explode($GLOBALS['linebreak'].'$str_len:'.$str_len.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===3)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$fourcc:'.$fourcc.';'))$xsig=explode($GLOBALS['linebreak'].'$fourcc:'.$fourcc.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===4)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$twocc:'.$twocc.';'))$xsig=explode($GLOBALS['linebreak'].'$twocc:'.$twocc.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===5)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$phase:'.$phase.';'))$xsig=explode($GLOBALS['linebreak'].'$phase:'.$phase.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===6)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$xt:'.$xt.';'))$xsig=explode($GLOBALS['linebreak'].'$xt:'.$xt.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===7)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$sha:'.$sha.';'))$xsig=explode($GLOBALS['linebreak'].'$sha:'.$sha.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===8)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$crc:'.$crc.';'))$xsig=explode($GLOBALS['linebreak'].'$crc:'.$crc.';',$GLOBALS['memCache'][$SigFile]);
                    if($is_html&&$coexi===9)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_html:1;'))$xsig=explode($GLOBALS['linebreak'].'$is_html:1;',$GLOBALS['memCache'][$SigFile]);
                    if(!$is_html&&$coexi===9)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_html:0;'))$xsig=explode($GLOBALS['linebreak'].'$is_html:0;',$GLOBALS['memCache'][$SigFile]);
                    if($is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_graphics:1;'))$xsig=explode($GLOBALS['linebreak'].'$is_graphics:1;',$GLOBALS['memCache'][$SigFile]);
                    if(!$is_graphics&&$coexi===10)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_graphics:0;'))$xsig=explode($GLOBALS['linebreak'].'$is_graphics:0;',$GLOBALS['memCache'][$SigFile]);
                    if($is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_pe:1;'))$xsig=explode($GLOBALS['linebreak'].'$is_pe:1;',$GLOBALS['memCache'][$SigFile]);
                    if(!$is_pe&&$coexi===11)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_pe:0;'))$xsig=explode($GLOBALS['linebreak'].'$is_pe:0;',$GLOBALS['memCache'][$SigFile]);
                    if($is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_macho:1;'))$xsig=explode($GLOBALS['linebreak'].'$is_macho:1;',$GLOBALS['memCache'][$SigFile]);
                    if(!$is_macho&&$coexi===12)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$is_macho:0;'))$xsig=explode($GLOBALS['linebreak'].'$is_macho:0;',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===13)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$xts:'.$xts.';'))$xsig=explode($GLOBALS['linebreak'].'$xts:'.$xts.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===14)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$NumOfSections:'.$NumOfSections.';'))$xsig=explode($GLOBALS['linebreak'].'$NumOfSections:'.$NumOfSections.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi===15)if(substr_count($GLOBALS['memCache'][$SigFile],$GLOBALS['linebreak'].'$container:'.$container.';'))$xsig=explode($GLOBALS['linebreak'].'$container:'.$container.';',$GLOBALS['memCache'][$SigFile]);
                    if($coexi>15)break;
                    $xc=count($xsig);
                    if(isset($xsig[0]))$xsig[0]='';
                    if($xc>0)for($xi=1;$xi<$xc;$xi++)
                        {
                        if(!substr_count($xsig[$xi],':'))continue;
                        if(substr_count($xsig[$xi],$GLOBALS['linebreak']))$xsig[$xi]=substrbf($xsig[$xi],$GLOBALS['linebreak']);
                        if(substr_count($xsig[$xi],';'))
                            {
                            $signame=vn_shorthand(substral($xsig[$xi],';'));
                            $xsig[$xi]=explode(';',substrbl($xsig[$xi],';'));
                            $sxc=count($xsig[$xi]);
                            }
                        else
                            {
                            $signame=vn_shorthand($xsig[$xi]);
                            $xsig[$xi]='';
                            $sxc=0;
                            }
                        if($sxc>0)for($sxi=0;$sxi<$sxc;$sxi++)
                            {
                            $xsig[$xi][$sxi]=explode(':',$xsig[$xi][$sxi],7);
                            if($xsig[$xi][$sxi][0]==='LV')
                                {
                                if(!isset($xsig[$xi][$sxi][1]))continue 2;
                                if(substr($xsig[$xi][$sxi][1],0,1)!=='$')continue 2;
                                $lv_haystack=substr($xsig[$xi][$sxi][1],1);
                                if(!isset($$lv_haystack))continue 2;
                                if(is_array($$lv_haystack))continue 2;
                                $lv_haystack=$$lv_haystack;
                                if($climode)$lv_haystack=substral(substral($lv_haystack,"/"),"\\");
                                $lv_needle=(isset($xsig[$xi][$sxi][2]))?$xsig[$xi][$sxi][2]:'';
                                $pos_A=(isset($xsig[$xi][$sxi][3]))?$xsig[$xi][$sxi][3]:0;
                                $pos_Z=(isset($xsig[$xi][$sxi][4]))?$xsig[$xi][$sxi][4]:0;
                                $lv_min=(isset($xsig[$xi][$sxi][5]))?$xsig[$xi][$sxi][5]:0;
                                $lv_max=(isset($xsig[$xi][$sxi][6]))?$xsig[$xi][$sxi][6]:-1;
                                if(!lv_match($lv_needle,$lv_haystack,$pos_A,$pos_Z,$lv_min,$lv_max))continue 2;
                                }
                            else if(isset($xsig[$xi][$sxi][2]))
                                {
                                if(isset($xsig[$xi][$sxi][3]))
                                    {
                                    if($xsig[$xi][$sxi][2]=='A')
                                        {
                                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,',','.$xsig[$xi][$sxi][0].','))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD')if(!substr_count("\x01".substr($str_hex,0,$xsig[$xi][$sxi][3]*2),"\x01".$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-RX')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',substr($str_hex,0,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM')if(!substr_count("\x01".substr($str_norm,0,$xsig[$xi][$sxi][3]*2),"\x01".$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM-RX')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',substr($str_norm,0,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='META')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',substr($CoExMeta,0,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        }
                                    else
                                        {
                                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,',','.$xsig[$xi][$sxi][0].','))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD')if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2]*2,$xsig[$xi][$sxi][3]*2),$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($str_hex,$xsig[$xi][$sxi][2]*2,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM')if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2]*2,$xsig[$xi][$sxi][3]*2),$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($str_norm,$xsig[$xi][$sxi][2]*2,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='META')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($CoExMeta,$xsig[$xi][$sxi][2]*2,$xsig[$xi][$sxi][3]*2)))continue 2;
                                        }
                                    }
                                else
                                    {
                                    if($xsig[$xi][$sxi][2]=='A')
                                        {
                                        if(!substr_count(',FN,FD,FD-RX,FD-NORM,FD-NORM-RX,META,',','.$xsig[$xi][$sxi][0].','))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FN')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',$ofn))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD')if(!substr_count("\x01".$str_hex,"\x01".$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-RX')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',$str_hex))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM')if(!substr_count("\x01".$str_norm,"\x01".$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM-RX')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',$str_norm))continue 2;
                                        if($xsig[$xi][$sxi][0]=='META')if(!preg_match('/\A'.$xsig[$xi][$sxi][1].'/i',$CoExMeta))continue 2;
                                        }
                                    else
                                        {
                                        if(!substr_count(',FD,FD-RX,FD-NORM,FD-NORM-RX,META,',','.$xsig[$xi][$sxi][0].','))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD')if(!substr_count(substr($str_hex,$xsig[$xi][$sxi][2]*2),$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($str_hex,$xsig[$xi][$sxi][2]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM')if(!substr_count(substr($str_norm,$xsig[$xi][$sxi][2]*2),$xsig[$xi][$sxi][1]))continue 2;
                                        if($xsig[$xi][$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($str_norm,$xsig[$xi][$sxi][2]*2)))continue 2;
                                        if($xsig[$xi][$sxi][0]=='META')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',substr($CoExMeta,$xsig[$xi][$sxi][2]*2)))continue 2;
                                        }
                                    }
                                }
                            else
                                {
                                if($xsig[$xi][$sxi][0]=='FN')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',$ofn))continue 2;
                                if($xsig[$xi][$sxi][0]=='FS-MIN')if($str_len<$xsig[$xi][$sxi][1])continue 2;
                                if($xsig[$xi][$sxi][0]=='FS-MAX')if($str_len>$xsig[$xi][$sxi][1])continue 2;
                                if($xsig[$xi][$sxi][0]=='FD')if(!substr_count($str_hex,$xsig[$xi][$sxi][1]))continue 2;
                                if($xsig[$xi][$sxi][0]=='FD-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',$str_hex))continue 2;
                                if($xsig[$xi][$sxi][0]=='FD-NORM')if(!substr_count($str_norm,$xsig[$xi][$sxi][1]))continue 2;
                                if($xsig[$xi][$sxi][0]=='FD-NORM-RX')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',$str_norm))continue 2;
                                if($xsig[$xi][$sxi][0]=='META')if(!preg_match('/'.$xsig[$xi][$sxi][1].'/i',$CoExMeta))continue 2;
                                if(substr($xsig[$xi][$sxi][0],0,1)=='$')
                                    {
                                    $vf=substr($xsig[$xi][$sxi][0],1);
                                    if(!isset($$vf))continue 2;
                                    if(is_array($$vf))continue 2;
                                    if($$vf!=$xsig[$xi][$sxi][1])continue 2;
                                    }
                                else if(substr($xsig[$xi][$sxi][0],0,2)=='!$')
                                    {
                                    $vf=substr($xsig[$xi][$sxi][0],2);
                                    if(!isset($$vf))continue 2;
                                    if(is_array($$vf))continue 2;
                                    if($$vf==$xsig[$xi][$sxi][1])continue 2;
                                    }
                                else if(!substr_count(',FN,FS-MIN,FS-MAX,FD,FD-RX,FD-NORM,FD-NORM-RX,META,',','.$xsig[$xi][$sxi][0].','))continue 2;
                                }
                            }
                        if($signame&&!substr_count($GLOBALS['memCache']['greylist'],','.$signame.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if(!$flagged)
                                {
                                $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                $flagged=true;
                                }
                            $heur['detections']++;
                            $GLOBALS['memCache']['detections_count']++;
                            if($GLOBALS['memCache']['weighted'])
                                {
                                $heur['weight']++;
                                $heur['cli'].=$lnap.phpMusselV(array('vn'=>$signame),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $heur['web'].=phpMusselV(array('vn'=>$signame),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            else
                                {
                                $out.=$lnap.phpMusselV(array('vn'=>$signame),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$signame),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        $xsig[$xi]='';
                        }
                    }
                $sxi=$sxc=$signame=$xi=$xc=$xsig=$coexi='';
                }
            }
        }
    unset($sxi,$sxc,$coexi,$SigFile,$SigDo,$SigStandardFile,$SigRegexFile);
    if($heur['weight']>=$GLOBALS['MusselConfig']['heuristic']['threshold']||$out)
        {
        $out.=$heur['cli'];
        $GLOBALS['whyflagged'].=$heur['web'];
        }
    if(!$out)if(!empty($GLOBALS['MusselConfig']['virustotal']['vt_public_api_key']))
        {
        $doscan=false;
        $GLOBALS['MusselConfig']['virustotal']['vt_suspicion_level']=(int)$GLOBALS['MusselConfig']['virustotal']['vt_suspicion_level'];
        if($GLOBALS['MusselConfig']['virustotal']['vt_suspicion_level']===0)
            {
            if($heur['weight']>0)$doscan=true;
            }
        else if($GLOBALS['MusselConfig']['virustotal']['vt_suspicion_level']===1)
            {
            if($heur['weight']>0||$fileswitch=='chrome'||$fileswitch=='java'||$fileswitch=='docfile'||$fileswitch=='vt_interest'||$is_pe)$doscan=true;
            }
        else if($GLOBALS['MusselConfig']['virustotal']['vt_suspicion_level']===2)$doscan=true;
        if($doscan)
            {
            $vt_weight=array('weight'=>0,'cli'=>'','web'=>'');
            if(!isset($GLOBALS['memCache']['vt_quota']))$GLOBALS['memCache']['vt_quota']=phpMusselCacheGet('vt_quota');
            $x=0;
            if(!empty($GLOBALS['memCache']['vt_quota']))
                {
                $GLOBALS['memCache']['vt_quota']=explode(';',$GLOBALS['memCache']['vt_quota']);
                $c=count($GLOBALS['memCache']['vt_quota']);
                for($i=0;$i<$c;$i++)
                    {
                    if($GLOBALS['memCache']['vt_quota'][$i]>$GLOBALS['time'])$x++;
                    else $GLOBALS['memCache']['vt_quota'][$i]='';
                    }
                $GLOBALS['memCache']['vt_quota']=implode(';',$GLOBALS['memCache']['vt_quota']);
                }
            if($x<$GLOBALS['MusselConfig']['virustotal']['vt_quota_rate'])
                {
                $vts='apikey='.urlencode($GLOBALS['MusselConfig']['virustotal']['vt_public_api_key']).'&resource='.$md5;
                $vta=array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$GLOBALS['phpmusselua'],'content'=>$vts,'timeout'=>12));
                $vtx=stream_context_create($vta);
                $vt=@json_decode(file_get_contents('http://www.virustotal.com/vtapi/v2/file/report?apikey='.urlencode($GLOBALS['MusselConfig']['virustotal']['vt_public_api_key']).'&resource='.$md5,false,$vtx),true);
                $y=$GLOBALS['time']+($GLOBALS['MusselConfig']['virustotal']['vt_quota_time']*60);
                $GLOBALS['memCache']['vt_quota'].=$y.';';
                $GLOBALS['memCache']['vt_quota']=str_ireplace(';;',';',$GLOBALS['memCache']['vt_quota']);
                $y=phpMusselCacheSet('vt_quota',$y+60,$GLOBALS['memCache']['vt_quota']);
                $vt['response_code']=(int)$vt['response_code'];
                if(isset($vt['response_code'])&&isset($vt['scans']))if($vt['response_code']===1&&is_array($vt['scans']))
                    {
                    $c=count($vt['scans']);
                    for($i=0;$i<$c;$i++)
                        {
                        $k=key($vt['scans']);
                        if($vt['scans'][$k]['detected']&&$vt['scans'][$k]['result'])
                            {
                            $vn=$k.'(VirusTotal)-'.$vt['scans'][$k]['result'];
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if(!$flagged)
                                    {
                                    $GLOBALS['killdata'].=$md5.':'.$str_len.':'.$ofn.$GLOBALS['linebreak'];
                                    $flagged=true;
                                    }
                                $heur['detections']++;
                                $GLOBALS['memCache']['detections_count']++;
                                if($GLOBALS['MusselConfig']['virustotal']['vt_weighting']>0)
                                    {
                                    $vt_weight['weight']++;
                                    $vt_weight['web'].=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $vt_weight['cli'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                else
                                    {
                                    $out.=$lnap.phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                    $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                    }
                                }
                            }
                        next($vt['scans']);
                        }
                    }
                if($vt_weight['weight']>0&&$vt_weight['weight']>=$GLOBALS['MusselConfig']['virustotal']['vt_weighting'])
                    {
                    $out.=$vt_weight['web'];
                    $GLOBALS['whyflagged'].=$vt_weight['cli'];
                    }
                }
            }
        }
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['after_vt']))if($GLOBALS['MusselPlugins']['hookcounts']['after_vt']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['after_vt']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['after_vt'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['after_vt']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['after_vt'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['after_vt'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['after_vt'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['after_vt'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['after_vt'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['after_vt']);
            }
        }
    if(isset($HashCacheData))if(!isset($GLOBALS['HashCache'][$HashCacheData]))if($GLOBALS['MusselConfig']['general']['scan_cache_expiry']>0)
        {
        $GLOBALS['HashCache'][$HashCacheData]=array();
        $GLOBALS['HashCache'][$HashCacheData][0]=$HashCacheData;
        $GLOBALS['HashCache'][$HashCacheData][1]=$GLOBALS['time']+$GLOBALS['MusselConfig']['general']['scan_cache_expiry'];
        $GLOBALS['HashCache'][$HashCacheData][2]=(empty($out))?'':bin2hex($out);
        $GLOBALS['HashCache'][$HashCacheData][3]=(empty($GLOBALS['whyflagged']))?'':bin2hex($GLOBALS['whyflagged']);
        }
    if(!$out)return 1;
    if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
        {
        if($str_len<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
            {
            $qfu=$GLOBALS['time'].'-'.md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$crc.$GLOBALS['time']);
            @phpMusselQ($str,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
            $GLOBALS['killdata'].='Quarantined as "/vault/quarantine/'.$qfu.'.qfu".'.$GLOBALS['linebreak'];
            }
        }
    return (!$n)?2:$out;
    }

/**
 * This function (`phpMusselR()`, or, the phpMussel recursor) is one of two sub-functions of the core scanning function
 * of phpMussel (`phpMussel()`).
 *
 * `phpMusselR()` handles metadata-based and non-signature-based detections, and performs the preparations necessary
 * for scanning files (such as reading the contents of files prior to checking the contents of files against anti-virus
 * signatures). Additionally, it performs all necessary whitelist, blacklist and greylist checks, filesize and file
 * extension-based checks, and handles the processing and extraction of files from archives, fetching the files
 * contained in archives being scanned in order to process those contained files as so that they, too, may be scanned.
 *
 * When phpMussel is instructed to scan a directory or an array of multiple files, the phpMussel recursor is the
 * function responsible for iterating through that directory and/or array in order to scan each object required to be
 * scanned, and if necessary, recurse itself (such as for when scanning a directory containing sub-directories or when
 * scanning a multidimensional array of multiple files and/or directories).
 *
 * @param string|array $f In the context of the initial file upload scanning that phpMussel performs when operating via a server, this parameter (a string) represents the "temporary filename" of the file being scanned (the temporary filename, in this context, referring to the name temporarily assigned to the file by the server upon the file being uploaded to the temporary uploads location assigned to the server). When operating in the context of CLI mode, both $f and $ofn represent the scan target, as per specified by the CLI operator; The only difference between the two is when the scan target is a directory, rather than a single file; $f will represent the full path to the file (so, directory plus filename), whereas $ofn will represent only the filename. This parameter can also accept an array of filenames.
 * @param bool $n Usually inherited from the calling function (`phpMussel()`), this optional parameter is a boolean (defaults to false, but set to true during the initial scan of file uploads), indicating the format that the scan results should be returned as. False instructs the function to return results as an integer; True instructs the function to return results as human readable text (refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB SERVERS)", for more information).
 * @param bool $zz Usually inherited from the calling function (`phpMussel()`), this optional parameter is a boolean (defaults to false, but set to true during the initial scan of file uploads), indicating to the function whether or not arrayed results should be imploded prior to being returned to the calling function. False instructs the function to return the arrayed results as verbatim; True instructs the function to return the arrayed results as an imploded string.
 * @param int $dpt Represents the current depth of recursion from which the function has been called. `phpMusselD()` and `phpMusselR()` use this information for determining how much they should indent any entries they generate for logging and for the display of scan results in CLI mode.
 * @param string $ofn In the context of the initial file upload scanning that phpMussel performs when operating via a server, this parameter (a string) represents the "original filename" of the file being scanned (the original filename, in this context, referring to the name of the file being scanned as per supplied by the upload client, as opposed to the temporary filename assigned by the server or any other filename). When operating in the context of CLI mode, both $f and $ofn represent the scan target, as per specified by the CLI operator; The only difference between the two is when the scan target is a directory, rather than a single file; $f will represent the full path to the file (so, directory plus filename), whereas $ofn will represent only the filename.
 * @return int|string|array The scan results, returned as an array when the $f parameter is an array and when $n and/or $zz is/are false, and otherwise returned as per described by the README documentation. The function may also die the script and return nothing, if something goes wrong, such as if the function is triggered in the absense of the required $memCache variable being set.
 */
function phpMusselR($f='',$n=false,$zz=false,$dpt=0,$ofn='')
    {
    if(!isset($GLOBALS['memCache']))
        {
        echo (!isset($GLOBALS['MusselConfig']['lang']['required_variables_not_defined']))?'[phpMussel] Required variables aren\'t defined: Can\'t continue.':'[phpMussel] '.$GLOBALS['MusselConfig']['lang']['required_variables_not_defined'];
        die;
        }
    if($GLOBALS['memCache']['eof'])
        {
        $GLOBALS['whyflagged']=$GLOBALS['killdata']=$GLOBALS['pedata']='';
        if($dpt===0||!isset($GLOBALS['memCache']['objects_scanned'])||!isset($GLOBALS['memCache']['detections_count'])||!isset($GLOBALS['memCache']['scan_errors']))
            {
            $GLOBALS['memCache']['objects_scanned']=0;
            $GLOBALS['memCache']['detections_count']=0;
            $GLOBALS['memCache']['scan_errors']=0;
            }
        }
    else
        {
        if(!isset($GLOBALS['killdata']))$GLOBALS['killdata']='';
        if(!isset($GLOBALS['whyflagged']))$GLOBALS['whyflagged']='';
        if(!isset($GLOBALS['pedata']))$GLOBALS['pedata']='';
        if(!isset($GLOBALS['memCache']['objects_scanned'])||!isset($GLOBALS['memCache']['detections_count'])||!isset($GLOBALS['memCache']['scan_errors']))
            {
            $GLOBALS['memCache']['objects_scanned']=0;
            $GLOBALS['memCache']['detections_count']=0;
            $GLOBALS['memCache']['scan_errors']=0;
            }
        }
    $dpt++;
    for($lnap='',$i=0;$i<($dpt-1);$i++)
        {
        $lnap.='-';
        }
    $lnap.='> ';
    if(is_array($f))
        {
        $k=key($f);
        $c=count($f);
        for($i=0;$i<$c;$i++)
            {
            $f[$k]=phpMusselR($f[$k],$n,false,$dpt,$f[$k]);
            next($f);
            }
        if($n&&$zz)return implode_md($f);
        return $f;
        }
    $ofn=@prescan_decode($ofn);
    $ofnSafe=urlencode($ofn);
    if($d=@is_dir($f))
        {
        if(!$d=@scandir($f))
            {
            $GLOBALS['memCache']['scan_errors']++;
            return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['failed_to_access'].'\''.$ofn.'\''.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
            }
        $c=count($d);
        for($i=0;$i<$c;$i++)
            {
            if($d[$i]=='.'||$d[$i]=='..')
                {
                unset($d[$i]);
                continue;
                }
            $d[$i]=phpMusselR($f."/".$d[$i],$n,false,$dpt,$d[$i]);
            }
        if($n&&$zz)return implode_md($d);
        return $d;
        }
    $GLOBALS['memCache']['objects_scanned']++;
    $GLOBALS['memCache']['phase']='file';
    $GLOBALS['memCache']['container']='none';
    $GLOBALS['memCache']['file_is_ole']=false;
    if(!isset($GLOBALS['memCache']['greylist']))
        {
        if(!file_exists($GLOBALS['vault'].'greylist.csv'))
            {
            $GLOBALS['memCache']['greylist']=',';
            $glf=fopen($GLOBALS['vault'].'greylist.csv','a');
            fwrite($glf,',');
            fclose($glf);
            unset($glf);
            }
        else $GLOBALS['memCache']['greylist']=phpMusselFile($GLOBALS['vault'].'greylist.csv');
        }
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['before_scan']))if($GLOBALS['MusselPlugins']['hookcounts']['before_scan']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['before_scan']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['before_scan'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['before_scan']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['before_scan'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['before_scan'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['before_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['before_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['before_scan'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['before_scan']);
            }
        }
    $d=@is_file($f);
    $fnCRC=@hash('crc32b',$ofn);
    if(!$d||!$f)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['invalid_file'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
    $fS=@filesize($f);
    if($GLOBALS['MusselConfig']['files']['filesize_limit']>0)
        {
        if($fS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
            {
            if(!$GLOBALS['MusselConfig']['files']['filesize_response'])return (!$n)?1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['ok'].' ('.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].').'.$GLOBALS['linebreak'];
            $GLOBALS['killdata'].='--FILESIZE-LIMIT--------NO-HASH-:'.$fS.':'.$ofn.$GLOBALS['linebreak'];
            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
            if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
            return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
            }
        }
    if(substr($ofn,0,1)==='.'||substr($ofn,-1)==='.')
        {
        $GLOBALS['killdata'].='--FILENAME-MANIPULATION-NO-HASH-:'.$fS.':'.$ofn.$GLOBALS['linebreak'];
        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
        if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
        return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
        }
    $xt=$xts=$gzxt=$gzxts='-';
    if(substr_count($ofn,'.')>0)
        {
        $xt=explode('.',strtolower($ofn));
        $xts=substr($xt[count($xt)-1],0,3).'*';
        $xt=$xt[count($xt)-1];
        if(substr_count($ofn,'.')>1)
            {
            $gzxt=explode('.',str_replace('.gz','',strtolower($ofn)));
            $gzxts=substr($gzxt[count($gzxt)-1],0,3).'*';
            $gzxt=strtolower($gzxt[count($gzxt)-1]);
            }
        if(strlen($xt)<1)$xt=$xts=$gzxt=$gzxts='-';
        }
    if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xts.',')>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',$gzxt.',')>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',$gzxts.',')>0)return (!$n)?1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
    if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xts.',')>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',$gzxt.',')>0||substr_count($GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',$gzxts.',')>0)
        {
        $GLOBALS['killdata'].='--FILETYPE-BLACKLISTED--NO-HASH-:'.$fS.':'.$ofn.$GLOBALS['linebreak'];
        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
        if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
        return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
        }
    if($GLOBALS['MusselConfig']['files']['filetype_greylist'])if(!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xt.',')&&!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xts.',')&&!substr_count($GLOBALS['MusselConfig']['files']['filetype_greylist'].',',$gzxt.',')&&!substr_count($GLOBALS['MusselConfig']['files']['filetype_greylist'].',',$gzxts.','))
        {
        $GLOBALS['killdata'].='----FILETYPE--NOT-GREYLISTED----:'.$fS.':'.$ofn.$GLOBALS['linebreak'];
        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
        if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
        return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
        }
    $in=@phpMusselFile($f,($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']>0&&$fS>($GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']*1024))?$GLOBALS['MusselConfig']['attack_specific']['scannable_threshold']:$fS,true);
    $fdCRC=@hash('crc32b',$in);
    if($in&&$GLOBALS['MusselConfig']['compatibility']['only_allow_images'])
        {
        $is_img=(substr_count(',bmp,cd5,cgm,dib,dwf,dwg,dxf,ecw,fits,gif,hdp,hdr,img,jfi,jfif,jif,jp2,jpe,jpeg,jpg,jps,jxr,mpo,odg,pam,pbm,pcx,pdd,pfm,pgm,png,pnm,pns,ppm,psd,psp,sid,svg,swf,tga,tif,tiff,vicar,wbmp,wdp,webp,wmf,xbm,xbmp,xcf,xvl,',','.$xt.',')>0)?true:false;
        $hh=(!$is_img)?bin2hex(substr($in,0,128)):'';
        if(!$is_img)if(substr($hh,0,12)==='474946383761'||substr($hh,0,12)==='474946383961')$is_img=true;
        if(!$is_img)if(substr($hh,0,16)==='0000000c6a502020')$is_img=true;
        if(!$is_img)if(substr($hh,0,8)==='89504e47')$is_img=true;
        if(!$is_img)if(substr($hh,0,6)==='ffd8ff')$is_img=true;
        if(!$is_img)if(substr($hh,0,8)==='25504446')$is_img=true;
        if(!$is_img)if(substr($str,0,2)==='BM'||substr($str,0,8)==='gimp xcf'||substr($str,0,4)==='8BPS'||substr($str,0,4)==='WEBP')$is_img=true;
        if(!$is_img)
            {
            $GLOBALS['killdata'].=md5($in).':'.$fS.':'.$ofn.$GLOBALS['linebreak'];
            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['only_allow_images'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
            if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
            return (!$n)?2:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'; FD: '.$fdCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['only_allow_images'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
            }
        unset($hh,$is_img);
        }
    $z=phpMusselD($in,$n,$dpt,$ofn);
    if($z!==1)
        {
        if($GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
        return (!$n)?$z:$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'; FD: '.$fdCRC.'):'.$GLOBALS['linebreak'].$z;
        }
    $x=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' (FN: '.$fnCRC.'; FD: '.$fdCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
    $r=1;
    if($GLOBALS['MusselConfig']['files']['check_archives']&&!empty($in)&&$GLOBALS['MusselConfig']['files']['max_recursion']>1)
        {
        $GLOBALS['memCache']['phase']='archive';
        $depth=0;
        $eN=$ofn;
        $eNSafe=urlencode($eN);
        $eS=strlen($in);
        $zCRC=@hash('crc32b',$in);
        $lnap='-'.$lnap;
        while(true)
            {
            if($depth>$GLOBALS['MusselConfig']['files']['max_recursion'])
                {
                $r=2;
                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['recursive'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FD: '.$zCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['recursive'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                break;
                }
            $zDo=false;
            if(!$zDo&&substr_compare_hex($in,0,2,'1f8b',true))
                {
                if(!function_exists('gzdecode'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                $in=@gzdecode($in);
                if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $zDo=true;
                }
            if(!$zDo&&substr_compare_hex($in,0,3,'425a68',true))
                {
                if(!function_exists('bzdecompress'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                $in=@bzdecompress($in);
                if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $zDo=true;
                }
            $xtt=(substr_count($eN,'.')>0)?array(substr($eN,-3),substr($eN,-4),substr($eN,-7,4),substr($eN,-8,4)):false;
            if($xtt)if(!$zDo&&(substr_count(',.gz,',','.$xtt[0].',')>0||substr_count(',.tgz,',','.$xtt[1].',')>0))
                {
                if(!function_exists('gzdecode'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                $in=@gzdecode($in);
                if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (GZIP):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $zDo=true;
                }
            if($xtt)if(!$zDo&&(substr_count(',.bz,',','.$xtt[0].',')>0||substr_count(',.bz2,.tbz,',','.$xtt[1].',')>0))
                {
                if(!function_exists('bzdecompress'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                $in=@bzdecompress($in);
                if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (BZIP2):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $zDo=true;
                }
            if($xtt)if(!$zDo&&(substr_count(',.lz,',','.$xtt[0].',')>0||substr_count(',.lha,.lzh,.lzo,.lzw,.lzx,.tlz,',','.$xtt[1].',')>0))
                {
                if(!function_exists('lzf_decompress'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (LZF):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                $in=@lzf_decompress($in);
                if(!$in)return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (LZF):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' (LZF):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $zDo=true;
                }
            if(substr($in,257,6)==="ustar\x00"||$xtt&&(substr_count(',.tar,.tgz,.tbz,.tlz,',','.$xtt[1].',')>0||substr_count(',.tar,.tgz,.tbz,.tlz,',','.$xtt[2].',')>0||substr_count(',.tar,.tgz,.tbz,.tlz,',','.$xtt[3].',')>0))
                {
                $lnap='-'.$lnap;
                $depth++;
                $GLOBALS['memCache']['container']='tarfile';
                if($zDo)
                    {
                    $eS=strlen($in);
                    $zCRC=@hash('crc32b',$in);
                    }
                $TarFile=array();
                // $TarFile['blocksize']=ceil($eS/512);
                $TarFile['file']=array('filename'=>$ofn,'filesize'=>$eS,'rawdata'=>$in,'crc32'=>$zCRC,'fncrc32'=>$fnCRC,'md5'=>md5($in),'directory'=>false);
                if(strtolower(substr($TarFile['file']['filename'],-4))!=='.tar')$TarFile['file']['filename']=(substr_count($TarFile['file']['filename'],'.')>0)?substrbl($TarFile['file']['filename'],'.'):$TarFile['file']['filename'];
                $TarFile['file']['filename']=(substr_count($TarFile['file']['filename'],"\x5c")>0)?substral($TarFile['file']['filename'],"\x5c"):$TarFile['file']['filename'];
                $TarFile['file']['filename']=(substr_count($TarFile['file']['filename'],"\x2f")>0)?substral($TarFile['file']['filename'],"\x2f"):$TarFile['file']['filename'];
                $TarFile['file']['filenameSafe']=urlencode($TarFile['file']['filename']);
                $TarFile['offset']=0;
                $TarFile['badmetadata']=false;
                while(true)
                    {
                    if(($TarFile['offset']+1024)>$eS)break;
                    while(true)
                        {
                        if($TarFile['file']['directory'])break;
                        $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$TarFile['file']['filename'].'\' (FN: '.$TarFile['file']['fncrc32'].'; FD: '.$TarFile['file']['crc32'].'):'.$GLOBALS['linebreak'];
                        if(!$TarFile['file']['filename'])
                            {
                            $r=2;
                            $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':MISSING-FILENAME'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_missing_filename'].$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_missing_filename'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            break 2;
                            }
                        if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
                            {
                            if($TarFile['file']['filesize']>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
                                {
                                if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
                                    {
                                    $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['ok'].' ('.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].').'.$GLOBALS['linebreak'];
                                    break;
                                    }
                                $r=2;
                                $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                                break 2;
                                }
                            }
                        if(substr($TarFile['file']['filename'],0,1)==='.'||substr($TarFile['file']['filename'],-1)==='.')
                            {
                            $r=2;
                            $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                            break 2;
                            }
                        if($GLOBALS['MusselConfig']['files']['filetype_archives'])
                            {
                            $xt=$xts='-';
                            if(substr_count($TarFile['file']['filename'],'.')>0)
                                {
                                $xt=explode('.',strtolower($TarFile['file']['filename']));
                                $xts=substr($xt[count($xt)-1],0,3).'*';
                                $xt=$xt[count($xt)-1];
                                if(strlen($xt)<1)$xt=$xts='-';
                                }
                            if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xts.',')>0)
                                {
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
                                break;
                                }
                            if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xts.',')>0)
                                {
                                $r=2;
                                $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                                break 2;
                                }
                            if($GLOBALS['MusselConfig']['files']['filetype_greylist'])if(!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xt.',')&&!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xts.','))
                                {
                                $r=2;
                                $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                                break 2;
                                }
                            }
                        $GLOBALS['memCache']['objects_scanned']++;
                        $TarFile['file']['scan']=phpMusselD($TarFile['file']['rawdata'],$n,$dpt,$TarFile['file']['filename']);
                        if($TarFile['file']['scan']!==1)
                            {
                            $r=2;
                            $x.=$TarFile['file']['scan'];
                            break 2;
                            }
                        if($GLOBALS['MusselConfig']['signatures']['metadata_clamav'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_clamav.cvd']))$GLOBALS['memCache']['metadata_clamav.cvd']=@file($GLOBALS['vault'].'metadata_clamav.cvd');
                            if(!$GLOBALS['memCache']['metadata_clamav.cvd'])
                                {
                                $xc=0;
                                if($r!==2)$r=-3;
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                                break;
                                }
                            else
                                {
                                $xc=count($GLOBALS['memCache']['metadata_clamav.cvd']);
                                if($GLOBALS['memCache']['metadata_clamav.cvd']&&$xc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                                    break;
                                    }
                                }
                            if($xc>0)for($xi=0;$xi<$xc;$xi++)
                                {
                                $TarFile['sig']=@explode(':',$GLOBALS['memCache']['metadata_clamav.cvd'][$xi]);
                                $TarFile['sig'][0]=vn_shorthand($TarFile['sig'][0]);
                                if(!isset($TarFile['sig'][1]))$TarFile['sig'][1]=0;
                                $TarFile['sig'][2]=(!isset($TarFile['sig'][2]))?'':preg_replace('/[^a-z0-9]/','',$TarFile['sig'][2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$TarFile['sig'][0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($TarFile['sig'][0]&&$TarFile['sig'][1]&&$TarFile['sig'][2])if($TarFile['sig'][1]==$TarFile['file']['filesize']&&$TarFile['sig'][2]==$TarFile['file']['crc32'])
                                        {
                                        $r=2;
                                        $TarFile['badmetadata']=true;
                                        $x.='-'.$lnap.phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($TarFile['file']['rawdata']).':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        break 2;
                                        }
                                    }
                                }
                            }
                        if($GLOBALS['MusselConfig']['signatures']['metadata_custom'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_custom.cvd']))$GLOBALS['memCache']['metadata_custom.cvd']=@file($GLOBALS['vault'].'metadata_custom.cvd');
                            if(!$GLOBALS['memCache']['metadata_custom.cvd'])
                                {
                                $xc=0;
                                if($r!==2)$r=-3;
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                                break;
                                }
                            else
                                {
                                $xc=count($GLOBALS['memCache']['metadata_custom.cvd']);
                                if($GLOBALS['memCache']['metadata_custom.cvd']&&$xc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                                    break;
                                    }
                                }
                            if($xc>0)for($xi=0;$xi<$xc;$xi++)
                                {
                                $TarFile['sig']=@explode(':',$GLOBALS['memCache']['metadata_custom.cvd'][$xi]);
                                $TarFile['sig'][0]=vn_shorthand($TarFile['sig'][0]);
                                if(!isset($TarFile['sig'][1]))$TarFile['sig'][1]=0;
                                $TarFile['sig'][2]=(!isset($TarFile['sig'][2]))?'':preg_replace('/[^a-z0-9]/','',$TarFile['sig'][2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$TarFile['sig'][0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($TarFile['sig'][0]&&$TarFile['sig'][1]&&$TarFile['sig'][2])if($TarFile['sig'][1]==$TarFile['file']['filesize']&&$TarFile['sig'][2]==$TarFile['file']['crc32'])
                                        {
                                        $r=2;
                                        $TarFile['badmetadata']=true;
                                        $x.='-'.$lnap.phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($TarFile['file']['rawdata']).':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        break 2;
                                        }
                                    }
                                }
                            }
                        if($GLOBALS['MusselConfig']['signatures']['metadata_mussel'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_mussel.cvd']))$GLOBALS['memCache']['metadata_mussel.cvd']=@file($GLOBALS['vault'].'metadata_mussel.cvd');
                            if(!$GLOBALS['memCache']['metadata_mussel.cvd'])
                                {
                                $xc=0;
                                if($r!==2)$r=-3;
                                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                                break;
                                }
                            else
                                {
                                $xc=count($GLOBALS['memCache']['metadata_mussel.cvd']);
                                if($GLOBALS['memCache']['metadata_mussel.cvd']&&$xc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                                    break;
                                    }
                                }
                            if($xc>0)for($xi=0;$xi<$xc;$xi++)
                                {
                                $TarFile['sig']=@explode(':',$GLOBALS['memCache']['metadata_mussel.cvd'][$xi]);
                                $TarFile['sig'][0]=vn_shorthand($TarFile['sig'][0]);
                                if(!isset($TarFile['sig'][1]))$TarFile['sig'][1]=0;
                                $TarFile['sig'][2]=(!isset($TarFile['sig'][2]))?'':preg_replace('/[^a-z0-9]/','',$TarFile['sig'][2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$TarFile['sig'][0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($TarFile['sig'][0]&&$TarFile['sig'][1]&&$TarFile['sig'][2])if($TarFile['sig'][1]==$TarFile['file']['filesize']&&$TarFile['sig'][2]==$TarFile['file']['crc32'])
                                        {
                                        $r=2;
                                        $TarFile['badmetadata']=true;
                                        $x.='-'.$lnap.phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($TarFile['file']['rawdata']).':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$TarFile['sig'][0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        break 2;
                                        }
                                    }
                                }
                            }
                        $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
                        break;
                        }
                    $TarFile['file']=array();
                    $TarFile['file']['filename']=preg_replace('/[^\x20-\xff]/','',substr($in,$TarFile['offset'],100));
                    $TarFile['file']['filesize']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+124,12)));
                    $TarFile['file']['directory']=(substr($TarFile['file']['filename'],-1,1)==='/'&&$TarFile['file']['filesize']===0);
                    // There's also a bit-check for confirming directory status with POSIX TARs, will add that in later, as well as other bit flags (`typeflag` and etc).
                    if($TarFile['file']['filename'])
                        {
                        $TarFile['file']['filename']=(substr_count($TarFile['file']['filename'],"\x5c")>0)?substral($TarFile['file']['filename'],"\x5c"):$TarFile['file']['filename'];
                        $TarFile['file']['filename']=(substr_count($TarFile['file']['filename'],"\x2f")>0)?substral($TarFile['file']['filename'],"\x2f"):$TarFile['file']['filename'];
                        }
                    $TarFile['file']['filenameSafe']=urlencode($TarFile['file']['filename']);
                    if($TarFile['file']['filesize']<0)
                        {
                        $r=2;
                        $TarFile['badmetadata']=true;
                        $GLOBALS['killdata'].=$TarFile['file']['md5'].':'.$TarFile['file']['filesize'].':'.$ofn.'>'.$TarFile['file']['filename'].$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].' ('.$ofnSafe.'>'.$TarFile['file']['filenameSafe'].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_tampering'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        break;
                        }
                    // $TarFile['file']['mode']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+100,8)));
                    // $TarFile['file']['uid']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+108,8)));
                    // $TarFile['file']['gid']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+116,8)));
                    // $TarFile['file']['mtime']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+136,12)));
                    // $TarFile['file']['chksum']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+148,8)));
                    // $TarFile['file']['typeflag']=substr($in,$TarFile['offset']+156,1);
                    // $TarFile['file']['linkname']=preg_replace('/[^\x20-\xff]/','',substr($in,$TarFile['offset']+157,100));
                    $TarFile['file']['magic']=preg_replace('/[^\x20-\xff]/','',substr($in,$TarFile['offset']+257,6));
                    // $TarFile['file']['version']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+263,2)));
                    // $TarFile['file']['uname']=preg_replace('/[^\x20-\xff]/','',substr($in,$TarFile['offset']+265,32));
                    // $TarFile['file']['gname']=preg_replace('/[^\x20-\xff]/','',substr($in,$TarFile['offset']+297,32));
                    // $TarFile['file']['devmajor']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+329,8)));
                    // $TarFile['file']['devminor']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+337,8)));
                    // $TarFile['file']['prefix']=octdec(preg_replace('/[^0-9]/','',substr($in,$TarFile['offset']+345,155)));
                    $TarFile['file']['rawdata']=substr($in,$TarFile['offset']+512,$TarFile['file']['filesize']);
                    $TarFile['file']['crc32']=hash('crc32b',$TarFile['file']['rawdata']);
                    $TarFile['file']['fncrc32']=hash('crc32b',$TarFile['file']['filename']);
                    $TarFile['file']['md5']=md5($TarFile['file']['rawdata']);
                    $TarFile['file']['blocks']=ceil($TarFile['file']['filesize']/512)+1;
                    $TarFile['offset']+=$TarFile['file']['blocks']*512;
                    }
                if($TarFile['badmetadata']&&$r===2)
                    {
                    if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
                        {
                        if($eS<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
                            {
                            $qfu=$GLOBALS['time']."-".md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$zCRC.$GLOBALS['time']);
                            @phpMusselQ($in,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
                            $GLOBALS['killdata'].='Quarantined as "/vault/quarantine/'.$qfu.'.qfu".'.$GLOBALS['linebreak'];
                            }
                        }
                    }
                $TarFile='';
                break;
                }
            else if($zDo)
                {
                $lnap='-'.$lnap;
                $depth++;
                $GLOBALS['memCache']['container']='compressor';
                $eN=(substr_count($eN,'.')>0)?substrbl($eN,'.'):$eN;
                $eN=(substr_count($eN,"\x5c")>0)?substral($eN,"\x5c"):$eN;
                $eN=(substr_count($eN,"\x2f")>0)?substral($eN,"\x2f"):$eN;
                $eNSafe=urlencode($eN);
                $eS=strlen($in);
                $zCRC=@hash('crc32b',$in);
                if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
                    {
                    if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
                        {
                        if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
                            {
                            $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FD: '.$zCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['ok'].' ('.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].').'.$GLOBALS['linebreak'];
                            break;
                            }
                        $r=2;
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FD: '.$zCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                        break;
                        }
                    }
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$fnCRC.'; FD: '.$zCRC.'):'.$GLOBALS['linebreak'];
                $GLOBALS['memCache']['objects_scanned']++;
                $bad=phpMusselD($in,$n,$dpt,$eN);
                if($bad!==1)
                    {
                    $r=2;
                    $x.=$bad;
                    break;
                    }
                if($GLOBALS['MusselConfig']['signatures']['metadata_clamav'])
                    {
                    if(!isset($GLOBALS['memCache']['metadata_clamav.cvd']))$GLOBALS['memCache']['metadata_clamav.cvd']=@file($GLOBALS['vault'].'metadata_clamav.cvd');
                    if(!$GLOBALS['memCache']['metadata_clamav.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        $zmdc=0;
                        if($r!==2)$r=-3;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_clamav.cvd)! ';
                            }
                        $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                        }
                    else
                        {
                        $zmdc=count($GLOBALS['memCache']['metadata_clamav.cvd']);
                        if($zmdc<1)
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if($r!==2)$r=-3;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_clamav.cvd)! ';
                                }
                            $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                            }
                        }
                    if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                        {
                        $zmds=@explode(':',$GLOBALS['memCache']['metadata_clamav.cvd'][$zmdi]);
                        $zmds[0]=vn_shorthand($zmds[0]);
                        if(!isset($zmds[1]))$zmds[1]=0;
                        $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
                                {
                                $r=2;
                                $x.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                if($GLOBALS['MusselConfig']['signatures']['metadata_custom'])
                    {
                    if(!isset($GLOBALS['memCache']['metadata_custom.cvd']))$GLOBALS['memCache']['metadata_custom.cvd']=@file($GLOBALS['vault'].'metadata_custom.cvd');
                    if(!$GLOBALS['memCache']['metadata_custom.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        $zmdc=0;
                        if($r!==2)$r=-3;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_custom.cvd)! ';
                            }
                        $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                        }
                    else
                        {
                        $zmdc=count($GLOBALS['memCache']['metadata_custom.cvd']);
                        if($zmdc<1)
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if($r!==2)$r=-3;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_custom.cvd)! ';
                                }
                            $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                            }
                        }
                    if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                        {
                        $zmds=@explode(':',$GLOBALS['memCache']['metadata_custom.cvd'][$zmdi]);
                        $zmds[0]=vn_shorthand($zmds[0]);
                        if(!isset($zmds[1]))$zmds[1]=0;
                        $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
                                {
                                $r=2;
                                $x.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                if($GLOBALS['MusselConfig']['signatures']['metadata_mussel'])
                    {
                    if(!isset($GLOBALS['memCache']['metadata_mussel.cvd']))$GLOBALS['memCache']['metadata_mussel.cvd']=@file($GLOBALS['vault'].'metadata_mussel.cvd');
                    if(!$GLOBALS['memCache']['metadata_mussel.cvd'])
                        {
                        $GLOBALS['memCache']['scan_errors']++;
                        $zmdc=0;
                        if($r!==2)$r=-3;
                        if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                            {
                            $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_mussel.cvd)! ';
                            }
                        $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                        }
                    else
                        {
                        $zmdc=count($GLOBALS['memCache']['metadata_mussel.cvd']);
                        if($zmdc<1)
                            {
                            $GLOBALS['memCache']['scan_errors']++;
                            if($r!==2)$r=-3;
                            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])
                                {
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_mussel.cvd)! ';
                                }
                            $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                            }
                        }
                    if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                        {
                        $zmds=@explode(':',$GLOBALS['memCache']['metadata_mussel.cvd'][$zmdi]);
                        $zmds[0]=vn_shorthand($zmds[0]);
                        if(!isset($zmds[1]))$zmds[1]=0;
                        $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eS&&$zmds[2]==$zCRC)
                                {
                                $r=2;
                                $x.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                if($r===2)
                    {
                    if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
                        {
                        if($eS<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
                            {
                            $qfu=$GLOBALS['time'].'-'.md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$zCRC.$GLOBALS['time']);
                            @phpMusselQ($in,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
                            $GLOBALS['killdata'].='Quarantined as "/vault/quarantine/'.$qfu.'.qfu".'.$GLOBALS['linebreak'];
                            }
                        }
                    break;
                    }
                $x.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
                continue;
                }
            break;
            }
        if($xts=='zip*'||substr($in,0,2)==='PK')
            {
            $ziptype=false;
            if(!$ziptype)if($xt=='ole')$ziptype='OLE';
            if(!$ziptype)if($xt=='smpk')$ziptype='SMPTE';
            if(!$ziptype)if($xt=='xpi')$ziptype='XPInstall';
            if(!$ziptype)if($xts=='app*')$ziptype='App';
            if(!$ziptype)if(substr_count(',docm,docx,dotm,dotx,potm,potx,ppam,ppsm,ppsx,pptm,pptx,xlam,xlsb,xlsm,xlsx,xltm,xltx,',','.$xt.',')>0)$ziptype='OpenXML';
            if(!$ziptype)if(substr_count(',odc,odf,odg,odm,odp,ods,odt,otg,oth,otp,ots,ott,',','.$xt.',')>0||$xts=='fod*')$ziptype='OpenDocument';
            if(!$ziptype)if(substr_count(',opf,epub,',','.$xt.',')>0)$ziptype='EPUB';
            if(!$ziptype)$ziptype='ZIP';
            else $GLOBALS['memCache']['file_is_ole']=true;
            if($ziptype=='ZIP')$GLOBALS['memCache']['container']='zipfile';
            else $GLOBALS['memCache']['container']='pkfile';
            // AAA MORE WORK TO BE DONE, FUTURE ZIP FUNCTIONS TO GO HERE! AAA
            // WORKING NOTES: https://pkware.cachefly.net/webdocs/casestudies/APPNOTE.TXT
            // $ziphead['version_needed']=explode_bits(substr($in,4,2));
            // $ziphead['compression_method']=explode_bits(substr($in,8,2));
            // I'm hoping to eventually re-code this whole section.
            $ziphead=array('passed'=>true);
            $ziphead['general_purpose']=explode_bits(substr($in,6,2));
            if($ziphead['general_purpose'][7])
                {
                // Encryption Detected.
                $ziphead['passed']=false;
                if($GLOBALS['MusselConfig']['files']['block_encrypted_archives'])
                    {
                    $r=2;
                    $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                    $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['encrypted_archive'].' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$zCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['encrypted_archive'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                    }
                }
            if($ziphead['passed'])
                {
                if(!function_exists('zip_open'))
                    {
                    $GLOBALS['memCache']['scan_errors']++;
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_extensions_silently'])
                        {
                        $GLOBALS['killdata'].=md5($in).':'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].' ';
                        }
                    return (!$n)?-1:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' ('.$ziptype.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_extensions_missing'].$GLOBALS['linebreak'];
                    }
                if(!$fS=@zip_open($f))return (!$n)?0:$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' ('.$ziptype.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_not_archive'].$GLOBALS['linebreak'];
                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_reading'].' \''.$ofn.'\' ('.$ziptype.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking_contents'].$GLOBALS['linebreak'];
                $b=false;
                $lnap='-'.$lnap;
                $bi=-1;
                while(!$b)
                    {
                    $bi++;
                    if(!$fD=@zip_read($fS))
                        {
                        $b=true;
                        continue;
                        }
                    $eN=@zip_entry_name($fD);
                    $eNSafe=urlencode($eN);
                    $eS=@zip_entry_filesize($fD);
                    $znCRC=@hash('crc32b',$eN);
                    if($GLOBALS['MusselConfig']['files']['filesize_archives']&&$GLOBALS['MusselConfig']['files']['filesize_limit']>0)
                        {
                        if($eS>($GLOBALS['MusselConfig']['files']['filesize_limit']*1024))
                            {
                            if(!$GLOBALS['MusselConfig']['files']['filesize_response'])
                                {
                                $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['ok'].' ('.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].').'.$GLOBALS['linebreak'];
                                continue;
                                }
                            $r=2;
                            $GLOBALS['killdata'].='--FILESIZE-LIMIT--------NO-HASH-:'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filesize_limit_exceeded'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                            continue;
                            }
                        }
                    if(substr($eN,0,1)==='.'||substr($eN,-1)==='.')
                        {
                        $r=2;
                        $GLOBALS['killdata'].='--FILENAME-MANIPULATION-NO-HASH-:'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                        $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].' ('.$ofnSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_filename_manipulation_detected'].$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                        continue;
                        }
                    if($GLOBALS['MusselConfig']['files']['filetype_archives'])
                        {
                        $xt=$xts='-';
                        if(substr_count($eN,'.')>0)
                            {
                            $xt=explode('.',strtolower($eN));
                            $xts=substr($xt[count($xt)-1],0,3).'*';
                            $xt=$xt[count($xt)-1];
                            if(strlen($xt)<1)$xt=$xts='-';
                            }
                        if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_whitelist'].',',','.$xts.',')>0)
                            {
                            $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
                            continue;
                            }
                        if(substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xt.',')>0||substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_blacklist'].',',','.$xts.',')>0)
                            {
                            $r=2;
                            $GLOBALS['killdata'].='--FILETYPE-BLACKLISTED--NO-HASH-:'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                            continue;
                            }
                        if($GLOBALS['MusselConfig']['files']['filetype_greylist'])if(!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xt.',')&&!substr_count(','.$GLOBALS['MusselConfig']['files']['filetype_greylist'].',',','.$xts.','))
                            {
                            $r=2;
                            $GLOBALS['killdata'].='----FILETYPE--NOT-GREYLISTED----:'.$eS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                            $GLOBALS['whyflagged'].=$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['filetype_blacklisted'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'];
                            continue;
                            }
                        }
                    $eD=@zip_entry_read($fD,$eS);
                    if(!$eD||!$eS)continue;
                    $eFS=strlen($eD);
                    $GLOBALS['memCache']['objects_scanned']++;
                    $bad=phpMusselD($eD,$n,$dpt,$eN);
                    $zmd='';
                    $zCRC=@hash('crc32b',$eD);
                    if($bi<2)
                        {
                        if($GLOBALS['MusselConfig']['signatures']['metadata_clamav'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_clamav.cvd']))$GLOBALS['memCache']['metadata_clamav.cvd']=@file($GLOBALS['vault'].'metadata_clamav.cvd');
                            if(!$GLOBALS['memCache']['metadata_clamav.cvd'])
                                {
                                $zmdc=0;
                                if($r!==2)$r=-3;
                                $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                                }
                            else
                                {
                                $zmdc=count($GLOBALS['memCache']['metadata_clamav.cvd']);
                                if($zmdc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_clamav.cvd)!'.$GLOBALS['linebreak'];
                                    }
                                }
                            if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                                {
                                $zmds=@explode(':',$GLOBALS['memCache']['metadata_clamav.cvd'][$zmdi]);
                                $zmds[0]=vn_shorthand($zmds[0]);
                                if(!isset($zmds[1]))$zmds[1]=0;
                                $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
                                        {
                                        $r=2;
                                        $zmd.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($eD).':'.$eFS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        if($GLOBALS['MusselConfig']['signatures']['metadata_custom'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_custom.cvd']))$GLOBALS['memCache']['metadata_custom.cvd']=@file($GLOBALS['vault'].'metadata_custom.cvd');
                            if(!$GLOBALS['memCache']['metadata_custom.cvd'])
                                {
                                $zmdc=0;
                                if($r!==2)$r=-3;
                                $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                                }
                            else
                                {
                                $zmdc=count($GLOBALS['memCache']['metadata_custom.cvd']);
                                if($zmdc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_custom.cvd)!'.$GLOBALS['linebreak'];
                                    }
                                }
                            if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                                {
                                $zmds=@explode(':',$GLOBALS['memCache']['metadata_custom.cvd'][$zmdi]);
                                $zmds[0]=vn_shorthand($zmds[0]);
                                if(!isset($zmds[1]))$zmds[1]=0;
                                $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
                                        {
                                        $r=2;
                                        $zmd.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($eD).':'.$eFS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        if($GLOBALS['MusselConfig']['signatures']['metadata_mussel'])
                            {
                            if(!isset($GLOBALS['memCache']['metadata_mussel.cvd']))$GLOBALS['memCache']['metadata_mussel.cvd']=@file($GLOBALS['vault'].'metadata_mussel.cvd');
                            if(!$GLOBALS['memCache']['metadata_mussel.cvd'])
                                {
                                $zmdc=0;
                                if($r!==2)$r=-3;
                                $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_missing'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                                }
                            else
                                {
                                $zmdc=count($GLOBALS['memCache']['metadata_mussel.cvd']);
                                if($zmdc<1)
                                    {
                                    if($r!==2)$r=-3;
                                    $zmd.='-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_signature_file_corrupted'].' (metadata_mussel.cvd)!'.$GLOBALS['linebreak'];
                                    }
                                }
                            if($zmdc>0)for($zmdi=0;$zmdi<$zmdc;$zmdi++)
                                {
                                $zmds=@explode(':',$GLOBALS['memCache']['metadata_mussel.cvd'][$zmdi]);
                                $zmds[0]=vn_shorthand($zmds[0]);
                                if(!isset($zmds[1]))$zmds[1]=0;
                                $zmds[2]=(!isset($zmds[2]))?'':preg_replace('/[^a-z0-9]/','',$zmds[2]);
                                if(!substr_count($GLOBALS['memCache']['greylist'],','.$zmds[0].',')&&!$GLOBALS['memCache']['ignoreme'])
                                    {
                                    if($zmds[0]&&$zmds[1]&&$zmds[2])if($zmds[1]==$eFS&&$zmds[2]==$zCRC)
                                        {
                                        $r=2;
                                        $zmd.='-'.$lnap.phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$GLOBALS['linebreak'];
                                        $GLOBALS['killdata'].=md5($eD).':'.$eFS.':'.$ofn.'>'.$eN.$GLOBALS['linebreak'];
                                        $GLOBALS['whyflagged'].=phpMusselV(array('vn'=>$zmds[0]),$GLOBALS['MusselConfig']['lang']['detected']).' ('.$ofnSafe.'>'.$eNSafe.')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                        }
                                    }
                                }
                            }
                        }
                    if($bad!==1)
                        {
                        $r=2;
                        $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'; FD: '.$zCRC.'):'.$GLOBALS['linebreak'].$bad.$zmd;
                        continue;
                        }
                    if($r===2&&$zmd)
                        {
                        if($GLOBALS['MusselConfig']['general']['quarantine_key']&&!$GLOBALS['MusselConfig']['general']['honeypot_mode'])
                            {
                            if($eFS<($GLOBALS['MusselConfig']['general']['quarantine_max_filesize']*1024))
                                {
                                $qfu=$GLOBALS['time']."-".md5($GLOBALS['MusselConfig']['general']['quarantine_key'].$zCRC.$GLOBALS['time']);
                                @phpMusselQ($eD,$GLOBALS['MusselConfig']['general']['quarantine_key'],$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],$qfu);
                                $GLOBALS['killdata'].='Quarantined as "/vault/quarantine/'.$qfu.'.qfu".'.$GLOBALS['linebreak'];
                                }
                            }
                        $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'; FD: '.$zCRC.'):'.$GLOBALS['linebreak'].$zmd;
                        continue;
                        }
                    $x.=$lnap.$GLOBALS['MusselConfig']['lang']['scan_checking'].' \''.$ofn.'\' > \''.$eN.'\' (FN: '.$znCRC.'; FD: '.$zCRC.'):'.$GLOBALS['linebreak'].'-'.$lnap.$GLOBALS['MusselConfig']['lang']['scan_no_problems_found'].$GLOBALS['linebreak'];
                    }
                zip_close($fS);
                }
            }
        /**
         * @todo Future RAR functions to go here!
         */
        if($xt=='rar'||substr($in,0,4)==='Rar!'||bin2hex(substr($in,0,4))==='52457e5e')
            {
            // $GLOBALS['memCache']['container']='rarfile';
            }
        if($r===2&&$GLOBALS['MusselConfig']['general']['delete_on_sight'])@unlink($f);
        }
    return (!$n)?$r:$x;
    }

define('mussel_php',defined('PHP_BINARY')?PHP_BINARY:'');
define('mussel_os',strtoupper(substr(PHP_OS,0,3)));
define('mussel_sapi',php_sapi_name());
if(strlen(mussel_php)>0&&mussel_os=='WIN'&&mussel_sapi=='cli'&&!function_exists('phpMusselFork'))
    {
    /**
     * This function is used by phpMussel to fork the PHP process when scanning files in CLI mode. It does this as so
     * that if PHP happens to crash while scanning a file and/or directory, phpMussel can continue to scan any
     * remaining files and/or directories queued for scanning (because if the parent process handles the scanning queue
     * and the child process handles the actual scanning of each file queued for scanning, if the child process
     * crashes, the parent process can simply create a new child process to continue iterating through the queue).
     *
     * There are also some additional benefits to be had by scanning in this way, such as the ability to kill a child
     * process, responsible for the actual scanning, and yet still have the results of this scanning logged (which, of
     * course, if killed in this way prior to completing the scan, would likely entail some manner of error).
     *
     * @param string $f The name of the file and/or directory to be scanned, with path included (so, the complete file address).
     * @param string $ofn The name of the file and/or directory to be scanned, without any path included (so, just the name by itself).
     * @return string The scan results, piped back to the parent from the child process and returned to the calling function as a string.
     */
    function phpMusselFork($f='',$ofn='')
        {
        $pf=popen(mussel_php.' "'.$GLOBALS['vault'].'../phpmussel.php" "cli_win_scan" "'.$f.'" "'.$ofn.'"','r');
        $s='';
        while($x=fgets($pf))$s.=$x;
        pclose($pf);
        return $s;
        }
    }

if(!isset($MusselConfig['general']['scan_log']))$MusselConfig['general']['scan_log']='';
if(!isset($MusselConfig['general']['scan_log_serialized']))$MusselConfig['general']['scan_log_serialized']='';
if(!isset($MusselConfig['general']['scan_kills']))$MusselConfig['general']['scan_kills']='';
if(!isset($MusselConfig['general']['forbid_on_block']))$MusselConfig['general']['forbid_on_block']=false;
if(!isset($MusselConfig['general']['delete_on_sight']))$MusselConfig['general']['delete_on_sight']=false;
if(!isset($MusselConfig['general']['quarantine_key']))$MusselConfig['general']['quarantine_key']='';
if(!isset($MusselConfig['general']['quarantine_max_filesize']))$MusselConfig['general']['quarantine_max_filesize']=2048;
if(!isset($MusselConfig['general']['quarantine_max_usage']))$MusselConfig['general']['quarantine_max_usage']=65536;
if(!isset($MusselConfig['general']['honeypot_mode']))$MusselConfig['general']['honeypot_mode']=false;
if(!isset($MusselConfig['general']['scan_cache_expiry']))$MusselConfig['general']['scan_cache_expiry']=21600;
if(!isset($MusselConfig['general']['disable_cli']))$MusselConfig['general']['disable_cli']=false;
if(!isset($MusselConfig['signatures']))$MusselConfig['signatures']=array();
$memCache['vChkSigs']=array();
foreach(array('ascii','coex','elf','exe','filenames','general','graphics','html','macho','mail','md5','metadata','ole','pdf','pe','pex','swf','whitelist','xmlxdp') as $memCache['vChkSigs']['sigset'])
    {
    $memCache['vChkSigs']['clamav']=$memCache['vChkSigs']['sigset'].'_clamav';
    $memCache['vChkSigs']['custom']=$memCache['vChkSigs']['sigset'].'_custom';
    $memCache['vChkSigs']['mussel']=$memCache['vChkSigs']['sigset'].'_mussel';
    if(isset($MusselConfig['signatures'][$memCache['vChkSigs']['sigset']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']])&&!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=$MusselConfig['signatures'][$memCache['vChkSigs']['sigset']];
    if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]))$MusselConfig['signatures'][$memCache['vChkSigs']['clamav']]=true;
    if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['custom']]))$MusselConfig['signatures'][$memCache['vChkSigs']['custom']]=true;
    if(!isset($MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]))$MusselConfig['signatures'][$memCache['vChkSigs']['mussel']]=true;
    }
unset($memCache['vChkSigs']);
if(!isset($MusselConfig['signatures']['fn_siglen_min']))$MusselConfig['signatures']['fn_siglen_min']=2;
if(!isset($MusselConfig['signatures']['fn_siglen_max']))$MusselConfig['signatures']['fn_siglen_max']=512;
if(!isset($MusselConfig['signatures']['rx_siglen_min']))$MusselConfig['signatures']['rx_siglen_min']=4;
if(!isset($MusselConfig['signatures']['rx_siglen_max']))$MusselConfig['signatures']['rx_siglen_max']=1024;
if(!isset($MusselConfig['signatures']['sd_siglen_min']))$MusselConfig['signatures']['sd_siglen_min']=4;
if(!isset($MusselConfig['signatures']['sd_siglen_max']))$MusselConfig['signatures']['sd_siglen_max']=1024;
if(!isset($MusselConfig['signatures']['fail_silently']))$MusselConfig['signatures']['fail_silently']=true;
if(!isset($MusselConfig['signatures']['fail_extensions_silently']))$MusselConfig['signatures']['fail_extensions_silently']=true;
if(!isset($MusselConfig['signatures']['detect_adware']))$MusselConfig['signatures']['detect_adware']=true;
if(!isset($MusselConfig['signatures']['detect_joke_hoax']))$MusselConfig['signatures']['detect_joke_hoax']=true;
if(!isset($MusselConfig['signatures']['detect_pua_pup']))$MusselConfig['signatures']['detect_pua_pup']=true;
if(!isset($MusselConfig['signatures']['detect_packer_packed']))$MusselConfig['signatures']['detect_packer_packed']=true;
if(!isset($MusselConfig['signatures']['detect_shell']))$MusselConfig['signatures']['detect_shell']=true;
if(!isset($MusselConfig['signatures']['detect_deface']))$MusselConfig['signatures']['detect_deface']=true;
if(!isset($MusselConfig['files']))$MusselConfig['files']=array();
if(!isset($MusselConfig['files']['max_uploads']))$MusselConfig['files']['max_uploads']=10;
if(!isset($MusselConfig['files']['filesize_limit']))$MusselConfig['files']['filesize_limit']=65536;
if(!isset($MusselConfig['files']['filesize_response']))$MusselConfig['files']['filesize_response']=true;
if(!isset($MusselConfig['files']['filetype_whitelist']))$MusselConfig['files']['filetype_whitelist']='';
if(!isset($MusselConfig['files']['filetype_blacklist']))$MusselConfig['files']['filetype_blacklist']='386,acc*,acm,act*,apk,app,ax,bat,bin,cgi,cmd,com*,cpl,csh,dll,drv,elf,exe,fxp,gad*,hta*,htp*,ico,inf,ins,inx,ipa,isu,job,js,jse,ksh,lnk,msc,msi,msp,mst,net,ocx,ops,org,osx,out,paf,php*,pif,pl,prg,ps1,reg,rgs,rs,run,scr*,sct,shb,shs,sql*,sys,u3p,url,vb,vbe,vbs*,wor*,ws,wsf,xsl';
if(!isset($MusselConfig['files']['filetype_greylist']))$MusselConfig['files']['filetype_greylist']='';
if(!isset($MusselConfig['files']['check_archives']))$MusselConfig['files']['check_archives']=true;
if(!isset($MusselConfig['files']['filesize_archives']))$MusselConfig['files']['filesize_archives']=true;
if(!isset($MusselConfig['files']['filetype_archives']))$MusselConfig['files']['filetype_archives']=false;
if(!isset($MusselConfig['files']['max_recursion']))$MusselConfig['files']['max_recursion']=10;
if(!isset($MusselConfig['files']['block_encrypted_archives']))$MusselConfig['files']['block_encrypted_archives']=true;
if(!isset($MusselConfig['attack_specific']))$MusselConfig['attack_specific']=array();
if(!isset($MusselConfig['attack_specific']['chameleon_from_php']))$MusselConfig['attack_specific']['chameleon_from_php']=true;
if(!isset($MusselConfig['attack_specific']['chameleon_from_exe']))$MusselConfig['attack_specific']['chameleon_from_exe']=true;
if(!isset($MusselConfig['attack_specific']['chameleon_to_archive']))$MusselConfig['attack_specific']['chameleon_to_archive']=true;
if(!isset($MusselConfig['attack_specific']['chameleon_to_doc']))$MusselConfig['attack_specific']['chameleon_to_doc']=true;
if(!isset($MusselConfig['attack_specific']['chameleon_to_img']))$MusselConfig['attack_specific']['chameleon_to_img']=true;
if(!isset($MusselConfig['attack_specific']['chameleon_to_pdf']))$MusselConfig['attack_specific']['chameleon_to_pdf']=true;
if(!isset($MusselConfig['attack_specific']['archive_file_extensions']))$MusselConfig['attack_specific']['archive_file_extensions']='7z,a,ace,alz,apk,app,ar,arc,arj,ba,bh,bz2,dmg,gz,ice,iso,lha,lz,lzh,lzo,lzw,lzx,mar,pak,pck,pea,rar,rz,s7z,sea,sen,sfx,shar,sqx,tar,tgz,tlz,xar,xp3,xz,yz1,z,zz';
if(!isset($MusselConfig['attack_specific']['archive_file_extensions_wc']))$MusselConfig['attack_specific']['archive_file_extensions_wc']='paq*,sit*,tbz*,zip*';
if(!isset($MusselConfig['attack_specific']['general_commands']))$MusselConfig['attack_specific']['general_commands']=false;
if(!isset($MusselConfig['attack_specific']['block_control_characters']))$MusselConfig['attack_specific']['block_control_characters']=false;
if(!isset($MusselConfig['attack_specific']['corrupted_exe']))$MusselConfig['attack_specific']['corrupted_exe']=true;
if(!isset($MusselConfig['attack_specific']['decode_threshold']))$MusselConfig['attack_specific']['decode_threshold']=512;
if(!isset($MusselConfig['attack_specific']['scannable_threshold']))$MusselConfig['attack_specific']['scannable_threshold']=32768;
if(!isset($MusselConfig['compatibility']))$MusselConfig['compatibility']=array();
if(!isset($MusselConfig['compatibility']['ignore_upload_errors']))$MusselConfig['compatibility']['ignore_upload_errors']=false;
if(!isset($MusselConfig['compatibility']['only_allow_images']))$MusselConfig['compatibility']['only_allow_images']=false;
if(!isset($MusselConfig['heuristic']))$MusselConfig['heuristic']=array();
if(!isset($MusselConfig['heuristic']['threshold']))$MusselConfig['heuristic']['threshold']=3;
if(!isset($MusselConfig['virustotal']))$MusselConfig['virustotal']=array();
if(!isset($MusselConfig['virustotal']['vt_public_api_key']))$MusselConfig['virustotal']['vt_public_api_key']='';
if(!isset($MusselConfig['virustotal']['vt_suspicion_level']))$MusselConfig['virustotal']['vt_suspicion_level']=1;
if(!isset($MusselConfig['virustotal']['vt_weighting']))$MusselConfig['virustotal']['vt_weighting']=0;
if(!isset($MusselConfig['virustotal']['vt_quota_rate']))$MusselConfig['virustotal']['vt_quota_rate']=4;
if(!isset($MusselConfig['virustotal']['vt_quota_time']))$MusselConfig['virustotal']['vt_quota_time']=1;
if(!isset($MusselConfig['urlscanner']))$MusselConfig['urlscanner']=array();
if(!isset($MusselConfig['urlscanner']['urlscanner']))$MusselConfig['urlscanner']['urlscanner']=true;
if(!isset($MusselConfig['urlscanner']['lookup_hphosts']))$MusselConfig['urlscanner']['lookup_hphosts']=true;
if(!isset($MusselConfig['urlscanner']['google_api_key']))$MusselConfig['urlscanner']['google_api_key']='';
if(!isset($MusselConfig['urlscanner']['maximum_api_lookups']))$MusselConfig['urlscanner']['maximum_api_lookups']=10;
if(!isset($MusselConfig['urlscanner']['maximum_api_lookups_response']))$MusselConfig['urlscanner']['maximum_api_lookups_response']=false;
if(!isset($MusselConfig['urlscanner']['cache_time']))$MusselConfig['urlscanner']['cache_time']=3600;
if(!isset($MusselConfig['template_data']))$MusselConfig['template_data']=array();
if(!isset($MusselConfig['template_data']['css_url']))$MusselConfig['template_data']['css_url']='';

$cli_args=array(isset($argv[0])?$argv[0]:'',isset($argv[1])?$argv[1]:'',isset($argv[2])?$argv[2]:'',isset($argv[3])?$argv[3]:'');
if(!$MusselConfig['general']['disable_cli']&&function_exists('phpMusselFork'))
    {
    if($cli_args[1]=='cli_win_scan')
        {
        $cmd=strtolower((substr_count($cli_args[2],' '))?substrbf($cli_args[2],' '):$cli_args[2]);
        if($cmd=='scan')
            {
            if($MusselConfig['general']['scan_cache_expiry'])
                {
                $HashCache=phpMusselCacheGet('HashCache');
                if(empty($HashCache))$HashCache=array();
                else
                    {
                    $HashCache=explode(';',$HashCache);
                    $HashCacheN=array();
                    $HashCacheC=count($HashCache);
                    for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
                        {
                        if(substr_count($HashCache[$HashCacheI],':'))
                            {
                            $HashCache[$HashCacheI]=explode(':',$HashCache[$HashCacheI],4);
                            if(!($time>$HashCache[$HashCacheI][1]))$HashCacheN[$HashCache[$HashCacheI][0]]=$HashCache[$HashCacheI];
                            }
                        }
                    $HashCache=$HashCacheN;
                    unset($HashCacheN);
                    }
                }
            echo phpMusselR(substr($cli_args[2],5),true,true,0,$cli_args[3]);
            if(isset($MusselPlugins['hookcounts']['after_scan']))if($MusselPlugins['hookcounts']['after_scan']>0)
                {
                $MusselPlugins['tempdata']=array();
                reset($MusselPlugins['hooks']['after_scan']);
                for($MusselPlugins['tempdata']['i']=0;$MusselPlugins['tempdata']['i']<$MusselPlugins['hookcounts']['after_scan'];$MusselPlugins['tempdata']['i']++)
                    {
                    $MusselPlugins['tempdata']['k']=key($MusselPlugins['hooks']['after_scan']);
                    if(!is_array($MusselPlugins['hooks']['after_scan'][$MusselPlugins['tempdata']['k']]))$MusselPlugins['hooks']['after_scan'][$MusselPlugins['tempdata']['k']]=array(0=>$MusselPlugins['hooks']['after_scan'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['kc']=count($MusselPlugins['hooks']['after_scan'][$MusselPlugins['tempdata']['k']]);
                    $MusselPlugins['tempdata']['varsfeed']=array();
                    for($MusselPlugins['tempdata']['ki']=0;$MusselPlugins['tempdata']['ki']<$MusselPlugins['tempdata']['kc'];$MusselPlugins['tempdata']['ki']++)
                        {
                        $x=$MusselPlugins['hooks']['after_scan'][$MusselPlugins['tempdata']['k']][$MusselPlugins['tempdata']['ki']];
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
                    next($MusselPlugins['hooks']['after_scan']);
                    }
                }
            if($MusselConfig['general']['scan_cache_expiry'])
                {
                reset($HashCache);
                $HashCacheC=count($HashCache);
                for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
                    {
                    $HashCacheK=key($HashCache);
                    if(is_array($HashCache[$HashCacheK]))$HashCache[$HashCacheK]=implode(':',$HashCache[$HashCacheK]).';';
                    next($HashCache);
                    }
                $HashCache=implode('',$HashCache);
                $HashCache=phpMusselCacheSet('HashCache',$time+$MusselConfig['general']['scan_cache_expiry'],$HashCache);
                }
            die;
            }
        if($cmd=='md5_file')
            {
            $stl=substr($cli_args[2],strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'"'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('md5_file '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $hashme=@phpMusselFile($stl,0,true);
                echo md5($hashme).':'.strlen($hashme).':YOUR-SIGNATURE-NAME'.$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        if($cmd=='coex_file')
            {
            $stl=substr($cli_args[2],strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('coex_file '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $hashme=@phpMusselFile($stl,0,true);
                echo '$md5:'.md5($hashme).';$sha:'.sha1($hashme).';$str_len:'.strlen($hashme).';YOUR-SIGNATURE-NAME'.$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        if($cmd=='pe_meta')
            {
            $stl=substr($cli_args[2],strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('pe_meta '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $hashme=@phpMusselFile($stl,0,true);
                if(substr($hashme,0,2)==='MZ')
                    {
                    $PEArr=array();
                    $PEArr['Len']=strlen($hashme);
                    $PEArr['Offset']=@unpack('S',substr($hashme,60,4));
                    $PEArr['Offset']=$PEArr['Offset'][1];
                    while(true)
                        {
                        $PEArr['DoScan']=true;
                        if($PEArr['Offset']<1||$PEArr['Offset']>16384||$PEArr['Offset']>$PEArr['Len'])
                            {
                            $PEArr['DoScan']=false;
                            break;
                            }
                        $PEArr['Magic']=@substr($hashme,$PEArr['Offset'],2);
                        if($PEArr['Magic']!=='PE')
                            {
                            $PEArr['DoScan']=false;
                            break;
                            }
                        $PEArr['Proc']=@unpack('S',substr($hashme,$PEArr['Offset']+4,2));
                        $PEArr['Proc']=$PEArr['Proc'][1];
                        if($PEArr['Proc']!=0x14c&&$PEArr['Proc']!=0x8664)
                            {
                            $PEArr['DoScan']=false;
                            break;
                            }
                        $PEArr['NumOfSections']=@unpack('S',substr($hashme,$PEArr['Offset']+6,2));
                        $PEArr['NumOfSections']=$PEArr['NumOfSections'][1];
                        if($PEArr['NumOfSections']<1||$PEArr['NumOfSections']>40)$PEArr['DoScan']=false;
                        break;
                        }
                    if(!$PEArr['DoScan'])
                        {
                        echo $MusselConfig['lang']['cli_pe1'].$linebreak;
                        }
                    else
                        {
                        $PEArr['OptHdrSize']=@unpack('S',substr($hashme,$PEArr['Offset']+20,2));
                        $PEArr['OptHdrSize']=$PEArr['OptHdrSize'][1];
                        echo $MusselConfig['lang']['cli_pe2'].$linebreak;
                        for($PEArr['k']=0;$PEArr['k']<$PEArr['NumOfSections'];$PEArr['k']++)
                            {
                            $PEArr['SectionHead']=substr($hashme,$PEArr['Offset']+24+$PEArr['OptHdrSize']+($PEArr['k']*40),$PEArr['NumOfSections']*40);
                            $PEArr['SectionName']=str_ireplace("\x00",'',substr($PEArr['SectionHead'],0,8));
                            $PEArr['VirtualSize']=@unpack('S',substr($PEArr['SectionHead'],8,4));
                            $PEArr['VirtualSize']=$PEArr['VirtualSize'][1];
                            $PEArr['VirtualAddress']=@unpack('S',substr($PEArr['SectionHead'],12,4));
                            $PEArr['VirtualAddress']=$PEArr['VirtualAddress'][1];
                            $PEArr['SizeOfRawData']=@unpack('S',substr($PEArr['SectionHead'],16,4));
                            $PEArr['SizeOfRawData']=$PEArr['SizeOfRawData'][1];
                            $PEArr['PointerToRawData']=@unpack('S',substr($PEArr['SectionHead'],20,4));
                            $PEArr['PointerToRawData']=$PEArr['PointerToRawData'][1];
                            $PEArr['SectionData']=@substr($hashme,$PEArr['PointerToRawData'],$PEArr['SizeOfRawData']);
                            $PEArr['MD5']=md5($PEArr['SectionData']);
                            echo $PEArr['SizeOfRawData'].':'.$PEArr['MD5'].':'.$PEArr['SectionName'].$linebreak;
                            }
                        echo $linebreak;
                        if(substr_count($hashme,"V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24"))
                            {
                            $PEArr['FINFO']=substral($hashme,"V\x00a\x00r\x00F\x00i\x00l\x00e\x00I\x00n\x00f\x00o\x00\x00\x00\x00\x00\x24");
                            if(substr_count($PEArr['FINFO'],"F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"F\x00i\x00l\x00e\x00D\x00e\x00s\x00c\x00r\x00i\x00p\x00t\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PEFileDescription:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"F\x00i\x00l\x00e\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PEFileVersion:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00N\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PEProductName:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"P\x00r\x00o\x00d\x00u\x00c\x00t\x00V\x00e\x00r\x00s\x00i\x00o\x00n\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PEProductVersion:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"L\x00e\x00g\x00a\x00l\x00C\x00o\x00p\x00y\x00r\x00i\x00g\x00h\x00t\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PECopyright:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"O\x00r\x00i\x00g\x00i\x00n\x00a\x00l\x00F\x00i\x00l\x00e\x00n\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PEOriginalFilename:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            if(substr_count($PEArr['FINFO'],"C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00"))
                                {
                                $PEArr['ThisData']=trim(str_ireplace("\x00",'',substrbf(substral($PEArr['FINFO'],"C\x00o\x00m\x00p\x00a\x00n\x00y\x00N\x00a\x00m\x00e\x00\x00\x00"),"\x00\x00\x00")));
                                echo '$PECompanyName:'.md5($PEArr['ThisData']).':'.strlen($PEArr['ThisData']).':YOUR-SIGNATURE-NAME'.$linebreak;
                                }
                            }
                        }
                    $PEArr=false;
                    }
                else echo $MusselConfig['lang']['cli_pe1'].$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        die;
        }
    }

/**
 * This is the core scanning function of phpMussel, responsible for initialising the scanning performed by phpMussel
 * for most circumstances. It's the function that generally should be called whenever phpMussel is required by external
 * scripts, apps, CMS, etc.
 *
 * Please refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB SERVERS)", for more information.
 *
 * @param string|array $f Indicates which file, files, directory and/or directories to scan (can be a string, an array, or a multidimensional array).
 * @param bool $n A boolean, indicating the format for the scan results to be returned as. False instructs the function to return the results as an integer; True instructs the function to return the results as human readable text. Optional; Defaults to false.
 * @param bool $zz A boolean, indicating to the function whether or not arrayed results should be imploded prior to being returned to the calling function. False instructs the function to return the arrayed results as verbatim; True instructs the function to return the arrayed results as an imploded string. Optional; Defaults to false.
 * @param int $dpt Represents the current depth of recursion from which the function has been called. `phpMusselD()` and `phpMusselR()` use this information for determining how much they should indent any entries they generate for logging and for the display of scan results in CLI mode (you should never manually set this parameter yourself).
 * @param string $ofn In the context of the initial file upload scanning that phpMussel performs when operating via a server, this parameter (a string) represents the "original filename" of the file being scanned (the original filename, in this context, referring to the name of the file being scanned as per supplied by the upload client, as opposed to the temporary filename assigned by the server or any other filename). When operating in the context of CLI mode, both $f and $ofn represent the scan target, as per specified by the CLI operator; The only difference between the two is when the scan target is a directory, rather than a single file; $f will represent the full path to the file (so, directory plus filename), whereas $ofn will represent only the filename.
 * @return bool|int|string|array The scan results, returned as an array when the $f parameter is an array and when $n and/or $zz is/are false, and otherwise returned as per described by the README documentation. The function may also die the script and return nothing, if something goes wrong, such as if the function is triggered in the absense of the required $memCache variable being set, and may also return false, in the absense of the required $HashCache variable being set.
 */
function phpMussel($f='',$n=false,$zz=false,$dpt=0,$ofn='')
    {
    if(!isset($GLOBALS['memCache']))
        {
        echo (!isset($GLOBALS['MusselConfig']['lang']['required_variables_not_defined']))?'[phpMussel] Required variables aren\'t defined: Can\'t continue.':'[phpMussel] '.$GLOBALS['MusselConfig']['lang']['required_variables_not_defined'];
        die;
        }
    if($GLOBALS['memCache']['eof'])
        {
        $GLOBALS['HashCache']=($GLOBALS['MusselConfig']['general']['scan_cache_expiry']>0)?phpMusselCacheGet('HashCache'):array();
        if(!empty($GLOBALS['HashCache']))
            {
            $GLOBALS['HashCache']=explode(';',$GLOBALS['HashCache']);
            $HashCacheN=array();
            $HashCacheC=count($GLOBALS['HashCache']);
            for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
                {
                if(substr_count($GLOBALS['HashCache'][$HashCacheI],':'))
                    {
                    $GLOBALS['HashCache'][$HashCacheI]=explode(':',$GLOBALS['HashCache'][$HashCacheI],4);
                    if(!($GLOBALS['time']>$GLOBALS['HashCache'][$HashCacheI][1]))$HashCacheN[$GLOBALS['HashCache'][$HashCacheI][0]]=$GLOBALS['HashCache'][$HashCacheI];
                    }
                }
            $GLOBALS['HashCache']=$HashCacheN;
            unset($HashCacheN);
            }
        }
    if(!isset($GLOBALS['HashCache']))return false;
    if(!$ofn)$ofn=$f;
    $xst=time();
    $xst2822=date('r',$xst);
    $r=phpMusselR($f,$n,$zz,$dpt,$ofn);
    $xet=time();
    $xet2822=date('r',$xet);
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['after_scan']))if($GLOBALS['MusselPlugins']['hookcounts']['after_scan']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['after_scan']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['after_scan'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['after_scan']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['after_scan'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['after_scan'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['after_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['after_scan'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['after_scan'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['after_scan']);
            }
        }
    if($GLOBALS['MusselConfig']['general']['scan_log']&&$n&&!is_array($r))
        {
        $r=$xst2822.' '.$GLOBALS['MusselConfig']['lang']['started'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'].$r.$xet2822.' '.$GLOBALS['MusselConfig']['lang']['finished'].$GLOBALS['MusselConfig']['lang']['_fullstop_final'].$GLOBALS['linebreak'].$GLOBALS['linebreak'];
        if(!file_exists($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log']))$r=$GLOBALS['phpmusselsafety'].$GLOBALS['linebreak'].$GLOBALS['linebreak'].$r;
        $xf=fopen($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log'],'a');
        fwrite($xf,$r);
        fclose($xf);
        }
    if($GLOBALS['memCache']['eof'])
        {
        if($GLOBALS['MusselConfig']['general']['scan_cache_expiry']>0)
            {
            reset($GLOBALS['HashCache']);
            $HashCacheC=count($GLOBALS['HashCache']);
            for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
                {
                $HashCacheK=key($GLOBALS['HashCache']);
                if(is_array($GLOBALS['HashCache'][$HashCacheK]))$GLOBALS['HashCache'][$HashCacheK]=implode(':',$GLOBALS['HashCache'][$HashCacheK]).';';
                next($GLOBALS['HashCache']);
                }
            $GLOBALS['HashCache']=implode('',$GLOBALS['HashCache']);
            $GLOBALS['HashCache']=phpMusselCacheSet('HashCache',$GLOBALS['time']+$GLOBALS['MusselConfig']['general']['scan_cache_expiry'],$GLOBALS['HashCache']);
            unset($GLOBALS['HashCache']);
            }
        if(!empty($GLOBALS['whyflagged'])&&$GLOBALS['MusselConfig']['general']['scan_log_serialized'])
            {
            $handle=array();
            $handle['whyflagged']=trim($GLOBALS['whyflagged']);
            $handle['s']=serialize(array('start_time'=>$xst,'end_time'=>$xet,'origin'=>$_SERVER[$GLOBALS['MusselConfig']['general']['ipaddr']],'objects_scanned'=>$GLOBALS['memCache']['objects_scanned'],'detections_count'=>$GLOBALS['memCache']['detections_count'],'scan_errors'=>$GLOBALS['memCache']['scan_errors'],'detections'=>$handle['whyflagged'])).$GLOBALS['linebreak'];
            $handle['f']=fopen($GLOBALS['vault'].$GLOBALS['MusselConfig']['general']['scan_log_serialized'],'a');
            fwrite($handle['f'],$handle['s']);
            fclose($handle['f']);
            }
        }
    return $r;
    }

/**
 * This is an additional scanning function that can be used for scanning email messages, forum posts, contact form
 * messages and other similar such things, and is unrelated to the core scanning function of phpMussel. The function is
 * unused by phpMussel itself, not being called anywhere in any contexts, but exists here nonetheless for the benefit
 * of those that may wish to use it within their scripts, apps, CMS, etc.
 *
 * Please refer to Section 3A of the README documentation, "HOW TO USE (FOR WEB SERVERS)", for more information.
 *
 * @param string $body The actual content (email message, forum post, etc) that you wish to scan (must be a string).
 * @return int|string If any error occurs preventing the function from completing its scan, a value of -1 (integer) will be returned. If the function completes its scan and doesn't match anything, a value of 0 (integer) will be returned. If, however, the function does match something, a string will be returned containing a message citing what has been matched.
 */
function phpMussel_mail($body='')
    {
    if(!$len=strlen($body))return -1;
    if(!isset($GLOBALS['memCache']['greylist']))
        {
        if(!file_exists($GLOBALS['vault'].'greylist.csv'))
            {
            $GLOBALS['memCache']['greylist']=',';
            $glf=fopen($GLOBALS['vault'].'greylist.csv','a');
            fwrite($glf,',');
            fclose($glf);
            unset($glf);
            }
        else $GLOBALS['memCache']['greylist']=phpMusselFile($GLOBALS['vault'].'greylist.csv');
        }
    $f='';
    $hex=@bin2hex($body);
    $hexlc=@bin2hex(strtolower($body));
    $hexlen=strlen($hexlc);
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['before_scan_mail']))if($GLOBALS['MusselPlugins']['hookcounts']['before_scan_mail']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['before_scan_mail']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['before_scan_mail'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['before_scan_mail']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['before_scan_mail'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['before_scan_mail'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['before_scan_mail'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['before_scan_mail'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['before_scan_mail'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['before_scan_mail']);
            }
        }
    if($GLOBALS['MusselConfig']['signatures']['mail_clamav'])
        {
        while(true)
            {
            if(!isset($GLOBALS['memCache']['mail_clamav_standard.cvd']))$GLOBALS['memCache']['mail_clamav_standard.cvd']=@file($GLOBALS['vault'].'mail_clamav_standard.cvd');
            if(!$GLOBALS['memCache']['mail_clamav_standard.cvd'])
                {
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                break;
                }
            if(!isset($GLOBALS['memCache']['mail_clamav_standard.map']))$GLOBALS['memCache']['mail_clamav_standard.map']=@file($GLOBALS['vault'].'mail_clamav_standard.map');
            if(!$GLOBALS['memCache']['mail_clamav_standard.map'])
                {
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                break;
                }
            $c=@count($GLOBALS['memCache']['mail_clamav_standard.map']);
            for($i=0;$i<$c;$i++)
                {
                $map=explode(':',$GLOBALS['memCache']['mail_clamav_standard.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($hex,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['mail_clamav_standard.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if($hexlen<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                                $xsigc=count($xsig);
                                $this_str=$hex;
                                $this_strlc=$hexlc;
                                if($xstrf=='A')
                                    {
                                    $this_str="\x01".$this_str;
                                    $this_strlc="\x01".$this_strlc;
                                    $xsig[0]="\x01".$xsig[0];
                                    }
                                else if($xstrf!='*')
                                    {
                                    $this_str=substr($this_str,$xstrf*2);
                                    $this_strlc=substr($this_strlc,$xstrf*2);
                                    }
                                if($xstrt!='*')
                                    {
                                    $this_str=substr($this_str,0,$xstrt*2);
                                    $this_strlc=substr($this_strlc,0,$xstrt*2);
                                    }
                                for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                    {
                                    if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_strlc,$xsig[$xsigi]))continue 2;
                                    if($xsigc>1)
                                        {
                                        if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                        if(substr_count($this_strlc,$xsig[$xsigi]))$this_strlc=substraf($this_strlc,$xsig[$xsigi].'>');
                                        }
                                    }
                                $this_strlc=$this_str=false;
                                $f.=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        while(true)
            {
            if(!isset($GLOBALS['memCache']['mail_clamav_regex.cvd']))$GLOBALS['memCache']['mail_clamav_regex.cvd']=@file($GLOBALS['vault'].'mail_clamav_regex.cvd');
            if(!$GLOBALS['memCache']['mail_clamav_regex.cvd'])
                {
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                break;
                }
            if(!isset($GLOBALS['memCache']['mail_clamav_regex.map']))$GLOBALS['memCache']['mail_clamav_regex.map']=@file($GLOBALS['vault'].'mail_clamav_regex.map');
            if(!$GLOBALS['memCache']['mail_clamav_regex.map'])
                {
                if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                break;
                }
            $c=@count($GLOBALS['memCache']['mail_clamav_regex.map']);
            for($i=0;$i<$c;$i++)
                {
                $map=explode(':',$GLOBALS['memCache']['mail_clamav_regex.map'][$i]);
                $map[2]=(int)$map[2];
                if(substr_count($hex,$map[0])>0)
                    {
                    for($xind=$map[1];$xind<($map[2]+1);$xind++)
                        {
                        $xsig=$GLOBALS['memCache']['mail_clamav_regex.cvd'][$xind];
                        if(substr_count($xsig,':')>0)
                            {
                            $vn=@explode(':',$xsig);
                            $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                            $xsig=($xsig===false?'':implode('',$xsig));
                            $xlen=strlen($xsig);
                            if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                            $xstrf=(isset($vn[2]))?$vn[2]:'*';
                            $xstrt=(isset($vn[3]))?$vn[3]:'*';
                            $vn=vn_shorthand($vn[0]);
                            if($hexlen<$xlen)continue;
                            if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                                {
                                if($xstrf=='*')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',$hex)&&!preg_match('/'.$xsig.'/i',$hexlc))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,0,$xstrt*2)))continue;
                                    }
                                else if($xstrf=='A')
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/\A'.$xsig.'/i',$hex)&&!preg_match('/\A'.$xsig.'/i',$hexlc))continue;
                                        }
                                    else if(!preg_match('/\A'.$xsig.'/i',substr($hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($hexlc,0,$xstrt*2)))continue;
                                    }
                                else
                                    {
                                    if($xstrt=='*')
                                        {
                                        if(!preg_match('/'.$xsig.'/i',substr($hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,$xstrf*2)))continue;
                                        }
                                    else if(!preg_match('/'.$xsig.'/i',substr($hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,$xstrf*2,$xstrt*2)))continue;
                                    }
                                $f.=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                                }
                            }
                        }
                    }
                }
            break;
            }
        }
    for($SigSet=0;$SigSet<2;$SigSet++)
        {
        $SigDo=$SigFileRX=$SigFileSD=false;
        if($SigSet===0)
            {
            if($GLOBALS['MusselConfig']['signatures']['mail_custom'])
                {
                $SigFileSD='mail_custom_standard.cvd';
                $SigFileRX='mail_custom_regex.cvd';
                $SigDo=true;
                }
            }
        else if($SigSet===1)
            {
            if($GLOBALS['MusselConfig']['signatures']['mail_mussel'])
                {
                $SigFileSD='mail_mussel_standard.cvd';
                $SigFileRX='mail_mussel_regex.cvd';
                $SigDo=true;
                }
            }
        if($SigDo)
            {
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigFileSD]))$GLOBALS['memCache'][$SigFileSD]=@file($GLOBALS['vault'].$SigFileSD);
                if(!$GLOBALS['memCache'][$SigFileSD])
                    {
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigFileSD]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigFileSD][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='STR')
                            {
                            if(!substr_count($hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-LC')
                            {
                            if(!substr_count($hexlc,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-RX-LC')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$hexlc))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[^a-fA-F0-9>]+/i',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['sd_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['sd_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        if($hexlen<$xlen)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            $xsig=@(substr_count($xsig,'>')>0)?explode('>',$xsig):array(0=>$xsig);
                            $xsigc=count($xsig);
                            $this_str=$hex;
                            $this_strlc=$hexlc;
                            if($xstrf=='A')
                                {
                                $this_str="\x01".$this_str;
                                $this_strlc="\x01".$this_strlc;
                                $xsig[0]="\x01".$xsig[0];
                                }
                            else if($xstrf!='*')
                                {
                                $this_str=substr($this_str,$xstrf*2);
                                $this_strlc=substr($this_strlc,$xstrf*2);
                                }
                            if($xstrt!='*')
                                {
                                $this_str=substr($this_str,0,$xstrt*2);
                                $this_strlc=substr($this_strlc,0,$xstrt*2);
                                }
                            for($xsigi=0;$xsigi<$xsigc;$xsigi++)
                                {
                                if(!substr_count($this_str,$xsig[$xsigi])&&!substr_count($this_strlc,$xsig[$xsigi]))continue 2;
                                if($xsigc>1)
                                    {
                                    if(substr_count($this_str,$xsig[$xsigi]))$this_str=substraf($this_str,$xsig[$xsigi].'>');
                                    if(substr_count($this_strlc,$xsig[$xsigi]))$this_strlc=substraf($this_strlc,$xsig[$xsigi].'>');
                                    }
                                }
                            $this_strlc=$this_str=false;
                            $f.=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        }
                    }
                break;
                }
            while(true)
                {
                if(!isset($GLOBALS['memCache'][$SigFileRX]))$GLOBALS['memCache'][$SigFileRX]=@file($GLOBALS['vault'].$SigFileRX);
                if(!$GLOBALS['memCache'][$SigFileRX])
                    {
                    if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
                    break;
                    }
                $c=@count($GLOBALS['memCache'][$SigFileRX]);
                for($i=0;$i<$c;$i++)
                    {
                    $xsig=$GLOBALS['memCache'][$SigFileRX][$i];
                    if(substr($xsig,0,1)=='>')
                        {
                        $xsig=explode('>',$xsig,4);
                        $xsig[3]=(int)$xsig[3];
                        if($xsig[1]=='STR')
                            {
                            if(!substr_count($hex,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-LC')
                            {
                            if(!substr_count($hexlc,$xsig[2]))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-RX')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$hex))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if($xsig[1]=='STR-RX-LC')
                            {
                            if(!preg_match('/'.$xsig[2].'/i',$hexlc))
                                {
                                if($xsig[3]<=$i)break;
                                $i=$xsig[3]-1;
                                }
                            }
                        else if(substr($xsig[1],0,1)=='$')
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
                    if(substr_count($xsig,':')>0)
                        {
                        $vn=@explode(':',$xsig);
                        $xsig=@preg_split('/[\x00-\x1f]+/',$vn[1],-1,PREG_SPLIT_NO_EMPTY);
                        $xsig=($xsig===false?'':implode('',$xsig));
                        $xlen=strlen($xsig);
                        if($xlen<$GLOBALS['MusselConfig']['signatures']['rx_siglen_min']||$xlen>$GLOBALS['MusselConfig']['signatures']['rx_siglen_max'])continue;
                        $xstrf=(isset($vn[2]))?$vn[2]:'*';
                        $xstrt=(isset($vn[3]))?$vn[3]:'*';
                        $vn=vn_shorthand($vn[0]);
                        if($hexlen<$xlen)continue;
                        if(!substr_count($GLOBALS['memCache']['greylist'],','.$vn.',')&&!$GLOBALS['memCache']['ignoreme'])
                            {
                            if($xstrf=='*')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',$hex)&&!preg_match('/'.$xsig.'/i',$hexlc))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($hex,0,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,0,$xstrt*2)))continue;
                                }
                            else if($xstrf=='A')
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/\A'.$xsig.'/i',$hex)&&!preg_match('/\A'.$xsig.'/i',$hexlc))continue;
                                    }
                                else if(!preg_match('/\A'.$xsig.'/i',substr($hex,0,$xstrt*2))&&!preg_match('/\A'.$xsig.'/i',substr($hexlc,0,$xstrt*2)))continue;
                                }
                            else
                                {
                                if($xstrt=='*')
                                    {
                                    if(!preg_match('/'.$xsig.'/i',substr($hex,$xstrf*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,$xstrf*2)))continue;
                                    }
                                else if(!preg_match('/'.$xsig.'/i',substr($hex,$xstrf*2,$xstrt*2))&&!preg_match('/'.$xsig.'/i',substr($hexlc,$xstrf*2,$xstrt*2)))continue;
                                }
                            $f.=phpMusselV(array('vn'=>$vn),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                            }
                        }
                    }
                break;
                }
            }
        }
    // AAA urlscanner functionality for phpMussel_mail() BEGIN
    if($GLOBALS['MusselConfig']['urlscanner']['urlscanner'])
        {
        $norm=@prescan_normalise($body);
        $normlen=strlen($norm);
        }
    else $normlen=0;
    if($normlen)
        {
        $urlscanner=array();
        $urlscanner['req_c']=$urlscanner['domains_c']=$urlscanner['urls_c']=0;
        if(!isset($GLOBALS['memCache']['urlscanner.cvd']))$GLOBALS['memCache']['urlscanner.cvd']=phpMusselFile($GLOBALS['vault'].'urlscanner.cvd');
        if(!$GLOBALS['memCache']['urlscanner.cvd'])
            {
            if(!$GLOBALS['MusselConfig']['signatures']['fail_silently'])return -1;
            }
        else
            {
            $urlscanner['domains_p']=array();
            $urlscanner['domains']=array();
            $urlscanner['tlds']=array();
            $urlscanner['z']=0;
            $urlscanner['c']=preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([0-9a-z.-]{1,512})[^0-9a-z.-]/i',$norm,$urlscanner['m']);
            for($urlscanner['i']=0;$urlscanner['c']>$urlscanner['i'];$urlscanner['i']++)
                {
                $urlscanner['domains_p'][$urlscanner['z']]=$urlscanner['m'][3][$urlscanner['i']];
                if(substr_count($urlscanner['domains_p'][$urlscanner['z']],'.'))$urlscanner['tlds'][$urlscanner['z']]=substral($urlscanner['domains_p'][$urlscanner['z']],'.');
                $urlscanner['domains'][$urlscanner['z']]='DOMAIN:'.md5($urlscanner['m'][3][$urlscanner['i']]).':'.strlen($urlscanner['m'][3][$urlscanner['i']]).':';
                $urlscanner['z']++;
                }
            $urlscanner['m']='';
            $urlscanner['domains_p']=array_unique($urlscanner['domains_p']);
            $urlscanner['domains']=array_unique($urlscanner['domains']);
            $urlscanner['tlds']=array_unique($urlscanner['tlds']);
            sort($urlscanner['domains_p']);
            sort($urlscanner['domains']);
            sort($urlscanner['tlds']);
            $urlscanner['tldc']=count($urlscanner['tlds']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['tldc'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],'TLD:'.$urlscanner['tlds'][$urlscanner['i']].':'))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],'TLD:'.$urlscanner['tlds'][$urlscanner['i']].':');
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        $f.=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                }
            $urlscanner['domains_c']=count($urlscanner['domains']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['domains_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['domains'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['domains'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        $f.=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                }
            $xsig='';
            $urlscanner['urls_p']=array();
            $urlscanner['urls']=array();
            $urlscanner['queries']=array();
            $urlscanner['z']=0;
            $urlscanner['c']=preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4000})(\&quot;|[;"\'\(\)\[\]\{\}])/i',$norm,$urlscanner['m']);
            for($urlscanner['i']=0;$urlscanner['c']>$urlscanner['i'];$urlscanner['i']++)
                {
                $urlscanner['urls_p'][$urlscanner['z']]=$urlscanner['m'][3][$urlscanner['i']];
                $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['m'][3][$urlscanner['i']]).':'.strlen($urlscanner['m'][3][$urlscanner['i']]).':';
                $urlscanner['z']++;
                if(preg_match('/[^0-9a-z.-]$/i',$urlscanner['m'][3][$urlscanner['i']]))
                    {
                    $urlscanner['x']=preg_replace('/[^0-9a-z.-]+$/i','',$urlscanner['m'][3][$urlscanner['i']]);
                    $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['z']++;
                    }
                if(substr_count($urlscanner['m'][3][$urlscanner['i']],'?'))
                    {
                    $urlscanner['x']=substrbf($urlscanner['m'][3][$urlscanner['i']],'?');
                    $urlscanner['urls'][$urlscanner['z']]='URL:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['x']=substraf($urlscanner['m'][3][$urlscanner['i']],'?');
                    $urlscanner['queries'][$urlscanner['z']]='QUERY:'.md5($urlscanner['x']).':'.strlen($urlscanner['x']).':';
                    $urlscanner['z']++;
                    }
                }
            $urlscanner['m']='';
            $urlscanner['urls_p']=array_unique($urlscanner['urls_p']);
            $urlscanner['urls']=array_unique($urlscanner['urls']);
            $urlscanner['queries']=array_unique($urlscanner['queries']);
            sort($urlscanner['urls_p']);
            sort($urlscanner['urls']);
            sort($urlscanner['queries']);
            $urlscanner['urls_c']=count($urlscanner['urls']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['urls_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['urls'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['urls'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        $f.=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                }
            $urlscanner['queries_c']=count($urlscanner['queries']);
            for($urlscanner['i']=0;$urlscanner['i']<$urlscanner['queries_c'];$urlscanner['i']++)
                {
                if(substr_count($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['queries'][$urlscanner['i']]))
                    {
                    $xsig=substraf($GLOBALS['memCache']['urlscanner.cvd'],$urlscanner['queries'][$urlscanner['i']]);
                    if(substr_count($xsig,$GLOBALS['linebreak']))$xsig=substrbf($xsig,$GLOBALS['linebreak']);
                    $xsig=vn_shorthand($xsig);
                    if($xsig&&!substr_count($GLOBALS['memCache']['greylist'],','.$xsig.',')&&!$GLOBALS['memCache']['ignoreme'])
                        {
                        $f.=phpMusselV(array('vn'=>$xsig),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                }
            }
        if(!$f&&$GLOBALS['MusselConfig']['urlscanner']['lookup_hphosts']&&$urlscanner['domains_c'])
            {
            if(!isset($GLOBALS['memCache']['urlscanner_domains']))$GLOBALS['memCache']['urlscanner_domains']=phpMusselCacheGet('urlscanner_domains');
            $urlscanner['y']=$GLOBALS['time']+$GLOBALS['MusselConfig']['urlscanner']['cache_time'];
            $urlscanner['req_v']=urlencode($GLOBALS['phpmusselversion']);
            $urlscanner['classes']=array('EMD'=>"\x1a\x82\x10\x1bXXX",'EXP'=>"\x1a\x82\x10\x16XXX",'GRM'=>"\x1a\x82\x10\x32XXX",'HFS'=>"\x1a\x82\x10\x32XXX",'PHA'=>"\x1a\x82\x10\x32XXX",'PSH'=>"\x1a\x82\x10\x31XXX");
            for($i=0;$i<$urlscanner['domains_c'];$i++)
                {
                if($GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups']>0&&$urlscanner['req_c']>$GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups'])
                    {
                    if($GLOBALS['MusselConfig']['urlscanner']['maximum_api_lookups_response'])$f.=$GLOBALS['MusselConfig']['lang']['too_many_urls'].$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    break;
                    }
                if(substr_count($GLOBALS['memCache']['urlscanner_domains'],$urlscanner['domains'][$i]))
                    {
                    $urlscanner['class']=substrbf(substral($GLOBALS['memCache']['urlscanner_domains'],$urlscanner['domains'][$i]),';');
                    $urlscanner['expiry']=substrbf($urlscanner['class'],':');
                    if($urlscanner['expiry']>$GLOBALS['time'])
                        {
                        $urlscanner['class']=substraf($urlscanner['class'],':');
                        if(!$urlscanner['class'])continue;
                        $urlscanner['class']=vn_shorthand($urlscanner['class']);
                        $f.=phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        break;
                        }
                    }
                $urlscanner['req']='v='.$urlscanner['req_v'].'&s='.$urlscanner['domains_p'][$i].'&class=true';
                $urlscanner['req_context']=array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$GLOBALS['phpmusselua'],'content'=>$urlscanner['req'],'timeout'=>12));
                $urlscanner['req_stream']=stream_context_create($urlscanner['req_context']);
                $urlscanner['req_result']=@file_get_contents('http://verify.hosts-file.net/?'.$urlscanner['req'],false,$urlscanner['req_stream']);
                $urlscanner['req_c']++;
                if(substr($urlscanner['req_result'],0,6)=="Listed")
                    {
                    $urlscanner['class']=substr($urlscanner['req_result'],7,3);
                    $urlscanner['class']=(isset($urlscanner['classes'][$urlscanner['class']]))?$urlscanner['classes'][$urlscanner['class']]:"\x1a\x82\x10\x3fXXX";
                    $GLOBALS['memCache']['urlscanner_domains'].=$urlscanner['domains'][$i].$urlscanner['y'].':'.$urlscanner['class'].';';
                    $urlscanner['class']=vn_shorthand($urlscanner['class']);
                    $f.=phpMusselV(array('vn'=>$urlscanner['class']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    break;
                    }
                $GLOBALS['memCache']['urlscanner_domains'].=$urlscanner['domains'][$i].$urlscanner['y'].':;';
                }
            $urlscanner['y']=phpMusselCacheSet('urlscanner_domains',$urlscanner['y'],$GLOBALS['memCache']['urlscanner_domains']);
            }
        if(!$out&&$GLOBALS['MusselConfig']['urlscanner']['google_api_key']&&$urlscanner['urls_c'])
            {
            /* Incomplete code, doesn't work yet.
            $urlscanner['req']=$urlscanner['urls_c'].$GLOBALS['linebreak'].'http://'.implode($GLOBALS['linebreak'].'http://',$urlscanner['urls_p']);
            $urlscanner['req_context']=array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$GLOBALS['phpmusselua'],'content'=>$urlscanner['req'],'timeout'=>12));
            $urlscanner['req_stream']=stream_context_create($urlscanner['req_context']);
            $urlscanner['req_result']=file_get_contents('https://sb-ssl.google.com/safebrowsing/api/lookup?client=phpMussel&key='.$GLOBALS['MusselConfig']['urlscanner']['google_api_key'].'&appver='.$GLOBALS['phpmusselversion_int'].'&pver=3.1',false,$urlscanner['req_stream']);
            $urlscanner['req_c']++;
            $f.=phpMusselV(array('vn'=>$urlscanner['req_result']),$GLOBALS['MusselConfig']['lang']['detected']).$GLOBALS['MusselConfig']['lang']['_exclamation'];
            break;
            */
            }
        unset($urlscanner);
        }
    // AAA urlscanner functionality for phpMussel_mail() END
    if(isset($GLOBALS['MusselPlugins']['hookcounts']['after_scan_mail']))if($GLOBALS['MusselPlugins']['hookcounts']['after_scan_mail']>0)
        {
        $MusselPluginTempData=array();
        reset($GLOBALS['MusselPlugins']['hooks']['after_scan_mail']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$GLOBALS['MusselPlugins']['hookcounts']['after_scan_mail'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($GLOBALS['MusselPlugins']['hooks']['after_scan_mail']);
            if(!is_array($GLOBALS['MusselPlugins']['hooks']['after_scan_mail'][$MusselPluginTempData['k']]))$GLOBALS['MusselPlugins']['hooks']['after_scan_mail'][$MusselPluginTempData['k']]=array(0=>$GLOBALS['MusselPlugins']['hooks']['after_scan_mail'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($GLOBALS['MusselPlugins']['hooks']['after_scan_mail'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$GLOBALS['MusselPlugins']['hooks']['after_scan_mail'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($GLOBALS['MusselPlugins']['hooks']['after_scan_mail']);
            }
        }
    return (!$f)?0:$f;
    }

/**
 * We need to count the number of elements contained by the $_FILES array, to know if there are any file uploads to be
 * scanned during execution of the script.
 */
$c=empty($_FILES)?0:count($_FILES);

/**
 * Initialise $whyflagged (string), $killdata (string) and $pedata (string).
 *
 * Whenever something is detected in a file being scanned, a human-readable description of what has been detected is
 * appended to $whyflagged; This variable contains the "Detected ... !" message you see on the "Upload Denied!" page
 * generated whenever a file upload has been blocked.
 *
 * The $killdata variable contains a hash reference to every file upload blocked and to every file where something has
 * been detected in that file, in the form of "FILE-MD5-HASH:FILESIZE:FILENAME".
 *
 * If the file being scanned happens to be a PE file, in addition to the information appended to $whyflagged and
 * $killdata, reconstructed references to the PE sections of that PE file will be appended to the $pedata variable.
 *
 * If logging is enabled, the information contained by these three variables will all be logged as per the specified by
 * the logging-related directives of the phpMussel configuration file.
 */
$whyflagged=$killdata=$pedata='';

$HashCache=($c>0&&$MusselConfig['general']['scan_cache_expiry']>0)?phpMusselCacheGet('HashCache'):array();
if(!empty($HashCache))
    {
    $HashCache=explode(';',$HashCache);
    $HashCacheN=array();
    $HashCacheC=count($HashCache);
    for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
        {
        if(substr_count($HashCache[$HashCacheI],':'))
            {
            $HashCache[$HashCacheI]=explode(':',$HashCache[$HashCacheI],4);
            if(!($time>$HashCache[$HashCacheI][1]))$HashCacheN[$HashCache[$HashCacheI][0]]=$HashCache[$HashCacheI];
            }
        }
    $HashCache=$HashCacheN;
    unset($HashCacheN);
    }

if($c>0)
    {
    reset($_FILES);
    $memCache['start_time']=time();
    $memCache['FilesData']=array();
    if($MusselConfig['general']['honeypot_mode'])
        {
        $memCache['handle']=array();
        $memCache['handle']['qdata']='== HONEYPOT EVENT =='.$linebreak.'DATE: '.date('r',$memCache['start_time']).$linebreak.'IP ADDRESS: '.$_SERVER[$MusselConfig['general']['ipaddr']].$linebreak.$linebreak;
        }
    for($memCache['FilesData']['i']=0;$memCache['FilesData']['i']<$c;$memCache['FilesData']['i']++)
        {
        $memCache['FilesData']['k']=key($_FILES);
        if(!isset($_FILES[$memCache['FilesData']['k']]['error']))
            {
            next($_FILES);
            continue;
            }
        if(!is_array($_FILES[$memCache['FilesData']['k']]['error']))
            {
            $memCache['FilesData']['FileSet']=array();
            $memCache['FilesData']['FileSet']['name']=array($_FILES[$memCache['FilesData']['k']]['name']);
            $memCache['FilesData']['FileSet']['type']=array($_FILES[$memCache['FilesData']['k']]['type']);
            $memCache['FilesData']['FileSet']['tmp_name']=array($_FILES[$memCache['FilesData']['k']]['tmp_name']);
            $memCache['FilesData']['FileSet']['error']=array($_FILES[$memCache['FilesData']['k']]['error']);
            $memCache['FilesData']['FileSet']['size']=array($_FILES[$memCache['FilesData']['k']]['size']);
            }
        else $memCache['FilesData']['FileSet']=$_FILES[$memCache['FilesData']['k']];
        $memCache['FilesData']['FileSet']['c']=count($memCache['FilesData']['FileSet']['error']);
        for($memCache['FilesData']['FileSet']['i']=0;$memCache['FilesData']['FileSet']['i']<$memCache['FilesData']['FileSet']['c'];$memCache['FilesData']['FileSet']['i']++)
            {
            if(empty($memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']])||empty($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))
                {
                next($_FILES);
                continue;
                }
            if($MusselConfig['compatibility']['ignore_upload_errors'])
                {
                if(!isset($memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['error'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']]))
                    {
                    next($_FILES);
                    continue;
                    }
                if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
                    {
                    $killdata.='-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_limit_exceeded'].' ('.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    }
                if($memCache['FilesData']['FileSet']['error'][$memCache['FilesData']['FileSet']['i']]>0)
                    {
                    next($_FILES);
                    continue;
                    }
                if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
                    {
                    if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))@unlink($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                    next($_FILES);
                    continue;
                    }
                $r=phpMussel($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']],true,true,0,$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']]);
                }
            else if(!isset($memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['error'][$memCache['FilesData']['FileSet']['i']])||!isset($memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']]))
                {
                $killdata.='-UNAUTHORISED-UPLOAD-MISCONFIG-:?:?'.$linebreak;
                $whyflagged.=$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig'];
                }
            else
                {
                if($memCache['FilesData']['FileSet']['error'][$memCache['FilesData']['FileSet']['i']]===1)
                    {
                    $killdata.='---------UPLOAD-ERROR-1---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_1'];
                    if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))@unlink($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                    }
                else if($memCache['FilesData']['FileSet']['error']===2)
                    {
                    $killdata.='---------UPLOAD-ERROR-2---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_2'];
                    if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))@unlink($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                    }
                else if($memCache['FilesData']['FileSet']['error']===3)
                    {
                    $killdata.='---------UPLOAD-ERROR-3---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_3'];
                    }
                else if($memCache['FilesData']['FileSet']['error']===4)
                    {
                    $killdata.='---------UPLOAD-ERROR-4---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_3'];
                    }
                else if($memCache['FilesData']['FileSet']['error']===6)
                    {
                    $killdata.='---------UPLOAD-ERROR-6---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_6'];
                    }
                else if($memCache['FilesData']['FileSet']['error']===7)
                    {
                    $killdata.='---------UPLOAD-ERROR-7---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_7'];
                    }
                else if($memCache['FilesData']['FileSet']['error']===8)
                    {
                    $killdata.='---------UPLOAD-ERROR-8---------:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['upload_error_8'];
                    }
                else if(!is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))
                    {
                    $killdata.='UNAUTHORISED-FILE-UPLOAD-NO-HASH:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                    $whyflagged.=$MusselConfig['lang']['scan_unauthorised_upload'].' ('.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                    }
                else
                    {
                    if($MusselConfig['general']['honeypot_mode']&&$MusselConfig['general']['quarantine_key']&&is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))
                        {
                        $memCache['handle']['odata']=phpMusselFile($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                        $memCache['handle']['len']=strlen($memCache['handle']['odata']);
                        $memCache['handle']['crc']=@hash('crc32b',$memCache['handle']['odata']);
                        $memCache['handle']['qfile']=$time.'-'.md5($MusselConfig['general']['quarantine_key'].$memCache['handle']['crc'].$time);
                        if($memCache['handle']['len']>0&&$memCache['handle']['len']<($MusselConfig['general']['quarantine_max_filesize']*1024))@phpMusselQ($memCache['handle']['odata'],$MusselConfig['general']['quarantine_key'],$_SERVER[$MusselConfig['general']['ipaddr']],$memCache['handle']['qfile']);
                        if($MusselConfig['general']['delete_on_sight'])@unlink($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                        $memCache['handle']['qdata'].='TEMP FILENAME: '.$memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']].$linebreak.'FILENAME: '.urlencode($memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']]).$linebreak.'FILESIZE: '.$memCache['handle']['len'].$linebreak.'MD5: '.md5($memCache['handle']['odata']).$linebreak.'QUARANTINED AS: \'/vault/quarantine/'.$memCache['handle']['qfile'].'.qfu\''.$linebreak.$linebreak;
                        }
                    if($c>$MusselConfig['files']['max_uploads']&&$MusselConfig['files']['max_uploads']>=1)
                        {
                        $killdata.='-UPLOAD-LIMIT-EXCEEDED--NO-HASH-:'.$memCache['FilesData']['FileSet']['size'][$memCache['FilesData']['FileSet']['i']].':'.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].$linebreak;
                        $whyflagged.=$MusselConfig['lang']['upload_limit_exceeded'].' ('.$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']].')'.$GLOBALS['MusselConfig']['lang']['_exclamation'];
                        if($MusselConfig['general']['delete_on_sight']&&is_uploaded_file($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]))@unlink($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']]);
                        next($_FILES);
                        continue;
                        }
                    $r=phpMussel($memCache['FilesData']['FileSet']['tmp_name'][$memCache['FilesData']['FileSet']['i']],true,true,0,$memCache['FilesData']['FileSet']['name'][$memCache['FilesData']['FileSet']['i']]);
                    }
                }
            }
        next($_FILES);
        }
    if($MusselConfig['general']['honeypot_mode']&&$MusselConfig['general']['scan_kills'])
        {
        if(!file_exists($vault.$MusselConfig['general']['scan_kills']))$memCache['handle']['qdata']=$phpmusselsafety.$linebreak.$linebreak.$memCache['handle']['qdata'];
        $memCache['handle']['logfile']=fopen($vault.$MusselConfig['general']['scan_kills'],'a');
        fwrite($memCache['handle']['logfile'],$memCache['handle']['qdata']);
        fclose($memCache['handle']['logfile']);
        $memCache['handle']='';
        }
    if($MusselConfig['general']['scan_cache_expiry']>0)
        {
        reset($HashCache);
        $HashCacheC=count($HashCache);
        for($HashCacheI=0;$HashCacheI<$HashCacheC;$HashCacheI++)
            {
            $HashCacheK=key($HashCache);
            if(is_array($HashCache[$HashCacheK]))$HashCache[$HashCacheK]=implode(':',$HashCache[$HashCacheK]).';';
            next($HashCache);
            }
        $HashCache=implode('',$HashCache);
        $HashCache=phpMusselCacheSet('HashCache',$time+$MusselConfig['general']['scan_cache_expiry'],$HashCache);
        unset($HashCacheK,$HashCacheI,$HashCacheC,$HashCache);
        }
    $memCache['end_time']=time();
    $whyflagged=trim($whyflagged);
    if($MusselConfig['general']['scan_log_serialized'])
        {
        if(!isset($memCache['objects_scanned']))$memCache['objects_scanned']=0;
        if(!isset($memCache['detections_count']))$memCache['detections_count']=0;
        if(!isset($memCache['scan_errors']))$memCache['scan_errors']=1;
        $memCache['handle']=array();
        $memCache['handle']['s']=serialize(array('start_time'=>$memCache['start_time'],'end_time'=>$memCache['end_time'],'origin'=>$_SERVER[$MusselConfig['general']['ipaddr']],'objects_scanned'=>$memCache['objects_scanned'],'detections_count'=>$memCache['detections_count'],'scan_errors'=>$memCache['scan_errors'],'detections'=>$whyflagged)).$linebreak;
        $memCache['handle']['f']=fopen($vault.$MusselConfig['general']['scan_log_serialized'],'a');
        fwrite($memCache['handle']['f'],$memCache['handle']['s']);
        fclose($memCache['handle']['f']);
        $memCache['handle']='';
        }
    unset($memCache['FilesData']);
    reset($_FILES);
    }
if(!empty($whyflagged))
    {
    $memCache['template_file']=(!$MusselConfig['template_data']['css_url'])?'template.html':'template_custom.html';
    $MusselConfig['template_data']['detected']=$whyflagged;
    $MusselConfig['template_data']['phpmusselversion']=$phpmusselversion;
    $MusselConfig['template_data']['xmlLang']=$MusselConfig['general']['lang'];
    if($MusselConfig['general']['scan_kills']&&!empty($killdata))
        {
        $memCache['handle']=array();
        $memCache['handle']['d']=(!file_exists($vault.$MusselConfig['general']['scan_kills']))?$phpmusselsafety.$linebreak.$linebreak:'';
        $memCache['handle']['d'].='DATE: '.date('r').$linebreak.'IP ADDRESS: '.$_SERVER[$MusselConfig['general']['ipaddr']].$linebreak.'== SCAN RESULTS / WHY FLAGGED =='.$linebreak.$whyflagged.$linebreak.'== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) =='.$linebreak.$killdata;
        if($pedata)$memCache['handle']['d'].='== PE SECTIONAL SIGNATURES RECONSTRUCTION (SECTION-SIZE:SECTION-HASH:FILE-NAME--SECTION-NAME) =='.$linebreak.$pedata;
        $memCache['handle']['d'].=$linebreak.$linebreak;
        $memCache['handle']['f']=fopen($vault.$MusselConfig['general']['scan_kills'],'a');
        fwrite($memCache['handle']['f'],$memCache['handle']['d']);
        fclose($memCache['handle']['f']);
        $memCache['handle']='';
        }
    if(!file_exists($vault.$memCache['template_file']))plaintext_echo_die('[phpMussel] '.$MusselConfig['lang']['denied'].' '.$MusselConfig['template_data']['detected']);
    if($MusselConfig['general']['forbid_on_block'])
        {
        header('HTTP/1.0 403 Forbidden');
        header('HTTP/1.1 403 Forbidden');
        header('Status: 403 Forbidden');
        }
    $html=phpMusselV($MusselConfig['lang'],phpMusselV($MusselConfig['template_data'],phpMusselFile($vault.$memCache['template_file'],0,true)));
    if(isset($MusselPlugins['hookcounts']['before_html_out']))if($MusselPlugins['hookcounts']['before_html_out']>0)
        {
        $MusselPluginTempData=array();
        reset($MusselPlugins['hooks']['before_html_out']);
        for($MusselPluginTempData['i']=0;$MusselPluginTempData['i']<$MusselPlugins['hookcounts']['before_html_out'];$MusselPluginTempData['i']++)
            {
            $MusselPluginTempData['k']=key($MusselPlugins['hooks']['before_html_out']);
            if(!is_array($MusselPlugins['hooks']['before_html_out'][$MusselPluginTempData['k']]))$MusselPlugins['hooks']['before_html_out'][$MusselPluginTempData['k']]=array(0=>$MusselPlugins['hooks']['before_html_out'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['kc']=count($MusselPlugins['hooks']['before_html_out'][$MusselPluginTempData['k']]);
            $MusselPluginTempData['varsfeed']=array();
            for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['kc'];$MusselPluginTempData['ki']++)
                {
                $x=$MusselPlugins['hooks']['before_html_out'][$MusselPluginTempData['k']][$MusselPluginTempData['ki']];
                if($x)$MusselPluginTempData['varsfeed'][$MusselPluginTempData['ki']]=(isset($$x))?$$x:$x;
                }
            $MusselPluginTempData['out']=call_user_func($MusselPluginTempData['k'],$MusselPluginTempData['varsfeed']);
            if(is_array($MusselPluginTempData['out']))
                {
                $MusselPluginTempData['outs']=count($MusselPluginTempData['out']);
                for($MusselPluginTempData['ki']=0;$MusselPluginTempData['ki']<$MusselPluginTempData['outs'];$MusselPluginTempData['ki']++)
                    {
                    $x=key($MusselPluginTempData['out']);
                    $$x=$MusselPluginTempData['out'][$x];
                    next($x);
                    }
                }
            next($MusselPlugins['hooks']['before_html_out']);
            }
        }
    die($html);
    }
if(!$MusselConfig['general']['disable_cli']&&function_exists('phpMusselFork')&&strlen(mussel_php)>0&&mussel_os=='WIN'&&mussel_sapi=='cli')
    {
    echo $MusselConfig['lang']['cli_ln1'].$MusselConfig['lang']['cli_ln2'].$MusselConfig['lang']['cli_ln3'];
    $sth=fopen('php://stdin','r');
    while(true)
        {
        if(function_exists('cli_set_process_title'))@cli_set_process_title($phpmusselversion);
        echo $MusselConfig['lang']['cli_prompt'];
        $stl=trim(fgets($sth));
        if(function_exists('cli_set_process_title'))@cli_set_process_title($phpmusselversion.' - '.$MusselConfig['lang']['cli_working'].'...');
        $cmd=@strtolower((substr_count($stl,' '))?substrbf($stl,' '):$stl);
        if($cmd=='quit'||$cmd=='q'||$cmd=='exit')die;
        if($cmd=='md5_file'||$cmd=='m')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('md5_file '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $hashme=@phpMusselFile($stl,0,true);
                echo md5($hashme).':'.strlen($hashme).':YOUR-SIGNATURE-NAME'.$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        if($cmd=='coex_file')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('coex_file '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $hashme=@phpMusselFile($stl,0,true);
                echo '$md5:'.md5($hashme).';$sha:'.sha1($hashme).';$str_len:'.strlen($hashme).';YOUR-SIGNATURE-NAME'.$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        if($cmd=='pe_meta')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))echo $MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        echo phpMusselFork('pe_meta '.$stl.$d[$i],$d[$i]).$linebreak;
                        }
                    }
                }
            else if(@is_file($stl))
                {
                echo phpMusselFork('pe_meta '.$stl,$stl).$linebreak;
                }
            else echo $stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            }
        if($cmd=='md5')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo md5($stl).':'.strlen($stl).':YOUR-SIGNATURE-NAME'.$linebreak;
            }
        if($cmd=='url_sig')
            {
            echo $linebreak.$linebreak;
            $stl=prescan_normalise(substr($stl,strlen($cmd)+1));
            $urlsig=array();
            $urlsig['avoidme']='';
            $urlsig['forthis']='';
            if(!preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([0-9a-z.-]{1,512})/i',$stl,$urlsig['domain'])||!preg_match_all('/(data|file|https?|ftps?|sftp|ss[hl])\:\/\/(www[0-9]{0,3}\.)?([\!\#\$\&-;\=\?\@-\[\]_a-z~]{1,4000})/i',$stl,$urlsig['url']))echo $MusselConfig['lang']['invalid_url'].$linebreak;
            else
                {
                echo 'DOMAIN:'.md5($urlsig['domain'][3][0]).':'.strlen($urlsig['domain'][3][0]).':YOUR-SIGNATURE-NAME'.$linebreak;
                $urlsig['forthis']=md5($urlsig['url'][3][0]).':'.strlen($urlsig['url'][3][0]);
                $urlsig['avoidme'].=','.$urlsig['forthis'].',';
                echo 'URL:'.$urlsig['forthis'].':YOUR-SIGNATURE-NAME'.$linebreak;
                if(preg_match('/[^0-9a-z.-]$/i',$urlsig['url'][3][0]))
                    {
                    $urlsig['x']=preg_replace('/[^0-9a-z.-]+$/i','',$urlsig['url'][3][0]);
                    $urlsig['forthis']=md5($urlsig['x']).':'.strlen($urlsig['x']);
                    if(!substr_count($urlsig['avoidme'],$urlsig['forthis']))
                        {
                        $urlsig['avoidme'].=','.$urlsig['forthis'].',';
                        echo 'URL:'.$urlsig['forthis'].':YOUR-SIGNATURE-NAME'.$linebreak;
                        }
                    }
                if(substr_count($urlsig['url'][3][0],'?'))
                    {
                    $urlsig['x']=substrbf($urlsig['url'][3][0],'?');
                    $urlsig['forthis']=md5($urlsig['x']).':'.strlen($urlsig['x']);
                    if(!substr_count($urlsig['avoidme'],$urlsig['forthis']))
                        {
                        $urlsig['avoidme'].=','.$urlsig['forthis'].',';
                        echo 'URL:'.$urlsig['forthis'].':YOUR-SIGNATURE-NAME'.$linebreak;
                        }
                    $urlsig['x']=substraf($urlsig['url'][3][0],'?');
                    $urlsig['forthis']=md5($urlsig['x']).':'.strlen($urlsig['x']);
                    if(!substr_count($urlsig['avoidme'],$urlsig['forthis'])&&$urlsig['forthis']!='d41d8cd98f00b204e9800998ecf8427e:0')
                        {
                        $urlsig['avoidme'].=','.$urlsig['forthis'].',';
                        echo 'QUERY:'.$urlsig['forthis'].':YOUR-SIGNATURE-NAME'.$linebreak;
                        }
                    }
                }
            $urlsig='';
            }
        if($cmd=='coex')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo '$md5:'.md5($stl).';$sha:'.sha1($stl).';$str_len:'.strlen($stl).';YOUR-SIGNATURE-NAME'.$linebreak;
            }
        if($cmd=='hex_encode'||$cmd=='x')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo @bin2hex($stl).$linebreak;
            }
        if($cmd=='hex_decode')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo @hex2bin($stl).$linebreak;
            }
        if($cmd=='base64_encode'||$cmd=='b')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo @base64_encode($stl).$linebreak;
            }
        if($cmd=='base64_decode')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo @base64_decode($stl).$linebreak;
            }
        if($cmd=='scan'||$cmd=='s')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            $out=$r='';
            $memCache['start_time']=time();
            $memCache['start_time_2822']=date('r',$memCache['start_time']);
            $s=$memCache['start_time_2822'].' '.$MusselConfig['lang']['started'].$MusselConfig['lang']['_fullstop_final'].$linebreak;
            echo $s;
            if(@is_dir($stl))
                {
                if(!$d=@scandir($stl))$out='> '.$MusselConfig['lang']['failed_to_access'].'"'.$stl.'".'.$linebreak;
                else
                    {
                    $c=count($d);
                    $xsc=$stl[strlen($stl)-1];
                    if($xsc!=="\\"&&$xsc!=="/")$stl.="/";
                    for($i=0;$i<$c;$i++)
                        {
                        if($d[$i]=='.'||$d[$i]=='..')continue;
                        $pcent=@round(($i/$c)*100,2).'%';
                        echo $pcent.' '.$MusselConfig['lang']['scan_complete'].$MusselConfig['lang']['_fullstop_final'];
                        $out=phpMusselFork('scan '.$stl.$d[$i],$d[$i]);
                        if(!$out)$out='> '.$MusselConfig['lang']['cli_failed_to_complete'].' ('.$d[$i].')'.$GLOBALS['MusselConfig']['lang']['_exclamation_final'].$linebreak;
                        $r.=$out;
                        echo "\r".prescan_decode($out);
                        $out='';
                        }
                    }
                }
            else if(@is_file($stl))
                {
                $out=phpMusselFork('scan '.$stl,$stl);
                if(!$out)$out='> '.$MusselConfig['lang']['cli_failed_to_complete'].$MusselConfig['lang']['_exclamation_final'].$linebreak;
                }
            else if(!$out)$out='> '.$stl.$MusselConfig['lang']['cli_is_not_a'].$linebreak;
            $r.=$out;
            if($out)
                {
                echo prescan_decode($out);
                $out='';
                }
            $memCache['end_time']=time();
            $memCache['end_time_2822']=date('r',$memCache['end_time']); /* AAA
            "detections" serialised variable comes from the "$whyflagged" variable, normally populated during scanning, but inaccessible,
            due to process forking. Data is logged by the parent process but $whyflagged is populated by the child process.
            This messes up the ability to correctly write to the serialised log when in CLI mode. I don't have any solution yet. '-.-
            if($MusselConfig['general']['scan_log_serialized'])
                {
                $memCache['handle']=array();
                $memCache['handle']['d']=serialize(array('start_time'=>$memCache['start_time'],'end_time'=>$memCache['end_time'],'origin'=>'CLI','objects_scanned'=>$memCache['objects_scanned'],'detections_count'=>$memCache['detections_count'],'scan_errors'=>$memCache['scan_errors'],'detections'=>$whyflagged)).$linebreak;
                $memCache['handle']['f']=fopen($vault.$MusselConfig['general']['scan_log_serialized'],'a');
                fwrite($memCache['handle']['f'],$memCache['handle']['d']);
                fclose($memCache['handle']['f']);
                $memCache['handle']='';
                } AAA */
            $r=$s.$r;
            $s=$memCache['end_time_2822'].' '.$MusselConfig['lang']['finished'].$MusselConfig['lang']['_fullstop_final'].$linebreak.$linebreak;
            echo $s;
            $r.=$s;
            if($MusselConfig['general']['scan_log'])
                {
                $memCache['handle']=array();
                if(!file_exists($vault.$MusselConfig['general']['scan_log']))$r=$phpmusselsafety.$linebreak.$linebreak.$r;
                $memCache['handle']['f']=fopen($vault.$MusselConfig['general']['scan_log'],'a');
                fwrite($memCache['handle']['f'],$r);
                fclose($memCache['handle']['f']);
                $memCache['handle']='';
                }
            $s=$r='';
            }
        if($cmd=='update'||$cmd=='u')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            $is_cli=true;
            $phpmusselversion_preserved=$phpmusselversion;
            $musselvar='';
            if(!file_exists($vault.'update.inc'))echo $MusselConfig['lang']['update_scriptfile_missing'];
            else
                {
                require $vault.'update.inc';
                echo $linebreak.$linebreak.$MusselConfig['lang']['cli_update_restart'];
                }
            $phpmusselversion=$phpmusselversion_preserved;
            }
        if($cmd=='greylist'||$cmd=='g')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            if(!empty($stl))
                {
                $greylist=(!file_exists($vault.'greylist.csv'))?',':'';
                $greylist.=$stl.',';
                $greylistf=fopen($vault.'greylist.csv','a');
                fwrite($greylistf,$greylist);
                fclose($greylistf);
                unset($greylistf,$greylist);
                echo $MusselConfig['lang']['greylist_updated'];
                }
            }
        if($cmd=='greylist_clear'||$cmd=='gc')
            {
            echo $linebreak.$linebreak;
            $greylistf=fopen($vault.'greylist.csv','a');
            ftruncate($greylistf,0);
            fwrite($greylistf,',');
            fclose($greylistf);
            unset($greylistf,$greylist);
            echo $MusselConfig['lang']['greylist_cleared'];
            }
        if($cmd=='greylist_show'||$cmd=='gs')
            {
            echo $linebreak.$linebreak;
            $stl=substr($stl,strlen($cmd)+1);
            echo (file_exists($vault.'greylist.csv'))?' greylist.csv:'.$linebreak.$linebreak.implode("\n ",explode(',',phpMusselFile($vault.'greylist.csv'))):' greylist.csv '.$MusselConfig['lang']['x_does_not_exist'].$MusselConfig['lang']['_exclamation_final'];
            }
        if($cmd=='c')echo $MusselConfig['lang']['cli_commands'];
        }
    die;
    }
@ini_set('user_agent',$inidefaults['user_agent']);
@ini_set('mbstring.internal_encoding',$inidefaults['internal_encoding']);
@ini_set('default_charset',$inidefaults['default_charset']);
@ini_set('pcre.recursion_limit',$inidefaults['recursion_limit']);
@ini_set('pcre.backtrack_limit',$inidefaults['backtrack_limit']);
@ini_set('display_errors',$inidefaults['display_errors']);
if($MusselConfig['general']['cleanup'])unset($cli_args,$r,$pedata,$killdata,$whyflagged,$k,$i,$c,$phpmusselsafety,$phpmusselua,$memCache,$inidefaults,$linebreak,$time,$phpmusselversion,$phpmusselversion_int);
else $memCache['eof']=true;
