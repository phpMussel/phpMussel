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
 * This file: Italian language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Pagina Principale</a> | <a href="?phpmussel-page=logout">Disconnettersi</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Disconnettersi</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Riconosciute archivio file estensioni (formato è CSV; deve solo aggiungere o rimuovere quando problemi apparire; rimozione inutilmente può causare falsi positivi per archivio file, mentre aggiungendo inutilmente saranno essenzialmente whitelist quello che si sta aggiungendo dall\'attacco specifico rilevamento; modificare con cautela; anche notare che questo non ha qualsiasi effetto su cui gli archivi possono e non possono essere analizzati dal contenuti livello). La lista, come da predefinito, è i formati utilizzati più comunemente attraverso la maggior parte dei sistemi e CMS, ma apposta non è necessariamente completo.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Bloccare tutti i file contenenti i controlli caratteri (eccetto per nuove linee)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Se si sta caricando solo normale testo, quindi si puó attivare questa opzione a fornire additionale protezione al vostro sistema. Ma, se si carica qualcosa di diverso da normale testo, abilitando questo opzione può causare falsi positivi. False = Non bloccare [Predefinito]; True = Bloccare.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Cercare per eseguibili magici numeri che non sono riconosciuti eseguibili né archivi e per eseguibili cui non sono corrette. False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Cercare per PHP magici numeri che non sono riconosciuti PHP file né archivi. False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Cercare per archivi di cui non sono corrette (Supportato: BZ, GZ, RAR, ZIP, RAR, GZ). False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Cercare per office documenti di cui non sono corrette (Supportato: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Cercare per immagini file di cui non sono corrette (Supportato: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Cercare per PDF file di cui non sono corrette. False = Disattivato; True = Attivato.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Corrotto file e parsare errori. False = Ignorarli; True = Bloccarli [Predefinito]. Rilevare e bloccare i potenzialmente corrotti PE (portatile eseguibili) file? Spesso (ma non sempre), quando alcuni aspetti di un PE file sono corrotto o non può essere parsato correttamente, tale può essere indicativo di una virale infezione. I processi utilizzati dalla maggior parte dei antivirus programmi per rilevare i virus all\'intero PE file richiedono parsare quei file in certi modi, di cui, se il programmatore di un virus è consapevole di, sarà specificamente provare di prevenire, al fine di abilita loro virus di rimanere inosservato.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Soglia per la lunghezza dei grezzi dati dove decodificare comandi dovrebbe essere rilevati (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Predefinito = 512KB. Un zero o un nullo valore disabilita la soglia (rimuovere tale limitazione basata sulla dimensione dei file).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Soglia per la lunghezza dei dati grezzi dove phpMussel è permesso di leggere e scansione (nel caso in cui vi siano notevoli problemi di prestazioni durante la scansione). Predefinito = 32MB. Un zero o un nullo valore disabilita la soglia. In generale, questo valore non dovrebbe essere meno quella media dimensione dei file che si desidera e si aspettano di ricevere al vostro server o al vostro web sito, non dovrebbe essere più di la filesize_limit direttiva, e non dovrebbe essere più di circa un quinto del totale ammissibile allocazione della memoria concesso al PHP tramite il file di configurazione "php.ini". Questa direttiva esiste per tenta di evitare avendo phpMussel utilizzare troppa memoria (di cui sarebbe impedirebbe di essere capace di completare la file scansione correttamente per i file piú d\'una certa dimensione).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Questa direttiva dovrebbe generalmente essere SPENTO meno se necessario per la corretta funzionalità del phpMussel sul vostra sistema. Normalmente, quando spento, quando phpMussel rileva la presenza di elementi nella <code>$_FILES</code> array(), è tenterà di avviare una scansione dei file che tali elementi rappresentano, e, se tali elementi sono vuoti, phpMussel restituirà un errore messaggio. Questo è un comportamento adeguato per phpMussel. Tuttavia, per alcuni CMS, vuoti elementi nel <code>$_FILES</code> può avvenire come conseguenza del naturale comportamento di questi CMS, o errori possono essere segnalati quando non ce ne sono, nel qual caso, il normale comportamento per phpMussel sarà interferire con il normale comportamento di questi CMS. Se una tale situazione avvenire per voi, attivazione di questa opzione SU sarà istruirà phpMussel a non tenta avviare scansioni per tali vuoti elementi, ignorarli quando si trova ea non ritorno qualsiasi errore correlato messaggi, così permettendo proseguimento della pagina richiesta. False = SPENTO/OFF; True = SU/ON.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Se vi aspettare o intendere solo di permettere le immagini da caricare al vostro sistema o CMS, e se assolutamente non richiedono qualsiasi file diversi da immagini essere caricare per il vostro sistema o CMS, questa direttiva dovrebbe essere SU, ma dovrebbe altrimenti essere SPENTO. Se questa direttiva è SU, che istruirà phpMussel di indiscriminatamente bloccare tutti i caricati file identificati come file non-immagine, senza scansionali. Questo può ridurre il tempo di processo e l\'utilizzo della memoria per tentati caricamenti di non-immagine file. False = SPENTO/OFF; True = SU/ON.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Rilevi e blocchi archivi criptati? Perché phpMussel non è in grado di verifica del contenuto degli archivi criptati, è possibile che la archivi criptati può essere usato da un attaccante verifieracome mezzo di tenta di bypassare phpMussel, verificatore anti-virus e altri tali protezioni. Istruire phpMussel di bloccare qualsiasi archivi criptati che si trovato potrebbe potenzialmente contribuire a ridurre il rischio associato a questi tali possibilità. False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_files_check_archives'] = 'Tenta per verifica il contenuti degli archivi? False = No (no verifica); True = Sì (fare verifica) [Predefinito]. Al momento, gli unici formati di archiviazione e compressione supportati sono BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR e ZIP (formati di archiviazione e compressione RAR, CAB, 7z e eccetera non sono supportate al momento). Questo non è infallibile! Mentre mi assai raccomando che è attivato, non posso garantire che sarà sempre trovare tutto. Anche essere consapevoli che verifica per archivio al momento è non ricorsiva per PHAR o ZIP formati.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Eredita file dimensione limite blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].';
