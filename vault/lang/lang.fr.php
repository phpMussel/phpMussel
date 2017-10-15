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
 * This file: French language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Language plurality rule. */
$phpMussel['Plural-Rule'] = function($Num) {
    return ($Num >= 0 || $Num <= 1) ? 0 : 1;
};

$phpMussel['lang']['bad_command'] = 'Je ne comprends pas cette commande, désolé.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Échec du terminer le processus d\'analyse';
$phpMussel['lang']['cli_is_not_a'] = ' n\'est pas un fichier ou un répertoire.';
$phpMussel['lang']['cli_ln2'] = " Merci d\'utiliser phpMussel, un script PHP pour la détection de virus, logiciels\n malveillants et autres menaces dans les fichiers téléchargés sur votre système\n partout où le script est accroché, basé sur les signatures de ClamAV et autres.\n\n PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 par Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Exécute actuellement phpMussel en mode CLI (Interface Ligne de Commande).\n\n Pour analyser un fichier ou répertoire, taper 'scan', suivi par le nom du\n fichier ou répertoire que vous voulez que phpMussel analyse et appuyez sur\n Entrée ; Tapez « c » et appuyez sur Entrée pour une liste de commandes du mode\n CLI ; Tapez 'q' et appuyez sur Entrée pour quitter :";
$phpMussel['lang']['cli_pe1'] = 'Pas un valide PE fichier !';
$phpMussel['lang']['cli_pe2'] = 'Sections du PE :';
$phpMussel['lang']['cli_signature_placeholder'] = 'NOM-DE-SIGNATURE';
$phpMussel['lang']['cli_working'] = 'En cours';
$phpMussel['lang']['corrupted'] = 'PE corrompu détecté';
$phpMussel['lang']['data_not_available'] = 'Les données ne sont pas disponibles.';
$phpMussel['lang']['denied'] = 'Téléchargement Refusé !';
$phpMussel['lang']['denied_reason'] = 'Votre tentative de téléchargement a été bloquée pour les raisons énumérées ci-dessous :';
$phpMussel['lang']['detected'] = 'Détecté {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Caractères de contrôle ont été détectés';
$phpMussel['lang']['encrypted_archive'] = 'Archive cryptée détectée; Archives cryptées interdites';
$phpMussel['lang']['failed_to_access'] = 'Échec d\'accès ';
$phpMussel['lang']['file'] = 'Fichier';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Taille limite fichier dépassée';
$phpMussel['lang']['filetype_blacklisted'] = 'Type de fichier sur liste noire';
$phpMussel['lang']['finished'] = 'Terminé';
$phpMussel['lang']['generated_by'] = 'Généré par';
$phpMussel['lang']['greylist_cleared'] = ' Greylist vidé.';
$phpMussel['lang']['greylist_not_updated'] = ' Liste grise n\'a pas été mise à jour';
$phpMussel['lang']['greylist_updated'] = ' Liste grise mise à jour.';
$phpMussel['lang']['image'] = 'Image';
$phpMussel['lang']['instance_already_active'] = 'Instance déjà active ! Veuillez vérifier vos crochets.';
$phpMussel['lang']['invalid_data'] = 'Données non valides !';
$phpMussel['lang']['invalid_file'] = 'Fichier non valide';
$phpMussel['lang']['invalid_url'] = 'URL non valide !';
$phpMussel['lang']['ok'] = 'Bien';
$phpMussel['lang']['only_allow_images'] = 'Le téléchargement de fichiers qui ne sont pas des images n\'est pas autorisé';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Le répertoire de plugins n\'existe pas !';
$phpMussel['lang']['quarantined_as'] = "Mis en quarantaine comme « /vault/quarantine/{QFU}.qfu ».\n";
$phpMussel['lang']['recursive'] = 'Profondeur limite de récursion dépassée';
$phpMussel['lang']['required_variables_not_defined'] = 'Les variables requises ne sont pas définies : Vous ne pouvez pas continuer.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL potentiellement nuisible détecté';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Erreur de requête de l\'API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Erreur d\'autorisation de l\'API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Le service de l\'API est indisponible';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Erreur API inconnue';
$phpMussel['lang']['scan_aborted'] = 'Analyse abandonnée !';
$phpMussel['lang']['scan_chameleon'] = 'Attaque {x} caméléon détectée';
$phpMussel['lang']['scan_checking'] = 'Vérification';
$phpMussel['lang']['scan_checking_contents'] = 'Succès ! La vérification des contenus peut continuer.';
$phpMussel['lang']['scan_command_injection'] = 'Tentative d\'injection de commande détectée';
$phpMussel['lang']['scan_complete'] = 'Terminé';
$phpMussel['lang']['scan_extensions_missing'] = 'Échec (extensions requises manquantes) !';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Manipulation de nom de fichier détectée';
$phpMussel['lang']['scan_missing_filename'] = 'Nom de fichier manquant';
$phpMussel['lang']['scan_not_archive'] = 'Échec (vide ou pas une archive) !';
$phpMussel['lang']['scan_no_problems_found'] = 'Pas de problème trouvé.';
$phpMussel['lang']['scan_reading'] = 'Lecture en cours';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Fichier des signatures corrompu';
$phpMussel['lang']['scan_signature_file_missing'] = 'Fichiers des signatures manquant';
$phpMussel['lang']['scan_tampering'] = 'Altération de fichier potentiellement dangereuse détectée';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Non autorisée manipulation de téléchargement de fichiers détecté';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Manipulation de téléchargement de fichiers non autorisée ou mauvaise configuration détectée ! ';
$phpMussel['lang']['started'] = 'Commencé';
$phpMussel['lang']['too_many_urls'] = 'Trop d\'URLs';
$phpMussel['lang']['upload_error_1'] = 'La taille du fichier dépasse la directive upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'La taille du fichier dépasse la limite spécifiée dans le formulaire taille limite. ';
$phpMussel['lang']['upload_error_34'] = 'Échec du téléchargement ! S\'il vous plaît contacter le hostmaster pour obtenir de l\'aide ! ';
$phpMussel['lang']['upload_error_6'] = 'Répertoire de téléchargement manquant ! Veuillez contacter le hostmaster pour obtenir de l\'aide ! ';
$phpMussel['lang']['upload_error_7'] = 'Erreur d\'écriture disque ! Veuillez contacter le hostmaster pour obtenir de l\'aide ! ';
$phpMussel['lang']['upload_error_8'] = 'Mauvaise configuration PHP détectée ! Veuillez contacter le hostmaster pour obtenir de l\'aide ! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Limite de téléchargement dépassée';
$phpMussel['lang']['wrong_password'] = 'Mauvais mot de passe; Action rejetée.';
$phpMussel['lang']['x_does_not_exist'] = 'n\'existe pas';
$phpMussel['lang']['_exclamation'] = ' ! ';
$phpMussel['lang']['_exclamation_final'] = ' !';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Quitter CLI.
 - Alias : quit, exit.
 md5_file
 - Générer les signatures MD5 des fichiers [Syntaxe : md5_file fichier].
 - Alias : m.
 sha1_file
 - Générer les signatures SHA1 des fichiers [Syntaxe : sha1_file fichier].
 md5
 - Générer la signature MD5 à partir d'une chaîne [Syntaxe : md5 chaîne].
 sha1
 - Générer la signature SHA1 à partir d'une chaîne [Syntaxe : sha1 chaîne].
 hex_encode
 - Convertir une chaîne binaire en hexadécimal [Syntaxe : hex_encode chaîne].
 - Alias : x.
 hex_decode
 - Convertir hexadécimal en chaîne binaire [Syntaxe : hex_decode chaîne].
 base64_encode
 - Convertir chaîne binaire en chaîne base64 [Syntaxe : base64_encode chaîne].
 - Alias : b.
 base64_decode
 - Convertir chaîne base64 en chaîne binaire [Syntaxe : base64_decode chaîne].
 pe_meta
 - Extraire les métadonnées d'un fichier PE [Syntaxe : pe_meta fichier].
 url_sig
 - Générer des signatures de scanner d'URL [Syntaxe : url_sig chaîne].
 scan
 - Analyser fichier ou répertoire [Syntaxe : scan fichier].
 - Alias : s.
 c
 - Imprimer cette liste des commandes.
";
