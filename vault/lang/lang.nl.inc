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
 This File: phpMussel Dutch/Nederlandse Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.nl.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Ik begrijp niet dat bevel, sorry.';
$MusselConfig['lang']['cli_commands']=" q\n - Verlaten CLI.\n - Aliassen: quit, exit.\n md5_file\n - Genereer MD5 handtekeningen van bestanden [Syntaxis: md5_file bestandsnaam].\n - Alias: m.\n md5\n - Genereer MD5 handtekening van string [Syntaxis: md5 string].\n hex_encode\n - Converteren van binaire string naar hexadecimaal [Syntaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Converteren van hexadecimaal naar binaire string [Syntaxis: hex_decode string].\n base64_encode\n - Converteren van binaire string naar base64 string [Syntaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Converteren van base64 string naar binaire string [Syntaxis: base64_decode string].\n scan\n - Scannen bestand of map [Syntaxis: scan bestandsnaam].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n c\n - Print dit commando lijst.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Mislukt om het voltooien te scannen';
$MusselConfig['lang']['cli_is_not_a']=' is geen bestand of map.';
$MusselConfig['lang']['cli_ln2']=" Dank u voor het gebruiken van phpMussel, een PHP-script ontwikkeld om trojans,\n virussen, malware en andere bedreigingen te ontworpen, binnen bestanden\n geüpload naar uw systeem waar het script is haakte, gebaseerd op de\n handtekeningen van ClamAV en anderen.\n PHPMUSSEL COPYRIGHT 2013 en verder GNU/GPL V.2 van Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Momenteel phpMussel is in CLI-modus (Commandlijn interface).\n\n Om scannen een bestand of map, typ 'scan', gevolgd door de naam van het\n bestand of de map die u wilt phpMussel te scannen en druk op Enter; Typ 'c' en\n druk op Enter voor een lijst op CLI-modus commando's; Typ 'q' en druk op Enter\n om te stoppen:";
$MusselConfig['lang']['cli_pe1']='Geen geldig PE-bestand!';
$MusselConfig['lang']['cli_pe2']='PE Secties:';
$MusselConfig['lang']['cli_update_restart']=' Herstarten phpMussel kan nodig zijn voordat updates zichtbaar worden.';
$MusselConfig['lang']['cli_working']='Aan de gang';
$MusselConfig['lang']['controls_lockout']='phpMussel controles-slot ingeschakeld.';
$MusselConfig['lang']['core_scriptfile_missing']='Kern script ontbreekt! Opnieuw installeer phpMussel.';
$MusselConfig['lang']['corrupted']='Gedetecteerd beschadigd PE';
$MusselConfig['lang']['denied']='Upload Geweigerd!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='De upload poging werd geblokkeerd voor de hieronder vermelde redenen / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Gedetecteerd {vn}';
$MusselConfig['lang']['detected_control_characters']='Gedetecteerd controle karakters';
$MusselConfig['lang']['encrypted_archive']='Gedetecteerd gecodeerde archief; Gecodeerde archieven niet toegestaan';
$MusselConfig['lang']['failed_to_access']='Mislukt om toegang ';
$MusselConfig['lang']['file']='Bestand';
$MusselConfig['lang']['filesize_limit_exceeded']='Bestandsgrootte limiet overschreden';
$MusselConfig['lang']['filetype_blacklisted']='Bestandstype in zwarte lijst';
$MusselConfig['lang']['finished']='Afgewerkt';
$MusselConfig['lang']['generated_by']='Gegenereerde door';
$MusselConfig['lang']['greylist_cleared']=' Greylist geleegd.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist niet bijgewerkt.';
$MusselConfig['lang']['greylist_updated']=' Greylist bijgewerkt.';
$MusselConfig['lang']['image']='Image';
$MusselConfig['lang']['instance_already_active']='Instantie al actief! Controleer uw haken.';
$MusselConfig['lang']['invalid_file']='Ongeldig bestand';
$MusselConfig['lang']['ok']='OK';
$MusselConfig['lang']['only_allow_images']='Uploaden van niet-beeldbestanden is niet toegestaan';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel uitgeschakeld.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel al uitgeschakeld.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel ingeschakeld.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel al ingeschakeld.';
$MusselConfig['lang']['recursive']='Recursie dieptelimiet overschreden';
$MusselConfig['lang']['refer_to_scan_kills']=' (verwijzen naar '.$MusselConfig['general']['scan_kills'].' voor meer informatie)';
$MusselConfig['lang']['required_variables_not_defined']='Vereiste variabelen zijn niet gedefinieerd: Kan niet doorgaan.';
$MusselConfig['lang']['scan_aborted']='Scannen afgebroken';
$MusselConfig['lang']['scan_chameleon']='{x} kameleon aanval gedetecteerd';
$MusselConfig['lang']['scan_checking']='Verifiëren';
$MusselConfig['lang']['scan_checking_contents']='Succes! Gaan tot verifiëren de inhoud.';
$MusselConfig['lang']['scan_command_injection']='Command injectie poging gedetecteerd';
$MusselConfig['lang']['scan_complete']='Voltooid';
$MusselConfig['lang']['scan_extensions_missing']='Mislukt (ontbrekende vereiste extensies)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Bestandsnaam manipulatie ontdekt';
$MusselConfig['lang']['scan_map_corrupted']='Handtekening kaart beschadigd';
$MusselConfig['lang']['scan_map_missing']='Handtekening kaart ontbrekende';
$MusselConfig['lang']['scan_missing_filename']='Ontbrekende bestandsnaam';
$MusselConfig['lang']['scan_not_archive']='Mislukt (leeg of is geen archief)!';
$MusselConfig['lang']['scan_no_problems_found']='Geen problemen gevonden.';
$MusselConfig['lang']['scan_reading']='Lezen van';
$MusselConfig['lang']['scan_signature_file_corrupted']='Handtekening bestand beschadigd';
$MusselConfig['lang']['scan_signature_file_missing']='Handtekening bestand ontbreekt';
$MusselConfig['lang']['scan_tampering']='Gedetecteerd potentieel gevaarlijke bestandswijziging';
$MusselConfig['lang']['scan_unauthorised_upload']='ngeautoriseerde bestand uploaden manipulatie gedetecteerd';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Ongeautoriseerde bestand uploaden manipulatie of misconfiguratie gedetecteerd! ';
$MusselConfig['lang']['started']='Gestart';
$MusselConfig['lang']['update_']='phpMussel zal nu proberen om zichzelf te bijwerken.';
$MusselConfig['lang']['update_available']='Een script bijwerk is beschikbaar.';
$MusselConfig['lang']['update_complete']='Bijwerk verificatie afgerond geslaagd.';
$MusselConfig['lang']['update_created']='gecreëerd';
$MusselConfig['lang']['update_deleted']='verwijderd';
$MusselConfig['lang']['update_err1']='Bijwerken mislukte: \'update.dat\' vermist. Opnieuw installeren of bijwerken handmatig.';
$MusselConfig['lang']['update_err2']='Bijwerken mislukte: \'update.dat\' bevat geen geldige bijwerken bronnen. Bijwerken handmatig.';
$MusselConfig['lang']['update_err3']='Mogelijke hack of vervalsing ontdekt in de instructies door de bijwerken bron; Bron mogelijk gecompromitteerd. Gelieve verwittigen het scriptschrijver. Handmatig updaten wordt aanbevolen.';
$MusselConfig['lang']['update_err4']='Vermist checksum!';
$MusselConfig['lang']['update_err5']='Vermist data!';
$MusselConfig['lang']['update_err6']='Slecht data!';
$MusselConfig['lang']['update_err7']='Slecht checksum!';
$MusselConfig['lang']['update_failed']='Mislukt.';
$MusselConfig['lang']['update_fetch']='Proberen te halen versie gegevens van';
$MusselConfig['lang']['update_lock_detected']='Update slot gedetecteerd: Kan niet doorgaan. Controleren op updates corrupte of probeer later opnieuw.';
$MusselConfig['lang']['update_not']='NIET {x}';
$MusselConfig['lang']['update_not_available']='Geen script bijwerk beschikbaar op dit moment.';
$MusselConfig['lang']['update_not_possible']='Een script bijwerk zijn beschikbaar, maar kan niet worden volledig bijgewerkt met deze versie van de bijwerkscript. Alstublieft bijwerken handmatig.';
$MusselConfig['lang']['update_no_source']='phpMussel heeft mislukt te bijwerken, omdat het niet kon verbinden met een geldige bijwerkenbron. Handmatig bijwerk zijn aanbevolen.';
$MusselConfig['lang']['update_patched']='versteld';
$MusselConfig['lang']['update_scriptfile_missing']=' Update script bestand vermist! Opnieuw installeer phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' seconden verstreken';
$MusselConfig['lang']['update_signatures_available']='Een handtekeningen bijwerken zijn beschikbaar.';
$MusselConfig['lang']['update_signatures_latest']='LAATSTE HANDTEKENINGEN';
$MusselConfig['lang']['update_signatures_not_available']='Geen handtekeningen bijwerken beschikbaar op dit moment.';
$MusselConfig['lang']['update_signatures_yours']='UW HANDTEKENINGEN';
$MusselConfig['lang']['update_success']='Succes.';
$MusselConfig['lang']['update_successfully']=' met succes';
$MusselConfig['lang']['update_version_latest']='NIEUWSTE SCRIPT VERSIE';
$MusselConfig['lang']['update_version_yours']='UW SCRIPT VERSIE';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='handtekeningen';
$MusselConfig['lang']['upload_error_1']='Bestandsgrootte overschrijdt MAX_FILE_SIZE richtlijn. ';
$MusselConfig['lang']['upload_error_2']='Bestandsgrootte overschrijdt vorm gespecificeerde bestandsgrootte limiet. ';
$MusselConfig['lang']['upload_error_34']='Upload mislukking! Contact op met de hostmaster voor hulp! ';
$MusselConfig['lang']['upload_error_6']='Uploadmap ontbreekt! Contact op met de hostmaster voor hulp! ';
$MusselConfig['lang']['upload_error_7']='Disc-schrijffout! Contact op met de hostmaster voor hulp! ';
$MusselConfig['lang']['upload_error_8']='PHP misconfiguratie gedetecteerd! Contact op met de hostmaster voor hulp! ';
$MusselConfig['lang']['upload_limit_exceeded']='Uploadlimiet overschreden';
$MusselConfig['lang']['wrong_password']='Verkeerd wachtwoord; Actie geweigerd.';
$MusselConfig['lang']['x_does_not_exist']='niet bestaat';

?>