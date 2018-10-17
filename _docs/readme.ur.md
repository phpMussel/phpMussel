## <div dir="rtl">phpMussel لئے دستاویزی (اردو).</div>

### <div dir="rtl">فہرست:</div>
<div dir="rtl"><ul>
 <li>١. <a href="#SECTION1">تمہید</a></li>
 <li>٢. <a href="#SECTION2">انسٹال کرنے کا طریقہ</a></li>
 <li>٣. <a href="#SECTION3">کس طرح استعمال</a></li>
 <li>٤. <a href="#SECTION4">سامنے کے آخر میں انتظام</a></li>
 <li>٥. <a href="#SECTION5">CLI (کمانڈ لائن انٹرفیس)</a></li>
 <li>٦. <a href="#SECTION6">فائل اس پیکیج میں شامل</a></li>
 <li>٧. <a href="#SECTION7">ترتیب کے اختیارات</a></li>
 <li>٨. <a href="#SECTION8">دستخط فارمیٹ</a></li>
 <li>٩. <a href="#SECTION9">جانا جاتا مطابقت کے مسائل</a></li>
 <li>١٠. <a href="#SECTION10">اکثر پوچھے گئے سوالات (FAQ)</a></li>
 <li>١١. <a href="#SECTION11">قانونی معلومات</a></li>
</ul></div>

<div dir="rtl"><em>ترجمہ سلسلے نوٹ: کی غلطیوں کی صورت میں (جیسے، ترجمہ، typos کے، وغیرہ کے درمیان تضادات)، مجھے پڑھ کے انگریزی ورژن اصل اور مستند ورژن سمجھا جاتا ہے. آپ کو کسی بھی کی غلطیوں کو تلاش کریں تو ان کو ٹھیک کرنے میں آپ کی مدد کا خیر مقدم کیا جائے گا.</em></div>

---


### <div dir="rtl">١. <a name="SECTION1"></a>تمہید</div>

<div dir="rtl">phpMussel، ایک PHP کی سکرپٹ کو جہاں کہیں سکرپٹ جھکا ہے، ClamAV اور دوسروں کے دستخط کی بنیاد پر آپ کے سسٹم پر اپ لوڈ کی فائلوں کے اندر اندر ٹروجن، وائرس، میلویئر اور دیگر خطرات کا پتہ لگانے کے لئے ڈیزائن کیا استعمال کرنے کے لئے آپ کا شکریہ.<br /><br /></div>

<div dir="rtl">PHPMUSSEL کاپی رائٹ 2013 اور Caleb M (Maikuolan) کی طرف GNU/GPLv2 اجازت سے آگے.<br /><br /></div>

<div dir="rtl">یہ سکرپٹ مفت سافٹ ویئر ہے. آپ اسے دوبارہ تقسیم اور/یا کے طور پر مفت سافٹ ویئر فاؤنڈیشن کی جانب سے شائع GNU جنرل پبلک لائسنس کی شرائط کے تحت اس پر نظر ثانی کر سکتے ہیں؛ یا تو لائسنس کے ورژن 2، یا (آپ کے اختیارات پر) کسی بھی جدید ورژن. یہ سکرپٹ یہ مفید ہو جائے گا، لیکن کسی بھی وارنٹی کے بغیر امید میں تقسیم کیا جاتا ہے؛ کسی خاص مقصد کے لئے قابل فروختگی یا فٹنس کی بھی تقاضا وارنٹی کے بغیر. مزید تفصیلات کے لئے GNU جنرل پبلک لائسنس، "LICENSE.txt" فائل اور سے بھی دستیاب میں واقع دیکھیں:</div>
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

<div dir="rtl">کرنے کے لئے خصوصی شکریہ ادا کیا. <a href="http://www.clamav.net/">ClamAV</a> دونوں منصوبے پریرتا کے لئے اور اس سکرپٹ کا استعمال ہے کہ دستخط، اسکرپٹ کا امکان موجود نہیں کریں گے، جس کے بغیر، یا سب کے لئے، بہت محدود قدر ہو گی.<br /><br /></div>

SourceForge اور GitHub کے لئے خصوصی شکریہ، اور اضافی ذرائع کے phpMussel طرف سے استعمال کیا دستخطوں کی ایک بڑی تعداد کی: <a href="http://www.securiteinfo.com/">SecuriteInfo.com</a>، <a href="http://www.phishtank.com/">PhishTank</a>، <a href="http://nlnetlabs.nl/">NLNetLabs</a> اور دوسروں کو، اور یہ کہ میں نے ذکر کرنا وگرنہ بھول گئے ہیں، اور اسکرپٹ استعمال کرنے کے لئے، کسی اور کو اس منصوبے کی حمایت تمام والوں کے لئے خصوصی شکریہ.<br /><br /></div>

<div dir="rtl">یہ دستاویز اور اس کے متعلقہ پیکجوں کے لئے مفت سے ڈاؤن لوڈ کیا جا سکتا ہے:</div>

- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### <div dir="rtl">٢. <a name="SECTION2"></a>انسٹال کرنے کا طریقہ</div>

#### <div dir="rtl">٢.٠ دستی طور پر نصب</div>

<div dir="rtl">١. آپ کے پڑھنے کی طرف سے اس، مجھے سنبھالنے رہا ہوں آپ کے پاس پہلے، اسکرپٹ کا ایک آرکائیو کاپی کو ڈاؤن لوڈ کیا اس کے مشمولات کو پھیلا اور اس کو اپنے مقامی مشین پر کہیں بیٹھے ہیں کیا ہے. یہاں سے، آپ جہاں آپ کا میزبان یا CMS پر آپ ان کے مندرجات رکھنے کے لئے چاہتے ہیں باہر کام کرنے چاہیں گے. جیسے <code dir="ltr">"/public_html/phpmussel/"</code> یا اسی طرح کی (اگرچہ، یہ جو آپ کو اسے محفوظ ہے کچھ اور کچھ اور آپ کے ساتھ خوش ہیں ہے اتنی دیر کے طور پر انتخاب کرتے ہیں، کوئی فرق نہیں پڑتا) ایک ڈائریکٹری کافی ہوگا. <em>آپ کو اپ لوڈ کرنے شروع کرنے سے پہلے، پر پڑھیں ..</em><br /><br /></div>

<div dir="rtl">٢. <code dir="ltr">"config.ini"</code> (اندر "vault" واقع کرنے <code dir="ltr">"config.ini.RenameMe"</code> نام تبدیل)، اور اختیاری پختہ اعلی درجے کی صارفین کے لئے سفارش کی جاتی ہے، لیکن (اس فائل پر مشتمل ابتدائی کے لئے یا ناتجربہ کار)، اسے کھولنے کے لئے سفارش کی نہیں phpMussel لئے دستیاب تمام ہدایات؛ ہر آپشن کے اوپر ایک مختصر تبصرہ یہ کیا کرتا بیان اور کیا اس کے لئے ہے) ہونا چاہئے. آپ کو فٹ دیکھ کے طور جو بھی اپنے مخصوص سیٹ اپ کے لئے مناسب ہے کے مطابق ان ہدایات کو ایڈجسٹ کریں. فائل محفوظ کریں، قریب ہے.<br /><br /></div>

<div dir="rtl">٣. (اگر آپ پہلے پر فیصلہ کیا تھا ڈائریکٹری میں مندرجات (phpMussel اور اس کی فائلوں) کو اپ لوڈ کریں آپ "<code dir="ltr">*.txt/*.md</code>" فائلوں کو شامل کرنے کی ضرورت نہیں ہے، لیکن زیادہ تر، تم سب کچھ اپ لوڈ کرنا چاہئے) .<br /><br /></div>

<div dir="rtl">٤. CHMOD "755" (مسائل ہیں تو، آپ کو کوشش "vault" ڈائریکٹری میں کر سکتے ہیں "777"؛ اس سے کم محفوظ ہے، اگرچہ). مندرجات (آپ اس سے قبل انتخاب کیا ایک) ذخیرہ کرنے کے اہم ڈائریکٹری، عام طور پر، آپ کو آپ کے سسٹم پر ماضی میں اجازتیں مسائل پڑا ہے تو اکیلے چھوڑ دیا جا سکتا ہے، لیکن CHMOD کی حیثیت کی جانچ پڑتال کی جانی چاہئے (ڈیفالٹ کی طرف سے، جیسے "755" کچھ ہونا چاہئے). مختصرا: پیکج کے لئے مناسب طریقے سے کام کرنے کے لئے، پی ایچ او کو <code dir="ltr">vault</code> ڈائریکٹری کے اندر فائلوں کو پڑھنے اور لکھنے کے قابل ہونے کی ضرورت ہے. اگر بہت سے چیزیں (اپ ڈیٹنگ، لاگنگ، وغیرہ) ممکن نہیں ہوسکتے، اگر پی ایچ پی <code dir="ltr">vault</code> ڈائریکٹری میں نہیں لکھا جاسکتا ہے، اور پیکج بالکل کام نہیں کرے گا تو پی ایچ پی <code dir="ltr">vault</code> ڈائرکٹری سے پڑھ نہیں سکتا. تاہم، زیادہ سے زیادہ سیکورٹی کے لئے، <code dir="ltr">vault</code> ڈائرکٹری عوامی طور پر قابل رسائی نہیں ہونا ضروری ہے (<code dir="ltr">vault</code> ڈائرکٹری عوامی طور پر قابل رسائی ہے تو حملہ آوروں کے بارے میں سنجیدگی سے متعلق معلومات سامنے آسکتی ہیں).<br /><br /></div>

<div dir="rtl">٥. کسی بھی دستخط کو انسٹال کریں جو آپ کی ضرورت ہو گی. <em>دیکھیں: <a href="#INSTALLING_SIGNATURES">تنصیب کا دستخط</a>).</em><br /><br /></div>

<div dir="rtl">٦. اگلا، آپ کو "ہک" آپ کے سسٹم یا CMS کرنے phpMussel کرنا ہوگا. کئی مختلف طریقے ہیں آپ کر سکتے ہیں جیسا کہ آپ کے سسٹم یا CMS، لیکن سب سے آسان ہے صرف عام طور پر ہمیشہ سے لوڈ کیا جائے گا کہ آپ کے سسٹم یا CMS (ایک کی ایک بنیادی فائل کے شروع میں سکرپٹ کو شامل کرنے کے لئے کرنا phpMussel "ہک" اسکرپٹس اگر کوئی ویب سائٹ بھر میں کسی بھی صفحے تک رسائی حاصل کرتا ہے جب) ایک "require" یا "include" بیان کا استعمال کرتے ہوئے. عام طور پر، اس طرح کے طور پر "/includes"، "/assets" یا "/functions" ایک ڈائریکٹری میں محفوظ کیا کچھ ہو جائے گا، اور اکثر" init.php"، "common_functions.php"،" افعال کی طرح کچھ نام دیا جائے گا. php" یا اسی طرح کی. تم جس فائل اگر یہ آپ کی صورت حال کے لئے ہے باہر کام کرنا پڑے گا؛ تم اپنے لئے اس سے باہر کام کرنے میں مشکلات کا سامنا کرتے ہیں، GitHub کے پر phpMussel مسائل کا صفحہ ملاحظہ کریں. [ "require" یا" استعمال کرنے کے لئے include"] ایسا کرنے کے لئے، جو کہ بنیادی فائل کے شروع کرنے کے لئے کوڈ کی مندرجہ ذیل لائن داخل، "loader.php" فائل کا عین مطابق ایڈریس کے ساتھ واوین کے اندر موجود سٹرنگ کی جگہ (مقامی پتہ، نہ HTTP ایڈریس؛ یہ پہلے ذکر والٹ ایڈریس کو اسی طرح دیکھ لیں گے).<br /><br /></div>

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

<div dir="rtl">فائل، قریب، ہٹادیا بچائیں.<br /><br /></div>

<div dir="rtl">-- یا متبادل --<br /><br /></div>

<div dir="rtl">آپ ایک اپاچی ویب سرور استعمال کر رہے ہیں اور آپ کو "php.ini" تک رسائی ہے تو، تو آپ جب بھی کسی بھی PHP کی درخواست کی جاتی ہے phpMussel prepend کے کو "auto_prepend_file" ہدایت کو استعمال کر سکتے ہیں. کی طرح کچھ:<br /><br /></div>

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

<div dir="rtl">یا ".htaccess" فائل میں اس:<br /><br /></div>

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

<div dir="rtl">٧. اس وقت تم نے کیا کر رہے ہیں! تاہم، آپ کو شاید اسے باہر یہ مناسب طریقے سے کام کر رہا ہے بات کو یقینی بنانے کے لئے جانچ کرنا چاہئے. فائل اپ لوڈ کی حفاظت کے باہر کی جانچ کرنے کے لئے، ٹیسٹنگ کی فائلوں کو اپ لوڈ کرنا شامل پیکیج میں آپ کی ویب سائٹ کو "_testfiles" کے تحت اپنے معمول کے براؤزر کی بنیاد پر اپ لوڈ طریقوں کے ذریعے کوشش. سب کچھ کام کر رہی ہے تو، ایک پیغام کی تصدیق ہے کہ اپ لوڈ کریں کامیابی سے بلاک کیا گیا تھا phpMussel سے ظاہر ہونا چاہیے. کچھ بھی ظاہر ہوتا ہے، کسی چیز کے صحیح طریقے سے کام نہیں کر رہا ہے. آپ کو کسی بھی جدید ترین خصوصیات کا استعمال کر رہے ہیں یا آپ کے آلے کے ساتھ ممکن سکیننگ کے دیگر اقسام کا استعمال کرتے ہوئے کر رہے ہیں تو، تو میں نے اسے باہر والوں کے ساتھ جو بھی کام کرتا ہے کے طور پر توقع اس بات کو یقینی بنانے کی کوشش کر مشورہ تھا.<br /><br /></div>

#### <div dir="rtl">٢.١ دستی طور پر نصب (CLI کے لئے)</div>

<div dir="rtl">١. آپ کے پڑھنے کی طرف سے اس، مجھے سنبھالنے رہا ہوں آپ کے پاس پہلے، اسکرپٹ کا ایک آرکائیو کاپی کو ڈاؤن لوڈ کیا اس کے مشمولات کو پھیلا اور اس کو اپنے مقامی مشین پر کہیں بیٹھے ہیں کیا ہے. کیا آپ نے منتخب کیا ہے مقام کے ساتھ خوش ہیں، جاری رکھیں.<br /><br /></div>

<div dir="rtl">٢. PHP کی کام کرنے کے لئے ترتیب میں phpMussel طرف مطلوب ہے. اگر آپ نے پہلے نہیں کیا ہے، اسے انسٹال کریں.<br /><br /></div>

<div dir="rtl">٣. <code dir="ltr">"config.ini"</code> (اندر "vault" واقع کرنے <code dir="ltr">"config.ini.RenameMe"</code> نام تبدیل)، اور اختیاری پختہ اعلی درجے کی صارفین کے لئے سفارش کی جاتی ہے، لیکن (اس فائل پر مشتمل ابتدائی کے لئے یا ناتجربہ کار)، اسے کھولنے کے لئے سفارش کی نہیں phpMussel لئے دستیاب تمام ہدایات؛ ہر آپشن کے اوپر ایک مختصر تبصرہ یہ کیا کرتا بیان اور کیا اس کے لئے ہے) ہونا چاہئے. آپ کو فٹ دیکھ کے طور جو بھی اپنے مخصوص سیٹ اپ کے لئے مناسب ہے کے مطابق ان ہدایات کو ایڈجسٹ کریں. فائل محفوظ کریں، قریب ہے.<br /><br /></div>

<div dir="rtl">٤. "BAT" فائلوں کو آپ کے لئے اسے آسان بنانے کے کر سکتے ہیں. اس سے آپ کو کوشش کر سکتے ہیں کچھ ہے.<br /><br /></div>

<div dir="rtl">٥. کسی بھی دستخط کو انسٹال کریں جو آپ کی ضرورت ہو گی. <em>دیکھیں: <a href="#INSTALLING_SIGNATURES">تنصیب کا دستخط</a>).</em><br /><br /></div>

<div dir="rtl">٦. اس وقت تم نے کیا کر رہے ہیں! تاہم، آپ کو شاید اسے باہر یہ مناسب طریقے سے کام کر رہا ہے بات کو یقینی بنانے کے لئے جانچ کرنا چاہئے. phpMussel کو ٹیسٹ کرنے کے لئے، phpMussel چلانے اور سکیننگ پیکج کے ساتھ فراہم کی "_testfiles" ڈائریکٹری کوشش کریں.<br /><br /></div>

#### <div dir="rtl">٢.٢ COMPOSER کے ساتھ نصب</div>

<div dir="rtl"><a href="https://packagist.org/packages/phpmussel/phpmussel">phpMussel Packagist ساتھ رجسٹرڈ ہے</a>، اور اسی طرح، آپ کمپوزر سے واقف ہیں تو، آپ (phpMussel انسٹال کرنے کے کمپوزر استعمال کر سکتے ہیں اگر آپ اب بھی تیار کرنے کے لئے کی ضرورت ہو گی ترتیب اور ہکس اگرچہ؛ "دستی طور پر نصب کرنے" دیکھیں اقدامات ٢ اور ٦).<br /><br /></div>

`composer require phpmussel/phpmussel`

#### <div dir="rtl"><a name="INSTALLING_SIGNATURES"></a>٢.٣ تنصیب کا دستخط</div>

<div dir="rtl">چونکہ v1.0.0، دستخط اہم پیکج میں شامل نہیں ہیں. خاص خطرات کا پتہ لگانے کے لئے phpMussel کے دستخط کی ضرورت ہوتی ہے. دستخط کو انسٹال کرنے کے لئے 3 اہم طریقوں ہیں:<br /><br /></div>

<div dir="rtl"><ul>
 <li>١. خود کار طریقے سے سامنے کے آخر میں اپ ڈیٹس کا صفحہ استعمال کرتے ہوئے انسٹال کریں.</li>
 <li>٢. "SigTool" کا استعمال کرتے ہوئے دستخط پیدا کریں اور دستی طور پر انسٹال کریں.</li>
 <li>٣. <code dir="ltr">"phpMussel/Signatures"</code> سے دستخط ڈاؤن لوڈ کریں اور دستی طور پر انسٹال کریں.</li>
</ul></div>

##### <div dir="rtl">٢.٣.١ خود کار طریقے سے سامنے کے آخر میں اپ ڈیٹس کا صفحہ استعمال کرتے ہوئے انسٹال کریں.</div>

<div dir="rtl">سب سے پہلے، آپ کو اس بات کا یقین کرنے کی ضرورت ہوگی کہ سامنے کے آخر میں فعال ہو. دیکھیں: <a href="#SECTION4">سامنے کے آخر میں انتظام</a>.<br /><br /></div>

<div dir="rtl">پھر، آپ کو اپ ڈیٹس صفحے پر جانے کی ضرورت ہوگی، لازمی دستخط شدہ فائلوں کو تلاش کریں، اور صفحے پر فراہم کی جانے والے اختیارات کا استعمال کرتے ہوئے، انہیں انسٹال کریں، اور ان کو چالو کریں.<br /><br /></div>

##### <div dir="rtl">٢.٣.٢ "SigTool" کا استعمال کرتے ہوئے دستخط پیدا کریں اور دستی طور پر انسٹال کریں.</div>

<div dir="rtl">دیکھیں: <a href="https://github.com/phpMussel/SigTool#documentation">SigTool دستاویزات</a>.<br /><br /></div>

##### <div dir="rtl">٢.٣.٣ <code dir="ltr">"phpMussel/Signatures"</code> سے دستخط ڈاؤن لوڈ کریں اور دستی طور پر انسٹال کریں.</div>

<div dir="rtl">سب سے پہلے، <a href="https://github.com/phpMussel/Signatures" dir="ltr">phpMussel/Signatures</a> پر جائیں. ذخیرہ پر مشتمل مختلف GZ کمپریسڈ دستخط فائلیں. آپ کی ضرورت فائلوں کو ڈاؤن لوڈ کریں، ان کو ڈسپوز کریں، اور ڈسپلے شدہ فائلوں کو <code dir="ltr">/vault/signatures</code> ڈائریکٹری میں ان کو نصب کرنے کیلئے کاپی کریں. کاپی شدہ فائلوں کے ناموں کو ان کی چالو کرنے کے لئے آپ کے phpMussel ترتیب میں <code dir="ltr">Active</code> ڈائریکٹری میں درج کریں.<br /><br /></div>

---


### <div dir="rtl">٣. <a name="SECTION3"></a>کس طرح استعمال</div>

#### <div dir="rtl">٣.٠ (ویب سرورز کے لئے) استعمال کرنے کا طریقہ</div>

<div dir="rtl">phpMussel آپ کے حصہ پر کم سے کم ضروریات کے ساتھ درست طریقے سے کام کرنے کے قابل ہونا چاہئے: یہ انسٹال کرنے کے بعد، یہ فوری طور پر کام کرتے ہیں اور فوری طور پر قابل استعمال ہونا چاہئے.<br /><br /></div>

<div dir="rtl">فائل اپ لوڈ کی سکیننگ خود کار ہے اور فطری طور پر قابل ہے، تو کچھ بھی نہیں اس مخصوص فعالیت کے لئے آپ کی طرف سے کی ضرورت ہے.<br /><br /></div>

<div dir="rtl">تاہم، آپ کو بھی مخصوص فائلوں، ڈائریکٹریز اور/یا ابلیھاگار اسکین کرنے phpMussel ہدایت کرنے کے قابل ہو. ایسا کرنے کے لئے، سب سے پہلے، آپ کو مناسب ترتیب (<code dir="ltr">cleanup</code> غیر فعال کر دیا جائے ضروری ہے) <code dir="ltr">config.ini</code> فائل میں مقرر کیا گیا ہے، اور کیا جب phpMussel کو جھکا دیا گیا ہے کہ ایک PHP کی فائل میں، استعمال یقینی بنانے کے لئے کی ضرورت ہو گی مندرجہ ذیل آپ کے کوڈ میں بندش.<br /><br /></div>

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

<div dir="rtl"><ul>
 <li><code dir="ltr">$what_to_scan</code> ایک سٹرنگ، ایک صف، یا arrays کے ایک صف ہو، اور فائل، فائلوں، ڈائریکٹری اور/یا ڈائریکٹریز کو اسکین کرنے کے لئے جس کی طرف اشارہ کر سکتے ہیں.</li>
 <li><code dir="ltr">$output_type</code> طور واپس کرنے کے اسکین کے نتائج کے لئے کی شکل کا اشارہ، ایک بولین ہے. جھوٹی ایک عدد صحیح (کے -4 اشارہ کرتا ہے کہ ڈیٹا کو خفیہ کاری کی وجہ سے سکینڈ نہیں کیا جا سکتا، -3 اشارہ کرتا ہے کہ دستخط فائلوں کے ساتھ مسائل کا سامنا کرنا پڑا، -2 کی طرف اشارہ کرتا ہے کہ بدعنوان ڈیٹا دوران پتہ چلا تھا اسکین اور اس طرح اسکین مکمل کرنے میں ناکام رہے، -1 طرف اشارہ کرتا ہے کہ ملانے یا addons کے اسکین پر عمل کرنے PHP طرف سے کی ضرورت لاپتہ تھے اور اس طرح اسکین، کو مکمل کرنے میں ناکام رہے 0 اشارہ کرتا اسکین ہدف موجود نہیں ہے کہ اس طرح اور اسکین کرنے کی کوئی بات نہیں تھی 1 ہدف کو کامیابی سے سکین کر رہا تھا اور کوئی مسائل کا پتہ چلا رہے تھے کہ اشارہ کرتا ہے، اور 2 کی طرف اشارہ ہدف کو کامیابی سے سکین کر رہا تھا کہ اور مسائل کا پتہ چلا رہے تھے). یہ سچ ہے کہ انسانی قابل مطالعہ متن کے طور پر نتائج واپس کرنے کے لئے تقریب کی ہدایات. اس کے علاوہ، دونوں صورتوں میں، نتائج عالمی متغیر کے ذریعے جانے کے بعد سکیننگ مکمل کر لیا ہے حاصل کیا جا سکتا ہے. یہ متغیر غلط پر مجرم، اختیاری ہے.</li>
 <li><code dir="ltr">$output_flatness</code> تقریب کرنے کا اشارہ ایک صف یا ایک تار کے طور پر سکیننگ کے نتائج (ایک سے زیادہ اسکین اہداف ہیں جب) واپس کرنے کے لئے، چاہے ایک بولین ہے. جھوٹی ایک صف کے طور پر نتائج واپس کرے گا. یہ سچ ہے کہ ایک تار کے طور پر نتائج واپس کرے گا. یہ متغیر غلط پر مجرم، اختیاری ہے.</li>
