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
 * This file: French language data (last modified: 2017.02.07).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Je ne comprends pas cette commande, désolé.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Échec du terminer le processus d\'analyse';
$phpMussel['lang']['cli_is_not_a'] = ' n\'est pas un fichier ou un répertoire.';
$phpMussel['lang']['cli_ln2'] = " Merci pour l'utiliser de phpMussel, un PHP script pour la détection de virus,\n malveillants logiciels et autres menaces dans les fichiers téléchargés sur\n votre système partout où le script est accroché, basé sur les signatures de\n ClamAV et autres.\n\n PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 par Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Fonctionne comme CLI mode pour le moment (commande ligne interface).\n\n Pour analyser un fichier ou répertoire, taper 'scan', suivi par le nom du\n fichier ou répertoire que vous voulez phpMussel pour analyser et appuyez sur\n Entrée; Tapez 'c' et appuyez sur Entrée pour une liste de CLI mode commandes;\n Taper 'q' et appuyez sur Entrée pour quitter:";
$phpMussel['lang']['cli_pe1'] = 'Pas un valide PE fichier!';
$phpMussel['lang']['cli_pe2'] = 'PE Sections:';
$phpMussel['lang']['cli_working'] = 'En cours';
$phpMussel['lang']['corrupted'] = 'Détecté corrompu PE';
$phpMussel['lang']['denied'] = 'Téléchargement Refusé!';
$phpMussel['lang']['denied_reason'] = 'Votre tentative à télécharger a été bloqué pour les raisons énumérées ci-dessous:';
$phpMussel['lang']['detected'] = 'Détecté {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Caractères de contrôle ont été détectés';
$phpMussel['lang']['encrypted_archive'] = 'Detected archive cryptée; Archives cryptées pas autorisés';
$phpMussel['lang']['failed_to_access'] = 'Échec d\'accès ';
$phpMussel['lang']['file'] = 'Fichier';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Fichier taille limite dépassé';
$phpMussel['lang']['filetype_blacklisted'] = 'Type de fichier sur la noire liste';
$phpMussel['lang']['finished'] = 'Terminé';
$phpMussel['lang']['generated_by'] = 'Généré par';
$phpMussel['lang']['greylist_cleared'] = ' Greylist vidé.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist n\'a pas été réactualisé';
$phpMussel['lang']['greylist_updated'] = ' Greylist réactualisé.';
$phpMussel['lang']['image'] = 'Image';
$phpMussel['lang']['instance_already_active'] = 'Instance déjà actif! S\'il vous plaît vérifiez vos crochets.';
$phpMussel['lang']['invalid_file'] = 'Fichier non valide';
$phpMussel['lang']['invalid_url'] = 'URL non valide!';
$phpMussel['lang']['ok'] = 'Bien';
$phpMussel['lang']['only_allow_images'] = 'Télécharger des fichiers qui ne sont pas images n\'est pas autorisée';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Répertoire de plugins n\'existe pas!';
$phpMussel['lang']['quarantined_as'] = "Mis en quarantaine comme \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursion limite de profondeur dépassé';
$phpMussel['lang']['required_variables_not_defined'] = 'Variables requises ne sont pas définies: Ne pouvez pas continuer.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL potentiellement nuisible détecté';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Erreur de requête de l\'API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Erreur d\'autorisation de l\'API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Le service de l\'API est indisponible';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'API erreur inconnue';
$phpMussel['lang']['scan_aborted'] = 'Analyse avorté!';
$phpMussel['lang']['scan_chameleon'] = '{x} caméléon attaque détecté';
$phpMussel['lang']['scan_checking'] = 'Vérification';
$phpMussel['lang']['scan_checking_contents'] = 'Succès! Procédant à vérifier le contenu.';
$phpMussel['lang']['scan_command_injection'] = 'Commande injection tentative détecté';
$phpMussel['lang']['scan_complete'] = 'Complète';
$phpMussel['lang']['scan_extensions_missing'] = 'Manqué (manquant extensions requises)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Fichier nom manipulation détecté';
$phpMussel['lang']['scan_missing_filename'] = 'Nom de fichier manquant';
$phpMussel['lang']['scan_not_archive'] = 'Manqué (vide ou pas une archive)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Pas problème trouvé.';
$phpMussel['lang']['scan_reading'] = 'Accéder';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Signature fichier corrompu';
$phpMussel['lang']['scan_signature_file_missing'] = 'Signature fichier manquant';
$phpMussel['lang']['scan_tampering'] = 'Détecté potentiellement dangereux altération de fichier';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Non autorisée manipulation de téléchargement de fichiers détecté';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Non autorisée manipulation de téléchargement de fichiers ou mauvaise configuration détecté! ';
$phpMussel['lang']['started'] = 'Commencé';
$phpMussel['lang']['too_many_urls'] = 'Trop de URL';
$phpMussel['lang']['upload_error_1'] = 'Fichier taille dépasse la directive upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'Fichier taille dépasse la forme spécifiée fichier taille limite. ';
$phpMussel['lang']['upload_error_34'] = 'Téléchargement échec! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['lang']['upload_error_6'] = 'Téléchargement répertoire manquant! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['lang']['upload_error_7'] = 'Disque-écriture erreur! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['lang']['upload_error_8'] = 'PHP mauvaise configuration détecté! S\'il vous plaît contacter le hostmaster pour l\'aide! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Téléchargement limite dépassé';
$phpMussel['lang']['wrong_password'] = 'Mauvais mot de passe; Action rejetée.';
$phpMussel['lang']['x_does_not_exist'] = 'n\'existe pas';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Quitter CLI.
 - Alias: quit, exit.
 md5_file
 - Générer MD5 signatures des fichiers [Syntaxe: md5_file \"nom du fichier\"].
 - Alias: m.
 md5
 - Générer MD5 signature de string [Syntaxe: md5 string].
 hex_encode
 - Convertir binaire string à hexadécimal [Syntaxe: hex_encode string].
 - Alias: x.
 hex_decode
 - Convertir hexadécimal à binaire string [Syntaxe: hex_decode string].
 base64_encode
 - Convertir binaire string à base64 string [Syntaxe: base64_encode string].
 - Alias: b.
 base64_decode
 - Convertir base64 string à binaire string [Syntaxe: base64_decode string].
 scan
 - Analyser fichier ou répertoire [Syntaxe: scan \"nom du fichier\"].
 - Alias: s.
 c
 - Imprimer cette liste des commandes.
";
