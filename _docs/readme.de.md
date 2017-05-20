## Dokumentation für phpMussel (Deutsch).

### Inhalt
- 1. [VORWORT](#SECTION1)
- 2. [INSTALLATION](#SECTION2)
- 3. [BENUTZUNG](#SECTION3)
- 4. [FRONT-END-MANAGEMENT](#SECTION4)
- 5. [CLI (BEFEHLSZEILENMODUS)](#SECTION5)
- 6. [IM PAKET ENTHALTENE DATEIEN](#SECTION6)
- 7. [EINSTELLUNGEN](#SECTION7)
- 8. [SIGNATURENFORMAT](#SECTION8)
- 9. [BEKANNTE KOMPATIBILITÄTSPROBLEME](#SECTION9)
- 10. [HÄUFIG GESTELLTE FRAGEN (FAQ)](#SECTION10)

*Hinweis für Übersetzungen: Im Falle von Fehlern (z.B, Diskrepanzen zwischen den Übersetzungen, Tippfehler, u.s.w.), die Englische Version des README als die ursprüngliche und maßgebliche Version ist betrachtet. Wenn Sie irgendwelche Fehler finden, ihre Hilfe bei der Korrektur wäre willkommen.*

---


### 1. <a name="SECTION1"></a>VORWORT

Vielen Dank für die Benutzung von phpMussel, einem PHP-Script, um Trojaner, Viren, Malware und andere Bedrohungen in Dateien zu entdecken, die auf Ihr System hochgeladen werden könnten, welches die Signaturen von ClamAV und weitere nutzt.

PHPMUSSEL COPYRIGHT 2013 und darüber hinaus GNU/GPLv2 by Caleb M (Maikuolan).

Dieses Skript ist freie Software; Sie können Sie weitergeben und/oder modifizieren unter den Bedingungen der GNU General Public License, wie von der Free Software Foundation veröffentlicht; entweder unter Version 2 der Lizenz oder (nach Ihrer Wahl) jeder späteren Version. Dieses Skript wird in der Hoffnung verteilt, dass es nützlich sein wird, allerdings OHNE JEGLICHE GARANTIE; ohne implizite Garantien für VERMARKTUNG/VERKAUF/VERTRIEB oder FÜR EINEN BESTIMMTEN ZWECK. Lesen Sie die GNU General Public License für weitere Details, in der Datei `LICENSE.txt`, ebenfalls verfügbar auf:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Besonderer Dank geht an [ClamAV](http://www.clamav.net/) für die Inspiration und die Signaturen, die dieses Script benutzt, ohne die dieses Script wahrscheinlich nicht existieren würde oder bestenfalls einen sehr begrenzten Wert hätte.

Besonderer Dank geht auch an Sourceforge und GitHub für das Hosten der Projektdateien, an [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) für die phpMussel Diskussionforen, und an die weiteren Quellen einiger von phpMussel verwendeten Signaturen: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) und andere, und Besonderer Dank geht an alle diejenigen die das Projekt unterstützen werden, an andere nicht erwähnte Personen, und an Sie, für die Verwendung des Scripts.

Dieses Dokument und das zugehörige Paket kann von folgenden Links kostenlos heruntergeladen werden:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


### 2. <a name="SECTION2"></a>INSTALLATION

#### 2.0 MANUELL INSTALLIEREN (SERVER)

1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC. Erstellen Sie ein Verzeichnis, wohin Sie den Inhalt dieses Paketes auf Ihrem Host oder CMS installieren möchten. Ein Verzeichnis wie `/public_html/phpmussel/` o.ä. genügt, solange es Ihren Sicherheitsbedürfnissen oder persönlichen Präferenzen entspricht.

2) Die Datei `config.ini.RenameMe` (im `vault`-Verzeichnis) zu `config.ini` umbenennen, und optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender ohne entsprechende Kenntnisse), öffnen Sie diese Datei (diese Datei beinhaltet alle funktionalen Optionen für phpMussel; über jeder Option beschreibt ein kurzer Kommentar die Aufgabe dieser Option). Verändern Sie die Werte nach Ihren Bedürfnissen. Speichern und schließen Sie die Datei.

3) Laden Sie den kompletten Inhalt (phpMussel und die Dateien) in das Verzeichnis hoch, für das Sie sich in Schritt 1 entschieden haben. Die Dateien `*.txt`/`*.md` müssen nicht mit hochgeladen werden.

4) Ändern Sie die Zugriffsberechtigungen des `vault`-Verzeichnisses auf "755" (wenn es Probleme gibt, Sie können "777" versuchen; Dies ist weniger sicher, obwohl). Die Berechtigungen des übergeordneten Verzeichnises, in welchem sich der Inhalt befindet (das Verzeichnis, wofür Sie sich entschieden haben), können so belassen werden, überprüfen Sie jedoch die Berechtigungen, wenn in der Vergangenheit Zugriffsprobleme aufgetreten sind (Voreinstellung "755" o.ä.).

5) Binden Sie phpMussel in Ihr System oder CMS ein. Es gibt viele verschiedene Möglichkeiten, ein Script wie phpMussel einzubinden, am einfachsten ist es, das Script am Anfang einer Haupt-Datei (eine Datei, die immer geladen wird, wenn irgend eine beliebige Seite Ihres Webauftritts aufgerufen wird) Ihres Systems oder CMS mit Hilfe des require- oder include-Befehls einzubinden. Üblicherweise wird eine solche Datei in Verzeichnissen wie `/includes`, `/assets` or `/functions` gespeichert und wird häufig `init.php`, `common_functions.php`, `functions.php` o.ä. genannt. Sie müssen herausfinden, welche Datei dies für Ihre Bedürfnisse ist; Wenn Sie dabei Schwierigkeiten haben das herauszufinden, besuchen Sie die phpMussel Issues-Seite oder die phpMussel Support-Foren und lassen Sie es uns wissen; Es ist möglich, dass entweder ich oder ein anderer Benutzer mit dem CMS, das Sie verwenden, Erfahrung hat (Sie müssen Sie mitteilen, welche CMS Sie verwenden) und möglicherweise in der Lage ist, etwas Unterstützung anzubieten. Fügen Sie in dieser Datei folgenden Code direkt am Anfang ein:

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Ersetzen Sie den String zwischen den Anführungszeichen mit dem lokalen Pfad der Datei `loader.php`, nicht mit der HTTP-Adresse (ähnlich dem Pfad für das `vault`-Verzeichnis). Speichern und schließen Sie die Datei, laden Sie sie ggf. erneut hoch.

-- ODER ALTERNATIV --

Wenn Sie einen Apache-Webserver haben und wenn Sie Zugriff auf die `php.ini` oder eine ähnliche Datei haben, dann können Sie die `auto_prepend_file` Direktive verwenden um phpMussel voranstellen wenn eine PHP-Anfrage erfolgt. Ungefähr so:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Oder das in der `.htaccess` Datei:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das Programm auf ordnungsgemäße Funktion testen. Sie sollten nun die im Paket enthaltenen Testdateien `_testfiles` auf Ihre Webseite über die gewöhnlichen browserbasierten Methoden hochladen. Funktioniert das Programm ordnungsgemäß, erscheint eine Meldung von phpMussel, dass der Upload erfolgreich blockiert wurde. Erscheint keine Meldung, funktioniert das Programm nicht korrekt. Nutzen Sie andere erweiterte Funktionen oder weitere mögliche Arten von Scannern dieses Programms, so sollten Sie diese ebenfalls testen, um die ordnungsgemäße Funktion sicherzustellen.

#### 2.1 MANUELL INSTALLIEREN (CLI - BEFEHLSZEILENMODUS)

1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC in ein Verzeichnis, das Ihren Sicherheitsbedürfnissen oder persönlichen Präferenzen entspricht.

2) phpMussel benötigt eine installierte PHP-Umgebung, um ausgeführt werden zu können. Sofern PHP bei Ihnen nicht installiert ist, installieren Sie es bitte nach den Anweisungen des PHP-Installers.

3) Optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender ohne entsprechende Kenntnisse), öffnen Sie die Datei `config.ini` im `vault`-Verzeichnis) - Diese Datei beinhaltet alle funktionalen Optionen für phpMussel. Über jeder Option beschreibt ein kurzer Kommentar die Aufgabe dieser Option. Verändern Sie die Werte nach Ihren Bedürfnissen. Speichern und schließen Sie die Datei.

4) Optional, Sie können den Start von phpMussel vereinfachen, indem Sie mittels einer Stapelverarbeitungsdatei PHP und phpMussel automatisch laden. Öffnen Sie einen einfachen Texteditor wie Editor oder Notepad++, tragen Sie den vollständigen Pfad zu Ihrer `php.exe` im Verzeichnis Ihrer PHP-Installation ein, gefolgt von einem Leerzeichen und dem vollständigen Pfad zur `loader.php` im Verzeichnis Ihrer phpMussel-Installation, speichern diese Datei mit einer `.bat`-Dateierweiterung an einem Ort, wo Sie sie leicht finden können und führen Sie sie zukünfig nur noch mit einem Doppelklick aus.

5) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das Programm auf ordnungsgemäße Funktion testen. Um den Test durchzuführen, führen Sie bitte phpMussel aus und versuchen Sie, das Verzeichnis `_testfiles` in diesem Installationspaket zu scannen.

#### 2.2 INSTALLATION MIT COMPOSER

