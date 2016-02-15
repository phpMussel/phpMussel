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
 * This file: Dutch language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'Ik begrijp niet dat bevel, sorry.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Verlaten CLI.\n - Aliassen: quit, exit.\n md5_file\n - Genereer MD5 handtekeningen van bestanden [Syntaxis: md5_file bestandsnaam].\n - Alias: m.\n md5\n - Genereer MD5 handtekening van string [Syntaxis: md5 string].\n hex_encode\n - Converteren van binaire string naar hexadecimaal [Syntaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Converteren van hexadecimaal naar binaire string [Syntaxis: hex_decode string].\n base64_encode\n - Converteren van binaire string naar base64 string [Syntaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Converteren van base64 string naar binaire string [Syntaxis: base64_decode string].\n scan\n - Scannen bestand of map [Syntaxis: scan bestandsnaam].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n c\n - Print dit commando lijst.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'Mislukt om het voltooien te scannen';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' is geen bestand of map.';
$phpMussel['Config']['lang']['cli_ln2'] = " Dank u voor het gebruiken van phpMussel, een PHP-script ontwikkeld om trojans,\n virussen, malware en andere bedreigingen te ontworpen, binnen bestanden\n geüpload naar uw systeem waar het script is haakte, gebaseerd op de\n handtekeningen van ClamAV en anderen.\n PHPMUSSEL COPYRIGHT 2013 en verder GNU/GPL V.2 van Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " Momenteel phpMussel is in CLI-modus (commandlijn interface).\n\n Om scannen een bestand of map, typ 'scan', gevolgd door de naam van het\n bestand of de map die u wilt phpMussel te scannen en druk op Enter; Typ 'c' en\n druk op Enter voor een lijst op CLI-modus commando's; Typ 'q' en druk op Enter\n om te stoppen:";
$phpMussel['Config']['lang']['cli_pe1'] = 'Geen geldig PE-bestand!';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE Secties:';
$phpMussel['Config']['lang']['cli_update_restart'] = ' Herstarten phpMussel kan nodig zijn voordat updates zichtbaar worden.';
$phpMussel['Config']['lang']['cli_working'] = 'Aan de gang';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel controles-slot ingeschakeld.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Kern script ontbreekt! Opnieuw installeer phpMussel.';
$phpMussel['Config']['lang']['corrupted'] = 'Gedetecteerd beschadigd PE';
$phpMussel['Config']['lang']['denied'] = 'Upload Geweigerd!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'De upload poging werd geblokkeerd voor de hieronder vermelde redenen / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Gedetecteerd {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Gedetecteerd controle karakters';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Gedetecteerd gecodeerde archief; Gecodeerde archieven niet toegestaan';
$phpMussel['Config']['lang']['failed_to_access'] = 'Mislukt om toegang ';
$phpMussel['Config']['lang']['file'] = 'Bestand';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Bestandsgrootte limiet overschreden';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Bestandstype in zwarte lijst';
$phpMussel['Config']['lang']['finished'] = 'Afgewerkt';
$phpMussel['Config']['lang']['generated_by'] = 'Gegenereerde door';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Greylist geleegd.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Greylist niet bijgewerkt.';
$phpMussel['Config']['lang']['greylist_updated'] = ' Greylist bijgewerkt.';
$phpMussel['Config']['lang']['image'] = 'Image';
$phpMussel['Config']['lang']['instance_already_active'] = 'Instantie al actief! Controleer uw haken.';
$phpMussel['Config']['lang']['invalid_file'] = 'Ongeldige bestand';
$phpMussel['Config']['lang']['invalid_url'] = 'Ongeldige URL!';
$phpMussel['Config']['lang']['ok'] = 'OK';
$phpMussel['Config']['lang']['only_allow_images'] = 'Uploaden van niet-beeldbestanden is niet toegestaan';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel uitgeschakeld.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel al uitgeschakeld.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel ingeschakeld.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel al ingeschakeld.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Plugins bestandsmap bestaat niet!';
$phpMussel['Config']['lang']['recursive'] = 'Recursie dieptelimiet overschreden';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Vereiste variabelen zijn niet gedefinieerd: Kan niet doorgaan.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Scannen afgebroken!';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x} kameleon aanval gedetecteerd';
$phpMussel['Config']['lang']['scan_checking'] = 'Verifiëren';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Succes! Gaan tot verifiëren de inhoud.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'Command injectie poging gedetecteerd';
$phpMussel['Config']['lang']['scan_complete'] = 'Voltooid';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Mislukt (ontbrekende vereiste extensies)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Bestandsnaam manipulatie ontdekt';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Handtekening kaart beschadigd';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Handtekening kaart ontbrekende';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Ontbrekende bestandsnaam';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Mislukt (leeg of is geen archief)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'Geen problemen gevonden.';
$phpMussel['Config']['lang']['scan_reading'] = 'Lezen van';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Handtekening bestand beschadigd';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Handtekening bestand ontbreekt';
$phpMussel['Config']['lang']['scan_tampering'] = 'Gedetecteerd potentieel gevaarlijke bestandswijziging';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'Ongeautoriseerde bestand uploaden manipulatie gedetecteerd';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'Ongeautoriseerde bestand uploaden manipulatie of misconfiguratie gedetecteerd! ';
$phpMussel['Config']['lang']['started'] = 'Gestart';
$phpMussel['Config']['lang']['too_many_urls'] = 'Te veel URL\'s';
$phpMussel['Config']['lang']['update_'] = 'phpMussel zal nu proberen om zichzelf te bijwerken.';
$phpMussel['Config']['lang']['update_available'] = 'Een script bijwerk is beschikbaar.';
$phpMussel['Config']['lang']['update_complete'] = 'Bijwerk verificatie afgerond geslaagd.';
$phpMussel['Config']['lang']['update_created'] = 'gecreëerd';
$phpMussel['Config']['lang']['update_deleted'] = 'verwijderd';
$phpMussel['Config']['lang']['update_err1'] = 'Bijwerken mislukte: \'update.dat\' vermist. Opnieuw installeren of bijwerken handmatig.';
$phpMussel['Config']['lang']['update_err2'] = 'Bijwerken mislukte: \'update.dat\' bevat geen geldige bijwerken bronnen. Bijwerken handmatig.';
$phpMussel['Config']['lang']['update_err3'] = 'Mogelijke hack of vervalsing ontdekt in de instructies door de bijwerken bron; Bron mogelijk gecompromitteerd. Gelieve verwittigen het scriptschrijver. Handmatig updaten wordt aanbevolen.';
$phpMussel['Config']['lang']['update_err4'] = 'Vermist checksum!';
$phpMussel['Config']['lang']['update_err5'] = 'Vermist data!';
$phpMussel['Config']['lang']['update_err6'] = 'Slecht data!';
$phpMussel['Config']['lang']['update_err7'] = 'Slecht checksum!';
$phpMussel['Config']['lang']['update_failed'] = 'Mislukt.';
$phpMussel['Config']['lang']['update_fetch'] = 'Proberen te halen versie gegevens van {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Update slot gedetecteerd: Kan niet doorgaan. Controleren op updates corrupte of probeer later opnieuw.';
$phpMussel['Config']['lang']['update_not'] = 'NIET {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'Geen script bijwerk beschikbaar op dit moment.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Een script bijwerk zijn beschikbaar, maar kan niet worden volledig bijgewerkt met deze versie van de bijwerkscript. Alstublieft bijwerken handmatig.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel heeft mislukt te bijwerken, omdat het niet kon verbinden met een geldige bijwerkenbron. Handmatig bijwerk zijn aanbevolen.';
$phpMussel['Config']['lang']['update_patched'] = 'versteld';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Update script bestand vermist! Opnieuw installeer phpMussel.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' seconden verstreken';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Een handtekeningen bijwerken zijn beschikbaar.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'LAATSTE HANDTEKENINGEN';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'Geen handtekeningen bijwerken beschikbaar op dit moment.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'UW HANDTEKENINGEN';
$phpMussel['Config']['lang']['update_success'] = 'Succes.';
$phpMussel['Config']['lang']['update_successfully'] = ' met succes';
$phpMussel['Config']['lang']['update_version_latest'] = 'NIEUWSTE SCRIPT VERSIE';
$phpMussel['Config']['lang']['update_version_yours'] = 'UW SCRIPT VERSIE';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'handtekeningen';
$phpMussel['Config']['lang']['upload_error_1'] = 'Bestandsgrootte overschrijdt de upload_max_filesize richtlijn. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Bestandsgrootte overschrijdt de vorm gespecificeerde bestandsgrootte limiet. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Upload mislukking! Contact op met de hostmaster voor hulp! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Uploadmap ontbreekt! Contact op met de hostmaster voor hulp! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Disc-schrijffout! Contact op met de hostmaster voor hulp! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP misconfiguratie gedetecteerd! Contact op met de hostmaster voor hulp! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Uploadlimiet overschreden';
$phpMussel['Config']['lang']['wrong_password'] = 'Verkeerd wachtwoord; Actie geweigerd.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'niet bestaat';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
