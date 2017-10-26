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
 * This file: French language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Page d\'Accueil</a> | <a href="?phpmussel-page=logout">Déconnecter</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Déconnecter</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Les extensions de fichiers d\'archives reconnus (format est CSV ; devraient ajouter ou supprimer seulement quand problèmes surviennent ; supprimer inutilement peut entraîner des faux positifs à paraître pour archive fichiers, tandis que ajoutant inutilement sera essentiellement liste blanche ce que vous ajoutez à partir de l\'attaque spécifique détection ; modifier avec prudence ; aussi noter que cela n\'a aucun effet sur ce archives peut et ne peut pas être analysé au niveau du contenu). La liste, comme en cas de défaut, énumère les formats plus couramment utilisé dans la majorité des systèmes et CMS, mais volontairement pas nécessairement complète.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Bloquer tous les fichiers contenant les caractères de contrôle (autre que les sauts de ligne) ? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Si vous êtes <em><strong>SEULEMENT</strong></em> télécharger de brut texte fichiers, puis vous pouvez activer cette option à fournir une supplémentaire protection à votre système. Mais, si vous télécharger quelque chose plus que brut texte, l\'activation de cette peut créer faux positifs. False = Ne pas bloquer [Défaut] ; True = Bloquer.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Vérifier pour les headers d\'exécutables dans les fichiers qui ne sont pas fichiers exécutable ni reconnue comme archives et pour exécutables dont headers sont incorrects. False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Vérifier pour les header PHP dans les fichiers qui ne sont pas de PHP ni reconnue comme archives. False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Vérifier pour les archives dont headers sont incorrects (Supporté : BZ, GZ, RAR, ZIP, RAR, GZ). False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Vérifier pour les documents office dont headers sont incorrects (Supporté : DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Vérifier pour les images dont headers sont incorrects (Supporté : BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Vérifier pour les fichiers PDF dont headers sont incorrects. False = Désactivé; True = Activé.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Fichiers corrompus et erreurs d\'analyse. False = Ignorer ; True = Bloquer [Défaut]. Détecter et bloquer les fichiers PE (Portable Executable) potentiellement corrompus ? Souvent (mais pas toujours), lorsque certains aspects d\'un fichier PE sont corrompus ou ne peut pas être analysée correctement, il peut être le signe d\'une infection virale. Les processus utilisés par la plupart des programmes anti-virus pour détecter les virus dans fichiers PE requérir l\'analyse de ces fichiers par méthodes certaines, de ce que, si le programmeur d\'un virus est conscient de, seront spécifiquement tenter d\'empêcher, en vue de permettre leur virus n\'être pas détectée.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Seuil à la longueur de brutes données dans laquelle commandes des décodages doivent être détectés (dans le cas où il ya remarquable performance problèmes au cours de l\'analyse). Défaut = 512Ko. Zéro ou nulle valeur désactive le seuil (supprimant toute restriction basé sur la taille du fichier).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Seuil à la longueur de données brutes dans laquelle phpMussel est autorisé à lire et à analyser (dans le cas où il ya remarquable performance problèmes au cours de l\'analyse). Défaut = 32Mo. Zéro ou nulle valeur désactive le seuil. En général, cette valeur ne doit pas être moins que la moyenne tailles des fichiers des téléchargements que vous voulez et s\'attendent à recevoir de votre serveur ou site web, ne devrait pas être plus que la filesize_limit directive, et ne devrait pas être plus que d\'un cinquième de l\'allocation de totale mémoire autorisée à PHP via le "php.ini" fichier de configuration. Cette directive existe pour tenter d\'empêcher phpMussel d\'utiliser trop de mémoire (ce qui l\'empêcherait d\'être capable d\'analyse fichiers dessus d\'une certaine taille avec succès).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Cette directive doit généralement être DÉSACTIVÉ sauf si cela est nécessaire pour la correcte fonctionnalité de phpMussel sur votre spécifique système. Normalement, lorsque DÉSACTIVÉ, lorsque phpMussel détecte la présence d\'éléments dans le <code>$_FILES</code>() tableau, il va tenter de lancer une analyse du fichiers que ces éléments représentent, et, si ces éléments sont vide, phpMussel retourne un message d\'erreur. Ce comportement est normal pour phpMussel. Mais, pour certains CMS, vides éléments dans <code>$_FILES</code> peuvent survenir à la suite du naturel comportement de ces CMS, ou erreurs peuvent être signalés quand il ne sont pas tout, dans ce cas, le normal comportement pour phpMussel seront interférer avec le normal comportement de ces CMS. Si telle une situation se produit pour vous, ACTIVATION de cette option sera instruire phpMussel ne pas à tenter de lancer d\'analyses pour ces vides éléments, ignorer quand il est reconnu et ne pas à retourner tout de connexes messages d\'erreur, permettant ainsi la continuation de la page demande. False = DÉSACTIVÉ; True = ACTIVÉ.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Si vous seulement attendre ou vouloir d\'autoriser images à être téléchargé sur votre système ou CMS, et si vous absolument n\'avez pas besoin tous les fichiers autres que les images à être téléchargé sur votre système ou CMS, cette directive devrait être ACTIVÉ, mais devrait autrement être DÉSACTIVÉ. Si cette directive est ACTIVÉ, il va instruire phpMussel à bloquer indistinctement tous téléchargements identifié comme non image fichiers, sans analyser. Cela peut réduire le temps de travail et l\'utilisation de la mémoire pour les tentativé téléchargements de non image fichiers. False = DÉSACTIVÉ; True = ACTIVÉ.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Détecter et bloquer les archives cryptées ? Parce phpMussel est pas capable d\'analyse du contenu des archives cryptées, il est possible que le cryptage des archives peut être utilisé par un attaquant un moyen a tenter de contourner phpMussel, analyseurs anti-virus et d\'autres protections. Instruire phpMussel pour bloquer toutes les archives cryptées qu\'il découvre pourrait aider à réduire les risques associés à ces possibilités. False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_files_check_archives'] = 'Essayer vérifier les contenus des archives ? False = Non (ne pas vérifier) ; True = Oui (vérifier) [Défaut]. En ce moment, les seuls formats d\'archives et de compression supporté sont BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR et ZIP (les formats d\'archives et de compression RAR, CAB, 7z et etc ne sont pas supporté en ce moment). Ce n\'est pas à toute épreuve ! Bien que je recommande fortement d\'avoir ce reste activée, je ne peux pas garantir il va toujours trouver tout. Aussi être conscient que l\'examen d\'archives actuellement n\'est pas récursif pour PHARs ou ZIPs formats.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Étendre taille du fichier liste noire/blanche paramètres à le contenu des archives ? False = Non (énumérer grise tout) ; True = Oui [Défaut].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Limite de taille des fichiers en Ko. 65536 = 64Mo [Défaut] ; 0 = Pas limite (toujours en liste grise), tout (positif) valeur numérique acceptée. Cela peut être utile lorsque votre configuration de PHP limite la quantité de mémoire qu\'un processus peut contenir ou si votre configuration de PHP limite la taille du fichier téléchargements.';
