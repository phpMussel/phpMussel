## <div dir="rtl">phpMussel بالعربية</div>

### <div dir="rtl">المحتويات:</div>
<div dir="rtl"><ul>
 <li>١. <a href="#SECTION1">مقدمة</a></li>
 <li>٢. <a href="#SECTION2">كيفية التحميل</a></li>
 <li>٣. <a href="#SECTION3">كيفية الإستخدام</a></li>
 <li>٤. <a href="#SECTION4">إدارة FRONT-END</a></li>
 <li>٥. <a href="#SECTION5">CLI (واجهة سطر الأوامر)</a></li>
 <li>٦. <a href="#SECTION6">الملفات الموجودة في هذه الحزمة</a></li>
 <li>٧. <a href="#SECTION7">خيارات التكوين/التهيئة</a></li>
 <li>٨. <a href="#SECTION8">شكل/تنسيق التوقيع</a></li>
 <li>٩. <a href="#SECTION9">مشاكل التوافق المعروفة</a></li>
 <li>١٠. <a href="#SECTION10">أسئلة وأجوبة (FAQ)</a></li>
 <li>١١. <a href="#SECTION11">المعلومات القانونية</a></li>
</ul></div>

<div dir="rtl"><em>ملاحظة بخصوص ترجمة: في حالة الأخطاء (على سبيل المثال، التناقضات بين الترجمات، الأخطاء المطبعية، إلخ)، النسخة الإنجليزية من هذه الوثيقة هو تعتبر النسخة الأصلية وموثوق. إذا وجدت أي أخطاء، سيكون موضع ترحيب مساعدتكم في تصحيحها.</em></div>

---


### <div dir="rtl">١. <a name="SECTION1"></a>مقدمة</div>

<div dir="rtl">شكراً لك على إستخدام phpMussel، المبرمج بلغة PHP للكشف عن ملفات الإختراق والفيروسات والبرمجيات الخبيثة الموجودة حيث يعتمد السكربت على توقيعات ClamAV وغيرها.<br /><br /></div>

<div dir="rtl">حقوق النشر محفوظة ل phpMussel لعام ٢٠١٣ وما بعده تحت رخصة GNU/GPLv2 للمبرمج (Caleb M (Maikuolan.<br /><br /></div>

<div dir="rtl">هذا البرنامج مجاني، يمكنك تعديله وإعادة نشره تحت رخصة GNU. نشارك هذا السكربت على أمل أن تعم الفائدة لكن لا نتحمل أية مسؤولية أو أية ضمانات لاستخدامك، اطلع على تفاصيل رخصة GNU للمزيد من المعلومات عبر الملف "LICENSE.txt" وللمزيد من المعلومات:</div>
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

<div dir="rtl">شكر خاص ل<a href="http://www.clamav.net/">ClamAV</a> لكل من الإلهام للمشروع والتواقيع التي يعمد عليها السكربت، والتي من دونها كان من الممكن أن لا يتم إنجاز هذا البرنامج أو بأفضل الأحوال ستكون قيمته محدودة جداً.<br /><br /></div>

<div dir="rtl">شكر خاص أيضاً ل SourceForge و GitHub لإستضافتهم ملفات المشروع، وأيضاً لمصادر التوقيعات التي يستخدمها phpMussel مثل: <a href="http://www.securiteinfo.com/">SecuriteInfo.com</a> و <a href="http://www.phishtank.com/">PhishTank</a> و <a href="http://nlnetlabs.nl/">NLNetLabs</a> وغيرهم، والشكر مقدم لكل من يدعم المشروع وشكراً لك لاستخدامك للسكربت.<br /><br /></div>

<div dir="rtl">هذا المستند و الحزم المرتبطة به يمكن تحميلها مجاناً من:</div>

- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### <div dir="rtl">٢. <a name="SECTION2"></a>كيفية التحميل</div>

#### <div dir="rtl">٢.٠ تثبيت يدويا (لخدمات الويب)</div>

<div dir="rtl">١. بقراءتك لهذا سنفرض بأنك قمت بتحميل السكربت، من هنا عليك العمل على جهازك المحلي أو نظام إدارة المحتوى لإضافة هذه الأمور، مجلد مثل <code dir="ltr">"/public_html/phpmussel/"</code> أو ما شابه سيكون كاف.<br /><br /></div>

<div dir="rtl">٢. إعادة تسمية <code dir="ltr">"config.ini.RenameMe"</code> إلى "config.ini" (تقع داخل "vault")، واختياريا (هذه الخطوة اختيارية ينصح بها للمستخدمين المتقدمين ولا ينصح بها للمبتدئين)، افتحه، وعدل الخيارات كما يناسبك (أعلى كل خيار يوجد وصف مختصر للوظيفة التي يقوم بها).<br /><br /></div>

<div dir="rtl">٣. إرفع الملفات للمجلد الذي اخترته(لست بحاجة لرفع "<code dir="ltr">*.txt/*.md</code>" لكن في الغالب يجب أن ترفع جميع الملفات).<br /><br /></div>

<div dir="rtl">٤. غير التصريح لمجلد vault للتصريح "755" (إذا كان هناك مشاكل، يمكنك محاولة "777"، ولكن هذه ليست آمنة). المجلد الرئيسي الذي يحتوي على الملفات-المجلد الذي اخترته سابقاً-، بالعادة يمكن تجاهله، لكن يجب التأكد من التصريح إذا واجهت مشاكل في الماضي(إفتراضيا يجب أن يكون "755"). باختصار: لكي تعمل الحزمة بشكل صحيح، يجب أن تكون PHP قادرة على قراءة وكتابة الملفات داخل دليل <code dir="ltr">vault</code>. العديد من الأشياء (التحديث، التسجيل، الخ) لن تكون ممكنة، إذا تعذر على PHP الكتابة إلى دليل <code dir="ltr">vault</code>، ولن تعمل الحزمة على الإطلاق إذا تعذر على PHP القراءة من دليل <code dir="ltr">vault</code>. ومع ذلك، للحصول على الأمان الأمثل، يجب ألا يكون دليل <code dir="ltr">vault</code> متاحًا للجميع (المعلومات الحساسة، مثل المعلومات التي يحتوي عليها <code dir="ltr">config.ini</code> أو <code dir="ltr">frontend.dat</code>، يمكن أن تتعرض لمهاجمين محتملين إذا كان دليل <code dir="ltr">vault</code> متاحًا للجميع).<br /><br /></div>

<div dir="rtl">٥. تثبيت أي التوقيعات التي ستحتاج إليها. <em>نرى: <a href="#INSTALLING_SIGNATURES">تثبيت التوقيعات</a>).</em><br /><br /></div>

<div dir="rtl">٦. الآن أنت بحاجة لربط phpMussel لنظام إدارة المحتوى أو النظام الذي تستخدمه، هناك عدة طرق لفعل هذا لكن أسهل طريقة ببساطة إضافة السكربت لبداية النواة في نظامك (سيتم إعادة التحميل لكل وصول لأي صفحة في الموقع) بإستخدام جمل "require" أو "include"، بالعادة سيتم التخزين في "/includes"، "/assets" أو "/functions"، وسيتم تسميته بالغالب مثل: "init.php"، "common_functions.php"، "functions.php" أو ما شابه. من الممكن أن تكون مستخدم ل CMS لذا يمكن أن أقدم بعض المساعدة بخصوص هذا الموضوع، لإستخدام "require" أو "include" قم بإضافة الكود التالي لبداية الملف الرئيسي لبرنامجك، عدل النص الموجود داخل علامات التنصيص لمسار "loader.php" لديك.<br /><br /></div>

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

<div dir="rtl">إحفظ الملف ثم قم بإعادة رفعه.<br /><br /></div>

<div dir="rtl">-- أو بدلاً من ذلك --<br /><br /></div>

<div dir="rtl">إذا كنت تستخدم Apache webserver وتستطيع الوصول ل "php.ini"، بإستطاعتك إستخدام "auto_prepend_file" للتوجيه ل phpMussel لكل طلب مثل:<br /><br /></div>

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

<div dir="rtl">أو هذا في ملف ".htaccess":<br /><br /></div>

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

<div dir="rtl">٧. لقد إنتهيت لكن يجب عليك التأكد من أن كل شيئ على ما يرام، للتأكد حاول رفع ملفات الفحص الموجودة في الحزمة _testfiles لموقعك، إذا كل شيئ يعمل على ما يرام يجب أن تظهر رسالة من phpMussel لتأكيد على أنه تم حجب الملفات المرفوعة بنجاح، إذا لم يظهر شيئ إذاً هناك شيئ لا يعمل على ما يرام، إذا كنت تستخدم إضافات متقدمة أو أدوات فحص أخرى أقترح أن تجرب من خلالهم أيضاً للتأكد إذا ما كان كل شيئ على ما يرام.<br /><br /></div>

#### <div dir="rtl">٢.١ تثبيت يدويا (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">١. بقراءتك لهذا سنفرض بأنك قمت بتحميل السكربت، من هنا عليك العمل على جهازك المحلي.<br /><br /></div>

<div dir="rtl">٢. يتطلب phpMussel أن يتم تثبيت PHP على الجهاز المضيف من أجل تنفيذه. إذا لم يكن PHP مثبتا على جهازك، الرجاء قم بتثبيت PHP على جهازك، و اتبع أي تعليمات يقدمها مثبت PHP.<br /><br /></div>

<div dir="rtl">٣. هذه الخطوة اختيارية ينصح بها للمستخدمين المتقدمين ولا ينصح بها للمبتدئين، إفتح "config.ini" الموجود داخل vault هذا الملف يحتوي جميع التعليمات ل phpMussel، أعلى كل خيار يوجد وصف مختصر للوظيفة التي يقوم بها، عدل الخيارات كما يناسبك.<br /><br /></div>

<div dir="rtl">٤. بشكل إختياري، يمكنك إستخدام phpMussel لواجهة سطر الأوامر بإنشاء ملف "باتش" لتحميل PHP و phpMussel تلقائياً، للقيام بهذا إفتح محرر النصوص مثل Notepad++ ثم أكتب المسار الكامل لملف "php.exe" الموجود في دليل التثبيت متبوع بمسافة ثم المسار الكامل لملف "loader.php" احفظ الملف بصيغة "bat."، إفتح الملف الذي قمت بإنشاءه لتشغيل phpMussel في المستقبل.<br /><br /></div>

<div dir="rtl">٥. تثبيت أي التوقيعات التي ستحتاج إليها. <em>نرى: <a href="#INSTALLING_SIGNATURES">تثبيت التوقيعات</a>).</em><br /><br /></div>

<div dir="rtl">٦. في هذه المرحلة، لقد انتهيت! ومع ذلك فربما يجب عليك اختباره للتأكد من أنه يعمل بشكل صحيح. لاختبار phpMussel، قم بتشغيله و حاول فحص الدليل "_testfiles" المتوفر مع الحزمة.<br /><br /></div>

#### <div dir="rtl">٢.٢ تثبيت مع COMPOSER</div>

<div dir="rtl"><a href="https://packagist.org/packages/phpmussel/phpmussel">يتم تسجيل phpMussel مع Packagist</a>، و بالتالي، إذا كنت على دراية به، يمكنك استخدامه لتثبيت phpMussel (ستظل بحاجة إلى إعداده على الرغم من ذلك؛ نرى "تثبيت يدويا (لخدمات الويب)" الخطوتين ٢ و ٦).<br /><br /></div>

`composer require phpmussel/phpmussel`

#### <div dir="rtl"><a name="INSTALLING_SIGNATURES"></a>٢.٣ تثبيت التوقيعات</div>

<div dir="rtl">منذ v1.0.0، لا يتم تضمين التوقيعات في الحزمة الرئيسية. التوقيعات مطلوبة من قبل phpMussel للكشف عن تهديدات محددة. هناك 3 طرق رئيسية لتثبيت التوقيعات:<br /><br /></div>

<div dir="rtl"><ul>
 <li>١. تثبيت تلقائيا باستخدام الصفحة الأمامية التحديثات.</li>
 <li>٢. توليد التوقيعات باستخدام "SigTool" وتثبيت يدويا.</li>
 <li>٣. تحميل التوقيعات من <code dir="ltr">"phpMussel/Signatures"</code> وتثبيت يدويا.</li>
</ul></div>

##### <div dir="rtl">٢.٣.١ تثبيت تلقائيا باستخدام الصفحة الأمامية التحديثات.</div>

<div dir="rtl">أولا، ستحتاج إلى التأكد من تمكين front-end. نرى: <a href="#SECTION4">إدارة FRONT-END</a>.<br /><br /></div>

<div dir="rtl">ثم، ستحتاج إلى الانتقال إلى صفحة التحديثات، العثور على ملفات التوقيع اللازمة، واستخدام الخيارات المتوفرة على الصفحة، وتثبيتها، وتنشيطها.<br /><br /></div>

##### <div dir="rtl">٢.٣.٢ توليد التوقيعات باستخدام "SigTool" وتثبيت يدويا.</div>

<div dir="rtl">نرى: <a href="https://github.com/phpMussel/SigTool#documentation">وثائق SigTool</a>.<br /><br /></div>

##### <div dir="rtl">٢.٣.٣ تحميل التوقيعات من <code dir="ltr">"phpMussel/Signatures"</code> وتثبيت يدويا.</div>

<div dir="rtl">أولا، اذهب إلى <a href="https://github.com/phpMussel/Signatures" dir="ltr">phpMussel/Signatures</a>. يحتوي المستودع على ملفات توقيع GZ مضغوط مختلفة. تحميل الملفات التي تحتاج إليها، فك ضغطها، ونسخ الملفات المضغوطة إلى الدليل <code dir="ltr">/vault/signatures</code> لتثبيتها. قم بإدراج أسماء الملفات المنسوخة إلى التوجيه <code dir="ltr">Active</code> في تهيئة phpMussel لتنشيطها.<br /><br /></div>

---


### <div dir="rtl">٣. <a name="SECTION3"></a>كيفية الإستخدام</div>

#### <div dir="rtl">٣.٠ كيفية الإستخدام (لخدمات الويب)</div>

<div dir="rtl">لقد تم إعداد phpMussel ليكون البرنامج النصي الذي سوف يعمل بشكل مرضي على جهازك مع الحد الأدنى من المتطلبات على جهازك: بمجرد تثبيته بشكلي أساسي فإنه ببساطة يجب أن يعمل.<br /><br /></div>

<div dir="rtl">سيتم فحص الملفات تلقائياً لقد تم إعداده إفتراضياً لذا ليس عليك القيام بشيئ.<br /><br /></div>

<div dir="rtl">مع ذلك، فإنك قادراً أيضاً على إرشاد phpMussel لمسح ملفات معينة مثل الدلائل و/ أو المحفوظات. للقيام بذلك فعليك أولاً: سوف تحتاج إلى التأكد من أن يتم تعيين التكوين المناسب في ملف "config.ini" (يجب تعطيل عملية التنظيف) وعندما تنتهي من ذلك، في ملف PHP و الذي تم ربطه مع phpMussel، استخدم الدالة التالية في التعليمة البرمجية "الكود" الذي ستضعه:<br /><br /></div>

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

