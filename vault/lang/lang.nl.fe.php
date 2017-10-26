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
 * This file: Dutch language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Startpagina</a> | <a href="?phpmussel-page=logout">Uitloggen</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Uitloggen</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Herkende archief bestandsextensies (formaat is CSV; moet alleen toevoegen of verwijderen wanneer problemen voorkomen; onnodig verwijderen kan leiden tot vals-positieven te verschijnen voor archiefbestanden, terwijl onnodig toevoeging zal effectief whitelist wat u toevoegt van aanval-specifieke detectie; wijzigen met voorzichtigheid; ook noteren dat Dit heeft geen effect op welke archieven kan en niet kan wordt geanalyseerd op inhoudsniveau). De lijst, als is bij standaard, geeft die formaten gebruikt meest vaak door de meeste systemen en CMS, maar opzettelijk is niet noodzakelijk alomvattend.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Blokkeren alle bestanden bevatten controle karakters (andere dan nieuwe regels)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Als u <em><strong>ALLEEN</strong></em>  uploaden platte tekst, dan u kan inschakelen dit optie te bieden extra bescherming aan uw systeem. Hoewel, als u uploaden iets anders dan platte tekst, inschakelen dit kan leiden tot valse positieven. False = Niet blokkeren [Standaard]; True = Doen blokkeren.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Zoeken naar PHP header in bestanden die niet zijn executables noch herkende archieven en naar executables waarvan de headers zijn onjuist. False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Zoeken naar PHP header in bestanden die niet zijn PHP-bestanden noch herkende archieven. False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Zoeken naar archieven waarvan headers zijn onjuist (Ondersteunde: BZ, GZ, RAR, ZIP, RAR, GZ). False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Zoeken naar office documenten waarvan headers zijn onjuist (Ondersteunde: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Zoeken naar beelden waarvan headers zijn onjuist (Ondersteunde: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Zoeken naar PDF-bestanden waarvan headers zijn onjuist. False = Uitgeschakeld; True = Ingeschakeld.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Corrupte bestanden en verwerking fouten. False = Negeren; True = Blokkeren [Standaard]. Detecteren en blokkeren mogelijk beschadigd PE (Portable Executable) bestanden? Vaak (maar niet altijd), wanneer bepaalde aspecten van een PE-bestand zijn beschadigd of kan niet correct worden verwerkt, het kan wijzen op een virale infectie. De processen gebruikt door de meeste anti-virus programma\'s om virussen in PE-bestanden te detecteren vereisen de verwerking van die bestanden op bepaalde manieren, dat, als de programmeur van een virus kent, specifiek zal proberen te verhinderen, zodat haar virus onopgemerkt blijven.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Drempelwaarde de lengte van onverwerkte gegevens waarbinnen decoderen commando\'s moeten gedetecteerd worden (in het geval er enige merkbare prestatieproblemen terwijl scannen). Standaard = 512KB. Zero of nulwaarde zal uitschakelen het drempelwaarde (het verwijderen van een dergelijke limiet gebaseerd op bestandsgrootte).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Drempelwaarde de lengte van onverwerkte gegevens dat phpMussel is toegestaan te lezen en scan (in het geval er enige merkbare prestatieproblemen terwijl scannen). Standaard = 32MB. Zero of nulwaarde zal uitschakelen het drempelwaarde. Algemeen, dit waarde moeten niet zijn lagere dan de gemiddelde bestandsgrootte van het bestandsuploads dat u wilt en verwacht te ontvangen aan uw server of website, moeten niet zijn meer dan de filesize_limit richtlijn, en moeten niet zijn meet dan ongeveer een vijfde van de totale toegestane geheugentoewijzing toegekend aan PHP via de "php.ini" configuratiebestand. Dit richtlijn bestaat te proberen om phpMussel te verhinderen van het gebruik van teveel geheugen (dat zou verhinderen het van de mogelijkheid te scannen bestanden met succes boven een bepaalde bestandsgrootte).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Dit richtlijn moet in het algemeen worden uitgeschakeld tenzij het is vereist voor de juiste functionaliteit van phpMussel op uw specifieke systeem. Normaal, wanneer uitgeschakeld, wanneer phpMussel detecteert de aanwezigheid van elementen van de <code>$_FILES</code> array(), het zal proberen initiëren een scan van het bestanden deze elementen vertegenwoordigen, en, als deze elementen zijn leeg, phpMussel zal terugkeren een foutmelding. Dit is het juiste gedrag voor phpMussel. Dat gezegd hebbende, voor sommige CMS, lege elementen in <code>$_FILES</code> kan optreden als gevolg van het natuurlijke gedrag van deze CMS, of fouten zouden zijn gerapporteerd wanneer er geen, in welk geval, het normale gedrag voor phpMussel zullen bemoeien met het normale gedrag van deze CMS. Als dergelijke een situatie optreedt voor u, inschakelen dit optie zal instrueren phpMussel niet te proberen te initiëren scannen voor dergelijke lege elementen, negeer hem wanneer gevonden en niet terugkeren gerelateerde foutmeldingen, dus toelaten de voortzetting van de pagina-aanvraag. False = UITGESCHAKELD; True = INGESCHAKELD.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Als u alleen verwachten of alleen bedoelen toestaan beelden worden geüpload om uw systeem of CMS, en als u absoluut nodig geen bestanden behalve afbeeldingen te wordt geüpload om uw systeem of CMS, dit richtlijn moet worden ingeschakeld, maar moet anderszins worden uitgeschakeld. Als dit richtlijn is ingeschakeld, het zal instrueren phpMussel zonder onderscheid te blokkeren elke upload geïdentificeerd als niet-beeldbestanden, zonder te scannen. Dit kan verminderen verwerkingstijd en geheugengebruik voor het geprobeerd uploaden van niet-beeldbestanden. False = UITGESCHAKELD; True = INGESCHAKELD.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Detecteren en blokkeren gecodeerde archieven? Omdat phpMussel is niet in staat te scannen de inhoud van gecodeerde archieven, het is mogelijk dat archief encryptie kan worden toegepast door een aanvaller als middel van probeert te omzeilen phpMussel, anti-virus scanners en andere dergelijke beveiligingen. Instrueren phpMussel te blokkeren elke archieven dat het ontdekt worden gecodeerde zou kunnen helpen het risico in verband met deze dergelijke mogelijkheden te verminderen. False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_files_check_archives'] = 'Om de inhoud van archieven proberen te controleer? False = Nee (niet doen controleer); True = Ja (doen controleer) [Standaard]. Momenteel, het enige archief en compressie-formaten ondersteund zijn BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR en ZIP (archief en compressie-formaten RAR, CAB, 7z en etcetera momenteel niet ondersteund). Dit is niet onfeilbaar! Hoewel ik beveel het houden van dit ingeschakeld, ik kan niet garanderen dat het zal altijd vind alles. Ook noteren dat archief controleren momenteel is niet recursief voor PHAR of ZIP formaten.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Erven het bestandsgrootte blacklist/whitelist staat om de inhoud van archieven? False = Nee (gewoon greylist alles); True = Ja [Standaard].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Bestandsgrootte limiet in KB. 65536 = 64MB [Standaard]; 0 = Geen limiet (altijd op de greylist), ieder (positief) numerieke waarde aanvaard. Dit kunt handig zijn als uw PHP configuratie beperkt de hoeveelheid van geheugen een proces kunt houden of als u PHP configuratie beperkt het bestandsgrootte van uploads.';
$phpMussel['lang']['config_files_filesize_response'] = 'Wat te doen met bestanden dat overschrijden het bestandsgrootte limiet (als aanwezig). False = Whitelist; True = Blacklist [Standaard].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Erven het bestandstype blacklist/whitelist staat om de inhoud van archieven? False = Nee (gewoon greylist alles); True = Ja [Standaard].';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Als uw systeem vergunningen alleen specifieke bestandstypen te uploaden, of als uw systeem expliciet ontkent bepaalde bestandstypen, specificeren deze bestandstypen in whitelists, blacklists en greylists kunt toenemen de snelheid waarin scannen is uitgevoerd via vergunningen het script te negeren bepaalde bestandstypen. Formaat is CSV (komma\'s gescheiden waarden). Als u wilt te scannen alles, eerder dan whitelist, blacklist of greylist, laat de variabele(/n) leeg; doen zo zal uitschakelen whitelist/blacklist/greylist. Logische volgorde van de verwerking is: Als het bestandstype is op de whitelist, niet scannen en niet blokkeren het bestand, en niet controleer het bestand tegen de blacklist of de greylist. Als het bestandstype is op de blacklist, niet scannen het bestand maar blokkeren het niettemin, en niet controleer het bestand tegen de greylist. Als de greylist is leeg of als de greylist is niet leeg en het bestandstype is op de greylist, scannen het bestand als per normaal en bepalen als om het gebaseerd op de resultaten van de scan te blokkeren, maar als de greylist is niet leeg en het bestandstype is niet op de greylist, behandel het bestand alsof op de blacklist, dus om het niet te scannen, maar toch blokkeren het niettemin. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Maximale recursiediepte limiet voor archieven. Standaard = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximaal toegestane aantal bestanden te scannen tijdens bestandsupload scan voordat aborteren de scan en informeren de gebruiker ze zijn uploaden van te veel in een keer! Biedt bescherming tegen een theoretische aanval waardoor een aanvaller probeert te DDoS uw systeem of CMS door overbelasting phpMussel te vertragen het PHP proces tot stilstand. Aanbevolen: 10. U zou kunnen wil te verhogen of verlagen dit nummer afhankelijk van de snelheid van uw hardware. Noteren dat dit aantal niet verklaren voor of opnemen de inhoud van de archieven.';
$phpMussel['lang']['config_general_cleanup'] = 'Vrijmaken script variabelen en de cache na de uitvoering? False = Nee; True = Ja [Standaard]. Als u niet gebruik het script na de eerste scan van upload, moet zetten op <code>true</code> (ja), om minimaliseren de geheugengebruik. Als u gebruik het script voor de doeleinden na de eerste scan van upload, moet zetten op <code>false</code> (nee), om te voorkomen dat onnodig herladen dubbele gegevens in het geheugen. In de huisartspraktijk, moet waarschijnlijk worden zetten op <code>true</code> (ja), maar, als u dit doet, het zal niet mogelijk zijn om het script te gebruiken voor iets anders dan het scannen van bestand uploaden. Heeft geen invloed in CLI-modus.';
$phpMussel['lang']['config_general_default_algo'] = 'Definieert welk algoritme u wilt gebruiken voor alle toekomstige wachtwoorden en sessies. Opties: PASSWORD_DEFAULT (standaard), PASSWORD_BCRYPT, PASSWORD_ARGON2I (vereist PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Het inschakelen van dit richtlijn zal instrueren het script om elke gescande geprobeerd bestand upload dat gecontroleerd tegen elke detectie criteria te proberen onmiddellijk verwijderen, via signatures of anderszins. Bestanden vastbesloten te zijn schoon zal niet worden aangeraakt. In het geval van archieven, het hele archief wordt verwijderd, ongeacht of niet het overtredende bestand is slechts één van meerdere bestanden vervat in het archief. Voor het geval van bestand upload scannen, doorgaans, het is niet nodig om dit richtlijn te inschakelen, omdat doorgaans, PHP zal automatisch zuiveren de inhoud van zijn cache wanneer de uitvoering is voltooid, wat betekent dat het doorgans zal verwijdert ieder bestanden geüpload doorheen aan de server tenzij ze zijn verhuisd, gekopieerd of verwijderd alreeds. Dit richtlijn is toegevoegd hier als een extra maatregel van veiligheid voor degenen wier kopies van PHP misschien niet altijd gedragen op de manier verwacht. False = Na het scannen, met rust laten het bestand [Standaard]; True = Na het scannen, als niet schoon, onmiddellijk verwijderen.';
$phpMussel['lang']['config_general_disable_cli'] = 'Uitschakelen CLI-modus? CLI-modus is standaard ingeschakeld, maar kunt somtijds interfereren met bepaalde testtools (zoals PHPUnit bijvoorbeeld) en andere CLI-gebaseerde applicaties. Als u niet hoeft te uitschakelen CLI-modus, u moeten om dit richtlijn te negeren. False = Inschakelen CLI-modus [Standaard]; True = Uitschakelen CLI-modus.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Uitschakelen frontend toegang? frontend toegang kan phpMussel beter beheersbaar te maken, maar kan ook een potentieel gevaar voor de veiligheid zijn. Het is aan te raden om phpMussel te beheren via het backend wanneer mogelijk, maar frontend toegang is hier voorzien voor wanneer het niet mogelijk is. Hebben het uitgeschakeld tenzij u het nodig hebt. False = Inschakelen frontend toegang; True = Uitschakelen frontend toegang [Standaard].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Uitschakelen webfonts? True = Ja; False = Nee [Standaard].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Activeer ondersteuning voor phpMussel plugins? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Moet phpMussel reageren met 403 headers met het bestanden upload geblokkeerd bericht, of blijven met de gebruikelijke 200 OK? False = Nee (200); True = Ja (403) [Standaard].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Bestand om de frontend login pogingen te loggen. Geef een bestandsnaam, of laat leeg om uit te schakelen.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Wanneer honeypot-modus is ingeschakeld, phpMussel zal proberen om ieder bestandsupload dat het tegenkomt in quarantaine plaatsen, ongeacht of niet het bestand wordt geüpload is gecontroleerd tegen een meegeleverde signatures, en geen daadwerkelijke scannen of analyse van deze gevlagd geprobeerd bestandsuploads zal daadwerkelijk optreedt. Dit functionaliteit moet nuttig zijn voor degenen dat willen gebruik phpMussel voor de toepassing van virus/malware onderzoek, maar het is niet aanbevolen om dit functionaliteit te inschakelen wanneer het beoogde gebruik van phpMussel door de gebruiker is voor werkelijke bestandsupload scannen, noch aanbevolen te gebruik de honeypot functionaliteit voor andere doeleinden andere dan honeypotting. Als standaard, dit optie is uitgeschakeld. False = Uitgeschakeld [Standaard]; True = Ingeschakeld.';
$phpMussel['lang']['config_general_ipaddr'] = 'Waar het IP-adres van het aansluiten verzoek te vinden? (Handig voor diensten zoals Cloudflare en dergelijke) Standaard = REMOTE_ADDR. WAARSCHUWING: Verander dit niet tenzij u weet wat u doet!';
$phpMussel['lang']['config_general_lang'] = 'Geef de standaardtaal voor phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Inschakelen de onderhoudsmodus? True = Ja; False = Nee [Standaard]. Schakelt alles anders dan het frontend uit. Soms nuttig bij het bijwerken van uw CMS, frameworks, enz.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Maximum aantal inlogpogingen (frontend). Standaard = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Hoe verkiest u nummers die worden weergegeven? Selecteer het voorbeeld dat het meest correct voor u lijkt.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel is in staat om gevlagd geprobeerd bestandsuploads te quarantaine in isolatie binnen de phpMussel vault, als dit is iets wat u wilt doen. Regelmatige gebruikers van phpMussel dat gewoon willen om hun websites of hosting-omgeving te beschermen zonder enige interesse in diep analyseren van gevlagd geprobeerd bestandsuploads moet dit functionaliteit hebben uitgeschakeld, maar elke gebruikers geïnteresseerd in de verdere analyse van gevlagd geprobeerd bestandsuploads voor malware onderzoek of voor soortgelijke zaken moeten inschakelen dit functionaliteit. Quarantaine van gevlagd geprobeerd bestandsuploads kunt ook somtijds helpen bij het opsporen van vals-positieven, als dit is iets dat vaak voorkomt voor u. Voor de uitschakelen van quarantaine functionaliteit, gewoon laat de <code>quarantine_key</code> richtlijn leeg, of wissen de inhoud van de richtlijn als het niet leeg alreeds. Voor de inschakelen van quarantaine functionaliteit, invoeren soms waarde in de richtlijn. De <code>quarantine_key</code> is een belangrijke beveiliging kenmerk van de quarantaine functionaliteit vereist als middel om de functionaliteit quarantaine te verhinderen exploitatie door potentiële aanvallers en als middel om verhinderen van elke mogelijke gegevens uitvoering van gegevens opgeslagen in de quarantaine. De <code>quarantine_key</code> moeten op dezelfde manier als uw wachtwoorden worden behandeld: De langer de beter, en bewaken het goed. Voor het beste gevolg, gebruik in combinatie met <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'De maximaal toegestane bestandsgrootte van bestanden te worden in quarantaine plaatsen. Bestanden groter dan de opgegeven waarde zal NIET in quarantaine plaatsen. Dit richtlijn is belangrijk als een middel van maak het moeilijker voor potentiële aanvallers te overspoelen uw quarantaine met ongewenste gegevens potentieel veroorzaakt weggelopen gebruiksgegevens op uw hosting service. Standaard = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'De maximale geheugengebruik toegestaan voor de quarantaine. Als de totale geheugengebruik van de quarantaine bereikt dit waarde, de oudste bestanden in quarantaine zullen worden verwijderd totdat het totale geheugengebruik niet meer bereikt dit waarde. Dit richtlijn is belangrijk als een middel van maak het moeilijker voor potentiële aanvallers te overspoelen uw quarantaine met ongewenste gegevens potentieel veroorzaakt weggelopen gebruiksgegevens op uw hosting service. Standaard = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Hoe lang moeten phpMussel cache de resultaten van de scan? Waarde is het aantal seconden dat de resultaten van het scannen moet wordt gecached voor. Standaard is 21600 seconden (6 uur); Een waarde van 0 zal uitschakelen caching de resultaten van de scan.';
$phpMussel['lang']['config_general_scan_kills'] = 'Bestandsnaam van het bestand te opnemen alle geblokkeerde of gedood upload. Geef een bestandsnaam of laat leeg om te uitschakelen.';
$phpMussel['lang']['config_general_scan_log'] = 'Bestandsnaam van het bestand te opnemen alle scanresultaten. Geef een bestandsnaam of laat leeg om te uitschakelen.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Bestandsnaam van het bestand te opnemen alle scanresultaten (formaat is geserialiseerd). Geef een bestandsnaam of laat leeg om te uitschakelen.';
$phpMussel['lang']['config_general_statistics'] = 'Track phpMussel gebruiksstatistieken? True = Ja; False = Nee [Standaard].';
$phpMussel['lang']['config_general_timeFormat'] = 'De datum notatie gebruikt door phpMussel. Extra opties kunnen worden toegevoegd op aanvraag.';
$phpMussel['lang']['config_general_timeOffset'] = 'Tijdzone offset in minuten.';
$phpMussel['lang']['config_general_timezone'] = 'Uw tijdzone.';
$phpMussel['lang']['config_general_truncate'] = 'Trunceren logbestanden wanneer ze een bepaalde grootte bereiken? Waarde is de maximale grootte in B/KB/MB/GB/TB dat een logbestand kan groeien tot voordat het wordt getrunceerd. De standaardwaarde van 0KB schakelt truncatie uit (logbestanden kunnen onbepaald groeien). Notitie: Van toepassing op individuele logbestanden! De grootte van de logbestanden wordt niet collectief beschouwd.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Er zijn bepaalde signatures van phpMussel dat zijn bedoeld om verdachte en potentieel kwaadaardige kwaliteiten te identificeren van bestanden wordt geüpload zonder zichzelf om bestanden wordt geüpload te identificeren specifiek als kwaadaardige. Dit "threshold" waarde vertelt phpMussel het maximaal totaalgewicht van verdachte en potentieel kwaadaardige kwaliteiten van bestanden wordt geüpload dat is toelaatbaar voordat deze bestanden worden gemarkeerd als kwaadaardig. De definitie van gewicht in dit verband is het aantal van verdachte en potentieel kwaadaardige kwaliteiten dat zijn geïdentificeerd. Standaard, dit waarde wordt ingesteld op 3. Algemeen, een lagere waarde zal resulteren in meer valse positieven maar meer kwaadaardige bestanden wordt gemarkeerd, terwijl een hogere waarde zal resulteren in minder valse positieven maar minder kwaadaardige bestanden wordt gemarkeerd. Algemeen, het is beste om dit waarde te laten op zijn standaard, tenzij u problemen ondervindt met betrekking tot het.';
$phpMussel['lang']['config_signatures_Active'] = 'Een lijst van de actief signature-bestanden, gescheiden door komma\'s.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Moet phpMussel verwerken signatures voor het detecteren van adware? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Moet phpMussel verwerken signatures voor het detecteren van schendingen/defacements en schenders/defacers? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Moet phpMussel gecodeerde bestanden detecteren en blokkeren? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Moet phpMussel verwerken signatures voor het detecteren van grap/beetnemerij malware/virussen? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Moet phpMussel verwerken signatures voor het detecteren van verpakkers en verpakt gegevens? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Moet phpMussel verwerken signatures voor het detecteren van PUAs/PUPs? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Moet phpMussel verwerken signatures voor het detecteren van shell scripts? False = Nee; True = Ja [Standaard].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Moet phpMussel rapporteren wanneer extensies zijn ontbreken? Als <code>fail_extensions_silently</code> is uitgeschakeld, ontbrekende extensies zal worden gerapporteerd op het scannen, en als <code>fail_extensions_silently</code> is ingeschakeld, ontbrekende extensies zal zijn genegeerd, met het scannen rapporten voor het bestanden die er geen problemen. Het uitschakelen van dit richtlijn kunt mogelijk verhogen van uw veiligheid, maar kunt ook leiden tot een toename van valse positieven. False = Uitgeschakeld; True = Ingeschakeld [Standaard].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Moet phpMussel rapporteren wanneer signatures bestanden zijn ontbrekend of beschadigd? Als <code>fail_silently</code> is uitgeschakeld, ontbrekende en beschadigde bestanden zal worden gerapporteerd op het scannen, en als <code>fail_silently</code> is ingeschakeld, ontbrekende en beschadigde bestanden zal zijn genegeerd, met het scannen rapporten voor het bestanden die er geen problemen. Dit moet in het algemeen met rust gelaten worden tenzij u ervaart mislukt of soortgelijke problemen. False = Uitgeschakeld; True = Ingeschakeld [Standaard].';
$phpMussel['lang']['config_template_data_css_url'] = 'De sjabloonbestand voor aangepaste thema\'s maakt gebruik van externe CSS-eigenschappen, terwijl de sjabloonbestand voor het standaardthema maakt gebruik van interne CSS-eigenschappen. Om phpMussel instrueren om de sjabloonbestand voor aangepaste thema\'s te gebruiken, geef het openbare HTTP-adres van uw aangepaste thema\'s CSS-bestanden via de <code>css_url</code> variabele. Als u dit variabele leeg laat, phpMussel zal de sjabloonbestand voor de standaardthema te gebruiken.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Lettergrootte vergroting. Standaard = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Standaard thema om te gebruiken voor phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Hoe lang (in seconden) moeten de resultaten van de API verzoeken worden gecached voor? Standaard is 3600 seconden (1 uur).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Inschakelt gebruik van de Google Safe Browsing API wanneer de noodzakelijke API sleutel wordt gedefinieerd.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Inschakelt gebruik van de hpHosts API wanneer zet op true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Maximaal toelaatbaar aantal van de API verzoeken te voeren per individuele scan iteratie. Omdat elke extra API verzoek zullen toevoegen aan de totale tijd die nodig te voltooien elke scan iteratie, u kunt wensen om een beperking te specificeren teneinde versnellen het algehele scanproces. Wanneer ingesteld op 0, geen dergelijk maximaal toelaatbaar aantal wordt toegepast. Ingesteld op 10 standaard.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Wat te doen als het maximaal toelaatbaar aantal van API verzoeken wordt overschreden? False = Niets doen (voortzetten de verwerking) [Standaard]; True = Merken/blokkeren het bestand.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Optioneel, met phpMussel, het is mogelijk om bestanden te scannen met behulp van de Virus Total API als een manier om een sterk verbeterde mate van bescherming te bieden tegen virussen, trojans, malware en andere bedreigingen. Standaard, scannen van bestanden met behulp van de Virus Total API is uitgeschakeld. Om het te inschakelen, een Virus Total API-sleutel is nodig. Vanwege de aanzienlijke voordeel dat dit zou kunnen om u te voorzien, het is iets dat ik sterk aanbevelen te inschakelen. Wees u ervan bewust, echter, dat voor gebruik op de Virus Total API, u <em><strong>MOET</strong></em> akkoord gaan hun Algemene Voorwaarden en u <em><strong>MOET</strong></em> voldoen aan alle richtlijnen per beschreven door de Virus Total documentatie! U bent NIET toegestaan om dit integratie functie te gebruiken TENZIJ: U heeft gelezen en u akkoord met de Algemene Voorwaarden van de Virus Total en zijn API. U heeft gelezen en u begrijpt, ten minste, de preambule van de Virus Total Public API-documentatie (alles na "VirusTotal Public API v2.0" maar vóór "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Volgens de Virus Total API-documentatie, het is beperkt tot maximaal 4 verzoeken van welke aard in elk 1 minuut tijdsbestek. Als u een honeyclient, honeypot of andere automatisering te voorzien, dat gaat om middelen te verschaffen om VirusTotal en niet alleen rapporten opvragen heeft u recht op een hogere API-quotum. Normaal, phpMussel zal strikt houden aan deze beperkingen, maar vanwege de mogelijkheid van deze API-quotum verhoogd te worden, deze twee richtlijnen worden verstrekt als middel voor u om instrueren phpMussel wat limiet moeten houden worden. Tenzij u heeft geïnstrueerd om dit te doen, het is niet aan te raden voor u om deze waarden te verhogen, maar, als u heeft ondervonden problemen met betrekking tot uw tarief quota bereiken, afnemende deze waarden kunnen u soms helpen in het omgaan met deze problemen. Uw maximaal tarief bepaald als <code>vt_quota_rate</code> verzoeken van welke aard in elk <code>vt_quota_time</code> minuut tijdsbestek.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Zie bovenstaande beschrijving).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Normaal, phpMussel zal beperken welke bestanden scant met behulp van de Virus Total API om het bestanden die zijn beschouwd "achterdochtig". Optioneel, u kan dit beperking aan te passen door de waarde van het <code>vt_suspicion_level</code> richtlijn.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Moeten phpMussel de resultaten van het scannen met behulp van de Virus Total API toe te passen als detecties of detectie weging? Dit richtlijn bestaat, omdat, hoewel het scannen van een bestand met behulp van meerdere motoren (als Virus Total doet) moet leiden tot een verhoogde aantal van detecties (en dus in een hoger aantal van kwaadaardige bestanden worden gedetecteerd), het kan ook resulteren in een hoger aantal van valse positieven, en daarom, in sommige gevallen, de resultaten van de scan kan beter worden benut als betrouwbaarheidsscore eerder dan als een definitieve conclusie. Als een waarde van 0 wordt gebruikt, de resultaten van het scannen met behulp van de Virus Total API zal worden toegepast als detecties, en zo, als een motor gebruikt door Virus Total vlaggen het bestand wordt gescand als kwaadaardige, phpMussel zal het bestand overwegen kwaadaardig te zijn. Als een andere waarde wordt gebruikt, de resultaten van het scannen met behulp van de Virus Total API zal worden toegepast als detectie weging, en zo, het aantal van motoren gebruikt door Virus Total dat vlag het bestand wordt gescand als kwaadaardige zal dienen als een betrouwbaarheidsscore (of detectie weging) voor of het bestand dat wordt gescand moet worden beschouwd als kwaadaardige door phpMussel (de waarde die wordt gebruikt zal vertegenwoordigen de minimale betrouwbaarheidsscore of weging vereist om kwaadaardige te worden beschouwd). Een waarde van 0 wordt standaard gebruikt.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'De primaire pakket (zonder de handtekeningen, documentatie en configuratie).';
$phpMussel['lang']['field_activate'] = 'Activeren';
$phpMussel['lang']['field_clear_all'] = 'Annuleer alles';
$phpMussel['lang']['field_component'] = 'Component';
$phpMussel['lang']['field_create_new_account'] = 'Nieuw Account Creëren';
$phpMussel['lang']['field_deactivate'] = 'Deactiveren';
$phpMussel['lang']['field_delete_account'] = 'Account Verwijderen';
$phpMussel['lang']['field_delete_all'] = 'Verwijder alles';
$phpMussel['lang']['field_delete_file'] = 'Verwijder';
$phpMussel['lang']['field_download_file'] = 'Download';
$phpMussel['lang']['field_edit_file'] = 'Bewerk';
$phpMussel['lang']['field_false'] = 'False (Vals)';
$phpMussel['lang']['field_file'] = 'Bestand';
$phpMussel['lang']['field_filename'] = 'Bestandsnaam: ';
$phpMussel['lang']['field_filetype_directory'] = 'Bestandsmap';
$phpMussel['lang']['field_filetype_info'] = '{EXT}-Bestand';
$phpMussel['lang']['field_filetype_unknown'] = 'Onbekend';
$phpMussel['lang']['field_install'] = 'Installeren';
$phpMussel['lang']['field_latest_version'] = 'Laatste Versie';
$phpMussel['lang']['field_log_in'] = 'Inloggen';
$phpMussel['lang']['field_more_fields'] = 'Meer Velden';
$phpMussel['lang']['field_new_name'] = 'Nieuwe naam:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Opties';
$phpMussel['lang']['field_password'] = 'Wachtwoord';
$phpMussel['lang']['field_permissions'] = 'Machtigingen';
$phpMussel['lang']['field_quarantine_key'] = 'Quarantaine sleutel';
$phpMussel['lang']['field_rename_file'] = 'Naam veranderen';
$phpMussel['lang']['field_reset'] = 'Resetten';
$phpMussel['lang']['field_restore_file'] = 'Herstellen';
$phpMussel['lang']['field_set_new_password'] = 'Stel Nieuw Wachtwoord';
$phpMussel['lang']['field_size'] = 'Totale Grootte: ';
$phpMussel['lang']['field_size_bytes'] = ['byte', 'bytes'];
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Toestand';
$phpMussel['lang']['field_system_timezone'] = 'Gebruik de systeem standaard tijdzone.';
$phpMussel['lang']['field_true'] = 'True (Waar)';
$phpMussel['lang']['field_uninstall'] = 'Verwijderen';
$phpMussel['lang']['field_update'] = 'Bijwerken';
$phpMussel['lang']['field_update_all'] = 'Bijwerken alles';
$phpMussel['lang']['field_upload_file'] = 'Nieuw bestand uploaden';
$phpMussel['lang']['field_username'] = 'Gebruikersnaam';
$phpMussel['lang']['field_your_version'] = 'Uw Versie';
$phpMussel['lang']['header_login'] = 'Inloggen om verder te gaan.';
$phpMussel['lang']['label_active_config_file'] = 'Actief configuratiebestand: ';
$phpMussel['lang']['label_blocked'] = 'Uploads geblokkeerd';
$phpMussel['lang']['label_branch'] = 'Branch laatste stabiele:';
$phpMussel['lang']['label_events'] = 'Scan gebeurtenissen';
$phpMussel['lang']['label_flagged'] = 'Objecten gemarkeerd';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Cache data en tijdelijke bestanden';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel-schijfgebruik: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Vrije schijfruimte: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Totaal schijfgebruik: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Totale schijfruimte: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Component updates metadata';
$phpMussel['lang']['label_hide'] = 'Verbergen';
$phpMussel['lang']['label_os'] = 'Besturingssysteem gebruikt:';
$phpMussel['lang']['label_other'] = 'Anders';
$phpMussel['lang']['label_other-Active'] = 'Actieve signature bestanden';
$phpMussel['lang']['label_other-Since'] = 'Begin datum';
$phpMussel['lang']['label_php'] = 'PHP versie gebruikt:';
$phpMussel['lang']['label_phpmussel'] = 'phpMussel versie gebruikt:';
$phpMussel['lang']['label_quarantined'] = 'Uploads in quarantaine';
$phpMussel['lang']['label_sapi'] = 'SAPI gebruikt:';
$phpMussel['lang']['label_scanned_objects'] = 'Objecten gescand';
$phpMussel['lang']['label_scanned_uploads'] = 'Uploads gescand';
$phpMussel['lang']['label_show'] = 'Zien';
$phpMussel['lang']['label_size_in_quarantine'] = 'Grootte in quarantaine: ';
$phpMussel['lang']['label_stable'] = 'Laatste stabiele:';
$phpMussel['lang']['label_sysinfo'] = 'Systeem informatie:';
$phpMussel['lang']['label_tests'] = 'Testen:';
$phpMussel['lang']['label_unstable'] = 'Laatste onstabiele:';
$phpMussel['lang']['label_upload_date'] = 'Upload datum: ';
$phpMussel['lang']['label_upload_hash'] = 'Upload hash: ';
$phpMussel['lang']['label_upload_origin'] = 'Upload oorsprong: ';
$phpMussel['lang']['label_upload_size'] = 'Upload grootte: ';
$phpMussel['lang']['link_accounts'] = 'Accounts';
$phpMussel['lang']['link_config'] = 'Configuratie';
$phpMussel['lang']['link_documentation'] = 'Documentatie';
$phpMussel['lang']['link_file_manager'] = 'Bestandsbeheer';
$phpMussel['lang']['link_home'] = 'Startpagina';
$phpMussel['lang']['link_logs'] = 'Logbestanden';
$phpMussel['lang']['link_quarantine'] = 'Quarantaine';
$phpMussel['lang']['link_statistics'] = 'Statistieken';
$phpMussel['lang']['link_textmode'] = 'Tekstformaat: <a href="%1$sfalse">Eenvoudig</a> – <a href="%1$strue">Geformatteerde</a>';
$phpMussel['lang']['link_updates'] = 'Updates';
$phpMussel['lang']['link_upload_test'] = 'Upload Test';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Geselecteerde logbestand bestaat niet!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Geen logbestanden beschikbaar.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Geen logbestand geselecteerd.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Maximum aantal inlogpogingen overschreden; Toegang geweigerd.';
$phpMussel['lang']['previewer_days'] = 'Dagen';
$phpMussel['lang']['previewer_hours'] = 'Uur';
$phpMussel['lang']['previewer_minutes'] = 'Minuten';
$phpMussel['lang']['previewer_months'] = 'Maanden';
$phpMussel['lang']['previewer_seconds'] = 'Seconden';
$phpMussel['lang']['previewer_weeks'] = 'Weken';
$phpMussel['lang']['previewer_years'] = 'Jaren';
$phpMussel['lang']['response_accounts_already_exists'] = 'Een account bij die gebruikersnaam bestaat al!';
$phpMussel['lang']['response_accounts_created'] = 'Account succesvol aangemaakt!';
$phpMussel['lang']['response_accounts_deleted'] = 'Account succesvol verwijderd!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Die account bestaat niet.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Wachtwoord succesvol gewijzigd!';
$phpMussel['lang']['response_activated'] = 'Succesvol geactiveerd.';
$phpMussel['lang']['response_activation_failed'] = 'Mislukt om te activeren!';
$phpMussel['lang']['response_checksum_error'] = 'Checksum error! Bestand afgewezen!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Component succesvol geïnstalleerd.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Component succesvol verwijderd.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Component succesvol gewijzigd.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Er is een fout opgetreden tijdens een poging om de component te verwijderen.';
$phpMussel['lang']['response_configuration_updated'] = 'Configuratie succesvol gewijzigd.';
$phpMussel['lang']['response_deactivated'] = 'Succesvol gedeactiveerd.';
$phpMussel['lang']['response_deactivation_failed'] = 'Mislukt om te deactiveren!';
$phpMussel['lang']['response_delete_error'] = 'Mislukt om te verwijderen!';
$phpMussel['lang']['response_directory_deleted'] = 'Bestandsmap succesvol verwijderd!';
$phpMussel['lang']['response_directory_renamed'] = 'De naam van de bestandsmap met succes veranderd!';
$phpMussel['lang']['response_error'] = 'Fout';
$phpMussel['lang']['response_failed_to_install'] = 'Installatie mislukt!';
$phpMussel['lang']['response_failed_to_update'] = 'Update mislukt!';
$phpMussel['lang']['response_file_deleted'] = 'Bestand succesvol verwijderd!';
$phpMussel['lang']['response_file_edited'] = 'Bestand succesvol gewijzigd!';
$phpMussel['lang']['response_file_renamed'] = 'De naam van de bestand met succes veranderd!';
$phpMussel['lang']['response_file_restored'] = 'Bestand succesvol hersteld!';
$phpMussel['lang']['response_file_uploaded'] = 'Bestand succesvol uploadet!';
$phpMussel['lang']['response_login_invalid_password'] = 'Inloggen mislukt! Ongeldig wachtwoord!';
$phpMussel['lang']['response_login_invalid_username'] = 'Inloggen mislukt! Gebruikersnaam bestaat niet!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Password veld leeg!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Gebruikersnaam veld leeg!';
$phpMussel['lang']['response_rename_error'] = 'Mislukt om de naam te veranderen!';
$phpMussel['lang']['response_restore_error_1'] = 'Kan niet herstellen! Beschadigd bestand!';
$phpMussel['lang']['response_restore_error_2'] = 'Kan niet herstellen! Onjuiste quarantaine sleutel!';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistieken geannuleerd.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Al bijgewerkt.';
$phpMussel['lang']['response_updates_not_installed'] = 'Component niet geïnstalleerd!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Component niet geïnstalleerd (heeft nodig PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Verouderd!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Verouderd (neem handmatig bijwerken)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Verouderd (heeft nodig PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Onbepaald.';
$phpMussel['lang']['response_upload_error'] = 'Mislukt om te uploaden!';
$phpMussel['lang']['state_complete_access'] = 'Volledige toegang';
$phpMussel['lang']['state_component_is_active'] = 'Component is actief.';
$phpMussel['lang']['state_component_is_inactive'] = 'Component is inactief.';
$phpMussel['lang']['state_component_is_provisional'] = 'Component is voorlopig.';
$phpMussel['lang']['state_default_password'] = 'Waarschuwing: Gebruikt de standaard wachtwoord!';
$phpMussel['lang']['state_logged_in'] = 'Ingelogd.';
$phpMussel['lang']['state_logs_access_only'] = 'Logbestanden toegang alleen';
$phpMussel['lang']['state_maintenance_mode'] = 'Waarschuwing: De onderhoudsmodus is ingeschakeld!';
$phpMussel['lang']['state_password_not_valid'] = 'Waarschuwing: Dit account is niet gebruikt van een geldig wachtwoord!';
$phpMussel['lang']['state_quarantine'] = ['Er is momenteel %s bestand in quarantaine.', 'Er zijn momenteel %s bestanden in quarantaine.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'De al bijgewerkt niet verbergen';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'De al bijgewerkt verbergen';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'De ongebruikte niet verbergen';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'De ongebruikte verbergen';
$phpMussel['lang']['tip_accounts'] = 'Hallo, {username}.<br />De accounts pagina stelt u in staat om te bepalen wie toegang heeft tot de phpMussel frontend.';
$phpMussel['lang']['tip_config'] = 'Hallo, {username}.<br />De configuratie pagina stelt u in staat om de configuratie voor phpMussel te modificeren vanaf de frontend.';
$phpMussel['lang']['tip_donate'] = 'phpMussel wordt gratis aangeboden, maar als u wilt doneren aan het project, kan u dit doen door te klikken op de knop doneren.';
$phpMussel['lang']['tip_file_manager'] = 'Hallo, {username}.<br />De bestandsbeheer stelt u in staat om te verwijderen, bewerken, uploaden en downloaden van bestanden. Gebruik met voorzichtigheid (kon u uw installatie breken met deze).';
$phpMussel['lang']['tip_home'] = 'Hallo, {username}.<br />Dit is de startpagina van de phpMussel frontend. Selecteer een link in het navigatiemenu aan de linkerkant om door te gaan.';
$phpMussel['lang']['tip_login'] = 'Standaard gebruikersnaam: <span class="txtRd">admin</span> – Standaard wachtwoord: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Hallo, {username}.<br />Selecteer een logbestand uit de onderstaande lijst om de inhoud van de logbestand te bekijken.';
$phpMussel['lang']['tip_quarantine'] = 'Hallo, {username}.<br />Deze pagina bevat een lijst met alle bestanden die momenteel in quarantaine staan en het beheer van die bestanden vergemakkelijkt.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Notitie: Quarantaine is momenteel uitgeschakeld, maar kan via de configuratiepagina worden ingeschakeld.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Zie de <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.nl.md#SECTION7">documentatie</a> voor informatie over de verschillende configuratie richtlijnen en hun doeleinden.';
$phpMussel['lang']['tip_statistics'] = 'Hallo, {username}.<br />Deze pagina bevat een aantal basisgebruiksstatistieken voor uw phpMussel-installatie.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Notitie: Statistische tracking is momenteel uitgeschakeld, maar kan via de configuratiepagina worden ingeschakeld.';
$phpMussel['lang']['tip_updates'] = 'Hallo, {username}.<br />De updates pagina stelt u in staat om de verschillende phpMussel componenten te installeren, verwijderen, en actualiseren (de core pakket, signatures, plugins, L10N bestanden, ezv).';
$phpMussel['lang']['tip_upload_test'] = 'Hallo, {username}.<br />De upload test pagina bevat een standaard file upload formulier, voor het testen of een bestand normaliter geblokkeerd door phpMussel bij een poging om het te uploaden.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Accounts';
$phpMussel['lang']['title_config'] = 'phpMussel – Configuratie';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Bestandsbeheer';
$phpMussel['lang']['title_home'] = 'phpMussel – Startpagina';
$phpMussel['lang']['title_login'] = 'phpMussel – Inloggen';
$phpMussel['lang']['title_logs'] = 'phpMussel – Logbestanden';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Quarantaine';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistieken';
$phpMussel['lang']['title_updates'] = 'phpMussel – Updates';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Upload Test';
$phpMussel['lang']['warning'] = 'Waarschuwingen:';
$phpMussel['lang']['warning_php_1'] = 'Uw PHP versie wordt niet meer actief ondersteund! Het bijwerken is aanbevolen!';
$phpMussel['lang']['warning_php_2'] = 'Uw PHP versie is ernstig kwetsbaar! Het bijwerken is sterk aanbevolen!';
$phpMussel['lang']['warning_signatures_1'] = 'Geen signature bestanden zijn actief!';

$phpMussel['lang']['info_some_useful_links'] = 'Enkele nuttige links:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel Kwesties @ GitHub</a> – Kwesties pagina voor phpMussel (steun, hulp, ezv).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Discussieforum voor phpMussel (steun, hulp, ezv).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Een alternatieve download-spiegel voor phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Een verzameling van eenvoudige webmaster tools waarmee websites te beveiligen.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV startpagina (ClamAV® is een open source antivirus engine voor het opsporen van trojans, virussen, malware en andere bedreigingen).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Computerbeveiliging bedrijf dat aanvullende signatures biedt voor ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Phishing-database gebruikt door de phpMussel URL scanner.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP leermiddelen en discussie.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP leermiddelen en discussie.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal is een gratis service voor het analyseren van verdachte bestanden en URL\'s.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis is een gratis malware analyse dienst die door <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Computer anti-malware-specialisten.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Nuttig malware-gericht discussiefora.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Kwetsbaarheidstabellen</a> – Hiermee worden veilige/onveilige versies van verschillende pakketten weergegeven (PHP, HHVM, ezv).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Compatibiliteitstabellen</a> – Hiermee worden informatie over compatibiliteit voor verschillende pakketten weergegeven (CIDRAM, phpMussel, ezv).</li>
        </ul>';
