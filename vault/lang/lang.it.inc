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
 This File: phpMussel Italian/Italiano Language Data (4th June 2015).
 <%phpMussel%/vault/lang/lang.it.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['cli_commands']=" q\n - Smettere CLI.\n - Alias: quit, exit.\n md5_file\n - Genera MD5 firme da file [Sintassi: md5_file filename].\n - Alias: m.\n md5\n - Genera MD5 firma da string [Sintassi: md5 string].\n hex_encode\n - Convertire binaria string a esadecimale [Sintassi: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertire esadecimale a binaria string [Sintassi: hex_decode string].\n base64_encode\n - Convertire binaria string a base64 string [Sintassi: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertire base64 string a binaria string [Sintassi: base64_decode string].\n scan\n - Scansionare file o una cartella [Sintassi: scan filename].\n - Alias: s.\n update\n - Aggiornare phpMussel.\n - Alias: u.\n c\n - Stampare questo lista dei comandi.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Fallimento a completa processo di scansione';
$MusselConfig['lang']['cli_is_not_a']=' non è un file o una directory.';
$MusselConfig['lang']['cli_ln2']=" Grazie per aver scelto phpMussel, uno PHP script progettato per la rilevazione\n di trojan, virus, malware e altre minacce all'interno di file caricati nel\n sistema ovunque lo script è collegato, basato su firme di ClamAV e altri.\n\n PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPL V.2 da Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Attualmente in esecuzione di phpMussel in CLI modalità (Comando riga\n\n interfaccia). Per scansione di un file o cartella, digitare 'scan', seguito dal nome del\n file o cartella che si desidera phpMussel per scansione e premere Enter;\n Digitare 'c' e premere Enter per un elenco dei CLI modalità comandi; Digitare\n 'q' e premere Enter per chiudere:";
$MusselConfig['lang']['cli_update_restart']=" Riavvio di phpMussel può essere richiesto prima che gli aggiornamenti\n diventano evidenti.";
$MusselConfig['lang']['cli_working']='In corso';
$MusselConfig['lang']['corrupted']='Rilevato corrotto PE';
$MusselConfig['lang']['denied']='Carica Negato!';
$MusselConfig['lang']['denied_other']='Upload Denied! Télécharger Refusé! Carga Negado! Upload verweigert! アップロード拒否されました! 上载是否认! 上載是否認! Uppladda Nekas! Загрузить Отказано! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Il tentativo di caricamento è stato bloccato per i motivi elencati di seguito / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Rilevato {vn}';
$MusselConfig['lang']['detected_control_characters']='Controllo Caratteri Rilevati';
$MusselConfig['lang']['failed_to_access']='Fallimento all\'accesso ';
$MusselConfig['lang']['file']='File';
$MusselConfig['lang']['filesize_limit_exceeded']='File dimensione limite superato';
$MusselConfig['lang']['filetype_blacklisted']='Tipo di file sulla nera lista';
$MusselConfig['lang']['finished']='Finito';
$MusselConfig['lang']['generated_by']='Generato da';
$MusselConfig['lang']['greylist_cleared']=' Greylist svuotato.';
$MusselConfig['lang']['greylist_updated']=' Greylist aggiornato.';
$MusselConfig['lang']['image']='Immagine';
$MusselConfig['lang']['invalid_file']='File non valido';
$MusselConfig['lang']['ok']='Bene';
$MusselConfig['lang']['only_allow_images']='Upload di file che non sono immagini non è consentito';
$MusselConfig['lang']['recursive']='Ricorsione profondità limite superato';
$MusselConfig['lang']['refer_to_scan_kills']=' (riferimento alla '.$MusselConfig['general']['scan_kills'].' per i dettagli)';
$MusselConfig['lang']['scan_aborted']='Scansione interrotta';
$MusselConfig['lang']['scan_chameleon']='{x} camaleonte attacco rilevato';
$MusselConfig['lang']['scan_checking']='Verificare';
$MusselConfig['lang']['scan_checking_contents']='Successo! Procedendo per verificare i contenuti.';
$MusselConfig['lang']['scan_command_injection']='Comando iniezione tentativo rilevato';
$MusselConfig['lang']['scan_complete']='Completo';
$MusselConfig['lang']['scan_extensions_missing']='Mancato (Manca richieste estensioni)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='File nome manipolazione rilevato';
$MusselConfig['lang']['scan_map_corrupted']='Firma mappa corrotto';
$MusselConfig['lang']['scan_map_missing']='Firma mappa manca';
$MusselConfig['lang']['scan_missing_filename']='Nome del file mancante';
$MusselConfig['lang']['scan_not_archive']='Mancato (vuoto o non è un archivio)!';
$MusselConfig['lang']['scan_no_problems_found']='Nessun problema trovato.';
$MusselConfig['lang']['scan_reading']='Leggendo';
$MusselConfig['lang']['scan_signature_file_corrupted']='Firma file corrotto';
$MusselConfig['lang']['scan_signature_file_missing']='Firma file manca';
$MusselConfig['lang']['scan_unauthorised_upload']='Non autorizzato file nome manipolazione rilevato';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Non autorizzato file nome manipolazione o male configurazione rilevato! ';
$MusselConfig['lang']['started']='Iniziato';
$MusselConfig['lang']['update_']='phpMussel ora tenterà di aggiornarsi.';
$MusselConfig['lang']['update_available']='Un script aggiornamento è disponibile.';
$MusselConfig['lang']['update_complete']='Aggiornamento verifica completato con successo.';
$MusselConfig['lang']['update_created']='creato';
$MusselConfig['lang']['update_deleted']='cancellato';
$MusselConfig['lang']['update_err1']='Aggiornamento non riuscito: \'update.dat\' mancante. Reinstallare o aggiornare manualmente.';
$MusselConfig['lang']['update_err2']='Aggiornamento non riuscito: \'update.dat\' non contiene qualsiasi valido fonti di aggiornamento. Si prega di aggiornare manualmente.';
$MusselConfig['lang']['update_err3']='Possibile hack o falsificazioni rilevato nelle aggiornamento istruzioni forniti dalla aggiornamento sorgente; Fonte è forse compromessa. Si prega di avvisare l\'autore di script. Aggiornamento manuale è consigliata.';
$MusselConfig['lang']['update_err4']='Checksum mancanti!';
$MusselConfig['lang']['update_err5']='Dati mancanti!';
$MusselConfig['lang']['update_err6']='Dati errati!';
$MusselConfig['lang']['update_err7']='Checksum errati!';
$MusselConfig['lang']['update_failed']='Mancato.';
$MusselConfig['lang']['update_fetch']='Il tentativo di ottenere i dati della versione da';
$MusselConfig['lang']['update_not']='NON {x}';
$MusselConfig['lang']['update_not_available']='Nessun script aggiornamento è disponibile in questo momento.';
$MusselConfig['lang']['update_not_possible']='Un script aggiornamento è disponibile, ma non può essere completamente aggiornato con questa versione dello aggiornamento script. Si prega aggiornare manualmente.';
$MusselConfig['lang']['update_no_source']='phpMussel non è riuscito ad aggiornare perché non poteva connettersi a un valido aggiornamento origine. Aggiornamento manuale è consigliato.';
$MusselConfig['lang']['update_patched']='patchato';
$MusselConfig['lang']['update_scriptfile_missing']=' Aggiornare script file è manca! Prego, reinstallare phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' secondi trascorsi';
$MusselConfig['lang']['update_signatures_available']='Un aggiornamento delle firme è disponibile.';
$MusselConfig['lang']['update_signatures_latest']='ULTIME FIRME';
$MusselConfig['lang']['update_signatures_not_available']='Nessun aggiornamento delle firme è disponibile in questo momento.';
$MusselConfig['lang']['update_signatures_yours']='VOSTRE FIRME';
$MusselConfig['lang']['update_success']='Successo.';
$MusselConfig['lang']['update_successfully']=' con successo';
$MusselConfig['lang']['update_version_latest']='ULTIMA SCRIPT VERSIONE';
$MusselConfig['lang']['update_version_yours']='VOSTRE SCRIPT VERSIONE';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='firme';
$MusselConfig['lang']['upload_error_1']='File dimensione supera MAX_FILE_SIZE direttiva. ';
$MusselConfig['lang']['upload_error_2']='File dimensione supera modulo specificato file dimensione limite. ';
$MusselConfig['lang']['upload_error_34']='Carica fallimento! Si prega contattare il hostmaster per l\'assistenza! ';
$MusselConfig['lang']['upload_error_6']='Carica direttorio manca! Si prega contattare il hostmaster per l\'assistenza! ';
$MusselConfig['lang']['upload_error_7']='Errore del disco-scrittura! Si prega contattare il hostmaster per l\'assistenza! ';
$MusselConfig['lang']['upload_error_8']='PHP male configurazione rilevato! Si prega contattare il hostmaster per l\'assistenza! ';
$MusselConfig['lang']['upload_limit_exceeded']='Upload limita supera';
$MusselConfig['lang']['wrong_password']='Password errata; Azione negato.';
$MusselConfig['lang']['x_does_not_exist']='non esiste';

?>