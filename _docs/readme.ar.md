## <div dir="rtl">phpMussel بالعربية</div>

### <div dir="rtl">المحتويات:</div>
<div dir="rtl"><ul>
 <li>1. <a href="#SECTION1">مقدمة</a></li>
 <li>2-أ. <a href="#SECTION2A">التحميل(لخدمات الويب).</a></li>
 <li>2-ب. <a href="#SECTION2B">التحميل(واجهة سطر الأوامر).</a></li>
 <li>3-أ. <a href="#SECTION3A">كيفية الإستخدام (لخدمات الويب).</a></li>
 <li>3-ب. <a href="#SECTION3B">كيفية الإستخدام (واجهة سطر الأوامر).</a></li>
 <li>4-أ. <a href="#SECTION4A">أوامرالمتصفح.</a></li>
 <li>4-ب. <a href="#SECTION4B">واجهة سطر الأوامر(CLI) .</a></li>
 <li>5. <a href="#SECTION5">الملفات الموجودة في هذه الحزمة.</a></li>
 <li>6. <a href="#SECTION6">خيارات التكوين/التهيئة.</a></li>
 <li>7. <a href="#SECTION7">شكل/تنسيق التوقيع.</a></li>
 <li>8. <a href="#SECTION8">مشاكل التوافق الشائعة.</a></li>
</ul></div>

---


### <div dir="rtl">1. <a name="SECTION1"></a>مقدمة</div>

<div dir="rtl">شكراً لك على إستخدام phpMussel، المبرمج بلغة php للكشف عن ملفات الإختراق والفيروسات والبرمجيات الخبيثة الموجودة حيث يعتمد السكربت على توقيعات ClamAV وغيرها.<br /><br /></div>