[phpMussel ist bei Packagist registriert](https://packagist.org/packages/maikuolan/phpmussel), und so, wenn Sie mit Composer vertraut sind, können Sie Composer verwenden, um phpMussel zu installieren (musst Sie dennoch die Konfiguration und Hooks aber vorbereiten; Siehe "manuell installieren (server)" der Schritte 2 und 5).

`composer require maikuolan/phpmussel`

---


### 3. <a name="SECTION3"></a>BENUTZUNG

#### 3.0 BENUTZUNG (SERVER)

phpMussel ist dafür vorgesehen, fast vollständig autonom zu funktionieren, ohne dass Sie etwas tun müssen: Sobald es installiert ist, führt es die Tätigkeiten allein aus.

Das Scannen von Dateiuploads ist automatisiert und standardmäßig eingeschaltet, Sie müssen nichts weiter unternehmen.

Sie sind jedoch auch in der Lage, phpMussel anzuweisen, spezifische Dateien, Ordner und/oder Archive zu scannen. Um dies auszuführen, stellen Sie sicher, dass diese Konfiguration in der `config.ini` festgelegt ist (`cleanup` muss deaktiviert sein). Erstellen Sie eine mit phpMussel eingebundene PHP-Datei mit folgender Closure:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` kann ein String, ein Array oder ein Array von Arrays sein und gibt an, welche Datei, Dateien, Ordner und/oder Ordner gescannt werden sollen.
- `$output_type` ist ein boolescher Wert und gibt an, in welchem Format die Scan-Ergebnisse zurückgegeben werden sollen. False weist die Funktion an, Ergebnisse als Integer (Ganzzahl) zurückzugeben (ein Rückgabewert von -3 zeigt an, dass es Probleme mit den phpMussel Signatur-Dateien oder Signatur-Map-Dateien gibt und dass sie wahrscheinlich fehlen oder beschädigt sind, -2 zeigt an, dass beschädigte Dateien gefunden wurden und der Scan nicht abgeschlossen wurde, -1 zeigt an, dass fehlende Erweiterungen oder Addons von PHP benötigt werden, um den Scan durchzuführen und der Scan deshalb nicht abgeschlossen wurde, 0 zeigt an, dass das Ziel nicht existiert und somit nichts überprüft werden konnte, 1 zeigt an, dass das Ziel erfolgreich geprüft wurde und keine Probleme erkannt wurden, 2 zeigt an, dass das Ziel erfolgreich geprüft wurde, jedoch Probleme gefunden wurden). True weist die Funktion an, Ergebnisse als lesbaren Text zurückzugeben. Zusätzlich können in beiden Fällen auf die Ergebnisse über globale Variablen nach dem Scannen zugegriffen werden. Diese Variable ist optional und standardmäßig auf false.
- `$output_flatness` ist ein boolescher Wert und gibt der Funktion an, ob die Ergebnisse vom Scannen (falls mehrere Scan-Ziele existieren) als Array oder String zurückgegeben werden sollen. False wird die Ergebnisse als Array zurückgeben. True wird die Ergebnisse als String zurückgeben. Diese Variable ist optional und standardmäßig auf false.

Beispiel:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Gibt so etwas wie dies (als ein String):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Gestartet.
 > Überprüfung '/user_name/public_html/my_file.html':
 -> Keine Probleme gefunden.
 Wed, 16 Sep 2013 02:49:47 +0000 Fertig.
```

Eine vollständige Liste der Signaturen, die phpMussel nutzt und wie diese verarbeitet werden, finden Sie im Abschnitt SIGNATURENFORMAT.

Sollten irgendwelche Fehlalarme auftreten, Sie etwas entdecken, was Ihrer Meinung nach blockiert werden sollte oder etwas mit den Signaturen nicht funktionieren, so informieren Sie den Autor, damit die erforderlichen Änderungen durchgeführt werden können.

Um die Signaturen, die in phpMussel enthalten sind, zu deaktivieren, lesen Sie bitte die Hinweise zum Greylisting im Abschnitt FRONT-END-MANAGEMENT.

#### 3.1 BENUTZUNG (CLI - BEFEHLSZEILENMODUS)

Bitte lesen Sie den Abschnitt "MANUELL INSTALLIEREN (CLI - BEFEHLSZEILENMODUS)".

Bedenken Sie, dass zukünftige Versionen von phpMussel andere Systeme unterstützen werden, zur Zeit jedoch phpMussel im CLI-Modus nur für Windows-Systeme optimiert wurde (Sie können natürlich versuchen, phpMussel auf anderen Systemen zu installieren, jedoch wird nicht garantiert, dass es wie vorgesehen funktioniert).

Beachten Sie außerdem, dass phpMussel eine *On-Demand-Scanner*; Keine *On-Access-Scanner* (andere als für das Hochladen von Dateien, zum Zeitpunkt der Upload), und nicht den aktiven Speicher überwacht! Es erkennt nur Viren in den Dateien, die hochgeladen werden, und die Sie explizit zum Scannen angegeben haben.

---


### 4. <a name="SECTION4"></a>FRONT-END-MANAGEMENT

#### 4.0 WAS IST DAS FRONT-END.

Das Front-End bietet eine bequeme und einfache Möglichkeit, für Ihre phpMussel-Installation zu pflegen, zu verwalten und zu aktualisieren. Sie können Protokolldateien über die Protokollseite anzeigen, teilen und herunterladen, Sie können die Konfiguration über die Konfigurationsseite ändern, Sie können Komponenten über die Updates-Seite installieren und deinstallieren, und Sie können Dateien in Ihrem vault über den Dateimanager hochladen, herunterladen und ändern.

Das Front-End ist standardmäßig deaktiviert, um unautorisiert Zugriff zu verhindern (unautorisiert Zugriff könnte erhebliche Konsequenzen für Ihre Website und ihre Sicherheit haben). Aktivieren Sie es, indem Sie die unten aufgeführten Anweisungen befolgen.

#### 4.1 WIE AKTIVIEREN SIE DAS FRONT-END.

1) Finden Sie die `disable_frontend`-Direktive in der Datei `config.ini`, und setzen Sie es auf `false` (wird es standardmäßig `true` sein).

2) Greifen Sie `loader.php` aus Ihrem Browser (z.B., `http://localhost/phpmussel/loader.php`).

3) Einloggen Sie sich mit dem standardmäßig Benutzernamen und Passwort an (admin/password).

Note: Nachdem Sie sich eingeloggt haben, um einen unautorisiert Zugriff auf das Front-End zu verhindern, sollten Sie sofort Ihren Benutzernamen und Ihr Passwort ändern! Dies ist sehr wichtig, weil es möglich ist, beliebigen PHP-Code auf Ihre Website über das Front-End zu hochladen.

#### 4.2 WIE MAN DAS FRONT-END BENUTZT.

Anweisungen sind auf jeder Seite des Front-Ends vorhanden, um die richtige Verwendung und den vorgesehenen Zweck zu erläutern. Wenn Sie weitere Erklärungen oder spezielle Hilfe benötigen, wenden Sie sich bitte an den Support. Alternativ gibt es einige Videos auf YouTube, die durch Demonstration helfen könnte.


---


### 5. <a name="SECTION5"></a>CLI (BEFEHLSZEILENMODUS)

phpMussel kann als interaktiver Scanner im CLI-Modus in einer Windows-Systemumgebung genutzt werden. Bitte lesen Sie den Abschnitt INSTALLATION (CLI - BEFEHLSZEILENMODUS).

Um eine Liste der verfügbaren CLI-Befehle zu erhalten, geben Sie in der Befehlszeile 'c' ein und bestätigen Sie mit Enter.

Zusätzlich, für Interessenten, ein Video-Tutorial, wie phpMussel im CLI-Modus zu verwenden, können finden Sie hier:
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>IM PAKET ENTHALTENE DATEIEN

Die folgende Liste beinhaltet alle Dateien, die im heruntergeladenen Archiv des Scripts enthalten sind und Dateien, die durch die Benutzung des Scripts eventuell erstellt werden, inkl. einer kurzen Beschreibung.

