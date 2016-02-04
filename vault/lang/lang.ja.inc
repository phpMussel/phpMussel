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
 This file: phpMussel Japanese/日本語 language data (4th February 2016).
 <%phpMussel%/vault/lang/lang.ja.inc>

*/

/**
 * phpMussel: A PHP script designed to detect trojans, viruses, malware and other threats within files uploaded to your
 * system wherever the script is hooked, based on the signatures of ClamAV and others.
 *
 * This file: Japanese language data for phpMussel.
 *
 * PO/POT version of this file is available via: https://github.com/Maikuolan/phpMussel-extras/blob/master/PO/phpMussel-ja.po
 *
 * @package Maikuolan/phpMussel
 */

/**
 * Prevents execution from outside of phpMussel.
 */
if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='すみませんが、コマンドが理解できません。';
$MusselConfig['lang']['cli_commands']=" q\n - CLI終了。\n - エイリアス：quit，exit。\n md5_file\n - ファイルからMD5署名を作成 「構文: md5_file ファイル名」。\n - エイリアス： m。\n md5\n - 文字列からMD5署名を作成 「構文: md5 string」。\n hex_encode\n - ２進法文字列を１６進法文字列に変換 「構文: hex_encode string」。\n - エイリアス： x。\n hex_decode\n - １６進法文字列を２進法文字列に変換 「構文: hex_decode string」。\n base64_encode\n - ２進法文字列をBASE６４文字列に変換 「構文: base64_encode string」。\n - エイリアス： b。\n base64_decode\n - BASE６４文字列を２進法文字列に変換 「構文: base64_decode string」。\n scan\n - ファイルまたはディレクトリをスキャン 「構文: scan ファイル名」。\n - エイリアス：s。\n update\n - phpMusselをアップデート。\n - エイリアス： u。\n c\n - コマンドリストをプリント。\n";
$MusselConfig['lang']['cli_failed_to_complete']='スキャンを完了できませんでした';
$MusselConfig['lang']['cli_is_not_a']='はファイルでもディレクトリでもありません。';
$MusselConfig['lang']['cli_ln2']=" phpMussel（ピー・エイチ・ピー・マッスル）のご愛顧に感謝します。phpMusselは、トロイの木馬型をはじめ、\n各種ウィルス、マルウェアがアップロードファイルからシステムに侵入しようとするのを検知するよう設計されたPHPスクリプトです。\n\nClamAVやその他の署名に基づきシステム内のどこに配置されても機能します。PHPMUSSEL2013以降の著作権は全てCaleb M (Maikuolan)氏によるGNU/GPLv2 に帰属します。\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" CLIモード（コマンドラインインターフェイス）でphpMusselを実行中です。\n\n ファイルまたはディレクトリ―をスキャンするには、’スキャン’とタイプし、続けてファイル名\n またはディレクトリ名をタイプしてエンターを押して下さい。\n CLIモードコマンドのリストを得るには’c’とタイプしてエンターを押して下さい；終了には'q'とタイプしてエンターを押します。 　";
$MusselConfig['lang']['cli_pe1']='正しいPEファイルではありません！';
$MusselConfig['lang']['cli_pe2']='PEセクション：';
$MusselConfig['lang']['cli_update_restart']=' アップデートを有効にするためにはphpMusselを再スタートする必要があるかもしれません。';
$MusselConfig['lang']['cli_working']='処理中';
$MusselConfig['lang']['controls_lockout']='phpMusselコントロールロックアウトが有効です。'
$MusselConfig['lang']['core_scriptfile_missing']='重要なスクリプトファイルがありません。phpMusselを再インストールして下さい。';
$MusselConfig['lang']['corrupted']='破損PEを検出しました';
$MusselConfig['lang']['denied']='アップロード拒否！';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$MusselConfig['lang']['denied_reason']='以下の理由でアップロードは拒否されました / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='{vn}を検出しました';
$MusselConfig['lang']['detected_control_characters']='制御文字を検出しました';
$MusselConfig['lang']['encrypted_archive']='暗号化されたアーカイブ検出：暗号化されたアーカイブは許可されていません';
$MusselConfig['lang']['failed_to_access']='アクセスに失敗しました';
$MusselConfig['lang']['file']='ファイル';
$MusselConfig['lang']['filesize_limit_exceeded']='容範囲外ファイルサイズです';
$MusselConfig['lang']['filetype_blacklisted']='ファイルタイプがブラックリスト記載です';
$MusselConfig['lang']['finished']='完了';
$MusselConfig['lang']['generated_by']='作成者';
$MusselConfig['lang']['greylist_cleared']=' グレーリストが解除されました';
$MusselConfig['lang']['greylist_not_updated']=' グレーリストがアップデートされていません';
$MusselConfig['lang']['greylist_updated']=' グレーリストがアップデートされました';
$MusselConfig['lang']['image']='画像';
$MusselConfig['lang']['instance_already_active']='インスタンスが既にアクティブです！フックを再確認して下さい。';
$MusselConfig['lang']['invalid_file']='不正ファイル';
$MusselConfig['lang']['invalid_url']='不正URL！';
$MusselConfig['lang']['ok']='OKです';
$MusselConfig['lang']['only_allow_images']='画像以外のファイルをアップロードするのは許可されていません';
$MusselConfig['lang']['phpmussel_disabled']='phpMusselはオフです。';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMusselはすでにオフの状態です。';
$MusselConfig['lang']['phpmussel_enabled']='phpMusselはオンです。';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMusselは既にオンです。';
$MusselConfig['lang']['plugins_directory_nonexistent']='プラグインデイレクトリが存在しません！';
$MusselConfig['lang']['recursive']='再帰定義呼び出しの繰り返し回数が上限を超えました';
$MusselConfig['lang']['required_variables_not_defined']='リクエストのあった変数は定義されていないため、続行できません。';
$MusselConfig['lang']['scan_aborted']='スキャニング中断！';
$MusselConfig['lang']['scan_chameleon']='{x} Chameleon（カメレオン）攻撃が検出されました';
$MusselConfig['lang']['scan_checking']='チェック中';
$MusselConfig['lang']['scan_checking_contents']='成功！コンテンツをチェックしています。';
$MusselConfig['lang']['scan_command_injection']='コマンドインジェクション攻撃が検出されました';
$MusselConfig['lang']['scan_complete']='完了';
$MusselConfig['lang']['scan_extensions_missing']='失敗（要求のあった拡張子がありません）！';
$MusselConfig['lang']['scan_filename_manipulation_detected']='ファイルネイム不正操作が検出されました';
$MusselConfig['lang']['scan_map_corrupted']='署名マップが汚染されています';
$MusselConfig['lang']['scan_map_missing']='署名マップがありません';
$MusselConfig['lang']['scan_missing_filename']='ファイル名が存在しません';
$MusselConfig['lang']['scan_not_archive']='失敗（中身が存在しないかアーカイブではありません）！';
$MusselConfig['lang']['scan_no_problems_found']='問題は検出されませんでした。';
$MusselConfig['lang']['scan_reading']='読み込んでいます';
$MusselConfig['lang']['scan_signature_file_corrupted']='署名ファイルが汚染されています';
$MusselConfig['lang']['scan_signature_file_missing']='署名ファイルがありません';
$MusselConfig['lang']['scan_tampering']='検出された潜在的に危険なファイル改ざん';
$MusselConfig['lang']['scan_unauthorised_upload']='不正ファイルアップロード改ざんが検出されました';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='不正ファイルアップロード改ざんまたはミスコンフィギュレーションが検出されました！';
$MusselConfig['lang']['started']='開始しています';
$MusselConfig['lang']['too_many_urls']='URLが多すぎます';
$MusselConfig['lang']['update_']='phpMusselは自動アップデート中です。';
$MusselConfig['lang']['update_available']='スクリプトのアップデートが可能です。';
$MusselConfig['lang']['update_complete']='アップデートのチェックが完了しました。';
$MusselConfig['lang']['update_created']='作成';
$MusselConfig['lang']['update_deleted']='消去';
$MusselConfig['lang']['update_err1']='アップデート失敗： \'update.dat\'がありません。手動で再インストールして下さい。';
$MusselConfig['lang']['update_err2']='アップデート失敗： \'update.dat\'に有効なアップデートソースがありません。手動で再インストールして下さい。';
$MusselConfig['lang']['update_err3']='アップデート元が提供するアップデート指示がハックされたか偽造された疑いがあります。ソースがウィルス感染している恐れがあります。スクリプト作成者に連絡して下さい。手動でのアップデートを推奨します。';
$MusselConfig['lang']['update_err4']='チェックサムがありません！';
$MusselConfig['lang']['update_err5']='データがありません！!';
$MusselConfig['lang']['update_err6']='不正データです！';
$MusselConfig['lang']['update_err7']='不正チェックサムです！';
$MusselConfig['lang']['update_failed']='失敗しました。';
$MusselConfig['lang']['update_fetch']='{Location}からバージョン情報の取得を試みています。。。';
$MusselConfig['lang']['update_lock_detected']='アップデートロックが検出されたため、継続できません。破損したアップデートがないかチェックし、再度試みて下さい。';
$MusselConfig['lang']['update_not']='{x}に失敗しました';
$MusselConfig['lang']['update_not_available']='アップデート可能なスクリプトはありません。';
$MusselConfig['lang']['update_not_possible']='アップデート可能なスクリプトがありますが、このバージョンでは完全にはできません。手動でアップデートして下さい。';
$MusselConfig['lang']['update_no_source']='有効なアップデートソースに接続できなかったため、phpMusselは自動アップデートに失敗しました。手動でのアップデートを推奨します。';
$MusselConfig['lang']['update_patched']='パッチ';
$MusselConfig['lang']['update_scriptfile_missing']=' アップデートスクリプトファイルがありません。phpMusselを再インストールして下さい。';
$MusselConfig['lang']['update_seconds_elapsed']='秒経過';
$MusselConfig['lang']['update_signatures_available']='署名アップデートが可能です。';
$MusselConfig['lang']['update_signatures_latest']='署名最新版';
$MusselConfig['lang']['update_signatures_not_available']='現在署名アップデートはできません。';
$MusselConfig['lang']['update_signatures_yours']='あなたの署名';
$MusselConfig['lang']['update_success']='成功です。';
$MusselConfig['lang']['update_successfully']='　問題なく';
$MusselConfig['lang']['update_version_latest']='最新スクリプトバージョン';
$MusselConfig['lang']['update_version_yours']='あなたのスクリプトバージョン';
$MusselConfig['lang']['update_was']='{x}しました';
$MusselConfig['lang']['update_wrd1']='署名';
$MusselConfig['lang']['upload_error_1']='指示された最大アップロードファイルサイズを超えています。';
$MusselConfig['lang']['upload_error_2']='フォームのファイルサイズ上限を超えています。';
$MusselConfig['lang']['upload_error_34']='アップロード失敗！ホスト責任者に相談して下さい！';
$MusselConfig['lang']['upload_error_6']='アップロードディレクトリがありません！ホスト責任者に相談して下さい！';
$MusselConfig['lang']['upload_error_7']='ディスクに書き込めません！ホスト責任者に相談して下さい！';
$MusselConfig['lang']['upload_error_8']='不適切なPHP設定が検出されました！ホスト責任者に相談して下さい！';
$MusselConfig['lang']['upload_limit_exceeded']='アップロードの制限を超えています。';
$MusselConfig['lang']['wrong_password']='不正パスワード；アクションは否定されました。';
$MusselConfig['lang']['x_does_not_exist']='存在しません';
$MusselConfig['lang']['_exclamation']='！';
$MusselConfig['lang']['_exclamation_final']='！';
$MusselConfig['lang']['_fullstop']='。';
$MusselConfig['lang']['_fullstop_final']='。';
