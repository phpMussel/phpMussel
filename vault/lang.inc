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
 This File: phpMussel v0.3e Language Data
 This File Last Updated: 20th February 2014

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

if(!isset($MusselConfig['general']['lang']))$MusselConfig['general']['lang']="";
if(!$MusselConfig['general']['lang'])$MusselConfig['general']['lang']="en";
$MusselConfig['lang']=array();
$MusselConfig['lang']['cli_ln1']="      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";

// $GLOBALS['MusselConfig']['lang']['denied']
// Multilingual support still under development - Not yet fully supported.
if($MusselConfig['general']['lang']=="en")
	{ // English
	$MusselConfig['lang']['cli_ln2']=" Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
	$MusselConfig['lang']['cli_ln3']=" Currently running phpMussel in CLI mode (Command line interface).\n\n What file or directory do you want to scan? Type the name of the file or\n directory that you want phpMussel to scan and press enter, or type 'q' and\n enter to quit without scanning:\n\n>> ";
	$MusselConfig['lang']['cli_failed_to_access']="Failed to access";
	$MusselConfig['lang']['cli_failed_to_complete']="Failed to complete scanning process";
	$MusselConfig['lang']['cli_finished']="Finished";
	$MusselConfig['lang']['cli_started']="Started";
	$MusselConfig['lang']['denied']="Upload Denied!";
	// $MusselConfig['lang']['denied_reason_local']="Your upload attempt was blocked for the reasons listed below / ";
	$MusselConfig['lang']['denied_reason_local']="";
	$MusselConfig['lang']['detected']="Detected";
	$MusselConfig['lang']['generated_by']="Generated&nbsp;by";
	}
else if($MusselConfig['general']['lang']=="de")
	{ // German
	$MusselConfig['lang']['detected']="Entdeckte";
	}
else if($MusselConfig['general']['lang']=="es")
	{ // Spanish
	$MusselConfig['lang']['detected']="Detectado";
	}
else if($MusselConfig['general']['lang']=="fr")
	{ // French
	$MusselConfig['lang']['cli_ln2']="  Merci pour d'utiliser phpMussel, un script en PHP basé sur les signatures de \n  ClamAV conçus pour détecter les virus, les malveillants logiciels et autres  \n     menaces dans les fichiers téléchargés sur votre système partout où le     \n                              script est accroché.                             \n     PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                  ~ ~ ~                                        \n\n";
	$MusselConfig['lang']['cli_ln3']=" Fonctionne comme CLI mode pour le moment (Commande Ligne Interface).\n\n Quel fichier ou répertoire que vous souhaitez analyser? Taper le nom du\n fichier ou du répertoire que vous souhaiter pour phpMussel à analyser et\n appuyez sur Enter, ou tapez 'q' et Enter à quitter sans analyser:\n\n>> ";
	$MusselConfig['lang']['cli_failed_to_access']="Échec d'accès";
	$MusselConfig['lang']['cli_failed_to_complete']="Échec du terminer le processus d'analyse";
	$MusselConfig['lang']['cli_finished']="Terminé";
	$MusselConfig['lang']['cli_started']="Commencé";
	$MusselConfig['lang']['denied']="Téléchargement Refusé!";
	$MusselConfig['lang']['denied_reason_local']="Votre tentative à télécharger a été bloqué pour les raisons énumérées ci-dessous / ";
	$MusselConfig['lang']['detected']="Détecté";
	$MusselConfig['lang']['generated_by']="Généré&nbsp;par";
	}
else if($MusselConfig['general']['lang']=="id")
	{ // Indonesian
	$MusselConfig['lang']['cli_ln2']=" Terima kasih untuk menggunakan phpMussel, sebuah script php berdasarkan tanda \n    tangan ClamAV di design untuk mendeteksi trojan-trojan, virus-virus dan    \n serangan-serangan lainnya dalam data-data diupload ke system anda dimana saja \n                               script di kaitkan.                              \n     PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPL V.2 oleh Caleb M (Maikuolan)\n\n                                  ~ ~ ~                                        \n\n";
	$MusselConfig['lang']['cli_ln3']=" Sekarang phpMussel operasi di CLI mode (Command line interface).\n\n Apa fail atau direktori yang anda ingin memindai? Ketik nama fail atau\n direktori yang anda inginkan phpMussel untuk memindai dan tekan enter, atau\n ketik 'q' dan enter untuk berhenti tanpa memindai:\n\n>> ";
	$MusselConfig['lang']['cli_failed_to_access']="Gagal untuk akses";
	$MusselConfig['lang']['cli_failed_to_complete']="Gagal untuk menyelesaikan memindai proses";
	$MusselConfig['lang']['cli_finished']="Selesai";
	$MusselConfig['lang']['cli_started']="Dimulai";
	$MusselConfig['lang']['denied']="Upload Ditolak!";
	$MusselConfig['lang']['denied_reason_local']="Upload diblokir karena alasan yang tercantum di bawah / ";
	$MusselConfig['lang']['detected']="Terdeteksi";
	$MusselConfig['lang']['generated_by']="Dihasilkan&nbsp;oleh";
	}
else if($MusselConfig['general']['lang']=="it")
	{ // Italian
	$MusselConfig['lang']['detected']="Rilevato";
	}
else if($MusselConfig['general']['lang']=="nl")
	{ // Dutch
	$MusselConfig['lang']['detected']="Gedetecteerd";
	}
else if($MusselConfig['general']['lang']=="pt")
	{ // Portuguese
	$MusselConfig['lang']['detected']="Detectado";
	}
else
	{
	die("[phpMussel] Language undefined or incorrectly defined. Can\'t continue.");
	}

?>