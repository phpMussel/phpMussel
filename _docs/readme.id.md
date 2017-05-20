## Dokumentasi untuk phpMussel (Bahasa Indonesia).

### Isi
- 1. [SEPATAH KATA](#SECTION1)
- 2. [BAGAIMANA CARA MENGINSTAL](#SECTION2)
- 3. [BAGAIMANA CARA MENGGUNAKAN](#SECTION3)
- 4. [MANAJEMEN BAGIAN DEPAN](#SECTION4)
- 5. [CLI (COMMAND LINE INTERFACE)](#SECTION5)
- 6. [FILE YANG DIIKUTKAN DALAM PAKET INI](#SECTION6)
- 7. [OPSI KONFIGURASI](#SECTION7)
- 8. [FORMAT TANDA TANGAN](#SECTION8)
- 9. [MASALAH KOMPATIBILITAS DIKETAHUI](#SECTION9)
- 10. [PERTANYAAN YANG SERING DIAJUKAN (FAQ)](#SECTION10)

*Catatan tentang terjemahan: Dalam hal kesalahan (misalnya, perbedaan antara terjemahan, kesalahan cetak, dll), versi bahasa Inggris dari README dianggap versi asli dan berwibawa. Jika Anda menemukan kesalahan, bantuan Anda dalam mengoreksi mereka akan disambut.*

---


### 1. <a name="SECTION1"></a>SEPATAH KATA

Terima kasih untuk menggunakan phpMussel, sebuah skrip PHP di-design untuk mendeteksi trojan-trojan, virus-virus dan serangan-serangan lainnya dalam file-file diupload ke sistem Anda dimana saja skrip di kaitkan, berdasarkan tanda tangan dari ClamAV dan lain-lain.

PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPLv2 oleh Caleb M (Maikuolan).

Skrip ini adalah perangkat lunak gratis; Anda dapat mendistribusikan kembali dan/atau memodifikasinya dalam batasan dari GNU General Public License, seperti di publikasikan dari Free Software Foundation; baik versi 2 dari License, atau (dalam opsi Anda) versi selanjutnya apapun. Skrip ini didistribusikan untuk harapan dapat digunakan tapi TANPA JAMINAN; tanpa walaupun garansi dari DIPERJUALBELIKAN atau KECOCOKAN UNTUK TUJUAN TERTENTU. Mohon Lihat GNU General Public Licence untuk lebih detail, terletak di file `LICENSE.txt` dan tersedia juga dari:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Terima kasih khususnya untuk ClamAV buat inspirasi project dan tanda tangan dimana skrip ini menggunakan ClamAV, tanpa nya skrip ini tidak akan ada, atau akan mengalami nilai yang kurang baik.

Khusus terima kasih kepada Sourceforge dan GitHub untuk menghost file proyek, kepada [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) untuk menghost forum diskusi phpMussel, dan kepada sumber-sumber tambahan tanda tangan dimanfaatkan oleh phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) dan lain-lain, dan khusus terima kasih kepada semua orang yang mendukung proyek, kepada orang lain bahwa saya mungkin telah dinyatakan lupa untuk menyebutkan, dan kepada Anda, untuk menggunakan skrip.

Dokumen ini dan paket terhubung di dalamnya dapat di unduh secara gratis dari:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


### 2. <a name="SECTION2"></a>BAGAIMANA CARA MENGINSTAL

#### 2.0 MENGINSTAL SECARA MANUAL (UNTUK SERVER WEB)

1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh dan menyimpan copy dari skrip, membuka data terkompres dan isinya dan Anda meletakkannya pada mesin komputer lokal Anda. Dari sini, Anda akan latihan dimana di host Anda atau CMS Anda untuk meletakkan isi data terkompres nya. Sebuah direktori seperti `/public_html/phpmussel/` atau yang lain (walaupun tidak masalah Anda memilih direktori apa, selama dia aman dan dimana pun yang Anda senangi) akan mencukupi. *Sebelum Anda mulai upload, mohon baca dulu..*

2) Mengubah file nama `config.ini.RenameMe` ke `config.ini` (berada di dalam `vault`), dan secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), membukanya (file ini berisikan semua opsi operasional yang tersedia untuk phpMussel; di atas tiap opsi seharusnya ada komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa). Atur opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk setup tertentu. Simpan file, menutupnya.

3) Upload isi (phpMussel dan file-filenya) ke direktori yang telah kamu putuskan sebelumnya (Anda tidak memerlukan file-file `*.txt`/`*.md`, tapi kebanyakan Anda harus mengupload semuanya).

4) Gunakan perinta CHMOD ke direktori `vault` dengan "755" (jika ada masalah, Anda dapat mencoba "777", tapi ini kurang aman). Direktori utama menyimpan isinya (yang Anda putuskan sebelumnya), umumnya dapat di biarkan sendirian, tapi status perintah "CHMOD" seharusnya di cek jika kamu punya izin di sistem Anda (defaultnya, seperti "755").

5) Selanjutnya Anda perlu menghubungkan phpMussel ke sistem atau CMS. Ada beberapa cara yang berbeda untuk menghubungkan skrip seperti phpMussel ke sistem atau CMS, tapi yang paling mudah adalah memasukkan skrip pada permulaan dari file murni dari sistem atau CMS (satu yang akan secara umum di muat ketika seseorang mengakses halaman apapun pada website) berdasarkan pernyataan `require` atau `include`. Umumnya, ini akan menjadi sesuatu yang disimpan di sebuah direktori seperti `/includes`, `/assets` atau `/functions` dan akan selalu di namai sesuatu seperti `init.php`, `common_functions.php`, `functions.php` atau yang sama. Anda harus bekerja pada file apa untuk situasi ini; Jika Anda mengalami kesulitan dalam menentukan ini untuk diri sendiri, kunjungi halaman isu-isu (issues) phpMussel di GitHub atau forum dukungan phpMussel untuk bantuan; Ada kemungkinan bahwa saya sendiri atau pengguna lain mungkin memiliki pengalaman dengan CMS yang Anda gunakan (Anda harus memberitahu kami tahu mana CMS yang Anda gunakan), dan demikian, mungkin dapat memberikan beberapa bantuan kepada Anda. Untuk melakukannya [menggunakan `require` atau `include`], sisipkan baris kode dibawah pada file murni, menggantikan kata-kata berisikan didalam tanda kutip dari alamat file `loader.php` (alamat lokal, tidak alamat HTTP; akan terlihat seperti alamat vault yang di bicarakan sebelumnya).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Simpan file dan menutupnya. Upload kembali.

-- ATAU ALTERNATIF --

Jika Anda menggunakan webserver Apache dan jika Anda memiliki akses ke `php.ini`, Anda dapat menggunakan `auto_prepend_file` direktif untuk tambahkan phpMussel setiap kali ada permintaan PHP dibuat. Sesuatu seperti:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Atau ini di file `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) Pada titik ini, kamu telah selesai! Bagaimanapun, kamu mungkin seharusnya mencobanya untuk melihat dia bekerja dengan dengan baik. Untuk mencoba file keamanan upload, coba mengupload file-file testing yang dimasukkan dalam paket di `_testfiles` ke website Anda melalui metode upload di browser Anda. Jika semua bekerja dengan baik, sebuah pesan akan muncul dari phpMussel mengkonfirmasikan bahwa upload sudah sukses di blok. Jika tidak ada yang terjadi, ada sesuatu yang tidak bekerja dengan baik. Jika Anda menggunakan fitur-fitur lanjut atau jika Anda menggunakan tipe-tipe yang lain untuk memeriksa mungkin dengan alat-alat itu, saya sarankan mencoba dengan nya untuk memastikan dia bekerja seperti yang diharapkan juga.

#### 2.1 MENGINSTAL SECARA MANUAL (UNTUK CLI)

1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh data terkompres nya dan menguraikan isi nya pada mesin komputer lokal Anda. Setelah Anda telah memilih lokasi dari phpMussel, lanjutkan.

2) phpMussel memerlukan PHP untuk diinstall pada mesin host untuk mengeksekusinya. Jika Anda tidak memiliki PHP pada mesin Anda, ikuti instruksi yang di supply oleh installer PHP.

3) Secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), buka `config.ini` (berada di dalam `vault`) - File ini berisikan semua opsi operasional yang tersedia untuk phpMussel. Di atas tiap opsi seharusnya ada komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa. Atur opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk setup tertentu. Simpan file, menutupnya.

4) Secara fakultatif, Anda dapat menggunakan phpMussel di dalam mode CLI untuk diri Anda sendiri dengan menciptakan file batch untuk secara automatis memuat PHP dan phpMussel. Untuk melakukannya, buka sebuah text editor kosong seperti Notepad atau Notepad++, ketikkan jalur dari file `php.exe` di dalam direktori dari instalasi PHP Anda, diikuti spasi, diikuti dengan jalur lengkap dari file `loader.php` di dalam direktori dari instalasi phpMussel, simpan file dengan ekstensi `.bat` di simpan di tempat yang Anda mudah temukan dan klik dua kali pada file itu untuk menjalankan phpMussel di masa yang akan datang.

5) Pada titik ini, Anda selesai! Bagaimanapun Anda seharusnya mencobanya untuk memastikan berjalan dengan lancar. Untuk mencek phpMussel, jalankan phpMussel dan coba memindai `_testfiles` direktori yang disediakan dengan ini paket.

#### 2.2 MENGINSTAL DENGAN COMPOSER

[phpMussel terdaftar dengan Packagist](https://packagist.org/packages/maikuolan/phpmussel). Jika Anda akrab dengan Composer, Anda dapat menggunakan Composer untuk menginstal phpMussel (Anda masih perlu mempersiapkan konfigurasi dan kait meskipun; melihat "menginstal secara manual (untuk server web)" langkah 2 dan 5).

`composer require maikuolan/phpmussel`

---


### 3. <a name="SECTION3"></a>BAGAIMANA CARA MENGGUNAKAN

#### 3.0 BAGAIMANA CARA MENGGUNAKAN (UNTUK SERVER WEB)

phpMussel harus mampu beroperasi benar dengan persyaratan minimal darimu: Setelah instalasi, harus bekerja segera dan harus berguna segera.

Memindai upload file secara automatis dan di mungkinkan secara default, jadi tidak ada yang diharuskan pada Anda untuk fungsi ini.

Bagaimanapun, Anda juga bisa menginstruksikan phpMussel untuk memindai file, direktori dan/atau arsip spesifik. Untuk melakukannya, pertama-tama Anda harus memastikan konfigurasi yang cocok diset di file `config.ini` (`cleanup` harus dinonaktifkan) dan ketika selesai, di sebuah file PHP yang di hubungkan ke phpMussel, gunakan fungsi berikut pada kode Anda:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` dapat berupa string, array, atau array mengandung array-array, mengindikasikan apa file, file-file, direktori dan/atau direktori-direktori untuk memindai.
- `$output_type` adalah boolean, mengindikasikan format untuk hasil pemindaian untuk dikembalikan sebagai. False/Palsu menginstruksikan fungsi untuk mengembalikan hasil sebagai integer (sebuah hasil dari -3 mengindikasikan masalah adalah ditemui dengan file tanda tangan phpMussel atau file memetakan tanda tangan dan mereka mungkin hilang atau rusak, -2 mengindikasikan bahwa file dikorup terdeteksi selama proses memindai dan proses memindai gagal selesai, -1 mengindikasikan bawa ekstensi atau addon yang dibutuhkan oleh PHP untuk mengeksekusi pemindaian hilang dan demikian gagal selesai, 0 mengindikasikan bahwa pemindaian target tidak ada dan tidak ada yang dipindai 1 mengindikasikan bahwa target sukses dipindai dan tidak ada masalah terdeteksi, dan 2 mengindikasikan target sukses di scan namun ada masalah terdeteksi). True/Benar menginstruksikan fungsi untuk mengembalikan hasil sebagai teks yang dapat dibaca manusia. Tambahan, dalam kedua kasus, hasilnya dapat diakses melalui variabel global setelah memindai selesai. Variabel ini adalah opsional, default untuk false/palsu.
- `$output_flatness` adalah boolean, mengindikasikan ke fungsi apakah akan mengembalikan hasil pemindaian (ketika ada beberapa target pemindaian) sebagai array atau string. False/Palsu akan mengembalikan hasil sebagai array. True/Benar akan mengembalikan hasil sebagai string. Variabel ini adalah opsional, default untuk false/palsu.

Contoh:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Menghasilkan seperti ini (sebagai kata-kata):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Dimulai.
 > Memeriksa '/user_name/public_html/my_file.html':
 -> Tidak ada masalah yang diketahui.
 Wed, 16 Sep 2013 02:49:47 +0000 Selesai.
```

Untuk sebuah pemecahan penuh dari jenis tanda tangan phpMussel yang digunakan selama pemindaian dan bagaimana dia memegang tanda tangan-tanda tangan ini, mencocokkan ke format tanda tangan dari file README.

Jika Anda menjumpai bilangan positif yang salah, jika Anda menemukan hal baru yang harus di blok atau untuk apapun dalam tanda tangan mohon hubungi saya mengenainya sehingga saya dapat membuat perubahan yang perlu, dimana, jika Anda tidak menghubungi saya saya tidak tahu.

Untuk menonaktifkan tanda tangan-tanda tangan yang dimasukkan dalam phpMussel (seperti jika Anda berpengalaman sebuah angka positif yang salah untuk tujuan Anda yang seharusnya secara normal di hapus dari aliran), mencocokkan ke catatan berwarna abu-abu di dalam MANAJEMEN BAGIAN DEPAN dari file README.

#### 3.1 BAGAIMANA CARA MENGGUNAKAN (UNTUK CLI)

Mohon merujuk pada seksi "MENGINSTAL SECARA MANUAL (UNTUK CLI)" dari file README.

Mohon diingat, walaupun versi selanjutnya dari phpMussel seharusnya mendukung sistem yang lain, pada waktu ini, mode pendukung phpMussel CLI hanya di optimisasi untuk sistem berbasis Windows (anda dapat, tentu saja, mencoba pada sistem yang lain, tapi saya tidak dapat menjamin dapat bekerja seperti bagaimana seharusnya).

Mohon diingat bahwa phpMussel adalah scanner *on-demand*; adalah *BUKAN* scanner *on-demand* (dengan pengecualian upload file, pada saat upload), dan tidak seperti anti virus, tidak memonitor memori aktif! phpMussel hanya mendeteksi virus dalam upload file dan dalam file yang Anda perintahkan untuk dipindai.

---


### 4. <a name="SECTION4"></a>MANAJEMEN BAGIAN DEPAN

#### 4.0 APA YANG MANAJEMEN BAGIAN DEPAN.

Manajemen bagian depan menyediakan cara yang nyaman dan mudah untuk mempertahankan, mengelola, dan memperbarui instalasi phpMussel Anda. Anda dapat melihat, berbagi, dan download file log melalui halaman log, Anda dapat mengubah konfigurasi melalui halaman konfigurasi, Anda dapat instal dan uninstal/hapus komponen melalui halaman pembaruan, dan Anda dapat upload, download, dan memodifikasi file dalam vault Anda melalui file manager.

Bagian depan adalah dinonaktifkan secara default untuk mencegah akses yang tidak sah (akses yang tidak sah bisa memiliki konsekuensi yang signifikan untuk website Anda dan keamanannya). Instruksi untuk mengaktifkannya termasuk di bawah paragraf ini.

#### 4.1 BAGAIMANA CARA MENGAKTIFKAN MANAJEMEN BAGIAN DEPAN.

1) Menemukan direktif `disable_frontend` dalam `config.ini`, dan mengaturnya untuk `false` (akan menjadi `true` secara default).

2) Mengakses `loader.php` dari browser Anda (misalnya, `http://localhost/phpmussel/loader.php`).

3) Masuk dengan nama pengguna dan kata sandi default (admin/password).

Catat: Setelah Anda dimasukkan untuk pertama kalinya, untuk mencegah akses tidak sah ke manajemen bagian depan, Anda harus segera mengubah nama pengguna dan kata sandi Anda! Ini sangat penting, karena itu mungkin untuk meng-upload kode PHP sewenang-wenang untuk situs web Anda melalui bagian depan.

#### 4.2 BAGAIMANA CARA MENGGUNAKAN MANAJEMEN BAGIAN DEPAN.

Instruksi disediakan pada setiap halaman dari manajemen bagian depan, untuk menjelaskan cara yang benar untuk menggunakannya dan tujuan yang telah ditetapkan. Jika Anda membutuhkan penjelasan lebih lanjut atau bantuan khusus, silahkan hubungi dukungan, atau sebagai pilihan lain, ada beberapa video yang tersedia di YouTube yang dapat membantu dengan cara demonstrasi.


---


### 5. <a name="SECTION5"></a>CLI (COMMAND LINE INTERFACE)

phpMussel dapat dijalankan sebagai sebuah file interaktif pemindai dalam mode CLI dalam Windows. Merujuk ke seksi "BAGAIMANA CARA MENGINSTAL (UNTUK CLI)" dari file README untuk lebih detail.

Untuk daftar yang tersedia CLI perintah, pada prompt CLI, ketik 'c', dan tekan Enter.

Sebagai tambahan, bagi yang berminat, sebuah video tutorial untuk bagaimana menggunakan phpMussel di modus CLI tersedia disini:
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>FILE YANG DIIKUTKAN DALAM PAKET INI

Berikut list dari semua file yang diikutkan di dalam kopi skrip yang dikompres ketika Anda mendownloadnya, setiap file-file yang secara potensial diciptakan sebagai hasil dari menggunakan skrip ini, sejalan dengan deskripsi singkat dari untuk apa file-file ini.

Data | Deskripsi
----|----
/_docs/ | Direktori dokumentasi (berisi bermacam file).
/_docs/readme.ar.md | Dokumentasi Bahasa Arab.
/_docs/readme.de.md | Dokumentasi Bahasa Jerman.
/_docs/readme.en.md | Dokumentasi Bahasa Inggris.
/_docs/readme.es.md | Dokumentasi Bahasa Spanyol.
/_docs/readme.fr.md | Dokumentasi Bahasa Perancis.
/_docs/readme.id.md | Dokumentasi Bahasa Indonesia.
/_docs/readme.it.md | Dokumentasi Bahasa Italia.
/_docs/readme.ja.md | Dokumentasi Bahasa Jepang.
/_docs/readme.ko.md | Dokumentasi Bahasa Korea.
/_docs/readme.nl.md | Dokumentasi Bahasa Belanda.
/_docs/readme.pt.md | Dokumentasi Bahasa Portugis.
/_docs/readme.ru.md | Dokumentasi Bahasa Rusia.
/_docs/readme.ur.md | Dokumentasi Bahasa Urdu.
/_docs/readme.vi.md | Dokumentasi Bahasa Vietnam.
/_docs/readme.zh-TW.md | Dokumentasi Cina tradisional.
/_docs/readme.zh.md | Dokumentasi Cina sederhana.
/_testfiles/ | Direktori file-file test (berisi bermacam file). Semua file-file berisikan di dalamnya adalah file test untuk testing jika phpMussel dengan benar diinstal pada sistem, dan Anda tidak perlu mengupload direktori ini atau file-filenya jika melakukan testing.
/_testfiles/ascii_standard_testfile.txt | File test untuk mentest tanda tangan ASCII dinormalisasi phpMussel.
/_testfiles/coex_testfile.rtf | File test untuk mentest tanda tangan diperpanjang kompleks phpMussel.
/_testfiles/exe_standard_testfile.exe | File test untuk mentest tanda tangan PE phpMussel.
/_testfiles/general_standard_testfile.txt | File test untuk mentest tanda tangan umum phpMussel.
/_testfiles/graphics_standard_testfile.gif | File test untuk mentest tanda tangan grafis phpMussel.
/_testfiles/html_standard_testfile.html | File test untuk mentest tanda tangan HTML dinormalisasi phpMussel.
/_testfiles/md5_testfile.txt | File test untuk mentest tanda tangan MD5 phpMussel.
/_testfiles/ole_testfile.ole | File test untuk mentest tanda tangan OLE phpMussel.
/_testfiles/pdf_standard_testfile.pdf | File test untuk mentest tanda tangan PDF phpMussel.
/_testfiles/pe_sectional_testfile.exe | File test untuk mentest tanda tangan PE Sectional phpMussel.
/_testfiles/swf_standard_testfile.swf | File test untuk mentest tanda tangan SWF phpMussel.
/vault/ | Direktori Vault (berisikan bermacam file).
/vault/cache/ | Direktori Cache (untuk file sementara).
/vault/cache/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/fe_assets/ | Data untuk akses bagian depan.
/vault/fe_assets/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/fe_assets/_accounts.html | Template HTML untuk akses bagian depan halaman akun.
/vault/fe_assets/_accounts_row.html | Template HTML untuk akses bagian depan halaman akun.
/vault/fe_assets/_config.html | Template HTML untuk akses bagian depan halaman konfigurasi.
/vault/fe_assets/_config_row.html | Template HTML untuk akses bagian depan halaman konfigurasi.
/vault/fe_assets/_files.html | Template HTML untuk file manager.
/vault/fe_assets/_files_edit.html | Template HTML untuk file manager.
/vault/fe_assets/_files_rename.html | Template HTML untuk file manager.
/vault/fe_assets/_files_row.html | Template HTML untuk file manager.
/vault/fe_assets/_home.html | Template HTML untuk akses bagian depan halaman utama.
/vault/fe_assets/_login.html | Template HTML untuk akses bagian depan halaman masuk.
/vault/fe_assets/_logs.html | Template HTML untuk akses bagian depan halaman log.
/vault/fe_assets/_nav_complete_access.html | Template HTML untuk akses bagian depan link navigasi, untuk mereka yang memiliki akses lengkap.
/vault/fe_assets/_nav_logs_access_only.html | Template HTML untuk akses bagian depan link navigasi, untuk mereka yang memiliki akses ke log hanya.
/vault/fe_assets/_updates.html | Template HTML untuk akses bagian depan halaman pembaruan.
/vault/fe_assets/_updates_row.html | Template HTML untuk akses bagian depan halaman pembaruan.
/vault/fe_assets/_upload_test.html | Template HTML untuk halaman upload test.
/vault/fe_assets/frontend.css | Style-sheet CSS untuk akses bagian depan.
/vault/fe_assets/frontend.dat | Database untuk akses bagian depan (berisi informasi untuk akun dan sesi; hanya dihasilkan jika akses bagian depan diaktifkan dan digunakan).
/vault/fe_assets/frontend.html | Template HTML utama untuk akses bagian depan.
/vault/fe_assets/icons.php | File ikon (digunakan oleh file manager bagian depan).
/vault/fe_assets/pips.php | File pip (digunakan oleh file manager bagian depan).
/vault/lang/ | Berisikan file bahasa.
/vault/lang/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/lang/lang.ar.fe.php | File Bahasa Arab untuk bagian depan.
/vault/lang/lang.ar.php | File Bahasa Arab.
/vault/lang/lang.de.fe.php | File Bahasa Jerman untuk bagian depan.
/vault/lang/lang.de.php | File Bahasa Jerman.
/vault/lang/lang.en.fe.php | File Bahasa Inggris untuk bagian depan.
/vault/lang/lang.en.php | File Bahasa Inggris.
/vault/lang/lang.es.fe.php | File Bahasa Spanyol untuk bagian depan.
/vault/lang/lang.es.php | File Bahasa Spanyol.
/vault/lang/lang.fr.fe.php | File Bahasa Perancis untuk bagian depan.
/vault/lang/lang.fr.php | File Bahasa Perancis.
/vault/lang/lang.id.fe.php | File Bahasa Indonesia untuk bagian depan.
/vault/lang/lang.id.php | File Bahasa Indonesia.
/vault/lang/lang.it.fe.php | File Bahasa Italia untuk bagian depan.
/vault/lang/lang.it.php | File Bahasa Italia.
/vault/lang/lang.ja.fe.php | File Bahasa Jepang untuk bagian depan.
/vault/lang/lang.ja.php | File Bahasa Jepang.
/vault/lang/lang.ko.fe.php | File Bahasa Korea untuk bagian depan.
/vault/lang/lang.ko.php | File Bahasa Korea.
/vault/lang/lang.nl.fe.php | File Bahasa Belanda untuk bagian depan.
/vault/lang/lang.nl.php | File Bahasa Belanda.
/vault/lang/lang.pt.fe.php | File Bahasa Portugis untuk bagian depan.
/vault/lang/lang.pt.php | File Bahasa Portugis.
/vault/lang/lang.ru.fe.php | File Bahasa Rusia untuk bagian depan.
/vault/lang/lang.ru.php | File Bahasa Rusia.
/vault/lang/lang.th.fe.php | File Bahasa Thailand untuk bagian depan.
/vault/lang/lang.th.php | File Bahasa Thailand.
/vault/lang/lang.ur.fe.php | File Bahasa Urdu untuk bagian depan.
/vault/lang/lang.ur.php | File Bahasa Urdu.
/vault/lang/lang.vi.fe.php | File Bahasa Vietnam untuk bagian depan.
/vault/lang/lang.vi.php | File Bahasa Vietnam.
/vault/lang/lang.zh-tw.fe.php | File Bahasa Cina tradisional untuk bagian depan.
/vault/lang/lang.zh-tw.php | File Bahasa Cina tradisional.
/vault/lang/lang.zh.fe.php | File Bahasa Cina sederhana untuk bagian depan.
/vault/lang/lang.zh.php | File Bahasa Cina sederhana.
/vault/quarantine/ | Direktori karantina (berisikan file yang dikarantina).
/vault/quarantine/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/signatures/ | Direktori tanda tangan (berisikan file tanda tangan).
/vault/signatures/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/signatures/switch.dat | Kontrol dan set variabel tertentu.
/vault/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/cli.php | Modul CLI handler.
/vault/components.dat | Berisi informasi yang berkaitan dengan berbagai komponen untuk phpMussel; Digunakan oleh fitur pembaruan disediakan oleh akses bagian depan.
/vault/config.ini.RenameMe | File konfigurasi phpMussel; Berisi semua opsi konfigurasi dari phpMussel, memberitahukannya apa yang harus dilakukan dan bagaimana mengoperasikannya dengan benar (mengubah nama untuk mengaktifkan).
/vault/config.php | Modul konfigurasi.
/vault/config.yaml | File default konfigurasi; Berisi nilai konfigurasi default untuk phpMussel.
/vault/frontend.php | Modul untuk akses bagian depan.
/vault/functions.php | Modul fungsi (utama).
/vault/greylist.csv | CSV terdiri dari tanda tangan daftar abu-abu mengindikasikan phpMussel tanda tangan mana yang harus diabaikan (file automatis diciptakan kembali jika dihapus).
/vault/lang.php | File bahasa.
/vault/php5.4.x.php | Polyfill untuk PHP 5.4.X (diperlukan untuk kompatibilitas mundur PHP 5.4.X; aman untuk menghapus selama versi PHP yang lebih baru).
※ /vault/scan_kills.txt | Sebuah catatan dari setiap file upload yang diblok/dibunuh oleh phpMussel.
※ /vault/scan_log.txt | Sebuah catatan dari apapun yang di pemindaian oleh phpMussel.
※ /vault/scan_log_serialized.txt | Sebuah catatan dari apapun yang di pemindaian oleh phpMussel.
/vault/template_custom.html | File template phpMussel; Template untuk output HTML yang diproduksi oleh phpMussel untuk file pesan upload yang dibloknya (pesan dilihat oleh pengupload).
/vault/template_default.html | File template phpMussel; Template untuk output HTML yang diproduksi oleh phpMussel untuk file pesan upload yang dibloknya (pesan dilihat oleh pengupload).
/vault/themes.dat | File tema; Digunakan oleh fitur pembaruan disediakan oleh akses bagian depan.
/vault/upload.php | Modul upload.
/.gitattributes | Sebuah file proyek GitHub (tidak dibutuhkan untuk fungsi teratur dari skrip).
/Changelog-v1.txt | Sebuah rekaman dari perubahan yang dibuat pada skrip ini di antara perbedaan versi (tidak dibutuhkan untuk fungsi teratur dari skrip).
/composer.json | Informasi untuk Composer/Packagist (tidak dibutuhkan untuk fungsi teratur dari skrip).
/CONTRIBUTING.md | Informasi tentang cara berkontribusi pada proyek.
/LICENSE.txt | Salinan lisensi GNU/GPLv2 (tidak dibutuhkan untuk fungsi teratur dari skrip).
/loader.php | Pemuat/Loader. Ini yang apa Anda ingin masukkan (utama)!
/PEOPLE.md | Informasi tentang orang-orang yang terlibat dalam proyek.
/README.md | Ringkasan informasi proyek.
/web.config | Sebuah file konfigurasi ASP.NET (dalam instansi ini, untuk melindungi direktori `/vault` dari pengaksesan oleh sumber-sumber tidak terauthorisasi dalam kejadian yang mana skrip ini diinstal pada server berbasis teknologi ASP.NET).

※ Nama file bisa berbeda berdasarkan ketentuan konfigurasi (di dalam `config.ini`).

---


### 7. <a name="SECTION7"></a>OPSI KONFIGURASI
Berikut list variabel yang ditemukan pada file konfigurasi phpMussel `config.ini`, dengan deskripsi dari tujuan dan fungsi.

#### "general" (Kategori)
Konfigurasi umum dari phpMussel.

"cleanup"
- Membersihkan variabel skrip dan cache setelah eksekusi? False = Tidak; True = Ya [Default]. Jika Anda tidak menggukan skrip di bawah pemindaian upload inisial, harus diset ke `true` (ya) untuk meminimalisasi penggunaan memori. Jika Anda menggunakan skrip untuk tujuan di bawah pemindaian upload inisial, harus diset ke `false` (tidak), untuk menghindari reload duplikat file ke memori. Dalam praktek umum, haru diset ke `true`, tapi jika kamu melakukannya, kamu tidak bisa menggunakan skrip untuk hal lain kecuali pemindaian upload file.
- Tidak memiliki pengaruh di dalam mode CLI.

"scan_log"
- Nama dari file untuk mencatat semua hasil pemindaian. Spesifikasikan nama atau biarkan kosong untuk menonaktifkan.

"scan_log_serialized"
- Nama dari file untuk mencatat semua hasil pemindaian (menggunakan format serial). Spesifikasikan nama atau biarkan kosong untuk menonaktifkan.

"scan_kills"
- Nama dari fata untuk mencatat semua rekord dari upload terblok atau terbunuh. Spesifikan nama atau biarkan kosong untuk menonaktifkan.

*Tip berguna: Jika Anda mau, Anda dapat menambahkan informasi tanggal/waktu untuk nama-nama file log Anda oleh termasuk ini dalam nama: `{yyyy}` untuk tahun lengkap, `{yy}` untuk tahun disingkat, `{mm}` untuk bulan, `{dd}` untuk hari, `{hh}` untuk jam.*

*Contoh:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Memotong file log ketika mereka mencapai ukuran tertentu? Nilai adalah ukuran maksimum dalam B/KB/MB/GB/TB yang bisa ditambahkan untuk file log sebelum dipotong. Nilai default 0KB menonaktifkan pemotongan (file log dapat tumbuh tanpa batas waktu). Catatan: Berlaku untuk file log individu! Ukuran file log tidak dianggap secara kolektif.

"timeOffset"
- Jika waktu server Anda tidak cocok waktu lokal Anda, Anda dapat menentukan offset sini untuk menyesuaikan informasi tanggal/waktu dihasilkan oleh phpMussel sesuai dengan kebutuhan Anda. Ini umumnya direkomendasikan sebagai gantinya untuk menyesuaikan direktif zona waktu dalam file `php.ini` Anda, tapi terkadang (seperti ketika bekerja dengan terbatas penyedia shared hosting) ini tidak selalu mungkin untuk melakukan, dan demikian, opsi ini disediakan disini. Offset adalah dalam menit.
- Contoh (untuk menambahkan satu jam): `timeOffset=60`

"timeFormat"
- Format notasi tanggal/waktu yang digunakan oleh phpMussel. Default = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Dimana menemukan alamat IP dari permintaan alamat? (Bergunak untuk pelayanan-pelayanan seperti Cloudflare dan sejenisnya). Default = REMOTE_ADDR. PERINGATAN: Jangan ganti ini kecuali Anda tahu apa yang Anda lakukan!

"enable_plugins"
- Mengaktifkan dukungan untuk plugin phpMussel? False = Tidak; True = Ya [Default].

"forbid_on_block"
- Seharusnya phpMussel mengirimkan 403 headers dengan pesan upload file yang terblok, atau cocok dengan 200 OK? False = Tidak (200); True = Ya (403) [Default].

"delete_on_sight"
- Mengaktifkan opsi ini akan menginstruksikan skrip untuk berusaha secepatnya menghapus file apapun yang ditemukannya selama scan yang mencocokkan pada kriteria deteksi apapun, baik melalui tanda tangan atau yang lain. file-file ditentukan "clean" tidak akan disentuh. Pada kasus file terkompress seluruh file terkompress akan didelate (kecuali file yang menyerang adalah satu-satunya dari beberapa file yang menjadi isi file terkompress). Untuk kasus pemindaian upload file biasanya, tidak cocok untuk mengaktifkan opsi ini, karena biasanya PHP akan secara otomatis menyatukan isi dari cache ketika eksekusi selesai, berarti bahwa dia akan selalu menghapus file terupload apapun melalui server jika tidak dipindahkan, dikopi atau dihapus sebelumnya. Opsi tersebut ditambahkan disini sebagai ukuran keamanan ekstra untuk semua salinan PHP yang tidak selalu bersikap pada perilaku yang diharapkan. False = Setelah pemindahaian, biarkan file [Default]; True = Setelah pemindaian, jika tidak bersih, hapus langsung.

"lang"
- Tentukan bahasa default untuk phpMussel.

"quarantine_key"
- phpMussel dapat mengkarantina upload file ditandai dalam isolasi dalam vault phpMussel, jika ini adalah sesuatu yang Anda ingin lakukan. Pengguna biasa dari phpMussel yang hanya ingin memproteksi website mereka dan/atau lingkungan hosting mereka tanpa memiliki minat dalam-dalam menganalisis setiap ditandai upload file harus meninggalkan fungsi ini dinonaktifkan, tapi setiap pengguna yang tertarik pada analisis lebih lanjut dari ditandai upload file bagi penelitian malware atau untuk hal-hal seperti serupa harus mengaktifkan fungsi ini. Mengkarantina ditandai upload file dapat kadang-kadang juga membantu dalam men-debug false-positif, jika ini adalah sesuatu yang sering terjadi untuk Anda. Untuk menonaktifkan fungsi karantina, meninggalkan `quarantine_key` direktif kosong, atau menghapus isi dari direktif ini jika tidak sudah kosong. Untuk mengaktifkan fungsi karantina, masukkan beberapa nilai dalam direktif ini. `quarantine_key` adalah fitur keamanan penting dari fungsi karantina diharuskan sebagai sarana untuk mencegah fungsi karantina dari dieksploitasi oleh penyerang potensial dan sebagai sarana mencegah eksekusi potensi file yang disimpan dalam karantina. `quarantine_key` harus diperlakukan dengan cara yang sama seperti password Anda: Semakin lama semakin baik, dan menjaganya diproteksi erat. Bagi efek terbaik, gunakan dalam hubungannya dengan `delete_on_sight`.

"quarantine_max_filesize"
- Ukuran file maksimum yang diijinkan dari file yang akan dikarantina. File yang lebih besar dari nilai yang ditentukan di bawah ini TIDAK akan dikarantina. Direktif ini penting sebagai sarana untuk membuat lebih sulit bagi setiap penyerang potensial untuk banjir karantina Anda dengan file yang tidak diinginkan berpotensi menyebabkan penggunaan file kelebihan pada layanan hosting Anda. Default = 2MB.

"quarantine_max_usage"
- Penggunaan memori maksimal yang diijinkan untuk karantina. Jika total penggunaan memori oleh karantina mencapai nilai ini, file yang dikarantina tertua akan dihapus sampai total penggunaan memori tidak lagi mencapai nilai ini. Direktif ini penting sebagai sarana untuk membuat lebih sulit bagi setiap penyerang potensial untuk banjir karantina Anda dengan file yang tidak diinginkan berpotensi menyebabkan penggunaan file kelebihan pada layanan hosting Anda. Default = 64MB.

"honeypot_mode"
- Bila modus honeypot diaktifkan, phpMussel akan mencoba untuk karantina setiap file upload yang dia menemui, terlepas dari apakah atau tidak file yang di-upload cocok dengan tanda tangan yang disertakan, dan tidak ada pemindaian aktual atau analisis dari upload file akan terjadi. Fungsi ini akan berguna bagi mereka yang ingin menggunakan phpMussel untuk tujuan virus/malware penelitian, tapi tidak direkomendasikan untuk mengaktifkan fungsi ini jika tujuan penggunaan dari phpMussel oleh pengguna adalah bagi aktual upload file pemindaian dan juga tidak direkomendasikan untuk menggunakan fungsi honeypot untuk tujuan selain bagi honeypot. Biasanya, opsi ini dinonaktifkan. False = Dinonaktifkan [Default]; True = Diaktifkan.

"scan_cache_expiry"
- Untuk berapa lama harus phpMussel cache hasil-hasil? Nilai adalah jumlah detik untuk cache hasil-hasil untuk. Default adalah 21600 detik (6 jam); Nilai 0 akan menonaktifkan caching hasil-hasil.

"disable_cli"
- Menonaktifkan modus CLI? Modus CLI diaktifkan secara default, tapi kadang-kadang dapat mengganggu alat pengujian tertentu (seperti PHPUnit, sebagai contoh) dan aplikasi CLI berbasis lainnya. Jika Anda tidak perlu menonaktifkan modus CLI, Anda harus mengabaikan direktif ini. False = Mengaktifkan modus CLI [Default]; True = Menonaktifkan modus CLI.

"disable_frontend"
- Menonaktifkan akses bagian depan? Akses bagian depan dapat membuat phpMussel lebih mudah dikelola, tapi juga dapat menjadi potensial resiko keamanan. Itu direkomendasi untuk mengelola phpMussel melalui bagian belakang bila mungkin, tapi akses bagian depan yang disediakan untuk saat itu tidak mungkin. Memilikinya dinonaktifkan kecuali jika Anda membutuhkannya. False = Mengaktifkan akses bagian depan; True = Menonaktifkan akses bagian depan [Default].

"max_login_attempts"
- Jumlah maksimum upaya untuk memasukkan (bagian depan). Default = 5.

"FrontEndLog"
- File untuk mencatat upaya login untuk bagian depan. Spesifikasikan nama file, atau biarkan kosong untuk menonaktifkan.

"disable_webfonts"
- Menonaktifkan webfonts? True = Ya; False = Tidak [Default].

#### "signatures" (Kategori)
Konfigurasi untuk tanda tangan.

"Active"
- Daftar file tanda tangan yang aktif, dipisahkan oleh koma.

"fail_silently"
- Seharusnya laporan phpMussel ketika file tanda tangan hilang atau dikorup? Jika `fail_silently` dinonaktifkan, file dikorup dan hilang akan dilaporkan ketika pemindaian, dan jika `fail_silently` diaktifkan, file dikorup dan hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini bahwa tidak ada masalah. Harus ini dibiarkan sendirian jika Anda pernah mengalami crash atau masalah lain. False = Dinonaktifkan; True = Diaktifkan [Default].

"fail_extensions_silently"
- Seharusnya laporan phpMussel ketika ekstensi hilang? Jika `fail_extensions_silently` dinonaktifkan, ekstensi hilang akan dilaporkan ketika pemindaian, dan jika `fail_extensions_silently` diaktifkan, ekstensi hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini bahwa tidak ada masalah. Menonaktifkan direktif ini berpotensi dapat meningkatkan keamanan Anda, tapi juga dapat menyebabkan peningkatan positif palsu. False = Dinonaktifkan; True = Diaktifkan [Default].

"detect_adware"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi adware? False = Tidak; True = Ya [Default].

"detect_joke_hoax"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi lelucon/kebohongan malware/virus? False = Tidak; True = Ya [Default].

"detect_pua_pup"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi PUAs/PUPs? False = Tidak; True = Ya [Default].

"detect_packer_packed"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi pengepakan dan file dikemas? False = Tidak; True = Ya [Default].

"detect_shell"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi skrip shell? False = Tidak; True = Ya [Default].

"detect_deface"
- Harus phpMussel menggunakan tanda tangan untuk mendeteksi perusakan dan perusak? False = Tidak; True = Ya [Default].

#### "files" (Kategori)
Konfigurasi umum untuk mengambil alih file-file.

"max_uploads"
- Maksimum jumla file-file yang diizinkan untuk dipindai selama pemindaian upload file sebelum menghentikan pemindaian dan menginformasikan pengguna bahwa pengguna mengupload terlalu banyak! Menyediakan perlindungan pada serangan teoritis dimana penyerang mencoba DDoS pada sistem Anda atau CMS ada dengan overloading phpMussel supaya berjalan lambat. Proses PHP ke penghentian keras. Recommendasi: 10. Anda dapat menaikkan atau menurunkan angka ini bergantung dari kecepatan hardware Anda. Catat itu nomor ini tidak mengakuntabilitas atau mengikutkan konten dari file terkompres.

"filesize_limit"
- Batasan ukuran file dalam KB. 65536 = 64MB [Default]; 0 = Tidak ada batasa (selalu bertanda abu-abu), nilai angka positif apapun diterima. Ini dapat berguna ketika batasan konfigurasi PHP Anda membatasi jumah memori dari proses yang dapat ditampungnya atau jika konfigurasi PHP Anda membatasi jumlah ukuran upload Anda.

"filesize_response"
- Apa yang Anda lakukan dengan file-file yang melebihi batasan ukuran (jika ada). False = Bertanda putih; True = Bertanda hitam [Default].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Jika sistem Anda hanya mengizinkan tipe file spesifik menjadi diupload, atau jika sistem Anda secara eksplisit menolak tipe file-file tertentu, menspesifikasikan tipe file dalam bertanda putih, bertanda hitam dan bertanda abu-abu dapat menaikkan kecepatan dari pemindaian dilakukan dengan mengizinkan skrip untuk mengabaikan tipe file tertentu. Format adalah CSV (comma separated values). Jika Anda ingin memindai semuanya, daripada daftar putih, daftar hitam atau daftar abu-abu, tinggalkan variabel kosong; Melakukannya akan menonaktifkan dafter putih/hitam/abu-abu.
- Urutan logis dari pengolahan:
  - Jika tipe file bertanda putih, tidak memindai dan tidak memblokir file, dan tidak memeriksa file terhadap daftar hitam atau daftar abu-abu.
  - Jika tipe file bertanda hitem, tidak memindai file tapi memblokir bagaimanapun, dan tidak memeriksa file terhadap daftar abu-abu.
  - Jika daftar abu-abu yang kosong atau jika daftar abu-abu tidak kosong dan tipe file bertanda abu-abu, memindai file seperti biasa dan menentukan apakah untuk memblokir berdasarkan hasil memindai, tapi jika daftar abu-abu tidak kosong dan tipe file tidak bertanda abu-abu, memperlakukan seolah olah bertanda hitam, demikian tidak memindai tapi memblokir itu bagaimanapun.

"check_archives"
- Berusaha mencek isi file terkompress? False = Tidak (Tidak mencek); True = Ya (Mencek) [Default].
- Sekarang, hanya BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR dan ZIP format yang didukung (RAR, CAB, 7z, dll tidak didukung).
- Ini tidak selalu sempurna! Selama saya sangat rekomendasikan menjaga ini aktif, saya tidak dapat menjamin itu hanya menemukan segala sesuatunya.
- Juga diingatkan bahwa mencek file terkompres tidak rekursif untuk format PHAR atau ZIP.

"filesize_archives"
- Memperlalaikan ukuran daftar hitam/putih dari isi file terkompress? False = Tidak (Bertanda abu-abu semua); True = Ya [Default].

"filetype_archives"
- Memperlalaikan jenis file daftar hitam/putih dari isi file terkompress? False = Tidak (Bertanda abu-abu semua) [Default]; True = Ya.

"max_recursion"
- Batas kedalaman rekursi maksimum untuk arsip. Default = 10.

"block_encrypted_archives"
- Mendeteksi dan memblokir dienkripsi arsip? Karena phpMussel tidak mampu memindai isi arsip dienkripsi, itu mungkin bahwa enkripsi arsip dapat digunakan oleh penyerang sebagai sarana mencoba untuk memotong phpMussel, anti-virus pemindai dan perlindungan mirip lainnya. Menginstruksikan phpMussel untuk memblokir setiap arsip dienkripsi ditemukan akan berpotensi membantu mengurangi risiko terkait dengan kemungkinan tersebut. False = Tidak; True = Ya [Default].

#### "attack_specific" (Kategori)
Direktif serangan spesifik.

Chameleon serangan deteksi: False = Dinonaktifkan; True = Diaktifkan.

"chameleon_from_php"
- Cari header PHP tidak di dalam file-file PHP atau file terkompress.

"chameleon_from_exe"
- Cari header yang dapat dieksekusi di dalam file-file yang dapat dieksekusi atau file terkompress yang dikenali dan untuk file dapat dieksekusi yang headernya tidak benar.

"chameleon_to_archive"
- Cari file terkompress yang header nya tidak benar (Mendukung: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Cari dokumen office yang header nya tidak benar (Mendukung: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Cari gambar yang header nya tidak benar (Mendukung: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Cari file PDF yang headernya tidak benar.

"archive_file_extensions"
- Ekstensi file terkompres yang dikenali (format nya CSV; seharusnya hanya menambah atau menghapus ketika masalah terjadi; Tidak cocok langsung menghapus karena dapat menyebabkan angka positif yang salah terjadi pada file terkompres, dimana juga menambahkan deteksi; memodifikasi dengan peringatan; Juga dicatat bahwa ini tidak memberi efek pada file terkompress apa yang dapat dan tidak dapat di analisa pada level isi). Daftar sebagaimana defaultnya, memberi daftar format-format yang digunakan yang paling umum melalui melalui mayoritas sistem dan CMS, tapi bermaksud tidak komprehensif.

"block_control_characters"
- Memblokade file apapun yang berisi karakter pengendali (lain dari baris baru)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Jika Anda hanya sedang mengupload file teks biasa, maka Anda dapat menghidupkan opsi ini untuk menyediakan perlindungan tambahan ke sistem Anda. Bagaimanapun jika Anda mengupload apapun lebih dari file teks biasa, menghidupkan opsi ini mungkin mengakibatkan angka positif salah. False = Jangan memblokade [Default]; True = Memblokade.

"corrupted_exe"
- File korup dan diurai kesalahan. False = Mengabaikan; True = Memblokade [Default]. Mendeteksi dan memblokir berpotensi korup PE (Portable Executable) file? Sering (tapi tidak selalu), ketika aspek-aspek tertentu dari file PE yang korup atau tidak bisa diurai dengan benar, itu dapat menjadi indikasi dari infeksi virus. Proses yang digunakan oleh sebagian besar program anti-virus untuk mendeteksi virus dalam file PE memerlukan parsing file-file dengan cara tertentu, yang, jika programmer virus menyadari, secara khusus akan mencoba untuk mencegah, untuk memungkinkan virus mereka untuk tetap tidak terdeteksi.

"decode_threshold"
- Ambang batas dengan panjang file mentah yang dalam decode perintah harus terdeteksi (dalam kasus ada masalah kinerja sementara pemindaian). Default = 512KB. Nol atau nilai null menonaktifkan ambang batas (menghapus apapun batasan berdasarkan ukuran file).

"scannable_threshold"
- Ambang batas dengan panjang file mentah yang phpMussel diperbolehkan untuk membaca dan memindai (dalam kasus ada masalah kinerja sementara pemindaian). Default = 32MB. Nol atau nilai null menonaktifkan ambang batas. Umumnya, nilai ini tidak seharusnya kurang dari ukuran file rata-rata upload file yang Anda inginkan dan Anda harapkan untuk menerima ke server atau website, tidak seharusnya lebih dari direktif filesize_limit, dan tidak seharusnya lebih dari sekitar seperlima dari total alokasi memori yang diijinkan ke PHP melalui file konfigurasi `php.ini`. Direktif ini ada untuk mencegah phpMussel menggunakan terlalu banyak memori (yang bisa mencegah dari yang berhasil memindai file di atas tertentu ukuran file).

#### "compatibility" (Kategori)
Direktif-direktif kompatibilitas pada phpMussel.

"ignore_upload_errors"
- Direktif ini umumnya harus DINONAKTIFKAN kecuali diharuskan untuk fungsi yang benar dari phpMussel pada sistem tertentu. Biasanya, ketika DINONAKTIFKAN, ketika phpMussel mendeteksi adanya elemen dalam `$_FILES` array(), itu akan mencoba untuk memulai scan file yang mewakili elemen, dan, jika elemen yang kosong, phpMussel akan mengembalikan pesan kesalahan. Ini adalah perilaku yang tepat untuk phpMussel. Namun, untuk beberapa CMS, elemen kosong di `$_FILES` dapat terjadi sebagai akibat dari perilaku alami itu CMS, atau kesalahan dapat dilaporkan bila tidak ada, dalam kasus seperti itu, perilaku normal untuk phpMussel akan mengganggu untuk perilaku normal itu CMS. Jika situasi seperti itu terjadi untuk Anda, MENGAKTIFKAN direktif ini akan menginstruksikan phpMussel untuk tidak mencoba untuk memulai scan untuk elemen kosong, mengabaikan saat ditemui dan untuk tidak kembali terkait pesan kesalahan, sehingga memungkinkan kelanjutan dari halaman permintaan. False = DINONAKTIFKAN; True = DIAKTIFKAN.

"only_allow_images"
- Jika Anda hanya mengharapkan atau hanya berniat untuk memungkinkan mengupload gambar ke sistem atau CMS, dan jika Anda benar-benar tidak memerlukan mengupload file selain gambar ke sistem atau CMS, direktif ini harus DIAKTIFKAN, tapi sebaliknya harus DINONAKTIFKAN. Jika direktif ini DIAKTIFKAN, ini akan menginstruksikan phpMussel untuk memblokir tanpa pandang bulu setiap upload diidentifikasi sebagai file tidak gambar, tanpa pemindaian mereka. Ini mungkin mengurangi waktu memproses dan penggunaan memori untuk mencoba upload file tidak gambar. False = DINONAKTIFKAN; True = DIAKTIFKAN.

#### "heuristic" (Kategori)
Direktif-direktif heuristik pada phpMussel.

"threshold"
- Ada tanda tangan tertentu dari phpMussel yang dimaksudkan untuk mengidentifikasi kualitas yang mencurigakan dan berpotensi berbahaya pada file-file yang di-upload tanpa di diri mereka mengidentifikasi file-file yang di-upload spesifik sebagai berbahaya. Ini "threshold" nilai memberitahu phpMussel apa total berat maksimum untuk kualitas yang mencurigakan dan berpotensi berbahaya pada file-file yang di-upload yang diijinkan adalah sebelum file-file yang akan diidentifikasi sebagai berbahaya. Definisi berat dalam konteks ini adalah jumlah total kualitas mencurigakan dan berpotensi berbahaya diidentifikasi. Secara default, nilai ini akan ditetapkan sebagai 3. Sebuah nilai lebih rendah umumnya akan menghasilkan sebagai lebih tinggi positif palsu kejadian tapi sebuah jumlah lebih tinggi file berbahaya diidentifikasi, sedangkan sebuah nilai lebih tinggi umumnya akan menghasilkan sebagai lebih rendah positif palsu kejadian tapi sebuah jumlah lebih rendah pada file berbahaya yang diidentifikasi. Ini umumnya terbaik untuk meninggalkan nilai ini di default kecuali jika Anda mengalami masalah berhubungan dengan itu.

#### "virustotal" (Kategori)
Konfigurasi untuk Virus Total integrasi.

"vt_public_api_key"
- Secara fakultatif, phpMussel mampu memindai file menggunakan Virus Total API sebagai cara untuk memberikan tingkat sangat ditingkatkan perlindungan terhadap virus, trojan, malware dan ancaman lainnya. Secara default, file pemindaian menggunakan Virus Total API dinonaktifkan. Untuk mengaktifkannya, kunci API dari Virus Total diperlukan. Karena manfaat yang signifikan bahwa ini bisa memberikan kepada Anda, itu adalah sesuatu yang sangat direkomendasi mengaktifkan. Perlu diketahui, bagaimanapun, menggunakan Virus Total API, Anda _**HARUS**_ setuju untuk Terms of Service dan Anda _**HARUS**_ mematuhi semua pedoman terkait dijelaskan oleh Virus Total dokumentasi! Anda TIDAK diizinkan untuk menggunakan fungsi ini KECUALI KALAU:
  - Anda membaca dan setuju untuk Terms of Service dari Virus Total dan API mereka. Terms of Service dari Virus Total dan API mereka dapat ditemukan di [Sini](https://www.virustotal.com/en/about/terms-of-service/).
  - Anda membaca dan memahami, setidaknya, mukadimah dari Virus Total dokumentasi API (semuanya setelah "VirusTotal Public API v2.0" tapi sebelum "Contents"). Virus Total dokumentasi API umum dapat ditemukan di [Sini](https://www.virustotal.com/en/documentation/public-api/).

Mencatat: Jika memindai file menggunakan Virus Total API dinonaktifkan, Anda tidak akan perlu meninjau salah di direktif-direktif dalam kategori ini (`virustotal`), karena tidak satupun dari mereka akan melakukan apapun jika ini dinonaktifkan. Untuk memperoleh Virus Total kunci API, dari dimanapun di website mereka, mengklik atas "Join our Community" link yang terletak ke arah kanan atas dari halaman, memasukkan informasi yang diminta, dan mengklik "Sign up" ketika dilakukan. Ikuti semua instruksi yang diberikan, dan ketika Anda punya kunci API umum Anda, menyalin/menempelkan bahwa kunci API umum untuk `vt_public_api_key` direktif dari `config.ini` file konfigurasi.

"vt_suspicion_level"
- Secara default, phpMussel akan membatasi file dipindai menggunakan Virus Total API untuk file-file yang dianggap "mencurigakan". Anda dapat menyesuaikan pembatasan ini dengan mengubah nilai direktif `vt_suspicion_level`.
- `0`: File hanya dianggap mencurigakan jika, setelah dipindai oleh phpMussel menggunakan tanda tangan sendiri, mereka dianggap membawa berat heuristik. Ini akan efektif berarti bahwa penggunaan Virus Total API akan untuk pendapat kedua ketika phpMussel mencurigai bahwa file berpotensi menjadi berbahaya, tapi tidak dapat sepenuhnya mengesampingkan bahwa hal itu juga berpotensi menjadi jinak (atau tidak berbahaya) dan demikian akan dinyatakan biasanya tidak memblokir atau mengindikasi itu sebagai berbahaya.
- `1`: File dianggap mencurigakan jika, setelah dipindai oleh phpMussel menggunakan tanda tangan sendiri, mereka dianggap membawa berat heuristik, jika mereka diketahui executable (PE file, Mach-O file, ELF/Linux file, dll), atau jika mereka diketahui dari format yang berpotensi berisi file executable (seperti macro executable, DOC/DOCX file, arsip file seperti RAR, ZIP dan dll). Ini adalah default dan direkomendasikan tingkat kecurigaan untuk menerapkan, efektif berarti bahwa penggunaan Virus Total API akan untuk pendapat kedua ketika phpMussel tidak awalnya mendeteksi sesuatu yang berbahaya atau yang salah dengan file yang dianggap mencurigakan dan demikian akan dinyatakan biasanya tidak memblokir atau mengindikasi itu sebagai berbahaya.
- `2`: Semua file dianggap mencurigakan dan harus dipindai menggunakan Virus Total API. Saya biasanya tidak merekomendasikan menerapkan tingkat kecurigaan ini, karena risiko mencapai kuota API Anda lebih cepat daripada yang akan terjadi, tapi ada kondisi beberapa (seperti ketika webmaster atau hostmaster memiliki sedikit iman atau kepercayaan apakah gerangan dalam apapun diupload dari pengguna mereka) dimana tingkat kecurigaan ini dapat bisa sesuai. Dengan tingkat kecurigaan ini, semua file biasanya tidak diblokir atau ditandai sebagai berbahaya akan dipindai menggunakan Virus Total API. Mencatat, bagaimanapun, phpMussel akan berhenti menggunakan Virus Total API ketika kuota API Anda telah tercapai (terlepas dari tingkat kecurigaan), dan kuota Anda kemungkinan akan dicapai jauh lebih cepat bila menggunakan tingkat kecurigaan ini.

Mencatat: Terlepas dari tingkat kecurigaan, setiap file yang masuk daftar hitam atau daftar putih oleh phpMussel tidak akan dipindai menggunakan Virus Total API, karena file seperti ini akan sudah dinyatakan sebagai jinak atau berbahaya oleh phpMussel pada saat itu mereka akan sudah dinyatakan telah dipindai oleh Virus Total API, dan demikian, memindai tambahan tidak akan diperlukan. Kemampuan phpMussel untuk memindai file menggunakan Virus Total API dimaksudkan untuk membangun kepercayaan lebih lanjut untuk apakah file yang berbahaya atau jinak pada mereka situasi dimana phpMussel sendiri tidak sepenuhnya yakin apakah file yang berbahaya atau jinak.

"vt_weighting"
- Apakah Anda ingin phpMussel menerapkan hasil pemindaian menggunakan Virus Total API sebagai deteksi atau deteksi pembobotan? Direktif ini ada, karena, meskipun memindai file menggunakan mesin-mesin kelipatan (sebagai Virus Total melakukannya) harus menghasilkan tingkat deteksi meningkat (dan demikian lebih banyak file berbahaya tertangkap), juga dapat menghasilkan jumlah yang lebih banyak dari positif palsu, dan demikian, dalam kondisi beberapa, hasil pemindaian dapat digunakan lebih efektif sebagai nilai keyakinan daripada daripada sebagai kesimpulan definitif. Jika nilai 0 digunakan, hasil pemindaian menggunakan Virus Total API akan diaplikasikan sebagai pendeteksian, dan demikian, jika mesin-mesin digunakan oleh Virus Total menandai file dipindai sebagai berbahaya, phpMussel akan menganggap file yang berbahaya. Jika nilai lain yang digunakan, hasil pemindaian menggunakan Virus Total API akan diaplikasikan sebagai deteksi pembobotan, dan demikian, jumlah mesin digunakan oleh Virus Total menandai file dipindai sebagai berbahaya akan berfungsi sebagai nilai keyakinan (atau deteksi pembobotan) untuk jika file dipindai harus dianggap berbahaya oleh phpMussel (nilai digunakan akan mewakili nilai keyakinan minimum atau pembobotan minimum diperlukan untuk dianggap berbahaya). Nilai 0 digunakan secara default.

"vt_quota_rate" dan "vt_quota_time"
- Menurut Virus Total dokumentasi API, itu terbatas untuk paling 4 permintaan dalam bentuk apapun dalam jangka waktu 1 menit diberikan. Jika Anda menjalankan sebuah honeyclient, honeypot atau otomatisasi lainnya yang akan menyediakan file untuk VirusTotal dan tidak hanya mengambil laporan Anda berhak untuk kuota permintaan lebih tinggi. Secara default, phpMussel ketat akan mematuhi keterbatasan ini, tapi karena kemungkinan kuota ini sedang meningkat, dua direktif ini yang disediakan sebagai sarana bagi Anda untuk menginstruksikan phpMussel tentang apa batas harus dipatuhi. Kecuali Anda telah diperintahkan untuk melakukannya, itu tidak direkomendasikan bagi Anda untuk meningkat nilai-nilai ini, tapi, jika Anda mengalami masalah berkaitan dengan mencapai kuota Anda, penurunan nilai-nilai ini kadang _**DAPAT**_ membantu Anda bagi berurusan dengan masalah-masalah ini. Batas Anda ditentukan sebagai `vt_quota_rate` permintaan dalam bentuk apapun dalam jangka waktu `vt_quota_time` menit.

#### "urlscanner" (Kategori)
Scanner URL adalah disertakan dengan phpMussel, mampu mendeteksi URL berbahaya dari dalam data atau file dipindai.

Mencatat: Jika scanner URL dinonaktifkan, Anda tidak perlu meninjaunya direktif-direktif dalam kategori ini (`urlscanner`), karena tidak satupun dari mereka akan melakukan apa-apa jika ini dinonaktifkan.

Konfigurasi scanner URL memeriksa API.

"lookup_hphosts"
- Memungkinkan pemeriksaan API ke [hpHosts](http://hosts-file.net/) API ketika diset untuk true. hpHosts tidak memerlukan kunci API untuk melakukan pemeriksaan API.

"google_api_key"
- Memungkinkan pemeriksaan API ke Google Safe Browsing API ketika kunci API diperlukan didefinisikan. Pemeriksaan Google Safe Browsing API memerlukan kunci API, diperoleh dari di [Sini](https://console.developers.google.com/).
- Mencatat: Ekstensi cURL diperlukan untuk menggunakan fitur ini.

"maximum_api_lookups"
- Jumlah maksimum pemeriksaan API melakukan per iterasi memindai individual. Karena setiap API pemeriksaan akan menambah tambahan waktu total dibutuhkan untuk menyelesaikan setiap iterasi pemindaian, Anda mungkin ingin menetapkan batasan untuk mempercepat proses pemindaian secara keseluruhan. Bila diset untuk 0, sejumlah maksimum tidak akan diterapkan. Diset untuk 10 secara default.

"maximum_api_lookups_response"
- Apa yang harus dilakukan jika jumlah maksimal pemeriksaan API dilampaui? False = Tidak melakukan apa-apa (melanjutkan pemrosesan) [Default]; True = Memblokir file.

"cache_time"
- Berapa lama (dalam detik) harus hasil API untuk disimpan dalam cache? Default adalah 3600 detik (1 jam).

#### "template_data" (Kategori)
Direktif-direktif dan variabel-variabel untuk template-template dan tema-tema.

File template berkaitan untuk HTML diproduksi yang digunakan untuk menghasilkan pesan "Upload Ditolak" yang ditampilkan kepada pengguna-pengguna ketika file upload yang diblokir. Jika Anda menggunakan tema kustom untuk phpMussel, HTML diproduksi yang bersumber dari file `template_custom.html`, dan sebaliknya, HTML diproduksi yang bersumber dari file `template.html`. Variabel ditulis untuk file konfigurasi bagian ini yang diurai untuk HTML diproduksi dengan cara mengganti nama-nama variabel dikelilingi dengan kurung keriting ditemukan dalam HTML diproduksi dengan file variabel sesuai. Sebagai contoh, dimana `foo="bar"`, setiap terjadinya `<p>{foo}</p>` ditemukan dalam HTML diproduksi akan menjadi `<p>bar</p>`.

"theme"
- Tema default untuk phpMussel.

"css_url"
- File template untuk tema kustom menggunakan properti CSS eksternal, sedangkan file template untuk tema default menggunakan properti CSS internal. Untuk menginstruksikan phpMussel menggunakan file template untuk tema kustom, menentukan alamat HTTP publik file CSS tema kustom Anda menggunakan variable `css_url`. Jika Anda biarkan kosong variabel ini, phpMussel akan menggunakan file template untuk tema default.

---


### 8. <a name="SECTION8"></a>FORMAT TANDA TANGAN

#### *TANDA TANGAN NAMA FILE*
Semua tanda tangan nama file mengikuti format ini:

`NAMA:FNRX`

Dimana NAMA adalah nama mengutip tanda tangan dan FNRX adalah pola regex untuk mencocokkan nama file (tidak ter-encode).

#### *TANDA TANGAN MD5*
Semua tanda tangan MD5 mengikuti format ini:

`HASH:UKURAN:NAMA`

Dimana HASH adalah MD5 dari keseluruhan file, UKURAN adalah total ukuran file dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN SEKSIONAL PE*
Semua tanda tangan seksional PE mengikuti format ini:

`UKURAN:HASH:NAMA`

Dimana HASH adalah MD5 dari seksi PE, UKURAN adalah total ukuran dari seksi PE dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN DIPERPANJANG PE*
Semua tanda tangan diperpanjang PE mengikuti format ini:

`$VAR:HASH:UKURAN:NAMA`

Dimana $VAR adalah nama dari PE variabel untuk mencocokkan terhadap, HASH adalah MD5 dari variabel, UKURAN adalah ukuran total dari variabel dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN PUTIH*
Semua tanda tangan putih mengikuti format ini:

`HASH:UKURAN:TYPE`

Dimana HASH adalah MD5 dari keseluruhan file, UKURAN adalah total ukuran file dan TYPE adalah jenis tanda tangan yang file daftar putih tersebut adalah kebal terhadap.

#### *TANDA TANGAN DIPERPANJANG KOMPLEKS*
Tanda tangan diperpanjang kompleks adalah berbeda dengan jenis lain dari tanda tangan phpMussel, melalui bahwa apa yang mencocokkan mereka ditentukan oleh tanda tangan sendiri dan mereka dapat mencocokkan terhadap beberapa kriteria. Kriteria mencocokkan yang dipisahkan oleh ";" dan pencocokan jenis dan pencocokan data masing-masing kriteria yang dipisahkan oleh ":" sebagai sehingga format untuk tanda tangan ini cenderung terlihat sedikit seperti:

`$variabel1:DATA;$variabel:DATA;NamaTandaTangan`

#### *YANG LAIN*
Semua tanda tangan yang lain mengikuti format ini:

`NAMA:HEX:FROM:TO`

Dimana NAMA adalah nama yang mengutip tanda tangan ini dan HEX adalah sebuah segmen heksadesimal-dikodekan dari data yang dimaksudkan untuk dicocokkan oleh tanda tangan yang diberikan. FROM dan TO adalah parameter opsional, mengindikasikan dari mana dan kemana posisi dari sumber file untuk cek.

#### *REGEX*
Setiap bentuk dari regex mengerti dan dengan benar diproses oleh PHP seharusnya bisa dengan benar dimengerti dan diproses oleh phpMussel dan tanda tangannya. Bagaimanapun, saya menyarankan peringatan ekstrim ketika menuliskan tanda tangan berbasis regex baru karena, jika Anda tidak yakin apa yang Anda lakukan dapat menghasilkan hal yang tidak diinginkan. Coba lihat source-code phpMussel dan jika Anda tidak yakin tentang konteks dari statemen regex diparsing. Juga ingat bahwa semua pola (dengan pengecualian ke nama data, metadata terkompres dan pola MD5) harus diencode heksadesimal (sintaksis pola sebelumnya, tentu saja)!

---


### 9. <a name="SECTION9"></a>MASALAH KOMPATIBILITAS DIKETAHUI

#### PHP dan PCRE
- phpMussel memerlukan PHP dan PCRE untuk mengeksekusi dan berfungsi dengan baik. Tanpa PHP, atau tanpa ekstensi PCRE, phpMussel tidak akan mengeksekusi atau berfungsi dengan baik. Seharusnya memastikan sistem Anda terinstal PHP dan PCRE dan tersedia secara prioritas untuk mengunduh dan menginstal phpMussel.

#### KOMPATIBILITAS SOFTWARE ANTI-VIRUS

Untuk banyak bagian, phpMussel seharusnya kompatibel dengan software pemindaian virus. Bagaimanapun konflik telah dilaporkan oleh penggunak di masa lalu. Informasi di bawah adalah dari virustotal.com, dan menguraikan sejumlah angka positif yang salah yang dilaporkan oleh bermacam-macam program anti-virus pada phpMussel. Walaupun informasi ini bukan jaminan absolut dari apakah Anda mengalami masalah kompatibilitas antara phpMussel dan perangkat anti-virus Anda, jika perangkat lunak anti-virus Anda tercatat berlawanan dengan phpMussel, Anda seharusnya mempertimbangkan menonaktifkannya bekerja dengan phpMussel atau seharusnya mempertimbangkan opsi alternatif ke software anti virus atau phpMussel.

Informasi ini diupdate 29 Agustus 2016 dan cocok untuk semua rilis phpMussel dari dua versi minor terbaru versi (v0.10.0-v1.0.0) pada waktu saya menuliskan ini.

| Scanner              |  Hasil                               |
|----------------------|--------------------------------------|
| Ad-Aware             |  Tidak masalah                       |
| AegisLab             |  Tidak masalah                       |
| Agnitum              |  Tidak masalah                       |
| AhnLab-V3            |  Tidak masalah                       |
| Alibaba              |  Tidak masalah                       |
| ALYac                |  Tidak masalah                       |
| AntiVir              |  Tidak masalah                       |
| Antiy-AVL            |  Tidak masalah                       |
| Arcabit              |  Tidak masalah                       |
| Avast                |  Melaporkan "JS:ScriptSH-inf [Trj]"  |
| AVG                  |  Tidak masalah                       |
| Avira                |  Tidak masalah                       |
| AVware               |  Tidak masalah                       |
| Baidu                |  Melaporkan "VBS.Trojan.VBSWG.a"     |
| Baidu-International  |  Tidak masalah                       |
| BitDefender          |  Tidak masalah                       |
| Bkav                 |  Melaporkan "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell", "VEXEFFC.Webshell"|
| ByteHero             |  Tidak masalah                       |
| CAT-QuickHeal        |  Tidak masalah                       |
| ClamAV               |  Tidak masalah                       |
| CMC                  |  Tidak masalah                       |
| Commtouch            |  Tidak masalah                       |
| Comodo               |  Tidak masalah                       |
| Cyren                |  Tidak masalah                       |
| DrWeb                |  Tidak masalah                       |
| Emsisoft             |  Tidak masalah                       |
| ESET-NOD32           |  Tidak masalah                       |
| F-Prot               |  Tidak masalah                       |
| F-Secure             |  Tidak masalah                       |
| Fortinet             |  Tidak masalah                       |
| GData                |  Tidak masalah                       |
| Ikarus               |  Tidak masalah                       |
| Jiangmin             |  Tidak masalah                       |
| K7AntiVirus          |  Tidak masalah                       |
| K7GW                 |  Tidak masalah                       |
| Kaspersky            |  Tidak masalah                       |
| Kingsoft             |  Tidak masalah                       |
| Malwarebytes         |  Tidak masalah                       |
| McAfee               |  Melaporkan "New Script.c"           |
| McAfee-GW-Edition    |  Melaporkan "New Script.c"           |
| Microsoft            |  Tidak masalah                       |
| MicroWorld-eScan     |  Tidak masalah                       |
| NANO-Antivirus       |  Tidak masalah                       |
| Norman               |  Tidak masalah                       |
| nProtect             |  Tidak masalah                       |
| Panda                |  Tidak masalah                       |
| Qihoo-360            |  Tidak masalah                       |
| Rising               |  Tidak masalah                       |
| Sophos               |  Tidak masalah                       |
| SUPERAntiSpyware     |  Tidak masalah                       |
| Symantec             |  Tidak masalah                       |
| Tencent              |  Tidak masalah                       |
| TheHacker            |  Tidak masalah                       |
| TotalDefense         |  Tidak masalah                       |
| TrendMicro           |  Tidak masalah                       |
| TrendMicro-HouseCall |  Tidak masalah                       |
| VBA32                |  Tidak masalah                       |
| VIPRE                |  Tidak masalah                       |
| ViRobot              |  Tidak masalah                       |
| Zillya               |  Tidak masalah                       |
| Zoner                |  Tidak masalah                       |

---


### 10. <a name="SECTION10"></a>PERTANYAAN YANG SERING DIAJUKAN (FAQ)

#### Apa yang "tanda tangan"?

Dalam konteks phpMussel, "tanda tangan" mengacu pada data yang bertindak sebagai indikator/pengenal untuk sesuatu spesifik yang kita cari, biasanya dalam bentuk segmen yang sangat kecil, unik, tidak berbahaya dari sesuatu yang lebih besar dan biasanya, sebaliknya berbahaya, seperti virus atau trojan, atau dalam bentuk file checksum, hash, atau indikator yang mengidentifikasi lainnya, dan biasanya termasuk label, dan beberapa data lainnya, untuk membantu memberikan konteks tambahan yang bisa digunakan oleh phpMussel untuk menentukan cara terbaik untuk melanjutkan ketika menemukan apa yang kita cari.

#### Apa yang dimaksud dengan "positif palsu"?

Istilah "positif palsu" (*alternatif: "kesalahan positif palsu"; "alarm palsu"*; Bahasa Inggris: *false positive*; *false positive error*; *false alarm*), dijelaskan dengan sangat sederhana, dan dalam konteks umum, digunakan saat pengujian untuk kondisi, untuk merujuk pada hasil tes, ketika hasilnya positif (yaitu, kondisi adalah dianggap untuk menjadi "positif", atau "benar"), namun diharapkan (atau seharusnya) menjadi negatif (yaitu, kondisi ini, pada kenyataannya, adalah "negatif", atau "palsu"). Sebuah "positif palsu" bisa dianggap analog dengan "menangis serigala" (dimana kondisi dites adalah apakah ada serigala di dekat kawanan, kondisi adalah "palsu" di bahwa tidak ada serigala di dekat kawanan, dan kondisi ini dilaporkan sebagai "positif" oleh gembala dengan cara memanggil "serigala, serigala"), atau analog dengan situasi dalam pengujian medis dimana seorang pasien didiagnosis sebagai memiliki beberapa penyakit, ketika pada kenyataannya, mereka tidak memiliki penyakit tersebut.

Hasil terkait ketika pengujian untuk kondisi dapat digambarkan menggunakan istilah "positif benar", "negatif benar" dan "negatif palsu". Sebuah "positif benar" mengacu pada saat hasil tes dan keadaan sebenarnya dari kondisi adalah keduanya benar (atau "positif"), dan sebuah "negatif benar" mengacu pada saat hasil tes dan keadaan sebenarnya dari kondisi adalah keduanya palsu (atau "negatif"); Sebuah "positif benar" atau "negatif benar" adalah dianggap untuk menjadi sebuah "inferensi benar". Antitesis dari "positif palsu" adalah sebuah "negatif palsu"; Sebuah "negatif palsu" mengacu pada saat hasil tes are negatif (yaitu, kondisi adalah dianggap untuk menjadi "negatif", atau "palsu"), namun diharapkan (atau seharusnya) menjadi positif (yaitu, kondisi ini, pada kenyataannya, adalah "positif", atau "benar").

Dalam konteks phpMussel, istilah-istilah ini mengacu pada tanda tangan dari phpMussel dan file yang mereka memblokir. Ketika phpMussel blok file karena buruk, usang atau salah tanda tangan, tapi seharusnya tidak melakukannya, atau ketika melakukannya untuk alasan salah, kita menyebut acara ini sebuah "positif palsu". Ketika phpMussel gagal untuk memblokir file yang seharusnya diblokir, karena ancaman tak terduga, hilang tanda tangan atau kekurangan dalam tanda tangan nya, kita menyebut acara ini sebuah "deteksi terjawab" atau "missing detection" (ini analog dengan sebuah "negatif palsu").

Ini dapat diringkas dengan tabel di bawah:

&nbsp; | phpMussel seharusnya *TIDAK* memblokir file | phpMussel *SEHARUSNYA* memblokir file
---|---|---
phpMussel *TIDAK* memblokir file | Negatif benar (inferensi benar) | Deteksi terjawab (analog dengan negatif palsu)
phpMussel memblokir file | __Positif palsu__ | Positif benar (inferensi benar)

#### Seberapa sering tanda tangan diperbarui?

Frekuensi pembaruan bervariasi tergantung pada file tanda tangan. Semua penulis bagi file tanda tangan phpMussel umumnya mencoba untuk menjaga tanda tangan mereka sebagai diperbarui sebanyak mungkin, tapi karena semua dari kita memiliki komitmen lainnya, kehidupan kita di luar proyek, dan karena kita tidak dikompensasi finansial (yaitu, dibayar) untuk upaya kami pada proyek, jadwal pembaruan yang tepat tidak dapat dijamin. Umumnya, tanda tangan diperbarui ketika ada cukup waktu untuk memperbaruinya, dan umumnya, penulis mencoba untuk memprioritaskan berdasarkan kebutuhan dan frekuensi berbagai perubahan dalam rentang. Bantuan selalu dihargai jika Anda bersedia untuk menawarkan.

#### Saya mengalami masalah ketika menggunakan phpMussel dan saya tidak tahu apa saya harus lakukan! Tolong bantu!

- Apakah Anda menggunakan versi terbaru bagi perangkat lunak? Apakah Anda menggunakan versi terbaru bagi file tanda tangan Anda? Jika jawaban untuk salah satu dari dua pertanyaan ini adalah tidak, mencoba untuk memperbarui segala sesuatu pertama, dan memeriksa apakah masalah terus berlanjut. Jika terus berlanjut, lanjutkan membaca.
- Apakah Anda memeriksa semua dokumentasi? Jika tidak, silahkan melakukannya. Jika masalah tidak dapat diselesaikan dengan menggunakan dokumentasi, lanjutkan membaca.
- Apakah Anda memeriksa **[halaman isu-isu](https://github.com/Maikuolan/phpMussel/issues)**, untuk melihat apakah masalah telah disebutkan sebelumnya? Jika sudah disebutkan sebelumnya, memeriksa apakah ada saran, ide, dan/atau solusi yang tersedia, dan ikuti sesuai yang diperlukan untuk mencoba untuk menyelesaikan masalah.
- Apakah Anda memeriksa **[forum dukungan bagi phpMussel yang disediakan oleh Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)**, untuk melihat apakah masalah telah disebutkan sebelumnya? Jika sudah disebutkan sebelumnya, memeriksa apakah ada saran, ide, dan/atau solusi yang tersedia, dan ikuti sesuai yang diperlukan untuk mencoba untuk menyelesaikan masalah.
- Jika masalah masih berlanjut, silahkan beritahu kami dengan membuat isu baru di halaman isu-isu atau dengan memulai diskusi baru di forum dukungan.

#### Saya ingin menggunakan phpMussel dengan versi PHP yang lebih tua dari 5.4.0; Anda dapat membantu?

Tidak. PHP 5.4.0 mencapai EoL ("End of Life", atau Akhir Hidup) resmi pada tahun 2014, dan dukungan keamanan diperpanjang dihentikan pada tahun 2015. Sebagai menulis ini, itu adalah 2017, dan PHP 7.1.0 sudah tersedia. Pada saat ini, dukungan disediakan untuk menggunakan phpMussel dengan PHP 5.4.0 dan semua tersedia versi PHP yang lebih baru, tapi jika Anda mencoba untuk menggunakan phpMussel dengan versi PHP yang lebih tua, dukungan tidak akan diberikan.

#### Dapatkah saya menggunakan satu instalasi phpMussel untuk melindungi beberapa domain?

Ya. Instalasi phpMussel tidak secara alami terkunci pada domain tertentu, dan dengan demikian dapat digunakan untuk melindungi beberapa domain. Umumnya, kami mengacu pada instalasi phpMussel yang hanya melindungi satu domain as "instalasi domain tunggal" ("single-domain installations"), dan kami mengacu pada instalasi phpMussel yang melindungi beberapa domain dan/atau sub-domain sebagai "instalasi domain beberapa" ("multi-domain installations"). Jika Anda mengoperasikan instalasi domain beberapa dan perlu menggunakan berbagai kumpulan file tanda tangan untuk berbagai domain, atau perlu phpMussel untuk dikonfigurasi secara berbeda untuk domain berbeda, kamu bisa melakukan ini. Setelah memuat file konfigurasi (`config.ini`), phpMussel akan memeriksa adanya "file untuk pengganti konfigurasi" spesifik untuk domain (atau sub-domain) yang diminta (`domain-yang-diminta.tld.config.ini`), dan jika ditemukan, setiap nilai konfigurasi yang ditentukan oleh file untuk pengganti konfigurasi akan digunakan untuk instance eksekusi daripada nilai konfigurasi yang ditentukan oleh file konfigurasi. File untuk pengganti konfigurasi identik dengan file konfigurasi, dan atas kebijaksanaan Anda, dapat berisi keseluruhan semua konfigurasi yang tersedia untuk phpMussel, atau apapun bagian kecil yang dibutuhkan yang berbeda dari nilai yang biasanya ditentukan oleh file konfigurasi. File untuk pengganti konfigurasi diberi nama sesuai dengan domain yang mereka inginkan (jadi, misalnya, jika Anda memerlukan file untuk pengganti konfigurasi untuk domain, `http://www.some-domain.tld/`, file untuk pengganti konfigurasi harus diberi nama sebagai `some-domain.tld.config.ini`, dan harus ditempatkan di dalam vault bersama file konfigurasi, `config.ini`). Nama domain untuk instance eksekusi berasal dari header permintaan `HTTP_HOST`; "www" diabaikan.

---


Terakhir Diperbarui: 19 Mei 2017 (2017.05.19).
