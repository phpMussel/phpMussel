<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

 Thank you for using phpMussel, a PHP script designed to detect trojans,
 viruses, malware and other threats within files uploaded to your system
 wherever the script is hooked, based on the signatures of ClamAV and others.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).

 This document and its associated package can be downloaded for free from:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~
 This File: phpMussel German/Deutsch Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.de.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Entschuldigung, ich verstehe diesen Befehl nicht.';
$MusselConfig['lang']['cli_commands']="q\n - Beendet den CLI-Modus.\n - Alias: quit, exit.\n md5_file\n - Generiert MD5-Signaturen einer Datei\n   [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generiert MD5-Signaturen eines String-Wertes\n   [Syntax: md5 string].\n hex_encode\n - Konvertiert einen Binär-Wert in einen Hexidezimal-Wert\n   [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Konvertiert einen Hexidezimal-Wert in einen Binär-Wert\n   [Syntax: hex_decode string].\n base64_encode\n -  Konvertiert einen Binär-Wert in einen Base64-Wert\n   [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Konvertiert einen Base64-Wert in einen Binär-Wert\n   [Syntax: base64_decode string].\n scan\n - Überprüft eine Datei oder ein Verzeichnis\n   [Syntax: scan filename].\n - Alias: s.\n update\n - Aktualisiert phpMussel.\n - Alias: u.\n c\n - Gibt diese Befehlsliste aus.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Ein vollständiger Scan konnte nicht durchgeführt werden';
$MusselConfig['lang']['cli_is_not_a']=' ist keine Datei oder ein Verzeichnis.';
$MusselConfig['lang']['cli_ln2']=" Vielen Dank für die Benutzung von phpMussel, einem auf PHP basiertem Script,\n um Trojaner, Viren, Malware und andere Bedrohungen in Dateien zu entdecken,\n die auf Ihr System hochgeladen werden könnten, welches die Signaturen von\n ClamAV und andere nutzt.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" phpMussel befindet sich im CLI-Modus (Command line interface).\n\n Um eine Datei oder ein Verzeichnis mit phpMussel zu überprüfen, geben Sie\n 'scan', gefolgt vom Namen der Datei oder des Verzeichnisses ein und\n bestätigen mit Enter;\n\n Geben Sie 'c' und Enter für eine Liste der verfügbaren Befehle im CLI-Modus\n ein; Geben Sie 'q' und Enter zum Beenden ein: ";
$MusselConfig['lang']['cli_pe1']='Keine gültige PE-Datei!';
$MusselConfig['lang']['cli_pe2']='PE-Sektionen:';
$MusselConfig['lang']['cli_update_restart']=' phpMussel muss neu gestartet werden, damit die Aktualisierungen wirksam werden.';
$MusselConfig['lang']['cli_working']='Im Gange';
$MusselConfig['lang']['controls_lockout']='phpMussel Kontrollen-Sperrung aktiviert.';
$MusselConfig['lang']['core_scriptfile_missing']='Coree-Script Datei fehlt! Bitte phpMussel erneut installieren.';
$MusselConfig['lang']['corrupted']='Beschädigte PE entdeckt';
$MusselConfig['lang']['denied']='Upload verweigert!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Der Upload wurde aus den unten aufgeführten Gründen blockiert / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Entdeckt {vn}';
$MusselConfig['lang']['detected_control_characters']='Steuerzeichen erkannt';
$MusselConfig['lang']['encrypted_archive']='Verschlüsseltes Archiv entdeckt; Verschlüsselte Archive sind nicht erlaubt';
$MusselConfig['lang']['failed_to_access']='Zugriff fehlgeschlagen auf ';
$MusselConfig['lang']['file']='Datei';
$MusselConfig['lang']['filesize_limit_exceeded']='Dateigröße überschritten';
$MusselConfig['lang']['filetype_blacklisted']='Dateityp auf Blacklist';
$MusselConfig['lang']['finished']='Fertig';
$MusselConfig['lang']['generated_by']='Generiert von';
$MusselConfig['lang']['greylist_cleared']=' Greylist gelöscht.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist nicht aktualisiert.';
$MusselConfig['lang']['greylist_updated']=' Greylist aktualisiert.';
$MusselConfig['lang']['image']='Bild';
$MusselConfig['lang']['instance_already_active']='Instanz bereits aktiv! Bitte prüfe deine Hooks.';
$MusselConfig['lang']['invalid_file']='Ungültige Datei';
$MusselConfig['lang']['ok']='OK';
$MusselConfig['lang']['only_allow_images']='Upload von Nicht-Bilddateien ist nicht erlaubt';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel deaktiviert.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel bereits deaktiviert.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel aktiviert.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel bereits aktiviert.';
$MusselConfig['lang']['recursive']='Rekursionstiefe-Limit überschritten';
$MusselConfig['lang']['refer_to_scan_kills']=' (lesen Sie '.$MusselConfig['general']['scan_kills'].' für Details)';
$MusselConfig['lang']['required_variables_not_defined']='Benötigte Variablen sind nicht definiert: Kann nicht fortfahren.';
$MusselConfig['lang']['scan_aborted']='Scan abgebrochen';
$MusselConfig['lang']['scan_chameleon']='{x}-Chamäleon-Angriff erkannt';
$MusselConfig['lang']['scan_checking']='Überprüfung';
$MusselConfig['lang']['scan_checking_contents']='Erfolg! Überprüfe Inhalte.';
$MusselConfig['lang']['scan_command_injection']='CMD-Injektion erkannt';
$MusselConfig['lang']['scan_complete']='Komplett';
$MusselConfig['lang']['scan_extensions_missing']='Gescheitert (fehlende benötigte Erweiterungen)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Manipulation des Dateinamens erkannt';
$MusselConfig['lang']['scan_map_corrupted']='Signaturkarte beschädigt';
$MusselConfig['lang']['scan_map_missing']='Signaturkarte fehlt';
$MusselConfig['lang']['scan_missing_filename']='Fehlender Dateiname';
$MusselConfig['lang']['scan_not_archive']='Gescheitert (leer oder kein Archiv)!';
$MusselConfig['lang']['scan_no_problems_found']='Keine Probleme gefunden.';
$MusselConfig['lang']['scan_reading']='Lesen';
$MusselConfig['lang']['scan_signature_file_corrupted']='Signaturdatei beschädigt';
$MusselConfig['lang']['scan_signature_file_missing']='Signaturdatei fehlt';
$MusselConfig['lang']['scan_tampering']='Potentiell gefährliche Datei-Manipulation erkannt';
$MusselConfig['lang']['scan_unauthorised_upload']='Unerlaubte Upload-Manipulation erkannt';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Unerlaubte Upload-Manipulation oder Fehlkonfiguration erkannt! ';
$MusselConfig['lang']['started']='Gestartet';
$MusselConfig['lang']['update_']='phpMussel wird nun versuchen, sich zu aktualisieren.';
$MusselConfig['lang']['update_available']='Ein Script-Update ist verfügbar.';
$MusselConfig['lang']['update_complete']='Update-Prüfung erfolgreich abgeschlossen.';
$MusselConfig['lang']['update_created']='erstellt';
$MusselConfig['lang']['update_deleted']='gelöscht';
$MusselConfig['lang']['update_err1']='Nicht aktualisiert: \'update.dat\' fehlt. Erneut installieren oder manuell aktualisieren.';
$MusselConfig['lang']['update_err2']='Nicht aktualisiert: \'update.dat\' keine gültigen Update-Quellen enthalten. Bitte aktualisieren Sie manuell.';
$MusselConfig['lang']['update_err3']='Möglicher Hack oder Fälschung in den von der Update-Quelle angebotenen Update-Anweisungen erkannt; Quelle wurde möglicherweise beeinträchtigt. Bitte benachrichtigen Sie den Skript-Autor. Manuelle Aktualisierung wird empfohlen.';
$MusselConfig['lang']['update_err4']='Checksumme fehlt!';
$MusselConfig['lang']['update_err5']='Daten fehlen!';
$MusselConfig['lang']['update_err6']='Daten beschädigt!';
$MusselConfig['lang']['update_err7']='Checksumme beschädigt!';
$MusselConfig['lang']['update_failed']='Gescheitert.';
$MusselConfig['lang']['update_fetch']='Abrufen von Versionsdaten aus';
$MusselConfig['lang']['update_lock_detected']='Update-Sperrung entdeckt: Kann nicht fortfahren. Prüf auf fehlerhafte Updates oder versuch es später nochmal.';
$MusselConfig['lang']['update_not']='NICHT {x}';
$MusselConfig['lang']['update_not_available']='Es steht zur Zeit kein Script-Update zur Verfügung.';
$MusselConfig['lang']['update_not_possible']='Ein Script-Update ist verfügbar, kann aber nicht vollständig mit dieser Version des Update-Scripts aktualisiert werden. Bitte aktualisieren Sie manuell.';
$MusselConfig['lang']['update_no_source']='phpMussel konnte nicht aktualisiert werden, da es sich nicht zu einer gültigen Update-Quelle verbinden konnte. Manuelles Update wird empfohlen.';
$MusselConfig['lang']['update_patched']='gepatcht';
$MusselConfig['lang']['update_scriptfile_missing']=' Update-Script fehlt! Bitte installieren Sie phpMussel erneut.';
$MusselConfig['lang']['update_seconds_elapsed']=' Sekunden verstrichen';
$MusselConfig['lang']['update_signatures_available']='Ein Signaturenupdate ist verfügbar.';
$MusselConfig['lang']['update_signatures_latest']='AKTUELLE SIGNATUREN';
$MusselConfig['lang']['update_signatures_not_available']='Es steht zur Zeit kein Signaturenupdate zur Verfügung.';
$MusselConfig['lang']['update_signatures_yours']='IHRE SIGNATUREN';
$MusselConfig['lang']['update_success']='Erfolgreich.';
$MusselConfig['lang']['update_successfully']=' erfolgreich';
$MusselConfig['lang']['update_version_latest']='AKTUELLE SCRIPT VERSION';
$MusselConfig['lang']['update_version_yours']='IHRE SCRIPT VERSION';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='Signaturen';
$MusselConfig['lang']['upload_error_1']='Dateigröße überschreitet die Richtlinie MAX_FILE_SIZE. ';
$MusselConfig['lang']['upload_error_2']='Dateigröße überschreitet die im Formular angegebene Dateigröße. ';
$MusselConfig['lang']['upload_error_34']='Upload gescheitert! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$MusselConfig['lang']['upload_error_6']='Fehlendes Uploadverzeichnis! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$MusselConfig['lang']['upload_error_7']='Festplatten-Schreibfehler! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$MusselConfig['lang']['upload_error_8']='PHP-Fehlkonfiguration erkannt! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$MusselConfig['lang']['upload_limit_exceeded']='Uploadlimit überschritten';
$MusselConfig['lang']['wrong_password']='Falsches Passwort; Ausführung des Befehls verweigert.';
$MusselConfig['lang']['x_does_not_exist']='nicht vorhanden';

?>