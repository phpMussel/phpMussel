      _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

                        { ~ ~ ~ BAHASA INDONESIA ~ ~ ~ }
 ISI
 1. SEPATAH KATA
 2A. BAGAIMANA CARA MENGINSTALL (UNTUK SERVER WEB)
 2B. BAGAIMANA CARA MENGINSTALL (UNTUK CLI)
 3A. BAGAIMANA CARA MENGGUNAKAN (UNTUK SERVER WEB)
 3B. BAGAIMANA CARA MENGGUNAKAN (UNTUK CLI)
 4A. PERINTAH-PERINTAH BROWSER
 4B. CLI (COMMAND LINE INTERFACE)
 5. DATA YANG DIIKUTKAN DALAM PAKET INI
 6. OPSI KONFIGURASI
 7. FORMAT TANDA TANGAN
 8. MASALAH KOMPATIBILITAS DIKETAHUI

                                     ~ ~ ~


 1. SEPATAH KATA

 Terima kasih untuk menggunakan phpMussel, sebuah skrip PHP di-design untuk
 mendeteksi trojan-trojan, virus-virus dan serangan-serangan lainnya dalam
 file-file diupload ke sistem Anda dimana saja skrip di kaitkan, berdasarkan
 tanda tangan dari ClamAV dan lain-lain.

 PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPLv2 oleh Caleb M (Maikuolan).

 Skrip ini adalah perangkat lunak gratis; Anda dapat mendistribusikan kembali
 dan/atau memodifikasinya dalam batasan dari GNU General Public License,
 seperti di publikasikan dari Free Software Foundation; baik versi 2 dari
 License, atau (dalam opsi Anda) versi selanjutnya apapun. Skrip ini
 didistribusikan untuk harapan dapat digunakan tapi TANPA JAMINAN; tanpa
 walaupun garansi dari DIPERJUALBELIKAN atau KECOCOKAN UNTUK TUJUAN TERTENTU.
 Mohon Lihat GNU General Public Licence untuk lebih detail, terletak di
 "LICENCE" file dalam "_docs" direktori dari paket terkait dan repositori untuk
 file ini dan tersedia juga dari:
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>.

 Terima kasih khususnya untuk ClamAV buat inspirasi project dan tanda tangan
 dimana skrip ini menggunakan ClamAV, tanpa nya skrip ini tidak akan ada,
 atau akan mengalami nilai yang kurang baik <http://www.clamav.net/>.

 Khusus terima kasih kepada Sourceforge dan GitHub untuk menghost file proyek,
 kepada Spambot Security untuk menghost forum diskusi phpMussel, terletak di
 <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, dan kepada
 sumber-sumber tambahan tanda tangan dimanfaatkan oleh phpMussel:
 SecuriteInfo.com <http://www.securiteinfo.com/>, PhishTank
 <http://www.phishtank.com/>, NLNetLabs <http://nlnetlabs.nl/> dan lain-lain,
 dan khusus terima kasih kepada semua orang yang mendukung proyek, kepada orang
 lain bahwa saya mungkin telah dinyatakan lupa untuk menyebutkan, dan kepada
 Anda, untuk menggunakan skrip.

 Dokumen ini dan paket terhubung di dalamnya dapat di unduh secara gratis dari:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~


 2A. BAGAIMANA CARA MENGINSTALL (UNTUK SERVER WEB)

 Saya berharap untuk mempersingkat proses ini dengan membuat sebuah installer
 pada beberapa point di dalam masa depan yang tidak terlalu jauh, tapi
 kemudian, ikuti instruksi-instruksi ini untuk mendapatkan phpMussel bekerja
 pada *banyak sistem dan CMS:

 1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh dan menyimpan copy
    dari skrip, membuka data terkompres dan isinya dan Anda meletakkannya pada
    mesin komputer lokal Anda. Dari sini, Anda akan latihan dimana di host Anda
    atau CMS Anda untuk meletakkan isi data terkompres nya. Sebuah direktori
    seperti /public_html/phpmussel/ atau yang lain (walaupun tidak masalah Anda
    memilih direktori apa, selama dia aman dan dimana pun yang Anda senangi)
    akan mencukupi. Sebelum Anda mulai upload, mohon baca dulu..

 2) Secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman
    lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), buka
    "phpmussel.ini" (berada di dalam "vault") - File ini berisikan semua opsi
    operasional yang tersedia untuk phpMussel. Di atas tiap opsi seharusnya ada
    komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa. Atur
    opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk
    setup tertentu. Simpan data, tutup.

 3) Upload isi (phpMussel dan file-filenya) ke direktori yang telah kamu
    putuskan sebelumnya (Anda tidak memerlukan file-file *.txt/*.md, tapi
    kebanyakan Anda harus mengupload semuanya).

 4) Gunakan perinta CHMOD ke direktori "vault" dengan "777". Direktori utama
    menyimpan isinya (yang Anda putuskan sebelumnya), umumnya dapat di biarkan
    sendirian, tapi status perintah "CHMOD" seharusnya di cek jika kamu punya
    izin di sistem Anda (defaultnya, seperti "755").

 5) Selanjutnya Anda perlu menghubungkan phpMussel ke sistem atau CMS. Ada
    beberapa cara yang berbeda untuk menghubungkan skrip seperti phpMussel ke
    sistem atau CMS, tetapi yang paling mudah adalah memasukkan skrip pada
    permulaan dari data murni dari sistem atau CMS (satu yang akan secara umum
    di muat ketika seseorang mengakses halaman apapun pada website) berdasarkan
    perintah "require()" atau include(). Umumnya, ini akan menjadi sesuatu yang
    disimpan di sebuah direktori seperti "/includes", "/asset" atau
    "/functions" dan akan selalu di namai sesuatu seperti "init.php",
    "common_functions.php","functions.php" atau yang sama. Anda harus bekerja
    pada data apa untuk situasi ini; Jika Anda mengalami kesulitan dalam
    menentukan ini untuk diri sendiri, kunjungi forum dukungan phpMussel dan
    biarkan kami tahu; Ada kemungkinan bahwa saya sendiri atau pengguna lain
    mungkin memiliki pengalaman dengan CMS yang Anda gunakan (Anda harus
    memberitahu kami tahu mana CMS yang Anda gunakan), dan demikian, mungkin
    dapat memberikan beberapa bantuan kepada Anda. Untuk melakukannya
    [menggunakan "require()" atau "include()"], sisipkan baris kode dibawah
    pada data murni, menggantikan kata-kata berisikan didalam tanda kutip dari
    alamat data "phpmussel.php" (alamat lokal, tidak alamat HTTP; Akan terlihat
    seperti alamat vault yang di bicarakan sebelumnya.

    <?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>

    Simpan data dan tutup. Upload kembali.

    -- ATAU ALTERNATIF --

    Jika Anda menggunakan webserver Apache dan jika Anda memiliki akses ke
    "php.ini", Anda dapat menggunakan "auto_prepend_file" direktif untuk
    tambahkan phpMussel setiap kali ada permintaan PHP dibuat. Sesuatu
    seperti:

    auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"

    Atau ini di file ".htaccess":

    php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"

 6) Pada titik ini, kamu telah selesai! Bagaimanapun, kamu mungkin seharusnya
    mencobanya untuk melihat dia bekerja dengan dengan baik. Untuk mencoba data
    keamanan upload, coba mengupload file-file testing yang dimasukkan dalam
    paket di "_testfiles" ke website Anda melalui metode upload di browser
    Anda. Jika semua bekerja dengan baik, sebuah pesan akan muncul dari
    phpMussel mengkonfirmasikan bahwa upload sudah sukses di blok. Jika tidak
    ada yang terjadi, ada sesuatu yang tidak bekerja dengan baik. Jika Anda
    menggunakan fitur-fitur lanjut atau jika Anda menggunakan tipe-tipe yang
    lain untuk memeriksa mungkin dengan alat-alat itu, saya sarankan mencoba
    dengan nya untuk memastikan dia bekerja seperti yang diharapkan juga.

                                     ~ ~ ~


 2B. BAGAIMANA CARA MENGINSTALL (UNTUK CLI)

 Saya berharap untuk mempersingkat proses ini dengan membuat sebuah installer
 dari beberapa poin di dalam masa depan yang tidak terlalu jauh, tapi sampai
 kemudian, turuti instruksi ini untuk membuat phpMussel siap bekerja dengan CLI
 (mohon diingat untuk poin ini, CLI mendukung hanya pada sistem berbasis
 Windows; Linux dan sistem-sistem yang lain akan di persiapkan pada versi
 selanjutnya dari phpMussel):

 1) Dengan membaca ini, Saya asumsikan Anda telah mengunduh data terkompres nya
    dan menguraikan isi nya pada mesin komputer lokal Anda. Setelah Anda telah
    memilih lokasi dari phpMussel, lanjutkan.

 2) phpMussel memerlukan PHP untuk diinstall pada mesin host untuk
    mengeksekusinya. Jika Anda tidak memiliki PHP pada mesin Anda, ikuti
    instruksi yang di supply oleh installer php.

 3) Secara fakultatif (sangat direkomendasikan untuk user dengan pengalaman
    lebih lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman), buka
    "phpmussel.ini" (berada di dalam "vault") - File ini berisikan semua opsi
    operasional yang tersedia untuk phpMussel. Di atas tiap opsi seharusnya ada
    komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa. Atur
    opsi-opsi ini seperti Anda lihat cocok, seperti apapun yang cocok untuk
    setup tertentu. Simpan data, tutup.

 4) Secara fakultatif, Anda dapat menggunakan phpMussel di dalam mode CLI untuk
    diri Anda sendiri dengan menciptakan file batch untuk secara automatis
    memuat PHP dan phpMussel. Untuk melakukannya, buka sebuah text editor
    kosong seperti Notepad atau Notepad++, ketikkan jalur dari data "php.exe"
    di dalam direktori dari instalasi PHP Anda, diikuti spasi, diikuti dengan
    jalur lengkap dari data "phpmussel.php" di dalam direktori dari instalasi
    phpMussel, simpan data dengan ekstensi ".bat" di simpan di tempat yang Anda
    mudah temukan dan klik dua kali pada data itu untuk menjalankan phpMussel
    di masa yang akan datang.

 5) Pada titik ini, Anda selesai! Bagaimanapun Anda seharusnya mencobanya untuk
    memastikan berjalan dengan lancar. Untuk mencek phpMussel, jalankan
    phpMussel dan coba memindai "_testfiles" direktori yang disediakan dengan
    ini paket.

                                     ~ ~ ~


 3A. BAGAIMANA CARA MENGGUNAKAN (UNTUK SERVER WEB)

 phpMussel dimaksudkan sebagai sebuah skrip yang akan berfungsi dengan baik
 dengan keperluan yang minimum dari sisi Anda: Sekali dia telah terinstall,
 pada dasarnya, dia seharusnya bekerja.

 Memindai upload data secara automatis dan di mungkinkan secara default, jadi
 tidak ada yang diharuskan pada Anda untuk fungsi ini.

 Bagaimanapun, Anda juga bisa menginstruksikan phpMussel untuk memindai file,
 direktori dan/atau arsip spesifik. Untuk melakukannya, pertama-tama Anda harus
 memastikan konfigurasi yang cocok diset di data `phpmussel.ini` (cleanup harus
 dinon aktifkan) dan ketika selesai, di sebuah data PHP yang di hubungkan ke
 phpMussel, gunakan fungsi berikut pada kode Anda:

 phpMussel($what_to_scan,$output_type,$output_flatness);

 - $what_to_scan dapat berupa string, array, atau array mengandung array-array,
   mengindikasikan apa file, file-file, direktori dan/atau direktori-direktori
   untuk memindai.

 - $output_type adalah boolean, mengindikasikan format untuk hasil pemindaian
   untuk dikembalikan sebagai. False/Palsu menginstruksikan fungsi untuk
   mengembalikan hasil sebagai integer (sebuah hasil dari -3 mengindikasikan
   masalah adalah ditemui dengan file tanda tangan phpMussel atau file
   memetakan tanda tangan dan mereka mungkin hilang atau rusak, -2
   mengindikasikan bahwa data korup terdeteksi selama proses memindai dan
   proses memindai gagal selesai, -1 mengindikasikan bawa ekstensi atau addon
   yang dibutuhkan oleh PHP untuk mengeksekusi pemindaian hilang dan demikian
   gagal selesai, 0 mengindikasikan bahwa pemindaian target tidak ada dan tidak
   ada yang dipindai 1 mengindikasikan bahwa target sukses dipindai dan tidak
   ada masalah terdeteksi, dan 2 mengindikasikan target sukses di scan namun
   ada masalah terdeteksi). True/Benar menginstruksikan fungsi untuk
   mengembalikan hasil sebagai teks yang dapat dibaca manusia. Tambahan, dalam
   kedua kasus, hasilnya dapat diakses melalui variabel global setelah memindai
   selesai. Variabel ini adalah opsional, default ke false/palsu.

 - $output_flatness adalah boolean, mengindikasikan ke fungsi apakah akan
   mengembalikan hasil pemindaian (ketika ada beberapa target pemindaian)
   sebagai array atau string. False/Palsu akan mengembalikan hasil sebagai
   array. True/Benar akan mengembalikan hasil sebagai string. Variabel ini
   adalah opsional, default ke false/palsu.

 Contoh:

   $results=phpMussel('/user_name/public_html/my_file.html',true,true);
   echo $results;

   Menghasilkan seperti ini (sebagai kata-kata):
    Wed, 16 Sep 2013 02:49:46 +0000 Dimulai.
    > Memeriksa '/user_name/public_html/my_file.html':
    -> Tidak ada masalah yang diketahui.
    Wed, 16 Sep 2013 02:49:47 +0000 Selesai.

 Untuk sebuah pemecahan penuh dari jenis tanda tangan phpMussel yang digunakan
 selama pemindaian dan bagaimana dia memegang tanda tangan-tanda tangan ini,
 mencocokkan ke format tanda tangan dari data README.

 Jika Anda menjumpai bilangan positif yang salah, jika Anda menemukan hal baru
 yang harus di blok atau untuk apapun dalam tanda tangan mohon hubungi saya
 mengenainya sehingga saya dapat membuat perubahan yang perlu, dimana, jika
 Anda tidak menghubungi saya saya tidak tahu.

 Untuk menonaktifkan tanda tangan-tanda tangan yang dimasukkan dalam phpMussel
 (seperti jika Anda berpengalaman sebuah angka positif yang salah untuk tujuan
 Anda yang seharusnya secara normal di hapus dari aliran), mencocokkan ke
 catatan berwarna abu-abu didalam perintah browser dari data README.

 Sebagai tambahan dari data default mengupload pemindaian dan pemindaian
 opsional dari file-file dan/atau direktori lain yang dispesifikasikan melalui
 fungsi di atas, termasuk di dalam phpMussel adalah sebuah fungsi yang
 dimaksudkan untuk memindai body dari pesan email. Fungsi ini berlaku sama
 dengan standard fungsi phpMussel(), tetapi satu-satunya berfokus untuk
 mencocokkan pada tanda tangan ClamAV. Saya belum mengikat tanda tangan-tanda
 tangan ini ke dalam standard fungsi phpMussel(), karena sepertinya tidak akan
 pernah Anda menemukan body dari pesan email masuk untuk pemindaian di dalam
 sebuah data upload yang ditargetkan untuk sebuah halaman dimana phpMussel
 dihubungkan, dan kemudian untuk mengikat tanda tangan ini ke dalam fungsi
 phpMussel yang akan redundan. Bagaimanapun seperti dibicarakan memiliki
 sebuah fungsi terpisa untuk mencocokkan dengan tanda tangan ini dapat
 membuktikan sangat berguna untuk beberapa, khususnya untuk CMS atau sistem
 webfront yang diikatkan ke sistem email dan untuk ke mereka yang memparsing
 email mereka melalui skrip PHP dari mana mereka dapat dengan potensial
 dikaitkan dengan phpMussel. Konfigurasi untuk fungsi ini, seperti yang lain,
 di atur melalui data "phpmussel.ini". Untuk menggunakan fungsi ini (Anda akan
 memerlukan untuk melakukan implementasi Anda sendiri), di dalam sebuah data
 PHP yang di kaitkan ke phpMussel, gunakan fungsi ini di dalam kode:

 phpMussel_mail($body);

 Dimana $body adalah body dari pesan email yang Anda ingin scan (sebagai
 tambahan Anda dapat mencoba memindai post forum terbaru, pesan masuk dari form
 kontak online atau sejenisnya). Jika ada error terjadi mencegah fungsi ini
 selesai memindai, nilai -1 akan dihasilkan. Jika fungsi selesai memindai dan
 tidak cocok dengan apapun, nilai 0 akan dikembalikan (berarti bersih). Jika,
 bagaimanapun fungsi tidak cocok dengan apapun, sebuah string akan dihasilkan
 berisikan sebuah pesan mendeklarasikan apa yang dicocokkannya.

 Sebagai tambahan, jika Anda melihat kode, Anda dapat melihat fungsi
 phpMusselD() dan phpMusselR(). Fungsi-fungsi ini adalah sub fungsi dari
 phpMussel(), dan seharusnya tidak di namakan secara langsung di luar dari
 fungsi parent (tidak karena efek-efek adverse.. Lebih lagi, sederhananya
 karena dia melayani tanpa tujuan dan kebanyakan kemungkinan tidak bekerja
 dengan baik).

 Ada banyak kontrol-kontrol dan fungsi-fungsi tersedia di dalam phpMussel untuk
 penggunaan Anda juga. Untuk kontrol-kontrol dan fungsi-fungsi yang dalam akhir
 seksi README yang belum didokumentasikan mohon teruskan membaca dan merefer
 dari perintah seksi Browser dari data README.

                                     ~ ~ ~


 3B. BAGAIMANA CARA MENGGUNAKAN (UNTUK CLI)

 Mohon merujuk pada seksi "BAGAIMANA CARA MENGINSTALL (UNTUK CLI)" dari data
 readme.

 Mohon diingat, walaupun versi selanjutnya dari phpMussel seharusnya mendukung
 sistem yang lain, pada waktu ini, mode pendukung phpMussel CLI hanya di
 optimisasi untuk sistem berbasis Windows (anda dapat, tentu saja, mencoba
 pada sistem yang lain, tapi saya tidak dapat menjamin dapat bekerja seperti
 bagaimana seharusnya).

 Mohon diingat bahwa phpMussel tidak sama dengan anti virus dan tidak seperti
 anti virus, tidak memonitor memori aktif atau mendeteksi virus secara
 langsung. phpMussel Hanya mendeteksi virus dalam file-file yang Anda
 perintahkan untuk dipindai.

                                     ~ ~ ~


 4A. PERINTAH-PERINTAH BROWSER

 Sekali phpMussel telah diinstal dan dengan benar berfungsi pada sistem Anda,
 jika Anda telah menset variabel script_password dan logs_password di dalam
 data konfigurasi Anda, Anda akan dapat melakukan sejumlah fungsi administratif
 dan memasukkan beberapa perintah ke phpMussel melalui browser Anda. Alasannya
 sandi-sandi harus diset untuk memungkinkan kontrol-kontrol dari sisi browser
 adalah untuk meyakinkan keamanan yang teratur, perlindungan teratur dari
 kontrol dari sisi browser dan memastikan bahwa ada cara untuk kontrol-kontrol
 untuk semuanya dinonaktifkan jika tidak diinginkan oleh Anda dan/atau
 webmaster/administrator menggunakan melalui phpMussel. Jadi dengan kata lain,
 untuk memungkinkan kontrol-kontrol ini, menset sandi dan menonaktifkan
 kontrol-kontrol ini, set tidak ada password. Alternatif lain, jika Anda
 memilih memungkinkan kontrol-kontrol ini dan kemudian memilih untuk
 menonaktifkan kontrol ini pada hari yang lain, ada perintah untuk melakukan
 ini (yang mana yang berguna jika Anda melakukan beberapa aksi yang Anda rasa
 dapat secara potensial berkompromi dengan password terdelegasi dan perlu untuk
 dengan cepat menonaktifkan kontrol-kontrol ini tanpa memodifikasi data
 konfigurasi Anda).

 Beberapa alasan mengapa Anda -seharusnya- mengaktifkan kontrol-kontrol ini:
 - Menyediakan jalan untuk mewarnai biru tanda tangan secara langsung di dalam
   instansi-instansi seperti ketika Anda menemukan sebuah tanda tangan yang
   memproduksi sebuah angka positif yang salah selama mengupload file ke sistem
   Anda dan Anda tidak punya waktu untuk secara manual mengedit dan mengupload
   ulang data daftar abu-abu Anda.
 - Menyediakan sebuah jalan untuk Anda mengizinkan seseorang lain dari Anda
   untuk mengatur kopi dari phpMussel tanpa keperluan implisit untuk memberi
   hak akses ke FTP.
 - Menyediakan sebuah cara untuk menyediakan akses terkontrol ke data log Anda.
 - Menyediakan cara yang mudah untuk mengubah phpMussel ketika update tersedia.
 - Menyediakan cara untuk Anda untuk memonitor phpMussel ketika FTP akses atau
   akses poin konvensional untuk memonitor phpMussel tidak tersedia.

 Beberapa alasan mengapa Anda seharusnya -tidak- mengaktifkan kontrol-kontrol
 ini:
 - Menyediakan sebuah vektor untuk penyerang potensial dan tidak diharapkan
   untuk menentukan apakah Anda menggunakan phpMussel atau tidak (walaupun,
   ini dapat menjadi alasan mengapa atau alasan perdebatan, bergantung pada
   perspektif) dengan cara buta mengirim perintah ke server dalam penyelidikan.
   Dalam cara lain, ini dapat menghalangi penyerang dari menargetkan sistem
   Anda jika mereka belajar bahwa Anda menggunakan phpMussel, asumsi jika
   mereka menyelidiki karena serangan mereka dialirkan tidak efektif karena
   menggunakan phpMussel. Bagaimanapun, pada cara lain, jika beberapa tidak
   terlihat dan eksploitasi yang tidak diketahui di dalam phpMussel atau versi
   selanjutnya akan ada cahaya, dan jika dapat secara potensial menyediakan
   sebuah vektor serangan, sebuah hasil positif dari penyelidikan dapat
   mendorong penyerang menargetkan sistem Anda.
 - Jika sandi delegasi Anda pernah dikompromikan atau diubah dapat menyediakan
   sebuah cara untuk penyerang membypass tanda tangan apapun mungkin jika tidak
   secara normal menghindari serangan mereka dari kesuksesan, atau juga secara
   potensial menonaktifkan phpMussel bersamaan, juga menyediakan sebuah cara
   untuk mengalirkan keefektifan dari phpMussel yang dibicarakan.

 Cara lain, tanpa bergantung dengan apa yang Anda pilih, pilihan adalah milik
 Anda. Secara default, kontrol-kontrol ini akan dinonaktifkan, tapi harus
 berpikir tentang nya, dan jika Anda memutuskan untuk menginginkannya, seksi
 ini akan menjelaskan tentang cara mengaktifkan dan menggunakannya.

 Daftar dari perintah-perintah dari sisi browser:

 scan_log
   Sandi diharuskan: logs_password
   Keperluan lain: scan_log harus didefinisikan.
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Apa yang dilakukannya: Mencetak isi dari data scan_log ke layar.
   ~
 scan_kills
   Sandi diharuskan: logs_password
   Keperluan lain: scan_kills harus didefinisikan.
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Apa yang dilakukannya: Mencetak isi dari data scan_kills ke layar.
   ~
 controls_lockout
   Sandi diharuskan: logs_password ATAU script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Contoh 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Apa yang dilakukannya: Menonaktifkan ("Mengunci") semua kontrol dari sisi
                          browser. Ini seharusnya digunakan jika Anda menyangka
                          bahwa sandi-dandi telah dikompromikan (ini dapat
                          terjadi jika Anda sedang menggunakan kontrol-kontrol
                          ini dari sebuah komputer yang tidak aman dan/atau
                          tidak terpercaya). controls_lockout bekerja dengan
                          menciptakan sebuah file, "controls.lck", di dalam
                          vault Anda, yang mana phpMussel akan mencek sebelum
                          melakukan perintah-perintah apapun. Setelah ini
                          terjadi, untuk kembali mengaktifkan kontrol-kontrol,
                          Anda akan memerlukan untuk menghapus data
                          "controls.lck" via FTP atau sejenisnya. Dapat
                          dipanggil melalui sandi.
   ~
 disable
   Sandi diharuskan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=disable
   ~
   Apa yang dilakukannya: Menonaktifkan phpMussel. Ini harusnya digunakan jika
                          Anda melakukan update apapun atau perubahan ke sistem
                          Anda atau jika Anda menginstall software baru apapun
                          atau modul ke sistem yang melakukan atau secara
                          potensial dapat menyebabkan angka positif salah. Ini
                          harusnya juga digunakan jika Anda memiliki
                          masalah-masalah dengan phpMussel tapi tidak ingin
                          menghapusnya dari sistem. Sekali ini terjadi aktifkan
                          kembali phpMussel, gunakan "enable".
   ~
 enable
   Sandi diharuskan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=enable
   ~
   Apa yang dilakukannya: Mengaktifkan phpMussel. Ini dapat digunakan jika Anda
                          sebelumnya menonaktifkan phpMussel menggunakan
                          "disable" dan ingin mengaktifkannya lagi.
   ~
 update
   Sandi diharuskan: script_password
   Keperluan lain: "update.dat" dan "update.inc" harus ada.
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=update
   ~
   Apa yang dilakukannya: Cek untuk mengupdate ke phpMussel dan tanda
                          tangannya. Jika update cek sukses dan update
                          ditemukan, akan berusaha mendownload dan menginstall
                          update-update ini. Jika update cek gagal, update akan
                          berhenti. Hasil-hasil dari keseluruhan proses akan di
                          cetak ke layar. Saya rekomendasikan mencek setidaknya
                          satu per bulan untuk memastikan tanda tangan Anda dan
                          kopi dari phpMussel Anda yang terkini (kecuali jika,
                          tentu saja Anda mencek update dan menginstall secara
                          manual, yang, saya masih merekomendasikan
                          melakukannya setidaknya satu per bulan). Mencek lebih
                          dari 2 per bulan kemungkinan tidak bertujuan,
                          mengingat bahwa saya mungkin tidak sangat bisa
                          memproduksi update lebih sering dari itu (walaupun
                          saya khususnya ingin melakukannya).
   ~
 greylist
   Sandi diharuskan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: [Tanda tangan nama menjadi bertanda
                                        abu-abu]
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist&musselvar=[TandaTangan]
   ~
   Apa yang dilakukannya: Menambah tanda tangan pada daftar abu-abu.
   ~
 greylist_clear
   Sandi diharuskan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Apa yang dilakukannya: Membersihkan keseluruhan daftar abu-abu.
   ~
 greylist_show
   Sandi diharuskan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diharuskan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Apa yang dilakukannya: Mencetak isi dari daftar abu-abu ke layar.
   ~

                                     ~ ~ ~


 4B. CLI (COMMAND LINE INTERFACE)

 phpMussel dapat dijalankan sebagai sebuah data interaktif pemindai dalam mode
 CLI dalam Windows. Merujuk ke seksi "BAGAIMANA CARA MENGINSTALL (UNTUK CLI)"
 dari data readme untuk lebih detail.

 Untuk daftar yang tersedia CLI perintah, pada prompt CLI, ketik 'c', dan tekan
 Enter.

                                     ~ ~ ~


 5. DATA YANG DIIKUTKAN DALAM PAKET INI

 Berikut list dari semua data yang diikutkan di dalam kopi skrip yang dikompres
 ketika Anda mendownloadnya, setiap file-file yang secara potensial diciptakan
 sebagai hasil dari menggunakan skrip ini, sejalan dengan deskripsi singkat
 dari untuk apa file-file ini.

 /phpmussel.php (Skrip, Diikutkan)
    data pemuat phpMussel. Memuat skrip utama, pengupdate, dll.
    Ini yang apa Anda ingin masukkan (utama)!
    ~
 /web.config (Lainnya, Diikutkan)
    Sebuah data konfigurasi ASP.NET (dalam instansi ini, untuk melindungi
    direktori "/vault" dari pengaksesan oleh sumber-sumber tidak terauthorisasi
    dalam kejadian yang mana skrip ini diinstal pada server berbasis teknologi
    ASP.NET).
    ~
 /_docs/ (Direktori)
    Direktori dokumentasi (berisi bermacam data).
    ~
 /_docs/change_log.txt (Dokumentasi, Diikutkan)
    Sebuah rekaman dari perubahan yang dibuat pada skrip ini di antara
    perbedaan versi (tidak dibutuhkan untuk fungsi teratur dari skrip).
    ~
 /_docs/readme.de.md (Dokumentasi, Diikutkan); DEUTSCH
 /_docs/readme.de.txt (Dokumentasi, Diikutkan); DEUTSCH
 /_docs/readme.en.md (Dokumentasi, Diikutkan); ENGLISH
 /_docs/readme.en.txt (Dokumentasi, Diikutkan); ENGLISH
 /_docs/readme.es.md (Dokumentasi, Diikutkan); ESPAÑOL
 /_docs/readme.es.txt (Dokumentasi, Diikutkan); ESPAÑOL
 /_docs/readme.fr.md (Dokumentasi, Diikutkan); FRANÇAIS
 /_docs/readme.fr.txt (Dokumentasi, Diikutkan); FRANÇAIS
 /_docs/readme.id.md (Dokumentasi, Diikutkan); BAHASA INDONESIA
 /_docs/readme.id.txt (Dokumentasi, Diikutkan); BAHASA INDONESIA
 /_docs/readme.it.md (Dokumentasi, Diikutkan); ITALIANO
 /_docs/readme.it.txt (Dokumentasi, Diikutkan); ITALIANO
 /_docs/readme.nl.md (Dokumentasi, Diikutkan); NEDERLANDSE
 /_docs/readme.nl.txt (Dokumentasi, Diikutkan); NEDERLANDSE
 /_docs/readme.pt.md (Dokumentasi, Diikutkan); PORTUGUÊS
 /_docs/readme.pt.txt (Dokumentasi, Diikutkan); PORTUGUÊS
 /_docs/readme.ru.md (Dokumentasi, Diikutkan); РУССКИЙ
 /_docs/readme.ru.txt (Dokumentasi, Diikutkan); РУССКИЙ
    File-file baca saya (misalnya; file yang Anda sedang membaca).
    ~
 /_docs/signatures_tally.txt (Dokumentasi, Diikutkan)
    Perhitungan dari diikutkan tanda tangan (tidak dibutuhkan untuk fungsi
    teratur dari skrip).
    ~
 /_testfiles/ (Direktori)
    Direktori test file-file (berisi bermacam data).
    Semua file-file berisikan di dalamnya adalah data test untuk testing jika
    phpMussel dengan benar diinstal pada sistem, dan Anda tidak perlu
    mengupload direktori ini atau file-filenya jika melakukan testing.
    ~
 /_testfiles/ascii_standard_testfile.txt (Data test, Diikutkan)
    File test untuk mentest tanda tangan ASCII normal phpMussel.
    ~
 /_testfiles/coex_testfile.rtf (Test file, Diikutkan)
    File test untuk mentest tanda tangan diperpanjang kompleks phpMussel.
    ~
 /_testfiles/exe_standard_testfile.exe (Data test, Diikutkan)
    File test untuk mentest tanda tangan PE phpMussel.
    ~
 /_testfiles/general_standard_testfile.txt (Data test, Diikutkan)
    File test untuk mentest tanda tangan umum phpMussel.
    ~
 /_testfiles/graphics_standard_testfile.gif (Data test, Diikutkan)
    File test untuk mentest tanda tangan grafis phpMussel.
    ~
 /_testfiles/html_standard_testfile.txt (Data test, Diikutkan)
    File test untuk mentest tanda tangan HTML normal phpMussel.
    ~
 /_testfiles/md5_testfile.txt (Data test, Diikutkan)
    File test untuk mentest tanda tangan MD5 phpMussel.
    ~
 /_testfiles/metadata_testfile.tar (Data test, Diikutkan)
    File test untuk mentest tanda tangan metadata phpMussel dan untuk mentest
    data support TAR pada sistem Anda.
    ~
 /_testfiles/metadata_testfile.txt.gz (Data test, Diikutkan)
    File test untuk mentest tanda tangan metadata phpMussel dan untuk mentest
    data support GZ pada sistem Anda.
    ~
 /_testfiles/metadata_testfile.zip (Data test, Diikutkan)
    File test untuk mentest tanda tangan metadata phpMussel dan untuk mentest
    data support ZIP pada sistem Anda.
    ~
 /_testfiles/ole_testfile.ole (Data test, Diikutkan)
    File test untuk mentest tanda tangan OLE phpMussel.
    ~
 /_testfiles/pdf_standard_testfile.pdf (Data test, Diikutkan)
    File test untuk mentest tanda tangan PDF phpMussel.
    ~
 /_testfiles/pe_sectional_testfile.exe (Data test, Diikutkan)
    File test untuk mentest tanda tangan PE Sectional phpMussel.
    ~
 /_testfiles/swf_standard_testfile.swf (Data test, Diikutkan)
    File test untuk mentest tanda tangan SWF phpMussel.
    ~
 /_testfiles/xdp_standard_testfile.xdp (Data test, Diikutkan)
    File test untuk mentest tanda tangan potongan XML/XDP phpMussel.
    ~
 /vault/ (Direktori)
    Direktori Vault (berisikan bermacam file).
    ~
 /vault/cache/ (Direktori)
    Direktori Cache (untuk data sementara).
    ~
 /vault/cache/.htaccess (Lainnya, Diikutkan)
    Sebuah data akses hiperteks (pada instansi ini, untuk melindungi file-file
    sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
    ~
 /vault/lang/ (Direktori)
    Berisikan data bahasa.
    ~
 /vault/lang/.htaccess (Lainnya, Diikutkan)
    Sebuah data akses hiperteks (pada instansi ini, untuk melindungi file-file
    sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
    ~
 /vault/lang/lang.de.inc (Skrip, Diikutkan); DEUTSCH
 /vault/lang/lang.en.inc (Skrip, Diikutkan); ENGLISH
 /vault/lang/lang.es.inc (Skrip, Diikutkan); ESPAÑOL
 /vault/lang/lang.fr.inc (Skrip, Diikutkan); FRANÇAIS
 /vault/lang/lang.id.inc (Skrip, Diikutkan); BAHASA INDONESIA
 /vault/lang/lang.it.inc (Skrip, Diikutkan); ITALIANO
 /vault/lang/lang.ja.inc (Skrip, Diikutkan); 日本語
 /vault/lang/lang.nl.inc (Skrip, Diikutkan); NEDERLANDSE
 /vault/lang/lang.pt.inc (Skrip, Diikutkan); PORTUGUÊS
 /vault/lang/lang.ru.inc (Skrip, Diikutkan); РУССКИЙ
 /vault/lang/lang.vi.inc (Skrip, Diikutkan); TIẾNG VIỆT
 /vault/lang/lang.zh.inc (Skrip, Diikutkan); 中文（简体）
 /vault/lang/lang.zh-TW.inc (Skrip, Diikutkan); 中文（傳統）
    Data bahasa untuk phpMussel.
    ~
 /vault/quarantine/ (Direktori)
    Direktori Karantina (berisikan file yang dikarantina).
    ~
 /vault/quarantine/.htaccess (Lainnya, Diikutkan)
    Sebuah data akses hiperteks (pada instansi ini, untuk melindungi file-file
    sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
    ~
 /vault/.htaccess (Lainnya, Diikutkan)
    Sebuah data akses hiperteks (pada instansi ini, untuk melindungi file-file
    sensitif dari skrip untuk diakses dari sumber yang tidak terautorisasi).
    ~
 /vault/ascii_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ascii_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/ascii_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ascii_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/ascii_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ascii_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ascii_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ascii_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan ASCII normal.
    Diharuskan jika tanda tangan opsi ASCII normal di dalam "phpmussel.ini"
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/coex_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/coex_custom.cvd (Tanda tangan, Diikutkan)
 /vault/coex_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan diperpanjang kompleks.
    Diharuskan jika tanda tangan opsi diperpanjang kompleks di dalam
    "phpmussel.ini" diaktifkan. Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/elf_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/elf_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/elf_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/elf_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/elf_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan ELF.
    Diharuskan jika tanda tangan opsi ELF di dalam "phpmussel.ini" diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/exe_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/exe_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/exe_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/exe_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/exe_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan file eksekusi portable.
    Diharuskan jika opsi tanda tangan EXE di dalam "phpmussel.ini" diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/filenames_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/filenames_custom.cvd (Tanda tangan, Diikutkan)
 /vault/filenames_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan nama file.
    Diharuskan jika opsi tanda tangan di dalam "phpmussel.ini" diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/general_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/general_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/general_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/general_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/general_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan umum. Diharuskan jika opsi tanda tangan di
    dalam "phpmussel.ini" diaktifkan. Dapat menghapus jika opsi
    dinonaktifkan.
    ~
 /vault/graphics_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/graphics_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan grafis. Diharuskan jika opsi tanda tangan
    grafis di dalam "phpmussel.ini" diaktifkan. Dapat menghapus jika opsi
    dinonaktifkan.
    ~
 /vault/greylist.csv (Tanda tangan, Diikutkan/Diciptakan)
    CSV terdiri dari tanda tangan daftar abu-abu mengindikasikan phpMussel
    tanda tangan mana yang harus diabaikan (data automatis diciptakan kembali
    jika dihapus).
    ~
 /vault/hex_general_commands.csv (Tanda tangan, Diikutkan)
    CSV terencode Hex dari deteksi perintah umum secara opsional digunakan
    phpMussel. diharuskan jika opsi deteksi perintah umum di dalam
    "phpmussel.ini" diaktifkan. Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/html_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/html_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/html_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/html_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/html_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan HTML normal.
    Diharuskan jika tanda tangan opsi HTML normal di dalam "phpmussel.ini"
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/lang.inc (Skrip, Diikutkan)
    phpMussel data bahasa.
    ~
 /vault/macho_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/macho_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/macho_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/macho_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/macho_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan Mach-O.
    Diharuskan jika opsi tanda tangan Mach-O di "phpmussel.ini" diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/mail_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/mail_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/mail_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/mail_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/mail_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/mail_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/mail_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/mail_mussel_standard.cvd (Tanda tangan, Diikutkan)
 /vault/mail_mussel_standard.map (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan yang digunakan oleh fungsi phpMussel_mail().
    Diharuskan jika fungsi phpMussel_mail() digunakan dalam jalan apapun.
    Dapat menghapus jika tidak digunakan.
    ~
 /vault/md5_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/md5_custom.cvd (Tanda tangan, Diikutkan)
 /vault/md5_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan berbasis MD5.
    Diharuskan jika opsi tanda tangan berbasis MD5 diaktifkan. Dapat menghapus
    jika tidak digunakan.
    ~
 /vault/metadata_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/metadata_custom.cvd (Tanda tangan, Diikutkan)
 /vault/metadata_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan meta data yang terkompres.
    Diharuskan jika tanda tangan meta data dalam opsi di "phpmussel.ini" di
    aktifkan. Dapat menghapus jika opsi di nonaktifkan.
    ~
 /vault/ole_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/ole_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ole_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/ole_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ole_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan OLE.
    Diharuskan jika opsi tanda tangan OLE di "phpmussel.ini" diaktifkan. Dapat
    menghapus jika opsi dinonaktifkan.
    ~
 /vault/pdf_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/pdf_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/pdf_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/pdf_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/pdf_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/pdf_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/pdf_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/pdf_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan PDF.
    Diharuskan jika opsi tanda tangan PDF di "phpmussel.ini" diaktifkan. Dapat
    menghapus jika opsi dinonaktifkan.
    ~
 /vault/pe_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/pe_custom.cvd (Tanda tangan, Diikutkan)
 /vault/pe_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan PE Sectional. Diharuskan jika opsi tanda
    tangan PE Sectional di "phpmussel.ini" diaktifkan. Dapat menghapus jika
    opsi dinonaktifkan.
    ~
 /vault/pex_custom.cvd (Tanda tangan, Diikutkan)
 /vault/pex_mussel.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan PE diperpanjang. Diharuskan jika opsi tanda
    tangan PE diperpanjang di "phpmussel.ini" diaktifkan. Dapat menghapus jika
    opsi dinonaktifkan.
    ~
 /vault/phpmussel.inc (Skrip, Diikutkan)
    Skrip murni phpMussel; Body utama dan vital dari phpMussel (utama)!
    ~
 /vault/phpmussel.ini (Lainnya, Diikutkan)
    Data konfigurasi phpMussel; Berisi semua opsi konfigurasi dari phpMussel,
    memberitahukannya apa yang harus dilakukan dan bagaimana mengoperasikannya
    dengan benar (utama)!
    ~
 /vault/scan_log.txt *(Data catatan, Diciptakan)
    Sebuah catatan dari apapun yang di pemindaian oleh phpMussel.
    ~
 /vault/scan_kills.txt *(Data catatan, Diciptakan)
    Sebuah catatan dari setiap data upload yang diblok/dibunuh oleh phpMussel.
    ~
 /vault/swf_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/swf_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/swf_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/swf_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/swf_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/swf_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/swf_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/swf_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan Shockwave.
    Diharuskan jika opsi tanda tangan Shockwave di "phpmussel.ini" diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan.
    ~
 /vault/switch.dat (Lainnya, Diikutkan)
    Kontrol dan set variabel tertentu.
    ~
 /vault/template.html (Lainnya, Diikutkan)
 /vault/template_custom.html (Lainnya, Diikutkan)
    Data template phpMussel; Template untuk output HTML yang diproduksi oleh
    phpMussel untuk data pesan upload yang dibloknya (pesan dilihat oleh
    pengupload).
    ~
 /vault/update.dat (Lainnya, Diikutkan)
    Data berisi informasi versi untuk skrip phpMussel dan tanda tangan
    phpMussel. Jika Anda pernah ingin mengupgrade phpMussel atau ingin
    mengupdate phpMussel via browser file ini penting.
    ~
 /vault/update.inc (Skrip, Diikutkan)
    Skrip upgrade phpMussel; Diharuskan untuk upgrade otomatis dan untuk
    mengupgrade phpMussel dengan menggunakan browser Anda, tapi tidak
    diharuskan juga.
    ~
 /vault/whitelist_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/whitelist_custom.cvd (Tanda tangan, Diikutkan)
 /vault/whitelist_mussel.cvd (Tanda tangan, Diikutkan)
    File spesifik daftar putih.
    Diharuskan jika opsi Whitelist di "phpmussel.ini" diaktifkan dan jika ingin
    Anda spesifik file bertanda putih. Dapat menghapus jika opsi dinonaktifkan
    atau jika Anda tidak memerlukan spesifik file bertanda putih.
    ~
 /vault/xmlxdp_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/xmlxdp_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_mussel_standard.cvd (Tanda tangan, Diikutkan)
    File-file untuk tanda tangan potongan XML/XDP.
    Diharuskan jika opsi tanda tangan potongan XML/XDP di "phpmussel.ini"
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan.
    ~

 * Nama file bisa berbeda berdasarkan ketentuan konfigurasi (di dalam
   "phpmussel.ini").

 = BERDASARKAN FILE-FILE TANDA TANGAN =
    CVD adalah akronim dari "ClamAV Virus Definitions", dalam referensi dari
    bagaimana ClamAV merujuk ke tanda tangan nya sendiri dan penggunaan dari
    tanda tangan-tanda tangan itu untuk phpMussel; Data berakhir dengan "CVD"
    berisikan tanda tangan.
    ~
    File berakhir dengan "MAP", secara harfiah, memetakan tanda tangan mana
    phpMussel seharusnya dan seharusnya tidak gunakan untuk pemindaian
    individual. Tidak semua tanda tangan secocoknya diharuskan untuk pemindaian
    tunggal, jadi, phpMussel menggunakan peta-peta dari file-file tanda tangan
    untuk mempercepat proses pemindaian (sebuah proses yang akan menjadi lambat
    dan monoton).
    ~
    File-file tanda tangan ditandai dengan "_regex" berisikan tanda tangan yang
    mengarahkan bentuk pengecekan regular expression (regex).
    ~
    File-file tanda tangan ditandai dengan "_standard" berisikan tanda tangan
    yang secara spesifik tidak mengarahkan bentuk pengecekan apapun.
    ~
    File-file tanda tangan tidak ditandai dengan "_regex" atau "_standard" akan
    menjadi satu atau yang lain, tapi tidak keduanya (merujuk pada seksi format
    tanda tangan dari data README untuk dokumentasi dan detail spesifik).
    ~
    File-file tanda tangan ditandai dengan "_clamav" berisikan tanda tangan
    yang berasal dari basis data ClamAV (GNU/GPL).
    ~
    File-file tanda tangan ditandai dengan "_custom", secara default,
    tidak berisikan tanda tangan apapun; file-file ini ada untuk memberikan
    Anda kemana saja untuk meletakkan tanda tangan Anda jika Anda datang
    dengan milik diri Anda sendiri.
    ~
    File-file tanda tangan ditandai dengan "_mussel" berisikan tanda tangan
    yang secara spesifik tidak berasal dari ClamAV, tanda tangan yang secara
    umum, Yang saya buat sendiri atau informasi dari berbagai sumber.
    ~

                                     ~ ~ ~


 6. OPSI KONFIGURASI

 Berikut list variabel yang ditemukan pada data konfigurasi phpMussel
 "phpmussel.ini", dengan deskripsi dari tujuan dan fungsi.

 "general" (Kategori)
 - Konfigurasi umum dari phpMussel.
    "script_password"
    - Sebagai sebuah kenyamanan, phpMussel akan mengizinkan fungsi-fungsi
      tertentu (termasuk kemampuan mengupgrade phpMussel secara langsung) untuk
      secara manual dibangkitkan via POST, GET dan QUERY. Bagaimanapun, untuk
      alasan keamanan, untuk melakukan ini phpMussel akan mengharapkan sebuah
      sandi untuk diikutkan pada perintah, untuk memastikan bahwa itu Anda dan
      bukan orang lain, yang berusaha secara manual membangkitkan fungsi-fungsi
      ini. Set script_password untuk sandi apapun yang Anda mau gunakan. Jika
      tidak ada password diset, pembangkitan manual akan di non aktifkan secara
      default. Gunakan hal yang mudah Anda ingat tapi susah untuk orang lain
      hapal.
      * Tidak memiliki pengaruh di dalam mode CLI.
    "logs_password"
    - Sama seperti script_password tapi untuk melihat semua isi dari scan_log
      dan scan_kills. Memiliki sandi yang lain dapat bergunan jika Anda ingin
      memberikan akses pada orang lain untuk mengakses dan menset fungsi tapi
      tidak yang lain.
      * Tidak memiliki pengaruh di dalam mode CLI.
    "cleanup"
    - Membersihkan variabel skrip dan cache setelah eksekusi?
      False = Tidak, True = Ya [Default]. Jika Anda tidak menggukan skrip di
      bawah pemindaian upload inisial, harus diset ke "true" (ya) untuk
      meminimalisasi penggunaan memori. Jika Anda menggunakan skrip untuk
      tujuan di bawah pemindaian upload inisial, harus diset ke
      "false" (tidak), untuk menghindari reload duplikat data ke memori. Dalam
      praktek umum, haru diset ke "true", tapi jika kamu melakukannya, kamu
      tidak bisa menggunakan skrip untuk hal lain kecuali pemindaian upload
      data.
      * Tidak memiliki pengaruh di dalam mode CLI.
    "scan_log"
    - Nama data dari data untuk mencatat semua hasil pemindaian. Spesifikasikan
      nama data atau biarkan kosong untuk menonaktifkan.
    "scan_kills"
    - Nama data dari fata untuk mencatat semua rekord dari upload terblok atau
      terbunuh. Spesifikan nama data atau biarkan kosong untuk menonaktifkan.
    "ipaddr"
    - Dimana menemukan alamat IP dari permintaan alamat? (Bergunak untuk
      pelayanan-pelayanan seperti Cloudflare dan sejenisnya).
      Default = REMOTE_ADDR
      PERINGATAN: Jangan ganti ini kecuali Anda tahu apa yang Anda lakukan!
    "forbid_on_block"
    - Seharusnya phpMussel mengirimkan 403 headers dengan pesan upload data
      yang terblok, atau cocok dengan 200 OK?
      0 = Tidak (200) [Default], 1 = Ya (403).
    "delete_on_sight"
    - Mengaktifkan opsi ini akan menginstruksikan skrip untuk berusaha
      secepatnya menghapus data apapun yang ditemukannya selama scan yang
      mencocokkan pada kriteria deteksi apapun, baik melalui tanda tangan atau
      yang lain. file-file ditentukan "clean" tidak akan disentuh. Pada kasus
      file terkompress seluruh file terkompress akan didelate (kecuali data
      yang menyerang adalah satu-satunya dari beberapa file yang menjadi isi
      file terkompress). Untuk kasus pemindaian upload data biasanya, tidak
      cocok untuk mengaktifkan opsi ini, karena biasanya PHP akan secara
      otomatis menyatukan isi dari cache ketika eksekusi selesai, berarti bahwa
      dia akan selalu menghapus data terupload apapun melalui server jika tidak
      dipindahkan, dikopi atau dihapus sebelumnya. Opsi tersebut ditambahkan
      di sini sebagai ukuran keamanan ekstra untuk semua salinan PHP yang tidak
      selalu bersikap pada perilaku yang diharapkan.
      False = Setelah pemindahaian, biarkan data [Default],
      True = Setelah pemindaian, jika tidak bersih, hapus langsung.
    "lang"
    - Tentukan bahasa default untuk phpMussel.
    "lang_override"
    - Tentukan jika phpMussel harus, bila memungkinkan, mengganti spesifikasi
      bahasa dengan preferensi bahasa dideklarasikan oleh permintaan memasukan
      (HTTP_ACCEPT_LANGUAGE). 0 - Tidak [Default], 1 - Ya.
    "lang_acceptable"
    - Direktif "lang_acceptable" menginstruksikan phpMussel apa bahasa-bahasa
      dapat diterima oleh skrip dari "lang" atau dari "HTTP_ACCEPT_LANGUAGE".
      Direktif ini -HANYA- harus diubah jika Anda menambahkan file bahasa Anda
      sendiri disesuaikan atau paksa menghapus file bahasa. Direktif adalah
      string dipisahkan koma dari kode-kode digunakan oleh bahasa-bahasa
      diterima oleh skrip.
    "quarantine_key"
    - phpMussel dapat mengkarantina upload file ditandai dalam isolasi dalam
      vault phpMussel, jika ini adalah sesuatu yang Anda ingin lakukan.
      Pengguna biasa dari phpMussel yang hanya ingin memproteksi website mereka
      dan/atau lingkungan hosting mereka tanpa memiliki minat dalam-dalam
      menganalisis setiap ditandai upload file harus meninggalkan fungsi ini
      dinonaktifkan, tetapi setiap pengguna yang tertarik pada analisis lebih
      lanjut dari ditandai upload file bagi penelitian malware atau untuk
      hal-hal seperti serupa harus mengaktifkan fungsi ini. Mengkarantina
      ditandai upload file dapat kadang-kadang juga membantu dalam men-debug
      false-positif, jika ini adalah sesuatu yang sering terjadi untuk Anda.
      Untuk menonaktifkan fungsi karantina, meninggalkan "quarantine_key"
      direktif kosong, atau menghapus isi dari direktif ini jika tidak sudah
      kosong. Untuk mengaktifkan fungsi karantina, masukkan beberapa nilai
      dalam direktif ini. "quarantine_key" adalah fitur keamanan penting dari
      fungsi karantina diharuskan sebagai sarana untuk mencegah fungsi
      karantina dari dieksploitasi oleh penyerang potensial dan sebagai sarana
      mencegah eksekusi potensi data yang disimpan dalam karantina.
      "quarantine_key" harus diperlakukan dengan cara yang sama seperti
      password Anda: Semakin lama semakin baik, dan menjaganya diproteksi erat.
      Bagi efek terbaik, gunakan dalam hubungannya dengan "delete_on_sight".
    "quarantine_max_filesize"
    - Ukuran file maksimum yang diijinkan dari file yang akan dikarantina. File
      yang lebih besar dari nilai yang ditentukan di bawah ini TIDAK akan
      dikarantina. Direktif ini penting sebagai sarana untuk membuat lebih
      sulit bagi setiap penyerang potensial untuk banjir karantina Anda dengan
      data yang tidak diinginkan berpotensi menyebabkan penggunaan data
      kelebihan pada layanan hosting Anda. Nilai dalam KB.
      Default =2048 =2048KB =2MB.
    "quarantine_max_usage"
    - Penggunaan memori maksimal yang diijinkan untuk karantina. Jika total
      penggunaan memori oleh karantina mencapai nilai ini, file yang
      dikarantina tertua akan dihapus sampai total penggunaan memori tidak lagi
      mencapai nilai ini. Direktif ini penting sebagai sarana untuk membuat
      lebih sulit bagi setiap penyerang potensial untuk banjir karantina Anda
      dengan data yang tidak diinginkan berpotensi menyebabkan penggunaan data
      kelebihan pada layanan hosting Anda. Nilai dalam KB.
      Default =65536 =65536KB =64MB.
    "honeypot_mode"
    - Bila modus honeypot diaktifkan, phpMussel akan mencoba untuk karantina
      setiap file upload yang dia menemui, terlepas dari apakah atau tidak file
      yang di-upload cocok dengan tanda tangan yang disertakan, dan tidak ada
      pemindaian aktual atau analisis dari upload file akan terjadi. Fungsi ini
      akan berguna bagi mereka yang ingin menggunakan phpMussel untuk tujuan
      virus/malware penelitian, tetapi tidak direkomendasikan untuk
      mengaktifkan fungsi ini jika tujuan penggunaan dari phpMussel oleh
      pengguna adalah bagi aktual upload file pemindaian dan juga tidak
      direkomendasikan untuk menggunakan fungsi honeypot untuk tujuan selain
      bagi honeypot. Biasanya, opsi ini dinonaktifkan.
      0 = Dinonaktifkan [Default], 1 = Diaktifkan.
    "scan_cache_expiry"
    - Untuk berapa lama harus phpMussel cache hasil-hasil? Nilai adalah jumlah
      detik untuk cache hasil-hasil untuk. Default adalah 21600 detik (6 jam);
      Nilai 0 akan menonaktifkan caching hasil-hasil.
    "disable_cli"
    - Menonaktifkan modus CLI? Modus CLI diaktifkan secara default, tapi
      kadang-kadang dapat mengganggu alat pengujian tertentu (seperti PHPUnit,
      sebagai contoh) dan aplikasi CLI berbasis lainnya. Jika Anda tidak perlu
      menonaktifkan modus CLI, Anda harus mengabaikan direktif ini.
      0 = Mengaktifkan modus CLI [Default], 1 = Menonaktifkan modus CLI.
 "signatures" (Kategori)
 - Konfigurasi untuk tanda tangan.
   %%%_clamav = Tanda tangan ClamAV (kedua-duanya utama dan harian).
   %%%_custom = Tanda tangan terubah (Jika Anda merubahnya).
   %%%_mussel = Tanda tangan phpMussel dimasukkan dalam tanda tangan tersebut
                dari yang bukan dari ClamAV.
   - Cek tanda tangan MD5 ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Cek tanda tangan umum ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Cek tanda tangan ASCII normal ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Cek tanda tangan HTML normal ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Cek file PE (Portable Executable; EXE, DLL, etc) pada tanda tangan PE
     Sectional ketika pemindaian? False = Tidak, True = Ya [Default].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Cek file PE (Portable Executable; EXE, DLL, etc) pada tanda tangan PE
     diperpanjang ketika pemindaian? False = Tidak, True = Ya [Default].
     "pex_custom"
     "pex_mussel"
   - Cek file PE (Portable Executable; EXE, DLL, etc) pada tanda tangan PE
     ketika pemindaian? False = Tidak, True = Ya [Default].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Cek file-file ELF pada tanda tangan ELF ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Cek file-file Mach-O (OSX, etc) pada tanda tangan Mach-O ketika
     pemindaian? False = Tidak, True = Ya [Default].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Cek file-file grafis pada tanda tangan grafis ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Cek isi file terkompress pada tanda tangan metadata terkompres ketika
     pemindaian? False = Tidak, True = Ya [Default].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Cek objek-objek OLE pada tanda tangan OLE ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "ole_clamav"
     "ole_custom"
     "ole_mussel"
   - Cek nama data pada tanda tangan berbasis nama file ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Mengizinkan pemindaian dengan phpMussel_mail()?
     False = Tidak, True = Ya [Default].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Aktifkan daftar putih tertentu file? False = Tidak, True = Ya [Default].
     "whitelist_clamav"
     "whitelist_custom"
     "whitelist_mussel"
   - Cek XML/XDP potongan pada tanda tangan potongan XML/XDP ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "xmlxdp_clamav"
     "xmlxdp_custom"
     "xmlxdp_mussel"
   - Cek tanda tangan diperpanjang kompleks ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "coex_clamav"
     "coex_custom"
     "coex_mussel"
   - Cek tanda tangan PDF ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "pdf_clamav"
     "pdf_custom"
     "pdf_mussel"
   - Cek tanda tangan Shockwave ketika pemindaian?
     False = Tidak, True = Ya [Default].
     "swf_clamav"
     "swf_custom"
     "swf_mussel"
   - Opsi Tanda tangan cocok batas panjangnya. Hanya ubah ini jika Anda tahu
     apa yang Anda lakukan. SD = Standard tanda tangan. RX = Tanda tangan PCRE
     (Perl Compatible Regular Expressions, "Regex"). FN = Tanda tangan Nama
     Data. Jika Anda melihat PHP crashing ketika phpMussel meoncoba memindai,
     coba merendahkan nilai "max". Jika mungkin dan cocok, biarkan saya tahu
     kapan ini terjadi dan hasil dari apapun yang Anda coba.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   "fail_silently"
   - Seharusnya laporan phpMussel ketika data tanda tangan hilang atau dikorup?
     Jika fail_silently dinonaktifkan, data dikorup dan hilang akan dilaporkan
     ketika pemindaian, dan jika fail_silently diaktifkan, data dikorup dan
     hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini
     bahwa tidak ada masalah. Harus ini dibiarkan sendirian jika Anda pernah
     mengalami crash atau masalah lain.
     0 = Dinonaktifkan, 1 = Diaktifkan [Default].
   "fail_extensions_silently"
   - Seharusnya laporan phpMussel ketika ekstensi hilang? Jika
     fail_extensions_silently dinonaktifkan, ekstensi hilang akan dilaporkan
     ketika pemindaian, dan jika fail_extensions_silently diaktifkan, ekstensi
     hilang akan diabaikan, dengan pemindaian melaporkan untuk file-file ini
     bahwa tidak ada masalah. Menonaktifkan direktif ini berpotensi dapat
     meningkatkan keamanan Anda, tetapi juga dapat menyebabkan peningkatan
     positif palsu. 0 = Dinonaktifkan, 1 = Diaktifkan [Default].
   "detect_adware"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi adware?
     False = Tidak, True = Ya [Default].
   "detect_joke_hoax"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi
     lelucon/kebohongan malware/virus? False = Tidak, True = Ya [Default].
   "detect_pua_pup"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi PUAs/PUPs?
     False = Tidak, True = Ya [Default].
   "detect_packer_packed"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi pengepakan dan
     data dikemas? False = Tidak, True = Ya [Default].
   "detect_shell"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi skrip shell?
     False = Tidak, True = Ya [Default].
   "detect_deface"
   - Harus phpMussel menggunakan tanda tangan untuk mendeteksi perusakan dan
     perusak? False = Tidak, True = Ya [Default].
 "files" (Kategori)
 - Konfigurasi umum untuk mengambil alih file-file.
   "max_uploads"
   - Maksimum jumla file-file yang diizinkan untuk dipindai selama pemindaian
     upload data sebelum menghentikan pemindaian dan menginformasikan pengguna
     bahwa pengguna mengupload terlalu banyak! Menyediakan perlindungan pada
     serangan teoritis dimana penyerang mencoba DDoS pada sistem Anda atau CMS
     ada dengan overloading phpMussel supaya berjalan lambat. Proses PHP ke
     penghentian keras. Recommendasi: 10. Anda dapat menaikkan atau menurunkan
     angka ini bergantung dari kecepatan hardware Anda. Catat itu nomor ini
     tidak mengakuntabilitas atau mengikutkan konten dari file terkompres.
   "filesize_limit"
   - Batasan ukuran file dalam KB. 65536 = 64MB [Default], 0 = Tidak ada batasa
     (selalu bertanda abu-abu), nilai angka positif apapun diterima. Ini dapat
     berguna ketika batasan konfigurasi PHP Anda membatasi jumah memori dari
     proses yang dapat ditampungnya atau jika konfigurasi PHP Anda membatasi
     jumlah ukuran upload Anda.
   "filesize_response"
   - Apa yang Anda lakukan dengan file-file yang melebihi batasan ukuran (jika
     ada).
     0 - Bertanda putih, 1 - Bertanda hitam [Default].
   "filetype_whitelist", "filetype_blacklist", "filetype_greylist"
   - Jika sistem Anda hanya mengizinkan tipe data spesifik menjadi diupload,
     atau jika sistem Anda secara eksplisit menolak tipe file-file tertentu,
     menspesifikasikan tipe data dalam bertanda putih, bertanda hitam dan
     bertanda abu-abu dapat menaikkan kecepatan dari pemindaian dilakukan
     dengan mengizinkan skrip untuk mengabaikan tipe data tertentu. Format
     adalah CSV (comma separated values). Jika Anda ingin memindai semuanya,
     daripada daftar putih, daftar hitam atau daftar abu-abu, tinggalkan
     variabel kosong; Melakukannya akan menonaktifkan dafter
     putih/hitam/abu-abu. Urutan logis dari pengolahan:
     - Jika tipe data bertanda putih, tidak memindai dan tidak memblokir data,
       dan tidak memeriksa data terhadap daftar hitam atau daftar abu-abu.
     - Jika tipe data bertanda hitem, tidak memindai data tapi memblokir
       bagaimanapun, dan tidak memeriksa data terhadap daftar abu-abu.
     - Jika daftar abu-abu yang kosong atau jika daftar abu-abu tidak kosong
       dan tipe file bertanda abu-abu, memindai data seperti biasa dan
       menentukan apakah untuk memblokir berdasarkan hasil memindai, tapi jika
       daftar abu-abu tidak kosong dan tipe data tidak bertanda abu-abu,
       memperlakukan seolah olah bertanda hitam, demikian tidak memindai tapi
       memblokir itu bagaimanapun.
   "check_archives"
   - Berusaha mencek isi file terkompress?
     0 - Tidak (Tidak mencek), 1 - Ya (Mencek) [Default].
     * Hanya mencek BZ, GZ, LZF dan ZIP files didukung (mencek RAR, CAB, 7z,
       dll tidak didukung).
     * Ini bukan bukti yang bodoh! Selama saya sangat rekomendasikan menjaga
       ini aktif, saya tidak dapat menjamin itu hanya menemukan segala
       sesuatunya.
     * Juga diingatkan bahwa mencek data terkompres tidak rekursif untuk ZIP.
   "filesize_archives"
   - Memperlalaikan ukuran daftar hitam/putih dari isi data terkompress?
     0 - Tidak (Bertanda abu-abu semua), 1 - Ya [Default].
   "filetype_archives"
   - Memperlalaikan jenis data daftar hitam/putih dari isi data terkompress?
     0 - Tidak (Bertanda abu-abu semua) [Default], 1 - Ya.
   "max_recursion"
   - Dalam rekursi dari data terkompres. Default = 10.
   "block_encrypted_archives"
   - Mendeteksi dan memblokir dienkripsi arsip? Karena phpMussel tidak mampu
     memindai isi arsip dienkripsi, itu mungkin bahwa enkripsi arsip dapat
     digunakan oleh penyerang sebagai sarana mencoba untuk memotong phpMussel,
     anti-virus pemindai dan perlindungan mirip lainnya. Menginstruksikan
     phpMussel untuk memblokir setiap arsip dienkripsi ditemukan akan
     berpotensi membantu mengurangi risiko terkait dengan kemungkinan tersebut.
     0 - Tidak, 1 - Ya [Default].
 "attack_specific" (Kategori)
 - Konfigurasi dari deteksi serangan spesifik (tidak berdasarkan CVDs).
   * Chameleon serangan deteksi: 0 = Dinonaktifkan, 1 = Diaktifkan.
   "chameleon_from_php"
   - Cari header PHP tidak di dalam file-file PHP atau data terkompress.
   "chameleon_from_exe"
   - Cari header yang dapat dieksekusi di dalam file-file yang dapat
     dieksekusi atau data terkompress yang dikenali dan untuk data dapat
     dieksekusi yang headernya tidak benar.
   "chameleon_to_archive"
   - Cari data terkompress yang header nya tidak benar (Mendukung: BZ, GZ, RAR,
     ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Cari dokumen office yang header nya tidak benar (Mendukung: DOC, DOT, PPS,
     PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Cari gambar yang header nya tidak benar (Mendukung: BMP, DIB, PNG, GIF,
     JPEG, JPG, XCF, PSD, PDD, WEBP).
   "chameleon_to_pdf"
   - Cari data PDF yang headernya tidak benar.
   "archive_file_extensions" dan "archive_file_extensions_wc".
   - Ekstensi data terkompres yang dikenali (formatnya CSV; seharusnya hanya
     menambah atau menghapus ketika masalah terjadi; Tidak cocok langsung
     menghapus karena dapat menyebabkan angka positif yang salah terjadi
     pada data terkompres, dimana juga menambahkan deteksi; memodifikasi dengan
     peringatan; Juga dicatat bahwa ini tidak memberi efek pada data
     terkompress apa yang dapat dan tidak dapat di analisa pada level isi).
     Daftar sebagaimana defaultnya, memberi daftar format-format yang digunakan
     yang paling umum melalui melalui mayoritas sistem dan CMS, tapi bermaksud
     tidak komprehensif.
   "general_commands"
   - Mencari isi file-file untuk perintah umum seperti "eval()", "exec()" and
     "include()"? 0 - Tidak (tidak mencek) [Default], 1 - Ya (mencek).
     Matikan opsi ini jika Anda bermaksud untuk mengupload yang manapun dari
     ini ke sistem ata CMS Anda via browser Anda: file-file PHP, JavaScript,
     HTML, python, perl dll. Hidupkan opsi ini jika Anda tidak punya tambahan
     perlindungan pada sistem Anda dan tidak bermaksud mengupload file-file
     apapun. Jika Anda menggunakan keamanan tambahan dalam kata penghubung
     dengan phpMussel seperti ZB Block, tidak perlu menghidupkan opsi ini,
     karena kebanyakan apa yang akan phpMussel cari (dalam konteks opsi ini)
     adalah duplikasi dari perlindungan yang telah disediakan.
   "block_control_characters"
   - Memblokade data apapun yang berisi karakter pengendali (lain dari baris
     baru)? ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) Jika Anda hanya sedang mengupload
     data teks biasa, maka Anda dapat menghidupkan opsi ini untuk menyediakan
     perlindungan tambahan ke sistem Anda. Bagaimanapun jika Anda mengupload
     apapun lebih dari data teks biasa, menghidupkan opsi ini mungkin
     mengakibatkan angka positif salah.
     0 - Jangan memblokade [Default], 1 - Memblokade.
   "corrupted_exe"
   - File korup dan diurai kesalahan.
     0 = Mengabaikan, 1 = Memblokade [Default]. Mendeteksi dan memblokir
     berpotensi korup PE (Portable Executable) file? Sering (tetapi tidak
     selalu), ketika aspek-aspek tertentu dari file PE yang korup atau tidak
     bisa diurai dengan benar, itu dapat menjadi indikasi dari infeksi virus.
     Proses yang digunakan oleh sebagian besar program anti-virus untuk
     mendeteksi virus dalam file PE memerlukan parsing file-file dengan cara
     tertentu, yang, jika programmer virus menyadari, secara khusus akan
     mencoba untuk mencegah, untuk memungkinkan virus mereka untuk tetap tidak
     terdeteksi.
   "decode_threshold"
   - Opsional pembatasan atau ambang batas dengan panjang data mentah yang
     dalam decode perintah harus terdeteksi (dalam kasus ada masalah kinerja
     sementara pemindaian). Nilai adalah bilangan yang mewakili ukuran file
     dalam KB. Default = 512 (512KB). Nol atau nilai null menonaktifkan ambang
     batas (menghapus apapun batasan berdasarkan ukuran file).
   "scannable_threshold"
   - Opsional pembatasan atau ambang batas dengan panjang data mentah yang
     phpMussel diperbolehkan untuk membaca dan memindai (dalam kasus ada
     masalah kinerja sementara pemindaian). Nilai adalah bilangan yang mewakili
     ukuran file dalam KB. Default = 32768 (32MB). Nol atau nilai null
     menonaktifkan ambang batas. Umumnya, nilai ini tidak seharusnya kurang
     dari ukuran file rata-rata upload file yang Anda inginkan dan Anda
     harapkan untuk menerima ke server atau website, tidak seharusnya lebih
     dari direktif filesize_limit, dan tidak seharusnya lebih dari sekitar
     seperlima dari total alokasi memori yang diijinkan ke PHP melalui file
     "phpmussel.ini" konfigurasi. Direktif ini ada untuk mencegah phpMussel
     menggunakan terlalu banyak memori (yang bisa mencegah dari yang berhasil
     memindai file di atas tertentu ukuran file).
 "compatibility" (Kategori)
 - Direktif-direktif kompatibilitas pada phpMussel.
   "ignore_upload_errors"
   - Direktif ini umumnya harus DINONAKTIFKAN kecuali diharuskan untuk fungsi
     yang benar dari phpMussel pada sistem tertentu. Biasanya, ketika
     DINONAKTIFKAN, ketika phpMussel mendeteksi adanya elemen dalam $_FILES
     array(), itu akan mencoba untuk memulai scan file yang mewakili elemen,
     dan, jika elemen yang kosong, phpMussel akan mengembalikan pesan
     kesalahan. Ini adalah perilaku yang tepat untuk phpMussel. Namun, untuk
     beberapa CMS, elemen kosong di $_FILES dapat terjadi sebagai akibat dari
     perilaku alami itu CMS, atau kesalahan dapat dilaporkan bila tidak ada,
     dalam kasus seperti itu, perilaku normal untuk phpMussel akan mengganggu
     untuk perilaku normal itu CMS. Jika situasi seperti itu terjadi untuk
     Anda, MENGAKTIFKAN direktif ini akan menginstruksikan phpMussel untuk
     tidak mencoba untuk memulai scan untuk elemen kosong, mengabaikan saat
     ditemui dan untuk tidak kembali terkait pesan kesalahan, sehingga
     memungkinkan kelanjutan dari halaman permintaan.
     0 - DINONAKTIFKAN, 1 - DIAKTIFKAN.
   "only_allow_images"
   - Jika Anda hanya mengharapkan atau hanya berniat untuk memungkinkan
     mengupload gambar ke sistem atau CMS, dan jika Anda benar-benar tidak
     memerlukan mengupload file selain gambar ke sistem atau CMS, direktif ini
     harus DIAKTIFKAN, tetapi sebaliknya harus DINONAKTIFKAN. Jika direktif ini
     DIAKTIFKAN, ini akan menginstruksikan phpMussel untuk memblokir tanpa
     pandang bulu setiap upload diidentifikasi sebagai file tidak gambar, tanpa
     pemindaian mereka. Ini mungkin mengurangi waktu memproses dan penggunaan
     memori untuk mencoba upload file tidak gambar.
     0 - DINONAKTIFKAN, 1 - DIAKTIFKAN.
 "heuristic" (Kategori)
 - Direktif-direktif heuristik pada phpMussel.
   "threshold"
   - Ada tanda tangan tertentu dari phpMussel yang dimaksudkan untuk
     mengidentifikasi kualitas yang mencurigakan dan berpotensi berbahaya pada
     file-file yang di-upload tanpa di diri mereka mengidentifikasi file-file
     yang di-upload spesifik sebagai berbahaya. Ini "threshold" nilai
     memberitahu phpMussel apa total berat maksimum untuk kualitas yang
     mencurigakan dan berpotensi berbahaya pada file-file yang di-upload yang
     diijinkan adalah sebelum file-file yang akan diidentifikasi sebagai
     berbahaya. Definisi berat dalam konteks ini adalah jumlah total kualitas
     mencurigakan dan berpotensi berbahaya diidentifikasi. Secara default,
     nilai ini akan ditetapkan ke 3. Sebuah nilai lebih rendah umumnya akan
     menghasilkan sebagai lebih tinggi positif palsu kejadian tetapi sebuah
     jumlah lebih tinggi file berbahaya diidentifikasi, sedangkan sebuah nilai
     lebih tinggi umumnya akan menghasilkan sebagai lebih rendah positif palsu
     kejadian tetapi sebuah jumlah lebih rendah pada file berbahaya yang
     diidentifikasi. Ini umumnya terbaik untuk meninggalkan nilai ini di
     default kecuali jika Anda mengalami masalah berhubungan dengan itu.
 "virustotal" (Kategori)
 - Konfigurasi untuk Virus Total integrasi.
   "vt_public_api_key"
   - Secara fakultatif, phpMussel mampu memindai file menggunakan Virus Total
     API sebagai cara untuk memberikan tingkat sangat ditingkatkan perlindungan
     terhadap virus, trojan, malware dan ancaman lainnya. Secara default, file
     pemindaian menggunakan Virus Total API dinonaktifkan. Untuk
     mengaktifkannya, kunci API dari Virus Total diperlukan. Karena manfaat
     yang signifikan bahwa ini bisa memberikan kepada Anda, itu adalah sesuatu
     itu adalah sesuatu yang sangat direkomendasi mengaktifkan. Perlu
     diketahui, bagaimanapun, menggunakan Virus Total API, Anda -HARUS- setuju
     untuk Terms of Service dan Anda -HARUS- mematuhi semua pedoman terkait
     dijelaskan oleh Virus Total dokumentasi! Anda TIDAK diizinkan untuk
     menggunakan fungsi ini KECUALI KALAU:
     A) Anda membaca dan setuju untuk Terms of Service dari Virus Total dan API
        mereka. Terms of Service dari Virus Total dan API mereka dapat
        ditemukan di sini:
        <https://www.virustotal.com/en/about/terms-of-service/>.
     B) Anda membaca dan memahami, setidaknya, mukadimah dari Virus Total
        dokumentasi API (semuanya setelah "VirusTotal Public API v2.0" tapi
        sebelum "Contents"). Virus Total dokumentasi API umum dapat ditemukan
        di sini: <https://www.virustotal.com/en/documentation/public-api/>.
     Mencatat: Jika memindai file menggunakan Virus Total API dinonaktifkan,
     Anda tidak akan perlu meninjau salah di direktif-direktif dalam kategori
     ini ("virustotal"), karena tidak satupun dari mereka akan melakukan apapun
     jika ini dinonaktifkan. Untuk memperoleh Virus Total kunci API, dari
     dimanapun di website mereka, mengklik atas "Join our Community" link yang
     terletak ke arah kanan atas dari halaman, memasukkan informasi yang
     diminta, dan mengklik "Sign up" ketika dilakukan. Ikuti semua instruksi
     yang diberikan, dan ketika Anda punya kunci API umum Anda,
     menyalin/menempelkan bahwa kunci API umum untuk "vt_public_api_key"
     direktif dari "phpmussel.ini" file konfigurasi.
   "vt_suspicion_level"
   - Secara default, phpMussel akan membatasi file dipindai menggunakan Virus
     Total API untuk file-file yang dianggap "mencurigakan". Anda dapat
     menyesuaikan pembatasan ini dengan mengubah nilai direktif
     "vt_suspicion_level".
     0 - File hanya dianggap mencurigakan jika, setelah dipindai oleh phpMussel
         menggunakan tanda tangan sendiri, mereka dianggap membawa berat
         heuristik. Ini akan efektif berarti bahwa penggunaan Virus Total API
         akan untuk pendapat kedua ketika phpMussel mencurigai bahwa file
         berpotensi menjadi berbahaya, tetapi tidak dapat sepenuhnya
         mengesampingkan bahwa hal itu juga berpotensi menjadi jinak (atau
         tidak berbahaya) dan demikian akan dinyatakan biasanya tidak memblokir
         atau mengindikasi itu sebagai berbahaya.
     1 - File dianggap mencurigakan jika, setelah dipindai oleh phpMussel
         menggunakan tanda tangan sendiri, mereka dianggap membawa berat
         heuristik, jika mereka diketahui executable (PE file, Mach-O file,
         ELF/Linux file, dll), atau jika mereka diketahui dari format yang
         berpotensi berisi data executable (seperti macro executable, DOC/DOCX
         file, arsip file seperti RAR, ZIP dan dll). Ini adalah default dan
         direkomendasikan tingkat kecurigaan untuk menerapkan, efektif berarti
         bahwa penggunaan Virus Total API akan untuk pendapat kedua ketika
         phpMussel tidak awalnya mendeteksi sesuatu yang berbahaya atau yang
         salah dengan file yang dianggap mencurigakan dan demikian akan
         dinyatakan biasanya tidak memblokir atau mengindikasi itu sebagai
         berbahaya.
     2 - Semua file dianggap mencurigakan dan harus dipindai menggunakan Virus
         Total API. Saya biasanya tidak merekomendasikan menerapkan tingkat
         kecurigaan ini, karena risiko mencapai kuota API Anda lebih cepat
         daripada yang akan terjadi, tetapi ada kondisi tertentu (seperti
         ketika webmaster atau hostmaster memiliki sedikit iman atau
         kepercayaan apakah gerangan dalam apapun diupload dari pengguna
         mereka) dimana tingkat kecurigaan ini dapat bisa sesuai. Dengan
         tingkat kecurigaan ini, semua file biasanya tidak diblokir atau
         ditandai sebagai berbahaya akan dipindai menggunakan Virus Total API.
         Catat, bagaimanapun, phpMussel akan berhenti menggunakan Virus Total
         API ketika kuota API Anda telah tercapai (terlepas dari tingkat
         kecurigaan), dan kuota Anda kemungkinan akan dicapai jauh lebih cepat
         bila menggunakan tingkat kecurigaan ini.
     Mencatat: Terlepas dari tingkat kecurigaan, setiap file yang masuk daftar
     hitam atau daftar putih oleh phpMussel tidak akan dipindai menggunakan
     Virus Total API, karena file seperti ini akan sudah dinyatakan sebagai
     jinak atau berbahaya oleh phpMussel pada saat itu mereka akan sudah
     dinyatakan telah dipindai oleh Virus Total API, dan demikian, memindai
     tambahan tidak akan diperlukan. Kemampuan phpMussel untuk memindai file
     menggunakan Virus Total API dimaksudkan untuk membangun kepercayaan lebih
     lanjut untuk apakah file yang berbahaya atau jinak pada mereka situasi
     dimana phpMussel sendiri tidak sepenuhnya yakin apakah file yang berbahaya
     atau jinak.
   "vt_weighting"
   - Apakah Anda ingin phpMussel menerapkan hasil pemindaian menggunakan Virus
     Total API sebagai deteksi atau deteksi pembobotan? Direktif ini ada,
     karena, meskipun memindai file menggunakan mesin-mesin kelipatan (sebagai
     Virus Total melakukannya) harus menghasilkan tingkat deteksi meningkat
     (dan demikian lebih banyak file berbahaya tertangkap), juga dapat
     menghasilkan jumlah yang lebih banyak dari positif palsu, dan demikian,
     dalam kondisi beberapa, hasil pemindaian dapat digunakan lebih efektif
     sebagai nilai keyakinan daripada daripada sebagai kesimpulan definitif.
     Jika nilai 0 digunakan, hasil pemindaian menggunakan Virus Total API akan
     diaplikasikan sebagai pendeteksian, dan demikian, jika mesin-mesin
     digunakan oleh Virus Total menandai file dipindai sebagai berbahaya,
     phpMussel akan menganggap file yang berbahaya. Jika nilai lain yang
     digunakan, hasil pemindaian menggunakan Virus Total API akan diaplikasikan
     sebagai deteksi pembobotan, dan demikian, jumlah mesin digunakan oleh
     Virus Total menandai file dipindai sebagai berbahaya akan berfungsi
     sebagai nilai keyakinan (atau deteksi pembobotan) untuk jika file dipindai
     harus dianggap berbahaya oleh phpMussel (nilai digunakan akan mewakili
     nilai keyakinan minimum atau pembobotan minimum diperlukan untuk dianggap
     berbahaya). Nilai 0 digunakan secara default.
   "vt_quota_rate" dan "vt_quota_time"
   - Menurut Virus Total dokumentasi API, itu terbatas untuk paling 4
     permintaan dalam bentuk apapun dalam jangka waktu 1 menit diberikan. Jika
     Anda menjalankan sebuah honeyclient, honeypot atau otomatisasi lainnya
     yang akan menyediakan data untuk VirusTotal dan tidak hanya mengambil
     laporan Anda berhak untuk kuota permintaan lebih tinggi. Secara default,
     phpMussel ketat akan mematuhi keterbatasan ini, tetapi karena kemungkinan
     kuota ini sedang meningkat, dua direktif ini yang disediakan sebagai
     sarana bagi Anda untuk menginstruksikan phpMussel tentang apa batas harus
     dipatuhi. Kecuali Anda telah diperintahkan untuk melakukannya, itu tidak
     direkomendasi bagi Anda untuk meningkat nilai-nilai ini, tetapi, jika Anda
     mengalami masalah berkaitan dengan mencapai kuota Anda, penurunan
     nilai-nilai ini kadang -DAPAT- membantu Anda bagi berurusan dengan
     masalah-masalah ini. Batas Anda ditentukan sebagai "vt_quota_rate"
     permintaan dalam bentuk apapun dalam jangka waktu "vt_quota_time" menit.
 "template_data" (Category)
 - Direktif-direktif dan variabel-variabel untuk template-template dan
   tema-tema: Data template berkaitan untuk HTML diproduksi yang digunakan
   untuk menghasilkan pesan "Upload Ditolak" yang ditampilkan kepada
   pengguna-pengguna ketika file upload yang diblokir. Jika Anda menggunakan
   tema kustom untuk phpMussel, HTML diproduksi yang bersumber dari file
   "template_custom.html", dan sebaliknya, HTML diproduksi yang bersumber dari
   file "template.html". Variabel ditulis untuk file konfigurasi bagian ini
   yang diurai untuk HTML diproduksi dengan cara mengganti nama-nama variabel
   dikelilingi dengan kurung keriting ditemukan dalam HTML diproduksi dengan
   data variabel sesuai. Sebagai contoh, dimana foo="bar", setiap terjadinya
   <p>{foo}</p> ditemukan dalam HTML diproduksi akan menjadi <p>bar</p>.
   "css_url"
   - File template untuk tema kustom menggunakan properti CSS eksternal,
     sedangkan file template untuk tema default menggunakan properti CSS
     internal. Untuk menginstruksikan phpMussel menggunakan file template untuk
     tema kustom, menentukan alamat HTTP publik file CSS tema kustom Anda
     menggunakan variable "css_url" variable. Jika Anda biarkan kosong variabel
     ini, phpMussel akan menggunakan file template untuk tema default.

                                     ~ ~ ~


 7. FORMAT TANDA TANGAN

 = TANDA TANGAN NAMA FILE =
   Semua tanda tangan nama file mengikuti format ini:
    NAMA:FNRX
   Dimana NAMA adalah nama mengutip tanda tangan dan FNRX adalah pola regex
   untuk mencocokkan nama file (tidak ter-encode).

 = TANDA TANGAN MD5 =
   Semua tanda tangan MD5 mengikuti format ini:
    HASH:UKURAN:NAMA
   Dimana HASH adalah MD5 dari keseluruhan file, UKURAN adalah total ukuran
   file dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

 = TANDA TANGAN METADATA ARSIP =
   Semua tanda tangan meta data arsip mengikuti format ini:
    NAMA:UKURAN:CRC32
   Dimana NAMA adalah nama mengutip tanda tangan itu, UKURAN adalah total
   ukuran data (tidak terkompres) dari sebuah data berisikan arsip dan CRC32
   adalah checksum CRC32 dari data yang berisikan.

 = TANDA TANGAN SEKSIONAL PE =
   Semua tanda tangan seksional PE mengikuti format ini:
    UKURAN:HASH:NAMA
   Dimana HASH adalah MD5 dari seksi PE, UKURAN adalah total ukuran dari seksi
   PE dan NAMA adalah nama untuk mengutip tanda tangan tersebut.

 = TANDA TANGAN DIPERPANJANG PE =
   Semua tanda tangan diperpanjang PE mengikuti format ini:
    $VAR:HASH:UKURAN:NAMA
   Dimana $VAR adalah nama dari PE variabel untuk mencocokkan terhadap, HASH
   adalah MD5 dari variabel, UKURAN adalah ukuran total dari variabel dan NAMA
   adalah nama untuk mengutip tanda tangan tersebut.

 = TANDA TANGAN PUTIH =
   Semua tanda tangan putih mengikuti format ini:
    HASH:UKURAN:TYPE
   Dimana HASH adalah MD5 dari keseluruhan file, UKURAN adalah total ukuran
   file dan TYPE adalah jenis tanda tangan yang file daftar putih tersebut
   adalah kebal terhadap.

 = TANDA TANGAN DIPERPANJANG KOMPLEKS =
   Tanda tangan diperpanjang kompleks adalah berbeda dengan jenis lain dari
   tanda tangan phpMussel, melalui bahwa apa yang mencocokkan mereka ditentukan
   oleh tanda tangan sendiri dan mereka dapat mencocokkan terhadap beberapa
   kriteria. Kriteria mencocokkan yang dipisahkan oleh ";" dan pencocokan jenis
   dan pencocokan data masing-masing kriteria yang dipisahkan oleh ":" sebagai
   sehingga format untuk tanda tangan ini cenderung terlihat sedikit seperti:
    $variabel1:DATA;$variabel:DATA;NamaTandaTangan

 = YANG LAIN =
   Semua tanda tangan yang lain mengikuti format ini:
    NAMA:HEX:FROM:TO
   Dimana NAMA adalah nama yang mengutip tanda tangan ini dan HEX adalah sebuah
   segmen heksadesimal-dikodekan dari data yang dimaksudkan untuk dicocokkan
   oleh tanda tangan yang diberikan. FROM dan TO adalah parameter opsional,
   mengindikasikan dari mana dan kemana posisi dari sumber data untuk di cek
   (tidak didukung oleh fungsi mail).

 = REGEX =
   Setiap bentuk dari regex mengerti dan dengan benar diproses oleh php
   seharusnya bisa dengan benar dimengerti dan diproses oleh phpMussel dan
   tanda tangannya. Bagaimanapun, saya menyarankan peringatan ekstrim ketika
   menuliskan tanda tangan berbasis regex baru karena, jika Anda tidak yakin
   apa yang Anda lakukan dapat menghasilkan hal yang tidak diinginkan. Coba
   lihat source-code phpMussel dan jika Anda tidak yakin tentang konteks dari
   statemen regex diparsing. Juga ingat bahwa semua pola (dengan pengecualian
   ke nama data, metadata terkompres dan pola MD5) harus diencode heksadesimal
   (sintaksis pola sebelumnya, tentu saja)!

 = DIMANA MELETAKKAN TANDA TANGAN YANG TERUBAH? =
   Hanya menempatkan tanda tangan kustom dalam file yang dimaksudkan untuk
   tanda tangan kustom. File harus berisi "_custom" dalam nama file mereka.
   Anda juga harus menghindari mengedit file tanda tangan default, kecuali jika
   Anda tahu persis apa yang Anda lakukan, karena, selain menjadi praktik baik
   umumnya dan selain membantu Anda membedakan antara tanda tangan Anda sendiri
   dan tanda tangan default diikutkan dengan phpMussel, itu baik untuk menjaga
   mengedit hanya file ditujukan bagi mengedit, karena yang dirusak dengan file
   tanda tangan default dapat menyebabkan mereka untuk berhenti bekerja dengan
   benar, karena "map" file-file: File-file map menginstruksikan phpMussel
   dimana dalam file tanda tangan untuk mencari bagi tanda tangan dibutuhkan
   oleh phpMussel sesuai diharuskan, dan map-map ini dapat menjadi tidak
   disinkronkan dengan file tanda tangan mereka terkait jika file tanda tangan
   yang dirusak dengan. Anda dapat menempatkan apapun yang Anda inginkan dalam
   file-file tanda tangan kustom Anda, asalkan Anda mengikuti sintaks yang
   benar. Namun, berhati-hatilah untuk menguji tanda tangan baru bagi
   false-positif sebelumnya jika Anda berniat untuk berbagi mereka atau
   menggunakannya dalam lingkungan hidup.

 = TANDA TANGAN PEMECAH-MECAHAN =
   Berikut adalah pemecah-mecahan dari tipe tanda tangan yang digunakan
   phpMussel:
   - "Tanda tangan ASCII normal" (ascii_*). Dicek pada isi dari apapun file
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan diperpanjang kompleks" (coex_*). Campuran pencocokan jenis
      tanda tangan.
   - "Tanda tangan ELF" (elf_*). Dicek pada isi dari apapun file tidak bertanda
      putih, ditargetkan untuk dipindai dan dicocokkan ke format ELF.
   - "Tanda tangan Portable Executable" (exe_*). Dicek pada isi dari apapun
      file tidak bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke
      format PE.
   - "Tanda tangan Nama file" (filenames_*). Dicek pada nama file dari file
      yang ditargetkan pada pemindaian.
   - "Tanda tangan umum" (general_*). Dicek pada isi dari apapun file tidak
      bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan Grafis" (graphics_*). Dicek pada isi dari apapun file tidak
      bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke apapun
      diketahui format grafis.
   - "Perintah umum" (hex_general_commands.csv). Dicek pada isi dari apapun
      file tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan HTML normal" (html_*). Dicek pada isi dari apapun file HTML
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan Mach-O" (macho_*). Dicek pada isi dari apapun file tidak
      bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke format
      Mach-O.
   - "Tanda tangan Email" (mail_*). Dicek pada variabel $body diparse ke fungsi
      phpMussel_mail(), yang dimaksudkan untuk menjadi body dari pesan-pesan
      email atau entries yang sama (secara potensial post forum dll).
   - "Tanda tangan MD5" (md5_*). Dicek pada hash MD5 dari isi dan ukuran file
      dari apapun file tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan Metadata Arsip" (metadata_*). Dicek pada hash CRC32 dan
      ukuran file dari pertama file berisikan dalam apapun arsip terkompress
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan OLE" (ole_*). Dicek pada isi dari apapun objek tidak
      bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan PDF" (pdf_*). Dicek pada isi dari apapun file PDF tidak
      bertanda putih.
   - "Tanda tangan Portable Executable Sectional" (pe_*). Dicek pada hash MD5
      dan ukuran dari seksi PE dari apapun file tidak bertanda putih,
      ditargetkan untuk dipindai dan dicocokkan ke format PE.
   - "Tanda tangan diperpanjang portable executable" (pex_*). Dicek pada hash
      MD5 dan ukuran dari variabel dari apapun file tidak bertanda putih,
      ditargetkan untuk dipindai dan dicocokkan ke format PE.
   - "Tanda tangan SWF" (swf_*). Dicek pada isi dari apapun file Shockwave
      tidak bertanda putih.
   - "Tanda tangan Putih" (whitelist_*). Dicek pada hash MD5 dari isi dan
      ukuran file dari apapun file ditargetkan untuk dipindai. File dicocokkan
      akan kebal terhadap dari dicocokkan dengan jenis tanda tangan yang
      disebutkan dalam entri daftar putih mereka.
   - "Tanda tangan potongan XML/XDP" (xmlxdp_*). Dicek pada apapun XML/XDP
      potongan ditemukan dari apapun file tidak bertanda putih dan ditargetkan
      untuk dipindai.
     (Catat itu bahwa semua ini tanda tangan dapat dinonaktifkan melalui
      "phpmussel.ini").

                                     ~ ~ ~


 8. MASALAH KOMPATIBILITAS DIKETAHUI

 PHP dan PCRE
 - phpMussel memerlukan PHP dan PCRE untuk mengeksekusi dan berfungsi dengan
   baik. Tanpa PHP, atau tanpa ekstensi PCRE, phpMussel tidak akan mengeksekusi
   atau berfungsi dengan baik. Seharusnya memastikan sistem Anda terinstal PHP
   dan PCRE dan tersedia secara prioritas untuk mengunduh dan menginstal
   phpMussel.

 KOMPATIBILITAS SOFTWARE ANTI-VIRUS

 Untuk banyak bagian, phpMussel seharusnya kompatibel dengan software
 pemindaian virus. Bagaimanapun konflik telah dilaporkan oleh penggunak di masa
 lalu. Informasi di bawah adalah dari virustotal.com, dan menguraikan sejumlah
 angka positif yang salah yang dilaporkan oleh bermacam-macam program
 anti-virus pada phpMussel. Walaupun informasi ini tidak jaminan absolut dari
 apa dan atau tidak mengalami masalah kompatibilitas antara phpMussel dan
 perangkat anti-virus Anda, jika perangkat lunak anti-virus Anda tercatat
 berlawanan dengan phpMussel, Anda seharusnya mempertimbangkan menonaktifkannya
 bekerja dengan phpMussel atau seharusnya mempertimbangkan opsi alternatif ke
 software anti virus atau phpMussel.

 Informasi ini diupdate 7 September 2015 dan cocok untuk semua rilis phpMussel
 dari dua versi minor terbaru versi (v0.6-v0.7a) pada waktu saya menuliskan
 ini.

 Ad-Aware                Tidak masalah
 Agnitum                 Tidak masalah
 AhnLab-V3               Tidak masalah
 AntiVir                 Tidak masalah
 Antiy-AVL               Tidak masalah
 Avast                !  Melaporkan "JS:ScriptSH-inf [Trj]"
 AVG                     Tidak masalah
 Baidu-International     Tidak masalah
 BitDefender             Tidak masalah
 Bkav                 !  Melaporkan "VEXDAD2.Webshell"
 ByteHero                Tidak masalah
 CAT-QuickHeal           Tidak masalah
 ClamAV                  Tidak masalah
 CMC                     Tidak masalah
 Commtouch               Tidak masalah
 Comodo                  Tidak masalah
 DrWeb                   Tidak masalah
 Emsisoft                Tidak masalah
 ESET-NOD32              Tidak masalah
 F-Prot                  Tidak masalah
 F-Secure                Tidak masalah
 Fortinet                Tidak masalah
 GData                   Tidak masalah
 Ikarus                  Tidak masalah
 Jiangmin                Tidak masalah
 K7AntiVirus             Tidak masalah
 K7GW                    Tidak masalah
 Kaspersky               Tidak masalah
 Kingsoft                Tidak masalah
 Malwarebytes            Tidak masalah
 McAfee               !  Melaporkan "New Script.c"
 McAfee-GW-Edition    !  Melaporkan "New Script.c"
 Microsoft               Tidak masalah
 MicroWorld-eScan        Tidak masalah
 NANO-Antivirus          Tidak masalah
 Norman                  Tidak masalah
 nProtect                Tidak masalah
 Panda                   Tidak masalah
 Qihoo-360               Tidak masalah
 Rising                  Tidak masalah
 Sophos                  Tidak masalah
 SUPERAntiSpyware        Tidak masalah
 Symantec                Tidak masalah
 TheHacker               Tidak masalah
 TotalDefense            Tidak masalah
 TrendMicro              Tidak masalah
 TrendMicro-HouseCall    Tidak masalah
 VBA32                   Tidak masalah
 VIPRE                   Tidak masalah
 ViRobot                 Tidak masalah

                                     ~ ~ ~


Terakhir Diperbarui: 11 September 2015 (2015.09.11).
EOF