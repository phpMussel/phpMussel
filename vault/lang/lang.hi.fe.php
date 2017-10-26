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
 * This file: Hindi language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">होमपेज</a> | <a href="?phpmussel-page=logout">लोग आउट</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">लोग आउट</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'अभिलेखागार के लिए ज्ञात फाइल एक्सटेंशन (प्रारूप CSV है; समस्याएं होने पर केवल जोड़ या निकालना चाहिए; हटाने के कारण संग्रह फाइलों के लिए झूठी सकारात्मक दिखाई दे सकते हैं, जबकि जोड़ना अनिवार्य रूप से श्वेतसूची में होगा जो आप हमला विशिष्ट पहचान से जोड़ रहे हैं; सावधानी के साथ संशोधित करें; यह भी ध्यान रखें कि कंटेंट स्तर पर अभिलेखागार क्या कर सकते हैं और इसका विश्लेषण नहीं किया जा सकता है इसका इसका कोई प्रभाव नहीं है)। सूची, जैसा कि डिफ़ॉल्ट रूप से है, उन स्वरूपों को सूचीबद्ध करता है जो अधिकांश प्रणालियों और CMS पर सबसे ज्यादा इस्तेमाल करते हैं, लेकिन जानबूझकर व्यापक रूप से व्यापक नहीं है।';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'किसी भी नियंत्रण पात्रों (नई लाइनों के अलावा) वाले किसी भी फाइल को अवरुद्ध करें? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) यदि आप केवल सादा-पाठ अपलोड कर रहे हैं, तो आप अपने सिस्टम पर कुछ अतिरिक्त सुरक्षा प्रदान करने के लिए इस विकल्प को चालू कर सकते हैं। हालांकि, यदि आप सादा-पाठ के अलावा कुछ भी अपलोड करते हैं, तो इसे बदलकर गलत सकारात्मक परिणाम हो सकते हैं। False(झूठी) = ब्लॉक न करें [डिफ़ॉल्ट]; True(सच्चे) = ब्लॉक करें।';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'फाइलों में एक्जिक्यूटिव हेडर की खोज करें, जो न तो निष्पादन योग्य हैं और न ही अभिलेखीय अभिलेखागार हैं और जिनके हेडर गलत हैं। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'फाइलों में PHP हेडर के लिए खोजें, जो न तो PHP फाइलें अभिलेखीय मान्यता प्राप्त नहीं हैं। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'अभिलेखों के लिए खोजें जिनके शीर्षलेख गलत हैं (समर्थित: BZ, GZ, RAR, ZIP, RAR, GZ). False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'कार्यालय दस्तावेज़ों के लिए खोजें जिनके हेडर गलत हैं (समर्थित: DOC, DOT, PPS, PPT, XLA, XLS, WIZ)। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'उन छवियों के लिए खोजें जिनके शीर्षलेख गलत हैं (समर्थित: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP)। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'PDF फाइलों के लिए खोजें जिनके हेडर गलत हैं। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'भ्रष्ट फाइलें और पार्स त्रुटियां। False(झूठी) = ध्यान न दें; True(सच्चे) = ब्लॉक करना [डिफ़ॉल्ट]। संभावित दूषित PE (पोर्टेबल निष्पादन योग्य) फाइलों को पहचान और अवरुद्ध करें? अक्सर (लेकिन हमेशा नहीं), जब किसी PE फाइल के कुछ पहलू भ्रष्ट होते हैं या ठीक से पार्स नहीं किए जा सकते हैं, तो यह वायरल संक्रमण का संकेत हो सकता है। PE फाइलों में वायरस का पता लगाने के लिए अधिकांश एंटी-वायरस प्रोग्रामों द्वारा उपयोग की जाने वाली प्रक्रियाओं को उन फाइलों को निश्चित तरीके से पार्स करना पड़ता है, और यदि वायरस के प्रोग्रामर को इस बारे में पता है, तो वे वायरस को अनक्रेता बनाए रखने के लिए रोकने की कोशिश करेंगे।';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'डीकोड कमांड की अधिकतम लंबाई का पता लगाया जाना चाहिए (अगर स्कैनिंग के दौरान कोई भी स्पष्ट प्रदर्शन समस्याएं हैं)। डिफ़ॉल्ट = 512KB। शून्य सीमा को अक्षम करता है (फाइलसिस्टम के आधार पर किसी भी सीमा को हटाने)।';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'कच्चे डेटा के लिए अधिकतम लंबाई जो phpMussel को पढ़ने और स्कैन करने की अनुमति है (अगर स्कैनिंग के दौरान कोई भी स्पष्ट प्रदर्शन समस्याएं हैं)। डिफ़ॉल्ट = 32MB। शून्य या शून्य मान सीमा को निष्क्रिय कर देता है। आम तौर पर, यह मान आपके द्वारा अपलोड किए जाने वाले फाइल अपलोड की औसत फाइल से कम नहीं होना चाहिए और आपके सर्वर या वेबसाइट पर प्राप्त होने की उम्मीद है, "filesize_limit" निर्देश से अधिक नहीं होना चाहिए, और लगभग एक से अधिक नहीं होना चाहिए "php.ini" विन्यास फाइल के माध्यम से PHP को दी जाने वाली कुल स्वीकार्य स्मृति आवंटन का पांचवां हिस्सा। phpMussel को बहुत अधिक स्मृति का उपयोग करने से रोकने के लिए यह निर्देश मौजूद है (जो इसे किसी निश्चित फाइल साइड के ऊपर फाइल को सफलतापूर्वक स्कैन करने में सक्षम होने से रोक देगा)।';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'आमतौर पर यह निर्देश आम तौर पर अक्षम किया जाता है जब तक कि आपके विशिष्ट सिस्टम पर phpMussel की सही कार्यक्षमता के लिए आवश्यक नहीं हो। आम तौर पर, अक्षम होने पर, जब phpMussel <code>$_FILES</code> सरणी में तत्वों की मौजूदगी का पता लगाता है, यह उन तत्वों को स्कैन करने की कोशिश करेगा और उन तत्वों को रिक्त या खाली होने पर, उन तत्वों का प्रतिनिधित्व करते हैं, और, phpMussel एक त्रुटि संदेश वापस करेगा। यह phpMussel के लिए उचित व्यवहार है। यदि यह आपके सिस्टम या CMS के लिए समस्याएं पैदा करता है, तो इस विकल्प को सक्षम करने से phpMussel को यह स्कैन करने का प्रयास नहीं किया जाएगा; उन्हें जब पाया जाता है पर ध्यान नहीं दिया जाएगा और कोई त्रुटि संदेश नहीं मिलेगा, इस प्रकार पृष्ठ अनुरोध को जारी रखने की अनुमति दी गई है। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'यदि आप केवल अपने सिस्टम या CMS पर छवियों को अपलोड करने की अनुमति देते हैं, और अगर आपको पूरी तरह से आपके सिस्टम या CMS पर अपलोड किए जाने वाले चित्रों के अलावा किसी भी फाइल की आवश्यकता नहीं है, यह निर्देश सक्षम होना चाहिए, लेकिन अन्यथा अक्षम होना चाहिए। यदि यह निर्देश सक्षम किया गया है, तो वह गैर-छवि फाइलों के रूप में पहचाने गए किसी भी अपलोड को अंधाधुंध रूप से ब्लॉक करने के लिए phpMussel को निर्देशित करेगा। इससे गैर-छवि फाइलों को अपलोड करने के प्रयास के लिए प्रोसेसिंग समय और मेमोरी उपयोग घट सकता है। False(झूठी) = अक्षम; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'एन्क्रिप्टेड अभिलेखागार का पता लगाओ और ब्लॉक करें? phpMussel एन्क्रिप्टेड अभिलेखागार की सामग्री को स्कैन करने में सक्षम नहीं है, इसलिए, यह संभव है कि पुरालेख एन्क्रिप्शन किसी हमलावर द्वारा phpMussel, एंटी वायरस स्कैनर और अन्य ऐसी सुरक्षा को बायपास करने के प्रयास के रूप में नियोजित किया जा सकता है। एन्क्रिप्टेड अभिलेखागार को ब्लॉक करने के लिए phpMussel को निर्देशित करने से इस के साथ जुड़े किसी भी जोखिम को कम करने में मदद मिल सकती है। False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_files_check_archives'] = 'अभिलेखागार की सामग्री की जांच करने का प्रयास? False(झूठी) = उन्हें जांच न करें; True(सच्चे) = उन्हें जांच [डिफ़ॉल्ट]. वर्तमान में, समर्थित केवल संग्रह और संपीड़न प्रारूप BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR और ZIP हैं। (RAR, CAB, 7z और वगैरह वर्तमान में समर्थित नहीं है)। यह अचूक नहीं है! मैं यह अनुशंसा करता हूं कि यह चालू हो, लेकिन मैं गारंटी नहीं दे सकता कि यह हमेशा सब कुछ पायेगा। भी, ध्यान रखें कि वर्तमान में संग्रह की जांच PHAR या ZIP प्रारूप के लिए पुनरावर्ती नहीं है।';
