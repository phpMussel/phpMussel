## Documentazione per phpMussel (Italiano).

### Contenuti
- 1. [PREAMBOLO](#SECTION1)
- 2A. [COME INSTALLARE (PER WEB SERVER)](#SECTION2A)
- 2B. [COME INSTALLARE (PER CLI)](#SECTION2B)
- 3A. [COME USARE (PER WEB SERVER)](#SECTION3A)
- 3B. [COME USARE (PER CLI)](#SECTION3B)
- 4A. [BROWSER COMANDI](#SECTION4A)
- 4B. [CLI (COMANDO LINEA INTERFACCIA)](#SECTION4B)
- 5. [FILE INCLUSI IN QUESTO PACCHETTO](#SECTION5)
- 6. [OPZIONI DI CONFIGURAZIONE](#SECTION6)
- 7. [FIRMA FORMATO](#SECTION7)
- 8. [CONOSCIUTI COMPATIBILITÀ PROBLEMI](#SECTION8)

---


###1. <a name="SECTION1"></a>PREAMBOLO

Grazie per aver scelto phpMussel, un programma in PHP progettato per rilevare trojan, virus, malware ed altre minacce nei file caricati sul tuo sistema dovunque il programma stesso è collegato, basato sulle firme di ClamAV ed altri.

PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPLv2 Caleb M (Maikuolan).

Questo script è libero software; è possibile ridistribuirlo e/o modificarlo sotto i termini della GNU General Public License come pubblicato dalla Free Software Foundation; o la versione 2 della licenza, o (a propria scelta) una versione successiva. Questo script è distribuito nella speranza che possa essere utile, Ma SENZA ALCUNA GARANZIA; senza neppure la implicita garanzia di COMMERCIABILITÀ o IDONEITÀ PER UN PARTICOLARE SCOPO. Vedere la GNU General Public License per ulteriori dettagli, situato nella `LICENSE.txt` file e disponibili anche da:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Uno speciale grazie a [ClamAV](http://www.clamav.net/) per l'ispirazione del progetto e per le firme che questo script usi, senza la quale, lo script sarebbe probabilmente non esisterebbe, o nel migliore, avrebbe un molto limitato valore.

Uno speciale grazie a Sourceforge e GitHub per ospitare i progetto file, a [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) per ospitare le phpMussel discussione forum, e le risorse di un certo numero di firme utilizzata da phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) e altri, e un grazie a tutti coloro che sostengono il progetto, a chiunque altro che io possa avere altrimenti dimenticato di menzionare, e per voi, per l'utilizzo dello script.

Questo documento ed il pacchetto associtato ad esso possono essere scaricati liberamente da:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>COME INSTALLARE (PER WEB SERVER)

Spero di semplificare questo processo tramite un installatore ad un certo punto in un futuro non troppo lontano, Ma fino ad allora, seguire queste istruzioni per avere phpMussel funzionale sulla maggior parte dei sistemi e CMS:

1) Con la vostra lettura di questo, sto supponendo che hai già scaricato una archiviata copia dello script, decompresso il contenuto e lo hanno seduto da qualche parte sul tuo locale macchina. Da qui, ti consigliamo di determinare dove sulla macchina o CMS si desidera inserire quei contenuti. Una cartella come `/public_html/phpmussel/` o simile (però, è non importa quale si sceglie, purché sia qualcosa sicuro e qualcosa si è soddisfatti) sarà sufficiente. *Prima di iniziare il caricamento, continua a leggere..*

2) Facoltativamente (fortemente consigliata per gli avanzati utenti, Ma non è consigliata per i principianti o per gli inesperti), apri `phpmussel.ini` (situato della `vault`) - Questo file contiene tutte le direttive disponibili per phpMussel. Sopra ogni opzione dovrebbe essere un breve commento che descrive ciò che fa e ciò che è per. Regolare queste opzioni come meglio credi, come per ciò che è appropriato per la vostre particolare configurazione. Salvare il file, chiudere.

3) Carica i contenuti (phpMussel e le sue file) nella cartella che ci deciso in precedenza (non è necessario includere i `*.txt`/`*.md` file, ma altrimenti, si dovrebbe caricare tutto).

4) CHMOD la cartella `vault` a "777". La principale cartella che memorizzare il contenuti (quello scelto in precedenza), solitamente, può essere lasciato solo, Ma lo CHMOD stato dovrebbe essere controllato se hai avuto problemi di autorizzazioni in passato sul vostro sistema (per predefinita, dovrebbe essere qualcosa simile a "755").

5) Successivamente, sarà necessario collegare phpMussel al vostro sistema o CMS. Ci sono diversi modi in cui è possibile collegare script come phpMussel al vostre sistema o CMS, Ma il più semplice è di inserire lo script all'inizio di un file del vostre sistema o CMS (quello che sarà generalmente sempre essere caricato quando qualcuno accede a una pagina attraverso il vostro sito) utilizzando un `require` o `include` comando. Solitamente, questo sarà qualcosa memorizzate in una cartella, ad esempio `/includes`, `/assets` o `/functions`, e spesso essere chiamato qualcosa come `init.php`, `common_functions.php`, `functions.php` o simili. Avrete bisogno determinare quale file è per la vostra situazione; In caso di difficoltà nel determinare questo per te, visitare il phpMussel supporto forum e fateci sapere; È possibile che io o un altro utente possono avere esperienza con il CMS che si sta utilizzando (avrete bisogno di fateci sapere quale CMS si sta utilizzando), e quindi, può essere in grado di fornire assistenza in questo settore. Per fare questo [utilizzare `require` o `include`], inserire la seguente linea di codice all'inizio di quel core file, sostituendo la stringa contenuta all'interno delle virgolette con l'esatto indirizzo della "phpmussel" file (indirizzo locale, non l'indirizzo HTTP; sarà simile all'indirizzo citato in precedenza).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Salvare il file, chiudere, caricare di nuovo.

-- IN ALTERNATIVA --

Se stai usando un Apache web server e se si ha accesso a `php.ini`, è possibile utilizzare il `auto_prepend_file` direttiva per precarico phpMussel ogni volta che qualsiasi richiesta di PHP è fatto. Qualcosa come:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

O questo nel `.htaccess` file:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare il lavoro svolto per assicurarsi che funzioni correttamente. Per testare le protezioni di file caricamente, tentare di caricare i test file inclusi nella pacchetto all'interno `_testfiles` al vostro web sito via i vostri soliti metodi di browser basato file caricamento. Se tutto funziona, un messaggio dovrebbe apparire da phpMussel conferma che il caricamento è stato bloccato con successo. Se nulla appare, qualcosa non funziona correttamente. Se si sta utilizzando qualsiasi l'avanzate funzioni o se si sta utilizzando qualsiasi altri tipi di scansione possibili con lo strumento, mi piacerebbe suggerisco di provarlo quelli per assicurarsi che funzioni come previsto, anche.

---


###2B. <a name="SECTION2B"></a>COME INSTALLARE (PER CLI)

Spero di semplificare questo processo tramite un installatore ad un certo punto in un futuro non troppo lontano, Ma fino ad allora, seguire queste istruzioni per avere phpMussel pronto a lavorare con CLI (essere consapevoli che in questo momento, CLI supporto applica solo ai Windows basato sistemi; Linux e altri sistemi arriveranno presto a una successiva versione di phpMussel):

1) Con la vostra lettura di questo, sto supponendo che hai già scaricato una archiviata copia dello script, decompresso il contenuto e lo hanno seduto da qualche parte sul tuo locale macchina. Quando hai stabilito che sei felice con il luogo scelto per phpMussel, continuare.

2) phpMussel richiede PHP essere installato sulla macchina per eseguire. Se non lo avete PHP installato sul vostra macchina, prego installare PHP sul vostra macchina seguendo le istruzioni fornite dal PHP installazione programma.

3) Facoltativamente (fortemente consigliata per gli avanzati utenti, ma non è consigliata per i principianti o per gli inesperti), apri `phpmussel.ini` (situato della `vault`) - Questo file contiene tutte le direttive disponibili per phpMussel. Sopra ogni opzione dovrebbe essere un breve commento che descrive ciò che fa e ciò che è per. Regolare queste opzioni come meglio credi, come per ciò che è appropriato per la vostre particolare configurazione. Salvare il file, chiudere.

4) Facoltativamente, si può rendere utilizzando di phpMussel in CLI modalità facile per voi stessi per creando un batch file ai fini della automaticamente caricare PHP e phpMussel. Per fare questo, aprire un testo editor come Notepad o Notepad++, digitare il completo percorso della `php.exe` file nella cartella della vostra installazione di PHP, seguito da uno spazio, seguito dal completo percorso della `phpmussel.php` file nella cartella della vostra installazione di phpMussel, salvare il file con un ".bat" estensione qualche parte che lo troverete facilmente, e fare doppio clic su tale file per eseguire phpMussel in futuro.

5) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare il lavoro svolto per assicurarsi che funzioni correttamente. Per testare phpMussel, eseguire phpMussel e prova scansionare la `_testfiles` cartella fornito con il pacchetto.

---


###3A. <a name="SECTION3A"></a>COME USARE (PER WEB SERVER)

phpMussel è uno script destinato a funzionare adeguatamente con solo minimi requisiti: Quando è stato installato, fondamentalmente, è dovrebbe funzionare.

Scansionare di file caricamenti è automatizzato e abilitato per predefinita, perciò nulla è richiesto a vostro nome per questa particolare funzione.

Ma, si è anche in grado di istruire phpMussel per la scansione per i specifici file, cartelle o archivi. Per fare questo, in primo luogo, è necessario assicurarsi che l'appropriata configurazione è impostato nella `phpmussel.ini` file (`cleanup` deve essere disattivato), e quando fatto, in un PHP file che è collegato allo phpMussel, utilizzare la seguente funzione nelle codice:

`phpMussel($cosa_a_scansione,$tipi_di_output,$output_pianura);`

- `$cosa_a_scansione` può essere una stringa, un array o un array di array multipli, e indica quale d'il file, cartella e/o cartelle a scansiona.
- `$tipi_di_output` è un valore booleano, indicanti il formato per i risultati della scansione a essere restituire come. False/Falso istruisce la funzione a restituire i risultati come un intero (un risultato restituito di -3 indica problemi sono stati incontrati con il phpMussel firme file o file di firme mappe e che possono essere possibile mancanti o corrotto, -2 indica che i corrotto dato è stato rilevato durante la scansione e quindi la scansione non abbia completato, -1 indica che estensioni o addon richiesti per PHP a eseguire la scansione erano assente e quindi la scansione non abbia completato, 0 indica che l'obiettivo di scansione non esiste e quindi non c'era nulla a scansione, 1 indica che l'obiettivo è stato scansionata correttamente e non problemi stati rilevati, e 2 indica che l'obiettivo è stato scansionata correttamente e problemi stati rilevati). True/Vero istruisce la funzione a restituire i risultati come testo leggibile. In aggiunta, in ogni caso, i risultati sono accessibili tramite variabili globali dopo la scansione è stata completata. Questa variabile è facoltativa, inadempiente su false/falso.
- `$output_pianura` è un valore booleano, indicanti alla funzione se restituire i risultati della scansione (quando ci sono multipli obiettivi di scansione) come un array o una stringa. False/Falso restituirà i risultati come un array. True/Vero restituirà i risultati come una stringa. Questa variabile è facoltativa, inadempiente su false/falso.

Esempi:

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

Restituisce qualcosa come (in forma di una stringa):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Iniziato.
 > Verifica '/user_name/public_html/my_file.html':
 -> Nessun problema rilevato.
 Wed, 16 Sep 2013 02:49:47 +0000 Finito.
```

Per una dettagliata spiegazione del tipo di firme di cui phpMussel usa durante le sue scansioni e come le sue gestisce queste firme, fare riferimento alla Firma Formato sezione di questo README file.

Se si incontrano qualsiasi falsi positivi, Se si incontrano qualcosa nuova che si pensa dovrebbe essere bloccato, o per qualsiasi altri scopi o materia a riguardo delle firme, si prega di contattare me a riguardo esso così che io possa apportare le necessarie modifiche, di cui, se si non fare contatto me, io non necessariamente essere consapevole ne.

Per disabilita firme incluso con phpMussel (come se stai sperimentando falsi positivi specifico alle vostri scopi di cui non dovrebbero normalmente essere rimosso dalla streamline), fare riferimento alle note per greylisting all'interno del Browser Comandi sezione di questo README file.

Oltre alla predefinito scansione dei file caricamenti e l'opzionale scansione di altri file e/o cartelle specificato tramite la sopra funzione, incluso in phpMussel è una funzione intendeva per la scansione dello corpo dei email messaggi. Questa funzione si comporta in simile modi alla norma phpMussel() funzione, Ma si concentra esclusivamente sulla verificare contro i ClamAV email basato firme. L'ho non legato queste firme alla norma phpMussel() funzione, perché è altamente improbabile che mai avresti trovato il corpo di un in arrivo e-mail messaggio di bisogno di scansione dall'interno un file caricamento mirato a una pagina dove phpMussel è collegato, e così, a legare queste firme nella phpMussel() funzione sarebbe ridondante. Ma, con quello detto, avente una separata funzione per verificare contro queste firme potrebbe rivelarsi estremamente utile per alcuni, soprattutto per coloro il cui CMS o webfront sistema è in qualche modo legato nel loro email sistema e per quelli di cui parsare i loro email tramite una PHP script di cui essi potenzialmente potrebbero collegare a phpMussel. Configurazione per questa funzione, come tutti gli altri, è controllato tramite delle `phpmussel.ini` file. Per utilizzare di questa funzione (avrete bisogno a fare la propria implementazione), in un PHP file che è collegato al phpMussel, utilizzare la seguente funzione nel vostre codice:

`phpMussel_mail($corpo);`

Dove $corpo è corpo dello email messaggio che si desidera a scansione (inoltre, si potrebbe provare a scansione nuovi forum messaggi, in arrivo messaggi dal vostro online contatto form o simile). se qualsiasi errori accadere impedendo la funzione di completare il sue scansione, un valore di -1 verrà restituito. Se la funzione completa il sue scansione e nulla è trovato, un valore di 0 verrà restituito (che significa pulito). Se, ma, la funzione lo fa trovare qualcosa, una stringa sarà restituito contenente un messaggio che dichiara ciò che ha trovato.

In aggiunta a quanto sopra, se si guarda il sorgente codice, è possibile si può notare le funzioni phpMusselD() e phpMusselR(). Queste funzioni sono sub-funzioni di phpMussel(), e non deve essere chiamato direttamente al di fuori di tale genitore funzione (non a causa di avversi effetti.. Più così, semplicemente perché che sarebbe stato inutile, e molto probabilmente non sarà effettivamente funziona correttamente comunque).

Ci sono molti altri controlli e funzioni disponibili all'interno phpMussel per il vostro uso. Per tali controlli e funzioni che, dalla fine di questa sezione del README, non sono ancora stato documentato, si prego continuare a leggere e fare riferimento alla Browser Comandi sezione di questo README file.

---


###3B. <a name="SECTION3B"></a>COME USARE (PER CLI)

Si prega di fare riferimento alla "COME INSTALLARE (PER CLI)" sezione di questo README file.

Essere consapevoli che, sebbene futuri versioni di phpMussel dovrebbe sostenere altri sistemi, in questo momento, phpMussel CLI modalità supporto è ottimizzata solo per l'utilizzo su Windows basati sistemi (si può, ovviamente, provare su altri sistemi, Ma non posso garantire che funzionerà come previsto).

Anche essere consapevoli che phpMussel è non l'equivalente di un completa funzionale anti-virus suite, e diverso dai convenzionali anti-virus suite, non protegge l'attiva memoria o simili! Essa solo rileva virus contenuti da quei specifici file che si esplicitamente dica per scansione.

---


###4A. <a name="SECTION4A"></a>BROWSER COMANDI

Quando phpMussel è stato installato ed è funzionante correttamente sulla vostra sistema, se hai definito le `script_password` e `logs_password` variabili nel configurazione file, si sarà in grado di eseguire qualche limitato numero di amministrative funzioni e inserire qualche numero di comandi per phpMussel tramite il browser. La ragione per cui queste password devono essere definite come mezzo per abilita le browser lato controlli è sia per garantire l'adeguata sicurezza, un'adeguata protezione di questi browser lato controlli e per assicurare che esista un modo per questi browser lato controlli essere completamente disabilitalo se non sono desiderati da voi e/o altro webmaster/amministratori che utilizzano phpMussel. Così, in altre parole, per abilita questi controlli, definire una password, e per disabilita questi controlli, definire nessune password. In alternativa, se si sceglie di abilitare questi controlli e quindi scegliere di disabilita questi controlli in un secondo momento, c'è un comando per fare questo (che può essere utile se si eseguono particulare azioni che si sente potrebbero compromettere le delegati password ed è necessità di rapidamente disabilita questi controlli senza modificare le configurazione file).

Un paio di motivi per cui si _**DOVREBBE**_ abilita questi controlli:
- Fornisce un modo per facilmente aggiungere firme alla greylist in casi come quando si scopre una firma che sta producendo un falso positivo durante il caricamento dei file di vostra sistema e non avete il tempo di modificare manualmente e caricare di nuovo il greylist file.
- Fornisce un modo per permettere a qualcuno diverso da te per controllare la vostra copia di phpMussel senza l'implicita necessità di concedere loro l'accesso a FTP.
- Fornisce un modo per fornire controllato accesso ai log file.
- Fornisce un semplice modo per aggiornare phpMussel quando sono aggiornamenti disponibili.
- Fornisce un modo per monitorare phpMussel quando l'accesso a FTP o altri convenzionali punti di accesso per il monitoraggio di phpMussel non sono disponibili.

Un paio di motivi per cui si dovrebbe _**NON**_ abilita questi controlli:
- Fornisce un vettore per i potenziali aggressori e indesiderabili per determinare se si sta utilizzando phpMussel o non (sebbene, questo potrebbe essere sia un ragione per e una ragione contro, dipendente di come si vedono le cose) passando per l'invio ciecamente di comandi ai server come un mezzo per sondare. Da una parte, questo potrebbe scoraggiare gli aggressori dalla mirare di vostra sistema se vengono a sapere che si sta utilizzando phpMussel, supponendo il loro sono sondante perché il loro metodo di attacco è reso inefficace come risultato dell'utilizzo di phpMussel. Ma, d'altra parte, se qualche imprevisto e attualmente sconosciuto sfruttare all'interno phpMussel o una versione futura della stessa viene alla luce, e se potrebbe potenzialmente fornire un vettore di attacco, un positivo risultato da tale sondare potrebbe effettivamente incoraggiare attaccanti per mirante il sistema.
- Se le delegato password erano stati compromessi, se non cambiato, potrebbe fornire un modo per un utente malintenzionato di circonvallazione qualunque firme possono essere altrimenti normalmente impediscono loro attacchi dal successo, o anche potenzialmente disabilita phpMussel del tutto, così fornendo un modo per rendere l'efficacia della phpMussel discutibile.

In entrambi i casi, senza riguardo di ciò che si sceglie, la scelta in definitiva è la vostra. Per predefinita, questi controlli saranno disattivato, ma hanno un pensateci, e se si decidere li vuoi, questa sezione spiega sia come abilitare e come utilizzare queste cose.

Un elenco di disponibili browser lato comandi:

scan_log
- Password requisito: `logs_password`
- Altri requisiti: scan_log deve essere definito.
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?logspword=[logs_password]&phpmussel=scan_kills`
- Cosa fa: Stampi il contenuti del scan_log file sullo vostro schermo.

scan_kills
- Password requisito: `logs_password`
- Altri requisiti: scan_kills deve essere definito.
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?logspword=[logs_password]&phpmussel=scan_kills`
- Cosa fa: Stampi il contenuti del scan_kills file sullo vostro schermo.

controls_lockout
- Password requisito: `logs_password` O `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Esempio 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Cosa fa: Disabilita/blocca tutti le browser lato controlli. Questo dovrebbe essere usato se si sospetta che una o più delle vostre password sono stato compromesso (questo può accadere se si sta utilizzando questi controlli da un computer che non è protetto o fidato). controls_lockout opere tramite creando un file, `controls.lck`, nelle vostre vault, che phpMussel sarà verifica per prima di eseguire qualsiasi comando di qualsiasi tipo. Quando questo accade, per riabilitarla i controlli, è necessario per vostre di manualmente eliminare il `controls.lck` file via FTP o simile. Può essere chiamato utilizzando qualsiasi delle password.

disable
- Password requisito: `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=disable`
- Cosa fa: Disabilita phpMussel. Questo dovrebbe essere utilizzato se si sta eseguendo qualsiasi aggiornamenti o modifiche al vostra sistema o se si sta installando nuovo software o dei moduli al vostra sistema che fare o potenzialmente potrebbe innescare falsi positivi. Questo anche dovrebbe essere utilizzato se si hanno qualsiasi problemi con phpMussel ma non vogliono rimuoverlo dal vostra sistema. Quando questo accade, per riabilitare phpMussel, utilizzare "enable".

enable
- Password requisito: `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=enable`
- Cosa fa: Abilita phpMussel. Questo dovrebbe essere usato se in precedenza vostra ha disattivato phpMussel con "disable" e vogliono riabilitarla.

update
- Password requisito: `script_password`
- Altri requisiti: `update.dat` e `update.inc` deve esistere.
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=update`
- Cosa fa: Verifica la presenza di aggiornamenti sia per phpMussel e le sue firme. Se l'aggiornamento verificare è successo e aggiornamenti sono trovano, sarà tenterà per scaricare e installare gli aggiornamenti. Se l'aggiornamento verificare fallisce, l'aggiornamento sarà abortito. Risultati dell'intero processo sono stampati sullo schermo. Mi raccomando di fare l'aggiornamento verificare almeno una volta al mese per garantire le vostre firme e la vostra copia di phpMussel sono aggiornato all'ultimo edizioni (a meno, ovviamente, si fare l'aggiornamento verificare e fare l'installazione di manualmente, di cui, mi piacerebbe ancora consiglio di fare almeno una volta al mese). Verifica più di due volte al mese è probabilmente inutile, considerando sto molto improbabile essere grado per produzione qualsiasi aggiornamenti di qualsiasi tipo più spesso di quello (né faccio in modo particolare voglio per la maggior parte).

greylist
- Password requisito: `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: [Nome della firma essere sulla greylist]
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=greylist&musselvar=[Firma]`
- Cosa fa: Aggiungere una firma alla greylist.

greylist_clear
- Password requisito: `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=greylist_clear`
- Cosa fa: Cancella l'intera greylist.

greylist_show
- Password requisito: `script_password`
- Altri requisiti: (nessuno)
- Parametri requisiti: (nessuno)
- Parametri opzionali: (nessuno)
- Esempio: `?pword=[script_password]&phpmussel=greylist_show`
- Cosa fa: Consente di stampare il contenuto della greylist sullo schermo.

---


###4B. <a name="SECTION4B"></a>CLI (COMANDO LINEA INTERFACCIA)

phpMussel può essere eseguito come uno interattivo file scanner in CLI modalità da Windows. Fare riferimento alla "COME INSTALLARE (PER CLI)" sezione di questo README file per maggiori dettagli.

Per un elenco di comandi disponibili all'interno CLI , al CLI prompt, tipo 'c', e premere Enter.

---


###5. <a name="SECTION5"></a>FILE INCLUSI IN QUESTO PACCHETTO

Il seguente è un elenco di tutti i file che dovrebbero essere incluso nella archiviato copia di questo script quando si scaricalo, qualsiasi di file che potrebbero potenzialmente essere creato come risultato della vostra utilizzando questo script, insieme con una breve descrizione di ciò che tutti questi file sono per.

File | Descrizione
----|----
/.gitattributes | Un file del GitHub progetto (non richiesto per il corretto funzionamento dello script).
/composer.json | Composer/Packagist informazioni (non richiesto per il corretto funzionamento dello script).
/CONTRIBUTING.md | Informazioni su come contribuire al progetto.
/LICENSE.txt | Una copia della GNU/GPLv2 licenza.
/PEOPLE.md | Informazioni sulle persone coinvolte nel progetto.
/phpmussel.php | Caricatore (carica lo principale script, l'aggiornamento script, eccetera). Questo è il file si collegare alla vostra sistema (essenziale)!
/README.md | Informazioni di riepilogo del progetto.
/web.config | Un ASP.NET configurazione file (in questo caso, a proteggere la `/vault` cartella da l'acceso di non autorizzate origini nel caso che lo script è installato su un server basata su ASP.NET tecnologie).
/_docs/ | Documentazione cartella (contiene vari file).
/_docs/change_log.txt | Un record delle modifiche apportate allo script tra diverse versioni (non richiesto per il corretto funzionamento dello script).
/_docs/readme.ar.md | Arabo documentazione.
/_docs/readme.de.md | Tedesco documentazione.
/_docs/readme.de.txt | Tedesco documentazione.
/_docs/readme.en.md | Inglese documentazione.
/_docs/readme.en.txt | Inglese documentazione.
/_docs/readme.es.md | Spagnolo documentazione.
/_docs/readme.es.txt | Spagnolo documentazione.
/_docs/readme.fr.md | Francese documentazione.
/_docs/readme.fr.txt | Francese documentazione.
/_docs/readme.id.md | Indonesiano documentazione.
/_docs/readme.id.txt | Indonesiano documentazione.
/_docs/readme.it.md | Italiano documentazione.
/_docs/readme.it.txt | Italiano documentazione.
/_docs/readme.nl.md | Olandese documentazione.
/_docs/readme.nl.txt | Olandese documentazione.
/_docs/readme.pt.md | Portoghese documentazione.
/_docs/readme.pt.txt | Portoghese documentazione.
/_docs/readme.ru.md | Russo documentazione.
/_docs/readme.ru.txt | Russo documentazione.
/_docs/readme.vi.md | Vietnamita documentazione.
/_docs/readme.vi.txt | Vietnamita documentazione.
/_docs/readme.zh-TW.md | Cinese (Tradizionale) documentazione.
/_docs/readme.zh.md | Cinese (Semplificato) documentazione.
/_docs/signatures_tally.txt | Conteggio delle firme incluso (non richiesto per il corretto funzionamento dello script).
/_testfiles/ | Test file cartella (contiene vari file). Tutti i file contenuti sono test file per la verifica se phpMussel è installato correttamente sulla vostra sistema, e non è necessario a caricare questa cartella o qualsiasi dei suoi file, tranne quando fa tali test.
/_testfiles/ascii_standard_testfile.txt | Test file per test di phpMussel normalizzati ASCII firme.
/_testfiles/coex_testfile.rtf | Test file per test di phpMussel complesso esteso firme.
/_testfiles/exe_standard_testfile.exe | Test file per test di phpMussel PE firme.
/_testfiles/general_standard_testfile.txt | Test file per test di phpMussel generale firme.
/_testfiles/graphics_standard_testfile.gif | Test file per test di phpMussel grafica firme.
/_testfiles/html_standard_testfile.html | Test file per test di phpMussel normalizzati HTML firme.
/_testfiles/md5_testfile.txt | Test file per test di phpMussel MD5 firme.
/_testfiles/metadata_testfile.tar | Test file per test di phpMussel metadata firme e per testare TAR file supporto sullo vostro sistema.
/_testfiles/metadata_testfile.txt.gz | Test file per test di phpMussel metadata firme e per testare GZ file supporto sullo vostro sistema.
/_testfiles/metadata_testfile.zip | Test file per test di phpMussel metadata firme e per testare ZIP file supporto sullo vostro sistema.
/_testfiles/ole_testfile.ole | Test file per test di phpMussel OLE firme.
/_testfiles/pdf_standard_testfile.pdf | Test file per test di phpMussel PDF firme.
/_testfiles/pe_sectional_testfile.exe | Test file per test di phpMussel PE Sezionale firme.
/_testfiles/swf_standard_testfile.swf | Test file per test di phpMussel SWF firme.
/_testfiles/xdp_standard_testfile.xdp | Test file per test di phpMussel XML/XDP firme.
/vault/ | La vault cartella (contiene vari file).
/vault/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/cache/ | La cartella della cache (per i dati temporanei).
/vault/cache/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/cli.inc | Gestore di CLI.
/vault/config.inc | Gestore di configurazione.
/vault/controls.inc | Gestore dei controlli.
/vault/functions.inc | File di funzioni.
/vault/greylist.csv | CSV di firme indicando per phpMussel cui firme dovrebbero essere ignorato (il file sarà ricreato automaticamente se è cancellato).
/vault/lang.inc | Linguistici dati.
/vault/lang/ | Contiene linguistici dati.
/vault/lang/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/lang/lang.ar.inc | Linguistici dati Araba.
/vault/lang/lang.de.inc | Linguistici dati Tedesca.
/vault/lang/lang.en.inc | Linguistici dati Inglese.
/vault/lang/lang.es.inc | Linguistici dati Spagnola.
/vault/lang/lang.fr.inc | Linguistici dati Francese.
/vault/lang/lang.id.inc | Linguistici dati Indonesiana.
/vault/lang/lang.it.inc | Linguistici dati Italiana.
/vault/lang/lang.ja.inc | Linguistici dati Giapponese.
/vault/lang/lang.nl.inc | Linguistici dati Olandese.
/vault/lang/lang.pt.inc | Linguistici dati Portoghese.
/vault/lang/lang.ru.inc | Linguistici dati Russa.
/vault/lang/lang.vi.inc | Linguistici dati Vietnamita.
/vault/lang/lang.zh-TW.inc | Linguistici dati Cinese (Tradizionale).
/vault/lang/lang.zh.inc | Linguistici dati Cinese (Semplificata).
/vault/phpmussel.ini | Configurazione file; Contiene tutte l'opzioni di configurazione per phpMussel, dicendogli cosa fare e come operare correttamente (essenziale)!
/vault/quarantine/ | Quarantena cartella (contiene i file in quarantena).
/vault/quarantine/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
※ /vault/scan_kills.txt | Un record di tutti i file bloccati/uccisi da phpMussel.
※ /vault/scan_log.txt | Un record di tutto scansionato da phpMussel.
※ /vault/scan_log_serialized.txt | Un record di tutto scansionato da phpMussel.
/vault/signatures/ | Firme cartella (contiene i file di firme).
/vault/signatures/.htaccess | Un ipertesto accesso file (in questo caso, a proteggere di riservati file appartenente allo script da l'acceso di non autorizzate origini).
/vault/signatures/ascii_clamav_regex.cvd | File per le normalizzati ASCII firme.
/vault/signatures/ascii_clamav_regex.map | File per le normalizzati ASCII firme.
/vault/signatures/ascii_clamav_standard.cvd | File per le normalizzati ASCII firme.
/vault/signatures/ascii_clamav_standard.map | File per le normalizzati ASCII firme.
/vault/signatures/ascii_custom_regex.cvd | File per le normalizzati ASCII firme.
/vault/signatures/ascii_custom_standard.cvd | File per le normalizzati ASCII firme.
/vault/signatures/ascii_mussel_regex.cvd | File per le normalizzati ASCII firme.
/vault/signatures/ascii_mussel_standard.cvd | File per le normalizzati ASCII firme.
/vault/signatures/coex_clamav.cvd | File per il complesso esteso firme.
/vault/signatures/coex_custom.cvd | File per il complesso esteso firme.
/vault/signatures/coex_mussel.cvd | File per il complesso esteso firme.
/vault/signatures/elf_clamav_regex.cvd | File per l'ELF firme.
/vault/signatures/elf_clamav_regex.map | File per l'ELF firme.
/vault/signatures/elf_clamav_standard.cvd | File per l'ELF firme.
/vault/signatures/elf_clamav_standard.map | File per l'ELF firme.
/vault/signatures/elf_custom_regex.cvd | File per l'ELF firme.
/vault/signatures/elf_custom_standard.cvd | File per l'ELF firme.
/vault/signatures/elf_mussel_regex.cvd | File per l'ELF firme.
/vault/signatures/elf_mussel_standard.cvd | File per l'ELF firme.
/vault/signatures/exe_clamav_regex.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_clamav_regex.map | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_clamav_standard.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_clamav_standard.map | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_custom_regex.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_custom_standard.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_mussel_regex.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/exe_mussel_standard.cvd | File per PE (Portatile Eseguibile) firme.
/vault/signatures/filenames_clamav.cvd | File per le file nomi firme.
/vault/signatures/filenames_custom.cvd | File per le file nomi firme.
/vault/signatures/filenames_mussel.cvd | File per le file nomi firme.
/vault/signatures/general_clamav_regex.cvd | File per generali firme.
/vault/signatures/general_clamav_regex.map | File per generali firme.
/vault/signatures/general_clamav_standard.cvd | File per generali firme.
/vault/signatures/general_clamav_standard.map | File per generali firme.
/vault/signatures/general_custom_regex.cvd | File per generali firme.
/vault/signatures/general_custom_standard.cvd | File per generali firme.
/vault/signatures/general_mussel_regex.cvd | File per generali firme.
/vault/signatures/general_mussel_standard.cvd | File per generali firme.
/vault/signatures/graphics_clamav_regex.cvd | File per grafica firme.
/vault/signatures/graphics_clamav_regex.map | File per grafica firme.
/vault/signatures/graphics_clamav_standard.cvd | File per grafica firme.
/vault/signatures/graphics_clamav_standard.map | File per grafica firme.
/vault/signatures/graphics_custom_regex.cvd | File per grafica firme.
/vault/signatures/graphics_custom_standard.cvd | File per grafica firme.
/vault/signatures/graphics_mussel_regex.cvd | File per grafica firme.
/vault/signatures/graphics_mussel_standard.cvd | File per grafica firme.
/vault/signatures/hex_general_commands.csv | Hex-codificata CSV di generale comando rilevazioni opzionalmente utilizzati da phpMussel.
/vault/signatures/html_clamav_regex.cvd | File per le normalizzati HTML firme.
/vault/signatures/html_clamav_regex.map | File per le normalizzati HTML firme.
/vault/signatures/html_clamav_standard.cvd | File per le normalizzati HTML firme.
/vault/signatures/html_clamav_standard.map | File per le normalizzati HTML firme.
/vault/signatures/html_custom_regex.cvd | File per le normalizzati HTML firme.
/vault/signatures/html_custom_standard.cvd | File per le normalizzati HTML firme.
/vault/signatures/html_mussel_regex.cvd | File per le normalizzati HTML firme.
/vault/signatures/html_mussel_standard.cvd | File per le normalizzati HTML firme.
/vault/signatures/macho_clamav_regex.cvd | File per Mach-O firme.
/vault/signatures/macho_clamav_regex.map | File per Mach-O firme.
/vault/signatures/macho_clamav_standard.cvd | File per Mach-O firme.
/vault/signatures/macho_clamav_standard.map | File per Mach-O firme.
/vault/signatures/macho_custom_regex.cvd | File per Mach-O firme.
/vault/signatures/macho_custom_standard.cvd | File per Mach-O firme.
/vault/signatures/macho_mussel_regex.cvd | File per Mach-O firme.
/vault/signatures/macho_mussel_standard.cvd | File per Mach-O firme.
/vault/signatures/mail_clamav_regex.cvd | File per mail firme.
/vault/signatures/mail_clamav_regex.map | File per mail firme.
/vault/signatures/mail_clamav_standard.cvd | File per mail firme.
/vault/signatures/mail_clamav_standard.map | File per mail firme.
/vault/signatures/mail_custom_regex.cvd | File per mail firme.
/vault/signatures/mail_custom_standard.cvd | File per mail firme.
/vault/signatures/mail_mussel_regex.cvd | File per mail firme.
/vault/signatures/mail_mussel_standard.cvd | File per mail firme.
/vault/signatures/md5_clamav.cvd | File per l'MD5 basate firme.
/vault/signatures/md5_custom.cvd | File per l'MD5 basate firme.
/vault/signatures/md5_mussel.cvd | File per l'MD5 basate firme.
/vault/signatures/metadata_clamav.cvd | File per l'archivio metadati firme.
/vault/signatures/metadata_custom.cvd | File per l'archivio metadati firme.
/vault/signatures/metadata_mussel.cvd | File per l'archivio metadati firme.
/vault/signatures/ole_clamav_regex.cvd | File per OLE firme.
/vault/signatures/ole_clamav_regex.map | File per OLE firme.
/vault/signatures/ole_clamav_standard.cvd | File per OLE firme.
/vault/signatures/ole_clamav_standard.map | File per OLE firme.
/vault/signatures/ole_custom_regex.cvd | File per OLE firme.
/vault/signatures/ole_custom_standard.cvd | File per OLE firme.
/vault/signatures/ole_mussel_regex.cvd | File per OLE firme.
/vault/signatures/ole_mussel_standard.cvd | File per OLE firme.
/vault/signatures/pdf_clamav_regex.cvd | File per PDF firme.
/vault/signatures/pdf_clamav_regex.map | File per PDF firme.
/vault/signatures/pdf_clamav_standard.cvd | File per PDF firme.
/vault/signatures/pdf_clamav_standard.map | File per PDF firme.
/vault/signatures/pdf_custom_regex.cvd | File per PDF firme.
/vault/signatures/pdf_custom_standard.cvd | File per PDF firme.
/vault/signatures/pdf_mussel_regex.cvd | File per PDF firme.
/vault/signatures/pdf_mussel_standard.cvd | File per PDF firme.
/vault/signatures/pex_custom.cvd | File per PE esteso firme.
/vault/signatures/pex_mussel.cvd | File per PE esteso firme.
/vault/signatures/pe_clamav.cvd | File per PE Sezionale firme.
/vault/signatures/pe_custom.cvd | File per PE Sezionale firme.
/vault/signatures/pe_mussel.cvd | File per PE Sezionale firme.
/vault/signatures/swf_clamav_regex.cvd | File per Shockwave firme.
/vault/signatures/swf_clamav_regex.map | File per Shockwave firme.
/vault/signatures/swf_clamav_standard.cvd | File per Shockwave firme.
/vault/signatures/swf_clamav_standard.map | File per Shockwave firme.
/vault/signatures/swf_custom_regex.cvd | File per Shockwave firme.
/vault/signatures/swf_custom_standard.cvd | File per Shockwave firme.
/vault/signatures/swf_mussel_regex.cvd | File per Shockwave firme.
/vault/signatures/swf_mussel_standard.cvd | File per Shockwave firme.
/vault/signatures/switch.dat | Questo controlla e imposta alcune variabili.
/vault/signatures/urlscanner.cvd | File per firme di l'URL scanner.
/vault/signatures/whitelist_clamav.cvd | File specifico whitelist.
/vault/signatures/whitelist_custom.cvd | File specifico whitelist.
/vault/signatures/whitelist_mussel.cvd | File specifico whitelist.
/vault/signatures/xmlxdp_clamav_regex.cvd | File per XML/XDP firme.
/vault/signatures/xmlxdp_clamav_regex.map | File per XML/XDP firme.
/vault/signatures/xmlxdp_clamav_standard.cvd | File per XML/XDP firme.
/vault/signatures/xmlxdp_clamav_standard.map | File per XML/XDP firme.
/vault/signatures/xmlxdp_custom_regex.cvd | File per XML/XDP firme.
/vault/signatures/xmlxdp_custom_standard.cvd | File per XML/XDP firme.
/vault/signatures/xmlxdp_mussel_regex.cvd | File per XML/XDP firme.
/vault/signatures/xmlxdp_mussel_standard.cvd | File per XML/XDP firme.
/vault/template.html | Template file; Template per l'HTML output prodotto da phpMussel per il suo messaggio di bloccato file caricamento (il messaggio visto dallo caricatore).
/vault/template_custom.html | Template file; Template per l'HTML output prodotto da phpMussel per il suo messaggio di bloccato file caricamento (il messaggio visto dallo caricatore).
/vault/update.dat | File contenente informazioni sulla versione sia di phpMussel e le phpMussel firme. Se si desidero automaticamente aggiornare di phpMussel o si desidero l'aggiornare di phpMussel tramite il browser, questo file è essenziale.
/vault/update.inc | Aggiornare Script; Richiesto per l'automatico aggiornare di phpMussel e per l'aggiornare di phpMussel tramite il browser, ma non richiesto altrimenti.
/vault/upload.inc | Gestore di caricamenti.

※ Nome del file può variare dipendente di configurazione (in `phpmussel.ini`).

####*IN RIGUARDA PER FIRME FILE*
CVD è l'acronimo di "ClamAV Virus Definitions", in riferimento sia come ClamAV riferisce alle proprie firme e all'uso di tali firme da phpMussel; I file che terminano con "CVD" contengono firme.

I file che terminano con "MAP", letteralmente, mappa cui delle firme phpMussel dovrebbe e non dovrebbe usare per individuale scansioni; Non tutte le firme sono necessariamente richiesti per ogni singola scansione, così, phpMussel utilizza mappe delle firme file a accelerare il processo di scansione (un processo che sarebbe altrimenti essere estremamente lento e noioso).

Firma file contrassegnati con "_regex" contengono le firme che utilizzano regolari espressioni (regex) modello verifica.

Firma file contrassegnati con "_standard" contengono le firme che specificamente non utilizzano qualsiasi forma di modello verifica.

Firma file contrassegnati con né "_regex" o "_Standard" sarà come uno o l'altro, Ma non entrambi (fare riferimento alla Firma Formato sezione di questo README file per documentazione e specifici dettagli).

Firma file contrassegnati con "_clamav" contengono le firme che esclusivamente forniti dal ClamAV database (GNU/GPL).

Firma file contrassegnati con "_custom", per predefinita, contengono non firme; Questi tali file esistono a darvi un posto dove inserire le vostre personalizzate firme, se si arriva con qualsiasi.

Firma file contrassegnati con "_mussel" contengono le firme che in particolare non sono forniti da ClamAV, firme che, in generale, l'ho venire con me stesso e/o sulla base di informazioni raccolte da varie fonti.

---


###6. <a name="SECTION6"></a>OPZIONI DI CONFIGURAZIONE
Il seguente è un elenco di variabili trovate nelle `phpmussel.ini` configurazione file di phpMussel, insieme con una descrizione del loro scopo e funzione.

####"general" (Categoria)
Generale configurazione per phpMussel.

"script_password"
- Per conveniance, phpMussel permette alcune funzioni (per esempio, l'aggiornare di phpMussel tramite il browser) essere innescato manualmente tramite POST, GET e QUERY. Ma, come precauzione di sicurezza, per fare questo, phpMussel aspetta una password essere incluso con il comando, al fine per garantire che sia tu, e non qualcun altro, tentando per manualmente attivare queste funzioni. Impostare `script_password` a qualunque password che si desidera utilizzare. Se non alcuna password è impostata, Manuale innescando sarà disattivato per predefinita. Usa qualcosa si ricorda, Ma che è difficile per indovinare d'altrui.
- Non ha alcuna influenza in CLI modalità.

"logs_password"
- Stesso come `script_password`, ma per la visualizzazione dei contenuti di scan_log e scan_kills. Avendo separate password può essere utile se si vuole dare l'accesso a qualcun altro a una serie di funzioni ma non l'altro.
- Non ha alcuna influenza in CLI modalità.

"cleanup"
- Disimpostare le script variabili e la cache dopo l'esecuzione? False = No; True = Sì [Predefinito]. Se si non utilizza lo script dopo l'iniziale scansione di caricamenti, dovrebbe impostato a `true` (sì), per minimizzare la memoria uso. Se si fa utilizza lo script dopo l'iniziale scansione di caricamenti, dovrebbe impostato a `false` (no), al fine per evitare ricaricare inutili duplicati dati all'interno memoria. In generale pratica, dovrebbe probabilmente essere impostata a `true` (sì), ma, se si farlo, voi sarà non in grado per utilizzare lo script per scopi diversi dalla scansione di caricamenti.
- Non ha alcuna influenza in CLI modalità.

"scan_log"
- Il nome del file per registrare tutti i risultati di la scansione. Specificare un nome del file, o lasciare vuoto per disattivarlo.

"scan_log_serialized"
- Il nome del file per registrare tutti i risultati di la scansione (utilizzando un formato serializzato). Specificare un nome del file, o lasciare vuoto per disattivarlo.

"scan_kills"
- Il nome del file per registrare tutti i record di bloccato o ucciso caricamenti. Specificare un nome del file, o lasciare vuoto per disattivarlo.

"ipaddr"
- Dove trovare l'IP indirizzo di collegamento richiesta? (Utile per servizi come Cloudflare e simili) Predefinito = REMOTE_ADDR. AVVISO: Non modificare questa se non sai quello che stai facendo!

"forbid_on_block"
- phpMussel dovrebbe inviare 403 intestazioni con il file caricamente bloccato messaggio, o tenere con il solito 200 OK? False = No (200) [Predefinito]; True = Sì (403).

"delete_on_sight"
- Abilitando questa opzione sarà istruirà lo script per tentare immediatamente eliminare qualsiasi file trovato durante scansioni che corrisponde a qualsiasi i criteri di rilevazione, attraverso le firme o altrimenti. I file determinati ad essere "pulito" non verranno toccati. Nel caso degli archivi, l'intero archivio verrà eliminato (indipendentemente se il file all'origine è soltanto uno dei vari file contenuti all'interno dell'archivio o non). Nel caso di file caricamente scansione, solitamente, non è necessario attivare questa opzione, perché solitamente, PHP sarà automaticamente eliminerà il contenuto della cache quando l'esecuzione è terminata, il che significa che lo farà solitamente eliminare tutti i file caricati tramite al server tranne ciò che già è spostato, copiato o cancellato. L'opzione viene aggiunto qui come ulteriore misura di sicurezza per coloro le cui copie di PHP non sempre comportarsi nel previsto modo. False = Dopo la scansione, lasciare il file solo [Predefinito]; True = Dopo la scansione, se non pulite, immediatamente eliminarlo.

"lang"
- Specifica la lingua predefinita per phpMussel.

"lang_override"
- Specifica se phpMussel dovrebbe, ove possibile, sostituire la lingua specificazione con la lingua preferenza dichiarato da richieste in entrata (HTTP_ACCEPT_LANGUAGE). False = No [Predefinito]; True = Sì.

"lang_acceptable"
- La `lang_acceptable` direttiva indica per phpMussel quali lingue può essere accettato dallo script da `lang` o da `HTTP_ACCEPT_LANGUAGE`. La direttiva dovrebbe essere modificato **SOLO** se si aggiunge i propri personalizzati lingua file o rimuovere con forza di lingua file. La direttiva è una stringa delimitata da virgole dei codici utilizzati da tali lingue accettate dallo script.

"quarantine_key"
- phpMussel è capace di mettere in quarantena contrassegnati tentati file caricamenti in isolamento all'interno della phpMussel vault, se questo è qualcosa che si vuole fare. L'ordinario utenti di phpMussel che semplicemente desiderano proteggere i loro website o hosting environment senza avendo profondo interesse ad analizzare qualsiasi contrassegnati tentati file caricamenti dovrebbe lasciare questa funzionalità disattivata, ma tutti gli utenti interessati ad ulteriori analisi di contrassegnati tentati file caricamenti per la ricerca di malware o per simili cose dovrebbe attivare questa funzionalità. Quarantena di contrassegnati tentati file caricamenti a volte può aiutare anche in debug falsi positivi, se questo è qualcosa che si accade di frequente per voi. Per disattivare la funzionalità di quarantena, lasciare vuota la direttiva `quarantine_key`, o cancellare i contenuti di tale direttiva, se non già è vuoto. Per abilita la funzionalità di quarantena, immettere alcun valore nella direttiva. Il `quarantine_key` è un importante aspetto di sicurezza della funzionalità di quarantena richiesto come un mezzo per prevenire la funzionalità di quarantena di essere sfruttati da potenziali aggressori e come mezzo per prevenire potenziale esecuzione di dati memorizzati all'interno della quarantena. Il `quarantine_key` dovrebbe essere trattato nello stesso modo come le password: Più lunga è la migliore, e proteggila ermeticamente. Per la migliore effetto, utilizzare in combinazione con `delete_on_sight`.

"quarantine_max_filesize"
- La massima permesso dimensione del file dei file essere quarantena. File di dimensioni superiori questo valore NON verranno quarantena. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la tua quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul tuo hosting servizio. Il valore è in KB. Predefinito =2048 =2048KB =2MB.

"quarantine_max_usage"
- La massima permesso utilizzo della memoria per la quarantena. Se la totale memoria utilizzata dalla quarantena raggiunge questo valore, i più vecchi file in quarantena vengono eliminati fino a quando la totale memoria utilizzata non raggiunge questo valore. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la tua quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul tuo hosting servizio. Il valore è in KB. Predefinito =65536 =65536KB =64MB.

"honeypot_mode"
- Quando la honeypot modalità è abilitata, phpMussel tenterà di mettere in quarantena ogni file caricamenti che esso incontra, indipendentemente di se il file che essere caricato corrisponde d'alcuna incluso firma, e zero reale scansionare o analisi di quei tentati file caricati sarà avvenire. Questa funzionalità dovrebbe essere utile per coloro che desiderano utilizzare phpMussel a fini di virus/malware ricerca, ma non si raccomandato di abilitare questa funzionalità se l'uso previsto de phpMussel da parte dell'utente è per l'effettivo scansione dei file caricamenti né raccomandato di utilizzare la funzionalità di honeypot per fini diversi da l'uso de honeypot. Da predefinita, questo opzione è disattivato. False = Disattivato [Predefinito]; True = Attivato.

"scan_cache_expiry"
- Per quanto tempo deve phpMussel cache i risultati della scansione? Il valore è il numero di secondi per memorizzare nella cache i risultati della scansione per. Predefinito valore è 21600 secondi (6 ore); Un valore pari a 0 disabilita il caching dei risultati di scansione.

"disable_cli"
- Disabilita CLI? Modalità CLI è abilitato per predefinito, ma a volte può interferire con alcuni strumenti di test (come PHPUnit, per esempio) e altre applicazioni basate su CLI. Se non è necessario disattivare la modalità CLI, si dovrebbe ignorare questa direttiva. False = Abilita CLI [Predefinito]; True = Disabilita CLI.

####"signatures" (Categoria)
Configurazione per firme.
- %%%_clamav = ClamAV firme (sia mains e daily).
- %%%_custom = Le vostre personalizzate firme (se hai scritto qualsiasi).
- %%%_mussel = phpMussel firme inclusi nel corrente set di firme che non è da ClamAV.

Verificare contro MD5 firme durante la scansione? False = No; True = Sì [Predefinito].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Verificare contro generali firme durante la scansione? False = No; True = Sì [Predefinito].
- "general_clamav"
- "general_custom"
- "general_mussel"

Verificare contro normalizzati ASCII firme durante la scansione? False = No; True = Sì [Predefinito].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Verificare contro normalizzati HTML firme durante la scansione? False = No; True = Sì [Predefinito].
- "html_clamav"
- "html_custom"
- "html_mussel"

Verificare PE (Portatile Eseguibile) file (EXE, DLL, ecc) contro PE Sezionale firme durante la scansione? False = No; True = Sì [Predefinito].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Verificare PE (Portatile Eseguibile) file (EXE, DLL, ecc) contro PE esteso firme durante la scansione? False = No; True = Sì [Predefinito].
- "pex_custom"
- "pex_mussel"

Verificare PE (Portatile Eseguibile) file (EXE, DLL, ecc) contro PE firme durante la scansione? False = No; True = Sì [Predefinito].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Verificare ELF file contro ELF firme durante la scansione? False = No; True = Sì [Predefinito].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Verificare Mach-O file (OSX, ecc) contro Mach-O firme durante la scansione? False = No; True = Sì [Predefinito].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Verificare grafica file contro grafica basato firme durante la scansione? False = No; True = Sì [Predefinito].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Verificare il contenuto dell'archivio contro archivio metadati firme durante la scansione? False = No; True = Sì [Predefinito].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Verificare OLE oggetti contro OLE firme durante la scansione? False = No; True = Sì [Predefinito].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Verificare nomi del file contro file nome basate firme durante la scansione? False = No; True = Sì [Predefinito].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Permettere scansione con phpMussel_mail()? False = No; True = Sì [Predefinito].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Abilita file-specifico whitelist? False = No; True = Sì [Predefinito].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Verificare XML/XDP pezzi contro XML/XDP firme durante la scansione? False = No; True = Sì [Predefinito].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Verificare contro complesso esteso firme durante la scansione? False = No; True = Sì [Predefinito].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Verificare contro PDF firme durante la scansione? False = No; True = Sì [Predefinito].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Verificare contro Shockwave firme durante la scansione? False = No; True = Sì [Predefinito].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Firma lunghezza corrispondenza limitando opzioni. Modificata solo se si sa cosa si sta facendo. SD = Standard firme. RX = PCRE (Perl Compatibile Regolari Espressioni, o "Regex") firme. FN = File nomi firme. Se notate PHP termina fatalmente quando phpMussel tenta per scansione, tenta per abbassare i "max" valori seguito. Se possibile e conveniente, fatemi sapere quando questo accade ei risultati di quello il voi tentò.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Dovrebbe phpMussel rapporto quando le file di firme sono mancanti o danneggiati? Se fail_silently è disattivato, mancanti e danneggiati file saranno riportato sulla scansione, e se fail_silently è abilitato, mancanti e danneggiati file saranno ignorato, con scansione riportando per quei file che non ha sono problemi. Questo dovrebbe essere generalmente lasciata sola a meno che sperimentando inaspettate terminazioni o simili problemi. False = Disattivato; True = Attivato [Predefinito].

"fail_extensions_silently"
- Dovrebbe phpMussel rapporto quando le estensioni sono mancanti? Se fail_extensions_silently è disattivato, mancanti estensioni saranno riportato sulla scansione, e se fail_extensions_silently è abilitato, mancanti estensioni saranno ignorato, con scansione riportando per quei file che non ha sono problemi. La disattivazione di questa direttiva potrebbe potenzialmente aumentare la sicurezza, ma può anche portare ad un aumento di falsi positivi. False = Disattivato; True = Attivato [Predefinito].

"detect_adware"
- Dovrebbe phpMussel utilizzare le firme per il rilevamento di adware? False = No; True = Sì [Predefinito].

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

####"files" (Categoria)
Generale configurazione per la gestione dei file.

"max_uploads"
- Massimo numero di file per analizzare durante il file caricamenti scansione prima le terminazione del scansione e d'informare dell'utente che essi stai caricando troppo in una volta! Fornisce protezione contro un teorico attacco per cui un malintenzionato utente tenta per DDoS vostra sistema o CMS da sovraccaricamento phpMussel rallentare il PHP processo ad un brusco stop. Raccomandato: 10. Si potrebbe desiderare di aumentare o diminuire che numero basato sulla velocità del vostra sistema e hardware. Si noti che questo numero non tiene conto o includere il contenuti degli archivi.

"filesize_limit"
- File dimensione limite in KB. 65536 = 64MB [Predefinito]; 0 = Nessun limite (sempre sul greylist), qualsiasi (positivo) numerico valore accettato. Questo può essere utile quando la configurazione di PHP limita la quantità di memoria che un processo può contenere o se i configurazione ha limitato la dimensione dei file caricamenti.

"filesize_response"
- Cosa fare con i file che superano il file dimensione limite (se esistente). False = Whitelist; True = Blacklist [Predefinito].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Se il vostro sistema permette solo determinati tipi di file per caricamenti, o se il vostra sistema esplicitamente negare determinati tipi di file, specificando i tipi di file nel whitelist, blacklist e/o greylist può aumentare la velocità a cui la scansione viene eseguita da permettendo lo script da ignora alcuni tipi di file. Il formato è CSV (valori separati da virgola). Se si desidera eseguire la scansione tutti, invece del whitelist, blacklist or greylist, lasciare le variabili vuoti; Fare questo sarà disabilitali.
- Logico ordine del trattamento è:
  - Se il tipo di file è nel whitelist, non scansiona e non blocca il file, e non verificare il file contra la blacklist o la greylist.
  - Se il tipo di file è nel blacklist, non scansiona il file ma bloccarlo comunque, e non verificar il file contra la greylist.
  - Se il greylist è vuoto o se il greylist non è vuota e il tipo di file è nel greylist, scansiona il file come per normale e determinare se bloccarlo sulla base dei risultati della scansione, ma se il greylist non è vuoto e il tipo di file non è nel greylist, trattare il file come se è nel blacklist, quindi non scansionarlo ma bloccarlo comunque.

"check_archives"
- Tenta per verifica il contenuti degli archivi? False = No (no verifica); True = Sì (fare verifica) [Predefinito].
- Al momento, solo verifica di BZ, GZ, LZF e ZIP file è supportato (verifica di RAR, CAB, 7z eccetera è supportato al momento).
- Questo non è infallibile! Mentre mi assai raccomando che è attivato, non posso garantire che sarà sempre trovare tutto.
- Anche essere consapevoli che verifica per archivio al momento è non ricorsiva per ZIP.

"filesize_archives"
- Eredita file dimensione limite blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].

"filetype_archives"
- Eredita file tipi blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].

"max_recursion"
- Massimo ricorsione profondità limite per gli archivi. Predefinito = 10.

"block_encrypted_archives"
- Rilevi e blocchi archivi criptati? Perché phpMussel non è in grado di verifica del contenuto degli archivi criptati, è possibile che la archivi criptati può essere usato da un attaccante verifieracome mezzo di tenta di bypassare phpMussel, verificatore anti-virus e altri tali protezioni. Istruire phpMussel di bloccare qualsiasi archivi criptati che si trovato potrebbe potenzialmente contribuire a ridurre il rischio associato a questi tali possibilità. False = No; True = Sì [Predefinito].

####"attack_specific" (Categoria)
Configurazione per specifiche attacco rilevazioni (non basate sulle CVD).

Chameleon attacco rilevamento: False = Disattivato; True = Attivato.

"chameleon_from_php"
- Cercare per PHP magici numeri che non sono riconosciuti PHP file né archivi.

"chameleon_from_exe"
- Cercare per eseguibili magici numeri che non sono riconosciuti eseguibili né archivi e per eseguibili cui non sono corrette.

"chameleon_to_archive"
- Cercare per archivi di cui non sono corrette (Supportato: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Cercare per office documenti di cui non sono corrette (Supportato: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Cercare per immagini file di cui non sono corrette (Supportato: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Cercare per PDF file di cui non sono corrette.

"archive_file_extensions" e "archive_file_extensions_wc"
- Riconosciute archivio file estensioni (formato è CSV; deve solo aggiungere o rimuovere quando problemi apparire; rimozione inutilmente può causare falsi positivi per archivio file, mentre aggiungendo inutilmente saranno essenzialmente whitelist quello che si sta aggiungendo dall'attacco specifico rilevamento; modificare con cautela; anche notare che questo non ha qualsiasi effetto su cui gli archivi possono e non possono essere analizzati dal contenuti livello). La lista, come da predefinito, è i formati utilizzati più comunemente attraverso la maggior parte dei sistemi e CMS, Ma apposta non è necessariamente completo.

"general_commands"
- Cercare contenuti dei file per generali comandi quali `eval()`, `exec()` e `include`? False = No (no verifica) [Predefinito]; True = Sì (fare verifica). Disattivare questa opzione se si intende caricare qualsiasi delle seguenti al vostra sistema o CMS tramite il browser: PHP, JavaScript, HTML, python, perl file e eccetera. Attivare questa opzione se non avete qualsiasi aggiuntivi protezioni sul vostro sistema e non intendono caricare tali file. Se si utilizza qualsiasi aggiuntivi protezione in collaborazione con phpMussel come ZB Block, vi è non necessità di attivare questa opzione, perché la maggior parte di ciò che phpMussel sarà cercare (nel contesto di questa opzione) sono duplicazioni di protezioni che sono già forniti.

"block_control_characters"
- Bloccare tutti i file contenenti i controlli caratteri (eccetto per nuove linee)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Se si sta caricando solo normale testo, quindi si puó attivare questa opzione a fornire additionale protezione al vostro sistema. Ma, se si carica qualcosa di diverso da normale testo, abilitando questo opzione può causare falsi positivi. False = Non bloccare [Predefinito]; True = Bloccare.

"corrupted_exe"
- Corrotto file e parsare errori. False = Ignorarli; True = Bloccarli [Predefinito]. Rilevare e bloccare i potenzialmente corrotti PE (portatile eseguibili) file? Spesso (ma non sempre), quando alcuni aspetti di un PE file sono corrotto o non può essere parsato correttamente, tale può essere indicativo di una virale infezione. I processi utilizzati dalla maggior parte dei antivirus programmi per rilevare i virus all'intero PE file richiedono parsare quei file in certi modi, di cui, se il programmatore di un virus è consapevole di, sarà specificamente provare di prevenire, al fine di abilita loro virus di rimanere inosservato.

"decode_threshold"
- Opzionale limitazione o soglia per la lunghezza dei grezzi dati dove decodificare comandi dovrebbe essere rilevati (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Il valore è un integer che rappresenta la dimensione dei file in KB. Predefinito = 512 (512KB). Un zero o un nullo valore disabilita la soglia (rimuovere tale limitazione basata sulla dimensione dei file).

"scannable_threshold"
- Opzionale limitazione o soglia per la lunghezza dei grezzi dati dove phpMussel è permesso di leggere e scansione (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Il valore è un integer che rappresenta la dimensione dei file in KB. Predefinito = 32768 (32MB). Un zero o un nullo valore disabilita la soglia. In generale, questo valore non dovrebbe essere meno quella media dimensione dei file che si desidera e si aspettano di ricevere al vostro server o al vostro web sito, non dovrebbe essere più di la filesize_limit direttiva, e non dovrebbe essere più di circa un quinto del totale ammissibile allocazione della memoria concesso al PHP tramite il php.ini configurazione file. Questa direttiva esiste per tenta di evitare avendo phpMussel utilizzare troppa memoria (di cui sarebbe impedirebbe di essere capace di completare la file scansione correttamente per i file piú d'una certa dimensione).

####"compatibility" (Categoria)
Compatibilità direttive per phpMussel.

"ignore_upload_errors"
- Questa direttiva dovrebbe generalmente essere SPENTO meno se necessario per la corretta funzionalità del phpMussel sul vostra sistema. Normalmente, quando spento, quando phpMussel rileva la presenza di elementi nella `$_FILES` array(), è tenterà di avviare una scansione dei file che tali elementi rappresentano, e, se tali elementi sono vuoti, phpMussel restituirà un errore messaggio. Questo è un comportamento adeguato per phpMussel. Tuttavia, per alcuni CMS, vuoti elementi nel `$_FILES` può avvenire come conseguenza del naturale comportamento di questi CMS, o errori possono essere segnalati quando non ce ne sono, nel qual caso, il normale comportamento per phpMussel sarà interferire con il normale comportamento di questi CMS. Se una tale situazione avvenire per voi, attivazione di questa opzione SU sarà istruirà phpMussel a non tenta avviare scansioni per tali vuoti elementi, ignorarli quando si trova ea non ritorno qualsiasi errore correlato messaggi, così permettendo proseguimento della pagina richiesta. False = SPENTO/OFF; True = SU/ON.

"only_allow_images"
- Se vi aspettare o intendere solo di permettere le immagini da caricare al vostro sistema o CMS, e se assolutamente non richiedono qualsiasi file diversi da immagini essere caricare per il vostro sistema o CMS, questa direttiva dovrebbe essere SU, ma dovrebbe altrimenti essere SPENTO. Se questa direttiva è SU, che istruirà phpMussel di indiscriminatamente bloccare tutti i caricati file identificati come file non-immagine, senza scansionali. Questo può ridurre il tempo di processo e l'utilizzo della memoria per tentati caricamenti di non-immagine file. False = SPENTO/OFF; True = SU/ON.

####"heuristic" (Categoria)
Euristici direttive per phpMussel.

"threshold"
- Ci sono particolare firme di phpMussel che sono destinato a identificare sospetti e potenzialmente maligno qualità dei file che vengono essere caricati senza in sé identificando i file che vengono essere caricati in particolare ad essere maligno. Questo "threshold" (soglia) valore dice phpMussel cosa che il totale massimo peso di sospetti e potenzialmente maligno qualità dei file che vengono essere caricati che è ammissibile è prima che quei file devono essere contrassegnati come maligno. La definizione di peso in questo contesto è il totale numero di sospetti e potenzialmente maligno qualità identificato. Per predefinito, questo valore viene impostato su 3. Un inferiore valore generalmente sarà risultare di una maggiore presenza di falsi positivi ma una maggior numero di file essere contrassegnato come maligno, mentre una maggiore valore generalmente sarà risultare di un inferiore presenza di falsi positivi ma un inferiore numero di file essere contrassegnato come maligno. È generalmente meglio di lasciare questo valore a suo predefinito a meno che si incontrare problemi ad esso correlati.

####"virustotal" (Categoria)
Configurazione per Virus Total integrazione.

"vt_public_api_key"
- Facoltativamente, phpMussel è in grado di scansionare dei file utilizzando il Virus Total API come un modo per fornire un notevolmente migliorato livello di protezione contro virus, trojan, malware e altre minacce. Per predefinita, la scansionare dei file utilizzando il Virus Total API è disattivato. Per abilitarlo, an API key from Virus Total is required. A causa del significativo vantaggio che questo potrebbe fornire a voi, è qualcosa che consiglio vivamente di attivare. Si prega di notare, tuttavia, che per utilizzare il Virus Total API, è necessario d'accettare i Termini di Servizio (Terms of Service) e rispettare tutte le orientamenti descritto nella documentazione di Virus Total! Tu NON sei autorizzato a utilizzare questa funzionalità TRANNE SE:
  - Hai letto e accettato i Termini di Servizio (Terms of Service) di Virus Total e le sue API. I Termini di Servizio di Virus Total e le sue API può essere trovato [Qui](https://www.virustotal.com/en/about/terms-of-service/).
  - Hai letto e si capisce, come minimo, il preambolo del Virus Total Pubblica API documentazione (tutto dopo "VirusTotal Public API v2.0" ma prima "Contents"). La Virus Total Pubblica API documentazione può essere trovato [Qui](https://www.virustotal.com/en/documentation/public-api/).

Notare: Se scansionare dei file utilizzando il Virus Total API è disattivato, non avrete bisogno di rivedere qualsiasi delle direttive in questa categoria (`virustotal`), perché nessuno di loro farà una cosa se questo è disattivato. Per acquisire un Virus Total API chiave, dal ovunque sul loro website, clicca il "Join our Community" link situato in alto destra della pagina, immettere le informazioni richieste, e clicca "Sign up" quando hai finito. Seguite tutte le istruzioni fornite, e quando hai la tua pubblica API chiave, copia/incolla la pubblica API chiave per la `vt_public_api_key` direttiva del `phpmussel.ini` configurazione file.

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

####"urlscanner" (Categoria)
Configurazione per l'URL scanner.

"urlscanner"
- Costruito in phpMussel è un URL scanner, in grado di rilevare URL malevoli all'interno di dati ei file scansionati. Per abilitare l'URL scanner, imposta la `urlscanner` direttiva su true; Per disabilitarlo, imposta questa direttiva su false.

Notare: Se l'URL scanner è disabilitato, non sarà necessario rivedere nessuna delle direttive in questa categoria (`urlscanner`), perché nessuno di loro farà nulla se questo è disabilitato.

API configurazione per l'URL scanner.

"lookup_hphosts"
- Abilita API richieste per l'API di [hpHosts](http://hosts-file.net/) quando impostato su true. hpHosts non richiede un API chiave per l'esecuzione di API richieste.

"google_api_key"
- Abilita API richieste per l'API di Google Safe Browsing quando le API chiave necessarie è definito. L'API di Google Safe Browsing richiede un API chiave, che può essere ottenuto da [Qui](https://console.developers.google.com/).
- Notare: Questa è una caratteristica futuro! Google Safe Browsing API funzionalità non completato a quest'ora!

"maximum_api_lookups"
- Numero massimo di richieste per l'API di eseguire per iterazione di scansione individuo. Perché ogni richiesta supplementare per l'API farà aggiungere al tempo totale necessario per completare ogni iterazione di scansione, si potrebbe desiderare di stipulare una limitazione al fine di accelerare il processo di scansione. Quando è impostato su 0, no tale ammissibile numero massimo sarà applicata. Impostato su 10 per impostazione predefinite.

"maximum_api_lookups_response"
- Cosa fare se il ammissibile numero massimo di richieste per l'API è superato? False = Fare nulla (continuare il processo) [Predefinito]; True = Segnare/bloccare il file.

"cache_time"
- Per quanto tempo (in secondi) dovrebbe i risultati delle API richieste essere memorizzati nella cache per? Predefinito è 3600 secondi (1 ora).

####"template_data" (Categoria)
Direttive/Variabili per modelli e temi.

Modelli dati riferisce alla prodotti HTML utilizzato per generare il "Caricamento Negato" messaggio visualizzati agli utenti quando file caricamenti sono bloccati. Se stai usando temi personalizzati per phpMussel, prodotti HTML è provenienti da file `template_custom.html`, e altrimenti, prodotti HTML è provenienti da file `template.html`. Variabili scritte a questa sezione della configurazione file sono parsato per il prodotti HTML per mezzo di sostituendo tutti i nomi di variabili circondati da parentesi graffe trovato all'interno il prodotti HTML con la corrispondente dati di quelli variabili. Per esempio, dove `foo="bar"`, qualsiasi istanza di `<p>{foo}</p>` trovato all'interno il prodotti HTML diventerà `<p>bar</p>`.

"css_url"
- Il modello file per i temi personalizzati utilizzi esterni CSS proprietà, mentre il modello file per i temi personalizzati utilizzi interni CSS proprietà. Per istruire phpMussel di utilizzare il modello file per i temi personalizzati, specificare l'indirizzo pubblico HTTP dei CSS file dei suoi tema personalizzato utilizzando la variabile `css_url`. Se si lascia questo variabile come vuoto, phpMussel utilizzerà il modello file per il predefinito tema.

---


###7. <a name="SECTION7"></a>FIRMA FORMATO

####*FILE NOMI FIRME*
Tutte le file nomi firme seguono il formato:

`NOME:FNRX`

Dove NOME è il nome per citare per quella firma e FNRX è la regolare espressione a verifica file nomi firme (non codificata) contra.

####*MD5 FIRME*
Tutte l'MD5 firme seguono il formato:

`HASH:DIMENSIONE:NOME`

Dove HASH è l'MD5 hash dell'intero file, DIMENSIONE è la totale dimensione del file e NOME è il nome per citare per quella firma.

####*ARCHIVIO METADATI FIRME*
Tutte l'archivio metadati firme seguono il formato:

`NOME:DIMENSIONE:CRC32`

Dove NOME è il nome per citare per quella firma, DIMENSIONE è la totale dimensione (non compresso) di un file contenuto all'interno dell'archivio e CRC32 è la CRC32 verifica numero di tale file.

####*PE SEZIONALI FIRME*
Tutte il PE sezionali firme seguono il formato:

`DIMENSIONE:HASH:NOME`

Dove HASH è l'MD5 hash di una sezione del PE file, DIMENSIONE è la totale dimensioni della sezione e NOME è il nome per citare per quella firma.

####*PE ESTESO FIRME*
Tutte il PE esteso firme seguono il formato:

`$VAR:HASH:DIMENSIONE:NOME`

Dove $VAR è il nome della PE variabile per corrispondere contro, HASH è l'MD5 hash di quella variabile, DIMENSIONE è la dimensione totale di quella variabile e NOME è il nome per citare per quella firma.

####*WHITELIST FIRME*
Tutte la whitelist firme seguono il formato:

`HASH:DIMENSIONE:TYPE`

Dove HASH è l'MD5 hash dell'intero file, DIMENSIONE è la totale dimensione del file e TYPE è il tipo di firme il file sulla whitelist è di essere immune contro.

####*COMPLESSO ESTESO FIRME*
Complesso esteso firme sono piuttosto diverso da altri tipi di firme possibili con phpMussel, in quanto ciò che essi sono corrispondenti contro è specificato dalle firme stesse e possono corrispondere contro più criteri. Criteri sono delimitati da ";" e il tipo e dati di ogni criterio è delimitato da ":" come tale che il formato per queste firme sembra come:

`$variabile1:DATI;$variabile2:DATI;FirmeNome`

####*TUTTO IL RESTO*
Tutte le altre firme seguono il formato:

`NOME:HEX:FROM:TO`

Dove NOME è il nome per citare per quella firma e HEX è un esadecimale codificato segmento del file destinato essere verificato dal pertinente firma. FROM e TO sono opzionali parametri, indicando da cui ea cui posizioni nei sorgenti dati per verificare contra (non supportata dal mail funzione).

####*REGEX*
Ogni forma di regex correttamente capito da PHP anche dovrebbe essere correttamente capito da phpMussel el sue firme. Ma, io suggerirei di prendere estrema cautela quando scrittura nuove regex basato firme, perché, se non sei certo quello stai facendo, ci possono essere molto irregolari e/o inaspettati risultati. Occhiata al sorgente codice di phpMussel se non sei certo sul contesto in cui le regolari espressioni dichiarazioni vengono parsato. Anche, ricordare che tutti i espressioni (ad eccezione per i file nomi, archivio metadati e l'MD5 espressioni) deve essere esadecimale codificato (tranne sintassi, naturalmente)!

####*DOVE METTERE PERSONALIZZATE FIRME?*
Solo mettere personalizzate firme in quei file destinati personalizzate firme. Questi file dovrebbe contenere "_custom" nei loro nomi. Si dovrebbe anche evitare di modificare i predefiniti firme file, tranne sai esattamente cosa si sta facendo, perché, oltre ad essere una buona pratica in generale e oltre ad aiutare a distinguere tra le vostre firme proprie e le predefinite firme incluso con phpMussel, è bene tenere a modificare solo i file destinati per modificare, perché interferenza con i predefiniti firme file può causare loro di smettere di funzionare correttamente, a causa dei "map" file: I map file raccontano per phpMussel dove nei firma file a cercare per firme necessarie per phpMussel quando a richiesto, e queste map file possono diventare fuori sincronia con i loro associati firma file se chi firme file vengono interferito con. Si può mettere più o meno quello che vuoi nel vostre personalizzate firme, fino a quando si segue la corretta sintassi. Ma, stare attenti a verificare le nuove firme per falsi positivi in anticipo se avete intenzione di condividerli o utilizzarli in un vivo ambiente.

####*TIPI DI FIRME*
I seguenti sono i tipi di firme utilizzate da phpMussel:
- "Normalizzati ASCII Firme" (ascii_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist.
- "Complesso Esteso Firme" (coex_*). Misto tipi dei firme verifica.
- "ELF Firme" (elf_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist e verificato allo ELF formato.
- "Portatili Eseguibili Firme" (exe_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist e verificato allo PE formato.
- "File Nomi Firme" (filenames_*). Verificato contro i file nomi dei file mirati per la scansionare.
- "Generali Firme" (general_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist.
- "Grafiche Firme" (graphics_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist e verificato come un conosciuto grafico file formato.
- "Generali Comandi" (hex_general_commands.csv). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist.
- "Normalizzati HTML Firme" (html_*). Verificato contro i contenuti del ogni HTML file mirati per scansionare quello che non è sulla whitelist.
- "Mach-O Firme" (macho_*). Verificato contro i contenuti del ogni file mirati per scansionare quello che non è sulla whitelist e verificato allo Mach-O formato.
- "Email Firme" (mail_*). Verificato contro la $body variabile parsato a la phpMussel_mail() funzione, che è destinato a essere il corpo de email messaggi o simili entità (potenzialmente forum messaggi e etcetera).
- "MD5 Firme" (md5_*). Verificato contro l'MD5 hash dei contenuti e la dimensione del ogni file mirati per scansionare quello che non è sulla whitelist.
- "Archive Metadati Firme" (metadata_*). Verificato contro l'CRC32 hash e la dimensione dell'iniziale file contenuto all'interno di qualsiasi file mirati per scansionare quello che non è sulla whitelist.
- "OLE Firme" (ole_*). Verificato contro i contenuti del ogni oggetti mirati per scansionare quello che non è sulla whitelist.
- "PDF Firme" (pdf_*). Verificato contro i contenuti del ogni PDF file mirati per scansionare quello che non è sulla whitelist.
- "Portatili Eseguibili Sezionale Firme" (pe_*). Verificato contro l'MD5 hash e la dimensione di ogni PE sezione del ogni file non sulla whitelist mirati per la scansione e verificato allo PE formato.
- "Portatili Eseguibili Esteso Firme" (pex_*). Verificato contro l'MD5 hash e la dimensione di ogni variabili del ogni file non sulla whitelist mirati per la scansione e verificato allo PE formato.
- "SWF Firme" (swf_*). Verificato contro i contenuti del ogni Shockwave file mirati per scansionare quello che non è sulla whitelist.
- "Whitelist Firme" (whitelist_*). Verificato contro l'MD5 hash dei contenuti e la dimensione del ogni file mirati per scansionare. Corrispondenti file saranno immuni contro l'essere bloccato dal tipo di firme di cui al loro whitelist listato.
- "XML/XDP Firme" (xmlxdp_*). Verificato contro qualsiasi XML/XDP pezzi trovato all'interno di qualsiasi dei file mirati per scansionare quello che non è sulla whitelist.
(Si noti che qualsiasi di queste firme possono essere disattivato facilmente tramite `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>CONOSCIUTI COMPATIBILITÀ PROBLEMI

####PHP e PCRE
- phpMussel richiede PHP e PCRE a eseguire ea funzionare correttamente. Senza PHP, o senza il PCRE estensione di PHP, phpMussel non sarà eseguirà o funzionare correttamente. Dovrebbe assicurarsi che il vostra sistema ha sia PHP e PCRE installati e disponibili prima di scaricare e installare phpMussel.

####ANTI-VIRUS SOFTWARE COMPATIBILITÀ

Per la maggior parte, phpMussel dovrebbe essere compatibile abbastanza con la maggior parte dei antivirus software. Ma, conflitti sono stati riportati da un numero di utenti in passato. Queste informazioni qui di seguito è da VirusTotal.com, e descrive un certo numero di falsi positivi riportato dai vari anti-virus programmi contro phpMussel. Sebbene questa informazione non è un'assoluta garanzia di se o non si sarà verificheranno problemi di compatibilità tra phpMussel e il vostro anti-virus software, se il vostro software anti-virus è stati ha notato o ha bandierato contro phpMussel, si dovrebbe considerare sia disattivarlo prima di lavorare con phpMussel o dovrebbe considerare l'alternative opzioni per sia il vostro anti-virus software o phpMussel.

Questa informazione è stato lo scorso aggiornato 25 Febbraio 2016 ed è in corso per tutte le phpMussel rilasci delle due più recenti minori versioni (v0.9.0-v0.10.0) al momento di scrivere questo.

| Scanner              |  Risultati                           |
|----------------------|--------------------------------------|
| Ad-Aware             |  Senza noti problemi                 |
| AegisLab             |  Senza noti problemi                 |
| Agnitum              |  Senza noti problemi                 |
| AhnLab-V3            |  Senza noti problemi                 |
| Alibaba              |  Senza noti problemi                 |
| ALYac                |  Senza noti problemi                 |
| AntiVir              |  Senza noti problemi                 |
| Antiy-AVL            |  Senza noti problemi                 |
| Arcabit              |  Senza noti problemi                 |
| Avast                |  Riferisce "JS:ScriptSH-inf [Trj]"   |
| AVG                  |  Senza noti problemi                 |
| Avira                |  Senza noti problemi                 |
| AVware               |  Senza noti problemi                 |
| Baidu-International  |  Senza noti problemi                 |
| BitDefender          |  Senza noti problemi                 |
| Bkav                 |  Riferisce "VEXC640.Webshell" e "VEXD737.Webshell"|
| ByteHero             |  Senza noti problemi                 |
| CAT-QuickHeal        |  Senza noti problemi                 |
| ClamAV               |  Senza noti problemi                 |
| CMC                  |  Senza noti problemi                 |
| Commtouch            |  Senza noti problemi                 |
| Comodo               |  Senza noti problemi                 |
| Cyren                |  Senza noti problemi                 |
| DrWeb                |  Senza noti problemi                 |
| Emsisoft             |  Senza noti problemi                 |
| ESET-NOD32           |  Senza noti problemi                 |
| F-Prot               |  Senza noti problemi                 |
| F-Secure             |  Senza noti problemi                 |
| Fortinet             |  Senza noti problemi                 |
| GData                |  Senza noti problemi                 |
| Ikarus               |  Senza noti problemi                 |
| Jiangmin             |  Senza noti problemi                 |
| K7AntiVirus          |  Senza noti problemi                 |
| K7GW                 |  Senza noti problemi                 |
| Kaspersky            |  Senza noti problemi                 |
| Kingsoft             |  Senza noti problemi                 |
| Malwarebytes         |  Senza noti problemi                 |
| McAfee               |  Riferisce "New Script.c"            |
| McAfee-GW-Edition    |  Riferisce "New Script.c"            |
| Microsoft            |  Senza noti problemi                 |
| MicroWorld-eScan     |  Senza noti problemi                 |
| NANO-Antivirus       |  Senza noti problemi                 |
| Norman               |  Senza noti problemi                 |
| nProtect             |  Senza noti problemi                 |
| Panda                |  Senza noti problemi                 |
| Qihoo-360            |  Senza noti problemi                 |
| Rising               |  Senza noti problemi                 |
| Sophos               |  Senza noti problemi                 |
| SUPERAntiSpyware     |  Senza noti problemi                 |
| Symantec             |  Senza noti problemi                 |
| Tencent              |  Senza noti problemi                 |
| TheHacker            |  Senza noti problemi                 |
| TotalDefense         |  Senza noti problemi                 |
| TrendMicro           |  Senza noti problemi                 |
| TrendMicro-HouseCall |  Senza noti problemi                 |
| VBA32                |  Senza noti problemi                 |
| VIPRE                |  Senza noti problemi                 |
| ViRobot              |  Senza noti problemi                 |
| Zillya               |  Senza noti problemi                 |
| Zoner                |  Senza noti problemi                 |

---


Ultimo Aggiornamento: 25 Febbraio 2016 (2016.02.25).
