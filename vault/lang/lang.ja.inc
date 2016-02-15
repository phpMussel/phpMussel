<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Japanese language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'すみませんが、コマンドが理解できません。';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - CLI終了。\n - エイリアス：quit，exit。\n md5_file\n - ファイルからMD5署名を作成 「構文: md5_file ファイル名」。\n - エイリアス： m。\n md5\n - 文字列からMD5署名を作成 「構文: md5 string」。\n hex_encode\n - ２進法文字列を１６進法文字列に変換 「構文: hex_encode string」。\n - エイリアス： x。\n hex_decode\n - １６進法文字列を２進法文字列に変換 「構文: hex_decode string」。\n base64_encode\n - ２進法文字列をBASE６４文字列に変換 「構文: base64_encode string」。\n - エイリアス： b。\n base64_decode\n - BASE６４文字列を２進法文字列に変換 「構文: base64_decode string」。\n scan\n - ファイルまたはディレクトリをスキャン 「構文: scan ファイル名」。\n - エイリアス：s。\n update\n - phpMusselをアップデート。\n - エイリアス： u。\n c\n - コマンドリストをプリント。\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'スキャンを完了できませんでした';
$phpMussel['Config']['lang']['cli_is_not_a'] = 'はファイルでもディレクトリでもありません。';
$phpMussel['Config']['lang']['cli_ln2'] = " phpMussel（ピー・エイチ・ピー・マッスル）のご愛顧に感謝します。phpMusselは、トロイの木馬型をはじめ、\n各種ウィルス、マルウェアがアップロードファイルからシステムに侵入しようとするのを検知するよう設計されたPHPスクリプトです。\n\nClamAVやその他の署名に基づきシステム内のどこに配置されても機能します。PHPMUSSEL2013以降の著作権は全てCaleb M (Maikuolan)氏によるGNU/GPLv2 に帰属します。\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " CLIモード（コマンドラインインターフェイス）でphpMusselを実行中です。\n\n ファイルまたはディレクトリ―をスキャンするには、’スキャン’とタイプし、続けてファイル名\n またはディレクトリ名をタイプしてエンターを押して下さい。\n CLIモードコマンドのリストを得るには’c’とタイプしてエンターを押して下さい；終了には'q'とタイプしてエンターを押します。 ";
$phpMussel['Config']['lang']['cli_pe1'] = '正しいPEファイルではありません！';
$phpMussel['Config']['lang']['cli_pe2'] = 'PEセクション：';
$phpMussel['Config']['lang']['cli_update_restart'] = ' アップデートを有効にするためにはphpMusselを再スタートする必要があるかもしれません。';
$phpMussel['Config']['lang']['cli_working'] = '処理中';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMusselコントロールロックアウトが有効です。'
$phpMussel['Config']['lang']['core_scriptfile_missing'] = '重要なスクリプトファイルがありません。phpMusselを再インストールして下さい。';
$phpMussel['Config']['lang']['corrupted'] = '破損PEを検出しました';
$phpMussel['Config']['lang']['denied'] = 'アップロード拒否！';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = '以下の理由でアップロードは拒否されました / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = '{vn}を検出しました';
$phpMussel['Config']['lang']['detected_control_characters'] = '制御文字を検出しました';
$phpMussel['Config']['lang']['encrypted_archive'] = '暗号化されたアーカイブ検出：暗号化されたアーカイブは許可されていません';
$phpMussel['Config']['lang']['failed_to_access'] = 'アクセスに失敗しました';
$phpMussel['Config']['lang']['file'] = 'ファイル';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = '容範囲外ファイルサイズです';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'ファイルタイプがブラックリスト記載です';
$phpMussel['Config']['lang']['finished'] = '完了';
$phpMussel['Config']['lang']['generated_by'] = '作成者';
$phpMussel['Config']['lang']['greylist_cleared'] = ' グレーリストが解除されました。';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' グレーリストがアップデートされていません。';
$phpMussel['Config']['lang']['greylist_updated'] = ' グレーリストがアップデートされました。';
$phpMussel['Config']['lang']['image'] = '画像';
$phpMussel['Config']['lang']['instance_already_active'] = 'インスタンスが既にアクティブです！フックを再確認して下さい。';
$phpMussel['Config']['lang']['invalid_file'] = '不正ファイル';
$phpMussel['Config']['lang']['invalid_url'] = '不正URL！';
$phpMussel['Config']['lang']['ok'] = 'OKです';
$phpMussel['Config']['lang']['only_allow_images'] = '画像以外のファイルをアップロードするのは許可されていません';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMusselはオフです。';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMusselはすでにオフの状態です。';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMusselはオンです。';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMusselは既にオンです。';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'プラグインデイレクトリが存在しません！';
$phpMussel['Config']['lang']['recursive'] = '再帰定義呼び出しの繰り返し回数が上限を超えました';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'リクエストのあった変数は定義されていないため、続行できません。';
$phpMussel['Config']['lang']['scan_aborted'] = 'スキャニング中断！';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x} Chameleon（カメレオン）攻撃が検出されました';
$phpMussel['Config']['lang']['scan_checking'] = 'チェック中';
$phpMussel['Config']['lang']['scan_checking_contents'] = '成功！コンテンツをチェックしています。';
$phpMussel['Config']['lang']['scan_command_injection'] = 'コマンドインジェクション攻撃が検出されました';
$phpMussel['Config']['lang']['scan_complete'] = '完了';
$phpMussel['Config']['lang']['scan_extensions_missing'] = '失敗（要求のあった拡張子がありません）！';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'ファイルネイム不正操作が検出されました';
$phpMussel['Config']['lang']['scan_map_corrupted'] = '署名マップが汚染されています';
$phpMussel['Config']['lang']['scan_map_missing'] = '署名マップがありません';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'ファイル名が存在しません';
$phpMussel['Config']['lang']['scan_not_archive'] = '失敗（中身が存在しないかアーカイブではありません）！';
$phpMussel['Config']['lang']['scan_no_problems_found'] = '問題は検出されませんでした。';
$phpMussel['Config']['lang']['scan_reading'] = '読み込んでいます';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = '署名ファイルが汚染されています';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = '署名ファイルがありません';
$phpMussel['Config']['lang']['scan_tampering'] = '検出された潜在的に危険なファイル改ざん';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = '不正ファイルアップロード改ざんが検出されました';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = '不正ファイルアップロード改ざんまたはミスコンフィギュレーションが検出されました！';
$phpMussel['Config']['lang']['started'] = '開始しています';
$phpMussel['Config']['lang']['too_many_urls'] = 'URLが多すぎます';
$phpMussel['Config']['lang']['update_'] = 'phpMusselは自動アップデート中です。';
$phpMussel['Config']['lang']['update_available'] = 'スクリプトのアップデートが可能です。';
$phpMussel['Config']['lang']['update_complete'] = 'アップデートのチェックが完了しました。';
$phpMussel['Config']['lang']['update_created'] = '作成';
$phpMussel['Config']['lang']['update_deleted'] = '消去';
$phpMussel['Config']['lang']['update_err1'] = 'アップデート失敗： \'update.dat\'がありません。手動で再インストールして下さい。';
$phpMussel['Config']['lang']['update_err2'] = 'アップデート失敗： \'update.dat\'に有効なアップデートソースがありません。手動で再インストールして下さい。';
$phpMussel['Config']['lang']['update_err3'] = 'アップデート元が提供するアップデート指示がハックされたか偽造された疑いがあります。ソースがウィルス感染している恐れがあります。スクリプト作成者に連絡して下さい。手動でのアップデートを推奨します。';
$phpMussel['Config']['lang']['update_err4'] = 'チェックサムがありません！';
$phpMussel['Config']['lang']['update_err5'] = 'データがありません！!';
$phpMussel['Config']['lang']['update_err6'] = '不正データです！';
$phpMussel['Config']['lang']['update_err7'] = '不正チェックサムです！';
$phpMussel['Config']['lang']['update_failed'] = '失敗しました。';
$phpMussel['Config']['lang']['update_fetch'] = '{Location}からバージョン情報の取得を試みています。。。';
$phpMussel['Config']['lang']['update_lock_detected'] = 'アップデートロックが検出されたため、継続できません。破損したアップデートがないかチェックし、再度試みて下さい。';
$phpMussel['Config']['lang']['update_not'] = '{x}に失敗しました';
$phpMussel['Config']['lang']['update_not_available'] = 'アップデート可能なスクリプトはありません。';
$phpMussel['Config']['lang']['update_not_possible'] = 'アップデート可能なスクリプトがありますが、このバージョンでは完全にはできません。手動でアップデートして下さい。';
$phpMussel['Config']['lang']['update_no_source'] = '有効なアップデートソースに接続できなかったため、phpMusselは自動アップデートに失敗しました。手動でのアップデートを推奨します。';
$phpMussel['Config']['lang']['update_patched'] = 'パッチ';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' アップデートスクリプトファイルがありません。phpMusselを再インストールして下さい。';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = '秒経過';
$phpMussel['Config']['lang']['update_signatures_available'] = '署名アップデートが可能です。';
$phpMussel['Config']['lang']['update_signatures_latest'] = '署名最新版';
$phpMussel['Config']['lang']['update_signatures_not_available'] = '現在署名アップデートはできません。';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'あなたの署名';
$phpMussel['Config']['lang']['update_success'] = '成功です。';
$phpMussel['Config']['lang']['update_successfully'] = '　問題なく';
$phpMussel['Config']['lang']['update_version_latest'] = '最新スクリプトバージョン';
$phpMussel['Config']['lang']['update_version_yours'] = 'あなたのスクリプトバージョン';
$phpMussel['Config']['lang']['update_was'] = '{x}しました';
$phpMussel['Config']['lang']['update_wrd1'] = '署名';
$phpMussel['Config']['lang']['upload_error_1'] = '指示された最大アップロードファイルサイズを超えています。';
$phpMussel['Config']['lang']['upload_error_2'] = 'フォームのファイルサイズ上限を超えています。';
$phpMussel['Config']['lang']['upload_error_34'] = 'アップロード失敗！ホスト責任者に相談して下さい！';
$phpMussel['Config']['lang']['upload_error_6'] = 'アップロードディレクトリがありません！ホスト責任者に相談して下さい！';
$phpMussel['Config']['lang']['upload_error_7'] = 'ディスクに書き込めません！ホスト責任者に相談して下さい！';
$phpMussel['Config']['lang']['upload_error_8'] = '不適切なPHP設定が検出されました！ホスト責任者に相談して下さい！';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'アップロードの制限を超えています。';
$phpMussel['Config']['lang']['wrong_password'] = '不正パスワード；アクションは否定されました。';
$phpMussel['Config']['lang']['x_does_not_exist'] = '存在しません';
$phpMussel['Config']['lang']['_exclamation'] = '！';
$phpMussel['Config']['lang']['_exclamation_final'] = '！';
$phpMussel['Config']['lang']['_fullstop'] = '。';
$phpMussel['Config']['lang']['_fullstop_final'] = '。';
