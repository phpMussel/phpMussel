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
 * This file: German language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Startseite</a> | <a href="?phpmussel-page=logout">Ausloggen</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Ausloggen</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Erkannte Archiv-Dateierweiterungen (Format ist CSV; nur bei Problemen hinzufügen oder entfernen; unnötiges Entfernen könnte Fehlalarme für Archive auslösen, unnötiges Hinzufügen fügt das zur Whitelist hinzu, was vorher als möglicher Angriff definiert wurde; Ändern Sie diese Liste äußerst vorsichtig; Beachten Sie, dass dies keinen Einfluss darauf hat, wozu Archive fähig sind und nicht auf Inhaltsebene analysiert werden können). Diese Liste enthält die Archivformate, die am häufigsten von der Mehrzahl der Systeme und CMS verwendet werden, ist aber absichtlich nicht vollständig.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Sollen Dateien, welche Steuerzeichen (andere als Newline/Zeilenumbruch) enthalten, blockiert werden? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Sofern Sie <em><strong>NUR</strong></em> reinen Text hochladen, können Sie diese Option aktivieren, um Ihrem System zusätzlichen Schutz zu bieten. Sollten Sie anderes als reinen Text hochladen, werden bei aktivierter Option Fehlalarme ausgelöst. False = Nicht blockieren [Standardeinstellung]; True = Blockieren.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Suche nach ausführbaren Headern in Dateien, die weder ausführbar noch erkannte Archive sind und nach ausführbaren Dateien, deren Header nicht korrekt sind. False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Suche nach PHP-Headern in Dateien, die weder PHP-Dateien noch erkannte Archive sind. False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Suche nach Archiven, deren Header nicht korrekt sind (Unterstützt: BZ, GZ, RAR, ZIP, RAR, GZ). False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Suche nach Office-Dokumenten, deren Header nicht korrekt sind (Unterstützt: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Suche nach Bildern, deren Header nicht korrekt sind (Unterstützt: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Suche nach PDF-Dateien, deren Header nicht korrekt sind. False = Deaktiviert; True = Aktiviert.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Defekte Dateien und Parse-Errors. False = Ignorieren; True = Blockieren [Standardeinstellung]. Soll auf potentiell defekte ausführbare Dateien geprüft und diese blockiert werden? Oftmals (aber nicht immer), wenn bestimmte Aspekte einer PE-Datei beschädigt sind oder nicht korrekt verarbeitet werden können, ist dies ein Hinweis auf eine infizierte Datei. Viele Antiviren-Programme nutzen verschiedene Methoden, um Viren in solchen Dateien zu erkennen, sofern sich der Programmierer eines Virus dieser Tatsache bewußt ist, wird er versuchen, diese Maßnahmen zu verhindern, damit der Virus unentdeckt bleibt.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Schwelle der Menge der Rohdaten, die durch den Decode-Befehl erkannt werden sollen (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 512KB. Null oder ein Null-Wert deaktiviert die Beschränkung (Entfernen aller solcher Einschränkungen basierend auf die Dateigröße).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Schwelle der Menge der Rohdaten, die phpMussel lesen und scannen darf (sofern während des Scanvorgangs spürbare Performance-Probleme auftreten). Standardeinstellung ist 32MB. Null oder ein Null-Wert deaktiviert die Beschränkung. Generell sollte dieser Wert nicht kleiner sein als die durchschnittliche Dateigröße von Datei-Uploads, die Sie auf Ihrem Server oder Ihrer Website erwarten, sollte nicht größer sein als die Richtlinie filesize_limit und sollte nicht mehr als ein Fünftel der Gesamtspeicherzuweisung für PHP in der Konfigurationsdatei "php.ini" sein. Diese Richtlinie verhindert, dass phpMussel zu viel Speicher benutzt (was phpMussel daran hindern würde, einen Scan ab einer bestimmten Dateigröße erfolgreich durchzuführen).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Diese Direktive sollte generell AUS geschaltet bleiben sofern es nicht für die korrekte Funktion von phpMussel auf Ihrem System benötigt wird. Normalerweise, sobald phpMussel bei AUS geschalteter Direktive ein Element in <code>$_FILES</code> array() erkennt, wird es beginnen, die Dateien, die diese Elemente repräsentieren, zu überprüfen, sollten diese Elemente leer sein, gibt phpMussel eine Fehlermeldung zurück. Dies ist das normale Verhalten von phpMussel. Bei einigen CMS werden allerdings als normales Verhalten leere Elemente in <code>$_FILES</code> zurückgegeben oder Fehlermeldungen ausgelöst, sobald sich dort keine leeren Elemente befinden, in diesem Fall tritt ein Konflikt zwischen dem normalen Verhalten von phpMussel und dem CMS auf. Sollte eine solche Konstellation bei Ihrem CMS zutreffen, so stellen Sie diese Option AN, phpMussel wird somit nicht nach leeren Elementen suchen, Sie bei einem Fund ignorieren und keine zugehörigen Fehlermeldungen ausgeben, der Request zum Seitenaufruf kann somit fortgesetzt werden. False = AUS/OFF; True = AN/ON.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Wenn Sie nur Bilder erwarten, die auf Ihr System oder CMS hochgeladen werden oder nur Bilder und keine anderen Dateien als Upload erlauben oder benötigen, so sollte diese Direktive aktiviert werden (ON), ansonsten deaktiviert bleiben (OFF). Ist diese Direktive aktiviert, wird phpMussel alle Uploads, die keine Bilddateien sind, blockieren, ohne sie zu scannen. Dies kann die Verarbeitungszeit und Speichernutzung reduzieren, sobald andere Nicht-Bilddateien hochgeladen werden. False = AUS/OFF; True = AN/ON.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Verschlüsselte Archive erkennen und blockieren? Denn phpMussel ist nicht in der Lage, die Inhalte von verschlüsselten Archiven zu scannen. Es ist möglich, dass Archiv-Verschlüsselung von Angreifern zum Umgehen von phpMussel, Antiviren-Scanner und weiterer solcher Schutzlösungen verwendet wird. Die Anweisung, dass phpMussel verschlüsselte Archive blockiert kann möglicherweise helfen, die Risiken, die mit dieser Möglichkeit verbunden sind, zu verringern. False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_files_check_archives'] = 'Soll der Inhalt von Archiven überprüft werden? False = Nein (keine Überprüfung); True = Ja (wird überprüft) [Standardeinstellung]. Zur Zeit wird NUR die Überprüfung von BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR und ZIP Archiven unterstützt (Überprüfung von RAR, CAB, 7z usw. wird zur Zeit NICHT unterstützt). Diese Funktion ist nicht sicher! Es wird dringend empfohlen, diese Funktion aktiviert zu lassen, es kann jedoch nicht garantiert werden, dass alles entdeckt wird. Die Archivüberprüfung ist derzeit nicht rekursiv für PHAR-Archive oder ZIP-Archive.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Soll das Blacklisting/Whitelisting der Dateigröße auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen); True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Begrenzung der Dateigröße in KB. 65536 = 64MB [Standardeinstellung]; 0 = Keine Begrenzung (wird immer zur Greylist hinzugefügt), jeder (positive) numerische Wert wird akzeptiert. Dies ist nützlich, wenn Ihre PHP-Konfiguration den verfügbaren Speicherverbrauch je Prozess einschränkt oder die Dateigröße von Uploads begrenzt.';
$phpMussel['lang']['config_files_filesize_response'] = 'Handhabung von Dateien, die die Begrenzung der Dateigröße (sofern angegeben) überschreiten. False = Hinzufügen zur Whitelist; True = Hinzufügen zur Blacklist [Standardeinstellung].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Soll das Blacklisting/Whitelisting des Dateityps auf den Inhalt des Archivs übertragen werden? False = Nein (alles nur in die Greylist aufnehmen) [Standardeinstellung]; True = Ja.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Sofern Ihr System spezielle Dateitypen im Upload erlaubt oder komplett verweigert, so unterteilen Sie diese Dateitypen in Whitelists, Blacklists oder Greylists, um den Scanvorgang zu beschleunigen, indem diese Dateitypen übersprungen werden. Format ist CSV (comma separated values, Komma-getrennte Werte). Möchten Sie lieber alles überprüfen lassen, so lassen Sie die Variable(n) leer; Dies deaktiviert die Whitelist/Blacklist/Greylist. Logische Reihenfolge der Verarbeitung ist: Wenn der Dateityp in der Whitelist ist, scanne und blockieren nicht die Datei, und überprüfe nicht wenn die Datei in der Whitelist oder in der Greylist ist. Wenn der Dateityp in der Blacklist ist, scanne nicht die Datei aber blockieren sie trotzdem, und überprüfe nicht wenn die Datei in der Greylist ist. Wenn die Greylist leer ist oder wenn die Greylist nicht leer ist und der Dateityp in der Greylist ist, scanne die Datei wie standardmäßig eingestellt ist und stelle fest, ob diese blockiert werden soll, basierend auf dem Scan, aber wenn die Greylist nicht leer ist und der Dateityp nicht in der Greylist ist, behandel die Datei als ob sie in der Blacklist ist, scanne sie nicht aber blockiere sie trotzdem. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Maximale Grenze der Rekursionstiefe von Archiven. Standardwert = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximale erlaubte Anzahl zu überprüfender Dateien während eines Dateiuploads bevor der Scan abgebrochen und der Nutzer darüber informiert wird, dass er zu viele Dateien auf einmal hochgeladen hat. Bietet einen Schutz gegen den theoretischen Angriff eines DDoS auf Ihr System oder CMS, indem der Angreifer phpMussel überlastet und den PHP-Prozess zum Stillstand bringt. Empfohlen: 10. Sie können den Wert abhängig von Ihrer Hardware erhöhen oder senken. Beachten Sie, dass dieser Wert nicht den Inhalt von Archiven berücksichtigt.';
$phpMussel['lang']['config_general_cleanup'] = 'Löscht die Scriptvariablen und den Cache nach der Ausführung. False = Nicht löschen; True = Löschen [Standardeinstellung]. Sollten Sie das Script nach der Überprüfung des Uploads nicht mehr nutzen, stellen Sie diese Option auf <code>true</code>, um die Speichernutzung zu minimieren. Verwenden Sie das Script noch für weitere Zwecke, stellen Sie die Option auf <code>false</code>, um unnötiges mehrfaches Einlesen der Daten in den Speicher zu vermeiden. Normalerweise sollte diese Option auf <code>true</code> gesetzt werden, allerdings können Sie das Script dann nur zur Dateiüberprüfung verwenden. Kein Einfluss im CLI-Modus.';
$phpMussel['lang']['config_general_default_algo'] = 'Definiert den Algorithmus für alle zukünftigen Passwörter und Sitzungen. Optionen: PASSWORD_DEFAULT (Standardeinstellung), PASSWORD_BCRYPT, PASSWORD_ARGON2I (erfordert PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Diese Option weist das Script an, Dateien während eines Scans sofort zu löschen, wenn ein Erkennungsmerkmal, ob durch Signaturen oder andere Methoden, zutrifft. Dateien, die als nicht infiziert eingestuft werden, werden nicht berührt. Im Falle von Archiven wird das gesamte Archiv gelöscht, auch wenn nur eine einzige Datei im Archiv infiziert sein sollte. Normalerweise ist es bei einem Dateiupload nicht notwendig, diese Option zu aktivieren, da PHP nach der Ausführung von Scripten den Inhalt vom Cache löscht, d.h. PHP löscht jede Datei, die über den Server hochgeladen wird, sofern Sie nicht verschoben, kopiert oder bereits gelöscht wurde. Diese Option wurde als zusätzliches Mass an Sicherheit hinzugefügt, außerdem für Systeme, deren PHP-Installation nicht dem üblichen Verhalten entspricht. False = Nach der Überprüfung wird die Datei so belassen [Standardeinstellung]; True = Nach der Überprüfung wird die Datei sofort gelöscht, sofern Sie infiziert ist.';
$phpMussel['lang']['config_general_disable_cli'] = 'CLI-Modus deaktivieren? CLI-Modus ist standardmäßig aktiviert, kann aber manchmal bestimmte Test-Tools (PHPUnit zum Beispiel) und andere CLI-basierte Anwendungen beeinträchtigen. Wenn du den CLI-Modus nicht deaktiveren musst, solltest du diese Anweisung ignorieren. False = CLI-Modus aktivieren [Standardeinstellung]; True = CLI-Modus deaktivieren.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Front-End-Access deaktivieren? Front-End-Access kann machen phpMussel einfacher zu handhaben, aber es kann auch ein potentielles Sicherheitsrisiko sein. Es wird empfohlen, wenn möglich, phpMussel über die Back-End-Access zu verwalten, aber Front-End-Access vorgesehen ist, für wenn es nicht möglich ist. Halten Sie es deaktiviert außer wenn Sie es brauchen. False = Front-End-Access aktivieren; True = Front-End-Access deaktivieren [Standardeinstellung].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Web-Fonts deaktivieren? True = Ja; False = Nein [Standardeinstellung].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Aktivieren Sie die Unterstützung für phpMussel Plugins? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Zurückgegebener 403-HTTP-Header bei einem blockierten Dateiupload. False = Nein (200); True = Ja (403) [Standardeinstellung].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Datei für die Protokollierung von Front-End Einloggen-Versuchen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Ist der Honeypot-Modus aktiviert, wird phpMussel jede Datei aus dem Dateiupload isolieren, ohne Rücksicht darauf zu nehmen, ob diese Dateien Signaturen enthalten, es findet auch keine weitere Überprüfung statt. Diese Funktionalität dient ausschließlich dem Zweck der Viren- und Malwareforschung, es wird ausdrücklich nicht empfohlen, phpMussel mit dieser Funktion zum Zwecke der Dateiüberprüfung von Uploads oder anderen Zwecken außer "Honeypotting" zu verwenden. Standardmäßig ist diese Funktion deaktiviert. False = Deativiert [Standardwert]; True = Aktiviert.';
$phpMussel['lang']['config_general_ipaddr'] = 'Ort der IP-Adresse der aktuellen Verbindung im gesamten Datenstrom (nützlich für Cloud-Services) Standardeinstellung = REMOTE_ADDR. Achtung: Ändern Sie diesen Wert nur wenn Sie wissen was Sie tun!';
$phpMussel['lang']['config_general_lang'] = 'Gibt die Standardsprache für phpMussel an.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Wartungsmodus aktivieren? True = Ja; False = Nein [Standardeinstellung]. Deaktiviert alles andere als das Front-End. Manchmal nützlich für die Aktualisierung Ihrer CMS, Frameworks, usw.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Maximale Anzahl der Versucht zu einloggen (Front-End). Standardeinstellung = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Wie willst du Nummern anzeigen? Wählen Sie das Beispiel aus, das Ihnen am besten entspricht.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel ist in der Lage, Versuche von Datei-Uploads in einem Quarantäne-Verzeichnis zu isolieren, sofern Sie dies tun wollen. Nutzer, die nur daran interessiert sind, ihre Webauftritte oder ihre Hosting-Umgebung zu schützen ohne das Interesse, die markierten Dateien weitergehend zu untersuchen, sollten diese Funktionalität deaktivieren, Nutzer, die diese Dateien zur Ananlyse auf Malware o.ä. benötigen, sollten diese Funktion aktivieren. Die Isolation von markierten Dateien kann manchmal auch bei der Fehlersuche von Fehlalarmen helfen, wenn dies häufiger bei Ihnen auftritt. Um die Quarantänefunktion zu deaktivieren, lassen Sie die Richtlinie <code>quarantine_key</code> leer oder löschen Sie den Inhalt dieser Richtlinie, wenn sie nicht bereits leer ist. Um die Quarantänefunktion zu aktivieren, geben Sie einen Wert ein. Der <code>quarantine_key</code> ist ein wichtiges Sicherheitsmerkmal der Quarantänfunktionen, um zu verhindern, dass die Quarantänefunktionen einem Exploit ausgesetzt wird und gespeicherte Daten in der Quarantäneumgebung ausgeführt werden können. Der Wert des <code>quarantine_key</code> sollte so behandelt werden, wie Ihre Passwörter: Je länger, desto besser, und halten Sie sie geheim. Optimal in Verbindung mit <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'Die maximal zulässige Dateigröße von Dateien, die in der Quarantäne isoliert werden sollen. Dateien, die größer sind als der angegebene Wert, werden NICHT im Quarantäneverzeichnis gespeichert. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardeinstellung = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'Die maximal zulässige Speichernutzung der Quarantäne. Erreicht die Geamtgröße der Dateien in der Quarantäne diesen Wert, werden die ältesten Dateien in der Quarantäne gelöscht, bis der Wert unterschritten wird. Diese Richtlinie ist wichtig, um es einem potentiellen Angreifer zu erschweren, die Quarantäne -und somit Ihren zugesicherten Speicher auf Ihrem Hostservice- mit unerwünschten Daten zu überfluten. Standardwert = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Für wie lange soll phpMussel die Scan-Ergebnisse zwischenspeichern? Wert entspricht der Anzahl Sekunden, wie lange die Scan-Ergebnisse zwischengespeichert werden. Standard ist 21600 Sekunden (6 Stunden); Ein Wert von 0 wird das Zwischenspeichern von Scan-Ergebnissen deaktivieren.';
$phpMussel['lang']['config_general_scan_kills'] = 'Name einer Datei zum Aufzeichnen aller blockierten Uploads. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.';
$phpMussel['lang']['config_general_scan_log'] = 'Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen. Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Name einer Datei zum Aufzeichnen aller Resultate von Überprüfungen (Format ist serialisiert). Geben Sie einen Dateinamen an oder lassen Sie die Option zum Deaktivieren leer.';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel-Nutzungsstatistiken verfolgen? True = Ja; False = Nein [Standardeinstellung].';
$phpMussel['lang']['config_general_timeFormat'] = 'Das Datumsformat verwendet von phpMussel. Zusätzliche Optionen können auf Anfrage hinzugefügt werden.';
$phpMussel['lang']['config_general_timeOffset'] = 'Zeitzonenversatz in Minuten.';
$phpMussel['lang']['config_general_timezone'] = 'Ihre Zeitzone.';
$phpMussel['lang']['config_general_truncate'] = 'Trunkate Protokolldateien, wenn sie eine bestimmte Größe erreichen? Wert ist die maximale Größe in B/KB/MB/GB/TB, die eine Protokolldatei wachsen kann, bevor sie trunkiert wird. Der Standardwert von 0KB deaktiviert die Trunkierung (Protokolldateien können unbegrenzt wachsen). Hinweis: Gilt für einzelne Protokolldateien! Die Größe der Protokolldateien gilt nicht als kollektiv.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Es gibt bestimmte Signaturen in phpMussel, die dazu dienen, verdächtige und potenziell bösartige Eigenschaften von hochgeladenen Dateien zu identifizieren, ohne diese Dateien an sich zu überprüfen und als bösartig zu identifizieren. Diese Direktive teilt phpMussel mit, welche Gewichtung von verdächtigen und potenziell bösartigen Eigenschaften zulässig ist, bevor diese Dateien als bösartig gekennzeichnet werden. Die Definition des Gewichts ist in diesem Zusammenhang die Gesamtzahl der verdächtigen und potenziell bösartigen Eigenschaften. Standardwert ist 3. Ein niedriger Wert in der Regel führt zu einem vermehrten Auftreten von Fehlalarmen und eine größere Anzahl von schädlichen Dateien werden erkannt, während ein höherer Wert weniger Fehlalarme auslöst und eine geringere Anzahl von schädlichen Dateien markiert werden. Dieser Wert sollte so belassen werden, es sei denn, Sie erkennen Probleme, die durch diese Einstellung hervorgerufen werden.';
$phpMussel['lang']['config_signatures_Active'] = 'Eine Liste der aktiven Signaturdateien, die durch Kommas getrennt sind.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Soll phpMussel Signaturen für die Erkennung von Adware parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Soll phpMussel Signaturen für die Erkennung von Defacements und Defacer parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Soll phpMussel verschlüsselte Dateien erkennen und blockieren? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Soll phpMussel Signaturen für die Erkennung von Scherz/Fake-Malware/Viren parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Soll phpMussel Signaturen für die Erkennung von Packern und komprimierten Daten parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Soll phpMussel Signaturen für die Erkennung von PUAs/PUPs parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Soll phpMussel Signaturen für die Erkennung von Shell-Scripten parsen? False = Nein; True = Ja [Standardeinstellung].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Soll phpMussel melden, wenn Dateierweiterungen fehlen? Wenn <code>fail_extensions_silently</code> deaktiviert ist, werden fehlende Dateierweiterungen beim Scannen gemeldet und wenn <code>fail_extensions_silently</code> aktiviert ist, werden fehlende Dateierweiterungen ignoriert und beim Scan gemeldet, dass es mit diesen Dateien keine Probleme gibt. Das Deaktivieren dieser Anweisung kann möglicherweise deine Sicherheit erhöhen, kann aber auch zu mehr Falschmeldungen führen. False = Deaktiviert; True = Aktiviert [Standardeinstellung].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Reaktion von phpMussel auf fehlende oder defekte Signaturen. Ist <code>fail_silently</code> deaktiviert, werden fehlende oder defekte Signaturen während des Scanvorgangs gemeldet, ist <code>fail_silently</code> aktiviert, werden fehlende oder defekte Signaturen ignoriert, ohne dass entsprechende Probleme gemeldet werden. Diese Option sollte so belassen werden, es sei denn, Sie erwarten Abstürze oder ähnliches. False = Deaktiviert; True = Aktiviert [Standardeinstellung].';
$phpMussel['lang']['config_template_data_css_url'] = 'Die Template-Datei für benutzerdefinierte Themes verwendet externe CSS-Regeln, wobei die Template-Datei für das normale Theme interne CSS-Regeln verwendet. Um phpMussel anzuweisen, die Template-Datei für benutzerdefinierte Themes zu verwenden, geben Sie die öffentliche HTTP-Adresse von den CSS-Dateien des benutzerdefinierten Themes mit der <code>css_url</code>-Variable an. Wenn Sie diese Variable leer lassen, wird phpMussel die Template-Datei für das normale Theme verwenden.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Schriftvergrößerung. Standardeinstellung = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Standard-Thema für phpMussel verwenden.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Wie lange (in Sekunden) sollen die Ergebnisse von API-Abfragen zwischengespeichert werden? Standardeinstellung ist 3600 Sekunden (1 Stunde).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Aktiviert API-Abfragen zur Google Safe Browsing API wenn der benötigte API-Schlüssel festgelegt ist.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Aktiviert API-Abfragen zur hpHosts API wenn der Wert auf <code>true</code> gesetzt ist.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Die maximal erlaubte Anzahl von API-Abfragen die bei jedem Scan-Durchgang durchgeführt werden. Weil jede zusätzliche API-Abfrage die Zeit für einen Scan-Durchgang erhöht, wollen Sie unter Umständen ein Limit festlegen, um den gedamten Scan-Prozess zu beschleunigen. Wenn 0 eingestellt wird, wird kein Limit angewendet. Standardmäßig ist der Wert auf 10 gesetzt.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Was soll passieren, wenn die maximale Anzahl der erlaubten API-Abfragen erreicht wird? False = Nichts (Verarbeitung fortführen) [Standardeinstellung]; True = Markiere/blockiere die Datei.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Optional, phpMussel kann Dateien mit der Virus Total API scannen, um einen noch besseren Schutz gegen Viren, Trojaner, Malware und andere Bedrohungen zu bieten. Standardmäßig ist das Scannen von Dateien mit der Virus Total API deaktiviert. Um es zu aktivieren, wird ein API Schlüssel von Virus Total benötigt. Wegen dem großen Vorteil den dir das bietet, empfehle ich die Aktivierung. Bitte sei dir bewusst, um die Virus Total API zu nutzen, dass du deren Nutzungsbedingungen zustimmen und dich an alle Richtlinien halten musst, wie es in der Virus Total Dokumentation beschrieben ist! Du darfst diese Integrations-Funktion nicht verwenden AUSSER: Du hast die Nutzungsbedingungen von Virus Total und der API gelesen und stimmst diesen zu. Du hast, zu einem Minimum, das Vorwort von der Virus Total Public API Dokumentation gelesen und verstanden (alles nach "Virus Total Public API v2.0" aber vor "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Laut der Virus Total API Dokumentation, "ist diese auf 4 Anfragen irgendeiner Art in einer 1 Minuten Zeitspanne limitiert. Falls du einen Honeyclient, Honeypot oder einen andere Automatisierung verwendest, was etwas zu VirusTotal beiträgt und nicht nur Berichte abruft, bist du für ein höheres Limit berechtigt". Standardmäßig wird sich phpMussel strikt daran halten, da aber diese Limits erhöht werden können, stehen dir diese zwei Direktiven zur Verfügung um phpMussel anzuweisen, an welches Limit es sich halten soll. Außer du bist dazu aufgefordert, ist es nicht empfohlen diese Werte zu erhöhen. Solltest du aber Probleme bezogen auf das Erreichen des Limits haben, <em><strong>SOLLTE</strong></em> das Verringern dieser Werte manchmal helfen. Dein Limit wird festgelegt als <code>vt_quota_rate</code> Anfragen jeder Art in jeder <code>vt_quota_time</code> Minuten Zeitspanne.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Siehe Beschreibung oben).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'phpMussel wird standardmäßig die mit der Virus Total API zu scannenden Dateien auf Dateien eisnchränken, die es als "verdächtig" betrachtet. Du kannst optional diese Einschränkung durch Änderung des Wertes der <code>vt_suspicion_level</code> Direktive anpassen.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Soll phpMussel die Ergebnisse des Scans mit der Virus Total API als Erkennungen oder Erkennungs-Gewichtung anwenden? Diese Direktive existiert, weil das Scannen einer Datei mit mehreren Engines (wie es Virus Total macht) in einer höheren Erkennungsrate resultieren sollte (und somit eine größere Anzahl schädlicher Dateien erwischt werden), dies kann aber zu in einer höheren Anzahl von Falschmeldungen führen. Unter manchen Umständen würden die Ergebnisse des Scans besser als Vertrauens-Wert als ein eindeutiges Ergebnis verwendet werden. Wenn der Wert 0 verwendet wird, werden die Ergebnisse des Scans als Erkennungen angewendet und somit wird phpMussel, falls irgendeine von Virus Total verwendete Engine die gescannte Datei als schädlich markiert, die Datei als schädlich betrachten. Wird ein anderer Wert verwendet, werden die Ergebnisse des Scans mit der Virus Total API als Erkennungs-Gewichtung angewendet. Die Anzahl der von Virus Total verwendeten Engines, welche die Datei als schädlich markieren, wird als Vertrauens-Wert (oder Erkennungs-Gewichtung) dienen, ob die gescannte Datei von phpMussel als schädlich angesehen werden soll (der verwendete Wert wird den Mindest-Vertrauens-Wert oder erforderliche Gewichtung repräsentieren, um als schädlich angesehen zu werden. Standardmäßig der Wert 0 verwendet.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'Das Hauptpaket (Abzüglich der Unterschriften, Dokumentation, und Konfiguration).';
$phpMussel['lang']['field_activate'] = 'Aktivieren';
$phpMussel['lang']['field_clear_all'] = 'Alles löschen';
$phpMussel['lang']['field_component'] = 'Komponente';
$phpMussel['lang']['field_create_new_account'] = 'Neuen Konto erstellen';
$phpMussel['lang']['field_deactivate'] = 'Deaktivieren';
$phpMussel['lang']['field_delete_account'] = 'Konto löschen';
$phpMussel['lang']['field_delete_all'] = 'Alles löschen';
$phpMussel['lang']['field_delete_file'] = 'Löschen';
$phpMussel['lang']['field_download_file'] = 'Herunterladen';
$phpMussel['lang']['field_edit_file'] = 'Bearbeiten';
$phpMussel['lang']['field_false'] = 'False (Falsch)';
$phpMussel['lang']['field_file'] = 'Datei';
$phpMussel['lang']['field_filename'] = 'Dateiname: ';
$phpMussel['lang']['field_filetype_directory'] = 'Verzeichnis';
$phpMussel['lang']['field_filetype_info'] = '{EXT}-Datei';
$phpMussel['lang']['field_filetype_unknown'] = 'Unbekannt';
$phpMussel['lang']['field_install'] = 'Installieren';
$phpMussel['lang']['field_latest_version'] = 'Letzte Version';
$phpMussel['lang']['field_log_in'] = 'Einloggen';
$phpMussel['lang']['field_more_fields'] = 'Mehr Felder';
$phpMussel['lang']['field_new_name'] = 'Neuer Name:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Optionen';
$phpMussel['lang']['field_password'] = 'Passwort';
$phpMussel['lang']['field_permissions'] = 'Berechtigungen';
$phpMussel['lang']['field_quarantine_key'] = 'Quarantäneschlüssel';
$phpMussel['lang']['field_rename_file'] = 'Umbenennen';
$phpMussel['lang']['field_reset'] = 'Zurücksetzen';
$phpMussel['lang']['field_restore_file'] = 'Wiederherstellen';
$phpMussel['lang']['field_set_new_password'] = 'Neues Passwort eingeben';
$phpMussel['lang']['field_size'] = 'Gesamtgröße: ';
$phpMussel['lang']['field_size_bytes'] = ['Byte', 'Bytes'];
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Status';
$phpMussel['lang']['field_system_timezone'] = 'System Standard-Zeitzone verwenden.';
$phpMussel['lang']['field_true'] = 'True (Wahr)';
$phpMussel['lang']['field_uninstall'] = 'Deinstallieren';
$phpMussel['lang']['field_update'] = 'Aktualisieren';
$phpMussel['lang']['field_update_all'] = 'Alle aktualisieren';
$phpMussel['lang']['field_upload_file'] = 'Neue Datei hochladen';
$phpMussel['lang']['field_username'] = 'Benutzername';
$phpMussel['lang']['field_your_version'] = 'Ihre Version';
$phpMussel['lang']['header_login'] = 'Bitte einloggen zum Fortfahren.';
$phpMussel['lang']['label_active_config_file'] = 'Aktive Konfigurationsdatei: ';
$phpMussel['lang']['label_blocked'] = 'Uploads blockiert';
$phpMussel['lang']['label_branch'] = 'Branch neueste stabil:';
$phpMussel['lang']['label_events'] = 'Scan-Veranstaltungen';
$phpMussel['lang']['label_flagged'] = 'Objekte markiert';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Cache-Daten und temporäre Dateien';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel Speicherplatz verwendet: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Speicherplatz verfügbar: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Speicherplatz verwendet insgesamt: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Speicherplatz insgesamt: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Komponente aktualisiert Metadaten';
$phpMussel['lang']['label_hide'] = 'Verstecke';
$phpMussel['lang']['label_os'] = 'Betriebssystem verwendet:';
$phpMussel['lang']['label_other'] = 'Andere';
$phpMussel['lang']['label_other-Active'] = 'Aktive Signaturdateien';
$phpMussel['lang']['label_other-Since'] = 'Anfangsdatum';
$phpMussel['lang']['label_php'] = 'PHP-Version verwendet:';
$phpMussel['lang']['label_phpmussel'] = 'phpMussel-Version verwendet:';
$phpMussel['lang']['label_quarantined'] = 'Uploads unter Quarantäne gestellt';
$phpMussel['lang']['label_sapi'] = 'SAPI verwendet:';
$phpMussel['lang']['label_scanned_objects'] = 'Objekte gescannt';
$phpMussel['lang']['label_scanned_uploads'] = 'Uploads gescannt';
$phpMussel['lang']['label_show'] = 'Zeig';
$phpMussel['lang']['label_size_in_quarantine'] = 'Größe in Quarantäne: ';
$phpMussel['lang']['label_stable'] = 'Neueste stabil:';
$phpMussel['lang']['label_sysinfo'] = 'System Information:';
$phpMussel['lang']['label_tests'] = 'Tests:';
$phpMussel['lang']['label_unstable'] = 'Neueste instabil:';
$phpMussel['lang']['label_upload_date'] = 'Datum des Hochladens: ';
$phpMussel['lang']['label_upload_hash'] = 'Hash des Hochladen: ';
$phpMussel['lang']['label_upload_origin'] = 'Ursprung des Hochladen: ';
$phpMussel['lang']['label_upload_size'] = 'Größe des Hochladen: ';
$phpMussel['lang']['link_accounts'] = 'Konten';
$phpMussel['lang']['link_config'] = 'Konfiguration';
$phpMussel['lang']['link_documentation'] = 'Dokumentation';
$phpMussel['lang']['link_file_manager'] = 'Dateimanager';
$phpMussel['lang']['link_home'] = 'Startseite';
$phpMussel['lang']['link_logs'] = 'Protokolldateien';
$phpMussel['lang']['link_quarantine'] = 'Quarantäne';
$phpMussel['lang']['link_statistics'] = 'Statistiken';
$phpMussel['lang']['link_textmode'] = 'Textformatierung: <a href="%1$sfalse">Einfach</a> – <a href="%1$strue">Schick</a>';
$phpMussel['lang']['link_updates'] = 'Aktualisierungen';
$phpMussel['lang']['link_upload_test'] = 'Upload-Prüfung';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Ausgewählte Protokolldatei existiert nicht!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Keine Protokolldateien vorhanden.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Keine Protokolldatei ausgewählt.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Maximale Anzahl der Versucht zu einloggen überschritten; Zugriff verweigert.';
$phpMussel['lang']['previewer_days'] = 'Tage';
$phpMussel['lang']['previewer_hours'] = 'Stunden';
$phpMussel['lang']['previewer_minutes'] = 'Minuten';
$phpMussel['lang']['previewer_months'] = 'Monate';
$phpMussel['lang']['previewer_seconds'] = 'Sekunden';
$phpMussel['lang']['previewer_weeks'] = 'Wochen';
$phpMussel['lang']['previewer_years'] = 'Jahre';
$phpMussel['lang']['response_accounts_already_exists'] = 'Ein Konto mit diesem Benutzernamen ist bereits vorhanden!';
$phpMussel['lang']['response_accounts_created'] = 'Konto erfolgreich erstellt!';
$phpMussel['lang']['response_accounts_deleted'] = 'Konto erfolgreich gelöscht!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Dieses Konto existiert nicht.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Passwort erfolgreich aktualisiert!';
$phpMussel['lang']['response_activated'] = 'Erfolgreich aktiviert.';
$phpMussel['lang']['response_activation_failed'] = 'Konnte nicht aktivieren!';
$phpMussel['lang']['response_checksum_error'] = 'Prüfsummenfehler! Datei abgelehnt!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Komponente erfolgreich installiert.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Komponente erfolgreich deinstalliert.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Komponente erfolgreich aktualisiert.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Beim Deinstallieren der Komponente ist ein Fehler aufgetreten.';
$phpMussel['lang']['response_configuration_updated'] = 'Konfiguration erfolgreich aktualisiert.';
$phpMussel['lang']['response_deactivated'] = 'Erfolgreich deaktiviert.';
$phpMussel['lang']['response_deactivation_failed'] = 'Konnte nicht deaktivieren!';
$phpMussel['lang']['response_delete_error'] = 'Löschung-Fehler!';
$phpMussel['lang']['response_directory_deleted'] = 'Verzeichnis erfolgreich gelöscht!';
$phpMussel['lang']['response_directory_renamed'] = 'Verzeichnis erfolgreich umbenannt!';
$phpMussel['lang']['response_error'] = 'Fehler';
$phpMussel['lang']['response_failed_to_install'] = 'Installation fehlgeschlagen!';
$phpMussel['lang']['response_failed_to_update'] = 'Aktualisierung fehlgeschlagen!';
$phpMussel['lang']['response_file_deleted'] = 'Datei erfolgreich gelöscht!';
$phpMussel['lang']['response_file_edited'] = 'Datei erfolgreich geändert!';
$phpMussel['lang']['response_file_renamed'] = 'Datei erfolgreich umbenannt!';
$phpMussel['lang']['response_file_restored'] = 'Datei erfolgreich wiederhergestellt!';
$phpMussel['lang']['response_file_uploaded'] = 'Datei erfolgreich hochgeladen!';
$phpMussel['lang']['response_login_invalid_password'] = 'Einloggen-Fehler! Ungültiges Passwort!';
$phpMussel['lang']['response_login_invalid_username'] = 'Einloggen-Fehler! Benutzername existiert nicht!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Passwort-Feld leer!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Benutzername-Feld leer!';
$phpMussel['lang']['response_rename_error'] = 'Umbenennung-Fehler!';
$phpMussel['lang']['response_restore_error_1'] = 'Fehler beim Wiederherstellen! Beschädigte Datei!';
$phpMussel['lang']['response_restore_error_2'] = 'Fehler beim Wiederherstellen! Falscher Quarantäneschlüssel!';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistiken gelöscht.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Schon aktuell.';
$phpMussel['lang']['response_updates_not_installed'] = 'Komponente nicht installiert!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Komponente nicht installiert (erfordert PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Veraltet!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Veraltet (bitte manuell aktualisieren)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Veraltet (erfordert PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Kann nicht ermittelt werden.';
$phpMussel['lang']['response_upload_error'] = 'Hochladen-Fehler!';
$phpMussel['lang']['state_complete_access'] = 'Vollständiger Zugriff';
$phpMussel['lang']['state_component_is_active'] = 'Komponente ist aktiv.';
$phpMussel['lang']['state_component_is_inactive'] = 'Komponente ist inaktiv.';
$phpMussel['lang']['state_component_is_provisional'] = 'Komponente ist vorläufig.';
$phpMussel['lang']['state_default_password'] = 'Warnung: Verwendet das Standard-Passwort!';
$phpMussel['lang']['state_logged_in'] = 'Eingeloggt.';
$phpMussel['lang']['state_logs_access_only'] = 'Zugriff nur auf Protokolldateien';
$phpMussel['lang']['state_maintenance_mode'] = 'Warnung: Wartungsmodus ist aktiviert!';
$phpMussel['lang']['state_password_not_valid'] = 'Warnung: Dieses Konto verwendet kein gültiges Passwort!';
$phpMussel['lang']['state_quarantine'] = ['Es befinden sich derzeit %s Datei in der Quarantäne.', 'Es befinden sich derzeit %s Dateien in der Quarantäne.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Nicht verstecken nicht veraltet';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Verstecken nicht veraltet';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Nicht verstecken unbenutzt';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Verstecken unbenutzt';
$phpMussel['lang']['tip_accounts'] = 'Hallo, {username}.<br />Das Kontenseite macht es möglich zu kontrollieren, wer kann Zugriff auf der phpMussel Front-End haben.';
$phpMussel['lang']['tip_config'] = 'Hallo, {username}.<br />Das Konfigurationsseite macht es möglich zu ändern das Konfiguration für phpMussel von der Front-End.';
$phpMussel['lang']['tip_donate'] = 'phpMussel wird kostenlos angeboten, aber wenn Sie für das Projekt spenden möchten, können Sie dies tun indem Klicken Sie auf die Spenden-Schaltfläche.';
$phpMussel['lang']['tip_file_manager'] = 'Hallo, {username}.<br />Mit dem Dateimanager können Sie Dateien löschen, bearbeiten, hochladen und herunterladen. Mit Vorsicht verwenden (Können Sie Ihre Installation mit diesem brechen).';
$phpMussel['lang']['tip_home'] = 'Hallo, {username}.<br />Dies ist die Homepage der phpMussel Front-End. Wählen Sie einen Link aus dem Navigationsmenü auf der linken um fortzufahren.';
$phpMussel['lang']['tip_login'] = 'Standard-Benutzername: <span class="txtRd">admin</span> – Standard-Passwort: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Hallo, {username}.<br />Wählen Sie eine Protokolldatei aus der folgenden Liste um den Inhalt dieser Protokolldatei anzuzeigen.';
$phpMussel['lang']['tip_quarantine'] = 'Hallo, {username}.<br />Diese Seite erleichtert die Verwaltung von, und listet alle Dateien auf, die sich derzeit in der Quarantäne befinden.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Hinweis: Die Quarantäne ist derzeit deaktiviert, aber kann über die Konfigurationsseite aktiviert werden.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Siehe die <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.de.md#SECTION7">Dokumentation</a> für Informationen über den verschiedenen Konfigurationseinstellungen und ihren Zwecken.';
$phpMussel['lang']['tip_statistics'] = 'Hallo, {username}.<br />Diese Seite zeigt einige grundlegende Nutzungsstatistiken zu Ihrer phpMussel-Installation.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Hinweis: Die Statistikverfolgung ist derzeit deaktiviert, aber kann über die Konfigurationsseite aktiviert werden.';
$phpMussel['lang']['tip_updates'] = 'Hallo, {username}.<br />Das Aktualisierungsseite macht es möglich für Sie zu installieren, zu deinstallieren und zu aktualisieren die verschiedenen Komponenten von phpMussel (das Kernpaket, Signaturen, Plugins, L10N-Dateien, u.s.w.).';
$phpMussel['lang']['tip_upload_test'] = 'Hallo, {username}.<br />Das Upload-Testseite enthält ein Standard-Datei-Upload-Formular, das macht es möglich zu prüfen ob eine Datei normalerweise gestoppt von phpMussel werden soll, wenn Sie versuchen es hochzuladen.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Konten';
$phpMussel['lang']['title_config'] = 'phpMussel – Konfiguration';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Dateimanager';
$phpMussel['lang']['title_home'] = 'phpMussel – Startseite';
$phpMussel['lang']['title_login'] = 'phpMussel – Einloggen';
$phpMussel['lang']['title_logs'] = 'phpMussel – Protokolldateien';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Quarantäne';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistiken';
$phpMussel['lang']['title_updates'] = 'phpMussel – Aktualisierungen';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Upload-Prüfung';
$phpMussel['lang']['warning'] = 'Warnungen:';
$phpMussel['lang']['warning_php_1'] = 'Ihre PHP-Version wird nicht mehr aktiv unterstützt! Aktualisierung wird empfohlen!';
$phpMussel['lang']['warning_php_2'] = 'Ihre PHP-Version ist schwer verwundbar! Aktualisierung wird dringend empfohlen!';
$phpMussel['lang']['warning_signatures_1'] = 'Keine Signaturdateien sind aktiv!';

$phpMussel['lang']['info_some_useful_links'] = 'Einige nützliche Links:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel Fragen @ GitHub</a> – Problemseite für phpMussel (Unterstützung, u.s.w.).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Diskussionsforum für phpMussel (Unterstützung, u.s.w.).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Alternative download spiegel für phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Eine Sammlung von einfachen Webmaster-Tools, um Websites zu sichern.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV Startseite (ClamAV® ClamAV ist ein Open-Source-Antivirus-Modul für die Erkennung von Trojanern, Viren, Malware und anderen bösartigen Bedrohungen).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Computer Security Unternehmen, das ergänzende Signaturen für ClamAV bietet.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Phishing-Datenbank, die vom phpMussel-URL-Scanner verwendet wird.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP Lernressourcen und Diskussion.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP Lernressourcen und Diskussion.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal ist ein kostenloser Dienst zur Analyse verdächtiger Dateien und URLs.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis ist ein kostenloser Malware-Analyse-Service von <a href="http://www.payload-security.com/">Payload Security</a> zur Verfügung gestellt.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Computer-Anti-Malware-Spezialisten.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Nützliche Malware konzentrierte Diskussionsforen.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Sicherheitskarten</a> – Listet sichere/unsichere Versionen verschiedener Pakete auf (PHP, HHVM, usw).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Kompatibilitätskarten</a> – Listet Kompatibilitätsinformationen für verschiedene Pakete auf (CIDRAM, phpMussel, usw).</li>
        </ul>';
