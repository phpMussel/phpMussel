## Documentatie voor phpMussel (Nederlandse).

### Inhoud
- 1. [PREAMBULE](#SECTION1)
- 2A. [HOE TE INSTALLEREN (VOOR WEBSERVERS)](#SECTION2A)
- 2B. [HOE TE INSTALLEREN (VOOR CLI)](#SECTION2B)
- 3A. [HOE TE GEBRUIKEN (VOOR WEBSERVERS)](#SECTION3A)
- 3B. [HOE TE GEBRUIKEN (VOOR CLI)](#SECTION3B)
- 4A. [BROWSER RICHTLIJNEN](#SECTION4A)
- 4B. [CLI (COMMANDLIJN INTERFACE)](#SECTION4B)
- 5. [BESTANDEN IN DIT PAKKET](#SECTION5)
- 6. [CONFIGURATIEOPTIES](#SECTION6)
- 7. [HANDTEKENINGFORMAAT](#SECTION7)
- 8. [BEKENDE COMPATIBILITEITSPROBLEMEN](#SECTION8)

---


###1. <a name="SECTION1"></a>PREAMBULE

Dank u voor het gebruiken van phpMussel, een PHP-script ontwikkeld om trojans, virussen, malware en andere bedreigingen te ontworpen, binnen bestanden geüpload naar uw systeem waar het script is haakte, gebaseerd op de handtekeningen van ClamAV en anderen.

PHPMUSSEL COPYRIGHT 2013 en verder GNU/GPLv2 van Caleb M (Maikuolan).

Dit script is gratis software; u kunt, onder de voorwaarden van de GNU General Public License zoals gepubliceerd door de Free Software Foundation, herdistribueren en/of wijzigen dit; ofwel versie 2 van de Licentie, of (naar uw keuze) enige latere versie. Dit script wordt gedistribueerd in de hoop dat het nuttig zal zijn, maar ZONDER ENIGE GARANTIE; zonder zelfs de impliciete garantie van VERKOOPBAARHEID of GESCHIKTHEID VOOR EEN BEPAALD DOEL. Zie de GNU General Public License voor meer informatie, gelegen in het `LICENSE.txt` bestand en ook beschikbaar uit:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Speciale dank aan [ClamAV](http://www.clamav.net/) voor zowel project inspiratie en voor de handtekeningen dat dit script maakt gebruik daarvan, zonder welke, het script zou waarschijnlijk niet bestaan, of op zijn best, zou heeft zeer beperkte waarde.

Speciale dank aan Sourceforge en GitHub voor het hosten van de project-bestanden, ann [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) voor het hosten van de phpMussel discussies forums, en de extra bronnen van een aantal handtekeningen gebruikt door phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) en anderen, en speciale dank aan allen die het project steunen, aan iemand anders die ik anders misschien vergeten te vermelden, en voor u, voor het gebruik van het script.

Dit document en de bijbehorende pakket kunt gedownload gratis zijn van:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>HOE TE INSTALLEREN (VOOR WEBSERVERS)

Ik hoop te stroomlijnen dit proces door maken een installateur op een bepaald punt in de niet al te verre toekomst, maar tot die tijd, volg deze instructies te werken phpMussel om meeste systemen en CMS:

1) Omdat u zijn lezen dit, ik ben ervan uit u al gedownload een gearchiveerde kopie van het script, uitgepakt zijn inhoud en heeft het ergens op uw lokale computer. Vanaf hier, u nodig te bepalen waar op uw host of CMS die inhoud te plaatsen. Een bestandsmap zoals `/public_html/phpmussel/` of soortgelijk (hoewel, het is niet belangrijk welke u kiest, zolang het is iets veilig en iets waar u blij mee bent) zal volstaan. *Voordat u het uploaden begint, lees verder..*

2) Facultatief (sterk aanbevolen voor ervaren gebruikers, maar niet aan te raden voor beginners of voor de onervaren), open `phpmussel.ini` (gelegen binnen `vault`) - Dit bestand bevat alle beschikbare phpMussel configuratie opties. Boven elke optie moet een korte opmerking te beschrijven wat het doet en wat het voor. Pas deze opties als het u past, volgens welke geschikt is voor uw configuratie. Sla het bestand, sluiten.

3) Upload de inhoud (phpMussel en zijn bestanden) naar het bestandsmap die u zou op eerder besloten (u nodig niet de `*.txt`/`*.md` bestanden opgenomen, maar meestal, u moeten uploaden alles).

4) CHMOD het bestandsmap `vault` naar "777". De belangrijkste bestandsmap opslaan van de inhoud (degene die u eerder koos), gewoonlijk, kunt worden genegeerd, maar CHMOD-status moet worden gecontroleerd als u machtigingen problemen heeft in het verleden met uw systeem (standaard, moet iets zijn als "755").

5) Volgende, u nodig om "haak" phpMussel om uw systeem of CMS. Er zijn verschillende manieren waarop u kunt "haak" scripts zoals phpMussel om uw systeem of CMS, maar het makkelijkste is om gewoon omvatten voor het script aan het begin van een kern bestand van uw systeem of CMS (een die het algemeen altijd zal worden geladen wanneer iemand heeft toegang tot een pagina in uw website) met behulp van een `require` of `include` opdracht. Meestal is dit wel iets worden opgeslagen in een bestandsmap zoals `/includes`, `/assets` of `/functions`, en zal vaak zijn vernoemd iets als `init.php`, `common_functions.php`, `functions.php` of soortgelijk. U nodig om te bepalen welk bestand dit is voor uw situatie; Als u problemen ondervindt in het werken dit uit voor uzelf, bezoek de phpMussel support forums en laat het ons weten; Het is mogelijk dat ofwel mijzelf of een andere gebruiker kunt ervaring met de CMS die u gebruikt heeft (u nodig om ons te laten weten welk CMS u gebruikt), en dus, in staat zijn om wat hulp te bieden in dit gebied. Om dit te doen [te gebruiken `require` of `include`], plaatst u de volgende regel code aan het begin op die kern bestand, vervangen van de string die binnen de aanhalingstekens met het exacte adres van het `phpmussel.php` bestand (lokaal adres, niet het HTTP-adres; zal vergelijkbaar zijn met de eerder genoemde vault adres).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Opslaan bestand, sluiten, heruploaden.

-- OF ALTERNATIEF --

Als u gebruik een Apache webserver en als u heeft toegang om `php.ini`, u kunt gebruiken de `auto_prepend_file` richtlijn naar prepend phpMussel wanneer een PHP verzoek wordt gemaakt. Zoiets als:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

Of dit in het `.htaccess` bestand:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) Op dit punt, u bent klaar! Echter, u moet waarschijnlijk test het uit om ervoor te zorgen dat het werken correct. Voor het testen van het bestand upload protecties, proberen om de testen bestanden te uploaden opgenomen in het pakket als `_testfiles` naar uw website via uw gebruikelijke browser-gebaseerde uploaden methoden. Wanneer alles werkt, verschijnt er een bericht uit phpMussel bevestigen dat de upload met succes werd geblokkeerd. Wanneer er niets, is er iets niet correct werkt. Als u met behulp van een geavanceerde functies of als u met behulp van de andere types van het scannen mogelijk met het gereedschap, ik stel het uit te proberen met die ervoor zorgen dat het werkt zoals verwacht, ook.

---


###2B. <a name="SECTION2B"></a>HOE TE INSTALLEREN (VOOR CLI)

Ik hoop te stroomlijnen dit proces door maken een installateur op een bepaald punt in de niet al te verre toekomst, maar tot die tijd, volg deze instructies te werken phpMussel met CLI (beseffen dat op dit moment, CLI is alleen bekend om te werken met Windows-gebaseerde systemen; Linux en andere systemen zal binnenkort komen tot een latere versie van phpMussel):

1) Omdat u zijn lezen dit, ik ben ervan uit u al gedownload een gearchiveerde kopie van het script, uitgepakt zijn inhoud en heeft het ergens op uw lokale computer. Wanneer u heeft beslist dat u bent tevreden met de gekozen phpMussel locatie, voortzetten.

2) phpMussel vereist van PHP moet worden geïnstalleerd op de host machine om uit te werken correct. Als u niet heeft PHP geïnstalleerd op uw machine, installeer PHP op uw machine, volgende instructies door de PHP installateur geleverd.

3) Facultatief (sterk aanbevolen voor ervaren gebruikers, maar niet aan te raden voor beginners of voor de onervaren), open `phpmussel.ini` (gelegen binnen `vault`) - Dit bestand bevat alle beschikbare phpMussel configuratie opties. Boven elke optie moet een korte opmerking te beschrijven wat het doet en wat het voor. Wijzigen deze opties volgens welke geschikt is voor uw configuratie. Sla het bestand, sluiten.

4) Facultatief, u kunt om phpMussel in CLI-modus te maken makkelijker voor uzelf door het creëren van een batch-bestand te automatisch laden PHP en phpMussel. Om dit te doen, open een platte tekst editor zoals Notepad of Notepad++, typt u het volledige pad naar de `php.exe` bestand in het bestandsmap van uw PHP-installatie, gevolgd door een spatie, gevolgd door het volledige pad naar de `phpmussel.php` bestand in het bestandsmap van uw phpMussel installatie, Sla het bestand op met een ".bat" extensie ergens dat u het gemakkelijk vinden, en dubbelklik op het bestand om phpMussel te opereren in de toekomst.

5) Op dit punt, u bent klaar! Echter, u moet waarschijnlijk test het uit om ervoor te zorgen dat het werken correct. Om phpMussel testen, draaien phpMussel en probeer het scannen van de `_testfiles` bestandsmap die bij het pakket.

---


###3A. <a name="SECTION3A"></a>HOE TE GEBRUIKEN (VOOR WEBSERVERS)

phpMussel is bedoeld te zijn een script dat zal adequaat functioneren direct uit de doos met een minimum niveau van de eisen van uw kant: Eenmaal geïnstalleerd, in principe, het gewoon moeten werken.

Het scannen van het bestanden uploaden is geautomatiseerd en ingeschakeld door standaard, zo niets is vereist op namens u voor deze specifieke functie.

Echter, u bent ook in staat om te instrueren phpMussel om te scannen specifiek bestanden, bestandsmappen en/of archieven. Om dit te doen, ten eerste, moet u ervoor zorgen dat de juiste configuratie is ingesteld in het `phpmussel.ini` configuratiebestand (`cleanup` moet worden uitgeschakeld), en als u klaar bent, in een PHP-bestand dat wordt gehaakt op phpMussel, gebruik de volgende functie in uw code:

`phpMussel($what_to_scan,$output_type,$output_flatness);`

- `$what_to_scan` kunt worden een tekenreeks, een array, of een array van arrays, en vermelding welk bestand, bestanden, bestandsmap en/of bestandsmappen om scannen.
- `$output_type` is een boolean, met vermelding van het formaat voor de scanresultaten te worden geretourneerd als. False instrueert de functie om de resultaten als een integer retourneer (een geretourneerd resultaat van -3 betekent problemen werden aangetroffen met de phpMussel handtekeningen bestanden of handtekening kaart bestanden en dat zij mogelijk worden beschadigd of ontbreekt, -2 betekent dat beschadigd gegevens tijdens de scan werd ontdekt en dus de scan niet voltooid, -1 betekent dat uitbreidingen of addons vereist door PHP om de scan te voeren werd ontbraken zijn en dus de scan niet voltooid, 0 betekent dat het scandoel bestaat niet en dus was er niets te scannen, 1 betekent dat het doel met succes werden gescand en geen problemen gedetecteerd, en 2 betekent dat het doel met succes werd gescand en problemen werden gedetecteerd). True instrueert de functie om de resultaten als leesbare tekst retourneer. Bovendien, in elk geval, de resultaten kunnen worden geraadpleegd via globale variabelen na het scannen is voltooid. Deze variabele is optioneel, voorgedefinieerd als false.
- `$output_flatness` is een boolean, vermelding van de functie of de resultaten van de scan retourneren (wanneer er meerdere scandoelen) als een array of een tekenreeks. False zullen de resultaten als een array retourneer. True zullen de resultaten als een tekenreeks retourneer. Deze variabele is optioneel, voorgedefinieerd als false.

