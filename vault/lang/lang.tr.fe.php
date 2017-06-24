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
 * This file: Turkish language data for the front-end (last modified: 2017.06.24).
 * (NOT COMPLETE)
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Ana Sayfa</a> | <a href="?phpmussel-page=logout">Çıkış</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Çıkış</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Tanınan arşiv dosya uzantıları (biçimi CSV\'dir; sorunlar olduğunda yalnızca eklemeli veya çıkarılmalıdır; gereksiz yere kaldırılması yanlış pozitiflerin ortaya çıkmasına neden olabilir; gereksiz yere ekleme, eklediğinizin beyaz listeye eklenmesine eşdeğerdir; dikkatle değiştirmek; bunun içerik düzeyinde bir etkisi olmadığını da unutmayın). Varsayılan olarak olduğu gibi liste, çoğunlukla sistemlerin ve CMS\'nin çoğunluğunda kullanılan biçimleri listeler, ancak kapsamlı değildir.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Herhangi bir kontrol karakteri içeren dosyaları engelle (yeni satırlara istisna)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Yalnızca düz metin yüklüyorsanız, sisteminize biraz daha koruma sağlamak için bu seçeneği açabilirsiniz. Bununla birlikte, başka herhangi bir şey için, bunu açtığınızda yanlış pozitif sonuç alabilirsiniz. Yanlış/False = Don\'t block [Varsayılan]; Doğru/True = Engelle.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Search for PHP header in files that are neither PHP files nor recognised archives. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Başlıkları yanlış olan arşivlerde arama yapın (Desteklenen: BZ, GZ, RAR, ZIP, RAR, GZ). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Başlıkları yanlış olan ofis belgelerini arama (Desteklenen: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Başlıkları yanlış olan resimleri arama (Desteklenen: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Başlıkları yanlış olan PDF dosyalarını arayın. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Bozuk dosyalar ve işleme hataları. Yanlış/False = Ignore; Doğru/True = Engelle [Varsayılan]. Potansiyel olarak bozuk PE (Portable Executable) dosyalarını algıla ve engelle? Genellikle (ama her zaman değil), bir PE dosyasının bazı kısımları bozulmuş veya doğru şekilde ayrıştırılamadığında, viral bir enfeksiyonun göstergesi olabilir. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Threshold for the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues while scanning). Varsayılan = 512KB. Zero or null disables the threshold (removing any such limitation based on filesize).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Threshold to the length of raw data that phpMussel is permitted to read and scan (in case there are any noticeable performance issues while scanning). Varsayılan = 32MB. Zero or null value disables the threshold. Generally, this value shouldn\'t be less than the average filesize of file uploads that you want and expect to receive to your server or website, shouldn\'t be more than the filesize_limit directive, and shouldn\'t be more than roughly one fifth of the total allowed memory allocation granted to PHP via the "php.ini" configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that\'d prevent it from being able to successfully scan files above a certain filesize).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'This directive should generally be disabled unless it\'s required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the <code>$_FILES</code> array(), it\'ll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. However, for some CMS, empty elements in <code>$_FILES</code> can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren\'t any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don\'t require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it\'ll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Detect and block encrypted archives? Because phpMussel isn\'t able to scan the contents of encrypted archives, it\'s possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_files_check_archives'] = 'Attempt to check the contents of archives? Yanlış/False = Don\'t check; Doğru/True = Check [Varsayılan]. Currently, the only archive and compression formats supported are BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR and ZIP (archive and compression formats RAR, CAB, 7z and etcetera not currently supported). This is not foolproof! While I highly recommend keeping this turned on, I can\'t guarantee it\'ll always find everything. Also be aware that archive checking currently is not recursive for PHARs or ZIPs.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Carry over filesize blacklisting/whitelisting to the contents of archives? Yanlış/False = Hayır (just greylist everything); Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Filesize limit in KB. 65536 = 64MB [Varsayılan]; 0 = Hayır limit (always greylisted). Any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.';
$phpMussel['lang']['config_files_filesize_response'] = 'What to do with files that exceed the filesize limit (if one exists). Yanlış/False = Whitelist; Doğru/True = Blacklist [Varsayılan].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Carry over filetype blacklisting/whitelisting to the contents of archives? Yanlış/False = Hayır (just greylist everything) [Varsayılan]; Doğru/True = Evet.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Kara liste:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Gri liste:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist. Logical order of processing is: If the filetype is whitelisted, don\'t scan and don\'t block the file, and don\'t check the file against the blacklist or the greylist. If the filetype is blacklisted, don\'t scan the file but block it anyway, and don\'t check the file against the greylist. If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the file as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the file as blacklisted, therefore not scanning it but blocking it anyway. Beyaz liste:';
$phpMussel['lang']['config_files_max_recursion'] = 'Arşivler için maksimum özyineleme derinliği sınırı. Varsayılan = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximum allowed number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn\'t account for or include the contents of archives.';
$phpMussel['lang']['config_general_cleanup'] = 'İlk yükleme taramasından sonra komut dosyası tarafından kullanılan değişkenleri ve önbellek ayarını kaldırın mı? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan]. If you aren't using the script for purposes other than scanning uploads, you should set this to <code>true</code> (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to <code>false</code> (no), to avoid unnecessarily reloading duplicate data into memory. In general practice, it should usually be set to <code>true</code>, but, if you do this, you won\'t be able to use the script for anything other than the initial file upload scanning. CLI modunda hiçbir etkisi yoktur.';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted file upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won\'t be touched. In the case of archives, the entire archive will be deleted, regardless of whether or not the offending file is only one of several files contained within the archive. For the case of file upload scanning, usually, it isn\'t necessary to enable this directive, because usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it\'ll usually delete any files uploaded through it to the server unless they\'ve been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn\'t always behave in the manner expected. Yanlış/False = After scanning, leave the file alone [Varsayılan]; Doğru/True = After scanning, if not clean, delete immediately.';
$phpMussel['lang']['config_general_disable_cli'] = 'CLI modunu devre dışı bırak?';
$phpMussel['lang']['config_general_disable_frontend'] = 'Ön uç erişimini devre dışı bırak?';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Webfontlarını devre dışı bırak? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan].';
$phpMussel['lang']['config_general_enable_plugins'] = 'phpMussel eklentileri için desteği etkinleştirilsin mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Should phpMussel send 403 headers with the file upload blocked message, or stick with the usual 200 OK? Yanlış/False = Hayır (200); Doğru/True = Evet (403) [Varsayılan].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Ön uç giriş denemelerini kaydetmek için kullanılan dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'When honeypot mode is enabled, phpMussel will attempt to quarantine every single file upload that it encounters, regardless of whether or not the file being uploaded matches any included signatures, and no actual scanning or analysis of those attempted file uploads will actually occur. This functionality should be useful for those that wish to use phpMussel for the purposes of virus/malware research, but it\'s neither recommended to enable this functionality if the intended use of phpMussel by the user is for actual file upload scanning, nor recommended to use the honeypot functionality for purposes other than honeypotting. Varsayılan olarak, this option is disabled. Yanlış/False = Devre dışı [Varsayılan]; Doğru/True = Etkinleştirildi.';
$phpMussel['lang']['config_general_ipaddr'] = 'Bağlama isteklerinin IP adresi nerede bulunur? (Cloudflare ve benzeri hizmetler için yararlıdır). Varsayılan = REMOTE_ADDR. UYARI: Ne yaptığınızı bilmiyorsanız bunu değiştirmeyin!';
$phpMussel['lang']['config_general_lang'] = 'phpMussel için varsayılan dili belirleyin.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Maksimum giriş denemesi sayısı.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel is able to quarantine flagged attempted file uploads in isolation within the phpMussel vault, if this is something you want it to do. Casual users of phpMussel that simply wish to protect their websites or hosting environment without having any interest in deeply analysing any flagged attempted file uploads should leave this functionality disabled, but any users interested in further analysis of flagged attempted file uploads for malware research or for similar such things should enable this functionality. Quarantining of flagged attempted file uploads can sometimes also assist in debugging false positives, if this is something that frequently occurs for you. To disable quarantine functionality, simply leave the <code>quarantine_key</code> directive empty, or erase the contents of that directive if it isn\'t already empty. To enable quarantine functionality, enter some value into the directive. The <code>quarantine_key</code> is an important security feature of the quarantine functionality required as a means of preventing the quarantine functionality from being exploited by potential attackers and as a means of preventing any potential execution of data stored within the quarantine. The <code>quarantine_key</code> should be treated in the same manner as your passwords: The longer the better, and guard it tightly. For best effect, use in conjunction with <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'The maximum filesize allowed for files to be quarantined. Files larger than the value specified will NOT be quarantined. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Varsayılan = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'The maximum memory usage allowed for the quarantine. If the total memory used by the quarantine reaches this value, the oldest quarantined files will be deleted until the total memory used no longer reaches this value. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Varsayılan = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'phpMussel tarama sonuçlarını ne kadar süreyle önbelleğe almalı? Değer, tarama sonuçlarının önbellekleneceği saniye sayısıdır. Varsayılan 21600 saniyedir (6 saat); 0 değeri, tarama sonuçlarını önbelleğe almayı devre dışı bırakır.';
$phpMussel['lang']['config_general_scan_kills'] = 'Filename of file to log all records of blocked or killed uploads to. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_scan_log'] = 'Filename of file to log all scanning results to. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Filename of file to log all scanning results to (using a serialised format). Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel tarafından kullanılan tarih/saat gösterimi biçimi. İsteğe bağlı olarak ek seçenekler eklenebilir.';
$phpMussel['lang']['config_general_timeOffset'] = 'Dakika cinsinden zaman dilimi farkı.';
$phpMussel['lang']['config_general_timezone'] = 'Zaman diliminiz.';
$phpMussel['lang']['config_general_truncate'] = 'Belirli bir boyuta ulaştığında günlük dosyalarını kesin? Değer, bir günlük dosyasının kesilmeden önce büyüyebileceği B/KB/MB/GB/TB cinsinden maksimum boyuttur. Varsayılan 0KB değeri, kesmeyi devre dışı bırakır (günlük dosyaları sınırsız büyüyebilir). Not: Tek tek kayıt dosyaları için geçerlidir! Günlük dosyalarının boyutu toplam olarak alınmaz.';
$phpMussel['lang']['config_heuristic_threshold'] = 'There are certain signatures of phpMussel that are intended to identify suspicious and potentially malicious qualities of files being uploaded without in themselves identifying those files being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious and potentially malicious qualities of files being uploaded that\'s allowed is before those files are to be flagged as malicious. The definition of weight in this context is the total number of suspicious and potentially malicious qualities identified. Varsayılan olarak, this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious files being flagged, whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious files being flagged. It\'s generally best to leave this value at its default unless you\'re experiencing problems related to it.';
// ^
$phpMussel['lang']['config_signatures_Active'] = 'Aktif imza dosyalarının virgülle ayrılmış bir listesi.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel reklam yazılımlarını algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel bozulmalar ve defacement ları tespiti için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel sahtekarlık programlarını tespit etmek için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel paketleyicileri ve paketlenmiş verileri algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel PU(A/P)\'ları algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel kabuk komut dosyalarını algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Uzantılar eksik olduğunda phpMussel raporlamalı mı? <code>fail_extensions_silently</code> devre dışı bırakılırsa, eksik uzantılar tarama sırasında raporlanacak, ve <code>fail_extensions_silently</code> etkinleştirilmişse, eksik uzantılar yok sayılır, ve bu dosyalarda herhangi bir sorun olmadığını bildirir. Bu yönergenin devre dışı bırakılması, potansiyel olarak güvenliğinizi artırabilir, ancak yanlış pozitifliklerin artmasına neden olabilir. Yanlış/False = Devre dışı; Doğru/True = Etkinleştirildi [Varsayılan].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'İmzalar dosyaları eksik veya bozuk olduğunda phpMussel raporlamalı mı? <code>fail_silently</code> devre dışı bırakılırsa, eksik veya bozuk dosyalar tarama sırasında rapor edilecektir, ve <code>fail_silently</code> etkinleştirilmişse, eksik ve bozuk dosyalar yok sayılır, ve bu dosyalarda herhangi bir sorun olmadığını bildirir. Sorun yaşamadığınız sürece bu yalnız bırakılmalıdır. Yanlış/False = Devre dışı; Doğru/True = Etkinleştirildi [Varsayılan].';
$phpMussel['lang']['config_template_data_css_url'] = 'Özel temalar için CSS dosyası URL\'si.';
$phpMussel['lang']['config_template_data_theme'] = 'phpMussel için kullanılacak varsayılan tema.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'API aramalarının sonuçları ne kadar süreyle (saniye olarak) önbelleğe alınır? Varsayılan değer 3600 saniyedir (1 saat).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Gerekli API anahtarı tanımlandığında Google Güvenli Tarama API\'sı için API aramalarını etkinleştirir.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'True olarak ayarlandığında hpHosts API\'sine API aramalarını etkinleştirir.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Tek tek tarama yinelemeleri için izin verilen azami API arama sayısı. Eklenen her API araması, her tarama yinelemesinin tamamlanması için gereken toplam süreyi ekler ve bu nedenle, genel tarama sürecini hızlandırmak için bir sınırlama önermek isteyebilirsiniz. 0 olarak ayarlandığında hiçbir sınırlama uygulanmaz. Varsayılan olarak 10 olarak ayarlayın.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'İzin verilen maksimum API arama sayısı aşıldığında ne yapılması gerekir? Yanlış/False = Hiçbir şey yapma (ışleme devam et) [Varsayılan]; Doğru/True = Dosyayı engelleyin.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'İsteğe bağlı olarak, phpMussel, Virus Total API\'sını kullanarak dosyaları virüslere, truva atlarına, kötü amaçlı yazılımlara ve diğer tehditlere karşı daha iyi koruma sağlamanın bir yolu olarak tarayabilir. Varsayılan olarak, Virus Total API\'sını kullanarak tarama dosyaları devre dışı bırakılır. Etkinleştirmek için Virus Total\'dan bir API anahtarı gerekiyor. Bunun size sağlayabileceği önemli fayda nedeniyle, etkinleştirilmesini önemle öneririm. Virus Total API\'sını kullanabilmeniz için Hizmet şartlarını kabul etmeniz gerektiğini lütfen unutmayın! Ayrıca, belgelerinde öngörülen kurallara uymanız gerekir! Bu özelliği yalnızca aşağıdaki koşullar sağlandığında kullanabilirsiniz: Virus Total ve API hizmet şartlarını okudunuz ve kabul ettiniz. Okudunuz ve en azından Virus Total Genel API belgelerinin giriş bölümünü anladınız ("VirusTotal Public API v2.0" den sonra ancak "Contents" öncesi her şey).';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Virus Total API dokümantasyonuna göre, herhangi bir 1 dakikalık zaman aralığında herhangi bir doğadan en çok 4 istekle sınırlıdır. VirusTotal\'a kaynak sağlayacak bir honeyclient, honeypot veya başka bir otomasyon çalıştırırsanız ve yalnızca raporları almakla kalmazsanız, daha yüksek bir talep oranı kotası alma hakkına sahipsiniz. Varsayılan olarak, phpMussel bu sınırlamalara kesinlikle uyacaktır, ancak bu oran kotalarının artması ihtimalinden ötürü, bu iki talimat, phpMussel\'a hangi sınırlamaya uyulması gerektiğini öğretmek için bir araç olarak sağlanmaktadır. Sizden talimat almadıysanız, bu değerleri artırmanız önerilmez, ancak, oran kotanıza ulaşma ile ilgili sorunlarla karşılaşırsanız, bu değerleri azaltmak bazen bu sorunlarla başa çıkmanıza yardımcı olabilir. Ücret limitiniz, herhangi bir <code>vt_quota_time</code> dakika zaman aralığında herhangi bir nitelikte <code>vt_quota_rate</code> istek olarak belirlenir.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Yukarıdaki açıklamaya bakın).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Varsayılan olarak, phpMussel, "şüpheli" olarak gördüğü dosyalara Virus Total API\'sını kullanarak taradığı dosyaları sınırlar. Bu sınırlamayı, <code>vt_suspicion_level</code> yönergesinin değerini değiştirerek ayarlayabilirsiniz.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Virus Total API tarama sonuçları algılar mı yoksa algılama ağırlığı olarak mı uygulanmalıdır? Bir dosyayı birden çok motor kullanarak tarama yapmak (Virus Total\'in yaptığı gibi) artan algılama hızıyla sonuçlanmalıdır (ve dolayısıyla daha çok sayıda kötü amaçlı dosyanın yakalanmasıyla), ancak daha fazla yanlış pozitif sayıya neden olabilir, ve bu nedenle, bazı durumlarda, tarama sonuçları kesin bir sonuç olmaktan çok bir güven puanı olarak daha iyi kullanılabilir; Bu nedenle bu direktifin mevcut olması. 0 değeri kullanılırsa, Virus Total API tarama sonuçları algılar olarak uygulanır, ve bu nedenle eğer herhangi bir motor zararlı olarak dosyaya bayrak atarsa, phpMussel dosyayı kötü amaçlı olarak değerlendirir. Başka herhangi bir değer kullanılırsa, Virus Total API tarama sonuçları algılama ağırlığı olarak uygulanır, ve bu nedenle, dosyayı kötü amaçlı olarak işaretleyen motor sayısı bir güven puanı görevi görür (kullanılan değer dosyanın kötü amaçlı olarak değerlendirilebilmesi için gereken minimum güven puanı temsil edecektir). Varsayılan olarak 0 değeri kullanılır.';
$phpMussel['lang']['field_activate'] = 'Etkinleştir';
$phpMussel['lang']['field_component'] = 'Bileşen';
$phpMussel['lang']['field_create_new_account'] = 'Yeni Hesap Oluştur';
$phpMussel['lang']['field_deactivate'] = 'Devre dışı bırak';
$phpMussel['lang']['field_delete_account'] = 'Hesabı sil';
$phpMussel['lang']['field_delete_file'] = 'Sil';
$phpMussel['lang']['field_download_file'] = 'İndir';
$phpMussel['lang']['field_edit_file'] = 'Düzenle';
$phpMussel['lang']['field_file'] = 'Dosya';
$phpMussel['lang']['field_filename'] = 'Dosya adı: ';
$phpMussel['lang']['field_filetype_directory'] = 'Rehber';
$phpMussel['lang']['field_filetype_info'] = '{EXT} Dosya';
$phpMussel['lang']['field_filetype_unknown'] = 'Bilinmiyor';
$phpMussel['lang']['field_install'] = 'Yükle';
$phpMussel['lang']['field_latest_version'] = 'En son sürüm';
$phpMussel['lang']['field_log_in'] = 'Oturum Aç';
$phpMussel['lang']['field_more_fields'] = 'Daha fazla yükleme alanı';
$phpMussel['lang']['field_new_name'] = 'Yeni isim:';
$phpMussel['lang']['field_ok'] = 'Tamam';
$phpMussel['lang']['field_options'] = 'Seçenekler';
$phpMussel['lang']['field_password'] = 'Parola';
$phpMussel['lang']['field_permissions'] = 'İzinler';
$phpMussel['lang']['field_rename_file'] = 'Adını değiştirmek';
$phpMussel['lang']['field_reset'] = 'Sıfırla';
$phpMussel['lang']['field_set_new_password'] = 'Yeni Şifre Oluştur';
$phpMussel['lang']['field_size'] = 'Toplam Boyut: ';
$phpMussel['lang']['field_size_bytes'] = 'Bayt';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Durum';
$phpMussel['lang']['field_system_timezone'] = 'Sistem varsayılan saat dilimini kullanın.';
$phpMussel['lang']['field_uninstall'] = 'Kaldır';
$phpMussel['lang']['field_update'] = 'Güncelle';
$phpMussel['lang']['field_update_all'] = 'Tümünü Güncelle';
$phpMussel['lang']['field_upload_file'] = 'Yeni Dosya Yükle';
$phpMussel['lang']['field_username'] = 'Kullanıcı adı';
$phpMussel['lang']['field_your_version'] = 'Sürümünüz';
$phpMussel['lang']['header_login'] = 'Devam etmek için lütfen giriş yapınız.';
$phpMussel['lang']['label_active_config_file'] = 'Etkin yapılandırma dosyası: ';
$phpMussel['lang']['label_os'] = 'Kullanılan işletim sistemi:';
$phpMussel['lang']['label_php'] = 'Kullanılan PHP sürümü:';
$phpMussel['lang']['label_phpmussel'] = 'Kullanılan phpMussel sürümü:';
$phpMussel['lang']['label_sapi'] = 'Kullanılan SAPI:';
$phpMussel['lang']['label_sysinfo'] = 'Sistem bilgisi:';
$phpMussel['lang']['link_accounts'] = 'Hesaplar';
$phpMussel['lang']['link_config'] = 'Yapılandırma';
$phpMussel['lang']['link_documentation'] = 'Belgeler';
$phpMussel['lang']['link_file_manager'] = 'Dosya Yöneticisi';
$phpMussel['lang']['link_home'] = 'Ana Sayfa';
$phpMussel['lang']['link_logs'] = 'Kayıtlar';
$phpMussel['lang']['link_updates'] = 'Güncellemeler';
$phpMussel['lang']['link_upload_test'] = 'Yükleme Testi';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Seçilen günlük dosyası yok!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Günlük dosyası yok.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Hiçbir günlük dosyası seçilmedi.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Maksimum giriş denemesi aşıldı; Erişim reddedildi.';
$phpMussel['lang']['previewer_days'] = 'Günler';
$phpMussel['lang']['previewer_hours'] = 'Saatler';
$phpMussel['lang']['previewer_minutes'] = 'Dakikalar';
$phpMussel['lang']['previewer_months'] = 'Aylar';
$phpMussel['lang']['previewer_seconds'] = 'Saniyeler';
$phpMussel['lang']['previewer_weeks'] = 'Haftalar';
$phpMussel['lang']['previewer_years'] = 'Yıllar';
$phpMussel['lang']['punct_decimals'] = ',';
$phpMussel['lang']['punct_thousand'] = '.';
$phpMussel['lang']['response_accounts_already_exists'] = 'Bu kullanıcı adıyla bir hesap zaten var!';
$phpMussel['lang']['response_accounts_created'] = 'Hesap başarıyla oluşturuldu!';
$phpMussel['lang']['response_accounts_deleted'] = 'Hesap başarıyla silindi!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Bu hesap mevcut değil.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Şifre başarıyla güncellendi!';
$phpMussel['lang']['response_activated'] = 'Başarıyla etkinleştirildi.';
$phpMussel['lang']['response_activation_failed'] = 'Etkinleştirilemedi!';
$phpMussel['lang']['response_checksum_error'] = 'Checksum hatası! Dosya reddedildi!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Bileşen başarıyla yüklendi.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Bileşen başarıyla kaldırıldı.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Bileşen başarıyla güncellendi.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Bileşeni kaldırmaya çalışırken bir hata oluştu.';
$phpMussel['lang']['response_component_update_error'] = 'Bileşeni güncelleştirmeye çalışılırken bir hata oluştu.';
$phpMussel['lang']['response_configuration_updated'] = 'Yapılandırma başarıyla güncellendi.';
$phpMussel['lang']['response_deactivated'] = 'Başarıyla devre dışı bırakıldı.';
$phpMussel['lang']['response_deactivation_failed'] = 'Devre dışı bırakılamadı!';
$phpMussel['lang']['response_delete_error'] = 'Silinemedi!';
$phpMussel['lang']['response_directory_deleted'] = 'Dizin başarıyla silindi!';
$phpMussel['lang']['response_directory_renamed'] = 'Dizin başarıyla yeniden adlandırıldı!';
$phpMussel['lang']['response_error'] = 'Hata';
$phpMussel['lang']['response_file_deleted'] = 'Dosya başarıyla silindi!';
$phpMussel['lang']['response_file_edited'] = 'Dosya başarıyla değiştirildi!';
$phpMussel['lang']['response_file_renamed'] = 'Dosya başarıyla yeniden adlandırıldı!';
$phpMussel['lang']['response_file_uploaded'] = 'Dosya başarıyla yüklendi!';
$phpMussel['lang']['response_login_invalid_password'] = 'Giriş başarısız! Geçersiz parola!';
$phpMussel['lang']['response_login_invalid_username'] = 'Giriş başarısız! Kullanıcı adı yok!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Parola alanı boş!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Kullanıcı adı alanı boş!';
$phpMussel['lang']['response_rename_error'] = 'Yeniden adlandırılamadı!';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Zaten güncel.';
$phpMussel['lang']['response_updates_not_installed'] = 'Bileşen yüklü değil!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Bileşen yüklü değil (PHP {V} gerektirir)!';
$phpMussel['lang']['response_updates_outdated'] = 'Eski!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Eski (lütfen manuel olarak güncelleyin)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Eski (PHP {V} gerektirir)!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Belirlenemedi.';
$phpMussel['lang']['response_upload_error'] = 'Yüklenemedi!';
$phpMussel['lang']['state_complete_access'] = 'Tam erişim';
$phpMussel['lang']['state_component_is_active'] = 'Bileşen aktiftir.';
$phpMussel['lang']['state_component_is_inactive'] = 'Bileşen etkin değil.';
$phpMussel['lang']['state_component_is_provisional'] = 'Bileşen geçicidir.';
$phpMussel['lang']['state_default_password'] = 'Uyarı: Varsayılan şifreyi kullanıyor!';
$phpMussel['lang']['state_logged_in'] = 'Giriş yapıldı.';
$phpMussel['lang']['state_logs_access_only'] = 'Sadece girişleri kaydeder';
$phpMussel['lang']['state_password_not_valid'] = 'Uyarı: Bu hesap geçerli bir şifre kullanmıyor!';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Eskimiş olmayanları gizleme';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Eskimiş olmayanları gizle';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Kullanılmayanları gizleme';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Kullanılmayanları gizle';
$phpMussel['lang']['tip_accounts'] = 'Merhaba, {username}.<br />Hesaplar sayfası, phpMussel ön ucuna kimin erişebileceğini kontrol etmenizi mümkün kılar.';
$phpMussel['lang']['tip_config'] = 'Merhaba, {username}.<br />Yapılandırma sayfası, phpMussel için yapılandırmayı ön uçtan değiştirmenizi mümkün kılar.';
$phpMussel['lang']['tip_donate'] = 'phpMussel ücretsiz olarak sunulmaktadır, ancak projeye bağış yapmak isterseniz, bağış düğmesini tıklayarak bunu yapabilirsiniz.';
$phpMussel['lang']['tip_file_manager'] = 'Merhaba, {username}.<br />Dosya yöneticisi dosyalarınızı silmenizi, düzenlemenizi, yüklemenizi ve indirmenizi sağlar. Dikkatli kullanın (kurulumunuzu bununla bozabilirsiniz).';
$phpMussel['lang']['tip_home'] = 'Merhaba, {username}.<br />Bu, phpMussel ön uçunun ana sayfasıdır. Devam etmek için soldaki gezinme menüsünden bir bağlantı seçin.';
$phpMussel['lang']['tip_login'] = 'Varsayılan kullanıcı adı: <span class="txtRd">admin</span> – Varsayılan şifre: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Merhaba, {username}.<br />Bu günlük dosyasının içeriğini görüntülemek için aşağıdaki listeden bir günlük dosyası seçin.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Çeşitli yapılandırma yönergeleri ve amaçlarıyla ilgili bilgi için <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION7">belgelere</a> bakın.';
$phpMussel['lang']['tip_updates'] = 'Merhaba, {username}.<br />Güncellemeler sayfası, phpMussel\'ın çeşitli bileşenlerini (çekirdek paket, imzalar, L10N dosyaları vb.) yüklemenizi, kaldırmanızı ve güncellemenizi sağlar.';
$phpMussel['lang']['tip_upload_test'] = 'Merhaba, {username}.<br />Yükleme sınama sayfası, bir dosyanın yüklenmeye çalışılırken normalde phpMussel tarafından engelleneceğini test etmenize izin veren standart bir dosya yükleme formu içerir.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Hesaplar';
$phpMussel['lang']['title_config'] = 'phpMussel – Yapılandırma';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Dosya Yöneticisi';
$phpMussel['lang']['title_home'] = 'phpMussel – Ana Sayfa';
$phpMussel['lang']['title_login'] = 'phpMussel – Giriş';
$phpMussel['lang']['title_logs'] = 'phpMussel – Kayıtlar';
$phpMussel['lang']['title_updates'] = 'phpMussel – Güncellemeler';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Yükleme Testi';

