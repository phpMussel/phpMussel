## phpMussel 自述文件寫在中文（傳統）。

### 內容
- 1. [前言](#SECTION1)
- 2A. [如何安裝（對於WEB服務器）](#SECTION2A)
- 2B. [如何安裝（對於CLI）](#SECTION2B)
- 3A. [如何使用（對於WEB服務器）](#SECTION3A)
- 3B. [如何使用（對於CLI）](#SECTION3B)
- 4A. [瀏覽器命令](#SECTION4A)
- 4B. [CLI（命令行界面）](#SECTION4B)
- 5. [文件在包](#SECTION5)
- 6. [配置選項](#SECTION6)
- 7. [簽名格式](#SECTION7)
- 8. [已知的兼容問題](#SECTION8)

---


###1. <a name="SECTION1"></a>前言

謝謝對於使用phpMussel，一個PHP腳本旨在檢測木馬，病毒，惡意軟件，和其他威脅在文件上傳到您的系統隨地這個腳本是叫，根據ClamAV的簽名和其他簽名。

PHPMUSSEL版權2013和此後GNU/GPLv.2通過Caleb M （Maikuolan）。

這個腳本是免費軟件;您可以重新分配它和/或修改它按照條款GNU通用公共許可證發表由自由軟件基金會;或第2版本的許可證，或（根據您的選擇）任何新版本。這個腳本是提供在希望將是有用，但不提供任何擔保和不提供任何隱含擔保的適銷或適用於某一特定用途。見GNU通用公共許可證的更多細節，坐落於`LICENSE`文件於`_docs`文件夾的相關包和知識庫的此文件和也可從：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

謝謝[ClamAV](http://www.clamav.net/)為計劃靈感和為簽名這個腳本利用。沒有它，這個腳本很可能不會存在，或充其量，將有非常有限的價值。

谢谢Sourceforge和GitHub为主办的计划文件，[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)为主办的phpMussel讨论论坛，和其他来源的签名利用由phpMussel：[SecuriteInfo.com](http://www.securiteinfo.com/)，[PhishTank](http://www.phishtank.com/)，[NLNetLabs](http://nlnetlabs.nl/)和他人，和特别谢谢大家为支持的计划，和任何人我忘了提，和您，为您的运用的脚本。

这个文件和其关联包可以下载免费从：
- [Sourceforge](http://phpmussel.sourceforge.net/)。
- [GitHub](https://github.com/Maikuolan/phpMussel/)。

---


###2A. <a name="SECTION2A"></a>如何安裝（對於WEB服務器）

我希望能夠簡化這過程通過創建的安裝程序在某一點在近未來，但直到那個時候，遵循這些說明以經營phpMussel在多數係統和CMS：

1） 通過您的閱讀這，我假設您已經下載一個存檔的副本的腳本，已解壓縮其內容和有它地方的某處上您的機器。從這裡，您要決定在哪裡在您的服務器您想放這些內容。一個文件夾例如`/public_html/phpmussel/`或類似（無論您選擇，不要緊，只要它的安全和您是滿意）會是足夠了。*之前您開始上傳，繼續閱讀。。*

2） 自選（強烈推薦為高級用戶，但不推薦為業餘用戶或為用戶沒有經驗），打開`phpmussel.ini`（位於內`vault`） - 這個文件包含所有指令可用的為phpMussel。以上的每指令應該有一個簡評以說明它做什麼和它的功能。調整這些指令您認為合適的，按照隨您是適合為您的特定的設置。保存文件，關閉。

3） 上傳內容（phpMussel和它的文件）至文件夾您決定在早期（不需要包括`*.txt`/`*.md`文件，但大多，您應該上傳的一切）。

4） CMHOD的`vault`文件夾為“755”。主文件夾存儲的內容（一個您先前選擇），平時，可以單獨留，但CHMOD狀態應檢查如果您有權限問題以往上您的系統（按說，應該是這樣的“755”）。

5） 接下來，您需要｢鉤子｣phpMussel為您的系統或CMS。有幾種不同的方式在其中您可以｢鉤子｣腳本例如phpMussel為您的系統或CMS，但最簡單的是簡單地包括的腳本在開頭的核心文件為您的系統或CMS（這是一個是通常一直加載的當有人訪問的任何頁面在您的網站）使用`require()`或`include()`命令。平時，這將是存儲的在文件夾例如`/includes`，`/assets`或`/functions`，和將經常被命名的某物例如`init.php`，`common_functions.php`，`functions.php`或類似。您需要確定哪些文件這是為您的情況；如果您遇到困難關於確定這為您自己，訪問phpMussel支持論壇和讓我​​們知；這是可能的我自己或其他用戶可有經驗的該CMS您正在使用（您需要讓我們知哪些CMS您使用的），和從而，可能能夠提供援助關於這。為了使用`require()`或`include()`，插入下面的代碼行到最開始的該核心文件，更換裡面的數據引號以確切的地址的`phpmussel.php`文件（本地地址，不HTTP地址；它會類似於vault地址前面提到的）。

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'；?>`

保存文件，關閉，重新上傳。

-- 或交替 --

如果您使用Apache網絡服務器和如果您可以訪問`php.ini`，您可以使用該`auto_prepend_file`指令為附上的phpMussel每當任何PHP請求是創建。就像是：

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

或在該`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6） 從這裡，您完成了！然，您應該測試它以確保它的正常運行。為了測試文件上傳保護，嘗試上傳測試文件包括在包內`_testfiles`至您的網站通過您常用的基於瀏覽器的上傳方法。如果一切正常，信息應該出現從phpMussel以確認上載已成功阻止了。如果出現什麼，什麼是不正常工作。如果您使用的任何先進的功能或如果您使用的其它類型的掃描可能的，我建議嘗試它跟他們以確保其工作正常，也。

---


###2B. <a name="SECTION2B"></a>如何安裝（對於CLI）

我希望能夠簡化這過程通過創建的安裝程序在某一點在近未來，但直到那個時候，遵循這些說明為預備phpMussel於操作使用CLI模式（請注意，在這個時候，CLI支持僅適用於基於Windows系統；Linux和其他系統即將推出到更高版本的phpMussel）：

1） 通過您的閱讀這，我假設您已經下載一個存檔的副本的腳本，已解壓縮其內容和有它地方的某處上您的機器。當您決定您滿意與選擇的位置為phpMussel，繼續。

2） phpMussel需要PHP安裝在主機以經營。如果您沒有PHP已安裝上您的機器，請安裝PHP上您的機器，和跟隨任何指令提供由PHP的安裝程序。

3） 自選（強烈推薦為高級用戶，但不推薦為業餘用戶或為用戶沒有經驗），打開`phpmussel.ini`（位於內`vault`） - 這個文件包含所有指令可用的為phpMussel。以上的每指令應該有一個簡評以說明它做什麼和它的功能。調整這些指令您認為合適的，按照隨您是適合為您的特定的設置。保存文件，關閉。

4） 自選，使用的phpMussel在CLI模式可能是更容易為您如果您創建一個批處理文件為自動加載的PHP和phpMussel。要做到這一點，打開一個純文本編輯器例如Notepad或Notepad++，鍵入完整路徑為`php.exe`文件在文件夾的您的PHP安裝，其次是一個空格，然後完整路徑為`phpmussel.php`文件在文件夾的您的phpMussel安裝，最後，保存此文件使用一個".bat"擴展名在一個地方您會容易發現它；從這裡，雙擊的文件以經營phpMussel在未來。

5） 從這裡，您完成了！然，您應該測試它以確保它的正常運行。以測試phpMussel，經營phpMussel和嘗試掃描`_testfiles`文件夾提供有包。

---


###3A. <a name="SECTION3A"></a>如何使用（對於WEB服務器）

phpMussel的目的是作為一個腳本這將將滿意地和正確地執行｢從開箱｣有最小的要求為您完成：如果正確地安裝的，簡而言之，它應該正確地功能。

文件上傳掃描是自動和按說已激活，所以，您不需要做任何事為這個功能。

然而，另外，您能指示phpMussel至掃描文件，文件夾或存檔該您指示以做。要做到這一點，首先，您需要確保適當配置是確定在`phpmussel.ini`文件（`cleanup`｢清理｣必須關閉），和在做完，在任何一個PHP文件是鉤子至phpMussel，使用下列功能在您的代碼：

`phpMussel($what_to_scan，$output_type，$output_flatness);`

- `$what_to_scan`可以是字符串，數組，或多維數組，和表明什麼文件，收集的文件，文件夾和／或文件夾至掃描。
- `$output_type`是布爾，和表明什麼格式以回報掃描結果作為。False｢假／負｣指示關於功能以回報掃描結果作為整數（結果回報的-3表明問題是遇到關於phpMussel簽名文件或簽名MAP｢地圖｣文件和表明他們可能是失踪或損壞，-2表明損壞數據是檢測中掃描和因此掃描失敗完成，-1表明擴展或插件需要通過PHP以經營掃描是失踪和因此掃描失敗完成，0表明掃描目標不存在和因此沒有任何事為掃描，1表明掃描目標是成功掃描和沒有任何問題檢測，和2表明掃描目標是成功掃描和至少一些問題是檢測）。True｢真／正｣指示關於功能以回報掃描結果作為人類可讀文本。此外，在任一情況下，結果可以訪問通過全局變量後掃描是完成。變量是自選，確定作為False｢假／負｣由標準。
- `$output_flatness`是布爾，表明如果回報掃描結果（如果有多掃描目標）作為數組或字符串。False｢假／負｣指示回報結果作為數組。True｢真／正｣負｣指示回報結果作為字符串。變量是自選，確定作為False｢假／負｣由標準。

例子：

```
 $results=phpMussel('/user_name/public_html/my_file.html'，true，true);
 echo $results;
```

回報這樣的事情或類似（作為字符串）：

```
 Wed, 16 Sep 2013 02:49:46 +0000 開始.
 > 檢查 '/user_name/public_html/my_file.html'：
 -> 沒有問題發現。
 Wed, 16 Sep 2013 02:49:47 +0000 完了.
```

為一個全說明的什麼類型的簽名phpMussel使用中它的掃描和怎麼它手柄這些簽名，參考｢簽名格式｣部分的這個自述文件。

如果您遇到任何假陽性，如果您遇到某物新您想應該受阻，或為任何其他題關於簽名，請聯繫我關於它為使我可以使需要變化，該，如果您不聯繫我，我可能不一定知關於。

以關閉簽名包括在phpMussel（例如如果您遇到假陽性具體至您的目的該不應該按說去掉），參考灰名單筆記在｢瀏覽器命令｣部分的這個自述文件。

除了前述的文件上傳掃描和自選掃描的其他文件和／或文件夾指定通過上述功能，包括在phpMussel是一個功能意為掃描入站電子郵件正文。這個功能行為類似至標準`phpMussel()`功能，但只考慮在對照的ClamAV基於電子郵件簽名。我不鏈接這些簽名在標準phpMussel()功能，因為它是不太可能您將會發現任何入站電子郵件正文在需要的掃描在一個文件上傳目標的向一個網頁其中phpMussel是鉤子到，和從而，以鏈接這些簽名在phpMussel()功能將會無意義。然而，這說，擁有一個單獨功能以對照的這些簽名可以證明是極有用為一些，特別為那些誰的CMS或系統是在任何方式鏈接在他們的電子郵件系統和為那些處理他們的電子郵件通過一個PHP腳本他們可以可能鉤子在phpMussel。配置為這個功能，像所有其他，是控制通過`phpmussel.ini`文件。以使用這個功能（您需要做您的自己實施），在一個PHP文件是鉤子在phpMussel，使用下列功能在您的代碼：

`phpMussel_mail($body);`

`$body`是電子郵件正文您想掃描（還，您可以嘗試掃描新論壇帖子，入站信息從您的在線聯繫方式頁面或等等）。如果任何錯誤發生阻礙這個功能從完成它的掃描，一個數值的-1將會回報。如果這個功能完成它的掃描和它不發現任何問題，一個數值的0將會回報（表明它是良性）。如果，然而，這個功能發現某物，一個字符串將會回報包含一個信息聲明什麼它發現。

除了上述，如果您看源代碼，您可能注意到這些功能`phpMusselD()`和`phpMusselR()`。這些功能是子功能的`phpMussel()`，和不應該叫直外的該父功能（不因為不利影響，但更使，因為它將會提供沒有目的，和可能將不會正確執行無論如何）。

有許多其他控制和功能可用在phpMussel為您的，還。為了任何這樣的控制和功能其中，由端的這個部分的自述，是還不說明，請繼續閱讀和參考｢瀏覽器命令｣部分的這個自述文件。

---


###3B. <a name="SECTION3B"></a>如何使用（對於CLI）

請參考｢如何安裝（對於CLI）｣部分的這個自述文件。

請注意，雖說未來版本的phpMussel應該支持其他系統，在這個時候，phpMussel CLI模式支持是只優化為使用在基於Windows系統（您可以，當然，嘗試它在其他系統，但我不能保證它會執行如預期）。

還注意，phpMussel是功能不相等的一個全殺毒套房，和違背了的常規殺毒套房，它不監控活動內存或檢測病毒自發地！它將會只檢測病毒從那些具體文件您明確地告訴它來掃描。

---


###4A. <a name="SECTION4A"></a>瀏覽器命令

之後phpMussel是安裝和是正確地功能在您的系統，如果您已經設置`script_password`和`logs_password`變量（訪問密碼）在您的配置文件，您將會可以執行一些有限數的行政功能和輸入一些有限數的命令在phpMussel通過您的瀏覽器。這些密碼需要是設置以激活這些瀏覽器控制，以保證正確安全，正確保護的這些瀏覽器控制和以保證存在一個方法為這些瀏覽器控製成為完全關閉如果您和／或其他網站管理員使用phpMussel不想要他們。所以，換句話說，以激活這些控制，設置一個密碼，和以關閉這些控制，設置沒有密碼。另外，如果您選擇激活這些控制和然後選擇關閉這些控制在稍後的日期，有一個命令以做這個（可以有用如果您執行一些行動您感覺可以可能妥協分配的密碼和需要很快關閉這些控制沒有修改您的配置文件）。

有些原因為什麼您應該激活這些控制：
- 提供一個辦法的灰名單簽名自發地在情況例如當您發現一個簽名產生一個假陽性中文件上傳到您的系統和您沒有時間為手動編輯和重新上傳您的灰名單文件。
- 提供一個辦法為您允許有人除了您自己控制您的副本的phpMussel沒有含蓄需要發放他們訪問在FTP。
- 提供一個辦法的提供控制的訪問辦您的日誌文件。
- 提供一個簡易辦法的更新phpMussel當更新是可用的。
- 提供一個辦法為您監控phpMussel當FTP訪問或其他常規訪問點為監控phpMussel是不可用的。

有些原因為什麼您不應該激活這些控制：
- 提供一個向量為潛力攻擊者和不受歡迎的人查明如果您使用phpMussel（雖說，這個可以二者一個目的讚成和一個目的反對，根據透視)通過盲目地發送命令向服務器作為一種手段來探測。這個可以阻礙攻擊者從目標您的系統如果他們學習您使用phpMussel，在假設他們是探測因為他們的攻擊方法是使不有力因之的使用phpMussel。然，如果一些意外和目前未知漏洞在phpMussel或一個未來版本其被曝光，和如果它可以的可能提供一個攻擊向量，一個正面結果從這探測可以可能鼓勵攻擊者目標您的系統。
- 如果您的分配密碼成為妥協，如果不變，可以提供一個方法為一個攻擊者為旁路任何簽名按說防止他們的攻擊成功，或潛在共關閉phpMussel，從而提供一個方法為使phpMussel的效用無實際意義。

無論哪種方式，無論您選擇什麼樣，選擇最終是您的。標準，這些控制將會已關閉，但思考關於它，和如果您決定您想他們，這個部分說明如何激活他們和如何使用他們。

可用瀏覽器命令列表：

scan_log
- 密碼需要：`logs_password`
- 其他需要：您需要確定`scan_log`指令。
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?logspword=[logs_password]&phpmussel=scan_log`
- 它的作用：打印您的`scan_log`文件內容到屏幕。

scan_kills
- 密碼需要：`logs_password`
- 其他需要：您需要確定`scan_kills`指令。
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?logspword=[logs_password]&phpmussel=scan_kills`
- 它的作用：打印您的`scan_kills`文件內容到屏幕。

controls_lockout
- 密碼需要：`logs_password`或`script_password`
- 其他需要：（不任何）
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子1：`?logspword=[logs_password]&phpmussel=controls_lockout`
- 例子2：`?pword=[script_password]&phpmussel=controls_lockout`
- 它的作用：關閉所有瀏覽器控制。這個應該使用如果您疑似任一您的密碼已成為妥協（這個可以發生如果您使用這些控制從一個不安全和／或不信賴計算機）。`controls_lockout`執行途經創建一個文件，`controls.lck`，在您的安全／保險庫｢Vault｣文件夾，其中phpMussel將尋找之前執行任何類型的命令。當這個發生，以重新激活控制，您需要手動刪除`controls.lck`文件通過FTP或類似。可以使叫使用任一密碼。

disable
- 密碼需要：`script_password`
- 其他需要：（不任何）
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=disable`
- 它的作用：關閉phpMussel。這個應該使用如果您執行任何更新或修改在您的系統或如果您安裝任何新軟件或模塊在您的系統其中可能可以扳機假陽性。這個還應該使用如果您遇到任何問題從phpMussel但您不想去掉它從您的系統。當這個發生，以重新激活phpMussel，使用“enable”。

enable
- 密碼需要：`script_password`
- 其他需要：（不任何）
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=enable`
- 它的作用：激活phpMussel。這個應該使用如果您先前關閉phpMussel通過“disable”和想重新激活它。

update
- 密碼需要：`script_password`
- 其他需要：`update.dat`和`update.inc`必須存在。
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=update`
- 它的作用：查找更新的phpMussel和它的簽名。如果更新是發現，這個命令將嘗試下載和安裝這些更新。如果更新不發現或失敗，更新將退出。整個過程結果是印刷到屏幕。我推薦檢查至少一次每月以確保您的簽名和您的phpMussel是最新（除非，當然，您手動更新一切，但我依然推薦更新至少一次每月）。更新更頻繁是可能毫無意義，考慮到我不太可能有能力的產生任何類型更新更頻繁比這（也不我實在想）。

greylist
- 密碼需要：`script_password`
- 其他需要：（不任何）
- 需要參數：【名的簽名為灰名單】
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist&musselvar=[簽名]`
- 它的作用：添加一個簽名在灰名單。

greylist_clear
- 密碼需要：`script_password`
- 其他需要：（不任何）
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist_clear`
- 它的作用：抹去整個灰名單。

greylist_show
- 密碼需要：`script_password`
- 其他需要：（不任何）
- 需要參數：（不任何）
- 自選參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist_show`
- 它的作用：打印內容的灰名單到屏幕。

---


###4B. <a name="SECTION4B"></a>CLI（命令行界面）

phpMussel可以執行作為一個互動文件掃描在CLI模式在基於Windows系統。參考｢如何安裝（對於CLI）｣部分的這個自述文件為更信息。

為一個列表的可用CLI命令，在CLI提示，鍵入【c】，和按Enter鍵。

---


###5. <a name="SECTION5"></a>文件在包

下面是一個列表的所有的文件該應該是存在在您的存檔在下載時間，任何文件該可能創建因之的您的使用這個腳本，包括一個簡短說明的他們的目的。

文件                                       | 說明
-------------------------------------------|--------------------------------------
/phpmussel.php                             | 加載文件。它加載主腳本，更新文件，和等等。這個是文件您應該｢鉤子｣（必不可少）!
/web.config                                | 一個ASP.NET配置文件（在這種情況，以保護`/vault`文件夾從被訪問由非授權來源在事件的腳本是安裝在服務器根據ASP.NET技術）。
/_docs/                                    | 筆記文件夾（包含若干文件）。
/_docs/change_log.txt                      | 記錄的變化做出至腳本間不同版本（不需要為正確經營腳本）。
/_docs/readme.de.md                        | 自述文件：DEUTSCH
/_docs/readme.de.txt                       | 自述文件：DEUTSCH
/_docs/readme.en.md                        | 自述文件：ENGLISH
/_docs/readme.en.txt                       | 自述文件：ENGLISH
/_docs/readme.es.md                        | 自述文件：ESPAÑOL
/_docs/readme.es.txt                       | 自述文件：ESPAÑOL
/_docs/readme.fr.md                        | 自述文件：FRANÇAIS
/_docs/readme.fr.txt                       | 自述文件：FRANÇAIS
/_docs/readme.id.md                        | 自述文件：BAHASA INDONESIA
/_docs/readme.id.txt                       | 自述文件：BAHASA INDONESIA
/_docs/readme.it.md                        | 自述文件：ITALIANO
/_docs/readme.it.txt                       | 自述文件：ITALIANO
/_docs/readme.nl.md                        | 自述文件：NEDERLANDSE
/_docs/readme.nl.txt                       | 自述文件：NEDERLANDSE
/_docs/readme.pt.md                        | 自述文件：PORTUGUÊS
/_docs/readme.pt.txt                       | 自述文件：PORTUGUÊS
/_docs/readme.ru.md                        | 自述文件：РУССКИЙ
/_docs/readme.ru.txt                       | 自述文件：РУССКИЙ
/_docs/signatures_tally.txt                | 文件為數量追踪的為包含的簽名（不需要為正確經營腳本）。
/_testfiles/                               | 測試文件文件夾（包含若干文件）。所有包含文件是測試文件為測試如果phpMussel是正確地安裝上您的系統，和您不需要上傳這個文件夾或任何其文件除為上傳測試。
/_testfiles/ascii_standard_testfile.txt    | 測試文件以測試phpMussel標準化ASCII簽名。
/_testfiles/coex_testfile.rtf              | 測試文件以測試phpMussel複雜擴展簽名。
/_testfiles/exe_standard_testfile.exe      | 測試文件以測試phpMussel移植可執行｢PE｣簽名。
/_testfiles/general_standard_testfile.txt  | 測試文件以測試phpMussel通用簽名。
/_testfiles/graphics_standard_testfile.gif | 測試文件以測試phpMussel圖像簽名。
/_testfiles/html_standard_testfile.txt     | 測試文件以測試phpMussel標準化HTML簽名。
/_testfiles/md5_testfile.txt               | 測試文件以測試phpMussel MD5簽名。
/_testfiles/metadata_testfile.tar          | 測試文件以測試phpMussel元數據簽名和以測試TAR文件支持在您的系統。
/_testfiles/metadata_testfile.txt.gz       | 測試文件以測試phpMussel元數據簽名和以測試GZ文件支持在您的系統。
/_testfiles/metadata_testfile.zip          | 測試文件以測試phpMussel元數據簽名和以測試ZIP文件支持在您的系統。
/_testfiles/ole_testfile.ole               | 測試文件以測試phpMussel OLE簽名。
/_testfiles/pdf_standard_testfile.pdf      | 測試文件以測試phpMussel PDF簽名。
/_testfiles/pe_sectional_testfile.exe      | 測試文件以測試phpMussel移植可執行｢PE｣部分簽名。
/_testfiles/swf_standard_testfile.swf      | 測試文件以測試phpMussel SWF簽名。
/_testfiles/xdp_standard_testfile.xdp      | 測試文件以測試phpMussel XML／XDP塊簽名。
/vault/                                    | 安全／保險庫｢Vault｣文件夾（包含若干文件）。
/vault/cache/                              | 緩存｢Cache｣文件夾（為臨時數據）。
/vault/cache/.htaccess                     | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/lang/                               | 包含phpMussel語言數據。
/vault/lang/.htaccess                      | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/lang/lang.de.inc                    | 語言數據：DEUTSCH
/vault/lang/lang.en.inc                    | 語言數據：ENGLISH
/vault/lang/lang.es.inc                    | 語言數據：ESPAÑOL
/vault/lang/lang.fr.inc                    | 語言數據：FRANÇAIS
/vault/lang/lang.id.inc                    | 語言數據：BAHASA INDONESIA
/vault/lang/lang.it.inc                    | 語言數據：ITALIANO
/vault/lang/lang.ja.inc                    | 語言數據：日本語
/vault/lang/lang.nl.inc                    | 語言數據：NEDERLANDSE
/vault/lang/lang.pt.inc                    | 語言數據：PORTUGUÊS
/vault/lang/lang.ru.inc                    | 語言數據：РУССКИЙ
/vault/lang/lang.vi.inc                    | 語言數據：TIẾNG VIỆT
/vault/lang/lang.zh.inc                    | 語言數據：中文（简体）
/vault/lang/lang.zh-TW.inc                 | 語言數據：中文（傳統）
/vault/quarantine/                         | 隔離文件夾（包含隔離文件）。
/vault/quarantine/.htaccess                | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/.htaccess                           | 超文本訪問文件（在這種情況，以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/ascii_clamav_regex.cvd              | 標準化ASCII簽名文件。
/vault/ascii_clamav_regex.map              | 標準化ASCII簽名文件。
/vault/ascii_clamav_standard.cvd           | 標準化ASCII簽名文件。
/vault/ascii_clamav_standard.map           | 標準化ASCII簽名文件。
/vault/ascii_custom_regex.cvd              | 標準化ASCII簽名文件。
/vault/ascii_custom_standard.cvd           | 標準化ASCII簽名文件。
/vault/ascii_mussel_regex.cvd              | 標準化ASCII簽名文件。
/vault/ascii_mussel_standard.cvd           | 標準化ASCII簽名文件。
/vault/coex_clamav.cvd                     | 複雜擴展簽名文件。
/vault/coex_custom.cvd                     | 複雜擴展簽名文件。
/vault/coex_mussel.cvd                     | 複雜擴展簽名文件。
/vault/elf_clamav_regex.cvd                | ELF簽名文件。
/vault/elf_clamav_regex.map                | ELF簽名文件。
/vault/elf_clamav_standard.cvd             | ELF簽名文件。
/vault/elf_clamav_standard.map             | ELF簽名文件。
/vault/elf_custom_regex.cvd                | ELF簽名文件。
/vault/elf_custom_standard.cvd             | ELF簽名文件。
/vault/elf_mussel_regex.cvd                | ELF簽名文件。
/vault/elf_mussel_standard.cvd             | ELF簽名文件。
/vault/exe_clamav_regex.cvd                | 移植可執行｢PE｣簽名文件。
/vault/exe_clamav_regex.map                | 移植可執行｢PE｣簽名文件。
/vault/exe_clamav_standard.cvd             | 移植可執行｢PE｣簽名文件。
/vault/exe_clamav_standard.map             | 移植可執行｢PE｣簽名文件。
/vault/exe_custom_regex.cvd                | 移植可執行｢PE｣簽名文件。
/vault/exe_custom_standard.cvd             | 移植可執行｢PE｣簽名文件。
/vault/exe_mussel_regex.cvd                | 移植可執行｢PE｣簽名文件。
/vault/exe_mussel_standard.cvd             | 移植可執行｢PE｣簽名文件。
/vault/filenames_clamav.cvd                | 文件名簽名文件。
/vault/filenames_custom.cvd                | 文件名簽名文件。
/vault/filenames_mussel.cvd                | 文件名簽名文件。
/vault/general_clamav_regex.cvd            | 通用簽名文件。
/vault/general_clamav_regex.map            | 通用簽名文件。
/vault/general_clamav_standard.cvd         | 通用簽名文件。
/vault/general_clamav_standard.map         | 通用簽名文件。
/vault/general_custom_regex.cvd            | 通用簽名文件。
/vault/general_custom_standard.cvd         | 通用簽名文件。
/vault/general_mussel_regex.cvd            | 通用簽名文件。
/vault/general_mussel_standard.cvd         | 通用簽名文件。
/vault/graphics_clamav_regex.cvd           | 圖像簽名文件。
/vault/graphics_clamav_regex.map           | 圖像簽名文件。
/vault/graphics_clamav_standard.cvd        | 圖像簽名文件。
/vault/graphics_clamav_standard.map        | 圖像簽名文件。
/vault/graphics_custom_regex.cvd           | 圖像簽名文件。
/vault/graphics_custom_standard.cvd        | 圖像簽名文件。
/vault/graphics_mussel_regex.cvd           | 圖像簽名文件。
/vault/graphics_mussel_standard.cvd        | 圖像簽名文件。
/vault/greylist.csv                        | 灰名單簽名CSV（逗號分隔變量）文件說明為phpMussel什麼簽名它應該忽略（文件自動重新創建如果刪除）。
/vault/hex_general_commands.csv            | 十六進制編碼的CSV（逗號分隔變量）為通用命令檢測，使用可選通過phpMussel。
/vault/html_clamav_regex.cvd               | 標準化HTML簽名文件。
/vault/html_clamav_regex.map               | 標準化HTML簽名文件。
/vault/html_clamav_standard.cvd            | 標準化HTML簽名文件。
/vault/html_clamav_standard.map            | 標準化HTML簽名文件。
/vault/html_custom_regex.cvd               | 標準化HTML簽名文件。
/vault/html_custom_standard.cvd            | 標準化HTML簽名文件。
/vault/html_mussel_regex.cvd               | 標準化HTML簽名文件。
/vault/html_mussel_standard.cvd            | 標準化HTML簽名文件。
/vault/lang.inc                            | 語言數據。
/vault/macho_clamav_regex.cvd              | Mach-O簽名文件。
/vault/macho_clamav_regex.map              | Mach-O簽名文件。
/vault/macho_clamav_standard.cvd           | Mach-O簽名文件。
/vault/macho_clamav_standard.map           | Mach-O簽名文件。
/vault/macho_custom_regex.cvd              | Mach-O簽名文件。
/vault/macho_custom_standard.cvd           | Mach-O簽名文件。
/vault/macho_mussel_regex.cvd              | Mach-O簽名文件。
/vault/macho_mussel_standard.cvd           | Mach-O簽名文件。
/vault/mail_clamav_regex.cvd               | 電子郵件簽名文件。
/vault/mail_clamav_regex.map               | 電子郵件簽名文件。
/vault/mail_clamav_standard.cvd            | 電子郵件簽名文件。
/vault/mail_clamav_standard.map            | 電子郵件簽名文件。
/vault/mail_custom_regex.cvd               | 電子郵件簽名文件。
/vault/mail_custom_standard.cvd            | 電子郵件簽名文件。
/vault/mail_mussel_regex.cvd               | 電子郵件簽名文件。
/vault/mail_mussel_standard.cvd            | 電子郵件簽名文件。
/vault/mail_mussel_standard.map            | 電子郵件簽名文件。
/vault/md5_clamav.cvd                      | 基於MD5簽名文件。
/vault/md5_custom.cvd                      | 基於MD5簽名文件。
/vault/md5_mussel.cvd                      | 基於MD5簽名文件。
/vault/metadata_clamav.cvd                 | 存檔元數據簽名文件。
/vault/metadata_custom.cvd                 | 存檔元數據簽名文件。
/vault/metadata_mussel.cvd                 | 存檔元數據簽名文件。
/vault/ole_clamav_regex.cvd                | OLE簽名文件。
/vault/ole_clamav_regex.map                | OLE簽名文件。
/vault/ole_clamav_standard.cvd             | OLE簽名文件。
/vault/ole_clamav_standard.map             | OLE簽名文件。
/vault/ole_custom_regex.cvd                | OLE簽名文件。
/vault/ole_custom_standard.cvd             | OLE簽名文件。
/vault/ole_mussel_regex.cvd                | OLE簽名文件。
/vault/ole_mussel_standard.cvd             | OLE簽名文件。
/vault/pdf_clamav_regex.cvd                | PDF簽名文件。
/vault/pdf_clamav_regex.map                | PDF簽名文件。
/vault/pdf_clamav_standard.cvd             | PDF簽名文件。
/vault/pdf_clamav_standard.map             | PDF簽名文件。
/vault/pdf_custom_regex.cvd                | PDF簽名文件。
/vault/pdf_custom_standard.cvd             | PDF簽名文件。
/vault/pdf_mussel_regex.cvd                | PDF簽名文件。
/vault/pdf_mussel_standard.cvd             | PDF簽名文件。
/vault/pe_clamav.cvd                       | 移植可執行｢PE｣部分簽名文件。
/vault/pe_custom.cvd                       | 移植可執行｢PE｣部分簽名文件。
/vault/pe_mussel.cvd                       | 移植可執行｢PE｣部分簽名文件。
/vault/pex_custom.cvd                      | 移植可執行｢PE｣擴展簽名文件。
/vault/pex_mussel.cvd                      | 移植可執行｢PE｣擴展簽名文件。
/vault/phpmussel.inc                       | 主腳本；主體和機制的phpMussel（必不可少）！
/vault/phpmussel.ini                       | 配置文件;包含所有配置指令為phpMussel，告訴它什麼做和怎麼正確地經營（必不可少）!
※ /vault/scan_log.txt                     | 記錄的一切phpMussel掃描。
※ /vault/scan_kills.txt                   | 記錄的所有上傳文件phpMussel受阻／殺。
/vault/swf_clamav_regex.cvd                | SWF簽名文件。
/vault/swf_clamav_regex.map                | SWF簽名文件。
/vault/swf_clamav_standard.cvd             | SWF簽名文件。
/vault/swf_clamav_standard.map             | SWF簽名文件。
/vault/swf_custom_regex.cvd                | SWF簽名文件。
/vault/swf_custom_standard.cvd             | SWF簽名文件。
/vault/swf_mussel_regex.cvd                | SWF簽名文件。
/vault/swf_mussel_standard.cvd             | SWF簽名文件。
/vault/switch.dat                          | 控制和確定某些變量。
/vault/template.html                       | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/template_custom.html                | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/update.dat                          | 文件包含版本信息為phpMussel的腳本和phpMussel的簽名。如果您隨時需要自動更新phpMussel或需要更新phpMussel通過您的瀏覽器，這個文件是必不可少。
/vault/update.inc                          | 更新腳本；需要為自動更新和為更新phpMussel通過您的瀏覽器，但不否則需要。
/vault/whitelist_clamav.cvd                | 文件具體白名單。
/vault/whitelist_custom.cvd                | 文件具體白名單。
/vault/whitelist_mussel.cvd                | 文件具體白名單。
/vault/xmlxdp_clamav_regex.cvd             | XML／XDP塊簽名文件。
/vault/xmlxdp_clamav_regex.map             | XML／XDP塊簽名文件。
/vault/xmlxdp_clamav_standard.cvd          | XML／XDP塊簽名文件。
/vault/xmlxdp_clamav_standard.map          | XML／XDP塊簽名文件。
/vault/xmlxdp_custom_regex.cvd             | XML／XDP塊簽名文件。
/vault/xmlxdp_custom_standard.cvd          | XML／XDP塊簽名文件。
/vault/xmlxdp_mussel_regex.cvd             | XML／XDP塊簽名文件。
/vault/xmlxdp_mussel_standard.cvd          | XML／XDP塊簽名文件。

※ 文件名可能不同基於配置規定（在`phpmussel.ini`）。

####*關於簽名文件*
CVD是一個acronym為｢ClamAV Virus Definitions｣，在參照如何ClamAV參考它自己的簽名和在參的用法的那些簽名在phpMussel;文件名結尾有｢CVD｣包含簽名。

文件名結尾有｢MAP｣繪製該簽名phpMussel應該和不應該使用為獨特掃描；不所有簽名是一定需要為所有獨特掃描，所以，phpMussel使用簽名地圖文件以加快掃描過程（一個過程該否則將會極其緩慢和乏味）。

簽名文件標有“_regex”包含簽名使用正則表達式｢REGEX｣掃描。

簽名文件標有“_standard”包含簽名特別是不使用任何類型的特殊式或正則表達式掃描。

簽名文件標有不"_regex"也不"_standard"將會作為一個或其他，但不二者（參考｢簽名格式｣部分的這個自述文件為詳細信息）。

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
- ｢反設置／刪除／清潔｣腳本變量和緩存｢Cache｣之後執行嗎？如果您不使用腳本外初始上傳掃描，應該設置true｢真／正｣，為了最小化內存使用。如果您使用腳本為目的外初始上傳掃描，應該設置false｢假／負｣，為了避免不必要重新加載複製數據在內存。在一般的做法，它應該設置true｢真／正｣，但，如果您做這樣，您將不能夠使用腳本為任何目的以外文件上傳掃描。
- 無影響在CLI模式。

“scan_log”
- 文件為記錄在所有掃描結果。指定一個文件名，或留空以關閉。

“scan_kills”
- 文件為記錄在所有受阻或已殺上傳。指定一個文件名，或留空以關閉。

“ipaddr”
- 在哪裡可以找到連接請求IP地址？（可以使用為服務例如Cloudflare和類似）標準是`REMOTE_ADDR`。警告！不要修改此除非您知道什麼您做著！

“forbid_on_block”
- phpMussel應該發送`403`頭隨著文件上傳受阻信息，或堅持標準`200 OK`？ 0 = 發送`200`【標準】，1 = 發送`403`。

“delete_on_sight”
- 激活的這個指令將指示腳本馬上刪除任何掃描文件上傳匹配任何檢測標準，是否通過簽名或任何事其他。文件已確定是清潔將會忽略。如果是存檔，全存檔將會刪除，不管如果違規文件是只有一個的幾個文件包含在存檔。為文件上傳掃描，按說，它不必要為您激活這個指令，因為按說，PHP將自動清洗內容的它的緩存當執行是完，意思它將按說刪除任何文件上傳從它向服務器如果不已移動，複製或刪除。這個指令是添加這里為額外安全為任何人誰的PHP副本可能不一直表現在預期方式。False｢假／負｣：之後掃描，忽略文件【標準】，True｢真／正｣：之後掃描，如果不清潔，馬上刪除。

“lang”
- 指定標準phpMussel語言。

“lang_override”
- 指定如果phpMussel應該，當可能，更換語言規範通過語言偏愛聲明從入站請求（HTTP_ACCEPT_LANGUAGE）。 0：不更換【標準】，1：更換。

“lang_acceptable”
- `lang_acceptable`指令指示phpMussel什么语言可以公认在脚本从`lang`或从`HTTP_ACCEPT_LANGUAGE`。这个指令应该只会修改如果您添加您自己的个性化语言文件或强制去掉语言文件。指令是一个逗号分隔字符串的代码使用通过那些语言公认在脚本。

“quarantine_key”
- phpMussel可以檢疫壞文件上傳在隔離在phpMussel的安全／保險庫｢Vault｣，如果這個是某物您想。普通用戶的phpMussel簡單地想保護他們的網站或宿主環境無任何興趣在深深分析任何嘗試文件上傳應該離開這個功能關閉，但任何用戶有興趣在更深分析的嘗試文件上傳為目的惡意軟件研究或為類似這樣事情應該激活這個功能。檢疫的嘗試文件上傳可以有時還助攻在調試假陽性，如果這個是某物經常發生為您。以關閉檢疫功能，簡單地離開`quarantine_key`指令空白，或抹去內容的這個指令如果它不已空白。以激活隔離功能，輸入一些值在這個指令。`quarantine_key`是一個重要安全功能的隔離功能需要以預防檢疫功能從成為利用通過潛在攻擊者和以預防任何潛在執行的數據存儲在檢疫。`quarantine_key`應該被處理在同樣方法作為您的密碼：更長是更好，和緊緊保護它。為獲得最佳效果，在結合使用`delete_on_sight`。

“quarantine_max_filesize”
- The maximum allowable filesize of文件to be quarantined.文件larger than the value specified will NOT be quarantined. This directive是important as a means of making it more difficult为any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value是in KB. Default =2048 =2048KB =2MB。

“quarantine_max_usage”
- The maximum memory usage allowed为the quarantine. If the total memory used by the quarantine reaches this value，the oldest quarantined文件will be deleted until the total memory used no longer reaches this value. This directive是important as a means of making it more difficult为any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value是in KB. Default =65536 =65536KB =64MB。

“honeypot_mode”
- When honeypot mode是enabled，phpMussel will attempt to quarantine every single文件upload that it encounters，regardless of 如果 the文件being uploaded matches any included signatures，和no actual scanning or analysis of those attempted文件uploads will actually occur. This functionality should be useful为those that wish to use phpMussel为the purposes of virus/malware research，but it's neither recommended to enable this functionality if the intended use of phpMussel by the user is为actual文件upload scanning，nor recommended to use the honeypot functionality为purposes other than honeypotting. By default，this option是disabled. 0 = Disabled [Default]，1 = Enabled。

“scan_cache_expiry”
-为how long should phpMussel cache the results of scanning? Value是the number of seconds to cache the results of scanning for. Default是21600 seconds (6 hours)；A value of 0 will disable caching the results of scanning。

“disable_cli”
- Disable CLI mode? CLI mode是enabled by default，but can sometimes interfere with certain testing tools (such as PHPUnit，为example)和other CLI-based applications. If you don't need to disable CLI mode，you should ignore this directive. 0 = Enable CLI mode [Default]，1 = Disable CLI mode。

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

檢查Mach-O文件（OSX文件，等等）針對Ma​​ch-O簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “macho_clamav”
- “macho_custom”
- “macho_mussel”

檢查圖像文件針對基於圖像簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “graphics_clamav”
- “graphics_custom”
- “graphics_mussel”

檢查存檔內容針對存檔元數據簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “metadata_clamav”
- “metadata_custom”
- “metadata_mussel”

檢查OLE對象針對OLE簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “ole_clamav”
- “ole_custom”
- “ole_mussel”

檢查文件名針對基於文件名簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “filenames_clamav”
- “filenames_custom”
- “filenames_mussel”

允許掃描通過`phpMussel_mail()`嗎？ False = 不檢查， True = 檢查【標準】。
- “mail_clamav”
- “mail_custom”
- “mail_mussel”

激活具體文件白名單嗎？ False = 不檢查， True = 檢查【標準】。
- “whitelist_clamav”
- “whitelist_custom”
- “whitelist_mussel”

檢查XML／XDP塊針對XML／XDP塊簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “xmlxdp_clamav”
- “xmlxdp_custom”
- “xmlxdp_mussel”

檢查針對複雜擴展簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “coex_clamav”
- “coex_custom”
- “coex_mussel”

檢查針對PDF簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “pdf_clamav”
- “pdf_custom”
- “pdf_mussel”

檢查針對SWF簽名當掃描嗎？ False = 不檢查， True = 檢查【標準】。
- “swf_clamav”
- “swf_custom”
- “swf_mussel”

Signature matching length limiting options. Only change these if you know what you're doing. SD = Standard signatures. RX = PCRE (Perl Compatible Regular Expressions，or "Regex") signatures. FN = Filename signatures. If you notice PHP crashing when phpMussel attempts to scan，try lowering these "max" values. If possible和convenient，let me know when this happens和the results of whatever you try。
- “fn_siglen_min”
- “fn_siglen_max”
- “rx_siglen_min”
- “rx_siglen_max”
- “sd_siglen_min”
- “sd_siglen_max”

“fail_silently”
- Should phpMussel report when签名files are missing or corrupted? If fail_silently是disabled，missing和corrupted文件will be reported on scanning，和if fail_silently是enabled，missing和corrupted文件will be ignored，with scanning reporting为those文件that there aren't any problems. This should generally be left alone unless you're experiencing crashes或类似problems. 0 = Disabled，1 = Enabled [Default]。

“fail_extensions_silently”
- Should phpMussel report when extensions are missing? If fail_extensions_silently是disabled，missing extensions will be reported on scanning，和if fail_extensions_silently是enabled，missing extensions will be ignored，with scanning reporting为those文件that there aren't any problems. Disabling this directive may potentially increase your security，but may also lead to an increase of false positives. 0 = Disabled，1 = Enabled [Default]。

“detect_adware”
- phpMussel應該使用簽名為廣告軟件檢測嗎？ False = 不檢查， True = 檢查【標準】。

“detect_joke_hoax”
- phpMussel應該使用簽名為病毒／惡意軟件笑話／惡作​​劇檢測嗎？ False = 不檢查， True = 檢查【標準】。

“detect_pua_pup”
- phpMussel應該使用簽名為PUP/PUA（可能無用／非通緝程序／軟件）檢測嗎？ False = 不檢查， True = 檢查【標準】。

“detect_packer_packed”
- phpMussel應該使用簽名為打包機和打包數據檢測嗎？ False = 不檢查， True = 檢查【標準】。

“detect_shell”
- phpMussel應該使用簽名為webshel​​l腳本檢測嗎？ False = 不檢查， True = 檢查【標準】。

“detect_deface”
- phpMussel應該使用簽名為污損和污損軟件檢測嗎？ False = 不檢查， True = 檢查【標準】。

####"files" （類別）
文件處理配置。

“max_uploads”
- Maximum allowable number of文件to scan during文件upload scan before aborting the scan和informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn't account为or include the contents of archives。

“filesize_limit”
- Filesize limit in KB. 65536 = 64MB [Default]，0 = No limit (always greylisted)，any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads。

“filesize_response”
- What to do with文件that exceed the filesize limit (if one exists). 0 - Whitelist，1 - Blacklist [Default]。

“filetype_whitelist"，"filetype_blacklist"，"filetype_greylist”
- If your system only allows specific types of文件to be uploaded，or if your system explicitly denies certain types of files，specifying those filetypes in whitelists，blacklists和greylists can increase the speed at which scanning是performed by allowing the脚本to skip over certain filetypes. Format是CSV (comma separated values). If you want to scan everything，rather than whitelist，blacklist or greylist，leave the variable(/s) blank；Doing so will disable whitelist/blacklist/greylist。
- Logical order of processing is：
  - If the filetype是whitelisted，don't scan和don't block the file，和don't check the文件against the blacklist or the greylist。
  - If the filetype是blacklisted，don't scan the文件but block it anyway，和don't check the文件against the greylist。
  - If the greylist是empty or if the greylist是not empty和the filetype是greylisted，scan the文件as per normal和determine whether to block it based on the results of the scan，but if the greylist是not empty和the filetype是not greylisted，treat the文件as blacklisted，therefore not scanning it but blocking it anyway。

“check_archives”
- Attempt to check the contents of archives? 0 - No (do not check)，1 - Yes (check) [Default]。
- Currently，only checking of BZ，GZ，LZF和ZIP文件is supported (checking of RAR，CAB，7z和etcetera not currently supported）。
- This是not foolproof! While I highly recommend keeping this turned on，I can't guarantee it'll always find everything。
- Also be aware that archive checking currently是not recursive为ZIPs。

“filesize_archives”
- Carry over filesize blacklisting/whitelisting to the contents of archives? 0 - No (just greylist everything)，1 - Yes [Default]。

“filetype_archives”
- Carry over filetype blacklisting/whitelisting to the contents of archives? 0 - No (just greylist everything) [Default]，1 - Yes。

“max_recursion”
- Maximum recursion depth limit为archives. Default = 10。

“block_encrypted_archives”
- Detect和block encrypted archives? Because phpMussel isn't able to scan the contents of encrypted archives，it's possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel，杀毒 scanners和other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. 0 - No，1 - Yes [Default]。

####"attack_specific" （類別）
Attack-specific directives。

Chameleon attack detection: 0 = Off，1 = On。

“chameleon_from_php”
- Search为php header in文件that are neither php文件nor recognised archives。

“chameleon_from_exe”
- Search为executable headers in文件that are neither executables nor recognised archives和for executables whose headers are incorrect。

“chameleon_to_archive”
- Search为archives whose headers are incorrect (Supported: BZ，GZ，RAR，ZIP，RAR，GZ）。

“chameleon_to_doc”
- Search为office documents whose headers are incorrect (Supported: DOC，DOT，PPS，PPT，XLA，XLS，WIZ）。

“chameleon_to_img”
- Search为images whose headers are incorrect (Supported: BMP，DIB，PNG，GIF，JPEG，JPG，XCF，PSD，PDD，WEBP）。

“chameleon_to_pdf”
- Search为PDF文件whose headers are incorrect。

“archive_file_extensions"和"archive_file_extensions_wc”
- Recognised archive文件extensions (format是CSV；should only add or remove when problems occur；unnecessarily removing may cause false-positives to appear为archive files，whereas unnecessarily adding will essentially whitelist what you're adding from attack specific detection；modify with caution；also note that this has no effect on what archives can和can't be analysed at content-level). The list，as是at default，lists those formats used most commonly across the majority of systems和CMS，but intentionally isn't necessarily comprehensive。

“general_commands”
- Search content of files为general commands例如`eval()`，`exec()`和`include()`? 0 - No (do not check) [Default]，1 - Yes (check). Disable this option if you intend to upload any of 下列 to your system or CMS via your browser: PHP，JavaScript，HTML，python，perl files和etcetera. Enable this option if you don't have any additional protections on your system和do not intend to upload such files. If you use additional security in conjunction with phpMussel例如ZB Block，there是no need to turn this option on，because most of what phpMussel will look为(in the context of this option) are duplications of protections that are already provided。

“block_control_characters”
- Block any文件containing any control characters (other than newlines)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) If you're _**ONLY**_ uploading plain-text，then you can turn this option on to provide some additional protection to your system. However，if you upload anything other than plain-text，turning this on may result in false positives. 0 - Don't block [Default]，1 - Block。

“corrupted_exe”
- Corrupted files和parse errors. 0 = Ignore，1 = Block [Default]. Detect和block potentially corrupted移植可执行｢PE｣ files? Often (but not always)，when certain aspects of a移植可执行｢PE｣file are corrupted or can't be parsed correctly，it can be indicative of a viral infection. The processes used by most 杀毒 programs to detect viruses in PE文件require parsing those文件in certain ways，which，if the programmer of a virus是aware of，will specifically try to prevent，in order to allow their virus to remain undetected。

“decode_threshold”
- Optional limitation or threshold to the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues whilst scanning). Value是an integer representing filesize in KB. Default = 512 (512KB). Zero or null value disables the threshold (removing any such limitation based on filesize）。

“scannable_threshold”
- Optional limitation or threshold to the length of raw data that phpMussel是permitted to read和scan (in case there are any noticeable performance issues whilst scanning). Value是an integer representing filesize in KB. Default = 32768 (32MB). Zero or null value disables the threshold. Generally，this value shouldn't be less than the average filesize of文件uploads that you want和expect to receive to your server or website，shouldn't be more than the filesize_limit directive，和shouldn't be more than roughly one fifth of the total allowable memory allocation granted to PHP via the php.ini configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that'd prevent it from being able to successfully scan文件above a certain filesize）。

####"compatibility" （類別）
Compatibility directives为phpMussel。

“ignore_upload_errors”
- This directive should generally be disabled unless it's required为correct functionality of phpMussel on your specific system. Normally，when disabled，when phpMussel detects the presence of elements in the `$_FILES` array()，it'll attempt to initiate a scan of the文件that those elements represent，and，if those elements are blank or empty，phpMussel will return an error message. This是proper behaviour为phpMussel。However，为some CMS，empty elements in `$_FILES` can occur as a result of the natural behaviour of those CMS，or errors may be reported when there aren't any，in which case，the normal behaviour为phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs为you，enabling this option will instruct phpMussel to not attempt to initiate scans为such empty elements，ignore them when found和to not return any related error messages，thus allowing continuation of the page request. 0 - OFF，1 - ON。

“only_allow_images”
- If you only expect or only intend to allow images to be uploaded to your system or CMS，和if you absolutely don't require any文件other than images to be uploaded to your system or CMS，this directive should be enabled，but should otherwise be disabled. If this directive是enabled，it'll instruct phpMussel to indiscriminately block any uploads identified as non-image files，without scanning them. This may reduce processing time和memory usage为attempted uploads of non-image files. 0 - OFF，1 - ON。

####"heuristic" （類別）
Heuristic directives。

“threshold”
- There are certain签名of phpMussel that are intended to identify suspicious和potentially malicious qualities of文件being uploaded without in themselves identifying those文件being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious和potentially malicious qualities of文件being uploaded that's allowable是before those文件are to be flagged as malicious. The definition of weight in this context是the total number of suspicious和potentially malicious qualities identified. By default，this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious文件being flagged，whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious文件being flagged. It's generally best to leave this value at its default unless you're experiencing problems related to it。

####"virustotal" （類別）
VirusTotal.com directives。

“vt_public_api_key”
- Optionally，phpMussel是able to scan文件using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses，trojans，malware和other threats. By default，scanning文件using the Virus Total API是disabled. To enable it，an API key from Virus Total是required. Due to the significant benefit that this could provide to you，it's something that I highly recommend enabling. Please be aware，however，that to use the Virus Total API，you _**MUST**_ agree to their Terms of Service和you _**MUST**_ adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS：
  - You have read和agree to the Terms of Service of Virus Total和its API. The Terms of Service of Virus Total和its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/)。
  - You have read和you understand，at a minimum，the preamble of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). The Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/)。

Note: If scanning文件using the Virus Total API是disabled，you won't need to review any of the directives in this category (`virustotal`)，because none of them will do anything if this是disabled. To acquire a Virus Total API key，from anywhere on their website，click the "Join our Community" link located towards the top-right of the page，enter in the information requested，和click "Sign up" when done. Follow all instructions supplied，和when you've got your public API key，copy/paste that public API key to the `vt_public_api_key` directive of the `phpmussel.ini` configuration file。

“vt_suspicion_level”
- By default，phpMussel will restrict which文件it scans using the Virus Total API to those文件that it considers "suspicious". You can optionally adjust this restriction by changing the value of the `vt_suspicion_level` directive。
- `0`:文件are only considered suspicious if，upon being scanned by phpMussel using its own signatures，they are deemed to carry a heuristic weight. This would effectively mean that use of the Virus Total API would be为a second opinion为when phpMussel suspects that a文件may potentially be malicious，but can't entirely rule out that it may also potentially be benign (non-malicious)和therefore would otherwise normally not block it or flag it as being malicious。
- `1`:文件are considered suspicious if，upon being scanned by phpMussel using its own signatures，they are deemed to carry a heuristic weight，if they're known to be executable (PE files，Mach-O files，ELF/Linux files，etc)，or if they're known to be of a format that could potentially contain executable data (such as executable macros，DOC/DOCX files，archive文件such as RARs，ZIPS和etc). This是the default和recommended suspicion level to apply，effectively meaning that use of the Virus Total API would be为a second opinion为when phpMussel doesn't initially find anything malicious or wrong with a文件that it considers to be suspicious和therefore would otherwise normally not block it or flag it as being malicious。
- `2`: All文件are considered suspicious和should be scanned using the Virus Total API. I don't generally recommend applying this suspicion level，due to the risk of reaching your API quota much quicker than would otherwise be the case，but there are certain circumstances (such as when the webmaster or hostmaster has very little faith or trust whatsoever in any of the uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level，all文件not normally blocked or flagged as being malicious would be scanned using the Virus Total API. Note，however，that phpMussel will cease using the Virus Total API when your API quota has been reached (regardless of suspicion level)，和that your quota will likely be reached much faster when using this suspicion level。

Note: Regardless of suspicion level，any文件that are either blacklisted or whitelisted by phpMussel won't be scanned using the Virus Total API，because those such文件would've already been declared as either malicious or benign by phpMussel by the time that they would've otherwise been scanned by the Virus Total API，和therefore，additional scanning wouldn't be required. The ability of phpMussel to scan文件using the Virus Total API是intended to build further confidence为whether a file是malicious or benign in those circumstances where phpMussel itself isn't entirely certain as to whether a file是malicious or benign。

“vt_weighting”
- Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists，because，虽说 scanning a文件using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious文件being caught)，it can also result in a higher number of false positives，和therefore，in some circumstances，the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0是used，the results of scanning using the Virus Total API will be applied as detections，和therefore，if any engine used by Virus Total flags the文件being scanned as being malicious，phpMussel will consider the文件to be malicious. If any other value是used，the results of scanning using the Virus Total API will be applied as detection weighting，和therefore，the number of engines used by Virus Total that flag the文件being scanned as being malicious will serve as a confidence score (or detection weighting)为如果 the文件being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0是used by default。

“vt_quota_rate"和"vt_quota_time”
- According to the Virus Total API documentation，"it是limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient，honeypot or any other automation that是going to provide resources to VirusTotal和not only retrieve reports you are entitled to a higher request rate quota". By default，phpMussel will strictly adhere to these limitations，but due to the possibility of these rate quotas being increased，these two directives are provided as a means为you to instruct phpMussel as to what limit it should adhere to. Unless you've been instructed to do so，it's不推荐为you to increase these values，but，if you've encountered problems relating to reaching your rate quota，decreasing these values _**MAY**_ sometimes help you in dealing with these problems. Your rate limit是determined as `vt_quota_rate` requests of any nature in any given `vt_quota_time` minute time frame。

####"template_data" （類別）
Directives/Variables为templates和themes。

Template data relates to the HTML output used to generate the "Upload Denied" message displayed to users upon a文件upload being blocked. If you're using custom themes为phpMussel，HTML output是sourced from the `template_custom.html` file，和otherwise，HTML output是sourced from the `template.html` file. Variables written to this section of the configuration文件are parsed to the HTML output by way of replacing any variable names circumfixed by curly brackets found within the HTML output with the corresponding variable data.为example，where `foo="bar"`，any instance of `<p>{foo}</p>` found within the HTML output will become `<p>bar</p>`。

“css_url”
- The template file为custom themes utilises external CSS properties，whereas the template file为the default theme utilises internal CSS properties. To instruct phpMussel to use the template file为custom themes，specify the public HTTP address of your custom theme's CSS文件using the `css_url` variable. If you leave this variable blank，phpMussel will use the template file为the default theme。

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

Where NAME是the name to cite为that signature和HEX是a hexadecimal-encoded segment of the文件intended to be matched by the given signature. FROM和TO are optional parameters，indicting from which和to which positions in the source data to check against (not supported by the mail function）。

####*REGEX*
Any form of regex understood和correctly processed by PHP should also be correctly understood和processed by phpMussel和its signatures. However，I'd suggest taking extreme caution when writing new regex based signatures，because，if you're not entirely sure what you're doing，there can be highly irregular 和／或 unexpected results. Take a look at the phpMussel source-code if you're not entirely sure about the context in which regex statements are parsed. Also，remember that all patterns (with exception to filename，archive metadata和MD5 patterns) must be hexadecimally encoded (foregoing pattern syntax，of course)!

####*WHERE TO PUT CUSTOM SIGNATURES?*
Only put custom签名in those文件intended为custom signatures. Those文件should contain "_custom" in their filenames. You should also avoid editing the default signature files，unless you know exactly what you're doing，because，aside from being good practise in general和aside from helping you distinguish between your own signatures和the default签名included with phpMussel，it's good to stick to editing only the文件intended为editing，because tampering with the default signature文件can cause them to stop working correctly，due to the "maps" files: The maps文件tell phpMussel where in the signature文件to look for签名required by phpMussel as per when required，和these maps can become out-of-sync with their associated signature文件if those signature文件are tampered with. You can put pretty much whatever you want into your custom signatures，so long as you follow the correct syntax. However，be careful to test new签名for false-positives beforehand if you intend to share them or use them in a live environment。

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
- “OLE簽名” （ole_*）。匹配針對內容的所有非白名單OLE對象目​​標為掃描。
- “PDF簽名” （pdf_*）。匹配針對內容的所有非白名單PDF文件目標為掃描。
- “移植可執行｢PE｣部分簽名” （pe_*）。匹配針對MD5哈希和大小的每移植可執行｢PE｣部分的所有非白名單文件目標為掃描識別的移植可執行｢PE｣文件。
- “移植可執行｢PE｣擴展簽名” （pex_*）。匹配針對MD5哈希和大小的變量在所有非白名單文件目標為掃描識別的移植可執行｢PE｣文件。
- “SWF簽名” （swf_*）。匹配針對內容的所有非白名單SWF文件目標為掃描。
- “白名單簽名” （whitelist_*）。匹配針對MD5哈希的內容和文件大小的所有文件目標為掃描。識別文件將會免疫的成為匹配通過簽名類型提到從他們的白名單項。
- “XML／XDP塊簽名” （xmlxdp_*）。匹配針對任何XML／XDP塊發現從任何非白名單文件目標為掃描。
(請注意任何的這些簽名可以很容易地關閉通過`phpmussel.ini`）。

---


###8. <a name="SECTION8"></a>已知的兼容問題

####PHP和PCRE
- phpMussel需要PHP和PCRE以正確地執行和功能。如果沒有PHP，或如果沒有PCRE擴展的PHP，phpMussel不會正確地執行和功能。應該確保您的系統有PHP和PCRE安裝和可用之前下載和安裝phpMussel。

####殺毒軟件兼容性

在大多數情況下，phpMussel應該相當兼容性與大多數殺毒軟件。然，衝突已經報導由多個用戶以往。下面這些信息是從VirusTotal.com，和它描述了一個數的假陽性報告的各種殺毒軟件針對phpMussel。雖說這個信息是不絕對保證的如果您會遇到兼容性問題間phpMussel和您的殺毒軟件，如果您的殺毒軟件注意為衝突針對phpMussel，您應該考慮關閉它之前使用phpMussel或您應該考慮替代選項從您的殺毒軟件或從phpMussel。

這個信息最後更新2015年9月7日和是準確為至少phpMussel的兩個最近次要版本（v0.6-v0.7a）在這個現在時候的寫作。

| 掃描器               |  結果                                 |
|----------------------|--------------------------------------|
| Ad-Aware             |  沒有已知的問題                       |
| Agnitum              |  沒有已知的問題                       |
| AhnLab-V3            |  沒有已知的問題                       |
| AntiVir              |  沒有已知的問題                       |
| Antiy-AVL            |  沒有已知的問題                       |
| Avast                |  報告 "JS:ScriptSH-inf [Trj]"        |
| AVG                  |  沒有已知的問題                       |
| Baidu-International  |  沒有已知的問題                       |
| BitDefender          |  沒有已知的問題                       |
| Bkav                 |  報告 "VEXDAD2.Webshell"             |
| ByteHero             |  沒有已知的問題                       |
| CAT-QuickHeal        |  沒有已知的問題                       |
| ClamAV               |  沒有已知的問題                       |
| CMC                  |  沒有已知的問題                       |
| Commtouch            |  沒有已知的問題                       |
| Comodo               |  沒有已知的問題                       |
| DrWeb                |  沒有已知的問題                       |
| Emsisoft             |  沒有已知的問題                       |
| ESET-NOD32           |  沒有已知的問題                       |
| F-Prot               |  沒有已知的問題                       |
| F-Secure             |  沒有已知的問題                       |
| Fortinet             |  沒有已知的問題                       |
| GData                |  沒有已知的問題                       |
| Ikarus               |  沒有已知的問題                       |
| Jiangmin             |  沒有已知的問題                       |
| K7AntiVirus          |  沒有已知的問題                       |
| K7GW                 |  沒有已知的問題                       |
| Kaspersky            |  沒有已知的問題                       |
| Kingsoft             |  沒有已知的問題                       |
| Malwarebytes         |  沒有已知的問題                       |
| McAfee               |  報告 "New Script.c"                 |
| McAfee-GW-Edition    |  報告 "New Script.c"                 |
| Microsoft            |  沒有已知的問題                       |
| MicroWorld-eScan     |  沒有已知的問題                       |
| NANO-Antivirus       |  沒有已知的問題                       |
| Norman               |  沒有已知的問題                       |
| nProtect             |  沒有已知的問題                       |
| Panda                |  沒有已知的問題                       |
| Qihoo-360            |  沒有已知的問題                       |
| Rising               |  沒有已知的問題                       |
| Sophos               |  沒有已知的問題                       |
| SUPERAntiSpyware     |  沒有已知的問題                       |
| Symantec             |  沒有已知的問題                       |
| TheHacker            |  沒有已知的問題                       |
| TotalDefense         |  沒有已知的問題                       |
| TrendMicro           |  沒有已知的問題                       |
| TrendMicro-HouseCall |  沒有已知的問題                       |
| VBA32                |  沒有已知的問題                       |
| VIPRE                |  沒有已知的問題                       |
| ViRobot              |  沒有已知的問題                       |


---


最後更新：2015年9月11日。