<div dir="rtl">حقوق النشر محفوظة ل phpMussel لعام 2013 وما بعده تحت رخصة GNU/GPLv2 للمبرمج (Caleb M (Maikuolan.<br /><br /></div>

<div dir="rtl">هذا البرنامج مجاني، يمكنك تعديله وإعادة نشره تحت رخصة GNU.<br /><br /></div>

<div dir="rtl">نشارك هذا السكربت على أمل أن تعم الفائدة لكن لا نتحمل أية مسؤولية أو أية ضمانات لاستخدامك، اطلع على تفاصيل رخصة GNU للمزيد من المعلومات عبر الملف LICENSE.txt وللمزيد من المعلومات :</div>
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

<div dir="rtl">شكر خاص ل<a href="http://www.clamav.net/">ClamAV</a> لكل من الإلهام للمشروع والتواقيع التي يعمد عليها السكربت، والتي من دونها كان من الممكن أن لا يتم إنجاز هذا البرنامج أو بأفضل الأحوال ستكون قيمته محدودة جداً. <br /><br /></div>

<div dir="rtl">شكر خاص أيضاً ل Sourceforge و GitHub لإستضافتهم ملفات المشروع، و <a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">Spambot Security</a> لإستضافة phpMussel لمنتديات المناقشة، وأيضاً لمصادر التوقيعات التي يستخدمها phpMussel مثل : <a href="http://www.securiteinfo.com/">SecuriteInfo.com</a> و <a href="http://www.phishtank.com/">PhishTank</a>  و <a href="http://nlnetlabs.nl/">NLNetLabs</a> وغيرهم، والشكر مقدم لكل من يدعم المشروع وشكراً لك لاستخدامك للسكربت. <br /><br /></div>
 
<div dir="rtl">هذا المستند و الحزم المرتبطة به يمكن تحميلها مجاناً من:</div>
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


### <div dir="rtl">2-أ. <a name="SECTION2A"></a>كيفية التحميل (لخدمات الويب)</div>

<div dir="rtl">أرجو أن يتم تسهيل هذه العملية في المستقبل القريب، لكن في الوقت الحالي إتبع هذه التعليمات والتي تعمل على أغلب الأنظمة وأنظمة إدارة المحتوى CMS : <br /><br /></div>

<div dir="rtl">1_بقراءتك لهذا سنفرض بأنك قمت بتحميل السكربت، من هنا عليك العمل على جهازك المحلي أو نظام إدارة المحتوى لإضافة هذه الأمور، مجلد مثل "/public_html/phpmussel/" أو ما شابه سيكون كاف.<br /><br /></div>

<div dir="rtl">2_هذه الخطوة اختيارية ينصح بها للمستخدمين المتقدمين ولا ينصح بها للمبتدئين، إفتح phpmussel.ini الموجود داخل vault هذا الملف يحتوي جميع التعليمات ل phpMussel، أعلى كل خيار يوجد وصف مختصر للوظيفة التي يقوم بها، عدل الخيارات كما يناسبك.<br /><br /></div>

<div dir="rtl">3_إرفع الملفات للمجلد الذي اخترته(لست بحاجة لرفع *.txt-*.md لكن في الغالب يجب أن ترفع جميع الملفات).<br /><br /></div>

<div dir="rtl">4_غير التصريح لمجلد vault للتصريح 777. المجلد الرئيسي الذي يحتوي على الملفات-المجلد الذي اخترته سابقاً-، بالعادة يمكن تجاهله، لكن يجب التأكد من التصريح إذا واجهت مشاكل في الماضي(إفتراضيا يجب أن يكون 755).<br /><br /></div>

<div dir="rtl">5_الآن أنت بحاجة لربط phpMussel لنظام إدارة المحتوى أو النظام الذي تستخدمه, هناك عدة طرق لفعل هذا لكن أسهل طريقة ببساطة إضافة السكربت لبداية النواة في نظامك (سيتم إعادة التحميل لكل وصول لأي صفحة في الموقع) بإستخدام جمل require أو include, بالعادة سيتم التخزين في  /includes, /assets أو /functions, وسيتم تسميته بالغالب مثل: init.php, common_functions.php, functions.php أو ما شابه.
من الممكن أن تكون مستخدم ل CMS لذا يمكن أن أقدم بعض المساعدة بخصوص هذا الموضوع, لإستخدام require أو include قم بإضافة الكود التالي لبداية الملف الرئيسي لبرنامجك, عدل النص الموجود داخل علامات التنصيص لمسار phpmussel.php لديك.<br /><br /></div>

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

<div dir="rtl">إحفظ الملف ثم قم بإعادة رفعه.<br /><br /></div>

<div dir="rtl">--أو بدلاً من ذلك--<br /><br /></div>

<div dir="rtl">إذا كنت تستخدم Apache webserver وتستطيع الوصول ل php.ini، بإستطاعتك إستخدام auto_prpend_file للتوجيه ل phpMussel لكل طلب مثل:<br /><br /></div>

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

<div dir="rtl">أو هذا في ملف ".htaccess":<br /><br /></div>

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

<div dir="rtl">6_لقد إنتهيت لكن يجب عليك التأكد من أن كل شيئ على ما يرام، للتأكد حاول رفع ملفات الفحص الموجودة في الحزمة _testfiles لموقعك، إذا كل شيئ يعمل على ما يرام يجب أن تظهر رسالة من phpMussel لتأكيد على أنه تم حجب الملفات المرفوعة بنجاح، إذا لم يظهر شيئ إذاً هناك شيئ لا يعمل على ما يرام، إذا كنت تستخدم إضافات متقدمة أو أدوات فحص أخرى أقترح أن تجرب من خلالهم أيضاً للتأكد إذا ما كان كل شيئ على ما يرام.<br /><br /></div>

---


### <div dir="rtl">2-ب. <a name="SECTION2B"></a>كيفية التحميل (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">أرجو أن يتم تسهيل هذه العملية في المستقبل القريب، لكن في الوقت الحالي إتبع هذه التعليمات للعمل من خلال واجهة سطر الأوامر(في الوقت الحالي واجهة سطر الأوامر تدعم فقط أنظمة ويندوز سيتم دعم لينكس والأنظمة الأخرى في الإصدار القادم).<br /><br /></div>

<div dir="rtl">1_بقراءتك لهذا سنفرض بأنك قمت بتحميل السكربت،  من هنا عليك العمل على جهازك المحلي.<br /><br /></div>

<div dir="rtl">2_ يتطلب phpMussel أن يتم تثبيت PHP على الجهاز المضيف من أجل تنفيذه. إذا لم يكن PHP مثبتا على جهازك، الرجاء قم بتثبيت PHP على جهازك، و اتبع أي تعليمات يقدمها مثبت PHP.<br /><br /></div>

<div dir="rtl">3_هذه الخطوة اختيارية ينصح بها للمستخدمين المتقدمين ولا ينصح بها للمبتدئين،إفتح phpmussel.ini الموجود داخل vault هذا الملف يحتوي جميع التعليمات ل phpMussel، أعلى كل خيار يوجد وصف مختصر للوظيفة التي يقوم بها، عدل الخيارات كما يناسبك.
<br /><br /></div>

<div dir="rtl">4_بشكل إختياري، يمكنك إستخدام phpMussel لواجهة سطر الأوامر بإنشاء ملف "باتش" لتحميل php و phpMussel تلقائياً، للقيام بهذا إفتح محرر النصوص مثل Notepad++ ثم أكتب المسار الكامل لملف php.exe الموجود في دليل التثبيت متبوع بمسافة ثم المسار الكامل لملف phpmussel1.php احفظ الملف بصيغة bat.، إفتح الملف الذي قمت بإنشاءه لتشغيل phpMussel في المستقبل. <br /><br /></div>

<div dir="rtl">5) في هذه المرحلة، لقد انتهيت! ومع ذلك فربما يجب عليك اختباره للتأكد من أنه يعمل بشكل صحيح. لاختبار phpMussel، قم بتشغيله و حاول فحص الدليل "_testfiles" المتوفر مع الحزمة.<br /><br /></div>

---


### <div dir="rtl">3-أ. <a name="SECTION3A"></a>كيفية الإستخدام (لخدمات الويب)</div>

<div dir="rtl">لقد تم إعداد phpMussel ليكون البرنامج النصي الذي سوف يعمل بشكل مرضي على جهازك مع الحد الأدنى من المتطلبات على جهازك: بمجرد تثبيته -بشكلي أساسي- فإنه ببساطة يجب أن يعمل.<br /><br /></div>

<div dir="rtl">سيتم فحص الملفات تلقائياً لقد تم إعداده إفتراضياً لذا ليس عليك القيام بشيئ.<br /><br /></div>

<div dir="rtl">مع ذلك، فإنك قادراً أيضاً على إرشاد phpMussel لمسح ملفات معينة مثل الدلائل و/ أو المحفوظات. للقيام بذلك فعليك أولاً: سوف تحتاج إلى التأكد من أن يتم تعيين التكوين المناسب في ملف "phpmussel.ini" (يجب تعطيل عملية التنظيف) وعندما تنتهي من ذلك، في ملف PHP و الذي تم ربطه مع phpMussel، استخدم الدالة التالية في التعليمة البرمجية "الكود" الذي ستضعه:<br /><br /></div>

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`


<div dir="rtl"><ul>
 <li>"$what_to_scan" يمكن أن تكون سلسلة، مصفوفة، أو مجموعة من المصفوفات، وتشير إلى أي ملف/ملفات، دليل و/أو دلائل ليتم إجراء المسح عليها.</li>
 <li>"$output_type" هي قيمة منطقية تدل على نتائج الفحص ليتم إرجاعها كالتالي، الخطأ يرشد الدالة لإرجاع نتائج الفحص على شكل عدد (النتائج المرجعة -3 تشير إلى مشاكل واجهها phpMussel مع التوقيعات أو ملفات خريطة التوقيع و التي من الممكن أن تكون مفقودة أو تالفة، -2 تشير إلى أنه تم الكشف عن بيانات تالفة خلال الفحص وبالتالي فشل في إكمال الفحص، 0 يشير إلى أن هدف الفحص غير موجود و بالتالي لم تكن هناك حاجة لعملية الفحص، 1 يشير إلى أن الهدف تم فحصه بنجاح و لم يتم الكشف عن أي مشاكل، 2 يشير إلى أن الهدف تم فحصه بنجاح و تم الكشف عن مشاكل. القيمة الصحيحة ترشد الدالة لإرجاع نتائج الفحص كنص مقروء للبشر. بالإضافة إلى ذلك، في كلتا الحالتين، يمكن الوصول إلى النتائج عبر المتغيرات العالمية بعد اكتمال الفحص. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
 <li>"$output_flatness" هي قيمة منطقية تشير إلى دالة بالعودة لنتائج الفحص من النوعين (عندما يكون هناك أهداف فحص متعددة)، سواء خاطئة فتعود النتائج على شكل مصفوفة، أو صحيحة فتعود النتائج على شكل سلسلة. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
</ul></div>

<div dir="rtl">أمثلة:<br /><br /></div>

```
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

<div dir="rtl">يتحول كالتالي (كسلسلة):<br /><br /></div>

```
 Wed, 16 Sep 2013 02:49:46 +0000 Started.
 > Checking '/user_name/public_html/my_file.html':
 -> No problems found.
 Wed, 16 Sep 2013 02:49:47 +0000 Finished.
```

<div dir="rtl">للحصول على مفعول كامل لأي من التوقيعات التي يستخدمها phpMussel أثناء التفحص، وكيف يتعامل مع هذه التوقيعات، راجع قسم (7) شكل/صيغة التوقيع في هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">إذا واجهت أي إيجابيات زائفة أي إذا واجهت شيئا جديدا تعتقد أنه يجب أن يكون قد تم حظره أو أي شيء آخر بخصوص التوقيعات، فيرجى الاتصال بي لإبلاغي عن ذلك حتى أستطيع إجراء التغييرات اللازمة، والتي إذا لم تقوم بالاتصال بي، فإنني قد لا أكون منتبه لها.<br /><br /></div>

<div dir="rtl">لتعطيل التواقيع التي يتضمنها phpMussel (مثل إذا كنت تعاني من إيجابية زائفة محددة لأغراضك التي لا ينبغي أن يتم عادة إزالتها)، فارجع إلى القائمة الرمادية ضمن قسم أوامرالمتصفح من هذا الملف التمهيدي.<br /><br /></div>

---


### <div dir="rtl">3ب. <a name="SECTION3B"></a>كيفية الاستخدام (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">يرجى الرجوع إلى قسم "التحميل (لخدمات واجهة سطر الأوامر)" من هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">يجب أن تدرك أنه على الرغم من أن الإصدارات المستقبلية من phpMussel ينبغي أن تدعم الأنظمة الأخرى، لكن في هذا الوقت phpMussel CLI في وضعه الأمثل يدعم فقط الاستخدام على نظام Windows (يمكنك بطبيعة الحال محاولة استخدامه على الأنظمة الأخرى، ولكن لا أستطيع أن أضمن لك أنه سوف يعمل على النحو المنشود).<br /><br /></div>

<div dir="rtl">كما يجب أن تدرك أن phpMussel ليس المكافئ الوظيفي لمجموعة متكاملة من مضاد الفيروسات، وعلى عكس البرامج التقليدية لمكافحة الفيروسات فإنها لا تراقب الذاكرة النشطة أو الكشف عن الفيروسات بشكل مباشر و على الطاير! لكنها سوف تكشف عن الفيروسات فقط الواردة في تلك الملفات المحددة التي طلبت منه فحصها.<br /><br /></div>

---


### <div dir="rtl">4أ. <a name="SECTION4A"></a>أوامرالمتصفح</div>

<div dir="rtl">بمجرد أن تم تثبيت phpMussel و يعمل بشكل صحيح على النظام الخاص بك، فإذا قمت بضبط المتغيرات "script_password" و "logs_password" في ملف التكوين الخاص بك، ستكون قادرة على أداء بعض من الوظائف الإدارية المحدودة و إدخال بعض من الأوامر لـphpMussel عبر متصفحك.السبب في أن كلمات السر هذه يجب وضعها من أجل تمكين هذه الضوابط من جانب المتصفح لضمان الأمن السليم، سواء للحماية المناسبة من هذه الضوابط من جانب المتصفح و كذلك لضمان أن هناك وسيلة لهذه الضوابط من جانب المتصفح ليكون معطل تماما إذا لم يتم طلبه من قبلك و/أو مشرفي المواقع الأخرى الذين يستخدمون phpMussel. لذلك، وبعبارة أخرى، لتمكين هذه الضوابط قم بتعيين كلمة مرور، و لتعطيل هذه الضوابط لا تقم بتعيين أية كلمة مرور. بدلا من ذلك، إذا أردت تمكين هذه الضوابط و من ثم تعطيل هذه الضوابط في وقت لاحق، هناك أمر للقيام بذلك (مثل هذا يمكن أن يكون مفيد اًإذا قمت بإجراء بعض الإجراءات التي تشعر باحتمالية أن تؤثر سلبا على كلمات السر المفوضة وتحتاج إلى تعطيل هذه الضوابط بسرعة دون تعديل ملف التكوين الخاص بك).<br /><br /></div>

<div dir="rtl">يجب عليك <strong>تفعيل</strong> هذه الضوابط لمجموعة أسباب:<br /></div>
<div dir="rtl"><ul>
 <li>يوفر وسيلة للتوقيعات الموجودة في القائمة الرمادية على الفور في حالات مثل عندما تكتشف توقيع ينتج إيجابية كاذبة(أي أنه صنف الملف على أنه تحت تأثير الفايروس و لكن في الحقيقة أن الملف سليم و غير مصاب بالفايروس) أثناء تحميل الملفات على النظام الخاص بك و ليس لديك الوقت لتعديل وإعادة رفع ملف القائمة الرمادية يدويا.</li>
 <li>يوفر لك طريقة لتمكن شخص غيرك من التحكم في نسختك من phpMussel دون الحاجة لمنحهم إمكانية الوصول إلى بروتوكول نقل الملفات.</li>
 <li>يوفر طريقة لتوفير مراقب إلى سجل ملفاتك.</li>
 <li>يوفر طريقة لتتمكن من مراقبة phpMussel عند عدم توفر مراقبة من FTPأ و نقاط الوصول التقليدية الأخرى.</li>
</ul></div>

<div dir="rtl">كذلك يجب عليك <strong>عدم تفعيل</strong> هذه الضوابط لمجموعة أسباب:<br /></div>
<div dir="rtl"><ul>
 <li>يوفر ناقل للمهاجمين المحتملين وغير المرغوب فيهم لتحديد ما إذا كنت تستخدم phpMussel أم لا (على الرغم من أن هذا يمكن أن يكون سبب لها أو ضدها بناء على نوعيتها) عن طريق إرسال أوامر بصورة عمياء إلى الخادم كوسيلة لفحص. من جهة فيمكن أن يثني المهاجمين من استهداف النظام الخاص بك إذا كانوا يعلمون أنك تستخدم phpMussel على افتراض أنهم يفحصون و وجدوا أن طريقة هجومهم ستكون غير فعالة نتيجة لاستخدام phpMussel. مع ذلك فمن ناحية أخرى، فقد يمكن استغلال بعض المداخل غير المتوقعة وغير المعروفة حاليا داخل phpMussel أو في إصدار لاحق من البرنامج، فمن المحتمل أن توفر ناقلات لهجومهم، كنتيجة إيجابية من مثل هذا الفحص (أي أنهم يجدون مدخل أو ثغرة في البرنامج) في الواقع يمكن أن تشجع المعتدين على استهداف النظام الخاص بك.</li>
 <li>إذا تعرضت كلمات السر التي قمت بتعيينها للخطر في أي وقت، إلا إذا تغيرت، فيمكن أن توفر وسيلة للمهاجمين لتجاوز كل ما قد تكون التوقيعات كفيلة عادة بمنع هجماتهم من النجاح، أو حتى يحتمل تعطيل phpMussel تماما، وبالتالي توفير وسيلة لجعل فعالية phpMussel شكلية غير فعالة.</li>
</ul></div>

<div dir="rtl">في كلتا الحالتين بغض النظر عن ما اخترت والخيار في النهاية لك، فإنه بشكل افتراضي سيتم تعطيل هذه الضوابط، ولكن فكر في ذلك، وإذا قررت أنك تريدهم، فهذا القسم يوضح كل من كيفية تمكينها وكيفية استخدامها.<br /><br /></div>

<div dir="rtl">قائمة الأوامر المتاحة من جانب متصفح:<br /><br /></div>

<div dir="rtl">scan_log<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password"</li>
 <li>متطلبات أخرى: يجب ضبط "scan_log".</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?logspword=[logs_password]&phpmussel=scan_log"</li>
 <li>ماذا يفعل: إظهار محتويات ملف (سجل الفحص) `scan_log` إلى الشاشة.</li>
</ul></div>

<div dir="rtl">scan_log_serialized<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password"</li>
 <li>متطلبات أخرى: يجب ضبط "scan_log_serialized".</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?logspword=[logs_password]&phpmussel=scan_log_serialized"</li>
 <li>ماذا يفعل: إظهار محتويات ملف (سجل الفحص) `scan_log_serialized` إلى الشاشة.</li>
</ul></div>

<div dir="rtl">scan_kills<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password"</li>
 <li>متطلبات أخرى: يجب ضبط `scan_kills`.</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?logspword=[logs_password]&phpmussel=scan_kills"</li>
 <li>ماذا يفعل: إظهار محتويات ملف (تعطل الفحص) `scan_kills` إلى الشاشة.</li>
</ul></div>

<div dir="rtl">controls_lockout (قفل التحكم)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "logs_password" أو "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال 1: "?logspword=[logs_password]&phpmussel=controls_lockout"</li>
 <li>مثال 2: "?pword=[script_password]&phpmussel=controls_lockout"</li>
 <li>ماذا يفعل: تعطل جميع عناصر التحكم من قبل المتصفح. هذا ينبغي أن تستخدم إذا كنت تظن أن أي من كلمات السر الخاصة بك قد تم اختراقها (هذا يمكن أن يحدث إذا كنت تستخدم هذه الضوابط من جهاز كمبيوتر ليس آمن و/أو غير موثوق). "controls_lockout" (قفل التحكم) يعمل عن طريق إنشاء ملف يسمى (controls.lck) في مجلد خاص و الذي سوف يقوم phpMussel بالتحقق من خلاله قبل تنفيذ أي أوامر من أي نوع. عندما يحدث هذا فإنك لإعادة تمكين الضوابط، ستحتاج إلى حذف الملف (controls.lck) يدويا عبر بروتوكول نقل الملفات أو ما شابه ذلك و الذي يمكن استدعاءه باستخدام كلمة مرور.</li>
</ul></div>

<div dir="rtl">disable (تعطل)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=disable"</li>
 <li>ماذا يفعل: تعطيل phpMussel. هذا ينبغي أن تستخدم إذا كنت تود بالقيام بأي تحديثات أو تغييرات على النظام الخاص بك أو يمكن إذا كنت تقوم بتثبيت أي برنامج جديد أو وحدات لنظامك فإما أن يفعل أو يحتمل أن يؤدي لفحص خاطئ (أن يعطي الفحص نتيجة بان البرنامج مصاب بالفايروس و هو غير ضار أو غير مصاب فعلياً). ينبغي أن يستخدم أيضا إذا كنت تواجه أي مشاكل مع phpMussel ولكن لا ترغب في إزالته من النظام الخاص بك. عندما يحدث هذا، لإعادة تمكين phpMussel، استخدم "تمكين".</li>
</ul></div>

<div dir="rtl">enable (تمكين)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: (لا يوجد)</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=enable"</li>
 <li>ماذا يفعل: تمكين phpMussel. هذا ينبغي أن تستخدم إذا كنت قد قمت بتعطيل phpMussel مسبقاً باستخدام "تعطيل" و تود إعادة تمكينه.</li>
</ul></div>

<div dir="rtl">update (تحديث)<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور مطلوبة: "script_password"</li>
 <li>متطلبات أخرى: يجب أن تكون update.dat و update.php موجودة.</li>
 <li>المعاملات المطلوبة: (لا يوجد)</li>
 <li>المعاملات الاختيارية: (لا يوجد)</li>
 <li>مثال: "?pword=[script_password]&phpmussel=update"</li>
 <li>ماذا يفعل: البحث عن التحديثات لكلاً من phpMussel و توقيعاته. إذا نجحت الفحوصات و أشارات لوجود تحديث، فستحاول تحميل وتثبيت هذه التحديثات. إذا فشلت الفحوصات بإيجاد التحديث، فسوف تحبط عملية التحديث و تظهر نتائج العملية برمتها إلى الشاشة. أنا أوصي بالفحص مرة واحدة على الأقل في الشهر لضمان أن يتم الاحتفاظ بالتوقيعات الخاصة بك ونسختك من phpMussel حديثة (باستثناء أن تكون قد قمت بالتحقق من التحديثات وتثبيتها يدويا والتي كنت و لا زلت أوصي به مرة واحدة في الشهر على الأقل). فحص أكثر من مرتين في الشهر ربما لا فائدة منه بإعتبار أنني أستبعد جدا أن أكون قادر على إنتاج التحديثات أياً كان نوعها في كثير من الأحيان لأكثر من مرة في الشهر (لا سيما الجزء الأكبر منهاً).</li>
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

<div dir="rtl">يمكن تشغيل phpMussel باعتباره برنامج فحص ملفات تفاعلي في وضع CLI في ظل النظم المستندة إلى Windows. راجع قسم "كيفية التثبيت (لواجهة سطر الاوامر)" من هذا الملف التمهيدي لمزيد من التفاصيل.<br /><br /></div>

<div dir="rtl">للحصول على قائمة الأوامر المتاحة لواجهة سطر الأوامر، اكتب "c" في موجه واجهة سطر الأوامر واضغط "دخول" Enter.<br /><br /></div>

---


### <div dir="rtl">5. <a name="SECTION5"></a>الملفاتالموجودةفيهذهالحزمة</div>

<div dir="rtl">فيما يلي قائمة بجميع الملفات التي ينبغي أن تدرج في النسخة المحفوظة من هذا البرنامج النصي عند تحميله، أي الملفات التي يمكن أن يحتمل أن تكون نشأت نتيجة استعمالك لهذا البرنامج النصي، بالإضافة إلى وصفا موجزا لدور و وظيفة كل ملف.<br /><br /></div>

الوصف | الملف
----|----
<div dir="rtl" style="display:inline;">أ ملف المشروع GitHub (غير مطلوب لتشغيل سليم للبرنامج).</div> | /.gitattributes
<div dir="rtl" style="display:inline;">سجل للتغييرات التي أجريت على البرنامج بين التحديثات المختلفة (غير مطلوب لتشغيل سليم للبرنامج).</div> | /Changelog-v1.txt
<div dir="rtl" style="display:inline;">معلومات Composer/Packagist (غير مطلوب لتشغيل سليم للبرنامج).</div> | /composer.json
<div dir="rtl" style="display:inline;">معلومات حول كيفية المساهمة في المشروع.</div> | /CONTRIBUTING.md
<div dir="rtl" style="display:inline;">نسخة من GNU/GPLv2 رخصة.</div> | /LICENSE.txt
<div dir="rtl" style="display:inline;">معلومات حول الأشخاص الذين شاركوا في المشروع.</div> | /PEOPLE.md
<div dir="rtl" style="display:inline;">الملف المحمل (المسئول عن التحميل): يحمل البرنامج الرئيسي و التحديث و، إلى آخره. هذا هو الذي من المفترض أن تكون على علاقة به و تقوم بتركيبه (أساسي)!</div> | /phpmussel.php
<div dir="rtl" style="display:inline;">معلومات موجزة المشروع.</div> | /README.md
<div dir="rtl" style="display:inline;">ملف تكوين ASP.NET (في هذه الحالة، لحماية دليل /vault من أن يتم الوصول إليه بواسطة مصادر غير مأذون لها في حالة إذا ما تم تثبيت البرنامج النصي على ملقم يستند إلى تقنيات ASP.NET</div> | /web.config
<div dir="rtl" style="display:inline;">دليل الوثائق (يحتوي على ملفات مختلفة).</div> | /_docs/
<div dir="rtl" style="display:inline;">الوثائق العربية.</div> | /_docs/readme.ar.md
<div dir="rtl" style="display:inline;">الوثائق الألمانية.</div> | /_docs/readme.de.md
<div dir="rtl" style="display:inline;">الوثائق الإنجليزية.</div> | /_docs/readme.en.md
<div dir="rtl" style="display:inline;">الوثائق الأسبانية.</div> | /_docs/readme.es.md
<div dir="rtl" style="display:inline;">الوثائق الفرنسية.</div> | /_docs/readme.fr.md
<div dir="rtl" style="display:inline;">الوثائق الاندونيسية.</div> | /_docs/readme.id.md
<div dir="rtl" style="display:inline;">الوثائق الايطالية.</div> | /_docs/readme.it.md
<div dir="rtl" style="display:inline;">الوثائق الهولندية.</div> | /_docs/readme.nl.md
<div dir="rtl" style="display:inline;">الوثائق البرتغالية.</div> | /_docs/readme.pt.md
<div dir="rtl" style="display:inline;">الوثائق الروسية.</div> | /_docs/readme.ru.md
<div dir="rtl" style="display:inline;">الوثائق الفيتنامية.</div> | /_docs/readme.vi.md
<div dir="rtl" style="display:inline;">الوثائق الصينية (المبسطة).</div> | /_docs/readme.zh.md
<div dir="rtl" style="display:inline;">الوثائق الصينية (التقليدية).</div> | /_docs/readme.zh-TW.md
<div dir="rtl" style="display:inline;">دليل اختبار الملفات ( يحتوي على العديد من الملفات). كل الملفات الواردة هي ملفات اختبار لاختبار إذا ما تم تثبيت phpMussel بشكل صحيح على النظام الخاص بك, لن تحتاج لتحميل هذا الدليل أو أي من ملفاته إلا عند القيام بهذا الاختبار.</div> | /_testfiles/
<div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات ASCII.</div> | /_testfiles/ascii_standard_testfile.txt
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات phpMussel الموسعة المعقدة.</div> | /_testfiles/coex_testfile.rtf
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PE في phpMussel.</div> | /_testfiles/exe_standard_testfile.exe
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات phpMussel العامة.</div> | /_testfiles/general_standard_testfile.txt
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات جرافيكس\رسومات phpMussel.</div> | /_testfiles/graphics_standard_testfile.gif
<div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات HTML.</div> | /_testfiles/html_standard_testfile.html
<div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات MD5.</div> | /_testfiles/md5_testfile.txt
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات البيانات الوصفية لـ phpMussel و لاختبار دعم ملف من نوع TAR على النظام الخاص بك.</div> | /_testfiles/metadata_testfile.tar
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات البيانات الوصفية لـ phpMussel و لاختبار دعم ملف من نوع GZ على النظام الخاص بك.</div> | /_testfiles/metadata_testfile.txt.gz
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات البيانات الوصفية لـ phpMussel و لاختبار دعم ملف من نوع ZIP على النظام الخاص بك.</div> | /_testfiles/metadata_testfile.zip
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات OLE في phpMussel.</div> | /_testfiles/ole_testfile.ole
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PDF في phpMussel.</div> | /_testfiles/pdf_standard_testfile.pdf
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PE الجزئية في phpMussel.</div> | /_testfiles/pe_sectional_testfile.exe
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات swf في phpMussel.</div> | /_testfiles/swf_standard_testfile.swf
<div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات XML/XDP في phpMussel.</div> | /_testfiles/xdp_standard_testfile.xdp
<div dir="rtl" style="display:inline;">دليل /vault/ (يحتوي على ملفات متنوعة).</div> | /vault/
<div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/.htaccess
<div dir="rtl" style="display:inline;">دليل ذاكرة التخزين المؤقت (للبيانات المؤقتة).</div> | /vault/cache/
<div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/cache/.htaccess
<div dir="rtl" style="display:inline;">معالج CLI.</div> | /vault/cli.php
<div dir="rtl" style="display:inline;">معالج التكوين.</div> | /vault/config.php
<div dir="rtl" style="display:inline;">معالج أوامر.</div> | /vault/controls.php
<div dir="rtl" style="display:inline;">ملف وظائف (ضروري).</div> | /vault/functions.php
<div dir="rtl" style="display:inline;">ملف CSV توقيعات القائمة الرمادية المشيرة إلى التوقيعات التي ينبغي على phpMussel أن يتجاهلها (هذا ملف يتم إعادة إنشاءه تلقائيا إذا حذف).</div> | /vault/greylist.csv
<div dir="rtl" style="display:inline;">ملف لغة.</div> | /vault/lang.php
<div dir="rtl" style="display:inline;">يحتوي على بيانات اللغة لـ phpMussel.</div> | /vault/lang/
<div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/lang/.htaccess
<div dir="rtl" style="display:inline;">ملفات اللغة العربية.</div> | /vault/lang/lang.ar.php
<div dir="rtl" style="display:inline;">ملفات اللغة الألمانية.</div> | /vault/lang/lang.de.php
<div dir="rtl" style="display:inline;">ملفات اللغة الإنجليزية.</div> | /vault/lang/lang.en.php
<div dir="rtl" style="display:inline;">ملفات اللغة الاسبانية.</div> | /vault/lang/lang.es.php
<div dir="rtl" style="display:inline;">ملفات اللغة الفرنسية.</div> | /vault/lang/lang.fr.php
<div dir="rtl" style="display:inline;">ملفات اللغة الاندونيسية.</div> | /vault/lang/lang.id.php
<div dir="rtl" style="display:inline;">ملفات اللغة الايطالية.</div> | /vault/lang/lang.it.php
<div dir="rtl" style="display:inline;">ملفات اللغة اليابانية.</div> | /vault/lang/lang.ja.php
<div dir="rtl" style="display:inline;">ملفات اللغة الهولندية.</div> | /vault/lang/lang.nl.php
<div dir="rtl" style="display:inline;">ملفات اللغة البرتغالية.</div> | /vault/lang/lang.pt.php
<div dir="rtl" style="display:inline;">ملفات اللغة الروسية.</div> | /vault/lang/lang.ru.php
<div dir="rtl" style="display:inline;">ملفات اللغة الفيتنامية.</div> | /vault/lang/lang.vi.php
<div dir="rtl" style="display:inline;">ملفات اللغة الصينية (المبسطة).</div> | /vault/lang/lang.zh.php
<div dir="rtl" style="display:inline;">ملفات اللغة الصينية (التقليدية).</div> | /vault/lang/lang.zh-TW.php
<div dir="rtl" style="display:inline;">ملف التكوين. يحتوي على جميع خيارات تهيئة phpMussel، يخبرك ماذا يفعل وكيف يعمل بشكل صحيح (ضروري)!</div> | /vault/phpmussel.ini
<div dir="rtl" style="display:inline;">دليل العزل (يحتوي على الملفات المعزولة).</div> | /vault/quarantine/
<div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/quarantine/.htaccess
<div dir="rtl" style="display:inline;">سجل لكل ما تم فحصه بواسطة phpMussel.</div> | ※ /vault/scan_log.txt
<div dir="rtl" style="display:inline;">سجل لكل ما تم فحصه بواسطة phpMussel.</div> | ※ /vault/scan_log_serialized.txt
<div dir="rtl" style="display:inline;">سجل لكل ما تم القضاء عليه بواسطة phpMussel.</div> | ※ /vault/scan_kills.txt
<div dir="rtl" style="display:inline;">دليل توقيعات (يحتوي توقيعات).</div> | /vault/signatures/
<div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/signatures/.htaccess
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من ASCII.</div> | /vault/signatures/ascii_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات الموسعة المعقدة.</div> | /vault/signatures/coex_clamav.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات الموسعة المعقدة.</div> | /vault/signatures/coex_custom.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات الموسعة المعقدة.</div> | /vault/signatures/coex_mussel.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات ELF.</div> | /vault/signatures/elf_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE (المحمولة التنفيذية).</div> | /vault/signatures/exe_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات اسم الملف.</div> | /vault/signatures/filenames_clamav.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات اسم الملف.</div> | /vault/signatures/filenames_custom.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات اسم الملف.</div> | /vault/signatures/filenames_mussel.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات العامة.</div> | /vault/signatures/general_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات الرسومات.</div> | /vault/signatures/graphics_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ترميز ملف CSV الأوامر العامة المكتشفة المستخدمة اختياريا من قبل phpMussel.</div> | /vault/signatures/hex_general_commands.csv
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف للتوقيعات التي تمت تسويتها/تطبيعها من HTML.</div> | /vault/signatures/html_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Mach-O.</div> | /vault/signatures/macho_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البريد.</div> | /vault/signatures/mail_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات القائمة على MD5.</div> | /vault/signatures/md5_clamav.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات القائمة على MD5.</div> | /vault/signatures/md5_custom.cvd
<div dir="rtl" style="display:inline;">ملف التوقيعات القائمة على MD5.</div> | /vault/signatures/md5_mussel.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البيانات الوصفية المؤرشفة.</div> | /vault/signatures/metadata_clamav.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البيانات الوصفية المؤرشفة.</div> | /vault/signatures/metadata_custom.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات البيانات الوصفية المؤرشفة.</div> | /vault/signatures/metadata_mussel.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات OLE.</div> | /vault/signatures/ole_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PDF.</div> | /vault/signatures/pdf_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE الجزئية.</div> | /vault/signatures/pe_clamav.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE الجزئية.</div> | /vault/signatures/pe_custom.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE الجزئية.</div> | /vault/signatures/pe_mussel.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE الموسعة.</div> | /vault/signatures/pex_clamav.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات PE الموسعة.</div> | /vault/signatures/pex_custom.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات Shockwave.</div> | /vault/signatures/swf_mussel_standard.cvd
<div dir="rtl" style="display:inline;">يتحكم و يضع متغيرات محددة.</div> | /vault/signatures/switch.dat
<div dir="rtl" style="display:inline;">ملق توقيعات مسح الروابط.</div> | /vault/signatures/urlscanner.cvd
<div dir="rtl" style="display:inline;">ملف قائمة السماح المحددة.</div> | /vault/signatures/whitelist_clamav.cvd
<div dir="rtl" style="display:inline;">ملف قائمة السماح المحددة.</div> | /vault/signatures/whitelist_custom.cvd
<div dir="rtl" style="display:inline;">ملف قائمة السماح المحددة.</div> | /vault/signatures/whitelist_mussel.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_clamav_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_clamav_regex.map
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_clamav_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_clamav_standard.map
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_custom_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_custom_standard.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_mussel_regex.cvd
<div dir="rtl" style="display:inline;">ملف توقيعات XML/XDP.</div> | /vault/signatures/xmlxdp_mussel_standard.cvd
<div dir="rtl" style="display:inline;">ملف القالب. قالب لمخرجات HTML التي تنتجها phpMussel لرسالة حظر تحميل الملفات (الرسالة التي يراها القائم بالتحميل).</div> | /vault/template.html
<div dir="rtl" style="display:inline;">ملف القالب. قالب لمخرجات HTML التي تنتجها phpMussel لرسالة حظر تحميل الملفات (الرسالة التي يراها القائم بالتحميل).</div> | /vault/template_custom.html
<div dir="rtl" style="display:inline;">ملف يحتوي على معلومات الإصدار لبرنامج phpMussel وتوقيعاته. إذا كنت تريد في أي وقت عمل تحديثا تلقائيا أو ترغب في تحديثه عن طريق المتصفح فهذا الملف ضروري.</div> | /vault/update.dat
<div dir="rtl" style="display:inline;">برنامج التحديث؛ مطلوب للحصول على التحديثات التلقائية وتحديث phpMussel عن طريق المتصفح، ولكن ليس مطلوب لغير ذلك.</div> | /vault/update.php
<div dir="rtl" style="display:inline;">معالج تحميل.</div> | /vault/upload.php

<div dir="rtl">※ اسم الملف قد يختلف استنادا إلى نصوص التكوين (في phpmussel.ini).</div>

####*<div dir="rtl">فيما يتعلق بملفات التوقيع</div>*
<div dir="rtl">CVD هو اختصار ل "تعريفات فيروسات (كلام ايه في)"، في إشارة إلى كل من كيف تشير (كلام ايه في) إلى التوقيعات الخاصة بهم واستخدام تلك التوقيعات في phpMussel. الملفات التي تنتهي ب "CVD" تحتوي على التوقيعات.<br /><br /></div>

<div dir="rtl">ملفات تنتهي ب "MAP" و معناها قد يكون حرفيا، و هي خريطة تواقيع phpMussel التي ينبغي أو يجب عدم استخدامها لاجراء الفحوصات الفردية؛ ليس مطلوبا من جميع التوقيعات بالضرورة لكل فحص، لذلك، يستخدم phpMussel خرائط ملفات التوقيع لتسريع عملية الفحص (عملية من شأنها أن تكون لولا ذلك بطيئة للغاية ومملة).<br /><br /></div>

<div dir="rtl">ملفات التوقيع المحددة بعلامة "_regex" تحتوي على التوقيعات التي تستخدم نمط التحقق المعتاد (regex).<br /><br /></div>

<div dir="rtl">ملفات التوقيع المحددة بعلامة "_standard" تحتوي على التوقيعات التي على وجه التحديد لا تستخدم أي شكل من أشكال نمط التحقق.<br /><br /></div>

<div dir="rtl">ملفات التوقيع الغير محددة بـ "_regex" أو "_standard" ستكون باعتبارها مثل أحدها أو الأخرى، ولكن ليس كلاهما (يرجى الرجوع إلى قسم شكل التوقيع في هذا الملف التمهيدي للوثائق و التفاصيل المحددة).<br /><br /></div>

<div dir="rtl">ملفات التوقيع المحددة بعلامة "_clamav" تحتوي على التوقيعات التي مصدرها تماما من قاعدة بيانات كلام ايه في (GNU/GPL).<br /><br /></div>

<div dir="rtl">ملفات التوقيع المحددة بعلامة "_custom"بشكل افتراضي، لا تحتوي على أي توقيعات على الإطلاق؛ توجد مثل هذه الملفات لتعطيك مكان لوضع التوقيعات المخصصة الخاصة بك، إذا كنت تأتي بأي منها بنفسك.<br /><br /></div>

<div dir="rtl">ملفات التوقيع المحددة بعلامة "_mussel" تحتوي على التوقيعات التي على وجه التحديد التي ليست مصدرها كلام ايه في، والتوقيعات التي عموما قد إما أتيت بها بنفسي و/أو بناء على المعلومات التي تم جمعها من مصار مختلفة.<br /><br /></div>

---


### <div dir="rtl">6. <a name="SECTION6"></a>خياراتالتكوين/التهيئة</div>
<div dir="rtl">وفيما يلي قائمة من المتغيرات الموجودة في ملف تكوين phpmussel.ini، بالإضافة إلى وصف الغرض منه و وظيفته.<br /><br /></div>

#### <div dir="rtl">"general" (التصنيف)<br /></div>
<div dir="rtl">التكوين العام لـ phpMussel.<br /><br /></div>

<div dir="rtl">"script_password"<br /></div>
<div dir="rtl"><ul>
 <li>للسهولة، phpMussel يقوم بالسماح لوظائف معينة يمكن تشغيلها يدويا من خلال وظيفة الحصول على والاستعلام. مع ذلك، كإجراء أمني احترازي، للقيام بذلك، phpMussel تتوقع كلمة مرور ليتم تضمينها مع الأمر لضمان أنك من أصدرت الامر وليس شخصا آخر، في محاولة لبدء هذه الوظائف يدويا. تحدد script_password أي كلمة سر ترغب في استخدامها. إذا تم تعيين أية كلمة مرور، سيتم تعطيل البدء اليدوي بشكل افتراضي. ننصح باستخدام شيء تذكرونه ككلمة مرور ولكن يصعب على الآخرين تخمينها.</li>
 <li>ليس له أي تأثير في وضع CLI "واجهة سطر الأوامر".</li>
</ul></div>

<div dir="rtl">"logs_password"<br /></div>
<div dir="rtl"><ul>
 <li>نفس "script_password"، ولكن لعرض محتويات `scan_log` وscan_kills. يمكن وجود كلمات سر منفصلة تكون مفيدة إذا كنت تريد أن تعطي شخص آخر الوصول إلى مجموعة واحدة من وظائف دون غيرها.</li>
 <li>ليس له أي تأثير في وضع CLI "واجهة سطر الأوامر".</li>
</ul></div>

<div dir="rtl">"cleanup"<br /></div>
<div dir="rtl"><ul>
 <li>إلغاء تعيين المتغيرات وذاكرة التخزين المؤقت التي يستخدمها البرنامج النصي بعد المسح الأولي للتحميل؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي]. إذا كنت -لا -تستخدم البرنامج النصي وراء المسح الأولي للتحميل، يجب تعيين هذا صحيح (نعم)، للحد من استخدام الذاكرة. إذا كنت تستخدم البرنامج النصي وراء المسح الأولي للتحميل، ينبغي أن تحدد إلى زائفة =(لا)، لتجنب داع إعادة تحميل البيانات المكررة في الذاكرة. في الممارسة العامة، ينبغي عادة أن يتم تعيين إلى صحيح، ولكن، إذا كنت تفعل ذلك، فإنك لن تكون قادرا على استخدام البرنامج النصي في أي شيء سوى المسح الأولي لتحميل الملف.</li>
 <li>ليس له أي تأثير في وضع CLI "واجهة سطر الأوامر".</li>
</ul></div>

<div dir="rtl">"scan_log"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف لملف تسجيل جميع نتائج المسح. قم بتعيين اسم الملف، أو اتركه فارغا للتعطيل.</li>
</ul></div>

<div dir="rtl">"scan_log_serialized"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف من ملف لتسجيل جميع نتائج المسح إلى (باستخدام تنسيق متسلسل). تحديد اسم الملف، أو اتركه فارغا للتعطيل.</li>
</ul></div>

<div dir="rtl">"scan_kills"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف من ملف لتسجيل كل سجلات الملفات التي منعت او اوقفت من .تحديد اسم الملف، أو اتركه فارغا لتعطيل.</li>
</ul></div>

<div dir="rtl"><em>Useful tip: If you want, you can append date/time information to the names of your logfiles by including these in the name: `{yyyy}` for complete year, `{yy}` for abbreviated year, `{mm}` for month, `{dd}` for day, `{hh}` for hour. @TranslateMe@</em><br /><br /></div>

<div dir="rtl"><em>Examples: @TranslateMe@</em><br /></div>
<div dir="rtl"><ul><em>
 <li>logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'</li>
 <li>logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'</li>
 <li>logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'</li>
</em></ul></div>

<div dir="rtl">"timeOffset"<br /></div>
<div dir="rtl"><ul>
 <li>If your server time doesn't match your local time, you can specify an offset here to adjust the date/time information generated by CIDRAM according to your needs. It's generally recommended instead to adjust the timezone directive in your `php.ini` file, but sometimes (such as when working with limited shared hosting providers) this isn't always possible to do, and so, this option is provided here. Offset is in minutes. @TranslateMe@</li>
 <li>Example (to add one hour): `timeOffset=60` @TranslateMe@</li>
</ul></div>

<div dir="rtl">"ipaddr"<br /></div>
<div dir="rtl"><ul>
 <li>أين يمكن العثور على عنوان IP لربط الطلبات؟ (مفيدة للخدمات مثل لايتكلاود و مثلها) الافتراضي = REMOTE_ADDR. تحذير: لا تغير هذا إلا إذا كنت تعرف ما تفعلونه!</li>
</ul></div>

<div dir="rtl">"enable_plugins"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين دعم ملحقات phpMussel؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].</li>
</ul></div>

