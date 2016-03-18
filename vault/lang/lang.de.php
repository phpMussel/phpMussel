<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: German language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'Entschuldigung, ich verstehe diesen Befehl nicht.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Beendet den CLI-Modus.\n - Alias: quit, exit.\n md5_file\n - Generiert MD5-Signaturen einer Datei\n   [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generiert MD5-Signaturen eines String-Wertes\n   [Syntax: md5 string].\n hex_encode\n - Konvertiert einen Binär-Wert in einen Hexidezimal-Wert\n   [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Konvertiert einen Hexidezimal-Wert in einen Binär-Wert\n   [Syntax: hex_decode string].\n base64_encode\n -  Konvertiert einen Binär-Wert in einen Base64-Wert\n   [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Konvertiert einen Base64-Wert in einen Binär-Wert\n   [Syntax: base64_decode string].\n scan\n - Überprüft eine Datei oder ein Verzeichnis\n   [Syntax: scan filename].\n - Alias: s.\n update\n - Aktualisiert phpMussel.\n - Alias: u.\n c\n - Gibt diese Befehlsliste aus.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'Ein vollständiger Scan konnte nicht durchgeführt werden';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' ist keine Datei oder ein Verzeichnis.';
$phpMussel['Config']['lang']['cli_ln2'] = " Vielen Dank für die Benutzung von phpMussel, einem auf PHP basiertem Script,\n um Trojaner, Viren, Malware und andere Bedrohungen in Dateien zu entdecken,\n die auf Ihr System hochgeladen werden könnten, welches die Signaturen von\n ClamAV und andere nutzt.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " phpMussel befindet sich im CLI-Modus (Command Line Interface).\n\n Um eine Datei oder ein Verzeichnis mit phpMussel zu überprüfen, geben Sie\n 'scan', gefolgt vom Namen der Datei oder des Verzeichnisses ein und\n bestätigen mit Enter;\n\n Geben Sie 'c' und Enter für eine Liste der verfügbaren Befehle im CLI-Modus\n ein; Geben Sie 'q' und Enter zum Beenden ein: ";
$phpMussel['Config']['lang']['cli_pe1'] = 'Keine gültige PE-Datei!';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE-Sektionen:';
$phpMussel['Config']['lang']['cli_update_restart'] = ' phpMussel muss neu gestartet werden, damit die Aktualisierungen wirksam werden.';
$phpMussel['Config']['lang']['cli_working'] = 'Im Gange';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel Kontrollen-Sperrung aktiviert.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Coree-Script Datei fehlt! Bitte phpMussel erneut installieren.';
$phpMussel['Config']['lang']['corrupted'] = 'Beschädigte PE entdeckt';
$phpMussel['Config']['lang']['denied'] = 'Upload verweigert!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'Der Upload wurde aus den unten aufgeführten Gründen blockiert / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Entdeckt {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Steuerzeichen erkannt';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Verschlüsseltes Archiv entdeckt; Verschlüsselte Archive sind nicht erlaubt';
$phpMussel['Config']['lang']['failed_to_access'] = 'Zugriff fehlgeschlagen auf ';
$phpMussel['Config']['lang']['file'] = 'Datei';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Dateigröße überschritten';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Dateityp auf Blacklist';
$phpMussel['Config']['lang']['finished'] = 'Fertig';
$phpMussel['Config']['lang']['generated_by'] = 'Generiert von';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Greylist gelöscht.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Greylist nicht aktualisiert.';
$phpMussel['Config']['lang']['greylist_updated'] = ' Greylist aktualisiert.';
$phpMussel['Config']['lang']['image'] = 'Bild';
$phpMussel['Config']['lang']['instance_already_active'] = 'Instanz bereits aktiv! Bitte prüfe deine Hooks.';
$phpMussel['Config']['lang']['invalid_file'] = 'Ungültige Datei';
$phpMussel['Config']['lang']['invalid_url'] = 'Ungültige URL!';
$phpMussel['Config']['lang']['ok'] = 'OK';
$phpMussel['Config']['lang']['only_allow_images'] = 'Upload von Nicht-Bilddateien ist nicht erlaubt';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel deaktiviert.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel bereits deaktiviert.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel aktiviert.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel bereits aktiviert.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Plugin-Verzeichnis nicht vorhanden!';
$phpMussel['Config']['lang']['recursive'] = 'Rekursionstiefe-Limit überschritten';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Benötigte Variablen sind nicht definiert: Kann nicht fortfahren.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Scan abgebrochen!';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x}-Chamäleon-Angriff erkannt';
$phpMussel['Config']['lang']['scan_checking'] = 'Überprüfung';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Erfolg! Überprüfe Inhalte.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'CMD-Injektion erkannt';
$phpMussel['Config']['lang']['scan_complete'] = 'Komplett';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Gescheitert (fehlende benötigte Erweiterungen)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Manipulation des Dateinamens erkannt';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Signaturkarte beschädigt';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Signaturkarte fehlt';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Fehlender Dateiname';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Gescheitert (leer oder kein Archiv)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'Keine Probleme gefunden.';
$phpMussel['Config']['lang']['scan_reading'] = 'Lesen';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Signaturdatei beschädigt';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Signaturdatei fehlt';
$phpMussel['Config']['lang']['scan_tampering'] = 'Potentiell gefährliche Datei-Manipulation erkannt';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'Unerlaubte Upload-Manipulation erkannt';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'Unerlaubte Upload-Manipulation oder Fehlkonfiguration erkannt! ';
$phpMussel['Config']['lang']['started'] = 'Gestartet';
$phpMussel['Config']['lang']['too_many_urls'] = 'Zu viele URLs';
$phpMussel['Config']['lang']['update_'] = 'phpMussel wird nun versuchen, sich zu aktualisieren.';
$phpMussel['Config']['lang']['update_available'] = 'Ein Script-Update ist verfügbar.';
$phpMussel['Config']['lang']['update_complete'] = 'Update-Prüfung erfolgreich abgeschlossen.';
$phpMussel['Config']['lang']['update_created'] = 'erstellt';
$phpMussel['Config']['lang']['update_deleted'] = 'gelöscht';
$phpMussel['Config']['lang']['update_err1'] = 'Nicht aktualisiert: \'update.dat\' fehlt. Erneut installieren oder manuell aktualisieren.';
$phpMussel['Config']['lang']['update_err2'] = 'Nicht aktualisiert: \'update.dat\' keine gültigen Update-Quellen enthalten. Bitte aktualisieren Sie manuell.';
$phpMussel['Config']['lang']['update_err3'] = 'Möglicher Hack oder Fälschung in den von der Update-Quelle angebotenen Update-Anweisungen erkannt; Quelle wurde möglicherweise beeinträchtigt. Bitte benachrichtigen Sie den Skript-Autor. Manuelle Aktualisierung wird empfohlen.';
$phpMussel['Config']['lang']['update_err4'] = 'Checksumme fehlt!';
$phpMussel['Config']['lang']['update_err5'] = 'Daten fehlen!';
$phpMussel['Config']['lang']['update_err6'] = 'Daten beschädigt!';
$phpMussel['Config']['lang']['update_err7'] = 'Checksumme beschädigt!';
$phpMussel['Config']['lang']['update_failed'] = 'Gescheitert.';
$phpMussel['Config']['lang']['update_fetch'] = 'Abrufen von Versionsdaten aus {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Update-Sperrung entdeckt: Kann nicht fortfahren. Prüf auf fehlerhafte Updates oder versuch es später nochmal.';
$phpMussel['Config']['lang']['update_not'] = 'NICHT {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'Es steht zur Zeit kein Script-Update zur Verfügung.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Ein Script-Update ist verfügbar, kann aber nicht vollständig mit dieser Version des Update-Scripts aktualisiert werden. Bitte aktualisieren Sie manuell.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel konnte nicht aktualisiert werden, da es sich nicht zu einer gültigen Update-Quelle verbinden konnte. Manuelles Update wird empfohlen.';
$phpMussel['Config']['lang']['update_patched'] = 'gepatcht';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Update-Script fehlt! Bitte installieren Sie phpMussel erneut.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' Sekunden verstrichen';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Ein Signaturenupdate ist verfügbar.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'AKTUELLE SIGNATUREN';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'Es steht zur Zeit kein Signaturenupdate zur Verfügung.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'IHRE SIGNATUREN';
$phpMussel['Config']['lang']['update_success'] = 'Erfolgreich.';
$phpMussel['Config']['lang']['update_successfully'] = ' erfolgreich';
$phpMussel['Config']['lang']['update_version_latest'] = 'AKTUELLE SCRIPT VERSION';
$phpMussel['Config']['lang']['update_version_yours'] = 'IHRE SCRIPT VERSION';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'Signaturen';
$phpMussel['Config']['lang']['upload_error_1'] = 'Dateigröße überschreitet die Richtlinie upload_max_filesize. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Dateigröße überschreitet die im Formular angegebene Dateigröße. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Upload gescheitert! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Fehlendes Uploadverzeichnis! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Festplatten-Schreibfehler! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP-Fehlkonfiguration erkannt! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Uploadlimit überschritten';
$phpMussel['Config']['lang']['wrong_password'] = 'Falsches Passwort; Ausführung des Befehls verweigert.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'nicht vorhanden';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