Voorbeeld:

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

Retourneren iets als dit (als een tekenreeks):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Gestart.
 > Verifiëren '/user_name/public_html/my_file.html':
 -> Geen problemen gevonden.
 Wed, 16 Sep 2013 02:49:47 +0000 Afgewerkt.
```

Voor een volledige beschrijving van de soorten van de handtekeningen gebruikt door phpMussel tijdens de scans en hoe het omgaat met deze handtekeningen, raadpleeg de Handtekeningformaat sectie van dit README bestand.

Als u tegenkomen valse positieven, als u iets nieuws tegenkomen waarvan u denkt dat zou moeten geblokkeerd worden, of voor iets anders met betrekking tot handtekeningen, neem dan contact met mij over het zo dat ik de noodzakelijke veranderingen kunnen maken, die, als u niet contact met mij over, ik zou niet per se bewust van.

Voor uitschakelen om de handtekeningen die bij phpMussel (zoals als u het ervaren van een vals positief specifiek voor uw doeleinden dat mag niet normaal van stroomlijn worden verwijderd), raadpleeg de greylisting aantekeningen binnen de Browser Richtlijnen sectie van dit README bestand.

In aanvulling op de standaard bestand uploaden scannen en de optionele scannen van andere bestanden en/of bestandsmappen opgegeven via de bovenstaande functie, in phpMussel een functie bestemd voor het scannen van het lichaam van emailberichten. Deze functie gedraagt zich zoals de phpMussel() standaardfunctie, maar richt zich uitsluitend op bijpassende tegen de ClamAV email-gebaseerde handtekeningen. Ik heb niet gebonden deze handtekeningen naar de phpMussel() standaardfunctie, want het is zeer onwaarschijnlijk dat u zou ooit het lichaam van een inkomende emailbericht vinden in het behoefte van scannen binnen een bestand-upload gericht op een pagina waar phpMussel is haakte, en dus, om deze handtekeningen te binden in de phpMussel() functie zou overbodig zijn. Echter, dat gezegd hebbende, een aparte functie te meten met deze handtekeningen kunnen blijken uiterst nuttig voor sommigen, vooral voor degenen wier CMS of webfront systeem is een of andere manier gebonden in hun email systeem en voor degenen die het ontleden van hun emails via een PHP-script dat ze zou kunnen haak in phpMussel. Configuratie voor deze functie, net als alle anderen, wordt via het `phpmussel.ini` bestand gecontroleerde. Om deze functie te gebruiken (u nodig om uw eigen implementatie), in een PHP-bestand dat wordt aangesloten op phpMussel, gebruik de volgende functie in uw code:

`phpMussel_mail($body);`

Waar $body is het lichaam van het emailbericht dat u wilt scannen (bovendien, u zou kunnen proberen te scannen nieuwe forum posts, inkomende berichten van uw online contactformulier of soortgelijk). Bij een fout voorkomen dat de functie voltooien de scan, een waarde van -1 zal worden geretourneerd. Als de functie voltooit haar scan en niets is vinden, een waarde van 0 zal worden geretourneerd (wat betekent niet-kwaadaardige). Als, echter, iets is vinden door de functie, een string zal worden geretourneerd, met daarin een bericht te verklaren wat het heeft gevonden.

In aanvulling op het bovenstaande, als u kijkt naar de broncode, u zou kunnen opmerken deze functies: phpMusselD() en phpMusselR(). Deze functies zijn sub-functies van phpMussel(), en moeten niet worden opgeroepen direct buiten die ouder functie (niet vanwege bijwerkingen; meer-zo, simpelweg het zou geen enkel doel dienen, en waarschijnlijk zal niet echt goed werken hoe dan ook).

Er zijn vele andere controles en functies beschikbaar zijn binnen phpMussel voor uw gebruik, ook. Voor dergelijke controles en functies dat, met het einde van dit deel van de README, zijn nog niet gedocumenteerd, gelieve verder te lezen en raadpleeg de Browser Richtlijnen sectie van dit README bestand.

---


###3B. <a name="SECTION3B"></a>HOE TE GEBRUIKEN (VOOR CLI)

Raadpleeg de "HOE TE INSTALLEREN (VOOR CLI)" sectie van dit README bestand.

Gelieve bewust te zijn, hoewel toekomstige versies van phpMussel andere systemen moet ondersteunen, momenteel, phpMussel CLI-modus ondersteuning is alleen geoptimaliseerd voor gebruik op Windows gebaseerde systemen (u kunt, natuurlijk, probeer het op andere systemen, maar ik kan niet garanderen dat het zal werken zoals bedoeld).

Eveneens, noteren dat phpMussel is niet de functionele equivalent van een compleet anti-virus suite, en in tegenstelling tot conventionele anti-virus suites, het maakt niet actief geheugen controleren of virussen detecteren buiten het toepassingsgebied! Het zal alleen virussen vervat in specifieke bestanden detecteren dat u expliciet zeggen dat het te scannen.

---


###4A. <a name="SECTION4A"></a>BROWSER RICHTLIJNEN

Wanneer phpMussel is geïnstalleerd en correct functionerende op uw systeem, als u de `script_password` en `logs_password` variabelen heeft ingesteld in het configuratiebestand, u zult in staat om te presteren sommige beperkt aantal administratieve functies en input sommige aantal commando's naar phpMussel via uw browser. De reden dat deze wachtwoorden moeten worden ingesteld om te deze browser controles te worden ingeschakeld is om een goede veiligheid te verzekeren, een goede bescherming van deze browser controles en zodat er een manier voor deze browser controles te geheel uitgeschakeld worden als ze niet gewenst door jou en/of ander webmasters/beheerders gebruikmakend van phpMussel. Dus, in andere woorden, om deze controles te inschakelen, stel een wachtwoord, en om deze controles te uitschakelen, stel geen wachtwoord. Alternatief, als u kiezen om deze controles te inschakelen en dan kiezen om deze controles te uitschakelen op een toekomst tijdstip, er is een commando om dit te doen (zodanig kan nuttig zijn als u heeft actie te ondernemen met potentieel van om de gedelegeerde wachtwoorden te compromitteer en daarom moeten om deze controles te snel uitschakelen zonder uw configuratiebestand te modificeren).

Redenen voor deze controles te wordt ingeschakeld:
- Biedt een manier om handtekeningen te greylist in gevallen zoals wanneer u ontdekken een handtekening dat is produceren van een vals-positieve tijdens het uploaden van bestanden naar uw systeem en u heeft geen tijd te handmatig bewerken en heruploaden uw greylist bestand.
- Biedt een manier voor u te toestaan iemand anders dan uzelf te controleer uw exemplaar van phpMussel zonder de impliciete behoefte te geven om hen toegang tot FTP.
- Biedt een manier om gecontroleerde toegang tot uw logbestanden te bieden.
- Biedt een eenvoudige manier om phpMussel bijgewerkt wanneer er updates beschikbaar zijn.
- Biedt een manier voor u om te controleren phpMussel wanneer FTP-toegang of andere conventionele toegangspunten voor het toezicht op phpMussel zijn niet beschikbaar.

Redenen voor deze controles te _**NIET**_ wordt ingeschakeld:
- Biedt een vector voor potentiële aanvallers en ongewensten om te bepalen als u gebruik van phpMussel (hoewel, Dit kan zowel een reden zijn en een reden zijn tegen, afhankelijk van het perspectief) door middel van blindelings het verzenden van commando aan servers als middel sonderen. Aan de ene kant, dit zou kunnen ontmoedigen aanvallers van het richten van uw systeem als zij leren dat u gebruikt phpMussel, aannemende dat ze zijn sonderen omdat hun aanval methode is ineffectief gerenderd als gevolg van het gebruik van phpMussel. Echter, aan de andere kant, als sommige onvoorziene en momenteel onbekende exploiteren binnen van phpMussel of een toekomstige versie daarvan komt aan het licht, en als het mogelijk zou kunnen bieden voor een aanvalsvector, een positief resultaat van zo'n sonderen eigenlijk zou kunnen aanmoedigen aanvallers uw systeem te richten.
- Als uw gedelegeerde wachtwoorden ooit werden gecompromitteerd, tenzij veranderd, zou bieden een manier voor een aanvaller te omzeilen wat handtekeningen kan anders normaal verhinderen het aanvallen van slagen, of potentieel uitschakelen phpMussel helemaal, dus verschaffen van een manier te renderen de doeltreffendheid van phpMussel betwistbaar.

In elk geval, ongeacht wat u kiest, de keuze is uiteindelijk jou. Standaard, deze controles zullen worden uitgeschakeld, maar hebben een over nadenken, en als u besluit dat u wilt hen, dit sectie verklaart hoe te inschakelen en hoe te gebruiken hen.

Een lijst van beschikbare browser commando's.

scan_log
- Wachtwoord vereist: `logs_password`
- Andere vereisten: scan_log moet worden ingesteld.
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?logspword=[logs_password]&phpmussel=scan_log`
- Wat het doet: Drukt de inhoud van uw scan_log bestand naar het scherm.

scan_kills
- Wachtwoord vereist: `logs_password`
- Andere vereisten: scan_kills moet worden ingesteld.
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?logspword=[logs_password]&phpmussel=scan_kills`
- Wat het doet: Drukt de inhoud van uw scan_kills bestand naar het scherm.

controls_lockout
- Wachtwoord vereist: `logs_password` OF `script_password`
- Andere vereisten: (geen)
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Example 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Example 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Wat het doet: Uitschakelen alle browser controles. Deze moet worden gebruikt als u vermoedt dat een van uw wachtwoorden zijn gecompromitteerd (dit kan gebeuren als u gebruik deze controles vanaf een computer die niet is beveiligd en/of niet vertrouwd). controls_lockout werkt door creëren van een bestand, `controls.lck`, in uw vault, dat phpMussel zal controleren voordat om uitvoeren van commando's van welke aard. Zodra dit gebeurt, om herinschakelen van controles, u nodig om het bestand `controls.lck` te handmatig verwijderen via FTP of soortgelijke. Kunt worden opgeroepen met behulp van ieder van het wachtwoorden.

disable
- Wachtwoord vereist: `script_password`
- Andere vereisten: (geen)
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=disable`
- Wat het doet: Uitschakelen phpMussel. Dit moet gebruikt als u bent uitvoeren ieder updaten of wijzigingen aan uw systeem of als u bent installeren ieder nieuwe software of modules aan uw systeem dat doet of zou kunnen potentieel leiden valse positieven. Ook, dit moet worden gebruikt als heeft u een problemen met phpMussel maar niet willen het te verwijderen van uw systeem. Zodra dit gebeurt, om herinschakelen van phpMussel, gebruik "enable".

enable
- Wachtwoord vereist: `script_password`
- Andere vereisten: (geen)
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=enable`
- Wat het doet: Inschakelen phpMussel. Dit moet worden gebruikt als u eerder heeft uitgeschakeld phpMussel gebruiken "disable" en wil het herinschakeld.

update
- Wachtwoord vereist: `script_password`
- Andere vereisten: `update.dat` en `update.inc` moet bestaan
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=update`
- Wat het doet: Controleert of er updates voor phpMussel en handtekeningen. Als update-controleert slagen en updates worden gevonden, zal proberen om deze updates te downloaden en te installeren. Als update-controleert mislukt, update zal aborteren. De resultaten van het hele proces worden afgedrukt naar het scherm. Ik raad ten minste eenmaal per maand te controleren om ervoor te zorgen dat uw handtekeningen en uw kopie van phpMussel zijn huidige (tenzij, natuurlijk, u controleren op updates en installeren handmatig, dat, ik zou nog steeds aanbevelen dat te doen ten minste eenmaal per maand). Controleren meer dan tweemaal per maand is waarschijnlijk zinloos, aangezien dat ik ben zeer onwaarschijnlijk te produceren updates van welke aard meer vaker dan dat (noch heb ik in het bijzonder wil voor het grootste gedeelte).

