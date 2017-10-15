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
 * This file: Turkish language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Language plurality rule. */
$phpMussel['Plural-Rule'] = function($Num) {
    return $Num <= 1 ? 0 : 1;
};

$phpMussel['lang']['bad_command'] = 'Bu komutu anlamıyorum, üzgünüm.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Tarama işlemini tamamlama başarısız';
$phpMussel['lang']['cli_is_not_a'] = ' bir dosya veya dizin değil.';
$phpMussel['lang']['cli_ln2'] = " phpMussel programını kullandığınız için teşekkür ederiz; Sisteminize yüklenen\n dosyalardaki truva atlarını, virüsleri, zararlı yazılımları ve diğer tehditleri\n tespit etmek için tasarlanmış bir PHP betiği, ClamAV imzalarına ve diğerlerine\n dayalı olarak.\n\n PHPMUSSEL TELIF HAKKI 2013 ve sonrası GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Şu anda CLI modunda çalışan phpMussel (komut\n satırı arabirimi).\n\n Bir dosyayı veya dizini taramak için 'scan' yazın, taramak istediğiniz\n dosyanın veya dizinin adını yazın ve Enter tuşuna basın; CLI modu komutlarının\n bir listesi için 'c' yazın ve Enter tuşuna basın; Çıkmak için 'q' yazın ve\n Enter tuşuna basın:";
$phpMussel['lang']['cli_pe1'] = 'Geçerli bir PE dosyası değil!';
$phpMussel['lang']['cli_pe2'] = 'PE Bölümleri:';
$phpMussel['lang']['cli_signature_placeholder'] = 'IMZA-ADINIZ';
$phpMussel['lang']['cli_working'] = 'Devam etmekte';
$phpMussel['lang']['corrupted'] = 'Bozuk PE saptandı';
$phpMussel['lang']['data_not_available'] = 'Veri mevcut değil.';
$phpMussel['lang']['denied'] = 'Yükleme Reddedildi!';
$phpMussel['lang']['denied_reason'] = 'Yükleme aşağıda belirtilen nedenlerle engellendi:';
$phpMussel['lang']['detected'] = '{vn} algılandı';
$phpMussel['lang']['detected_control_characters'] = 'Algılanan kontrol karakterleri';
$phpMussel['lang']['encrypted_archive'] = 'Algılanan şifreli arşiv; Şifrelenmiş arşivlere izin verilmiyor';
$phpMussel['lang']['failed_to_access'] = 'Erişemiyorum: ';
$phpMussel['lang']['file'] = 'Dosya';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Dosya boyutu sınırı aşıldı';
$phpMussel['lang']['filetype_blacklisted'] = 'Filetype kara listeye alındı';
$phpMussel['lang']['finished'] = 'Bitirdi';
$phpMussel['lang']['generated_by'] = 'Üreten';
$phpMussel['lang']['greylist_cleared'] = ' Gri liste temizlendi.';
$phpMussel['lang']['greylist_not_updated'] = ' Gri liste güncellenmedi.';
$phpMussel['lang']['greylist_updated'] = ' Gri liste güncellendi.';
$phpMussel['lang']['image'] = 'Imaj';
$phpMussel['lang']['instance_already_active'] = 'Örnek zaten etkin! Lütfen kancalarınızı tekrar kontrol edin.';
$phpMussel['lang']['invalid_data'] = 'Geçersiz veri!';
$phpMussel['lang']['invalid_file'] = 'Geçersiz dosya';
$phpMussel['lang']['invalid_url'] = 'Geçersiz URL!';
$phpMussel['lang']['ok'] = 'Tamam';
$phpMussel['lang']['only_allow_images'] = 'Resim dışındaki dosyaları yüklemek izin verilmez';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Eklentiler dizini yok!';
$phpMussel['lang']['quarantined_as'] = "\"/vault/quarantine/{QFU}.qfu\" olarak karantinaya alındı.\n";
$phpMussel['lang']['recursive'] = 'Yineleme derinliği sınırı aşıldı';
$phpMussel['lang']['required_variables_not_defined'] = 'Gerekli değişkenler tanımlanmamış: Devam edemiyorum.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'Potansiyel olarak zararlı URL tespit edildi';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API istek hatası';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API yetkilendirme hatası';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API hizmeti kullanılamıyor';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Bilinmeyen API hatası';
$phpMussel['lang']['scan_aborted'] = 'Tarama iptal edildi!';
$phpMussel['lang']['scan_chameleon'] = '{x} bukalemun saldırısı tespit edildi';
$phpMussel['lang']['scan_checking'] = 'Kontrol etme';
$phpMussel['lang']['scan_checking_contents'] = 'Başarı! İçeriği kontrol etmeye devam etmek.';
$phpMussel['lang']['scan_command_injection'] = 'Komuta enjeksiyon girişimi tespit edildi';
$phpMussel['lang']['scan_complete'] = 'Tamamlayınız';
$phpMussel['lang']['scan_extensions_missing'] = 'Başarısız oldu (gerekli uzantıları eksik)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Dosya adı işleme algılandı';
$phpMussel['lang']['scan_missing_filename'] = 'Dosya adı eksik';
$phpMussel['lang']['scan_not_archive'] = 'Başarısız oldu (boş veya bir arşiv değil)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Hiçbir sorun bulunamadı.';
$phpMussel['lang']['scan_reading'] = 'Okuma';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'İmza dosyası bozulmuş';
$phpMussel['lang']['scan_signature_file_missing'] = 'İmza dosyası eksik';
$phpMussel['lang']['scan_tampering'] = 'Potansiyel olarak tehlikeli dosyaların değiştirilmesi algılandı';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Yetkisiz dosya yükleme işi algılandı';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Yetkisiz dosya yükleme manipülasyonu veya yanlış yapılandırma algılandı! ';
$phpMussel['lang']['started'] = 'Başlatılan';
$phpMussel['lang']['too_many_urls'] = 'Çok fazla URL\'ler';
$phpMussel['lang']['upload_error_1'] = 'Dosya boyutu upload_max_filesize yönergesini aşıyor. ';
$phpMussel['lang']['upload_error_2'] = 'Dosya boyutu form tanımlı dosya boyutu sınırını aşıyor. ';
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
 pe_meta
 - Meta verileri bir PE dosyasından ayıklayın [Sözdizimi: pe_meta dosya-adı].
 url_sig
 - URL tarayıcı imzalarını oluştur [Sözdizimi: url_sig dizgesi].
 scan
 - Dosya veya dizini tara [Sözdizimi: scan dosya-adı].
 - Takma ad: s.
 c
 - Bu komut listesini yazdırın.
";