$phpMussel['lang']['config_files_filesize_response'] = 'Que faire avec des fichiers qui dépassent la limite de taille des fichiers (si existant). False = Énumérer Blanche ; True = Énumérer Noire [Défaut].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Étendre type de fichier liste noire/blanche paramètres à le contenu des archives ? False = Non (énumérer grise tout) ; True = Oui [Défaut].';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Liste Noire :';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Liste Gris :';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Si votre système permettre seulement particuliers types des fichiers à être téléchargé, ou si votre système nie explicitement particuliers types des fichiers, spécifiant les types des fichiers dans listes blanches, listes noires et listes gris peut augmenter la vitesse à laquelle l\'analyse est effectuée en permettant le script à sauter particuliers types des fichiers. Format est CSV (virgule séparées valeurs). Si vous souhaitez analyse tout, plutôt que de liste blanche, liste noire ou liste gris, laisser les variable(/s) blanc ; Il va désactiver liste blanche/noire/gris. L\'ordre logique de l\'application est : Si le type de fichier est listé blanche, n\'analyser pas ni bloquer pas le fichier, et ne vérifie pas le fichier contre la liste noire ou la liste grise. Si le type de fichier est listé noire, n\'analyser pas le fichier mais bloquer de toute façon, et ne vérifie pas le fichier contre la liste grise. Si la liste grise est vide ou si la liste grise n\'est vide pas et le type de fichier est listé grise, analyser le fichier comme d\'habitude et déterminer si de bloquer basés des résultats de l\'analyse, mais si la liste grise n\'est vide pas et le type de fichier n\'est listé grise pas, traiter le fichier comme listé noire, donc n\'analyse pas mais bloque de toute façon. Liste Blanche :';
$phpMussel['lang']['config_files_max_recursion'] = 'Maximum récursivité profondeur limite pour archives. Défaut = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximum admissible nombre de fichiers pour analyse lorsque l\'analyse de fichier téléchargements avant d\'abandonner l\'analyse et informer l\'utilisateur qu\'ils sont téléchargement trop à la fois! Fournit protection contre une théorique attaque par lequel un attaquant tente à DDoS votre système ou CMS par surchargeant phpMussel à ralentir le processus de PHP à une halte. Recommandé : 10. Vous pouvez désirer d\'augmenter ou diminuer ce nombre dépendamment de la vitesse de votre hardware. Notez que ce nombre ne tient pas compte pour ou inclure le contenus des archives.';
$phpMussel['lang']['config_general_cleanup'] = 'Déensemble variables du script et cache après l\'exécution ? False = Non ; True = Oui [Défaut]. Si vous ne utilisez pas le script au-delà l\'initiale analyse du téléchargements, devrait ensemble à <code>true</code> (oui) à minimiser l\'utilisation de la mémoire. Si vous utilisez le script à des fins au-delà l\'initiale analyse du téléchargements, devrait ensemble à <code>false</code> (non), pour éviter recharger inutilement dupliqué données dans la mémoire. Dans la pratique générale, il devrait probablement être ensemblé à <code>true</code>, mais, si vous faites cela, vous ne serez pas être capable d\'utiliser le script pour tout chose autre que l\'analyse des fichiers téléchargements. N\'a pas d\'influence en le mode CLI.';
$phpMussel['lang']['config_general_default_algo'] = 'Définit quel algorithme utiliser pour tous les mots de passe et les sessions à l\'avenir. Options : PASSWORD_DEFAULT (défaut), PASSWORD_BCRYPT, PASSWORD_ARGON2I (nécessite PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Mise en cette option sera instruire le script à tenter immédiatement supprimer tout fichiers elle constate au cours de son analyse correspondant à des critères de détection, que ce soit via des signatures ou autrement. Fichiers jugées propre ne seront pas touchés. Dans le cas des archives, l\'ensemble d\'archive sera supprimé (indépendamment de si le incriminé fichier est que l\'un de plusieurs fichiers contenus dans l\'archive). Pour le cas d\'analyse de fichiers téléchargement, généralement, il n\'est pas nécessaire d\'activer cette option sur, parce généralement, PHP faire purger automatiquement les contenus de son cache lorsque l\'exécution est terminée, ce qui signifie que il va généralement supprimer tous les fichiers téléchargés à travers elle au serveur sauf qu\'ils ont déménagé, copié ou supprimé déjà. L\'option est ajoutée ici comme une supplémentaire mesure de sécurité pour ceux dont copies de PHP peut pas toujours se comporter de la manière attendu. False = Après l\'analyse, laissez le fichier tel quel [Défaut] ; True = Après l\'analyse, si pas propre, supprimer immédiatement.';
$phpMussel['lang']['config_general_disable_cli'] = 'Désactiver le mode CLI ? Le mode CLI est activé par défaut, mais peut parfois interférer avec certains test outils (comme PHPUnit, par exemple) et d\'autres applications basées sur CLI. Si vous n\'avez pas besoin désactiver le mode CLI, vous devrait ignorer cette directive. False = Activer le mode CLI [Défaut] ; True = Désactiver le mode CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Désactiver l\'accès frontal ? L\'accès frontal peut rendre phpMussel plus facile à gérer, mais peut aussi être un risque potentiel pour la sécurité. Il est recommandé de gérer phpMussel via le back-end chaque fois que possible, mais l\'accès frontal est prévu pour quand il est impossible. Seulement activer si vous avez besoin. False = Activer l\'accès frontal ; True = Désactiver l\'accès frontal [Défaut].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Désactiver les webfonts ? True = Oui ; False = Non [Défaut].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Permettre le support pour les plugins du phpMussel ? False = Non [Défaut] ; True = Oui.';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Devrait phpMussel envoyer 403 headers avec le fichier téléchargement bloqué message, ou rester avec l\'habitude 200 bien (200 OK) ? False = Non (200) ; True = Oui (403) [Défaut].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Fichier pour l\'enregistrement des tentatives de connexion à l\'accès frontal. Spécifier un fichier, ou laisser vide à désactiver.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Quand le honeypot mode est activé, phpMussel va tenter de mettre en quarantaine tous les fichier téléchargements ce qu\'il rencontre, indépendamment de si oui ou non le fichier en cours de téléchargement correspond à signature inclus, et aucune réelle analyse de ces fichier téléchargements tentatives va arriver. Cette fonctionnalité devrait être utile pour ceux qui souhaitent utiliser phpMussel pour des fins de logiciels malveillants ou virus recherche, mais il pas n\'est recommandé d\'activer cette fonctionnalité si l\'utilisation prévue de phpMussel par l\'utilisateur est l\'analyse de fichier téléchargements comme la norme, ni est-il recommandé d\'utiliser la honeypot fonctionnalité pour fins autres que celles du honeypot. Par défaut, cette option est désactivée. False = Désactivé [Défaut] ; True = Activé.';
$phpMussel['lang']['config_general_ipaddr'] = 'Où trouver l\'adresse IP de demandes de connexion ? (Utile pour services tels que Cloudflare et similaires) Par Défaut = REMOTE_ADDR. AVERTISSEMENT : Ne pas changer si vous ne sais pas ce que vous faites !';
$phpMussel['lang']['config_general_lang'] = 'Spécifiez la langue défaut pour phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Activer le mode de maintenance ? True = Oui ; False = Non [Défaut]. Désactive tout autre que l\'accès frontal. Parfois utile pour la mise à jour de votre CMS, des frameworks, etc.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Nombre maximal de tentatives de connexion (l\'accès frontal). Défaut = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Comment préférez-vous que les nombres soient affichés ? Sélectionnez l\'exemple qui vous paraît le plus approprié.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel est capable de mettre en quarantaine le marqué fichier téléchargement tentatives en isolement au sein de la voûte de phpMussel, si cela est quelque chose que vous voulez qu\'il fasse. L\'utilisateurs de phpMussel qui souhaitent simplement de protéger leurs sites ou environnement d\'hébergement sans avoir un profondément intérêt dans d\'analyse de quelconque marqué fichier téléchargement tentatives devrait laisser cette fonctionnalité désactivée, mais tous les utilisateurs intéressés dans d\'analyse plus approfondie de tenté fichier téléchargements pour la recherche des logiciels malveillants ou pour des choses semblables devraient permettre cette fonctionnalité. La quarantaine de marqué fichier téléchargement tentatives peut parfois aider également dans le débogage des faux positifs, si cela est quelque chose qui se produit fréquemment pour vous. Pour désactiver la fonctionnalité de quarantaine, il suffit de laisser la directive <code>quarantine_key</code> vide, ou effacer le contenu de cette directive si elle est pas déjà vide. Pour activer la fonctionnalité de quarantaine, entrer une valeur dans la directive. Le <code>quarantine_key</code> est une élément important de la sécurité de la fonctionnalité de quarantaine requis en tant que moyen de prévention de la fonctionnalité de quarantaine d\'être exploités par des attaquants potentiels en tant que moyen de prévention toute potentielle exécution de données stockées dans la quarantaine. Le <code>quarantine_key</code> devrait être traité de la même manière que vos mots de passe : Le plus sera le mieux, et conservez-le bien. Pour un meilleur effet, utiliser en conjonction avec <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'La maximum taille autorisée de fichiers mis en quarantaine. Fichiers au-dessus de cette valeur ne sera pas placé en quarantaine. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d\'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l\'emballement d\'utilisation des données sur votre service d\'hébergement. Défaut = 2Mo.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'La maximale utilisation autorisée de la mémoire pour la quarantaine. Si la totale d\'utilisée mémoire par la quarantaine atteint cette valeur, les anciens fichiers en quarantaine seront supprimés jusqu\'à ce que la totale mémoire utilisée n\'atteint pas cette valeur. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d\'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l\'emballement d\'utilisation des données sur votre service d\'hébergement. Défaut = 64Mo.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Pour combien de temps devrait phpMussel cache les résultats de l\'analyse ? La valeur est le nombre de secondes pour mettre en cache les résultats de l\'analyse pour. Par défaut est 21600 secondes (6 heures) ; Une valeur de 0 désactive mettre en cache les résultats de l\'analyse.';
$phpMussel['lang']['config_general_scan_kills'] = 'Nom du fichier à enregistrer tous les résultats de bloqué ou tué téléchargements. Spécifiez un nom de fichier, ou laisser vide à désactiver.';
$phpMussel['lang']['config_general_scan_log'] = 'Nom du fichier à enregistrer tous les résultats de l\'analyse. Spécifiez un nom de fichier, ou laisser vide à désactiver.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Nom du fichier à enregistrer tous les résultats de l\'analyse (le format est sérialisé). Spécifiez un nom de fichier, ou laisser vide à désactiver.';
$phpMussel['lang']['config_general_statistics'] = 'Suivre les statistiques d\'utilisation pour phpMussel ? True = Oui ; False = Non [Défaut].';
$phpMussel['lang']['config_general_timeFormat'] = 'Le format de notation de la date/heure utilisé par phpMussel. Des options supplémentaires peuvent être ajoutées sur demande.';
$phpMussel['lang']['config_general_timeOffset'] = 'Décalage horaire en minutes.';
$phpMussel['lang']['config_general_timezone'] = 'Votre fuseau horaire.';
$phpMussel['lang']['config_general_truncate'] = 'Tronquer les fichiers journaux lorsqu\'ils atteignent une certaine taille ? La valeur est la taille maximale en o/Ko/Mo/Go/To qu\'un fichier journal peut croître avant d\'être tronqué. La valeur par défaut de 0Ko désactive la troncature (les fichiers journaux peuvent croître indéfiniment). Remarque : S\'applique aux fichiers journaux individuels ! La taille des fichiers journaux n\'est pas considérée collectivement.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Il ya certaines signatures des phpMussel qui sont destinés à identifier des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement sans en eux-mêmes identifier les fichiers en cours de téléchargement spécifiquement comme étant malveillants. Cette « threshold » (seuil) valeur raconte à phpMussel ce que le total maximum poids des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement pour ce qui est admissible avant que ces fichiers doivent être signalées comme malveillant. La définition du poids dans ce contexte est le nombre total de suspectes et potentiellement malveillants qualités identifié. Par défaut, cette valeur sera fixée à 3. Une valeur inférieur va résulter généralement avec une fréquence supérieur de faux positifs mais une nombre supérieur de fichiers signalé comme malveillant, tandis que une valeur inférieur va résulter généralement avec une fréquence inférieur de faux positifs mais un nombre inférieur de fichiers signalé comme malveillant. Il est généralement préférable de laisser cette valeur à sa valeur défaut, sauf si vous rencontrez des problèmes qui sont liés à elle.';
$phpMussel['lang']['config_signatures_Active'] = 'Une liste des fichiers de signatures active, délimitée par des virgules.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Devrait phpMussel utiliser signatures pour détecter les adwares ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Devrait phpMussel utiliser signatures pour détecter les defacements and defacers ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Devrait phpMussel détecter et bloquer les fichiers cryptés ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Devrait phpMussel utiliser signatures pour détecter les blagues/canulars malware/virus ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Devrait phpMussel utiliser signatures pour détecter les emballeurs et des données emballés ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Devrait phpMussel utiliser signatures pour détecter les PUAs/PUPs ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Devrait phpMussel utiliser signatures pour détecter les scripts shell ? False = Non ; True = Oui [Défaut].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Devrait phpMussel signaler quand les extensions sont manquantes ? Si <code>fail_extensions_silently</code> est désactivé, extensions manquantes seront signalé sur analyse, et si <code>fail_extensions_silently</code> est activé, extensions manquantes seront ignorés, avec l\'analyse signalés pour ceux fichiers qu\'il n\'y a pas de problèmes. La désactivation de cette directive peut potentiellement augmenter votre sécurité, mais peut aussi conduire à une augmentation de faux positifs. False = Désactivé ; True = Activé [Défaut].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Devrait phpMussel signaler quand les extensions sont manquantes ? Si <code>fail_extensions_silently</code> est désactivé, extensions manquantes seront signalé sur analyse, et si <code>fail_extensions_silently</code> est activé, extensions manquantes seront ignorés, avec l\'analyse signalés pour ceux fichiers qu\'il n\'y a pas de problèmes. La désactivation de cette directive peut potentiellement augmenter votre sécurité, mais peut aussi conduire à une augmentation de faux positifs. False = Désactivé ; True = Activé [Défaut].';
$phpMussel['lang']['config_template_data_css_url'] = 'Le modèle fichier pour des thèmes personnalisés utilise les propriétés CSS externes, tandis que le modèle fichier pour le défaut thème utilise les propriétés CSS internes. Pour instruire phpMussel d\'utiliser le modèle fichier pour des thèmes personnalisés, spécifier l\'adresse HTTP public de votre thèmes personnalisés CSS fichiers utilisant le <code>css_url</code> variable. Si vous laissez cette variable vide, phpMussel va utiliser le modèle fichier pour le défaut thème.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Grossissement des fontes. Défaut = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Le thème à utiliser par défaut pour phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Combien de temps (en secondes) devrait les résultats du cherches de l\'API être conservé dans le cache ? Défaut est 3600 secondes (1 heure).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Permet cherches de l\'API Google Safe Browsing quand l\'API clé nécessaire est définie.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Permet cherches de l\'API hpHosts quand définit comme true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Nombre de cherches maximal de l\'API pour effectuer par itération d\'analyse individuelle. Parce que chaque API cherche supplémentaire va ajouter à la durée totale requise pour compléter chaque itération d\'analyse, vous pouvez prévoir une limitation afin d\'accélérer le processus d\'analyse. Quand défini comme 0, pas de telles nombre maximum admissible sera appliquée. Défini comme 10 par défaut.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Que faire si le nombre de cherches de l\'API maximal est dépassée ? False = Ne fais rien (poursuivre le traitement) [Défaut] ; True = Marque/bloquer le fichier.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Facultativement, phpMussel est capable d\'analyser les fichiers en utilisant le Virus Total API comme un moyen de fournir un renforcée niveau de protection contre les virus, trojans, logiciels malveillants et autres menaces. Par défaut, l\'analyse des fichiers en utilisant le Virus Total API est désactivé. Pour activer, une Total Virus API clé est nécessaire. En raison de le significative avantage que cela pourrait fournir pour vous, il est quelque chose que je recommande fortement pour l\'activer. S\'il vous plaît être conscient, cependant, que pour utiliser le Virus Total API, vous <em><strong>DEVEZ</strong></em> accepter leurs conditions d\'utilisation (Terms of Service) et vous <em><strong>DEVEZ</strong></em> respecter toutes les directives selon décrit par la documentation Virus Total ! Vous N\'ÊTES PAS autorisé à utiliser cette fonctionnalité SAUF SI : Vous avez lu et accepté les Conditions d\'Utilisation (Terms of Service) de Total Virus et son API. Vous avez lu et vous comprendre, au minimum, le préambule du Virus Total Publique API documentation (tout ce qui suit « VirusTotal Public API v2.0 » mais avant « Contents »).';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Selon le Virus Total API documentation, elle est limitée à au plus 4 demandes de toute nature dans un laps de 1 minute de temps. Si vous exécutez un honeyclient, honeypot ou autre automatisation qui va fournir les ressources pour Virus Total et pas seulement récupérer des rapports vous avez droit à un plus élevée demande quota. Par défaut, phpMussel va adhérer strictement à ces limitations, mais en raison de la possibilité de ces quotas étant augmenté, ces deux directives sont fournies comme un moyen pour vous d\'instruire phpMussel à quelle limite il faut adhérer. Sauf si vous avez été invité à le faire, on ne recommande pas pour vous d\'augmenter ces valeurs, mais, si vous avez rencontré des problèmes relatifs à atteindre votre quota, diminuant ces valeurs <em><strong>PEUT</strong></em> parfois vous aider dans le traitement de ces problèmes. Votre quota est déterminée comme <code>vt_quota_rate</code> demandes de toute nature dans un laps de <code>vt_quota_time</code> minute de temps.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Voir description ci-dessus).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Par défaut, phpMussel va restreindre les fichiers de l\'analyse utilisant le Virus Total API à ces fichiers qu\'il juges comme soupçonneux. Facultativement, vous pouvez régler cette restriction par changeant la valeur de la <code>vt_suspicion_level</code> directive.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Devrais phpMussel appliquer les résultats de l\'analyse en utilisant le Virus Total API comme détections ou comme pondération de détection ? Cette directive existe, parce que, quoique analyse d\'un fichier à l\'aide de plusieurs moteurs (comme Virus Total fait) devrait résulter en un augmenté taux de détection (et donc en un plus grand nombre de fichiers malveillants être détectés), il peut également résulter en un plus grand nombre de faux positifs, et donc, dans certaines circonstances, les résultats de l\'analyse peuvent être mieux utilisées comme un score de confiance plutôt que comme une conclusion définitive. Si la valeur 0 est utilisée, les résultats de l\'analyse en utilisant le Virus Total API seront être appliquées comme détections, et donc, si quelconque moteur utilisé par Virus Total marques le fichier analysé comme étant malveillants, phpMussel va considérer le fichier comme malveillant. Si quelconque autre valeur est utilisée, les résultats de l\'analyse en utilisant le Virus Total API sera appliquée comme pondération de détection, et donc, le nombre de moteurs utilisés par Total Virus que marque le fichier analysé comme étant malveillant sera servir un score de confiance (ou une pondération de détection) pour savoir si ou non le fichier êtant analysé devrait être considéré comme malveillant par phpMussel (la valeur utilisée représentera le minimum score de confiance ou le poids requis pour être considéré comme malveillant). Une valeur de 0 est utilisée par défaut.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'Le paquet principal (moins les signatures, la documentation et la configuration).';
$phpMussel['lang']['field_activate'] = 'Activer';
$phpMussel['lang']['field_clear_all'] = 'Annuler tout';
$phpMussel['lang']['field_component'] = 'Composant';
$phpMussel['lang']['field_create_new_account'] = 'Créer un nouveau compte';
$phpMussel['lang']['field_deactivate'] = 'Désactiver';
$phpMussel['lang']['field_delete_account'] = 'Supprimer le compte';
$phpMussel['lang']['field_delete_all'] = 'Supprimer tout';
$phpMussel['lang']['field_delete_file'] = 'Supprimer';
$phpMussel['lang']['field_download_file'] = 'Télécharger';
$phpMussel['lang']['field_edit_file'] = 'Modifier';
$phpMussel['lang']['field_false'] = 'False (Faux)';
$phpMussel['lang']['field_file'] = 'Fichier';
$phpMussel['lang']['field_filename'] = 'Nom de fichier : ';
$phpMussel['lang']['field_filetype_directory'] = 'Répertoire';
$phpMussel['lang']['field_filetype_info'] = '{EXT} Fichier';
$phpMussel['lang']['field_filetype_unknown'] = 'Inconnu';
$phpMussel['lang']['field_install'] = 'Installer';
$phpMussel['lang']['field_latest_version'] = 'Dernière Version';
$phpMussel['lang']['field_log_in'] = 'Connecter';
$phpMussel['lang']['field_more_fields'] = 'Plus de Champs';
$phpMussel['lang']['field_new_name'] = 'Nouveau nom :';
$phpMussel['lang']['field_ok'] = 'D\'accord';
$phpMussel['lang']['field_options'] = 'Options';
$phpMussel['lang']['field_password'] = 'Mot de Passe';
$phpMussel['lang']['field_permissions'] = 'Autorisations';
$phpMussel['lang']['field_quarantine_key'] = 'Clé de quarantaine';
$phpMussel['lang']['field_rename_file'] = 'Renommer';
$phpMussel['lang']['field_reset'] = 'Réinitialiser';
$phpMussel['lang']['field_restore_file'] = 'Restaurer';
$phpMussel['lang']['field_set_new_password'] = 'Définir nouveau mot de passe';
$phpMussel['lang']['field_size'] = 'Taille totale : ';
$phpMussel['lang']['field_size_bytes'] = ['octet', 'octets'];
$phpMussel['lang']['field_size_GB'] = 'Go';
$phpMussel['lang']['field_size_KB'] = 'Ko';
$phpMussel['lang']['field_size_MB'] = 'Mo';
$phpMussel['lang']['field_size_TB'] = 'To';
$phpMussel['lang']['field_status'] = 'Statut';
$phpMussel['lang']['field_system_timezone'] = 'Utilisez le fuseau horaire par défaut du système.';
$phpMussel['lang']['field_true'] = 'True (Vrai)';
$phpMussel['lang']['field_uninstall'] = 'Désinstaller';
$phpMussel['lang']['field_update'] = 'Mettre à jour';
$phpMussel['lang']['field_update_all'] = 'Tout mettre à jour';
$phpMussel['lang']['field_upload_file'] = 'Télécharger un nouveau fichier';
$phpMussel['lang']['field_username'] = 'Nom d\'Utilisateur';
$phpMussel['lang']['field_your_version'] = 'Votre Version';
$phpMussel['lang']['header_login'] = 'Merci de vous connecter pour continuer.';
$phpMussel['lang']['label_active_config_file'] = 'Fichier de configuration active : ';
$phpMussel['lang']['label_blocked'] = 'Téléchargements bloqués';
$phpMussel['lang']['label_branch'] = 'Dernier stable de branche :';
$phpMussel['lang']['label_events'] = 'événements d\'analyse';
$phpMussel['lang']['label_flagged'] = 'Objets marqués';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Données cache et fichiers temporaires';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'Utilisation du disque par phpMussel : ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Espace disque libre : ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Utilisation du disque totale : ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Espace disque total : ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Métadonnées pour la mise à jour des composants';
$phpMussel['lang']['label_hide'] = 'Cacher';
$phpMussel['lang']['label_os'] = 'Système opérateur utilisée :';
$phpMussel['lang']['label_other'] = 'Autres';
$phpMussel['lang']['label_other-Active'] = 'Fichiers de signatures actifs';
$phpMussel['lang']['label_other-Since'] = 'Date de début';
$phpMussel['lang']['label_php'] = 'Version PHP utilisée :';
$phpMussel['lang']['label_phpmussel'] = 'Version phpMussel utilisée :';
$phpMussel['lang']['label_quarantined'] = 'Téléchargements mis en quarantaine';
$phpMussel['lang']['label_sapi'] = 'SAPI utilisée :';
$phpMussel['lang']['label_scanned_objects'] = 'Objets analysés';
$phpMussel['lang']['label_scanned_uploads'] = 'Téléchargements analysés';
$phpMussel['lang']['label_show'] = 'Montrer';
$phpMussel['lang']['label_size_in_quarantine'] = 'Taille en quarantaine : ';
$phpMussel['lang']['label_stable'] = 'Dernier stable :';
$phpMussel['lang']['label_sysinfo'] = 'Informations sur le système :';
$phpMussel['lang']['label_tests'] = 'Tests :';
$phpMussel['lang']['label_unstable'] = 'Dernier instable :';
$phpMussel['lang']['label_upload_date'] = 'Date de téléchargement : ';
$phpMussel['lang']['label_upload_hash'] = 'Hash de téléchargement : ';
$phpMussel['lang']['label_upload_origin'] = 'Origine du téléchargement : ';
$phpMussel['lang']['label_upload_size'] = 'Taille du téléchargement : ';
$phpMussel['lang']['link_accounts'] = 'Comptes';
$phpMussel['lang']['link_config'] = 'Configuration';
$phpMussel['lang']['link_documentation'] = 'Documentation';
$phpMussel['lang']['link_file_manager'] = 'Gestionnaire de Fichiers';
$phpMussel['lang']['link_home'] = 'Page d\'Accueil';
$phpMussel['lang']['link_logs'] = 'Fichiers Journaux';
$phpMussel['lang']['link_quarantine'] = 'Quarantaine';
$phpMussel['lang']['link_statistics'] = 'Statistiques';
$phpMussel['lang']['link_textmode'] = 'Formatage du texte : <a href="%1$sfalse">Simple</a> – <a href="%1$strue">Formaté</a>';
$phpMussel['lang']['link_updates'] = 'Mises à Jour';
$phpMussel['lang']['link_upload_test'] = 'Test de Télécharger';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Le fichier journal sélectionné n\'existe pas !';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Aucun fichiers journaux disponibles.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Aucun fichier journal sélectionné.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Nombre maximal de tentatives de connexion excédée ; Accès refusé.';
$phpMussel['lang']['previewer_days'] = 'Journées';
$phpMussel['lang']['previewer_hours'] = 'Heures';
$phpMussel['lang']['previewer_minutes'] = 'Minutes';
$phpMussel['lang']['previewer_months'] = 'Mois';
$phpMussel['lang']['previewer_seconds'] = 'Secondes';
$phpMussel['lang']['previewer_weeks'] = 'Semaines';
$phpMussel['lang']['previewer_years'] = 'Années';
$phpMussel['lang']['response_accounts_already_exists'] = 'Un compte avec ce nom d\'utilisateur existe déjà !';
$phpMussel['lang']['response_accounts_created'] = 'Compte créé avec succès !';
$phpMussel['lang']['response_accounts_deleted'] = 'Compte supprimé avec succès !';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Ce compte n\'existe pas.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Mot de passe mis à jour avec succès !';
$phpMussel['lang']['response_activated'] = 'Activé avec succès.';
$phpMussel['lang']['response_activation_failed'] = 'Échec de l\'activation !';
$phpMussel['lang']['response_checksum_error'] = 'Erreur checksum ! Fichier rejeté !';
$phpMussel['lang']['response_component_successfully_installed'] = 'Composant installé avec succès.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Composant désinstallé avec succès.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Composant mise à jour avec succès.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Une erreur est survenue lors de la désinstallation du composant.';
$phpMussel['lang']['response_configuration_updated'] = 'Configuration mis à jour avec succès.';
$phpMussel['lang']['response_deactivated'] = 'Désactivé avec succès.';
$phpMussel['lang']['response_deactivation_failed'] = 'Échec de la désactivation !';
$phpMussel['lang']['response_delete_error'] = 'Échec du suppriment !';
$phpMussel['lang']['response_directory_deleted'] = 'Répertoire supprimé avec succès !';
$phpMussel['lang']['response_directory_renamed'] = 'Répertoire renommé avec succès !';
$phpMussel['lang']['response_error'] = 'Erreur';
$phpMussel['lang']['response_failed_to_install'] = 'Échec de l\'installation!';
$phpMussel['lang']['response_failed_to_update'] = 'Échec de la mise à jour!';
$phpMussel['lang']['response_file_deleted'] = 'Fichier supprimé avec succès !';
$phpMussel['lang']['response_file_edited'] = 'Fichier modifié avec succès !';
$phpMussel['lang']['response_file_renamed'] = 'Fichier renommé avec succès !';
$phpMussel['lang']['response_file_restored'] = 'Fichier restauré avec succès !';
$phpMussel['lang']['response_file_uploaded'] = 'Fichier téléchargé avec succès !';
$phpMussel['lang']['response_login_invalid_password'] = 'Erreur de connexion ! Mot de passe incorrect !';
$phpMussel['lang']['response_login_invalid_username'] = 'Erreur de connexion ! Nom d\'utilisateur n\'existe pas !';
$phpMussel['lang']['response_login_password_field_empty'] = 'Mot de passe entrée était vide !';
$phpMussel['lang']['response_login_username_field_empty'] = 'Nom d\'utilisateur entrée était vide !';
$phpMussel['lang']['response_rename_error'] = 'Échec du renomment !';
$phpMussel['lang']['response_restore_error_1'] = 'Échec de la restauration ! Fichier corrompu !';
$phpMussel['lang']['response_restore_error_2'] = 'Échec de la restauration ! Clé de quarantaine incorrecte !';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistiques annulées.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Déjà mise à jour.';
$phpMussel['lang']['response_updates_not_installed'] = 'Composant pas installé !';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Composant pas installé (il nécessite PHP {V}) !';
$phpMussel['lang']['response_updates_outdated'] = 'Dépassé !';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Dépassé (s\'il vous plaît mettre à jour manuellement) !';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Dépassé (il nécessite PHP {V}) !';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Incapable de déterminer.';
$phpMussel['lang']['response_upload_error'] = 'Échec du téléchargement !';
$phpMussel['lang']['state_complete_access'] = 'Accès complet';
$phpMussel['lang']['state_component_is_active'] = 'Le composant est actif.';
$phpMussel['lang']['state_component_is_inactive'] = 'Le composant est inactif.';
$phpMussel['lang']['state_component_is_provisional'] = 'Le composant est provisoire.';
$phpMussel['lang']['state_default_password'] = 'Attention : Utilisant le mot de passe défaut !';
$phpMussel['lang']['state_logged_in'] = 'Connecté.';
$phpMussel['lang']['state_logs_access_only'] = 'Accès aux fichiers journaux seulement';
$phpMussel['lang']['state_maintenance_mode'] = 'Avertissement : Le mode de maintenance est activé !';
$phpMussel['lang']['state_password_not_valid'] = 'Attention : Ce compte n\'utilise un mot de passe valide !';
$phpMussel['lang']['state_quarantine'] = ['Il y a %s fichier actuellement en quarantaine.', 'Il y a %s fichiers actuellement en quarantaine.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Ne masquer pas non dépassé';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Masquer non dépassé';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Ne masquer pas inutilisé';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Masquer inutilisé';
$phpMussel['lang']['tip_accounts'] = 'Bonjour, {username}.<br />La page des comptes vous permet de contrôler qui peut accéder l\'accès frontal de phpMussel.';
$phpMussel['lang']['tip_config'] = 'Bonjour, {username}.<br />La page de configuration vous permet de modifier la configuration pour phpMussel à l\'accès frontal.';
$phpMussel['lang']['tip_donate'] = 'phpMussel est offert gratuitement, mais si vous voulez faire un don au projet, vous pouvez le faire en cliquant sur le bouton don.';
$phpMussel['lang']['tip_file_manager'] = 'Bonjour, {username}.<br />Le gestionnaire de fichiers vous permet de supprimer, éditer et télécharger des fichiers. Utiliser avec précaution (vous pourriez casser votre installation avec ceci).';
$phpMussel['lang']['tip_home'] = 'Bonjour, {username}.<br />C\'est la page d\'accueil de l\'accès frontal de phpMussel. Sélectionnez un lien dans le menu de navigation à gauche pour continuer.';
$phpMussel['lang']['tip_login'] = 'Nom d\'utilisateur défaut : <span class="txtRd">admin</span> – Mot de passe défaut : <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Bonjour, {username}.<br />Sélectionnez un fichier journal dans la liste ci-dessous pour afficher le contenu de ce fichier journal.';
$phpMussel['lang']['tip_quarantine'] = 'Bonjour, {username}.<br />Cette page répertorie tous les fichiers actuellement en quarantaine et facilite la gestion de ces fichiers.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Remarque : La quarantaine est actuellement désactivée, mais peut être activée via la page de configuration.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Voir la <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.fr.md#SECTION7">documentation</a> pour information sur les différentes directives de la configuration et leurs objectifs.';
$phpMussel['lang']['tip_statistics'] = 'Bonjour, {username}.<br />Cette page présente certaines statistiques d\'utilisation concernant votre installation pour phpMussel.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Remarque : Le suivi des statistiques est actuellement désactivé, mais peut être activé via la page de configuration.';
$phpMussel['lang']['tip_updates'] = 'Bonjour, {username}.<br />La page des mises à jour vous permet d\'installer, de désinstaller et de mettre à jour les différentes composantes de phpMussel (le paquet de base, signatures, plugins, fichiers de L10N, etc).';
$phpMussel['lang']['tip_upload_test'] = 'Bonjour, {username}.<br />La page pour tester les téléchargements contient un formulaire pour le téléchargement de fichiers standard, vous permettant de tester si un fichier serait normalement être bloqué par phpMussel quand vous essayez de le télécharger.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Comptes';
$phpMussel['lang']['title_config'] = 'phpMussel – Configuration';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Gestionnaire de Fichiers';
$phpMussel['lang']['title_home'] = 'phpMussel – Page d\'Accueil';
$phpMussel['lang']['title_login'] = 'phpMussel – Connexion';
$phpMussel['lang']['title_logs'] = 'phpMussel – Fichiers Journaux';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Quarantaine';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistiques';
$phpMussel['lang']['title_updates'] = 'phpMussel – Mises à Jour';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Test de Télécharger';
$phpMussel['lang']['warning'] = 'Avertissements :';
$phpMussel['lang']['warning_php_1'] = 'Votre version PHP n\'est plus activement prise en charge ! La mise à jour est recommandée !';
$phpMussel['lang']['warning_php_2'] = 'Votre version PHP est sévèrement vulnérable ! La mise à jour est fortement recommandée !';
$phpMussel['lang']['warning_signatures_1'] = 'Il n\'y a pas fichiers du signatures actifs.';

$phpMussel['lang']['info_some_useful_links'] = 'Quelques liens utiles :<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">Les problèmes de phpMussel @ GitHub</a> – Page de problèmes pour phpMussel (soutien, assistance, etc).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Forum de discussion pour phpMussel (soutien, assistance, etc).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Alternative download mirror for phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Une collection de simples outils webmaster pour sécuriser les sites Web.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – Page d\'accueil de ClamAV (ClamAV® est un moteur antivirus open source pour détecter les trojans, les virus, les logiciels malveillants et autres menaces malveillantes).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Compagnie de sécurité informatique qui offre des signatures supplémentaires pour ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Base de données d\'hameçonnage utilisée par le scanner URL de phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – Ressources d\'apprentissage PHP et discussion.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – Ressources d\'apprentissage PHP et discussion.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal est un service gratuit pour analyser les fichiers et les URL qui sont suspects.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis est un service gratuit pour l\'analyse des logiciels malveillants fourni par <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Spécialistes en logiciels malveillants.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Forum de discussion sur les logiciels malveillants.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Cartes de Vulnérabilité</a> – Liste des versions sûres/dangereuses de divers paquets (PHP, HHVM, etc).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Cartes de Compatibilité</a> – Liste des informations de compatibilité pour divers packages (CIDRAM, phpMussel, etc).</li>
        </ul>';
