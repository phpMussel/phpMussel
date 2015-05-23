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
 This File: phpMussel v0.4d (10th September 2014) Language Data

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

if(!isset($MusselConfig['general']['lang']))$MusselConfig['general']['lang']="";
if(!$MusselConfig['general']['lang'])$MusselConfig['general']['lang']="en";
$MusselConfig['lang']=array();
$MusselConfig['lang']['cli_ln1']="      _____  _     _  _____  _______ _     _ _______ _______ _______           \n <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >\n     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    \n";
$MusselConfig['lang']['cli_prompt']="\n\n>> ";

if($MusselConfig['general']['lang']=="en")
	{ // English
	$MusselConfig['lang']['cli_commands']=" q\n - Quit CLI.\n - Aliases: quit, exit.\n md5_file\n - Generate MD5 signatures from files [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generate MD5 signature from string [Syntax: md5_file string].\n hex_encode\n - Convert binary string to hexadecimal [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Convert hexadecimal to binary string [Syntax: hex_decode string].\n base64_encode\n - Convert binary string to base64 string [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Convert base64 string to binary string [Syntax: base64_decode string].\n scan\n - Scan file or directory [Syntax: scan filename].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n forcedupdate\n - Forcibly update phpMussel.\n - Alias: f.\n c\n - Print this command list.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Failed to complete scanning process";
	$MusselConfig['lang']['cli_is_not_a']=" is not a file or directory.";
	$MusselConfig['lang']['cli_ln2']=" Thank you for using phpMussel, a php-based script based upon ClamAV signatures\n  designed to detect trojans, viruses, malware and other threats within files  \n             uploaded to your system wherever the script is hooked.            \n     PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Currently running phpMussel in CLI mode (Command line interface).\n\n To scan a file or directory, type 'scan', followed by the name of the file or\n directory that you want phpMussel to scan and press Enter; Type 'c' and press\n Enter for a list of CLI mode commands; Type 'q' and press Enter to quit:";
	$MusselConfig['lang']['cli_update_restart']=" Restarting phpMussel may be required before updates become apparent.";
	$MusselConfig['lang']['cli_working']="In progress";
	$MusselConfig['lang']['corrupted']="corrupted";
	$MusselConfig['lang']['denied_other']="Télécharger Refusé! Subir Denegado! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Your upload attempt was blocked for the reasons listed below / &#24744;&#30340;&#19978;&#36733;&#23581;&#35797;&#34987;&#25298;&#32477;&#30340;&#29702;&#30001;&#19979;&#38754;&#21015;&#20986;:";
	$MusselConfig['lang']['denied']="Upload Denied!";
	$MusselConfig['lang']['detected_control_characters']="Detected Control Characters";
	$MusselConfig['lang']['detected']="Detected";
	$MusselConfig['lang']['failed_to_access']="Failed to access ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Filesize limit exceeded";
	$MusselConfig['lang']['filetype_blacklisted']="Filetype blacklisted";
	$MusselConfig['lang']['finished']="Finished";
	$MusselConfig['lang']['generated_by']="Generated&nbsp;by";
	$MusselConfig['lang']['invalid_file']="Invalid file";
	$MusselConfig['lang']['ok']="OK";
	$MusselConfig['lang']['refer_to_scan_kills']=" (refer to ".$MusselConfig['general']['scan_kills']." for details)";
	$MusselConfig['lang']['scan_aborted']="Scanning aborted";
	$MusselConfig['lang']['scan_chameleon']="chameleon attack detected";
	$MusselConfig['lang']['scan_checking_contents']="Success! Proceeding to check contents.";
	$MusselConfig['lang']['scan_checking']="Checking";
	$MusselConfig['lang']['scan_command_injection']="Command injection attempt detected";
	$MusselConfig['lang']['scan_extensions_missing']="Failed (missing required extensions)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Filename manipulation detected";
	$MusselConfig['lang']['scan_map_corrupted']="Signature map corrupted";
	$MusselConfig['lang']['scan_map_missing']="Signature map missing";
	$MusselConfig['lang']['scan_missing_filename']="Missing filename";
	$MusselConfig['lang']['scan_no_problems_found']="No problems found.";
	$MusselConfig['lang']['scan_not_archive']="Failed (empty or not an archive)!";
	$MusselConfig['lang']['scan_reading']="Reading";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Signature file corrupted";
	$MusselConfig['lang']['scan_signature_file_missing']="Signature file missing";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Unauthorised file upload manipulation or misconfiguration detected! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Unauthorised file upload manipulation detected";
	$MusselConfig['lang']['started']="Started";
	$MusselConfig['lang']['update_']="phpMussel will now attempt to update itself.";
	$MusselConfig['lang']['update_available']="A script update is available.";
	$MusselConfig['lang']['update_complete']="Update check completed successfully.";
	$MusselConfig['lang']['update_created']="created";
	$MusselConfig['lang']['update_deleted']="deleted";
	$MusselConfig['lang']['update_failed']="Failed.";
	$MusselConfig['lang']['update_fetch']="Attempting to fetch version data from";
	$MusselConfig['lang']['update_no_source']="phpMussel has failed to update itself because it could not connect to a valid update source. Updating manually is recommended.";
	$MusselConfig['lang']['update_not']="NOT";
	$MusselConfig['lang']['update_not_available']="No script update is available at this time.";
	$MusselConfig['lang']['update_not_possible']="A script update is available, but can't be fully updated with this version of the update script. Please update manually.";
	$MusselConfig['lang']['update_patched']="patched";
	$MusselConfig['lang']['update_scriptfile_missing']=" Update script file missing! Please reinstall phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" seconds elapsed";
	$MusselConfig['lang']['update_signatures_available']="A signatures update is available.";
	$MusselConfig['lang']['update_signatures_latest']="LATEST SIGNATURES";
	$MusselConfig['lang']['update_signatures_not_available']="No signatures update is available at this time.";
	$MusselConfig['lang']['update_signatures_yours']="YOUR SIGNATURES";
	$MusselConfig['lang']['update_success']="Success.";
	$MusselConfig['lang']['update_successfully']="successfully";
	$MusselConfig['lang']['update_version_latest']="LATEST SCRIPT VERSION";
	$MusselConfig['lang']['update_version_yours']="YOUR SCRIPT VERSION";
	$MusselConfig['lang']['upload_error_1']="Filesize exceeds MAX_FILE_SIZE directive. ";
	$MusselConfig['lang']['upload_error_2']="Filesize exceeds form-specified filesize limit. ";
	$MusselConfig['lang']['upload_error_34']="Upload failure! Please contact the hostmaster for assistance! ";
	$MusselConfig['lang']['upload_error_6']="Upload directory missing! Please contact the hostmaster for assistance! ";
	$MusselConfig['lang']['upload_error_7']="Disc-write error! Please contact the hostmaster for assistance! ";
	$MusselConfig['lang']['upload_error_8']="PHP misconfiguration detected! Please contact the hostmaster for assistance! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Upload limit exceeded";
	$MusselConfig['lang']['wrong_password']="Wrong password; Action denied.";
	$MusselConfig['lang']['x_does_not_exist']="does not exist";
	}
