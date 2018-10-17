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
- 11. [INFORMATION LÉGALE](#SECTION11)

*Note concernant les traductions : En cas d'erreurs (par exemple, différences entre les traductions, fautes de frappe, etc), la version Anglaise du README est considérée comme la version originale et faisant autorité. Si vous trouvez des erreurs, votre aide pour les corriger serait bienvenue.*

---


### 1. <a name="SECTION1"></a>PRÉAMBULE

Merci d'utiliser phpMussel, un script PHP pour la détection de virus, logiciels malveillants et autres menaces dans les fichiers téléchargés sur votre système partout où le script est accroché, basé sur les signatures de ClamAV et autres.

PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPLv2 par Caleb M (Maikuolan).

Ce script est un logiciel libre ; vous pouvez redistribuer et/ou le modifier selon les termes de la GNU General Public License telle que publiée par la Free Software Foundation ; soit la version 2 de la Licence, ou (à votre choix) toute version ultérieure. Ce script est distribué dans l'espoir qu'il sera utile, mais SANS AUCUNE GARANTIE, sans même l'implicite garantie de COMMERCIALISATION ou D'ADAPTATION À UN PARTICULIER USAGE. Voir la GNU General Public License pour plus de détails, situé dans le `LICENSE.txt` fichier et disponible également à partir de :
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Un spécial merci à ClamAV pour l'inspiration du le projet et pour les signatures que ce script utilise, sans qui, le script ne seraient probablement pas exister, ou, au mieux, auraient avoir un très limité valeur.

Un spécial merci à SourceForge et GitHub pour l'hébergement du projet fichiers, et à les sources supplémentaires d'un certain nombre de signatures utilisés par phpMussel : [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) et autres, et merci à tous ceux qui soutiennent le projet, à quelqu'un d'autre que j'ai peut-être oublié de mentionner autrement, et à vous, pour l'utiliser du script.

Ce document et son associé paquet peuvent être téléchargé gratuitement à sans frais à partir de :
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>COMMENT INSTALLER

#### 2.0 INSTALLATION MANUELLE (POUR SERVEURS WEB)

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Maintenant, vous devez déterminer l'approprié emplacement sur votre hôte ou CMS à mettre ces contenus. Un répertoire comme `/public_html/phpmussel/` ou similaire (cependant, il n'est pas question que vous choisissez, à condition que c'est quelque part de sûr et quelque part que vous êtes heureux avec) sera suffira. *Vous avant commencer téléchargement au serveur, continuer lecture..*

2) Renommer `config.ini.RenameMe` à `config.ini` (situé à l'intérieur de `vault`), et facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), l'ouvrir (ce fichier contient toutes les directives disponible pour phpMussel ; au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour). Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, et fermer.

3) Télécharger les contenus (phpMussel et ses fichiers) à le répertoire vous aviez décidé plus tôt (vous n'avez pas besoin les `*.txt`/`*.md` fichiers, mais surtout, vous devriez télécharger tous les fichiers sur le serveur).

4) CHMOD la `vault` répertoire à « 755 » (s'il y a des problèmes, vous pouvez essayer « 777 », mais c'est moins sûr). Le principal répertoire qui est stocker le contenu (celui que vous avez choisi plus tôt), généralement, peut être laissé seul, mais CHMOD état devrait être vérifié si vous avez eu problèmes d'autorisations dans le passé sur votre système (par défaut, devrait être quelque chose comme « 755 »). En bref : Pour que le paquet fonctionne correctement, PHP doit pouvoir lire et écrire des fichiers dans le répertoire `vault`. Beaucoup de choses (mise à jour, journalisation, etc) ne seront pas possibles si PHP ne peut pas écrire dans le répertoire `vault`, et le paquet ne fonctionnera pas du tout si PHP ne peut pas lire le répertoire `vault`. Cependant, pour une sécurité optimale, le répertoire `vault` ne doit PAS être accessible au public (des informations sensibles, telles que les informations contenues dans `config.ini` ou `frontend.dat`, pourraient être exposées à des attaquants potentiels si le répertoire `vault` était accessible au public).

5) Installez toutes les signatures dont vous aurez besoin. *Voir : [INSTALLATION DES SIGNATURES](#INSTALLING_SIGNATURES).*

6) Suivant, vous aurez besoin de l'attacher phpMussel à votre système ou CMS. Il est plusieurs façons vous pouvez attacher phpMussel à votre système ou CMS, mais le plus simple est à simplement inclure le script au début d'un fichier de la base de données de votre système ou CMS (un qui va généralement toujours être chargé lorsque quelqu'un accède à n'importe quelle page sur votre site web) utilisant un `require` ou `include` déclaration. Généralement, ce sera quelque chose de stocké dans un répertoire comme `/includes`, `/assets` ou `/functions`, et il sera souvent nommé quelque chose comme `init.php`, `common_functions.php`, `functions.php` ou similaire. Vous sera besoin à déterminer qui est le fichier c'est pour votre situation ; Si vous rencontrez des difficultés pour la détermination de ce par vous-même, à l'aide, visitez la page des issues pour phpMussel à GitHub ou les forums de support pour phpMussel ; Il est possible que ce soit moi ou un autre utilisateur peuvent avoir de l'expérience avec le CMS que vous utilisez (vous aurez besoin pour nous faire savoir ce qui CMS vous utilisez), et ainsi, peut être en mesure de fournir une assistance pour cette question. Pour ce faire [à utiliser `require` ou `include`], insérez la ligne de code suivante au début de ce le noyau fichier et remplacer la string contenue à l'intérieur des guillemets avec l'exacte adresse le fichier `loader.php` (l'adresse locale, pas l'adresse HTTP ; il ressemblera l'adresse de `vault` mentionné précédemment).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Enregistrer le fichier, fermer, rétélécharger.

-- OU ALTERNATIVEMENT --

Si vous utilisez un Apache serveur web et si vous avez accès à `php.ini`, vous pouvez utiliser la `auto_prepend_file` directive à préfixer phpMussel chaque fois qu'une requête de PHP est faite. Quelque chose comme :

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Ou cette dans le `.htaccess` fichier :

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) À ce stade, vous avez fini ! Cependant, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester les protections, essayez de télécharger les tester fichiers inclus dans le paquet sous `_testfiles` à votre site web par votre habituelles navigateur basé méthodes de téléchargement. Si tout fonctionne correctement, un message devrait apparaître à partir de phpMussel confirmant que le téléchargement a été bloqué avec succès. Si rien ne s'affiche, quelque chose ne fonctionne pas correctement. Si vous utilisez d'avancées fonctions ou si vous utilisez l'autres types d'analyse possibles avec l'outil, je vous suggère de l'essayer avec ceux pour s'assurer qu'il fonctionne comme prévu, aussi.

#### 2.1 INSTALLATION MANUELLE (POUR CLI)

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Lorsque vous avez déterminé que vous êtes satisfait sur l'emplacement choisi pour phpMussel, continuer.

2) phpMussel exige PHP d'être installé sur l'ordinateur hôte afin d'exécuter. Si vous n'avez pas de PHP installé sur votre machine, s'il vous plaît, installer PHP sur votre machine, suivant les instructions fournies par le programme d'installation de PHP.

3) Facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), ouvrir `config.ini` (situé à l'intérieur de `vault`) – Ce fichier contient toutes les directives disponible pour phpMussel. Au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour. Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, fermer.

4) Facultativement, vous pouvez faire utilisant phpMussel en le mode CLI plus facile pour vous-même par la création d'un fichier de commandes pour automatique charger PHP et phpMussel. Pour ce faire, ouvrir un éditeur de texte comme Notepad ou Notepad++, taper le complet chemin vers le `php.exe` fichier dans le répertoire de votre installation de PHP, suivi d'un espace, suivi par le complet chemin vers le `loader.php` fichier dans le répertoire de votre installation de phpMussel, enregistrer le fichier avec un `.bat` suffixe quelque part que vous trouverez facile, et double-cliquer sur ce fichier pour exécuter phpMussel à l'avenir.

5) Installez toutes les signatures dont vous aurez besoin. *Voir : [INSTALLATION DES SIGNATURES](#INSTALLING_SIGNATURES).*

6) À ce stade, vous avez fini ! Mais, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester phpMussel, exécuter phpMussel et essayer d'analyser le `_testfiles` répertoire fourni avec le paquet.

#### 2.2 INSTALLATION AVEC COMPOSER

