      _____  _     _  _____  _______ _     _ _______ _______ _______           
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    

                            { ~ ~ ~ ITALIANO ~ ~ ~ }                           
 Grazie per aver scelto phpMussel, uno PHP-basato script basato su ClamAV firme
  progettato per individuare trojan, virus, Malware e altre minacce all'interno
          di file caricati nel sistema ovunque lo script è collegato.          
      PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPL V.2 da Caleb M (Maikuolan)      

                                     ~ ~ ~                                     


 CONTENUTO
 1. PREAMBOLO
 2A. COME INSTALLARE (PER WEB SERVER)
 2B. COME INSTALLARE (PER CLI)
 3A. COME USARE (PER WEB SERVER)
 3B. COME USARE (PER CLI)
 4A. BROWSER COMANDI
 4B. CLI (COMANDO LINEA INTERFACCIA)
 5. FILE INCLUSI IN QUESTO PACCHETTO
 6. OPZIONI DI CONFIGURAZIONE
 7. FIRMA FORMATO
 8. CONOSCIUTI COMPATIBILITÀ PROBLEMI

                                     ~ ~ ~                                     


 1. PREAMBOLO

 Uno speciale grazie a ClamAV sia per l'ispirazione del progetto e per le firme
 che questo script usi, senza la quale, lo script sarebbe probabilmente non    
 esisterebbe, o nel migliore, avrebbe un molto limitato valore.                
 <http://www.clamav.net/lang/en/>                                              

                                     ~ ~ ~                                     
 Questo script è libero software; è possibile ridistribuirlo e/o modificarlo   
 sotto i termini della GNU General Public License come pubblicato dalla Free   
 Software Foundation; o la versione 2 della licenza, o (a propria scelta) una  
 versione successiva. Questo script è distribuito nella speranza che possa     
 essere utile, Ma SENZA ALCUNA GARANZIA; senza neppure la implicita garanzia di
 COMMERCIABILITà o IDONEITà PER UN PARTICOLARE SCOPO. Vedere la GNU General    
 Public License per ulteriori dettagli.                                        
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>              

                                     ~ ~ ~                                     
 Questo documento e il suo associato pacchetto possono essere scaricati
 gratuitamente da Sourceforge. <http://sourceforge.net/projects/phpmussel/>

                                     ~ ~ ~                                     


 2A. COME INSTALLARE (PER WEB SERVER)

 Spero di semplificare questo processo tramite un installatore ad un certo
 punto in un futuro non troppo lontano, Ma fino ad allora, seguire queste
 istruzioni per avere phpMussel funzionale sulla maggior parte dei sistemi e
 CMS:

 1) Con la vostra lettura di questo, sto supponendo che hai già scaricato una
    archiviata copia dello script, decompresso il contenuto e lo hanno seduto
    da qualche parte sul tuo locale macchina. Da qui, ti consigliamo di
    determinare dove sulla macchina o CMS si desidera inserire quei contenuti.
    Una cartella come /public_html/phpmussel/ o simile (però, è non importa
    quale si sceglie, purché sia qualcosa sicuro e qualcosa si è soddisfatti)
    sarà sufficiente. Prima di iniziare il caricamento, continua a leggere..

 2) Apri "phpmussel.php", cercare la linea che inizia con "$vault=", e
    sostituire la stringa tra le seguenti virgolette su quella linea con la
    vera esatta posizione della "vault" cartella di phpMussel. Avrete notato un
    tale cartella nell'archivio avresti scaricato (a meno che si sente fino a
    ri-codifica l'intero script, avrete bisogno di mantenere la stessa
    struttura di file e cartelle come era nell'archivio originariamente).
    Questa cartella "vault" dovrebbe essere di un ulteriore cartella livello
    della cartella che il file "phpmussel.php" esiste dentro. Salvare il file,
    chiudere.

 3) (Opzionale; Fortemente consigliata per gli avanzati utenti, Ma non è
    consigliata per i principianti o per gli inesperti): Apri "phpmussel.ini"
    (situato della "vault") - Questo file contiene tutte le direttive
    disponibili per phpMussel. Sopra ogni opzione dovrebbe essere un breve
    commento che descrive ciò che fa e ciò che è per. Regolare queste opzioni
    come meglio credi, come per ciò che è appropriato per la vostre particolare
    configurazione. Salvare il file, chiudere.

 4) Carica i contenuti (phpMussel e le sue file) nella cartella che ci deciso
    in precedenza (non necessario includere il readme.XX.txt o change_log.txt
    file, Ma altrimenti, si dovrebbe caricare tutto).

 5) CMHOD la cartella "vault" a "777". La principale cartella che memorizzare
    il contenuto (quello scelto in precedenza), solitamente, può essere
    lasciato solo, Ma lo CHMOD stato dovrebbe essere controllato se hai avuto
    problemi di autorizzazioni in passato sul vostro sistema (per predefinita,
    dovrebbe essere qualcosa simile a "755").

 6) Successivamente, sarà necessario collegare phpMussel al vostro sistema o
    CMS. Ci sono diversi modi in cui è possibile collegare script come
    phpMussel al vostre sistema o CMS, Ma il più semplice è di inserire lo
    script all'inizio di un file del vostre sistema o CMS (quello che sarà
    generalmente sempre essere caricato quando qualcuno accede a una pagina
    attraverso il vostro sito) utilizzando un require o include comando.
    Solitamente, questo sarà qualcosa memorizzate in una cartella, ad esempio
    "/includes", "/assets" o "/functions", e spesso essere chiamato qualcosa
    come "init.php", "common_functions.php", "functions.php" o simili. Avrete
    bisogno determinare quale file è per la vostra situazione. Per fare questo,
    inserire la seguente linea di codice all'inizio di quel core file,
    sostituendo la stringa contenuta all'interno delle virgolette con l'esatto
    indirizzo della "phpmussel" file (indirizzo locale, non l'indirizzo HTTP;
    sarà simile all'indirizzo citato in precedenza).

    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>

    Salvare il file, chiudere, caricare di nuovo.

 7) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare
    il lavoro svolto per assicurarsi che funzioni correttamente. Per testare le
    protezioni di file caricamente, tentare di caricare i test file inclusi
    nella pacchetto all'interno "_testfiles" al vostro web sito via i vostri
    soliti metodi di browser basato file caricamento. Se tutto funziona, un
    messaggio dovrebbe apparire da phpMussel conferma che il caricamento è
    stato bloccato con successo. Se nulla appare, qualcosa non funziona
    correttamente. Se si sta utilizzando qualsiasi l'avanzate funzioni o se si
    sta utilizzando qualsiasi altri tipi di scansione possibili con lo
    strumento, mi piacerebbe suggerisco di provarlo quelli per assicurarsi che
    funzioni come previsto, anche.

                                     ~ ~ ~                                     


 2B. COME INSTALLARE (PER CLI)

 Spero di semplificare questo processo tramite un installatore ad un certo
 punto in un futuro non troppo lontano, Ma fino ad allora, seguire queste
 istruzioni per avere phpMussel pronto a lavorare con CLI (essere consapevoli
 che in questo momento, CLI supporto applica solo ai Windows basato sistemi;
 Linux e altri sistemi arriveranno presto a una successiva versione di
 phpMussel):

 1) Con la vostra lettura di questo, sto supponendo che hai già scaricato una
    archiviata copia dello script, decompresso il contenuto e lo hanno seduto
    da qualche parte sul tuo locale macchina. Quando hai stabilito che sei
    felice con il luogo scelto per phpMussel, continuare.

 2) phpMussel richiede php essere installato sulla macchina per eseguire. Se
    non lo avete php installato sul vostra macchina, prego installare php sul
    vostra macchina seguendo le istruzioni fornite dal php installazione
    programma.

 3) Apri "phpmussel.php", cercare la linea che inizia con "$vault=", e
    sostituire la stringa tra le seguenti virgolette su quella linea con la
    vera esatta posizione della "vault" cartella di phpMussel. Avrete notato un
    tale cartella nell'archivio avresti scaricato (a meno che si sente fino a
    ri-codifica l'intero script, avrete bisogno di mantenere la stessa
    struttura di file e cartelle come era nell'archivio originariamente).
    Questa cartella "vault" dovrebbe essere di un ulteriore cartella livello
    della cartella che il file "phpmussel.php" esiste dentro. Salvare il file,
    chiudere.

 4) (Opzionale; Fortemente consigliata per gli avanzati utenti, Ma non è
    consigliata per i principianti o per gli inesperti): Apri "phpmussel.ini"
    (situato della "vault") - Questo file contiene tutte le direttive
    disponibili per phpMussel. Sopra ogni opzione dovrebbe essere un breve
    commento che descrive ciò che fa e ciò che è per. Regolare queste opzioni
    come meglio credi, come per ciò che è appropriato per la vostre particolare
    configurazione. Salvare il file, chiudere.

 5) (Opzionale) Si può rendere utilizzando di phpMussel in CLI modalità
    facile per voi stessi per creando un batch file ai fini della
    automaticamente caricare php e phpMussel. Per fare questo, aprire un testo
    editor come Notepad o Notepad++, digitare il completo percorso della
    "php.exe" file nella cartella della vostra installazione di PHP, seguito da
    uno spazio, seguito dal completo percorso della "phpmussel.php" file nella
    cartella della vostra installazione di phpMussel, salvare il file con un
    ".bat" estensione qualche parte che lo troverete facilmente, e fare doppio
    clic su tale file per eseguire phpMussel in futuro.

 6) A questo punto, il gioco è fatto! Ma, si dovrebbe probabilmente verificare
    il lavoro svolto per assicurarsi che funzioni correttamente. Per testare
    phpMussel, eseguire phpMussel e prova scansionare la "_testfiles" cartella
    fornito con il pacchetto.

                                     ~ ~ ~                                     


 3A. COME USARE (PER WEB SERVER)

 phpMussel è uno script destinato a funzionare adeguatamente con solo minimi
 requisiti: Quando è stato installato, fondamentalmente, è dovrebbe funzionare.

 Scansione di file caricamenti è automatizzato e abilitato per predefinita,
 perciò nulla è richiesto a vostro nome per questa particolare funzione.

 Ma, si è anche in grado di istruire phpMussel per la scansione per i file,
 cartelle o archivi che si implicitamente specificano. Per fare questo, in
 primo luogo, è necessario assicurarsi che l'appropriata configurazione è
 impostato nella phpmussel.ini file (cleanup deve essere disabilitato), e
 quando fatto, in un php file che è collegato allo phpMussel, utilizzare la
 seguente funzione nelle codice:

 phpMussel($cosa_a_scansione,$tipi_di_output,$output_pianura);

 Dove:
 - $cosa_a_scansione è una stringa o un array, che punta a un obiettivo file,
   un obiettivo cartella o un array di obiettivo file e/o obiettivo cartella.
 - $tipi_di_output è un integer, indicando il formato in cui i risultati della
   scansione dovrebbero restituire come. Un valore di 0 istruire la funzione a
   restituire i risultati come integer (un risultato restituito di -2 indica
   che i corrotto dato è stato rilevato durante la scansione e quindi la
   scansione non abbia completato, -1 indica che estensioni o addon richiesti
   per php a eseguire la scansione erano assente e quindi la scansione non
   abbia completato, 0 indica che l'obiettivo di scansione non esiste e quindi
   non c'era nulla a scansione, 1 indica che l'obiettivo è stato scansionata
   correttamente e non problemi stati rilevati, e 2 indica che l'obiettivo è
   stato scansionata correttamente e problemi stati rilevati). Un valore di 1
   istruire la funzione a restituire i risultati come leggibile testo. Un
   valore di 2 istruire la funzione a restituire i risultati come leggibile
   testo e di esportare i risultati ad un globale variabile. Questa variabile è
   opzionale, predefinito a 0.
 - $output_pianura è un integer, indicando se a restituire i risultati come un
   array o non. Normalmente, se la scansione obiettivo conteneva multiplo
   elementi (come se una cartella o un array) i risultati sará restituiti come
   array (predefinito valore di 0). Un valore di 1 istruire la funzione a
   implodere qualsiasi tale array prima di restituire, risultante in un
   appiattita stringa contenente i risultati essere restituire. Questa
   variabile è opzionale, predefinito a 0.

 Esempi:

   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;

   Restituisce qualcosa come (in forma di una stringa):
    Wed, 18 Sep 2013 02:49:46 +0000 Iniziato.
    > Verificare '/user_name/public_html/my_file.html':
    -> Nessun problema trovato.
    Wed, 18 Sep 2013 02:49:47 +0000 Finito.

 Per una dettagliata spiegazione del tipo di firme di cui phpMussel usa durante
 le sue scansioni e come le sue gestisce queste firme, fare riferimento alla
 Firma Formato sezione di questo README file.

 Se si incontrano qualsiasi falsi positivi, Se si incontrano qualcosa nuova che
 si pensa dovrebbe essere bloccato, o per qualsiasi altri scopi o materia a
 riguardo delle firme, si prega di contattare me a riguardo esso così che io
 possa apportare le necessarie modifiche, di cui, se si non fare contatto me,
 io non necessariamente essere consapevole ne.

 Per disabilitare firme incluso con phpMussel (come se stai sperimentando falsi
 positivi specifico alle vostri scopi di cui non dovrebbero normalmente essere
 rimosso dalla streamline), fare riferimento alle note per greylisting
 all'interno del Browser Comandi sezione di questo README file.

 Oltre alla predefinito scansione dei file caricamenti e l'opzionale scansione
 di altri file e/o cartelle specificato tramite la sopra funzione, incluso in
 phpMussel è una funzione intendeva per la scansione dello corpo dei email
 messaggi. Questa funzione si comporta in simile modi alla norma phpMussel()
 funzione, Ma si concentra esclusivamente sulla verificare contro i ClamAV
 email basato firme. L'ho non legato queste firme alla norma phpMussel()
 funzione, perché è altamente improbabile che mai avresti trovato il corpo di
 un in arrivo e-mail messaggio di bisogno di scansione dall'interno un file
 caricamento mirato a una pagina dove phpMussel è collegato, e così, a legare
 queste firme nella phpMussel() funzione sarebbe ridondante. Ma, con quello
 detto, avente una separata funzione per verificare contro queste firme
 potrebbe rivelarsi estremamente utile per alcuni, soprattutto per coloro il
 cui CMS o webfront sistema è in qualche modo legato nel loro email sistema
 e per quelli di cui parsare i loro email tramite una php script di cui essi
 potenzialmente potrebbero collegare a phpMussel. Configurazione per questa
 funzione, come tutti gli altri, è controllato tramite delle phpmussel.ini
 file. Per utilizzare di questa funzione (avrete bisogno a fare la propria
 implementazione), in un php file che è collegato al phpMussel, utilizzare la
 seguente funzione nel vostre codice:

 phpMussel_mail($corpo);

 Dove $corpo è corpo dello email messaggio che si desidera a scansione
 (inoltre, si potrebbe provare a scansione nuovi forum messaggi, in arrivo
 messaggi dal vostro online contatto form o simile). se qualsiasi errori
 accadere impedendo la funzione di completare il sue scansione, un valore di -1
 verrà restituito. Se la funzione completa il sue scansione e nulla è trovato,
 un valore di 0 verrà restituito (che significa pulito). Se, ma, la funzione lo
 fa trovare qualcosa, una stringa sarà restituito contenente un messaggio che
 dichiara ciò che ha trovato.

 In aggiunta a quanto sopra, se si guarda il sorgente codice, è possibile si
 può notare le funzioni phpMusselD() e phpMusselR(). Queste funzioni sono
 sub-funzioni di phpMussel(), e non deve essere chiamato direttamente al di
 fuori di tale genitore funzione (non a causa di avversi effetti.. Più così,
 semplicemente perché che sarebbe stato inutile, e molto probabilmente non
 sarà effettivamente funziona correttamente comunque).

 Ci sono molti altri controlli e funzioni disponibili all'interno phpMussel per
 il vostro uso. Per tali controlli e funzioni che, dalla fine di questa sezione
 del README, non sono ancora stato documentato, si prego continuare a leggere e
 fare riferimento alla Browser Comandi sezione di questo README file.

                                     ~ ~ ~                                     


 3B. COME USARE (PER CLI)

 Si prega di fare riferimento alla "COME INSTALLARE (PER CLI)" sezione di
 questo readme file.

 Essere consapevoli che, sebbene futuri versioni di phpMussel dovrebbero
 sostenere altri sistemi, in questo momento, phpMussel CLI modalità supporto è
 ottimizzata solo per l'utilizzo su Windows basati sistemi (si può, ovviamente,
 provare su altri sistemi, Ma non posso garantire che funzionerà come
 previsto).

 Anche essere consapevoli che phpMussel è non l'equivalente di un completa
 funzionale anti-virus suite, e diverso dai convenzionali anti-virus suite, non
 protegge l'attiva memoria o simili! Essa solo rileva virus contenuti da quei
 specifici file che si esplicitamente dica per scansione.

                                     ~ ~ ~                                     


 4A. BROWSER COMANDI

 Quando phpMussel è stato installato ed è funzionante correttamente sulla
 vostra sistema, se hai definito le script_password e logs_password variabili
 nel configurazione file, si sarà in grado di eseguire qualche limitato numero
 di amministrative funzioni e inserire qualche numero di comandi per phpMussel
 tramite il browser. La ragione per cui queste password devono essere definite
 come mezzo per abilita le browser lato controlli è sia per garantire
 l'adeguata sicurezza, un'adeguata protezione di questi browser lato controlli
 e per assicurare che esista un modo per questi browser lato controlli essere
 completamente disabilitalo se non sono desiderati da voi e/o altro
 webmaster/amministratori che utilizzano phpMussel. Così, in altre parole, per
 abilita questi controlli, definire una password, e per disabilita questi
 controlli, definire nessune password. In alternativa, se si sceglie di
 abilitare questi controlli e quindi scegliere di disabilita questi controlli
 in un secondo momento, c'è un comando per fare questo (che può essere utile se
 si eseguono particulare azioni che si sente potrebbero compromettere le
 delegati password ed è necessità di rapidamente disabilita questi controlli
 senza modificare le configurazione file).

 Un paio di motivi per cui si -dovrebbe- abilita questi controlli:
 - Fornisce un modo per facilmente aggiungere firme alla greylist in casi come
   quando si scopre una firma che sta producendo un falso positivo durante il
   caricamento dei file di vostra sistema e non avete il tempo di modificare
   manualmente e caricare di nuovo il greylist file.
 - Fornisce un modo per permettere a qualcuno diverso da te per controllare la
   vostra copia di phpMussel senza l'implicita necessità di concedere loro
   l'accesso a FTP.
 - Fornisce un modo per fornire controllato accesso ai log file.
 - Fornisce un semplice modo per aggiornare phpMussel quando sono aggiornamenti
   disponibili.
 - Fornisce un modo per monitorare phpMussel quando l'accesso a FTP o altri
   convenzionali punti di accesso per il monitoraggio di phpMussel non sono
   disponibili.

 Un paio di motivi per cui si dovrebbe -non- abilita questi controlli:
 - Fornisce un vettore per i potenziali aggressori e indesiderabili per
   determinare se si sta utilizzando phpMussel o non (sebbene, questo potrebbe
   essere sia un ragione per e una ragione contro, dipendente di come si vedono
   le cose) passando per l'invio ciecamente di comandi ai server come un mezzo
   per sondare. Da una parte, questo potrebbe scoraggiare gli aggressori dalla
   mirare di vostra sistema se vengono a sapere che si sta utilizzando
   phpMussel, supponendo il loro sono sondante perché il loro metodo di attacco
   è reso inefficace come risultato dell'utilizzo di phpMussel. Ma, d'altra
   parte, se qualche imprevisto e attualmente sconosciuto sfruttare all'interno
   phpMussel o una versione futura della stessa viene alla luce, e se potrebbe
   potenzialmente fornire un vettore di attacco, un positivo risultato da tale
   sondare potrebbe effettivamente incoraggiare attaccanti per mirante il
   sistema.
 - Se le delegato password erano stati compromessi, se non cambiato, potrebbe
   fornire un modo per un utente malintenzionato di circonvallazione qualunque
   firme possono essere altrimenti normalmente impediscono loro attacchi dal
   successo, o anche potenzialmente disabilita phpMussel del tutto, così
   fornendo un modo per rendere l'efficacia della phpMussel discutibile.

 In entrambi i casi, senza riguardo di ciò che si sceglie, la scelta in
 definitiva è la vostra. Per predefinita, questi controlli saranno
 disabilitato, Ma hanno un pensateci, e se si decidere li vuoi, questa sezione
 spiega sia come abilitare e come utilizzare queste cose.

 Un elenco di disponibili browser lato comandi:

 scan_log
   Password requisito: logs_password
   Altri requisiti: scan_log deve essere definito.
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Cosa fa: Stampi il contenuti del scan_log file sullo vostro schermo.
   ~
 scan_kills
   Password requisito: logs_password
   Altri requisiti: scan_kills deve essere definito.
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Cosa fa: Stampi il contenuti del scan_kills file sullo vostro schermo.
   ~
 controls_lockout
   Password requisito: logs_password O script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Esempio 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Cosa fa: Disabilitare/bloccare tutti le browser lato controlli. Questo
            dovrebbe essere usato se si sospetta che una o più delle vostre
            password sono stato compromesso (questo può accadere se si sta
            utilizzando questi controlli da un computer che non è protetto o
            fidato). controls_lockout opere tramite creando un file,
            controls.lck, nelle vostre vault, che phpMussel sarà verifica per
            prima di eseguire qualsiasi comando di qualsiasi tipo. Quando
            questo accade, per riabilitarla i controlli, è necessario per
            vostre di manualmente eliminare il controls.lck file via FTP o
            simile. Può essere chiamato utilizzando qualsiasi delle password.
   ~
 disable
   Password requisito: script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?pword=[script_password]&phpmussel=disable
   ~
   Cosa fa: Disabilitare phpMussel. Questo dovrebbe essere utilizzato se si sta
            eseguendo qualsiasi aggiornamenti o modifiche al vostra sistema o
            se si sta installando nuovo software o dei moduli al vostra sistema
            che fare o potenzialmente potrebbe innescare falsi positivi. Questo
            anche dovrebbe essere utilizzato se si hanno qualsiasi problemi con
            phpMussel ma non vogliono rimuoverlo dal vostra sistema. Quando
            questo accade, per riabilitare phpMussel, utilizzare "enable".
   ~
 enable
   Password requisito: script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?pword=[script_password]&phpmussel=enable
   ~
   Cosa fa: Abilita phpMussel. Questo dovrebbe essere usato se in precedenza
            vostra ha disabilitato phpMussel con "disable" e vogliono
            riabilitarla.
   ~
 update
   Password requisito: script_password
   Altri requisiti: update.dat e update.inc deve esistere.
   Parametri requisiti: (nessuno)
   Parametri opzionali: forcedupdate
   Esempio: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   Cosa fa: Verifica la presenza di aggiornamenti sia per phpMussel e le sue
            firme. Se l'aggiornamento verificare è successo e aggiornamenti
            sono trovano, sarà tenterà per scaricare e installare gli
            aggiornamenti. Se l'aggiornamento verificare è troppo rapidamente,
            l'aggiornamento verificare sarà abortire. Se l'aggiornamento
            verificare fallisce, l'aggiornamento sarà abortito. Se l'opzionale
            parametro "forcedupdate" vieno dato, momento dell'aggiornamento
            verrà ignorato e così l'aggiornamento verificare sarà continuerà
            indipendentemente di s'essere verificò "troppo rapidamente", Ma
            sarà ancora abortire se l'aggiornamento verificare fallisce.
            Risultati dell'intero processo sono stampati sullo schermo.
            Raccomando incluse l'opzionale parametro "forcedupdate" se si sta
            manualmente innescando questo controllo, Ma si prega di non usare
            "forcedupdate" se si sta automatizzando il processo, come tramite
            cron o simili. Mi consiglia di fare l'aggiornamento verificare
            almeno una volta al mese per garantire le vostre firme e la vostra
            copia di phpMussel sono aggiornato all'ultimo edizioni (a meno,
            ovviamente, si fare l'aggiornamento verificare e fare
            l'installazione di manualmente, di cui, Mi piacerebbe ancora
            consiglio di fare almeno una al mese). Controllo più di due volte
            al mese, è probabilmente inutile, considerando sto (alla momento di
            stesura questo) lavorando su questo progetto da solo e sto molto
            improbabile essere in grado per produzione qualsiasi aggiornamenti
            di qualsiasi tipo più spesso di quello (né faccio in modo
            particolare voglio per la maggior parte).
   ~
 greylist
   Password requisito: script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: [Nome della firma essere sulla greylist]
   Parametri opzionali: (nessuno)
   Esempio: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   Cosa fa: Aggiungere una firma alla greylist.
   ~
 greylist_clear
   Password requisito: script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Cosa fa: Cancella l'intera greylist.
   ~
 greylist_show
   Password requisito: script_password
   Altri requisiti: (nessuno)
   Parametri requisiti: (nessuno)
   Parametri opzionali: (nessuno)
   Esempio: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Cosa fa: Consente di stampare il contenuto della greylist sullo schermo.
   ~

                                     ~ ~ ~                                     


 4B. CLI (COMANDO LINEA INTERFACCIA)

 phpMussel può essere eseguito come uno interattivo file scanner in CLI
 modalità da Windows. Fare riferimento alla "COME INSTALLARE (PER CLI)" sezione
 di questo readme file per maggiori dettagli.

 Per un elenco di comandi disponibili all'interno CLI , al CLI prompt, tipo
 'c', e premere Enter.

                                     ~ ~ ~                                     


 5. FILE INCLUSI IN QUESTO PACCHETTO

 Il seguente è un elenco di tutti i file che dovrebbe essere incluso nella
 archiviato copia di questo script quando si scaricalo, qualsiasi di file che
 potrebbero potenzialmente essere creato come risultato della vostra
 utilizzando questo script, insieme con una breve descrizione di ciò che tutti
 questi file sono per.

 /phpmussel.php (Script, Incluso)
    phpMussel caricatore file. Carica lo principale script, l'aggiornamento
    script, eccetera. Questo è il file si collegare alla vostra sistema
    (essenziale)!
    ~
 /web.config (Altro, Incluso)
    Un ASP.NET configurazione file (in questo caso, a proteggere la "/vault"
    cartella da l'acceso di non autorizzate origini nel caso che lo script è
    installato su un server basata su ASP.NET tecnologie).
    ~
 /_docs/ (Cartella)
    Documentazione cartella (contiene vari file).
    ~
 /_docs/change_log.txt (Documentazione, Incluso)
    Un record delle modifiche apportate allo script tra diverse versioni
    (non richiesto per il corretto funzionamento dello script).
    ~
 /_docs/readme.XX.txt (Documentazione, Incluso)
    Il README file (per esempio; il file che si sta leggendo momentaneamente).
    ~
 /_testfiles/ (Cartella)
    Test file cartella (contiene vari file).
    Tutti i file contenuti sono test file per la verifica se phpMussel è
    installato correttamente sulla vostra sistema, e non è necessario a
    caricare questa cartella o qualsiasi dei suoi file, tranne quando fa tali
    test.
    ~
 /_testfiles/ascii_standard_testfile.txt (Test file, Incluso)
    Test file per test di phpMussel normalizzati ASCII firme.
    ~
 /_testfiles/exe_standard_testfile.exe (Test file, Incluso)
    Test file per test di phpMussel PE firme.
    ~
 /_testfiles/general_standard_testfile.txt (Test file, Incluso)
    Test file per test di phpMussel generale firme.
    ~
 /_testfiles/graphics_standard_testfile.gif (Test file, Incluso)
    Test file per test di phpMussel grafica firme.
    ~
 /_testfiles/md5_testfile.txt (Test file, Incluso)
    Test file per test di phpMussel MD5 firme.
    ~
 /_testfiles/metadata_testfile.txt.gz (Test file, Incluso)
    Test file per test di phpMussel metadata firme e per testare GZ file
    supporto sullo vostro sistema.
    ~
 /_testfiles/metadata_testfile.txt.zip (Test file, Incluso)
    Test file per test di phpMussel metadata firme e per testare ZIP file
    supporto sullo vostro sistema.
    ~
 /_testfiles/pe_sectional_testfile.exe (Test file, Incluso)
    Test file per test di phpMussel PE Sezionale firme.
    ~
 /vault/ (Cartella)
    Vault cartella (contiene vari file).
    ~
 /vault/.htaccess (Altro, Incluso)
    Un ipertesto accesso file (in questo caso, a proteggere di riservati file
    appartenente allo script da l'acceso di non autorizzate origini).
    ~
 /vault/ascii_clamav_regex.cvd (Firme, Incluso)
 /vault/ascii_clamav_regex.map (Firme, Incluso)
 /vault/ascii_clamav_standard.cvd (Firme, Incluso)
 /vault/ascii_clamav_standard.map (Firme, Incluso)
 /vault/ascii_custom_regex.cvd (Firme, Incluso)
 /vault/ascii_custom_standard.cvd (Firme, Incluso)
 /vault/ascii_mussel_regex.cvd (Firme, Incluso)
 /vault/ascii_mussel_standard.cvd (Firme, Incluso)
    File per le normalizzati ASCII firme.
    Richiesto se l'opzione per le normalizzati ASCII firme in phpmussel.ini è
    abilitato. Può rimuovere se l'opzione è disabilitato (ma i file verranno
    ricreati al momento di aggiornamento).
    ~
 /vault/elf_clamav_regex.cvd (Firme, Incluso)
 /vault/elf_clamav_regex.map (Firme, Incluso)
 /vault/elf_clamav_standard.cvd (Firme, Incluso)
 /vault/elf_clamav_standard.map (Firme, Incluso)
 /vault/elf_custom_regex.cvd (Firme, Incluso)
 /vault/elf_custom_standard.cvd (Firme, Incluso)
 /vault/elf_mussel_regex.cvd (Firme, Incluso)
 /vault/elf_mussel_standard.cvd (Firme, Incluso)
    File per l'ELF firme.
    Richiesto se l'opzione per l'ELF firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/exe_clamav_regex.cvd (Firme, Incluso)
 /vault/exe_clamav_regex.map (Firme, Incluso)
 /vault/exe_clamav_standard.cvd (Firme, Incluso)
 /vault/exe_clamav_standard.map (Firme, Incluso)
 /vault/exe_custom_regex.cvd (Firme, Incluso)
 /vault/exe_custom_standard.cvd (Firme, Incluso)
 /vault/exe_mussel_regex.cvd (Firme, Incluso)
 /vault/exe_mussel_standard.cvd (Firme, Incluso)
    File per Portatile Eseguibile file (EXE) firme.
    Richiesto se l'opzione per l'EXE firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/filenames_clamav.cvd (Firme, Incluso)
 /vault/filenames_custom.cvd (Firme, Incluso)
 /vault/filenames_mussel.cvd (Firme, Incluso)
    File per le file nomi firme.
    Richiesto se l'opzione per file nomi firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/general_clamav_regex.cvd (Firme, Incluso)
 /vault/general_clamav_regex.map (Firme, Incluso)
 /vault/general_clamav_standard.cvd (Firme, Incluso)
 /vault/general_clamav_standard.map (Firme, Incluso)
 /vault/general_custom_regex.cvd (Firme, Incluso)
 /vault/general_custom_standard.cvd (Firme, Incluso)
 /vault/general_mussel_regex.cvd (Firme, Incluso)
 /vault/general_mussel_standard.cvd (Firme, Incluso)
    File per generali firme.
    Richiesto se l'opzione per generali firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/graphics_clamav_regex.cvd (Firme, Incluso)
 /vault/graphics_clamav_regex.map (Firme, Incluso)
 /vault/graphics_clamav_standard.cvd (Firme, Incluso)
 /vault/graphics_clamav_standard.map (Firme, Incluso)
 /vault/graphics_custom_regex.cvd (Firme, Incluso)
 /vault/graphics_custom_standard.cvd (Firme, Incluso)
 /vault/graphics_mussel_regex.cvd (Firme, Incluso)
 /vault/graphics_mussel_standard.cvd (Firme, Incluso)
    File per grafica firme.
    Richiesto se l'opzione per grafica firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/greylist.csv (Firme, Included/Created)
    CSV di firme sulla greylist indicando a phpMussel cui firme dovrebbe essere
    ignorato (il file sarà ricreato automaticamente se è cancellato).
    ~
 /vault/hex_general_commands.csv (Firme, Incluso)
    Hex-codificata CSV di generale comando rilevazioni opzionalmente utilizzati
    da phpMussel. Richiesto se l'opzione per generale comando rilevazione in
    phpmussel.ini è abilitato. Può rimuovere se l'opzione è disabilitato (ma i
    file verranno ricreati al momento di aggiornamento).
    ~
 /vault/lang.inc (Script, Incluso)
    phpMussel Lingua Dati; Necessario per multilingue funzionalità.
    ~
 /vault/macho_clamav_regex.cvd (Firme, Incluso)
 /vault/macho_clamav_regex.map (Firme, Incluso)
 /vault/macho_clamav_standard.cvd (Firme, Incluso)
 /vault/macho_clamav_standard.map (Firme, Incluso)
 /vault/macho_custom_regex.cvd (Firme, Incluso)
 /vault/macho_custom_standard.cvd (Firme, Incluso)
 /vault/macho_mussel_regex.cvd (Firme, Incluso)
 /vault/macho_mussel_standard.cvd (Firme, Incluso)
    File per Mach-O firme.
    Richiesto se l'opzione per Mach-O firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/mail_clamav_regex.cvd (Firme, Incluso)
 /vault/mail_clamav_regex.map (Firme, Incluso)
 /vault/mail_clamav_standard.cvd (Firme, Incluso)
 /vault/mail_clamav_standard.map (Firme, Incluso)
 /vault/mail_custom_regex.cvd (Firme, Incluso)
 /vault/mail_custom_standard.cvd (Firme, Incluso)
 /vault/mail_mussel_regex.cvd (Firme, Incluso)
 /vault/mail_mussel_standard.cvd (Firme, Incluso)
    File per firme utilizzati dalla phpMussel_mail() funzione. Richiesta se la
    funzione viene utilizzato in qualsiasi modo. Può rimuovere se non viene
    utilizzato (ma i file verranno ricreati al momento di aggiornamento).
    ~
 /vault/md5_clamav.cvd (Firme, Incluso)
 /vault/md5_custom.cvd (Firme, Incluso)
 /vault/md5_mussel.cvd (Firme, Incluso)
    File per l'MD5 basate firme.
    Richiesto se l'opzione per l'MD5 basate firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/metadata_clamav.cvd (Firme, Incluso)
 /vault/metadata_custom.cvd (Firme, Incluso)
 /vault/metadata_mussel.cvd (Firme, Incluso)
    File per l'archivio metadati firme.
    Richiesto se l'opzione per l'archivio metadati firme in phpmussel.ini è
    abilitato. Può rimuovere se l'opzione è disabilitato (ma i file verranno
    ricreati al momento di aggiornamento).
    ~
 /vault/pe_clamav.cvd (Firme, Incluso)
 /vault/pe_custom.cvd (Firme, Incluso)
 /vault/pe_mussel.cvd (Firme, Incluso)
    File per PE Sezionale firme.
    Richiesto se l'opzione per PE Sezionale firme in phpmussel.ini è abilitato.
    Può rimuovere se l'opzione è disabilitato (ma i file verranno ricreati al
    momento di aggiornamento).
    ~
 /vault/phpmussel.inc (Script, Incluso)
    phpMussel Nucleo Script; Il principale corpo e budella di phpMussel
    (essenziale)!
    ~
 /vault/phpmussel.ini (Altro, Incluso)
    phpMussel configurazione file; Contiene tutte l'opzioni di configurazione
    per phpMussel, dicendogli cosa fare e come operare correttamente
    (essenziale)!
    ~
 /vault/scan_log.txt *(Logfile, Created)
    Un record di tutto scansionato da phpMussel.
    ~
 /vault/scan_kills.txt *(Logfile, Created)
    Un record di tutti i file bloccati/uccisi da phpMussel.
    ~
 /vault/template.html (Altro, Incluso)
    phpMussel Template file; Template per l'HTML output prodotto da phpMussel
    per il suo messaggio di bloccato file caricamento (il messaggio visto dallo
    caricatore).
    ~
 /vault/update.dat (Altro, Incluso)
    File contenente informazioni sulla versione sia di phpMussel e le phpMussel
    firme. Se si desidero automaticamente aggiornare di phpMussel o si desidero
    l'aggiornare di phpMusel tramite il browser, questo file è essenziale.
    ~
 /vault/update.inc (Script, Incluso)
    phpMussel Aggiornare Script; Richiesto per l'automatico aggiornare di
    phpMussel e per l'aggiornare di phpMussel tramite il browser, Ma non
    richiesto altrimenti.
    ~

 * Nome del file può variare dipendente di configurazione (in phpmussel.ini).

 = IN RIGUARDA PER FIRMA FILES =
    CVD è l'acronimo di "ClamAV Virus Definitions", in riferimento sia come
    ClamAV riferisce alle proprie firme e all'uso di tali firme da phpMussel;
    I file che terminano con "CVD" contengono firme.
    ~
    I file che terminano con "MAP", letteralmente, Mappa cui delle firme
    phpMussel dovrebbe e non dovrebbe usare per individuale scansioni; Non
    tutte le firme sono necessariamente richiesti per ogni singola scansione,
    così, phpMussel utilizza mappe delle firme file a accelerare il processo di
    scansione (un processo che sarebbe altrimenti essere estremamente lento e
    noioso).
    ~
    Firma file contrassegnati con "_regex" contengono le firme che utilizzano
    regolari espressioni (regex) modello verifica.
    ~
    Firma file contrassegnati con "_standard" contengono le firme che
    specificamente non utilizzano qualsiasi forma di modello verifica.
    ~
    Firma file contrassegnati con né "_regex" o "_Standard" sarà come uno o
    l'altro, Ma non entrambi (fare riferimento alla Firma Formato sezione di
    questo README file per documentazione e specifici dettagli).
    ~
    Firma file contrassegnati con "_clamav" contengono le firme che
    esclusivamente forniti dal ClamAV database (GNU/GPL).
    ~
    Firma file contrassegnati con "_custom", per predefinita, contengono non
    firme; Questi tali file esistono a darvi un posto dove inserire le vostre
    personalizzate firme, se si arriva con qualsiasi.
    ~
    Firma file contrassegnati con "_mussel" contengono le firme che in
    particolare non sono forniti da ClamAV, firme che, in generale, l'ho venire
    con me stesso e/o sulla base di informazioni raccolte da varie fonti.
    ~

                                     ~ ~ ~                                     


 6. OPZIONI DI CONFIGURAZIONE

 Il seguente è un elenco di variabili trovate nelle "phpmussel.ini"
 configurazione file di phpMussel, insieme con una descrizione del loro scopo e
 funzione.

 "general" (Categoria)
 - Generale configurazione per phpMussel.
    "script_password"
    - Per conveniance, phpMussel permette alcune funzioni (per esempio,
      l'aggiornare di phpMussel tramite il browser) essere innescato
      manualmente tramite POST, GET e QUERY. Ma, come precauzione di sicurezza,
      per fare questo, phpMussel aspetta una password essere incluso con il
      comando, al fine per garantire che sia tu, e non qualcun altro, tentando
      per manualmente attivare queste funzioni. Impostare script_password a
      qualunque password che si desidera utilizzare. Se non alcuna password è
      impostata, Manuale innescando sarà disabilitato per predefinita. Usa
      qualcosa si ricorda, Ma che è difficile per indovinare d'altrui.
      * Non ha alcuna influenza in CLI modalità.
    "logs_password"
    - Stesso come script_password, Ma per la visualizzazione dei contenuti di
      scan_log e scan_kills. Avendo separate password può essere utile se si
      vuole dare l'accesso a qualcun altro a una serie di funzioni ma non
      l'altro.
      * Non ha alcuna influenza in CLI modalità.
    "cleanup"
    - Disimpostare le script variabili e la cache dopo l'esecuzione. Se si non
      utilizza lo script dopo la iniziale scansione di caricamenti, dovrebbe
      impostato a sì, per minimizzare la memoria uso. Se si fa utilizza lo
      script dopo la iniziale scansione di caricamenti, dovrebbe impostato a
      no, al fine per evitare ricaricare inutili duplicati dati all'interno
      memoria. In generale pratica, dovrebbe probabilmente essere impostata a
      sì, ma, se si farlo, voi sarà non in grado per utilizzare lo script per
      scopi diversi dalla scansione di caricamenti.
      * Non ha alcuna influenza in CLI modalità.
    "scan_log"
    - Il nome del file per registrare tutti i risultati di la scansione.
      Specificare un nome del file, o lasciare vuoto per disabilitarlo.
    "scan_kills"
    - Il nome del file per registrare tutti i record di bloccato o ucciso
      caricamenti. Specificare un nome del file, o lasciare vuoto per
      disabilitarlo.
    "ipaddr"
    - Dove trovare l'IP indirizzo di collegamento richiesta? (Utile per servizi
      come Cloudflare e simili) Predefinito = REMOTE_ADDR
      AVVISO: Non modificare questa se non sai quello che stai facendo!
    "forbid_on_block"
    - phpMussel dovrebbe inviare 403 intestazioni con il file caricamente
      bloccato messaggio, o tenere con il solito 200 OK?
      0 = No (200) [Predefinito], 1 Sì (403).
    "delete_on_sight"
    - Abilitando questa opzione sarà istruirà lo script per tentare
      immediatamente eliminare qualsiasi file trovato durante scansioni che
      corrisponde a qualsiasi i criteri di rilevazione, attraverso le firme o
      altrimenti. I file determinati ad essere "pulito" non verranno toccati.
      Nel caso degli archivi, l'intero archivio verrà eliminato
      (indipendentemente se il file all'origine è soltanto uno dei vari file
      contenuti all'interno dell'archivio o non). Nel caso di file caricamente
      scansione, solitamente, non è necessario attivare questa opzione, perché
      solitamente, php sarà automaticamente eliminerà il contenuto della cache
      quando l'esecuzione è terminata, il che significa che lo farà solitamente
      eliminare tutti i file caricati tramite al server tranne ciò che già è
      spostato, copiato o cancellato. L'opzione viene aggiunto qui come
      ulteriore misura di sicurezza per la molto paranoico e per coloro le cui
      copie di php non sempre comportarsi nel previsto modo.
      0 - Dopo la scansione, lasciare il file solo [Predefinito],
      1 - Dopo la scansione, se non pulite, immediatamente eliminarlo.
    "lang"
    - Specificare la predefinita lingua per phpMussel.
 "signatures" (Categoria)
 - Configurazione per firme.
   %%%_clamav = ClamAV firme (sia mains e daily).
   %%%_custom = Le vostre personalizzate firme (se hai scritto qualsiasi).
   %%%_mussel = phpMussel firme inclusi nel corrente set di firme che non è da
   ClamAV.
   - Verificare contro MD5 firme durante la scansione?
     0 = No, 1 = Yes [Default].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Verificare contro generali firme durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Verificare contro normalizzati ASCII firme durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Verificare PE (portatile eseguibile) files (EXE, DLL, ecc) contro PE
     Sezionale firme durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Verificare PE (portatile eseguibile) files (EXE, DLL, ecc) contro PE firme
     durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Verificare ELF file contro ELF firme durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Verificare Mach-O file (OSX, ecc) control Mach-O firme durante la
     scansione?
     0 = No, 1 = Sì [Predefinito].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Verificare grafica file contro grafica basato firme durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Verificare il contenuto dell'archivio contro archivio metadati firme
     durante la scansione?
     0 = No, 1 = Sì [Predefinito].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Verificare nomi del file against file nome basate firme durante la
     scansione?
     0 = No, 1 = Sì [Predefinito].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Permettere scansione con phpMussel_mail()?
     0 = No, 1 = Sì [Predefinito].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Firma lunghezza corrispondenza limitando opzioni. Modificata solo se si sa
     cosa si sta facendo. SD = Standard firme. RX = PCRE (Perl Compatible
     Regolari Espressioni, o "Regex") firme. FN = File nome firme. Se notate
     php termina fatalmente quando phpMussel tenta per scansione, tenta per
     abbassare i "max" valori seguito. Se possibile e conveniente, fatemi
     sapere quando questo accade ei risultati di quello il voi tentò.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   - phpMussel dovrebbe riportarlo quando i firme file sono mancanti o
     danneggiati? Se fail_silently è disabilitato, Mancanti e danneggiati file
     saranno riportato sulla scansione, e se fail_silently è abilitato,
     mancanti e danneggiati file saranno ignorato, con scansione riportato per
     quei file che non ha sono problemi. Questo dovrebbe essere generalmente
     lasciata sola a meno che sperimentando inaspettate terminazioni o simili
     problemi. 0 = Disabilitato [Predefinito], 1 = Abilitato.
     "fail_silently"
 "files" (Categoria)
 - Generale configurazione per la gestione dei file.
   "max_uploads"
   - Massimo numero di file per analizzare durante il file caricamenti
     scansione prima le terminazione del scansione e d'informare dell'utente
     che essi stai caricando troppo in una volta! Fornisce protezione contro un
     teorico attacco per cui un malintenzionato utente tenta per DDoS vostra
     sistema o CMS da sovraccaricamento phpMussel rallentare il php processo ad
     un brusco stop. Raccomandato: 10. Si potrebbe desiderare di aumentare o
     diminuire che numero basato sulla velocità del vostra sistema e hardware.
     Si noti che questo numero non tiene conto o includere il contenuto degli
     archivi.
   "filesize_limit"
   - File dimensione limite in KB. 65536 = 64MB [Predefinito], 0 = Nessun
     limite (sempre sul greylist), qualsiasi (positivo) numerico valore
     accettato. Questo può essere utile quando la configurazione di PHP limita
     la quantità di memoria che un processo può contenere o se i configurazione
     ha limitato la dimensione del file caricamenti.
   "filesize_response"
   - Cosa fare con i file che superano il file dimensione limite (se
     esistente). 0 - Whitelist, 1 - Blacklist [Predefinito].
   "filetype_whitelist" e "filetype_blacklist"
   - Se il vostro sistema permette solo determinati tipi di file per
     caricamenti, o se il vostra sistema esplicitamente negare determinati tipi
     di file, specificando i tipi di file nel whitelist e blacklist può
     aumentare la velocità a cui la scansione viene eseguita da permettendo lo
     script da ignora alcuni tipi di file. Il formato è CSV (valori separati da
     virgola). Se si desidera eseguire la scansione di tutti, invece del
     whitelist o blacklist, lasciare le variabili vuoti (fare questo sarà
     disabilitali).
   "check_archives"
   - Tenta per verifica il contenuto degli archivi?
     0 - No (no verifica), 1 - Sì (fare verifica) [Predefinito].
     * Al momento, solo verifica di ZIP e GZ file è supportato (verifica di
       TAR, RAR, CAB, 7z eccetera è supportato al momento).
     * Questo non è infallibile! Mentre mi assai raccomando che è attivato, non
       posso garantire che sarà sempre trovare tutto.
     * Anche essere consapevoli che verifica per archivio al momento è non
       ricorsiva per ZIPs (anche ho intendo a correggere questo ad alcuni tempo
       nel futuro, e GZ è ricorsiva).
   "filesize_archives"
   - Eredita file dimensione limite blacklist/whitelist al contenuto degli
     archivi? 0 - No (appena greylist tutto), 1 - Sì [Predefinito].
   "filetype_archives"
   - Eredita file tipi blacklist/whitelist al contenuto degli archivi?
     0 - No (appena greylist tutto), 1 - Sì [Predefinito].
   "max_recursion"
   - Massimo ricorsione profondità limite per gli archivi. Predefinito = 10.
 "attack_specific" (Categoria)
 - Configurazione per specifiche attacco rilevazioni (non basate sulle CVD).
   * Chameleon attacco rilevamento: 0 = Disabilitato, 1 = Abilitato.
   "chameleon_from_php"
   - Cercare per php magici numeri che non sono riconosciuti php file né
     archivi.
   "chameleon_from_exe"
   - Cercare per eseguibili magici numeri che non sono riconosciuti eseguibili
     né archivi e per eseguibili cui non sono corrette.
   "chameleon_to_archive"
   - Cercare per archivi di cui non sono corrette (Supportato: ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Cercare per office documenti di cui non sono corrette (Supportato: DOC,
     DOT, PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Cercare per immagini file di cui non sono corrette (Supportato: BMP, DIB,
     PNG, GIF, JPEG, JPG, XCF, PSD, PDD).
   "chameleon_to_pdf"
   - Cercare per PDF file di cui non sono corrette.
   "archive_file_extensions" e "archive_file_extensions_wc"
   - Riconosciute archivio file estensioni (formato è CSV; deve solo aggiungere
     o rimuovere quando problemi apparire; rimozione inutilmente può causare
     falsi positivi per archivio file, mentre aggiungendo inutilmente saranno
     essenzialmente whitelist quello che si sta aggiungendo dall'attacco
     specifico rilevamento; modificare con cautela; anche notare che questo non
     ha qualsiasi effetto su cui gli archivi possono e non possono essere
     analizzati dal contenuti livello). La lista, come da predefinito, è i
     formati utilizzati più comunemente attraverso la maggior parte dei sistemi
     e CMS, Ma apposta non è necessariamente completo.
   "general_commands"
   - Cercare contenuti dei file per generali comandi quali eval(), exec() e
     include()? 0 - No (no verifica) [Predefinito], 1 - Sì (fare verifica).
     Disattivare questa opzione se si intende caricare qualsiasi delle seguenti
     al vostra sistema o CMS tramite il browser: php, JavaScript, HTML, python,
     perl file e eccetera. Attivare questa opzione se non avete qualsiasi
     aggiuntivi protezioni sul vostro sistema e non intendono caricare tali
     file. Se si utilizza qualsiasi aggiuntivi protezione in collaborazione con
     phpMussel come ZB Block, vi è non necessità di attivare questa opzione,
     perché la maggior parte di ciò che phpMussel sarà cercare (nel contesto di
     questa opzione) sono duplicazioni di protezioni che sono già forniti.
   "block_control_characters"
   - Bloccare tutti i file contenenti i controlli caratteri (eccetto per nuove
     linee)? ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) Se si sta caricando solo normale
     testo, quindi si puó attivare questa opzione a fornire additionale
     protezione al vostro sistema. Ma, se si carica qualcosa di diverso da
     normale testo, abilitando questo opzione può causare falsi positivi.
     0 - Non bloccare [Predefinito], 1 - Bloccare.
   "corrupted_exe"
   - Corrotto file e parsare errori. 0 = Ignorare, 1 = Bloccare [Predefinito].
     Rilevare e bloccare i potenzialmente corrotti PE (portatile eseguibili)
     file? Spesso (ma non sempre), quando alcuni aspetti di un PE file sono
     corrotto o non può essere parsato correttamente, tale può essere
     indicativo di una virale infezione. I processi utilizzati dalla maggior
     parte dei antivirus programmi per rilevare i virus all'intero PE file
     richiedono parsare quei file in certi modi, di cui, se il programmatore di
     un virus è consapevole di, sarà specificamente provare di prevenire, al
     fine di abilitare loro virus di rimanere inosservato.
 "compatibility" (Categoria)
 - Compatibilità direttive per phpMussel.
    "ignore_upload_errors"
    - Questa direttiva dovrebbe generalmente essere SPENTO meno se necessario
      per la corretta funzionalità del phpMussel sul vostra sistema.
      Normalmente, quando spento, quando phpMussel rileva la presenza di
      elementi nella $_FILES array(), è tenterà di avviare una scansione dei
      file che tali elementi rappresentano, e, se tali elementi sono vuoti,
      phpMussel restituirà un errore messaggio. Questo è un comportamento
      adeguato per phpMussel. Tuttavia, per alcuni CMS, vuoti elementi nel
      $_FILES può avvenire come conseguenza del naturale comportamento di
      questi CMS, o errori possono essere segnalati quando non ce ne sono, nel
      qual caso, il normale comportamento per phpMussel sarà interferire con il
      normale comportamento di questi CMS. Se una tale situazione avvenire per
      voi, attivazione di questa opzione SU sarà istruirà phpMussel a non tenta
      avviare scansioni per tali vuoti elementi, ignorarli quando si trova ea
      non ritorno qualsiasi errore correlato messaggi, così permettendo
      proseguimento della pagina richiesta. 0 - SPENTO (OFF), 1 - SU (ON).

                                     ~ ~ ~                                     


 7. FIRMA FORMATO

 = MD5 FIRME =
   Tutte l'MD5 firme seguono il formato:
    HASH:FILESIZE:NAME
   Dove HASH è l'MD5 hash dell'intero file, FILESIZE è la totale dimensione del
   file e NAME è il nome per citare per quella firma.

 = FILENAME FIRME =
   Tutte le file nomi firme seguono il formato:
    NAME:FNRX
   Dove NAME è il nome per citare per quella firma e FNRX è la regolare
   espressione a verifica file nomi firme (non codificata) contra.

 = ARCHIVIO METADATI FIRME =
   Tutte l'archivio metadati firme seguono il formato:
    NAME:FILESIZE:CRC32
   Dove NAME è il nome per citare per quella firma, FILESIZE è la totale
   dimensione (non compresso) di un file contenuto all'interno
   dell'archivio e CRC32 è la CRC32 verifica numero di tale file.

 = TUTTO IL RESTO =
   Tutte le altre firme seguono il formato:
    NAME:HEX:FROM:TO
   Dove NAME è il nome per citare per quella firma e HEX è un esadecimale
   codificato segmento del file destinato essere verificato dal pertinente
   firma. FROM e TO sono opzionali parametri, indicando da cui ea cui
   posizioni nei sorgenti dati per verificare contra (non supportata dal mail
   funzione).

 = REGEX =
   Ogni forma di regex correttamente capito da php anche dovrebbe essere
   correttamente capito da phpMussel el sue firme. Ma, io suggerirei di
   prendere estrema cautela quando scrittura nuove regex basato firme, perché,
   se non sei certo quello stai facendo, ci possono essere molto irregolari e/o
   inaspettati risultati. Occhiata al sorgente codice di phpMussel se non sei
   certo sul contesto in cui le regolari espressioni dichiarazioni vengono
   parsato. Anche, ricordare che tutti i espressioni (ad eccezione per i file
   nomi, archivio metadati e l'MD5 espressioni) deve essere esadecimale
   codificato (tranne sintassi, naturalmente)!

 = DOVE METTERE PERSONALIZZATE FIRME? =
   Solo mettere personalizzate firme in quei file destinati personalizzate
   firme. Questi file dovrebbe contenere "_custom" nei loro nomi. Si dovrebbe
   anche evitare di modificare i predefiniti firme file, tranne sai esattamente
   cosa si sta facendo, perché, oltre ad essere una buona pratica in generale e
   oltre ad aiutare a distinguere tra le vostre firme proprie e le predefinite
   firme incluso con phpMussel, è bene tenere a modificare solo i file
   destinati per modificare, perché interferenza con i predefiniti firme file
   può causare loro di smettere di funzionare correttamente, a causa dei "map"
   file: I map file raccontano per phpMussel dove nei firma file a cercare per
   firme necessarie per phpMussel quando a richiesto, e queste map file possono
   diventare fuori sincronia con i loro associati firma file se chi firme file
   vengono interferito con. Si può mettere più o meno quello che vuoi nel
   vostre personalizzate firme, fino a quando si segue la corretta sintassi.
   Ma, stare attenti a verificare le nuove firme per falsi positivi in anticipo
   se avete intenzione di condividerli o utilizzarli in un vivo ambiente.

 = TIPI DI FIRME =
   I seguenti sono i tipi di firme utilizzate da phpMussel:
   - "MD5 Firme" (md5_*). Verificato contro l'MD5 hash dei contenuti e la
      dimensione del ogni file mirati per scansionare quello che non è sulla
      whitelist.
   - "Generali Firme" (general_*). Verificato contro i contenuti del ogni file
      mirati per scansionare quello che non è sulla whitelist.
   - "Normalizzati ASCII Firme" (ascii_*). Verificato contro i contenuti del
      ogni file mirati per scansionare quello che non è sulla whitelist.
   - "Generali Comandi" (hex_general_commands.csv). Verificato contro i
      contenuti del ogni file mirati per scansionare quello che non è sulla
      whitelist.
   - "Portatili Eseguibili Sezionale Firme" (pe_*). Verificato contro i
      contenuti del ogni file mirati per scansionare quello che non è sulla
      whitelist e verificato allo PE formato.
   - "Portatili Eseguibili Firme" (exe_*). Verificato contro i contenuti del
      ogni file mirati per scansionare quello che non è sulla whitelist e
      verificato allo PE formato.
   - "ELF Firme" (elf_*). Verificato contro i contenuti del ogni file mirati
      per scansionare quello che non è sulla whitelist e verificato allo ELF
      formato.
   - "Grafiche Firme" (graphics_*). Verificato contro i contenuti del ogni file
      mirati per scansionare quello che non è sulla whitelist e verificato come
      un conosciuto grafico file formato.
   - "Mach-O Firme" (macho_*). Verificato contro i contenuti del ogni file
      mirati per scansionare quello che non è sulla whitelist e verificato allo
      Mach-O formato.
   - "ZIP Metadati Firme" (metadata_*). Verificato contro l'CRC32 hash e la
      dimensione dell'iniziale file contenuto all'interno di qualsiasi file
      mirati per scansionare quello che non è sulla whitelist.
   - "Email Signatures" (mail_*). Verificato contro la $body variabile parsato
      a la phpMussel_mail() funzione, che è destinato a essere il corpo de
      email messaggi o simili entità (potenzialmente forum messaggi e
      etcetera).
     (Si noti che qualsiasi di queste firme possono essere facilmente
      disattivato tramite phpmussel.ini).


                                     ~ ~ ~                                     


 8. CONOSCIUTI COMPATIBILITÀ PROBLEMI

 PHP e PCRE
 - phpMussel richiede PHP e PCRE a eseguire ea funzionare correttamente. Senza
   php, o senza il PCRE estensione di PHP, phpMussel non sarà eseguirà o
   funzionare correttamente. Dovrebbe assicurarsi che il vostra sistema ha sia
   PHP e PCRE installati e disponibili prima di scaricare e installare
   phpMussel.

 ANTI-VIRUS SOFTWARE COMPATIBILITÀ

 Per la maggior parte, phpMussel dovrebbe essere compatibile abbastanza con la
 maggior parte dei antivirus software. Ma, conflitti sono stati riportati da un
 numero di utenti in passato. Queste informazioni qui di seguito è da
 VirusTotal.com, e descrive un certo numero di falsi positivi riportato dai
 vari anti-virus programmi contro phpMussel. Sebbene questa informazione non è
 un'assoluta garanzia di se o non si sarà verificheranno problemi di
 compatibilità tra phpMussel e il vostro anti-virus software, se il vostro
 software anti-virus è stati ha notato o ha bandierato contro phpMussel, si
 dovrebbe considerare sia disabilitarlo prima di lavorare con phpMussel o
 dovrebbe considerare l'alternative opzioni per sia il vostro anti-virus
 software o phpMussel.

 Questa informazione è stato lo scorso aggiornato 14 Agosto 2014 ed è in corso
 per TUTTE le versioni di phpMussel, dall'iniziale rilascio v0.1 fino
 all'ultima rilascio v0.4b al momento di scrivere questo.

 Ad-Aware                Senza noti problemi
 Agnitum                 Senza noti problemi
 AhnLab-V3               Senza noti problemi
 AntiVir                 Senza noti problemi
 Antiy-AVL               Senza noti problemi
 Avast                !  Riferisce "JS:ScriptSH-inf [Trj]" (tutti tranne v0.3d)
 AVG                     Senza noti problemi
 Baidu-International     Senza noti problemi
 BitDefender             Senza noti problemi
 Bkav                 !  Riferisce "VEX408f.Webshell" (v0.3 a v0.3c)
 ByteHero                Senza noti problemi
 CAT-QuickHeal           Senza noti problemi
 ClamAV                  Senza noti problemi
 CMC                     Senza noti problemi
 Commtouch            !  Riferisce "W32/GenBl.857A3D28!Olympus" (v0.3e solo)
 Comodo                  Senza noti problemi
 DrWeb                   Senza noti problemi
 Emsisoft                Senza noti problemi
 ESET-NOD32              Senza noti problemi
 F-Prot                  Senza noti problemi
 F-Secure                Senza noti problemi
 Fortinet                Senza noti problemi
 GData                !  Riferisce "Archive.Trojan.Agent.E7C7J7" (v0.3e solo)
 Ikarus               !  Riferisce "Trojan.JS.Agent" (v0.3g a v0.4b)
 Jiangmin                Senza noti problemi
 K7AntiVirus             Senza noti problemi
 K7GW                    Senza noti problemi
 Kaspersky               Senza noti problemi
 Kingsoft                Senza noti problemi
 Malwarebytes            Senza noti problemi
 McAfee                  Senza noti problemi
 McAfee-GW-Edition       Senza noti problemi
 Microsoft               Senza noti problemi
 MicroWorld-eScan        Senza noti problemi
 NANO-Antivirus          Senza noti problemi
 Norman               !  Riferisce "Kryptik.BQS" (tutti tranne v0.3d e v0.3e)
 nProtect                Senza noti problemi
 Panda                   Senza noti problemi
 Qihoo-360               Senza noti problemi
 Rising                  Senza noti problemi
 Sophos                  Senza noti problemi
 SUPERAntiSpyware        Senza noti problemi
 Symantec             !  Riferisce "WS.Reputation.1" (v0.3e a v0.3g)
 TheHacker               Senza noti problemi
 TotalDefense            Senza noti problemi
 TrendMicro              Senza noti problemi
 TrendMicro-HouseCall !  Riferisce "TROJ_GEN.F47V1219" (v0.3d e prima)
                      !  Riferisce "TROJ_GEN.F47V0312" (v0.3e solo)
 VBA32                   Senza noti problemi
 VIPRE                   Senza noti problemi
 ViRobot                 Senza noti problemi


                                     ~ ~ ~                                     


Ultimo Aggiornamento: 14 Agosto 2014 (2014.08.14).
EOF