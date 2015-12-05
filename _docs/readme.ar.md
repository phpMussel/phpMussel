## <div dir="rtl">المستندات عن "بي اتش بي ماسل" (اللغة العربية).</div>

### <div dir="rtl">المحتويات:</div>
<div dir="rtl"><ul>
 <li>1. <a href="#SECTION1">مقدمة</a></li>
 <li>2أ. <a href="#SECTION2A">كيفية التحميل (لخدمات الويب).</a></li>
 <li>2ب. <a href="#SECTION2B">كيفية التحميل (لخدمات واجهة سطر الأوامر).</a></li>
 <li>3أ. <a href="#SECTION3A">كيفية الاستخدام (لخدمات الويب).</a></li>
 <li>3ب. <a href="#SECTION3B">كيفية الاستخدام (لخدمات واجهة سطر الأوامر).</a></li>
 <li>4أ. <a href="#SECTION4A">أوامرالمتصفح.</a></li>
 <li>4ب. <a href="#SECTION4B">CLI (واجهة سطر الأوامر).</a></li>
 <li>5. <a href="#SECTION5">الملفاتالموجودةفيهذهالحزمة.</a></li>
 <li>6. <a href="#SECTION6">خياراتالتكوين/التهيئة.</a></li>
 <li>7. <a href="#SECTION7">شكلالتوقيع.</a></li>
 <li>8. <a href="#SECTION8">مشاكلالتوافقالمعروفة.</a></li>
</ul></div>

---


### <div dir="rtl">1. <a name="SECTION1"></a>مقدمة</div>

<div dir="rtl">شكرا لك على استخدام "بي اتش بي ماسل"، البرنامج بصيغة PHPمصمم للكشف عن ملفات الاختراق والفيروسات والبرمجيات الخبيثة وغيرها من التهديدات ضمن الملفات التي تم تحميلها على النظام الخاص بك حيثما البرنامج تم تجهيزه، بناء على توقيعات "كلام ايه في"وغيرها.<br /><br /></div>

<div dir="rtl">حقوق النسخ والنشر لـ بي اتش بيم اسل 2013وما بعده GNU/GPLv2كتبها كالب أم (مايكولان).<br /><br /></div>

<div dir="rtl">هذا البرنامج النصي من البرمجيات المجانية، يمكنك إعادة توزيعه أو تعديله تحت شروط رخصة GNU("جي أن يو") العالمية و التي نشرتها مؤسسة البرمجيات المجانية ؛ إما في الإصدار الثاني أو (حسب اختيارك) لأحد الإصدارات اللاحقة. يتم توزيع هذا البرنامج على أمل أن يكون مفيداً و لكن دون أي ضمان، حتى دون ضمان التسويق أو الملائمة لغرض معين. اطلع على رخصة GNUالعالمية لمزيد من التفاصيل و تقع في ملف Licenseداخل الدليل (المجلد) _docsضمن الحزمة المرتبطة بها و مستودع أيضاً ضمن هذا الملف، كذلك تتوفر في:</div>
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

<div dir="rtl">شكر خاص لـ "كلام ايه في"(<a href="http://www.clamav.net/">ClamAV</a>)لكل من الإلهام للمشروع وللتوقيعات المستخدمة في هذا البرنامج النصي و التي من دونها فمن المرجح أنه لا وجود للبرنامج، أو في أحسن الأحوال له قيمة محدودة للغاية.<br /><br /></div>

<div dir="rtl">شكر خاص لكل من "سورس فورج"(Sourceforge)و "جيت هاب"(Github)على استضافتهم لملفات المشروع، كذلك الشكر لـ <a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">Spambot Security</a>على استضافتهم لمنتديات مناقشة "بي اتش بي ماسل"(phpMussel)و إلى المصادر الإضافية لعدد من التوقيعات المستخدمة في "بي اتش بي ماسل"و منها: <a href="http://www.securiteinfo.com/">SecuriteInfo.com</a>، <a href="http://www.phishtank.com/">PhishTank</a>، <a href="http://nlnetlabs.nl/">NLNetLabs</a> و مصادر أخرى و شكر خاص لكل الذين دعموا المشروع و إلى أي أحد قد نسيت أن أذكره و لكم بالتأكيد على استخدامكم البرنامج.<br /><br /></div>

<div dir="rtl">هذا المستند و الحزمة المرتبطة به يمكن تحميلها مجاناً من:</div>
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


### <div dir="rtl">2أ. <a name="SECTION2A"></a>كيفية التحميل (لخدمات الويب)</div>

<div dir="rtl">آمل أن يتم تسهيل هذه العملية عن طريق المثبت في مرحلة ما في المستقبل غير البعيد جدا، ولكن حتى ذلك الحين اتبع الإرشادات للحصول على "بي اتش بي ماسل"phpMusselو الذي يعمل على *معظم الأنظمة و CMS:<br /><br /></div>

<div dir="rtl">1) حسب قراءتك لهذا، فإنني أفترض أنك قد قمت بالفعل بتنزيل نسخة مؤرشفة من البرنامج النصي و قمت بفك ضغط محتوياته وأنها توجد في مكان ما على جهازك المحلي. من هنا، فأنت تريد أن تعمل خارجا على المضيف الخاص بك أو CMSحيث تريد أن تضع تلك المحتويات. الدليل مثل "/public_html/phpmussel/"أو ما شابه ذلك (على الرغم من أنه لا يهم الذي تختاره، وطالما انه شيء آمن وشيء يرضيك) فلن يكون كافيا. قبل بدء التحميل، واصل القراءة..<br /><br /></div>

<div dir="rtl">2) بشكل اختياري (موصى به بشدة للمستخدمين المتقدمين، ولكن لا ينصح به للمبتدئين أو لعديمي الخبرة)، افتح "phpmussel.ini" مفتوحة (الموجود داخل "vault") - يحتوي هذا الملف على كافة التوجيهات المتاحة لـphpMussel. فوق كل خيار سيكون تعليق مختصر يصف ما يقوم به وإلى ما هو هذا التوجيه. اضبط هذه الخيارات على النحو الذي تراه مناسبا، حسب ما هو مناسب لإعداداتك المعينة، قم بحفظ الملف ثم أغلق.<br /><br /></div>