else if($MusselConfig['general']['lang']=="de")
	{ // German
	$MusselConfig['lang']['cli_commands']="q\n - Beendet den CLI-Modus.\n - Alias: quit, exit.\n md5_file\n - Generiert MD5-Signaturen einer Datei\n   [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generiert MD5-Signaturen eines String-Wertes\n   [Syntax: md5_file string].\n hex_encode\n - Konvertiert einen Bin&#228;r-Wert in einen Hexidezimal-Wert\n   [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Konvertiert einen Hexidezimal-Wert in einen Bin&#228;r-Wert\n   [Syntax: hex_decode string].\n base64_encode\n -  Konvertiert einen Bin&#228;r-Wert in einen Base64-Wert\n   [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Konvertiert einen Base64-Wert in einen Bin&#228;r-Wert\n   [Syntax: base64_decode string].\n scan\n - &#220;berpr&#252;ft eine Datei oder ein Verzeichnis\n   [Syntax: scan filename].\n - Alias: s.\n update\n - Aktualisiert phpMussel.\n - Alias: u.\n forcedupdate\n - Erzwingt ein Update von phpMussel.\n - Alias: f.\n c\n - Gibt diese Befehlsliste aus.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Ein vollst&#228;ndiger Scan konnte nicht durchgef&#252;hrt werden";
	$MusselConfig['lang']['cli_is_not_a']=" ist keine Datei oder ein Verzeichnis.";
	$MusselConfig['lang']['cli_ln2']=" Vielen Dank f&#252;r die Benutzung von phpMussel, einem auf PHP-basiertem Script,  \n   welches die Signaturen von ClamAV nutzt, um Trojaner, Viren, Malware und    \n   andere Bedrohungen in Dateien zu entdecken, die auf Ihr System hochgeladen  \n                                werden k&#246;nnten.                                \n    PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan)     \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" phpMussel befindet sich im CLI-Modus (Command line interface).\n\n Um eine Datei oder ein Verzeichnis mit phpMussel zu &#252;berpr&#252;fen, geben Sie\n 'scan', gefolgt vom Namen der Datei oder des Verzeichnisses ein und\n best&#228;tigen mit Enter;\n\n Geben Sie 'c' und Enter f&#252;r eine Liste der verf&#252;gbaren Befehle im CLI-Modus\n ein; Geben Sie 'q' und Enter zum Beenden ein: ";
	$MusselConfig['lang']['cli_update_restart']=" phpMussel muss neu gestartet werden, damit die Aktualisierungen wirksam werden.";
	$MusselConfig['lang']['cli_working']="Im Gange";
	$MusselConfig['lang']['corrupted']="besch&#228;digt";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Subir Denegado! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Der Upload wurde aus den unten aufgeführten Gründen blockiert / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Upload verweigert!";
	$MusselConfig['lang']['detected_control_characters']="Steuerzeichen erkannt";
	$MusselConfig['lang']['detected']="Entdeckt: ";
	$MusselConfig['lang']['failed_to_access']="Zugriff fehlgeschlagen auf ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Dateigröße überschritten";
	$MusselConfig['lang']['filetype_blacklisted']="Dateityp auf Blacklist";
	$MusselConfig['lang']['finished']="Fertig";
	$MusselConfig['lang']['generated_by']="Generiert&nbsp;von&nbsp;";
	$MusselConfig['lang']['invalid_file']="Ungültige Datei";
	$MusselConfig['lang']['ok']="OK";
	$MusselConfig['lang']['refer_to_scan_kills']=" (lesen Sie ".$MusselConfig['general']['scan_kills']." für Details)";
	$MusselConfig['lang']['scan_aborted']="Scan abgebrochen";
	$MusselConfig['lang']['scan_chameleon']="Chamäleon-Angriff erkannt";
	$MusselConfig['lang']['scan_checking_contents']="Erfolg! Überprüfe Inhalte.";
	$MusselConfig['lang']['scan_checking']="Überprüfung";
	$MusselConfig['lang']['scan_command_injection']="CMD-Injektion erkannt";
	$MusselConfig['lang']['scan_extensions_missing']="Gescheitert (fehlende benötigte Erweiterungen)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Manipulation des Dateinamens erkannt";
	$MusselConfig['lang']['scan_map_corrupted']="Signaturkarte beschädigt";
	$MusselConfig['lang']['scan_map_missing']="Signaturkarte fehlt";
	$MusselConfig['lang']['scan_missing_filename']="Fehlender Dateiname";
	$MusselConfig['lang']['scan_no_problems_found']="Keine Probleme gefunden.";
	$MusselConfig['lang']['scan_not_archive']="Gescheitert (leer oder kein Archiv)!";
	$MusselConfig['lang']['scan_reading']="Lesen";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Signaturdatei beschädigt";
	$MusselConfig['lang']['scan_signature_file_missing']="Signaturdatei fehlt";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Unerlaubte Upload-Manipulation oder Fehlkonfiguration erkannt! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Unerlaubte Upload-Manipulation erkannt";
	$MusselConfig['lang']['started']="Gestartet";
	$MusselConfig['lang']['update_']="phpMussel wird nun versuchen, sich zu aktualisieren.";
	$MusselConfig['lang']['update_available']="Ein Scriptupdate ist verfügbar.";
	$MusselConfig['lang']['update_complete']="Update-Prüfung erfolgreich abgeschlossen.";
	$MusselConfig['lang']['update_created']="erstellt";
	$MusselConfig['lang']['update_deleted']="gelöscht";
	$MusselConfig['lang']['update_failed']="Gescheitert.";
	$MusselConfig['lang']['update_fetch']="Abrufen von Versionsdaten aus";
	$MusselConfig['lang']['update_no_source']="phpMussel konnte nicht aktualisiert werden, da es sich nicht zu einer gültigen Update-Quelle verbinden konnte. Manuelles Update wird empfohlen.";
	$MusselConfig['lang']['update_not']="NICHT";
	$MusselConfig['lang']['update_not_available']="Es steht zur Zeit kein Scriptupdate zur Verfügung.";
	$MusselConfig['lang']['update_not_possible']="Ein Scriptupdate ist verfügbar, kann aber nicht vollständig mit dieser Version des Update-Scripts aktualisiert werden. Bitte aktualisieren Sie manuell.";
	$MusselConfig['lang']['update_patched']="gepatcht";
	$MusselConfig['lang']['update_scriptfile_missing']=" Update-Script fehlt! Bitte installieren Sie phpMussel erneut.";
	$MusselConfig['lang']['update_seconds_elapsed']=" Sekunden verstrichen";
	$MusselConfig['lang']['update_signatures_available']="Ein Signaturenupdate ist verfügbar.";
	$MusselConfig['lang']['update_signatures_latest']="AKTUELLE SIGNATUREN";
	$MusselConfig['lang']['update_signatures_not_available']="Es steht zur Zeit kein Signaturenupdate zur Verfügung.";
	$MusselConfig['lang']['update_signatures_yours']="IHRE SIGNATUREN";
	$MusselConfig['lang']['update_success']="Erfolgreich.";
	$MusselConfig['lang']['update_successfully']="erfolgreich";
	$MusselConfig['lang']['update_version_latest']="AKTUELLE SCRIPT VERSION";
	$MusselConfig['lang']['update_version_yours']="IHRE SCRIPT VERSION";
	$MusselConfig['lang']['upload_error_1']="Dateigröße überschreitet die Richtlinie MAX_FILE_SIZE. ";
	$MusselConfig['lang']['upload_error_2']="Dateigröße überschreitet die im Formular angegebene Dateigröße. ";
	$MusselConfig['lang']['upload_error_34']="Upload gescheitert! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ";
	$MusselConfig['lang']['upload_error_6']="Fehlendes Uploadverzeichnis! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ";
	$MusselConfig['lang']['upload_error_7']="Disc-Schreibfehler! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ";
	$MusselConfig['lang']['upload_error_8']="PHP-Fehlkonfiguration erkannt! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Uploadlimit überschritten";
	$MusselConfig['lang']['wrong_password']="Falsches Passwort; Ausführung des Befehls verweigert.";
	$MusselConfig['lang']['x_does_not_exist']="nicht vorhanden";
	}