<div dir="rtl"><ul>
 <li><code dir="ltr">$what_to_scan</code> يمكن أن تكون سلسلة، مصفوفة، أو مجموعة من المصفوفات، وتشير إلى أي ملف/ملفات، دليل و/أو دلائل ليتم إجراء المسح عليها.</li>
 <li><code dir="ltr">$output_type</code> هي قيمة منطقية تدل على نتائج الفحص ليتم إرجاعها كالتالي، الخطأ يرشد الدالة لإرجاع نتائج الفحص على شكل عدد (النتائج المرجعة -3 تشير إلى مشاكل واجهها phpMussel مع التوقيعات أو ملفات خريطة التوقيع و التي من الممكن أن تكون مفقودة أو تالفة، -2 تشير إلى أنه تم الكشف عن بيانات تالفة خلال الفحص وبالتالي فشل في إكمال الفحص، 0 يشير إلى أن هدف الفحص غير موجود و بالتالي لم تكن هناك حاجة لعملية الفحص، 1 يشير إلى أن الهدف تم فحصه بنجاح و لم يتم الكشف عن أي مشاكل، 2 يشير إلى أن الهدف تم فحصه بنجاح و تم الكشف عن مشاكل. القيمة الصحيحة ترشد الدالة لإرجاع نتائج الفحص كنص مقروء للبشر. بالإضافة إلى ذلك، في كلتا الحالتين، يمكن الوصول إلى النتائج عبر المتغيرات العالمية بعد اكتمال الفحص. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
 <li><code dir="ltr">$output_flatness</code> هي قيمة منطقية تشير إلى دالة بالعودة لنتائج الفحص من النوعين (عندما يكون هناك أهداف فحص متعددة)، سواء خاطئة فتعود النتائج على شكل مصفوفة، أو صحيحة فتعود النتائج على شكل سلسلة. هذا المتغير هو اختياري و إذا لم تحدد فالافتراضي هو القيمة الخطأ.</li>
</ul></div>

<div dir="rtl">أمثلة:<br /><br /></div>

```PHP
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

<div dir="rtl">للحصول على مفعول كامل لأي من التوقيعات التي يستخدمها phpMussel أثناء التفحص، وكيف يتعامل مع هذه التوقيعات، راجع قسم (٨) <a href="#SECTION8">دستخط فارمیٹ</a> في هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">إذا واجهت أي إيجابيات زائفة أي إذا واجهت شيئا جديدا تعتقد أنه يجب أن يكون قد تم حظره أو أي شيء آخر بخصوص التوقيعات، فيرجى الاتصال بي لإبلاغي عن ذلك حتى أستطيع إجراء التغييرات اللازمة، والتي إذا لم تقوم بالاتصال بي، فإنني قد لا أكون منتبه لها. <em>(نرى: <a href="#WHAT_IS_A_FALSE_POSITIVE">ما هو "إيجابية خاطئة"؟</a>).</em><br /><br /></div>

<div dir="rtl">لتعطيل التواقيع التي يتضمنها phpMussel (مثل إذا كنت تعاني من إيجابية زائفة محددة لأغراضك التي لا ينبغي أن يتم عادة إزالتها)، قم بإضافة أسماء التوقيع المحدد المراد تعطيله إلى التوقيعات ملف قائمة رمادية (<code dir="ltr">/vault/greylist.csv</code>)، مفصولة بفواصل.<br /><br /></div>

<div dir="rtl">أنظر أيضا: <a href="#SCAN_DEBUGGING">كيفية الوصول إلى تفاصيل محددة حول الملفات عند مسحها ضوئيا؟</a><br /></div>

#### <div dir="rtl">٣.١ كيفية الاستخدام (لخدمات واجهة سطر الأوامر)</div>

<div dir="rtl">يرجى الرجوع إلى قسم "تثبيت يدويا (لخدمات واجهة سطر الأوامر)" من هذا الملف التمهيدي.<br /><br /></div>

<div dir="rtl">كما يجب أن تدرك أن phpMussel فمن الماسح الضوئي <em>على الطلب</em>؛ وهي ليست الماسح الضوئي <em>على وصول</em> (مع استثناء ل تحميل الملف، عندما يحدث). وعلى عكس البرامج التقليدية لمكافحة الفيروسات فإنها لا تراقب الذاكرة النشطة! لكنها سوف تكشف عن الفيروسات فقط الواردة في تلك الملفات المحددة التي طلبت منه فحصها، وفي تحميل الملف.<br /><br /></div>

---


### <div dir="rtl">٤. <a name="SECTION4"></a>إدارة FRONT-END</div>

#### <div dir="rtl">٤.٠ ما هو FRONT-END.<br /><br /></div>

<div dir="rtl">Front-end يوفر وسيلة سهلة للحفاظ على، وإدارة، وتحديث phpMussel. يمكنك عرض، حصة، وتحميل ملفات الدخول، يمكنك تعديل تكوين، يمكنك تثبيت وإلغاء تثبيت مكونات، ويمكنك تحميل وتنزيل وتعديل الملفات.<br /><br /></div>

<div dir="rtl">Front-end معطل في البداية، لمنع الوصول غير المصرح به (الدخول غير المصرح به قد يكون له عواقب أمنية كبيرة). تعليمات لتمكينه أدناه.<br /><br /></div>

#### <div dir="rtl">٤.١ كيفية تمكين FRONT-END.<br /><br /></div>

<div dir="rtl">١. العثور <code dir="ltr">"disable_frontend"</code> من في <code dir="ltr">"config.ini"</code>، وتعيينها إلى false (القيمة القياسية هي true).<br /><br /></div>

<div dir="rtl">٢. الوصول إلى <code dir="ltr">"loader.php"</code> من المتصفح (مثلا، <code dir="ltr">"http://localhost/phpmussel/loader.php"</code>).<br /><br /></div>

<div dir="rtl">٣. تسجيل الدخول باستخدام اسم المستخدم وكلمة المرور الافتراضية (admin/password).<br /><br /></div>

<div dir="rtl">ملحوظة: تغيير اسم المستخدم وكلمة المرور الخاصة بك بعد تسجيل الدخول للمرة الأولى، من أجل منع الوصول غير المصرح به (هذا مهم جدا)!<br /><br /></div>

<div dir="rtl">أيضًا، للحصول على الأمان الأمثل، نوصي بشدة بتمكين 2FA لجميع حسابات الواجهة الأمامية (الإرشادات الواردة أدناه).<br /><br /></div>

#### <div dir="rtl">٤.٢ كيفية استخدام FRONT-END.<br /><br /></div>

<div dir="rtl">في كل صفحة، ويفسر ذلك كيفية استخدامها. إذا كنت بحاجة إلى أي مساعدة، يرجى الاتصال بالدعم. وهناك أيضا بعض مقاطع الفيديو المفيدة المتاحة على موقع يوتيوب.<br /><br /></div>

#### <div dir="rtl">٤.٣ 2FA<br /><br /></div>

<div dir="rtl">من الممكن جعل front-end أكثر أمانًا عن طريق تمكين 2FA. عند تسجيل الدخول إلى حساب باستخدام 2FA، يتم إرسال بريد إلكتروني إلى عنوان البريد الإلكتروني المقترن بهذا الحساب. تحتوي هذه الرسالة الإلكترونية على "رمز 2FA"، والذي يجب على المستخدم إدخاله، بالإضافة إلى اسم المستخدم وكلمة المرور، حتى تتمكن من تسجيل الدخول باستخدام هذا الحساب. وهذا يعني أن الحصول على كلمة مرور الحساب لن يكون كافيًا لأي متسلل أو مهاجم محتمل ليتمكن من تسجيل الدخول إلى هذا الحساب، لأنهم سيحتاجون أيضًا إلى الوصول بالفعل إلى عنوان البريد الإلكتروني المرتبط بهذا الحساب حتى يتمكنوا من تلقي رمز 2FA واستخدامه في الجلسة.<br /><br /></div>

<div dir="rtl">أولاً، لتمكين 2FA، استخدم صفحة تحديثات front-end لتثبيت مكون PHPMailer. phpMussel يستخدم PHPMailer لإرسال رسائل البريد الإلكتروني. ملحوظة: على الرغم من أن phpMussel متوافق مع <code dir="ltr">PHP &gt;= 5.4.0</code>، PHPMailer يتطلب <code dir="ltr">PHP &gt;= 5.5.0</code>، مما يعني أن تمكين 2FA لـ phpMussel front-end لن يكون ممكنًا لمستخدمي <code dir="ltr">PHP 5.4</code>.<br /><br /></div>

<div dir="rtl">بعد تثبيت PHPMailer، ستحتاج إلى تعبئة توجيهات التهيئة لـ PHPMailer عبر صفحة تهيئة phpMussel أو ملف التكوين. يتم تضمين مزيد من المعلومات حول توجيهات التكوين هذه في قسم التكوين في هذا المستند. بعد ملء توجيهات تهيئة PHPMailer، اضبط <code dir="ltr">Enable2FA</code> على <code dir="ltr">true</code>. 2FA ممكّن الآن.<br /><br /></div>

<div dir="rtl">بعد ذلك، ستحتاج إلى ربط عنوان بريد إلكتروني بحساب، حتى يعرف phpMussel مكان إرسال رموز 2FA عند تسجيل الدخول باستخدام هذا الحساب. للقيام بذلك، استخدم عنوان البريد الإلكتروني كاسم مستخدم للحساب (مثل <code dir="ltr">foo@bar.tld</code>)، أو تضمين عنوان البريد الإلكتروني كجزء من اسم المستخدم بالطريقة نفسها التي تريدها عند إرسال بريد إلكتروني بشكل طبيعي (مثل <code dir="ltr">Foo Bar &lt;foo@bar.tld&gt;</code>).<br /><br /></div>

<div dir="rtl">ملحوظة: حماية "vault" ضد الوصول غير المصرح به (على سبيل المثال، من خلال تعزيز أمن الخادم الخاص بك وتقييد أذونات الوصول العام)، أهمية خاصة هنا، لأن الوصول غير المصرح به إلى ملف التكوين الخاص بك (المخزن في "vault")، قد يؤدي إلى تعريض إعدادات SMTP الصادرة (بما في ذلك اسم مستخدم وكلمة مرور SMTP). يجب التأكد من تأمين "vault" بشكل صحيح قبل تمكين 2FA. إذا كنت غير قادر على القيام بذلك، فعلى الأقل، يجب عليك إنشاء حساب بريد إلكتروني جديد مخصص لهذا الغرض، وذلك لتقليل المخاطر المرتبطة بإعدادات SMTP المكشوفة.<br /><br /></div>

---


### <div dir="rtl">٥. <a name="SECTION5"></a>CLI (واجهة سطر الأوامر).</div>

<div dir="rtl">يمكن تشغيل phpMussel باعتباره برنامج فحص ملفات تفاعلي في وضع CLI في ظل النظم المستندة إلى Windows. راجع قسم "كيفية التثبيت (لواجهة سطر الاوامر)" من هذا الملف التمهيدي لمزيد من التفاصيل.<br /><br /></div>

<div dir="rtl">للحصول على قائمة الأوامر المتاحة لواجهة سطر الأوامر، اكتب "c" في موجه واجهة سطر الأوامر واضغط "دخول" Enter.<br /><br /></div>

<div dir="rtl">بالإضافة إلى، للراغبين، فيديو تعليمي عن كيفية استخدام phpMussel في وضع CLI متوفر هنا:</div>
- <https://youtu.be/H-Pa740-utc>

---


### <div dir="rtl">٦. <a name="SECTION6"></a>الملفات الموجودة في هذه الحزمة</div>

<div dir="rtl">فيما يلي قائمة بجميع الملفات التي ينبغي أن تدرج في النسخة المحفوظة من هذا البرنامج النصي عند تحميله، أي الملفات التي يمكن أن يحتمل أن تكون نشأت نتيجة استعمالك لهذا البرنامج النصي، بالإضافة إلى وصفا موجزا لدور و وظيفة كل ملف.<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">الوصف</div> | <div dir="rtl" style="display:inline;">الملف</div>
----|----
&nbsp; <div dir="rtl" style="display:inline;">دليل الوثائق (يحتوي على ملفات مختلفة).</div> | /_docs/
&nbsp; <div dir="rtl" style="display:inline;">الوثائق العربية.</div> | /_docs/readme.ar.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الألمانية.</div> | /_docs/readme.de.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الإنجليزية.</div> | /_docs/readme.en.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الأسبانية.</div> | /_docs/readme.es.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الفرنسية.</div> | /_docs/readme.fr.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الاندونيسية.</div> | /_docs/readme.id.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الايطالية.</div> | /_docs/readme.it.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق اليابانية.</div> | /_docs/readme.ja.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الكورية.</div> | /_docs/readme.ko.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الهولندية.</div> | /_docs/readme.nl.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق البرتغالية.</div> | /_docs/readme.pt.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الروسية.</div> | /_docs/readme.ru.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الأردية.</div> | /_docs/readme.ur.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الفيتنامية.</div> | /_docs/readme.vi.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الصينية (المبسطة).</div> | /_docs/readme.zh.md
&nbsp; <div dir="rtl" style="display:inline;">الوثائق الصينية (التقليدية).</div> | /_docs/readme.zh-TW.md
&nbsp; <div dir="rtl" style="display:inline;">دليل اختبار الملفات (يحتوي على العديد من الملفات). كل الملفات الواردة هي ملفات اختبار لاختبار إذا ما تم تثبيت phpMussel بشكل صحيح على النظام الخاص بك, لن تحتاج لتحميل هذا الدليل أو أي من ملفاته إلا عند القيام بهذا الاختبار.</div> | /_testfiles/
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات ASCII.</div> | /_testfiles/ascii_standard_testfile.txt
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات phpMussel الموسعة المعقدة.</div> | /_testfiles/coex_testfile.rtf
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PE في phpMussel.</div> | /_testfiles/exe_standard_testfile.exe
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات phpMussel العامة.</div> | /_testfiles/general_standard_testfile.txt
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات جرافيكس\رسومات phpMussel.</div> | /_testfiles/graphics_standard_testfile.gif
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات HTML.</div> | /_testfiles/html_standard_testfile.html
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار للتأكد بأن "بي اتش بيم اسل" قد قام بتطبيع توقيعات MD5.</div> | /_testfiles/md5_testfile.txt
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات OLE في phpMussel.</div> | /_testfiles/ole_testfile.ole
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PDF في phpMussel.</div> | /_testfiles/pdf_standard_testfile.pdf
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات PE الجزئية في phpMussel.</div> | /_testfiles/pe_sectional_testfile.exe
&nbsp; <div dir="rtl" style="display:inline;">ملف اختبار لاختبار توقيعات swf في phpMussel.</div> | /_testfiles/swf_standard_testfile.swf
&nbsp; <div dir="rtl" style="display:inline;">دليل /vault/ (يحتوي على ملفات متنوعة).</div> | /vault/
&nbsp; <div dir="rtl" style="display:inline;">دليل ذاكرة التخزين المؤقت (للبيانات المؤقتة).</div> | /vault/cache/
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/cache/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">الأصول front-end.</div> | /vault/fe_assets/
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/fe_assets/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML المستخدم عند طلب المستخدم للحصول على كود 2FA.</div> | /vault/fe_assets/_2fa.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الحسابات.</div> | /vault/fe_assets/_accounts.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الحسابات.</div> | /vault/fe_assets/_accounts_row.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة بيانات ذاكرة التخزين المؤقت.</div> | /vault/fe_assets/_cache.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة التكوين.</div> | /vault/fe_assets/_config.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة التكوين.</div> | /vault/fe_assets/_config_row.html
&nbsp; <div dir="rtl" style="display:inline;">قالب HTML لمدير الملفات.</div> | /vault/fe_assets/_files.html
&nbsp; <div dir="rtl" style="display:inline;">قالب HTML لمدير الملفات.</div> | /vault/fe_assets/_files_edit.html
&nbsp; <div dir="rtl" style="display:inline;">قالب HTML لمدير الملفات.</div> | /vault/fe_assets/_files_rename.html
&nbsp; <div dir="rtl" style="display:inline;">قالب HTML لمدير الملفات.</div> | /vault/fe_assets/_files_row.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الرئيسية.</div> | /vault/fe_assets/_home.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة تسجيل الدخول.</div> | /vault/fe_assets/_login.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة السجلات.</div> | /vault/fe_assets/_logs.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end ارتباطات التنقل، يستخدم لهؤلاء مع وصول كامل.</div> | /vault/fe_assets/_nav_complete_access.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end ارتباطات التنقل، يستخدم لهؤلاء مع سجلات الوصول فقط.</div> | /vault/fe_assets/_nav_logs_access_only.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الحجر الصحي.</div> | /vault/fe_assets/_quarantine.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الحجر الصحي.</div> | /vault/fe_assets/_quarantine_row.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة معلومات التوقيع.</div> | /vault/fe_assets/_siginfo.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة معلومات التوقيع.</div> | /vault/fe_assets/_siginfo_row.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة الإحصاء.</div> | /vault/fe_assets/_statistics.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة التحديثات.</div> | /vault/fe_assets/_updates.html
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML لfront-end صفحة التحديثات.</div> | /vault/fe_assets/_updates_row.html
&nbsp; <div dir="rtl" style="display:inline;">قالب HTML لصفحة التحميل الاختبار.</div> | /vault/fe_assets/_upload_test.html
&nbsp; <div dir="rtl" style="display:inline;">ملف CSS (صفحات الطرز المتراصة) لfront-end.</div> | /vault/fe_assets/frontend.css
&nbsp; <div dir="rtl" style="display:inline;">قاعدة البيانات لfront-end (يحتوي على معلومات الحسابات و الجلسات؛ خلق فقط اذا front-end يتم تمكين واستخدامها).</div> | /vault/fe_assets/frontend.dat
&nbsp; <div dir="rtl" style="display:inline;">يتم توليدها كآلية سلامة عند الحاجة.</div> | /vault/fe_assets/frontend.dat.safety
&nbsp; <div dir="rtl" style="display:inline;">ملف قالب HTML الرئيسي لfront-end.</div> | /vault/fe_assets/frontend.html
&nbsp; <div dir="rtl" style="display:inline;">الرموز معالج (التي يستخدمها مدير الملفات الأمامية).</div> | /vault/fe_assets/icons.php
&nbsp; <div dir="rtl" style="display:inline;">بالنقاط معالج (التي يستخدمها مدير الملفات الأمامية).</div> | /vault/fe_assets/pips.php
&nbsp; <div dir="rtl" style="display:inline;">يحتوي على بيانات JavaScript front-end.</div> | /vault/fe_assets/scripts.js
&nbsp; <div dir="rtl" style="display:inline;">يحتوي على بيانات اللغة لـ phpMussel.</div> | /vault/lang/
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/lang/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة العربية لfront-end.</div> | /vault/lang/lang.ar.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة العربية.</div> | /vault/lang/lang.ar.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة البنغالية لfront-end.</div> | /vault/lang/lang.bn.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة البنغالية.</div> | /vault/lang/lang.bn.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الألمانية لfront-end.</div> | /vault/lang/lang.de.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الألمانية.</div> | /vault/lang/lang.de.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الإنجليزية لfront-end.</div> | /vault/lang/lang.en.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الإنجليزية.</div> | /vault/lang/lang.en.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الاسبانية لfront-end.</div> | /vault/lang/lang.es.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الاسبانية.</div> | /vault/lang/lang.es.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الفرنسية لfront-end.</div> | /vault/lang/lang.fr.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الفرنسية.</div> | /vault/lang/lang.fr.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الهندية لfront-end.</div> | /vault/lang/lang.hi.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الهندية.</div> | /vault/lang/lang.hi.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الاندونيسية لfront-end.</div> | /vault/lang/lang.id.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الاندونيسية.</div> | /vault/lang/lang.id.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الايطالية لfront-end.</div> | /vault/lang/lang.it.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الايطالية.</div> | /vault/lang/lang.it.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة اليابانية لfront-end.</div> | /vault/lang/lang.ja.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة اليابانية.</div> | /vault/lang/lang.ja.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الكورية لfront-end.</div> | /vault/lang/lang.ko.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الكورية.</div> | /vault/lang/lang.ko.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الهولندية لfront-end.</div> | /vault/lang/lang.nl.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الهولندية.</div> | /vault/lang/lang.nl.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة البرتغالية لfront-end.</div> | /vault/lang/lang.pt.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة البرتغالية.</div> | /vault/lang/lang.pt.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الروسية لfront-end.</div> | /vault/lang/lang.ru.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الروسية.</div> | /vault/lang/lang.ru.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة التايلاندية لfront-end.</div> | /vault/lang/lang.th.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة التايلاندية.</div> | /vault/lang/lang.th.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة اللغة التركية لfront-end.</div> | /vault/lang/lang.tr.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة اللغة التركية.</div> | /vault/lang/lang.tr.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الأردية لfront-end.</div> | /vault/lang/lang.ur.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الأردية.</div> | /vault/lang/lang.ur.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الفيتنامية لfront-end.</div> | /vault/lang/lang.vi.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الفيتنامية.</div> | /vault/lang/lang.vi.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الصينية (التقليدية) لfront-end.</div> | /vault/lang/lang.zh-tw.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الصينية (التقليدية).</div> | /vault/lang/lang.zh-tw.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الصينية (المبسطة) لfront-end.</div> | /vault/lang/lang.zh.fe.php
&nbsp; <div dir="rtl" style="display:inline;">ملفات اللغة الصينية (المبسطة).</div> | /vault/lang/lang.zh.php
&nbsp; <div dir="rtl" style="display:inline;">دليل العزل (يحتوي على الملفات المعزولة).</div> | /vault/quarantine/
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/quarantine/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">دليل توقيعات (يحتوي توقيعات).</div> | /vault/signatures/
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/signatures/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">يتحكم و يضع متغيرات محددة.</div> | /vault/signatures/switch.dat
&nbsp; <div dir="rtl" style="display:inline;">ملف وصول النص التشعبي (في هذه الحالة، لحماية الملفات الحساسة التي تنتمي إلى البرنامج من أن يتم الوصول إليها عن طريق مصادر غير مصرح لها).</div> | /vault/.htaccess
&nbsp; <div dir="rtl" style="display:inline;">المستخدمة من قبل Travis CI للاختبار (غير مطلوب لتشغيل سليم للبرنامج).</div> | /vault/.travis.php
&nbsp; <div dir="rtl" style="display:inline;">المستخدمة من قبل Travis CI للاختبار (غير مطلوب لتشغيل سليم للبرنامج).</div> | /vault/.travis.yml
&nbsp; <div dir="rtl" style="display:inline;">معالج CLI.</div> | /vault/cli.php
&nbsp; <div dir="rtl" style="display:inline;">حدات ملف البيانات الوصفية؛ المستخدمة من قبل صفحة التحديثات.</div> | /vault/components.dat
&nbsp; <div dir="rtl" style="display:inline;">ملف التكوين. يحتوي على جميع خيارات تهيئة phpMussel، يخبرك ماذا يفعل وكيف يعمل بشكل صحيح (إعادة تسمية لتفعيل)!</div> | /vault/config.ini.RenameMe
&nbsp; <div dir="rtl" style="display:inline;">معالج التكوين.</div> | /vault/config.php
&nbsp; <div dir="rtl" style="display:inline;">ملف التخلف التكوين؛ يحتوي على قيم التكوين الافتراضي لphpMussel.</div> | /vault/config.yaml
&nbsp; <div dir="rtl" style="display:inline;">معالج front-end.</div> | /vault/frontend.php
&nbsp; <div dir="rtl" style="display:inline;">ملف وظائف front-end.</div> | /vault/frontend_functions.php
&nbsp; <div dir="rtl" style="display:inline;">ملف وظائف (ضروري).</div> | /vault/functions.php
&nbsp; <div dir="rtl" style="display:inline;">ملف CSV توقيعات القائمة الرمادية المشيرة إلى التوقيعات التي ينبغي على phpMussel أن يتجاهلها (هذا ملف يتم إعادة إنشاءه تلقائيا إذا حذف).</div> | /vault/greylist.csv
&nbsp; <div dir="rtl" style="display:inline;">ملف لغة.</div> | /vault/lang.php
&nbsp; <div dir="rtl" style="display:inline;">Polyfills لPHP 5.4.X (اللازمة لالتوافق PHP 5.4.X؛ لإصدارات أحدث PHP، آمنة للحذف).</div> | /vault/php5.4.x.php
&nbsp; <div dir="rtl" style="display:inline;">ملف البيانات الوصفية الإضافات؛ المستخدمة من قبل صفحة التحديثات.</div> | /vault/plugins.dat
&nbsp; <div dir="rtl" style="display:inline;">سجل لكل ما تم فحصه بواسطة phpMussel.</div> | ※ /vault/scan_log.txt
&nbsp; <div dir="rtl" style="display:inline;">سجل لكل ما تم فحصه بواسطة phpMussel.</div> | ※ /vault/scan_log_serialized.txt
&nbsp; <div dir="rtl" style="display:inline;">يحتوي على معرفات توقيع مختلفة ليتم معالجتها بواسطة phpMussel عند تفسير توقيع الاختزال أثناء الفحص، وعند الوصول إلى معلومات التوقيع عبر الواجهة الأمامية.</div> | /vault/shorthand.yaml
&nbsp; <div dir="rtl" style="display:inline;">ملف البيانات الوصفية التوقيعات؛ المستخدمة من قبل صفحة التحديثات.</div> | /vault/signatures.dat
&nbsp; <div dir="rtl" style="display:inline;">سجل لكل ما تم القضاء عليه بواسطة phpMussel.</div> | ※ /vault/scan_kills.txt
&nbsp; <div dir="rtl" style="display:inline;">ملف القالب. قالب لمخرجات HTML التي تنتجها phpMussel لرسالة حظر تحميل الملفات (الرسالة التي يراها القائم بالتحميل).</div> | /vault/template_custom.html
&nbsp; <div dir="rtl" style="display:inline;">ملف القالب. قالب لمخرجات HTML التي تنتجها phpMussel لرسالة حظر تحميل الملفات (الرسالة التي يراها القائم بالتحميل).</div> | /vault/template_default.html
&nbsp; <div dir="rtl" style="display:inline;">ملف البيانات الوصفية للسمات؛ المستخدمة من قبل صفحة التحديثات.</div> | /vault/themes.dat
&nbsp; <div dir="rtl" style="display:inline;">معالج تحميل.</div> | /vault/upload.php
&nbsp; <div dir="rtl" style="display:inline;">أ ملف المشروع GitHub (غير مطلوب لتشغيل سليم للبرنامج).</div> | /.gitattributes
&nbsp; <div dir="rtl" style="display:inline;">أ ملف المشروع GitHub (غير مطلوب لتشغيل سليم للبرنامج).</div> | /.gitignore
&nbsp; <div dir="rtl" style="display:inline;">سجل للتغييرات التي أجريت على البرنامج بين التحديثات المختلفة (غير مطلوب لتشغيل سليم للبرنامج).</div> | /Changelog-v1.txt
&nbsp; <div dir="rtl" style="display:inline;">معلومات Composer/Packagist (غير مطلوب لتشغيل سليم للبرنامج).</div> | /composer.json
&nbsp; <div dir="rtl" style="display:inline;">معلومات حول كيفية المساهمة في المشروع.</div> | /CONTRIBUTING.md
&nbsp; <div dir="rtl" style="display:inline;">نسخة من GNU/GPLv2 رخصة (غير مطلوب لتشغيل سليم للبرنامج).</div> | /LICENSE.txt
&nbsp; <div dir="rtl" style="display:inline;">الملف المحمل (المسئول عن التحميل): يحمل البرنامج الرئيسي و التحديث و، إلى آخره. هذا هو الذي من المفترض أن تكون على علاقة به و تقوم بتركيبه (أساسي)!</div> | /loader.php
&nbsp; <div dir="rtl" style="display:inline;">معلومات حول الأشخاص الذين شاركوا في المشروع.</div> | /PEOPLE.md
&nbsp; <div dir="rtl" style="display:inline;">معلومات موجزة المشروع.</div> | /README.md
&nbsp; <div dir="rtl" style="display:inline;">ملف تكوين ASP.NET (في هذه الحالة، لحماية دليل /vault من أن يتم الوصول إليه بواسطة مصادر غير مأذون لها في حالة إذا ما تم تثبيت البرنامج النصي على ملقم يستند إلى تقنيات ASP.NET</div> | /web.config

<div dir="rtl">※ اسم الملف قد يختلف استنادا إلى نصوص التكوين (في config.ini).</div>

---


### <div dir="rtl">٧. <a name="SECTION7"></a>خيارات التكوين/التهيئة</div>
<div dir="rtl">وفيما يلي قائمة من المتغيرات الموجودة في ملف تكوين "config.ini"، بالإضافة إلى وصف الغرض منه و وظيفته.<br /><br /></div>

#### <div dir="rtl">"general" (التصنيف)<br /></div>
<div dir="rtl">التكوين العام لـ phpMussel.<br /><br /></div>

##### <div dir="rtl">"cleanup"<br /></div>
<div dir="rtl"><ul>
 <li>إلغاء تعيين المتغيرات وذاكرة التخزين المؤقت التي يستخدمها البرنامج النصي بعد المسح الأولي للتحميل؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي]. إذا كنت -لا -تستخدم البرنامج النصي وراء المسح الأولي للتحميل، يجب تعيين هذا صحيح (نعم)، للحد من استخدام الذاكرة. إذا كنت تستخدم البرنامج النصي وراء المسح الأولي للتحميل، ينبغي أن تحدد إلى زائفة/False =(لا)، لتجنب داع إعادة تحميل البيانات المكررة في الذاكرة. في الممارسة العامة، ينبغي عادة أن يتم تعيين إلى صحيح، ولكن، إذا كنت تفعل ذلك، فإنك لن تكون قادرا على استخدام البرنامج النصي في أي شيء سوى المسح الأولي لتحميل الملف.</li>
 <li>ليس له أي تأثير في وضع CLI "واجهة سطر الأوامر".</li>
</ul></div>

##### <div dir="rtl">"scan_log"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف لملف تسجيل جميع نتائج المسح. قم بتعيين اسم الملف، أو اتركه فارغا للتعطيل.</li>
</ul></div>

##### <div dir="rtl">"scan_log_serialized"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف من ملف لتسجيل جميع نتائج المسح إلى (باستخدام تنسيق متسلسل). تحديد اسم الملف، أو اتركه فارغا للتعطيل.</li>
</ul></div>

##### <div dir="rtl">"scan_kills"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الملف من ملف لتسجيل كل سجلات الملفات التي منعت او اوقفت من .تحديد اسم الملف، أو اتركه فارغا لتعطيل.</li>
</ul></div>

<div dir="rtl"><em>نصيحة مفيدة: إن أردت، يمكنك إلحاق تاريخ/المعلومات في الوقت إلى أسماء ملفات السجل من خلال تضمين هذه في اسم: "{yyyy}" لمدة عام كامل، "{yy}" لمدة عام يختصر، "{mm}" لمدة شهر، "{dd}" ليوم واحد، "{hh}" لمدة ساعة (راجع الأمثلة أدناه).</em><br /><br /></div>

```
 scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'
 scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'
 scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'
```

##### <div dir="rtl">"truncate"<br /></div>
<div dir="rtl"><ul>
 <li>اقتطاع ملفات السجل عندما تصل إلى حجم معين؟ القيمة هي الحجم الأقصى في بايت/كيلوبايت/ميغابايت/غيغابايت/تيرابايت الذي قد ينمو ملفات السجل إلى قبل اقتطاعه. القيمة الافتراضية 0KB تعطيل اقتطاع (ملفات السجل يمكن أن تنمو إلى أجل غير مسمى). ملاحظة: ينطبق على ملفات السجل الفردية! ولا يعتبر حجمها جماعيا.</li>
</ul></div>

##### <div dir="rtl">"log_rotation_limit"<br /></div>
<div dir="rtl"><ul>
 <li>يحدد تدوير السجل عدد ملفات السجل التي يجب أن تكون موجودة في أي وقت. عند إنشاء ملفات السجل الجديدة، إذا تجاوز العدد الإجمالي لبيانات السجل الحد المحدد، فسيتم تنفيذ الإجراء المحدد. يمكنك تحديد الحد المرغوب هنا. ستعمل القيمة 0 على تعطيل تدوير السجل.</li>
</ul></div>

##### <div dir="rtl">"log_rotation_action"<br /></div>
<div dir="rtl"><ul>
 <li>يحدد تدوير السجل عدد ملفات السجل التي يجب أن تكون موجودة في أي وقت. عند إنشاء ملفات السجل الجديدة، إذا تجاوز العدد الإجمالي لبيانات السجل الحد المحدد، فسيتم تنفيذ الإجراء المحدد. يمكنك تحديد الإجراء المطلوب هنا. Delete = احذف أقدم السجلات، حتى لا يتم تجاوز الحد. Archive = أرشفة أولاً، ثم احذف أقدم السجلات، حتى لا يتم تجاوز الحد.</li>
</ul></div>

<div dir="rtl">التوضيح الفني: في هذا السياق، تعني كلمة "أقدم"، هذا يعني "الأقل معدلة مؤخرا".<br /><br /></div>

##### <div dir="rtl">"timeOffset"<br /></div>
<div dir="rtl"><ul>
 <li>إذا بالتوقيت المحلي الخاص بك ليست هي نفسها كما الخادم الخاص بك، يمكنك تحديد إزاحة هنا (لضبط التاريخ / المعلومات في الوقت صنعت بواسطة phpMussel). الإزاحة المستندة دقيقة.<br /></li>
 <li>مثال (لإضافة ساعة واحدة):</li>
</ul></div>

`timeOffset=60`

##### <div dir="rtl">"timeFormat"<br /></div>
<div dir="rtl"><ul>
 <li>شكل التواريخ المستخدم من قبل phpMussel. الافتراضي:</li>
</ul></div>

`{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`

##### <div dir="rtl">"ipaddr"<br /></div>
<div dir="rtl"><ul>
 <li>أين يمكن العثور على عنوان IP لربط الطلبات؟ (مفيدة للخدمات مثل لايتكلاود و مثلها) الافتراضي = REMOTE_ADDR. تحذير: لا تغير هذا إلا إذا كنت تعرف ما تفعلونه!</li>
</ul></div>

<div dir="rtl">القيم الموصى بها ل "ipaddr":<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">القيمة</div> | &nbsp; <div dir="rtl" style="display:inline;">استعمال</div>
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula reverse proxy (إنكابسولا عكس الوكيل).
`HTTP_CF_CONNECTING_IP` | Cloudflare reverse proxy (كلودفلاري عكس الوكيل).
`CF-Connecting-IP` | Cloudflare reverse proxy (كلودفلاري عكس الوكيل؛ لبديل؛ إذا كان ما سبق لا يعمل).
`HTTP_X_FORWARDED_FOR` | Cloudbric reverse proxy.
`X-Forwarded-For` | [Squid reverse proxy (عكس الوكيل)](http://www.squid-cache.org/Doc/config/forwarded_for/).
&nbsp; <div dir="rtl" style="display:inline;"><em>يحددها تكوين الخادم.</em></div> | [Nginx reverse proxy (إنجن إكس عكس الوكيل)](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | &nbsp; <div dir="rtl" style="display:inline;">لا يوجد عكس الوكيل (الافتراضي).</div>

##### <div dir="rtl">"enable_plugins"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين دعم ملحقات phpMussel؟ زائفة/False = لا؛ صحيح/True = نعم [الافتراضي].</li>
</ul></div>

##### <div dir="rtl">"forbid_on_block"<br /></div>
<div dir="rtl"><ul>
 <li>هل phpMussel يرسل 403 من العناوين مع الرسالة منعت إيداع الملف، أو يبقى مع المعتادة 200 موافق؟ خطأ = رقم (200). صحيح/True = نعم (403) [الافتراضي].</li>
</ul></div>

##### <div dir="rtl">"delete_on_sight"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين هذا التوجيه وإرشاد النصي لمحاولة حذف فورا عن أي الممسوحة ضوئيا تحميل ملف محاولة مطابقة أي معايير الكشف، سواء عن طريق التوقيعات أو غير ذلك. لن يكون لمست الملفات مصممة على أن تكون "نظيفة". في حالة المحفوظات، سيتم حذف أرشيف كامل، بغض النظر عن ما إذا كان أو لم يكن ملف المخالف هو واحد فقط من العديد من الملفات الواردة في الأرشيف. بالنسبة لحالة إيداع ملف المسح الضوئي، عادة، فإنه ليس من الضروري لتمكين هذا التوجيه، لأن العادة، PHP وتطهير محتويات ذاكرة التخزين المؤقت تلقائيا عند انتهاء التنفيذ، وهذا يعني انها سوف عادة حذف أي الملفات التي تم تحميلها من خلال ذلك إلى الخادم ما لم يكونوا قد تم نقلها أو نسخها أو حذفها بالفعل. يضاف هذا التوجيه هنا كإجراء إضافي من الأمن لأولئك الذين نسخ من PHP قد لا تتصرف دائما على النحو المتوقع. = كاذبة بعد المسح، وترك الملف وحده [الافتراضي]. صحيح/True = بعد المسح، إن لم يكن نظيفة، تحذف فورا.</li>
</ul></div>

##### <div dir="rtl">"lang"<br /></div>
<div dir="rtl"><ul>
 <li>تحديد اللغة الافتراضية الخاصة بـ phpMussel.</li>
</ul></div>

##### <div dir="rtl">"numbers"<br /></div>
<div dir="rtl"><ul>
 <li>لتحديد كيفية عرض الأرقام.</li>
</ul></div>

<div dir="rtl">القيم المدعومة حاليًا:<br /><br /></div>

القيمة | ينتج عنه | وصف
---|---|---
`NoSep-1` | `1234567.89`
`NoSep-2` | `1234567,89`
`Latin-1` | `1,234,567.89` | القيمة القياسية
`Latin-2` | `1 234 567.89`
`Latin-3` | `1.234.567,89`
`Latin-4` | `1 234 567,89`
`Latin-5` | `1,234,567·89`
`China-1` | `123,4567.89`
`India-1` | `12,34,567.89`
`India-2` | `१२,३४,५६७.८९`
`Bengali-1` | `১২,৩৪,৫৬৭.৮৯`
`Arabic-1` | `١٢٣٤٥٦٧٫٨٩`
`Arabic-2` | `١٬٢٣٤٬٥٦٧٫٨٩`
`Thai-1` | `๑,๒๓๔,๕๖๗.๘๙`

<div dir="rtl">ملحوظة: هذه القيم ليست موحدة في أي مكان، وربما لن تكون ذات صلة خارج الحزمة. أيضا، قد تتغير القيم المدعومة في المستقبل.<br /><br /></div>

##### <div dir="rtl">"quarantine_key"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel غير قادرة على الحجر ترفع علم حاول تحميل الملف في عزلة داخل "قبو" phpMussel، إذا كان هذا هو ما تريد أن تفعله. المستخدمين العاديين من phpMussel التي ترغب ببساطة لحماية مواقعها على شبكة الإنترنت أو بيئة استضافة دون وجود أي مصلحة في تحليل عميق أي ترفع علم تحميل الملفات حاول يجب ترك هذه الوظيفة ذوي الاحتياجات الخاصة، ولكن أي المستخدمين المهتمين في مزيد من التحليل للترفع علم حاولت تحميل الملفات للبحث عن البرامج الضارة أو ما شابه مثل هذه الأمور ينبغي أن تمكن هذه الوظيفة. الحجر الصحي لترفع العلم تحميل الملفات حاول يمكن في بعض الأحيان أن تساعد في تصحيح ايجابيات كاذبة، إذا كان هذا هو الشيء الذي كثيرا ما يحدث لك. إلى تعطيل وظيفة العزل، ببساطة مغادرة "quarantine_key" التوجيه فارغة، أو مسح محتويات هذا التوجيه إذا لم يكن خاليا بالفعل. لتمكين وظيفة العزل، وإدخال قيمة في التوجيه. و "quarantine_key" هي ميزة أمنية مهمة من وظائف الحجر الصحي المطلوبة كوسيلة لمنع وظيفة الحجر الصحي من أن تستغل من قبل المهاجمين المحتملين، وكوسيلة لمنع أي احتمال تنفيذ البيانات المخزنة داخل الحجر الصحي. و "quarantine_key" ينبغي أن يعامل بنفس الطريقة التي يعامل بها كلمات السر الخاصة بك: وكلما كان ذلك أفضل، وحراسته مشددة. للحصول على أفضل تأثير، استخدم بالتزامن مع "delete_on_sight".</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_filesize"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لحجم الملف المسموح به من الملفات للحجر الصحي. لن يكون الحجر الصحي الملفات أكبر من القيمة المحددة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. الافتراضي = 2MB.</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_usage"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لاستخدام الذاكرة يسمح للحجر الصحي. إذا كان إجمالي الذاكرة المستخدمة من قبل الحجر الصحي تصل هذه القيمة، سيتم حذف أقدم الملفات المعزولة حتى الذاكرة الإجمالية المستخدمة لم تعد تصل هذه القيمة. هذا التوجيه لا يقل أهمية عن وسيلة لجعل الأمر أكثر صعوبة لأي مهاجمين محتملين لإغراق الحجر الصحي الخاص مع البيانات غير المرغوب فيها مما يمكن أن يسبب استخدام البيانات التشغيل بعيدا عن خدمة الاستضافة. الافتراضي = 64MB.</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_files"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لعدد الملفات التي يمكن أن توجد في وحدة العزل. عند إضافة ملفات جديدة إلى وحدة العزل، إذا تم تجاوز هذا الرقم، فسيتم حذف الملفات القديمة حتى لا يتجاوز الجزء المتبقي هذا الرقم. الافتراضي = 100.</li>
</ul></div>

##### <div dir="rtl">"honeypot_mode"<br /></div>
<div dir="rtl"><ul>
 <li>عند تمكين وضع مصيدة، و phpMussel محاولة لعزل كل تحميل ملف واحد أن يواجه، بغض النظر عن ما إذا كان أو لم يكن ملف يتم تحميلها يطابق أي وشملت التوقيعات، وسوف لا المسح الفعلي أو تحليل لتلك تحميل الملفات حاول أن يحدث في الواقع. وينبغي أن تكون هذه الوظيفة مفيدة لأولئك الذين يرغبون في استخدام phpMussel لأغراض فيروس / بحث عن البرامج الضارة، ولكن هذا لا يوصى لتمكين هذه الوظيفة إذا كان الغرض من استخدام phpMussel من قبل المستخدم هو الفعلي إيداع ملف المسح، ولا ينصح لاستخدام وظائف مصيدة لأغراض أخرى غير honeypotting. افتراضيا، يتم تعطيل هذا الخيار. زائفة/False = معطل [الافتراضي]. = الحقيقية تمكين.</li>
</ul></div>

##### <div dir="rtl">"scan_cache_expiry"<br /></div>
<div dir="rtl"><ul>
 <li>إلى متى يجب أن phpMussel تخزين نتائج المسح؟ القيمة هي عدد الثواني لتخزين نتائج المسح ل. الافتراضي هو 21600 ثانية (6 ساعات)؛ وقيمة 0 تعطيل التخزين المؤقت نتائج المسح.</li>
</ul></div>

##### <div dir="rtl">"disable_cli"<br /></div>
<div dir="rtl"><ul>
 <li>وضع تعطيل CLI؟ يتم تمكين وضع CLI افتراضيا، ولكن يمكن أن تتداخل أحيانا مع بعض أدوات الاختبار (مثل PHPUnit، على سبيل المثال) وغيرها من التطبيقات القائمة على المبادرة القطرية. إذا كنت لا تحتاج إلى تعطيل وضع CLI، يجب تجاهل هذا التوجيه. خطأ = تمكين وضع CLI [الافتراضي]. صحيح/True = وضع تعطيل CLI.</li>
</ul></div>

##### <div dir="rtl">"disable_frontend"<br /></div>
<div dir="rtl"><ul>
 <li>تعطيل وصول front-end؟ وصول front-end يستطيع جعل phpMussel أكثر قابلية للإدارة، ولكن يمكن أيضا أن تكون مخاطر أمنية محتملة. من المستحسن لإدارة phpMussel عبر back-end متى أمكن، لكن وصول front-end متوفر عندما لم يكن ممكنا. يبقيه المعوقين إلا إذا كنت في حاجة إليها. زائفة/False = تمكين وصول front-end؛ صحيح/True = تعطيل وصول front-end [الافتراضي].</li>
</ul></div>

##### <div dir="rtl">"max_login_attempts"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لعدد محاولات تسجيل الدخول (front-end). الافتراضي = 5.</li>
</ul></div>

##### <div dir="rtl">"FrontEndLog"<br /></div>
<div dir="rtl"><ul>
 <li>ملف لتسجيل محاولات الدخول الأمامية. تحديد اسم الملف، أو اتركه فارغا لتعطيل.</li>
</ul></div>

##### <div dir="rtl">"disable_webfonts"<br /></div>
<div dir="rtl"><ul>
 <li>هل تريد تعطيل ويبفونتس؟ صحيح/True = نعم [افتراضي]؛ زائفة/False = لا.</li>
</ul></div>

##### <div dir="rtl">"maintenance_mode"<br /></div>
<div dir="rtl"><ul>
 <li>هل تريد تمكين وضع الصيانة؟ صحيح/True = نعم؛ زائفة/False = لا [افتراضي]. تعطيل كل شيء بخلاف front-end. قد تكون مفيدة أحيانا عند تحديث نظام إدارة المحتوى والأطر وما إلى ذلك.</li>
</ul></div>

##### <div dir="rtl">"default_algo"<br /></div>
<div dir="rtl"><ul>
 <li>يحدد الخوارزمية التي سيتم استخدامها لكل كلمات المرور والجلسات المستقبلية. خيارات: PASSWORD_DEFAULT (افتراضي)، PASSWORD_BCRYPT، PASSWORD_ARGON2I (يتطلب PHP >= 7.2.0).</li>
</ul></div>

##### <div dir="rtl">"statistics"<br /></div>
<div dir="rtl"><ul>
 <li>هل تريد تتبع إحصاءات استخدام phpMussel؟ صحيح/True = نعم؛ زائفة/False = لا [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"allow_symlinks"<br /></div>
<div dir="rtl"><ul>
 <li>في بعض الأحيان، لا يتمكن phpMussel من الوصول إلى ملف مباشرةً عندما يتم تسميته بطريقة معينة. يمكن أن يؤدي الوصول إلى الملف بشكل غير مباشر عن طريق symlinks في بعض الأحيان إلى حل هذه المشكلة. ومع ذلك، هذا ليس دائمًا حلًا قابلاً للتطبيق، لأنه في بعض الأنظمة، قد يتم حظر استخدام symlinks، أو قد يتطلب امتيازات إدارية. يتم استخدام هذا التوجيه لتحديد ما إذا كان يجب على phpMussel محاولة استخدام روابط symlinks للوصول إلى الملفات بشكل غير مباشر، عند الوصول إليها مباشرة غير ممكن. صحيح/True = تمكين symlinks؛ زائفة/False = تعطيل symlinks [الافتراضي].</li>
</ul></div>

#### <div dir="rtl">"signatures" (التصنيف)<br /></div>
<div dir="rtl">تكوين التوقيعات.<br /><br /></div>

##### <div dir="rtl">"Active"<br /></div>
<div dir="rtl"><ul>
 <li>قائمة من الملفات توقيع النشطة، محدد بفواصل.</li>
</ul></div>

<div dir="rtl">ملحوظة: يجب أولاً تثبيت ملفات التوقيع، قبل أن تتمكن من تنشيطها.<br /><br /></div>

##### <div dir="rtl">"fail_silently"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على phpMussel الابلاغ عندما يتم توقيع ملفات مفقودة أو تالفة؟ إذا كان "fail_silently" المعوقين، في عداد المفقودين وسيتم الإبلاغ عن ملفات فساد في المسح، وإذا "fail_silently" تمكين، في عداد المفقودين وسيتم تجاهل ملفات فساد، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. وهذا ين بغي عموما أن تترك وحدها إلا إذا كنت تعاني من أعطال أو مشاكل مشابهة. خطأ = معطل. صحيح/True = ممكن [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"fail_extensions_silently"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على phpMussel الابلاغ عندما تفقد الملحقات؟ إذا تم تعطيل "fail_extensions_silently"، وسيتم إبلاغ ملحقات مفقودة على المسح، وإذا تم تمكين "fail_extensions_silently"، سيتم تجاهل ملحقات المفقودة، مع مسح الإبلاغ عن تلك الملفات أنه لا توجد أي مشاكل. تعطيل هذا التوجيه قد يحتمل زيادة الأمان، ولكن قد يؤدي أيضا إلى زيادة من ايجابيات كاذبة. خطأ = معطل. صحيح/True = ممكن [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_adware"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن تجسس؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_encryption"<br /></div>
<div dir="rtl"><ul>
 <li>يجب phpMussel كشف ومنع الملفات المشفرة؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_joke_hoax"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن خدعة البرمجيات الخبيثة / الفيروسات؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_pua_pup"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن PUAs؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_packer_packed"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن تعبئة والبيانات المعبأة؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_shell"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن البرامج النصية قذيفة؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"detect_deface"<br /></div>
<div dir="rtl"><ul>
 <li>هل يجب على توقيعات phpMussel الكشف عن مهاجمات وdefacers؟ زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

#### <div dir="rtl">"files" (التصنيف)<br /></div>
<div dir="rtl">ملف التعامل مع التكوين.<br /><br /></div>

##### <div dir="rtl">"max_uploads"<br /></div>
<div dir="rtl"><ul>
 <li>العدد الأقصى المسموح به من ملفات لمسح أثناء تحميل الملفات مسح قبل إحباط عملية الفحص وإعلام المستخدم أنهم تحميل أكثر من اللازم في وقت واحد! يوفر الحماية ضد هجوم النظري حيث يحاول أحد المهاجمين دوس النظام الخاص بك أو CMS من الحمولة الزائدة phpMussel إلى إبطاء عملية PHP لوقف طحن. الموصى بها: 10. أنت قد ترغب في رفع أو خفض هذا الرقم اعتمادا على سرعة الجهاز. لاحظ أن هذا الرقم لا يأخذ في الحسبان أو تتضمن محتويات المحفوظات.</li>
</ul></div>

##### <div dir="rtl">"filesize_limit"<br /></div>
<div dir="rtl"><ul>
 <li>حدود حجم الملف بالكيلو بايت. 65536 = 64MB [افتراضي]. 0 = لا يوجد حد (greylisted دائما)، أي (إيجابية) قيمة رقمية قبلت. هذا يمكن أن يكون مفيدا عندما يحد التكوين الخاص بي مقدار الذاكرة عملية يمكن أن تعقد أو إذا كان لديك PHP حدود التكوين حجم الملف من الإضافات.</li>
</ul></div>

##### <div dir="rtl">"filesize_response"<br /></div>
<div dir="rtl"><ul>
 <li>ماذا تفعل مع الملفات التي تتجاوز الحد الأقصى لحجم الملف (إن وجد). زائفة/False = القائمة البيضاء. صحيح/True = القائمة السوداء [افتراضي].</li>
</ul></div>

##### <div dir="rtl"><code dir="ltr">"filetype_whitelist"</code>، <code dir="ltr">"filetype_blacklist"</code>، <code dir="ltr">"filetype_greylist"</code><br /></div>
<div dir="rtl"><ul>
 <li>إذا كان النظام يسمح فقط أنواع معينة من الملفات المراد تحميلها، أو إذا كان النظام ينفي صراحة أنواع معينة من الملفات، تحديد تلك نوع الملف في قوائم بيضاء، القوائم السوداء و القوائم الرمادية يمكن أن تزيد من السرعة التي يتم تنفيذ المسح من خلال السماح للبرنامج بتخطي بعض أنواع الملفات. الشكل هو CSV (قيم مفصولة بفواصل). إذا كنت ترغب في مسح كل شيء، وليس من القائمة البيضاء، القائمة السوداء أو القائمة الرمادية، وترك المتغير (/ ث) فارغة. وبذلك تعطيل القائمة البيضاء / السوداء / القائمة الرمادية.</li>
 <li><strong>الترتيب المنطقي للمعالجة هو:</strong></li>
 <ul>
 <li>إذا نوع الملف موجود في القائمة البيضاء، لا يفحص ولا تحجب الملف، وعدم التدقيق في ملف ضد القائمة السوداء أو القائمة الرمادية.</li>
 <li>إذا نوع الملف موجود في القائمة السوداء، لا تفحص الملف ولكن منع ذلك على أي حال، وعدم التدقيق في ملف ضد قائمة رمادية.</li>
 <li>إذا كانت قائمة رمادية فارغة أو إذا كانت قائمة رمادية ليس فارغا من نوع الملف، مسح الملفات حسب طبيعتها وتحديد ما إذا كان لمنع ذلك بناء على نتائج الفحص، ولكن إذا كانت قائمة رمادية ليس فارغا ونوع الملف هو ليس ملف قائمة رمادية، معالجة الملف على القائمة السوداء، لذلك لا المسح الضوئي ولكن منع ذلك على أي حال.</li>
 </ul>
</ul></div>

##### <div dir="rtl">"check_archives" – غير متاح مؤقتا<br /></div>
<div dir="rtl"><ul>
 <li>محاولة للتحقق من محتويات المحفوظات؟ = كاذبة لا تحقق. صحيح/True = افحص [افتراضي].</li>
 <li>في الوقت الراهن، يتم اعتماد فحص فقط من BZ/BZIP2، GZ/GZIP، LZF، PHAR، TAR و ZIP (فحص من RAR، CAB، 7Z وإلى آخره غير معتمدة حاليا).</li>
 <li>هذه ليست مضمونة! بينما أنا أوصي حفظ هذا قيد التشغيل، لا يمكنني ان اضمن انها سوف تجد دائما كل شيء.</li>
 <li>أيضا أن ندرك أن أرشيف التحقق حاليا ليست متكررة ملفات PHAR أو ZIP.</li>
</ul></div>

##### <div dir="rtl">"filesize_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ترحيل حجم ملف القائمة السوداء / قائمة بيضاء لمحتويات المحفوظات؟ زائفة/False = لا (فقط كل ما يدرجون)؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"filetype_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ترحيل نوع الملف القائمة السوداء / القائمة البيضاء لمحتويات المحفوظات؟ زائفة/False = لا (فقط كل ما يدرجون) [افتراضي]. صحيح/True = نعم.</li>
</ul></div>

##### <div dir="rtl">"max_recursion"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لإعادة الحد الأقصى لعمق المحفوظات. افتراضي = 10.</li>
</ul></div>

##### <div dir="rtl">"block_encrypted_archives"<br /></div>
<div dir="rtl"><ul>
 <li>كشف ومنع تشفير المحفوظات؟ لأن phpMussel ليست قادرة على مسح محتويات المحفوظات مشفرة، فمن الممكن أن التشفير أرشيف يجوز توظيف من قبل مهاجم كوسيلة لمحاولة تجاوز phpMussel، والماسحات الضوئية مكافحة الفيروسات وغيرها من مثل هذه الحماية. يمكن أن تعليمات phpMussel لمنع أي المحفوظات التي كان تكتشف لتكون مشفرة المحتمل أن يساعد على الحد من أي مخاطر المرتبطة بهذه مثل هذه الاحتمالات. زائفة/False = لا؛ صحيح/True = نعم [افتراضي].</li>
</ul></div>

#### <div dir="rtl">"attack_specific" (التصنيف)<br /></div>
<div dir="rtl">تعليمات للهجوم المحدد.<br /><br /></div>

<div dir="rtl">الكشف عن الهجوم المتقلب: صحيح/True = على. زائفة/False = إيقاف.<br /><br /></div>

##### <div dir="rtl">"chameleon_from_php"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن العنوان PHP في الملفات التي ليست ملفات PHP و لا المحفوظات معترفة بها.</li>
</ul></div>

##### <div dir="rtl">"can_contain_php_file_extensions"<br /></div>
<div dir="rtl"><ul>
 <li>قائمة ملحقات الملفات المسموح بها تحتوي على شفرة PHP، مفصولة بفواصل. إذا تم تمكين الكشف عن هجوم حرباء PHP، فسيتم الكشف عن الملفات التي تحتوي على كود PHP، والتي تحتوي على ملحقات ليست موجودة في هذه القائمة، على أنها هجمات حرباء على PHP.</li>
</ul></div>

##### <div dir="rtl">"chameleon_from_exe"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن العناوين قابلة للتنفيذ في الملفات التي ليست التنفيذية ولا المحفوظات المعترف بها والقابلة للتنفيذ التي هي العناوين غير صحيحة.</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_archive"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن المحفوظات التي عناوينها غير صحيحة (المدعومة: BZ، GZ، RAR، ZIP، GZ).</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_doc"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن المستندات التي عناوينها غير صحيحة (المدعومة: DOC، وزارة النقل، PPS، PPT، XLA، XLS، WIZ).</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_img"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن الصور التي عناوينها غير صحيحة (المدعومة: BMP، DIB، PNG، GIF، JPEG، JPG، XCF، PSD، PDD، WEBP).</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_pdf"<br /></div>
<div dir="rtl"><ul>
 <li>البحث عن الملفات PDF التي عناوينها غير صحيحة.</li>
</ul></div>

##### <div dir="rtl">"archive_file_extensions"<br /></div>
<div dir="rtl"><ul>
 <li>ملحقات ملفات الأرشيف المعترف بها (الشكل هو CSV، وينبغي فقط إضافة أو إزالة عندما تحدث المشاكل؛ إزالة دون داع قد يسبب ايجابيات كاذبة لتظهر لملفات الأرشيف، في حين اضاف داع سوف القائمة البيضاء أساسا ما كنت تقوم بإضافة من كشف المحدد الهجوم؛ تعديل مع الحذر، لاحظ أيضا أن هذا ليس له تأثير على ما المحفوظات يمكن ولا يمكن تحليلها على مستوى المحتوى). القائمة، كما هو في التقصير، يسرد تلك الأشكال الأكثر شيوعا في غالبية النظم واتفاقية الأنواع المهاجرة، ولكن عمدا ليست شاملة بالضرورة.</li>
</ul></div>

##### <div dir="rtl">"block_control_characters"<br /></div>
<div dir="rtl"><ul>
 <li>حظر أي ملفات تحتوي على أي أحرف التحكم (عدا أسطر جديدة)؟ ("[\x00-\x08\x0b\x0c\x0e\x1f\x7f]") إذا كنت <strong>فقط</strong> تحميل نص عادي، ثم يمكنك تشغيل هذا الخيار لتوفير بعض الحماية إضافية على النظام الخاص بك. ومع ذلك، إذا قمت بتحميل أي شيء آخر غير نص عادي، وتحول هذا على قد يؤدي إلى ايجابيات كاذبة. زائفة/False = كاذبة لا منع [افتراضي]. صحيح/True = بلوك.</li>
</ul></div>

##### <div dir="rtl">"corrupted_exe"<br /></div>
<div dir="rtl"><ul>
 <li>تلف الملفات وتحليل الأخطاء. خطأ = تجاهل. صحيح/True = كتلة [افتراضي]. كشف ومنع الملفات المحتمل تلف PE (محمول قابل للتنفيذ)؟ في كثير من الأحيان (ولكن ليس دائما)، عندما تلف جوانب معينة من ملف PE أو لا يمكن تحليله بشكل صحيح، فإنه يمكن أن يكون مؤشرا على وجود عدوى فيروسية. العمليات المستخدمة من قبل معظم برامج مكافحة الفيروسات للكشف عن الفيروسات في ملفات PE تتطلب تحليل تلك الملفات بطرق معينة والتي إذا كان مبرمج للفيروس هو على علم، ومحاولة خصيصا لمنع، من أجل السماح للفيروس لتبقى غير مكتشفة .</li>
</ul></div>

##### <div dir="rtl">"decode_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لطول البيانات الخام من خلاله أن يتم الكشف عن أوامر فك (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). افتراضي = 512KB. صفر أو قيمة فارغة تعطيل عتبة (إزالة مثل هذا القيد على أساس حجم الملف).</li>
</ul></div>

##### <div dir="rtl">"allow_leading_trailing_dots"<br /></div>
<div dir="rtl"><ul>
 <li>السماح النقاط الرائدة والزائدة في أسماء الملفات؟ يمكن استخدام هذا أحيانًا لإخفاء الملفات أو خداع بعض الأنظمة للسماح بدخول الدليل. زائفة/False = لا تسمح [افتراضي]. صحيح/True = السماح.</li>
</ul></div>

##### <div dir="rtl">"block_macros"<br /></div>
<div dir="rtl"><ul>
 <li>حاول حظر أي ملفات تحتوي على وحدات ماكرو؟ قد تحتوي بعض أنواع المستندات وجداول البيانات على وحدات ماكرو قابلة للتنفيذ، وبالتالي توفير ناقلات برامج ضارة محتملة خطيرة. زائفة/False = لا تمنع [افتراضي]. صحيح/True = تمنع.</li>
</ul></div>

##### <div dir="rtl">"scannable_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>الحد الأقصى لطول البيانات الخام التي يسمح phpMussel لقراءة ومسح (في حالة وجود أي مشكلات في الأداء ملحوظة أثناء المسح). افتراضي = 32MB. صفر أو قيمة فارغة تعطيل العتبة. عموما، يجب أن لا تكون هذه القيمة أقل من متوسط حجم الملف من تحميل الملفات التي تريد وتتوقع الحصول على الخادم الخاص بك أو الموقع، لا ينبغي أن يكون أكثر من التوجيه filesize_limit، ويجب أن لا يكون خامس أكثر من ما يقرب من واحد من مجموع تخصيص الذاكرة المسموح منح لPHP عن طريق ملف التكوين "php.ini". هذا التوجيه موجود في محاولة لمنع phpMussel من استخدام ما يصل الكثير من الذاكرة (التي تريد منعها من أن تكون قادرة على مسح بنجاح الملفات فوق حجم الملف معين).</li>
</ul></div>

#### <div dir="rtl">"compatibility" (التصنيف)<br /></div>
<div dir="rtl">تعليمات التوافق مع phpMussel.<br /><br /></div>

##### <div dir="rtl">"ignore_upload_errors"<br /></div>
<div dir="rtl"><ul>
 <li>يجب أن يكون هذا التوجيه عموما هو تعطيل ما لم تصبح مطلوبة حصول على الوظائف الصحيحة لـ phpMussel على النظام الخاص بك محددة. عادة، عندما يكون في وضع تعطيل، عندما يكتشف phpMussel وجود عناصر في مجموعة <code dir="ltr">$_FILES</code>، وأنها سوف محاولة لبدء فحص الملفات التي تمثل تلك العناصر، وإذا كانت تلك العناصر هي فارغة أو فارغة، سوف phpMussel العودة رسالة خطأ. هذا هو السلوك الصحيح للـ phpMussel. ومع ذلك، بالنسبة لبعض CMS، العناصر الفارغة في <code dir="ltr">$_FILES</code> يمكن أن تحدث نتيجة لسلوك طبيعي لتلك CMS، أو أخطاء قد يتم الإعلام عندما لم تكن هناك أي، في هذه الحالة، السلوك العادي للphpMussel سوف تتدخل مع السلوك العادي من تلك CMS. في حال حدوث مثل هذه الحالة بالنسبة لك، تمكين هذا الخيار سوف يكلف phpMussel ليست محاولة لبدء المسح الضوئي لمثل هذه العناصر الفارغة، تجاهلها عندما وجدت وعدم إعادة أي رسائل خطأ ذات الصلة، مما يتيح استمرار طلب الصفحة. زائفة/False = أطفئ؛ صحيح/True = تشغيل.</li>
</ul></div>

##### <div dir="rtl">"only_allow_images"<br /></div>
<div dir="rtl"><ul>
 <li>إذا كنت تتوقع فقط أو تنوي فقط للسماح الصور المراد تحميلها على النظام الخاص بك أو CMS، وإذا كنت على الاطلاق لا تتطلب أية ملفات أخرى من الصور ليتم تحميلها على النظام الخاص بك أو CMS، ينبغي تمكين هذا التوجيه، ولكن ينبغي خلاف ذلك يتم تعطيل. إذا تم تمكين هذا التوجيه، أنه سوف يكلف phpMussel لمنع عشوائيا أي الإضافات التي تم تحديدها كملفات صورة غير، دون مسحها. هذا قد يقلل من الوقت اللازم لتجهيز واستخدام الذاكرة لمحاولة تحميل الملفات غير الصورة. زائفة/False = OFF؛ صحيح/True = ON.</li>
</ul></div>

#### <div dir="rtl">"heuristic" (التصنيف)<br /></div>
<div dir="rtl">تعليمات الكشف عن مجريات الأمور.<br /><br /></div>

##### <div dir="rtl">"threshold"<br /></div>
<div dir="rtl"><ul>
 <li>هناك توقيعات معينة من phpMussel التي تهدف إلى تحديد الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها دون في أنفسهم تحديد تلك الملفات التي تم تحميلها على وجه التحديد بأنها خبيثة. هذه القيمة "الحد الأقصى " تقول phpMussel ما الحد الأقصى للوزن الكلي من الصفات المشبوهة والمحتمل أن تكون ضارة من الملفات التي يتم تحميلها هذا المسموح به هو قبل تلك الملفات ليتم وضع علامة بأنها خبيثة. تعريف الوزن في هذا السياق هو العدد الإجمالي من الصفات المشبوهة والمحتمل أن تكون ضارة تحديدها. افتراضيا، سيتم تعيين هذه القيمة إلى 3. القيمة المنخفضة عموما سوف يؤدي إلى حدوث أعلى من ايجابيات كاذبة ولكن عددا أكبر من الملفات الخبيثة التي لوحت، في حين أن أعلى قيمة عموما سوف يؤدي إلى حدوث انخفاض من ايجابيات كاذبة ولكن انخفاض عدد الملفات الخبيثة التي توضع. انها عموما من الأفضل ترك هذه القيمة في الافتراضي إلا إذا كنت تعاني من مشاكل المتعلقة بها.</li>
</ul></div>

#### <div dir="rtl">"virustotal" (التصنيف)<br /></div>
<div dir="rtl">تعليمات VirusTotal.com.<br /><br /></div>

##### <div dir="rtl">"vt_public_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>اختياريا، phpMussel غير قادرة على مسح الملفات باستخدام الفيروسات مجموع API كوسيلة لتوفير مستوى تتعزز بشكل كبير من الحماية ضد الفيروسات، و ملفات التجسس، والبرمجيات الخبيثة وغيرها من التهديدات. افتراضيا، ملفات المسح الضوئي باستخدام الفيروسات مجموع API يتم تعطيل. لتمكينه، لا بد من وضع مفتاح API من الفيروسات إجمالي. ويرجع ذلك إلى فائدة كبيرة أن هذا يمكن أن توفر لك، هذا شيء أنا أوصي تمكين. يرجى أن يكون على علم، مع ذلك، أن استخدام الفيروسات مجموع API، التي يجب أن تتوافق مع شروط الخدمة، ويجب أن تلتزم جميع المبادئ التوجيهية حسب وصفه الفيروسات مجموع الوثائق! لا يجوز لك استخدام هذه الميزة التكامل ما لم:</li>
 <ul>
  <li>لقد قرأت ووافقت على شروط الخدمة من فيروس توتال و API لها. شروط الخدمة من فيروس توتال و API ليمكن العثور عليها <a href="https://www.virustotal.com/en/about/terms-of-service/">هنا</a>.</li>
  <li>لقد قرأت وفهمت، كحد أدنى، ديباجة الفيروسات وثائق API ملفه مجموع (كل شيء بعد "VirusTotal Public API v2.0" ولكن قبل "Contents"). يمكن العثور على وثائق  Virus Total API <a href="https://www.virustotal.com/en/documentation/public-api/">هنا</a>.</li>
 </ul>
</ul></div>

<div dir="rtl">ملاحظة: إذا مسح الملفات باستخدام فيروس معطل مجموع API، فلن تحتاج إلى مراجعة أي من توجيهات في هذه الفئة ("virustotal")، لأن أيا منهم سوف تفعل أي شيء إذا تم تعطيل هذا. للحصول على الفيروسات مجموع مفتاح API، من أي مكان على موقعه على الانترنت، انقر على الرابط "تاريخ جماعتنا " التي تقع نحو الجزء العلوي الأيسر من الصفحة، أدخل المعلومات المطلوبة، ثم انقر على "اشترك" عند الانتهاء. اتباع جميع التعليمات المرفقة، وعندما كنت قد حصلت على مفتاح API العام، نسخ/لصق هذا المفتاح API العام إلى توجيه "vt_public_api_key" من "config.ini" ملف التكوين.<br /><br /></div>

##### <div dir="rtl">"vt_suspicion_level"<br /></div>
<div dir="rtl"><ul>
 <li>افتراضيا، سوف يقوم phpMussel بتقييد الملفات التي تقوم بمسح باستخدام الفيروسات API الكلي لتلك الملفات التي تعتبرها "المشبوهة". يمكنك ضبط اختياريا هذا التقييد عن طريق تغيير قيمة التوجيه "vt_suspicion_level".</li>
 <li>"0": تعتبر الملفات فقط مشبوهة إذا، عند مسحها بواسطة phpMussel باستخدام التواقيع الخاصة بها، وتعتبر أنها لحمل الوزن الكشف عن مجريات الأمور. وهذا يعني عمليا أن استخدام الفيروسات أن مجموع API يكون للرأي ثان لأنه عندما يشتبه phpMussel أن ملف يحتمل أن تكون ضارة، ولكن لا يمكن استبعاد تماما إلى أنه قد يحتمل أيضا أن تكون حميدة (غير الخبيثة)، وبالتالي لولاها عادة لا يرفضها أو العلم بأنها خبيثة.</li>
 <li>"1": تعتبر الملفات المشبوهة إذا، عند مسحها بواسطة phpMussel باستخدام التواقيع الخاصة بها، وتعتبر أنها لحمل الوزن الكشف عن مجريات الأمور، إذا كنت معروفة ليكون قابل للتنفيذ (ملفات PE، ملفات mach-o، ELF / لينكس، الخ)، أو إذا كنت معروفة لتكون ذات شكل التي يمكن أن تحتوي على بيانات قابلة للتنفيذ (مثل وحدات الماكرو القابلة للتنفيذ، DOC / ملفات DOCX، ملفات الأرشيف مثل RARS، الكود البريدية وغيرها). هذا هو مستوى الشكوك الافتراضية وأوصت للتطبيق، وهذا يعني فعليا أن استخدام الفيروسات أن مجموع API يكون للرأي ثان لأنه عندما phpMussel لا يجد في البداية أي شيء ضار أو خطأ في ملف أنها تعتبر أن تكون مشبوهة، وبالتالي سوف خلاف ذلك عادة لا يرفضها أو العلم بأنها خبيثة.</li>
 <li>"2": تعتبر جميع الملفات المشبوهة ويجب أن يتم فحصها باستخدام الفيروسات مجموع API. أنا لا أوصي عموما تطبيق هذا المستوى الشك، نظرا لخطر الوصول إلى الحصة API بشكل أسرع مما سيكون عليه الحال كثيرا، ولكن هناك ظروف معينة (مثل عندما المسئول عن الموقع أو المضيف لديها القليل جدا من الإيمان أو الثقة على الإطلاق في أي من المحتويات التي يتم تحميلها من مستخدميها) حيث هذا المستوى شك يمكن أن يكون مناسبا. مع هذا المستوى الشك، كل الملفات لا يتم حظر عادة أو ترفع العلم بأنها خبيثة سيتم مسحها ضوئيا باستخدام الفيروسات مجموع API. نلاحظ مع ذلك، أن phpMussel والتوقف عن استخدام الفيروسات API الكلي عندما تم التوصل إلى الحصص API الخاص بك (بغض النظر عن مستوى الشك)، والتي من المرجح أن يتم التوصل الحصص بشكل أسرع بكثير عند استخدام هذا المستوى الشك.</li>
</ul></div>

<div dir="rtl">ملاحظة: بغض النظر عن مستوى الشبهات، لن يتم فحصها أي الملفات التي إما أن تكون على القائمة السوداء أو التي أدرجها phpMussel باستخدام الفيروسات مجموع API، لان لقد أعلن هؤلاء مثل هذه الملفات بالفعل إما خبيثة أو حميدة من قبل phpMussel بحلول الوقت الذي كانوا لظل ذلك تم فحصها من قبل الفيروسات مجموع API، وبالتالي لن تكون هناك حاجة مسح إضافي. والقصد من قدرة phpMussel لمسح الملفات باستخدام الفيروسات مجموع API لبناء المزيد من الثقة لما إذا كان ملف خبيث أو حميد في هذه الظروف حيث phpMussel نفسها ليس من المؤكد تماما ما إذا كان ملف خبيث أو حميد.<br /><br /></div>

##### <div dir="rtl">"vt_weighting"<br /></div>
<div dir="rtl"><ul>
 <li>هل phpMussel يطبق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة أو الممكن كشفها؟ يوجد هذا التوجيه لأنه على الرغم من أن مسح ملف باستخدام محركات متعددة (كما فايروس توتال لا) ينبغي أن يؤدي في معدل اكتشاف زيادة (وبالتالي في عدد أكبر من الملفات الخبيثة الوقوع)، فإنه يمكن أن يؤدي أيضا إلى ارتفاع عدد كاذبة الإيجابيات، وبالتالي، في بعض الظروف، فإن نتائج المسح يمكن الاستفادة بشكل أفضل كما على درجة الثقة بدلا من أن تكون نتيجة محددة. إذا تم استخدام قيمة 0، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما المكتشفة و بالتالي إذا أي محرك تستخدم من قبل الفيروسات مجموع أعلام الملف تم مسحها ضوئيا بأنها خبيثة، وphpMussel النظر في الملف إلى تكون ضارة. إذا تم استخدام أي قيمة أخرى، سيتم تطبيق نتائج المسح باستخدام الفيروسات مجموع API كما الترجيح الكشف و بالتالي فإن عدد من المحركات المستخدمة من قبل الفيروسات إجمالي هذا العلم الملف تم مسحها ضوئيا بأنها خبيثة سيكون بمثابة نتيجة الثقة (أو الترجيح الكشف) عن ما إذا كان ملف تم مسحها ضوئيا ينبغي النظر الخبيثة التي كتبها phpMussel (القيمة المستخدمة سيمثل الحد الأدنى من الثقة يسجل أو الوزن المطلوب من أجل أن تعتبر ضارة). يتم استخدام قيمة 0 افتراضيا.</li>
</ul></div>

<div dir="rtl">"vt_quota_rate" و "vt_quota_time"<br /><br /></div>
<div dir="rtl"><ul>
 <li>استنادا إلى وثائق الفيروسات الكلي API، "فإنه يقتصر على الأكثر 4 طلبات من أي نوع في أي إطار زمني معين 1 دقيقة. إذا قمت بتشغيل honeyclient، مصيدة أو أي أتمتة الآخر الذي يجري لتوفير الموارد اللازمة لفايروس توتال ولا استرداد فقط تقارير يحق لك الحصول على أعلى حصص معدلات الطلب". افتراضيا، سوف phpMussel الالتزام الصارم لهذه القيود، ولكن نظرا لإمكانية هذه الحصص نسبة تجري زيادة، وتقدم هذه التوجيهات اثنين كوسيلة لتتمكن من إرشاد phpMussel على ما الحد الأقصى ينبغي أن تلتزم بها. إلا إذا كنت قد أعطيت تعليمات للقيام بذلك، فإنه من غير المستحسن بالنسبة لك لزيادة هذه القيم و لكن إذا كنت قد واجهت مشاكل تتعلق الوصول الحصص الخاصة بك، وخفض هذه القيم قد يساعد في بعض الأحيان كنت في التعامل مع هذه المشاكل. يتم تحديد الحد الأقصى معدل حسابك عن طلبات "vt_quota_rate" من أي نوع في أي إطار "vt_quota_time" الوقت دقيقة معين.</li>
</ul></div>

#### <div dir="rtl">"urlscanner" (التصنيف)<br /></div>
<div dir="rtl">مدمج في phpMussel هو ماسح URL، قادر على الكشف عن عناوين المواقع الخبيثة من داخل أي بيانات أو ملفات تم فحصها.<br /><br /></div>

<div dir="rtl">ملاحظة: إذا تم تعطيل فحص URL، فلن تحتاج إلى مراجعة أي من توجيهات في هذه الفئة ("urlscanner")، لأن لا احد منهم سوف تفعل أي شيء إذا تم تعطيل هذا.<br /><br /></div>

<div dir="rtl">تكوين بحث API في فحص URL.<br /><br /></div>

##### <div dir="rtl">"lookup_hphosts"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين عمليات بحث API إلى API <a href="http://hosts-file.net/">hpHosts</a>. hpHosts لا يحتاج الى مفتاح API لأداء عمليات البحث API.</li>
</ul></div>

##### <div dir="rtl">"google_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>تمكين عمليات بحث API إلى API التصفح الآمن من Google عندما يتم تعريف مفتاح API الضروري. التصفح الآمن في جوجل: عمليات البحث API بحاجة إلى مفتاح API، والتي يمكن الحصول عليها من <a href="https://console.developers.google.com/">هنا</a>.</li>
 <li>ملاحظة: مطلوب تمديد cURL من أجل استخدام هذه الميزة.</li>
</ul></div>

##### <div dir="rtl">"maximum_api_lookups"<br /></div>
<div dir="rtl"><ul>
 <li>العدد الأقصى المسموح به من عمليات بحث واجهة برمجة التطبيقات لأداء في تكرار المسح الفردية. لأن كل بحث API إضافية سوف يضيف إلى الوقت الإجمالي المطلوب لإكمال كل تكرار المسح، قد ترغب في اشتراط وجود قيود من أجل الإسراع في عملية المسح الشاملة. عند تعيينها إلى 0، سيتم تطبيق الحد الأقصى لا هذا العدد المسموح به. تعيين إلى 10 افتراضيا.</li>
</ul></div>

##### <div dir="rtl">"maximum_api_lookups_response"<br /></div>
<div dir="rtl"><ul>
 <li>ماذا تفعل إذا تم تجاوز الحد الأقصى المسموح به من عمليات بحث API؟ = كاذبة لا تفعل شيئا (متابعة المعالجة) [افتراضي]. صحيح/True = تحديد الملف.</li>
</ul></div>

##### <div dir="rtl">"cache_time"<br /></div>
<div dir="rtl"><ul>
 <li>متى (بالثواني) يجب التوصل إلى نتائج عمليات بحث API؟ الافتراضي هو 3600 ثانية (1 ساعة).</li>
</ul></div>

#### <div dir="rtl">"legal" (التصنيف)<br /></div>
<div dir="rtl">التكوين المتعلق بالمتطلبات القانونية.<br /><br /></div>

<div dir="rtl">لمزيد من المعلومات حول المتطلبات القانونية وكيف يمكن أن يؤثر ذلك على متطلبات التهيئة الخاصة بك، يرجى الرجوع إلى قسم <a href="#SECTION11">المعلومات القانونية</a> من الوثائق.<br /><br /></div>

##### <div dir="rtl">"pseudonymise_ip_addresses"<br /></div>
<div dir="rtl"><ul>
 <li>إخفاء عناوين IP عند كتابة السجلات؟ صحيح/True = نعم؛ زائفة/False = لا [افتراضي].</li>
</ul></div>

##### <div dir="rtl">"privacy_policy"<br /></div>
<div dir="rtl"><ul>
 <li>عنوان سياسة الخصوصية ذات الصلة ليتم عرضها في تذييل الصفحات التي تم إنشاؤها. حدد عنوان URL، أو اتركه فارغًا لتعطيله.</li>
</ul></div>

#### <div dir="rtl">"template_data" (التصنيف)<br /></div>
<div dir="rtl">توجيهات/متغيرات القوالب والمواضيع.<br /><br /></div>

<div dir="rtl">تتعلق البيانات بقالب انتاج HTML تستخدم لتوليد "رفض تحميل" الرسالة المعروضة للمستخدمين على تحميل ملف حجبها. إذا كنت تستخدم موضوعات مخصصة لـ phpMussel، هو مصدر إخراج HTML من ملف <code dir="ltr">template_custom.html</code> وغيرها، ويتم الحصول على إخراج HTML من ملف <code dir="ltr">template.html</code>. يتم تحليل المتغيرات الخطية لهذا القسم من ملف التكوين إلى إخراج HTML عن طريق استبدال أي أسماء المتغيرات محاط بواسطة الأقواس الموجودة داخل إخراج HTML مع البيانات المتغيرة المناظرة. فمثلا، أين <code dir="ltr">foo="bar"</code>، أي مثيل <code dir="ltr">&lt;p&gt;{foo}&lt;/p&gt;</code> وجدت داخل إخراج HTML ستصبح <code dir="ltr">&lt;p&gt;bar&lt;/p&gt;</code>.<br /><br /></div>

##### <div dir="rtl">"theme"<br /></div>
<div dir="rtl"><ul>
 <li>الموضوع الافتراضي لاستخدام phpMussel.</li>
</ul></div>

##### <div dir="rtl">"Magnification"<br /></div>
<div dir="rtl"><ul>
 <li>تكبير الخط. افتراضي = 1.</li>
</ul></div>

##### <div dir="rtl">"css_url"<br /></div>
<div dir="rtl"><ul>
 <li>ملف الصيغة النموذجية للمواضيع مخصصة يستخدم خصائص CSS الخارجية، في حين أن ملف قالب لموضوع الافتراضي يستخدم خصائص CSS الداخلية. لإرشاد phpMussel لاستخدام ملف النموذجية للمواضيع مخصصة، تحديد عنوان HTTP العام من ملفات CSS موضوع المخصصة لديك باستخدام "css_url" متغير. إذا تركت هذا الحقل فارغا متغير، سوف يقوم phpMussel باستخدام ملف القالب لموضوع التقصير.</li>
</ul></div>

#### <div dir="rtl">"PHPMailer" (التصنيف)<br /></div>
<div dir="rtl">تكوين PHPMailer.<br /><br /></div>

##### <div dir="rtl">"EventLog"<br /></div>
<div dir="rtl"><ul>
 <li>ملف لتسجيل جميع الأحداث المتعلقة ب PHPMailer. تحديد اسم الملف، أو اتركه فارغا لتعطيل.</li>
</ul></div>

##### <div dir="rtl">"SkipAuthProcess"<br /></div>
<div dir="rtl"><ul>
 <li>تعيين هذا التوجيه إلى <code dir="ltr">true</code> يرشد PHPMailer لتخطي عملية المصادقة التي تحدث عادة عند إرسال البريد الإلكتروني عبر SMTP. يجب تجنب هذا، لأن تخطي هذه العملية قد يعرض البريد الإلكتروني الصادر إلى هجمات MITM، ولكنه قد يكون ضروريًا في الحالات التي تمنع فيها هذه العملية من اتصال PHPMailer بخادم SMTP.</li>
</ul></div>

##### <div dir="rtl">"Enable2FA"<br /></div>
<div dir="rtl"><ul>
 <li>يحدد هذا التوجيه ما إذا كان سيتم استخدام 2FA للحسابات front-end أم لا.</li>
</ul></div>

##### <div dir="rtl">"Host"<br /></div>
<div dir="rtl"><ul>
 <li>مضيف SMTP الذي يستخدم للبريد الإلكتروني الصادر.</li>
</ul></div>

##### <div dir="rtl">"Port"<br /></div>
<div dir="rtl"><ul>
 <li>رقم المنفذ المراد استخدامه للبريد الإلكتروني الصادر. افتراضي = 587.</li>
</ul></div>

##### <div dir="rtl">"SMTPSecure"<br /></div>
<div dir="rtl"><ul>
 <li>البروتوكول المستخدم عند إرسال البريد الإلكتروني عبر SMTP (TLS أو SSL).</li>
</ul></div>

##### <div dir="rtl">"SMTPAuth"<br /></div>
<div dir="rtl"><ul>
 <li>يحدد هذا التوجيه ما إذا كنت تريد مصادقة جلسات SMTP (يجب ألا يغير هذا عادة).</li>
</ul></div>

##### <div dir="rtl">"Username"<br /></div>
<div dir="rtl"><ul>
 <li>اسم المستخدم لاستخدامه عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

##### <div dir="rtl">"Password"<br /></div>
<div dir="rtl"><ul>
 <li>كلمة المرور لاستخدامها عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

##### <div dir="rtl">"setFromAddress"<br /></div>
<div dir="rtl"><ul>
 <li>عنوان المرسل للاستشهاد عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

##### <div dir="rtl">"setFromName"<br /></div>
<div dir="rtl"><ul>
 <li>اسم المرسل للاستشهاد عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

##### <div dir="rtl">"addReplyToAddress"<br /></div>
<div dir="rtl"><ul>
 <li>عنوان الرد للاستشهاد عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

##### <div dir="rtl">"addReplyToName"<br /></div>
<div dir="rtl"><ul>
 <li>اسم الرد للاستشهاد عند إرسال البريد الإلكتروني عبر SMTP.</li>
</ul></div>

---


### <div dir="rtl">٨. <a name="SECTION8"></a>شكل/تنسيق التوقيع</div>

<div dir="rtl">أنظر أيضا:<br /></div>
<div dir="rtl"><ul>
 <li><a href="#WHAT_IS_A_SIGNATURE">ما هو "التوقيع"؟</a></li>
</ul></div>

<div dir="rtl">أول 9 بايت <code dir="ltr">[x0-x8]</code> من ملف التوقيع phpMussel هو <code dir="ltr">phpMussel</code>، والعمل بمثابة "عدد سحري" (magic number)، لتحديدها كملفات توقيع (وهذا يساعد على منع عن طريق الخطأ باستخدام الملفات التي ليست ملفات التوقيع). البايت المقبل <code dir="ltr">[x9]</code> يحدد نوع ملف التوقيع، والتي يجب أن تعرف من أجل أن تكون قادرة على تفسير ملف التوقيع بشكل صحيح. يتم التعرف على الأنواع التالية من ملفات التوقيع:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">نوع</div> | <div dir="rtl" style="display:inline;">بايت</div> | <div dir="rtl" style="display:inline;">وصف</div>
---|---|---
`General_Command_Detections` | `0?` | <div dir="rtl" style="display:inline;">بالنسبة إلى ملفات التوقيع "القيم المفصولة بفواصل". التوقيعات هي سلاسل مشفرة عشرية للبحث عن الملفات. التوقيعات هنا ليس لديها أي أسماء أو تفاصيل أخرى (فقط السلسلة للكشف).</div>
`Filename` | `1?` | <div dir="rtl" style="display:inline;">لتوقيعات اسم الملف.</div>
`Hash` | `2?` | <div dir="rtl" style="display:inline;">لتوقيعات تجزئة الملف.</div>
`Standard` | `3?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مباشرة مع محتوى الملف.</div>
`Standard_RegEx` | `4?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مباشرة مع محتوى الملف. يمكن أن تحتوي التوقيعات على تعبيرات عادية.</div>
`Normalised` | `5?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع محتوى ملف أنسي-تطبيع.</div>
`Normalised_RegEx` | `6?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع محتوى ملف أنسي-تطبيع. يمكن أن تحتوي التوقيعات على تعبيرات عادية.</div>
`HTML` | `7?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع محتوى ملف بتنسيق هتمل.</div>
`HTML_RegEx` | `8?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع محتوى ملف بتنسيق هتمل. يمكن أن تحتوي التوقيعات على تعبيرات عادية.</div>
`PE_Extended` | `9?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع البيانات الوصفية PE (باستثناء البيانات الوصفية المقطعية PE).</div>
`PE_Sectional` | `A?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع البيانات الوصفية المقطع PE.</div>
`Complex_Extended` | `B?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع قواعد مختلفة استنادا إلى بيانات التعريف الموسعة التي تم إنشاؤها بواسطة phpMussel.</div>
`URL_Scanner` | `C?` | <div dir="rtl" style="display:inline;">لملفات التوقيع التي تعمل مع عناوين URL.</div>

<div dir="rtl">البايت المقبل <code dir="ltr">[x10]</code> هو خط جديد <code dir="ltr">[0A]</code>، ويختتم رأس ملف التوقيع phpMussel.<br /><br /></div>

<div dir="rtl">كل خط غير فارغ بعد ذلك هو توقيع أو قاعدة. كل توقيع أو قاعدة تحتل سطر واحد. وفيما يلي وصف لأشكال التوقيع المعتمدة.<br /><br /></div>

#### *<div dir="rtl">توقيعات اسم الملف</div>*
<div dir="rtl">كل توقيعات اسم الملف تتبع التنسيق التالي:<br /><br /></div>

`NAME:FNRX`

<div dir="rtl">حيث "NAME" هو الاسم المذكور في التوقيع و "FNRX" نمط التعابير المنطقية بحيث تتطابق الأسماء (الغير مشفرة) مقابله.<br /><br /></div>

#### *<div dir="rtl">توقيعات تجزئة</div>*
<div dir="rtl">جميع التوقيعات تجزئة تتبع التنسيق:<br /><br /></div>

`HASH:FILESIZE:NAME`

<div dir="rtl">حيث "HASH" هي تجزئة تجزئة للملف كله (عادة MD5)، و "FILESIZE" هي الحجم الإجمالي لذلك الملف و "NAME" هو الاسم المذكور في التوقيع.<br /><br /></div>

#### *<div dir="rtl">توقيعات PE الجزئية</div>*
<div dir="rtl">جميع توقيعات PE الجزئية تتبع التنسيق:<br /><br /></div>

`SIZE:HASH:NAME`

<div dir="rtl">حيث "HASH" هو تجزئة "MD5" لجزء من ملف PE، "SIZE" هو الحجم الكلي لهذا القسم، "NAME" هو الاسم المذكور في التوقيع.<br /><br /></div>

#### *<div dir="rtl">توقيعات PE الموسعة</div>*
<div dir="rtl">جميع توقيعات PE الموسعة تتبع التنسيق:<br /><br /></div>

`$VAR:HASH:SIZE:NAME`

<div dir="rtl">حيث <code dir="ltr">$VAR</code> هو اسم المتغير PE للتطابق معه، "HASH" هو تجزئة "MD5" هذا المتغير، "SIZE" هو الحجم الكلي لهذا المتغير والاسم هو الاسم المذكور في التوقيع.<br /><br /></div>

#### *<div dir="rtl">التوقيعات المركبة الموسعة</div>*
<div dir="rtl">التواقيع المركبة الموسعة هي مختلفة عن أنواع أخرى من التوقيعات المحتملة مع phpMussel، في أنهم يقومون بمطابقة مع ما تم تعيينه من قبل التوقيعات أنفسهم وأنها يمكن أن تتطابق ضد معايير متعددة. محدد مع معايير المطابقة ";" ونوع المطابقة و بيانات المطابقة و كل معايير المطابقة محددة بواسطة ":" ذلك أن شكل هذه التوقيعات يميل قليلا إلى مثل:<br /><br /></div>

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

#### *<div dir="rtl">كل شيء آخر</div>*
<div dir="rtl">جميع التوقيعات الأخرى تتبع التنسيق:<br /><br /></div>

`NAME:HEX:FROM:TO`

<div dir="rtl">حيث "NAME" هو الاسم المذكور لهذا التوقيع و "HEX" هو الترميز الجزئي السادس عشري من الملف المراد أن يقابله تواقيع معينة. من وإلى المعاملات الاختيارية، مشيرا من خلالها إلى المواضع في البيانات المصدر للتحقق منها.<br /><br /></div>

#### *<div dir="rtl">التعابير المنطقية</div>*
<div dir="rtl">أي شكل من أشكال التعابير المنطقية يتم فهمها ومعالجتها بشكل صحيح عن طريق PHP و يجب أيضا أن يكون مفهوما بشكل صحيح و تتم معالجتها بواسطة phpMussel و توقيعاتها. مع ذلك، أود أن أقترح اتخاذ الحذر الشديد عند كتابة توقيعات التعابير المنطقية الجديدة، لأنه إذا لم تكن متأكدا تماما مما تفعله، يمكن أن يكون هناك عدم انتظام كبير و/أو نتائج غير متوقعة. القي نظرة على phpMussel مصدر الترميز إذا لم تكن متأكدا تماما من السياق الذي يتم تحليل البيانات باستخدام التعابير المنطقية. أيضا، تذكر أن كل أنماط (باستثناء اسم الملف، أرشيف البيانات الوصفية وأنماط MD5) يجب أن تتبع ترميز سادس عشري(عند تركيب نمط ما، بالتأكيد)!<br /><br /></div>

---


### <div dir="rtl">٩. <a name="SECTION9"></a>مشاكل التوافق المعروفة</div>

#### <div dir="rtl">PHP و PCRE</div>

<div dir="rtl">phpMussel يتطلب PHP و PCRE لتنفيذ وظيفته بشكل صحيح و بدون أحدهما أو كلاهما فإن البرنامج لن يعمل بشكل صحيح. تأكد من أن نظامك يمتلك كلا من PHP و PCRE مثبتين و متاحين قبل أن تقوم بتنزيل و تثبيت phpMussel.<br /><br /></div>

#### <div dir="rtl">التوافق البرمجي لبرنامج مكافحة الفيروسات</div>

<div dir="rtl">بالنسبة للجزء الأكبر، ينبغي أن يكون phpMussel متوافق إلى حد ما مع معظم برامج مكافحة و فحص الفيروسات الأخرى. مع ذلك، فقد تم الإبلاغ عن تعارضات من قبل عدد من المستخدمين في الماضي. وهذه المعلومات أدناه من VirusTotal.com، و توضح عدد من ايجابيات كاذبة (فحص خاطئ بوجود فايروس) ذكرت من قبل مختلف برامج مكافحة الفيروسات ضد phpMussel. على الرغم من أن هذه المعلومات ليست ضمانة مطلقة من أنك سوف تواجه أو لا مشاكل توافق بين phpMussel وبرنامج مكافحة الفيروسات الخاص بك، إذا لاحظ برنامج مكافحة الفيروسات الخاص بك ضعف تجاه phpMussel، يجب عليك إما النظر في تعطيله قبل العمل مع phpMussel أو أن تنظر في خيارات بديلة إما الخاصة ببرنامج مكافحة الفيروسات أو phpMussel.<br /><br /></div>

<div dir="rtl">آخر تحديث لهذه المعلومات كان في 2018.10.09 و هي كذلك الحالية للإصدارين الثانويين الذين تم إصدارهما مؤخرا (v1.5.0-v1.6.0) من phpMussel.<br /><br /></div>

<div dir="rtl"><em>تنطبق هذه المعلومات فقط على الحزمة الرئيسية. قد تختلف النتائج استنادا إلى ملفات التوقيع المثبتة، والمكونات الإضافية، والمكونات الطرفية الأخرى.</em><br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">برنامج فحص الفيروسات</div> | <div dir="rtl" style="display:inline;">النتيجة</div>
----|----
Bkav | <div dir="rtl" style="display:inline;">"VEX.Webshell" تقارير</div>

---


### <div dir="rtl">١٠. <a name="SECTION10"></a>أسئلة وأجوبة (FAQ)</div>

<div dir="rtl"><ul>
 <li><a href="#WHAT_IS_A_SIGNATURE">ما هو "التوقيع"؟</a></li>
 <li><a href="#WHAT_IS_A_FALSE_POSITIVE">ما هو "إيجابية خاطئة"؟</a></li>
 <li><a href="#SIGNATURE_UPDATE_FREQUENCY">عدد المرات التي يتم تحديثها التوقيعات؟</a></li>
 <li><a href="#ENCOUNTERED_PROBLEM_WHAT_TO_DO">لقد واجهت مشكلة! أنا لا أعرف ما يجب القيام به! الرجاء المساعدة!</a></li>
 <li><a href="#MINIMUM_PHP_VERSION">أريد استخدام phpMussel مع نسخة PHP كبار السن من 5.4.0؛ يمكنك أن تساعد؟</a></li>
 <li><a href="#PROTECT_MULTIPLE_DOMAINS">هل يمكنني استخدام تثبيت phpMussel واحد لحماية نطاقات متعددة؟</a></li>
 <li><a href="#PAY_YOU_TO_DO_IT">أنا لا أريد أن تضيع الوقت مع تثبيت هذا أو ضمان أنه يعمل لموقع الويب الخاص بي؛ يمكنني دفع لك أن تفعل ذلك بالنسبة لي؟</a></li>
 <li><a href="#HIRE_FOR_PRIVATE_WORK">هل يمكنني توظيفك أو أي من مطوري هذا المشروع للعمل الخاص؟</a></li>
 <li><a href="#SPECIALIST_MODIFICATIONS">أنا بحاجة إلى تعديلات متخصصة، والتخصيصات، الخ؛ يمكنك أن تساعد؟</a></li>
 <li><a href="#ACCEPT_OR_OFFER_WORK">أنا مطور، مصمم موقع، أو مبرمج. هل يمكنني قبول أو عرض العمل المتعلق بهذا المشروع؟</a></li>
 <li><a href="#WANT_TO_CONTRIBUTE">أريد أن أساهم في المشروع؛ هل يمكنني فعل هذا؟</a></li>
 <li><a href="#SCAN_DEBUGGING">كيفية الوصول إلى تفاصيل محددة حول الملفات عند مسحها ضوئيا؟</a></li>
 <li><a href="#CRON_TO_UPDATE_AUTOMATICALLY">هل يمكنني استخدام cron لتحديث تلقائيا؟</a></li>
 <li><a href="#SCAN_NON_ANSI">هل يمكن فحص ملفات phpMussel بأسماء غير ANSI؟</a></li>
 <li><a href="#BLACK_WHITE_GREY">القوائم السوداء – القوائم البيضاء – القائمة الرمادية – ما هي، وكيف أستخدمها؟</a></li>
 <li><a href="#CHANGE_COMPONENT_SORT_ORDER">عندما أقوم بتنشيط أو إلغاء تنشيط ملفات التوقيع عبر صفحة التحديثات، فإنها تقوم بترتيبها أبجديًا في التكوين. هل يمكنني تغيير الطريقة التي يتم تصنيفها بها؟</a></li>
</ul></div>

#### <div dir="rtl"><a name="WHAT_IS_A_SIGNATURE"></a>ما هو "التوقيع"؟<br /><br /></div>

<div dir="rtl">في phpMussel، يشير "التوقيع" إلى البيانات التي تعمل كمعرف، وعادة ما تكون قطعة صغيرة من الكل أكبر لشيء نسعى. تتضمن عادة تصنيفا، وبيانات مفيدة أخرى للمساعدة في توفير سياق إضافي. وهذا يمكن أن يساعدنا على تحديد أفضل طريقة للمضي قدما عندما نجد ذلك.<br /><br /></div>

#### <div dir="rtl"><a name="WHAT_IS_A_FALSE_POSITIVE"></a>ما هو "إيجابية خاطئة"؟<br /><br /></div>

<div dir="rtl">المصطلح "إيجابية خاطئة" (<em>بدلا من ذلك: "خطأ إيجابية خاطئة"؛ "انذار خاطئة"</em>؛ الإنجليزية: <em>false positive</em>; <em>false positive error</em>; <em>false alarm</em>)، وصف ببساطة، بشكل عام، يستخدم عند اختبار حالة، للإشارة إلى نتائج هذا الاختبار، عندما تكون النتائج إيجابية (أي، تحديد حالة أن يكون "إيجابية"، أو "صحيح")، ولكن من المتوقع أن تكون (أو كان ينبغي أن يكون) سلبي (أي، الحالة، في الواقع، هو "سلبي"، أو "خاطئة"). "إيجابية خاطئة" ويمكن اعتبار التناظرية من "الذئب الباكي" (حيث لحالة يجري اختبارها هو ما إذا كان هناك ذئب بالقرب من القطيع، الحالة هو "خاطئة" في أنه لا يوجد الذئب بالقرب من القطيع، و الحالة يقال بأنها "إيجابية" بواسطة الراعي عن طريق الدعوة "الذئب، الذئب")، أو التناظرية من الفحص الطبي حيث المريض يتم تشخيص المرض، عندما تكون في واقع، ليس لديهم المرض.<br /><br /></div>

<div dir="rtl">بعض المصطلحات ذات الصلة هي "إيجابية صحيح"، "سلبي صحيح" و "سلبي خاطئة". "إيجابية صحيح" هو عندما تكون نتائج الاختبار والحالة الفعلية للحالة على حد سواء صحيح (أو "إيجابية")، و "سلبي صحيح" هو عندما تكون نتائج الاختبار والحالة الفعلية للحالة على حد سواء خاطئة (أو "سلبي")؛ "إيجابية صحيح" أو "سلبي صحيح" ويعتبر أن تكون "الاستدلال الصحيح". نقيض ل "إيجابية خاطئة" هو "سلبي خاطئة"؛ "سلبي خاطئة" هو عندما تكون النتائج سلبي (أي، تحديد حالة أن يكون "سلبي"، أو "خاطئة")، ولكن من المتوقع أن تكون (أو كان ينبغي أن يكون) إيجابية (أي، الحالة، في الواقع، هو "إيجابية"، أو "صحيح").<br /><br /></div>

<div dir="rtl">في سياق phpMussel، هذه المصطلحات تشير إلى التوقيعات phpMussel والملفات التي كانت منع. عندما phpMussel يمنع ملف نظرا لتوقيع سيئة، قديمة أو غير صحيحة، ولكن لا ينبغي أن تفعل ذلك، أو عندما يفعل ذلك لأسباب خاطئة، نشير إلى هذا الحدث باعتباره "إيجابية خاطئة". عندما phpMussel يفشل لمنع ملف التي كان ينبغي أن سدت، بسبب تهديدات غير متوقعة، التوقيعات المفقودة أو أوجه القصور توقيع، نشير إلى هذا الحدث باعتباره "افتقد" (هذا هو التناظرية من ا "سلبي خاطئة").<br /><br /></div>

<div dir="rtl">هذا يمكن تلخيصها حسب الجدول أدناه:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline;">phpMussel لا ينبغي منع ملف</div> | &nbsp; <div dir="rtl" style="display:inline;">phpMussel يجب منع ملف</div> | &nbsp;
---|---|---
&nbsp; <div dir="rtl" style="display:inline;">سلبي صحيح (الاستدلال الصحيح)</div> | <div dir="rtl" style="display:inline;">افتقد (التناظرية من سلبي خاطئة)</div> | <div dir="rtl" style="display:inline;"><strong>phpMussel لا يمنع ملف</strong></div>
&nbsp; <div dir="rtl" style="display:inline;"><strong>إيجابية خاطئة</strong></div> | <div dir="rtl" style="display:inline;">إيجابية صحيح (الاستدلال الصحيح)</div> | <div dir="rtl" style="display:inline;"><strong>phpMussel منع ملف</strong></div>

#### <div dir="rtl"><a name="SIGNATURE_UPDATE_FREQUENCY"></a>عدد المرات التي يتم تحديثها التوقيعات؟<br /><br /></div>

<div dir="rtl">أنه يختلف. نحن نحاول قدر الإمكان، ولكن نظرا لالتزامات أخرى، حياتنا اليومية، وعدم حصولهم على رواتبهم، تحديث الجدول الزمني الدقيق لا يمكن أن تكون مضمونة. ورحب المساعدة دائما.<br /><br /></div>

#### <div dir="rtl"><a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>لقد واجهت مشكلة! أنا لا أعرف ما يجب القيام به! الرجاء المساعدة!</div>
<div dir="rtl"><ul>
 <li>تحقق مما إذا كنت تستخدم أحدث إصدار من البرنامج والتوقيع الملفات.</li>
 <li>قراءة الوثائق. قد تكون هناك إجابات هناك.</li>
 <li>قراءة <strong><a href="https://github.com/phpMussel/phpMussel/issues">صفحة المشكلات</a></strong>. قد تكون هناك إجابات هناك.</li>
 <li>لا يوجد حتى الآن إجابات؟ يرجى طلب المساعدة عبر صفحة القضايا.</li>
</ul></div>

#### <div dir="rtl"><a name="MINIMUM_PHP_VERSION"></a>أريد استخدام phpMussel مع نسخة PHP كبار السن من 5.4.0؛ يمكنك أن تساعد؟<br /><br /></div>

<div dir="rtl">لا. PHP 5.4.0 دعم إنهاء عام 2014. الدعم الأمني الموسع إنهاء في عام 2015. حاليا، فمن عام 2017، وPHP 7.1.0 متاحة بالفعل. يتم توفير دعم لاستخدام phpMussel مع PHP 5.4.0 و كل ما هو متاح أحدث إصدارات PHP. لن تكون معتمدة الإصدارات القديمة PHP.<br /><br /></div>

<div dir="rtl"><em>انظر أيضا: <a href="https://maikuolan.github.io/Compatibility-Charts/">مخططات التوافق</a>.</em><br /><br /></div>

#### <div dir="rtl"><a name="PROTECT_MULTIPLE_DOMAINS"></a>هل يمكنني استخدام تثبيت phpMussel واحد لحماية نطاقات متعددة؟<br /><br /></div>

<div dir="rtl">نعم. يمكن استخدام phpMussel لحماية نطاقات متعددة. إذا كان التكوين المطلوب مختلفا، للقيام بذلك، إنشاء ملفات تكوين جديدة، واسمه وفقا للنطاقات التي تتطلب الحماية. كمثال، ل <code dir="ltr">"http://www.some-domain.tld/"</code>، أطلق عليه اسما <code dir="ltr">"some-domain.tld.config.ini"</code>. اسم النطاق يأتي من <code dir="ltr">"HTTP_HOST"</code>. يتم تجاهل <code dir="ltr">"www"</code>.<br /><br /></div>

#### <div dir="rtl"><a name="PAY_YOU_TO_DO_IT"></a>أنا لا أريد أن تضيع الوقت مع تثبيت هذا أو ضمان أنه يعمل لموقع الويب الخاص بي؛ يمكنني دفع لك أن تفعل ذلك بالنسبة لي؟<br /><br /></div>

<div dir="rtl">ربما. وينظر في ذلك على أساس كل حالة على حدة. أخبرنا احتياجاتك وما تقدمه. سنخبرك بما إذا كنا نستطيع مساعدتك أم لا.<br /><br /></div>

#### <div dir="rtl"><a name="HIRE_FOR_PRIVATE_WORK"></a>هل يمكنني توظيفك أو أي من مطوري هذا المشروع للعمل الخاص؟<br /><br /></div>

<div dir="rtl"><em>راجع اإلجابة أعاله.</em><br /><br /></div>

#### <div dir="rtl"><a name="SPECIALIST_MODIFICATIONS"></a>أنا بحاجة إلى تعديلات متخصصة، والتخصيصات، الخ؛ يمكنك أن تساعد؟<br /><br /></div>

<div dir="rtl"><em>راجع اإلجابة أعاله.</em><br /><br /></div>

#### <div dir="rtl"><a name="ACCEPT_OR_OFFER_WORK"></a>أنا مطور، مصمم موقع، أو مبرمج. هل يمكنني قبول أو عرض العمل المتعلق بهذا المشروع؟<br /><br /></div>

<div dir="rtl">نعم. ترخيصنا لا يحظر هذا.<br /><br /></div>

#### <div dir="rtl"><a name="WANT_TO_CONTRIBUTE"></a>أريد أن أساهم في المشروع؛ هل يمكنني فعل هذا؟<br /><br /></div>

<div dir="rtl">نعم. المساهمة في المشروع هو موضع ترحيب كبير. يرجى الاطلاع على "CONTRIBUTING.md" لمزيد من المعلومات.<br /><br /></div>

#### <div dir="rtl"><a name="SCAN_DEBUGGING"></a>كيفية الوصول إلى تفاصيل محددة حول الملفات عند مسحها ضوئيا؟<br /><br /></div>

<div dir="rtl">يمكنك الوصول إلى تفاصيل محددة حول الملفات عند مسحها عن طريق تعيين مصفوفة لاستخدامها لهذا الغرض قبل توجيه phpMussel لمسحها.<br /><br /></div>

<div dir="rtl">في المثال أدناه، يتم تعيين <code dir="ltr">$Foo</code> لهذا الغرض. بعد مسح <code dir="ltr">/file/path/...</code>، سيتم تضمين معلومات مفصلة حول الملفات التي تحتوي عليها <code dir="ltr">/file/path/...</code> من قبل <code dir="ltr">$Foo</code>.<br /><br /></div>

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/file/path/...');

var_dump($Foo);
```

<div dir="rtl">المصفوفة عبارة عن مصفوفة متعددة الأبعاد تتكون من عناصر تمثل كل ملف يتم مسحه ضوئيا وعناصر فرعية تمثل تفاصيل هذه الملفات. وهذه العناصر الفرعية هي كما يلي:<br /><br /></div>

- Filename (`string`)
- FromCache (`bool`)
- Depth (`int`)
- Size (`int`)
- MD5 (`string`)
- SHA1 (`string`)
- CRC32B (`string`)
- 2CC (`string`)
- 4CC (`string`)
- ScanPhase (`string`)
- Container (`string`)
- † FileSwitch (`string`)
- † Is_ELF (`bool`)
- † Is_Graphics (`bool`)
- † Is_HTML (`bool`)
- † Is_Email (`bool`)
- † Is_MachO (`bool`)
- † Is_PDF (`bool`)
- † Is_SWF (`bool`)
- † Is_PE (`bool`)
- † Is_Not_HTML (`bool`)
- † Is_Not_PHP (`bool`)
- ‡ NumOfSections (`int`)
- ‡ PEFileDescription (`string`)
- ‡ PEFileVersion (`string`)
- ‡ PEProductName (`string`)
- ‡ PEProductVersion (`string`)
- ‡ PECopyright (`string`)
- ‡ PEOriginalFilename (`string`)
- ‡ PECompanyName (`string`)
- Results (`int`)
- Output (`string`)

<div dir="rtl"><em>† - لم يتم توفير نتائج مخبأة (تقدم فقط لنتائج مسح جديدة).</em><br /><br /></div>

<div dir="rtl"><em>‡ - يتم توفيرها فقط عند مسح ملفات PE.</em><br /><br /></div>

<div dir="rtl">اختياريا، يمكن تدمير هذه المصفوفة باستخدام ما يلي:<br /><br /></div>

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <div dir="rtl"><a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>هل يمكنني استخدام cron لتحديث تلقائيا؟<br /><br /></div>

<div dir="rtl">نعم. يتم تضمين API في front-end للتفاعل مع صفحة التحديثات عبر النصوص البرمجية الخارجية. وهناك نص منفصل، <a href="https://github.com/Maikuolan/Cronable">Cronable</a>، هو متاح، ويمكن استخدامها من قبل مدير كرون أو كرون جدولة لتحديث هذا وغيرها من الحزم المعتمدة تلقائيا (يوفر هذا البرنامج النصي وثائقه الخاصة).<br /><br /></div>

#### <div dir="rtl"><a name="SCAN_NON_ANSI"></a>هل يمكن فحص ملفات phpMussel بأسماء غير ANSI؟<br /><br /></div>

<div dir="rtl">لنفترض أن هناك مجلدًا تريد مسحه ضوئيًا. في هذا المجلد، لديك بعض الملفات ذات أسماء غير ANSI.<br /><br /></div>

- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

<div dir="rtl">لنفترض أنك إما تستخدم وضع CLI أو واجهة برمجة تطبيقات phpMussel لإجراء المسح الضوئي.<br /><br /></div>

<div dir="rtl">عند استخدام <code dir="ltr">PHP &lt; 7.1.0</code>، على بعض الأنظمة، لن يرى phpMussel هذه الملفات عند محاولة مسح المجلد، وبالتالي، لن تتمكن من فحص هذه الملفات ضوئيًا. من المرجح أن ترى النتائج نفسها كما لو كنت تفحص مجلدًا فارغًا:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">بالإضافة إلى ذلك، عند استخدام <code dir="ltr">PHP &lt; 7.1.0</code>، ينتج عن فحص الملفات بشكل فردي نتائج مثل هذه:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > Checking 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Invalid file!
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">أو هذه:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > X:/directory/??????.txt is not a file or directory.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">هذا بسبب الطريقة التي تعامل بها PHP مع أسماء ملفات غير ANSI قبل <code dir="ltr">PHP 7.1.0</code>. إذا واجهت هذه المشكلة، فإن الحل هو تحديث تثبيت PHP الخاص بك إلى الإصدار <code dir="ltr">7.1.0</code> أو الأحدث. في <code dir="ltr">PHP &gt;= 7.1.0</code>، يتم التعامل مع أسماء ملفات غير ANSI بشكل أفضل، ويجب أن يكون phpMussel قادرًا على فحص الملفات بشكل صحيح.<br /><br /></div>

<div dir="rtl">للمقارنة، فإن النتائج عند محاولة مسح المجلد باستخدام <code dir="ltr">PHP &gt;= 7.1.0</code>:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 -> Checking '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> No problems found.
 -> Checking '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> No problems found.
 -> Checking '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> No problems found.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">ومحاولة مسح الملفات بشكل فردي:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > Checking 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> No problems found.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

#### <div dir="rtl"><a name="BLACK_WHITE_GREY"></a>القوائم السوداء – القوائم البيضاء – القائمة الرمادية – ما هي، وكيف أستخدمها؟<br /><br /></div>

<div dir="rtl">تعبر المصطلحات معان مختلفة في سياقات مختلفة. في phpMussel، هناك ثلاث سياقات حيث يتم استخدام هذه المصطلحات: استجابة حجم الملف، استجابة نوع الملف، والتوقيع القائمة الرمادية.<br /><br /></div>

<div dir="rtl">من أجل تحقيق نتيجة مرغوبة بأقل تكلفة ممكنة للمعالجة، هناك بعض الأشياء البسيطة التي يمكن لـ phpMussel التحقق منها قبل مسح الملفات، مثل حجم الملف والاسم والامتداد. فمثلا؛ إذا كان الملف كبيرًا جدًا، أو إذا كانت إضافته تشير إلى نوع من الملفات لا نريد السماح به على مواقعنا الإلكترونية على أي حال، فيمكننا الإبلاغ عن الملف على الفور، ولا تحتاج إلى فحصه.<br /><br /></div>

<div dir="rtl">استجابة حجم الملف هي الطريقة التي يستجيب بها phpMussel عندما يتجاوز الملف حدًا معينًا. على الرغم من عدم وجود قوائم فعلية، يمكن اعتبار الملف في هذه القوائم بناءً على حجمه. يوجد خياران منفصلان للتوصيف لتحديد الحد والاستجابة المرغوبة على التوالي.<br /><br /></div>

<div dir="rtl">استجابة نوع الملف هي الطريقة التي يستجيب بها phpMussel لتمديد الملف. توجد ثلاثة خيارات تكوين منفصلة لتحديد الإضافات التي يجب أن تكون على أي القوائم. يمكن اعتبار الملف مدرجًا بشكل فعال إذا كانت إضافته مطابقة لأي من الإضافات المحددة على التوالي.<br /><br /></div>

<div dir="rtl">في هذين السياقين، يعني الوجود في القائمة البيضاء أنه لا يجب فحصه أو وضع علامة عليه؛ في القائمة السوداء يعني أنه يجب وضع علامة عليها (وبالتالي لا تحتاج لمسحها ضوئيًا)؛ وكونه على الشبح الرمزي يعني أن هناك حاجة إلى مزيد من التحليل لتحديد ما إذا كان ينبغي لنا وضع علامة عليه (أي، يجب فحصها).<br /><br /></div>

<div dir="rtl">القائمة الرمادية هو قائمة بالتوقيعات التي يجب تجاهلها (هذا يذكر لفترة وجيزة في وقت سابق من الوثائق). عندما يتم تشغيل التوقيع على توقيع القائمة الرمادية، يستمر phpMussel بالعمل من خلال توقيعاته ولا يتخذ أي إجراء معين فيما يتعلق بالتوقيع. لا توجد قائمة سوداء مميزة، لأن السلوك الضمني هو سلوك طبيعي للتوقيعات المشغلة على أي حال، وليس هناك قائمة بيضاء مميزة، لأن السلوك الضمني لن يكون منطقيًا حقًا بالنظر إلى كيفية عمل phpMussel العادي والإمكانيات المتوفرة لديه بالفعل.<br /><br /></div>

<div dir="rtl">يكون توقيع القائمة الرمادية مفيدًا إذا كنت بحاجة إلى حل المشكلات التي يسببها توقيع معين دون تعطيل أو إلغاء تثبيت ملف التوقيع بأكمله.<br /><br /></div>

#### <div dir="rtl"><a name="CHANGE_COMPONENT_SORT_ORDER"></a>عندما أقوم بتنشيط أو إلغاء تنشيط ملفات التوقيع عبر صفحة التحديثات، فإنها تقوم بترتيبها أبجديًا في التكوين. هل يمكنني تغيير الطريقة التي يتم تصنيفها بها؟<br /><br /></div>

<div dir="rtl">نعم. إذا كنت بحاجة إلى فرض بعض الملفات للتنفيذ بترتيب معين، فيمكنك إضافة بعض البيانات الاعتباطية قبل أسمائها في توجيه التهيئة حيث يتم إدراجها، مفصولة بنقطتين. عندما تقوم صفحة التحديثات بفرز الملفات في وقت لاحق، ستؤثر هذه البيانات العشوائية المضافة على ترتيب الفرز، مما يؤدي إلى تنفيذها وفقًا للترتيب الذي تريده، دون الحاجة إلى إعادة تسمية أي منها.<br /><br /></div>

<div dir="rtl">على سبيل المثال، بافتراض توجيه تكوين مع الملفات المسرودة كما يلي:<br /><br /></div>

`file1.php,file2.php,file3.php,file4.php,file5.php`

<div dir="rtl">إذا كنت تريد <code dir="ltr">file3.php</code> تنفيذ أولاً، يمكنك إضافة شيء مثل <code dir="ltr">aaa:</code> قبل اسم الملف:<br /><br /></div>

`file1.php,file2.php,aaa:file3.php,file4.php,file5.php`

<div dir="rtl">وبعد ذلك، إذا تم تنشيط ملف جديد، <code dir="ltr">file6.php</code>، فعندما تقوم صفحة التحديثات بفرزها مرة أخرى، يجب أن ينتهي الأمر بهذا الشكل:<br /><br /></div>

`aaa:file3.php,file1.php,file2.php,file4.php,file5.php,file6.php`

<div dir="rtl">نفس الموقف عندما يتم إلغاء تنشيط الملف. وبالعكس، إذا أردت تنفيذ الملف آخر، فيمكنك إضافة شيء مثل <code dir="ltr">zzz:</code> قبل اسم الملف. على أي حال، لن تحتاج إلى إعادة تسمية الملف المعني.<br /><br /></div>

---


### <div dir="rtl">١١. <a name="SECTION11"></a>المعلومات القانونية</div>

#### <div dir="rtl">١١.٠ مقدمة القسم<br /><br /></div>

<div dir="rtl">يصف هذا القسم من الوثائق الاعتبارات القانونية الممكنة فيما يتعلق باستخدام الحزمة وتنفيذها، ويوفر بعض المعلومات الأساسية ذات الصلة. قد يكون هذا مهمًا لبعض المستخدمين كوسيلة لضمان التوافق مع أي متطلبات قانونية قد تكون موجودة في البلدان التي يعملون فيها، وقد يحتاج بعض المستخدمين إلى تعديل سياسات موقع الويب الخاصة بهم وفقًا لهذه المعلومات.<br /><br /></div>

<div dir="rtl">أولا، يرجى ندرك أنني (مؤلف حزمة) لست محام، وليس أي نوع من المهنيين القانونيين المؤهلين. لذلك، لست مؤهلاً قانونًا لتقديم المشورة القانونية. أيضا، في بعض الحالات، قد تختلف المتطلبات القانونية بين الدول والاختصاصات المختلفة، وهذه المتطلبات القانونية المتفاوتة قد تكون متناقضة في بعض الأحيان (على سبيل المثال، الدول التي تفضل "<a href="https://ar.wikipedia.org/wiki/%D8%AD%D9%82_%D9%81%D9%8A_%D8%A7%D9%84%D8%AE%D8%B5%D9%88%D8%B5%D9%8A%D8%A9">حقوق الخصوصية</a>" و "<a href="https://ar.wikipedia.org/wiki/%D8%AD%D9%82_%D8%A7%D9%84%D9%85%D8%B1%D8%A1_%D8%A3%D9%86_%D9%8A%D9%86%D8%B3%D9%89">الحق في أن تنسى</a>"، مقارنة بالبلدان التي تفضل "الاحتفاظ بالبيانات"). ضع في اعتبارك أيضًا أن الوصول إلى الحزمة لا يقتصر على بلدان أو ولايات قضائية محددة، وبالتالي، فإن مستخدمي الحزمة من المحتمل أن يكونوا متنوعين جغرافيًا. بالنظر إلى هذه النقاط، فأنا لست في وضع يسمح لي بالإشارة إلى ما يعنيه أن يكون "متوافقة مع القانون" مع الجميع. ومع ذلك، آمل أن تساعدك هذه المعلومات على أن تقرر بنفسك ما يجب عليك القيام به للبقاء ملتزمين قانونًا في سياق الحزمة. إذا كانت لديك أي شكوك بخصوص هذه المعلومات، أو إذا كنت بحاجة إلى مساعدة ومشورة إضافية من منظور قانوني، فإنني أوصيك باستشارة متخصص قانوني مؤهل.<br /><br /></div>

#### <div dir="rtl">١١.١ المسؤولية<br /><br /></div>

<div dir="rtl">كما هو مذكور بالفعل من قبل ترخيص الحزمة، يتم توفير الحزمة دون أي ضمان. وهذا يشمل (على سبيل المثال لا الحصر) كل نطاق المسؤولية. يتم توفير الحزمة لك لراحتك، على أمل أن تكون مفيدة، وأنها سوف توفر بعض الفائدة بالنسبة لك. ومع ذلك، سواء كنت تستخدم أو تنفذ الحزمة، فذلك هو خيارك. لا تضطر إلى استخدام الحزمة أو تنفيذها، ولكن عندما تقوم بذلك، فأنت مسؤول عن هذا القرار. لا أنا ولا أي مساهم آخر في الحزمة مسؤول قانونيًا عن عواقب القرارات التي تتخذها، بصرف النظر عما إذا كانت مباشرة أو غير مباشرة أو ضمنية أو غير ذلك.<br /><br /></div>

#### <div dir="rtl">١١.٢ الأطراف الثالثة<br /><br /></div>

<div dir="rtl">اعتمادا على التكوين الدقيق والتنفيذ، قد تتواصل الحزمة وتتبادل المعلومات مع أطراف ثالثة في بعض الحالات. في بعض السياقات، من خلال بعض السلطات القضائية، يمكن تعريف ذلك على أنه "<a href="https://ar.wikipedia.org/wiki/%D9%85%D8%B9%D9%84%D9%88%D9%85%D8%A7%D8%AA_%D8%B4%D8%AE%D8%B5%D9%8A%D8%A9">معلومات تعريف شخصية</a>".<br /><br /></div>

<div dir="rtl">إن كيفية استخدام هذه المعلومات من قِبل هذه الجهات الخارجية تخضع لسياساتها، وهي خارج نطاق هذه الوثائق. ومع ذلك، في جميع هذه الحالات، يمكن تعطيل مشاركة المعلومات. في جميع هذه الحالات، إذا اخترت تمكينها، تقع على عاتقك مسؤولية البحث عن أي مخاوف قد تكون لديك بشأن الخصوصية والأمان واستخدام هذه المعلومات من قِبل هذه الأطراف الثالثة. إذا وجدت أي شكوك، أو إذا كنت غير راضي عن سلوك هذه الأطراف الثالثة، قد يكون من الأفضل تعطيل كل مشاركة المعلومات مع هذه الأطراف الثالثة.<br /><br /></div>

<div dir="rtl">لغرض الشفافية، يتم وصف نوع المعلومات المشتركة أدناه.<br /><br /></div>

##### <div dir="rtl">١١.٢.٠ خطوط الويب<br /><br /></div>

<div dir="rtl">بعض السمات المخصصة، واجهة المستخدم القياسية phpMussel، وصفحة "رفض تحميل" قد تستخدم خطوط الويب لأسباب جمالية. يتم تعطيل خطوط الويب بشكل افتراضي. عند التمكين، هناك اتصال مباشر بين متصفح المستخدم ومضيف الويب. قد ينطوي ذلك على نقل معلومات مثل عنوان IP الخاص بالمستخدم، وكيل المستخدم، نظام التشغيل، وغيرها من التفاصيل المتاحة للطلب. تستضيف <a href="https://fonts.google.com/">خدمة خطوط Google</a> معظم خطوط الويب هذه.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">disable_webfonts</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٢.١ ماسح URL<br /><br /></div>

<div dir="rtl">قد تتم مشاركة عناوين URL الموجودة داخل عمليات تحميل الملفات مع واجهة برمجة التطبيقات لـ hpHosts أو واجهة برمجة تطبيقات التصفح الآمن من Google، بناءً على كيفية تهيئة الحزمة. في حالة API hpHosts، يتم تمكين هذا السلوك بشكل افتراضي. تتطلب واجهة برمجة تطبيقات التصفح الآمن من Google مفاتيح API لكي تعمل بشكل صحيح، وبالتالي يتم تعطيلها افتراضيًا.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">lookup_hphosts</code> &lt;- <code dir="ltr">urlscanner</code></li>
 <li><code dir="ltr">google_api_key</code> &lt;- <code dir="ltr">urlscanner</code></li>
</ul></div>

##### <div dir="rtl">١١.٢.٢ VIRUS TOTAL<br /><br /></div>

<div dir="rtl">عندما يقوم phpMussel بمسح تحميل الملف، قد تتم مشاركة تجزئة تلك الملفات مع Virus Total API، بناءً على كيفية تكوين الحزمة. هناك خطط لتتمكن من مشاركة ملفات كاملة في وقت ما في المستقبل أيضًا، ولكن هذه الميزة غير مدعومة بواسطة الحزمة في الوقت الحالي. مطلوب مفتاح API من أجل استخدام هذه الميزة.<br /><br /></div>

<div dir="rtl">يمكن أيضًا مشاركة المعلومات (بما في ذلك الملفات والبيانات الوصفية ذات الصلة للملف) التي تم مشاركتها مع Virus Total مع شركائها والشركات التابعة لها ومختلف الشركات الأخرى لأغراض البحث. يتم وصف ذلك بمزيد من التفاصيل من خلال سياسة الخصوصية الخاصة بهم.<br /><br /></div>

<div dir="rtl">نرى: <a dir="ltr" href="https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy">Privacy Policy &ndash; VirusTotal</a>.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">vt_public_api_key</code> &lt;- <code dir="ltr">virustotal</code></li>
</ul></div>

#### <div dir="rtl">١١.٣ تسجيل<br /><br /></div>

Logging is an important part of phpMussel for a number of reasons. Without logging, it may be difficult to diagnose false positives, to ascertain exactly how performant phpMussel is in any particular context, and to determine where its shortfalls may be, and what changes may be required to its configuration or signatures accordingly, in order for it to continue functioning as intended. Regardless, logging mightn't be desirable for all users, and remains entirely optional. In phpMussel, logging is disabled by default. To enable it, phpMussel must be configured accordingly.

Additionally, whether logging is legally permissible, and to the extent that it is legally permissible (e.g., the types of information that may logged, for how long, and under what circumstances), may vary, depending on jurisdiction and on the context where phpMussel is implemented (e.g., whether you're operating as an individual, as a corporate entity, and whether on a commercial or non-commercial basis). It may therefore be useful for you to read through this section carefully.

There are multiple types of logging that phpMussel can perform. Different types of logging involves different types of information, for different reasons.

##### 11.3.0 SCAN LOGS

When enabled in the package configuration, phpMussel keeps logs of the files it scans. This type of logging is available in two different formats:
- Human readable logfiles.
- Serialised logfiles.

Entries to a human readable logfile typically look something like this (as an example):

```
Mon, 21 May 2018 00:47:58 +0800 Started.
> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Detected phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Finished.
```

A scan log entry typically includes the following information:
- The date and time that the file was scanned.
- The name of the file scanned.
- CRC32b hashes of the name and contents of the file.
- What was detected in the file (if anything was detected).

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">scan_log</code> &lt;- <code dir="ltr">general</code></li>
 <li><code dir="ltr">scan_log_serialized</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

When these directives are left empty, this type of logging will remain disabled.

##### 11.3.1 SCAN KILLS

When enabled in the package configuration, phpMussel keeps logs of the uploads that have been blocked.

Entries to a "scan kills" logfile typically look something like this (as an example):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Detected phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Quarantined as "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu".
```

A "scan kills" entry typically includes the following information:
- The date and time that the upload was blocked.
- The IP address where the upload originated from.
- The reason why the file was blocked (what was detected).
- The name of the file blocked.
- An MD5 and the size of the file blocked.
- Whether the file was quarantined, and under what internal name.

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">scan_kills</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">FrontEndLog</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٣ دوران السجل<br /><br /></div>

<div dir="rtl">قد ترغب في تطهير السجلات بعد فترة من الوقت، أو قد تكون مطلوبة للقيام بذلك بموجب القانون (أي أن مقدار الوقت المسموح به قانونًا لك للاحتفاظ بالسجلات قد يكون محدودًا بموجب القانون). يمكنك تحقيق ذلك عن طريق تضمين علامات التاريخ/الوقت في أسماء ملفات السجل الخاصة بك كما هو محدد بواسطة تكوين الحزمة الخاصة بك (على سبيل المثال، <code dir="ltr">{yyyy}-{mm}-{dd}.log</code>)، ثم تمكين دوران السجل (يسمح لك تدوير السجل بتنفيذ بعض الإجراءات على ملفات السجل عندما يتم تجاوز الحدود المحددة).<br /><br /></div>

<div dir="rtl">فمثلا: إذا كان من الضروري قانونًا حذف السجلات بعد 30 يومًا، يمكنني تحديد <code dir="ltr">{dd}.log</code> في أسماء ملفات السجل الخاصة بي (<code dir="ltr">{dd}</code> يمثل عدد الأيام)، قم بتعيين قيمة <code dir="ltr">log_rotation_limit</code> إلى 30، وقم بتعيين قيمة <code dir="ltr">log_rotation_action</code> إلى <code dir="ltr">Delete</code>.<br /><br /></div>

<div dir="rtl">على العكس من ذلك، إذا كنت مطالبًا بالاحتفاظ بالسجلات لفترة زمنية طويلة، فيمكنك تعطيل تدوير السجل، أو يمكنك تعيين قيمة <code dir="ltr">log_rotation_action</code> إلى <code dir="ltr">Archive</code>، لضغط ملفات السجل، وبالتالي تقليل إجمالي مساحة القرص التي يشغلونها.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">log_rotation_limit</code> &lt;- <code dir="ltr">general</code></li>
 <li><code dir="ltr">log_rotation_action</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٤ سجل اقتطاع<br /><br /></div>

<div dir="rtl">إذا أردت، يمكنك اقتطاع ملفات السجل الفردية عندما تتجاوز حجمًا معينًا.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">truncate</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٥ عنوان IP PSEUDONYMISATION<br /><br /></div>

<div dir="rtl">أولاً، إذا لم تكن على دراية بهذا المصطلح، "pseudonymisation" يشير إلى معالجة البيانات الشخصية على هذا النحو بحيث لا يمكن تحديدها لأي موضوع بيانات محدد بعد الآن بدون معلومات إضافية، وشريطة أن يتم الاحتفاظ بهذه المعلومات التكميلية بشكل منفصل وتخضع للتدابير التقنية والتنظيمية لضمان عدم إمكانية تحديد البيانات الشخصية لأي شخص طبيعي.<br /><br /></div>

<div dir="rtl">يمكن أن تساعد الموارد التالية في شرحها بمزيد من التفاصيل:</div>
<div dir="rtl"><ul>
 <li><a href="https://www.trust-hub.com/news/what-is-pseudonymisation/">[trust-hub.com] What is pseudonymisation?</a></li>
 <li><a href="https://en.wikipedia.org/wiki/Pseudonymization">[Wikipedia] Pseudonymization]</a></li>
</ul></div>

<div dir="rtl">في بعض الحالات، قد يُطلب منك قانونًا تنفيذ "anonymisation" أو "pseudonymisation" لأي معلومات PII تم جمعها أو معالجتها أو تخزينها. على الرغم من وجود هذا المفهوم منذ بعض الوقت، GDPR/DSGVO يذكر بشكل ملحوظ ويشجع "pseudonymisation".<br /><br /></div>

<div dir="rtl">إذا أردت، يمكن لـ phpMussel القيام بذلك لعناوين IP عند الكتابة إلى السجلات. عند الكتابة إلى السجلات، سيتم تمثيل الثمانية النهائية لعناوين IPv4 وكل شيء بعد الجزء الثاني من عناوين IPv6 بواسطة "x" (تقريب عناوين IPv4 إلى العنوان الأولي للشبكة الفرعية الـ 24 التي تدخلها، وعناوين IPv6 إلى العنوان الأولي للشبكة الفرعية 32 التي تدخلها).<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">pseudonymise_ip_addresses</code> &lt;- <code dir="ltr">legal</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٦ الإحصاء<br /><br /></div>

<div dir="rtl">phpMussel قادر بشكل اختياري على تتبع الإحصائيات مثل العدد الإجمالي للملفات التي تم مسحها وحظرها منذ وقت معين. يتم تعطيل هذه الميزة بشكل افتراضي، ولكن يمكن تمكينها من خلال تهيئة الحزمة. لا يجب اعتبار نوع المعلومات التي يتم تتبعها كمعلومات تحديد الهوية الشخصية.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">statistics</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٧ التشفير<br /><br /></div>

<div dir="rtl">لا يقوم phpMussel بتشفير ذاكرة التخزين المؤقت أو أي معلومات سجل. قد يتم إدخال <a href="https://ar.wikipedia.org/wiki/%D8%AA%D8%B4%D9%81%D9%8A%D8%B1">تشفير</a> ذاكرة التخزين المؤقت والسجلات في المستقبل، ولكن لا توجد خطط محددة لها حاليًا. إذا كنت قلقًا بشأن حصول أطراف ثالثة غير مصرح لها على إمكانية الوصول إلى أجزاء من phpMussel قد تحتوي على معلومات تحديد الهوية الشخصية أو معلومات حساسة مثل ذاكرة التخزين المؤقت أو السجلات، أوصي بعدم تثبيت phpMussel في مكان يمكن الوصول إليه بشكل عام (على سبيل المثال، مجلد تثبيت phpMussel خارج الدليل <code dir="ltr">public_html</code> القياسي أو ما يعادله، متاح لمعظم خوادم الويب القياسية) والتأكد من فرض الأذونات المقيدة بشكل مناسب لدليل التثبيت (على وجه الخصوص، لدليل <code dir="ltr">vault</code>). إذا لم يكن ذلك كافيًا لمعالجة مخاوفك، فقم بتكوين phpMussel بحيث لا يتم جمع أنواع المعلومات التي تسبب مخاوفك أو تسجيلها في المقام الأول (مثل، عن طريق تعطيل التسجيل).<br /><br /></div>

#### <div dir="rtl">١١.٤ ملف تعريف ارتباط<br /><br /></div>

<div dir="rtl">عندما يسجل المستخدم بنجاح في الواجهة الأمامية، يعين phpMussel <a href="https://ar.wikipedia.org/wiki/%D9%85%D9%84%D9%81_%D8%AA%D8%B9%D8%B1%D9%8A%D9%81_%D8%A7%D8%B1%D8%AA%D8%A8%D8%A7%D8%B7">ملف تعريف ارتباط</a> حتى يتمكن من تذكر المستخدم للطلبات اللاحقة (أي، يتم استخدام ملفات تعريف الارتباط لمصادقة المستخدم على جلسة تسجيل الدخول). في صفحة تسجيل الدخول، يتم عرض تحذير ملف تعريف ارتباط بشكل بارز، ويحذر المستخدم من أنه سيتم تعيين ملف تعريف ارتباط إذا شارك في الإجراء ذي الصلة. لا يتم تعيين ملفات تعريف الارتباط في أي نقاط أخرى في مصدر التعليمات البرمجية.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">disable_frontend</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

#### <div dir="rtl">١١.٥ التسويق والإعلان<br /><br /></div>

<div dir="rtl">لا تجمع phpMussel أو تعالج أي معلومات لأغراض التسويق أو الإعلانات، ولا تبيع أو تحقق أرباحًا من أي معلومات تم جمعها أو تسجيلها. phpMussel ليست مؤسسة تجارية، ولا ترتبط بأي مصالح تجارية، لذا فإن القيام بهذه الأشياء لن يكون له أي معنى. كان هذا هو الحال منذ بداية المشروع، وما زالت الحالة اليوم. بالإضافة إلى ذلك، فإن القيام بهذه الأشياء سيؤدي إلى نتائج عكسية للمشروع والغرض المقصود من المشروع ككل، وطالما استمر في الحفاظ على المشروع، لن يحدث أبداً.<br /><br /></div>

#### <div dir="rtl">١١.٦ سياسة الخصوصية<br /><br /></div>

<div dir="rtl">في بعض الحالات، قد يُطلب منك قانونًا عرض رابط لسياسة الخصوصية بوضوح في جميع صفحات وأقسام موقعك. قد يكون هذا أمرًا مهمًا كوسيلة لضمان معرفة المستخدمين جيدًا بممارسات الخصوصية الدقيقة، وأنواع معلومات تحديد الهوية الشخصية التي تجمعها، وكيفية تنوي استخدامها. لتتمكن من تضمين مثل هذا الارتباط في صفحة "رفض تحميل" الخاصة بـ phpMussel، يتم توفير توجيه تكوين لتحديد عنوان URL لسياسة الخصوصية الخاصة بك.<br /><br /></div>

<div dir="rtl">خيارات التكوين ذات الصلة:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">privacy_policy</code> &lt;- <code dir="ltr">legal</code></li>
</ul></div>

#### <div dir="rtl">١١.٧ GDPR/DSGVO<br /><br /></div>

<div dir="rtl">يعد اللائحة العامة لحماية البيانات (GDPR) لائحة خاصة بالاتحاد الأوروبي، والتي تدخل حيز التنفيذ اعتبارًا من 25 مايو 2018. الهدف الأساسي من التنظيم هو إعطاء السيطرة على المواطنين والمقيمين في الاتحاد الأوروبي فيما يتعلق ببياناتهم الشخصية، وتوحيد الأنظمة داخل الاتحاد الأوروبي فيما يتعلق بالخصوصية والبيانات الشخصية.<br /><br /></div>

<div dir="rtl">تحتوي اللائحة على أحكام محددة تتعلق بمعالجة "معلومات التعريف الشخصية" لأي "موضوعات بيانات" تابعة للاتحاد الأوروبي (أي شخص طبيعي محدد أو قابل للتحديد). من أجل الامتثال للأنظمة، "الشركات" (كما هو محدد في اللائحة)، وكذلك أي أنظمة وعمليات ذات صلة، يجب تنفيذ "الخصوصية حسب التصميم" بشكل افتراضي، يجب استخدام أعلى إعدادات الخصوصية الممكنة، يجب تنفيذ الضمانات اللازمة لأية معلومات مخزنة أو معالجتها (بما في ذلك، على سبيل المثال لا الحصر، تنفيذ "pseudonymisation" أو "anonymisation" الكامل للبيانات)، يجب أن يعلن بوضوح وبشكل لا لبس فيه أنواع البيانات التي يجمعونها، كيفية معالجتها، لأي أسباب، إلى متى تحتفظ بها، وإذا شاركوا هذه البيانات مع أطراف ثالثة، وأنواع البيانات المشتركة مع أطراف ثالثة، وكيف، ولماذا، وما إلى ذلك.<br /><br /></div>

<div dir="rtl">لا يجوز معالجة البيانات ما لم يكن هناك أساس قانوني للقيام بذلك، كما هو محدد في اللائحة. وبشكل عام، يعني هذا أنه من أجل معالجة بيانات موضوع البيانات على أساس قانوني، يجب أن يتم ذلك وفقًا لالتزامات قانونية، أو يتم فقط بعد الحصول على موافقة واضحة ومطلعة بشكل لا لبس فيه من موضوع البيانات.<br /><br /></div>

<div dir="rtl">قد تتطور جوانب التنظيم في الوقت المناسب، ومن أجل تجنب نشر المعلومات القديمة، قد يكون من الأفضل معرفة التنظيم من مصدر موثوق، بدلاً من مجرد تضمين المعلومات ذات الصلة هنا في وثائق الحزمة (مثل المعلومات المضمنة قد تصبح في نهاية المطاف عفا عليها الزمن مع تطور التنظيم).<br /><br /></div>

<div dir="rtl">بعض الموارد الموصى بها لتعلم المزيد من المعلومات:<br /></div>
<div dir="rtl"><ul>
 <li><a href="https://ar.wikipedia.org/wiki/%D8%A7%D9%84%D9%86%D8%B8%D8%A7%D9%85_%D8%A7%D9%84%D8%A3%D9%88%D8%B1%D9%88%D8%A8%D9%8A_%D9%84%D8%AD%D9%85%D8%A7%D9%8A%D8%A9_%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA_%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%A9">النظام الأوروبي لحماية البيانات العامة</a></li>
 <li><a href="https://taqnia24.com/2018/05/24/%D8%AA%D8%B9%D8%B1%D9%81-%D8%B9%D9%84%D9%89-%D9%82%D8%A7%D9%86%D9%88%D9%86-%D8%AD%D9%85%D8%A7%D9%8A%D8%A9-%D8%AE%D8%B5%D9%88%D8%B5%D9%8A%D8%A9-%D8%A7%D9%84%D8%A8%D9%8A%D8%A7%D9%86%D8%A7%D8%AA-gdpr/">تعرف على قانون حماية خصوصية البيانات GDPR</a></li>
 <li><a href="https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679">REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL</a></li>
</ul></div>

---


<div dir="rtl">آخر تحديث: 9 اكتوبر 2018 (2018.10.09).</div>
