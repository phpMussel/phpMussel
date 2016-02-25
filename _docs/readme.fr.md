## Documentation pour phpMussel (Français).

### Contenu
- 1. [PRÉAMBULE](#SECTION1)
- 2A. [COMMENT INSTALLER (POUR SERVEURS WEB)](#SECTION2A)
- 2B. [COMMENT INSTALLER (POUR CLI)](#SECTION2B)
- 3A. [COMMENT UTILISER (POUR SERVEURS WEB)](#SECTION3A)
- 3B. [COMMENT UTILISER (POUR CLI)](#SECTION3B)
- 4A. [COMMANDES DU NAVIGATEUR](#SECTION4A)
- 4B. [CLI (COMMANDE LIGNE INTERFACE)](#SECTION4B)
- 5. [FICHIERS INCLUS DANS CETTE PAQUET](#SECTION5)
- 6. [CONFIGURATION OPTIONS](#SECTION6)
- 7. [SIGNATURE FORMAT](#SECTION7)
- 8. [CONNUS PROBLÈMES DE COMPATIBILITÉ](#SECTION8)

---


###1. <a name="SECTION1"></a>PRÉAMBULE

Merci pour l'utiliser de phpMussel, un PHP script pour la détection de virus, logiciels malveillants et autres menaces dans les fichiers téléchargés sur votre système partout où le script est accroché, basé sur les signatures de ClamAV et autres.

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


###2A. <a name="SECTION2A"></a>COMMENT INSTALLER (POUR SERVEURS WEB)

J'ai l'intention de simplifier ce processus par la création d'un programme d'installation à l'avenir, mais en attendant, suivez ces instructions pour la correcte fonction de phpMussel sur la majorité de systèmes et CMS:

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Maintenant, vous devez déterminer la approprié emplacement sur votre hôte ou CMS à mettre ces contenus. Un répertoire comme `/public_html/phpmussel/` ou similaire (cependant, il n'est pas question que vous choisissez, à condition que c'est quelque part de sûr et quelque part que vous êtes heureux avec) sera suffira. *Vous avant commencer téléchargement au serveur, continuer lecture..*

2) Facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), ouvrir `phpmussel.ini` (situé à l'intérieur de `vault`) - Ce fichier contient toutes les directives disponible pour phpMussel. Au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour. Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, fermer.

3) Télécharger les contenus (phpMussel et ses fichiers) à le répertoire vous aviez décidé plus tôt (vous n'avez pas besoin les `*.txt`/`*.md` fichiers, mais surtout, vous devriez télécharger tous les fichiers sur le serveur).

4) CHMOD la `vault` répertoire à "777". Le principal répertoire qui est stocker le contenu (celui que vous avez choisi plus tôt), généralement, peut être laissé seul, mais CHMOD état devrait être vérifié si vous avez eu problèmes d'autorisations dans le passé sur votre système (par défaut, devrait être quelque chose comme "755").

5) Suivant, vous aurez besoin de "crochet" phpMussel à votre système ou CMS. Il est plusieurs façons vous pouvez "crochet" phpMussel à votre système ou CMS, mais le plus simple est à simplement inclure le script au début d'un fichier de la base de données de votre système ou CMS (un qui va généralement toujours être chargé lorsque quelqu'un accède à n'importe quelle page sur votre website) utilisant un `require` ou `include` déclaration. Généralement, ce sera quelque chose de stocké dans un répertoire comme `/includes`, `/assets` ou `/functions`, et il sera souvent nommé quelque chose comme `init.php`, `common_functions.php`, `functions.php` ou similaire. Vous sera besoin à déterminer qui est le fichier c'est pour votre situation; Si vous rencontrez des difficultés dans déterminer de ce pour vous-même, visiter les phpMussel support forums et laissez-nous savoir; Il est possible que ce soit moi ou un autre utilisateur peuvent avoir de l'expérience avec le CMS que vous utilisez (vous aurez besoin pour nous faire savoir ce qui CMS vous utilisez), et ainsi, peut être en mesure de fournir une assistance pour cette question. Pour ce faire [à utiliser `require` ou `include`], insérez la ligne de code suivante au début de ce le noyau fichier et remplacer la string contenue à l'intérieur des guillemets avec l'exacte adresse le fichier `phpmussel.php` (l'adresse locale, pas l'adresse HTTP; il ressemblera l'adresse de `vault` mentionné précédemment).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Enregistrer le fichier, fermer, rétélécharger.

-- OU ALTERNATIVEMENT --

Si vous utilisez un Apache serveur web et si vous avez accès à `php.ini`, vous pouvez utiliser la `auto_prepend_file` directive à préfixer phpMussel chaque fois qu'une demande de PHP est faite. Quelque chose comme:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

Ou cette dans le `.htaccess` fichier:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) À ce stade, vous avez fini! Cependant, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester les protections, essayez de télécharger les tester fichiers inclus dans le paquet sous `_testfiles` à votre website par votre habituelles navigateur basé méthodes de téléchargement. Si tout fonctionne correctement, un message devrait apparaître à partir de phpMussel confirmant que le téléchargement a été bloqué avec succès. Si rien ne s'affiche, quelque chose ne fonctionne pas correctement. Si vous utilisez d'avancées fonctions ou si vous utilisez l'autres types d'analyse possibles avec l'outil, je vous suggère de l'essayer avec ceux pour s'assurer qu'il fonctionne comme prévu, aussi.

---


###2B. <a name="SECTION2B"></a>COMMENT INSTALLER (POUR CLI)

J'ai l'intention de simplifier ce processus par la création d'un programme d'installation à l'avenir, mais en attendant, suivez ces instructions pour rendant phpMussel disposé de travailler avec CLI (être conscient que, à ce stade, CLI support est uniquement pour les Windows systèmes; Linux et d'autres systèmes seront bientôt arriver à une ultérieure version de phpMussel):

1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une archivée copie du script, décompressé son contenu et l'ont assis sur votre locale machine. Lorsque vous avez déterminé que vous êtes satisfait sur l'emplacement choisi pour phpMussel, continuer.

2) phpMussel exige PHP d'être installé sur l'ordinateur hôte afin d'exécuter. Si vous n'avez pas de PHP installé sur votre machine, s'il vous plaît, installer PHP sur votre machine, suivant les instructions fournies par le programme d'installation de PHP.

3) Facultativement (fortement recommandé pour les utilisateurs avancés, mais pas recommandé pour les débutants ou pour les novices), ouvrir `phpmussel.ini` (situé à l'intérieur de `vault`) - Ce fichier contient toutes les directives disponible pour phpMussel. Au-dessus de chaque option devrait être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour. Réglez ces options comme bon vous semble, selon ce qui est approprié pour votre particulière configuration. Enregistrer le fichier, fermer.

4) Facultativement, vous pouvez faire utilisant phpMussel en CLI mode plus facile pour vous-même par la création d'un fichier de commandes pour automatique charger PHP et phpMussel. Pour ce faire, ouvrir un éditeur de texte comme Notepad ou Notepad++, taper le complet chemin vers le `php.exe` fichier dans le répertoire de votre installation de PHP, suivi d'un espace, suivi par le complet chemin vers le `phpmussel.php` fichier dans le répertoire de votre installation de phpMussel, enregistrer le fichier avec un ".bat" suffixe quelque part que vous trouverez facile, et double-cliquer sur ce fichier pour exécuter phpMussel à l'avenir.

5) À ce stade, vous avez fini! Mais, vous devriez probablement tester ce pour s'assurer qu'il fonctionne correctement. Pour tester phpMussel, exécuter phpMussel et essayer d'analyser le `_testfiles` répertoire fourni avec le paquet.

---


###3A. <a name="SECTION3A"></a>COMMENT UTILISER (POUR SERVEURS WEB)

phpMussel est destiné à être un script qui va fonctionner correctement droit de la boîte avec un niveau de strict minimum des exigences de votre part: Après qu'il a été installé, fondamentalement, il devrait tout simplement travailler.

L'analyses des téléchargements des fichiers est automatisée et activée par défaut, donc rien est nécessaire à partir de vous pour cette fonction particulière.

Cependant, vous êtes également capable d'instruire phpMussel à analyser spécifiques fichiers, répertoires et/ou archives. Pour ce faire, premièrement, vous devez assurer que la appropriée configuration est imposé dans le `phpmussel.ini` fichier (`cleanup` doit être désactivé), et lorsque vous avez terminé, dans un fichier PHP qui est accroché à phpMussel, utilisez la fonction suivante dans votre code:

`phpMussel($what_to_scan,$output_type,$output_flatness);`

- `$what_to_scan` peut être une chaîne, un tableau, ou un tableau de tableaux, et indique quel fichier, fichiers, répertoire et/ou répertoires à analyser.
- `$output_type` est un booléen, indiquant le format dont les résultats d'analyse doivent être retournées sous. False/Faux instruit la fonction à retourner des résultats comme un entier (un retourné résultat de -3 indique des problèmes ont été rencontrés avec le phpMussel signatures fichiers ou des signatures cartes fichiers et qu'ils peuvent être possible manquants ou corrompus, -2 indique que données corrompues était détecté lors de l'analyse et donc l'analyse n'ont pas réussi à compléter, -1 indique que les extensions ou addons requis par PHP pour exécuter l'analyse sont manquaient et donc l'analyse n'ont pas réussi à compléter, 0 indique qu'il n'existe pas cible à analyser et donc il n'y avait rien à analyser, 1 indique que la cible était analysé avec succès et aucun problème n'été détectée, et 2 indique que la cible était analysé avec succès et problèmes ont été détectés). True/Vrai instruit la fonction à retourner des résultats sous forme de texte lisible par humain. De plus, dans tout le cas, les résultats peuvent être accessibles via les variables globales après l'analyse est terminée. Cette variable est optionnel, imposé par défaut comme false/faux.
- `$output_flatness` est un booléen, indiquant à la fonction soit à retourner les résultats de l'analyse (quand il ya plusieurs cibles d'analyse) comme un tableau ou une chaîne. False/Faux sera retour les résultats comme un tableau. True/Vrai sera retour les résultats comme une chaîne. Cette variable est optionnel, imposé par défaut comme false/faux.

