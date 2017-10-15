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
 * This file: Japanese language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'すみませんが、​コマンドが理解できません。';
$phpMussel['lang']['cli_failed_to_complete'] = 'スキャンを完了できませんでした';
$phpMussel['lang']['cli_is_not_a'] = 'はファイルでもディレクトリでもありません。';
$phpMussel['lang']['cli_ln2'] = " phpMussel（ピー・エイチ・ピー・マッスル）のご愛顧に感謝します。​phpMusselは、​トロイの木馬型をはじめ、​\n 各種ウィルス、​マルウェアがアップロードファイルからシステムに侵入しようとするのを検知するよう設計されたPHPスクリプトです。\n\n ClamAVやその他のシグネチャに基づきシステム内のどこに配置されても機能します。\n\n PHPMUSSEL著作権2013とGNU一般公衆ライセンスv2を超える権利について：​Caleb M (Maikuolan)著。\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " ＣＬＩモード（コマンドラインインターフェイス）でphpMusselを実行中です。\n\n ファイルまたはディレクトリ―をスキャンするには、​「scan」とタイプし、​続けてファイル名またはディレクトリ名をタイプしてエンターを押して下さい。\n ＣＬＩモードコマンドのリストを得るには「c」とタイプしてエンターを押して下さい；終了には「q」とタイプしてエンターを押します。";
$phpMussel['lang']['cli_pe1'] = '正しいＰＥファイルではありません！';
$phpMussel['lang']['cli_pe2'] = 'ＰＥセクション：';
$phpMussel['lang']['cli_signature_placeholder'] = 'シグネチャ名';
$phpMussel['lang']['cli_working'] = '処理中';
$phpMussel['lang']['corrupted'] = '破損ＰＥを検出しました';
$phpMussel['lang']['data_not_available'] = 'データは入手できません。';
$phpMussel['lang']['denied'] = 'アップロード拒否！';
$phpMussel['lang']['denied_reason'] = '以下の理由でアップロードは拒否されました：';
$phpMussel['lang']['detected'] = '{vn}を検出しました';
$phpMussel['lang']['detected_control_characters'] = '制御文字を検出しました';
$phpMussel['lang']['encrypted_archive'] = '暗号化されたアーカイブ検出：暗号化されたアーカイブは許可されていません';
$phpMussel['lang']['failed_to_access'] = 'アクセスに失敗しました';
$phpMussel['lang']['file'] = 'ファイル';
$phpMussel['lang']['filesize_limit_exceeded'] = '容範囲外ファイルサイズです';
$phpMussel['lang']['filetype_blacklisted'] = 'ファイルタイプがブラックリスト記載です';
$phpMussel['lang']['finished'] = '完了';
$phpMussel['lang']['generated_by'] = '作成者';
$phpMussel['lang']['greylist_cleared'] = ' グレーリストが解除されました。';
$phpMussel['lang']['greylist_not_updated'] = ' グレーリストがアップデートされていません。';
$phpMussel['lang']['greylist_updated'] = ' グレーリストがアップデートされました。';
$phpMussel['lang']['image'] = '画像';
$phpMussel['lang']['instance_already_active'] = 'インスタンスが既にアクティブです！​フックを再確認して下さい。';
$phpMussel['lang']['invalid_data'] = '不正データ！';
$phpMussel['lang']['invalid_file'] = '不正ファイル';
$phpMussel['lang']['invalid_url'] = '不正ＵＲＬ！';
$phpMussel['lang']['ok'] = 'ＯＫです';
$phpMussel['lang']['only_allow_images'] = '画像以外のファイルをアップロードするのは許可されていません';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'プラグインデイレクトリが存在しません！';
$phpMussel['lang']['quarantined_as'] = "「/vault/quarantine/{QFU}.qfu」として隔離。\n";
$phpMussel['lang']['recursive'] = '再帰定義呼び出しの繰り返し回数が上限を超えました';
$phpMussel['lang']['required_variables_not_defined'] = 'リクエストのあった変数は定義されていないため、​続行できません。';
$phpMussel['lang']['SafeBrowseLookup_200'] = '潜在的に有害なＵＲＬが検出されました';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'ＡＰＩリクエストが不正である';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'ＡＰＩ認証エラー';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'ＡＰＩサービス利用不可';
$phpMussel['lang']['SafeBrowseLookup_999'] = '不明なＡＰＩエラー';
$phpMussel['lang']['scan_aborted'] = 'スキャニング中断！';
$phpMussel['lang']['scan_chameleon'] = '{x} Chameleon（カメレオン）攻撃が検出されました';
$phpMussel['lang']['scan_checking'] = 'チェック中';
$phpMussel['lang']['scan_checking_contents'] = '成功！​コンテンツをチェックしています。';
$phpMussel['lang']['scan_command_injection'] = 'コマンドインジェクション攻撃が検出されました';
$phpMussel['lang']['scan_complete'] = '完了';
$phpMussel['lang']['scan_extensions_missing'] = '失敗（要求のあった拡張子がありません）！';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'ファイルネイム不正操作が検出されました';
$phpMussel['lang']['scan_missing_filename'] = 'ファイル名が存在しません';
$phpMussel['lang']['scan_not_archive'] = '失敗（中身が存在しないかアーカイブではありません）！';
$phpMussel['lang']['scan_no_problems_found'] = '問題は検出されませんでした。';
$phpMussel['lang']['scan_reading'] = '読み込んでいます';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'シグネチャファイルが汚染されています';
$phpMussel['lang']['scan_signature_file_missing'] = 'シグネチャファイルがありません';
$phpMussel['lang']['scan_tampering'] = '検出された潜在的に危険なファイル改ざん';
$phpMussel['lang']['scan_unauthorised_upload'] = '不正ファイルアップロード改ざんが検出されました';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = '不正ファイルアップロード改ざんまたはミスコンフィギュレーションが検出されました！';
$phpMussel['lang']['started'] = '開始しています';
$phpMussel['lang']['too_many_urls'] = 'URLが多すぎます';
$phpMussel['lang']['upload_error_1'] = '指示された最大アップロードファイルサイズを超えています。';
$phpMussel['lang']['upload_error_2'] = 'フォームのファイルサイズ上限を超えています。';
$phpMussel['lang']['upload_error_34'] = 'アップロード失敗！​ホスト責任者に相談して下さい！';
$phpMussel['lang']['upload_error_6'] = 'アップロードディレクトリがありません！​ホスト責任者に相談して下さい！';
$phpMussel['lang']['upload_error_7'] = 'ディスクに書き込めません！​ホスト責任者に相談して下さい！';
$phpMussel['lang']['upload_error_8'] = '不適切なPHP設定が検出されました！​ホスト責任者に相談して下さい！';
$phpMussel['lang']['upload_limit_exceeded'] = 'アップロードの制限を超えています。';
$phpMussel['lang']['wrong_password'] = '不正パスワード；アクションは否定されました。';
$phpMussel['lang']['x_does_not_exist'] = '存在しません';
$phpMussel['lang']['_exclamation'] = '！';
$phpMussel['lang']['_exclamation_final'] = '！';
$phpMussel['lang']['_fullstop'] = '。';
$phpMussel['lang']['_fullstop_final'] = '。';

