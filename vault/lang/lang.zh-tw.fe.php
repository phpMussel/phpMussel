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
 * This file: Chinese (traditional) language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">主頁</a> | <a href="?phpmussel-page=logout">登出</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">登出</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = '認可存檔文件擴展（格式是CSV；應該只添加或去掉當問題發生；不必要的去掉可能的可以導致假陽性出現為存檔文件，​而不必要的增加將實質上白名單任何事您增加從專用攻擊檢測；修改有慎重；還請注這個無影響在什麼存檔可以和不能被分析在內容級）。​這個名單，​作為是作為標準，​名單那些格式使用最常見的橫過多數的系統和CMS，​但有意是不全面。';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = '受阻任何文件包含任何控製字符嗎（以外換行符）？​(<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) 如果您只上傳純文本，​您可以激活這個指令以提供某些另外保護在您的系統。​然而，​如果您上傳任何事以外純文本，​激活這個可能結果在假陽性。​False（假）=不受阻【默認】； True（真）=受阻。';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = '尋找可執行頭在文件是不可執行文件也不認可存檔文件和尋找可執行文件誰的頭是不正確。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = '尋找PHP頭在文件是不PHP文件也不認可存檔文件。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = '尋找存檔文件誰的頭是不正確（已支持：BZ，​GZ，​RAR，​ZIP，​RAR，​GZ）。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = '尋找辦公文檔誰的頭是不正確（已支持：DOC，​DOT，​PPS，​PPT，​XLA，​XLS，​WIZ）。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = '尋找圖像誰的頭是不正確（已支持：BMP，​DIB，​PNG，​GIF，​JPEG，​JPG，​XCF，​PSD，​PDD，​WEBP）。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = '尋找PDF文件誰的頭是不正確。​False（假）=是關閉； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = '損壞文件和處理錯誤。​False（假）=忽略； True（真）=受阻【默認】。​檢測和受阻潛在的損壞移植可執行【PE】文件嗎？​時常（但不始終），​當某些零件的一個移植可執行【PE】文件是損壞或不能被正確處理，​它可以建議建議的一個病毒感染。​過程使用通過最殺毒程序以檢測病毒在PE文件需要處理那些文件在某些方式，​哪裡，​如果程序員的一個病毒是意識的，​將特別嘗試防止，​以允許他們的病毒留不檢測。';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = '在原始數據中解碼命令的長度限制（如果有任何引人注目性能問題當掃描）。​默認 = 512KB。​零或空值將關閉門檻（去除任何這樣的限基於文件大小）。';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = '原始數據讀取和掃描的最大長度（如果有任何引人注目性能問題當掃描）。​默認 = 32MB。​零或空值將關閉門檻。​按說，​這個數值應不會少於平均文件大小的文件上傳您想和期待收到您的服務器或網站，​應不會多於<code>filesize_limit</code>指令，​和應不會多於大致五分之一的總允許內存分配獲授PHP通過"php.ini"配置文件。​這個指令存在為嘗試防止phpMussel從用的太多內存（這個將防止它從能夠順利掃描文件以上的一個特別文件大小）。';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = '這個指令按說應會關閉除非它是需要為對功能的phpMussel在您的具體系統。​按說，​當是關閉，​當phpMussel檢測存在元素在<code>$_FILES</code>數組，​它將嘗試引發一個掃描的文件代表通過那些元素，​和，​如果他們是空或空白，​phpMussel將回報一個錯誤信息。​這個是正確行為為phpMussel。​然而，​為某些CMS，​空元素在<code>$_FILES</code>可以發生因之的自然的行為的那些CMS，​或錯誤可能會報告當沒有任何，​在這種情況，​正常行為為phpMussel將會使乾擾為正常行為的那些CMS。​如果這樣的一個情況發生為您，​激活這個指令將指示phpMussel不嘗試引發掃描為這樣的空元素，​忽略他們當發現和不回報任何關聯錯誤信息，​從而允許延續的頁面請求。​False（假）=不忽略； True（真）=忽略。';