else if($MusselConfig['general']['lang']=="es")
	{ // Spanish
	$MusselConfig['lang']['cli_commands']=" q\n - Dejar CLI.\n - Alias: quit, exit.\n md5_file\n - Generar MD5 firmas de archivos [Sintaxis: md5_file nombre_de_archivo].\n - Alias: m.\n md5\n - Generar MD5 firma de string [Sintaxis: md5_file string].\n hex_encode\n - Convertir binaria string a hexadecimal [Sintaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadecimal a binaria string [Sintaxis: hex_decode string].\n base64_encode\n - Convertir binaria string a base64 string [Sintaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string a binaria string [Sintaxis: base64_decode string].\n scan\n - Analizar archivo o directorio [Sintaxis: scan nombre_de_archivo].\n - Alias: s.\n update\n - Actualizar phpMussel.\n - Alias: u.\n forcedupdate\n - Fuerza actualizar phpMussel.\n - Alias: f.\n c\n - Imprimir esta lista de comandos.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="No se pudo completar el proceso de escaneo";
	$MusselConfig['lang']['cli_is_not_a']=" no es un archivo o directorio.";
	$MusselConfig['lang']['cli_ln2']=" Gracias por usar phpMussel, un PHP script basado en las definiciones de ClamAV\n    diseñados para detectar troyanos, virus, malware y otras amenazas en los   \n         archivos cargados en el sistema donde el script está adjunto.         \n   PHPMUSSEL COPYRIGHT 2013 después de eso GNU/GPL V.2 by Caleb M (Maikuolan)  \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Corrientemente phpMussel en ejecución en modo CLI (Comandos línea interfaz).\n\n Para analizar un archivo o directorio, escribir 'scan', seguido por el nombre\n del archivo o directorio que usted desea phpMussel para escanear y pulse Enter;\n Escribir 'c' y pulse Enter para obtener una lista de CLI modo comandos;\n Escribir 'q' y pulse Enter para salir:";
	$MusselConfig['lang']['cli_update_restart']=" Reinicio phpMussel puede ser requerido antes de las actualizaciones se hacen\n evidentes.";
	$MusselConfig['lang']['cli_working']="En operación";
	$MusselConfig['lang']['corrupted']="corrompido";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Intento de subida ha sido bloqueada por las razones que se indican a continuación / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Subir Denegado!";
	$MusselConfig['lang']['detected_control_characters']="Detectado Control Caracteres";
	$MusselConfig['lang']['detected']="Detectado";
	$MusselConfig['lang']['failed_to_access']="No se pudo acceso ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Excede el límite del archivo tamaño";
	$MusselConfig['lang']['filetype_blacklisted']="Tipo de archivo en la lista negra";
	$MusselConfig['lang']['finished']="Terminado";
	$MusselConfig['lang']['generated_by']="Generado&nbsp;por";
	$MusselConfig['lang']['invalid_file']="Archivo no válido";
	$MusselConfig['lang']['ok']="OK";
	$MusselConfig['lang']['refer_to_scan_kills']=" (referir a ".$MusselConfig['general']['scan_kills']." para más detalles)";
	$MusselConfig['lang']['scan_aborted']="Escaneo abortado!";
	$MusselConfig['lang']['scan_chameleon']="camaleón ataque detectado";
	$MusselConfig['lang']['scan_checking_contents']="Éxito! Procediendo a verificar el contenido.";
	$MusselConfig['lang']['scan_checking']="Verificando";
	$MusselConfig['lang']['scan_command_injection']="Comandos inyección intento detectado";
	$MusselConfig['lang']['scan_extensions_missing']="Fracasado (desaparecido requeridos extensiones)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Manipulación del fichero nombre detectado";
	$MusselConfig['lang']['scan_map_corrupted']="Firma Mapa corrompido";
	$MusselConfig['lang']['scan_map_missing']="Firma Mapa desaparecido";
	$MusselConfig['lang']['scan_missing_filename']="Nombre del archivo está ausente";
	$MusselConfig['lang']['scan_no_problems_found']="No problemas encontrado.";
	$MusselConfig['lang']['scan_not_archive']="Fracasado (vacío o no es un archivo)!";
	$MusselConfig['lang']['scan_reading']="Leyendo";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Firma archivo corrompido";
	$MusselConfig['lang']['scan_signature_file_missing']="Firma archivo desaparecido";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="No autorizado archivos manipulación o malo configuración detectado! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="No autorizado archivos manipulación detectado";
	$MusselConfig['lang']['started']="Iniciado";
	$MusselConfig['lang']['update_']="phpMussel ahora intentará actualización.";
	$MusselConfig['lang']['update_available']="Una script actualización está disponible.";
	$MusselConfig['lang']['update_complete']="Actualización verificación completada con éxito.";
	$MusselConfig['lang']['update_created']="creado";
	$MusselConfig['lang']['update_deleted']="borrado";
	$MusselConfig['lang']['update_failed']="Fracasado.";
	$MusselConfig['lang']['update_fetch']="Intentar para obtener la versión datos de";
	$MusselConfig['lang']['update_no_source']="phpMussel ha fracasado de actualización porque no se pudo conectar a una válido actualización fuente. Se recomienda actualizar manualmente.";
	$MusselConfig['lang']['update_not']="NO";
	$MusselConfig['lang']['update_not_available']="No script actualización está disponible en este momento.";
	$MusselConfig['lang']['update_not_possible']="Una script actualización está disponible, pero no puede ser completamente actualizada con esta versión de la script de actualización. Por favor, actualizar manualmente.";
	$MusselConfig['lang']['update_patched']="parcheado";
	$MusselConfig['lang']['update_scriptfile_missing']=" Actualización script archivo faltan! Por favor, reinstalar phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" segundos transcurridos";
	$MusselConfig['lang']['update_signatures_available']="Una actualización de firmas está disponible.";
	$MusselConfig['lang']['update_signatures_latest']="ÚLTIMAS FIRMAS";
	$MusselConfig['lang']['update_signatures_not_available']="No actualización de firmas está disponible en este momento.";
	$MusselConfig['lang']['update_signatures_yours']="SUS FIRMAS";
	$MusselConfig['lang']['update_success']="Éxito.";
	$MusselConfig['lang']['update_successfully']="con éxito";
	$MusselConfig['lang']['update_version_latest']="ÚLTIMA SCRIPT VERSIÓN";
	$MusselConfig['lang']['update_version_yours']="SU SCRIPT VERSIÓN";
	$MusselConfig['lang']['upload_error_1']="Fichero tamaño excede MAX_FILE_SIZE directiva. ";
	$MusselConfig['lang']['upload_error_2']="Fichero tamaño excede forma especificada fichero tamaño límite. ";
	$MusselConfig['lang']['upload_error_34']="Subir fracaso! Contacto el hostmaster para ayuda! ";
	$MusselConfig['lang']['upload_error_6']="Subir directorio desaparecido! Contacto el hostmaster para ayuda! ";
	$MusselConfig['lang']['upload_error_7']="Error en el disco contra escritura! Contacto el hostmaster para ayuda! ";
	$MusselConfig['lang']['upload_error_8']="PHP mala configuración detectado! Contacto el hostmaster para ayuda! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Subir límite excedido";
	$MusselConfig['lang']['wrong_password']="Contraseña incorrecta; Acción negada.";
	$MusselConfig['lang']['x_does_not_exist']="no existe";
	}