greylist
- Wachtwoord vereist: `script_password`
- Andere vereisten: (geen)
- Andere vereisten: [Naam van de handtekening van de greylist]
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]`
- Wat het doet: Toevoegen een handtekening aan de greylist.

greylist_clear
- Wachtwoord vereist: `script_password`
- Andere vereisten: (geen)
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=greylist_clear`
- Wat het doet: Verwijderen de hele greylist.

greylist_show
- Wachtwoord vereist: `script_password`
- Andere vereisten: (geen)
- Andere vereisten: (geen)
- Optionele parameters: (geen)
- Voorbeeld: `?pword=[script_password]&phpmussel=greylist_show`
- Wat het doet: Drukt de inhoud van de greylist naar het scherm.

---


###4B. <a name="SECTION4B"></a>CLI (COMMANDLIJN INTERFACE)

phpMussel kan worden uitgevoerd als een interactief bestand scanner in de CLI-modus onder Windows-gebaseerde systemen. Raadpleeg de sectie "HOE TE INSTALLEREN (VOOR CLI)" van deze README bestand voor meer informatie.

Voor een lijst van beschikbare CLI commando's, bij de CLI-prompt, typ 'c', en druk op Enter.

---


###5. <a name="SECTION5"></a>BESTANDEN IN DIT PAKKET

Het volgende is een lijst van alle bestanden die moeten worden opgenomen in de gearchiveerde kopie van dit script als u gedownload het, alle bestanden die kunt mogelijk worden gemaakt als resultaat van uw gebruik van dit script, samen met een korte beschrijving van wat al deze bestanden zijn voor.

Bestand | Beschrijving
----|----
/.gitattributes | Een GitHub project bestand (niet vereist voor een goede werking van het script).
/composer.json | Composer/Packagist informatie (niet vereist voor een goede werking van het script).
/CONTRIBUTING.md | Informatie over hoe bij te dragen aan het project.
/LICENSE.txt | Een kopie van de GNU/GPLv2 licentie.
/PEOPLE.md | Informatie over de bij het project betrokken personen.
/phpmussel.php | Lader (laadt de belangrijkste script, updater, ezv). Dit is wat u zou moeten worden inhaken in (essentieel)!
/README.md | Project beknopte informatie.
/web.config | Een ASP.NET-configuratiebestand (in dit geval, naar het bestandsmap "vault" te beschermen tegen toegang door niet-geautoriseerde bronnen indien het script is geïnstalleerd op een server op basis van ASP.NET technologieën).
/_docs/ | Documentatie bestandsmap (bevat verschillende bestanden).
/_docs/change_log.txt | Een overzicht van wijzigingen in het script tussen verschillende versies (niet vereist voor een goede werking van het script).
/_docs/readme.ar.md | Arabisch documentatie.
/_docs/readme.de.md | Duitse documentatie.
/_docs/readme.de.txt | Duitse documentatie.
/_docs/readme.en.md | Engels documentatie.
/_docs/readme.en.txt | Engels documentatie.
/_docs/readme.es.md | Spaanse documentatie.
/_docs/readme.es.txt | Spaanse documentatie.
/_docs/readme.fr.md | Franse documentatie.
/_docs/readme.fr.txt | Franse documentatie.
/_docs/readme.id.md | Indonesisch documentatie.
/_docs/readme.id.txt | Indonesisch documentatie.
/_docs/readme.it.md | Italiaanse documentatie.
/_docs/readme.it.txt | Italiaanse documentatie.
/_docs/readme.nl.md | Nederlandse documentatie.
/_docs/readme.nl.txt | Nederlandse documentatie.
/_docs/readme.pt.md | Portugees documentatie.
/_docs/readme.pt.txt | Portugees documentatie.
/_docs/readme.ru.md | Russische documentatie.
/_docs/readme.ru.txt | Russische documentatie.
/_docs/readme.vi.md | Vietnamees documentatie.
/_docs/readme.vi.txt | Vietnamees documentatie.
/_docs/readme.zh-TW.md | Chinees (Traditioneel) documentatie.
/_docs/readme.zh.md | Chinees (Vereenvoudigd) documentatie.
/_docs/signatures_tally.txt | Net-shift tally van meegeleverde handtekeningen (niet vereist voor een goede werking van het script).
/_testfiles/ | Testbestanden bestandsmap (bevat verschillende bestanden). Alle opgenomen bestanden zijn testbestanden voor het testen als phpMussel correct op uw systeem is geïnstalleerd, en u hoeft niet om deze map of een van het bestanden, behalve bij het doen van dergelijke testen te uploaden.
/_testfiles/ascii_standard_testfile.txt | Testbestand voor het testen phpMussel genormaliseerde ASCII handtekeningen.
/_testfiles/coex_testfile.rtf | Testbestand voor het testen phpMussel complexe uitgebreide handtekeningen.
/_testfiles/exe_standard_testfile.exe | Testbestand voor het testen phpMussel PE handtekeningen.
/_testfiles/general_standard_testfile.txt | Testbestand voor het testen phpMussel algemene handtekeningen.
/_testfiles/graphics_standard_testfile.gif | Testbestand voor het testen phpMussel grafische handtekeningen.
/_testfiles/html_standard_testfile.html | Testbestand voor het testen phpMussel genormaliseerde HTML handtekeningen.
/_testfiles/md5_testfile.txt | Testbestand voor het testen phpMussel MD5 handtekeningen.
/_testfiles/metadata_testfile.tar | Testbestand voor het testen phpMussel metadata handtekeningen en voor het testen van TAR bestandsondersteuning op uw systeem.
/_testfiles/metadata_testfile.txt.gz | Testbestand voor het testen phpMussel metadata handtekeningen en voor het testen van GZ bestandsondersteuning op uw systeem.
/_testfiles/metadata_testfile.zip | Testbestand voor het testen phpMussel metadata handtekeningen en voor het testen van ZIP bestandsondersteuning op uw systeem.
/_testfiles/ole_testfile.ole | Testbestand voor het testen phpMussel OLE handtekeningen.
/_testfiles/pdf_standard_testfile.pdf | Testbestand voor het testen phpMussel PDF handtekeningen.
/_testfiles/pe_sectional_testfile.exe | Testbestand voor het testen phpMussel PE Sectionele handtekeningen.
/_testfiles/swf_standard_testfile.swf | Testbestand voor het testen phpMussel SWF handtekeningen.
/_testfiles/xdp_standard_testfile.xdp | Testbestand voor het testen phpMussel XML/XDP handtekeningen.
/vault/ | Vault bestandsmap (bevat verschillende bestanden).
/vault/.htaccess | Een hypertext toegang bestand (in dit geval, om gevoelige bestanden die behoren tot het script te beschermen tegen toegang door niet-geautoriseerde bronnen).
/vault/cache/ | Cache bestandsmap (tijdelijke data).
/vault/cache/.htaccess | Een hypertext toegang bestand (in dit geval, om gevoelige bestanden die behoren tot het script te beschermen tegen toegang door niet-geautoriseerde bronnen).
/vault/cli.inc | CLI handler.
/vault/config.inc | Configuratie handler.
/vault/controls.inc | Controls handler.
/vault/functions.inc | Functies bestand (essentieel).
/vault/greylist.csv | CSV van greylisted handtekeningen aangeeft om phpMussel waarop handtekeningen moet worden negeren (bestand automatisch aangemaakt opnieuw als verwijderd).
/vault/lang.inc | taaldata.
/vault/lang/ | Bevat phpMussel taaldata.
/vault/lang/.htaccess | Een hypertext toegang bestand (in dit geval, om gevoelige bestanden die behoren tot het script te beschermen tegen toegang door niet-geautoriseerde bronnen).
/vault/lang/lang.ar.inc | Arabisch taaldata.
/vault/lang/lang.de.inc | Duitse taaldata.
/vault/lang/lang.en.inc | Engels taaldata.
/vault/lang/lang.es.inc | Spaanse taaldata.
/vault/lang/lang.fr.inc | Franse taaldata.
/vault/lang/lang.id.inc | Indonesisch taaldata.
/vault/lang/lang.it.inc | Italiaanse taaldata.
/vault/lang/lang.ja.inc | Japanse taaldata.
/vault/lang/lang.nl.inc | Nederlandse taaldata.
/vault/lang/lang.pt.inc | Portugees taaldata.
/vault/lang/lang.ru.inc | Russische taaldata.
/vault/lang/lang.vi.inc | Vietnamees taaldata.
/vault/lang/lang.zh-TW.inc | Chinees (Traditioneel) taaldata.
/vault/lang/lang.zh.inc | Chinees (Vereenvoudigd) taaldata.
/vault/phpmussel.ini | Configuratiebestand; Bevat alle configuratieopties van phpMussel, het vertellen wat te doen en hoe om te werken correct (essentiële)!
/vault/quarantine/ | Quarantaine bestandsmap (bestanden in quarantaine bevat).
/vault/quarantine/.htaccess | Een hypertext toegang bestand (in dit geval, om gevoelige bestanden die behoren tot het script te beschermen tegen toegang door niet-geautoriseerde bronnen).
※ /vault/scan_kills.txt | Een record van elk bestand uploaden geblokkeerde/gedood door phpMussel.
※ /vault/scan_log.txt | Een record van alles gescand door phpMussel.
※ /vault/scan_log_serialized.txt | Een record van alles gescand door phpMussel.
/vault/signatures/ | Handtekeningen bestandsmap (handtekening bestanden bevat).
/vault/signatures/.htaccess | Een hypertext toegang bestand (in dit geval, om gevoelige bestanden die behoren tot het script te beschermen tegen toegang door niet-geautoriseerde bronnen).
/vault/signatures/ascii_clamav_regex.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_clamav_regex.map | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_clamav_standard.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_clamav_standard.map | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_custom_regex.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_custom_standard.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_mussel_regex.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/ascii_mussel_standard.cvd | Bestand voor genormaliseerde ASCII handtekeningen.
/vault/signatures/coex_clamav.cvd | Bestand voor complexe uitgebreide handtekeningen.
/vault/signatures/coex_custom.cvd | Bestand voor complexe uitgebreide handtekeningen.
/vault/signatures/coex_mussel.cvd | Bestand voor complexe uitgebreide handtekeningen.
/vault/signatures/elf_clamav_regex.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/elf_clamav_regex.map | Bestand voor ELF handtekeningen.
/vault/signatures/elf_clamav_standard.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/elf_clamav_standard.map | Bestand voor ELF handtekeningen.
/vault/signatures/elf_custom_regex.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/elf_custom_standard.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/elf_mussel_regex.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/elf_mussel_standard.cvd | Bestand voor ELF handtekeningen.
/vault/signatures/exe_clamav_regex.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_clamav_regex.map | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_clamav_standard.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_clamav_standard.map | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_custom_regex.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_custom_standard.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_mussel_regex.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/exe_mussel_standard.cvd | Bestand voor PE (Portable Executable) handtekeningen.
/vault/signatures/filenames_clamav.cvd | Bestand voor bestandsnaam handtekeningen.
/vault/signatures/filenames_custom.cvd | Bestand voor bestandsnaam handtekeningen.
/vault/signatures/filenames_mussel.cvd | Bestand voor bestandsnaam handtekeningen.
/vault/signatures/general_clamav_regex.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/general_clamav_regex.map | Bestand voor algemene handtekeningen.
/vault/signatures/general_clamav_standard.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/general_clamav_standard.map | Bestand voor algemene handtekeningen.
/vault/signatures/general_custom_regex.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/general_custom_standard.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/general_mussel_regex.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/general_mussel_standard.cvd | Bestand voor algemene handtekeningen.
/vault/signatures/graphics_clamav_regex.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_clamav_regex.map | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_clamav_standard.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_clamav_standard.map | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_custom_regex.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_custom_standard.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_mussel_regex.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/graphics_mussel_standard.cvd | Bestand voor grafische handtekeningen.
/vault/signatures/hex_general_commands.csv | Hex-gecodeerde CSV van algemene commando detecties optioneel gebruikt door phpMussel.
/vault/signatures/html_clamav_regex.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_clamav_regex.map | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_clamav_standard.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_clamav_standard.map | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_custom_regex.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_custom_standard.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_mussel_regex.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/html_mussel_standard.cvd | Bestand voor genormaliseerde HTML handtekeningen.
/vault/signatures/macho_clamav_regex.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_clamav_regex.map | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_clamav_standard.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_clamav_standard.map | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_custom_regex.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_custom_standard.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_mussel_regex.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/macho_mussel_standard.cvd | Bestand voor Mach-O handtekeningen.
/vault/signatures/mail_clamav_regex.cvd | Bestand voor mail handtekeningen.
/vault/signatures/mail_clamav_regex.map | Bestand voor mail handtekeningen.
/vault/signatures/mail_clamav_standard.cvd | Bestand voor mail handtekeningen.
/vault/signatures/mail_clamav_standard.map | Bestand voor mail handtekeningen.
/vault/signatures/mail_custom_regex.cvd | Bestand voor mail handtekeningen.
/vault/signatures/mail_custom_standard.cvd | Bestand voor mail handtekeningen.
/vault/signatures/mail_mussel_regex.cvd | Bestand voor mail handtekeningen.
/vault/signatures/mail_mussel_standard.cvd | Bestand voor mail handtekeningen.
/vault/signatures/md5_clamav.cvd | Bestand voor MD5 gebaseerde handtekeningen.
/vault/signatures/md5_custom.cvd | Bestand voor MD5 gebaseerde handtekeningen.
/vault/signatures/md5_mussel.cvd | Bestand voor MD5 gebaseerde handtekeningen.
/vault/signatures/metadata_clamav.cvd | Bestand voor archief metadata handtekeningen.
/vault/signatures/metadata_custom.cvd | Bestand voor archief metadata handtekeningen.
/vault/signatures/metadata_mussel.cvd | Bestand voor archief metadata handtekeningen.
/vault/signatures/ole_clamav_regex.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/ole_clamav_regex.map | Bestand voor OLE handtekeningen.
/vault/signatures/ole_clamav_standard.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/ole_clamav_standard.map | Bestand voor OLE handtekeningen.
/vault/signatures/ole_custom_regex.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/ole_custom_standard.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/ole_mussel_regex.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/ole_mussel_standard.cvd | Bestand voor OLE handtekeningen.
/vault/signatures/pdf_clamav_regex.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_clamav_regex.map | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_clamav_standard.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_clamav_standard.map | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_custom_regex.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_custom_standard.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_mussel_regex.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pdf_mussel_standard.cvd | Bestand voor PDF handtekeningen.
/vault/signatures/pex_custom.cvd | Bestand voor PE uitgebreide handtekeningen.
/vault/signatures/pex_mussel.cvd | Bestand voor PE uitgebreide handtekeningen.
/vault/signatures/pe_clamav.cvd | Bestand voor PE Sectionele handtekeningen.
/vault/signatures/pe_custom.cvd | Bestand voor PE Sectionele handtekeningen.
/vault/signatures/pe_mussel.cvd | Bestand voor PE Sectionele handtekeningen.
/vault/signatures/swf_clamav_regex.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_clamav_regex.map | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_clamav_standard.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_clamav_standard.map | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_custom_regex.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_custom_standard.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_mussel_regex.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/swf_mussel_standard.cvd | Bestand voor the Shockwave handtekeningen.
/vault/signatures/switch.dat | Controles en sets bepaalde variabelen.
/vault/signatures/urlscanner.cvd | Bestand voor URL scanner handtekeningen.
/vault/signatures/whitelist_clamav.cvd | Bestand-specifieke whitelist.
/vault/signatures/whitelist_custom.cvd | Bestand-specifieke whitelist.
/vault/signatures/whitelist_mussel.cvd | Bestand-specifieke whitelist.
/vault/signatures/xmlxdp_clamav_regex.cvd | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_clamav_regex.map | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_clamav_standard.cvd | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_clamav_standard.map | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_custom_regex.cvd | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_custom_standard.cvd | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_mussel_regex.cvd | Bestand voor XML/XDP handtekeningen.
/vault/signatures/xmlxdp_mussel_standard.cvd | Bestand voor XML/XDP handtekeningen.
/vault/template.html | Sjabloonbestand; Sjabloon voor HTML-uitvoer geproduceerd door phpMussel voor zijn geblokkeerd bestand te uploaden bericht (het bericht gezien te de uploader).
/vault/template_custom.html | Sjabloonbestand; Sjabloon voor HTML-uitvoer geproduceerd door phpMussel voor zijn geblokkeerd bestand te uploaden bericht (het bericht gezien te de uploader).
/vault/update.dat | Bestand met versie-informatie voor zowel de phpMussel script en de phpMussel handtekeningen. Als u ooit wilt te automatisch update phpMussel of willen phpMussel updaten via uw browser, dit bestand is essentieel.
/vault/update.inc | Update Script; Vereist voor automatische updates en voor het bijwerken van phpMussel via uw browser, maar niet anders vereist.
/vault/upload.inc | Upload handler.

