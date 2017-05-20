## Documentation pour phpMussel (Français).

### Contenu
- 1. [PRÉAMBULE](#SECTION1)
- 2. [COMMENT INSTALLER](#SECTION2)
- 3. [COMMENT UTILISER](#SECTION3)
- 4. [GESTION L'ACCÈS FRONTAL](#SECTION4)
- 5. [CLI (COMMANDE LIGNE INTERFACE)](#SECTION5)
- 6. [FICHIERS INCLUS DANS CETTE PAQUET](#SECTION6)
- 7. [OPTIONS DE CONFIGURATION](#SECTION7)
- 8. [FORMATS DE SIGNATURES](#SECTION8)
- 9. [PROBLÈMES DE COMPATIBILITÉ CONNUS](#SECTION9)
- 10. [QUESTIONS FRÉQUEMMENT POSÉES (FAQ)](#SECTION10)

*Note concernant les traductions: En cas d'erreurs (par exemple, différences entre les traductions, fautes de frappe, etc), la version Anglaise du README est considérée comme la version originale et faisant autorité. Si vous trouvez des erreurs, votre aide pour les corriger serait bienvenue.*

---


### 1. <a name="SECTION1"></a>PRÉAMBULE

Merci d'utiliser phpMussel, un script PHP pour la détection de virus, logiciels malveillants et autres menaces dans les fichiers téléchargés sur votre système partout où le script est accroché, basé sur les signatures de ClamAV et autres.

PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPLv2 par Caleb M (Maikuolan).

Ce script est un logiciel libre; vous pouvez redistribuer et/ou le modifier selon les termes de la GNU General Public License telle que publiée par la Free Software Foundation; soit la version 2 de la Licence, ou (à votre choix) toute version ultérieure. Ce script est distribué dans l'espoir qu'il sera utile, mais SANS AUCUNE GARANTIE, sans même la implicite garantie de COMMERCIALISATION ou D'ADAPTATION À UN PARTICULIER USAGE. Voir la GNU General Public License pour plus de détails, situé dans le `LICENSE.txt` fichier et disponible également à partir de:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Un spécial merci à ClamAV pour l'inspiration du le projet et pour les signatures que ce script utilise, sans qui, le script ne seraient probablement pas exister, ou, au mieux, auraient avoir un très limité valeur.

Un spécial merci à Sourceforge et GitHub pour l'hébergement du projet fichiers, à [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) pour l'hébergement du phpMussel discussion forums, et à les sources supplémentaires d'un certain nombre de signatures utilisés par phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) et autres, et merci à tous ceux qui soutiennent le projet, à quelqu'un d'autre que j'ai peut-être oublié de mentionner autrement, et à vous, pour l'utiliser du script.

Ce document et son associé paquet peuvent être téléchargé gratuitement à sans frais à partir de:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


### 2. <a name="SECTION2"></a>COMMENT INSTALLER

#### 2.0 INSTALLATION MANUELLE (POUR SERVEURS WEB)

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Maintenant, vous devez déterminer la approprié emplacement sur votre hôte ou CMS à mettre ces contenus. Un répertoire comme `/public_html/phpmussel/` ou similaire (cependant, il n'est pas question que vous choisissez, à condition que c'est quelque part de sûr et quelque part que vous êtes heureux avec) sera suffira. *Vous avant commencer téléchargement au serveur, continuer lecture..*

2) Renommer `config.ini.RenameMe` à `config.ini` (situé à l'intérieur de `vault`), et facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), l'ouvrir (ce fichier contient toutes les directives disponible pour phpMussel; au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour). Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, et fermer.

3) Télécharger les contenus (phpMussel et ses fichiers) à le répertoire vous aviez décidé plus tôt (vous n'avez pas besoin les `*.txt`/`*.md` fichiers, mais surtout, vous devriez télécharger tous les fichiers sur le serveur).

4) CHMOD la `vault` répertoire à "755" (s'il y a des problèmes, vous pouvez essayer "777", mais c'est moins sûr). Le principal répertoire qui est stocker le contenu (celui que vous avez choisi plus tôt), généralement, peut être laissé seul, mais CHMOD état devrait être vérifié si vous avez eu problèmes d'autorisations dans le passé sur votre système (par défaut, devrait être quelque chose comme "755").

5) Suivant, vous aurez besoin de l'attacher phpMussel à votre système ou CMS. Il est plusieurs façons vous pouvez attacher phpMussel à votre système ou CMS, mais le plus simple est à simplement inclure le script au début d'un fichier de la base de données de votre système ou CMS (un qui va généralement toujours être chargé lorsque quelqu'un accède à n'importe quelle page sur votre website) utilisant un `require` ou `include` déclaration. Généralement, ce sera quelque chose de stocké dans un répertoire comme `/includes`, `/assets` ou `/functions`, et il sera souvent nommé quelque chose comme `init.php`, `common_functions.php`, `functions.php` ou similaire. Vous sera besoin à déterminer qui est le fichier c'est pour votre situation; Si vous rencontrez des difficultés pour la détermination de ce par vous-même, à l'aide, visitez la page des problèmes/issues pour phpMussel à GitHub ou les forums de support pour phpMussel; Il est possible que ce soit moi ou un autre utilisateur peuvent avoir de l'expérience avec le CMS que vous utilisez (vous aurez besoin pour nous faire savoir ce qui CMS vous utilisez), et ainsi, peut être en mesure de fournir une assistance pour cette question. Pour ce faire [à utiliser `require` ou `include`], insérez la ligne de code suivante au début de ce le noyau fichier et remplacer la string contenue à l'intérieur des guillemets avec l'exacte adresse le fichier `loader.php` (l'adresse locale, pas l'adresse HTTP; il ressemblera l'adresse de `vault` mentionné précédemment).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Enregistrer le fichier, fermer, rétélécharger.

-- OU ALTERNATIVEMENT --

Si vous utilisez un Apache serveur web et si vous avez accès à `php.ini`, vous pouvez utiliser la `auto_prepend_file` directive à préfixer phpMussel chaque fois qu'une demande de PHP est faite. Quelque chose comme:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Ou cette dans le `.htaccess` fichier:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) À ce stade, vous avez fini! Cependant, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester les protections, essayez de télécharger les tester fichiers inclus dans le paquet sous `_testfiles` à votre website par votre habituelles navigateur basé méthodes de téléchargement. Si tout fonctionne correctement, un message devrait apparaître à partir de phpMussel confirmant que le téléchargement a été bloqué avec succès. Si rien ne s'affiche, quelque chose ne fonctionne pas correctement. Si vous utilisez d'avancées fonctions ou si vous utilisez l'autres types d'analyse possibles avec l'outil, je vous suggère de l'essayer avec ceux pour s'assurer qu'il fonctionne comme prévu, aussi.

#### 2.1 INSTALLATION MANUELLE (POUR CLI)

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Lorsque vous avez déterminé que vous êtes satisfait sur l'emplacement choisi pour phpMussel, continuer.

2) phpMussel exige PHP d'être installé sur l'ordinateur hôte afin d'exécuter. Si vous n'avez pas de PHP installé sur votre machine, s'il vous plaît, installer PHP sur votre machine, suivant les instructions fournies par le programme d'installation de PHP.

3) Facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), ouvrir `config.ini` (situé à l'intérieur de `vault`) - Ce fichier contient toutes les directives disponible pour phpMussel. Au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour. Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, fermer.

4) Facultativement, vous pouvez faire utilisant phpMussel en le mode CLI plus facile pour vous-même par la création d'un fichier de commandes pour automatique charger PHP et phpMussel. Pour ce faire, ouvrir un éditeur de texte comme Notepad ou Notepad++, taper le complet chemin vers le `php.exe` fichier dans le répertoire de votre installation de PHP, suivi d'un espace, suivi par le complet chemin vers le `loader.php` fichier dans le répertoire de votre installation de phpMussel, enregistrer le fichier avec un `.bat` suffixe quelque part que vous trouverez facile, et double-cliquer sur ce fichier pour exécuter phpMussel à l'avenir.

5) À ce stade, vous avez fini! Mais, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester phpMussel, exécuter phpMussel et essayer d'analyser le `_testfiles` répertoire fourni avec le paquet.

#### 2.2 INSTALLATION AVEC COMPOSER

[phpMussel est enregistré avec Packagist](https://packagist.org/packages/maikuolan/phpmussel), et donc, si vous êtes familier avec Composer, vous pouvez utiliser Composer pour installer phpMussel (vous devrez néanmoins préparer la configuration et les attaches; voir "installation manuelle (pour serveurs web)" les étapes 2 et 5).

`composer require maikuolan/phpmussel`

---


### 3. <a name="SECTION3"></a>COMMENT UTILISER

#### 3.0 COMMENT UTILISER (POUR SERVEURS WEB)

phpMussel devrait être capable de fonctionner correctement avec des exigences minimales de votre part: Après l'avoir installé, il devrait fonctionner immédiatement et être immédiatement utilisable.

L'analyses des téléchargements des fichiers est automatisée et activée par défaut, donc rien est nécessaire à partir de vous pour cette fonction particulière.

Cependant, vous êtes également capable d'instruire phpMussel à analyser spécifiques fichiers, répertoires et/ou archives. Pour ce faire, premièrement, vous devez assurer que la appropriée configuration est imposé dans le `config.ini` fichier (`cleanup` doit être désactivé), et lorsque vous avez terminé, dans un fichier PHP qui est attaché à phpMussel, utilisez la fonction suivante dans votre code:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` peut être une chaîne, un tableau, ou un tableau de tableaux, et indique quel fichier, fichiers, répertoire et/ou répertoires à analyser.
- `$output_type` est un booléen, indiquant le format dont les résultats d'analyse doivent être retournées sous. False/Faux instruit la fonction à retourner des résultats comme un entier (un retourné résultat de -3 indique des problèmes ont été rencontrés avec le phpMussel signatures fichiers ou des signatures cartes fichiers et qu'ils peuvent être possible manquants ou corrompus, -2 indique que données corrompues était détecté lors de l'analyse et donc l'analyse n'ont pas réussi à compléter, -1 indique que les extensions ou addons requis par PHP pour exécuter l'analyse sont manquaient et donc l'analyse n'ont pas réussi à compléter, 0 indique qu'il n'existe pas cible à analyser et donc il n'y avait rien à analyser, 1 indique que la cible était analysé avec succès et aucun problème n'été détectée, et 2 indique que la cible était analysé avec succès et problèmes ont été détectés). True/Vrai instruit la fonction à retourner des résultats sous forme de texte lisible par humain. De plus, dans tout le cas, les résultats peuvent être accessibles via les variables globales après l'analyse est terminée. Cette variable est optionnel, imposé par défaut comme false/faux.
- `$output_flatness` est un booléen, indiquant à la fonction soit à retourner les résultats de l'analyse (quand il ya plusieurs cibles d'analyse) comme un tableau ou une chaîne. False/Faux sera retour les résultats comme un tableau. True/Vrai sera retour les résultats comme une chaîne. Cette variable est optionnel, imposé par défaut comme false/faux.

Exemples:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Retours quelque chose comme ça (comme une string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Commencé.
 > Vérification '/user_name/public_html/my_file.html':
 -> Pas problème trouvé.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminé.
```

Pour un complet itinéraire de signatures que sera utilisé par phpMussel pour l'analyse et la façon dont il gère ces signatures, référer à la Signature Format section de ce fichier README.

Si vous rencontrez des faux positifs, si vous rencontrez quelque chose nouveau que vous pensez doit être bloqué, ou pour toute autre chose en ce qui concerne les signatures, s'il vous plaît, contactez moi à ce sujet afin que je puisse effectuer les nécessaires changements, dont, si vous ne contactez moi pas, j'ai peut n'être pas conscient.

Pour désactiver les signatures qui sont incluent avec phpMussel (comme si vous rencontrez un faux positif spécifique à vos besoins dont ne devrait normalement pas être retiré à partir de rationaliser), référer aux les notes de la liste grise dans la GESTION L'ACCÈS FRONTAL section de ce fichier README.

#### 3.1 COMMENT UTILISER (POUR CLI)

S'il vous plaît, référer à la "INSTALLATION MANUELLE (POUR CLI)" section de ce fichier README.

Soyez conscient que, bien que avenirs versions de phpMussel devraient soutenir d'autres systèmes, à ce moment, support pour le mode CLI de phpMussel est optimisé uniquement pour l'utilisation sur le Windows basée systèmes (vous pouvez, bien sûr, essayer sur d'autres systèmes, mais je ne peux pas garantir que ça va fonctionner comme prévu).

Aussi soyez conscient que phpMussel est un scanner *à la demande* (ou *on-demand*); Il n'est *PAS* un scanner *à l'accès* (ou *on-access*; autres que pour le téléchargement de fichiers, au moment du téléchargement), et contrairement anti-virus suites conventionnelles, ne surveille pas la mémoire active! Il seulement détecte les virus contenue par le téléchargement de fichiers, et dans les fichiers que vous explicitement spécifier pour d'analyse.

---


### 4. <a name="SECTION4"></a>GESTION L'ACCÈS FRONTAL

#### 4.0 CE QUI EST L'ACCÈS FRONTAL.

L'accès frontal fournit un moyen pratique et facile de gérer, de maintenir et de mettre à jour votre installation de phpMussel. Vous pouvez afficher, partager et télécharger des fichiers journaux via la page des journaux, vous pouvez modifier la configuration via la page de configuration, vous pouvez installer et désinstaller des composants via la page des mises à jour, et vous pouvez télécharger et modifier des fichiers dans votre vault via le gestionnaire de fichiers.

L'accès frontal est désactivée par défaut afin d'empêcher tout accès non autorisé (l'accès non autorisé pourrait avoir des conséquences importantes pour votre site web et sa sécurité). Les instructions pour l'activer sont incluses ci-dessous.

#### 4.1 COMMENT ACTIVER L'ACCÈS FRONTAL.

1) Localiser la directive `disable_frontend` à l'intérieur de `config.ini`, et réglez-le sur `false` (il sera `true` par défaut).

2) Accéder `loader.php` à partir de votre navigateur (par exemple, `http://localhost/phpmussel/loader.php`).

3) Connectez-vous avec le nom d'utilisateur et le mot de passe défaut (admin/password).

Remarque: Après vous être connecté pour la première fois, afin d'empêcher l'accès frontal non autorisé, vous devez immédiatement changer votre nom d'utilisateur et votre mot de passe! C'est très important, car il est possible de télécharger du code PHP arbitraire à votre site Web via l'accès frontal.

#### 4.2 COMMENT UTILISER L'ACCÈS FRONTAL.

Des instructions sont fournies sur chaque page de l'accès frontal, pour expliquer la manière correcte de l'utiliser et son but. Si vous avez besoin d'autres explications ou d'une assistance spéciale, veuillez contacter le support technique. Alternativement, il ya quelques vidéos disponibles sur YouTube qui pourraient aider par voie de démonstration.


---


### 5. <a name="SECTION5"></a>CLI (COMMANDE LIGNE INTERFACE)

phpMussel peut être exécuté comme un analyseur de fichiers interactif en mode CLI dans windows. Référer à la "COMMENT INSTALLER (POUR CLI)" section de ce fichier README pour plus détails.

Pour une liste des disponibles CLI commandes, à l'invite CLI, tapez «c», et appuyez sur Entrée.

En outre, pour les personnes intéressées, un didacticiel vidéo pour savoir comment utiliser phpMussel en le mode CLI est disponible ici:
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>FICHIERS INCLUS DANS CETTE PAQUET

Voici une liste de tous les fichiers inclus dans phpMussel dans son natif état, tous les fichiers qui peuvent être potentiellement créées à la suite de l'utilisation de ce script, avec une brève description de ce que tous ces fichiers sont pour.

Fichier | Description
----|----
/_docs/ | Documentation répertoire (contient divers fichiers).
/_docs/readme.ar.md | Documentation en Arabe.
/_docs/readme.de.md | Documentation en Allemande.
/_docs/readme.en.md | Documentation en Anglais.
/_docs/readme.es.md | Documentation en Espagnol.
/_docs/readme.fr.md | Documentation en Français.
/_docs/readme.id.md | Documentation en Indonésienne.
/_docs/readme.it.md | Documentation en Italienne.
/_docs/readme.ja.md | Documentation en Japonaise.
/_docs/readme.ko.md | Documentation en Coréenne.
/_docs/readme.nl.md | Documentation en Néerlandaise.
/_docs/readme.pt.md | Documentation en Portugaise.
/_docs/readme.ru.md | Documentation en Russe.
/_docs/readme.ur.md | Documentation en Urdu.
/_docs/readme.vi.md | Documentation en Vietnamienne.
/_docs/readme.zh-TW.md | Documentation en Chinois (traditionnel).
/_docs/readme.zh.md | Documentation en Chinois (simplifié).
/_testfiles/ | Test fichiers répertoire (contient divers fichiers). Tous les fichiers contenus sont des fichiers à test si phpMussel a été correctement installé sur votre système, et vous n'avez pas besoin de télécharger ce répertoire ou l'un de ses fichiers, sauf si faire ces tests.
/_testfiles/ascii_standard_testfile.txt | Fichier pour tester phpMussel normalisé ASCII signatures.
/_testfiles/coex_testfile.rtf | Fichier pour tester phpMussel signatures complexes étendues.
/_testfiles/exe_standard_testfile.exe | Fichier pour tester phpMussel PE signatures.
/_testfiles/general_standard_testfile.txt | Fichier pour tester phpMussel générales signatures.
/_testfiles/graphics_standard_testfile.gif | Fichier pour tester phpMussel graphiques signatures.
/_testfiles/html_standard_testfile.html | Fichier pour tester phpMussel normalisé HTML signatures.
/_testfiles/md5_testfile.txt | Fichier pour tester phpMussel MD5 signatures.
/_testfiles/ole_testfile.ole | Fichier pour tester phpMussel OLE signatures.
/_testfiles/pdf_standard_testfile.pdf | Fichier pour tester phpMussel PDF signatures.
/_testfiles/pe_sectional_testfile.exe | Fichier pour tester phpMussel PE Sectional signatures.
/_testfiles/swf_standard_testfile.swf | Fichier pour tester phpMussel SWF signatures.
/vault/ | Voûte répertoire (contient divers fichiers).
/vault/cache/ | Cache répertoire (pour les données temporaires).
/vault/cache/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/fe_assets/ | Les fichiers de l'accès frontal.
/vault/fe_assets/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/fe_assets/_accounts.html | Un modèle HTML pour la page des comptes de l'accès frontal.
/vault/fe_assets/_accounts_row.html | Un modèle HTML pour la page des comptes de l'accès frontal.
/vault/fe_assets/_config.html | Un modèle HTML pour la page de configuration de l'accès frontal.
/vault/fe_assets/_config_row.html | Un modèle HTML pour la page de configuration de l'accès frontal.
/vault/fe_assets/_files.html | Un modèle HTML pour le gestionnaire de fichiers.
/vault/fe_assets/_files_edit.html | Un modèle HTML pour le gestionnaire de fichiers.
/vault/fe_assets/_files_rename.html | Un modèle HTML pour le gestionnaire de fichiers.
/vault/fe_assets/_files_row.html | Un modèle HTML pour le gestionnaire de fichiers.
/vault/fe_assets/_home.html | Un modèle HTML pour la page d'accueil de l'accès frontal.
/vault/fe_assets/_login.html | Un modèle HTML pour la page pour la connexion de l'accès frontal.
/vault/fe_assets/_logs.html | Un modèle HTML pour la page pour les fichiers journaux de l'accès frontal.
/vault/fe_assets/_nav_complete_access.html | Un modèle HTML pour les liens de navigation de l'accès frontal, pour ceux qui ont accès complet.
/vault/fe_assets/_nav_logs_access_only.html | Un modèle HTML pour les liens de navigation de l'accès frontal, pour ceux qui ont accès aux fichiers journaux seulement.
/vault/fe_assets/_updates.html | Un modèle HTML pour la page des mises à jour de l'accès frontal.
/vault/fe_assets/_updates_row.html | Un modèle HTML pour la page des mises à jour de l'accès frontal.
/vault/fe_assets/_upload_test.html | Un modèle HTML pour les tests de téléchargement.
/vault/fe_assets/frontend.css | Feuille de style CSS pour l'accès frontal.
/vault/fe_assets/frontend.dat | Base de données pour l'accès frontal (contient des informations sur les comptes et les sessions; généré seulement si l'accès frontal est activé et utilisé).
/vault/fe_assets/frontend.html | Le fichier modèle HTML principal pour l'accès frontal.
/vault/fe_assets/icons.php | Gestionnaire d'icônes (utilisé par le gestionnaire de fichiers de l'accès frontal).
/vault/fe_assets/pips.php | Gestionnaire de pips (utilisé par le gestionnaire de fichiers de l'accès frontal).
/vault/lang/ | Contient données linguistiques.
/vault/lang/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/lang/lang.ar.fe.php | Données linguistiques en Arabe pour l'accès frontal.
/vault/lang/lang.ar.php | Données linguistiques en Arabe.
/vault/lang/lang.de.fe.php | Données linguistiques en Allemande pour l'accès frontal.
/vault/lang/lang.de.php | Données linguistiques en Allemande.
/vault/lang/lang.en.fe.php | Données linguistiques en Anglais pour l'accès frontal.
/vault/lang/lang.en.php | Données linguistiques en Anglais.
/vault/lang/lang.es.fe.php | Données linguistiques en Espagnol pour l'accès frontal.
/vault/lang/lang.es.php | Données linguistiques en Espagnol.
/vault/lang/lang.fr.fe.php | Données linguistiques en Français pour l'accès frontal.
/vault/lang/lang.fr.php | Données linguistiques en Français.
/vault/lang/lang.id.fe.php | Données linguistiques en Indonésienne pour l'accès frontal.
/vault/lang/lang.id.php | Données linguistiques en Indonésienne.
/vault/lang/lang.it.fe.php | Données linguistiques en Italienne pour l'accès frontal.
/vault/lang/lang.it.php | Données linguistiques en Italienne.
/vault/lang/lang.ja.fe.php | Données linguistiques en Japonaise pour l'accès frontal.
/vault/lang/lang.ja.php | Données linguistiques en Japonaise.
/vault/lang/lang.ko.fe.php | Données linguistiques en Coréenne pour l'accès frontal.
/vault/lang/lang.ko.php | Données linguistiques en Coréenne.
/vault/lang/lang.nl.fe.php | Données linguistiques en Néerlandaise pour l'accès frontal.
/vault/lang/lang.nl.php | Données linguistiques en Néerlandaise.
/vault/lang/lang.pt.fe.php | Données linguistiques en Portugaise pour l'accès frontal.
/vault/lang/lang.pt.php | Données linguistiques en Portugaise.
/vault/lang/lang.ru.fe.php | Données linguistiques en Russe pour l'accès frontal.
/vault/lang/lang.ru.php | Données linguistiques en Russe.
/vault/lang/lang.th.fe.php | Données linguistiques en Thai pour l'accès frontal.
/vault/lang/lang.th.php | Données linguistiques en Thai.
/vault/lang/lang.ur.fe.php | Données linguistiques en Urdu pour l'accès frontal.
/vault/lang/lang.ur.php | Données linguistiques en Urdu.
/vault/lang/lang.vi.fe.php | Données linguistiques en Vietnamienne pour l'accès frontal.
/vault/lang/lang.vi.php | Données linguistiques en Vietnamienne.
/vault/lang/lang.zh-tw.fe.php | Données linguistiques en Chinois (traditionnel) pour l'accès frontal.
/vault/lang/lang.zh-tw.php | Données linguistiques en Chinois (traditionnel).
/vault/lang/lang.zh.fe.php | Données linguistiques en Chinois (simplifié) pour l'accès frontal.
/vault/lang/lang.zh.php | Données linguistiques en Chinois (simplifié).
/vault/quarantine/ | Quarantaine répertoire (contient des fichiers de la quarantaine).
/vault/quarantine/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/signatures/ | Signatures répertoire (contient des fichiers de signatures).
/vault/signatures/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/signatures/switch.dat | Contrôle et définit certaines variables.
/vault/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/cli.php | Module de CLI.
/vault/components.dat | Contient des informations relatives aux divers composants de phpMussel; Utilisé par la page des mises à jour fournies par de l'accès frontal.
/vault/config.ini.RenameMe | Fichier de configuration; Contient toutes les options de configuration pour phpMussel, pour comment fonctionner correctement (renommer pour activer).
/vault/config.php | Module de configuration.
/vault/config.yaml | Fichier pour les valeurs par défaut de la configuration; Contient les valeurs par défaut de la configuration pour phpMussel.
/vault/frontend.php | Module de l'accès frontal.
/vault/functions.php | Fichier de fonctions (essentiel).
/vault/greylist.csv | CSV de grise listé signatures indiquant pour phpMussel qui signatures il faut ignorer (fichier recréé automatiquement si supprimé).
/vault/lang.php | Module de linguistiques.
/vault/php5.4.x.php | Polyfills pour PHP 5.4.X (Requis pour la compatibilité descendante de PHP 5.4.X; safe à supprimer pour les versions plus récentes de PHP).
※ /vault/scan_kills.txt | Les résultats de chaque fichier téléchargement bloqué/tués par phpMussel.
※ /vault/scan_log.txt | Un enregistrement de tout analysé par phpMussel.
※ /vault/scan_log_serialized.txt | Un enregistrement de tout analysé par phpMussel.
/vault/template_custom.html | Modèle fichier; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/template_default.html | Modèle fichier; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/themes.dat | Fichier des thèmes; Utilisé par la page des mises à jour fournies par de l'accès frontal.
/vault/upload.php | Module de téléchargements.
/.gitattributes | Un fichier du GitHub projet (pas nécessaire pour le bon fonctionnement du script).
/Changelog-v1.txt | Un enregistrement des modifications apportées au script entre les différentes versions (pas nécessaire pour le bon fonctionnement du script).
/composer.json | Composer/Packagist information (pas nécessaire pour le bon fonctionnement du script).
/CONTRIBUTING.md | Informations sur la façon de contribuer au projet.
/LICENSE.txt | Une copie de la GNU/GPLv2 license (pas nécessaire pour le bon fonctionnement du script).
/loader.php | Le chargeur. C'est ce que vous êtes censé être attacher dans à (essentiel)!
/PEOPLE.md | Informations sur les personnes impliquées dans le projet.
/README.md | Sommaire de l'information du projet.
/web.config | Un ASP.NET fichier de configuration (dans ce cas, pour protéger de la `/vault` répertoire contre d'être consulté par des non autorisée sources dans le cas où le script est installé sur un serveur basé sur les ASP.NET technologies).

※ Noms du fichiers peut varier basé sur configuration stipulations (dans `config.ini`).

---


### 7. <a name="SECTION7"></a>OPTIONS DE CONFIGURATION
Ce qui suit est une liste des directives disponibles pour phpMussel dans le `config.ini` fichier de configuration, avec une description de leur objectif et leur fonction.

#### "general" (Catégorie)
Configuration générale pour phpMussel.

"cleanup"
- Déensemble variables du script et cache après l'exécution? False = Non; True = Oui [Défaut]. Si vous ne utilisez pas le script au-delà l'initiale analyse du téléchargements, devrait ensemble à `true` (oui) à minimiser l'utilisation de la mémoire. Si vous utilisez le script à des fins au-delà l'initiale analyse du téléchargements, devrait ensemble à `false` (non), pour éviter recharger inutilement dupliqué données dans la mémoire. Dans la pratique générale, il devrait probablement être ensemblé à `true`, mais, si vous faites cela, vous ne serez pas être capable d'utiliser le script pour tout chose autre que l'analyse des fichiers téléchargements.
- N'a pas d'influence en le mode CLI.

"scan_log"
- Nom du fichier à enregistrer tous les résultats de l'analyse. Spécifiez un nom de fichier, ou laisser vide à désactiver.

"scan_log_serialized"
- Nom du fichier à enregistrer tous les résultats de l'analyse (le format est sérialisé). Spécifiez un nom de fichier, ou laisser vide à désactiver.

"scan_kills"
- Nom du fichier à enregistrer tous les résultats de bloqué ou tué téléchargements. Spécifiez un nom de fichier, ou laisser vide à désactiver.

*Conseil utile: Si vous souhaitez, vous pouvez ajouter l'information pour la date/l'heure à les noms de vos fichiers pour enregistrement par des incluant ceux-ci au nom: `{yyyy}` pour l'année complète, `{yy}` pour l'année abrégée, `{mm}` pour mois, `{dd}` pour le jour, `{hh}` pour l'heure.*

*Exemples:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Tronquer les fichiers journaux lorsqu'ils atteignent une certaine taille? La valeur est la taille maximale en o/Ko/Mo/Go/To qu'un fichier journal peut croître avant d'être tronqué. La valeur par défaut de 0Ko désactive la troncature (les fichiers journaux peuvent croître indéfiniment). Remarque: S'applique aux fichiers journaux individuels! La taille des fichiers journaux n'est pas considérée collectivement.

"timeOffset"
- Si votre temps serveur ne correspond pas à votre temps locale, vous pouvez spécifier un offset ici pour régler l'information en date/temps généré par phpMussel selon vos besoins. Il est généralement recommandé à la place pour ajuster la directive de fuseau horaire dans votre fichier `php.ini`, mais parfois (tels que lorsque l'on travaille avec des fournisseurs d'hébergement partagé limitées) ce n'est pas toujours possible de faire, et donc, cette option est disponible ici. Offset est en minutes.
- Exemple (à ajouter une heure): `timeOffset=60`

"timeFormat"
- Le format de notation de la date/heure utilisé par phpMussel. Défaut = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Où trouver l'adresse IP de demandes de connexion? (Utile pour services tels que Cloudflare et similaires) Par Défaut = REMOTE_ADDR. AVERTISSEMENT: Ne pas changer si vous ne sais pas ce que vous faites!

"enable_plugins"
- Permettre le support pour les plugins du phpMussel? False = Non [Défaut]; True = Oui.

"forbid_on_block"
- Devrait phpMussel envoyer 403 headers avec le fichier téléchargement bloqué message, ou rester avec l'habitude 200 bien (200 OK)? False = Non (200); True = Oui (403) [Défaut].

"delete_on_sight"
- Mise en cette option sera instruire le script à tenter immédiatement supprimer tout fichiers elle constate au cours de son analyse correspondant à des critères de détection, que ce soit via des signatures ou autrement. Fichiers jugées "propre" ne seront pas touchés. Dans le cas des archives, l'ensemble d'archive sera supprimé (indépendamment de si le incriminé fichier est que l'un de plusieurs fichiers contenus dans l'archive). Pour le cas d'analyse de fichiers téléchargement, généralement, il n'est pas nécessaire d'activer cette option sur, parce généralement, PHP faire purger automatiquement les contenus de son cache lorsque l'exécution est terminée, ce qui signifie que il va généralement supprimer tous les fichiers téléchargés à travers elle au serveur sauf qu'ils ont déménagé, copié ou supprimé déjà. L'option est ajoutée ici comme une supplémentaire mesure de sécurité pour ceux dont copies de PHP peut pas toujours se comporter de la manière attendu. False = Après l'analyse, laissez le fichier tel quel [Défaut]; True = Après l'analyse, si pas propre, supprimer immédiatement.

"lang"
- Spécifiez la langue défaut pour phpMussel.

"quarantine_key"
- phpMussel est capable de mettre en quarantaine le marqué fichier téléchargement tentatives en isolement au sein de la voûte de phpMussel, si cela est quelque chose que vous voulez qu'il fasse. L'utilisateurs de phpMussel qui souhaitent simplement de protéger leurs sites ou environnement d'hébergement sans avoir un profondément intérêt dans d'analyse de quelconque marqué fichier téléchargement tentatives devrait laisser cette fonctionnalité désactivée, mais tous les utilisateurs intéressés dans d'analyse plus approfondie de tenté fichier téléchargements pour la recherche des logiciels malveillants ou pour des choses semblables devraient permettre cette fonctionnalité. La quarantaine de marqué fichier téléchargement tentatives peut parfois aider également dans le débogage des faux positifs, si cela est quelque chose qui se produit fréquemment pour vous. Pour désactiver la fonctionnalité de quarantaine, il suffit de laisser la directive `quarantine_key` vide, ou effacer le contenu de cette directive si elle est pas déjà vide. Pour activer la fonctionnalité de quarantaine, entrer une valeur dans la directive. Le `quarantine_key` est une élément important de la sécurité de la fonctionnalité de quarantaine requis en tant que moyen de prévention de la fonctionnalité de quarantaine d'être exploités par des attaquants potentiels en tant que moyen de prévention toute potentielle exécution de données stockées dans la quarantaine. Le `quarantine_key` devrait être traité de la même manière que vos mots de passe: Le plus sera le mieux, et conservez-le bien. Pour un meilleur effet, utiliser en conjonction avec `delete_on_sight`.

"quarantine_max_filesize"
- La maximum taille autorisée de fichiers mis en quarantaine. Fichiers au-dessus de cette valeur ne sera pas placé en quarantaine. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. Défaut = 2Mo.

"quarantine_max_usage"
- La maximale utilisation autorisée de la mémoire pour la quarantaine. Si la totale d'utilisée mémoire par la quarantaine atteint cette valeur, les anciens fichiers en quarantaine seront supprimés jusqu'à ce que la totale mémoire utilisée n'atteint pas cette valeur. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. Défaut = 64Mo.

"honeypot_mode"
- Quand le honeypot mode est activé, phpMussel va tenter de mettre en quarantaine tous les fichier téléchargements ce qu'il rencontre, indépendamment de si oui ou non le fichier en cours de téléchargement correspond à signature inclus, et aucune réelle analyse de ces fichier téléchargements tentatives va arriver. Cette fonctionnalité devrait être utile pour ceux qui souhaitent utiliser phpMussel pour des fins de logiciels malveillants ou virus recherche, mais il pas n'est recommandé d'activer cette fonctionnalité si l'utilisation prévue de phpMussel par l'utilisateur est l'analyse de fichier téléchargements comme la norme, ni est-il recommandé d'utiliser la honeypot fonctionnalité pour fins autres que de honeypotting. Par défaut, cette option est désactivée. False = Désactivé [Défaut]; True = Activé.

"scan_cache_expiry"
- Pour combien de temps devrait phpMussel cache les résultats de l'analyse? La valeur est le nombre de secondes pour mettre en cache les résultats de l'analyse pour. Par défaut est 21600 secondes (6 heures); Une valeur de 0 désactive mettre en cache les résultats de l'analyse.

"disable_cli"
- Désactiver le mode CLI? Le mode CLI est activé par défaut, mais peut parfois interférer avec certains test outils (comme PHPUnit, par exemple) et d'autres applications basées sur CLI. Si vous n'avez pas besoin désactiver le mode CLI, vous devrait ignorer cette directive. False = Activer le mode CLI [Défaut]; True = Désactiver le mode CLI.

"disable_frontend"
- Désactiver l'accès frontal? L'accès frontal peut rendre phpMussel plus facile à gérer, mais peut aussi être un risque potentiel pour la sécurité. Il est recommandé de gérer phpMussel via le back-end chaque fois que possible, mais l'accès frontal est prévu pour quand il est impossible. Seulement activer si vous avez besoin. False = Activer l'accès frontal; True = Désactiver l'accès frontal [Défaut].

"max_login_attempts"
- Nombre maximal de tentatives de connexion (l'accès frontal). Défaut = 5.

"FrontEndLog"
- Fichier pour l'enregistrement des tentatives de connexion à l'accès frontal. Spécifier un fichier, ou laisser vide à désactiver.

"disable_webfonts"
- Désactiver les webfonts? True = Oui; False = Non [Défaut].

#### "signatures" (Catégorie)
Configuration pour les signatures.

"Active"
- Une liste des fichiers de signatures active, délimitée par des virgules.

"fail_silently"
- Devrait phpMussel signaler quand les fichiers du signatures sont manquants ou endommagés? Si `fail_silently` est désactivé, fichiers manquants et corrompus seront signalé sur analyse, et si `fail_silently` est activé, fichiers manquants et corrompus seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. Cela devrait généralement être laissé seul sauf si vous rencontrez accidents ou similaires problèmes. False = Désactivé; True = Activé [Défaut].

"fail_extensions_silently"
- Devrait phpMussel signaler quand les extensions sont manquantes? Si `fail_extensions_silently` est désactivé, extensions manquantes seront signalé sur analyse, et si `fail_extensions_silently` est activé, extensions manquantes seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. La désactivation de cette directive peut potentiellement augmenter votre sécurité, mais peut aussi conduire à une augmentation de faux positifs. False = Désactivé; True = Activé [Défaut].

"detect_adware"
- Devrait phpMussel utiliser signatures pour détecter les adwares? False = Non; True = Oui [Défaut].

"detect_joke_hoax"
- Devrait phpMussel utiliser signatures pour détecter les blagues/canulars malware/virus? False = Non; True = Oui [Défaut].

"detect_pua_pup"
- Devrait phpMussel utiliser signatures pour détecter les PUAs/PUPs? False = Non; True = Oui [Défaut].

"detect_packer_packed"
- Devrait phpMussel utiliser signatures pour détecter les emballeurs et des données emballés? False = Non; True = Oui [Défaut].

"detect_shell"
- Devrait phpMussel utiliser signatures pour détecter les shell scripts? False = Non; True = Oui [Défaut].

"detect_deface"
- Devrait phpMussel utiliser signatures pour détecter les defacements and defacers? False = Non; True = Oui [Défaut].

#### "files" (Catégorie)
Configuration générale pour les gestion des fichiers.

"max_uploads"
- Maximum admissible nombre de fichiers pour analyse lorsque l'analyse de fichier téléchargements avant d'abandonner l'analyse et informer l'utilisateur qu'ils sont téléchargement trop à la fois! Fournit protection contre une théorique attaque par lequel un attaquant tente à DDoS votre système ou CMS par surchargeant phpMussel à ralentir le processus de PHP à une halte. Recommandé: 10. Vous pouvez désirer d'augmenter ou diminuer ce nombre dépendamment de la vitesse de votre hardware. Notez que ce nombre ne tient pas compte pour ou inclure le contenus des archives.

"filesize_limit"
- Limite de taille des fichiers en Ko. 65536 = 64Mo [Défaut]; 0 = Pas limite (toujours en liste grise), tout (positif) valeur numérique acceptée. Cela peut être utile lorsque votre configuration de PHP limite la quantité de mémoire qu'un processus peut contenir ou si votre configuration de PHP limite la taille du fichier téléchargements.

"filesize_response"
- Que faire avec des fichiers qui dépassent la limite de taille des fichiers (si existant). False = Énumérer Blanche; True = Énumérer Noire [Défaut].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Si votre système permettre seulement particuliers types des fichiers à être téléchargé, ou si votre système nie explicitement particuliers types des fichiers, spécifiant les types des fichiers dans listes blanches, listes noires et listes gris peut augmenter la vitesse à laquelle l'analyse est effectuée en permettant le script à sauter particuliers types des fichiers. Format est CSV (virgule séparées valeurs). Si vous souhaitez analyse tout, plutôt que de liste blanche, liste noire ou liste gris, laisser les variable(/s) blanc; Il va désactiver liste blanche/noire/gris.
- L'ordre logique de l'application est:
  - Si le type de fichier est listé blanche, n'analyser pas ni bloquer pas le fichier, et ne vérifie pas le fichier contre la liste noire ou la liste grise.
  - Si le type de fichier est listé noire, n'analyser pas le fichier mais bloquer de toute façon, et ne vérifie pas le fichier contre la liste grise.
  - Si la liste grise est vide ou si la liste grise n'est vide pas et le type de fichier est listé grise, analyser le fichier comme d'habitude et déterminer si de bloquer basés des résultats de l'analyse, mais si la liste grise n'est vide pas et le type de fichier n'est listé grise pas, traiter le fichier comme listé noire, donc n'analyse pas mais bloque de toute façon.

"check_archives"
- Essayer vérifier les contenus des archives? False = Non (ne pas vérifier); True = Oui (vérifier) [Défaut].
- En ce moment, les seuls formats d'archives et de compression supporté sont BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR et ZIP (les formats d'archives et de compression RAR, CAB, 7z et etc ne sont pas supporté en ce moment).
- Ce n'est pas à toute épreuve! Bien que je recommande fortement d'avoir ce reste activée, je ne peux pas garantir il va toujours trouver tout.
- Aussi être conscient que l'examen d'archives actuellement n'est pas récursif pour PHARs ou ZIPs formats.

"filesize_archives"
- Étendre taille du fichier liste noire/blanche paramètres à le contenu des archives? False = Non (énumérer grise tout); True = Oui [Défaut].

"filetype_archives"
- Étendre type de fichier liste noire/blanche paramètres à le contenu des archives? False = Non (énumérer grise tout); True = Oui [Défaut].

"max_recursion"
- Maximum récursivité profondeur limite pour archives. Défaut = 10.

"block_encrypted_archives"
- Détecter et bloquer les archives cryptées? Parce phpMussel est pas capable d'analyse du contenu des archives cryptées, il est possible que le cryptage des archives peut être utilisé par un attaquant un moyen a tenter de contourner phpMussel, analyseurs anti-virus et d'autres protections. Instruire phpMussel pour bloquer toutes les archives cryptées qu'il découvre pourrait aider à réduire les risques associés à ces possibilités. False = Non; True = Oui [Défaut].

#### "attack_specific" (Catégorie)
Configuration pour les détections d'attaque spécifiques.

Détection des attaques de caméléon: False = Désactivé; True = Activé.

"chameleon_from_php"
- Vérifier pour les header PHP dans les fichiers qui ne sont pas de PHP ni reconnue comme archives.

"chameleon_from_exe"
- Vérifier pour les headers d'exécutables dans les fichiers qui ne sont pas fichiers exécutable ni reconnue comme archives et pour exécutables dont headers sont incorrects.

"chameleon_to_archive"
- Vérifier pour les archives dont headers sont incorrects (Supporté: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Vérifier pour les documents office dont headers sont incorrects (Supporté: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Vérifier pour les images dont headers sont incorrects (Supporté: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Vérifier pour les fichiers PDF dont headers sont incorrects.

"archive_file_extensions"
- Les extensions de fichiers d'archives reconnus (format est CSV; devraient ajouter ou supprimer seulement quand problèmes surviennent; supprimer inutilement peut entraîner des faux positifs à paraître pour archive fichiers, tandis que ajoutant inutilement sera essentiellement liste blanche ce que vous ajoutez à partir de l'attaque spécifique détection; modifier avec prudence; aussi noter que cela n'a aucun effet sur ce archives peut et ne peut pas être analysé au niveau du contenu). La liste, comme en cas de défaut, énumère les formats plus couramment utilisé dans la majorité des systèmes et CMS, mais volontairement pas nécessairement complète.

"block_control_characters"
- Bloquer tous les fichiers contenant les caractères de contrôle (autre que les sauts de ligne)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Si vous êtes _**SEULEMENT**_ télécharger de brut texte fichiers, puis vous pouvez activer cette option à fournir une supplémentaire protection à votre système. Mais, si vous télécharger quelque chose plus que brut texte, l'activation de cette peut créer faux positifs. False = Ne pas bloquer [Défaut]; True = Bloquer.

"corrupted_exe"
- Fichiers corrompus et erreurs d'analyse. False = Ignorer; True = Bloquer [Défaut]. Détecter et bloquer les fichiers PE (Portable Executable) potentiellement corrompus? Souvent (mais pas toujours), lorsque certains aspects d'un fichier PE sont corrompus ou ne peut pas être analysée correctement, il peut être le signe d'une infection virale. Les processus utilisés par la plupart des programmes anti-virus pour détecter les virus dans fichiers PE requérir l'analyse de ces fichiers par méthodes certaines, de ce que, si le programmeur d'un virus est conscient de, seront spécifiquement tenter d'empêcher, en vue de permettre leur virus n'être pas détectée.

"decode_threshold"
- Seuil à la longueur de brutes données dans laquelle commandes des décodages doivent être détectés (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). Défaut = 512Ko. Zéro ou nulle valeur désactive le seuil (supprimant toute restriction basé sur la taille du fichier).

"scannable_threshold"
- Seuil à la longueur de données brutes dans laquelle phpMussel est autorisé à lire et à analyser (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). Défaut = 32Mo. Zéro ou nulle valeur désactive le seuil. En général, cette valeur ne doit pas être moins que la moyenne tailles des fichiers des téléchargements que vous voulez et s'attendent à recevoir de votre serveur ou website, ne devrait pas être plus que la filesize_limit directive, et ne devrait pas être plus que d'un cinquième de l'allocation de totale mémoire autorisée à PHP via le `php.ini` fichier de configuration. Cette directive existe pour tenter d'empêcher phpMussel d'utiliser trop de mémoire (ce qui l'empêcherait d'être capable d'analyse fichiers dessus d'une certaine taille avec succès).

#### "compatibility" (Catégorie)
Directives de compatibilité pour phpMussel.

"ignore_upload_errors"
- Cette directive doit généralement être DÉSACTIVÉ sauf si cela est nécessaire pour la correcte fonctionnalité de phpMussel sur votre spécifique système. Normalement, lorsque DÉSACTIVÉ, lorsque phpMussel détecte la présence d'éléments dans le `$_FILES`() tableau, il va tenter de lancer une analyse du fichiers que ces éléments représentent, et, si ces éléments sont vide, phpMussel retourne un message d'erreur. Ce comportement est normal pour phpMussel. Mais, pour certains CMS, vides éléments dans `$_FILES` peuvent survenir à la suite du naturel comportement de ces CMS, ou erreurs peuvent être signalés quand il ne sont pas tout, dans ce cas, le normal comportement pour phpMussel seront interférer avec le normal comportement de ces CMS. Si telle une situation se produit pour vous, ACTIVATION de cette option sera instruire phpMussel ne pas à tenter de lancer d'analyses pour ces vides éléments, ignorer quand il est reconnu et ne pas à retourner tout de connexes messages d'erreur, permettant ainsi la continuation de la page demande. False = DÉSACTIVÉ; True = ACTIVÉ.

"only_allow_images"
- Si vous seulement attendre ou vouloir d'autoriser images à être téléchargé sur votre système ou CMS, et si vous absolument n'avez pas besoin tous les fichiers autres que les images à être téléchargé sur votre système ou CMS, cette directive devrait être ACTIVÉ, mais devrait autrement être DÉSACTIVÉ. Si cette directive est ACTIVÉ, il va instruire phpMussel à bloquer indistinctement tous téléchargements identifié comme non image fichiers, sans analyser. Cela peut réduire le temps de travail et l'utilisation de la mémoire pour les tentativé téléchargements de non image fichiers. False = DÉSACTIVÉ; True = ACTIVÉ.

#### "heuristic" (Catégorie)
Directives heuristiques pour phpMussel.

"threshold"
- Il ya certaines signatures des phpMussel qui sont destinés à identifier des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement sans en eux-mêmes identifier les fichiers en cours de téléchargement spécifiquement comme étant malveillants. Cette "threshold" (seuil) valeur raconte à phpMussel ce que le total maximum poids des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement pour ce qui est admissible avant que ces fichiers doivent être signalées comme malveillant. La définition du poids dans ce contexte est le nombre total de suspectes et potentiellement malveillants qualités identifié. Par défaut, cette valeur sera fixée à 3. Une valeur inférieur va résulter généralement avec une fréquence supérieur de faux positifs mais une nombre supérieur de fichiers signalé comme malveillant, tandis que une valeur inférieur va résulter généralement avec une fréquence inférieur de faux positifs mais un nombre inférieur de fichiers signalé comme malveillant. Il est généralement préférable de laisser cette valeur à sa valeur défaut, sauf si vous rencontrez des problèmes qui sont liés à elle.

#### "virustotal" (Catégorie)
Configuration pour Virus Total intégration.

"vt_public_api_key"
- Facultativement, phpMussel est capable d'analyser les fichiers en utilisant le Virus Total API comme un moyen de fournir un renforcée niveau de protection contre les virus, trojans, logiciels malveillants et autres menaces. Par défaut, l'analyse des fichiers en utilisant le Virus Total API est désactivé. Pour activer, une Total Virus API clé est nécessaire. En raison de le significative avantage que cela pourrait fournir pour vous, il est quelque chose que je recommande fortement pour l'activer. S'il vous plaît être conscient, cependant, que pour utiliser le Virus Total API, vous _**DEVEZ**_ accepter leurs conditions d'utilisation (Terms of Service) et vous _**DEVEZ**_ respecter toutes les directives selon décrit par le Virus Total documentation! Vous N'ÊTES PAS autorisé à utiliser cette fonctionnalité SAUF SI:
  - Vous avez lu et accepté les Conditions d'Utilisation (Terms of Service) de Total Virus et son API. Les Conditions d'Utilisation de Total Virus et son API peut être trouvé [Ici](https://www.virustotal.com/en/about/terms-of-service/).
  - Vous avez lu et vous comprendre, au minimum, le préambule du Virus Total Publique API documentation (tout ce qui suit "VirusTotal Public API v2.0" mais avant "Contents"). Le Virus Total Publique API documentation peut être trouvé [Ici](https://www.virustotal.com/en/documentation/public-api/).

Noter: Si l'analyse des fichiers en utilisant le Virus Total API est désactivé, vous ne serez pas besoin de revoir tout des directives dans cette catégorie (`virustotal`), parce qu'aucun d'eux ne fait rien si cette option est désactivée. Pour acquérir une Virus Total API clé, à partir de quelque part sur leur website, cliquez sur le "Rejoindre notre communauté" lien situé vers le haut à droite de la page, saisissez les informations demandées, et cliquez sur "S'enregistrer" quand vous avez terminé. Suivez toutes les instructions fournies, et quand vous avez votre publique API clé, copier/coller cette publique API clé à la `vt_public_api_key` directive du `config.ini` fichier de configuration.

"vt_suspicion_level"
- Par défaut, phpMussel va restreindre les fichiers de l'analyse utilisant le Virus Total API à ces fichiers qu'il juges comme "soupçonneux". Facultativement, vous pouvez régler cette restriction par changeant la valeur de la `vt_suspicion_level` directive.
- `0`: Fichiers sont seulement considérées comme soupçonneux si, quand étant analysé par phpMussel utilisant ses propres signatures, ils sont réputés pour porter un poids heuristique. Cela signifierait effectivement que l'utilisation du Virus Total API serait être pour une deuxième opinion pour quand phpMussel soupçonne qu'un fichier peut être potentiellement malveillants, mais ne peut pas entièrement exclu que il peut aussi potentiellement être bénigne (non malveillant) et donc serait autrement normalement pas bloquer ou signaler qu'il est malveillant.
- `1`: Fichiers sont considérés comme soupçonneux si, quand étant analysé par phpMussel utilisant ses propres signatures, ils sont réputés pour porter un poids heuristique, si elles sont connues pour être exécutable (PE fichiers, Mach-O fichiers, ELF/Linux fichiers, etc), ou s'ils sont connus pour être d'une forme qui pourrait contenir exécutable données (tels comme exécutable macros, DOC/DOCX fichiers, archive fichiers tels comme RARs, ZIPS et etc). C'est la valeur par défaut et le niveau de suspicion recommandé d'appliquer, qui signifie effectivement que l'utilisation du Virus Total API serait être pour une deuxième opinion pour quand initialement phpMussel ne peut pas trouver quoi que malveillant ou problématique avec un fichier qu'il considère comme soupçonneux et donc serait autrement normalement pas bloquer ou signaler qu'il est malveillant.
- `2`: Tous fichiers sont considérés comme soupçonneux et doivent être analysés utiliser le Virus Total API. Généralement, je ne recommande pas d'appliquer ce niveau de suspicion, en raison du risque d'atteindre votre API quota beaucoup plus rapide que ce serait autrement être le cas, mais il ya certaines circonstances (comme quand le webmaster ou hostmaster possède très peu foi ou confiance concernant le téléchargé contenu de leurs utilisateurs) où ce niveau de suspicion pourrait être approprié. Avec ce niveau de suspicion, tous fichiers que ne sont pas normalement bloquée ou signalés comme étant malveillants serait être analysé par le Virus Total API. Noter, cependant, que phpMussel sera cesser l'utiliser du Virus Total API quand votre API quota a été atteint (indépendamment du niveau de suspicion), et que votre quota sera probablement être atteint beaucoup plus rapidement quand vous utilisez ce niveau de suspicion.

Noter: Indépendamment du niveau de suspicion, tous les fichiers qui sont sur la liste noire ou liste blanche soit pour phpMussel ne seront pas analysés en utilisant le Virus API total, parce que ces fichiers seraient ont déjà été déclarés comme soit malveillant ou bénigne par phpMussel avant le moment où ils auraient autrement été analysés par le Virus Total API, et donc, analyser supplémentaire ne serait pas être nécessaire. La capacité de phpMussel pour analyser les fichiers en utilisant le Virus Total API est destiné à renforcer la confiance pour savoir si un fichier est malveillant ou bénigne dans les circonstances où phpMussel lui-même est pas tout à fait certain quant à savoir si un fichier est malveillant ou bénigne.

"vt_weighting"
- Devrais phpMussel appliquer les résultats de l'analyse en utilisant le Virus Total API comme détections ou comme pondération de détection? Cette directive existe, parce que, quoique analyse d'un fichier à l'aide de plusieurs moteurs (comme Virus Total fait) devrait résulter en un augmenté taux de détection (et donc en un plus grand nombre de fichiers malveillants être détectés), il peut également résulter en un plus grand nombre de faux positifs, et donc, dans certaines circonstances, les résultats de l'analyse peuvent être mieux utilisées comme un score de confiance plutôt que comme une conclusion définitive. Si la valeur 0 est utilisée, les résultats de l'analyse en utilisant le Virus Total API seront être appliquées comme détections, et donc, si quelconque moteur utilisé par Virus Total marques le fichier analysé comme étant malveillants, phpMussel va considérer le fichier comme malveillant. Si quelconque autre valeur est utilisée, les résultats de l'analyse en utilisant le Virus Total API sera appliquée comme pondération de détection, et donc, le nombre de moteurs utilisés par Total Virus que marque le fichier analysé comme étant malveillant sera servir un score de confiance (ou une pondération de détection) pour savoir si ou non le fichier êtant analysé devrait être considéré comme malveillant par phpMussel (la valeur utilisée représentera le minimum score de confiance ou le poids requis pour être considéré comme malveillant). Une valeur de 0 est utilisée par défaut.

"vt_quota_rate" et "vt_quota_time"
- Selon le Virus Total API documentation, elle est limitée à au plus 4 demandes de toute nature dans un laps de 1 minute de temps. Si vous exécutez un honeyclient, honeypot ou autre automatisation qui va fournir les ressources pour Virus Total et pas seulement récupérer des rapports vous avez droit à un plus élevée demande quota. Par défaut, phpMussel va adhérer strictement à ces limitations, mais en raison de la possibilité de ces quotas étant augmenté, ces deux directives sont fournies comme un moyen pour vous d'instruire phpMussel à quelle limite il faut adhérer. Sauf si vous avez été invité à le faire, on ne recommande pas pour vous d'augmenter ces valeurs, mais, si vous avez rencontré des problèmes relatifs à atteindre votre quota, diminuant ces valeurs _**PEUT**_ parfois vous aider dans le traitement de ces problèmes. Votre quota est déterminée comme `vt_quota_rate` demandes de toute nature dans un laps de `vt_quota_time` minute de temps.

#### "urlscanner" (Catégorie)
Un scanner d'URL est inclus avec phpMussel, capable de détecter les URLs malveillantes à partir de toutes les données ou fichiers analysés.

Noter: Si le scanner d'URLs est désactivé, vous ne serez pas besoin de revoir quelconque du directives dans cette catégorie (`urlscanner`), parce qu'aucun d'eux avoir une fonction si cette directive est désactivée.

Configuration du scanner d'URLs API chercher.

"lookup_hphosts"
- Permet cherches de l'API [hpHosts](http://hosts-file.net/) quand définit comme true. hpHosts ne nécessite pas une clé de l'API pour effectuer des cherches de l'API.

"google_api_key"
- Permet cherches de l'API Google Safe Browsing quand l'API clé nécessaire est définie. API Google Safe Browsing cherches nécessite une clé de l'API, qui peut être obtenu à partir [d'ici](https://console.developers.google.com/).
- Noter: L'extension cURL est nécessaire pour la utiliser de cette fonctionnalité.

"maximum_api_lookups"
- Nombre de cherches maximal de l'API pour effectuer par itération d'analyse individuelle. Parce que chaque API cherche supplémentaire va ajouter à la durée totale requise pour compléter chaque itération d'analyse, vous pouvez prévoir une limitation afin d'accélérer le processus d'analyse. Quand défini comme 0, pas de telles nombre maximum admissible sera appliquée. Défini comme 10 par défaut.

"maximum_api_lookups_response"
- Que faire si le nombre de cherches de l'API maximal est dépassée? False = Ne fais rien (poursuivre le traitement) [Défaut]; True = Marque/bloquer le fichier.

"cache_time"
- Combien de temps (en secondes) devrait les résultats du cherches de l'API être conservé dans le cache? Défaut est 3600 secondes (1 heure).

#### "template_data" (Catégorie)
Directives/Variables pour les modèles et thèmes.

Modèles données est liée à la sortie HTML utilisé pour générer le "Téléchargement Refusé" message affiché aux utilisateurs sur un fichier téléchargement est bloqué. Si vous utilisez des thèmes personnalisés pour phpMussel, sortie HTML provient du `template_custom.html` fichier, et sinon, sortie HTML provient du `template.html` fichier. Variables écrites à cette section du fichier de configuration sont préparé pour la sortie HTML par voie de remplacer tous les noms de variables circonfixé par accolades trouvés dans la sortie HTML avec les variables données correspondant. Par exemple, où `foo="bar"`, toute instance de `<p>{foo}</p>` trouvés dans la sortie HTML deviendra `<p>bar</p>`.

"theme"
- Le thème à utiliser par défaut pour phpMussel.

"css_url"
- Le modèle fichier pour des thèmes personnalisés utilise les propriétés CSS externes, tandis que le modèle fichier pour le défaut thème utilise les propriétés CSS internes. Pour instruire phpMussel d'utiliser le modèle fichier pour des thèmes personnalisés, spécifier l'adresse HTTP public de votre thèmes personnalisés CSS fichiers utilisant le `css_url` variable. Si vous laissez cette variable vide, phpMussel va utiliser le modèle fichier pour le défaut thème.

---


### 8. <a name="SECTION8"></a>FORMATS DE SIGNATURES

#### *SIGNATURES POUR LES NOMS DE FICHIERS*
Toutes les signatures pour les noms de fichiers suivez le format:

`NOM:FNRX`

Où NOM est le nom à citer pour la signature et FNRX est l'expression rationnelle pour faire correspondre les (non codé) noms de fichiers.

#### *MD5 SIGNATURES*
Toutes les signatures MD5 suivez le format:

`HASH:TAILLE:NOM`

Où HASH est le hachage MD5 d'un ensemble du fichier, TAILLE est la totale taille du fichier et NOM est le nom à citer pour la signature.

#### *SIGNATURES PE SECTIONAL*
Toutes les signatures PE Sectional suivez le format:

`TAILLE:HASH:NOM`

Où HASH est le hachage MD5 d'un section du PE fichier, TAILLE est la totale taille de cet section et NOM est le nom à citer pour la signature.

#### *SIGNATURES PE ÉTENDUES*
Toutes les signatures PE étendues suivez le format:

`$VAR:HASH:TAILLE:NOM`

Où $VAR est le nom de la PE variable à comparer contre, HASH est le MD5 hachage de cette variable, TAILLE est la taille totale de cette variable et NOM est le nom de à pour cette signature.

#### *BLANCHE LISTE SIGNATURES*
Toutes les signatures blanche liste suivez le format:

`HASH:TAILLE:TYPE`

Où HASH est le hachage MD5 d'un ensemble du fichier, TAILLE est la totale taille du fichier et TYPE est le type de signatures le listé blanche fichier est d'être immunitaire contre.

#### *SIGNATURES COMPLEXES ÉTENDUES*
Signatures complexes étendues sont assez différentes pour les autres types de signatures possible avec phpMussel, dans que ce qu'ils vérifient contre est spécifié par les signatures elles-mêmes et ils peuvent vérifier contre plusieurs critères. Les critères sont délimitées par ";" et le type et les données de chacun critères est délimitée par ":" comme ainsi le format de ces signatures tendances à semble un peu comme:

`$variable1:CERTAINSDONNÉES;$variable2:CERTAINSDONNÉES;SignatureNom`

#### *TOUT LE RESTE*
Toutes les autres signatures suivez le format:

`NOM:HEX:FROM:TO`

Où NOM est le nom à citer pour la signature et HEX est un hexadécimal codé segment du fichier destiné à être identifié par la signature donnée. FROM et TO sont optionnel paramètres, indication de laquelle et à laquelle les positions dans les source données pour vérifier contre.

#### *REGEX*
Toute forme de regex comprise et préparé correctement par PHP devrait aussi être correctement compris et préparé par phpMussel et ses signatures. Mais, je vous suggère de prendre une extrême prudence lors de l'écriture de nouvelles regex basé signatures, parce, si vous n'êtes pas entièrement sûr de ce que vous faites, il peut y avoir très irréguliers et/ou inattendus résultats. Jetez un oeil à la phpMussel source code si vous n'êtes pas entièrement sûr sur le contexte dans lequel regex déclarations sont analysés. Aussi, rappeler toutes les déclarations (à l'exception de nom de fichier, métadonnées d'archives et MD5 déclarations) doit être de codé de hexadécimale (à l'exception de déclaration syntaxe, bien sûr)!

---


### 9. <a name="SECTION9"></a>PROBLÈMES DE COMPATIBILITÉ CONNUS

#### PHP et PCRE
- phpMussel requérir PHP et PCRE à signer et à fonctionner correctement. Sans PHP, ou sans le PCRE extension de PHP, phpMussel n'exécutera pas ou fonctionnent correctement. Devrait s'assurer que votre système avoir PHP et PCRE installé et disponible avant de votre téléchargement et installation de phpMussel.

#### LOGICIELS ANTI-VIRUS COMPATIBILITÉ

Pour la plupart, phpMussel devrait être assez compatible avec plupart du virus détection logiciels. Cependant, conflictualités ont été signalés par un nombre d'utilisateurs dans le passé. Cette information ci-dessous est VirusTotal.com, et il décrit un certain nombre de faux positifs signalé par divers anti-virus programmes contre phpMussel. Bien que cette information ne constitue pas une absolue garantie de si oui ou non vous rencontrerez des problèmes de compatibilité entre phpMussel et votre anti-virus logiciel, si votre logiciel anti-virus est noté comme signalant contre phpMussel, vous devriez envisager désactivation avant à travailler avec phpMussel ou devrait envisager d'autres options soit votre logiciel anti-virus ou phpMussel.

Cette information a été mise à jour le 29 Août 2016 et est courant pour toutes les phpMussel parutions des deux plus récentes mineures versions (v0.10.0-v1.0.0) au moment de la rédaction de cette.

| Scanner              |  Résultats                           |
|----------------------|--------------------------------------|
| Ad-Aware             |  Pas problèmes connus                |
| AegisLab             |  Pas problèmes connus                |
| Agnitum              |  Pas problèmes connus                |
| AhnLab-V3            |  Pas problèmes connus                |
| Alibaba              |  Pas problèmes connus                |
| ALYac                |  Pas problèmes connus                |
| AntiVir              |  Pas problèmes connus                |
| Antiy-AVL            |  Pas problèmes connus                |
| Arcabit              |  Pas problèmes connus                |
| Avast                |  Rapports "JS:ScriptSH-inf [Trj]"    |
| AVG                  |  Pas problèmes connus                |
| Avira                |  Pas problèmes connus                |
| AVware               |  Pas problèmes connus                |
| Baidu                |  Rapports "VBS.Trojan.VBSWG.a"       |
| Baidu-International  |  Pas problèmes connus                |
| BitDefender          |  Pas problèmes connus                |
| Bkav                 |  Rapports "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell", "VEXEFFC.Webshell"|
| ByteHero             |  Pas problèmes connus                |
| CAT-QuickHeal        |  Pas problèmes connus                |
| ClamAV               |  Pas problèmes connus                |
| CMC                  |  Pas problèmes connus                |
| Commtouch            |  Pas problèmes connus                |
| Comodo               |  Pas problèmes connus                |
| Cyren                |  Pas problèmes connus                |
| DrWeb                |  Pas problèmes connus                |
| Emsisoft             |  Pas problèmes connus                |
| ESET-NOD32           |  Pas problèmes connus                |
| F-Prot               |  Pas problèmes connus                |
| F-Secure             |  Pas problèmes connus                |
| Fortinet             |  Pas problèmes connus                |
| GData                |  Pas problèmes connus                |
| Ikarus               |  Pas problèmes connus                |
| Jiangmin             |  Pas problèmes connus                |
| K7AntiVirus          |  Pas problèmes connus                |
| K7GW                 |  Pas problèmes connus                |
| Kaspersky            |  Pas problèmes connus                |
| Kingsoft             |  Pas problèmes connus                |
| Malwarebytes         |  Pas problèmes connus                |
| McAfee               |  Rapports "New Script.c"             |
| McAfee-GW-Edition    |  Rapports "New Script.c"             |
| Microsoft            |  Pas problèmes connus                |
| MicroWorld-eScan     |  Pas problèmes connus                |
| NANO-Antivirus       |  Pas problèmes connus                |
| Norman               |  Pas problèmes connus                |
| nProtect             |  Pas problèmes connus                |
| Panda                |  Pas problèmes connus                |
| Qihoo-360            |  Pas problèmes connus                |
| Rising               |  Pas problèmes connus                |
| Sophos               |  Pas problèmes connus                |
| SUPERAntiSpyware     |  Pas problèmes connus                |
| Symantec             |  Pas problèmes connus                |
| Tencent              |  Pas problèmes connus                |
| TheHacker            |  Pas problèmes connus                |
| TotalDefense         |  Pas problèmes connus                |
| TrendMicro           |  Pas problèmes connus                |
| TrendMicro-HouseCall |  Pas problèmes connus                |
| VBA32                |  Pas problèmes connus                |
| VIPRE                |  Pas problèmes connus                |
| ViRobot              |  Pas problèmes connus                |
| Zillya               |  Pas problèmes connus                |
| Zoner                |  Pas problèmes connus                |

---


### 10. <a name="SECTION10"></a>QUESTIONS FRÉQUEMMENT POSÉES (FAQ)

#### Qu'est-ce qu'une «signature»?

Dans le contexte de phpMussel, une «signature» réfère à les données qui servent comme d'indicateur ou d'identifiant pour quelque chose spécifique que nous recherchons, généralement sous la forme d'un segment très petit, distinct et inoffensif de quelque chose plus grand et autrement nuisible, comme un virus ou un trojan, ou sous la forme d'une somme de contrôle, d'un hash ou d'un autre indicateur d'identification similaire, et généralement comprend une étiquette, et d'autres données pour aider à fournir certains contexte supplémentaire qui peut être utilisé par phpMussel pour déterminer la meilleure façon de procéder quand il rencontre ce que nous recherchons.

#### Qu'est-ce qu'un «faux positif»?

Le terme «faux positif» (*alternativement: «erreur faux positif»; «fausse alarme»*; Anglais: *false positive*; *false positive error*; *false alarm*), décrit très simplement, et dans un contexte généralisé, est utilisé lors de tester pour une condition, de se référer aux résultats de ce test, lorsque les résultats sont positifs (c'est à dire, lorsque la condition est déterminée comme étant «positif», ou «vrai»), mais ils devraient être (ou aurait dû être) négatif (c'est à dire, lorsque la condition, en réalité, est «négatif», ou «faux»). Un «faux positif» pourrait être considérée comme analogue à «crier au loup» (où la condition testée est de savoir s'il y a un loup près du troupeau, la condition est «faux» en ce que il n'y a pas de loup près du troupeau, et la condition est signalé comme «positif» par le berger par voie de crier "loup, loup"), ou analogues à des situations dans des tests médicaux dans lequel un patient est diagnostiqué comme ayant une maladie, alors qu'en réalité, ils ont pas une telle maladie.

Résultats connexes lors de tester pour une condition peut être décrit en utilisant les termes «vrai positif», «vrai négatif» et «faux négatif». Un «vrai positif» se réfère à quand les résultats du test et l'état actuel de la condition sont tous deux vrai (or «positif»), and a «vrai négatif» se réfère à quand les résultats du test et l'état actuel de la condition sont tous deux faux (ou «négatif»); Un «vrai positif» ou «vrai négatif» est considéré comme une «inférence correcte». L'antithèse d'un «faux positif» est un «faux négatif»; Un «faux négatif» se réfère à quand les résultats du test are négatif (c'est à dire, la condition est déterminée comme étant «négatif», ou «faux»), mais ils devraient être (ou aurait dû être) positif (c'est à dire, la condition, en réalité, est «positif», ou «vrai»).

Dans le contexte de phpMussel, ces termes réfèrent à les signatures de phpMussel et les fichiers qu'ils bloquent. Quand phpMussel bloque un fichier en raison du mauvais, obsolète ou signatures incorrectes, mais ne devrait pas l'avoir fait, ou quand il le fait pour les mauvaises raisons, nous référons à cet événement comme un «faux positif». Quand phpMussel ne parvient pas à bloquer un fichier qui aurait dû être bloqué, en raison de menaces imprévues, signatures manquantes ou déficits dans ses signatures, nous référons à cet événement comme un «détection manquée» ou «missed detection» (qui est analogue à un «faux négatif»).

Ceci peut être résumé par le tableau ci-dessous:

&nbsp; | phpMussel ne devrait *PAS* bloquer un fichier | phpMussel *DEVRAIT* bloquer un fichier
---|---|---
phpMussel ne bloque *PAS* un fichier | Vrai négatif (inférence correcte) | Détection manquée (analogue à faux négatif)
phpMussel bloque un fichier | __Faux positif__ | Vrai positif (inférence correcte)

#### À quelle fréquence les signatures sont-elles mises à jour?

La fréquence de mise à jour varie selon les fichiers de signature en question. Tous les mainteneurs des fichiers de signature pour phpMussel tentent généralement de conserver leurs signatures aussi à jour que possible, mais comme nous avons tous divers autres engagements, nos vies en dehors du projet, et comme aucun de nous n'est rémunéré financièrement (ou payé) pour nos efforts sur le projet, un planning de mise à jour précis ne peut être garanti. Généralement, les signatures sont mises à jour chaque fois qu'il y a suffisamment de temps pour les mettre à jour, et généralement, les mainteneurs tentent de prioriser basé sur la nécessité et la fréquence à laquelle des changements se produisent entre les gammes. L'assistance est toujours appréciée si vous êtes prêt à en offrir.

#### J'ai rencontré un problème lors de l'utilisation de phpMussel et je ne sais pas quoi faire à ce sujet! Aidez-moi!

- Utilisez-vous la dernière version du logiciel? Utilisez-vous les dernières versions de vos fichiers de signature? Si la réponse à l'une ou l'autre de ces deux est non, essayez de tout mettre à jour tout d'abord, et vérifier si le problème persiste. Si elle persiste, continuez à lire.
- Avez-vous vérifié toute la documentation? Si non, veuillez le faire. Si le problème ne peut être résolu en utilisant la documentation, continuez à lire.
- Avez-vous vérifié la **[page des problèmes](https://github.com/Maikuolan/phpMussel/issues)**, pour voir si le problème a été mentionné avant? Si on l'a mentionné avant, vérifier si des suggestions, des idées et/ou des solutions ont été fournies, et suivez comme nécessaire pour essayer de résoudre le problème.
- Avez-vous vérifié le **[forum de support pour phpMussel fourni par Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)**, pour voir si le problème a été mentionné avant? Si on l'a mentionné avant, vérifier si des suggestions, des idées et/ou des solutions ont été fournies, et suivez comme nécessaire pour essayer de résoudre le problème.
- Si le problème persiste, veuillez nous en informer en créant un nouveau discussion sur la page des problèmes ou en le forum de support.

#### Je veux utiliser phpMussel avec une version PHP plus ancienne que 5.4.0; Pouvez-vous m'aider?

Non. PHP 5.4.0 a atteint officiellement l'EoL ("End of Life", ou fin de vie) en 2014, et le support étendu en matière de sécurité a pris fin en 2015. À la date d'écriture, il est 2017, et PHP 7.1.0 est déjà disponible. À l'heure actuelle, le support est fourni pour l'utilisation de phpMussel avec PHP 5.4.0 et toutes les nouvelles versions PHP disponibles, mais si vous essayez d'utiliser phpMussel avec les anciennes versions PHP, le support ne sera pas fourni.

#### Puis-je utiliser une seule installation de phpMussel pour protéger plusieurs domaines?

Oui. Les installations phpMussel ne sont pas naturellement verrouillées dans des domaines spécifiques, et peut donc être utilisé pour protéger plusieurs domaines. Généralement, nous référons aux installations phpMussel protégeant un seul domaine comme "installations à un seul domaine" ("single-domain installations"), et nous référons aux installations phpMussel protégeant plusieurs domaines et/ou sous-domaines comme "installations multi-domaines" ("multi-domain installations"). Si vous utilisez une installation multi-domaine et besoin d'utiliser différents ensembles de fichiers de signature pour différents domaines, ou besoin de phpMussel pour être configuré différemment pour différents domaines, il est possible de le faire. Après avoir chargé le fichier de configuration (`config.ini`), phpMussel vérifiera l'existence d'un "fichier de substitution de configuration" spécifique au domaine (ou sous-domaine) demandé (`le-domaine-demandé.tld.config.ini`), et si trouvé, les valeurs de configuration définies par le fichier de substitution de configuration sera utilisé pour l'instance d'exécution au lieu des valeurs de configuration définies par le fichier de configuration. Les fichiers de substitution de configuration sont identiques au fichier de configuration, et à votre discrétion, peut contenir l'intégralité de toutes les directives de configuration disponibles pour phpMussel, ou quelle que soit la petite sous-section requise qui diffère des valeurs normalement définies par le fichier de configuration. Les fichiers de substitution de configuration sont nommée selon le domaine auquel elle est destinée (donc, par exemple, si vous avez besoin d'une fichier de substitution de configuration pour le domaine, `http://www.some-domain.tld/`, sa fichier de substitution de configuration doit être nommé comme `some-domain.tld.config.ini`, et devrait être placé dans la vault à côté du fichier de configuration, `config.ini`). Le nom de domaine pour l'instance d'exécution dérive de l'en-tête `HTTP_HOST` de la demande; "www" est ignoré.

---


Dernière Mise à Jour: 19 Mai 2017 (2017.05.19).