else if($MusselConfig['general']['lang']=="fr")
	{ // French
	$MusselConfig['lang']['cli_commands']=" q\n - Quitter CLI.\n - Alias: quit, exit.\n md5_file\n - Générer MD5 signatures des fichiers [Syntaxe: md5_file nom_de_fichier].\n - Alias: m.\n md5\n - Générer MD5 signature de string [Syntaxe: md5_file string].\n hex_encode\n - Convertir binaire string à hexadécimal [Syntaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadécimal à binaire string [Syntaxe: hex_decode string].\n base64_encode\n - Convertir binaire string à base64 string [Syntaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string à binaire string [Syntaxe: base64_decode string].\n scan\n - Analyser fichier ou répertoire [Syntaxe: scan nom_de_fichier].\n - Alias: s.\n update\n - Réactualiser phpMussel.\n - Alias: u.\n forcedupdate\n - Forcement réactualiser phpMussel.\n - Alias: f.\n c\n - Imprimer cette liste des commandes.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Échec du terminer le processus d'analyse";
	$MusselConfig['lang']['cli_is_not_a']="  n'est pas un fichier ou un répertoire.";
	$MusselConfig['lang']['cli_ln2']="  Merci pour d'utiliser phpMussel, un script en PHP basé sur les signatures de \n  ClamAV conçus pour détecter les virus, les malveillants logiciels et autres  \n     menaces dans les fichiers téléchargés sur votre système partout où le     \n                              script est accroché.                             \n     PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 by Caleb M (Maikuolan)    \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Fonctionne comme CLI mode pour le moment (Commande Ligne Interface).\n\n Pour analyser un fichier ou répertoire, taper 'scan', suivi par le nom du\n fichier ou répertoire que vous voulez phpMussel pour analyser et appuyez sur\n Entrée; Tapez 'c' et appuyez sur Entrée pour une liste de CLI mode commandes;\n Taper 'q' et appuyez sur Entrée pour quitter:";
	$MusselConfig['lang']['cli_update_restart']=" Redémarrage phpMussel peut être nécessaire avant les réactualisations deviennent apparents.";
	$MusselConfig['lang']['cli_working']="En cours";
	$MusselConfig['lang']['corrupted']="corrompu";
	$MusselConfig['lang']['denied_other']="Upload Denied! Subir Denegado! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Votre tentative à télécharger a été bloqué pour les raisons énumérées ci-dessous / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Téléchargement Refusé!";
	$MusselConfig['lang']['detected_control_characters']="Contrôle Caractères Détectés";
	$MusselConfig['lang']['detected']="Détecté";
	$MusselConfig['lang']['failed_to_access']="Échec d'accès ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Fichier taille limite dépassé";
	$MusselConfig['lang']['filetype_blacklisted']="Type de fichier sur la noire liste";
	$MusselConfig['lang']['finished']="Terminé";
	$MusselConfig['lang']['generated_by']="Généré&nbsp;par";
	$MusselConfig['lang']['invalid_file']="Fichier non valide";
	$MusselConfig['lang']['ok']="Bien";
	$MusselConfig['lang']['refer_to_scan_kills']=" (reportez-vous à ".$MusselConfig['general']['scan_kills']." pour détails)";
	$MusselConfig['lang']['scan_aborted']="Analyse avorté";
	$MusselConfig['lang']['scan_chameleon']="caméléon attaque détecté";
	$MusselConfig['lang']['scan_checking_contents']="Succès! Procédant à vérifier le contenu.";
	$MusselConfig['lang']['scan_checking']="Vérification";
	$MusselConfig['lang']['scan_command_injection']="Commande injection tentative détecté";
	$MusselConfig['lang']['scan_extensions_missing']="Manqué (manquant extensions requises)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Fichier nom manipulation détecté";
	$MusselConfig['lang']['scan_map_corrupted']="Signature carte corrompu";
	$MusselConfig['lang']['scan_map_missing']="Signature carte manquante";
	$MusselConfig['lang']['scan_missing_filename']="Nom de fichier manquant";
	$MusselConfig['lang']['scan_no_problems_found']="Pas problème trouvé.";
	$MusselConfig['lang']['scan_not_archive']="Manqué (vide ou pas une archive)!";
	$MusselConfig['lang']['scan_reading']="Accéder";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Signature fichier corrompu";
	$MusselConfig['lang']['scan_signature_file_missing']="Signature fichier manquant";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Non autorisée manipulation de téléchargement de fichiers ou mauvaise configuration détecté! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Non autorisée manipulation de téléchargement de fichiers détecté";
	$MusselConfig['lang']['started']="Commencé";
	$MusselConfig['lang']['update_']="phpMussel va maintenant tenter à réactualiser.";
	$MusselConfig['lang']['update_available']="Une réactualisation du script est disponible.";
	$MusselConfig['lang']['update_complete']="Réactualisation chèque réussi.";
	$MusselConfig['lang']['update_created']="créé";
	$MusselConfig['lang']['update_deleted']="supprimé";
	$MusselConfig['lang']['update_failed']="Manqué.";
	$MusselConfig['lang']['update_fetch']="Tenter d'apporter les données de la version de";
	$MusselConfig['lang']['update_no_source']="phpMussel n'a pas réussi à réactualiser parce qu'il ne pouvait pas connecter à une valide réactualisation source. Réactualisation manuelle est recommandé.";
	$MusselConfig['lang']['update_not']="PAS";
	$MusselConfig['lang']['update_not_available']="Aucune réactualisation du script est disponible à ce moment.";
	$MusselConfig['lang']['update_not_possible']="Une réactualisation du script est disponible, mais ne peut pas être entièrement réactualisé avec cette version du réactualisation script. S'il vous plaît réactualiser manuellement.";
	$MusselConfig['lang']['update_patched']="patché";
	$MusselConfig['lang']['update_scriptfile_missing']=" Réactualisation script fichier manquant! S'il vous plaît, réinstaller phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" secondes écoulées";
	$MusselConfig['lang']['update_signatures_available']="Une signatures réactualisation est disponible.";
	$MusselConfig['lang']['update_signatures_latest']="DERNIÈRES SIGNATURES";
	$MusselConfig['lang']['update_signatures_not_available']="Aucune réactualisation du signatures est disponible à ce moment.";
	$MusselConfig['lang']['update_signatures_yours']="VOS SIGNATURES";
	$MusselConfig['lang']['update_success']="Succès.";
	$MusselConfig['lang']['update_successfully']="avec succès";
	$MusselConfig['lang']['update_version_latest']="DERNIÈRE SCRIPT VERSION";
	$MusselConfig['lang']['update_version_yours']="VOS SCRIPT VERSION";
	$MusselConfig['lang']['upload_error_1']="Fichier taille dépasse MAX_FILE_SIZE directive. ";
	$MusselConfig['lang']['upload_error_2']="Fichier taille dépasse forme spécifiée fichier taille limite. ";
	$MusselConfig['lang']['upload_error_34']="Téléchargement échec! S'il vous plaît contacter le hostmaster pour l'aide! ";
	$MusselConfig['lang']['upload_error_6']="Téléchargement répertoire manquant! S'il vous plaît contacter le hostmaster pour l'aide! ";
	$MusselConfig['lang']['upload_error_7']="Disque-écriture erreur! S'il vous plaît contacter le hostmaster pour l'aide! ";
	$MusselConfig['lang']['upload_error_8']="PHP mauvaise configuration détecté! S'il vous plaît contacter le hostmaster pour l'aide! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Téléchargement limite dépassé";
	$MusselConfig['lang']['wrong_password']="Mauvais mot de passe; Action rejetée.";
	$MusselConfig['lang']['x_does_not_exist']="n'existe pas";
	}
