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
 * This file: French language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'Je ne comprends pas cette commande, désolé.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Quitter CLI.\n - Alias: quit, exit.\n md5_file\n - Générer MD5 signatures des fichiers [Syntaxe: md5_file nom_de_fichier].\n - Alias: m.\n md5\n - Générer MD5 signature de string [Syntaxe: md5 string].\n hex_encode\n - Convertir binaire string à hexadécimal [Syntaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadécimal à binaire string [Syntaxe: hex_decode string].\n base64_encode\n - Convertir binaire string à base64 string [Syntaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string à binaire string [Syntaxe: base64_decode string].\n scan\n - Analyser fichier ou répertoire [Syntaxe: scan nom_de_fichier].\n - Alias: s.\n update\n - Réactualiser phpMussel.\n - Alias: u.\n c\n - Imprimer cette liste des commandes.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'Échec du terminer le processus d\'analyse';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' n\'est pas un fichier ou un répertoire.';
$phpMussel['Config']['lang']['cli_ln2'] = " Merci pour l'utiliser de phpMusel, un PHP script pour la détection de virus,\n malveillants logiciels et autres menaces dans les fichiers téléchargés sur\n votre système partout où le script est accroché, basé sur les signatures de\n ClamAV et autres.\n\n PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 par Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " Fonctionne comme CLI mode pour le moment (commande ligne interface).\n\n Pour analyser un fichier ou répertoire, taper 'scan', suivi par le nom du\n fichier ou répertoire que vous voulez phpMussel pour analyser et appuyez sur\n Entrée; Tapez 'c' et appuyez sur Entrée pour une liste de CLI mode commandes;\n Taper 'q' et appuyez sur Entrée pour quitter:";
$phpMussel['Config']['lang']['cli_pe1'] = 'Pas un valide PE fichier!';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE Sections:';
$phpMussel['Config']['lang']['cli_update_restart'] = ' Redémarrage phpMussel peut être nécessaire avant les réactualisations deviennent apparents.';
$phpMussel['Config']['lang']['cli_working'] = 'En cours';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel verrouillage des commandes est activées.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Base script fichier manquant! S\'il vous plaît réinstaller phpMussel.';
$phpMussel['Config']['lang']['corrupted'] = 'Détecté corrompu PE';
$phpMussel['Config']['lang']['denied'] = 'Téléchargement Refusé!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'Votre tentative à télécharger a été bloqué pour les raisons énumérées ci-dessous / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Détecté {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Caractères de contrôle ont été détectés';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Detected archive cryptée; Archives cryptées pas autorisés';
$phpMussel['Config']['lang']['failed_to_access'] = 'Échec d\'accès ';
$phpMussel['Config']['lang']['file'] = 'Fichier';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Fichier taille limite dépassé';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Type de fichier sur la noire liste';
$phpMussel['Config']['lang']['finished'] = 'Terminé';
$phpMussel['Config']['lang']['generated_by'] = 'Généré par';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Greylist vidé.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Greylist n\'a pas été réactualisé';
$phpMussel['Config']['lang']['greylist_updated'] = ' Greylist réactualisé.';
$phpMussel['Config']['lang']['image'] = 'Image';
$phpMussel['Config']['lang']['instance_already_active'] = 'Instance déjà actif! S\'il vous plaît vérifiez vos crochets.';
$phpMussel['Config']['lang']['invalid_file'] = 'Fichier non valide';
$phpMussel['Config']['lang']['invalid_url'] = 'URL non valide!';
$phpMussel['Config']['lang']['ok'] = 'Bien';
$phpMussel['Config']['lang']['only_allow_images'] = 'Télécharger des fichiers qui ne sont pas images n\'est pas autorisée';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel désactivé.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel déjà désactivé.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel activé.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel déjà activé.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Répertoire de plugins n\'existe pas!';
$phpMussel['Config']['lang']['recursive'] = 'Recursion limite de profondeur dépassé';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Variables requises ne sont pas définies: Ne pouvez pas continuer.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Analyse avorté!';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x} caméléon attaque détecté';
$phpMussel['Config']['lang']['scan_checking'] = 'Vérification';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Succès! Procédant à vérifier le contenu.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'Commande injection tentative détecté';
$phpMussel['Config']['lang']['scan_complete'] = 'Complète';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Manqué (manquant extensions requises)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Fichier nom manipulation détecté';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Signature carte corrompu';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Signature carte manquante';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Nom de fichier manquant';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Manqué (vide ou pas une archive)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'Pas problème trouvé.';
$phpMussel['Config']['lang']['scan_reading'] = 'Accéder';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Signature fichier corrompu';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Signature fichier manquant';
$phpMussel['Config']['lang']['scan_tampering'] = 'Détecté potentiellement dangereux altération de fichier';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'Non autorisée manipulation de téléchargement de fichiers détecté';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'Non autorisée manipulation de téléchargement de fichiers ou mauvaise configuration détecté! ';
$phpMussel['Config']['lang']['started'] = 'Commencé';
$phpMussel['Config']['lang']['too_many_urls'] = 'Trop de URL';
$phpMussel['Config']['lang']['update_'] = 'phpMussel va maintenant tenter à réactualiser.';
$phpMussel['Config']['lang']['update_available'] = 'Une réactualisation du script est disponible.';
$phpMussel['Config']['lang']['update_complete'] = 'Réactualisation chèque réussi.';
$phpMussel['Config']['lang']['update_created'] = 'créé';
$phpMussel['Config']['lang']['update_deleted'] = 'supprimé';
$phpMussel['Config']['lang']['update_err1'] = 'Update échec: \'update.dat\' manquant. Réinstaller ou réactualiser manuellement.';
$phpMussel['Config']['lang']['update_err2'] = 'Update échec: \'update.dat\' ne contient pas de sources valide de réactualisations. Réactualiser manuellement s\'il vous plaît.';
$phpMussel['Config']['lang']['update_err3'] = 'Possible hack ou falsification de données détecté dans les réactualisation instructions fournie par la source de la réactualisation; Source peut être compromise. S\'il vous plaît, aviser l\'auteur de la script. Réactualisation manuellement est recommandé.';
$phpMussel['Config']['lang']['update_err4'] = 'Checksum manquant!';
$phpMussel['Config']['lang']['update_err5'] = 'Données manquant!';
$phpMussel['Config']['lang']['update_err6'] = 'Mauvais données!';
$phpMussel['Config']['lang']['update_err7'] = 'Mauvais checksum!';
$phpMussel['Config']['lang']['update_failed'] = 'Manqué.';
$phpMussel['Config']['lang']['update_fetch'] = 'Tenter d\'apporter les données de la version de {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Verrouillage des réactualisations a été détecté: Ne pouvez pas continuer. Examiner pour réactualisations corrompues ou réessayez plus tard.';
$phpMussel['Config']['lang']['update_not'] = 'PAS {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'Aucune réactualisation du script est disponible à ce moment.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Une réactualisation du script est disponible, mais ne peut pas être entièrement réactualisé avec cette version du réactualisation script. S\'il vous plaît réactualiser manuellement.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel n\'a pas réussi à réactualiser parce qu\'il ne pouvait pas connecter à une valide réactualisation source. Réactualisation manuelle est recommandé.';
$phpMussel['Config']['lang']['update_patched'] = 'patché';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Réactualisation script fichier manquant! S\'il vous plaît, réinstaller phpMussel.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' secondes écoulées';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Une signatures réactualisation est disponible.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'DERNIÈRES SIGNATURES';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'Aucune réactualisation du signatures est disponible à ce moment.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'VOS SIGNATURES';
$phpMussel['Config']['lang']['update_success'] = 'Succès.';
$phpMussel['Config']['lang']['update_successfully'] = ' avec succès';
$phpMussel['Config']['lang']['update_version_latest'] = 'DERNIÈRE SCRIPT VERSION';
$phpMussel['Config']['lang']['update_version_yours'] = 'VOS SCRIPT VERSION';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'signatures';
$phpMussel['Config']['lang']['upload_error_1'] = 'Fichier taille dépasse la directive upload_max_filesize. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Fichier taille dépasse la forme spécifiée fichier taille limite. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Téléchargement échec! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Téléchargement répertoire manquant! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Disque-écriture erreur! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP mauvaise configuration détecté! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Téléchargement limite dépassé';
$phpMussel['Config']['lang']['wrong_password'] = 'Mauvais mot de passe; Action rejetée.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'n\'existe pas';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
