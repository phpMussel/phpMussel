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
 * This file: Arabic language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">الرئيسية</a> | <a href="?phpmussel-page=logout">خروج</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">خروج</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'ملحقات ملفات الأرشيف المعترف بها (الشكل هو CSV، وينبغي فقط إضافة أو إزالة عندما تحدث المشاكل؛ إزالة دون داع قد يسبب ايجابيات كاذبة لتظهر لملفات الأرشيف، في حين اضاف داع سوف القائمة البيضاء أساسا ما كنت تقوم بإضافة من كشف المحدد الهجوم؛ تعديل مع الحذر، لاحظ أيضا أن هذا ليس له تأثير على ما المحفوظات يمكن ولا يمكن تحليلها على مستوى المحتوى). القائمة، كما هو في التقصير، يسرد تلك الأشكال الأكثر شيوعا في غالبية النظم واتفاقية الأنواع المهاجرة، ولكن عمدا ليست شاملة بالضرورة.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'حظر أي ملفات تحتوي على أي أحرف التحكم (عدا أسطر جديدة)؟ (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) إذا كنت <strong>فقط</strong> تحميل نص عادي، ثم يمكنك تشغيل هذا الخيار لتوفير بعض الحماية إضافية على النظام الخاص بك. ومع ذلك، إذا قمت بتحميل أي شيء آخر غير نص عادي، وتحول هذا على قد يؤدي إلى ايجابيات كاذبة. = كاذبة لا منع [افتراضي]. صحيح = بلوك.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'البحث عن العناوين قابلة للتنفيذ في الملفات التي ليست التنفيذية ولا المحفوظات المعترف بها والقابلة للتنفيذ التي هي العناوين غير صحيحة. True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'البحث عن العنوان PHP في الملفات التي ليست ملفات PHP و لا المحفوظات معترفة بها. True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'البحث عن المحفوظات التي عناوينها غير صحيحة (المدعومة: BZ، GZ، RAR، ZIP، RAR، GZ). True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'البحث عن المستندات التي عناوينها غير صحيحة (المدعومة: DOC، وزارة النقل، PPS، PPT، XLA، XLS، WIZ). True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'البحث عن الصور التي عناوينها غير صحيحة (المدعومة: BMP، DIB، PNG، GIF، JPEG، JPG، XCF، PSD، PDD، WEBP). True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'البحث عن الملفات PDF التي عناوينها غير صحيحة. True = على. False = إيقاف.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'تلف الملفات وتحليل الأخطاء. خطأ = تجاهل. صحيح = كتلة [افتراضي]. كشف ومنع الملفات المحتمل تلف PE (محمول قابل للتنفيذ)؟ في كثير من الأحيان (ولكن ليس دائما)، عندما تلف جوانب معينة من ملف PE أو لا يمكن تحليله بشكل صحيح، فإنه يمكن أن يكون مؤشرا على وجود عدوى فيروسية. العمليات المستخدمة من قبل معظم برامج مكافحة الفيروسات للكشف عن الفيروسات في ملفات PE تتطلب تحليل تلك الملفات بطرق معينة والتي إذا كان مبرمج للفيروس هو على علم، ومحاولة خصيصا لمنع، من أجل السماح للفيروس لتبقى غير مكتشفة.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'الحد الأقصى لطول البيانات الخام من خلاله أن يتم الكشف عن أوامر فك (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). افتراضي = 512KB. صفر أو قيمة فارغة تعطيل عتبة (إزالة مثل هذا القيد على أساس حجم الملف).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'الحد الأقصى لطول البيانات الخام التي يسمح phpMussel لقراءة ومسح (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). افتراضي = 32MB. صفر أو قيمة فارغة تعطيل العتبة. عموما، يجب أن لا تكون هذه القيمة أقل من متوسط حجم الملف من تحميل الملفات التي تريد وتتوقع الحصول على الخادم الخاص بك أو الموقع، لا ينبغي أن يكون أكثر من التوجيه filesize_limit، ويجب أن لا يكون خامس أكثر من ما يقرب من واحد من مجموع تخصيص الذاكرة المسموح منح لPHP عن طريق ملف التكوين "php.ini". هذا التوجيه موجود في محاولة لمنع phpMussel من استخدام ما يصل الكثير من الذاكرة (التي تريد منعها من أن تكون قادرة على مسح بنجاح الملفات فوق حجم الملف معين).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'يجب أن يكون هذا التوجيه عموما هو تعطيل ما لم تصبح مطلوبة حصول على الوظائف الصحيحة لـ phpMussel على النظام الخاص بك محددة. عادة، عندما يكون في وضع تعطيل، عندما يكتشف phpMussel وجود عناصر في مجموعة "$_FILES" ()، وأنها سوف محاولة لبدء فحص الملفات التي تمثل تلك العناصر، وإذا كانت تلك العناصر هي فارغة أو فارغة، سوف phpMussel العودة رسالة خطأ. هذا هو السلوك الصحيح للـ phpMussel. ومع ذلك، بالنسبة لبعض CMS، العناصر الفارغة في "$_FILES" يمكن أن تحدث نتيجة لسلوك طبيعي لتلك CMS، أو أخطاء قد يتم الإعلام عندما لم تكن هناك أي، في هذه الحالة، السلوك العادي للphpMussel سوف تتدخل مع السلوك العادي من تلك CMS. في حال حدوث مثل هذه الحالة بالنسبة لك، تمكين هذا الخيار سوف يكلف phpMussel ليست محاولة لبدء المسح الضوئي لمثل هذه العناصر الفارغة، تجاهلها عندما وجدت وعدم إعادة أي رسائل خطأ ذات الصلة، مما يتيح استمرار طلب الصفحة. كاذبة = OFF؛ صحيح = ON.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'إذا كنت تتوقع فقط أو تنوي فقط للسماح الصور المراد تحميلها على النظام الخاص بك أو CMS، وإذا كنت على الاطلاق لا تتطلب أية ملفات أخرى من الصور ليتم تحميلها على النظام الخاص بك أو CMS، ينبغي تمكين هذا التوجيه، ولكن ينبغي خلاف ذلك يتم تعطيل. إذا تم تمكين هذا التوجيه، أنه سوف يكلف phpMussel لمنع عشوائيا أي الإضافات التي تم تحديدها كملفات صورة غير، دون مسحها. هذا قد يقلل من الوقت اللازم لتجهيز واستخدام الذاكرة لمحاولة تحميل الملفات غير الصورة. كاذبة = OFF؛ صحيح = ON.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'كشف ومنع تشفير المحفوظات؟ لأن phpMussel ليست قادرة على مسح محتويات المحفوظات مشفرة، فمن الممكن أن التشفير أرشيف يجوز توظيف من قبل مهاجم كوسيلة لمحاولة تجاوز phpMussel، والماسحات الضوئية مكافحة الفيروسات وغيرها من مثل هذه الحماية. يمكن أن تعليمات phpMussel لمنع أي المحفوظات التي كان تكتشف لتكون مشفرة المحتمل أن يساعد على الحد من أي مخاطر المرتبطة بهذه مثل هذه الاحتمالات. كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_files_check_archives'] = 'محاولة للتحقق من محتويات المحفوظات؟ = كاذبة لا تحقق. صحيح = افحص [افتراضي]. في الوقت الراهن، يتم اعتماد فحص فقط من BZ/BZIP2، GZ/GZIP، LZF، PHAR، TAR و ZIP (فحص من RAR، CAB، 7Z وإلى آخره غير معتمدة حاليا). هذه ليست مضمونة! بينما أنا أوصي حفظ هذا قيد التشغيل، لا يمكنني ان اضمن انها سوف تجد دائما كل شيء. أيضا أن ندرك أن أرشيف التحقق حاليا ليست متكررة ملفات PHAR أو ZIP.';
