## phpMussel 中文（傳統）文檔。
（自動翻譯與穀歌翻譯從中文簡體至中文傳統）

### 內容
- 1. [前言](#SECTION1)
- 2A. [如何安裝（WEB服務器）](#SECTION2A)
- 2B. [如何安裝（CLI）](#SECTION2B)
- 3A. [如何使用（WEB服務器）](#SECTION3A)
- 3B. [如何使用（CLI）](#SECTION3B)
- 4A. [瀏覽器命令](#SECTION4A)
- 4B. [CLI（命令行界面）](#SECTION4B)
- 5. [文件在包](#SECTION5)
- 6. [配置選項](#SECTION6)
- 7. [簽名格式](#SECTION7)
- 8. [已知的兼容問題](#SECTION8)

---


###1. <a name="SECTION1"></a>前言

感謝使用phpMussel，這是一個根據ClamAV的簽名和其他簽名在上傳完成後來自動檢測木馬/病毒/惡意軟件和其他可能威脅到您系統安全的文件的PHP腳本。

PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan)。

本腳本是基於GNU通用許可V2.0版許可協議發布的，您可以在許可協議的允許範圍內自行修改和發布，但請遵守GNU通用許可協議。使用腳本的過程中，作者不提供任何擔保和任何隱含擔保。更多的細節請參見GNU通用公共許可證，下的`LICENSE.txt`文件也可從訪問：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

謝謝[ClamAV](http://www.clamav.net/)為本腳本提供文件簽名庫訪問許可。沒有它，這個腳本很可能不會存在，或者其價值有限。

謝謝Sourceforge和GitHub開通了，[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)的phpMussel的討論論壇，謝謝為phpMussel提供簽名文件的：[SecuriteInfo.com](http://www.securiteinfo.com/)，[PhishTank](http://www.phishtank.com/)，[NLNetLabs](http://nlnetlabs.nl/)，還有更多的我忘了提及的人（抱歉，語文水平有限，這句話實在不知道怎麼翻譯才通順）。

現在phpMussel的代碼文件和關聯包可以從以下地址免費下載：
- [Sourceforge](http://phpmussel.sourceforge.net/)。
- [GitHub](https://github.com/Maikuolan/phpMussel/)。

---


###2A. <a name="SECTION2A"></a>如何安裝（WEB服務器）

我可能在將來會創建一個安裝程序來簡化安裝過程，但在之前，按照下面的這些安裝說明能在大多數的系統和CMS上成功安裝：

1） 在閱讀到這里之前，我假設您已經下載腳本的一個副本，已解壓縮其內容並保存在您的機器的某個地方。現在，您要決定將腳本放在您服務器上的哪些文件夾中，例如`/public_html/phpmussel/`或其他任何你覺得滿意和安全的地方。*上傳完成後，繼續閱讀。。*

2） 自定義（強烈推薦高級用戶，但不推薦業餘用戶或者新手使用這個方法），打開`phpmussel.ini`（位於內`vault`） - 這個文件包含所有phpMussel的可用配置選項。以上的每一個配置選項應有一個簡介來說明它是做什麼的和它的具有的功能。按照你認為合適的參數來調整這些選項，然後保存文件，關閉。

3） 上傳（phpMussel和它的文件）到你選定的文件夾（不需要包括`*.txt`/`*.md`文件，但大多數情況下，您應上傳所有的文件）。

4） 修改的`vault`文件夾權限為“755”。注意，主文件夾也應該是該權限，如果遇上其他權限問題，請修改對應文件夾和文件的權限。

5） 接下來，您需要為您的系統或CMS設定啟動phpMussel的鉤子。有幾種不同的方式為您的系統或CMS設定鉤子，最簡單的是在您的系統或CMS的核心文件的開頭中使用`require`或`include`命令直接包含腳本（這個方法通常會導致在有人訪問時每次都加載）。平時，這些都是存儲的在文件夾中，例如`/includes`，`/assets`或`/functions`等文件夾，和將經常被命名的某物例如`init.php`，`common_functions.php`，`functions.php`。這是根據您自己的情況決定的，並不需要完全遵守；如果您遇到困難，訪問phpMussel支持論壇和發送問題；可能其他用戶或者我自己也有這個問題並且解決了（您需要讓我們您在使用哪些CMS）。為了使用`require`或`include`，插入下面的代碼行到最開始的該核心文件，更換裡面的數據引號以確切的地址的`phpmussel.php`文件（本地地址，不是HTTP地址；它會類似於前面提到的vault地址）。（注意，本人不是PHP程序員，關於這一段僅僅是直譯，如有錯誤，請在對應項目上提交問題更正）。

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

保存文件，關閉，重新上傳。

-- 或替換 --

如果您使用Apache網絡服務器並且您可以訪問`php.ini`，您可以使用該`auto_prepend_file`指令為任何PHP請求創建附上的phpMussel。就像是：

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

或在該`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6） 到這裡，您已經完成安裝，現在您應測試phpMussel以確保它的正常運行！為了保護系統中的文件（或者應該翻譯為保護上傳的文件），可以嘗試通過常用的瀏覽器上傳的方式上傳包含在`_testfiles`文件夾內的內容到您的網站。如果一切正常，phpMussel應該出現阻止上傳信息，如果出現什麼不正常情況例如您使用了其他高級的功能或使用的其它類型的掃描，我建議嘗試它跟他們一起使用以確保都能工作正常。

---


###2B. <a name="SECTION2B"></a>如何安裝（CLI）

我可能在將來會創建一個安裝程序來簡化安裝過程，但在之前，按照這些說明將使phpMussel能使用CLI模式（請注意，在這個時候，CLI支持僅適用於Windows系統；Linux和其他系統支持請關注更高版本的phpMussel）：

1） 在閱讀到這里之前，我假設您已經下載腳本並且已經解壓縮並且保存在您指定的位置。

2） phpMussel需要PHP運行環境支持。如果您沒有安裝PHP，請安裝。

3） 自定義（強烈推薦高級用戶使用，但不推薦新手或沒有經驗的用戶使用）：打開`phpmussel.ini`（位於內`vault`） - 這個文件包含phpMussel所有的配置選項。每選項應有一個簡評以說明它做什麼和它的功能。按照您認為合適的參數調整這些選項，然後保存文件，關閉。

4） 您如果您創建一個批處理文件來自動加載的PHP和phpMussel，那麼使用phpMussel的CLI模式將更加方便。要做到這一點，打開一個純文本編輯器例如Notepad或Notepad++，輸入php.exe的完整路徑（注意是絕對路徑不是相對路徑），其次是一個空格，然後是`phpmussel.php`的路徑（同php.exe），最後，保存此文件使用一個".bat"擴展名放在常用的位置；在你指定的位置，能通過雙擊你保存的`.bat`文件來調用phpMussel。

5） 到這裡，您完成了CLI模式的安裝！當然您應測試以確保正常運行。如果要測試phpMussel，請通過phpMussel嘗試掃描`_testfiles`文件夾內提供的文件。

---


###3A. <a name="SECTION3A"></a>如何使用（對於WEB服務器）

phpMussel的目的是作為一個腳本並且能做到最小化安裝和開箱即用：如果正確地安裝的，它應就正常的工作。

文件上傳掃描是自動的和按照設定規則激活的，所以，您不需要做任何額外的事情。

另外，您能手動使用phpMussel掃描文件，文件夾或存檔當您需要時。要做到這一點，首先，您需要確保`phpmussel.ini`文件（`cleanup`｢清理｣必須關閉）的配置是正常的，然後通過任何一個PHP文件的鉤子至phpMussel，在您的代碼中添加以下代碼：

`phpMussel($what_to_scan,$output_type,$output_flatness);`

- `$what_to_scan`可以是字符串，數組，或多維數組，和表明什麼文件，收集的文件，文件夾和／或文件夾至掃描。
- `$output_type`是布爾，和表明什麼格式到回報掃描結果作為。False｢假／負｣指示關於功能以回報掃描結果作為整數（結果回報的-3表明問題是遇到關於phpMussel簽名文件或簽名MAP｢地圖｣文件和表明他們可能是失踪或損壞，-2表明損壞數據是檢測中掃描和因此掃描失敗完成，-1表明擴展或插件需要通過PHP以經營掃描是失踪和因此掃描失敗完成，0表明掃描目標不存在和因此沒有任何事為掃描，1表明掃描目標是成功掃描和沒有任何問題檢測，和2表明掃描目標是成功掃描和至少一些問題是檢測）。True｢真／正｣指示關於功能以回報掃描結果作為人類可讀文本。此外，在任一情況下，結果可以訪問通過全局變量後掃描是完成。變量是自選，確定作為False｢假／負｣作為標準。
- `$output_flatness`是布爾，表明如果回報掃描結果（如果有多掃描目標）作為數組或字符串。False｢假／負｣指示回報結果作為數組。True｢真／正｣負｣指示回報結果作為字符串。變量是自選，確定作為False｢假／負｣作為標準。

例子：

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

返回結果類似於（作為字符串）：

```
 Wed, 16 Sep 2013 02:49:46 +0000 Started.
 > Checking '/user_name/public_html/my_file.html':
 -> No problems found.
 Wed, 16 Sep 2013 02:49:47 +0000 Finished.
```

對一個簽名類型進行完整的檢查測試以及phpMussel如何掃描和使用簽名文件，請參閱｢簽名格式｣部分的自述文件。

如果您遇到任何誤報，如果您遇到無法檢測的新類型，或者關於簽名的其他任何問題，請聯繫我以便於後續的版本支持，該，如果您不聯繫我，我可能不會知道並在下一版本中進行處理。

如果您遇到誤報嚴重或者不需要檢測該簽名下的文件或者其他不需要使用簽名驗證的場景，請關閉簽名驗證，具體請參考｢瀏覽器命令｣部分的這個自述文件中的黑名單部分。

除了前面鎖說的的文件上傳掃描和自選掃描的其他文件和／或文件夾指定掃描外，phpMussel還提供掃描入站電子郵件正文功能。這個功能行為類似至標準`phpMussel()`功能，但只掃描電子郵件的簽名並且對照的ClamAV的數據。我不支持這些簽名在標準`phpMussel()`功能，因為這些電子郵件的簽名不太可能出現在你需要檢測的文件中，從而使得支持這些簽名能將會毫無意義。但是，擁有一個單獨功能以對比這些簽名可以證明是極有用的，為一部分特別是那些CMS或系統是以任何方式直接連接在他們的電子郵件系統上和那些處理他們的電子郵件是通過一個PHP腳本的，他們可以配置鉤子使用郵件檢測這個功能，使用這個功能同樣是修改`phpmussel.ini`文件內的相關選項（您需要自己修改，意思就是不提供開箱即用支持）。然後在您使用的PHP文件中設定鉤子，就是在您的代碼中插入：

`phpMussel_mail($body);`

`$body`是您想掃描的電子郵件正文（您還可以嘗試掃描論壇新帖子，入站信息或您的在線聯繫方式頁面等等）。如果在掃描過程中發生任何錯誤導致無法完成掃描，將會返回一個數值-1。如果沒有發現任何問題，返回0（表明它是正常無害的）。如果這個發現任何東西，將會返回一個字符串包含它發現的信息。

除了上述，如果您看源代碼，您可能注意到這些功能`phpMusselD()`和`phpMusselR()`。這些功能是`phpMussel()`的子功能，和不應該叫直外的父功能（沒有直接提供是因為他們可能不能正確執行）。

有許多其他控制和功能可用在phpMussel中，其他沒有說明的功能，請繼續閱讀和參考這個自述文件的｢瀏覽器命令｣部分。

---


###3B. <a name="SECTION3B"></a>如何使用（CLI）

請參考｢如何安裝（對於CLI）｣部分的這個自述文件。

請注意，雖說未來版本的phpMussel應該支持其他系統，在這個時候，phpMussel CLI模式僅支持基於Windows系統（您可以，當然，嘗試它在其他系統，但我不能保證它正常工作）。

還注意，phpMussel是功能不完全的殺毒軟件，但是它不監控活動內存或檢測病毒自發地！它將會只檢測病毒從那些具體文件並且您需要明確地告訴它需要掃描哪些文件。

---


###4A. <a name="SECTION4A"></a>瀏覽器命令

假設您已經正確的安裝並且功能正常，如果您已經設置`script_password`和`logs_password`變量（訪問密碼）在您的配置文件中，通過您的瀏覽器您將會可以執行一些有限數的行政功能和輸入一些有限數的命令來執行phpMussel。這些密碼需要被設置來激活這些瀏覽器控制，以保證安全，如果您和／或其他網站管理員使用phpMussel不想要他們，請正確保護的這些瀏覽器控制和保證存在一個方法保證瀏覽器控制被完全關閉。換句話說，激活這些控制，需要設置一個密碼，設置沒有密碼則關閉這些控制，設。另外，如果您選擇激活這些控制和然後過段時間關閉這些控制，有一個命令以做這個。（這裡請參考英文原文）

以下原因是為什麼您應該激活這些控制：
- 提供一個自定義的簽名黑名單，例如當您發現一個簽名產生一個誤報，但是您沒有時間去手動編輯和重新上傳您的黑名單文件。
- 提供一個方法為您允許除了您自己外的其他人控制您的副本的phpMussel在沒有安全的可用FTP的情況下。
- 提供一個方法以供其他人或者程序訪問您的日誌文件。
- 提供一個簡易辦法來更新phpMussel（當更新可用時）。
- 提供一個方法為您監控phpMussel，當FTP訪問或其他常規訪問phpMussel不可用時。

有些原因為什麼你不應該激活這些控制：
- 提供一個為潛力攻擊者和不受歡迎的人查明您使用phpMussel，因為phpMussel可能存在漏洞或者其他問題，如果被查明則可能會被利用。
- 如果您設定的密碼被洩露，如果不變，可能會導致攻擊者自定義簽名檢測文件來繞過phpMussel檢測。

無論哪種方式，無論您選擇什麼樣的設置，最終選擇權在您，這裡僅提供建議，下面給出了一些未被提及的選項，如果您決定使用他們，這個部分說明如何激活和使用他們。

可用瀏覽器命令列表：

scan_log
- 密碼需要：`logs_password`
- 其他需要：您需要確定`scan log`指令。
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?logspword=[logs_password]&phpmussel=scan_log`
- 它的作用：打印您的`scan log`文件內容到屏幕。

scan_kills
- 密碼需要：`logs_password`
- 其他需要：您需要確定`scan kills`指令。
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?logspword=[logs_password]&phpmussel=scan_kills`
- 它的作用：打印您的`scan_kills`文件內容到屏幕。

controls_lockout
- 密碼需要：`logs_password`或`script_password`
- 其他需要：不需要
- 需要參數：不需要
- 自選參數：不需要
- 例子1：`?logspword=[logs_password]&phpmussel=controls_lockout`
- 例子2：`?pword=[script_password]&phpmussel=controls_lockout`
- 它的作用：關閉所有瀏覽器控制。這個應該使用如果您疑似任一您的密碼已成為妥協（這個可以發生如果您使用這些控制從一個不安全和／或不信賴計算機）。`controls_lockout`執行途經創建一個文件，`controls.lck`，在您的安全／保險庫｢Vault｣文件夾，哪裡phpMussel將尋找之前執行任何類型的命令。當這個發生，以重新激活控制，您需要手動刪除`controls.lck`文件通過FTP或類似。可以使叫使用任一密碼。

disable
- 密碼需要：`script_password`
- 其他需要：不需要
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=disable`
- 它的作用：關閉phpMussel。這個應該使用如果您執行任何更新或修改在您的系統或如果您安裝任何新軟件或模塊在您的系統哪裡可能的可以扳機假陽性。這個還應該使用如果您遇到任何問題從phpMussel但您不想去掉它從您的系統。當這個發生，以重新激活phpMussel，使用“enable”。

enable
- 密碼需要：`script_password`
- 其他需要：不需要
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=enable`
- 它的作用：激活phpMussel。這個應該使用如果您先前關閉phpMussel通過“disable”和想重新激活它。

update
- 密碼需要：`script_password`
- 其他需要：`update.dat`和`update.inc`必須存在。
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=update`
- 它的作用：查找更新的phpMussel和他的簽名。如果更新是發現，這個命令將嘗試下載和安裝這些更新。如果更新不發現或失敗，更新將退出。整個過程結果是印刷到屏幕。我推薦檢查至少一次每月以確保您的簽名和您的phpMussel是最新（除非，當然，您手動更新一切，但我依然推薦更新至少一次每月）。更新更頻繁是可能毫無意義，考慮到我不太可能有能力的產生任何類型更新更頻繁比這（也不我實在想）。

greylist
- 密碼需要：`script_password`
- 其他需要：不需要
- 需要參數：【需要添加到黑名單的簽名】
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=greylist&musselvar=[签名]`
- 它的作用：添加一個簽名在黑名單。

greylist_clear
- 密碼需要：`script_password`
- 其他需要：不需要
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=greylist_clear`
- 它的作用：刪除整個黑名單。

greylist_show
- 密碼需要：`script_password`
- 其他需要：不需要
- 需要參數：不需要
- 自選參數：不需要
- 例子：`?pword=[script_password]&phpmussel=greylist_show`
- 它的作用：打印內容的黑名單到屏幕。

---


###4B. <a name="SECTION4B"></a>CLI（命令行界面）

在Windows系統上phpMussel在CLI模式可以作為一個互動文件執行掃描。參考｢如何安裝（對於CLI）｣部分的這個自述文件為更信息。

為一個列表的可用CLI命令，在CLI提示，鍵入【c】，和按Enter鍵。

---


###5. <a name="SECTION5"></a>文件在包
（本段文件採用的自動翻譯，因為都是一些文件描述，參考意義不是很大，如有疑問，請參考英文原版）

下面是一個列表的所有的文件該應該是存在在您的存檔在下載時間，任何文件該可能創建因之的您的使用這個腳本，包括一個簡短說明的他們的目的。

文件 | 說明
----|----
/.gitattributes | GitHub文件（不需要為正確經營腳本）。
/composer.json | Composer/Packagist 信息（不需要為正確經營腳本）。
/CONTRIBUTING.md | 相關信息如何有助於該項目。
/LICENSE.txt | GNU/GPLv2 執照文件。
/PEOPLE.md | 人民捲入到該項目。
/phpmussel.php | 加載文件（它加載主腳本，更新文件，和等等）。這個是文件您應該｢鉤子｣（必不可少）!
/README.md | 項目概要信息。
/web.config | 一個ASP.NET配置文件（在這種情況，以保護`/vault`文件夾從被訪問由非授權來源在事件的腳本是安裝在服務器根據ASP.NET技術）。
/_docs/ | 筆記文件夾（包含若干文件）。
/_docs/change_log.txt | 記錄的變化做出至腳本間不同版本（不需要為正確經營腳本）。
/_docs/readme.ar.md | 阿拉伯文自述文件。
/_docs/readme.de.md | 德文自述文件。
/_docs/readme.de.txt | 德文自述文件。
/_docs/readme.en.md | 英文自述文件。
/_docs/readme.en.txt | 英文自述文件。
/_docs/readme.es.md | 西班牙文自述文件。
/_docs/readme.es.txt | 西班牙文自述文件。
/_docs/readme.fr.md | 法文自述文件。
/_docs/readme.fr.txt | 法文自述文件。
/_docs/readme.id.md | 印度尼西亞文自述文件。
/_docs/readme.id.txt | 印度尼西亞文自述文件。
/_docs/readme.it.md | 意大利文自述文件。
/_docs/readme.it.txt | 意大利文自述文件。
/_docs/readme.nl.md | 荷蘭文自述文件。
/_docs/readme.nl.txt | 荷蘭文自述文件。
/_docs/readme.pt.md | 葡萄牙文自述文件。
/_docs/readme.pt.txt | 葡萄牙文自述文件。
/_docs/readme.ru.md | 俄文自述文件。
/_docs/readme.ru.txt | 俄文自述文件。
/_docs/readme.vi.md | 越南文自述文件。
/_docs/readme.vi.txt | 越南文自述文件。
/_docs/readme.zh-TW.md | 中文（簡體）自述文件。
/_docs/readme.zh.md | 中文（簡體）自述文件。
/_docs/signatures_tally.txt | 文件為數量追踪的為包含的簽名（不需要為正確經營腳本）。
/_testfiles/ | 測試文件文件夾（包含若干文件）。所有包含文件是測試文件為測試如果phpMussel是正確地安裝上您的系統，和您不需要上傳這個文件夾或任何其文件除為上傳測試。
/_testfiles/ascii_standard_testfile.txt | 測試文件以測試phpMussel標準化ASCII簽名。
/_testfiles/coex_testfile.rtf | 測試文件以測試phpMussel複雜擴展簽名。
/_testfiles/exe_standard_testfile.exe | 測試文件以測試phpMussel移植可執行｢PE｣簽名。
/_testfiles/general_standard_testfile.txt | 測試文件以測試phpMussel通用簽名。
/_testfiles/graphics_standard_testfile.gif | 測試文件以測試phpMussel圖像簽名。
/_testfiles/html_standard_testfile.html | 測試文件以測試phpMussel標準化HTML簽名。
/_testfiles/md5_testfile.txt | 測試文件以測試phpMussel MD5簽名。
/_testfiles/metadata_testfile.tar | 測試文件以測試phpMussel元數據簽名和以測試TAR文件支持在您的系統。
/_testfiles/metadata_testfile.txt.gz | 測試文件以測試phpMussel元數據簽名和以測試GZ文件支持在您的系統。
/_testfiles/metadata_testfile.zip | 測試文件以測試phpMussel元數據簽名和以測試ZIP文件支持在您的系統。
/_testfiles/ole_testfile.ole | 測試文件以測試phpMussel OLE簽名。
/_testfiles/pdf_standard_testfile.pdf | 測試文件以測試phpMussel PDF簽名。
/_testfiles/pe_sectional_testfile.exe | 測試文件以測試phpMussel移植可執行｢PE｣部分簽名。
/_testfiles/swf_standard_testfile.swf | 測試文件以測試phpMussel SWF簽名。
/_testfiles/xdp_standard_testfile.xdp | 測試文件以測試phpMussel XML/XDP塊簽名。
/vault/ | 安全／保險庫｢Vault｣文件夾（包含若干文件）。
/vault/.htaccess | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/cache/ | 緩存｢Cache｣文件夾（為臨時數據）。
/vault/cache/.htaccess | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/cli.inc | CLI處理文件。
/vault/config.inc | 配置處理文件。
/vault/controls.inc | 控制處理文件。
/vault/functions.inc | 功能處理文件（必不可少）。
/vault/greylist.csv | 灰名單簽名CSV（逗號分隔變量）文件說明為phpMussel什麼簽名它應該忽略（文件自動重新創建如果刪除）。
/vault/lang.inc | 語音數據。
/vault/lang/ | 包含phpMussel語言數據。
/vault/lang/.htaccess | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/lang/lang.ar.inc | 阿拉伯文語言數據。
/vault/lang/lang.de.inc | 德文語言數據。
/vault/lang/lang.en.inc | 英文語言數據。
/vault/lang/lang.es.inc | 西班牙文語言數據。
/vault/lang/lang.fr.inc | 法文語言數據。
/vault/lang/lang.id.inc | 印度尼西亞文語言數據。
/vault/lang/lang.it.inc | 意大利文語言數據。
/vault/lang/lang.ja.inc | 日文語言數據。
/vault/lang/lang.nl.inc | 荷蘭文語言數據。
/vault/lang/lang.pt.inc | 葡萄牙文語言數據。
/vault/lang/lang.ru.inc | 俄文語言數據。
/vault/lang/lang.vi.inc | 越南文語言數據。
/vault/lang/lang.zh-TW.inc | 中文（傳統）語言數據。
/vault/lang/lang.zh.inc | 中文（簡體）語言數據。
/vault/phpmussel.ini | 配置文件；包含所有配置指令為phpMussel，告訴它什麼做和怎麼正確地經營（必不可少）！
/vault/quarantine/ | 隔離文件夾（包含隔離文件）。
/vault/quarantine/.htaccess | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
※ /vault/scan_kills.txt | 記錄的所有上傳文件phpMussel受阻／殺。
※ /vault/scan_log.txt | 記錄的一切phpMussel掃描。
※ /vault/scan_log_serialized.txt | 記錄的一切phpMussel掃描。
/vault/signatures/ | 簽名文件夾（包含簽名文件）。
/vault/signatures/.htaccess | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/signatures/ascii_clamav_regex.cvd | 標準化ASCII簽名文件。
/vault/signatures/ascii_clamav_regex.map | 標準化ASCII簽名文件。
/vault/signatures/ascii_clamav_standard.cvd | 標準化ASCII簽名文件。
/vault/signatures/ascii_clamav_standard.map | 標準化ASCII簽名文件。
/vault/signatures/ascii_custom_regex.cvd | 標準化ASCII簽名文件。
/vault/signatures/ascii_custom_standard.cvd | 標準化ASCII簽名文件。
/vault/signatures/ascii_mussel_regex.cvd | 標準化ASCII簽名文件。
/vault/signatures/ascii_mussel_standard.cvd | 標準化ASCII簽名文件。
/vault/signatures/coex_clamav.cvd | 複雜擴展簽名文件。
/vault/signatures/coex_custom.cvd | 複雜擴展簽名文件。
/vault/signatures/coex_mussel.cvd | 複雜擴展簽名文件。
/vault/signatures/elf_clamav_regex.cvd | ELF簽名文件。
/vault/signatures/elf_clamav_regex.map | ELF簽名文件。
/vault/signatures/elf_clamav_standard.cvd | ELF簽名文件。
/vault/signatures/elf_clamav_standard.map | ELF簽名文件。
/vault/signatures/elf_custom_regex.cvd | ELF簽名文件。
/vault/signatures/elf_custom_standard.cvd | ELF簽名文件。
/vault/signatures/elf_mussel_regex.cvd | ELF簽名文件。
/vault/signatures/elf_mussel_standard.cvd | ELF簽名文件。
/vault/signatures/exe_clamav_regex.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_clamav_regex.map | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_clamav_standard.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_clamav_standard.map | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_custom_regex.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_custom_standard.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_mussel_regex.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/exe_mussel_standard.cvd | 移植可執行｢PE｣簽名文件。
/vault/signatures/filenames_clamav.cvd | 文件名簽名文件。
/vault/signatures/filenames_custom.cvd | 文件名簽名文件。
/vault/signatures/filenames_mussel.cvd | 文件名簽名文件。
/vault/signatures/general_clamav_regex.cvd | 通用簽名文件。
/vault/signatures/general_clamav_regex.map | 通用簽名文件。
/vault/signatures/general_clamav_standard.cvd | 通用簽名文件。
/vault/signatures/general_clamav_standard.map | 通用簽名文件。
/vault/signatures/general_custom_regex.cvd | 通用簽名文件。
/vault/signatures/general_custom_standard.cvd | 通用簽名文件。
/vault/signatures/general_mussel_regex.cvd | 通用簽名文件。
/vault/signatures/general_mussel_standard.cvd | 通用簽名文件。
/vault/signatures/graphics_clamav_regex.cvd | 圖像簽名文件。
/vault/signatures/graphics_clamav_regex.map | 圖像簽名文件。
/vault/signatures/graphics_clamav_standard.cvd | 圖像簽名文件。
/vault/signatures/graphics_clamav_standard.map | 圖像簽名文件。
/vault/signatures/graphics_custom_regex.cvd | 圖像簽名文件。
/vault/signatures/graphics_custom_standard.cvd | 圖像簽名文件。
/vault/signatures/graphics_mussel_regex.cvd | 圖像簽名文件。
/vault/signatures/graphics_mussel_standard.cvd | 圖像簽名文件。
/vault/signatures/hex_general_commands.csv | 十六進制編碼的CSV（逗號分隔變量）為通用命令檢測，使用可選通過phpMussel。
/vault/signatures/html_clamav_regex.cvd | 標準化HTML簽名文件。
/vault/signatures/html_clamav_regex.map | 標準化HTML簽名文件。
/vault/signatures/html_clamav_standard.cvd | 標準化HTML簽名文件。
/vault/signatures/html_clamav_standard.map | 標準化HTML簽名文件。
/vault/signatures/html_custom_regex.cvd | 標準化HTML簽名文件。
/vault/signatures/html_custom_standard.cvd | 標準化HTML簽名文件。
/vault/signatures/html_mussel_regex.cvd | 標準化HTML簽名文件。
/vault/signatures/html_mussel_standard.cvd | 標準化HTML簽名文件。
/vault/signatures/macho_clamav_regex.cvd | Mach-O簽名文件。
/vault/signatures/macho_clamav_regex.map | Mach-O簽名文件。
/vault/signatures/macho_clamav_standard.cvd | Mach-O簽名文件。
/vault/signatures/macho_clamav_standard.map | Mach-O簽名文件。
/vault/signatures/macho_custom_regex.cvd | Mach-O簽名文件。
/vault/signatures/macho_custom_standard.cvd | Mach-O簽名文件。
/vault/signatures/macho_mussel_regex.cvd | Mach-O簽名文件。
/vault/signatures/macho_mussel_standard.cvd | Mach-O簽名文件。
/vault/signatures/mail_clamav_regex.cvd | 電子郵件簽名文件。
/vault/signatures/mail_clamav_regex.map | 電子郵件簽名文件。
/vault/signatures/mail_clamav_standard.cvd | 電子郵件簽名文件。
/vault/signatures/mail_clamav_standard.map | 電子郵件簽名文件。
/vault/signatures/mail_custom_regex.cvd | 電子郵件簽名文件。
/vault/signatures/mail_custom_standard.cvd | 電子郵件簽名文件。
/vault/signatures/mail_mussel_regex.cvd | 電子郵件簽名文件。
/vault/signatures/mail_mussel_standard.cvd | 電子郵件簽名文件。
/vault/signatures/md5_clamav.cvd | 基於MD5簽名文件。
/vault/signatures/md5_custom.cvd | 基於MD5簽名文件。
/vault/signatures/md5_mussel.cvd | 基於MD5簽名文件。
/vault/signatures/metadata_clamav.cvd | 存檔元數據簽名文件。
/vault/signatures/metadata_custom.cvd | 存檔元數據簽名文件。
/vault/signatures/metadata_mussel.cvd | 存檔元數據簽名文件。
/vault/signatures/ole_clamav_regex.cvd | OLE簽名文件。
/vault/signatures/ole_clamav_regex.map | OLE簽名文件。
/vault/signatures/ole_clamav_standard.cvd | OLE簽名文件。
/vault/signatures/ole_clamav_standard.map | OLE簽名文件。
/vault/signatures/ole_custom_regex.cvd | OLE簽名文件。
/vault/signatures/ole_custom_standard.cvd | OLE簽名文件。
/vault/signatures/ole_mussel_regex.cvd | OLE簽名文件。
/vault/signatures/ole_mussel_standard.cvd | OLE簽名文件。
/vault/signatures/pdf_clamav_regex.cvd | PDF簽名文件。
/vault/signatures/pdf_clamav_regex.map | PDF簽名文件。
/vault/signatures/pdf_clamav_standard.cvd | PDF簽名文件。
/vault/signatures/pdf_clamav_standard.map | PDF簽名文件。
/vault/signatures/pdf_custom_regex.cvd | PDF簽名文件。
/vault/signatures/pdf_custom_standard.cvd | PDF簽名文件。
/vault/signatures/pdf_mussel_regex.cvd | PDF簽名文件。
/vault/signatures/pdf_mussel_standard.cvd | PDF簽名文件。
/vault/signatures/pex_custom.cvd | 移植可執行｢PE｣擴展簽名文件。
/vault/signatures/pex_mussel.cvd | 移植可執行｢PE｣擴展簽名文件。
/vault/signatures/pe_clamav.cvd | 移植可執行｢PE｣部分簽名文件。
/vault/signatures/pe_custom.cvd | 移植可執行｢PE｣部分簽名文件。
/vault/signatures/pe_mussel.cvd | 移植可執行｢PE｣部分簽名文件。
/vault/signatures/swf_clamav_regex.cvd | SWF簽名文件。
/vault/signatures/swf_clamav_regex.map | SWF簽名文件。
/vault/signatures/swf_clamav_standard.cvd | SWF簽名文件。
/vault/signatures/swf_clamav_standard.map | SWF簽名文件。
/vault/signatures/swf_custom_regex.cvd | SWF簽名文件。
/vault/signatures/swf_custom_standard.cvd | SWF簽名文件。
/vault/signatures/swf_mussel_regex.cvd | SWF簽名文件。
/vault/signatures/swf_mussel_standard.cvd | SWF簽名文件。
/vault/signatures/switch.dat | 控制和確定某些變量。
/vault/signatures/urlscanner.cvd | URL掃描儀簽名文件。
/vault/signatures/whitelist_clamav.cvd | 文件具體白名單。
/vault/signatures/whitelist_custom.cvd | 文件具體白名單。
/vault/signatures/whitelist_mussel.cvd | 文件具體白名單。
/vault/signatures/xmlxdp_clamav_regex.cvd | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_clamav_regex.map | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_clamav_standard.cvd | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_clamav_standard.map | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_custom_regex.cvd | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_custom_standard.cvd | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_mussel_regex.cvd | XML/XDP塊簽名文件。
/vault/signatures/xmlxdp_mussel_standard.cvd | XML/XDP塊簽名文件。
/vault/template.html | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/template_custom.html | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/update.dat | 文件包含版本信息為phpMussel的腳本和phpMussel的簽名。如果您隨時需要自動更新phpMussel或需要更新phpMussel通過您的瀏覽器，這個文件是必不可少。
/vault/update.inc | 更新腳本；需要為自動更新和為更新phpMussel通過您的瀏覽器，但不否則需要。
/vault/upload.inc | 上傳處理文件。

※ 文件名可能不同基於配置規定（在`phpmussel.ini`）。

####*關於簽名文件*
（這裡是關於phpMussel引用的簽名文件來源以及格式說明，請參考英文部分以及簽名文件提供商的說明）
CVD是一個acronym為｢ClamAV Virus Definitions｣，在參照如何ClamAV參考它自己的簽名和在參的用法的那些簽名在phpMussel；文件名結尾有｢CVD｣包含簽名。

文件名結尾有｢MAP｣繪製該簽名phpMussel應該和不應該使用為獨特掃描；不所有簽名是一定需要為所有獨特掃描，所以，phpMussel使用簽名地圖文件以加快掃描過程（一個過程該否則將會極其緩慢和乏味）。

簽名文件標有“_regex”包含簽名使用正則表達式｢REGEX｣掃描。

簽名文件標有“_standard”包含簽名特別是不使用任何類型的特殊式或正則表達式掃描。

簽名文件標有不“_regex”也不“_standard”將會作為一個或其他，但不二者（參考｢簽名格式｣部分的這個自述文件為詳細信息）。

簽名文件標有“_clamav”包含簽名完全從ClamAV的數據庫（GNU/GPL）。

簽名文件標有“_custom”按說不包含任何簽名；這些文件存在以給您某處為放置您自己的個性化簽名，如果您創建任何您自己的。

簽名文件標有“_mussel”包含簽名特別是不從ClamAV，簽名該大體，我親自創建和／或基於信息雲集從雜項來源。

---


###6. <a name="SECTION6"></a>配置選項
下列是一個列表的變量發現在`phpmussel.ini`配置文件的phpMussel，以及一個說明的他們的目的和功能。

####"general" （類別）
基本phpMussel配置。

“script_password”
- 為方便，phpMussel將允許某些功能（包括phpMussel的更新能力）成為手動引發通過POST，GET和QUERY。然而，作為一種安全措施，要做到這一點，phpMussel將期待一個密碼是包括隨著命令，以確保它是您，和不其他人，嘗試手動引發這些功能。設置`script_password`到什麼密碼您將想用。如果沒有密碼是設置，手動引發將會關閉作為標準。使用某物您將記得但某物難為其他人猜測。
- 無影響在CLI模式。

“logs_password”
- 相同作為`script_password`，但為查看`scan_log`內容和`scan_kills`。分離的密碼可以有用如果您想給其他人訪問在一套的功能但不其他套。
- 無影響在CLI模式。

“cleanup”
- ｢反設置／刪除／清潔｣腳本變量和緩存｢Cache｣之後執行嗎？如果您不使用腳本外初始上傳掃描，應該設置True｢真／正｣，為了最小化內存使用。如果您使用腳本為目的外初始上傳掃描，應該設置False｢假／負｣，為了避免不必要重新加載複製數據在內存。在一般的做法，它應該設置True｢真／正｣，但，如果您做這樣，您將不能夠使用腳本為任何目的以外文件上傳掃描。
- 無影響在CLI模式。

“scan_log”
- 文件為記錄在所有掃描結果。指定一個文件名，或留空以關閉。

“scan_log_serialized”
- 文件為記錄在所有掃描結果（它採用序列化格式）。指定一個文件名，或留空以關閉。

“scan_kills”
- 文件為記錄在所有受阻或已殺上傳。指定一個文件名，或留空以關閉。

“ipaddr”
- 在哪裡可以找到連接請求IP地址？（可以使用為服務例如Cloudflare和類似）標準是`REMOTE_ADDR`。警告！不要修改此除非您知道什麼您做著！

“forbid_on_block”
- phpMussel應該發送`403`頭隨著文件上傳受阻信息，或堅持標準`200 OK`？ False = 發送`200`【標準】； True = 發送`403`。

“delete_on_sight”
- 激活的這個指令將指示腳本馬上刪除任何掃描文件上傳匹配任何檢測標準，是否通過簽名或任何事其他。文件已確定是清潔將會忽略。如果是存檔，全存檔將會刪除，不管如果違規文件是只有一個的幾個文件包含在存檔。為文件上傳掃描，按說，它不必要為您激活這個指令，因為按說，PHP將自動清洗內容的它的緩存當執行是完，意思它將按說刪除任何文件上傳從它向服務器如果不已移動，複製或刪除。這個指令是添加這里為額外安全為任何人誰的PHP副本可能不始終表現在預期方式。False｢假／負｣：之後掃描，忽略文件【標準】，True｢真／正｣：之後掃描，如果不清潔，馬上刪除。

“lang”
- 指定標準phpMussel語言。

“lang_override”
- 指定如果phpMussel應該，當可能，更換語言規範通過語言偏愛聲明從入站請求（HTTP_ACCEPT_LANGUAGE）。 False：不更換【標準】； True：更換。

“lang_acceptable”
- `lang_acceptable`指令指示phpMussel什麼語言可以接受在腳本從`lang`或從`HTTP_ACCEPT_LANGUAGE`。這個指令應該只會修改如果您添加您自己的個性化語言文件或強制去掉語言文件。指令是一個逗號分隔字符串的代碼使用通過那些語言接受在腳本。

“quarantine_key”
- phpMussel可以檢疫壞文件上傳在隔離在phpMussel的安全／保險庫｢Vault｣，如果這個是某物您想。普通用戶的phpMussel簡單地想保護他們的網站或宿主環境無任何興趣在深深分析任何嘗試文件上傳應該離開這個功能關閉，但任何用戶有興趣在更深分析的嘗試文件上傳為目的惡意軟件研究或為類似這樣事情應該激活這個功能。檢疫的嘗試文件上傳可以有時還助攻在調試假陽性，如果這個是某物經常發生為您。以關閉檢疫功能，簡單地離開`quarantine_key`指令空白，或抹去內容的這個指令如果它不已空白。以激活隔離功能，輸入一些值在這個指令。`quarantine_key`是一個重要安全功能的隔離功能需要以預防檢疫功能從成為利用通過潛在攻擊者和以預防任何潛在執行的數據存儲在檢疫。`quarantine_key`應該被處理在同樣方法作為您的密碼：更長是更好，和緊緊保護它。為獲得最佳效果，在結合使用`delete_on_sight`。

“quarantine_max_filesize”
- 最大允許文件大小為文件在檢疫。文件大於這個指定數值將不成為檢疫。這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。數值是在KB。 標準 =2048 =2048KB =2MB。

“quarantine_max_usage”
- 最大內存使用允許為檢疫。如果總內存已用通過隔離到達這個數值，最老檢疫文件將會刪除直到總內存已用不再到達這個數值。這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。數值是在KB。 標準 =65536 =65536KB =64MB。

“honeypot_mode”
- 當這個指令（蜜罐模式）是激活，phpMussel將嘗試檢疫所有文件上傳它遇到，無論的如果文件上傳是匹配任何包括簽名，和沒有掃描或分析的那些文件上傳將發生。這個功能應有用為那些想使用的phpMussel為目的病毒或惡意軟件研究，但它是不推薦激活這個功能如果預期的用的phpMussel通過用戶是為標準文件上傳掃描，也不推薦使用蜜罐功能為目的以外蜜罐。作為標準，這個指令是關閉。 False = 是關閉【標準】； True = 是激活。

“scan_cache_expiry”
- 多長時間應該phpMussel維持掃描結果？數值是秒數為維持掃描結果。標準是21600秒（6小時）；一個`0`數值將停止維持掃描結果。

“disable_cli”
- 關閉CLI模式嗎？CLI模式是按說激活作為標準，但可以有時干擾某些測試工具（例如PHPUnit，為例子）和其他基於CLI應用。如果您沒有需要關閉CLI模式，您應該忽略這個指令。 False = 激活CLI模式【標準】； True = 關閉CLI模式。

####"signatures" （類別）
簽名配置。
- %%%_clamav = ClamAV簽名（二者mains和daily）。
- %%%_custom = 您的個性化簽名（如果您寫任何）。
- %%%_mussel = phpMussel簽名已包括在您的當前簽名文件不從ClamAV。

檢查針對MD5簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “md5_clamav”
- “md5_custom”
- “md5_mussel”

檢查針對通用簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “general_clamav”
- “general_custom”
- “general_mussel”

檢查針對標準化ASCII簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “ascii_clamav”
- “ascii_custom”
- “ascii_mussel”

檢查針對標準化HTML簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “html_clamav”
- “html_custom”
- “html_mussel”

檢查移植可執行｢PE｣文件（EXE文件，DLL文件，等等）針對移植可執行｢PE｣部分簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “pe_clamav”
- “pe_custom”
- “pe_mussel”

檢查移植可執行｢PE｣文件（EXE文件，DLL文件，等等）針對移植可執行｢PE｣擴展簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “pex_custom”
- “pex_mussel”

檢查移植可執行｢PE｣文件（EXE文件，DLL文件，等等）針對移植可執行｢PE｣簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “exe_clamav”
- “exe_custom”
- “exe_mussel”

檢查ELF文件針對ELF簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “elf_clamav”
- “elf_custom”
- “elf_mussel”

檢查Mach-O文件（OSX文件，等等）針對Mach-O簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “macho_clamav”
- “macho_custom”
- “macho_mussel”

檢查圖像文件針對基於圖像簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “graphics_clamav”
- “graphics_custom”
- “graphics_mussel”

檢查存檔內容針對存檔元數據簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “metadata_clamav”
- “metadata_custom”
- “metadata_mussel”

檢查OLE對象針對OLE簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “ole_clamav”
- “ole_custom”
- “ole_mussel”

檢查文件名針對基於文件名簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “filenames_clamav”
- “filenames_custom”
- “filenames_mussel”

允許掃描通過`phpMussel_mail()`嗎？ False = 不檢查， True = 檢查【默認】。
- “mail_clamav”
- “mail_custom”
- “mail_mussel”

激活具體文件白名單嗎？ False = 不檢查， True = 檢查【默認】。
- “whitelist_clamav”
- “whitelist_custom”
- “whitelist_mussel”

檢查XML/XDP塊針對XML/XDP塊簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “xmlxdp_clamav”
- “xmlxdp_custom”
- “xmlxdp_mussel”

檢查針對複雜擴展簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “coex_clamav”
- “coex_custom”
- “coex_mussel”

檢查針對PDF簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “pdf_clamav”
- “pdf_custom”
- “pdf_mussel”

檢查針對SWF簽名當掃描嗎？ False = 不檢查， True = 檢查【默認】。
- “swf_clamav”
- “swf_custom”
- “swf_mussel”

簽名匹配長度限制選項。只修改這些如果您知道什麼您做。 SD = 標準簽名。 RX = PCRE（Perl兼容的正則表達式，或"Regex"）簽名。 FN = 文件名簽名。 如果您通知PHP失敗當phpMussel嘗試掃描，嘗試降低這些"max"數值。如果可能和方便，讓我知道當這個發生和結果的什麼您嘗試。
- “fn_siglen_min”
- “fn_siglen_max”
- “rx_siglen_min”
- “rx_siglen_max”
- “sd_siglen_min”
- “sd_siglen_max”

“fail_silently”
- phpMussel應該報告當簽名文件是失踪或損壞嗎？如果`fail_silently`是關閉，失踪和損壞文件將會報告當掃描，和如果`fail_silently`是激活，失踪和損壞文件將會忽略，有掃描報告為那些文件哪裡沒有問題。這個應該按說被留下除非您遇到失敗或有其他類似問題。 False = 是關閉； True = 是激活【默認】。

“fail_extensions_silently”
- phpMussel應該報告當擴展是失踪嗎？如果`fail_extensions_silently`是關閉，失踪擴展將會報告當掃描，和如果`fail_extensions_silently`是激活，失踪擴展將會忽略，有掃描報告為那些文件哪裡沒有任何問題。關閉的這個指令可能的可以增加您的安全，但可能還導致一個增加的假陽性。 False = 是關閉； True = 是激活【默認】。

“detect_adware”
- phpMussel應該使用簽名為廣告軟件檢測嗎？ False = 不檢查， True = 檢查【默認】。

“detect_joke_hoax”
- phpMussel應該使用簽名為病毒／惡意軟件笑話／惡作劇檢測嗎？ False = 不檢查， True = 檢查【默認】。

“detect_pua_pup”
- phpMussel應該使用簽名為PUP/PUA（可能無用／非通緝程序／軟件）檢測嗎？ False = 不檢查， True = 檢查【默認】。

“detect_packer_packed”
- phpMussel應該使用簽名為打包機和打包數據檢測嗎？ False = 不檢查， True = 檢查【默認】。

“detect_shell”
- phpMussel應該使用簽名為webshell腳本檢測嗎？ False = 不檢查， True = 檢查【默認】。

“detect_deface”
- phpMussel應該使用簽名為污損的污損軟件檢測嗎？ False = 不檢查， True = 檢查【默認】。

####"files" （類別）
文件處理配置。

“max_uploads”
- 最大允許數值的文件為掃描當文件上傳掃描之前中止掃描和告訴用戶他們是上傳太多在同一時間！提供保護針對一個理論攻擊哪裡一個攻擊者嘗試DDoS您的系統或CMS通過超載phpMussel以減速PHP進程到一個停止。推薦：10。您可能想增加或減少這個數值，根據速度的您的硬件。注意這個數值不交待為或包括存檔內容。

“filesize_limit”
- 文件大小限在KB。 65536 = 64MB 【默認】，0 = 沒有限（始終灰名單），任何正數值接受。這個可以有用當您的PHP配置限內存量一個進程可以佔據或如果您的PHP配置限文件大小的上傳。

“filesize_response”
- 如何處理文件超過文件大小限（如果存在）。 False = 白名單； True = 黑名單【默認】。

“filetype_whitelist”, “filetype_blacklist”, “filetype_greylist”
- 如果您的系統只允許具體文件類型被上傳，或如果您的系統明確地否認某些文件類型，指定那些文件類型在白名單，黑名單和灰名單可以增加掃描執行速度通過允許腳本跳過某些文件類型。格式是CSV（逗號分隔變量）。如果您想掃描一切，而不是白名單，黑名單或灰名單，留變量空；這樣做將關閉白名單／黑名單／灰名單。
- 進程邏輯順序是：
  - 如果文件類型已白名單，不掃描和不受阻文件，和不匹配文件對照黑名單或灰名單。
  - 如果文件類型已黑名單，不掃描文件但阻止它無論如何，和不匹配文件對照灰名單。
  - 如果灰名單是空，或如果灰名單不空和文件類型已灰名單，掃描文件像正常和確定如果阻止它基於掃描結果，但如果灰名單不空和文件類型不灰名單，過程文件彷彿已黑名單，因此不掃描它但阻止它無論如何。

“check_archives”
- 嘗試匹配存檔內容嗎？ False = 不匹配； True = 匹配【默認】。
- 目前，只BZ，GZ，LZF和ZIP文件匹配是支持（匹配的RAR，CAB，7z和等等不還支持）。
- 這個是不完美！雖說我很推薦保持這個激活，我不能保證它將始終發現一切。
- 還，請注意存檔匹配目前是不遞歸為ZIP格式。

“filesize_archives”
- 繼承文件大小黑名單／白名單在存檔內容嗎？ False = 不繼承（剛灰名單一切）； True = 繼承【默認】。

“filetype_archives”
- 繼承文件類型黑名單／白名單在存檔內容嗎？ False = 不繼承（剛灰名單一切）； True = 繼承【默認】。

“max_recursion”
- 最大存檔遞歸深度限。 默認 = 10。

“block_encrypted_archives”
- 檢測和受阻加密的存檔嗎？因為phpMussel是不能夠掃描加密的存檔內容，它是可能存檔加密可能的可以使用通過一個攻擊者作為一種手段嘗試繞過phpMussel，殺毒掃描儀和其他這樣的保護。指示phpMussel受阻任何存檔它發現被加密可能的可以幫助減少任何風險有關聯這些可能性。 False = 不受阻； True = 受阻【默認】。

####"attack_specific" （類別）
專用攻擊指令。

蜴攻擊檢測： False = 是關閉； True = 是激活。

“chameleon_from_php”
- 尋找PHP頭在文件是不PHP文件也不認可存檔文件。

“chameleon_from_exe”
- 尋找可執行頭在文件是不可執行文件也不認可存檔文件和尋找可執行文件誰的頭是不正確。

“chameleon_to_archive”
- 尋找存檔文件誰的頭是不正確（已支持：BZ，GZ，RAR，ZIP，RAR，GZ）。

“chameleon_to_doc”
- 尋找辦公文檔誰的頭是不正確（已支持：DOC，DOT，PPS，PPT，XLA，XLS，WIZ）。

“chameleon_to_img”
- 尋找圖像誰的頭是不正確（已支持：BMP，DIB，PNG，GIF，JPEG，JPG，XCF，PSD，PDD，WEBP）。

“chameleon_to_pdf”
- 尋找PDF文件誰的頭是不正確。

“archive_file_extensions”和“archive_file_extensions_wc”
- 認可存檔文件擴展（格式是CSV；應該只添加或去掉當問題發生；不必要的去掉可能的可以導致假陽性出現為存檔文件，而不必要的增加將實質上白名單任何事您增加從專用攻擊檢測；修改有慎重；還請注這個無影響在什麼存檔可以和不能被分析在內容級）。這個名單，作為是作為標準，名單那些格式使用最常見的橫過多數的系統和CMS，但有意是不全面。

“general_commands”
- 搜索文件內容為通用命令例如`eval()`和`exec()`？ False = 不搜索【默認】； True = 搜索。 關閉這個指令如果您打算上傳任何的下列在您的系統或CMS通過您的瀏覽器：PHP，JavaScript，HTML，python，perl文件和等等。激活這個指令如果您不有任何另外保護在您的系統和不打算上傳這些文件。如果您使用另外安全在連詞的phpMussel例如ZB Block，沒有任何需要激活這個指令，因為最的什麼phpMussel將尋找（在上下文這個指令）是重複的保護已提供。

“block_control_characters”
- 受阻任何文件包含任何控製字符嗎（以外換行符）？ (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) 如果您只上傳純文本，您可以激活這個指令以提供某些另外保護在您的系統。然而，如果您上傳任何事以外純文本，激活這個可能結果在假陽性。 False = 不受阻【默認】； True = 受阻。

“corrupted_exe”
- 損壞文件和處理錯誤。 False = 忽略； True = 受阻【默認】。 檢測和受阻潛在的損壞移植可執行｢PE｣文件嗎？時常（但不始終），當某些零件的一個移植可執行｢PE｣文件是損壞或不能被正確處理，它可以建議建議的一個病毒感染。過程使用通過最殺毒程序以檢測病毒在PE文件需要處理那些文件在某些方式，哪裡，如果程序員的一個病毒是意識的，將特別嘗試防止，以允許他們的病毒留不檢測。

“decode_threshold”
- 可選限或門檻的長度的原始數據在其中解碼命令應該被檢測（如果有任何引人注目性能問題當掃描）。值是一個整數代表文件大小在KB。 默認 = 512 （512KB）。 零或空值將關閉門檻（去除任何這樣的限基於文件大小）。

“scannable_threshold”
- 可選限或門檻為原始數據長度phpMussel是允許為閱讀和掃描（如果有任何引人注目性能問題當掃描）。值是一個整數代表文件大小在KB。 默認 = 32768 （32MB）。 零或空值將關閉門檻。按說，這個數值應不會少於平均文件大小的文件上傳您想和期待收到您的服務器或網站，應不會多於`filesize_limit`指令，和應不會多於大致五分之一的總允許內存分配獲授PHP通過`php.ini`配置文件。這個指令存在為嘗試防止phpMussel從用的太多內存（這個將防止它從能夠順利掃描文件以上的一個特別文件大小）。

####"compatibility" （類別）
phpMussel兼容性指令。

“ignore_upload_errors”
- 這個指令按說應會關閉除非它是需要為對功能的phpMussel在您的具體系統。按說，當是關閉，當phpMussel檢測存在元素在`$_FILES`數組，它將嘗試引發一個掃描的文件代表通過那些元素，和，如果他們是空或空白，phpMussel將回報一個錯誤信息。這個是正確行為為phpMussel。然而，為某些CMS，空元素在`$_FILES`可以發生因之的自然的行為的那些CMS，或錯誤可能會報告當沒有任何，在這種情況，正常行為為phpMussel將會使乾擾為正常行為的那些CMS。如果這樣的一個情況發生為您，激活這個指令將指示phpMussel不嘗試引發掃描為這樣的空元素，忽略他們當發現和不回報任何關聯錯誤信息，從而允許延續的頁面請求。 False = 不忽略； True = 忽略。

“only_allow_images”
- 如果您只期待或只意味到允許圖像被上傳在您的系統或CMS，和如果您絕對不需要任何文件以外圖像被上傳在您的系統或CMS，這個指令應會激活，但其他應會關閉。如果這個指令是激活，它將指示phpMussel受阻而不例外任何上傳確定為非圖像文件，而不掃描他們。這個可能減少處理時間和內存使用為非圖像文件上傳嘗試。 False = 還允許其他文件； True = 只允許圖像文件。

####"heuristic" （類別）
啟發式指令。

“threshold”
- 有某些簽名的phpMussel意味為確定可疑和可能惡意文件零件被上傳有不在他們自己確定那些文件被上傳特別是作為惡意。這個“threshold”數值告訴phpMussel什麼是最大總重量的可疑和潛在惡意文件零件被上傳允許之前那些文件是被識別作為惡意。定義的重量在這個上下文是總數值的可疑和可能惡意文件零件確定。作為默認，這個數值將會設置作為3。一個較低的值通常將結果在一個更高的發生的假陽性但一個更高的發生的惡意文件被確定，而一個更高的數值將通常結果在一個較低的發生的假陽性但一個較低的數值的惡意文件被確定。它是通常最好忽略這個數值除非您遇到關聯問題。

####"virustotal" （類別）
VirusTotal.com指令。

“vt_public_api_key”
- 可選的，phpMussel可以掃描文件使用｢Virus Total API｣作為一個方法提供一個顯著的改善保護級別針對病毒，木馬，惡意軟件和其他威脅。作為默認，掃描文件使用｢Virus Total API｣是關閉。以激活它，一個API密鑰從VirusTotal是需要。因為的顯著好處這個可以提供為您，它是某物我很推薦激活。請注意，然而，以使用的｢Virus Total API｣，您必須同意他們的服務條款和您必須堅持所有方針按照說明通過VirusTotal閱讀材料！您是不允許使用這個積分功能除非：
  - 您已閱讀和您同意服務條款的VirusTotal和它的API。服務條款的VirusTotal和它的API可以發現[這裡](https://www.virustotal.com/en/about/terms-of-service/)。
  - 您已閱讀和您了解至少序言的VirusTotal公共API閱讀材料(一切之後“VirusTotal Public API v2.0”但之前“Contents”）。VirusTotal公共API閱讀材料可以發現[這裡](https://www.virustotal.com/en/documentation/public-api/)。

請注意：如果掃描文件使用｢Virus Total API｣是關閉，您不需要修改任何指令在這個類別（`virustotal`），因為沒有人將做任何事如果這個是關閉。以獲得一個VirusTotalAPI密鑰，從隨地在他們的網站，點擊“進入我們的社區”連接位於朝向右上方的頁面，輸入在信息請求，和點擊“註冊”在做完。跟隨所有指令提供，和當您有您的公共API密鑰，複製／粘貼您的公共API密鑰到`vt_public_api_key`指令的`phpmussel.ini`配置文件。

“vt_suspicion_level”
- 作為標準，phpMussel將限制什麼文件它掃描通過使用｢Virus Total API｣為那些文件它考慮作為“可疑”。您可以可選調整這個局限性通過修改的`vt_suspicion_level`指令數值。
- `0`:文件是只考慮可疑如果，當被掃描通過phpMussel使用它自己的簽名，他們是認為有一個啟發式重量。這個將有效意味使用的｢Virus Total API｣將會為一個第二個意見為當phpMussel懷疑一個文件可能的是惡意，但不能完全排除它可能還可能的被良性（非惡意）和因此將否則按說不受阻它或標誌它作為被惡意。
- `1`:文件是考慮可疑如果，當被掃描通過phpMussel使用它自己的簽名，他們是認為有一個啟發式重量，如果他們是已知被可執行（PE文件，Mach-O文件，ELF/Linux文件，等等），或如果他們是已知被的一個格式潛在的包含可執行數據（例如可執行宏，DOC/DOCX文件，存檔文件例如RAR格式，ZIP格式和等等）。這個是標準和推薦可疑級別到使用，有效意味使用的｢Virus Total API｣將會為一個第二個意見為當phpMussel不原來發現任何事惡意或錯在一個文件它考慮被可疑和因此將否則按說不受阻它或標誌它作為被惡意。
- `2`:所有文件是考慮可疑和應會掃描使用｢Virus Total API｣。我通常不推薦應用這個可疑級別，因為風險的到達您的API配額更快，但存在某些情況（例如當網站管理員或主機管理員有很少信仰或信任在任何的內容上傳從他們的用戶）哪裡這個可疑級別可以被適當。有使用的這個可疑級別，所有文件不按說受阻或標誌是作為被惡意將會掃描使用｢Virus Total API｣。請注意，然而，phpMussel將停止使用｢Virus Total API｣當您的API配額是到達（無論的可疑級別），和您的配額將會容易更快當使用這個可疑級別。

請注意：無論的可疑級別，任何文件任一已黑名單或已白名單通過phpMussel不會掃描使用｢Virus Total API｣，因為那些文件將會已標誌作為惡意或良性通過phpMussel到的時候他們將會否則掃描通過｢Virus Total API｣，和因此，另外掃描不會需要。能力的phpMussel掃描文件使用｢Virus Total API｣是意味為建更置信為如果一個文件是惡意或良性在那些情況哪裡phpMussel是不完全確定如果一個文件是惡意或良性。

“vt_weighting”
- phpMussel應使用掃描結果使用｢Virus Total API｣作為檢測或作為檢測重量嗎？這個指令存在，因為，雖說掃描一個文件使用多AV引擎（例如怎麼樣VirusTotal做）應結果有一個增加檢測率（和因此在一個更惡意文件被抓），它可以還結果有更假陽性，和因此，為某些情況，掃描結果可能被更好使用作為一個置信得分而不是作為一個明確結論。如果一個數值的`0`是使用，掃描結果使用｢Virus Total API｣將會適用作為檢測，和因此，如果任何AV引擎使用通過VirusTotal標致文件被掃描作為惡意，phpMussel將考慮文件作為惡意。如果任何其他數值是使用，掃描結果使用｢Virus Total API｣將會適用作為檢測重量，和因此，數的AV引擎使用通過VirusTotal標致文件被掃描作為惡意將服務作為一個置信得分（或檢測重量）為如果文件被掃描應會考慮惡意通過phpMussel（數值使用將代表最低限度的置信得分或重量需要以被考慮惡意）。一個數值的`0`是使用作為標準。

“vt_quota_rate”和“vt_quota_time”
- 根據｢Virus Total API｣閱讀材料，它是限於最大的`4`請求的任何類型在任何`1`分鐘大致時間。如果您經營一個“honeyclient”，蜜罐或任何其他自動化將會提供資源為VirusTotal和不只取回報告您是有權一個更高請求率配額。作為標準，phpMussel將嚴格的堅持這些限制，但因為可能性的這些率配額被增加，這些二指令是提供為您指示phpMussel為什麼限它應堅持。除非您是指示這樣做，它是不推薦為您增加這些數值，但，如果您遇到問題相關的到達您的率配額，減少這些數值可能有時幫助您解析這些問題。您的率限是決定作為`vt_quota_rate`請求的任何類型在任何`vt_quota_time`分鐘大致時間。

####"urlscanner" （類別）
URL掃描儀配置。

"urlscanner"
- 內phpMussel是一個URL掃描儀，能夠檢測惡意URL在任何數據或文件它掃描。以激活URL掃描儀，設置`urlscanner`指令`true`；以關閉它，設置這個指令`false`。

請注意：如果URL掃描儀已關閉，您將不需要復習任何指令在這個類別（`urlscanner`），因為沒有指令會做任何事如果這個已關閉。

URL掃描儀API配置。

"lookup_hphosts"
- 激活[hpHosts](http://hosts-file.net/) API當設置`true`。hpHosts不需要API密鑰為了執行API請求。

"google_api_key"
- 激活Google Safe Browsing API當API密鑰是設置。Google Safe Browsing API需要API密鑰，可以得到從[這裡](https://console.developers.google.com/)。
- 請注意：這是一個將來的功能！Google Safe Browsing API功能尚未完成！

"maximum_api_lookups"
- 最大數值API請求來執行每個掃描迭代。額外API請求將增加的總要求完成時間每掃描迭代，所以，您可能想來規定一個限以加快全掃描過程。當設置`0`，沒有最大數值將會應用的。設置`10`作為默認。

"maximum_api_lookups_response"
- 該什麼辦如果最大數值API請求已超過？ False = 沒做任何事（繼續處理） 【默認】； True = 標誌/受阻文件。

"cache_time"
- 多長時間（以秒為單位）應API結果被緩存？默認是3600秒（1小時）。

####"template_data" （類別）
指令和變量為模板和主題。

模板數據涉及到HTML產量使用以生成“上傳是否認”信息顯示為用戶當一個文件上傳是受阻。如果您使用個性化主題為phpMussel，HTML產量資源是從`template_custom.html`文件，和否則，HTML產量資源是從`template.html`文件。變量書面在這個配置文件部分是餵在HTML產量通過更換任何變量名包圍在大括號發現在HTML產量使用相應變量數據。為例子，哪里`foo="bar"`，任何發生的`<p>{foo}</p>`發現在HTML產量將成為`<p>bar</p>`。

“css_url”
- 模板文件為個性化主題使用外部CSS屬性，而模板文件為t標準主題使用內部CSS屬性。以指示phpMussel使用模板文件為個性化主題，指定公共HTTP地址的您的個性化主題的CSS文件使用`css_url`變量。如果您離開這個變量空白，phpMussel將使用模板文件為默認主題。

---


###7. <a name="SECTION7"></a>簽名格式

####*文件名簽名*
所有文件名簽名跟隨格式：

`NAME:FNRX`

`NAME`是名援引為簽名和`FNRX`是正則表達式匹配文件名（未編碼）為。

####*MD5簽名*
所有MD5簽名跟隨格式：

`HASH:FILESIZE:NAME`

`HASH`是一個MD5哈希的一個全文件，`FILESIZE`是總文件大小和`NAME`是名援引為簽名。

####*存檔元數據簽名*
所有存檔元數據簽名跟隨格式：

`NAME:FILESIZE:CRC32`

`NAME`是名援引為簽名，`FILESIZE`是總大小（非壓縮）的一個文件包含在存檔和`CRC32`是一個CRC32哈希的這個文件。

####*移植可執行｢PE｣部分簽名*
所有移植可執行｢PE｣部分簽名跟隨格式：

`SIZE:HASH:NAME`

`HASH`是一個MD5哈希的一個部分的一個移植可執行｢PE｣文件，`SIZE`是總大小的該部分和`NAME`是名援引為簽名。

####*移植可執行｢PE｣擴展簽名*
所有移植可執行｢PE｣擴展簽名跟隨格式：

`$VAR:HASH:SIZE:NAME`

`$VAR`是移植可執行｢PE｣變量名匹配為，`HASH`是一個MD5哈希的該變量，`SIZE`是總大小的該變量和`NAME`是名援引為簽名。

####*白名單簽名*
所有白名單簽名跟隨格式：

`HASH:FILESIZE:TYPE`

`HASH`是MD5哈希的一個全文件，`FILESIZE`是總文件大小和`TYPE`是簽名類型為白名單文件成為免疫的針對。

####*複雜擴展簽名*
複雜擴展簽名是寧不同從其他可能phpMussel簽名類型，在某種意義上說，什麼他們匹配針對是指定通過這些簽名他們自己和他們可以匹配針對多重標準。多重標準是分隔通過【;】和匹配類型和匹配數據的每多重標準是分隔通過【:】以確保格式為這些簽名往往看起來有點像：

`$變量1:某些數據;$變量2:某些數據;簽名等等`

####*一切其他*
所有其他簽名跟隨格式：

`NAME:HEX:FROM:TO`

`NAME`是名援引為簽名和`HEX`是一個十六進制編碼分割的文件意味被匹配通過有關簽名。`FROM`和`TO`是可選參數，說明從哪里和向哪裡在源數據匹配針對（不支持通過電子郵件功能）。

####*正則表達式／REGEX*
任何形式的正則表達式了解和正確地處理通過PHP應還會正確地了解和處理通過phpMussel和它的簽名。然而，我將建議採取極端謹慎當寫作新正則表達式為基礎的簽名，因為，如果您不完全肯定什麼您被做，可以有很不規則和／或意外結果。看一眼的phpMussel源代碼如果您不完全肯定的上下文其中正則表達式語句被處理。還，記得，所有語句（除外為文件名，存檔元數據和MD5語句）必須是十六進制編碼（和除外為語句句法，還，當然）！

####*哪裡放個性化簽名*
放個性化簽名只在那些文件意味為個性化簽名。那些文件應包含`_custom`在他們的文件名。您應還避免修改的標準簽名文件，除非您確切地知什麼您被做，因為，除了大體被好習慣和除了幫助您區分間您自己的簽名和標準簽名包括在phpMussel，它是好依照只修改文件意味為修改，因為篡改標準簽名文件可以導致他們停止正確地運作，因為MAP｢地圖｣（`.map`）文件：這些文件告訴phpMussel哪裡在簽名文件到定位簽名需要通過phpMussel按照當需要，和這些MAP｢地圖｣文件可以成為不同步從他們的關聯簽名文件如果那些簽名文件是篡改。您可以放幾乎任何您想在您的個性化簽名，只要您跟隨對句法。然而，當心和測試新簽名為假陽性預如果您意味共享他們或使用他們在一個活環境。

####*簽名說明*
下列是說明的簽名類型使用phpMussel：
- “標準化ASCII簽名” （ascii_*）。匹配針對內容的所有非白名單文件目標為掃描。
- “複雜擴展簽名” （coex_*）。雜簽名類型匹配。
- “ELF簽名” （elf_*）。匹配針對內容的所有非白名單文件目標為掃描識別的ELF文件。
- “移植可執行｢PE｣簽名” （exe_*）。匹配針對內容的所有非白名單掃描目標識別的移植可執行｢PE｣文件。
- “文件名簽名” （filenames_*）。匹配針對文件名的文件目標為掃描。
- “通用簽名” （general_*）。匹配針對內容的所有非白名單文件目標為掃描。
- “圖像簽名” （graphics_*）。匹配針對內容的所有非白名單文件目標為掃描識別的一個已知圖像文件格式。
- “通用命令” （hex_general_commands.csv）。匹配針對內容的所有非白名單文件目標為掃描。
- “標準化HTML簽名” （html_*）。匹配針對內容的所有非白名單HTML文件目標為掃描。
- “Mach-O簽名” （macho_*）。匹配針對內容的所有非白名單文件目標為掃描識別的Mach-O文件。
- “電子郵件簽名” （mail_*）。匹配針對`$body`變量在`phpMussel_mail()`功能（`$body`變量是為電子郵件正文或類似實體，可能論壇帖子和等等）。
- “MD5簽名” （md5_*）。匹配針對MD5哈希的內容和文件大小的所有非白名單文件目標為掃描。
- “存檔元數據簽名” （metadata_*）。匹配針對CRC32哈希和文件大小的第一文件包含在任何非白名單存檔目標為掃描。
- “OLE簽名” （ole_*）。匹配針對內容的所有非白名單OLE對象目標為掃描。
- “PDF簽名” （pdf_*）。匹配針對內容的所有非白名單PDF文件目標為掃描。
- “移植可執行｢PE｣部分簽名” （pe_*）。匹配針對MD5哈希和大小的每移植可執行｢PE｣部分的所有非白名單文件目標為掃描識別的移植可執行｢PE｣文件。
- “移植可執行｢PE｣擴展簽名” （pex_*）。匹配針對MD5哈希和大小的變量在所有非白名單文件目標為掃描識別的移植可執行｢PE｣文件。
- “SWF簽名” （swf_*）。匹配針對內容的所有非白名單SWF文件目標為掃描。
- “白名單簽名” （whitelist_*）。匹配針對MD5哈希的內容和文件大小的所有文件目標為掃描。識別文件將會免疫的成為匹配通過簽名類型提到從他們的白名單項。
- “XML/XDP塊簽名” （xmlxdp_*）。匹配針對任何XML/XDP塊發現從任何非白名單文件目標為掃描。
（請注意任何的這些簽名可以很容易地關閉通過`phpmussel.ini`）。

---


###8. <a name="SECTION8"></a>已知的兼容問題

####PHP和PCRE
- phpMussel需要PHP和PCRE以正確地執行和功能。如果沒有PHP，或如果沒有PCRE擴展的PHP，phpMussel不會正確地執行和功能。應該確保您的系統有PHP和PCRE安裝和可用之前下載和安裝phpMussel。

####殺毒軟件兼容性

在大多數情況下，phpMussel應該相當兼容性與大多數殺毒軟件。然，衝突已經報導由多個用戶以往。下面這些信息是從VirusTotal.com，和它描述了一個數的假陽性報告的各種殺毒軟件針對phpMussel。雖說這個信息是不絕對保證的如果您會遇到兼容性問題間phpMussel和您的殺毒軟件，如果您的殺毒軟件注意衝突針對phpMussel，您應該考慮關閉它之前使用phpMussel或您應該考慮替代選項從您的殺毒軟件或從phpMussel。

這個信息最後更新2016年2月25日和是準確為至少phpMussel的兩個最近次要版本（v0.9.0-v0.10.0）在這個現在時候的寫作。

| 掃描器               |  結果                                 |
|----------------------|--------------------------------------|
| Ad-Aware             |  無衝突 |
| AegisLab             |  無衝突 |
| Agnitum              |  無衝突 |
| AhnLab-V3            |  無衝突 |
| Alibaba              |  無衝突 |
| ALYac                |  無衝突 |
| AntiVir              |  無衝突 |
| Antiy-AVL            |  無衝突 |
| Arcabit              |  無衝突 |
| Avast                |  報告 "JS:ScriptSH-inf [Trj]" |
| AVG                  |  無衝突 |
| Avira                |  無衝突 |
| AVware               |  無衝突 |
| Baidu-International  |  無衝突 |
| BitDefender          |  無衝突 |
| Bkav                 |  報告 "VEXC640.Webshell" 和 "VEXD737.Webshell"|
| ByteHero             |  無衝突 |
| CAT-QuickHeal        |  無衝突 |
| ClamAV               |  無衝突 |
| CMC                  |  無衝突 |
| Commtouch            |  無衝突 |
| Comodo               |  無衝突 |
| Cyren                |  無衝突 |
| DrWeb                |  無衝突 |
| Emsisoft             |  無衝突 |
| ESET-NOD32           |  無衝突 |
| F-Prot               |  無衝突 |
| F-Secure             |  無衝突 |
| Fortinet             |  無衝突 |
| GData                |  無衝突 |
| Ikarus               |  無衝突 |
| Jiangmin             |  無衝突 |
| K7AntiVirus          |  無衝突 |
| K7GW                 |  無衝突 |
| Kaspersky            |  無衝突 |
| Kingsoft             |  無衝突 |
| Malwarebytes         |  無衝突 |
| McAfee               |  報告 "New Script.c" |
| McAfee-GW-Edition    |  報告 "New Script.c" |
| Microsoft            |  無衝突 |
| MicroWorld-eScan     |  無衝突 |
| NANO-Antivirus       |  無衝突 |
| Norman               |  無衝突 |
| nProtect             |  無衝突 |
| Panda                |  無衝突 |
| Qihoo-360            |  無衝突 |
| Rising               |  無衝突 |
| Sophos               |  無衝突 |
| SUPERAntiSpyware     |  無衝突 |
| Symantec             |  無衝突 |
| Tencent              |  無衝突 |
| TheHacker            |  無衝突 |
| TotalDefense         |  無衝突 |
| TrendMicro           |  無衝突 |
| TrendMicro-HouseCall |  無衝突 |
| VBA32                |  無衝突 |
| VIPRE                |  無衝突 |
| ViRobot              |  無衝突 |
| Zillya               |  無衝突 |
| Zoner                |  無衝突 |

---


最後更新：2016年2月25日。

翻譯聲明：本文檔翻譯基於英文原始文檔，但由於本人水平有限，且非PHP程序員，對其中某些字詞的翻譯可能不是很準確，故如果出現錯誤，請指出並聯繫原作者予以更正，另外，本翻譯僅簡體中文，與繁體中文無關亦未參考繁體中文的譯文！！
