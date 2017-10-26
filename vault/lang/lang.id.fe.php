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
 * This file: Indonesian language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Halaman Utama</a> | <a href="?phpmussel-page=logout">Keluar</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Keluar</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Ekstensi file terkompres yang dikenali (format nya CSV; seharusnya hanya menambah atau menghapus ketika masalah terjadi; Tidak cocok langsung menghapus karena dapat menyebabkan angka positif yang salah terjadi pada file terkompres, dimana juga menambahkan deteksi; memodifikasi dengan peringatan; Juga dicatat bahwa ini tidak memberi efek pada file terkompress apa yang dapat dan tidak dapat di analisa pada level isi). Daftar sebagaimana defaultnya, memberi daftar format-format yang digunakan yang paling umum melalui melalui mayoritas sistem dan CMS, tapi bermaksud tidak komprehensif.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Memblokade file apapun yang berisi karakter pengendali (lain dari baris baru)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Jika Anda hanya sedang mengupload file teks biasa, maka Anda dapat menghidupkan opsi ini untuk menyediakan perlindungan tambahan ke sistem Anda. Bagaimanapun jika Anda mengupload apapun lebih dari file teks biasa, menghidupkan opsi ini mungkin mengakibatkan angka positif salah. False = Jangan memblokade [Default]; True = Memblokade.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Cari header yang dapat dieksekusi di dalam file-file yang dapat dieksekusi atau file terkompress yang dikenali dan untuk file dapat dieksekusi yang headernya tidak benar. False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Cari header PHP tidak di dalam file-file PHP atau file terkompress. False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Cari file terkompress yang header nya tidak benar (Mendukung: BZ, GZ, RAR, ZIP, RAR, GZ). False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Cari dokumen office yang header nya tidak benar (Mendukung: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Cari gambar yang header nya tidak benar (Mendukung: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Cari file PDF yang headernya tidak benar. False = Dinonaktifkan; True = Diaktifkan.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'File korup dan diurai kesalahan. False = Mengabaikan; True = Memblokade [Default]. Mendeteksi dan memblokir berpotensi korup PE (Portable Executable) file? Sering (tapi tidak selalu), ketika aspek-aspek tertentu dari file PE yang korup atau tidak bisa diurai dengan benar, itu dapat menjadi indikasi dari infeksi virus. Proses yang digunakan oleh sebagian besar program anti-virus untuk mendeteksi virus dalam file PE memerlukan parsing file-file dengan cara tertentu, yang, jika programmer virus menyadari, secara khusus akan mencoba untuk mencegah, untuk memungkinkan virus mereka untuk tetap tidak terdeteksi.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Ambang batas dengan panjang file mentah yang dalam decode perintah harus terdeteksi (dalam kasus ada masalah kinerja sementara pemindaian). Default = 512KB. Nol atau nilai null menonaktifkan ambang batas (menghapus apapun batasan berdasarkan ukuran file).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Ambang batas dengan panjang file mentah yang phpMussel diperbolehkan untuk membaca dan memindai (dalam kasus ada masalah kinerja sementara pemindaian). Default = 32MB. Nol atau nilai null menonaktifkan ambang batas. Umumnya, nilai ini tidak seharusnya kurang dari ukuran file rata-rata upload file yang Anda inginkan dan Anda harapkan untuk menerima ke server atau website, tidak seharusnya lebih dari direktif filesize_limit, dan tidak seharusnya lebih dari sekitar seperlima dari total alokasi memori yang diijinkan ke PHP melalui file konfigurasi "php.ini". Direktif ini ada untuk mencegah phpMussel menggunakan terlalu banyak memori (yang bisa mencegah dari yang berhasil memindai file di atas tertentu ukuran file).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Direktif ini umumnya harus DINONAKTIFKAN kecuali diharuskan untuk fungsi yang benar dari phpMussel pada sistem tertentu. Biasanya, ketika DINONAKTIFKAN, ketika phpMussel mendeteksi adanya elemen dalam <code>$_FILES</code> array(), itu akan mencoba untuk memulai scan file yang mewakili elemen, dan, jika elemen yang kosong, phpMussel akan mengembalikan pesan kesalahan. Ini adalah perilaku yang tepat untuk phpMussel. Namun, untuk beberapa CMS, elemen kosong di <code>$_FILES</code> dapat terjadi sebagai akibat dari perilaku alami itu CMS, atau kesalahan dapat dilaporkan bila tidak ada, dalam kasus seperti itu, perilaku normal untuk phpMussel akan mengganggu untuk perilaku normal itu CMS. Jika situasi seperti itu terjadi untuk Anda, MENGAKTIFKAN direktif ini akan menginstruksikan phpMussel untuk tidak mencoba untuk memulai scan untuk elemen kosong, mengabaikan saat ditemui dan untuk tidak kembali terkait pesan kesalahan, sehingga memungkinkan kelanjutan dari halaman permintaan. False = DINONAKTIFKAN; True = DIAKTIFKAN.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Jika Anda hanya mengharapkan atau hanya berniat untuk memungkinkan mengupload gambar ke sistem atau CMS, dan jika Anda benar-benar tidak memerlukan mengupload file selain gambar ke sistem atau CMS, direktif ini harus DIAKTIFKAN, tapi sebaliknya harus DINONAKTIFKAN. Jika direktif ini DIAKTIFKAN, ini akan menginstruksikan phpMussel untuk memblokir tanpa pandang bulu setiap upload diidentifikasi sebagai file tidak gambar, tanpa pemindaian mereka. Ini mungkin mengurangi waktu memproses dan penggunaan memori untuk mencoba upload file tidak gambar. False = DINONAKTIFKAN; True = DIAKTIFKAN.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Mendeteksi dan memblokir dienkripsi arsip? Karena phpMussel tidak mampu memindai isi arsip dienkripsi, itu mungkin bahwa enkripsi arsip dapat digunakan oleh penyerang sebagai sarana mencoba untuk memotong phpMussel, anti-virus pemindai dan perlindungan mirip lainnya. Menginstruksikan phpMussel untuk memblokir setiap arsip dienkripsi ditemukan akan berpotensi membantu mengurangi risiko terkait dengan kemungkinan tersebut. False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_files_check_archives'] = 'Berusaha mencek isi file terkompress? False = Tidak (Tidak mencek); True = Ya (Mencek) [Default]. Sekarang, hanya BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR dan ZIP format yang didukung (RAR, CAB, 7z, dll tidak didukung). Ini tidak selalu sempurna! Selama saya sangat rekomendasikan menjaga ini aktif, saya tidak dapat menjamin itu hanya menemukan segala sesuatunya. Juga diingatkan bahwa mencek file terkompres tidak rekursif untuk format PHAR atau ZIP.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Memperlalaikan ukuran daftar hitam/putih dari isi file terkompress? False = Tidak (Bertanda abu-abu semua); True = Ya [Default].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Batasan ukuran file dalam KB. 65536 = 64MB [Default]; 0 = Tidak ada batasa (selalu bertanda abu-abu), nilai angka positif apapun diterima. Ini dapat berguna ketika batasan konfigurasi PHP Anda membatasi jumah memori dari proses yang dapat ditampungnya atau jika konfigurasi PHP Anda membatasi jumlah ukuran upload Anda.';
$phpMussel['lang']['config_files_filesize_response'] = 'Apa yang Anda lakukan dengan file-file yang melebihi batasan ukuran (jika ada). False = Bertanda putih; True = Bertanda hitam [Default].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Memperlalaikan jenis file daftar hitam/putih dari isi file terkompress? False = Tidak (Bertanda abu-abu semua) [Default]; True = Ya.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Daftar Hitam:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Daftar Abu-Abu:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Jika sistem Anda hanya mengizinkan tipe file spesifik menjadi diupload, atau jika sistem Anda secara eksplisit menolak tipe file-file tertentu, menspesifikasikan tipe file dalam bertanda putih, bertanda hitam dan bertanda abu-abu dapat menaikkan kecepatan dari pemindaian dilakukan dengan mengizinkan skrip untuk mengabaikan tipe file tertentu. Format adalah CSV (comma separated values). Jika Anda ingin memindai semuanya, daripada daftar putih, daftar hitam atau daftar abu-abu, tinggalkan variabel kosong; Melakukannya akan menonaktifkan dafter putih/hitam/abu-abu. Urutan logis dari pengolahan: Jika tipe file bertanda putih, tidak memindai dan tidak memblokir file, dan tidak memeriksa file terhadap daftar hitam atau daftar abu-abu. Jika tipe file bertanda hitem, tidak memindai file tapi memblokir bagaimanapun, dan tidak memeriksa file terhadap daftar abu-abu. Jika daftar abu-abu yang kosong atau jika daftar abu-abu tidak kosong dan tipe file bertanda abu-abu, memindai file seperti biasa dan menentukan apakah untuk memblokir berdasarkan hasil memindai, tapi jika daftar abu-abu tidak kosong dan tipe file tidak bertanda abu-abu, memperlakukan seolah olah bertanda hitam, demikian tidak memindai tapi memblokir itu bagaimanapun. Daftar Putih:';
$phpMussel['lang']['config_files_max_recursion'] = 'Batas kedalaman rekursi maksimum untuk arsip. Default = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maksimum jumla file-file yang diizinkan untuk dipindai selama pemindaian upload file sebelum menghentikan pemindaian dan menginformasikan pengguna bahwa pengguna mengupload terlalu banyak! Menyediakan perlindungan pada serangan teoritis dimana penyerang mencoba DDoS pada sistem Anda atau CMS ada dengan overloading phpMussel supaya berjalan lambat. Proses PHP ke penghentian keras. Recommendasi: 10. Anda dapat menaikkan atau menurunkan angka ini bergantung dari kecepatan hardware Anda. Catat itu nomor ini tidak mengakuntabilitas atau mengikutkan konten dari file terkompres.';
$phpMussel['lang']['config_general_cleanup'] = 'Membersihkan variabel skrip dan cache setelah eksekusi? False = Tidak; True = Ya [Default]. Jika Anda tidak menggukan skrip di bawah pemindaian upload inisial, harus diset ke <code>true</code> (ya) untuk meminimalisasi penggunaan memori. Jika Anda menggunakan skrip untuk tujuan di bawah pemindaian upload inisial, harus diset ke <code>false</code> (tidak), untuk menghindari reload duplikat file ke memori. Dalam praktek umum, haru diset ke <code>true</code>, tapi jika kamu melakukannya, kamu tidak bisa menggunakan skrip untuk hal lain kecuali pemindaian upload file. Tidak memiliki pengaruh di dalam mode CLI.';
$phpMussel['lang']['config_general_default_algo'] = 'Mendefinisikan algoritma mana yang akan digunakan untuk semua password dan sesi di masa depan. Opsi: PASSWORD_DEFAULT (default), PASSWORD_BCRYPT, PASSWORD_ARGON2I (membutuhkan PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Mengaktifkan opsi ini akan menginstruksikan skrip untuk berusaha secepatnya menghapus file apapun yang ditemukannya selama scan yang mencocokkan pada kriteria deteksi apapun, baik melalui tanda tangan atau yang lain. file-file ditentukan "clean" tidak akan disentuh. Pada kasus file terkompress seluruh file terkompress akan didelate (kecuali file yang menyerang adalah satu-satunya dari beberapa file yang menjadi isi file terkompress). Untuk kasus pemindaian upload file biasanya, tidak cocok untuk mengaktifkan opsi ini, karena biasanya PHP akan secara otomatis menyatukan isi dari cache ketika eksekusi selesai, berarti bahwa dia akan selalu menghapus file terupload apapun melalui server jika tidak dipindahkan, dikopi atau dihapus sebelumnya. Opsi tersebut ditambahkan disini sebagai ukuran keamanan ekstra untuk semua salinan PHP yang tidak selalu bersikap pada perilaku yang diharapkan. False = Setelah pemindahaian, biarkan file [Default]; True = Setelah pemindaian, jika tidak bersih, hapus langsung.';
$phpMussel['lang']['config_general_disable_cli'] = 'Menonaktifkan modus CLI? Modus CLI diaktifkan secara default, tapi kadang-kadang dapat mengganggu alat pengujian tertentu (seperti PHPUnit, sebagai contoh) dan aplikasi CLI berbasis lainnya. Jika Anda tidak perlu menonaktifkan modus CLI, Anda harus mengabaikan direktif ini. False = Mengaktifkan modus CLI [Default]; True = Menonaktifkan modus CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Menonaktifkan akses bagian depan? Akses bagian depan dapat membuat phpMussel lebih mudah dikelola, tapi juga dapat menjadi potensial resiko keamanan. Itu direkomendasi untuk mengelola phpMussel melalui bagian belakang bila mungkin, tapi akses bagian depan yang disediakan untuk saat itu tidak mungkin. Memilikinya dinonaktifkan kecuali jika Anda membutuhkannya. False = Mengaktifkan akses bagian depan; True = Menonaktifkan akses bagian depan [Default].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Menonaktifkan webfonts? True = Ya; False = Tidak [Default].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Mengaktifkan dukungan untuk plugin phpMussel? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Seharusnya phpMussel mengirimkan 403 headers dengan pesan upload file yang terblok, atau cocok dengan 200 OK? False = Tidak (200); True = Ya (403) [Default].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'File untuk mencatat upaya login untuk bagian depan. Spesifikasikan nama file, atau biarkan kosong untuk menonaktifkan.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Bila modus honeypot diaktifkan, phpMussel akan mencoba untuk karantina setiap file upload yang dia menemui, terlepas dari apakah atau tidak file yang di-upload cocok dengan tanda tangan yang disertakan, dan tidak ada pemindaian aktual atau analisis dari upload file akan terjadi. Fungsi ini akan berguna bagi mereka yang ingin menggunakan phpMussel untuk tujuan virus/malware penelitian, tapi tidak direkomendasikan untuk mengaktifkan fungsi ini jika tujuan penggunaan dari phpMussel oleh pengguna adalah bagi aktual upload file pemindaian dan juga tidak direkomendasikan untuk menggunakan fungsi honeypot untuk tujuan selain bagi honeypot. Biasanya, opsi ini dinonaktifkan. False = Dinonaktifkan [Default]; True = Diaktifkan.';
$phpMussel['lang']['config_general_ipaddr'] = 'Dimana menemukan alamat IP dari permintaan alamat? (Bergunak untuk pelayanan-pelayanan seperti Cloudflare dan sejenisnya). Default = REMOTE_ADDR. PERINGATAN: Jangan ganti ini kecuali Anda tahu apa yang Anda lakukan!';
$phpMussel['lang']['config_general_lang'] = 'Tentukan bahasa default untuk phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Aktifkan modus perawatan? True = Ya; False = Tidak [Default]. Nonaktifkan semuanya selain bagian depan. Terkadang berguna saat memperbarui CMS, kerangka kerja, dll.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Jumlah maksimum upaya untuk memasukkan (bagian depan). Default = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Cara apa yang kamu suka nomor menjadi ditampilkan? Pilih contoh yang paling sesuai untuk Anda.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel dapat mengkarantina upload file ditandai dalam isolasi dalam vault phpMussel, jika ini adalah sesuatu yang Anda ingin lakukan. Pengguna biasa dari phpMussel yang hanya ingin memproteksi website mereka dan/atau lingkungan hosting mereka tanpa memiliki minat dalam-dalam menganalisis setiap ditandai upload file harus meninggalkan fungsi ini dinonaktifkan, tapi setiap pengguna yang tertarik pada analisis lebih lanjut dari ditandai upload file bagi penelitian malware atau untuk hal-hal seperti serupa harus mengaktifkan fungsi ini. Mengkarantina ditandai upload file dapat kadang-kadang juga membantu dalam men-debug false-positif, jika ini adalah sesuatu yang sering terjadi untuk Anda. Untuk menonaktifkan fungsi karantina, meninggalkan <code>quarantine_key</code> direktif kosong, atau menghapus isi dari direktif ini jika tidak sudah kosong. Untuk mengaktifkan fungsi karantina, masukkan beberapa nilai dalam direktif ini. <code>quarantine_key</code> adalah fitur keamanan penting dari fungsi karantina diharuskan sebagai sarana untuk mencegah fungsi karantina dari dieksploitasi oleh penyerang potensial dan sebagai sarana mencegah eksekusi potensi file yang disimpan dalam karantina. <code>quarantine_key</code> harus diperlakukan dengan cara yang sama seperti password Anda: Semakin lama semakin baik, dan menjaganya diproteksi erat. Bagi efek terbaik, gunakan dalam hubungannya dengan <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'Ukuran file maksimum yang diijinkan dari file yang akan dikarantina. File yang lebih besar dari nilai yang ditentukan di bawah ini TIDAK akan dikarantina. Direktif ini penting sebagai sarana untuk membuat lebih sulit bagi setiap penyerang potensial untuk banjir karantina Anda dengan file yang tidak diinginkan berpotensi menyebabkan penggunaan file kelebihan pada layanan hosting Anda. Default = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'Penggunaan memori maksimal yang diijinkan untuk karantina. Jika total penggunaan memori oleh karantina mencapai nilai ini, file yang dikarantina tertua akan dihapus sampai total penggunaan memori tidak lagi mencapai nilai ini. Direktif ini penting sebagai sarana untuk membuat lebih sulit bagi setiap penyerang potensial untuk banjir karantina Anda dengan file yang tidak diinginkan berpotensi menyebabkan penggunaan file kelebihan pada layanan hosting Anda. Default = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Untuk berapa lama harus phpMussel cache hasil-hasil? Nilai adalah jumlah detik untuk cache hasil-hasil untuk. Default adalah 21600 detik (6 jam); Nilai 0 akan menonaktifkan caching hasil-hasil.';
$phpMussel['lang']['config_general_scan_kills'] = 'Nama dari fata untuk mencatat semua rekord dari upload terblok atau terbunuh. Spesifikan nama atau biarkan kosong untuk menonaktifkan.';
$phpMussel['lang']['config_general_scan_log'] = 'Nama dari file untuk mencatat semua hasil pemindaian. Spesifikasikan nama atau biarkan kosong untuk menonaktifkan.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Nama dari file untuk mencatat semua hasil pemindaian (menggunakan format serial). Spesifikasikan nama atau biarkan kosong untuk menonaktifkan.';
$phpMussel['lang']['config_general_statistics'] = 'Lacak statistik penggunaan phpMussel? True = Ya; False = Tidak [Default].';
$phpMussel['lang']['config_general_timeFormat'] = 'Format notasi tanggal/waktu yang digunakan oleh phpMussel. Opsi tambahan dapat ditambahkan atas permintaan.';
$phpMussel['lang']['config_general_timeOffset'] = 'Offset zona waktu dalam hitungan menit.';
$phpMussel['lang']['config_general_timezone'] = 'Zona waktu Anda.';
$phpMussel['lang']['config_general_truncate'] = 'Memotong file log ketika mereka mencapai ukuran tertentu? Nilai adalah ukuran maksimum dalam B/KB/MB/GB/TB yang bisa ditambahkan untuk file log sebelum dipotong. Nilai default 0KB menonaktifkan pemotongan (file log dapat tumbuh tanpa batas waktu). Catatan: Berlaku untuk file log individu! Ukuran file log tidak dianggap secara kolektif.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Ada tanda tangan tertentu dari phpMussel yang dimaksudkan untuk mengidentifikasi kualitas yang mencurigakan dan berpotensi berbahaya pada file-file yang di-upload tanpa di diri mereka mengidentifikasi file-file yang di-upload spesifik sebagai berbahaya. Ini "threshold" nilai memberitahu phpMussel apa total berat maksimum untuk kualitas yang mencurigakan dan berpotensi berbahaya pada file-file yang di-upload yang diijinkan adalah sebelum file-file yang akan diidentifikasi sebagai berbahaya. Definisi berat dalam konteks ini adalah jumlah total kualitas mencurigakan dan berpotensi berbahaya diidentifikasi. Secara default, nilai ini akan ditetapkan sebagai 3. Sebuah nilai lebih rendah umumnya akan menghasilkan sebagai lebih tinggi positif palsu kejadian tapi sebuah jumlah lebih tinggi file berbahaya diidentifikasi, sedangkan sebuah nilai lebih tinggi umumnya akan menghasilkan sebagai lebih rendah positif palsu kejadian tapi sebuah jumlah lebih rendah pada file berbahaya yang diidentifikasi. Ini umumnya terbaik untuk meninggalkan nilai ini di default kecuali jika Anda mengalami masalah berhubungan dengan itu.';
$phpMussel['lang']['config_signatures_Active'] = 'Daftar file tanda tangan yang aktif, dipisahkan oleh koma.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi adware? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi perusakan dan perusak? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Harus phpMussel mendeteksi dan memblokir file terenkripsi? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi lelucon/kebohongan malware/virus? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi pengepakan dan file dikemas? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi PUAs/PUPs? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Harus phpMussel menggunakan tanda tangan untuk mendeteksi skrip shell? False = Tidak; True = Ya [Default].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Seharusnya laporan phpMussel ketika ekstensi hilang? Jika <code>fail_extensions_silently</code> dinonaktifkan, ekstensi hilang akan dilaporkan ketika pemindaian, dan jika <code>fail_extensions_silently</code> diaktifkan, ekstensi hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini bahwa tidak ada masalah. Menonaktifkan direktif ini berpotensi dapat meningkatkan keamanan Anda, tapi juga dapat menyebabkan peningkatan positif palsu. False = Dinonaktifkan; True = Diaktifkan [Default].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Seharusnya laporan phpMussel ketika file tanda tangan hilang atau dikorup? Jika <code>fail_silently</code> dinonaktifkan, file dikorup dan hilang akan dilaporkan ketika pemindaian, dan jika <code>fail_silently</code> diaktifkan, file dikorup dan hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini bahwa tidak ada masalah. Harus ini dibiarkan sendirian jika Anda pernah mengalami crash atau masalah lain. False = Dinonaktifkan; True = Diaktifkan [Default].';
$phpMussel['lang']['config_template_data_css_url'] = 'File template untuk tema kustom menggunakan properti CSS eksternal, sedangkan file template untuk tema default menggunakan properti CSS internal. Untuk menginstruksikan phpMussel menggunakan file template untuk tema kustom, menentukan alamat HTTP publik file CSS tema kustom Anda menggunakan variable <code>css_url</code>. Jika Anda biarkan kosong variabel ini, phpMussel akan menggunakan file template untuk tema default.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Perbesaran font. Default = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Tema default untuk phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Berapa lama (dalam detik) harus hasil API untuk disimpan dalam cache? Default adalah 3600 detik (1 jam).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Memungkinkan pemeriksaan API ke Google Safe Browsing API ketika kunci API diperlukan didefinisikan.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Memungkinkan pemeriksaan API ke hpHosts API ketika diset untuk true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Jumlah maksimum pemeriksaan API melakukan per iterasi memindai individual. Karena setiap API pemeriksaan akan menambah tambahan waktu total dibutuhkan untuk menyelesaikan setiap iterasi pemindaian, Anda mungkin ingin menetapkan batasan untuk mempercepat proses pemindaian secara keseluruhan. Bila diset untuk 0, sejumlah maksimum tidak akan diterapkan. Diset untuk 10 secara default.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Apa yang harus dilakukan jika jumlah maksimal pemeriksaan API dilampaui? False = Tidak melakukan apa-apa (melanjutkan pemrosesan) [Default]; True = Memblokir file.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Secara fakultatif, phpMussel mampu memindai file menggunakan Virus Total API sebagai cara untuk memberikan tingkat sangat ditingkatkan perlindungan terhadap virus, trojan, malware dan ancaman lainnya. Secara default, file pemindaian menggunakan Virus Total API dinonaktifkan. Untuk mengaktifkannya, kunci API dari Virus Total diperlukan. Karena manfaat yang signifikan bahwa ini bisa memberikan kepada Anda, itu adalah sesuatu yang sangat direkomendasi mengaktifkan. Perlu diketahui, bagaimanapun, menggunakan Virus Total API, Anda <em><strong>HARUS</strong></em> setuju untuk Terms of Service dan Anda <em><strong>HARUS</strong></em> mematuhi semua pedoman terkait dijelaskan oleh Virus Total dokumentasi! Anda TIDAK diizinkan untuk menggunakan fungsi ini KECUALI KALAU: Anda membaca dan setuju untuk Terms of Service dari Virus Total dan API mereka. Anda membaca dan memahami, setidaknya, mukadimah dari Virus Total dokumentasi API (semuanya setelah "VirusTotal Public API v2.0" tapi sebelum "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Menurut Virus Total dokumentasi API, itu terbatas untuk paling 4 permintaan dalam bentuk apapun dalam jangka waktu 1 menit diberikan. Jika Anda menjalankan sebuah honeyclient, honeypot atau otomatisasi lainnya yang akan menyediakan file untuk VirusTotal dan tidak hanya mengambil laporan Anda berhak untuk kuota permintaan lebih tinggi. Secara default, phpMussel ketat akan mematuhi keterbatasan ini, tapi karena kemungkinan kuota ini sedang meningkat, dua direktif ini yang disediakan sebagai sarana bagi Anda untuk menginstruksikan phpMussel tentang apa batas harus dipatuhi. Kecuali Anda telah diperintahkan untuk melakukannya, itu tidak direkomendasikan bagi Anda untuk meningkat nilai-nilai ini, tapi, jika Anda mengalami masalah berkaitan dengan mencapai kuota Anda, penurunan nilai-nilai ini kadang <em><strong>DAPAT</strong></em> membantu Anda bagi berurusan dengan masalah-masalah ini. Batas Anda ditentukan sebagai <code>vt_quota_rate</code> permintaan dalam bentuk apapun dalam jangka waktu <code>vt_quota_time</code> menit.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Lihat uraian di atas).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Secara default, phpMussel akan membatasi file dipindai menggunakan Virus Total API untuk file-file yang dianggap "mencurigakan". Anda dapat menyesuaikan pembatasan ini dengan mengubah nilai direktif <code>vt_suspicion_level</code>.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Apakah Anda ingin phpMussel menerapkan hasil pemindaian menggunakan Virus Total API sebagai deteksi atau deteksi pembobotan? Direktif ini ada, karena, meskipun memindai file menggunakan mesin-mesin kelipatan (sebagai Virus Total melakukannya) harus menghasilkan tingkat deteksi meningkat (dan demikian lebih banyak file berbahaya tertangkap), juga dapat menghasilkan jumlah yang lebih banyak dari positif palsu, dan demikian, dalam kondisi beberapa, hasil pemindaian dapat digunakan lebih efektif sebagai nilai keyakinan daripada daripada sebagai kesimpulan definitif. Jika nilai 0 digunakan, hasil pemindaian menggunakan Virus Total API akan diaplikasikan sebagai pendeteksian, dan demikian, jika mesin-mesin digunakan oleh Virus Total menandai file dipindai sebagai berbahaya, phpMussel akan menganggap file yang berbahaya. Jika nilai lain yang digunakan, hasil pemindaian menggunakan Virus Total API akan diaplikasikan sebagai deteksi pembobotan, dan demikian, jumlah mesin digunakan oleh Virus Total menandai file dipindai sebagai berbahaya akan berfungsi sebagai nilai keyakinan (atau deteksi pembobotan) untuk jika file dipindai harus dianggap berbahaya oleh phpMussel (nilai digunakan akan mewakili nilai keyakinan minimum atau pembobotan minimum diperlukan untuk dianggap berbahaya). Nilai 0 digunakan secara default.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'Paket utama (tanpa tanda tangan, dokumentasi, konfigurasi).';
$phpMussel['lang']['field_activate'] = 'Mengaktifkan';
$phpMussel['lang']['field_clear_all'] = 'Cabut semua';
$phpMussel['lang']['field_component'] = 'Komponen';
$phpMussel['lang']['field_create_new_account'] = 'Buat Akun Baru';
$phpMussel['lang']['field_deactivate'] = 'Menonaktifkan';
$phpMussel['lang']['field_delete_account'] = 'Hapus Akun';
$phpMussel['lang']['field_delete_all'] = 'Menghapus semua';
$phpMussel['lang']['field_delete_file'] = 'Menghapus';
$phpMussel['lang']['field_download_file'] = 'Mendownload';
$phpMussel['lang']['field_edit_file'] = 'Mengedit';
$phpMussel['lang']['field_false'] = 'False (Palsu)';
$phpMussel['lang']['field_file'] = 'File';
$phpMussel['lang']['field_filename'] = 'Nama file: ';
$phpMussel['lang']['field_filetype_directory'] = 'Direktori';
$phpMussel['lang']['field_filetype_info'] = 'File {EXT}';
$phpMussel['lang']['field_filetype_unknown'] = 'Tidak Diketahui';
$phpMussel['lang']['field_install'] = 'Instal';
$phpMussel['lang']['field_latest_version'] = 'Versi Terbaru';
$phpMussel['lang']['field_log_in'] = 'Masuk';
$phpMussel['lang']['field_more_fields'] = 'Bidang Lebih';
$phpMussel['lang']['field_new_name'] = 'Nama baru:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Opsi';
$phpMussel['lang']['field_password'] = 'Kata Sandi';
$phpMussel['lang']['field_permissions'] = 'Izin';
$phpMussel['lang']['field_quarantine_key'] = 'Kunci karantina';
$phpMussel['lang']['field_rename_file'] = 'Memodifikasi nama';
$phpMussel['lang']['field_reset'] = 'Mengatur Kembali';
$phpMussel['lang']['field_restore_file'] = 'Memulihkan';
$phpMussel['lang']['field_set_new_password'] = 'Buat Baru Kata Sandi';
$phpMussel['lang']['field_size'] = 'Ukuran Total: ';
$phpMussel['lang']['field_size_bytes'] = 'byte';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Status';
$phpMussel['lang']['field_system_timezone'] = 'Gunakan zona waktu default sistem.';
$phpMussel['lang']['field_true'] = 'True (Benar)';
$phpMussel['lang']['field_uninstall'] = 'Uninstal';
$phpMussel['lang']['field_update'] = 'Perbarui';
$phpMussel['lang']['field_update_all'] = 'Memperbarui semua';
$phpMussel['lang']['field_upload_file'] = 'Mengupload file baru';
$phpMussel['lang']['field_username'] = 'Nama Pengguna';
$phpMussel['lang']['field_your_version'] = 'Versi Anda';
$phpMussel['lang']['header_login'] = 'Silahkan masuk untuk melanjutkan.';
$phpMussel['lang']['label_active_config_file'] = 'File konfigurasi aktif: ';
$phpMussel['lang']['label_blocked'] = 'Upload diblokir';
$phpMussel['lang']['label_branch'] = 'Cabang terbaru stabil:';
$phpMussel['lang']['label_events'] = 'Pindai acara';
$phpMussel['lang']['label_flagged'] = 'Obyek ditandai';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Data cache dan file sementara';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'Penggunaan disk phpMussel: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Ruang disk kosong: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Penggunaan disk total: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Ruang disk total: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Komponen memperbarui metadata';
$phpMussel['lang']['label_hide'] = 'Menyembunyikan';
$phpMussel['lang']['label_os'] = 'Sistem operasi digunakan:';
$phpMussel['lang']['label_other'] = 'Lain';
$phpMussel['lang']['label_other-Active'] = 'File tanda tangan aktif';
$phpMussel['lang']['label_other-Since'] = 'Mulai tanggal';
$phpMussel['lang']['label_php'] = 'Versi PHP digunakan:';
$phpMussel['lang']['label_phpmussel'] = 'Versi phpMussel digunakan:';
$phpMussel['lang']['label_quarantined'] = 'Upload dikarantina';
$phpMussel['lang']['label_sapi'] = 'SAPI digunakan:';
$phpMussel['lang']['label_scanned_objects'] = 'Obyek dipindai';
$phpMussel['lang']['label_scanned_uploads'] = 'Upload dipindai';
$phpMussel['lang']['label_show'] = 'Menunjukkan';
$phpMussel['lang']['label_size_in_quarantine'] = 'Ukuran dalam karantina: ';
$phpMussel['lang']['label_stable'] = 'Terbaru stabil:';
$phpMussel['lang']['label_sysinfo'] = 'Informasi sistem:';
$phpMussel['lang']['label_tests'] = 'Pengujian:';
$phpMussel['lang']['label_unstable'] = 'Terbaru tidak stabil:';
$phpMussel['lang']['label_upload_date'] = 'Tanggal pengunggahan: ';
$phpMussel['lang']['label_upload_hash'] = 'Hash pengunggahan: ';
$phpMussel['lang']['label_upload_origin'] = 'Asal pengunggahan: ';
$phpMussel['lang']['label_upload_size'] = 'Ukuran pengunggahan: ';
$phpMussel['lang']['link_accounts'] = 'Akun';
$phpMussel['lang']['link_config'] = 'Konfigurasi';
$phpMussel['lang']['link_documentation'] = 'Dokumentasi';
$phpMussel['lang']['link_file_manager'] = 'File Manager';
$phpMussel['lang']['link_home'] = 'Halaman Utama';
$phpMussel['lang']['link_logs'] = 'Log';
$phpMussel['lang']['link_quarantine'] = 'Karantina';
$phpMussel['lang']['link_statistics'] = 'Statistik';
$phpMussel['lang']['link_textmode'] = 'Format teks: <a href="%1$sfalse">Sederhana</a> – <a href="%1$strue">Terformat</a>';
$phpMussel['lang']['link_updates'] = 'Pembaruan';
$phpMussel['lang']['link_upload_test'] = 'Upload Test';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Log yang dipilih tidak ada!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Tidak ada log tersedia.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Tidak ada log dipilih.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Jumlah maksimum upaya untuk memasukkan tercapai; Akses ditolak.';
$phpMussel['lang']['previewer_days'] = 'Hari';
$phpMussel['lang']['previewer_hours'] = 'Jam';
$phpMussel['lang']['previewer_minutes'] = 'Menit';
$phpMussel['lang']['previewer_months'] = 'Bulan';
$phpMussel['lang']['previewer_seconds'] = 'Detik';
$phpMussel['lang']['previewer_weeks'] = 'Minggu';
$phpMussel['lang']['previewer_years'] = 'Tahun';
$phpMussel['lang']['response_accounts_already_exists'] = 'Akun dengan nama pengguna ini sudah ada!';
$phpMussel['lang']['response_accounts_created'] = 'Akun berhasil dibuat!';
$phpMussel['lang']['response_accounts_deleted'] = 'Akun berhasil dihapus!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Akun ini tidak ada.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Kata sandi berhasil diperbarui!';
$phpMussel['lang']['response_activated'] = 'Berhasil diaktifkan.';
$phpMussel['lang']['response_activation_failed'] = 'Kegagalan pengaktifan!';
$phpMussel['lang']['response_checksum_error'] = 'Kesalahan checksum! File ditolak!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Komponen berhasil diinstal.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Komponen berhasil diuninstal.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Komponen berhasil diperbarui.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Terjadi kesalahan saat mencoba untuk menguninstal komponen ini.';
$phpMussel['lang']['response_configuration_updated'] = 'Konfigurasi berhasil diperbarui.';
$phpMussel['lang']['response_deactivated'] = 'Berhasil dinonaktifkan.';
$phpMussel['lang']['response_deactivation_failed'] = 'Kegagalan penonaktifan!';
$phpMussel['lang']['response_delete_error'] = 'Gagal menghapus!';
$phpMussel['lang']['response_directory_deleted'] = 'Direktori berhasil dihapus!';
$phpMussel['lang']['response_directory_renamed'] = 'Nama direktori berhasil dimodifikasi!';
$phpMussel['lang']['response_error'] = 'Kesalahan';
$phpMussel['lang']['response_failed_to_install'] = 'Gagal menginstal!';
$phpMussel['lang']['response_failed_to_update'] = 'Gagal memperbarui!';
$phpMussel['lang']['response_file_deleted'] = 'File berhasil dihapus!';
$phpMussel['lang']['response_file_edited'] = 'File berhasil diubah!';
$phpMussel['lang']['response_file_renamed'] = 'Nama file berhasil dimodifikasi!';
$phpMussel['lang']['response_file_restored'] = 'File berhasil dipulihkan!';
$phpMussel['lang']['response_file_uploaded'] = 'File berhasil diupload!';
$phpMussel['lang']['response_login_invalid_password'] = 'Kegagalan masuk! Kata sandi salah!';
$phpMussel['lang']['response_login_invalid_username'] = 'Kegagalan masuk! Nama pengguna tidak ada!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Kata sandi yang kosong!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Nama pengguna yang kosong!';
$phpMussel['lang']['response_rename_error'] = 'Gagal memodifikasi nama!';
$phpMussel['lang']['response_restore_error_1'] = 'Gagal memulihkan! File rusak!';
$phpMussel['lang']['response_restore_error_2'] = 'Gagal memulihkan! Kunci karantina salah!';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistik dicabut';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Sudah yang terbaru.';
$phpMussel['lang']['response_updates_not_installed'] = 'Komponen tidak diinstal!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Komponen tidak diinstal (membutuhkan PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Tidak yang terbaru!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Tidak yang terbaru (silahkan perbarui secara manual)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Tidak yang terbaru (membutuhkan PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Tidak dapat menentukan.';
$phpMussel['lang']['response_upload_error'] = 'Gagal mengupload!';
$phpMussel['lang']['state_complete_access'] = 'Akses lengkap';
$phpMussel['lang']['state_component_is_active'] = 'Komponen ini aktif.';
$phpMussel['lang']['state_component_is_inactive'] = 'Komponen ini non-aktif.';
$phpMussel['lang']['state_component_is_provisional'] = 'Komponen ini kadang-kadang aktif.';
$phpMussel['lang']['state_default_password'] = 'Peringatan: Menggunakan kata sandi standar!';
$phpMussel['lang']['state_logged_in'] = 'Pengguna yang online.';
$phpMussel['lang']['state_logs_access_only'] = 'Akses ke log hanya';
$phpMussel['lang']['state_maintenance_mode'] = 'Peringatan: Modus perawatan diaktifkan!';
$phpMussel['lang']['state_password_not_valid'] = 'Peringatan: Akun ini tidak menggunakan kata sandi yang valid!';
$phpMussel['lang']['state_quarantine'] = 'Ada %s file yang saat ini di karantina.';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Tidak menyembunyikan terbaru';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Menyembunyikan terbaru';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Tidak menyembunyikan non-digunakan';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Menyembunyikan non-digunakan';
$phpMussel['lang']['tip_accounts'] = 'Salam, {username}.<br />Halaman akun memungkinkan Anda untuk mengontrol siapa dapat mengakses bagian depan phpMussel.';
$phpMussel['lang']['tip_config'] = 'Salam, {username}.<br />Halaman konfigurasi memungkinkan Anda untuk memodifikasi konfigurasi untuk phpMussel dari bagian depan.';
$phpMussel['lang']['tip_donate'] = 'phpMussel ditawarkan gratis, tapi jika Anda ingin menyumbang untuk proyek, Anda dapat melakukannya dengan mengklik menyumbangkan tombol.';
$phpMussel['lang']['tip_file_manager'] = 'Salam, {username}.<br />File manager memungkinkan Anda untuk menghapus, mengedit, mengupload, dan mendownload file. Gunakan dengan hati-hati (Anda bisa istirahat instalasi Anda dengan ini).';
$phpMussel['lang']['tip_home'] = 'Salam, {username}.<br />Ini adalah halaman utama untuk phpMussel bagian depan. Pilih link dari menu navigasi di sisi kiri untuk melanjutkan.';
$phpMussel['lang']['tip_login'] = 'Nama pengguna standar: <span class="txtRd">admin</span> – Kata sandi standar: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Salam, {username}.<br />Pilih log dari daftar dibawah untuk melihat isi log.';
$phpMussel['lang']['tip_quarantine'] = 'Salam, {username}.<br />Halaman ini mencantumkan semua file yang saat ini ada di karantina dan memfasilitasi pengelolaan file-file tersebut.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Catatan: Karantina saat ini dinonaktifkan, namun bisa diaktifkan melalui halaman konfigurasi.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Lihat <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.id.md#SECTION7">dokumentasi</a> untuk informasi tentang berbagai direktif konfigurasi dan tujuan mereka.';
$phpMussel['lang']['tip_statistics'] = 'Salam, {username}.<br />Halaman ini menunjukkan beberapa statistik penggunaan dasar mengenai instalasi phpMussel Anda.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Catatan: Pelacakan statistik saat ini dinonaktifkan, namun dapat diaktifkan melalui halaman konfigurasi.';
$phpMussel['lang']['tip_updates'] = 'Salam, {username}.<br />Halaman pembaruan memungkinkan Anda untuk menginstal, menguninstal, dan memperbarui berbagai komponen phpMussel (paket inti, tanda tangan, plugin, file L10N, dll).';
$phpMussel['lang']['tip_upload_test'] = 'Salam, {username}.<br />Halaman upload test berisi form upload file standar, memungkinkan Anda untuk mengetes apakah file biasanya akan diblokir oleh phpMussel ketika mencoba untuk menguploadnya.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Akun';
$phpMussel['lang']['title_config'] = 'phpMussel – Konfigurasi';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – File Manager';
$phpMussel['lang']['title_home'] = 'phpMussel – Halaman Utama';
$phpMussel['lang']['title_login'] = 'phpMussel – Masuk';
$phpMussel['lang']['title_logs'] = 'phpMussel – Log';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Karantina';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistik';
$phpMussel['lang']['title_updates'] = 'phpMussel – Pembaruan';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Upload Test';
$phpMussel['lang']['warning'] = 'Peringatan:';
$phpMussel['lang']['warning_php_1'] = 'Versi PHP Anda tidak aktif didukung lagi! Memperbarui dianjurkan!';
$phpMussel['lang']['warning_php_2'] = 'Versi PHP Anda sangat rentan! Memperbarui sangat dianjurkan!';
$phpMussel['lang']['warning_signatures_1'] = 'Tidak ada file tanda tangan yang aktif!';

$phpMussel['lang']['info_some_useful_links'] = 'Beberapa link yang berguna:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">Masalah phpMussel @ GitHub</a> – Halaman masalah untuk phpMussel (dukungan, bantuan, dll).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Forum diskusi untuk phpMussel (dukungan, bantuan, dll).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Cermin download alternatif untuk phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Sebuah kumpulan alat webmaster sederhana untuk mengamankan situs web.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – Halaman utama untuk ClamAV (ClamAV® adalah injin antivirus open source untuk mendeteksi trojan, virus, malware dan ancaman berbahaya lainnya).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Perusahaan keamanan komputer yang menawarkan tanda tangan tambahan untuk ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Database phishing digunakan oleh scanner URL phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – Sumber belajar dan diskusi PHP.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – Sumber belajar dan diskusi PHP.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal adalah layanan gratis untuk menganalisis file dan URL yang mencurigakan.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis adalah layanan analisis malware gratis yang disediakan oleh <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Komputer spesialis anti-malware.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Berguna forum diskusi difokuskan pada malware.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Tabel Kerentanan</a> – Mencantumkan berbagai versi dari paket-paket yang aman dan tidak aman (PHP, HHVM, dll).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Tabel Kompatibilitas</a> – Mencantumkan informasi kompatibilitas untuk berbagai paket (CIDRAM, phpMussel, dll).</li>
        </ul>';
