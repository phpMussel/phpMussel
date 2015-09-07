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
 This File: phpMussel Indonesian Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.id.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Saya tidak mengerti perintah itu, maaf.';
$MusselConfig['lang']['cli_commands']=" q\n - Berhenti CLI.\n - Alias: quit, exit.\n md5_file\n - Menghasilkan tanda tangan MD5 dari file [Sintaksis: md5_file nama_file].\n - Alias: m.\n md5\n - Menghasilkan tanda tangan MD5 dari string [Sintaksis: md5 string].\n hex_encode\n - Mengkonversi string biner ke heksadesimal [Sintaksis: hex_encode string].\n - Alias: x.\n hex_decode\n - Mengkonversi heksadesimal ke string biner [Sintaksis: hex_decode string].\n base64_encode\n - Mengkonversi string biner ke string base64 [Sintaksis: base64_encode string].\n - Alias: b.\n base64_decode\n - Mengkonversi string base64 ke string biner [Sintaksis: base64_decode string].\n scan\n - Pindai file atau direktori [Sintaksis: scan nama_file].\n - Alias: s.\n update\n - Memperbarui phpMussel.\n - Alias: u.\n c\n - Cetak ini daftar perintah.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Gagal untuk menyelesaikan memindai proses';
$MusselConfig['lang']['cli_is_not_a']=' bukan file atau direktori.';
$MusselConfig['lang']['cli_ln2']=" Terima kasih untuk menggunakan phpMussel, sebuah skrip php di-design untuk\n mendeteksi trojan-trojan, virus-virus dan serangan-serangan lainnya dalam\n file-file diupload ke system Anda dimana saja skrip di kaitkan, berdasarkan\n tanda tangan dari ClamAV dan lain-lain.\n\n PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPL V.2 oleh Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Sekarang phpMussel operasi di CLI mode (Command line interface).\n\n Untuk memindai file atau direktori, menulis 'scan', diikuti dengan nama file\n atau direktori yang ingin Anda phpMussel untuk memindai dan tekan Enter;\n Menulis 'c' dan tekan Enter untuk daftar CLI mode perintah; Menulis 'q' dan\n tekan Enter untuk keluar:";
$MusselConfig['lang']['cli_pe1']='Tidak valid file PE!';
$MusselConfig['lang']['cli_pe2']='Seksi PE:';
$MusselConfig['lang']['cli_update_restart']=' Restart phpMussel mungkin diperlukan sebelum perbarui menjadi jelas.';
$MusselConfig['lang']['cli_working']='Dalam proses';
$MusselConfig['lang']['controls_lockout']='phpMussel mengunci kontrol diaktifkan.';
$MusselConfig['lang']['core_scriptfile_missing']='File skrip inti hilang! Silakan instal ulang phpMussel.';
$MusselConfig['lang']['corrupted']='Terdeteksi rusak PE';
$MusselConfig['lang']['denied']='Upload Ditolak!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Upload diblokir karena alasan yang tercantum di bawah / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Terdeteksi {vn}';
$MusselConfig['lang']['detected_control_characters']='Terdeteksi Kontrol Karakter';
$MusselConfig['lang']['encrypted_archive']='Terdeteksi arsip dienkripsi; Arsip dienkripsi tidak diizinkan';
$MusselConfig['lang']['failed_to_access']='Gagal untuk akses ';
$MusselConfig['lang']['file']='File';
$MusselConfig['lang']['filesize_limit_exceeded']='File ukuran batas melebihi';
$MusselConfig['lang']['filetype_blacklisted']='File jenis pada hitam daftar';
$MusselConfig['lang']['finished']='Selesai';
$MusselConfig['lang']['generated_by']='Dihasilkan oleh';
$MusselConfig['lang']['greylist_cleared']=' Greylist dikosongkan.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist tidak diperbarui.';
$MusselConfig['lang']['greylist_updated']=' Greylist diperbarui.';
$MusselConfig['lang']['image']='gambar';
$MusselConfig['lang']['instance_already_active']='Kejadian sudah aktif! Silakan periksa kait Anda.';
$MusselConfig['lang']['invalid_file']='File tidak valid';
$MusselConfig['lang']['ok']='Oke';
$MusselConfig['lang']['only_allow_images']='Upload file selain gambar tidak diizinkan';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel dinonaktifkan.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel sudah dinonaktifkan.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel diaktifkan.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel sudah diaktifkan.';
$MusselConfig['lang']['recursive']='Batas kedalaman rekursi melebihi';
$MusselConfig['lang']['refer_to_scan_kills']=' (mengacu pada '.$MusselConfig['general']['scan_kills'].' untuk rincian)';
$MusselConfig['lang']['required_variables_not_defined']='Variabel diharuskan tidak didefinisikan: Tidak dapat dilanjutkan.';
$MusselConfig['lang']['scan_aborted']='Memindai dibatalkan';
$MusselConfig['lang']['scan_chameleon']='Bunglon {x} serangan terdeteksi';
$MusselConfig['lang']['scan_checking']='Memeriksa';
$MusselConfig['lang']['scan_checking_contents']='Sukses! Melanjutkan untuk memeriksa isi.';
$MusselConfig['lang']['scan_command_injection']='Perintah injeksi terdeteksi';
$MusselConfig['lang']['scan_complete']='Selesai';
$MusselConfig['lang']['scan_extensions_missing']='Gagal (hilang ekstensi yang dibutuhkan)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='File nama manipulasi terdeteksi';
$MusselConfig['lang']['scan_map_corrupted']='Tanda tangan peta rusak';
$MusselConfig['lang']['scan_map_missing']='Tanda tangan peta hilang';
$MusselConfig['lang']['scan_missing_filename']='Hilang nama file';
$MusselConfig['lang']['scan_not_archive']='Gagal (kosong atau tidak sebuah arsip)!';
$MusselConfig['lang']['scan_no_problems_found']='Tidak ada masalah yang diketahui.';
$MusselConfig['lang']['scan_reading']='Bacaan';
$MusselConfig['lang']['scan_signature_file_corrupted']='Tanda tangan file rusak';
$MusselConfig['lang']['scan_signature_file_missing']='Tanda tangan file hilang';
$MusselConfig['lang']['scan_tampering']='Terdeteksi perubahan berpotensi berbahaya dalam file';
$MusselConfig['lang']['scan_unauthorised_upload']='Tidak sah file nama manipulasi terdeteksi';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Tidak sah file nama manipulasi atau salah-konfigurasi terdeteksi! ';
$MusselConfig['lang']['started']='Dimulai';
$MusselConfig['lang']['update_']='phpMussel sekarang akan mencoba untuk sendiri update.';
$MusselConfig['lang']['update_available']='Update untuk skrip tersedia.';
$MusselConfig['lang']['update_complete']='Update cek selesai dengan sukses.';
$MusselConfig['lang']['update_created']='dibuat';
$MusselConfig['lang']['update_deleted']='dihapus';
$MusselConfig['lang']['update_err1']='Gagal memperbarui: \'update.dat\' yang hilang. Menginstal lagi atau memperbarui secara manual.';
$MusselConfig['lang']['update_err2']='Gagal memperbarui: \'update.dat\' tidak mengandung sumber pembaruan yang valid. Saya sarankan untuk memperbarui secara manual.';
$MusselConfig['lang']['update_err3']='Kemungkinan hack atau pemalsuan terdeteksi dalam petunjuk pembaruan yang diberikan oleh sumber pembaruan; Sumber mungkin dapat dikompromikan. Harap memberitahu penulis skrip. Saya sarankan untuk memperbarui secara manual.';
$MusselConfig['lang']['update_err4']='Checksum yang hilang!';
$MusselConfig['lang']['update_err5']='Data yang hilang!';
$MusselConfig['lang']['update_err6']='Data yang buruk!';
$MusselConfig['lang']['update_err7']='Checksum yang buruk!';
$MusselConfig['lang']['update_failed']='Gagal.';
$MusselConfig['lang']['update_fetch']='Mencoba untuk mengambil versi data dari';
$MusselConfig['lang']['update_lock_detected']='Mengunci memperbarui terdeteksi: Tidak dapat dilanjutkan. Memeriksa pembaruan korup atau coba lagi nanti.';
$MusselConfig['lang']['update_not']='TIDAK {x}';
$MusselConfig['lang']['update_not_available']='Skrip update yang tidak tersedia saat ini.';
$MusselConfig['lang']['update_not_possible']='Skrip update yang tersedia, tetapi tidak dapat sepenuhnya diupdate dengan ini update skrip versi. Silahkan update secara manual.';
$MusselConfig['lang']['update_no_source']='phpMussel gagal untuk sendiri update karena tidak bisa terhubung ke valid update sumber. Update secara manual dianjurkan.';
$MusselConfig['lang']['update_patched']='ditambal';
$MusselConfig['lang']['update_scriptfile_missing']=' Perbarui file script hilang! Silakan instal ulang phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' detik berlalu';
$MusselConfig['lang']['update_signatures_available']='Tanda tangan yang tersedia.';
$MusselConfig['lang']['update_signatures_latest']='TERAKHIR TANDA TANGAN';
$MusselConfig['lang']['update_signatures_not_available']='Tanda tangan update yang tidak tersedia saat ini.';
$MusselConfig['lang']['update_signatures_yours']='TANDA TANGAN ANDA';
$MusselConfig['lang']['update_success']='Sukses.';
$MusselConfig['lang']['update_successfully']=' yang sukses';
$MusselConfig['lang']['update_version_latest']='TERAKHIR SKRIPT VERSI';
$MusselConfig['lang']['update_version_yours']='SKRIPT VERSI ANDA';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='tanda tangan';
$MusselConfig['lang']['upload_error_1']='File ukuran melebihi MAX_FILE_SIZE direktif. ';
$MusselConfig['lang']['upload_error_2']='File ukuran melebihi formulir ditentukan file ukuran batas. ';
$MusselConfig['lang']['upload_error_34']='Upload gagal! Silahkan hubungi hostmaster untuk bantuan! ';
$MusselConfig['lang']['upload_error_6']='Upload direktori hilang! Silahkan hubungi hostmaster untuk bantuan! ';
$MusselConfig['lang']['upload_error_7']='Disk-menulis kesalahan! Silahkan hubungi hostmaster untuk bantuan! ';
$MusselConfig['lang']['upload_error_8']='PHP salah-konfigurasi terdeteksi! Silahkan hubungi hostmaster untuk bantuan! ';
$MusselConfig['lang']['upload_limit_exceeded']='Upload batas melebihi';
$MusselConfig['lang']['wrong_password']='Password yang salah; Aksi ditolak.';
$MusselConfig['lang']['x_does_not_exist']='tidak ada';

?>