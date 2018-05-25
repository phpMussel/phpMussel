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
- 11. [INFORMASI HUKUM](#SECTION11)

*Catatan tentang terjemahan: Dalam hal kesalahan (misalnya, perbedaan antara terjemahan, kesalahan cetak, dll), versi bahasa Inggris dari README dianggap versi asli dan berwibawa. Jika Anda menemukan kesalahan, bantuan Anda dalam mengoreksi mereka akan disambut.*

---


### 1. <a name="SECTION1"></a>SEPATAH KATA

Terima kasih untuk menggunakan phpMussel, sebuah skrip PHP di-design untuk mendeteksi trojan-trojan, virus-virus dan serangan-serangan lainnya dalam file-file diupload ke sistem Anda dimana saja skrip di kaitkan, berdasarkan tanda tangan dari ClamAV dan lain-lain.

PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPLv2 oleh Caleb M (Maikuolan).

Skrip ini adalah perangkat lunak gratis; Anda dapat mendistribusikan kembali dan/atau memodifikasinya dalam batasan dari GNU General Public License, seperti di publikasikan dari Free Software Foundation; baik versi 2 dari License, atau (dalam opsi Anda) versi selanjutnya apapun. Skrip ini didistribusikan untuk harapan dapat digunakan tapi TANPA JAMINAN; tanpa walaupun garansi dari DIPERJUALBELIKAN atau KECOCOKAN UNTUK TUJUAN TERTENTU. Mohon Lihat GNU General Public Licence untuk lebih detail, terletak di file `LICENSE.txt` dan tersedia juga dari:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Terima kasih khususnya untuk ClamAV buat inspirasi project dan tanda tangan dimana skrip ini menggunakan ClamAV, tanpa nya skrip ini tidak akan ada, atau akan mengalami nilai yang kurang baik.

Khusus terima kasih kepada SourceForge dan GitHub untuk menghost file proyek, dan kepada sumber-sumber tambahan tanda tangan dimanfaatkan oleh phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) dan lain-lain, dan khusus terima kasih kepada semua orang yang mendukung proyek, kepada orang lain bahwa saya mungkin telah dinyatakan lupa untuk menyebutkan, dan kepada Anda, untuk menggunakan skrip.

Dokumen ini dan paket terhubung di dalamnya dapat di unduh secara gratis dari:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>BAGAIMANA CARA MENGINSTAL

#### 2.0 MENGINSTAL SECARA MANUAL (UNTUK SERVER WEB)

1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh dan menyimpan copy dari skrip, membuka data terkompres dan isinya dan Anda meletakkannya pada mesin komputer lokal Anda. Dari sini, Anda akan latihan dimana di host Anda atau CMS Anda untuk meletakkan isi data terkompres nya. Sebuah direktori seperti `/public_html/phpmussel/` atau yang lain (walaupun tidak masalah Anda memilih direktori apa, selama dia aman dan dimana pun yang Anda senangi) akan mencukupi. *Sebelum Anda mulai upload, mohon baca dulu..*

2) Mengubah file nama `config.ini.RenameMe` ke `config.ini` (berada di dalam `vault`), dan secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), membukanya (file ini berisikan semua opsi operasional yang tersedia untuk phpMussel; di atas tiap opsi seharusnya ada komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa). Atur opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk setup tertentu. Simpan file, menutupnya.

3) Upload isi (phpMussel dan file-filenya) ke direktori yang telah kamu putuskan sebelumnya (Anda tidak memerlukan file-file `*.txt`/`*.md`, tapi kebanyakan Anda harus mengupload semuanya).

4) Gunakan perinta CHMOD ke direktori `vault` dengan "755" (jika ada masalah, Anda dapat mencoba "777", tapi ini kurang aman). Direktori utama menyimpan isinya (yang Anda putuskan sebelumnya), umumnya dapat di biarkan sendirian, tapi status perintah "CHMOD" seharusnya di cek jika kamu punya izin di sistem Anda (defaultnya, seperti "755").

5) Instal semua tanda tangan yang Anda perlukan. *Lihat: [MENGINSTAL TANDA TANGAN](#INSTALLING_SIGNATURES).*

6) Selanjutnya Anda perlu menghubungkan phpMussel ke sistem atau CMS. Ada beberapa cara yang berbeda untuk menghubungkan skrip seperti phpMussel ke sistem atau CMS, tapi yang paling mudah adalah memasukkan skrip pada permulaan dari file murni dari sistem atau CMS (satu yang akan secara umum di muat ketika seseorang mengakses halaman apapun pada website) berdasarkan pernyataan `require` atau `include`. Umumnya, ini akan menjadi sesuatu yang disimpan di sebuah direktori seperti `/includes`, `/assets` atau `/functions` dan akan selalu di namai sesuatu seperti `init.php`, `common_functions.php`, `functions.php` atau yang sama. Anda harus bekerja pada file apa untuk situasi ini; Jika Anda mengalami kesulitan dalam menentukan ini untuk diri sendiri, kunjungi halaman issues (issues) phpMussel di GitHub atau forum dukungan phpMussel untuk bantuan; Ada kemungkinan bahwa saya sendiri atau pengguna lain mungkin memiliki pengalaman dengan CMS yang Anda gunakan (Anda harus memberitahu kami tahu mana CMS yang Anda gunakan), dan demikian, mungkin dapat memberikan beberapa bantuan kepada Anda. Untuk melakukannya [menggunakan `require` atau `include`], sisipkan baris kode dibawah pada file murni, menggantikan kata-kata berisikan didalam tanda kutip dari alamat file `loader.php` (alamat lokal, tidak alamat HTTP; akan terlihat seperti alamat vault yang di bicarakan sebelumnya).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Simpan file dan menutupnya. Upload kembali.

-- ATAU ALTERNATIF --

