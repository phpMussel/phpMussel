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
 This File: phpMussel v0.7b-BETA (24th August 2015) Language Data.
 <%phpMussel%/vault/lang.inc>

                                     ~ ~ ~
 Please refer to the README documentation for installation instructions and for
 instructions regarding how to correctly use phpMussel.

 You may change any part of phpMussel as you see fit, but you are not required
 to change anything in this file in order for phpMussel to work effectively.

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

if(!isset($MusselConfig['general']))$MusselConfig['general']=array();
if(!isset($MusselConfig['general']['lang']))$MusselConfig['general']['lang']='';
if(!$MusselConfig['general']['lang'])$MusselConfig['general']['lang']='en';
$MusselConfig['lang']=array();
$MusselConfig['lang']['cli_ln1']="      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";
$MusselConfig['lang']['cli_prompt']="\n\n>> ";
if(!isset($MusselConfig['general']['lang_override']))$MusselConfig['general']['lang_override']=0;
if(!isset($MusselConfig['lang_acceptable']))$MusselConfig['lang_acceptable']=',en,de,es,fr,id,it,ja,nl,pt,ru,vi,zh,zh-TW,';
if(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))$_SERVER['HTTP_ACCEPT_LANGUAGE']='';
if($MusselConfig['general']['lang_override']&&$_SERVER['HTTP_ACCEPT_LANGUAGE'])
	{
	if(substr_count($MusselConfig['lang_acceptable'],substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)))$MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);
	else if(substr_count($MusselConfig['lang_acceptable'],substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)))$MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
	}
if(!file_exists($vault.'lang/lang.'.$MusselConfig['general']['lang'].'.inc'))plaintext_echo_die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');
require $vault.'lang/lang.'.$MusselConfig['general']['lang'].'.inc';

?>