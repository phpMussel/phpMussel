      _____  _     _  _____  _______ _     _ _______ _______ _______           
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    

                            { ~ ~ ~ FRANÇAIS ~ ~ ~ }                           
  Merci pour d'utiliser phpMussel, un script en PHP basé sur les signatures de 
  ClamAV conçus pour détecter les virus, les malveillants logiciels et autres  
     menaces dans les fichiers téléchargés sur votre système partout où le     
                              script est accroché.                             
     PHPMUSSEL COPYRIGHT 2013 et au-delà GNU/GPL V.2 by Caleb M (Maikuolan)    

                                     ~ ~ ~                                     


 CONTENU
 1. PRÉAMBULE
 2A. COMMENT INSTALLER (POUR WEB SERVEURS)
 2B. COMMENT INSTALLER (POUR CLI)
 3A. COMMENT UTILISER (POUR WEB SERVEURS)
 3B. COMMENT UTILISER (POUR CLI)
 4A. NAVIGATEUR COMMANDES
 4B. CLI (COMMANDE LIGNE INTERFACE)
 5. FICHIERS INCLUS DANS CES EMPAQUETER
 6. CONFIGURATION OPTIONS
 7. SIGNATURE FORMAT
 8. CONNUS PROBLÈMES DE COMPATIBILITÉ

                                     ~ ~ ~                                     


 1. PRÉAMBULE

 Un spécial merci à ClamAV pour l'inspiration du le projet et pour les         
 signatures que ce script utilise, sans qui, le script ne seraient             
 probablement pas exister, ou, au mieux, auraient avoir un très limité         
 valeur. <http://www.clamav.net/lang/en/>                                      

                                     ~ ~ ~                                     
 Ce script est un logiciel libre; vous pouvez redistribuer et/ou le modifier   
 selon les termes de la GNU General Public License telle que publiée par la    
 Free Software Foundation; soit la version 2 de la Licence, ou (à votre choix) 
 toute version ultérieure. Ce script est distribué dans l'espoir qu'il sera    
 utile, mais SANS AUCUNE GARANTIE, sans même la implicite garantie de          
 COMMERCIALISATION ou D'ADAPTATION À UN PARTICULIER USAGE. Voir la GNU General 
 Public License pour plus de détails.                                          
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>              

                                     ~ ~ ~                                     
 Ce document et son associé empaqueter peuvent être téléchargés gratuitement à
 sans frais de Sourceforge. <http://sourceforge.net/projects/phpmussel/>

                                     ~ ~ ~                                     


 2A. COMMENT INSTALLER (POUR WEB SERVEURS)

 J'ai l'intention de simplifier ce processus par la création d'un programme
 d'installation à l'avenir, mais en attendant, suivez ces instructions pour
 la correcte fonction de phpMussel sur la majorité de systèmes et CMS:

 1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une
    archivée copie du script, décompressé son contenu et l'ont assis sur votre
    locale machine. Maintenant, vous devez déterminer l'approprié emplacement
    sur votre hôte ou CMS à mettre ces contenus. Un répertoire comme
    /public_html/phpmussel/ ou similaire (cependant, il n'est pas question que
    vous choisissez, à condition que c'est quelque part de sûr et quelque part
    que vous êtes heureux avec) sera suffira. Vous avant commencer
    téléchargement au serveur, continuer lecture..

 2) Ouvrir "phpmussel.php", cherchez pour la ligne commençant par "$vault=",
    et remplacez la string entre guillemets suivantes sur cette ligne avec le
    véritable exact emplacement du le répertoire "vault" de phpMussel. Vous
    aurez remarqué un tel dossier dans l'archive que vous avez téléchargé (sauf
    si vous sentez à nouveau codage de l'ensemble du script, vous aurez besoin
    à maintenir la même structure de fichiers et de répertoires comme il était
    dans l'origine archive). Ce "vault" répertoire devrait être d'un niveau
    au-dessus le répertoire que le fichier "phpmussel.php" existera po.
    Enregistrer le fichier, fermer.

 3) (En option; Fortement recommandé pour l'avancés utilisateurs, mais pas
    recommandé pour les débutants ou pour les novices): Ouvrir "phpmussel.ini"
    (situé à l'intérieur de "vault") - Ce fichier contient toutes les
    directives disponible pour phpMussel. Au-dessus de chaque option devrait
    être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour.
    Réglez ces options comme bon vous semble, selon ce qui est approprié pour
    votre particulière configuration. Enregistrer le fichier, fermer.

 4) Téléchargez le contenu (phpMussel et ses fichiers) à le répertoire vous
    aviez décidé plus tôt (vous n'avez pas besoin le readme.XX.txt ou le
    change_log.txt fichiers inclus, mais, surtout, vous devriez télécharger
    tous les fichiers sur le serveur).

 5) CMHOD la "vault" répertoire à "777". Le principal répertoire qui est
    stocker le contenu (celui que vous avez choisi plus tôt), généralement,
    peut être laissé seul, mais CHMOD état devrait être vérifié si vous avez eu
    problèmes d'autorisations dans le passé sur votre système (par défaut,
    devrait être quelque chose comme "755").

 6) Suivant, vous aurez besoin de "crochet" phpMussel à votre système ou CMS.
    Il est plusieurs façons vous pouvez "crochet" phpMussel à votre système ou
    CMS, mais le plus simple est à simplement inclure le script au début d'un
    fichier de la base de données de votre système ou CMS (un qui va
    généralement toujours être chargé lorsque quelqu'un accède à n'importe
    quelle page sur votre website) utilisant un require ou include commande.
    Généralement, ce sera quelque chose de stocké dans un répertoire comme
    "/includes", "/assets" ou "/functions", et il sera souvent nommé quelque
    chose comme "init.php", "common_functions.php", "functions.php" ou
    similaire. Vous sera besoin à déterminer qui est le fichier c'est pour
    votre situation. Pour ce faire, insérez la ligne de code suivante au début
    de ce le noyau fichier et remplacer la string contenue à l'intérieur des
    guillemets avec l'exacte adresse le fichier "phpmussel.php" (l'adresse
    locale, pas l'adresse HTTP; il ressemblera l'adresse de "vault" mentionné
    précédemment).

    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>

    Enregistrer le fichier, fermer, rétélécharger.

 7) À ce stade, vous avez fini! Cependant, vous devriez probablement tester ce
    pour s'assurer qu'il fonctionne correctement. Pour tester les protections,
    essayez de télécharger les tester fichiers inclus dans le empaqueter sous
    "_testfiles" à votre website par votre habituelles navigateur basé méthodes
    de téléchargement. Si tout fonctionne correctement, un message devrait
    apparaître à partir de phpMussel confirmant que le téléchargement a été
    bloqué avec succès. Si rien ne s'affiche, quelque chose ne fonctionne pas
    correctement. Si vous utilisez d'avancées fonctions ou si vous utilisez
    l'autres types d'analyse possibles avec l'outil, je vous suggère de
    l'essayer avec ceux pour s'assurer qu'il fonctionne comme prévu, aussi.

                                     ~ ~ ~                                     


 2B. COMMENT INSTALLER (POUR CLI)

 J'ai l'intention de simplifier ce processus par la création d'un programme
 d'installation à l'avenir, mais en attendant, suivez ces instructions pour
 rendant phpMussel disposé de travailler avec CLI (être conscient que, à ce
 stade, CLI support est uniquement pour les Windows systèmes; Linux et d'autres
 systèmes seront bientôt arriver à une ultérieure version de phpMussel):

 1) Parce que vous lisez ceci, je suppose que vous avez déjà téléchargé une
    archivée copie du script, décompressé son contenu et l'ont assis sur votre
    locale machine. Lorsque vous avez déterminé que vous êtes satisfait sur
    l'emplacement choisi pour phpMussel, continuer.

 2) phpMussel exige php d'être installé sur l'hôte ordinateur afin d'exécuter.
    Si vous n'avez pas de php installé sur votre machine, s'il vous plaît
    installer php sur votre machine, suivant les instructions fournies par le
    programme d'installation de php.

 2) Ouvrir "phpmussel.php", cherchez pour la ligne commençant par "$vault=",
    et remplacez la string entre guillemets suivantes sur cette ligne avec le
    véritable exact emplacement du le répertoire "vault" de phpMussel. Vous
    aurez remarqué un tel dossier dans l'archive que vous avez téléchargé (sauf
    si vous sentez à nouveau codage de l'ensemble du script, vous aurez besoin
    à maintenir la même structure de fichiers et de répertoires comme il était
    dans l'origine archive). Ce "vault" répertoire devrait être d'un niveau
    au-dessus le répertoire que le fichier "phpmussel.php" existera po.
    Enregistrer le fichier, fermer.

 4) (En option; Fortement recommandé pour l'avancés utilisateurs, mais pas
    recommandé pour les débutants ou pour les novices): Ouvrir "phpmussel.ini"
    (situé à l'intérieur de "vault") - Ce fichier contient toutes les
    directives disponible pour phpMussel. Au-dessus de chaque option devrait
    être un bref commentaire décrivant ce qu'il fait et ce qu'il est pour.
    Réglez ces options comme bon vous semble, selon ce qui est approprié pour
    votre particulière configuration. Enregistrer le fichier, fermer.

 5) (En option) Vous pouvez faire utilisant phpMussel en CLI mode plus facile
    pour vous-même par la création d'un fichier de commandes pour automatique
    charger php et phpMussel. Pour ce faire, ouvrir un éditeur de texte comme
    Notepad ou Notepad++, tapez le complet chemin vers le "php.exe" fichier
    dans le répertoire de votre installation de PHP, suivi d'un espace, suivi
    par le complet chemin vers le "phpmussel.php" fichier dans le répertoire de
    votre installation de phpMussel, enregistrer le fichier avec un ".bat"
    suffixe quelque part que vous trouverez facile, et double-cliquez sur ce
    fichier pour exécuter phpMussel à l'avenir.

 6) À ce stade, vous avez fini! Mais, vous devriez probablement tester ce
    pour s'assurer qu'il fonctionne correctement. Pour tester phpMussel,
    exécuter phpMussel et essayer d'analyser le "_testfiles" répertoire fourni
    avec le paquet.

                                     ~ ~ ~                                     


 3A. COMMENT UTILISER (POUR WEB SERVEURS)

 phpMussel est prévu à être un script qui fonctionnera correctement dès la
 boîte avec un minimum niveau des exigences de votre part: Une fois qu'il a été
 installé, au fond, il devrait simplement travailler.

 Numérisation de fichiers téléchargé est automatisée et activée par défaut,
 donc rien n'est requise de votre part pour cette particulière fonction.

 Cependant, vous êtes également capable de instruire phpMussel à rechercher des
 fichiers, répertoires ou archives que vous spécifiez implicitement. Pour ce
 faire, d'abord, vous devez assurer que la appropriée configuration est réglée
 dans le phpmussel.ini fichier (cleanup doit être désactivé), et lorsque fini,
 dans un php fichier qui est lié à phpMussel, utiliser la fonction suivante
 dans votre code:

 phpMussel($quoi_a_recherche,$sortie_type,$sortie_platitude);

 Où:
 - $quoi_a_recherche est une string ou un tableau, pointant à un cible fichier,
   un cible répertoire ou un tableau de cibles fichiers et/ou cibles
   répertoires.
 - $sortie_type est un entier, indiquant le format dans lequel les résultats de
   l'analyse doivent être retour. Une valeur de 0 instruit que la fonction
   d'affichage des résultats comme un entier (un retourné résultat de -2
   indique que corrompues données était détecté lors de l'analyse et donc
   l'analyse n'ont pas réussi à compléter, -1 indique que les extensions ou
   addons requis par PHP pour exécuter l'analyse sont manquaient et donc
   l'analyse n'ont pas réussi à compléter, 0 indique qu'il n'existe pas cible à
   analyser et donc il n'y avait rien à analyser, 1 indique que la cible était
   analysé avec succès et aucun problème n'été détectée, et 2 indique que la
   cible était analysé avec succès et problèmes ont été détectés). Une valeur
   de 1 indique à la fonction pour renvoyer les résultats sous forme de texte
   lisible par l'homme. Une valeur de 2 indique à la fonction pour renvoyer les
   résultats sous forme de texte lisible par l'homme et pour exporter les
   résultats à une globale variable. Cette variable est facultative, 0 par
   défaut.
 - $sortie_platitude est un entier, indiquant si les résultats pourront être
   retournés comme un tableau ou pas. Normalement, si la cible de l'analyse
   contenue plusieurs articles (par exemple, si un répertoire ou un tableau)
   les résultats seront retournés dans un tableau (défaut valeur de 0). Une
   valeur de 1 instruit la fonction pour imploser tous tableaux avant l'entrée,
   résultant en une aplatie string contenant les résultats à être retourner.
   Cette variable est facultative, 0 par défaut.

 Exemples:

   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;

   Retours quelque chose comme ça (comme une string):
    Wed, 18 Sep 2013 02:49:46 +0000 Commencé.
    > Vérification '/user_name/public_html/my_file.html':
    -> Pas problème trouvé.
    Wed, 18 Sep 2013 02:49:47 +0000 Terminé.

 Pour un complet itinéraire de signatures que sera utilisé par phpMussel pour
 l'analyse et la façon dont il gère ces signatures, référer à la Signature
 Format section de ce README fichier.

 Si vous rencontrez des faux positifs, si vous rencontrez quelque chose nouveau
 que vous pensez doit être bloqué, ou pour toute autre chose en ce qui concerne
 les signatures, s'il vous plaît, contactez moi à ce sujet afin que je puisse
 effectuer les nécessaires changements, dont, si vous ne contactez moi pas,
 j'ai peut n'être pas conscient.

 Pour désactiver les signatures qui sont incluent avec phpMussel (comme si vous
 rencontrez un faux positif spécifique à vos besoins dont ne devrait
 normalement pas être retiré à partir de rationaliser), référer aux les notes
 de la liste grise dans le Navigateur Commandes section de ce README fichier.

 En plus de la défaut analyse de fichier téléchargement et la facultative
 analyse d'autres fichiers et/ou répertoires spécifiés par la fonction
 ci-dessus, inclus dans phpMussel est une fonction destinée pour l'analyse du
 corps des courriels messages. Cette fonction se comporte comme la standard
 phpMussel() fonction, mais se concentre uniquement sur ??la correspondance
 contre les ClamAV courriels basées signatures. Je n'ai pas attaché ces
 signatures dans la standard phpMussel() fonction, parce que il est hautement
 improbable que vous auriez trouver le corps d'un entrant message dans le
 besoin de l'analyse dans un fichier téléchargement ciblé d'un page où
 phpMussel est accroché, et ainsi, pour lier ces signatures dans la phpMussel()
 fonction serait redondant. Cependant, à ce que ledit, ayant une distincte
 fonction pour correspondre encontre ces signatures pourrait s'avérer
 extrêmement utile pour quelque, surtout pour ceux dont CMS ou système webfront
 est en quelque sorte lié à leur messagerie système et pour ceux dont analyser
 leurs courriels à travers un script php dont ils pourraient s'accrocher dans
 phpMussel. Configuration pour cette fonction, comme tous les autres, est
 contrôlé par le phpmussel.ini fichier. Pour utiliser cette fonction (vous
 aurez besoin de faire votre propre implémentation), dans un php fichier qui
 est accroché à phpMussel, utiliser ce fonction dans votre code:

 phpMussel_mail($corps);

 Où $corps est le corps de le courriel que vous souhaitez d'analyser (plus,
 vous pouvez essayer d'analyser nouveaux forum messages, l'entrants messages de
 votre online contact page ou similaire). Si une erreur s'empêchant la fonction
 d'achever son analyse, une valeur de -1 sera retourné. Si la fonction a
 terminé son analyse et ne correspond pas à rien, une valeur de 0 sera retourné
 (indiquant pas infecté). Si, cependant, la fonction correspond à quelque
 chose, une string sera retournée contenant un message déclarant ce qu'il a
 identifié.

 En plus de ce qui précède, si vous regardez le source code, vous peut
 remarquerez la fonction phpMusselD() et phpMusselR(). Ces fonctions sont
 sous-fonctions de phpMussel(), et ne devrait pas être appelé directement à
 l'extérieur de cette principale fonction (pas en raison d'indésirables
 effets.. Plus-si, simplement parce que ce serait sans utilité, et très
 probablement ne sera pas réellement fonctionner correctement de toute façon).

 Il ya beaucoup autres contrôles et fonctions disponibles dans phpMussel pour
 votre usage, aussi. Pour toutes ces contrôles et fonctions dont, sur la fin de
 cette section de la README, n'ont pas encore été documenté, s'il vous plaît,
 continuer à lire et référer à la Navigateur Commandes section de ce README
 fichier.

                                     ~ ~ ~                                     


 3B. COMMENT UTILISER (POUR CLI)

 S'il vous plaît, référer à la "COMMENT INSTALLER (POUR CLI)" section de ce
 README fichier.

 Soyez conscient que, bien que avenirs versions de phpMussel devraient soutenir
 d'autres systèmes, à ce moment, phpMussel CLI mode support est uniquement
 optimisé pour l'utilisation sur le Windows basée systèmes (vous pouvez, bien
 sûr, essayer sur d'autres systèmes, mais je ne peux pas garantir que ça va
 fonctionner comme prévu).

 Aussi soyez conscient que phpMussel est pas la fonctionnel équivalent d'une
 complet anti-virus suite, et contrairement conventionnelles anti-virus suites,
 ne surveille pas la active mémoire ou détecter les virus sur la volée! Il
 seulement détecte les virus contenus dans les fichiers que vous explicitement
 spécifier pour l'analyse.

                                     ~ ~ ~                                     


 4A. NAVIGATEUR COMMANDES

 Après phpMussel a été installé et est fonctionner correctement sur votre
 système, si vous avez défini les variables script_password et logs_password
 dans votre configuration fichier, vous sera pouvoir d'effectuer un certain
 nombre de administratives fonctions et entrée un nombre de commandes à
 phpMussel par votre navigateur. La raison de ces mots de passe doivent être
 defini afin de permettre à ces navigateur contrôles est pour assurer adéquate
 sécurité, l'adéquate protection de ces navigateur contrôles et faire en sorte
 une méthode existe pour ceux navigateur contrôle à être entièrement désactivé
 si elles ne sont pas souhaitées par vous et/ou autres
 webmasters/administrateurs dont sont l'utiliser phpMussel. Ainsi, en d'autres
 termes, pour activer ces contrôles, définir un mot de passe, et pour
 désactiver ces contrôles, définir aucun mot de passe. Comme alternatif, si
 vous choisir d'activer ces contrôles et puis choisir de désactiver ces
 contrôles à une ultérieure date, il existe une commande à faire ce (tel peut
 être utile si vous effectuer certaines actions vous sentez pourrait
 compromettre les mots de pass que vous avez délégué et besoin de rapidement
 désactiver ces contrôles sans modifier votre configuration fichier).

 Quelques raisons pour lesquelles vous -devriez- permettre à ces contrôles:
 - Fournit une méthode à liste grise les signatures sur la volée dans des cas
   comme lorsque vous découvrez une signature qui produit un faux positif
   tandis le téléchargement de fichiers à votre système et vous n'avez pas le
   temps à manuellement modifier et rétélécharger votre liste grise fichier.
 - Fournit une méthode pour vous à permettre à quelqu'un d'autre que vous pour
   contrôler votre copie de phpMussel sans la implicite nécessité à donner de
   leur accès à FTP.
 - Fournit une méthode à fournir contrôlé accès à vos journaux fichiers.
 - Fournit un facile méthode à réactualiser phpMussel quand une réactualiser
   est disponibles.
 - Fournit une méthode pour vous à surveiller phpMussel quand l'accès de FTP ou
   d'autres conventionnelles points d'accès pour surveillance de phpMussel ne
   sont pas disponibles.

 Quelques raisons pour lesquelles vous -ne devriez pas- permettre à ces
 contrôles:
 - Fournit un potentiel vecteur pour attaquants et indésirables à déterminer si
   vous utilisez phpMussel ou pas (quoique, cela pourrait être positif ou
   négatif, en lieu du point de vue) par le biais d'aveuglément envoyer les
   commandes aux serveurs comme méthode à sonder. D'une part, cela pourrait
   décourager les attaquants de cibler votre système s'ils apprennent que vous
   utilisez phpMussel, en supposant qu'ils sondage parce que leur méthode
   d'attaque est rendu inefficace en raison de l'utilisation de phpMussel.
   Mais, de l'autre part, si certains imprévu et actuellement inconnue exploit
   dans phpMussel uo un avenir version de celui-ci vient à la lumière, et si
   elle pourrait fournir un vecteur d'attaque, un positif résultat d'une telle
   sondage pourrait effectivement encourager les attaquants à cibler votre
   système.
 - Si vos délégués mots de passe ont été compromises, sans être changé,
   pourrait fournir un méthode pour un attaquant à contourner les signatures
   que peuvent être autrement normalement empêchent leurs attaques de réussir,
   ou même potentiellement désactiver phpMussel complètement, ainsi fournissant
   un théorique méthode de rendre l'efficacité de phpMussel avenu.

 De toute façon, indépendamment de que vous choisissez, le choix est finalement
 vôtre. Par défaut, ces contrôles seront désactivés, mais avoir une réflexion à
 ce sujet, et si vous décidez que vous voulez ces, cette section explique
 comment activer et comment utiliser ces.

 Une liste de disponible navigateur commandes:

 scan_log
   Mot de passe requis: logs_password
   Autre exigences: scan_log doit être défini.
   Paramètres requis: (aucun)
   Paramètres optionnels: (aucun)
   Exemple: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Quel est-il: Imprime le contenu de votre scan_log fichier à l'écran.
   ~
 scan_kills
   Mot de passe requis: logs_password
   Autre exigences: scan_kills doit être défini.
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Quel est-il: Imprime le contenu de votre scan_kills fichier à l'écran.
   ~
 controls_lockout
   Mot de passe requis: logs_password OU script_password
   Autre exigences: (aucun)
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Exemple 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Quel est-il: Désactiver/verrouille tous les navigateur contrôles. Cela
                devrait être utilisé si vous pensez que vos mots de passe ont
                été compromis (cela peut arriver si vous utilisez ces commandes
                à partir d'un ordinateur qui n'est pas sécurisé et/ou n'est pas
                digne de confiance). controls_lockout fonctionne par créant un
                fichier, controls.lck, dans votre voûte, dont phpMussel sera
                vérifié avant d'effectuer commandes de toute nature. Après,
                pour réactiver les contrôles, vous devez manuellement supprimer
                le controls.lck fichier par FTP ou similaire.
   ~
 disable
   Mot de passe requis: script_password
   Autre exigences: (aucun)
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple: ?pword=[script_password]&phpmussel=disable
   ~
   Quel est-il: Désactiver phpMussel. Cela devrait être utilisé si vous
                réactualiser ou faire changements à votre système ou si vous
                installez un nouveau logiciel ou modules à votre système dont
                sera ou pourrait potentiellement déclencher faux positifs.
                Aussi, Cela devrait être utilisé si vous rencontrez problèmes
                avec phpMussel mais ne veulent pas à supprimer de votre
                système. Si c'est le cas, pour réactiver phpMussel, utiliser
                "enable".
   ~
 enable
   Mot de passe requis: script_password
   Autre exigences: (aucun)
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple: ?pword=[script_password]&phpmussel=enable
   ~
   Quel est-il: Réactiver phpMussel. Cela devrait être utilisé si vous avez
                précédemment désactivé phpMussel utilisant "disable" et vous
                voulez à réactiver ce.
   ~
 update
   Mot de passe requis: script_password
   Autre exigences: update.dat and update.inc must exist.
   Paramètres requis: (aucun)
   Optional parameters: forcedupdate
   Exemple: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   Quel est-il: Vérifie pour nouvelles versions de phpMussel et ses signatures.
                Si quelque chose est trouvé, il va tenter à télécharger et
                installer les nouveaux fichiers. S'il est vérifié trop vite, il
                sera annulerait. S'il est ne parvient pas à vérifier, il sera
                annulerait. Si l'optionnel paramètre "forcedupdate" est fourni,
                temps de la dernière vérification sera ignorée indépendamment
                de si la vérification est "trop vite", mais il sera annulerait
                s'il est ne parvient pas à vérifier. Les résultats du processus
                sont imprimés à l'écran. Je recommande inclus d'optionnel
                paramètre "forcedupdate" si vous manuellement déclencher cette
                commande, mais ne pas utiliser "forcedupdate" si vous
                automatiser le processus, comme par cron ou similaire. Je
                recommande vérifier au moins une fois par mois afin d'assurer
                que vos signatures et votre copie de phpMussel sont la dernière
                disponible. (sauf, bien sûr, vous télécharger et installer les
                derniers fichiers manuellement, dont, j'aussi recommande
                vérifier au moins une fois par mois). Vérification de plus de
                deux fois par mois est probablement inutile, en tenant compte
                que je (au moment d'écrire ces) travaille sur ce projet par
                moi-même et je suis très peu probable d'être produire nouveaux
                fichiers plus fréquemment que cela (ni je ne particulièrement
                pas vouloir à, pour la plupart).
   ~
 greylist
   Mot de passe requis: script_password
   Autre exigences: (aucun)
   Paramètres requis: [Name of signature to be greylisted]
   Optional parameters: (aucun)
   Exemple: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   Quel est-il: Ajouter une signature à la liste grise.
   ~
 greylist_clear
   Mot de passe requis: script_password
   Autre exigences: (aucun)
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Quel est-il: Efface la totalité de la liste grise.
   ~
 greylist_show
   Mot de passe requis: script_password
   Autre exigences: (aucun)
   Paramètres requis: (aucun)
   Optional parameters: (aucun)
   Exemple: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Quel est-il: Imprime le contenu de la liste grise à l'écran.
   ~

                                     ~ ~ ~                                     


 4B. CLI (COMMANDE LIGNE INTERFACE)

 phpMussel peut être exécuté comme un interactif fichier analyseur en CLI mode
 dans windows. Référer à la "COMMENT INSTALLER (POUR CLI)" section de ce readme
 fichier pour plus détails.

 Pour une liste des disponibles CLI commandes, à l'invite CLI, tapez «c», et
 appuyez sur Entrée.

                                     ~ ~ ~                                     


 5. FICHIERS INCLUS DANS CES EMPAQUETER

 Voici une liste de tous les fichiers inclus dans phpMussel dans son natif
 état, tous les fichiers qui peuvent être potentiellement créées à la suite de
 l'utilisation de ce script, avec une brève description de ce que tous ces
 fichiers sont pour.

 /phpmussel.php (Script, Inclus)
    phpMussel chargement fichier. Charge le principal script et etc. C'est ce
    que vous êtes censé être accrochage dans à (essentiel)!
    ~
 /web.config (Other, Inclus)
    Un ASP.NET configuration fichier (dans ce cas, pour protéger de la "/vault"
    répertoire contre d'être consulté par des non autorisée sources dans le cas
    où le script est installé sur un serveur basé sur les ASP.NET
    technologies).
    ~
 /_docs/ (Directory)
    Documentation répertoire (contient divers fichiers).
    ~
 /_docs/change_log.txt (Documentation, Inclus)
    Un enregistrement des modifications apportées au script entre les
    différentes versions (pas nécessaire pour le bon fonctionnement du script).
    ~
 /_docs/readme.XX.txt (Documentation, Inclus)
    Le README fichiers (par exemple; le fichier vous êtes en cours de lire).
    ~
 /_testfiles/ (Directory)
    Test fichiers répertoire (contient divers fichiers).
    Tous les fichiers contenus sont des fichiers à test si phpMussel a été
    correctement installé sur votre système, et vous n'avez pas besoin de
    télécharger ce répertoire ou l'un de ses fichiers, sauf si faire ces tests.
    ~
 /_testfiles/ascii_standard_testfile.txt (Test fichier, Inclus)
    Test fichier à test phpMussel normalisé ASCII signatures.
    ~
 /_testfiles/exe_standard_testfile.exe (Test fichier, Inclus)
    Test fichier à test phpMussel PE signatures.
    ~
 /_testfiles/general_standard_testfile.txt (Test fichier, Inclus)
    Test fichier à test phpMussel générales signatures.
    ~
 /_testfiles/graphics_standard_testfile.gif (Test fichier, Inclus)
    Test fichier à test phpMussel graphiques signatures.
    ~
 /_testfiles/html_standard_testfile.txt (Test fichier, Inclus)
    Test fichier à test phpMussel normalisé HTML signatures.
    ~
 /_testfiles/md5_testfile.txt (Test fichier, Inclus)
    Test fichier à test phpMussel MD5 signatures.
    ~
 /_testfiles/metadata_testfile.txt.gz (Test fichier, Inclus)
    Test fichier à test phpMussel métadonnées signatures et pour tester GZ
    fichier support sur votre système.
    ~
 /_testfiles/metadata_testfile.txt.zip (Test fichier, Inclus)
    Test fichier à test phpMussel métadonnées signatures et pour tester ZIP
    fichier support sur votre système.
    ~
 /_testfiles/pe_sectional_testfile.exe (Test fichier, Inclus)
    Test fichier à test phpMussel PE Sectional signatures.
    ~
 /vault/ (Répertoire)
    Voûte répertoire (contient divers fichiers).
    ~
 /vault/.htaccess (Autre, Inclus)
    Un hypertexte accès fichier (dans ce cas, pour protéger les sensibles
    fichiers appartenant au script contre être consulté par non autorisées
    sources).
    ~
 /vault/ascii_clamav_regex.cvd (Signatures, Inclus)
 /vault/ascii_clamav_regex.map (Signatures, Inclus)
 /vault/ascii_clamav_standard.cvd (Signatures, Inclus)
 /vault/ascii_clamav_standard.map (Signatures, Inclus)
 /vault/ascii_custom_regex.cvd (Signatures, Inclus)
 /vault/ascii_custom_standard.cvd (Signatures, Inclus)
 /vault/ascii_mussel_regex.cvd (Signatures, Inclus)
 /vault/ascii_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour normalisé ASCII signatures.
    Nécessaire si la normalisé ASCII option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/elf_clamav_regex.cvd (Signatures, Inclus)
 /vault/elf_clamav_regex.map (Signatures, Inclus)
 /vault/elf_clamav_standard.cvd (Signatures, Inclus)
 /vault/elf_clamav_standard.map (Signatures, Inclus)
 /vault/elf_custom_regex.cvd (Signatures, Inclus)
 /vault/elf_custom_standard.cvd (Signatures, Inclus)
 /vault/elf_mussel_regex.cvd (Signatures, Inclus)
 /vault/elf_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour ELF signatures.
    Nécessaire si l'ELF signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/exe_clamav_regex.cvd (Signatures, Inclus)
 /vault/exe_clamav_regex.map (Signatures, Inclus)
 /vault/exe_clamav_standard.cvd (Signatures, Inclus)
 /vault/exe_clamav_standard.map (Signatures, Inclus)
 /vault/exe_custom_regex.cvd (Signatures, Inclus)
 /vault/exe_custom_standard.cvd (Signatures, Inclus)
 /vault/exe_mussel_regex.cvd (Signatures, Inclus)
 /vault/exe_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour Portable Executable fichier (EXE) signatures.
    Nécessaire si l'EXE signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/filenames_clamav.cvd (Signatures, Inclus)
 /vault/filenames_custom.cvd (Signatures, Inclus)
 /vault/filenames_mussel.cvd (Signatures, Inclus)
    Fichiers pour filename signatures.
    Nécessaire si le filename signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/general_clamav_regex.cvd (Signatures, Inclus)
 /vault/general_clamav_regex.map (Signatures, Inclus)
 /vault/general_clamav_standard.cvd (Signatures, Inclus)
 /vault/general_clamav_standard.map (Signatures, Inclus)
 /vault/general_custom_regex.cvd (Signatures, Inclus)
 /vault/general_custom_standard.cvd (Signatures, Inclus)
 /vault/general_mussel_regex.cvd (Signatures, Inclus)
 /vault/general_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour général signatures.
    Nécessaire si le général signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/graphics_clamav_regex.cvd (Signatures, Inclus)
 /vault/graphics_clamav_regex.map (Signatures, Inclus)
 /vault/graphics_clamav_standard.cvd (Signatures, Inclus)
 /vault/graphics_clamav_standard.map (Signatures, Inclus)
 /vault/graphics_custom_regex.cvd (Signatures, Inclus)
 /vault/graphics_custom_standard.cvd (Signatures, Inclus)
 /vault/graphics_mussel_regex.cvd (Signatures, Inclus)
 /vault/graphics_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour graphiques signatures.
    Nécessaire si le graphiques signatures option dans phpmussel.ini est
    activée. Peut enlever si l'option est désactivée (mais les fichiers seront
    recréés sur réactualiser).
    ~
 /vault/greylist.csv (Signatures, Included/Created)
    CSV de grise listé signatures indiquant pour phpMussel qui signatures il
    faut ignorer (fichier recréé automatiquement si supprimé).
    ~
 /vault/hex_general_commands.csv (Signatures, Inclus)
    Hex-codé CSV de généraux commande détections optionnellement utilisés par
    phpMussel. Nécessaire si l'option de général commande détection dans
    phpmussel.ini est activée. Peut enlever si l'option est désactivée (mais
    les fichiers seront recréés sur réactualiser).
    ~
 /vault/html_clamav_regex.cvd (Signatures, Inclus)
 /vault/html_clamav_regex.map (Signatures, Inclus)
 /vault/html_clamav_standard.cvd (Signatures, Inclus)
 /vault/html_clamav_standard.map (Signatures, Inclus)
 /vault/html_custom_regex.cvd (Signatures, Inclus)
 /vault/html_custom_standard.cvd (Signatures, Inclus)
 /vault/html_mussel_regex.cvd (Signatures, Inclus)
 /vault/html_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour normalisé HTML signatures.
    Nécessaire si la normalisé HTML option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/lang.inc (Script, Included)
    phpMussel Langue Données; Obligatoire pour les capacités multilingues.
    ~
 /vault/macho_clamav_regex.cvd (Signatures, Inclus)
 /vault/macho_clamav_regex.map (Signatures, Inclus)
 /vault/macho_clamav_standard.cvd (Signatures, Inclus)
 /vault/macho_clamav_standard.map (Signatures, Inclus)
 /vault/macho_custom_regex.cvd (Signatures, Inclus)
 /vault/macho_custom_standard.cvd (Signatures, Inclus)
 /vault/macho_mussel_regex.cvd (Signatures, Inclus)
 /vault/macho_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour Mach-O signatures.
    Nécessaire si le Mach-O signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/mail_clamav_regex.cvd (Signatures, Inclus)
 /vault/mail_clamav_regex.map (Signatures, Inclus)
 /vault/mail_clamav_standard.cvd (Signatures, Inclus)
 /vault/mail_clamav_standard.map (Signatures, Inclus)
 /vault/mail_custom_regex.cvd (Signatures, Inclus)
 /vault/mail_custom_standard.cvd (Signatures, Inclus)
 /vault/mail_mussel_regex.cvd (Signatures, Inclus)
 /vault/mail_mussel_standard.cvd (Signatures, Inclus)
    Fichiers pour signatures utilisées par la phpMussel_mail() fonction.
    Nécessaire si la phpMussel_mail() fonction est utilisé en aucune façon.
    Peut enlever si elle n'est pas utilisée (mais les fichiers seront recréés
    quand réactualisé).
    ~
 /vault/md5_clamav.cvd (Signatures, Inclus)
 /vault/md5_custom.cvd (Signatures, Inclus)
 /vault/md5_mussel.cvd (Signatures, Inclus)
    Fichiers pour MD5 basé signatures.
    Nécessaire si le MD5 signatures option dans phpmussel.ini est activée.
    Peut enlever si l'option est désactivée (mais les fichiers seront recréés
    sur réactualiser).
    ~
 /vault/metadata_clamav.cvd (Signatures, Inclus)
 /vault/metadata_custom.cvd (Signatures, Inclus)
 /vault/metadata_mussel.cvd (Signatures, Inclus)
    Fichiers pour métadonnées d'archives signatures.
    Nécessaire si le métadonnées d'archives option dans phpmussel.ini est
    activée. Peut enlever si l'option est désactivée (mais les fichiers seront
    recréés sur réactualiser).
    ~
 /vault/pe_clamav.cvd (Signatures, Inclus)
 /vault/pe_custom.cvd (Signatures, Inclus)
 /vault/pe_mussel.cvd (Signatures, Inclus)
    Fichiers pour PE Sectional signatures.
    Nécessaire si le PE Sectional signatures option dans phpmussel.ini est
    activée. Peut enlever si l'option est désactivée (mais les fichiers seront
    recréés sur réactualiser).
    ~
 /vault/phpmussel.inc (Script, Inclus)
    phpMussel Principal Script; Le principal corps de phpMussel (essentiel)!
    ~
 /vault/phpmussel.ini (Other, Inclus)
    phpMussel Configuration fichier; Contient toutes les configuration options
    de phpMussel, diriger comment faire fonctionner correctement (essentiel)!
    ~
 /vault/scan_log.txt *(Logfile, Created)
    Un enregistrement de tout analysé par phpMussel.
    ~
 /vault/scan_kills.txt *(Logfile, Created)
    Les résultats de chaque fichier téléchargement bloqué/tués par phpMussel.
    ~
 /vault/template.html (Other, Inclus)
    phpMussel modèle fichier; Modèle pour l'HTML sortie produit par phpMussel
    pour son bloqués fichiers téléchargement message (le message vu par
    l'envoyeur).
    ~
 /vault/update.dat (Other, Inclus)
    Fichier contenant les version informations pour le script et les signatures
    de phpMussel. Si jamais vous voulez à réactualiser automatiquement
    phpMussel ou réactualiser phpMusel par votre navigateur, ce fichier est
    indispensable.
    ~
 /vault/update.inc (Script, Inclus)
    phpMussel Réactualiser Script; Requis pour automatique réactualisation et
    pour réactualisation phpMussel par votre navigateur, mais n'est pas
    autrement requise.
    ~

 * Noms du fichiers peut varier basé sur configuration stipulations (dans
   phpmussel.ini).

 = REGARDING SIGNATURE FILES =
    CVD est un acronyme pour "ClamAV Virus Definitions", en référence à la
    façon ClamAV réfère à ses signatures et à l'utilisation de ces signatures
    en phpMussel; Les fichiers terminant par "CVD" contiennent signatures.
    ~
    Les fichiers terminant par "MAP" tracer qui signatures phpMussel devrait et
    ne devrait pas être utilisé pour individuelle analyse; Pas toutes les
    signatures sont nécessairement requises pour chaque unique analyse, ainsi,
    phpMussel utilise cartes fichiers des signatures afin d'accélérer le
    processus d'analyse (un processus qui, autrement, serait extrêmement lent
    et fastidieux).
    ~
    Signature fichiers marqué avec "_regex" contenir signatures qui
    utilisent regular expression modèle vérification (regex).
    ~
    Signature fichiers marqué avec "_standard" contenir signatures qui
    n'utilisent toute spécifique forme de modèle vérification.
    ~
    Signature fichiers non marqués avec "_regex" ou "_standard" seront aussi
    l'un ou l'autre (mais pas deux); Référer à la Signature Format section de
    ce README fichier pour la documentation et les spécifiques détails.
    ~
    Signature fichiers marqué avec "_clamav" contient signatures entièrement
    basée du ClamAV base de données (GNU/GPL).
    ~
    Signature fichiers marqué avec "_custom", par défaut, ne contiennent pas
    de signatures; Ces fichiers existent à donner vous un place pour placer
    vos propres personnalisées signatures, si vous créez une partie de votre
    propre.
    ~
    Signature fichiers marqué avec "_mussel" contenir signatures qui ne sont
    pas spécifiquement provenant par ClamAV, signatures qui, en général, je
    développé par moi-même et/ou basé sur informations recueillies de diverses
    sources.
    ~

                                     ~ ~ ~                                     


 6. CONFIGURATION OPTIONS

 Ce qui suit est une liste de variables trouvé dans le "phpmussel.ini"
 configuration fichier de phpMussel, avec une description de leur objet et leur
 fonction.

 "general" (Catégorie)
 - Configuration générale pour phpMussel.
    "script_password"
    - Par commodité, phpMussel permettra certaines fonctions (inclus la
      capacité de réactualiser phpMussel sur la volée) pour être déclenché
      manuellement via POST, GET et QUERY. Toutefois, par mesure de sécurité,
      pour ce faire, phpMussel s'attend à un mot de passe pour être inclus
      dans la commande, à assurer que c'est vous, et pas quelqu'un d'autre,
      attenter de déclencher manuellement ces fonctions. Fixer script_password
      à le mot de passe que vous souhaitez d'utiliser. Si aucun mot de passe
      est fixé, déclenchement manuel sera désactivé par défaut. Utiliser
      quelque chose que vous souvenez, mais qui est difficile à deviner.
      * N'a pas d'influence en mode CLI.
    "logs_password"
    - La même comme script_password, mais par l'affichage du contenu de
      scan_log et scan_kills. Pour avoir distincts mots de passe peut être
      utile si vous voulez donner à quelqu'un autre accès à un ensemble de
      fonctions mais pas l'autre.
      * N'a pas d'influence en CLI mode.
    "cleanup"
    - Déensemble variables du script et cache après l'exécution. Si vous
      n'utilisez pas le script au-delà l'initiale analyse du téléchargements,
      devrait ensemble à oui à minimiser l'utilisation de la mémoire. Si vous
      utilisez le script à des fins au-delà l'initiale analyse du
      téléchargements, devrait ensemble à non, pour éviter recharger
      inutilement dupliqué données dans la mémoire. Dans la générale pratique,
      il devrait probablement être ensemblé sur oui, mais, si vous faites cela,
      vous ne serez pas être capable d'utiliser le script pour tout chose autre
      que la analyse de fichiers téléchargements.
      * N'a pas d'influence en CLI mode.
    "scan_log"
    - Nom du fichier à enregistrer tous les résultats d'analyse à. Spécifiez
      un nom de fichier, ou laisser vide à désactiver.
    "scan_kills"
    - Nom du fichier à enregistrer tous les résultats de bloqué ou tué
      téléchargements à. Spécifiez un nom de fichier, ou laisser vide à
      désactiver.
    "ipaddr"
    - Où trouver l'IP adresse du connexion demande? (Utile pour services tels
      que Cloudflare et les goûts) Par Défaut = REMOTE_ADDR
      AVERTISSEMENT: Ne pas changer si vous ne sais pas ce que vous faites!
    "forbid_on_block"
    - Devrait phpMussel envoyer 403 têtes avec le fichier téléchargement bloqué
      message, ou rester avec l'habitude 200 bien (200 OK)?
      0 = Non (200) [Défaut], 1 = Oui (403).
    "delete_on_sight"
    - Mise en cette option sera instruire le script à tenter immédiatement
      supprimer tout fichiers elle constate au cours de son analyse
      correspondant à des critères de détection, que ce soit via des signatures
      ou autrement. Fichiers jugées "propre" ne seront pas touchés. Dans le cas
      des archives, l'ensemble d'archive sera supprimé (indépendamment de si le
      incriminé fichier est que l'un de plusieurs fichiers contenus dans
      l'archive). Pour le cas d'analyse de fichiers téléchargement,
      généralement, il n'est pas nécessaire d'activer cette option sur, parce
      généralement, php faire purger automatiquement les contenus de son cache
      lorsque l'exécution est terminée, ce qui signifie que il va généralement
      supprimer tous les fichiers téléchargés à travers elle au serveur sauf
      qu'ils ont déménagé, copié ou supprimé déjà. L'option est ajoutée ici
      comme une supplémentaire mesure de sécurité pour le supplémentaire
      paranoïaque et pour ceux dont copies de php peut pas toujours se
      comporter de la manière attendu.
      0 - Après l'analyse, laissez le fichier tel quel [Défaut],
      1 - Après l'analyse, si pas propre, supprimer immédiatement.
    "lang"
    - Spécifier la défaut langue pour phpMussel.
 "signatures" (Catégorie)
 - Configuration pour les signatures.
   %%%_clamav = ClamAV signatures (mains et daily).
   %%%_custom = Vos personnalisés signatures (si vous avez écrit tout).
   %%%_mussel = phpMussel signatures incluses dans votre courant ensemble des
                signatures qui ne sont pas de ClamAV.
   - Vérifier contre MD5 signatures au cours de analyse?
     0 = Non, 1 = Oui [Défaut].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Vérifier contre général signatures au cours de analyse?
     0 = Non, 1 = Oui [Défaut].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Vérifier contre normalisé ASCII signatures au cours de analyse?
     0 = Non, 1 = Oui [Défaut].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Vérifier contre normalisé HTML signatures au cours de analyse?
     0 = Non, 1 = Oui [Défaut].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Vérifier PE (portable exécutable) fichiers (EXE, DLL, etc) contre PE
     Sectional signatures au cours de analyse? 0 = Non, 1 = Oui [Défaut].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Vérifier PE (portable exécutable) fichiers (EXE, DLL, etc) contre PE
     signatures au cours de analyse? 0 = Non, 1 = Oui [Défaut].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Vérifier ELF fichiers contre ELF signatures au cours de analyse?
     0 = Non, 1 = Oui [Défaut].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Vérifier Mach-O fichiers (OSX, etc) contre Mach-O signatures au cours de
     analyse? 0 = Non, 1 = Oui [Défaut].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Vérifier graphiques fichiers contre graphiques basé signatures au cours de
     analyse? 0 = Non, 1 = Oui [Défaut].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Vérifier archives contenu contre archive métadonnées signatures au cours
     de analyse? 0 = Non, 1 = Oui [Défaut].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Vérifier les noms de fichiers contre signatures basé sur les noms de
     fichiers au cours de analyse? 0 = Non, 1 = Oui [Défaut].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Autoriser analyse avec phpMussel_mail()? 0 = Non, 1 = Oui [Défaut].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Signature correspondance longueur limiter options. Seulement modifier si
     vous savez ce que vous faites. SD = Standard signatures. RX = PCRE (Perl
     Compatibles Régulières Expressions, ou "Regex") signatures. FN = Nom de
     fichier signatures. Si vous remarquez php s'écraser quand phpMussel
     tentatives d'analyse, tenter à réduire les valeurs "max" ci-dessous. Si
     possible et pratique, laissez-moi savoir quand cela se produit et les
     résultats de ce que vous essayez.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   - Devrait phpMussel signaler lorsque les signatures fichiers sont manquants
     ou endommagés? Si fail_silently est désactivé, manquants et corrompus
     fichiers seront signalé sur analyse, et if fail_silently est activé,
     manquants et corrompus fichiers seront ignorés, avec l'analyse signalés
     pour ceux fichiers qu'il n'y a pas de problèmes. Cela devrait généralement
     être laissé seul sauf si vous rencontrez accidents ou similaires
     problèmes. 0 = Désactivé. [Défaut], 1 = Activé.
     "fail_silently"
 "files" (Catégorie)
 - Générale configuration pour gestion des fichiers.
   "max_uploads"
   - Maximum admissible nombre de fichiers pour analyse lorsque l'analyse de
     fichier téléchargements avant d'abandonner l'analyse et informer
     l'utilisateur qu'ils sont téléchargement trop à la fois! Fournit
     protection contre une théorique attaque par lequel un attaquant tente à
     DDoS votre système ou CMS par surchargeant phpMussel à ralentir le
     processus de php à une halte. Recommandé: 10. Vous pouvez désirer
     d'augmenter ou diminuer ce nombre dépendamment de la vitesse de votre
     hardware. Notez que ce nombre ne tient pas compte pour ou inclure le
     contenus des archives.
   "filesize_limit"
   - Limite de taille de fichier en Ko. 65536 = 64Mo [Défaut], 0 = Pas limite
     (toujours en liste grise), tout (positif) valeur numérique acceptée. Cela
     peut être utile lorsque votre configuration de PHP limite la quantité de
     mémoire qu'un processus peut contenir ou si votre configuration de PHP
     limite la taille du fichier téléchargements.
   "filesize_response"
   - Que faire avec des fichiers qui dépassent la taille de fichier limite (si
     existant). 0 - Énumérer Blanche, 1 - Énumérer Noire [Défaut].
   "filetype_whitelist" et "filetype_blacklist"
   - Si votre système seulement permettre particuliers types de fichiers à
     téléchargé, ou si votre système nie explicitement particuliers types de
     fichiers, spécifiant les types de fichiers dans listes blanches et listes
     noires peut augmenter la vitesse à laquelle l'analyse est effectuée en
     permettant le script à sauter particuliers types de fichiers. Format est
     CSV (virgule séparées valeurs). Si vous souhaitez analyse tout, plutôt que
     de liste blanche ou liste noire, laisser les variable(/s) blanc (il va
     désactiver liste blanche/noire).
   "check_archives"
   - Essayez vérifier le contenu des archives?
     0 - Non (ne pas vérifier), 1 - Oui (vérifier) [Défaut].
     * Actuellement, seulement l'examen de BZ, GZ, LZF et ZIP fichiers est
       supporté (l'examen RAR, CAB, 7z etc actuellement pas supporté).
     * Ce n'est pas à toute épreuve! Bien que je recommande fortement d'avoir
       ce reste activée, je ne peux pas garantir il va toujours trouver tout.
     * Aussi être conscient que l'examen d'archives actuellement n'est pas
       récursif pour ZIPs.
   "filesize_archives"
   - Étendre taille du fichier liste noire/blanche paramètres à le contenu des
     archives? 0 - Non (énumérer grise tout), 1 - Oui [Défaut].
   "filetype_archives"
   - Étendre type de fichier liste noire/blanche paramètres à le contenu des
     archives? 0 - Non (énumérer grise tout), 1 - Oui [Défaut].
   "max_recursion"
   - Maximum récursivité profondeur limite pour archives. Défaut = 10.
 "attack_specific" (Catégorie)
 - Configuration pour les spécifique attaque détections (pas basé sur CVDs).
   * Caméléon Attaque Détection: 0 = Désactivé, 1 = Activé.
   "chameleon_from_php"
   - Vérifier pour php tête dans les fichiers qui sont ni php fichiers ni
     reconnue comme archives.
   "chameleon_from_exe"
   - Vérifier pour exécutable têtes dans les fichiers qui sont ni exécutable
     fichiers ni reconnue comme archives et pour exécutables dont têtes sont
     incorrects.
   "chameleon_to_archive"
   - Vérifier pour archives dont têtes sont incorrects (Supporté: BZ, GZ, RAR,
     ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Vérifier pour office documents dont têtes sont incorrects (Supporté: DOC,
     DOT, PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Vérifier pour images dont têtes sont incorrects (Supporté: BMP, DIB, PNG,
     GIF, JPEG, JPG, XCF, PSD, PDD).
   "chameleon_to_pdf"
   - Vérifier pour PDF fichiers dont têtes sont incorrects.
   "archive_file_extensions" et "archive_file_extensions_wc"
   - Les extensions de reconnus archive fichiers (format est CSV; devraient
     ajouter ou supprimer seulement quand problèmes surviennent; supprimer
     inutilement peut entraîner des faux positifs à paraître pour archive
     fichiers, tandis que ajoutant inutilement sera essentiellement liste
     blanche ce que vous ajoutez à partir de l'attaque spécifique détection;
     modifier avec prudence; aussi noter que cela n'a aucun effet sur ce
     archives peut et ne peut pas être analysé au niveau du contenu). La liste,
     comme en cas de défaut, énumère les formats plus couramment utilisé dans
     la majorité des systèmes et CMS, mais volontairement pas nécessairement
     complète.
   "general_commands"
   - Vérifier de fichiers pour générales commandes comme eval(), exec() et
     include()? 0 - Non (pas vérifier) [Défaut], 1 - Oui (vérifier).
     Définir comme 0 (Non) si vous avez l'intention à télécharger de la suivant
     à votre système ou CMS via votre navigateur: php, JavaScript, HTML,
     python, perl fichiers etc. Définir comme 1 (Oui) si vous n'avez pas de
     supplémentaire protections sur votre système et n'ont pas l'intention de
     télécharger ces fichiers. Si vous utilisez une supplémentaire sécurité en
     conjonction avec phpMussel comme ZB Block, il n'est pas nécessaire
     d'activer cette option, parce la plupart de que phpMussel va chercher pour
     (dans le contexte de cette option) sont des duplications de protections
     qui sont déjà fournis.
   "block_control_characters"
   - Bloquer tous les fichiers contenant des contrôle caractères (autre que les
     sauts de ligne)? ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) Si vous êtes
     -seulement- télécharger de brut texte fichiers, puis vous pouvez activer
     cette option à fournir une supplémentaire protection à votre système.
     Mais, si vous télécharger quelque chose plus que brut texte, l'activation
     de cette peut créer faux positifs.
     0 - Ne pas bloquer [Défaut], 1 - Bloquer.
   "corrupted_exe"
   - Corrompus fichiers et des erreurs d'analyse.
     0 = Ignorer, 1 = Bloquer [Défaut]. Détecter et bloquer les potentiellement
     corrompus PE (Portable Executable) fichiers? Souvent (mais pas toujours),
     lorsque certains aspects d'un PE fichier sont corrompus ou ne peut pas
     être analysée correctement, il peut être le signe d'une virale infection.
     Les processus utilisés par la plupart des anti-virus programmes pour
     détecter les virus dans PE fichiers requérir l'analyse de ces fichiers par
     certaines méthodes, de ce que, si le programmeur d'un virus est conscient
     de, seront spécifiquement tenter d'empêcher, en vue de permettre leur
     virus n'être pas détectée.
 "compatibility" (Catégorie)
 - Compatibilité directives pour phpMussel.
    "ignore_upload_errors"
    - Cette directive doit généralement être DÉSACTIVÉ sauf si cela est
      nécessaire pour la correcte fonctionnalité de phpMussel sur votre
      spécifique système. Normalement, lorsque DÉSACTIVÉ, lorsque phpMussel
      détecte la présence d'éléments dans le $_FILES() tableau, il va tenter
      de lancer une analyse du fichiers que ces éléments représentent, et, si
      ces éléments sont vide, phpMussel retourne un message d'erreur. Ce
      comportement est normal pour phpMussel. Mais, pour certains CMS, vides
      éléments dans $_FILES peuvent survenir à la suite du naturel comportement
      de ces CMS, ou erreurs peuvent être signalés quand il ne sont pas tout,
      dans ce cas, le normal comportement pour phpMussel seront interférer avec
      le normal comportement de ces CMS. Si telle une situation se produit pour
      vous, ACTIVATION de cette option sera instruire phpMussel ne pas à tenter
      de lancer d'analyses pour ces vides éléments, ignorer quand il est
      reconnu et ne pas à retourner tout de connexes messages d'erreur,
      permettant ainsi la continuation de la page demande.
      0 - DÉSACTIVÉ, 1 - SACTIVÉ.


                                     ~ ~ ~                                     


 7. SIGNATURE FORMAT

 = MD5 SIGNATURES =
   Toutes les MD5 signatures suivez le format:
    HASH:FILESIZE:NAME
   Où HASH est le MD5 hash d'un ensemble du fichier, FILESIZE est la totale
   taille du fichier et NAME est le nom à citer pour la signature.

 = NOM DE FICHIER SIGNATURES =
   Toutes les nom de fichier signatures suivez le format:
    NAME:FNRX
   Où NAME est le nom à citer pour la signature et FNRX est l'expression
   rationnelle pour faire correspondre les (non codé) noms de fichiers.

 = ARCHIVE MÉTADONNÉES SIGNATURES =
   Toutes les archive métadonnées signatures suivez le format:
    NAME:FILESIZE:CRC32
   Où NAME est le nom à citer pour la signature, FILESIZE est la totale
   taille (non compressé) d'un fichier contenues dans l'archive et CRC32 est
   la CRC32 contrôle somme of de ce fichier contenu.

 = TOUT LE RESTE =
   Toutes les autre signatures suivez le format:
    NAME:HEX:FROM:TO
   Où NAME est le nom à citer pour la signature et HEX est un hexadécimal codé
   segment du fichier destiné à être identifié par la signature donnée. FROM et
   TO sont optionnel paramètres, indication de laquelle et à laquelle les
   positions dans les source données pour vérifier contre (non supporté par la
   mail fonction).

 = REGEX =
   Toute forme de regex comprise et préparé correctement par php devrait aussi
   être correctement compris et préparé par phpMussel et ses signatures.
   Mais, je vous suggère de prendre une extrême prudence lors de l'écriture de
   nouvelles regex basé signatures, parce, si vous n'êtes pas entièrement sûr
   de ce que vous faites, il peut y avoir très irréguliers et/ou inattendus
   résultats. Jetez un oeil à la phpMussel source code si vous n'êtes pas
   entièrement sûr sur le contexte dans lequel regex déclarations sont
   analysés. Aussi, rappeler toutes les déclarations (à l'exception de nom de
   fichier, archive métadonnées et MD5 déclarations) doit être de codé de
   hexadécimale (à l'exception de déclaration syntaxe, bien sûr)!

 = OÙ METTRE DES PERSONNALISÉES SIGNATURES? =
   Seulement mettre des personnalisées signatures dans les fichiers prévu pour
   personnalisées signatures. Ces fichiers devrait contenir "_custom" dans leur
   noms. Vous devrait aussi éviter modifier les défaut signature fichiers, sauf
   si vous savez exactement ce que vous faites, parce, en plus d'être une bonne
   pratique en général et aidant vous à distinguer entre vos signatures
   et le défaut signatures inclus avec phpMussel, il est bon de tenir à
   l'édition seuls les fichiers destinés à l'édition, parce que l'altération du
   défaut signature fichiers peut cessé leur fonctionner correctement, en
   raison des "maps" fichiers: Les maps fichiers racontent phpMussel où dans le
   signature fichiers à chercher pour requis signatures par phpMussel selon
   lorsque requis, et ces maps peut devenir désynchronisée avec leur associé
   signature fichiers si le signature fichiers sont altéré. Vous pouvez mettre
   à peu près ce que vous voulez dans vos personnalisée signatures, aussi
   longtemps que vous suivez la correcte syntaxe. Mais, être prudent à tester
   nouvelles signatures pour faux positifs avant si vous avez l'intention à
   partager ou utiliser dans un réel environnement.

 = SIGNATURE DÉTAIL =
   Ce qui suit est un détail des types de signatures utilisées par phpMussel:
   - "MD5 Signatures" (md5_*). Vérifié contre le MD5 hash des contenus et la
      taille du fichier de chaque fichier non listé blanche ciblée pour
      l'analyse.
   - "Générales Signatures" (general_*). Vérifié contre les contenus de chaque
      fichier non listé blanche ciblée pour l'analyse.
   - "Normalisé ASCII Signatures" (ascii_*). Vérifié contre les contenus de
      chaque fichier non listé blanche ciblée pour l'analyse.
   - "Normalisé HTML Signatures" (html_*). Vérifié contre les contenus de
      chaque fichier de HTML non listé blanche ciblée pour l'analyse.
   - "Générales Commandes" (hex_general_commands.csv). Vérifié contre les
      contenus de chaque fichier non listé blanche ciblée pour l'analyse.
   - "Portable Executable Sectional Signatures" (pe_*). Vérifié contre les
      contenus de chaque fichier non listé blanche ciblée pour l'analyse et
      identifié au PE format.
   - "Portable Executable Signatures" (exe_*). Vérifié contre les contenus de
      chaque fichier non listé blanche ciblée pour l'analyse et identifié au PE
      format.
   - "ELF Signatures" (elf_*). Vérifié contre les contenus de chaque fichier
      non listé blanche ciblée pour l'analyse et identifié au ELF format.
   - "Graphics Signatures" (graphics_*). Vérifié contre les contenus de chaque
      fichier non listé blanche ciblée pour l'analyse et identifié à un connu
      graphique fichier format.
   - "Mach-O Signatures" (macho_*). Vérifié contre les contenus de chaque
      fichier non listé blanche ciblée pour l'analyse et identifié au Mach-O
      format.
   - "ZIP Métadonnées Signatures" (metadata_*). Vérifié contre le CRC32 hash et
      taille du fichier de l'initial fichier contenu à l'intérieur de toute
      archive non listé blanche ciblée pour l'analyse.
   - "Email Signatures" (mail_*). Vérifié contre le $corps variable analysée à
      la phpMussel_mail() fonction, qui est destiné à être le corps des e-mails
      ou similaire entités (potentiellement messages du forum et etc).
   (Noter que ces signatures peut être facilement désactivé via phpmussel.ini).


                                     ~ ~ ~                                     


 8. CONNUS PROBLÈMES DE COMPATIBILITÉ

 PHP et PCRE
 - phpMussel requérir PHP et PCRE à signer et à fonctionner correctement. Sans
   php, ou sans le PCRE extension de PHP, phpMussel n'exécutera pas ou
   fonctionnent correctement. Devrait s'assurer que votre système avoir PHP et
   PCRE installé et disponible avant de votre téléchargement et installation de
   phpMussel.

 ANTI-VIRUS LOGICIELS COMPATIBILITÉ

 Pour la plupart, phpMussel devrait être assez compatible avec plupart du virus
 détection logiciels. Cependant, conflictualités ont été signalés par un nombre
 d'utilisateurs dans le passé. Cette information ci-dessous est VirusTotal.com,
 et il décrit un certain nombre de faux positifs signalé par divers anti-virus
 programmes contre phpMussel. Bien que cette information ne constitue pas une
 absolue garantie de si oui ou non vous rencontrerez des problèmes de
 compatibilité entre phpMussel et votre anti-virus logiciel, si votre logiciel
 anti-virus est noté comme signalant contre phpMussel, vous devriez envisager
 désactivation avant à travailler avec phpMussel ou devrait envisager d'autres
 options soit votre logiciel anti-virus ou phpMussel.

 Cette information a été réactualisé le 28 Août 2014 et est courant pour TOUTES
 les versions de phpMussel, partir de l'initiale version v0.1 travers à le
 dernière version v0.4c au moment de la rédaction cette.

 Ad-Aware                Pas problèmes connus
 Agnitum                 Pas problèmes connus
 AhnLab-V3               Pas problèmes connus
 AntiVir                 Pas problèmes connus
 Antiy-AVL               Pas problèmes connus
 Avast                !  Rapports "JS:ScriptSH-inf [Trj]"
                         - Tous sauf v0.3d
 AVG                     Pas problèmes connus
 Baidu-International     Pas problèmes connus
 BitDefender             Pas problèmes connus
 Bkav                 !  Rapports "VEX408f.Webshell"
                         - v0.3 à v0.3c
 ByteHero                Pas problèmes connus
 CAT-QuickHeal           Pas problèmes connus
 ClamAV                  Pas problèmes connus
 CMC                     Pas problèmes connus
 Commtouch            !  Rapports "W32/GenBl.857A3D28!Olympus"
                         - v0.3e seule
 Comodo                  Pas problèmes connus
 DrWeb                   Pas problèmes connus
 Emsisoft                Pas problèmes connus
 ESET-NOD32              Pas problèmes connus
 F-Prot                  Pas problèmes connus
 F-Secure                Pas problèmes connus
 Fortinet                Pas problèmes connus
 GData                !  Rapports "Archive.Trojan.Agent.E7C7J7"
                         - v0.3e seule
 Ikarus               !  Rapports "Trojan.JS.Agent"
                         - v0.3g à v0.4c
 Jiangmin                Pas problèmes connus
 K7AntiVirus             Pas problèmes connus
 K7GW                    Pas problèmes connus
 Kaspersky               Pas problèmes connus
 Kingsoft                Pas problèmes connus
 Malwarebytes            Pas problèmes connus
 McAfee                  Pas problèmes connus
 McAfee-GW-Edition       Pas problèmes connus
 Microsoft               Pas problèmes connus
 MicroWorld-eScan        Pas problèmes connus
 NANO-Antivirus          Pas problèmes connus
 Norman               !  Rapports "Kryptik.BQS"
                         - Tous sauf v0.3d et v0.3e
 nProtect                Pas problèmes connus
 Panda                   Pas problèmes connus
 Qihoo-360               Pas problèmes connus
 Rising                  Pas problèmes connus
 Sophos                  Pas problèmes connus
 SUPERAntiSpyware        Pas problèmes connus
 Symantec             !  Rapports "WS.Reputation.1"
                         - v0.3e à v0.4c
 TheHacker               Pas problèmes connus
 TotalDefense            Pas problèmes connus
 TrendMicro              Pas problèmes connus
 TrendMicro-HouseCall !  Rapports "Suspici.450F5936"
                         - v0.3d à v0.4c
 VBA32                   Pas problèmes connus
 VIPRE                   Pas problèmes connus
 ViRobot                 Pas problèmes connus


                                     ~ ~ ~                                     


Dernière Réactualisé: 28 Août 2014 (2014.08.28).
EOF