Datei | Beschreibung
----|----
/_docs/ | Verzeichnis für die Dokumentationen (beinhaltet verschiedene Dateien).
/_docs/readme.ar.md | Arabische Dokumentation.
/_docs/readme.de.md | Deutsche Dokumentation.
/_docs/readme.en.md | Englische Dokumentation.
/_docs/readme.es.md | Spanische Dokumentation.
/_docs/readme.fr.md | Französische Dokumentation.
/_docs/readme.id.md | Indonesische Dokumentation.
/_docs/readme.it.md | Italienische Dokumentation.
/_docs/readme.ja.md | Japanische Dokumentation.
/_docs/readme.ko.md | Koreanische Dokumentation.
/_docs/readme.nl.md | Niederländische Dokumentation.
/_docs/readme.pt.md | Portugiesische Dokumentation.
/_docs/readme.ru.md | Russische Dokumentation.
/_docs/readme.ur.md | Urdu Dokumentation.
/_docs/readme.vi.md | Vietnamesische Dokumentation.
/_docs/readme.zh-TW.md | Chinesische Dokumentation (traditionell).
/_docs/readme.zh.md | Chinesische Dokumentation (vereinfacht).
/_testfiles/ | Verzeichnis für Testdateien (beinhaltet verschiedene Dateien). Alle enthaltenen Dateien dienen zur Überprüfung, ob phpMussel auf Ihrem System ordnungsgemäß installiert wurde. Sie müssen dieses Verzeichnis oder die Dateien nicht hochladen, sofern Sie keinen solchen Test durchführen möchten.
/_testfiles/ascii_standard_testfile.txt | Testdatei zur Überprüfung der normierten ASCII-Signaturerkennung.
/_testfiles/coex_testfile.rtf | Testdatei zur Überprüfung der Komplex-Erweitert-Signaturerkennung.
/_testfiles/exe_standard_testfile.exe | Testdatei zur Überprüfung der PE-Signaturerkennung.
/_testfiles/general_standard_testfile.txt | Testdatei zur Überprüfung der Erkennung der allgemeinen Signaturen.
/_testfiles/graphics_standard_testfile.gif | Testdatei zur Überprüfung der Grafik-Signaturerkennung.
/_testfiles/html_standard_testfile.html | Testdatei zur Überprüfung der normierten HTML-Signaturerkennung.
/_testfiles/md5_testfile.txt | Testdatei zur Überprüfung der MD5-Signaturerkennung.
/_testfiles/ole_testfile.ole | Testdatei zur Überprüfung der OLE-Signaturerkennung.
/_testfiles/pdf_standard_testfile.pdf | Testdatei zur Überprüfung der PDF-Signaturerkennung.
/_testfiles/pe_sectional_testfile.exe | Testdatei zur Überprüfung der PE-Sectional-Signaturerkennung.
/_testfiles/swf_standard_testfile.swf | Testdatei zur Überprüfung der Shockwave-Signaturerkennung.
/vault/ | Vault-Verzeichnis (beinhaltet verschiedene Dateien).
/vault/cache/ | Cache-Verzeichnis (für temporäre Daten).
/vault/cache/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/fe_assets/ | Front-End-Daten.
/vault/fe_assets/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/fe_assets/_accounts.html | Ein HTML-Template für das Front-End Konten-Seite.
/vault/fe_assets/_accounts_row.html | Ein HTML-Template für das Front-End Konten-Seite.
/vault/fe_assets/_config.html | Ein HTML-Template für die Front-End Konfiguration-Seite.
/vault/fe_assets/_config_row.html | Ein HTML-Template für die Front-End Konfiguration-Seite.
/vault/fe_assets/_files.html | Ein HTML-Template für den Dateimanager.
/vault/fe_assets/_files_edit.html | Ein HTML-Template für den Dateimanager.
/vault/fe_assets/_files_rename.html | Ein HTML-Template für den Dateimanager.
/vault/fe_assets/_files_row.html | Ein HTML-Template für den Dateimanager.
/vault/fe_assets/_home.html | Ein HTML-Template für das Front-End Startseite.
/vault/fe_assets/_login.html | Ein HTML-Template für das Front-End Einloggen-Seite.
/vault/fe_assets/_logs.html | Ein HTML-Template für das Front-End Protokolldateien-Seite.
/vault/fe_assets/_nav_complete_access.html | Ein HTML-Template für das Front-End Navigation-Links, für alle mit vollständiger Zugriff.
/vault/fe_assets/_nav_logs_access_only.html | Ein HTML-Template für das Front-End Navigation-Links, für alle mit Zugriff nur auf Protokolldateien.
/vault/fe_assets/_updates.html | Ein HTML-Template für das Front-End Aktualisierungen-Seite.
/vault/fe_assets/_updates_row.html | Ein HTML-Template für das Front-End Aktualisierungen-Seite.
/vault/fe_assets/_upload_test.html | Ein HTML-Template für die Upload-Testseite.
/vault/fe_assets/frontend.css | CSS-Stylesheet für das Front-End.
/vault/fe_assets/frontend.dat | Datenbank für das Front-End (Enthält Kontoinformationen und Sitzungsinformationen; nur erzeugt wenn das Frontend aktiviert und verwendet wird).
/vault/fe_assets/frontend.html | Die Haupt-HTML-Template-Datei für das Front-End.
/vault/fe_assets/icons.php | Ikonen-Handler (die vom Front-End-Dateimanager verwendet wird).
/vault/fe_assets/pips.php | Pips-Handler (die vom Front-End-Dateimanager verwendet wird).
/vault/lang/ | Enthält Sprachdaten für phpMussel.
/vault/lang/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/lang/lang.ar.fe.php | Arabische Sprachdateien für das Front-End.
/vault/lang/lang.ar.php | Arabische Sprachdateien.
/vault/lang/lang.de.fe.php | Deutsche Sprachdateien für das Front-End.
/vault/lang/lang.de.php | Deutsche Sprachdateien.
/vault/lang/lang.en.fe.php | Englische Sprachdateien für das Front-End.
/vault/lang/lang.en.php | Englische Sprachdateien.
/vault/lang/lang.es.fe.php | Spanische Sprachdateien für das Front-End.
/vault/lang/lang.es.php | Spanische Sprachdateien.
/vault/lang/lang.fr.fe.php | Französische Sprachdateien für das Front-End.
/vault/lang/lang.fr.php | Französische Sprachdateien.
/vault/lang/lang.id.fe.php | Indonesische Sprachdateien für das Front-End.
/vault/lang/lang.id.php | Indonesische Sprachdateien.
/vault/lang/lang.it.fe.php | Italienische Sprachdateien für das Front-End.
/vault/lang/lang.it.php | Italienische Sprachdateien.
/vault/lang/lang.ja.fe.php | Japanische Sprachdateien für das Front-End.
/vault/lang/lang.ja.php | Japanische Sprachdateien.
/vault/lang/lang.ko.fe.php | Koreanische Sprachdateien für das Front-End.
/vault/lang/lang.ko.php | Koreanische Sprachdateien.
/vault/lang/lang.nl.fe.php | Niederländische Sprachdateien für das Front-End.
/vault/lang/lang.nl.php | Niederländische Sprachdateien.
/vault/lang/lang.pt.fe.php | Portugiesische Sprachdateien für das Front-End.
/vault/lang/lang.pt.php | Portugiesische Sprachdateien.
/vault/lang/lang.ru.fe.php | Russische Sprachdateien für das Front-End.
/vault/lang/lang.ru.php | Russische Sprachdateien.
/vault/lang/lang.th.fe.php | Thai Sprachdateien für das Front-End.
/vault/lang/lang.th.php | Thai Sprachdateien.
/vault/lang/lang.ur.fe.php | Urdu Sprachdateien für das Front-End.
/vault/lang/lang.ur.php | Urdu Sprachdateien.
/vault/lang/lang.vi.fe.php | Vietnamesische Sprachdateien für das Front-End.
/vault/lang/lang.vi.php | Vietnamesische Sprachdateien.
/vault/lang/lang.zh-tw.fe.php | Chinesische Sprachdateien (traditionell) für das Front-End.
/vault/lang/lang.zh-tw.php | Chinesische Sprachdateien (traditionell).
/vault/lang/lang.zh.fe.php | Chinesische Sprachdateien (vereinfacht) für das Front-End.
/vault/lang/lang.zh.php | Chinesische Sprachdateien (vereinfacht).
/vault/quarantine/ | Quarantäne-Verzeichnis (enthält Dateien in Quarantäne).
/vault/quarantine/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/signatures/ | Signaturverzeichnis (enthält Signaturdateien).
/vault/signatures/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/signatures/switch.dat | Diese Datei definiert bestimmte Variablen.
/vault/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/cli.php | CLI-Handler.
/vault/config.ini.RenameMe | Konfigurationsdatei; Beinhaltet alle Konfigurationsmöglichkeiten von phpMussel (umbenennen zu aktivieren).
/vault/config.php | Konfiguration-Handler.
/vault/config.yaml | Standardkonfigurationsdatei; Beinhaltet Standardkonfigurationswerte für phpMussel.
/vault/components.dat | Enthält Informationen zu den verschiedenen Komponenten für phpMussel; Wird von der Aktualisierungsfunktion bereitgestellt durch das Front-End verwendet.
/vault/frontend.php | Front-End-Handler.
/vault/functions.php | Funktionen-Datei.
/vault/greylist.csv | CSV der Signaturen in der Greylist, die phpMussel ignorieren soll (Datei wird nach dem Löschen automatisch neu erstellt).
/vault/lang.php | Sprachdateien.
/vault/php5.4.x.php | Polyfills für PHP 5.4.X (erforderlich für Abwärtskompatibilität mit PHP 5.4.X; sicher zu löschen für neuere PHP-Versionen).
※ /vault/scan_kills.txt | Eine Aufzeichnung aller von phpMussel blockierten Dateiuploads.
※ /vault/scan_log.txt | Eine Aufzeichnung aller von phpMussel gescannten Objekte.
※ /vault/scan_log_serialized.txt | Eine Aufzeichnung aller von phpMussel gescannten Objekte.
/vault/template_custom.html | Template Datei; Template für die HTML-Ausgabe mit der Nachricht, dass der Dateiupload von phpMussel blockiert wurde (Nachricht, die dem Nutzer angezeigt wird).
/vault/template_default.html | Template Datei; Template für die HTML-Ausgabe mit der Nachricht, dass der Dateiupload von phpMussel blockiert wurde (Nachricht, die dem Nutzer angezeigt wird).
/vault/themes.dat | Themen-Datei; Wird von der Aktualisierungsfunktion bereitgestellt durch das Front-End verwendet.
/vault/upload.php | Upload-Handler.
/.gitattributes | Ein GitHub Projektdatei (für die korrekte Funktion des Scripts nicht notwendig).
/Changelog-v1.txt | Eine Auflistung der Änderungen des Scripts der verschiedenen Versionen (für die korrekte Funktion des Scripts nicht notwendig).
/composer.json | Composer/Packagist Informationen (für die korrekte Funktion des Scripts nicht notwendig).
/CONTRIBUTING.md | Wie Sie dazu beitragen für das Projekt.
/LICENSE.txt | Eine Kopie der GNU/GPLv2 Lizenz (für die korrekte Funktion des Scripts nicht notwendig).
/loader.php | Loader. Diese Datei wird in Ihr CMS eingebunden (notwendig)!
/PEOPLE.md | Informationen zu den am Projekt beteiligten Personen.
/README.md | Projektübersicht.
/web.config | Eine ASP.NET-Konfigurationsdatei (in diesem Fall zum Schutz des Verzeichnisses `/vault` vor einem nicht authorisierten Zugriff, sofern das Script auf einem auf der ASP.NET-Technologie basierenden Server installiert wurde).

※ Der Dateiname kann je nach Konfiguratuion in der `config.ini` variieren.

---


### 7. <a name="SECTION7"></a>EINSTELLUNGEN
Nachfolgend finden Sie eine Liste der Variablen in der Konfigurationsdatei `config.ini` mit einer kurzen Beschreibung ihrer Funktionen.

#### "general" (Kategorie)
Generelle Konfiguration von phpMussel.

"cleanup"
- Löscht die Scriptvariablen und den Cache nach der Ausführung. False = Nicht löschen; True = Löschen [Standardeinstellung]. Sollten Sie das Script nach der Überprüfung des Uploads nicht mehr nutzen, stellen Sie diese Option auf `true`, um die Speichernutzung zu minimieren. Verwenden Sie das Script noch für weitere Zwecke, stellen Sie die Option auf `false`, um unnötiges mehrfaches Einlesen der Daten in den Speicher zu vermeiden. Normalerweise sollte diese Option auf `true` gesetzt werden, allerdings können Sie das Script dann nur zur Dateiüberprüfung verwenden.
- Kein Einfluss im CLI-Modus.

"scan_log"
- Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

"scan_log_serialized"
- Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen (Format ist serialisiert). Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

"scan_kills"
- Name einer Datei zum Aufzeichnen aller blockierten Uploads. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

*Nützlicher Tipp: Wenn du willst, Sie können die Datum/Uhrzeit um die Aufzeichnungen hinzufügen durch diese im Namen einschließlich: `{yyyy}` für komplette Jahr, `{yy}` für abgekürzten Jahr, `{mm}` für Monat, `{dd}` für Tag, `{hh}` für Stunde.*