Jika Anda menggunakan webserver Apache dan jika Anda memiliki akses ke `php.ini`, Anda dapat menggunakan `auto_prepend_file` direktif untuk tambahkan phpMussel setiap kali ada permintaan PHP dibuat. Sesuatu seperti:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Atau ini di file `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) Pada titik ini, kamu telah selesai! Bagaimanapun, kamu mungkin seharusnya mencobanya untuk melihat dia bekerja dengan dengan baik. Untuk mencoba file keamanan upload, coba mengupload file-file testing yang dimasukkan dalam paket di `_testfiles` ke website Anda melalui metode upload di browser Anda. Jika semua bekerja dengan baik, sebuah pesan akan muncul dari phpMussel mengkonfirmasikan bahwa upload sudah sukses di blok. Jika tidak ada yang terjadi, ada sesuatu yang tidak bekerja dengan baik. Jika Anda menggunakan fitur-fitur lanjut atau jika Anda menggunakan tipe-tipe yang lain untuk memeriksa mungkin dengan alat-alat itu, saya sarankan mencoba dengan nya untuk memastikan dia bekerja seperti yang diharapkan juga.

#### 2.1 MENGINSTAL SECARA MANUAL (UNTUK CLI)

1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh data terkompres nya dan menguraikan isi nya pada mesin komputer lokal Anda. Setelah Anda telah memilih lokasi dari phpMussel, lanjutkan.

2) phpMussel memerlukan PHP untuk diinstall pada mesin host untuk mengeksekusinya. Jika Anda tidak memiliki PHP pada mesin Anda, ikuti instruksi yang di supply oleh installer PHP.

3) Secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), buka `config.ini` (berada di dalam `vault`) – File ini berisikan semua opsi operasional yang tersedia untuk phpMussel. Di atas tiap opsi seharusnya ada komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa. Atur opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk setup tertentu. Simpan file, menutupnya.

4) Secara fakultatif, Anda dapat menggunakan phpMussel di dalam mode CLI untuk diri Anda sendiri dengan menciptakan file batch untuk secara automatis memuat PHP dan phpMussel. Untuk melakukannya, buka sebuah text editor kosong seperti Notepad atau Notepad++, ketikkan jalur dari file `php.exe` di dalam direktori dari instalasi PHP Anda, diikuti spasi, diikuti dengan jalur lengkap dari file `loader.php` di dalam direktori dari instalasi phpMussel, simpan file dengan ekstensi `.bat` di simpan di tempat yang Anda mudah temukan dan klik dua kali pada file itu untuk menjalankan phpMussel di masa yang akan datang.

5) Instal semua tanda tangan yang Anda perlukan. *Lihat: [MENGINSTAL TANDA TANGAN](#INSTALLING_SIGNATURES).*

6) Pada titik ini, Anda selesai! Bagaimanapun Anda seharusnya mencobanya untuk memastikan berjalan dengan lancar. Untuk mencek phpMussel, jalankan phpMussel dan coba memindai `_testfiles` direktori yang disediakan dengan ini paket.

#### 2.2 MENGINSTAL DENGAN COMPOSER

[phpMussel terdaftar dengan Packagist](https://packagist.org/packages/phpmussel/phpmussel). Jika Anda akrab dengan Composer, Anda dapat menggunakan Composer untuk menginstal phpMussel (Anda masih perlu mempersiapkan konfigurasi dan kait meskipun; melihat "menginstal secara manual (untuk server web)" langkah 2 dan 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 MENGINSTAL TANDA TANGAN

Sejak v1.0.0, tanda tangan tidak termasuk dalam paket phpMussel. Tanda tangan dibutuhkan oleh phpMussel untuk mendeteksi ancaman tertentu. Ada 3 metode utama untuk menginstal tanda tangan:

1. Instal secara otomatis menggunakan halaman pembaruan dari bagian depan.
2. Buat tanda tangan menggunakan "SigTool" dan instal secara manual.
3. Download tanda tangan dari "phpMussel/Signatures" dan instal secara manual.

##### 2.3.1 Instal secara otomatis menggunakan halaman pembaruan dari bagian depan.

Pertama, Anda harus memastikan bahwa akses bagian depan diaktifkan. *Lihat: [MANAJEMEN BAGIAN DEPAN](#SECTION4).*

Kemudian, semua yang Anda perlu lakukan adalah pergi ke halaman pembaruan dari bagian depan, cari file tanda tangan yang diperlukan, dan menggunakan pilihan yang tersedia di halaman, menginstalnya, dan mengaktifkannya.

##### 2.3.2 Buat tanda tangan menggunakan "SigTool" dan instal secara manual.

*Lihat: [Dokumentasi SigTool](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Download tanda tangan dari "phpMussel/Signatures" dan instal secara manual.

Pertama, pergi ke [phpMussel/Signatures](https://github.com/phpMussel/Signatures). Repositori berisi berbagai file tanda tangan yang GZ-dikompres. Download file yang Anda perlukan, dekompresi mereka, dan salin file yang didekompresi ke direktori `/vault/signatures` untuk menginstalnya. Cantumkan nama file yang disalin ke direktif `Active` dalam konfigurasi phpMussel Anda untuk mengaktifkannya.

---


### 3. <a name="SECTION3"></a>BAGAIMANA CARA MENGGUNAKAN

#### 3.0 BAGAIMANA CARA MENGGUNAKAN (UNTUK SERVER WEB)

phpMussel harus mampu beroperasi benar dengan persyaratan minimal darimu: Setelah instalasi, harus bekerja segera dan harus berguna segera.

Memindai upload file secara automatis dan di mungkinkan secara default, jadi tidak ada yang diharuskan pada Anda untuk fungsi ini.

Bagaimanapun, Anda juga bisa menginstruksikan phpMussel untuk memindai file, direktori dan/atau arsip spesifik. Untuk melakukannya, pertama-tama Anda harus memastikan konfigurasi yang cocok diset di file `config.ini` (`cleanup` harus dinonaktifkan) dan ketika selesai, di sebuah file PHP yang di hubungkan ke phpMussel, gunakan fungsi berikut pada kode Anda:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` dapat berupa string, array, atau array mengandung array-array, mengindikasikan apa file, file-file, direktori dan/atau direktori-direktori untuk memindai.
- `$output_type` adalah boolean, mengindikasikan format untuk hasil pemindaian untuk dikembalikan sebagai. `false` menginstruksikan fungsi untuk mengembalikan hasil sebagai integer. `true` menginstruksikan fungsi untuk mengembalikan hasil sebagai teks yang dapat dibaca manusia. Tambahan, dalam kedua kasus, hasilnya dapat diakses melalui variabel global setelah memindai selesai. Variabel ini adalah opsional, default untuk `false`. Berikut ini adalah deskripsi untuk hasil integer:

| Hasil | Deskripsi |
|---|---|
| -3 | Mengindikasikan masalah adalah ditemui dengan file tanda tangan phpMussel atau file memetakan tanda tangan dan mereka mungkin hilang atau rusak. |
| -2 | Mengindikasikan bahwa file dikorup terdeteksi selama proses memindai dan proses memindai gagal selesai. |
| -1 | Mengindikasikan bawa ekstensi atau addon yang dibutuhkan oleh PHP untuk mengeksekusi pemindaian hilang dan demikian gagal selesai. |
| 0 | Mengindikasikan bahwa target pemindaian tidak ada dan tidak ada yang dipindai. |
| 1 | Mengindikasikan bahwa target sukses dipindai dan tidak ada masalah terdeteksi. |
| 2 | Mengindikasikan target sukses di scan namun ada masalah terdeteksi. |

- `$output_flatness` adalah boolean, mengindikasikan ke fungsi apakah akan mengembalikan hasil pemindaian (ketika ada beberapa target pemindaian) sebagai array atau string. `false` akan mengembalikan hasil sebagai array. `true` akan mengembalikan hasil sebagai string. Variabel ini adalah opsional, default untuk `false`.

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

