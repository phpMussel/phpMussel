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
 * This file: Turkish language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Ana Sayfa</a> | <a href="?phpmussel-page=logout">Çıkış</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Çıkış</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Tanınan arşiv dosya uzantıları (biçimi CSV\'dir; sorunlar olduğunda yalnızca eklemeli veya çıkarılmalıdır; gereksiz yere kaldırılması yanlış pozitiflerin ortaya çıkmasına neden olabilir; gereksiz yere ekleme, eklediğinizin beyaz listeye eklenmesine eşdeğerdir; dikkatle değiştirmek; bunun içerik düzeyinde bir etkisi olmadığını da unutmayın). Varsayılan olarak olduğu gibi liste, çoğunlukla sistemlerin ve CMS\'nin çoğunluğunda kullanılan biçimleri listeler, ancak kapsamlı değildir.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Herhangi bir kontrol karakteri içeren dosyaları engelle (yeni satırlara istisna)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Yalnızca düz metin yüklüyorsanız, sisteminize biraz daha koruma sağlamak için bu seçeneği açabilirsiniz. Bununla birlikte, başka herhangi bir şey için, bunu açtığınızda yanlış pozitif sonuç alabilirsiniz. Yanlış/False = Engelleme [Varsayılan]; Doğru/True = Engelle.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Çalıştırılamaz dosyalarda ve arşiv dışı dosyalarda yürütülebilir üstbilgileri ara ve başlıkları yanlış olan yürütülebilir dosyaları arayın. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'PHP başlıklarını PHP olmayan dosyalarda arayın. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Başlıkları yanlış olan arşivlerde arama yapın (Desteklenen: BZ, GZ, RAR, ZIP, RAR, GZ). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Başlıkları yanlış olan ofis belgelerini arama (Desteklenen: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Başlıkları yanlış olan resimleri arama (Desteklenen: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Başlıkları yanlış olan PDF dosyalarını arayın. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Bozuk dosyalar ve işleme hataları. Yanlış/False = Aldırmamak; Doğru/True = Engelle [Varsayılan]. Potansiyel olarak bozuk PE (Portable Executable) dosyalarını algıla ve engelle? Genellikle (ama her zaman değil), bir PE dosyasının bazı kısımları bozulmuş veya doğru şekilde ayrıştırılamadığında, viral bir enfeksiyonun göstergesi olabilir. Çoğu anti-virüs programının PE dosyalarındaki virüsleri algılamak için kullandığı süreçler, dosyaların belirli yollarla işlenmesini gerektirir. Bir virüs yazarı bunun farkındaysa, virüslerinin tespit edilmemesine izin vermek için bu işlemi atlatmaya çalışacaklardır.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Kod çözme komutlarını kontrol etmek için ham verinin maksimum uzunluğu (tarama sırasında belirgin bir performans sorunu olması durumunda). Varsayılan = 512KB. Sıfır veya null değer, sınırı devre dışı bırakır.';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'phpMussel\'ın okumasına ve taramasına izin verilen ham verinin maksimum uzunluğu (tarama sırasında belirgin bir performans sorunu olması durumunda). Varsayılan = 32MB. Sıfır veya null değer, sınırı devre dışı bırakır. Genellikle bu değer, sunucuya veya web sitenize almak istediğiniz ve beklediğiniz dosya yüklemelerinin ortalama dosya boyutundan daha az olmamalıdır, filesize_limit yönergesinden daha fazla olmamalıdır, ve PHP\'ye izin verilen toplam bellek ayırmanın beşte birinden fazla olmamalıdır. Bu yönerge, phpMussel\'ın fazla bellek kullanmasını önlemeye yöneliktir.';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Bu yönerge genelde, phpMussel\'ın sizin belirli sisteminizde düzgün çalışması için gerekliyse devre dışı bırakılmalıdır. Normalde devre dışı bırakıldığında, phpMussel <code>$_FILES</code> array() içindeki öğelerin varlığını tespit ettiğinde, bu elemanların temsil ettiği dosyaların bir taramasını başlatmaya çalışacaktır, ve, bu elemanlar boşsa, phpMussel bir hata mesajı döndürür. Bu, phpMussel için doğru davranıştır. Bununla birlikte, bazı CMS için <code>$_FILES</code> daki boş öğeler, bu CMS\'nin doğal davranışının bir sonucu olarak ortaya çıkabilir veya herhangi bir şey olmadığında hata raporlanabilir, ve bu durumda, phpMussel için normal davranış, o CMS\'nin normal davranışını engelleyecektir. Böyle bir durum sizin için ortaya çıkarsa, bu seçeneği etkinleştirmek bu tarama türlerini önlemeniz yoluyla yardımcı olacaktır, böylece sayfa talebinin devam etmesine izin verilir. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Yalnızca resimlerin sisteminize veya CMS\'e yüklenmesine izin vermeyi düşünüyorsanız, ve kesinlikle sistemden veya CMS\'e yüklenmek üzere görüntülerden başka herhangi bir dosyaya ihtiyaç duymuyorsanız, bu yönergenin etkinleştirilmesi gerekir, ancak aksi takdirde devre dışı bırakılmalıdır. Bu yönerge etkinleştirilirse, phpMussel\'a resim olmayan dosyalar olarak tanımlanan yüklemeleri ayrımsız olarak engellemesini söyleyecektir. Bu, resim olmayan dosyaların yüklenmesine teşebbüs edilmesi için işlem süresi ve bellek kullanımını azaltabilir. Yanlış/False = Kapalı; Doğru/True = Açık.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Şifreli arşivlerin algılanan ve engellemek? phpMussel, şifreli arşivlerin içeriğini tarayamıyor, ve bu yüzden, arşiv şifrelemesinin bir saldırgan tarafından phpMussel\'ı, anti-virüs tarayıcıları ve benzeri diğer korumalar, atlamak için bir araç olarak kullanılabileceği mümkündür. phpMussel tarafından keşfedilen şifreli arşivlerin engellenmesi bu riskleri potansiyel olarak azaltabilir. Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_files_check_archives'] = 'Arşiv içeriğini kontrol etmeye çalıştınız mı? Yanlış/False = Kontrol etmeyin; Doğru/True = Kontrol et [Varsayılan]. Şu anda desteklenen tek arşiv ve sıkıştırma biçimi BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR ve ZIP (arşiv ve sıkıştırma formatları RAR, CAB, 7z ve v.b. şu anda desteklenmiyor). Bu kusursuz değil! Bu özelliğin etkinleştirilmesini tavsiye ederim, ancak her zaman her şeyi bulacağını garanti edemem. Ayrıca arşiv denetiminin halihazırda PHAR\'lar veya ZIP\'ler için özyinelemeli olmadığını da unutmayın.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Dosya boyutu kara/beyaz listeyi arşiv içeriğine mi aktarıyorsun? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_files_filesize_limit'] = 'KB cinsinden dosya boyutu sınırı. 65536 = 64MB [Varsayılan]; 0 = Sınır yok. Kabul edilen herhangi bir pozitif sayısal değer. Bu, PHP yapılandırmanızın bir işlemin tutabileceği bellek miktarını sınırladığında veya PHP yapılandırmanızın yüklemelerin dosya boyutunu sınırlaması durumunda yararlı olabilir.';
$phpMussel['lang']['config_files_filesize_response'] = 'Dosya boyutu sınırını aşan dosyalarla ne yapılması gerekiyor (bir sınır varsa). Yanlış/False = Beyaz listeye; Doğru/True = Kara listeye [Varsayılan].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Arşiv içeriği için dosya türü kara listeyi ve beyaz listeyi devralır mı? Yanlış/False = Hayır [Varsayılan]; Doğru/True = Evet.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Kara liste:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Gri liste:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Sisteminiz yalnızca belirli dosya türlerinin yüklenmesine izin veriyorsa, veya sisteminiz belli dosya türlerini açıkça reddetiyorsa, bu dosya türlerini beyaz listelerde, kara listelerde ve gri listelerde belirtmek taramanın hızını artırabilir, komut dosyası belirli dosya türlerini atlamak için izin vererek. Biçim CSV (virgülle ayrılmış değerler). Her şeyi taramak istiyorsanız, bu değişkenleri boş bırakın; Bunu yapmak beyaz/kara/gri listeyi devre dışı bırakır. İşlem mantığı şu şekildedir: Dosya türü beyaz listede bulunuyorsa, dosyayı taramayın ve engellemeyin ve dosyayı kara listeye veya gri listeye karşı kontrol etmeyin. Dosya türü kara listede bulunuyorsa, dosyayı taramayın, ancak yine de engelleyin ve dosyayı gri liste karşı kontrol etmeyin. Gri liste boşsa, ya da gri liste boş değilse ve dosya türü gri listede bulunuyorsa, dosyayı normal göre tara ve taramanın sonuçlarına dayanarak engelleyip engellemeyeceğini belirleme, ancak gri liste boş değilse ve dosya türü gri listede değil, dosyayı kara listede olduğu gibi davranın, bu nedenle tarama değil, yine de engelleme. Beyaz liste:';
$phpMussel['lang']['config_files_max_recursion'] = 'Arşivler için maksimum özyineleme derinliği sınırı. Varsayılan = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Yükleme taraması sırasında taranacak maksimum dosya sayısı. Bu sayıyı aşmak taramayı durduracak ve kullanıcıya çok fazla yükleme yaptıkları bildirilecektir! Sisteminizi veya CMS\'nizi DDoS girişiminde bulunduran teorik bir saldırıya karşı koruma sağlar. Tavsiye edilen: 10. Donanımınızın hızına bağlı olarak bu sayıyı yükseltebilir veya azaltabilirsiniz. Bu numaranın arşiv içeriğini hesaba katmadığını unutmayın.';
$phpMussel['lang']['config_general_cleanup'] = 'İlk yükleme taramasından sonra komut dosyası tarafından kullanılan değişkenleri ve önbellek ayarını kaldırın mı? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan]. Yüklemeleri taramak için yalnızca betiği kullanıyorsanız, bunu <code>true</code> (evet) olarak ayarlamanız gerekir, bellek kullanımını en aza indirgemek için. Senaryoyu başka şeyler için kullanıyorsanız, onu <code>false</code> (hayır) olarak ayarlamanız, yinelenen verilerin belleğe yeniden yüklenmesini önlemek için. Genel uygulamada genellikle <code>true</code> olarak ayarlanmalıdır, ancak bunu yaparsanız, betiği dosya yüklemelerini taramaktan başka bir şey için kullanamazsınız. CLI modunda hiçbir etkisi yoktur.';
$phpMussel['lang']['config_general_default_algo'] = 'Gelecekteki tüm şifreler ve oturumlar için hangi algoritmayı kullanacağını tanımlar. Options: PASSWORD_DEFAULT (varsayılan), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 gerektirir).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Bu yönergeyi etkinleştirmek, komut dosyasına, imzalar yoluyla veya başka şekilde herhangi bir algılama ölçütüyle eşleşen tüm taranan yüklemeleri derhal silmesini söyleyecektir. Temiz olduğu düşünülen dosyalara dokunulmaz. Arşiv durumunda tüm arşiv silinir. Dosya yükleme taraması için, genellikle bu yönergeyi etkinleştirmek gerekli değildir, çünkü genellikle yürütme tamamlandığında PHP otomatik olarak önbellek içeriğini temizleyecektir (yükleme nedeniyle geçici olarak saklanan dosyaları sileceğini belirtir). Bu yönerge, burada PHP\'nin kopyaları her zaman beklendiği gibi davranmayanlar için ek bir güvenlik tedbiri olarak eklenmiştir. Yanlış/False = Taramadan sonra, dosyayı yalnız bırakın [Varsayılan]; Doğru/True = Taramadan sonra, temiz değilse hemen silin.';
$phpMussel['lang']['config_general_disable_cli'] = 'CLI modunu devre dışı bırak? CLI modu varsayılan olarak etkindir, ancak bazen bazı test araçlarına (örneğin PHPUnit) ve diğer CLI tabanlı uygulamalara müdahale edebilir. CLI modunu devre dışı bırakmanız gerekmiyorsa, bu direktif görmezden almalısınız. False = CLI modunu etkinleştir [Varsayılan]; True = CLI modunu devre dışı bırak.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Ön uç erişimini devre dışı bırak? Ön uç erişimi phpMussel\'ın daha yönetilebilir hale getirebilir, ancak potansiyel bir güvenlik riski de oluşturabilir. phpMussel\'ın mümkün olduğunda arka ucundan yönetmesi önerilir, ancak kolaylık sağlamak için ön uç erişimi sağlanmıştır. İhtiyacınız olmadıkça devre dışı bırakın. False = Ön uç erişimini etkinleştir; True = Ön uç erişimini devre dışı bırak [Varsayılan].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Webfontlarını devre dışı bırak? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan].';
$phpMussel['lang']['config_general_enable_plugins'] = 'phpMussel eklentileri için desteği etkinleştirilsin mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel, dosya yüklemesi engellenen mesajla birlikte hangi başlıkları göndermelidir? Yanlış/False = 200 OK (Tamam); Doğru/True = 403 Forbidden (Yasak) [Varsayılan].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Ön uç giriş denemelerini kaydetmek için kullanılan dosya. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Honeypot modu etkinleştirildiğinde, phpMussel karşılaştığı her dosya yüklemesini karantinaya almaya çalışacaktır, dahil olan imzalardan herhangi biriyle eşleşip eşleşmediğine bakılmaksızın, ve aslında hiçbir tarama ya da analiz yapılmayacaktır. Bu işlevsellik, kötücül yazılım araştırması için yararlı olmalıdır, ancak normal şartlar altında bu işlevselliği etkinleştirmeniz önerilmez. Varsayılan olarak, bu seçenek devre dışıdır. Yanlış/False = Devre dışı [Varsayılan]; Doğru/True = Etkinleştirildi.';
$phpMussel['lang']['config_general_ipaddr'] = 'Bağlama isteklerinin IP adresi nerede bulunur? (Cloudflare ve benzeri hizmetler için yararlıdır). Varsayılan = REMOTE_ADDR. UYARI: Ne yaptığınızı bilmiyorsanız bunu değiştirmeyin!';
$phpMussel['lang']['config_general_lang'] = 'phpMussel için varsayılan dili belirleyin.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Bakım modunu etkinleştirilsin mi? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan]. Ön uç haricindeki her şeyi devre dışı bırakır. Bazen CMS\'nizi, çerçeveleri vb. güncellenirken yararlıdır.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Maksimum giriş denemesi sayısı.';
$phpMussel['lang']['config_general_numbers'] = 'Numaraların görüntülenmesini nasıl tercih edersiniz? Size en uygun görünen örneği seçin.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel dosyaları karantinaya koyabilir, bunu yapmak istiyorsan. Web sitelerini korumak isteyen, dosyaları derinlemesine analiz etmek istemeyen kullanıcılar bu işlevselliği devre dışı bırakmalıdır. Dosyaları daha derinlemesine analiz etmek isteyen tüm kullanıcılar (ör., kötü amaçlı yazılım araştırmaları) bu işlevselliği etkinleştirmelidir. Dosyaları karantinaya koymak bazen yanlış pozitiflerin hata ayıklanmasına yardımcı olabilir. Bunu devre dışı bırakmak için <code>quarantine_key</code> yönergesini boş bırakın (veya henüz boş değilse içeriğini sil). Etkinleştirmek için bir miktar girin. <code>quarantine_key</code> karantina işlevinin önemli bir güvenlik özelliğidir. Bu yönerge, potansiyel saldırganların karantina içeriğini istismar etmesini önler. <code>quarantine_key</code>, şifrelerinizle aynı şekilde ele alınmalıdır: Dikkatli koruyun, ve uzun olanlar daha iyidir. En iyi efekti elde etmek için <code>delete_on_sight</code> ile birlikte kullanın.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'Dosyaların karantinaya alınmasına izin verilen maksimum dosya boyutu. Belirtilen değerden büyük dosyalar karantinaya Alınmayacaktır. Bu yönerge olası herhangi bir saldırganın karantinaya istenmeyen verilerle sel baskını yapmasını zorlaştıran bir araç olarak önemlidir. Varsayılan = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'Karantina için izin verilen maksimum bellek kullanımı. Karantina tarafından kullanılan toplam bellek bu değere ulaşırsa, kullanılan en büyük bellek artık bu değere ulaşıncaya kadar en eski karantinaya alınan dosyalar silinir. Bu yönerge olası herhangi bir saldırganın karantinaya istenmeyen verilerle sel baskını yapmasını zorlaştıran bir araç olarak önemlidir. Varsayılan = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'phpMussel tarama sonuçlarını ne kadar süreyle önbelleğe almalı? Değer, tarama sonuçlarının önbellekleneceği saniye sayısıdır. Varsayılan 21600 saniyedir (6 saat); 0 değeri, tarama sonuçlarını önbelleğe almayı devre dışı bırakır.';
$phpMussel['lang']['config_general_scan_kills'] = 'Engellenen ve silinen yüklemelerin tüm kayıtlarını kaydetmek için kullanılan dosyanın adı. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_scan_log'] = 'Tüm tarama sonuçlarını günlüğe kaydetmek için dosyanın adı. Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Tüm tarama sonuçlarını kaydetmek için dosyanın adı (seri hale getirilmiş bir format kullanarak). Dosya adı belirtin veya devre dışı bırakmak için boş bırakın.';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel kullanım istatistiklerini takip et? Doğru/True = Evet; Yanlış/False = Hayır [Varsayılan].';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel tarafından kullanılan tarih/saat gösterimi biçimi. İsteğe bağlı olarak ek seçenekler eklenebilir.';
$phpMussel['lang']['config_general_timeOffset'] = 'Dakika cinsinden zaman dilimi farkı.';
$phpMussel['lang']['config_general_timezone'] = 'Zaman diliminiz.';
$phpMussel['lang']['config_general_truncate'] = 'Belirli bir boyuta ulaştığında günlük dosyalarını kesin? Değer, bir günlük dosyasının kesilmeden önce büyüyebileceği B/KB/MB/GB/TB cinsinden maksimum boyuttur. Varsayılan 0KB değeri, kesmeyi devre dışı bırakır (günlük dosyaları sınırsız büyüyebilir). Not: Tek tek kayıt dosyaları için geçerlidir! Günlük dosyalarının boyutu toplam olarak alınmaz.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Şüpheli ve potansiyel olarak kötü amaçlı dosya kalitesini tanımlamak için phpMussel\'de imzalar var. Bu dosya kalitesi, dosyanın kötü amaçlı olduğu anlamına gelmez, ancak çok sayıda dosya kalitesi dosyanın kötü amaçlı olduğunu gösterebilir. Bu "threshold" değeri, phpMussel\'a şüpheli ve potansiyel olarak kötü amaçlı dosya kalitesinin maksimum toplam ağırlığını bildirir. Bu maksimumu aşmak, dosyanın kötü amaçlı olarak tanımlanmasına neden olur. Bu bağlamda ağırlığın tanımı, belirlenen şüpheli ve potansiyel olarak kötü amaçlı özelliklerin toplam sayısıdır. Varsayılan olarak, Bu değer 3\'e ayarlanacaktır. Daha düşük bir değer genelde yanlış pozitif sonuçların ortaya çıkmasına neden olur, ancak daha yüksek sayıda kötü amaçlı dosyanın bayraklı olduğu görülürken, daha yüksek bir değer genellikle yanlış pozitiflerin oluşumuyla sonuçlanır, ancak bayrak altındaki kötü amaçlı dosyaların sayısı daha düşük olur. Mümkün olduğunda bu değeri varsayılan değerlerine bırakmak genellikle en iyisidir.';
$phpMussel['lang']['config_signatures_Active'] = 'Aktif imza dosyalarının virgülle ayrılmış bir listesi.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel reklam yazılımlarını algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel bozulmalar ve defacement ları tespiti için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel şifrelenmiş dosyaları algılayıp bloke etmeli mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel sahtekarlık programlarını tespit etmek için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel paketleyicileri ve paketlenmiş verileri algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel PU(A/P)\'ları algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel kabuk komut dosyalarını algılamak için imzaları işleyecek mi? Yanlış/False = Hayır; Doğru/True = Evet [Varsayılan].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Uzantılar eksik olduğunda phpMussel raporlamalı mı? <code>fail_extensions_silently</code> devre dışı bırakılırsa, eksik uzantılar tarama sırasında raporlanacak, ve <code>fail_extensions_silently</code> etkinleştirilmişse, eksik uzantılar yok sayılır, ve bu dosyalarda herhangi bir sorun olmadığını bildirir. Bu yönergenin devre dışı bırakılması, potansiyel olarak güvenliğinizi artırabilir, ancak yanlış pozitifliklerin artmasına neden olabilir. Yanlış/False = Devre dışı; Doğru/True = Etkinleştirildi [Varsayılan].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'İmzalar dosyaları eksik veya bozuk olduğunda phpMussel raporlamalı mı? <code>fail_silently</code> devre dışı bırakılırsa, eksik veya bozuk dosyalar tarama sırasında rapor edilecektir, ve <code>fail_silently</code> etkinleştirilmişse, eksik ve bozuk dosyalar yok sayılır, ve bu dosyalarda herhangi bir sorun olmadığını bildirir. Sorun yaşamadığınız sürece bu yalnız bırakılmalıdır. Yanlış/False = Devre dışı; Doğru/True = Etkinleştirildi [Varsayılan].';
$phpMussel['lang']['config_template_data_css_url'] = 'Özel temalar için CSS dosyası URL\'si.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Yazı tipi büyütme. Varsayılan = 1.';
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
$phpMussel['lang']['Extended Description: phpMussel'] = 'Ana paket (hariç imzalar, belgeler, ve yapılandırma).';
$phpMussel['lang']['field_activate'] = 'Etkinleştir';
$phpMussel['lang']['field_clear_all'] = 'Hepsini temizle';
$phpMussel['lang']['field_component'] = 'Bileşen';
$phpMussel['lang']['field_create_new_account'] = 'Yeni Hesap Oluştur';
$phpMussel['lang']['field_deactivate'] = 'Devre dışı bırak';
$phpMussel['lang']['field_delete_account'] = 'Hesabı sil';
$phpMussel['lang']['field_delete_all'] = 'Hepsini sil';
$phpMussel['lang']['field_delete_file'] = 'Sil';
$phpMussel['lang']['field_download_file'] = 'İndir';
$phpMussel['lang']['field_edit_file'] = 'Düzenle';
$phpMussel['lang']['field_false'] = 'False (Yanlış)';
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
$phpMussel['lang']['field_quarantine_key'] = 'Karantina anahtarı';
$phpMussel['lang']['field_rename_file'] = 'Adını değiştirmek';
$phpMussel['lang']['field_reset'] = 'Sıfırla';
$phpMussel['lang']['field_restore_file'] = 'Canlandır';
$phpMussel['lang']['field_set_new_password'] = 'Yeni Şifre Oluştur';
$phpMussel['lang']['field_size'] = 'Toplam Boyut: ';
$phpMussel['lang']['field_size_bytes'] = 'bayt';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Durum';
$phpMussel['lang']['field_system_timezone'] = 'Sistem varsayılan saat dilimini kullanın.';
$phpMussel['lang']['field_true'] = 'True (Doğru)';
$phpMussel['lang']['field_uninstall'] = 'Kaldır';
$phpMussel['lang']['field_update'] = 'Güncelle';
$phpMussel['lang']['field_update_all'] = 'Tümünü güncelle';
$phpMussel['lang']['field_upload_file'] = 'Yeni dosya yükle';
$phpMussel['lang']['field_username'] = 'Kullanıcı adı';
$phpMussel['lang']['field_your_version'] = 'Sürümünüz';
$phpMussel['lang']['header_login'] = 'Devam etmek için lütfen giriş yapınız.';
$phpMussel['lang']['label_active_config_file'] = 'Etkin yapılandırma dosyası: ';
$phpMussel['lang']['label_blocked'] = 'Yüklemeler engellendi';
$phpMussel['lang']['label_branch'] = 'Branşı en yeni kararlı:';
$phpMussel['lang']['label_events'] = 'Tara olayları';
$phpMussel['lang']['label_flagged'] = 'İşaretlenen nesneler';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Önbellek verileri ve geçici dosyalar';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel disk kullanımı: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Boş disk alanı: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Toplam disk kullanımı: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Toplam disk alanı: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Bileşen güncellemeleri meta verileri';
$phpMussel['lang']['label_hide'] = 'Saklamak';
$phpMussel['lang']['label_os'] = 'Kullanılan işletim sistemi:';
$phpMussel['lang']['label_other'] = 'Diğer';
$phpMussel['lang']['label_other-Active'] = 'Etkin imza dosyaları';
$phpMussel['lang']['label_other-Since'] = 'Başlangıç tarihi';
$phpMussel['lang']['label_php'] = 'Kullanılan PHP sürümü:';
$phpMussel['lang']['label_phpmussel'] = 'Kullanılan phpMussel sürümü:';
$phpMussel['lang']['label_quarantined'] = 'Karantinaya yüklenenler';
$phpMussel['lang']['label_sapi'] = 'Kullanılan SAPI:';
$phpMussel['lang']['label_scanned_objects'] = 'Nesneler tarandı';
$phpMussel['lang']['label_scanned_uploads'] = 'Yüklenenler tarandı';
$phpMussel['lang']['label_show'] = 'Göstermek';
$phpMussel['lang']['label_size_in_quarantine'] = 'Karantinadaki boyutu: ';
$phpMussel['lang']['label_stable'] = 'En yeni kararlı:';
$phpMussel['lang']['label_sysinfo'] = 'Sistem bilgisi:';
$phpMussel['lang']['label_tests'] = 'Testler:';
$phpMussel['lang']['label_unstable'] = 'En yeni kararsız:';
$phpMussel['lang']['label_upload_date'] = 'Yükleme tarihi: ';
$phpMussel['lang']['label_upload_hash'] = 'Yükleme karması: ';
$phpMussel['lang']['label_upload_origin'] = 'Yükleme menşe: ';
$phpMussel['lang']['label_upload_size'] = 'Yükleme boyutu: ';
$phpMussel['lang']['link_accounts'] = 'Hesaplar';
$phpMussel['lang']['link_config'] = 'Yapılandırma';
$phpMussel['lang']['link_documentation'] = 'Belgeler';
$phpMussel['lang']['link_file_manager'] = 'Dosya Yöneticisi';
$phpMussel['lang']['link_home'] = 'Ana Sayfa';
$phpMussel['lang']['link_logs'] = 'Kayıtlar';
$phpMussel['lang']['link_quarantine'] = 'Karantina';
$phpMussel['lang']['link_statistics'] = 'İstatistik';
$phpMussel['lang']['link_textmode'] = 'Metin biçimlendirme: <a href="%1$sfalse">Basit</a> – <a href="%1$strue">Süslü</a>';
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
$phpMussel['lang']['response_configuration_updated'] = 'Yapılandırma başarıyla güncellendi.';
$phpMussel['lang']['response_deactivated'] = 'Başarıyla devre dışı bırakıldı.';
$phpMussel['lang']['response_deactivation_failed'] = 'Devre dışı bırakılamadı!';
$phpMussel['lang']['response_delete_error'] = 'Silinemedi!';
$phpMussel['lang']['response_directory_deleted'] = 'Dizin başarıyla silindi!';
$phpMussel['lang']['response_directory_renamed'] = 'Dizin başarıyla yeniden adlandırıldı!';
$phpMussel['lang']['response_error'] = 'Hata';
$phpMussel['lang']['response_failed_to_install'] = 'Yükleme başarısız!';
$phpMussel['lang']['response_failed_to_update'] = 'Güncelleme başarısız!';
$phpMussel['lang']['response_file_deleted'] = 'Dosya başarıyla silindi!';
$phpMussel['lang']['response_file_edited'] = 'Dosya başarıyla değiştirildi!';
$phpMussel['lang']['response_file_renamed'] = 'Dosya başarıyla yeniden adlandırıldı!';
$phpMussel['lang']['response_file_restored'] = 'Dosya başarıyla canlandırıldı!';
$phpMussel['lang']['response_file_uploaded'] = 'Dosya başarıyla yüklendi!';
$phpMussel['lang']['response_login_invalid_password'] = 'Giriş başarısız! Geçersiz parola!';
$phpMussel['lang']['response_login_invalid_username'] = 'Giriş başarısız! Kullanıcı adı yok!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Parola alanı boş!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Kullanıcı adı alanı boş!';
$phpMussel['lang']['response_rename_error'] = 'Yeniden adlandırılamadı!';
$phpMussel['lang']['response_restore_error_1'] = 'Canlanamadı! Bozuk dosya!';
$phpMussel['lang']['response_restore_error_2'] = 'Canlanamadı! Yanlış karantina anahtarı!';
$phpMussel['lang']['response_statistics_cleared'] = 'İstatistikler temizlendi.';
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
$phpMussel['lang']['state_maintenance_mode'] = 'Uyarı: Bakım modu etkin!';
$phpMussel['lang']['state_password_not_valid'] = 'Uyarı: Bu hesap geçerli bir şifre kullanmıyor!';
$phpMussel['lang']['state_quarantine'] = ['Şu anda karantina içinde %s dosya var.', 'Şu anda karantina içinde %s dosyalar var.'];
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
$phpMussel['lang']['tip_quarantine'] = 'Merhaba, {username}.<br />Bu sayfada, şu anda karantinadaki tüm dosyaları listeler ve bu dosyaların yönetimini kolaylaştırır.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Not: Karantina şu anda devre dışıdır, ancak yapılandırma sayfası aracılığıyla etkinleştirilebilir.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Çeşitli yapılandırma yönergeleri ve amaçlarıyla ilgili bilgi için <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION7">belgelere</a> bakın.';
$phpMussel['lang']['tip_statistics'] = 'Merhaba, {username}.<br />Bu sayfada, phpMussel kurulumunuzla ilgili bazı temel kullanım istatistikleri gösterilmektedir.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Not: İstatistik izleme şu anda devre dışı, ancak yapılandırma sayfası aracılığıyla etkinleştirilebilir.';
$phpMussel['lang']['tip_updates'] = 'Merhaba, {username}.<br />Güncellemeler sayfası, phpMussel\'ın çeşitli bileşenlerini (çekirdek paket, imzalar, L10N dosyaları vb.) yüklemenizi, kaldırmanızı ve güncellemenizi sağlar.';
$phpMussel['lang']['tip_upload_test'] = 'Merhaba, {username}.<br />Yükleme sınama sayfası, bir dosyanın yüklenmeye çalışılırken normalde phpMussel tarafından engelleneceğini test etmenize izin veren standart bir dosya yükleme formu içerir.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Hesaplar';
$phpMussel['lang']['title_config'] = 'phpMussel – Yapılandırma';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Dosya Yöneticisi';
$phpMussel['lang']['title_home'] = 'phpMussel – Ana Sayfa';
$phpMussel['lang']['title_login'] = 'phpMussel – Giriş';
$phpMussel['lang']['title_logs'] = 'phpMussel – Kayıtlar';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Karantina';
$phpMussel['lang']['title_statistics'] = 'phpMussel – İstatistik';
$phpMussel['lang']['title_updates'] = 'phpMussel – Güncellemeler';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Yükleme Testi';
$phpMussel['lang']['warning'] = 'Uyarılar:';
$phpMussel['lang']['warning_php_1'] = 'PHP sürümünüz aktif olarak desteklenmiyor! Güncelleme önerilir!';
$phpMussel['lang']['warning_php_2'] = 'PHP sürümünüz ağır savunmasız! Güncelleme önerilir!';
$phpMussel['lang']['warning_signatures_1'] = 'Hiçbir imza dosyası aktif değil!';

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
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Güvenlik Açığı Tabloları</a> – Çeşitli paketler (PHP, HHVM, vb.) güvenli/güvensiz sürümlerini listeler.</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Uyumluluk Tabloları</a> – Çeşitli paketler (CIDRAM, phpMussel, vb.) için uyumluluk bilgilerini listeler.</li>
        </ul>';