$phpMussel['lang']['config_compatibility_only_allow_images'] = '如果您只期待或只意味到允許圖像被上傳在您的系統或CMS，​和如果您絕對不需要任何文件以外圖像被上傳在您的系統或CMS，​這個指令應會激活，​但其他應會關閉。​如果這個指令是激活，​它將指示phpMussel受阻而不例外任何上傳確定為非圖像文件，​而不掃描他們。​這個可能減少處理時間和內存使用為非圖像文件上傳嘗試。​False（假）=還允許其他文件； True（真）=只允許圖像文件。';
$phpMussel['lang']['config_files_block_encrypted_archives'] = '檢測和受阻加密的存檔嗎？​因為phpMussel是不能夠掃描加密的存檔內容，​它是可能存檔加密可能的可以使用通過一個攻擊者作為一種手段嘗試繞過phpMussel，​殺毒掃描儀和其他這樣的保護。​指示phpMussel受阻任何存檔它發現被加密可能的可以幫助減少任何風險有關聯這些可能性。​False（假）=不受阻； True（真）=受阻【默認】。';
$phpMussel['lang']['config_files_check_archives'] = '嘗試匹配存檔內容嗎？​False（假）=不匹配； True（真）=匹配【默認】。​目前，​只BZ/BZIP2，​GZ/GZIP，​LZF，​PHAR，​TAR和ZIP文件格式是支持（匹配的RAR，​CAB，​7z和等等不還支持）。​這個是不完美！​雖說我很推薦保持這個激活，​我不能保證它將始終發現一切。​還，​請注意存檔匹配目前是不遞歸為PHAR或ZIP格式。';
$phpMussel['lang']['config_files_filesize_archives'] = '繼承文件大小黑名單/白名單在存檔內容嗎？​False（假）=不繼承（剛灰名單一切）； True（真）=繼承【默認】。';
$phpMussel['lang']['config_files_filesize_limit'] = '文件大小限在KB。​65536 = 64MB【默認】，​0 = 沒有限（始終灰名單），​任何正數值接受。​這個可以有用當您的PHP配置限內存量一個進程可以佔據或如果您的PHP配置限文件大小的上傳。';
$phpMussel['lang']['config_files_filesize_response'] = '如何處理文件超過文件大小限（如果存在）。​False（假）=白名單； True（真）=黑名單【默認】。';
$phpMussel['lang']['config_files_filetype_archives'] = '繼承文件類型黑名單/白名單在存檔內容嗎？​False（假）=不繼承（剛灰名單一切）； True（真）=繼承【默認】。';
$phpMussel['lang']['config_files_filetype_blacklist'] = '黑名單：';
$phpMussel['lang']['config_files_filetype_greylist'] = '灰名單：';
$phpMussel['lang']['config_files_filetype_whitelist'] = '如果您的系統只允許具體文件類型被上傳，​或如果您的系統明確地否認某些文件類型，​指定那些文件類型在白名單，​黑名單和灰名單可以增加掃描執行速度通過允許腳本跳過某些文件類型。​格式是CSV（逗號分隔變量）。​如果您想掃描一切，​而不是白名單，​黑名單或灰名單，​留變量空；這樣做將關閉白名單/黑名單/灰名單。​進程邏輯順序是：如果文件類型已白名單，​不掃描和不受阻文件，​和不匹配文件對照黑名單或灰名單。​如果文件類型已黑名單，​不掃描文件但阻止它無論如何，​和不匹配文件對照灰名單。​如果灰名單是空，​或如果灰名單不空和文件類型已灰名單，​掃描文件像正常和確定如果阻止它基於掃描結果，​但如果灰名單不空和文件類型不灰名單，​過程文件彷彿已黑名單，​因此不掃描它但阻止它無論如何。​白名單：';
$phpMussel['lang']['config_files_max_recursion'] = '最大存檔遞歸深度限。​默認=10。';
$phpMussel['lang']['config_files_max_uploads'] = '最大允許數值的文件為掃描當文件上傳掃描之前中止掃描和告訴用戶他們是上傳太多在同一時間！​提供保護針對一個理論攻擊哪裡一個攻擊者嘗試DDoS您的系統或CMS通過超載phpMussel以減速PHP進程到一個停止。​推薦：10。​您可能想增加或減少這個數值，​根據速度的您的硬件。​注意這個數值不交待為或包括存檔內容。';
$phpMussel['lang']['config_general_cleanup'] = '【反設置/刪除/清潔】腳本變量和緩存【Cache】之後執行嗎？​如果您不使用腳本外初始上傳掃描，​應該設置True【真/正】，​為了最小化內存使用。​如果您使用腳本為目的外初始上傳掃描，​應該設置False【假/負】，​為了避免不必要重新加載複製數據在內存。​在一般的做法，​它應該設置True【真/正】，​但，​如果您做這樣，​您將不能夠使用腳本為任何目的以外文件上傳掃描。​無影響在CLI模式。';
$phpMussel['lang']['config_general_default_algo'] = '定義要用於所有未來密碼和會話的算法。​選項：​​PASSWORD_DEFAULT（標準），​PASSWORD_BCRYPT，​PASSWORD_ARGON2I（需要PHP >= 7.2.0）。';
$phpMussel['lang']['config_general_delete_on_sight'] = '激活的這個指令將指示腳本馬上刪除任何掃描文件上傳匹配任何檢測標準，​是否通過簽名或任何事其他。​文件已確定是清潔將會忽略。​如果是存檔，​全存檔將會刪除，​不管如果違規文件是只有一個的幾個文件包含在存檔。​為文件上傳掃描，​按說，​它不必要為您激活這個指令，​因為按說，​PHP將自動清洗內容的它的緩存當執行是完，​意思它將按說刪除任何文件上傳從它向服務器如果不已移動，​複製或刪除。​這個指令是添加這里為額外安全為任何人誰的PHP副本可能不始終表現在預期方式。​False【假/負】：之後掃描，​忽略文件【標準】，​True【真/正】：之後掃描，​如果不清潔，​馬上刪除。';
$phpMussel['lang']['config_general_disable_cli'] = '關閉CLI模式嗎？​CLI模式是按說激活作為標準，​但可以有時干擾某些測試工具（例如PHPUnit，​為例子）和其他基於CLI應用。​如果您沒有需要關閉CLI模式，​您應該忽略這個指令。​False（假）=激活CLI模式【標準】； True（真）=關閉CLI模式。';
$phpMussel['lang']['config_general_disable_frontend'] = '關閉前端訪問嗎？​前端訪問可以使phpMussel更易於管理，​但也可能是潛在的安全風險。​建議管理phpMussel通過後端只要有可能，​但前端訪問提供當不可能。​保持關閉除非您需要它。​False（假）=激活前端訪問； True（真）=關閉前端訪問【標準】。';
$phpMussel['lang']['config_general_disable_webfonts'] = '關閉網絡字體嗎？​True（真）=關閉； False（假）=不關閉【標準】。';
$phpMussel['lang']['config_general_enable_plugins'] = '啟用phpMussel插件支持嗎？​False（假）=不要啟用； True（真）=要啟用【標準】。';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel應該發送<code>403</code>頭隨著文件上傳受阻信息，​或堅持標準<code>200 OK</code>？​False（假）=發送<code>200</code>； True（真）=發送<code>403</code>【標準】。';
$phpMussel['lang']['config_general_FrontEndLog'] = '前端登錄嘗試的錄音文件。​指定一個文件名，​或留空以禁用。';
$phpMussel['lang']['config_general_honeypot_mode'] = '當這個指令（蜜罐模式）是激活，​phpMussel將嘗試檢疫所有文件上傳它遇到，​無論的如果文件上傳是匹配任何包括簽名，​和沒有掃描或分析的那些文件上傳將發生。​這個功能應有用為那些想使用的phpMussel為目的病毒或惡意軟件研究，​但它是不推薦激活這個功能如果預期的用的phpMussel通過用戶是為標準文件上傳掃描，​也不推薦使用蜜罐功能為目的以外蜜罐。​作為標準，​這個指令是關閉。​False（假）=是關閉【標準】； True（真）=是激活。';
$phpMussel['lang']['config_general_ipaddr'] = '在哪裡可以找到連接請求IP地址？​（可以使用為服務例如Cloudflare和類似）標準是<code>REMOTE_ADDR</code>。​警告！​不要修改此除非您知道什麼您做著！';
$phpMussel['lang']['config_general_lang'] = '指定標準phpMussel語言。';
$phpMussel['lang']['config_general_maintenance_mode'] = '啟用維護模式？​True（真）=關閉；​False（假）=不關閉【標準】。​它停用一切以外前端。​有時候在更新CMS，框架，等時有用。';
$phpMussel['lang']['config_general_max_login_attempts'] = '最大登錄嘗試次數（前端）。​標準=5。';
$phpMussel['lang']['config_general_numbers'] = '您如何喜歡顯示數字？​選擇最適合示例。';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel可以檢疫壞文件上傳在隔離在phpMussel的安全/保險庫【Vault】，​如果這個是某物您想。​普通用戶的phpMussel簡單地想保護他們的網站或宿主環境無任何興趣在深深分析任何嘗試文件上傳應該離開這個功能關閉，​但任何用戶有興趣在更深分析的嘗試文件上傳為目的惡意軟件研究或為類似這樣事情應該激活這個功能。​檢疫的嘗試文件上傳可以有時還助攻在調試假陽性，​如果這個是某物經常發生為您。​以關閉檢疫功能，​簡單地離開<code>quarantine_key</code>指令空白，​或抹去內容的這個指令如果它不已空白。​以激活隔離功能，​輸入一些值在這個指令。​<code>quarantine_key</code>是一個重要安全功能的隔離功能需要以預防檢疫功能從成為利用通過潛在攻擊者和以預防任何潛在執行的數據存儲在檢疫。​<code>quarantine_key</code>應該被處理在同樣方法作為您的密碼：更長是更好，​和緊緊保護它。​為獲得最佳效果，​在結合使用<code>delete_on_sight</code>。';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = '最大允許文件大小為文件在檢疫。​文件大於這個指定數值將不成為檢疫。​這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。​標準 = 2MB。';
$phpMussel['lang']['config_general_quarantine_max_usage'] = '最大內存使用允許為檢疫。​如果總內存已用通過隔離到達這個數值，​最老檢疫文件將會刪除直到總內存已用不再到達這個數值。​這個指令是重要為使它更難為任何潛在攻擊者洪水您的檢疫用非通緝數據潛在的造成過度數據用法在您的虛擬主機服務。​數值是在KB。​標準 = 64MB。';
$phpMussel['lang']['config_general_scan_cache_expiry'] = '多長時間應該phpMussel維持掃描結果？​數值是秒數為維持掃描結果。​標準是21600秒（6小時）； 一個<code>0</code>數值將停止維持掃描結果。';
$phpMussel['lang']['config_general_scan_kills'] = '文件為記錄在所有受阻或已殺上傳。​指定一個文件名，​或留空以關閉。';
$phpMussel['lang']['config_general_scan_log'] = '文件為記錄在所有掃描結果。​指定一個文件名，​或留空以關閉。';
$phpMussel['lang']['config_general_scan_log_serialized'] = '文件為記錄在所有掃描結果（它採用序列化格式）。​指定一個文件名，​或留空以關閉。';
$phpMussel['lang']['config_general_statistics'] = '跟踪phpMussel使用情況統計？​True（真）=跟踪； False（假）=不跟踪【標準】。';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel使用的日期符號格式。​可根據要求增加附加選項。';
$phpMussel['lang']['config_general_timeOffset'] = '時區偏移量（分鐘）。';
$phpMussel['lang']['config_general_timezone'] = '您的時區。';
$phpMussel['lang']['config_general_truncate'] = '截斷日誌文件當他們達到一定的大小嗎？​值是在B/KB/MB/GB/TB，​是日誌文件允許的最大大小直到它被截斷。​默認值為『0KB』將禁用截斷（日誌文件可以無限成長）。​注意：適用於單個日誌文件！​日誌文件大小不被算集體的。';
$phpMussel['lang']['config_heuristic_threshold'] = '有某些簽名的phpMussel意味為確定可疑和可能惡意文件零件被上傳有不在他們自己確定那些文件被上傳特別是作為惡意。​這個『threshold』數值告訴phpMussel什麼是最大總重量的可疑和潛在惡意文件零件被上傳允許之前那些文件是被識別作為惡意。​定義的重量在這個上下文是總數值的可疑和可能惡意文件零件確定。​作為默認，​這個數值將會設置作為3。​一個較低的值通常將結果在一個更高的發生的假陽性但一個更高的發生的惡意文件被確定，​而一個更高的數值將通常結果在一個較低的發生的假陽性但一個較低的數值的惡意文件被確定。​它是通常最好忽略這個數值除非您遇到關聯問題。';
$phpMussel['lang']['config_signatures_Active'] = '活性簽名文件的列表，​以逗號分隔。';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel應該使用簽名為廣告軟件檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel應該使用簽名為污損的污損軟件檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel應該檢測並阻止加密的文件嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel應該使用簽名為病毒/惡意軟件笑話/惡作劇檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel應該使用簽名為打包機和打包數據檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel應該使用簽名為PUP/PUA（可能無用/非通緝程序/軟件）檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel應該使用簽名為webshell腳本檢測嗎？​False（假）=不檢查，​True（真）=檢查【默認】。';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'phpMussel應該報告當擴展是失踪嗎？​如果<code>fail_extensions_silently</code>是關閉，​失踪擴展將會報告當掃描，​和如果<code>fail_extensions_silently</code>是激活，​失踪擴展將會忽略，​有掃描報告為那些文件哪裡沒有任何問題。​關閉的這個指令可能的可以增加您的安全，​但可能還導致一個增加的假陽性。​False（假）=是關閉； True（真）=是激活【默認】。';
$phpMussel['lang']['config_signatures_fail_silently'] = 'phpMussel應該報告當簽名文件是失踪或損壞嗎？​如果<code>fail_silently</code>是關閉，​失踪和損壞文件將會報告當掃描，​和如果<code>fail_silently</code>是激活，​失踪和損壞文件將會忽略，​有掃描報告為那些文件哪裡沒有問題。​這個應該按說被留下除非您遇到失敗或有其他類似問題。​False（假）=是關閉； True（真）=是激活【默認】。';
$phpMussel['lang']['config_template_data_css_url'] = '模板文件為個性化主題使用外部CSS屬性，​而模板文件為t標準主題使用內部CSS屬性。​以指示phpMussel使用模板文件為個性化主題，​指定公共HTTP地址的您的個性化主題的CSS文件使用<code>css_url</code>變量。​如果您離開這個變量空白，​phpMussel將使用模板文件為默認主題。';
$phpMussel['lang']['config_template_data_Magnification'] = '字體放大。​標準 = 1。';
$phpMussel['lang']['config_template_data_theme'] = '用於phpMussel的默認主題。';
$phpMussel['lang']['config_urlscanner_cache_time'] = '多長時間（以秒為單位）應API結果被緩存？​默認是3600秒（1小時）。';
$phpMussel['lang']['config_urlscanner_google_api_key'] = '激活Google Safe Browsing API當API密鑰是設置。';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = '激活hpHosts API當設置<code>true</code>。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = '最大數值API請求來執行每個掃描迭代。​額外API請求將增加的總要求完成時間每掃描迭代，​所以，​您可能想來規定一個限以加快全掃描過程。​當設置<code>0</code>，​沒有最大數值將會應用的。​設置<code>10</code>作為默認。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = '該什麼辦如果最大數值API請求已超過？​False（假）=沒做任何事（繼續處理）【默認】； True（真）=標誌/受阻文件。';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = '可選的，​phpMussel可以掃描文件使用【Virus Total API】作為一個方法提供一個顯著的改善保護級別針對病毒，​木馬，​惡意軟件和其他威脅。​作為默認，​掃描文件使用【Virus Total API】是關閉。​以激活它，​一個API密鑰從VirusTotal是需要。​因為的顯著好處這個可以提供為您，​它是某物我很推薦激活。​請注意，​然而，​以使用的【Virus Total API】，​您必須同意他們的服務條款和您必須堅持所有方針按照說明通過VirusTotal閱讀材料！​您是不允許使用這個積分功能除非：您已閱讀和您同意服務條款的VirusTotal和它的API。​您已閱讀和您了解至少序言的VirusTotal公共API閱讀材料(一切之後『VirusTotal Public API v2.0』但之前『Contents』）。';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = '根據【Virus Total API】閱讀材料，​它是限於最大的<code>4</code>請求的任何類型在任何<code>1</code>分鐘大致時間。​如果您經營一個『honeyclient』，​蜜罐或任何其他自動化將會提供資源為VirusTotal和不只取回報告您是有權一個更高請求率配額。​作為標準，​phpMussel將嚴格的堅持這些限制，​但因為可能性的這些率配額被增加，​這些二指令是提供為您指示phpMussel為什麼限它應堅持。​除非您是指示這樣做，​它是不推薦為您增加這些數值，​但，​如果您遇到問題相關的到達您的率配額，​減少這些數值可能有時幫助您解析這些問題。​您的率限是決定作為<code>vt_quota_rate</code>請求的任何類型在任何<code>vt_quota_time</code>分鐘大致時間。';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '（見上面的說明）。';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = '作為標準，​phpMussel將限制什麼文件它掃描通過使用【Virus Total API】為那些文件它考慮作為『可疑』。​您可以可選調整這個局限性通過修改的<code>vt_suspicion_level</code>指令數值。';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMussel應使用掃描結果使用【Virus Total API】作為檢測或作為檢測重量嗎？​這個指令存在，​因為，​雖說掃描一個文件使用多AV引擎（例如怎麼樣VirusTotal做） 應結果有一個增加檢測率（和因此在一個更惡意文件被抓），​它可以還結果有更假陽性，​和因此，​為某些情況，​掃描結果可能被更好使用作為一個置信得分而不是作為一個明確結論。​如果一個數值的<code>0</code>是使用，​掃描結果使用【Virus Total API】將會適用作為檢測，​和因此，​如果任何AV引擎使用通過VirusTotal標致文件被掃描作為惡意，​phpMussel將考慮文件作為惡意。​如果任何其他數值是使用，​掃描結果使用【Virus Total API】將會適用作為檢測重量，​和因此，​數的AV引擎使用通過VirusTotal標致文件被掃描作為惡意將服務作為一個置信得分（或檢測重量） 為如果文件被掃描應會考慮惡意通過phpMussel（數值使用將代表最低限度的置信得分或重量需要以被考慮惡意）。​一個數值的<code>0</code>是使用作為標準。';
$phpMussel['lang']['Extended Description: phpMussel'] = '主包（沒有簽名文件，文檔，和配置）。';
$phpMussel['lang']['field_activate'] = '啟用';
$phpMussel['lang']['field_clear_all'] = '撤銷所有';
$phpMussel['lang']['field_component'] = '組件';
$phpMussel['lang']['field_create_new_account'] = '創建新賬戶';
$phpMussel['lang']['field_deactivate'] = '停用';
$phpMussel['lang']['field_delete_account'] = '刪除賬戶';
$phpMussel['lang']['field_delete_all'] = '刪除所有';
$phpMussel['lang']['field_delete_file'] = '刪除';
$phpMussel['lang']['field_download_file'] = '下載';
$phpMussel['lang']['field_edit_file'] = '編輯';
$phpMussel['lang']['field_false'] = 'False（假）';
$phpMussel['lang']['field_file'] = '文件';
$phpMussel['lang']['field_filename'] = '文件名：';
$phpMussel['lang']['field_filetype_directory'] = '文件夾';
$phpMussel['lang']['field_filetype_info'] = '{EXT}文件';
$phpMussel['lang']['field_filetype_unknown'] = '未知';
$phpMussel['lang']['field_install'] = '安裝';
$phpMussel['lang']['field_latest_version'] = '最新版本';
$phpMussel['lang']['field_log_in'] = '登錄';
$phpMussel['lang']['field_more_fields'] = '更多字段';
$phpMussel['lang']['field_new_name'] = '新名稱：';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = '選項';
$phpMussel['lang']['field_password'] = '密碼';
$phpMussel['lang']['field_permissions'] = '權限';
$phpMussel['lang']['field_quarantine_key'] = '隔離鑰匙';
$phpMussel['lang']['field_rename_file'] = '改名';
$phpMussel['lang']['field_reset'] = '重啟';
$phpMussel['lang']['field_restore_file'] = '恢復';
$phpMussel['lang']['field_set_new_password'] = '保存新密碼';
$phpMussel['lang']['field_size'] = '總大小：';
$phpMussel['lang']['field_size_bytes'] = '字節';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = '狀態';
$phpMussel['lang']['field_system_timezone'] = '使用系統默認時區。';
$phpMussel['lang']['field_true'] = 'True（真）';
$phpMussel['lang']['field_uninstall'] = '卸載';
$phpMussel['lang']['field_update'] = '更新';
$phpMussel['lang']['field_update_all'] = '更新一切';
$phpMussel['lang']['field_upload_file'] = '上傳新文件';
$phpMussel['lang']['field_username'] = '用戶名';
$phpMussel['lang']['field_your_version'] = '您的版本';
$phpMussel['lang']['header_login'] = '請登錄以繼續。';
$phpMussel['lang']['label_active_config_file'] = '活動配置文件：';
$phpMussel['lang']['label_blocked'] = '上傳已阻止';
$phpMussel['lang']['label_branch'] = '分支最新穩定：';
$phpMussel['lang']['label_events'] = '掃描事件';
$phpMussel['lang']['label_flagged'] = '對像已標記';
$phpMussel['lang']['label_fmgr_cache_data'] = '緩存數據和臨時文件';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel使用的磁盤空間： ';
$phpMussel['lang']['label_fmgr_free_space'] = '可用磁盤空間： ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = '總共使用的磁盤空間： ';
$phpMussel['lang']['label_fmgr_total_space'] = '總磁盤空間： ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = '組件更新元數據';
$phpMussel['lang']['label_hide'] = '隱藏';
$phpMussel['lang']['label_os'] = '目前使用操作系統：';
$phpMussel['lang']['label_other'] = '其他';
$phpMussel['lang']['label_other-Active'] = '活動簽名文件';
$phpMussel['lang']['label_other-Since'] = '開始日期';
$phpMussel['lang']['label_php'] = '目前使用PHP版本：';
$phpMussel['lang']['label_phpmussel'] = '目前使用phpMussel版本：';
$phpMussel['lang']['label_quarantined'] = '上傳已隔離';
$phpMussel['lang']['label_sapi'] = '目前使用SAPI：';
$phpMussel['lang']['label_scanned_objects'] = '對像已掃描';
$phpMussel['lang']['label_scanned_uploads'] = '上傳已掃描';
$phpMussel['lang']['label_show'] = '顯示';
$phpMussel['lang']['label_size_in_quarantine'] = '大小在檢疫：';
$phpMussel['lang']['label_stable'] = '最新穩定：';
$phpMussel['lang']['label_sysinfo'] = '系統信息：';
$phpMussel['lang']['label_tests'] = '測試：';
$phpMussel['lang']['label_unstable'] = '最新不穩定：';
$phpMussel['lang']['label_upload_date'] = '上傳日期：';
$phpMussel['lang']['label_upload_hash'] = '上傳哈希：';
$phpMussel['lang']['label_upload_origin'] = '上傳原點：';
$phpMussel['lang']['label_upload_size'] = '上傳大小：';
$phpMussel['lang']['link_accounts'] = '賬戶';
$phpMussel['lang']['link_config'] = '配置';
$phpMussel['lang']['link_documentation'] = '文檔';
$phpMussel['lang']['link_file_manager'] = '文件管理器';
$phpMussel['lang']['link_home'] = '主頁';
$phpMussel['lang']['link_logs'] = '日誌';
$phpMussel['lang']['link_quarantine'] = '隔離';
$phpMussel['lang']['link_statistics'] = '統計';
$phpMussel['lang']['link_textmode'] = '文字格式： <a href="%1$sfalse">簡單</a> – <a href="%1$strue">漂亮</a>';
$phpMussel['lang']['link_updates'] = '更新';
$phpMussel['lang']['link_upload_test'] = '上傳測試';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = '選擇的日誌不存在！';
$phpMussel['lang']['logs_no_logfiles_available'] = '沒有日誌可用。';
$phpMussel['lang']['logs_no_logfile_selected'] = '沒有選擇的日誌。';
$phpMussel['lang']['max_login_attempts_exceeded'] = '最大登錄嘗試次數已經超過；拒絕訪問。';
$phpMussel['lang']['previewer_days'] = '天';
$phpMussel['lang']['previewer_hours'] = '小時';
$phpMussel['lang']['previewer_minutes'] = '分';
$phpMussel['lang']['previewer_months'] = '月';
$phpMussel['lang']['previewer_seconds'] = '秒';
$phpMussel['lang']['previewer_weeks'] = '週';
$phpMussel['lang']['previewer_years'] = '年';
$phpMussel['lang']['response_accounts_already_exists'] = '一個賬戶與那個用戶名已經存在！';
$phpMussel['lang']['response_accounts_created'] = '帳戶成功創建！';
$phpMussel['lang']['response_accounts_deleted'] = '帳戶成功刪除！';
$phpMussel['lang']['response_accounts_doesnt_exist'] = '那個帳戶不存在。';
$phpMussel['lang']['response_accounts_password_updated'] = '密碼成功更新！';
$phpMussel['lang']['response_activated'] = '已成功啟用。';
$phpMussel['lang']['response_activation_failed'] = '無法啟用！';
$phpMussel['lang']['response_checksum_error'] = '校驗和錯誤！​文件拒絕！';
$phpMussel['lang']['response_component_successfully_installed'] = '組件成功安裝。';
$phpMussel['lang']['response_component_successfully_uninstalled'] = '組件成功卸載。';
$phpMussel['lang']['response_component_successfully_updated'] = '組件成功更新。';
$phpMussel['lang']['response_component_uninstall_error'] = '一個錯誤發生當嘗試卸載組件。';
$phpMussel['lang']['response_configuration_updated'] = '配置成功更新。';
$phpMussel['lang']['response_deactivated'] = '已成功停用。';
$phpMussel['lang']['response_deactivation_failed'] = '無法停用！';
$phpMussel['lang']['response_delete_error'] = '無法刪除！';
$phpMussel['lang']['response_directory_deleted'] = '文件夾成功刪除！';
$phpMussel['lang']['response_directory_renamed'] = '文件夾成功改名！';
$phpMussel['lang']['response_error'] = '錯誤';
$phpMussel['lang']['response_failed_to_install'] = '無法安裝！';
$phpMussel['lang']['response_failed_to_update'] = '無法更新！';
$phpMussel['lang']['response_file_deleted'] = '文件成功刪除！';
$phpMussel['lang']['response_file_edited'] = '文件成功改性！';
$phpMussel['lang']['response_file_renamed'] = '文件成功改名！';
$phpMussel['lang']['response_file_restored'] = '文件成功恢復！';
$phpMussel['lang']['response_file_uploaded'] = '文件成功上傳！';
$phpMussel['lang']['response_login_invalid_password'] = '登錄失敗！​密碼無效！';
$phpMussel['lang']['response_login_invalid_username'] = '登錄失敗！​用戶名不存在！';
$phpMussel['lang']['response_login_password_field_empty'] = '密碼輸入是空的！';
$phpMussel['lang']['response_login_username_field_empty'] = '用戶名輸入是空的！';
$phpMussel['lang']['response_rename_error'] = '無法改名！';
$phpMussel['lang']['response_restore_error_1'] = '無法恢復！損壞的文件！';
$phpMussel['lang']['response_restore_error_2'] = '無法恢復！不正確的隔離鑰匙！';
$phpMussel['lang']['response_statistics_cleared'] = '統計刪除。';
$phpMussel['lang']['response_updates_already_up_to_date'] = '已經更新。';
$phpMussel['lang']['response_updates_not_installed'] = '組件不安裝！';
$phpMussel['lang']['response_updates_not_installed_php'] = '組件不安裝（它需要PHP {V}）！';
$phpMussel['lang']['response_updates_outdated'] = '過時！';
$phpMussel['lang']['response_updates_outdated_manually'] = '過時（請更新手動）！';
$phpMussel['lang']['response_updates_outdated_php_version'] = '過時（它需要PHP {V}）！';
$phpMussel['lang']['response_updates_unable_to_determine'] = '無法確定。';
$phpMussel['lang']['response_upload_error'] = '無法上傳！';
$phpMussel['lang']['state_complete_access'] = '完全訪問';
$phpMussel['lang']['state_component_is_active'] = '組件是活性。';
$phpMussel['lang']['state_component_is_inactive'] = '組件是非活性。';
$phpMussel['lang']['state_component_is_provisional'] = '組件是有時活性。';
$phpMussel['lang']['state_default_password'] = '警告：它使用標準密碼！';
$phpMussel['lang']['state_logged_in'] = '目前在線。';
$phpMussel['lang']['state_logs_access_only'] = '僅日誌訪問';
$phpMussel['lang']['state_maintenance_mode'] = '警告：維護模式是啟用！';
$phpMussel['lang']['state_password_not_valid'] = '警告：此帳戶不​使用有效的密碼！';
$phpMussel['lang']['state_quarantine'] = '目前有%s個文件在隔離區。';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = '不要隱藏非過時';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = '隱藏非過時';
$phpMussel['lang']['switch-hide-unused-set-false'] = '不要隱藏非用過';
$phpMussel['lang']['switch-hide-unused-set-true'] = '隱藏非用過';
$phpMussel['lang']['tip_accounts'] = '你好，​{username}。​<br />賬戶頁面允許您控制誰可以訪問phpMussel前端。';
$phpMussel['lang']['tip_config'] = '你好，​{username}。​<br />配置頁面允許您修改phpMussel配置從前端。';
$phpMussel['lang']['tip_donate'] = 'phpMussel是免費提供的，​但如果您想捐贈給項目，​您可以通過點擊捐贈按鈕這樣做。';
$phpMussel['lang']['tip_file_manager'] = '你好，​{username}。​<br />文件管理器允許您刪除，​編輯，​上傳和下載文件。​小心使用（您可以用這個破壞您的安裝）。';
$phpMussel['lang']['tip_home'] = '你好，​{username}。​<br />這是phpMussel的前端主頁。​從左側的導航菜單中選擇一個鏈接以繼續。';
$phpMussel['lang']['tip_login'] = '標準用戶名：<span class="txtRd">admin</span> – 標準密碼：<span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = '你好，​{username}。​<br />選擇一個日誌從下面的列表以查看那個日誌的內容。';
$phpMussel['lang']['tip_quarantine'] = '你好，​{username}。​<br />此頁面列出當前在隔離中的所有文件，並可以用來管理這些文件。';
$phpMussel['lang']['tip_quarantine_disabled'] = '注意：隔離目前禁用，但可以通過配置頁面啟用。';
$phpMussel['lang']['tip_see_the_documentation'] = '請參閱<a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.zh-TW.md#SECTION7">文檔</a>以獲取有關各種配置指令的信息和他們的目的。';
$phpMussel['lang']['tip_statistics'] = '你好，​{username}。​<br />此頁面顯示了有關phpMussel安裝的一些基本使用統計信息。';
$phpMussel['lang']['tip_statistics_disabled'] = '注意：統計跟踪目前已被禁用，但可以通過配置頁面啟用。';
$phpMussel['lang']['tip_updates'] = '你好，​{username}。​<br />更新頁面允許您安裝，​卸載，​和更新phpMussel的各種組件（核心包，​簽名，​插件，​L10N文件，​等等）。';
$phpMussel['lang']['tip_upload_test'] = '你好，​{username}。​<br />上傳測試頁麵包含標准文件上傳表單，​允許您測試是否文件通常會被阻止通過phpMussel當嘗試上傳他們。';
$phpMussel['lang']['title_accounts'] = 'phpMussel – 帳戶';
$phpMussel['lang']['title_config'] = 'phpMussel – 配置';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – 文件管理器';
$phpMussel['lang']['title_home'] = 'phpMussel – 主頁';
$phpMussel['lang']['title_login'] = 'phpMussel – 登錄';
$phpMussel['lang']['title_logs'] = 'phpMussel – 日誌';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – 隔離';
$phpMussel['lang']['title_statistics'] = 'phpMussel – 統計';
$phpMussel['lang']['title_updates'] = 'phpMussel – 更新';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – 上傳測試';
$phpMussel['lang']['warning'] = '警告：';
$phpMussel['lang']['warning_php_1'] = '您的PHP版本不再被積極支持！​推薦更新！';
$phpMussel['lang']['warning_php_2'] = '您的PHP版本非常脆弱！​強烈推薦更新！';
$phpMussel['lang']['warning_signatures_1'] = '沒有簽名文件是活動的！';