</ul></div>

<div dir="rtl">مثالیں:<br /><br /></div>

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

<div dir="rtl">کچھ اس طرح (ایک تار کے طور پر) واپسی:<br /><br /></div>

```
 Wed, 16 Sep 2013 02:49:46 +0000 Started.
 > Checking '/user_name/public_html/my_file.html':
 -> No problems found.
 Wed, 16 Sep 2013 02:49:47 +0000 Finished.
```

<div dir="rtl">دستخط کس قسم کی ایک مکمل بریک ڈاون کے phpMussel اس کے علیحدہ اسکین کے دوران استعمال کرتا ہے اور یہ ان کے دستخط کو کس طرح ہینڈل، اس README فائل کا <a href="#SECTION8">دستخط فارمیٹ</a> سیکشن سے رجوع کریں.<br /><br /></div>

<div dir="rtl">آپ کو کسی بھی جھوٹے مثبت سامنا کرتے ہیں، آپ کو کچھ نیا آپ کو لگتا ہے کہ کا سامنا ہے تو بلاک کر دیا جائے چاہئے، یا کچھ اور دستخط کے بارے میں کے طور پر، اس کے بارے میں مجھ سے رابطہ کریں تا کہ میں ضروری تبدیلیاں کر سکتے ہیں، آپ مجھ سے، مجھے سے رابطہ نہیں کرتے تو لازمی طور سے آگاہ نہیں ہو سکتا. <em>(دیکھیں: <a href="#WHAT_IS_A_FALSE_POSITIVE">ایک "جھوٹی مثبت" سے کیا مراد ہے؟</a>).</em><br /><br /></div>

<div dir="rtl">phpMussel ساتھ شامل دستخطوں کو غیر فعال کرنے کے لئے (جیسا کہ آپ کو آپ کے مقاصد عموما مین لائن سے ہٹایا نہیں کیا جانا چاہئے کہ ایک جھوٹی مثبت مخصوص سامنا کر رہے ہیں کے طور پر اگر)، سرمئی لسٹ کے دستخط کے ناموں کو شامل کریں (<code dir="ltr">/vault/greylist.csv</code>)، کاموں کی طرف سے الگ.<br /><br /></div>

<div dir="rtl">بھی دیکھو: <a href="#SCAN_DEBUGGING">کس طرح وہ سکین کر رہے ہیں جب فائلوں کے بارے میں مزید تفصیلات تک رسائی حاصل کرنے کے لئے؟</a><br /><br /></div>

#### <div dir="rtl">٣.١ (CLI کے لئے) استعمال کرنے کا طریقہ</div>

<div dir="rtl">"دستی طور پر نصب (CLI کے لئے)" اس README فائل کا سیکشن سے رجوع کریں.<br /><br /></div>

<div dir="rtl">اس کے علاوہ اس بات سے آگاہ phpMussel ایک <em>ڈیمانڈ</em> سکینر ہے کہ ہو؛ یہ ہے <strong>نہیں</strong> ایک <em>پر رسائی</em> سکینر (اپ لوڈ کے وقت، فائل اپ لوڈ ماسوائے) اور روایتی اینٹی وائرس سوئٹ کے برعکس، فعال میموری کی نگرانی نہیں کرتا! یہ صرف فائل اپ لوڈ کی طرف سے موجود وائرس کا پتہ لگانے، اور ان لوگوں کے مخصوص فائلوں کو آپ کو واضح طور پر اسکین پر یہ بتانے کے کہ کر لیں گے.<br /><br /></div>

---


### <div dir="rtl">٤. <a name="SECTION4"></a>سامنے کے آخر میں انتظام</div>

#### <div dir="rtl">٤.٠ سامنے کے آخر کیا ہے.<br /><br /></div>

<div dir="rtl">سامنے کے آخر میں، برقرار رکھنے کا انتظام، اور آپ phpMussel تنصیب کو اپ ڈیٹ کرنے کے لئے ایک آسان اور آسان طریقہ فراہم کرتا ہے. آپ صرف مسودہ دیکھ سکتے ہیں، اشتراک، اور نوشتہ صفحے کے ذریعے لاگ مسلیں لوڈ، آپ کی ترتیب کے صفحے کے ذریعے کی ترتیب تبدیل کر سکتے ہیں، آپ کو انسٹال کر سکتے ہیں اور اپ ڈیٹس صفحے کے ذریعے انسٹال اجزاء، اور آپ کو اپ لوڈ کر سکتے ہیں، ڈاؤن لوڈ، اتارنا، اور فائل کے ذریعے آپ کے والٹ میں فائلوں پر نظر ثانی مینیجر.<br /><br /></div>

<div dir="rtl">سامنے کے آخر میں (آپ کی ویب سائٹ اور اس کی سیکیورٹی کے لئے اہم نتائج ہو سکتے ہیں غیر مجاز رسائی) غیر مجاز رسائی کو روکنے کے لئے پہلے سے طے شدہ کی طرف سے غیر فعال ہے. اس کو چالو کرنے کے لئے ہدایات اس پیراگراف ذیل میں شامل ہیں.<br /><br /></div>

#### <div dir="rtl">٤.١ سامنے کے آخر میں فعال کرنے کا طریقہ.<br /><br /></div>

<div dir="rtl">١. اندر <code dir="ltr">"config.ini"</code>، <code dir="ltr">"disable_frontend"</code> ہدایت کو تلاش کریں اور "false" کرنے کے لئے مقرر (یہ ڈیفالٹ کی طرف سے "true" ہو جائے گا).<br /><br /></div>

<div dir="rtl">٢. رسائی اپنے براؤزر سے <code dir="ltr">"loader.php"</code> (جیسے، <code dir="ltr">"http://localhost/phpmussel/loader.php"</code>).<br /><br /></div>

<div dir="rtl">٣. پہلے سے طے شدہ صارف کا نام اور پاس ورڈ کے ساتھ لاگ ان کریں (admin/password).<br /><br /></div>

<div dir="rtl">نوٹ: اگر آپ کو پہلی بار کے لئے لاگ ان کرنے کے بعد، سامنے کے آخر تک غیر مجاز رسائی کو روکنے کے لئے، آپ کو فوری طور پر آپ کا صارف نام اور پاس ورڈ کو تبدیل کرنا چاہئے! یہ بہت اہم ہے، یہ سامنے کے آخر میں کے ذریعے آپ کی ویب سائٹ پر من مانی PHP کوڈ کو اپ لوڈ کرنا ممکن ہے کیونکہ.<br /><br /></div>

<div dir="rtl">اس کے علاوہ، زیادہ سے زیادہ سیکورٹی کے لئے، تمام فرنٹ اینڈ اکاؤنٹس کے لئے 2FA کو مؤثر طریقے سے سفارش کی جاتی ہے (ذیل میں دی گئی ہدایات).<br /><br /></div>

#### <div dir="rtl">٤.٢ سامنے کے آخر میں کس طرح استعمال.<br /><br /></div>

<div dir="rtl">ہدایات یہ اور اس مقصد کو استعمال کرنے کا صحیح طریقہ کی وضاحت کے لئے سامنے کے آخر میں کے ہر صفحے پر فراہم کی جاتی ہیں. اگر آپ کو مزید وضاحت یا کوئی خاص مدد کی ضرورت ہے، کی مدد سے رابطہ کریں. متبادل طور پر، یو ٹیوب پر دستیاب کچھ ویڈیوز مظاہرے کی راہ کی طرف مدد کر سکتا ہے جس میں موجود ہیں.<br /><br /></div>

#### <div dir="rtl">٤.٣ 2FA<br /><br /></div>

<div dir="rtl">2FA کو چالو کرنے کے ذریعہ front-end کو مزید محفوظ بنانے کے لئے ممکن ہے. جب 2FA کے ساتھ اکاؤنٹ میں لاگ ان ہو تو، اس اکاؤنٹ سے منسلک ای میل ایڈریس پر ایک ای میل بھیجا جاتا ہے. اس ای میل میں "2FA کوڈ" شامل ہے، جو اس صارف کا استعمال کرتے ہوئے لاگ ان کرنے کے لۓ صارف کا نام اور پاسورڈ کے علاوہ صارف کو داخل ہونا ضروری ہے. اس کا مطلب یہ ہے کہ اکاؤنٹ اکاؤنٹ پاس ورڈ حاصل کرنے کے لئے کسی بھی ہیکر یا ممکنہ حملہ آور کو اس اکاؤنٹ میں لاگ ان کرنے کے قابل نہیں ہو گا، کیونکہ انہیں وصول کرنے کے قابل ہونے کے لئے ان اکاؤنٹ سے منسلک ای میل ایڈریس تک رسائی حاصل ہوگی. اور سیشن کے ساتھ منسلک 2FA کوڈ استعمال کریں.<br /><br /></div>

<div dir="rtl">سب سے پہلے، 2FA کو چالو کرنے کے لئے، PHPMailer اجزاء کو انسٹال کرنے کے لئے front-end اپ ڈیٹس کا صفحہ استعمال کریں. ای میل بھیجنے کے لئے phpMussel PHPMailer کا استعمال کرتا ہے. نوٹ: اگرچہ phpMussel، خود ہی، <code dir="ltr">PHP &gt;= 5.4.0</code> کے ساتھ مطابقت رکھتا ہے، PHPMailer کی ضرورت ہے <code dir="ltr">PHP &gt;= 5.5.0</code>. اس کا مطلب ہے کہ <code dir="ltr">PHP 5.4</code> صارفوں کیلئے phpMussel front-end 2FA کو چالو کرنا ممکن نہیں ہوگا.<br /><br /></div>

<div dir="rtl">PHPMailer نصب کرنے کے بعد، آپ کو phpMussel ترتیب کے صفحے یا ترتیب کی فائل کے ذریعے PHPMailer کے لئے ترتیب ہدایات کو آباد کرنے کی ضرورت ہوگی. ان ترتیبات کے ہدایات کے بارے میں مزید معلومات اس دستاویز کے ترتیب کے حصے میں شامل ہیں. PHPMailer ترتیب ہدایات آبادی کے بعد، <code dir="ltr">Enable2FA</code> <code dir="ltr">true</code> سیٹ کریں. 2FA اب فعال ہونا چاہئے.<br /><br /></div>

<div dir="rtl">اگلا، آپ کو ایک ای میل ایڈریس کو اکاؤنٹ کے ساتھ منسلک کرنے کی ضرورت ہوگی، تاکہ phpMussel کو معلوم ہے کہ اس اکاؤنٹ کے ساتھ لاگ ان کرتے وقت 2FA کوڈ بھیجنے کے لئے. ایسا کرنے کے لئے، اکاؤنٹ کے صارف نام کے طور پر ای میل پتہ استعمال کریں (کچھ <code dir="ltr">foo@bar.tld</code> کی طرح)، یا اس صارف کے صارف کے حصے کے طور پر ای میل ایڈریس بھی شامل ہے جس طرح آپ عام طور پر ای میل بھیجیں گے (کچھ <code dir="ltr">Foo Bar &lt;foo@bar.tld&gt;</code> کی طرح).<br /><br /></div>

<div dir="rtl">نوٹ: غیر مجاز رسائی کے خلاف vault کی حفاظت خاص طور پر اہم ہے (مثال کے طور پر، آپ کے سرور کی سیکیورٹی کو مضبوط کرنا، عوامی رسائی کی اجازت محدود)، کیونکہ غیر مجاز رسائی آپ کے SMTP ترتیبات کو بے نقاب کر سکتا ہے (اس میں SMTP صارف کا نام اور پاس ورڈ بھی شامل ہے). آپ کو اس بات کو یقینی بنانا چاہئے کہ 2FA کو چالو کرنے سے پہلے vault مناسب طریقے سے محفوظ ہو. اگر آپ ایسا کرنے میں قاصر ہیں تو، کم سے کم، آپ کو ایک نیا ای میل اکاؤنٹ بنانا چاہئے، اس مقصد کیلئے وقف کردہ SMTP ترتیبات کے خطرات کو کم کرنے کے لئے.<br /><br /></div>

---


### <div dir="rtl">٥. <a name="SECTION5"></a>CLI (کمانڈ لائن انٹرفیس)</div>

<div dir="rtl">phpMussel ونڈوز کی بنیاد پر نظام کے تحت CLI موڈ میں ایک انٹرایکٹو فائل سکینر کے طور پر چلایا جا سکتا ہے. "(CLI لئے) نصب کرنے کے لئے کس طرح" مزید تفصیلات کے لئے اس README فائل کا سیکشن دیکھیں.<br /><br /></div>

<div dir="rtl">آپ CLI کی فہرست کے لئے حکم دیتا ہے، CLI پرامپٹ میں، قسم سی، اور پریس درج کریں.<br /><br /></div>

<div dir="rtl">مزید برآں، ان دلچسپی کے لئے، CLI موڈ میں phpMussel استعمال کرنے کے لئے کس طرح کے لئے ایک ویڈیو ٹیوٹوریل یہاں دستیاب ہے:</div>
- <https://youtu.be/H-Pa740-utc>

---


### <div dir="rtl">٦. <a name="SECTION6"></a>فائل اس پیکیج میں شامل</div>