<div dir="rtl">"forbid_on_block"<br /></div>
<div dir="rtl"><ul>
 <li>هل phpMussel يرسل 403 من العناوين مع الرسالة منعت إيداع الملف، أو يبقى مع المعتادة 200 موافق؟ خطأ = رقم (200) [الافتراضي]. صحيح = نعم (403).</li>
</ul></div>

<div dir="rtl">"delete_on_sight"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين هذا التوجيه وإرشاد النصي لمحاولة حذف فورا عن أي الممسوحة ضوئيا تحميل ملف محاولة مطابقة أي معايير الكشف، سواء عن طريق التوقيعات أو غير ذلك. لن يكون لمست الملفات مصممة على أن تكون "نظيفة". في حالة المحفوظات، سيتم حذف أرشيف كامل، بغض النظر عن ما إذا كان أو لم يكن ملف المخالف هو واحد فقط من العديد من الملفات الواردة في الأرشيف. بالنسبة لحالة إيداع ملف المسح الضوئي، عادة، فإنه ليس من الضروري لتمكين هذا التوجيه، لأن العادة، PHP وتطهير محتويات ذاكرة التخزين المؤقت تلقائيا عند انتهاء التنفيذ، وهذا يعني انها سوف عادة حذف أي الملفات التي تم تحميلها من خلال ذلك إلى الخادم ما لم يكونوا قد تم نقلها أو نسخها أو حذفها بالفعل. يضاف هذا التوجيه هنا كإجراء إضافي من الأمن لأولئك الذين نسخ من PHP قد لا تتصرف دائما على النحو المتوقع. = كاذبة بعد المسح، وترك الملف وحده [الافتراضي]. صحيح = بعد المسح، إن لم يكن نظيفة، تحذف فورا.</li>
</ul></div>

