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
 * This file: Hindi language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'मुझे यह आज्ञा नहीं समझती, खेद है।';
$phpMussel['lang']['cli_failed_to_complete'] = 'स्कैनिंग प्रक्रिया को पूरा करने में विफल';
$phpMussel['lang']['cli_is_not_a'] = ' एक फाइल या निर्देशिका नहीं है।';
$phpMussel['lang']['cli_ln2'] = " phpMussel का उपयोग करने के लिए धन्यवाद। phpMussel एक PHP स्क्रिप्ट है जो\n ट्रॉजन, वायरस, मैलवेयर और आपके सिस्टम पर अपलोड की गई फाइलों के भीतर अन्य खतरों\n का पता लगाने के लिए डिज़ाइन की गई है, जहां स्क्रिप्ट का आच्छादित है। यह ClamAV\n और अन्य के हस्ताक्षर पर आधारित है।\n\n PHPMUSSEL कॉपीराइट 2013 और उससे आगे GNU/GPLv2, Caleb M (Maikuolan) द्वारा।\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " वर्तमान में सीएलआई मोड (कमांड लाइन इंटरफेस) में phpMussel चल रहा है।\n\n किसी फाइल या निर्देशिका को स्कैन करने के लिए, scan टाइप करें, फाइल या\n निर्देशिका के नाम के बाद, जिसे आप phpMussel को स्कैन करने के लिए चाहते हैं और\n Enter दबाएं; CLI मोड आदेशों की सूची के लिए c टाइप करें और Enter दबाएं; q टाइप\n करें और छोड़ने के लिए Enter दबाएं:";
$phpMussel['lang']['cli_pe1'] = 'वैध PE फाइल नहीं है!';
$phpMussel['lang']['cli_pe2'] = 'PE अनुभाग:';
$phpMussel['lang']['cli_signature_placeholder'] = 'आपका-हस्ताक्षर-नाम';
$phpMussel['lang']['cli_working'] = 'चालू';
$phpMussel['lang']['corrupted'] = 'भ्रष्ट PE का पता चला';
$phpMussel['lang']['data_not_available'] = 'डेटा उपलब्ध नहीं।';
$phpMussel['lang']['denied'] = 'अपलोड अस्वीकृत!';
$phpMussel['lang']['denied_reason'] = 'आपके अपलोड को नीचे सूचीबद्ध कारणों के कारण अवरुद्ध किया गया था:';
$phpMussel['lang']['detected'] = '{vn} का पता चला';
$phpMussel['lang']['detected_control_characters'] = 'पता चला नियंत्रण अक्षर';
$phpMussel['lang']['encrypted_archive'] = 'पता चला एन्क्रिप्टेड संग्रह; एन्क्रिप्ट किए गए अभिलेखागार की अनुमति नहीं है';
$phpMussel['lang']['failed_to_access'] = 'तक पहुंचने में विफल ';
$phpMussel['lang']['file'] = 'फाइल';
$phpMussel['lang']['filesize_limit_exceeded'] = 'फाइल आकार सीमा पार हो गई';
$phpMussel['lang']['filetype_blacklisted'] = 'काली सूची पर फाइल प्रकार';
$phpMussel['lang']['finished'] = 'ख़त्म होना';
$phpMussel['lang']['generated_by'] = 'जनरेटर';
$phpMussel['lang']['greylist_cleared'] = ' धूसर सूची खाली कर दी गई।';
$phpMussel['lang']['greylist_not_updated'] = ' धूसर सूची अपडेट नहीं हुआ।';
$phpMussel['lang']['greylist_updated'] = ' धूसर सूची अपडेट किया गया।';
$phpMussel['lang']['image'] = 'छवि';
$phpMussel['lang']['instance_already_active'] = 'उदाहरण पहले से ही सक्रिय है! कृपया अपने हुक दो बार जांचें।';
$phpMussel['lang']['invalid_data'] = 'अमान्य डेटा!';
$phpMussel['lang']['invalid_file'] = 'अवैध फाइल';
$phpMussel['lang']['invalid_url'] = 'अवैध URL!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'छवियों के अलावा अन्य फाइल अपलोड करने की अनुमति नहीं है';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'प्लगइन्स निर्देशिका मौजूद नहीं है!';
$phpMussel['lang']['quarantined_as'] = "\"/vault/quarantine/{QFU}.qfu\" के रूप में क्वारंटाइन।\n";
$phpMussel['lang']['recursive'] = 'पुनरावर्ती गहराई सीमा पार हो गई';
$phpMussel['lang']['required_variables_not_defined'] = 'आवश्यक चर परिभाषित नहीं हैं: जारी नहीं कर सकते।';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'संभावित हानिकारक URL का पता चला';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API अनुरोध त्रुटि';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API प्राधिकरण त्रुटि';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API सेवा उप्लब्ध् नहीं है';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'अज्ञात API त्रुटि';
$phpMussel['lang']['scan_aborted'] = 'स्कैनिंग निरस्त कर दी गई!';
$phpMussel['lang']['scan_chameleon'] = '{x} गिरगिट के हमले का पता चला';
$phpMussel['lang']['scan_checking'] = 'जाँच हो रही है';
$phpMussel['lang']['scan_checking_contents'] = 'सफलता! सामग्री की जांच अब।';
$phpMussel['lang']['scan_command_injection'] = 'कमान इंजेक्शन प्रयास का पता चला';
$phpMussel['lang']['scan_complete'] = 'पूर्ण';
$phpMussel['lang']['scan_extensions_missing'] = 'अनुत्तीर्ण होना (आवश्यक एक्सटेंशन लापता)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'फाइलनाम हेरफेर का पता चला';
$phpMussel['lang']['scan_missing_filename'] = 'गुम फाइल नाम';
$phpMussel['lang']['scan_not_archive'] = 'अनुत्तीर्ण होना (खाली या नहीं एक संग्रह)!';
$phpMussel['lang']['scan_no_problems_found'] = 'कोई समस्या नहीं मिली।';
$phpMussel['lang']['scan_reading'] = 'पढ़ना';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'हस्ताक्षर फाइल दूषित';
$phpMussel['lang']['scan_signature_file_missing'] = 'हस्ताक्षर फाइल लापता है';
$phpMussel['lang']['scan_tampering'] = 'संभावित खतरनाक फाइल छेड़छाड़ की गई';
$phpMussel['lang']['scan_unauthorised_upload'] = 'अनधिकृत फाइल अपलोड मैनिपुलेशन का पता लगाया';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'अनधिकृत फाइल अपलोड हेरफेर या गलत कॉन्फ़िगरेशन का पता चला! ';
$phpMussel['lang']['started'] = 'शुरू कर दिया है';
$phpMussel['lang']['too_many_urls'] = 'बहुत सारे URL';
$phpMussel['lang']['upload_error_1'] = 'फाइल का आकार upload_max_file आकार निर्देशन से अधिक है। ';
$phpMussel['lang']['upload_error_2'] = 'फाइल का आकार फॉर्म-निर्दिष्ट फाइल आकार सीमा से अधिक है। ';
$phpMussel['lang']['upload_error_34'] = 'विफलता अपलोड करें! कृपया सहायता के लिए होस्टमास्टर से संपर्क करें! ';
$phpMussel['lang']['upload_error_6'] = 'अपलोड निर्देशिका गायब है! कृपया सहायता के लिए होस्टमास्टर से संपर्क करें! ';
$phpMussel['lang']['upload_error_7'] = 'डिस्क-लेखन त्रुटि! कृपया सहायता के लिए होस्टमास्टर से संपर्क करें! ';
$phpMussel['lang']['upload_error_8'] = 'PHP गलत कॉन्फ़िगरेशन का पता चला! कृपया सहायता के लिए होस्टमास्टर से संपर्क करें! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'अपलोड की सीमा पार हो गई';
$phpMussel['lang']['wrong_password'] = 'गलत पासवर्ड; कार्रवाई से इनकार किया।';
$phpMussel['lang']['x_does_not_exist'] = 'अस्तित्व में नहीं है';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '। ';
$phpMussel['lang']['_fullstop_final'] = '।';