<div dir="rtl">مندرجہ ذیل اس سکرپٹ کے ذخیرہ کردہ کاپی میں شامل کیا گیا ہے کہ آپ ان فائلوں کے مقصد کی ایک مختصر وضاحت کے ساتھ ساتھ، یہ ڈاؤن لوڈ، جب تمام فائلوں کی ایک فہرست ہے.<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline">تفصیل</div> | <div dir="rtl" style="display:inline">فائل</div>
----|----
&nbsp; <div dir="rtl" style="display:inline">دستاویزی ڈائریکٹری (مختلف فائلوں پر مشتمل ہے).</div> | /_docs/
&nbsp; <div dir="rtl" style="display:inline">عربی دستاویزات.</div> | /_docs/readme.ar.md
&nbsp; <div dir="rtl" style="display:inline">جرمن دستاویزات.</div> | /_docs/readme.de.md
&nbsp; <div dir="rtl" style="display:inline">انگریزی دستاویزات.</div> | /_docs/readme.en.md
&nbsp; <div dir="rtl" style="display:inline">ہسپانوی دستاویزات.</div> | /_docs/readme.es.md
&nbsp; <div dir="rtl" style="display:inline">فرانسیسی دستاویزات.</div> | /_docs/readme.fr.md
&nbsp; <div dir="rtl" style="display:inline">انڈونیشیا دستاویزات.</div> | /_docs/readme.id.md
&nbsp; <div dir="rtl" style="display:inline">اطالوی دستاویزات.</div> | /_docs/readme.it.md
&nbsp; <div dir="rtl" style="display:inline">جاپانی دستاویزات.</div> | /_docs/readme.ja.md
&nbsp; <div dir="rtl" style="display:inline">کوریا دستاویزات.</div> | /_docs/readme.ko.md
&nbsp; <div dir="rtl" style="display:inline">ڈچ دستاویزات.</div> | /_docs/readme.nl.md
&nbsp; <div dir="rtl" style="display:inline">پرتگالی دستاویزات.</div> | /_docs/readme.pt.md
&nbsp; <div dir="rtl" style="display:inline">روسی دستاویزات.</div> | /_docs/readme.ru.md
&nbsp; <div dir="rtl" style="display:inline">اردو دستاویزات.</div> | /_docs/readme.ur.md
&nbsp; <div dir="rtl" style="display:inline">ویتنامی دستاویزات.</div> | /_docs/readme.vi.md
&nbsp; <div dir="rtl" style="display:inline">چینی (روایتی) دستاویزات.</div> | /_docs/readme.zh-TW.md
&nbsp; <div dir="rtl" style="display:inline">چینی (آسان کردہ) دستاویزات.</div> | /_docs/readme.zh.md
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹ فائلوں ڈائریکٹری (مختلف فائلوں پر مشتمل ہے). phpMussel درست طریقے سے آپ کے سسٹم پر نصب کیا گیا تھا کہ اگر تمام موجود فائلوں کی جانچ کے لئے ٹیسٹ فائلوں ہیں، اور آپ کو اس ڈائریکٹری یا اس کے فائلوں کے کسی بھی طرح کی ٹیسٹنگ کر رہے ہیں جب سوائے اپ لوڈ کرنے کی ضرورت نہیں.</div> | /_testfiles/
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel معمول ASCII دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/ascii_standard_testfile.txt
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel کمپلیکس توسیعی دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/coex_testfile.rtf
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel PE دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/exe_standard_testfile.exe
&nbsp; <div dir="rtl" style="display:inline">phpMussel جنرل دستخط کے ٹیسٹ کے لئے ٹیسٹ فائل.</div> | /_testfiles/general_standard_testfile.txt
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel گرافکس دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/graphics_standard_testfile.gif
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel معمول HTML دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/html_standard_testfile.html
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel MD5 دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/md5_testfile.txt
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel OLE دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/ole_testfile.ole
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel PDF دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/pdf_standard_testfile.pdf
&nbsp; <div dir="rtl" style="display:inline">phpMussel PE تخباگیی دستخط کے ٹیسٹ کے لئے ٹیسٹ فائل.</div> | /_testfiles/pe_sectional_testfile.exe
&nbsp; <div dir="rtl" style="display:inline">ٹیسٹنگ phpMussel SWF دستخط کے لئے ٹیسٹ فائل.</div> | /_testfiles/swf_standard_testfile.swf
&nbsp; <div dir="rtl" style="display:inline">والٹ ڈائریکٹری (مختلف فائلوں پر مشتمل ہے).</div> | /vault/
&nbsp; <div dir="rtl" style="display:inline">کیشے ڈائریکٹری (عارضی اعداد و شمار کے لئے).</div> | /vault/cache/
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/cache/.htaccess
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں اثاثوں.</div> | /vault/fe_assets/
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/fe_assets/.htaccess
&nbsp; <div dir="rtl" style="display:inline">صارف کو 2FA کوڈ کے لئے پوچھتے وقت ایک HTML ٹیمپلیٹ استعمال کیا جاتا ہے.</div> | /vault/fe_assets/_2fa.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ایک HTML سانچے اکاؤنٹس صفحہ.</div> | /vault/fe_assets/_accounts.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ایک HTML سانچے اکاؤنٹس صفحہ.</div> | /vault/fe_assets/_accounts_row.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کیش ڈیٹا صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_cache.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں ترتیب کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_config.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں ترتیب کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_config_row.html
&nbsp; <div dir="rtl" style="display:inline">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files.html
&nbsp; <div dir="rtl" style="display:inline">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_edit.html
&nbsp; <div dir="rtl" style="display:inline">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_rename.html
&nbsp; <div dir="rtl" style="display:inline">فائل مینیجر کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_files_row.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے ہوم پیج کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_home.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں لاگ ان کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_login.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر لاگز صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_logs.html
&nbsp; <div dir="rtl" style="display:inline">مکمل رسائی کے ساتھ ان لوگوں کے لئے سامنے کے آخر نیویگیشن روابط کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_nav_complete_access.html
&nbsp; <div dir="rtl" style="display:inline">لاگز کے ساتھ ان لوگوں کے لئے سامنے کے آخر نیویگیشن روابط کے لئے ایک HTML سانچے، صرف تک رسائی.</div> | /vault/fe_assets/_nav_logs_access_only.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں قرنطین صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_quarantine.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں قرنطین صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_quarantine_row.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں دستخط کی معلومات صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_siginfo.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں دستخط کی معلومات صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_siginfo_row.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں اعداد و شمار صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_statistics.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں اپ ڈیٹس صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_updates.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں اپ ڈیٹس صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_updates_row.html
&nbsp; <div dir="rtl" style="display:inline">اپ لوڈ کریں ٹیسٹ کے صفحے کے لئے ایک HTML سانچے.</div> | /vault/fe_assets/_upload_test.html
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے سی ایس ایس سٹائل شیٹ.</div> | /vault/fe_assets/frontend.css
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ڈیٹا بیس (اکاؤنٹ کی معلومات، سیشن کی معلومات، اور کیشے پر مشتمل ہے؛ سامنے کے آخر میں فعال اور استعمال کیا جاتا ہے تو صرف پیدا).</div> | /vault/fe_assets/frontend.dat
&nbsp; <div dir="rtl" style="display:inline">جب ضرورت ہو تو ایک حفاظتی میکانزم کی حیثیت سے پیدا.</div> | /vault/fe_assets/frontend.dat.safety
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے اہم HTML سانچے کی فائل.</div> | /vault/fe_assets/frontend.html
&nbsp; <div dir="rtl" style="display:inline">شبیہیں کے ہینڈلر (سامنے کے آخر میں فائل مینیجر کی طرف سے استعمال کیا جاتا).</div> | /vault/fe_assets/icons.php
&nbsp; <div dir="rtl" style="display:inline">پپس کے ہینڈلر (سامنے کے آخر میں فائل مینیجر کی طرف سے استعمال کیا جاتا).</div> | /vault/fe_assets/pips.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر جاوا اسکرپٹ ڈیٹا پر مشتمل ہے.</div> | /vault/fe_assets/scripts.js
&nbsp; <div dir="rtl" style="display:inline">phpMussel زبان کے اعداد و شمار پر مشتمل ہے.</div> | /vault/lang/
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/lang/.htaccess
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے عربی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ar.fe.php
&nbsp; <div dir="rtl" style="display:inline">عربی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ar.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے بنگلا زبان کے اعداد و شمار.</div> | /vault/lang/lang.bn.fe.php
&nbsp; <div dir="rtl" style="display:inline">بنگلا زبان کے اعداد و شمار.</div> | /vault/lang/lang.bn.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے جرمن زبان کے اعداد و شمار.</div> | /vault/lang/lang.de.fe.php
&nbsp; <div dir="rtl" style="display:inline">جرمن زبان کے اعداد و شمار.</div> | /vault/lang/lang.de.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے انگریزی زبان کے اعداد و شمار.</div> | /vault/lang/lang.en.fe.php
&nbsp; <div dir="rtl" style="display:inline">انگریزی زبان کے اعداد و شمار.</div> | /vault/lang/lang.en.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ہسپانوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.es.fe.php
&nbsp; <div dir="rtl" style="display:inline">ہسپانوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.es.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے فرانسیسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.fr.fe.php
&nbsp; <div dir="rtl" style="display:inline">فرانسیسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.fr.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ہندی زبان کے اعداد و شمار.</div> | /vault/lang/lang.hi.fe.php
&nbsp; <div dir="rtl" style="display:inline">ہندی زبان کے اعداد و شمار.</div> | /vault/lang/lang.hi.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے انڈونیشی زبان کے اعداد و شمار.</div> | /vault/lang/lang.id.fe.php
&nbsp; <div dir="rtl" style="display:inline">انڈونیشی زبان کے اعداد و شمار.</div> | /vault/lang/lang.id.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے اطالوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.it.fe.php
&nbsp; <div dir="rtl" style="display:inline">اطالوی زبان کے اعداد و شمار.</div> | /vault/lang/lang.it.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے جاپانی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ja.fe.php
&nbsp; <div dir="rtl" style="display:inline">جاپانی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ja.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے کوریائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ko.fe.php
&nbsp; <div dir="rtl" style="display:inline">کورین زبان کے اعداد و شمار.</div> | /vault/lang/lang.ko.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ڈچ زبان کے اعداد و شمار.</div> | /vault/lang/lang.nl.fe.php
&nbsp; <div dir="rtl" style="display:inline">ڈچ زبان کے اعداد و شمار.</div> | /vault/lang/lang.nl.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے پرتگالی زبان کے اعداد و شمار.</div> | /vault/lang/lang.pt.fe.php
&nbsp; <div dir="rtl" style="display:inline">پرتگالی زبان کے اعداد و شمار.</div> | /vault/lang/lang.pt.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے روسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ru.fe.php
&nbsp; <div dir="rtl" style="display:inline">روسی زبان کے اعداد و شمار.</div> | /vault/lang/lang.ru.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے تھائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.th.fe.php
&nbsp; <div dir="rtl" style="display:inline">تھائی زبان کے اعداد و شمار.</div> | /vault/lang/lang.th.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ترکی زبان کے اعداد و شمار.</div> | /vault/lang/lang.tr.fe.php
&nbsp; <div dir="rtl" style="display:inline">ترکی زبان کے اعداد و شمار.</div> | /vault/lang/lang.tr.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے اردو زبان کے اعداد و شمار.</div> | /vault/lang/lang.ur.fe.php
&nbsp; <div dir="rtl" style="display:inline">اردو زبان کے اعداد و شمار.</div> | /vault/lang/lang.ur.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے ویتنامی زبان کے اعداد و شمار.</div> | /vault/lang/lang.vi.fe.php
&nbsp; <div dir="rtl" style="display:inline">ویتنامی زبان کے اعداد و شمار.</div> | /vault/lang/lang.vi.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں کے لئے چینی (روایتی) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh-tw.fe.php
&nbsp; <div dir="rtl" style="display:inline">چینی (روایتی) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh-tw.php
&nbsp; <div dir="rtl" style="display:inline">چینی کے سامنے کے آخر کے لئے (آسان کردہ) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh.fe.php
&nbsp; <div dir="rtl" style="display:inline">چینی (آسان کردہ) زبان کے اعداد و شمار.</div> | /vault/lang/lang.zh.php
&nbsp; <div dir="rtl" style="display:inline">سنگرودھ ڈائریکٹری (قرنطینہ فائلوں پر مشتمل ہے).</div> | /vault/quarantine/
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/quarantine/.htaccess
&nbsp; <div dir="rtl" style="display:inline">دستخط ڈائریکٹری (دستخط فائلوں پر مشتمل ہے).</div> | /vault/signatures/
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/signatures/.htaccess
&nbsp; <div dir="rtl" style="display:inline">کنٹرولز اور سیٹ خاص متغیر.</div> | /vault/signatures/switch.dat
&nbsp; <div dir="rtl" style="display:inline">ایک ہایپر ٹیکسٹ رسائی فائل (اس مثال میں، غیر مجاز ذرائع کی طرف سے حاصل کیا جا رہا ہے سے سکرپٹ سے تعلق رکھنے والے حساس فائلوں کی حفاظت کے لئے).</div> | /vault/.htaccess
&nbsp; <div dir="rtl" style="display:inline">جانچ کے لئے Travis CI کی طرف سے استعمال کیا جاتا ہے (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /vault/.travis.php
&nbsp; <div dir="rtl" style="display:inline">جانچ کے لئے Travis CI کی طرف سے استعمال کیا جاتا ہے (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /vault/.travis.yml
&nbsp; <div dir="rtl" style="display:inline">CLI ہینڈلر</div> | /vault/cli.php
&nbsp; <div dir="rtl" style="display:inline">جزو میٹا ڈیٹا فائل؛ سامنے کے آخر میں اپ ڈیٹس صفحہ کے ذریعہ استعمال کیا جاتا ہے.</div> | /vault/components.dat
&nbsp; <div dir="rtl" style="display:inline">کنفگریشن فائل؛ phpMussel کے تمام ترتیب کے اختیارات، کیا کرنا ہے یہ کہہ رہا ہے اور کس طرح درست طریقے سے کام کرنے کے لئے پر مشتمل ہے (چالو کرنے کا نام تبدیل).</div> | /vault/config.ini.RenameMe
&nbsp; <div dir="rtl" style="display:inline">کنفگریشن ہینڈلر.</div> | /vault/config.php
&nbsp; <div dir="rtl" style="display:inline">کنفگریشن ڈیفالٹس فائل؛ phpMussel لئے پہلے سے طے شدہ ترتیب کے اقدار پر مشتمل ہے.</div> | /vault/config.yaml
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر میں ہینڈلر.</div> | /vault/frontend.php
&nbsp; <div dir="rtl" style="display:inline">سامنے کے آخر افعال فائل.</div> | /vault/frontend_functions.php
&nbsp; <div dir="rtl" style="display:inline">افعال فائل (ضروری).</div> | /vault/functions.php
&nbsp; <div dir="rtl" style="display:inline">phpMussel (فائل خود کار طریقے سے خارج کر دیا ہے تو دوبارہ) اسے نظر انداز کیا جانا چاہئے دستخط جس سے اشارہ greylisted دستخط کی CSV.</div> | /vault/greylist.csv
&nbsp; <div dir="rtl" style="display:inline">زبان ہینڈلر.</div> | /vault/lang.php
&nbsp; <div dir="rtl" style="display:inline">PHP 5.4.X کے لئے Polyfills (PHP 5.4.X کے لئے ضروری پیچھے کی طرف مطابقت؛ جدید تر PHP ورژن کے لئے حذف کرنا محفوظ).</div> | /vault/php5.4.x.php
&nbsp; <div dir="rtl" style="display:inline">پلگ ان میٹا ڈیٹا فائل؛ سامنے کے آخر میں اپ ڈیٹس صفحہ کے ذریعہ استعمال کیا جاتا ہے.</div> | /vault/plugins.dat
&nbsp; <div dir="rtl" style="display:inline">ہر فائل اپ لوڈ کی ایک ریکارڈ بلاک/phpMussel کر ہلاک کر دیا.</div> | ※ /vault/scan_kills.txt
&nbsp; <div dir="rtl" style="display:inline">phpMussel طرف سے سکین ہر چیز کا ایک ریکارڈ ہے.</div> | ※ /vault/scan_log.txt
&nbsp; <div dir="rtl" style="display:inline">phpMussel طرف سے سکین ہر چیز کا ایک ریکارڈ ہے.</div> | ※ /vault/scan_log_serialized.txt
&nbsp; <div dir="rtl" style="display:inline">دستخط کی شناخت کی وضاحت کرتے وقت اسکین کے دوران اور جب دستخط کے ذریعے دستخط کی معلومات تک رسائی حاصل کرنے پر دستخط کرنے کے لئے دستخط کی شناختی کاروائیوں پر مشتمل ہوتا ہے.</div> | /vault/shorthand.yaml
&nbsp; <div dir="rtl" style="display:inline">دستخط میٹا ڈیٹا فائل؛ سامنے کے آخر میں اپ ڈیٹس صفحہ کے ذریعہ استعمال کیا جاتا ہے.</div> | /vault/signatures.dat
&nbsp; <div dir="rtl" style="display:inline">سانچہ فائل؛ اس سے بلاک فائل اپ لوڈ پیغام (پیغام اپ لوڈ کنندہ نے دیکھا) کے لئے phpMussel طرف سے تیار HTML پیداوار کے لئے سانچہ.</div> | /vault/template_custom.html
&nbsp; <div dir="rtl" style="display:inline">سانچہ فائل؛ اس سے بلاک فائل اپ لوڈ پیغام (پیغام اپ لوڈ کنندہ نے دیکھا) کے لئے phpMussel طرف سے تیار HTML پیداوار کے لئے سانچہ.</div> | /vault/template_default.html
&nbsp; <div dir="rtl" style="display:inline">موضوعات میٹا ڈیٹا فائل؛ سامنے کے آخر میں اپ ڈیٹس صفحہ کے ذریعہ استعمال کیا جاتا ہے.</div> | /vault/themes.dat
&nbsp; <div dir="rtl" style="display:inline">اپ لوڈ کریں ہینڈلر.</div> | /vault/upload.php
&nbsp; <div dir="rtl" style="display:inline">ایک GitHub کے منصوبے فائل (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /.gitattributes
&nbsp; <div dir="rtl" style="display:inline">ایک GitHub کے منصوبے فائل (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /.gitignore
&nbsp; <div dir="rtl" style="display:inline">مختلف ورژن کے درمیان سکرپٹ کی گئی تبدیلیوں کا ایک ریکارڈ (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /Changelog-v1.txt
&nbsp; <div dir="rtl" style="display:inline">Composer/Packagist معلومات (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /composer.json
&nbsp; <div dir="rtl" style="display:inline">اس منصوبے میں شراکت کے لئے کس طرح کے بارے میں معلومات.</div> | /CONTRIBUTING.md
&nbsp; <div dir="rtl" style="display:inline">GNU/GPLv2 اجازت نامے کی ایک نقل (رسم الخط کی مناسب تقریب کے لئے ضروری نہیں).</div> | /LICENSE.txt
&nbsp; <div dir="rtl" style="display:inline">لوڈر. اس سے آپ (ضروری) میں hooking ہونا چاہیے رہے ہیں کیا ہوتا ہے!</div> | /loader.php
&nbsp; <div dir="rtl" style="display:inline">اس منصوبے میں ملوث افراد کے بارے میں معلومات.</div> | /PEOPLE.md
&nbsp; <div dir="rtl" style="display:inline">پروجیکٹ کا خلاصہ معلومات.</div> | /README.md
&nbsp; <div dir="rtl" style="display:inline">ایک ASP.NET کنفیگریشن فائل (اس مثال میں، ایونٹ میں غیر مجاز ذرائع سکرپٹ ASP.NET ٹیکنالوجیز کی بنیاد پر ایک سرور پر نصب کیا جاتا ہے کہ کی طرف سے حاصل کیا جا رہا ہے سے "/vault" ڈائریکٹری کی حفاظت کے لئے).</div> | /web.config

<div dir="rtl">※ فائل کا نام ترتیب کے شرائط (<code dir="ltr">config.ini</code> میں) کی بنیاد پر مختلف ہو سکتے ہیں.<br /><br /></div>

---


### <div dir="rtl">٧. <a name="SECTION7"></a>ترتیب کے اختیارات</div>
<div dir="rtl">مندرجہ ذیل phpMussel کے <code dir="ltr">"config.ini"</code> کنفیگریشن فائل میں پایا، ان کے مقاصد اور تقریب کی ایک وضاحت کے ساتھ ساتھ متغیر کی ایک فہرست ہے.<br /><br /></div>

#### <div dir="rtl">"general" (قسم)<br /></div>
<div dir="rtl">جنرل phpMussel ترتیب.<br /><br /></div>

##### <div dir="rtl">"cleanup"<br /></div>
<div dir="rtl"><ul>
 <li>ترتیب ختم متغیر اور کیشے ابتدائی اپ لوڈ سکیننگ کے بعد اسکرپٹ طرف سے استعمال کیا؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ]. آپ کے اپ لوڈز کے ابتدائی سکیننگ پرے سکرپٹ کا استعمال کرتے ہوئے نہیں ہیں تو، آپ کو اس TRUE" (ہاں) "کرنے کے لئے، میموری استعمال کو کم سے کم کرنے کے لئے مقرر کیا جانا چاہئے. آپ کے اپ لوڈز کے ابتدائی سکیننگ پرے سکرپٹ کا استعمال کرتے ہوئے ہیں تو، میموری میں دہرے ڈیٹا دوبارہ لوڈ بیکار میں سے بچنے کے لئے FALSE" (کوئی) "لئے مقرر کیا جانا چاہئے. عام پریکٹس میں، یہ عام طور پر TRUE" "لئے مقرر کیا جائے چاہئے، لیکن آپ ایسا کرتے ہیں تو، آپ کو ابتدائی فائل اپ لوڈ کی سکیننگ کے علاوہ کسی اور چیز کے لئے سکرپٹ کو استعمال کرنے کے لئے نہیں کر سکیں گے.</li>
 <li>CLI موڈ میں کوئی اثر و رسوخ ہے.</li>
</ul></div>

##### <div dir="rtl">"scan_log"<br /></div>
<div dir="rtl"><ul>
 <li>فائل کی فائل کا نام لئے تمام سکیننگ نتائج لاگ ان کریں. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے خالی چھوڑ دیں.</li>
</ul></div>

##### <div dir="rtl">"scan_log_serialized"<br /></div>
<div dir="rtl"><ul>
 <li>فائل کا نام مسل تمام سکیننگ کے نتائج کو (serialized فارمیٹ استعمال کرتے ہوئے) لاگ ان کریں. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے خالی چھوڑ دیں.</li>
</ul></div>

##### <div dir="rtl">"scan_kills"<br /></div>
<div dir="rtl"><ul>
 <li>فائل کا نام مسل کو مسدود یا ہلاک کر کے اپ لوڈز کے تمام ریکارڈ لاگ ان کریں. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے خالی چھوڑ دیں.</li>
</ul></div>

<div dir="rtl"><em>مفید ٹپ: "{yyyy}" مکمل سال کے لئے، "{yy}" مختصر سال کے لئے، "{mm}": اگر آپ چاہتے ہیں تو آپ کے نام میں ان کو شامل کرکے آپ لاگ مسلیں کے ناموں کو تاریخ/وقت کی معلومات شامل کر سکتے ہیں مہینے کے لئے، دن کے لئے، "{hh}" گھنٹے کیلئے "{dd}" (ذیل کی مثالیں دیکھ).</em><br /><br /></div>

```
 scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'
 scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'
 scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'
```

##### <div dir="rtl">"truncate"<br /></div>
<div dir="rtl"><ul>
 <li>وہ ایک خاص سائز تک پہنچنے میں جب صاف لاگ مسلیں؟ ویلیو میں B/KB/MB/GB/TB زیادہ سے زیادہ سائز ہے. جب 0KB، وہ غیر معینہ مدت تک ترقی کر سکتا ہے (پہلے سے طے). نوٹ: واحد فائلوں پر لاگو ہوتا ہے! فائلیں اجتماعی غور نہیں کر رہے ہیں.</li>
</ul></div>

##### <div dir="rtl">"log_rotation_limit"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ گرد گردش کسی بھی وقت کسی بھی وقت موجود ہونا لاگ ان کی تعداد محدود کرتا ہے. جب نیا لاگ ان کی تخلیق کی جاتی ہے تو، اگر لاگ ان کی کل تعداد مخصوص حد سے زیادہ ہوتی ہے تو مخصوص کارروائی کی جائے گی. آپ یہاں مطلوبہ حد کی وضاحت کرسکتے ہیں. 0 کی قیمت لاگ گرد گردش کو غیر فعال کرے گی.</li>
</ul></div>

##### <div dir="rtl">"log_rotation_action"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ گرد گردش کسی بھی وقت کسی بھی وقت موجود ہونا لاگ ان کی تعداد محدود کرتا ہے. جب نیا لاگ ان کی تخلیق کی جاتی ہے تو، اگر لاگ ان کی کل تعداد مخصوص حد سے زیادہ ہوتی ہے تو مخصوص کارروائی کی جائے گی. آپ یہاں مطلوبہ کارروائی کی وضاحت کرسکتے ہیں. Delete = قدیم ترین لاگ ان کو حذف کریں، جب تک کہ حد تک زیادہ نہیں ہوسکتی ہے. Archive = سب سے پہلے آرکائیو، اور پھر سب سے پرانی لاگ ان کو حذف کریں، جب تک کہ حد زیادہ نہیں ہوسکتی.</li>
</ul></div>

<div dir="rtl">تکنیکی وضاحت: اس تناظر میں "سب سے پرانی" کا مطلب "کم از کم ترمیم شدہ" ہے.<br /><br /></div>

##### <div dir="rtl">"timeOffset"<br /></div>
<div dir="rtl"><ul>
 <li>آپ کے سرور کے وقت آپ کے مقامی وقت کے مماثل نہیں ہے تو، آپ کو آپ کی ضروریات کے مطابق phpMussel طرف سے پیدا تاریخ/وقت کی معلومات کو ایڈجسٹ کرنے کے لئے یہاں آفسیٹ ایک وضاحت کر سکتے ہیں. یہ عام طور پر یہ کرنا ہمیشہ ممکن نہیں ہے، اور تو، اس اختیار کو یہاں فراہم کی جاتی ہے (جیسا محدود مشترکہ ہوسٹنگ فراہم کرنے والے کے ساتھ کام کرتے وقت کے طور پر) آپ "php.ini" فائل میں ٹائم زون ہدایت کو ایڈجسٹ کرنے کی بجائے سفارش، لیکن کبھی کبھی رہا ہے. آف سیٹ منٹ میں ہے.</li>
 <li>مثال (ایک گھنٹے کا اضافہ کرنے کے لئے):</li>
</ul></div>

`timeOffset=60`

##### <div dir="rtl">"timeFormat"<br /></div>
<div dir="rtl"><ul>
 <li>تاریخ کی شکل phpMussel طرف سے استعمال کیا. پہلے سے طے شدہ:</li>
</ul></div>

`{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`

##### <div dir="rtl">"ipaddr"<br /></div>
<div dir="rtl"><ul>
 <li>درخواستوں منسلک کرنے کے IP ایڈریس کو کہاں تلاش کرنے کے لئے؟ پہلے سے طے شدہ = REMOTE_ADDR (جیسا Cloudflare کے اور پسند کرتا ہے کے طور پر خدمات کے لئے مفید). انتباہ: جب تک کہ آپ کو پتہ ہے تم کیا کر رہے ہو اس کو تبدیل نہ کریں!</li>
</ul></div>

<div dir="rtl">"ipaddr" کے لئے سفارش کی اقدار:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline">قدر</div> | &nbsp; <div dir="rtl" style="display:inline">استعمال</div>
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula reverse proxy (ریورس پراکسی).
`HTTP_CF_CONNECTING_IP` | Cloudflare reverse proxy (ریورس پراکسی).
`CF-Connecting-IP` | Cloudflare reverse proxy (ریورس پراکسی؛ متبادل؛ مندرجہ بالا کام نہیں کرتا تو).
`HTTP_X_FORWARDED_FOR` | Cloudbric reverse proxy (ریورس پراکسی).
`X-Forwarded-For` | [Squid reverse proxy (ریورس پراکسی)](http://www.squid-cache.org/Doc/config/forwarded_for/).
&nbsp; <div dir="rtl" style="display:inline"><em>سرور کی ترتیب کی طرف سے وضاحت کی گئی.</em></div> | [Nginx reverse proxy (ریورس پراکسی)](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | &nbsp; <div dir="rtl" style="display:inline">نہیں کسی بھی ریورس پراکسی (پہلے سے طے شدہ قیمت).</div>

##### <div dir="rtl">"enable_plugins"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel پلگ ان کے لئے حمایت فعال کریں؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"forbid_on_block"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel فائل اپ بلاک کر کے پیغام کے ساتھ 403 ہیڈرز بھیجیں، یا کے ساتھ معمول کے 200 OK رہنا چاہیے؟ False (جھوٹی) = نہیں (200)؛ True (سچے) = جی ہاں (403) [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"delete_on_sight"<br /></div>
<div dir="rtl"><ul>
 <li>چاہے دستخط کے ذریعے یا دوسری صورت میں، فوری طور پر الفاظ کے ملاپ کے کسی بھی پتہ لگانے کے معیار پر کسی بھی سکین کی کوشش کی فائل اپ لوڈ حذف کرنے کی کوشش کرنے کے لئے اس ہدایت کو چالو کرنے سکرپٹ ہدایت کرے گا. "صاف" ہونے کا تعین کیا فائلیں چھوا نہیں رکھا جائے گا. ابلیھاگاروں کی صورت میں، پورے آرکائیو حذف کر دیا جائے گا قطع نظر یا نہیں آمیز فائل کا صرف ایک ہی محفوظ شدہ دستاویزات کے اندر موجود کئی فائلوں میں سے ہے. فائل اپ لوڈ کی سکیننگ کے معاملے کے طور پر، عام طور پر، یہ ضروری نہیں ہے، یہ ہدایت چالو کرنے کے لئے عام طور پر PHP کی خود کار طریقے سے اس کی کیشے کے مندرجات مٹا دے گا کیونکہ عملدرآمد ختم ہو گیا ہے جب یہ عام طور پر کرنے کے لئے اس کے ذریعے اپ لوڈ کردہ کسی بھی فائلوں کو خارج کر دیں گے جس کا مطلب ہے، سرور جب تک کہ وہ پہلے ہی منتقل کر دیا کاپی یا خارج کر دیا گیا ہے. یہ ہدایت جن PHP کی کاپیاں ہمیشہ انداز کی توقع میں برتاؤ نہیں کر سکتے ہیں ان کے لئے سیکورٹی کی ایک اضافی اقدام کے طور پر یہاں شامل کی جاتی ہے. False (جھوٹی) = سکیننگ کے بعد، اکیلے فائل [پہلے سے طے شدہ] چھوڑ دیں؛ True (سچے) = سکیننگ کے بعد، صاف نہیں ہے تو، فوری طور پر خارج کر دیں.</li>
</ul></div>

##### <div dir="rtl">"lang"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel لئے پہلے سے طے شدہ زبان.</li>
</ul></div>

##### <div dir="rtl">"numbers"<br /></div>
<div dir="rtl"><ul>
 <li>نمبروں کو ظاہر کرنے کی وضاحت کرتا ہے.</li>
</ul></div>

<div dir="rtl">فی الحال تعاون شدہ اقدار:<br /><br /></div>

قدر | پیدا کرتا ہے | تفصیل
---|---|---
`NoSep-1` | `1234567.89`
`NoSep-2` | `1234567,89`
`Latin-1` | `1,234,567.89` | پہلے سے طے شدہ.
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

<div dir="rtl">نوٹ: یہ اقدار کہیں بھی معیاری نہیں ہیں، اور شاید پیکج سے باہر متعلقہ نہیں ہوں گے. اس کے علاوہ، معاون اقدار مستقبل میں تبدیل کر سکتے ہیں.<br /><br /></div>

##### <div dir="rtl">"quarantine_key"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel سنگرودھ، phpMussel والٹ کے اندر تنہائی میں فائل اپ لوڈ کی کوشش جھنڈا لگایا اس سے تم نے ایسا کرنا چاہتے ہیں کچھ ہے تو قابل ہے. صرف دل کی گہرائیوں سے کسی بھی پرچم لگایا کوشش کی فائل اپ لوڈ اس فعالیت کو غیر فعال کر چھوڑ دینا چاہئے تجزیہ کرنے میں کوئی دلچسپی کے بغیر ان کی ویب سائٹ یا ہوسٹنگ ماحول کی حفاظت کے لئے چاہتے ہیں کہ phpMussel کے آرام دہ اور پرسکون صارفین، لیکن میلویئر کی تحقیق کے لئے یا اسی طرح کے پرچم لگائے کوشش کی فائل اپ لوڈ کی مزید تجزیہ کرنے میں دلچسپی رکھتے کسی بھی صارفین ایسی چیزوں کو اس فعالیت کو چالو کرنا چاہئے. نشان زدہ کوشش کی فائل اپ لوڈ کی Quarantining کبھی کبھی بھی، جھوٹے مثبت ٹھیک کرنا میں مدد کر سکتے ہیں یہ اکثر آپ کے لئے اس وقت ہوتی ہے کہ کچھ ہے. سنگرودھ فعالیت کو غیر فعال کرنے کیلئے، بس "quarantine_key" ہدایت خالی چھوڑ دیں، یا یہ کہ ہدایت کے مندرجات کو مٹانے یہ پہلے سے خالی نہیں ہے. سنگرودھ فعالیت کو چالو کرنے کے لئے، ہدایت میں کچھ قیمت درج کریں. "quarantine_key" ممکنہ حملہ آوروں کی طرف سے اور سنگرودھ کے اندر اندر ذخیرہ کردہ ڈیٹا کی کسی بھی ممکنہ پھانسی کی روک تھام کا ایک ذریعہ کے طور پر استحصال کیا جا رہا ہے سے قرنطینہ فعالیت کی روک تھام کا ایک ذریعہ کے طور پر ضرورت سنگرودھ فعالیت کا ایک اہم حفاظتی خصوصیت ہے. "quarantine_key" آپ کے پاس ورڈ کے طور پر اسی انداز میں علاج کیا جانا چاہئے: اب بہتر ہے، اور مضبوطی سے اس کی حفاظت. بہترین اثر کے لیے، "delete_on_sight" ساتھ مل کر میں استعمال کرتے ہیں.</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_filesize"<br /></div>
<div dir="rtl"><ul>
 <li>فائلوں کی زیادہ سے زیادہ قابل اجازت فائل قرنطینہ جائے. متعین قدر سے بڑی فائلوں قرنطینہ نہیں رکھا جائے گا. یہ ہدایت کسی بھی ممکنہ حملہ آوروں کے ممکنہ طور پر اپنے ہوسٹنگ سروس پر رن دور ڈیٹا کے استعمال کے باعث ناپسندیدہ اعداد و شمار کے ساتھ آپ کے سنگرودھ سیلاب کے لئے یہ زیادہ مشکل بنانے کا ایک ذریعہ کے طور پر اہم ہے. پہلے سے طے شدہ = 2MB.</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_usage"<br /></div>
<div dir="rtl"><ul>
 <li>زیادہ سے زیادہ میموری کا استعمال سنگرودھ کے لئے کی اجازت دی. سنگرودھ طرف سے استعمال کیا کل میموری اس قیمت تک پہنچ جاتا ہے تو، استعمال کیا کل میموری اب کوئی اس قیمت تک پہنچ جاتا ہے جب تک قدیم ترین قرنطینہ فائلوں کو خارج کر دیا جائے گا. یہ ہدایت کسی بھی ممکنہ حملہ آوروں کے ممکنہ طور پر اپنے ہوسٹنگ سروس پر رن دور ڈیٹا کے استعمال کے باعث ناپسندیدہ اعداد و شمار کے ساتھ آپ کے سنگرودھ سیلاب کے لئے یہ زیادہ مشکل بنانے کا ایک ذریعہ کے طور پر اہم ہے. پہلے سے طے شدہ = 64MB.</li>
</ul></div>

##### <div dir="rtl">"quarantine_max_files"<br /></div>
<div dir="rtl"><ul>
 <li>قرنطین میں موجود فائلوں کی زیادہ سے زیادہ تعداد. جب قرنطین میں نئی فائلوں کو شامل کیا جاتا ہے تو، اگر یہ نمبر تجاوز کردی جاتی ہے تو، پرانی فائلوں کو حذف کر دیا جائے گا جب باقی باقی اب اس نمبر سے زیادہ نہیں ہیں. پہلے سے طے شدہ = 100.</li>
</ul></div>

##### <div dir="rtl">"honeypot_mode"<br /></div>
<div dir="rtl"><ul>
 <li>جب honeypot موڈ چالو حالت میں ہے، phpMussel یہ مقابلوں کہ ہر ایک فائل اپ لوڈ نظرانداز کرنے پر، قطع نظر یا نہیں فائل اپ لوڈ کی جارہی میل کھاتا کی کوشش کرے گا کسی بھی دستخط شامل ہیں، اور ان لوگوں کی کوشش کی فائل اپ لوڈ کی کوئی اصل سکیننگ یا تجزیہ اصل میں واقع ہو گا. یہ فعالیت وائرس/میلویئر کی تحقیق کے مقاصد کے لئے phpMussel استعمال کرنا چاہتے ہیں ان لوگوں کے لئے مفید ہونا چاہئے، لیکن صارف کی طرف phpMussel کے مقصد کے استعمال کی اصل فائل اپ لوڈ کی سکیننگ کے لئے ہے اگر یہ نہ تو اس فعالیت کو چالو کرنے کی سفارش کی، اور نہ ہی استعمال کرنے کے لئے سفارش کی جاتی ہے honeypotting علاوہ دیگر مقاصد کے لئے honeypot فعالیت. بنیادی طور پر، اس اختیار کو غیر فعال ہے. False (جھوٹی) = معذور [پہلے سے طے شدہ]؛ True (سچے) = فعال.</li>
</ul></div>

##### <div dir="rtl">"scan_cache_expiry"<br /></div>
<div dir="rtl"><ul>
 <li>کب تک phpMussel سکیننگ کے نتائج کیشے چاہئے؟ قیمت کے لئے سکیننگ کے نتائج کیشے سیکنڈ کی تعداد ہے. پہلے سے طے شدہ 21600 سیکنڈ (6 گھنٹے) ہے؛ 0 کی قدر سکیننگ کے نتائج کیشنگ کو غیر فعال کریں گے.</li>
</ul></div>

##### <div dir="rtl">"disable_cli"<br /></div>
<div dir="rtl"><ul>
 <li>فعال CLI موڈ؟ CLI موڈ ڈیفالٹ کی طرف سے چالو حالت میں ہے، لیکن کبھی کبھی بعض جانچ کے آلات (جیسے PHPUnit کے طور پر، مثال کے طور پر) اور دیگر CLI کی بنیاد پر ایپلی کیشنز کے ساتھ مداخلت کر سکتے ہیں. آپ CLI موڈ کو غیر فعال کرنے کی ضرورت نہیں ہے تو، آپ کو اس ہدایت کو نظر انداز کرنا چاہئے. False (جھوٹی) = CLI موڈ [پہلے سے طے شدہ] فعال؛ True (سچے) = غیر فعال CLI موڈ</li>
</ul></div>

##### <div dir="rtl">"disable_frontend"<br /></div>
<div dir="rtl"><ul>
 <li>سامنے کے آخر تک رسائی کو غیر فعال کریں؟ سامنے کے آخر میں رسائی phpMussel زیادہ انتظام بنا سکتے ہیں، لیکن یہ بھی بہت ہے، ایک زبردست حفاظتی خطرہ ہو سکتا ہے. یہ جب بھی ممکن ہو واپس کے آخر کے ذریعے phpMussel منظم کرنے کی سفارش کی جاتی ہے، لیکن سامنے کے آخر میں رسائی ممکن نہیں ہے جب کے لئے فراہم کی جاتی ہے. تمہیں اس کی ضرورت ہے جب تک کہ اس کو معذور رکھیں. False (جھوٹی) = سامنے کے آخر میں رسائی کو فعال کریں؛ True (سچے) = غیر فعال سامنے کے آخر میں رسائی [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"max_login_attempts"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ ان کوششوں (سامنے کے آخر میں) کی زیادہ سے زیادہ تعداد. پہلے سے طے شدہ = 5.</li>
</ul></div>

##### <div dir="rtl">"FrontEndLog"<br /></div>
<div dir="rtl"><ul>
 <li>لاگنگ سامنے کے آخر میں لاگ ان کوششوں کے لئے فائل. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے خالی چھوڑ دیں.</li>
</ul></div>

##### <div dir="rtl">"disable_webfonts"<br /></div>
<div dir="rtl"><ul>
 <li>ویب فونٹس کے غیر فعال کریں؟ True (سچے) = جی ہاں [پہلے سے طے شدہ]؛ False (جھوٹی) = کوئی.</li>
</ul></div>

##### <div dir="rtl">"maintenance_mode"<br /></div>
<div dir="rtl"><ul>
 <li>بحالی کا موڈ فعال کریں؟ True (سچے) = جی ہاں؛ False (جھوٹی) = کوئی [پہلے سے طے شدہ]. سامنے کے اختتام کے مقابلے میں سب کچھ غیر فعال کرتا ہے. کبھی کبھی آپ کے CMS، فریم ورک، وغیرہ کو اپ ڈیٹ کرنے کے لئے مفید ہے.</li>
</ul></div>

##### <div dir="rtl">"default_algo"<br /></div>
<div dir="rtl"><ul>
 <li>اس بات کی وضاحت کرتا ہے جو تمام مستقبل کے پاس ورڈ اور سیشن کے لئے الگورتھم استعمال کرنا ہے. اختیارات: PASSWORD_DEFAULT (ڈیفالٹ), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 کی ضرورت ہے).</li>
</ul></div>

##### <div dir="rtl">"statistics"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel استعمال کے اعداد و شمار کو ٹریک کریں؟ True (سچے) = جی ہاں؛ False (جھوٹی) = نہیں [پہلے سے طے شدہ].</li>
</ul></div>

#### <div dir="rtl">"signatures" (قسم)<br /></div>
<div dir="rtl">دستخط ترتیب.<br /><br /></div>

##### <div dir="rtl">"Active"<br /></div>
<div dir="rtl"><ul>
 <li>فعال دستخط کی فائلوں، کوما سے ختم ہونے والی کی ایک فہرست.</li>
</ul></div>

<div dir="rtl">نوٹ: دستخط فائلوں کو پہلے ہی انسٹال کرنا ضروری ہے، اس سے پہلے کہ آپ ان کو چالو کرسکیں.<br /><br /></div>

##### <div dir="rtl">"fail_silently"<br /></div>
<div dir="rtl"><ul>
 <li>چاہئے phpMussel رپورٹ جب دستخط فائلوں غائب یا خراب ہو؟ اگر "fail_silently"، غیر فعال ہے لاپتہ اور خراب فائلوں سکیننگ پر اطلاع دی جائے گی، اور" اگر fail_silently" فعال لاپتہ اور خراب فائلوں کو کسی بھی مسائل موجود نہیں ہیں کہ ان فائلوں کے لئے رپورٹنگ سکیننگ کے ساتھ، نظر انداز کر دیا جائے گا. آپ گر کر تباہ یا اسی طرح کے مسائل کا سامنا کر رہے ہیں جب تک کہ یہ عام تنہا چھوڑ دیا جانا چاہئے. False (جھوٹی) = معذور؛ True (سچے) = چالو کیا [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"fail_extensions_silently"<br /></div>
<div dir="rtl"><ul>
 <li>چاہئے phpMussel رپورٹ توسیعات لاپتہ ہیں جب؟ fail_extensions_silently" غیر فعال ہے "تو، لاپتہ توسیعات سکیننگ پر اطلاع دی جائے گی، اور" اگر fail_extensions_silently" چالو حالت میں ہے، لاپتہ توسیعات کسی بھی مسائل موجود نہیں ہیں کہ ان فائلوں کے لئے رپورٹنگ سکیننگ کے ساتھ، نظر انداز کر دیا جائے گا. اس حکم کو غیر فعال ممکنہ طور پر آپ کی سیکورٹی میں اضافہ ہو سکتا ہے، بلکہ جھوٹے مثبت کا اضافہ کا باعث بن سکتا. False (جھوٹی) = معذور؛ True (سچے) = چالو کیا [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_adware"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel ایڈویئر کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_encryption"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel کو خفیہ کاری فائلوں کا پتہ لگانے اور بلاک کرنا چاہئے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_joke_hoax"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel مذاق/چکما میلویئر/وائرس کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_pua_pup"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel PUAs/بچوں کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_packer_packed"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel پیکرز اور پیک کے اعداد و شمار کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_shell"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel شیل اسکرپٹ کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"detect_deface"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel defacements اور defacers کا پتہ لگانے کے لئے دستخط تجزیہ کرنا چاہیے؟ False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

#### <div dir="rtl">"files" (قسم)<br /></div>
<div dir="rtl">کنفیگریشن ہینڈلنگ فائل.<br /><br /></div>

##### <div dir="rtl">"max_uploads"<br /></div>
<div dir="rtl"><ul>
 <li>فائلوں کی زیادہ سے زیادہ قابل اجازت تعداد میں اپ لوڈ کے دوران فائلوں کو اسکین اسکین کرنے اسکین اسقاط اور صارف کو وہ بہت زیادہ ایک ہی بار میں اپ لوڈ کر رہے ہیں مطلع کرنے سے پہلے! ایک نظریاتی حملے ہیں جس کے تحت ایک حملہ آور ایک پیسنے رک PHP عمل کو سست کرنے phpMussel اوور لوڈنگ کی طرف سے آپ کے سسٹم یا CMS DDOS کرنے کی کوشش کے خلاف تحفظ فراہم کرتا ہے. تجویز کردہ: 10. آپ کو بڑھانے یا اس نمبر سے آپ ہارڈ ویئر کی رفتار پر منحصر ہے کو کم کر سکتے ہیں. کہ اس نمبر کے لئے اکاؤنٹ یا ابلیھاگاروں کے مندرجات شامل نہیں ہے یاد رکھیں کہ.</li>
</ul></div>

##### <div dir="rtl">"filesize_limit"<br /></div>
<div dir="rtl"><ul>
 <li>میں KB فائل کی حد. 65536 = 64MB [پہلے سے طے شدہ]؛ 0 = کوئی حد نہیں (ہمیشہ سرمئی درج)، کسی بھی (مثبت) عددی قیمت قبول کر لیا. آپ PHP کی ترتیب میموری کی رقم ایک عمل کو پکڑ کر سکتے محدود کر دیتی ہے یا اپ لوڈز آپ PHP کی ترتیب حدود فائل اگر تو یہ مفید ہو سکتا ہے.</li>
</ul></div>

##### <div dir="rtl">"filesize_response"<br /></div>
<div dir="rtl"><ul>
 <li>کیا فائل کی حد سے تجاوز ہے کہ (اگر موجود ہو) فائلوں کے ساتھ کیا کرنا. False (جھوٹی) = وائٹ لسٹ؛ True (سچے) = بلیک لسٹ [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl"><code dir="ltr">"filetype_whitelist"</code>، <code dir="ltr">"filetype_blacklist"</code>، <code dir="ltr">"filetype_greylist"</code><br /></div>
<div dir="rtl"><ul>
 <li>آپ کے سسٹم صرف فائلوں کی مخصوص اقسام اپ لوڈ کیا جا کرنے کی اجازت دیتا ہے، یا آپ کے سسٹم کو واضح طور پر، فائلوں کی بعض اقسام کی تردید کرتے ہیں وائٹ لسٹیں، بلیک لسٹ اور سرمئی فہرستوں میں ان قسم کی فائلوں کی وضاحت جس میں رفتار سکیننگ جائیں کرنے سکرپٹ اجازت دے کر کیا جاتا ہے بڑھا سکتے ہیں اگر تو بعض قسم کی فائلوں کے دوران. ڈاک CSV (علامت سے علیحدہ اقدار) ہے. آپ کو سب کچھ، بلکہ وائٹ لسٹ، بلیک لسٹ یا بھوری رنگ کی فہرست کے مقابلے میں اسکین کرنے کے لئے چاہتے ہیں، متغیر خالی چھوڑ؛ ایسا کرنے سے وائٹ لسٹ/بلیک لسٹ/سرمئی فہرست کو غیر فعال کریں گے.</li>
 <li><strong>پروسیسنگ کے منطقی حکم ہے:</strong></li>
 <ul>
 <li>قسم کی فائل کو وائٹ لسٹ میں ہے، تو اسکین نہیں اور فائل کو مسدود نہ کریں، اور بلیک لسٹ یا سرمئی فہرست خلاف کی فائل کو چیک نہیں کرتے.</li>
 <li>قسم کی فائل کو بلیک لسٹ کیا جاتا ہے تو، فائل کو اسکین نہیں لیکن بہرحال اس پر بلاک، اور سرمئی فہرست خلاف کی فائل کو چیک نہیں کرتے.</li>
 <li>سرمئی لسٹ خالی ھے یا سرمئی لسٹ خالی نہیں ہے اور قسم کی فائل سرمئی مندرج ہے تو، عام طور پر فی فائل کو اسکین اور اسکین کے نتائج کی بنیاد پر اسے مسدود کرنا چاہے تعین، لیکن بھوری رنگ لسٹ خالی نہیں ہے تو تو اور قسم کی فائل، درج ہوتا نہیں گرے بلیک لسٹ کے طور پر فائل کا علاج، اس وجہ سے اس کو سکین لیکن ویسے یہ مسدود نہیں.</li>
 </ul>
</ul></div>

##### <div dir="rtl">"check_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ابلیھاگاروں کے مندرجات کو چیک کرنے کی کوشش؟ False (جھوٹی) = چیک نہ کریں؛ True (سچے) = چیک کریں [پہلے سے طے شدہ].</li>
</ul></div>

&nbsp; <div dir="rtl" style="display:inline">شکل</div> | &nbsp; <div dir="rtl" style="display:inline">پڑھ سکتے ہیں</div> | &nbsp; <div dir="rtl" style="display:inline">دوبارہ پڑھ سکتے ہیں</div> | &nbsp; <div dir="rtl" style="display:inline">خفیہ کاری کا پتہ لگانا</div> | &nbsp; <div dir="rtl" style="display:inline">نوٹس</div>
---|---|---|---|---
Zip | ✔️ | ✔️ | ✔️ | &nbsp; <div dir="rtl" style="display:inline"><a href="http://php.net/manual/en/zip.requirements.php">libzip</a> کی ضرورت ہوتی ہے (عام طور پر PHP کے ساتھ شامل). بھی حمایت کی (zip فارمیٹ استعمال کرتا ہے): ✔️ OLE اعتراض کا سراغ لگانا. ✔️ آفس میکرو کا پتہ لگانا.</div>
Tar | ✔️ | ✔️ | ➖ | &nbsp; <div dir="rtl" style="display:inline">کوئی خاص ضروریات نہیں. فارمیٹ خفیہ کاری کی حمایت نہیں کرتا.</div>
Rar | ✔️ | ✔️ | ✔️ | &nbsp; <div dir="rtl" style="display:inline"><a href="https://pecl.php.net/package/rar">rar</a> توسیع کی ضرورت ہوتی ہے (جب یہ توسیع انسٹال نہیں ہے تو، phpMussel rar فائلوں کو پڑھ نہیں سکتے).</div>
7zip | ❌ | ❌ | ❌ | &nbsp; <div dir="rtl" style="display:inline">یہ ابھی تک نہیں سیکھا ہے.</div>
Phar | ❌ | ❌ | ❌ | &nbsp; <div dir="rtl" style="display:inline">سپورٹ v1.6.0 میں ہٹا دیا گیا ہے. محفوظ نہیں. دوبارہ شامل نہیں کیا جائے گا.</div>

<div dir="rtl">معاونت کا خیر مقدم ہے، اگر کوئی اسے بہتر بنانا چاہتا ہے.<br /><br /></div>

##### <div dir="rtl">"filesize_archives"<br /></div>
<div dir="rtl"><ul>
 <li>ابلیھاگاروں کے مندرجات کو فائل بلیک لسٹ/وہسلنگ لے؟ False (جھوٹی) = کوئی (صرف greylist سب کچھ)؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"filetype_archives"<br /></div>
<div dir="rtl"><ul>
 <li>قسم کی فائل بلیک لسٹ/دستاویز کے مندرجات کو وہسلنگ لے؟ False (جھوٹی) = کوئی (صرف greylist سب کچھ) [پہلے سے طے شدہ]؛ True (سچے) = جی ہاں.</li>
</ul></div>

##### <div dir="rtl">"max_recursion"<br /></div>
<div dir="rtl"><ul>
 <li>ابلیھاگاروں کے لئے زیادہ سے زیادہ تکرار کی گہرائی کی حد. پہلے سے طے شدہ = 3.</li>
</ul></div>

##### <div dir="rtl">"block_encrypted_archives"<br /></div>
<div dir="rtl"><ul>
 <li>پتہ لگانے اور مرموز آرکائیوز کو بلاک؟ کیونکہ phpMussel مرموز ابلیھاگاروں کے مندرجات کو اسکین کرنے کے قابل نہیں ہے، یہ ممکن ہے کہ محفوظ شدہ دستاویزات خفیہ کاری phpMussel، اینٹی وائرس سکینر اور ایسی دیگر تحفظات کو نظرانداز کرنے کی کوشش کرنے کا ایک ذریعہ کے طور پر ایک حملہ آور کی طرف سے ملازم ہو جائے. phpMussel جو مرموز جائے کرنے کو پتہ چلتا ہے کہ کسی بھی تاریخی دستاویز کو بلاک کرنے کی تربیت؛ ممکنہ طور پر یہ اس طرح کے امکانات کے ساتھ منسلک کسی بھی خطرے کو کم کرنے میں مدد کر سکتا ہے. False (جھوٹی) = کوئی؛ True (سچے) = جی ہاں [پہلے سے طے شدہ].</li>
</ul></div>

#### <div dir="rtl">"attack_specific" (قسم)<br /></div>
<div dir="rtl">حملہ مخصوص ہدایات.<br /><br /></div>

<div dir="rtl">گرگٹ حملے کا پتہ لگانے: False (جھوٹی) = بند؛ True (سچے) = پر.<br /><br /></div>

##### <div dir="rtl">"chameleon_from_php"<br /></div>
<div dir="rtl"><ul>
 <li>نہ تو PHP فائلوں کو نہ پہچان لیا آرکائیوز ہیں کہ فائلوں میں PHP ہیڈر تلاش کریں.</li>
</ul></div>

##### <div dir="rtl">"can_contain_php_file_extensions"<br /></div>
<div dir="rtl"><ul>
 <li>فائل کی توسیع کی ایک فہرست PHP کوڈ پر مشتمل ہونے کی اجازت دیتا ہے، جو کمم کے ذریعہ الگ ہوتی ہے. اگر PHP کی چیلنج حملے کا پتہ چلتا ہے تو، PHP کوڈ پر مشتمل فائلوں، جو اس فہرست پر مشتمل نہیں ہیں، اس PHP کی چیلنج حملوں کے طور پر پتہ چلا جائے گا.</li>
</ul></div>

##### <div dir="rtl">"chameleon_from_exe"<br /></div>
<div dir="rtl"><ul>
 <li>نہ تو چلنے نہ ہی تسلیم کیا آرکائیوز ہیں کہ فائلوں میں اور چلنے جن ہیڈرز غلط ہیں کے لئے کارکردگی قابل ہیڈر کے لئے تلاش کریں.</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_archive"<br /></div>
<div dir="rtl"><ul>
 <li>آرکائیو اور کمپریسڈ فائلوں میں غلط ہیڈر کا پتہ لگائیں. تائید: BZ/BZIP2، GZ/GZIP، LZF، RAR، ZIP</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_doc"<br /></div>
<div dir="rtl"><ul>
 <li>جس کا ہیڈرز ہیں غلط دفتر دستاویزات کے لئے تلاش کریں (تائید: DOC، ڈاٹ، پی پی ایس، PPT، XLA، XLS، جانکار).</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_img"<br /></div>
<div dir="rtl"><ul>
 <li>جس کا ہیڈرز غلط ہیں تصاویر کے لئے تلاش کریں (تائید: BMP، DIB، PNG، GIF، JPEG، JPG، XCF، PSD، PDD، WEBP.</li>
</ul></div>

##### <div dir="rtl">"chameleon_to_pdf"<br /></div>
<div dir="rtl"><ul>
 <li>پی ڈی ایف فائلوں جن ہیڈرز غلط ہیں کے لئے تلاش کریں.</li>
</ul></div>

##### <div dir="rtl">"archive_file_extensions"<br /></div>
<div dir="rtl"><ul>
 <li>تسلیم شدہ آرکائیو فائل ایکسٹنشن (شکل CSV ہے؛ مسائل پائے جاتے ہیں جب صرف شامل کرنے یا ہٹانے چاہئے؛ غیر ضروری طور پر ہٹانے کے بغیر وجہ انہوں نے مزید کہا کہ آپ حملے مخصوص پتہ لگانے سے اضافہ کر رہے ہیں کیا بنیادی طور پر وائٹ لسٹ گے جبکہ جھوٹے مثبت، ذخیرہ فائلوں کے لئے ظاہر کرنے کے لئے کی وجہ سے ہو سکتا ہے، کے ساتھ نظر ثانی احتیاط بھی نوٹ کریں کہ اس تاریخی دستاویز اور مواد کی سطح پر تجزیہ نہیں کیا جا سکتا کر سکتے ہیں پر کوئی اثر) ہے. فہرست، ڈیفالٹ میں ہے کے طور پر، نظام اور CMS کی اکثریت کے اس پار سب سے زیادہ عام طور پر استعمال والوں فارمیٹس کی فہرست، لیکن جان بوجھ ضروری جامع نہیں ہے.</li>
</ul></div>

##### <div dir="rtl">"block_control_characters"<br /></div>
<div dir="rtl"><ul>
 <li>کسی بھی کنٹرول حروف (نیولائنز علاوہ) استعمال میں کسی بھی فائلوں کو مسدود کریں؟ ("[\x00-\x08\x0b\x0c\x0e\x1f\x7f]") آپ ہو تو <strong><em>صرف</em></strong> اپ لوڈ سادہ ٹیکسٹ، تو آپ اس اختیار کو کچھ اضافی تحفظ فراہم کرنے کے لئے پر تبدیل کر سکتے ہیں آپ کے سسٹم. تاہم، اگر آپ کو سادہ متن کے علاوہ اور کچھ پر اس رخ جھوٹے مثبت نتیجے میں اپ لوڈ کریں. False (جھوٹی) = مسدود نہ کریں [پہلے سے طے شدہ]؛ True (سچے) = بلاک.</li>
</ul></div>

##### <div dir="rtl">"corrupted_exe"<br /></div>
<div dir="rtl"><ul>
 <li>خراب فائلوں اور غلطیوں کا تجزیہ. False (جھوٹی) = نظرانداز کریں. سچا = بلاک [پہلے سے طے شدہ]. پتہ لگانے اور ممکنہ طور پر خراب PE (پورٹ ایبل نفاذ پذیر) فائلوں کو بلاک؟ اکثر ایسا ہوتا ہے (لیکن ہمیشہ نہیں)، ایک PE فائل کے کچھ پہلوؤں کو خراب کر رہے ہیں یا صحیح طریقے سے پارس نہیں کیا جا سکتا ہے جب، یہ ایک وائرل انفیکشن کا اشارہ ہو سکتا ہے. سب سے زیادہ اینٹی وائرس پروگراموں کی طرف سے استعمال کیا جاتا ہے عمل PE فائلوں میں وائرس کا پتہ لگانے کے لئے ان کے وائرس undetected رہنے کی اجازت دینے کے لئے ہے، بعض طریقوں، ایک وائرس کے پروگرامر کے بارے میں معلوم ہو تو خاص طور پر روکنے کی کوشش کریں گے، جس میں ان فائلوں کی تصریف کی ضرورت ہوتی ہے.</li>
</ul></div>

##### <div dir="rtl">"decode_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>خام ڈیٹا جس کے اندر ڈیکوڈ کمانڈز کے پتہ جانی چاہئے کی لمبائی کے حد سے (کے معاملے میں کسی بھی نمایاں کارکردگی کے مسائل جبکہ سکیننگ سے ہیں). پہلے سے طے شدہ = 512KB. زیرو یا شہوت انگیز null قیمت (فائل کی بنیاد پر اس طرح کے کسی بھی حد کو ہٹانے کے) حد سے نااہل کیا.</li>
</ul></div>

##### <div dir="rtl">"scannable_threshold"<br /></div>
<div dir="rtl"><ul>
 <li>کہ phpMussel پڑھیں اور سکین کرنے کی اجازت ہے خام ڈیٹا کی لمبائی کی حد (کے معاملے میں کوئی نمایاں کارکردگی کے مسائل جبکہ سکیننگ ہیں). پہلے سے طے شدہ = 32MB. زیرو یا خالی قدر حد سے غیر فعال. عام طور پر، اس کی قیمت آپ چاہتے ہیں اور filesize_limit ہدایت کے مقابلے میں زیادہ نہیں ہونا چاہئے، آپ کے سرور یا ویب سائٹ کو حاصل کرنے کی توقع ہے کہ فائل اپ لوڈ کی اوسط فائل سے کم نہیں ہونا چاہئے، اور میں سے ایک تقریبا سے زیادہ پانچویں نہیں ہونا چاہئے کل قابل اجازت میموری مختص "php.ini" ترتیب دینے کی فائل کے ذریعے PHP کے لئے عطا کی. یہ ہدایت بہت زیادہ میموری کا استعمال کرتے ہوئے کی طرف سے phpMussel کو روکنے کے لئے کوشش کرنے کے لئے موجود ہے (کہ کامیابی کی ایک مخصوص فائل کے اوپر فائلوں کو اسکین کرنے کے قابل ہونے سے روکنے کروں گا).</li>
</ul></div>

##### <div dir="rtl">"allow_leading_trailing_dots"<br /></div>
<div dir="rtl"><ul>
 <li>فائلوں کے آغاز اور اختتام پر نقطہ نظر کی اجازت دیں؟ یہ کبھی کبھی استعمال کرنے کے لئے فائلوں کو چھپانے کے لئے، یا کچھ نظام کو ڈائل کرنے کے لئے استعمال کیا جا سکتا ہے ڈائرکٹری کے تبادلوں کی اجازت دیتا ہے. False (جھوٹی) = اجازت نہ دیں [پہلے سے طے شدہ]؛ True (سچے) = اجازت دیں.</li>
</ul></div>

##### <div dir="rtl">"block_macros"<br /></div>
<div dir="rtl"><ul>
 <li>میکروس پر مشتمل کسی بھی فائل کو روکنے کی کوشش کریں؟ کچھ قسم کے دستاویزات اور سپریڈ شیٹوں میں قابل عمل میکروس شامل ہوسکتا ہے، اس طرح ایک خطرناک ممکنہ میلویئر ویکٹر فراہم کرتا ہے. False (جھوٹی) = مسدود نہ کریں [پہلے سے طے شدہ]؛ True (سچے) = بلاک.</li>
</ul></div>

#### <div dir="rtl">"compatibility" (قسم)<br /></div>
<div dir="rtl">phpMussel لئے مطابقت ہدایات.<br /><br /></div>

##### <div dir="rtl">"ignore_upload_errors"<br /></div>
<div dir="rtl"><ul>
 <li>جب تک یہ آپ کی مخصوص نظام پر phpMussel کا صحیح فعالیت کے لئے ضروری ہے یہ ہدایت عام طور پر غیر فعال کر دیا جائے چاہئے. عام طور پر، جب معذور، phpMussel میں عناصر کی موجودگی کا پتہ لگاتا ہے جب <code dir="ltr">$_FILES</code> array(), یہ phpMussel ایک غلطی پیغام واپس آ جائیں گے، ان عناصر کو خالی یا خالی ہو تو، فائلوں ان عناصر کی نمائندگی کرتے ہیں کی ایک اسکین شروع کرنے کی کوشش کرتے ہیں، اور کرے گا. یہ phpMussel لئے مناسب رویہ ہے. تاہم، کچھ CMS کے لئے، میں خالی عناصر <code dir="ltr">$_FILES</code> وہاں نہ کوئی بھی ہوتے ہیں تو اس صورت میں، phpMussel لئے عام رویہ ان لوگوں CMS کے عام رویے کے ساتھ مداخلت کی جائے گی رپورٹ کیا جا سکتا ہے ان لوگوں کے CMS، یا غلطیوں کے قدرتی رویے کے نتیجے میں ہو سکتا ہے. ایک ایسی صورتحال نے اس وقت ہوتی ہے، تو اس اختیار کو چالو کرنے کے، phpMussel طرح خالی عناصر کے لئے علیحدہ اسکین کی ضرورت شروع کرنے کی کوشش نہ کرنے کی ہدایت دیں گے، اس طرح کے صفحے کی درخواست کے تسلسل کی اجازت دی چلا جب ان کو نظر انداز اور کسی بھی متعلقہ خرابی کے پیغامات واپس نہیں کرنا. False (جھوٹی) = بند؛ True (سچے) = ON.</li>
</ul></div>

##### <div dir="rtl">"only_allow_images"<br /></div>
<div dir="rtl"><ul>
 <li>آپ کو صرف امید رکھتے ہیں یا تو صرف تصاویر آپ کے سسٹم یا CMS پر اپ لوڈ کرنے کی اجازت دینے کا ارادہ رکھتے ہیں، اور آپ بالکل دوسرے کسی بھی فائلوں کی ضرورت نہیں ہے اگر تصاویر آپ کے سسٹم یا CMS پر اپ لوڈ کیا جا کرنے کی بجائے، اس حکم فعال کیا جانا چاہئے، لیکن ہونا چاہئے دوسری صورت میں غیر فعال کیا. اس ہدایت چالو حالت میں ہے، تو یہ phpMussel ہدایت اندھا دھند ان کی سکیننگ کے بغیر، غیر تصویری فائلوں کے طور پر شناخت کی کوئی بھی اپ لوڈز کو بلاک کرنے کے لئے کریں گے. یہ غیر تصویری فائلوں کی کوشش کی اپ لوڈ کے لئے پروسیسنگ کے وقت اور میموری استعمال کو کم کر سکتا ہے. False (جھوٹی) = بند؛ True (سچے) = ON.</li>
</ul></div>

#### <div dir="rtl">"heuristic" (قسم)<br /></div>
<div dir="rtl">انکشافی ہدایات.<br /><br /></div>

##### <div dir="rtl">"threshold"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel فائلوں کی مشکوک اور ممکنہ طور پر بدنیتی پر مبنی خصوصیات کی شناخت کے لئے ارادہ کر رہے ہیں کہ بعض دستخط موجود ہیں خود میں بغیر اپ لوڈ کیا جا رہا ہے ان فائلوں بدنیتی پر مبنی ہونے کے طور پر خاص طور پر اپ لوڈ کیا جا رہا ہے کی شناخت. یہ "دہلیز" قدر بتاتا ہے ان فائلوں درنساوناپورن کا جھنڈا لگا ہو رہے ہیں اس سے پہلے phpMussel فائلوں کی مشکوک اور ممکنہ طور پر بدنیتی پر مبنی خصوصیات کے زیادہ سے زیادہ کل وزن ہے کہ قابل اجازت ہے اپ لوڈ کیا جا رہا ہے. اس تناظر میں وزن کی تعریف کی شناخت مشکوک اور ممکنہ طور پر بدنیتی پر مبنی خصوصیات کی کل تعداد ہے. بنیادی طور پر، اس کی قیمت 3. ایک کم قیمت عام طور پر جھوٹے مثبت کے ایک اعلی موجودگی کے نتیجے میں جائے کرنے کے لئے مقرر کیا جائے گا لیکن بدنیتی پر مبنی فائلوں کی ایک بڑی تعداد جھنڈا لگایا جا رہا ہے، ایک زیادہ قیمت عام طور پر جھوٹے مثبت کی ایک کم موجودگی لیکن ایک کے نتیجے میں جائے جبکہ بدنیتی پر مبنی فائلوں کی کم تعداد جھنڈا لگایا جا رہا ہے. یہ آپ کو اس سے متعلق مسائل کا سامنا کر رہے ہیں جب تک کہ اس کا بنیادی میں اس قدر چھوڑنے کے لئے عام طور پر سب سے بہتر ہے.</li>
</ul></div>

#### <div dir="rtl">"virustotal" (قسم)<br /></div>
<div dir="rtl">VirusTotal.com ہدایات.<br /><br /></div>

##### <div dir="rtl">"vt_public_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>اختیاری، phpMussel وائرس، ٹروجن، میلویئر اور دیگر خطرات کے خلاف تحفظ کی ایک بہت بڑھا سطح فراہم کرنے کے لئے ایک طریقہ کے طور پر وائرس کل API کا استعمال کرتے ہوئے فائلوں کو اسکین کرنے کے قابل ہے. بطور ڈیفالٹ، سکیننگ فائلوں وائرس کل API کا استعمال غیر فعال ہے. یہ فعال کرنے کیلئے، وائرس کل سے ایک API کلید درکار ہے. اگر آپ کے ساتھ فراہم کر سکتے ہیں کہ اہم فائدہ کی وجہ سے، جو میں انتہائی چالو کرنے کی سفارش کرتے ہیں کہ کچھ ہے. براہ کرم آگاہ رہیں، تاہم، کہ وائرس کل API استعمال کرنے کے لئے، آپ کو <strong><em>ضروری</em></strong> ان سروس کی شرائط سے اتفاق کرتا ہوں اور تم <strong><em>ضروری</em></strong> مطابق وائرس کل دستاویزات کی طرف سے بیان تمام ہدایات پر عمل! تم جب تک یہ انضمام خصوصیت کو استعمال کرنے کی اجازت نہیں ہے:</li>
 <ul>
  <li>آپ کو پڑھ اور وائرس کل اور اس API کے سروس کی شرائط سے اتفاق کرتا ہوں. وائرس کل اور اس API کے سروس کی شرائط پایا جا سکتا ہے <a href="https://www.virustotal.com/en/about/terms-of-service/">یہاں</a>.</li>
  <li>آپ نے پڑھا ہے اور آپ کو ایک کم از کم، سمجھنے، وائرس کل پبلک API دستاویزات کا کردار (بعد "VirusTotal Public API v2.0" لیکن "Contents" سے پہلے سب کچھ). Virus Total پبلک API دستاویزات پایا جا سکتا ہے <a href="https://www.virustotal.com/en/documentation/public-api/">یہاں</a>.</li>
 </ul>
</ul></div>

<div dir="rtl">نوٹ: وائرس کل API غیر فعال ہے کا استعمال کرتے ہوئے فائلوں کو سکین تو، آپ کو اس زمرے میں ہدایت میں سے کسی پر نظرثانی کرنے کی ضرورت نہیں کرے گا ("virustotal")، اس غیر فعال ہو تو ان میں سے کوئی کچھ بھی کرے گا کیونکہ. ان کی ویب سائٹ پر کسی بھی جگہ سے، ایک وائرس کل API کلید حاصل کرنے کے لئے،، صفحے کے سب سے اوپر دائیں جانب واقع "ہماری کمیونٹی میں شامل" کے لنک پر کلک کر درخواست کی معلومات میں درج کریں، اور کلک کریں "سائن اپ" کیا جب. فراہم کی تمام ہدایات پر عمل کریں، اور آپ اپنے عوامی API کلید، کاپی/پیسٹ <code dir="ltr">config.ini</code> کنفیگریشن فائل کے<code dir="ltr">vt_public_api_key</code> ہدایت ہے کہ عوامی API کلید مل گیا ہے جب.<br /><br /></div>

##### <div dir="rtl">"vt_suspicion_level"<br /></div>
<div dir="rtl"><ul>
 <li>ڈیفالٹ کی طرف سے، phpMussel جس فائلوں کی یہ "مشکوک" سمجھتی ہے کہ ان فائلوں کو وائرس کل API کا استعمال کرتے ہوئے کو سکین کرتا ہے کو محدود کریں گے. آپ اختیاری <code dir="ltr">vt_suspicion_level</code> ہدایت کی قدر میں تبدیلی کرتے ہوئے اس پابندی کو ایڈجسٹ کر سکتے ہیں.</li>
 <li>"0": فائلیں صرف phpMussel اس کے اپنے دستخط کا استعمال کرتے ہوئے کی طرف سے سکین کیا جا رہا ہے کے بعد، اگر مشکوک سمجھا جاتا ہے، وہ ایک انکشافی وزن لے جانے کے لئے تصور کیا جاتا ہے. یہ مؤثر طریقے سے وائرس کل API لئے جب phpMussel ایک فائل ممکنہ طور پر بدنیتی پر مبنی ہو سکتا ہے کہ شبہ ہے ایک دوسرے کی رائے کے لئے ہو جائے گا کے اس کے استعمال کا مطلب ہو گا، لیکن مکمل طور پر یہ بھی ممکنہ طور پر سومی (غیر درنساوناپورن) ہو سکتا ہے کو مسترد نہیں کر سکتے ہیں اور اس وجہ سے دوسری صورت میں عام طور پر بدنیتی پر مبنی ہونے کے طور پر اس کا یا اس پر پرچم لگا مسدود نہ کریں گے.</li>
 <li>"1": فائلیں اس کے اپنے دستخط کا استعمال کرتے ہوئے phpMussel طرف سے سکین کیا جا رہا ہے کے بعد، اگر مشکوک سمجھا جاتا ہے، وہ (ایگزیکیوٹیبل ہو جانا جاتا رہے تو PE فائلوں، مچھ-O فائلیں، ایک انکشافی وزن لے جانے کے لئے تصور کیا جاتا ہے، تیر/لینکس فائلوں، وغیرہ)، یا وہ ایک شکل ہے کہ ممکنہ طور پر کارکردگی کا ڈیٹا (جیسے جیسے RARs، زپ اور وغیرہ) کارکردگی میکرو، DOC/DOCX فائلوں، ذخیرہ فائلوں پر مشتمل کر سکتے کے طور پر جانا جاتا رہے ہیں. یہ مؤثر طریقے سے وائرس کے استعمال کل API جب phpMussel ابتدائی طور پر بدنیتی پر مبنی یا ایک فائل جو مشکوک ہونے کے لئے اور اس وجہ سے کرے گا سمجھتی ہے کہ ساتھ کچھ غلط کچھ بھی نہیں کرتا ہے کے لئے ایک دوسرے کی رائے کے لئے ہو جائے گا کہ جس کا مطلب لاگو کرنے کے لئے پہلے سے طے شدہ اور سفارش شبہ سطح ہے دوسری صورت میں عام طور پر یہ یا بدنیتی پر مبنی ہونے کے طور پر پرچم لگا مسدود نہ.</li>
 <li>"2": تمام فائلوں کو مشکوک سمجھا جاتا ہے اور وائرس کل API کا استعمال کرتے ہوئے اسکین کیا جانا چاہئے. میں عام طور پر بہت تیز وگرنہ صورت ہو گا کے مقابلے میں آپ API کوٹہ پہنچنے کے خطرے کی وجہ سے، اس شک کی سطح کا اطلاق کرنے کی سفارش نہیں کرتے، لیکن بعض حالات (جیسا کہ ویب ماسٹر یا hostmaster میں بہت کم ایمان یا اعتماد جو کچھ ہے جب سے ہیں ان صارفین کی اپ لوڈ کردہ مواد) اس شک کی سطح پر مناسب ہو سکتا ہے جہاں کے کسی بھی. اس شک کی سطح کے ساتھ، تمام فائلوں کو عام طور پر مسدود یا جھنڈا لگایا نہیں بدنیتی پر مبنی ہونے کی وجہ سے وائرس کل API کا استعمال کرتے ہوئے اسکین کیا جائے گا. نوٹ، تاہم، phpMussel اپنے API کوٹہ (قطع نظر اس شک کی سطح کی) تک پہنچ گیا ہے جب وائرس کل API کا استعمال ختم ہو جائے گا، اور اس شک کی سطح کا استعمال کرتے وقت آپ کے کوٹے کا امکان زیادہ تیزی سے تک پہنچ جائے گی.</li>
</ul></div>

<div dir="rtl">نوٹ: قطع شبہ سطح کے، یا تو phpMussel طرف سے بلیک لسٹ یا وائٹ لسٹ کر رہے ہیں کہ کسی بھی فائلوں وائرس کل API کا استعمال کرتے ہوئے اسکین نہیں کیا جائے گا، ان لوگوں کو اس طرح کی فائلوں کو پہلے ہی وقت کی طرف سے phpMussel طرف درنساوناپورن یا سومی یا تو کے طور پر اعلان کیا گیا ہے گی کیونکہ کہ وہ دوسری صورت میں وائرس کل API کی طرف سے سکین کریں گے لیا ہے کیا گیا ہے، اور اس وجہ سے، اضافی سکیننگ کی ضرورت نہیں ہو گی. وائرس کل API کا استعمال کرتے ہوئے فائلوں کو اسکین کرنے phpMussel کی صلاحیت ہے کہ آیا ایک فائل درنساوناپورن یا ان حالات میں جہاں phpMussel خود چاہے ایک فائل درنساوناپورن یا سومی ہے کرنے کے طور پر مکمل طور پر یقین نہیں ہے میں سومی ہے کے لئے مزید اعتماد کی تعمیر کرنا ہے.<br /><br /></div>

##### <div dir="rtl">"vt_weighting"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel کا پتہ لگانے کے کر کے طور پر یا پتہ لگانے وزن کے طور وائرس کل API کا استعمال کرتے ہوئے سکیننگ کے نتائج کو درخواست دینی چاہیے؟ (اور بدنیتی پر مبنی فائلوں کی ایک بڑی تعداد پکڑے جانے لہذا میں) ایک سے زیادہ کے انجن کو استعمال کرتے ہوئے (جیسا وائرس کل کرتا ہے) ایک فائل کو سکین ایک اضافہ کا پتہ لگانے کی شرح کے نتیجے چاہئے، اگرچہ، یہ بھی جھوٹے کی زیادہ تعداد کے نتیجے کر سکتے ہیں، کیونکہ یہ ہدایت موجود ہے، مثبت ہے، اور اس وجہ سے، کچھ حالات میں، سکیننگ کے نتائج بہتر ایک حتمی نتیجے پر اس اعتماد کا سکور کے طور پر کی بجائے استعمال کیا جا سکتا ہے. 0 کی قدر استعمال کیا جاتا ہے تو، وائرس کل API کا استعمال کرتے ہوئے سکیننگ کے نتائج کسی بھی انجن وائرس کل پرچم فائل کو بدنیتی پر مبنی ہونے کے طور پر سکین کیا جا رہا ہے کی طرف سے استعمال کیا تو اس کا پتہ لگانے کے طور پر لاگو کیا جائے گا، اور اس وجہ سے، phpMussel بدنیتی پر مبنی ہونے کے لئے فائل پر غور کریں گے. کسی دوسرے کی قدر استعمال کیا جاتا ہے تو، وائرس کل API کا استعمال کرتے ہوئے سکیننگ کے نتائج کا پتہ لگانے وزن کے طور پر لاگو کیا جائے گا، اور اس وجہ سے، فائل پرچم کہ وائرس کل کی طرف سے استعمال کے انجن کی تعداد سکین کیا جا رہا ہے درنساوناپورن ہونے (ایک اعتماد سکور کے طور پر کام کرے گا کے طور پر یا پتہ لگانے وزن کے) کے لئے ہے یا نہیں کی فائل کو سکین کیا جا رہا phpMussel طرف بدنیتی پر مبنی سمجھا جانا چاہئے (استعمال کیا کم از کم اعتماد کی نمائندگی کریں گے ویلیو سکور یا ترتیب میں کی ضرورت وزن بدنیتی پر مبنی سمجھا جائے). 0 کی قدر سے طے شدہ کی طرف سے استعمال کیا جاتا ہے.</li>
</ul></div>

<div dir="rtl">"vt_quota_rate" اور "vt_quota_time"<br /></div>
<div dir="rtl"><ul>
 <li>وائرس کل API دستاویزات کے مطابق، "یہ کسی بھی 1 منٹ ٹائم فریم میں کسی بھی نوعیت کی زیادہ سے زیادہ 4 درخواستوں تک محدود ہے آپ کو ایک honeyclient، honeypot یا VirusTotal کی اور نہ کرنے کے لئے وسائل فراہم کرنے کے لئے کی جا رہی ہے کہ کسی دوسرے آٹومیشن چلاتے ہیں تو. صرف رپورٹیں آپ کو ایک اعلی کی درخواست کی شرح کوٹہ" کے حقدار ہیں بازیافت. بطور ڈیفالٹ، phpMussel سختی سے ان حدود پر عمل کرے گا، لیکن ان کی شرح کوٹہ کے امکان میں اضافہ کیا جا رہا ہے کی وجہ سے، ان دو ہدایات آپ اس پر کیا عمل کرنا چاہئے محدود کرنے کے طور phpMussel ہدایت کرنے کے لئے ایک وسیلہ کے طور پر فراہم کی جاتی ہیں. جب تک آپ کو ایسا کرنے کی ہدایت کی گئی ہے، یہ آپ کو ان اقدار کو کم، آپ کو آپ کی شرح کوٹہ پہنچنے سے متعلق مسائل کا سامنا کرنا پڑا ہے تو، ان اقدار میں اضافہ کرنے کے لئے، لیکن کبھی کبھی آپ نمٹنے میں مدد مل سکتی ہے کی سفارش کی نہیں ہے ان مسائل کے ساتھ. آپ کی شرح کی حد کسی بھی 'vt_quota_time' منٹ ٹائم فریم میں کسی بھی نوعیت کی 'vt_quota_rate' درخواستوں کے طور پر مقرر کیا جاتا ہے.</li>
</ul></div>

#### <div dir="rtl">"urlscanner" (قسم)<br /></div>
<div dir="rtl">میں ایک یو آر ایل سکینر phpMussel کے ساتھ شامل، سکین کسی بھی ڈیٹا یا فائلوں کے اندر سے درنساوناپورن یو آر ایل کا پتہ لگانے کی صلاحیت رکھتا.<br /><br /></div>

<div dir="rtl">نوٹ: یو آر ایل سکینر غیر فعال ہے تو، آپ کو اس غیر فعال ہے اگر ان میں سے کوئی کچھ بھی کرے گا، کیونکہ اس زمرے ("urlscanner") میں ہدایت میں سے کسی پر نظرثانی کرنے کی ضرورت نہیں کرے گا.<br /><br /></div>

<div dir="rtl">URL سکینر API لک اپ ترتیب.<br /><br /></div>

##### <div dir="rtl">"lookup_hphosts"<br /></div>
<div dir="rtl"><ul>
 <li>صحیح پر مقرر کرتے وقت <a href="http://hosts-file.net/">hpHosts</a> API کے لئے API لک اپ فعال کرتا ہے. hpHosts API لک اپ کو انجام کے لئے ایک API کلید کی ضرورت نہیں ہے.</li>
</ul></div>

##### <div dir="rtl">"google_api_key"<br /></div>
<div dir="rtl"><ul>
 <li>ضروری API کلید وضاحت کی گئی ہے جب گوگل محفوظ براؤزنگ API کو API لک اپ فعال کرتا ہے. گوگل محفوظ براؤزنگ API لک اپ <a href="https://console.developers.google.com/">یہاں</a> سے حاصل کیا جا سکتا ہے جس میں ایک API کلید کی ضرورت ہے.</li>
 <li>نوٹ: cURL توسیع اس خصوصیت کو استعمال کرنے کے لئے ضروری ہے.</li>
</ul></div>

##### <div dir="rtl">"maximum_api_lookups"<br /></div>
<div dir="rtl"><ul>
 <li>انفرادی اسکین تکرار کے مطابق انجام دینے کے لئے API لک اپ کی زیادہ سے زیادہ قابل اجازت تعداد. ہر اضافی API لک اپ ہر ایک اسکین تکرار مکمل کرنے کی ضرورت کل وقت کا اضافہ کریں گے، لہذا آپ کو مجموعی طور پر اسکین کے عمل کو تیز کرنے کے لئے ایک حد مقرر کر سکتے ہیں. 0 مقرر کرتے وقت، کوئی ایسی زیادہ سے زیادہ قابل اجازت تعداد میں لاگو کیا جائے گا. پہلے سے طے شدہ کی طرف سے 10 مقرر کریں.</li>
</ul></div>

##### <div dir="rtl">"maximum_api_lookups_response"<br /></div>
<div dir="rtl"><ul>
 <li>API لک اپ کی زیادہ سے زیادہ قابل اجازت تعداد سے تجاوز کر جاتا ہے تو کیا کیا جائے؟ False (جھوٹی) = کچھ بھی نہیں (پروسیسنگ جاری رہے) [پہلے سے طے شدہ] ہو؛ True (سچے) = فلیگ/بلاک فائل.</li>
</ul></div>

##### <div dir="rtl">"cache_time"<br /></div>
<div dir="rtl"><ul>
 <li>کب تک (سیکنڈوں میں) API لک اپ کے نتائج کے لئے محفوظ ہو جائے چاہئے؟ پہلے سے طے شدہ 3600 سیکنڈ (1 گھنٹہ) ہے.</li>
</ul></div>

#### <div dir="rtl">"legal" (قسم)<br /></div>
<div dir="rtl">قانونی ضروریات سے متعلق ترتیب.<br /><br /></div>

<div dir="rtl">قانونی ضروریات کے بارے میں مزید معلومات کے لئے اور یہ آپ کی ترتیبات کی ضروریات کو کس طرح اثر انداز کر سکتا ہے، براہ کرم دستاویزات کے "<a href="#SECTION11">قانونی معلومات</a>" حصے کا حوالہ دیتے ہیں.<br /><br /></div>

##### <div dir="rtl">"pseudonymise_ip_addresses"<br /></div>
<div dir="rtl"><ul>
 <li>لاگ ان کرتے وقت پی ایس ڈی نامناسب IP پتے؟ True (سچے) = جی ہاں؛ False (جھوٹی) = نہیں [پہلے سے طے شدہ].</li>
</ul></div>

##### <div dir="rtl">"privacy_policy"<br /></div>
<div dir="rtl"><ul>
 <li>کسی بھی پیدا کردہ صفحات کے فوٹر میں ظاہر ہونے والی متعلقہ رازداری کی پالیسی کا پتہ. ایک URL کی وضاحت کریں، یا غیر فعال کرنے کیلئے خالی چھوڑ دیں.</li>
</ul></div>

#### <div dir="rtl">"template_data" (قسم)<br /></div>
<div dir="rtl">سانچوں اور موضوعات کے لئے ہدایات/متغیر.<br /><br /></div>

<div dir="rtl">"رسائی نہیں ہوئی" کے صفحے پیدا کرنے کے لئے استعمال HTML پیداوار سے متعلق ہے. آپ phpMussel لئے اپنی مرضی کے موضوعات کا استعمال کرتے ہوئے کر رہے ہیں، ایچ ٹی ایم ایل کی پیداوار <code dir="ltr">template_custom.html</code> فائل سے کیے جاتا ہے، اور دوسری صورت میں، HTML پیداوار <code dir="ltr">template.html</code> فائل سے کیے جاتا ہے. ترتیب فائل کے اس شعبہ کو لکھا تغیر اسی متغیر ڈیٹا کے ساتھ ایچ ٹی ایم ایل کی پیداوار کے اندر اندر پایا گھوبگھرالی بریکٹ طرف circumfixed کوئی بھی متغیرہ کے ناموں کی جگہ کی راہ کی طرف HTML پیداوار میں پارس کر رہے ہیں. مثال کے طور پر، جہاں <code dir="ltr">foo="bar"</code> بار کے کسی بھی مثال <code dir="ltr">&lt;p&gt;{foo}&lt;/p&gt;</code> HTML پیداوار کے اندر اندر پایا بن جائے گا <code dir="ltr">&lt;p&gt;bar&lt;/p&gt;</code>.<br /><br /></div>

##### <div dir="rtl">"theme"<br /></div>
<div dir="rtl"><ul>
 <li>phpMussel لئے استعمال کرنے کے لئے مرکزی خیال، موضوع پہلے سے طے شدہ.</li>
</ul></div>

##### <div dir="rtl">"Magnification"<br /></div>
<div dir="rtl"><ul>
 <li>فونٹ اضافہ. پہلے سے طے شدہ = 1.</li>
</ul></div>

##### <div dir="rtl">"css_url"<br /></div>
<div dir="rtl"><ul>
 <li>ڈیفالٹ تھیم کے لئے سانچے کی فائل اندرونی سی ایس ایس خصوصیات کا استعمال، جبکہ اپنی مرضی کے موضوعات کے لئے سانچے کی فائل، خارجی سی ایس ایس خصوصیات کا استعمال. اپنی مرضی کے موضوعات کے لئے سانچے کی فائل کو استعمال کرنے phpMussel ہدایت کرنے کے لئے، "css_url" متغیر کا استعمال کرتے ہوئے آپ کی اپنی مرضی کے موضوع کی سی ایس ایس فائلوں کے عوامی HTTP ایڈریس کی وضاحت. آپ کو اس متغیر خالی چھوڑ تو، phpMussel ڈیفالٹ تھیم کے لئے سانچے کی فائل کو استعمال کریں گے.</li>
</ul></div>

#### <div dir="rtl">"PHPMailer" (قسم)<br /></div>
<div dir="rtl">PHPMailer ترتیب.<br /><br /></div>

##### <div dir="rtl">"EventLog"<br /></div>
<div dir="rtl"><ul>
 <li>PHPMailer کے سلسلے میں تمام واقعات کو لاگ ان کرنے کے لئے ایک فائل. ایک فائل کا نام کی وضاحت کریں، یا غیر فعال کرنے کو خالی چھوڑ.</li>
</ul></div>

##### <div dir="rtl">"SkipAuthProcess"<br /></div>
<div dir="rtl"><ul>
 <li>جب <code dir="ltr">true</code>، SMTP کی تصدیق کے عمل کو چھوڑ دیا گیا ہے. اس سے بچنا چاہئے. اگر عمل ختم ہو جاتا ہے تو، آؤٹ باؤنڈ ای میل MITM حملوں سے بے نقاب ہوسکتا ہے. مخصوص معاملات میں ضروری ہوسکتا ہے (مثال کے طور پر، جب SMTP سرور مناسب طریقے سے منسلک نہیں کرے گا).</li>
</ul></div>

##### <div dir="rtl">"Enable2FA"<br /></div>
<div dir="rtl"><ul>
 <li>یہ تعین کرتا ہے کہ 2FA استعمال کیا جانا چاہئے.</li>
</ul></div>

##### <div dir="rtl">"Host"<br /></div>
<div dir="rtl"><ul>
 <li>آؤٹ پاؤنڈ ای میل کے لئے استعمال کرنے کے لئے SMTP میزبان.</li>
</ul></div>

##### <div dir="rtl">"Port"<br /></div>
<div dir="rtl"><ul>
 <li>آؤٹ پاؤنڈ ای میل کے لئے استعمال کرنے کے لئے پورٹ نمبر. پہلے سے طے شدہ = 587.</li>
</ul></div>

##### <div dir="rtl">"SMTPSecure"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے پر پروٹوکول استعمال کرنے کے لئے (TLS یا SSL).</li>
</ul></div>

##### <div dir="rtl">"SMTPAuth"<br /></div>
<div dir="rtl"><ul>
 <li>کیا SMTP سیشن کو مستند کیا جاسکتا ہے؟ (عام طور پر اس کو نظر انداز کرنا چاہئے).</li>
</ul></div>

##### <div dir="rtl">"Username"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے کے لئے صارف کا نام.</li>
</ul></div>

##### <div dir="rtl">"Password"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے کے لئے پاس ورڈ.</li>
</ul></div>

##### <div dir="rtl">"setFromAddress"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے کے لئے بھیجنے والے کا پتہ.</li>
</ul></div>

##### <div dir="rtl">"setFromName"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے کے لئے بھیجنے کا نام.</li>
</ul></div>

##### <div dir="rtl">"addReplyToAddress"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے پر جواب کا پتہ.</li>
</ul></div>

##### <div dir="rtl">"addReplyToName"<br /></div>
<div dir="rtl"><ul>
 <li>ای میل بھیجنے پر جواب کا نام.</li>
</ul></div>

---


### <div dir="rtl">٨. <a name="SECTION8"></a>دستخط فارمیٹ</div>

<div dir="rtl">بھی دیکھو:<br /></div>
<div dir="rtl"><ul>
 <li><a href="#WHAT_IS_A_SIGNATURE">ایک "دستخط" کیا ہے؟</a></li>
</ul></div>

<div dir="rtl">پہلا 9 بائٹس <code dir="ltr">[x0-x8]</code> phpMussel دستخط فائل کی <code dir="ltr">phpMussel</code> ہے، اور "جادو نمبر"(magic number) کے طور پر کام کرتے ہیں، انہیں دستخط شدہ فائلوں کے طور پر شناخت کرنے کے لئے (اس فائلوں کا استعمال کرتے ہوئے حادثے سے بچنے میں مدد ملتی ہے جو دستخط شدہ فائلوں میں نہیں ہیں). اگلے بائٹ <code dir="ltr">[x9]</code> دستخط فائل کی قسم کی شناخت کرتا ہے، دستخط فائل کو سمجھنے کے قابل ہونے کے لئے ضروری ہے. مندرجہ ذیل قسم کے دستخط فائلوں کو تسلیم کیا جاتا ہے:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline">قسم</div> | <div dir="rtl" style="display:inline">بائٹ</div> | <div dir="rtl" style="display:inline">تفصیل</div>
---|---|---
`General_Command_Detections` | `0?` | <div dir="rtl" style="display:inline">"کوما علیحدہ اقدار" دستخط فائلوں کے لئے. دستخط فائلوں کے اندر اندر تلاش کرنے کے لئے ہییکسڈیکیلٹ - انکوڈ کرنگ ہیں. یہاں دستخط کسی نام یا دیگر تفصیلات نہیں ہیں (پتہ لگانے کے لئے صرف تار).</div>
`Filename` | `1?` | <div dir="rtl" style="display:inline">فائل نام کے دستخط کے لئے.</div>
`Hash` | `2?` | <div dir="rtl" style="display:inline">ہش دستخط کے لئے.</div>
`Standard` | `3?` | <div dir="rtl" style="display:inline">دستخط کی فائلوں کے لئے جو براہ راست فائل فائل کے ساتھ کام کرتی ہے.</div>
`Standard_RegEx` | `4?` | <div dir="rtl" style="display:inline">دستخط کی فائلوں کے لئے جو براہ راست فائل فائل کے ساتھ کام کرتی ہے. دستخط باقاعدگی سے اظہار میں شامل ہوسکتے ہیں.</div>
`Normalised` | `5?` | <div dir="rtl" style="display:inline">دستخط کردہ فائلوں کے لئے جو معمولی فائل کے مواد کے ساتھ کام کرتی ہے.</div>
`Normalised_RegEx` | `6?` | <div dir="rtl" style="display:inline">دستخط کردہ فائلوں کے لئے جو معمولی فائل کے مواد کے ساتھ کام کرتی ہے. دستخط باقاعدگی سے اظہار میں شامل ہوسکتے ہیں.</div>
`HTML` | `7?` | <div dir="rtl" style="display:inline">دستخط فائلوں کے لئے جو HTML مواد کے ساتھ کام کرتا ہے.</div>
`HTML_RegEx` | `8?` | <div dir="rtl" style="display:inline">دستخط فائلوں کے لئے جو HTML مواد کے ساتھ کام کرتا ہے. دستخط باقاعدگی سے اظہار میں شامل ہوسکتے ہیں.</div>
`PE_Extended` | `9?` | <div dir="rtl" style="display:inline">پی ایچ میٹ میٹاٹا کے ساتھ کام کرنے والی دستخط کی فائلوں کے لئے.</div>
`PE_Sectional` | `A?` | <div dir="rtl" style="display:inline">پی ایچ سیکشنل میٹا ڈیٹا کے ساتھ کام کرنے والی دستخط کی فائلوں کے لئے.</div>
`Complex_Extended` | `B?` | <div dir="rtl" style="display:inline">دستخط فائلوں کے لئے جو وسیع قوانین کے ساتھ وسیع پیمانے پر میٹا ڈیٹا ڈیٹا پر مبنی کام کرتی ہیں.</div>
`URL_Scanner` | `C?` | <div dir="rtl" style="display:inline">سائن ان فائلوں کے لئے جو URL کے ساتھ کام کرتی ہیں.</div>

<div dir="rtl">اگلے بائٹ <code dir="ltr">[x10]</code> ایک نیا لائن ہے <code dir="ltr">[0A]</code>.<br /><br /></div>

<div dir="rtl">اس کے بعد ہر غیر خالی لائن ایک دستخط یا حکمرانی ہے. ہر دستخط یا قاعدہ ایک لائن پر قبضہ کرتی ہے. معاون دستخط کی حمایت ذیل میں بیان کی گئی ہے.<br /><br /></div>

#### <div dir="rtl"><em>فائل کا نام دستخط</em></div>
<div dir="rtl">تمام فائل کا نام دستخطوں کی شکل پر عمل کریں:<br /><br /></div>

`NAME:FNRX`

<div dir="rtl">NAME کہاں کہ دستخط کے لئے پیش کرنے کے لئے نام ہے اور FNRX اسم مسل (انکوڈنگ نہیں) خلاف سے ملنے کے لئے رگ نمونہ ہے.<br /><br /></div>

#### <div dir="rtl"><em>ہش دستخط</em></div>
<div dir="rtl">تمام ہش دستخط شکل پر عمل کریں:<br /><br /></div>

`HASH:FILESIZE:NAME`

<div dir="rtl">کہاں ہیش ایک پوری فائل کی ہش ہیش ہے (عام طور پر MD5)، FILESIZE وہ فائل کا مجموعی حجم ہے اور NAME کہ دستخط کے لئے پیش کرنے کے لئے نام ہے.<br /><br /></div>

#### <div dir="rtl"><em>PE تخباگیی دستخط</em></div>
<div dir="rtl">تمام PE تخباگیی دستخط شکل پر عمل کریں:<br /><br /></div>

`SIZE:HASH:NAME`

<div dir="rtl">کہاں ہیش ایک PE فائل کے ایک حصے کی MD5 ہیش ہے، SIZE اس حصے کا مجموعی حجم ہے اور NAME کہ دستخط کے لئے پیش کرنے کے لئے نام ہے.<br /><br /></div>

#### <div dir="rtl"><em>PE توسیع دستخط</em></div>
<div dir="rtl">تمام PE توسیع کر دستخطوں کی شکل پر عمل کریں:<br /><br /></div>

`$VAR:HASH:SIZE:NAME`

<div dir="rtl">$VAR کہاں کیخلاف سے ملنے کے لئے پیئ متغیر کا نام ہے، ہیش کہ متغیر کی MD5 ہیش، SIZE کہ متغیر کا مجموعی حجم ہے اور NAME کہ دستخط کے لئے پیش کرنے کے لئے نام ہے.<br /><br /></div>

#### <div dir="rtl"><em>پیچیدہ بڑھا دیا دستخط</em></div>
<div dir="rtl">کمپلیکس توسیعی دستخط وہ خود کے خلاف دستخطوں کی طرف سے مخصوص کیا جاتا ہے کے ملاپ کر رہے ہیں کہ میں phpMussel ساتھ ممکن دستخط کے دیگر اقسام کے بجائے مختلف ہیں اور وہ متعدد معیارات کے خلاف میچ کر سکتے ہیں. میچ کے criterias کی طرف سے محدود رہے ہیں "؛" اور ہر میچ کا کلیہ کی طرف سے محدود کیا جاتا ہے کے ملاپ کی قسم اور میچ کے اعداد و شمار ":" کے طور پر تو ان کے دستخط کے لئے اس کی شکل کی طرح تھوڑا سا نظر جاتا:<br /><br /></div>

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

#### <div dir="rtl"><em>باقی سب کچھ</em></div>
<div dir="rtl">دیگر تمام دستخطوں کی شکل پر عمل کریں:<br /><br /></div>

`NAME:HEX:FROM:TO`

<div dir="rtl">کہاں کا نام ہے کہ دستخط کے لئے پیش کرنے کے لئے نام ہے اور HEX دیا دستخط کی طرف سے ملائے جا کرنا فائل کی ایک شش اعشاری انکوڈنگ طبقہ ہے. FROM اور کرنے کا اشارہ، اختیاری پیرامیٹرز ہیں جس کے خلاف جانچ کرنا ماخذ ڈیٹا میں عہدوں کے لئے اور جس میں سے.<br /><br /></div>

#### <div dir="rtl"><em>رگ</em></div>
<div dir="rtl">رگ کی کسی بھی شکل سمجھا اور صحیح طریقے سے PHP کی طرف سے کارروائی بھی صحیح phpMussel اور اس کے دستخط کی طرف سے سمجھ اور اس پر عملدرآمد کیا جانا چاہئے. تاہم، میں نے نئے رگ بنیاد پر دستخط لکھنے جب، انتہائی احتیاط لینے کیا آپ کیا کر رہے ہیں مکمل طور پر یقین نہیں ہے تو، کیونکہ مشورہ تھا، انتہائی فاسد اور/یا غیر متوقع نتائج ہو جائے کر سکتے ہیں. phpMussel منبع کوڈ پر ایک نظر ڈالیں آپ سیاق و سباق ہے جس میں رگ بیانات تصریف کر رہے ہیں کے بارے میں مکمل طور پر یقین نہیں ہیں تو. اس کے علاوہ، کہ تمام نمونوں (فائل نام، ذخیرہ میٹاڈیٹا اور MD5 نمونوں کو رعایت کے ساتھ) شش اعشاری (کورس کی، پوروگامی پیٹرن نحو) انکوڈنگ جائے ضروری ہے یاد رکھنا!<br /><br /></div>

---


### <div dir="rtl">٩. <a name="SECTION9"></a>جانا جاتا مطابقت کے مسائل</div>

#### <div dir="rtl">PHP اور PCRE</div>

<div dir="rtl">phpMussel صحیح PHP اور PCRE پر عمل کرنے اور تقریب کی ضرورت ہے. PHP کے بغیر، یا PHP کی PCRE توسیع کے بغیر، phpMussel پھانسی یا صحیح طریقے سے کام نہیں کرے گا. پہلے ڈاؤن لوڈ کرنے اور phpMussel نصب کرنے سے آپ کے سسٹم PHP اور PCRE دونوں نصب ہے اس بات کا یقین اور دستیاب بنانا چاہئے.<br /><br /></div>

#### <div dir="rtl">اینٹی وائرس سافٹ ویئر کی مطابقت</div>

<div dir="rtl">زیادہ تر حصے کے لیے، phpMussel سب سے زیادہ دیگر وائرس سکیننگ سافٹ ویئر کے ساتھ کافی ہم آہنگ ہونا چاہئے. تاہم، تنازعات ماضی میں صارفین کی ایک بڑی تعداد کی طرف سے رپورٹ کیا گیا ہے. یہ معلومات ذیل میں VirusTotal.com سے ہے، اور یہ جھوٹے مثبت phpMussel خلاف مختلف اینٹی وائرس پروگرام کی طرف سے رپورٹ کی ایک بڑی تعداد کی وضاحت. یہ معلومات آپ phpMussel اور آپ کے اینٹی وائرس سافٹ ویئر کے درمیان مطابقت کے مسائل کا سامنا کریں گے یا نہیں کا ایک مکمل ضمانت نہیں ہے، اگرچہ، آپ کے اینٹی وائرس سافٹ ویئر phpMussel خلاف پرچم لگانے کے طور پر بیان کیا گیا ہے تو، آپ کے ساتھ کام کرنے سے پہلے اس کو غیر فعال کرنے کے بارے میں غور کرنا چاہئے یا تو phpMussel یا آپ کے اینٹی وائرس سافٹ ویئر یا phpMussel یا تو کرنے کے لئے متبادل آپشنز پر غور کرنا چاہئے.<br /><br /></div>

<div dir="rtl">یہ معلومات کی آخری تازہ کاری کے 2018.10.09 اور دو سب سے حالیہ معمولی ورژن (v1.5.0-v1.6.0) اس تحریر کے وقت کے تمام phpMussel ریلیز کے لئے موجودہ ہے.<br /><br /></div>

<div dir="rtl"><em>یہ معلومات صرف اہم پیکج پر لاگو ہوتا ہے. نصب شدہ دستخط فائلوں، پلگ ان اور دوسرے پردیوی اجزاء کے مطابق نتائج مختلف ہوں گے.</em><br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline">سکینر</div> | <div dir="rtl" style="display:inline">نتائج</div>
----|----
Bkav | <div dir="rtl" style="display:inline">رپورٹیں "VEX.Webshell"</div>

---


### <div dir="rtl">١٠. <a name="SECTION10">اکثر پوچھے گئے سوالات (FAQ)</div>

<div dir="rtl"><ul>
 <li><a href="#WHAT_IS_A_SIGNATURE">ایک "دستخط" کیا ہے؟</a></li>
 <li><a href="#WHAT_IS_A_FALSE_POSITIVE">ایک "جھوٹی مثبت" سے کیا مراد ہے؟</a></li>
 <li><a href="#SIGNATURE_UPDATE_FREQUENCY">دستخط کیسے بیشتر اپ ڈیٹ کر رہے ہیں؟</a></li>
 <li><a href="#ENCOUNTERED_PROBLEM_WHAT_TO_DO">phpMussel استعمال کرتے ہوئے میں ایک مسئلہ کا سامنا کرنا پڑا ہے اور میں اس کے بارے میں کیا پتہ نہیں ہے! مدد کریں!</a></li>
 <li><a href="#MINIMUM_PHP_VERSION">میں 5.4.0 سے زیادہ پرانے ایک PHP ورژن کے ساتھ phpMussel استعمال کرنا چاہتے ہیں؛ کیا آپ مدد کر سکتے ہیں؟</a></li>
 <li><a href="#PROTECT_MULTIPLE_DOMAINS">میں نے ایک سے زیادہ ڈومینز کی حفاظت کے لئے ایک واحد phpMussel تنصیب کا استعمال کر سکتا ہوں؟</a></li>
 <li><a href="#PAY_YOU_TO_DO_IT">میں نے اس پر وقت خرچ نہیں کرنا چاہتا (اسے انسٹال، اس کے قیام، وغیرہ)؛ میں نے آپ کو ایسا کرنے کے لئے ادا کر سکتے ہیں؟</a></li>
 <li><a href="#HIRE_FOR_PRIVATE_WORK">میں ذاتی کام کے لئے آپ کی خدمات حاصل کر سکتے ہیں؟</a></li>
 <li><a href="#SPECIALIST_MODIFICATIONS">مجھے خصوصی ترمیم کی ضرورت؛ کیا آپ مدد کر سکتے ہیں؟</a></li>
 <li><a href="#ACCEPT_OR_OFFER_WORK">میں نے ایک ڈویلپر، ویب سائٹ ڈیزائنر، یا پروگرامر ہوں. میں اس منصوبے سے متعلق کام کر سکتے ہیں؟</a></li>
 <li><a href="#WANT_TO_CONTRIBUTE">میں نے اس منصوبے میں شراکت کے لئے چاہتے ہیں؛ میں یہ کر سکتا ہوں؟</a></li>
 <li><a href="#SCAN_DEBUGGING">کس طرح وہ سکین کر رہے ہیں جب فائلوں کے بارے میں مزید تفصیلات تک رسائی حاصل کرنے کے لئے؟</a></li>
 <li><a href="#CRON_TO_UPDATE_AUTOMATICALLY">کیا میں خود کار طریقے سے اپ ڈیٹ کرنے کیلئے cron استعمال کرسکتا ہوں؟</a></li>
 <li><a href="#SCAN_NON_ANSI">غیر ANSI ناموں کے ساتھ فائلوں کو phpMussel اسکین کرسکتے ہیں؟</a></li>
 <li><a href="#BLACK_WHITE_GREY">بلیک لسٹ – سفید لسٹ – سرمئی لسٹ – وہ کیا ہیں، اور میں ان کا کیسے استعمال کروں؟</a></li>
 <li><a href="#CHANGE_COMPONENT_SORT_ORDER">جب میں دستخط شدہ فائلوں کے ذریعہ دستخط شدہ فائلوں کو چالو یا غیر فعال کروں تو، یہ انفرادی طور پر ترتیب میں تبدیل کرتا ہے. کیا میں اس راستہ کو تبدیل کر سکتا ہوں جسے وہ ترتیب دیں گے؟</a></li>
</ul></div>

#### <div dir="rtl"><a name="WHAT_IS_A_SIGNATURE"></a>ایک "دستخط" کیا ہے؟<br /><br /></div>

<div dir="rtl">phpMussel میں، ایک "دستخط" ڈیٹا کو ایک شناخت کے طور پر کام کرتا ہے کہ مراد، عام طور پر کچھ کے لئے بڑی پورے کا ایک چھوٹا سا ٹکڑا کے طور پر ہم تلاش کر رہے ہیں. عام طور پر اضافی سیاق و سباق فراہم کرنے میں مدد کرنے کے لئے ایک لیبل، اور دیگر مفید ڈیٹا شامل ہیں. یہ ہم اسے تلاش کرتے وقت آگے بڑھنے کا بہترین طریقہ کا تعین کرنے میں مدد کر سکتے ہیں.<br /><br /></div>

#### <div dir="rtl"><a name="WHAT_IS_A_FALSE_POSITIVE"></a>ایک "جھوٹی مثبت" سے کیا مراد ہے؟<br /><br /></div>

<div dir="rtl">اصطلاح "جھوٹی مثبت" (<em>متبادل کے طور پر: "جھوٹی مثبت غلطی"؛ "جھوٹے الارم"</em>)، بیان بہت صرف، اور ایک عام سیاق و سباق میں، ایک کی حالت کے لئے جانچ جب، استعمال کیا جاتا ہے کہ ٹیسٹ کے نتائج کا حوالہ دیتے ہیں کے لئے، نتائج مثبت ہیں جب (یعنی حالت "مثبت" یا "سچ" ہونے کا تعین کیا جاتا ہے)، لیکن بننے کی توقع کی جاتی ہے (یا ہونا چاہیئے) منفی (یعنی حالت، حقیقت میں، "منفی"، یا "جھوٹے"). "جھوٹی مثبت" مثل غور کیا جا سکتا کے لئے "رونا بھیڑیا" (جس حالت تجربہ کیا جا رہا، حالت "جھوٹے" کہ میں ریوڑ کے قریب کوئی بھیڑیا ہے، اور شرط کے طور پر رپورٹ کیا جاتا ہے ریوڑ کے قریب ایک بھیڑیا ہے کہ آیا ہے "بھیڑیا، بھیڑیا" بلا کی راہ کی طرف چرواہا کی طرف سے "مثبت")، یا طبی جانچ میں حالات جس میں ایک مریض، کچھ بیماری یا مرض ہونے حقیقت میں، وہ ایسی کوئی بیماری یا مرض ہے جب کے طور پر تشخیص کی جاتی ہے کے مطابق.<br /><br /></div>

<div dir="rtl">ایک شرط کے لئے جانچ جب متعلقہ نتائج "سچ مثبت" کی اصطلاحات کا استعمال کرتے ہوئے، "سچ منفی" اور "جھوٹے منفی" بیان کیا جا سکتا ہے. "سچ مثبت" جب ٹیسٹ کے نتائج اور حالت کی اصل ریاست دونوں حقیقی (یا "مثبت")، اور ایک "حقیقی منفی" ہیں سے مراد ہے سے مراد ہے جب ٹیسٹ کے نتائج اور کی اصل ریاست شرط ہیں دونوں جھوٹے ہیں (یا "منفی")؛ "سچ مثبت" یا "سچ منفی" ایک "صحیح اندازہ" سمجھا جاتا ہے. ایک "جھوٹی مثبت" کے برعکس ایک "جھوٹے منفی" ہے؛ "جھوٹے منفی" سے ٹیسٹ کے نتائج منفی ہیں، جب (یعنی حالت "منفی"، یا "جھوٹے" ہونے کا تعین کیا جاتا ہے)، لیکن بننے کی توقع کی جاتی ہے (یا ہونا چاہیئے) مراد مثبت (یعنی، حالت، حقیقت میں، "مثبت" یا "سچ") ہے.<br /><br /></div>

<div dir="rtl">phpMussel کے تناظر میں، ان شرائط phpMussel کے دستخط اور فائلوں کو وہ بلاک ہے کہ حوالہ دیتے ہیں. جب phpMussel وجہ سے بری فرسودہ یا غلط دستخط کرنے کے بلاکس ایک فائل ہے، لیکن ایسا نہیں کیا جاتا یا یہ غلط وجوہات کی بناء پر ایسا کرتا ہے جب، ہم نے ایک "جھوٹی مثبت" کے طور پر اس ایونٹ کا حوالہ دیتے ہیں. phpMussel ایک فائل ہے، کی وجہ سے غیر متوقع خطرات سے، بلاک کر دیا گیا ہے چاہئے لاپتہ اس کے دستخط میں دستخط یا کمی کو بلاک کرنے میں ناکام ہونے پر، ہم نے ایک "یاد کا پتہ لگانے" (ایک "جھوٹے منفی" کے مطابق ہوتا ہے) کے طور پر اس واقعہ کا حوالہ دیتے ہیں.<br /><br /></div>

<div dir="rtl">یہ مندرجہ ذیل ٹیبل کی طرف سے بیان کیا جا سکتا ہے:<br /><br /></div>

&nbsp; <div dir="rtl" style="display:inline">phpMussel چاہئے <strong>نہیں</strong> ایک فائل بلاک</div> | &nbsp; <div dir="rtl" style="display:inline">phpMussel ایک فائل کو بلاک کرنا چاہئے</div> | &nbsp;
---|---|---
&nbsp; <div dir="rtl" style="display:inline">یہ سچ ہے کہ منفی (صحیح اندازہ)</div> | <div dir="rtl" style="display:inline">فوت شدہ کا پتہ لگانے (جھوٹے منفی کے مطابق)</div> | <div dir="rtl" style="display:inline">phpMussel <strong>نہیں</strong> ایک فائل کو بلاک</div>
&nbsp; <div dir="rtl" style="display:inline"><strong>جھوٹی مثبت</strong></div> | <div dir="rtl" style="display:inline">یہ سچ ہے کہ مثبت (صحیح اندازہ)</div> | <div dir="rtl" style="display:inline"><strong>phpMussel کرتا فائل کو بلاک</strong></div>

#### <div dir="rtl"><a name="SIGNATURE_UPDATE_FREQUENCY"></a>دستخط کیسے بیشتر اپ ڈیٹ کر رہے ہیں؟<br /><br /></div>

<div dir="rtl">اپ ڈیٹ فریکوئنسی سوال میں دستخط کی فائلوں پر منحصر ہوتی ہے. phpMussel دستخط کی فائلوں کے لئے تمام حاکم عام طور پر اپ ڈیٹ کرنے کے لئے ممکن ہے کے طور پر کے طور پر ان کے دستخط رکھنے کی کوشش کرتے ہیں، لیکن ہم سب کے طور پر مختلف دیگر وعدوں، اس منصوبے سے باہر ہماری زندگی ہے، اور ہم میں سے کوئی اس کو مالی طور پر معاوضہ رہے ہیں (یعنی، ادا کی ) منصوبے پر ہماری کوششوں کے لئے ایک عین مطابق اپ ڈیٹ کے شیڈول کی ضمانت نہیں کیا جا سکتا. دستخط کو اپ ڈیٹ کیا جاتا ہے جب ایسا کرنے کا کافی وقت ہے. اگر آپ کو کوئی پیشکش کرنے کو تیار ہیں تو اس سلسلے میں معاونت ہمیشہ تعریف کی ہے.<br /><br /></div>

#### <div dir="rtl"><a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>phpMussel استعمال کرتے ہوئے میں ایک مسئلہ کا سامنا کرنا پڑا ہے اور میں اس کے بارے میں کیا پتہ نہیں ہے! مدد کریں!</div>
<div dir="rtl"><ul>
 <li>آپ نے سافٹ ویئر کا تازہ ترین ورژن استعمال کر رہے ہیں؟ آپ کو آپ کے دستخط فائلوں کا تازہ ترین ورژن استعمال کر رہے ہیں؟ ان دو سوالوں کی یا تو کرنے کے لئے جواب نہیں ہے تو، سب سے پہلے سب کچھ کو اپ ڈیٹ کرنے کی کوشش کریں، اور چاہے وہ مسئلہ برقرار رہتا ہے چیک کریں. یہ برقرار رہتا ہے، پڑھنے جاری رکھیں.</li>
 <li>اگر آپ کو تمام دستاویزات کے ذریعے کی جانچ پڑتال کی ہے؟ اگر نہیں، تو براہ مہربانی. مسئلہ دستاویزات استعمال کر حل نہیں کیا جا سکتا ہے، تو پڑھنے جاری رکھیں.</li>
 <li>اگر آپ کو <strong><a href="https://github.com/phpMussel/phpMussel/issues">issues صفحے</a></strong>، دیکھنا چاہے مسئلہ پہلے ذکر کیا گیا ہے؟ اس سے پہلے ذکر کیا گیا ہے تو، چاہے وہ کسی بھی تجاویز، خیالات، اور/یا کے حل فراہم کیا گیا جانچ اور مسئلہ حل کرنے کی کوشش کرنے کے لئے ضروری کے مطابق عمل کریں.</li>
 <li>اگر مسئلہ اب بھی جاری رہتا ہے، تو issues کے صفحے پر ایک نیا issue تشکیل دے کر اس کے بارے میں مدد طلب کریں.</li>
</ul></div>

#### <div dir="rtl"><a name="MINIMUM_PHP_VERSION"></a>میں 5.4.0 سے زیادہ پرانے ایک PHP ورژن کے ساتھ phpMussel استعمال کرنا چاہتے ہیں؛ کیا آپ مدد کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl">نہیں. PHP 5.4.0 کی حمایت کے 2014 میں ختم ہونے والے، اور توسیع کی سیکورٹی کی حمایت کی اس تحریر کی وجہ 2015. میں ختم کیا گیا تھا، یہ 2017 ہے اور PHP 7.1.0 پہلے سے ہی دستیاب ہے. اس وقت، حمایت PHP 5.4.0 اور تمام دستیاب جدید تر PHP ورژن کے ساتھ phpMussel استعمال کرنے کے لئے فراہم کی جاتی ہے، لیکن آپ کو کسی بھی بڑی عمر کے PHP ورژن کے ساتھ phpMussel استعمال کرنے کی کوشش کرتے ہیں، مدد فراہم نہیں کی جائے گی.<br /><br /></div>

<div dir="rtl"><em>بھی دیکھو: <a href="https://maikuolan.github.io/Compatibility-Charts/">مطابقت چارٹ</a>.</em><br /><br /></div>

#### <div dir="rtl"><a name="PROTECT_MULTIPLE_DOMAINS"></a>میں نے ایک سے زیادہ ڈومینز کی حفاظت کے لئے ایک واحد phpMussel تنصیب کا استعمال کر سکتا ہوں؟<br /><br /></div>

<div dir="rtl">جی ہاں. phpMussel ایک سے زیادہ ڈومینز کی حفاظت کے لئے استعمال کیا جا سکتا ہے. ضرورت کی ترتیب مختلف ہے تو، ایسا کرنے کے لئے تحفظ کی ضرورت ہوتی ڈومینز کے مطابق نامی نئی ترتیب فائل، تخلیق کرتے ہیں. phpMussel یہ ڈومین کیلئے کام کرنا چاہئے کہ کس طرح اس بات کا تعین کرنے کے لئے ان فائلوں کو استعمال کریں گے. سوف تستخدم phpMussel هذه الملفات لتحديد كيفية تشغيلها للنطاق. ایک مثال کے طور، کے لئے <code dir="ltr">"http://www.some-domain.tld/"</code>، اس کا نام ہے <code dir="ltr">"some-domain.tld.config.ini"</code>. ڈومین نام <code dir="ltr">"HTTP_HOST"</code> سے آتا ہے. <code dir="ltr">"www"</code> نظر انداز کر دیا جاتا ہے.<br /><br /></div>

#### <div dir="rtl"><a name="PAY_YOU_TO_DO_IT"></a>میں نے اس پر وقت خرچ نہیں کرنا چاہتا (اسے انسٹال، اس کے قیام، وغیرہ)؛ میں نے آپ کو ایسا کرنے کے لئے ادا کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl">شاید. یہ معاملہ در معاملہ کی بنیاد پر کیا جاتا ہے. کی آپ کو ضرورت ہے ہمیں بتائیں. ہمیں بتائیں کہ آپ کی پیشکش کر رہے ہیں. ہم آپ کو بتا دیں گے ہم مدد کر سکتے ہیں.<br /><br /></div>

#### <div dir="rtl"><a name="HIRE_FOR_PRIVATE_WORK"></a>میں ذاتی کام کے لئے آپ کی خدمات حاصل کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl"><em>اوپر ملاحظہ کریں.</em><br /><br /></div>

#### <div dir="rtl"><a name="SPECIALIST_MODIFICATIONS"></a>مجھے خصوصی ترمیم کی ضرورت؛ کیا آپ مدد کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl"><em>اوپر ملاحظہ کریں.</em><br /><br /></div>

#### <div dir="rtl"><a name="ACCEPT_OR_OFFER_WORK"></a>میں نے ایک ڈویلپر، ویب سائٹ ڈیزائنر، یا پروگرامر ہوں. میں اس منصوبے سے متعلق کام کر سکتے ہیں؟<br /><br /></div>

<div dir="rtl">جی ہاں. ہمارے لائسنس اس کی ممانعت نہیں کرتا.<br /><br /></div>

#### <div dir="rtl"><a name="WANT_TO_CONTRIBUTE"></a>میں نے اس منصوبے میں شراکت کے لئے چاہتے ہیں؛ میں یہ کر سکتا ہوں؟<br /><br /></div>

<div dir="rtl">جی ہاں. اس کا خیر مقدم کیا جاتا ہے. "CONTRIBUTING.md" ملاحظہ کریں مزید معلومات کے لئے.<br /><br /></div>

#### <div dir="rtl"><a name="SCAN_DEBUGGING"></a>کس طرح وہ سکین کر رہے ہیں جب فائلوں کے بارے میں مزید تفصیلات تک رسائی حاصل کرنے کے لئے؟<br /><br /></div>

<div dir="rtl">آپ کو اس مقصد ان کو اسکین کرنے phpMussel ہدایت کرنے سے پہلے کے لئے استعمال کرنے کے لئے ایک صف بتائے کی طرف سے ایسا کر سکتے ہیں.<br /><br /></div>

<div dir="rtl">ذیل کی مثال میں، <code dir="ltr">$Foo</code> اس مقصد کے لئے مقرر کیا جاتا ہے. سکیننگ کے بعد <code dir="ltr">/file/path/...</code>، <code dir="ltr">/file/path/...</code> کی طرف سے موجود فائلوں کے بارے میں تفصیلی معلومات <code dir="ltr">$Foo</code> کی طرف سے پر مشتمل ہو گا.<br /><br /></div>

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/file/path/...');

var_dump($Foo);
```

<div dir="rtl">صف کثیرالابعاد ہے. عناصر ہر فائل کو سکین کیا جا رہا ہے کی نمائندگی کرتے ہیں. ذیلی عناصر ان فائلوں کے بارے میں تفصیلات نمائندگی کرتے ہیں. ذیلی عناصر مندرجہ ذیل ہیں:<br /><br /></div>

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

<div dir="rtl"><em>† - عارضی نتائج کے ساتھ فراہم نہیں (صرف نئے اسکین کے نتائج کے لئے فراہم).</em><br /><br /></div>

<div dir="rtl"><em>‡ - PE فائلوں کو سکین جب صرف فراہم کی.</em><br /><br /></div>

<div dir="rtl">اختیاری، اس صف میں مندرجہ ذیل کا استعمال کرتے ہوئے کی طرف سے تباہ کیا جا سکتا ہے:<br /><br /></div>

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <div dir="rtl"><a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>کیا میں خود کار طریقے سے اپ ڈیٹ کرنے کیلئے cron استعمال کرسکتا ہوں؟<br /><br /></div>

<div dir="rtl">جی ہاں. بیرونی سکرپٹ کے ذریعہ اپ ڈیٹس صفحہ کے ساتھ بات چیت کرنے کے لئے ایک API سامنے کے آخر میں بنایا جاتا ہے. ایک علیحدہ لکھاوٹ، "<a href="https://github.com/Maikuolan/Cronable">Cronable</a>"، دستیاب ہے، اور اس کے اور دیگر معاون پیکجوں کو خود کار طریقے سے اپ ڈیٹ کرنے کے لئے آپ کے cron manager یا cron scheduler کا استعمال کیا جا سکتا ہے (یہ اسکرپٹ اپنی اپنی دستاویزات فراہم کرتا ہے).<br /><br /></div>

#### <div dir="rtl"><a name="SCAN_NON_ANSI"></a>غیر ANSI ناموں کے ساتھ فائلوں کو phpMussel اسکین کرسکتے ہیں؟<br /><br /></div>

<div dir="rtl">فرض کریں کہ اس ڈائریکٹری میں آپ اسکین کرنا چاہتے ہیں. اس ڈائرکٹری میں، آپ کے پاس غیر ANSI ناموں کے ساتھ کچھ فائلیں ہیں.<br /><br /></div>

- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

<div dir="rtl">فرض کریں آپ اسکین کرنے کے لئے CLI موڈ یا phpMussel API استعمال کر رہے ہیں.<br /><br /></div>

<div dir="rtl">کچھ نظام پر <code dir="ltr">PHP &lt; 7.1.0</code> کا استعمال کرتے ہوئے، phpMussel کو ڈائرکٹری کو اسکین کرنے کے دوران ان فائلوں کو نہیں ملیں گے. آپ کو یہ ممکنہ طور پر وہی نتیجہ مل جائے گا جیسے آپ کو ایک خالی ڈائرکٹری اسکین کرنا پڑا تھا:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">اس کے علاوہ، <code dir="ltr">PHP &lt; 7.1.0</code> کا استعمال کرتے ہوئے، انفرادی طور پر فائلوں کو اسکیننگ ان طرح کے نتائج پیدا کرتا ہے:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > Checking 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Invalid file!
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">یا یہ:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > X:/directory/??????.txt is not a file or directory.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

<div dir="rtl">یہ اس وجہ سے ہے کہ غیر ANSI فائلوں کے <code dir="ltr">PHP 7.1.0</code> سے پہلے کس طرح سنبھال لیا گیا تھا. اگر آپ اس مسئلے کا تجربہ کرتے ہیں تو، حل آپ کے PHP کی تنصیب کو اپ ڈیٹ کرنا ہے. <code dir="ltr">PHP &gt;= 7.1.0</code> میں، غیر ANSI فائلوں کے نام کو بہتر بنا دیا جاتا ہے، اور phpMussel کو مناسب طریقے سے اسکین کرنے کے قابل ہونا چاہئے.<br /><br /></div>

<div dir="rtl">مقابلے کے لئے، <code dir="ltr">PHP &gt;= 7.1.0</code> کا استعمال کرتے ہوئے ڈائرکٹری کو اسکین کرنے کے لۓ نتائج:<br /><br /></div>

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

<div dir="rtl">اور انفرادی طور پر فائلوں کو اسکین کرنے کی کوشش:<br /><br /></div>

```
 Sun, 01 Apr 2018 22:27:41 +0800 Started.
 > Checking 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> No problems found.
 Sun, 01 Apr 2018 22:27:41 +0800 Finished.
```

#### <div dir="rtl"><a name="BLACK_WHITE_GREY"></a>بلیک لسٹ – سفید لسٹ – سرمئی لسٹ – وہ کیا ہیں، اور میں ان کا کیسے استعمال کروں؟<br /><br /></div>

<div dir="rtl">سیاق و ضوابط پر منحصر ہے، یہ الفاظ مختلف چیزوں کا مطلب ہے. phpMussel میں، تین شرائط ہیں جہاں یہ شرائط استعمال کیا جاتا ہے: فائل کا ناپ، فائل کی قسم، اور سرمئی لسٹ دستخط.<br /><br /></div>

<div dir="rtl">کم سے کم پروسیسنگ کے ساتھ مطلوبہ مطلوبہ نتائج حاصل کرنے کے لئے، فائلوں کو اسکین کرنے سے قبل phpMussel کچھ چیزیں کرسکتے ہیں، مثال کے طور پر، فائل کا سائز، نام، اور توسیع چیک کر رہا ہے. اگر ایک فائل بہت بڑی ہے، یا اگر اس کے کسی قسم کی فائل کا توسیع ہے جسے ہم نہیں چاہتے ہیں، ہم فوری طور پر فائل کی شناخت کر سکتے ہیں، اور اسے اسکین کرنے کی ضرورت نہیں ہے.<br /><br /></div>

<div dir="rtl">فائل کا سائز کے سیاق و سباق کا طریقہ phpMussel کا جواب ہے جب ایک فائل ایک مخصوص حد سے کہیں زیادہ ہے. کوئی فہرست شامل نہیں ہیں، لیکن اس کے سائز پر مبنی ایک فائل کو سمجھا جا سکتا ہے. دو الگ الگ، اختیاری ترتیب کے ہدایات بالترتیب ایک حد اور مطلوبہ جواب کی وضاحت کرنے کے لئے موجود ہیں.<br /><br /></div>

<div dir="rtl">فائل کی قسم کا جواب یہ ہے کہ phpMussel فائل کی توسیع کا جواب ہے. تین علیحدہ، اختیاری ترتیب کے ہدایات واضح طور پر واضح کرنے کے لئے موجود ہیں کہ بالترتیب ہر لسٹ پر ہر ترتیب پر ہونا چاہئے. ایک فائل درج کی جا سکتی ہے اگر اس کی توسیع بالترتیب کسی بھی مخصوص ملانے سے ملتی ہے.<br /><br /></div>

<div dir="rtl">ان دونوں مقاصد میں، وائٹسٹسٹ کا مطلب یہ ہے کہ اسے اسکین یا پرچم نہیں کیا جانا چاہئے؛ بلیک لسٹ پر ہونے کا مطلب یہ ہے کہ اسے نشان زد کیا جانا چاہئے (اور اس وجہ سے اس کو اسکین کرنے کی ضرورت نہیں ہے)؛ اور گرینسٹ پر ہونے کا مطلب یہ ہے کہ اس بات کا تعین کرنے کے لئے مزید تجزیہ کی ضرورت ہے کہ آیا ہمیں اسے پرچم دینا چاہیے (یعنی، اسے اسکین کیا جانا چاہئے).<br /><br /></div>

<div dir="rtl">دستخط سرمئی لسٹ دستخط کی ایک فہرست ہے جو لازمی طور پر نظر انداز کی جانی چاہئے (اس دستاویز میں پہلے ہی مختصر بیان کی گئی ہے). جب سرمئی لسٹ پر دستخط ہوجائے تو، phpMussel اپنے دستخط کے ذریعہ کام جاری رکھتا ہے اور سرمئی لسٹ پر دستخط کے حوالے سے کوئی خاص کارروائی نہیں کرتا ہے. کوئی دستخط بلیک لسٹ نہیں ہے، کیونکہ تخیل شدہ دستخط کے لئے منسلک سلوک رویہ عام رویے ہے. اس میں کوئی دستخط نہیں ہے، کیونکہ یہ اس سلسلے میں ضروری نہیں ہے.<br /><br /></div>

<div dir="rtl">اگر آپ کو دستخط یا مکمل دستخط فائل غیر فعال کرنے کے بغیر کسی خاص دستخط کی وجہ سے مسائل کو حل کرنے کی ضرورت ہوتی ہے تو دستخط سرمئی لسٹ مفید ہے.<br /><br /></div>

#### <div dir="rtl"><a name="CHANGE_COMPONENT_SORT_ORDER"></a>جب میں دستخط شدہ فائلوں کے ذریعہ دستخط شدہ فائلوں کو چالو یا غیر فعال کروں تو، یہ انفرادی طور پر ترتیب میں تبدیل کرتا ہے. کیا میں اس راستہ کو تبدیل کر سکتا ہوں جسے وہ ترتیب دیں گے؟<br /><br /></div>

<div dir="rtl">جی ہاں. اگر آپ کو مخصوص فائلوں میں عمل درآمد کرنے کے لئے کچھ فائلوں پر مجبور کرنے کی ضرورت ہے تو، آپ ان کے نام سے پہلے ان ترتیبات کو ہدایت دیتے ہیں جہاں وہ فہرست میں درج ہوتے ہیں، ان سے پہلے کسی بھی مباحثہ کے اعداد و شمار کو شامل کرسکتے ہیں. جب اپ ڈیٹس کے صفحے کو بعد میں فائلوں کو دوبارہ ترتیب دیتا ہے، تو اس نے مزید کہا کہ خود مختار اعداد و شمار اس طرح کے حکم کو متاثر کرے گی، جس کے نتیجے میں ان کے نتیجے میں عملدرآمد کرنے کے نتیجے میں عملدرآمد کرنے کے لۓ، بغیر کسی کو تبدیل کرنے کی ضرورت ہے.<br /><br /></div>

<div dir="rtl">مثال کے طور پر، مندرجہ ذیل درج ذیل فائلوں کے ساتھ ایک ترتیب ڈائریکٹری کو فرض کرنا:<br /><br /></div>

`file1.php,file2.php,file3.php,file4.php,file5.php`

<div dir="rtl">اگر آپ چاہتے تھے کہ <code dir="ltr">file3.php</code> سب سے پہلے عمل کرنے کیلئے، آپ فائل کے نام سے پہلے <code dir="ltr">aaa:</code> کی طرح کچھ شامل کرسکتے ہیں:<br /><br /></div>

`file1.php,file2.php,aaa:file3.php,file4.php,file5.php`

<div dir="rtl">پھر، اگر ایک نئی فائل، <code dir="ltr">file6.php</code>، چالو کر دیا جاتا ہے، جب اپ ڈیٹس صفحہ ان کو دوبارہ دوبارہ تبدیل کرتا ہے، تو اسے اس طرح ختم کرنا چاہئے:<br /><br /></div>

`aaa:file3.php,file1.php,file2.php,file4.php,file5.php,file6.php`

<div dir="rtl">ایک ہی صورت حال حال ہی میں ایک فائل غیر فعال ہے. اس کے برعکس، اگر آپ چاہتے تھے کہ آخری فائل کو عمل کرنے کے لۓ، آپ فائل کے نام سے پہلے <code dir="ltr">zzz:</code> کی طرح کچھ شامل کرسکیں. کسی بھی صورت میں، آپ کو سوال میں فائل کا نام تبدیل کرنے کی ضرورت نہیں ہوگی.<br /><br /></div>

---


### <div dir="rtl">١١. <a name="SECTION11">قانونی معلومات</div>

#### <div dir="rtl">١١.٠ سیکشن پریامبل<br /><br /></div>

<div dir="rtl">دستاویزات کا یہ حصہ پیکج کے استعمال اور عمل کے بارے میں ممکنہ قانونی مفکوم بیان کرتا ہے، اور کچھ بنیادی متعلق معلومات فراہم کرتی ہے. بعض صارفین کے لئے شکایت کا یقین کرنے کے لئے یہ ممکن ہو سکتا ہے کہ وہ کسی بھی قانونی تقاضے کے ساتھ موجود ممالک میں موجود ہوسکتے ہیں جس میں وہ کام کرتے ہیں، اور کچھ صارفین اس کی معلومات کے مطابق اپنی ویب سائٹ کی پالیسیوں کو ایڈجسٹ کرنے کی ضرورت ہوسکتی ہے.<br /><br /></div>

<div dir="rtl">سب سے پہلے، سب سے اہم، یاد رکھیں کہ میں (پیکیج کا مصنف) ایک وکیل نہیں ہوں. لہذا، میں قانونی مشورہ فراہم کرنے کے لئے قانونی طور پر قابل نہیں ہوں. اس کے علاوہ، کچھ معاملات میں، قانونی ضروریات مختلف ممالک اور دائرہ کاروں کے درمیان مختلف ہوتی ہیں. یہ مختلف قانونی ضروریات کبھی کبھی متفق ہیں (مثلا، ایسے ممالک جو "رازداری کے حقوق" اور "بھول جانے کا حق"، ایسے ممالک کے مقابلے میں جو "ڈیٹا برقرار رکھنے" کا حق رکھتے ہیں). یہ بھی غور کریں کہ پیکیج تک رسائی مخصوص ممالک یا دائرہ کاروں سے محدود نہیں ہے, اور اس وجہ سے، پیکج کے صارفین جغرافیایی متنوع ہونے کا امکان رکھتے ہیں. ان پوائنٹس پر غور کیا گیا ہے، میں ایسی حیثیت میں نہیں ہوں جو یہ سب کے لئے "قانونی طور پر مطابق" ہونے کا مطلب ہے. تاہم، مجھے امید ہے کہ اس معلومات میں آپ کو یہ فیصلہ کرنے میں مدد ملتی ہے کہ پیکج کے تناظر میں قانونی طور پر مطابق رہنے کے لۓ آپ کو کیا کرنا ہوگا. اگر آپ کو کوئی شبہ ہے، یا اگر آپ کو قانونی نقطہ نظر سے اضافی مدد اور مشورہ کی ضرورت ہو تو، میں ایک قانونی پیشہ ورانہ مشاورت کی سفارش کروں گا.<br /><br /></div>

#### <div dir="rtl">١١.١ ذمہ داری<br /><br /></div>

<div dir="rtl">پیکج کسی بھی وارنٹی کے ساتھ فراہم نہیں کی جاتی ہے (لائسنس پہلے ہی اس کا ذکر کرتا ہے). یہ ذمہ داری کے تمام مقاصد پر لاگو ہوتا ہے. پیکج آپ کی سہولت کے لئے فراہم کی جاتی ہے. امید ہے کہ یہ مفید ہو گا، اور یہ آپ کے لئے کچھ فائدہ فراہم کرے گا. تاہم، پیکج کا استعمال کرتے ہوئے یا لاگو آپ کا اپنا فیصلہ ہے. آپ اسے استعمال کرنے یا اسے لاگو کرنے پر مجبور نہیں ہوئے ہیں. جب آپ ایسا کرتے ہو تو، آپ اس فیصلے کے ذمہ دار ہیں. میں اور دوسرا پیکج شراکت دار، آپ کے فیصلوں کے نتائج کے لئے قانونی طور پر ذمہ دار نہیں ہے.<br /><br /></div>

#### <div dir="rtl">١١.٢ تیسرے فریقوں<br /><br /></div>

<div dir="rtl">اس پیکیج پر منحصر ہے کہ کس طرح پیکج ترتیب اور لاگو ہوتا ہے، کچھ صورتو میں، یہ تیسری جماعتوں کے ساتھ معلومات کا اشتراک کرسکتا ہے. کچھ قواعد و ضوابط میں، کچھ دائرہ کار کی طرف سے، یہ "ذاتی طور پر شناختی معلومات" کے طور پر بیان کیا جا سکتا ہے.<br /><br /></div>

<div dir="rtl">تیسری جماعتوں کی طرف سے یہ معلومات کس طرح استعمال کی جاتی ہے، ان کی پالیسیوں کے تابع ہے، اور اس دستاویزات کے دائمے سے باہر ہے. تاہم، اس طرح کے معاملات میں، معلومات کا اشتراک معذور ہوسکتا ہے. اس طرح کے معاملات میں، اگر آپ اسے چالو کرنے کا انتخاب کرتے ہیں تو، یہ آپ کی ذمہ داری ہے کہ آپ کو ان خدشات کے بارے میں معلومات کی رازداری، سیکورٹی اور استعمال کے بارے میں کوئی خدشات کی تحقیقات کی جا سکتی ہے. اگر کوئی شبہ موجود ہے، یا اگر آپ ان تیسری جماعتوں کے انعقاد سے ناخوش ہیں تو، ان تیسری جماعتوں کے ساتھ معلومات کے تمام حصول کو غیر فعال کرنے میں یہ سب سے بہتر ہوسکتا ہے.<br /><br /></div>

<div dir="rtl">شفافیت کے مقصد کے لئے، مشترکہ معلومات کی قسم ذیل میں بیان کی گئی ہے.<br /><br /></div>

##### <div dir="rtl">١١.٢.٠ ویب فونٹس<br /><br /></div>

<div dir="rtl">کچھ اپنی مرضی کے مطابق موضوعات، معیاری phpMussel صارف انٹرفیس، اور "اپ لوڈ کریں تردید" صفحہ، ویب فونٹس کو جمالیاتی وجوہات کے لۓ استعمال کرسکتے ہیں. ویب فونٹس ڈیفالٹ کے ذریعہ غیر فعال ہیں. فعال ہونے پر، صارف کے برائوزر اور ویب فونٹ میزبان کے درمیان براہ راست مواصلات موجود ہے. یہ ممکنہ طور پر مواصلاتی معلومات جیسے صارف کے IP ایڈریس، صارف ایجنٹ، آپریٹنگ سسٹم، اور درخواست کے لئے دستیاب دیگر تفصیلات شامل ہوسکتا ہے. ان میں سے زیادہ تر ویب فونٹس <a dir="ltr" href="https://fonts.google.com/">Google Fonts</a> سروس کی طرف سے میزبان ہیں.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">disable_webfonts</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٢.١ URL سکینر<br /><br /></div>

<div dir="rtl">فائل اپ لوڈوں کے اندر پایا URL، <code dir="ltr">hpHosts API</code> یا <code dir="ltr">Google Safe Browsing API</code>، کے ساتھ اشتراک کیا جا سکتا ہے، اس سلسلے پر منحصر ہے کہ کس طرح پیکج کو ترتیب دیا گیا ہے.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">lookup_hphosts</code> &lt;- <code dir="ltr">urlscanner</code></li>
 <li><code dir="ltr">google_api_key</code> &lt;- <code dir="ltr">urlscanner</code></li>
</ul></div>

##### <div dir="rtl">١١.٢.٢ VIRUS TOTAL<br /><br /></div>

<div dir="rtl">جب phpMussel فائل فائل اپ لوڈ کرتا ہے، ان فائلوں کے ہیس کو Virus Total API کے ساتھ اشتراک کیا جاسکتا ہے، اس پر منحصر ہے کہ کس طرح پیکج کو تشکیل دیا گیا ہے. مستقبل میں کچھ عرصے سے پوری فائلوں کو بھی اشتراک کرنے کے قابل ہونے کا منصوبہ موجود ہے، لیکن اس خصوصیت اس وقت پیکج کے ذریعہ معاون نہیں ہے. اس خصوصیت کو استعمال کرنے کے لئے API کی کلید کی ضرورت ہے.<br /><br /></div>

<div dir="rtl">معلومات Virus Total کے ساتھ اشتراک کیا جا سکتا ہے، تحقیق کے مقاصد کے لۓ ان کے شراکت دار، ملحقہ، اور دیگر دیگر کے ساتھ بھی اشتراک کیا جا سکتا ہے. یہ ان کی رازداری کی پالیسی کی طرف سے مزید تفصیل میں بیان کی گئی ہے.<br /><br /></div>

<div dir="rtl">دیکھیں: <a dir="ltr" href="https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy">Privacy Policy &ndash; VirusTotal</a>.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">vt_public_api_key</code> &lt;- <code dir="ltr">virustotal</code></li>
</ul></div>

#### <div dir="rtl">١١.٣ لاگ<br /><br /></div>

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

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
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

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">scan_kills</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - لاگ ان.
```

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">FrontEndLog</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٣ لاگ گرد گھومنے<br /><br /></div>

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">log_rotation_limit</code> &lt;- <code dir="ltr">general</code></li>
 <li><code dir="ltr">log_rotation_action</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٤ ٹرنک ریکارڈ<br /><br /></div>

<div dir="rtl">اگر آپ چاہتے ہیں تو، آپ انفرادی ریکارڈز کو چھوٹ سکتے ہیں جب وہ مخصوص سائز سے کہیں زیادہ ہیں.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">truncate</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٥ IP ایڈریس PSEUDONYMISATION<br /><br /></div>

<div dir="rtl">سب سے پہلے، اگر آپ اصطلاح سے واقف نہیں ہیں، "pseudonymisation" ذاتی اعداد و شمار کی پروسیسنگ سے مراد اس طرح سے ہے کہ یہ کسی بھی مخصوص شخص کو بغیر کسی ضمنی معلومات کی نشاندہی نہیں کی جاسکتی ہے، فراہم کی جاتی ہے کہ اس طرح کی اضافی معلومات علیحدہ طریقے سے برقرار رکھی جاتی ہے اور تکنیکی اور تنظیمی تدابیر کے تابع ہوتے ہیں اس بات کو یقینی بنانے کے لئے کہ ذاتی ڈیٹا کسی قدرتی شخص کو نشاندہی نہیں کی جاسکتی ہے.<br /><br /></div>

<div dir="rtl">مندرجہ ذیل وسائل اس سے مزید تفصیل میں وضاحت کرنے میں مدد کرسکتے ہیں:</div>
<div dir="rtl"><ul>
 <li><a href="https://www.trust-hub.com/news/what-is-pseudonymisation/">[trust-hub.com] What is pseudonymisation?</a></li>
 <li><a href="https://en.wikipedia.org/wiki/Pseudonymization">[Wikipedia] Pseudonymization]</a></li>
</ul></div>

<div dir="rtl">کچھ حالات میں، آپ کو کسی بھی PII جمع، عملدرآمد، یا ذخیرہ کرنے کے لئے "anonymisation" یا "pseudonymisation" کو لاگو کرنا قانونی طور پر ضروری ہوسکتا ہے. یہ تصور ابھی کچھ وقت تک وجود میں آیا ہے، لیکن GDPR/DSGVO خاص طور پر "pseudonymisation" کا ذکر اور حوصلہ افزائی کرتا ہے.<br /><br /></div>

<div dir="rtl">اگر آپ چاہتے ہیں تو، phpMussel لاگ ان کرتے وقت لاگ ان کرتے وقت IP پتے کے لئے یہ کر سکتے ہیں. جب لکھنا لکھنا، IPv4 پتے کے آخری آکٹیٹ اور IPv6 پتے کے دوسرے حصے کے بعد سب کچھ، "x" کی طرف سے نمائندگی کی جائے گی.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">pseudonymise_ip_addresses</code> &lt;- <code dir="ltr">legal</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٦ اعداد و شمار<br /><br /></div>

<div dir="rtl">phpMussel اعداد و شمار کو ٹریک کر سکتے ہیں، جیسے کہ ایک خاص وقت سے کتنے فائلوں کو سکینڈ اور بند کر دیا گیا ہے. یہ خصوصیت ڈیفالٹ کے ذریعہ غیر فعال ہے، لیکن پیکیج کی ترتیب کے ذریعے فعال کیا جا سکتا ہے. ٹریک کردہ معلومات کی قسم PII کے طور پر نہیں جانا چاہئے.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">statistics</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

##### <div dir="rtl">١١.٣.٧ خفیہ کاری<br /><br /></div>

<div dir="rtl">phpMussel اس کے لاگ ان یا کیش کو خفیہ نہیں کرتا. یہ مستقبل میں متعارف کرایا جا سکتا ہے، لیکن فی الحال اس کی کوئی مخصوص منصوبہ نہیں ہے. اگر آپ غیر قانونی شدہ تیسری جماعتوں کے بارے میں فکر مند ہیں تو phpMussel میں حساس معلومات تک رسائی حاصل ہے، میں سفارش کرتا ہوں کہ عام طور پر قابل رسائی مقام پر phpMussel انسٹال نہیں کیا جائے گا (مثال کے طور پر، <code dir="ltr">public_html</code> میں انسٹال نہ کریں) اور اس بات کو یقینی بنائیں کہ مناسب حد تک محدود پابندیوں کو نافذ کیا جائے. اگر یہ آپ کے خدشات کو حل کرنے کے لئے کافی نہیں ہے تو پھر phpMussel کو ترتیب دیں تاکہ حساس معلومات جمع نہیں کی جائے گی (جیسے جیسے، لاگ ان کو غیر فعال کرکے).<br /><br /></div>

#### <div dir="rtl">١١.٤ کوکی<br /><br /></div>

<div dir="rtl">صارف کو سامنے کے آخر میں لاگ ان ہونے پر phpMussel ایک کوکی سیٹ کرتا ہے (تصدیق کے مقاصد کے لئے). لاگ ان کے صفحے پر، صارف کو خبردار کیا جاتا ہے کہ اگر وہ صفحہ مشغول ہوجائے تو ایک کوکی پیدا کی جائے گی. کوکیز کہیں اور نہیں بنائے جاتے ہیں.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">disable_frontend</code> &lt;- <code dir="ltr">general</code></li>
</ul></div>

#### <div dir="rtl">١١.٥ مارکیٹنگ اور اشتہارات<br /><br /></div>

<div dir="rtl">phpMussel مارکیٹنگ یا اشتہارات کے مقاصد کے لئے کسی بھی معلومات جمع یا عمل نہیں کرتا ہے. یہ کسی جمع کردہ یا لاگ ان معلومات سے کوئی فائدہ نہیں فروخت کرتا ہے. phpMussel ایک تجارتی ادارہ نہیں ہے، اور کسی بھی تجارتی مفادات سے متعلق نہیں ہے، لہذا ان کاموں کو کوئی احساس نہیں ہوگا. اس منصوبے کی شروعات کے بعد یہ معاملہ رہا ہے، اور آج ہی مقدمہ جاری ہے.<br /><br /></div>

#### <div dir="rtl">١١.٦ رازداری کی پالیسی<br /><br /></div>

<div dir="rtl">بعض اوقات آپ کو قانون کی طرف سے آپ کی ویب سائٹ پر اپنی جگہ پر اپنی رازداری کی پالیسی پر ایک لنک ظاہر کرنے کی ضرورت ہوسکتی ہے. اس بات کو یقینی بنانے کیلئے صارفین کو آپ کی رازداری کے طریقوں کے بارے میں مطلع کیا جاسکتا ہے، جو آپ جمع کرتے ہیں، اور آپ اس معلومات کے ساتھ کیا کرتے ہیں. phpMussel کے "اپ لوڈ کریں تردید" کے صفحے پر اس لنک کو شامل کرنے کے قابل ہونے کے لۓ، آپ کی رازداری کی پالیسی کے ایڈریس کی وضاحت کرنے کے لئے ایک ترتیب کا اختیار فراہم کیا جاتا ہے.<br /><br /></div>

<div dir="rtl">متعلقہ ترتیب ہدایات:<br /></div>
<div dir="rtl"><ul>
 <li><code dir="ltr">privacy_policy</code> &lt;- <code dir="ltr">legal</code></li>
</ul></div>

#### <div dir="rtl">١١.٧ GDPR/DSGVO<br /><br /></div>

<div dir="rtl">GDPR یورپی یونین کا ایک ضابطہ ہے جو 25 مئی، 2018 تک اثر انداز ہوتا ہے. ریگولیشن کا بنیادی مقصد یہ ہے کہ یورپی یونین کے شہریوں اور باشندوں کو ان کے اپنے ذاتی ڈیٹا سے متعلق قابو پانے، اور پرائیویٹ اور ذاتی ڈیٹا کے بارے میں یورپی یونین کے اندر ریگولیشن کو متحد کرنا.<br /><br /></div>

<div dir="rtl">ریگولیشن کسی بھی EU کے "اعداد و شمار کے مضامین" (کسی بھی شناخت یا شناختی قدرتی شخص) کے "ذاتی طور پر شناختی معلومات" کی پروسیسنگ سے متعلق مخصوص اجزاء پر مشتمل ہے. تعمیل کرنے کے لئے، کمپنیوں، عمل، اور متعلقہ نظام، "ڈیزائن کی طرف سے رازداری" کو لاگو کرنا لازمی ہے، سب سے زیادہ ممکن راز رازداری کی ترتیبات کا استعمال کرنا ضروری ہے، کسی ذخیرہ یا پروسیسنگ معلومات کے لئے حفاظتی انتظامات کو لاگو کرنا ضروری ہے (بشمول، لیکن تک محدود نہیں، "pseudonymisation" اور "anonymisation")، واضح طور پر ان اعداد و شمار کی اقسام کا اعلان کرنا چاہیے جو وہ جمع کرتے ہیں، وہ کس طرح کے سببوں کے لئے، اس کے عمل کو کس طرح، وہ کتنی عرصے تک اسے برقرار رکھتی ہیں، اور اگر وہ اس ڈیٹا کو کسی بھی تیسری پارٹی کے ساتھ شریک کریں، اعداد و شمار کی اقسام، کیسے، کیوں، اور اسی طرح کی اقسام.<br /><br /></div>

<div dir="rtl">اعداد و شمار پر عملدرآمد نہیں کیا جاسکتا جب تک کہ ایسا کرنے کے لئے قانونی بنیاد نہ ہو، قواعد و ضوابط کے مطابق. عام طور پر، اس کا مطلب یہ ہے کہ یہ قانونی ذمہ داریوں کے مطابق ہونا ضروری ہے، اور صرف واضح ہونے کے بعد، اچھی طرح سے مطلع رضامندی کے اعداد و شمار سے حاصل کی گئی ہے.<br /><br /></div>

<div dir="rtl">وقت میں، قوانین تبدیل کر سکتے ہیں. لہذا، پرانے معلومات کو پھیلانے سے بچنے کے لۓ، یہ مستند ذریعہ سے سیکھنا بہتر ہوگا. اگر میں براہ راست یہاں معلومات شامل ہوں تو، یہ تاریخ سے باہر ہوسکتا ہے.<br /><br /></div>

<div dir="rtl">مزید معلومات سیکھنے کے لئے کچھ سفارش کردہ وسائل:<br /></div>
<div dir="rtl"><ul>
 <li><a href="https://ur.wikipedia.org/wiki/%D8%AC%D9%86%D8%B1%D9%84_%DA%88%DB%8C%D9%B9%D8%A7_%D9%BE%D8%B1%D9%88%D9%B9%DB%8C%DA%A9%D8%B4%D9%86_%D8%B1%DB%8C%DA%AF%D9%88%D9%84%DB%8C%D8%B4%D9%86">جنرل ڈیٹا پروٹیکشن ریگولیشن</a></li>
 <li><a href="https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679">REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL</a></li>
</ul></div>

---


<div dir="rtl">آخری تازہ کاری: 16 اکتوبر 2018 (2018.10.16).</div>