<div dir="rtl">"lang"<br /></div>
<div dir="rtl"><ul>
 <li>تحديد اللغة الافتراضية الخاصة بـ phpMussel.</li>
</ul></div>

<div dir="rtl">"lang_override"<br /></div>
<div dir="rtl"><ul>
 <li>تحديد ما إذا كان ينبغي phpMussel، عندما يكون ذلك ممكنا، تجاوز مواصفات اللغة مع تفضيلات اللغة التي أعلنها طلبات الداخلية (HTTP_ACCEPT_LANGUAGE). كاذبة = لا [الافتراضي]. صحيح = نعم.</li>
</ul></div>

<div dir="rtl">"lang_acceptable"<br /></div>
<div dir="rtl"><ul>
 <li>و"lang_acceptable" التوجيه يقول phpMussel التي يجوز قبول لغة من خلال البرنامج النصي من "لانج" أو من "HTTP_ACCEPT_LANGUAGE". يجب فقط أن يتم تعديل هذا التوجيه إذا كنت تقوم بإضافة ملفات اللغة مخصصة الخاصة بك أو إزالة الملفات لغة قسرا. التوجيه هو بفواصل سلسلة من الرموز المستخدمة من قبل تلك اللغات التي يقبلها النصي.</li>
</ul></div>

<div dir="rtl">"quarantine_key"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel غير قادرة على الحجر ترفع علم حاول تحميل الملف في عزلة داخل "قبو" phpMussel، إذا كان هذا هو ما تريد أن تفعله. المستخدمين العاديين من phpMussel التي ترغب ببساطة لحماية مواقعها على شبكة الإنترنت أو بيئة استضافة دون وجود أي مصلحة في تحليل عميق أي ترفع علم تحميل الملفات حاول يجب ترك هذه الوظيفة ذوي الاحتياجات الخاصة، ولكن أي المستخدمين المهتمين في مزيد من التحليل للترفع علم حاولت تحميل الملفات للبحث عن البرامج الضارة أو ما شابه مثل هذه الأمور ينبغي أن تمكن هذه الوظيفة. الحجر الصحي لترفع العلم تحميل الملفات حاول يمكن في بعض الأحيان أن تساعد في تصحيح ايجابيات كاذبة، إذا كان هذا هو الشيء الذي كثيرا ما يحدث لك. إلى تعطيل وظيفة العزل، ببساطة مغادرة "quarantine_key" التوجيه فارغة، أو مسح محتويات هذا التوجيه إذا لم يكن خاليا بالفعل. لتمكين وظيفة العزل، وإدخال قيمة في التوجيه. و"quarantine_key" هي ميزة أمنية مهمة من وظائف الحجر الصحي المطلوبة كوسيلة لمنع وظيفة الحجر الصحي من أن تستغل من قبل المهاجمين المحتملين، وكوسيلة لمنع أي احتمال تنفيذ البيانات المخزنة داخل الحجر الصحي. و"quarantine_key" ينبغي أن يعامل بنفس الطريقة التي يعامل بها كلمات السر الخاصة بك: وكلما كان ذلك أفضل، وحراسته مشددة. للحصول على أفضل تأثير، استخدم بالتزامن مع "delete_on_sight".</li>
</ul></div>

<div dir="rtl">"quarantine_max_filesize"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لحجم الملف المسموح به من الملفات للحجر الصحي. لن يكون الحجر الصحي الملفات أكبر من القيمة المحددة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. القيمة في كيلوبايت. الافتراضي = 2048 = 2048KB = 2MB.</li>
</ul></div>

<div dir="rtl">"quarantine_max_usage"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لاستخدام الذاكرة يسمح للحجر الصحي. إذا كان إجمالي الذاكرة المستخدمة من قبل الحجر الصحي تصل هذه القيمة، سيتم حذف أقدم الملفات المعزولة حتى الذاكرة الإجمالية المستخدمة لم تعد تصل هذه القيمة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. القيمة في كيلوبايت. الافتراضي = 65536 = 65536KB = 64MB.</li>
</ul></div>

<div dir="rtl">"honeypot_mode"<br /></div>
<div dir="rtl"><ul>
 <li>عند تمكين وضع مصيدة، و phpMussel محاولة لعزل كل تحميل ملف واحد أن يواجه، بغض النظر عن ما إذا كان أو لم يكن ملف يتم تحميلها يطابق أي وشملت التوقيعات، وسوف لا المسح الفعلي أو تحليل لتلك تحميل الملفات حاول أن يحدث في الواقع. وينبغي أن تكون هذه الوظيفة مفيدة لأولئك الذين يرغبون في استخدام phpMussel لأغراض فيروس / بحث عن البرامج الضارة، ولكن هذا لا يوصى لتمكين هذه الوظيفة إذا كان الغرض من استخدام phpMussel من قبل المستخدم هو الفعلي إيداع ملف المسح، ولا ينصح لاستخدام وظائف مصيدة لأغراض أخرى غير honeypotting. افتراضيا، يتم تعطيل هذا الخيار. كاذبة = معطل [الافتراضي]. = الحقيقية تمكين.</li>
