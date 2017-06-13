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
 * This file: Turkish language data (last modified: 2017.06.12).
 * (NOT COMPLETE)
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Bu komutu anlamıyorum, üzgünüm.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Tarama işlemini tamamlama başarısız';
$phpMussel['lang']['cli_is_not_a'] = ' bir dosya veya dizin değil.';
$phpMussel['lang']['cli_ln2'] = " Thank you for using phpMussel, a PHP script designed to detect trojans,\n viruses, malware and other threats within files uploaded to your system\n wherever the script is hooked, based on the signatures of ClamAV and others.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Currently running phpMussel in CLI mode (command line interface).\n\n To scan a file or directory, type 'scan', followed by the name of the file or\n directory that you want phpMussel to scan and press Enter; Type 'c' and press\n Enter for a list of CLI mode commands; Type 'q' and press Enter to quit:";
$phpMussel['lang']['cli_pe1'] = 'Not a valid PE file!';
$phpMussel['lang']['cli_pe2'] = 'PE Bölümleri:';
$phpMussel['lang']['cli_signature_placeholder'] = 'IMZA-ADINIZ';
$phpMussel['lang']['cli_working'] = 'Devam etmekte';
$phpMussel['lang']['corrupted'] = 'Detected corrupted PE';
$phpMussel['lang']['denied'] = 'Yükleme Reddedildi!';
$phpMussel['lang']['denied_reason'] = 'Your upload was blocked for the reasons listed below:';
$phpMussel['lang']['detected'] = 'Detected {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Detected control characters';
$phpMussel['lang']['encrypted_archive'] = 'Detected encrypted archive; Encrypted archives not permitted';
$phpMussel['lang']['failed_to_access'] = 'Failed to access ';
$phpMussel['lang']['file'] = 'File';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Filesize limit exceeded';
$phpMussel['lang']['filetype_blacklisted'] = 'Filetype blacklisted';
$phpMussel['lang']['finished'] = 'Finished';
$phpMussel['lang']['generated_by'] = 'Üreten';
$phpMussel['lang']['greylist_cleared'] = ' Greylist cleared.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist not updated.';
$phpMussel['lang']['greylist_updated'] = ' Greylist updated.';
$phpMussel['lang']['image'] = 'Image';
$phpMussel['lang']['instance_already_active'] = 'Instance already active! Please double-check your hooks.';
$phpMussel['lang']['invalid_file'] = 'Invalid file';
$phpMussel['lang']['invalid_url'] = 'Invalid URL!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Uploading files other than images isn\'t permitted';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Plugins directory doesn\'t exist!';
$phpMussel['lang']['quarantined_as'] = "Quarantined as \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursion depth limit exceeded';
$phpMussel['lang']['required_variables_not_defined'] = 'Required variables aren\'t defined: Can\'t continue.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'Potentially harmful URL detected';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API request error';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API authorisation error';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API service unavailable';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Unknown API error';
$phpMussel['lang']['scan_aborted'] = 'Scanning aborted!';
$phpMussel['lang']['scan_chameleon'] = '{x} chameleon attack detected';
$phpMussel['lang']['scan_checking'] = 'Checking';
$phpMussel['lang']['scan_checking_contents'] = 'Success! Proceeding to check contents.';
$phpMussel['lang']['scan_command_injection'] = 'Command injection attempt detected';
$phpMussel['lang']['scan_complete'] = 'Complete';
$phpMussel['lang']['scan_extensions_missing'] = 'Failed (missing required extensions)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Filename manipulation detected';
$phpMussel['lang']['scan_missing_filename'] = 'Missing filename';
$phpMussel['lang']['scan_not_archive'] = 'Failed (empty or not an archive)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Hiçbir sorun bulunamadı.';
$phpMussel['lang']['scan_reading'] = 'Reading';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Signature file corrupted';
$phpMussel['lang']['scan_signature_file_missing'] = 'Signature file missing';
$phpMussel['lang']['scan_tampering'] = 'Detected potentially dangerous file tampering';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Unauthorised file upload manipulation detected';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Unauthorised file upload manipulation or misconfiguration detected! ';
$phpMussel['lang']['started'] = 'Started';
$phpMussel['lang']['too_many_urls'] = 'Too many URLs';
$phpMussel['lang']['upload_error_1'] = 'Filesize exceeds the upload_max_filesize directive. ';
$phpMussel['lang']['upload_error_2'] = 'Filesize exceeds form-specified filesize limit. ';
$phpMussel['lang']['upload_error_34'] = 'Yükleme hatası! Lütfen yardım için hostmaster ile iletişime geçin! ';
$phpMussel['lang']['upload_error_6'] = 'Yükleme dizini eksik! Lütfen yardım için hostmaster ile iletişime geçin! ';
$phpMussel['lang']['upload_error_7'] = 'Disk yazma hatası! Lütfen yardım için hostmaster ile iletişime geçin! ';
$phpMussel['lang']['upload_error_8'] = 'PHP yanlış yapılandırması tespit edildi! Lütfen yardım için hostmaster ile iletişime geçin! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Yükleme sınırı aşıldı';
$phpMussel['lang']['wrong_password'] = 'Yanlış şifre; Eylem reddedildi.';
$phpMussel['lang']['x_does_not_exist'] = 'varolmayan';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - CLI\'den çıkın.
 - Takma adları: quit, exit.
 md5_file
 - Dosyalardan MD5 imzaları oluştur [Sözdizimi: md5_file dosya-adı].
 - Takma ad: m.
 sha1_file
 - Dosyalardan SHA1 imzaları oluştur [Sözdizimi: sha1_file dosya-adı].
 md5
 - Dizeden MD5 imzası üret [Sözdizimi: md5 dizgesi].
 sha1
 - Dizeden SHA1 imzası üret [Sözdizimi: sha1 dizgesi].
 hex_encode
 - İkili dizgeyi onaltılık olarak dönüştür [Sözdizimi: hex_encode dizgesi].
 - Takma ad: x.
 hex_decode
 - Onaltılıyı ikili dizeye olarak dönüştür [Sözdizimi: hex_decode dizgesi].
 base64_encode
 - İkili'e base64 hale dönüştür [Sözdizimi: base64_encode dizgesi].
 - Takma ad: b.
 base64_decode
 - Base64'ü ikili hale dönüştür [Sözdizimi: base64_decode dizgesi].
 scan
 - Dosya veya dizini tara [Sözdizimi: scan dosya-adı].
 - Takma ad: s.
 c
 - Bu komut listesini yazdırın.
";