$phpMussel['lang']['cli_commands'] = " q
 - ＣＬＩ終了。
 - エイリアス：quit，exit。
 md5_file
 - ファイルからＭＤ５シグネチャを作成 「構文: md5_file ファイル名」。
 - エイリアス：​m。
 sha1_file
 - ファイルからＳＨＡ１シグネチャを作成 「構文: sha1_file ファイル名」。
 md5
 - 文字列からＭＤ５シグネチャを作成 「構文: md5 文字列」。
 sha1
 - 文字列からＳＨＡ１シグネチャを作成 「構文: sha1 文字列」。
 hex_encode
 - ２進法文字列を１６進法文字列に変換 「構文: hex_encode 文字列」。
 - エイリアス：​x。
 hex_decode
 - １６進法文字列を２進法文字列に変換 「構文: hex_decode 文字列」。
 base64_encode
 - ２進法文字列をＢＡＳＥ６４文字列に変換 「構文: base64_encode 文字列」。
 - エイリアス：​b。
 base64_decode
 - ＢＡＳＥ６４文字列を２進法文字列に変換 「構文: base64_decode 文字列」。
 pe_meta
 - ＰＥファイルからメタデータを抽出する 「構文: pe_meta ファイル名」。
 url_sig
 - ＵＲＬスキャナ・シグネチャを生成する 「構文: url_sig 文字列」。
 scan
 - ファイルまたはディレクトリをスキャン 「構文: scan ファイル名」。
 - エイリアス：s。
 c
 - コマンドリストをプリント。
";