</ul></div>

<div dir="rtl">"scan_cache_expiry"<br /></div>
<div dir="rtl"><ul>
 <li>إلى متى يجب أن phpMussel تخزين نتائج المسح؟ القيمة هي عدد الثواني لتخزين نتائج المسح ل. الافتراضي هو 21600 ثانية (6 ساعات)؛ وقيمة 0 تعطيل التخزين المؤقت نتائج المسح.</li>
</ul></div>

<div dir="rtl">"disable_cli"<br /></div>
<div dir="rtl"><ul>
 <li>وضع تعطيل CLI؟ يتم تمكين وضع CLI افتراضيا، ولكن يمكن أن تتداخل أحيانا مع بعض أدوات الاختبار (مثل PHPUnit، على سبيل المثال) وغيرها من التطبيقات القائمة على المبادرة القطرية. إذا كنت لا تحتاج إلى تعطيل وضع CLI، يجب تجاهل هذا التوجيه. خطأ = تمكين وضع CLI [الافتراضي]. صحيح = وضع تعطيل CLI.</li>
</ul></div>

#### <div dir="rtl">"signatures" (التصنيف)<br /></div>
<div dir="rtl">تكوين التوقيعات.<br /><br /></div>
<div dir="rtl"><ul>
 <li>%%%_clamav = ClamAV توقيعات (الرئيسية و اليومية).</li>
 <li>%%%_custom = توقيعاتك الخاصة ( إذا كنت قد كتبت أي منها ).</li>
 <li>%%%_mussel = phpMussel توقيعات،المدرجة في القائمة الحالية حتى التي ليست من توقيعات ClamAV.</li>
</ul></div>

<div dir="rtl">تحقق على التوقيعات MD5 أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"md5_clamav"</li>
 <li>"md5_custom"</li>
 <li>"md5_mussel"</li>
</ul></div>

<div dir="rtl">تحقق على التوقيعات العامة أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"general_clamav"</li>
 <li>"general_custom"</li>
 <li>"general_mussel"</li>
</ul></div>

<div dir="rtl">تحقق على التوقيعات ASCII المطبعة أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"ascii_clamav"</li>
 <li>"ascii_custom"</li>
 <li>"ascii_mussel"</li>
</ul></div>

<div dir="rtl">تحقق على التوقيعات HTML المطبعة أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"html_clamav"</li>
 <li>"html_custom"</li>
 <li>"html_mussel"</li>
</ul></div>

<div dir="rtl">تحقق PE (الملف التنفيذي المحمولة) ملفات (EXE، DLL، الخ) على التوقيعات PE الاقسام أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"pe_clamav"</li>
 <li>"pe_custom"</li>
 <li>"pe_mussel"</li>
</ul></div>

<div dir="rtl">تحقق PE الملفات (محمول الملف التنفيذي) (EXE، DLL، الخ) على التوقيعات طويلة PE أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"pex_custom"</li>
 <li>"pex_mussel"</li>
</ul></div>

<div dir="rtl">تحقق PE الملفات (محمول الملف التنفيذي) (EXE، DLL، الخ) على التوقيعات PE أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"exe_clamav"</li>
 <li>"exe_custom"</li>
 <li>"exe_mussel"</li>
</ul></div>

<div dir="rtl">التحقق من الملفات ELF على التوقيعات ELF أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"elf_clamav"</li>
 <li>"elf_custom"</li>
 <li>"elf_mussel"</li>
</ul></div>