$phpMussel['lang']['info_some_useful_links'] = '一些有用的链接：<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel問題 ＠ GitHub</a> – phpMussel問題頁面（支持，​協助，​等等）。​</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel ＠ Spambot Security</a> – phpMussel討論論壇（支持，​協助，​等等）。​</li>
            <li><a href="https://www.oschina.net/p/phpMussel">phpMussel＠开源中国社区</a> – phpMussel頁面託管在開源中國社區。​</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel ＠ SourceForge</a> – phpMussel替代下載鏡像。​</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – 簡單網站管理員工具集合為保護網站。​</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV主頁（ClamAV®是一個開源的防病毒引擎用於檢測木馬，​病毒，​惡意軟件和其他惡意威脅）。​</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – 一家計算機安全公司；為ClamAV提供補充簽名。​</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – 網絡釣魚數據庫；由phpMussel URL掃描器使用。​</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group ＠ Facebook</a> – PHP學習資源和討論。​</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP學習資源和討論。​</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal是一項免費服務，​用於分析可疑文件和URL。​</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis是由<a href="http://www.payload-security.com/">Payload Security</a>提供的免費惡意軟件分析服務。​</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – 電腦反惡意軟件專家。​</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – 有用的討論論壇關於惡意軟件。​</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">脆弱性圖表</a> – 列出各種軟件包的安全/不安全版本（PHP，HHVM，等等）。</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">兼容性圖表</a> – 列出各種軟件包的兼容性信息（CIDRAM，phpMussel，等等）。</li>
        </ul>';