Untuk sebuah pemecahan penuh dari jenis tanda tangan phpMussel yang digunakan selama pemindaian dan bagaimana dia memegang tanda tangan-tanda tangan ini, mencocokkan ke [FORMAT TANDA TANGAN](#SECTION8) dari file README.

Jika Anda menjumpai bilangan positif yang salah, jika Anda menemukan hal baru yang harus di blok atau untuk apapun dalam tanda tangan mohon hubungi saya mengenainya sehingga saya dapat membuat perubahan yang perlu, dimana, jika Anda tidak menghubungi saya saya tidak tahu. *(Lihat: [Apa yang dimaksud dengan "positif palsu"?](#WHAT_IS_A_FALSE_POSITIVE)).*

Untuk menonaktifkan tanda tangan-tanda tangan yang dimasukkan dalam phpMussel (seperti jika Anda berpengalaman sebuah angka positif yang salah untuk tujuan Anda yang seharusnya secara normal di hapus dari aliran), tambahkan nama tanda tangan spesifik yang harus dinonaktifkan ke file tanda tangan daftar abu-abu (`/vault/greylist.csv`), dipisahkan dengan koma.

*Lihat juga: [Bagaimana cara mengakses rincian spesifik tentang file saat dipindai?](#SCAN_DEBUGGING)*

#### 3.1 BAGAIMANA CARA MENGGUNAKAN (UNTUK CLI)

Silahkan lihat "MENGINSTAL SECARA MANUAL (UNTUK CLI)" dari file README.

Mohon diingat bahwa phpMussel adalah scanner *on-demand*; adalah *BUKAN* scanner *on-access* (dengan pengecualian upload file, pada saat upload), dan tidak seperti anti virus, tidak memonitor memori aktif! phpMussel hanya mendeteksi virus dalam upload file dan dalam file yang Anda perintahkan untuk dipindai.

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

phpMussel dapat dijalankan sebagai sebuah file interaktif pemindai dalam mode CLI dalam Windows. Lihat "BAGAIMANA CARA MENGINSTAL (UNTUK CLI)" dari file README untuk lebih detail.

Untuk daftar yang tersedia CLI perintah, pada prompt CLI, ketik 'c', dan tekan Enter.

Sebagai tambahan, bagi yang berminat, sebuah video tutorial untuk bagaimana menggunakan phpMussel di modus CLI tersedia disini:
- <https://youtu.be/H-Pa740-utc>

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
/vault/fe_assets/_cache.html | Template HTML untuk akses bagian depan halaman data cache.
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
/vault/fe_assets/_quarantine.html | Template HTML untuk akses bagian depan halaman karantina.
/vault/fe_assets/_quarantine_row.html | Template HTML untuk akses bagian depan halaman karantina.
/vault/fe_assets/_statistics.html | Template HTML untuk akses bagian depan halaman statistik.
/vault/fe_assets/_updates.html | Template HTML untuk akses bagian depan halaman pembaruan.
/vault/fe_assets/_updates_row.html | Template HTML untuk akses bagian depan halaman pembaruan.
/vault/fe_assets/_upload_test.html | Template HTML untuk halaman upload test.
/vault/fe_assets/frontend.css | Style-sheet CSS untuk akses bagian depan.
/vault/fe_assets/frontend.dat | Database untuk akses bagian depan (berisi informasi untuk akun dan sesi; hanya dihasilkan jika akses bagian depan diaktifkan dan digunakan).
/vault/fe_assets/frontend.html | Template HTML utama untuk akses bagian depan.
/vault/fe_assets/icons.php | File ikon (digunakan oleh file manager bagian depan).
/vault/fe_assets/pips.php | File pip (digunakan oleh file manager bagian depan).
/vault/fe_assets/scripts.js | Berisi data JavaScript bagian depan.
/vault/lang/ | Berisikan file bahasa.
/vault/lang/.htaccess | File akses hiperteks (pada instansi ini, untuk melindungi file-file sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
/vault/lang/lang.ar.fe.php | File Bahasa Arab untuk bagian depan.
/vault/lang/lang.ar.php | File Bahasa Arab.
/vault/lang/lang.bn.fe.php | File Bahasa Benggala untuk bagian depan.
/vault/lang/lang.bn.php | File Bahasa Benggala.
/vault/lang/lang.de.fe.php | File Bahasa Jerman untuk bagian depan.
/vault/lang/lang.de.php | File Bahasa Jerman.
/vault/lang/lang.en.fe.php | File Bahasa Inggris untuk bagian depan.
/vault/lang/lang.en.php | File Bahasa Inggris.
/vault/lang/lang.es.fe.php | File Bahasa Spanyol untuk bagian depan.
/vault/lang/lang.es.php | File Bahasa Spanyol.
/vault/lang/lang.fr.fe.php | File Bahasa Perancis untuk bagian depan.
/vault/lang/lang.fr.php | File Bahasa Perancis.
/vault/lang/lang.hi.fe.php | File Bahasa Hindi untuk bagian depan.
/vault/lang/lang.hi.php | File Bahasa Hindi.
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
/vault/lang/lang.tr.fe.php | File Bahasa Turki untuk bagian depan.
/vault/lang/lang.tr.php | File Bahasa Turki.
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
/vault/.travis.php | Digunakan oleh Travis CI untuk pengujian (tidak dibutuhkan untuk fungsi teratur dari skrip).
/vault/.travis.yml | Digunakan oleh Travis CI untuk pengujian (tidak dibutuhkan untuk fungsi teratur dari skrip).
/vault/cli.php | Modul CLI handler.
/vault/components.dat | Berisi informasi yang berkaitan dengan berbagai komponen untuk phpMussel; Digunakan oleh fitur pembaruan disediakan oleh akses bagian depan.
/vault/config.ini.RenameMe | File konfigurasi phpMussel; Berisi semua opsi konfigurasi dari phpMussel, memberitahukannya apa yang harus dilakukan dan bagaimana mengoperasikannya dengan benar (mengubah nama untuk mengaktifkan).
/vault/config.php | Modul konfigurasi.
/vault/config.yaml | File default konfigurasi; Berisi nilai konfigurasi default untuk phpMussel.
/vault/frontend.php | Modul untuk akses bagian depan.
/vault/frontend_functions.php | Modul untuk fungsi akses bagian depan.
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
/.gitignore | Sebuah file proyek GitHub (tidak dibutuhkan untuk fungsi teratur dari skrip).
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
- Memotong file log ketika mereka mencapai ukuran tertentu? Nilai adalah ukuran maksimum dalam B/KB/MB/GB/TB yang bisa ditambahkan untuk file log sebelum dipotong. Nilai default 0KB menonaktifkan pemotongan (file log dapat tumbuh tanpa batas waktu). Catat: Berlaku untuk file log individu! Ukuran file log tidak dianggap secara kolektif.

"log_rotation_limit"
- Rotasi log membatasi jumlah file log yang seharusnya ada pada satu waktu. Ketika file log baru dibuat, jika jumlah total file log melebihi batas yang ditentukan, tindakan yang ditentukan akan dilakukan. Anda dapat menentukan batas yang diinginkan disini. Nilai 0 akan menonaktifkan rotasi log.

"log_rotation_action"
- Rotasi log membatasi jumlah file log yang seharusnya ada pada satu waktu. Ketika file log baru dibuat, jika jumlah total file log melebihi batas yang ditentukan, tindakan yang ditentukan akan dilakukan. Anda dapat menentukan tindakan yang diinginkan disini. Delete = Hapus file log tertua, hingga batasnya tidak lagi terlampaui. Archive = Pertama arsipkan, lalu hapus file log tertua, hingga batasnya tidak lagi terlampaui.

*Klarifikasi teknis: Dalam konteks ini, "tertua" berarti tidak dimodifikasi baru-baru.*

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

"numbers"
- Menentukan bagaimana menampilkan nomor-nomor.

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
- Menonaktifkan webfonts? True = Ya [Default]; False = Tidak.

"maintenance_mode"
- Aktifkan modus perawatan? True = Ya; False = Tidak [Default]. Nonaktifkan semuanya selain bagian depan. Terkadang berguna saat memperbarui CMS, kerangka kerja, dll.

"default_algo"
- Mendefinisikan algoritma mana yang akan digunakan untuk semua password dan sesi di masa depan. Opsi: PASSWORD_DEFAULT (default), PASSWORD_BCRYPT, PASSWORD_ARGON2I (membutuhkan PHP >= 7.2.0).

"statistics"
- Lacak statistik penggunaan phpMussel? True = Ya; False = Tidak [Default].

"allow_symlinks"
- Kadang-kadang phpMussel tidak dapat mengakses file secara langsung ketika diberi nama dengan cara tertentu. Mengakses file secara tidak langsung melalui symlink terkadang dapat menyelesaikan masalah ini. Namun, ini tidak selalu merupakan solusi yang layak, karena pada beberapa sistem, menggunakan symlink mungkin dilarang, atau mungkin memerlukan hak administratif. Direktif ini digunakan untuk menentukan apakah phpMussel harus mencoba menggunakan symlink untuk mengakses file secara tidak langsung, ketika mengaksesnya secara langsung tidak mungkin. True = Aktifkan symlink; False = Nonaktifkan symlink [Default].

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

"detect_encryption"
- Harus phpMussel mendeteksi dan memblokir file terenkripsi? False = Tidak; True = Ya [Default].

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

#### "legal" (Kategori)
Konfigurasi yang berkaitan dengan persyaratan hukum.

*Untuk informasi lebih lanjut tentang persyaratan hukum dan bagaimana ini dapat mempengaruhi persyaratan konfigurasi Anda, silahkan lihat bagian "[LEGAL INFORMATION](#SECTION11)" pada dokumentasi.*

"pseudonymise_ip_addresses"
- Pseudonymise alamat IP saat menulis file log? True = Ya; False = Tidak [Default].

"privacy_policy"
- Alamat dari kebijakan privasi yang relevan untuk ditampilkan di footer dari setiap halaman yang dihasilkan. Spesifikasikan URL, atau biarkan kosong untuk menonaktifkan.

#### "template_data" (Kategori)
Direktif-direktif dan variabel-variabel untuk template-template dan tema-tema.

File template berkaitan untuk HTML diproduksi yang digunakan untuk menghasilkan pesan "Upload Ditolak" yang ditampilkan kepada pengguna-pengguna ketika file upload yang diblokir. Jika Anda menggunakan tema kustom untuk phpMussel, HTML diproduksi yang bersumber dari file `template_custom.html`, dan sebaliknya, HTML diproduksi yang bersumber dari file `template.html`. Variabel ditulis untuk file konfigurasi bagian ini yang diurai untuk HTML diproduksi dengan cara mengganti nama-nama variabel dikelilingi dengan kurung keriting ditemukan dalam HTML diproduksi dengan file variabel sesuai. Sebagai contoh, dimana `foo="bar"`, setiap terjadinya `<p>{foo}</p>` ditemukan dalam HTML diproduksi akan menjadi `<p>bar</p>`.

"theme"
- Tema default untuk phpMussel.

"Magnification"
- Perbesaran font. Default = 1.

"css_url"
- File template untuk tema kustom menggunakan properti CSS eksternal, sedangkan file template untuk tema default menggunakan properti CSS internal. Untuk menginstruksikan phpMussel menggunakan file template untuk tema kustom, menentukan alamat HTTP publik file CSS tema kustom Anda menggunakan variable `css_url`. Jika Anda biarkan kosong variabel ini, phpMussel akan menggunakan file template untuk tema default.

---


### 8. <a name="SECTION8"></a>FORMAT TANDA TANGAN

*Lihat juga:*
- *[Apa yang "tanda tangan"?](#WHAT_IS_A_SIGNATURE)*

9 byte pertama `[x0-x8]` dari file tanda tangan phpMussel adalah `phpMussel`, dan Bertindak sebagai "nomor ajaib" (magic number), untuk mengidentifikasi mereka sebagai file tanda tangan (ini membantu mencegah phpMussel secara tidak sengaja mencoba menggunakan file yang bukan file tanda tangan). Byte berikutnya `[x9]` mengidentifikasi jenis file tanda tangan, yang harus diketahui oleh phpMussel agar bisa menafsirkan file tanda tangan dengan benar. Jenis file tanda tangan berikut dikenali:

Tipe | Byte | Deskripsi
---|---|---
`General_Command_Detections` | `0?` | Untuk file tanda tangan CSV (comma separated values). Nilai (tanda tangan) adalah string yang dikodekan heksadesimal untuk dicari dalam file. Tanda tangan disini tidak memiliki nama atau rincian lainnya (hanya string yang bisa dideteksi).
`Filename` | `1?` | Untuk tanda tangan nama file.
`Hash` | `2?` | Untuk tanda tangan hash.
`Standard` | `3?` | Untuk file tanda tangan yang bekerja langsung dengan isi file.
`Standard_RegEx` | `4?` | Untuk file tanda tangan yang bekerja langsung dengan isi file. Tanda tangan dapat berisi ekspresi reguler.
`Normalised` | `5?` | Untuk file tanda tangan yang bekerja dengan isi file yang dibuat menjadi ANSI.
`Normalised_RegEx` | `6?` | Untuk file tanda tangan yang bekerja dengan isi file yang dibuat menjadi ANSI. Tanda tangan dapat berisi ekspresi reguler.
`HTML` | `7?` | Untuk file tanda tangan yang bekerja dengan isi file yang dibuat menjadi HTML.
`HTML_RegEx` | `8?` | Untuk file tanda tangan yang bekerja dengan isi file yang dibuat menjadi HTML. Tanda tangan dapat berisi ekspresi reguler.
`PE_Extended` | `9?` | Untuk file tanda tangan yang bekerja dengan metadata PE (selain metadata seksi PE).
`PE_Sectional` | `A?` | Untuk file tanda tangan yang bekerja dengan metadata seksi PE.
`Complex_Extended` | `B?` | Untuk file tanda tangan yang bekerja dengan berbagai peraturan berdasarkan metadata yang diperluas yang dihasilkan oleh phpMussel.
`URL_Scanner` | `C?` | Untuk file tanda tangan yang bekerja dengan URL.

Byte berikutnya `[x10]` adalah baris baru `[0A]`, dan menyimpulkan header file tanda tangan phpMussel.

Setiap baris yang tidak kosong setelah itu adalah tanda tangan atau peraturan. Setiap tanda tangan atau peraturan menempati satu baris. Format tanda tangan yang didukung dijelaskan di bawah ini.

#### *TANDA TANGAN NAMA FILE*
Semua tanda tangan nama file mengikuti format ini:

`NAMA:FNRX`

Dimana NAMA adalah nama mengutip tanda tangan dan FNRX adalah pola regex untuk mencocokkan nama file (tidak ter-encode).

#### *TANDA TANGAN HASH*
Semua tanda tangan HASH mengikuti format ini:

`HASH:UKURAN:NAMA`

Dimana HASH adalah hash (biasanya MD5) dari keseluruhan file, UKURAN adalah total ukuran file dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN SEKSIONAL PE*
Semua tanda tangan seksional PE mengikuti format ini:

`UKURAN:HASH:NAMA`

Dimana HASH adalah MD5 dari seksi PE, UKURAN adalah total ukuran dari seksi PE dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN DIPERPANJANG PE*
Semua tanda tangan diperpanjang PE mengikuti format ini:

`$VAR:HASH:UKURAN:NAMA`

Dimana $VAR adalah nama dari PE variabel untuk mencocokkan terhadap, HASH adalah MD5 dari variabel, UKURAN adalah ukuran total dari variabel dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

#### *TANDA TANGAN DIPERPANJANG KOMPLEKS*
Tanda tangan diperpanjang kompleks adalah berbeda dengan jenis lain dari tanda tangan phpMussel, melalui bahwa apa yang mencocokkan mereka ditentukan oleh tanda tangan sendiri dan mereka dapat mencocokkan terhadap beberapa kriteria. Kriteria mencocokkan yang dipisahkan oleh ";" dan pencocokan jenis dan pencocokan data masing-masing kriteria yang dipisahkan oleh ":" sebagai sehingga format untuk tanda tangan ini cenderung terlihat sedikit seperti:

`$variabel1:DATA;$variabel:DATA;NamaTandaTangan`

#### *YANG LAIN*
Semua tanda tangan yang lain mengikuti format ini:

`NAMA:HEX:FROM:TO`

Dimana NAMA adalah nama yang mengutip tanda tangan ini dan HEX adalah sebuah segmen heksadesimal-dikodekan dari data yang dimaksudkan untuk dicocokkan oleh tanda tangan yang diberikan. FROM dan TO adalah parameter opsional, mengindikasikan dari mana dan kemana posisi dari sumber file untuk cek.

#### *REGEX (REGULAR EXPRESSIONS)*
Setiap bentuk dari regex mengerti dan dengan benar diproses oleh PHP seharusnya bisa dengan benar dimengerti dan diproses oleh phpMussel dan tanda tangannya. Bagaimanapun, saya menyarankan peringatan ekstrim ketika menuliskan tanda tangan berbasis regex baru karena, jika Anda tidak yakin apa yang Anda lakukan dapat menghasilkan hal yang tidak diinginkan. Coba lihat source-code phpMussel dan jika Anda tidak yakin tentang konteks dari statemen regex diparsing. Juga ingat bahwa semua pola (dengan pengecualian ke nama data, metadata terkompres dan pola MD5) harus diencode heksadesimal (sintaksis pola sebelumnya, tentu saja)!

---


### 9. <a name="SECTION9"></a>MASALAH KOMPATIBILITAS DIKETAHUI

#### PHP dan PCRE
- phpMussel memerlukan PHP dan PCRE untuk mengeksekusi dan berfungsi dengan baik. Tanpa PHP, atau tanpa ekstensi PCRE, phpMussel tidak akan mengeksekusi atau berfungsi dengan baik. Seharusnya memastikan sistem Anda terinstal PHP dan PCRE dan tersedia secara prioritas untuk mengunduh dan menginstal phpMussel.

#### KOMPATIBILITAS SOFTWARE ANTI-VIRUS

Untuk banyak bagian, phpMussel seharusnya kompatibel dengan software pemindaian virus. Bagaimanapun konflik telah dilaporkan oleh penggunak di masa lalu. Informasi di bawah adalah dari virustotal.com, dan menguraikan sejumlah angka positif yang salah yang dilaporkan oleh bermacam-macam program anti-virus pada phpMussel. Walaupun informasi ini bukan jaminan absolut dari apakah Anda mengalami masalah kompatibilitas antara phpMussel dan perangkat anti-virus Anda, jika perangkat lunak anti-virus Anda tercatat berlawanan dengan phpMussel, Anda seharusnya mempertimbangkan menonaktifkannya bekerja dengan phpMussel atau seharusnya mempertimbangkan opsi alternatif ke software anti virus atau phpMussel.

Informasi ini diupdate 2017.12.01 dan cocok untuk semua rilis phpMussel dari dua versi minor terbaru versi (v1.0.0-v1.1.0) pada waktu saya menuliskan ini.

*Informasi ini hanya berlaku untuk paket utama. Hasil dapat bervariasi berdasarkan file tanda tangan yang diinstal, plugin, dan komponen periferal lainnya.*

| Scanner | Hasil |
|---|---|
| AVware | Melaporkan "BPX.Shell.PHP" |
| Bkav | Melaporkan "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>PERTANYAAN YANG SERING DIAJUKAN (FAQ)

- [Apa yang "tanda tangan"?](#WHAT_IS_A_SIGNATURE)
- [Apa yang dimaksud dengan "positif palsu"?](#WHAT_IS_A_FALSE_POSITIVE)
- [Seberapa sering tanda tangan diperbarui?](#SIGNATURE_UPDATE_FREQUENCY)
- [Saya mengalami masalah ketika menggunakan phpMussel dan saya tidak tahu apa saya harus lakukan! Tolong bantu!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Saya ingin menggunakan phpMussel dengan versi PHP yang lebih tua dari 5.4.0; Anda dapat membantu?](#MINIMUM_PHP_VERSION)
- [Dapatkah saya menggunakan satu instalasi phpMussel untuk melindungi beberapa domain?](#PROTECT_MULTIPLE_DOMAINS)
- [Saya tidak ingin membuang waktu dengan menginstal ini dan membuatnya bekerja dengan situs web saya; Bisakah saya membayar Anda untuk melakukan semuanya untuk saya?](#PAY_YOU_TO_DO_IT)
- [Dapatkah saya mempekerjakan Anda atau pengembang proyek ini untuk pekerjaan pribadi?](#HIRE_FOR_PRIVATE_WORK)
- [Saya perlu modifikasi khusus, customisasi, dll; Apakah kamu bisa membantu?](#SPECIALIST_MODIFICATIONS)
- [Saya seorang pengembang, perancang situs web, atau programmer. Dapatkah saya menerima atau menawarkan pekerjaan yang berkaitan dengan proyek ini?](#ACCEPT_OR_OFFER_WORK)
- [Saya ingin berkontribusi pada proyek ini; Dapatkah saya melakukan ini?](#WANT_TO_CONTRIBUTE)
- [Nilai yang disarankan untuk "ipaddr".](#RECOMMENDED_VALUES_FOR_IPADDR)
- [Bagaimana cara mengakses rincian spesifik tentang file saat dipindai?](#SCAN_DEBUGGING)
- [Dapatkah saya menggunakan cron untuk mengupdate secara otomatis?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [Dapatkah phpMussel memindai file dengan nama yang tidak ANSI?](#SCAN_NON_ANSI)
- [Daftar hitam – Daftar putih – Daftar abu-abu – Apa itu mereka, dan bagaimana cara menggunakannya?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>Apa yang "tanda tangan"?

Dalam konteks phpMussel, "tanda tangan" mengacu pada data yang bertindak sebagai indikator/pengenal untuk sesuatu spesifik yang kita cari, biasanya dalam bentuk segmen yang sangat kecil, unik, tidak berbahaya dari sesuatu yang lebih besar dan biasanya, sebaliknya berbahaya, seperti virus atau trojan, atau dalam bentuk file checksum, hash, atau indikator yang mengidentifikasi lainnya, dan biasanya termasuk label, dan beberapa data lainnya, untuk membantu memberikan konteks tambahan yang bisa digunakan oleh phpMussel untuk menentukan cara terbaik untuk melanjutkan ketika menemukan apa yang kita cari.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>Apa yang dimaksud dengan "positif palsu"?

Istilah "positif palsu" (*alternatif: "kesalahan positif palsu"; "alarm palsu"*; Bahasa Inggris: *false positive*; *false positive error*; *false alarm*), dijelaskan dengan sangat sederhana, dan dalam konteks umum, digunakan saat pengujian untuk kondisi, untuk merujuk pada hasil tes, ketika hasilnya positif (yaitu, kondisi adalah dianggap untuk menjadi "positif", atau "benar"), namun diharapkan (atau seharusnya) menjadi negatif (yaitu, kondisi ini, pada kenyataannya, adalah "negatif", atau "palsu"). Sebuah "positif palsu" bisa dianggap analog dengan "menangis serigala" (dimana kondisi dites adalah apakah ada serigala di dekat kawanan, kondisi adalah "palsu" di bahwa tidak ada serigala di dekat kawanan, dan kondisi ini dilaporkan sebagai "positif" oleh gembala dengan cara memanggil "serigala, serigala"), atau analog dengan situasi dalam pengujian medis dimana seorang pasien didiagnosis sebagai memiliki beberapa penyakit, ketika pada kenyataannya, mereka tidak memiliki penyakit tersebut.

Hasil terkait ketika pengujian untuk kondisi dapat digambarkan menggunakan istilah "positif benar", "negatif benar" dan "negatif palsu". Sebuah "positif benar" mengacu pada saat hasil tes dan keadaan sebenarnya dari kondisi adalah keduanya benar (atau "positif"), dan sebuah "negatif benar" mengacu pada saat hasil tes dan keadaan sebenarnya dari kondisi adalah keduanya palsu (atau "negatif"); Sebuah "positif benar" atau "negatif benar" adalah dianggap untuk menjadi sebuah "inferensi benar". Antitesis dari "positif palsu" adalah sebuah "negatif palsu"; Sebuah "negatif palsu" mengacu pada saat hasil tes are negatif (yaitu, kondisi adalah dianggap untuk menjadi "negatif", atau "palsu"), namun diharapkan (atau seharusnya) menjadi positif (yaitu, kondisi ini, pada kenyataannya, adalah "positif", atau "benar").

Dalam konteks phpMussel, istilah-istilah ini mengacu pada tanda tangan dari phpMussel dan file yang mereka memblokir. Ketika phpMussel blok file karena buruk, usang atau salah tanda tangan, tapi seharusnya tidak melakukannya, atau ketika melakukannya untuk alasan salah, kita menyebut acara ini sebuah "positif palsu". Ketika phpMussel gagal untuk memblokir file yang seharusnya diblokir, karena ancaman tak terduga, hilang tanda tangan atau kekurangan dalam tanda tangan nya, kita menyebut acara ini sebuah "deteksi terjawab" atau "missing detection" (ini analog dengan sebuah "negatif palsu").

Ini dapat diringkas dengan tabel di bawah:

&nbsp; | phpMussel seharusnya *TIDAK* memblokir file | phpMussel *SEHARUSNYA* memblokir file
---|---|---
phpMussel *TIDAK* memblokir file | Negatif benar (inferensi benar) | Deteksi terjawab (analog dengan negatif palsu)
phpMussel memblokir file | __Positif palsu__ | Positif benar (inferensi benar)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>Seberapa sering tanda tangan diperbarui?

Frekuensi pembaruan bervariasi tergantung pada file tanda tangan. Semua penulis bagi file tanda tangan phpMussel umumnya mencoba untuk menjaga tanda tangan mereka sebagai diperbarui sebanyak mungkin, tapi karena semua dari kita memiliki komitmen lainnya, kehidupan kita di luar proyek, dan karena kita tidak dikompensasi finansial (yaitu, dibayar) untuk upaya kami pada proyek, jadwal pembaruan yang tepat tidak dapat dijamin. Umumnya, tanda tangan diperbarui ketika ada cukup waktu untuk memperbaruinya, dan umumnya, penulis mencoba untuk memprioritaskan berdasarkan kebutuhan dan frekuensi berbagai perubahan dalam rentang. Bantuan selalu dihargai jika Anda bersedia untuk menawarkan.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>Saya mengalami masalah ketika menggunakan phpMussel dan saya tidak tahu apa saya harus lakukan! Tolong bantu!

- Apakah Anda menggunakan versi terbaru bagi perangkat lunak? Apakah Anda menggunakan versi terbaru bagi file tanda tangan Anda? Jika jawaban untuk salah satu dari dua pertanyaan ini adalah tidak, mencoba untuk memperbarui segala sesuatu pertama, dan memeriksa apakah masalah terus berlanjut. Jika terus berlanjut, lanjutkan membaca.
- Apakah Anda memeriksa semua dokumentasi? Jika tidak, silahkan melakukannya. Jika masalah tidak dapat diselesaikan dengan menggunakan dokumentasi, lanjutkan membaca.
- Apakah Anda memeriksa **[halaman issues](https://github.com/phpMussel/phpMussel/issues)**, untuk melihat apakah masalah telah disebutkan sebelumnya? Jika sudah disebutkan sebelumnya, memeriksa apakah ada saran, ide, dan/atau solusi yang tersedia, dan ikuti sesuai yang diperlukan untuk mencoba untuk menyelesaikan masalah.
- Jika masalah masih berlanjut, silahkan mencari bantuan dengan membuat issue baru di halaman issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Saya ingin menggunakan phpMussel dengan versi PHP yang lebih tua dari 5.4.0; Anda dapat membantu?

Tidak. PHP 5.4.0 mencapai EoL ("End of Life", atau Akhir Hidup) resmi pada tahun 2014, dan dukungan keamanan diperpanjang dihentikan pada tahun 2015. Sebagai menulis ini, itu adalah 2017, dan PHP 7.1.0 sudah tersedia. Pada saat ini, dukungan disediakan untuk menggunakan phpMussel dengan PHP 5.4.0 dan semua tersedia versi PHP yang lebih baru, tapi jika Anda mencoba untuk menggunakan phpMussel dengan versi PHP yang lebih tua, dukungan tidak akan diberikan.

*Lihat juga: [Bagan Kompatibilitas](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Dapatkah saya menggunakan satu instalasi phpMussel untuk melindungi beberapa domain?

Ya. Instalasi phpMussel tidak secara alami terkunci pada domain tertentu, dan dengan demikian dapat digunakan untuk melindungi beberapa domain. Umumnya, kami mengacu pada instalasi phpMussel yang hanya melindungi satu domain as "instalasi domain tunggal" ("single-domain installations"), dan kami mengacu pada instalasi phpMussel yang melindungi beberapa domain dan/atau sub-domain sebagai "instalasi domain beberapa" ("multi-domain installations"). Jika Anda mengoperasikan instalasi domain beberapa dan perlu menggunakan berbagai kumpulan file tanda tangan untuk berbagai domain, atau perlu phpMussel untuk dikonfigurasi secara berbeda untuk domain berbeda, kamu bisa melakukan ini. Setelah memuat file konfigurasi (`config.ini`), phpMussel akan memeriksa adanya "file untuk pengganti konfigurasi" spesifik untuk domain (atau sub-domain) yang diminta (`domain-yang-diminta.tld.config.ini`), dan jika ditemukan, setiap nilai konfigurasi yang ditentukan oleh file untuk pengganti konfigurasi akan digunakan untuk instance eksekusi daripada nilai konfigurasi yang ditentukan oleh file konfigurasi. File untuk pengganti konfigurasi identik dengan file konfigurasi, dan atas kebijaksanaan Anda, dapat berisi keseluruhan semua konfigurasi yang tersedia untuk phpMussel, atau apapun bagian kecil yang dibutuhkan yang berbeda dari nilai yang biasanya ditentukan oleh file konfigurasi. File untuk pengganti konfigurasi diberi nama sesuai dengan domain yang mereka inginkan (jadi, misalnya, jika Anda memerlukan file untuk pengganti konfigurasi untuk domain, `http://www.some-domain.tld/`, file untuk pengganti konfigurasi harus diberi nama sebagai `some-domain.tld.config.ini`, dan harus ditempatkan di dalam vault bersama file konfigurasi, `config.ini`). Nama domain untuk instance eksekusi berasal dari header permintaan `HTTP_HOST`; "www" diabaikan.

#### <a name="PAY_YOU_TO_DO_IT"></a>Saya tidak ingin membuang waktu dengan menginstal ini dan membuatnya bekerja dengan situs web saya; Bisakah saya membayar Anda untuk melakukan semuanya untuk saya?

Mungkin. Ini dipertimbangkan berdasarkan kasus per kasus. Beritahu kami apa yang Anda butuhkan, apa yang Anda tawarkan, dan kami akan memberitahu Anda jika kami dapat membantu.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Dapatkah saya mempekerjakan Anda atau pengembang proyek ini untuk pekerjaan pribadi?

*Lihat di atas.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Saya perlu modifikasi khusus, customisasi, dll; Apakah kamu bisa membantu?

*Lihat di atas.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Saya seorang pengembang, perancang situs web, atau programmer. Dapatkah saya menerima atau menawarkan pekerjaan yang berkaitan dengan proyek ini?

Ya. Lisensi kami tidak melarang hal ini.

#### <a name="WANT_TO_CONTRIBUTE"></a>Saya ingin berkontribusi pada proyek ini; Dapatkah saya melakukan ini?

Ya. Kontribusi untuk proyek ini sangat disambut baik. Silahkan lihat "CONTRIBUTING.md" untuk informasi lebih lanjut.

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>Nilai yang disarankan untuk "ipaddr".

Nilai | Menggunakan
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula reverse proxy.
`HTTP_CF_CONNECTING_IP` | Cloudflare reverse proxy.
`CF-Connecting-IP` | Cloudflare reverse proxy (alternatif; jika di atas tidak bekerja).
`HTTP_X_FORWARDED_FOR` | Cloudbric reverse proxy.
`X-Forwarded-For` | [Squid reverse proxy](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Ditetapkan oleh konfigurasi server.* | [Nginx reverse proxy](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Tidak ada reverse proxy (nilai default).

#### <a name="SCAN_DEBUGGING"></a>Bagaimana cara mengakses rincian spesifik tentang file saat dipindai?

Anda dapat mengakses rincian spesifik tentang file saat dipindai dengan menetapkan array yang akan digunakan untuk tujuan ini sebelum menginstruksikan phpMussel untuk memindai mereka.

Pada contoh di bawah ini, `$Foo` ditugaskan untuk tujuan ini. Setelah memindai `/jalur/file/...`, informasi rinci tentang file yang dalam `/jalur/file/...` akan berada dalam `$Foo`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/jalur/file/...');

var_dump($Foo);
```

Array yang multidimensi dan terdiri dari elemen yang mewakili setiap file yang dipindai dan sub-elemen yang mewakili rincian tentang file-file ini. Sub-elemen ini adalah sebagai berikut:

- Filename (`string`)
- FromCache (`bool`)
- Depth (`int`)
- Size (`int`)
- MD5 (`string`)
- SHA1 (`string`)
- CRC32B (`string`)
- 2CC (`string`)
- 4CC (`string`)
- ScanPhase (`string`)
- Container (`string`)
- † FileSwitch (`string`)
- † Is_ELF (`bool`)
- † Is_Graphics (`bool`)
- † Is_HTML (`bool`)
- † Is_Email (`bool`)
- † Is_MachO (`bool`)
- † Is_PDF (`bool`)
- † Is_SWF (`bool`)
- † Is_PE (`bool`)
- † Is_Not_HTML (`bool`)
- † Is_Not_PHP (`bool`)
- ‡ NumOfSections (`int`)
- ‡ PEFileDescription (`string`)
- ‡ PEFileVersion (`string`)
- ‡ PEProductName (`string`)
- ‡ PEProductVersion (`string`)
- ‡ PECopyright (`string`)
- ‡ PEOriginalFilename (`string`)
- ‡ PECompanyName (`string`)
- Results (`int`)
- Output (`string`)

*† - Tidak disediakan untuk hasil yang di-cache (hanya disediakan untuk hasil scan yang baru).*

*‡ - Hanya disediakan saat memindai file PE.*

Opsional, array ini bisa dihancurkan dengan menggunakan berikut ini:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Dapatkah saya menggunakan cron untuk mengupdate secara otomatis?

Ya. API dibangun dalam bagian depan untuk berinteraksi dengan halaman pembaruan melalui skrip eksternal. Skrip terpisah, "[Cronable](https://github.com/Maikuolan/Cronable)", tersedia, dan dapat digunakan oleh cron manager atau cron scheduler untuk mengupdate paket ini dan paket didukung lainnya secara otomatis (script ini menyediakan dokumentasi sendiri).

#### <a name="SCAN_NON_ANSI"></a>Dapatkah phpMussel memindai file dengan nama yang tidak ANSI?

Misalkanlah ada direktori yang Anda ingin pindai. Di direktori ini, Anda memiliki beberapa file dengan nama non-ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Anggaplah Anda menggunakan mode CLI atau API phpMussel untuk memindai.

Ketika menggunakan PHP < 7.1.0, pada beberapa sistem, phpMussel tidak akan melihat file-file ini ketika mencoba untuk memindai direktori, dan karenanya, tidak akan dapat memindai file-file ini. Anda mungkin akan melihat hasil yang sama seperti jika Anda memindai direktori kosong:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Dimulai.
 Sun, 01 Apr 2018 22:27:41 +0800 Selesai.
```

Juga, ketika menggunakan PHP < 7.1.0, memindai file secara individual menghasilkan hasil seperti ini:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Dimulai.
 > Memeriksa 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> File tidak valid!
 Sun, 01 Apr 2018 22:27:41 +0800 Selesai.
```

Atau ini:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Dimulai.
 > X:/directory/??????.txt bukan file atau direktori.
 Sun, 01 Apr 2018 22:27:41 +0800 Selesai.
```

Ini karena cara PHP menangani nama file non-ANSI sebelum PHP 7.1.0. Jika Anda mengalami masalah ini, solusinya adalah memperbarui instalasi PHP Anda ke 7.1.0 atau yang lebih baru. Di PHP >= 7.1.0, nama file non-ANSI ditangani lebih baik, dan phpMussel harus dapat memindai file dengan benar.

Sebagai perbandingan, hasil ketika mencoba untuk memindai direktori menggunakan PHP >= 7.1.0:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Dimulai.
 -> Memeriksa '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Tidak ada masalah yang diketahui.
 -> Memeriksa '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Tidak ada masalah yang diketahui.
 -> Memeriksa '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Tidak ada masalah yang diketahui.
 Sun, 01 Apr 2018 22:27:41 +0800 Selesai.
```

Dan mencoba memindai file secara individual:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Dimulai.
 > Memeriksa 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Tidak ada masalah yang diketahui.
 Sun, 01 Apr 2018 22:27:41 +0800 Selesai.
```

#### <a name="BLACK_WHITE_GREY"></a>Daftar hitam – Daftar putih – Daftar abu-abu – Apa itu mereka, dan bagaimana cara menggunakannya?

Istilah-istilah ini menyampaikan makna yang berbeda dalam konteks yang berbeda. Di phpMussel, ada tiga konteks dimana istilah-istilah ini digunakan: Respons ukuran file, respons jenis file, dan daftar abu-abu tanda tangan.

Untuk mencapai hasil yang diinginkan dengan biaya minimal untuk diproses, ada beberapa hal sederhana yang dapat diperiksa oleh phpMussel sebelum benar-benar memindai file, seperti ukuran file, nama, dan ekstensi. Sebagai contoh; Jika file terlalu besar, atau jika ekstensi menunjukkan jenis file yang kami tidak ingin izinkan ke situs web kami, kami dapat segera menandai file, dan tidak perlu memindainya.

Respons ukuran file adalah cara phpMussel merespons ketika file melebihi batas yang ditentukan. Meskipun tidak ada daftar terlibat, sebuah file dapat dianggap masuk daftar hitam, masuk daftar putih, atau masuk daftar abu-abu, berdasarkan ukurannya. Dua direktif konfigurasi opsional yang terpisah ada untuk menentukan batas dan respons yang diinginkan masing-masing.

Respons jenis file adalah cara phpMussel merespons ekstensi file. Tiga direktif konfigurasi opsional tersedia untuk secara eksplisit menentukan ekstensi mana yang harus dimasukkan dalam daftar hitam, daftar putih, atau daftar abu-abu. Sebuah file dapat dianggap masuk daftar hitam, masuk daftar putih, atau masuk daftar abu-abu jika ekstensinya cocok dengan salah satu ekstensi yang ditentukan.

Dalam dua konteks ini, menjadi masuk daftar putih berarti tidak boleh dipindai atau ditandai; masuk daftar hitam berarti harus ditandai (dan karena itu tidak perlu memindainya); dan menjadi masuk daftar abu-abu berarti analisis lebih lanjut diperlukan untuk menentukan apakah kita harus menandainya (yaitu, itu harus dipindai).

Daftar abu-abu tanda tangan adalah daftar tanda tangan yang pada dasarnya harus diabaikan (ini secara singkat disebutkan sebelumnya dalam dokumentasi). Ketika tanda tangan di daftar abu-abu tanda tangan dipicu, phpMussel terus bekerja melalui tandatangannya dan tidak mengambil tindakan khusus dalam hal tanda tangan dalam daftar abu-abu. Tidak ada daftar hitam tanda tangan, karena perilaku tersirat adalah perilaku normal untuk tanda tangan yang dipicu, dan tidak ada daftar putih tanda tangan, karena perilaku tersirat tidak akan benar-benar masuk akal dengan pertimbangan bagaimana phpMussel bekerja normal dan kemampuan yang sudah dimiliki.

Daftar abu-abu tanda tangan berguna jika Anda perlu menyelesaikan masalah yang disebabkan oleh tanda tangan tertentu tanpa menonaktifkan atau menghapus seluruh file tanda tangan.

---


### 11. <a name="SECTION11"></a>INFORMASI HUKUM

#### 11.0 SECTION PREAMBLE

This section of the documentation is intended to describe possible legal considerations regarding the use and implementation of the package, and to provide some basic related information. This may be important for some users as a means to ensure compliancy with any legal requirements that may exist in the countries that they operate in, and some users may need to adjust their website policies in accordance with this information.

First and foremost, please realise that I (the package author) am not a lawyer, nor a qualified legal professional of any kind. Therefore, I am not legally qualified to provide legal advice. Also, in some cases, exact legal requirements may vary between different countries and jurisdictions, and these varying legal requirements may sometimes conflict (such as, for example, in the case of countries that favour privacy rights and the right to be forgotten, versus countries that favour extended data retention). Consider also that access to the package is not restricted to specific countries or jurisdictions, and therefore, the package userbase is likely to the geographically diverse. These points considered, I'm not in a position to state what it means to be "legally compliant" for all users, in all regards. However, I hope that the information herein will help you to come to a decision yourself regarding what you must do in order to remain legally compliant in the context of the package. If you have any doubts or concerns regarding the information herein, or if you need additional help and advice from a legal perspective, I would recommend consulting a qualified legal professional.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Relevant configuration directives:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Relevant configuration directives:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevant configuration directives:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 LOGGING

Logging is an important part of phpMussel for a number of reasons. Without logging, it may be difficult to diagnose false positives, to ascertain exactly how performant phpMussel is in any particular context, and to determine where its shortfalls may be, and what changes may be required to its configuration or signatures accordingly, in order for it to continue functioning as intended. Regardless, logging mightn't be desirable for all users, and remains entirely optional. In phpMussel, logging is disabled by default. To enable it, phpMussel must be configured accordingly.

Additionally, whether logging is legally permissible, and to the extent that it is legally permissible (e.g., the types of information that may logged, for how long, and under what circumstances), may vary, depending on jurisdiction and on the context where phpMussel is implemented (e.g., whether you're operating as an individual, as a corporate entity, and whether on a commercial or non-commercial basis). It may therefore be useful for you to read through this section carefully.

There are multiple types of logging that phpMussel can perform. Different types of logging involves different types of information, for different reasons.

##### 11.3.0 SCAN LOGS

When enabled in the package configuration, phpMussel keeps logs of the files it scans. This type of logging is available in two different formats:
- Human readable logfiles.
- Serialised logfiles.

Entries to a human readable logfile typically look something like this (as an example):

```
Mon, 21 May 2018 00:47:58 +0800 Started.
> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Detected phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Finished.
```

A scan log entry typically includes the following information:
- The date and time that the file was scanned.
- The name of the file scanned.
- CRC32b hashes of the name and contents of the file.
- What was detected in the file (if anything was detected).

*Relevant configuration directives:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

When these directives are left empty, this type of logging will remain disabled.

##### 11.3.1 SCAN KILLS

When enabled in the package configuration, phpMussel keeps logs of the uploads that have been blocked.

Entries to a "scan kills" logfile typically look something like this (as an example):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Detected phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Quarantined as "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu".
```

A "scan kills" entry typically includes the following information:
- The date and time that the upload was blocked.
- The IP address where the upload originated from.
- The reason why the file was blocked (what was detected).
- The name of the file blocked.
- An MD5 and the size of the file blocked.
- Whether the file was quarantined, and under what internal name.

*Relevant configuration directives:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Relevant configuration directives:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Relevant configuration directives:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Relevant configuration directives:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Relevant configuration directives:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Relevant configuration directives:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Relevant configuration directives:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Relevant configuration directives:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

The General Data Protection Regulation (GDPR) is a regulation of the European Union, which comes into effect as of May 25, 2018. The primary goal of the regulation is to give control to EU citizens and residents regarding their own personal data, and to unify regulation within the EU concerning privacy and personal data.

The regulation contains specific provisions pertaining to the processing of "personally identifiable information" (PII) of any "data subjects" (any identified or identifiable natural person) either from or within the EU. To be compliant with the regulation, "enterprises" (as per defined by the regulation), and any relevant systems and processes must implement "privacy by design" by default, must use the highest possible privacy settings, must implement necessary safeguards for any stored or processed information (including, but not limited to, the implementation of pseudonymisation or full anonymisation of data), must clearly and unambiguously declare the types of data they collect, how they process it, for what reasons, for how long they retain it, and whether they share this data with any third parties, the types of data shared with third parties, how, why, and so on.

Data may not be processed unless there's a lawful basis for doing so, as per defined by the regulation. Generally, this means that in order to process a data subject's data on a lawful basis, it must be done in compliance with legal obligations, or done only after explicit, well-informed, unambiguous consent has been obtained from the data subject.

Because aspects of the regulation may evolve in time, in order to avoid the propagation of outdated information, it may be better to learn about the regulation from an authoritative source, as opposed to simply including the relevant information here in the package documentation (which may eventually become outdated as the regulation evolves).

[EUR-Lex](https://eur-lex.europa.eu/) (a part of the official website of the European Union that provides information about EU law) provides extensive information about GDPR/DSGVO, available in 24 different languages (at the time of writing this), and available for download in PDF format. I would definitely recommend reading the information that they provide, in order to learn more about GDPR/DSGVO:
- [REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679)

Alternatively, there's a brief (non-authoritative) overview of GDPR/DSGVO available at Wikipedia:
- [General Data Protection Regulation](https://en.wikipedia.org/wiki/General_Data_Protection_Regulation)

---


Terakhir Diperbarui: 25 Mei 2018 (2018.05.25).