$phpMussel['lang']['config_files_filesize_archives'] = 'ترحيل حجم ملف القائمة السوداء / قائمة بيضاء لمحتويات المحفوظات؟ كاذبة = لا (فقط كل ما يدرجون)؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_files_filesize_limit'] = 'حدود حجم الملف بالكيلو بايت. 65536 = 64MB [افتراضي]. 0 = لا يوجد حد (greylisted دائما)، أي (إيجابية) قيمة رقمية قبلت. هذا يمكن أن يكون مفيدا عندما يحد التكوين الخاص بي مقدار الذاكرة عملية يمكن أن تعقد أو إذا كان لديك PHP حدود التكوين حجم الملف من الإضافات.';
$phpMussel['lang']['config_files_filesize_response'] = 'ماذا تفعل مع الملفات التي تتجاوز الحد الأقصى لحجم الملف (إن وجد). كاذبة = القائمة البيضاء. صحيح = القائمة السوداء [افتراضي].';
$phpMussel['lang']['config_files_filetype_archives'] = 'ترحيل نوع الملف القائمة السوداء / القائمة البيضاء لمحتويات المحفوظات؟ كاذبة = لا (فقط كل ما يدرجون) [افتراضي]. صحيح = نعم.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'القائمة السوداء:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'قائمة رمادية:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'إذا كان النظام يسمح فقط أنواع معينة من الملفات المراد تحميلها، أو إذا كان النظام ينفي صراحة أنواع معينة من الملفات، تحديد تلك نوع الملف في قوائم بيضاء، القوائم السوداء و القوائم الرمادية يمكن أن تزيد من السرعة التي يتم تنفيذ المسح من خلال السماح للبرنامج بتخطي بعض أنواع الملفات. الشكل هو CSV (قيم مفصولة بفواصل). إذا كنت ترغب في مسح كل شيء، وليس من القائمة البيضاء، القائمة السوداء أو القائمة الرمادية، وترك المتغير (/ ث) فارغة. وبذلك تعطيل القائمة البيضاء / السوداء / القائمة الرمادية. الترتيب المنطقي للمعالجة هو: إذا نوع الملف موجود في القائمة البيضاء، لا يفحص ولا تحجب الملف، وعدم التدقيق في ملف ضد القائمة السوداء أو القائمة الرمادية. إذا نوع الملف موجود في القائمة السوداء، لا تفحص الملف ولكن منع ذلك على أي حال، وعدم التدقيق في ملف ضد قائمة رمادية. إذا كانت قائمة رمادية فارغة أو إذا كانت قائمة رمادية ليس فارغا من نوع الملف، مسح الملفات حسب طبيعتها وتحديد ما إذا كان لمنع ذلك بناء على نتائج الفحص، ولكن إذا كانت قائمة رمادية ليس فارغا ونوع الملف هو ليس ملف قائمة رمادية، معالجة الملف على القائمة السوداء، لذلك لا المسح الضوئي ولكن منع ذلك على أي حال. القائمة البيضاء:';
$phpMussel['lang']['config_files_max_recursion'] = 'الحد الأقصى لإعادة الحد الأقصى لعمق المحفوظات. افتراضي = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'العدد الأقصى المسموح به من ملفات لمسح أثناء تحميل الملفات مسح قبل إحباط عملية الفحص وإعلام المستخدم أنهم تحميل أكثر من اللازم في وقت واحد! يوفر الحماية ضد هجوم النظري حيث يحاول أحد المهاجمين دوس النظام الخاص بك أو CMS من الحمولة الزائدة phpMussel إلى إبطاء عملية PHP لوقف طحن. الموصى بها: 10. أنت قد ترغب في رفع أو خفض هذا الرقم اعتمادا على سرعة الجهاز. لاحظ أن هذا الرقم لا يأخذ في الحسبان أو تتضمن محتويات المحفوظات.';
$phpMussel['lang']['config_general_cleanup'] = 'إلغاء تعيين المتغيرات وذاكرة التخزين المؤقت التي يستخدمها البرنامج النصي بعد المسح الأولي للتحميل؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي]. إذا كنت -لا -تستخدم البرنامج النصي وراء المسح الأولي للتحميل، يجب تعيين هذا صحيح (نعم)، للحد من استخدام الذاكرة. إذا كنت تستخدم البرنامج النصي وراء المسح الأولي للتحميل، ينبغي أن تحدد إلى زائفة =(لا)، لتجنب داع إعادة تحميل البيانات المكررة في الذاكرة. في الممارسة العامة، ينبغي عادة أن يتم تعيين إلى صحيح، ولكن، إذا كنت تفعل ذلك، فإنك لن تكون قادرا على استخدام البرنامج النصي في أي شيء سوى المسح الأولي لتحميل الملف. ليس له أي تأثير في وضع CLI "واجهة سطر الأوامر".';
$phpMussel['lang']['config_general_default_algo'] = 'يحدد الخوارزمية التي سيتم استخدامها لكل كلمات المرور والجلسات المستقبلية. خيارات: PASSWORD_DEFAULT (افتراضي)، PASSWORD_BCRYPT، PASSWORD_ARGON2I (يتطلب PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'تمكين هذا التوجيه وإرشاد النصي لمحاولة حذف فورا عن أي الممسوحة ضوئيا تحميل ملف محاولة مطابقة أي معايير الكشف، سواء عن طريق التوقيعات أو غير ذلك. لن يكون لمست الملفات مصممة على أن تكون "نظيفة". في حالة المحفوظات، سيتم حذف أرشيف كامل، بغض النظر عن ما إذا كان أو لم يكن ملف المخالف هو واحد فقط من العديد من الملفات الواردة في الأرشيف. بالنسبة لحالة إيداع ملف المسح الضوئي، عادة، فإنه ليس من الضروري لتمكين هذا التوجيه، لأن العادة، PHP وتطهير محتويات ذاكرة التخزين المؤقت تلقائيا عند انتهاء التنفيذ، وهذا يعني انها سوف عادة حذف أي الملفات التي تم تحميلها من خلال ذلك إلى الخادم ما لم يكونوا قد تم نقلها أو نسخها أو حذفها بالفعل. يضاف هذا التوجيه هنا كإجراء إضافي من الأمن لأولئك الذين نسخ من PHP قد لا تتصرف دائما على النحو المتوقع. = كاذبة بعد المسح، وترك الملف وحده [الافتراضي]. صحيح = بعد المسح، إن لم يكن نظيفة، تحذف فورا.';
$phpMussel['lang']['config_general_disable_cli'] = 'وضع تعطيل CLI؟ يتم تمكين وضع CLI افتراضيا، ولكن يمكن أن تتداخل أحيانا مع بعض أدوات الاختبار (مثل PHPUnit، على سبيل المثال) وغيرها من التطبيقات القائمة على المبادرة القطرية. إذا كنت لا تحتاج إلى تعطيل وضع CLI، يجب تجاهل هذا التوجيه. خطأ = تمكين وضع CLI [الافتراضي]. صحيح = وضع تعطيل CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'تعطيل وصول front-end؟ وصول front-end يستطيع جعل phpMussel أكثر قابلية للإدارة، ولكن يمكن أيضا أن تكون مخاطر أمنية محتملة. من المستحسن لإدارة phpMussel عبر back-end متى أمكن، لكن وصول front-end متوفر عندما لم يكن ممكنا. يبقيه المعوقين إلا إذا كنت في حاجة إليها. False = تمكين وصول front-end؛ True = تعطيل وصول front-end [الافتراضي].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'هل تريد تعطيل ويبفونتس؟ True = نعم؛ False = لا [افتراضي].';
$phpMussel['lang']['config_general_enable_plugins'] = 'تمكين دعم ملحقات phpMussel؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'هل phpMussel يرسل 403 من العناوين مع الرسالة منعت إيداع الملف، أو يبقى مع المعتادة 200 موافق؟ خطأ = رقم (200). صحيح = نعم (403) [الافتراضي].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'ملف لتسجيل محاولات الدخول الأمامية. تحديد اسم الملف، أو اتركه فارغا لتعطيل.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'عند تمكين وضع مصيدة، و phpMussel محاولة لعزل كل تحميل ملف واحد أن يواجه، بغض النظر عن ما إذا كان أو لم يكن ملف يتم تحميلها يطابق أي وشملت التوقيعات، وسوف لا المسح الفعلي أو تحليل لتلك تحميل الملفات حاول أن يحدث في الواقع. وينبغي أن تكون هذه الوظيفة مفيدة لأولئك الذين يرغبون في استخدام phpMussel لأغراض فيروس / بحث عن البرامج الضارة، ولكن هذا لا يوصى لتمكين هذه الوظيفة إذا كان الغرض من استخدام phpMussel من قبل المستخدم هو الفعلي إيداع ملف المسح، ولا ينصح لاستخدام وظائف مصيدة لأغراض أخرى غير honeypotting. افتراضيا، يتم تعطيل هذا الخيار. كاذبة = معطل [الافتراضي]. = الحقيقية تمكين.';
$phpMussel['lang']['config_general_ipaddr'] = 'أين يمكن العثور على عنوان IP لربط الطلبات؟ (مفيدة للخدمات مثل لايتكلاود و مثلها) الافتراضي = REMOTE_ADDR. تحذير: لا تغير هذا إلا إذا كنت تعرف ما تفعلونه!';
$phpMussel['lang']['config_general_lang'] = 'تحديد اللغة الافتراضية الخاصة بـ phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'هل تريد تمكين وضع الصيانة؟ True = نعم؛ False = لا [افتراضي]. تعطيل كل شيء بخلاف front-end. قد تكون مفيدة أحيانا عند تحديث نظام إدارة المحتوى والأطر وما إلى ذلك.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'الحد الأقصى لعدد محاولات تسجيل الدخول (front-end). الافتراضي = 5.';
$phpMussel['lang']['config_general_numbers'] = 'كيف تفضل الأرقام ليتم عرضها؟ حدد المثال الذي يبدو أكثر صحيح لك.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel غير قادرة على الحجر ترفع علم حاول تحميل الملف في عزلة داخل "قبو" phpMussel، إذا كان هذا هو ما تريد أن تفعله. المستخدمين العاديين من phpMussel التي ترغب ببساطة لحماية مواقعها على شبكة الإنترنت أو بيئة استضافة دون وجود أي مصلحة في تحليل عميق أي ترفع علم تحميل الملفات حاول يجب ترك هذه الوظيفة ذوي الاحتياجات الخاصة، ولكن أي المستخدمين المهتمين في مزيد من التحليل للترفع علم حاولت تحميل الملفات للبحث عن البرامج الضارة أو ما شابه مثل هذه الأمور ينبغي أن تمكن هذه الوظيفة. الحجر الصحي لترفع العلم تحميل الملفات حاول يمكن في بعض الأحيان أن تساعد في تصحيح ايجابيات كاذبة، إذا كان هذا هو الشيء الذي كثيرا ما يحدث لك. إلى تعطيل وظيفة العزل، ببساطة مغادرة <code>quarantine_key</code> التوجيه فارغة، أو مسح محتويات هذا التوجيه إذا لم يكن خاليا بالفعل. لتمكين وظيفة العزل، وإدخال قيمة في التوجيه. و <code>quarantine_key</code> هي ميزة أمنية مهمة من وظائف الحجر الصحي المطلوبة كوسيلة لمنع وظيفة الحجر الصحي من أن تستغل من قبل المهاجمين المحتملين، وكوسيلة لمنع أي احتمال تنفيذ البيانات المخزنة داخل الحجر الصحي. و <code>quarantine_key</code> ينبغي أن يعامل بنفس الطريقة التي يعامل بها كلمات السر الخاصة بك: وكلما كان ذلك أفضل، وحراسته مشددة. للحصول على أفضل تأثير، استخدم بالتزامن مع <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'الحد الأقصى لحجم الملف المسموح به من الملفات للحجر الصحي. لن يكون الحجر الصحي الملفات أكبر من القيمة المحددة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. الافتراضي = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'الحد الأقصى لاستخدام الذاكرة يسمح للحجر الصحي. إذا كان إجمالي الذاكرة المستخدمة من قبل الحجر الصحي تصل هذه القيمة، سيتم حذف أقدم الملفات المعزولة حتى الذاكرة الإجمالية المستخدمة لم تعد تصل هذه القيمة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. الافتراضي = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'إلى متى يجب أن phpMussel تخزين نتائج المسح؟ القيمة هي عدد الثواني لتخزين نتائج المسح ل. الافتراضي هو 21600 ثانية (6 ساعات)؛ وقيمة 0 تعطيل التخزين المؤقت نتائج المسح.';
$phpMussel['lang']['config_general_scan_kills'] = 'اسم الملف من ملف لتسجيل كل سجلات الملفات التي منعت او اوقفت من .تحديد اسم الملف، أو اتركه فارغا لتعطيل.';
$phpMussel['lang']['config_general_scan_log'] = 'اسم الملف لملف تسجيل جميع نتائج المسح. قم بتعيين اسم الملف، أو اتركه فارغا للتعطيل.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'اسم الملف من ملف لتسجيل جميع نتائج المسح إلى (باستخدام تنسيق متسلسل). تحديد اسم الملف، أو اتركه فارغا للتعطيل.';
$phpMussel['lang']['config_general_statistics'] = 'هل تريد تتبع إحصاءات استخدام phpMussel؟ True = نعم؛ False = لا [افتراضي].';
$phpMussel['lang']['config_general_timeFormat'] = 'شكل التواريخ المستخدم من قبل phpMussel. ويمكن إضافة خيارات إضافية عند الطلب.';
$phpMussel['lang']['config_general_timeOffset'] = 'المنطقة الزمنية تعويض في غضون دقائق.';
$phpMussel['lang']['config_general_timezone'] = 'المنطقة الزمنية.';
$phpMussel['lang']['config_general_truncate'] = 'اقتطاع ملفات السجل عندما تصل إلى حجم معين؟ القيمة هي الحجم الأقصى في بايت/كيلوبايت/ميغابايت/غيغابايت/تيرابايت الذي قد ينمو ملفات السجل إلى قبل اقتطاعه. القيمة الافتراضية 0KB تعطيل اقتطاع (ملفات السجل يمكن أن تنمو إلى أجل غير مسمى). ملاحظة: ينطبق على ملفات السجل الفردية! ولا يعتبر حجمها جماعيا.';
$phpMussel['lang']['config_heuristic_threshold'] = 'هناك توقيعات معينة من phpMussel التي تهدف إلى تحديد الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها دون في أنفسهم تحديد تلك الملفات التي تم تحميلها على وجه التحديد بأنها خبيثة. هذه القيمة "الحد الأقصى " تقول phpMussel ما الحد الأقصى للوزن الكلي من الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها هذا المسموح به هو قبل تلك الملفات ليتم وضع علامة بأنها خبيثة. تعريف الوزن في هذا السياق هو العدد الإجمالي من الصفات المشبوهة والمحتمل أن تكون ضارة تحديدها. افتراضيا، سيتم تعيين هذه القيمة إلى 3. القيمة المنخفضة عموما سوف يؤدي إلى حدوث أعلى من ايجابيات كاذبة ولكن عددا أكبر من الملفات الخبيثة التي لوحت، في حين أن أعلى قيمة عموما سوف يؤدي إلى حدوث انخفاض من ايجابيات كاذبة ولكن انخفاض عدد الملفات الخبيثة التي توضع. انها عموما من الأفضل ترك هذه القيمة في الافتراضي إلا إذا كنت تعاني من مشاكل المتعلقة بها.';
$phpMussel['lang']['config_signatures_Active'] = 'قائمة من الملفات توقيع النشطة، محدد بفواصل.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'هل يجب على توقيعات phpMussel الكشف عن تجسس؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'هل يجب على توقيعات phpMussel الكشف عن مهاجمات وdefacers؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'يجب phpMussel كشف ومنع الملفات المشفرة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'هل يجب على توقيعات phpMussel الكشف عن خدعة البرمجيات الخبيثة / الفيروسات؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'هل يجب على توقيعات phpMussel الكشف عن تعبئة والبيانات المعبأة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'هل يجب على توقيعات phpMussel الكشف عن PUAs؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'هل يجب على توقيعات phpMussel الكشف عن البرامج النصية قذيفة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'هل يجب على phpMussel الابلاغ عندما تفقد الملحقات؟ إذا تم تعطيل <code>fail_extensions_silently</code>، وسيتم إبلاغ ملحقات مفقودة على المسح، وإذا تم تمكين <code>fail_extensions_silently</code>، سيتم تجاهل ملحقات المفقودة، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. تعطيل هذا التوجيه قد يحتمل زيادة الأمان، ولكن قد يؤدي أيضا إلى زيادة من ايجابيات كاذبة. خطأ = معطل. صحيح = ممكن [افتراضي].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'هل يجب على phpMussel الابلاغ عندما يتم توقيع ملفات مفقودة أو تالفة؟ إذا كان <code>fail_silently</code> المعوقين، في عداد المفقودين وسيتم الإبلاغ عن ملفات فساد في المسح، وإذا <code>fail_silently</code> تمكين، في عداد المفقودين وسيتم تجاهل ملفات فساد، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. وهذا ين بغي عموما أن تترك وحدها إلا إذا كنت تعاني من أعطال أو مشاكل مشابهة. خطأ = معطل. صحيح = ممكن [افتراضي].';
$phpMussel['lang']['config_template_data_css_url'] = 'ملف الصيغة النموذجية للمواضيع مخصصة يستخدم خصائص CSS الخارجية، في حين أن ملف قالب لموضوع الافتراضي يستخدم خصائص CSS الداخلية. لإرشاد phpMussel لاستخدام ملف النموذجية للمواضيع مخصصة، تحديد عنوان HTTP العام من ملفات CSS موضوع المخصصة لديك باستخدام "css_url" متغير. إذا تركت هذا الحقل فارغا متغير، سوف يقوم phpMussel باستخدام ملف القالب لموضوع التقصير.';
$phpMussel['lang']['config_template_data_Magnification'] = 'تكبير الخط. افتراضي = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'الموضوع الافتراضي لاستخدام phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'متى (بالثواني) يجب التوصل إلى نتائج عمليات بحث API؟ الافتراضي هو 3600 ثانية (1 ساعة).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'العدد الأقصى المسموح به من عمليات بحث واجهة برمجة التطبيقات لأداء في تكرار المسح الفردية.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'تمكين عمليات بحث API إلى API hpHosts.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'العدد الأقصى المسموح به من عمليات بحث واجهة برمجة التطبيقات لأداء في تكرار المسح الفردية. لأن كل بحث API إضافية سوف يضيف إلى الوقت الإجمالي المطلوب لإكمال كل تكرار المسح، قد ترغب في اشتراط وجود قيود من أجل الإسراع في عملية المسح الشاملة. عند تعيينها إلى 0، سيتم تطبيق الحد الأقصى لا هذا العدد المسموح به. تعيين إلى 10 افتراضيا.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'ماذا تفعل إذا تم تجاوز الحد الأقصى المسموح به من عمليات بحث API؟ = كاذبة لا تفعل شيئا (متابعة المعالجة) [افتراضي]. صحيح = تحديد الملف.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'اختياريا، phpMussel غير قادرة على مسح الملفات باستخدام الفيروسات مجموع API كوسيلة لتوفير مستوى تتعزز بشكل كبير من الحماية ضد الفيروسات، و ملفات التجسس، والبرمجيات الخبيثة وغيرها من التهديدات. افتراضيا، ملفات المسح الضوئي باستخدام الفيروسات مجموع API يتم تعطيل. لتمكينه، لا بد من وضع مفتاح API من الفيروسات إجمالي. ويرجع ذلك إلى فائدة كبيرة أن هذا يمكن أن توفر لك، هذا شيء أنا أوصي تمكين. يرجى أن يكون على علم، مع ذلك، أن استخدام الفيروسات مجموع API، التي يجب أن تتوافق مع شروط الخدمة، ويجب أن تلتزم جميع المبادئ التوجيهية حسب وصفه الفيروسات مجموع الوثائق! لا يجوز لك استخدام هذه الميزة التكامل ما لم: لقد قرأت ووافقت على شروط الخدمة من فيروس توتال و API لها. لقد قرأت وفهمت، كحد أدنى، ديباجة الفيروسات وثائق API ملفه مجموع (كل شيء بعد "فايروس توتال V2.0 API العام" ولكن قبل "المحتويات").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'استنادا إلى وثائق الفيروسات الكلي API، "فإنه يقتصر على الأكثر 4 طلبات من أي نوع في أي إطار زمني معين 1 دقيقة. إذا قمت بتشغيل honeyclient، مصيدة أو أي أتمتة الآخر الذي يجري لتوفير الموارد اللازمة لفايروس توتال ولا استرداد فقط تقارير يحق لك الحصول على أعلى حصص معدلات الطلب". افتراضيا، سوف phpMussel الالتزام الصارم لهذه القيود، ولكن نظرا لإمكانية هذه الحصص نسبة تجري زيادة، وتقدم هذه التوجيهات اثنين كوسيلة لتتمكن من إرشاد phpMussel على ما الحد الأقصى ينبغي أن تلتزم بها. إلا إذا كنت قد أعطيت تعليمات للقيام بذلك، فإنه من غير المستحسن بالنسبة لك لزيادة هذه القيم و لكن إذا كنت قد واجهت مشاكل تتعلق الوصول الحصص الخاصة بك، وخفض هذه القيم قد يساعد في بعض الأحيان كنت في التعامل مع هذه المشاكل. يتم تحديد الحد الأقصى معدل حسابك عن طلبات "vt_quota_rate" من أي نوع في أي إطار "vt_quota_time" الوقت دقيقة معين.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(انظر الوصف أعلاه).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'افتراضيا، سوف يقوم phpMussel بتقييد الملفات التي تقوم بمسح باستخدام الفيروسات API الكلي لتلك الملفات التي تعتبرها "المشبوهة". يمكنك ضبط اختياريا هذا التقييد عن طريق تغيير قيمة التوجيه "vt_suspicion_level".';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'هل phpMussel يطبق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة أو الممكن كشفها؟ يوجد هذا التوجيه لأنه على الرغم من أن مسح ملف باستخدام محركات متعددة (كما فايروس توتال لا) ينبغي أن يؤدي في معدل اكتشاف زيادة (وبالتالي في عدد أكبر من الملفات الخبيثة الوقوع)، فإنه يمكن أن يؤدي أيضا إلى ارتفاع عدد كاذبة الإيجابيات، وبالتالي، في بعض الظروف، فإن نتائج المسح يمكن الاستفادة بشكل أفضل كما على درجة الثقة بدلا من أن تكون نتيجة محددة. إذا تم استخدام قيمة 0، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة و بالتالي إذا أي محرك تستخدم من قبل الفيروسات مجموع أعلام الملف تم مسحها ضوئيا بأنها خبيثة، وphpMussel النظر في الملف إلى تكون ضارة. إذا تم استخدام أي قيمة أخرى، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما الترجيح الكشف و بالتالي فإن عدد من المحركات المستخدمة من قبل الفيروسات إجمالي هذا العلم الملف تم مسحها ضوئيا بأنها خبيثة سيكون بمثابة نتيجة الثقة (أو الترجيح الكشف) عن ما إذا كان ملف تم مسحها ضوئيا ينبغي النظر الخبيثة التي كتبها phpMussel (القيمة المستخدمة سيمثل الحد الأدنى من الثقة يسجل أو الوزن المطلوب من أجل أن تعتبر ضارة). يتم استخدام قيمة 0 افتراضيا.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'حزمة الابتدائية (ناقص التوقيعات، وثائق، والتكوين).';
$phpMussel['lang']['field_activate'] = 'جعله نشطة';
$phpMussel['lang']['field_clear_all'] = 'امسح الكل';
$phpMussel['lang']['field_component'] = 'وحدة';
$phpMussel['lang']['field_create_new_account'] = 'إنشاء حساب جديد';
$phpMussel['lang']['field_deactivate'] = 'جعلها غير نشطة';
$phpMussel['lang']['field_delete_account'] = 'حذف حساب';
$phpMussel['lang']['field_delete_all'] = 'حذف الكل';
$phpMussel['lang']['field_delete_file'] = 'حذف';
$phpMussel['lang']['field_download_file'] = 'تحميل';
$phpMussel['lang']['field_edit_file'] = 'تحرير';
$phpMussel['lang']['field_false'] = 'False (خاطئة)';
$phpMussel['lang']['field_file'] = 'ملف';
$phpMussel['lang']['field_filename'] = 'اسم الملف: ';
$phpMussel['lang']['field_filetype_directory'] = 'مجلد';
$phpMussel['lang']['field_filetype_info'] = 'ملف {EXT}';
$phpMussel['lang']['field_filetype_unknown'] = 'غير معروف';
$phpMussel['lang']['field_install'] = 'تثبيت';
$phpMussel['lang']['field_latest_version'] = 'احدث اصدار';
$phpMussel['lang']['field_log_in'] = 'تسجيل الدخول';
$phpMussel['lang']['field_more_fields'] = 'المزيد من الحقول';
$phpMussel['lang']['field_new_name'] = 'اسم جديد:';
$phpMussel['lang']['field_ok'] = 'حسنا';
$phpMussel['lang']['field_options'] = 'خيارات';
$phpMussel['lang']['field_password'] = 'كلمه السر';
$phpMussel['lang']['field_permissions'] = 'أذونات';
$phpMussel['lang']['field_quarantine_key'] = 'الحجر الصحي مفتاح';
$phpMussel['lang']['field_rename_file'] = 'إعادة تسمية';
$phpMussel['lang']['field_reset'] = 'إعادة تعيين';
$phpMussel['lang']['field_restore_file'] = 'استعادة';
$phpMussel['lang']['field_set_new_password'] = 'تحديد جديد كلمه السر';
$phpMussel['lang']['field_size'] = 'الحجم الإجمالي: ';
$phpMussel['lang']['field_size_bytes'] = 'بايت';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'الحالة';
$phpMussel['lang']['field_system_timezone'] = 'استخدام المنطقة الزمنية الافتراضية للنظام.';
$phpMussel['lang']['field_true'] = 'True (صحيح)';
$phpMussel['lang']['field_uninstall'] = 'الغاء التثبيت';
$phpMussel['lang']['field_update'] = 'تحديث';
$phpMussel['lang']['field_update_all'] = 'تحديث الجميع';
$phpMussel['lang']['field_upload_file'] = 'تحميل ملف جديد';
$phpMussel['lang']['field_username'] = 'اسم المستخدم';
$phpMussel['lang']['field_your_version'] = 'الإصدار الخاص بك';
$phpMussel['lang']['header_login'] = 'الرجاء تسجيل الدخول للمتابعة.';
$phpMussel['lang']['label_active_config_file'] = 'ملف التكوين النشط: ';
$phpMussel['lang']['label_blocked'] = 'تم حظر التحميلات';
$phpMussel['lang']['label_branch'] = 'فرع أحدث مستقرة:';
$phpMussel['lang']['label_events'] = 'مسح الأحداث';
$phpMussel['lang']['label_flagged'] = 'تم الإبلاغ عن الكائنات';
$phpMussel['lang']['label_fmgr_cache_data'] = 'بيانات ذاكرة التخزين المؤقت والملفات المؤقتة';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel إستخدام القرص: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'مساحة حرة: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'إجمالي استخدام القرص: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'إجمالي مساحة القرص: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'تحديثات البيانات الوصفية للمكون';
$phpMussel['lang']['label_hide'] = 'إخفائه';
$phpMussel['lang']['label_os'] = 'نظام التشغيل المستخدمة:';
$phpMussel['lang']['label_other'] = 'آخر';
$phpMussel['lang']['label_other-Active'] = 'ملفات التوقيع النشطة';
$phpMussel['lang']['label_other-Since'] = 'تاريخ البدء';
$phpMussel['lang']['label_php'] = 'النسخة PHP المستخدمة:';
$phpMussel['lang']['label_phpmussel'] = 'النسخة phpMussel المستخدمة:';
$phpMussel['lang']['label_quarantined'] = 'تم عزل وحدات التحميل';
$phpMussel['lang']['label_sapi'] = 'SAPI المستخدمة:';
$phpMussel['lang']['label_scanned_objects'] = 'الكائنات التي الممسوحة ضوئيا';
$phpMussel['lang']['label_scanned_uploads'] = 'التحميلات الممسوحة ضوئيا';
$phpMussel['lang']['label_show'] = 'اظهره';
$phpMussel['lang']['label_size_in_quarantine'] = 'الحجر الصحي بحجم: ';
$phpMussel['lang']['label_stable'] = 'أحدث مستقرة:';
$phpMussel['lang']['label_sysinfo'] = 'معلومات النظام:';
$phpMussel['lang']['label_tests'] = 'اختبارات:';
$phpMussel['lang']['label_unstable'] = 'أحدث غير مستقرة:';
$phpMussel['lang']['label_upload_date'] = 'تحميل تاريخ: ';
$phpMussel['lang']['label_upload_hash'] = 'تحميل التجزئة: ';
$phpMussel['lang']['label_upload_origin'] = 'تحميل الأصل: ';
$phpMussel['lang']['label_upload_size'] = 'تحميل بحجم: ';
$phpMussel['lang']['link_accounts'] = 'حسابات';
$phpMussel['lang']['link_config'] = 'التكوين';
$phpMussel['lang']['link_documentation'] = 'توثيق';
$phpMussel['lang']['link_file_manager'] = 'مدير الملفات';
$phpMussel['lang']['link_home'] = 'الرئيسية';
$phpMussel['lang']['link_logs'] = 'سجلات';
$phpMussel['lang']['link_quarantine'] = 'الحجر الصحي';
$phpMussel['lang']['link_statistics'] = 'الإحصاء';
$phpMussel['lang']['link_textmode'] = 'تنسيق النص: <a href="%1$sfalse">بسيط</a> – <a href="%1$strue">تهيئتها</a>';
$phpMussel['lang']['link_updates'] = 'التحديثات';
$phpMussel['lang']['link_upload_test'] = 'تحميل اختبار';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'هذا سجل غير موجود!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'لا سجلات متاح.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'لا سجلات مختار.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'تجاوز الحد الأقصى لعدد محاولات تسجيل الدخول؛ تم رفض الوصول.';
$phpMussel['lang']['previewer_days'] = 'أيام';
$phpMussel['lang']['previewer_hours'] = 'ساعات';
$phpMussel['lang']['previewer_minutes'] = 'الدقائق';
$phpMussel['lang']['previewer_months'] = 'الشهور';
$phpMussel['lang']['previewer_seconds'] = 'ثواني';
$phpMussel['lang']['previewer_weeks'] = 'أسابيع';
$phpMussel['lang']['previewer_years'] = 'سنوات';
$phpMussel['lang']['response_accounts_already_exists'] = 'اسم المستخدم موجود بالفعل!';
$phpMussel['lang']['response_accounts_created'] = 'تم انشاء الحساب بنجاح!';
$phpMussel['lang']['response_accounts_deleted'] = 'تم حذف الحساب بنجاح!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'حساب غير موجود.';
$phpMussel['lang']['response_accounts_password_updated'] = 'تم تحديث كلمه السر بنجاح!';
$phpMussel['lang']['response_activated'] = 'نجحت في جعل نشطة';
$phpMussel['lang']['response_activation_failed'] = 'فشلت في جعله نشطة!';
$phpMussel['lang']['response_checksum_error'] = 'خطأ أختباري! تم رفض الملف!';
$phpMussel['lang']['response_component_successfully_installed'] = 'تم تثبيت الوحدة بنجاح';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'تم الغاء تثبيت الوحدة بنجاح';
$phpMussel['lang']['response_component_successfully_updated'] = 'تم تحديث الوحدة بنجاح';
$phpMussel['lang']['response_component_uninstall_error'] = 'حدث خطأ أثناء محاولة إلغاء تثبيت الوحدة.';
$phpMussel['lang']['response_configuration_updated'] = 'تم تحديث التكوين بنجاح';
$phpMussel['lang']['response_deactivated'] = 'نجحت في جعل غير نشطة';
$phpMussel['lang']['response_deactivation_failed'] = 'فشلت في جعله غير نشطة!';
$phpMussel['lang']['response_delete_error'] = 'فشلت في حذف!';
$phpMussel['lang']['response_directory_deleted'] = 'تم حذف الدليل بنجاح!';
$phpMussel['lang']['response_directory_renamed'] = 'تم اعادة تسمية الدليل بنجاح!';
$phpMussel['lang']['response_error'] = 'خطأ';
$phpMussel['lang']['response_failed_to_install'] = 'فشل التثبيت!';
$phpMussel['lang']['response_failed_to_update'] = 'فشل التحديث!';
$phpMussel['lang']['response_file_deleted'] = 'ملف حذف بنجاح!';
$phpMussel['lang']['response_file_edited'] = 'ملف تعديل بنجاح!';
$phpMussel['lang']['response_file_renamed'] = 'ملف إعادة تسمية بنجاح!';
$phpMussel['lang']['response_file_restored'] = 'تمت استعادة الملف بنجاح!';
$phpMussel['lang']['response_file_uploaded'] = 'ملف تحميلها بنجاح!';
$phpMussel['lang']['response_login_invalid_password'] = 'فشل تسجيل الدخول! كلمة السر غير صالحة!';
$phpMussel['lang']['response_login_invalid_username'] = 'فشل تسجيل الدخول! اسم المستخدم غير موجود!';
$phpMussel['lang']['response_login_password_field_empty'] = 'كلمه السر حقل فارغ!';
$phpMussel['lang']['response_login_username_field_empty'] = 'اسم المستخدم حقل فارغ!';
$phpMussel['lang']['response_rename_error'] = 'فشل في إعادة تسمية!';
$phpMussel['lang']['response_restore_error_1'] = 'أخفق الاستعادة! ملف معطوب!';
$phpMussel['lang']['response_restore_error_2'] = 'أخفق الاستعادة! الحجر الصحي مفتاح غير صحيح!';
$phpMussel['lang']['response_statistics_cleared'] = 'تم مسح الإحصاءات.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'تحديث غير مطلوب.';
$phpMussel['lang']['response_updates_not_installed'] = 'وحدة غير مثبت!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'وحدة غير مثبت (يتطلب PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'عفا عليها الزمن!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'عفا عليها الزمن (يرجى تحديث يدويا)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'عفا عليها الزمن (يتطلب PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'غير قادر على تحديد.';
$phpMussel['lang']['response_upload_error'] = 'فشل لتحميل!';
$phpMussel['lang']['state_complete_access'] = 'الوصول كامل';
$phpMussel['lang']['state_component_is_active'] = 'وحدة نشطة.';
$phpMussel['lang']['state_component_is_inactive'] = 'وحدة غير نشطة.';
$phpMussel['lang']['state_component_is_provisional'] = 'وحدة نشطة جزئيا.';
$phpMussel['lang']['state_default_password'] = 'تحذير: يستخدم الافتراضي كلمه السر!';
$phpMussel['lang']['state_logged_in'] = 'حاليا على.';
$phpMussel['lang']['state_logs_access_only'] = 'سجلات الوصول فقط';
$phpMussel['lang']['state_maintenance_mode'] = 'تحذير: تم تمكين وضع الصيانة!';
$phpMussel['lang']['state_password_not_valid'] = ' تحذير: هذا الحساب لا يستخدم كلمه السر صالحة !';
$phpMussel['lang']['state_quarantine'] = ['هناك ملف %s موجود حاليا في وحدة العزل.', 'هناك ملفات %s موجودة حاليا في وحدة العزل.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'لا يخفون غير عفا عليها الزمن';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'يخفون غير عفا عليها الزمن';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'لا يخفون غير مستعمل';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'يخفون غير مستعمل';
$phpMussel['lang']['tip_accounts'] = 'مرحبا، {username}.<br />الصفحة حسابات يسمح لك للسيطرة على الذي يمكن الوصول ألfront-end phpMussel.';
$phpMussel['lang']['tip_config'] = 'مرحبا، {username}.<br />الصفحة التكوين يسمح لك لتعديل التكوين phpMussel عن طريق ألfront-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel يتم توفير مجانا، ولكن إذا كنت تريد التبرع للمشروع، يمكنك القيام بذلك عن طريق النقر على زر التبرع.';
$phpMussel['lang']['tip_file_manager'] = 'مرحبا، {username}.<br />مدير الملفات يسمح لك لحذف، تعديل، وتحميل الملفات. استخدام بحذر (هل يمكن كسر التثبيت مع هذا).';
$phpMussel['lang']['tip_home'] = 'مرحبا، {username}.<br />هذا هو الصفحة رئيسية ألfront-end phpMussel. اختر ارتباط من قائمة التنقل على اليسار للمتابعة.';
$phpMussel['lang']['tip_login'] = 'الافتراضي اسم المستخدم: <span class="txtRd">admin</span> – الافتراضي كلمه السر: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'مرحبا، {username}.<br />اختار سجلات من القائمة أدناه لعرضها.';
$phpMussel['lang']['tip_quarantine'] = 'مرحبا، {username}.<br />تسرد هذه الصفحة جميع الملفات الموجودة حاليا في وحدة العزل وتسهل إدارة تلك الملفات.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'ملحوظة: تم تعطيل وحدة العزل حاليا، ولكن يمكن تمكينها عبر صفحة التهيئة.';
$phpMussel['lang']['tip_see_the_documentation'] = 'راجع <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.ar.md#SECTION7">وثائق</a> للحصول على معلومات حول مختلف توجيهات التكوين ونيتهم.';
$phpMussel['lang']['tip_statistics'] = 'مرحبا، {username}.<br />تعرض هذه الصفحة بعض إحصاءات الاستخدام الأساسية المتعلقة بتثبيت phpMussel.';
$phpMussel['lang']['tip_statistics_disabled'] = 'ملاحظة: يتم تعطيل تتبع الإحصاءات حاليا، ولكن يمكن تمكينه عبر صفحة التكوين.';
$phpMussel['lang']['tip_updates'] = 'مرحبا، {username}.<br />الصفحة تحديثات يسمح لك لتثبيت، إلغاء، ولتحديث المكونات المختلفة phpMussel (حزمة الأساسية، التوقيعات، الإضافات، الملفات L10N، إلخ).';
$phpMussel['lang']['tip_upload_test'] = 'مرحبا، {username}.<br />الصفحة تحميل اختبار يحتوي على شكل تحميل الملفات القياسية، مما يسمح لك لاختبار ما إذا كان عادة يكون قد تم حظره ملف بواسطة phpMussel عند محاولة تحميله.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – حسابات';
$phpMussel['lang']['title_config'] = 'phpMussel – التكوين';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – مدير الملفات';
$phpMussel['lang']['title_home'] = 'phpMussel – الرئيسية';
$phpMussel['lang']['title_login'] = 'phpMussel – تسجيل الدخول';
$phpMussel['lang']['title_logs'] = 'phpMussel – سجلات';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – الحجر الصحي';
$phpMussel['lang']['title_statistics'] = 'phpMussel – الإحصاء';
$phpMussel['lang']['title_updates'] = 'phpMussel – التحديثات';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – تحميل اختبار';
$phpMussel['lang']['warning'] = 'تحذيرات:';
$phpMussel['lang']['warning_php_1'] = 'لم يتم دعم إصدار PHP الخاص بك بشكل نشط بعد الآن! يوصى بالتحديث!';
$phpMussel['lang']['warning_php_2'] = 'إصدار PHP الخاص بك معرض للخطر بشدة! ينصح بشدة تحديث!';
$phpMussel['lang']['warning_signatures_1'] = 'لا ملفات التوقيع نشطة!';

$phpMussel['lang']['info_some_useful_links'] = 'بعض الروابط المفيدة:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues" dir="ltr">phpMussel Issues @ GitHub</a> – صفحة المشكلات لphpMussel (الدعم والمساعدة، الخ).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55" dir="ltr">phpMussel @ Spambot Security</a> – منتدى للنقاش ل phpMussel (الدعم والمساعدة، الخ).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/" dir="ltr">phpMussel @ SourceForge</a> – بديلة حمل مرآة للphpMussel.</li>
            <li><a href="https://websectools.com/" dir="ltr">WebSecTools.com</a> – بعض الأدوات البسيطة ل جعل المواقع آمنة.</li>
            <li><a href="https://www.clamav.net/" dir="ltr">ClamavNet</a> – الرئيسية ClamAV (ClamAV® هو محرك مكافحة الفيروسات مفتوحة المصدر للكشف عن أحصنة طروادة والفيروسات، والبرمجيات الخبيثة وغيرها من التهديدات الخبيثة).</li>
            <li><a href="https://www.securiteinfo.com/" dir="ltr">SecuriteInfo.com</a> – شركة أمن الكمبيوتر التي توفر التوقيعات التكميلية لكلاماف.</li>
            <li><a href="http://www.phishtank.com/" dir="ltr">PhishTank</a> – التصيد قاعدة البيانات التي تستخدمها URL الماسح الضوئي phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/" dir="ltr">Global PHP Group @ Facebook</a> – PHP مصادر التعلم والمناقشة.</li>
            <li><a href="https://php.earth/" dir="ltr">PHP.earth</a> – PHP مصادر التعلم والمناقشة.</li>
            <li><a href="https://www.virustotal.com/" dir="ltr">VirusTotal</a> – خدمة مجانية لتحليل الملفات وعناوين المواقع التي هي مشبوهة.</li>
            <li><a href="https://www.hybrid-analysis.com/" dir="ltr">Hybrid Analysis</a> – Hybrid Analysis هو خدمة تحليل البرمجيات الخبيثة المجانية التي تقدمها <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/" dir="ltr">Malwarebytes</a> – الكمبيوتر المتخصصين لمكافحة البرمجيات الخبيثة.</li>
            <li><a href="https://malwaretips.com/" dir="ltr">MalwareTips</a> – مفيدة البرمجيات الخبيثة المنتديات مناقشة مركزة.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/" dir="ltr">Vulnerability Charts</a> – يسرد نسخ آمنة وغير آمنة من مختلف الحزم (PHP، HHVM، إلخ).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/" dir="ltr">Compatibility Charts</a> – قوائم معلومات التوافق لمختلف الحزم (CIDRAM، phpMussel، إلخ).</li>
        </ul>';