$phpMussel['lang']['info_some_useful_links'] = 'Bazı kullanışlı bağlantılar:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel Sorunları @ GitHub</a> – phpMussel için sorunlar sayfası (destek, yardım, vb.).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – phpMussel için tartışma forumu (destek, yardım vb.).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – phpMussel için alternatif karşıdan yükleme aynası.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Web sitelerini güvenli hale getirmek için basit web yöneticisi araçlarından oluşan bir koleksiyon.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV anasayfası (Truva atlarını, virüsleri, kötü amaçlı yazılımları ve diğer kötü niyetli tehditleri tespit etmek için kullanılan açık kaynak kodlu bir antivirüs motoru).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – ClamAV için ek imzalar sunan bilgisayar güvenlik şirketi.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Kimlik avı veritabanı (URL tarayıcısı tarafından kullanılır).</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">International PHP Group @ Facebook</a> – PHP öğrenme kaynakları ve tartışmalar.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP öğrenme kaynakları ve tartışmalar.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – Şüpheli dosyaları ve URL\'leri analiz etmek için ücretsiz bir hizmet.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – <a href="http://www.payload-security.com/">Payload Security</a> tarafından sağlanan ücretsiz bir kötü amaçlı yazılım analizi hizmeti.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Kötü amaçlı yazılımlarla mücadele uzmanları.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Yararlı kötü amaçlı yazılım odaklı tartışma forumları.</li>
        </ul>';