[phpMussel est enregistré avec Packagist](https://packagist.org/packages/phpmussel/phpmussel), et donc, si vous êtes familier avec Composer, vous pouvez utiliser Composer pour installer phpMussel (vous devrez néanmoins préparer la configuration et les attaches ; voir « installation manuelle (pour serveurs web) » les étapes 2 et 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 INSTALLATION DES SIGNATURES

Depuis v1.0.0, les signatures ne sont pas incluses dans le phpMussel. Les signatures sont requises par phpMussel pour détecter des menaces spécifiques. Il existe 3 méthodes principales pour installer des signatures :

1. Installez automatiquement à l'aide de la page des mises à jour de l'accès frontal.
2. Générer des signatures à l'aide de « SigTool » et installez-les manuellement.
3. Téléchargez les signatures de « phpMussel/Signatures » et installez-les manuellement.

##### 2.3.1 Installez automatiquement à l'aide de la page des mises à jour de l'accès frontal.

Premièrement, vous devrez vous assurer que l'accès frontal est activé. *Voir : [GESTION L'ACCÈS FRONTAL](#SECTION4).*

Ensuite, tout ce que vous aurez à faire est d'aller à la page des mises à jour, trouver les fichiers de signature nécessaires et utiliser les options fournies sur la page, installez-les et activez-les.

##### 2.3.2 Générer des signatures à l'aide de « SigTool » et installez-les manuellement.

*Voir : [Documentation SigTool](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Téléchargez les signatures de « phpMussel/Signatures » et installez-les manuellement.

Premièrement, va à [phpMussel/Signatures](https://github.com/phpMussel/Signatures). Le référentiel contient différents fichiers de signature compressés GZ. Téléchargez les fichiers dont vous avez besoin, décompressez-les et copiez les fichiers décompressés dans le répertoire `/vault/signatures` pour les installer. Listez les noms des fichiers copiés dans la directive `Active` dans votre configuration phpMussel pour les activer.

---


### 3. <a name="SECTION3"></a>COMMENT UTILISER

#### 3.0 COMMENT UTILISER (POUR SERVEURS WEB)

phpMussel devrait être capable de fonctionner correctement avec des exigences minimales de votre part : Après l'avoir installé, il devrait fonctionner immédiatement et être immédiatement utilisable.

L'analyses des téléchargements des fichiers est automatisée et activée par défaut, donc rien est nécessaire à partir de vous pour cette fonction particulière.

Cependant, vous êtes également capable d'instruire phpMussel à analyser spécifiques fichiers, répertoires et/ou archives. Pour ce faire, premièrement, vous devez assurer que la configuration appropriée est imposé dans le `config.ini` fichier (`cleanup` doit être désactivé), et lorsque vous avez terminé, dans un fichier PHP qui est attaché à phpMussel, utilisez la fonction suivante dans votre code :

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` peut être une chaîne, un tableau, ou un tableau de tableaux, et indique quel fichier, fichiers, répertoire et/ou répertoires à analyser.
- `$output_type` est un booléen, indiquant le format dont les résultats d'analyse doivent être retournées sous. `false` instruit la fonction à retourner des résultats comme un entier. `true` instruit la fonction à retourner des résultats sous forme de texte lisible par humain. De plus, dans tout le cas, les résultats peuvent être accessibles via les variables globales après l'analyse est terminée. Cette variable est optionnel, imposé par défaut comme `false`. Ce qui suit décrit les résultats entiers :

| Résultats | Description |
|---|---|
| -4 | Indique que les données n'ont pas pu être analysées à cause du cryptage. |
| -3 | Indique que des problèmes ont été rencontrés avec les fichiers de signature phpMussel. |
| -2 | Indique que données corrompues était détecté lors de l'analyse et donc l'analyse n'ont pas réussi à compléter. |
| -1 | Indique que les extensions ou addons requis par PHP pour exécuter l'analyse sont manquaient et donc l'analyse n'ont pas réussi à compléter. |
| 0 | Indique qu'il n'existe pas cible à analyser et donc il n'y avait rien à analyser. |
| 1 | Indique que la cible était analysé avec succès et aucun problème n'été détectée. |
| 2 | Indique que la cible était analysé avec succès et problèmes ont été détectés. |

- `$output_flatness` est un booléen, indiquant à la fonction soit à retourner les résultats de l'analyse (quand il ya plusieurs cibles d'analyse) comme un tableau ou une chaîne. `false` sera retour les résultats comme un tableau. `true` sera retour les résultats comme une chaîne. Cette variable est optionnel, imposé par défaut comme `false`.

Exemples :

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Retours quelque chose comme ça (comme une string) :

```
 Wed, 16 Sep 2013 02:49:46 +0000 Commencé.
 > Vérification '/user_name/public_html/my_file.html':
 -> Pas problème trouvé.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminé.
```

Pour un complet itinéraire de signatures que sera utilisé par phpMussel pour l'analyse et la façon dont il gère ces signatures, référer à la [SIGNATURE FORMAT](#SECTION8) section de ce fichier README.

Si vous rencontrez des faux positifs, si vous rencontrez quelque chose nouveau que vous pensez doit être bloqué, ou pour toute autre chose en ce qui concerne les signatures, s'il vous plaît, contactez moi à ce sujet afin que je puisse effectuer les nécessaires changements, dont, si vous ne contactez moi pas, j'ai peut n'être pas conscient. *(Voir : [Qu'est-ce qu'un « faux positif » ?](#WHAT_IS_A_FALSE_POSITIVE)).*

Pour désactiver les signatures qui sont incluent avec phpMussel (comme si vous rencontrez un faux positif spécifique à vos besoins dont ne devrait normalement pas être retiré à partir de rationaliser), ajouter les noms des signatures spécifiques à désactiver dans la liste grise des signatures (`/vault/greylist.csv`), séparé par des virgules.

*Voir également : [Comment accéder à des détails spécifiques sur les fichiers lorsqu'ils sont analysés ?](#SCAN_DEBUGGING)*

#### 3.1 COMMENT UTILISER (POUR CLI)

S'il vous plaît, référer à la section « INSTALLATION MANUELLE (POUR CLI) » de ce fichier README.

Aussi soyez conscient que phpMussel est un scanner *à la demande* (ou *on-demand*) ; Il n'est *PAS* un scanner *à l'accès* (ou *on-access* ; autres que pour le téléchargement de fichiers, au moment du téléchargement), et contrairement anti-virus suites conventionnelles, ne surveille pas la mémoire active ! Il seulement détecte les virus contenue par le téléchargement de fichiers, et dans les fichiers que vous explicitement spécifier pour d'analyse.

---


### 4. <a name="SECTION4"></a>GESTION L'ACCÈS FRONTAL

#### 4.0 CE QUI EST L'ACCÈS FRONTAL.

L'accès frontal fournit un moyen pratique et facile de gérer, de maintenir et de mettre à jour votre installation de phpMussel. Vous pouvez afficher, partager et télécharger des fichiers journaux via la page des journaux, vous pouvez modifier la configuration via la page de configuration, vous pouvez installer et désinstaller des composants via la page des mises à jour, et vous pouvez télécharger et modifier des fichiers dans votre vault via le gestionnaire de fichiers.

L'accès frontal est désactivée par défaut afin d'empêcher tout accès non autorisé (l'accès non autorisé pourrait avoir des conséquences importantes pour votre site web et sa sécurité). Les instructions pour l'activer sont incluses ci-dessous.

#### 4.1 COMMENT ACTIVER L'ACCÈS FRONTAL.

1) Localiser la directive `disable_frontend` à l'intérieur de `config.ini`, et réglez-le sur `false` (il sera `true` par défaut).

2) Accéder `loader.php` à partir de votre navigateur (par exemple, `http://localhost/phpmussel/loader.php`).

3) Connectez-vous avec le nom d'utilisateur et le mot de passe défaut (admin/password).

Remarque : Après vous être connecté pour la première fois, afin d'empêcher l'accès frontal non autorisé, vous devez immédiatement changer votre nom d'utilisateur et votre mot de passe ! C'est très important, car il est possible de télécharger du code PHP arbitraire à votre site Web via l'accès frontal.

Aussi, pour une sécurité optimale, il est fortement recommandé d'activer « l'authentification à deux facteurs » pour tous les comptes frontaux (instructions fournies ci-dessous).

#### 4.2 COMMENT UTILISER L'ACCÈS FRONTAL.

Des instructions sont fournies sur chaque page de l'accès frontal, pour expliquer la manière correcte de l'utiliser et son but. Si vous avez besoin d'autres explications ou d'une assistance spéciale, veuillez contacter le support technique. Alternativement, il ya quelques vidéos disponibles sur YouTube qui pourraient aider par voie de démonstration.

#### 4.3 AUTHENTIFICATION À DEUX FACTEURS

Il est possible de sécuriser l'accès frontal en activant l'authentification à deux facteurs (« 2FA »). Lors de la connexion à l'aide d'un compte sur lequel 2FA est activé, un e-mail est envoyé à l'adresse électronique associée à ce compte. Cet e-mail contient un « code 2FA », que l'utilisateur doit alors entrer, en plus du nom d'utilisateur et du mot de passe, afin de pouvoir authentifier ce compte. Cela signifie que l'obtention d'un mot de passe d'un compte ne serait pas suffisant pour qu'un attaquant potentiel puisse authentifier ce compte, comme ils auraient également besoin d'avoir déjà accès à l'adresse électronique associée à ce compte afin de pouvoir recevoir et utiliser le code 2FA associé à la session, rendant ainsi l'accès frontal plus sécurisé.

Avant toute chose, pour activer l'authentification à deux facteurs, à l'aide de la page des mises à jour frontales, installez le composant PHPMailer. phpMussel utilise PHPMailer pour envoyer des emails. Il convient de noter que bien que phpMussel, en soi, est compatible avec PHP >= 5.4.0, PHPMailer a besoin de PHP >= 5.5.0, ce qui signifie que l'activation de l'authentification à deux facteurs pour l'accès frontal sur phpMussel ne sera pas possible pour les utilisateurs de PHP 5.4.

Après avoir installé PHPMailer, vous devez renseigner les directives de configuration de PHPMailer via la page de configuration ou le fichier de configuration de phpMussel. Plus d'informations sur ces directives de configuration sont incluses dans la section de configuration de ce document. Après avoir rempli les directives de configuration de PHPMailer, mettre `Enable2FA` à `true`. L'authentification à deux facteurs devrait maintenant être activée.

Ensuite, vous devrez associer une adresse e-mail à un compte afin que phpMussel sache où envoyer les codes 2FA lors de la connexion via ce compte. Pour ce faire, utilisez l'adresse e-mail comme nom d'utilisateur pour le compte (comme `foo@bar.tld`), ou inclure l'adresse e-mail dans le nom d'utilisateur de la même manière que lorsqu'un e-mail est envoyé normalement (comme `Foo Bar <foo@bar.tld>`).

Remarque : Protéger votre vault contre les accès non autorisés (par exemple, en renforçant la sécurité de votre serveur et les autorisations d'accès public), est particulièrement important ici, en raison de cet accès non autorisé à votre fichier de configuration (qui est stocké dans votre vault), risque d'exposer vos paramètres SMTP sortants (qui comprend le nom d'utilisateur et le mot de passe pour votre SMTP). Vous devez vous assurer que votre vault est correctement sécurisé avant de activer l'authentification à deux facteurs. Si vous ne pouvez pas le faire, vous devez au moins créer un nouveau compte e-mail, dédié à cet effet, afin de réduire les risques associés aux paramètres SMTP exposés.

---


### 5. <a name="SECTION5"></a>CLI (COMMANDE LIGNE INTERFACE)

phpMussel peut être exécuté comme un analyseur de fichiers interactif en mode CLI dans windows. Référer à la section « COMMENT INSTALLER (POUR CLI) » de ce fichier README pour plus détails.

Pour une liste des disponibles CLI commandes, à l'invite CLI, tapez « c », et appuyez sur Entrée.

En outre, pour les personnes intéressées, un didacticiel vidéo pour savoir comment utiliser phpMussel en le mode CLI est disponible ici :
- <https://youtu.be/H-Pa740-utc>

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
/_testfiles/ascii_standard_testfile.txt | Fichier pour tester phpMussel signatures ASCII/ANSI normalisé.
/_testfiles/coex_testfile.rtf | Fichier pour tester phpMussel signatures complexes étendues.
/_testfiles/exe_standard_testfile.exe | Fichier pour tester phpMussel signatures PE.
/_testfiles/general_standard_testfile.txt | Fichier pour tester phpMussel signatures générales.
/_testfiles/graphics_standard_testfile.gif | Fichier pour tester phpMussel signatures graphiques.
/_testfiles/html_standard_testfile.html | Fichier pour tester phpMussel signatures HTML normalisé.
/_testfiles/md5_testfile.txt | Fichier pour tester phpMussel signatures MD5.
/_testfiles/ole_testfile.ole | Fichier pour tester phpMussel signatures OLE.
/_testfiles/pdf_standard_testfile.pdf | Fichier pour tester phpMussel signatures PDF.
/_testfiles/pe_sectional_testfile.exe | Fichier pour tester phpMussel signatures PE sectionnelle.
/_testfiles/swf_standard_testfile.swf | Fichier pour tester phpMussel signatures SWF.
/vault/ | Voûte répertoire (contient divers fichiers).
/vault/cache/ | Cache répertoire (pour les données temporaires).
/vault/cache/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/fe_assets/ | Les fichiers de l'accès frontal.
/vault/fe_assets/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/fe_assets/_2fa.html | Un modèle HTML utilisé pour demander à l'utilisateur un code 2FA.
/vault/fe_assets/_accounts.html | Un modèle HTML pour la page des comptes de l'accès frontal.
/vault/fe_assets/_accounts_row.html | Un modèle HTML pour la page des comptes de l'accès frontal.
/vault/fe_assets/_cache.html | Un modèle HTML pour la page del données de cache de l'accès frontal.
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
/vault/fe_assets/_quarantine.html | Un modèle HTML pour la page de quarantaine de l'accès frontal.
/vault/fe_assets/_quarantine_row.html | Un modèle HTML pour la page de quarantaine de l'accès frontal.
/vault/fe_assets/_siginfo.html | Un modèle HTML pour la page des informations sur les signatures de l'accès frontal.
/vault/fe_assets/_siginfo_row.html | Un modèle HTML pour la page des informations sur les signatures de l'accès frontal.
/vault/fe_assets/_statistics.html | Un modèle HTML pour la page de statistiques de l'accès frontal.
/vault/fe_assets/_updates.html | Un modèle HTML pour la page des mises à jour de l'accès frontal.
/vault/fe_assets/_updates_row.html | Un modèle HTML pour la page des mises à jour de l'accès frontal.
/vault/fe_assets/_upload_test.html | Un modèle HTML pour les tests de téléchargement.
/vault/fe_assets/frontend.css | Feuille de style CSS pour l'accès frontal.
/vault/fe_assets/frontend.dat | Base de données pour l'accès frontal (contient des informations sur les comptes et les sessions ; généré seulement si l'accès frontal est activé et utilisé).
/vault/fe_assets/frontend.dat.safety | Généré comme un mécanisme de sécurité en cas de besoin.
/vault/fe_assets/frontend.html | Le fichier modèle HTML principal pour l'accès frontal.
/vault/fe_assets/icons.php | Gestionnaire d'icônes (utilisé par le gestionnaire de fichiers de l'accès frontal).
/vault/fe_assets/pips.php | Gestionnaire de pips (utilisé par le gestionnaire de fichiers de l'accès frontal).
/vault/fe_assets/scripts.js | Contient des données JavaScript pour l'accès frontal.
/vault/lang/ | Contient données linguistiques.
/vault/lang/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/lang/lang.ar.fe.php | Données linguistiques en Arabe pour l'accès frontal.
/vault/lang/lang.ar.php | Données linguistiques en Arabe.
/vault/lang/lang.bn.fe.php | Données linguistiques en Bangla pour l'accès frontal.
/vault/lang/lang.bn.php | Données linguistiques en Bangla.
/vault/lang/lang.de.fe.php | Données linguistiques en Allemande pour l'accès frontal.
/vault/lang/lang.de.php | Données linguistiques en Allemande.
/vault/lang/lang.en.fe.php | Données linguistiques en Anglais pour l'accès frontal.
/vault/lang/lang.en.php | Données linguistiques en Anglais.
/vault/lang/lang.es.fe.php | Données linguistiques en Espagnol pour l'accès frontal.
/vault/lang/lang.es.php | Données linguistiques en Espagnol.
/vault/lang/lang.fr.fe.php | Données linguistiques en Français pour l'accès frontal.
/vault/lang/lang.fr.php | Données linguistiques en Français.
/vault/lang/lang.hi.fe.php | Données linguistiques en Hindi pour l'accès frontal.
/vault/lang/lang.hi.php | Données linguistiques en Hindi.
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
/vault/lang/lang.tr.fe.php | Données linguistiques en Turc pour l'accès frontal.
/vault/lang/lang.tr.php | Données linguistiques en Turc.
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
/vault/.travis.php | Utilisé par Travis CI pour le tester (pas nécessaire pour le bon fonctionnement du script).
/vault/.travis.yml | Utilisé par Travis CI pour le tester (pas nécessaire pour le bon fonctionnement du script).
/vault/cli.php | Module de CLI.
/vault/components.dat | Fichier de métadonnées de composants ; Utilisé par la page des mises à jour frontales.
/vault/config.ini.RenameMe | Fichier de configuration ; Contient toutes les options de configuration pour phpMussel, pour comment fonctionner correctement (renommer pour activer).
/vault/config.php | Module de configuration.
/vault/config.yaml | Fichier pour les valeurs par défaut de la configuration ; Contient les valeurs par défaut de la configuration pour phpMussel.
/vault/frontend.php | Module de l'accès frontal.
/vault/frontend_functions.php | Fichier de fonctions de l'accès frontal.
/vault/functions.php | Fichier de fonctions (essentiel).
/vault/greylist.csv | CSV de grise listé signatures indiquant pour phpMussel qui signatures il faut ignorer (fichier recréé automatiquement si supprimé).
/vault/lang.php | Module de linguistiques.
/vault/php5.4.x.php | Polyfills pour PHP 5.4.X (Requis pour la compatibilité descendante de PHP 5.4.X ; safe à supprimer pour les versions plus récentes de PHP).
/vault/plugins.dat | Fichier de métadonnées de plugins ; Utilisé par la page des mises à jour frontales.
※ /vault/scan_kills.txt | Les résultats de chaque fichier téléchargement bloqué/tués par phpMussel.
※ /vault/scan_log.txt | Un enregistrement de tout analysé par phpMussel.
※ /vault/scan_log_serialized.txt | Un enregistrement de tout analysé par phpMussel.
/vault/shorthand.yaml | Contient divers identifiants de signature à traiter par phpMussel lors de l'interprétation des sténographie des signatures lors d'un scan, et lors de l'accès aux informations sur les signatures via l'accès frontal.
/vault/signatures.dat | Fichier de métadonnées de signatures ; Utilisé par la page des mises à jour frontales.
/vault/template_custom.html | Modèle fichier ; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/template_default.html | Modèle fichier ; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/themes.dat | Fichier de métadonnées de thèmes ; Utilisé par la page des mises à jour frontales.
/vault/upload.php | Module de téléchargements.
/.gitattributes | Un fichier du GitHub projet (pas nécessaire pour le bon fonctionnement du script).
/.gitignore | Un fichier du GitHub projet (pas nécessaire pour le bon fonctionnement du script).
/Changelog-v1.txt | Un enregistrement des modifications apportées au script entre les différentes versions (pas nécessaire pour le bon fonctionnement du script).
/composer.json | Composer/Packagist information (pas nécessaire pour le bon fonctionnement du script).
/CONTRIBUTING.md | Informations sur la façon de contribuer au projet.
/LICENSE.txt | Une copie de la GNU/GPLv2 license (pas nécessaire pour le bon fonctionnement du script).
/loader.php | Le chargeur. C'est ce que vous êtes censé être attacher dans à (essentiel) !
/PEOPLE.md | Informations sur les personnes impliquées dans le projet.
/README.md | Sommaire de l'information du projet.
/web.config | Un ASP.NET fichier de configuration (dans ce cas, pour protéger de la `/vault` répertoire contre d'être consulté par des non autorisée sources dans le cas où le script est installé sur un serveur basé sur les ASP.NET technologies).

※ Noms du fichiers peut varier basé sur configuration stipulations (dans `config.ini`).

---


### 7. <a name="SECTION7"></a>OPTIONS DE CONFIGURATION
Ce qui suit est une liste des directives disponibles pour phpMussel dans le `config.ini` fichier de configuration, avec une description de leur objectif et leur fonction.

#### « general » (Catégorie)
Configuration générale pour phpMussel.

##### « cleanup »
- Déensemble variables du script et cache après l'exécution ? False = Non ; True = Oui [Défaut]. Si vous ne utilisez pas le script au-delà l'initiale analyse du téléchargements, devrait ensemble à `true` (oui) à minimiser l'utilisation de la mémoire. Si vous utilisez le script à des fins au-delà l'initiale analyse du téléchargements, devrait ensemble à `false` (non), pour éviter recharger inutilement dupliqué données dans la mémoire. Dans la pratique générale, il devrait probablement être ensemblé à `true`, mais, si vous faites cela, vous ne serez pas être capable d'utiliser le script pour tout chose autre que l'analyse des fichiers téléchargements.
- N'a pas d'influence en le mode CLI.

##### « scan_log »
- Nom du fichier à enregistrer tous les résultats de l'analyse. Spécifiez un nom de fichier, ou laisser vide à désactiver.

##### « scan_log_serialized »
- Nom du fichier à enregistrer tous les résultats de l'analyse (le format est sérialisé). Spécifiez un nom de fichier, ou laisser vide à désactiver.

##### « scan_kills »
- Nom du fichier à enregistrer tous les résultats de bloqué ou tué téléchargements. Spécifiez un nom de fichier, ou laisser vide à désactiver.

*Conseil utile : Si vous souhaitez, vous pouvez ajouter l'information pour la date/l'heure à les noms de vos fichiers pour enregistrement par des incluant ceux-ci au nom : `{yyyy}` pour l'année complète, `{yy}` pour l'année abrégée, `{mm}` pour mois, `{dd}` pour le jour, `{hh}` pour l'heure.*

*Exemples :*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

##### « truncate »
- Tronquer les fichiers journaux lorsqu'ils atteignent une certaine taille ? La valeur est la taille maximale en o/Ko/Mo/Go/To qu'un fichier journal peut croître avant d'être tronqué. La valeur par défaut de 0Ko désactive la troncature (les fichiers journaux peuvent croître indéfiniment). Remarque : S'applique aux fichiers journaux individuels ! La taille des fichiers journaux n'est pas considérée collectivement.

##### « log_rotation_limit »
- La rotation du journal limite le nombre de fichiers journaux qui doivent exister à un moment donné. Lorsque de nouveaux fichiers journaux sont créés, si le nombre total de fichiers journaux dépasse la limite spécifiée, l'action spécifiée sera effectuée. Vous pouvez spécifier la limite souhaitée ici. Une valeur de 0 désactivera la rotation du journal.

##### « log_rotation_action »
- La rotation du journal limite le nombre de fichiers journaux qui doivent exister à un moment donné. Lorsque de nouveaux fichiers journaux sont créés, si le nombre total de fichiers journaux dépasse la limite spécifiée, l'action spécifiée sera effectuée. Vous pouvez spécifier l'action souhaitée ici. Delete = Supprimez les fichiers journaux les plus anciens, jusqu'à ce que la limite ne soit plus dépassée. Archive = Tout d'abord archiver, puis supprimez les fichiers journaux les plus anciens, jusqu'à ce que la limite ne soit plus dépassée.

*Clarification technique : Dans ce contexte, « plus ancien » signifie moins récemment modifié.*

##### « timeOffset »
- Si votre temps serveur ne correspond pas à votre temps locale, vous pouvez spécifier un offset ici pour régler l'information en date/temps généré par phpMussel selon vos besoins. Il est généralement recommandé à la place pour ajuster la directive de fuseau horaire dans votre fichier `php.ini`, mais parfois (tels que lorsque l'on travaille avec des fournisseurs d'hébergement partagé limitées) ce n'est pas toujours possible de faire, et donc, cette option est disponible ici. Offset est en minutes.
- Exemple (à ajouter une heure) : `timeOffset=60`

##### « timeFormat »
- Le format de notation de la date/heure utilisé par phpMussel. Défaut = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

##### « ipaddr »
- Où trouver l'adresse IP de requêtes ? (Utile pour services tels que Cloudflare et similaires) Par Défaut = REMOTE_ADDR. AVERTISSEMENT : Ne pas changer si vous ne sais pas ce que vous faites !

Valeurs recommandées pour « ipaddr » :

Valeur | En utilisant
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy inversé Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy inversé Cloudflare.
`CF-Connecting-IP` | Proxy inversé Cloudflare (alternative ; si ce qui précède ne fonctionne pas).
`HTTP_X_FORWARDED_FOR` | Proxy inversé Cloudbric.
`X-Forwarded-For` | [Proxy inversé Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Défini par la configuration du serveur.* | [Proxy inversé Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Pas de proxy inversé (valeur par défaut).

##### « enable_plugins »
- Permettre le support pour les plugins du phpMussel ? False = Non [Défaut] ; True = Oui.

##### « forbid_on_block »
- Devrait phpMussel envoyer les en-têtes 403 avec le fichier téléchargement bloqué message, ou rester avec l'habitude 200 bien (200 OK) ? False = Non (200) ; True = Oui (403) [Défaut].

##### « delete_on_sight »
- Mise en cette option sera instruire le script à tenter immédiatement supprimer tout fichiers elle constate au cours de son analyse correspondant à des critères de détection, que ce soit via des signatures ou autrement. Fichiers jugées propre ne seront pas touchés. Dans le cas des archives, l'ensemble d'archive sera supprimé (indépendamment de si le incriminé fichier est que l'un de plusieurs fichiers contenus dans l'archive). Pour le cas d'analyse de fichiers téléchargement, généralement, il n'est pas nécessaire d'activer cette option sur, parce généralement, PHP faire purger automatiquement les contenus de son cache lorsque l'exécution est terminée, ce qui signifie que il va généralement supprimer tous les fichiers téléchargés à travers elle au serveur sauf qu'ils ont déménagé, copié ou supprimé déjà. L'option est ajoutée ici comme une supplémentaire mesure de sécurité pour ceux dont copies de PHP peut pas toujours se comporter de la manière attendu. False = Après l'analyse, laissez le fichier tel quel [Défaut] ; True = Après l'analyse, si pas propre, supprimer immédiatement.

##### « lang »
- Spécifiez la langue défaut pour phpMussel.

##### « numbers »
- Spécifie comment afficher les nombres.

Valeurs actuellement supportées :

Valeur | Produit | Description
---|---|---
`NoSep-1` | `1234567.89`
`NoSep-2` | `1234567,89`
`Latin-1` | `1,234,567.89` | Valeur par défaut.
`Latin-2` | `1 234 567.89`
`Latin-3` | `1.234.567,89`
`Latin-4` | `1 234 567,89`
`Latin-5` | `1,234,567·89`
`China-1` | `123,4567.89`
`India-1` | `12,34,567.89`
`India-2` | `१२,३४,५६७.८९`
`Bengali-1` | `১২,৩৪,৫৬৭.৮৯`
`Arabic-1` | `١٢٣٤٥٦٧٫٨٩`
`Arabic-2` | `١٬٢٣٤٬٥٦٧٫٨٩`
`Thai-1` | `๑,๒๓๔,๕๖๗.๘๙`

*Remarque : Ces valeurs ne sont standardisées nulle part, et ne seront probablement pas pertinentes au-delà du package. Aussi, les valeurs supportées peuvent changer à l'avenir.*

##### « quarantine_key »
- phpMussel est capable de mettre en quarantaine le marqué fichier téléchargement tentatives en isolement au sein de la voûte de phpMussel, si cela est quelque chose que vous voulez qu'il fasse. L'utilisateurs de phpMussel qui souhaitent simplement de protéger leurs sites ou environnement d'hébergement sans avoir un profondément intérêt dans d'analyse de quelconque marqué fichier téléchargement tentatives devrait laisser cette fonctionnalité désactivée, mais tous les utilisateurs intéressés dans d'analyse plus approfondie de tenté fichier téléchargements pour la recherche des logiciels malveillants ou pour des choses semblables devraient permettre cette fonctionnalité. La quarantaine de marqué fichier téléchargement tentatives peut parfois aider également dans le débogage des faux positifs, si cela est quelque chose qui se produit fréquemment pour vous. Pour désactiver la fonctionnalité de quarantaine, il suffit de laisser la directive `quarantine_key` vide, ou effacer le contenu de cette directive si elle est pas déjà vide. Pour activer la fonctionnalité de quarantaine, entrer une valeur dans la directive. Le `quarantine_key` est une élément important de la sécurité de la fonctionnalité de quarantaine requis en tant que moyen de prévention de la fonctionnalité de quarantaine d'être exploités par des attaquants potentiels en tant que moyen de prévention toute potentielle exécution de données stockées dans la quarantaine. Le `quarantine_key` devrait être traité de la même manière que vos mots de passe : Le plus sera le mieux, et conservez-le bien. Pour un meilleur effet, utiliser en conjonction avec `delete_on_sight`.

##### « quarantine_max_filesize »
- La maximum taille autorisée de fichiers mis en quarantaine. Fichiers au-dessus de cette valeur ne sera pas placé en quarantaine. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. Défaut = 2Mo.

##### « quarantine_max_usage »
- La maximale utilisation autorisée de la mémoire pour la quarantaine. Si la totale d'utilisée mémoire par la quarantaine atteint cette valeur, les anciens fichiers en quarantaine seront supprimés jusqu'à ce que la totale mémoire utilisée n'atteint pas cette valeur. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. Défaut = 64Mo.

##### « quarantine_max_files »
- Le nombre maximal de fichiers pouvant exister dans la quarantaine. Lorsque de nouveaux fichiers sont ajoutés à la quarantaine, si ce nombre est dépassé, les anciens fichiers seront supprimés jusqu'à ce que le reste ne dépasse plus ce nombre. Défaut = 100.

##### « honeypot_mode »
- Quand le honeypot mode est activé, phpMussel va tenter de mettre en quarantaine tous les fichier téléchargements ce qu'il rencontre, indépendamment de si oui ou non le fichier en cours de téléchargement correspond à signature inclus, et aucune réelle analyse de ces fichier téléchargements tentatives va arriver. Cette fonctionnalité devrait être utile pour ceux qui souhaitent utiliser phpMussel pour des fins de logiciels malveillants ou virus recherche, mais il pas n'est recommandé d'activer cette fonctionnalité si l'utilisation prévue de phpMussel par l'utilisateur est l'analyse de fichier téléchargements comme la norme, ni est-il recommandé d'utiliser la honeypot fonctionnalité pour fins autres que celles du honeypot. Par défaut, cette option est désactivée. False = Désactivé [Défaut] ; True = Activé.

##### « scan_cache_expiry »
- Pour combien de temps devrait phpMussel cache les résultats de l'analyse ? La valeur est le nombre de secondes pour mettre en cache les résultats de l'analyse pour. Par défaut est 21600 secondes (6 heures) ; Une valeur de 0 désactive mettre en cache les résultats de l'analyse.

##### « disable_cli »
- Désactiver le mode CLI ? Le mode CLI est activé par défaut, mais peut parfois interférer avec certains test outils (comme PHPUnit, par exemple) et d'autres applications basées sur CLI. Si vous n'avez pas besoin désactiver le mode CLI, vous devrait ignorer cette directive. False = Activer le mode CLI [Défaut] ; True = Désactiver le mode CLI.

##### « disable_frontend »
- Désactiver l'accès frontal ? L'accès frontal peut rendre phpMussel plus facile à gérer, mais peut aussi être un risque potentiel pour la sécurité. Il est recommandé de gérer phpMussel via le back-end chaque fois que possible, mais l'accès frontal est prévu pour quand il est impossible. Seulement activer si vous avez besoin. False = Activer l'accès frontal ; True = Désactiver l'accès frontal [Défaut].

##### « max_login_attempts »
- Nombre maximal de tentatives de connexion (l'accès frontal). Défaut = 5.

##### « FrontEndLog »
- Fichier pour l'enregistrement des tentatives de connexion à l'accès frontal. Spécifier un fichier, ou laisser vide à désactiver.

##### « disable_webfonts »
- Désactiver les webfonts ? True = Oui [Défaut] ; False = Non.

##### « maintenance_mode »
- Activer le mode de maintenance ? True = Oui ; False = Non [Défaut]. Désactive tout autre que l'accès frontal. Parfois utile pour la mise à jour de votre CMS, des frameworks, etc.

##### « default_algo »
- Définit quel algorithme utiliser pour tous les mots de passe et les sessions à l'avenir. Options : PASSWORD_DEFAULT (défaut), PASSWORD_BCRYPT, PASSWORD_ARGON2I (nécessite PHP >= 7.2.0).

##### « statistics »
- Suivre les statistiques d'utilisation pour phpMussel ? True = Oui ; False = Non [Défaut].

#### « signatures » (Catégorie)
Configuration pour les signatures.

##### « Active »
- Une liste des fichiers de signatures active, délimitée par des virgules.

*Remarque : Les fichiers de signatures doivent d'abord être installés, avant de pouvoir les activer.*

##### « fail_silently »
- Devrait phpMussel signaler quand les fichiers du signatures sont manquants ou endommagés ? Si `fail_silently` est désactivé, fichiers manquants et corrompus seront signalé sur analyse, et si `fail_silently` est activé, fichiers manquants et corrompus seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. Cela devrait généralement être laissé seul sauf si vous rencontrez accidents ou similaires problèmes. False = Désactivé ; True = Activé [Défaut].

##### « fail_extensions_silently »
- Devrait phpMussel signaler quand les extensions sont manquantes ? Si `fail_extensions_silently` est désactivé, extensions manquantes seront signalé sur analyse, et si `fail_extensions_silently` est activé, extensions manquantes seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. La désactivation de cette directive peut potentiellement augmenter votre sécurité, mais peut aussi conduire à une augmentation de faux positifs. False = Désactivé ; True = Activé [Défaut].

##### « detect_adware »
- Devrait phpMussel utiliser signatures pour détecter les adwares ? False = Non ; True = Oui [Défaut].

##### « detect_encryption »
- Devrait phpMussel détecter et bloquer les fichiers cryptés ? False = Non ; True = Oui [Défaut].

##### « detect_joke_hoax »
- Devrait phpMussel utiliser signatures pour détecter les blagues/canulars malware/virus ? False = Non ; True = Oui [Défaut].

##### « detect_pua_pup »
- Devrait phpMussel utiliser signatures pour détecter les PUAs/PUPs ? False = Non ; True = Oui [Défaut].

##### « detect_packer_packed »
- Devrait phpMussel utiliser signatures pour détecter les emballeurs et des données emballés ? False = Non ; True = Oui [Défaut].

##### « detect_shell »
- Devrait phpMussel utiliser signatures pour détecter les scripts shell ? False = Non ; True = Oui [Défaut].

##### « detect_deface »
- Devrait phpMussel utiliser signatures pour détecter les defacements and defacers ? False = Non ; True = Oui [Défaut].

#### « files » (Catégorie)
Configuration générale pour les gestion des fichiers.

##### « max_uploads »
- Maximum admissible nombre de fichiers pour analyse lorsque l'analyse de fichier téléchargements avant d'abandonner l'analyse et informer l'utilisateur qu'ils sont téléchargement trop à la fois ! Fournit protection contre une théorique attaque par lequel un attaquant tente à DDoS votre système ou CMS par surchargeant phpMussel à ralentir le processus de PHP à une halte. Recommandé : 10. Vous pouvez désirer d'augmenter ou diminuer ce nombre dépendamment de la vitesse de votre hardware. Notez que ce nombre ne tient pas compte pour ou inclure le contenus des archives.

##### « filesize_limit »
- Limite de taille des fichiers en Ko. 65536 = 64Mo [Défaut] ; 0 = Pas limite (toujours en liste grise), tout (positif) valeur numérique acceptée. Cela peut être utile lorsque votre configuration de PHP limite la quantité de mémoire qu'un processus peut contenir ou si votre configuration de PHP limite la taille du fichier téléchargements.

##### « filesize_response »
- Que faire avec des fichiers qui dépassent la limite de taille des fichiers (si existant). False = Énumérer Blanche ; True = Énumérer Noire [Défaut].

##### « filetype_whitelist », « filetype_blacklist », « filetype_greylist »
- Si votre système permettre seulement particuliers types des fichiers à être téléchargé, ou si votre système nie explicitement particuliers types des fichiers, spécifiant les types des fichiers dans listes blanches, listes noires et listes grises peut augmenter la vitesse à laquelle l'analyse est effectuée en permettant le script à sauter particuliers types des fichiers. Format est CSV (virgule séparées valeurs). Si vous souhaitez analyse tout, plutôt que de liste blanche, liste noire ou liste gris, laisser les variable(/s) blanc ; Il va désactiver liste blanche/noire/gris.
- L'ordre logique de l'application est :
  - Si le type de fichier est listé blanche, n'analyser pas ni bloquer pas le fichier, et ne vérifie pas le fichier contre la liste noire ou la liste grise.
  - Si le type de fichier est listé noire, n'analyser pas le fichier mais bloquer de toute façon, et ne vérifie pas le fichier contre la liste grise.
  - Si la liste grise est vide ou si la liste grise n'est vide pas et le type de fichier est listé grise, analyser le fichier comme d'habitude et déterminer si de bloquer basés des résultats de l'analyse, mais si la liste grise n'est vide pas et le type de fichier n'est listé grise pas, traiter le fichier comme listé noire, donc n'analyse pas mais bloque de toute façon.

##### « check_archives »
- Essayer vérifier les contenus des archives ? False = Non (ne pas vérifier) ; True = Oui (vérifier) [Défaut].

Format | Peut lire | Peut lire récursivement | Peut détecter le cryptage | Remarques
---|---|---|---|---
Zip | ✔️ | ✔️ | ✔️ | Nécessite [libzip](http://php.net/manual/en/zip.requirements.php) (normalement livré avec PHP de toute façon). Aussi supporté (utilise le format zip) : ✔️ Détection d'objet OLE. ✔️ Détection de macro Office.
Tar | ✔️ | ✔️ | ➖ | Aucune exigence particulière. Le format ne supporte pas le cryptage.
Rar | ✔️ | ✔️ | ✔️ | Nécessite l'extension [rar](https://pecl.php.net/package/rar) (quand cette extension n'est pas installée, phpMussel ne peut pas lire les fichiers rar).
7zip | ❌ | ❌ | ❌ | Étudie actuellement comment lire les fichiers 7zip dans phpMussel.
Phar | ❌ | ❌ | ❌ | La capacité de lire des fichiers phar a été supprimée dans la version 1.6.0, et ne sera réajoutée pour des raisons de sécurité.

*Si quelqu'un est capable et disposé à aider à implémenter le support pour la lecture d'autres formats d'archive, une telle aide serait la bienvenue.*

##### « filesize_archives »
- Étendre taille du fichier liste noire/blanche paramètres à le contenu des archives ? False = Non (énumérer grise tout) ; True = Oui [Défaut].

##### « filetype_archives »
- Étendre type de fichier liste noire/blanche paramètres à le contenu des archives ? False = Non (énumérer grise tout) ; True = Oui [Défaut].

##### « max_recursion »
- Maximum récursivité profondeur limite pour archives. Défaut = 3.

##### « block_encrypted_archives »
- Détecter et bloquer les archives cryptées ? Parce phpMussel est pas capable d'analyse du contenu des archives cryptées, il est possible que le cryptage des archives peut être utilisé par un attaquant un moyen a tenter de contourner phpMussel, analyseurs anti-virus et d'autres protections. Instruire phpMussel pour bloquer toutes les archives cryptées qu'il découvre pourrait aider à réduire les risques associés à ces possibilités. False = Non ; True = Oui [Défaut].

#### « attack_specific » (Catégorie)
Configuration pour les détections d'attaque spécifiques.

Détection des attaques de caméléon : False = Désactivé ; True = Activé.

##### « chameleon_from_php »
- Vérifier pour les en-têtes PHP dans les fichiers qui ne sont pas de PHP ni reconnue comme archives.

##### « can_contain_php_file_extensions »
- Une liste d'extensions de fichiers autorisés à contenir du code PHP, séparés par des virgules. Si la détection des attaques de caméléon PHP est activée, les fichiers qui contiennent du code PHP, qui ont des extensions qui ne sont pas sur cette liste, seront détectés comme des attaques de caméléon PHP.

##### « chameleon_from_exe »
- Vérifier pour les en-têtes d'exécutables dans les fichiers qui ne sont pas fichiers exécutable ni reconnue comme archives et pour exécutables dont les en-têtes sont incorrects.

##### « chameleon_to_archive »
- Détecter les en-têtes incorrects dans les archives et les fichiers compressés. Supporté : BZ/BZIP2, GZ/GZIP, LZF, RAR, ZIP.

##### « chameleon_to_doc »
- Vérifier pour les documents office dont les en-têtes sont incorrects (Supporté : DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

##### « chameleon_to_img »
- Vérifier pour les images dont les en-têtes sont incorrects (Supporté : BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

##### « chameleon_to_pdf »
- Vérifier pour les fichiers PDF dont les en-têtes sont incorrects.

##### « archive_file_extensions »
- Les extensions de fichiers d'archives reconnus (format est CSV ; devraient ajouter ou supprimer seulement quand problèmes surviennent ; supprimer inutilement peut entraîner des faux positifs à paraître pour archive fichiers, tandis que ajoutant inutilement sera essentiellement liste blanche ce que vous ajoutez à partir de l'attaque spécifique détection ; modifier avec prudence ; aussi noter que cela n'a aucun effet sur ce archives peut et ne peut pas être analysé au niveau du contenu). La liste, comme en cas de défaut, énumère les formats plus couramment utilisé dans la majorité des systèmes et CMS, mais volontairement pas nécessairement complète.

##### « block_control_characters »
- Bloquer tous les fichiers contenant les caractères de contrôle (autre que les sauts de ligne) ? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Si vous êtes _**SEULEMENT**_ télécharger de brut texte fichiers, puis vous pouvez activer cette option à fournir une supplémentaire protection à votre système. Mais, si vous télécharger quelque chose plus que brut texte, l'activation de cette peut créer faux positifs. False = Ne pas bloquer [Défaut] ; True = Bloquer.

##### « corrupted_exe »
- Fichiers corrompus et erreurs d'analyse. False = Ignorer ; True = Bloquer [Défaut]. Détecter et bloquer les fichiers PE (Portable Executable) potentiellement corrompus ? Souvent (mais pas toujours), lorsque certains aspects d'un fichier PE sont corrompus ou ne peut pas être analysée correctement, il peut être le signe d'une infection virale. Les processus utilisés par la plupart des programmes anti-virus pour détecter les virus dans fichiers PE requérir l'analyse de ces fichiers par méthodes certaines, de ce que, si le programmeur d'un virus est conscient de, seront spécifiquement tenter d'empêcher, en vue de permettre leur virus n'être pas détectée.

##### « decode_threshold »
- Seuil à la longueur de brutes données dans laquelle commandes des décodages doivent être détectés (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). Défaut = 512Ko. Zéro ou nulle valeur désactive le seuil (supprimant toute restriction basé sur la taille du fichier).

##### « scannable_threshold »
- Seuil à la longueur de données brutes dans laquelle phpMussel est autorisé à lire et à analyser (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). Défaut = 32Mo. Zéro ou nulle valeur désactive le seuil. En général, cette valeur ne doit pas être moins que la moyenne tailles des fichiers des téléchargements que vous voulez et s'attendent à recevoir de votre serveur ou site web, ne devrait pas être plus que la filesize_limit directive, et ne devrait pas être plus que d'un cinquième de l'allocation de totale mémoire autorisée à PHP via le `php.ini` fichier de configuration. Cette directive existe pour tenter d'empêcher phpMussel d'utiliser trop de mémoire (ce qui l'empêcherait d'être capable d'analyse fichiers dessus d'une certaine taille avec succès).

##### « allow_leading_trailing_dots »
- Autoriser les points de début et de fin dans les noms de fichiers ? Cela peut parfois être utilisé pour cacher des fichiers, ou pour tromper certains systèmes en permettant la traversée de répertoires. False = Ne pas autoriser [Défaut]. True = Autoriser.

##### « block_macros »
- Essayez de bloquer tous les fichiers contenant des macros ? Certains types de documents et feuilles de calcul peuvent contenir des macros exécutables, fournissant ainsi un dangereux vecteur potentiel pour logiciels malveillants. False = Ne pas bloquer [Défaut] ; True = Bloquer.

#### « compatibility » (Catégorie)
Directives de compatibilité pour phpMussel.

##### « ignore_upload_errors »
- Cette directive doit généralement être DÉSACTIVÉ sauf si cela est nécessaire pour la correcte fonctionnalité de phpMussel sur votre spécifique système. Normalement, lorsque DÉSACTIVÉ, lorsque phpMussel détecte la présence d'éléments dans le `$_FILES`() tableau, il va tenter de lancer une analyse du fichiers que ces éléments représentent, et, si ces éléments sont vide, phpMussel retourne un message d'erreur. Ce comportement est normal pour phpMussel. Mais, pour certains CMS, vides éléments dans `$_FILES` peuvent survenir à la suite du naturel comportement de ces CMS, ou erreurs peuvent être signalés quand il ne sont pas tout, dans ce cas, le normal comportement pour phpMussel seront interférer avec le normal comportement de ces CMS. Si telle une situation se produit pour vous, ACTIVATION de cette option sera instruire phpMussel ne pas à tenter de lancer d'analyses pour ces vides éléments, ignorer quand il est reconnu et ne pas à retourner tout de connexes messages d'erreur, permettant ainsi la continuation de la requête de page. False = DÉSACTIVÉ ; True = ACTIVÉ.

##### « only_allow_images »
- Si vous seulement attendre ou vouloir d'autoriser images à être téléchargé sur votre système ou CMS, et si vous absolument n'avez pas besoin tous les fichiers autres que les images à être téléchargé sur votre système ou CMS, cette directive devrait être ACTIVÉ, mais devrait autrement être DÉSACTIVÉ. Si cette directive est ACTIVÉ, il va instruire phpMussel à bloquer indistinctement tous téléchargements identifié comme non image fichiers, sans analyser. Cela peut réduire le temps de travail et l'utilisation de la mémoire pour les tentativé téléchargements de non image fichiers. False = DÉSACTIVÉ ; True = ACTIVÉ.

#### « heuristic » (Catégorie)
Directives heuristiques pour phpMussel.

##### « threshold »
- Il ya certaines signatures des phpMussel qui sont destinés à identifier des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement sans en eux-mêmes identifier les fichiers en cours de téléchargement spécifiquement comme étant malveillants. Cette « threshold » (seuil) valeur raconte à phpMussel ce que le total maximum poids des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement pour ce qui est admissible avant que ces fichiers doivent être signalées comme malveillant. La définition du poids dans ce contexte est le nombre total de suspectes et potentiellement malveillants qualités identifié. Par défaut, cette valeur sera fixée à 3. Une valeur inférieur va résulter généralement avec une fréquence supérieur de faux positifs mais une nombre supérieur de fichiers signalé comme malveillant, tandis que une valeur inférieur va résulter généralement avec une fréquence inférieur de faux positifs mais un nombre inférieur de fichiers signalé comme malveillant. Il est généralement préférable de laisser cette valeur à sa valeur défaut, sauf si vous rencontrez des problèmes qui sont liés à elle.

#### « virustotal » (Catégorie)
Configuration pour Virus Total intégration.

##### « vt_public_api_key »
- Facultativement, phpMussel est capable d'analyser les fichiers en utilisant le Virus Total API comme un moyen de fournir un renforcée niveau de protection contre les virus, trojans, logiciels malveillants et autres menaces. Par défaut, l'analyse des fichiers en utilisant le Virus Total API est désactivé. Pour activer, une Total Virus API clé est nécessaire. En raison de le significative avantage que cela pourrait fournir pour vous, il est quelque chose que je recommande fortement pour l'activer. S'il vous plaît être conscient, cependant, que pour utiliser le Virus Total API, vous _**DEVEZ**_ accepter leurs conditions d'utilisation (Terms of Service) et vous _**DEVEZ**_ respecter toutes les directives selon décrit par la documentation Virus Total ! Vous N'ÊTES PAS autorisé à utiliser cette fonctionnalité SAUF SI :
  - Vous avez lu et accepté les Conditions d'Utilisation (Terms of Service) de Total Virus et son API. Les Conditions d'Utilisation de Total Virus et son API peut être trouvé [Ici](https://www.virustotal.com/en/about/terms-of-service/).
  - Vous avez lu et vous comprendre, au minimum, le préambule du Virus Total Publique API documentation (tout ce qui suit « VirusTotal Public API v2.0 » mais avant « Contents »). Le Virus Total Publique API documentation peut être trouvé [Ici](https://www.virustotal.com/en/documentation/public-api/).

Noter : Si l'analyse des fichiers en utilisant le Virus Total API est désactivé, vous ne serez pas besoin de revoir tout des directives dans cette catégorie (`virustotal`), parce qu'aucun d'eux ne fait rien si cette option est désactivée. Pour acquérir une Virus Total API clé, à partir de quelque part sur leur site web, cliquez sur le lien « Rejoindre notre communauté » situé vers le haut à droite de la page, saisissez les informations demandées, et cliquez sur « S'enregistrer » quand vous avez terminé. Suivez toutes les instructions fournies, et quand vous avez votre publique API clé, copier/coller cette publique API clé à la `vt_public_api_key` directive du `config.ini` fichier de configuration.

##### « vt_suspicion_level »
- Par défaut, phpMussel va restreindre les fichiers de l'analyse utilisant le Virus Total API à ces fichiers qu'il juges comme soupçonneux. Facultativement, vous pouvez régler cette restriction par changeant la valeur de la `vt_suspicion_level` directive.
- `0` : Fichiers sont seulement considérées comme soupçonneux si, quand étant analysé par phpMussel utilisant ses propres signatures, ils sont réputés pour porter un poids heuristique. Cela signifierait effectivement que l'utilisation du Virus Total API serait être pour une deuxième opinion pour quand phpMussel soupçonne qu'un fichier peut être potentiellement malveillants, mais ne peut pas entièrement exclu que il peut aussi potentiellement être bénigne (non malveillant) et donc serait autrement normalement pas bloquer ou signaler qu'il est malveillant.
- `1` : Fichiers sont considérés comme soupçonneux si, quand étant analysé par phpMussel utilisant ses propres signatures, ils sont réputés pour porter un poids heuristique, si elles sont connues pour être exécutable (PE fichiers, Mach-O fichiers, ELF/Linux fichiers, etc), ou s'ils sont connus pour être d'une forme qui pourrait contenir exécutable données (tels comme exécutable macros, DOC/DOCX fichiers, archive fichiers tels comme RARs, ZIPS et etc). C'est la valeur par défaut et le niveau de suspicion recommandé d'appliquer, qui signifie effectivement que l'utilisation du Virus Total API serait être pour une deuxième opinion pour quand initialement phpMussel ne peut pas trouver quoi que malveillant ou problématique avec un fichier qu'il considère comme soupçonneux et donc serait autrement normalement pas bloquer ou signaler qu'il est malveillant.
- `2` : Tous fichiers sont considérés comme soupçonneux et doivent être analysés utiliser le Virus Total API. Généralement, je ne recommande pas d'appliquer ce niveau de suspicion, en raison du risque d'atteindre votre API quota beaucoup plus rapide que ce serait autrement être le cas, mais il ya certaines circonstances (comme quand le webmaster ou hostmaster possède très peu foi ou confiance concernant le téléchargé contenu de leurs utilisateurs) où ce niveau de suspicion pourrait être approprié. Avec ce niveau de suspicion, tous fichiers que ne sont pas normalement bloquée ou signalés comme étant malveillants serait être analysé par le Virus Total API. Noter, cependant, que phpMussel sera cesser l'utiliser du Virus Total API quand votre API quota a été atteint (indépendamment du niveau de suspicion), et que votre quota sera probablement être atteint beaucoup plus rapidement quand vous utilisez ce niveau de suspicion.

Noter : Indépendamment du niveau de suspicion, tous les fichiers qui sont sur la liste noire ou liste blanche soit pour phpMussel ne seront pas analysés en utilisant le Virus API total, parce que ces fichiers seraient ont déjà été déclarés comme soit malveillant ou bénigne par phpMussel avant le moment où ils auraient autrement été analysés par le Virus Total API, et donc, analyser supplémentaire ne serait pas être nécessaire. La capacité de phpMussel pour analyser les fichiers en utilisant le Virus Total API est destiné à renforcer la confiance pour savoir si un fichier est malveillant ou bénigne dans les circonstances où phpMussel lui-même est pas tout à fait certain quant à savoir si un fichier est malveillant ou bénigne.

##### « vt_weighting »
- Devrais phpMussel appliquer les résultats de l'analyse en utilisant le Virus Total API comme détections ou comme pondération de détection ? Cette directive existe, parce que, quoique analyse d'un fichier à l'aide de plusieurs moteurs (comme Virus Total fait) devrait résulter en un augmenté taux de détection (et donc en un plus grand nombre de fichiers malveillants être détectés), il peut également résulter en un plus grand nombre de faux positifs, et donc, dans certaines circonstances, les résultats de l'analyse peuvent être mieux utilisées comme un score de confiance plutôt que comme une conclusion définitive. Si la valeur 0 est utilisée, les résultats de l'analyse en utilisant le Virus Total API seront être appliquées comme détections, et donc, si quelconque moteur utilisé par Virus Total marques le fichier analysé comme étant malveillants, phpMussel va considérer le fichier comme malveillant. Si quelconque autre valeur est utilisée, les résultats de l'analyse en utilisant le Virus Total API sera appliquée comme pondération de détection, et donc, le nombre de moteurs utilisés par Total Virus que marque le fichier analysé comme étant malveillant sera servir un score de confiance (ou une pondération de détection) pour savoir si ou non le fichier êtant analysé devrait être considéré comme malveillant par phpMussel (la valeur utilisée représentera le minimum score de confiance ou le poids requis pour être considéré comme malveillant). Une valeur de 0 est utilisée par défaut.

« vt_quota_rate » et « vt_quota_time »
- Selon le Virus Total API documentation, elle est limitée à au plus 4 demandes de toute nature dans un laps de 1 minute de temps. Si vous exécutez un honeyclient, honeypot ou autre automatisation qui va fournir les ressources pour Virus Total et pas seulement récupérer des rapports vous avez droit à un plus élevée demande quota. Par défaut, phpMussel va adhérer strictement à ces limitations, mais en raison de la possibilité de ces quotas étant augmenté, ces deux directives sont fournies comme un moyen pour vous d'instruire phpMussel à quelle limite il faut adhérer. Sauf si vous avez été invité à le faire, on ne recommande pas pour vous d'augmenter ces valeurs, mais, si vous avez rencontré des problèmes relatifs à atteindre votre quota, diminuant ces valeurs _**PEUT**_ parfois vous aider dans le traitement de ces problèmes. Votre quota est déterminée comme `vt_quota_rate` demandes de toute nature dans un laps de `vt_quota_time` minute de temps.

#### « urlscanner » (Catégorie)
Un scanner d'URL est inclus avec phpMussel, capable de détecter les URLs malveillantes à partir de toutes les données ou fichiers analysés.

Noter : Si le scanner d'URLs est désactivé, vous ne serez pas besoin de revoir quelconque du directives dans cette catégorie (`urlscanner`), parce qu'aucun d'eux avoir une fonction si cette directive est désactivée.

Configuration du scanner d'URLs API chercher.

##### « lookup_hphosts »
- Permet cherches de l'API [hpHosts](http://hosts-file.net/) quand définit comme true. hpHosts ne nécessite pas une clé de l'API pour effectuer des cherches de l'API.

##### « google_api_key »
- Permet cherches de l'API Google Safe Browsing quand l'API clé nécessaire est définie. API Google Safe Browsing cherches nécessite une clé de l'API, qui peut être obtenu à partir [d'ici](https://console.developers.google.com/).
- Noter : L'extension cURL est nécessaire pour la utiliser de cette fonctionnalité.

##### « maximum_api_lookups »
- Nombre de cherches maximal de l'API pour effectuer par itération d'analyse individuelle. Parce que chaque API cherche supplémentaire va ajouter à la durée totale requise pour compléter chaque itération d'analyse, vous pouvez prévoir une limitation afin d'accélérer le processus d'analyse. Quand défini comme 0, pas de telles nombre maximum admissible sera appliquée. Défini comme 10 par défaut.

##### « maximum_api_lookups_response »
- Que faire si le nombre de cherches de l'API maximal est dépassée ? False = Ne fais rien (poursuivre le traitement) [Défaut] ; True = Marque/bloquer le fichier.

##### « cache_time »
- Combien de temps (en secondes) devrait les résultats du cherches de l'API être conservé dans le cache ? Défaut est 3600 secondes (1 heure).

#### « legal » (Catégorie)
Configuration relative aux exigences légales.

*Pour plus d'informations sur les exigences légales et comment cela peut affecter vos exigences de configuration, veuillez vous référer à la section « [INFORMATION LÉGALE](#SECTION11) » de la documentation.*

##### « pseudonymise_ip_addresses »
- Pseudonymiser les adresses IP lors de la journalisation ? True = Oui ; False = Non [Défaut].

##### « privacy_policy »
- L'adresse d'une politique de confidentialité pertinente à afficher dans le pied de page des pages générées. Spécifier une URL, ou laisser vide à désactiver.

#### « template_data » (Catégorie)
Directives/Variables pour les modèles et thèmes.

Modèles données est liée à la sortie HTML utilisé pour générer le message « Téléchargement Refusé » affiché aux utilisateurs sur un fichier téléchargement est bloqué. Si vous utilisez des thèmes personnalisés pour phpMussel, sortie HTML provient du `template_custom.html` fichier, et sinon, sortie HTML provient du `template.html` fichier. Variables écrites à cette section du fichier de configuration sont préparé pour la sortie HTML par voie de remplacer tous les noms de variables circonfixé par accolades trouvés dans la sortie HTML avec les variables données correspondant. Par exemple, où `foo="bar"`, toute instance de `<p>{foo}</p>` trouvés dans la sortie HTML deviendra `<p>bar</p>`.

##### « theme »
- Le thème à utiliser par défaut pour phpMussel.

##### « Magnification »
- Grossissement des fontes. Défaut = 1.

##### « css_url »
- Le modèle fichier pour des thèmes personnalisés utilise les propriétés CSS externes, tandis que le modèle fichier pour le défaut thème utilise les propriétés CSS internes. Pour instruire phpMussel d'utiliser le modèle fichier pour des thèmes personnalisés, spécifier l'adresse HTTP public de votre thèmes personnalisés CSS fichiers utilisant le `css_url` variable. Si vous laissez cette variable vide, phpMussel va utiliser le modèle fichier pour le défaut thème.

#### « PHPMailer » (Catégorie)
Configuration de PHPMailer.

##### « EventLog »
- Fichier pour l'enregistrement de tous les événements relatifs à PHPMailer. Spécifier un fichier, ou laisser vide à désactiver.

##### « SkipAuthProcess »
- Définir cette directive sur `true` instruit à PHPMailer de sauter le processus d'authentification qui se produit normalement lors de l'envoi d'e-mail via SMTP. Cela doit être évité, car sauter du processus peut exposer l'e-mail sortant aux attaques MITM, mais peut être nécessaire dans les cas où ce processus empêche PHPMailer de se connecter à un serveur SMTP.

##### « Enable2FA »
- Cette directive détermine s'il faut utiliser 2FA pour les comptes frontaux.

##### « Host »
- Hôte SMTP à utiliser pour les e-mails sortants.

##### « Port »
- Le numéro de port à utiliser pour l'e-mail sortant. Défaut = 587.

##### « SMTPSecure »
- Le protocole à utiliser lors de l'envoi d'e-mail via SMTP (TLS ou SSL).

##### « SMTPAuth »
- Cette directive détermine si les sessions SMTP doivent être authentifiées (elles doivent généralement être laissées seules).

##### « Username »
- Le nom d'utilisateur à utiliser lors de l'envoi d'e-mail via SMTP.

##### « Password »
- Le mot de passe à utiliser lors de l'envoi d'e-mail via SMTP.

##### « setFromAddress »
- L'adresse de l'expéditeur à citer lors de l'envoi d'e-mail via SMTP.

##### « setFromName »
- Le nom de l'expéditeur à citer lors de l'envoi d'e-mail via SMTP.

##### « addReplyToAddress »
- L'adresse de réponse à citer lors de l'envoi d'e-mail via SMTP.

##### « addReplyToName »
- Le nom pour répondre à citer lors de l'envoi d'e-mail via SMTP.

---


### 8. <a name="SECTION8"></a>FORMATS DE SIGNATURES

*Voir également :*
- *[Qu'est-ce qu'une « signature » ?](#WHAT_IS_A_SIGNATURE)*

Les 9 premiers octets `[x0-x8]` d'un fichier des signatures de phpMussel sont `phpMussel`, et agir comme un « numéro magique » (magic number), afin de les identifier en tant que fichiers de signature (cela aide à empêcher phpMussel de tenter accidentellement d'utiliser des fichiers qui ne sont pas des fichiers de signature). L'octet suivant `[x9]` identifie le type de fichier des signatures, que phpMussel doit savoir pour pouvoir interpréter correctement le fichier de signatures. Les types de fichiers de signatures suivants sont reconnus :

Type | Octet | Description
---|---|---
`General_Command_Detections` | `0?` | Pour les fichiers de signatures utilisant CSV (valeurs séparées par des virgules). Les valeurs (signatures) sont des chaînes codées en hexadécimal pour rechercher dans les fichiers. Les signatures ici n'ont aucun nom ou d'autres détails (seulement la chaîne à détecter).
`Filename` | `1?` | Pour les signatures des noms de fichiers.
`Hash` | `2?` | Pour les signatures de hachage.
`Standard` | `3?` | Pour les fichiers de signatures qui fonctionnent directement avec le contenu du fichiers.
`Standard_RegEx` | `4?` | Pour les fichiers de signatures qui fonctionnent directement avec le contenu du fichiers. Les signatures peuvent contenir des expressions régulières.
`Normalised` | `5?` | Pour les fichiers de signatures qui fonctionnent avec le contenu de fichiers normalisés par ANSI.
`Normalised_RegEx` | `6?` | Pour les fichiers de signatures qui fonctionnent avec le contenu de fichiers normalisés par ANSI. Les signatures peuvent contenir des expressions régulières.
`HTML` | `7?` | Pour les fichiers de signatures qui fonctionnent avec le contenu de fichiers normalisés par HTML.
`HTML_RegEx` | `8?` | Pour les fichiers de signatures qui fonctionnent avec le contenu de fichiers normalisés par HTML. Les signatures peuvent contenir des expressions régulières.
`PE_Extended` | `9?` | Pour les fichiers de signatures qui fonctionnent avec des métadonnées PE (autres que les métadonnées PE sectionnelle).
`PE_Sectional` | `A?` | Pour les fichiers de signatures qui fonctionnent avec des métadonnées PE sectionnelle.
`Complex_Extended` | `B?` | Pour les fichiers de signatures qui fonctionnent avec diverses règles basées sur les métadonnées étendues générées par phpMussel.
`URL_Scanner` | `C?` | Pour les fichiers de signatures qui fonctionnent avec les URLs.

L'octet suivant `[x10]` est une nouvelle ligne `[0A]`, et conclut l'en-tête du fichier des signatures de phpMussel.

Chaque ligne non vide par la suite est une signature ou une règle. Chaque signature ou règle occupe une seule ligne. Les formats de signatures supportées sont décrits ci-dessous.

#### *SIGNATURES POUR LES NOMS DE FICHIERS*
Toutes les signatures pour les noms de fichiers suivez le format :

`NOM:FNRX`

Où NOM est le nom à citer pour la signature et FNRX est l'expression régulière pour faire correspondre les (non codé) noms de fichiers.

#### *SIGNATURES HASH*
Toutes les signatures HASH suivez le format :

`HASH:TAILLE:NOM`

Où HASH est le hachage (généralement MD5) d'un ensemble du fichier, TAILLE est la totale taille du fichier et NOM est le nom à citer pour la signature.

#### *SIGNATURES PE SECTIONNELLE*
Toutes les signatures PE sectionnelle suivez le format :

`TAILLE:HASH:NOM`

Où HASH est le hachage MD5 d'un section du PE fichier, TAILLE est la totale taille de cet section et NOM est le nom à citer pour la signature.

#### *SIGNATURES PE ÉTENDUES*
Toutes les signatures PE étendues suivez le format :

`$VAR:HASH:TAILLE:NOM`

Où $VAR est le nom de la PE variable à comparer contre, HASH est le MD5 hachage de cette variable, TAILLE est la taille totale de cette variable et NOM est le nom de à pour cette signature.

#### *SIGNATURES COMPLEXES ÉTENDUES*
Signatures complexes étendues sont assez différentes pour les autres types de signatures possible avec phpMussel, dans que ce qu'ils vérifient contre est spécifié par les signatures elles-mêmes et ils peuvent vérifier contre plusieurs critères. Les critères sont délimitées par « ; » et le type et les données de chacun critères est délimitée par « : » comme ainsi le format de ces signatures tendances à semble un peu comme :

`$variable1:CERTAINSDONNÉES;$variable2:CERTAINSDONNÉES;SignatureNom`

#### *TOUT LE RESTE*
Toutes les autres signatures suivez le format :

`NOM:HEX:FROM:TO`

Où NOM est le nom à citer pour la signature et HEX est un hexadécimal codé segment du fichier destiné à être identifié par la signature donnée. FROM et TO sont optionnel paramètres, indication de laquelle et à laquelle les positions dans les source données pour vérifier contre.

#### *REGEX (REGULAR EXPRESSIONS)*
Toute forme de regex comprise et préparé correctement par PHP devrait aussi être correctement compris et préparé par phpMussel et ses signatures. Mais, je vous suggère de prendre une extrême prudence lors de l'écriture de nouvelles regex basé signatures, parce, si vous n'êtes pas entièrement sûr de ce que vous faites, il peut y avoir très irréguliers et/ou inattendus résultats. Jetez un oeil à la phpMussel source code si vous n'êtes pas entièrement sûr sur le contexte dans lequel regex déclarations sont analysés. Aussi, rappeler toutes les déclarations (à l'exception de nom de fichier, métadonnées d'archives et MD5 déclarations) doit être de codé de hexadécimale (à l'exception de déclaration syntaxe, bien sûr) !

---


### 9. <a name="SECTION9"></a>PROBLÈMES DE COMPATIBILITÉ CONNUS

#### PHP et PCRE
- phpMussel requérir PHP et PCRE à signer et à fonctionner correctement. Sans PHP, ou sans le PCRE extension de PHP, phpMussel n'exécutera pas ou fonctionnent correctement. Devrait s'assurer que votre système avoir PHP et PCRE installé et disponible avant de votre téléchargement et installation de phpMussel.

#### LOGICIELS ANTI-VIRUS COMPATIBILITÉ

Pour la plupart, phpMussel devrait être assez compatible avec plupart du virus détection logiciels. Cependant, conflictualités ont été signalés par un nombre d'utilisateurs dans le passé. Cette information ci-dessous est VirusTotal.com, et il décrit un certain nombre de faux positifs signalé par divers anti-virus programmes contre phpMussel. Bien que cette information ne constitue pas une absolue garantie de si oui ou non vous rencontrerez des problèmes de compatibilité entre phpMussel et votre anti-virus logiciel, si votre logiciel anti-virus est noté comme signalant contre phpMussel, vous devriez envisager désactivation avant à travailler avec phpMussel ou devrait envisager d'autres options soit votre logiciel anti-virus ou phpMussel.

Cette information a été mise à jour 2018.10.09 et est courant pour toutes les phpMussel parutions des deux plus récentes mineures versions (v1.5.0-v1.6.0) au moment de la rédaction de cette.

*Cette information s'applique uniquement au paquet principal. Les résultats peuvent varier en fonction des fichiers de signature installés, des plugins, et d'autres composants périphériques.*

| Scanner | Résultats |
|---|---|
| Bkav | Rapports « VEX.Webshell » |

---


### 10. <a name="SECTION10"></a>QUESTIONS FRÉQUEMMENT POSÉES (FAQ)

- [Qu'est-ce qu'une « signature » ?](#WHAT_IS_A_SIGNATURE)
- [Qu'est-ce qu'un « faux positif » ?](#WHAT_IS_A_FALSE_POSITIVE)
- [À quelle fréquence les signatures sont-elles mises à jour ?](#SIGNATURE_UPDATE_FREQUENCY)
- [J'ai rencontré un problème lors de l'utilisation de phpMussel et je ne sais pas quoi faire à ce sujet ! Aidez-moi !](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Je veux utiliser phpMussel avec une version PHP plus ancienne que 5.4.0 ; Pouvez-vous m'aider ?](#MINIMUM_PHP_VERSION)
- [Puis-je utiliser une seule installation de phpMussel pour protéger plusieurs domaines ?](#PROTECT_MULTIPLE_DOMAINS)
- [Je ne veux pas déranger avec l'installation de cela et le faire fonctionner avec mon site ; Puis-je vous payer pour tout faire pour moi ?](#PAY_YOU_TO_DO_IT)
- [Puis-je vous embaucher ou à l'un des développeurs de ce projet pour un travail privé ?](#HIRE_FOR_PRIVATE_WORK)
- [J'ai besoin de modifications spécialisées, de personnalisations, etc ; Êtes-vous en mesure d'aider ?](#SPECIALIST_MODIFICATIONS)
- [Je suis un développeur, un concepteur de site Web ou un programmeur. Puis-je accepter ou offrir des travaux relatifs à ce projet ?](#ACCEPT_OR_OFFER_WORK)
- [Je veux contribuer au projet ; Puis-je faire cela ?](#WANT_TO_CONTRIBUTE)
- [Comment accéder à des détails spécifiques sur les fichiers lorsqu'ils sont analysés ?](#SCAN_DEBUGGING)
- [Puis-je utiliser cron pour mettre à jour automatiquement ?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [Est-ce que phpMussel peut analyser des fichiers avec des noms non-ANSI ?](#SCAN_NON_ANSI)
- [Listes noires – Listes blanches – Listes grises – Quels sont-ils, et comment puis-je les utiliser ?](#BLACK_WHITE_GREY)
- [Lorsque j'activer ou désactiver des fichiers de signatures via la page des mises à jour, il les trie de manière alphanumérique dans la configuration. Puis-je changer la façon dont ils sont triés ?](#CHANGE_COMPONENT_SORT_ORDER)

#### <a name="WHAT_IS_A_SIGNATURE"></a>Qu'est-ce qu'une « signature » ?

Dans le contexte de phpMussel, une « signature » réfère à les données qui servent comme d'indicateur ou d'identifiant pour quelque chose spécifique que nous recherchons, généralement sous la forme d'un segment très petit, distinct et inoffensif de quelque chose plus grand et autrement nuisible, comme un virus ou un trojan, ou sous la forme d'une somme de contrôle, d'un hash ou d'un autre indicateur d'identification similaire, et généralement comprend une étiquette, et d'autres données pour aider à fournir certains contexte supplémentaire qui peut être utilisé par phpMussel pour déterminer la meilleure façon de procéder quand il rencontre ce que nous recherchons.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>Qu'est-ce qu'un « faux positif » ?

Le terme « faux positif » (*alternativement : « erreur faux positif » ; « fausse alarme »* ; Anglais : *false positive* ; *false positive error* ; *false alarm*), décrit très simplement, et dans un contexte généralisé, est utilisé lors de tester pour une condition, de se référer aux résultats de ce test, lorsque les résultats sont positifs (c'est à dire, lorsque la condition est déterminée comme étant « positif », ou « vrai »), mais ils devraient être (ou aurait dû être) négatif (c'est à dire, lorsque la condition, en réalité, est « négatif », ou « faux »). Un « faux positif » pourrait être considérée comme analogue à « crier au loup » (où la condition testée est de savoir s'il y a un loup près du troupeau, la condition est « faux » en ce que il n'y a pas de loup près du troupeau, et la condition est signalé comme « positif » par le berger par voie de crier « loup ! loup ! »), ou analogues à des situations dans des tests médicaux dans lequel un patient est diagnostiqué comme ayant une maladie, alors qu'en réalité, ils ont pas une telle maladie.

Résultats connexes lors de tester pour une condition peut être décrit en utilisant les termes « vrai positif », « vrai négatif » et « faux négatif ». Un « vrai positif » se réfère à quand les résultats du test et l'état actuel de la condition sont tous deux vrai (ou « positif »), and a « vrai négatif » se réfère à quand les résultats du test et l'état actuel de la condition sont tous deux faux (ou « négatif ») ; Un « vrai positif » ou « vrai négatif » est considéré comme une « inférence correcte ». L'antithèse d'un « faux positif » est un « faux négatif » ; Un « faux négatif » se réfère à quand les résultats du test are négatif (c'est à dire, la condition est déterminée comme étant « négatif », ou « faux »), mais ils devraient être (ou aurait dû être) positif (c'est à dire, la condition, en réalité, est « positif », ou « vrai »).

Dans le contexte de phpMussel, ces termes réfèrent à les signatures de phpMussel et les fichiers qu'ils bloquent. Quand phpMussel bloque un fichier en raison du mauvais, obsolète ou signatures incorrectes, mais ne devrait pas l'avoir fait, ou quand il le fait pour les mauvaises raisons, nous référons à cet événement comme un « faux positif ». Quand phpMussel ne parvient pas à bloquer un fichier qui aurait dû être bloqué, en raison de menaces imprévues, signatures manquantes ou déficits dans ses signatures, nous référons à cet événement comme un « détection manquée » ou « missed detection » (qui est analogue à un « faux négatif »).

Ceci peut être résumé par le tableau ci-dessous :

&nbsp; | phpMussel ne devrait *PAS* bloquer un fichier | phpMussel *DEVRAIT* bloquer un fichier
---|---|---
phpMussel ne bloque *PAS* un fichier | Vrai négatif (inférence correcte) | Détection manquée (analogue à faux négatif)
phpMussel bloque un fichier | __Faux positif__ | Vrai positif (inférence correcte)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>À quelle fréquence les signatures sont-elles mises à jour ?

La fréquence de mise à jour varie selon les fichiers de signature en question. Tous les mainteneurs des fichiers de signature pour phpMussel tentent généralement de conserver leurs signatures aussi à jour que possible, mais comme nous avons tous divers autres engagements, nos vies en dehors du projet, et comme aucun de nous n'est rémunéré financièrement (ou payé) pour nos efforts sur le projet, un planning de mise à jour précis ne peut être garanti. Généralement, les signatures sont mises à jour chaque fois qu'il y a suffisamment de temps pour les mettre à jour. L'assistance est toujours appréciée si vous êtes prêt à en offrir.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>J'ai rencontré un problème lors de l'utilisation de phpMussel et je ne sais pas quoi faire à ce sujet ! Aidez-moi !

- Utilisez-vous la dernière version du logiciel ? Utilisez-vous les dernières versions de vos fichiers de signature ? Si la réponse à l'une ou l'autre de ces deux est non, essayez de tout mettre à jour tout d'abord, et vérifier si le problème persiste. Si elle persiste, continuez à lire.
- Avez-vous vérifié toute la documentation ? Si non, veuillez le faire. Si le problème ne peut être résolu en utilisant la documentation, continuez à lire.
- Avez-vous vérifié la **[page des issues](https://github.com/phpMussel/phpMussel/issues)**, pour voir si le problème a été mentionné avant ? Si on l'a mentionné avant, vérifier si des suggestions, des idées et/ou des solutions ont été fournies, et suivez comme nécessaire pour essayer de résoudre le problème.
- Si le problème persiste, s'il vous plaît demander de l'aide à ce sujet en créant un nouveau issue sur la page des issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Je veux utiliser phpMussel avec une version PHP plus ancienne que 5.4.0 ; Pouvez-vous m'aider ?

Non. PHP 5.4.0 a atteint officiellement l'EoL (« End of Life », ou fin de vie) en 2014, et le support étendu en matière de sécurité a pris fin en 2015. À la date d'écriture, il est 2017, et PHP 7.1.0 est déjà disponible. À l'heure actuelle, le support est fourni pour l'utilisation de phpMussel avec PHP 5.4.0 et toutes les nouvelles versions PHP disponibles, mais si vous essayez d'utiliser phpMussel avec les anciennes versions PHP, le support ne sera pas fourni.

*Voir également : [Tableaux de Compatibilité](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Puis-je utiliser une seule installation de phpMussel pour protéger plusieurs domaines ?

Oui. Les installations phpMussel ne sont pas naturellement verrouillées dans des domaines spécifiques, et peut donc être utilisé pour protéger plusieurs domaines. Généralement, nous référons aux installations phpMussel protégeant un seul domaine comme « installations à un seul domaine » (« single-domain installations »), et nous référons aux installations phpMussel protégeant plusieurs domaines et/ou sous-domaines comme « installations multi-domaines » (« multi-domain installations »). Si vous utilisez une installation multi-domaine et besoin d'utiliser différents ensembles de fichiers de signature pour différents domaines, ou besoin de phpMussel pour être configuré différemment pour différents domaines, il est possible de le faire. Après avoir chargé le fichier de configuration (`config.ini`), phpMussel vérifiera l'existence d'un « fichier de substitution de configuration » spécifique au domaine (ou sous-domaine) demandé (`le-domaine-demandé.tld.config.ini`), et si trouvé, les valeurs de configuration définies par le fichier de substitution de configuration sera utilisé pour l'instance d'exécution au lieu des valeurs de configuration définies par le fichier de configuration. Les fichiers de substitution de configuration sont identiques au fichier de configuration, et à votre discrétion, peut contenir l'intégralité de toutes les directives de configuration disponibles pour phpMussel, ou quelle que soit la petite sous-section requise qui diffère des valeurs normalement définies par le fichier de configuration. Les fichiers de substitution de configuration sont nommée selon le domaine auquel elle est destinée (donc, par exemple, si vous avez besoin d'une fichier de substitution de configuration pour le domaine, `http://www.some-domain.tld/`, sa fichier de substitution de configuration doit être nommé comme `some-domain.tld.config.ini`, et devrait être placé dans la vault à côté du fichier de configuration, `config.ini`). Le nom de domaine pour l'instance d'exécution dérive de l'en-tête `HTTP_HOST` de la requête ; « www » est ignoré.

#### <a name="PAY_YOU_TO_DO_IT"></a>Je ne veux pas déranger avec l'installation de cela et le faire fonctionner avec mon site ; Puis-je vous payer pour tout faire pour moi ?

Peut-être. Ceci est considéré au cas par cas. Faites-nous savoir ce dont vous avez besoin, ce que vous offrez, et nous vous informerons si nous pouvons vous aider.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Puis-je vous embaucher ou à l'un des développeurs de ce projet pour un travail privé ?

*Voir au dessus.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>J'ai besoin de modifications spécialisées, de personnalisations, etc ; Êtes-vous en mesure d'aider ?

*Voir au dessus.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Je suis un développeur, un concepteur de site Web ou un programmeur. Puis-je accepter ou offrir des travaux relatifs à ce projet ?

Oui. Notre licence ne l'interdit pas.

#### <a name="WANT_TO_CONTRIBUTE"></a>Je veux contribuer au projet ; Puis-je faire cela ?

Oui. Les contributions au projet sont les bienvenues. Voir « CONTRIBUTING.md » pour plus d'informations.

#### <a name="SCAN_DEBUGGING"></a>Comment accéder à des détails spécifiques sur les fichiers lorsqu'ils sont analysés ?

Vous pouvez accéder à des détails spécifiques sur les fichiers lorsqu'ils sont analysés en attribuant un tableau à utiliser à cet effet avant de demander à phpMussel de les analyser.

Dans l'exemple ci-dessous, `$Foo` est utilisé à cette fin. Après avoir analysé `/chemin/du/fichier/...`, des informations détaillées sur les fichiers contenus dans `/chemin/du/fichier/...` seront contenues par `$Foo`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/chemin/du/fichier/...');

var_dump($Foo);
```

Le tableau est un tableau multidimensionnel composé d'éléments représentant chaque fichier analysé et des sous-éléments représentant les détails de ces fichiers. Ces sous-éléments sont les suivants :

- Filename (`string`)
- FromCache (`bool`)
- Depth (`int`)
- Size (`int`)
- MD5 (`string`)
- SHA1 (`string`)
- CRC32B (`string`)
- 2CC (`string`)
- 4CC (`string`)
- ScanPhase (`string`)
- Container (`string`)
- † FileSwitch (`string`)
- † Is_ELF (`bool`)
- † Is_Graphics (`bool`)
- † Is_HTML (`bool`)
- † Is_Email (`bool`)
- † Is_MachO (`bool`)
- † Is_PDF (`bool`)
- † Is_SWF (`bool`)
- † Is_PE (`bool`)
- † Is_Not_HTML (`bool`)
- † Is_Not_PHP (`bool`)
- ‡ NumOfSections (`int`)
- ‡ PEFileDescription (`string`)
- ‡ PEFileVersion (`string`)
- ‡ PEProductName (`string`)
- ‡ PEProductVersion (`string`)
- ‡ PECopyright (`string`)
- ‡ PEOriginalFilename (`string`)
- ‡ PECompanyName (`string`)
- Results (`int`)
- Output (`string`)

*† - Non fourni avec les résultats mis en cache (fourni pour les résultats d'analyse nouveaux seulement).*

*‡ - Fourni lors de l'analyse des fichiers PE seulement.*

En option, ce tableau peut être détruit en utilisant ce qui suit :

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Puis-je utiliser cron pour mettre à jour automatiquement ?

Oui. Une API est intégrée dans le frontal pour interagir avec la page des mises à jour via des scripts externes. Un script séparé, « [Cronable](https://github.com/Maikuolan/Cronable) », est disponible, et peut être utilisé par votre gestionnaire de cron ou cron scheduler pour mettre à jour ce paquet et d'autres paquets supportés automatiquement (ce script fournit sa propre documentation).

#### <a name="SCAN_NON_ANSI"></a>Est-ce que phpMussel peut analyser des fichiers avec des noms non-ANSI ?

Disons qu'il y a un répertoire que vous voulez scanner. Dans ce répertoire, vous avez des fichiers avec des noms non-ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Supposons que vous utilisez le mode CLI ou l'API phpMussel pour analyser.

Lors de l'utilisation de PHP < 7.1.0, sur certains systèmes, phpMussel ne verra pas ces fichiers lors de l'analyse du répertoire, et ne pourra donc pas analyser ces fichiers. Vous verrez probablement les mêmes résultats que si vous deviez analyser un répertoire vide :

```
 Sun, 01 Apr 2018 22:27:41 +0800 Commencé.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminé.
```

De plus, lorsque vous utilisez PHP < 7.1.0, l'analyse des fichiers individuellement produit des résultats comme ceux-ci :

```
 Sun, 01 Apr 2018 22:27:41 +0800 Commencé.
 > Vérification 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Fichier non valide !
 Sun, 01 Apr 2018 22:27:41 +0800 Terminé.
```

Ou ceux-ci :

```
 Sun, 01 Apr 2018 22:27:41 +0800 Commencé.
 > X:/directory/??????.txt n'est pas un fichier ou un répertoire.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminé.
```

C'est à cause de la façon dont PHP a traité les noms de fichiers non-ANSI avant PHP 7.1.0. Si vous rencontrez ce problème, la solution consiste à mettre à jour votre installation PHP à 7.1.0 ou plus récent. En PHP >= 7.1.0, les noms de fichiers non-ANSI sont mieux gérés, et phpMussel devrait être capable d'analyser les fichiers correctement.

Pour comparaison, les résultats lors de l'analyse du répertoire en utilisant PHP >= 7.1.0 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 Commencé.
 -> Vérification '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Pas problème trouvé.
 -> Vérification '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Pas problème trouvé.
 -> Vérification '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Pas problème trouvé.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminé.
```

Et en analysant les fichiers individuellement :

```
 Sun, 01 Apr 2018 22:27:41 +0800 Commencé.
 > Vérification 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Pas problème trouvé.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminé.
```

#### <a name="BLACK_WHITE_GREY"></a>Listes noires – Listes blanches – Listes grises – Quels sont-ils, et comment puis-je les utiliser ?

Les termes véhiculent des significations différentes dans différents contextes. Dans phpMussel, il existe trois contextes où ces termes sont utilisés : La réponse à la taille du fichier, la réponse au type du fichier, et la liste grise des signatures.

Afin d'obtenir un résultat souhaité à un coût minimal pour le traitement, il existe des choses simples que phpMussel peut vérifier avant de scanner les fichiers, tels que la taille, le nom et l'extension d'un fichier. Par exemple ; Si un fichier est trop volumineux, ou si son extension indique un type de fichier que nous ne voulons pas autoriser sur nos sites web, nous pouvons signaler le fichier immédiatement et ne pas avoir besoin de le scanner.

La réponse à la taille du fichier correspond à la réponse de phpMussel lorsqu'un fichier dépasse une limite spécifiée. Bien qu'aucune liste ne soit en cause, un fichier peut être considéré comme effectivement mis sur liste noire, sur liste blanche, ou sur liste grise, en fonction de sa taille. Deux directives de configuration facultatives distinctes existent pour spécifier respectivement une limite et la réponse souhaitée.

La réponse au type du fichier est la façon dont phpMussel répond à l'extension du fichier. Trois directives de configuration facultatives distinctes existent pour spécifier explicitement quelles extensions doivent être mises en liste noire, en liste blanche, ou en liste grise. Un fichier peut être considéré comme effectivement mis sur liste noire, sur liste blanche, ou sur liste grise si son extension correspond respectivement à l'une des extensions spécifiées.

Dans ces deux contextes, être sur liste blanche signifie qu'il ne doit pas être scanné ou marqué ; être sur la liste noire signifie qu'il devrait être marqué (et n'a donc pas besoin de le scanner) ; et être sur la liste grise signifie une analyse plus approfondie est nécessaire pour déterminer si nous devrions le marquer (c'est-à-dire, qu'il devrait être scanné).

La liste grise des signatures est une liste de signatures qui devraient être ignorées (ceci est brièvement mentionné plus haut dans la documentation). Quand une signature sur le liste grise des signatures est déclenchée, phpMussel continue à travailler à travers ses signatures et ne prend aucune action particulière en ce qui concerne la signature sur le liste grise. Il n'y a pas de liste noire des signatures, car le comportement implicite est un comportement normal pour les signatures déclenchées en tous cas, et il n'y a pas de liste blanche des signatures, parce que le comportement implicite n'aurait pas vraiment de sens compte tenu du fonctionnement normal de phpMussel et des capacités qu'il possède déjà.

Le liste grise des signatures est utile si vous avez besoin de résoudre des problèmes causés par une signature particulière sans désactiver ou désinstaller le fichier de signatures entier.

#### <a name="CHANGE_COMPONENT_SORT_ORDER"></a>Lorsque j'activer ou désactiver des fichiers de signatures via la page des mises à jour, il les trie de manière alphanumérique dans la configuration. Puis-je changer la façon dont ils sont triés ?

Oui. Si vous devez forcer l'exécution de certains fichiers dans un ordre spécifique, vous pouvez ajouter des données arbitraires avant leurs noms dans la directive de configuration où elles sont listées, séparées par un signe deux-points. Lorsque la page des mises à jour trie à nouveau les fichiers, ces données arbitraires ajoutées affectent l'ordre de tri, en leur faisant par conséquent exécuter dans l'ordre que vous voulez, sans avoir besoin de renommer l'un d'entre eux.

Par exemple, en supposant une directive de configuration avec des fichiers listés comme suit :

`file1.php,file2.php,file3.php,file4.php,file5.php`

Si vous voulez que `file3.php` s'exécute en premier, vous pouvez ajouter quelque chose comme `aaa:` avant le nom du fichier :

`file1.php,file2.php,aaa:file3.php,file4.php,file5.php`

Ensuite, si un nouveau fichier, `file6.php`, est activé, lorsque la page des mises à jour les trie à nouveau, elle devrait se terminer comme suit :

`aaa:file3.php,file1.php,file2.php,file4.php,file5.php,file6.php`

Inversement, si vous voulez que le fichier s'exécute en dernier, vous pouvez ajouter quelque chose comme `zzz:` avant le nom du fichier. Dans tous les cas, vous n'aurez pas besoin de renommer le fichier en question.

---


### 11. <a name="SECTION11"></a>INFORMATION LÉGALE

#### 11.0 PRÉAMBULE DE LA SECTION

Cette section de la documentation est destinée à décrire les considérations juridiques possibles concernant l'utilisation et la mise en œuvre du paquet, et de fournir quelques informations de base connexes. Cela peut être important pour certains utilisateurs afin de garantir le respect des exigences légales qui peuvent exister dans les pays où ils opèrent, et certains utilisateurs peuvent avoir besoin d'ajuster leurs politiques de site Web conformément à cette information.

Tout d'abord, s'il vous plaît se rendre compte que je (l'auteur du paquet) ne suis pas un avocat, ni un professionnel juridique qualifié de toute nature. Par conséquent, je ne suis pas légalement qualifié pour fournir des conseils juridiques. Aussi, dans certains cas, les exigences légales peuvent varier selon les pays et les juridictions, et ces différentes exigences juridiques peuvent parfois entrer en conflit (comme, par exemple, dans le cas des pays qui favorisent le droit à la [vie privée](https://fr.wikipedia.org/wiki/Vie_priv%C3%A9e) et le [droit à l'oubli](https://fr.wikipedia.org/wiki/Droit_%C3%A0_l%27oubli), par rapport aux pays qui favorisent la [conversation des données](https://fr.wikipedia.org/wiki/Conservation_des_donn%C3%A9es) étendue). Considérons également que l'accès au paquet n'est pas limité à des pays ou des juridictions spécifiques, et par conséquent, la base d'utilisateurs du paquet est susceptible de la diversité géographique. Ces points pris en compte, je ne suis pas en mesure de dire ce que cela signifie d'être « conforme à la loi » pour tous les utilisateurs, à tous égards. Cependant, j'espère que les informations contenues dans le présent document vous aideront à prendre vous-même une décision concernant ce que vous devez faire pour rester juridiquement conforme dans le cadre du paquet. Si vous avez des doutes ou des préoccupations concernant les informations contenues dans le présent document, ou si vous avez besoin d'aide supplémentaire et de conseils d'un point de vue juridique, je recommande de consulter un professionnel du droit qualifié.

#### 11.1 RESPONSABILITÉ

Comme déjà indiqué par la licence de paquet, le paquet est fourni sans aucune garantie. Cela inclut (mais n'est pas limité à) toute la portée de la responsabilité. Le paquet est fourni pour votre commodité, dans l'espoir qu'il vous sera utile, et qu'il vous apportera un certain avantage. Cependant, que vous utilisiez ou implémentiez le package, vous avez le choix. Vous n'êtes pas obligé d'utiliser ou de mettre en œuvre le package, mais lorsque vous le faites, vous êtes responsable de cette décision. Ni moi, ni aucun autre contributeur au paquet, ne sommes légalement responsables des conséquences des décisions que vous prenez, qu'elles soient directes, indirectes, implicites ou autres.

#### 11.2 TIERS

En fonction de sa configuration et de son implémentation exactes, le paquet peut communiquer et partager des informations avec des tiers dans certains cas. Ces informations peuvent être définies comme des « [données personnelles](https://fr.wikipedia.org/wiki/Donn%C3%A9es_personnelles) » (PII) dans certains contextes, par certaines juridictions.

La manière dont ces informations peuvent être utilisées par ces tiers est soumise aux différentes politiques énoncées par ces tiers et ne relève pas de cette documentation. Cependant, dans tous ces cas, le partage d'informations avec ces tiers peut être désactivé. Dans tous ces cas, si vous choisissez de l'activer, vous êtes responsable de rechercher toute préoccupation que vous pourriez avoir concernant la confidentialité, la sécurité, et l'utilisation des informations personnelles par ces tiers. Si des doutes existent, ou si vous n'êtes pas satisfait de la conduite de ces tiers en ce qui concerne les PII, il peut être préférable de désactiver tout partage d'informations avec ces tiers.

Dans un souci de transparence, le type d'informations partagées, et avec qui, est décrit ci-dessous.

##### 11.2.0 WEBFONTS

Certains thèmes personnalisés, et aussi l'interface utilisateur standard pour l'accès frontal de phpMussel, et la page « Téléchargement Refusé », peuvent utiliser des webfonts pour des raisons esthétiques. Les webfonts sont désactivées par défaut, mais lorsqu'elles sont activées, la communication directe entre le navigateur de l'utilisateur et le service hébergeant les webfonts produit. Cela peut éventuellement impliquer la communication d'informations telles que l'adresse IP de l'utilisateur, l'agent utilisateur, le système d'exploitation et d'autres informations disponibles à la demande. La plupart de ces webfonts sont hébergées par le service [Google Fonts](https://fonts.google.com/).

*Directives de configuration pertinentes :*
- `general` -> `disable_webfonts`

##### 11.2.1 SCANNER D'URL

Les URL trouvées dans les téléchargements de fichiers peuvent être partagées avec l'API hpHosts ou l'API Google Safe Browsing, en fonction de la configuration du package. Dans le cas de l'API hpHosts, ce comportement est activé par défaut. L'API Google Safe Browsing requiert des clés API pour fonctionner correctement, et est donc désactivée par défaut.

*Directives de configuration pertinentes :*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

Lorsque phpMussel analyse un téléchargement de fichier, les hachages de ces fichiers peuvent être partagés avec l'API Virus Total, en fonction de la configuration du package. Il est prévu de pouvoir partager des fichiers entiers à un moment donné dans le futur, mais cette fonctionnalité n'est pas supportée par le paquet pour le moment. L'API Virus Total requiert une clé API pour fonctionner correctement, et est donc désactivée par défaut.

Les informations (y compris les fichiers et métadonnées de fichiers associés) partagées avec Virus Total peuvent également être partagées avec leurs partenaires, affiliés, et divers autres à des fins de recherche. Ceci est décrit plus en détail par leur politique de confidentialité.

*Voir : [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Directives de configuration pertinentes :*
- `virustotal` -> `vt_public_api_key`

#### 11.3 JOURNALISATION

La journalisation est une partie importante de phpMussel pour un certain nombre de raisons. Sans la journalisation, il peut être difficile de diagnostiquer des faux positifs, de déterminer exactement comment phpMussel est performant dans un contexte particulier, et de déterminer où ses lacunes peuvent être, et quels changements peuvent être nécessaires à sa configuration ou à ses signatures en conséquence, afin de continuer à fonctionner comme prévu. Quoi qu'il en soit, la journalisation peut ne pas être souhaitable pour tous les utilisateurs, et reste entièrement facultative. Dans phpMussel, la journalisation est désactivée par défaut. Pour l'activer, phpMussel doit être configuré en accord.

Aditionellement, si la journalisation est légalement autorisée, et dans la mesure où elle est légalement permise (par exemple, les types d'informations pouvant être journalisées, pendant combien de temps, et dans quelles circonstances), peut varier, selon la juridiction et le contexte dans lequel phpMussel est mis en œuvre (par exemple, si vous opérez en tant qu'individu, en tant qu'entreprise, et si sur une base commerciale ou non-commerciale). Il peut donc être utile pour que vous lisiez attentivement cette section.

Il existe plusieurs types de journalisation que phpMussel peut effectuer. Différents types de journalisation impliquent différents types d'informations, pour différentes raisons.

##### 11.3.0 JOURNAUX D'ANALYSE

Lorsqu'il est activé dans la configuration du paquet, phpMussel conserve les journaux des fichiers qu'il analyse. Ce type de journalisation est disponible en deux formats différents :
- Fichiers journaux lisibles par l'homme.
- Fichiers journaux sérialisés.

Les entrées d'un fichier journal lisible par un humain, ressemblent généralement à ceci (à titre d'exemple) :

```
Mon, 21 May 2018 00:47:58 +0800 Commencé.
> Vérification 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5) :
-> Détecté phpMussel-Testfile.ASCII.Standard !
Mon, 21 May 2018 00:48:04 +0800 Terminé.
```

Une entrée de journal d'analyse inclut généralement les informations suivantes :
- La date et l'heure auxquelles le fichier a été analysé.
- Le nom du fichier analysé.
- CRC32b hashes du nom et du contenu du fichier.
- Ce qui a été détecté dans le fichier (si quelque chose a été détecté).

*Directives de configuration pertinentes :*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

Lorsque ces directives sont laissées vides, ce type de journalisation reste désactivé.

##### 11.3.1 SCAN KILLS

Lorsqu'il est activé dans la configuration du paquet, phpMussel conserve les journaux des téléchargements qui ont été bloqués.

Les entrées d'un fichier journal pour les « scan kills » ressemblent généralement à ceci (à titre d'exemple) :

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Détecté phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt) !
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Mis en quarantaine comme « /vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu ».
```

Une entrée pour les « scan kills » inclut généralement les informations suivantes :
- La date et l'heure auxquelles le téléchargement a été bloqué.
- L'adresse IP d'origine du téléchargement.
- La raison pour laquelle le fichier a été bloqué (ce qui a été détecté).
- Le nom du fichier bloqué.
- Un MD5 et la taille du fichier bloqué.
- Si le fichier a été mis en quarantaine, et sous quel nom interne.

*Directives de configuration pertinentes :*
- `general` -> `scan_kills`

##### 11.3.2 JOURNALISATION FRONTALE

Ce type de journalisation concerne les tentatives de connexion frontale, et se produit uniquement lorsqu'un utilisateur tente de se connecter à l'accès frontal (en supposant que l'accès frontal est activé).

Une entrée de journal frontal contient l'adresse IP de l'utilisateur qui tente de se connecter, la date et l'heure de la tentative, et les résultats de la tentative (connecté avec succès ou sans succès). Une entrée de journal frontal ressemble généralement à ceci (à titre d'exemple) :

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Connecté.
```

*Directives de configuration pertinentes :*
- `general` -> `FrontEndLog`

##### 11.3.3 ROTATION DES JOURNAUX

Vous voudrez peut-être purger les journaux après un certain temps, ou peut être requis de le faire par la loi (c'est à dire, la durée légale de la conservation des journaux peut être limitée par la loi). Vous pouvez y parvenir en incluant des marqueurs de date/heure dans les noms de vos fichiers journaux (par exemple, `{yyyy}-{mm}-{dd}.log`), conformément à la configuration de votre package, puis en activant la rotation des journaux (la rotation des journaux vous permet d'effectuer des actions sur les fichiers journaux lorsque les limites spécifiées sont dépassées).

Par exemple : Si j'étais légalement tenu de supprimer les journaux après 30 jours, je pourrais spécifier `{dd}.log` dans les noms de mes fichiers journaux (`{dd}` représente les jours), définir la valeur de `log_rotation_limit` à 30, et définir la valeur de `log_rotation_action` à `Delete`.

À l'inverse, si vous devez conserver les journaux pendant une période prolongée, vous ne pouvez pas utiliser la rotation des journaux, ou vous pouvez définir la valeur de `log_rotation_action` à `Archive`, pour compresser les fichiers journaux, réduisant ainsi la quantité totale d'espace disque qu'ils occupent.

*Directives de configuration pertinentes :*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 TRONCATION DES JOURNAUX

Il est également possible de tronquer des fichiers journaux individuels lorsqu'ils dépassent une certaine taille, si c'est quelque chose que vous pourriez avoir besoin ou que vous voulez faire.

*Directives de configuration pertinentes :*
- `general` -> `truncate`

##### 11.3.5 PSEUDONYMISATION D'ADRESSE IP

Premièrement, si vous n'êtes pas familier avec le terme, « pseudonymisation » se réfère au traitement des données personnelles en tant que tel, il ne peut plus être identifié à une personne concernée sans information supplémentaire, et à condition que ces informations supplémentaires soient conservées séparément, et soumis à des mesures techniques et organisationnelles pour s'assurer que les données personnelles ne peuvent être identifiées à aucune personnes naturelles.

Les ressources suivantes peuvent aider à l'expliquer plus en détail :
- [[les-infostrateges.com] RGPD : entre anonymisation et pseudonymisation](http://www.les-infostrateges.com/actu/18012505/rgpd-entre-anonymisation-et-pseudonymisation)
- [[Wikipedia] Pseudonymisation](https://fr.wikipedia.org/wiki/Pseudonymisation)

Dans certaines circonstances, vous pouvez être légalement requis d'anonymiser ou de pseudonymiser toute PII collectée, traitée, ou stockée. Bien que ce concept existe depuis longtemps, le GDPR/DSGVO mentionne notamment, et encourage spécifiquement la « pseudonymisation ».

phpMussel est capable de pseudonymiser les adresses IP lors de la connexion, si c'est quelque chose que vous pourriez avoir besoin ou que vous voulez faire. Lorsque phpMussel pseudonymise les adresses IP, lorsqu'il est connecté, l'octet final des adresses IPv4, et tout ce qui suit la deuxième partie des adresses IPv6 est représenté par un « x » (arrondir efficacement les adresses IPv4 à l'adresse initiale du 24ème sous-réseau dans lequel elles sont factorisées, et les adresses IPv6 à l'adresse initiale du 32ème sous-réseau dans lequel elles sont factorisées).

*Directives de configuration pertinentes :*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTIQUES

phpMussel est facultativement capable de suivre des statistiques telles que le nombre total de fichiers analysés et bloqués depuis un certain moment. Cette fonctionnalité est désactivée par défaut, mais peut être activée via la configuration du package. Le type d'informations suivies ne doit pas être considéré comme les PII.

*Directives de configuration pertinentes :*
- `general` -> `statistics`

##### 11.3.7 CRYPTAGE

phpMussel ne crypte pas son cache ou aucune information de journal. Le [cryptage](https://fr.wikipedia.org/wiki/Chiffrement) des cache et des journaux peuvent être introduits à l'avenir, mais il n'existe actuellement aucun plan spécifique. Si vous craignez que des tiers non autorisés puissent accéder à des parties de phpMussel pouvant contenir des informations personnelles/sensibles telles que son cache ou ses journaux, je recommanderais que phpMussel ne soit pas installé dans un endroit accessible au public (par exemple, installer phpMussel en dehors du répertoire `public_html` standard ou équivalent disponible pour la plupart des serveurs web standard) et et que des autorisations appropriées restrictives soient appliquées pour le répertoire où il réside (en particulier, pour le répertoire vault). Si ce n'est pas suffisant pour répondre à vos préoccupations, configurez phpMussel de telle sorte que les types d'informations à l'origine de vos préoccupations ne soient pas collectées ou journalisées en premier lieu (tel que en désactivant la journalisation).

#### 11.4 COOKIES

Lorsqu'un utilisateur se connecte avec succès à l'accès frontal, phpMussel définit un cookie afin de pouvoir se souvenir de l'utilisateur pour les demandes suivantes (c'est à dire, les cookies sont utilisés pour authentifier l'utilisateur à une session de connexion). Sur la page de connexion, un avertissement de cookie est affiché en évidence, avertissant l'utilisateur qu'un cookie sera défini s'il s'engage dans l'action correspondante. Les cookies ne sont définis à aucun autre endroit du code.

*Directives de configuration pertinentes :*
- `general` -> `disable_frontend`

#### 11.5 COMMERCIALISATION ET PUBLICITÉ

phpMussel ni collecte ni traite aucune information à des fins de commercialisation ou de publicité, et ni vend ni profite d'aucune information collectée ou journalisée. phpMussel n'est pas une entreprise commerciale, et n'est pas lié à des intérêts commerciaux, donc faire ces choses n'aurait aucun sens. Cela a été le cas depuis le début du projet, et continue d'être le cas aujourd'hui. Aditionellement, faire ces choses serait contre-productif à l'esprit et à l'objectif du projet dans son ensemble, et aussi longtemps que je continuerai à maintenir le projet, cela n'arrivera jamais.

#### 11.6 POLITIQUE DE CONFIDENTIALITÉ

Dans certaines circonstances, vous pouvez être légalement tenu d'afficher clairement un lien vers votre politique de confidentialité sur toutes les pages et sections de votre site Web. Cela peut être important pour s'assurer que les utilisateurs sont bien informés de vos pratiques exactes de confidentialité, les types de PII que vous collectez, et comment vous avez l'intention de l'utiliser. Afin de pouvoir inclure un lien sur la page « Téléchargement Refusé » de phpMussel, une directive de configuration est fournie pour spécifier l'URL de votre politique de confidentialité.

*Directives de configuration pertinentes :*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

Le règlement général sur la protection des données (GDPR) est un règlement de l'Union européenne qui entrera en vigueur le 25 Mai 2018. L'objectif principal de la réglementation est de permettre aux citoyens et aux résidents de l'UE de contrôler leurs propres données personnelles et d'unifier la réglementation au sein de l'UE en matière de vie privée et de données personnelles.

Le règlement contient des dispositions spécifiques relatives au traitement [des informations personnelles identifiables](https://fr.wikipedia.org/wiki/Donn%C3%A9es_personnelles) de toute « personne concernée » (toute personne physique identifiée ou identifiable) provenant ou provenant de l'UE. Pour être conforme à la réglementation, les « entreprises » (telles que définies par la réglementation) et tous les systèmes et processus pertinents doivent implémenter « [protection de la vie privée dès la conception](https://fr.wikipedia.org/wiki/Protection_de_la_vie_priv%C3%A9e_d%C3%A8s_la_conception) » par défaut, doivent utiliser les paramètres de confidentialité les plus élevés possibles, doivent mettre en œuvre les garanties nécessaires pour toute information stockée ou traitée (y compris, mais sans s'y limiter, la mise en œuvre de la pseudonymisation ou l'anonymisation complète des données), doivent déclarer clairement et sans ambiguïté les types de données qu'ils collectent, comment ils les traitent, pour quelles raisons, pour combien de temps ils les conservent, et s'ils partagent ces données avec des tiers, les types de données partagées avec des tiers, comment, pourquoi, et ainsi de suite.

Les données ne peuvent pas être traitées à moins qu'il y ait une base légale pour le faire, tel que défini par le règlement. En général, cela signifie que pour traiter les données d'une personne concernée sur une base légale, cela doit être fait conformément aux obligations légales, ou seulement après qu'un consentement explicite, bien informé et sans ambiguïté a été obtenu de la personne concernée.

Étant donné que certains aspects de la réglementation peuvent évoluer dans le temps, afin d'éviter la propagation d'informations périmées, il peut être préférable de connaître la réglementation auprès d'une source autorisée, par opposition à simplement inclure les informations pertinentes ici dans la documentation du paquet (dont peut éventuellement devenir obsolète à mesure que la réglementation évolue).

[EUR-Lex](https://eur-lex.europa.eu/) (une partie du site officiel de l'Union européenne qui fournit des informations sur le droit de l'UE) fournit des informations détaillées sur GDPR/DSGVO, disponible en 24 langues différentes (au moment de la rédaction de ce document), et disponible en téléchargement au format PDF. Je recommande vivement de lire les informations qu'ils fournissent, afin d'en savoir plus sur GDPR/DSGVO :
- [RÈGLEMENT (UE) 2016/679 DU PARLEMENT EUROPÉEN ET DU CONSEIL](https://eur-lex.europa.eu/legal-content/FR/TXT/?uri=celex:32016R0679)

Alternativement, il y a un bref aperçu (non autorisé) de GDPR/DSGVO disponible sur Wikipedia :
- [Règlement général sur la protection des données](https://fr.wikipedia.org/wiki/R%C3%A8glement_g%C3%A9n%C3%A9ral_sur_la_protection_des_donn%C3%A9es)

---


Dernière mise à jour : 16 Octobre 2018 (2018.10.16).