*Beispielen:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Trunkate Protokolldateien, wenn sie eine bestimmte Größe erreichen? Wert ist die maximale Größe in B/KB/MB/GB/TB, die eine Protokolldatei wachsen kann, bevor sie trunkiert wird. Der Standardwert von 0KB deaktiviert die Trunkierung (Protokolldateien können unbegrenzt wachsen). Hinweis: Gilt für einzelne Protokolldateien! Die Größe der Protokolldateien gilt nicht als kollektiv.

"timeOffset"
- Wenn Ihr Serverzeit nicht mit Ihrer Ortszeit, Sie können einen Offset hier angeben. Der Zeitversatz ist Minute-basiert.
- Beispiel (eine Stunde hinzufügen): `timeOffset=60`

"timeFormat"
- Das Datumsformat verwendet von phpMussel. Standardeinstellung = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Ort der IP-Adresse der aktuellen Verbindung im gesamten Datenstrom (nützlich für Cloud-Services) Standardeinstellung = REMOTE_ADDR. Achtung: Ändern Sie diesen Wert nur wenn Sie wissen was Sie tun!

"enable_plugins"
- Aktivieren Sie die Unterstützung für phpMussel Plugins? False = Nein; True = Ja [Standardeinstellung].

"forbid_on_block"
- Zurückgegebener 403-HTTP-Header bei einem blockierten Dateiupload. False = Nein (200); True = Ja (403) [Standardeinstellung].

"delete_on_sight"
- Diese Option weist das Script an, Dateien während eines Scans sofort zu löschen, wenn ein Erkennungsmerkmal, ob durch Signaturen oder andere Methoden, zutrifft. Dateien, die als nicht infiziert eingestuft werden, werden nicht berührt. Im Falle von Archiven wird das gesamte Archiv gelöscht, auch wenn nur eine einzige Datei im Archiv infiziert sein sollte. Normalerweise ist es bei einem Dateiupload nicht notwendig, diese Option zu aktivieren, da PHP nach der Ausführung von Scripten den Inhalt vom Cache löscht, d.h. PHP löscht jede Datei, die über den Server hochgeladen wird, sofern Sie nicht verschoben, kopiert oder bereits gelöscht wurde. Diese Option wurde als zusätzliches Mass an Sicherheit hinzugefügt, außerdem für Systeme, deren PHP-Installation nicht dem üblichen Verhalten entspricht. False = Nach der Überprüfung wird die Datei so belassen [Standardeinstellung]; True = Nach der Überprüfung wird die Datei sofort gelöscht, sofern Sie infiziert ist.

"lang"
- Gibt die Standardsprache für phpMussel an.

"quarantine_key"
- phpMussel ist in der Lage, Versuche von Datei-Uploads in einem Quarantäne-Verzeichnis zu isolieren, sofern Sie dies tun wollen. Nutzer, die nur daran interessiert sind, ihre Webauftritte oder ihre Hosting-Umgebung zu schützen ohne das Interesse, die markierten Dateien weitergehend zu untersuchen, sollten diese Funktionalität deaktivieren, Nutzer, die diese Dateien zur Ananlyse auf Malware o.ä. benötigen, sollten diese Funktion aktivieren. Die Isolation von markierten Dateien kann manchmal auch bei der Fehlersuche von Fehlalarmen helfen, wenn dies häufiger bei Ihnen auftritt. Um die Quarantänefunktion zu deaktivieren, lassen Sie die Richtlinie `quarantine_key` leer oder löschen Sie den Inhalt dieser Richtlinie, wenn sie nicht bereits leer ist. Um die Quarantänefunktion zu aktivieren, geben Sie einen Wert ein. Der `quarantine_key` ist ein wichtiges Sicherheitsmerkmal der Quarantänfunktionen, um zu verhindern, dass die Quarantänefunktionen einem Exploit ausgesetzt wird und gespeicherte Daten in der Quarantäneumgebung ausgeführt werden können. Der Wert des `quarantine_key` sollte so behandelt werden, wie Ihre Passwörter: Je länger, desto besser, und halten Sie sie geheim. Optimal in Verbindung mit `delete_on_sight`.

"quarantine_max_filesize"
- Die maximal zulässige Dateigröße von Dateien, die in der Quarantäne isoliert werden sollen. Dateien, die größer sind als der angegebene Wert, werden NICHT im Quarantäneverzeichnis gespeichert. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardeinstellung = 2MB.

"quarantine_max_usage"
- Die maximal zulässige Speichernutzung der Quarantäne. Erreicht die Geamtgröße der Dateien in der Quarantäne diesen Wert, werden die ältesten Dateien in der Quarantäne gelöscht, bis der Wert unterschritten wird. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardwert = 64MB.

"honeypot_mode"
- Ist der Honeypot-Modus aktiviert, wird phpMussel jede Datei aus dem Dateiupload isolieren, ohne Rücksicht darauf zu nehmen, ob diese Dateien Signaturen enthalten, es findet auch keine weitere Überprüfung statt. Diese Funktionalität dient ausschließlich dem Zweck der Viren- und Malwareforschung, es wird ausdrücklich nicht empfohlen, phpMussel mit dieser Funktion zum Zwecke der Dateiüberprüfung von Uploads oder anderen Zwecken außer "Honeypotting" zu verwenden. Standardmäßig ist diese Funktion deaktiviert. False = Deativiert [Standardwert]; True = Aktiviert.

"scan_cache_expiry"
- Für wie lange soll phpMussel die Scan-Ergebnisse zwischenspeichern? Wert entspricht der Anzahl Sekunden, wie lange die Scan-Ergebnisse zwischengespeichert werden. Standard ist 21600 Sekunden (6 Stunden); Ein Wert von 0 wird das Zwischenspeichern von Scan-Ergebnissen deaktivieren.

"disable_cli"
- CLI-Modus deaktivieren? CLI-Modus ist standardmäßig aktiviert, kann aber manchmal bestimmte Test-Tools (PHPUnit zum Beispiel) und andere CLI-basierte Anwendungen beeinträchtigen. Wenn du den CLI-Modus nicht deaktiveren musst, solltest du diese Anweisung ignorieren. False = CLI-Modus aktivieren [Standardeinstellung]; True = CLI-Modus deaktivieren.

"disable_frontend"
- Front-End-Access deaktivieren? Front-End-Access kann machen phpMussel einfacher zu handhaben, aber es kann auch ein potentielles Sicherheitsrisiko sein. Es wird empfohlen, wenn möglich, phpMussel über die Back-End-Access zu verwalten, aber Front-End-Access vorgesehen ist, für wenn es nicht möglich ist. Halten Sie es deaktiviert außer wenn Sie es brauchen. False = Front-End-Access aktivieren; True = Front-End-Access deaktivieren [Standardeinstellung].

"max_login_attempts"
- Maximale Anzahl der Versucht zu einloggen (Front-End). Standardeinstellung = 5.

"FrontEndLog"
- Datei für die Protokollierung von Front-End Einloggen-Versuchen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

"disable_webfonts"
- Web-Fonts deaktivieren? True = Ja; False = Nein [Standardeinstellung].

#### "signatures" (Kategorie)
Konfiguration der Signaturen.

"Active"
- Eine Liste der aktiven Signaturdateien, die durch Kommas getrennt sind.

"fail_silently"
- Reaktion von phpMussel auf fehlende oder defekte Signaturen. Ist `fail_silently` deaktiviert, werden fehlende oder defekte Signaturen während des Scanvorgangs gemeldet, ist `fail_silently` aktiviert, werden fehlende oder defekte Signaturen ignoriert, ohne dass entsprechende Probleme gemeldet werden. Diese Option sollte so belassen werden, es sei denn, Sie erwarten Abstürze oder ähnliches. False = Deaktiviert; True = Aktiviert [Standardeinstellung].

"fail_extensions_silently"
- Soll phpMussel melden, wenn Dateierweiterungen fehlen? Wenn `fail_extensions_silently` deaktiviert ist, werden fehlende Dateierweiterungen beim Scannen gemeldet und wenn `fail_extensions_silently` aktiviert ist, werden fehlende Dateierweiterungen ignoriert und beim Scan gemeldet, dass es mit diesen Dateien keine Probleme gibt. Das Deaktivieren dieser Anweisung kann möglicherweise deine Sicherheit erhöhen, kann aber auch zu mehr Falschmeldungen führen. False = Deaktiviert; True = Aktiviert [Standardeinstellung].

"detect_adware"
- Soll phpMussel Signaturen für die Erkennung von Adware parsen? False = Nein; True = Ja [Standardeinstellung].

"detect_joke_hoax"
- Soll phpMussel Signaturen für die Erkennung von Scherz/Fake-Malware/Viren parsen? False = Nein; True = Ja [Standardeinstellung].

"detect_pua_pup"
- Soll phpMussel Signaturen für die Erkennung von PUAs/PUPs parsen? False = Nein; True = Ja [Standardeinstellung].

"detect_packer_packed"
- Soll phpMussel Signaturen für die Erkennung von Packern und komprimierten Daten parsen? False = Nein; True = Ja [Standardeinstellung].

"detect_shell"
- Soll phpMussel Signaturen für die Erkennung von Shell-Scripten parsen? False = Nein; True = Ja [Standardeinstellung].

"detect_deface"
- Soll phpMussel Signaturen für die Erkennung von Defacements und Defacer parsen? False = Nein; True = Ja [Standardeinstellung].

#### "files" (Kategorie)
Generelle Konfigurationen für die Handhabung von Dateien.

"max_uploads"
- Maximale erlaubte Anzahl zu überprüfender Dateien während eines Dateiuploads bevor der Scan abgebrochen und der Nutzer darüber informiert wird, dass er zu viele Dateien auf einmal hochgeladen hat. Bietet einen Schutz gegen den theoretischen Angriff eines DDoS auf Ihr System oder CMS, indem der Angreifer phpMussel überlastet und den PHP-Prozess zum Stillstand bringt. Empfohlen: 10. Sie können den Wert abhängig von Ihrer Hardware erhöhen oder senken. Beachten Sie, dass dieser Wert nicht den Inhalt von Archiven berücksichtigt.

