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
 This File: phpMussel Japanese/日本語 Language Data (4th June 2015).
 <%phpMussel%/vault/lang/lang.ja.inc> **INCOMPLETE!!!**

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['cli_commands']=" q\n - Quit CLI.\n - Aliases: quit, exit.\n md5_file\n - Generate MD5 signatures from files [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generate MD5 signature from string [Syntax: md5 string].\n hex_encode\n - Convert binary string to hexadecimal [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Convert hexadecimal to binary string [Syntax: hex_decode string].\n base64_encode\n - Convert binary string to base64 string [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Convert base64 string to binary string [Syntax: base64_decode string].\n scan\n - Scan file or directory [Syntax: scan filename].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n c\n - Print this command list.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Failed to complete scanning process';
$MusselConfig['lang']['cli_is_not_a']='ファイルまたはディレクトリはありません。';
$MusselConfig['lang']['cli_ln2']=" Thank you for using phpMussel, a PHP script designed to detect trojans,\n viruses, malware and other threats within files uploaded to your system\n wherever the script is hooked, based on the signatures of ClamAV and others.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Currently running phpMussel in CLI mode (Command line interface).\n\n To scan a file or directory, type 'scan', followed by the name of the file or\n directory that you want phpMussel to scan and press Enter; Type 'c' and press\n Enter for a list of CLI mode commands; Type 'q' and press Enter to quit:";
$MusselConfig['lang']['cli_update_restart']=' Restarting phpMussel may be required before updates become apparent.';
$MusselConfig['lang']['cli_working']='進行中';
$MusselConfig['lang']['corrupted']='破損したPEが検出されました';
$MusselConfig['lang']['denied']='アップロード拒否されました！';
$MusselConfig['lang']['denied_other']='Upload Denied! Télécharger Refusé! Carga Negado! Carica Negato! Upload verweigert! 上载是否认! 上載是否認! Uppladda Nekas! Загрузить Отказано! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='アップロードは次の原因で拒否されました / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='{vn}を検出しました';
$MusselConfig['lang']['detected_control_characters']='検出された制御文字';
$MusselConfig['lang']['failed_to_access']='Failed to access ';
$MusselConfig['lang']['file']='ファイル';
$MusselConfig['lang']['filesize_limit_exceeded']='ファイルサイズの制限を超えました';
$MusselConfig['lang']['filetype_blacklisted']='ファイルタイプはブラックリストに掲載されています';
$MusselConfig['lang']['finished']='終了しました';
$MusselConfig['lang']['generated_by']='搭載：';
$MusselConfig['lang']['greylist_cleared']=' Greylist cleared.';
$MusselConfig['lang']['greylist_updated']=' Greylist updated.';
$MusselConfig['lang']['image']='画像';
$MusselConfig['lang']['invalid_file']='無効なファイル';
$MusselConfig['lang']['ok']='大丈夫です';
$MusselConfig['lang']['only_allow_images']='画像以外のファイルのアップロードは許可されません';
$MusselConfig['lang']['recursive']='Recursion depth limit exceeded';
$MusselConfig['lang']['refer_to_scan_kills']=' （詳細については、「'.$MusselConfig['general']['scan_kills'].'」を参照してください）';
$MusselConfig['lang']['scan_aborted']='Scanning aborted';
$MusselConfig['lang']['scan_chameleon']='検出された{x}カメレオン攻撃';
$MusselConfig['lang']['scan_checking']='Checking';
$MusselConfig['lang']['scan_checking_contents']='成功！内容を確認します。';
$MusselConfig['lang']['scan_command_injection']='Command injection attempt detected';
$MusselConfig['lang']['scan_complete']='Complete';
$MusselConfig['lang']['scan_extensions_missing']='失敗しました（必要な拡張機能が欠落しています）！';
$MusselConfig['lang']['scan_filename_manipulation_detected']='ファイル名 manipulation detected';
$MusselConfig['lang']['scan_map_corrupted']='Signature map corrupted';
$MusselConfig['lang']['scan_map_missing']='Signature map missing';
$MusselConfig['lang']['scan_missing_filename']='ファイル名はありません';
$MusselConfig['lang']['scan_not_archive']='失敗しました（空です、または、アーカイブではありません）！';
$MusselConfig['lang']['scan_no_problems_found']='問題は見つかりませんでした。';
$MusselConfig['lang']['scan_reading']='Reading';
$MusselConfig['lang']['scan_signature_file_corrupted']='Signature file corrupted';
$MusselConfig['lang']['scan_signature_file_missing']='Signature file missing';
$MusselConfig['lang']['scan_unauthorised_upload']='Unauthorised file upload manipulation detected';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Unauthorised file upload manipulation or misconfiguration detected! ';
$MusselConfig['lang']['started']='Started';
$MusselConfig['lang']['update_']='phpMussel will now attempt to update itself.';
$MusselConfig['lang']['update_available']='A script update is available.';
$MusselConfig['lang']['update_complete']='Update check completed successfully.';
$MusselConfig['lang']['update_created']='created';
$MusselConfig['lang']['update_deleted']='deleted';
$MusselConfig['lang']['update_err1']='Failed to update: \'update.dat\' missing. Reinstall or update manually.';
$MusselConfig['lang']['update_err2']='Failed to update: \'update.dat\' does not contain any valid update sources. Please update manually.';
$MusselConfig['lang']['update_err3']='Possible hack or forgery detected in the update instructions supplied by the update source; Source may possibly be compromised. Please notify the script author. Updating manually is recommended.';
$MusselConfig['lang']['update_err4']='チェックサムはありません！';
$MusselConfig['lang']['update_err5']='データはありません！';
$MusselConfig['lang']['update_err6']='データ悪いです！';
$MusselConfig['lang']['update_err7']='チェックサム悪いです！';
$MusselConfig['lang']['update_failed']='失敗しました。';
$MusselConfig['lang']['update_fetch']='Attempting to fetch version data from';
$MusselConfig['lang']['update_not']='{x}されませんでした';
$MusselConfig['lang']['update_not_available']='No script update is available at this time.';
$MusselConfig['lang']['update_not_possible']='A script update is available, but can\'t be fully updated with this version of the update script. Please update manually.';
$MusselConfig['lang']['update_no_source']='phpMussel has failed to update itself because it could not connect to a valid update source. Updating manually is recommended.';
$MusselConfig['lang']['update_patched']='patched';
$MusselConfig['lang']['update_scriptfile_missing']=' Update script file missing! Please reinstall phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']='秒が経過しました';
$MusselConfig['lang']['update_signatures_available']='A signatures update is available.';
$MusselConfig['lang']['update_signatures_latest']='最新の署名';
$MusselConfig['lang']['update_signatures_not_available']='No signatures update is available at this time.';
$MusselConfig['lang']['update_signatures_yours']='あなたの署名';
$MusselConfig['lang']['update_success']='成功。';
$MusselConfig['lang']['update_successfully']='成功';
$MusselConfig['lang']['update_version_latest']='最新のスクリプト·バージョン';
$MusselConfig['lang']['update_version_yours']='あなたのスクリプト·バージョン';
$MusselConfig['lang']['update_was']='{x}しました';
$MusselConfig['lang']['update_wrd1']='署名';
$MusselConfig['lang']['upload_error_1']='ファイルサイズは、「MAX_FILE_SIZE」ディレクティブを超えています。';
$MusselConfig['lang']['upload_error_2']='ファイルサイズは、フォーム指定ファイルサイズの上限を超えています。';
$MusselConfig['lang']['upload_error_34']='アップロードの失敗！支援のためのホストマスタに連絡してください！ ';
$MusselConfig['lang']['upload_error_6']='アップロードのディレクトリが存在しません！支援のためのホストマスタに連絡してください！ ';
$MusselConfig['lang']['upload_error_7']='ディスク書き込みエラー！支援のためのホストマスタに連絡してください！ ';
$MusselConfig['lang']['upload_error_8']='PHPミスコンフィギュレーションを検出しました！支援のためのホストマスタに連絡してください！ ';
$MusselConfig['lang']['upload_limit_exceeded']='アップロード制限を超えました';
$MusselConfig['lang']['wrong_password']='間違ったパスワード; アクション拒否されました。';
$MusselConfig['lang']['x_does_not_exist']='が存在しません';

?>