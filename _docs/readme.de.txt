      _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

                            { ~ ~ ~ DEUTSCH ~ ~ ~ }
 INHALT
 1. VORWORT
 2A. INSTALLATION (SERVER)
 2B. INSTALLATION (CLI - BEFEHLSZEILENMODUS)
 3A. BENUTZUNG (SERVER)
 3B. BENUTZUNG (CLI - BEFEHLSZEILENMODUS)
 4A. BROWSER BEFEHLE
 4B. CLI (BEFEHLSZEILENMODUS)
 5. IM PAKET ENTHALTENE DATEIEN
 6. EINSTELLUNGEN
 7. SIGNATURENFORMAT
 8. BEKANNTE KOMPATIBILITÄTSPROBLEME

                                     ~ ~ ~


 1. VORWORT

 Vielen Dank für die Benutzung von phpMussel, einem PHP-Script, um Trojaner,
 Viren, Malware und andere Bedrohungen in Dateien zu entdecken, die auf Ihr
 System hochgeladen werden könnten, welches die Signaturen von ClamAV und
 weitere nutzt.

 PHPMUSSEL COPYRIGHT 2013 und darüber hinaus GNU/GPLv2 by Caleb M (Maikuolan).

 Dieses Skript ist freie Software; Sie können Sie weitergeben und/oder
 modifizieren unter den Bedingungen der GNU General Public License, wie von der
 Free Software Foundation veröffentlicht; entweder unter Version 2 der Lizenz
 oder (nach Ihrer Wahl) jeder späteren Version. Dieses Skript wird in der
 Hoffnung verteilt, dass es nützlich sein wird, allerdings OHNE JEGLICHE
 GARANTIE; ohne implizite Garantien für VERMARKTUNG/VERKAUF/VERTRIEB oder FÜR
 EINEN BESTIMMTEN ZWECK. Lesen Sie die GNU General Public License für weitere
 Details, in der Datei "LICENSE" im Verzeichnis "_docs" im zugeordneten Paket
 und Repository für diese Datei, ebenfalls verfügbar auf:
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>.

 Besonderer Dank geht an ClamAV für die Inspiration und die Signaturen, die
 dieses Script benutzt, ohne die dieses Script wahrscheinlich nicht existieren
 würde oder bestenfalls einen sehr begrenzten Wert hätte
 <http://www.clamav.net/>.

 Besonderer Dank geht auch an Sourceforge und GitHub für das Hosten der
 Projektdateien, an Spambot Security für die phpMussel Diskussionforen gehostet
 auf <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, und an die
 weiteren Quellen einiger von phpMussel verwendeten Signaturen:
 SecuriteInfo.com <http://www.securiteinfo.com/>, PhishTank
 <http://www.phishtank.com/>, NLNetLabs <http://nlnetlabs.nl/> und andere, und
 Besonderer Dank geht an alle diejenigen die das Projekt unterstützen werden,
 an andere nicht erwähnte Personen, und an Sie, für die Verwendung des Scripts.

 Dieses Dokument und das zugehörige Paket kann von folgenden Links kostenlos
 heruntergeladen werden:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~


 2A. INSTALLATION (SERVER)

 Zufünftig wird dieser Prozess mit einem Installationsmanager vereinfacht, bis
 dahin folgen Sie den Anweisungen, um phpMussel auf den *meisten Systemen und
 CMS zu installieren:

 1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC. Erstellen
    Sie ein Verzeichnis, wohin Sie den Inhalt dieses Paketes auf Ihrem Host
    oder CMS installieren möchten. Ein Verzeichnis wie
    /public_html/phpmussel/ o.ä. genügt, solange es Ihren
    Sicherheitsbedürfnissen oder persönlichen Präferenzen entspricht.

 2) Optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender
    ohne entsprechende Kenntnisse), öffnen Sie die Datei "phpmussel.ini" im
    "vault"-Verzeichnis) - Diese Datei beinhaltet alle funktionalen Optionen
    für phpMussel. Über jeder Option beschreibt ein kurzer Kommentar die
    Aufgabe dieser Option. Verändern Sie die Werte nach Ihren Bedürfnissen.
    Speichern und schließen Sie die Datei.

 3) Laden Sie den kompletten Inhalt (phpMussel und die Dateien) in das
    Verzeichnis hoch, für das Sie sich in Schritt 1 entschieden haben. Die
    Dateien *.txt/*.md müssen nicht mit hochgeladen werden.

 4) Ändern Sie die Zugriffsberechtigungen des "vault"-Verzeichnisses auf "777".
    Die Berechtigungen des übergeordneten Verzeichnises, in welchem sich der
    Inhalt befindet (das Verzeichnis, wofür Sie sich entschieden haben), können
    so belassen werden, überprüfen Sie jedoch die Berechtigungen, wenn in der
    Vergangenheit Zugriffsprobleme aufgetreten sind (Voreinstellung "755"
    o.ä.).

 5) Binden Sie phpMussel in Ihr System oder CMS ein. Es gibt viele verschiedene
    Möglichkeiten, ein Script wie phpMussel einzubinden, am einfachsten ist es,
    das Script am Anfang einer Haupt-Datei (eine Datei, die immer geladen wird,
    wenn irgend eine beliebige Seite Ihres Webauftritts aufgerufen wird) Ihres
    Systems oder CMS mit Hilfe des require- oder include-Befehls einzubinden.
    Üblicherweise wird eine solche Datei in Verzeichnissen wie "/includes",
    "/assets" or "/functions" gespeichert und wird häufig "init.php",
    "common_functions.php", "functions.php" o.ä. genannt. Sie müssen
    herausfinden, welche Datei dies für Ihre Bedürfnisse ist; Wenn Sie dabei
    Schwierigkeiten haben das herauszufinden, besuchen Sie die phpMussel
    Support-Foren und lassen Sie es uns wissen; Es ist möglich, dass entweder
    ich oder ein anderer Benutzer mit dem CMS, das Sie verwenden, Erfahrung hat
    (Sie müssen Sie mitteilen, welche CMS Sie verwenden) und möglicherweise in
    der Lage ist, etwas Unterstützung anzubieten. Fügen Sie in dieser Datei
    folgenden Code direkt am Anfang ein:

    <?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>

    Ersetzen Sie den String zwischen den Anführungszeichen mit dem lokalen Pfad
    der Datei "phpmussel.php", nicht mit der HTTP-Adresse (ähnlich dem Pfad für
    das "vault"-Verzeichnis). Speichern und schließen Sie die Datei, laden Sie
    sie ggf. erneut hoch.

    -- ODER ALTERNATIV --

    Wenn Sie einen Apache-Webserver haben und wenn Sie Zugriff auf die
    "php.ini" oder eine ähnliche Datei haben, dann können Sie die
    "auto_prepend_file" Direktive verwenden um phpMussel voranstellen wenn eine
    PHP-Anfrage erfolgt. Ungefähr so:

    auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"

    Oder das in der ".htaccess" Datei:

    php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"

 6) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das
    Programm auf ordnungsgemäße Funktion testen. Sie sollten nun die im Paket
    enthaltenen Testdateien "_testfiles" auf Ihre Webseite über die
    gewöhnlichen browserbasierten Methoden hochladen. Funktioniert das Programm
    ordnungsgemäß, erscheint eine Meldung von phpMussel, dass der Upload
    erfolgreich blockiert wurde. Erscheint keine Meldung, funktioniert das
    Programm nicht korrekt. Nutzen Sie andere erweiterte Funktionen oder
    weitere mögliche Arten von Scannern dieses Programms, so sollten Sie diese
    ebenfalls testen, um die ordnungsgemäße Funktion sicherzustellen.

                                     ~ ~ ~


 2B. INSTALLATION (CLI - BEFEHLSZEILENMODUS)

 Zufünftig wird dieser Prozess mit einem Installationsmanager vereinfacht, bis
 dahin folgen Sie den Anweisungen, um phpMussel im CLI-Modus zu installieren
 (beachten Sie an dieser Stelle, CLI-Support ist nur auf Windows-Systemen
 möglich, Linux und andere Systeme werden in zukünftigen Versionen
 unterstützt):

 1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC in ein
    Verzeichnis, das Ihren Sicherheitsbedürfnissen oder persönlichen
    Präferenzen entspricht.

 2) phpMussel benötigt eine installierte PHP-Umgebung, um ausgeführt werden zu
    können. Sofern PHP bei Ihnen nicht installiert ist, installieren Sie es
    bitte nach den Anweisungen des PHP-Installers.

 3) Optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender
    ohne entsprechende Kenntnisse), öffnen Sie die Datei "phpmussel.ini" im
    "vault"-Verzeichnis) - Diese Datei beinhaltet alle funktionalen Optionen
    für phpMussel. Über jeder Option beschreibt ein kurzer Kommentar die
    Aufgabe dieser Option. Verändern Sie die Werte nach Ihren Bedürfnissen.
    Speichern und schließen Sie die Datei.

 4) Optional, Sie können den Start von phpMussel vereinfachen, indem Sie
    mittels einer Stapelverarbeitungsdatei PHP und phpMussel automatisch laden.
    Öffnen Sie einen einfachen Texteditor wie Editor oder Notepad++, tragen
    Sie den vollständigen Pfad zu Ihrer "php.exe" im Verzeichnis Ihrer
    PHP-Installation ein, gefolgt von einem Leerzeichen und dem vollständigen
    Pfad zur "phpmussel.php" im Verzeichnis Ihrer phpMussel-Installation,
    speichern diese Datei mit einer ".bat"-Dateierweiterung an einem Ort, wo
    Sie sie leicht finden können und führen Sie sie zukünfig nur noch mit einem
    Doppelklick aus.

 5) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das
    Programm auf ordnungsgemäße Funktion testen. Um den Test durchzuführen,
    führen Sie bitte phpMussel aus und versuchen Sie, das Verzeichnis
    "_testfiles" in diesem Installationspaket zu scannen.

                                     ~ ~ ~


 3A. BENUTZUNG (SERVER)

 phpMussel ist dafür vorgesehen, fast vollständig autonom zu funktionieren,
 ohne dass Sie etwas tun müssen: Sobald es installiert ist, führt es die
 Tätigkeiten allein aus.

 Das Scannen von Dateiuploads ist automatisiert und standardmäßig
 eingeschaltet, Sie müssen nichts weiter unternehmen.

 Sie sind jedoch auch in der Lage, phpMussel anzuweisen, spezifische Dateien,
 Ordner und/oder Archive zu scannen. Um dies auszuführen, stellen Sie sicher,
 dass diese Konfiguration in der "phpmussel.ini" festgelegt ist (cleanup muß
 deaktiviert sein). Erstellen Sie eine mit phpMussel eingebundene PHP-Datei mit
 folgender Funktion:

 phpMussel($what_to_scan,$output_type,$output_flatness);

 - $what_to_scan kann ein String, ein Array oder ein Array von Arrays sein und
   gibt an, welche Datei, Dateien, Ordner und/oder Ordner gescannt werden
   sollen.

 - $output_type ist ein boolescher Wert und gibt an, in welchem Format die
   Scan-Ergebnisse zurückgegeben werden sollen. False weist die Funktion an,
   Ergebnisse als Integer (Ganzzahl) zurückzugeben (ein Rückgabewert von -3
   zeigt an, dass es Probleme mit den phpMussel Signatur-Dateien oder Signatur-
   Map-Dateien gibt und dass sie wahrscheinlich fehlen oder beschädigt sind, -2
   zeigt an, dass beschädigte Dateien gefunden wurden und der Scan nicht
   abgeschlossen wurde, -1 zeigt an, dass fehlende Erweiterungen oder Addons
   von PHP benötigt werden, um den Scan durchzuführen und der Scan deshalb
   nicht abgeschlossen wurde, 0 zeigt an, dass das Ziel nicht existiert und
   somit nichts überprüft werden konnte, 1 zeigt an, dass das Ziel erfolgreich
   geprüft wurde und keine Probleme erkannt wurden, 2 zeigt an, dass das Ziel
   erfolgreich geprüft wurde, jedoch Probleme gefunden wurden). True weist die
   Funktion an, Ergebnisse als lesbaren Text zurückzugeben. Zusätzlich können
   in beiden Fällen auf die Ergebnisse über globale Variablen nach dem Scannen
   zugegriffen werden. Diese Variable ist optional und standardmäßig auf false.

 - $output_flatness ist ein boolescher Wert und gibt der Funktion an, ob die
   Ergebnisse vom Scannen (falls mehrere Scan-Ziele existieren) als Array oder
   String zurückgegeben werden sollen. False wird die Ergebnisse als Array
   zurückgeben. True wird die Ergebnisse als String zurückgeben. Diese Variable
   ist optional und standardmäßig auf false.

 Beispiel:

   $results=phpMussel('/user_name/public_html/my_file.html',true,true);
   echo $results;

   Gibt so etwas wie dies (als ein String):
    Wed, 16 Sep 2013 02:49:46 +0000 Gestartet.
    > Überprüfung '/user_name/public_html/my_file.html':
    -> Keine Probleme gefunden.
    Wed, 16 Sep 2013 02:49:47 +0000 Fertig.

 Eine vollständige Liste der Signaturen, die phpMussel nutzt und wie diese
 verarbeitet werden, finden Sie im Abschnitt SIGNATURENFORMAT.

 Sollten irgendwelche Fehlalarme auftreten, Sie etwas entdecken, was Ihrer
 Meinung nach blockiert werden sollte oder etwas mit den Signaturen nicht
 funktionieren, so informieren Sie den Autor, damit die erforderlichen
 Änderungen durchgeführt werden können.

 Um die Signaturen, die in phpMussel enthalten sind, zu deaktivieren, lesen Sie
 bitte die Hinweise zum Greylisting im Abschnitt BROWSER BEFEHLE.

 Zusätzlich zum Überprüfen von hochgeladenen Dateien und dem optionalen
 Überprüfen von Dateien und Verzeichnissen mittels der oben genannten Funktion,
 ist in phpMussel eine Funktion enthalten, Textkörper (body) von E-Mails zu
 überprüfen. Diese Funktion verhält sich ähnlich wie die normalen
 Scan-Funktionen von phpMussel, ist allerdings auf die E-Mail-Signaturen von
 ClamAV fokussiert. Diese Signaturen sind nicht in der normalen phpMussel()
 Funktion eingebunden, da es höchst unwahrscheinlich ist, eine E-Mail auf einer
 Webseite, in der phpMussel eingebunden ist, innerhalb eines Dateiuploads
 überprüfen zu müssen. Diese Signaturen in die phpMussel() Funktion einzubinden
 wäre redundant. Diese separate Funktion ist nützlich für CMS, die mit dem
 E-Mail-System zusammenarbeiten oder Systeme, die E-Mails mittels PHP
 analysieren. Diese Funktion wird in der "phpmussel.ini" konfiguriert. Um diese
 Funktion zu nutzen (Sie benötigen Ihre eigene Implementierung), fügen Sie in
 eine PHP-Datei, in welcher phpMussel eingebunden ist, folgenden Code hinzu:

 phpMussel_mail($body);

 $body ist der Textkörper (Body) der E-Mail, die Sie überprüfen möchten
 (zusätzlich können Sie versuchen, neue Forenbeiträge oder eingehende
 Nachrichten aus einem Formular zu scannen). Tritt ein Fehler auf, wird ein
 Wert von -1 zurückgegeben. Wurde der Scan beendet und keine Auffälligkeiten
 festgestellt, gibt die Funktion den Wert 0 zurück.
 Sollte etwas festgestellt werden, gibt die Funktion einen String mit einer
 Nachricht, was gefunden wurde, zurück.

 Sollten Sie die Quelltexte betrachten, werden Sie die Funktionen phpMusselD()
 und phpMusselR() auffinden. Diese Funktionen sind Subroutinen von phpMussel()
 und sollten nicht außerhalb der übergeordneten Funktion aufgerufen werden
 (nicht wegen der Nebeneffekte, Sie hätten allein ausgeführt einfach nur keinen
 Zweck und würden nicht korrekt ausgeführt werden).

 Es gibt noch viele weitere Funktionen und Steuermöglichkeiten in phpMussel für
 Ihren Einsatzzweck. Für andere Funktionen und Steuermöglichkeiten, die hier
 nicht aufgelistet sind, lesen Sie bitte den Abschnitt BROWSER BEFEHLE.

                                     ~ ~ ~


 3B. BENUTZUNG (CLI - BEFEHLSZEILENMODUS)

 Bitte lesen Sie den Abschnitt INSTALLATION (CLI - BEFEHLSZEILENMODUS).

 Bedenken Sie, dass zukünftige Versionen von phpMussel andere Systeme
 unterstützen werden, zur Zeit jedoch phpMussel im CLI-Modus nur für
 Windows-Systeme optimiert wurde (Sie können natürlich versuchen, phpMussel
 auf anderen Systemen zu installieren, jedoch wird nicht garantiert, dass es
 wie vorgesehen funktioniert).

 Beachten Sie außerdem, dass phpMussel keine vollständige Antiviren-Software
 ersetzt, nicht den aktiven Speicher überwacht oder Viren spontan erkennt! Es
 erkennt nur Viren in den Dateien, die Sie explizit zum Scannen angegeben
 haben.

                                     ~ ~ ~


 4A. BROWSER BEFEHLE

 Ist phpMussel auf Ihrem System installiert und funktioniert ordnungsgemäß,
 sind Sie in der Lage, einige Verwaltungsfunktionen und Befehle an phpMussel
 über Ihren Browser zu übergeben, sofern Sie die Variablen script_password und
 logs_password in Ihrer Konfigurationsdatei gesetzt haben. Diese Passwörter
 müssen zum Aktivieren dieser Kontrollen gesetzt werden, um eine größt mögliche
 Sicherheit zu erlangen, die browserbasierten Kontrollen zu schützen und um
 dafür zu sorgen, dass diese browserbasierten Kontrollen vollständig
 deaktiviert werden können, wenn Sie nicht von Ihnen, dem Webmaster oder den
 Administratoren benötigt werden. Zum Aktivieren dieser Kontrollmöglichkeiten
 wird ein Passwort vergeben, zum Deaktivieren wird kein Passwort vergeben.
 Alternativ können Sie diese Kontrollen aktivieren und zu einem späteren
 Zeitpunkt mit einem Befehl deaktivieren (z.B. wenn Sie Aktionen durchführen
 müssen und befürchten, dass Ihr Passwort ausgelesen werden kann, so können Sie
 die Kontrollen schnell deaktivieren ohne die Konfigurationsdatei zu
 bearbeiten).

 Gründe, warum Sie diese Kontrollen aktivieren sollten:
 - Bietet die Möglichkeit, Signaturen schnell in eine Greylist aufzunehmen,
   wenn Sie Dateien auf Ihr System hochladen und Fehlalarme erzeugt werden und
   Sie nicht die Zeit haben, die Greylist manuell zu bearbeiten.
 - Bietet die Möglichkeit, anderen Personen die Kontrollen über phpMussel zu
   geben, ohne ihnen Zugang über FTP zu gewähren.
 - Bietet die Möglichkeit, kontrollierten Zugang zu Ihren Log-Dateien zu
   gewähren.
 - Bietet einen einfachen Weg, phpMussel zu aktualisieren.
 - Bietet die Möglichkeit, phpMussel zu überwachen, wenn kein FTP-Zugang oder
   andere Zugangsmethoden verfügbar sind.

 Gründe, warum Sie diese Kontrollen nicht aktivieren sollten:
 - Bietet einen Vektor für Angreifer, ob Sie phpMussel nutzen oder nicht (je
   nach Perspektive könnte dies ein Grund für oder gegen die Nutzung der
   Browserbefehle sein), indem blind Befehle an Ihren Server gesendet werden
   (Probing). Einerseits könnte dies den Angreifer entmutigen, sobald er
   feststellt, dass die Angriffsmethoden aufgrund der Ergebnisse von phpMussel
   nutzlos sind. Andererseits könnte ein unvorhergesehener oder bislang
   unbekannter Exploit für phpMussel oder für zukünftige Versionen einen
   Angriffsverkor bieten, ein positives Ergebnis einer blinden Anfrage könnte
   den Angreifer ermutigen, Ihr System zu attackieren.
 - Sollte Ihr Passwort kompromittiert worden sein, bietet es dem Angreifer die
   Möglichkeit, Signaturen zu umgehen, die normalerweise den Angriff verhindert
   hätten, oder phpMussel vollständig zu deaktivieren.

 Die Entscheidung müssen Sie selbst treffen. Standardmäßig sind diese
 Kontrollen deaktiviert, dennoch erklärt dieser Abschnitt, wie Sie die
 Kontrollen aktivieren und nutzen.

 Liste der verfügbaren Browser Befehle:

 scan_log
   Benötigtes Passwort: logs_password
   Weitere Bedingungen: scan_log muss gesetzt sein.
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Zweck: Gibt den Inhalt der Datei scan_log aus.
   ~
 scan_kills
   Benötigtes Passwort: logs_password
   Weitere Bedingungen: scan_kills muss gesetzt sein.
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Zweck: Gibt den Inhalt der Datei scan_kills aus.
   ~
 controls_lockout
   Benötigtes Passwort: logs_password ODER script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Beispiel 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Zweck: Deaktiviert alle browser-basierten Kontrollen. Diese Funktion sollte
          benutzt werden, wenn Sie befürchten, dass Ihr Passwort kompromittiert
          wurde (dies ist möglich, wenn Sie die Kontrollen von einem Computer
          aus benutzen, der nicht abgesichert oder dem nicht vertraut werden
          kann). controls_lockout erstellt die Datei "controls.lck" im
          Verzeichnis "vault", wonach phpMussel zuerst sucht, befor es Aktionen
          ausführt. Wurden die Kontrollen deaktiviert, müssen Sie die Datei
          "controls.lck" manuell mittels FTP o.ä. löschen. Kann mit jedem
          Passwort aufgerufen werden.
   ~
 disable
   Benötigtes Passwort: script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?pword=[script_password]&phpmussel=disable
   ~
   Zweck: Deaktiviert phpMussel. Wird benutzt, wenn Sie Aktualisierungen
          dürchführen, Änderungen an Ihrem System vornehmen oder Software oder
          Module installieren und möglicherweise Fehlalarme ausgelöst werden
          könnten. Sie können diese Funktion nutzen, wenn Sie Probleme mit
          phpMussel entdecken und es nicht von Ihrem System entfernen möchten.
          Um phpMussel wieder zu aktivieren, nutzen Sie "enable".
   ~
 enable
   Benötigtes Passwort: script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?pword=[script_password]&phpmussel=enable
   ~
   Zweck: Aktiviert phpMussel. Wird benutzt, wenn Sie phpMussel mittels
          "disable" deaktiviert haben und es wieder aktivieren möchten.
   ~
 update
   Benötigtes Passwort: script_password
   Weitere Bedingungen: "update.dat" und "update.inc" müssen vorhanden sein.
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiele: ?pword=[script_password]&phpmussel=update
   ~
   Zweck: Sucht nach Aktualisierungen für phpMussel und Signaturen.
          War die Suche erfolgreich und Aktualisierungen sind verfügbar, so
          werden diese heruntergeladen und installiert. Schlägt die Suche fehl,
          wird der Vorgang abgebrochen. Die Ergebnisse des gesamten Vorgangs
          werden ausgegeben. Es wird empfohlen, mindestens einmal monatlich
          nach Aktualisierungen zu suchen, um sicherzustellen, dass die
          Signaturen und Ihre Kopie von phpMussel auf dem neuesten Stand sind.
          Eine häufigere Suche nach Aktualisierungen ist fruchtlos, da die
          entsprechenden Pakete meist monatlich eingestellt werden.
   ~
 greylist
   Benötigtes Passwort: script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: [Name der Signatur für die Greylist]
   Optionale Parameter: (keine)
   Beispiel: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signatur]
   ~
   Zweck: Fügt eine Signatur zur Greylist hinzu.
   ~
 greylist_clear
   Benötigtes Passwort: script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Zweck: Löscht die gesamte Greylist.
   ~
 greylist_show
   Benötigtes Passwort: script_password
   Weitere Bedingungen: (keine)
   Benötigte Parameter: (keine)
   Optionale Parameter: (keine)
   Beispiel: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Zweck: Gibt den Inhalt der Greylist aus.
   ~

                                     ~ ~ ~


 4B. CLI (BEFEHLSZEILENMODUS)

 phpMussel kann als interaktiver Scanner im CLI-Modus in einer
 Windows-Systemumgebung genutzt werden. Bitte lesen Sie den Abschnitt
 INSTALLATION (CLI - BEFEHLSZEILENMODUS).

 Um eine Liste der verfügbaren CLI-Befehle zu erhalten, geben Sie in der
 Befehlszeile 'c' ein und bestätigen Sie mit Enter.

                                     ~ ~ ~


 5. IM PAKET ENTHALTENE DATEIEN

 Die folgende Liste beinhaltet alle Dateien, die im heruntergeladenen Archiv
 des Scripts enthalten sind und Dateien, die durch die Benutzung des Scripts
 eventuell erstellt werden, inkl. einer kurzen Beschreibung.

 /phpmussel.php (Script, enthalten)
    phpMussel Loader Datei. Lädt das Script, Updater, etc.
    Diese Datei wird in Ihr CMS eingebunden (notwendig)!
    ~
 /web.config (Sonstiges, enthalten)
    Eine ASP.NET-Konfigurationsdatei (in diesem Fall zum Schutz des
    Verzeichnisses "/vault" vor einem nicht authorisierten Zugriff, sofern das
    Script auf einem auf der ASP.NET-Technologie basierenden Server installiert
    wurde).
    ~
 /_docs/ (Verzeichnis)
    Verzeichnis für die Dokumentationen (beinhaltet verschiedene Dateien).
    ~
 /_docs/change_log.txt (Dokumentation, enthalten)
    Eine Auflistung der Änderungen des Scripts der verschiedenen Versionen (für
    die korrekte Funktion des Scripts nicht notwendig).
    ~
 /_docs/readme.de.md (Dokumentation, enthalten); DEUTSCH
 /_docs/readme.de.txt (Dokumentation, enthalten); DEUTSCH
 /_docs/readme.en.md (Dokumentation, enthalten); ENGLISH
 /_docs/readme.en.txt (Dokumentation, enthalten); ENGLISH
 /_docs/readme.es.md (Dokumentation, enthalten); ESPAÑOL
 /_docs/readme.es.txt (Dokumentation, enthalten); ESPAÑOL
 /_docs/readme.fr.md (Dokumentation, enthalten); FRANÇAIS
 /_docs/readme.fr.txt (Dokumentation, enthalten); FRANÇAIS
 /_docs/readme.id.md (Dokumentation, enthalten); BAHASA INDONESIA
 /_docs/readme.id.txt (Dokumentation, enthalten); BAHASA INDONESIA
 /_docs/readme.it.md (Dokumentation, enthalten); ITALIANO
 /_docs/readme.it.txt (Dokumentation, enthalten); ITALIANO
 /_docs/readme.nl.md (Dokumentation, enthalten); NEDERLANDSE
 /_docs/readme.nl.txt (Dokumentation, enthalten); NEDERLANDSE
 /_docs/readme.pt.md (Dokumentation, enthalten); PORTUGUÊS
 /_docs/readme.pt.txt (Dokumentation, enthalten); PORTUGUÊS
 /_docs/readme.ru.md (Dokumentation, enthalten); РУССКИЙ
 /_docs/readme.ru.txt (Dokumentation, enthalten); РУССКИЙ
    Die README-Dateien (z.B. die Datei, die Sie gerade lesen).
    ~
 /_docs/signatures_tally.txt (Dokumentation, enthalten)
    Netto-Veränderungs-Anzahl von enthaltenen Signaturen (für die korrekte
    Funktion des Scripts nicht notwendig).
    ~
 /_testfiles/ (Verzeichnis)
    Verzeichnis für Testdateien (beinhaltet verschiedene Dateien).
    Alle enthaltenen Dateien dienen zur Überprüfung, ob phpMussel auf Ihrem
    System ordnungsgemäß installiert wurde. Sie müssen dieses Verzeichnis oder
    die Dateien nicht hochladen, sofern Sie keinen solchen Test durchführen
    möchten.
    ~
 /_testfiles/ascii_standard_testfile.txt (Testdatei, enthalten)
    Testdatei zur Überprüfung der normierten ASCII-Signaturerkennung.
    ~
 /_testfiles/coex_testfile.rtf (Testdatei, enthalten)
    Testdatei zur Überprüfung der Komplex-Erweitert-Signaturerkennung.
    ~
 /_testfiles/exe_standard_testfile.exe (Testdatei, enthalten)
    Testdatei zur Überprüfung der PE-Signaturerkennung.
    ~
 /_testfiles/general_standard_testfile.txt (Testdatei, enthalten)
    Testdatei zur Überprüfung der Erkennung der allgemeinen Signaturen.
    ~
 /_testfiles/graphics_standard_testfile.gif (Testdatei, enthalten)
    Testdatei zur Überprüfung der Grafik-Signaturerkennung.
    ~
 /_testfiles/html_standard_testfile.txt (Testdatei, enthalten)
    Testdatei zur Überprüfung der normierten HTML-Signaturerkennung.
    ~
 /_testfiles/md5_testfile.txt (Testdatei, enthalten)
    Testdatei zur Überprüfung der MD5-Signaturerkennung.
    ~
 /_testfiles/metadata_testfile.tar (Testdatei, enthalten)
    Testdatei zur Überprüfung der Metadata-Signaturerkennung und zur
    Überprüfung der TAR-Archivunterstützung Ihres Systems.
    ~
 /_testfiles/metadata_testfile.txt.gz (Testdatei, enthalten)
    Testdatei zur Überprüfung der Metadata-Signaturerkennung und zur
    Überprüfung der GZ-Archivunterstützung Ihres Systems.
    ~
 /_testfiles/metadata_testfile.zip (Testdatei, enthalten)
    Testdatei zur Überprüfung der Metadata-Signaturerkennung und zur
    Überprüfung der ZIP-Archivunterstützung Ihres Systems.
    ~
 /_testfiles/ole_testfile.ole (Testdatei, enthalten)
    Testdatei zur Überprüfung der OLE-Signaturerkennung.
    ~
 /_testfiles/pdf_standard_testfile.pdf (Testdatei, enthalten)
    Testdatei zur Überprüfung der PDF-Signaturerkennung.
    ~
 /_testfiles/pe_sectional_testfile.exe (Testdatei, enthalten)
    Testdatei zur Überprüfung der PE-Sectional-Signaturerkennung.
    ~
 /_testfiles/swf_standard_testfile.swf (Testdatei, enthalten)
    Testdatei zur Überprüfung der Shockwave-Signaturerkennung.
    ~
 /_testfiles/xdp_standard_testfile.xdp (Testdatei, enthalten)
    Testdatei zur Überprüfung der XML/XDP-Datenblock-
    -Signaturerkennung.
    ~
 /vault/ (Verzeichnis)
    Vault-Verzeichnis (beinhaltet verschiedene Dateien).
    ~
 /vault/cache/ (Directory)
    Cache directory (for temporary data).
    ~
 /vault/cache/.htaccess (Sonstiges, enthalten)
    Ein hypertext access file (in diesem Fall zum Schutz von sensiblen Dateien
    des Scripts vor einem nicht authorisierten Zugriff).
    ~
 /vault/lang/ (Verzeichnis)
    Enthält Sprachdaten für phpMussel.
    ~
 /vault/lang/.htaccess (Sonstiges, enthalten)
    Ein hypertext access file (in diesem Fall zum Schutz von sensiblen Dateien
    des Scripts vor einem nicht authorisierten Zugriff).
    ~
 /vault/lang/lang.de.inc (Script, enthalten); DEUTSCH
 /vault/lang/lang.en.inc (Script, enthalten); ENGLISH
 /vault/lang/lang.es.inc (Script, enthalten); ESPAÑOL
 /vault/lang/lang.fr.inc (Script, enthalten); FRANÇAIS
 /vault/lang/lang.id.inc (Script, enthalten); BAHASA INDONESIA
 /vault/lang/lang.it.inc (Script, enthalten); ITALIANO
 /vault/lang/lang.ja.inc (Script, enthalten); 日本語
 /vault/lang/lang.nl.inc (Script, enthalten); NEDERLANDSE
 /vault/lang/lang.pt.inc (Script, enthalten); PORTUGUÊS
 /vault/lang/lang.ru.inc (Script, enthalten); РУССКИЙ
 /vault/lang/lang.vi.inc (Script, enthalten); TIẾNG VIỆT
 /vault/lang/lang.zh.inc (Script, enthalten); 中文（简体）
 /vault/lang/lang.zh-TW.inc (Script, enthalten); 中文（傳統）
    Sprachdateien für phpMussel.
    ~
 /vault/quarantine/ (Verzeichnis)
    Quarantäne-Verzeichnis (enthält Dateien in Quarantäne).
    ~
 /vault/quarantine/.htaccess (Sonstiges, enthalten)
    Ein hypertext access file (in diesem Fall zum Schutz von sensiblen Dateien
    des Scripts vor einem nicht authorisierten Zugriff).
    ~
 /vault/.htaccess (Sonstiges, enthalten)
    Ein hypertext access file (in diesem Fall zum Schutz von sensiblen Dateien
    des Scripts vor einem nicht authorisierten Zugriff).
    ~
 /vault/ascii_clamav_regex.cvd (Signaturen, enthalten)
 /vault/ascii_clamav_regex.map (Signaturen, enthalten)
 /vault/ascii_clamav_standard.cvd (Signaturen, enthalten)
 /vault/ascii_clamav_standard.map (Signaturen, enthalten)
 /vault/ascii_custom_regex.cvd (Signaturen, enthalten)
 /vault/ascii_custom_standard.cvd (Signaturen, enthalten)
 /vault/ascii_mussel_regex.cvd (Signaturen, enthalten)
 /vault/ascii_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der normierten ASCII-Signaturen.
    Benötigt, wenn die Option "ASCII Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/coex_clamav.cvd (Signaturen, enthalten)
 /vault/coex_custom.cvd (Signaturen, enthalten)
 /vault/coex_mussel.cvd (Signaturen, enthalten)
    Dateien der Komplex-Erweitert-Signaturen.
    Benötigt, wenn die Option "Complex Extended" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/elf_clamav_regex.cvd (Signaturen, enthalten)
 /vault/elf_clamav_regex.map (Signaturen, enthalten)
 /vault/elf_clamav_standard.cvd (Signaturen, enthalten)
 /vault/elf_clamav_standard.map (Signaturen, enthalten)
 /vault/elf_custom_regex.cvd (Signaturen, enthalten)
 /vault/elf_custom_standard.cvd (Signaturen, enthalten)
 /vault/elf_mussel_regex.cvd (Signaturen, enthalten)
 /vault/elf_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der ELF-Signaturen.
    Benötigt, wenn die Option "ELF Signatures" in der "phpmussel.ini" aktiviert
    ist. Die Dateien können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/exe_clamav_regex.cvd (Signaturen, enthalten)
 /vault/exe_clamav_regex.map (Signaturen, enthalten)
 /vault/exe_clamav_standard.cvd (Signaturen, enthalten)
 /vault/exe_clamav_standard.map (Signaturen, enthalten)
 /vault/exe_custom_regex.cvd (Signaturen, enthalten)
 /vault/exe_custom_standard.cvd (Signaturen, enthalten)
 /vault/exe_mussel_regex.cvd (Signaturen, enthalten)
 /vault/exe_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der Portable Executable Datei (EXE)-Signaturen.
    Benötigt, wenn die Option "EXE Signatures" in der "phpmussel.ini" aktiviert
    ist. Die Dateien können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/filenames_clamav.cvd (Signaturen, enthalten)
 /vault/filenames_custom.cvd (Signaturen, enthalten)
 /vault/filenames_mussel.cvd (Signaturen, enthalten)
    Dateien der Dateinamen-Signaturen.
    Benötigt, wenn die Option "Filename Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/general_clamav_regex.cvd (Signaturen, enthalten)
 /vault/general_clamav_regex.map (Signaturen, enthalten)
 /vault/general_clamav_standard.cvd (Signaturen, enthalten)
 /vault/general_clamav_standard.map (Signaturen, enthalten)
 /vault/general_custom_regex.cvd (Signaturen, enthalten)
 /vault/general_custom_standard.cvd (Signaturen, enthalten)
 /vault/general_mussel_regex.cvd (Signaturen, enthalten)
 /vault/general_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der allgemeinen Signaturen.
    Benötigt, wenn die Option "General Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/graphics_clamav_regex.cvd (Signaturen, enthalten)
 /vault/graphics_clamav_regex.map (Signaturen, enthalten)
 /vault/graphics_clamav_standard.cvd (Signaturen, enthalten)
 /vault/graphics_clamav_standard.map (Signaturen, enthalten)
 /vault/graphics_custom_regex.cvd (Signaturen, enthalten)
 /vault/graphics_custom_standard.cvd (Signaturen, enthalten)
 /vault/graphics_mussel_regex.cvd (Signaturen, enthalten)
 /vault/graphics_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der Signaturen für Bilddateien.
    Benötigt, wenn die Option "Graphics Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/greylist.csv (Signaturen, enthalten/wird erstellt)
    CSV der Signaturen in der Greylist, die phpMussel ignorieren soll (Datei
    wird nach dem Löschen automatisch neu erstellt).
    ~
 /vault/hex_general_commands.csv (Signaturen, enthalten)
    Hex-codierte CSV mit allgemeinen Befehlserkennung.
    Benötigt, wenn die Option "General Command Detection" in der
    "phpmussel.ini" aktiviert ist. Die Datei kann entfernt werden, wenn die
    Option deaktiviert ist.
    ~
 /vault/html_clamav_regex.cvd (Signaturen, enthalten)
 /vault/html_clamav_regex.map (Signaturen, enthalten)
 /vault/html_clamav_standard.cvd (Signaturen, enthalten)
 /vault/html_clamav_standard.map (Signaturen, enthalten)
 /vault/html_custom_regex.cvd (Signaturen, enthalten)
 /vault/html_custom_standard.cvd (Signaturen, enthalten)
 /vault/html_mussel_regex.cvd (Signaturen, enthalten)
 /vault/html_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der normierten HTML-Signaturen.
    Benötigt, wenn die Option "HTML Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/lang.inc (Script, enthalten)
    Sprachpaket für phpMussel.
    ~
 /vault/macho_clamav_regex.cvd (Signaturen, enthalten)
 /vault/macho_clamav_regex.map (Signaturen, enthalten)
 /vault/macho_clamav_standard.cvd (Signaturen, enthalten)
 /vault/macho_clamav_standard.map (Signaturen, enthalten)
 /vault/macho_custom_regex.cvd (Signaturen, enthalten)
 /vault/macho_custom_standard.cvd (Signaturen, enthalten)
 /vault/macho_mussel_regex.cvd (Signaturen, enthalten)
 /vault/macho_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der Mach-O-Signaturen.
    Benötigt, wenn die Option "Mach-O Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/mail_clamav_regex.cvd (Signaturen, enthalten)
 /vault/mail_clamav_regex.map (Signaturen, enthalten)
 /vault/mail_clamav_standard.cvd (Signaturen, enthalten)
 /vault/mail_clamav_standard.map (Signaturen, enthalten)
 /vault/mail_custom_regex.cvd (Signaturen, enthalten)
 /vault/mail_custom_standard.cvd (Signaturen, enthalten)
 /vault/mail_mussel_regex.cvd (Signaturen, enthalten)
 /vault/mail_mussel_standard.cvd (Signaturen, enthalten)
 /vault/mail_mussel_standard.map (Signaturen, enthalten)
    Signaturdateien für die Funktion phpMussel_mail().
    Dateien werden auf jeden Fall von der Funktion phpMussel_mail() benötigt.
    Die Dateien können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/md5_clamav.cvd (Signaturen, enthalten)
 /vault/md5_custom.cvd (Signaturen, enthalten)
 /vault/md5_mussel.cvd (Signaturen, enthalten)
    Dateien der MD5-Signaturen.
    Benötigt, wenn die Option "MD5" in der "phpmussel.ini" aktiviert ist.
    Die Dateien können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/metadata_clamav.cvd (Signaturen, enthalten)
 /vault/metadata_custom.cvd (Signaturen, enthalten)
 /vault/metadata_mussel.cvd (Signaturen, enthalten)
    Dateien für die Signaturen der Archiv-Metadaten.
    Benötigt, wenn die Option "Archive Metadata Signatures" in der
    "phpmussel.ini" aktiviert ist. Die Dateien können entfernt werden, wenn
    die Option deaktiviert ist.
    ~
 /vault/ole_clamav_regex.cvd (Signaturen, enthalten)
 /vault/ole_clamav_regex.map (Signaturen, enthalten)
 /vault/ole_clamav_standard.cvd (Signaturen, enthalten)
 /vault/ole_clamav_standard.map (Signaturen, enthalten)
 /vault/ole_custom_regex.cvd (Signaturen, enthalten)
 /vault/ole_custom_standard.cvd (Signaturen, enthalten)
 /vault/ole_mussel_regex.cvd (Signaturen, enthalten)
 /vault/ole_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der OLE-Signaturen.
    Benötigt, wenn die Option "OLE Signatures" in der "phpmussel.ini" aktiviert
    ist. Die Dateien können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/pdf_clamav_regex.cvd (Signaturen, enthalten)
 /vault/pdf_clamav_regex.map (Signaturen, enthalten)
 /vault/pdf_clamav_standard.cvd (Signaturen, enthalten)
 /vault/pdf_clamav_standard.map (Signaturen, enthalten)
 /vault/pdf_custom_regex.cvd (Signaturen, enthalten)
 /vault/pdf_custom_standard.cvd (Signaturen, enthalten)
 /vault/pdf_mussel_regex.cvd (Signaturen, enthalten)
 /vault/pdf_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der PDF-Signaturen.
    Benötigt, wenn die Option "PDF Signatures" in der "phpmussel.ini" aktiviert
    ist. Die Dateien können entfernt werden, wenn die Option deaktiviert ist
    (Dateien werden bei einem Update neu erstellt).
    ~
 /vault/pe_clamav.cvd (Signaturen, enthalten)
 /vault/pe_custom.cvd (Signaturen, enthalten)
 /vault/pe_mussel.cvd (Signaturen, enthalten)
    Dateien der PE-Sectional-Signaturen.
    Benötigt, wenn die Option "PE Sectional signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/pex_custom.cvd (Signaturen, enthalten)
 /vault/pex_mussel.cvd (Signaturen, enthalten)
    Dateien der PE-Erweitert-Signaturen.
    Benötigt, wenn die Option "PE extended signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/phpmussel.inc (Script, enthalten)
    phpMussel Core Script (absolut notwendig)!
    ~
 /vault/phpmussel.ini (Sonstiges, enthalten)
    phpMussel Konfigurationsdatei; beinhaltet alle Konfigurationsmöglichkeiten
    von phpMussel (absolut notwendig)!
    ~
 /vault/scan_log.txt *(Logfile, wird erstellt)
    Eine Aufzeichnung aller von phpMussel gescannten Objekte.
    ~
 /vault/scan_kills.txt *(Logfile, wird erstellt)
    Eine Aufzeichnung aller von phpMussel blockierten Dateiuploads.
    ~
 /vault/swf_clamav_regex.cvd (Signaturen, enthalten)
 /vault/swf_clamav_regex.map (Signaturen, enthalten)
 /vault/swf_clamav_standard.cvd (Signaturen, enthalten)
 /vault/swf_clamav_standard.map (Signaturen, enthalten)
 /vault/swf_custom_regex.cvd (Signaturen, enthalten)
 /vault/swf_custom_standard.cvd (Signaturen, enthalten)
 /vault/swf_mussel_regex.cvd (Signaturen, enthalten)
 /vault/swf_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der Shockwave-Signaturen.
    Benötigt, wenn die Option "Shockwave Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~
 /vault/switch.dat (Sonstiges, enthalten)
    Diese Datei definiert bestimmte Variablen.
    ~
 /vault/template.html (Sonstiges, enthalten)
 /vault/template_custom.html (Sonstiges, enthalten)
    phpMussel Template Datei; Template für die HTML-Ausgabe mit der Nachricht,
    dass der Dateiupload von phpMussel blockiert wurde (Nachricht, die dem
    Nutzer angezeigt wird).
    ~
 /vault/update.dat (Sonstiges, enthalten)
    Datei beinhaltet Versionsinformationen des Scripts und der Signaturen.
    Diese Datei ist notwendig, wenn Sie phpMussel automatisch oder mittels
    Browser aktualisieren wollen.
    ~
 /vault/update.inc (Script, enthalten)
    phpMussel Update Script; Wird nur für die automatische und manuelle
    Aktualisierung mittels Browser benötigt.
    ~
 /vault/whitelist_clamav.cvd (Signaturen, enthalten)
 /vault/whitelist_custom.cvd (Signaturen, enthalten)
 /vault/whitelist_mussel.cvd (Signaturen, enthalten)
    Datei-spezifische Whitelist.
    Benötigt, wenn die Option "Whitelist" in der "phpmussel.ini" aktiviert ist,
    und wenn Sie auf bestimmte Dateien Whitelist haben möchten. Die Dateien
    können entfernt werden, wenn die Option deaktiviert ist.
    ~
 /vault/xmlxdp_clamav_regex.cvd (Signaturen, enthalten)
 /vault/xmlxdp_clamav_regex.map (Signaturen, enthalten)
 /vault/xmlxdp_clamav_standard.cvd (Signaturen, enthalten)
 /vault/xmlxdp_clamav_standard.map (Signaturen, enthalten)
 /vault/xmlxdp_custom_regex.cvd (Signaturen, enthalten)
 /vault/xmlxdp_custom_standard.cvd (Signaturen, enthalten)
 /vault/xmlxdp_mussel_regex.cvd (Signaturen, enthalten)
 /vault/xmlxdp_mussel_standard.cvd (Signaturen, enthalten)
    Dateien der XML/XDP-Datenblock-Signaturen.
    Benötigt, wenn die Option "XML/XDP-Chunk Signatures" in der "phpmussel.ini"
    aktiviert ist. Die Dateien können entfernt werden, wenn die Option
    deaktiviert ist.
    ~

 * Der Dateiname kann je nach Konfiguratuion in der "phpmussel.ini" variieren.

 = BETRIFFT DIE SIGNATURDATEIEN =
    CVD ist ein Akronym für "ClamAV Virus Definitions", in Bezug auf die
    Namensgebung der Signaturen von ClamAV und zur Nutzung durch phpMussel;
    Dateien mit der Endung "CVD" enthalten Signaturen.
    ~
    Dateien mit der Endung "MAP" stellen eine Liste dar, welche Signaturen
    phpMussel für einzelne Scans nutzen soll und welche nicht; Nicht alle
    Signaturen werden unbedingt für jeden einzelnen Scan benötigt, phpMussel
    nutzt diese Listen, um den Scanvorgang zu beschleunigen (der sonst recht
    langsam und ressourcenaufwändig wäre).
    ~
    Signaturdateien mit der Kennzeichnung "_regex" enthalten Signaturen,
    welche reguläre Ausdrucke verwenden (regex).
    ~
    Signaturdateien mit der Kennzeichnung "_standard" enthalten Signaturen,
    welche nicht jede Form der Musterprüfung nutzen.
    ~
    Signaturdateien, die weder mit "_regex" oder "_standard" gekennzeichnet
    sind, sind entweder das eine oder das andere, aber nicht beides (Bitte
    lesen Sie den Abschnitt SIGNATURENFORMAT).
    ~
    Signaturdateien mit der Kennzeichnung "_clamav" enthalten Signaturen direkt
    aus der Datenbank von ClamAV (GNU/GPL).
    ~
    Signaturdateien mit der Kennzeichnung "_custom" enthalten in der
    Voreinstellung keinerlei Signaturen; In diese Dateien können Sie Ihre
    eigenen Signaturen eintragen.
    ~
    Signaturdateien mit der Kennzeichnung "_mussel" enthalten Signaturen,
    welche nicht von ClamAV stammen.
    ~

                                     ~ ~ ~


 6. EINSTELLUNGEN

 Nachfolgend finden Sie eine Liste der Variablen in der Konfigurationsdatei
 "phpmussel.ini" mit einer kurzen Beschreibung ihrer Funktionen.

 "general" (Kategorie)
 - Generelle Konfiguration von phpMussel.
    "script_password"
    - Als Komfort-Funktion ermöglicht es phpMussel, einige Funktionen
      (inkl. des schnellen Updates) manuell via POST, GET und QUERY auszulösen.
      Um sicherzustellen, dass diese Anfrage auch nur von Ihnen und keinem
      anderen abgeschickt wurde, erwartet phpMussel das Passwort innerhalb der
      Anfrage. Setzen Sie das script_password nach Belieben, wählen Sie ein
      Passwort, das Sie sich leicht merken können, aber für andere schwer zu
      erraten ist. Ist kein Passwort vergeben, sind die manuellen Anfragen
      deaktiviert.
      * Kein Einfluss im CLI-Modus.
    "logs_password"
    - Wie script_password, allerdings nur zur Ausgabe des Inhalts von scan_log
      und scan_kills. Separate Passworte sind nützlich, wenn Sie jemandem
      Zugang zur einen Funktionalität gewähren wollen, aber nicht zur anderen.
      * Kein Einfluss im CLI-Modus.
    "cleanup"
    - Löscht die Scriptvariablen und den Cache nach der Ausführung.
      False = Nicht löschen, True = Löschen [Standardeinstellung].
      Sollten Sie das Script nach der Überprüfung des Uploads nicht mehr
      nutzen, stellen Sie diese Option auf "true", um die Speichernutzung zu
      minimieren. Verwenden Sie das Script noch für weitere Zwecke, stellen Sie
      die Option auf "false", um unnötiges mehrfaches Einlesen der Daten in den
      Speicher zu vermeiden. Normalerweise sollte diese Option auf "true"
      gesetzt werden, allerdings können Sie das Script dann nur zur
      Dateiüberprüfung verwenden.
      * Kein Einfluss im CLI-Modus.
    "scan_log"
    - Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen. Geben
      Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.
    "scan_kills"
    - Name einer Datei zum Aufzeichnen aller blockierten Uploads. Geben Sie
      einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.
    "ipaddr"
    - Ort der IP-Adresse der aktuellen Verbindung im gesamten Datenstrom
      (nützlich für Cloud-Services) Standardeinstellung = REMOTE_ADDR
      Achtung: Ändern Sie diesen Wert nur, wenn Sie wissen, was Sie tun!
    "forbid_on_block"
    - Zurückgegebener 403-HTTP-Header bei einem blockierten Dateiupload.
      0 = Nein (200) [Standardeinstellung], 1 = Ja (403).
    "delete_on_sight"
    - Diese Option weist das Script an, Dateien während eines Scans sofort
      zu löschen, wenn ein Erkennungsmerkmal, ob durch Signaturen oder
      andere Methoden, zutrifft. Dateien, die als nicht infiziert eingestuft
      werden, werden nicht berührt. Im Falle von Archiven wird das gesamte
      Archiv gelöscht, auch wenn nur eine einzige Datei im Archiv infiziert
      sein sollte. Normalerweise ist es bei einem Dateiupload nicht notwendig,
      diese Option zu aktivieren, da PHP nach der Ausführung von Scripten den
      Inhalt vom Cache löscht, d.h. PHP löscht jede Datei, die über den Server
      hochgeladen wird, sofern Sie nicht verschoben, kopiert oder bereits
      gelöscht wurde. Diese Option wurde als zusätzliches Maß an Sicherheit
      hinzugefügt, außerdem für Systeme, deren PHP-Installation nicht dem
      üblichen Verhalten entspricht.
      False = Nach der Überprüfung wird die Datei so belassen
              [Standardeinstellung],
      True = Nach der Überprüfung wird die Datei sofort gelöscht, sofern Sie
             infiziert ist.
    "lang"
    - Gibt die Standardsprache für phpMussel an.
    "lang_override"
    - Festlegen ob phpMussel, falls möglich, die Sprach-Einstellung mit dem
      Sprach-Wert von einkommenden Anfragen festlegen soll
      (HTTP_ACCEPT_LANGUAGE). 0 - Nein [Standardeinstellung], 1 - Ja.
    "lang_acceptable"
    - Die "lang_acceptable" Anweisung sagt phpMussel, welche Sprachen von dem
      Script von "lang" oder von "HTTP_ACCEPT_LANGUAGE" akzeptiert werden.
      Diese Anweisung sollte -NUR- angepasst werden, falls du eigene
      angepasste Sprachen hinzufügst oder zwangsweise Sprachdateien entfernst.
      Diese Anweisung ist ein mit Kommata getrennter String der Codes der
      benutzten Sprachen, die von dem Script akzeptiert werden.
    "quarantine_key"
    - phpMussel ist in der Lage, Versuche von Datei-Uploads in einem
      Quarantäne-Verzeichnis zu isolieren, sofern Sie dies tun wollen. Nutzer,
      die nur daran interessiert sind, ihre Webauftritte oder ihre
      Hosting-Umgebung zu schützen ohne das Interesse, die markierten Dateien
      weitergehend zu untersuchen, sollten diese Funktionalität deaktivieren,
      Nutzer, die diese Dateien zur Ananlyse auf Malware o.ä. benötigen,
      sollten diese Funktion aktivieren. Die Isolation von markierten Dateien
      kann manchmal auch bei der Fehlersuche von Fehlalarmen helfen, wenn dies
      häufiger bei Ihnen auftritt. Um die Quarantänefunktion zu deaktivieren,
      lassen Sie die Richtlinie "quarantine_key" leer oder löschen Sie den
      Inhalt dieser Richtlinie, wenn sie nicht bereits leer ist. Um die
      Quarantänefunktion zu aktivieren, geben Sie einen Wert ein. Der
      "quarantine_key" ist ein wichtiges Sicherheitsmerkmal der
      Quarantänfunktionen, um zu verhindern, dass die Quarantänefunktionen
      einem Exploit ausgesetzt wird und gespeicherte Daten in der
      Quarantäneumgebung ausgeführt werden können. Der Wert des
      "quarantine_key" sollte so behandelt werden, wie Ihre Passwörter: Je
      länger, desto besser, und halten Sie sie geheim. Optimal in Verbindung
      mit "delete_on_sight".
    "quarantine_max_filesize"
    - Die maximal zulässige Dateigröße von Dateien, die in der Quarantäne
      isoliert werden sollen. Dateien, die größer sind als der angegebene Wert,
      werden NICHT im Quarantäneverzeichnis gespeichert. Diese Richtlinie ist
      wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne
      -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit
      unerwünschten Daten zu überfluten. Wert in KB.
      Standardeinstellung =2048 =2048KB =2MB.
    "quarantine_max_usage"
    - Die maximal zulässige Speichernutzung der Quarantäne. Erreicht die
      Geamtgröße der Dateien in der Quarantäne diesen Wert, werden die ältesten
      Dateien in der Quarantäne gelöscht, bis der Wert unterschritten wird.
      Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu
      erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf
      Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Wert in KB.
      Standardwert =65536 =65536KB =64MB.
    "honeypot_mode"
    - Ist der Honeypot-Modus aktiviert, wird phpMussel jede Datei aus dem
      Dateiupload isolieren, ohne Rücksicht darauf zu nehmen, ob diese Dateien
      Signaturen enthalten, es findet auch keine weitere Überprüfung statt.
      Diese Funktionalität dient ausschließlich dem Zweck der Viren-
      und Malwareforschung, es wird ausdrücklich nicht empfohlen, phpMussel
      mit dieser Funktion zum Zwecke der Dateiüberprüfung von Uploads oder
      anderen Zwecken außer "Honeypotting" zu verwenden. Standardmäßig ist
      diese Funktion deaktiviert.
      0 = Deativiert [Standardwert], 1 = Aktiviert.
    "scan_cache_expiry"
    - Für wie lange soll phpMussel die Scan-Ergebnisse zwischenspeichern? Wert
      entspricht der Anzahl Sekunden, wie lange die Scan-Ergebnisse zwischen-
      gespeichert werden. Standard ist 21600 Sekunden (6 Stunden); Ein Wert von
      0 wird das Zwischenspeichern von Scan-Ergebnissen deaktivieren.
    "disable_cli"
    - CLI-Modus deaktivieren? CLI-Modus ist standardmäßig aktiviert, kann aber
      manchmal bestimmte Test-Tools (PHPUnit zum Beispiel) und andere
      CLI-basierte Anwendungen beeinträchtigen. Wenn du den CLI-Modus nicht
      deaktiveren musst, solltest du diese Anweisung ignorieren.
      0 = CLI-Modus aktivieren [Standardeinstellung],
      1 = CLI-Modus deaktivieren.
 "signatures" (Kategorie)
 - Konfiguration der Signaturen.
   %%%_clamav = ClamAV-Signaturen (generelle Signaturen und tägliche Updates).
   %%%_custom = Ihre eigenen Signaturen (sofern Sie welche erstellt haben).
   %%%_mussel = phpMussel-Signaturen, nicht aus der ClamAV-Datenbank.
   - Scan mit den MD5-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Scan mit den generellen Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Scan mit den normierten ASCII Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Scan mit den normierten HTML Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Scan von PE-Dateien (Portable Executable, EXE, DLL, etc.)
     mit den PE-Sectional-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Scan von PE-Dateien (Portable Executable, EXE, DLL, etc.)
     mit den PE-Erweitert-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "pex_custom"
     "pex_mussel"
   - Scan von PE-Dateien (Portable Executable, EXE, DLL, etc.)
     mit den PE-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Scan von ELF-Dateien mit den ELF-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Scan von Mach-O-Dateien (OSX, etc.) mit den Mach-O-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Scan von Bilddateien mit den Grafik-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Scan von Archivinhalten mit den Archiv-Metadata-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Scan von OLE-Objekten mit den OLE-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "ole_clamav"
     "ole_custom"
     "ole_mussel"
   - Scan von Dateinamen mit den Dateinamen-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Scan mit phpMussel_mail() erlauben?
     False = Nein, True = Ja [Standardeinstellung].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Aktivieren Datei-spezifischer Whitelist?
     False = Nein, True = Ja [Standardeinstellung].
     "whitelist_clamav"
     "whitelist_custom"
     "whitelist_mussel"
   - Scan von XML/XDP-Datenblöcken mit den XML/XDP-Datenblock-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "xmlxdp_clamav"
     "xmlxdp_custom"
     "xmlxdp_mussel"
   - Scan mit den Komplex-Erweitert-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "coex_clamav"
     "coex_custom"
     "coex_mussel"
   - Scan mit den PDF-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "pdf_clamav"
     "pdf_custom"
     "pdf_mussel"
   - Scan mit den Shockwave-Signaturen?
     False = Nein, True = Ja [Standardeinstellung].
     "swf_clamav"
     "swf_custom"
     "swf_mussel"
   - Optionen für das Größenlimit der Übereinstimmungen. Ändern Sie diese Werte
     nur, wenn Sie wissen, was Sie tun. SD = Standardsignaturen. RX = PCRE
     (Perl Compatible Regular Expressions, bzw. "Regex")-Signaturen.
     FN = Dateinamen-Signaturen. Sollten Sie bemerken, dass PHP abstürzt, wenn
     phpMussel aktiv wird, setzen Sie die "max"-Werte herab. Informieren Sie
     den Autor, was passiert ist und melden Sie die Ergebnisse Ihrer Versuche
     und Bemühungen.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   "fail_silently"
   - Reaktion von phpMussel auf fehlende oder defekte Signaturen.
     Ist fail_silently deaktiviert, werden fehlende oder defekte Signaturen
     während des Scanvorgangs gemeldet, ist fail_silently aktiviert, werden
     fehlende oder defekte Signaturen ignoriert, ohne dass entsprechende
     Probleme gemeldet werden. Diese Option sollte so belassen werden, es sei
     denn, Sie erwarten Abstürze oder ähnliches.
     0 = Deaktiviert, 1 = Aktiviert [Standardeinstellung].
   "fail_extensions_silently"
   - Soll phpMussel melden, wenn Dateierweiterungen fehlen? Wenn
     fail_extensions_silently deaktiviert ist, werden fehlende
     Dateierweiterungen beim Scannen gemeldet und wenn fail_extensions_silently
     aktiviert ist, werden fehlende Dateierweiterungen ignoriert und beim Scan
     gemeldet, dass es mit diesen Dateien keine Probleme gibt. Das Deaktivieren
     dieser Anweisung kann möglicherweise deine Sicherheit erhöhen, kann aber
     auch zu mehr Falschmeldungen führen.
     0 = Deaktiviert, 1 = Aktiviert [Standardeinstellung].
   "detect_adware"
   - Soll phpMussel Signaturen für die Erkennung von Adware parsen?
     False = Nein, True = Ja [Standardeinstellung].
   "detect_joke_hoax"
   - Soll phpMussel Signaturen für die Erkennung von Scherz/Fake-Malware/Viren
     parsen? False = Nein, True = Ja [Standardeinstellung].
   "detect_pua_pup"
   - Soll phpMussel Signaturen für die Erkennung von PUAs/PUPs parsen?
     False = Nein, True = Ja [Standardeinstellung].
   "detect_packer_packed"
   - Soll phpMussel Signaturen für die Erkennung von Packern und komprimierten
     Daten parsen? False = Nein, True = Ja [Standardeinstellung].
   "detect_shell"
   - Soll phpMussel Signaturen für die Erkennung von Shell-Scripten parsen?
     False = Nein, True = Ja [Standardeinstellung].
   "detect_deface"
   - Soll phpMussel Signaturen für die Erkennung von Defacements und Defacer
     parsen? False = Nein, True = Ja [Standardeinstellung].
 "files" (Kategorie)
 - Generelle Konfigurationen für die Handhabung von Dateien.
   "max_uploads"
   - Maximale erlaubte Anzahl zu überprüfender Dateien während eines
     Dateiuploads bevor der Scan abgebrochen und der Nutzer darüber informiert
     wird, dass er zu viele Dateien auf einmal hochgeladen hat. Bietet einen
     Schutz gegen den theoretischen Angriff eines DDoS auf Ihr System oder CMS,
     indem der Angreifer phpMussel überlastet und den PHP-Prozess zum
     Stillstand bringt. Empfohlen: 10. Sie können den Wert abhängig von Ihrer
     Hardware erhöhen oder senken. Beachten Sie, dass dieser Wert nicht den
     Inhalt von Archiven berücksichtigt.
   "filesize_limit"
   - Begrenzung der Dateigröße in KB. 65536 = 64MB [Standardeinstellung],
     0 = Keine Begrenzung (wird immer zur Greylist hinzugefügt), jeder
     (positive) numerische Wert wird akzeptiert. Dies ist nützlich, wenn Ihre
     PHP-Konfiguration den verfügbaren Speicherverbrauch je Prozess einschränkt
     oder die Dateigröße von Uploads begrenzt.
   "filesize_response"
   - Handhabung von Dateien, die die Begrenzung der Dateigröße (sofern
     angegeben) überschreiten.
     0 - Hinzufügen zur Whitelist,
     1 - Hinzufügen zur Blacklist [Standardeinstellung].
   "filetype_whitelist", "filetype_blacklist", "filetype_greylist"
   - Sofern Ihr System spezielle Dateitypen im Upload erlaubt oder komplett
     verweigert, so unterteilen Sie diese Dateitypen in Whitelists, Blacklists
     oder Greylists, um den Scanvorgang zu beschleunigen, indem diese
     Dateitypen übersprungen werden. Format ist CSV (comma separated values,
     Komma-getrennte Werte). Möchten Sie lieber alles überprüfen lassen, so
     lassen Sie die Variable(n) leer; Dies deaktiviert die
     Whitelist/Blacklist/Greylist. Logische Reihenfolge der Verarbeitung ist:
     - Wenn der Dateityp in der Whitelist ist, scanne und blockieren nicht die
       Datei, und überprüfe nicht wenn die Datei in der Whitelist oder in der
       Greylist ist.
     - Wenn der Dateityp in der Blacklist ist, scanne nicht die Datei aber
       blockieren sie trotzdem, und überprüfe nicht wenn die Datei in
       der Greylist ist.
     - Wenn die Greylist leer ist oder wenn die Greylist nicht leer ist und der
       Dateityp in der Greylist ist, scanne die Datei wie standardmäßig
       eingestellt ist und stelle fest, ob diese blockiert werden soll,
       basierend auf dem Scan, aber wenn die Greylist nicht leer ist und der
       Dateityp nicht in der Greylist ist, behandel die Datei als ob sie in der
       Blacklist ist, scanne sie nicht aber blockiere sie trotzdem.
   "check_archives"
   - Soll der Inhalt von Archiven überprüft werden?
     0 - Nein (keine Überprüfung),
     1 - Ja (wird überprüft) [Standardeinstellung].
     * Zur Zeit wird NUR die Überprüfung von BZ, GZ, LZF und ZIP Archiven
       unterstützt (Überprüfung von RAR, CAB, 7z usw. wird zur Zeit NICHT
       unterstützt).
     * Diese Funktion ist nicht sicher! Es wird dringend empfohlen, diese
       Funktion aktiviert zu lassen, es kann jedoch nicht garantiert werden,
       dass alles entdeckt wird.
     * Die Archivüberprüfung ist derzeit nicht rekursiv für ZIP-Archive.
   "filesize_archives"
   - Soll das Blacklisting/Whitelisting der Dateigröße auf den Inhalt des
     Archivs übertragen werden?
     0 - Nein (alles nur in die Greylist aufnehmen),
     1 - Ja [Standardeinstellung].
   "filetype_archives"
   - Soll das Blacklisting/Whitelisting des Dateityps auf den Inhalt des
     Archivs übertragen werden?
     0 - Nein (alles nur in die Greylist aufnehmen) [Standardeinstellung],
     1 - Ja.
   "max_recursion"
   - Maximale Grenze der Rekursionstiefe von Archiven. Standardwert = 10.
   "block_encrypted_archives"
   - Verschlüsselte Archive erkennen und blockieren? Denn phpMussel ist nicht
     in der Lage, die Inhalte von verschlüsselten Archiven zu scannen. Es ist
     möglich, dass Archiv-Verschlüsselung von Angreifern zum Umgehen von
     phpMussel, Antiviren-Scanner und weiterer solcher Schutzlösungen verwendet
     wird. Die Anweisung, dass phpMussel verschlüsselte Archive blockiert kann
     möglicherweise helfen, die Risiken, die mit dieser Möglichkeit verbunden
     sind, zu verringern.
     0 - Nein, 1 - Ja [Standardeinstellung].
 "attack_specific" (Kategorie)
 - Konfiguration für spezifische Angriffserkennung (nicht auf CVD basierend).
   * Chameleon-Angriffserkennung: 0 = deaktiviert, 1 = aktiviert.
   "chameleon_from_php"
   - Suche nach PHP-Headern in Dateien, die weder PHP-Dateien noch erkannte
     Archive sind.
   "chameleon_from_exe"
   - Suche nach ausführbaren Headern in Dateien, die weder ausführbar noch
     erkannte Archive sind und nach ausführbaren Dateien, deren Header nicht
     korrekt sind.
   "chameleon_to_archive"
   - Suche nach Archiven, deren Header nicht korrekt sind (Unterstützt: BZ, GZ,
     RAR, ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Suche nach Office-Dokumenten, deren Header nicht korrekt sind.
     (Unterstützt: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Suche nach Bildern, deren Header nicht korrekt sind.
     (Unterstützt: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).
   "chameleon_to_pdf"
   - Suche nach PDF-Dateien, deren Header nicht korrekt sind.
   "archive_file_extensions" und "archive_file_extensions_wc"
   - Erkannte Archiv-Dateierweiterungen (Format ist CSV; nur bei Problemen
     hinzufügen oder entfernen; unnötiges Entfernen könnte Fehlalarme für
     Archive auslösen, unnötiges Hinzufügen fügt das zur Whitelist hinzu, was
     vorher als möglicher Angriff definiert wurde; Ändern Sie diese Liste
     äußerst vorsichtig; Beachten Sie, dass dies keinen Einfluß darauf hat,
     wozu Archive fähig sind und nicht auf Inhaltsebene analysiert
     werden können). Diese Liste enthält die Archivformate, die am häufigsten
     von der Mehrzahl der Systeme und CMS verwendet werden, ist aber
     absichtlich nicht vollständig.
   "general_commands"
   - Soll der Inhalt von Dateien auf allgemeine Befehle wie "eval()", "exec()"
     und "include()" durchsucht werden?
     0 - Nein (nicht überprüfen) [Standardeinstellung], 1 - Ja (überprüfen).
     Stellen Sie diese Option aus, wenn Sie vorhaben, folgende Dateien mittels
     Browser auf Ihr System oder CMS hochzuladen: PHP, JavaScript, HTML,
     Python, Perl usw. Aktivieren Sie diese Option, falls Sie keine
     zusätzlichen Schutzmechanismen auf Ihrem System haben und nicht planen,
     solche Dateien hochzuladen. Verwenden Sie zusätzliche Sicherheitssoftware
     in Verbindung mit phpMussel wie ZB Block, ist es nicht notwendig, diese
     Option zu aktivieren, phpMussel würde nur unnötigerweise (im Kontext
     dieser Option) danach suchen, wogegen das System bereits geschützt ist.
   "block_control_characters"
   - Sollen Dateien, welche Steuerzeichen (andere als Newline/Zeilenumbruch)
     enthalten, blockiert werden?
     ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) Sofern Sie -nur- reinen Text hochladen,
     können Sie diese Option aktivieren, um Ihrem System zusätzlichen Schutz zu
     bieten. Sollten Sie anderes als reinen Text hochladen, werden bei
     aktivierter Option Fehlalarme ausgelöst.
     0 - Nicht blockieren [Standardeinstellung], 1 - Blockieren.
   "corrupted_exe"
   - Defekte Dateien und Parse-Errors.
     0 = Ignorieren, 1 = Blockieren [Standardeinstellung].
     Soll auf potentiell defekte ausführbare Dateien (PE - Portable Executable)
     geprüft und diese blockiert werden? Oftmals (aber nicht immer), wenn
     bestimmte Aspekte einer PE-Datei beschädigt sind oder nicht korrekt
     verarbeitet werden können, ist dies ein Hinweis auf eine infizierte Datei.
     Viele Antiviren-Programme nutzen verschiedene Methoden, um Viren in
     solchen Dateien zu erkennen, sofern sich der Programmierer eines Virus
     dieser Tatsache bewußt ist, wird er versuchen, diese Maßnahmen zu
     verhindern, damit der Virus unentdeckt bleibt.
   "decode_threshold"
   - Optionale Beschränkung oder Schwelle der Menge der Rohdaten, die durch den
     Decode-Befehl erkannt werden sollen (sofern während des Scanvorgangs
     spürbare Performance-Probleme auftreten). Der Wert ist ein Integer
     (Ganzzahl) und repräsentiert die Dateigröße in KB. Standardeinstellung ist
     512 (512 KB). Null oder ein Null-Wert deaktiviert die Beschränkung
     (Entfernen aller solcher Einschränkungen basierend auf die Dateigröße).
   "scannable_threshold"
   - Optionale Beschränkung oder Schwelle der Menge der Rohdaten, die phpMussel
     lesen und scannen darf (sofern während des Scanvorgangs spürbare
     Performance-Probleme auftreten). Der Wert ist ein Integer (Ganzzahl) und
     repräsentiert die Dateigröße in KB. Standardeinstellung ist 32768 (32 MB).
     Null oder ein Null-Wert deaktiviert die Beschränkung. Generell sollte
     dieser Wert nicht kleiner sein als die durchschnittliche Dateigröße von
     Datei-Uploads, die Sie auf Ihrem Server oder Ihrer Website erwarten,
     sollte nicht größer sein als die Richtlinie filesize_limit und sollte
     nicht mehr als ein Fünftel der Gesamtspeicherzuweisung für PHP in der
     Konfigurationsdatei php.ini sein. Diese Richtlinie verhindert, dass
     phpMussel zu viel Speicher benutzt (was phpMussel daran hindern würde,
     einen Scan ab einer bestimmten Dateigröße erfolgreich durchzuführen).
 "compatibility" (Kategorie)
 - Kompatibilitätsdirektiven für phpMussel.
   "ignore_upload_errors"
   - Diese Direktive sollte generell AUS geschaltet bleiben sofern es nicht für
     die korrekte Funktion von phpMussel auf Ihrem System benötigt wird.
     Normalerweise, sobald phpMussel bei AUS geschalteter Direktive ein Element
     in $_FILES array() erkennt, wird es beginnen, die Dateien, die diese
     Elemente repräsentieren, zu überprüfen, sollten diese Elemente leer sein,
     gibt phpMussel eine Fehlermeldung zurück. Dies ist das normale Verhalten
     von phpMussel. Bei einigen CMS werden allerdings als normales Verhalten
     leere Elemente in $_FILES zurückgegeben oder Fehlermeldungen ausgelöst,
     sobald sich dort keine leeren Elemente befinden, in diesem Fall tritt ein
     Konflikt zwischen dem normalen Verhalten von phpMussel und dem CMS auf.
     Sollte eine solche Konstellation bei Ihrem CMS zutreffen, so stellen Sie
     diese Option AN, phpMussel wird somit nicht nach leeren Elementen suchen,
     Sie bei einem Fund ignorieren und keine zugehörigen Fehlermeldungen
     ausgeben, der Request zum Seitenaufruf kann somit fortgesetzt werden.
     0 - AUS/OFF, 1 - AN/ON.
   "only_allow_images"
   - Wenn Sie nur Bilder erwarten, die auf Ihr System oder CMS hochgeladen
     werden oder nur Bilder und keine anderen Dateien als Upload erlauben oder
     benötigen, so sollte diese Direktive aktiviert werden (ON), ansonsten
     deaktiviert bleiben (OFF). Ist diese Direktive aktiviert, wird phpMussel
     alle Uploads, die keine Bilddateien sind, blockieren, ohne sie zu scannen.
     Dies kann die Verarbeitungszeit und Speichernutzung reduzieren, sobald
     andere Nicht-Bilddateien hochgeladen werden. 0 - AUS/OFF, 1 - AN/ON.
 "heuristic" (Kategorie)
 - Heuristic-Direktive für phpMussel.
   "threshold"
   - Es gibt bestimmte Signaturen in phpMussel, die dazu dienen, verdächtige
     und potenziell bösartige Eigenschaften von hochgeladenen Dateien zu
     identifizieren, ohne diese Dateien an sich zu überprüfen und als bösartig
     zu identifizieren. Diese Direktive teilt phpMussel mit, welche Gewichtung
     von verdächtigen und potenziell bösartigen Eigenschaften zulässig ist,
     bevor diese Dateien als bösartig gekennzeichnet werden. Die Definition des
     Gewichts ist in diesem Zusammenhang die Gesamtzahl der verdächtigen und
     potenziell bösartigen Eigenschaften. Standardwert ist 3. Ein niedriger
     Wert in der Regel führt zu einem vermehrten Auftreten von Fehlalarmen und
     eine größere Anzahl von schädlichen Dateien werden erkannt, während ein
     höherer Wert weniger Fehlalarme auslöst und eine geringere Anzahl von
     schädlichen Dateien markiert werden. Dieser Wert sollte so belassen
     werden, es sei denn, Sie erkennen Probleme, die durch diese Einstellung
     hervorgerufen werden.
 "virustotal" (Kategorie)
 - Konfiguration für Virus Total Integration.
   "vt_public_api_key"
   - Optional, phpMussel kann Dateien mit der Virus Total API scannen, um einen
     noch besseren Schutz gegen Viren, Trojaner, Malware und andere Bedrohungen
     zu bieten. Standardmäßig ist das Scannen von Dateien mit der Virus Total
     API deaktiviert. Um es zu aktivieren, wird ein API Schlüssel von Virus
     Total benötigt. Wegen dem großen Vorteil den dir das bietet, empfehle ich
     die Aktivierung. Bitte sei dir bewusst, um die Virus Total API zu nutzen,
     dass du deren Nutzungsbedingungen zustimmen und dich an alle Richtlinien
     halten musst, wie es in der Virus Total Dokumentation beschrieben ist! Du
     darfst diese Integrations-Funktion nicht verwenden AUSSER:
     A) Du hast die Nutzungsbedingungen von Virus Total und der API gelesen und
        stimmst diesen zu. Die Nutzungsbedingungen von Virus Total und der API
        findet man hier:
        <https://www.virustotal.com/en/about/terms-of-service/>.
     B) Du hast, zu einem Minimum, das Vorwort von der Virus Total Public API
        Dokumentation gelesen und und verstanden (alles nach "Virus Total
        Public API v2.0" aber vor "Contents"). Die Virus Total Public API
        Dokumentation findet man hier:
        <https://www.virustotal.com/en/documentation/public-api/>.
     Anmerkung: Falls das Scannen von Dateien mit der Virus Total API
     deaktiviert ist, brauchst du keine der Direktiven in dieser Kategorie
     ("virustotal") zu überprüfen, weil keine davon etwas machen wenn dies
     deaktiviert ist. Um einen Virus Total API Schlüssel zu erhalten, klicke
     auf deren Webseite auf den "Treten Sie unserer Community bei" Link oben
     rechts auf der Seite, gebe die geforderten Daten an und klick auf
     "Anmelden" wenn du fertig bist. Folge allen Anweisungen und wenn du deinen
     öffentlichen API Schlüssel hast, kopier eund füge den öffentlichen API
     Schlüssel bei der "vt_public_api_key" Direktive der "phpmussel.ini"
     Konfigurations-Datei ein.
   "vt_suspicion_level"
   - phpMussel wird standardmäßig die mit der Virus Total API zu scannenden
     Dateien auf Dateien eisnchränken, die es als "verdächtig" betrachtet. Du
     kannst optional diese Einschränkung durch Änderung des Wertes der
     "vt_suspicion_level" Direktive anpassen.
     0 - Dateien werden nur als verdächtig betrachtet, falls durch den Scan mit
         phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung
         haben. Das würde bdeuten, dass die Verwendung der Virus Total API für
         eine zweite Meinung ist, wenn phpMussel eine Datei verdächtigt, dass
         diese schädlich ist aber nicht vollkommen ausschließen kann, dass
         diese potentiell harmlos (nicht schädlich) und somit diese
         andererseits normalerweise nicht blockieren oder als schädlich
         markieren würde.
     1 - Dateien werden als verdächtig betrachtet, falls durch den Scan mit
         phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung
         haben, falls diese eine ausführbare Datei (PE Dateien, Mach-O Dateien,
         ELF/Linux Dateien, usw.), oder ein Format sind, das ausführbare Daten
         enthalten könnte (solche wie ausführbare Makros, DOC/DOCX Dateien,
         Archivdateien wie RAR, ZIP und usw). Das ist die normale und
         empfohlene Verdachts-Stufe, was bedeutet, dass die Virus Total API für
         eine zweite Meinung genutzt wird, wenn phpMussel in einer als
         verdächtig betrachteten Datei nichts schädliches oder unstimmiges
         findet, die es als verdächtig ansieht und somit normalerweise nicht
         blockieren oder als schädlich markieren würde.
     2 - Alle Dateien werden als verdächtig angesehen und sollten mit der Virus
         Total API gescannt werden. Ich empfehle nicht, diese Verdachts-Stufe
         anzuwenden, da dadurch eine schnellere Erreichung des API Limits
         riskiert wird, als es normalerweise der Fall wäre. Aber es gibt
         bestimmte Umstände (zB wenn der Webmaster oder Hostmaster sehr wenig
         Vertrauen in die hochgeladenen Inhalte der Nutzer hat) wo diese
         Verdachts-Stufe angemessen sein könnte. Mit dieser Verdachts-Stufe
         werden alle Dateien, die normalerweise nicht blockiert oder als
         schädlich markiert würden, mit der Virus Total API gescannt. Beachte,
         dass phpMussel die Virus Total API nicht nutzen wird, wenn dein API
         Limit erreicht ist (unabhängig von der Verdachts-Stufe) und dass dein
         Limit wahrscheinlich schneller erreicht wird, wenn diese Verdachts-
         Stufe verwendet wird.
     Hinweis: Unabhängig von der Verdachts-Stufe wird jede Datei auf der
     Whitelist oder der Blacklist nicht durch phpMussel mit der Virus Total API
     gescannt, da diese Dateien bereits als schädlich oder harmlos deklariert
     wurden und ansonste gescannt würden, und somit zusätzliches Scannen nicht
     erforderlich ist. Die Möglichkeit von phpMussel Dateien mit der Virus
     Total API zu scannen ist dafür gedacht, weiteres Vertrauen aufzubauen, ob
     eine Datei unter den Umständen schädlich oder harmlost ist, wo phpMussel
     sich selber nicht sicher ist ob eine Datei schädlich oder harmlos ist.
   "vt_weighting"
   - Soll phpMussel die Ergebnisse des Scans mit der Virus Total API als
     Erkennungen oder Erkennungs-Gewichtung anwenden? Diese Direktive
     existiert, weil das Scannen einer Datei mit mehreren Engines (wie es
     Virus Total macht) in einer höheren Erkennungsrate resultieren sollte (und
     somit eine größere Anzahl schädlicher Dateien erwischt werden), dies kann
     aber zu in einer höheren Anzahl von Falschmeldungen führen. Unter manchen
     Umständen würden die Ergebnisse des Scans besser als Vertrauens-Wert als
     ein eindeutiges Ergebnis verwendet werden. Wenn der Wert 0 verwendet wird,
     werden die Ergebnisse des Scans als Erkennungen angewendet und somit wird
     phpMussel, falls irgendeine von Virus Total verwendete Engine die
     gescannte Datei als schädlich markiert, die Datei als schädlich
     betrachten. Wird ein anderer Wert verwendet, werden die Ergebnisse des
     Scans mit der Virus Total API als Erkennungs-Gewichtung angewendet. Die
     Anzahl der von Virus Total verwendeten Engines, welche die Datei als
     schädlich markieren, wird als Vertrauens-Wert (oder Erkennungs-Gewichtung)
     dienen, ob die gescannte Datei von phpMussel als schädlich angesehen
     werden soll (der verwendete Wert wird den Mindest-Vertrauens-Wert oder
     erforderliche Gewichtung repräsentieren, um als schädlich angesehen zu
     werden. Standardmäßig der Wert 0 verwendet.
   "vt_quota_rate" und "vt_quota_time"
   - Laut der Virus Total API Dokumentation, "ist diese auf 4 Anfragen
     irgendeiner Art in einer 1 Minuten Zeitspanne limitiert. Falls du einen
     Honeyclient, Honeypot oder einen andere Automatisierung verwendest, was
     etwas zu VirusTotal beiträgt und nicht nur Berichte abruft, bist du für
     ein höheres Limit berechtigt". Standardmäßig wird sich phpMussel strikt
     daran halten, da aber diese Limits erhöht werden können, stehen dir diese
     zwei Direktiven zur Verfügung um phpMussel anzuweisen, an welches Limit es
     sich halten soll. Außer du bist dazu aufgefordert, ist es nicht empfohlen
     diese Werte zu erhöhen. Solltest du aber Probleme bezogen auf das
     Erreichen des Limits haben, -sollte- das Verringern dieser Werte manchmal
     helfen. Dein Limit wird festgelegt als "vt_quota_rate" Anfragen jeder Art
     in jeder "vt_quota_time" Minuten Zeitspanne.
 "template_data" (Kategorie)
 - Anweisungen/Variablen für Templates und Themes: Template-Daten bezieht sich
   auf die HTML-Ausgabe die verwendet wird, um die "Upload blockiert"-Nachricht
   Benutzern anzuzeigen, wenn eine hochgeladene Datei blockiert wird. Falls Sie
   benutzerdefinierte Themes für phpMussel verwenden, wird die HTML-Ausgabe von
   der "template_custom.html"-Datei verwendet, ansonsten wird die HTML-Ausgabe
   von der "template.html"-Datei verwendet. Variablen, die in diesem Bereich
   der Konfigurations-Datei festgelegt werden, werden als HTML-Ausgabe geparst,
   indem jede Variable mit geschweiften Klammern innerhalb der HTML-Ausgabe mit
   den entsprechenden Variablen-Daten ersetzt wird. Zum Beispiel, wenn
   foo="bar", dann wird jedes Exemplar mit <p>{foo}</p> innerhalb der
   HTML-Ausgabe zu <p>bar</p>.
   "css_url"
   - Die Template-Datei für benutzerdefinierte Themes verwendet externe CSS-
     Regeln, wobei die Template-Datei für das normale Theme interne CSS-Regeln
     verwendet. Um phpMussel anzuweisen, die Template-Datei für
     benutzerdefinierte Themes zu verwenden, geben Sie die öffentliche
     HTTP-Adresse von den CSS-Dateien des benutzerdefinierten Themes mit der
     "css_url"-Variable an. Wenn Sie diese Variable leer lassen, wird phpMussel
     die Template-Datei für das normale Theme verwenden.

                                     ~ ~ ~


 7. SIGNATURENFORMAT

 = DATEINAMEN-SIGNATUREN =
   Alle Dateinamen-Signaturen besitzen folgendes Format:
    NAME:FNRX
   NAME ist der Name, um die Signatur zu benennen und FNRX ist das
   Regex-Erkennungsmuster zum Vergleich von (nicht kodierten) Dateinamen.

 = MD5-SIGNATUREN =
   Alle MD5-Signaturen besitzen folgendes Format:
    HASH:FILESIZE:NAME
   HASH ist der MD5-Hash der ganzen Datei, FILESIZE ist die gesamte Größe der
   Datei und NAME ist der Name, um die Signatur zu benennen.

 = ARCHIV-METADATA-SIGNATUREN =
   Alle Archiv-Metadata-Signaturen besitzen folgendes Format:
    NAME:FILESIZE:CRC32
   NAME ist der Name, um die Signatur zu benennen, FILESIZE ist die gesamte
   Größe (unkomprimiert) einer jeden Datei im Archiv und CRC32 ist die
   CRC32-Prüfsumme jeder einzelnen Datei im Archiv.

 = PE-SECTIONAL-SIGNATUREN =
   Alle PE-Sectional-Signaturen besitzen folgendes Format:
    SIZE:HASH:NAME
   HASH ist der MD5-Hash einer PE-Sektion der Datei, FILESIZE ist die gesamte
   Größe der PE-Sektion und NAME ist der Name, um die Signatur zu benennen.

 = PE-ERWEITERT-SIGNATUREN =
   Alle PE-Erweitert-Signaturen besitzen folgendes Format:
    $VAR:HASH:SIZE:NAME
   Wo $VAR der Name der zu prüfenden PE-Variable  ist, HASH ist der MD5-Hash
   von dieser Variable, SIZE ist die gesamte Größe von dieser Variable und NAME
   ist der Name für diese Signatur.

 = WHITELIST-SIGNATUREN =
   Alle Whitelist-Signaturen besitzen folgendes Format:
    HASH:FILESIZE:NAME
   HASH ist der MD5-Hash der ganzen Datei, FILESIZE ist die gesamte Größe der
   Datei und TYPE ist der Signaturtyp der whitegelisteten Datei, gegen die sie
   immun ist.

 = KOMPLEX-ERWEITERT-SIGNATUREN =
   Komplex-Erweitert-Signaturen sind ziemlich unterschiedlich zu anderen Arten
   von möglichen Signaturen für phpMussel. Insofern, dass sie gegen das
   übereinstimmen was die Signaturen spezifizieren und das können mehrere
   Kriterien sein. Die Übereinstimmungs-Kriterien werden durch ";" getrennt und
   der Übereinstimmungs-Typ und die Übereinstimmungs-Daten jedes
   Übereinstimmungskriteriums ist durch ":" getrennt sodass das Format für
   diese Signaturen in etwa so aussieht:
    $variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName

 = ALLE SONSTIGEN SIGNATUREN =
   Alle sonstigen Signaturen besitzen folgendes Format:
    NAME:HEX:FROM:TO
   NAME ist der Name, um die Signatur zu benennen und HEX ist ein
   hexidezimal-kodiertes Segment der Datei, welches mit der gegebenen
   Signatur geprüft werden soll. FROM und TO sind optionale Parameter, sie
   geben Start- und Endpunkt in den Quelldaten zur Überprüfung an (wird nicht
   von der Mail-Funktion unterstützt).

 = REGEX =
   Jede Form von regulären Ausdrücken, die von PHP verstanden und korrekt
   ausgeführt werden, sollten auch von phpMussel und den Signaturen verstanden
   und korrekt ausgeführt werden können. Lassen Sie extreme Vorsicht walten,
   wenn Sie neue Signaturen schreiben, die auf regulären Ausdrücken basieren.
   Wenn Sie nicht absolut sicher sind, was Sie dort machen, kann dies zu nicht
   korrekten und/oder unerwarteten Ergebnissen führen. Schauen Sie im Quelltext
   von phpMussel nach, wenn Sie sich nicht absolut sicher sind, wie die
   regulären Ausdrücke verarbeitet werden. Beachten Sie bitte, dass alle
   Suchmuster (außer Dateinamen, Archive-Metadata and MD5-Prüfmuster)
   hexadezimal kodiert sein müssen (mit Ausnahme von Syntax, natürlich)!

 = WO WERDEN EIGENE SIGNATUREN ABGELEGT? =
   Legen Sie Ihre eigenen Signaturen nur in den Dateien ab, die dafür
   vorgesehen sind. Diese Dateien sollten "_custom" im Dateinamen enthalten.
   Sie sollten es vermeiden, die Standard-Signaturen direkt zu bearbeiten,
   sofern Sie nicht genau wissen, was Sie dort tun. Eigene Signaturdateien
   helfen Ihnen, zwischen Ihren und den von phpMussel mitgelieferten Signaturen
   zu unterscheiden. Führen Sie Änderungen an den von phpMussel mitgelieferten
   Signaturen durch, ist es möglich, dass diese nicht mehr richtig ausgeführt
   werden können, da die Map-Dateien, sofern Sie für verschiedene Operationen
   angefordert werden, nicht mehr mit den zugehörigen Signaturen synchronisiert
   sind. Sie können alles in Ihre eigenen Signaturen eintragen, sofern es der
   richtigen Syntax entspricht. Achten Sie darauf, neue Signaturen gründlich zu
   testen, bevor Sie sie mit anderen teilen oder in einer Live-Umgebung
   einsetzen.

 = AUFSCHLÜSSELUNG DER SIGNATUREN =
   Im Folgenden eine Aufschlüsselung der Signaturen, die von phpMussel genutzt
   werden:
   - "Normierte ASCII-Signaturen" (ascii_*). Überprüft den Inhalt jeder Datei,
      die nicht in der Whitelist aufgeführt ist und überprüft werden soll.
   - "Komplex-Erweitert-Signaturen" (coex_*). Mischsignaturtyp
      Datei-Überprüfungen.
   - "ELF-Signaturen" (elf_*). Überprüft den Inhalt jeder Datei, die nicht in
      der Whitelist aufgeführt ist und überprüft werden soll und dem ELF-Format
      entspricht.
   - "Portable-Executable-Signaturen" (exe_*). Überprüft den Inhalt jeder
      Datei, die nicht in der Whitelist aufgeführt ist und überprüft werden
      soll und dem PE-Format entspricht.
   - "Dateinamen-Signaturen" (filenames_*). Überprüft die Dateinamen jeder
      Datei, die nicht in der Whitelist aufgeführt ist und überprüft werden
      soll.
   - "Allgemeine Signaturen" (general_*). Überprüft den Inhalt jeder Datei, die
      nicht in der Whitelist aufgeführt ist und überprüft werden soll.
   - "Grafiksignaturen" (graphics_*). Überprüft den Inhalt jeder Datei, die
      nicht in der Whitelist aufgeführt ist und überprüft werden soll und einem
      bekannten Bildformat entspricht.
   - "Allgemeine Befehle" (hex_general_commands.csv). Überprüft den Inhalt
      jeder Datei, die nicht in der Whitelist aufgeführt ist und überprüft
      werden soll.
   - "Normierte HTML-Signaturen" (html_*). Überprüft den Inhalt jeder
      HTML-Datei, die nicht in der Whitelist aufgeführt ist und überprüft
      werden soll.
   - "Mach-O-Signaturen" (macho_*). Überprüft den Inhalt jeder Datei, die nicht
      in der Whitelist aufgeführt ist und überprüft werden soll und dem
      Mach-O-Format entspricht.
   - "Email-Signaturen" (mail_*). Überprüft mittels der Funktion
      phpMussel_mail() die Variable $body von E-Mail-Nachrichten oder ähnlichen
      Einträgen (Foreneinträge etc.).
   - "MD5-Signaturen" (md5_*). Überprüft mittels MD5-Hash des Inhalts und der
      Dateigröße jede Datei, die nicht in der Whitelist aufgeführt ist und
      überprüft werden soll.
   - "Archiv-Metadata-Signaturen" (metadata_*). Überprüft die CRC32-Prüfsumme
      und Dateigröße der ersten Datei in jedem Archiv, welche nicht in der
      Whitelist aufgeführt ist und überprüft werden soll.
   - "OLE-Signaturen" (ole_*). Überprüft den Inhalt jeder Objekten, die nicht
      in der Whitelist aufgeführt ist.
   - "PDF-Signaturen" (pdf_*). Überprüft den Inhalt jeder PDF-Dateien, die
      nicht in der Whitelist aufgeführt ist.
   - "Portable-Executable-Sectional-Signaturen" (pe_*). Überprüft mittels der
      Größe und MD5-Hash der PE-Sektionen jeder Datei, die nicht in der
      Whitelist aufgeführt ist und überprüft werden soll und dem PE-Format
      entspricht.
   - "Portable-Executable-Erweitert-Signaturen" (pex_*). Überprüft mittels der
      Größe und MD5-Hash der Variablen jeder Datei, die nicht in der Whitelist
      aufgeführt ist und überprüft werden soll und dem PE-Format entspricht.
   - "Shockwave-Signaturen" (swf_*). Überprüft den Inhalt jeder
      Shockwave-Datei, die nicht in der Whitelist aufgeführt ist.
   - "Whitelist-Signaturen" (whitelist_*). Überprüft mittels MD5-Hash des
      Inhalts und der Dateigröße jede Datei. Übereinstimmende Dateien werden
      immun gegen die Art der Signaturen in dem Whitelist-Eintrag.
   - "XML/XDP-Datenblock-Signaturen" (xmlxdp_*). Überprüft XML/XDP-Datenblöcke
      aus jeder Datei, die nicht in der Whitelist aufgeführt ist und überprüft
      werden soll.
   (Beachten Sie, dass jede dieser Signaturen auf einfache Weise in der
    "phpmussel.ini" deaktiviert werden kann).

                                     ~ ~ ~


 8. BEKANNTE KOMPATIBILITÄTSPROBLEME

 PHP und PCRE
 - phpMussel benötigt PHP und PCRE, um ausgeführt werden zu können. Ohne PHP
   und ohne die PCRE-Erweiterungen von PHP, kann phpMussel nicht oder nicht
   ordnungsgemäß ausgeführt werden. Stellen Sie sicher, dass auf Ihrem System
   PHP und PCRE installiert und verfügbar ist, bevor Sie phpMussel
   herunterladen und installieren.

 KOMPATIBILITÄT ZU ANTIVIREN-SOFTWARE

 In den meisten Fällen sollte phpMussel mit den meisten anderen
 Antiviren-Softwareprodukten kompatibel sein. Jedoch wurden in der
 Vergangenheit Konflikte von anderen Nutzern festgestellt. Die folgenden
 Informationen stammen von VirusTotal.com, welche einige Fehlalarme von
 verschiedenen Antiviren-Programmen gegen phpMussel beschreiben. Diese
 Informationen garantieren nicht, ob Kompatibilitätsprobleme zwischen phpMussel
 und Ihrem eingesetzten Antiviren-Produkt bestehen. Sollte Ihre
 Antiviren-Software als problematisch aufgelistet sein, sollten Sie diese
 entweder vor der Benutzung von phpMussel deaktivieren oder sich andere
 Alternativen überlegen.

 Diese Informationen wurden zuletzt am 2015.07.09 aktualisiert und gelten für
 alle phpMussel Veröffentlichungen von den beiden letzten Nebenversionen
 (v0.6-v0.7a) zu diesem Zeitpunkt.

 Ad-Aware                Keine bekannten Probleme
 Agnitum                 Keine bekannten Probleme
 AhnLab-V3               Keine bekannten Probleme
 AntiVir                 Keine bekannten Probleme
 Antiy-AVL               Keine bekannten Probleme
 Avast                !  Meldet "JS:ScriptSH-inf [Trj]"
 AVG                     Keine bekannten Probleme
 Baidu-International     Keine bekannten Probleme
 BitDefender             Keine bekannten Probleme
 Bkav                 !  Meldet "VEXDAD2.Webshell"
 ByteHero                Keine bekannten Probleme
 CAT-QuickHeal           Keine bekannten Probleme
 ClamAV                  Keine bekannten Probleme
 CMC                     Keine bekannten Probleme
 Commtouch               Keine bekannten Probleme
 Comodo                  Keine bekannten Probleme
 DrWeb                   Keine bekannten Probleme
 Emsisoft                Keine bekannten Probleme
 ESET-NOD32              Keine bekannten Probleme
 F-Prot                  Keine bekannten Probleme
 F-Secure                Keine bekannten Probleme
 Fortinet                Keine bekannten Probleme
 GData                   Keine bekannten Probleme
 Ikarus                  Keine bekannten Probleme
 Jiangmin                Keine bekannten Probleme
 K7AntiVirus             Keine bekannten Probleme
 K7GW                    Keine bekannten Probleme
 Kaspersky               Keine bekannten Probleme
 Kingsoft                Keine bekannten Probleme
 Malwarebytes            Keine bekannten Probleme
 McAfee               !  Meldet "New Script.c"
 McAfee-GW-Edition    !  Meldet "New Script.c"
 Microsoft               Keine bekannten Probleme
 MicroWorld-eScan        Keine bekannten Probleme
 NANO-Antivirus          Keine bekannten Probleme
 Norman                  Keine bekannten Probleme
 nProtect                Keine bekannten Probleme
 Panda                   Keine bekannten Probleme
 Qihoo-360               Keine bekannten Probleme
 Rising                  Keine bekannten Probleme
 Sophos                  Keine bekannten Probleme
 SUPERAntiSpyware        Keine bekannten Probleme
 Symantec                Keine bekannten Probleme
 TheHacker               Keine bekannten Probleme
 TotalDefense            Keine bekannten Probleme
 TrendMicro              Keine bekannten Probleme
 TrendMicro-HouseCall    Keine bekannten Probleme
 VBA32                   Keine bekannten Probleme
 VIPRE                   Keine bekannten Probleme
 ViRobot                 Keine bekannten Probleme

                                     ~ ~ ~


Zuletzt aktualisiert: 11. September 2015 (2015.09.11).
EOF
