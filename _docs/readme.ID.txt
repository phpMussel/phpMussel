      _____  _     _  _____  _______ _     _ _______ _______ _______           
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____    

                        { ~ ~ ~ BAHASA INDONESIA ~ ~ ~ }                       
 Terima kasih untuk menggunakan phpMussel, sebuah script php berdasarkan tanda 
    tangan ClamAV di design untuk mendeteksi trojan-trojan, virus-virus dan    
 serangan-serangan lainnya dalam data-data diupload ke system anda dimana saja 
                               script di kaitkan.                              
     PHPMUSSEL HAK CIPTA 2013 dan di atas GNU/GPL V.2 oleh Caleb M (Maikuolan)

                                     ~ ~ ~                                     


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

 Terima kasih khususnya untuk ClamAV buat inspirasi project dan tanda tangan   
 dimana script ini menggunakan ClamAV, tanpa nya script ini tidak akan ada,    
 atau akan mengalami nilai yang kurang baik <http://www.clamav.net/>.          

                                     ~ ~ ~                                     
 Script ini adalah perangkat lunak gratis; anda dapat mendistribusikan kembali 
 dan/atau memodifikasinya dalam batasan dari GNU General Public License,       
 seperti di publikasikan dari Free Software Foundation; baik versi 2 dari      
 License, atau (dalam opsi anda) versi selanjutnya apapun. Script ini          
 didistribusikan untuk harapan dapat digunakan tapi TANPA JAMINAN; tanpa       
 walaupun garansi dari DIPERJUALBELIKAN atau KECOCOKAN UNTUK TUJUAN TERTENTU.  
 Mohon Lihat GNU General Public Licence untuk lebih detail                     
 <http://www.gnu.org/licenses/> <http://opensource.org/licenses/>.             

                                     ~ ~ ~                                     
 Dokumen ini dan paket yang terhubung di dalamnya dapat di unduh secara gratis
 dari Sourceforge <http://sourceforge.net/projects/phpmussel/>.

                                     ~ ~ ~                                     


 2A. BAGAIMANA CARA MENGINSTALL (UNTUK SERVER WEB)

 Saya berharap untuk mempersingkat proses ini dengan membuat sebuah installer
 pada beberapa point di dalam masa depan yang tidak terlalu jauh, tapi
 kemudian, ikuti instruksi-instruksi ini untuk mendapatkan phpMussel bekerja
 pada *banyak system dan CMS:

 1) Dengan membaca ini, Saya asumsikan anda telah mengunduh dan menyimpan copy
    dari script, membuka data terkompres dan isinya dan anda meletakkannya pada
    mesin komputer lokal anda. Dari sini, anda akan latihan di mana di host
    anda atau CMS anda untuk meletakkan isi data terkompres nya. Sebuah
    direktori seperti /public_html/phpmussel/ atau yang lain (walaupun tidak
    masalah anda memilih direktori apa, selama dia aman dan di mana pun yang
    anda senangi) akan mencukupi. Sebelum anda mulai upload, mohon baca dulu..

 2) Buka data "phpmussel.php", lihat baris dengan kata "$vault=" dan gantikan
    kata di antara tanda dengan lokasi asli dari direktori "vault" dari
    phpMussel. Anda akan mendapati direktori dari data terkompres yang anda
    telah unduh. (kecuali anda sedang mengubah script secara keseluruhan, anda
    perlu mempertahankan data dan struktur direktori yang sama dengan yang
    aslinya) direktori "vault" harusnya satu level direktori di bawah
    "phpmussel.php" berada. Simpan data dan tutup.

 3) (Opsional; Sangat direkomendasikan untuk user dengan pengalaman lebih
    lanjut, tapi tidak untuk pemula atau yang tidak berpengalaman): buka
    "phpmussel.ini" (berada di dalam "vault") - Data ini berisikan semua opsi
    operasional yang tersedia untuk phpMussel. Di atas tiap opsi seharusnya ada
    komentar tegas menguraikan tentang apa yang dilakukan dan untuk apa. Atur
    opsi-opsi ini seperti anda lihat cocok, seperti apapun yang cocok untuk
    setup tertentu. Simpan data, tutup.

 4) Upload isi (phpMussel dan data-datanya) ke direktori yang telah kamu
    putuskan sebelumnya (anda tidak memerlukan data readme.XX.txt atau
    change_log.txt yang termasuk tapi kebanyakan anda harus mengupload
    semuanya).

 5) Gunakan perinta CHMOD ke direktori "vault" dengan "777". Direktori utama
    menyimpan isinya (yang anda putuskan sebelumnya), umumnya dapat di biarkan
    sendirian, tapi status perintah "CHMOD" seharusnya di cek jika kamu punya
    izin di system anda (defaultnya, seperti "755").

 6) Selanjutnya anda perlu menghubungkan phpMussel ke system atau CMS. Ada
    beberapa cara yang berbeda untuk menghubungkan script seperti phpMussel ke
    system atau CMS, tetapi yang paling mudah adalah memasukkan script pada
    permulaan dari data murni dari system atau CMS ( satu yang akan secara umum
    di muat ketika seseorang mengakses halaman apapun pada website) berdasarkan
    perintah require atau include. Umumnya, ini akan menjadi sesuatu yang
    disimpan di sebuah direktori seperti "/includes", "/asset" atau
    "/functions" dan akan selalu di namai sesuatu seperti "init.php",
    "common_functions.php","functions.php" atau yang sama. Anda harus bekerja
    pada data apa untuk situasi ini. Untuk melakukannya, sisipkan baris kode
    dibawah pada data murni, menggantikan kata-kata berisikan didalam tanda
    kutip dari alamat data "phpmussel.php" (alamat lokal, tidak alamat HTTP;
    Akan terlihat seperti alamat vault yang di bicarakan sebelumnya.

    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>

   Simpan data dan tutup. Upload kembali.

 7) Pada point ini, kamu telah selesai! Bagaimanapun, kamu mungkin seharusnya
    mencobanya untuk melihat dia bekerja dengan dengan baik. Untuk mencoba data
    keamanan upload, coba mengupload data-data testing yang dimasukkan dalam
    paket di "_testfiles" ke website anda melalui metode upload di browser
    anda. Jika semua bekerja dengan baik, sebuah pesan akan muncul dari
    phpMussel mengkonfirmasikan bahwa upload sudah sukses di blok. Jika tidak
    ada yang terjadi, ada sesuatu yang tidak bekerja dengan baik. Jika anda
    menggunakan fitur-fitur lanjut atau jika anda menggunakan tipe-tipe yang
    lain untuk memeriksa mungkin dengan alat-alat itu, saya sarankan mencoba
    dengan nya untuk memastikan dia bekerja seperti yang diharapkan juga.

                                     ~ ~ ~                                     


 2B. BAGAIMANA CARA MENGINSTALL (untuk CLI)

 Saya berharap untuk mempersingkat proses ini dengan membuat sebuah installer
 dari beberapa poin di dalam masa depan yang tidak terlalu jauh, tapi sampai
 kemudian, turuti instruksi ini untuk membuat phpMussel siap bekerja dengan CLI
 (mohon diingat untuk poin ini, CLI mendukung hanya pada system berbasis
 Windows; Linux dan system-system yang lain akan di persiapkan pada versi
 selanjutnya dari phpMussel):

 1) Dengan membaca ini, Saya asumsikan anda telah mengunduh data terkompres nya
    dan menguraikan isi nya pada mesin komputer lokal anda. Setelah anda telah
    memilih lokasi dari phpMussel, lanjutkan.

 2) phpMussel memerlukan php untuk diinstall pada mesin host untuk
    mengeksekusinya. Jika anda tidak memiliki php pada mesin anda, ikuti
    instruksi yang di supply oleh installer php.

 3) Buka "phpmussel.php", cari baris dimulai dengan "$vault=" dan gantukan
    kata-kata di antara tanda kutip berikut dengan lokasi sebenarnya dari
    direktori "vault" dari phpMussel. Anda akan telah melihat sebuah direktori
    dari file terkompres yang telah didownload. (Jika anda tidak telah mengkode
    ulang keseluruhan script, anda perlu memelihara data yang sama dan struktur
    direktori seperti di dalam file terkompres). Direktori "vault" ini
    seharusnya satu direktori di bawah direktori berisikan "phpmussel.php".
    Simpan data dan tutup.

 4) (Opsional; Sangat direkomendasikan untuk pengguna tingkat lanjut, tapi
    tidak direkomendasikan untuk pemula atau yang tidak berpengalaman): Buka
    "phpmussel.ini" (terletak di dalam "vault") - file ini berisikan semua opsi
    operasional dari phpMussel. Diatas tiap-tiap opsi seharusnya ada komentar
    tegas menguraikan apa yang dilakukan dan untuk apa. Atur opsi ini sampai
    anda melihat cocok, yang cocok untuk setup tertentu. Simpan data dan tutup.

 5) (Opsional) Anda dapat menggunakan phpMussel di dalam mode CLI untuk diri
    anda sendiri dengan menciptakan file batch untuk secara automatis memuat
    php dan phpMussel. Untuk melakukannya, buka sebuah text editor kosong
    seperti Notepad atau Notepad++, ketikkan jalur dari data "php.exe" di dalam
    direktori dari instalasi php anda, diikuti spasi, diikuti dengan jalur
    lengkap dari data "phpmussel.php" di dalam direktori dari instalasi
    phpMussel, simpan data dengan ekstensi ".bat" di simpan di tempat yang anda
    mudah temukan dan klik dua kali pada data itu untuk menjalankan phpMussel
    di masa yang akan datang.

 6) Pada point ini, anda selesai! Bagaimanapun anda seharusnya mencobanya untuk
    memastikan berjalan dengan lancar. Untuk mencek phpMussel, jalankan
    phpMussel dan coba pindai "_testfiles" direktori yang disediakan dengan ini
    paket.

                                     ~ ~ ~                                     


 3A. BAGAIMANA CARA MENGGUNAKAN (UNTUK SERVER WEB)

 phpMussel dimaksudkan sebagai sebuah script yang akan berfungsi dengan baik
 dengan keperluan yang minimum dari sisi anda: Sekali dia telah terinstall,
 pada dasarnya, dia seharusnya bekerja.

 Memindai upload data secara automatis dan di mungkinkan secara default, jadi
 tidak ada yang diperlukan pada anda untuk fungsi ini.

 Bagaimanapun anda juga bisa menginstruksikan phpMussel untuk memindai data,
 direktori atau arsip yang anda spesifikasikan. Untuk melakukannya,
 pertama-tama anda harus memastikan konfigurasi yang cocok di set di data
 phpmussel.ini (cleanup harus dinon aktifkan) dan ketika selesai, di sebuah
 data php yang di hubungkan ke phpMussel, gunakan fungsi berikut pada kode
 anda:

 phpMussel($what_to_scan,$output_type,$output_flatness);

 Dimana:
 - $what_to_scan adalah string atau array, mengarah ke data target, direktori
   target atau array data target dan/atau direktori target.
 - $output_type adalah sebuah integer, mengindikasikan format dimana hasil dari
   memindai yang dikembalikan (sebuah hasil dari -2 mengindikasikan bahwa data
   corrupt dideteksi selama proses memindai dan proses memindai gagal selesai,
   -1 mengindikasikan bawa ekstensi atau addon yang dibutuhkan oleh php untuk
   mengeksekusi pemindaian hilang dan demikian gagal selesai, 0 mengindikasikan
   bahwa pemindaian target tidak ada dan tidak ada yang dipindai 1
   mengindikasikan bahwa target sukses dipindai dan tidak ada masalah
   terdeteksi, dan 2 mengindikasikan target sukses di scan namun ada masalah
   terdeteksi). Nilai 1 menginstruksikan fungsi untuk menghasilkan hasil teks
   yang dapat dibaca manusia. Nilai 2 menginstruksikan fungsi untuk
   menghasilkan hasil teks yang dapat dibaca manusia dan mengekspor hasil ke
   variabel global. Variabel ini opsional, defaultnya 0.
 - $output_flatness adalah sebuah integer, mengindikasikan apakah mengizinkan
   hasil untuk dihasilkan sebagai array atau tidak. Secara normal jika
   pemindaian target berisikan banyak item (seperti direktori atau array)
   hasilnya akan dihasilkan dalam sebuah array (nilai default 0). Nilai 1
   menginstruksikan fungsi untuk membagi array untuk masukan, menghasilkan
   karakter rata berisikan hasil yang dikembalikan. Variabel ini opsional,
   default nya 0.

 Contoh:

   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;

   Menghasilkan seperti ini (sebagai kata-kata):
    Wed, 18 Sep 2013 02:49:46 +0000 Dimulai.
    > Memeriksa '/user_name/public_html/my_file.html':
    -> Tidak ada masalah yang diketahui.
    Wed, 18 Sep 2013 02:49:47 +0000 Selesai.

 Untuk sebuah pemecahan penuh dari jenis tanda tangan phpMussel yang digunakan
 selama pemindaian dan bagaimana dia memegang tanda tangan-tanda tangan ini,
 mencocokkan ke format tanda tangan dari data README.

 Jika anda menjumpai bilangan positif yang salah, jika anda menemukan hal baru
 yang harus di blok atau untuk apapun dalam tanda tangan mohon hubungi saya
 mengenainya sehingga saya boleh membuat perubahan yang perlu, dimana, jika
 anda tidak menghubungi saya saya tidak tahu.

 Untuk menonaktifkan tanda tangan-tanda tangan yang dimasukkan dalam phpMussel
 (seperti jika anda berpengalaman sebuah angka positif yang salah untuk tujuan
 anda yang seharusnya secara normal di hapus dari aliran), mencocokkan ke
 catatan berwarna abu-abu didalam perintah browser dari data README.

 Sebagai tambahan dari data default mengupload pemindaian dan pemindaian
 opsional dari data-data dan/atau direktori lain yang dispesifikasikan melalui
 fungsi di atas, termasuk di dalam phpMussel adalah sebuah fungsi yang
 dimaksudkan untuk memindai body dari pesan email. Fungsi ini berlaku sama
 dengan standard fungsi phpMussel(), tetapi satu-satunya berfokus untuk
 mencocokkan pada tanda tangan ClamAV. Saya belum mengikat tanda tangan-tanda
 tangan ini ke dalam standard fungsi phpMussel(), karena sepertinya tidak akan
 pernah anda menemukan body dari pesan email masuk untuk pemindaian di dalam
 sebuah data upload yang ditargetkan untuk sebuah halaman dimana phpMussel
 dihubungkan, dan kemudian untuk mengikat tanda tangan ini ke dalam fungsi
 phpMussel yang akan redundan. Bagaimanapun seperti dibicarakan memiliki
 sebuah fungsi terpisa untuk mencocokkan dengan tanda tangan ini dapat
 membuktikan sangat berguna untuk beberapa, khususnya untuk CMS atau system
 webfront yang diikatkan ke system email dan untuk ke mereka yang memparsing
 email mereka melalui script php dari mana mereka dapat dengan potensial
 dikaitkan dengan phpMussel. Konfigurasi untuk fungsi ini, seperti yang lain,
 di atur melalui data phpmussel.ini. Untuk menggunakan fungsi ini (Anda akan
 memerlukan untuk melakukan implementasi anda sendiri), di dalam sebuah data
 php yang di kaitkan ke phpMussel, gunakan fungsi ini di dalam kode:

 phpMussel_mail($body);

 Dimana $body adalah body dari pesan email yang anda ingin scan (sebagai
 tambahan anda dapat mencoba memindai post forum terbaru, pesan masuk dari form
 kontak online atau sejenisnya). Jika ada error terjadi mencegah fungsi ini
 selesai memindai, nilai -1 akan dihasilkan. Jika fungsi selesai memindai dan
 tidak cocok dengan apapun, nilai 0 akan dikembalikan (berarti bersih). Jika,
 bagaimanapun fungsi tidak cocok dengan apapun, sebuah string akan dihasilkan
 berisikan sebuah pesan mendeklarasikan apa yang dicocokkannya.

 Sebagai tambahan, jika anda melihat kode, anda boleh melihat fungsi
 phpMusselD() dan phpMusselR(). fungsi-fungsi ini adalah sub fungsi dari
 phpMussel(), dan seharusnya tidak di namakan secara langsung di luar dari
 fungsi parent (tidak karena efek-efek adverse.. Lebih lagi, sederhananya
 karena dia melayani tanpa tujuan dan kebanyakan kemungkinan tidak bekerja
 dengan baik).

 Ada banyak kontrol-kontrol dan fungsi-fungsi tersedia di dalam phpMussel untuk
 penggunaan anda juga. Untuk kontrol-kontrol dan fungsi-fungsi yang dalam akhir
 seksi READMI yang belum didokumentasikan mohon teruskan membaca dan merefer
 dari perintah seksi Browser dari data README.

                                     ~ ~ ~                                     


 3B. BAGAIMANA CARA MENGGUNAKAN (UNTUK CLI)

 Mohon merujuk pada seksi "BAGAIMANA CARA MENGINSTALL (UNTUK CLI)" dari data
 readme.

 Mohon diingat, walaupun versi selanjutnya dari phpMussel seharusnya mendukung
 system yang lain, pada waktu ini, mode pendukung phpMussel CLI hanya di
 optimisasi untuk system berbasis Windows (anda dapat, tentu saja, mencoba
 pada system yang lain, tapi saya tidak dapat menjamin dapat bekerja seperti
 bagaimana seharusnya).

 Mohon diingat bahwa phpMussel tidak sama dengan anti virus dan tidak seperti
 anti virus, tidak memonitor memori aktif atau mendeteksi virus secara
 langsung. phpMussel Hanya mendeteksi virus dalam data-data yang anda
 perintahkan untuk dipindai.

                                     ~ ~ ~                                     


 4A. PERINTAH-PERINTAH BROWSER

 Sekali phpMussel telah diinstal dan dengan benar berfungsi pada sistem anda,
 jika anda telah menset variabel script_password dan logs_password di dalam
 data konfigurasi anda, anda akan dapat melakukan sejumlah fungsi administratif
 dan memasukkan beberapa perintah ke phpMussel melalui browser anda. Alasannya
 sandi-sandi harus di set untuk memungkinkan kontrol-kontrol dari sisi browser
 adalah untuk meyakinkan keamanan yang teratur, perlindungan teratur dari
 kontrol dari sisi browser dan memastikan bahwa ada cara untuk kontrol-kontrol
 untuk semuanya dinonaktifkan jika tidak diinginkan oleh anda dan/atau
 webmaster/administrator menggunakan melalui phpMussel. Jadi dengan kata lain,
 untuk memungkinkan kontrol-kontrol ini, menset sandi dan menonaktifkan
 kontrol-kontrol ini, set tidak ada password. Alternatif lain, jika anda
 memilih memungkinkan kontrol-kontrol ini dan kemudian memilih untuk
 menonaktifkan kontrol ini pada hari yang lain, ada perintah untuk melakukan
 ini (yang mana yang berguna jika anda melakukan beberapa aksi yang anda rasa
 dapat secara potensial berkompromi dengan password terdelegasi dan perlu untuk
 dengan cepat menonaktifkan kontrol-kontrol ini tanpa memodifikasi data
 konfigurasi anda).

 Beberapa alasan mengapa anda -seharusnya- mengaktifkan kontrol-kontrol ini:
 - Menyediakan jalan untuk mewarnai biru tanda tangan secara langsung di dalam
   instansi-instansi seperti ketika anda menemukan sebuah tanda tangan yang
   memproduksi sebuah angka positif yang salah selama mengupload file ke sistem
   anda dan anda tidak punya waktu untuk secara manual mengedit dan mengupload
   ulang data greylist anda.
 - Menyediakan sebuah jalan untuk anda mengizinkan seseorang lain dari anda
   untuk mengatur kopi dari phpMussel tanpa keperluan implisit untuk memberi
   hak akses ke FTP.
 - Menyediakan sebuah cara untuk menyediakan akses terkontrol ke data log anda.
 - Menyediakan cara yang mudah untuk mengubah phpMussel ketika update tersedia.
 - Menyediakan cara untuk anda untuk memonitor phpMussel ketika FTP akses atau
   akses poin konvensional untuk memonitor phpMussel tidak tersedia.

 Beberapa alasan mengapa anda seharusnya -tidak- mengaktifkan kontrol-kontrol
 ini:
 - Menyediakan sebuah vektor untuk penyerang potensial dan tidak diharapkan
   untuk menentukan apakah anda menggunakan phpMussel atau tidak (walaupun,
   ini dapat menjadi alasan mengapa atau alasan perdebatan, bergantung pada
   perspektif) dengan cara buta mengirim perintah ke server dalam penyelidikan.
   Dalam cara lain, ini dapat menghalangi penyerang dari menargetkan sistem
   anda jika mereka belajar bahwa anda menggunakan phpMussel, asumsi jika
   mereka menyelidiki karena serangan mereka dialirkan tidak efektif karena
   menggunakan phpMussel. Bagaimanapun, pada cara lain, jika beberapa tidak
   terlihat dan eksploitasi yang tidak diketahui di dalam phpMussel atau versi
   selanjutnya akan ada cahaya, dan jika dapat secara potensial menyediakan
   sebuah vektor serangan, sebuah hasil positif dari penyelidikan dapat
   mendorong penyerang menargetkan sistem anda.
 - Jika sandi delegasi anda pernah dikompromikan atau diubah dapat menyediakan
   sebuah cara untuk penyerang membypass tanda tangan apapun mungkin jika tidak
   secara normal menghindari serangan mereka dari kesuksesan, atau juga secara
   potensial menonaktifkan phpMussel bersamaan, juga menyediakan sebuah cara
   untuk mengalirkan keefektifan dari phpMussel yang dibicarakan.

 Cara lain, tanpa bergantung dengan apa yang anda pilih, pilihan adalah milik
 anda. Secara default, kontrol-kontrol ini akan dinonaktifkan, tapi harus
 berpikir tentang nya, dan jika anda memutuskan untuk menginginkannya, seksi
 ini akan menjelaskan tentang cara mengaktifkan dan menggunakannya.

 Daftar dari perintah-perintah dari sisi browser:

 scan_log
   Sandi diperlukan: logs_password
   Keperluan lain: scan_log harus didefinisikan.
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Apa yang dilakukan: Mencetak isi dari data scan_log ke layar.
   ~
 scan_kills
   Sandi diperlukan: logs_password
   Keperluan lain: scan_kills harus didefinisikan.
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Apa yang dilakukan: Mencetak isi dari data scan_kills ke layar.
   ~
 controls_lockout
   Sandi diperlukan: logs_password ATAU script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Contoh 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Apa yang dilakukannya: Menonaktifkan ("Mengunci") semua kontrol dari sisi
                          browser. Ini seharusnya digunakan jika anda menyangka
                          bahwa sandi-dandi telah dikompromikan (ini dapat
                          terjadi jika anda sedang menggunakan kontrol-kontrol
                          ini dari sebuah komputer yang tidak aman dan/atau
                          tidak terpercaya). controls_lockout bekerja dengan
                          menciptakan sebuah file, controls.lck, di dalam
                          vault anda, yang mana phpMussel akan mencek sebelum
                          melakukan perintah-perintah apapun. Setelah ini
                          terjadi, untuk kembali mengaktifkan kontrol-kontrol,
                          anda akan memerlukan untuk menghapus data
                          controls.lck via FTP atau sejenisnya. Dapat dipanggil
                          melalui sandi.
   ~
 disable
   Sandi diperlukan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=disable
   ~
   Apa yang dilakukannya: Menonaktifkan phpMussel. Ini harusnya digunakan jika
                          anda melakukan update apapun atau perubahan ke sistem
                          anda atau jika anda menginstall software baru apapun
                          atau modul ke sistem yang melakukan atau secara
                          potensial dapat menyebabkan angka positif salah. Ini
                          harusnya juga digunakan jika anda memiliki
                          masalah-masalah dengan phpMussel tapi tidak ingin
                          menghapus nya dari system. Sekali ini terjadi
                          aktifkan kembali phpMussel, gunakan "enable".
   ~
 enable
   Sandi diperlukan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=enable
   ~
   Apa yang dilakukannya: Mengaktifkan phpMussel. Ini dapat digunakan jika anda
                          sebelumnya menonaktifkan phpMussel menggunakan
                          "disable" dan ingin mengaktifkannya lagi.
   ~
 update
   Sandi diperlukan: script_password
   Keperluan lain: update.dat dan update.inc harus ada.
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: forcedupdate
   Contoh: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   Apa yang dilakukannya: Cek untuk mengupdate ke phpMussel dan tanda
                          tangannya. Jika update cek sukses dan update
                          ditemukan, akan berusaha mendownload dan menginstall
                          update-update ini. Jika update di cek terlalu cepat,
                          update cek akan berhenti jika update cek gagal,
                          update akan berhenti. Jika parameter opsional
                          "forcedupdate" disupply, waktu terakhir update akan
                          diabaikan dan kemudian update check akan lanjut
                          walaupun jika dia sedang dicek "too quickly" tapi
                          tetap akan berhenti jika update cek gagal.
                          Hasil-hasil dari keseluruhan proses akan di cetak ke
                          layar. Saya rekomendasikan memasukkan opsional
                          parameter "forcedupdate" jika anda secara manual
                          menyebabkan kontrol ini, tapi mohon jangan gunakan
                          "forcedupdate" jika anda mengautomatisasi proses
                          tersebut, seperti via cron atau sejenis. Saya
                          rekomendasikan mencek setidaknya satu per bulan untuk
                          memastikan tanda tangan anda dan kopi dari phpMussel
                          di pastikan up to-date( Kecuali jika, tentu saja
                          anda mencek update dan menginstall secara manual,
                          yang mana, saya masih merekomendasikan melakukannya
                          setidaknya satu per bulan). Mencek lebih dari 2 per
                          bulan kemungkinan tidak bertujuan, mengingat saya
                          (saat menulis ini) bekerja pada proyek ini sendiri
                          dan saya sangat tidak bisa memproduksi update lebih
                          sering dari itu (Walaupun saya khususnya ingin
                          melakukannya).
   ~
 greylist
   Sandi diperlukan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: [Name of signature to be greylisted]
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   Apa yang dilakukannya: Menambah tanda tangan pada greylist.
   ~
 greylist_clear
   Sandi diperlukan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Apa yang dilakukannya: Membersihkan keseluruhan greylist.
   ~
 greylist_show
   Sandi diperlukan: script_password
   Keperluan lain: (tidak ada)
   Parameter-parameter yang diperlukan: (tidak ada)
   Parameter-parameter opsional: (tidak ada)
   Contoh: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Apa yang dilakukannya: Mencetak isi dari greylist ke layar.
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

 Berikut list dari semua data yang diikutkan di dalam kopi script yang
 dikompres ketika anda mendownloadnya, setiap data-data yang secara
 potensial diciptakan sebagai hasil dari menggunakan script ini, sejalan dengan
 deskripsi singkat dari untuk apa data-data ini.

 /phpmussel.php (Script, Diikutkan)
    data pemuat phpMussel. Memuat script utama, pengupdate, dll.
    Ini yang apa anda ingin masukkan  (utama)!
    ~
 /web.config (Lainnya, Diikutkan)
    Sebuah data konfigurasi ASP.NET (dalam instansi ini, untuk melindungi
    direktori "/vault" dari pengaksesan oleh sumber-sumber tidak terauthorisasi
    dalam kejadian yang mana skrip ini diinstal pada server berbasis teknologi
    ASP.NET).
    ~
 /_docs/ (Directory)
    Direktori dokumentasi (berisi bermacam data).
    ~
 /_docs/change_log.txt (Dokumentasi, Diikutkan)
    Sebuah rekaman dari perubahan yang dibuat pada script ini di antara
    perbedaan versi (tidak dibutuhkan untuk fungsi teratur dari script).
    ~
 /_docs/readme.DE.txt (Dokumentasi, Diikutkan); DEUTSCH
 /_docs/readme.EN.txt (Dokumentasi, Diikutkan); ENGLISH
 /_docs/readme.ES.txt (Dokumentasi, Diikutkan); ESPAÑOL
 /_docs/readme.FR.txt (Dokumentasi, Diikutkan); FRANÇAIS
 /_docs/readme.ID.txt (Dokumentasi, Diikutkan); BAHASA INDONESIA
 /_docs/readme.IT.txt (Dokumentasi, Diikutkan); ITALIANO
 /_docs/readme.NL.txt (Dokumentasi, Diikutkan); NEDERLANDSE
 /_docs/readme.PT.txt (Dokumentasi, Diikutkan); PORTUGUÊS
    File-file baca saya (misalnya; file yang anda sedang membaca).
    ~
 /_docs/signatures_tally.txt (Dokumentasi, Diikutkan)
    Perhitungan dari diikutkan tanda tangan (tidak dibutuhkan untuk fungsi
    teratur dari script).
    ~
 /_testfiles/ (Directory)
    Direktori test data-data (berisi bermacam data).
    Semua data-data berisikan di dalamnya adalah data test untuk testing jika
    phpMussel dengan benar diinstal pada sistem, dan anda tidak perlu
    mengupload direktori ini atau data-datanya jika melakukan testing.
    ~
 /_testfiles/ascii_standard_testfile.txt (Data test, Diikutkan)
    Data test untuk mentest tanda tangan ASCII normal phpMussel.
    ~
 /_testfiles/exe_standard_testfile.exe (Data test, Diikutkan)
    Data test untuk mentest tanda tangan PE phpMussel.
    ~
 /_testfiles/general_standard_testfile.txt (Data test, Diikutkan)
    Data test untuk mentest tanda tangan umum phpMussel.
    ~
 /_testfiles/graphics_standard_testfile.gif (Data test, Diikutkan)
    Data test untuk mentest tanda tangan grafis phpMussel.
    ~
 /_testfiles/html_standard_testfile.txt (Data test, Diikutkan)
    Data test untuk mentest tanda tangan HTML normal phpMussel.
    ~
 /_testfiles/md5_testfile.txt (Data test, Diikutkan)
    Data test untuk mentest tanda tangan MD5 phpMussel.
    ~
 /_testfiles/metadata_testfile.txt.gz (Data test, Diikutkan)
    Data test untuk mentest tanda tangan metadata phpMussel dan untuk testing
    data support GZ pada sistem anda.
    ~
 /_testfiles/metadata_testfile.zip (Data test, Diikutkan)
    Data test untuk mentest tanda tangan phpMussel dan untuk testing data
    support ZIP pada sistem anda.
    ~
 /_testfiles/ole_testfile.ole (Data test, Diikutkan)
    Data test untuk mentest tanda tangan OLE phpMussel.
    ~
 /_testfiles/pe_sectional_testfile.exe (Data test, Diikutkan)
    Data test untuk mentest tanda tangan PE Sectional phpMussel.
    ~
 /_testfiles/xdp_standard_testfile.xdp (Data test, Diikutkan)
    Data test untuk mentest tanda tangan potongan XML/XDP phpMussel.
    ~
 /vault/ (Directory)
    Direktori Vault  (berisikan bermacam file).
    ~
 /vault/.htaccess (Lainnya, Diikutkan)
    Sebuah data akses hypertext (pada instansi ini, untuk melindungi data-data
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
    Data-data untuk tanda tangan ASCII normal.
    Diperlukan jika tanda tangan opsi ASCII normal di dalam phpmussel.ini
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan
    diciptakan kembali pada saat mengupdate).
    ~
 /vault/elf_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/elf_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/elf_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/elf_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/elf_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/elf_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan ELF.
    Diperlukan jika tanda tangan opsi ELF di dalam phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptakan
    kembali pada saat mengupdate).
    ~
 /vault/exe_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/exe_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/exe_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/exe_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/exe_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/exe_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk data tanda tangan portable yang dapat dieksekusi.
    Diperlukan jika opsi tanda tangan EXE di dalam phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
    ~
 /vault/filenames_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/filenames_custom.cvd (Tanda tangan, Diikutkan)
 /vault/filenames_mussel.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan nama file.
    Diperlukan jika opsi tanda tangan di dalam phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
    ~
 /vault/general_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/general_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/general_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/general_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/general_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/general_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan umum.
    Diperlukan jika opsi tanda tangan di dalam phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
    ~
 /vault/graphics_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/graphics_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/graphics_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan grafis.
    Diperlukan jika opsi tanda tangan grafis di dalam phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
    ~
 /vault/greylist.csv (Tanda tangan, Diikutkan/Diciptakan)
    CSV terdiri dari tanda tangan greylist mengindikasikan phpMussel tanda
    tangan mana yang harus diabaikan (data automatis diciptakan kembali jika
    dihapus).
    ~
 /vault/hex_general_commands.csv (Tanda tangan, Diikutkan)
    CSV terencode Hex dari deteksi perintah umum secara opsional digunakan
    phpMussel. Diperlukan jika opsi deteksi perintah umum di dalam
    phpmussel.ini diaktifkan. Dapat menghapus jika opsi dinonaktifkan (tapi
    data-data akan diciptkan kembali pada saat mengupdate).
    ~
 /vault/html_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/html_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/html_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/html_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/html_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/html_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan HTML normal.
    Diperlukan jika tanda tangan opsi HTML normal di dalam phpmussel.ini
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan
    diciptakan kembali pada saat mengupdate).
    ~
 /vault/lang.inc (Script, Included)
    phpMussel Bahasa Data; Diperlukan untuk kemampuan multibahasa.
    ~
 /vault/macho_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/macho_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/macho_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/macho_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/macho_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/macho_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan Mach-O.
    Diperlukan jika opsi tanda tangan Mach-O di phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
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
    Data-data untuk tanda tangan yang digunakan oleh fungsi phpMussel_mail().
    Diperlukan jika fungsi phpMussel_mail() digunakan dalam jalan apapun.
    Dapat menghapus jika tidak digunakan (tapi data-data akan diciptakan
    kembali pada saat update).
    ~
 /vault/md5_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/md5_custom.cvd (Tanda tangan, Diikutkan)
 /vault/md5_mussel.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan berbasis MD5.
    Diperlukan jika opsi tanda tangan berbasis MD5 diaktifkan. Dapat menghapus
    jika tidak digunakan (tapi data-data akan diciptakan kembali pada saat
    update).
    ~
 /vault/metadata_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/metadata_custom.cvd (Tanda tangan, Diikutkan)
 /vault/metadata_mussel.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan meta data yang terkompres.
    Diperlukan jika tanda tangan meta data dalam opsi di phpmussel.ini di
    aktifkan. Dapat menghapus jika opsi di nonaktifkan (data akan diciptakan
    kembali saat upgrade).
    ~
 /vault/ole_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/ole_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ole_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/ole_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/ole_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/ole_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan OLE.
    Diperlukan jika opsi tanda tangan OLE di phpmussel.ini diaktifkan. Dapat
    menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan kembali
    pada saat mengupdate).
    ~
 /vault/pe_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/pe_custom.cvd (Tanda tangan, Diikutkan)
 /vault/pe_mussel.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan PE Sectional.
    Diperlukan jika opsi tanda tangan PE Sectional di phpmussel.ini diaktifkan.
    Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan diciptkan
    kembali pada saat mengupdate).
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
    Sebuah catatan dari apapun yang di pindai oleh phpMussel.
    ~
 /vault/scan_kills.txt *(Data catatan, Diciptakan)
    Sebuah catatan dari setiap data upload yang diblok/dibunuh oleh phpMussel.
    ~
 /vault/template.html (Lainnya, Diikutkan)
    Data template phpMussel; Template untuk output HTML yang diproduksi oleh
    phpMussel untuk data pesan upload yang dibloknya  (Pesan dilihat oleh
    pengupload).
    ~
 /vault/update.dat (Lainnya, Diikutkan)
    Data berisi informasi versi untuk skrip phpMussel dan tanda tangan
    phpMussel. Jika anda pernah ingin mengupgrade phpMussel atau ingin
    mengupdate phpMussel via browser file ini penting.
    ~
 /vault/update.inc (Skrip, Diikutkan)
    Skrip upgrade phpMussel; Diperlukan untuk upgrade otomatis dan untuk 
    mengupgrade phpMussel via browser anda, tapi tidak diperlukan juga.
    ~
 /vault/whitelist_clamav.cvd (Tanda tangan, Diikutkan)
 /vault/whitelist_custom.cvd (Tanda tangan, Diikutkan)
 /vault/whitelist_mussel.cvd (Tanda tangan, Diikutkan)
    File spesifik whitelist.
    Diperlukan jika opsi Whitelist di phpmussel.ini diaktifkan dan jika ingin
    Anda spesifik file bertanda putih. Dapat menghapus jika opsi dinonaktifkan
    atau jika Anda tidak memerlukan spesifik file bertanda putih (tapi
    data-data akan diciptkan kembali pada saat mengupdate).
    ~
 /vault/xmlxdp_clamav_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_regex.map (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_standard.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_clamav_standard.map (Tanda tangan, Diikutkan)
 /vault/xmlxdp_custom_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_custom_standard.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_mussel_regex.cvd (Tanda tangan, Diikutkan)
 /vault/xmlxdp_mussel_standard.cvd (Tanda tangan, Diikutkan)
    Data-data untuk tanda tangan potongan XML/XDP.
    Diperlukan jika opsi tanda tangan potongan XML/XDP di phpmussel.ini
    diaktifkan. Dapat menghapus jika opsi dinonaktifkan (tapi data-data akan
    diciptkan kembali pada saat mengupdate).
    ~

 * Nama file bisa berbeda berdasarkan ketentuan konfigurasi (di dalam
   phpmussel.ini).

 = BERDASARKAN DATA-DATA TANDA TANGAN =
    CVD adalah akronim dari "ClamAV Virus Definitions", dalam referensi dari
    bagaimana ClamAV merujuk ke tanda tangan- tanda tangan nya sendiri dan
    penggunaan dari tanda tangan-tanda tangan itu untuk phpMussel; Data
    berakhir dengan "CVD" berisikan tanda tangan.
    ~
    Data berakhir dengan "MAP", secara harfiah, memetakan tanda tangan mana
    phpMussel seharusnya dan seharusnya tidak gunakan untuk pemindaian
    individual. Tidak semua tanda tangan secocoknya diperlukan untuk pemindaian
    tunggal, jadi, phpMussel menggunakan peta-peta dari data-data tanda tangan
    untuk mempercepat proses pemindaian (sebuah proses yang akan menjadi lambat
    dan monoton).
    ~
    Data-data tanda tangan ditandai dengan "_regex" berisikan tanda
    tangan-tanda tangan yang mengarahkan bentuk pengecekan regular expression
    (regex).
    ~
    Data-data tanda tangan ditandai dengan "_standard" berisikan tanda
    tangan-tanda tangan yang secara spesifik tidak mengarahkan bentuk
    pengecekan apapun.
    ~
    Data-data tanda tangan tidak ditandai dengan "_regex" atau "_standard" akan
    menjadi satu atau yang lain, tapi tidak keduanya (merujuk pada seksi format
    tanda tangan dari data README untuk dokumentasi dan detail spesifik).
    ~
    Data-data tanda tangan ditandai dengan "_clamav" berisikan tanda tangan
    yang berasal dari basis data ClamAV (GNU/GPL).
    ~
    Data-data tanda tangan ditandai dengan  "_custom", secara default,
    tidak berisikan tanda tangan apapun; Data-data ini ada untuk memberikan
    anda kemana saja untuk meletakkan tanda tangan anda jika anda datang
    dengan milik diri anda sendiri.
    ~
    Data-data tanda tangan ditandai dengan "_mussel" berisikan tanda tangan
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
      sandi untuk diikutkan pada perintah, untuk memastikan bahwa itu anda dan
      bukan orang lain, yang berusaha secara manual membangkitkan fungsi-fungsi
      ini. Set script_password untuk sandi apapun yang anda mau gunakan. Jika
      tidak ada password diset, pembangkitan manual akan di non aktifkan secara
      default. Gunakan hal yang mudah anda ingat tapi susah untuk orang lain
      hapal.
      * Tidak memiliki pengaruh di dalam mode CLI.
    "logs_password"
    - Sama seperti script_password tapi untuk melihat semua isi dari scan_log
      dan scan_kills. Memiliki sandi yang lain dapat bergunan jika anda ingin 
      memberikan akses pada orang lain untuk mengakses dan menset fungsi tapi
      tidak yang lain.
      * Tidak memiliki pengaruh di dalam mode CLI.
    "cleanup"
    - Jangan diset variabel skrip dan cache setelah eksekusi. Jika anda tidak
      menggukan skrip di bawah pemindaian upload inisial, harus di set ke yes
      untuk meminimalisasi penggunaan memori. Jika anda menggunakan skrip untuk
      tujuan di bawah pemindaian upload inisial, harus di set ke no, untuk
      menghindari reload duplikat data ke memori. Dalam praktek umum, haru di
      set ke yes, tapi jika kamu melakukannya, kamu tidak bisa menggunakan
      script untuk hal lain kecuali pemindaian upload data.
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
      PERINGATAN: Jangan ganti ini kecuali anda tahu apa yang anda lakukan!
    "forbid_on_block"
    - Seharusnya phpMussel mengirimkan 403 headers dengan pesan upload data
      yang terblok, atau cocok dengan 200 OK?
      0 = Tidak (200) [Default], 1 Ya (403).
    "delete_on_sight"
    - Mengaktifkan opsi ini akan menginstruksikan skrip untuk berusaha
      secepatnya menghapus data apapun yang ditemukannya selama scan yang
      mencocokkan pada kriteria deteksi apapun, baik melalui tanda tangan atau
      yang lain. Data-data ditentukan "clean" tidak akan disentuh. Pada kasus
      file terkompress seluruh file terkompress akan didelate (kecuali data
      yang menyerang adalah satu-satunya dari beberapa file yang menjadi isi
      file terkompress). Untuk kasus pemindaian upload data biasanya, tidak
      cocok untuk mengaktifkan opsi ini, karena biasanya php akan secara
      otomatis menyatukan isi dari cache ketika eksekusi selesai, berarti bahwa
      dia akan selalu menghapus data terupload apapun melalui server jika tidak
      dipindahkan, dikopi atau dihapus sebelumnya. Opsi tersebut ditambahkan
      di sini sebagai ukuran extra dari keamanan atau untuk paranoid ekstra dan
      untuk semua yang mengkopi php yang tidak boleh bersikap pada perilaku
      yang dimaksudkan.
      0 - Setelah pemindahaian, biarkan data  [Default],
      1 - Setelah pemindaian, jika tidak bersih, hapus langsung.
    "lang"
    - Tentukan bahasa default untuk phpMussel.
 "signatures" (Kategori)
 - Configuration for signatures.
   %%%_clamav = Tanda tangan ClamAV (kedua-duanya utama dan harian).
   %%%_custom = Tanda tangan terubah  (Jika anda merubahnya).
   %%%_mussel = Tanda tangan phpMussel dimasukkan dalam tanda tangan tersebut
                dari yang bukan dari ClamAV.
   - Cek tanda tangan MD5 ketika pemindaian? 0 = Tidak, 1 = Ya [Default].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Cek tanda tangan umum ketika pemindaian? 0 = Tidak, 1 = Ya [Default].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Cek tanda tangan ASCII normal ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Cek tanda tangan HTML normal ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Cek file PE (Portable Executable; EXE, DLL, etc) pada tanda tangan PE
     Sectional ketika pemindaian? 0 = Tidak, 1 = Ya [Default].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Cek file PE (Portable Executable; EXE, DLL, etc) pada tanda tangan PE
     ketika pemindaian? 0 = Tidak, 1 = Ya [Default].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Cek data-data ELF pada tanda tangan ELF ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Cek data-data Mach-O (OSX, etc) pada tanda tangan Mach-O ketika
     pemindaian? 0 = Tidak, 1 = Ya [Default].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Cek data-data grafis pada tanda tangan grafis ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Cek isi file terkompress pada tanda tangan metadata terkompres ketika
     pemindaian? 0 = Tidak, 1 = Ya [Default].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Cek objek-objek OLE pada tanda tangan OLE ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "ole_clamav"
     "ole_custom"
     "ole_mussel"
   - Cek nama data pada tanda tangan berbasis nama file ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Mengizinkan pemindaian dengan phpMussel_mail()?
     0 = Tidak, 1 = Ya [Default].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Aktifkan whitelist tertentu file? 0 = Tidak, 1 = Ya [Default].
     "whitelist_clamav"
     "whitelist_custom"
     "whitelist_mussel"
   - Cek XML/XDP potongan pada tanda tangan potongan XML/XDP ketika pemindaian?
     0 = Tidak, 1 = Ya [Default].
     "xmlxdp_clamav"
     "xmlxdp_custom"
     "xmlxdp_mussel"
   - Opsi Tanda tangan cocok batas panjangnya. Hanya ubah ini jika anda tahu
     apa yang anda lakukan. SD = Standard tanda tangan. RX = Tanda tangan PCRE
     (Perl Compatible Regular Expressions, "Regex"). FN = Tanda tangan Nama
     Data. Jika anda melihat php crashing ketika phpMussel meoncoba memindai,
     coba merendahkan nilai "max" di bawah. Jika mungkin dan cocok, biarkan
     saya tahu kapan ini terjadi dan hasil dari apapun yang anda coba.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   - Seharusnya laporan phpMussel ketika data tanda tangan hilang atau
     corrupted? Jika fail_silently dinonaktifkan, data corrupted dan hilang
     akan di laporkan ketika pemindaian, dan jika fail_silently diaktifkan,
     data corrupted dan hilang akan diabaikan, dengan pemindaian dilaporkan
     untuk data-data ini bahwa tidak ada masalah. Ini harus dibiarkan
     sendirian jika anda pernah mengalami crashes atau masalah lain.
     0 = Disabled [Default], 1 = Enabled.
     "fail_silently"
 "files" (Kategori)
 - Konfigurasi umum untuk mengambil alih data-data.
   "max_uploads"
   - Maksimum jumla Data-data yang diizinkan untuk dipindai selama pemindaian
     upload data sebelum menghentikan pemindaian dan menginformasikan pengguna
     bahwa pengguna mengupload terlalu banyak! Menyediakan perlindungan pada
     serangan teoritis dimana penyerang mencoba DDoS pada sistem anda atau CMS
     ada dengan overloading phpMussel supaya berjalan lambat. Proses php ke
     penghentian keras.
     Recommendasi: 10. Anda dapat menaikkan atau menurunkan angka ini
     bergantung dari kecepatan hardware anda. Catatan jika nomor ini tidak
     mengakuntabilitas atau mengikutkan konten dari file terkompres.
   "filesize_limit"
   - Batasan ukuran file dalam KB. 65536 = 64MB [Default], 0 = Tidak ada batasa
     (selalu bertanda abu-abu), nilai angka positif apapun diterima. Ini dapat
     berguna ketika batasan konfigurasi php anda membatasi jumah memori dari
     proses yang dapat ditampungnya atau jika konfigurasi php anda membatasi
     jumlah ukuran upload anda.
   "filesize_response"
   - Apa yang anda lakukan dengan data-data yang melebihi batasan ukuran (jika
     ada).
     0 - Bertanda putih, 1 - Bertanda hitam [Default].
   "filetype_whitelist" dan "filetype_blacklist"
   - Jika sistem anda hanya mengizinkan tipe data yang diupload atau jika
     sistem anda secara eksplisit menolak tipe data-data tertentu,
     menspesifikasikan tipe data dalam bertanda putih dan bertanda hitam dapat
     menaikkan kecepatan dari pemindaian dilakukan dengan mengizinkan skrip
     untuk mengabaikan tipe data tertentu. Format adalah CSV (comma separated
     values). Jika anda ingin memindai semuanya, daripada whitelist atau
     blacklist, tinggalkan variabel kosong (melakukannya akan menonaktifkan
     whitelist/blacklist).
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
   - Memperlalaikan ukuran blacklisting/whitelisting dari isi data terkompress?
     0 - Tidak (Greylist semua), 1 - Ya [Default].
   "filetype_archives"
   - Memperlalaikan jenis file blacklisting/whitelisting dari isi data
     terkompress? 0 - No (Greylist semua) [Default], 1 - Ya.
   "max_recursion"
   - Dalam rekursi dari data terkompres. Default = 10.
 "attack_specific" (Kategori)
 - Konfigurasi dari deteksi serangan spesifik (tidak berdasarkan CVDs).
   * Chameleon attack detection: 0 = Off, 1 = On.
   "chameleon_from_php"
   - Cari header php tidak di dalam data-data php atau data terkompress.
   "chameleon_from_exe"
   - Cari header yang dapat dieksekusi di dalam data-data yang dapat
     dieksekusi atau data terkompress yang dikenali dan untuk data dapat
     dieksekusi yang headernya tidak benar.
   "chameleon_to_archive"
   - Cari data terkompress yang header nya tidak benar (Mendukung: BZ, GZ, RAR,
     ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Cari dokumen office yang header nya tidak benar (Mendukung: DOC, DOT,
     PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Cari gambar yang header nya tidak benar (Mendukung: BMP, DIB, PNG, GIF,
     JPEG, JPG, XCF, PSD, PDD).
   "chameleon_to_pdf"
   - Cari data PDF yang headernya tidak benar.
   "archive_file_extensions" dan "archive_file_extensions_wc".
   - Ekstensi data terkompres yang dikenali (format nya CSV; seharusnya hanya
     menambah atau menghapus ketika masalah terjadi; Tidak cocok langsung
     menghapus karena dapat menyebabkan angka positif yang salah terjadi
     pada data terkompres, dimana juga menambahkan deteksi; memodifikasi dengan
     peringatan; Juga dicatat bahwa ini tidak memberi efek pada data
     terkompress apa yang dapat dan tidak dapat di analisa pada level isi).
     Daftar sebagaimana defaultnya, memberi daftar format-format yang digunakan
     yang paling umum melalui melalui mayoritas system dan CMS, tapi bermaksud
     tidak komprehensif.
   "general_commands"
   - Mencari isi data-data untuk perintah umum seperti eval(), exec() and
     include()? 0 - tidak (tidak mencek) [Default], 1 - Ya (mencek).
     Matikan opsi ini jika anda bermaksud untuk mengupload yang manapun dari
     ini ke sistem ata CMS anda via browser anda: data-data php, JavaScript,
     HTML, python, perl dll. Hidupkan opsi ini jika anda tidak punya tambahan
     perlindungan pada sistem anda dan tidak bermaksud mengupload data-data
     apapun. Jika anda menggunakan keamanan tambahan dalam kata penghubung
     dengan phpMussel seperti ZB Block, tidak perlu menghidupkan opsi ini,
     karena kebanyakan apa yang akan phpMussel cari (dalam konteks opsi ini)
     adalah duplikasi dari perlindungan yang telah disediakan.
   "block_control_characters"
   - Memblokade data apapun yang berisi karakter pengendali (lain dari baris
     baru)? ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) Jika anda hanya sedang mengupload
     data teks biasa, maka anda dapat menghidupkan opsi ini untuk menyediakan
     perlindungan tambahan ke sistem anda. Bagaimanapun jika anda mengupload
     apapun lebih dari data teks biasa, menghidupkan opsi ini mungkin
     mengakibatkan angka positif salah.
     0 - Jangan memblokade [Default], 1 - Memblokade.
   "corrupted_exe"
   - File rusak dan diurai kesalahan.
     0 = Mengabaikan, 1 = Memblokade [Default]. Mendeteksi dan memblokir
     berpotensi rusak PE (Portable Executable) file? Sering (tetapi tidak
     selalu), ketika aspek-aspek tertentu dari file PE yang rusak atau tidak
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
     seperlima dari total alokasi memori yang diijinkan ke php melalui file
     phpmussel.ini konfigurasi. Direktif ini ada untuk mencegah phpMussel
     menggunakan terlalu banyak memori (yang bisa mencegah dari yang berhasil
     memindai file di atas tertentu ukuran file).
 "compatibility" (Category)
 - Direktif-direktif kompatibilitas pada phpMussel.
    "ignore_upload_errors"
    - Direktif ini umumnya harus DINONAKTIFKAN kecuali diperlukan untuk fungsi
      yang benar dari phpMussel pada sistem tertentu. Biasanya, ketika
      DINONAKTIFKAN, ketika phpMussel mendeteksi adanya elemen dalam $_FILES
      array(), itu akan mencoba untuk memulai scan file yang mewakili elemen,
      dan, jika elemen yang kosong, phpMussel akan mengembalikan pesan
      kesalahan. Ini adalah perilaku yang tepat untuk phpMussel. Namun, untuk
      beberapa CMS, elemen kosong di $_FILES dapat terjadi sebagai akibat dari
      perilaku alami itu CMS, atau kesalahan dapat dilaporkan bila tidak ada,
      dalam kasus seperti itu, perilaku normal untuk phpMussel akan mengganggu
      untuk perilaku normal itu CMS. Jika situasi seperti itu terjadi untuk
      anda, MENGAKTIFKAN direktif ini akan menginstruksikan phpMussel untuk
      tidak mencoba untuk memulai scan untuk elemen kosong, mengabaikan saat
      ditemui dan untuk tidak kembali terkait pesan kesalahan, sehingga
      memungkinkan kelanjutan dari halaman permintaan.
      0 - DINONAKTIFKAN, 1 - DIAKTIFKAN.
    "only_allow_images"
    - Jika anda hanya mengharapkan atau hanya berniat untuk memungkinkan
      mengupload gambar ke sistem atau CMS, dan jika Anda benar-benar tidak
      memerlukan mengupload file selain gambar ke sistem atau CMS, direktif ini
      harus DIAKTIFKAN, tetapi sebaliknya harus DINONAKTIFKAN. Jika direktif
      ini DIAKTIFKAN, ini akan menginstruksikan phpMussel untuk memblokir tanpa
      pandang bulu setiap upload diidentifikasi sebagai file tidak gambar,
      tanpa pemindaian mereka. Ini mungkin mengurangi waktu memproses dan
      penggunaan memori untuk mencoba upload file tidak gambar.
      0 - DINONAKTIFKAN, 1 - DIAKTIFKAN.

                                     ~ ~ ~                                     


 7. FORMAT TANDA TANGAN

 = TANDA TANGAN MD5 =
   Semua tanda tangan MD5 mengikuti format ini:
    HASH:FILESIZE:NAME
   Dimana HASH adalah MD5 dari keseluruhan file, FILESIZE adalah total ukuran
   file dan NAME adalah nama untuk mengutip tanda tangan tersebut.

 = TANDA TANGAN MD5 SEKSIONAL PE =
   Semua tanda tangan MD5 seksional PE mengikuti format ini:
    FILESIZE:HASH:NAME
   Dimana HASH adalah MD5 dari seksi PE, FILESIZE adalah total ukuran file dan
   NAME adalah nama untuk mengutip tanda tangan tersebut.

 = TANDA TANGAN PUTIH =
   Semua tanda tangan putih mengikuti format ini:
    HASH:FILESIZE:TYPE
   Dimana HASH adalah MD5 dari keseluruhan file, FILESIZE adalah total ukuran
   file dan TYPE adalah jenis tanda tangan yang file daftar putih tersebut
   adalah kebal terhadap.

 = TANDA TANGAN NAMA FILE =
   Semua tanda tangan nama file mengikuti format ini:
    NAME:FNRX
   Dimana NAME adalah nama mengutip tanda tangan dan FNRX adalah pola regex
   untuk mencocokkan nama file (tidak ter-encode).

 = TANDA TANGAN METADATA ARSIP =
   Semua tanda tangan meta data arsip mengikuti format ini:
    NAME:FILESIZE:CRC32
   Di mana NAME adalah nama mengutip tanda tangan itu, FILESIZE adalah total
   ukuran data (tidak terkompres) dari sebuah data berisikan arsip dan CRC32
   adalah checksum crc32 dari data yang berisikan.

 = YANG LAIN =
   Semua tanda tangan yang lain mengikuti format ini:
    NAME:HEX:FROM:TO
   Di mana NAME adalah nama yang mengutip tanda tangan ini dan HEX adalah
   sebuah segmen hexidecimal-encoded dari data yang dimaksudkan untuk
   dicocokkan oleh tanda tangan yang diberikan. FROM dan TO adalah parameter
   opsional, mengindikasikan dari mana dan kemana posisi dari sumber data
   untuk di cek (tidak didukung oleh fungsi mail).

 = REGEX =
   Setiap bentuk dari regex mengerti dan dengan benar diproses oleh php
   seharusnya bisa dengan benar dimengerti dan diproses oleh phpMussel dan
   tanda tangannya. Bagaimanapun, saya menyarankan peringatan ekstrim ketika
   menuliskan tanda tangan berbasis regex baru karena, jika anda tidak yakin
   apa yang anda lakukan dapat menghasilkan hal yang tidak diinginkan. Coba
   lihat source-code phpMussel dan jika anda tidak yakin tentang konteks dari
   statemen regex diparsing. Juga ingat bahwa semua pola (dengan pengecualian
   ke nama data, metadata terkompres dan pola MD5) harus diencode hexadecimal
   (syntax pola sebelumnya, tentu saja)!

 = DIMANA MELETAKKAN TANDA TANGAN YANG TERUBAH? =
   Letakkan hanya tanda tangan yang terubah pada data-data yang dimaksudkan
   untuk tanda tangan. Data-data itu harus berisikan "_custom" pada nama
   datanya. Anda harus juga menghindari mengedit data tanda tangan default,
   kecuali anda mengetahui apa yang anda lakukan, karena, disamping praktek
   baik dalam umumnya dan disamping dari membantu anda membedakan antara tanda
   tangan anda sendiri dan tanda tangan default dari phpMussel, baik juga untuk
   tetap mengedit hanya data yang dimaksudkan untuk diedit. Karena merusakkan
   data tanda tangan default dapat mengakibatkan mereka berhenti bekerja dengan
   benar, berdasakan data "maps": Data peta/maps memberitahukan phpMussel
   dimana dalam data tanda tangan untuk mencari tanda tangan yang diperlukan
   phpMussel dalam periode ketika diperlukan, dan peta-peta ini dapat di luar
   sinkronisasi dari data tanda tangannya jika data-data tanda tangannya
   dirusakkan. Anda dapat meletakkan banyak apapun yang kamu inginkan dalam
   tanda tangan anda, selama anda mengikuti syntax yang benar. Bagaimanapun
   mohon hati-hati mencoba tanda tangan baru untuk angka positif yang salah
   sebelum anda bermaksud untuk membagikannya atau menggunakan nya di dalam
   lingkungan langsung.

 = SIGNATURE BREAKDOWN =
   Berikut adalah pemecah-mecahan dari tipe tanda tangan yang digunakan
   phpMussel:
   - "Tanda tangan MD5" (md5_*). Dicek pada hash MD5 dari isi dan ukuran file
      dari apapun file tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan umum" (general_*). Dicek pada isi dari apapun file tidak
      bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan ASCII normal" (ascii_*). Dicek pada isi dari apapun file
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan HTML normal" (html_*). Dicek pada isi dari apapun file HTML
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Perintah umum" (hex_general_commands.csv). Dicek pada isi dari apapun
      file tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan Portable Executable Sectional" (pe_*). Dicek pada hash MD5
      dari seksi PE dan ukuran file dari apapun file tidak bertanda putih,
      ditargetkan untuk dipindai dan dicocokkan ke format PE.
   - "Tanda tangan Portable Executable" (exe_*). Dicek pada isi dari apapun
      file tidak bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke
      format PE.
   - "Tanda tangan ELF" (elf_*). Dicek pada isi dari apapun file tidak bertanda
      putih, ditargetkan untuk dipindai dan dicocokkan ke format ELF.
   - "Tanda tangan Grafis" (graphics_*). Dicek pada isi dari apapun file tidak
      bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke apapun
      diketahui format grafis.
   - "Tanda tangan Mach-O" (macho_*). Dicek pada isi dari apapun file tidak
      bertanda putih, ditargetkan untuk dipindai dan dicocokkan ke format
      Mach-O.
   - "Tanda tangan Metadata Arsip" (metadata_*). Dicek pada hash CRC32 dan
      ukuran file dari pertama file berisikan dalam apapun arsip terkompress
      tidak bertanda putih dan ditargetkan untuk dipindai.
   - "Tanda tangan OLE" (ole_*). Dicek pada isi dari apapun objek tidak
      bertanda putih dan ditargetkan untuk dipindai.
   - "Email Signatures" (mail_*). Dicek pada variabel $body diparse ke fungsi
      phpMussel_mail(), yang dimaksudkan untuk menjadi body dari pesan-pesan
      email atau entries yang sama (secara potensial post forum dll).
   - "Tanda tangan Putih" (whitelist_*). Dicek pada hash MD5 dari isi dan
      ukuran file dari apapun file ditargetkan untuk dipindai. File dicocokkan
      akan kebal terhadap dari dicocokkan dengan jenis tanda tangan yang
      disebutkan dalam entri daftar putih mereka.
   - "Tanda tangan potongan XML/XDP" (xmlxdp_*). Dicek pada apapun XML/XDP
      potongan ditemukan dari apapun file tidak bertanda putih dan ditargetkan
      untuk dipindai.
     (Catatan jika tanda tangan ini boleh dinonaktifkan melalui phpmussel.ini).

                                     ~ ~ ~                                     


 8. MASALAH KOMPATIBILITAS DIKETAHUI

 PHP dan PCRE
 - phpMussel memerlukan PHP dan PCRE untuk mengeksekusi dan berfungsi dengan
   baik. Tanpa php, atau tanpa ekstensi PCRE, phpMussel tidak akan mengeksekusi
   atau berfungsi dengan baik. Seharusnya memastikan sistem anda terinstal PHP
   dan PCRE dan tersedia secara prioritas untuk mengunduh dan menginstal
   phpMussel.

 KOMPATIBILITAS SOFTWARE ANTI-VIRUS

 Untuk banyak bagian, phpMussel seharusnya kompatibel dengan software
 pemindaian virus. Bagaimanapun konflik telah dilaporkan oleh penggunak di masa
 lalu. Informasi di bawah adalah dari virustotal.com, dan menguraikan sejumlah
 angka positif yang salah yang dilaporkan oleh bermacam-macam program
 anti-virus pada phpMussel. Walaupun informasi ini tidak jaminan absolut dari
 apa dan atau tidak mengalami masalah kompatibilitas antara phpMussel dan
 perangkat anti-virus anda, jika perangkat lunak anti-virus anda tercatat
 berlawanan dengan phpMussel, anda seharusnya mempertimbangkan menonaktifkannya
 bekerja dengan phpMussel atau seharusnya mempertimbangkan opsi alternatif ke
 software anti virus atau phpMussel.

 Informasi ini diupdate 25 September 2014 dan cocok untuk semua rilis phpMussel
 dari dua versi minor terbaru versi (v0.4-v0.5) pada waktu saya menuliskan ini.

 Ad-Aware                Tidak ada masalah yang diketahui
 Agnitum                 Tidak ada masalah yang diketahui
 AhnLab-V3               Tidak ada masalah yang diketahui
 AntiVir                 Tidak ada masalah yang diketahui
 Antiy-AVL               Tidak ada masalah yang diketahui
 Avast                !  Melaporkan "JS:ScriptSH-inf [Trj]"
 AVG                     Tidak ada masalah yang diketahui
 Baidu-International     Tidak ada masalah yang diketahui
 BitDefender             Tidak ada masalah yang diketahui
 Bkav                    Tidak ada masalah yang diketahui
 ByteHero                Tidak ada masalah yang diketahui
 CAT-QuickHeal           Tidak ada masalah yang diketahui
 ClamAV                  Tidak ada masalah yang diketahui
 CMC                     Tidak ada masalah yang diketahui
 Commtouch               Tidak ada masalah yang diketahui
 Comodo                  Tidak ada masalah yang diketahui
 DrWeb                   Tidak ada masalah yang diketahui
 Emsisoft                Tidak ada masalah yang diketahui
 ESET-NOD32              Tidak ada masalah yang diketahui
 F-Prot                  Tidak ada masalah yang diketahui
 F-Secure                Tidak ada masalah yang diketahui
 Fortinet                Tidak ada masalah yang diketahui
 GData                   Tidak ada masalah yang diketahui
 Ikarus               !  Melaporkan "Trojan.JS.Agent"
 Jiangmin                Tidak ada masalah yang diketahui
 K7AntiVirus             Tidak ada masalah yang diketahui
 K7GW                    Tidak ada masalah yang diketahui
 Kaspersky               Tidak ada masalah yang diketahui
 Kingsoft                Tidak ada masalah yang diketahui
 Malwarebytes            Tidak ada masalah yang diketahui
 McAfee                  Tidak ada masalah yang diketahui
 McAfee-GW-Edition       Tidak ada masalah yang diketahui
 Microsoft               Tidak ada masalah yang diketahui
 MicroWorld-eScan        Tidak ada masalah yang diketahui
 NANO-Antivirus          Tidak ada masalah yang diketahui
 Norman               !  Melaporkan "Kryptik.BQS"
 nProtect                Tidak ada masalah yang diketahui
 Panda                   Tidak ada masalah yang diketahui
 Qihoo-360               Tidak ada masalah yang diketahui
 Rising                  Tidak ada masalah yang diketahui
 Sophos                  Tidak ada masalah yang diketahui
 SUPERAntiSpyware        Tidak ada masalah yang diketahui
 Symantec             !  Melaporkan "WS.Reputation.1"
 TheHacker               Tidak ada masalah yang diketahui
 TotalDefense            Tidak ada masalah yang diketahui
 TrendMicro              Tidak ada masalah yang diketahui
 TrendMicro-HouseCall !  Melaporkan "Suspici.450F5936"
 VBA32                   Tidak ada masalah yang diketahui
 VIPRE                   Tidak ada masalah yang diketahui
 ViRobot                 Tidak ada masalah yang diketahui


                                     ~ ~ ~                                     


Terakhir Diperbarui: 28 Oktober 2014 (2014.10.28).
EOF