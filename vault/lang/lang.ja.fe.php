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
 * This file: Japanese language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">ホーム</a> | <a href="?phpmussel-page=logout">ログアウト</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">ログアウト</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = '認識可能なアーカイブファイルエクステンションです（フォーマットはCSV；問題があった場合にのみ追加あるいは取り除くべきです。​不用意に取り除くと誤検出の原因となる可能性があります。​反対に不用意に追加すると、​アタックースペシフィック検出から追加したものをホワイトリスト化してしまいます。​充分に注意に上、​変更して下さい。​なお、​コンテントレベルにおいてアーカイブを分析することが出来るか否かには影響しません）。​デフォルトでは最も一般なフォーマットをリストしていますが、​意図的に包括的にはしていません。';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = '制御文字を含んだファイルをブロックするか否か（改行以外）？​についてです（<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>）。​もし、​テキストのみをアップロードするなら、​このオプションを有効にして、​さらにプロテクションを強化できます。​テキスト以外もアップロード対象であれば、​有効にすると誤検出の原因になりえます。​<code>false</code>（偽） = ブロックしない（Default/デフォルト）；​<code>true</code>（真） = ブロックする。';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = '実行ファイルでもなく実行ファイルのアーカイブとも認識できないファイル中の実行ヘッダーや不正なヘッダーの実行ファイルを探します。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'ファイルでもなくPHPアーカイブとも認識できないファイル中のPHPヘッダーを探します。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'ヘッダーが正しくないアーカイブを探します（BZ、​GZ、​RAR、​ZIP、​RAR、​GZをサポート）。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'ヘッダーが正しくないオフィスドキュメントを探します（DOC、​DOT、​PPS、​PPT、​XLA、​XLS、​WIZをサポート）。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'ヘッダーが正しくない画像ファイルを探します（BMP、​DIB、​PNG、​GIF、​JPEG、​JPG、​XCF、​PSD、​PDD、​WEBPをサポート）。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'ヘッダーが正しくないPDFファイルを探します。​<code>false</code>（偽） = オフ; <code>true</code>（真） = オン。';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = '破損ファイルとエラー解析。​<code>false</code>（偽） = 無視する；​<code>true</code>（真） = ブロックする（Default/デフォルト）。​破損の可能性があるPEファイルをブロックし検出するか否か？​についてです。​PEファイルの一部が破損し、​正しく分析できないことは珍しくなく、​ウィルス感染をみるバロメーターになります。​PEファイル内のウィルスを検出するアンチウィルスプログラムは、​PEファイルの解析を行いますが、​ウィルスを作る側では、​ウィルスが検出されないようそれを避けようとするものだからです。';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'デコード・コマンドが検出されるべき生データの長さの制限（スキャニング中に顕著な問題がある場合に必要に応じて設定）。​デフォルト＝５１２ＫＢ。​ゼロあるいは値なし（null）はしきい値を無効化します（ファイルサイズによる制限を取り除きます）。';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'phpMusselが読みスキャンしてよい生データの長さの制限（スキャニング中に顕著な問題がある場合に必要に応じて設定）。​デフォルト＝３２ＭＢ。​ゼロあるいは値なし（null）はしきい値を無効化します。​値は、​サーバーやウェブサイトでアップロードされるファイルの平均ファイルサイズより大きく、​filesize_limitディレクティブより小さく設定すべきです。​また"php.ini"設定によってPHPに割り当てられたメモリーのおおよそ5分の１を超えるべきではありません。​このディレクティブはphpMusselがメモリーを使い過ぎないようにするためのものです。​（一定のサイズ以上のファイルはスキャンできなくなることもあります）。';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'システム上でphpMusselの機能に修正が必要でない限りはこのディレクティブは通常無効です。​無効に設定すると、​<code>$_FILES</code> array()に要素の存在を検知したとき、​その要素が表すファイルのスキャンが開始され、​要素が空白か無であればphpMusselはエラーメッセージを返します。​これは本来phpMusselがあるべき姿です。​しかしＣＭＳにおいては、​$_FILESの空要素は普通に発生するものであり、​正常なphpMusselの挙動が正常なＣＭＳの挙動を阻害する恐れがあります。​このような場合は、​本オプションを有効にして、​phpMusselが空要素をスキャンしてエラーメッセージを返すのを避け、​要求のあったページへスムーズに進むことができるようにします。​<code>false</code>（偽） = OFF （オフ）；​<code>true</code>（真） = ON （オン）です。';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'システムあるいはＣＭＳに画像ファイルのアップロードのみを許可するのであれば、​このディレクティブは有効にすべきであり、​そうでなければ無効とします。​有効にすると、​画像と特定できないファイルはスキャンすることなしにブロックしますので、​プロセス時間の短縮とメモリーの節約が期待できます。​<code>false</code>（偽） = OFF （オフ）；​<code>true</code>（真） = ON （オン） です。';
