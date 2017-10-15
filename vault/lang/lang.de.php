<?php
/**
 * This file is a part of the phpMussel package.
 * Homepage: https://phpmussel.github.io/
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: German language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Entschuldigung, ich verstehe diesen Befehl nicht.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Ein vollständiger Scan konnte nicht durchgeführt werden';
$phpMussel['lang']['cli_is_not_a'] = ' ist keine Datei oder ein Verzeichnis.';
$phpMussel['lang']['cli_ln2'] = " Vielen Dank für die Benutzung von phpMussel, einem auf PHP basiertem Script,\n um Trojaner, Viren, Malware und andere Bedrohungen in Dateien zu entdecken,\n die auf Ihr System hochgeladen werden könnten, welches die Signaturen von\n ClamAV und andere nutzt.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " phpMussel befindet sich im CLI-Modus (Command Line Interface).\n\n Um eine Datei oder ein Verzeichnis mit phpMussel zu überprüfen, geben Sie\n 'scan', gefolgt vom Namen der Datei oder des Verzeichnisses ein und\n bestätigen mit Enter;\n\n Geben Sie 'c' und Enter für eine Liste der verfügbaren Befehle im CLI-Modus\n ein; Geben Sie 'q' und Enter zum Beenden ein: ";
$phpMussel['lang']['cli_pe1'] = 'Keine gültige PE-Datei!';
$phpMussel['lang']['cli_pe2'] = 'PE-Sektionen:';
$phpMussel['lang']['cli_signature_placeholder'] = 'IHR-SIGNATURNAME';
$phpMussel['lang']['cli_working'] = 'Im Gange';
$phpMussel['lang']['corrupted'] = 'Beschädigte PE entdeckt';
$phpMussel['lang']['data_not_available'] = 'Keine Daten verfügbar.';
$phpMussel['lang']['denied'] = 'Upload verweigert!';
$phpMussel['lang']['denied_reason'] = 'Der Upload wurde aus den unten aufgeführten Gründen blockiert:';
$phpMussel['lang']['detected'] = 'Entdeckt {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Steuerzeichen erkannt';
$phpMussel['lang']['encrypted_archive'] = 'Verschlüsseltes Archiv entdeckt; Verschlüsselte Archive sind nicht erlaubt';
$phpMussel['lang']['failed_to_access'] = 'Zugriff fehlgeschlagen auf ';
$phpMussel['lang']['file'] = 'Datei';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Dateigröße überschritten';
$phpMussel['lang']['filetype_blacklisted'] = 'Dateityp auf Blacklist';
$phpMussel['lang']['finished'] = 'Fertig';
$phpMussel['lang']['generated_by'] = 'Generiert von';
$phpMussel['lang']['greylist_cleared'] = ' Greylist gelöscht.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist nicht aktualisiert.';
$phpMussel['lang']['greylist_updated'] = ' Greylist aktualisiert.';
$phpMussel['lang']['image'] = 'Bild';
$phpMussel['lang']['instance_already_active'] = 'Instanz bereits aktiv! Bitte prüfe deine Hooks.';
$phpMussel['lang']['invalid_data'] = 'Ungültige Daten!';
$phpMussel['lang']['invalid_file'] = 'Ungültige Datei';
$phpMussel['lang']['invalid_url'] = 'Ungültige URL!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Upload von Nicht-Bilddateien ist nicht erlaubt';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Plugin-Verzeichnis nicht vorhanden!';
$phpMussel['lang']['quarantined_as'] = "Als \"/vault/quarantine/{QFU}.qfu\" unter Quarantäne gestellt.\n";
$phpMussel['lang']['recursive'] = 'Rekursionstiefe-Limit überschritten';
$phpMussel['lang']['required_variables_not_defined'] = 'Benötigte Variablen sind nicht definiert: Kann nicht fortfahren.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'Potentiell schädliche URL entdeckt';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API-Anforderungsfehler';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API-Berechtigungsfehler';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API-Dienst nicht verfügbar';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Unbekannt API-Fehler';
$phpMussel['lang']['scan_aborted'] = 'Scan abgebrochen!';
$phpMussel['lang']['scan_chameleon'] = '{x}-Chamäleon-Angriff erkannt';
$phpMussel['lang']['scan_checking'] = 'Überprüfung';
$phpMussel['lang']['scan_checking_contents'] = 'Erfolg! Überprüfe Inhalte.';
$phpMussel['lang']['scan_command_injection'] = 'CMD-Injektion erkannt';
$phpMussel['lang']['scan_complete'] = 'Komplett';
$phpMussel['lang']['scan_extensions_missing'] = 'Gescheitert (fehlende benötigte Erweiterungen)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Manipulation des Dateinamens erkannt';
$phpMussel['lang']['scan_missing_filename'] = 'Fehlender Dateiname';
$phpMussel['lang']['scan_not_archive'] = 'Gescheitert (leer oder kein Archiv)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Keine Probleme gefunden.';
$phpMussel['lang']['scan_reading'] = 'Lesen';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Signaturdatei beschädigt';
$phpMussel['lang']['scan_signature_file_missing'] = 'Signaturdatei fehlt';
$phpMussel['lang']['scan_tampering'] = 'Potentiell gefährliche Datei-Manipulation erkannt';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Unerlaubte Upload-Manipulation erkannt';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Unerlaubte Upload-Manipulation oder Fehlkonfiguration erkannt! ';
$phpMussel['lang']['started'] = 'Gestartet';
$phpMussel['lang']['too_many_urls'] = 'Zu viele URLs';
$phpMussel['lang']['upload_error_1'] = 'Dateigröße überschreitet die Richtlinie upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'Dateigröße überschreitet die im Formular angegebene Dateigröße. ';
$phpMussel['lang']['upload_error_34'] = 'Upload gescheitert! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['lang']['upload_error_6'] = 'Fehlendes Uploadverzeichnis! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['lang']['upload_error_7'] = 'Festplatten-Schreibfehler! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['lang']['upload_error_8'] = 'PHP-Fehlkonfiguration erkannt! Bitte kontaktieren Sie den Hostmaster für Unterstützung! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Uploadlimit überschritten';
$phpMussel['lang']['wrong_password'] = 'Falsches Passwort; Ausführung des Befehls verweigert.';
$phpMussel['lang']['x_does_not_exist'] = 'nicht vorhanden';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Beendet den CLI-Modus.
 - Alias: quit, exit.
 md5_file
 - Generiert MD5-Signaturen einer Datei [Syntax: md5_file Dateiname].
 - Alias: m.
 sha1_file
 - Generiert SHA1-Signaturen einer Datei [Syntax: sha1_file Dateiname].
 md5
 - Generiert MD5-Signaturen eines String-Wertes [Syntax: md5 String].
 sha1
 - Generiert SHA1-Signaturen eines String-Wertes [Syntax: sha1 String].
 hex_encode
 - Konvertiert einen Binär-Wert in einen Hexidezimal-Wert
   [Syntax: hex_encode String].
 - Alias: x.
 hex_decode
 - Konvertiert einen Hexidezimal-Wert in einen Binär-Wert
   [Syntax: hex_decode String].
 base64_encode
 - Konvertiert einen Binär-Wert in einen Base64-Wert
   [Syntax: base64_encode String].
 - Alias: b.
 base64_decode
 - Konvertiert einen Base64-Wert in einen Binär-Wert
   [Syntax: base64_decode String].
 pe_meta
 - Extrahieren Sie Metadaten aus einer PE-Datei [Syntax: pe_meta Dateiname].
 url_sig
 - Generiere URL-Scanner-Signaturen [Syntax: url_sig String].
 scan
 - Überprüft eine Datei oder ein Verzeichnis [Syntax: scan Dateiname].
 - Alias: s.
 c
 - Gibt diese Befehlsliste aus.
";
