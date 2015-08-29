<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

 Thank you for using phpMussel, a PHP script designed to detect trojans,
 viruses, malware and other threats within files uploaded to your system
 wherever the script is hooked, based on the signatures of ClamAV and others.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).

 This document and its associated package can be downloaded for free from:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~
 Questo file è la traduzione Italiana di phpMussel (30th August 2015).
 <%phpMussel%/vault/lang/lang.it.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] Non puoi accedervi direttamente.');

$MusselConfig['lang']['bad_command']='Non capisco quel comando, mi dispiace.';
$MusselConfig['lang']['cli_commands']=" q\n - Esci dall'interfaccia a riga di comando.\n - Alias: quit, exit.\n md5_file\n - Genera le firme MD5 da file [Sintassi: md5_file nomefile].\n - Alias: m.\n md5\n - Genera le firme md5 da stringa [Sintassi: md5 stringa].\n hex_encode\n - Converti la stringa binaria in esadecimale [Sintassi: hex_encode stringa].\n - Alias: x.\n hex_decode\n - Converti la stringa esadecimale in binaria [Sintassi: hex_decode stringa].\n base64_encode\n - Converti la stringa binaria in base64 [Sintassi: base64_encode stringa].\n - Alias: b.\n base64_decode\n - Converti la stringa da base64 a binaria [Sintassi: base64_decode stringa].\n scan\n - Controlla un file o una cartella [Sintassi: scan nomefile].\n - Alias: s.\n update\n - Aggiorna phpMussel.\n - Alias: u.\n c\n - Mostra questa lista di comandi.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Completamento del processo di controllo fallito';
$MusselConfig['lang']['cli_is_not_a']=' non è né un file né una cartella.';
$MusselConfig['lang']['cli_ln2']=" Grazie per aver scelto phpMussel, un programma in PHP progettato per rilevare\n trojan, virus, malware ed altre minacce nei file caricati sul tuo sistama\n dovunque il programma stesso è collegato, basato sulle firme di ClamAV\n ed altri.\n\n PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPL V.2 Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Attualmente in esecuzione in modalità CLI (interfaccia a riga di comando).\n\n Per controllare un file o una cartella digita 'scan' seguito dal nome del\n file o della cartella e premi Invio; digita 'c' e premi Invio per l\'elenco\n dei comandi in modalità CLI; digita 'q' e premi Invio per uscire.";
$MusselConfig['lang']['cli_pe1']='Non è un PE file valida!';
$MusselConfig['lang']['cli_pe2']='PE Sezioni:';
$MusselConfig['lang']['cli_update_restart']=" Può essere necessario riavviare phpMussel prima che gli aggiornamenti\n diventino effettivi.";
$MusselConfig['lang']['cli_working']='In corso';
$MusselConfig['lang']['controls_lockout']='phpMussel blocco di controlli attivato.';
$MusselConfig['lang']['core_scriptfile_missing']='Nucleo script file mancante! Reinstalla phpMussel.';
$MusselConfig['lang']['corrupted']='Rilevato PE corrotto';
$MusselConfig['lang']['denied']='Caricamento Negato!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Il tentativo di caricamento è stato bloccato per i motivi elencati di seguito / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Rilevato {vn}';
$MusselConfig['lang']['detected_control_characters']='Rilevati caratteri di controllo';
$MusselConfig['lang']['encrypted_archive']='Rilevato archivio criptato; Archivi criptati non ammessi';
$MusselConfig['lang']['failed_to_access']='Fallito l\'accesso a ';
$MusselConfig['lang']['file']='File';
$MusselConfig['lang']['filesize_limit_exceeded']='Dimensione massima del file superata';
$MusselConfig['lang']['filetype_blacklisted']='Tipo di file nella lista nera';
$MusselConfig['lang']['finished']='Finito';
$MusselConfig['lang']['generated_by']='Generato da';
$MusselConfig['lang']['greylist_cleared']=' Lista grigia svuotata.';
$MusselConfig['lang']['greylist_not_updated']=' Lista grigia non aggiornata.';
$MusselConfig['lang']['greylist_updated']=' Lista grigia aggiornata.';
$MusselConfig['lang']['image']='Immagine';
$MusselConfig['lang']['instance_already_active']='Istanza già attivo! Si prega di ricontrolla i vostri ganci.';
$MusselConfig['lang']['invalid_file']='File non valido';
$MusselConfig['lang']['ok']='Fatto';
$MusselConfig['lang']['only_allow_images']='Il caricamento di file che non sono immagini non è consentito';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel disattivato.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel già disattivato.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel attivato.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel già attivato.';
$MusselConfig['lang']['recursive']='Limite di profondità di controllo superato';
$MusselConfig['lang']['refer_to_scan_kills']=' (vedi '.$MusselConfig['general']['scan_kills'].' per i dettagli)';
$MusselConfig['lang']['required_variables_not_defined']='Variabili obbligatori non sono definite: Impossibile di continuare.';
$MusselConfig['lang']['scan_aborted']='Controllo interrotto';
$MusselConfig['lang']['scan_chameleon']='Rilevato attacco camaleonte {x}';
$MusselConfig['lang']['scan_checking']='Verifica';
$MusselConfig['lang']['scan_checking_contents']='Successo! Procedo a verificare i contenuti.';
$MusselConfig['lang']['scan_command_injection']='Rilevato tentativo di iniezione dei comandi';
$MusselConfig['lang']['scan_complete']='Completato';
$MusselConfig['lang']['scan_extensions_missing']='Fallito (mancano le estensioni richieste)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Rilevata la manipolazione del nome di un file';
$MusselConfig['lang']['scan_map_corrupted']='Mappa delle firme corrotta';
$MusselConfig['lang']['scan_map_missing']='Mappa delle firme mancante';
$MusselConfig['lang']['scan_missing_filename']='Nome del file mancante';
$MusselConfig['lang']['scan_not_archive']='Fallito (vuoto o non è un archivio)!';
$MusselConfig['lang']['scan_no_problems_found']='Nessun problema rilevato.';
$MusselConfig['lang']['scan_reading']='Lettura in corso';
$MusselConfig['lang']['scan_signature_file_corrupted']='File delle firme corrotto';
$MusselConfig['lang']['scan_signature_file_missing']='File delle firme mancante';
$MusselConfig['lang']['scan_tampering']='Rilevato potenzialmente pericolosi alterazione del file';
$MusselConfig['lang']['scan_unauthorised_upload']='Rilevata manipolazione non autorizzata del caricamento del file';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Rilevata manipolazione non autorizzata del caricamento del file o malconfigurazione! ';
$MusselConfig['lang']['started']='Iniziato';
$MusselConfig['lang']['update_']='phpMussel tenterà di aggiornarsi adesso.';
$MusselConfig['lang']['update_available']='Un aggiornamento del programma è disponibile.';
$MusselConfig['lang']['update_complete']='Verifica dell\'aggiornamento completata con successo.';
$MusselConfig['lang']['update_created']='creato';
$MusselConfig['lang']['update_deleted']='cancellato';
$MusselConfig['lang']['update_err1']='Aggiornamento non riuscito: \'update.dat\' mancante. Reinstallare o aggiornare manualmente.';
$MusselConfig['lang']['update_err2']='Aggiornamento non riuscito: \'update.dat\' non contiene nessuna valida sorgente per l\'aggiornamento. Si prega di aggiornare manualmente.';
$MusselConfig['lang']['update_err3']='Rilevata una possibile manipolazione malevola delle istruzioni di aggiornamento fornite dalla sorgente di aggiornamento; la sorgente è probabilmente compromessa. Si prega di avvisare l\'autore del programma. È consigliato aggiornare manualmente.';
$MusselConfig['lang']['update_err4']='Checksum mancanti!';
$MusselConfig['lang']['update_err5']='Dati mancanti!';
$MusselConfig['lang']['update_err6']='Dati errati!';
$MusselConfig['lang']['update_err7']='Checksum errati!';
$MusselConfig['lang']['update_failed']='Fallito.';
$MusselConfig['lang']['update_fetch']='Tentativo di ottenere i dati della versione da';
$MusselConfig['lang']['update_lock_detected']='Blocco di aggiornamento rilevato: Impossibile di continuare. Controlla per aggiornamenti corrotti o riprova più tardi.';
$MusselConfig['lang']['update_not']='NON {x}';
$MusselConfig['lang']['update_not_available']='Nessun aggiornamento del programma è disponibile in questo momento.';
$MusselConfig['lang']['update_not_possible']='Un aggiornamento del programma è disponibile, ma non è possibile l\'aggiornamento completo con questa versione del programma di aggornamento. Si prega di aggiornare manualmente.';
$MusselConfig['lang']['update_no_source']='phpMussel non è riuscito ad aggiornarsi perché non poteva connettersi ad una valida sorgente di aggiornamenti. È consigliato aggiornare manualmente.';
$MusselConfig['lang']['update_patched']='patchato';
$MusselConfig['lang']['update_scriptfile_missing']=' Il file dell\'aggiornamento del programma è mancante! Reinstalla phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' secondi trascorsi';
$MusselConfig['lang']['update_signatures_available']='Un aggiornamento delle firme è disponibile.';
$MusselConfig['lang']['update_signatures_latest']='ULTIME FIRME';
$MusselConfig['lang']['update_signatures_not_available']='Nessun aggiornamento delle firme è disponibile in questo momento.';
$MusselConfig['lang']['update_signatures_yours']='TUE FIRME';
$MusselConfig['lang']['update_success']='Successo.';
$MusselConfig['lang']['update_successfully']=' con successo';
$MusselConfig['lang']['update_version_latest']='ULTIMA VERSIONE DEL PROGRAMMA';
$MusselConfig['lang']['update_version_yours']='TUA VERSIONE DEL PROGRAMMA';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='firme';
$MusselConfig['lang']['upload_error_1']='La dimensione del file supera la direttiva MAX_FILE_SIZE. ';
$MusselConfig['lang']['upload_error_2']='La dimensione del file supera la dimensione limite specificata dal modulo. ';
$MusselConfig['lang']['upload_error_34']='Caricamento fallito! Contatta l\'hostmaster per assistenza! ';
$MusselConfig['lang']['upload_error_6']='Cartella per il caricamento mancante! Contatta l\'hostmaster per assistenza! ';
$MusselConfig['lang']['upload_error_7']='Errore nella scrittura del disco! Contatta l\'hostmaster per assistenza! ';
$MusselConfig['lang']['upload_error_8']='Rilevata una malconfigurazione di PHP! Contatta l\'hostmaster per assistenza! ';
$MusselConfig['lang']['upload_limit_exceeded']='Limite di caricamento superato';
$MusselConfig['lang']['wrong_password']='Password sbagliata; azione negata.';
$MusselConfig['lang']['x_does_not_exist']='non esiste';

?>