else if($MusselConfig['general']['lang']=="id")
	{ // Indonesian
	$MusselConfig['lang']['cli_commands']=" q\n - Berhenti CLI.\n - Alias: quit, exit.\n md5_file\n - Menghasilkan tanda tangan MD5 dari file [Sintaksis: md5_file nama_file].\n - Alias: m.\n md5\n - Menghasilkan tanda tangan MD5 dari string [Sintaksis: md5_file string].\n hex_encode\n - Mengkonversi string biner ke heksadesimal [Sintaksis: hex_encode string].\n - Alias: x.\n hex_decode\n - Mengkonversi heksadesimal ke string biner [Sintaksis: hex_decode string].\n base64_encode\n - Mengkonversi string biner ke string base64 [Sintaksis: base64_encode string].\n - Alias: b.\n base64_decode\n - Mengkonversi string base64 ke string biner [Sintaksis: base64_decode string].\n scan\n - Pindai file atau direktori [Sintaksis: scan nama_file].\n - Alias: s.\n update\n - Memperbarui phpMussel.\n - Alias: u.\n forcedupdate\n - Paksa memperbarui phpMussel.\n - Alias: f.\n c\n - Cetak ini daftar perintah.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Gagal untuk menyelesaikan memindai proses";
	$MusselConfig['lang']['cli_is_not_a']=" bukan file atau direktori.";
	$MusselConfig['lang']['cli_ln2']=" Terima kasih untuk menggunakan phpMussel, sebuah script php berdasarkan tanda \n    tangan ClamAV di design untuk mendeteksi trojan-trojan, virus-virus dan    \n serangan-serangan lainnya dalam data-data diupload ke system anda dimana saja \n                               script di kaitkan.                              \n     PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPL V.2 oleh Caleb M (Maikuolan)\n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Sekarang phpMussel operasi di CLI mode (Command line interface).\n\n Untuk memindai file atau direktori, menulis 'scan', diikuti dengan nama file\n atau direktori yang ingin Anda phpMussel untuk memindai dan tekan Enter;\n Menulis 'c' dan tekan Enter untuk daftar CLI mode perintah; Menulis 'q' dan\n tekan Enter untuk keluar:";
	$MusselConfig['lang']['cli_update_restart']=" Restart phpMussel mungkin diperlukan sebelum perbarui menjadi jelas.";
	$MusselConfig['lang']['cli_working']="Dalam proses";
	$MusselConfig['lang']['corrupted']="rusak";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Subir Denegado! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Upload diblokir karena alasan yang tercantum di bawah / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Upload Ditolak!";
	$MusselConfig['lang']['detected_control_characters']="Terdeteksi Kontrol Karakter";
	$MusselConfig['lang']['detected']="Terdeteksi";
	$MusselConfig['lang']['failed_to_access']="Gagal untuk akses ";
	$MusselConfig['lang']['filesize_limit_exceeded']="File ukuran batas melebihi";
	$MusselConfig['lang']['filetype_blacklisted']="File jenis pada hitam daftar";
	$MusselConfig['lang']['finished']="Selesai";
	$MusselConfig['lang']['generated_by']="Dihasilkan&nbsp;oleh";
	$MusselConfig['lang']['invalid_file']="File tidak valid";
	$MusselConfig['lang']['ok']="Oke";
	$MusselConfig['lang']['refer_to_scan_kills']=" (mengacu pada ".$MusselConfig['general']['scan_kills']." untuk rincian)";
	$MusselConfig['lang']['scan_aborted']="Memindai dibatalkan";
	$MusselConfig['lang']['scan_chameleon']="bunglon serangan terdeteksi";
	$MusselConfig['lang']['scan_checking_contents']="Sukses! Melanjutkan untuk memeriksa isi.";
	$MusselConfig['lang']['scan_checking']="Memeriksa";
	$MusselConfig['lang']['scan_command_injection']="Perintah injeksi terdeteksi";
	$MusselConfig['lang']['scan_extensions_missing']="Gagal (hilang ekstensi yang dibutuhkan)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="File nama manipulasi terdeteksi";
	$MusselConfig['lang']['scan_map_corrupted']="Tanda tangan peta rusak";
	$MusselConfig['lang']['scan_map_missing']="Tanda tangan peta hilang";
	$MusselConfig['lang']['scan_missing_filename']="Hilang nama file";
	$MusselConfig['lang']['scan_no_problems_found']="Tidak ada masalah yang diketahui.";
	$MusselConfig['lang']['scan_not_archive']="Gagal (kosong atau tidak sebuah arsip)!";
	$MusselConfig['lang']['scan_reading']="Bacaan";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Tanda tangan file rusak";
	$MusselConfig['lang']['scan_signature_file_missing']="Tanda tangan file hilang";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Tidak sah file nama manipulasi atau salah-konfigurasi terdeteksi! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Tidak sah file nama manipulasi terdeteksi";
	$MusselConfig['lang']['started']="Dimulai";
	$MusselConfig['lang']['update_']="phpMussel sekarang akan mencoba untuk sendiri update.";
	$MusselConfig['lang']['update_available']="Update untuk skrip tersedia.";
	$MusselConfig['lang']['update_complete']="Update cek selesai dengan sukses.";
	$MusselConfig['lang']['update_created']="dibuat";
	$MusselConfig['lang']['update_deleted']="dihapus";
	$MusselConfig['lang']['update_failed']="Gagal.";
	$MusselConfig['lang']['update_fetch']="Mencoba untuk mengambil versi data dari";
	$MusselConfig['lang']['update_no_source']="phpMussel gagal untuk sendiri update karena tidak bisa terhubung ke valid update sumber. Update secara manual dianjurkan.";
	$MusselConfig['lang']['update_not']="TIDAK";
	$MusselConfig['lang']['update_not_available']="Skrip update yang tidak tersedia saat ini.";
	$MusselConfig['lang']['update_not_possible']="Skrip update yang tersedia, tetapi tidak dapat sepenuhnya diupdate dengan ini update skrip versi. Silahkan update secara manual.";
	$MusselConfig['lang']['update_patched']="ditambal";
	$MusselConfig['lang']['update_scriptfile_missing']=" Perbarui file script hilang! Silakan instal ulang phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" detik berlalu";
	$MusselConfig['lang']['update_signatures_available']="Tanda tangan yang tersedia.";
	$MusselConfig['lang']['update_signatures_latest']="TERAKHIR TANDA TANGAN";
	$MusselConfig['lang']['update_signatures_not_available']="Tanda tangan update yang tidak tersedia saat ini.";
	$MusselConfig['lang']['update_signatures_yours']="TANDA TANGAN ANDA";
	$MusselConfig['lang']['update_success']="Sukses.";
	$MusselConfig['lang']['update_successfully']="yang sukses";
	$MusselConfig['lang']['update_version_latest']="TERAKHIR SKRIPT VERSI";
	$MusselConfig['lang']['update_version_yours']="SKRIPT VERSI ANDA";
	$MusselConfig['lang']['upload_error_1']="File ukuran melebihi MAX_FILE_SIZE direktif. ";
	$MusselConfig['lang']['upload_error_2']="File ukuran melebihi formulir ditentukan file ukuran batas. ";
	$MusselConfig['lang']['upload_error_34']="Upload gagal! Silahkan hubungi hostmaster untuk bantuan! ";
	$MusselConfig['lang']['upload_error_6']="Upload direktori hilang! Silahkan hubungi hostmaster untuk bantuan! ";
	$MusselConfig['lang']['upload_error_7']="Disk-menulis kesalahan! Silahkan hubungi hostmaster untuk bantuan! ";
	$MusselConfig['lang']['upload_error_8']="PHP salah-konfigurasi terdeteksi! Silahkan hubungi hostmaster untuk bantuan! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Upload batas melebihi";
	$MusselConfig['lang']['wrong_password']="Password yang salah; Aksi ditolak.";
	$MusselConfig['lang']['x_does_not_exist']="tidak ada";
	}
