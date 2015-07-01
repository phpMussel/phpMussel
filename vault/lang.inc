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

 Special thanks to Sourceforge and GitHub for hosting the project files,
 located at <http://phpmussel.sourceforge.net/> and
 <https://github.com/Maikuolan/phpMussel/>, to Spambot Security for hosting
 the phpMussel discussion forums, located at
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
 This File: phpMussel v0.7-BETA (29th June 2015) Language Data.
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
if(!isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))$_SERVER['HTTP_ACCEPT_LANGUAGE']='';
if($MusselConfig['general']['lang_override']&&$_SERVER['HTTP_ACCEPT_LANGUAGE'])
	{
	$MusselConfig['lang_acceptable']=',en,de,es,fr,id,it,ja,nl,pt,ru,zh,zh-TW,';
	if(substr_count($MusselConfig['lang_acceptable'],substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5)))$MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,5);
	else if(substr_count($MusselConfig['lang_acceptable'],substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2)))$MusselConfig['general']['lang']=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
	}

if($MusselConfig['general']['lang']==='en')
	{ // English
	if(!file_exists($vault.'lang/lang.en.inc'))plaintext_echo_die('[phpMussel] Language data missing! Can\'t continue.');
	require($vault.'lang/lang.en.inc');
	}
else if($MusselConfig['general']['lang']==='de')
	{ // German - Deutsch
	if(!file_exists($vault.'lang/lang.de.inc'))plaintext_echo_die('[phpMussel] Sprache Daten fehlen! Kann nicht fortgesetzt werden.');
	require($vault.'lang/lang.de.inc');
	}
else if($MusselConfig['general']['lang']==='es')
	{ // Spanish - Español
	if(!file_exists($vault.'lang/lang.es.inc'))plaintext_echo_die('[phpMussel] Idioma datos faltan! No puede continuar.');
	require($vault.'lang/lang.es.inc');
	}
else if($MusselConfig['general']['lang']==='fr')
	{ // French - Français
	if(!file_exists($vault.'lang/lang.fr.inc'))plaintext_echo_die('[phpMussel] Langue données manquant! Ne pouvez pas continuer.');
	require($vault.'lang/lang.fr.inc');
	}
else if($MusselConfig['general']['lang']==='id')
	{ // Indonesian - Bahasa Indonesia
	if(!file_exists($vault.'lang/lang.id.inc'))plaintext_echo_die('[phpMussel] Data Bahasa hilang! Tidak dapat dilanjutkan.');
	require($vault.'lang/lang.id.inc');
	}
else if($MusselConfig['general']['lang']==='it')
	{ // Italian - Italiano
	if(!file_exists($vault.'lang/lang.it.inc'))plaintext_echo_die('[phpMussel] Lingua dati mancanti! Non può continuare.');
	require($vault.'lang/lang.it.inc');
	}
else if($MusselConfig['general']['lang']==='ja')
	{ // Japanese - 日本語
	if(!file_exists($vault.'lang/lang.ja.inc'))plaintext_echo_die('[phpMussel] 言語データが見つかりません！続行できません。');
	require($vault.'lang/lang.ja.inc');
	}
else if($MusselConfig['general']['lang']==='nl')
	{ // Dutch - Nederlandse
	if(!file_exists($vault.'lang/lang.nl.inc'))plaintext_echo_die('[phpMussel] Taal data niet gevonden! Kan niet doorgaan.');
	require($vault.'lang/lang.nl.inc');
	}
else if($MusselConfig['general']['lang']==='pt')
	{ // Portuguese - Português
	if(!file_exists($vault.'lang/lang.pt.inc'))plaintext_echo_die('[phpMussel] Idioma dados faltando! Não pode continuar.');
	require($vault.'lang/lang.pt.inc');
	}
else if($MusselConfig['general']['lang']==='ru')
	{ // Russian - Русский
	if(!file_exists($vault.'lang/lang.ru.inc'))plaintext_echo_die('[phpMussel] Язык данные не найдены! Не может продолжаться.');
	require($vault.'lang/lang.ru.inc');
	}
else if($MusselConfig['general']['lang']==='zh')
	{ // Chinese (Simplified) - 中文（简体）
	if(!file_exists($vault.'lang/lang.zh.inc'))plaintext_echo_die('[phpMussel] 语言数据不存在！无法继续。');
	require($vault.'lang/lang.zh.inc');
	}
else if($MusselConfig['general']['lang']==='zh-TW')
	{ // Chinese (Traditional) - 中文（傳統）
	if(!file_exists($vault.'lang/lang.zh-tw.inc'))plaintext_echo_die('[phpMussel] 語言數據不存在！無法繼續。');
	require($vault.'lang/lang.zh-tw.inc');
	}
else die('[phpMussel] Language undefined or incorrectly defined. Can\'t continue.');

?>