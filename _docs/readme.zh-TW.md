## phpMussel 中文（傳統）文檔。

### 內容
- 1. [前言](#SECTION1)
- 2. [如何安裝](#SECTION2)
- 3. [如何使用](#SECTION3)
- 4. [前端管理](#SECTION4)
- 5. [CLI（命令行界面）](#SECTION5)
- 6. [文件在包](#SECTION6)
- 7. [配置選項](#SECTION7)
- 8. [簽名格式](#SECTION8)
- 9. [已知的兼容問題](#SECTION9)
- 10. [常見問題（FAQ）](#SECTION10)
- 11. [法律信息](#SECTION11)

*翻譯註釋：如果錯誤（例如，​翻譯差異，​錯別字，​等等），​英文版這個文件是考慮了原版和權威版。​如果您發現任何錯誤，​您的協助糾正他們將受到歡迎。​*

---


### 1. <a name="SECTION1"></a>前言

感謝使用phpMussel，​這是一個根據ClamAV的簽名和其他簽名在上傳完成後來自動檢測木馬/病毒/惡意軟件和其他可能威脅到您系統安全的文件的PHP腳本。

PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan)。

本腳本是基於GNU通用許可V2.0版許可協議發布的，​您可以在許可協議的允許範圍內自行修改和發布，​但請遵守GNU通用許可協議。​使用腳本的過程中，​作者不提供任何擔保和任何隱含擔保。​更多的細節請參見GNU通用公共許可證，​下的`LICENSE.txt`文件也可從訪問：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

謝謝[ClamAV](http://www.clamav.net/)為本腳本提供文件簽名庫訪問許可。​沒有它，​這個腳本很可能不會存在，​或者其價值有限。

謝謝SourceForge和GitHub為項目託管，​還有謝謝這些組織為提供一些簽名：​[SecuriteInfo.com](http://www.securiteinfo.com/)，​[PhishTank](http://www.phishtank.com/)，​[NLNetLabs](http://nlnetlabs.nl/)，​等人。

現在phpMussel的代碼文件和關聯包可以從以下地址免費下載：
- [SourceForge](http://phpmussel.sourceforge.net/)。
- [GitHub](https://github.com/phpMussel/phpMussel/)。

---


### 2. <a name="SECTION2"></a>如何安裝

#### 2.0 安裝手工（WEB服務器）

1） 在閱讀到這里之前，​我假設您已經下載腳本的一個副本，​已解壓縮其內容並保存在您的機器的某個地方。​現在，​您要決定將腳本放在您服務器上的哪些文件夾中，​例如`/public_html/phpmussel/`或其他任何您覺得滿意和安全的地方。​*上傳完成後，​繼續閱讀。​。​*

2） 重命名`config.ini.RenameMe`到`config.ini`（位於內`vault`），​和如果您想（強烈推薦高級用戶，​但不推薦業餘用戶或者新手使用這個方法），​打開它（這個文件包含所有phpMussel的可用配置選項；以上的每一個配置選項應有一個簡介來說明它是做什麼的和它的具有的功能）。​按照您認為合適的參數來調整這些選項，​然後保存文件，​關閉。

3） 上傳（phpMussel和它的文件）到您選定的文件夾（不需要包括`*.txt`/`*.md`文件，​但大多數情況下，​您應上傳所有的文件）。

4） 修改的`vault`文件夾權限為『755』（如果有問題，​您可以試試『777』，​但是這是不太安全）。​注意，​主文件夾也應該是該權限，​如果遇上其他權限問題，​請修改對應文件夾和文件的權限。

5） 安裝您需要的任何簽名。​看到：[安裝簽名](#INSTALLING_SIGNATURES)。

6） 接下來，​您需要為您的系統或CMS設定啟動phpMussel的鉤子。​有幾種不同的方式為您的系統或CMS設定鉤子，​最簡單的是在您的系統或CMS的核心文件的開頭中使用`require`或`include`命令直接包含腳本（這個方法通常會導致在有人訪問時每次都加載）。​平時，​這些都是存儲的在文件夾中，​例如`/includes`，​`/assets`或`/functions`等文件夾，​和將經常被命名的某物例如`init.php`，​`common_functions.php`，​`functions.php`。​這是根據您自己的情況決定的，​並不需要完全遵守；如果您遇到困難，​參觀GitHub上的phpMussel issues頁面和/或訪問phpMussel支持論壇和發送問題；可能其他用戶或者我自己也有這個問題並且解決了（您需要讓我們您在使用哪些CMS）。​為了使用`require`或`include`，​插入下面的代碼行到最開始的該核心文件，​更換裡面的數據引號以確切的地址的`loader.php`文件（本地地址，​不是HTTP地址；它會類似於前面提到的vault地址）。

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

保存文件，​關閉，​重新上傳。

-- 或替換 --

如果您使用Apache網絡服務器並且您可以訪問`php.ini`，​您可以使用該`auto_prepend_file`指令為任何PHP請求創建附上的phpMussel。​就像是：

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

或在該`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7） 到這裡，​您已經完成安裝，​現在您應測試phpMussel以確保它的正常運行！​為了保護系統中的文件（或者應該翻譯為保護上傳的文件），​可以嘗試通過常用的瀏覽器上傳的方式上傳包含在`_testfiles`文件夾內的內容到您的網站。​如果一切正常，​phpMussel應該出現阻止上傳信息，​如果出現什麼不正常情況例如您使用了其他高級的功能或使用的其它類型的掃描，​我建議嘗試它跟他們一起使用以確保都能工作正常。

#### 2.1 安裝手工（CLI）

1） 在閱讀到這里之前，​我假設您已經下載腳本並且已經解壓縮並且保存在您指定的位置。

2） phpMussel需要PHP運行環境支持。​如果您沒有安裝PHP，​請安裝。

3） 自定義（強烈推薦高級用戶使用，​但不推薦新手或沒有經驗的用戶使用）：打開`config.ini`（位於內`vault`） – 這個文件包含phpMussel所有的配置選項。​每選項應有一個簡評以說明它做什麼和它的功能。​按照您認為合適的參數調整這些選項，​然後保存文件，​關閉。

4） 您如果您創建一個批處理文件來自動加載的PHP和phpMussel，​那麼使用phpMussel的CLI模式將更加方便。​要做到這一點，​打開一個純文本編輯器例如Notepad或Notepad++，​輸入php.exe的完整路徑（注意是絕對路徑不是相對路徑），​其次是一個空格，​然後是`loader.php`的路徑（同php.exe），​最後，​保存此文件使用一個`.bat`擴展名放在常用的位置；在您指定的位置，​能通過雙擊您保存的`.bat`文件來調用phpMussel。

5） 安裝您需要的任何簽名。​看到：[安裝簽名](#INSTALLING_SIGNATURES)。

6） 到這裡，​您完成了CLI模式的安裝！​當然您應測試以確保正常運行。​如果要測試phpMussel，​請通過phpMussel嘗試掃描`_testfiles`文件夾內提供的文件。

#### 2.2 與COMPOSER安裝

[phpMussel是在Packagist上](https://packagist.org/packages/phpmussel/phpmussel)，​所以，​如果您熟悉Composer，​您可以使用Composer安裝phpMussel（您仍然需要準備配置和鉤子；參考『安裝手工（WEB服務器）』步驟2和6）。

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 安裝簽名

以來v1.0.0，簽名不包括在phpMussel包中。​phpMussel需要簽名來檢測特定的威脅。​安裝簽名有三種主要方法：

1. 使用前端更新頁面自動安裝。
2. 使用『SigTool』生成簽名並手動安裝。
3. 從『phpMussel/Signatures』下載簽名並手動安裝。

##### 2.3.1 使用前端更新頁面自動安裝。

首先，您需要確保前端已啟用。 *看到：[前端管理](#SECTION4).*

然後，所有您需要做的是轉到前端更新頁面，找到必要的簽名文件，並使用頁面上提供的選項，安裝它們並激活他們。

##### 2.3.2 使用『SigTool』生成簽名並手動安裝。

*看到：[SigTool文檔](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 從『phpMussel/Signatures』下載簽名並手動安裝。

首先，去[phpMussel/Signatures](https://github.com/phpMussel/Signatures)。​存儲庫包含各種GZ壓縮的簽名文件。​下載所需的文件，解壓縮文件，並將解壓縮的文件複製到`/vault/signatures`目錄以進行安裝。​將文件的名稱放在`Active`指令中（在您的phpMussel配置）來激活他們。

---


### 3. <a name="SECTION3"></a>如何使用

#### 3.0 如何使用（對於WEB服務器）

phpMussel應該能夠正確操作與最低要求從您：安裝後，​它應該立即開展工作和應該立即有用。

文件上傳掃描是自動的和按照設定規則激活的，​所以，​您不需要做任何額外的事情。

另外，​您能手動使用phpMussel掃描文件，​文件夾或存檔當您需要時。​要做到這一點，​首先，​您需要確保`config.ini`文件（`cleanup`【清理】必須關閉）的配置是正常的，​然後通過任何一個PHP文件的鉤子至phpMussel，​在您的代碼中添加以下代碼：

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan`可以是字符串，​數組，​或多維數組，​和表明什麼文件，​收集的文件，​文件夾和/或文件夾至掃描。
- `$output_type`是布爾，​和表明什麼格式到回報掃描結果作為。​False【假/負】指示關於功能以回報掃描結果作為整數。​True【真/正】指示關於功能以回報掃描結果作為人類可讀文本。​此外，​在任一情況下，​結果可以訪問通過全局變量後掃描是完成。​變量是自選，​確定作為False【假/負】作為標準。​以下描述整數結果：

| 結果 | 說明 |
|---|---|
| -3 | 表明問題是遇到關於phpMussel簽名文件或簽名MAP【地圖】文件和表明他們可能是失踪或損壞。 |
| -2 | 表明損壞數據是檢測中掃描和因此掃描失敗完成。 |
| -1 | 表明擴展或插件需要通過PHP以經營掃描是失踪和因此掃描失敗完成。 |
| 0 | 表明掃描目標不存在和因此沒有任何事為掃描。 |
| 1 | 表明掃描目標是成功掃描和沒有任何問題檢測。 |
| 2 | 表明掃描目標是成功掃描和至少一些問題是檢測。 |

- `$output_flatness`是布爾，​表明如果回報掃描結果（如果有多掃描目標）作為數組或字符串。​False【假/負】指示回報結果作為數組。​True【真/正】負】指示回報結果作為字符串。​變量是自選，​確定作為False【假/負】作為標準。

例子：

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

返回結果類似於（作為字符串）：

```
 Wed, 16 Sep 2013 02:49:46 +0000 開始。
 > 檢查 '/user_name/public_html/my_file.html':
 -> 沒有任何問題發現。
 Wed, 16 Sep 2013 02:49:47 +0000 完了。
```

對一個簽名類型進行完整的檢查測試以及phpMussel如何掃描和使用簽名文件，​請參閱【[簽名格式](#SECTION8)】部分的自述文件。

如果您遇到任何誤報，​如果您遇到無法檢測的新類型，​或者關於簽名的其他任何問題，​請聯繫我以便於後續的版本支持，​該，​如果您不聯繫我，​我可能不會知道並在下一版本中進行處理。 *(看到：[什麼是『假陽性』？​](#WHAT_IS_A_FALSE_POSITIVE))。​*

如果您遇到誤報嚴重或者不需要檢測該簽名下的文件或者其他不需要使用簽名驗證的場景，​將要禁用的特定簽名的名稱添加到簽名灰名單文件（`/vault/greylist.csv`），被逗號隔開。

*也可以看看： [掃描時如何訪問文件的具體細節？](#SCAN_DEBUGGING)*

#### 3.1 如何使用（CLI）

請參考『安裝手工（CLI）』部分的這個自述文件。

還注意，​phpMussel是『*一經請求*』掃描器；不是『*一經訪問*』掃描器（除了文件上傳，​在上傳時候），​而不像傳統的防病毒套件，​它不監控活動內存！​它將會只檢測病毒從文件上傳，​而從那些具體文件您明確地告訴它需要掃描。

---


### 4. <a name="SECTION4"></a>前端管理

#### 4.0 什麼是前端。

前端提供了一種方便，​輕鬆的方式來維護，​管理和更新phpMussel安裝。​您可以通過日誌頁面查看，​共享和下載日誌文件，​您可以通過配置頁面修改配置，​您可以通過更新頁面安裝和卸載組件，​和您可以通過文件管理器上傳，​下載和修改文件在vault。

默認情況是禁用前端，​以防止未授權訪問 （未授權訪問可能會對您的網站及其安全性造成嚴重後果）。​啟用它的說明包括在本段下面。

#### 4.1 如何啟用前端。

1) 裡面的`config.ini`文件，​找到指令`disable_frontend`，​並將其設置為`false` （默認值為`true`）。

2) 從瀏覽器訪問`loader.php` （例如，​`http://localhost/phpmussel/loader.php`）。

3) 使用默認用戶名和密碼（admin/password）登錄。

注意：第一次登錄後，​以防止未經授權的訪問前端，​您應該立即更改您的用戶名和密碼！​這是非常重要的，​因為它可以任意PHP代碼上傳到您的網站通過前端。

#### 4.2 如何使用前端。

每個前端頁面上都有說明，​用於解釋正確的用法和它的預期目的。​如果您需要進一步的解釋或幫助，​請聯繫支持。​另外，​YouTube上還有一些演示視頻。

---


### 5. <a name="SECTION5"></a>CLI（命令行界面）

在Windows系統上phpMussel在CLI模式可以作為一個互動文件執行掃描。​參考【如何安裝（對於CLI）】部分的這個自述文件為更信息。

為一個列表的可用CLI命令，​在CLI提示，​鍵入【c】，​和按Enter鍵。

另外，​對於那些有興趣，​一個視頻教程如何使用phpMussel在命令行模式是可在這裡：
- <https://youtu.be/H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>文件在包
（本段文件採用的自動翻譯，​因為都是一些文件描述，​參考意義不是很大，​如有疑問，​請參考英文原版）

下面是一個列表的所有的文件該應該是存在在您的存檔在下載時間，​任何文件該可能創建因之的您的使用這個腳本，​包括一個簡短說明的他們的目的。

文件 | 說明
----|----
/_docs/ | 筆記文件夾（包含若干文件）。
/_docs/readme.ar.md | 阿拉伯文自述文件。
/_docs/readme.de.md | 德文自述文件。
/_docs/readme.en.md | 英文自述文件。
/_docs/readme.es.md | 西班牙文自述文件。
/_docs/readme.fr.md | 法文自述文件。
/_docs/readme.id.md | 印度尼西亞文自述文件。
/_docs/readme.it.md | 意大利文自述文件。
/_docs/readme.ja.md | 日文自述文件。
/_docs/readme.ko.md | 韓文自述文件。
/_docs/readme.nl.md | 荷蘭文自述文件。
/_docs/readme.pt.md | 葡萄牙文自述文件。
/_docs/readme.ru.md | 俄文自述文件。
/_docs/readme.ur.md | 烏爾都文自述文件。
/_docs/readme.vi.md | 越南文自述文件。
/_docs/readme.zh-TW.md | 中文（簡體）自述文件。
/_docs/readme.zh.md | 中文（簡體）自述文件。
/_testfiles/ | 測試文件文件夾（包含若干文件）。​所有包含文件是測試文件為測試如果phpMussel是正確地安裝上您的系統，​和您不需要上傳這個文件夾或任何其文件除為上傳測試。
/_testfiles/ascii_standard_testfile.txt | 測試文件以測試phpMussel標準化ASCII簽名。
/_testfiles/coex_testfile.rtf | 測試文件以測試phpMussel複雜擴展簽名。
/_testfiles/exe_standard_testfile.exe | 測試文件以測試phpMussel移植可執行【PE】簽名。
/_testfiles/general_standard_testfile.txt | 測試文件以測試phpMussel通用簽名。
/_testfiles/graphics_standard_testfile.gif | 測試文件以測試phpMussel圖像簽名。
/_testfiles/html_standard_testfile.html | 測試文件以測試phpMussel標準化HTML簽名。
/_testfiles/md5_testfile.txt | 測試文件以測試phpMussel MD5簽名。
/_testfiles/ole_testfile.ole | 測試文件以測試phpMussel OLE簽名。
/_testfiles/pdf_standard_testfile.pdf | 測試文件以測試phpMussel PDF簽名。
/_testfiles/pe_sectional_testfile.exe | 測試文件以測試phpMussel移植可執行【PE】部分簽名。
/_testfiles/swf_standard_testfile.swf | 測試文件以測試phpMussel SWF簽名。
/vault/ | 安全/保險庫【Vault】文件夾（包含若干文件）。
/vault/cache/ | 緩存【Cache】文件夾（為臨時數據）。
/vault/cache/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/fe_assets/ | 前端資產。
/vault/fe_assets/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/fe_assets/_accounts.html | 前端賬戶頁面的HTML模板。
/vault/fe_assets/_accounts_row.html | 前端賬戶頁面的HTML模板。
/vault/fe_assets/_cache.html | 前端緩存數據頁面的HTML模板。
/vault/fe_assets/_config.html | 前端配置頁面的HTML模板。
/vault/fe_assets/_config_row.html | 前端配置頁面的HTML模板。
/vault/fe_assets/_files.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_edit.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_rename.html | 文件管理器的HTML模板。
/vault/fe_assets/_files_row.html | 文件管理器的HTML模板。
/vault/fe_assets/_home.html | 端主頁的HTML模板。
/vault/fe_assets/_login.html | 前端登錄的HTML模板。
/vault/fe_assets/_logs.html | 前端日誌頁面的HTML模板。
/vault/fe_assets/_nav_complete_access.html | 前端導航鏈接的HTML模板，​由那些與完全訪問使用。
/vault/fe_assets/_nav_logs_access_only.html | 前端導航鏈接的HTML模板，​由那些與僅日誌訪問使用。
/vault/fe_assets/_quarantine.html | 前端隔離頁面的HTML模板。
/vault/fe_assets/_quarantine_row.html | 前端隔離頁面的HTML模板。
/vault/fe_assets/_statistics.html | 前端統計頁面的HTML模板。
/vault/fe_assets/_updates.html | 前端更新頁面的HTML模板。
/vault/fe_assets/_updates_row.html | 前端更新頁面的HTML模板。
/vault/fe_assets/_upload_test.html | 上傳測試頁面的HTML模板。
/vault/fe_assets/frontend.css | 前端CSS樣式表。
/vault/fe_assets/frontend.dat | 前端數據庫（包含賬戶信息，​會話信息，​和緩存；只生成如果前端是啟用和使用）。
/vault/fe_assets/frontend.html | 前端的主HTML模板文件。
/vault/fe_assets/icons.php | 圖標處理文件（由前端文件管理器使用）。
/vault/fe_assets/pips.php | 點數處理文件（由前端文件管理器使用）。
/vault/fe_assets/scripts.js | 包含前端JavaScript數據。
/vault/lang/ | 包含phpMussel語言數據。
/vault/lang/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/lang/lang.ar.fe.php | 阿拉伯文前端語言數據。
/vault/lang/lang.ar.php | 阿拉伯文語言數據。
/vault/lang/lang.bn.fe.php | 孟加拉文前端語言數據。
/vault/lang/lang.bn.php | 孟加拉文語言數據。
/vault/lang/lang.de.fe.php | 德文前端語言數據。
/vault/lang/lang.de.php | 德文語言數據。
/vault/lang/lang.en.fe.php | 英文前端語言數據。
/vault/lang/lang.en.php | 英文語言數據。
/vault/lang/lang.es.fe.php | 西班牙文前端語言數據。
/vault/lang/lang.es.php | 西班牙文語言數據。
/vault/lang/lang.fr.fe.php | 法文前端語言數據。
/vault/lang/lang.fr.php | 法文語言數據。
/vault/lang/lang.hi.fe.php | 印地文前端語言數據。
/vault/lang/lang.hi.php | 印地文語言數據。
/vault/lang/lang.id.fe.php | 印度尼西亞文前端語言數據。
/vault/lang/lang.id.php | 印度尼西亞文語言數據。
/vault/lang/lang.it.fe.php | 意大利文前端語言數據。
/vault/lang/lang.it.php | 意大利文語言數據。
/vault/lang/lang.ja.fe.php | 日文前端語言數據。
/vault/lang/lang.ja.php | 日文語言數據。
/vault/lang/lang.ko.fe.php | 韓文前端語言數據。
/vault/lang/lang.ko.php | 韓文語言數據。
/vault/lang/lang.nl.fe.php | 荷蘭文前端語言數據。
/vault/lang/lang.nl.php | 荷蘭文語言數據。
/vault/lang/lang.pt.fe.php | 葡萄牙文前端語言數據。
/vault/lang/lang.pt.php | 葡萄牙文語言數據。
/vault/lang/lang.ru.fe.php | 俄文前端語言數據。
/vault/lang/lang.ru.php | 俄文語言數據。
/vault/lang/lang.th.fe.php | 泰文前端語言數據。
/vault/lang/lang.th.php | 泰文語言數據。
/vault/lang/lang.tr.fe.php | 土耳其文前端語言數據。
/vault/lang/lang.tr.php | 土耳其文語言數據。
/vault/lang/lang.ur.fe.php | 烏爾都文前端語言數據。
/vault/lang/lang.ur.php | 烏爾都文語言數據。
/vault/lang/lang.vi.fe.php | 越南文前端語言數據。
/vault/lang/lang.vi.php | 越南文語言數據。
/vault/lang/lang.zh-tw.fe.php | 中文（傳統）前端語言數據。
/vault/lang/lang.zh-tw.php | 中文（傳統）語言數據。
/vault/lang/lang.zh.fe.php | 中文（簡體）前端語言數據。
/vault/lang/lang.zh.php | 中文（簡體）語言數據。
/vault/quarantine/ | 隔離文件夾（包含隔離文件）。
/vault/quarantine/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/signatures/ | 簽名文件夾（包含簽名文件）。
/vault/signatures/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/signatures/switch.dat | 控制和確定某些變量。
/vault/.htaccess | 超文本訪問文件（在這種情況，​以保護敏感文件屬於腳本從被訪問由非授權來源）。
/vault/.travis.php | 由Travis CI用於測試（不需要為正確經營腳本）。
/vault/.travis.yml | 由Travis CI用於測試（不需要為正確經營腳本）。
/vault/cli.php | CLI處理文件。
/vault/components.dat | 包含的相關信息關於phpMussel的各種組件；它使用通過更新功能從前端。
/vault/config.ini.RenameMe | 配置文件；包含所有配置指令為phpMussel，​告訴它什麼做和怎麼正確地經營（重命名為激活）。
/vault/config.php | 配置處理文件。
/vault/config.yaml | 配置默認文件；包含phpMussel的默認配置值。
/vault/frontend.php | 前端處理文件。
/vault/frontend_functions.php | 前端功能處理文件。
/vault/functions.php | 功能處理文件（必不可少）。
/vault/greylist.csv | 灰名單簽名CSV（逗號分隔變量）文件說明為phpMussel什麼簽名它應該忽略（文件自動重新創建如果刪除）。
/vault/lang.php | 語音數據。
/vault/php5.4.x.php | Polyfill對於PHP 5.4.X （PHP 5.4.X 向下兼容需要它；​較新的版本可以刪除它）。
※ /vault/scan_kills.txt | 記錄的所有上傳文件phpMussel受阻/殺。
※ /vault/scan_log.txt | 記錄的一切phpMussel掃描。
※ /vault/scan_log_serialized.txt | 記錄的一切phpMussel掃描。
/vault/template_custom.html | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/template_default.html | 模板文件；模板為HTML產量產生通過phpMussel為它的受阻文件上傳信息（信息可見向上傳者）。
/vault/themes.dat | 主題文件；它使用通過更新功能從前端。
/vault/upload.php | 上傳處理文件。
/.gitattributes | GitHub文件（不需要為正確經營腳本）。
/.gitignore | GitHub文件（不需要為正確經營腳本）。
/Changelog-v1.txt | 記錄的變化做出至腳本間不同版本（不需要為正確經營腳本）。
/composer.json | Composer/Packagist 信息（不需要為正確經營腳本）。
/CONTRIBUTING.md | 相關信息如何有助於該項目。
/LICENSE.txt | GNU/GPLv2 執照文件（不需要為正確經營腳本）。
/loader.php | 加載文件。​這個是文件您應該【鉤子】（必不可少）!
/PEOPLE.md | 人民捲入到該項目。
/README.md | 項目概要信息。
/web.config | 一個ASP.NET配置文件（在這種情況，​以保護`/vault`文件夾從被訪問由非授權來源在事件的腳本是安裝在服務器根據ASP.NET技術）。

※ 文件名可能不同基於配置規定（在`config.ini`）。

---


### 7. <a name="SECTION7"></a>配置選項
下列是一個列表的變量發現在`config.ini`配置文件的phpMussel，​以及一個說明的他們的目的和功能。

#### 『general』 （類別）
基本phpMussel配置。

『cleanup』
-【反設置/刪除/清潔】腳本變量和緩存【Cache】之後執行嗎？​如果您不使用腳本外初始上傳掃描，​應該設置True【真/正】，​為了最小化內存使用。​如果您使用腳本為目的外初始上傳掃描，​應該設置False【假/負】，​為了避免不必要重新加載複製數據在內存。​在一般的做法，​它應該設置True【真/正】，​但，​如果您做這樣，​您將不能夠使用腳本為任何目的以外文件上傳掃描。
- 無影響在CLI模式。

『scan_log』
- 文件為記錄在所有掃描結果。​指定一個文件名，​或留空以關閉。

『scan_log_serialized』
- 文件為記錄在所有掃描結果（它採用序列化格式）。​指定一個文件名，​或留空以關閉。

『scan_kills』
- 文件為記錄在所有受阻或已殺上傳。​指定一個文件名，​或留空以關閉。

*有用的建議：如果您想，​可以追加日期/時間信息至附加到你的日誌文件的名稱通過包括這些中的名稱：`{yyyy}` 為今年完整，​`{yy}` 為今年縮寫，​`{mm}` 為今月，​`{dd}` 為今日，​`{hh}` 為今小時。​*

*例子：*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

『truncate』
- 截斷日誌文件當他們達到一定的大小嗎？​值是在B/KB/MB/GB/TB，​是日誌文件允許的最大大小直到它被截斷。​默認值為『0KB』將禁用截斷（日誌文件可以無限成長）。​注意：適用於單個日誌文件！​日誌文件大小不被算集體的。

『log_rotation_limit』
- 日誌輪轉限制了任何時候應該存在的日誌文件的數量。​當新的日誌文件被創建時，如果日誌文件的指定的最大數量已經超過，將執行指定的操作。​您可以在此指定所需的限制。​值為『0』將禁用日誌輪轉。

『log_rotation_action』
- 日誌輪轉限制了任何時候應該存在的日誌文件的數量。​當新的日誌文件被創建時，如果日誌文件的指定的最大數量已經超過，將執行指定的操作。​您可以在此處指定所需的操作。​『Delete』=刪除最舊的日誌文件，直到不再超出限制。​『Archive』=首先歸檔，然後刪除最舊的日誌文件，直到不再超出限制。

*技術澄清：在這種情況下，『最舊』意味著『不是最近被修改』。*

『timeOffset』
- 如果您的服務器時間不符合您的本地時間，​您可以在這裡指定的偏移調整日期/時間信息該產生通過phpMussel根據您的需要。​它一般建議，​而不是，​調整時區指令的文件`php.ini`，​但是有時（例如，​當利用有限的共享主機提供商）這並不總是可能做到，​所以，​此選項在這裡是提供。​偏移量是在分鐘。
- 例子（添加1小時）：`timeOffset=60`

『timeFormat』
- phpMussel使用的日期符號格式。​標準 = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`。

『ipaddr』
- 在哪裡可以找到連接請求IP地址？​（可以使用為服務例如Cloudflare和類似）標準是`REMOTE_ADDR`。​警告！​不要修改此除非您知道什麼您做著！

『enable_plugins』
- 啟用phpMussel插件支持嗎？​False（假）=不要啟用；​True（真）=要啟用【標準】。

『forbid_on_block』
- phpMussel應該發送`403`頭隨著文件上傳受阻信息，​或堅持標準`200 OK`？​False（假）=發送`200`；​True（真）=發送`403`【標準】。

『delete_on_sight』
- 激活的這個指令將指示腳本馬上刪除任何掃描文件上傳匹配任何檢測標準，​是否通過簽名或任何事其他。​文件已確定是清潔將會忽略。​如果是存檔，​全存檔將會刪除，​不管如果違規文件是只有一個的幾個文件包含在存檔。​為文件上傳掃描，​按說，​它不必要為您激活這個指令，​因為按說，​PHP將自動清洗內容的它的緩存當執行是完，​意思它將按說刪除任何文件上傳從它向服務器如果不已移動，​複製或刪除。​這個指令是添加這里為額外安全為任何人誰的PHP副本可能不始終表現在預期方式。​False【假/負】：之後掃描，​忽略文件【標準】，​True【真/正】：之後掃描，​如果不清潔，​馬上刪除。

『lang』
- 指定標準phpMussel語言。

『numbers』
- 指定如何顯示數字。

『quarantine_key』
- phpMussel可以檢疫壞文件上傳在隔離在phpMussel的安全/保險庫【Vault】，​如果這個是某物您想。​普通用戶的phpMussel簡單地想保護他們的網站或宿主環境無任何興趣在深深分析任何嘗試文件上傳應該離開這個功能關閉，​但任何用戶有興趣在更深分析的嘗試文件上傳為目的惡意軟件研究或為類似這樣事情應該激活這個功能。​檢疫的嘗試文件上傳可以有時還助攻在調試假陽性，​如果這個是某物經常發生為您。​以關閉檢疫功能，​簡單地離開`quarantine_key`指令空白，​或抹去內容的這個指令如果它不已空白。​以激活隔離功能，​輸入一些值在這個指令。​`quarantine_key`是一個重要安全功能的隔離功能需要以預防檢疫功能從成為利用通過潛在攻擊者和以預防任何潛在執行的數據存儲在檢疫。​`quarantine_key`應該被處理在同樣方法作為您的密碼：更長是更好，​和緊緊保護它。​為獲得最佳效果，​在結合使用`delete_on_sight`。

『quarantine_max_filesize』
- 最大允許文件大小為文件在檢疫。​文件大於這個指定數值將不成為檢疫。​這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。​標準=2MB。

『quarantine_max_usage』
- 最大內存使用允許為檢疫。​如果總內存已用通過隔離到達這個數值，​最老檢疫文件將會刪除直到總內存已用不再到達這個數值。​這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。​數值是在KB。​標準=64MB。

『honeypot_mode』
- 當這個指令（蜜罐模式）是激活，​phpMussel將嘗試檢疫所有文件上傳它遇到，​無論的如果文件上傳是匹配任何包括簽名，​和沒有掃描或分析的那些文件上傳將發生。​這個功能應有用為那些想使用的phpMussel為目的病毒或惡意軟件研究，​但它是不推薦激活這個功能如果預期的用的phpMussel通過用戶是為標準文件上傳掃描，​也不推薦使用蜜罐功能為目的以外蜜罐。​作為標準，​這個指令是關閉。​False（假）=是關閉【標準】；​True（真）=是激活。

『scan_cache_expiry』
- 多長時間應該phpMussel維持掃描結果？​數值是秒數為維持掃描結果。​標準是21600秒（6小時）；​一個`0`數值將停止維持掃描結果。

『disable_cli』
- 關閉CLI模式嗎？​CLI模式是按說激活作為標準，​但可以有時干擾某些測試工具（例如PHPUnit，​為例子）和其他基於CLI應用。​如果您沒有需要關閉CLI模式，​您應該忽略這個指令。​False（假）=激活CLI模式【標準】；​True（真）=關閉CLI模式。

『disable_frontend』
- 關閉前端訪問嗎？​前端訪問可以使phpMussel更易於管理，​但也可能是潛在的安全風險。​建議管理phpMussel通過後端只要有可能，​但前端訪問提供當不可能。​保持關閉除非您需要它。​False（假）=激活前端訪問；​True（真）=關閉前端訪問【標準】。

『max_login_attempts』
- 最大登錄嘗試次數（前端）。​標準=5。

『FrontEndLog』
- 前端登錄嘗試的錄音文件。​指定一個文件名，​或留空以禁用。

『disable_webfonts』
- 關閉網絡字體嗎？​True（真）=關閉【標準】；False（假）=不關閉。

『maintenance_mode』
- 啟用維護模式？​True（真）=關閉；​False（假）=不關閉【標準】。​它停用一切以外前端。​有時候在更新CMS，框架，等時有用。

『default_algo』
- 定義要用於所有未來密碼和會話的算法。​選項：​PASSWORD_DEFAULT（標準），​PASSWORD_BCRYPT，​PASSWORD_ARGON2I（需要PHP >= 7.2.0）。

『statistics』
- 跟踪phpMussel使用情況統計？​True（真）=跟踪；False（假）=不跟踪【標準】。

『allow_symlinks』
- 有時，phpMussel無法直接訪問以特定名稱的文件。​通過符號鏈接間接訪問文件有時可以解決此問題。​但是，這並不總是一個可行的解決方案，因為在某些系統上，使用符號鏈接可能是被禁止的，或者可能需要管理權限。​該指令確定是否phpMussel應嘗試間接使用符號鏈接來訪問文件，當直接訪問它們是不可能的。​True（真）=啟用符號鏈接；False（假）=禁用符號鏈接【標準】。

#### 『signatures』 （類別）
簽名配置。

『Active』
- 活性簽名文件的列表，​以逗號分隔。

『fail_silently』
- phpMussel應該報告當簽名文件是失踪或損壞嗎？​如果`fail_silently`是關閉，​失踪和損壞文件將會報告當掃描，​和如果`fail_silently`是激活，​失踪和損壞文件將會忽略，​有掃描報告為那些文件哪裡沒有問題。​這個應該按說被留下除非您遇到失敗或有其他類似問題。​False（假）=是關閉；​True（真）=是激活【默認】。

『fail_extensions_silently』
- phpMussel應該報告當擴展是失踪嗎？​如果`fail_extensions_silently`是關閉，​失踪擴展將會報告當掃描，​和如果`fail_extensions_silently`是激活，​失踪擴展將會忽略，​有掃描報告為那些文件哪裡沒有任何問題。​關閉的這個指令可能的可以增加您的安全，​但可能還導致一個增加的假陽性。​False（假）=是關閉；​True（真）=是激活【默認】。

『detect_adware』
- phpMussel應該使用簽名為廣告軟件檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_encryption』
- phpMussel應該檢測並阻止加密的文件嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_joke_hoax』
- phpMussel應該使用簽名為病毒/惡意軟件笑話/惡作劇檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_pua_pup』
- phpMussel應該使用簽名為PUP/PUA（可能無用/非通緝程序/軟件）檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_packer_packed』
- phpMussel應該使用簽名為打包機和打包數據檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_shell』
- phpMussel應該使用簽名為webshell腳本檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

『detect_deface』
- phpMussel應該使用簽名為污損的污損軟件檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。

#### 『files』 （類別）
文件處理配置。

『max_uploads』
- 最大允許數值的文件為掃描當文件上傳掃描之前中止掃描和告訴用戶他們是上傳太多在同一時間！​提供保護針對一個理論攻擊哪裡一個攻擊者嘗試DDoS您的系統或CMS通過超載phpMussel以減速PHP進程到一個停止。​推薦：10。​您可能想增加或減少這個數值，​根據速度的您的硬件。​注意這個數值不交待為或包括存檔內容。

『filesize_limit』
- 文件大小限在KB。​65536=64MB【默認】，​0=沒有限（始終灰名單），​任何正數值接受。​這個可以有用當您的PHP配置限內存量一個進程可以佔據或如果您的PHP配置限文件大小的上傳。

『filesize_response』
- 如何處理文件超過文件大小限（如果存在）。​False（假）=白名單；​True（真）=黑名單【默認】。

『filetype_whitelist』, 『filetype_blacklist』, 『filetype_greylist』
- 如果您的系統只允許具體文件類型被上傳，​或如果您的系統明確地否認某些文件類型，​指定那些文件類型在白名單，​黑名單和灰名單可以增加掃描執行速度通過允許腳本跳過某些文件類型。​格式是CSV（逗號分隔變量）。​如果您想掃描一切，​而不是白名單，​黑名單或灰名單，​留變量空；這樣做將關閉白名單/黑名單/灰名單。
- 進程邏輯順序是：
  - 如果文件類型已白名單，​不掃描和不受阻文件，​和不匹配文件對照黑名單或灰名單。
  - 如果文件類型已黑名單，​不掃描文件但阻止它無論如何，​和不匹配文件對照灰名單。
  - 如果灰名單是空，​或如果灰名單不空和文件類型已灰名單，​掃描文件像正常和確定如果阻止它基於掃描結果，​但如果灰名單不空和文件類型不灰名單，​過程文件彷彿已黑名單，​因此不掃描它但阻止它無論如何。

『check_archives』
- 嘗試匹配存檔內容嗎？​False（假）=不匹配；​True（真）=匹配【默認】。
- 目前，​只BZ/BZIP2，​GZ/GZIP，​LZF，​PHAR，​TAR和ZIP文件格式是支持（匹配的RAR，​CAB，​7z和等等不還支持）。
- 這個是不完美！​雖說我很推薦保持這個激活，​我不能保證它將始終發現一切。
- 還，​請注意存檔匹配目前是不遞歸為PHAR或ZIP格式。

『filesize_archives』
- 繼承文件大小黑名單/白名單在存檔內容嗎？​False（假）=不繼承（剛灰名單一切）；​True（真）=繼承【默認】。

『filetype_archives』
- 繼承文件類型黑名單/白名單在存檔內容嗎？​False（假）=不繼承（剛灰名單一切）；​True（真）=繼承【默認】。

『max_recursion』
- 最大存檔遞歸深度限。​默認=10。

『block_encrypted_archives』
- 檢測和受阻加密的存檔嗎？​因為phpMussel是不能夠掃描加密的存檔內容，​它是可能存檔加密可能的可以使用通過一個攻擊者作為一種手段嘗試繞過phpMussel，​殺毒掃描儀和其他這樣的保護。​指示phpMussel受阻任何存檔它發現被加密可能的可以幫助減少任何風險有關聯這些可能性。​False（假）=不受阻；​True（真）=受阻【默認】。

#### 『attack_specific』 （類別）
專用攻擊指令。

蜴攻擊檢測：False（假）=是關閉；​True（真）=是激活。

『chameleon_from_php』
- 尋找PHP頭在文件是不PHP文件也不認可存檔文件。

『chameleon_from_exe』
- 尋找可執行頭在文件是不可執行文件也不認可存檔文件和尋找可執行文件誰的頭是不正確。

『chameleon_to_archive』
- 尋找存檔文件誰的頭是不正確（已支持：BZ，​GZ，​RAR，​ZIP，​GZ）。

『chameleon_to_doc』
- 尋找辦公文檔誰的頭是不正確（已支持：DOC，​DOT，​PPS，​PPT，​XLA，​XLS，​WIZ）。

『chameleon_to_img』
- 尋找圖像誰的頭是不正確（已支持：BMP，​DIB，​PNG，​GIF，​JPEG，​JPG，​XCF，​PSD，​PDD，​WEBP）。

『chameleon_to_pdf』
- 尋找PDF文件誰的頭是不正確。

『archive_file_extensions』
- 認可存檔文件擴展（格式是CSV；應該只添加或去掉當問題發生；不必要的去掉可能的可以導致假陽性出現為存檔文件，​而不必要的增加將實質上白名單任何事您增加從專用攻擊檢測；修改有慎重；還請注這個無影響在什麼存檔可以和不能被分析在內容級）。​這個名單，​作為是作為標準，​名單那些格式使用最常見的橫過多數的系統和CMS，​但有意是不全面。

『block_control_characters』
- 受阻任何文件包含任何控製字符嗎（以外換行符）？​(`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) 如果您只上傳純文本，​您可以激活這個指令以提供某些另外保護在您的系統。​然而，​如果您上傳任何事以外純文本，​激活這個可能結果在假陽性。​False（假）=不受阻【默認】；​True（真）=受阻。

『corrupted_exe』
- 損壞文件和處理錯誤。​False（假）=忽略；​True（真）=受阻【默認】。​檢測和受阻潛在的損壞移植可執行【PE】文件嗎？​時常（但不始終），​當某些零件的一個移植可執行【PE】文件是損壞或不能被正確處理，​它可以建議建議的一個病毒感染。​過程使用通過最殺毒程序以檢測病毒在PE文件需要處理那些文件在某些方式，​哪裡，​如果程序員的一個病毒是意識的，​將特別嘗試防止，​以允許他們的病毒留不檢測。

『decode_threshold』
- 在原始數據中解碼命令的長度限制（如果有任何引人注目性能問題當掃描）。​默認=512KB。​零或空值將關閉門檻（去除任何這樣的限基於文件大小）。

『scannable_threshold』
- 原始數據讀取和掃描的最大長度（如果有任何引人注目性能問題當掃描）。​默認=32MB。​零或空值將關閉門檻。​按說，​這個數值應不會少於平均文件大小的文件上傳您想和期待收到您的服務器或網站，​應不會多於`filesize_limit`指令，​和應不會多於大致五分之一的總允許內存分配獲授PHP通過`php.ini`配置文件。​這個指令存在為嘗試防止phpMussel從用的太多內存（這個將防止它從能夠順利掃描文件以上的一個特別文件大小）。

#### 『compatibility』 （類別）
phpMussel兼容性指令。

『ignore_upload_errors』
- 這個指令按說應會關閉除非它是需要為對功能的phpMussel在您的具體系統。​按說，​當是關閉，​當phpMussel檢測存在元素在`$_FILES`數組，​它將嘗試引發一個掃描的文件代表通過那些元素，​和，​如果他們是空或空白，​phpMussel將回報一個錯誤信息。​這個是正確行為為phpMussel。​然而，​為某些CMS，​空元素在`$_FILES`可以發生因之的自然的行為的那些CMS，​或錯誤可能會報告當沒有任何，​在這種情況，​正常行為為phpMussel將會使乾擾為正常行為的那些CMS。​如果這樣的一個情況發生為您，​激活這個指令將指示phpMussel不嘗試引發掃描為這樣的空元素，​忽略他們當發現和不回報任何關聯錯誤信息，​從而允許延續的頁面請求。​False（假）=不忽略；​True（真）=忽略。

『only_allow_images』
- 如果您只期待或只意味到允許圖像被上傳在您的系統或CMS，​和如果您絕對不需要任何文件以外圖像被上傳在您的系統或CMS，​這個指令應會激活，​但其他應會關閉。​如果這個指令是激活，​它將指示phpMussel受阻而不例外任何上傳確定為非圖像文件，​而不掃描他們。​這個可能減少處理時間和內存使用為非圖像文件上傳嘗試。​False（假）=還允許其他文件；​True（真）=只允許圖像文件。

#### 『heuristic』 （類別）
啟發式指令。

『threshold』
- 有某些簽名的phpMussel意味為確定可疑和可能惡意文件零件被上傳有不在他們自己確定那些文件被上傳特別是作為惡意。​這個『threshold』數值告訴phpMussel什麼是最大總重量的可疑和潛在惡意文件零件被上傳允許之前那些文件是被識別作為惡意。​定義的重量在這個上下文是總數值的可疑和可能惡意文件零件確定。​作為默認，​這個數值將會設置作為3。​一個較低的值通常將結果在一個更高的發生的假陽性但一個更高的發生的惡意文件被確定，​而一個更高的數值將通常結果在一個較低的發生的假陽性但一個較低的數值的惡意文件被確定。​它是通常最好忽略這個數值除非您遇到關聯問題。

#### 『virustotal』 （類別）
VirusTotal.com指令。

『vt_public_api_key』
- 可選的，​phpMussel可以掃描文件使用【Virus Total API】作為一個方法提供一個顯著的改善保護級別針對病毒，​木馬，​惡意軟件和其他威脅。​作為默認，​掃描文件使用【Virus Total API】是關閉。​以激活它，​一個API密鑰從Virus Total是需要。​因為的顯著好處這個可以提供為您，​它是某物我很推薦激活。​請注意，​然而，​以使用的【Virus Total API】，​您必須同意他們的服務條款和您必須堅持所有方針按照說明通過Virus Total閱讀材料！​您是不允許使用這個積分功能除非：
  - 您已閱讀和您同意服務條款的Virus Total和它的API。​服務條款的Virus Total和它的API可以發現[這裡](https://www.virustotal.com/en/about/terms-of-service/)。
  - 您已閱讀和您了解至少序言的Virus Total公共API閱讀材料(一切之後『VirusTotal Public API v2.0』但之前『Contents』）。​Virus Total公共API閱讀材料可以發現[這裡](https://www.virustotal.com/en/documentation/public-api/)。

請注意：如果掃描文件使用【Virus Total API】是關閉，​您不需要修改任何指令在這個類別（`virustotal`），​因為沒有人將做任何事如果這個是關閉。​以獲得一個Virus Total API密鑰，​從隨地在他們的網站，​點擊『進入我們的社區』連接位於朝向右上方的頁面，​輸入在信息請求，​和點擊『註冊』在做完。​跟隨所有指令提供，​和當您有您的公共API密鑰，​複製/粘貼您的公共API密鑰到`vt_public_api_key`指令的`config.ini`配置文件。

『vt_suspicion_level』
- 作為標準，​phpMussel將限制什麼文件它掃描通過使用【Virus Total API】為那些文件它考慮作為『可疑』。​您可以可選調整這個局限性通過修改的`vt_suspicion_level`指令數值。
- `0`:文件是只考慮可疑如果，​當被掃描通過phpMussel使用它自己的簽名，​他們是認為有一個啟發式重量。​這個將有效意味使用的【Virus Total API】將會為一個第二個意見為當phpMussel懷疑一個文件可能的是惡意，​但不能完全排除它可能還可能的被良性（非惡意）和因此將否則按說不受阻它或標誌它作為被惡意。
- `1`:文件是考慮可疑如果，​當被掃描通過phpMussel使用它自己的簽名，​他們是認為有一個啟發式重量，​如果他們是已知被可執行（PE文件，​Mach-O文件，​ELF/Linux文件，​等等），​或如果他們是已知被的一個格式潛在的包含可執行數據（例如可執行宏，​DOC/DOCX文件，​存檔文件例如RAR格式，​ZIP格式和等等）。​這個是標準和推薦可疑級別到使用，​有效意味使用的【Virus Total API】將會為一個第二個意見為當phpMussel不原來發現任何事惡意或錯在一個文件它考慮被可疑和因此將否則按說不受阻它或標誌它作為被惡意。
- `2`:所有文件是考慮可疑和應會掃描使用【Virus Total API】。​我通常不推薦應用這個可疑級別，​因為風險的到達您的API配額更快，​但存在某些情況（例如當網站管理員或主機管理員有很少信仰或信任在任何的內容上傳從他們的用戶）哪裡這個可疑級別可以被適當。​有使用的這個可疑級別，​所有文件不按說受阻或標誌是作為被惡意將會掃描使用【Virus Total API】。​請注意，​然而，​phpMussel將停止使用【Virus Total API】當您的API配額是到達（無論的可疑級別），​和您的配額將會容易更快當使用這個可疑級別。

請注意：無論的可疑級別，​任何文件任一已黑名單或已白名單通過phpMussel不會掃描使用【Virus Total API】，​因為那些文件將會已標誌作為惡意或良性通過phpMussel到的時候他們將會否則掃描通過【Virus Total API】，​和因此，​另外掃描不會需要。​能力的phpMussel掃描文件使用【Virus Total API】是意味為建更置信為如果一個文件是惡意或良性在那些情況哪裡phpMussel是不完全確定如果一個文件是惡意或良性。

『vt_weighting』
- phpMussel應使用掃描結果使用【Virus Total API】作為檢測或作為檢測重量嗎？​這個指令存在，​因為，​雖說掃描一個文件使用多AV引擎（例如怎麼樣Virus Total做） 應結果有一個增加檢測率（和因此在一個更惡意文件被抓），​它可以還結果有更假陽性，​和因此，​為某些情況，​掃描結果可能被更好使用作為一個置信得分而不是作為一個明確結論。​如果一個數值的`0`是使用，​掃描結果使用【Virus Total API】將會適用作為檢測，​和因此，​如果任何AV引擎使用通過Virus Total標致文件被掃描作為惡意，​phpMussel將考慮文件作為惡意。​如果任何其他數值是使用，​掃描結果使用【Virus Total API】將會適用作為檢測重量，​和因此，​數的AV引擎使用通過Virus Total標致文件被掃描作為惡意將服務作為一個置信得分（或檢測重量） 為如果文件被掃描應會考慮惡意通過phpMussel（數值使用將代表最低限度的置信得分或重量需要以被考慮惡意）。​一個數值的`0`是使用作為標準。

『vt_quota_rate』和『vt_quota_time』
- 根據【Virus Total API】閱讀材料，​它是限於最大的`4`請求的任何類型在任何`1`分鐘大致時間。​如果您經營一個『honeyclient』，​蜜罐或任何其他自動化將會提供資源為Virus Total和不只取回報告您是有權一個更高請求率配額。​作為標準，​phpMussel將嚴格的堅持這些限制，​但因為可能性的這些率配額被增加，​這些二指令是提供為您指示phpMussel為什麼限它應堅持。​除非您是指示這樣做，​它是不推薦為您增加這些數值，​但，​如果您遇到問題相關的到達您的率配額，​減少這些數值可能有時幫助您解析這些問題。​您的率限是決定作為`vt_quota_rate`請求的任何類型在任何`vt_quota_time`分鐘大致時間。

#### 『urlscanner』 （類別）
phpMussel包含URL掃描程序，​能夠檢測惡意URL在任何數據或文件它掃描。

請注意：如果URL掃描儀已關閉，​您將不需要復習任何指令在這個類別（`urlscanner`），​因為沒有指令會做任何事如果這個已關閉。

URL掃描儀API配置。

『lookup_hphosts』
- 激活[hpHosts](http://hosts-file.net/) API當設置`true`。​hpHosts不需要API密鑰為了執行API請求。

『google_api_key』
- 激活Google Safe Browsing API當API密鑰是設置。​Google Safe Browsing API需要API密鑰，​可以得到從[這裡](https://console.developers.google.com/)。
- 請注意：cURL擴展是必須的為了使用此功能。

『maximum_api_lookups』
- 最大數值API請求來執行每個掃描迭代。​額外API請求將增加的總要求完成時間每掃描迭代，​所以，​您可能想來規定一個限以加快全掃描過程。​當設置`0`，​沒有最大數值將會應用的。​設置`10`作為默認。

『maximum_api_lookups_response』
- 該什麼辦如果最大數值API請求已超過？​False（假）=沒做任何事（繼續處理）【默認】；​True（真）=標誌/受阻文件。

『cache_time』
- 多長時間（以秒為單位）應API結果被緩存？​默認是3600秒（1小時）。

#### 『legal』 （類別）
有關法律義務的配置。

*請參閱文檔的『[法律信息](#SECTION11)』章節以獲取更多有關法律義務的信息，以及它可以如何影響您的配置義務。*

『pseudonymise_ip_addresses』
- 編寫日誌文件時使用假名的IP地址嗎？​True（真）=使用假名；False（假）=不使用假名【標準】。

『privacy_policy』
- 要顯示在任何生成的頁面的頁腳中的相關隱私政策的地址。​指定一個URL，或留空以禁用。

#### 『template_data』 （類別）
指令和變量為模板和主題。

模板數據涉及到HTML產量使用以生成『上傳是否認』信息顯示為用戶當一個文件上傳是受阻。​如果您使用個性化主題為phpMussel，​HTML產量資源是從`template_custom.html`文件，​和否則，​HTML產量資源是從`template.html`文件。​變量書面在這個配置文件部分是餵在HTML產量通過更換任何變量名包圍在大括號發現在HTML產量使用相應變量數據。​為例子，​哪里`foo="bar"`，​任何發生的`<p>{foo}</p>`發現在HTML產量將成為`<p>bar</p>`。

『theme』
- 用於phpMussel的默認主題。

『Magnification』
- 字體放大。​標準 = 1。

『css_url』
- 模板文件為個性化主題使用外部CSS屬性，​而模板文件為t標準主題使用內部CSS屬性。​以指示phpMussel使用模板文件為個性化主題，​指定公共HTTP地址的您的個性化主題的CSS文件使用`css_url`變量。​如果您離開這個變量空白，​phpMussel將使用模板文件為默認主題。

---


### 8. <a name="SECTION8"></a>簽名格式

*也可以看看：*
- *[什麼是『簽名』？](#WHAT_IS_A_SIGNATURE)*

phpMussel簽名文件前9個字節（`[x0-x8]`）是`phpMussel`。​它作為一個『魔術數字』【magic number】，將其標識為簽名文件（這有助於防止phpMussel意外地嘗試使用文件不是簽名文件）。​下一個字節`[x9]`標識簽名文件的類型。​這一點必須知道以便能夠正確解釋簽名文件。​以下類型的簽名文件被認可：

類型 | 字節 | 說明
---|---|---
`General_Command_Detections` | `0?` | 為CSV（逗號分隔值）簽名文件。​值（簽名）是在文件中查找的十六進制編碼字符串。​這裡的簽名沒有任何名稱或其他詳細信息（只有要檢測的字符串）。
`Filename` | `1?` | 為文件名簽名。
`Hash` | `2?` | 為哈希簽名。
`Standard` | `3?` | 為與文件內容直接工作的簽名文件。
`Standard_RegEx` | `4?` | 為與文件內容直接工作的簽名文件。​簽名可以包含正則表達式。
`Normalised` | `5?` | 為用於ANSI標準化文件內容的簽名文件。
`Normalised_RegEx` | `6?` | 為用於ANSI標準化文件內容的簽名文件。​簽名可以包含正則表達式。
`HTML` | `7?` | 為用於HTML標準化文件內容的簽名文件。
`HTML_RegEx` | `8?` | 為用於HTML標準化文件內容的簽名文件。​簽名可以包含正則表達式。
`PE_Extended` | `9?` | 為使用PE元數據的簽名文件（但不PE部分元數據）。
`PE_Sectional` | `A?` | 為使用PE部分元數據的簽名文件。
`Complex_Extended` | `B?` | 為使用各種規則的簽名文件，基於由phpMussel生成的擴展元數據。
`URL_Scanner` | `C?` | 為使用URL的簽名文件。

下一個字節`[x10]`是一個換行符`[0A]`，並結束phpMussel簽名文件頭。

之後的每個非空行都是簽名或規則。​每個簽名或規則佔用一行。​支持的簽名格式如下所述。

#### *文件名簽名*
所有文件名簽名跟隨格式：

`NAME:FNRX`

`NAME`是名援引為簽名和`FNRX`是正則表達式匹配文件名（未編碼）為。

#### *哈希簽名*
所有哈希簽名跟隨格式：

`HASH:FILESIZE:NAME`

`HASH`是全文件的哈希（通常是MD5），​`FILESIZE`是總文件大小和`NAME`是名援引為簽名。

#### *移植可執行【PE】部分簽名*
所有移植可執行【PE】部分簽名跟隨格式：

`SIZE:HASH:NAME`

`HASH`是一個MD5哈希的一個部分的一個移植可執行【PE】文件，​`SIZE`是總大小的該部分和`NAME`是名援引為簽名。

#### *移植可執行【PE】擴展簽名*
所有移植可執行【PE】擴展簽名跟隨格式：

`$VAR:HASH:SIZE:NAME`

`$VAR`是移植可執行【PE】變量名匹配為，​`HASH`是一個MD5哈希的該變量，​`SIZE`是總大小的該變量和`NAME`是名援引為簽名。

#### *複雜擴展簽名*
複雜擴展簽名是寧不同從其他可能phpMussel簽名類型，​在某種意義上說，​什麼他們匹配針對是指定通過這些簽名他們自己和他們可以匹配針對多重標準。​多重標準是分隔通過【;】和匹配類型和匹配數據的每多重標準是分隔通過【:】以確保格式為這些簽名往往看起來有點像：

`$變量1:某些數據;$變量2:某些數據;簽名等等`

#### *一切其他*
所有其他簽名跟隨格式：

`NAME:HEX:FROM:TO`

`NAME`是名援引為簽名和`HEX`是一個十六進制編碼分割的文件意味被匹配通過有關簽名。​`FROM`和`TO`是可選參數，​說明從哪里和向哪裡在源數據匹配針對。

#### *正則表達式/REGEX*
任何形式的正則表達式了解和正確地處理通過PHP應還會正確地了解和處理通過phpMussel和它的簽名。​然而，​我將建議採取極端謹慎當寫作新正則表達式為基礎的簽名，​因為，​如果您不完全肯定什麼您被做，​可以有很不規則和/或意外結果。​看一眼的phpMussel源代碼如果您不完全肯定的上下文其中正則表達式語句被處理。​還，​記得，​所有語句（除外為文件名，​存檔元數據和MD5語句）必須是十六進制編碼（和除外為語句句法，​還，​當然）！

---


### 9. <a name="SECTION9"></a>已知的兼容問題

#### PHP和PCRE
- phpMussel需要PHP和PCRE以正確地執行和功能。​如果沒有PHP，​或如果沒有PCRE擴展的PHP，​phpMussel不會正確地執行和功能。​應該確保您的系統有PHP和PCRE安裝和可用之前下載和安裝phpMussel。

#### 殺毒軟件兼容性

在大多數情況下，​phpMussel應該相當兼容性與大多數殺毒軟件。​然，​衝突已經報導由多個用戶以往。​下面這些信息是從VirusTotal.com，​和它描述了一個數的假陽性報告的各種殺毒軟件針對phpMussel。​雖說這個信息是不絕對保證的如果您會遇到兼容性問題間phpMussel和您的殺毒軟件，​如果您的殺毒軟件注意衝突針對phpMussel，​您應該考慮關閉它之前使用phpMussel或您應該考慮替代選項從您的殺毒軟件或從phpMussel。

這個信息最後更新2017年12月1日和是準確為至少phpMussel的兩個最近次要版本（v1.0.0-v1.1.0）在這個現在時候的寫作。

*此信息僅適用於主包裝。​結果可能因安裝的簽名文件，插件，和其他外圍組件而異。*

| 掃描器 | 結果 |
|---|---|
| AVware | 報告 『BPX.Shell.PHP』 |
| Bkav | 報告 『VEXA3F5.Webshell』 |

---


### 10. <a name="SECTION10"></a>常見問題（FAQ）

- [什麼是『簽名』？](#WHAT_IS_A_SIGNATURE)
- [什麼是『假陽性』？](#WHAT_IS_A_FALSE_POSITIVE)
- [什麼是簽名更新頻率？](#SIGNATURE_UPDATE_FREQUENCY)
- [我在使用phpMussel時遇到問題和我不知道該怎麼辦！​請幫忙！](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [我想使用phpMussel與早於5.4.0的PHP版本；​您能幫我嗎？](#MINIMUM_PHP_VERSION)
- [我可以使用單個phpMussel安裝來保護多個域嗎？](#PROTECT_MULTIPLE_DOMAINS)
- [我不想浪費時間安裝這個和確保它在我的網站上功能正常；我可以僱用您這樣做嗎？](#PAY_YOU_TO_DO_IT)
- [我可以聘請您或這個項目的任何開發者私人工作嗎？](#HIRE_FOR_PRIVATE_WORK)
- [我需要專家修改，​的定制，​等等；您能幫我嗎？](#SPECIALIST_MODIFICATIONS)
- [我是開發人員，​網站設計師，​或程序員。​我可以接受還是提供與這個項目有關的工作？](#ACCEPT_OR_OFFER_WORK)
- [我想為這個項目做出貢獻；我可以這樣做嗎？](#WANT_TO_CONTRIBUTE)
- [『ipaddr』的推薦值。](#RECOMMENDED_VALUES_FOR_IPADDR)
- [掃描時如何訪問文件的具體細節？](#SCAN_DEBUGGING)
- [可以使用cron自動更新嗎？](#CRON_TO_UPDATE_AUTOMATICALLY)
- [phpMussel可以掃描非ANSI名稱的文件嗎？](#SCAN_NON_ANSI)
- [黑名單 – 白名單 – 灰名單 – 他們是什麼，我如何使用它們？](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>什麼是『簽名』？

在phpMussel的上下文中，『簽名』是用於識別我們正在尋找的特定內容的數據，它通常採取一些非常小，不同，無害的一些更大和有害的東西的形式（例如，它可以識別病毒，木馬，等等）。​也可以是文件校驗和，哈希或其他類似的標識符。​通常包括一個標籤和一些其他數據，以幫助提供額外的上下文，可以由phpMussel使用它來確定遇到我們正在尋找的最佳方法。

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>什麼是『假陽性』？

術語『假陽性』（*或者：『假陽性錯誤』；『虛驚』*；英語：*false positive*； *false positive error*； *false alarm*），​很簡單地描述，​和在一個廣義上下文，​被用來當測試一個因子，​作為參考的測試結果，​當結果是陽性（即：因子被確定為『陽性』，​或『真』），​但預計將為（或者應該是）陰性（即：因子，​在現實中，​是『陰性』，​或『假』）。​一個『假陽性』可被認為是同樣的『哭狼』 (其中，​因子被測試是是否有狼靠近牛群，​因子是『假』由於該有沒有狼靠近牛群，​和因子是報告為『陽性』由牧羊人通過叫喊『狼，​狼』），​或類似在醫學檢測情況，​當患者被診斷有一些疾病，​當在現實中，​他們沒有疾病。

一些相關術語是『真陽性』，​『真陰性』和『假陰性』。​一個『真陽性』指的是當測試結果和真實因子狀態都是『真』（或『陽性』），​和一個『真陰性』指的是當測試結果和真實因子狀態都是『假』（或『陰性』）；一個『真陽性』或『真陰性』被認為是一個『正確的推理』。​對立面『假陽性』是一個『假陰性』；一個『假陰性』指的是當測試結果是『陰性』（即：因子被確定為『陰性』，​或『假』），​但預計將為（或者應該是）陽性（即：因子，​在現實中，​是『陽性』，​或『真』）。

在phpMussel的上下文，​這些術語指的是phpMussel的簽名和他們阻止的文件。​當phpMussel阻止一個文件由於惡劣的，​過時的，​或不正確的簽名，​但不應該這樣做，​或當它這樣做為錯誤的原因，​我們將此事件作為一個『假陽性』。​當phpMussel未能阻止文件該應該已被阻止，​由於不可預見的威脅，​缺少簽名或不足簽名，​我們將此事件作為一個『檢測錯過』（同樣的『假陰性』）。

這可以通過下表來概括：

&nbsp; | phpMussel不應該阻止文件 | phpMussel應該阻止文件
---|---|---
phpMussel不會阻止文件 | 真陰性（正確的推理） | 檢測錯過（同樣的『假陰性』）
phpMussel會阻止文件 | __假陽性__ | 真陽性（正確的推理）

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>什麼是簽名更新頻率？

更新頻率根據相關的簽名文件而有所不同。​所有的phpMussel簽名文件的維護者通常盡量保持他們的簽名為最新，​但是因為我們所有人都有各種其他承諾，​和因為我們的生活超越了項目，​和因為我們不得到經濟補償/付款為我們的項目的努力，​無法保證精確的更新時間表。​通常，​簽名被更新每當有足夠的時間，​和維護者嘗試根據必要性和根據范圍之間的變化頻率確定優先級。​幫助總是感謝，​如果你願意提供任何。

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>我在使用phpMussel時遇到問題和我不知道該怎麼辦！​請幫忙！

- 您使用軟件的最新版本嗎？​您使用簽名文件的最新版本嗎？​如果這兩個問題的答案是不，​嘗試首先更新一切，​然後檢查問題是否仍然存在。​如果它仍然存在，​繼續閱讀。
- 您檢查過所有的文檔嗎？​如果沒有做，​請這樣做。​如果文檔不能解決問題，​繼續閱讀。
- 您檢查過[issues頁面](https://github.com/phpMussel/phpMussel/issues)嗎？​檢查是否已經提到了問題。​如果已經提到了，​請檢查是否提供了任何建議，​想法或解決方案。​按照需要嘗試解決問題。
- 如果問題仍然存在，請通過在issues頁面上創建新issue尋求幫助。

#### <a name="MINIMUM_PHP_VERSION"></a>我想使用phpMussel與早於5.4.0的PHP版本；​您能幫我嗎？

不能。​PHP 5.4.0於2014年達到官方EoL（『生命終止』）。​延長的安全支持在2015年終止。​這時候目前，​它是2017年，​和PHP 7.1.0已經可用。​目前，​有支持使用phpMussel與PHP 5.4.0和所有可用的較新的PHP版本，​但不有支持使用phpMussel與任何以前的PHP版本。

*也可以看看：​[兼容性圖表](https://maikuolan.github.io/Compatibility-Charts/)。*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>我可以使用單個phpMussel安裝來保護多個域嗎？

可以。​phpMussel安裝未綁定到特定域，​因此可以用來保護多個域。​通常，​當phpMussel安裝保護只一個域，​我們稱之為『單域安裝』，​和當phpMussel安裝保護多個域和/或子域，​我們稱之為『多域安裝』。​如果您進行多域安裝並需要使用不同的簽名文件為不同的域，​或需要不同配置phpMussel為不同的域，​這可以做到。​加載配置文件後（`config.ini`），​phpMussel將尋找『配置覆蓋文件』特定於所請求的域（`xn--cjs74vvlieukn40a.tld.config.ini`），​並如果發現，​由配置覆蓋文件定義的任何配置值將用於執行實例而不是由配置文件定義的配置值。​配置覆蓋文件與配置文件相同，​並通過您的決定，​可能包含phpMussel可用的所有配置指令，​或任何必需的部分當需要。​配置覆蓋文件根據它們旨在的域來命名（所以，​例如，​如果您需要一個配置覆蓋文件為域，​`http://www.some-domain.tld/`，​它的配置覆蓋文件應該被命名`some-domain.tld.config.ini`，​和它應該放置在`vault`與配置文件，​`config.ini`）。​域名是從標題`HTTP_HOST`派生的；『www』被忽略。

#### <a name="PAY_YOU_TO_DO_IT"></a>我不想浪費時間安裝這個和確保它在我的網站上功能正常；我可以僱用您這樣做嗎？

也許。​這是根據具體情況考慮的。​告訴我們您需要什麼，​您提供什麼，​和我們會告訴您是否可以幫忙。

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>我可以聘請您或這個項目的任何開發者私人工作嗎？

*參考上面。​*

#### <a name="SPECIALIST_MODIFICATIONS"></a>我需要專家修改，​的定制，​等等；您能幫我嗎？

*參考上面。​*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>我是開發人員，​網站設計師，​或程序員。​我可以接受還是提供與這個項目有關的工作？

您可以。​我們的許可證並不禁止這一點。

#### <a name="WANT_TO_CONTRIBUTE"></a>我想為這個項目做出貢獻；我可以這樣做嗎？

您可以。​對項目的貢獻是歡迎。​有關詳細信息，​請參閱『CONTRIBUTING.md』。

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>『ipaddr』的推薦值。

值 | 運用
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula反向代理。
`HTTP_CF_CONNECTING_IP` | Cloudflare反向代理。
`CF-Connecting-IP` | Cloudflare反向代理（替代；如果另一個不工作）。
`HTTP_X_FORWARDED_FOR` | Cloudbric反向代理。
`X-Forwarded-For` | [Squid反向代理](http://www.squid-cache.org/Doc/config/forwarded_for/)。
*由服務器配置定義。​* | [Nginx反向代理](https://www.nginx.com/resources/admin-guide/reverse-proxy/)。
`REMOTE_ADDR` | 沒有反向代理（默認值）。

#### <a name="SCAN_DEBUGGING"></a>掃描時如何訪問文件的具體細節？

在啟動掃描之前，​請分配一個數組以用於此目的。

在下面的例子中，​`$Foo` 是分配以用於此目的。​掃描 `/文件/路徑/...` 後，​關於 `/文件/路徑/...` 所包含的文件的信息將包含在 `$Foo` 中。

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/文件/路徑/...');

var_dump($Foo);
```

數組是多維的。​元素表示掃描的每個文件。​子元素表示這些文件的詳細信息。​子要素如下：

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

*† - 在緩存結果中沒有提供 （僅在新的掃描結果中提供）。​*

*‡ - 僅在掃描PE文件時提供。​*

如果您想，​可以通過使用以下命令來破壞此數組：

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>可以使用cron自動更新嗎？

您可以。​前端有內置了API，外部腳本可以使用它與更新頁面進行交互。​一個單獨的腳本，『[Cronable](https://github.com/Maikuolan/Cronable)』，是可用，它可以由您的cron manager或cron scheduler程序使用於自動更新此和其他支持的包（此腳本提供自己的文檔）。

#### <a name="SCAN_NON_ANSI"></a>phpMussel可以掃描非ANSI名稱的文件嗎？

假設有一個您想掃描的目錄。​在這個目錄中，您有一些非ANSI名字的文件。
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

假設您使用CLI模式或phpMussel API進行掃描。

在某些系統上使用PHP < 7.1.0時，phpMussel在嘗試掃描目錄時不會看到這些文件，所以，將無法掃描這些文件。​您可能會看到與掃描空目錄相同的結果：

```
 Sun, 01 Apr 2018 22:27:41 +0800 開始。
 Sun, 01 Apr 2018 22:27:41 +0800 完了。
```

另外，當使用PHP < 7.1.0時，單獨掃描文件會產生如下結果：

```
 Sun, 01 Apr 2018 22:27:41 +0800 開始。
 > 檢查 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> 無效的文件！
 Sun, 01 Apr 2018 22:27:41 +0800 完了。
```

或者這些：

```
 Sun, 01 Apr 2018 22:27:41 +0800 開始。
 > X:/directory/??????.txt不是文件或文件夾。
 Sun, 01 Apr 2018 22:27:41 +0800 完了。
```

這是因為在PHP 7.1.0之前如何處理非ANSI文件名。​如果遇到此問題，解決方案是將PHP 7.1.0安裝更新到7或更新版本。​在PHP >= 7.1.0中，非ANSI文件名處理得更好，並且phpMussel應該能夠正確地掃描文件。

為了比較，嘗試使用PHP >= 7.1.0掃描目錄時的結果：

```
 Sun, 01 Apr 2018 22:27:41 +0800 開始。
 -> 檢查 '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> 沒有任何問題發現。
 -> 檢查 '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> 沒有任何問題發現。
 -> 檢查 '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> 沒有任何問題發現。
 Sun, 01 Apr 2018 22:27:41 +0800 完了。
```

並嘗試單獨掃描文件：

```
 Sun, 01 Apr 2018 22:27:41 +0800 開始。
 > 檢查 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> 沒有任何問題發現。
 Sun, 01 Apr 2018 22:27:41 +0800 完了。
```

#### <a name="BLACK_WHITE_GREY"></a>黑名單 – 白名單 – 灰名單 – 他們是什麼，我如何使用它們？

這些術語在不同的上下文中表達不同的含義。​在phpMussel中，有三個使用這些術語的上下文：​文件大小響應，文件類型響應，和簽名灰名單。

為了以最低的處理成本達到理想的效果，phpMussel在實際掃描文件之前可以檢查一些簡單的事情，如文件的大小，名稱和擴展名。​例如；如果文件太大，或者其擴展名表示在我們的網站上我們不想要的文件類型，我們可以立即標記文件，並且不需要掃描它。

文件大小響應是phpMussel在文件超出指定限制時響應的方式。​沒有涉及實際列表，但根據文件的大小，文件可能會在黑名單，白名單或灰名單中被有效考慮了。​存在兩種不同的可選配置指令來分別指定限制和期望的響應。

文件類型響應是phpMussel在文件擴展名時響應的方式。​存在三種不同的可選配置指令，用於明確指定哪些擴展應在黑名單，白名單和灰名單中位於。​如果文件的擴展名分別與指定的擴展名匹配，則可以在黑名單，白名單或灰名單中該文件有效地考慮了。

在這兩種上下文中，在白名單上意味著它不應該被掃描或標記；在黑名單上意味著它應該被標記（因此不需要掃描它）；和在灰名單上意味著需要進一步的分析來確定是否我們應該標記它（即，它應該被掃描）。

簽名灰名單是基本上應該忽略的簽名列表（這在文檔中已經簡要地提到了）。​當灰名單上的簽名被觸發時，phpMussel繼續通過其簽名工作，並且對於在灰名單上的簽名不要採取任何特殊行動。​沒有簽名黑名單，因為隱含的行為無論和触發簽名的正常的行為是一樣的，並且沒有簽名白名單，因為考慮到phpMussel的正常的工作方式以及它的已有的功能，隱含的行為不會有意義。

如果您需要解決由特定簽名造成的問題，並且不想禁用或卸載整個簽名文件，則簽名灰名單很有用。

---


### 11. <a name="SECTION11"></a>法律信息

#### 11.0 SECTION PREAMBLE

This section of the documentation is intended to describe possible legal considerations regarding the use and implementation of the package, and to provide some basic related information. This may be important for some users as a means to ensure compliancy with any legal requirements that may exist in the countries that they operate in, and some users may need to adjust their website policies in accordance with this information.

First and foremost, please realise that I (the package author) am not a lawyer, nor a qualified legal professional of any kind. Therefore, I am not legally qualified to provide legal advice. Also, in some cases, exact legal requirements may vary between different countries and jurisdictions, and these varying legal requirements may sometimes conflict (such as, for example, in the case of countries that favour privacy rights and the right to be forgotten, versus countries that favour extended data retention). Consider also that access to the package is not restricted to specific countries or jurisdictions, and therefore, the package userbase is likely to the geographically diverse. These points considered, I'm not in a position to state what it means to be "legally compliant" for all users, in all regards. However, I hope that the information herein will help you to come to a decision yourself regarding what you must do in order to remain legally compliant in the context of the package. If you have any doubts or concerns regarding the information herein, or if you need additional help and advice from a legal perspective, I would recommend consulting a qualified legal professional.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Relevant configuration directives:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Relevant configuration directives:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevant configuration directives:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 LOGGING

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

*Relevant configuration directives:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

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

*Relevant configuration directives:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Relevant configuration directives:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Relevant configuration directives:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Relevant configuration directives:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Relevant configuration directives:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Relevant configuration directives:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Relevant configuration directives:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Relevant configuration directives:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

The General Data Protection Regulation (GDPR) is a regulation of the European Union, which comes into effect as of May 25, 2018. The primary goal of the regulation is to give control to EU citizens and residents regarding their own personal data, and to unify regulation within the EU concerning privacy and personal data.

The regulation contains specific provisions pertaining to the processing of "personally identifiable information" (PII) of any "data subjects" (any identified or identifiable natural person) either from or within the EU. To be compliant with the regulation, "enterprises" (as per defined by the regulation), and any relevant systems and processes must implement "privacy by design" by default, must use the highest possible privacy settings, must implement necessary safeguards for any stored or processed information (including, but not limited to, the implementation of pseudonymisation or full anonymisation of data), must clearly and unambiguously declare the types of data they collect, how they process it, for what reasons, for how long they retain it, and whether they share this data with any third parties, the types of data shared with third parties, how, why, and so on.

Data may not be processed unless there's a lawful basis for doing so, as per defined by the regulation. Generally, this means that in order to process a data subject's data on a lawful basis, it must be done in compliance with legal obligations, or done only after explicit, well-informed, unambiguous consent has been obtained from the data subject.

Because aspects of the regulation may evolve in time, in order to avoid the propagation of outdated information, it may be better to learn about the regulation from an authoritative source, as opposed to simply including the relevant information here in the package documentation (which may eventually become outdated as the regulation evolves).

[EUR-Lex](https://eur-lex.europa.eu/) (a part of the official website of the European Union that provides information about EU law) provides extensive information about GDPR/DSGVO, available in 24 different languages (at the time of writing this), and available for download in PDF format. I would definitely recommend reading the information that they provide, in order to learn more about GDPR/DSGVO:
- [REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679)

Alternatively, there's a brief (non-authoritative) overview of GDPR/DSGVO available at Wikipedia:
- [General Data Protection Regulation](https://en.wikipedia.org/wiki/General_Data_Protection_Regulation)

---


最後更新：2018年5月25日。
