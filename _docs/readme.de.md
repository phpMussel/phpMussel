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
- 11. [RECHTSINFORMATION](#SECTION11)

*Hinweis für Übersetzungen: Im Falle von Fehlern (z.B, Diskrepanzen zwischen den Übersetzungen, Tippfehler, u.s.w.), die Englische Version des README als die ursprüngliche und maßgebliche Version ist betrachtet. Wenn Sie irgendwelche Fehler finden, ihre Hilfe bei der Korrektur wäre willkommen.*

---


### 1. <a name="SECTION1"></a>VORWORT

Vielen Dank für die Benutzung von phpMussel, einem PHP-Script, um Trojaner, Viren, Malware und andere Bedrohungen in Dateien zu entdecken, die auf Ihr System hochgeladen werden könnten, welches die Signaturen von ClamAV und weitere nutzt.

PHPMUSSEL COPYRIGHT 2013 und darüber hinaus GNU/GPLv2 by Caleb M (Maikuolan).

Dieses Skript ist freie Software; Sie können Sie weitergeben und/oder modifizieren unter den Bedingungen der GNU General Public License, wie von der Free Software Foundation veröffentlicht; entweder unter Version 2 der Lizenz oder (nach Ihrer Wahl) jeder späteren Version. Dieses Skript wird in der Hoffnung verteilt, dass es nützlich sein wird, allerdings OHNE JEGLICHE GARANTIE; ohne implizite Garantien für VERMARKTUNG/VERKAUF/VERTRIEB oder FÜR EINEN BESTIMMTEN ZWECK. Lesen Sie die GNU General Public License für weitere Details, in der Datei `LICENSE.txt`, ebenfalls verfügbar auf:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Besonderer Dank geht an [ClamAV](http://www.clamav.net/) für die Inspiration und die Signaturen, die dieses Script benutzt, ohne die dieses Script wahrscheinlich nicht existieren würde oder bestenfalls einen sehr begrenzten Wert hätte.

Besonderer Dank geht auch an SourceForge und GitHub für das Hosten der Projektdateien, und an die weiteren Quellen einiger von phpMussel verwendeten Signaturen: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) und andere, und Besonderer Dank geht an alle diejenigen die das Projekt unterstützen werden, an andere nicht erwähnte Personen, und an Sie, für die Verwendung des Scripts.

Dieses Dokument und das zugehörige Paket kann von folgenden Links kostenlos heruntergeladen werden:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>INSTALLATION

#### 2.0 MANUELL INSTALLIEREN (SERVER)

1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC. Erstellen Sie ein Verzeichnis, wohin Sie den Inhalt dieses Paketes auf Ihrem Host oder CMS installieren möchten. Ein Verzeichnis wie `/public_html/phpmussel/` o.ä. genügt, solange es Ihren Sicherheitsbedürfnissen oder persönlichen Präferenzen entspricht.

2) Die Datei `config.ini.RenameMe` (im `vault`-Verzeichnis) zu `config.ini` umbenennen, und optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender ohne entsprechende Kenntnisse), öffnen Sie diese Datei (diese Datei beinhaltet alle funktionalen Optionen für phpMussel; über jeder Option beschreibt ein kurzer Kommentar die Aufgabe dieser Option). Verändern Sie die Werte nach Ihren Bedürfnissen. Speichern und schließen Sie die Datei.

3) Laden Sie den kompletten Inhalt (phpMussel und die Dateien) in das Verzeichnis hoch, für das Sie sich in Schritt 1 entschieden haben. Die Dateien `*.txt`/`*.md` müssen nicht mit hochgeladen werden.

4) Ändern Sie die Zugriffsberechtigungen des `vault`-Verzeichnisses auf "755" (wenn es Probleme gibt, Sie können "777" versuchen; Dies ist weniger sicher, obwohl). Die Berechtigungen des übergeordneten Verzeichnises, in welchem sich der Inhalt befindet (das Verzeichnis, wofür Sie sich entschieden haben), können so belassen werden, überprüfen Sie jedoch die Berechtigungen, wenn in der Vergangenheit Zugriffsprobleme aufgetreten sind (Voreinstellung "755" o.ä.). Zusammenfassend: Damit das Paket ordnungsgemäß funktioniert, muss PHP in der Lage sein, Dateien im `vault`-Verzeichnis zu lesen und zu schreiben. Viele Dinge (Aktualisierung, Protokollierung, u.s.w.) sind nicht möglich, wenn PHP nicht in das `vault`-Verzeichnis schreiben kann, und das Paket überhaupt nicht funktioniert, wenn PHP nicht aus dem `vault`-Verzeichnis lesen kann. Zur optimalen Sicherheit darf das `vault`-Verzeichnis jedoch NICHT öffentlich zugänglich sein (sensible Informationen, wie die in `config.ini` oder `frontend.dat` enthaltenen Informationen, könnten potenziellen Angreifern ausgesetzt sein, wenn das `vault`-Verzeichnis öffentlich zugänglich ist).

5) Installiere alle Signaturen, die du brauchst. *Sehen: [SIGNATUREN INSTALLIEREN](#INSTALLING_SIGNATURES).*

6) Binden Sie phpMussel in Ihr System oder CMS ein. Es gibt viele verschiedene Möglichkeiten, ein Script wie phpMussel einzubinden, am einfachsten ist es, das Script am Anfang einer Haupt-Datei (eine Datei, die immer geladen wird, wenn irgend eine beliebige Seite Ihres Webauftritts aufgerufen wird) Ihres Systems oder CMS mit Hilfe des require- oder include-Befehls einzubinden. Üblicherweise wird eine solche Datei in Verzeichnissen wie `/includes`, `/assets` or `/functions` gespeichert und wird häufig `init.php`, `common_functions.php`, `functions.php` o.ä. genannt. Sie müssen herausfinden, welche Datei dies für Ihre Bedürfnisse ist; Wenn Sie dabei Schwierigkeiten haben das herauszufinden, besuchen Sie die phpMussel Issues-Seite oder die phpMussel Support-Foren und lassen Sie es uns wissen; Es ist möglich, dass entweder ich oder ein anderer Benutzer mit dem CMS, das Sie verwenden, Erfahrung hat (Sie müssen Sie mitteilen, welche CMS Sie verwenden) und möglicherweise in der Lage ist, etwas Unterstützung anzubieten. Fügen Sie in dieser Datei folgenden Code direkt am Anfang ein:

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Ersetzen Sie den String zwischen den Anführungszeichen mit dem lokalen Pfad der Datei `loader.php`, nicht mit der HTTP-Adresse (ähnlich dem Pfad für das `vault`-Verzeichnis). Speichern und schließen Sie die Datei, laden Sie sie ggf. erneut hoch.

-- ODER ALTERNATIV --

Wenn Sie einen Apache-Webserver haben und wenn Sie Zugriff auf die `php.ini` oder eine ähnliche Datei haben, dann können Sie die `auto_prepend_file` Direktive verwenden um phpMussel voranstellen wenn eine PHP-Anfrage erfolgt. Ungefähr so:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Oder das in der `.htaccess` Datei:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das Programm auf ordnungsgemäße Funktion testen. Sie sollten nun die im Paket enthaltenen Testdateien `_testfiles` auf Ihre Webseite über die gewöhnlichen browserbasierten Methoden hochladen. Funktioniert das Programm ordnungsgemäß, erscheint eine Meldung von phpMussel, dass der Upload erfolgreich blockiert wurde. Erscheint keine Meldung, funktioniert das Programm nicht korrekt. Nutzen Sie andere erweiterte Funktionen oder weitere mögliche Arten von Scannern dieses Programms, so sollten Sie diese ebenfalls testen, um die ordnungsgemäße Funktion sicherzustellen.

#### 2.1 MANUELL INSTALLIEREN (CLI - BEFEHLSZEILENMODUS)

1) Entpacken Sie das heruntergeladene Archiv auf Ihren lokalen PC in ein Verzeichnis, das Ihren Sicherheitsbedürfnissen oder persönlichen Präferenzen entspricht.

2) phpMussel benötigt eine installierte PHP-Umgebung, um ausgeführt werden zu können. Sofern PHP bei Ihnen nicht installiert ist, installieren Sie es bitte nach den Anweisungen des PHP-Installers.

3) Optional (empfohlen für erfahrene Anwender, nicht empfohlen für Anwender ohne entsprechende Kenntnisse), öffnen Sie die Datei `config.ini` im `vault`-Verzeichnis) – Diese Datei beinhaltet alle funktionalen Optionen für phpMussel. Über jeder Option beschreibt ein kurzer Kommentar die Aufgabe dieser Option. Verändern Sie die Werte nach Ihren Bedürfnissen. Speichern und schließen Sie die Datei.

4) Optional, Sie können den Start von phpMussel vereinfachen, indem Sie mittels einer Stapelverarbeitungsdatei PHP und phpMussel automatisch laden. Öffnen Sie einen einfachen Texteditor wie Editor oder Notepad++, tragen Sie den vollständigen Pfad zu Ihrer `php.exe` im Verzeichnis Ihrer PHP-Installation ein, gefolgt von einem Leerzeichen und dem vollständigen Pfad zur `loader.php` im Verzeichnis Ihrer phpMussel-Installation, speichern diese Datei mit einer `.bat`-Dateierweiterung an einem Ort, wo Sie sie leicht finden können und führen Sie sie zukünfig nur noch mit einem Doppelklick aus.

5) Installiere alle Signaturen, die du brauchst. *Sehen: [SIGNATUREN INSTALLIEREN](#INSTALLING_SIGNATURES).*

6) Der Installationsvorgang wurde nun fertiggestellt. Sie sollten nun das Programm auf ordnungsgemäße Funktion testen. Um den Test durchzuführen, führen Sie bitte phpMussel aus und versuchen Sie, das Verzeichnis `_testfiles` in diesem Installationspaket zu scannen.

#### 2.2 INSTALLATION MIT COMPOSER