$phpMussel['lang']['cli_commands'] = " q
 - CLI से बाहर निकलें।
 - उपनाम: quit, exit।
 md5_file
 - फाइलों से MD5 हस्ताक्षर उत्पन्न करें [सिंटेक्स: md5_file फाइल-का-नाम]।
 - उपनाम: m।
 sha1_file
 - फाइलों से SHA1 हस्ताक्षर उत्पन्न करें [सिंटेक्स: sha1_file फाइल-का-नाम]।
 md5
 - स्ट्रिंग से MD5 हस्ताक्षर उत्पन्न करें [सिंटेक्स: md5 स्ट्रिंग]।
 sha1
 - स्ट्रिंग से SHA1 हस्ताक्षर उत्पन्न करें [सिंटेक्स: sha1 स्ट्रिंग]।
 hex_encode
 - बाइनरी स्ट्रिंग को हेक्साडेसिमल में कनवर्ट करें [सिंटेक्स: hex_encode स्ट्रिंग]।
 - उपनाम: x।
 hex_decode
 - हेक्साडेसिमल को द्विआधारी स्ट्रिंग में कनवर्ट करें [सिंटेक्स: hex_decode स्ट्रिंग]।
 base64_encode
 - बाइनरी स्ट्रिंग को बेस 64 स्ट्रिंग में कनवर्ट करें [सिंटेक्स: base64_encode स्ट्रिंग]।
 - उपनाम: b।
 base64_decode
 - बेस 64 स्ट्रिंग को द्विआधारी स्ट्रिंग में कनवर्ट करें [सिंटेक्स: base64_decode स्ट्रिंग]।
 pe_meta
 - PE फाइल से मेटाडेटा लाएं [सिंटेक्स: pe_meta फाइल-का-नाम].
 url_sig
 - URL स्कैनर हस्ताक्षर जेनरेट करें [सिंटेक्स: url_sig स्ट्रिंग].
 scan
 - फाइल या निर्देशिका स्कैन करें [सिंटेक्स: scan फाइल-का-नाम]।
 - उपनाम: s।
 c
 - यह कमांड सूची प्रिंट करें।
";