<div dir="rtl">3) قم بتحميل المحتويات (phpMusselوملفاته) إلى الدليل الذي كنت قد قررت استخدامه في وقت سابق (أنت لا تحتاج إلى تضمين ملفات *.txt/*.md ولكن في الغالب، يجب تحميل كل شيء).<br /><br /></div>

<div dir="rtl">4) قم بتغيير وضع الدليل "vault"إلى "777". الدليل الرئيسي لتخزين المحتويات (الذي اخترته سابقا) عادة يمكن أن يترك وحده ولكن يجب فحص حالة تغيير الوضع إذا كان لديك مشاكل الأذونات في الماضي على النظام الخاص بك (افتراضيا، يجب أن يكون شيء مثل "755").<br /><br /></div>

<div dir="rtl">5) بعد ذلك، سوف تحتاج إلى ربط "بي اتش بي ماسل" على النظام الخاص بك أو CMS. هناك العديد من الطرق المختلفة التي تمكنك من "ربط" البرامج النصية مثل "بي اتش بي ماسل"على النظام الخاص بك أو CMS، ولكن الأسهل هو أن تضم ببساطة البرنامج النصي في بداية ملف أساسي من النظام الخاص بك أو CMS (هو الواحد الذي سيكون عموما بشكل دائم يمكن تحميله عندما يقوم شخص ما بالوصول إلى أي صفحة عبر موقع الويب الخاص بك) باستخدام أمر "require()"أو "include()". بشكل اعتيادي، سيكون هذا الشيء مخزن في دليل مثل "/includes"، "/assets" أو "/functions"، و غالباً يكون اسمه شيء مثل "init.php"، "common_functions.php"، "functions.php" أو ما شابه ذلك. سيكون عليك التوصل أي ملف هو الذي يناسب حالتك. إذا واجهت صعوبات في عمل هذا بنفسك، قم بزيارة منتدى الدعم الفني لـ "بي اتش بي ماسل" phpMusselو قم بإعلامنا، فمن الممكن أن أكون أنا أو مستخدم آخر قد يكون له تجربة مع نظام التشغيل الذي تستخدمه (ستحتاج لإعلامنا نوع نظام التشغيل الذي تستخدمه) وبالتالي قد نكون قادرين على توفير بعض المساعدة في هذا المجال. للقيام بذلك [لاستخدام "require()" أو "include()"]، أدخل السطر التالي من التعليمات البرمجية إلى بداية هذا الملف الأساسي، ليحل محل السلسلة الموجودة داخل علامتي الاقتباس مع العنوان الدقيق لملف "phpmussel.php" (العنوان المحلي وليس عنوان HTTP، بل سوف يبدو مشابه إلى عنوان vault المذكور سابقا).<br /><br /></div>

"<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>"

<div dir="rtl">احفظ الملف، إغلاق، إعادة تحميل(تحديث).<br /><br /></div>

<div dir="rtl">-- أو بدلا من ذلك --<br /><br /></div>

<div dir="rtl">إذا كنت تستخدم خادم الويب أباتشي و كان لديك الوصول إلى "php.ini"، يمكنك استخدام التوجيه "auto_prepend_file"للإضافة لبداية phpMusselكلما أجريت أي طلب PHP. شيء مثل:<br /><br /></div>

"auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php""

<div dir="rtl">أو هذا في ملف ".htaccess":<br /><br /></div>

"php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php""

<div dir="rtl">6) في هذه المرحلة، لقد انتهيت! ومع ذلك، ربما يجب عليك اختباره للتأكد من أنه يعمل بشكل صحيح. لاختبار حماية تحميل الملفات، حاول تحميل ملفات الاختبار الموجودة في الحزمة بالأسفل "_testfiles"إلى موقع الويب الخاص بك عبر وسائل تحميل المتصفح الاعتيادية الخاصة بك. إذا كان كل شيء يعمل، يجب أن تظهر رسالة من "بي اتش بي ماسل"مؤكدا أن التحميل تم حجبه بنجاح.<br /><br /></div>

---


### <div dir="rtl">2ب. <a name="SECTION2B"></a>كيفية التحميل (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">آمل أن يتم تبسيط هذه العملية عن طريق المثبت في مرحلة ما في المستقبل غير البعيد جدا، ولكن حتى ذلك الحين، اتبع الإرشادات للحصول على "بي اتش بي ماسل"جاهز للعمل مع واجهة سطر الأوامر، (يجب أن تكون على علم أنه عند هذه النقطة، دعم واجهة سطر الأوامر لا تنطبق إلا على أنظمة ويندوز ؛ لينكس والأنظمة الأخرى سيتم قريبا عند إصدار إصدارات أحدث من بي اتش بي ماسل):<br /><br /></div>

<div dir="rtl">1) حسب قراءتك لهذا، فإنني أفترض أنك قد قمت بالفعل بتنزيل نسخة مؤرشفة من البرنامج، و قمت بفك ضغط محتوياته، وأنها تجلس في مكان ما على جهازك المحلي. بمجرد ان تكون قد قررت أنك راضيا عن الموقع الذي تم اختياره لـ"بي اتش بي ماسل"، قم بالمتابعة.<br /><br /></div>

<div dir="rtl">2) يتطلب "بي اتش بي ماسل"أن يتم تثبيتPHPعلى الجهاز المضيف من أجل تنفيذه. إذا لم يكن لديك PHPمثبتا على جهازك، الرجاء قم بتثبيت PHPعلى جهازك، و اتبع أي تعليمات يقدمها مثبت PHP.<br /><br /></div>

<div dir="rtl">3) بشكل اختياري (موصى به بشدة للمستخدمين المتقدمين، ولكن لا ينصح به للمبتدئين أو لعديمي الخبرة)، افتح "phpmussel.ini" مفتوحة (الموجود داخل "vault") - يحتوي هذا الملف على كافة التوجيهات المتاحة لـphpMussel. فوق كل خيار سيكون تعليق مختصر يصف ما يقوم به وإلى ما هو هذا التوجيه. اضبط هذه الخيارات على النحو الذي تراه مناسبا، حسب ما هو مناسب لإعداداتك المعينة، قم بحفظ الملف ثم أغلق.<br /><br /></div>

<div dir="rtl">4) بشكل اختياري، يمكنك جعل استخدام"بي اتش بي ماسل"في وضع"واجهة سطر الاوامر"أسهل لنفسك عن طريق إنشاء ملف باتش لتحميل PHPوphpMusselتلقائيا. للقيام بذلك، قم بفتح محرر نص عادي مثل المفكرة أو Notepad++ ثم اكتب المسار الكامل لملف php.exe في دليل التثبيت الخاص بك متبوعا بمسافة ثم متبوعا بالمسار الكامل لملف "phpmussel.php" في دليل التركيب "بي اتش بي ماسل"الخاص بك، قم بحفظ الملف بملحق ".bat" في مكان يمكن أن تجده بسهولة، ثم انقر نقراً مزدوجاً على هذا الملف لتشغيل"بي اتش بي ماسل"في المستقبل.<br /><br /></div>

<div dir="rtl">5) في هذه المرحلة، لقد انتهيت! ومع ذلك فربما يجب عليك اختباره للتأكد من أنه يعمل بشكل صحيح. لاختبار "بي اتش بي ماسل"، قم بتشغيله و حاول فحص الدليل "_testfiles" المتوفر مع الحزمة.<br /><br /></div>

---


### <div dir="rtl">3أ. <a name="SECTION3A"></a>كيفية الاستخدام (لخدمات الويب)</div>

<div dir="rtl">لقد تم إعداد "بي اتش بي ماسل" ليكون البرنامج النصي الذي سوف يعمل بشكل مرضي على جهازك مع مستوى الحد الأدنى من المتطلبات على جهازك: بمجرد تثبيته -بشكلي أساسي- فإنه ببساطة يجب أن يعمل.<br /><br /></div>

<div dir="rtl">إن مسح تحميل الملفات يتم بشكل تلقائي و تم تمكينه افتراضيا، لذلك ليس هناك شيء مطلوب نيابة عنك لهذه الوظائف المحددة.<br /><br /></div>

<div dir="rtl">مع ذلك، فإنك قادراً أيضاً على إرشاد "بي اتش بي ماسل" لمسح ملفات معينة مثل الدلائل و/ أو المحفوظات. للقيام بذلك فعليك أولاً: سوف تحتاج إلى التأكد من أن يتم تعيين التكوين المناسب في ملف "phpmussel.ini" (يجب تعطيل عملية التنظيف) وعندما تنتهي من ذلك، في ملف PHP و الذي تم ربطه مع "بي اتش بي ماسل"، استخدم الدالة التالية في التعليمة البرمجية "الكود" الذي ستضعه:<br /><br /></div>

"phpMussel($what_to_scan,$output_type,$output_flatness);"


<div dir="rtl"><ul>
 <li>"$what_to_scan" يمكن أن تكون سلسلة، مصفوفة، أو مجموعة من المصفوفات، وتشير إلى أي ملف/ملفات، دليل و/أو دلائل ليتم إجراء المسح عليها.</li>
 <li>"$output_type" هي قيمة منطقية تدل على نتائج الفحص ليتم إرجاعها كالتالي، الخطأ يرشد الدالة لإرجاع نتائج الفحص على شكل عدد (النتائج المرجعة -3 تشير إلى مشاكل واجهها "بي اتش بي ماسل" مع التوقيعات أو ملفات خريطة التوقيع و التي من الممكن أن تكون مفقودة أو تالفة، -2 تشير إلى أنه تم الكشف عن بيانات تالفة خلال الفحص وبالتالي فشل في إكمال الفحص، 0 يشير إلى أن هدف الفحص غير موجود و بالتالي لم تكن هناك حاجة لعملية الفحص، 1 يشير إلى أن الهدف تم فحصه بنجاح و لم يتم الكشف عن أي مشاكل، 2 يشير إلى أن الهدف تم فحصه بنجاح و تم الكشف عن مشاكل. القيمة الصحيحة ترشد الدالة لإرجاع نتائج الفحص كنص مقروء للبشر. بالإضافة إلى ذلك، في كلتا الحالتين، يمكن الوصول إلى النتائج عبر المتغيرات العالمية بعد اكتمال الفحص. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
 <li>"$output_flatness" هي قيمة منطقية تشير إلى دالة بالعودة لنتائج الفحص من النوعين (عندما يكون هناك أهداف فحص متعددة)، سواء خاطئة فتعود النتائج على شكل مصفوفة، أو صحيحة فتعود النتائج على شكل سلسلة. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
</ul></div>

<div dir="rtl">أمثلة:<br /><br /></div>

"""
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
"""

<div dir="rtl">يتحول كالتالي (كسلسلة):<br /><br /></div>

"""
 Wed, 16 Sep 2013 02:49:46 +0000 Started.
 > Checking '/user_name/public_html/my_file.html':
 -> No problems found.
 Wed, 16 Sep 2013 02:49:47 +0000 Finished.
"""

<div dir="rtl">للحصول على مفعول كامل لأي من التوقيعات التي يستخدمها "بي اتش بي ماسل" أثناء التفحص، وكيف يتعامل مع هذه التوقيعات، راجع قسم (7) شكل/صيغة التوقيع في هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">إذا واجهت أي إيجابيات زائفة أي إذا واجهت شيئا جديدا تعتقد أنه يجب أن يكون قد تم حظره أو أي شيء آخر بخصوص التوقيعات، فيرجى الاتصال بي لإبلاغي عن ذلك حتى أستطيع إجراء التغييرات اللازمة، والتي إذا لم تقوم بالاتصال بي، فإنني قد لا أكون منتبه لها.<br /><br /></div>

<div dir="rtl">لتعطيل التواقيع التي يتضمنها phpMussel (مثل إذا كنت تعاني من إيجابية زائفة محددة لأغراضك التي لا ينبغي أن يتم عادة إزالتها)، فارجع إلى القائمة الرمادية ضمن قسم أوامرالمتصفح من هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">بالإضافة للمسح الافتراضي للملفات و المسح الاختياري للملفات و/أو الدلائل الأخرى المحددة عن طريق الدالة أعلاه المضمنة في phpMussel و هي وظيفة معدة لفحص محتوى رسائل البريد الإلكتروني. هذه الوظيفة تسلك بشكل مشابه للوظيفة المعيارية ل"بي اتش بي ماسل" ولكن تركز فقط على المطابقة ضد توقيعات "كلام ايه في" القائمة على البريد الإلكتروني. إنني لم أربط هذه التوقيعات بالوظيفة الافتراضية لـ"بي اتش بي ماسل" لأنه من المستبعد جداً أن تجد محتوى رسالة يحتاج للفحص ضمن تحميل الملف المستهدف إلى صفحة حيث يكون "بي اتش بي ماسل" مثبت. و بذلك فإن ربط هذه التوقيعات بوظيفة "بي اتش بي ماسل" غير ضروري أو مجدي، ومع ذلك فوجود وظيفة منفصلة تطابق ضد هذه التوقيعات يمكن أن تكون مفيدة للغاية بالنسبة للبعض، خصوصا بالنسبة لأولئك الذين لديهم نظام CMS أو نظام webfront مرتبط بطريقة أو بأخرى مع نظام بريدهم الإلكتروني وبالنسبة لأولئك الذين يحيلون رسائل بريدهم الإلكتروني عن طريق نص برمجي PHP فإنهم من المحتمل أن ربطوه مع "بي اتش بي ماسل". تكوين هذه الدالة مثل كل الدوال الأخرى والتحكم فيها عن طريق ملف "phpmussel.ini". لاستخدام هذه الدالة (سوف تحتاج إلى القيام بالإجراء الخاص بك)، في ملف PHP التي يتم ربطه مع "بي اتش بي ماسل"، استخدم الدالة التالية في التعليمات البرمجية:<br /><br /></div>

"phpMussel_mail($body);"

<div dir="rtl">حيث "$body" هي محتوى رسالة البريد الإلكتروني المارد فحصها (بالإضافة إلى ذلك، فيمكنك تجربة فحص المشاركات الجديدة في منتدى، الرسائل الواردة من نموذج اتصالك بالانترنت أو ما شابه ذلك. في حالة حدوث أي خطأ يمنع الدالة من إكمال فحصها فسوف تعاد قيمة -1. إذا اكتمل فحص الدالة ولم تطابق أي شيء فسيتم إرجاع قيمة "0" (بمعنى نظيفة). غير أنه إذا كانت الدالة لا تتطابق مع شيء فسيتم إرجاع سلسلة تحتوي على رسالة تعلن ما يقابل ذلك.<br /><br /></div>

<div dir="rtl">بالإضافة إلى ما سبق، إذا نظرتم إلى التعليمات البرمجية من المصدر فقد تلاحظ الدالة "phpMusselD()" و"phpMusselR()". هذه الدوال هي دوال فرعية من "phpMussel()"، ويجب أن لا يتم استدعاءها مباشرة خارج تلك الدالة الأم (ليس بسبب الآثار السلبية، ولكن يفضل ذلك، لأنه ببساطة لا تخدم أي غرض وستكون على الأرجح لا تعمل بشكل صحيح على أية حال).<br /><br /></div>

<div dir="rtl">هناك العديد من الضوابط وغيرها من المهام المتاحة داخل phpMussel للاستخدام الخاص أيضا. عن أي من هذه الضوابط والمهام الموجودة بنهاية هذا الملف التمهيدي، فيرجى مواصلة القراءة والرجوع إلى قسم أوامرالمتصفح من هذا الملف التمهيدي.<br /><br /></div>

---


### <div dir="rtl">3ب. <a name="SECTION3B"></a>كيفية الاستخدام (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">يرجى الرجوع إلى قسم "التحميل (لخدمات واجهة سطر الأوامر)" من هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">يجب أن تدرك أنه على الرغم من أن الإصدارات المستقبلية من "بي اتش بي ماسل" ينبغي أن تدعم الأنظمة الأخرى، لكن في هذا الوقت phpMussel CLI في وضعه الأمثل يدعم فقط الاستخدام على نظام Windows (يمكنك بطبيعة الحال محاولة استخدامه على الأنظمة الأخرى، ولكن لا أستطيع أن أضمن لك أنه سوف يعمل على النحو المنشود).<br /><br /></div>

<div dir="rtl">كما يجب أن تدرك أن "بي اتش بي ماسل" ليس المكافئ الوظيفي لمجموعة متكاملة من مضاد الفيروسات، وعلى عكس البرامج التقليدية لمكافحة الفيروسات فإنها لا تراقب الذاكرة النشطة أو الكشف عن الفيروسات بشكل مباشر و على الطاير! لكنها سوف تكشف عن الفيروسات فقط الواردة في تلك الملفات المحددة التي طلبت منه فحصها.<br /><br /></div>

---


### <div dir="rtl">4أ. <a name="SECTION4A"></a>أوامرالمتصفح</div>

<div dir="rtl">بمجرد أن تم تثبيت "بي اتش بي ماسل" و يعمل بشكل صحيح على النظام الخاص بك، فإذا قمت بضبط المتغيرات "script_password" و "logs_password" في ملف التكوين الخاص بك، ستكون قادرة على أداء بعض من الوظائف الإدارية المحدودة و إدخال بعض من الأوامر لـ"بي اتش بي ماسل" عبر متصفحك.السبب في أن كلمات السر هذه يجب وضعها من أجل تمكين هذه الضوابط من جانب المتصفح لضمان الأمن السليم، سواء للحماية المناسبة من هذه الضوابط من جانب المتصفح و كذلك لضمان أن هناك وسيلة لهذه الضوابط من جانب المتصفح ليكون معطل تماما إذا لم يتم طلبه من قبلك و/أو مشرفي المواقع الأخرى الذين يستخدمون "بي اتش بي ماسل". لذلك، وبعبارة أخرى، لتمكين هذه الضوابط قم بتعيين كلمة مرور، و لتعطيل هذه الضوابط لا تقم بتعيين أية كلمة مرور. بدلا من ذلك، إذا أردت تمكين هذه الضوابط و من ثم تعطيل هذه الضوابط في وقت لاحق، هناك أمر للقيام بذلك (مثل هذا يمكن أن يكون مفيد اًإذا قمت بإجراء بعض الإجراءات التي تشعر باحتمالية أن تؤثر سلبا على كلمات السر المفوضة وتحتاج إلى تعطيل هذه الضوابط بسرعة دون تعديل ملف التكوين الخاص بك).<br /><br /></div>

<div dir="rtl">يجب عليك <strong>تفعيل</strong> هذه الضوابط لمجموعة أسباب:<br /></div>
<div dir="rtl"><ul>
 <li>يوفر وسيلة للتوقيعات الموجودة في القائمة الرمادية على الفور في حالات مثل عندما تكتشف توقيع ينتج إيجابية كاذبة(أي أنه صنف الملف على أنه تحت تأثير الفايروس و لكن في الحقيقة أن الملف سليم و غير مصاب بالفايروس) أثناء تحميل الملفات على النظام الخاص بك و ليس لديك الوقت لتعديل وإعادة رفع ملف القائمة الرمادية يدويا.</li>
 <li>يوفر لك طريقة لتمكن شخص غيرك من التحكم في نسختك من "بي اتش بي ماسل" دون الحاجة لمنحهم إمكانية الوصول إلى بروتوكول نقل الملفات.</li>
 <li>يوفر طريقة لتوفير مراقب إلى سجل ملفاتك.</li>
 <li>يوفر طريقة سهلة لتحديث "بي اتش بي ماسل" عندما تتوفر تحديثات.</li>
 <li>يوفر طريقة لتتمكن من مراقبة "بي اتش بي ماسل"عند عدم توفر مراقبة من FTPأ و نقاط الوصول التقليدية الأخرى.</li>
</ul></div>

كذلك يجب عليك <strong>عدم تفعيل</strong> هذه الضوابط لمجموعة أسباب:
<div dir="rtl"><ul>
 <li>يوفر ناقل للمهاجمين المحتملين وغير المرغوب فيهم لتحديد ما إذا كنت تستخدم "بي اتش بي ماسل" أم لا (على الرغم من أن هذا يمكن أن يكون سبب لها أو ضدها بناء على نوعيتها) عن طريق إرسال أوامر بصورة عمياء إلى الخادم كوسيلة لفحص. من جهة فيمكن أن يثني المهاجمين من استهداف النظام الخاص بك إذا كانوا يعلمون أنك تستخدم"بي اتش بي ماسل" على افتراض أنهم يفحصون و وجدوا أن طريقة هجومهم ستكون غير فعالة نتيجة لاستخدام"بي اتش بي ماسل". مع ذلك فمن ناحية أخرى، فقد يمكن استغلال بعض المداخل غير المتوقعة وغير المعروفة حاليا داخل "بي اتش بي ماسل" أو في إصدار لاحق من البرنامج، فمن المحتمل أن توفر ناقلات لهجومهم، كنتيجة إيجابية من مثل هذا الفحص (أي أنهم يجدون مدخل أو ثغرة في البرنامج) في الواقع يمكن أن تشجع المعتدين على استهداف النظام الخاص بك.</li>
 <li>إذا تعرضت كلمات السر التي قمت بتعيينها للخطر في أي وقت، إلا إذا تغيرت، فيمكن أن توفر وسيلة للمهاجمين لتجاوز كل ما قد تكون التوقيعات كفيلة عادة بمنع هجماتهم من النجاح، أو حتى يحتمل تعطيل "بي اتش بي ماسل" تماما، وبالتالي توفير وسيلة لجعل فعالية "بي اتش بي ماسل" شكلية غير فعالة.</li>
</ul></div>

<div dir="rtl">في كلتا الحالتين بغض النظر عن ما اخترت والخيار في النهاية لك، فإنه بشكل افتراضي سيتم تعطيل هذه الضوابط، ولكن فكر في ذلك، وإذا قررت أنك تريدهم، فهذا القسم يوضح كل من كيفية تمكينها وكيفية استخدامها.<br /><br /></div>

<div dir="rtl">قائمة الأوامر المتاحة من جانب متصفح:<br /><br /></div>

<div dir="rtl">scan_log (سجل_الفحص)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password"</li>
 <li>متطلبات أخرى: يجب ضبط "scan_log".</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?logspword=[logs_password]&phpmussel=scan_log"</li>
 <li>ماذا يفعل: إظهار محتويات ملف (سجل الفحص) scan_log إلى الشاشة.</li>
</ul></div>

<div dir="rtl">scan_kills (تعطل_الفحص)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password"</li>
 <li>متطلبات أخرى: يجب ضبط scan_kills.</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?logspword=[logs_password]&phpmussel=scan_kills"</li>
 <li>ماذا يفعل: إظهار محتويات ملف (تعطل الفحص) scan_kills إلى الشاشة.</li>
</ul></div>

<div dir="rtl">controls_lockout (قفل التحكم)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password" أو "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال 1: "?logspword=[logs_password]&phpmussel=controls_lockout"</li>
 <li>مثال 2: "?pword=[script_password]&phpmussel=controls_lockout"</li>
 <li>ماذا يفعل: تعطل جميع عناصر التحكم من قبل المتصفح. هذا ينبغي أن تستخدم إذا كنت تظن أن أي من كلمات السر الخاصة بك قد تم اختراقها (هذا يمكن أن يحدث إذا كنت تستخدم هذه الضوابط من جهاز كمبيوتر ليس آمن و/أو غير موثوق). "controls_lockout" (قفل التحكم) يعمل عن طريق إنشاء ملف يسمى (controls.lck) في مجلد خاص و الذي سوف يقوم (بي اتش بي ماسل) بالتحقق من خلاله قبل تنفيذ أي أوامر من أي نوع. عندما يحدث هذا فإنك لإعادة تمكين الضوابط، ستحتاج إلى حذف الملف (controls.lck) يدويا عبر بروتوكول نقل الملفات أو ما شابه ذلك و الذي يمكن استدعاءه باستخدام كلمة مرور.</li>
</ul></div>

<div dir="rtl">disable (تعطل)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=disable"</li>
 <li>ماذا يفعل: تعطيل (بي اتش بي ماسل). هذا ينبغي أن تستخدم إذا كنت تود بالقيام بأي تحديثات أو تغييرات على النظام الخاص بك أو يمكن إذا كنت تقوم بتثبيت أي برنامج جديد أو وحدات لنظامك فإما أن يفعل أو يحتمل أن يؤدي لفحص خاطئ (أن يعطي الفحص نتيجة بان البرنامج مصاب بالفايروس و هو غير ضار أو غير مصاب فعلياً). ينبغي أن يستخدم أيضا إذا كنت تواجه أي مشاكل مع (بي اتش بي ماسل) ولكن لا ترغب في إزالته من النظام الخاص بك. عندما يحدث هذا، لإعادة تمكين (بي اتش بي ماسل)، استخدم "تمكين".</li>
</ul></div>

<div dir="rtl">enable (تمكين)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=enable"</li>
 <li>ماذا يفعل: تمكين بي اتش بي ماسل. هذا ينبغي أن تستخدم إذا كنت قد قمت بتعطيل (بي اتش بي ماسل) مسبقاً باستخدام "تعطيل" و تود إعادة تمكينه.</li>
</ul></div>

<div dir="rtl">update (تحديث)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: يجب أن تكون update.dat و  update.inc موجودة.</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=update"</li>
 <li>ماذا يفعل: البحث عن التحديثات لكلاً من (بي اتش بي ماسل) و توقيعاته. إذا نجحت الفحوصات و أشارات لوجود تحديث، فستحاول تحميل وتثبيت هذه التحديثات. إذا فشلت الفحوصات بإيجاد التحديث، فسوف تحبط عملية التحديث و تظهر نتائج العملية برمتها إلى الشاشة. أنا أوصي بالفحص مرة واحدة على الأقل في الشهر لضمان أن يتم الاحتفاظ بالتوقيعات الخاصة بك ونسختك من (بي اتش بي ماسل) حديثة (باستثناء أن تكون قد قمت بالتحقق من التحديثات وتثبيتها يدويا والتي كنت و لا زلت أوصي به مرة واحدة في الشهر على الأقل). فحص أكثر من مرتين في الشهر ربما لا فائدة منه بإعتبار أنني أستبعد جدا أن أكون قادر على إنتاج التحديثات أياً كان نوعها في كثير من الأحيان لأكثر من مرة في الشهر (لا سيما الجزء الأكبر منهاً).</li>
</ul></div>

<div dir="rtl">greylist (القائمة الرمادية "قائمة التوقيعات")<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (اسم التوقيع ليتم ضمه للقائمة)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]"</li>
 <li>ماذا يفعل: إضافة التوقيع للقائمة.</li>
</ul></div>

<div dir="rtl">greylist_clear (مسح القائمة الرمادية)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=greylist_clear"</li>
 <li>ماذا يفعل: مسح القائمة الرمادية.</li>
</ul></div>

<div dir="rtl">greylist_show (عرض القائمة الرمادية)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=greylist_show"</li>
 <li>ماذا يفعل: عرض القائمة الرمادية على الشاشة.</li>
</ul></div>

---


### <div dir="rtl">4ب. <a name="SECTION4B"></a>CLI (واجهة سطر الأوامر)</div>

<div dir="rtl">يمكن تشغيل (بي اتش بي  ماسل) باعتباره برنامج فحص ملفات تفاعلي في وضع CLI في ظل النظم المستندة إلى Windows. راجع قسم "كيفية التثبيت (لواجهة سطر الاوامر)" من هذا الملف التمهيدي لمزيد من التفاصيل.<br /><br /></div>

<div dir="rtl">للحصول على قائمة الأوامر المتاحة لواجهة سطر الأوامر، اكتب "c" في موجه واجهة سطر الأوامر واضغط "دخول" Enter.<br /><br /></div>

---


### <div dir="rtl">5. <a name="SECTION5"></a>الملفاتالموجودةفيهذهالحزمة</div>

The following is a list of all of the files that should have been included in the archived copy of this script when you downloaded it, any files that may be potentially created as a result of your using this script, along with a short description of what all these files are for.

File                                       | Description
-------------------------------------------|--------------------------------------
/phpmussel.php                             | Loader file. Loads the main script, updater, etcetera. This is what you're supposed to be hooking into (essential)!
/web.config                                | An ASP.NET configuration file (in this instance, to protect the "/vault" directory from being accessed by non-authorised sources in the event that the script is installed on a server based upon ASP.NET technologies).
/_docs/                                    | Documentation directory (contains various files).
/_docs/change_log.txt                      | A record of changes made to the script between different versions (not required for proper function of script).
/_docs/readme.de.md                        | Documentation: DEUTSCH
/_docs/readme.de.txt                       | Documentation: DEUTSCH
/_docs/readme.en.md                        | Documentation: ENGLISH
/_docs/readme.en.txt                       | Documentation: ENGLISH
/_docs/readme.es.md                        | Documentation: ESPAÑOL
/_docs/readme.es.txt                       | Documentation: ESPAÑOL
/_docs/readme.fr.md                        | Documentation: FRANÇAIS
/_docs/readme.fr.txt                       | Documentation: FRANÇAIS
/_docs/readme.id.md                        | Documentation: BAHASA INDONESIA
/_docs/readme.id.txt                       | Documentation: BAHASA INDONESIA
/_docs/readme.it.md                        | Documentation: ITALIANO
/_docs/readme.it.txt                       | Documentation: ITALIANO
/_docs/readme.nl.md                        | Documentation: NEDERLANDSE
/_docs/readme.nl.txt                       | Documentation: NEDERLANDSE
/_docs/readme.pt.md                        | Documentation: PORTUGUÊS
/_docs/readme.pt.txt                       | Documentation: PORTUGUÊS
/_docs/readme.ru.md                        | Documentation: РУССКИЙ
/_docs/readme.ru.txt                       | Documentation: РУССКИЙ
/_docs/readme.vi.md                        | Documentation: TIẾNG VIỆT
/_docs/readme.vi.txt                       | Documentation: TIẾNG VIỆT
/_docs/readme.zh.md                        | Documentation: 中文（简体）
/_docs/readme.zh-TW.md                     | Documentation: 中文（傳統）
/_docs/signatures_tally.txt                | Net-shift tally of included signatures (not required for proper function of script).
/_testfiles/                               | Test files directory (contains various files). All contained files are test files for testing if phpMussel was correctly installed on your system, and you don't need to upload this directory or any of its files except when doing such testing.
/_testfiles/ascii_standard_testfile.txt    | Test file for testing phpMussel normalised ASCII signatures.
/_testfiles/coex_testfile.rtf              | Test file for testing phpMussel Complex Extended signatures.
/_testfiles/exe_standard_testfile.exe      | Test file for testing phpMussel PE signatures.
/_testfiles/general_standard_testfile.txt  | Test file for testing phpMussel general signatures.
/_testfiles/graphics_standard_testfile.gif | Test file for testing phpMussel graphics signatures.
/_testfiles/html_standard_testfile.txt     | Test file for testing phpMussel normalised HTML signatures.
/_testfiles/md5_testfile.txt               | Test file for testing phpMussel MD5 signatures.
/_testfiles/metadata_testfile.tar          | Test file for testing phpMussel metadata signatures and for testing TAR file support on your system.
/_testfiles/metadata_testfile.txt.gz       | Test file for testing phpMussel metadata signatures and for testing GZ file support on your system.
/_testfiles/metadata_testfile.zip          | Test file for testing phpMussel metadata signatures and for testing ZIP file support on your system.
/_testfiles/ole_testfile.ole               | Test file for testing phpMussel OLE signatures.
/_testfiles/pdf_standard_testfile.pdf      | Test file for testing phpMussel PDF signatures.
/_testfiles/pe_sectional_testfile.exe      | Test file for testing phpMussel PE Sectional signatures.
/_testfiles/swf_standard_testfile.swf      | Test file for testing phpMussel SWF signatures.
/_testfiles/xdp_standard_testfile.xdp      | Test file for testing phpMussel XML/XDP-Chunk signatures.
/vault/                                    | Vault directory (contains various files).
/vault/cache/                              | Cache directory (for temporary data).
/vault/cache/.htaccess                     | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/lang/                               | Contains phpMussel language data.
/vault/lang/.htaccess                      | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/lang/lang.de.inc                    | Language data: DEUTSCH
/vault/lang/lang.en.inc                    | Language data: ENGLISH
/vault/lang/lang.es.inc                    | Language data: ESPAÑOL
/vault/lang/lang.fr.inc                    | Language data: FRANÇAIS
/vault/lang/lang.id.inc                    | Language data: BAHASA INDONESIA
/vault/lang/lang.it.inc                    | Language data: ITALIANO
/vault/lang/lang.ja.inc                    | Language data: 日本語
/vault/lang/lang.nl.inc                    | Language data: NEDERLANDSE
/vault/lang/lang.pt.inc                    | Language data: PORTUGUÊS
/vault/lang/lang.ru.inc                    | Language data: РУССКИЙ
/vault/lang/lang.vi.inc                    | Language data: TIẾNG VIỆT
/vault/lang/lang.zh.inc                    | Language data: 中文（简体）
/vault/lang/lang.zh-TW.inc                 | Language data: 中文（傳統）
/vault/quarantine/                         | Quarantine directory (contains quarantined files).
/vault/quarantine/.htaccess                | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/.htaccess                           | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/ascii_clamav_regex.cvd              | File for normalised ASCII signatures.
/vault/ascii_clamav_regex.map              | File for normalised ASCII signatures.
/vault/ascii_clamav_standard.cvd           | File for normalised ASCII signatures.
/vault/ascii_clamav_standard.map           | File for normalised ASCII signatures.
/vault/ascii_custom_regex.cvd              | File for normalised ASCII signatures.
/vault/ascii_custom_standard.cvd           | File for normalised ASCII signatures.
/vault/ascii_mussel_regex.cvd              | File for normalised ASCII signatures.
/vault/ascii_mussel_standard.cvd           | File for normalised ASCII signatures.
/vault/coex_clamav.cvd                     | File for complex extended signatures.
/vault/coex_custom.cvd                     | File for complex extended signatures.
/vault/coex_mussel.cvd                     | File for complex extended signatures.
/vault/elf_clamav_regex.cvd                | File for ELF signatures.
/vault/elf_clamav_regex.map                | File for ELF signatures.
/vault/elf_clamav_standard.cvd             | File for ELF signatures.
/vault/elf_clamav_standard.map             | File for ELF signatures.
/vault/elf_custom_regex.cvd                | File for ELF signatures.
/vault/elf_custom_standard.cvd             | File for ELF signatures.
/vault/elf_mussel_regex.cvd                | File for ELF signatures.
/vault/elf_mussel_standard.cvd             | File for ELF signatures.
/vault/exe_clamav_regex.cvd                | File for PE (Portable Executable) signatures.
/vault/exe_clamav_regex.map                | File for PE (Portable Executable) signatures.
/vault/exe_clamav_standard.cvd             | File for PE (Portable Executable) signatures.
/vault/exe_clamav_standard.map             | File for PE (Portable Executable) signatures.
/vault/exe_custom_regex.cvd                | File for PE (Portable Executable) signatures.
/vault/exe_custom_standard.cvd             | File for PE (Portable Executable) signatures.
/vault/exe_mussel_regex.cvd                | File for PE (Portable Executable) signatures.
/vault/exe_mussel_standard.cvd             | File for PE (Portable Executable) signatures.
/vault/filenames_clamav.cvd                | File for filename signatures.
/vault/filenames_custom.cvd                | File for filename signatures.
/vault/filenames_mussel.cvd                | File for filename signatures.
/vault/general_clamav_regex.cvd            | File for general signatures.
/vault/general_clamav_regex.map            | File for general signatures.
/vault/general_clamav_standard.cvd         | File for general signatures.
/vault/general_clamav_standard.map         | File for general signatures.
/vault/general_custom_regex.cvd            | File for general signatures.
/vault/general_custom_standard.cvd         | File for general signatures.
/vault/general_mussel_regex.cvd            | File for general signatures.
/vault/general_mussel_standard.cvd         | File for general signatures.
/vault/graphics_clamav_regex.cvd           | File for graphics signatures.
/vault/graphics_clamav_regex.map           | File for graphics signatures.
/vault/graphics_clamav_standard.cvd        | File for graphics signatures.
/vault/graphics_clamav_standard.map        | File for graphics signatures.
/vault/graphics_custom_regex.cvd           | File for graphics signatures.
/vault/graphics_custom_standard.cvd        | File for graphics signatures.
/vault/graphics_mussel_regex.cvd           | File for graphics signatures.
/vault/graphics_mussel_standard.cvd        | File for graphics signatures.
/vault/greylist.csv                        | CSV of greylisted signatures indicating to phpMussel which signatures it should be ignoring (file automatically recreated if deleted).
/vault/hex_general_commands.csv            | Hex-encoded CSV of general command detections optionally used by phpMussel.
/vault/html_clamav_regex.cvd               | File for normalised HTML signatures.
/vault/html_clamav_regex.map               | File for normalised HTML signatures.
/vault/html_clamav_standard.cvd            | File for normalised HTML signatures.
/vault/html_clamav_standard.map            | File for normalised HTML signatures.
/vault/html_custom_regex.cvd               | File for normalised HTML signatures.
/vault/html_custom_standard.cvd            | File for normalised HTML signatures.
/vault/html_mussel_regex.cvd               | File for normalised HTML signatures.
/vault/html_mussel_standard.cvd            | File for normalised HTML signatures.
/vault/lang.inc                            | Language data.
/vault/macho_clamav_regex.cvd              | File for Mach-O signatures.
/vault/macho_clamav_regex.map              | File for Mach-O signatures.
/vault/macho_clamav_standard.cvd           | File for Mach-O signatures.
/vault/macho_clamav_standard.map           | File for Mach-O signatures.
/vault/macho_custom_regex.cvd              | File for Mach-O signatures.
/vault/macho_custom_standard.cvd           | File for Mach-O signatures.
/vault/macho_mussel_regex.cvd              | File for Mach-O signatures.
/vault/macho_mussel_standard.cvd           | File for Mach-O signatures.
/vault/mail_clamav_regex.cvd               | File for mail signatures.
/vault/mail_clamav_regex.map               | File for mail signatures.
/vault/mail_clamav_standard.cvd            | File for mail signatures.
/vault/mail_clamav_standard.map            | File for mail signatures.
/vault/mail_custom_regex.cvd               | File for mail signatures.
/vault/mail_custom_standard.cvd            | File for mail signatures.
/vault/mail_mussel_regex.cvd               | File for mail signatures.
/vault/mail_mussel_standard.cvd            | File for mail signatures.
/vault/md5_clamav.cvd                      | File for MD5 based signatures.
/vault/md5_custom.cvd                      | File for MD5 based signatures.
/vault/md5_mussel.cvd                      | File for MD5 based signatures.
/vault/metadata_clamav.cvd                 | File for archive metadata signatures.
/vault/metadata_custom.cvd                 | File for archive metadata signatures.
/vault/metadata_mussel.cvd                 | File for archive metadata signatures.
/vault/ole_clamav_regex.cvd                | File for OLE signatures.
/vault/ole_clamav_regex.map                | File for OLE signatures.
/vault/ole_clamav_standard.cvd             | File for OLE signatures.
/vault/ole_clamav_standard.map             | File for OLE signatures.
/vault/ole_custom_regex.cvd                | File for OLE signatures.
/vault/ole_custom_standard.cvd             | File for OLE signatures.
/vault/ole_mussel_regex.cvd                | File for OLE signatures.
/vault/ole_mussel_standard.cvd             | File for OLE signatures.
/vault/pdf_clamav_regex.cvd                | File for PDF signatures.
/vault/pdf_clamav_regex.map                | File for PDF signatures.
/vault/pdf_clamav_standard.cvd             | File for PDF signatures.
/vault/pdf_clamav_standard.map             | File for PDF signatures.
/vault/pdf_custom_regex.cvd                | File for PDF signatures.
/vault/pdf_custom_standard.cvd             | File for PDF signatures.
/vault/pdf_mussel_regex.cvd                | File for PDF signatures.
/vault/pdf_mussel_standard.cvd             | File for PDF signatures.
/vault/pe_clamav.cvd                       | File for PE Sectional signatures.
/vault/pe_custom.cvd                       | File for PE Sectional signatures.
/vault/pe_mussel.cvd                       | File for PE Sectional signatures.
/vault/pex_custom.cvd                      | File for PE extended signatures.
/vault/pex_mussel.cvd                      | File for PE extended signatures.
/vault/phpmussel.inc                       | Core Script; The main body and guts of phpMussel (essential)!
/vault/phpmussel.ini                       | Configuration file; Contains all the configuration options of phpMussel, telling it what to do and how to operate correctly (essential)!
※ /vault/scan_log.txt                     | A record of everything scanned by phpMussel.
※ /vault/scan_kills.txt                   | A record of every file upload blocked/killed by phpMussel.
/vault/swf_clamav_regex.cvd                | File for the Shockwave signatures.
/vault/swf_clamav_regex.map                | File for the Shockwave signatures.
/vault/swf_clamav_standard.cvd             | File for the Shockwave signatures.
/vault/swf_clamav_standard.map             | File for the Shockwave signatures.
/vault/swf_custom_regex.cvd                | File for the Shockwave signatures.
/vault/swf_custom_standard.cvd             | File for the Shockwave signatures.
/vault/swf_mussel_regex.cvd                | File for the Shockwave signatures.
/vault/swf_mussel_standard.cvd             | File for the Shockwave signatures.
/vault/switch.dat                          | Controls and sets certain variables.
/vault/template.html                       | Template file; Template for HTML output produced by phpMussel for its blocked file upload message (the message seen by the uploader).
/vault/template_custom.html                | Template file; Template for HTML output produced by phpMussel for its blocked file upload message (the message seen by the uploader).
/vault/update.dat                          | File containing version information for both the phpMussel script and the phpMussel signatures. If you ever want to automatically update phpMussel or want to update phpMussel via your browser, this file is essential.
/vault/update.inc                          | Update Script; Required for automatic updates and for updating phpMussel via your browser, but not required otherwise.
/vault/urlscanner.cvd                      | File for URL scanner signatures.
/vault/whitelist_clamav.cvd                | File specific whitelist.
/vault/whitelist_custom.cvd                | File specific whitelist.
/vault/whitelist_mussel.cvd                | File specific whitelist.
/vault/xmlxdp_clamav_regex.cvd             | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_clamav_regex.map             | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_clamav_standard.cvd          | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_clamav_standard.map          | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_custom_regex.cvd             | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_custom_standard.cvd          | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_mussel_regex.cvd             | File for XML/XDP-Chunk signatures.
/vault/xmlxdp_mussel_standard.cvd          | File for XML/XDP-Chunk signatures.

※ Filename may differ based on configuration stipulations (in ""phpmussel.ini"").

####*REGARDING SIGNATURE FILES*
CVD is an acronym for "ClamAV Virus Definitions", in reference both to how ClamAV refers to its own signatures and to the use of those signatures for phpMussel; Files ending with "CVD" contain signatures.

Files ending with "MAP", quite literally, map which signatures phpMussel should and shouldn't use for individual scans; Not all signatures are necessarily required for every single scan, so, phpMussel uses maps of the signature files to speed up the scanning process (a process that would otherwise be extremely slow and tedious).

Signature files marked with "_regex" contain signatures that utilise regular expression pattern checking (regex).

Signature files marked with "_standard" contain signatures that specifically don't utilise any form of pattern checking.

Signature files marked with neither "_regex" nor "_standard" will be as one or the other, but not both (refer to the شكلالتوقيع section of this README file for documentation and specific details).

Signature files marked with "_clamav" contain signatures that are sourced entirely from the ClamAV database (GNU/GPL).

Signature files marked with "_custom", by default, don't contain any signatures at all; These such files exist to give you somewhere to place your own custom signatures, if you come up with any of your own.

Signature files marked with "_mussel" contain signatures that specifically are not sourced from ClamAV, signatures which, generally, I've either come up with myself and/or based on information gathered from various sources.


---


### <div dir="rtl">6. <a name="SECTION6"></a>خياراتالتكوين/التهيئة</div>
The following is a list of variables found in the ""phpmussel.ini"" configuration file of phpMussel, along with a description of their purpose and function.

####"general" (Category)
General phpMussel configuration.

"script_password"
- As a convenience, phpMussel will allow certain functions (including the ability to update phpMussel on-the-fly) to be manually triggered via POST, GET and QUERY. However, as a security precaution, to do this, phpMussel will expect a password to be included with the command, as to ensure that it's you, and not someone else, attempting to manually trigger these functions. Set "script_password" to whatever password you would like to use. If no password is set, manual triggering will be disabled by default. Use something you will remember but which is hard for others to guess.
- Has no influence in CLI mode.

"logs_password"
- The same as "script_password", but for viewing the contents of scan_log and scan_kills. Having separate passwords can be useful if you want to give someone else access to one set of functions but not the other.
- Has no influence in CLI mode.

"cleanup"
- Unset variables and cache used by the script after the initial upload scanning? False = No; True = Yes [Default]. If you -aren't- using the script beyond the initial scanning of uploads, you should set this to "true" (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to "false" (no), to avoid unnecessarily reloading duplicate data into memory. In general practice, it should usually be set to "true", but, if you do this, you won't be able to use the script for anything other than the initial file upload scanning.
- Has no influence in CLI mode.

"scan_log"
- Filename of file to log all scanning results to. Specify a filename, or leave blank to disable.

"scan_kills"
- Filename of file to log all records of blocked or killed uploads to. Specify a filename, or leave blank to disable.

"ipaddr"
- Where to find IP address of connecting request? (Useful for services such as Cloudflare and the likes) Default = REMOTE_ADDR. WARNING: Don't change this unless you know what you're doing!

"forbid_on_block"
- Should phpMussel send 403 headers with the file upload blocked message, or stick with the usual 200 OK? False = No (200) [Default]; True = Yes (403).

"delete_on_sight"
- Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted file upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won't be touched. In the case of archives, the entire archive will be deleted, regardless of whether or not the offending file is only one of several files contained within the archive. For the case of file upload scanning, usually, it isn't necessary to enable this directive, because usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it'll usually delete any files uploaded through it to the server unless they've been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn't always behave in the manner expected. False = After scanning, leave the file alone [Default]; True = After scanning, if not clean, delete immediately.

"lang"
- Specify the default language for phpMussel.

"lang_override"
- Specify if phpMussel should, when possible, override the language specification with the language preference declared by inbound requests (HTTP_ACCEPT_LANGUAGE). False = No [Default]; True = Yes.

"lang_acceptable"
- The "lang_acceptable" directive tells phpMussel which languages may be accepted by the script from "lang" or from "HTTP_ACCEPT_LANGUAGE". This directive should **ONLY** be modified if you're adding your own customised language files or forcibly removing language files. The directive is a comma delimited string of the codes used by those languages accepted by the script.

"quarantine_key"
- phpMussel is able to quarantine flagged attempted file uploads in isolation within the phpMussel "vault", if this is something you want it to do. Casual users of phpMussel that simply wish to protect their websites or hosting environment without having any interest in deeply analysing any flagged attempted file uploads should leave this functionality disabled, but any users interested in further analysis of flagged attempted file uploads for malware research or for similar such things should enable this functionality. Quarantining of flagged attempted file uploads can sometimes also assist in debugging false-positives, if this is something that frequently occurs for you. To disable quarantine functionality, simply leave the "quarantine_key" directive empty, or erase the contents of that directive if it isn't already empty. To enable quarantine functionality, enter some value into the directive. The "quarantine_key" is an important security feature of the quarantine functionality required as a means of preventing the quarantine functionality from being exploited by potential attackers and as a means of preventing any potential execution of data stored within the quarantine. The "quarantine_key" should be treated in the same manner as your passwords: The longer the better, and guard it tightly. For best effect, use in conjunction with "delete_on_sight".

"quarantine_max_filesize"
- The maximum allowable filesize of files to be quarantined. Files larger than the value specified will NOT be quarantined. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value is in KB. Default =2048 =2048KB =2MB.

"quarantine_max_usage"
- The maximum memory usage allowed for the quarantine. If the total memory used by the quarantine reaches this value, the oldest quarantined files will be deleted until the total memory used no longer reaches this value. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value is in KB. Default =65536 =65536KB =64MB.

"honeypot_mode"
- When honeypot mode is enabled, phpMussel will attempt to quarantine every single file upload that it encounters, regardless of whether or not the file being uploaded matches any included signatures, and no actual scanning or analysis of those attempted file uploads will actually occur. This functionality should be useful for those that wish to use phpMussel for the purposes of virus/malware research, but it's neither recommended to enable this functionality if the intended use of phpMussel by the user is for actual file upload scanning, nor recommended to use the honeypot functionality for purposes other than honeypotting. By default, this option is disabled. False = Disabled [Default]; True = Enabled.

"scan_cache_expiry"
- For how long should phpMussel cache the results of scanning? Value is the number of seconds to cache the results of scanning for. Default is 21600 seconds (6 hours); A value of 0 will disable caching the results of scanning.

"disable_cli"
- Disable CLI mode? CLI mode is enabled by default, but can sometimes interfere with certain testing tools (such as PHPUnit, for example) and other CLI-based applications. If you don't need to disable CLI mode, you should ignore this directive. False = Enable CLI mode [Default]; True = Disable CLI mode.

####"signatures" (Category)
Signatures configuration.
- %%%_clamav = ClamAV signatures (both mains and daily).
- %%%_custom = Your custom signatures (if you've written any).
- %%%_mussel = phpMussel signatures included in your current signatures set that aren't from ClamAV.

Check against MD5 signatures when scanning? False = No; True = Yes [Default].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Check against general signatures when scanning? False = No; True = Yes [Default].
- "general_clamav"
- "general_custom"
- "general_mussel"

Check against normalised ASCII signatures when scanning? False = No; True = Yes [Default].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Check against normalised HTML signatures when scanning? False = No; True = Yes [Default].
- "html_clamav"
- "html_custom"
- "html_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE Sectional signatures when scanning? False = No; True = Yes [Default].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE extended signatures when scanning? False = No; True = Yes [Default].
- "pex_custom"
- "pex_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE signatures when scanning? False = No; True = Yes [Default].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Check ELF files against ELF signatures when scanning? False = No; True = Yes [Default].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Check Mach-O files (OSX, etc) against Mach-O signatures when scanning? False = No; True = Yes [Default].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Check graphics files against graphics based signatures when scanning? False = No; True = Yes [Default].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Check archive contents against archive metadata signatures when scanning? False = No; True = Yes [Default].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Check OLE objects against OLE signatures when scanning? False = No; True = Yes [Default].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Check filenames against filename based signatures when scanning? False = No; True = Yes [Default].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Allow scanning with phpMussel_mail()? False = No; True = Yes [Default].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Enable file specific whitelist? False = No; True = Yes [Default].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Check XML/XDP chunks against XML/XDP-chunk signatures when scanning? False = No; True = Yes [Default].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Check against complex extended signatures when scanning? False = No; True = Yes [Default].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Check against PDF signatures when scanning? False = No; True = Yes [Default].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Check against Shockwave signatures when scanning? False = No; True = Yes [Default].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Signature matching length limiting options. Only change these if you know what you're doing. SD = Standard signatures. RX = PCRE (Perl Compatible Regular Expressions, or "Regex") signatures. FN = Filename signatures. If you notice PHP crashing when phpMussel attempts to scan, try lowering these "max" values. If possible and convenient, let me know when this happens and the results of whatever you try.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Should phpMussel report when signatures files are missing or corrupted? If fail_silently is disabled, missing and corrupted files will be reported on scanning, and if fail_silently is enabled, missing and corrupted files will be ignored, with scanning reporting for those files that there aren't any problems. This should generally be left alone unless you're experiencing crashes or similar problems. False = Disabled; True = Enabled [Default].

"fail_extensions_silently"
- Should phpMussel report when extensions are missing? If fail_extensions_silently is disabled, missing extensions will be reported on scanning, and if fail_extensions_silently is enabled, missing extensions will be ignored, with scanning reporting for those files that there aren't any problems. Disabling this directive may potentially increase your security, but may also lead to an increase of false positives. False = Disabled; True = Enabled [Default].

"detect_adware"
- Should phpMussel parse signatures for detecting adware? False = No; True = Yes [Default].

"detect_joke_hoax"
- Should phpMussel parse signatures for detecting joke/hoax malware/viruses? False = No; True = Yes [Default].

"detect_pua_pup"
- Should phpMussel parse signatures for detecting PUAs/PUPs? False = No; True = Yes [Default].

"detect_packer_packed"
- Should phpMussel parse signatures for detecting packers and packed data? False = No; True = Yes [Default].

"detect_shell"
- Should phpMussel parse signatures for detecting shell scripts? False = No; True = Yes [Default].

"detect_deface"
- Should phpMussel parse signatures for detecting defacements and defacers? False = No; True = Yes [Default].

####"files" (Category)
File handling configuration.

"max_uploads"
- Maximum allowable number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn't account for or include the contents of archives.

"filesize_limit"
- Filesize limit in KB. 65536 = 64MB [Default]; 0 = No limit (always greylisted), any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.

"filesize_response"
- What to do with files that exceed the filesize limit (if one exists). False = Whitelist; True = Blacklist [Default].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist.
- Logical order of processing is:
 - If the filetype is whitelisted, don't scan and don't block the file, and don't check the file against the blacklist or the greylist.
 - If the filetype is blacklisted, don't scan the file but block it anyway, and don't check the file against the greylist.
 - If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the file as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the file as blacklisted, therefore not scanning it but blocking it anyway.

"check_archives"
- Attempt to check the contents of archives? False = Don't check; True = Check [Default].
- Currently, only checking of BZ, GZ, LZF and ZIP files is supported (checking of RAR, CAB, 7z and etcetera not currently supported).
- This is not foolproof! While I highly recommend keeping this turned on, I can't guarantee it'll always find everything.
- Also be aware that archive checking currently is not recursive for ZIPs.

"filesize_archives"
- Carry over filesize blacklisting/whitelisting to the contents of archives? False = No (just greylist everything); True = Yes [Default].

"filetype_archives"
- Carry over filetype blacklisting/whitelisting to the contents of archives? False = No (just greylist everything) [Default]; True = Yes.

"max_recursion"
- Maximum recursion depth limit for archives. Default = 10.

"block_encrypted_archives"
- Detect and block encrypted archives? Because phpMussel isn't able to scan the contents of encrypted archives, it's possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. False = No; True = Yes [Default].

####"attack_specific" (Category)
Attack-specific directives.

Chameleon attack detection: False = Off; True = On.

"chameleon_from_php"
- Search for PHP header in files that are neither PHP files nor recognised archives.

"chameleon_from_exe"
- Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect.

"chameleon_to_archive"
- Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Search for office documents whose headers are incorrect (Supported: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Search for images whose headers are incorrect (Supported: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Search for PDF files whose headers are incorrect.

"archive_file_extensions" and "archive_file_extensions_wc"
- Recognised archive file extensions (format is CSV; should only add or remove when problems occur; unnecessarily removing may cause false-positives to appear for archive files, whereas unnecessarily adding will essentially whitelist what you're adding from attack specific detection; modify with caution; also note that this has no effect on what archives can and can't be analysed at content-level). The list, as is at default, lists those formats used most commonly across the majority of systems and CMS, but intentionally isn't necessarily comprehensive.

"general_commands"
- Search content of files for general commands such as "eval()", "exec()" and "include()"? False = Don't check [Default]; True = Check. Disable this option if you intend to upload any of the following to your system or CMS via your browser: PHP, JavaScript, HTML, python, perl files and etcetera. Enable this option if you don't have any additional protections on your system and do not intend to upload such files. If you use additional security in conjunction with phpMussel such as ZB Block, there is no need to turn this option on, because most of what phpMussel will look for (in the context of this option) are duplications of protections that are already provided.

"block_control_characters"
- Block any files containing any control characters (other than newlines)? ("[\x00-\x08\x0b\x0c\x0e\x1f\x7f]") If you're _**ONLY**_ uploading plain-text, then you can turn this option on to provide some additional protection to your system. However, if you upload anything other than plain-text, turning this on may result in false positives. False = Don't block [Default]; True = Block.

"corrupted_exe"
- Corrupted files and parse errors. False = Ignore; True = Block [Default]. Detect and block potentially corrupted PE (Portable Executable) files? Often (but not always), when certain aspects of a PE file are corrupted or can't be parsed correctly, it can be indicative of a viral infection. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.

"decode_threshold"
- Optional limitation or threshold to the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues whilst scanning). Value is an integer representing filesize in KB. Default = 512 (512KB). Zero or null value disables the threshold (removing any such limitation based on filesize).

"scannable_threshold"
- Optional limitation or threshold to the length of raw data that phpMussel is permitted to read and scan (in case there are any noticeable performance issues whilst scanning). Value is an integer representing filesize in KB. Default = 32768 (32MB). Zero or null value disables the threshold. Generally, this value shouldn't be less than the average filesize of file uploads that you want and expect to receive to your server or website, shouldn't be more than the filesize_limit directive, and shouldn't be more than roughly one fifth of the total allowable memory allocation granted to PHP via the php.ini configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that'd prevent it from being able to successfully scan files above a certain filesize).

####"compatibility" (Category)
Compatibility directives for phpMussel.

"ignore_upload_errors"
- This directive should generally be disabled unless it's required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the "$_FILES" array(), it'll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. However, for some CMS, empty elements in "$_FILES" can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren't any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. False = OFF; True = ON.

"only_allow_images"
- If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don't require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it'll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. False = OFF; True = ON.

####"heuristic" (Category)
Heuristic directives.

"threshold"
- There are certain signatures of phpMussel that are intended to identify suspicious and potentially malicious qualities of files being uploaded without in themselves identifying those files being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious and potentially malicious qualities of files being uploaded that's allowable is before those files are to be flagged as malicious. The definition of weight in this context is the total number of suspicious and potentially malicious qualities identified. By default, this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious files being flagged, whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious files being flagged. It's generally best to leave this value at its default unless you're experiencing problems related to it.

####"virustotal" (Category)
VirusTotal.com directives.

"vt_public_api_key"
- Optionally, phpMussel is able to scan files using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses, trojans, malware and other threats. By default, scanning files using the Virus Total API is disabled. To enable it, an API key from Virus Total is required. Due to the significant benefit that this could provide to you, it's something that I highly recommend enabling. Please be aware, however, that to use the Virus Total API, you _**MUST**_ agree to their Terms of Service and you _**MUST**_ adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS:
 - You have read and agree to the Terms of Service of Virus Total and its API. The Terms of Service of Virus Total and its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/).
 - You have read and you understand, at a minimum, the preamble of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). The Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/).

Note: If scanning files using the Virus Total API is disabled, you won't need to review any of the directives in this category ("virustotal"), because none of them will do anything if this is disabled. To acquire a Virus Total API key, from anywhere on their website, click the "Join our Community" link located towards the top-right of the page, enter in the information requested, and click "Sign up" when done. Follow all instructions supplied, and when you've got your public API key, copy/paste that public API key to the "vt_public_api_key" directive of the ""phpmussel.ini"" configuration file.

"vt_suspicion_level"
- By default, phpMussel will restrict which files it scans using the Virus Total API to those files that it considers "suspicious". You can optionally adjust this restriction by changing the value of the "vt_suspicion_level" directive.
- "0": Files are only considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight. This would effectively mean that use of the Virus Total API would be for a second opinion for when phpMussel suspects that a file may potentially be malicious, but can't entirely rule out that it may also potentially be benign (non-malicious) and therefore would otherwise normally not block it or flag it as being malicious.
- "1": Files are considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight, if they're known to be executable (PE files, Mach-O files, ELF/Linux files, etc), or if they're known to be of a format that could potentially contain executable data (such as executable macros, DOC/DOCX files, archive files such as RARs, ZIPS and etc). This is the default and recommended suspicion level to apply, effectively meaning that use of the Virus Total API would be for a second opinion for when phpMussel doesn't initially find anything malicious or wrong with a file that it considers to be suspicious and therefore would otherwise normally not block it or flag it as being malicious.
- "2": All files are considered suspicious and should be scanned using the Virus Total API. I don't generally recommend applying this suspicion level, due to the risk of reaching your API quota much quicker than would otherwise be the case, but there are certain circumstances (such as when the webmaster or hostmaster has very little faith or trust whatsoever in any of the uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level, all files not normally blocked or flagged as being malicious would be scanned using the Virus Total API. Note, however, that phpMussel will cease using the Virus Total API when your API quota has been reached (regardless of suspicion level), and that your quota will likely be reached much faster when using this suspicion level.

Note: Regardless of suspicion level, any files that are either blacklisted or whitelisted by phpMussel won't be scanned using the Virus Total API, because those such files would've already been declared as either malicious or benign by phpMussel by the time that they would've otherwise been scanned by the Virus Total API, and therefore, additional scanning wouldn't be required. The ability of phpMussel to scan files using the Virus Total API is intended to build further confidence for whether a file is malicious or benign in those circumstances where phpMussel itself isn't entirely certain as to whether a file is malicious or benign.

"vt_weighting"
- Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists, because, although scanning a file using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious files being caught), it can also result in a higher number of false positives, and therefore, in some circumstances, the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0 is used, the results of scanning using the Virus Total API will be applied as detections, and therefore, if any engine used by Virus Total flags the file being scanned as being malicious, phpMussel will consider the file to be malicious. If any other value is used, the results of scanning using the Virus Total API will be applied as detection weighting, and therefore, the number of engines used by Virus Total that flag the file being scanned as being malicious will serve as a confidence score (or detection weighting) for whether or not the file being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0 is used by default.

"vt_quota_rate" and "vt_quota_time"
- According to the Virus Total API documentation, "it is limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient, honeypot or any other automation that is going to provide resources to VirusTotal and not only retrieve reports you are entitled to a higher request rate quota". By default, phpMussel will strictly adhere to these limitations, but due to the possibility of these rate quotas being increased, these two directives are provided as a means for you to instruct phpMussel as to what limit it should adhere to. Unless you've been instructed to do so, it's not recommended for you to increase these values, but, if you've encountered problems relating to reaching your rate quota, decreasing these values _**MAY**_ sometimes help you in dealing with these problems. Your rate limit is determined as "vt_quota_rate" requests of any nature in any given "vt_quota_time" minute time frame.

####"urlscanner" (Category)
URL scanner configuration.

"urlscanner"
- Built into phpMussel is a URL scanner, capable of detecting malicious URLs from within any data or files scanned. To enable the URL scanner, set the "urlscanner" directive to true; To disable it, set this directive to false.

Note: If the URL scanner is disabled, you won't need to review any of the directives in this category ("urlscanner"), because none of them will do anything if this is disabled.

URL scanner API lookup configuration.

"lookup_hphosts"
- Enables API lookups to the [hpHosts](http://hosts-file.net/) API when set to true. hpHosts doesn't require an API key for performing API lookups.

"google_api_key"
- Enables API lookups to the Google Safe Browsing API when the necessary API key is defined. Google Safe Browsing API lookups requires an API key, which can be obtained from [Here](https://console.developers.google.com/).
- Note: This is a future feature! Google Safe Browsing API lookup functionality not yet completed!

"maximum_api_lookups"
- Maximum allowable number of API lookups to perform per individual scan iteration. Because each additional API lookup will add to the total time required to complete each scan iteration, you may wish to stipulate a limitation in order to expedite the overall scan process. When set to 0, no such maximum allowable number will be applied. Set to 10 by default.

"maximum_api_lookups_response"
- What to do if the maximum allowable number of API lookups is exceeded? False = Do nothing (continue processing) [Default]; True = Flag/block the file.

"cache_time"
- How long (in seconds) should the results of API lookups be cached for? Default is 3600 seconds (1 hour).

####"template_data" (Category)
Directives/Variables for templates and themes.

Template data relates to the HTML output used to generate the "Upload Denied" message displayed to users upon a file upload being blocked. If you're using custom themes for phpMussel, HTML output is sourced from the "template_custom.html" file, and otherwise, HTML output is sourced from the "template.html" file. Variables written to this section of the configuration file are parsed to the HTML output by way of replacing any variable names circumfixed by curly brackets found within the HTML output with the corresponding variable data. For example, where "foo="bar"", any instance of "<p>{foo}</p>" found within the HTML output will become "<p>bar</p>".

"css_url"
- The template file for custom themes utilises external CSS properties, whereas the template file for the default theme utilises internal CSS properties. To instruct phpMussel to use the template file for custom themes, specify the public HTTP address of your custom theme's CSS files using the "css_url" variable. If you leave this variable blank, phpMussel will use the template file for the default theme.

---


### <div dir="rtl">7. <a name="SECTION7"></a>شكلالتوقيع</div>

####*FILENAME SIGNATURES*
All filename signatures follow the format:

"NAME:FNRX"

Where NAME is the name to cite for that signature and FNRX is the regex pattern to match filenames (unencoded) against.

####*MD5 SIGNATURES*
All MD5 signatures follow the format:

"HASH:FILESIZE:NAME"

Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of that file and NAME is the name to cite for that signature.

####*ARCHIVE METADATA SIGNATURES*
All archive metadata signatures follow the format:

"NAME:FILESIZE:CRC32"

Where NAME is the name to cite for that signature, FILESIZE is the total size (uncompressed) of a file contained within the archive and CRC32 is the CRC32 checksum of that contained file.

####*PE SECTIONAL SIGNATURES*
All PE Sectional signatures follow the format:

"SIZE:HASH:NAME"

Where HASH is the MD5 hash of a section of a PE file, SIZE is the total size of that section and NAME is the name to cite for that signature.

####*PE EXTENDED SIGNATURES*
All PE extended signatures follow the format:

"$VAR:HASH:SIZE:NAME"

Where $VAR is the name of the PE variable to match against, HASH is the MD5 hash of that variable, SIZE is the total size of that variable and NAME is the name to cite for that signature.

####*WHITELIST SIGNATURES*
All Whitelist signatures follow the format:

"HASH:FILESIZE:TYPE"

Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of that file and TYPE is the type of signatures the whitelisted file is to be immune against.

####*COMPLEX EXTENDED SIGNATURES*
Complex Extended signatures are rather different to the other types of signatures possible with phpMussel, in that what they are matching against is specified by the signatures themselves and they can match against multiple criteria. The match criterias are delimited by ";" and the match type and match data of each match criteria is delimited by ":" as so that format for these signatures tends to look a bit like:

"$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName"

####*EVERYTHING ELSE*
All other signatures follow the format:

"NAME:HEX:FROM:TO"

Where NAME is the name to cite for that signature and HEX is a hexadecimal-encoded segment of the file intended to be matched by the given signature. FROM and TO are optional parameters, indicating from which and to which positions in the source data to check against (not supported by the mail function).

####*REGEX*
Any form of regex understood and correctly processed by PHP should also be correctly understood and processed by phpMussel and its signatures. However, I'd suggest taking extreme caution when writing new regex based signatures, because, if you're not entirely sure what you're doing, there can be highly irregular and/or unexpected results. Take a look at the phpMussel source-code if you're not entirely sure about the context in which regex statements are parsed. Also, remember that all patterns (with exception to filename, archive metadata and MD5 patterns) must be hexadecimally encoded (foregoing pattern syntax, of course)!

####*WHERE TO PUT CUSTOM SIGNATURES?*
Only put custom signatures in those files intended for custom signatures. Those files should contain "_custom" in their filenames. You should also avoid editing the default signature files, unless you know exactly what you're doing, because, aside from being good practise in general and aside from helping you distinguish between your own signatures and the default signatures included with phpMussel, it's good to stick to editing only the files intended for editing, because tampering with the default signature files can cause them to stop working correctly, due to the "maps" files: The maps files tell phpMussel where in the signature files to look for signatures required by phpMussel as per when required, and these maps can become out-of-sync with their associated signature files if those signature files are tampered with. You can put pretty much whatever you want into your custom signatures, so long as you follow the correct syntax. However, be careful to test new signatures for false-positives beforehand if you intend to share them or use them in a live environment.

####*SIGNATURE BREAKDOWN*
The following is a breakdown of the types of signatures used by phpMussel:
- "Normalised ASCII Signatures" (ascii_*). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Complex Extended Signatures" (coex_*). Mixed signature type matching.
- "ELF Signatures" (elf_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to the ELF format.
- "Portable Executable Signatures" (exe_*). Checked against the contents of every non-whitelisted targeted for scanning and matched to the PE format.
- "Filename Signatures" (filenames_*). Checked against the filenames of files targeted for scanning.
- "General Signatures" (general_*). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Graphics Signatures" (graphics_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to a known graphical file format.
- "General Commands" (hex_general_commands.csv). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Normalised HTML Signatures" (html_*). Checked against the contents of every non-whitelisted HTML file targeted for scanning.
- "Mach-O Signatures" (macho_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to the Mach-O format.
- "Email Signatures" (mail_*). Checked against the $body variable parsed to the phpMussel_mail() function, which is intended to be the body of email messages or similar entities (potentially forum posts and etcetera).
- "MD5 Signatures" (md5_*). Checked against the MD5 hash of the contents and the filesize of every non-whitelisted file targeted for scanning.
- "Archive Metadata Signatures" (metadata_*). Checked against the CRC32 hash and filesize of the initial file contained inside of any non-whitelisted archive targeted for scanning.
- "OLE Signatures" (ole_*). Checked against the contents of every non-whitelisted OLE object targeted for scanning.
- "PDF Signatures" (pdf_*). Checked against the contents of every non-whitelisted PDF file targeted for scanning.
- "Portable Executable Sectional Signatures" (pe_*). Checked against the MD5 hash and the size of each PE section of every non-whitelisted file targeted for scanning and matched to the PE format.
- "Portable Executable Extended Signatures" (pex_*). Checked against the MD5 hash and the size of variables within every non-whitelisted file targeted for scanning and matched to the PE format.
- "SWF Signatures" (swf_*). Checked against the contents of every non-whitelisted Shockwave file targeted for scanning.
- "Whitelist Signatures" (whitelist_*). Checked against the MD5 hash of the contents and the filesize of every file targeted for scanning. Matched files will be immune to being matched by the type of signature mentioned in their whitelist entry.
- "XML/XDP-Chunk Signatures" (xmlxdp_*). Checked against any XML/XDP chunks found within any non-whitelisted files targeted for scanning.
(Note that any of these signatures may be easily disabled via ""phpmussel.ini"").

---


### <div dir="rtl">8. <a name="SECTION8"></a>مشاكلالتوافقالمعروفة</div>

####PHP and PCRE
- phpMussel requires PHP and PCRE to execute and function correctly. Without PHP, or without the PCRE extension of PHP, phpMussel won't execute or function correctly. Should make sure your system has both PHP and PCRE installed and available prior to downloading and installing phpMussel.

####ANTI-VIRUS SOFTWARE COMPATIBILITY

For the most part, phpMussel should be fairly compatible with most other virus scanning software. However, conflictions have been reported by a number of users in the past. This information below is from VirusTotal.com, and it describes a number of false-positives reported by various anti-virus programs against phpMussel. Although this information isn't an absolute guarantee of whether or not you will encounter compatibility problems between phpMussel and your anti-virus software, if your anti-virus software is noted as flagging against phpMussel, you should either consider disabling it prior to working with phpMussel or should consider alternative options to either your anti-virus software or phpMussel.

This information was last updated 7th September 2015 and is current for all phpMussel releases of the two most recent minor versions (v0.6-v0.7a) at the time of writing this.

| Scanner | Results |
|----------------------|--------------------------------------|
| Ad-Aware | No known problems |
| Agnitum | No known problems |
| AhnLab-V3 | No known problems |
| AntiVir | No known problems |
| Antiy-AVL | No known problems |
| Avast | Reports "JS:ScriptSH-inf [Trj]" |
| AVG | No known problems |
| Baidu-International | No known problems |
| BitDefender | No known problems |
| Bkav | Reports "VEXDAD2.Webshell" |
| ByteHero | No known problems |
| CAT-QuickHeal | No known problems |
| ClamAV | No known problems |
| CMC | No known problems |
| Commtouch | No known problems |
| Comodo | No known problems |
| DrWeb | No known problems |
| Emsisoft | No known problems |
| ESET-NOD32 | No known problems |
| F-Prot | No known problems |
| F-Secure | No known problems |
| Fortinet | No known problems |
| GData | No known problems |
| Ikarus | No known problems |
| Jiangmin | No known problems |
| K7AntiVirus | No known problems |
| K7GW | No known problems |
| Kaspersky | No known problems |
| Kingsoft | No known problems |
| Malwarebytes | No known problems |
| McAfee | Reports "New Script.c" |
| McAfee-GW-Edition | Reports "New Script.c" |
| Microsoft | No known problems |
| MicroWorld-eScan | No known problems |
| NANO-Antivirus | No known problems |
| Norman | No known problems |
| nProtect | No known problems |
| Panda | No known problems |
| Qihoo-360 | No known problems |
| Rising | No known problems |
| Sophos | No known problems |
| SUPERAntiSpyware | No known problems |
| Symantec | No known problems |
| TheHacker | No known problems |
| TotalDefense | No known problems |
| TrendMicro | No known problems |
| TrendMicro-HouseCall | No known problems |
| VBA32 | No known problems |
| VIPRE | No known problems |
| ViRobot | No known problems |


---


Last Updated: 5th December 2015 (2015.12.05).