Exemples:

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

Retours quelque chose comme ça (comme une string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Commencé.
 > Vérification '/user_name/public_html/my_file.html':
 -> Pas problème trouvé.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminé.
```

Pour un complet itinéraire de signatures que sera utilisé par phpMussel pour l'analyse et la façon dont il gère ces signatures, référer à la Signature Format section de ce README fichier.

Si vous rencontrez des faux positifs, si vous rencontrez quelque chose nouveau que vous pensez doit être bloqué, ou pour toute autre chose en ce qui concerne les signatures, s'il vous plaît, contactez moi à ce sujet afin que je puisse effectuer les nécessaires changements, dont, si vous ne contactez moi pas, j'ai peut n'être pas conscient.

Pour désactiver les signatures qui sont incluent avec phpMussel (comme si vous rencontrez un faux positif spécifique à vos besoins dont ne devrait normalement pas être retiré à partir de rationaliser), référer aux les notes de la liste grise dans les Commandes du Navigateur section de ce README fichier.

En plus de la défaut analyse de fichier téléchargement et la facultative analyse d'autres fichiers et/ou répertoires spécifiés par la fonction ci-dessus, inclus dans phpMussel est une fonction destinée pour l'analyse du corps des courriels messages. Cette fonction se comporte comme la standard phpMussel() fonction, mais se concentre uniquement sur la correspondance contre les ClamAV courriels basées signatures. Je n'ai pas attaché ces signatures dans la standard phpMussel() fonction, parce que il est hautement improbable que vous auriez trouver le corps d'un entrant message dans le besoin de l'analyse dans un fichier téléchargement ciblé d'un page où phpMussel est accroché, et ainsi, pour lier ces signatures dans la phpMussel() fonction serait redondant. Cependant, à ce que ledit, ayant une distincte fonction pour correspondre encontre ces signatures pourrait s'avérer extrêmement utile pour quelque, surtout pour ceux dont CMS ou système webfront est en quelque sorte lié à leur messagerie système et pour ceux dont analyser leurs courriels à travers un script PHP dont ils pourraient s'accrocher dans phpMussel. Configuration pour cette fonction, comme tous les autres, est contrôlé par le `phpmussel.ini` fichier. Pour utiliser cette fonction (vous aurez besoin de faire votre propre implémentation), dans un PHP fichier qui est accroché à phpMussel, utiliser ce fonction dans votre code:

`phpMussel_mail($corps);`

Où $corps est le corps de le courriel que vous souhaitez d'analyser (plus, vous pouvez essayer d'analyser nouveaux forum messages, l'entrants messages de votre online contact page ou similaire). Si une erreur s'empêchant la fonction d'achever son analyse, une valeur de -1 sera retourné. Si la fonction a terminé son analyse et ne correspond pas à rien, une valeur de 0 sera retourné (indiquant pas infecté). Si, cependant, la fonction correspond à quelque chose, une string sera retournée contenant un message déclarant ce qu'il a identifié.

En plus de ce qui précède, si vous regardez le source code, vous peut remarquerez la fonction phpMusselD() et phpMusselR(). Ces fonctions sont sous-fonctions de phpMussel(), et ne devrait pas être appelé directement à l'extérieur de cette principale fonction (pas en raison des effets indésirables.. Plus-si, simplement parce que ce serait sans utilité, et très probablement ne sera pas réellement fonctionner correctement de toute façon).

Il ya beaucoup autres contrôles et fonctions disponibles dans phpMussel pour votre usage, aussi. Pour toutes ces contrôles et fonctions dont, sur la fin de cette section de la README, n'ont pas encore été documenté, s'il vous plaît, continuer à lire et référer à les Commandes du Navigateur section de ce README fichier.

---


###3B. <a name="SECTION3B"></a>COMMENT UTILISER (POUR CLI)

S'il vous plaît, référer à la "COMMENT INSTALLER (POUR CLI)" section de ce README fichier.

Soyez conscient que, bien que avenirs versions de phpMussel devraient soutenir d'autres systèmes, à ce moment, phpMussel CLI mode support est uniquement optimisé pour l'utilisation sur le Windows basée systèmes (vous pouvez, bien sûr, essayer sur d'autres systèmes, mais je ne peux pas garantir que ça va fonctionner comme prévu).

Aussi soyez conscient que phpMussel est pas la fonctionnel équivalent d'une complet anti-virus suite, et contrairement anti-virus suites conventionnelles, ne surveille pas la mémoire active ou détecter les virus sur la volée! Il seulement détecte les virus contenus dans les fichiers que vous explicitement spécifier pour d'analyse.

---


###4A. <a name="SECTION4A"></a>COMMANDES DU NAVIGATEUR

Après phpMussel a été installé et est fonctionner correctement sur votre système, si vous avez défini les variables `script_password` et `logs_password` dans votre configuration fichier, vous sera pouvoir d'effectuer un certain nombre de administratives fonctions et entrée un nombre de commandes à phpMussel par votre navigateur. La raison de ces mots de passe doivent être defini afin de permettre à ces navigateur contrôles est pour assurer adéquate sécurité, l'adéquate protection de ces navigateur contrôles et faire en sorte une méthode existe pour ceux navigateur contrôle à être entièrement désactivé si elles ne sont pas souhaitées par vous et/ou autres webmasters/administrateurs dont sont l'utiliser phpMussel. Ainsi, en d'autres termes, pour activer ces contrôles, définir un mot de passe, et pour désactiver ces contrôles, définir aucun mot de passe. Comme alternatif, si vous choisir d'activer ces contrôles et puis choisir de désactiver ces contrôles à une ultérieure date, il existe une commande à faire ce (tel peut être utile si vous effectuer certaines actions vous sentez pourrait compromettre les mots de pass que vous avez délégué et besoin de désactiver rapidement ces contrôles sans modifier votre configuration fichier).

Quelques raisons pour lesquelles vous _**DEVRIEZ**_ permettre à ces contrôles:
- Fournit une méthode à liste grise les signatures sur la volée dans des cas comme lorsque vous découvrez une signature qui produit un faux positif tandis le téléchargement de fichiers à votre système et vous n'avez pas le temps à manuellement modifier et rétélécharger votre liste grise fichier.
- Fournit une méthode pour vous à permettre à quelqu'un d'autre que vous pour contrôler votre copie de phpMussel sans la implicite nécessité à donner de leur accès à FTP.
- Fournit une méthode à fournir contrôlé accès à vos journaux fichiers.
- Fournit un facile méthode à réactualiser phpMussel quand une réactualiser est disponibles.
- Fournit une méthode pour vous à surveiller phpMussel quand l'accès de FTP ou d'autres conventionnelles points d'accès pour surveillance de phpMussel ne sont pas disponibles.

Quelques raisons pour lesquelles vous _**NE DEVRIEZ PAS**_ permettre à ces contrôles:
- Fournit un potentiel vecteur pour attaquants et indésirables à déterminer si vous utilisez phpMussel ou pas (quoique, cela pourrait être positif ou négatif, en lieu du point de vue) par le biais d'aveuglément envoyer les commandes aux serveurs comme méthode à sonder. D'une part, cela pourrait décourager les attaquants de cibler votre système s'ils apprennent que vous utilisez phpMussel, en supposant qu'ils sondage parce que leur méthode d'attaque est rendu inefficace en raison de l'utilisation de phpMussel. Mais, de l'autre part, si certains imprévu et actuellement inconnue exploit dans phpMussel uo un avenir version de celui-ci vient à la lumière, et si elle pourrait fournir un vecteur d'attaque, un positif résultat d'une telle sondage pourrait effectivement encourager les attaquants à cibler votre système.
- Si vos délégués mots de passe ont été compromises, sans être changé, pourrait fournir un méthode pour un attaquant à contourner les signatures que peuvent être autrement normalement empêchent leurs attaques de réussir, ou même potentiellement désactiver phpMussel complètement, ainsi fournissant un théorique méthode de rendre l'efficacité de phpMussel avenu.

De toute façon, indépendamment de que vous choisissez, le choix est finalement vôtre. Par défaut, ces contrôles seront désactivés, mais avoir une réflexion à ce sujet, et si vous décidez que vous voulez ces, cette section explique comment activer et comment utiliser ces.

Une liste de commandes du navigateur disponibles:

scan_log
- Mot de passe requis: `logs_password`
- Autre exigences: scan_log doit être défini.
- Paramètres requis: (aucun)
- Paramètres optionnels: (aucun)
- Exemple: `?logspword=[logs_password]&phpmussel=scan_kills`
- Quel est-il: Imprime le contenu de votre scan_log fichier à l'écran.

scan_kills
- Mot de passe requis: `logs_password`
- Autre exigences: scan_kills doit être défini.
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?logspword=[logs_password]&phpmussel=scan_kills`
- Quel est-il: Imprime le contenu de votre scan_kills fichier à l'écran.

controls_lockout
- Mot de passe requis: `logs_password` OU `script_password`
- Autre exigences: (aucun)
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Exemple 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Quel est-il: Désactiver/verrouille tous les contrôles de navigateur. Cela devrait être utilisé si vous pensez que vos mots de passe ont été compromis (cela peut arriver si vous utilisez ces commandes à partir d'un ordinateur qui n'est pas sécurisé et/ou n'est pas digne de confiance). controls_lockout fonctionne par créant un fichier, `controls.lck`, dans votre voûte, dont phpMussel sera vérifié avant d'effectuer commandes de toute nature. Après, pour réactiver les contrôles, vous devez supprimer manuellement le fichier `controls.lck` par FTP ou similaire.

disable
- Mot de passe requis: `script_password`
- Autre exigences: (aucun)
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=disable`
- Quel est-il: Désactiver phpMussel. Cela devrait être utilisé si vous réactualiser ou faire changements à votre système ou si vous installez logiciel ou modules nouveaux à votre système dont sera ou pourrait potentiellement déclencher faux positifs. Aussi, cela devrait être utilisé si vous rencontrez problèmes avec phpMussel mais ne veulent pas à supprimer de votre système. Si c'est le cas, pour réactiver phpMussel, utiliser "enable".

enable
- Mot de passe requis: `script_password`
- Autre exigences: (aucun)
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=enable`
- Quel est-il: Réactiver phpMussel. Cela devrait être utilisé si vous avez précédemment désactivé phpMussel utilisant "disable" et vous voulez à réactiver ce.

update
- Mot de passe requis: `script_password`
- Autre exigences: `update.dat` et `update.inc` doivent exister.
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=update`
- Quel est-il: Vérifie pour nouvelles versions de phpMussel et ses signatures. Si quelque chose est trouvé, il va tenter à télécharger et installer les nouveaux fichiers. S'il est ne parvient pas à vérifier, il sera annulerait. Les résultats du processus sont imprimés à l'écran. Je recommande vérifier au moins une fois par mois afin d'assurer que vos signatures et votre copie de phpMussel sont la dernière disponible (à moins que, bien sûr, si vous téléchargez et installez les derniers fichiers manuellement, dont, j'aussi recommande vérifier au moins une fois par mois). Vérification plus de deux fois par mois est probablement inutile, étant donné que je suis très improbable d'être produire nouveaux fichiers plus fréquemment que cela (ni je ne particulièrement pas vouloir à, pour la plupart).

greylist
- Mot de passe requis: `script_password`
- Autre exigences: (aucun)
- Paramètres requis: [Nom de la signature à greylist]
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]`
- Quel est-il: Ajouter une signature à la liste grise.

greylist_clear
- Mot de passe requis: `script_password`
- Autre exigences: (aucun)
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=greylist_clear`
- Quel est-il: Efface la totalité de la liste grise.

greylist_show
- Mot de passe requis: `script_password`
- Autre exigences: (aucun)
- Paramètres requis: (aucun)
- Optional parameters: (aucun)
- Exemple: `?pword=[script_password]&phpmussel=greylist_show`
- Quel est-il: Imprime le contenu de la liste grise à l'écran.

---


###4B. <a name="SECTION4B"></a>CLI (COMMANDE LIGNE INTERFACE)

phpMussel peut être exécuté comme un analyseur de fichiers interactif en CLI mode dans windows. Référer à la "COMMENT INSTALLER (POUR CLI)" section de ce README fichier pour plus détails.

Pour une liste des disponibles CLI commandes, à l'invite CLI, tapez «c», et appuyez sur Entrée.

---


###5. <a name="SECTION5"></a>FICHIERS INCLUS DANS CETTE PAQUET

Voici une liste de tous les fichiers inclus dans phpMussel dans son natif état, tous les fichiers qui peuvent être potentiellement créées à la suite de l'utilisation de ce script, avec une brève description de ce que tous ces fichiers sont pour.

Fichier | Description
----|----
/.gitattributes | Un fichier du GitHub projet (pas nécessaire pour le bon fonctionnement du script).
/composer.json | Composer/Packagist information (pas nécessaire pour le bon fonctionnement du script).
/CONTRIBUTING.md | Informations sur la façon de contribuer au projet.
/LICENSE.txt | Une copie de la GNU/GPLv2 license.
/PEOPLE.md | Informations sur les personnes impliquées dans le projet.
/phpmussel.php | Chargeur/Loader (charge le principal script et etc). C'est ce que vous êtes censé être accrochage dans à (essentiel)!
/README.md | Sommaire de l'information du projet.
/web.config | Un ASP.NET configuration fichier (dans ce cas, pour protéger de la `/vault` répertoire contre d'être consulté par des non autorisée sources dans le cas où le script est installé sur un serveur basé sur les ASP.NET technologies).
/_docs/ | Documentation répertoire (contient divers fichiers).
/_docs/change_log.txt | Un enregistrement des modifications apportées au script entre les différentes versions (pas nécessaire pour le bon fonctionnement du script).
/_docs/readme.ar.md | Documentation en Arabe.
/_docs/readme.de.md | Documentation en Allemand.
/_docs/readme.de.txt | Documentation en Allemand.
/_docs/readme.en.md | Documentation en Anglais.
/_docs/readme.en.txt | Documentation en Anglais.
/_docs/readme.es.md | Documentation en Espagnol.
/_docs/readme.es.txt | Documentation en Espagnol.
/_docs/readme.fr.md | Documentation en Français.
/_docs/readme.fr.txt | Documentation en Français.
/_docs/readme.id.md | Documentation en Indonésien.
/_docs/readme.id.txt | Documentation en Indonésien.
/_docs/readme.it.md | Documentation en Italien.
/_docs/readme.it.txt | Documentation en Italien.
/_docs/readme.nl.md | Documentation en Néerlandais.
/_docs/readme.nl.txt | Documentation en Néerlandais.
/_docs/readme.pt.md | Documentation en Portugais.
/_docs/readme.pt.txt | Documentation en Portugais.
/_docs/readme.ru.md | Documentation en Russe.
/_docs/readme.ru.txt | Documentation en Russe.
/_docs/readme.vi.md | Documentation en Vietnamien.
/_docs/readme.vi.txt | Documentation en Vietnamien.
/_docs/readme.zh-TW.md | Documentation en Chinois (traditionnel).
/_docs/readme.zh.md | Documentation en Chinois (simplifié).
/_docs/signatures_tally.txt | Décompte de signatures inclus (pas nécessaire pour le bon fonctionnement du script).
/_testfiles/ | Test fichiers répertoire (contient divers fichiers). Tous les fichiers contenus sont des fichiers à test si phpMussel a été correctement installé sur votre système, et vous n'avez pas besoin de télécharger ce répertoire ou l'un de ses fichiers, sauf si faire ces tests.
/_testfiles/ascii_standard_testfile.txt | Test fichier à test phpMussel normalisé ASCII signatures.
/_testfiles/coex_testfile.rtf | Test fichier à test phpMussel complexes étendues signatures.
/_testfiles/exe_standard_testfile.exe | Test fichier à test phpMussel PE signatures.
/_testfiles/general_standard_testfile.txt | Test fichier à test phpMussel générales signatures.
/_testfiles/graphics_standard_testfile.gif | Test fichier à test phpMussel graphiques signatures.
/_testfiles/html_standard_testfile.html | Test fichier à test phpMussel normalisé HTML signatures.
/_testfiles/md5_testfile.txt | Test fichier à test phpMussel MD5 signatures.
/_testfiles/metadata_testfile.tar | Test fichier à test phpMussel métadonnées signatures et pour tester TAR fichier support sur votre système.
/_testfiles/metadata_testfile.txt.gz | Test fichier à test phpMussel métadonnées signatures et pour tester GZ fichier support sur votre système.
/_testfiles/metadata_testfile.zip | Test fichier à test phpMussel métadonnées signatures et pour tester ZIP fichier support sur votre système.
/_testfiles/ole_testfile.ole | Test fichier à test phpMussel OLE signatures.
/_testfiles/pdf_standard_testfile.pdf | Test fichier à test phpMussel PDF signatures.
/_testfiles/pe_sectional_testfile.exe | Test fichier à test phpMussel PE Sectional signatures.
/_testfiles/swf_standard_testfile.swf | Test fichier à test phpMussel SWF signatures.
/_testfiles/xdp_standard_testfile.xdp | Test fichier à test phpMussel XML/XDP signatures.
/vault/ | Voûte répertoire (contient divers fichiers).
/vault/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/cache/ | Cache répertoire (pour les données temporaires).
/vault/cache/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/cli.inc | Module de CLI.
/vault/config.inc | Module de configuration.
/vault/controls.inc | Module de contrôles.
/vault/functions.inc | Fichier de fonctions (essentiel).
/vault/greylist.csv | CSV de grise listé signatures indiquant pour phpMussel qui signatures il faut ignorer (fichier recréé automatiquement si supprimé).
/vault/lang.inc | Linguistiques données.
/vault/lang/ | Contient linguistiques données.
/vault/lang/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/lang/lang.ar.inc | Linguistiques données en Arabe.
/vault/lang/lang.de.inc | Linguistiques données en Allemand.
/vault/lang/lang.en.inc | Linguistiques données en Anglais.
/vault/lang/lang.es.inc | Linguistiques données en Espagnol.
/vault/lang/lang.fr.inc | Linguistiques données en Français.
/vault/lang/lang.id.inc | Linguistiques données en Indonésien.
/vault/lang/lang.it.inc | Linguistiques données en Italien.
/vault/lang/lang.ja.inc | Linguistiques données en Japonais.
/vault/lang/lang.nl.inc | Linguistiques données en Néerlandais.
/vault/lang/lang.pt.inc | Linguistiques données en Portugais.
/vault/lang/lang.ru.inc | Linguistiques données en Russe.
/vault/lang/lang.vi.inc | Linguistiques données en Vietnamien.
/vault/lang/lang.zh-TW.inc | Linguistiques données en Chinois (Traditionnel).
/vault/lang/lang.zh.inc | Linguistiques données en Chinois (Simplifié).
/vault/phpmussel.ini | Configuration fichier; Contient toutes les configuration options de phpMussel, diriger comment faire fonctionner correctement (essentiel)!
/vault/quarantine/ | Quarantaine répertoire (contient des fichiers de la quarantaine).
/vault/quarantine/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
※ /vault/scan_kills.txt | Les résultats de chaque fichier téléchargement bloqué/tués par phpMussel.
※ /vault/scan_log.txt | Un enregistrement de tout analysé par phpMussel.
※ /vault/scan_log_serialized.txt | Un enregistrement de tout analysé par phpMussel.
/vault/signatures/ | Signatures répertoire (contient des fichiers de signatures).
/vault/signatures/.htaccess | Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles fichiers appartenant au script contre être consulté par non autorisées sources).
/vault/signatures/ascii_clamav_regex.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_clamav_regex.map | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_clamav_standard.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_clamav_standard.map | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_custom_regex.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_custom_standard.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_mussel_regex.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/ascii_mussel_standard.cvd | Fichier pour normalisé ASCII signatures.
/vault/signatures/coex_clamav.cvd | Fichier pour les complexes étendues signatures.
/vault/signatures/coex_custom.cvd | Fichier pour les complexes étendues signatures.
/vault/signatures/coex_mussel.cvd | Fichier pour les complexes étendues signatures.
/vault/signatures/elf_clamav_regex.cvd | Fichier pour l'ELF signatures.
/vault/signatures/elf_clamav_regex.map | Fichier pour l'ELF signatures.
/vault/signatures/elf_clamav_standard.cvd | Fichier pour l'ELF signatures.
/vault/signatures/elf_clamav_standard.map | Fichier pour l'ELF signatures.
/vault/signatures/elf_custom_regex.cvd | Fichier pour l'ELF signatures.
/vault/signatures/elf_custom_standard.cvd | Fichier pour l'ELF signatures.
/vault/signatures/elf_mussel_regex.cvd | Fichier pour l'ELF signatures.
/vault/signatures/elf_mussel_standard.cvd | Fichier pour l'ELF signatures.
/vault/signatures/exe_clamav_regex.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_regex.map | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_standard.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_standard.map | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_custom_regex.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_custom_standard.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_mussel_regex.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/exe_mussel_standard.cvd | Fichier pour les PE (Portable Executable) signatures.
/vault/signatures/filenames_clamav.cvd | Fichier pour filename signatures.
/vault/signatures/filenames_custom.cvd | Fichier pour filename signatures.
/vault/signatures/filenames_mussel.cvd | Fichier pour filename signatures.
/vault/signatures/general_clamav_regex.cvd | Fichier pour général signatures.
/vault/signatures/general_clamav_regex.map | Fichier pour général signatures.
/vault/signatures/general_clamav_standard.cvd | Fichier pour général signatures.
/vault/signatures/general_clamav_standard.map | Fichier pour général signatures.
/vault/signatures/general_custom_regex.cvd | Fichier pour général signatures.
/vault/signatures/general_custom_standard.cvd | Fichier pour général signatures.
/vault/signatures/general_mussel_regex.cvd | Fichier pour général signatures.
/vault/signatures/general_mussel_standard.cvd | Fichier pour général signatures.
/vault/signatures/graphics_clamav_regex.cvd | Fichier pour graphiques signatures.
/vault/signatures/graphics_clamav_regex.map | Fichier pour graphiques signatures.
/vault/signatures/graphics_clamav_standard.cvd | Fichier pour graphiques signatures.
/vault/signatures/graphics_clamav_standard.map | Fichier pour graphiques signatures.
/vault/signatures/graphics_custom_regex.cvd | Fichier pour graphiques signatures.
/vault/signatures/graphics_custom_standard.cvd | Fichier pour graphiques signatures.
/vault/signatures/graphics_mussel_regex.cvd | Fichier pour graphiques signatures.
/vault/signatures/graphics_mussel_standard.cvd | Fichier pour graphiques signatures.
/vault/signatures/hex_general_commands.csv | Hex-codé CSV de généraux commande détections optionnellement utilisés par phpMussel.
/vault/signatures/html_clamav_regex.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/html_clamav_regex.map | Fichier pour normalisé HTML signatures.
/vault/signatures/html_clamav_standard.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/html_clamav_standard.map | Fichier pour normalisé HTML signatures.
/vault/signatures/html_custom_regex.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/html_custom_standard.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/html_mussel_regex.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/html_mussel_standard.cvd | Fichier pour normalisé HTML signatures.
/vault/signatures/macho_clamav_regex.cvd | Fichier pour Mach-O signatures.
/vault/signatures/macho_clamav_regex.map | Fichier pour Mach-O signatures.
/vault/signatures/macho_clamav_standard.cvd | Fichier pour Mach-O signatures.
/vault/signatures/macho_clamav_standard.map | Fichier pour Mach-O signatures.
/vault/signatures/macho_custom_regex.cvd | Fichier pour Mach-O signatures.
/vault/signatures/macho_custom_standard.cvd | Fichier pour Mach-O signatures.
/vault/signatures/macho_mussel_regex.cvd | Fichier pour Mach-O signatures.
/vault/signatures/macho_mussel_standard.cvd | Fichier pour Mach-O signatures.
/vault/signatures/mail_clamav_regex.cvd | Fichier pour mail signatures.
/vault/signatures/mail_clamav_regex.map | Fichier pour mail signatures.
/vault/signatures/mail_clamav_standard.cvd | Fichier pour mail signatures.
/vault/signatures/mail_clamav_standard.map | Fichier pour mail signatures.
/vault/signatures/mail_custom_regex.cvd | Fichier pour mail signatures.
/vault/signatures/mail_custom_standard.cvd | Fichier pour mail signatures.
/vault/signatures/mail_mussel_regex.cvd | Fichier pour mail signatures.
/vault/signatures/mail_mussel_standard.cvd | Fichier pour mail signatures.
/vault/signatures/md5_clamav.cvd | Fichier pour MD5 basé signatures.
/vault/signatures/md5_custom.cvd | Fichier pour MD5 basé signatures.
/vault/signatures/md5_mussel.cvd | Fichier pour MD5 basé signatures.
/vault/signatures/metadata_clamav.cvd | Fichier pour métadonnées d'archives signatures.
/vault/signatures/metadata_custom.cvd | Fichier pour métadonnées d'archives signatures.
/vault/signatures/metadata_mussel.cvd | Fichier pour métadonnées d'archives signatures.
/vault/signatures/ole_clamav_regex.cvd | Fichier pour les OLE signatures.
/vault/signatures/ole_clamav_regex.map | Fichier pour les OLE signatures.
/vault/signatures/ole_clamav_standard.cvd | Fichier pour les OLE signatures.
/vault/signatures/ole_clamav_standard.map | Fichier pour les OLE signatures.
/vault/signatures/ole_custom_regex.cvd | Fichier pour les OLE signatures.
/vault/signatures/ole_custom_standard.cvd | Fichier pour les OLE signatures.
/vault/signatures/ole_mussel_regex.cvd | Fichier pour les OLE signatures.
/vault/signatures/ole_mussel_standard.cvd | Fichier pour les OLE signatures.
/vault/signatures/pdf_clamav_regex.cvd | Fichier pour les PDF signatures.
/vault/signatures/pdf_clamav_regex.map | Fichier pour les PDF signatures.
/vault/signatures/pdf_clamav_standard.cvd | Fichier pour les PDF signatures.
/vault/signatures/pdf_clamav_standard.map | Fichier pour les PDF signatures.
/vault/signatures/pdf_custom_regex.cvd | Fichier pour les PDF signatures.
/vault/signatures/pdf_custom_standard.cvd | Fichier pour les PDF signatures.
/vault/signatures/pdf_mussel_regex.cvd | Fichier pour les PDF signatures.
/vault/signatures/pdf_mussel_standard.cvd | Fichier pour les PDF signatures.
/vault/signatures/pex_custom.cvd | Fichier pour les PE étendues signatures.
/vault/signatures/pex_mussel.cvd | Fichier pour les PE étendues signatures.
/vault/signatures/pe_clamav.cvd | Fichier pour les PE Sectional signatures.
/vault/signatures/pe_custom.cvd | Fichier pour les PE Sectional signatures.
/vault/signatures/pe_mussel.cvd | Fichier pour les PE Sectional signatures.
/vault/signatures/swf_clamav_regex.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/swf_clamav_regex.map | Fichier pour les Shockwave signatures.
/vault/signatures/swf_clamav_standard.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/swf_clamav_standard.map | Fichier pour les Shockwave signatures.
/vault/signatures/swf_custom_regex.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/swf_custom_standard.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/swf_mussel_regex.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/swf_mussel_standard.cvd | Fichier pour les Shockwave signatures.
/vault/signatures/switch.dat | Contrôle et définit certaines variables.
/vault/signatures/urlscanner.cvd | Fichier pour l'URL scanner signatures.
/vault/signatures/whitelist_clamav.cvd | Fichier spécifique blanche liste.
/vault/signatures/whitelist_custom.cvd | Fichier spécifique blanche liste.
/vault/signatures/whitelist_mussel.cvd | Fichier spécifique blanche liste.
/vault/signatures/xmlxdp_clamav_regex.cvd | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_regex.map | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_standard.cvd | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_standard.map | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_custom_regex.cvd | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_custom_standard.cvd | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_mussel_regex.cvd | Fichier pour XML/XDP signatures.
/vault/signatures/xmlxdp_mussel_standard.cvd | Fichier pour XML/XDP signatures.
/vault/template.html | Modèle fichier; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/template_custom.html | Modèle fichier; Modèle pour l'HTML sortie produit par phpMussel pour son bloqués fichiers téléchargement message (le message vu par l'envoyeur).
/vault/update.dat | Fichier contenant les version informations pour le script et les signatures de phpMussel. Si jamais vous voulez à réactualiser automatiquement phpMussel ou réactualiser phpMussel par votre navigateur, ce fichier est indispensable.
/vault/update.inc | Réactualiser Script; Requis pour automatique réactualisation et pour réactualisation phpMussel par votre navigateur, mais n'est pas autrement requise.
/vault/upload.inc | Module de téléchargements.

※ Noms du fichiers peut varier basé sur configuration stipulations (dans `phpmussel.ini`).

####*CONCERNANT LES SIGNATURES FICHIERS*
CVD est un acronyme pour "ClamAV Virus Definitions", en référence à la façon ClamAV réfère à ses signatures et à l'utilisation de ces signatures en phpMussel; Les fichiers terminant par "CVD" contiennent signatures.

Les fichiers terminant par "MAP" tracer qui signatures phpMussel devrait et ne devrait pas être utilisé pour individuelle analyse; Pas toutes les signatures sont nécessairement requises pour chaque unique analyse, ainsi, phpMussel utilise cartes fichiers des signatures afin d'accélérer le processus d'analyse (un processus qui, autrement, serait extrêmement lent et fastidieux).

Signature fichiers marqué avec "_regex" contenir signatures qui utilisent regular expression modèle vérification (regex).

Signature fichiers marqué avec "_standard" contenir signatures qui n'utilisent toute spécifique forme de modèle vérification.

Signature fichiers non marqués avec "_regex" ou "_standard" seront aussi l'un ou l'autre (mais pas deux); Référer à la Signature Format section de ce README fichier pour la documentation et les spécifiques détails.

Signature fichiers marqué avec "_clamav" contient signatures entièrement basée du ClamAV base de données (GNU/GPL).

Signature fichiers marqué avec "_custom", par défaut, ne contiennent pas de signatures; Ces fichiers existent à donner vous un place pour placer vos propres personnalisées signatures, si vous créez une partie de votre propre.

Signature fichiers marqué avec "_mussel" contenir signatures qui ne sont pas spécifiquement provenant par ClamAV, signatures qui, en général, je développé par moi-même et/ou basé sur informations recueillies de diverses sources.

---


###6. <a name="SECTION6"></a>CONFIGURATION OPTIONS
Ce qui suit est une liste de variables trouvé dans le `phpmussel.ini` configuration fichier de phpMussel, avec une description de leur objet et leur fonction.

####"general" (Catégorie)
Configuration générale pour phpMussel.

"script_password"
- Par commodité, phpMussel permettra certaines fonctions (inclus la capacité de réactualiser phpMussel sur la volée) pour être déclenché manuellement via POST, GET et QUERY. Cependant, par mesure de sécurité, pour ce faire, phpMussel s'attend à un mot de passe pour être inclus dans la commande, à assurer que c'est vous, et pas quelqu'un d'autre, attenter de déclencher manuellement ces fonctions. Fixer `script_password` à le mot de passe que vous souhaitez d'utiliser. Si aucun mot de passe est fixé, déclenchement manuel sera désactivé par défaut. Utiliser quelque chose que vous souvenez, mais qui est difficile à deviner.
- N'a pas d'influence en mode CLI.

"logs_password"
- La même comme `script_password`, mais par l'affichage du contenu de scan_log et scan_kills. Pour avoir distincts mots de passe peut être utile si vous voulez donner à quelqu'un autre accès à un ensemble de fonctions mais pas l'autre.
- N'a pas d'influence en CLI mode.

"cleanup"
- Déensemble variables du script et cache après l'exécution? False = Non; True = Oui [Défaut]. Si vous ne utilisez pas le script au-delà l'initiale analyse du téléchargements, devrait ensemble à `true` (oui) à minimiser l'utilisation de la mémoire. Si vous utilisez le script à des fins au-delà l'initiale analyse du téléchargements, devrait ensemble à `false` (non), pour éviter recharger inutilement dupliqué données dans la mémoire. Dans la pratique générale, il devrait probablement être ensemblé à `true`, mais, si vous faites cela, vous ne serez pas être capable d'utiliser le script pour tout chose autre que l'analyse des fichiers téléchargements.
- N'a pas d'influence en CLI mode.

"scan_log"
- Nom du fichier à enregistrer tous les résultats de l'analyse. Spécifiez un nom de fichier, ou laisser vide à désactiver.

"scan_log_serialized"
- Nom du fichier à enregistrer tous les résultats de l'analyse (le format est sérialisé). Spécifiez un nom de fichier, ou laisser vide à désactiver.

"scan_kills"
- Nom du fichier à enregistrer tous les résultats de bloqué ou tué téléchargements. Spécifiez un nom de fichier, ou laisser vide à désactiver.

"ipaddr"
- Où trouver l'IP adresse du connexion demande? (Utile pour services tels que Cloudflare et les goûts) Par Défaut = REMOTE_ADDR. AVERTISSEMENT: Ne pas changer si vous ne sais pas ce que vous faites!

"forbid_on_block"
- Devrait phpMussel envoyer 403 têtes avec le fichier téléchargement bloqué message, ou rester avec l'habitude 200 bien (200 OK)? False = Non (200) [Défaut]; True = Oui (403).

"delete_on_sight"
- Mise en cette option sera instruire le script à tenter immédiatement supprimer tout fichiers elle constate au cours de son analyse correspondant à des critères de détection, que ce soit via des signatures ou autrement. Fichiers jugées "propre" ne seront pas touchés. Dans le cas des archives, l'ensemble d'archive sera supprimé (indépendamment de si le incriminé fichier est que l'un de plusieurs fichiers contenus dans l'archive). Pour le cas d'analyse de fichiers téléchargement, généralement, il n'est pas nécessaire d'activer cette option sur, parce généralement, PHP faire purger automatiquement les contenus de son cache lorsque l'exécution est terminée, ce qui signifie que il va généralement supprimer tous les fichiers téléchargés à travers elle au serveur sauf qu'ils ont déménagé, copié ou supprimé déjà. L'option est ajoutée ici comme une supplémentaire mesure de sécurité pour ceux dont copies de PHP peut pas toujours se comporter de la manière attendu. False = Après l'analyse, laissez le fichier tel quel [Défaut]; True = Après l'analyse, si pas propre, supprimer immédiatement.

"lang"
- Spécifier la défaut langue pour phpMussel.

"lang_override"
- Spécifiez si phpMussel devrait, quand c'est possible, remplacer la spécification du langage avec la préférence de langue déclarée par les demandes entrantes (HTTP_ACCEPT_LANGUAGE). False = Non [Défaut]; True = Oui.

"lang_acceptable"
- La `lang_acceptable` directive indique à phpMussel quelles langues peuvent être acceptées par le script de la part de `lang` ou de la part de `HTTP_ACCEPT_LANGUAGE`. Cette directive devrait **SEULEMENT** être modifié si vous ajoutez vos propres langues fichiers personnalisés ou retirer par force les langues fichiers. La directive est une chaîne de codes utilisés par ces langues acceptées par le script, délimité par des virgules.

"quarantine_key"
- phpMussel est capable de mettre en quarantaine le marqué fichier téléchargement tentatives en isolement au sein de la voûte de phpMussel, si cela est quelque chose que vous voulez qu'il fasse. L'utilisateurs de phpMussel qui souhaitent simplement de protéger leurs sites ou environnement d'hébergement sans avoir un profondément intérêt dans d'analyse de quelconque marqué fichier téléchargement tentatives devrait laisser cette fonctionnalité désactivée, mais tous les utilisateurs intéressés dans d'analyse plus approfondie de tenté fichier téléchargements pour la recherche des logiciels malveillants ou pour des choses semblables devraient permettre cette fonctionnalité. La quarantaine de marqué fichier téléchargement tentatives peut parfois aider également dans le débogage des faux positifs, si cela est quelque chose qui se produit fréquemment pour vous. Pour désactiver la fonctionnalité de quarantaine, il suffit de laisser la directive `quarantine_key` vide, ou effacer le contenu de cette directive si elle est pas déjà vide. Pour activer la fonctionnalité de quarantaine, entrer une valeur dans la directive. Le `quarantine_key` est une élément important de la sécurité de la fonctionnalité de quarantaine requis en tant que moyen de prévention de la fonctionnalité de quarantaine d'être exploités par des attaquants potentiels en tant que moyen de prévention toute potentielle exécution de données stockées dans la quarantaine. Le `quarantine_key` devrait être traité de la même manière que vos mots de passe: Le plus sera le mieux, et conservez-le bien. Pour un meilleur effet, utiliser en conjonction avec `delete_on_sight`.

"quarantine_max_filesize"
- La maximum taille autorisée de fichiers mis en quarantaine. Fichiers au-dessus de cette valeur ne sera pas placé en quarantaine. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. La valeur est en Ko. Défaut =2048 =2048Ko =2Mo.

"quarantine_max_usage"
- La maximale utilisation autorisée de la mémoire pour la quarantaine. Si la totale d'utilisée mémoire par la quarantaine atteint cette valeur, les anciens fichiers en quarantaine seront supprimés jusqu'à ce que la totale mémoire utilisée n'atteint pas cette valeur. Cette directive est un important moyen de rendre plus difficile pour des agresseurs potentiels d'inonder votre quarantaine avec des données non désirées ce qui pourrait causer l'emballement d'utilisation des données sur votre service d'hébergement. La valeur est en Ko. Défaut =65536 =65536Ko =64Mo.

"honeypot_mode"
- Lorsque le honeypot mode est activé, phpMussel va tenter de mettre en quarantaine tous les fichier téléchargements ce qu'il rencontre, indépendamment de si oui ou non le fichier en cours de téléchargement correspond à signature inclus, et aucune réelle analyse de ces fichier téléchargements tentatives va arriver. Cette fonctionnalité devrait être utile pour ceux qui souhaitent utiliser phpMussel pour des fins de logiciels malveillants ou virus recherche, mais il pas n'est recommandé d'activer cette fonctionnalité si l'utilisation prévue de phpMussel par l'utilisateur est l'analyse de fichier téléchargements comme la norme, ni est-il recommandé d'utiliser la honeypot fonctionnalité pour fins autres que de honeypotting. Par défaut, cette option est désactivée. False = Désactivé [Défaut]; True = Activé.

"scan_cache_expiry"
- Pour combien de temps devrait phpMussel cache les résultats de l'analyse? La valeur est le nombre de secondes pour mettre en cache les résultats de l'analyse pour. Par défaut est 21600 secondes (6 heures); Une valeur de 0 désactive mettre en cache les résultats de l'analyse.

"disable_cli"
- Désactiver CLI mode? CLI mode est activé par défaut, mais peut parfois interférer avec certains test outils (comme PHPUnit, par exemple) et d'autres applications basées sur CLI. Si vous n'avez pas besoin désactiver CLI mode, vous devrait ignorer cette directive. False = Activer CLI mode [Défaut]; True = Désactiver CLI mode.

####"signatures" (Catégorie)
Configuration pour les signatures.
- %%%_clamav = ClamAV signatures (mains et daily).
- %%%_custom = Vos signatures personnalisés (si vous avez écrit tout).
- %%%_mussel = phpMussel signatures incluses dans votre courant ensemble des signatures qui ne sont pas de ClamAV.

Vérifier contre MD5 signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Vérifier contre général signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "general_clamav"
- "general_custom"
- "general_mussel"

Vérifier contre normalisé ASCII signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Vérifier contre normalisé HTML signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "html_clamav"
- "html_custom"
- "html_mussel"

Vérifier PE (Portable Exécutable) fichiers (EXE, DLL, etc) contre PE Sectional signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Vérifier PE (Portable Exécutable) fichiers (EXE, DLL, etc) contre PE étendues signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "pex_custom"
- "pex_mussel"

Vérifier PE (Portable Exécutable) fichiers (EXE, DLL, etc) contre PE signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Vérifier ELF fichiers contre ELF signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Vérifier Mach-O fichiers (OSX, etc) contre Mach-O signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Vérifier graphiques fichiers contre graphiques basé signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Vérifier archives contenu contre archive métadonnées signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Vérifier OLE objets contre OLE signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Vérifier les noms de fichiers contre signatures basé sur les noms de fichiers au cours de analyse? False = Non; True = Oui [Défaut].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Autoriser analyse avec phpMussel_mail()? False = Non; True = Oui [Défaut].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Activer fichier spécifique blanche liste? False = Non; True = Oui [Défaut].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Vérifier XML/XDP contre XML/XDP signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Vérifier contre complexes étendues signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Vérifier contre PDF signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Vérifier contre Shockwave signatures au cours de analyse? False = Non; True = Oui [Défaut].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Signature correspondance longueur limiter options. Seulement modifier si vous savez ce que vous faites. SD = Standard signatures. RX = PCRE (Perl Compatibles Régulières Expressions, ou "Regex") signatures. FN = Nom de fichier signatures. Si vous remarquez PHP s'écraser quand phpMussel tentatives d'analyse, tenter à réduire ces "max" valeurs. Si possible et pratique, laissez-moi savoir quand cela se produit et les résultats de ce que vous essayez.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Devrait phpMussel signaler lorsque les signatures fichiers sont manquants ou endommagés? Si fail_silently est désactivé, fichiers manquants et corrompus seront signalé sur analyse, et si fail_silently est activé, fichiers manquants et corrompus seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. Cela devrait généralement être laissé seul sauf si vous rencontrez accidents ou similaires problèmes. False = Désactivé; True = Activé [Défaut].

"fail_extensions_silently"
- Devrait phpMussel signaler lorsque les extensions sont manquantes? Si fail_extensions_silently est désactivé, extensions manquantes seront signalé sur analyse, et si fail_extensions_silently est activé, extensions manquantes seront ignorés, avec l'analyse signalés pour ceux fichiers qu'il n'y a pas de problèmes. La désactivation de cette directive peut potentiellement augmenter votre sécurité, mais peut aussi conduire à une augmentation de faux positifs. False = Désactivé; True = Activé [Défaut].

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

####"files" (Catégorie)
Générale configuration pour gestion des fichiers.

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
- Actuellement, seulement l'examen de BZ, GZ, LZF et ZIP fichiers est supporté (l'examen RAR, CAB, 7z etc actuellement pas supporté).
- Ce n'est pas à toute épreuve! Bien que je recommande fortement d'avoir ce reste activée, je ne peux pas garantir il va toujours trouver tout.
- Aussi être conscient que l'examen d'archives actuellement n'est pas récursif pour ZIPs.

"filesize_archives"
- Étendre taille du fichier liste noire/blanche paramètres à le contenu des archives? False = Non (énumérer grise tout); True = Oui [Défaut].

"filetype_archives"
- Étendre type de fichier liste noire/blanche paramètres à le contenu des archives? False = Non (énumérer grise tout); True = Oui [Défaut].

"max_recursion"
- Maximum récursivité profondeur limite pour archives. Défaut = 10.

"block_encrypted_archives"
- Détecter et bloquer les archives cryptées? Parce phpMussel est pas capable d'analyse du contenu des archives cryptées, il est possible que le cryptage des archives peut être utilisé par un attaquant un moyen a tenter de contourner phpMussel, analyseurs anti-virus et d'autres protections. Instruire phpMussel pour bloquer toutes les archives cryptées qu'il découvre pourrait aider à réduire les risques associés à ces possibilités. False = Non; True = Oui [Défaut].

####"attack_specific" (Catégorie)
Configuration pour les spécifique attaque détections (pas basé sur CVDs).

Caméléon Attaque Détection: False = Désactivé; True = Activé.

"chameleon_from_php"
- Vérifier pour PHP tête dans les fichiers qui sont ni PHP fichiers ni reconnue comme archives.

"chameleon_from_exe"
- Vérifier pour exécutable têtes dans les fichiers qui sont ni exécutable fichiers ni reconnue comme archives et pour exécutables dont têtes sont incorrects.

"chameleon_to_archive"
- Vérifier pour archives dont têtes sont incorrects (Supporté: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Vérifier pour office documents dont têtes sont incorrects (Supporté: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Vérifier pour images dont têtes sont incorrects (Supporté: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Vérifier pour PDF fichiers dont têtes sont incorrects.

"archive_file_extensions" et "archive_file_extensions_wc"
- Les extensions de reconnus archive fichiers (format est CSV; devraient ajouter ou supprimer seulement quand problèmes surviennent; supprimer inutilement peut entraîner des faux positifs à paraître pour archive fichiers, tandis que ajoutant inutilement sera essentiellement liste blanche ce que vous ajoutez à partir de l'attaque spécifique détection; modifier avec prudence; aussi noter que cela n'a aucun effet sur ce archives peut et ne peut pas être analysé au niveau du contenu). La liste, comme en cas de défaut, énumère les formats plus couramment utilisé dans la majorité des systèmes et CMS, mais volontairement pas nécessairement complète.

"general_commands"
- Vérifier de fichiers pour des déclarations et des commandes générales comme `eval()` et `exec()`? False = Non (pas vérifier) [Défaut]; True = Oui (vérifier). Définir à `false` si vous avez l'intention à téléchargez de la suivant à votre système ou CMS via votre navigateur: PHP, JavaScript, HTML, python, perl fichiers, etc. Définir à `true` si vous n'avez pas supplémentaire protections pour votre système et n'ont pas l'intention de téléchargement de ces fichiers. Si vous utilisez supplémentaire sécurité en conjonction avec phpMussel (comme ZB Block), il n'est pas nécessaire d'activer cette directive, parce la plupart de que phpMussel va chercher pour (dans le contexte de cette directive) sont duplications de protections qui sont déjà fournis.

"block_control_characters"
- Bloquer tous les fichiers contenant les caractères de contrôle (autre que les sauts de ligne)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Si vous êtes _**SEULEMENT**_ télécharger de brut texte fichiers, puis vous pouvez activer cette option à fournir une supplémentaire protection à votre système. Mais, si vous télécharger quelque chose plus que brut texte, l'activation de cette peut créer faux positifs. False = Ne pas bloquer [Défaut]; True = Bloquer.

"corrupted_exe"
- Corrompus fichiers et des erreurs d'analyse. False = Ignorer; True = Bloquer [Défaut]. Détecter et bloquer les potentiellement corrompus PE (Portable Executable) fichiers? Souvent (mais pas toujours), lorsque certains aspects d'un PE fichier sont corrompus ou ne peut pas être analysée correctement, il peut être le signe d'une virale infection. Les processus utilisés par la plupart des anti-virus programmes pour détecter les virus dans PE fichiers requérir l'analyse de ces fichiers par certaines méthodes, de ce que, si le programmeur d'un virus est conscient de, seront spécifiquement tenter d'empêcher, en vue de permettre leur virus n'être pas détectée.

"decode_threshold"
- Facultatif limitation ou seuil à la longueur de brutes données dans laquelle commandes des décodages doivent être détectés (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). La valeur est un entier représentant la tailles des fichiers en Ko. Défaut = 512 (512Ko). Zéro ou nulle valeur désactive le seuil (supprimant toute restriction basé sur la taille du fichier).

"scannable_threshold"
- Facultatif limitation ou seuil à la longueur de brutes données dans laquelle phpMussel est autorisé à lire et à analyser (dans le cas où il ya remarquable performance problèmes au cours de l'analyse). La valeur est un entier représentant la tailles des fichiers en Ko. Défaut = 32768 (32Mo). Zéro ou nulle valeur désactive le seuil. En général, cette valeur ne doit pas être moins que la moyenne tailles des fichiers des téléchargements que vous voulez et s'attendent à recevoir de votre serveur ou website, ne devrait pas être plus que la filesize_limit directive, et ne devrait pas être plus que d'un cinquième de l'allocation de totale mémoire autorisée à PHP via le php.ini configuration fichier. Cette directive existe pour tenter d'empêcher phpMussel d'utiliser trop de mémoire (ce qui l'empêcherait d'être capable d'analyse fichiers dessus d'une certaine taille avec succès).

####"compatibility" (Catégorie)
Compatibilité directives pour phpMussel.

"ignore_upload_errors"
- Cette directive doit généralement être DÉSACTIVÉ sauf si cela est nécessaire pour la correcte fonctionnalité de phpMussel sur votre spécifique système. Normalement, lorsque DÉSACTIVÉ, lorsque phpMussel détecte la présence d'éléments dans le `$_FILES`() tableau, il va tenter de lancer une analyse du fichiers que ces éléments représentent, et, si ces éléments sont vide, phpMussel retourne un message d'erreur. Ce comportement est normal pour phpMussel. Mais, pour certains CMS, vides éléments dans `$_FILES` peuvent survenir à la suite du naturel comportement de ces CMS, ou erreurs peuvent être signalés quand il ne sont pas tout, dans ce cas, le normal comportement pour phpMussel seront interférer avec le normal comportement de ces CMS. Si telle une situation se produit pour vous, ACTIVATION de cette option sera instruire phpMussel ne pas à tenter de lancer d'analyses pour ces vides éléments, ignorer quand il est reconnu et ne pas à retourner tout de connexes messages d'erreur, permettant ainsi la continuation de la page demande. False = DÉSACTIVÉ; True = ACTIVÉ.

"only_allow_images"
- Si vous seulement attendre ou vouloir d'autoriser images à être téléchargé sur votre système ou CMS, et si vous absolument n'avez pas besoin tous les fichiers autres que les images à être téléchargé sur votre système ou CMS, cette directive devrait être ACTIVÉ, mais devrait autrement être DÉSACTIVÉ. Si cette directive est ACTIVÉ, il va instruire phpMussel à bloquer indistinctement tous téléchargements identifié comme non image fichiers, sans analyser. Cela peut réduire le temps de travail et l'utilisation de la mémoire pour les tentativé téléchargements de non image fichiers. False = DÉSACTIVÉ; True = ACTIVÉ.

####"heuristic" (Catégorie)
Heuristiques directives pour phpMussel.

"threshold"
- Il ya certaines signatures des phpMussel qui sont destinés à identifier des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement sans en eux-mêmes identifier les fichiers en cours de téléchargement spécifiquement comme étant malveillants. Cette "threshold" (seuil) valeur raconte à phpMussel ce que le total maximum poids des suspectes et potentiellement malveillants qualités des fichiers en cours de téléchargement pour ce qui est admissible avant que ces fichiers doivent être signalées comme malveillant. La définition du poids dans ce contexte est le nombre total de suspectes et potentiellement malveillants qualités identifié. Par défaut, cette valeur sera fixée à 3. Une valeur inférieur va résulter généralement avec une fréquence supérieur de faux positifs mais une nombre supérieur de fichiers signalé comme malveillant, tandis que une valeur inférieur va résulter généralement avec une fréquence inférieur de faux positifs mais un nombre inférieur de fichiers signalé comme malveillant. Il est généralement préférable de laisser cette valeur à sa valeur défaut, sauf si vous rencontrez des problèmes qui sont liés à elle.

####"virustotal" (Catégorie)
Configuration pour Virus Total intégration.

"vt_public_api_key"
- Facultativement, phpMussel est capable d'analyser les fichiers en utilisant le Virus Total API comme un moyen de fournir un renforcée niveau de protection contre les virus, trojans, logiciels malveillants et autres menaces. Par défaut, l'analyse des fichiers en utilisant le Virus Total API est désactivé. Pour activer, une Total Virus API clé est nécessaire. En raison de le significative avantage que cela pourrait fournir pour vous, il est quelque chose que je recommande fortement pour l'activer. S'il vous plaît être conscient, cependant, que pour utiliser le Virus Total API, vous _**DEVEZ**_ accepter leurs conditions d'utilisation (Terms of Service) et vous _**DEVEZ**_ respecter toutes les directives selon décrit par le Virus Total documentation! Vous N'ÊTES PAS autorisé à utiliser cette fonctionnalité SAUF SI:
  - Vous avez lu et accepté les Conditions d'Utilisation (Terms of Service) de Total Virus et son API. Les Conditions d'Utilisation de Total Virus et son API peut être trouvé [Ici](https://www.virustotal.com/en/about/terms-of-service/).
  - Vous avez lu et vous comprendre, au minimum, le préambule du Virus Total Publique API documentation (tout ce qui suit "VirusTotal Public API v2.0" mais avant "Contents"). Le Virus Total Publique API documentation peut être trouvé [Ici](https://www.virustotal.com/en/documentation/public-api/).

Noter: Si l'analyse des fichiers en utilisant le Virus Total API est désactivé, vous ne serez pas besoin de revoir tout des directives dans cette catégorie (`virustotal`), parce qu'aucun d'eux ne fait rien si cette option est désactivée. Pour acquérir une Virus Total API clé, à partir de quelque part sur leur website, cliquez sur le "Rejoindre notre communauté" lien situé vers le haut à droite de la page, saisissez les informations demandées, et cliquez sur "S'enregistrer" quand vous avez terminé. Suivez toutes les instructions fournies, et quand vous avez votre publique API clé, copier/coller cette publique API clé à la `vt_public_api_key` directive du `phpmussel.ini` configuration fichier.

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

####"urlscanner" (Catégorie)
URL scanner configuration.

"urlscanner"
- Construit dans phpMussel est un URL scanner, capable de détecter les URL malveillantes à partir de toutes les données ou fichiers analysés. Pour activer le URL scanner, définir la directive `urlscanner` à true; Pour désactiver le URL scanner, définir cette directive à false.

Noter: Si le URL scanner est désactivé, vous ne serez pas besoin de revoir quelconque du directives dans cette catégorie (`urlscanner`), parce qu'aucun d'eux avoir une fonction si cette directive est désactivée.

URL scanner API chercher configuration.

"lookup_hphosts"
- Permet cherches de l'[hpHosts](http://hosts-file.net/) API quand définit comme true. hpHosts ne nécessite pas une API clé pour effectuer des cherches de l'API.

"google_api_key"
- Permet cherches du Google Safe Browsing API quand la API clé nécessaire est définie. Google Safe Browsing API cherches nécessite une API clé, qui peut être obtenu à partir [d'ici](https://console.developers.google.com/).
- Noter: Cette fonctionnalité est prévu pour l'avenir! Google Safe Browsing API fonctionnalité pas encore écrit!

"maximum_api_lookups"
- Nombre de cherches maximal de l'API pour effectuer par itération d'analyse individuelle. Parce que chaque API cherche supplémentaire va ajouter à la durée totale requise pour compléter chaque itération d'analyse, vous pouvez prévoir une limitation afin d'accélérer le processus d'analyse. Quand défini comme 0, pas de telles nombre maximum admissible sera appliquée. Défini comme 10 par défaut.

"maximum_api_lookups_response"
- Que faire si le nombre de cherches de l'API maximal est dépassée? False = Ne fais rien (poursuivre le traitement) [Défaut]; True = Marque/bloquer le fichier.

"cache_time"
- Combien de temps (en secondes) devrait les résultats du cherches de l'API être conservé dans le cache? Défaut est 3600 secondes (1 heure).

####"template_data" (Catégorie)
Directives/Variables pour les modèles et thèmes.

Modèles données est liée à la sortie HTML utilisé pour générer le "Téléchargement Refusé" message affiché aux utilisateurs sur un fichier téléchargement est bloqué. Si vous utilisez des thèmes personnalisés pour phpMussel, sortie HTML provient du `template_custom.html` fichier, et sinon, sortie HTML provient du `template.html` fichier. Variables écrites à cette section du configuration fichier sont préparé pour la sortie HTML par voie de remplacer tous les noms de variables circonfixé par accolades trouvés dans la sortie HTML avec les variables données correspondant. Par exemple, où `foo="bar"`, toute instance de `<p>{foo}</p>` trouvés dans la sortie HTML deviendra `<p>bar</p>`.

"css_url"
- Le modèle fichier pour des thèmes personnalisés utilise les propriétés CSS externes, tandis que le modèle fichier pour le défaut thème utilise les propriétés CSS internes. Pour instruire phpMussel d'utiliser le modèle fichier pour des thèmes personnalisés, spécifier l'adresse HTTP public de votre thèmes personnalisés CSS fichiers utilisant le `css_url` variable. Si vous laissez cette variable vide, phpMussel va utiliser le modèle fichier pour le défaut thème.

---


###7. <a name="SECTION7"></a>SIGNATURE FORMAT

####*NOM DE FICHIER SIGNATURES*
Toutes les nom de fichier signatures suivez le format:

`NOM:FNRX`

Où NOM est le nom à citer pour la signature et FNRX est l'expression rationnelle pour faire correspondre les (non codé) noms de fichiers.

####*MD5 SIGNATURES*
Toutes les MD5 signatures suivez le format:

`HASH:TAILLE:NOM`

Où HASH est le MD5 hash d'un ensemble du fichier, TAILLE est la totale taille du fichier et NOM est le nom à citer pour la signature.

####*ARCHIVE MÉTADONNÉES SIGNATURES*
Toutes les archive métadonnées signatures suivez le format:

`NOM:TAILLE:CRC32`

Où NOM est le nom à citer pour la signature, TAILLE est la totale taille (non compressé) d'un fichier contenues dans l'archive et CRC32 est la CRC32 contrôle somme de ce fichier contenu.

####*PE SECTIONAL SIGNATURES*
Toutes les PE Sectional signatures suivez le format:

`TAILLE:HASH:NOM`

Où HASH est le MD5 hash d'un section du PE fichier, TAILLE est la totale taille de cet section et NOM est le nom à citer pour la signature.

####*PE ÉTENDUES SIGNATURES*
Toutes les PE étendues signatures suivez le format:

`$VAR:HASH:TAILLE:NOM`

Où $VAR est le nom de la PE variable à comparer contre, HASH est le MD5 hachage de cette variable, TAILLE est la taille totale de cette variable et NOM est le nom de à pour cette signature.

####*BLANCHE LISTE SIGNATURES*
Toutes les blanche liste signatures suivez le format:

`HASH:TAILLE:TYPE`

Où HASH est le MD5 hash d'un ensemble du fichier, TAILLE est la totale taille du fichier et TYPE est le type de signatures le listé blanche fichier est d'être immunitaire contre.

####*COMPLEXES ÉTENDUES SIGNATURES*
Complexes étendues signatures sont assez différentes pour les autres types de signatures possible avec phpMussel, dans que ce qu'ils vérifient contre est spécifié par les signatures elles-mêmes et ils peuvent vérifier contre plusieurs critères. Les critères sont délimitées par ";" et le type et les données de chacun critères est délimitée par ":" comme ainsi le format de ces signatures tendances à semble un peu comme:

`$variable1:CERTAINSDONNÉES;$variable2:CERTAINSDONNÉES;SignatureNom`

####*TOUT LE RESTE*
Toutes les autre signatures suivez le format:

`NOM:HEX:FROM:TO`

Où NOM est le nom à citer pour la signature et HEX est un hexadécimal codé segment du fichier destiné à être identifié par la signature donnée. FROM et TO sont optionnel paramètres, indication de laquelle et à laquelle les positions dans les source données pour vérifier contre (non supporté par la mail fonction).

####*REGEX*
Toute forme de regex comprise et préparé correctement par PHP devrait aussi être correctement compris et préparé par phpMussel et ses signatures. Mais, je vous suggère de prendre une extrême prudence lors de l'écriture de nouvelles regex basé signatures, parce, si vous n'êtes pas entièrement sûr de ce que vous faites, il peut y avoir très irréguliers et/ou inattendus résultats. Jetez un oeil à la phpMussel source code si vous n'êtes pas entièrement sûr sur le contexte dans lequel regex déclarations sont analysés. Aussi, rappeler toutes les déclarations (à l'exception de nom de fichier, archive métadonnées et MD5 déclarations) doit être de codé de hexadécimale (à l'exception de déclaration syntaxe, bien sûr)!

####*OÙ METTRE DES PERSONNALISÉES SIGNATURES?*
Seulement mettre des personnalisées signatures dans les fichiers prévu pour personnalisées signatures. Ces fichiers devrait contenir "_custom" dans leur noms. Vous devrait aussi éviter modifier les défaut signature fichiers, sauf si vous savez exactement ce que vous faites, parce, en plus d'être une bonne pratique en général et aidant vous à distinguer entre vos signatures et le défaut signatures inclus avec phpMussel, il est bon de tenir à l'édition seuls les fichiers destinés à l'édition, parce que l'altération du défaut signature fichiers peut cessé leur fonctionner correctement, en raison des "maps" fichiers: Les maps fichiers racontent phpMussel où dans le signature fichiers à chercher pour requis signatures par phpMussel selon lorsque requis, et ces maps peut devenir désynchronisée avec leur associé signature fichiers si le signature fichiers sont altéré. Vous pouvez mettre à peu près ce que vous voulez dans vos personnalisée signatures, aussi longtemps que vous suivez la correcte syntaxe. Mais, être prudent à tester nouvelles signatures pour faux positifs avant si vous avez l'intention à partager ou utiliser dans un réel environnement.

####*SIGNATURE DÉTAIL*
Ce qui suit est un détail des types de signatures utilisées par phpMussel:
- "Normalisé ASCII Signatures" (ascii_*). Vérifié contre les contenus de chaque fichier non listé blanche et ciblée pour d'analyse.
- "Complexes Étendues Signatures" (coex_*). Mixte types des signatures correspondant.
- "ELF Signatures" (elf_*). Vérifié contre les contenus de chaque fichier non listé blanche, ciblée pour l'analyse et identifié au ELF format.
- "Portable Executable Signatures" (exe_*). Vérifié contre les contenus de chaque fichier non listé blanche, ciblée pour l'analyse et identifié au PE format.
- "Filename Signatures" (filenames_*). Vérifié contre les noms de fichiers ciblé pour d'analyse.
- "Générales Signatures" (general_*). Vérifié contre les contenus de chaque fichier non listé blanche et ciblée pour d'analyse.
- "Graphics Signatures" (graphics_*). Vérifié contre les contenus de chaque fichier non listé blanche, ciblée pour l'analyse et identifié à un connu graphique fichier format.
- "Générales Commandes" (hex_general_commands.csv). Vérifié contre les contenus de chaque fichier non listé blanche et ciblée pour d'analyse.
- "Normalisé HTML Signatures" (html_*). Vérifié contre les contenus de chaque fichier de HTML non listé blanche et ciblée pour d'analyse.
- "Mach-O Signatures" (macho_*). Vérifié contre les contenus de chaque fichier non listé blanche, ciblée pour l'analyse et identifié au Mach-O format.
- "Email Signatures" (mail_*). Vérifié contre le $corps variable analysée à la phpMussel_mail() fonction, qui est destiné à être le corps des e-mails ou similaire entités (potentiellement messages du forum et etc).
- "MD5 Signatures" (md5_*). Vérifié contre le MD5 hash des contenus et taille de chaque fichier non listé blanche et ciblée pour d'analyse.
- "Archives Métadonnées Signatures" (metadata_*). Vérifié contre le CRC32 hash et taille de l'initial fichier contenu à l'intérieur de toute archive non listé blanche et ciblée pour d'analyse.
- "OLE Signatures" (ole_*). Vérifié contre les contenus de chaque objet non listé blanche et ciblée pour d'analyse.
- "PDF Signatures" (pdf_*). Vérifié contre les contenus de chaque PDF fichier non listé blanche.
- "Portable Executable Sectional Signatures" (pe_*). Vérifié contre le taille et l'MD5 hash des sections de chaque fichier non listé blanche, ciblée pour l'analyse et identifié au PE format.
- "Portable Executable Étendues Signatures" (pex_*). Vérifié contre le taille et l'MD5 hash des variables de chaque fichier non listé blanche, ciblée pour l'analyse et identifié au PE format.
- "SWF Signatures" (swf_*). Vérifié contre les contenus de chaque Shockwave fichier non listé blanche.
- "Blanche Liste Signatures" (whitelist_*). Vérifié contre le MD5 hash des contenus et la taille de chaque fichier ciblée pour d'analyse. Les identifiés fichiers sera immunitaire d'être identifié par le type de signature mentionné dans leur entrée de blanche liste.
- "XML/XDP Signatures" (xmlxdp_*). Vérifié contre de chaque XML/XDP trouvés dans tout fichier non listé blanche et ciblée pour l'analyse.
(Noter que ces signatures peut être désactivé facilement via `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>CONNUS PROBLÈMES DE COMPATIBILITÉ

####PHP et PCRE
- phpMussel requérir PHP et PCRE à signer et à fonctionner correctement. Sans PHP, ou sans le PCRE extension de PHP, phpMussel n'exécutera pas ou fonctionnent correctement. Devrait s'assurer que votre système avoir PHP et PCRE installé et disponible avant de votre téléchargement et installation de phpMussel.

####LOGICIELS ANTI-VIRUS COMPATIBILITÉ

Pour la plupart, phpMussel devrait être assez compatible avec plupart du virus détection logiciels. Cependant, conflictualités ont été signalés par un nombre d'utilisateurs dans le passé. Cette information ci-dessous est VirusTotal.com, et il décrit un certain nombre de faux positifs signalé par divers anti-virus programmes contre phpMussel. Bien que cette information ne constitue pas une absolue garantie de si oui ou non vous rencontrerez des problèmes de compatibilité entre phpMussel et votre anti-virus logiciel, si votre logiciel anti-virus est noté comme signalant contre phpMussel, vous devriez envisager désactivation avant à travailler avec phpMussel ou devrait envisager d'autres options soit votre logiciel anti-virus ou phpMussel.

Cette information a été réactualisé le 25 Février 2016 et est courant pour toutes les phpMussel parutions des deux plus récentes mineures versions (v0.9.0-v0.10.0) au moment de la rédaction de cette.

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
| Baidu-International  |  Pas problèmes connus                |
| BitDefender          |  Pas problèmes connus                |
| Bkav                 |  Rapports "VEXC640.Webshell" et "VEXD737.Webshell"|
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


Dernière Réactualisé: 25 Février 2016 (2016.02.25).
