<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Arabic language data (last modified: 2016.10.15).
 *
 * @todo Incomplete.
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['textDir'] = 'rtl';
$phpMussel['lang']['bad_command'] = 'أنا لا أفهم هذا الأمر، آسف.';
$phpMussel['lang']['cli_failed_to_complete'] = 'فشل في إكمال عملية المسح.';
$phpMussel['lang']['cli_is_not_a'] = ' ليس ملف أو مجلد.';
$phpMussel['lang']['cli_ln2'] = " شكراً لك على إستخدام phpMussel، المبرمج بلغة PHP للكشف عن ملفات الإختراق\n والفيروسات والبرمجيات الخبيثة الموجودة حيث يعتمد السكربت على\n توقيعات ClamAV وغيرها.\n\n حقوق النشر محفوظة ل PHPMUSSEL لعام 2013 وما بعده تحت رخصة\n GNU/GPLv2 للمبرمج (Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " حاليا على تنفيذ phpMussel في وضع CLI (واجهة سطر الأوامر).\n\n لمسح ملف أو دليل، اكتب 'scan'، ثم اسم ملف أو دليل الذي تريد phpMussel إلى لمسح\n واضغط Enter؛ اكتب 'c' واضغط Enter للحصول على قائمة أوامر وضع CLI؛\n اكتب 'q' واضغط Enter للخروج:";
$phpMussel['lang']['cli_pe1'] = 'ليس ملف PE صالح!';
$phpMussel['lang']['cli_pe2'] = 'أقسام PE:';
$phpMussel['lang']['cli_working'] = 'في تَقَدم';
$phpMussel['lang']['corrupted'] = 'الكشف PE تلف';
$phpMussel['lang']['denied'] = 'رفض تحميل!';
$phpMussel['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Subida Denegada! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['lang']['denied_reason'] = 'تم حجب التحميل للأسباب الواردة أدناه:';
$phpMussel['lang']['detected'] = 'الكشف {vn}';
$phpMussel['lang']['detected_control_characters'] = 'الكشف أحرف التحكم';
$phpMussel['lang']['encrypted_archive'] = 'كشف أرشيف المشفرة؛ أرشيف المشفرة غير مسموح';
$phpMussel['lang']['failed_to_access'] = 'فشل الوصول إلى ';
$phpMussel['lang']['file'] = 'ملف';
$phpMussel['lang']['filesize_limit_exceeded'] = 'تجاوز حد حجم ملف';
$phpMussel['lang']['filetype_blacklisted'] = 'نوع الملف في القائمة السوداء';
$phpMussel['lang']['finished'] = 'انتهى';
$phpMussel['lang']['generated_by'] = 'الناتج';
$phpMussel['lang']['greylist_cleared'] = ' قائمة رمادية أفرغت.';
$phpMussel['lang']['greylist_not_updated'] = ' قائمة رمادية لم تحديثها.';
$phpMussel['lang']['greylist_updated'] = ' قائمة رمادية تحديثها.';
$phpMussel['lang']['image'] = 'صورة';
$phpMussel['lang']['instance_already_active'] = 'Instance already active! Please double-check your hooks.';
$phpMussel['lang']['invalid_file'] = 'ملف غير صالح';
$phpMussel['lang']['invalid_url'] = 'URL غير صالح!';
$phpMussel['lang']['ok'] = 'حسنا';
$phpMussel['lang']['only_allow_images'] = 'Uploading files other than images isn\'t permitted';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Plugins directory doesn\'t exist!';
$phpMussel['lang']['quarantined_as'] = "الحجر الصحي بأنه \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursion depth limit exceeded';
$phpMussel['lang']['required_variables_not_defined'] = 'Required variables aren\'t defined: لا يمكن أن يستمر.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'يحتمل أن تكون ضارة URL الكشف';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API خطأ طلب';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API خطأ ترخيص';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API الخدمة غير متوفرة';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'خطأ API غير معروف';
$phpMussel['lang']['scan_aborted'] = 'Scanning aborted!';
$phpMussel['lang']['scan_chameleon'] = '{x} chameleon attack detected';
$phpMussel['lang']['scan_checking'] = 'فحص';
$phpMussel['lang']['scan_checking_contents'] = 'Success! Proceeding إلى check contents.';
$phpMussel['lang']['scan_command_injection'] = 'Command injection attempt detected';
$phpMussel['lang']['scan_complete'] = 'تم الانتهاء من';
$phpMussel['lang']['scan_extensions_missing'] = 'فشل (missing required extensions)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Filename manipulation detected';
$phpMussel['lang']['scan_map_corrupted'] = 'Signature map corrupted';
$phpMussel['lang']['scan_map_missing'] = 'Signature map missing';
$phpMussel['lang']['scan_missing_filename'] = 'Missing filename';
$phpMussel['lang']['scan_not_archive'] = 'فشل (فارغة أو ليس أرشيفا)!';
$phpMussel['lang']['scan_no_problems_found'] = 'No problems found.';
$phpMussel['lang']['scan_reading'] = 'قراءة';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Signature file corrupted';
$phpMussel['lang']['scan_signature_file_missing'] = 'Signature file missing';
$phpMussel['lang']['scan_tampering'] = 'Detected potentially dangerous file tampering';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Unauthorised file upload manipulation detected';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Unauthorised file upload manipulation or misconfiguration detected! ';
$phpMussel['lang']['started'] = 'بدأت';
$phpMussel['lang']['too_many_urls'] = 'عدد كبير جدا من عناوين المواقع';
$phpMussel['lang']['upload_error_1'] = 'Filesize exceeds the upload_max_filesize directive. ';
$phpMussel['lang']['upload_error_2'] = 'Filesize exceeds form-specified filesize limit. ';
$phpMussel['lang']['upload_error_34'] = 'Upload failure! Please contact the hostmaster for assistance! ';
$phpMussel['lang']['upload_error_6'] = 'Upload directory missing! Please contact the hostmaster for assistance! ';
$phpMussel['lang']['upload_error_7'] = 'Disc-write error! Please contact the hostmaster for assistance! ';
$phpMussel['lang']['upload_error_8'] = 'PHP misconfiguration detected! Please contact the hostmaster for assistance! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Upload limit exceeded';
$phpMussel['lang']['wrong_password'] = 'كلمة مرور خاطئة؛ رفض العمل.';
$phpMussel['lang']['x_does_not_exist'] = 'غير موجود';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - CLI للخروج.
 - البديل: quit, exit.
 md5_file
 - خلق التوقيعات MD5 من ملفات [بناء الجملة: md5_file اسم الملف].
 - البديل: m.
 md5
 - خلق التوقيعات MD5 من النص [بناء الجملة: md5 نص].
 hex_encode
 - تحول النص ثنائي إلى سداسي عشري [بناء الجملة: hex_encode نص].
 - البديل: x.
 hex_decode
 - تحول سداسي عشري إلى النص ثنائي [بناء الجملة: hex_decode نص].
 base64_encode
 - تحول النص ثنائي إلى نص base64 [بناء الجملة: base64_encode نص].
 - البديل: b.
 base64_decode
 - تحول نص base64 إلى النص ثنائي [بناء الجملة: base64_decode نص].
 scan
 - تفحص ملف أو دليل [بناء الجملة: scan اسم الملف].
 - البديل: s.
 c
 - طباعة هذه القائمة الأوامر.
";