※ Bestandsnaam kan verschillen, afhankelijk van de configuratie bedingen (van `phpmussel.ini`).

####*MET BETREKKING TOT HANDTEKENING BESTANDEN*
CVD is een acroniem voor "ClamAV Virus Definitions", in verwijzing zowel om hoe ClamAV verwijst aan zijn eigen handtekeningen en het gebruik van de handtekeningen voor phpMussel; Bestanden eindigend met "CVD" bevatten handtekeningen.

Bestanden eindigend met "MAP" kaart die handtekeningen phpMussel moeten en niet moeten gebruik voor individuele scans; Niet alle handtekeningen zijn noodzakelijkerwijs nodig voor elke scan, en zo, phpMussel maakt gebruik van kaarten van het handtekening bestanden te versnellen het scanproces (een proces dat zou worden anders zeer traag en vervelend).

Handtekening bestanden gemarkeerd met "_regex" bevatten handtekeningen dat maakt gebruiken van reguliere expressie patroon controleren (regex).

Handtekening bestanden gemarkeerd met "_standard" bevatten handtekeningen dat niet maakt gebruik van ieder specifiek vorm van patroon controleren.

Handtekening bestanden gemarkeerd niet met "_regex" noch "_standard" zal zijn als ene of de andere, maar niet beide (raadpleeg de Handtekeningformaat sectie van dit README bestand voor documentatie en specifieke details).

Handtekening bestanden gemarkeerd met "_clamav" bevatten handtekeningen dat zijn geheel afkomstig van de ClamAV databank (GNU/GPL).

Handtekening bestanden gemarkeerd met "_custom", als standaard, bevat geen handtekeningen; Deze dergelijke bestanden bestaan te geven u ergens aan uw eigen aangepaste handtekeningen te plaatsen, als u komen met elke van uw eigen.

Handtekening bestanden gemarkeerd met "_mussel" bevatten handtekeningen dat specifiek zijn niet afkomstig van ClamAV, handtekeningen dat, in algemeen, ik heeft persoonlijk geschreven en/of gebaseerd op diverse verschillende bronnen.

---


###6. <a name="SECTION6"></a>CONFIGURATIEOPTIES
Het volgende is een lijst van variabelen die in de `phpmussel.ini` configuratiebestand van phpMussel, samen met een beschrijving van hun doel en functie.

####"general" (Categorie)
Algemene configuratie voor phpMussel.

"script_password"
- Voor het gemak, phpMussel zullen bepaalde functies toestaan (inclusief de mogelijkheid om actief update phpMussel) te handmatig worden geactiveerd via POST, GET en QUERY. Echter, als een veiligheidsmaatregel, om dit te doen, phpMussel zal verwachten een wachtwoord te worden opgenomen met het commando, te waarborgen dat het u, en niet iemand anders, dat is proberen te handmatig activeren deze functies. Zetten `script_password` aan de wachtwoord zou u willen te gebruiken. Als er geen wachtwoord ingesteld, handmatige gebruik door standaard wordt uitgeschakeld. Gebruik iets wat u zult herinneren, maar dat is moeilijk voor anderen te gissen.
- Heeft geen invloed in CLI-modus.

"logs_password"
- Hetzelfde als `script_password`, maar voor het bekijken van de inhoud van scan_log en scan_kills. Hebben verschillende wachtwoorden kan nuttig zijn als u wilt te geven toegang tot iemand anders voor een set van functies, maar niet de andere.
- Heeft geen invloed in CLI-modus.

"cleanup"
- Vrijmaken script variabelen en de cache na de uitvoering? False = Nee; True = Ja [Standaard]. Als u niet gebruik het script na de eerste scan van upload, moet zetten op `true` (ja), om minimaliseren de geheugengebruik. Als u gebruik het script voor de doeleinden na de eerste scan van upload, moet zetten op `false` (nee), om te voorkomen dat onnodig herladen dubbele gegevens in het geheugen. In de huisartspraktijk, moet waarschijnlijk worden zetten op `true` (ja), maar, als u dit doet, het zal niet mogelijk zijn om het script te gebruiken voor iets anders dan het scannen van bestand uploaden.
- Heeft geen invloed in CLI-modus.

"scan_log"
- Bestandsnaam van het bestand te opnemen alle scanresultaten. Geef een bestandsnaam of laat leeg om te uitschakelen.

"scan_log_serialized"
- Bestandsnaam van het bestand te opnemen alle scanresultaten (formaat is geserialiseerd). Geef een bestandsnaam of laat leeg om te uitschakelen.

"scan_kills"
- Bestandsnaam van het bestand te opnemen alle geblokkeerde of gedood upload. Geef een bestandsnaam of laat leeg om te uitschakelen.

"ipaddr"
- Waar het IP-adres van het aansluiten verzoek te vinden? (Handig voor diensten zoals Cloudflare en dergelijke) Standaard = REMOTE_ADDR. WAARSCHUWING: Verander dit niet tenzij u weet wat u doet!

"forbid_on_block"
- Mocht phpMussel sturen 403 headers met het bestanden upload geblokkeerd bericht, of houd de gebruikelijke 200 OK? False = Nee (200) [Standaard]; True = Ja (403).

"delete_on_sight"
- Het inschakelen van dit richtlijn zal instrueren het script om elke gescande geprobeerd bestand upload dat gecontroleerd tegen elke detectie criteria te proberen onmiddellijk verwijderen, via handtekeningen of anderszins. Bestanden vastbesloten te zijn schoon zal niet worden aangeraakt. In het geval van archieven, het hele archief wordt verwijderd, ongeacht of niet het overtredende bestand is slechts één van meerdere bestanden vervat in het archief. Voor het geval van bestand upload scannen, doorgaans, het is niet nodig om dit richtlijn te inschakelen, omdat doorgaans, PHP zal automatisch zuiveren de inhoud van zijn cache wanneer de uitvoering is voltooid, wat betekent dat het doorgans zal verwijdert ieder bestanden geüpload doorheen aan de server tenzij ze zijn verhuisd, gekopieerd of verwijderd alreeds. Dit richtlijn is toegevoegd hier als een extra maatregel van veiligheid voor degenen wier kopies van PHP misschien niet altijd gedragen op de manier verwacht. False = Na het scannen, met rust laten het bestand [Standaard]; True = Na het scannen, als niet schoon, onmiddellijk verwijderen.