[phpMussel ist bei Packagist registriert](https://packagist.org/packages/phpmussel/phpmussel), und so, wenn Sie mit Composer vertraut sind, können Sie Composer verwenden, um phpMussel zu installieren (musst Sie dennoch die Konfiguration und Hooks aber vorbereiten; Siehe "manuell installieren (server)" der Schritte 2 und 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 SIGNATUREN INSTALLIEREN

Seit v1.0.0, Signaturen werden nicht mit phpMussel enthalten. Signaturen werden von phpMussel benötigt, um bestimmte Bedrohungen zu erkennen. Es gibt 3 Hauptmethoden, um Signaturen zu installieren:

1. Installieren Sie automatisch die Front-End-Updates-Seite.
2. Signaturen mit "SigTool" generieren und manuell installieren.
3. Signaturen aus "phpMussel/Signatures" herunterladen und manuell installieren.

##### 2.3.1 Installieren Sie automatisch die Front-End-Updates-Seite.

Zuerst, müssen Sie sicherstellen, dass das Front-End aktiviert ist. *Sehen: [FRONT-END-MANAGEMENT](#SECTION4).*

Dann alles was Sie tun müssen, ist auf die Front-End-Updates-Seite gehen, finden Sie die notwendigen Signaturdateien, und mit die Optionen auf der Seite, installieren, und aktivieren.

##### 2.3.2 Signaturen mit "SigTool" generieren und manuell installieren.

*Sehen: [SigTool Dokumentation](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Signaturen aus "phpMussel/Signatures" herunterladen und manuell installieren.

Zuerst, nach [phpMussel/Signatures](https://github.com/phpMussel/Signatures) gehen. Das Repository enthält verschiedene GZ-komprimierte Signaturdateien. Laden Sie die Dateien herunter, die du brauchst, dekomprimieren und kopieren Sie die dekomprimierten Dateien in das `/vault/signatures`-Verzeichnis um sie zu installieren. Auflisten der Namen der kopierten Dateien an die `Active`-Direktive in deiner phpMussel-Konfiguration um sie zu aktivieren.

---


### 3. <a name="SECTION3"></a>BENUTZUNG

#### 3.0 BENUTZUNG (SERVER)

phpMussel ist dafür vorgesehen, fast vollständig autonom zu funktionieren, ohne dass Sie etwas tun müssen: Sobald es installiert ist, führt es die Tätigkeiten allein aus.

Das Scannen von Dateiuploads ist automatisiert und standardmäßig eingeschaltet, Sie müssen nichts weiter unternehmen.

Sie sind jedoch auch in der Lage, phpMussel anzuweisen, spezifische Dateien, Ordner und/oder Archive zu scannen. Um dies auszuführen, stellen Sie sicher, dass diese Konfiguration in der `config.ini` festgelegt ist (`cleanup` muss deaktiviert sein). Erstellen Sie eine mit phpMussel eingebundene PHP-Datei mit folgender Closure:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` kann ein String, ein Array oder ein Array von Arrays sein und gibt an, welche Datei, Dateien, Ordner und/oder Ordner gescannt werden sollen.
- `$output_type` ist ein boolescher Wert und gibt an, in welchem Format die Scan-Ergebnisse zurückgegeben werden sollen. `false` weist die Funktion an, Ergebnisse als Integer (Ganzzahl) zurückzugeben. `true` weist die Funktion an, Ergebnisse als lesbaren Text zurückzugeben. Zusätzlich können in beiden Fällen auf die Ergebnisse über globale Variablen nach dem Scannen zugegriffen werden. Diese Variable ist optional und standardmäßig auf `false`. Im Folgenden werden die Integer-Ergebnisse beschrieben:

| Ergebnisse | Beschreibung |
|---|---|
| -3 | Zeigt an, dass es Probleme mit den phpMussel Signatur-Dateien oder Signatur-Map-Dateien gibt und dass sie wahrscheinlich fehlen oder beschädigt sind. |
| -2 | Zeigt an, dass beschädigte Dateien gefunden wurden und der Scan nicht abgeschlossen wurde. |
| -1 | Zeigt an, dass fehlende Erweiterungen oder Addons von PHP benötigt werden, um den Scan durchzuführen und der Scan deshalb nicht abgeschlossen wurde. |
| 0 | Zeigt an, dass das Ziel nicht existiert und somit nichts überprüft werden konnte. |
| 1 | Zeigt an, dass das Ziel erfolgreich geprüft wurde und keine Probleme erkannt wurden. |
| 2 | Zeigt an, dass das Ziel erfolgreich geprüft wurde, jedoch Probleme gefunden wurden. |

- `$output_flatness` ist ein boolescher Wert und gibt der Funktion an, ob die Ergebnisse vom Scannen (falls mehrere Scan-Ziele existieren) als Array oder String zurückgegeben werden sollen. `false` wird die Ergebnisse als Array zurückgeben. `true` wird die Ergebnisse als String zurückgeben. Diese Variable ist optional und standardmäßig auf `false`.

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

Eine vollständige Liste der Signaturen, die phpMussel nutzt und wie diese verarbeitet werden, finden Sie im Abschnitt [SIGNATURENFORMAT](#SECTION8).

Sollten irgendwelche Fehlalarme (oder "Falsch-Positivs") auftreten, Sie etwas entdecken, was Ihrer Meinung nach blockiert werden sollte oder etwas mit den Signaturen nicht funktionieren, so informieren Sie den Autor, damit die erforderlichen Änderungen durchgeführt werden können. *(Beziehen auf: [Was ist ein "Falsch-Positiv"?](#WHAT_IS_A_FALSE_POSITIVE)).*

Um die Signaturen, die in phpMussel enthalten sind, zu deaktivieren, fügen Sie die Namen der spezifischen Signatur, die deaktiviert werden soll, durch Kommata abgetrennt, in die Signaturen-Greylist-Datei ein (`/vault/greylist.csv`).

*Siehe auch: [Wie man spezifische Details über Dateien zugreifen, wenn sie gescannt werden?](#SCAN_DEBUGGING)*

#### 3.1 BENUTZUNG (CLI - BEFEHLSZEILENMODUS)

Bitte lesen Sie den Abschnitt "MANUELL INSTALLIEREN (CLI - BEFEHLSZEILENMODUS)".

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

Für eine optimale Sicherheit wird außerdem empfohlen, die "Zwei-Faktor-Authentifizierung" für alle Front-End-Konten zu aktivieren (Anweisungen unten).

#### 4.2 WIE MAN DAS FRONT-END BENUTZT.

Anweisungen sind auf jeder Seite des Front-Ends vorhanden, um die richtige Verwendung und den vorgesehenen Zweck zu erläutern. Wenn Sie weitere Erklärungen oder spezielle Hilfe benötigen, wenden Sie sich bitte an den Support. Alternativ gibt es einige Videos auf YouTube, die durch Demonstration helfen könnte.

#### 4.3 ZWEI-FAKTOR-AUTHENTIFIZIERUNG

Es ist möglich, das Front-End sicherer zu machen, indem Sie die Zwei-Faktor-Authentifizierung ("2FA") aktivieren. Wenn Sie sich bei einem 2FA-aktivierten Konto eingeloggt, wird eine E-Mail an die mit diesem Konto verknüpfte E-Mail-Adresse gesendet. Diese E-Mail enthält einen "2FA-Code", den der Nutzer zusätzlich zum Benutzernamen und Passwort eingeben muss, um sich mit diesem Konto einloggen zu können. Das bedeutet, dass das Erlangen eines Kontopassworts nicht ausreicht, damit sich ein Hacker oder potentieller Angreifer in diesem Konto einloggen kann, da sie auch bereits Zugriff auf die mit diesem Konto verknüpfte E-Mail-Adresse haben müssen, um den mit der Sitzung verbundenen 2FA-Code empfangen und verwenden zu können, dadurch wird das Front-End sicherer.

Um die Zwei-Faktor-Authentifizierung zu aktivieren, verwenden Sie zunächst die Front-End-Aktualisierungsseite, um die PHPMailer-Komponente zu installieren. phpMussel verwendet PHPMailer zum Senden von E-Mails. Hinweis: Obwohl phpMussel selbst mit PHP >= 5.4.0 kompatibel ist, PHPMailer benötigt PHP >= 5.5.0. Daher ist eine Zwei-Faktor-Authentifizierung für das phpMussel-Front-End für PHP 5.4-Benutzer nicht möglich.

Nachdem Sie PHPMailer installiert haben, müssen Sie die Konfigurationsdirektiven für PHPMailer über die phpMussel-Konfigurationsseite oder Konfigurationsdatei auffüllen. Weitere Informationen zu diesen Konfigurationsanweisungen finden Sie im Konfigurationsabschnitt dieses Dokuments. Nachdem Sie die PHPMailer-Konfigurationsdirektiven gefüllt haben, setzen Sie `Enable2FA` auf `true`. Die Zwei-Faktor-Authentifizierung sollte jetzt aktiviert sein.

Nächster, müssen Sie eine E-Mail-Adresse mit einem Konto verknüpfen, damit phpMussel bei der Einloggen mit diesem Konto weiß, wohin die 2FA-Codes gesendet werden müssen. Um dies zu tun, verwenden Sie die E-Mail-Adresse als Nutzername für das Konto (wie `foo@bar.tld`), oder fügen Sie die E-Mail-Adresse als Teil des Benutzernamens genauso ein wie beim normalen Senden einer E-Mail (wie `Foo Bar <foo@bar.tld>`).

Hinweis: Besonders wichtig ist hier der Schutz Ihres Vault vor unbefugtem Zugriff (z.B., durch die Stärkung der Sicherheit Ihres Servers und die Einschränkung der öffentlichen Zugriffsrechte), da ein unbefugter Zugriff auf Ihre Konfigurationsdatei (die in Ihrem Vault gespeichert ist), Ihre Einstellungen für ausgehenden SMTP (einschließlich SMTP-Benutzername und Passwort) gefährden könnte. Sie sollten sicherstellen, dass Ihr Vault ordnungsgemäß gesichert ist, bevor Sie die Zwei-Faktor-Authentifizierung aktivieren. Wenn dies nicht möglich ist, sollten Sie zumindest ein neues E-Mail-Konto erstellen, das speziell für diesen Zweck vorgesehen ist, um die mit freiliegenden SMTP-Einstellungen verbundenen Risiken zu verringern.

---


### 5. <a name="SECTION5"></a>CLI (BEFEHLSZEILENMODUS)

phpMussel kann als interaktiver Scanner im CLI-Modus in einer Windows-Systemumgebung genutzt werden. Bitte lesen Sie den Abschnitt INSTALLATION (CLI - BEFEHLSZEILENMODUS).

Um eine Liste der verfügbaren CLI-Befehle zu erhalten, geben Sie in der Befehlszeile 'c' ein und bestätigen Sie mit Enter.

Zusätzlich, für Interessenten, ein Video-Tutorial, wie phpMussel im CLI-Modus zu verwenden, können finden Sie hier:
- <https://youtu.be/H-Pa740-utc>

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
/vault/fe_assets/_2fa.html | Ein HTML-Template die verwendet wird wenn der Benutzer nach einem 2FA-Code gefragt wird.
/vault/fe_assets/_accounts.html | Ein HTML-Template für das Front-End Konten-Seite.
/vault/fe_assets/_accounts_row.html | Ein HTML-Template für das Front-End Konten-Seite.
/vault/fe_assets/_cache.html | Ein HTML-Template für die Front-End Datencache-Seite.
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
/vault/fe_assets/_quarantine.html | Ein HTML-Template für die Front-End Quarantäneseite.
/vault/fe_assets/_quarantine_row.html | Ein HTML-Template für die Front-End Quarantäneseite.
/vault/fe_assets/_siginfo.html | Ein HTML-Template für die Front-End Signature-Information-Seite.
/vault/fe_assets/_siginfo_row.html | Ein HTML-Template für die Front-End Signature-Information-Seite.
/vault/fe_assets/_statistics.html | Ein HTML-Template für die Front-End Statistikseite.
/vault/fe_assets/_updates.html | Ein HTML-Template für das Front-End Aktualisierungen-Seite.
/vault/fe_assets/_updates_row.html | Ein HTML-Template für das Front-End Aktualisierungen-Seite.
/vault/fe_assets/_upload_test.html | Ein HTML-Template für die Upload-Testseite.
/vault/fe_assets/frontend.css | CSS-Stylesheet für das Front-End.
/vault/fe_assets/frontend.dat | Datenbank für das Front-End (Enthält Kontoinformationen und Sitzungsinformationen; nur erzeugt wenn das Frontend aktiviert und verwendet wird).
/vault/fe_assets/frontend.dat.safety | Als Sicherheitsmechanismus generiert wenn es benötigt wird.
/vault/fe_assets/frontend.html | Die Haupt-HTML-Template-Datei für das Front-End.
/vault/fe_assets/icons.php | Ikonen-Handler (die vom Front-End-Dateimanager verwendet wird).
/vault/fe_assets/pips.php | Pips-Handler (die vom Front-End-Dateimanager verwendet wird).
/vault/fe_assets/scripts.js | Enthält Front-End-JavaScript-Daten.
/vault/lang/ | Enthält Sprachdaten für phpMussel.
/vault/lang/.htaccess | Ein Hypertext-Access-Datei (in diesem Fall zum Schutz von sensiblen Dateien des Scripts vor einem nicht authorisierten Zugriff).
/vault/lang/lang.ar.fe.php | Arabische Sprachdateien für das Front-End.
/vault/lang/lang.ar.php | Arabische Sprachdateien.
/vault/lang/lang.bn.fe.php | Bangla Sprachdateien für das Front-End.
/vault/lang/lang.bn.php | Bangla Sprachdateien.
/vault/lang/lang.de.fe.php | Deutsche Sprachdateien für das Front-End.
/vault/lang/lang.de.php | Deutsche Sprachdateien.
/vault/lang/lang.en.fe.php | Englische Sprachdateien für das Front-End.
/vault/lang/lang.en.php | Englische Sprachdateien.
/vault/lang/lang.es.fe.php | Spanische Sprachdateien für das Front-End.
/vault/lang/lang.es.php | Spanische Sprachdateien.
/vault/lang/lang.fr.fe.php | Französische Sprachdateien für das Front-End.
/vault/lang/lang.fr.php | Französische Sprachdateien.
/vault/lang/lang.hi.fe.php | Hindi Sprachdateien für das Front-End.
/vault/lang/lang.hi.php | Hindi Sprachdateien.
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
/vault/lang/lang.tr.fe.php | Türkische Sprachdateien für das Front-End.
/vault/lang/lang.tr.php | Türkische Sprachdateien.
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
/vault/.travis.php | Wird von Travis CI zum Testen verwendet (für die korrekte Funktion des Scripts nicht notwendig).
/vault/.travis.yml | Wird von Travis CI zum Testen verwendet (für die korrekte Funktion des Scripts nicht notwendig).
/vault/cli.php | CLI-Handler.
/vault/config.ini.RenameMe | Konfigurationsdatei; Beinhaltet alle Konfigurationsmöglichkeiten von phpMussel (umbenennen zu aktivieren).
/vault/config.php | Konfiguration-Handler.
/vault/config.yaml | Standardkonfigurationsdatei; Beinhaltet Standardkonfigurationswerte für phpMussel.
/vault/components.dat | Komponenten-Metadaten-Datei; Wird von der Front-End-Updates-Seite verwendet.
/vault/frontend.php | Front-End-Handler.
/vault/frontend_functions.php | Front-End-Funktionen-Datei.
/vault/functions.php | Funktionen-Datei.
/vault/greylist.csv | CSV der Signaturen in der Greylist, die phpMussel ignorieren soll (Datei wird nach dem Löschen automatisch neu erstellt).
/vault/lang.php | Sprachdateien.
/vault/php5.4.x.php | Polyfills für PHP 5.4.X (erforderlich für Abwärtskompatibilität mit PHP 5.4.X; sicher zu löschen für neuere PHP-Versionen).
/vault/plugins.dat | Plugins-Metadaten-Datei; Wird von der Front-End-Updates-Seite verwendet.
※ /vault/scan_kills.txt | Eine Aufzeichnung aller von phpMussel blockierten Dateiuploads.
※ /vault/scan_log.txt | Eine Aufzeichnung aller von phpMussel gescannten Objekte.
※ /vault/scan_log_serialized.txt | Eine Aufzeichnung aller von phpMussel gescannten Objekte.
/vault/shorthand.yaml | Enthält verschiedene Signatur-Identifikatoren, die von phpMussel bei der Interpretation von Signatur-Kurzschrift während eines Scans, und beim Zugriff auf Signatur-Informationen über das Front-End verarbeitet werden.
/vault/signatures.dat | Signatur-Metadaten-Datei; Wird von der Front-End-Updates-Seite verwendet.
/vault/template_custom.html | Template Datei; Template für die HTML-Ausgabe mit der Nachricht, dass der Dateiupload von phpMussel blockiert wurde (Nachricht, die dem Nutzer angezeigt wird).
/vault/template_default.html | Template Datei; Template für die HTML-Ausgabe mit der Nachricht, dass der Dateiupload von phpMussel blockiert wurde (Nachricht, die dem Nutzer angezeigt wird).
/vault/themes.dat | Themes-Metadaten-Datei; Wird von der Front-End-Updates-Seite verwendet.
/vault/upload.php | Upload-Handler.
/.gitattributes | Ein GitHub Projektdatei (für die korrekte Funktion des Scripts nicht notwendig).
/.gitignore | Ein GitHub Projektdatei (für die korrekte Funktion des Scripts nicht notwendig).
/Changelog-v1.txt | Eine Auflistung der Änderungen des Scripts der verschiedenen Versionen (für die korrekte Funktion des Scripts nicht notwendig).
/composer.json | Composer/Packagist Informationen (für die korrekte Funktion des Scripts nicht notwendig).
/CONTRIBUTING.md | Wie Sie dazu beitragen für das Projekt.
/LICENSE.txt | Eine Kopie der GNU/GPLv2 Lizenz (für die korrekte Funktion des Scripts nicht notwendig).
/loader.php | Loader. Diese Datei wird in Ihr CMS eingebunden (notwendig)!
/PEOPLE.md | Informationen zu den am Projekt beteiligten Personen.
/README.md | Projektübersicht.
/web.config | Eine ASP.NET-Konfigurationsdatei (in diesem Fall zum Schutz des Verzeichnisses `/vault` vor einem nicht authorisierten Zugriff, sofern das Script auf einem auf der ASP.NET-Technologie basierenden Server installiert wurde).

※ Der Dateiname kann je nach Konfiguration in der `config.ini` variieren.

---


### 7. <a name="SECTION7"></a>EINSTELLUNGEN
Nachfolgend finden Sie eine Liste der Variablen in der Konfigurationsdatei `config.ini` mit einer kurzen Beschreibung ihrer Funktionen.

#### "general" (Kategorie)
Generelle Konfiguration von phpMussel.

##### "cleanup"
- Löscht die Scriptvariablen und den Cache nach der Ausführung. False = Nicht löschen; True = Löschen [Standardeinstellung]. Sollten Sie das Script nach der Überprüfung des Uploads nicht mehr nutzen, stellen Sie diese Option auf `true`, um die Speichernutzung zu minimieren. Verwenden Sie das Script noch für weitere Zwecke, stellen Sie die Option auf `false`, um unnötiges mehrfaches Einlesen der Daten in den Speicher zu vermeiden. Normalerweise sollte diese Option auf `true` gesetzt werden, allerdings können Sie das Script dann nur zur Dateiüberprüfung verwenden.
- Kein Einfluss im CLI-Modus.

##### "scan_log"
- Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

##### "scan_log_serialized"
- Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen (Format ist serialisiert). Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

##### "scan_kills"
- Name einer Datei zum Aufzeichnen aller blockierten Uploads. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

*Nützlicher Tipp: Wenn du willst, Sie können die Datum/Uhrzeit um die Aufzeichnungen hinzufügen durch diese im Namen einschließlich: `{yyyy}` für komplette Jahr, `{yy}` für abgekürzten Jahr, `{mm}` für Monat, `{dd}` für Tag, `{hh}` für Stunde.*

*Beispielen:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

##### "truncate"
- Trunkate Protokolldateien, wenn sie eine bestimmte Größe erreichen? Wert ist die maximale Größe in B/KB/MB/GB/TB, die eine Protokolldatei wachsen kann, bevor sie trunkiert wird. Der Standardwert von 0KB deaktiviert die Trunkierung (Protokolldateien können unbegrenzt wachsen). Hinweis: Gilt für einzelne Protokolldateien! Die Größe der Protokolldateien gilt nicht als kollektiv.

##### "log_rotation_limit"
- Die Protokollrotation begrenzt die Anzahl der Protokolldateien, die gleichzeitig vorhanden sein sollten. Wenn neue Protokolldateien erstellt werden, und wenn die Gesamtzahl der Protokolldateien den angegebenen Limit überschreitet, wird die angegebene Aktion ausgeführt. Sie können hier das gewünschte Limit angeben. Ein Wert von 0 deaktiviert die Protokollrotation.

##### "log_rotation_action"
- Die Protokollrotation begrenzt die Anzahl der Protokolldateien, die gleichzeitig vorhanden sein sollten. Wenn neue Protokolldateien erstellt werden, und wenn die Gesamtzahl der Protokolldateien den angegebenen Limit überschreitet, wird die angegebene Aktion ausgeführt. Sie können hier die gewünschte Aktion angeben. Delete = Löschen Sie die ältesten Protokolldateien, bis das Limit nicht mehr überschritten wird. Archive = Zuerst archivieren, und dann löschen Sie die ältesten Protokolldateien, bis das Limit nicht mehr überschritten wird.

*Technische Erläuterung: "Ältesten" bedeutet, in diesem Zusammenhang, am wenigsten kurzem geändert.*

##### "timeOffset"
- Wenn Ihr Serverzeit nicht mit Ihrer Ortszeit, Sie können einen Offset hier angeben. Der Zeitversatz ist Minute-basiert.
- Beispiel (eine Stunde hinzufügen): `timeOffset=60`

##### "timeFormat"
- Das Datumsformat verwendet von phpMussel. Standardeinstellung = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

##### "ipaddr"
- Ort der IP-Adresse der aktuellen Verbindung im gesamten Datenstrom (nützlich für Cloud-Services) Standardeinstellung = REMOTE_ADDR. Achtung: Ändern Sie diesen Wert nur wenn Sie wissen was Sie tun!

Empfohlene Werte für "ipaddr":

Wert | Verwenden
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula Reverse Proxy.
`HTTP_CF_CONNECTING_IP` | Cloudflare Reverse Proxy.
`CF-Connecting-IP` | Cloudflare Reverse Proxy (Alternative; Wenn der andere Wert nicht funktioniert).
`HTTP_X_FORWARDED_FOR` | Cloudbric Reverse Proxy.
`X-Forwarded-For` | [Squid Reverse Proxy](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Definiert durch Server-Konfiguration.* | [Nginx Reverse Proxy](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Kein Reverse Proxy (Standardwert).

##### "enable_plugins"
- Aktivieren Sie die Unterstützung für phpMussel Plugins? False = Nein; True = Ja [Standardeinstellung].

##### "forbid_on_block"
- Zurückgegebener 403-HTTP-Header bei einem blockierten Dateiupload. False = Nein (200); True = Ja (403) [Standardeinstellung].

##### "delete_on_sight"
- Diese Option weist das Script an, Dateien während eines Scans sofort zu löschen, wenn ein Erkennungsmerkmal, ob durch Signaturen oder andere Methoden, zutrifft. Dateien, die als nicht infiziert eingestuft werden, werden nicht berührt. Im Falle von Archiven wird das gesamte Archiv gelöscht, auch wenn nur eine einzige Datei im Archiv infiziert sein sollte. Normalerweise ist es bei einem Dateiupload nicht notwendig, diese Option zu aktivieren, da PHP nach der Ausführung von Scripten den Inhalt vom Cache löscht, d.h. PHP löscht jede Datei, die über den Server hochgeladen wird, sofern Sie nicht verschoben, kopiert oder bereits gelöscht wurde. Diese Option wurde als zusätzliches Mass an Sicherheit hinzugefügt, außerdem für Systeme, deren PHP-Installation nicht dem üblichen Verhalten entspricht. False = Nach der Überprüfung wird die Datei so belassen [Standardeinstellung]; True = Nach der Überprüfung wird die Datei sofort gelöscht, sofern Sie infiziert ist.

##### "lang"
- Gibt die Standardsprache für phpMussel an.

##### "numbers"
- Gibt an, wie die Nummern angezeigt werden sollen.

Derzeit unterstützte Werte:

Wert | Produziert | Beschreibung
---|---|---
`NoSep-1` | `1234567.89`
`NoSep-2` | `1234567,89`
`Latin-1` | `1,234,567.89` | Standardwert.
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

*Beachten: Diese Werte sind nirgends standardisiert und werden wahrscheinlich nicht über das Paket hinaus relevant sein. Auch, unterstützte Werte können sich in Zukunft ändern.*

##### "quarantine_key"
- phpMussel ist in der Lage, Versuche von Datei-Uploads in einem Quarantäne-Verzeichnis zu isolieren, sofern Sie dies tun wollen. Nutzer, die nur daran interessiert sind, ihre Webauftritte oder ihre Hosting-Umgebung zu schützen ohne das Interesse, die markierten Dateien weitergehend zu untersuchen, sollten diese Funktionalität deaktivieren, Nutzer, die diese Dateien zur Ananlyse auf Malware o.ä. benötigen, sollten diese Funktion aktivieren. Die Isolation von markierten Dateien kann manchmal auch bei der Fehlersuche von Fehlalarmen helfen, wenn dies häufiger bei Ihnen auftritt. Um die Quarantänefunktion zu deaktivieren, lassen Sie die Richtlinie `quarantine_key` leer oder löschen Sie den Inhalt dieser Richtlinie, wenn sie nicht bereits leer ist. Um die Quarantänefunktion zu aktivieren, geben Sie einen Wert ein. Der `quarantine_key` ist ein wichtiges Sicherheitsmerkmal der Quarantänfunktionen, um zu verhindern, dass die Quarantänefunktionen einem Exploit ausgesetzt wird und gespeicherte Daten in der Quarantäneumgebung ausgeführt werden können. Der Wert des `quarantine_key` sollte so behandelt werden, wie Ihre Passwörter: Je länger, desto besser, und halten Sie sie geheim. Optimal in Verbindung mit `delete_on_sight`.

##### "quarantine_max_filesize"
- Die maximal zulässige Dateigröße von Dateien, die in der Quarantäne isoliert werden sollen. Dateien, die größer sind als der angegebene Wert, werden NICHT im Quarantäneverzeichnis gespeichert. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardeinstellung = 2MB.

##### "quarantine_max_usage"
- Die maximal zulässige Speichernutzung der Quarantäne. Erreicht die Geamtgröße der Dateien in der Quarantäne diesen Wert, werden die ältesten Dateien in der Quarantäne gelöscht, bis der Wert unterschritten wird. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardwert = 64MB.

##### "quarantine_max_files"
- Die maximale Anzahl von Dateien, die in der Quarantäne vorhanden sein können. Wenn neue Dateien zur Quarantäne hinzugefügt werden, werden alte Dateien gelöscht, wenn diese Anzahl überschritten wird, bis der Rest diese Nummer nicht mehr überschreitet. Standardwert = 100.

##### "honeypot_mode"
- Ist der Honeypot-Modus aktiviert, wird phpMussel jede Datei aus dem Dateiupload isolieren, ohne Rücksicht darauf zu nehmen, ob diese Dateien Signaturen enthalten, es findet auch keine weitere Überprüfung statt. Diese Funktionalität dient ausschließlich dem Zweck der Viren- und Malwareforschung, es wird ausdrücklich nicht empfohlen, phpMussel mit dieser Funktion zum Zwecke der Dateiüberprüfung von Uploads oder anderen Zwecken außer "Honeypotting" zu verwenden. Standardmäßig ist diese Funktion deaktiviert. False = Deativiert [Standardwert]; True = Aktiviert.

##### "scan_cache_expiry"
- Für wie lange soll phpMussel die Scan-Ergebnisse zwischenspeichern? Wert entspricht der Anzahl Sekunden, wie lange die Scan-Ergebnisse zwischengespeichert werden. Standard ist 21600 Sekunden (6 Stunden); Ein Wert von 0 wird das Zwischenspeichern von Scan-Ergebnissen deaktivieren.

##### "disable_cli"
- CLI-Modus deaktivieren? CLI-Modus ist standardmäßig aktiviert, kann aber manchmal bestimmte Test-Tools (PHPUnit zum Beispiel) und andere CLI-basierte Anwendungen beeinträchtigen. Wenn du den CLI-Modus nicht deaktiveren musst, solltest du diese Anweisung ignorieren. False = CLI-Modus aktivieren [Standardeinstellung]; True = CLI-Modus deaktivieren.

##### "disable_frontend"
- Front-End-Access deaktivieren? Front-End-Access kann machen phpMussel einfacher zu handhaben, aber es kann auch ein potentielles Sicherheitsrisiko sein. Es wird empfohlen, wenn möglich, phpMussel über die Back-End-Access zu verwalten, aber Front-End-Access vorgesehen ist, für wenn es nicht möglich ist. Halten Sie es deaktiviert außer wenn Sie es brauchen. False = Front-End-Access aktivieren; True = Front-End-Access deaktivieren [Standardeinstellung].

##### "max_login_attempts"
- Maximale Anzahl der Versucht zu einloggen (Front-End). Standardeinstellung = 5.

##### "FrontEndLog"
- Datei für die Protokollierung von Front-End Einloggen-Versuchen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

##### "disable_webfonts"
- Web-Fonts deaktivieren? True = Ja [Standardeinstellung]; False = Nein.

##### "maintenance_mode"
- Wartungsmodus aktivieren? True = Ja; False = Nein [Standardeinstellung]. Deaktiviert alles andere als das Front-End. Manchmal nützlich für die Aktualisierung Ihrer CMS, Frameworks, u.s.w.

##### "default_algo"
- Definiert den Algorithmus für alle zukünftigen Passwörter und Sitzungen. Optionen: PASSWORD_DEFAULT (Standardeinstellung), PASSWORD_BCRYPT, PASSWORD_ARGON2I (erfordert PHP >= 7.2.0).

##### "statistics"
- phpMussel-Nutzungsstatistiken verfolgen? True = Ja; False = Nein [Standardeinstellung].

##### "allow_symlinks"
- Manchmal kann phpMussel nicht direkt auf eine Datei zugreifen, wenn sie auf eine bestimmte Art benannt ist. Der indirekte Zugriff auf die Datei über Symlinks kann dieses Problem manchmal beheben. Dies ist jedoch nicht immer eine praktikable Lösung, da auf einigen Systemen die Verwendung von Symlinks verboten sein kann oder Administratorrechte erfordern. Diese Anweisung wird verwendet, um zu bestimmen, ob phpMussel versuchen sollte, Symlinks zu verwenden, um indirekt auf Dateien zuzugreifen, wenn ein direkter Zugriff auf sie nicht möglich ist. True = Aktivieren Symlinks; False = Deaktivieren Symlinks [Standardeinstellung].

#### "signatures" (Kategorie)
Konfiguration der Signaturen.

##### "Active"
- Eine Liste der aktiven Signaturdateien, die durch Kommas getrennt sind.

*Hinweis: Signaturdateien müssen zuerst installiert werden, bevor Sie sie aktivieren können.*

##### "fail_silently"
- Reaktion von phpMussel auf fehlende oder defekte Signaturen. Ist `fail_silently` deaktiviert, werden fehlende oder defekte Signaturen während des Scanvorgangs gemeldet, ist `fail_silently` aktiviert, werden fehlende oder defekte Signaturen ignoriert, ohne dass entsprechende Probleme gemeldet werden. Diese Option sollte so belassen werden, es sei denn, Sie erwarten Abstürze oder ähnliches. False = Deaktiviert; True = Aktiviert [Standardeinstellung].

##### "fail_extensions_silently"
- Soll phpMussel melden, wenn Dateierweiterungen fehlen? Wenn `fail_extensions_silently` deaktiviert ist, werden fehlende Dateierweiterungen beim Scannen gemeldet und wenn `fail_extensions_silently` aktiviert ist, werden fehlende Dateierweiterungen ignoriert und beim Scan gemeldet, dass es mit diesen Dateien keine Probleme gibt. Das Deaktivieren dieser Anweisung kann möglicherweise deine Sicherheit erhöhen, kann aber auch zu mehr Falschmeldungen führen. False = Deaktiviert; True = Aktiviert [Standardeinstellung].

##### "detect_adware"
- Soll phpMussel Signaturen für die Erkennung von Adware parsen? False = Nein; True = Ja [Standardeinstellung].

##### "detect_encryption"
- Soll phpMussel verschlüsselte Dateien erkennen und blockieren? False = Nein; True = Ja [Standardeinstellung].

##### "detect_joke_hoax"
- Soll phpMussel Signaturen für die Erkennung von Scherz/Fake-Malware/Viren parsen? False = Nein; True = Ja [Standardeinstellung].

##### "detect_pua_pup"
- Soll phpMussel Signaturen für die Erkennung von PUAs/PUPs parsen? False = Nein; True = Ja [Standardeinstellung].

##### "detect_packer_packed"
- Soll phpMussel Signaturen für die Erkennung von Packern und komprimierten Daten parsen? False = Nein; True = Ja [Standardeinstellung].

##### "detect_shell"
- Soll phpMussel Signaturen für die Erkennung von Shell-Scripten parsen? False = Nein; True = Ja [Standardeinstellung].

##### "detect_deface"
- Soll phpMussel Signaturen für die Erkennung von Defacements und Defacer parsen? False = Nein; True = Ja [Standardeinstellung].

#### "files" (Kategorie)
Generelle Konfigurationen für die Handhabung von Dateien.

##### "max_uploads"
- Maximale erlaubte Anzahl zu überprüfender Dateien während eines Dateiuploads bevor der Scan abgebrochen und der Nutzer darüber informiert wird, dass er zu viele Dateien auf einmal hochgeladen hat. Bietet einen Schutz gegen den theoretischen Angriff eines DDoS auf Ihr System oder CMS, indem der Angreifer phpMussel überlastet und den PHP-Prozess zum Stillstand bringt. Empfohlen: 10. Sie können den Wert abhängig von Ihrer Hardware erhöhen oder senken. Beachten Sie, dass dieser Wert nicht den Inhalt von Archiven berücksichtigt.

##### "filesize_limit"
- Begrenzung der Dateigröße in KB. 65536 = 64MB [Standardeinstellung]; 0 = Keine Begrenzung (wird immer zur Greylist hinzugefügt), jeder (positive) numerische Wert wird akzeptiert. Dies ist nützlich, wenn Ihre PHP-Konfiguration den verfügbaren Speicherverbrauch je Prozess einschränkt oder die Dateigröße von Uploads begrenzt.

##### "filesize_response"
- Handhabung von Dateien, die die Begrenzung der Dateigröße (sofern angegeben) überschreiten. False = Hinzufügen zur Whitelist; True = Hinzufügen zur Blacklist [Standardeinstellung].

##### "filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Sofern Ihr System spezielle Dateitypen im Upload erlaubt oder komplett verweigert, so unterteilen Sie diese Dateitypen in Whitelists, Blacklists oder Greylists, um den Scanvorgang zu beschleunigen, indem diese Dateitypen übersprungen werden. Format ist CSV (comma separated values, Komma-getrennte Werte). Möchten Sie lieber alles überprüfen lassen, so lassen Sie die Variable(n) leer; Dies deaktiviert die Whitelist/Blacklist/Greylist.
- Logische Reihenfolge der Verarbeitung ist:
  - Wenn der Dateityp in der Whitelist ist, scanne und blockieren nicht die Datei, und überprüfe nicht wenn die Datei in der Whitelist oder in der Greylist ist.
  - Wenn der Dateityp in der Blacklist ist, scanne nicht die Datei aber blockieren sie trotzdem, und überprüfe nicht wenn die Datei in der Greylist ist.
  - Wenn die Greylist leer ist oder wenn die Greylist nicht leer ist und der Dateityp in der Greylist ist, scanne die Datei wie standardmäßig eingestellt ist und stelle fest, ob diese blockiert werden soll, basierend auf dem Scan, aber wenn die Greylist nicht leer ist und der Dateityp nicht in der Greylist ist, behandel die Datei als ob sie in der Blacklist ist, scanne sie nicht aber blockiere sie trotzdem.

##### "check_archives" – Vorübergehend nicht erreichbar
- Soll der Inhalt von Archiven überprüft werden? False = Nein (keine Überprüfung); True = Ja (wird überprüft) [Standardeinstellung].
- Zur Zeit wird NUR die Überprüfung von BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR und ZIP Archiven unterstützt (Überprüfung von RAR, CAB, 7z, u.s.w. wird zur Zeit NICHT unterstützt).
- Diese Funktion ist nicht sicher! Es wird dringend empfohlen, diese Funktion aktiviert zu lassen, es kann jedoch nicht garantiert werden, dass alles entdeckt wird.
- Die Archivüberprüfung ist derzeit nicht rekursiv für PHAR-Archive oder ZIP-Archive.

##### "filesize_archives"
- Soll das Blacklisting/Whitelisting der Dateigröße auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen); True = Ja [Standardeinstellung].

##### "filetype_archives"
- Soll das Blacklisting/Whitelisting des Dateityps auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen) [Standardeinstellung]; True = Ja.

##### "max_recursion"
- Maximale Grenze der Rekursionstiefe von Archiven. Standardwert = 10.

##### "block_encrypted_archives"
- Verschlüsselte Archive erkennen und blockieren? Denn phpMussel ist nicht in der Lage, die Inhalte von verschlüsselten Archiven zu scannen. Es ist möglich, dass Archiv-Verschlüsselung von Angreifern zum Umgehen von phpMussel, Antiviren-Scanner und weiterer solcher Schutzlösungen verwendet wird. Die Anweisung, dass phpMussel verschlüsselte Archive blockiert kann möglicherweise helfen, die Risiken, die mit dieser Möglichkeit verbunden sind, zu verringern. False = Nein; True = Ja [Standardeinstellung].

#### "attack_specific" (Kategorie)
Konfiguration für spezifische Angriffserkennung.

Chameleon-Angriffserkennung: False = Deaktiviert; True = Aktiviert.

##### "chameleon_from_php"
- Suche nach PHP-Headern in Dateien, die weder PHP-Dateien noch erkannte Archive sind.

##### "can_contain_php_file_extensions"
- Eine Liste von Dateierweiterungen, die PHP-Code enthalten dürfen, getrennt durch Kommas. Wenn die PHP-Chameleon-Angriffserkennung aktiviert ist, werden Dateien mit PHP-Code, die Erweiterungen aufweisen, die nicht in dieser Liste enthalten sind, als PHP-Chameleon-Angriffe erkannt.

##### "chameleon_from_exe"
- Suche nach ausführbaren Headern in Dateien, die weder ausführbar noch erkannte Archive sind und nach ausführbaren Dateien, deren Header nicht korrekt sind.

##### "chameleon_to_archive"
- Suche nach Archiven, deren Header nicht korrekt sind (Unterstützt: BZ, GZ, RAR, ZIP, GZ).

##### "chameleon_to_doc"
- Suche nach Office-Dokumenten, deren Header nicht korrekt sind (Unterstützt: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

##### "chameleon_to_img"
- Suche nach Bildern, deren Header nicht korrekt sind (Unterstützt: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

##### "chameleon_to_pdf"
- Suche nach PDF-Dateien, deren Header nicht korrekt sind.

##### "archive_file_extensions"
- Erkannte Archiv-Dateierweiterungen (Format ist CSV; nur bei Problemen hinzufügen oder entfernen; unnötiges Entfernen könnte Fehlalarme für Archive auslösen, unnötiges Hinzufügen fügt das zur Whitelist hinzu, was vorher als möglicher Angriff definiert wurde; Ändern Sie diese Liste äußerst vorsichtig; Beachten Sie, dass dies keinen Einfluss darauf hat, wozu Archive fähig sind und nicht auf Inhaltsebene analysiert werden können). Diese Liste enthält die Archivformate, die am häufigsten von der Mehrzahl der Systeme und CMS verwendet werden, ist aber absichtlich nicht vollständig.

##### "block_control_characters"
- Sollen Dateien, welche Steuerzeichen (andere als Newline/Zeilenumbruch) enthalten, blockiert werden? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Sofern Sie _**NUR**_ reinen Text hochladen, können Sie diese Option aktivieren, um Ihrem System zusätzlichen Schutz zu bieten. Sollten Sie anderes als reinen Text hochladen, werden bei aktivierter Option Fehlalarme ausgelöst. False = Nicht blockieren [Standardeinstellung]; True = Blockieren.

##### "corrupted_exe"
- Defekte Dateien und Parse-Errors. False = Ignorieren; True = Blockieren [Standardeinstellung]. Soll auf potentiell defekte ausführbare Dateien geprüft und diese blockiert werden? Oftmals (aber nicht immer), wenn bestimmte Aspekte einer PE-Datei beschädigt sind oder nicht korrekt verarbeitet werden können, ist dies ein Hinweis auf eine infizierte Datei. Viele Antiviren-Programme nutzen verschiedene Methoden, um Viren in solchen Dateien zu erkennen, sofern sich der Programmierer eines Virus dieser Tatsache bewußt ist, wird er versuchen, diese Maßnahmen zu verhindern, damit der Virus unentdeckt bleibt.

##### "decode_threshold"
- Schwelle der Menge der Rohdaten, die durch den Decode-Befehl erkannt werden sollen (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 512KB. Null oder ein Null-Wert deaktiviert die Beschränkung (Entfernen aller solcher Einschränkungen basierend auf die Dateigröße).

##### "scannable_threshold"
- Schwelle der Menge der Rohdaten, die phpMussel lesen und scannen darf (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 32MB. Null oder ein Null-Wert deaktiviert die Beschränkung. Generell sollte dieser Wert nicht kleiner sein als die durchschnittliche Dateigröße von Datei-Uploads, die Sie auf Ihrem Server oder Ihrer Website erwarten, sollte nicht größer sein als die Richtlinie filesize_limit und sollte nicht mehr als ein Fünftel der Gesamtspeicherzuweisung für PHP in der Konfigurationsdatei `php.ini` sein. Diese Richtlinie verhindert, dass phpMussel zu viel Speicher benutzt (was phpMussel daran hindern würde, einen Scan ab einer bestimmten Dateigröße erfolgreich durchzuführen).

##### "allow_leading_trailing_dots"
- Erlaube führende und nachfolgende Punkte in Dateinamen? Dies kann manchmal verwendet werden, um Dateien auszublenden oder um einige Systeme dazu zu bringen, Directory Traversal zuzulassen. False = Nicht erlauben [Standardeinstellung]. True = Erlauben.

##### "block_macros"
- Versuchen Sie, alle Dateien die Makros enthalten zu blockieren? Einige Arten von Dokumenten und Tabellen können ausführbare Makros enthalten und somit einen gefährlichen potenziellen Malware-Vektor darstellen. False = Nicht blockieren [Standardeinstellung]; True = Blockieren.

#### "compatibility" (Kategorie)
Kompatibilitätsdirektiven für phpMussel.

##### "ignore_upload_errors"
- Diese Direktive sollte generell AUS geschaltet bleiben sofern es nicht für die korrekte Funktion von phpMussel auf Ihrem System benötigt wird. Normalerweise, sobald phpMussel bei AUS geschalteter Direktive ein Element in `$_FILES` array() erkennt, wird es beginnen, die Dateien, die diese Elemente repräsentieren, zu überprüfen, sollten diese Elemente leer sein, gibt phpMussel eine Fehlermeldung zurück. Dies ist das normale Verhalten von phpMussel. Bei einigen CMS werden allerdings als normales Verhalten leere Elemente in `$_FILES` zurückgegeben oder Fehlermeldungen ausgelöst, sobald sich dort keine leeren Elemente befinden, in diesem Fall tritt ein Konflikt zwischen dem normalen Verhalten von phpMussel und dem CMS auf. Sollte eine solche Konstellation bei Ihrem CMS zutreffen, so stellen Sie diese Option AN, phpMussel wird somit nicht nach leeren Elementen suchen, Sie bei einem Fund ignorieren und keine zugehörigen Fehlermeldungen ausgeben, der Request zum Seitenaufruf kann somit fortgesetzt werden. False = AUS/OFF; True = AN/ON.

##### "only_allow_images"
- Wenn Sie nur Bilder erwarten, die auf Ihr System oder CMS hochgeladen werden oder nur Bilder und keine anderen Dateien als Upload erlauben oder benötigen, so sollte diese Direktive aktiviert werden (ON), ansonsten deaktiviert bleiben (OFF). Ist diese Direktive aktiviert, wird phpMussel alle Uploads, die keine Bilddateien sind, blockieren, ohne sie zu scannen. Dies kann die Verarbeitungszeit und Speichernutzung reduzieren, sobald andere Nicht-Bilddateien hochgeladen werden. False = AUS/OFF; True = AN/ON.

#### "heuristic" (Kategorie)
Heuristic-Direktive für phpMussel.

##### "threshold"
- Es gibt bestimmte Signaturen in phpMussel, die dazu dienen, verdächtige und potenziell bösartige Eigenschaften von hochgeladenen Dateien zu identifizieren, ohne diese Dateien an sich zu überprüfen und als bösartig zu identifizieren. Diese Direktive teilt phpMussel mit, welche Gewichtung von verdächtigen und potenziell bösartigen Eigenschaften zulässig ist, bevor diese Dateien als bösartig gekennzeichnet werden. Die Definition des Gewichts ist in diesem Zusammenhang die Gesamtzahl der verdächtigen und potenziell bösartigen Eigenschaften. Standardwert ist 3. Ein niedriger Wert in der Regel führt zu einem vermehrten Auftreten von Fehlalarmen und eine größere Anzahl von schädlichen Dateien werden erkannt, während ein höherer Wert weniger Fehlalarme auslöst und eine geringere Anzahl von schädlichen Dateien markiert werden. Dieser Wert sollte so belassen werden, es sei denn, Sie erkennen Probleme, die durch diese Einstellung hervorgerufen werden.

#### "virustotal" (Kategorie)
Konfiguration für Virus Total Integration.

##### "vt_public_api_key"
- Optional, phpMussel kann Dateien mit der Virus Total API scannen, um einen noch besseren Schutz gegen Viren, Trojaner, Malware und andere Bedrohungen zu bieten. Standardmäßig ist das Scannen von Dateien mit der Virus Total API deaktiviert. Um es zu aktivieren, wird ein API Schlüssel von Virus Total benötigt. Wegen dem großen Vorteil den dir das bietet, empfehle ich die Aktivierung. Bitte sei dir bewusst, um die Virus Total API zu nutzen, dass du deren Nutzungsbedingungen zustimmen und dich an alle Richtlinien halten musst, wie es in der Virus Total Dokumentation beschrieben ist! Du darfst diese Integrations-Funktion nicht verwenden AUSSER:
  - Du hast die Nutzungsbedingungen von Virus Total und der API gelesen und stimmst diesen zu. Die Nutzungsbedingungen von Virus Total und der API findet man [hier](https://www.virustotal.com/en/about/terms-of-service/).
  - Du hast, zu einem Minimum, das Vorwort von der Virus Total Public API Dokumentation gelesen und verstanden (alles nach "VirusTotal Public API v2.0" aber vor "Contents"). Die Virus Total Public API Dokumentation findet man [hier](https://www.virustotal.com/en/documentation/public-api/).

Anmerkung: Falls das Scannen von Dateien mit der Virus Total API deaktiviert ist, brauchst du keine der Direktiven in dieser Kategorie (`virustotal`) zu überprüfen, weil keine davon etwas machen wenn dies deaktiviert ist. Um einen Virus Total API Schlüssel zu erhalten, klicke auf deren Webseite auf den "Treten Sie unserer Community bei" Link oben rechts auf der Seite, gebe die geforderten Daten an und klick auf "Anmelden" wenn du fertig bist. Folge allen Anweisungen und wenn du deinen öffentlichen API Schlüssel hast, kopier eund füge den öffentlichen API Schlüssel bei der `vt_public_api_key` Direktive der `config.ini` Konfigurations-Datei ein.

##### "vt_suspicion_level"
- phpMussel wird standardmäßig die mit der Virus Total API zu scannenden Dateien auf Dateien eisnchränken, die es als "verdächtig" betrachtet. Du kannst optional diese Einschränkung durch Änderung des Wertes der `vt_suspicion_level` Direktive anpassen.
- `0`: Dateien werden nur als verdächtig betrachtet, falls durch den Scan mit phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung haben. Das würde bdeuten, dass die Verwendung der Virus Total API für eine zweite Meinung ist, wenn phpMussel eine Datei verdächtigt, dass diese schädlich ist aber nicht vollkommen ausschließen kann, dass diese potentiell harmlos (nicht schädlich) und somit diese andererseits normalerweise nicht blockieren oder als schädlich markieren würde.
- `1`: Dateien werden als verdächtig betrachtet, falls durch den Scan mit phpMussel mit eigenen Signaturen, diese eine heuristische Gewichtung haben, falls diese eine ausführbare Datei (PE Dateien, Mach-O Dateien, ELF/Linux Dateien, u.s.w.), oder ein Format sind, das ausführbare Daten enthalten könnte (solche wie ausführbare Makros, DOC/DOCX Dateien, Archivdateien wie RAR, ZIP und u.s.w.). Das ist die normale und empfohlene Verdachts-Stufe, was bedeutet, dass die Virus Total API für eine zweite Meinung genutzt wird, wenn phpMussel in einer als verdächtig betrachteten Datei nichts schädliches oder unstimmiges findet, die es als verdächtig ansieht und somit normalerweise nicht blockieren oder als schädlich markieren würde.
- `2`: Alle Dateien werden als verdächtig angesehen und sollten mit der Virus Total API gescannt werden. Ich empfehle nicht, diese Verdachts-Stufe anzuwenden, da dadurch eine schnellere Erreichung des API Limits riskiert wird, als es normalerweise der Fall wäre. Aber es gibt bestimmte Umstände (zB wenn der Webmaster oder Hostmaster sehr wenig Vertrauen in die hochgeladenen Inhalte der Nutzer hat) wo diese Verdachts-Stufe angemessen sein könnte. Mit dieser Verdachts-Stufe werden alle Dateien, die normalerweise nicht blockiert oder als schädlich markiert würden, mit der Virus Total API gescannt. Beachte, dass phpMussel die Virus Total API nicht nutzen wird, wenn dein API Limit erreicht ist (unabhängig von der Verdachts-Stufe) und dass dein Limit wahrscheinlich schneller erreicht wird, wenn diese Verdachts-Stufe verwendet wird.

Hinweis: Unabhängig von der Verdachts-Stufe wird jede Datei auf der Whitelist oder der Blacklist nicht durch phpMussel mit der Virus Total API gescannt, da diese Dateien bereits als schädlich oder harmlos deklariert wurden und ansonste gescannt würden, und somit zusätzliches Scannen nicht erforderlich ist. Die Möglichkeit von phpMussel Dateien mit der Virus Total API zu scannen ist dafür gedacht, weiteres Vertrauen aufzubauen, ob eine Datei unter den Umständen schädlich oder harmlost ist, wo phpMussel sich selber nicht sicher ist ob eine Datei schädlich oder harmlos ist.

##### "vt_weighting"
- Soll phpMussel die Ergebnisse des Scans mit der Virus Total API als Erkennungen oder Erkennungs-Gewichtung anwenden? Diese Direktive existiert, weil das Scannen einer Datei mit mehreren Engines (wie es Virus Total macht) in einer höheren Erkennungsrate resultieren sollte (und somit eine größere Anzahl schädlicher Dateien erwischt werden), dies kann aber zu in einer höheren Anzahl von Falschmeldungen führen. Unter manchen Umständen würden die Ergebnisse des Scans besser als Vertrauens-Wert als ein eindeutiges Ergebnis verwendet werden. Wenn der Wert 0 verwendet wird, werden die Ergebnisse des Scans als Erkennungen angewendet und somit wird phpMussel, falls irgendeine von Virus Total verwendete Engine die gescannte Datei als schädlich markiert, die Datei als schädlich betrachten. Wird ein anderer Wert verwendet, werden die Ergebnisse des Scans mit der Virus Total API als Erkennungs-Gewichtung angewendet. Die Anzahl der von Virus Total verwendeten Engines, welche die Datei als schädlich markieren, wird als Vertrauens-Wert (oder Erkennungs-Gewichtung) dienen, ob die gescannte Datei von phpMussel als schädlich angesehen werden soll (der verwendete Wert wird den Mindest-Vertrauens-Wert oder erforderliche Gewichtung repräsentieren, um als schädlich angesehen zu werden. Standardmäßig der Wert 0 verwendet.

"vt_quota_rate" und "vt_quota_time"
- Laut der Virus Total API Dokumentation, "ist diese auf 4 Anfragen irgendeiner Art in einer 1 Minuten Zeitspanne limitiert. Falls du einen Honeyclient, Honeypot oder einen andere Automatisierung verwendest, was etwas zu VirusTotal beiträgt und nicht nur Berichte abruft, bist du für ein höheres Limit berechtigt". Standardmäßig wird sich phpMussel strikt daran halten, da aber diese Limits erhöht werden können, stehen dir diese zwei Direktiven zur Verfügung um phpMussel anzuweisen, an welches Limit es sich halten soll. Außer du bist dazu aufgefordert, ist es nicht empfohlen diese Werte zu erhöhen. Solltest du aber Probleme bezogen auf das Erreichen des Limits haben, _**SOLLTE**_ das Verringern dieser Werte manchmal helfen. Dein Limit wird festgelegt als `vt_quota_rate` Anfragen jeder Art in jeder `vt_quota_time` Minuten Zeitspanne.

#### "urlscanner" (Kategorie)
Ein URL-Scanner ist mit phpMussel enthalten, der bösartige URLs in Daten und gescannten Dateien erkennt.

Hinweis: Wenn der URL-Scanner deaktiviert ist, müssen Sie keine der Anweisungen in dieser Kategorie (`urlscanner`) überprüfen, da dann keine davon funktioniert.

URL-Scanner API-Abfrage Konfiguration.

##### "lookup_hphosts"
- Aktiviert API-Abfragen zur [hpHosts](http://hosts-file.net/) API wenn der Wert auf `true` gesetzt ist. hpHosts erfordert keinen API-Schlüssel um API-Abfragen durchzuführen.

##### "google_api_key"
- Aktiviert API-Abfragen zur Google Safe Browsing API wenn der benötigte API-Schlüssel festgelegt ist. Google Safe Browsing API-Abfragen erfordern einen API-Schlüssel, den Sie [hier](https://console.developers.google.com/) erhalten können.
- Hinweis: Die cURL-Erweiterung ist erforderlich, um diese Funktion zu nutzen.

##### "maximum_api_lookups"
- Die maximal erlaubte Anzahl von API-Abfragen die bei jedem Scan-Durchgang durchgeführt werden. Weil jede zusätzliche API-Abfrage die Zeit für einen Scan-Durchgang erhöht, wollen Sie unter Umständen ein Limit festlegen, um den gedamten Scan-Prozess zu beschleunigen. Wenn 0 eingestellt wird, wird kein Limit angewendet. Standardmäßig ist der Wert auf 10 gesetzt.

##### "maximum_api_lookups_response"
- Was soll passieren, wenn die maximale Anzahl der erlaubten API-Abfragen erreicht wird? False = Nichts (Verarbeitung fortführen) [Standardeinstellung]; True = Markiere/blockiere die Datei.

##### "cache_time"
- Wie lange (in Sekunden) sollen die Ergebnisse von API-Abfragen zwischengespeichert werden? Standardeinstellung ist 3600 Sekunden (1 Stunde).

#### "legal" (Kategorie)
Konfiguration für gesetzliche Anforderungen.

*Für weitere Informationen zu gesetzlichen Anforderungen und wie sich dies auf Ihre Konfiguration-Anforderungen auswirken könnte, bitte beachten Sie den Sektion "[RECHTSINFORMATION](#SECTION11)" der Dokumentation.*

##### "pseudonymise_ip_addresses"
- Pseudonymisieren IP-Adressen beim Schreiben der Protokolldateien? True = Ja; False = Nein [Standardeinstellung].

##### "privacy_policy"
- Die Adresse einer relevanten Datenschutz-Bestimmungen, die in der Fußzeile aller generierten Seiten angezeigt werden soll. Geben Sie eine URL, oder lassen Sie sie leer, um sie zu deaktivieren.

#### "template_data" (Kategorie)
Anweisungen/Variablen für Templates und Themes.

Template-Daten bezieht sich auf die HTML-Ausgabe die verwendet wird, um die "Upload blockiert"-Nachricht Benutzern anzuzeigen, wenn eine hochgeladene Datei blockiert wird. Falls Sie benutzerdefinierte Themes für phpMussel verwenden, wird die HTML-Ausgabe von der `template_custom.html`-Datei verwendet, ansonsten wird die HTML-Ausgabe von der `template.html`-Datei verwendet. Variablen, die in diesem Bereich der Konfigurations-Datei festgelegt werden, werden als HTML-Ausgabe geparst, indem jede Variable mit geschweiften Klammern innerhalb der HTML-Ausgabe mit den entsprechenden Variablen-Daten ersetzt wird. Zum Beispiel, wenn `foo="bar"`, dann wird jedes Exemplar mit `<p>{foo}</p>` innerhalb der HTML-Ausgabe zu `<p>bar</p>`.

##### "theme"
- Standard-Thema für phpMussel verwenden.

##### "Magnification"
- Schriftvergrößerung. Standardeinstellung = 1.

##### "css_url"
- Die Template-Datei für benutzerdefinierte Themes verwendet externe CSS-Regeln, wobei die Template-Datei für das normale Theme interne CSS-Regeln verwendet. Um phpMussel anzuweisen, die Template-Datei für benutzerdefinierte Themes zu verwenden, geben Sie die öffentliche HTTP-Adresse von den CSS-Dateien des benutzerdefinierten Themes mit der `css_url`-Variable an. Wenn Sie diese Variable leer lassen, wird phpMussel die Template-Datei für das normale Theme verwenden.

#### "PHPMailer" (Kategorie)
PHPMailer Konfiguration.

##### "EventLog"
- Eine Datei zum Protokollieren aller Ereignisse in Bezug auf PHPMailer. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.

##### "SkipAuthProcess"
- Wenn Sie diese Direktive auf `true` setzen, wird PHPMailer angewiesen, den normalen Authentifizierungsprozess zu überspringen, der normalerweise beim Senden von E-Mails über SMTP auftritt. Dies sollte vermieden werden, da das Überspringen dieses Prozesses ausgehende E-Mails an MITM-Angriffe aussetzen kann. Dies kann jedoch in Fällen erforderlich sein, in denen dieser Prozess die Verbindung von PHPMailer zu einem SMTP-Server verhindert.

##### "Enable2FA"
- Diese Direktive bestimmt, ob 2FA für Front-End-Konten verwendet werden soll.

##### "Host"
- Der SMTP-Host zum Senden von ausgehende E-Mails.

##### "Port"
- Die Portnummer zum Senden von ausgehende E-Mails. Standardeinstellung = 587.

##### "SMTPSecure"
- Das Protokoll zum Senden von E-Mails über SMTP (TLS oder SSL).

##### "SMTPAuth"
- Diese Direktive bestimmt, ob SMTP-Sitzungen authentifiziert werden sollen (sollte normalerweise in Ruhe gelassen werden).

##### "Username"
- Der Benutzername zum Senden von E-Mails über SMTP.

##### "Password"
- Das Passwort zum Senden von E-Mails über SMTP.

##### "setFromAddress"
- Die Absenderadresse, die beim Senden von E-Mails über SMTP anzugeben werden soll.

##### "setFromName"
- Der Name des Absenders, der beim Senden von E-Mails über SMTP anzugeben werden soll.

##### "addReplyToAddress"
- Die Antwortadresse, die beim Senden von E-Mails über SMTP anzugeben werden soll.

##### "addReplyToName"
- Der Name für der Antwort, die beim Senden von E-Mails über SMTP anzugeben werden soll.

---


### 8. <a name="SECTION8"></a>SIGNATURENFORMAT

*Siehe auch:*
- *[Was ist eine "Signatur"?](#WHAT_IS_A_SIGNATURE)*

Die ersten 9 Bytes `[x0-x8]` einer phpMussel Signaturdatei sind `phpMussel`, und handeln als eine "Magische Zahl" (Magic Number), um sie als Signaturdateien zu identifizieren (dies hilft zu verhindern, dass phpMussel versehentlich versucht, Dateien zu verwenden, die keine Signaturdateien sind). Das nächste Byte `[x9]` identifiziert die Art der Signaturdatei, welche phpMussel wissen muss, um die Signaturdatei korrekt interpretieren zu können. Folgende Arten von Signaturdateien werden erkannt:

Art | Byte | Beschreibung
---|---|---
`General_Command_Detections` | `0?` | Für CSV (comma separated values, Komma-getrennte Werte) Signaturdateien. Werte (Signaturen) sind hexadezimal-codierte Zeichenfolgen, um in Dateien zu suchen. Signaturen hier haben keine Namen oder andere Details (nur die Zeichenfolge zu erkennen).
`Filename` | `1?` | Für Dateinamen-Signaturen.
`Hash` | `2?` | Für Hash-Signaturen.
`Standard` | `3?` | Für Signaturdateien, die direkt mit Dateiinhalten arbeiten.
`Standard_RegEx` | `4?` | Für Signaturdateien, die direkt mit Dateiinhalten arbeiten. Signaturen können Reguläre Ausdrücke enthalten.
`Normalised` | `5?` | Für Signaturdateien, die mit ANSI-normalisiertem Dateiinhalt arbeiten.
`Normalised_RegEx` | `6?` | Für Signaturdateien, die mit ANSI-normalisiertem Dateiinhalt arbeiten. Signaturen können Reguläre Ausdrücke enthalten.
`HTML` | `7?` | Für Signaturdateien, die mit HTML-normalisierte Dateiinhalte arbeiten.
`HTML_RegEx` | `8?` | Für Signaturdateien, die mit HTML-normalisierte Dateiinhalte arbeiten. Signaturen können Reguläre Ausdrücke enthalten.
`PE_Extended` | `9?` | Für Signaturdateien, die mit PE-Metadaten arbeiten (andere als PE-Sektional-Metadaten).
`PE_Sectional` | `A?` | Für Signaturdateien, die mit PE-Sektional-Metadaten arbeiten.
`Complex_Extended` | `B?` | Für Signaturdateien, die mit verschiedenen Regeln arbeiten, die auf erweiterten Metadaten basieren, die von phpMussel generiert wurden.
`URL_Scanner` | `C?` | Für Signaturdateien, die mit URLs arbeiten.

Das nächste Byte `[x10]` ist ein Zeilenumbruch `[0A]`, und schließt den phpMussel-Signaturdatei-Header ab.

Jede nicht leere Zeile ist danach eine Signatur oder Regel. Jede Signatur oder Regel belegt eine Zeile. Die unterstützten Signaturformate werden nachfolgend beschrieben.

#### *DATEINAMEN-SIGNATUREN*
Alle Dateinamen-Signaturen besitzen folgendes Format:

`NAME:FNRX`

NAME ist der Name, um die Signatur zu benennen und FNRX ist das Regex-Erkennungsmuster zum Vergleich von (nicht kodierten) Dateinamen.

#### *HASH-SIGNATUREN*
Alle Hash-Signaturen besitzen folgendes Format:

`HASH:FILESIZE:NAME`

HASH ist der Hash (in der Regel MD5) der ganzen Datei, FILESIZE ist die gesamte Größe der Datei und NAME ist der Name, um die Signatur zu benennen.

#### *PE-SECTIONAL-SIGNATUREN*
Alle PE-Sectional-Signaturen besitzen folgendes Format:

`SIZE:HASH:NAME`

HASH ist der MD5-Hash einer PE-Sektion der Datei, FILESIZE ist die gesamte Größe der PE-Sektion und NAME ist der Name, um die Signatur zu benennen.

#### *PE-ERWEITERT-SIGNATUREN*
Alle PE-Erweitert-Signaturen besitzen folgendes Format:

`$VAR:HASH:SIZE:NAME`

Wo $VAR der Name der zu prüfenden PE-Variable ist, HASH ist der MD5-Hash von dieser Variable, SIZE ist die gesamte Größe von dieser Variable und NAME ist der Name für diese Signatur.

#### *KOMPLEX-ERWEITERT-SIGNATUREN*
Komplex-Erweitert-Signaturen sind ziemlich unterschiedlich zu anderen Arten von möglichen Signaturen für phpMussel. Insofern, dass sie gegen das übereinstimmen was die Signaturen spezifizieren und das können mehrere Kriterien sein. Die Übereinstimmungs-Kriterien werden durch ";" getrennt und der Übereinstimmungs-Typ und die Übereinstimmungs-Daten jedes Übereinstimmungskriteriums ist durch ":" getrennt sodass das Format für diese Signaturen in etwa so aussieht:

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

#### *ALLE SONSTIGEN SIGNATUREN*
Alle sonstigen Signaturen besitzen folgendes Format:

`NAME:HEX:FROM:TO`

NAME ist der Name, um die Signatur zu benennen und HEX ist ein hexidezimal-kodiertes Segment der Datei, welches mit der gegebenen Signatur geprüft werden soll. FROM und TO sind optionale Parameter, sie geben Start- und Endpunkt in den Quelldaten zur Überprüfung an.

#### *REGEX (REGULAR EXPRESSIONS)*
Jede Form von regulären Ausdrücken, die von PHP verstanden und korrekt ausgeführt werden, sollten auch von phpMussel und den Signaturen verstanden und korrekt ausgeführt werden können. Lassen Sie extreme Vorsicht walten, wenn Sie neue Signaturen schreiben, die auf regulären Ausdrücken basieren. Wenn Sie nicht absolut sicher sind, was Sie dort machen, kann dies zu nicht korrekten und/oder unerwarteten Ergebnissen führen. Schauen Sie im Quelltext von phpMussel nach, wenn Sie sich nicht absolut sicher sind, wie die regulären Ausdrücke verarbeitet werden. Beachten Sie bitte, dass alle Suchmuster (außer Dateinamen, Archive-Metadata and MD5-Prüfmuster) hexadezimal kodiert sein müssen (mit Ausnahme von Syntax, natürlich)!

---


### 9. <a name="SECTION9"></a>BEKANNTE KOMPATIBILITÄTSPROBLEME

#### PHP und PCRE
- phpMussel benötigt PHP und PCRE, um ausgeführt werden zu können. Ohne PHP und ohne die PCRE-Erweiterungen von PHP, kann phpMussel nicht oder nicht ordnungsgemäß ausgeführt werden. Stellen Sie sicher, dass auf Ihrem System PHP und PCRE installiert und verfügbar ist, bevor Sie phpMussel herunterladen und installieren.

#### KOMPATIBILITÄT ZU ANTIVIREN-SOFTWARE

In den meisten Fällen sollte phpMussel mit den meisten anderen Antiviren-Softwareprodukten kompatibel sein. Jedoch wurden in der Vergangenheit Konflikte von anderen Nutzern festgestellt. Die folgenden Informationen stammen von VirusTotal.com, welche einige Fehlalarme von verschiedenen Antiviren-Programmen gegen phpMussel beschreiben. Diese Informationen garantieren nicht, ob Kompatibilitätsprobleme zwischen phpMussel und Ihrem eingesetzten Antiviren-Produkt bestehen. Sollte Ihre Antiviren-Software als problematisch aufgelistet sein, sollten Sie diese entweder vor der Benutzung von phpMussel deaktivieren oder sich andere Alternativen überlegen.

Diese Informationen wurden zuletzt am 2018.10.09 aktualisiert und gelten für alle phpMussel Veröffentlichungen von den beiden letzten Nebenversionen (v1.5.0-v1.6.0) zu diesem Zeitpunkt.

*Diese Information gilt nur für das Hauptpaket. Die Ergebnisse können je nach installierten Signaturdateien, Plugins und anderen Peripheriekomponenten variieren.*

| Scanner | Ergebnisse |
|---|---|
| Bkav | Meldet "VEX.Webshell" |

---


### 10. <a name="SECTION10"></a>HÄUFIG GESTELLTE FRAGEN (FAQ)

- [Was ist eine "Signatur"?](#WHAT_IS_A_SIGNATURE)
- [Was ist ein "Falsch-Positiv"?](#WHAT_IS_A_FALSE_POSITIVE)
- [Wie häufig werden Signaturen aktualisiert?](#SIGNATURE_UPDATE_FREQUENCY)
- [Ich habe ein Problem bei der Verwendung von phpMussel und ich weiß nicht was ich tun soll! Bitte helfen Sie!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Ich möchte phpMussel mit einer PHP-Version älter als 5.4.0 verwenden; Kannst du helfen?](#MINIMUM_PHP_VERSION)
- [Kann ich eine einzige phpMussel-Installation verwenden, um mehrere Domains zu schützen?](#PROTECT_MULTIPLE_DOMAINS)
- [Ich möchte keine Zeit damit verbringen (es zu installieren, es richtig zu ordnen, u.s.w.); Kann ich dich einfach bezahlen, um alles für mich zu tun?](#PAY_YOU_TO_DO_IT)
- [Kann ich Sie oder einen der Entwickler dieses Projektes für private Arbeit einstellen?](#HIRE_FOR_PRIVATE_WORK)
- [Ich brauche spezialisierte Modifikationen, Anpassungen, u.s.w.; Kannst du helfen?](#SPECIALIST_MODIFICATIONS)
- [Ich bin ein Entwickler, Website-Designer oder Programmierer. Kann ich die Arbeit an diesem Projekt annehmen oder anbieten?](#ACCEPT_OR_OFFER_WORK)
- [Ich möchte zum Projekt beitragen; Darf ich das machen?](#WANT_TO_CONTRIBUTE)
- [Wie man spezifische Details über Dateien zugreifen, wenn sie gescannt werden?](#SCAN_DEBUGGING)
- [Kann ich cron verwenden, um automatisch zu aktualisieren?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [Kann phpMussel Dateien mit nicht-ANSI-Namen scannen?](#SCAN_NON_ANSI)
- [Blacklists – Whitelists – Greylists – Was sind sie und wie benutze ich sie?](#BLACK_WHITE_GREY)
- [Wenn ich Signaturdateien über die Update-Seite aktiviere oder deaktiviere, sortiert sie diese alphanumerisch in der Konfiguration. Kann ich die Art der Sortierung ändern?](#CHANGE_COMPONENT_SORT_ORDER)

#### <a name="WHAT_IS_A_SIGNATURE"></a>Was ist eine "Signatur"?

Im Kontext von phpMussel, eine "Signatur" bezieht sich auf Daten, die als Indikator/Identifikator fungieren, für etwas Bestimmtes das wir suchen, in der Regel in Form eines sehr kleinen, deutlichen, unschädlichen Segments von etwas Größerem und sonst schädlich, so wie ein Virus oder Trojaner, oder in Form einer Datei-Prüfsumme, Hash oder einer anderen identifizierenden Indikator, und enthält in der Regel ein Label, und einige andere Daten zu helfen, zusätzliche Kontext, die von phpMussel verwendet werden können, um den besten Weg zu bestimmen, wenn es aufsieht was wir suchen.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>Was ist ein "Falsch-Positiv"?

Der Begriff "Falsch-Positiv" (*Alternative: "falsch-positiv Fehler"; "falscher Alarm"*; Englisch: *false positive*; *false positive error*; *false alarm*), sehr einfach beschrieben, und in einem verallgemeinerten Kontext, verwendet wird, wenn eine Bedingung zu testen und wenn die Ergebnisse positiv sind, um die Ergebnisse dieser Tests zu entnehmen (dh, die Bedingung bestimmt wird positiv oder wahr), aber sind zu erwarten sein (oder sollte gewesen) negativ (dh, der Zustand, in Wirklichkeit, ist negativ oder falsch). Eine "Falsch-Positiv" könnte analog zu "weinen Wolf" betrachtet (wobei die Bedingung geprüft wird, ob es ein Wolf in der Nähe der Herde ist, die Bedingung "falsch" ist in dass es keinen Wolf in der Nähe der Herde, und die Bedingung wird als "positiv" berichtet durch die Schäfer durch Aufruf "Wolf, Wolf"), oder analog zu Situationen in medizinischen Tests, wobei ein Patient als mit eine Krankheit diagnostiziert, wenn sie in Wirklichkeit haben sie keine solche Krankheit.

Einige andere Begriffe verwendet: "Wahr-Positiv", "Wahr-Negativ" und "Falsch-Negativ". Eine "Wahr-Positiv" ist, wenn die Ergebnisse des Tests und der wahren Zustand beide wahr sind (oder "Positiv"), und eine "Wahr-Negativ" ist, wenn die Ergebnisse des Tests und der wahren Zustand beide falsch sind (oder "Negativ"); Eine "Wahr-Positiv" oder Eine "Wahr-Negativ" gilt als eine "korrekte Folgerung" zu sein. Der Antithese von einem "Falsch-Positiv" ist eine "Falsch-Negativ"; Eine "Falsch-Negativ" ist, wenn die Ergebnisse des Tests negativ sind (dh, die Bedingung bestimmt wird negativ oder falsch zu sein), aber sind zu erwarten sein (oder sollte gewesen) positiv (dh, der Zustand, in Wirklichkeit, ist "positiv", oder "wahr").

Im Kontext der phpMussel, Diese Begriffe beziehen sich auf der Signaturen von phpMussel, und die Dateien die Sie blockieren. Wenn phpMussel Blöcke eine Datei wegen schlechten, veraltete oder falsche Signaturen, sollte aber nicht so getan haben, oder wenn sie es tut, so aus den falschen Gründen, wir beziehen sich auf dieses Ereignis als eine "Falsch-Positiv". Wenn phpMussel, aufgrund unvorhergesehener Bedrohungen, fehlende Signaturen oder Defizite in ihren Signaturen, versagt eine Datei zu blockieren, die blockiert werden sollte, wir beziehen sich auf dieses Ereignis als eine "verpasste Erkennung" (das entspricht einem "Falsch-Negativ").

Dies kann durch die folgende Tabelle zusammengefasst werden:

&nbsp; | phpMussel sollte *KEINE* Datei blockieren | phpMussel *SOLLTE* eine Datei blockieren
---|---|---
phpMussel tut blockiert eine Datei *NICHT* | Wahr-Negativ (korrekte Folgerung) | Verpasste Erkennung (analog zu Falsch-Negativ)
phpMussel *TUT* blockiert eine Datei | __Falsch-Positiv__ | True-Positiv (korrekte Folgerung)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>Wie häufig werden Signaturen aktualisiert?

Die Aktualisierungshäufigkeit hängt von den betreffenden Signaturdateien ab. In der Regel, alle Betreuer für phpMussel Signaturdateien versuchen ihre Signaturen so aktuell wie möglich zu halten, aber da haben wir alle anderen Verpflichtungen, unser Leben außerhalb des Projekts, und da für unsere Bemühungen um das Projekt, keiner von uns wird finanziell entschädigt (d.h., bezahlt), ein genauer Aktualisierungs-Zeitplan kann nicht garantiert werden. In der Regel, Signaturen werden aktualisiert, wann immer es genügend Zeit gibt sie zu aktualisieren. Hilfe wird immer geschätzt, wenn Sie bereit bist, irgendwelche anzubieten.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>Ich habe ein Problem bei der Verwendung von phpMussel und ich weiß nicht was ich tun soll! Bitte helfen Sie!

- Verwenden Sie die neueste Version der Software? Verwenden Sie die neuesten Versionen Ihrer Signaturdateien? Wenn die Antwort auf eine dieser beiden Fragen nein ist, Versuchen alles zuerst zu aktualisieren, und überprüfen Sie ob das Problem weiterhin besteht. Wenn es weiterhin besteht, lesen Sie weiter.
- Haben Sie alle der Dokumentation überprüft? Wenn nicht, bitte tun Sie dies. Wenn das Problem nicht mit der Dokumentation gelöst werden kann, lesen Sie weiter.
- Haben Sie die **[Issues-Seite](https://github.com/phpMussel/phpMussel/issues)** überprüft, ob das Problem vorher erwähnt wurde? Wenn es vorher erwähnt wurde, überprüfen Sie ob irgendwelche Vorschläge, Ideen und/oder Lösungen zur Verfügung gestellt wurden, und folge wie nötig um das Problem zu lösen.
- Wenn das Problem weiterhin besteht, bitte fragen Sie nach Hilfe, indem Sie auf der Issues-Seite ein neues Issue erstellen.

#### <a name="MINIMUM_PHP_VERSION"></a>Ich möchte phpMussel mit einer PHP-Version älter als 5.4.0 verwenden; Kannst du helfen?

Nein. PHP 5.4.0 erreichte offiziellen EoL ("End of Life" oder Ende des Lebens) im Jahr 2014, und Sicherheits-Unterstützung wurde im Jahr 2015 beendet. Zum Zeitpunkt des Schreibens dieses, es ist 2017 und PHP 7.1.0 ist bereits vorhanden. An dieser Zeitpunkt, Unterstützung wird für die Verwendung von phpMussel mit PHP 5.4.0 und allen verfügbaren neueren PHP Versionen zur Verfügung, aber wenn Sie versuchen phpMussel mit älteren PHP Versionen zu verwenden, Unterstützung wird zur Verfügung nicht.

*Siehe auch: [Kompatibilitätstabellen](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Kann ich eine einzige phpMussel-Installation verwenden, um mehrere Domains zu schützen?

Ja. phpMussel-Installationen sind natürlich nicht auf bestimmte Domains gesperrt, und kann daher zum Schutz mehrerer Domains verwendet werden. Allgemein, wir verweisen auf phpMussel-Installationen die nur eine Domain schützen als "Single-Domain-Installationen", und Wir verweisen auf phpMussel-Installationen die mehrere Domains und/oder Subdomains schützen als "Multi-Domain-Installationen". Wenn Sie eine Multi-Domain-Installation betreiben und müssen verschiedene Sätze von Signaturdateien für verschiedene Domains verwenden, oder für verschiedene Domains muss unterschiedliche Konfiguration verwenden, das ist möglich. Nach dem Laden der Konfigurationsdatei (`config.ini`), phpMussel prüft auf die Existenz einer "Konfiguration-Überschreibt Datei", die für die Domain (oder Subdomain) spezifisch angefordert ist (`die-domain-angefordert.tld.config.ini`), und wenn gefunden, alle von der Konfiguration-Überschreibt Datei definierten Konfigurationswerte wird für die Ausführungsinstanz verwendet, anstelle der von der Konfigurationsdatei definierten Konfigurationswerte. Konfiguration-Überschreibt Dateien sind identisch mit der Konfigurationsdatei, und nach eigenem Ermessen, kann entweder die Gesamtheit aller Konfigurationsdirektiven für phpMussel enthalten, oder was auch immer kleiner Unterabschnitt erforderlich ist die sich normalerweise von der Konfigurationsdatei definierten Konfigurationswerte unterscheidet. Konfiguration-Überschreibt Dateien werden nach der Domain für die sie bestimmt sind benannt (so zum Beispiel, wenn Sie eine Konfiguration-Überschreibt Dateien benötigen für die Domäne, `http://www.some-domain.tld/`, seine Konfiguration-Überschreibt Datei sollte benannt werden als `some-domain.tld.config.ini`, und sollte in der vault neben der Konfigurationsdatei `config.ini` platziert werden). Der Domains-Name für die Ausführungsinstanz wird aus dem `HTTP_HOST`-Header der Anforderung abgeleitet; "www" wird ignoriert.

#### <a name="PAY_YOU_TO_DO_IT"></a>Ich möchte keine Zeit damit verbringen (es zu installieren, es richtig zu ordnen, u.s.w.); Kann ich dich einfach bezahlen, um alles für mich zu tun?

Vielleicht. Dies wird von Fall zu Fall berücksichtigt. Sag uns was du brauchst, was du anbietet, und wir werden Ihnen sagen, ob wir helfen können.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Kann ich Sie oder einen der Entwickler dieses Projektes für private Arbeit einstellen?

*Siehe oben.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Ich brauche spezialisierte Modifikationen, Anpassungen, u.s.w.; Kannst du helfen?

*Siehe oben.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Ich bin ein Entwickler, Website-Designer oder Programmierer. Kann ich die Arbeit an diesem Projekt annehmen oder anbieten?

Ja. Unsere Lizenz verbietet dies nicht.

#### <a name="WANT_TO_CONTRIBUTE"></a>Ich möchte zum Projekt beitragen; Darf ich das machen?

Ja. Beiträge zum Projekt sind sehr willkommen. Bitte beachten Sie "CONTRIBUTING.md" für weitere Informationen.

#### <a name="SCAN_DEBUGGING"></a>Wie man spezifische Details über Dateien zugreifen, wenn sie gescannt werden?

Sie können auf spezifische Details über Dateien zugreifen, wenn sie gescannt werden, indem Sie ein Array zuweisen, das zu diesem Zweck verwendet werden soll, bevor Sie phpMussel anweisen, sie zu scannen.

Im folgenden Beispiel, `$Foo` ist zu diesem Zweck zugeordnet. Nach dem Scannen `/Dateipfad/...`, detaillierte Informationen über die von `/Dateipfad/...` enthaltenen Dateien werden von `$Foo` enthalten sein.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/Dateipfad/...');

var_dump($Foo);
```

Das Array ist ein multidimensionales Array, das aus Elementen besteht, die jede gescannte Datei repräsentieren, und Subelemente, die die Details zu diesen Dateien darstellen. Diese Subelemente sind wie folgt:

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

*† - Nicht mit Ergebnissen aus dem Cache versehen (nur für neue Ergebnissen versehen).*

*‡ - Wird nur beim Scannen von PE-Dateien bereitgestellt.*

Optional, kann dieses Array zerstört werden, indem man folgendes verwendet:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Kann ich cron verwenden, um automatisch zu aktualisieren?

Ja. Eine API ist in das Front-End integriert, um über externe Skripte mit der Update-Seite zu interagieren. Ein separates Skript, "[Cronable](https://github.com/Maikuolan/Cronable)", ist verfügbar, und kann von Ihrem Cron-Manager oder Cron-Scheduler verwendet werden, um dieses und andere unterstützte Pakete automatisch zu aktualisieren (dieses Skript enthält eine eigene Dokumentation).

#### <a name="SCAN_NON_ANSI"></a>Kann phpMussel Dateien mit nicht-ANSI-Namen scannen?

Nehmen wir an, es gibt ein Verzeichnis, das Sie scannen möchten. In diesem Verzeichnis haben Sie einige Dateien mit nicht-ANSI-Namen.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Angenommen, Sie verwenden entweder den CLI-Modus oder die phpMussel-API zum Scannen.

Wenn PHP < 7.1.0 verwendet wird, kann phpMussel diese Dateien auf einigen Systemen nicht sehen, wenn er versucht, das Verzeichnis zu scannen, und daher phpMussel kann diese Dateien scannen nicht. Sie werden wahrscheinlich die gleichen Ergebnisse sehen, als würden Sie ein leeres Verzeichnis scannen:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Gestartet.
 Sun, 01 Apr 2018 22:27:41 +0800 Fertig.
```

Auch, wenn Sie PHP < 7.1.0 verwenden, scannen der Dateien Individuen produziert Ergebnisse wie diese:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Gestartet.
 > Überprüfung 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Ungültige Datei!
 Sun, 01 Apr 2018 22:27:41 +0800 Fertig.
```

Oder diese:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Gestartet.
 > X:/directory/??????.txt ist keine Datei oder ein Verzeichnis.
 Sun, 01 Apr 2018 22:27:41 +0800 Fertig.
```

Dies liegt an der Art und Weise, wie PHP nicht-ANSI-Dateinamen vor PHP 7.1.0 behandelt hat. Wenn dieses Problem auftritt, besteht die Lösung darin, Ihre PHP-Installation auf 7.1.0 oder höher zu aktualisieren. In PHP >= 7.1.0 werden nicht-ANSI-Dateinamen besser gehandhabt und phpMussel sollte in der Lage sein, die Dateien richtig zu scannen.

Zum Vergleich die Ergebnisse beim Versuch, das Verzeichnis mit PHP >= 7.1.0 zu scannen:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Gestartet.
 -> Überprüfung '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Keine Probleme gefunden.
 -> Überprüfung '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Keine Probleme gefunden.
 -> Überprüfung '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Keine Probleme gefunden.
 Sun, 01 Apr 2018 22:27:41 +0800 Fertig.
```

Und versuche, die Dateien einzeln zu scannen:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Gestartet.
 > Überprüfung 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Keine Probleme gefunden.
 Sun, 01 Apr 2018 22:27:41 +0800 Fertig.
```

#### <a name="BLACK_WHITE_GREY"></a>Blacklists – Whitelists – Greylists – Was sind sie und wie benutze ich sie?

Die Begriffe vermitteln unterschiedliche Bedeutungen in verschiedenen Kontexten. In phpMussel gibt es drei Kontexte, in denen diese Begriffe verwendet werden: Dateigröße Antwort, Dateityp Antwort, und die Signatur-Greylist.

Um ein gewünschtes Ergebnis bei minimalen Kosten für die Verarbeitung zu erzielen, gibt es einige einfache Dinge, die phpMussel vor dem eigentlichen Scannen von Dateien überprüfen kann, wie Dateigröße, Name und Erweiterung. Beispielsweise; Wenn eine Datei zu groß ist, oder ihre Erweiterung einen Dateityp angibt, den wir auf unseren Websites sowieso nicht zulassen möchten, können wir die Datei sofort markieren und müssen sie nicht scannen.

Dateigröße Antwort ist die Art, wie phpMussel reagiert, wenn eine Datei ein bestimmtes Limit überschreitet. Obwohl keine tatsächlichen Listen betroffen sind, kann eine Datei basierend auf ihrer Größe als effektiv auf Blacklists, Whitelists oder Greylists betrachtet werden. Es gibt zwei separate, optionale Konfigurationsdirektiven, um jeweils ein Limit und eine gewünschte Antwort anzugeben.

Dateityp Antwort ist die Art, wie phpMussel auf die Dateierweiterung reagiert. Es gibt drei separate, optionale Konfigurationsdirektiven, mit denen explizit angegeben werden kann, welche Erweiterungen auf die Blacklist, Whitelist oder Greylist gesetzt werden sollen. Eine Datei kann in einer dieser Listen effektiv betrachtet werden, wenn ihre Erweiterung mit einer der angegebenen Erweiterungen übereinstimmt.

In diesen beiden Kontexten, Whitelist bedeutet, dass es nicht gescannt oder markiert werden sollte; Blacklist bedeutet, dass es markiert werden sollte (und muss daher nicht gescannt werden); und Greylist bedeutet, dass eine weitere Analyse erforderlich ist, um festzustellen, ob wir sie markieren sollten (d.h., es sollte gescannt werden).

Die Signatur-Greylist ist eine Liste von Signaturen, die im Wesentlichen ignoriert werden sollten (Dies wird kurz in der Dokumentation erwähnt). Wenn eine Signatur auf der Signatur-Greylist ausgelöst wird, arbeitet phpMussel weiter durch seine Signaturen und unternimmt keine besondere Aktion in Bezug auf die Signatur auf der Greylist. Es gibt keine Signatur-Blacklist, da das implizierte Verhalten ohnehin normal für ausgelöste Signaturen ist, und es gibt keine Signatur-Whitelist, weil das implizierte Verhalten keinen Sinn ergibt, wenn man bedenkt, wie phpMussel normal funktioniert und welche Fähigkeiten es bereits hat.

Die Signatur-Greylist ist nützlich, wenn Sie Probleme beheben müssen, die von einer bestimmten Signatur verursacht werden, ohne die gesamte Signaturdatei zu deaktivieren oder zu deinstallieren.

#### <a name="CHANGE_COMPONENT_SORT_ORDER"></a>Wenn ich Signaturdateien über die Update-Seite aktiviere oder deaktiviere, sortiert sie diese alphanumerisch in der Konfiguration. Kann ich die Art der Sortierung ändern?

Ja. Wenn Sie einige Dateien zwingen müssen, in einer bestimmten Reihenfolge ausgeführt zu werden, Sie können einige beliebige Daten vor ihren Namen in der Konfigurationsdirektive in der sie aufgeführt sind hinzufügen, durch einen Doppelpunkt getrennt. Wenn die Updates-Seite anschließend die Dateien erneut sortiert, diese zusätzlichen Daten wirken sich auf die Sortierreihenfolge aus und führen dazu, dass sie in der von Ihnen gewünschten Reihenfolge ausgeführt werden, ohne sie umbenennen zu müssen.

z.B., angenommen dass eine Konfigurationsdirektive mit den folgenden Dateien ist aufgeführt:

`file1.php,file2.php,file3.php,file4.php,file5.php`

Wenn Sie `file3.php` zuerst ausführen möchten, Sie könnten etwas wie `aaa:` vor dem Namen der Datei hinzufügen:

`file1.php,file2.php,aaa:file3.php,file4.php,file5.php`

Wenn dann eine neue Datei `file6.php` aktiviert wird, wenn die Updates-Seite sie alle wieder sortiert, sollte es so enden:

`aaa:file3.php,file1.php,file2.php,file4.php,file5.php,file6.php`

Gleiche Situation, wenn eine Datei deaktiviert ist. Umgekehrt, wenn Sie möchten, dass die Datei zuletzt ausgeführt wird, Sie könnten etwas wie `zzz:` vor dem Namen der Datei hinzufügen. In jedem Fall müssen Sie die betreffende Datei nicht umbenennen.

---


### 11. <a name="SECTION11"></a>RECHTSINFORMATION

#### 11.0 ABSCHNITT VORWORT

Dieser Abschnitt der Dokumentation beschreibt mögliche rechtliche Überlegungen zur Verwendung und Implementierung des Pakets, und um einige grundlegende verwandte Informationen zur Verfügung zu stellen. Dies kann für einige Benutzer wichtig sein, um sicherzustellen, dass die gesetzlichen Anforderungen in den Ländern eingehalten werden, in denen sie tätig sind, und einige Benutzer müssen möglicherweise ihre Website-Richtlinien in Übereinstimmung mit diesen Informationen anpassen.

Zuallererst, bitte beachten Sie, dass ich (der Autor des Pakets) weder Rechtsanwalt noch qualifizierter Jurist bin. Daher bin ich rechtlich nicht zur Rechtsberatung qualifiziert. Auch, in einigen Fällen können die genauen rechtlichen Anforderungen zwischen verschiedenen Ländern und Rechtsordnungen variieren, und diese unterschiedlichen rechtlichen Anforderungen können sich manchmal widersprechen (wie zum Beispiel, in Ländern, die [Privatsphäre](https://de.wikipedia.org/wiki/Privatsph%C3%A4re) und das [Recht auf Vergessenwerden bevorzugen](https://de.wikipedia.org/wiki/Recht_auf_Vergessenwerden), gegenüber Ländern, die eine erweiterte [Vorratsdatenspeicherung](https://de.wikipedia.org/wiki/Vorratsdatenspeicherung) bevorzugen). Berücksichtigen Sie auch, dass der Zugriff auf das Paket nicht auf bestimmte Länder oder Gerichtsbarkeiten beschränkt ist und daher die Paket-Nutzerbasis wahrscheinlich geografisch-vielfältig ist. Nach diesen Punkten kann ich nicht sagen, was es heißt, in allen Belangen für alle Nutzer "rechtskonform" zu sein. Jedoch, ich hoffe, dass die hier enthaltenen Informationen Ihnen helfen, selbst zu einer Entscheidung zu kommen, was Sie tun müssen, um im Kontext des Pakets rechtskonform zu bleiben. Wenn Sie Zweifel oder Bedenken hinsichtlich der hierin enthaltenen Informationen haben, oder wenn Sie aus rechtlicher Sicht zusätzliche Hilfe und Rat benötigen, würde ich Ihnen empfehlen, einen qualifizierten Rechtsberater zu konsultieren.

#### 11.1 HAFTUNG UND VERANTWORTUNG

Wie bereits in der Paketlizenz angegeben, wird das Paket ohne jegliche Gewährleistung bereitgestellt. Dies beinhaltet (aber ist nicht beschränkt auf) den gesamten Umfang der Haftung. Das Paket wird Ihnen zu Ihrer Bequemlichkeit zur Verfügung gestellt, in der Hoffnung, dass es nützlich sein wird, und dass es Ihnen einen Vorteil bringen wird. Sie das Paket verwenden oder implementieren, ist jedoch Ihre eigene Entscheidung. Sie sind nicht gezwungen, das Paket zu verwenden oder zu implementieren, aber wenn Sie dies tun, sind Sie für diese Entscheidung verantwortlich. Weder ich noch andere Mitwirkende des Pakets sind rechtlich verantwortlich für die Folgen der Entscheidungen, die Sie treffen, unabhängig davon, ob sie direkt, indirekt, implizit oder anderweitig sind.

#### 11.2 DRITTE

Abhängig von seiner genauen Konfiguration und Implementierung kann das Paket in einigen Fällen mit Dritten kommunizieren und Informationen teilen. Diese Informationen können in einigen Kontexten von einigen Gerichtsbarkeiten als "[personenbezogene Daten](https://de.wikipedia.org/wiki/Personenbezogene_Daten)" (oder "PII") definiert werden.

Wie diese Informationen von diesen Dritten verwendet werden können, unterliegt den verschiedenen Richtlinien, die von diesen Dritten festgelegt wurden, und liegt außerhalb des Anwendungsbereichs dieser Dokumentation. In allen diesen Fällen jedoch kann der Austausch von Informationen mit diesen Dritten deaktiviert werden. In allen diesen Fällen liegt es in Ihrer Verantwortung, wenn Sie sich dafür entscheiden, Ihre Bedenken hinsichtlich der Vertraulichkeit, Sicherheit, und Verwendung von personenbezogenen Daten durch diese Dritten zu untersuchen. Wenn irgendwelche Zweifel bestehen oder wenn Sie mit dem Verhalten dieser Dritten in Bezug auf PII nicht zufrieden sind, ist es möglicherweise am besten, den gesamten Informationsaustausch mit diesen Dritten zu deaktivieren.

Aus Gründen der Transparenz wird im Folgenden beschrieben, welche Art von Informationen, und mit wem, geteilt werden.

##### 11.2.0 WEBFONTS

Einige benutzerdefinierte Themen sowie die Standard-UI (oder Benutzerschnittstelle) für das phpMussel-Front-End und die Seite "Upload verweigert" können Webfonts aus ästhetischen Gründen verwenden. Webfonts sind standardmäßig deaktiviert. Wenn sie jedoch aktiviert sind, erfolgt eine direkte Kommunikation zwischen dem Browser des Benutzers und dem Dienst, der die Webfonts hostet. Dies kann möglicherweise die Übermittlung von Informationen wie die IP-Adresse des Benutzers, den Benutzeragenten, das Betriebssystem und andere Details zur Anfrage verfügbar. Die meisten dieser Webfonts werden vom [Google Fonts](https://fonts.google.com/)-Service gehostet.

*Relevante Konfigurationsdirektiven:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL-SCANNER

URLs, die innerhalb von Dateiuploads gefunden werden, können je nach Konfiguration des Pakets mit der hpHosts-API oder der Google Safe Browsing-API geteilt werden. Im Fall der hpHosts-API ist dieses Verhalten standardmäßig aktiviert. Die Google Safe Browsing-API benötigt API-Schlüssel, um ordnungsgemäß zu funktionieren, und ist daher standardmäßig deaktiviert.

*Relevante Konfigurationsdirektiven:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

Wenn phpMussel einen Dateiupload scannt, werden die Hashwerte dieser Dateien möglicherweise mit der Virus Total-API geteilt, je nachdem, wie das Paket konfiguriert ist. Es ist geplant, in der Zukunft auch ganze Dateien gemeinsam nutzen zu können, aber diese Funktion wird derzeit nicht vom Paket unterstützt. Die Virus Total API benötigt einen API-Schlüssel, um korrekt zu funktionieren, und ist daher standardmäßig deaktiviert.

Informationen (einschließlich Dateien und zugehörige Dateimetadaten), die mit Virus Total geteilt werden, können auch mit ihren Partnern, verbundenen Unternehmen und verschiedenen anderen zu Forschungszwecken geteilt werden. Dies wird detaillierter durch ihre Datenschutzrichtlinie beschrieben.

*Sehen: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevante Konfigurationsdirektiven:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 PROTOKOLLIERUNG

Protokollierung ist aus verschiedenen Gründen ein wichtiger Teil von phpMussel. Ohne Protokollierung kann es schwierig sein, falsche Positive zu diagnostizieren, um genau festzustellen, wie gut phpMussel in einem bestimmten Kontext funktioniert, und es kann schwierig sein zu bestimmen, wo seine Defizite liegen und welche Änderungen möglicherweise an seiner Konfiguration oder den Signatures vorgenommen werden müssen, damit es weiterhin wie beabsichtigt funktioniert. Ungeachtet, die Protokollierung ist möglicherweise nicht für alle Benutzer wünschenswert und bleibt vollständig optional. In phpMussel ist die Protokollierung standardmäßig deaktiviert. Um es zu aktivieren, muss phpMussel entsprechend konfiguriert werden.

Zusätzlich, ob Protokollierung rechtlich zulässig ist, und in welchem Umfang es rechtlich zulässig ist (z.B., die Arten von Informationen, die protokolliert werden können, für wie lange und unter welchen Umständen), kann je nach Rechtssprechung und Kontext (z.B., ob Sie als Einzelperson, als juristische Person tätig sind, und ob auf kommerzieller oder nichtkommerzieller Basis), in dem phpMussel implementiert wird, variieren. Es kann daher sinnvoll sein, diesen Abschnitt sorgfältig durchzulesen.

Es gibt mehrere Arten der Protokollierung, die phpMussel ausführen kann. Verschiedene Arten der Protokollierung beinhalten verschiedene Arten von Informationen, aus verschiedenen Gründen.

##### 11.3.0 SCAN PROTOKOLLIERUNG

Wenn in der Paketkonfiguration aktiviert, speichert phpMussel Protokolle der Dateien, die es gescannt. Diese Art der Protokollierung ist in zwei verschiedenen Formaten verfügbar:
- Menschen lesbar oder benutzerfreundliche Protokolldateien.
- Serialisierte Protokolldateien.

Einträge in einer für Menschen lesbaren Protokolldatei sehen in etwa wie folgt aus (als Beispiel):

```
Mon, 21 May 2018 00:47:58 +0800 Gestartet.
> Überprüfung 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Entdeckt phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Fertig.
```

Ein Scan-Protokolleintrag enthält normalerweise die folgenden Informationen:
- Datum und Uhrzeit, zu der die Datei gescannt wurde.
- Der Name der gescannten Datei.
- CRC32b Hashes des Namens und des Inhalts der Datei.
- Was wurde in der Datei gefunden (falls etwas entdeckt wurde).

*Relevante Konfigurationsdirektiven:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

Wenn diese Direktiven leer bleiben, bleibt diese Art der Protokollierung deaktiviert.

##### 11.3.1 SCAN KILLS

Wenn in der Paketkonfiguration aktiviert, speichert phpMussel Protokolle der Uploads, die blockiert wurden.

Einträge in einem "scan kills" Protokolldatei sehen in etwa wie folgt aus (als Beispiel):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Entdeckt phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Als "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu" unter Quarantäne gestellt.
```

Ein "scan kills"-Eintrag enthält normalerweise die folgenden Informationen:
- Das Datum und die Uhrzeit, zu der der Upload gesperrt wurde.
- Die IP-Adresse, von der der Upload stammt.
- Der Grund, warum die Datei blockiert wurde (was entdeckt wurde).
- Der Name der blockierten Datei.
- Ein MD5 und die Größe der Datei blockiert.
- Ob die Datei unter Quarantäne gestellt wurde, und unter welchem internen Namen.

*Relevante Konfigurationsdirektiven:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END PROTOKOLLIERUNG

Diese Art der Protokollierung bezieht sich auf Front-End-Einloggen-Versuchen und tritt nur auf, wenn ein Benutzer versucht, sich am Front-End anzumelden (vorausgesetzt, der Front-End-Zugriff ist aktiviert).

Ein Front-End-Protokolleintrag enthält die IP-Adresse des Benutzers, der sich anzumelden versucht, das Datum und die Uhrzeit des Versuchs, und die Ergebnisse des Versuchs (erfolgreich eingeloggt oder könnte sich nicht einloggen). Ein Front-End-Protokolleintrag sieht in etwa wie folgt aus (als Beispiel):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Eingeloggt.
```

*Die für die Front-End-Protokollierung verantwortliche Konfigurationsdirektiven lautet:*
- `general` -> `FrontEndLog`

##### 11.3.3 PROTOKOLLROTATION

Möglicherweise möchten Sie Protokolle nach einer gewissen Zeit löschen, oder müssen dies gesetzlich tun (d.h., die Zeitspanne, die für die Aufbewahrung von Protokolldateien gesetzlich zulässig ist, kann gesetzlich beschränkt sein). Sie können dies erreichen, indem Sie Datums/Zeitmarkierungen in die Namen Ihrer Protokolldateien einfügen, die in Ihrer Paketkonfiguration festgelegt sind (z.B., `{yyyy}-{mm}-{dd}.log`), und dann Aktivieren der Protokollrotation (Protokollrotation ermöglicht es Ihnen, einige Aktionen in Protokolldateien durchzuführen, wenn bestimmte Limits überschritten werden).

Beispielsweise: Wenn ich gesetzlich dazu verpflichtet wäre, Protokolldateien nach 30 Tagen zu löschen, könnte ich `{dd}.log` in den Namen meiner Protokolldateien angeben (`{dd}` steht für Tage), setze den Wert von `log_rotation_limit` auf 30, und setze den Wert von `log_rotation_action` auf `Delete`.

Umgekehrt, wenn Sie Protokolldateien für einen längeren Zeitraum aufbewahren müssen, Sie könnten entweder überhaupt keine Protokollrotation verwenden, oder Sie könnten den Wert von `log_rotation_action` auf `Archive` setzen, um Protokolldateien zu komprimieren, wodurch der Gesamtbetrag des belegten Speicherplatzes reduziert wird.

*Relevante Konfigurationsdirektiven:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 PROTOKOLL-TRUNKIERUNG

Es ist auch möglich, um einzelne Protokolldateien zu trunkieren, wenn sie eine bestimmte Größe überschreiten, falls Sie dies benötigen oder tun möchten.

*Relevante Konfigurationsdirektiven:*
- `general` -> `truncate`

##### 11.3.5 IP-ADRESSE PSEUDONYMISIERUNG

Erstens, wenn Sie mit dem Begriff nicht vertraut sind, "Pseudonymisierung" bezieht sich auf die Verarbeitung personenbezogener Daten, so dass sie ohne zusätzliche Informationen nicht mehr für eine bestimmte Person identifiziert werden können, und vorausgesetzt, dass diese zusätzlichen Informationen getrennt aufbewahrt werden, und vorbehaltlich technischer und organisatorischer Maßnahmen, um sicherzustellen, dass personenbezogene Daten für keine natürliche Person identifiziert werden können.

Die folgenden Ressourcen können helfen, es genauer zu erklären:
- [[johner-institut.de] Anonymisierung und Pseudonymisierung](https://www.johner-institut.de/blog/gesundheitswesen/anonymisierung-und-pseudonymisierung/)
- [[datenschutzbeauftragter-info.de] Pseudonymisierung – was ist das eigentlich?](https://www.datenschutzbeauftragter-info.de/pseudonymisierung-was-ist-das-eigentlich/)
- [[Wikipedia] Anonymisierung und Pseudonymisierung](https://de.wikipedia.org/wiki/Anonymisierung_und_Pseudonymisierung)

Unter gewissen Umständen sind Sie gesetzlich dazu verpflichtet, alle PII, die gesammelt, verarbeitet oder gespeichert werden, zu anonymisieren oder zu pseudonymisieren. Obwohl dieses Konzept schon seit einiger Zeit besteht, erwähnt und ermutigt die GDPR/DSGVO ausdrücklich die "Pseudonymisierung" der PII.

phpMussel ist in der Lage, IP-Adressen zu pseudonymisieren, wenn Sie sie protokollieren, wenn Sie dies benötigen oder tun möchten. Wenn phpMussel IP-Adressen pseudonymisiert, wird das letzte Oktett von IPv4-Adressen und alles nach dem zweiten Teil von IPv6-Adressen durch ein "x" dargestellt (runden effektiv IPv4-Adressen in Subnetz 24 und IPv6-Adressen in Subnetz 32 ab).

*Relevante Konfigurationsdirektiven:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTIKEN

phpMussel ist optional in der Lage, Statistiken wie die Gesamtzahl der gescannten und blockierten Dateien seit einem bestimmten Zeitpunkt zu verfolgen. Diese Funktion ist standardmäßig deaktiviert, kann jedoch über die Paketkonfiguration aktiviert werden. Die Art der erfassten Informationen sollte nicht als PII betrachtet werden.

*Relevante Konfigurationsdirektiven:*
- `general` -> `statistics`

##### 11.3.7 KRYPTOGRAPHIE

phpMussel verwendet keine [Kryptografie](https://de.wikipedia.org/wiki/Kryptographie) zum den Cache oder Protokollierung. Kryptographie für den Cache oder Protokollierung kann in Zukunft eingeführt werden, aber es gibt derzeit keine konkreten Pläne dafür. Wenn Sie befürchten, dass unbefugte Dritte Zugang zu Teilen von phpMussel erhalten, die PII oder vertrauliche Informationen wie Cache oder Protokolle enthalten, würde ich empfehlen, phpMussel nicht an einem öffentlich zugänglichen Ort zu installieren (z.B., installieren Sie phpMussel außerhalb des Standard-Verzeichnisses `public_html` oder eines entsprechenden Verzeichnisses, das für die meisten Standard-Webserver verfügbar ist) und dass entsprechend restriktive Berechtigungen für das Verzeichnis erzwungen werden, in dem sie sich befinden (insbesondere für das vault verzeichnis). Wenn dies nicht ausreicht, um Ihre Bedenken auszuräumen, konfigurieren Sie phpMussel so, dass die Arten von Informationen, die Ihre Bedenken verursachen, nicht erfasst oder protokolliert werden (z.B. durch Deaktivieren der Protokollierung).

#### 11.4 COOKIES

Wenn sich ein Benutzer erfolgreich am Front-End eingeloggt, phpMussel setzt eine einen [Cookie](https://de.wikipedia.org/wiki/HTTP-Cookie), um sich den Benutzer für nachfolgende Anfragen merken zu können (d.h., Cookies dienen zur Authentifizierung des Benutzers bei einer Einloggen-Sitzung). Auf der Einloggen-Seite wird eine Cookie-Warnung angezeigt, die den Benutzer warnen, dass ein Cookie gesetzt wird, wenn er die relevante Aktion ausführt. An anderen Stellen in der Codebasis werden keine Cookies gesetzt.

*Relevante Konfigurationsdirektiven:*
- `general` -> `disable_frontend`

#### 11.5 VERMARKTUNG UND WERBUNG

phpMussel sammelt und verarbeitet keine Informationen für der Zweck des Vermarktung oder Werbung, und weder verkauft noch profitiert von gesammelten oder protokolliert Informationen. phpMussel ist kein kommerzielles Unternehmen, noch bezieht es sich auf irgendwelche kommerziellen Interessen, daher macht es keinen Sinn, diese Dinge zu tun. Dies ist seit Beginn des Projekts der Fall und ist auch heute noch der Fall. Außerdem, diese Dinge wären kontraproduktiv für den Geist und den beabsichtigten Zweck des gesamten Projekts, und so lange ich das Projekt weiterführen, wird nie passieren.

#### 11.6 DATENSCHUTZERKLÄRUNG

Unter bestimmten Umständen können Sie gesetzlich dazu verpflichtet sein, auf allen Seiten und Abschnitten Ihrer Website einen Link zu Ihrer Datenschutzerklärung deutlich anzuzeigen. Dies kann wichtig sein, um sicherzustellen, dass die Benutzer genau über Ihre genauen Datenschutzpraktiken, die Arten von personenbezogenen Daten, die Sie sammeln, und über Ihre beabsichtigte Verwendung informiert sind. Um einen solchen Link auf der Seite "Zugriff verweigert" von phpMussel einzubinden, wird eine Konfigurationsdirektive bereitgestellt, um die URL zu Ihrer Datenschutzerklärung anzugeben.

*Relevante Konfigurationsdirektiven:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

Die Datenschutz-Grundverordnung (DSGVO) ist eine Verordnung der Europäischen Union, die am 25. Mai 2018 in Kraft tritt. Das Hauptziel der Verordnung besteht darin, den EU-Bürgern und EU-Anwohnern die Kontrolle über ihre eigenen personenbezogenen Daten zu ermöglichen und die Regulierung innerhalb der EU in Bezug auf Privatsphäre und personenbezogene Daten zu vereinheitlichen.

Die Verordnung enthält spezifische Bestimmungen für die Verarbeitung "personenbezogenen Daten" (PII) von "betroffenen Personen" (jede identifizierte oder identifizierbare natürliche Person) aus oder innerhalb der EU. Um der Verordnung zu entsprechen, müssen "Unternehmen" (gemäß der Definition in der Verordnung) und alle relevanten Systeme und Prozesse "[Datenschutz durch Design](https://digitalcourage.de/blog/2015/was-ist-privacy-design)" standardmäßig implementieren, müssen die höchstmögliche Privatsphäre Einstellungen verwenden, müssen die erforderlichen Sicherheitsmaßnahmen für gespeicherte oder verarbeitete Informationen implementieren (einschließlich, aber nicht beschränkt auf die Durchführung der Pseudonymisierung oder vollständigen Anonymisierung von Daten), müssen die Art der Daten, die sie sammeln, eindeutig und eindeutig angeben, aus welchen Gründen, für wie lange sie diese Daten speichern und ob sie diese Daten an Dritte weitergeben, die Arten von Daten, die mit Dritten geteilt werden, wie, warum, u.s.w.

Daten dürfen nicht verarbeitet werden, es sei denn, es gibt eine gesetzliche Grundlage dafür, wie in der Verordnung definiert. Im Allgemeinen bedeutet dies, dass die Verarbeitung der Daten eines Datensubjekts auf gesetzlicher Grundlage gemäß den gesetzlichen Verpflichtungen oder nur nach ausdrücklicher, gut informierter und eindeutiger Zustimmung der betroffenen Person erfolgen muss.

Da sich Aspekte der Verordnung mit der Zeit weiterentwickeln können, um die Verbreitung veralteter Informationen zu vermeiden, ist es möglicherweise besser, die Vorschrift von einer autoritativen Quelle zu erfahren, als einfach die relevanten Informationen hier in die Paketdokumentation einzubeziehen (was eventuell mit der Entwicklung der Verordnung veraltet).

[EUR-Lex](https://eur-lex.europa.eu/) (ein Teil der offiziellen Website der Europäischen Union, die Informationen über EU-Recht bietet) bietet umfangreiche Informationen zu GDPR/DSGVO, die zum Zeitpunkt der Erstellung in 24 Sprachen verfügbar sind, und im PDF-Format heruntergeladen werden können. Ich würde definitiv empfehlen, die Informationen zu lesen, die sie zur Verfügung stellen, um mehr über GDPR/DSGVO zu erfahren:
- [VERORDNUNG (EU) 2016/679 DES EUROPÄISCHEN PARLAMENTS UND DES RATES](https://eur-lex.europa.eu/legal-content/DE/TXT/?uri=celex:32016R0679)

[Intersoft Consulting](https://www.intersoft-consulting.de/) bietet auch umfassende Informationen über DSGVO, die in deutscher und englischer Sprache verfügbar sind und die nützlich sein könnten, um mehr über GDPR/DSGVO zu erfahren:
- [Datenschutz-Grundverordnung (EU-DSGVO) als übersichtliche Website](https://dsgvo-gesetz.de/)

Alternativ gibt es einen kurzen (nicht autoritativen) Überblick über die GDPR/DSGVO bei Wikipedia:
- [Datenschutz-Grundverordnung](https://de.wikipedia.org/wiki/Datenschutz-Grundverordnung)

---


Zuletzt aktualisiert: 9 Oktober 2018 (2018.10.09).
