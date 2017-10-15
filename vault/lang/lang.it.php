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
 * This file: Italian language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Non capisco quel comando, mi dispiace.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Completamento del processo di controllo fallito';
$phpMussel['lang']['cli_is_not_a'] = ' non è né un file né una cartella.';
$phpMussel['lang']['cli_ln2'] = " Grazie per aver scelto phpMussel, un programma in PHP progettato per rilevare\n trojan, virus, malware ed altre minacce nei file caricati sul tuo sistama\n dovunque il programma stesso è collegato, basato sulle firme di ClamAV\n ed altri.\n\n PHPMUSSEL COPYRIGHT 2013 e oltre GNU/GPL V.2 Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Attualmente in esecuzione in modalità CLI (interfaccia a riga di comando).\n\n Per controllare un file o una cartella digita 'scan' seguito dal nome del\n file o della cartella e premi Invio; digita 'c' e premi Invio per l'elenco\n dei comandi in modalità CLI; digita 'q' e premi Invio per uscire.";
$phpMussel['lang']['cli_pe1'] = 'Non è un PE file valida!';
$phpMussel['lang']['cli_pe2'] = 'PE Sezioni:';
$phpMussel['lang']['cli_signature_placeholder'] = 'NOME-DELLA-FIRMA';
$phpMussel['lang']['cli_working'] = 'In corso';
$phpMussel['lang']['corrupted'] = 'Rilevato PE corrotto';
$phpMussel['lang']['data_not_available'] = 'Dati non disponibili.';
$phpMussel['lang']['denied'] = 'Caricamento Negato!';
$phpMussel['lang']['denied_reason'] = 'Il tentativo di caricamento è stato bloccato per i motivi elencati di seguito:';
$phpMussel['lang']['detected'] = 'Rilevato {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Rilevati caratteri di controllo';
$phpMussel['lang']['encrypted_archive'] = 'Rilevato archivio criptato; Archivi criptati non ammessi';
$phpMussel['lang']['failed_to_access'] = 'Fallito l\'accesso a ';
$phpMussel['lang']['file'] = 'File';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Dimensione massima del file superata';
$phpMussel['lang']['filetype_blacklisted'] = 'Tipo di file nella lista nera';
$phpMussel['lang']['finished'] = 'Finito';
$phpMussel['lang']['generated_by'] = 'Generato da';
$phpMussel['lang']['greylist_cleared'] = ' Lista grigia svuotata.';
$phpMussel['lang']['greylist_not_updated'] = ' Lista grigia non aggiornata.';
$phpMussel['lang']['greylist_updated'] = ' Lista grigia aggiornata.';
$phpMussel['lang']['image'] = 'Immagine';
$phpMussel['lang']['instance_already_active'] = 'Istanza già attivo! Si prega di ricontrolla i vostri ganci.';
$phpMussel['lang']['invalid_data'] = 'Dati non validi!';
$phpMussel['lang']['invalid_file'] = 'File non valido';
$phpMussel['lang']['invalid_url'] = 'URL non valido!';
$phpMussel['lang']['ok'] = 'Fatto';
$phpMussel['lang']['only_allow_images'] = 'Il caricamento di file che non sono immagini non è consentito';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Direttorio dei plugin non esiste!';
$phpMussel['lang']['quarantined_as'] = "In quarantena come \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Limite di profondità di controllo superato';
$phpMussel['lang']['required_variables_not_defined'] = 'Variabili obbligatori non sono definite: Impossibile di continuare.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL potenzialmente dannosi rilevati';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Errore di richiesta delle API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Errore di autorizzazione delle API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Servizio delle API è non disponibile';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Errore di API è sconosciuto';
$phpMussel['lang']['scan_aborted'] = 'Controllo interrotto!';
$phpMussel['lang']['scan_chameleon'] = 'Rilevato attacco camaleonte {x}';
$phpMussel['lang']['scan_checking'] = 'Verifica';
$phpMussel['lang']['scan_checking_contents'] = 'Successo! Procedo a verificare i contenuti.';
$phpMussel['lang']['scan_command_injection'] = 'Rilevato tentativo di iniezione dei comandi';
$phpMussel['lang']['scan_complete'] = 'Completato';
$phpMussel['lang']['scan_extensions_missing'] = 'Fallito (mancano le estensioni richieste)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Rilevata la manipolazione del nome di un file';
$phpMussel['lang']['scan_missing_filename'] = 'Nome del file mancante';
$phpMussel['lang']['scan_not_archive'] = 'Fallito (vuoto o non è un archivio)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Nessun problema rilevato.';
$phpMussel['lang']['scan_reading'] = 'Lettura in corso';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'File delle firme corrotto';
$phpMussel['lang']['scan_signature_file_missing'] = 'File delle firme mancante';
$phpMussel['lang']['scan_tampering'] = 'Rilevato potenzialmente pericolosi alterazione del file';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Rilevata manipolazione non autorizzata del caricamento del file';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Rilevata manipolazione non autorizzata del caricamento del file o malconfigurazione! ';
$phpMussel['lang']['started'] = 'Iniziato';
$phpMussel['lang']['too_many_urls'] = 'Troppi URL';
$phpMussel['lang']['upload_error_1'] = 'La dimensione del file supera la direttiva upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'La dimensione del file supera la dimensione limite specificata dal modulo. ';
$phpMussel['lang']['upload_error_34'] = 'Caricamento fallito! Contatta l\'hostmaster per assistenza! ';
$phpMussel['lang']['upload_error_6'] = 'Cartella per il caricamento mancante! Contatta l\'hostmaster per assistenza! ';
$phpMussel['lang']['upload_error_7'] = 'Errore nella scrittura del disco! Contatta l\'hostmaster per assistenza! ';
$phpMussel['lang']['upload_error_8'] = 'Rilevata una malconfigurazione di PHP! Contatta l\'hostmaster per assistenza! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Limite di caricamento superato';
$phpMussel['lang']['wrong_password'] = 'Password sbagliata; azione negata.';
$phpMussel['lang']['x_does_not_exist'] = 'non esiste';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Esci dall'interfaccia a riga di comando.
 - Alias: quit, exit.
 md5_file
 - Genera le firme MD5 da file [Sintassi: md5_file nomefile].
 - Alias: m.
 sha1_file
 - Genera le firme SHA1 da file [Sintassi: sha1_file nomefile].
 md5
 - Genera le firme md5 da stringa [Sintassi: md5 stringa].
 sha1
 - Genera le firme SHA1 da stringa [Sintassi: sha1 stringa].
 hex_encode
 - Converti la stringa binaria in esadecimale [Sintassi: hex_encode stringa].
 - Alias: x.
 hex_decode
 - Converti la stringa esadecimale in binaria [Sintassi: hex_decode stringa].
 base64_encode
 - Converti la stringa binaria in base64 [Sintassi: base64_encode stringa].
 - Alias: b.
 base64_decode
 - Converti la stringa da base64 a binaria [Sintassi: base64_decode stringa].
 pe_meta
 - Estrarre i metadati da un file PE [Sintassi: pe_meta nomefile].
 url_sig
 - Genera firme di scanner URL [Sintassi: url_sig string].
 scan
 - Controlla un file o una cartella [Sintassi: scan nomefile].
 - Alias: s.
 c
 - Mostra questa lista di comandi.
";