"lang"
- Geef de standaardtaal voor phpMussel.

"lang_override"
- Geef als phpMussel moet, wanneer mogelijk, overschrijven de taal specificatie met de taalvoorkeur verklaard door inkomende verzoeken (HTTP_ACCEPT_LANGUAGE). False = Nee [Standaard]; True = Ja.

"lang_acceptable"
- Het `lang_acceptable` richtlijn vertelt phpMussel welke talen door het script kunt worden aanvaard van `lang` of van `HTTP_ACCEPT_LANGUAGE`. Dit richtlijn moet -alleen- worden gewijzigd als u het toevoegen van uw eigen aangepaste taalbestanden of gedwongen verwijderen taalbestanden. De richtlijn is een door komma's gescheiden tekenreeks van de codes van die talen dat door het script zijn aanvaard.

"quarantine_key"
- phpMussel is in staat om gevlagd geprobeerd bestandsuploads te quarantaine in isolatie binnen de phpMussel vault, als dit is iets wat u wilt doen. Regelmatige gebruikers van phpMussel dat gewoon willen om hun websites of hosting-omgeving te beschermen zonder enige interesse in diep analyseren van gevlagd geprobeerd bestandsuploads moet dit functionaliteit hebben uitgeschakeld, maar elke gebruikers geïnteresseerd in de verdere analyse van gevlagd geprobeerd bestandsuploads voor malware onderzoek of voor soortgelijke zaken moeten inschakelen dit functionaliteit. Quarantaine van gevlagd geprobeerd bestandsuploads kunt ook somtijds helpen bij het opsporen van vals-positieven, als dit is iets dat vaak voorkomt voor u. Voor de uitschakelen van quarantaine functionaliteit, gewoon laat de `quarantine_key` richtlijn leeg, of wissen de inhoud van de richtlijn als het niet leeg alreeds. Voor de inschakelen van quarantaine functionaliteit, invoeren soms waarde in de richtlijn. De `quarantine_key` is een belangrijke beveiliging kenmerk van de quarantaine functionaliteit vereist als middel om de functionaliteit quarantaine te verhinderen exploitatie door potentiële aanvallers en als middel om verhinderen van elke mogelijke gegevens uitvoering van gegevens opgeslagen in de quarantaine. De `quarantine_key` moeten op dezelfde manier als uw wachtwoorden worden behandeld: De langer de beter, en bewaken het goed. Voor het beste gevolg, gebruik in combinatie met `delete_on_sight`.

"quarantine_max_filesize"
- De maximaal toegestane bestandsgrootte van bestanden te worden in quarantaine plaatsen. Bestanden groter dan de opgegeven waarde zal NIET in quarantaine plaatsen. Dit richtlijn is belangrijk als een middel van maak het moeilijker voor potentiële aanvallers te overspoelen uw quarantaine met ongewenste gegevens potentieel veroorzaakt weggelopen gebruiksgegevens op uw hosting service. Waarde is in KB. Standaard =2048 =2048KB =2MB.

"quarantine_max_usage"
- De maximale geheugengebruik toegestaan voor de quarantaine. Als de totale geheugengebruik van de quarantaine bereikt dit waarde, de oudste bestanden in quarantaine zullen worden verwijderd totdat het totale geheugengebruik niet meer bereikt dit waarde. Dit richtlijn is belangrijk als een middel van maak het moeilijker voor potentiële aanvallers te overspoelen uw quarantaine met ongewenste gegevens potentieel veroorzaakt weggelopen gebruiksgegevens op uw hosting service. Waarde is in KB. Standaard =65536 =65536KB =64MB.

"honeypot_mode"
- Wanneer honeypot-modus is ingeschakeld, phpMussel zal proberen om ieder bestandsupload dat het tegenkomt in quarantaine plaatsen, ongeacht of niet het bestand wordt geüpload is gecontroleerd tegen een meegeleverde handtekeningen, en geen daadwerkelijke scannen of analyse van deze gevlagd geprobeerd bestandsuploads zal daadwerkelijk optreedt. Dit functionaliteit moet nuttig zijn voor degenen dat willen gebruik phpMussel voor de toepassing van virus/malware onderzoek, maar het is niet aanbevolen om dit functionaliteit te inschakelen wanneer het beoogde gebruik van phpMussel door de gebruiker is voor werkelijke bestandsupload scannen, noch aanbevolen te gebruik de honeypot functionaliteit voor andere doeleinden andere dan honeypotting. Als standaard, dit optie is uitgeschakeld. False = Uitgeschakeld [Standaard]; True = Ingeschakeld.

"scan_cache_expiry"
- Hoe lang moet phpMussel cache de resultaten van de scan? Waarde is het aantal seconden dat de resultaten van het scannen moet wordt gecached voor. Standaard is 21600 seconden (6 uur); Een waarde van 0 zal uitschakelen caching de resultaten van de scan.

"disable_cli"
- Uitschakelen CLI-modus? CLI-modus is standaard ingeschakeld, maar kunt somtijds interfereren met bepaalde testtools (zoals PHPUnit bijvoorbeeld) en andere CLI-gebaseerde applicaties. Als u niet hoeft te uitschakelen CLI-modus, u moeten om dit richtlijn te negeren. False = Inschakelen CLI-modus [Standaard]; True = Uitschakelen CLI-modus.

####"signatures" (Categorie)
Configuratie voor handtekeningen.
- %%%_clamav = ClamAV handtekeningen (beide hoofdnet en dagelijks).
- %%%_custom = Uw aangepaste handtekeningen (als u heeft geschreven elke).
- %%%_mussel = phpMussel handtekeningen opgenomen in uw huidige handtekeningen reeks die niet afkomstig van ClamAV.

Controleer tegen MD5 handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Controleer tegen algemeen handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "general_clamav"
- "general_custom"
- "general_mussel"

Controleer tegen genormaliseerde ASCII handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Controleer tegen genormaliseerde HTML handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "html_clamav"
- "html_custom"
- "html_mussel"

Controleer PE (Portable Executable) bestanden (EXE, DLL, ezv) tegen PE Sectionele handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Controleer PE (Portable Executable) bestanden (EXE, DLL, ezv) tegen PE uitgebreide handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "pex_custom"
- "pex_mussel"

Controleer PE (Portable Executable) bestanden (EXE, DLL, ezv) tegen PE handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Controleer ELF bestanden tegen ELF handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Controleer Mach-O bestanden (OSX, ezv) tegen Mach-O handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Controleer grafische bestanden tegen grafische-gebaseerde handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Controleer archief inhoud tegen archief metadata handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Controleer OLE-objecten tegen OLE handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Controleer bestandsnamen tegen bestandsnaam gebaseerd handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Toestaan scannen met phpMussel_mail()? False = Nee; True = Ja [Standaard].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Inschakelen bestand-specifieke whitelist? False = Nee; True = Ja [Standaard].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Controleer XML/XDP gegevens tegen XML/XDP handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Controleer tegen complexe uitgebreide handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Controleer tegen PDF handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Controleer tegen Shockwave handtekeningen wanneer scannen? False = Nee; True = Ja [Standaard].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Handtekening controleren lengte beperken opties. Alleen veranderen deze als u weet wat je doet. SD = Standaard handtekeningen. RX = PCRE (Perl Compatibele Reguliere Expressies, of "Regex") handtekeningen. FN = Bestandsnaam handtekeningen. Als u noteren dat PHP mislukt wanneer phpMussel probeert te scannen, probeer verlagen deze "max" waarden. Als mogelijk en gemakkelijk, laat me weten wanneer dit gebeurt en de resultaten van wat u probeert.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Mocht phpMussel rapport wanneer handtekeningen bestanden zijn ontbrekend of beschadigd? Als fail_silently is uitgeschakeld, ontbrekende en beschadigde bestanden zal worden gerapporteerd op het scannen, en als fail_silently is ingeschakeld, ontbrekende en beschadigde bestanden zal zijn genegeerd, met het scannen rapporten voor het bestanden die er geen problemen. Dit moet in het algemeen met rust gelaten worden tenzij u ervaart mislukt of soortgelijke problemen. False = Uitgeschakeld; True = Ingeschakeld [Standaard].

"fail_extensions_silently"
- Mocht phpMussel rapport wanneer extensies zijn ontbreken? Als fail_extensions_silently is uitgeschakeld, ontbrekende extensies zal worden gerapporteerd op het scannen, en als fail_extensions_silently is ingeschakeld, ontbrekende extensies zal zijn genegeerd, met het scannen rapporten voor het bestanden die er geen problemen. Het uitschakelen van dit richtlijn kunt mogelijk verhogen van uw veiligheid, maar kunt ook leiden tot een toename van valse positieven. False = Uitgeschakeld; True = Ingeschakeld [Standaard].

"detect_adware"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van adware? False = Nee; True = Ja [Standaard].

"detect_joke_hoax"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van grap/beetnemerij malware/virussen? False = Nee; True = Ja [Standaard].

"detect_pua_pup"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van PUAs/PUPs? False = Nee; True = Ja [Standaard].

"detect_packer_packed"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van verpakkers en verpakt gegevens? False = Nee; True = Ja [Standaard].

"detect_shell"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van shell scripts? False = Nee; True = Ja [Standaard].

"detect_deface"
- Mocht phpMussel verwerken handtekeningen voor het detecteren van schendingen/defacements en schenders/defacers? False = Nee; True = Ja [Standaard].

####"files" (Categorie)
Bestand hanteren configuratie.

"max_uploads"
- Maximaal toegestane aantal bestanden te scannen tijdens bestandsupload scan voordat aborteren de scan en informeren de gebruiker ze zijn uploaden van te veel in een keer! Biedt bescherming tegen een theoretische aanval waardoor een aanvaller probeert te DDoS uw systeem of CMS door overbelasting phpMussel te vertragen het PHP proces tot stilstand. Aanbevolen: 10. U zou kunnen wil te verhogen of verlagen dit nummer afhankelijk van de snelheid van uw hardware. Noteren dat dit aantal niet verklaren voor of opnemen de inhoud van de archieven.

"filesize_limit"
- Bestandsgrootte limiet in KB. 65536 = 64MB [Standaard]; 0 = Geen limiet (altijd op de greylist), ieder (positief) numerieke waarde aanvaard. Dit kunt handig zijn als uw PHP configuratie beperkt de hoeveelheid van geheugen een proces kunt houden of als u PHP configuratie beperkt het bestandsgrootte van uploads.

