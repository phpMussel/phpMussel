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
 * This file: Chinese (traditional) language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = '我不明白的命令，​對不起。';
$phpMussel['lang']['cli_failed_to_complete'] = '完成掃描過程失敗';
$phpMussel['lang']['cli_is_not_a'] = '不是文件或文件夾。';
$phpMussel['lang']['cli_ln2'] = " 謝謝對於使用phpMussel，​一個PHP腳本旨在檢測木馬，​病毒，​惡意軟件，​和其他威脅在文件上傳到您的系統隨地這個腳本是叫，​\n 根據ClamAV的簽名和其他簽名。\n\n PHPMUSSEL版權2013和此後GNU/GPLv.2通過Caleb M （Maikuolan）。\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " 目前經營phpMussel在CLI模式（命令行界面）。\n\n 掃描一個文件或文件夾，​鍵入『scan』，​其次是名的文件或文件夾您想phpMussel掃描然後按Enter鍵；\n 鍵入『c』然後按Enter鍵對於CLI模式命令名單；鍵入『q』然後按Enter鍵對於戒菸：";
$phpMussel['lang']['cli_pe1'] = '不PE文件！';
$phpMussel['lang']['cli_pe2'] = 'PE部分:';
$phpMussel['lang']['cli_signature_placeholder'] = '簽名名稱';
$phpMussel['lang']['cli_working'] = '進行中';
$phpMussel['lang']['corrupted'] = '檢測損壞PE';
$phpMussel['lang']['data_not_available'] = '數據不可用。';
$phpMussel['lang']['denied'] = '上傳是否認！';
$phpMussel['lang']['denied_reason'] = '您的上傳被拒绝由于这些原因:';
$phpMussel['lang']['detected'] = '檢測{vn}';
$phpMussel['lang']['detected_control_characters'] = '檢測控製字符';
$phpMussel['lang']['encrypted_archive'] = '檢測加密檔案文件; 加密檔案文件不允許';
$phpMussel['lang']['failed_to_access'] = '無法訪問';
$phpMussel['lang']['file'] = '文件';
$phpMussel['lang']['filesize_limit_exceeded'] = '文件大小超過限制';
$phpMussel['lang']['filetype_blacklisted'] = '文件類型列入黑名單';
$phpMussel['lang']['finished'] = '完了';
$phpMussel['lang']['generated_by'] = '所產生通過';
$phpMussel['lang']['greylist_cleared'] = ' 灰名單清空。';
$phpMussel['lang']['greylist_not_updated'] = ' 灰名單不更新。';
$phpMussel['lang']['greylist_updated'] = ' 灰名單更新。';
$phpMussel['lang']['image'] = '圖像';
$phpMussel['lang']['instance_already_active'] = '腳本已激活！​請仔細檢查您的鉤子。';
$phpMussel['lang']['invalid_data'] = '無效數據！';
$phpMussel['lang']['invalid_file'] = '無效的文件';
$phpMussel['lang']['invalid_url'] = '無效的網址！';
$phpMussel['lang']['ok'] = '好';
$phpMussel['lang']['only_allow_images'] = '上傳文件以外圖片不允許';
$phpMussel['lang']['plugins_directory_nonexistent'] = '插件文件夾不存在！';
$phpMussel['lang']['quarantined_as'] = "隔離為『/vault/quarantine/{QFU}.qfu』。\n";
$phpMussel['lang']['recursive'] = '遞歸深度超過是限制';
$phpMussel['lang']['required_variables_not_defined'] = '需要的變量是未定義：無法繼續。';
$phpMussel['lang']['SafeBrowseLookup_200'] = '可能有害的URL檢測';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API請求錯誤';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API授權錯誤';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API服務不可用';
$phpMussel['lang']['SafeBrowseLookup_999'] = '未知API錯誤';
$phpMussel['lang']['scan_aborted'] = '掃描中止！';
$phpMussel['lang']['scan_chameleon'] = '{x}变色龙攻击检测';
$phpMussel['lang']['scan_checking'] = '檢查';
$phpMussel['lang']['scan_checking_contents'] = '成功了！​在進行檢查的內容。';
$phpMussel['lang']['scan_command_injection'] = '命令注入嘗試檢測';
$phpMussel['lang']['scan_complete'] = '完成';
$phpMussel['lang']['scan_extensions_missing'] = '失败（失踪必需的扩展）！';
$phpMussel['lang']['scan_filename_manipulation_detected'] = '文件名操控檢測';
$phpMussel['lang']['scan_missing_filename'] = '文件名是失踪';
$phpMussel['lang']['scan_not_archive'] = '失敗（空或不是存檔）！';
$phpMussel['lang']['scan_no_problems_found'] = '沒有任何問題發現。';
$phpMussel['lang']['scan_reading'] = '閱讀';
$phpMussel['lang']['scan_signature_file_corrupted'] = '簽名文件是損壞';
$phpMussel['lang']['scan_signature_file_missing'] = '簽名文件是失踪';
$phpMussel['lang']['scan_tampering'] = '檢測潛在的危險文件篡改';
$phpMussel['lang']['scan_unauthorised_upload'] = '未經授權的文件上傳操控是檢測';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = '未經授權的文件上傳操控或配置錯誤是檢測！';
$phpMussel['lang']['started'] = '開始';
$phpMussel['lang']['too_many_urls'] = '太多的URL';
$phpMussel['lang']['upload_error_1'] = '文件大小超過upload_max_filesize指令。';
$phpMussel['lang']['upload_error_2'] = '文件大小超过文件大小限制指定由文件上傳信息。';
$phpMussel['lang']['upload_error_34'] = '上傳失敗！​請聯繫網站管理員或網站託管服務！';
$phpMussel['lang']['upload_error_6'] = '上傳文件夾是失踪！​請聯繫網站管理員或網站託管服務！';
$phpMussel['lang']['upload_error_7'] = '硬盤寫入錯誤！​請聯繫網站管理員或網站託管服務！';
$phpMussel['lang']['upload_error_8'] = 'PHP配置錯誤是檢測！​請聯繫網站管理員或網站託管服務！';
$phpMussel['lang']['upload_limit_exceeded'] = '超過上傳限制';
$phpMussel['lang']['wrong_password'] = '密碼錯誤；行動拒絕。';
$phpMussel['lang']['x_does_not_exist'] = '不存在';
$phpMussel['lang']['_exclamation'] = '！';
$phpMussel['lang']['_exclamation_final'] = '！';
$phpMussel['lang']['_fullstop'] = '。';
$phpMussel['lang']['_fullstop_final'] = '。';

$phpMussel['lang']['cli_commands'] = " q
 - 戒菸CLI模式。
 - 別名：quit，​exit。
 md5_file
 - 生成MD5簽名從文件​[語法：md5_file 文件名]。
 - 別名：m。
 sha1_file
 - 生成SHA1簽名從文件​[語法：sha1_file 文件名]。
 md5
 - 生成MD5簽名從數據​[語法：md5 數據]。
 sha1
 - 生成SHA1簽名從數據​[語法：sha1 數據]。
 hex_encode
 - 兌換從二進制數據至十六進制​[語法：hex_encode 數據]。
 - 別名：x。
 hex_decode
 - 兌換從十六進制二進制數據至​[語法：hex_decode 數據]。
 base64_encode
 - 兌換從二進制數據至基地64數據​[語法：base64_encode 數據]。
 - 別名：b。
 base64_decode
 - 兌換從基地64數據至二進制數據​[語法：base64_decode 數據]。
 pe_meta
 - 從PE文件中提取元數據​[語法：pe_meta 文件名]。
 url_sig
 - 生成URL掃描器簽名​[語法：url_sig 數據]。
 scan
 - 掃描文件或文件夾​[語法：scan 文件名]。
 - 別名：s。
 c
 - 打印此命令列表。
";