$phpMussel['lang']['config_files_filesize_archives'] = 'अभिलेखागार की सामग्री को काली सूची / सफेद सूची पर लागू करें? False(झूठी) = नहीं (बस धूसर सूची सब कुछ); True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_files_filesize_limit'] = 'KB में फाईलिस की सीमा। 65536 = 64MB [डिफ़ॉल्ट]; 0 = कोई सीमा नहीं (धूसर सूची पर तरह व्यवहार)। कोई भी सकारात्मक संख्यात्मक मान स्वीकार किया। यह उपयोगी हो सकता है जब आपकी PHP कॉन्फ़िगरेशन मेमोरी की मात्रा को सीमित कर सकती है जो किसी प्रक्रिया को रोक सकती है या यदि आपका PHP कॉन्फ़िगरेशन अपलोड अपलोड करने में सीमित है।';
$phpMussel['lang']['config_files_filesize_response'] = 'फाइलों के साथ क्या करना है जो फाईलिज़ सीमा से अधिक हो (यदि कोई मौजूद है)। False(झूठी) = सफेद सूची; True(सच्चे) = काली सूची [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_files_filetype_archives'] = 'अभिलेखागार की सामग्री के लिए काली सूची / सफेद सूची में फाइल प्रकार प्राप्त करें? False(झूठी) = नहीं (सब कुछ ग्रे सूचीबद्ध के रूप में व्यवहार करें) [डिफ़ॉल्ट]; True(सच्चे) = हाँ.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'काली सूची:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'धूसर सूची:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'यदि आपका सिस्टम केवल विशिष्ट प्रकार की फाइलों को अपलोड करने की अनुमति देता है, या यदि आपका सिस्टम कुछ प्रकार की फाइलों को स्पष्ट रूप से इनकार करता है, तो काली सूची, धूसर सूची और सफेद सूची में उन फाइलप्रकार को निर्दिष्ट करते हुए स्पीड को बढ़ाया जा सकता है जिस पर स्कैनिंग की अनुमति हो सकती है, फाइल प्रकारों। प्रारूप CSV है (कॉमा से अलग किए गए मान)। यदि आप सब कुछ स्कैन करना चाहते हैं, तो रिक्त स्थान को छोड़ दें; ऐसा करने से धूसर सूची / काली सूची / सफेद सूची अक्षम हो जाएगा। प्रसंस्करण के तार्किक आदेश: अगर फाइल प्रकार सफेद सूची में है, तो स्कैन न करें और फाइल को ब्लॉक न करें, और फाइल को काली सूची या धूसर सूची के खिलाफ जांच न करें। यदि फाइलप्रकार काली सूची पर है, तो फाइल को स्कैन नहीं करें, लेकिन इसे किसी भी तरह से अवरुद्ध करें, और फाइल धूसर सूची के खिलाफ जांच न करें। यदि धूसर सूची रिक्त है या यदि धूसर सूची खाली नहीं है और फाइल प्रकार धूसर सूची पर है, तो फाइल को सामान्य रूप से स्कैन करें और यह निर्धारित करें कि स्कैन के परिणामों के आधार पर इसे ब्लॉक करना है या नहीं। यदि धूसर सूची खाली नहीं है और फाइल प्रकार धूसर सूची पर नहीं है, तो फाइल को काली सूची पर बताए अनुसार रखें। सफेद सूची:';
$phpMussel['lang']['config_files_max_recursion'] = 'अभिलेखागार के लिए अधिकतम पुनरावर्ती गहराई सीमा। डिफ़ॉल्ट = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'अपलोड करने पर स्कैन करने के लिए फाइलों की अधिकतम अनुमति संख्या, स्कैन को रद्द करने और उपयोगकर्ता को सूचित करने से पहले वे एक बार में बहुत अधिक अपलोड कर रहे हैं! एक सैद्धांतिक हमले के विरुद्ध सुरक्षा प्रदान करता है जिससे एक हमलावर phpMussel को ओवरलोड करने के द्वारा पीडीपी PHP को धीमा करने के लिए पीसने से रोकने के लिए आपका सिस्टम या CMS का प्रयास करता है। अनुशंसित: 10. आप अपने हार्डवेयर की गति के आधार पर इस नंबर को बढ़ा या कम कर सकते हैं। ध्यान दें कि इस संख्या में अभिलेखागार की सामग्री शामिल नहीं है।';
$phpMussel['lang']['config_general_cleanup'] = 'प्रारंभिक अपलोड स्कैनिंग के बाद स्क्रिप्ट द्वारा उपयोग किए गए वैरिएबल और कैशे को अनसेट करें? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]. यदि आप अपलोड के अलावा किसी और चीज़ के लिए स्क्रिप्ट का उपयोग नहीं कर रहे हैं, तो आपको इसे "<code>true</code>" (सच्चे) पर सेट करना चाहिए। अन्यथा, आपको इसे "false" (झूठी) पर सेट करना चाहिए। सामान्य व्यवहार में, इसे आम तौर पर "<code>true</code>" (सच्चे) पर सेट किया जाना चाहिए, लेकिन अगर आप ऐसा करते हैं, तो स्क्रिप्ट का उपयोग केवल अपलोड स्कैन करने के लिए किया जा सकता है। CLI मोड में कोई प्रभाव नहीं है।';
$phpMussel['lang']['config_general_default_algo'] = 'परिभाषित करता है कि भविष्य के सभी पासवर्ड और सत्रों के लिए किस एल्गोरिथम का उपयोग करना है। विकल्प: PASSWORD_DEFAULT (डिफ़ॉल्ट), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 की आवश्यकता है).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'इस निर्देश को सक्षम करने से स्क्रिप्ट को तुरंत किसी भी मापदंड से मेल खाने वाले किसी भी अपलोड को हटाने का प्रयास करने का निर्देश दिया जाएगा। साफ फाइलों को छुआ नहीं जाएगा। अभिलेखागार के मामले में, पूरे संग्रह हटा दिया जाएगा। अपलोड स्कैनिंग के लिए, आम तौर पर, इस निर्देश को सक्षम करने के लिए आवश्यक नहीं है, क्योंकि आमतौर पर PHP निष्पादन समाप्त होने पर स्वतः कैश की सामग्री को स्वतः शुद्ध कर देगा। यह निर्देश यहां अतिरिक्त सुरक्षा के एक अतिरिक्त उपाय के रूप में जोड़ा गया है। False(झूठी) = स्कैनिंग के बाद, अकेले फाइल को छोड़ दें [डिफ़ॉल्ट]; True(सच्चे) = स्कैनिंग के बाद, यदि साफ़ न हो तो तत्काल हटा दें।';
$phpMussel['lang']['config_general_disable_cli'] = 'अक्षम CLI मोड? CLI मोड डिफ़ॉल्ट रूप से सक्षम होता है, लेकिन कभी-कभी कुछ परीक्षण टूल (जैसे कि PHPUnit, उदाहरण के लिए) और अन्य CLI-आधारित अनुप्रयोगों में हस्तक्षेप कर सकता है। यदि आपको CLI मोड को अक्षम करने की आवश्यकता नहीं है, तो आपको इस निर्देश को अनदेखा करना चाहिए। False(झूठी) = CLI मोड सक्षम करें [डिफ़ॉल्ट]; True(सच्चे) = CLI मोड को अक्षम करें।';
$phpMussel['lang']['config_general_disable_frontend'] = 'सामने के अंत पहुँच अक्षम? सामने के अंत पहुंच phpMussel को और अधिक प्रबंधनीय बना सकता है, लेकिन यह भी एक संभावित सुरक्षा जोखिम भी हो सकता है। जब भी संभव हो, बैक-एंड के माध्यम से phpMussel का प्रबंधन करने की सिफारिश की जाती है, लेकिन सुविधा के लिए सामने के अंत पहुँच भी प्रदान किया जाता है। इसे तब तक अक्षम रखें जब तक आपको इसकी आवश्यकता न हो। False(झूठी) = सामने के अंत पहुँच सक्षम करें; True(सच्चे) = सामने के अंत पहुँच अक्षम करें [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_general_disable_webfonts'] = 'निष्क्रिय वेब फोंट? True(सच्चे) = हाँ; False(झूठी) = नहीं [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_general_enable_plugins'] = 'phpMussel प्लग-इन के लिए समर्थन सक्षम करें? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_general_forbid_on_block'] = 'फाइल अपलोड अवरुद्ध संदेश के साथ phpMussel 403 हेडर भेजना चाहिए, या 200 OK भेजें? False(झूठी) = नहीं (200); True(सच्चे) = हाँ (403) [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_general_FrontEndLog'] = 'सामने के अंत में प्रवेश प्रयासों प्रवेश के लिए दायर। एक फाइल नाम निर्दिष्ट करें, या निष्क्रिय करने के लिए खाली छोड़।';
$phpMussel['lang']['config_general_honeypot_mode'] = 'जब honeypot मोड सक्षम होता है, phpMussel प्रत्येक अपलोड को संगरोध करने का प्रयास करेगा जो इसे मुठभेड़ करता है। वास्तव में कोई स्कैनिंग या विश्लेषण नहीं होगा। वायरस/मैलवेयर अनुसंधान के लिए यह कार्यक्षमता उपयोगी होनी चाहिए। यह सामान्य परिस्थितियों में इस कार्यक्षमता को सक्षम करने के लिए अनुशंसित नहीं है। डिफ़ल्ट रूप में यह विकल्प अक्षम है। False(झूठी) = अक्षम [डिफ़ॉल्ट]; True(सच्चे) = सक्षम।';
$phpMussel['lang']['config_general_ipaddr'] = 'कहां अनुरोध जोड़ने के IP पते खोजने के लिए? (जैसा CloudFlare के रूप में सेवाओं और पसंद के लिए उपयोगी)। डिफ़ॉल्ट = REMOTE_ADDR। चेतावनी: जब तक कि आप को पता है तुम क्या कर रहे हो उसे बदल नहीं!';
$phpMussel['lang']['config_general_lang'] = 'phpMussel लिए डिफ़ॉल्ट भाषा निर्दिष्ट।';
$phpMussel['lang']['config_general_maintenance_mode'] = 'रखरखाव मोड सक्षम करें? True(सच्चे) = हाँ; False(झूठी) = नहीं [डिफ़ॉल्ट]। सामने के अंत के अलावा अन्य सभी को अक्षम करता है। आपके CMS, फ़्रेमवर्क, आदि को अपडेट करने के लिए कभी-कभी उपयोगी।';
$phpMussel['lang']['config_general_max_login_attempts'] = 'लॉगिन प्रयासों की अधिकतम संख्या।';
$phpMussel['lang']['config_general_numbers'] = 'आप संख्याओं को प्रदर्शित करने के लिए कैसे पसंद करते हैं? उदाहरण का चयन करें जो आपके लिए सबसे सही लग रहा है।';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel वॉल्ट(vault) में अपलोड संगरोध को सक्षम करने में सक्षम है, यदि आप यह चाहते हैं। उपयोगकर्ता जो केवल अपनी वेबसाइटों और होस्टिंग पर्यावरण की रक्षा करना चाहते हैं, जो फाइल अपलोड के लिए विश्लेषण के एक गहरे स्तर पर रूचि नहीं रखते, इस सुविधा को निष्क्रिय कर देना चाहिए, लेकिन मैलवेयर अनुसंधान के लिए पहचाने गई अपलोड के आगे के विश्लेषण में दिलचस्पी रखने वाले किसी भी उपयोगकर्ता या ऐसी ही चीज़ों के लिए इस कार्यक्षमता को सक्षम करना चाहिए। क्वारंटाइन कभी-कभी झूठी सकारात्मकताओं को डीबग करने में भी सहायता कर सकते हैं, अगर यह नियमित रूप से आवश्यक है। संगरोध को अक्षम करने के लिए, <code>quarantine_key</code> निर्देश खाली छोड़ दें। संगरोध कार्यक्षमता को सक्षम करने के लिए, निर्देश में कुछ मान दर्ज करें। <code>quarantine_key</code> एक महत्वपूर्ण सुरक्षा सुविधा है। यह क्वारंटाइन डेटा के मनमानी निष्पादन को रोकने में मदद कर सकता है। <code>quarantine_key</code> को आपके पासवर्ड के समान व्यवहार किया जाना चाहिए: लंबी अवधि बेहतर है, और इसे बारीकी से संरक्षित करें। सर्वोत्तम प्रभाव के लिए, <code>delete_on_sight</code> के साथ संयोजन के रूप में उपयोग करें।';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'फाइलों के लिए अधिकतम स्वीकार्य आकार को अलग रखा जाना चाहिए। निर्दिष्ट मूल्य से अधिक फाइलों को अलग-थलग नहीं किया जाएगा। यह निर्देश किसी संभावित हमलावरों के लिए अवांछित डेटा के साथ आपके संगरोध को बाधित करने के लिए इसे और अधिक कठिन बनाने के एक साधन के रूप में महत्वपूर्ण है। डिफ़ॉल्ट = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'क्वारंटाइन के लिए अनुमति अधिकतम स्मृति उपयोग। यदि संगरोध द्वारा उपयोग की जाने वाली कुल मेमोरी इस मान पर पहुंचती है, सबसे पुराना संगरोध फाइलें हटा दी जाएगी, जब तक कुल स्मृति का उपयोग अब इस मान तक नहीं पहुंच जाएगा। यह निर्देश किसी संभावित हमलावरों के लिए अवांछित डेटा के साथ आपके संगरोध को बाधित करने के लिए इसे और अधिक कठिन बनाने के एक साधन के रूप में महत्वपूर्ण है। डिफ़ॉल्ट = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'स्कैनिंग के परिणामों को कब कैसा होना चाहिए phpMussel? स्कैनिंग के परिणामों को कैश करने के लिए मूल्य सेकंड की संख्या है। डिफ़ॉल्ट 21600 सेकंड (6 घंटे) है; 0 का मान स्कैनिंग के परिणाम कैशिंग को अक्षम करेगा।';
$phpMussel['lang']['config_general_scan_kills'] = 'अवरुद्ध अपलोड के सभी अभिलेखों को लॉग करने के लिए फाइल का नाम। फाइल नाम निर्दिष्ट करें, या निष्क्रिय करने के लिए खाली छोड़ें।';
$phpMussel['lang']['config_general_scan_log'] = 'सभी स्कैनिंग परिणामों को लॉग करने के लिए फाइल का नाम। फाइल नाम निर्दिष्ट करें, या निष्क्रिय करने के लिए खाली छोड़ें।';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'सभी स्कैनिंग परिणामों को लॉग करने के लिए फाइल का नाम (एक क्रमबद्ध प्रारूप का उपयोग करना). फाइल नाम निर्दिष्ट करें, या निष्क्रिय करने के लिए खाली छोड़ें।';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel उपयोग के सांख्यिकी ट्रैक करें? True(सच्चे) = हाँ; False(झूठी) = नहीं [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel द्वारा इस्तेमाल की तिथियाँ प्रपत्र। अतिरिक्त विकल्प आवेदन शामिल किया जा सकता है।';
$phpMussel['lang']['config_general_timeOffset'] = 'समय क्षेत्र मिनट में ऑफसेट।';
$phpMussel['lang']['config_general_timezone'] = 'अपने समय क्षेत्र।';
$phpMussel['lang']['config_general_truncate'] = 'वह एक विशेष आकार तक पहुँचने में जब साफ प्रवेश फाइलें? मूल्य में B/KB/MB/GB/TB अधिकतम आकार है। जब 0KB, वे अनिश्चित काल तक बढ़ सकता है (डिफ़ॉल्ट)। नोट: एकल फाइल पर लागू होता है! फाइलें सामूहिक विचार नहीं कर रहे हैं।';
$phpMussel['lang']['config_heuristic_threshold'] = 'कुछ ऐसे phpMussel हस्ताक्षर हैं जो फाइलों में संदिग्ध और दुर्भावनापूर्ण प्रॉपर्टी की पहचान करने का इरादा है, लेकिन इसका मतलब यह नहीं है कि फाइल दुर्भावनापूर्ण है। यह "threshold" मान phpMussel को अपलोड किए जाने वाले फाइलों में संदिग्ध और संभावित रूप से दुर्भावनापूर्ण प्रॉपर्टी के लिए अधिकतम अनुमत भार बताता है। जब यह वजन अधिक हो जाता है, तो फाइलों को दुर्भावनापूर्ण के रूप में पहचाना जाता है। डिफ़ॉल्ट रूप से, यह मान 3 पर सेट हो जाएगा। कम मूल्य का परिणाम झूठी सकारात्मक की एक उच्च घटना में होगा, लेकिन दुर्भावनापूर्ण फाइलों की एक उच्च संख्या की पहचान की जा रही है। उच्च मूल्य का परिणाम झूठी सकारात्मक की कम घटना में होगा, लेकिन कम संख्या में दुर्भावनापूर्ण फाइलों की पहचान की जा रही है। आमतौर पर यह मान अपने डिफ़ॉल्ट पर छोड़ देना सबसे अच्छा होता है।';
$phpMussel['lang']['config_signatures_Active'] = 'सक्रिय हस्ताक्षर फाइलों की एक सूची, अल्पविराम से अलग।';
$phpMussel['lang']['config_signatures_detect_adware'] = 'एडवेयर का पता लगाने के लिए phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_deface'] = 'क्या डीफ़ेसेशमेंट और डिफैक्चर का पता लगाने के लिए phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'क्या phpMussel एन्क्रिप्ट की गई फाइलों का पता लगाना और ब्लॉक करना चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'मजाक/धोखाधड़ी मैलवेयर/वायरस का पता लगाने के लिए phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'पैकर्स और पैक किए गए डेटा का पता लगाने के लिए phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'PUP/PUA का पता लगाने के लिए क्या phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_detect_shell'] = 'क्या खोल स्क्रिप्ट का पता लगाने के लिए phpMussel प्रक्रिया हस्ताक्षर चाहिए? False(झूठी) = नहीं; True(सच्चे) = हाँ [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'क्या एक्सटेंशन गुम हैं तो phpMussel रिपोर्ट चाहिए? यदि <code>fail_extensions_silently</code> अक्षम है, लापता एक्सटेंशन स्कैनिंग के दौरान सूचित किया जाएगा, और यदि <code>fail_extensions_silently</code> सक्षम है, लापता एक्सटेंशन को नजरअंदाज कर दिया जाएगा, और यह सूचित किया जाएगा कि कोई समस्या नहीं है। इस निर्देश को अक्षम करने से संभवतः आपकी सुरक्षा में वृद्धि हो सकती है, लेकिन यह झूठी सकारात्मक वृद्धि की भी हो सकती है। False(झूठी) = अक्षम; True(सच्चे) = सक्षम [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_signatures_fail_silently'] = 'क्या phpMussel रिपोर्ट जब हस्ताक्षर फाइलें गायब या दूषित हैं? यदि <code>fail_silently</code> अक्षम है, लापता और दूषित फाइलों की सूचना स्कैनिंग के दौरान की जाएगी, और यदि <code>fail_silently</code> सक्षम है, लापता और भ्रष्ट फाइलें अनदेखा कर दी जाएंगी, और यह उन फाइलों के लिए रिपोर्ट की जाएगी जो किसी भी समस्याएं नहीं हैं। जब तक आप दुर्घटनाओं या इसी तरह की समस्याओं का सामना नहीं कर रहे हैं, तब तक इसे अकेला छोड़ दिया जाना चाहिए। False(झूठी) = अक्षम; True(सच्चे) = सक्षम [डिफ़ॉल्ट]।';
$phpMussel['lang']['config_template_data_css_url'] = 'कस्टम थीम के लिए CSS फाइल URL।';
$phpMussel['lang']['config_template_data_Magnification'] = 'फ़ॉन्ट बढ़ाई। डिफ़ॉल्ट = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'phpMussel के इस्तेमाल के लिए डिफ़ॉल्ट थीम।';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'API परिणामों को कैश करने के लिए कितने सेकेंड्स हैं? डिफ़ॉल्ट 3600 सेकंड है (1 घंटा)।';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'जब एक API कुंजी परिभाषित किया जाता है, Google Safe Browsing (सुरक्षित ब्राउज़िंग) API तक पहुंच सक्षम बनाता है।';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'जब true(सच्चे), hpHosts API तक पहुंच सक्षम बनाता है।';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'प्रति स्कैन की अनुमति अधिकतम API खोजों की संख्या। प्रत्येक API लुकअप स्कैन को पूरा करने के लिए आवश्यक कुल समय में जोड़ देगा, इसलिए, आप समग्र स्कैन प्रक्रिया में तेजी लाने के लिए एक सीमा निर्धारित करना चाह सकते हैं। 0 पर सेट करते समय, कोई सीमा लागू नहीं होगी। डिफ़ॉल्ट रूप से 10 पर सेट करें।';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'यदि API लुकअप की अधिकतम स्वीकार्य संख्या पार कर गई है तो क्या करें? False(झूठी) = कुछ मत करो (प्रसंस्करण जारी रखें) [डिफ़ॉल्ट]; True(सच्चे) = फाइल को ब्लॉक करें।';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'वैकल्पिक रूप से, वायरस, ट्रोजन, मैलवेयर और अन्य खतरों से सुरक्षा के एक बहुत बढ़ाया स्तर प्रदान करने के तरीके के रूप में, वायरस कुल API का उपयोग करते हुए, phpMussel फाइलों को स्कैन करने में सक्षम है। डिफ़ॉल्ट रूप से, वायरस कुल API का उपयोग कर फाइल स्कैन करना अक्षम है। इसे सक्षम करने के लिए, वायरस कुल से एक API कुंजी की आवश्यकता है। महत्वपूर्ण लाभ के कारण यह आपको प्रदान कर सकता है, ऐसा कुछ है जो मैं अत्यधिक सक्षम करने की सलाह देता हूं। कृपया ध्यान रखें, कि वायरस कुल API का उपयोग करने के लिए, आपको उनकी सेवा की शर्तों से सहमत होना होगा और आपको वायरस कुल दस्तावेज के अनुसार वर्णित सभी दिशानिर्देशों का पालन करना होगा! आपको इस एकीकरण सुविधा का उपयोग करने की अनुमति नहीं है, सिवाय इसके कि: आपने वायरस कुल और इसकी API की सेवा की शर्तों को पढ़ लिया है और उससे सहमत हूं। आपने पढ़ लिया है और आप समझते हैं, कम से कम, वायरस कुल सार्वजनिक API दस्तावेजों की प्रस्तावना ("VirusTotal Public API v2.0" के बाद सब कुछ लेकिन "Contents" के पहले)।';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'वायरस कुल API दस्तावेजों के अनुसार, "यह किसी भी 1 मिनट समय सीमा में किसी भी प्रकृति की अधिकतम 4 अनुरोध तक सीमित है।" आप एक honeyclient, honeypot या न केवल VirusTotal के करने के लिए संसाधन उपलब्ध कराने के लिए जा रही है कि किसी दूसरे स्वचालन चलाते हैं रिपोर्टें आप एक उच्च आवेदन दर कोटा हकदार हैं निकालते हैं। डिफ़ॉल्ट रूप से, phpMussel सख्ती से इन सीमाओं का पालन करेंगे, लेकिन उनकी दर कोटा की संभावना में वृद्धि किया जा रहा है क्योंकि इन दो निर्देश आप क्या पालन करना चाहिए सीमित करने के रूप phpMussel निर्देशित करने के लिए एक स्रोत के रूप में प्रदान की जाती हैं। आप \ जब तक \ ऐसा करने के लिए निर्देशित किया गया है, यह है, आप उन मूल्यों में वृद्धि करने के लिए सिफारिश नहीं है, लेकिन आप \ तो \ आप दर कोटा पहुँचने से संबंधित सामना करना पड़ा समस्याओं देने घट उन मूल्यों <em><strong>शायद</strong></em> कभी कभी इन समस्याओं से निपटने में मदद करते हैं। आप दर सीमा <code>vt_quota_rate</code> किसी भी किसी भी प्रकृति अनुरोधों <code>vt_quota_time</code> पल समय सीमा के रूप में निर्धारित किया जाता है।';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(ऊपर विवरण देखें)।';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'डिफ़ॉल्ट रूप से, phpMussel जो फाइलों यह "संदिग्ध" समझता है कि इन फाइलों को वायरस कुल API का उपयोग स्कैन करता है सीमित करेंगे। आप वैकल्पिक <code>vt_suspicion_level</code> के निर्देश मान बदलकर प्रतिबंध को समायोजित कर सकते हैं।';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMussel पहचान कर के रूप में या पता लगाने भार के रूप वायरस कुल API का उपयोग स्कैनिंग परिणाम आवेदन देना चाहिए? (और दुर्भावनापूर्ण फाइलें एक बड़ी संख्या पकड़े जाने इसलिए) एकाधिक इंजन का उपयोग (जैसे वायरस कुल करता है) एक फाइल स्कैन एक वृद्धि का पता लगाने दर परिणाम चाहिए, हालांकि, यह भी झूठी अधिक संख्या में जिसके परिणामस्वरूप कर सकते हैं, क्योंकि यह नुस्खा मौजूद है, सकारात्मक है, और इस वजह से, कुछ स्थितियों में, स्कैनिंग परिणाम बेहतर एक अंतिम परिणाम पर विश्वास स्कोर के रूप में बजाय प्रयोग किया जा सकता है । 0 मान उपयोग किया जाता है, तो वायरस कुल API का उपयोग स्कैनिंग परिणाम किसी भी इंजन वायरस कुल झंडा फाइल दुर्भावनापूर्ण के रूप में स्कैन किया जा रहा है द्वारा इस्तेमाल किया जाता है तो, पहचान कर के रूप में लागू किया जाएगा, और इस वजह से, phpMussel दुर्भावनापूर्ण होने के लिए फाइल पर विचार करेंगे। किसी दूसरे का मान प्रयोग किया जाता है, तो वायरस कुल API का उपयोग स्कैनिंग परिणाम का पता लगाने भार के रूप में लागू किया जाएगा, और इस वजह से, फाइल झंडे कि वायरस कल से उपयोग इंजन की संख्या स्कैन किया जा रहा है दुर्भावनापूर्ण होने (एक विश्वास स्कोर के रूप में काम करेगा के रूप में या पता लगाने भार) के लिए है या नहीं फाइल स्कैन किया जा रहा phpMussel द्वारा दुर्भावनापूर्ण माना जाना चाहिए (इस्तेमाल किया कम से कम विश्वास का प्रतिनिधित्व करेंगे मूल्य स्कोर या क्रम में की जरूरत वजन दुर्भावनापूर्ण समझा जाए)। 0 मान डिफ़ॉल्ट द्वारा उपयोग किया जाता है।';
$phpMussel['lang']['Extended Description: phpMussel'] = 'मुख्य पैकेज (हस्ताक्षर, डॉक्यूमेंटेशन, और कॉन्फ़िगरेशन के बिना)।';
$phpMussel['lang']['field_activate'] = 'सक्रिय करें';
$phpMussel['lang']['field_clear_all'] = 'सभी साफ करें';
$phpMussel['lang']['field_component'] = 'घटक';
$phpMussel['lang']['field_create_new_account'] = 'नया खाता बनाएँ';
$phpMussel['lang']['field_deactivate'] = 'निष्क्रिय करें';
$phpMussel['lang']['field_delete_account'] = 'खाता हटाएं';
$phpMussel['lang']['field_delete_all'] = 'सभी हटा दो';
$phpMussel['lang']['field_delete_file'] = 'हटाएं';
$phpMussel['lang']['field_download_file'] = 'डाउनलोड';
$phpMussel['lang']['field_edit_file'] = 'संपादित करें';
$phpMussel['lang']['field_false'] = 'False (असत्य)';
$phpMussel['lang']['field_file'] = 'फाइल';
$phpMussel['lang']['field_filename'] = 'फाइल का नाम: ';
$phpMussel['lang']['field_filetype_directory'] = 'निर्देशिका';
$phpMussel['lang']['field_filetype_info'] = '{EXT} फाइल';
$phpMussel['lang']['field_filetype_unknown'] = 'अनजान';
$phpMussel['lang']['field_install'] = 'इंस्टॉल करें';
$phpMussel['lang']['field_latest_version'] = 'नवीनतम संस्करण';
$phpMussel['lang']['field_log_in'] = 'लॉग इन करें';
$phpMussel['lang']['field_more_fields'] = 'अधिक फ़ील्ड';
$phpMussel['lang']['field_new_name'] = 'नया नाम:';
$phpMussel['lang']['field_ok'] = 'ठीक';
$phpMussel['lang']['field_options'] = 'विकल्प';
$phpMussel['lang']['field_password'] = 'पासवर्ड';
$phpMussel['lang']['field_permissions'] = 'अनुमतियां';
$phpMussel['lang']['field_quarantine_key'] = 'संगरोध कुंजी';
$phpMussel['lang']['field_rename_file'] = 'नाम बदलें';
$phpMussel['lang']['field_reset'] = 'रीसेट';
$phpMussel['lang']['field_restore_file'] = 'पुनर्स्थापित';
$phpMussel['lang']['field_set_new_password'] = 'नया पासवर्ड बनाएं';
$phpMussel['lang']['field_size'] = 'कुल आकार: ';
$phpMussel['lang']['field_size_bytes'] = ['बाइट', 'बाइट्स'];
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'अवस्था';
$phpMussel['lang']['field_system_timezone'] = 'सिस्टम डिफ़ॉल्ट समयक्षेत्र का उपयोग करें।';
$phpMussel['lang']['field_true'] = 'True (सच)';
$phpMussel['lang']['field_uninstall'] = 'अनइंस्टॉल करें';
$phpMussel['lang']['field_update'] = 'अपडेट करो';
$phpMussel['lang']['field_update_all'] = 'सब कुछ अपडेट करें';
$phpMussel['lang']['field_upload_file'] = 'नई फाइल अपलोड करें';
$phpMussel['lang']['field_username'] = 'उपयोगकर्ता नाम';
$phpMussel['lang']['field_your_version'] = 'आपका संस्करण';
$phpMussel['lang']['header_login'] = 'जारी रखने के लिए कृपया लॉग इन करें।';
$phpMussel['lang']['label_active_config_file'] = 'सक्रिय कॉन्फ़िगरेशन फाइल: ';
$phpMussel['lang']['label_blocked'] = 'अपलोड अवरुद्ध';
$phpMussel['lang']['label_branch'] = 'शाखा नवीनतम स्थिर:';
$phpMussel['lang']['label_events'] = 'स्कैन घटनाओं';
$phpMussel['lang']['label_flagged'] = 'फ़्लैग किए गए ऑब्जेक्ट';
$phpMussel['lang']['label_fmgr_cache_data'] = 'कैश डेटा और अस्थायी फाइलें';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel डिस्क उपयोग: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'खाली डिस्क स्पेस: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'कुल डिस्क उपयोग: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'कुल डिस्क स्पेस: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'घटक अद्यतन मेटाडेटा';
$phpMussel['lang']['label_hide'] = 'छिपाना';
$phpMussel['lang']['label_os'] = 'ऑपरेटिंग सिस्टम का इस्तेमाल किया:';
$phpMussel['lang']['label_other'] = 'अन्य';
$phpMussel['lang']['label_other-Active'] = 'सक्रिय हस्ताक्षर फाइलें';
$phpMussel['lang']['label_other-Since'] = 'आरंभ करने की तिथि';
$phpMussel['lang']['label_php'] = 'PHP संस्करण का इस्तेमाल किया:';
$phpMussel['lang']['label_phpmussel'] = 'phpMussel संस्करण का इस्तेमाल किया:';
$phpMussel['lang']['label_quarantined'] = 'क्वारंटाइन किए गए अपलोड';
$phpMussel['lang']['label_sapi'] = 'SAPI का इस्तेमाल किया:';
$phpMussel['lang']['label_scanned_objects'] = 'स्कैन किए गए ऑब्जेक्ट';
$phpMussel['lang']['label_scanned_uploads'] = 'स्कैन किए गए अपलोड';
$phpMussel['lang']['label_show'] = 'दिखाना';
$phpMussel['lang']['label_size_in_quarantine'] = 'संगरोध में आकार: ';
$phpMussel['lang']['label_stable'] = 'नवीनतम स्थिर:';
$phpMussel['lang']['label_sysinfo'] = 'प्रणाली की जानकारी:';
$phpMussel['lang']['label_tests'] = 'परीक्षण:';
$phpMussel['lang']['label_unstable'] = 'नवीनतम अस्थिर:';
$phpMussel['lang']['label_upload_date'] = 'अपलोड की तारीख: ';
$phpMussel['lang']['label_upload_hash'] = 'अपलोड का हैश: ';
$phpMussel['lang']['label_upload_origin'] = 'अपलोड की उत्पत्ति: ';
$phpMussel['lang']['label_upload_size'] = 'अपलोड का आकार: ';
$phpMussel['lang']['link_accounts'] = 'खातों';
$phpMussel['lang']['link_config'] = 'कॉन्फ़िगरेशन';
$phpMussel['lang']['link_documentation'] = 'डॉक्यूमेंटेशन';
$phpMussel['lang']['link_file_manager'] = 'फाइल प्रबंधक';
$phpMussel['lang']['link_home'] = 'होमपेज';
$phpMussel['lang']['link_logs'] = 'लॉग फाइलें';
$phpMussel['lang']['link_quarantine'] = 'संगरोध';
$phpMussel['lang']['link_statistics'] = 'सांख्यिकी';
$phpMussel['lang']['link_textmode'] = 'पाठ स्वरूपण: <a href="%1$sfalse">बुनियादी</a> – <a href="%1$strue">स्वरूपित</a>';
$phpMussel['lang']['link_updates'] = 'अपडेट';
$phpMussel['lang']['link_upload_test'] = 'अपलोड टेस्ट';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'चयनित लॉग फाइल मौजूद नहीं है!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'कोई लॉग फाइल उपलब्ध नहीं।';
$phpMussel['lang']['logs_no_logfile_selected'] = 'कोई लॉग फाइल चयनित नहीं।';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'लॉगिन प्रयासों की अधिकतम संख्या पार हो गई; पहुंच अस्वीकृत।';
$phpMussel['lang']['previewer_days'] = 'दिन';
$phpMussel['lang']['previewer_hours'] = 'घंटे';
$phpMussel['lang']['previewer_minutes'] = 'मिनट';
$phpMussel['lang']['previewer_months'] = 'महीने';
$phpMussel['lang']['previewer_seconds'] = 'सेकंड';
$phpMussel['lang']['previewer_weeks'] = 'सप्ताह';
$phpMussel['lang']['previewer_years'] = 'वर्षों';
$phpMussel['lang']['response_accounts_already_exists'] = 'उस उपयोगकर्ता नाम के साथ एक खाता पहले से मौजूद है!';
$phpMussel['lang']['response_accounts_created'] = 'खाता सफलतापूर्वक बनाया गया!';
$phpMussel['lang']['response_accounts_deleted'] = 'खाता सफलतापूर्वक हटाया गया!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'वह खाता मौजूद नहीं है।';
$phpMussel['lang']['response_accounts_password_updated'] = 'पासवर्ड सफलतापूर्वक अपडेट किया गया!';
$phpMussel['lang']['response_activated'] = 'सफलतापूर्वक सक्रियण।';
$phpMussel['lang']['response_activation_failed'] = 'सक्रिय करने में विफल!';
$phpMussel['lang']['response_checksum_error'] = 'कुछ त्रुटियों की जांच करें! फाइल अस्वीकृत!';
$phpMussel['lang']['response_component_successfully_installed'] = 'घटक सफलतापूर्वक इंस्टॉल किया गया।';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'घटक सफलतापूर्वक अनइंस्टॉल किया गया।';
$phpMussel['lang']['response_component_successfully_updated'] = 'घटक सफलतापूर्वक अपडेट किया गया';
$phpMussel['lang']['response_component_uninstall_error'] = 'घटक को अनइंस्टॉल करते समय त्रुटि।';
$phpMussel['lang']['response_configuration_updated'] = 'कॉन्फ़िगरेशन सफलतापूर्वक अपडेट किया गया।';
$phpMussel['lang']['response_deactivated'] = 'सफलतापूर्वक निष्क्रिय।';
$phpMussel['lang']['response_deactivation_failed'] = 'निष्क्रिय करने में विफल!';
$phpMussel['lang']['response_delete_error'] = 'हटाने में विफल!';
$phpMussel['lang']['response_directory_deleted'] = 'निर्देशिका को सफलतापूर्वक हटाया गया!';
$phpMussel['lang']['response_directory_renamed'] = 'निर्देशिका को सफलतापूर्वक नाम दिया गया!';
$phpMussel['lang']['response_error'] = 'त्रुटि';
$phpMussel['lang']['response_failed_to_install'] = 'इनस्टॉल करने में विफल!';
$phpMussel['lang']['response_failed_to_update'] = 'अपडेट करने में विफल!';
$phpMussel['lang']['response_file_deleted'] = 'सफलतापूर्वक फाइल हटाया गया!';
$phpMussel['lang']['response_file_edited'] = 'सफलतापूर्वक फाइल संशोधित किया गया!';
$phpMussel['lang']['response_file_renamed'] = 'सफलतापूर्वक फाइल नाम दिया गया!';
$phpMussel['lang']['response_file_restored'] = 'फाइल को सफलतापूर्वक पुनर्स्थापित किया गया!';
$phpMussel['lang']['response_file_uploaded'] = 'सफलतापूर्वक फाइल अपलोड की गई!';
$phpMussel['lang']['response_login_invalid_password'] = 'लॉगिन विफलता! अवैध पासवर्ड!';
$phpMussel['lang']['response_login_invalid_username'] = 'लॉगिन विफलता! उपयोगकर्ता नाम मौजूद नहीं!';
$phpMussel['lang']['response_login_password_field_empty'] = 'पासवर्ड फ़ील्ड खाली है!';
$phpMussel['lang']['response_login_username_field_empty'] = 'उपयोगकर्ता नाम फ़ील्ड खाली!';
$phpMussel['lang']['response_rename_error'] = 'नाम बदलने में विफल!';
$phpMussel['lang']['response_restore_error_1'] = 'पुनर्स्थापित करने में विफल! दूषित फाइल!';
$phpMussel['lang']['response_restore_error_2'] = 'पुनर्स्थापित करने में विफल! गलत संगरोध कुंजी!';
$phpMussel['lang']['response_statistics_cleared'] = 'सांख्यिकी साफ है।';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'पहले से ही आधुनिक।';
$phpMussel['lang']['response_updates_not_installed'] = 'घटक इंस्टॉल नहीं है!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'घटक इंस्टॉल नहीं है (PHP {V} की आवश्यकता है)!';
$phpMussel['lang']['response_updates_outdated'] = 'पदावनत!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'पदावनत (कृपया मैन्युअल अपडेट करें)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'पदावनत (PHP {V} की आवश्यकता है)!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'निर्धारित करने में असमर्थ।';
$phpMussel['lang']['response_upload_error'] = 'अपलोड करने में विफल!';
$phpMussel['lang']['state_complete_access'] = 'पूरा पहुंच';
$phpMussel['lang']['state_component_is_active'] = 'घटक सक्रिय है।';
$phpMussel['lang']['state_component_is_inactive'] = 'घटक निष्क्रिय है।';
$phpMussel['lang']['state_component_is_provisional'] = 'घटक अस्थायी है।';
$phpMussel['lang']['state_default_password'] = 'चेतावनी: डिफ़ॉल्ट पासवर्ड का उपयोग करना!';
$phpMussel['lang']['state_logged_in'] = 'लॉग इन किया है।';
$phpMussel['lang']['state_logs_access_only'] = 'लॉग फाइल का उपयोग केवल';
$phpMussel['lang']['state_maintenance_mode'] = 'चेतावनी: रखरखाव मोड सक्षम है!';
$phpMussel['lang']['state_password_not_valid'] = 'चेतावनी: यह खाता किसी मान्य पासवर्ड का उपयोग नहीं कर रहा है!';
$phpMussel['lang']['state_quarantine'] = ['वर्तमान में संगरोध में %s फाइल है।', 'वर्तमान में संगरोध में %s फाइलें हैं।'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'गैर पदावनत को छुपाएं न करें';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'गैर पदावनत को छिपाना';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'अप्रयुक्त को छुपाएं न करें';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'अप्रयुक्त को छिपाना';
$phpMussel['lang']['tip_accounts'] = 'हैलो, {username}।<br />खाता पृष्ठ आपको यह नियंत्रित करने की अनुमति देता है कि कौन phpMussel सामने के अंत तक पहुंच सकता है।';
$phpMussel['lang']['tip_config'] = 'हैलो, {username}।<br />कॉन्फ़िगरेशन पेज आपको सामने के अंत से phpMussel के लिए कॉन्फ़िगरेशन को संशोधित करने की अनुमति देता है।';
$phpMussel['lang']['tip_donate'] = 'phpMussel मुफ्त पेशकश की जाती है, लेकिन अगर आप इस परियोजना के लिए दान करना चाहते हैं, आप दान बटन पर क्लिक करके ऐसा कर सकते हैं।';
$phpMussel['lang']['tip_file_manager'] = 'हैलो, {username}।<br />फाइल प्रबंधक आपको फाइलों को हटाने, संपादित करने, अपलोड करने और डाउनलोड करने की अनुमति देता है। सावधानी से प्रयोग करें (आप इस के साथ अपनी इंस्टॉल को तोड़ सकते हैं)।';
$phpMussel['lang']['tip_home'] = 'हैलो, {username}।<br />यह phpMussel सामने के अंत के होमपेज है। जारी रखने के लिए बाईं ओर नेविगेशन मेनू से एक लिंक का चयन करें।';
$phpMussel['lang']['tip_login'] = 'डिफ़ॉल्ट उपयोगकर्ता नाम: <span class="txtRd">admin</span> – डिफ़ॉल्ट पासवर्ड: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'हैलो, {username}।<br />इसकी सामग्री देखने के लिए नीचे दी गई सूची से एक लॉग फाइल चुनें।';
$phpMussel['lang']['tip_quarantine'] = 'हैलो, {username}।<br />यह पृष्ठ वर्तमान में संगरोध में सभी फाइलों को सूचीबद्ध करता है और उन फाइलों के प्रबंधन की सुविधा देता है।';
$phpMussel['lang']['tip_quarantine_disabled'] = 'नोट: संगरोध वर्तमान में अक्षम है, लेकिन कॉन्फ़िगरेशन पृष्ठ के माध्यम से सक्षम किया जा सकता है।';
$phpMussel['lang']['tip_see_the_documentation'] = 'विभिन्न विन्यास निर्देशों और उनके उद्देश्यों के बारे में जानकारी के लिए <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION7">डॉक्यूमेंटेशन</a> देखें।';
$phpMussel['lang']['tip_statistics'] = 'हैलो, {username}।<br />यह पृष्ठ आपके phpMussel स्थापना के बारे में कुछ बुनियादी उपयोग सांख्यिकी दिखाता है।';
$phpMussel['lang']['tip_statistics_disabled'] = 'नोट: सांख्यिकी ट्रैकिंग वर्तमान में अक्षम है, लेकिन कॉन्फ़िगरेशन पृष्ठ के माध्यम से सक्षम किया जा।';
$phpMussel['lang']['tip_updates'] = 'हैलो, {username}।<br />अपडेट पेज आपको phpMussel के विभिन्न घटकों को इंस्टॉल, अनइंस्टॉल और अद्यतन करने की अनुमति देता है (मुख्य पैकेज, हस्ताक्षर, स्थानीयकरण फाइलें, आदि)।';
$phpMussel['lang']['tip_upload_test'] = 'हैलो, {username}।<br />अपलोड टेस्ट पृष्ठ में एक मानक फाइल अपलोड फॉर्म है। यह आपको यह जांचने में सक्षम बनाता है कि फाइल को सामान्य रूप से इसे अपलोड करने का प्रयास करते समय phpMussel द्वारा अवरुद्ध किया जाएगा या नहीं।';
$phpMussel['lang']['title_accounts'] = 'phpMussel – खातों';
$phpMussel['lang']['title_config'] = 'phpMussel – कॉन्फ़िगरेशन';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – फाइल प्रबंधक';
$phpMussel['lang']['title_home'] = 'phpMussel – होमपेज';
$phpMussel['lang']['title_login'] = 'phpMussel – लॉग इन करें';
$phpMussel['lang']['title_logs'] = 'phpMussel – लॉग फाइलें';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – संगरोध';
$phpMussel['lang']['title_statistics'] = 'phpMussel – सांख्यिकी';
$phpMussel['lang']['title_updates'] = 'phpMussel – अपडेट';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – अपलोड टेस्ट';
$phpMussel['lang']['warning'] = 'चेतावनी:';
$phpMussel['lang']['warning_php_1'] = 'आपका PHP संस्करण सक्रिय रूप से अब समर्थित नहीं है! अद्यतन की सिफारिश की है!';
$phpMussel['lang']['warning_php_2'] = 'आपका PHP संस्करण गंभीर रूप से कमजोर है! अद्यतन की जोरदार सिफारिश की है!';
$phpMussel['lang']['warning_signatures_1'] = 'कोई हस्ताक्षर फाइलें सक्रिय नहीं हैं!';

$phpMussel['lang']['info_some_useful_links'] = 'कुछ उपयोगी लिंक:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel के समस्याएं @ GitHub</a> – phpMussel के लिए समस्याएं पृष्ठ (सहायता के लिए, आदि)।</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – phpMussel के लिए चर्चा मंच (सहायता के लिए, आदि)।</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – phpMussel के लिए वैकल्पिक डाउनलोड आईना।</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – वेबसाइटों को सुरक्षित करने के लिए सरल वेबमास्टर उपकरण का एक संग्रह।</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV (क्लैमएव) होमपेज (ClamAV® ट्रोजन, वायरस, मैलवेयर और अन्य दुर्भावनापूर्ण खतरों का पता लगाने के लिए एक खुला स्रोत एंटीवायरस इंजन है)।</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – कम्प्यूटर सुरक्षा कंपनी जो ClamAV (क्लैमएव) के लिए अनुपूरक हस्ताक्षर प्रदान करती है।</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – phpMussel यूआरएल स्कैनर द्वारा उपयोग किए गए फ़िशिंग डेटाबेस।</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">वैश्विक PHP समूह @ Facebook</a> – PHP सीखने संसाधन और चर्चा।</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP सीखने संसाधन और चर्चा।</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal संदिग्ध फाइलें और URL का विश्लेषण करने के लिए एक नि: शुल्क सेवा है।</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis <a href="http://www.payload-security.com/">Payload Security</a> द्वारा प्रदान की जाने वाली एक मुफ्त मैलवेयर विश्लेषण सेवा है।</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – कंप्यूटर एंटी-मैलवेयर विशेषज्ञ।</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – उपयोगी मैलवेयर केंद्रित चर्चा मंच।</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Vulnerability Charts (भेद्यता चार्ट)</a> – विभिन्न पैकेजों के सुरक्षित/असुरक्षित संस्करणों की सूची (PHP, HHVM, आदि)।</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Compatibility Charts (संगतता चार्ट)</a> – विभिन्न पैकेजों के लिए सुसंगतता सूचियों की सूची (CIDRAM, phpMussel, आदि)।</li>
        </ul>';