$phpMussel['lang']['config_files_block_encrypted_archives'] = '暗号化されたアーカイブを検出しブロックするか否か？​phpMusselは暗号化されたアーカイブをスキャンすることはできないので、​アーカイブの暗号化によってphpMussel、​アンチウィルススキャナー等をかいくぐろうとする攻撃者がいるかもしれません。​暗号化されたアーカイブをブロックすることにより、​このようなリスクを回避することができます。​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_files_check_archives'] = 'アーカイブのコンテンツに対してチェックを試みるか否かについてです。​<code>false</code>（偽） = チェックしない; <code>true</code>（真） = チェックする（Default/デフォルト）。​現在サポートしているのはBZ、​GZ、​LZF、​ZIP形式です（RAR、​CAB、​7z等は対象外）。​本機能は万能ではありませんので、​有効にしておくことを推奨していますが、​必ず全てを検出することを保証するものではありません。​また現在チェックのアーカイブはZIPに対して再帰的でないことに注意して下さい。';
$phpMussel['lang']['config_files_filesize_archives'] = 'ファイルサイズのブラックリスト化/ホワイトリスト化をアーカイブのコンテンツに持ち込むか否か？​<code>false</code> = いいえ（ただグレーリストすべて）; <code>true</code> = はい 「Default/デフォルト設定」。';
$phpMussel['lang']['config_files_filesize_limit'] = 'ファイルサイズ上限の単位はＫＢです。​６５５３６＝６４ＭＢ（Default/デフォルト）；​0 = リミットしません（上限なし、​常にグレイリスト化）、​正の数値であれば何でも構いません。​ＰＨＰの設定でメモリーに制限があったり、​アップロードファイルサイズの上限が設定されている場合に有効的です。';
$phpMussel['lang']['config_files_filesize_response'] = '上限サイズを超えるファイルをどう処理するかについてです。​<code>false</code>（偽） = Whitelist（ホワイトリスト）; <code>true</code>（真） = Blacklist（ブラックリスト） （Default/デフォルト）。';
$phpMussel['lang']['config_files_filetype_archives'] = 'ファイルタイプのブラックリスト化/ホワイトリスト化をアーカイブのコンテンツに持ち込むか否か？​<code>false</code> = いいえ（ただグレーリストすべて） 「Default/デフォルト設定」; <code>true</code> = はい。';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'ファイルタイプ・ブラックリスト:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'ファイルタイプ・グレーリスト:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'システムが特定タイプのファイルのみアップロードを許可する、​あるいは拒絶する場合は、​ファイルタイプを適切にホワイトリスト、​ブラックリスト、​グレーリストにて分類しておくと、​ファイルタイプによって弾かれるファイルはスキャンをスキップできるため、​スピードアップに繋がります。​フォーマットはＣＳＶ（カンマ区切り）です。​リストによらず全てをスキャンしたい場合は、​変数は空白のままとし、​ホワイトリスト/ブラックリスト/グレーリストを無効にします。​プロセスの論理的順序: ファイルタイプがホワイトリストに記載されていれば、​スキャンせず、​ブロックせず、​ブラックリストおよびグレイリストに対してチェックを行いません。​ファイルタイプがブラックリストに記載されていれば、​スキャンすることなく、​直ちににブロックし、​グレーリストに対してチェックを行いません。​グレーリストが空、​あるいはグレーリストが空でなくかつそのファイルタイプがあれば、​通常通りスキャンしブロックするか否かを判断します。​グレーリストが空でなくかつそのファイルタイプが含まれていなければ、​ブラックリストと同様の扱いをすることになり、​スキャンなしにブロックします。​ファイルタイプ・ホワイトリスト:';
$phpMussel['lang']['config_files_max_recursion'] = 'アーカイブに対する最大再帰深さです。​デフォルト＝１０。';
$phpMussel['lang']['config_files_max_uploads'] = '一度にスキャンできるアップロードファイル数の上限で、​これを超えるとスキャンを中断し、​ユーザーにその旨を知らせ、​論理攻撃からの保護として機能します。​システムやＣＭＳがDDoS攻撃にあい、​phpMusselがオーバーロードしてＰＨＰプロセスに支障をきたすことがないようにするためです。​推奨数は１０ですが、​ハードウェアのスピードによっては、​これ以上/以下がよいということもあるでしょう。​この数は、​アーカイブのコンテンツは含まないことを覚えておいて下さい。';
$phpMussel['lang']['config_general_cleanup'] = '初回アップロード後に変数とキャッシュの設定をクリアするか否かについてのスクリプトです。​<code>false</code>(偽） = いいえ；​<code>true</code>（真） = はい 「Default/デフォルト設定」。​初回アップロードスキャニング以外で使用することがなければ、​<code>true</code>（真）としメモリーの使用量を最小にします。​使用するのであれば、​<code>false</code>（偽）とし、​メモリーに不要な重複データを再ロードするのを防ぎます。​通常は<code>true</code>（真）。​に設定しますが、​初回アップロードスキャニングに対してしか使用できないことを覚えておいて下さい。​ＣＬＩモードでは影響しません。';
$phpMussel['lang']['config_general_default_algo'] = '将来のすべてのパスワードとセッションに使用するアルゴリズムを定義します。​オプション：​PASSWORD_DEFAULT（Default/デフォルルト）、​PASSWORD_BCRYPT、​PASSWORD_ARGON2I ​（ＰＨＰ >= 7.2.0 が必要）。';
$phpMussel['lang']['config_general_delete_on_sight'] = 'このディレクティブを有効にすると、​検知基準（シグネチャでも何でも）にあったアップロードファイルは直ちに削除されます。​クリーンと判断されたファイルはそのままです。​アーカイブの場合、​問題のファイルが一部であってもアーカイブ全てが削除の対象となります。​アップロードファイルのスキャンにおいては、​本ディレクティブを有効にすることは必須ではありません。​なぜならＰＨＰはスクリプト実行後に自動的にキャッシュの内容を破棄するからです。​言い換えれば、​ファイルが移動されたか、​コピーされたか、​削除されない限り、​ＰＨＰはサーバーにアップロードしたファイルを残しておくことは通常ありません。​このディレクティブはセキュリティーに念を入れる目的で設置されています。​ＰＨＰは稀に予測外の振る舞いをすることがあるからです。​<code>false</code>（偽） = スキャニング後、​ファイルはそのまま（デフォルト設定）。​<code>true</code>（真） = スキャニング後、​クリーンでなければ直ちに削除。';
$phpMussel['lang']['config_general_disable_cli'] = 'ＣＬＩモードを無効にするか？​ＣＬＩモード（シーエルアイ・モード）はデフォルトでは有効になっていますが、​テストツール（PHPUnit等）やＣＬＩベースのアプリケーションと干渉しあう可能性が無いとは言い切れません。​ＣＬＩモードを無効にする必要がなければ、​このデレクティブは無視してもらって結構です。​<code>false</code>（偽） = ＣＬＩモードを有効にします（Default/デフォルルト）；​<code>true</code>（真） = ＣＬＩモードを無効にします。';
$phpMussel['lang']['config_general_disable_frontend'] = 'フロントエンドへのアクセスを無効にするか？​フロントエンドへのアクセスは、​phpMusselをより管理しやすくすることができます。​前記、​それはまた、​潜在的なセキュリティリスクになる可能性があります。​バックエンドを経由して管理することをお勧めします、​しかし、​これが不可能な場合、​フロントエンドへのアクセスが提供され。​あなたがそれを必要としない限り、​それを無効にします。​<code>false</code>（偽） = フロントエンドへのアクセスを有効にします；​<code>true</code>（真） = フロントエンドへのアクセスを無効にします（Default/デフォルルト）。';
$phpMussel['lang']['config_general_disable_webfonts'] = 'ウェブフォンツを無効にしますか？​True = はい；​False = いいえ（Default/デフォルルト）。';
$phpMussel['lang']['config_general_enable_plugins'] = 'プラグインのサポートを有効にしますか？​<code>false</code> = いいえ；​<code>true</code> = はい 「Default/デフォルト設定」。';
$phpMussel['lang']['config_general_forbid_on_block'] = 'アップロードファイルがブロックされたメッセージと共に、​phpMusselから４０３ヘッダーを送るべきか、​通常の２００でよいかどうかについて。​<code>false</code>（偽） = いいえ（２００） 「Default/デフォルト設定」；​<code>true</code>（真） = はい（４０３）。';
$phpMussel['lang']['config_general_FrontEndLog'] = 'フロントエンド・ログインの試みを記録するためのファイル。​ファイル名指定するか、​無効にしたい場合は空白のままにして下さい。';
$phpMussel['lang']['config_general_honeypot_mode'] = 'ハニーポットモードが有効になっていると、​phpMusselはアップロードされてきた全てのファイルを例外なく検疫します。​シグネチャにマッチするかどうかは問題としません。​スキャニングや分析もなされません。​phpMusselをウィルス/マルウェアのリサーチに利用と考えているユーザーにとって有益と言えるでしょう。​ただし、​アップロードファイルのスキャニングという点からは、​あまり推奨できませんし、​ハニーポット・モードを本来の目的以外に使用することもお勧めできません。​デフォルト設定では無効です。​<code>false</code>（偽） = Disabled/無効 （Default/デフォルト）；​<code>true</code>（真） = Enabled/有効。';
$phpMussel['lang']['config_general_ipaddr'] = '接続要求のＩＰアドレスをどこで見つけるべきかについて（Cloudflareのようなサービスに対して有効）。​Default（デフォルト設定） = REMOTE_ADDR。​注意：あなたが何をしているのか、​分からない限り、​これを変更しないでください。';
$phpMussel['lang']['config_general_lang'] = 'phpMusselのデフォルト言語を設定します。';
$phpMussel['lang']['config_general_maintenance_mode'] = 'メンテナンス・モードを有効にしますか？​True = はい；​False = いいえ（Default/デフォルルト）。​フロントエンド以外のすべてを無効にします。​ＣＭＳ、フレームワークなどを更新するときに便利です。';
$phpMussel['lang']['config_general_max_login_attempts'] = 'ログイン試行の最大回数（フロントエンド）。​Default（デフォルト設定） = ５。';
$phpMussel['lang']['config_general_numbers'] = 'どのように数字を表示するのが好きですか？​あなたに一番正しい例を選択してください。';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMusselは、​必要とあれば、​phpMusselのヴォルト内で独立してフラグ付ファイルのアップロードを検疫することができます。​一般的なphpMusselのユーザーは、​ウェブサイトやホスティング環境の保護ができれば充分と考えており、​フラグ付のようなものにさらなる分析を加えようまでの要求はないようですので、​無効で構いません。​ですが詳細に分析してマルウェアに備えたいユーザーは有効にすると良いでしょう。​フラグ付ファイルのアップロードの検疫は誤検出のデバッグに役立つことがあります。​検疫機能を無効にするには、​<code>quarantine_key</code>ディレクティブを空にしておくか、​空でない場合はディレクティブ内のコンテンツを消去して下さい。​有効にするには、​デイレクティブに何らかの値を入れて下さい。​<code>quarantine_key</code>は検疫機能における重要なセキュリティー要素であり、​検疫機能内に保存されたデータの執行を各種の攻撃から守っています。​<code>quarantine_key</code>はパスワードと同様に考えて下さい。​長い方がより安全と言えます。​最も効果的な使用法は<code>delete_on_sight</code>との併用です。';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = '検疫されるファイルサイズの上限。​この値より大きなファイルは検疫されません。​クオランティンの容量を超える異常に大きなファイルサイズによる攻撃で、​メモリーが無駄に消費されるのを防ぐ意味で重要です。​デフォルト設定は２ＭＢです。';
$phpMussel['lang']['config_general_quarantine_max_usage'] = '検疫のために利用する最大メモリー量。​全メモリー量が使用されると、​この範囲内に収まるよう古いファイルが削除の対象となります。​クオランティンの容量を超える異常に大きなファイルサイズによる攻撃で、​メモリーが無駄に消費されるのを防ぐ意味で重要です。​デフォルト設定は６４ＭＢです。';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'phpMusselはスキャニング結果をどれくらいの期間キャッシュすべきか？​秒単位で、​デフォルトは２１，６００秒（６時間）となっています。​０にするとキャッシュ無効になります。';
$phpMussel['lang']['config_general_scan_kills'] = 'ブロックしたか削除したアップロードの全てを記録するファイのファイル名。​ファイル名指定するか、​無効にしたい場合は空白のままにして下さい。';
$phpMussel['lang']['config_general_scan_log'] = '全スキャニング結果を記録するファイルのファイル名。​ファイル名指定するか、​無効にしたい場合は空白のままにして下さい。';
$phpMussel['lang']['config_general_scan_log_serialized'] = '全スキャニング結果を記録するファイルのファイル名（シリアル化形式を利用）。​ファイル名指定するか、​無効にしたい場合は空白のままにして下さい。';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel使用統計を追跡しますか？​True = はい；​False = いいえ（Default/デフォルルト）。';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMusselで使用される日付表記形式。​追加のオプションがリクエストに応じて追加される場合があります。';
$phpMussel['lang']['config_general_timeOffset'] = 'タイムゾーンオフセット（分）。';
$phpMussel['lang']['config_general_timezone'] = 'あなたのタイムゾーン。';
$phpMussel['lang']['config_general_truncate'] = 'ログファイルが一定のサイズに達したら切り詰めますか？​値は、​ログファイルが切り捨てられる前に大きくなる可能性があるＢ/ＫＢ/ＭＢ/ＧＢ/ＴＢ単位の最大サイズです。​デフォルト値の０ＫＢは切り捨てを無効にします （ログファイルは無期限に拡張できます）。​注：個々のログファイルに適用されます。​ログファイルのサイズは一括して考慮されません。';
$phpMussel['lang']['config_heuristic_threshold'] = 'phpMusselには、​このファイルは疑わしく危険性が高いと判断するシグネチャがあります。​しきい値は、​アップロードされているファイルの危険性の最大値であり、​これを超えるとマルウェアと判断されます。​ここにおける危険性の定義とは、​疑わしいと特定されたものの総数です。​デフォルトでは３に設定されています。​これより低いと誤検出の可能性が増え、​大きすぎると、​誤検出は減るものの危険性のあるファイルが検出されない可能性が増加してしまいます。​特に問題がなければ、​デフォルト値のままにしておくことお勧めします。';
$phpMussel['lang']['config_signatures_Active'] = 'カンマで区切られたアクティブなシグネチャファイルのリスト。';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMusselはアドウェア検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMusselは改ざんやディフェーサー検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMusselは暗号化ファイルを検出してブロックする必要がありますか？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMusselは悪戯/偽造やマルウェア/ウィルス検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMusselはパッカーやパックデータ検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMusselはＰＵＡ/ＰＵＰ検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMusselはshellスクリプト検出のためにシグネチャを分析すべきか否か？​<code>false</code>（偽） = いいえ；​<code>true</code>（真） = はい（Default/デフォルト）。';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = '拡張子がない場合にphpMusselがそれをレポートすべきか否か？​<code>fail_extensions_silently</code>が無効の場合、​拡張子なしはスキャニング時にレポートされ、​有効の場合は無視され問題は報告されません。​このディレクティブを無効にすることは、​セキュリティーを向上させるかもしれませんが、​誤検出も増加する恐れがあります。​<code>false</code>（偽） = Disabled/無効; <code>true</code>（真） = Enabled/有効 （Default/デフォルト）。';
$phpMussel['lang']['config_signatures_fail_silently'] = 'シグネチャファイルがない、​あるいは破損している場合に、​phpMusselがそれをリポートすべきか否か？​<code>fail_silently</code>が無効ならば、​問題はリポートされ、​有効であれば、​問題は無視されたスキャニングレポートが作成されます。​クラッシュするというような害がなければ、​デフォルト設定のままにしておくべきです。​<code>false</code>（偽） = Disabled/無効; <code>true</code>（真） = Enabled/有効 （Default/デフォルト）。';
$phpMussel['lang']['config_template_data_css_url'] = 'カスタムテーマ用のテンプレートファイルは、​外部ＣＳＳプロパティーを使っています。​一方、​デフォルトテーマは内部ＣＳＳです。​カスタムテーマを適用するためには、​ＣＳＳファイルのパブリック ＨＴＴＰアドレスを"css_url"変数を使って指定して下さい。​この変数が空白であれば、​デフォルトテーマが適用されます。';
$phpMussel['lang']['config_template_data_Magnification'] = 'フォントの倍率。​Default/デフォルルト = １。';
$phpMussel['lang']['config_template_data_theme'] = 'phpMusselに使用するデフォルトテーマ。';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'ＡＰＩルックアップの結果をどれくらいキャッシュするか（秒単位です）？​デフォルトは３６００秒（一時間）。';
$phpMussel['lang']['config_urlscanner_google_api_key'] = '必要なＡＰＩ鍵が定義されれば、​ＡＰＩのGoogle Safe Browsing APIルックアップが有効になります。';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Trueにすると、​APIのhpHostsルックアップが有効になります。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'スキャン反復におけるAPIルックアップの最大回数。​APIルックアップの度にスキャン反復の時間が積み重なってしまうので、​スキャン処理の速度向上のため、​制限を設けたいと考えるかもしれません。​０は制限なしを意味します。​デフォルトは１０です。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'APIルックアップの回数制限を超えた時の対応です。​<code>false</code>（偽） = 何もしない/処理を継続する（Default/デフォルト）；​<code>true</code>（真） = ファイルにフラグを付ける/ブロックする。';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'オプションですが、​phpMusselはVirus Total APIを使ってファイルをスキャンすることができます。​ウィルス、​トロイの木馬、​マルウェア、​その他の攻撃に対して非常に効果的に機能します。​デフォルトではVirus Total APIを使ったスキャニングは無効になっています。​有効にするには、​Virus TotalのAPIキーが必要です。​メリットが極めて大きいため、​有効にすることを強く推奨します。​Virus Total APIの使用にあたっては、​Virus Totalのドキュメンテーションにある通り、​利用規定ならびにガイドラインを遵守しなくてはなりません。​この統合機能を使用するためには：​Virus TotalとAPIのサービス規定を読み同意すること。​最低でもVirus Total Public APIドキュメンテーションの前文を読み理解すること（VirusTotalPublic API v2.0以降Contents「コンテンツ」前まで）。';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Virus Total APIのドキュメンテーションによると「１分間のタイムフレームの間にリクエストは最大４回」の上限があります。​ハニークライアントやハニーポット等のオートメーションを使用し、​リポートを受け取るだけでなく、​VirusTotal にリソースを提供していれば、​上限は引き上げられます。​phpMussel のデフォルトでは最大４回を遵守していますが、​前述の事情から、​この２つのディレクトリを準備し、​状況に合わせて変更できるようになっています。​制限に達してしまうといった不都合や問題がない限りデフォルト値を変更することは勧められませんが、​値を小さくすることが適当なケースもあります。​上限はタイムフレーム<code>vt_quota_time</code>（ヴィティ・クォータ・タイム）「 分内に」<code>vt_quota_rate</code>（ヴィティ・クォータ・レート）で設定します。';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '（上記の説明を参照）。';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'デフォルト設定では、​phpMusselがVirus Total APIを使ってスキャンするファイル（疑がわしいもの）には制限があります。​<code>vt_suspicion_level</code>ディレクティブを編集することのより、​この制限を変更することが可能です。';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMusselがVirus Total APIを使ったスキャニング結果を検出として扱うか、​検出の重み付けとして扱うべきか？​複数のエンジン（Virus Totalのように）を使用したスキャニングは、​検出率の向上（より多くのマルウェアが検出）をもたらす一方で誤検出の増加も招くため、​このディレクティブが存在します。​したがって、​スキャニング結果は、​決定的判断ではなく信頼スコアとして利用した方が適当なケースもあります。​値が０の場合、​Virus Total APIを使ったスキャンは検出として扱われ、​Virus Totalのエンジンがマルウェアとフラグを付けたファイルは、​phpMusselもマルウェアと判断します。​その他の値の場合は結果は検出の重み付けとなり、​スキャンされたファイルがマルウェアかどうかphpMusselが判断するための信頼スコア（あるいは検出の重み付け）となります（値はマルウェアと判断するための最小信頼スコア、​あるいは重み）。​デフォルト値は０です。';
$phpMussel['lang']['Extended Description: phpMussel'] = 'メインパッケージ（署名、ドキュメンテーション、コンフィギュレーション、は含まれません）。';
$phpMussel['lang']['field_activate'] = 'アクティブにする';
$phpMussel['lang']['field_clear_all'] = 'すべてキャンセル';
$phpMussel['lang']['field_component'] = 'コンポーネント';
$phpMussel['lang']['field_create_new_account'] = '新しいアカウントを作成する';
$phpMussel['lang']['field_deactivate'] = '非アクティブにする';
$phpMussel['lang']['field_delete_account'] = 'アカウントを削除する';
$phpMussel['lang']['field_delete_all'] = 'すべて削除';
$phpMussel['lang']['field_delete_file'] = '削除';
$phpMussel['lang']['field_download_file'] = 'ダウンロード';
$phpMussel['lang']['field_edit_file'] = '編集';
$phpMussel['lang']['field_false'] = 'False （偽）';
$phpMussel['lang']['field_file'] = 'ファイル';
$phpMussel['lang']['field_filename'] = 'ファイル名：';
$phpMussel['lang']['field_filetype_directory'] = 'ディレクトリ';
$phpMussel['lang']['field_filetype_info'] = '{EXT}ファイル';
$phpMussel['lang']['field_filetype_unknown'] = '不明です';
$phpMussel['lang']['field_install'] = 'インストール';
$phpMussel['lang']['field_latest_version'] = '最新バージョン';
$phpMussel['lang']['field_log_in'] = 'ログイン';
$phpMussel['lang']['field_more_fields'] = 'フィールドを追加します';
$phpMussel['lang']['field_new_name'] = '新しい名前：';
$phpMussel['lang']['field_ok'] = 'ＯＫ';
$phpMussel['lang']['field_options'] = 'オプション';
$phpMussel['lang']['field_password'] = 'パスワード';
$phpMussel['lang']['field_permissions'] = 'パーミッション';
$phpMussel['lang']['field_quarantine_key'] = '検疫キー';
$phpMussel['lang']['field_rename_file'] = '名前を変更する';
$phpMussel['lang']['field_reset'] = 'リセット';
$phpMussel['lang']['field_restore_file'] = '復元';
$phpMussel['lang']['field_set_new_password'] = '新しいパスワードを設定します';
$phpMussel['lang']['field_size'] = '合計サイズ：';
$phpMussel['lang']['field_size_bytes'] = 'バイト';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = '状態';
$phpMussel['lang']['field_system_timezone'] = 'システムのデフォルトタイムゾーンを使用します。';
$phpMussel['lang']['field_true'] = 'True （真）';
$phpMussel['lang']['field_uninstall'] = 'アンインストール';
$phpMussel['lang']['field_update'] = 'アップデート';
$phpMussel['lang']['field_update_all'] = 'すべてアップデートする';
$phpMussel['lang']['field_upload_file'] = '新しいファイルをアップロードする';
$phpMussel['lang']['field_username'] = 'ユーザー名';
$phpMussel['lang']['field_your_version'] = 'お使いのバージョン';
$phpMussel['lang']['header_login'] = '継続するには、​ログインしてください。';
$phpMussel['lang']['label_active_config_file'] = 'アクティブ・コンフィグレーション・ファイル：';
$phpMussel['lang']['label_blocked'] = 'ブロックされたアップロード';
$phpMussel['lang']['label_branch'] = 'ブランチ最新安定：';
$phpMussel['lang']['label_events'] = 'スキャンイベント';
$phpMussel['lang']['label_flagged'] = 'フラグされたオブジェクト';
$phpMussel['lang']['label_fmgr_cache_data'] = 'キャッシュ・データとテンポラリ・ファイル';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMusselディスク使用量：';
$phpMussel['lang']['label_fmgr_free_space'] = '空きディスク容量：  ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'ディスク使用量の合計：';
$phpMussel['lang']['label_fmgr_total_space'] = 'ディスク容量の合計：';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'コンポーネント・アップデート・メタデータ';
$phpMussel['lang']['label_hide'] = '隠す';
$phpMussel['lang']['label_os'] = '使用されたオペレーティングシステム：';
$phpMussel['lang']['label_other'] = 'その他';
$phpMussel['lang']['label_other-Active'] = 'アクティブなシグネチャ・ファイル';
$phpMussel['lang']['label_other-Since'] = '開始日';
$phpMussel['lang']['label_php'] = '使用されたPHPバージョン：';
$phpMussel['lang']['label_phpmussel'] = '使用されたphpMusselバージョン：';
$phpMussel['lang']['label_quarantined'] = '検疫されたアップロード';
$phpMussel['lang']['label_sapi'] = '使用されたSAPI：';
$phpMussel['lang']['label_scanned_objects'] = 'スキャンされたオブジェクト';
$phpMussel['lang']['label_scanned_uploads'] = 'スキャンしたアップロード';
$phpMussel['lang']['label_show'] = '表示する';
$phpMussel['lang']['label_size_in_quarantine'] = '検疫のサイズ：';
$phpMussel['lang']['label_stable'] = '最新安定：';
$phpMussel['lang']['label_sysinfo'] = 'システムインフォメーション：';
$phpMussel['lang']['label_tests'] = 'テスト：';
$phpMussel['lang']['label_unstable'] = '最新不安定：';
$phpMussel['lang']['label_upload_date'] = 'アップロード日：';
$phpMussel['lang']['label_upload_hash'] = 'アップロードのハッシュ：';
$phpMussel['lang']['label_upload_origin'] = 'アップロードの起源：';
$phpMussel['lang']['label_upload_size'] = 'アップロード・サイズ：';
$phpMussel['lang']['link_accounts'] = 'アカウント';
$phpMussel['lang']['link_config'] = 'コンフィギュレーション';
$phpMussel['lang']['link_documentation'] = 'ドキュメンテーション';
$phpMussel['lang']['link_file_manager'] = 'ファイル・マネージャー';
$phpMussel['lang']['link_home'] = 'ホーム';
$phpMussel['lang']['link_logs'] = 'ロゴス';
$phpMussel['lang']['link_quarantine'] = '検疫';
$phpMussel['lang']['link_statistics'] = '統計';
$phpMussel['lang']['link_textmode'] = 'テキスト・フォーマット： <a href="%1$sfalse">シンプル</a> – <a href="%1$strue">ファンシー</a>';
$phpMussel['lang']['link_updates'] = 'アップデート';
$phpMussel['lang']['link_upload_test'] = 'アップロード・テスト';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = '選択したログは存在しません！';
$phpMussel['lang']['logs_no_logfiles_available'] = 'いいえログが利用可能。';
$phpMussel['lang']['logs_no_logfile_selected'] = 'ログが選択されていません。';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'ログイン試行の最大回数を超えました；アクセス拒否。';
$phpMussel['lang']['previewer_days'] = '日';
$phpMussel['lang']['previewer_hours'] = '時';
$phpMussel['lang']['previewer_minutes'] = '分';
$phpMussel['lang']['previewer_months'] = '月';
$phpMussel['lang']['previewer_seconds'] = '秒';
$phpMussel['lang']['previewer_weeks'] = '週';
$phpMussel['lang']['previewer_years'] = '年';
$phpMussel['lang']['response_accounts_already_exists'] = 'そのアカウントはすでに存在します！';
$phpMussel['lang']['response_accounts_created'] = 'アカウントの作成に成功しました！';
$phpMussel['lang']['response_accounts_deleted'] = 'アカウントの削除が成功しました！';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'そのアカウントは存在しません。';
$phpMussel['lang']['response_accounts_password_updated'] = 'パスワードの更新が成功しました！';
$phpMussel['lang']['response_activated'] = 'アクティブにしました。';
$phpMussel['lang']['response_activation_failed'] = 'アクティブ化に失敗しました！';
$phpMussel['lang']['response_checksum_error'] = 'チェックサム・エラー！​ファイルが拒否されました！';
$phpMussel['lang']['response_component_successfully_installed'] = 'コンポーネントのインストールに成功しました。';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'コンポーネントのアンインストールは成功しました。';
$phpMussel['lang']['response_component_successfully_updated'] = 'コンポーネントのアップデートに成功しました！';
$phpMussel['lang']['response_component_uninstall_error'] = 'コンポーネントのアンインストール中にエラーが発生しました。';
$phpMussel['lang']['response_configuration_updated'] = 'コンフィギュレーションの更新が成功しました。';
$phpMussel['lang']['response_deactivated'] = '非アクティブにしました。';
$phpMussel['lang']['response_deactivation_failed'] = '非アクティブ化に失敗しました！';
$phpMussel['lang']['response_delete_error'] = '削除に失敗しました！';
$phpMussel['lang']['response_directory_deleted'] = 'ディレクトリが正常に削除されました！';
$phpMussel['lang']['response_directory_renamed'] = 'ディレクトリの名前が変更されました！';
$phpMussel['lang']['response_error'] = 'エラー';
$phpMussel['lang']['response_failed_to_install'] = 'インストールに失敗しました！';
$phpMussel['lang']['response_failed_to_update'] = 'アップデートに失敗しました！';
$phpMussel['lang']['response_file_deleted'] = 'ファイルを削除が成功しました！';
$phpMussel['lang']['response_file_edited'] = 'ファイルは正常に変更されました！';
$phpMussel['lang']['response_file_renamed'] = 'ファイルの名前が変更されました！';
$phpMussel['lang']['response_file_restored'] = 'ファイルは正常に復元されました！';
$phpMussel['lang']['response_file_uploaded'] = 'ファイルは正常にアップロードされました！';
$phpMussel['lang']['response_login_invalid_password'] = 'ログイン失敗！​無効なパスワード！';
$phpMussel['lang']['response_login_invalid_username'] = 'ログイン失敗！​ユーザー名は存在しません！';
$phpMussel['lang']['response_login_password_field_empty'] = 'パスワード入力は空です！';
$phpMussel['lang']['response_login_username_field_empty'] = 'ユーザー名入力は空です！';
$phpMussel['lang']['response_rename_error'] = '名前を変更できませんでした！';
$phpMussel['lang']['response_restore_error_1'] = '復元に失敗しました！​破損したファイル！';
$phpMussel['lang']['response_restore_error_2'] = '復元に失敗しました！​検疫キーが間違っています！';
$phpMussel['lang']['response_statistics_cleared'] = '統計はクリアされました。';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'すでに最新の状態です。';
$phpMussel['lang']['response_updates_not_installed'] = 'コンポーネントのインストールされていません！';
$phpMussel['lang']['response_updates_not_installed_php'] = 'コンポーネントのインストールされていません（PHP {V}が必要です）！';
$phpMussel['lang']['response_updates_outdated'] = '時代遅れです！';
$phpMussel['lang']['response_updates_outdated_manually'] = '時代遅れです（手動でアップデートしてください）！';
$phpMussel['lang']['response_updates_outdated_php_version'] = '時代遅れです（PHP {V}が必要です）！';
$phpMussel['lang']['response_updates_unable_to_determine'] = '決定することができません。';
$phpMussel['lang']['response_upload_error'] = 'アップロードに失敗しました！';
$phpMussel['lang']['state_complete_access'] = '完全なアクセス';
$phpMussel['lang']['state_component_is_active'] = 'コンポーネントがアクティブです。';
$phpMussel['lang']['state_component_is_inactive'] = 'コンポーネントが非アクティブです。';
$phpMussel['lang']['state_component_is_provisional'] = 'コンポーネントが暫定的です。';
$phpMussel['lang']['state_default_password'] = '警告：デフォルトのパスワードを使用して！';
$phpMussel['lang']['state_logged_in'] = 'ログインしています。';
$phpMussel['lang']['state_logs_access_only'] = 'ログのみにアクセス';
$phpMussel['lang']['state_maintenance_mode'] = '警告：メンテナンス・モードが有効になっています！';
$phpMussel['lang']['state_password_not_valid'] = '警告：このアカウントには有効なパスワードを使用していません！';
$phpMussel['lang']['state_quarantine'] = '現在、%sつのファイルが検疫されています。';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = '非時代遅れを隠さないで';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = '非時代遅れを隠す';
$phpMussel['lang']['switch-hide-unused-set-false'] = '未使用を隠さないで';
$phpMussel['lang']['switch-hide-unused-set-true'] = '未使用を隠す';
$phpMussel['lang']['tip_accounts'] = 'こんにちは、​{username}。​<br />アカウント・ページは、​phpMusselフロントエンドにアクセスできるユーザーを制御できます。';
$phpMussel['lang']['tip_config'] = 'こんにちは、​{username}。​<br />コンフィグレーション・ページは、​フロントエンドからphpMusselの設定を変更することができます。';
$phpMussel['lang']['tip_donate'] = 'phpMusselは無料で提供されています、​しかし、​あなたがしたい場合、​寄付ボタンをクリックすると、​プロジェクトに寄付することができます。';
$phpMussel['lang']['tip_file_manager'] = 'こんにちは、​{username}。​<br />ファイル・マネージャを使用する、​ファイルを削除、​編集、​アップロード、​ダウンロードができます。​慎重に使用する（これを使って、​インストールを壊すことができます）。';
$phpMussel['lang']['tip_home'] = 'こんにちは、​{username}。​<br />これはphpMusselフロントエンドのホームページです。​続行するには、​左側のナビゲーションメニューからリンクを選択します。';
$phpMussel['lang']['tip_login'] = 'デフォルト・ユーザ名：​<span class="txtRd">admin</span> – デフォルト・パスワード：​<span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'こんにちは、​{username}。​<br />そのログの内容を表示するために、​次のリストからログを選択します。';
$phpMussel['lang']['tip_quarantine'] = 'こんにちは、​{username}。<br />管理を容易にするために、​現在検疫されているすべてのファイルがこのページにリストされています。';
$phpMussel['lang']['tip_quarantine_disabled'] = '注意：検疫は現在無効になっていますが、コンフィギュレーション・ページで有効にすることができます。';
$phpMussel['lang']['tip_see_the_documentation'] = '設定ディレクティブの詳細については、​<a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.ja.md#SECTION7">ドキュメント</a>を参照してください。';
$phpMussel['lang']['tip_statistics'] = 'こんにちは、​{username}。​<br />このページには、phpMusselのインストールに関する基本的な使用状況の統計情報が表示されます。';
$phpMussel['lang']['tip_statistics_disabled'] = '注意：統計トラッキングは現在オフラインですが、コンフィギュレーション・ページで有効にすることができます。';
$phpMussel['lang']['tip_updates'] = 'こんにちは、​{username}。​<br />アップデート・ページは、​phpMusselのさまざまなコンポーネントはインストール、​アンインストール、​更新が可能です（コアパッケージ、​シグネチャ、​プラグイン、​L10Nファイル、​等）。';
$phpMussel['lang']['tip_upload_test'] = 'こんにちは、​{username}。​<br />アップロード・テスト・ページ、​標準的なファイルアップロードフォームを含んでいます、​ファイルが通常ブロックされるかどうかをテストすることができます。';
$phpMussel['lang']['title_accounts'] = 'phpMussel – アカウント';
$phpMussel['lang']['title_config'] = 'phpMussel – コンフィギュレーション';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – ファイル・マネージャー';
$phpMussel['lang']['title_home'] = 'phpMussel – ホーム';
$phpMussel['lang']['title_login'] = 'phpMussel – ログイン';
$phpMussel['lang']['title_logs'] = 'phpMussel – ロゴス';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – 検疫';
$phpMussel['lang']['title_statistics'] = 'phpMussel – 統計';
$phpMussel['lang']['title_updates'] = 'phpMussel – アップデート';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – アップロード・テスト';
$phpMussel['lang']['warning'] = '警告：';
$phpMussel['lang']['warning_php_1'] = 'あなたのＰＨＰバージョンはもはや積極的にサポートされていません！​​アップデートおすすめします！';
$phpMussel['lang']['warning_php_2'] = 'あなたのＰＨＰバージョンは深刻な脆弱性を持っています！​​アップデートを強くおすすめします！';
$phpMussel['lang']['warning_signatures_1'] = 'アクティブ・シグネチャ・ファイルはありません！';

