## Documentazione per phpMussel (Italiano).

### Contenuti
- 1. [PREAMBOLO](#SECTION1)
- 2. [COME INSTALLARE](#SECTION2)
- 3. [COME USARE](#SECTION3)
- 4. [GESTIONE FRONT-END](#SECTION4)
- 5. [CLI (INTERFACCIA A RIGA DI COMANDO)](#SECTION5)
- 6. [FILE INCLUSI IN QUESTO PACCHETTO](#SECTION6)
- 7. [OPZIONI DI CONFIGURAZIONE](#SECTION7)
- 8. [FIRMA FORMATO](#SECTION8)
- 9. [CONOSCIUTI COMPATIBILITÀ PROBLEMI](#SECTION9)
- 10. [DOMANDE FREQUENTI (FAQ)](#SECTION10)
- 11. [INFORMAZIONE LEGALE](#SECTION11)

*Nota per quanto riguarda le traduzioni: In caso di errori (per esempio, discrepanze tra le traduzioni, errori di battitura, ecc), la versione Inglese del README è considerata la versione originale e autorevole. Se trovate errori, il vostro aiuto a correggerli sarebbe il benvenuto.*

---


### 1. <a name="SECTION1"></a>PREAMBOLO

Grazie per aver scelto phpMussel, un programma in PHP progettato per rilevare trojan, virus, malware ed altre minacce nei file caricati sul tuo sistema dovunque il programma stesso è collegato, basato sulle firme di ClamAV ed altri.

PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPLv2 Caleb M (Maikuolan).

Questo script è un software "libero"; è possibile ridistribuirlo e/o modificarlo sotto i termini della GNU General Public License come pubblicato dalla Free Software Foundation; o la versione 2 della licenza, o (a propria scelta) una versione successiva. Questo script è distribuito nella speranza che possa essere utile, ma SENZA ALCUNA GARANZIA; senza neppure la implicita garanzia di COMMERCIABILITÀ o IDONEITÀ PER UN PARTICOLARE SCOPO. Vedere la GNU General Public License per ulteriori dettagli, situato nella `LICENSE.txt` file e disponibili anche da:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Uno speciale grazie a [ClamAV](http://www.clamav.net/) per l'ispirazione del progetto e per le firme che questo script usi, senza la quale, lo script sarebbe probabilmente non esisterebbe, o nel migliore, avrebbe un molto limitato valore.

Uno speciale grazie a SourceForge e GitHub per ospitare i progetto file, e le risorse di un certo numero di firme utilizzata da phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) e altri, e un grazie a tutti coloro che sostengono il progetto, a chiunque altro che io possa avere altrimenti dimenticato di menzionare, e per voi, per l'utilizzo dello script.

Questo documento ed il pacchetto associato ad esso possono essere scaricati liberamente da:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>COME INSTALLARE

#### 2.0 INSTALLAZIONE MANUALMENTE (PER WEB SERVER)

1) Continuando la lettura, si suppone che hai già scaricato una copia dello script, decompresso il contenuto e lo hai collocato da qualche parte sul tuo terminale. Da qui, ti consigliamo di determinare dove sulla macchina o CMS si desidera inserire quei contenuti. Una cartella come `/public_html/phpmussel/` o simile (sebbene, non è importante quale si sceglie, purché sia qualcosa di sicuro e che ti soddisfi) sarà sufficiente. *Prima di iniziare il caricamento, continua a leggere..*

2) Rinomina `config.ini.RenameMe` a `config.ini` (situato della `vault`), e facoltativamente (fortemente consigliata per gli avanzati utenti, ma non è consigliata per i principianti o per gli inesperti), aprirlo (questo file contiene tutte le direttive disponibili per phpMussel; sopra ogni opzione dovrebbe essere un breve commento che descrive ciò che fa e ciò che è per). Regolare queste opzioni come meglio credi, come per ciò che è appropriato per la vostre particolare configurazione. Salvare il file, chiudere.

3) Carica i contenuti (phpMussel e le sue file) nella cartella che ci deciso in precedenza (non è necessario includere i `*.txt`/`*.md` file, ma altrimenti, si dovrebbe caricare tutto).

4) CHMOD la cartella `vault` a "755" (se ci sono problemi, si può provare "777", ma questo è meno sicura). La principale cartella che memorizzare il contenuti (quello scelto in precedenza), solitamente, può essere lasciato solo, ma lo CHMOD stato dovrebbe essere controllato se hai avuto problemi di autorizzazioni in passato sul vostro sistema (per predefinita, dovrebbe essere qualcosa simile a "755").

5) Installare tutte le firme necessarie. *Vedere: [INSTALLAZIONE DI FIRME](#INSTALLING_SIGNATURES).*

6) Successivamente, sarà necessario collegare phpMussel al vostro sistema o CMS. Ci sono diversi modi in cui è possibile collegare script come phpMussel al vostre sistema o CMS, ma il più semplice è di inserire lo script all'inizio di un file del vostre sistema o CMS (quello che sarà generalmente sempre essere caricato quando qualcuno accede a una pagina attraverso il vostro sito) utilizzando un `require` o `include` comando. Solitamente, questo sarà qualcosa memorizzate in una cartella, ad esempio `/includes`, `/assets` o `/functions`, e spesso essere chiamato qualcosa come `init.php`, `common_functions.php`, `functions.php` o simili. Avrete bisogno determinare quale file è per la vostra situazione; In caso di difficoltà nel determinare questo per te, per assistenza, visitare la pagina di problemi/issues per phpMussel a GitHub o il forum di supporto per phpMussel; È possibile che io o un altro utente possono avere esperienza con il CMS che si sta utilizzando (avrete bisogno di fateci sapere quale CMS si sta utilizzando), e quindi, può essere in grado di fornire assistenza in questo settore. Per fare questo [utilizzare `require` o `include`], inserire la seguente linea di codice all'inizio di quel core file, sostituendo la stringa contenuta all'interno delle virgolette con l'indirizzo esatto del file `loader.php` (l'indirizzo locale, non l'indirizzo HTTP; sarà simile all'indirizzo citato in precedenza).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Salvare il file, chiudere, caricare di nuovo.

-- IN ALTERNATIVA --

Se stai usando un Apache web server e se si ha accesso a `php.ini`, è possibile utilizzare il `auto_prepend_file` direttiva per precarico phpMussel ogni volta che qualsiasi richiesta di PHP è fatto. Qualcosa come:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

O questo nel `.htaccess` file:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare il lavoro svolto per assicurarsi che funzioni correttamente. Per testare le protezioni di file caricamente, tentare di caricare i test file inclusi nella pacchetto all'interno `_testfiles` al vostro web sito via i vostri soliti metodi di browser basato file caricamento. Se tutto funziona, un messaggio dovrebbe apparire da phpMussel conferma che il caricamento è stato bloccato con successo. Se nulla appare, qualcosa non funziona correttamente. Se si sta utilizzando qualsiasi l'avanzate funzioni o se si sta utilizzando qualsiasi altri tipi di scansione possibili con lo strumento, mi piacerebbe suggerisco di provarlo quelli per assicurarsi che funzioni come previsto, anche.

#### 2.1 INSTALLAZIONE MANUALMENTE (PER CLI)

1) Con la vostra lettura di questo, sto supponendo che hai già scaricato una archiviata copia dello script, decompresso il contenuto e lo hanno seduto da qualche parte sul tuo locale macchina. Quando hai stabilito che sei felice con il luogo scelto per phpMussel, continuare.

2) phpMussel richiede PHP essere installato sulla macchina per eseguire. Se non lo avete PHP installato sul vostra macchina, prego installare PHP sul vostra macchina seguendo le istruzioni fornite dal PHP installazione programma.

3) Facoltativamente (fortemente consigliata per gli avanzati utenti, ma non è consigliata per i principianti o per gli inesperti), apri `config.ini` (situato della `vault`) – Questo file contiene tutte le direttive disponibili per phpMussel. Sopra ogni opzione dovrebbe essere un breve commento che descrive ciò che fa e ciò che è per. Regolare queste opzioni come meglio credi, come per ciò che è appropriato per la vostre particolare configurazione. Salvare il file, chiudere.

4) Facoltativamente, si può rendere utilizzando di phpMussel in modalità CLI facile per voi stessi per creando un batch file ai fini della automaticamente caricare PHP e phpMussel. Per fare questo, aprire un testo editor come Notepad o Notepad++, digitare il completo percorso della `php.exe` file nella cartella della vostra installazione di PHP, seguito da uno spazio, seguito dal completo percorso della `loader.php` file nella cartella della vostra installazione di phpMussel, salvare il file con un `.bat` estensione qualche parte che lo troverete facilmente, e fare doppio clic su tale file per eseguire phpMussel in futuro.

5) Installare tutte le firme necessarie. *Vedere: [INSTALLAZIONE DI FIRME](#INSTALLING_SIGNATURES).*

6) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare il lavoro svolto per assicurarsi che funzioni correttamente. Per testare phpMussel, eseguire phpMussel e prova scansionare la `_testfiles` cartella fornito con il pacchetto.

#### 2.2 INSTALLARE CON IL COMPOSER

[phpMussel è quotata a Packagist](https://packagist.org/packages/phpmussel/phpmussel), e così, se si ha familiarità con Composer, è possibile utilizzare Composer per l'installazione di phpMussel (è comunque necessario per preparare la configurazione e connessioni però; vedere "installazione manualmente (per web server)" passi 2 e 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 INSTALLAZIONE DI FIRME

Dal v1.0.0, le firme non sono incluse nel pacchetto phpMussel. Le firme sono richieste da phpMussel per rilevare minacce specifiche. Esistono 3 metodi principali per installare le firme:

1. Installare automaticamente utilizzando il front-end pagina degli aggiornamenti.
2. Genera firme usando "SigTool" e installa manualmente.
3. Scaricare le firme da "phpMussel/Signatures" e installare manualmente.

##### 2.3.1 Installare automaticamente utilizzando il front-end pagina degli aggiornamenti.

In primo luogo, è necessario assicurarsi che il front-end sia abilitato. *Vedere: [GESTIONE FRONT-END](#SECTION4).*

Allora, tutto quello che dovrai fare è andare a il front-end pagina degli aggiornamenti, trovare i file di firma necessari, e utilizzare le opzioni fornite nella pagina, installarle, e attivarle.

##### 2.3.2 Genera firme usando "SigTool" e installa manualmente.

*Vedere: [Documentazione SigTool](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Scaricare le firme da "phpMussel/Signatures" e installare manualmente.

In primo luogo, vai a [phpMussel/Signatures](https://github.com/phpMussel/Signatures). Il repository contiene vari file di firma compressi GZ. Scarica i file necessari, decomprimere e copiare i file decompressi nella cartella `/vault/signatures` per installarli. Elencare i nomi dei file copiati nella direttiva `Active` nella configurazione di phpMussel per attivarli.

---


### 3. <a name="SECTION3"></a>COME USARE

#### 3.0 COME USARE (PER WEB SERVER)

phpMussel dovrebbe essere in grado di funzionare correttamente con requisiti minimi da parte vostra: Dopo l'installazione, dovrebbe funzionare immediatamente ed essere immediatamente utilizzabile.

Scansionare di file caricamenti è automatizzato e abilitato per predefinita, perciò nulla è richiesto a vostro nome per questa particolare funzione.

Ma, si è anche in grado di istruire phpMussel per la scansione per i specifici file, cartelle o archivi. Per fare questo, in primo luogo, è necessario assicurarsi che l'appropriata configurazione è impostato nella `config.ini` file (`cleanup` deve essere disattivato), e quando fatto, in un PHP file che è collegato allo phpMussel, utilizzare la seguente funzione nelle codice:

`$phpMussel['Scan']($cosa_a_scansione, $tipi_di_output, $output_pianura);`

- `$cosa_a_scansione` può essere una stringa, un array o un array di array multipli, e indica quale d'il file, cartella e/o cartelle a scansiona.
- `$tipi_di_output` è un valore booleano, indicanti il formato per i risultati della scansione a essere restituire come. `false` istruisce la funzione a restituire i risultati come un intero. `true` istruisce la funzione a restituire i risultati come testo leggibile. In aggiunta, in ogni caso, i risultati sono accessibili tramite variabili globali dopo la scansione è stata completata. Questa variabile è facoltativa, inadempiente su `false`. Di seguito vengono descritti i risultati interi:

| Risultati | Descrizioni |
|---|---|
| -3 | Indica problemi sono stati incontrati con il phpMussel firme file o file di firme mappe e che possono essere possibile mancanti o corrotto. |
| -2 | Indica che i corrotto dato è stato rilevato durante la scansione e quindi la scansione non abbia completato. |
| -1 | Indica che estensioni o addon richiesti per PHP a eseguire la scansione erano assente e quindi la scansione non abbia completato. |
| 0 | Indica che l'obiettivo di scansione non esiste e quindi non c'era nulla a scansione. |
| 1 | Indica che l'obiettivo è stato scansionata correttamente e non problemi stati rilevati. |
| 2 | Indica che l'obiettivo è stato scansionata correttamente e problemi stati rilevati. |

- `$output_pianura` è un valore booleano, indicanti alla funzione se restituire i risultati della scansione (quando ci sono multipli obiettivi di scansione) come un array o una stringa. `false` restituirà i risultati come un array. `true` restituirà i risultati come una stringa. Questa variabile è facoltativa, inadempiente su `false`.

Esempi:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Restituisce qualcosa come (in forma di una stringa):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Iniziato.
 > Verifica '/user_name/public_html/my_file.html':
 -> Nessun problema rilevato.
 Wed, 16 Sep 2013 02:49:47 +0000 Finito.
```

Per una dettagliata spiegazione del tipo di firme di cui phpMussel usa durante le sue scansioni e come le sue gestisce queste firme, fare riferimento alla [FIRMA FORMATO](#SECTION8) sezione di questo file README.

Se si incontrano qualsiasi falsi positivi, se si incontrano qualcosa nuova che si pensa dovrebbe essere bloccato, o per qualsiasi altri scopi o materia a riguardo delle firme, si prega di contattare me a riguardo esso così che io possa apportare le necessarie modifiche, di cui, se si non contatto me, io non necessariamente essere consapevole ne. *(Vedere: [Che cosa è un "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)).*

Per disabilita firme incluso con phpMussel (come se stai sperimentando falsi positivi specifico alle vostri scopi di cui non dovrebbero normalmente essere rimosso dalla mainline), aggiungere i nomi delle firme specifiche da disabilitare al file greylist (`/vault/greylist.csv`), separati da virgole.

*Guarda anche: [Come accedere a dettagli specifici sui file quando vengono scansionati?](#SCAN_DEBUGGING)*

#### 3.1 COME USARE (PER CLI)

Si prega di fare riferimento alla "INSTALLAZIONE MANUALMENTE (PER CLI)" sezione di questo file README.

Anche essere consapevoli che phpMussel è uno scanner *on-demand* (cioè, su richiesta); *NON* è uno scanner *on-access* (cioè, in accesso; ad eccezione di caricamenti di file, al momento del caricamento), e diverso dai convenzionali anti-virus suite, non protegge la memoria attiva! Essa solo rileva virus contenuti dai caricamenti di file, e contenuti da quei file specifici che si esplicitamente dica per scansione.

---


### 4. <a name="SECTION4"></a>GESTIONE FRONT-END

#### 4.0 QUAL È IL FRONT-END.

Il front-end fornisce un modo conveniente e facile da mantenere, gestire e aggiornare l'installazione phpMussel. È possibile visualizzare, condividere e scaricare file di log attraverso la pagina di log, è possibile modificare la configurazione attraverso la pagina di configurazione, è possibile installare e disinstallare i componenti attraverso la pagina degli aggiornamenti, e si può caricare, scaricare e modificare i file nel vault tramite il file manager.

Il front-end è disabilitato per impostazione predefinita al fine di prevenire l'accesso non autorizzato (l'accesso non autorizzato potrebbe avere conseguenze significative per il vostro sito e la sua sicurezza). Istruzioni per l'abilitazione si sono compresi sotto di questo paragrafo.

#### 4.1 COME ATTIVARE IL FRONT-END.

1) Trova la direttiva `disable_frontend` dentro `config.ini`, e impostarlo su `false` (sarà `true` per impostazione predefinita).

2) Accedi `loader.php` dal browser (per esempio, `http://localhost/phpmussel/loader.php`).

3) Accedi con il nome utente e la password predefinita (admin/password).

Nota: Dopo aver effettuato l'accesso per la prima volta, al fine di impedire l'accesso non autorizzato al front-end, si dovrebbe cambiare immediatamente il nome utente e la password! Questo è molto importante, perché è possibile caricare codice PHP arbitrario al suo sito web attraverso il front-end.

#### 4.2 COME UTILIZZARE IL FRONT-END.

Le istruzioni sono fornite su ciascuna pagina del front-end, per spiegare il modo corretto di usarlo e la sua destinazione. Se avete bisogno di ulteriori spiegazioni o qualsiasi assistenza speciale, si prega di contattare il supporto. In alternativa, ci sono alcuni video disponibili su YouTube, che potrebbero aiutare per mezzo di dimostrazione.


---


### 5. <a name="SECTION5"></a>CLI (INTERFACCIA A RIGA DI COMANDO)

phpMussel può essere eseguito come uno interattivo file scanner in modalità CLI da Windows. Fare riferimento alla "COME INSTALLARE (PER CLI)" sezione di questo file README per maggiori dettagli.

Per un elenco di comandi disponibili all'interno CLI, al CLI prompt, tipo 'c', e premere Enter.

Inoltre, per chi fosse interessato, un video tutorial su come utilizzare phpMussel in modalità CLI è disponibile qui:
- <https://youtu.be/H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>FILE INCLUSI IN QUESTO PACCHETTO

Il seguente è un elenco di tutti i file che dovrebbero essere incluso nella archiviato copia di questo script quando si scaricalo, qualsiasi di file che potrebbero potenzialmente essere creato come risultato della vostra utilizzando questo script, insieme con una breve descrizione di ciò che tutti questi file sono per.

File | Descrizione
----|----
/_docs/ | Documentazione cartella (contiene vari file).
/_docs/readme.ar.md | Documentazione Arabo.
/_docs/readme.de.md | Documentazione Tedesco.
/_docs/readme.en.md | Documentazione Inglese.
/_docs/readme.es.md | Documentazione Spagnolo.
/_docs/readme.fr.md | Documentazione Francese.
/_docs/readme.id.md | Documentazione Indonesiano.
/_docs/readme.it.md | Documentazione Italiano.
/_docs/readme.ja.md | Documentazione Giapponese.
/_docs/readme.ko.md | Documentazione Coreana.
/_docs/readme.nl.md | Documentazione Olandese.
/_docs/readme.pt.md | Documentazione Portoghese.
/_docs/readme.ru.md | Documentazione Russo.
/_docs/readme.ur.md | Documentazione Urdu.
/_docs/readme.vi.md | Documentazione Vietnamita.
/_docs/readme.zh-TW.md | Documentazione Cinese (tradizionale).
/_docs/readme.zh.md | Documentazione Cinese (semplificato).
/_testfiles/ | Test file cartella (contiene vari file). Tutti i file contenuti sono test file per la verifica se phpMussel è installato correttamente sulla vostra sistema, e non è necessario a caricare questa cartella o qualsiasi dei suoi file, tranne quando fa tali test.
/_testfiles/ascii_standard_testfile.txt | Test file per test di phpMussel normalizzati ASCII firme.
/_testfiles/coex_testfile.rtf | Test file per test di phpMussel complesso esteso firme.
/_testfiles/exe_standard_testfile.exe | Test file per test di phpMussel PE firme.
/_testfiles/general_standard_testfile.txt | Test file per test di phpMussel generale firme.
/_testfiles/graphics_standard_testfile.gif | Test file per test di phpMussel grafica firme.
/_testfiles/html_standard_testfile.html | Test file per test di phpMussel normalizzati HTML firme.
/_testfiles/md5_testfile.txt | Test file per test di phpMussel MD5 firme.
/_testfiles/ole_testfile.ole | Test file per test di phpMussel OLE firme.
/_testfiles/pdf_standard_testfile.pdf | Test file per test di phpMussel PDF firme.
/_testfiles/pe_sectional_testfile.exe | Test file per test di phpMussel PE Sezionale firme.
/_testfiles/swf_standard_testfile.swf | Test file per test di phpMussel SWF firme.
/vault/ | La vault cartella (contiene vari file).
/vault/cache/ | La cartella della cache (per i dati temporanei).
/vault/cache/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/fe_assets/ | Dati front-end.
/vault/fe_assets/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/fe_assets/_accounts.html | Un modello HTML per il front-end pagina utenti.
/vault/fe_assets/_accounts_row.html | Un modello HTML per il front-end pagina utenti.
/vault/fe_assets/_cache.html | Un modello HTML per il front-end pagina di dati della cache.
/vault/fe_assets/_config.html | Un modello HTML per il front-end pagina di configurazione.
/vault/fe_assets/_config_row.html | Un modello HTML per il front-end pagina di configurazione.
/vault/fe_assets/_files.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_edit.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_rename.html | Un modello HTML per il file manager.
/vault/fe_assets/_files_row.html | Un modello HTML per il file manager.
/vault/fe_assets/_home.html | Un modello HTML per il front-end pagina principale.
/vault/fe_assets/_login.html | Un modello HTML per il front-end pagina di accedi.
/vault/fe_assets/_logs.html | Un modello HTML per il front-end pagina per i file di log.
/vault/fe_assets/_nav_complete_access.html | Un modello HTML per i link di navigazione del front-end, per quelli con accesso completo.
/vault/fe_assets/_nav_logs_access_only.html | Un modello HTML per i link di navigazione del front-end, per quelli con accesso solo per i log.
/vault/fe_assets/_quarantine.html | Un modello HTML per il front-end pagina della quarantena.
/vault/fe_assets/_quarantine_row.html | Un modello HTML per il front-end pagina della quarantena.
/vault/fe_assets/_statistics.html | Un modello HTML per il front-end pagina delle statistiche.
/vault/fe_assets/_updates.html | Un modello HTML per il front-end pagina degli aggiornamenti.
/vault/fe_assets/_updates_row.html | Un modello HTML per il front-end pagina degli aggiornamenti.
/vault/fe_assets/_upload_test.html | Un modello HTML per il carica testare.
/vault/fe_assets/frontend.css | Foglio di stile CSS per il front-end.
/vault/fe_assets/frontend.dat | Database per il front-end (contiene informazioni per i utenti e le sessioni; generato solo se il front-end è attivata e utilizzata).
/vault/fe_assets/frontend.html | Il file modello HTML principale per il front-end.
/vault/fe_assets/icons.php | Gestore dell'icone (utilizzata dal file manager del front-end).
/vault/fe_assets/pips.php | Gestore delle pips (utilizzata dal file manager del front-end).
/vault/fe_assets/scripts.js | Contiene dati JavaScript per il front-end.
/vault/lang/ | Contiene dati linguistici.
/vault/lang/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/lang/lang.ar.fe.php | Dati linguistici Araba per il front-end.
/vault/lang/lang.ar.php | Dati linguistici Araba.
/vault/lang/lang.bn.fe.php | Dati linguistici Bengalese per il front-end.
/vault/lang/lang.bn.php | Dati linguistici Bengalese.
/vault/lang/lang.de.fe.php | Dati linguistici Tedesca per il front-end.
/vault/lang/lang.de.php | Dati linguistici Tedesca.
/vault/lang/lang.en.fe.php | Dati linguistici Inglese per il front-end.
/vault/lang/lang.en.php | Dati linguistici Inglese.
/vault/lang/lang.es.fe.php | Dati linguistici Spagnola per il front-end.
/vault/lang/lang.es.php | Dati linguistici Spagnola.
/vault/lang/lang.fr.fe.php | Dati linguistici Francese per il front-end.
/vault/lang/lang.fr.php | Dati linguistici Francese.
/vault/lang/lang.hi.fe.php | Dati linguistici Hindi per il front-end.
/vault/lang/lang.hi.php | Dati linguistici Hindi.
/vault/lang/lang.id.fe.php | Dati linguistici Indonesiana per il front-end.
/vault/lang/lang.id.php | Dati linguistici Indonesiana.
/vault/lang/lang.it.fe.php | Dati linguistici Italiana per il front-end.
/vault/lang/lang.it.php | Dati linguistici Italiana.
/vault/lang/lang.ja.fe.php | Dati linguistici Giapponese per il front-end.
/vault/lang/lang.ja.php | Dati linguistici Giapponese.
/vault/lang/lang.ko.fe.php | Dati linguistici Coreana per il front-end.
/vault/lang/lang.ko.php | Dati linguistici Coreana.
/vault/lang/lang.nl.fe.php | Dati linguistici Olandese per il front-end.
/vault/lang/lang.nl.php | Dati linguistici Olandese.
/vault/lang/lang.pt.fe.php | Dati linguistici Portoghese per il front-end.
/vault/lang/lang.pt.php | Dati linguistici Portoghese.
/vault/lang/lang.ru.fe.php | Dati linguistici Russa per il front-end.
/vault/lang/lang.ru.php | Dati linguistici Russa.
/vault/lang/lang.th.fe.php | Dati linguistici Tailandese per il front-end.
/vault/lang/lang.th.php | Dati linguistici Tailandese.
/vault/lang/lang.tr.fe.php | Dati linguistici Turco per il front-end.
/vault/lang/lang.tr.php | Dati linguistici Turco.
/vault/lang/lang.ur.fe.php | Dati linguistici Urdu per il front-end.
/vault/lang/lang.ur.php | Dati linguistici Urdu.
/vault/lang/lang.vi.fe.php | Dati linguistici Vietnamita per il front-end.
/vault/lang/lang.vi.php | Dati linguistici Vietnamita.
/vault/lang/lang.zh-tw.fe.php | Dati linguistici Cinese (tradizionale) per il front-end.
/vault/lang/lang.zh-tw.php | Dati linguistici Cinese (tradizionale).
/vault/lang/lang.zh.fe.php | Dati linguistici Cinese (semplificata) per il front-end.
/vault/lang/lang.zh.php | Dati linguistici Cinese (semplificata).
/vault/quarantine/ | Quarantena cartella (contiene i file in quarantena).
/vault/quarantine/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/signatures/ | Firme cartella (contiene i file di firme).
/vault/signatures/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/signatures/switch.dat | Questo controlla e imposta alcune variabili.
/vault/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/.travis.php | Utilizzato da Travis CI per il test (non richiesto per il corretto funzionamento dello script).
/vault/.travis.yml | Utilizzato da Travis CI per il test (non richiesto per il corretto funzionamento dello script).
/vault/cli.php | Gestore di CLI.
/vault/components.dat | Contiene informazioni relative ai vari componenti di phpMussel; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/vault/config.ini.RenameMe | File di configurazione; Contiene tutte l'opzioni di configurazione per phpMussel, dicendogli cosa fare e come operare correttamente (rinomina per attivare).
/vault/config.php | Gestore di configurazione.
/vault/config.yaml | File di valori predefiniti per la configurazione; Contiene valori predefiniti per la configurazione di phpMussel.
/vault/frontend.php | Gestore del front-end.
/vault/frontend_functions.php | File di funzioni del front-end.
/vault/functions.php | File di funzioni.
/vault/greylist.csv | CSV di firme indicando per phpMussel cui firme dovrebbero essere ignorato (il file sarà ricreato automaticamente se è cancellato).
/vault/lang.php | Dati linguistici.
/vault/php5.4.x.php | Polyfills per PHP 5.4.X (necessaria per la retrocompatibilità di PHP 5.4.X; è sicuro di cancellare per le versioni più recenti di PHP).
※ /vault/scan_kills.txt | Un record di tutti i file bloccati/uccisi da phpMussel.
※ /vault/scan_log.txt | Un record di tutto scansionato da phpMussel.
※ /vault/scan_log_serialized.txt | Un record di tutto scansionato da phpMussel.
/vault/template_custom.html | Template file; Template per l'HTML output prodotto da phpMussel per il suo messaggio di bloccato file caricamento (il messaggio visto dallo caricatore).
/vault/template_default.html | Template file; Template per l'HTML output prodotto da phpMussel per il suo messaggio di bloccato file caricamento (il messaggio visto dallo caricatore).
/vault/themes.dat | File di temi; Utilizzato dalla funzionalità aggiornamenti forniti dal front-end.
/vault/upload.php | Gestore di caricamenti.
/.gitattributes | Un file del GitHub progetto (non richiesto per il corretto funzionamento dello script).
/.gitignore | Un file del GitHub progetto (non richiesto per il corretto funzionamento dello script).
/Changelog-v1.txt | Un record delle modifiche apportate allo script tra diverse versioni (non richiesto per il corretto funzionamento dello script).
/composer.json | Composer/Packagist informazioni (non richiesto per il corretto funzionamento dello script).
/CONTRIBUTING.md | Informazioni su come contribuire al progetto.
/LICENSE.txt | Una copia della GNU/GPLv2 licenza (non richiesto per il corretto funzionamento dello script).
/loader.php | Il caricatore. Questo è il file si collegare alla vostra sistema (essenziale)!
/PEOPLE.md | Informazioni sulle persone coinvolte nel progetto.
/README.md | Informazioni di riepilogo del progetto.
/web.config | Un ASP.NET file di configurazione (in questo caso, a proteggere la `/vault` cartella da l'acceso di non autorizzate origini nel caso che lo script è installato su un server basata su ASP.NET tecnologie).

※ Nome del file può variare dipendente di configurazione (in `config.ini`).

---


### 7. <a name="SECTION7"></a>OPZIONI DI CONFIGURAZIONE
Il seguente è un elenco di variabili trovate nelle `config.ini` file di configurazione di phpMussel, insieme con una descrizione del loro scopo e funzione.

#### "general" (Categoria)
Generale configurazione per phpMussel.

"cleanup"
- Disimpostare le script variabili e la cache dopo l'esecuzione? False = No; True = Sì [Predefinito]. Se si non utilizza lo script dopo l'iniziale scansione di caricamenti, dovrebbe impostato a `true` (sì), per minimizzare la memoria uso. Se si fa utilizza lo script dopo l'iniziale scansione di caricamenti, dovrebbe impostato a `false` (no), al fine per evitare ricaricare inutili duplicati dati all'interno memoria. In generale pratica, dovrebbe probabilmente essere impostata a `true` (sì), ma, se si farlo, voi sarà non in grado per utilizzare lo script per scopi diversi dalla scansione di caricamenti.
- Non ha alcuna influenza in modalità CLI.

"scan_log"
- Il nome del file per registrare tutti i risultati di la scansione. Specificare un nome del file, o lasciare vuoto per disattivarlo.

"scan_log_serialized"
- Il nome del file per registrare tutti i risultati di la scansione (utilizzando un formato serializzato). Specificare un nome del file, o lasciare vuoto per disattivarlo.

"scan_kills"
- Il nome del file per registrare tutti i record di bloccato o ucciso caricamenti. Specificare un nome del file, o lasciare vuoto per disattivarlo.

*Consiglio utile: Se vuoi, è possibile aggiungere data/ora informazioni per i nomi dei file per la registrazione par includendo queste nel nome: `{yyyy}` per l'anno completo, `{yy}` per l'anno abbreviato, `{mm}` per mese, `{dd}` per giorno, `{hh}` per ora.*

*Esempi:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Troncare i file di log quando raggiungono una determinata dimensione? Il valore è la dimensione massima in B/KB/MB/GB/TB che un file di log può crescere prima di essere troncato. Il valore predefinito di 0KB disattiva il troncamento (i file di log possono crescere indefinitamente). Nota: Si applica ai singoli file di log! La dimensione dei file di log non viene considerata collettivamente.

"log_rotation_limit"
- La rotazione dei log limita il numero di file di log che dovrebbero esistere in qualsiasi momento. Quando vengono creati nuovi file di log, se il numero totale di file di log supera il limite specificato, verrà eseguita l'azione specificata. Qui puoi specificare il limite desiderato. Un valore di 0 disabiliterà la rotazione dei log.

"log_rotation_action"
- La rotazione dei log limita il numero di file di log che dovrebbero esistere in qualsiasi momento. Quando vengono creati nuovi file di log, se il numero totale di file di log supera il limite specificato, verrà eseguita l'azione specificata. Qui puoi specificare l'azione desiderato. Delete = Elimina i file di log più vecchi, finché il limite non viene più superato. Archive = In primo luogo archiviare e quindi, eliminare i file di log più vecchi, finché il limite non viene più superato.

*Chiarimento tecnico: In questo contesto, "più vecchi" significa modificato meno di recente.*

"timeOffset"
- Se il tempo del server non corrisponde l'ora locale, è possibile specificare un offset qui per regolare le informazioni di data/tempo generato da phpMussel in base alle proprie esigenze. È generalmente raccomandato invece, regolare à la direttiva fuso orario nel file `php.ini`, ma a volte (come ad esempio quando si lavora con i fornitori di hosting condiviso limitati) questo non è sempre possibile fare, e così, questa opzione è fornito qui. Offset è in minuti.
- Esempio (per aggiungere un'ora): `timeOffset=60`

"timeFormat"
- Il formato della data/ora di notazione usata da phpMussel. Predefinito = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Dove trovare l'indirizzo IP di collegamento richiesta? (Utile per servizi come Cloudflare e simili) Predefinito = REMOTE_ADDR. AVVISO: Non modificare questa se non sai quello che stai facendo!

"enable_plugins"
- Attiva il supporto per i plugin di phpMussel? False = No; True = Sì [Predefinito].

"forbid_on_block"
- phpMussel dovrebbe rispondere con 403 header con il file caricamente bloccato messaggio, o rimanere con il solito 200 OK? False = No (200); True = Sì (403) [Predefinito].

"delete_on_sight"
- Abilitando questa opzione sarà istruirà lo script per tentare immediatamente eliminare qualsiasi file trovato durante scansioni che corrisponde a qualsiasi i criteri di rilevazione, attraverso le firme o altrimenti. I file determinati ad essere "pulito" non verranno toccati. Nel caso degli archivi, l'intero archivio verrà eliminato (indipendentemente se il file all'origine è soltanto uno dei vari file contenuti all'interno dell'archivio o non). Nel caso di file caricamente scansione, solitamente, non è necessario attivare questa opzione, perché solitamente, PHP sarà automaticamente eliminerà il contenuto della cache quando l'esecuzione è terminata, il che significa che lo farà solitamente eliminare tutti i file caricati tramite al server tranne ciò che già è spostato, copiato o cancellato. L'opzione viene aggiunto qui come ulteriore misura di sicurezza per coloro le cui copie di PHP non sempre comportarsi nel previsto modo. False = Dopo la scansione, lasciare il file solo [Predefinito]; True = Dopo la scansione, se non pulite, immediatamente eliminarlo.

"lang"
- Specifica la lingua predefinita per phpMussel.

"numbers"
- Specifica come visualizzare i numeri.

"quarantine_key"
- phpMussel è capace di mettere in quarantena contrassegnati tentati file caricamenti in isolamento all'interno della phpMussel vault, se questo è qualcosa che si vuole fare. L'ordinario utenti di phpMussel che semplicemente desiderano proteggere i loro website o hosting environment senza avendo profondo interesse ad analizzare qualsiasi contrassegnati tentati file caricamenti dovrebbe lasciare questa funzionalità disattivata, ma tutti gli utenti interessati ad ulteriori analisi di contrassegnati tentati file caricamenti per la ricerca di malware o per simili cose dovrebbe attivare questa funzionalità. Quarantena di contrassegnati tentati file caricamenti a volte può aiutare anche in debug falsi positivi, se questo è qualcosa che si accade di frequente per voi. Per disattivare la funzionalità di quarantena, lasciare vuota la direttiva `quarantine_key`, o cancellare i contenuti di tale direttiva, se non già è vuoto. Per abilita la funzionalità di quarantena, immettere alcun valore nella direttiva. Il `quarantine_key` è un importante aspetto di sicurezza della funzionalità di quarantena richiesto come un mezzo per prevenire la funzionalità di quarantena di essere sfruttati da potenziali aggressori e come mezzo per prevenire potenziale esecuzione di dati memorizzati all'interno della quarantena. Il `quarantine_key` dovrebbe essere trattato nello stesso modo come le password: Più lunga è la migliore, e proteggila ermeticamente. Per la migliore effetto, utilizzare in combinazione con `delete_on_sight`.

"quarantine_max_filesize"
- La massima permesso dimensione del file dei file essere quarantena. File di dimensioni superiori a questo valore NON verranno quarantena. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la vostra quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul vostro servizio di hosting. Predefinito = 2MB.

"quarantine_max_usage"
- La massima permesso utilizzo della memoria per la quarantena. Se la totale memoria utilizzata dalla quarantena raggiunge questo valore, i più vecchi file in quarantena vengono eliminati fino a quando la totale memoria utilizzata non raggiunge questo valore. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la tua quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul vostro servizio di hosting. Predefinito = 64MB.

"honeypot_mode"
- Quando la honeypot modalità è abilitata, phpMussel tenterà di mettere in quarantena ogni file caricamenti che esso incontra, indipendentemente di se il file che essere caricato corrisponde d'alcuna incluso firma, e zero reale scansionare o analisi di quei tentati file caricati sarà avvenire. Questa funzionalità dovrebbe essere utile per coloro che desiderano utilizzare phpMussel a fini di virus/malware ricerca, ma non si raccomandato di abilitare questa funzionalità se l'uso previsto de phpMussel da parte dell'utente è per l'effettivo scansione dei file caricamenti né raccomandato di utilizzare la funzionalità di honeypot per fini diversi da l'uso de honeypot. Da predefinita, questo opzione è disattivato. False = Disattivato [Predefinito]; True = Attivato.

"scan_cache_expiry"
- Per quanto tempo deve phpMussel cache i risultati della scansione? Il valore è il numero di secondi per memorizzare nella cache i risultati della scansione per. Predefinito valore è 21600 secondi (6 ore); Un valore pari a 0 disabilita il caching dei risultati di scansione.

"disable_cli"
- Disabilita CLI? Modalità CLI è abilitato per predefinito, ma a volte può interferire con alcuni strumenti di test (come PHPUnit, per esempio) e altre applicazioni basate su CLI. Se non è necessario disattivare la modalità CLI, si dovrebbe ignorare questa direttiva. False = Abilita CLI [Predefinito]; True = Disabilita CLI.

"disable_frontend"
- Disabilita l'accesso front-end? L'accesso front-end può rendere phpMussel più gestibile, ma può anche essere un potenziale rischio per la sicurezza. Si consiglia di gestire phpMussel attraverso il back-end, quando possibile, ma l'accesso front-end è previsto per quando non è possibile. Mantenerlo disabilitato tranne se hai bisogno. False = Abilita l'accesso front-end; True = Disabilita l'accesso front-end [Predefinito].

"max_login_attempts"
- Numero massimo di tentativi di accesso (front-end). Predefinito = 5.

"FrontEndLog"
- File per la registrazione di l'accesso front-end tentativi di accesso. Specificare un nome di file, o lasciare vuoto per disabilitare.

"disable_webfonts"
- Disabilita webfonts? True = Sì [Predefinito]; False = No.

"maintenance_mode"
- Abilita la modalità di manutenzione? True = Sì; False = No [Predefinito]. Disattiva tutto tranne il front-end. A volte utile per l'aggiornamento del CMS, dei framework, ecc.

"default_algo"
- Definisce quale algoritmo da utilizzare per tutte le password e le sessioni in futuro. Opzioni: PASSWORD_DEFAULT (predefinito), PASSWORD_BCRYPT, PASSWORD_ARGON2I (richiede PHP >= 7.2.0).

"statistics"
- Monitorare le statistiche di utilizzo di phpMussel? True = Sì; False = No [Predefinito].

"allow_symlinks"
- A volte phpMussel non è in grado di accedere direttamente a un file quando viene chiamato in un certo modo. L'accesso al file indirettamente tramite symlink a volte può risolvere questo problema. Tuttavia, questa non è sempre una soluzione praticabile, perché su alcuni sistemi, l'utilizzo di symlink potrebbe essere vietato, o potrebbe richiedere privilegi amministrativi. Questa direttiva viene utilizzata per determinare se phpMussel dovrebbe tentare di utilizzare i symlink per accedere ai file indirettamente, quando non è possibile accedervi direttamente. True = Abilita i symlink; False = Disabilita i symlink [Predefinito].

#### "signatures" (Categoria)
Configurazione per firme.

"Active"
- Un elenco dei file di firme attivi, delimitati da virgole.

"fail_silently"
- Dovrebbe phpMussel rapporto quando le file di firme sono mancanti o danneggiati? Se `fail_silently` è disattivato, mancanti e danneggiati file saranno riportato sulla scansione, e se `fail_silently` è abilitato, mancanti e danneggiati file saranno ignorato, con scansione riportando per quei file che non ha sono problemi. Questo dovrebbe essere generalmente lasciata sola a meno che sperimentando inaspettate terminazioni o simili problemi. False = Disattivato; True = Attivato [Predefinito].

"fail_extensions_silently"
- Dovrebbe phpMussel rapporto quando le estensioni sono mancanti? Se `fail_extensions_silently` è disattivato, mancanti estensioni saranno riportato sulla scansione, e se `fail_extensions_silently` è abilitato, mancanti estensioni saranno ignorato, con scansione riportando per quei file che non ha sono problemi. La disattivazione di questa direttiva potrebbe potenzialmente aumentare la sicurezza, ma può anche portare ad un aumento di falsi positivi. False = Disattivato; True = Attivato [Predefinito].

"detect_adware"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di adware? False = No; True = Sì [Predefinito].

"detect_encryption"
- Dovrebbe phpMussel rilevare e bloccare i file crittografati? False = No; True = Sì [Predefinito].

"detect_joke_hoax"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di scherzo/inganno malware/virus? False = No; True = Sì [Predefinito].

"detect_pua_pup"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di PUAs/PUPs? False = No; True = Sì [Predefinito].

"detect_packer_packed"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di confezionatori e dati confezionati? False = No; True = Sì [Predefinito].

"detect_shell"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di shell script? False = No; True = Sì [Predefinito].

"detect_deface"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di sfiguramenti e sfiguratori? False = No; True = Sì [Predefinito].

#### "files" (Categoria)
Generale configurazione per la gestione dei file.

"max_uploads"
- Massimo numero di file per analizzare durante il file caricamenti scansione prima le terminazione del scansione e d'informare dell'utente che essi stai caricando troppo in una volta! Fornisce protezione contro un teorico attacco per cui un malintenzionato utente tenta per DDoS vostra sistema o CMS da sovraccaricamento phpMussel rallentare il PHP processo ad un brusco stop. Raccomandato: 10. Si potrebbe desiderare di aumentare o diminuire che numero basato sulla velocità del vostra sistema e hardware. Si noti che questo numero non tiene conto o includere il contenuti degli archivi.

"filesize_limit"
- File dimensione limite in KB. 65536 = 64MB [Predefinito]; 0 = Nessun limite (sempre sul greylist), qualsiasi (positivo) numerico valore accettato. Questo può essere utile quando la configurazione di PHP limita la quantità di memoria che un processo può contenere o se i configurazione ha limitato la dimensione dei file caricamenti.

"filesize_response"
- Cosa fare con i file che superano il file dimensione limite (se esistente). False = Whitelist; True = Blacklist [Predefinito].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Se il vostro sistema permette solo determinati tipi di file per caricamenti, o se il vostra sistema esplicitamente negare determinati tipi di file, specificando i tipi di file nel whitelist, blacklist e/o greylist può aumentare la velocità a cui la scansione viene eseguita da permettendo lo script da ignora alcuni tipi di file. Il formato è CSV (valori separati da virgola). Se si desidera eseguire la scansione tutti, invece del whitelist, el blacklist o el greylist, lasciare le variabili vuoti; Fare questo sarà disabilitali.
- Logico ordine del trattamento è:
  - Se il tipo di file è nel whitelist, non scansiona e non blocca il file, e non verificare il file contra la blacklist o la greylist.
  - Se il tipo di file è nel blacklist, non scansiona il file ma bloccarlo comunque, e non verificar il file contra la greylist.
  - Se il greylist è vuoto o se il greylist non è vuota e il tipo di file è nel greylist, scansiona il file come per normale e determinare se bloccarlo sulla base dei risultati della scansione, ma se il greylist non è vuoto e il tipo di file non è nel greylist, trattare il file come se è nel blacklist, quindi non scansionarlo ma bloccarlo comunque.

"check_archives"
- Tenta per verifica il contenuti degli archivi? False = No (no verifica); True = Sì (fare verifica) [Predefinito].
- Al momento, gli unici formati di archiviazione e compressione supportati sono BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR e ZIP (formati di archiviazione e compressione RAR, CAB, 7z e eccetera non sono supportate al momento).
- Questo non è infallibile! Mentre mi assai raccomando che è attivato, non posso garantire che sarà sempre trovare tutto.
- Anche essere consapevoli che verifica per archivio al momento è non ricorsiva per PHAR o ZIP formati.

"filesize_archives"
- Eredita file dimensione limite blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].

"filetype_archives"
- Eredita file tipi blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].

"max_recursion"
- Massimo ricorsione profondità limite per gli archivi. Predefinito = 10.

"block_encrypted_archives"
- Rilevi e blocchi archivi criptati? Perché phpMussel non è in grado di verifica del contenuto degli archivi criptati, è possibile che la archivi criptati può essere usato da un attaccante verifieracome mezzo di tenta di bypassare phpMussel, verificatore anti-virus e altri tali protezioni. Istruire phpMussel di bloccare qualsiasi archivi criptati che si trovato potrebbe potenzialmente contribuire a ridurre il rischio associato a questi tali possibilità. False = No; True = Sì [Predefinito].

#### "attack_specific" (Categoria)
Configurazione per specifiche attacco rilevazioni.

Chameleon attacco rilevamento: False = Disattivato; True = Attivato.

"chameleon_from_php"
- Cercare per PHP magici numeri che non sono riconosciuti PHP file né archivi.

"chameleon_from_exe"
- Cercare per eseguibili magici numeri che non sono riconosciuti eseguibili né archivi e per eseguibili cui non sono corrette.

"chameleon_to_archive"
- Cercare per archivi di cui non sono corrette (Supportato: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Cercare per office documenti di cui non sono corrette (Supportato: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Cercare per immagini file di cui non sono corrette (Supportato: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Cercare per PDF file di cui non sono corrette.

"archive_file_extensions"
- Riconosciute archivio file estensioni (formato è CSV; deve solo aggiungere o rimuovere quando problemi apparire; rimozione inutilmente può causare falsi positivi per archivio file, mentre aggiungendo inutilmente saranno essenzialmente whitelist quello che si sta aggiungendo dall'attacco specifico rilevamento; modificare con cautela; anche notare che questo non ha qualsiasi effetto su cui gli archivi possono e non possono essere analizzati dal contenuti livello). La lista, come da predefinito, è i formati utilizzati più comunemente attraverso la maggior parte dei sistemi e CMS, ma apposta non è necessariamente completo.

"block_control_characters"
- Bloccare tutti i file contenenti i controlli caratteri (eccetto per nuove linee)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Se si sta caricando solo normale testo, quindi si puó attivare questa opzione a fornire additionale protezione al vostro sistema. Ma, se si carica qualcosa di diverso da normale testo, abilitando questo opzione può causare falsi positivi. False = Non bloccare [Predefinito]; True = Bloccare.

"corrupted_exe"
- Corrotto file e parsare errori. False = Ignorarli; True = Bloccarli [Predefinito]. Rilevare e bloccare i potenzialmente corrotti PE (portatile eseguibili) file? Spesso (ma non sempre), quando alcuni aspetti di un PE file sono corrotto o non può essere parsato correttamente, tale può essere indicativo di una virale infezione. I processi utilizzati dalla maggior parte dei antivirus programmi per rilevare i virus all'intero PE file richiedono parsare quei file in certi modi, di cui, se il programmatore di un virus è consapevole di, sarà specificamente provare di prevenire, al fine di abilita loro virus di rimanere inosservato.

"decode_threshold"
- Soglia per la lunghezza dei grezzi dati dove decodificare comandi dovrebbe essere rilevati (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Predefinito = 512KB. Un zero o un nullo valore disabilita la soglia (rimuovere tale limitazione basata sulla dimensione dei file).

"scannable_threshold"
- Soglia per la lunghezza dei dati grezzi dove phpMussel è permesso di leggere e scansione (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Predefinito = 32MB. Un zero o un nullo valore disabilita la soglia. In generale, questo valore non dovrebbe essere meno quella media dimensione dei file che si desidera e si aspettano di ricevere al vostro server o al vostro web sito, non dovrebbe essere più di la filesize_limit direttiva, e non dovrebbe essere più di circa un quinto del totale ammissibile allocazione della memoria concesso al PHP tramite il file di configurazione `php.ini`. Questa direttiva esiste per tenta di evitare avendo phpMussel utilizzare troppa memoria (di cui sarebbe impedirebbe di essere capace di completare la file scansione correttamente per i file piú d'una certa dimensione).

#### "compatibility" (Categoria)
Compatibilità direttive per phpMussel.

"ignore_upload_errors"
- Questa direttiva dovrebbe generalmente essere SPENTO meno se necessario per la corretta funzionalità del phpMussel sul vostra sistema. Normalmente, quando spento, quando phpMussel rileva la presenza di elementi nella `$_FILES` array(), è tenterà di avviare una scansione dei file che tali elementi rappresentano, e, se tali elementi sono vuoti, phpMussel restituirà un errore messaggio. Questo è un comportamento adeguato per phpMussel. Tuttavia, per alcuni CMS, vuoti elementi nel `$_FILES` può avvenire come conseguenza del naturale comportamento di questi CMS, o errori possono essere segnalati quando non ce ne sono, nel qual caso, il normale comportamento per phpMussel sarà interferire con il normale comportamento di questi CMS. Se una tale situazione avvenire per voi, attivazione di questa opzione SU sarà istruirà phpMussel a non tenta avviare scansioni per tali vuoti elementi, ignorarli quando si trova ea non ritorno qualsiasi errore correlato messaggi, così permettendo proseguimento della pagina richiesta. False = SPENTO/OFF; True = SU/ON.

"only_allow_images"
- Se vi aspettare o intendere solo di permettere le immagini da caricare al vostro sistema o CMS, e se assolutamente non richiedono qualsiasi file diversi da immagini essere caricare per il vostro sistema o CMS, questa direttiva dovrebbe essere SU, ma dovrebbe altrimenti essere SPENTO. Se questa direttiva è SU, che istruirà phpMussel di indiscriminatamente bloccare tutti i caricati file identificati come file non-immagine, senza scansionali. Questo può ridurre il tempo di processo e l'utilizzo della memoria per tentati caricamenti di non-immagine file. False = SPENTO/OFF; True = SU/ON.

#### "heuristic" (Categoria)
Euristici direttive per phpMussel.

"threshold"
- Ci sono particolare firme di phpMussel che sono destinato a identificare sospetti e potenzialmente maligno qualità dei file che vengono essere caricati senza in sé identificando i file che vengono essere caricati in particolare ad essere maligno. Questo "threshold" (soglia) valore dice phpMussel cosa che il totale massimo peso di sospetti e potenzialmente maligno qualità dei file che vengono essere caricati che è ammissibile è prima che quei file devono essere contrassegnati come maligno. La definizione di peso in questo contesto è il totale numero di sospetti e potenzialmente maligno qualità identificato. Per predefinito, questo valore viene impostato su 3. Un inferiore valore generalmente sarà risultare di una maggiore presenza di falsi positivi ma una maggior numero di file essere contrassegnato come maligno, mentre una maggiore valore generalmente sarà risultare di un inferiore presenza di falsi positivi ma un inferiore numero di file essere contrassegnato come maligno. È generalmente meglio di lasciare questo valore a suo predefinito a meno che si incontrare problemi ad esso correlati.

#### "virustotal" (Categoria)
Configurazione per Virus Total integrazione.

"vt_public_api_key"
- Facoltativamente, phpMussel è in grado di scansionare dei file utilizzando il Virus Total API come un modo per fornire un notevolmente migliorato livello di protezione contro virus, trojan, malware e altre minacce. Per predefinita, la scansionare dei file utilizzando il Virus Total API è disattivato. Per abilitarlo, una API chiave da Virus Total è richiesta. A causa del significativo vantaggio che questo potrebbe fornire a voi, è qualcosa che consiglio vivamente di attivare. Tuttavia, si prega di notare che per utilizzare il Virus Total API, è necessario d'accettare i Termini di Servizio (Terms of Service) e rispettare tutte le orientamenti descritto nella documentazione di Virus Total! Tu NON sei autorizzato a utilizzare questa funzionalità TRANNE SE:
  - Hai letto e accettato i Termini di Servizio (Terms of Service) di Virus Total e le sue API. I Termini di Servizio di Virus Total e le sue API può essere trovato [Qui](https://www.virustotal.com/en/about/terms-of-service/).
  - Hai letto e si capisce, come minimo, il preambolo del Virus Total Pubblica API documentazione (tutto dopo "VirusTotal Public API v2.0" ma prima "Contents"). La Virus Total Pubblica API documentazione può essere trovato [Qui](https://www.virustotal.com/en/documentation/public-api/).

Notare: Se scansionare dei file utilizzando il Virus Total API è disattivato, non avrete bisogno di rivedere qualsiasi delle direttive in questa categoria (`virustotal`), perché nessuno di loro farà una cosa se questo è disattivato. Per acquisire un Virus Total API chiave, dal ovunque sul loro website, clicca il "Join our Community" link situato in alto destra della pagina, immettere le informazioni richieste, e clicca "Sign up" quando hai finito. Seguite tutte le istruzioni fornite, e quando hai la tua pubblica API chiave, copia/incolla la pubblica API chiave per la `vt_public_api_key` direttiva del file di configurazione `config.ini`.

"vt_suspicion_level"
- Per predefinita, phpMussel limiterà quali file ciò scansiona utilizzando il Virus Total API ai quei file che considera "sospettose". Facoltativamente, è possibile modificare questa restrizione per mezzo di modificando il valore del `vt_suspicion_level` direttiva.
- `0`: File vengono solo considerati sospetti se, dopo essere sottoposto a scansione da phpMussel utilizzando i propri firme, essi sono considerati avere un peso euristica. Questo potrebbe effettivamente indicare che l'uso del Virus Total API sarebbe per un secondo parere per quando phpMussel sospetta che un file può essere potenzialmente maligno, ma non può escludere del possibilità che essa può essere benigno (non maligno) e quindi sarebbe altrimenti non normalmente bloccarlo o segnalarlo come maligno.
- `1`: File vengono considerati sospetti se, dopo essere sottoposto a scansione da phpMussel utilizzando i propri firme, essi sono considerati avere un peso euristica, se sono noti per essere eseguibile (PE file, Mach-O file, ELF/Linux file, ecc), o se sono noti per essere di un formato che potrebbe contenere dati eseguibile (come le macro eseguibili, DOC/DOCX file, archivio file come RAR, ZIP ed ecc). Questa è l'impostazione predefinita e il livello di sospetto consigliato di applicare, indicando effettivamente che l'uso del Virus Total API sarebbe per un secondo parere per quando phpMussel inizialmente non trova nulla maligno o sbagliato in un file che ritiene di essere sospettosi e quindi sarebbe altrimenti non normalmente bloccarlo o segnalarlo come maligno.
- `2`: Tutti i file vengono considerati sospetti e devono essere sottoposti a scansione utilizzando il Virus Total API. Generalmente, io non raccomando di applicarla questo livello di sospetti, a causa del rischio di raggiungere il vostro API quota molto più rapidamente di quanto sarebbe altrimenti essere il caso, ma ci sono certe circostanze (ad esempio quando il webmaster o hostmaster ha molto poca fede o fiducia in qualsiasi contenuto caricato dei loro utenti) per cui questo livello di sospetto potrebbe essere appropriato. Con questo livello di sospetto, tutti i file normalmente non bloccato o contrassegnato come maligno sarebbero sottoposti a scansione utilizzando il Virus Total API. Notare, tuttavia, che phpMussel cesserà utilizzando la Virus Total API quando il vostro API quota è raggiunto (indipendentemente dal livello di sospetto), e che la quota sarà probabilmente essere raggiunto molto più velocemente quando utilizzando questo livello di sospetto.

Notare: Indipendentemente dal livello di sospetto, qualsiasi file che sono nella blacklist o nella whitelist per mezzo di phpMussel non verrà soggetta di scansione utilizzando il Virus Total API, perché quelle tali file sarebbero hai già stati dichiarati come maligno o benigno per phpMussel per il momento in cui avrebbero altrimenti hai stati scansionati dal Virus Total API, e quindi, scansionare supplementare non sarebbe necessaria. La capacità di phpMussel a scansioni file utilizzando il Virus Total API è destinato a sviluppare fiducia ulteriormente per se un file è maligno o benigno in quelle circostanze in cui phpMussel sé non è interamente certo se un file è maligno o benigno.

"vt_weighting"
- Dovrebbe phpMussel applica i risultati della scansione utilizzando il Virus Total API come rilevamenti o il ponderazione rilevamenti? Questa direttiva esiste, perché, sebbene scansione di un file utilizzando più motori (come Virus Total fa) dovrebbe risulta in un maggiore tasso di rilevamenti (e quindi in un maggiore numero di maligni file essere catturati), può anche risulta in un maggiore numero di falsi positivi, e quindi, in certe circostanze, i risultati della scansione possono essere meglio utilizzato come un punteggio di confidenza anziché come una conclusione definitiva. Se viene utilizzato un valore di 0, i risultati della scansione utilizzando il Virus Total API saranno applicati come rilevamenti, e quindi, se qualsiasi motori utilizzati da Virus Total che marca il file sottoposto a scansione come maligno, phpMussel considererà il file come maligno. Se qualsiasi altro valore è utilizzato, i risultati della scansione utilizzando il Virus Total API saranno applicati come ponderazione rilevamenti, e quindi, il numero di motori utilizzati da Virus Total marcando il file sottoposto a scansione come maligno servirà come un punteggio di confidenza (o ponderazione rilevamenti) per se il file sottoposto a scansione deve essere considerato maligno per phpMussel (il valore utilizzato rappresenterà il minimo punteggio di confidenza o ponderazione richiesto per essere considerato maligno). Un valore di 0 è utilizzato per predefinita.

"vt_quota_rate" e "vt_quota_time"
- Secondo a la Virus Total API documentazione, è limitato a un massimo di 4 richieste di qualsiasi natura in un dato 1 minuto tempo periodo. Se tu esegue una honeyclient, honeypot o qualsiasi altro automazione che sta fornire risorse a VirusTotal e non solo recuperare rapporti si ha diritto a un più alto tasso di richiesta quota. Per predefinita, phpMussel rigorosamente rispetti questi limiti, ma a causa della possibilità di tali tassi quote essere aumentati, questi due direttivi sono forniti come un mezzo per voi per istruire phpMussel da quale limite si deve rispettare. A meno che sei stato richiesto di farlo, non è raccomandato per voi per aumentare questi valori, ma, se hai incontrati problemi relativi a raggiungere il vostro tasso quota, diminuendo questi valori _**POTREBBE**_ a volte aiutare nel lavoro attraverso questi problemi. Il vostro tasso limite è determinato come `vt_quota_rate` richieste di qualsiasi natura in un dato `vt_quota_time` minuto tempo periodo.

#### "urlscanner" (Categoria)
Uno scanner URL è incluso in phpMussel, in grado di rilevare URL malevoli all'interno di dati ei file scansionati.

Notare: Se l'URL scanner è disabilitato, non sarà necessario rivedere nessuna delle direttive in questa categoria (`urlscanner`), perché nessuno di loro farà nulla se questo è disabilitato.

API configurazione per l'URL scanner.

"lookup_hphosts"
- Abilita API richieste per l'API di [hpHosts](http://hosts-file.net/) quando impostato su true. hpHosts non richiede un API chiave per l'esecuzione di API richieste.

"google_api_key"
- Abilita API richieste per l'API di Google Safe Browsing quando le API chiave necessarie è definito. L'API di Google Safe Browsing richiede un API chiave, che può essere ottenuto da [Qui](https://console.developers.google.com/).
- Notare: L'estensione cURL è necessaria al fine di utilizzare questa funzione.

"maximum_api_lookups"
- Numero massimo di richieste per l'API di eseguire per iterazione di scansione individuo. Perché ogni richiesta supplementare per l'API farà aggiungere al tempo totale necessario per completare ogni iterazione di scansione, si potrebbe desiderare di stipulare una limitazione al fine di accelerare il processo di scansione. Quando è impostato su 0, no tale ammissibile numero massimo sarà applicata. Impostato su 10 per impostazione predefinite.

"maximum_api_lookups_response"
- Cosa fare se il ammissibile numero massimo di richieste per l'API è superato? False = Fare nulla (continuare il processo) [Predefinito]; True = Segnare/bloccare il file.

"cache_time"
- Per quanto tempo (in secondi) dovrebbe i risultati delle API richieste essere memorizzati nella cache per? Predefinito è 3600 secondi (1 ora).

#### "legal" (Categoria)
Configurazione relativa ai requisiti legali.

*Per ulteriori informazioni sui requisiti legali e su come ciò potrebbe influire sui requisiti di configurazione, si prega di fare riferimento alla sezione "[INFORMAZIONE LEGALE](#SECTION11)" della documentazione.*

"pseudonymise_ip_addresses"
- Pseudonimizzare gli indirizzi IP durante la scrivono i file di registro? True = Sì; False = No [Predefinito].

"privacy_policy"
- L'indirizzo di una politica sulla privacy pertinente da visualizzare nel piè di pagina delle pagine generate. Specificare un URL, o lasciare vuoto per disabilitare.

#### "template_data" (Categoria)
Direttive/Variabili per modelli e temi.

Modelli dati riferisce alla prodotti HTML utilizzato per generare il "Caricamento Negato" messaggio visualizzati agli utenti quando file caricamenti sono bloccati. Se stai usando temi personalizzati per phpMussel, prodotti HTML è provenienti da file `template_custom.html`, e altrimenti, prodotti HTML è provenienti da file `template.html`. Variabili scritte a questa sezione del file di configurazione sono parsato per il prodotti HTML per mezzo di sostituendo tutti i nomi di variabili circondati da parentesi graffe trovato all'interno il prodotti HTML con la corrispondente dati di quelli variabili. Per esempio, dove `foo="bar"`, qualsiasi istanza di `<p>{foo}</p>` trovato all'interno il prodotti HTML diventerà `<p>bar</p>`.

"theme"
- Tema predefinito da utilizzare per phpMussel.

"Magnification"
- Ingrandimento del carattere. Predefinito = 1.

"css_url"
- Il modello file per i temi personalizzati utilizzi esterni CSS proprietà, mentre il modello file per i temi personalizzati utilizzi interni CSS proprietà. Per istruire phpMussel di utilizzare il modello file per i temi personalizzati, specificare l'indirizzo pubblico HTTP dei CSS file dei suoi tema personalizzato utilizzando la variabile `css_url`. Se si lascia questo variabile come vuoto, phpMussel utilizzerà il modello file per il predefinito tema.

---


### 8. <a name="SECTION8"></a>FIRMA FORMATO

*Guarda anche:*
- *[Che cosa è una "firma"?](#WHAT_IS_A_SIGNATURE)*

I primi 9 byte `[x0-x8]` di un file di firma per phpMussel sono `phpMussel`, e agire come un "numero magico" (magic number), per identificarli come file di firma (questo aiuta a impedire phpMussel di tentare accidentalmente di utilizzare file che non sono file di firma). Il byte successivo `[x9]` identifica il tipo di file di firma, che phpMussel deve conoscere per poter interpretare correttamente il file di firma. Sono riconosciuti i seguenti tipi di file di firma:

Tipo | Byte | Descrizione
---|---|---
`General_Command_Detections` | `0?` | Per i file di firma CSV (valori separati da virgole). I valori (firme) sono stringhe esadecimali codificate per cercare all'interno di file. Le firme qui non hanno nomi o altri dettagli (solo la stringa da rilevare).
`Filename` | `1?` | Per le firme dei nomi di file.
`Hash` | `2?` | Per firme di hash.
`Standard` | `3?` | Per i file di firma che lavorano direttamente con il contenuto del file.
`Standard_RegEx` | `4?` | Per i file di firma che lavorano direttamente con il contenuto del file. Le firme possono contenere espressioni regolari.
`Normalised` | `5?` | Per i file di firma che funzionano con il contenuto di file normalizzato a ANSI.
`Normalised_RegEx` | `6?` | Per i file di firma che funzionano con il contenuto di file normalizzato a ANSI. Le firme possono contenere espressioni regolari.
`HTML` | `7?` | Per i file di firma che funzionano con il contenuto di file normalizzato a HTML.
`HTML_RegEx` | `8?` | Per i file di firma che funzionano con il contenuto di file normalizzato a HTML. Le firme possono contenere espressioni regolari.
`PE_Extended` | `9?` | Per i file di firma che funzionano con metadati PE (tranne i metadati sezione PE).
`PE_Sectional` | `A?` | Per i file di firma che funzionano con i metadati di sezione PE.
`Complex_Extended` | `B?` | Per i file di firma che funzionano con diverse regole basate su metadati estesi generati da phpMussel.
`URL_Scanner` | `C?` | Per i file di firma che funzionano con gli URL.

Il byte successivo `[x10]` è una nuova linea `[0A]`, e conclude l'intestazione del file di firma per phpMussel.

Ogni linea non vuota in seguito è una firma o una regola. Ogni firma o regola occupa una linea. I formati di firma supportati sono descritti di seguito.

#### *FIRME DEI NOMI DI FILE*
Tutte le firme dei nomi di file seguono il formato:

`NOME:FNRX`

Dove NOME è il nome per citare per quella firma e FNRX è la regolare espressione a verifica file nomi firme (non codificata) contra.

#### *FIRME HASH*
Tutte le firme hash seguono il formato:

`HASH:DIMENSIONE:NOME`

Dove HASH è l'hash (di solito MD5) dell'intero file, DIMENSIONE è la totale dimensione del file e NOME è il nome per citare per quella firma.

#### *FIRME PE SEZIONALI*
Tutte le firme PE sezionali seguono il formato:

`DIMENSIONE:HASH:NOME`

Dove HASH è l'MD5 hash di una sezione del PE file, DIMENSIONE è la totale dimensioni della sezione e NOME è il nome per citare per quella firma.

#### *FIRME PE ESTESO*
Tutte le firme PE esteso seguono il formato:

`$VAR:HASH:DIMENSIONE:NOME`

Dove $VAR è il nome della PE variabile per corrispondere contro, HASH è l'MD5 hash di quella variabile, DIMENSIONE è la dimensione totale di quella variabile e NOME è il nome per citare per quella firma.

#### *COMPLESSO ESTESO FIRME*
Complesso esteso firme sono piuttosto diverso da altri tipi di firme possibili con phpMussel, in quanto ciò che essi sono corrispondenti contro è specificato dalle firme stesse e possono corrispondere contro più criteri. Criteri sono delimitati da ";" e il tipo e dati di ogni criterio è delimitato da ":" come tale che il formato per queste firme sembra come:

`$variabile1:DATI;$variabile2:DATI;FirmeNome`

#### *TUTTO IL RESTO*
Tutte le altre firme seguono il formato:

`NOME:HEX:FROM:TO`

Dove NOME è il nome per citare per quella firma e HEX è un esadecimale codificato segmento del file destinato essere verificato dal pertinente firma. FROM e TO sono opzionali parametri, indicando da cui ea cui posizioni nei sorgenti dati per verificare contra.

#### *REGEX (REGULAR EXPRESSIONS)*
Ogni forma di regex correttamente capito da PHP anche dovrebbe essere correttamente capito da phpMussel el sue firme. Ma, io suggerirei di prendere estrema cautela quando scrittura nuove regex basato firme, perché, se non sei certo quello stai facendo, ci possono essere molto irregolari e/o inaspettati risultati. Occhiata al sorgente codice di phpMussel se non sei certo sul contesto in cui le regolari espressioni dichiarazioni vengono parsato. Anche, ricordare che tutti i espressioni (ad eccezione per i file nomi, archivio metadati e l'MD5 espressioni) deve essere esadecimale codificato (tranne sintassi, naturalmente)!

---


### 9. <a name="SECTION9"></a>CONOSCIUTI COMPATIBILITÀ PROBLEMI

#### PHP e PCRE
- phpMussel richiede PHP e PCRE a eseguire ea funzionare correttamente. Senza PHP, o senza il PCRE estensione di PHP, phpMussel non sarà eseguirà o funzionare correttamente. Dovrebbe assicurarsi che il vostra sistema ha sia PHP e PCRE installati e disponibili prima di scaricare e installare phpMussel.

#### ANTI-VIRUS SOFTWARE COMPATIBILITÀ

Per la maggior parte, phpMussel dovrebbe essere compatibile abbastanza con la maggior parte dei antivirus software. Ma, conflitti sono stati riportati da un numero di utenti in passato. Queste informazioni qui di seguito è da VirusTotal.com, e descrive un certo numero di falsi positivi riportato dai vari anti-virus programmi contro phpMussel. Sebbene questa informazione non è un'assoluta garanzia di se o non si sarà verificheranno problemi di compatibilità tra phpMussel e il vostro anti-virus software, se il vostro software anti-virus è stati ha notato o ha bandierato contro phpMussel, si dovrebbe considerare sia disattivarlo prima di lavorare con phpMussel o dovrebbe considerare l'alternative opzioni per sia il vostro anti-virus software o phpMussel.

Questa informazione è stato lo scorso aggiornato 2017.12.01 ed è in corso per tutte le phpMussel rilasci delle due più recenti minori versioni (v1.0.0-v1.1.0) al momento di scrivere questo.

*Questa informazione si applica solo al pacchetto principale. I risultati possono variare in base a file di firma installati, plug-in, e altri componenti periferici.*

| Scanner | Risultati |
|---|---|
| AVware | Riferisce "BPX.Shell.PHP" |
| Bkav | Riferisce "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>DOMANDE FREQUENTI (FAQ)

- [Che cosa è una "firma"?](#WHAT_IS_A_SIGNATURE)
- [Che cosa è un "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)
- [Con quale frequenza vengono aggiornate le firme?](#SIGNATURE_UPDATE_FREQUENCY)
- [Ho incontrato un problema durante l'utilizzo phpMussel e non so che cosa fare al riguardo! Aiutami!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Voglio usare phpMussel con una versione di PHP più vecchio di 5.4.0; Puoi aiutami?](#MINIMUM_PHP_VERSION)
- [Posso utilizzare un'installazione singola di phpMussel per proteggere più domini?](#PROTECT_MULTIPLE_DOMAINS)
- [Non voglio perdere tempo con l'installazione di questo e farlo funzionare con il mio sito web; Posso pagarti per farlo per me?](#PAY_YOU_TO_DO_IT)
- [Posso assumere voi o uno degli sviluppatori di questo progetto per lavori privati?](#HIRE_FOR_PRIVATE_WORK)
- [Ho bisogno di modifiche specialistiche, personalizzazioni, ecc; Puoi aiutare?](#SPECIALIST_MODIFICATIONS)
- [Sono uno sviluppatore, un designer di siti web o un programmatore. Posso accettare o offrire lavori relativi a questo progetto?](#ACCEPT_OR_OFFER_WORK)
- [Voglio contribuire al progetto; Posso farlo?](#WANT_TO_CONTRIBUTE)
- [Valori consigliati per "ipaddr".](#RECOMMENDED_VALUES_FOR_IPADDR)
- [Come accedere a dettagli specifici sui file quando vengono scansionati?](#SCAN_DEBUGGING)
- [Posso utilizzare il cron per aggiornare automaticamente?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [phpMussel può eseguire la scansione di file con nomi non ANSI?](#SCAN_NON_ANSI)
- [Blacklists (liste nere) – Whitelists (liste bianche) – Greylists (liste grigie) – Cosa sono e come li uso?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>Che cosa è una "firma"?

Nel contesto di phpMussel, una "firma" si riferisce a dati che fungono da indicatore/identificatore per qualcosa di specifico che stiamo cercando, di solito sotto forma di un segmento molto piccolo, distinto, e innocuo di qualcosa di più grande e altrimenti dannose, come un virus o un trojan, o sotto forma di un checksum di file, un hash, o altro identificando indicatore, e di solito include un'etichetta, e alcuni altri dati per fornire un contesto aggiuntivo che può essere utilizzato da phpMussel per determinare il modo migliore per procedere quando incontra quello che stiamo cercando.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>Che cosa è un "falso positivo"?

Il termine "falso positivo" (*in alternativa: "errore di falso positivo"; "falso allarme"*; Inglese: *false positive*; *false positive error*; *false alarm*), descritto molto semplicemente, e in un contesto generalizzato, viene utilizzato quando si analizza una condizione, per riferirsi ai risultati di tale analisi, quando i risultati sono positivi (cioè, la condizione è determinata a essere "positivo", o "vero"), ma dovrebbero essere (o avrebbe dovuto essere) negativo (cioè, la condizione, in realtà, è "negativo", o "falso"). Un "falso positivo" potrebbe essere considerato analogo a "piangendo lupo" (dove la condizione di essere analizzato è se c'è un lupo nei pressi della mandria, la condizione è "falso" in che non c'è nessun lupo nei pressi della mandria, e la condizione viene segnalato come "positivo" dal pastore per mezzo di chiamando "lupo, lupo"), o analogo a situazioni di test medici dove un paziente viene diagnosticato una malattia, quando in realtà, non hanno qualsiasi malattia.

Risultati correlati quando si analizza una condizione può essere descritto utilizzando i termini "vero positivo", "vero negativo" e "falso negativo". Un "vero positivo" si riferisce a quando i risultati dell'analisi e lo stato attuale della condizione sono entrambi vero (o "positivo"), e un "vero negativo" si riferisce a quando i risultati dell'analisi e lo stato attuale della condizione sono entrambe falso (o "negativo"); Un "vero positivo" o un "vero negativo" è considerato una "inferenza corretta". L'antitesi di un "falso positivo" è un "falso negativo"; Un "falso negativo" si riferisce a quando i risultati dell'analisi sono negativo (cioè, la condizione è determinata a essere "negativo", o "falso"), ma dovrebbero essere (o avrebbe dovuto essere) positivo (cioè, la condizione, in realtà, è "positivo", o "vero").

Nel contesto di phpMussel, questi termini si riferiscono alle firme di phpMussel e le file che si bloccano. Quando phpMussel si blocca un file a causa di firme male, obsoleti o errati, ma non avrebbe dovuto fare così, o quando lo fa per le ragioni sbagliate, ci riferiamo a questo evento come un "falso positivo". Quando phpMussel non riesce a bloccare un file che avrebbe dovuto essere bloccato, a causa delle minacce impreviste, firme mancante o carenze nelle sue firme, ci riferiamo a questo evento come una "rivelazione mancante" o "missed detection" (che è analoga ad un "falso negativo").

Questo può essere riassunta dalla seguente tabella:

&nbsp; | phpMussel *NON* dovrebbe bloccare un file | phpMussel *DOVREBBE* bloccare un file
---|---|---
phpMussel *NON* bloccare un file | Vero negativo (inferenza corretta) | Rivelazione mancante (analogous to falso negativo)
phpMussel *FA* bloccare un file | __Falso positivo__ | Vero positivo (inferenza corretta)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>Con quale frequenza vengono aggiornate le firme?

Frequenza di aggiornamento varia a seconda delle file di firma in questione. Tutti i manutentori per i file di firma per phpMussel in genere cercano di mantenere i loro firme aggiornato il più possibile, ma a causa di tutti noi abbiamo diversi altri impegni, la nostra vita al di fuori del progetto, e a causa di nessuno di noi sono finanziariamente compensato (o pagato) per i nostri sforzi sul progetto, un calendario di aggiornamento preciso non può essere garantita. In genere, le firme vengono aggiornati ogni volta che c'è abbastanza tempo per aggiornarli, e generalmente, manutentori cercano di dare la priorità sulla base di necessità e su come spesso i cambiamenti si verificano tra le gamme. L'assistenza è sempre apprezzato se siete disposti a offrire qualsiasi.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>Ho incontrato un problema durante l'utilizzo phpMussel e non so che cosa fare al riguardo! Aiutami!

- Si sta utilizzando la versione più recente del software? Si sta utilizzando le ultime versioni dei file di firma? Se la risposta a una di queste due domande è no, provare ad aggiornare tutto prima, e verificare se il problema persiste. Se persiste, continuare a leggere.
- Hai controllato attraverso tutta la documentazione? In caso non fatto, si prega di farlo. Se il problema non può essere risolto utilizzando la documentazione, continuare a leggere.
- Hai controllato la **[pagina dei issues](https://github.com/phpMussel/phpMussel/issues)**, per vedere se il problema è stato accennato prima? Se è stato accennato prima, verificare se sono stati forniti qualsiasi suggerimenti, idee, e/o soluzioni, e seguire come necessario per cercare di risolvere il problema.
- Se il problema persiste, si prega di cercare aiuto su di esso per mezzo di creando un nuovo issue nella pagina dei issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Voglio usare phpMussel con una versione di PHP più vecchio di 5.4.0; Puoi aiutami?

No. PHP 5.4.0 raggiunto EoL ("End of Life", o fine della vita) ufficiale nel 2014, e il supporto di sicurezza esteso è stato terminato nel 2015. Come della stesura di questo, è il 2017, e PHP 7.1.0 è già disponibile. In questo momento, il supporto è fornito per l'utilizzo di phpMussel con PHP 5.4.0 e tutte le versioni di PHP più recenti disponibili, ma se si tenta di utilizzare phpMussel con le versioni di PHP più vecchie, supporto non sarà fornito.

*Guarda anche: [Grafici di Compatibilità](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Posso utilizzare un'installazione singola di phpMussel per proteggere più domini?

Sì. Le installazioni di phpMussel non sono naturalmente legato a domini specifici, e quindi possono essere utilizzati per proteggere più domini. Generalmente, ci riferiamo alle installazioni di phpMussel che proteggono un solo dominio come "installazioni per singolo dominio", e ci riferiamo a installazioni di phpMussel che proteggono più domini e/o sottodomini come "installazioni per più domini". Se si esegue un'installazione per più domini e bisogno utilizzare diversi set di file di firma per diversi domini, o bisogno che phpMussel essere configurato in modo diverso per diversi domini, è possibile farlo. Dopo aver caricato il file di configurazione (`config.ini`), phpMussel verifica l'esistenza di un "file di sovrascrittura per la configurazione" specifico del dominio (o sottodominio) che viene richiesto (`il-dominio-che-viene-richiesto.tld.config.ini`), e se trovati, tutti i valori di configurazione definiti dal file di sovrascrittura per la configurazione verranno utilizzati per l'istanza di esecuzione invece dei valori di configurazione definiti dal file di configurazione. I file di sovrascrittura per la configurazione sono identiche al file di configurazione, e a vostra discrezione, può contenere l'insieme di tutte le direttive di configurazione disponibili a phpMussel, o qualsiasi piccola sottosezione richiesta che differisca dai valori normalmente definiti dal file di configurazione. I file di sovrascrittura per la configurazione sono chiamati in base al dominio a cui sono destinati (così, per esempio, se hai bisogno di un file di sovrascrittura per la configurazione per il dominio, `http://www.some-domain.tld/`, la sua file di sovrascrittura per la configurazione deve essere denominato come `some-domain.tld.config.ini`, e deve essere collocato all'interno della vault insieme al file di configurazione, `config.ini`). Il nome di dominio per l'istanza di esecuzione è derivato dall'intestazione `HTTP_HOST` della richiesta; "www" viene ignorato.

#### <a name="PAY_YOU_TO_DO_IT"></a>Non voglio perdere tempo con l'installazione di questo e farlo funzionare con il mio sito web; Posso pagarti per farlo per me?

Forse. Ciò è considerato caso per caso. Dicci cosa hai bisogno, quello che stai offrendo, e ti dirà se possiamo aiutare.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Posso assumere voi o uno degli sviluppatori di questo progetto per lavori privati?

*Vedi sopra.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Ho bisogno di modifiche specialistiche, personalizzazioni, ecc; Puoi aiutare?

*Vedi sopra.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Sono uno sviluppatore, un designer di siti web o un programmatore. Posso accettare o offrire lavori relativi a questo progetto?

Sì. La nostra licenza non vieta questo.

#### <a name="WANT_TO_CONTRIBUTE"></a>Voglio contribuire al progetto; Posso farlo?

Sì. I contributi al progetto sono molto graditi. Per ulteriori informazioni, vedere "CONTRIBUTING.md".

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>Valori consigliati per "ipaddr".

Valore | Utilizzando
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy inverso Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy inverso Cloudflare.
`CF-Connecting-IP` | Proxy inverso Cloudflare (alternativa; se il precedente non funziona).
`HTTP_X_FORWARDED_FOR` | Proxy inverso Cloudbric.
`X-Forwarded-For` | [Proxy inverso Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Definito dalla configurazione del server.* | [Proxy inverso Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Nessun proxy inverso (valore predefinito).

#### <a name="SCAN_DEBUGGING"></a>Come accedere a dettagli specifici sui file quando vengono scansionati?

È possibile accedere a dettagli specifici sui file quando vengono scansionati da assegnando un'array da utilizzare a tale scopo prima di istruire phpMussel per eseguire la scansione.

Nell'esempio qui sotto, a questo scopo viene utilizzato `$Foo`. Dopo la scansione di `/percorso/del/file/...`, le informazioni dettagliate sui file contenute da `/percorso/del/file/...` verranno contenute da `$Foo`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/percorso/del/file/...');

var_dump($Foo);
```

L'array è una matrice multidimensionale che consiste di elementi che rappresentano ogni file che viene sottoposto a scansione e sottoelementi che rappresentano i dettagli su questi file. Questi sottoelementi sono i seguenti:

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

*† - Non fornito di risultati memorizzati nella cache (fornito di nuovi risultati di scansione solo).*

*‡ - Fornito durante la scansione dei file PE solo.*

Facoltativamente, questa matrice può essere distrutta utilizzando quanto segue:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Posso utilizzare il cron per aggiornare automaticamente?

Sì. Una API è incorporata nel front-end per interagire con la pagina degli aggiornamenti tramite script esterni. È disponibile uno script separato, "[Cronable](https://github.com/Maikuolan/Cronable)", e può essere utilizzato dal tuo cron manager o cron scheduler per aggiornare automaticamente questo e altri pacchetti supportati (questo script fornisce la propria documentazione).

#### <a name="SCAN_NON_ANSI"></a>phpMussel può eseguire la scansione di file con nomi non ANSI?

Diciamo che c'è una cartella che vuoi scansionare. In questa cartella, hai alcuni file con nomi non ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Supponiamo che tu stia utilizzando la modalità CLI o l'API phpMussel per la scansione.

Quando si utilizza PHP < 7.1.0, su alcuni sistemi, phpMussel non vedrà questi file quando si tenta di eseguire la scansione della cartella e, quindi, non sarà in grado di eseguire la scansione di questi file. Probabilmente vedrai gli stessi risultati come se dovessi eseguire la scansione di una directory vuota:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniziato.
 Sun, 01 Apr 2018 22:27:41 +0800 Finito.
```

Inoltre, quando si utilizza PHP < 7.1.0, la scansione dei file individualmente produce risultati come questi:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniziato.
 > Verifica 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> File non valido!
 Sun, 01 Apr 2018 22:27:41 +0800 Finito.
```

O questi:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniziato.
 > X:/directory/??????.txt non è né un file né una cartella.
 Sun, 01 Apr 2018 22:27:41 +0800 Finito.
```

Questo è dovuto al modo in cui PHP gestiva i nomi di file non ANSI prima di PHP 7.1.0. Se riscontri questo problema, la soluzione è aggiornare la tua installazione PHP a 7.1.0 o più recente. In PHP >= 7.1.0, i nomi dei file non ANSI vengono gestiti meglio e phpMussel dovrebbe essere in grado di eseguire correttamente la scansione dei file.

Per confronto, i risultati quando si tenta di eseguire la scansione della cartella utilizzando PHP >= 7.1.0:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniziato.
 -> Verifica '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Nessun problema rilevato.
 -> Verifica '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Nessun problema rilevato.
 -> Verifica '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Nessun problema rilevato.
 Sun, 01 Apr 2018 22:27:41 +0800 Finito.
```

E tentando di scansionare i file individualmente:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniziato.
 > Verifica 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Nessun problema rilevato.
 Sun, 01 Apr 2018 22:27:41 +0800 Finito.
```

#### <a name="BLACK_WHITE_GREY"></a>Blacklists (liste nere) – Whitelists (liste bianche) – Greylists (liste grigie) – Cosa sono e come li uso?

I termini hanno significati diversi in diversi contesti. In phpMussel, ci sono tre contesti in cui vengono utilizzati questi termini: Risposta alla dimensione del file, risposta al tipo di file e, greylist delle firme.

Al fine di ottenere un risultato desiderato con un costo minimo per l'elaborazione, ci sono alcune cose semplici che phpMussel può controllare prima di eseguire effettivamente la scansione dei file, come la dimensione, il nome e l'estensione di un file. Per esempio; Se un file è troppo grande, o se la sua estensione indica un tipo di file che non vogliamo autorizzare sui nostri siti web, possiamo immediatamente contrassegnare il file e non è necessario eseguirne la scansione.

La risposta alle dimensioni del file è il modo in cui phpMussel risponde quando un file supera un limite specificato. Sebbene non siano presenti elenchi effettivi, un file può essere considerato efficacemente nella blacklist, nella whitelist, o nella greylist, in base alle sue dimensioni. Esistono due direttive di configurazione opzionali per specificare rispettivamente un limite e una risposta desiderata.

La risposta del tipo di file è il modo in cui phpMussel risponde all'estensione del file. Esistono tre direttive di configurazione opzionali per specificare esplicitamente quali estensioni dovrebbero essere inserite nella blacklist, nella whitelist, o nella greylist. Un file può essere considerato effettivamente nella blacklist, nella whitelist, o nella greylist se la sua estensione corrisponde rispettivamente a una delle estensioni specificate.

In questi due contesti, essere nella whitelist significa che non dovrebbe essere scansionato o contrassegnato; essere nella blacklist significa che dovrebbe essere contrassegnato (e quindi non è necessario scansionarlo); ed essere nella greylist significa che è necessaria un'ulteriore analisi per determinare se dovremmo contrassegnarlo (cioè, dovrebbe essere scansionato).

La greylist delle firme è una lista di firme che dovrebbe essere essenzialmente ignorata (questo è brevemente menzionato prima nella documentazione). Quando viene innescata una firma nella greylist delle firme, phpMussel continua a lavorare attraverso le sue firme e non intraprende alcuna azione particolare riguardo alla firma nella greylist. Non esiste una blacklist delle firme, perché il comportamento implicito è comunque un comportamento normale per le firme innescate, e non esiste una whitelist delle firme, perché il comportamento implicito non avrebbe davvero senso in considerazione di come funziona phpMussel normal e delle funzionalità che già possiede.

La greylist delle firme è utile se è necessario risolvere i problemi causati da una particolare firma senza disabilitare o disinstallare l'intero file di firme.

---


### 11. <a name="SECTION11"></a>INFORMAZIONE LEGALE

#### 11.0 SECTION PREAMBLE

This section of the documentation is intended to describe possible legal considerations regarding the use and implementation of the package, and to provide some basic related information. This may be important for some users as a means to ensure compliancy with any legal requirements that may exist in the countries that they operate in, and some users may need to adjust their website policies in accordance with this information.

First and foremost, please realise that I (the package author) am not a lawyer, nor a qualified legal professional of any kind. Therefore, I am not legally qualified to provide legal advice. Also, in some cases, exact legal requirements may vary between different countries and jurisdictions, and these varying legal requirements may sometimes conflict (such as, for example, in the case of countries that favour privacy rights and the right to be forgotten, versus countries that favour extended data retention). Consider also that access to the package is not restricted to specific countries or jurisdictions, and therefore, the package userbase is likely to the geographically diverse. These points considered, I'm not in a position to state what it means to be "legally compliant" for all users, in all regards. However, I hope that the information herein will help you to come to a decision yourself regarding what you must do in order to remain legally compliant in the context of the package. If you have any doubts or concerns regarding the information herein, or if you need additional help and advice from a legal perspective, I would recommend consulting a qualified legal professional.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Relevant configuration directives:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Relevant configuration directives:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevant configuration directives:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 LOGGING

Logging is an important part of phpMussel for a number of reasons. Without logging, it may be difficult to diagnose false positives, to ascertain exactly how performant phpMussel is in any particular context, and to determine where its shortfalls may be, and what changes may be required to its configuration or signatures accordingly, in order for it to continue functioning as intended. Regardless, logging mightn't be desirable for all users, and remains entirely optional. In phpMussel, logging is disabled by default. To enable it, phpMussel must be configured accordingly.

Additionally, whether logging is legally permissible, and to the extent that it is legally permissible (e.g., the types of information that may logged, for how long, and under what circumstances), may vary, depending on jurisdiction and on the context where phpMussel is implemented (e.g., whether you're operating as an individual, as a corporate entity, and whether on a commercial or non-commercial basis). It may therefore be useful for you to read through this section carefully.

There are multiple types of logging that phpMussel can perform. Different types of logging involves different types of information, for different reasons.

##### 11.3.0 SCAN LOGS

When enabled in the package configuration, phpMussel keeps logs of the files it scans. This type of logging is available in two different formats:
- Human readable logfiles.
- Serialised logfiles.

Entries to a human readable logfile typically look something like this (as an example):

```
Mon, 21 May 2018 00:47:58 +0800 Started.
> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Detected phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Finished.
```

A scan log entry typically includes the following information:
- The date and time that the file was scanned.
- The name of the file scanned.
- CRC32b hashes of the name and contents of the file.
- What was detected in the file (if anything was detected).

*Relevant configuration directives:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

When these directives are left empty, this type of logging will remain disabled.

##### 11.3.1 SCAN KILLS

When enabled in the package configuration, phpMussel keeps logs of the uploads that have been blocked.

Entries to a "scan kills" logfile typically look something like this (as an example):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Detected phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Quarantined as "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu".
```

A "scan kills" entry typically includes the following information:
- The date and time that the upload was blocked.
- The IP address where the upload originated from.
- The reason why the file was blocked (what was detected).
- The name of the file blocked.
- An MD5 and the size of the file blocked.
- Whether the file was quarantined, and under what internal name.

*Relevant configuration directives:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Relevant configuration directives:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Relevant configuration directives:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Relevant configuration directives:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Relevant configuration directives:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Relevant configuration directives:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Relevant configuration directives:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Relevant configuration directives:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

The General Data Protection Regulation (GDPR) is a regulation of the European Union, which comes into effect as of May 25, 2018. The primary goal of the regulation is to give control to EU citizens and residents regarding their own personal data, and to unify regulation within the EU concerning privacy and personal data.

The regulation contains specific provisions pertaining to the processing of "personally identifiable information" (PII) of any "data subjects" (any identified or identifiable natural person) either from or within the EU. To be compliant with the regulation, "enterprises" (as per defined by the regulation), and any relevant systems and processes must implement "privacy by design" by default, must use the highest possible privacy settings, must implement necessary safeguards for any stored or processed information (including, but not limited to, the implementation of pseudonymisation or full anonymisation of data), must clearly and unambiguously declare the types of data they collect, how they process it, for what reasons, for how long they retain it, and whether they share this data with any third parties, the types of data shared with third parties, how, why, and so on.

Data may not be processed unless there's a lawful basis for doing so, as per defined by the regulation. Generally, this means that in order to process a data subject's data on a lawful basis, it must be done in compliance with legal obligations, or done only after explicit, well-informed, unambiguous consent has been obtained from the data subject.

Because aspects of the regulation may evolve in time, in order to avoid the propagation of outdated information, it may be better to learn about the regulation from an authoritative source, as opposed to simply including the relevant information here in the package documentation (which may eventually become outdated as the regulation evolves).

[EUR-Lex](https://eur-lex.europa.eu/) (a part of the official website of the European Union that provides information about EU law) provides extensive information about GDPR/DSGVO, available in 24 different languages (at the time of writing this), and available for download in PDF format. I would definitely recommend reading the information that they provide, in order to learn more about GDPR/DSGVO:
- [REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679)

Alternatively, there's a brief (non-authoritative) overview of GDPR/DSGVO available at Wikipedia:
- [General Data Protection Regulation](https://en.wikipedia.org/wiki/General_Data_Protection_Regulation)

---


Ultimo Aggiornamento: 25 Maggio 2018 (2018.05.25).
