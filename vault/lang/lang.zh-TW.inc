<?php
/*    _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

 Thank you for using phpMussel, a PHP script designed to detect trojans,
 viruses, malware and other threats within files uploaded to your system
 wherever the script is hooked, based on the signatures of ClamAV and others.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).

 This document and its associated package can be downloaded for free from:
 - Sourceforge <http://phpmussel.sourceforge.net/>.
 - GitHub <https://github.com/Maikuolan/phpMussel/>.

                                     ~ ~ ~
 This File: phpMussel Chinese (Traditional) / 中文（傳統） Language Data (9th September 2015).
 <%phpMussel%/vault/lang/lang.zh-TW.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='我不明白的命令，對不起。';
$MusselConfig['lang']['cli_commands']=" q\n - 戒菸CLI模式。\n - 別名：quit，exit。\n md5_file\n - 生成MD5簽名從文件[語法：md5_file 文件名]。\n - 別名：m.\n md5\n - 生成MD5簽名從數據[語法：md5 數據]。\n hex_encode\n - 兌換從二進制數據至十六進制[語法：hex_encode 數據]。\n - 別名：x.\n hex_decode\n - 兌換從十六進制二進制數據至[語法：hex_decode 數據]。\n base64_encode\n - 兌換從二進制數據至基地64數據[語法：base64_encode 數據]。\n - 別名：b.\n base64_decode\n - 兌換從基地64數據至二進制數據[語法：base64_decode 數據]。\n scan\n - 掃描文件或文件夾[語法：scan 文件名]。\n - 別名：s。\n update\n - 更新phpMussel。\n - 別名：u。\n c\n - 打印此命令列表。\n";
$MusselConfig['lang']['cli_failed_to_complete']='完成掃描過程失敗';
$MusselConfig['lang']['cli_is_not_a']='不是文件或文件夾。';
$MusselConfig['lang']['cli_ln2']="謝謝對於使用phpMussel，一個PHP腳本旨在檢測木馬，病毒，惡意軟件，和其他威脅在文件上傳到您的系統隨地這個腳本是叫，根據ClamAV的簽名和其他簽名。\n\n PHPMUSSEL版權2013和此後GNU/GPLv.2通過Caleb M （Maikuolan）。\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" 目前經營phpMussel在CLI模式（命令行界面）。\n\n 掃描一個文件或文件夾，鍵入“scan”，其次是名的文件或文件夾您想phpMussel掃描然後按Enter鍵；\n 鍵入“c”然後按Enter鍵對於CLI模式命令名單；鍵入“q”然後按Enter鍵對於戒菸：";
$MusselConfig['lang']['cli_pe1']='不PE文件！';
$MusselConfig['lang']['cli_pe2']='PE部分:';
$MusselConfig['lang']['cli_update_restart']=' 重新啟動phpMussel可能是需要之前的更新變得明顯。';
$MusselConfig['lang']['cli_working']='進行中';
$MusselConfig['lang']['controls_lockout']='phpMussel控制閉鎖是啟用。';
$MusselConfig['lang']['core_scriptfile_missing']='核心文件是丟失！請重新安裝phpMussel。';
$MusselConfig['lang']['corrupted']='檢測損壞PE';
$MusselConfig['lang']['denied']='上傳是否認！';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='您的上傳被拒绝由于这些原因 / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='檢測{vn}';
$MusselConfig['lang']['detected_control_characters']='檢測控製字符';
$MusselConfig['lang']['encrypted_archive']='檢測加密檔案文件; 加密檔案文件不允許';
$MusselConfig['lang']['failed_to_access']='無法訪問';
$MusselConfig['lang']['file']='文件';
$MusselConfig['lang']['filesize_limit_exceeded']='文件大小超過限制';
$MusselConfig['lang']['filetype_blacklisted']='文件類型列入黑名單';
$MusselConfig['lang']['finished']='完了';
$MusselConfig['lang']['generated_by']='所產生通過';
$MusselConfig['lang']['greylist_cleared']=' 灰名單清空。';
$MusselConfig['lang']['greylist_not_updated']=' 灰名單不更新。';
$MusselConfig['lang']['greylist_updated']=' 灰名單更新。';
$MusselConfig['lang']['image']='圖像';
$MusselConfig['lang']['instance_already_active']='腳本已激活！請仔細檢查您的鉤子。';
$MusselConfig['lang']['invalid_file']='無效文件';
$MusselConfig['lang']['ok']='好';
$MusselConfig['lang']['only_allow_images']='上傳文件以外圖片不允許';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel關閉。';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel已關閉。';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel激活。';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel已激活。';
$MusselConfig['lang']['recursive']='遞歸深度超過是限制';
$MusselConfig['lang']['refer_to_scan_kills']=' （參考'.$MusselConfig['general']['scan_kills'].'詳細信息）';
$MusselConfig['lang']['required_variables_not_defined']='需要的變量是未定義：無法繼續。';
$MusselConfig['lang']['scan_aborted']='掃描中止';
$MusselConfig['lang']['scan_chameleon']='{x}变色龙攻击检测';
$MusselConfig['lang']['scan_checking']='檢查';
$MusselConfig['lang']['scan_checking_contents']='成功了！在進行檢查的內容。';
$MusselConfig['lang']['scan_command_injection']='命令注入嘗試檢測';
$MusselConfig['lang']['scan_complete']='完成';
$MusselConfig['lang']['scan_extensions_missing']='失败（失踪必需的扩展）！';
$MusselConfig['lang']['scan_filename_manipulation_detected']='文件名操控檢測';
$MusselConfig['lang']['scan_map_corrupted']='簽名地圖是損壞';
$MusselConfig['lang']['scan_map_missing']='簽名地圖是失踪';
$MusselConfig['lang']['scan_missing_filename']='文件名是失踪';
$MusselConfig['lang']['scan_not_archive']='失敗（空或不是存檔）！';
$MusselConfig['lang']['scan_no_problems_found']='沒有任何問題發現。';
$MusselConfig['lang']['scan_reading']='閱讀';
$MusselConfig['lang']['scan_signature_file_corrupted']='簽名文件是損壞';
$MusselConfig['lang']['scan_signature_file_missing']='簽名文件是失踪';
$MusselConfig['lang']['scan_tampering']='檢測潛在的危險文件篡改';
$MusselConfig['lang']['scan_unauthorised_upload']='未經授權的文件上傳操控是檢測';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='未經授權的文件上傳操控或配置錯誤是檢測！';
$MusselConfig['lang']['started']='開始';
$MusselConfig['lang']['update_']='phpMussel現在將嘗試進行自我更新。';
$MusselConfig['lang']['update_available']='編程更新可用。';
$MusselConfig['lang']['update_complete']='更新檢查成功完成。';
$MusselConfig['lang']['update_created']='創建';
$MusselConfig['lang']['update_deleted']='刪除';
$MusselConfig['lang']['update_err1']='更新失敗：“update.dat”失踪。重新安裝或手動更新。';
$MusselConfig['lang']['update_err2']='更新失敗：“update.dat”不包含任何有效的更新源。請手動更新。';
$MusselConfig['lang']['update_err3']='潛力黑客或偽造品是檢測在更新命令提供通過更新來源；源可能是妥協。請通知編程作者。手動更新是推薦。';
$MusselConfig['lang']['update_err4']='哈希碼失踪！';
$MusselConfig['lang']['update_err5']='數據失踪！';
$MusselConfig['lang']['update_err6']='數據損壞！';
$MusselConfig['lang']['update_err7']='哈希碼損壞！';
$MusselConfig['lang']['update_failed']='失敗。';
$MusselConfig['lang']['update_fetch']='試圖獲取版本數據從';
$MusselConfig['lang']['update_lock_detected']='更新鎖檢測：無法繼續。檢查是否有損壞的更新或稍後再試。';
$MusselConfig['lang']['update_not']='不{x}';
$MusselConfig['lang']['update_not_available']='沒有可用編程更新這個時。';
$MusselConfig['lang']['update_not_possible']='編程更新是可用的，但它不能完全更新使用此版本的更新編程。請手動更新。';
$MusselConfig['lang']['update_no_source']='phpMussel失敗自我更新因為無法連接至有效的更新源。手動更新是推薦。';
$MusselConfig['lang']['update_patched']='修訂';
$MusselConfig['lang']['update_scriptfile_missing']='更新編程文件是失踪！請重新安裝phpMussel。';
$MusselConfig['lang']['update_seconds_elapsed']='秒過去';
$MusselConfig['lang']['update_signatures_available']='簽名更新是可用的。';
$MusselConfig['lang']['update_signatures_latest']='最新簽名';
$MusselConfig['lang']['update_signatures_not_available']='沒有簽名更新可用這個時。';
$MusselConfig['lang']['update_signatures_yours']='您的簽名';
$MusselConfig['lang']['update_success']='成功了。';
$MusselConfig['lang']['update_successfully']='成功了';
$MusselConfig['lang']['update_version_latest']='最新編程版本';
$MusselConfig['lang']['update_version_yours']='您的編程版本';
$MusselConfig['lang']['update_was']='是{x}';
$MusselConfig['lang']['update_wrd1']='簽名';
$MusselConfig['lang']['upload_error_1']='文件大小超過MAX_FILE_SIZE指令。';
$MusselConfig['lang']['upload_error_2']='文件大小超过文件大小限制指定由文件上傳信息。';
$MusselConfig['lang']['upload_error_34']='上傳失敗！請聯繫網站管理員或網站託管服務！';
$MusselConfig['lang']['upload_error_6']='上傳文件夾是失踪！請聯繫網站管理員或網站託管服務！';
$MusselConfig['lang']['upload_error_7']='硬盤寫入錯誤！請聯繫網站管理員或網站託管服務！';
$MusselConfig['lang']['upload_error_8']='PHP配置錯誤是檢測！請聯繫網站管理員或網站託管服務！';
$MusselConfig['lang']['upload_limit_exceeded']='超過上傳限制';
$MusselConfig['lang']['wrong_password']='密碼錯誤；行動拒絕。';
$MusselConfig['lang']['x_does_not_exist']='不存在';

?>