"filesize_limit"
- Begrenzung der Dateigröße in KB. 65536 = 64MB [Standardeinstellung]; 0 = Keine Begrenzung (wird immer zur Greylist hinzugefügt), jeder (positive) numerische Wert wird akzeptiert. Dies ist nützlich, wenn Ihre PHP-Konfiguration den verfügbaren Speicherverbrauch je Prozess einschränkt oder die Dateigröße von Uploads begrenzt.

"filesize_response"
- Handhabung von Dateien, die die Begrenzung der Dateigröße (sofern angegeben) überschreiten. False = Hinzufügen zur Whitelist; True = Hinzufügen zur Blacklist [Standardeinstellung].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Sofern Ihr System spezielle Dateitypen im Upload erlaubt oder komplett verweigert, so unterteilen Sie diese Dateitypen in Whitelists, Blacklists oder Greylists, um den Scanvorgang zu beschleunigen, indem diese Dateitypen übersprungen werden. Format ist CSV (comma separated values, Komma-getrennte Werte). Möchten Sie lieber alles überprüfen lassen, so lassen Sie die Variable(n) leer; Dies deaktiviert die Whitelist/Blacklist/Greylist.
- Logische Reihenfolge der Verarbeitung ist:
  - Wenn der Dateityp in der Whitelist ist, scanne und blockieren nicht die Datei, und überprüfe nicht wenn die Datei in der Whitelist oder in der Greylist ist.
  - Wenn der Dateityp in der Blacklist ist, scanne nicht die Datei aber blockieren sie trotzdem, und überprüfe nicht wenn die Datei in der Greylist ist.
  - Wenn die Greylist leer ist oder wenn die Greylist nicht leer ist und der Dateityp in der Greylist ist, scanne die Datei wie standardmäßig eingestellt ist und stelle fest, ob diese blockiert werden soll, basierend auf dem Scan, aber wenn die Greylist nicht leer ist und der Dateityp nicht in der Greylist ist, behandel die Datei als ob sie in der Blacklist ist, scanne sie nicht aber blockiere sie trotzdem.

"check_archives"
- Soll der Inhalt von Archiven überprüft werden? False = Nein (keine Überprüfung); True = Ja (wird überprüft) [Standardeinstellung].
- Zur Zeit wird NUR die Überprüfung von BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR und ZIP Archiven unterstützt (Überprüfung von RAR, CAB, 7z usw. wird zur Zeit NICHT unterstützt).
- Diese Funktion ist nicht sicher! Es wird dringend empfohlen, diese Funktion aktiviert zu lassen, es kann jedoch nicht garantiert werden, dass alles entdeckt wird.
- Die Archivüberprüfung ist derzeit nicht rekursiv für PHAR-Archive oder ZIP-Archive.

"filesize_archives"
- Soll das Blacklisting/Whitelisting der Dateigröße auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen); True = Ja [Standardeinstellung].

"filetype_archives"
- Soll das Blacklisting/Whitelisting des Dateityps auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen) [Standardeinstellung]; True = Ja.

"max_recursion"
- Maximale Grenze der Rekursionstiefe von Archiven. Standardwert = 10.

"block_encrypted_archives"
- Verschlüsselte Archive erkennen und blockieren? Denn phpMussel ist nicht in der Lage, die Inhalte von verschlüsselten Archiven zu scannen. Es ist möglich, dass Archiv-Verschlüsselung von Angreifern zum Umgehen von phpMussel, Antiviren-Scanner und weiterer solcher Schutzlösungen verwendet wird. Die Anweisung, dass phpMussel verschlüsselte Archive blockiert kann möglicherweise helfen, die Risiken, die mit dieser Möglichkeit verbunden sind, zu verringern. False = Nein; True = Ja [Standardeinstellung].

#### "attack_specific" (Kategorie)
Konfiguration für spezifische Angriffserkennung.

Chameleon-Angriffserkennung: False = Deaktiviert; True = Aktiviert.

"chameleon_from_php"
- Suche nach PHP-Headern in Dateien, die weder PHP-Dateien noch erkannte Archive sind.

"chameleon_from_exe"
- Suche nach ausführbaren Headern in Dateien, die weder ausführbar noch erkannte Archive sind und nach ausführbaren Dateien, deren Header nicht korrekt sind.