<div dir="rtl">تحقق Mach-O الملفات (OSX، الخ) على Mach-O التوقيعات أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [الافتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"macho_clamav"</li>
 <li>"macho_custom"</li>
 <li>"macho_mussel"</li>
</ul></div>

<div dir="rtl">افحص ملفات الرسومات ضد الرسومات على أساس التوقيعات أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"graphics_clamav"</li>
 <li>"graphics_custom"</li>
 <li>"graphics_mussel"</li>
</ul></div>

<div dir="rtl">افحص محتويات أرشيف ضد التوقيعات الفوقية ارشيف أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"metadata_clamav"</li>
 <li>"metadata_custom"</li>
 <li>"metadata_mussel"</li>
</ul></div>

<div dir="rtl">افحص كائنات OLE ضد التوقيعات OLE أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"ole_clamav"</li>
 <li>"ole_custom"</li>
 <li>"ole_mussel"</li>
</ul></div>

<div dir="rtl">افحص أسماء الملفات ضد التوقيعات على اسم الملف أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"filenames_clamav"</li>
 <li>"filenames_custom"</li>
 <li>"filenames_mussel"</li>
</ul></div>

<div dir="rtl">افحص ضد توقيعات البريد الإلكتروني أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"mail_clamav"</li>
 <li>"mail_custom"</li>
 <li>"mail_mussel"</li>
</ul></div>

<div dir="rtl">تمكين ملف القائمة البيضاء المحددة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"whitelist_clamav"</li>
 <li>"whitelist_custom"</li>
 <li>"whitelist_mussel"</li>
</ul></div>

<div dir="rtl">افحص XML/XDP ضد XML/XDP التوقيعات أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"xmlxdp_clamav"</li>
 <li>"xmlxdp_custom"</li>
 <li>"xmlxdp_mussel"</li>
</ul></div>

<div dir="rtl">افحص ضد التوقيعات طويلة معقدة أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"coex_clamav"</li>
 <li>"coex_custom"</li>
 <li>"coex_mussel"</li>
</ul></div>

<div dir="rtl">افحص ضد التوقيعات PDF أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"pdf_clamav"</li>
 <li>"pdf_custom"</li>
 <li>"pdf_mussel"</li>
</ul></div>

<div dir="rtl">افحص ضد توقيعات المستخدمين أثناء الفحص؟ كاذبة = لا؛ صحيح = نعم [افتراضي].<br /></div>
<div dir="rtl"><ul>
 <li>"swf_clamav"</li>
 <li>"swf_custom"</li>
 <li>"swf_mussel"</li>
</ul></div>

<div dir="rtl">توقيع مطابقة المدة يحدد من الخيارات. فقط قم تغيير هذه إذا كنت تعرف ما تفعلونه. SD = التوقيعات القياسية. RX = PCRE (التعبير العادية بيرل المتوافقة، أو "التعبيرات المنتظمة") التوقيعات. FN = تواقيع اسم الملف. إذا لاحظت PHP تحطمها عندما يحاول phpMussel مسح ومحاولة خفض هذه القيم "الحد الأقصى". إذا كان ذلك ممكنا و مريح، واسمحوا لي أن أعرف عندما يحدث هذا، ونتائج مهما حاولت.<br /></div>
<div dir="rtl"><ul>
 <li>"fn_siglen_min"</li>
 <li>"fn_siglen_max"</li>
 <li>"rx_siglen_min"</li>
 <li>"rx_siglen_max"</li>
 <li>"sd_siglen_min"</li>
 <li>"sd_siglen_max"</li>
</ul></div>

<div dir="rtl">"fail_silently"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على phpMussel الابلاغ عندما يتم توقيع ملفات مفقودة أو تالفة؟ إذا كان `fail_silently` المعوقين، في عداد المفقودين وسيتم الإبلاغ عن ملفات فساد في المسح، وإذا `fail_silently` تمكين، في عداد المفقودين وسيتم تجاهل ملفات فساد، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. وهذا ين بغي عموما أن تترك وحدها إلا إذا كنت تعاني من أعطال أو مشاكل مشابهة. خطأ = معطل. صحيح = ممكن [افتراضي].</li>
</ul></div>

<div dir="rtl">"fail_extensions_silently"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على phpMussel الابلاغ عندما تفقد الملحقات؟ إذا تم تعطيل `fail_extensions_silently`، وسيتم إبلاغ ملحقات مفقودة على المسح، وإذا تم تمكين `fail_extensions_silently`، سيتم تجاهل ملحقات المفقودة، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. تعطيل هذا التوجيه قد يحتمل زيادة الأمان، ولكن قد يؤدي أيضا إلى زيادة من ايجابيات كاذبة. خطأ = معطل. صحيح = ممكن [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_adware"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن تجسس؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_joke_hoax"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن خدعة البرمجيات الخبيثة / الفيروسات؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_pua_pup"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن PUAs؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_packer_packed"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن تعبئة والبيانات المعبأة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_shell"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن البرامج النصية قذيفة؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"detect_deface"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن مهاجمات وdefacers؟ كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

#### <div dir="rtl">"files" (التصنيف)<br /></div>
<div dir="rtl">ملف التعامل مع التكوين.<br /><br /></div>

<div dir="rtl">"max_uploads"<br /></div>
<div dir="rtl"><ul>
 <li>العدد الأقصى المسموح به من ملفات لمسح أثناء تحميل الملفات مسح قبل إحباط عملية الفحص وإعلام المستخدم أنهم تحميل أكثر من اللازم في وقت واحد! يوفر الحماية ضد هجوم النظري حيث يحاول أحد المهاجمين دوس النظام الخاص بك أو CMS من الحمولة الزائدة phpMussel إلى إبطاء عملية PHP لوقف طحن. الموصى بها: 10. أنت قد ترغب في رفع أو خفض هذا الرقم اعتمادا على سرعة الجهاز. لاحظ أن هذا الرقم لا يأخذ في الحسبان أو تتضمن محتويات المحفوظات.</li>
</ul></div>

<div dir="rtl">"filesize_limit"<br /></div>
<div dir="rtl"><ul>
 <li>حدود حجم الملف بالكيلو بايت. 65536 = 64MB [افتراضي]. 0 = لا يوجد حد (greylisted دائما)، أي (إيجابية) قيمة رقمية قبلت. هذا يمكن أن يكون مفيدا عندما يحد التكوين الخاص بي مقدار الذاكرة عملية يمكن أن تعقد أو إذا كان لديك PHP حدود التكوين حجم الملف من الإضافات.</li>
</ul></div>

<div dir="rtl">"filesize_response"<br /></div>
<div dir="rtl"><ul>
 <li>ماذا تفعل مع الملفات التي تتجاوز الحد الأقصى لحجم الملف (إن وجد). كاذبة = القائمة البيضاء. صحيح = القائمة السوداء [افتراضي].</li>
</ul></div>

<div dir="rtl">"filetype_whitelist", "filetype_blacklist", "filetype_greylist"<br /></div>
<div dir="rtl"><ul>
 <li>إذا كان النظام يسمح فقط أنواع معينة من الملفات المراد تحميلها، أو إذا كان النظام ينفي صراحة أنواع معينة من الملفات، تحديد تلك نوع الملف في قوائم بيضاء، القوائم السوداء و القوائم الرمادية يمكن أن تزيد من السرعة التي يتم تنفيذ المسح من خلال السماح للبرنامج بتخطي بعض أنواع الملفات. الشكل هو CSV (قيم مفصولة بفواصل). إذا كنت ترغب في مسح كل شيء، وليس من القائمة البيضاء، القائمة السوداء أو القائمة الرمادية، وترك المتغير (/ ث) فارغة. وبذلك تعطيل القائمة البيضاء / السوداء / القائمة الرمادية.</li>
 <li><strong>الترتيب المنطقي للمعالجة هو:</strong></li>
 <ul>
 <li>إذا نوع الملف موجود في القائمة البيضاء، لا يفحص ولا تحجب الملف، وعدم التدقيق في ملف ضد القائمة السوداء أو القائمة الرمادية.</li>
 <li>إذا نوع الملف موجود في القائمة السوداء، لا تفحص الملف ولكن منع ذلك على أي حال، وعدم التدقيق في ملف ضد قائمة رمادية.</li>
 <li>إذا كانت قائمة رمادية فارغة أو إذا كانت قائمة رمادية ليس فارغا من نوع الملف، مسح الملفات حسب طبيعتها وتحديد ما إذا كان لمنع ذلك بناء على نتائج الفحص، ولكن إذا كانت قائمة رمادية ليس فارغا ونوع الملف هو ليس ملف قائمة رمادية، معالجة الملف على القائمة السوداء، لذلك لا المسح الضوئي ولكن منع ذلك على أي حال.</li>
 </ul>
</ul></div>

<div dir="rtl">"check_archives"<br /></div>
<div dir="rtl"><ul>
 <li>محاولة للتحقق من محتويات المحفوظات؟ = كاذبة لا تحقق. صحيح = افحص [افتراضي].</li>
 <li>في الوقت الراهن، يتم اعتماد فحص فقط من BZ/BZIP2، GZ/GZIP، LZF، PHAR، TAR و ZIP (فحص من RAR، CAB، 7Z وإلى آخره غير معتمدة حاليا).</li>
 <li>هذه ليست مضمونة! بينما أنا أوصي حفظ هذا قيد التشغيل، لا يمكنني ان اضمن انها سوف تجد دائما كل شيء.</li>
 <li>أيضا أن ندرك أن أرشيف التحقق حاليا ليست متكررة ملفات PHAR أو ZIP.</li>
</ul></div>

<div dir="rtl">"filesize_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ترحيل حجم ملف القائمة السوداء / قائمة بيضاء لمحتويات المحفوظات؟ كاذبة = لا (فقط كل ما يدرجون)؛ صحيح = نعم [افتراضي].</li>
</ul></div>

<div dir="rtl">"filetype_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ترحيل نوع الملف القائمة السوداء / القائمة البيضاء لمحتويات المحفوظات؟ كاذبة = لا (فقط كل ما يدرجون) [افتراضي]. صحيح = نعم.</li>
</ul></div>

<div dir="rtl">"max_recursion"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لإعادة الحد الأقصى لعمق المحفوظات. افتراضي = 10.</li>
</ul></div>

<div dir="rtl">"block_encrypted_archives"<br /></div>
<div dir="rtl"><ul>
 <li>كشف ومنع تشفير المحفوظات؟ لأن phpMussel ليست قادرة على مسح محتويات المحفوظات مشفرة، فمن الممكن أن التشفير أرشيف يجوز توظيف من قبل مهاجم كوسيلة لمحاولة تجاوز phpMussel، والماسحات الضوئية مكافحة الفيروسات وغيرها من مثل هذه الحماية. يمكن أن تعليمات phpMussel لمنع أي المحفوظات التي كان تكتشف لتكون مشفرة المحتمل أن يساعد على الحد من أي مخاطر المرتبطة بهذه مثل هذه الاحتمالات. كاذبة = لا؛ صحيح = نعم [افتراضي].</li>
</ul></div>

#### <div dir="rtl">"attack_specific" (التصنيف)<br /></div>
<div dir="rtl">تعليمات للهجوم المحدد.<br /><br /></div>

<div dir="rtl">الكشف عن الهجوم المتقلب: = زائف. صحيح = تشغيل.<br /><br /></div>

<div dir="rtl">"chameleon_from_php"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن العنوان PHP في الملفات التي ليست ملفات PHP و لا المحفوظات معترفة بها.</li>
</ul></div>

<div dir="rtl">"chameleon_from_exe"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن العناوين قابلة للتنفيذ في الملفات التي ليست التنفيذية ولا المحفوظات المعترف بها والقابلة للتنفيذ التي هي العناوين غير صحيحة.</li>
</ul></div>

<div dir="rtl">"chameleon_to_archive"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن المحفوظات التي عناوينها غير صحيحة (المدعومة: BZ، GZ، RAR، ZIP، RAR، GZ).</li>
</ul></div>

<div dir="rtl">"chameleon_to_doc"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن المستندات التي عناوينها غير صحيحة (المدعومة: DOC، وزارة النقل، PPS، PPT، XLA، XLS، WIZ).</li>
</ul></div>

<div dir="rtl">"chameleon_to_img"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن الصور التي عناوينها غير صحيحة (المدعومة: BMP، DIB، PNG، GIF، JPEG، JPG، XCF، PSD، PDD، WEBP).</li>
</ul></div>

<div dir="rtl">"chameleon_to_pdf"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن الملفات PDF التي عناوينها غير صحيحة.</li>
</ul></div>

<div dir="rtl">"archive_file_extensions" و "archive_file_extensions_wc"<br /></div>
<div dir="rtl"><ul>
 <li>ملحقات ملفات الأرشيف المعترف بها (الشكل هو CSV، وينبغي فقط إضافة أو إزالة عندما تحدث المشاكل؛ إزالة دون داع قد يسبب ايجابيات كاذبة لتظهر لملفات الأرشيف، في حين اضاف داع سوف القائمة البيضاء أساسا ما كنت تقوم بإضافة من كشف المحدد الهجوم؛ تعديل مع الحذر، لاحظ أيضا أن هذا ليس له تأثير على ما المحفوظات يمكن ولا يمكن تحليلها على مستوى المحتوى). القائمة، كما هو في التقصير، يسرد تلك الأشكال الأكثر شيوعا في غالبية النظم واتفاقية الأنواع المهاجرة، ولكن عمدا ليست شاملة بالضرورة.</li>
</ul></div>

<div dir="rtl">"general_commands"<br /></div>
<div dir="rtl"><ul>
 <li>البحث في محتوى الملفات للبيانات وأوامر عامة مثل وحدة التقييم () والذي exec ()؟ = كاذبة لا تحقق [افتراضي]. صحيح = افحص. تعطيل هذا التوجيه إذا كنت تنوي تحميل أي من الإجراءات التالية على النظام الخاص بك أو CMS عبر المتصفح: PHP، جافا سكريبت، HTML، python، ملفات بيرل وإلى آخره. تمكين هذا التوجيه إذا لم يكن لديك أي حماية إضافية على النظام الخاص بك ولا تنوي تحميل هذه الملفات. إذا كنت تستخدم أمنية إضافية بالتزامن مع phpMussel (مثل ZB Block)، وليس هناك حاجة لتمكين هذا التوجيه، لأن معظم ما سوف phpMussel ننظر ل (في سياق هذا التوجيه) والازدواجية من الحماية التي من المرجح أن تكون بالفعل المقدمة.</li>
</ul></div>

<div dir="rtl">"block_control_characters"<br /></div>
<div dir="rtl"><ul>
 <li>حظر أي ملفات تحتوي على أي أحرف التحكم (عدا أسطر جديدة)؟ ("[\x00-\x08\x0b\x0c\x0e\x1f\x7f]") إذا كنت **فقط** تحميل نص عادي، ثم يمكنك تشغيل هذا الخيار لتوفير بعض الحماية إضافية على النظام الخاص بك. ومع ذلك، إذا قمت بتحميل أي شيء آخر غير نص عادي، وتحول هذا على قد يؤدي إلى ايجابيات كاذبة. = كاذبة لا منع [افتراضي]. صحيح = بلوك.</li>
</ul></div>

<div dir="rtl">"corrupted_exe"<br /></div>
<div dir="rtl"><ul>
 <li>تلف الملفات وتحليل الأخطاء. خطأ = تجاهل. صحيح = كتلة [افتراضي]. كشف ومنع الملفات المحتمل تلف PE (محمول قابل للتنفيذ)؟ في كثير من الأحيان (ولكن ليس دائما)، عندما تلف جوانب معينة من ملف PE أو لا يمكن تحليله بشكل صحيح، فإنه يمكن أن يكون مؤشرا على وجود عدوى فيروسية. العمليات المستخدمة من قبل معظم برامج مكافحة الفيروسات للكشف عن الفيروسات في ملفات PE تتطلب تحليل تلك الملفات بطرق معينة والتي إذا كان مبرمج للفيروس هو على علم، ومحاولة خصيصا لمنع، من أجل السماح للفيروس لتبقى غير مكتشفة .</li>
</ul></div>

<div dir="rtl">"decode_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الاختياري أو الحد الأقصى لطول البيانات الخام من خلاله أن يتم الكشف عن أوامر فك (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). القيمة هي عدد صحيح يمثل حجم الملف بالكيلو بايت. افتراضي = 512 (512KB). صفر أو قيمة فارغة تعطيل عتبة (إزالة مثل هذا القيد على أساس حجم الملف).</li>
</ul></div>

<div dir="rtl">"scannable_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الاختياري أو الحد الأقصى لطول البيانات الخام التي يسمح phpMussel لقراءة ومسح (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). القيمة هي عدد صحيح يمثل حجم الملف بالكيلو بايت. افتراضي = 32768 (32MB). صفر أو قيمة فارغة تعطيل العتبة. عموما، يجب أن لا تكون هذه القيمة أقل من متوسط حجم الملف من تحميل الملفات التي تريد وتتوقع الحصول على الخادم الخاص بك أو الموقع، لا ينبغي أن يكون أكثر من التوجيه filesize_limit، ويجب أن لا يكون خامس أكثر من ما يقرب من واحد من مجموع تخصيص الذاكرة المسموح منح لPHP عن طريق ملف php.iniconfiguration. هذا التوجيه موجود في محاولة لمنع phpMussel من استخدام ما يصل الكثير من الذاكرة (التي تريد منعها من أن تكون قادرة على مسح بنجاح الملفات فوق حجم الملف معين).</li>
</ul></div>

#### <div dir="rtl">"compatibility" (التصنيف)<br /></div>
<div dir="rtl">تعليمات التوافق مع phpMussel.<br /><br /></div>

<div dir="rtl">"ignore_upload_errors"<br /></div>
<div dir="rtl"><ul>
 <li>يجب أن يكون هذا التوجيه عموما هو تعطيل ما لم تصبح مطلوبة حصول على الوظائف الصحيحة لـ phpMussel على النظام الخاص بك محددة. عادة، عندما يكون في وضع تعطيل، عندما يكتشف phpMussel وجود عناصر في مجموعة "$ _files" ()، وأنها سوف محاولة لبدء فحص الملفات التي تمثل تلك العناصر، وإذا كانت تلك العناصر هي فارغة أو فارغة، سوف phpMussel العودة رسالة خطأ. هذا هو السلوك الصحيح للـ phpMussel. ومع ذلك، بالنسبة لبعض CMS، العناصر الفارغة في "$ _files" يمكن أن تحدث نتيجة لسلوك طبيعي لتلك CMS، أو أخطاء قد يتم الإعلام عندما لم تكن هناك أي، في هذه الحالة، السلوك العادي للphpMussel سوف تتدخل مع السلوك العادي من تلك CMS. في حال حدوث مثل هذه الحالة بالنسبة لك، تمكين هذا الخيار سوف يكلف phpMussel ليست محاولة لبدء المسح الضوئي لمثل هذه العناصر الفارغة، تجاهلها عندما وجدت وعدم إعادة أي رسائل خطأ ذات الصلة، مما يتيح استمرار طلب الصفحة. كاذبة = OFF؛ صحيح = ON.</li>
</ul></div>

<div dir="rtl">"only_allow_images"<br /></div>
<div dir="rtl"><ul>
 <li>إذا كنت تتوقع فقط أو تنوي فقط للسماح الصور المراد تحميلها على النظام الخاص بك أو CMS، وإذا كنت على الاطلاق لا تتطلب أية ملفات أخرى من الصور ليتم تحميلها على النظام الخاص بك أو CMS، ينبغي تمكين هذا التوجيه، ولكن ينبغي خلاف ذلك يتم تعطيل. إذا تم تمكين هذا التوجيه، أنه سوف يكلف phpMussel لمنع عشوائيا أي الإضافات التي تم تحديدها كملفات صورة غير، دون مسحها. هذا قد يقلل من الوقت اللازم لتجهيز واستخدام الذاكرة لمحاولة تحميل الملفات غير الصورة. كاذبة = OFF؛ صحيح = ON.</li>
</ul></div>

#### <div dir="rtl">"heuristic" (التصنيف)<br /></div>
<div dir="rtl">تعليمات الكشف عن مجريات الأمور.<br /><br /></div>

<div dir="rtl">"threshold"<br /></div>
<div dir="rtl"><ul>
 <li>هناك توقيعات معينة من phpMussel التي تهدف إلى تحديد الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها دون في أنفسهم تحديد تلك الملفات التي تم تحميلها على وجه التحديد بأنها خبيثة. هذه القيمة "الحد الأقصى " تقول phpMussel ما الحد الأقصى للوزن الكلي من الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها هذا المسموح به هو قبل تلك الملفات ليتم وضع علامة بأنها خبيثة. تعريف الوزن في هذا السياق هو العدد الإجمالي من الصفات المشبوهة والمحتمل أن تكون ضارة تحديدها. افتراضيا، سيتم تعيين هذه القيمة إلى 3. القيمة المنخفضة عموما سوف يؤدي إلى حدوث أعلى من ايجابيات كاذبة ولكن عددا أكبر من الملفات الخبيثة التي لوحت، في حين أن أعلى قيمة عموما سوف يؤدي إلى حدوث انخفاض من ايجابيات كاذبة ولكن انخفاض عدد الملفات الخبيثة التي توضع. انها عموما من الأفضل ترك هذه القيمة في الافتراضي إلا إذا كنت تعاني من مشاكل المتعلقة بها.</li>
</ul></div>

#### <div dir="rtl">"virustotal" (التصنيف)<br /></div>
<div dir="rtl">تعليمات VirusTotal.com.<br /><br /></div>

<div dir="rtl">"vt_public_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>اختياريا، phpMussel غير قادرة على مسح الملفات باستخدام الفيروسات مجموع API كوسيلة لتوفير مستوى تتعزز بشكل كبير من الحماية ضد الفيروسات، و ملفات التجسس، والبرمجيات الخبيثة وغيرها من التهديدات. افتراضيا، ملفات المسح الضوئي باستخدام الفيروسات مجموع API يتم تعطيل. لتمكينه، لا بد من وضع مفتاح API من الفيروسات إجمالي. ويرجع ذلك إلى فائدة كبيرة أن هذا يمكن أن توفر لك، هذا شيء أنا أوصي تمكين. يرجى أن يكون على علم، مع ذلك، أن استخدام الفيروسات مجموع API، التي يجب أن تتوافق مع شروط الخدمة، ويجب أن تلتزم جميع المبادئ التوجيهية حسب وصفه الفيروسات مجموع الوثائق! لا يجوز لك استخدام هذه الميزة التكامل ما لم :</li>
 <ul>
  <li>لقد قرأت ووافقت على شروط الخدمة من فيروس توتال و API لها. شروط الخدمة من فيروس توتال و API ليمكن العثور عليها <a href="https://www.virustotal.com/en/about/terms-of-service/">هنا</a>.</li>
  <li> لقد قرأت وفهمت، كحد أدنى، ديباجة الفيروسات وثائق API ملفه مجموع (كل شيء بعد "فايروس توتال V2.0 API العام" ولكن قبل "المحتويات"). يمكن العثور على وثائق API العام الفيروسات إجمالي <a href="https://www.virustotal.com/en/documentation/public-api/">هنا</a>.</li>
 </ul>
</ul></div>

<div dir="rtl">ملاحظة: إذا مسح الملفات باستخدام فيروس معطل مجموع API، فلن تحتاج إلى مراجعة أي من توجيهات في هذه الفئة ("virustotal")، لأن أيا منهم سوف تفعل أي شيء إذا تم تعطيل هذا. للحصول على الفيروسات مجموع مفتاح API، من أي مكان على موقعه على الانترنت، انقر على الرابط "تاريخ جماعتنا " التي تقع نحو الجزء العلوي الأيسر من الصفحة، أدخل المعلومات المطلوبة، ثم انقر على "اشترك" عند الانتهاء. اتباع جميع التعليمات المرفقة، وعندما كنت قد حصلت على مفتاح API العام، نسخ/لصق هذا المفتاح API العام إلى توجيه "vt_public_api_key" من "phpmussel.ini" ملف التكوين.<br /><br /></div>

<div dir="rtl">"vt_suspicion_level"<br /></div>
<div dir="rtl"><ul>
 <li>افتراضيا، سوف يقوم phpMussel بتقييد الملفات التي تقوم بمسح باستخدام الفيروسات API الكلي لتلك الملفات التي تعتبرها "المشبوهة". يمكنك ضبط اختياريا هذا التقييد عن طريق تغيير قيمة التوجيه "vt_suspicion_level".</li>
 <li>"0": تعتبر الملفات فقط مشبوهة إذا، عند مسحها بواسطة phpMussel باستخدام التواقيع الخاصة بها، وتعتبر أنها لحمل الوزن الكشف عن مجريات الأمور. وهذا يعني عمليا أن استخدام الفيروسات أن مجموع API يكون للرأي ثان لأنه عندما يشتبه phpMussel أن ملف يحتمل أن تكون ضارة، ولكن لا يمكن استبعاد تماما إلى أنه قد يحتمل أيضا أن تكون حميدة (غير الخبيثة)، وبالتالي لولاها عادة لا يرفضها أو العلم بأنها خبيثة.</li>
 <li>"1": تعتبر الملفات المشبوهة إذا، عند مسحها بواسطة phpMussel باستخدام التواقيع الخاصة بها، وتعتبر أنها لحمل الوزن الكشف عن مجريات الأمور، إذا كنت معروفة ليكون قابل للتنفيذ (ملفات PE، ملفات mach-o، ELF / لينكس، الخ)، أو إذا كنت معروفة لتكون ذات شكل التي يمكن أن تحتوي على بيانات قابلة للتنفيذ (مثل وحدات الماكرو القابلة للتنفيذ، DOC / ملفات DOCX، ملفات الأرشيف مثل RARS، الكود البريدية وغيرها). هذا هو مستوى الشكوك الافتراضية وأوصت للتطبيق، وهذا يعني فعليا أن استخدام الفيروسات أن مجموع API يكون للرأي ثان لأنه عندما phpMussel لا يجد في البداية أي شيء ضار أو خطأ في ملف أنها تعتبر أن تكون مشبوهة، وبالتالي سوف خلاف ذلك عادة لا يرفضها أو العلم بأنها خبيثة.</li>
 <li>"2": تعتبر جميع الملفات المشبوهة ويجب أن يتم فحصها باستخدام الفيروسات مجموع API. أنا لا أوصي عموما تطبيق هذا المستوى الشك، نظرا لخطر الوصول إلى الحصة API بشكل أسرع مما سيكون عليه الحال كثيرا، ولكن هناك ظروف معينة (مثل عندما المسئول عن الموقع أو المضيف لديها القليل جدا من الإيمان أو الثقة على الإطلاق في أي من المحتويات التي يتم تحميلها من مستخدميها) حيث هذا المستوى شك يمكن أن يكون مناسبا. مع هذا المستوى الشك، كل الملفات لا يتم حظر عادة أو ترفع العلم بأنها خبيثة سيتم مسحها ضوئيا باستخدام الفيروسات مجموع API. نلاحظ مع ذلك، أن phpMussel والتوقف عن استخدام الفيروسات API الكلي عندما تم التوصل إلى الحصص API الخاص بك (بغض النظر عن مستوى الشك)، والتي من المرجح أن يتم التوصل الحصص بشكل أسرع بكثير عند استخدام هذا المستوى الشك.</li>
</ul></div>

<div dir="rtl">ملاحظة: بغض النظر عن مستوى الشبهات، لن يتم فحصها أي الملفات التي إما أن تكون على القائمة السوداء أو التي أدرجها phpMussel باستخدام الفيروسات مجموع API، لان لقد أعلن هؤلاء مثل هذه الملفات بالفعل إما خبيثة أو حميدة من قبل phpMussel بحلول الوقت الذي كانوا لظل ذلك تم فحصها من قبل الفيروسات مجموع API، وبالتالي لن تكون هناك حاجة مسح إضافي. والقصد من قدرة phpMussel لمسح الملفات باستخدام الفيروسات مجموع API لبناء المزيد من الثقة لما إذا كان ملف خبيث أو حميد في هذه الظروف حيث phpMussel نفسها ليس من المؤكد تماما ما إذا كان ملف خبيث أو حميد.<br /><br /></div>

<div dir="rtl">"vt_weighting"<br /></div>
<div dir="rtl"><ul>
 <li>هل phpMussel يطبق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة أو الممكن كشفها؟ يوجد هذا التوجيه لأنه على الرغم من أن مسح ملف باستخدام محركات متعددة (كما فايروس توتال لا) ينبغي أن يؤدي في معدل اكتشاف زيادة (وبالتالي في عدد أكبر من الملفات الخبيثة الوقوع)، فإنه يمكن أن يؤدي أيضا إلى ارتفاع عدد كاذبة الإيجابيات، وبالتالي، في بعض الظروف، فإن نتائج المسح يمكن الاستفادة بشكل أفضل كما على درجة الثقة بدلا من أن تكون نتيجة محددة. إذا تم استخدام قيمة 0، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة و بالتالي إذا أي محرك تستخدم من قبل الفيروسات مجموع أعلام الملف تم مسحها ضوئيا بأنها خبيثة، وphpMussel النظر في الملف إلى تكون ضارة. إذا تم استخدام أي قيمة أخرى، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما الترجيح الكشف و بالتالي فإن عدد من المحركات المستخدمة من قبل الفيروسات إجمالي هذا العلم الملف تم مسحها ضوئيا بأنها خبيثة سيكون بمثابة نتيجة الثقة (أو الترجيح الكشف) عن ما إذا كان ملف تم مسحها ضوئيا ينبغي النظر الخبيثة التي كتبها phpMussel (القيمة المستخدمة سيمثل الحد الأدنى من الثقة يسجل أو الوزن المطلوب من أجل أن تعتبر ضارة). يتم استخدام قيمة 0 افتراضيا.</li>
</ul></div>

<div dir="rtl">"vt_quota_rate" و "vt_quota_time"<br /><br /></div>
<div dir="rtl"><ul>
 <li>استنادا إلى وثائق الفيروسات الكلي API، "فإنه يقتصر على الأكثر 4 طلبات من أي نوع في أي إطار زمني معين 1 دقيقة. إذا قمت بتشغيل honeyclient، مصيدة أو أي أتمتة الآخر الذي يجري لتوفير الموارد اللازمة لفايروس توتال ولا استرداد فقط تقارير يحق لك الحصول على أعلى حصص معدلات الطلب". افتراضيا، سوف phpMussel الالتزام الصارم لهذه القيود، ولكن نظرا لإمكانية هذه الحصص نسبة تجري زيادة، وتقدم هذه التوجيهات اثنين كوسيلة لتتمكن من إرشاد phpMussel على ما الحد الأقصى ينبغي أن تلتزم بها. إلا إذا كنت قد أعطيت تعليمات للقيام بذلك، فإنه من غير المستحسن بالنسبة لك لزيادة هذه القيم و لكن إذا كنت قد واجهت مشاكل تتعلق الوصول الحصص الخاصة بك، وخفض هذه القيم قد يساعد في بعض الأحيان كنت في التعامل مع هذه المشاكل. يتم تحديد الحد الأقصى معدل حسابك عن طلبات "vt_quota_rate" من أي نوع في أي إطار "vt_quota_time" الوقت دقيقة معين.</li>
</ul></div>

#### <div dir="rtl">"urlscanner" (التصنيف)<br /></div>
<div dir="rtl">تكوين فحص URL.<br /><br /></div>

<div dir="rtl">"urlscanner"<br /></div>
<div dir="rtl"><ul>
 <li>مدمج في phpMussel هو ماسح URL، قادر على الكشف عن عناوين المواقع الخبيثة من داخل أي بيانات أو ملفات تم فحصها. لتمكين الماسح URL، تعيين "urlscanner" التوجيه إلى صحيح. لتعطيله، تعيين هذا التوجيه إلى خطأ.</li>
</ul></div>

<div dir="rtl">ملاحظة: إذا تم تعطيل فحص URL، فلن تحتاج إلى مراجعة أي من توجيهات في هذه الفئة ("urlscanner")، لأن لا احد منهم سوف تفعل أي شيء إذا تم تعطيل هذا.<br /><br /></div>

<div dir="rtl">تكوين بحث API في فحص URL.<br /><br /></div>

<div dir="rtl">"lookup_hphosts"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين عمليات بحث API إلى API hpHosts عند وضع <a href="http://hosts-file.net/">hpHosts</a> على hpHosts لا يحتاج الى مفتاح API لأداء عمليات البحث API.</li>
</ul></div>

<div dir="rtl">"google_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين عمليات بحث API إلى API التصفح الآمن من Google عندما يتم تعريف مفتاح API الضروري. التصفح الآمن في جوجل: عمليات البحث API بحاجة إلى مفتاح API، والتي يمكن الحصول عليها من <a href="https://console.developers.google.com/">هنا</a>.</li>
 <li>ملاحظة: مطلوب تمديد cURL من أجل استخدام هذه الميزة.</li>
</ul></div>

<div dir="rtl">"maximum_api_lookups"<br /></div>
<div dir="rtl"><ul>
 <li>العدد الأقصى المسموح به من عمليات بحث واجهة برمجة التطبيقات لأداء في تكرار المسح الفردية. لأن كل بحث API إضافية سوف يضيف إلى الوقت الإجمالي المطلوب لإكمال كل تكرار المسح ، قد ترغب في اشتراط وجود قيود من أجل الإسراع في عملية المسح الشاملة. عند تعيينها إلى 0، سيتم تطبيق الحد الأقصى لا هذا العدد المسموح به. تعيين إلى 10 افتراضيا.</li>
</ul></div>

<div dir="rtl">"maximum_api_lookups_response"<br /></div>
<div dir="rtl"><ul>
 <li>ماذا تفعل إذا تم تجاوز الحد الأقصى المسموح به من عمليات بحث API؟ = كاذبة لا تفعل شيئا (متابعة المعالجة) [افتراضي]. صحيح = تحديد الملف.</li>
</ul></div>

<div dir="rtl">"cache_time"<br /></div>
<div dir="rtl"><ul>
 <li>متى (بالثواني) يجب التوصل إلى نتائج عمليات بحث API؟ الافتراضي هو 3600 ثانية (1 ساعة).</li>
</ul></div>

#### <div dir="rtl">"template_data" (التصنيف)<br /></div>
<div dir="rtl">توجيهات/متغيرات القوالب والمواضيع.<br /><br /></div>

<div dir="rtl">تتعلق البيانات بقالب انتاج HTML تستخدم لتوليد "رفض تحميل " الرسالة المعروضة للمستخدمين على تحميل ملف حجبها. إذا كنت تستخدم موضوعات مخصصة لـ phpMussel، هو مصدر إخراج HTML من ملف "template_custom.html" وغيرها ، ويتم الحصول على إخراج HTML من ملف "template.html". يتم تحليل المتغيرات الخطية لهذا القسم من ملف التكوين إلى إخراج HTML عن طريق استبدال أي أسماء المتغيرات محاط بواسطة الأقواس الموجودة داخل إخراج HTML مع البيانات المتغيرة المناظرة. فمثلا، أين `foo="bar"`، أي مثيل `<p>{foo}</p>` وجدت داخل إخراج HTML ستصبح `<p>bar</p>`.<br /><br /></div>

<div dir="rtl">"css_url"<br /></div>
<div dir="rtl"><ul>
 <li>ملف الصيغة النموذجية للمواضيع مخصصة يستخدم خصائص CSS الخارجية ، في حين أن ملف قالب لموضوع الافتراضي يستخدم خصائص CSS الداخلية. لإرشاد phpMussel لاستخدام ملف النموذجية للمواضيع مخصصة ، تحديد عنوان HTTP العام من ملفات CSS موضوع المخصصة لديك باستخدام "css_url" متغير. إذا تركت هذا الحقل فارغا متغير ، سوف يقوم phpMussel باستخدام ملف القالب لموضوع التقصير.</li>
</ul></div>

---


### <div dir="rtl">7. <a name="SECTION7"></a>شكل/تنسيق التوقيع</div>

####*<div dir="rtl">توقيعات اسم الملف</div>*
<div dir="rtl">كل توقيعات اسم الملف تتبع التنسيق التالي:<br /><br /></div>

`NAME:FNRX`

<div dir="rtl">حيث "NAME" هو الاسم المذكور في التوقيع و "FNRX" نمط التعابير المنطقية بحيث تتطابق الأسماء (الغير مشفرة) مقابله.<br /><br /></div>

####*<div dir="rtl">توقيعات MD5</div>*
<div dir="rtl">جميع التوقيعات MD5 تتبع التنسيق:<br /><br /></div>

`HASH:FILESIZE:NAME`

<div dir="rtl">حيث "HASH" هي تجزئة "MD5" للملف كله، و "FILESIZE" هي الحجم الإجمالي لذلك الملف و "NAME" هو الاسم المذكور في التوقيع.<br /><br /></div>

####*<div dir="rtl">توقيعات أرشيف البيانات الوصفية</div>*
<div dir="rtl">جميع توقيعات أرشيف البيانات الوصفية تتبع التنسيق:<br /><br /></div>

`NAME:FILESIZE:CRC32`

<div dir="rtl">حيث "NAME" هو الاسم المذكور لهذا التوقيع، حجم الملف هو الحجم الكلي (غير مضغوط) للملف الوارد في الأرشيف و "CRC32" هو المجموع الاختباري لذلك الملف الوارد.<br /><br /></div>

####*<div dir="rtl">توقيعات PE الجزئية</div>*
<div dir="rtl">جميع توقيعات PE الجزئية تتبع التنسيق:<br /><br /></div>

`SIZE:HASH:NAME`

<div dir="rtl">حيث "HASH" هو تجزئة "MD5" لجزء من ملف PE، "SIZE" هو الحجم الكلي لهذا القسم، "NAME" هو الاسم المذكور في التوقيع.<br /><br /></div>

####*<div dir="rtl">توقيعات PE الموسعة</div>*
<div dir="rtl">جميع توقيعات PE الموسعة تتبع التنسيق:<br /><br /></div>

`$VAR:HASH:SIZE:NAME`

<div dir="rtl">حيث "$VAR" هو اسم المتغير PE للتطابق معه، "HASH" هو تجزئة "MD5" هذا المتغير، "SIZE" هو الحجم الكلي لهذا المتغير والاسم هو الاسم المذكور في التوقيع.<br /><br /></div>

####*<div dir="rtl">توقيعات قائمة السماح</div>*
<div dir="rtl">جميع توقيعات قائمة السماح تتبع التنسيق:<br /><br /></div>

`HASH:FILESIZE:TYPE`

<div dir="rtl">حيث "HASH" هو تجزئة "MD5" لكامل الملف "FILESIZE" هو الحجم الكلي لهذا الملف و "TYPE" هو نوع تحصين توقيعات ملف قائمة السماح.<br /><br /></div>

####*<div dir="rtl">التوقيعات المركبة الموسعة</div>*
<div dir="rtl">التواقيع المركبة الموسعة هي مختلفة عن أنواع أخرى من التوقيعات المحتملة مع phpMussel، في أنهم يقومون بمطابقة مع ما تم تعيينه من قبل التوقيعات أنفسهم وأنها يمكن أن تتطابق ضد معايير متعددة. محدد مع معايير المطابقة ";" ونوع المطابقة و بيانات المطابقة و كل معايير المطابقة محددة بواسطة ":" ذلك أن شكل هذه التوقيعات يميل قليلا إلى مثل:<br /><br /></div>

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

####*<div dir="rtl">كل شيء آخر</div>*
<div dir="rtl">جميع التوقيعات الأخرى تتبع التنسيق:<br /><br /></div>

`NAME:HEX:FROM:TO`

<div dir="rtl">حيث "NAME" هو الاسم المذكور لهذا التوقيع و "HEX" هو الترميز الجزئي السادس عشري من الملف المراد أن يقابله تواقيع معينة. من وإلى المعاملات الاختيارية، مشيرا من خلالها إلى المواضع في البيانات المصدر للتحقق منها.<br /><br /></div>

####*<div dir="rtl">التعابير المنطقية</div>*
<div dir="rtl">أي شكل من أشكال التعابير المنطقية يتم فهمها ومعالجتها بشكل صحيح عن طريق PHP و يجب أيضا أن يكون مفهوما بشكل صحيح و تتم معالجتها بواسطة phpMussel و توقيعاتها. مع ذلك، أود أن أقترح اتخاذ الحذر الشديد عند كتابة توقيعات التعابير المنطقية الجديدة، لأنه إذا لم تكن متأكدا تماما مما تفعله، يمكن أن يكون هناك عدم انتظام كبير و/أو نتائج غير متوقعة. القي نظرة على phpMussel مصدر الترميز إذا لم تكن متأكدا تماما من السياق الذي يتم تحليل البيانات باستخدام التعابير المنطقية. أيضا، تذكر أن كل أنماط (باستثناء اسم الملف، أرشيف البيانات الوصفية وأنماط MD5) يجب أن تتبع ترميز سادس عشري(عند تركيب نمط ما، بالتأكيد)!<br /><br /></div>

####*<div dir="rtl">أين يضع التوقيعات المخصصة؟</div>*
<div dir="rtl">فقط ضع التوقيعات المخصصة في تلك الملفات المعدة للتوقيعات مخصصة. ينبغي أن تتضمن تلك الملفات "_custom" في أسماء الملفات الخاصة بهم. يجب عليك أيضا تجنب تحرير ملفات التوقيع الافتراضي، إلا إذا كنتم تعرفون بالضبط ما تفعلونه، لأنه بصرف النظر عن كونها ممارسة جيدة بشكل عام، و بعيدا عن مساعدتك على التمييز بين التوقيعات الخاصة بك والتوقيعات الافتراضية المتضمنة في phpMussel، انها جيدة للتحرير فقط على الملفات المعدة للتحرير لأن العبث في ملفات التوقيع الافتراضي يمكن أن تسبب لهم التوقف عن العمل بشكل صحيح، ويرجع ذلك إلى ملفات "خرائط": ملفات الخرائط في phpMussel حيث في ملفات التوقيع للبحث عن التوقيعات المطلوبة بواسطة phpMussel عند الحاجة، ويمكن لهذه الخرائط أن تصبح غير متزامنة مع توقيع الملفات المرتبطة بها إذا تم العبث بملفات التوقيع معه. يمكنك وضع حد كبير ما تريد في التوقيعات المخصصة، طالما كنت تتبع بناء الجملة الصحيح. مع ذلك، وتوخي الحذر لاختبار توقيعات جديدة ل-فحص خاطئ مسبقا إذا كنت تنوي مشاركتها أو استخدامها في بيئة حية.<br /><br /></div>

####*<div dir="rtl">التوزيع التفصيلي للتوقيع</div>*
<div dir="rtl">فيما يلي تفصيل لأنواع التوقيعات التي يستخدمها phpMussel:<br /><br /></div>
<div dir="rtl"><ul>
 <li>"التوقيعات التي تمت تسويتها بواسطة ASCII" (ascii_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"التوقيعات المركبة الموسعة" (coex_*). نوع مطابقة التواقيع المختلطة.</li>
 <li>"توقيعات ELF" (elf_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص ومطابقة لتنسيق ELF.</li>
 <li>"التواقيع المحمولة القابلة للتنفيذ"  (exe_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص ومطابقة لتنسيق PE.</li>
 <li>"توقيعات اسم الملف"  (filenames_*). تم الفحص ضد أسماء الملفات المستهدفة للفحص.</li>
 <li>"التوقيعات العامة" (general_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات الرسومات" (graphics_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص و معروف كذلك كملف رسومات.</li>
 <li>"الاوامر العامة" (hex_general_commands.csv). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"التوقيعات التي تمت تسويتها بواسطة HTML" (html_*). تم الفحص ضد محتويات كل ملف HTML غير الموجودة في قائمة السماح المستهدفة للفحص.</li>
 <li>"توقيعات Mach-O" (macho_*). تم الفحص ضد محتويات كل ملف غير موجود في لائحة السماح المستهدفة للفحص ومطابقة لتنسيق Mach-O.</li>
 <li>"توقيعات البريد" (mail_*). تم الفحص ضد محتويات كل كائن EML غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات MD5" (md5_*). تم الفحص ضد تجزئة MD5 من محتويات وحجم الملف من كل ملف غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات أرشيف البيانات الوصفية" (metadata_*). فحص ضد تجزئة CRC32 الملف وحجم الملف الأولي الموجودة داخل أي أرشيف غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات OLE" (ole_*). تم الفحص ضد محتويات كل كائن OLE غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات PDF" (pdf_*). تم الفحص ضد محتويات كل كائن PDF غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"التوقيعات الفرعية المحمولة القابلة للتنفيذ" (pe_*). تم الفحص ضد تجزئة MD5 وحجم كل قسم PE من كل ملف غير موجود في لائحة السماح المستهدفة للفحص ومطابقة لتنسيق PE.</li>
 <li>"التوقيعات الموسعة المحمولة القابلة للتنفيذ" (pex_*). تم الفحص ضد تجزئة MD5 وحجم المتغيرات داخل كل ملف غير موجود في لائحة السماح المستهدفة للفحص ومطابقة لتنسيق PE.</li>
 <li>"توقيعات SWF" (swf_*). تم الفحص ضد محتويات كل ملف بالمستخدمين غير موجود في لائحة السماح المستهدفة للفحص.</li>
 <li>"توقيعات قائمة السماح" (whitelist_*). تم الفحص ضد تجزئة MD5 من محتويات وحجم الملف من كل ملف المستهدفة للفحص. الملفات المتطابقة سوف تكون في مأمن من أن يقابله نوع من التوقيع المذكورة في دخولهم قائمة السماح.</li>
 <li>"توقيعات XML/XDP" (xmlxdp_*). تم الفحص ضد أي قطع XML/XDP وجدت داخل أي ملفات غير لائحة السماح المستهدفة للفحص.</li>
</ul></div>
<div dir="rtl">(لاحظ أن أي من هذه التوقيعات قد يتم تعطيل بسهولة عبر "phpmussel.ini").<br /><br /></div>

---


### <div dir="rtl">8. <a name="SECTION8"></a>مشاكل التوافق المعروفة</div>

####<div dir="rtl">PHP و PCRE</div>

<div dir="rtl">phpMussel يتطلب PHP و PCRE لتنفيذ وظيفته بشكل صحيح و بدون أحدهما أو كلاهما فإن البرنامج لن يعمل بشكل صحيح. تأكد من أن نظامك يمتلك كلا من PHP و PCRE مثبتين و متاحين قبل أن تقوم بتنزيل و تثبيت phpMussel.<br /><br /></div>

####<div dir="rtl">التوافق البرمجي لبرنامج مكافحة الفيروسات</div>

<div dir="rtl">بالنسبة للجزء الأكبر، ينبغي أن يكون phpMussel متوافق إلى حد ما مع معظم برامج مكافحة و فحص الفيروسات الأخرى. مع ذلك، فقد تم الإبلاغ عن تعارضات من قبل عدد من المستخدمين في الماضي. وهذه المعلومات أدناه من VirusTotal.com، و توضح عدد من ايجابيات كاذبة (فحص خاطئ بوجود فايروس) ذكرت من قبل مختلف برامج مكافحة الفيروسات ضد phpMussel. على الرغم من أن هذه المعلومات ليست ضمانة مطلقة من أنك سوف تواجه أو لا مشاكل توافق بين phpMussel وبرنامج مكافحة الفيروسات الخاص بك، إذا لاحظ برنامج مكافحة الفيروسات الخاص بك ضعف تجاه phpMussel، يجب عليك إما النظر في تعطيله قبل العمل مع phpMussel أو أن تنظر في خيارات بديلة إما الخاصة ببرنامج مكافحة الفيروسات أو phpMussel.<br /><br /></div>

<div dir="rtl">آخر تحديث لهذه المعلومات كان في 21 أبريل 2016، و هي كذلك الحالية للإصدارين الثانويين الذين تم إصدارهما مؤخرا (v0.10.0-v1.0.0) من phpMussel.<br /><br /></div>

برنامج فحص الفيروسات | النتيجة
----|----
Ad-Aware | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
AegisLab | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Agnitum | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
AhnLab-V3 | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Alibaba | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
ALYac | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
AntiVir | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Antiy-AVL | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Arcabit | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Avast | <div dir="rtl" style="display:inline;">"JS:ScriptSH-inf [Trj]" تقارير</div>
AVG | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Avira | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
AVware | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Baidu | <div dir="rtl" style="display:inline;">"VBS.Trojan.VBSWG.a" تقارير</div>
Baidu-International | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
BitDefender | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Bkav | <div dir="rtl" style="display:inline;">"VEXC640.Webshell"، "VEXD737.Webshell"، "VEX5824.Webshell" تقارير</div>
ByteHero | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
CAT-QuickHeal | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
ClamAV | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
CMC | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Commtouch | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Comodo | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Cyren | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
DrWeb | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Emsisoft | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
ESET-NOD32 | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
F-Prot | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
F-Secure | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Fortinet | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
GData | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Ikarus | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Jiangmin | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
K7AntiVirus | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
K7GW | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Kaspersky | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Kingsoft | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Malwarebytes | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
McAfee | <div dir="rtl" style="display:inline;">"New Script.c" تقارير</div>
McAfee-GW-Edition | <div dir="rtl" style="display:inline;">"New Script.c" تقارير</div>
Microsoft | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
MicroWorld-eScan | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
NANO-Antivirus | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Norman | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
nProtect | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Panda | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Qihoo-360 | <div dir="rtl" style="display:inline;">"Script/Trojan.Script.393" تقارير</div>
Rising | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Sophos | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
SUPERAntiSpyware | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Symantec | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Tencent | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
TheHacker | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
TotalDefense | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
TrendMicro | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
TrendMicro-HouseCall | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
VBA32 | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
VIPRE | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
ViRobot | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Zillya | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>
Zoner | <div dir="rtl" style="display:inline;">لا مشاكل معروفة</div>

---


<div dir="rtl">آخر تحديث: 3 يونيو 2016 (2016.06.03).</div>