$phpMussel['lang']['config_files_filesize_limit'] = 'File dimensione limite in KB. 65536 = 64MB [Predefinito]; 0 = Nessun limite (sempre sul greylist), qualsiasi (positivo) numerico valore accettato. Questo può essere utile quando la configurazione di PHP limita la quantità di memoria che un processo può contenere o se i configurazione ha limitato la dimensione dei file caricamenti.';
$phpMussel['lang']['config_files_filesize_response'] = 'Cosa fare con i file che superano il file dimensione limite (se esistente). False = Whitelist; True = Blacklist [Predefinito].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Eredita file tipi blacklist/whitelist al contenuti degli archivi? False = No (appena greylist tutto); True = Sì [Predefinito].';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Se il vostro sistema permette solo determinati tipi di file per caricamenti, o se il vostra sistema esplicitamente negare determinati tipi di file, specificando i tipi di file nel whitelist, blacklist e/o greylist può aumentare la velocità a cui la scansione viene eseguita da permettendo lo script da ignora alcuni tipi di file. Il formato è CSV (valori separati da virgola). Se si desidera eseguire la scansione tutti, invece del whitelist, la blacklist o la greylist, lasciare le variabili vuoti; Fare questo sarà disabilitali. Logico ordine del trattamento è: Se il tipo di file è nel whitelist, non scansiona e non blocca il file, e non verificare il file contra la blacklist o la greylist. Se il tipo di file è nel blacklist, non scansiona il file ma bloccarlo comunque, e non verificar il file contra la greylist. Se il greylist è vuoto o se il greylist non è vuota e il tipo di file è nel greylist, scansiona il file come per normale e determinare se bloccarlo sulla base dei risultati della scansione, ma se il greylist non è vuoto e il tipo di file non è nel greylist, trattare il file come se è nel blacklist, quindi non scansionarlo ma bloccarlo comunque. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Massimo ricorsione profondità limite per gli archivi. Predefinito = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Massimo numero di file per analizzare durante il file caricamenti scansione prima le terminazione del scansione e d\'informare dell\'utente che essi stai caricando troppo in una volta! Fornisce protezione contro un teorico attacco per cui un malintenzionato utente tenta per DDoS vostra sistema o CMS da sovraccaricamento phpMussel rallentare il PHP processo ad un brusco stop. Raccomandato: 10. Si potrebbe desiderare di aumentare o diminuire che numero basato sulla velocità del vostra sistema e hardware. Si noti che questo numero non tiene conto o includere il contenuti degli archivi.';
$phpMussel['lang']['config_general_cleanup'] = 'Disimpostare le script variabili e la cache dopo l\'esecuzione? False = No; True = Sì [Predefinito]. Se si non utilizza lo script dopo l\'iniziale scansione di caricamenti, dovrebbe impostato a <code>true</code> (sì), per minimizzare la memoria uso. Se si fa utilizza lo script dopo l\'iniziale scansione di caricamenti, dovrebbe impostato a <code>false</code> (no), al fine per evitare ricaricare inutili duplicati dati all\'interno memoria. In generale pratica, dovrebbe probabilmente essere impostata a <code>true</code> (sì), ma, se si farlo, voi sarà non in grado per utilizzare lo script per scopi diversi dalla scansione di caricamenti. Non ha alcuna influenza in modalità CLI.';
$phpMussel['lang']['config_general_default_algo'] = 'Definisce quale algoritmo da utilizzare per tutte le password e le sessioni in futuro. Opzioni: PASSWORD_DEFAULT (predefinito), PASSWORD_BCRYPT, PASSWORD_ARGON2I (richiede PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Abilitando questa opzione sarà istruirà lo script per tentare immediatamente eliminare qualsiasi file trovato durante scansioni che corrisponde a qualsiasi i criteri di rilevazione, attraverso le firme o altrimenti. I file determinati ad essere "pulito" non verranno toccati. Nel caso degli archivi, l\'intero archivio verrà eliminato (indipendentemente se il file all\'origine è soltanto uno dei vari file contenuti all\'interno dell\'archivio o non). Nel caso di file caricamente scansione, solitamente, non è necessario attivare questa opzione, perché solitamente, PHP sarà automaticamente eliminerà il contenuto della cache quando l\'esecuzione è terminata, il che significa che lo farà solitamente eliminare tutti i file caricati tramite al server tranne ciò che già è spostato, copiato o cancellato. L\'opzione viene aggiunto qui come ulteriore misura di sicurezza per coloro le cui copie di PHP non sempre comportarsi nel previsto modo. False = Dopo la scansione, lasciare il file solo [Predefinito]; True = Dopo la scansione, se non pulite, immediatamente eliminarlo.';
$phpMussel['lang']['config_general_disable_cli'] = 'Disabilita CLI? Modalità CLI è abilitato per predefinito, ma a volte può interferire con alcuni strumenti di test (come PHPUnit, per esempio) e altre applicazioni basate su CLI. Se non è necessario disattivare la modalità CLI, si dovrebbe ignorare questa direttiva. False = Abilita CLI [Predefinito]; True = Disabilita CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Disabilita l\'accesso front-end? L\'accesso front-end può rendere phpMussel più gestibile, ma può anche essere un potenziale rischio per la sicurezza. Si consiglia di gestire phpMussel attraverso il back-end, quando possibile, ma l\'accesso front-end è previsto per quando non è possibile. Mantenerlo disabilitato tranne se hai bisogno. False = Abilita l\'accesso front-end; True = Disabilita l\'accesso front-end [Predefinito].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Disabilita webfonts? True = Sì; False = No [Predefinito].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Attiva il supporto per i plugin di phpMussel? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel dovrebbe rispondere con 403 header con il file caricamente bloccato messaggio, o rimanere con il solito 200 OK? False = No (200); True = Sì (403) [Predefinito].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'File per la registrazione di l\'accesso front-end tentativi di accesso. Specificare un nome di file, o lasciare vuoto per disabilitare.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Quando la honeypot modalità è abilitata, phpMussel tenterà di mettere in quarantena ogni file caricamenti che esso incontra, indipendentemente di se il file che essere caricato corrisponde d\'alcuna incluso firma, e zero reale scansionare o analisi di quei tentati file caricati sarà avvenire. Questa funzionalità dovrebbe essere utile per coloro che desiderano utilizzare phpMussel a fini di virus/malware ricerca, ma non si raccomandato di abilitare questa funzionalità se l\'uso previsto de phpMussel da parte dell\'utente è per l\'effettivo scansione dei file caricamenti né raccomandato di utilizzare la funzionalità di honeypot per fini diversi da l\'uso de honeypot. Da predefinita, questo opzione è disattivato. False = Disattivato [Predefinito]; True = Attivato.';
$phpMussel['lang']['config_general_ipaddr'] = 'Dove trovare l\'indirizzo IP di collegamento richiesta? (Utile per servizi come Cloudflare e simili) Predefinito = REMOTE_ADDR. AVVISO: Non modificare questa se non sai quello che stai facendo!';
$phpMussel['lang']['config_general_lang'] = 'Specifica la lingua predefinita per phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Abilita la modalità di manutenzione? True = Sì; False = No [Predefinito]. Disattiva tutto tranne il front-end. A volte utile per l\'aggiornamento del CMS, dei framework, ecc.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Numero massimo di tentativi di accesso (front-end). Predefinito = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Come preferisci che i numeri siano visualizzati? Seleziona l\'esempio che ti sembra più corretto.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel è capace di mettere in quarantena contrassegnati tentati file caricamenti in isolamento all\'interno della phpMussel vault, se questo è qualcosa che si vuole fare. L\'ordinario utenti di phpMussel che semplicemente desiderano proteggere i loro website o hosting environment senza avendo profondo interesse ad analizzare qualsiasi contrassegnati tentati file caricamenti dovrebbe lasciare questa funzionalità disattivata, ma tutti gli utenti interessati ad ulteriori analisi di contrassegnati tentati file caricamenti per la ricerca di malware o per simili cose dovrebbe attivare questa funzionalità. Quarantena di contrassegnati tentati file caricamenti a volte può aiutare anche in debug falsi positivi, se questo è qualcosa che si accade di frequente per voi. Per disattivare la funzionalità di quarantena, lasciare vuota la direttiva <code>quarantine_key</code>, o cancellare i contenuti di tale direttiva, se non già è vuoto. Per abilita la funzionalità di quarantena, immettere alcun valore nella direttiva. Il <code>quarantine_key</code> è un importante aspetto di sicurezza della funzionalità di quarantena richiesto come un mezzo per prevenire la funzionalità di quarantena di essere sfruttati da potenziali aggressori e come mezzo per prevenire potenziale esecuzione di dati memorizzati all\'interno della quarantena. Il <code>quarantine_key</code> dovrebbe essere trattato nello stesso modo come le password: Più lunga è la migliore, e proteggila ermeticamente. Per la migliore effetto, utilizzare in combinazione con <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'La massima permesso dimensione del file dei file essere quarantena. File di dimensioni superiori a questo valore NON verranno quarantena. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la vostra quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul vostro servizio di hosting. Predefinito = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'La massima permesso utilizzo della memoria per la quarantena. Se la totale memoria utilizzata dalla quarantena raggiunge questo valore, i più vecchi file in quarantena vengono eliminati fino a quando la totale memoria utilizzata non raggiunge questo valore. Questa direttiva è importante per rendere più difficile per qualsiasi potenziali aggressori di inondare la tua quarantena con indesiderati dati potenzialmente causare un eccessivo utilizzo dei dati sul vostro servizio di hosting. Predefinito = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Per quanto tempo deve phpMussel cache i risultati della scansione? Il valore è il numero di secondi per memorizzare nella cache i risultati della scansione per. Predefinito valore è 21600 secondi (6 ore); Un valore pari a 0 disabilita il caching dei risultati di scansione.';
$phpMussel['lang']['config_general_scan_kills'] = 'Il nome del file per registrare tutti i record di bloccato o ucciso caricamenti. Specificare un nome del file, o lasciare vuoto per disattivarlo.';
$phpMussel['lang']['config_general_scan_log'] = 'Il nome del file per registrare tutti i risultati di la scansione. Specificare un nome del file, o lasciare vuoto per disattivarlo.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Il nome del file per registrare tutti i risultati di la scansione (utilizzando un formato serializzato). Specificare un nome del file, o lasciare vuoto per disattivarlo.';
$phpMussel['lang']['config_general_statistics'] = 'Monitorare le statistiche di utilizzo di phpMussel? True = Sì; False = No [Predefinito].';
$phpMussel['lang']['config_general_timeFormat'] = 'Il formato della data/ora di notazione usata da phpMussel. Ulteriori opzioni possono essere aggiunti su richiesta.';
$phpMussel['lang']['config_general_timeOffset'] = 'Fuso orario offset in minuti.';
$phpMussel['lang']['config_general_timezone'] = 'Il vostro fuso orario.';
$phpMussel['lang']['config_general_truncate'] = 'Troncare i file di log quando raggiungono una determinata dimensione? Il valore è la dimensione massima in B/KB/MB/GB/TB che un file di log può crescere prima di essere troncato. Il valore predefinito di 0KB disattiva il troncamento (i file di log possono crescere indefinitamente). Nota: Si applica ai singoli file di log! La dimensione dei file di log non viene considerata collettivamente.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Ci sono particolare firme di phpMussel che sono destinato a identificare sospetti e potenzialmente maligno qualità dei file che vengono essere caricati senza in sé identificando i file che vengono essere caricati in particolare ad essere maligno. Questo "threshold" (soglia) valore dice phpMussel cosa che il totale massimo peso di sospetti e potenzialmente maligno qualità dei file che vengono essere caricati che è ammissibile è prima che quei file devono essere contrassegnati come maligno. La definizione di peso in questo contesto è il totale numero di sospetti e potenzialmente maligno qualità identificato. Per predefinito, questo valore viene impostato su 3. Un inferiore valore generalmente sarà risultare di una maggiore presenza di falsi positivi ma una maggior numero di file essere contrassegnato come maligno, mentre una maggiore valore generalmente sarà risultare di un inferiore presenza di falsi positivi ma un inferiore numero di file essere contrassegnato come maligno. È generalmente meglio di lasciare questo valore a suo predefinito a meno che si incontrare problemi ad esso correlati.';
$phpMussel['lang']['config_signatures_Active'] = 'Un elenco dei file di firme attivi, delimitati da virgole.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di adware? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di sfiguramenti e sfiguratori? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Dovrebbe phpMussel rilevare e bloccare i file crittografati? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di scherzo/inganno malware/virus? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di confezionatori e dati confezionati? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di PUAs/PUPs? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Dovrebbe phpMussel utilizzare le firme per il rilevamento di shell script? False = No; True = Sì [Predefinito].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Dovrebbe phpMussel rapporto quando le estensioni sono mancanti? Se <code>fail_extensions_silently</code> è disattivato, mancanti estensioni saranno riportato sulla scansione, e se <code>fail_extensions_silently</code> è abilitato, mancanti estensioni saranno ignorato, con scansione riportando per quei file che non ha sono problemi. La disattivazione di questa direttiva potrebbe potenzialmente aumentare la sicurezza, ma può anche portare ad un aumento di falsi positivi. False = Disattivato; True = Attivato [Predefinito].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Dovrebbe phpMussel rapporto quando le file di firme sono mancanti o danneggiati? Se <code>fail_silently</code> è disattivato, mancanti e danneggiati file saranno riportato sulla scansione, e se <code>fail_silently</code> è abilitato, mancanti e danneggiati file saranno ignorato, con scansione riportando per quei file che non ha sono problemi. Questo dovrebbe essere generalmente lasciata sola a meno che sperimentando inaspettate terminazioni o simili problemi. False = Disattivato; True = Attivato [Predefinito].';
$phpMussel['lang']['config_template_data_css_url'] = 'Il modello file per i temi personalizzati utilizzi esterni CSS proprietà, mentre il modello file per i temi personalizzati utilizzi interni CSS proprietà. Per istruire phpMussel di utilizzare il modello file per i temi personalizzati, specificare l\'indirizzo pubblico HTTP dei CSS file dei suoi tema personalizzato utilizzando la variabile <code>css_url</code>. Se si lascia questo variabile come vuoto, phpMussel utilizzerà il modello file per il predefinito tema.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Ingrandimento del carattere. Predefinito = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Tema predefinito da utilizzare per phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Per quanto tempo (in secondi) dovrebbe i risultati delle API richieste essere memorizzati nella cache per? Predefinito è 3600 secondi (1 ora).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Abilita API richieste per l\'API di Google Safe Browsing quando le API chiave necessarie è definito.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Abilita API richieste per l\'API di hpHosts quando impostato su true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Numero massimo di richieste per l\'API di eseguire per iterazione di scansione individuo. Perché ogni richiesta supplementare per l\'API farà aggiungere al tempo totale necessario per completare ogni iterazione di scansione, si potrebbe desiderare di stipulare una limitazione al fine di accelerare il processo di scansione. Quando è impostato su 0, no tale ammissibile numero massimo sarà applicata. Impostato su 10 per impostazione predefinite.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Cosa fare se il ammissibile numero massimo di richieste per l\'API è superato? False = Fare nulla (continuare il processo) [Predefinito]; True = Segnare/bloccare il file.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Facoltativamente, phpMussel è in grado di scansionare dei file utilizzando il Virus Total API come un modo per fornire un notevolmente migliorato livello di protezione contro virus, trojan, malware e altre minacce. Per predefinita, la scansionare dei file utilizzando il Virus Total API è disattivato. Per abilitarlo, una API chiave da Virus Total è richiesta. A causa del significativo vantaggio che questo potrebbe fornire a voi, è qualcosa che consiglio vivamente di attivare. Tuttavia, si prega di notare che per utilizzare il Virus Total API, è necessario d\'accettare i Termini di Servizio (Terms of Service) e rispettare tutte le orientamenti descritto nella documentazione di Virus Total! Tu NON sei autorizzato a utilizzare questa funzionalità TRANNE SE: Hai letto e accettato i Termini di Servizio (Terms of Service) di Virus Total e le sue API. Hai letto e si capisce, come minimo, il preambolo del Virus Total Pubblica API documentazione (tutto dopo "VirusTotal Public API v2.0" ma prima "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Secondo a la Virus Total API documentazione, è limitato a un massimo di 4 richieste di qualsiasi natura in un dato 1 minuto tempo periodo. Se tu esegue una honeyclient, honeypot o qualsiasi altro automazione che sta fornire risorse a VirusTotal e non solo recuperare rapporti si ha diritto a un più alto tasso di richiesta quota. Per predefinita, phpMussel rigorosamente rispetti questi limiti, ma a causa della possibilità di tali tassi quote essere aumentati, questi due direttivi sono forniti come un mezzo per voi per istruire phpMussel da quale limite si deve rispettare. A meno che sei stato richiesto di farlo, non è raccomandato per voi per aumentare questi valori, ma, se hai incontrati problemi relativi a raggiungere il vostro tasso quota, diminuendo questi valori <em><strong>POTREBBE</strong></em> a volte aiutare nel lavoro attraverso questi problemi. Il vostro tasso limite è determinato come <code>vt_quota_rate</code> richieste di qualsiasi natura in un dato <code>vt_quota_time</code> minuto tempo periodo.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Vedi descrizione precedente).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Per predefinita, phpMussel limiterà quali file ciò scansiona utilizzando il Virus Total API ai quei file che considera "sospettose". Facoltativamente, è possibile modificare questa restrizione per mezzo di modificando il valore del <code>vt_suspicion_level</code> direttiva.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Dovrebbe phpMussel applica i risultati della scansione utilizzando il Virus Total API come rilevamenti o il ponderazione rilevamenti? Questa direttiva esiste, perché, sebbene scansione di un file utilizzando più motori (come Virus Total fa) dovrebbe risulta in un maggiore tasso di rilevamenti (e quindi in un maggiore numero di maligni file essere catturati), può anche risulta in un maggiore numero di falsi positivi, e quindi, in certe circostanze, i risultati della scansione possono essere meglio utilizzato come un punteggio di confidenza anziché come una conclusione definitiva. Se viene utilizzato un valore di 0, i risultati della scansione utilizzando il Virus Total API saranno applicati come rilevamenti, e quindi, se qualsiasi motori utilizzati da Virus Total che marca il file sottoposto a scansione come maligno, phpMussel considererà il file come maligno. Se qualsiasi altro valore è utilizzato, i risultati della scansione utilizzando il Virus Total API saranno applicati come ponderazione rilevamenti, e quindi, il numero di motori utilizzati da Virus Total marcando il file sottoposto a scansione come maligno servirà come un punteggio di confidenza (o ponderazione rilevamenti) per se il file sottoposto a scansione deve essere considerato maligno per phpMussel (il valore utilizzato rappresenterà il minimo punteggio di confidenza o ponderazione richiesto per essere considerato maligno). Un valore di 0 è utilizzato per predefinita.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'Il pacchetto principale (senza le firme, la documentazione, e la configurazione).';
$phpMussel['lang']['field_activate'] = 'Attivarlo';
$phpMussel['lang']['field_clear_all'] = 'Revoca tutto';
$phpMussel['lang']['field_component'] = 'Componente';
$phpMussel['lang']['field_create_new_account'] = 'Crea un nuovo account';
$phpMussel['lang']['field_deactivate'] = 'Disattivarlo';
$phpMussel['lang']['field_delete_account'] = 'Elimina un account';
$phpMussel['lang']['field_delete_all'] = 'Eliminare tutto';
$phpMussel['lang']['field_delete_file'] = 'Eliminare';
$phpMussel['lang']['field_download_file'] = 'Scaricare';
$phpMussel['lang']['field_edit_file'] = 'Modificare';
$phpMussel['lang']['field_false'] = 'False (Falso)';
$phpMussel['lang']['field_file'] = 'File';
$phpMussel['lang']['field_filename'] = 'Nome del file: ';
$phpMussel['lang']['field_filetype_directory'] = 'Elenco';
$phpMussel['lang']['field_filetype_info'] = '{EXT} File';
$phpMussel['lang']['field_filetype_unknown'] = 'Sconosciuto';
$phpMussel['lang']['field_install'] = 'Installarlo';
$phpMussel['lang']['field_latest_version'] = 'Ultima Versione';
$phpMussel['lang']['field_log_in'] = 'Accedi';
$phpMussel['lang']['field_more_fields'] = 'Più Campi';
$phpMussel['lang']['field_new_name'] = 'Nuovo nome:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Opzioni';
$phpMussel['lang']['field_password'] = 'Password';
$phpMussel['lang']['field_permissions'] = 'Permessi';
$phpMussel['lang']['field_quarantine_key'] = 'Chiave di quarantena';
$phpMussel['lang']['field_rename_file'] = 'Rinominare';
$phpMussel['lang']['field_reset'] = 'Azzerare';
$phpMussel['lang']['field_restore_file'] = 'Ripristinare';
$phpMussel['lang']['field_set_new_password'] = 'Imposta una nuova password';
$phpMussel['lang']['field_size'] = 'Dimensione Totale: ';
$phpMussel['lang']['field_size_bytes'] = 'byte';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Status';
$phpMussel['lang']['field_system_timezone'] = 'Utilizza il fuso orario predefinito del sistema.';
$phpMussel['lang']['field_true'] = 'True (Vero)';
$phpMussel['lang']['field_uninstall'] = 'Disinstallarlo';
$phpMussel['lang']['field_update'] = 'Aggiornarlo';
$phpMussel['lang']['field_update_all'] = 'Aggiorna tutto';
$phpMussel['lang']['field_upload_file'] = 'Carica nuovo file';
$phpMussel['lang']['field_username'] = 'Nome Utente';
$phpMussel['lang']['field_your_version'] = 'La Vostra Versione';
$phpMussel['lang']['header_login'] = 'Per favore accedi per continuare.';
$phpMussel['lang']['label_active_config_file'] = 'File di configurazione attivo: ';
$phpMussel['lang']['label_blocked'] = 'Caricamenti bloccati';
$phpMussel['lang']['label_branch'] = 'Branch più recente stabile:';
$phpMussel['lang']['label_events'] = 'Scansioni eventi';
$phpMussel['lang']['label_flagged'] = 'Oggetti contrassegnati';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Dati di cache e file temporanei';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'Utilizzo del disco da parte di phpMussel: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Spazio libero su disco: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Utilizzo del disco totale: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Spazio totale su disco: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Componente aggiorna metadati';
$phpMussel['lang']['label_hide'] = 'Nascondere';
$phpMussel['lang']['label_os'] = 'Sistema operativo utilizzata:';
$phpMussel['lang']['label_other'] = 'Altro';
$phpMussel['lang']['label_other-Active'] = 'File di firme attivi';
$phpMussel['lang']['label_other-Since'] = 'Data d\'inizio';
$phpMussel['lang']['label_php'] = 'Versione PHP utilizzata:';
$phpMussel['lang']['label_phpmussel'] = 'Versione phpMussel utilizzata:';
$phpMussel['lang']['label_quarantined'] = 'Caricamenti in quarantena';
$phpMussel['lang']['label_sapi'] = 'SAPI utilizzata:';
$phpMussel['lang']['label_scanned_objects'] = 'Oggetti scansionati';
$phpMussel['lang']['label_scanned_uploads'] = 'Caricamenti scansionati';
$phpMussel['lang']['label_show'] = 'Mostrare';
$phpMussel['lang']['label_size_in_quarantine'] = 'Dimensione in quarantena: ';
$phpMussel['lang']['label_stable'] = 'Più recente stabile:';
$phpMussel['lang']['label_sysinfo'] = 'Informazioni sul sistema:';
$phpMussel['lang']['label_tests'] = 'Test:';
$phpMussel['lang']['label_unstable'] = 'Più recente instabile:';
$phpMussel['lang']['label_upload_date'] = 'Data del caricamento: ';
$phpMussel['lang']['label_upload_hash'] = 'Hash del caricamento: ';
$phpMussel['lang']['label_upload_origin'] = 'L\'origine del caricamento: ';
$phpMussel['lang']['label_upload_size'] = 'Dimensione del caricamento: ';
$phpMussel['lang']['link_accounts'] = 'Utenti';
$phpMussel['lang']['link_config'] = 'Configurazione';
$phpMussel['lang']['link_documentation'] = 'Documentazione';
$phpMussel['lang']['link_file_manager'] = 'File Manager';
$phpMussel['lang']['link_home'] = 'Pagina Principale';
$phpMussel['lang']['link_logs'] = 'File di Log';
$phpMussel['lang']['link_quarantine'] = 'Quarantena';
$phpMussel['lang']['link_statistics'] = 'Statistiche';
$phpMussel['lang']['link_textmode'] = 'Formattazione del testo: <a href="%1$sfalse">Semplice</a> – <a href="%1$strue">Formattato</a>';
$phpMussel['lang']['link_updates'] = 'Aggiornamenti';
$phpMussel['lang']['link_upload_test'] = 'Carica Testare';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Log selezionato non esiste!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Nessun file di log disponibili.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Nessun file di log selezionato.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Numero massimo di tentativi di accesso superato; Accesso negato.';
$phpMussel['lang']['previewer_days'] = 'Giorni';
$phpMussel['lang']['previewer_hours'] = 'Ore';
$phpMussel['lang']['previewer_minutes'] = 'Minuti';
$phpMussel['lang']['previewer_months'] = 'Mesi';
$phpMussel['lang']['previewer_seconds'] = 'Secondi';
$phpMussel['lang']['previewer_weeks'] = 'Settimane';
$phpMussel['lang']['previewer_years'] = 'Anni';
$phpMussel['lang']['response_accounts_already_exists'] = 'Un account con quel nome utente esiste già!';
$phpMussel['lang']['response_accounts_created'] = 'Account creato con successo!';
$phpMussel['lang']['response_accounts_deleted'] = 'Account eliminato con successo!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Questo account non esiste.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Password aggiornato con successo!';
$phpMussel['lang']['response_activated'] = 'Attivato con successo.';
$phpMussel['lang']['response_activation_failed'] = 'Non poteva essere attivato!';
$phpMussel['lang']['response_checksum_error'] = 'Errore di checksum! File respinto!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Componente installato con successo.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Componente disinstallato con successo.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Componente aggiornato con successo.';
$phpMussel['lang']['response_component_uninstall_error'] = 'C\'è stato un errore durante il tentativo di disinstallare il componente.';
$phpMussel['lang']['response_configuration_updated'] = 'Configurazione aggiornato con successo.';
$phpMussel['lang']['response_deactivated'] = 'Disattivato con successo.';
$phpMussel['lang']['response_deactivation_failed'] = 'Non poteva essere disattivato!';
$phpMussel['lang']['response_delete_error'] = 'Non riuscito a eliminare!';
$phpMussel['lang']['response_directory_deleted'] = 'Elenco eliminato con successo!';
$phpMussel['lang']['response_directory_renamed'] = 'Elenco rinominato con successo!';
$phpMussel['lang']['response_error'] = 'Errore';
$phpMussel['lang']['response_failed_to_install'] = 'Non è riuscito ad installare!';
$phpMussel['lang']['response_failed_to_update'] = 'Non è riuscito ad aggiornare!';
$phpMussel['lang']['response_file_deleted'] = 'File eliminato con successo!';
$phpMussel['lang']['response_file_edited'] = 'File modificato con successo!';
$phpMussel['lang']['response_file_renamed'] = 'File rinominato con successo!';
$phpMussel['lang']['response_file_restored'] = 'File ripristinato con successo!';
$phpMussel['lang']['response_file_uploaded'] = 'File caricato con successo!';
$phpMussel['lang']['response_login_invalid_password'] = 'Accedi non riuscito! Password non valida!';
$phpMussel['lang']['response_login_invalid_username'] = 'Accedi non riuscito! Nome utente non esiste!';
$phpMussel['lang']['response_login_password_field_empty'] = 'L\'input password era vuoto!';
$phpMussel['lang']['response_login_username_field_empty'] = 'L\'input nome utente era vuoto!';
$phpMussel['lang']['response_rename_error'] = 'Non riuscito a rinominare!';
$phpMussel['lang']['response_restore_error_1'] = 'Failed to restore! File corrotto!';
$phpMussel['lang']['response_restore_error_2'] = 'Failed to restore! La chiave di quarantena è errata!';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistiche revocate.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Aggiornato già.';
$phpMussel['lang']['response_updates_not_installed'] = 'Componente non installato!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Componente non installato (richiede PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Non aggiornato!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Non aggiornato (si prega di aggiornare manualmente)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Non aggiornato (richiede PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Incapace di determinare.';
$phpMussel['lang']['response_upload_error'] = 'Non riuscito a caricare!';
$phpMussel['lang']['state_complete_access'] = 'Accesso completo';
$phpMussel['lang']['state_component_is_active'] = 'Componente è attivo.';
$phpMussel['lang']['state_component_is_inactive'] = 'Componente è inattivo.';
$phpMussel['lang']['state_component_is_provisional'] = 'Componente è provvisorio.';
$phpMussel['lang']['state_default_password'] = 'Avvertimento: Utilizzando la password predefinita!';
$phpMussel['lang']['state_logged_in'] = 'Connesso.';
$phpMussel['lang']['state_logs_access_only'] = 'Accesso solo per i log';
$phpMussel['lang']['state_maintenance_mode'] = 'Attenzione: La modalità di manutenzione è abilitata!';
$phpMussel['lang']['state_password_not_valid'] = 'Avvertimento: Questo account non utilizzando una password valida!';
$phpMussel['lang']['state_quarantine'] = 'Ci sono %s file attualmente in quarantena.';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Non nascondere l\'aggiornato';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Nascondere l\'aggiornato';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Non nascondere il inutilizzato';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Nascondere il inutilizzato';
$phpMussel['lang']['tip_accounts'] = 'Salve, {username}.<br />La pagina di conti permette di controllare chi può accedere il front-end di phpMussel.';
$phpMussel['lang']['tip_config'] = 'Salve, {username}.<br />La pagina di configurazione permette di modificare la configurazione per phpMussel dal front-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel è offerto gratuitamente, ma se si vuole donare al progetto, è possibile farlo facendo clic sul pulsante donare.';
$phpMussel['lang']['tip_file_manager'] = 'Salve, {username}.<br />Il file manager consente di eliminare, modificare, caricare e scaricare file. Usare con cautela (si potrebbe rompere l\'installazione di questo).';
$phpMussel['lang']['tip_home'] = 'Salve, {username}.<br />Questa è la pagina principale per il front-end di phpMussel. Selezionare un collegamento dal menu di navigazione a sinistra per continuare.';
$phpMussel['lang']['tip_login'] = 'Nome utente predefinito: <span class="txtRd">admin</span> – Password predefinita: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Salve, {username}.<br />Selezionare un file di log dall\'elenco sottostante per visualizzare il contenuto di tale file di log.';
$phpMussel['lang']['tip_quarantine'] = 'Salve, {username}.<br />Questa pagina elenca tutti i file attualmente in quarantena e facilita la gestione di tali file.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Nota: La quarantena è attualmente disattivata, ma può essere attivata tramite la pagina di configurazione.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Vedere la <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.it.md#SECTION7">documentazione</a> per informazioni sulle varie direttive di configurazione ed i loro scopi.';
$phpMussel['lang']['tip_statistics'] = 'Salve, {username}.<br />Questa pagina mostra alcune statistiche di utilizzo relative all\'installazione di phpMussel.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Nota: Il monitoraggio delle statistiche è attualmente disattivato, ma può essere attivato tramite la pagina di configurazione.';
$phpMussel['lang']['tip_updates'] = 'Salve, {username}.<br />La pagina degli aggiornamenti permette di installare, disinstallare e aggiornare i vari componenti di phpMussel (il pacchetto di base, le firme, plugins, file per L10N, ecc).';
$phpMussel['lang']['tip_upload_test'] = 'Salve, {username}.<br />La pagina di carica testare contiene un modulo per i caricamenti file standard, che permette di verificare se un file viene normalmente essere bloccata da phpMussel quando si cerca di caricarlo.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Utenti';
$phpMussel['lang']['title_config'] = 'phpMussel – Configurazione';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – File Manager';
$phpMussel['lang']['title_home'] = 'phpMussel – Pagina Principale';
$phpMussel['lang']['title_login'] = 'phpMussel – Accedi';
$phpMussel['lang']['title_logs'] = 'phpMussel – File di Log';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Quarantena';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistiche';
$phpMussel['lang']['title_updates'] = 'phpMussel – Aggiornamenti';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Carica Testare';
$phpMussel['lang']['warning'] = 'Avvertimenti:';
$phpMussel['lang']['warning_php_1'] = 'La vostra versione di PHP non è più supportata attivamente! Si consiglia di aggiornarlo!';
$phpMussel['lang']['warning_php_2'] = 'La vostra versione PHP è severamente vulnerabile! Si consiglia fortemente di aggiornarlo!';
$phpMussel['lang']['warning_signatures_1'] = 'Non ci sono file di firme attivi!';