else if($MusselConfig['general']['lang']=="it")
	{ // Italian
	$MusselConfig['lang']['cli_commands']=" q\n - Smettere CLI.\n - Alias: quit, exit.\n md5_file\n - Genera MD5 firme da file [Sintassi: md5_file filename].\n - Alias: m.\n md5\n - Genera MD5 firma da string [Sintassi: md5_file string].\n hex_encode\n - Convertire binaria string a esadecimale [Sintassi: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertire esadecimale a binaria string [Sintassi: hex_decode string].\n base64_encode\n - Convertire binaria string a base64 string [Sintassi: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertire base64 string a binaria string [Sintassi: base64_decode string].\n scan\n - Scansionare file o una cartella [Sintassi: scan filename].\n - Alias: s.\n update\n - Aggiornare phpMussel.\n - Alias: u.\n forcedupdate\n - Forzatamente aggiornare phpMussel.\n - Alias: f.\n c\n - Stampare questo lista dei comandi.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Fallimento a completa processo di scansione";
	$MusselConfig['lang']['cli_is_not_a']=" non è un file o una directory.";
	$MusselConfig['lang']['cli_ln2']=" Grazie per aver scelto phpMussel, uno PHP-basato script basato su ClamAV firme\n  progettato per individuare trojan, virus, malware e altre minacce all'interno\n          di file caricati nel sistema ovunque lo script è collegato.          \n      PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPL V.2 da Caleb M (Maikuolan)      \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Attualmente in esecuzione di phpMussel in CLI modalità (Comando riga\n\n interfaccia). Per scansione di un file o cartella, digitare 'scan', seguito dal nome del\n file o cartella che si desidera phpMussel per scansione e premere Enter;\n Digitare 'c' e premere Enter per un elenco dei CLI modalità comandi; Digitare\n 'q' e premere Enter per chiudere:";
	$MusselConfig['lang']['cli_update_restart']=" Riavvio di phpMussel può essere richiesto prima che gli aggiornamenti\n diventano evidenti.";
	$MusselConfig['lang']['cli_working']="In corso";
	$MusselConfig['lang']['corrupted']="corrotto";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Subir Denegado! Upload verweigert! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Il tentativo di caricamento è stato bloccato per i motivi elencati di seguito / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Carica Negato!";
	$MusselConfig['lang']['detected_control_characters']="Controllo Caratteri Rilevati";
	$MusselConfig['lang']['detected']="Rilevato";
	$MusselConfig['lang']['failed_to_access']="Fallimento all'accesso ";
	$MusselConfig['lang']['filesize_limit_exceeded']="File dimensione limite superato";
	$MusselConfig['lang']['filetype_blacklisted']="Tipo di file sulla nera lista";
	$MusselConfig['lang']['finished']="Finito";
	$MusselConfig['lang']['generated_by']="Generato&nbsp;da";
	$MusselConfig['lang']['invalid_file']="File non valido";
	$MusselConfig['lang']['ok']="Bene";
	$MusselConfig['lang']['refer_to_scan_kills']=" (riferimento alla ".$MusselConfig['general']['scan_kills']." per i dettagli)";
	$MusselConfig['lang']['scan_aborted']="Scansione interrotta";
	$MusselConfig['lang']['scan_chameleon']="camaleonte attacco rilevato";
	$MusselConfig['lang']['scan_checking_contents']="Successo! Procedendo per verificare i contenuti.";
	$MusselConfig['lang']['scan_checking']="Verificare";
	$MusselConfig['lang']['scan_command_injection']="Comando iniezione tentativo rilevato";
	$MusselConfig['lang']['scan_extensions_missing']="Mancato (Manca richieste estensioni)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="File nome manipolazione rilevato";
	$MusselConfig['lang']['scan_map_corrupted']="Firma mappa corrotto";
	$MusselConfig['lang']['scan_map_missing']="Firma mappa manca";
	$MusselConfig['lang']['scan_missing_filename']="Nome del file mancante";
	$MusselConfig['lang']['scan_no_problems_found']="Nessun problema trovato.";
	$MusselConfig['lang']['scan_not_archive']="Mancato (vuoto o non è un archivio)!";
	$MusselConfig['lang']['scan_reading']="Leggendo";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Firma file corrotto";
	$MusselConfig['lang']['scan_signature_file_missing']="Firma file manca";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Non autorizzato file nome manipolazione o male configurazione rilevato! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Non autorizzato file nome manipolazione rilevato";
	$MusselConfig['lang']['started']="Iniziato";
	$MusselConfig['lang']['update_']="phpMussel ora tenterà di aggiornarsi.";
	$MusselConfig['lang']['update_available']="Un script aggiornamento è disponibile.";
	$MusselConfig['lang']['update_complete']="Aggiornamento verifica completato con successo.";
	$MusselConfig['lang']['update_created']="creato";
	$MusselConfig['lang']['update_deleted']="cancellato";
	$MusselConfig['lang']['update_failed']="Mancato.";
	$MusselConfig['lang']['update_fetch']="Il tentativo di ottenere i dati della versione da";
	$MusselConfig['lang']['update_no_source']="phpMussel non è riuscito ad aggiornare perché non poteva connettersi a un valido aggiornamento origine. Aggiornamento manuale è consigliato.";
	$MusselConfig['lang']['update_not']="NON";
	$MusselConfig['lang']['update_not_available']="Nessun script aggiornamento è disponibile in questo momento.";
	$MusselConfig['lang']['update_not_possible']="Un script aggiornamento è disponibile, ma non può essere completamente aggiornato con questa versione dello aggiornamento script. Si prega aggiornare manualmente.";
	$MusselConfig['lang']['update_patched']="patchato";
	$MusselConfig['lang']['update_scriptfile_missing']=" Aggiornare script file è manca! Prego, reinstallare phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" secondi trascorsi";
	$MusselConfig['lang']['update_signatures_available']="Un aggiornamento delle firme è disponibile.";
	$MusselConfig['lang']['update_signatures_latest']="ULTIME FIRME";
	$MusselConfig['lang']['update_signatures_not_available']="Nessun aggiornamento delle firme è disponibile in questo momento.";
	$MusselConfig['lang']['update_signatures_yours']="VOSTRE FIRME";
	$MusselConfig['lang']['update_success']="Successo.";
	$MusselConfig['lang']['update_successfully']="con successo";
	$MusselConfig['lang']['update_version_latest']="ULTIMA SCRIPT VERSIONE";
	$MusselConfig['lang']['update_version_yours']="VOSTRE SCRIPT VERSIONE";
	$MusselConfig['lang']['upload_error_1']="File dimensione supera MAX_FILE_SIZE direttiva. ";
	$MusselConfig['lang']['upload_error_2']="File dimensione supera modulo specificato file dimensione limite. ";
	$MusselConfig['lang']['upload_error_34']="Carica fallimento! Si prega contattare il hostmaster per l'assistenza! ";
	$MusselConfig['lang']['upload_error_6']="Carica direttorio manca! Si prega contattare il hostmaster per l'assistenza! ";
	$MusselConfig['lang']['upload_error_7']="Errore del disco-scrittura! Si prega contattare il hostmaster per l'assistenza! ";
	$MusselConfig['lang']['upload_error_8']="PHP male configurazione rilevato! Si prega contattare il hostmaster per l'assistenza! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Upload limita supera";
	$MusselConfig['lang']['wrong_password']="Password errata; Azione negato.";
	$MusselConfig['lang']['x_does_not_exist']="non esiste";
	}
