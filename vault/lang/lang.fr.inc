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
 This File: phpMussel French/Français Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.fr.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Je ne comprends pas cette commande, désolé.';
$MusselConfig['lang']['cli_commands']=" q\n - Quitter CLI.\n - Alias: quit, exit.\n md5_file\n - Générer MD5 signatures des fichiers [Syntaxe: md5_file nom_de_fichier].\n - Alias: m.\n md5\n - Générer MD5 signature de string [Syntaxe: md5 string].\n hex_encode\n - Convertir binaire string à hexadécimal [Syntaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadécimal à binaire string [Syntaxe: hex_decode string].\n base64_encode\n - Convertir binaire string à base64 string [Syntaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string à binaire string [Syntaxe: base64_decode string].\n scan\n - Analyser fichier ou répertoire [Syntaxe: scan nom_de_fichier].\n - Alias: s.\n update\n - Réactualiser phpMussel.\n - Alias: u.\n c\n - Imprimer cette liste des commandes.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Échec du terminer le processus d\'analyse';
$MusselConfig['lang']['cli_is_not_a']='  n\'est pas un fichier ou un répertoire.';
$MusselConfig['lang']['cli_ln2']=" Merci pour l'utiliser de phpMusel, un PHP script pour la détection de virus,\n malveillants logiciels et autres menaces dans les fichiers téléchargés sur\n votre système partout où le script est accroché, basé sur les signatures de\n ClamAV et autres.\n\n PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 par Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Fonctionne comme CLI mode pour le moment (Commande Ligne Interface).\n\n Pour analyser un fichier ou répertoire, taper 'scan', suivi par le nom du\n fichier ou répertoire que vous voulez phpMussel pour analyser et appuyez sur\n Entrée; Tapez 'c' et appuyez sur Entrée pour une liste de CLI mode commandes;\n Taper 'q' et appuyez sur Entrée pour quitter:";
$MusselConfig['lang']['cli_pe1']='Pas un valide PE fichier!';
$MusselConfig['lang']['cli_pe2']='PE Sections:';
$MusselConfig['lang']['cli_update_restart']=' Redémarrage phpMussel peut être nécessaire avant les réactualisations deviennent apparents.';
$MusselConfig['lang']['cli_working']='En cours';
$MusselConfig['lang']['controls_lockout']='phpMussel verrouillage des commandes est activées.';
$MusselConfig['lang']['core_scriptfile_missing']='Base script fichier manquant! S\'il vous plaît réinstaller phpMussel.';
$MusselConfig['lang']['corrupted']='Détecté corrompu PE';
$MusselConfig['lang']['denied']='Téléchargement Refusé!';
$MusselConfig['lang']['denied_other']='Upload Denied! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Votre tentative à télécharger a été bloqué pour les raisons énumérées ci-dessous / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Détecté {vn}';
$MusselConfig['lang']['detected_control_characters']='Contrôle Caractères Détectés';
$MusselConfig['lang']['encrypted_archive']='Detected archive cryptée; Archives cryptées pas autorisés';
$MusselConfig['lang']['failed_to_access']='Échec d\'accès ';
$MusselConfig['lang']['file']='Fichier';
$MusselConfig['lang']['filesize_limit_exceeded']='Fichier taille limite dépassé';
$MusselConfig['lang']['filetype_blacklisted']='Type de fichier sur la noire liste';
$MusselConfig['lang']['finished']='Terminé';
$MusselConfig['lang']['generated_by']='Généré par';
$MusselConfig['lang']['greylist_cleared']=' Greylist vidé.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist n\'a pas été réactualisé';
$MusselConfig['lang']['greylist_updated']=' Greylist réactualisé.';
$MusselConfig['lang']['image']='Image';
$MusselConfig['lang']['instance_already_active']='Instance déjà actif! S\'il vous plaît vérifiez vos crochets.';
$MusselConfig['lang']['invalid_file']='Fichier non valide';
$MusselConfig['lang']['ok']='Bien';
$MusselConfig['lang']['only_allow_images']='Télécharger des fichiers qui ne sont pas images n\'est pas autorisée';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel désactivé.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel déjà désactivé.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel activé.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel déjà activé.';
$MusselConfig['lang']['recursive']='Recursion limite de profondeur dépassé';
$MusselConfig['lang']['refer_to_scan_kills']=' (reportez-vous à '.$MusselConfig['general']['scan_kills'].' pour détails)';
$MusselConfig['lang']['required_variables_not_defined']='Variables requises ne sont pas définies: Ne pouvez pas continuer.';
$MusselConfig['lang']['scan_aborted']='Analyse avorté';
$MusselConfig['lang']['scan_chameleon']='{x} caméléon attaque détecté';
$MusselConfig['lang']['scan_checking']='Vérification';
$MusselConfig['lang']['scan_checking_contents']='Succès! Procédant à vérifier le contenu.';
$MusselConfig['lang']['scan_command_injection']='Commande injection tentative détecté';
$MusselConfig['lang']['scan_complete']='Complète';
$MusselConfig['lang']['scan_extensions_missing']='Manqué (manquant extensions requises)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Fichier nom manipulation détecté';
$MusselConfig['lang']['scan_map_corrupted']='Signature carte corrompu';
$MusselConfig['lang']['scan_map_missing']='Signature carte manquante';
$MusselConfig['lang']['scan_missing_filename']='Nom de fichier manquant';
$MusselConfig['lang']['scan_not_archive']='Manqué (vide ou pas une archive)!';
$MusselConfig['lang']['scan_no_problems_found']='Pas problème trouvé.';
$MusselConfig['lang']['scan_reading']='Accéder';
$MusselConfig['lang']['scan_signature_file_corrupted']='Signature fichier corrompu';
$MusselConfig['lang']['scan_signature_file_missing']='Signature fichier manquant';
$MusselConfig['lang']['scan_tampering']='Détecté potentiellement dangereux altération de fichier';
$MusselConfig['lang']['scan_unauthorised_upload']='Non autorisée manipulation de téléchargement de fichiers détecté';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Non autorisée manipulation de téléchargement de fichiers ou mauvaise configuration détecté! ';
$MusselConfig['lang']['started']='Commencé';
$MusselConfig['lang']['update_']='phpMussel va maintenant tenter à réactualiser.';
$MusselConfig['lang']['update_available']='Une réactualisation du script est disponible.';
$MusselConfig['lang']['update_complete']='Réactualisation chèque réussi.';
$MusselConfig['lang']['update_created']='créé';
$MusselConfig['lang']['update_deleted']='supprimé';
$MusselConfig['lang']['update_err1']='Update échec: \'update.dat\' manquant. Réinstaller ou réactualiser manuellement.';
$MusselConfig['lang']['update_err2']='Update échec: \'update.dat\' ne contient pas de sources valide de réactualisations. Réactualiser manuellement s\'il vous plaît.';
$MusselConfig['lang']['update_err3']='Possible hack ou falsification de données détecté dans les réactualisation instructions fournie par la source de la réactualisation; Source peut être compromise. S\'il vous plaît, aviser l\'auteur de la script. Réactualisation manuellement est recommandé.';
$MusselConfig['lang']['update_err4']='Checksum manquant!';
$MusselConfig['lang']['update_err5']='Données manquant!';
$MusselConfig['lang']['update_err6']='Mauvais données!';
$MusselConfig['lang']['update_err7']='Mauvais checksum!';
$MusselConfig['lang']['update_failed']='Manqué.';
$MusselConfig['lang']['update_fetch']='Tenter d\'apporter les données de la version de';
$MusselConfig['lang']['update_lock_detected']='Verrouillage des réactualisations a été détecté: Ne pouvez pas continuer. Examiner pour réactualisations corrompues ou réessayez plus tard.';
$MusselConfig['lang']['update_not']='PAS {x}';
$MusselConfig['lang']['update_not_available']='Aucune réactualisation du script est disponible à ce moment.';
$MusselConfig['lang']['update_not_possible']='Une réactualisation du script est disponible, mais ne peut pas être entièrement réactualisé avec cette version du réactualisation script. S\'il vous plaît réactualiser manuellement.';
$MusselConfig['lang']['update_no_source']='phpMussel n\'a pas réussi à réactualiser parce qu\'il ne pouvait pas connecter à une valide réactualisation source. Réactualisation manuelle est recommandé.';
$MusselConfig['lang']['update_patched']='patché';
$MusselConfig['lang']['update_scriptfile_missing']=' Réactualisation script fichier manquant! S\'il vous plaît, réinstaller phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' secondes écoulées';
$MusselConfig['lang']['update_signatures_available']='Une signatures réactualisation est disponible.';
$MusselConfig['lang']['update_signatures_latest']='DERNIÈRES SIGNATURES';
$MusselConfig['lang']['update_signatures_not_available']='Aucune réactualisation du signatures est disponible à ce moment.';
$MusselConfig['lang']['update_signatures_yours']='VOS SIGNATURES';
$MusselConfig['lang']['update_success']='Succès.';
$MusselConfig['lang']['update_successfully']=' avec succès';
$MusselConfig['lang']['update_version_latest']='DERNIÈRE SCRIPT VERSION';
$MusselConfig['lang']['update_version_yours']='VOS SCRIPT VERSION';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='signatures';
$MusselConfig['lang']['upload_error_1']='Fichier taille dépasse MAX_FILE_SIZE directive. ';
$MusselConfig['lang']['upload_error_2']='Fichier taille dépasse forme spécifiée fichier taille limite. ';
$MusselConfig['lang']['upload_error_34']='Téléchargement échec! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$MusselConfig['lang']['upload_error_6']='Téléchargement répertoire manquant! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$MusselConfig['lang']['upload_error_7']='Disque-écriture erreur! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$MusselConfig['lang']['upload_error_8']='PHP mauvaise configuration détecté! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$MusselConfig['lang']['upload_limit_exceeded']='Téléchargement limite dépassé';
$MusselConfig['lang']['wrong_password']='Mauvais mot de passe; Action rejetée.';
$MusselConfig['lang']['x_does_not_exist']='n\'existe pas';

?>