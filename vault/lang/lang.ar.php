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
 * This file: Arabic language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Language text direction (RTL). */
$phpMussel['lang']['textDir'] = 'rtl';

$phpMussel['lang']['bad_command'] = 'أنا لا أفهم هذا الأمر، آسف.';
$phpMussel['lang']['cli_failed_to_complete'] = 'فشل في إكمال عملية المسح.';
$phpMussel['lang']['cli_is_not_a'] = ' ليس ملف أو مجلد.';
$phpMussel['lang']['cli_ln2'] = " شكراً لك على إستخدام phpMussel، المبرمج بلغة PHP للكشف عن ملفات الإختراق\n والفيروسات والبرمجيات الخبيثة الموجودة حيث يعتمد السكربت على\n توقيعات ClamAV وغيرها.\n\n حقوق النشر محفوظة ل PHPMUSSEL لعام 2013 وما بعده تحت رخصة\n GNU/GPLv2 للمبرمج (Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " حاليا على تنفيذ phpMussel في وضع CLI (واجهة سطر الأوامر).\n\n لمسح ملف أو دليل، اكتب 'scan'، ثم اسم ملف أو دليل الذي تريد phpMussel إلى لمسح\n واضغط Enter؛ اكتب 'c' واضغط Enter للحصول على قائمة أوامر وضع CLI؛\n اكتب 'q' واضغط Enter للخروج:";
$phpMussel['lang']['cli_pe1'] = 'ليس ملف PE صالح!';
$phpMussel['lang']['cli_pe2'] = 'أقسام PE:';
$phpMussel['lang']['cli_signature_placeholder'] = 'اسم';
$phpMussel['lang']['cli_working'] = 'في تَقَدم';
$phpMussel['lang']['corrupted'] = 'الكشف PE تلف';
$phpMussel['lang']['data_not_available'] = 'البيانات غير متوفرة.';
$phpMussel['lang']['denied'] = 'رفض تحميل!';
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
$phpMussel['lang']['instance_already_active'] = 'نشطة بالفعل! يرجى إعادة الفحص اليشمل.';
$phpMussel['lang']['invalid_data'] = 'بيانات غير صالحة!';
$phpMussel['lang']['invalid_file'] = 'ملف غير صالح';
$phpMussel['lang']['invalid_url'] = 'URL غير صالح!';
$phpMussel['lang']['ok'] = 'حسنا';
$phpMussel['lang']['only_allow_images'] = 'تحميل ملفات غير صورة غير مسموح';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'مجلد الإضافات لا وجود!';
$phpMussel['lang']['quarantined_as'] = "الحجر الصحي بأنه \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'تجاوزت الحد عمق العودية';
$phpMussel['lang']['required_variables_not_defined'] = 'المتغيرات المطلوبة لم يتم تعريف: لا يمكن أن يستمر.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'يحتمل أن تكون ضارة URL الكشف';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API خطأ طلب';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API خطأ ترخيص';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API الخدمة غير متوفرة';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'خطأ API غير معروف';
$phpMussel['lang']['scan_aborted'] = 'مسح تم الالغاء!';
$phpMussel['lang']['scan_chameleon'] = 'الكشف هجوم الحرباء {x}';
$phpMussel['lang']['scan_checking'] = 'فحص';
$phpMussel['lang']['scan_checking_contents'] = 'نجاح! فحص محتويات الآن.';
$phpMussel['lang']['scan_command_injection'] = 'الكشف محاولة حقن القيادة';
$phpMussel['lang']['scan_complete'] = 'تم الانتهاء من';
$phpMussel['lang']['scan_extensions_missing'] = 'فشل (مفقود ملحقات المطلوبة)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'الكشف تلاعب اسم الملف';
$phpMussel['lang']['scan_missing_filename'] = 'مفقود اسم الملف';
$phpMussel['lang']['scan_not_archive'] = 'فشل (فارغة أو ليس أرشيفا)!';
$phpMussel['lang']['scan_no_problems_found'] = 'الكشف لا مشاكل.';
$phpMussel['lang']['scan_reading'] = 'قراءة';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'تلف ملف التوقيع';
$phpMussel['lang']['scan_signature_file_missing'] = 'مفقود ملف التوقيع';
$phpMussel['lang']['scan_tampering'] = 'الكشف العبث ملف يحتمل أن تكون خطرة';
$phpMussel['lang']['scan_unauthorised_upload'] = 'الكشف تلاعب تحميل الملف غير مصرح';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'تلاعب تحميل الملف غير مصرح أو تكوين الخطأ الكشف! ';
$phpMussel['lang']['started'] = 'بدأت';
$phpMussel['lang']['too_many_urls'] = 'عدد كبير جدا من عناوين المواقع';
$phpMussel['lang']['upload_error_1'] = 'حجم الملف تجاوز توجيهات upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'حجم الملف تجاوز الحد حجم الملف التي يحددها شكل. ';
$phpMussel['lang']['upload_error_34'] = 'إخفاق تحميل! يرجى الاتصال على المشرف الخادم للحصول على المساعدة! ';
$phpMussel['lang']['upload_error_6'] = 'مفقود مجلد تحميل! يرجى الاتصال على المشرف الخادم للحصول على المساعدة! ';
$phpMussel['lang']['upload_error_7'] = 'خطأ القرص الكتابة! يرجى الاتصال على المشرف الخادم للحصول على المساعدة! ';
$phpMussel['lang']['upload_error_8'] = 'الكشف تكوين الخطأ PHP! يرجى الاتصال على المشرف الخادم للحصول على المساعدة! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'تجاوزت الحد تحميل';
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
 sha1_file
 - خلق التوقيعات SHA1 من ملفات [بناء الجملة: sha1_file اسم الملف].
 md5
 - خلق التوقيعات MD5 من النص [بناء الجملة: md5 نص].
 sha1
 - خلق التوقيعات SHA1 من النص [بناء الجملة: sha1 نص].
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
 pe_meta
 - استخراج البيانات الوصفية من ملف PE [بناء الجملة: pe_meta اسم الملف].
 url_sig
 - توليد URL التوقيعات الماسح الضوئي [بناء الجملة: url_sig نص].
 scan
 - تفحص ملف أو دليل [بناء الجملة: scan اسم الملف].
 - البديل: s.
 c
 - طباعة هذه القائمة الأوامر.
";