else if($MusselConfig['general']['lang']=="nl")
	{ // Dutch
	$MusselConfig['lang']['cli_commands']=" q\n - Verlaten CLI.\n - Aliassen: quit, exit.\n md5_file\n - Genereer MD5 handtekeningen van bestanden [Syntaxis: md5_file bestandsnaam].\n - Alias: m.\n md5\n - Genereer MD5 handtekening van string [Syntaxis: md5_file string].\n hex_encode\n - Converteren van binaire string naar hexadecimaal [Syntaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Converteren van hexadecimaal naar binaire string [Syntaxis: hex_decode string].\n base64_encode\n - Converteren van binaire string naar base64 string [Syntaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Converteren van base64 string naar binaire string [Syntaxis: base64_decode string].\n scan\n - Scannen bestand of map [Syntaxis: scan bestandsnaam].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n forcedupdate\n - Gedwongen update phpMussel.\n - Alias: f.\n c\n - Print dit commando lijst.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Mislukt om het voltooien te scannen";
	$MusselConfig['lang']['cli_is_not_a']=" is niet een bestand of map.";
	$MusselConfig['lang']['cli_ln2']=" Bedankt voor het gebruik van phpMussel, een PHP-gebaseerde script gebaseerd op\n  ClamAV handtekeningen ontworpen om detecteren trojans, virussen, malware en  \n andere bedreigingen binnen bestanden geüpload naar uw systeem waar het script \n                                is aangesloten.                                \n     PHPMUSSEL COPYRIGHT 2013 en verder GNU/GPL V.2 van Caleb M (Maikuolan)    \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Momenteel phpMussel is in CLI-modus (Commandlijn interface).\n\n Om scannen een bestand of map, typ 'scan', gevolgd door de naam van het\n bestand of de map die u wilt phpMussel te scannen en druk op Enter; Typ 'c' en\n druk op Enter voor een lijst op CLI-modus commandos; Typ 'q' en druk op Enter\n om te stoppen:";
	$MusselConfig['lang']['cli_update_restart']=" Herstarten phpMussel kan nodig zijn voordat updates zichtbaar worden.";
	$MusselConfig['lang']['cli_working']="Aan de gang";
	$MusselConfig['lang']['corrupted']="beschadigd";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Subir Denegado! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="De upload poging werd geblokkeerd voor de hieronder vermelde redenen / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Upload Geweigerd!";
	$MusselConfig['lang']['detected_control_characters']="Gedetecteerd Controle Karakters";
	$MusselConfig['lang']['detected']="Gedetecteerd";
	$MusselConfig['lang']['failed_to_access']="Mislukt om toegang ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Bestandsgrootte limiet overschreden";
	$MusselConfig['lang']['filetype_blacklisted']="Bestandstype in zwarte lijst";
	$MusselConfig['lang']['finished']="Afgewerkt";
	$MusselConfig['lang']['generated_by']="Gegenereerde&nbsp;door";
	$MusselConfig['lang']['invalid_file']="Ongeldig bestand";
	$MusselConfig['lang']['ok']="OK";
	$MusselConfig['lang']['refer_to_scan_kills']=" (verwijzen naar ".$MusselConfig['general']['scan_kills']." voor meer informatie)";
	$MusselConfig['lang']['scan_aborted']="Scannen afgebroken";
	$MusselConfig['lang']['scan_chameleon']="kameleon aanval gedetecteerd";
	$MusselConfig['lang']['scan_checking_contents']="Succes! Gaan tot verifiëren de inhoud.";
	$MusselConfig['lang']['scan_checking']="Verifiëren";
	$MusselConfig['lang']['scan_command_injection']="Command injectie poging gedetecteerd";
	$MusselConfig['lang']['scan_extensions_missing']="Mislukt (ontbrekende vereiste extensies)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Bestandsnaam manipulatie ontdekt";
	$MusselConfig['lang']['scan_map_corrupted']="Handtekening kaart beschadigd";
	$MusselConfig['lang']['scan_map_missing']="Handtekening kaart ontbrekende";
	$MusselConfig['lang']['scan_missing_filename']="Ontbrekende bestandsnaam";
	$MusselConfig['lang']['scan_no_problems_found']="Geen problemen gevonden.";
	$MusselConfig['lang']['scan_not_archive']="Mislukt (leeg of is geen archief)!";
	$MusselConfig['lang']['scan_reading']="Lezen van";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Handtekening bestand beschadigd";
	$MusselConfig['lang']['scan_signature_file_missing']="Handtekening bestand ontbreekt";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Ongeautoriseerde bestand uploaden manipulatie of misconfiguratie gedetecteerd! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="ngeautoriseerde bestand uploaden manipulatie gedetecteerd";
	$MusselConfig['lang']['started']="Gestart";
	$MusselConfig['lang']['update_']="phpMussel zal nu proberen om zichzelf te bijwerken.";
	$MusselConfig['lang']['update_available']="Een script bijwerk is beschikbaar.";
	$MusselConfig['lang']['update_complete']="Bijwerk verificatie afgerond geslaagd.";
	$MusselConfig['lang']['update_created']="gecreëerd";
	$MusselConfig['lang']['update_deleted']="verwijderd";
	$MusselConfig['lang']['update_failed']="Mislukt.";
	$MusselConfig['lang']['update_fetch']="Proberen te halen versie gegevens van";
	$MusselConfig['lang']['update_no_source']="phpMussel heeft mislukt te bijwerken, omdat het niet kon verbinden met een geldige bijwerkenbron. Handmatig bijwerk zijn aanbevolen.";
	$MusselConfig['lang']['update_not']="NIET";
	$MusselConfig['lang']['update_not_available']="Geen script bijwerk beschikbaar op dit moment.";
	$MusselConfig['lang']['update_not_possible']="Een script bijwerk zijn beschikbaar, maar kan niet worden volledig bijgewerkt met deze versie van de bijwerkscript. Alstublieft bijwerken handmatig.";
	$MusselConfig['lang']['update_patched']="versteld";
	$MusselConfig['lang']['update_scriptfile_missing']=" Update script bestand vermist! Opnieuw installeer phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" seconden verstreken";
	$MusselConfig['lang']['update_signatures_available']="Een handtekeningen bijwerken zijn beschikbaar.";
	$MusselConfig['lang']['update_signatures_latest']="LAATSTE HANDTEKENINGEN";
	$MusselConfig['lang']['update_signatures_not_available']="Geen handtekeningen bijwerken beschikbaar op dit moment.";
	$MusselConfig['lang']['update_signatures_yours']="UW HANDTEKENINGEN";
	$MusselConfig['lang']['update_success']="Succes.";
	$MusselConfig['lang']['update_successfully']="met succes";
	$MusselConfig['lang']['update_version_latest']="NIEUWSTE SCRIPT VERSIE";
	$MusselConfig['lang']['update_version_yours']="UW SCRIPT VERSIE";
	$MusselConfig['lang']['upload_error_1']="Bestandsgrootte overschrijdt MAX_FILE_SIZE richtlijn. ";
	$MusselConfig['lang']['upload_error_2']="Bestandsgrootte overschrijdt vorm gespecificeerde bestandsgrootte limiet. ";
	$MusselConfig['lang']['upload_error_34']="Upload mislukking! Contact op met de hostmaster voor hulp! ";
	$MusselConfig['lang']['upload_error_6']="Uploadmap ontbreekt! Contact op met de hostmaster voor hulp! ";
	$MusselConfig['lang']['upload_error_7']="Disc-schrijffout! Contact op met de hostmaster voor hulp! ";
	$MusselConfig['lang']['upload_error_8']="PHP misconfiguratie gedetecteerd! Contact op met de hostmaster voor hulp! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Uploadlimiet overschreden";
	$MusselConfig['lang']['wrong_password']="Verkeerd wachtwoord; Actie geweigerd.";
	$MusselConfig['lang']['x_does_not_exist']="niet bestaat";
	}