$phpMussel['lang']['info_some_useful_links'] = 'Alcuni link utili:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">Problemi di phpMussel @ GitHub</a> – Pagina dei problemi per phpMussel (supporto, assistenza, ecc).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Forum di discussione per phpMussel (supporto, assistenza, ecc).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Una scarica specchio alternativa per phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Una collezione di semplici strumenti per i webmaster per sicurezza del sito Web.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – Pagina principale di ClamAV (ClamAV® è un motore antivirus open source per rilevamenti di trojan, virus, malware e altre minacce dannose).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Società di sicurezza informatica che offre firme supplementari per ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Database di phishing utilizzato dallo scanner URL di phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – Risorse di apprendimento e discussione per PHP.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – Risorse di apprendimento e discussione per PHP.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal è un servizio gratuito per l\'analisi dei file e URL sospetti.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis è un servizio gratuito per l\'analisi del malware fornito da <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Specialisti del malware di computer.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Forum di discussione utili concentrati su di malware.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Mappe di Vulnerabilità</a> – Elenca le versioni sicure e non sicure di varie pacchetti (PHP, HHVM, ecc).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Mappe di Compatibilità</a> – Elenca le informazioni sulla compatibilità per vari pacchetti (CIDRAM, phpMussel, ecc).</li>
        </ul>';