"filesize_response"
- Wat te doen met bestanden dat overschrijden het bestandsgrootte limiet (als aanwezig). False = Whitelist; True = Blacklist [Standaard].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Als uw systeem vergunningen alleen specifieke bestandstypen te uploaden, of als uw systeem expliciet ontkent bepaalde bestandstypen, specificeren deze bestandstypen in whitelists, blacklists en greylists kunt toenemen de snelheid waarin scannen is uitgevoerd via vergunningen het script te negeren bepaalde bestandstypen. Formaat is CSV (komma's gescheiden waarden). Als u wilt te scannen alles, eerder dan whitelist, blacklist of greylist, laat de variabele(/n) leeg; doen zo zal uitschakelen whitelist/blacklist/greylist.
- Logische volgorde van de verwerking is:
  - Als het bestandstype is op de whitelist, niet scannen en niet blokkeren het bestand, en niet controleer het bestand tegen de blacklist of de greylist.
  - Als het bestandstype is op de blacklist, niet scannen het bestand maar blokkeren het niettemin, en niet controleer het bestand tegen de greylist.
  - Als de greylist is leeg of als de greylist is niet leeg en het bestandstype is op de greylist, scannen het bestand als per normaal en bepalen als om het gebaseerd op de resultaten van de scan te blokkeren, maar als de greylist is niet leeg en het bestandstype is niet op de greylist, behandel het bestand alsof op de blacklist, dus om het niet te scannen, maar toch blokkeren het niettemin.

"check_archives"
- Om de inhoud van archieven proberen te controleer? False = Nee (niet doen controleer); True = Ja (doen controleer) [Standaard].
- Momenteel, alleen het controleren van BZ, GZ, LZF en ZIP bestanden is ondersteund (controleer van RAR, CAB, 7z en en zo voort momenteel niet ondersteund).
- Dit is niet onfeilbaar! Hoewel ik beveel het houden van dit ingeschakeld, ik kan niet garanderen dat het zal altijd vind alles.
- Ook noteren dat archief controleren momenteel is niet recursief voor ZIP.

"filesize_archives"
- Erven het bestandsgrootte blacklist/whitelist staat om de inhoud van archieven? False = Nee (gewoon greylist alles); True = Ja [Standaard].

"filetype_archives"
- Erven het bestandstype blacklist/whitelist staat om de inhoud van archieven? False = Nee (gewoon greylist alles); True = Ja [Standaard].

"max_recursion"
- Maximale recursiediepte limiet voor archieven. Standaard = 10.

"block_encrypted_archives"
- Detecteren en blokkeren gecodeerde archieven? Omdat phpMussel is niet in staat te scannen de inhoud van gecodeerde archieven, het is mogelijk dat archief encryptie kan worden toegepast door een aanvaller als middel van probeert te omzeilen phpMussel, anti-virus scanners en andere dergelijke beveiligingen. Instrueren phpMussel te blokkeren elke archieven dat het ontdekt worden gecodeerde zou kunnen helpen het risico in verband met deze dergelijke mogelijkheden te verminderen. False = Nee; True = Ja [Standaard].

####"attack_specific" (Categorie)
Aanval-specifieke richtlijnen.

Chameleon aanval detectie: False = Uitgeschakeld; True = Ingeschakeld.

"chameleon_from_php"
- Zoeken naar PHP header in bestanden die niet zijn PHP-bestanden noch herkende archieven.

"chameleon_from_exe"
- Zoeken naar PHP header in bestanden die niet zijn executables noch herkende archieven en naar executables waarvan de headers zijn onjuist.

"chameleon_to_archive"
- Zoeken naar archieven waarvan headers zijn onjuist (Ondersteunde: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Zoeken naar office documenten waarvan headers zijn onjuist (Ondersteunde: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Zoeken naar beelden waarvan headers zijn onjuist (Ondersteunde: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Zoeken naar PDF-bestanden waarvan headers zijn onjuist.

"archive_file_extensions" en "archive_file_extensions_wc"
- Herkende archief bestandsextensies (formaat is CSV; moet alleen toevoegen of verwijderen wanneer problemen voorkomen; onnodig verwijderen kan leiden tot vals-positieven te verschijnen voor archiefbestanden, terwijl onnodig toevoeging zal effectief whitelist wat u toevoegt van aanval-specifieke detectie; wijzigen met voorzichtigheid; ook noteren dat Dit heeft geen effect op welke archieven kan en niet kan wordt geanalyseerd op inhoudsniveau). De lijst, als is bij standaard, geeft die formaten gebruikt meest vaak door de meeste systemen en CMS, maar opzettelijk is niet noodzakelijk alomvattend.

"general_commands"
- Zoeken de inhoud van bestanden voor algemene commando's zoals `eval()`, `exec()` en `include`? False = Nee (niet doen controleer) [Standaard]; True = Ja (doen controleer). Uitschakelen dit optie als u plannen te uploaden om één van de volgende om uw systeem of CMS via uw browser: PHP, JavaScript, HTML, python, perl bestanden en zo voort. Inschakelen dit optie als u heeft geen extra bescherming op uw systeem en niet plannen te uploaden dergelijke bestanden. Als u gebruik extra beveiliging in combinatie met phpMussel zoals ZB Block, er is geen noodzaak om dit optie te inschakelen, omdat de meeste van wat phpMussel zal zoek naar (in het kader van dit optie) zijn duplicaties van beveiligingen die zijn voorzien alreeds.

"block_control_characters"
- Blokkeren alle bestanden bevatten controle karakters (andere dan nieuwe regels)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Als u _**ALLEEN**_  uploaden platte tekst, dan u kan inschakelen dit optie te bieden extra bescherming aan uw systeem. Hoewel, als u uploaden iets anders dan platte tekst, inschakelen dit kan leiden tot valse positieven. False = Niet blokkeren [Standaard]; True = Doen blokkeren.

"corrupted_exe"
- Corrupte bestanden en verwerking fouten. False = Negeren; True = Blokkeren [Standaard]. Detecteren en blokkeren mogelijk beschadigd PE (Portable Executable) bestanden? Vaak (maar niet altijd), wanneer bepaalde aspecten van een PE-bestand zijn beschadigd of kan niet correct worden verwerkt, het kan wijzen op een virale infectie. De processen gebruikt door de meeste anti-virus programma's om virussen in PE-bestanden te detecteren vereisen de verwerking van die bestanden op bepaalde manieren, dat, als de programmeur van een virus kent, specifiek zal proberen te verhinderen, zodat haar virus onopgemerkt blijven.

"decode_threshold"
- Optionele limiet of drempelwaarde de lengte van onverwerkte gegevens waarbinnen decoderen commando's moeten worden gedetecteerd (in het geval er enige merkbare prestatieproblemen terwijl scannen). Waarde is een integer vertegenwoordigen bestandsgrootte in KB. Standaard = 512 (512KB). Zero of nulwaarde zal uitschakelen het drempelwaarde (het verwijderen van een dergelijke limiet gebaseerd op bestandsgrootte).

"scannable_threshold"
- Optionele limiet of drempelwaarde de lengte van onverwerkte gegevens dat phpMussel is toegestaan te lezen en scan (in het geval er enige merkbare prestatieproblemen terwijl scannen). Waarde is een integer vertegenwoordigen bestandsgrootte in KB. Standaard = 32768 (32MB). Zero of nulwaarde zal uitschakelen het drempelwaarde. Algemeen, dit waarde moeten niet zijn lagere dan de gemiddelde bestandsgrootte van het bestandsuploads dat u wilt en verwacht te ontvangen aan uw server of website, moeten niet zijn meer dan de filesize_limit richtlijn, en moeten niet zijn meet dan ongeveer een vijfde van de totale toegestane geheugentoewijzing toegekend aan PHP via de php.ini configuratiebestand. Dit richtlijn bestaat te proberen om phpMussel te verhinderen van het gebruik van teveel geheugen (dat zou verhinderen het van de mogelijkheid te scannen bestanden met succes boven een bepaalde bestandsgrootte).

####"compatibility" (Categorie)
Compatibiliteit richtlijnen voor phpMussel.

"ignore_upload_errors"
- Dit richtlijn moet in het algemeen worden uitgeschakeld tenzij het is vereist voor de juiste functionaliteit van phpMussel op uw specifieke systeem. Normaal, wanneer uitgeschakeld, wanneer phpMussel detecteert de aanwezigheid van elementen van de `$_FILES` array(), het zal proberen initiëren een scan van het bestanden deze elementen vertegenwoordigen, en, als deze elementen zijn leeg, phpMussel zal terugkeren een foutmelding. Dit is het juiste gedrag voor phpMussel. Dat gezegd hebbende, voor sommige CMS, lege elementen in `$_FILES` kan optreden als gevolg van het natuurlijke gedrag van deze CMS, of fouten zouden zijn gerapporteerd wanneer er geen, in welk geval, het normale gedrag voor phpMussel zullen bemoeien met het normale gedrag van deze CMS. Als dergelijke een situatie optreedt voor u, inschakelen dit optie zal instrueren phpMussel niet te proberen te initiëren scannen voor dergelijke lege elementen, negeer hem wanneer gevonden en niet terugkeren gerelateerde foutmeldingen, dus toelaten de voortzetting van de pagina-aanvraag. False = UITGESCHAKELD; True = INGESCHAKELD.

"only_allow_images"
- Als u alleen verwachten of alleen bedoelen toestaan beelden worden geüpload om uw systeem of CMS, en als u absoluut nodig geen bestanden behalve afbeeldingen te wordt geüpload om uw systeem of CMS, dit richtlijn moet worden ingeschakeld, maar moet anderszins worden uitgeschakeld. Als dit richtlijn is ingeschakeld, het zal instrueren phpMussel zonder onderscheid te blokkeren elke upload geïdentificeerd als niet-beeldbestanden, zonder te scannen. Dit kan verminderen verwerkingstijd en geheugengebruik voor het geprobeerd uploaden van niet-beeldbestanden. False = UITGESCHAKELD; True = INGESCHAKELD.

####"heuristic" (Categorie)
Heuristische richtlijnen.

"threshold"
- Er zijn bepaalde handtekeningen van phpMussel dat zijn bedoeld om verdachte en potentieel kwaadaardige kwaliteiten te identificeren van bestanden wordt geüpload zonder zichzelf om bestanden wordt geüpload te identificeren specifiek als kwaadaardige. Dit "threshold" waarde vertelt phpMussel het maximaal totaalgewicht van verdachte en potentieel kwaadaardige kwaliteiten van bestanden wordt geüpload dat is toelaatbaar voordat deze bestanden worden gemarkeerd als kwaadaardig. De definitie van gewicht in dit verband is het aantal van verdachte en potentieel kwaadaardige kwaliteiten dat zijn geïdentificeerd. Standaard, dit waarde wordt ingesteld op 3. Algemeen, een lagere waarde zal resulteren in meer valse positieven maar meer kwaadaardige bestanden wordt gemarkeerd, terwijl een hogere waarde zal resulteren in minder valse positieven maar minder kwaadaardige bestanden wordt gemarkeerd. Algemeen, het is beste om dit waarde te laten op zijn standaard, tenzij u problemen ondervindt met betrekking tot het.

####"virustotal" (Categorie)
VirusTotal.com richtlijnen.

"vt_public_api_key"
- Optioneel, met phpMussel, het is mogelijk om bestanden te scannen met behulp van de Virus Total API als een manier om een sterk verbeterde mate van bescherming te bieden tegen virussen, trojans, malware en andere bedreigingen. Standaard, scannen van bestanden met behulp van de Virus Total API is uitgeschakeld. Om het te inschakelen, een Virus Total API-sleutel is nodig. Vanwege de aanzienlijke voordeel dat dit zou kunnen om u te voorzien, het is iets dat ik sterk aanbevelen te inschakelen. Wees u ervan bewust, echter, dat voor gebruik op de Virus Total API, u _**MOET**_ akkoord gaan hun Algemene Voorwaarden en u _**MOET**_ voldoen aan alle richtlijnen per beschreven door de Virus Total documentatie! U bent NIET toegestaan om dit integratie functie te gebruiken TENZIJ:
  - U heeft gelezen en u akkoord met de Algemene Voorwaarden van de Virus Total en zijn API. De Algemene Voorwaarden van de Virus Total en zijn API kan [Hier](https://www.virustotal.com/en/about/terms-of-service/) worden gevonden.
  - U heeft gelezen en u begrijpt, ten minste, de preambule van de Virus Total Public API-documentatie (alles na "VirusTotal Public API v2.0" maar vóór "Contents"). De Virus Total Public API-documentatie kan [Hier](https://www.virustotal.com/en/documentation/public-api/) worden gevonden.

Noteren: Als het scannen van bestanden met behulp van de Virus Total API is uitgeschakeld, u hoeft niet herziening van de richtlijnen in dit categorie (`virustotal`), omdat geen van hen iets te doen als dit is uitgeschakeld. Om een Virus Total API-sleutel te verwerven, van ergens op hun website, klik op de "Registreren" link gelegen in de richting van de rechterbovenhoek van de pagina, invoeren in de gevraagde informatie, en klik "Registreren" wanneer u klaar. Volg alle instructies geleverd, en wanneer u uw publieke API-sleutel heeft, kopieren/plakken dat publieke API om de `vt_public_api_key` richtlijn van de `phpmussel.ini` configuratiebestand.

"vt_suspicion_level"
- Normaal, phpMussel zal beperken welke bestanden scant met behulp van de Virus Total API om het bestanden die zijn beschouwd "achterdochtig". Optioneel, u kan dit beperking aan te passen door de waarde van het `vt_suspicion_level` richtlijn.
- `0`: Bestanden worden beschouwd achterdochtig alleen als, na te zijn gescand door phpMussel met eigen handtekeningen, zij geacht worden een heuristische gewicht te dragen. Dit zou effectief betekenen dat het gebruik van de Virus Total API zou zijn voor een tweede mening wanneer phpMussel vermoedt dat een bestand potentieel kwaadaardig kan zijn, maar kan niet helemaal uitsluiten dat het kan ook potentieel goedaardig zijn (niet-kwaadaardig) en daarom anders zou normaal niet blokkeren of vlag als kwaadaardig.
- `1`: Bestanden worden beschouwd achterdochtig alleen als, na te zijn gescand door phpMussel met eigen handtekeningen, zij geacht worden een heuristische gewicht te dragen, als ze bekend is executable te zijn (PE bestanden, Mach-O bestanden, ELF/Linux bestanden, etc), of als ze bekend zijn van een formaat dat potentieel executable gegevens kan bevatten (zoals executable macros, DOC/DOCX bestanden, archiefbestanden zoals RARs, ZIPS en etc). Dit is de standaard en aanbevolen achterdocht niveau toe te passen, effectief betekent dat het gebruik van de Virus Total API zou zijn voor een tweede mening wanneer in eerste instantie niets kwaadaardige of slecht wordt gevonden door phpMussel met een bestand beschouwd achterdochtig te zijn en daarom anders zou normaal niet blokkeren of vlag als kwaadaardig.
- `2`: Alle bestanden beschouwd achterdochtig worden en moeten worden gescand met behulp van de Virus Total API. Ik meestal niet raden het toepassen van dit achterdocht niveau, vanwege het risico bereiken API-quotum veel sneller dan anders het geval zou zijn, maar er zijn bepaalde omstandigheden (zoals wanneer de webmaster of hostmaster heeft weinig geloof of vertrouwen in de geringste in een van de geüploade inhoud van hun gebruikers) waarin dit achterdocht niveau kon passend zijn. Met dit achterdocht niveau, Alle bestanden normaal niet geblokkeerd of gemarkeerd als kwaadaardig zou worden gescand met behulp van de Virus Total API. Noteren, echter, dat phpMussel zal ophouden met behulp van de Virus Total API wanneer uw API-quotum is bereikt (ongeacht van achterdocht niveau), en dat uw API-quotum zal waarschijnlijk veel sneller bereikt met het gebruik van dit achterdocht niveau.

Noteren: Ongeacht van achterdocht niveau, elke bestanden die ofwel worden de zwarte lijst of witte lijst door phpMussel zal niet worden gescand met behulp van de Virus Total API, omdat die dergelijke bestanden reeds zou hebben verklaard als ofwel kwaadaardig of goedaardig door phpMussel tegen de tijd dat ze anders zouden hebben gescand door de Virus Total API, en daarom, extra scannen zou niet nodig. Het vermogen van phpMussel om bestanden te scannen met de Virus Total API is bedoeld om het vertrouwen bouwen verder voor of een bestand is kwaadaardig of goedaardig in die omstandigheden waarin phpMussel zelf is niet helemaal zeker de vraag van of een bestand is kwaadaardig of goedaardig.

"vt_weighting"
- Mocht phpMussel de resultaten van het scannen met behulp van de Virus Total API toe te passen als detecties of detectie weging? Dit richtlijn bestaat, omdat, hoewel het scannen van een bestand met behulp van meerdere motoren (als Virus Total doet) moet leiden tot een verhoogde aantal van detecties (en dus in een hoger aantal van kwaadaardige bestanden worden gedetecteerd), het kan ook resulteren in een hoger aantal van valse positieven, en daarom, in sommige gevallen, de resultaten van de scan kan beter worden benut als betrouwbaarheidsscore eerder dan als een definitieve conclusie. Als een waarde van 0 wordt gebruikt, de resultaten van het scannen met behulp van de Virus Total API zal worden toegepast als detecties, en zo, als een motor gebruikt door Virus Total vlaggen het bestand wordt gescand als kwaadaardige, phpMussel zal het bestand overwegen kwaadaardig te zijn. Als een andere waarde wordt gebruikt, de resultaten van het scannen met behulp van de Virus Total API zal worden toegepast als detectie weging, en zo, het aantal van motoren gebruikt door Virus Total dat vlag het bestand wordt gescand als kwaadaardige zal dienen als een betrouwbaarheidsscore (of detectie weging) voor of het bestand dat wordt gescand moet worden beschouwd als kwaadaardige door phpMussel (de waarde die wordt gebruikt zal vertegenwoordigen de minimale betrouwbaarheidsscore of weging vereist om kwaadaardige te worden beschouwd). Een waarde van 0 wordt standaard gebruikt.

"vt_quota_rate" en "vt_quota_time"
- Volgens de Virus Total API-documentatie, het is beperkt tot maximaal 4 verzoeken van welke aard in elk 1 minuut tijdsbestek. Als u een honeyclient, honeypot of andere automatisering te voorzien, dat gaat om middelen te verschaffen om VirusTotal en niet alleen rapporten opvragen heeft u recht op een hogere API-quotum. Normaal, phpMussel zal strikt houden aan deze beperkingen, maar vanwege de mogelijkheid van deze API-quotum verhoogd te worden, deze twee richtlijnen worden verstrekt als middel voor u om instrueren phpMussel wat limiet moeten houden worden. Tenzij u heeft geïnstrueerd om dit te doen, het is niet aan te raden voor u om deze waarden te verhogen, maar, als u heeft ondervonden problemen met betrekking tot uw tarief quota bereiken, afnemende deze waarden kunnen u soms helpen in het omgaan met deze problemen. Uw maximaal tarief bepaald als `vt_quota_rate` verzoeken van welke aard in elk `vt_quota_time` minuut tijdsbestek.

####"urlscanner" (Categorie)
URL scanner configuratie.

"urlscanner"
- Ingebouwd in phpMussel is een URL scanner, het opsporen van kwaadaardige URL's vanuit alle gegevens of bestanden gescand. Om de URL scanner te inschakelen, zetten de richtlijn `urlscanner` op true; Om het te uitschakelen, zetten dit richtlijn op false.

Noteren: Als de URL scanner wordt uitgeschakeld, zult u geen behoefte aan een van de richtlijnen in dit categorie te herzien (`urlscanner`), omdat geen van hen zal alles doen als dit is uitgeschakeld.

URL scanner API configuratie.

"lookup_hphosts"
- Inschakelt gebruik van de [hpHosts](http://hosts-file.net/) API wanneer zet op true. hpHosts nodig geen API sleutel voor het uitvoeren API verzoeken.

"google_api_key"
- Inschakelt gebruik van de Google Safe Browsing API wanneer de noodzakelijke API sleutel wordt gedefinieerd. Google Safe Browsing API nodig hebben een API sleutel, dat kan worden verkregen van [Hier](https://console.developers.google.com/).
- Noteren: Dit is een toekomstige functie! Google Safe Browsing API functionaliteit nog niet geschreven!

"maximum_api_lookups"
- Maximaal toelaatbaar aantal van de API verzoeken te voeren per individuele scan iteratie. Omdat elke extra API verzoek zullen toevoegen aan de totale tijd die nodig te voltooien elke scan iteratie, u kunt wensen om een beperking te specificeren teneinde versnellen het algehele scanproces. Wanneer ingesteld op 0, geen dergelijk maximaal toelaatbaar aantal wordt toegepast. Ingesteld op 10 standaard.

"maximum_api_lookups_response"
- Wat te doen als het maximaal toelaatbaar aantal van API verzoeken wordt overschreden? False = Niets doen (voortzetten de verwerking) [Standaard]; True = Merken/blokkeren het bestand.

"cache_time"
- Hoe lang (in seconden) moeten de resultaten van de API verzoeken worden gecached voor? Standaard is 3600 seconden (1 uur).

####"template_data" (Categorie)
Richtlijnen/Variabelen voor sjablonen en thema's.

Sjabloongegevens betreft op de HTML-uitvoer die wordt gegenereerd en gebruikt voor de "Upload Geweigerd" bericht getoond om de gebruikers wanneer een bestand upload is geblokkeerd. Als u gebruik aangepaste thema's voor phpMussel, HTML-uitvoer is afkomstig van de `template_custom.html` bestand, en alternatief, HTML-uitvoer is afkomstig van de `template.html` bestand. Variabelen geschreven om dit sectie van het configuratiebestand worden geïnterpreteerd aan de HTML-uitvoer door middel van het vervangen van variabelennamen omringd door accolades gevonden binnen de HTML-uitvoer met de bijbehorende variabele gegevens. Bijvoorbeeld, waar `foo="bar"`, elk geval van `<p>{foo}</p>` gevonden binnen de HTML-uitvoer `<p>bar</p>` zal worden.

"css_url"
- De sjabloonbestand voor aangepaste thema's maakt gebruik van externe CSS-eigenschappen, terwijl de sjabloonbestand voor het standaardthema maakt gebruik van interne CSS-eigenschappen. Om phpMussel instrueren om de sjabloonbestand voor aangepaste thema's te gebruiken, geef het openbare HTTP-adres van uw aangepaste thema's CSS-bestanden via de `css_url` variabele. Als u dit variabele leeg laat, phpMussel zal de sjabloonbestand voor de standaardthema te gebruiken.

---


###7. <a name="SECTION7"></a>HANDTEKENINGFORMAAT

####*BESTANDSNAAM HANDTEKENINGEN*
Alle bestandsnaam handtekeningen volgt het formaat:

`NAME:FNRX`

Waar NAME is de naam te noemen voor die handtekening en FNRX is de reguliere expressie patroon om bestandsnamen (ongecodeerde) te controleer tegen.

####*MD5 HANDTEKENINGEN*
Alle MD5 handtekeningen volgt het formaat:

`HASH:FILESIZE:NAME`

Waar HASH is de MD5 hash van een hele bestand, FILESIZE is de totale grootte van het bestand en NAME is de naam te noemen voor die handtekening.

####*ARCHIEF METADATA HANDTEKENINGEN*
Alle archief metadata handtekeningen volgt het formaat:

`NAME:FILESIZE:CRC32`

Waar NAME is de naam te noemen voor die handtekening, FILESIZE is de totale grootte (ongecomprimeerde) van een bestand vervat in het archief en CRC32 is de CRC32 checksum van die vervat bestand.

####*PE SECTIONELE HANDTEKENINGEN*
Alle PE sectionele handtekeningen volgt het formaat:

`SIZE:HASH:NAME`

Waar HASH is de MD5 hash van een sectie van een PE bestand, SIZE is de totale grootte van die sectie en NAME is de naam te noemen voor die handtekening.

####*PE UITGEBREIDE HANDTEKENINGEN*
Alle PE uitgebreide handtekeningen volgt het formaat:

`$VAR:HASH:SIZE:NAME`

Waar $VAR is de naam van de PE-variabele te controleer tegen, HASH is de MD5 hash van die variabele, SIZE is de totale grootte van die variabele en NAME is de naam te noemen voor die handtekening.

####*WHITELIST HANDTEKENINGEN*
Alle whitelist handtekeningen volgt het formaat:

`HASH:FILESIZE:TYPE`

Waar HASH is de MD5 hash van een hele bestand, FILESIZE is de totale grootte van het bestand en TYPE is het handtekeningen type het bestand van de whitelist is immuun tegen te zijn.

####*COMPLEXE UITGEBREIDE HANDTEKENINGEN*
Complexe uitgebreid handtekeningen zijn nogal verschillend van de andere handtekening typen mogelijk met phpMussel, doordat wat ze gecontroleerd tegen wordt bepaald door de handtekeningen zelf en ze kunnen controleer tegen meervoudig criteria. De controle criteria zijn begrensd door ";" en de controle type en de controle gegevens van elke controle criteria wordt begrensd door ":" zoals zo dat formaat voor deze handtekeningen heeft de neiging om een beetje uitzien als:

`$variable1:GEGEVENS;$variable2:GEGEVENS;Handtekeningnaam`

####*AL HET ANDERE*
Alle andere handtekeningen volgt het formaat:

`NAME:HEX:FROM:TO`

Waar NAME is de naam te noemen voor die handtekening en HEX is een hexadecimale gecodeerd segment van het bestand bestemd om te worden gecontroleerd door de gegeven handtekening. FROM en TO optioneel parameters zijn, aangeeft van waaruit en waaraan in de brongegevens om te controleren tegen (niet ondersteund door de mail functie).

####*REGEX*
Elke vorm van reguliere expressie begrepen en correct verwerkt door moet ook correct worden begrepen en verwerkt door phpMussel en handtekeningen. Echter, Ik stel voor het nemen van extreem voorzichtigheid bij het schrijven van nieuwe handtekeningen op basis van reguliere expressie, omdat, als u niet helemaal zeker wat u doet, kan er zeer onregelmatig en/of onverwachte resultaten worden. Neem een kijkje op de phpMussel broncode als u niet helemaal zeker over de context waarin regex verklaringen geïnterpreteerd worden. Ook, vergeet niet dat alle patronen (met uitzondering van bestandsnaam, archief metadata en MD5 patronen) moet hexadecimaal gecodeerd worden (voorgaande patroon syntaxis, natuurlijk)!

####*WAAR OM AANGEPASTE HANDTEKENINGEN TE ZETTEN?*
Alleen zet aangepaste handtekeningen in die bestanden bedoeld voor aangepaste handtekeningen. Die bestanden moeten "_custom" bevatten in hun bestandsnamen. U moet ook vermijden het bewerken van de standaard handtekeningen bestanden, tenzij u precies weet wat u doet, omdat, afgezien van goede praktijken in het algemeen en afgezien van het helpen u te onderscheiden tussen uw eigen handtekeningen en de standaard handtekeningen dat meegeleverd met phpMussel, het is goed om het bewerken te houden alleen het bestanden bestemd voor bewerking, omdat knoeien met de standaard handtekeningen bestanden kunt veroorzaken hen te stoppen met werken, vanwege de "map" bestanden: De maps/kaarten bestanden vertellen phpMussel waar in de handtekeningen bestanden te zoek voor handtekeningen vereist door phpMussel vanaf wanneer vereist, en deze kaarten ongesynchroniseerd kunt worden met hun bijbehorende handtekeningen bestanden indien deze handtekeningen bestanden hebben geknoeid. U kunt zetten ongeveer wat u ook wilt in uw aangepaste handtekeningen, zolang u de juiste syntaxis volgen. Echter, wees voorzichtig om nieuwe handtekeningen te testen voor vals-positieven vooraf als u van plan om ze te delen of gebruiken in een live-omgeving.

####*HANDTEKENINGEN OVERZICHT*
Het volgende is een overzicht van de soorten handtekeningen gebruikt door phpMussel:
- "Genormaliseerde ASCII Handtekeningen" (ascii_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen.
- "Complexe Uitgebreide Handtekeningen" (coex_*). Gemengde soort van handtekeningen controleren.
- "ELF Handtekeningen" (elf_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd aan de ELF-formaat.
- "Portable Executable Handtekeningen" (exe_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd aan de PE-formaat.
- "Bestandsnaam Handtekeningen" (filenames_*). Gecontroleerd tegen het bestandsnamen van het bestanden gerichte voor het scannen.
- "Algemene Handtekeningen" (general_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen.
- "Grafische Handtekeningen" (graphics_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd naar een bekende grafisch formaat.
- "Algemene Commando's" (hex_general_commands.csv). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen.
- "Genormaliseerde HTML Handtekeningen" (html_*). Gecontroleerd tegen de inhoud van elke niet-whitelist HTML-bestand gericht voor het scannen.
- "Mach-O Handtekeningen" (macho_*). Gecontroleerd tegen de inhoud van elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd aan de Mach-O-formaat.
- "Email Handtekeningen" (mail_*). Gecontroleerd tegen de $body variabele parsed aan de phpMussel_mail() functie, die bedoeld is om het lichaam van e-mailberichten of soortgelijke entiteiten (potentieel forum posten en etcetera).
- "MD5 Handtekeningen" (md5_*). Gecontroleerd tegen de MD5 hash van de inhoud en het bestandsgrootte van elke niet-whitelist bestand gericht voor het scannen.
- "Archief Metadata Handtekeningen" (metadata_*). Gecontroleerd tegen de CRC32 hash van de inhoud en het bestandsgrootte van de eerste bestand bevatte binnenkant van ieder niet-whitelist archief gericht voor het scannen.
- "OLE Handtekeningen" (ole_*). Gecontroleerd tegen de inhoud van elke niet-whitelist OLE-object gericht voor het scannen.
- "PDF Handtekeningen" (pdf_*). Gecontroleerd tegen de inhoud van elke niet-whitelist PDF-bestand gericht voor het scannen.
- "Portable Executable Sectionele Handtekeningen" (pe_*). Gecontroleerd tegen de MD5 hash en de grootte van elke PE-sectie van elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd aan de PE-formaat.
- "Portable Executable Uitgebreide Handtekeningen" (pex_*). Gecontroleerd tegen de MD5 hash en de grootte van variabelen in elke niet-whitelist bestand gericht voor het scannen en geïdentificeerd aan de PE-formaat.
- "Shockwave Handtekeningen" (swf_*). Gecontroleerd tegen de inhoud van elke niet-whitelist Shockwave-bestand gericht voor het scannen.
- "Whitelist Handtekeningen" (whitelist_*). Gecontroleerd tegen de MD5 hash van de inhoud en het bestandsgrootte van elke bestand gericht voor het scannen. Gecontroleerd bestanden zal zijn immuun van gecontroleerd te worden door de soort van handtekening in hun whitelist binnenkomst.
- "XML/XDP Handtekeningen" (xmlxdp_*). Gecontroleerd tegen elke XML/XDP data binnen elke niet-whitelist bestanden gericht voor het scannen.
(Bewust zijn van dat elk van deze handtekeningen gemakkelijk kunnen worden uitgeschakeld via `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>BEKENDE COMPATIBILITEITSPROBLEMEN

####PHP en PCRE
- PHP en PCRE is vereist voor phpMussel te kunnen functioneren juist. Zonder PHP, of zonder de PCRE extensie van PHP, phpMussel zullen niet worden uitgevoerd of functioneren juist. U moet er zeker van uw systeem heeft zowel PHP en PCRE geïnstalleerd en beschikbaar voordat downloaden en installeren phpMussel.

####ANTI-VIRUS SOFTWARECOMPATIBILITEIT

Voor het grootste deel, phpMussel is algemeen compatibel met de meeste andere anti-virus software. Echter, conflictions geweest beschreven door een aantal gebruikers in het verleden. Deze informatie hieronder is afkomstig van VirusTotal.com, het beschrijven van een aantal fout-positieven gemeld door anti-virus programma's tegen phpMussel. Hoewel deze informatie is geen absolute garantie van wel of niet u zult compatibiliteitsproblemen ondervindt tussen phpMussel en uw anti-virus software, als uw anti-virus software wordt gemarkeerd tegen phpMussel, moet u ofwel overwegen uit te schakelen voorafgaand aan het werken met phpMussel of moeten overwegen alternatieve opties om ofwel uw anti-virus software of phpMussel.

Dit informatie werd laatst bijgewerkt 25 Februari 2016 en is op de hoogte voor alle phpMussel publicaties van de twee meest recente mineur versies (v0.9.0-v0.10.0) op het moment van schrijven dit.

| Scanner              |  Resultaten                          |
|----------------------|--------------------------------------|
| Ad-Aware             |  Geen bekend problemen               |
| AegisLab             |  Geen bekend problemen               |
| Agnitum              |  Geen bekend problemen               |
| AhnLab-V3            |  Geen bekend problemen               |
| Alibaba              |  Geen bekend problemen               |
| ALYac                |  Geen bekend problemen               |
| AntiVir              |  Geen bekend problemen               |
| Antiy-AVL            |  Geen bekend problemen               |
| Arcabit              |  Geen bekend problemen               |
| Avast                |  Berichten "JS:ScriptSH-inf [Trj]"   |
| AVG                  |  Geen bekend problemen               |
| Avira                |  Geen bekend problemen               |
| AVware               |  Geen bekend problemen               |
| Baidu-International  |  Geen bekend problemen               |
| BitDefender          |  Geen bekend problemen               |
| Bkav                 |  Berichten "VEXC640.Webshell" en "VEXD737.Webshell"|
| ByteHero             |  Geen bekend problemen               |
| CAT-QuickHeal        |  Geen bekend problemen               |
| ClamAV               |  Geen bekend problemen               |
| CMC                  |  Geen bekend problemen               |
| Commtouch            |  Geen bekend problemen               |
| Comodo               |  Geen bekend problemen               |
| Cyren                |  Geen bekend problemen               |
| DrWeb                |  Geen bekend problemen               |
| Emsisoft             |  Geen bekend problemen               |
| ESET-NOD32           |  Geen bekend problemen               |
| F-Prot               |  Geen bekend problemen               |
| F-Secure             |  Geen bekend problemen               |
| Fortinet             |  Geen bekend problemen               |
| GData                |  Geen bekend problemen               |
| Ikarus               |  Geen bekend problemen               |
| Jiangmin             |  Geen bekend problemen               |
| K7AntiVirus          |  Geen bekend problemen               |
| K7GW                 |  Geen bekend problemen               |
| Kaspersky            |  Geen bekend problemen               |
| Kingsoft             |  Geen bekend problemen               |
| Malwarebytes         |  Geen bekend problemen               |
| McAfee               |  Berichten "New Script.c"            |
| McAfee-GW-Edition    |  Berichten "New Script.c"            |
| Microsoft            |  Geen bekend problemen               |
| MicroWorld-eScan     |  Geen bekend problemen               |
| NANO-Antivirus       |  Geen bekend problemen               |
| Norman               |  Geen bekend problemen               |
| nProtect             |  Geen bekend problemen               |
| Panda                |  Geen bekend problemen               |
| Qihoo-360            |  Geen bekend problemen               |
| Rising               |  Geen bekend problemen               |
| Sophos               |  Geen bekend problemen               |
| SUPERAntiSpyware     |  Geen bekend problemen               |
| Symantec             |  Geen bekend problemen               |
| Tencent              |  Geen bekend problemen               |
| TheHacker            |  Geen bekend problemen               |
| TotalDefense         |  Geen bekend problemen               |
| TrendMicro           |  Geen bekend problemen               |
| TrendMicro-HouseCall |  Geen bekend problemen               |
| VBA32                |  Geen bekend problemen               |
| VIPRE                |  Geen bekend problemen               |
| ViRobot              |  Geen bekend problemen               |
| Zillya               |  Geen bekend problemen               |
| Zoner                |  Geen bekend problemen               |

---


Laatste Bijgewerkt: 25 Februari 2016 (2016.02.25).