else if($MusselConfig['general']['lang']=="pt")
	{ // Portuguese
	$MusselConfig['lang']['cli_commands']=" q\n - Deixar CLI.\n - Alias: quit, exit.\n md5_file\n - Gerar MD5 assinaturas de arquivos [Sintaxe: md5_file nome_do_arquivo].\n - Alias: m.\n md5\n - Gerar MD5 assinatura de string [Sintaxe: md5_file string].\n hex_encode\n - Converter binária string para hexadecimal [Sintaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Converter hexadecimal para binária string [Sintaxe: hex_decode string].\n base64_encode\n - Converter binária string para base64 string [Sintaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Converter base64 string para binária string [Sintaxe: base64_decode string].\n scan\n - Verificação arquivo ou diretório [Sintaxe: scan nome_do_arquivo].\n - Alias: s.\n update\n - Atualizar phpMussel.\n - Alias: u.\n forcedupdate\n - Forçosamente atualizar phpMussel.\n - Alias: f.\n c\n - Imprimir esta lista de comandos.\n";
	$MusselConfig['lang']['cli_failed_to_complete']="Falha ao completar processo de verificação";
	$MusselConfig['lang']['cli_is_not_a']=" não é um arquivo ou diretório.";
	$MusselConfig['lang']['cli_ln2']="    Obrigado por usando phpMussel, um script baseado em php baseado em ClamAV  \n  assinaturas projetado para detectar trojans, vírus, malware e outras ameaças \n    dentro arquivos uploaded para seu sistema sempre que script é enganchado.  \n   PHPMUSSEL COPYRIGHT 2013 e além GNU/GPL V.2 através do Caleb M (Maikuolan)  \n\n                                     ~ ~ ~                                     \n\n";
	$MusselConfig['lang']['cli_ln3']=" Correntemente execução phpMussel em CLI modo (Comando linha interface).\n\n Para analisar um arquivo ou diretório, digitá 'scan', seguido pelo nome do\n arquivo ou diretório que você deseja phpMussel para analisar e pressione\n Enter; Digitá 'c' e pressione Enter por uma lista de CLI modo comandos; Digitá\n 'q' e pressione Enter para sair:";
	$MusselConfig['lang']['cli_update_restart']=" Reiniciando phpMussel podem ser necessários antes que as atualizações se\n tornam aparentes.";
	$MusselConfig['lang']['cli_working']="Em processo";
	$MusselConfig['lang']['corrupted']="corrompido";
	$MusselConfig['lang']['denied_other']="Upload Denied! Télécharger Refusé! Subir Denegado! Upload verweigert! Carica Negato! &#12450;&#12483;&#12503;&#12525;&#12540;&#12489;&#21542;&#23450;&#12373;&#12428;&#12414;&#12375;&#12383;! &#19978;&#36733;&#21542;&#35748;! &#19978;&#36617;&#21542;&#35469;! Uppladda Nekas! &#1047;&#1072;&#1075;&#1088;&#1091;&#1079;&#1080;&#1090;&#1100; &#1054;&#1090;&#1082;&#1072;&#1079;&#1072;&#1085;&#1086;! Confiar Negado! Aug&#353;upiel&#257;d&#275;t Liegta! &#50629;&#47196;&#46300; &#44144;&#48512;! &#1606;&#1601;&#1609; &#1578;&#1581;&#1605;&#1610;&#1604;!";
	$MusselConfig['lang']['denied_reason']="Carregamento tentativa foi bloqueado pelos motivos a seguir indicados / Your upload attempt was blocked for the reasons listed below:";
	$MusselConfig['lang']['denied']="Carregar Negado!";
	$MusselConfig['lang']['detected_control_characters']="Detectados Controle Caracteres";
	$MusselConfig['lang']['detected']="Detectado";
	$MusselConfig['lang']['failed_to_access']="Falha ao acesso ";
	$MusselConfig['lang']['filesize_limit_exceeded']="Arquivo tamanho limite excedido";
	$MusselConfig['lang']['filetype_blacklisted']="Tipo de arquivo está na negra lista";
	$MusselConfig['lang']['finished']="Terminado";
	$MusselConfig['lang']['generated_by']="Gerado&nbsp;por";
	$MusselConfig['lang']['invalid_file']="Inválido arquivo";
	$MusselConfig['lang']['ok']="OK";
	$MusselConfig['lang']['refer_to_scan_kills']=" (referem a ".$MusselConfig['general']['scan_kills']." para detalhes)";
	$MusselConfig['lang']['scan_aborted']="Verificação abortado";
	$MusselConfig['lang']['scan_chameleon']="camaleão ataque detectado";
	$MusselConfig['lang']['scan_checking_contents']="Sucesso! Prosseguindo para verificar o conteúdo.";
	$MusselConfig['lang']['scan_checking']="Verificação";
	$MusselConfig['lang']['scan_command_injection']="Comando injeção tentativa detectado";
	$MusselConfig['lang']['scan_extensions_missing']="Fracassado (faltando extensões necessárias)!";
	$MusselConfig['lang']['scan_filename_manipulation_detected']="Arquivo nome manipulação detectado";
	$MusselConfig['lang']['scan_map_corrupted']="Assinatura mapa corrompido";
	$MusselConfig['lang']['scan_map_missing']="Assinatura mapa faltando";
	$MusselConfig['lang']['scan_missing_filename']="Nome do arquivo está ausente";
	$MusselConfig['lang']['scan_no_problems_found']="Não problemas encontrados.";
	$MusselConfig['lang']['scan_not_archive']="Fracassado (vazio ou não um arquivo)!";
	$MusselConfig['lang']['scan_reading']="Lendo";
	$MusselConfig['lang']['scan_signature_file_corrupted']="Assinatura arquivo corrompido";
	$MusselConfig['lang']['scan_signature_file_missing']="Assinatura arquivo faltando";
	$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']="Não autorizada Arquivo carregar manipulação ou mau configuração detectado! ";
	$MusselConfig['lang']['scan_unauthorised_upload']="Não autorizada Arquivo carregar manipulação detectado";
	$MusselConfig['lang']['started']="Começado";
	$MusselConfig['lang']['update_']="phpMussel agora tentará se atualizar.";
	$MusselConfig['lang']['update_available']="Uma atualização de script está disponível.";
	$MusselConfig['lang']['update_complete']="Verificação de atualização concluída com êxito.";
	$MusselConfig['lang']['update_created']="criado";
	$MusselConfig['lang']['update_deleted']="deletado";
	$MusselConfig['lang']['update_failed']="Fracassado.";
	$MusselConfig['lang']['update_fetch']="A tentativa de buscar dados de versão de";
	$MusselConfig['lang']['update_no_source']="phpMussel falhou a atualizar-se porque não pôde conectar a uma válido atualização fonte. Atualizando manualmente é recomendado.";
	$MusselConfig['lang']['update_not']="NÃO";
	$MusselConfig['lang']['update_not_available']="Nenhuma script atualização está disponível no momento.";
	$MusselConfig['lang']['update_not_possible']="Uma script atualização está disponível, mas não pode ser totalmente atualizado com esta versão do atualização script. Por favor atualize manualmente.";
	$MusselConfig['lang']['update_patched']="remendado";
	$MusselConfig['lang']['update_scriptfile_missing']=" Atualização script arquivo faltando! Por favor, reinstale phpMussel.";
	$MusselConfig['lang']['update_seconds_elapsed']=" segundos transcorridos";
	$MusselConfig['lang']['update_signatures_available']="Uma atualização de assinaturas está disponível.";
	$MusselConfig['lang']['update_signatures_latest']="ÚLTIMAS ASSINATURAS";
	$MusselConfig['lang']['update_signatures_not_available']="Nenhuma atualização de assinaturas está disponível neste momento.";
	$MusselConfig['lang']['update_signatures_yours']="SEUS ASSINATURAS";
	$MusselConfig['lang']['update_success']="Sucesso.";
	$MusselConfig['lang']['update_successfully']="com sucesso";
	$MusselConfig['lang']['update_version_latest']="ÚLTIMA SCRIPT VERSÃO";
	$MusselConfig['lang']['update_version_yours']="SEU SCRIPT VERSÃO";
	$MusselConfig['lang']['upload_error_1']="Arquivo tamanho excede MAX_FILE_SIZE directiva. ";
	$MusselConfig['lang']['upload_error_2']="Arquivo tamanho excede formulário especificados arquivo tamanho limite. ";
	$MusselConfig['lang']['upload_error_34']="Carregar falha! Contato o hostmaster para ajuda! ";
	$MusselConfig['lang']['upload_error_6']="Carregar diretório faltando! Contato o hostmaster para ajuda! ";
	$MusselConfig['lang']['upload_error_7']="Disco escrita erro! Contato o hostmaster para ajuda! ";
	$MusselConfig['lang']['upload_error_8']="PHP mau configuração detectado! Contato o hostmaster para ajuda! ";
	$MusselConfig['lang']['upload_limit_exceeded']="Carregar limite excedido";
	$MusselConfig['lang']['wrong_password']="Wrong password; Action denied.";
	$MusselConfig['lang']['x_does_not_exist']="não existe";
	}
else
	{
	die("[phpMussel] Language undefined or incorrectly defined. Can\'t continue.");
	}

?>