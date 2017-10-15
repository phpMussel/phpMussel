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
 * This file: Dutch language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Ik begrijp niet dat bevel, sorry.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Mislukt om het voltooien te scannen';
$phpMussel['lang']['cli_is_not_a'] = ' is geen bestand of map.';
$phpMussel['lang']['cli_ln2'] = " Dank u voor het gebruiken van phpMussel, een PHP-script ontwikkeld om trojans,\n virussen, malware en andere bedreigingen te ontworpen, binnen bestanden\n geüpload naar uw systeem waar het script is haakte, gebaseerd op de\n signatures van ClamAV en anderen.\n PHPMUSSEL COPYRIGHT 2013 en verder GNU/GPL V.2 van Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Momenteel phpMussel is in CLI-modus (commandlijn interface).\n\n Om scannen een bestand of map, typ 'scan', gevolgd door de naam van het\n bestand of de map die u wilt phpMussel te scannen en druk op Enter; Typ 'c' en\n druk op Enter voor een lijst op CLI-modus commando's; Typ 'q' en druk op Enter\n om te stoppen:";
$phpMussel['lang']['cli_pe1'] = 'Geen geldig PE-bestand!';
$phpMussel['lang']['cli_pe2'] = 'PE Secties:';
$phpMussel['lang']['cli_signature_placeholder'] = 'UW-SIGNATURE-NAAM';
$phpMussel['lang']['cli_working'] = 'Aan de gang';
$phpMussel['lang']['corrupted'] = 'Gedetecteerd beschadigd PE';
$phpMussel['lang']['data_not_available'] = 'Gegevens niet beschikbaar.';
$phpMussel['lang']['denied'] = 'Upload Geweigerd!';
$phpMussel['lang']['denied_reason'] = 'De upload poging werd geblokkeerd voor de hieronder vermelde redenen:';
$phpMussel['lang']['detected'] = 'Gedetecteerd {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Gedetecteerd controle karakters';
$phpMussel['lang']['encrypted_archive'] = 'Gedetecteerd gecodeerde archief; Gecodeerde archieven niet toegestaan';
$phpMussel['lang']['failed_to_access'] = 'Mislukt om toegang ';
$phpMussel['lang']['file'] = 'Bestand';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Bestandsgrootte limiet overschreden';
$phpMussel['lang']['filetype_blacklisted'] = 'Bestandstype in zwarte lijst';
$phpMussel['lang']['finished'] = 'Afgewerkt';
$phpMussel['lang']['generated_by'] = 'Gegenereerde door';
$phpMussel['lang']['greylist_cleared'] = ' Greylist geleegd.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist niet bijgewerkt.';
$phpMussel['lang']['greylist_updated'] = ' Greylist bijgewerkt.';
$phpMussel['lang']['image'] = 'Image';
$phpMussel['lang']['instance_already_active'] = 'Instantie al actief! Controleer uw haken.';
$phpMussel['lang']['invalid_data'] = 'Ongeldige data!';
$phpMussel['lang']['invalid_file'] = 'Ongeldige bestand';
$phpMussel['lang']['invalid_url'] = 'Ongeldige URL!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Uploaden van niet-beeldbestanden is niet toegestaan';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Plugins bestandsmap bestaat niet!';
$phpMussel['lang']['quarantined_as'] = "In quarantaine geplaatst als \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursie dieptelimiet overschreden';
$phpMussel['lang']['required_variables_not_defined'] = 'Vereiste variabelen zijn niet gedefinieerd: Kan niet doorgaan.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'Potentieel schadelijke URL gedetecteerd';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API aanvraag foute';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API niet geautoriseerd';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API dienst niet beschikbaar';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Onbekende API fout';
$phpMussel['lang']['scan_aborted'] = 'Scannen afgebroken!';
$phpMussel['lang']['scan_chameleon'] = '{x} kameleon aanval gedetecteerd';
$phpMussel['lang']['scan_checking'] = 'Verifiëren';
$phpMussel['lang']['scan_checking_contents'] = 'Succes! Gaan tot verifiëren de inhoud.';
$phpMussel['lang']['scan_command_injection'] = 'Command injectie poging gedetecteerd';
$phpMussel['lang']['scan_complete'] = 'Voltooid';
$phpMussel['lang']['scan_extensions_missing'] = 'Mislukt (ontbrekende vereiste extensies)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Bestandsnaam manipulatie ontdekt';
$phpMussel['lang']['scan_missing_filename'] = 'Ontbrekende bestandsnaam';
$phpMussel['lang']['scan_not_archive'] = 'Mislukt (leeg of is geen archief)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Geen problemen gevonden.';
$phpMussel['lang']['scan_reading'] = 'Lezen van';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Signature bestand beschadigd';
$phpMussel['lang']['scan_signature_file_missing'] = 'Signature bestand ontbreekt';
$phpMussel['lang']['scan_tampering'] = 'Gedetecteerd potentieel gevaarlijke bestandswijziging';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Ongeautoriseerde bestand uploaden manipulatie gedetecteerd';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Ongeautoriseerde bestand uploaden manipulatie of misconfiguratie gedetecteerd! ';
$phpMussel['lang']['started'] = 'Gestart';
$phpMussel['lang']['too_many_urls'] = 'Te veel URL\'s';
$phpMussel['lang']['upload_error_1'] = 'Bestandsgrootte overschrijdt de upload_max_filesize richtlijn. ';
$phpMussel['lang']['upload_error_2'] = 'Bestandsgrootte overschrijdt de vorm gespecificeerde bestandsgrootte limiet. ';
$phpMussel['lang']['upload_error_34'] = 'Upload mislukking! Contact op met de hostmaster voor hulp! ';
$phpMussel['lang']['upload_error_6'] = 'Uploadmap ontbreekt! Contact op met de hostmaster voor hulp! ';
$phpMussel['lang']['upload_error_7'] = 'Disc-schrijffout! Contact op met de hostmaster voor hulp! ';
$phpMussel['lang']['upload_error_8'] = 'PHP misconfiguratie gedetecteerd! Contact op met de hostmaster voor hulp! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Uploadlimiet overschreden';
$phpMussel['lang']['wrong_password'] = 'Verkeerd wachtwoord; Actie geweigerd.';
$phpMussel['lang']['x_does_not_exist'] = 'niet bestaat';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Verlaten CLI.
 - Aliassen: quit, exit.
 md5_file
 - Genereer MD5 signatures van bestanden [Syntaxis: md5_file bestandsnaam].
 - Alias: m.
 sha1_file
 - Genereer SHA1 signatures van bestanden [Syntaxis: sha1_file bestandsnaam].
 md5
 - Genereer MD5 signature van string [Syntaxis: md5 string].
 sha1
 - Genereer SHA1 signature van string [Syntaxis: sha1 string].
 hex_encode
 - Converteren van binaire string naar hexadecimaal
   [Syntaxis: hex_encode string].
 - Alias: x.
 hex_decode
 - Converteren van hexadecimaal naar binaire string
   [Syntaxis: hex_decode string].
 base64_encode
 - Converteren van binaire string naar base64 string
   [Syntaxis: base64_encode string].
 - Alias: b.
 base64_decode
 - Converteren van base64 string naar binaire string
   [Syntaxis: base64_decode string].
 pe_meta
 - Haal metagegevens uit een PE-bestand [Syntaxis: pe_meta bestandsnaam].
 url_sig
 - Genereren URL-scanner signatures [Syntaxis: url_sig string].
 scan
 - Scannen bestand of map [Syntaxis: scan bestandsnaam].
 - Alias: s.
 c
 - Print dit commando lijst.
";