$phpMussel['lang']['info_some_useful_links'] = '役に立つリンク：<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMusselの問題 ＠ GitHub</a> – phpMusselの問題ページ（サポート、​援助、​など）。</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel ＠ Spambot Security</a> – phpMusselのディスカッションフォーラム（サポート、​援助、​など）。</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel ＠ SourceForge</a> – phpMusselの代替ダウンロードミラー。</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – ウェブサイトを保護するための簡単なウェブマスターツールのコレクション。</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAVホームページ（ClamAV®は、​トロイの木馬、​ウイルス、​マルウェア、​とその他の脅威を検出するための、​オープンソースのウイルス対策エンジンです）。</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – ClamAVの補足的なシグネチャを提供する、​コンピュータセキュリティ会社。</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – phpMussel URLスキャナーで利用される、​フィッシング詐欺データベース。</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group ＠ Facebook</a> – PHP学習リソースとディスカッション。</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP学習リソースとディスカッション。</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotalは、​疑わしいファイルやURLを分析するための無料サービスです。</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysisは、​<a href="http://www.payload-security.com/">Payload Security</a>が提供する無料のマルウェア分析サービスで。</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – コンピュータのマルウェア対策専門家。</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – 便利なマルウェア対策ディスカッションフォーラム。</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">脆弱性チャート</a> – さまざまなパッケージの安全で安全でないバージョンを一覧表示する（ＰＨＰ、ＨＨＶＭ、等）。</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">互換性チャート</a> – さまざまなパッケージの互換性情報を一覧表示します（CIDRAM、phpMussel、等）。</li>
        </ul>';