"chameleon_to_archive"
- Suche nach Archiven, deren Header nicht korrekt sind (Unterstützt: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Suche nach Office-Dokumenten, deren Header nicht korrekt sind (Unterstützt: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Suche nach Bildern, deren Header nicht korrekt sind (Unterstützt: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Suche nach PDF-Dateien, deren Header nicht korrekt sind.

"archive_file_extensions"
- Erkannte Archiv-Dateierweiterungen (Format ist CSV; nur bei Problemen hinzufügen oder entfernen; unnötiges Entfernen könnte Fehlalarme für Archive auslösen, unnötiges Hinzufügen fügt das zur Whitelist hinzu, was vorher als möglicher Angriff definiert wurde; Ändern Sie diese Liste äußerst vorsichtig; Beachten Sie, dass dies keinen Einfluss darauf hat, wozu Archive fähig sind und nicht auf Inhaltsebene analysiert werden können). Diese Liste enthält die Archivformate, die am häufigsten von der Mehrzahl der Systeme und CMS verwendet werden, ist aber absichtlich nicht vollständig.

"block_control_characters"
- Sollen Dateien, welche Steuerzeichen (andere als Newline/Zeilenumbruch) enthalten, blockiert werden? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Sofern Sie _**NUR**_ reinen Text hochladen, können Sie diese Option aktivieren, um Ihrem System zusätzlichen Schutz zu bieten. Sollten Sie anderes als reinen Text hochladen, werden bei aktivierter Option Fehlalarme ausgelöst. False = Nicht blockieren [Standardeinstellung]; True = Blockieren.

"corrupted_exe"
- Defekte Dateien und Parse-Errors. False = Ignorieren; True = Blockieren [Standardeinstellung]. Soll auf potentiell defekte ausführbare Dateien geprüft und diese blockiert werden? Oftmals (aber nicht immer), wenn bestimmte Aspekte einer PE-Datei beschädigt sind oder nicht korrekt verarbeitet werden können, ist dies ein Hinweis auf eine infizierte Datei. Viele Antiviren-Programme nutzen verschiedene Methoden, um Viren in solchen Dateien zu erkennen, sofern sich der Programmierer eines Virus dieser Tatsache bewußt ist, wird er versuchen, diese Maßnahmen zu verhindern, damit der Virus unentdeckt bleibt.

"decode_threshold"
- Schwelle der Menge der Rohdaten, die durch den Decode-Befehl erkannt werden sollen (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 512KB. Null oder ein Null-Wert deaktiviert die Beschränkung (Entfernen aller solcher Einschränkungen basierend auf die Dateigröße).

"scannable_threshold"
- Schwelle der Menge der Rohdaten, die phpMussel lesen und scannen darf (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 32MB. Null oder ein Null-Wert deaktiviert die Beschränkung. Generell sollte dieser Wert nicht kleiner sein als die durchschnittliche Dateigröße von Datei-Uploads, die Sie auf Ihrem Server oder Ihrer Website erwarten, sollte nicht größer sein als die Richtlinie filesize_limit und sollte nicht mehr als ein Fünftel der Gesamtspeicherzuweisung für PHP in der Konfigurationsdatei `php.ini` sein. Diese Richtlinie verhindert, dass phpMussel zu viel Speicher benutzt (was phpMussel daran hindern würde, einen Scan ab einer bestimmten Dateigröße erfolgreich durchzuführen).

#### "compatibility" (Kategorie)
Kompatibilitätsdirektiven für phpMussel.

"ignore_upload_errors"
- Diese Direktive sollte generell AUS geschaltet bleiben sofern es nicht für die korrekte Funktion von phpMussel auf Ihrem System benötigt wird. Normalerweise, sobald phpMussel bei AUS geschalteter Direktive ein Element in `$_FILES` array() erkennt, wird es beginnen, die Dateien, die diese Elemente repräsentieren, zu überprüfen, sollten diese Elemente leer sein, gibt phpMussel eine Fehlermeldung zurück. Dies ist das normale Verhalten von phpMussel. Bei einigen CMS werden allerdings als normales Verhalten leere Elemente in `$_FILES` zurückgegeben oder Fehlermeldungen ausgelöst, sobald sich dort keine leeren Elemente befinden, in diesem Fall tritt ein Konflikt zwischen dem normalen Verhalten von phpMussel und dem CMS auf. Sollte eine solche Konstellation bei Ihrem CMS zutreffen, so stellen Sie diese Option AN, phpMussel wird somit nicht nach leeren Elementen suchen, Sie bei einem Fund ignorieren und keine zugehörigen Fehlermeldungen ausgeben, der Request zum Seitenaufruf kann somit fortgesetzt werden. False = AUS/OFF; True = AN/ON.

"only_allow_images"
- Wenn Sie nur Bilder erwarten, die auf Ihr System oder CMS hochgeladen werden oder nur Bilder und keine anderen Dateien als Upload erlauben oder benötigen, so sollte diese Direktive aktiviert werden (ON), ansonsten deaktiviert bleiben (OFF). Ist diese Direktive aktiviert, wird phpMussel alle Uploads, die keine Bilddateien sind, blockieren, ohne sie zu scannen. Dies kann die Verarbeitungszeit und Speichernutzung reduzieren, sobald andere Nicht-Bilddateien hochgeladen werden. False = AUS/OFF; True = AN/ON.

#### "heuristic" (Kategorie)
Heuristic-Direktive für phpMussel.

"threshold"
- Es gibt bestimmte Signaturen in phpMussel, die dazu dienen, verdächtige und potenziell bösartige Eigenschaften von hochgeladenen Dateien zu identifizieren, ohne diese Dateien an sich zu überprüfen und als bösartig zu identifizieren. Diese Direktive teilt phpMussel mit, welche Gewichtung von verdächtigen und potenziell bösartigen Eigenschaften zulässig ist, bevor diese Dateien als bösartig gekennzeichnet werden. Die Definition des Gewichts ist in diesem Zusammenhang die Gesamtzahl der verdächtigen und potenziell bösartigen Eigenschaften. Standardwert ist 3. Ein niedriger Wert in der Regel führt zu einem vermehrten Auftreten von Fehlalarmen und eine größere Anzahl von schädlichen Dateien werden erkannt, während ein höherer Wert weniger Fehlalarme auslöst und eine geringere Anzahl von schädlichen Dateien markiert werden. Dieser Wert sollte so belassen werden, es sei denn, Sie erkennen Probleme, die durch diese Einstellung hervorgerufen werden.

#### "virustotal" (Kategorie)
Konfiguration für Virus Total Integration.

"vt_public_api_key"
- Optional, phpMussel kann Dateien mit der Virus Total API scannen, um einen noch besseren Schutz gegen Viren, Trojaner, Malware und andere Bedrohungen zu bieten. Standardmäßig ist das Scannen von Dateien mit der Virus Total API deaktiviert. Um es zu aktivieren, wird ein API Schlüssel von Virus Total benötigt. Wegen dem großen Vorteil den dir das bietet, empfehle ich die Aktivierung. Bitte sei dir bewusst, um die Virus Total API zu nutzen, dass du deren Nutzungsbedingungen zustimmen und dich an alle Richtlinien halten musst, wie es in der Virus Total Dokumentation beschrieben ist! Du darfst diese Integrations-Funktion nicht verwenden AUSSER:
  - Du hast die Nutzungsbedingungen von Virus Total und der API gelesen und stimmst diesen zu. Die Nutzungsbedingungen von Virus Total und der API findet man [hier](https://www.virustotal.com/en/about/terms-of-service/).
  - Du hast, zu einem Minimum, das Vorwort von der Virus Total Public API Dokumentation gelesen und verstanden (alles nach "Virus Total Public API v2.0" aber vor "Contents"). Die Virus Total Public API Dokumentation findet man [hier](https://www.virustotal.com/en/documentation/public-api/).

Anmerkung: Falls das Scannen von Dateien mit der Virus Total API deaktiviert ist, brauchst du keine der Direktiven in dieser Kategorie (`virustotal`) zu überprüfen, weil keine davon etwas machen wenn dies deaktiviert ist. Um einen Virus Total API Schlüssel zu erhalten, klicke auf deren Webseite auf den "Treten Sie unserer Community bei" Link oben rechts auf der Seite, gebe die geforderten Daten an und klick auf "Anmelden" wenn du fertig bist. Folge allen Anweisungen und wenn du deinen öffentlichen API Schlüssel hast, kopier eund füge den öffentlichen API Schlüssel bei der `vt_public_api_key` Direktive der `config.ini` Konfigurations-Datei ein.

"vt_suspicion_level"
- phpMussel wird standardmäßig die mit der Virus Total API zu scannenden Dateien auf Dateien eisnchränken, die es als "verdächtig" betrachtet. Du kannst optional diese Einschränkung durch Änderung des Wertes der `vt_suspicion_level` Direktive anpassen.
- `0`: Dateien werden nur als verdächtig betrachtet, falls durch den Scan mit phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung haben. Das würde bdeuten, dass die Verwendung der Virus Total API für eine zweite Meinung ist, wenn phpMussel eine Datei verdächtigt, dass diese schädlich ist aber nicht vollkommen ausschließen kann, dass diese potentiell harmlos (nicht schädlich) und somit diese andererseits normalerweise nicht blockieren oder als schädlich markieren würde.
- `1`: Dateien werden als verdächtig betrachtet, falls durch den Scan mit phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung haben, falls diese eine ausführbare Datei (PE Dateien, Mach-O Dateien, ELF/Linux Dateien, usw.), oder ein Format sind, das ausführbare Daten enthalten könnte (solche wie ausführbare Makros, DOC/DOCX Dateien, Archivdateien wie RAR, ZIP und usw). Das ist die normale und empfohlene Verdachts-Stufe, was bedeutet, dass die Virus Total API für eine zweite Meinung genutzt wird, wenn phpMussel in einer als verdächtig betrachteten Datei nichts schädliches oder unstimmiges findet, die es als verdächtig ansieht und somit normalerweise nicht blockieren oder als schädlich markieren würde.
- `2`: Alle Dateien werden als verdächtig angesehen und sollten mit der Virus Total API gescannt werden. Ich empfehle nicht, diese Verdachts-Stufe anzuwenden, da dadurch eine schnellere Erreichung des API Limits riskiert wird, als es normalerweise der Fall wäre. Aber es gibt bestimmte Umstände (zB wenn der Webmaster oder Hostmaster sehr wenig Vertrauen in die hochgeladenen Inhalte der Nutzer hat) wo diese Verdachts-Stufe angemessen sein könnte. Mit dieser Verdachts-Stufe werden alle Dateien, die normalerweise nicht blockiert oder als schädlich markiert würden, mit der Virus Total API gescannt. Beachte, dass phpMussel die Virus Total API nicht nutzen wird, wenn dein API Limit erreicht ist (unabhängig von der Verdachts-Stufe) und dass dein Limit wahrscheinlich schneller erreicht wird, wenn diese Verdachts-Stufe verwendet wird.

Hinweis: Unabhängig von der Verdachts-Stufe wird jede Datei auf der Whitelist oder der Blacklist nicht durch phpMussel mit der Virus Total API gescannt, da diese Dateien bereits als schädlich oder harmlos deklariert wurden und ansonste gescannt würden, und somit zusätzliches Scannen nicht erforderlich ist. Die Möglichkeit von phpMussel Dateien mit der Virus Total API zu scannen ist dafür gedacht, weiteres Vertrauen aufzubauen, ob eine Datei unter den Umständen schädlich oder harmlost ist, wo phpMussel sich selber nicht sicher ist ob eine Datei schädlich oder harmlos ist.

"vt_weighting"
- Soll phpMussel die Ergebnisse des Scans mit der Virus Total API als Erkennungen oder Erkennungs-Gewichtung anwenden? Diese Direktive existiert, weil das Scannen einer Datei mit mehreren Engines (wie es Virus Total macht) in einer höheren Erkennungsrate resultieren sollte (und somit eine größere Anzahl schädlicher Dateien erwischt werden), dies kann aber zu in einer höheren Anzahl von Falschmeldungen führen. Unter manchen Umständen würden die Ergebnisse des Scans besser als Vertrauens-Wert als ein eindeutiges Ergebnis verwendet werden. Wenn der Wert 0 verwendet wird, werden die Ergebnisse des Scans als Erkennungen angewendet und somit wird phpMussel, falls irgendeine von Virus Total verwendete Engine die gescannte Datei als schädlich markiert, die Datei als schädlich betrachten. Wird ein anderer Wert verwendet, werden die Ergebnisse des Scans mit der Virus Total API als Erkennungs-Gewichtung angewendet. Die Anzahl der von Virus Total verwendeten Engines, welche die Datei als schädlich markieren, wird als Vertrauens-Wert (oder Erkennungs-Gewichtung) dienen, ob die gescannte Datei von phpMussel als schädlich angesehen werden soll (der verwendete Wert wird den Mindest-Vertrauens-Wert oder erforderliche Gewichtung repräsentieren, um als schädlich angesehen zu werden. Standardmäßig der Wert 0 verwendet.

"vt_quota_rate" und "vt_quota_time"
- Laut der Virus Total API Dokumentation, "ist diese auf 4 Anfragen irgendeiner Art in einer 1 Minuten Zeitspanne limitiert. Falls du einen Honeyclient, Honeypot oder einen andere Automatisierung verwendest, was etwas zu VirusTotal beiträgt und nicht nur Berichte abruft, bist du für ein höheres Limit berechtigt". Standardmäßig wird sich phpMussel strikt daran halten, da aber diese Limits erhöht werden können, stehen dir diese zwei Direktiven zur Verfügung um phpMussel anzuweisen, an welches Limit es sich halten soll. Außer du bist dazu aufgefordert, ist es nicht empfohlen diese Werte zu erhöhen. Solltest du aber Probleme bezogen auf das Erreichen des Limits haben, _**SOLLTE**_ das Verringern dieser Werte manchmal helfen. Dein Limit wird festgelegt als `vt_quota_rate` Anfragen jeder Art in jeder `vt_quota_time` Minuten Zeitspanne.

#### "urlscanner" (Kategorie)
Ein URL-Scanner ist mit phpMussel enthalten, der bösartige URLs in Daten und gescannten Dateien erkennt.

Hinweis: Wenn der URL-Scanner deaktiviert ist, müssen Sie keine der Anweisungen in dieser Kategorie (`urlscanner`) überprüfen, da dann keine davon funktioniert.

URL-Scanner API-Abfrage Konfiguration.

"lookup_hphosts"
- Aktiviert API-Abfragen zur [hpHosts](http://hosts-file.net/) API wenn der Wert auf `true` gesetzt ist. hpHosts erfordert keinen API-Schlüssel um API-Abfragen durchzuführen.

"google_api_key"
- Aktiviert API-Abfragen zur Google Safe Browsing API wenn der benötigte API-Schlüssel festgelegt ist. Google Safe Browsing API-Abfragen erfordern einen API-Schlüssel, den Sie [hier](https://console.developers.google.com/) erhalten können.
- Hinweis: Die cURL-Erweiterung ist erforderlich, um diese Funktion zu nutzen.

"maximum_api_lookups"
- Die maximal erlaubte Anzahl von API-Abfragen die bei jedem Scan-Durchgang durchgeführt werden. Weil jede zusätzliche API-Abfrage die Zeit für einen Scan-Durchgang erhöht, wollen Sie unter Umständen ein Limit festlegen, um den gedamten Scan-Prozess zu beschleunigen. Wenn 0 eingestellt wird, wird kein Limit angewendet. Standardmäßig ist der Wert auf 10 gesetzt.

"maximum_api_lookups_response"
- Was soll passieren, wenn die maximale Anzahl der erlaubten API-Abfragen erreicht wird? False = Nichts (Verarbeitung fortführen) [Standardeinstellung]; True = Markiere/blockiere die Datei.

"cache_time"
- Wie lange (in Sekunden) sollen die Ergebnisse von API-Abfragen zwischengespeichert werden? Standardeinstellung ist 3600 Sekunden (1 Stunde).

#### "template_data" (Kategorie)
Anweisungen/Variablen für Templates und Themes.

Template-Daten bezieht sich auf die HTML-Ausgabe die verwendet wird, um die "Upload blockiert"-Nachricht Benutzern anzuzeigen, wenn eine hochgeladene Datei blockiert wird. Falls Sie benutzerdefinierte Themes für phpMussel verwenden, wird die HTML-Ausgabe von der `template_custom.html`-Datei verwendet, ansonsten wird die HTML-Ausgabe von der `template.html`-Datei verwendet. Variablen, die in diesem Bereich der Konfigurations-Datei festgelegt werden, werden als HTML-Ausgabe geparst, indem jede Variable mit geschweiften Klammern innerhalb der HTML-Ausgabe mit den entsprechenden Variablen-Daten ersetzt wird. Zum Beispiel, wenn `foo="bar"`, dann wird jedes Exemplar mit `<p>{foo}</p>` innerhalb der HTML-Ausgabe zu `<p>bar</p>`.

"theme"
- Standard-Thema für phpMussel verwenden.

"css_url"
- Die Template-Datei für benutzerdefinierte Themes verwendet externe CSS-Regeln, wobei die Template-Datei für das normale Theme interne CSS-Regeln verwendet. Um phpMussel anzuweisen, die Template-Datei für benutzerdefinierte Themes zu verwenden, geben Sie die öffentliche HTTP-Adresse von den CSS-Dateien des benutzerdefinierten Themes mit der `css_url`-Variable an. Wenn Sie diese Variable leer lassen, wird phpMussel die Template-Datei für das normale Theme verwenden.

---


### 8. <a name="SECTION8"></a>SIGNATURENFORMAT

#### *DATEINAMEN-SIGNATUREN*
Alle Dateinamen-Signaturen besitzen folgendes Format:

`NAME:FNRX`

NAME ist der Name, um die Signatur zu benennen und FNRX ist das Regex-Erkennungsmuster zum Vergleich von (nicht kodierten) Dateinamen.

#### *MD5-SIGNATUREN*
Alle MD5-Signaturen besitzen folgendes Format:

`HASH:FILESIZE:NAME`

HASH ist der MD5-Hash der ganzen Datei, FILESIZE ist die gesamte Größe der Datei und NAME ist der Name, um die Signatur zu benennen.

#### *PE-SECTIONAL-SIGNATUREN*
Alle PE-Sectional-Signaturen besitzen folgendes Format:

`SIZE:HASH:NAME`

HASH ist der MD5-Hash einer PE-Sektion der Datei, FILESIZE ist die gesamte Größe der PE-Sektion und NAME ist der Name, um die Signatur zu benennen.

#### *PE-ERWEITERT-SIGNATUREN*
Alle PE-Erweitert-Signaturen besitzen folgendes Format:

`$VAR:HASH:SIZE:NAME`

Wo $VAR der Name der zu prüfenden PE-Variable ist, HASH ist der MD5-Hash von dieser Variable, SIZE ist die gesamte Größe von dieser Variable und NAME ist der Name für diese Signatur.

#### *WHITELIST-SIGNATUREN*
Alle Whitelist-Signaturen besitzen folgendes Format:
`HASH:FILESIZE:NAME`

HASH ist der MD5-Hash der ganzen Datei, FILESIZE ist die gesamte Größe der Datei und TYPE ist der Signaturtyp der whitegelisteten Datei, gegen die sie immun ist.

#### *KOMPLEX-ERWEITERT-SIGNATUREN*
Komplex-Erweitert-Signaturen sind ziemlich unterschiedlich zu anderen Arten von möglichen Signaturen für phpMussel. Insofern, dass sie gegen das übereinstimmen was die Signaturen spezifizieren und das können mehrere Kriterien sein. Die Übereinstimmungs-Kriterien werden durch ";" getrennt und der Übereinstimmungs-Typ und die Übereinstimmungs-Daten jedes Übereinstimmungskriteriums ist durch ":" getrennt sodass das Format für diese Signaturen in etwa so aussieht:

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

#### *ALLE SONSTIGEN SIGNATUREN*
Alle sonstigen Signaturen besitzen folgendes Format:

`NAME:HEX:FROM:TO`

NAME ist der Name, um die Signatur zu benennen und HEX ist ein hexidezimal-kodiertes Segment der Datei, welches mit der gegebenen Signatur geprüft werden soll. FROM und TO sind optionale Parameter, sie geben Start- und Endpunkt in den Quelldaten zur Überprüfung an.

#### *REGEX*
Jede Form von regulären Ausdrücken, die von PHP verstanden und korrekt ausgeführt werden, sollten auch von phpMussel und den Signaturen verstanden und korrekt ausgeführt werden können. Lassen Sie extreme Vorsicht walten, wenn Sie neue Signaturen schreiben, die auf regulären Ausdrücken basieren. Wenn Sie nicht absolut sicher sind, was Sie dort machen, kann dies zu nicht korrekten und/oder unerwarteten Ergebnissen führen. Schauen Sie im Quelltext von phpMussel nach, wenn Sie sich nicht absolut sicher sind, wie die regulären Ausdrücke verarbeitet werden. Beachten Sie bitte, dass alle Suchmuster (außer Dateinamen, Archive-Metadata and MD5-Prüfmuster) hexadezimal kodiert sein müssen (mit Ausnahme von Syntax, natürlich)!

---


### 9. <a name="SECTION9"></a>BEKANNTE KOMPATIBILITÄTSPROBLEME

#### PHP und PCRE
- phpMussel benötigt PHP und PCRE, um ausgeführt werden zu können. Ohne PHP und ohne die PCRE-Erweiterungen von PHP, kann phpMussel nicht oder nicht ordnungsgemäß ausgeführt werden. Stellen Sie sicher, dass auf Ihrem System PHP und PCRE installiert und verfügbar ist, bevor Sie phpMussel herunterladen und installieren.

#### KOMPATIBILITÄT ZU ANTIVIREN-SOFTWARE

In den meisten Fällen sollte phpMussel mit den meisten anderen Antiviren-Softwareprodukten kompatibel sein. Jedoch wurden in der Vergangenheit Konflikte von anderen Nutzern festgestellt. Die folgenden Informationen stammen von VirusTotal.com, welche einige Fehlalarme von verschiedenen Antiviren-Programmen gegen phpMussel beschreiben. Diese Informationen garantieren nicht, ob Kompatibilitätsprobleme zwischen phpMussel und Ihrem eingesetzten Antiviren-Produkt bestehen. Sollte Ihre Antiviren-Software als problematisch aufgelistet sein, sollten Sie diese entweder vor der Benutzung von phpMussel deaktivieren oder sich andere Alternativen überlegen.

Diese Informationen wurden zuletzt am 29. August 2016 aktualisiert und gelten für alle phpMussel Veröffentlichungen von den beiden letzten Nebenversionen (v0.10.0-v1.0.0) zu diesem Zeitpunkt.

| Scanner              |  Ergebnisse                          |
|----------------------|--------------------------------------|
| Ad-Aware             |  Keine bekannten Probleme            |
| AegisLab             |  Keine bekannten Probleme            |
| Agnitum              |  Keine bekannten Probleme            |
| AhnLab-V3            |  Keine bekannten Probleme            |
| Alibaba              |  Keine bekannten Probleme            |
| ALYac                |  Keine bekannten Probleme            |
| AntiVir              |  Keine bekannten Probleme            |
| Antiy-AVL            |  Keine bekannten Probleme            |
| Arcabit              |  Keine bekannten Probleme            |
| Avast                |  Meldet "JS:ScriptSH-inf [Trj]"      |
| AVG                  |  Keine bekannten Probleme            |
| Avira                |  Keine bekannten Probleme            |
| AVware               |  Keine bekannten Probleme            |
| Baidu                |  Meldet "VBS.Trojan.VBSWG.a"         |
| Baidu-International  |  Keine bekannten Probleme            |
| BitDefender          |  Keine bekannten Probleme            |
| Bkav                 |  Meldet "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell", "VEXEFFC.Webshell"|
| ByteHero             |  Keine bekannten Probleme            |
| CAT-QuickHeal        |  Keine bekannten Probleme            |
| ClamAV               |  Keine bekannten Probleme            |
| CMC                  |  Keine bekannten Probleme            |
| Commtouch            |  Keine bekannten Probleme            |
| Comodo               |  Keine bekannten Probleme            |
| Cyren                |  Keine bekannten Probleme            |
| DrWeb                |  Keine bekannten Probleme            |
| Emsisoft             |  Keine bekannten Probleme            |
| ESET-NOD32           |  Keine bekannten Probleme            |
| F-Prot               |  Keine bekannten Probleme            |
| F-Secure             |  Keine bekannten Probleme            |
| Fortinet             |  Keine bekannten Probleme            |
| GData                |  Keine bekannten Probleme            |
| Ikarus               |  Keine bekannten Probleme            |
| Jiangmin             |  Keine bekannten Probleme            |
| K7AntiVirus          |  Keine bekannten Probleme            |
| K7GW                 |  Keine bekannten Probleme            |
| Kaspersky            |  Keine bekannten Probleme            |
| Kingsoft             |  Keine bekannten Probleme            |
| Malwarebytes         |  Keine bekannten Probleme            |
| McAfee               |  Meldet "New Script.c"               |
| McAfee-GW-Edition    |  Meldet "New Script.c"               |
| Microsoft            |  Keine bekannten Probleme            |
| MicroWorld-eScan     |  Keine bekannten Probleme            |
| NANO-Antivirus       |  Keine bekannten Probleme            |
| Norman               |  Keine bekannten Probleme            |
| nProtect             |  Keine bekannten Probleme            |
| Panda                |  Keine bekannten Probleme            |
| Qihoo-360            |  Keine bekannten Probleme            |
| Rising               |  Keine bekannten Probleme            |
| Sophos               |  Keine bekannten Probleme            |
| SUPERAntiSpyware     |  Keine bekannten Probleme            |
| Symantec             |  Keine bekannten Probleme            |
| Tencent              |  Keine bekannten Probleme            |
| TheHacker            |  Keine bekannten Probleme            |
| TotalDefense         |  Keine bekannten Probleme            |
| TrendMicro           |  Keine bekannten Probleme            |
| TrendMicro-HouseCall |  Keine bekannten Probleme            |
| VBA32                |  Keine bekannten Probleme            |
| VIPRE                |  Keine bekannten Probleme            |
| ViRobot              |  Keine bekannten Probleme            |
| Zillya               |  Keine bekannten Probleme            |
| Zoner                |  Keine bekannten Probleme            |

---


### 10. <a name="SECTION10"></a>HÄUFIG GESTELLTE FRAGEN (FAQ)

#### Was ist eine "Signatur"?

Im Kontext von phpMussel, eine "Signatur" bezieht sich auf Daten, die als Indikator/Identifikator fungieren, für etwas Bestimmtes das wir suchen, in der Regel in Form eines sehr kleinen, deutlichen, unschädlichen Segments von etwas Größerem und sonst schädlich, so wie ein Virus oder Trojaner, oder in Form einer Datei-Prüfsumme, Hash oder einer anderen identifizierenden Indikator, und enthält in der Regel ein Label, und einige andere Daten zu helfen, zusätzliche Kontext, die von phpMussel verwendet werden können, um den besten Weg zu bestimmen, wenn es aufsieht was wir suchen.

#### Was ist ein "Falsch-Positiv"?

Der Begriff "Falsch-Positiv" (*Alternative: "falsch-positiv Fehler"; "falscher Alarm"*; Englisch: *false positive*; *false positive error*; *false alarm*), sehr einfach beschrieben, und in einem verallgemeinerten Kontext, verwendet wird, wenn eine Bedingung zu testen und wenn die Ergebnisse positiv sind, um die Ergebnisse dieser Tests zu entnehmen (dh, die Bedingung bestimmt wird positiv oder wahr), aber sind zu erwarten sein (oder sollte gewesen) negativ (dh, der Zustand, in Wirklichkeit, ist negativ oder falsch). Eine "Falsch-Positiv" könnte analog zu "weinen Wolf" betrachtet (wobei die Bedingung geprüft wird, ob es ein Wolf in der Nähe der Herde ist, die Bedingung "falsch" ist in dass es keinen Wolf in der Nähe der Herde, und die Bedingung wird als "positiv" berichtet durch die Schäfer durch Aufruf "Wolf, Wolf"), oder analog zu Situationen in medizinischen Tests, wobei ein Patient als mit eine Krankheit diagnostiziert, wenn sie in Wirklichkeit haben sie keine solche Krankheit.

Einige andere Begriffe verwendet: "Wahr-Positiv", "Wahr-Negativ" und "Falsch-Negativ". Eine "Wahr-Positiv" ist, wenn die Ergebnisse des Tests und der wahren Zustand beide wahr sind (oder "Positiv"), und eine "Wahr-Negativ" ist, wenn die Ergebnisse des Tests und der wahren Zustand beide falsch sind (oder "Negativ"); Eine "Wahr-Positiv" oder Eine "Wahr-Negativ" gilt als eine "korrekte Folgerung" zu sein. Der Antithese von einem "Falsch-Positiv" ist eine "Falsch-Negativ"; Eine "Falsch-Negativ" ist, wenn die Ergebnisse des Tests negativ sind (dh, die Bedingung bestimmt wird negativ oder falsch zu sein), aber sind zu erwarten sein (oder sollte gewesen) positiv (dh, der Zustand, in Wirklichkeit, ist "positiv", oder "wahr").

Im Kontext der phpMussel, Diese Begriffe beziehen sich auf der Signaturen von phpMussel, und die Dateien die Sie blockieren. Wenn phpMussel Blöcke eine Datei wegen schlechten, veraltete oder falsche Signaturen, sollte aber nicht so getan haben, oder wenn sie es tut, so aus den falschen Gründen, wir beziehen sich auf dieses Ereignis als eine "Falsch-Positiv". Wenn phpMussel, aufgrund unvorhergesehener Bedrohungen, fehlende Signaturen oder Defizite in ihren Signaturen, versagt eine Datei zu blockieren, die blockiert werden sollte, wir beziehen sich auf dieses Ereignis als eine "verpasste Erkennung" (das entspricht einem "Falsch-Negativ").

Dies kann durch die folgende Tabelle zusammengefasst werden:

&nbsp; | phpMussel sollte *KEINE* Datei blockieren | phpMussel *SOLLTE* eine Datei blockieren
---|---|---
phpMussel tut blockiert eine Datei *NICHT* | Wahr-Negativ (korrekte Folgerung) | Verpasste Erkennung (analog zu Falsch-Negativ)
phpMussel *TUT* blockiert eine Datei | __Falsch-Positiv__ | True-Positiv (korrekte Folgerung)

#### Wie häufig werden Signaturen aktualisiert?

Die Aktualisierungshäufigkeit hängt von den betreffenden Signaturdateien ab. In der Regel, alle Betreuer für phpMussel Signaturdateien versuchen ihre Signaturen so aktuell wie möglich zu halten, aber da haben wir alle anderen Verpflichtungen, unser Leben außerhalb des Projekts, und da für unsere Bemühungen um das Projekt, keiner von uns wird finanziell entschädigt (d.h., bezahlt), ein genauer Aktualisierungs-Zeitplan kann nicht garantiert werden. In der Regel, Signaturen werden aktualisiert, wann immer es genügend Zeit gibt sie zu aktualisieren, und Betreuer versuchen auf der Grundlage der Notwendigkeit und auf der Grundlage wie häufig Veränderungen unter den Bereichen auftreten zu priorisieren. Hilfe wird immer geschätzt, wenn Sie bereit bist, irgendwelche anzubieten.

#### Ich habe ein Problem bei der Verwendung von phpMussel und ich weiß nicht was ich tun soll! Bitte helfen Sie!

- Verwenden Sie die neueste Version der Software? Verwenden Sie die neuesten Versionen Ihrer Signaturdateien? Wenn die Antwort auf eine dieser beiden Fragen nein ist, Versuchen alles zuerst zu aktualisieren, und überprüfen Sie ob das Problem weiterhin besteht. Wenn es weiterhin besteht, lesen Sie weiter.
- Haben Sie alle der Dokumentation überprüft? Wenn nicht, bitte tun Sie dies. Wenn das Problem nicht mit der Dokumentation gelöst werden kann, lesen Sie weiter.
- Haben Sie die **[Frage-Seite](https://github.com/Maikuolan/phpMussel/issues)** überprüft, ob das Problem vorher erwähnt wurde? Wenn es vorher erwähnt wurde, überprüfen Sie ob irgendwelche Vorschläge, Ideen und/oder Lösungen zur Verfügung gestellt wurden, und folge wie nötig um das Problem zu lösen.
- Haben Sie das **[phpMussel Support-Forum von Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)** überprüft, ob das Problem vorher erwähnt wurde? Wenn es vorher erwähnt wurde, überprüfen Sie ob irgendwelche Vorschläge, Ideen und/oder Lösungen zur Verfügung gestellt wurden, und folge wie nötig um das Problem zu lösen.
- Wenn das Problem weiterhin besteht, informieren Sie uns bitte darüber, indem Sie eine neue Diskussion auf der Frage-Seite erstellen oder eine neue Diskussion über das Support-Forum starten.

#### Ich möchte phpMussel mit einer PHP-Version älter als 5.4.0 verwenden; Kannst du helfen?

Nein. PHP 5.4.0 erreichte offiziellen EoL ("End of Life" oder Ende des Lebens) im Jahr 2014, und Sicherheits-Unterstützung wurde im Jahr 2015 beendet. Zum Zeitpunkt des Schreibens dieses, es ist 2017 und PHP 7.1.0 ist bereits vorhanden. An dieser Zeitpunkt, Unterstützung wird für die Verwendung von phpMussel mit PHP 5.4.0 und allen verfügbaren neueren PHP Versionen zur Verfügung, aber wenn Sie versuchen phpMussel mit älteren PHP Versionen zu verwenden, Unterstützung wird zur Verfügung nicht.

#### Kann ich eine einzige phpMussel-Installation verwenden, um mehrere Domains zu schützen?

Ja. phpMussel-Installationen sind natürlich nicht auf bestimmte Domains gesperrt, und kann daher zum Schutz mehrerer Domains verwendet werden. Allgemein, wir verweisen auf phpMussel-Installationen die nur eine Domain schützen als "Single-Domain-Installationen", und Wir verweisen auf phpMussel-Installationen die mehrere Domains und/oder Subdomains schützen als "Multi-Domain-Installationen". Wenn Sie eine Multi-Domain-Installation betreiben und müssen verschiedene Sätze von Signaturdateien für verschiedene Domains verwenden, oder für verschiedene Domains muss unterschiedliche Konfiguration verwenden, das ist möglich. Nach dem Laden der Konfigurationsdatei (`config.ini`), phpMussel prüft auf die Existenz einer "Konfiguration-Überschreibt Datei", die für die Domain (oder Subdomain) spezifisch angefordert ist (`die-domain-angefordert.tld.config.ini`), und wenn gefunden, alle von der Konfiguration-Überschreibt Datei definierten Konfigurationswerte wird für die Ausführungsinstanz verwendet, anstelle der von der Konfigurationsdatei definierten Konfigurationswerte. Konfiguration-Überschreibt Dateien sind identisch mit der Konfigurationsdatei, und nach eigenem Ermessen, kann entweder die Gesamtheit aller Konfigurationsrichtlinien für phpMussel enthalten, oder was auch immer kleiner Unterabschnitt erforderlich ist die sich normalerweise von der Konfigurationsdatei definierten Konfigurationswerte unterscheidet. Konfiguration-Überschreibt Dateien werden nach der Domain für die sie bestimmt sind benannt (so zum Beispiel, wenn Sie eine Konfiguration-Überschreibt Dateien benötigen für die Domäne, `http://www.some-domain.tld/`, seine Konfiguration-Überschreibt Datei sollte benannt werden als `some-domain.tld.config.ini`, und sollte in der vault neben der Konfigurationsdatei `config.ini` platziert werden). Der Domains-Name für die Ausführungsinstanz wird aus dem `HTTP_HOST`-Header der Anforderung abgeleitet; "www" wird ignoriert.

---


Zuletzt aktualisiert: 19 Mai 2017 (2017.05.19).
