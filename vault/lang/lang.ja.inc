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
 This File: phpMussel Japanese/日本語 Language Data (7th June 2015).
 <%phpMussel%/vault/lang/lang.ja.inc> **INCOMPLETE!!!**

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['cli_commands']=" q\n - Quit CLI.\n - Aliases: quit, exit.\n md5_file\n - Generate MD5 signatures from files [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generate MD5 signature from string [Syntax: md5 string].\n hex_encode\n - Convert binary string to hexadecimal [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Convert hexadecimal to binary string [Syntax: hex_decode string].\n base64_encode\n - Convert binary string to base64 string [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Convert base64 string to binary string [Syntax: base64_decode string].\n scan\n - Scan file or directory [Syntax: scan filename].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n c\n - Print this command list.\n";
$MusselConfig['lang']['cli_failed_to_complete']='スキャンプロセス完了できませんでした';
$MusselConfig['lang']['cli_is_not_a']='ファイルまたはディレクトリはありません。';
$MusselConfig['lang']['cli_ln2']=" phpMusselをご利用いただきありがとうございます！PHPスクリプトがために設計されています：検出のトロイの木馬、ウイルス、マルウェア、やその他の脅威、\n （どこファイルがシステムにアップロードされました、どこスクリプトが接続されました）。 ClamAV署名や他人に基づいています。\n\n PHPMUSSEL 著作権 2013 や以降です、GNU/GPLv2です、カレブによって作成（Maikuolan）。\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" phpMusselは、現在のCLIモード（コマンドラインインターフェース）で動作しています。\n\n ファイルまたはディレクトリをスキャンするには, 入力「scan」してください。, followed by the name of the file or\n directory that you want phpMussel to scan and press Enter; Type 'c' and press\n Enter for a list of CLI mode commands; Type 'q' and press Enter to quit:";
$MusselConfig['lang']['cli_update_restart']=' アップデートが明らかになるためには、再起動phpMusselが必要な場合があります。';
$MusselConfig['lang']['cli_working']='進行中';
$MusselConfig['lang']['corrupted']='検出されたPEが破損しました';
$MusselConfig['lang']['denied']='アップロード拒否されました！';
$MusselConfig['lang']['denied_other']='Upload Denied! Télécharger Refusé! Carga Negado! Carica Negato! Upload verweigert! 上载是否认! 上載是否認! Uppladda Nekas! Загрузить Отказано! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='アップロードは次の原因で拒否されました / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='検出された{vn}';
$MusselConfig['lang']['detected_control_characters']='検出された制御文字';
$MusselConfig['lang']['failed_to_access']='アクセスに失敗しました';
$MusselConfig['lang']['file']='ファイル';
$MusselConfig['lang']['filesize_limit_exceeded']='ファイルサイズリミットを超えました';
$MusselConfig['lang']['filetype_blacklisted']='ファイルタイプはブラックリストに掲載されています';
$MusselConfig['lang']['finished']='終了しました';
$MusselConfig['lang']['generated_by']='によって搭載しました';
$MusselConfig['lang']['greylist_cleared']=' グレーリストがクリアされました。';
$MusselConfig['lang']['greylist_updated']=' グレーリストがアップデートされました。';
$MusselConfig['lang']['image']='画像';
$MusselConfig['lang']['invalid_file']='無効なファイル';
$MusselConfig['lang']['ok']='大丈夫です';
$MusselConfig['lang']['only_allow_images']='画像以外のファイルアップロードは許可されません';
$MusselConfig['lang']['recursive']='再帰深さリミットを超えました';
$MusselConfig['lang']['refer_to_scan_kills']=' （詳細については、「'.$MusselConfig['general']['scan_kills'].'」を参照してください）';
$MusselConfig['lang']['scan_aborted']='スキャンは中断されました';
$MusselConfig['lang']['scan_chameleon']='検出された{x}カメレオン攻撃';
$MusselConfig['lang']['scan_checking']='検証は進行中';
$MusselConfig['lang']['scan_checking_contents']='成功！内容を確認します。';
$MusselConfig['lang']['scan_command_injection']='コマンドインジェクションの試みが検出されました';
$MusselConfig['lang']['scan_complete']='完成しました';
$MusselConfig['lang']['scan_extensions_missing']='失敗しました（必要な拡張機能が欠落しています）！';
$MusselConfig['lang']['scan_filename_manipulation_detected']='検出されたファイル名改ざん';
$MusselConfig['lang']['scan_map_corrupted']='署名地図が破損しました';
$MusselConfig['lang']['scan_map_missing']='署名地図はありません';
$MusselConfig['lang']['scan_missing_filename']='ファイル名はありません';
$MusselConfig['lang']['scan_not_archive']='失敗しました（空です、または、アーカイブではありません）！';
$MusselConfig['lang']['scan_no_problems_found']='問題は見つかりませんでした。';
$MusselConfig['lang']['scan_reading']='読んでいます';
$MusselConfig['lang']['scan_signature_file_corrupted']='署名ファイルが破損しました';
$MusselConfig['lang']['scan_signature_file_missing']='署名ファイルはありません';
$MusselConfig['lang']['scan_unauthorised_upload']='不正ファイルアップロード改ざんが検出されました';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='不正ファイルアップロード改ざんまたはミスコンフィギュレーションが検出されました！';
$MusselConfig['lang']['started']='開始しました';
$MusselConfig['lang']['update_']='phpMusselは現在、自身をアップデートしようとします。';
$MusselConfig['lang']['update_available']='スクリプトアップデートが利用可能です。';
$MusselConfig['lang']['update_complete']='アップロードチェックは成功しました。';
$MusselConfig['lang']['update_created']='作成';
$MusselConfig['lang']['update_deleted']='削除';
$MusselConfig['lang']['update_err1']='アップデートに失敗しました：「update.dat」はありません。再インストールします、または手動でのアップデート、お願いします。';
$MusselConfig['lang']['update_err2']='アップデートに失敗しました：「update.dat」は有効なアップデート元が含ましていません。手動でのアップデート、お願いします。';
$MusselConfig['lang']['update_err3']='アップデート元により供給されました、アップデート手順で、疑わハックや偽造が検出されました；元が潜在的に危険にさらさ。スクリプトの作成者に通知ください、お願いします。手動でのアップデートは推奨されます。';
$MusselConfig['lang']['update_err4']='チェックサムはありません！';
$MusselConfig['lang']['update_err5']='データはありません！';
$MusselConfig['lang']['update_err6']='データ悪いです！';
$MusselConfig['lang']['update_err7']='チェックサム悪いです！';
$MusselConfig['lang']['update_failed']='失敗しました。';
$MusselConfig['lang']['update_fetch']='バージョン情報が取得されますから';
$MusselConfig['lang']['update_not']='{x}されませんでした';
$MusselConfig['lang']['update_not_available']='現時点では、スクリプトアップデートが利用できません。';
$MusselConfig['lang']['update_not_possible']='スクリプトアップデートが利用可能です、しかし、アップデートスクリプトのこのバージョンから、それは完全にアップデートができません。手動でのアップデート、お願いします。';
$MusselConfig['lang']['update_no_source']='phpMusselは、有効なアップデート元に接続できなかったため、自身のアップデートに失敗しました。手動でのアップデートは推奨されます。';
$MusselConfig['lang']['update_patched']='パッチ';
$MusselConfig['lang']['update_scriptfile_missing']=' アップデートスクリプトファイルはありません！「phpMussel」再インストールします、お願いします。';
$MusselConfig['lang']['update_seconds_elapsed']='秒が経過しました';
$MusselConfig['lang']['update_signatures_available']='署名アップデートが利用可能です。';
$MusselConfig['lang']['update_signatures_latest']='最新の署名';
$MusselConfig['lang']['update_signatures_not_available']='現時点では、署名アップデートが利用できません。';
$MusselConfig['lang']['update_signatures_yours']='あなたの署名';
$MusselConfig['lang']['update_success']='成功。';
$MusselConfig['lang']['update_successfully']='成功';
$MusselConfig['lang']['update_version_latest']='最新のスクリプト·バージョン';
$MusselConfig['lang']['update_version_yours']='あなたのスクリプト·バージョン';
$MusselConfig['lang']['update_was']='{x}しました';
$MusselConfig['lang']['update_wrd1']='署名';
$MusselConfig['lang']['upload_error_1']='ファイルサイズは、「MAX_FILE_SIZE」ディレクティブを超えています。';
$MusselConfig['lang']['upload_error_2']='ファイルサイズは、フォーム指定ファイルサイズの上限を超えています。';
$MusselConfig['lang']['upload_error_34']='アップロードの失敗！支援のためのホストマスタに連絡してください！';
$MusselConfig['lang']['upload_error_6']='アップロードのディレクトリが存在しません！支援のためのホストマスタに連絡してください！';
$MusselConfig['lang']['upload_error_7']='ディスク書き込みエラー！支援のためのホストマスタに連絡してください！';
$MusselConfig['lang']['upload_error_8']='PHPミスコンフィギュレーションを検出しました！支援のためのホストマスタに連絡してください！';
$MusselConfig['lang']['upload_limit_exceeded']='アップロードリミットを超えました';
$MusselConfig['lang']['wrong_password']='間違ったパスワード; アクション拒否されました。';
$MusselConfig['lang']['x_does_not_exist']='が存在しません';

?>