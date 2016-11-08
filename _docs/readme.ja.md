## phpMusselのドキュメンテーション（日本語）。

### 目次
- 1. [序文](#SECTION1)
- 2A. [インストール方法（ウェブサーバー編）](#SECTION2A)
- 2B. [インストール方法（CLI編）](#SECTION2B)
- 3A. [使用方法（ウェーブサーバー編）](#SECTION3A)
- 3B. [使用方法（CLI編）](#SECTION3B)
- 4. [フロントエンドの管理](#SECTION4)
- 5. [CLI （コマンドライン・インターフェイス）](#SECTION5)
- 6. [本パッケージに含まれるファイル](#SECTION6)
- 7. [設定オプション](#SECTION7)
- 8. [署名（シグニチャ）フォーマット](#SECTION8)
- 9. [適合性問題](#SECTION9)
- 10. [よくある質問（FAQ）](#SECTION10)

*翻訳についての注意：エラーが発生した場合（例えば、翻訳の間の不一致、タイプミス、等等）、READMEの英語版が原本と権威のバージョンであると考えられます。誤りを見つけた場合は、それらを修正するにご協力を歓迎されるだろう。*

---


###1. <a name="SECTION1"></a>序文

phpMussel（ピー・エイチ・ピー・マッスル）をご利用頂き、ありがとうございます。phpMusselは、ClamAV をはじめとした署名（シグニチャ）を利用して、システムにアップロードされるファイルを対象して、トロイ型のウィルスやマルウェア等を検出するようデザインされたPHPスクリプトです。

PHPMUSSEL著作権2013とGNU一般公衆ライセンスv2を超える権利について： Caleb M (Maikuolan)著。

本スクリプトはフリーウェアです。フリーソフトウェア財団発行のGNU一般公衆ライセンス・バージョン２（またはそれ以降のバージョン）に従い、再配布ならびに加工が可能です。配布の目的は、役に立つことを願ってのものですが、『保証はなく、また商品性や特定の目的に適合するのを示唆するものでもありません』。"LICENSE.txt" にあるGNU General Public License（一般ライセンス）を参照して下さい。 以下のURLからも閲覧できます：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

作成のインスピレーションと本スクリプトが利用する署名（シグニチャ）について[ClamAV](http://www.clamav.net/)に感謝の意を表したいと思います。この２つがなければ、本スクリプトは存在しえないか、あるいは極めて限られた利用価値しかもたないと言ってよいでしょう。

本プロジェクトファイルのホスト先であるSourceforgeとGithub、 phpMusselのディスカッションフォーラムのホスト先である[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)、 phpMusselが利用する署名（シグニチャ）の提供先である： [SecuriteInfo.com](http://www.securiteinfo.com/)、 [PhishTank](http://www.phishtank.com/)、 [NLNetLabs](http://nlnetlabs.nl/) 他、 本プロジェクトを支援して下さった全ての方々に感謝の意を表したいと思います。

本ドキュメントならびに関連パッケージは以下のURLからダウンロードできます。
- [Sourceforge](http://phpmussel.sourceforge.net/)。
- [Github](https://github.com/Maikuolan/phpMussel/)。

---


###2A. <a name="SECTION2A"></a>インストール方法（ウェブサーバー編）

近い将来にはインストーラーを作成しインストールの簡素化を図りたいと考えていますが、現状では以下のインストラクションに従ってphpMusselをインストールして下さい。少数の例外はあるものの、大多数*のシステムおよびCMSで機能します。

1) 本項を読んでいるということから、アーカイブ・スクリプトのローカルマシンへのダウンロードと解凍は終了していると考えます。ホストあるいはCMSに`/public_html/phpmussel/`のようなディレクトリを作り、ローカルマシンからそこにコンテンツをアップロードするのが次のステップです。アップロード先のディレクトリ名や場所については、安全でさえあれば、もちろん制約などはありませんので、自由に決めて下さい。

2) `config.ini`に`config.ini.RenameMe`の名前を変更します（`vault`の内側に位置する）。オプションの修正のため（初心者には推奨できませんが、経験が豊富なユーザーには強く推奨します）、それを開いて下さい（本ファイルはphpMusselが利用可能なディレクティブを含んでおり、それぞれのオプションについての機能と目的に関した簡単な説明があります）。セットアップ環境にあわせて、適当な修正を行いファイルを保存して下さい。

3) コンテンツ（phpMussel本体とファイル）を先に定めたディレクトリにアップロードします。（`*.txt`や`*.md`ファイルはアップロードの必要はありませんが、大抵は全てをアップロードしてもらって構いません）。

4) `vault`ディレクトリは「７５５」にアクセス権変更します（問題がある場合は、「７７７」を試すことができます；これは、しかし、安全ではありません）。コンテンツをアップロードしたディレクトリそのものは、通常特に何もする必要ありませんが、過去にパーミッションで問題があった場合、CHMODのステータスは確認しておくと良いでしょう。（デフォルトでは「７５５」が一般的です）。

5) 次に、システム内あるいはCMSにphpMusselをフックします。方法はいくつかありますが、最も容易なのは、`require`や`include`でスクリプトをシステム内／CMCのコアファイルの最初の部分に記載する方法です。（コアファイルとは、サイト内のどのページにアクセスがあっても必ずロードされるファイルのことです）。一般的には、`/includes`や`/assets`や`/functions`のようなディレクトリ内のファイルで、`init.php`、`common_functions.php`、`functions.php`といったファイル名が付けられています。実際にどのファイルなのかは、見つけてもうらう必要があります。よく分からない場合は、phpMusselサポートフォーラムを参照するか、またはGithubのでphpMusselの問題のページ、あるいはお知らせください（CMS情報必須）。私自身を含め、ユーザーの中に類似のCMSを扱った経験があれば、何かしらのサポートを提供できます。コアファイルが見つかったなら、「`require`か`include`を使って」以下のコードをファイルの先頭に挿入して下さい。ただし、クォーテーションマークで囲まれた部分は`loader.php`ファイルの正確なアドレス（HTTPアドレスでなく、ローカルなアドレス。前述のvaultのアドレスに類似）に置き換えます。

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

ファイルを保存して閉じ、再アップロードします。

-- 他の手法 --

Apacheウェブサーバーを利用していて、かつ`php.ini`を編集できるようであれば、`auto_prepend_file`ディレクティブを使って、PHPリクエストがあった場合にはいつもphpMusselを先頭に追加するようにすることも可能です。以下に例を挙げます。

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

あるいは、`.htaccess` において：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) これでインストールは完了ですが、念のために、テストを行いましょう。不正ファイルアップロード保護機能をテストするには、パッケージ内の`_testfiles`に含まれているテストファイルをブラウザを使った通常の方法でアップロードします。問題がなければ、phpMusselからアップロードをブロックしたとのメッセージが表示され、そうでない場合は何かが正常に機能していません。また、もし何かしら特殊な機能を使っている、ないしは他のタイプのスキャニングも使っているようであれば、相互に影響があるかないかもチェックしておく方が良いでしょう。

---


###2B. <a name="SECTION2B"></a>インストール方法（CLI編）

近い将来にはインストーラーを作成しインストールの簡素化を図りたいと考えていますが、現状では以下のインストラクションに従ってphpMusselをインストールして下さい。（現段階ではウィンドウズベースのCLIのみサポートされています。Linuxおよび他のシステムは以降のバージョンにてサポートされる予定しています）。

1) 本項を読んでいるということから、アーカイブ・スクリプトのローカルマシンへのダウンロードと解凍は終了していると考えます。phpmusselの保存場所が決まったら、次へ進んで下さい。

2) phpMusselを使うには、PHPがホストマシンにインストールされている必要があります。もし、まだであれば、各種PHPインストーラーのどれを使っても構いませんので、インストールして下さい。

3) オプションの修正のため（初心者には推奨できませんが、経験が豊富なユーザーには強く推奨します）。`vault`内の`config.ini`を開いて下さい。本ファイルはphpMusselが利用可能なディレクティブを含んでおり、それぞれのオプションについての機能と目的に関した簡単な説明があります。セットアップ環境にあわせて、適当な修正を行いファイルを保存して下さい。

4) オプションですが、バッチファイルを作成することにより、phpMusselのCLIモードでの使用を容易にすることができます。バッチファイルはPHPとphpMusselを自動的にロードするものです。まず、Notepadか Notepad++のようなテキストエディタを開いて下さい。そして、インストールしたPHPの`php.exe`の絶対パス、半角スペース、`loader.php`の絶対パスをタイプして、拡張子".bat"でファイルを目につくところに保存します。このファイルをダブルクリックすることでphpMusselを起動することができます。

5) テストを行いましょう。パッケージ内の`_testfiles`をphpMusselでスキャンしてみて下さい。

---


###3A. <a name="SECTION3A"></a>使用方法（ウェーブサーバー編）

phpMusselは特別な使用環境を必要としないスクリプトです。一度インストールされれば、充分に機能します。

デフォルトでは、アップロードされたファイルのスキャンは自動的に行うように設定されています。従って基本的に何もすることはありません。

ですが、特定のファイル、ディレクトリ、アーカイブをスキャンするよう設定することも可能です。`config.ini`を適切に設定し直して下さい（クリーンアップは無効でなくてはなりません）。その後phpMusselがフックされているPHPファイル内において、以下のコードを使用します。

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` には、文字列あるいは（多次元）配列を代入することができます。どのファイル（一つないしは複数）あるいはディレクトリ（一つないしは複数）をスキャンすべきか指定します。
- `$output_type` はブーレアンで、スキャン結果のフォーマットを指定できます。Falseは結果を整数型で返します（-3は、phpMusselの署名ファイルか署名マップがない、もしくは破損している可能性があることを示しています。-2はスキャン中に破損データを検出したためスキャン失敗、-1はPHPがスキャンに必要な拡張子あるいはアドオンがないためにスキャン失敗、0はスキャンの対象が存在しないこと、１は対象のスキャンを完了しかつ問題がないこと、２は対象のスキャンを完了しかつ問題を検出したことを意味します）。`true`（真）は結果をテキスト形式で返します。どちらを選択しても、スキャン後にグローバル変数によって結果にアクセスすることが可能です。$output_typeはオプションでデフォルト設定は`false`（偽）になっています。
- `$output_flatness` はブーレアンで、スキャン結果を配列で返すか、文字列で返すかを指定します（対象が複数の場合）。`false`（偽）は配列、`true`（真）は文字列での返り値となります。`$output_flatness`はオプションでデフォルト設定は`false`（偽）です。

例：

```
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

の場合、返り値は：

```
 Wed, 16 Sep 2013 02:49:46 +0000 開始。
 > チェック '/user_name/public_html/my_file.html':
 -> 問題は検出されませんでした。
 Wed, 16 Sep 2013 02:49:47 +0000 完了。
```

phpMusselがどのような署名を使ったか等の詳細な情報については、本ファイルのセクション『署名フォーマット』を参照して下さい。

誤検出や新種の疑わしきものに遭遇した、あるいは署名に関することについては何でもお知らせ下さい。そうすれば、即時対応でき、必要な修正を行うことができます。

phpMusselに含まれる署名を無効にするには、本READMEファイルの「フロントエンドの管理」内にあるグレーリスティング・ノートを参照して下さいを参照して下さい（通常除かれるべきではないと考えられるものがブロックされてしまうような場合）。

---


###3B. <a name="SECTION3B"></a>使用方法（CLI編）

本READMEファイルのインストール方法（CLI編）を参照して下さい。

将来的にはウィンドウズベース以外のシステムもサポートする予定ですが、現バージョンのphpMussel CLIモードではウィンドウズベースのみです。（試して頂いたくことに問題はありません。ただ期待通りの機能を保証することはできない旨ご了承下さい）。

なお、phpMusselを通常のウィルスソフトと混同しないで下さい。アクティブメモリーを監視してウィルスを即時検出するものではありません（phpMusselは、オンデマンドスキャナです；phpMusselは、オンアクセススキャナではありません）。指定されたファイルのみをスキャンし（また、ファイルのアップロード）、含まれるウィルスを検出します。

---


###4. <a name="SECTION4"></a>フロントエンドの管理

@TODO@

---


###5. <a name="SECTION5"></a>CLI （コマンドライン・インターフェイス）

phpMusselはウィンドウズベースのシステムでは、CLIモードで対話式のファイルスキャナーとしても機能します。詳細についてはインストール方法（CLI編）を参照して下さい。

CLIプロンプトにて`c`とタイプしエンターを押せば、利用可能なCLIコマンドのリストが表示されます。

また、興味のある人のために、CLIモードでphpMusselを使用する方法のためのビデオチュートリアルは、ここで提供されています：
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


###6. <a name="SECTION6"></a>本パッケージに含まれるファイル

以下はアーカイブから一括ダウンロードされるファイルのリスト、ならびにスクリプト使用により作成されるファイルとこれらのファイルが何のためかという簡単な説明です。

ファイル | 説明
----|----
/_docs/ | ドキュメンテーション用のディレクトリです（様々なファイルを含みます）。
/_docs/readme.ar.md | アラビア語ドキュメンテーション。
/_docs/readme.de.md | ドイツ語ドキュメンテーション。
/_docs/readme.en.md | 英語ドキュメンテーション。
/_docs/readme.es.md | スペイン語ドキュメンテーション。
/_docs/readme.fr.md | フランス語ドキュメンテーション。
/_docs/readme.id.md | インドネシア語ドキュメンテーション。
/_docs/readme.it.md | 伊語ドキュメンテーション。
/_docs/readme.ja.md | 日本語ドキュメンテーション。
/_docs/readme.nl.md | オランダ語ドキュメンテーション。
/_docs/readme.pt.md | ポルトガル語ドキュメンテーション。
/_docs/readme.ru.md | ロシア語ドキュメンテーション。
/_docs/readme.vi.md | ベトナム語ドキュメンテーション。
/_docs/readme.zh-TW.md | 繁体字中国語ドキュメンテーション。
/_docs/readme.zh.md | 簡体字中国語ドキュメンテーション。
/_testfiles/ | テストファイルのディレクトリです（様々なファイルを含んでいます）。phpMusselがシステムに正しくインストールされたかどうかをテストするファイルです。テスト以外の目的でこのディレクトリをアップロードすることはありません。
/_testfiles/ascii_standard_testfile.txt | phpMussel正規化ASCII署名用テストファイル。
/_testfiles/coex_testfile.rtf | phpMussel拡張コンプレックス署名用テストファイル。
/_testfiles/exe_standard_testfile.exe | phpMussel PE署名用テストファイル。
/_testfiles/general_standard_testfile.txt | phpMussel一般署名用テストファイル。
/_testfiles/graphics_standard_testfile.gif | phpMusselグラフィック署名用テストファイル。
/_testfiles/html_standard_testfile.html | phpMussel正規化HTML署名テストファイル。
/_testfiles/md5_testfile.txt | phpMussel MD5署名用テストファイル。
/_testfiles/metadata_testfile.tar | システム内TARファイルサポート確認ならびにphpMusselメタデータ署名用テストファイル。
/_testfiles/metadata_testfile.txt.gz | システム内GZファイルサポート確認ならびにphpMusselメタデータ署名用テストファイル。
/_testfiles/metadata_testfile.zip | システム内ZIPファイルサポート確認ならびにphpMusselメタデータ署名用テストファイル。
/_testfiles/ole_testfile.ole | phpMussel OLE署名用テストファイル。
/_testfiles/pdf_standard_testfile.pdf | phpMussel PDF署名用テストファイル。
/_testfiles/pe_sectional_testfile.exe | phpMussel PEセクショナル署名用テストファイル。
/_testfiles/swf_standard_testfile.swf | phpMussel SWF署名用テストファイル。
/_testfiles/xdp_standard_testfile.xdp | phpMussel XML/XDP署名用テストファイル。
/vault/ | ヴォルト・ディレクトリ（様々なファイルを含んでいます）。
/vault/cache/ | キャッシュ・ディレクトリ（一時データ用）。
/vault/cache/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/fe_assets/ | フロントエンド資産。
/vault/fe_assets/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/fe_assets/_accounts.html | フロントエンドのアカウントページのHTMLテンプレート。
/vault/fe_assets/_accounts_row.html | フロントエンドのアカウントページのHTMLテンプレート。
/vault/fe_assets/_config.html | フロントエンドのコンフィギュレーションページのHTMLテンプレート。
/vault/fe_assets/_home.html | フロントエンドのホームページのHTMLテンプレート。
/vault/fe_assets/_login.html | フロントエンドのログインページのHTMLテンプレート。
/vault/fe_assets/_logs.html | フロントエンドのロゴスページのHTMLテンプレート。
/vault/fe_assets/_nav_complete_access.html | フロントエンドのナビゲーションリンクのHTMLテンプレート、は完全なアクセスのためのものです。
/vault/fe_assets/_nav_logs_access_only.html | フロントエンドのナビゲーションリンクのHTMLテンプレート、はログのみにアクセスのためのものです。
/vault/fe_assets/_updates.html | フロントエンドのアップデートページのHTMLテンプレート。
/vault/fe_assets/_updates_row.html | フロントエンドのアップデートページのHTMLテンプレート。
/vault/fe_assets/frontend.css | フロントエンドのCSSスタイルシート。
/vault/fe_assets/frontend.dat | フロントエンドのデータベース（アカウント情報とセッション情報が含まれています；フロントエンドが有効になっているときに作成）。
/vault/fe_assets/frontend.html | フロントエンドのメインテンプレートファイル。
/vault/lang/ | phpMusselの言語データを含んでいます。
/vault/lang/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/lang/lang.ar.fe.php | フロントエンドのアラビア語言語データ。
/vault/lang/lang.ar.php | アラビア語言語データ。
/vault/lang/lang.de.fe.php | フロントエンドのドイツ語言語データ。
/vault/lang/lang.de.php | ドイツ語言語データ。
/vault/lang/lang.en.fe.php | フロントエンドの英語言語データ。
/vault/lang/lang.en.php | 英語言語データ。
/vault/lang/lang.es.fe.php | フロントエンドのスペイン語言語データ。
/vault/lang/lang.es.php | スペイン語言語データ。
/vault/lang/lang.fr.fe.php | フロントエンドのフランス語言語データ。
/vault/lang/lang.fr.php | フランス語言語データ。
/vault/lang/lang.id.fe.php | フロントエンドのインドネシア語言語データ。
/vault/lang/lang.id.php | インドネシア語言語データ。
/vault/lang/lang.it.fe.php | フロントエンドの伊語言語データ。
/vault/lang/lang.it.php | 伊語言語データ。
/vault/lang/lang.ja.fe.php | フロントエンドの日本語言語データ。
/vault/lang/lang.ja.php | 日本語言語データ。
/vault/lang/lang.nl.fe.php | フロントエンドのオランダ語言語データ。
/vault/lang/lang.nl.php | オランダ語言語データ。
/vault/lang/lang.pt.fe.php | フロントエンドのポルトガル語言語データ。
/vault/lang/lang.pt.php | ポルトガル語言語データ。
/vault/lang/lang.ru.fe.php | フロントエンドのロシア語言語データ。
/vault/lang/lang.ru.php | ロシア語言語データ。
/vault/lang/lang.vi.fe.php | フロントエンドのベトナム語言語データ。
/vault/lang/lang.vi.php | ベトナム語言語データ。
/vault/lang/lang.zh-tw.fe.php | フロントエンドの繁体字中国語言語データ。
/vault/lang/lang.zh-tw.php | 繁体字中国語言語データ。
/vault/lang/lang.zh.fe.php | フロントエンドの簡体字中国語言語データ。
/vault/lang/lang.zh.php | 簡体字中国語言語データ。
/vault/quarantine/ | 検疫ディレクトリ（検疫されたファイル含んでいます）。
/vault/quarantine/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/signatures/ | 署名ディレクトリ（署名ファイルが含まれています）。
/vault/signatures/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/signatures/ascii_clamav_regex.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_clamav_regex.map | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_clamav_standard.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_clamav_standard.map | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_custom_regex.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_custom_standard.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_mussel_regex.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/ascii_mussel_standard.cvd | 正規化ASCII署名用ファイル。
/vault/signatures/coex_clamav.cvd | 複合拡張署名用ファイル。
/vault/signatures/coex_custom.cvd | 複合拡張署名用ファイル。
/vault/signatures/coex_mussel.cvd | 複合拡張署名用ファイル。
/vault/signatures/elf_clamav_regex.cvd | ELF署名用ファイル。
/vault/signatures/elf_clamav_regex.map | ELF署名用ファイル。
/vault/signatures/elf_clamav_standard.cvd | ELF署名用ファイル。
/vault/signatures/elf_clamav_standard.map | ELF署名用ファイル。
/vault/signatures/elf_custom_regex.cvd | ELF署名用ファイル。
/vault/signatures/elf_custom_standard.cvd | ELF署名用ファイル。
/vault/signatures/elf_mussel_regex.cvd | ELF署名用ファイル。
/vault/signatures/elf_mussel_standard.cvd | ELF署名用ファイル。
/vault/signatures/exe_clamav_regex.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_clamav_regex.map | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_clamav_standard.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_clamav_standard.map | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_custom_regex.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_custom_standard.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_mussel_regex.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/exe_mussel_standard.cvd | PE（ポータブル実行可能）署名用ファイル。
/vault/signatures/filenames_clamav.cvd | ファイル名署名用ファイル。
/vault/signatures/filenames_custom.cvd | ファイル名署名用ファイル。
/vault/signatures/filenames_mussel.cvd | ファイル名署名用ファイル。
/vault/signatures/general_clamav_regex.cvd | 一般署名用ファイル。
/vault/signatures/general_clamav_regex.map | 一般署名用ファイル。
/vault/signatures/general_clamav_standard.cvd | 一般署名用ファイル。
/vault/signatures/general_clamav_standard.map | 一般署名用ファイル。
/vault/signatures/general_custom_regex.cvd | 一般署名用ファイル。
/vault/signatures/general_custom_standard.cvd | 一般署名用ファイル。
/vault/signatures/general_mussel_regex.cvd | 一般署名用ファイル。
/vault/signatures/general_mussel_standard.cvd | 一般署名用ファイル。
/vault/signatures/graphics_clamav_regex.cvd | グラフィック署名用ファイル。
/vault/signatures/graphics_clamav_regex.map | グラフィック署名用ファイル。
/vault/signatures/graphics_clamav_standard.cvd | グラフィック署名用ファイル。
/vault/signatures/graphics_clamav_standard.map | グラフィック署名用ファイル。
/vault/signatures/graphics_custom_regex.cvd | グラフィック署名用ファイル。
/vault/signatures/graphics_custom_standard.cvd | グラフィック署名用ファイル。
/vault/signatures/graphics_mussel_regex.cvd | グラフィック署名用ファイル。
/vault/signatures/graphics_mussel_standard.cvd | グラフィック署名用ファイル。
/vault/signatures/hex_general_commands.csv | phpMussel がオプション利用する一般コマンド検知の１６進法変換CSV。
/vault/signatures/html_clamav_regex.cvd | 正規化HTML署名用ファイル。
/vault/signatures/html_clamav_regex.map | 正規化HTML署名用ファイル。
/vault/signatures/html_clamav_standard.cvd | 正規化HTML署名用ファイル。
/vault/signatures/html_clamav_standard.map | 正規化HTML署名用ファイル。
/vault/signatures/html_custom_regex.cvd | 正規化HTML署名用ファイル。
/vault/signatures/html_custom_standard.cvd | 正規化HTML署名用ファイル。
/vault/signatures/html_mussel_regex.cvd | 正規化HTML署名用ファイル。
/vault/signatures/html_mussel_standard.cvd | 正規化HTML署名用ファイル。
/vault/signatures/macho_clamav_regex.cvd | Mach-O署名用ファイル。
/vault/signatures/macho_clamav_regex.map | Mach-O署名用ファイル。
/vault/signatures/macho_clamav_standard.cvd | Mach-O署名用ファイル。
/vault/signatures/macho_clamav_standard.map | Mach-O署名用ファイル。
/vault/signatures/macho_custom_regex.cvd | Mach-O署名用ファイル。
/vault/signatures/macho_custom_standard.cvd | Mach-O署名用ファイル。
/vault/signatures/macho_mussel_regex.cvd | Mach-O署名用ファイル。
/vault/signatures/macho_mussel_standard.cvd | Mach-O署名用ファイル。
/vault/signatures/mail_clamav_regex.cvd | メール署名用のファイル。
/vault/signatures/mail_clamav_regex.map | メール署名用のファイル。
/vault/signatures/mail_clamav_standard.cvd | メール署名用のファイル。
/vault/signatures/mail_clamav_standard.map | メール署名用のファイル。
/vault/signatures/mail_custom_regex.cvd | メール署名用のファイル。
/vault/signatures/mail_custom_standard.cvd | メール署名用のファイル。
/vault/signatures/mail_mussel_regex.cvd | メール署名用のファイル。
/vault/signatures/mail_mussel_standard.cvd | メール署名用のファイル。
/vault/signatures/md5_clamav.cvd | MD5ベース署名用ファイル。
/vault/signatures/md5_custom.cvd | MD5ベース署名用ファイル。
/vault/signatures/md5_mussel.cvd | MD5ベース署名用ファイル。
/vault/signatures/metadata_clamav.cvd | アーカイブメタデータ署名用ファイル。
/vault/signatures/metadata_custom.cvd | アーカイブメタデータ署名用ファイル。
/vault/signatures/metadata_mussel.cvd | アーカイブメタデータ署名用ファイル。
/vault/signatures/ole_clamav_regex.cvd | OLE署名用ファイル。
/vault/signatures/ole_clamav_regex.map | OLE署名用ファイル。
/vault/signatures/ole_clamav_standard.cvd | OLE署名用ファイル。
/vault/signatures/ole_clamav_standard.map | OLE署名用ファイル。
/vault/signatures/ole_custom_regex.cvd | OLE署名用ファイル。
/vault/signatures/ole_custom_standard.cvd | OLE署名用ファイル。
/vault/signatures/ole_mussel_regex.cvd | OLE署名用ファイル。
/vault/signatures/ole_mussel_standard.cvd | OLE署名用ファイル。
/vault/signatures/pdf_clamav_regex.cvd | PDF署名用ファイル。
/vault/signatures/pdf_clamav_regex.map | PDF署名用ファイル。
/vault/signatures/pdf_clamav_standard.cvd | PDF署名用ファイル。
/vault/signatures/pdf_clamav_standard.map | PDF署名用ファイル。
/vault/signatures/pdf_custom_regex.cvd | PDF署名用ファイル。
/vault/signatures/pdf_custom_standard.cvd | PDF署名用ファイル。
/vault/signatures/pdf_mussel_regex.cvd | PDF署名用ファイル。
/vault/signatures/pdf_mussel_standard.cvd | PDF署名用ファイル。
/vault/signatures/pex_custom.cvd | PE拡張署名用ファイル。
/vault/signatures/pex_mussel.cvd | PE拡張署名用ファイル。
/vault/signatures/pe_clamav.cvd | PEセクショナル署名用ファイル。
/vault/signatures/pe_custom.cvd | PEセクショナル署名用ファイル。
/vault/signatures/pe_mussel.cvd | PEセクショナル署名用ファイル。
/vault/signatures/swf_clamav_regex.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/swf_clamav_regex.map | ショックウェーブ署名用ファイル。
/vault/signatures/swf_clamav_standard.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/swf_clamav_standard.map | ショックウェーブ署名用ファイル。
/vault/signatures/swf_custom_regex.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/swf_custom_standard.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/swf_mussel_regex.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/swf_mussel_standard.cvd | ショックウェーブ署名用ファイル。
/vault/signatures/switch.dat | 変数をコントロール、セットします。
/vault/signatures/urlscanner.cvd | URLスキャナー署名用ファイル。
/vault/signatures/whitelist_clamav.cvd | 特定ホワイトリスト用ファイル。
/vault/signatures/whitelist_custom.cvd | 特定ホワイトリスト用ファイル。
/vault/signatures/whitelist_mussel.cvd | 特定ホワイトリスト用ファイル。
/vault/signatures/xmlxdp_clamav_regex.cvd | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_clamav_regex.map | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_clamav_standard.cvd | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_clamav_standard.map | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_custom_regex.cvd | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_custom_standard.cvd | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_mussel_regex.cvd | XML/XDP署名用ファイル。
/vault/signatures/xmlxdp_mussel_standard.cvd | XML/XDP署名用ファイル。
/vault/.htaccess | ハイパーテキスト・アクセスファイル（この場合、本スクリプトの重要なファイルを権限のないソースのアクセスから保護するためです）。
/vault/cli.php | CLIハンドラ。
/vault/config.ini.RenameMe | phpMussel設定ファイル；phpMusselの全オプション設定を記載しています。それぞれのオプションの機能と動作手法の説明です（アクティブにするために名前を変更します）。
/vault/config.php | コンフィギュレーション・ハンドラ。
/vault/core.dat | phpMusselの主なコンポーネント情報が含まれています；アップデート機能で使用（フロントエンドが提供します）。
/vault/frontend.php | フロントエンド・ハンドラ。
/vault/functions.php | 関数ファイル（本質的ファイル）。
/vault/greylist.csv | グレーリスト化された署名のCSVで、phpMusselがどの署名を無視すべきかを指示するものです（削除しても自動的に再作成されます）。
/vault/l10n.dat | phpMusselのL10Nコンポーネント情報が含まれています；アップデート機能で使用（フロントエンドが提供します）。
/vault/lang.php | 言語・ハンドラ。
※ /vault/scan_kills.txt | phpMusselによりブロック／削除されたアップロードファイルの全記録。
※ /vault/scan_log.txt | phpMusselによりスキャンされたものの全記録。
※ /vault/scan_log_serialized.txt | phpMusselによりスキャンされたものの全記録。
/vault/template.html | phpMusselテンプレートファイル；phpMusselがファイルアップロードをブロックした際に作成されるメッセージのHTML出力用テンプレート（アップローダーが表示するメッセージ）。
/vault/template_custom.html | phpMusselテンプレートファイル；phpMusselがファイルアップロードをブロックした際に作成されるメッセージのHTML出力用テンプレート（アップローダーが表示するメッセージ）。
/vault/upload.php | アップロード・ハンドラ。
/.gitattributes | Githubのプロジェクトファイル（機能には関係のないファイルです）。
/Changelog-v1.txt | バージョンによる違いを記録したものです（機能には関係のないファイルです）。
/composer.json | Composer/Packagist情報（機能には関係のないファイルです）。
/CONTRIBUTING.md | プロジェクトに貢献する方法について。
/LICENSE.txt | GNU/GPLv2のライセンスのコピー（機能には関係のないファイルです）。
/loader.php | ローダー・ファイルです。主要スクリプトのロード、アップロード等を行います。フックするのはまさにこれです（本質的ファイル）！
/PEOPLE.md | プロジェクトに関わる人々についての情報。
/README.md | プロジェクト概要情報。
/web.config | ASP.NET設定ファイルです（スクリプトがASP.NETテクノロジーを基礎とするサーバーにインストールされた時に`/vault`ディレクトリを権限のないソースによるアクセスから保護するためです）。

※ ファイル名は設定の仕方（`config.ini`内）により異なることがあります。

####*署名ファイルについて*
CVDは"ClamAV Virus Definitions"（ClamAV ウィルス定義）の頭文字をとったもので、ClamAVがどのように署名を参照するか、phpMusselに対してどのように使用するかに関連しています。"CVD"で終了するファイルは署名を含んでいます。

"MAP"で終了するファイルは、文字通り、phpMusselが各々のスキャンにおいてどの署名を使用すべきか否かをマッピングしています。スキャンは必ずしも全ての署名を必要とはしません。phpMusselは署名ファイルのマップを使ってスキャン工程をスピードアップします（さもなければ、長時間を要する可能性がある場合など）。

"_regex"でマークされた署名ファイルは、正規表現パターンチェッキング(regex)を利用する署名を含んでいます。

"_standard"でマークされた署名ファイルは、特にパターンチェッキングを利用しない署名を含んでいます。

"_regex" でも "_standard"でもマークされていない署名ファイルでも、そのどちらか一方に属し、両方の性質をもつことはありません（本READMEファイルの署名フォーマットのセクションにてドキュメンテーション及び詳細を参照して下さい）。

"_clamav"でマークされた署名ファイルは、ClamAVデータベース（GNU/GPL）をソースとする署名のみを含んでいます。

"_custom"でマークされた署名ファイルは、署名を含んでいません。その必要があれば、ユーザーが自由にカスタム署名のために利用できます。

"_mussel"でマークされた署名は、ClamAVをソースとしない署名を含んでいます。概して私自身か種々の情報源から集めた署名です。

---


###7. <a name="SECTION7"></a>設定オプション
以下は`config.ini`設定ファイルにある変数ならびにその目的と機能のリストです。

####"general" （全般、カテゴリー）
全般的な設定。

"script_password" （スクリプト・パスワード）
- 利便性向上のため、phpMusselには、POST、GET 、QUERYを使ったいくつかの手動機能があります（迅速なアップデート等）。しかし、セキュリティーを考慮し、これを実行するには、コマンドとともにパスワードを必要とするようになっています。`script_password`は自由に設定してもらって構いません。デフォルトでは、パスワードの設定なくしては、手動機能は無効です。パスワードは覚えやすいが他人には想像できないものにして下さい。
- CLIモードでは影響しません。

"logs_password" （ログ・パスワード）
- `script_password`と同じですが、`scan_log`と`scan_kills`を見るためのパスワードです。パスワードが２つ存在する理由は、ユーザーが他者に`scan_log`と`scan_kills`のみのアクセスを与えることができるようにするためです。
- CLIモードでは影響しません。

"cleanup" （クリーンアップ）
- 初回アップロード後に変数とキャッシュの設定をクリアするか否かについてのスクリプトです。`false`(偽） = いいえ; `true`（真） = はい 「Default（デフォルト設定）」。初回アップロードスキャニング以外で使用することがなければ、 `true`（真）としメモリーの使用量を最小にします。使用するのであれば、`false`（偽）とし、メモリーに不要な重複データを再ロードするのを防ぎます。通常は`true`（真）。 に設定しますが、初回アップロードスキャニングに対してしか使用できないことを覚えておいて下さい。
- CLIモードでは影響しません。

"scan_log" （スキャンログ）
- 全スキャニング結果を記録するファイルのファイル名。ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

"scan_log_serialized" （スキャンログシリアライズド）
- 全スキャニング結果を記録するファイルのファイル名（シリアル化形式を利用）。ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

"scan_kills" （スキャンキルズ）
- ブロックしたか削除したアップロードの全てを記録するファイのファイル名。ファイル名指定するか、無効にしたい場合は空白のままにして下さい。

*有用な先端： あなたがしたい場合は、ログファイルの名前に日付/時刻情報を付加することができます、名前にこれらを含めることで:完全な年のため`{yyyy}`、省略された年のため`{yy}`、月`{mm}`、日`{dd}`、時間`{hh}`。*

*例：*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"timeOffset" （タイム・オフセット）
- お使いのサーバの時刻は、ローカル時刻と一致しない場合、あなたのニーズに応じて、時間を調整するために、あなたはここにオフセットを指定することができます。しかし、その代わりに、一般的にタイムゾーンディレクティブ（あなたの`php.ini`ファイルで）を調整ーることをお勧めします、でも時々（といった、限ら共有ホスティングプロバイダでの作業時）これは何をすることは必ずしも可能ではありません、したがって、このオプションは、ここで提供されています。オフセット分であります。
- 例（１時間を追加します）：`timeOffset=60`

"ipaddr" （アイピーアドレス）
- 接続要求のIPアドレスをどこで見つけるべきかについて（Cloudflareのようなサービスに対して有効）。 Default（デフォルト設定） = REMOTE_ADDR。
- 注意：変更には最新の注意が必要です。

"enable_plugins" （イネーブル・プラグインす）
- プラグインのサポートを有効にしますか？ `false` = いいえ; `true` = はい 「Default（デフォルト設定）」。

"forbid_on_block" （フォービッド・オン・ブロック）
- アップロードファイルがブロックされたメッセージと共に、phpMusselから４０３ヘッダーを送るべきか、通常の２００でよいかどうかについて。`false`（偽） = いいえ（２００） 「Default（デフォルト設定）」； `true`（真） = はい（４０３）。

"delete_on_sight" （デリート・オン・サイト）
- このディレクティブを有効にすると、検知基準（署名でも何でも）にあったアップロードファイルは直ちに削除されます。クリーンと判断されたファイルはそのままです。アーカイブの場合、問題のファイルが一部であってもアーカイブ全てが削除の対象となります。アップロードファイルのスキャンにおいては、本ディレクティブを有効にすることは必須ではありません。なぜならPHPはスクリプト実行後に自動的にキャッシュの内容を破棄するからです。言い換えれば、ファイルが移動されたか、コピーされたか、削除されない限り、PHPはサーバーにアップロードしたファイルを残しておくことは通常ありません。このディレクティブはセキュリティーに念を入れる目的で設置されています。PHPは稀に予測外の振る舞いをすることがあるからです。`false`（偽） = スキャニング後、ファイルはそのまま（デフォルト設定）。`true`（真） = スキャニング後、クリーンでなければ直ちに削除。

"lang" （ラング）
- phpMusselのデフォルト言語を設定します。

"lang_override" （ラング・オーバーライド）
- phpMusselが、可能であれば、インバウンド要求によって宣言された言語選択により言語設定を無視すべきかを設定します（HTTP_ACCEPT_LANGUAGE）。 `false`（偽） = いいえ「Default（デフォルト）」； `true`（真） = はい。

"lang_acceptable" （ラング・アクセクタブル）
- `lang_acceptable`ディレクティブは、スクリプト`lang`からの言語かそれとも`HTTP_ACCEPT_LANGUAGE`から言語のどちらを受け入れるべきかphpMusselに指示します。このディレクティブは、カスタマイズ言語ファイルが追加された場合、あるいは言語ファイルが強制的に取り除かれた場合にのみ修正して下さい。利用可能な言語で、カンマ区切りの文字列で指定します。

"quarantine_key" （クオランティン・キ―）
- phpMusselは、必要とあれば、phpMusselのヴォルト内で独立してフラグ付ファイルのアップロードを検疫することができます。一般的なphpMusselのユーザーは、ウェブサイトやホスティング環境の保護ができれば充分と考えており、フラグ付のようなものにさらなる分析を加えようまでの要求はないようですので、無効で構いません。ですが詳細に分析してマルウェアに備えたいユーザーは有効にすると良いでしょう。フラグ付ファイルのアップロードの検疫は誤検出のデバッグに役立つことがあります。検疫機能を無効にするには、`quarantine_key`ディレクティブを空にしておくか、空でない場合はディレクティブ内のコンテンツを消去して下さい。有効にするには、デイレクティブに何らかの値を入れて下さい。`quarantine_key`は検疫機能における重要なセキュリティー要素であり、検疫機能内に保存されたデータの執行を各種の攻撃から守っています。`quarantine_key`はパスワードと同様に考えて下さい。長い方がより安全と言えます。最も効果的な使用法は`delete_on_sight`との併用です。

"quarantine_max_filesize" （クオランティン・マックス・ファイルサイズ）
- 検疫されるファイルサイズの上限。この値より大きなファイルは検疫されません。クオランティンの容量を超える異常に大きなファイルサイズによる攻撃で、メモリーが無駄に消費されるのを防ぐ意味で重要です。単位はKB、デフォルト設定は２MB
（Default/デフォルト =2048 =2048KB =2MB）です。

"quarantine_max_usage" （クオランティン・マックス・ユーセッジ）
- 検疫のために利用する最大メモリー量。全メモリー量が使用されると、この範囲内に収まるよう古いファイルが削除の対象となります。クオランティンの容量を超える異常に大きなファイルサイズによる攻撃で、メモリーが無駄に消費されるのを防ぐ意味で重要です。単位はKB、デフォルト設定は６４MB（Default/デフォルト =65536 =65536KB =64MB）です。

"honeypot_mode" （ハニーポット・モード）
- ハニーポットモードが有効になっていると、phpMusselはアップロードされてきた全てのファイルを例外なく検疫します。署名にマッチするかどうかは問題としません。スキャニングや分析もなされません。phpMusselをウィルス／マルウェアのリサーチに利用と考えているユーザーにとって有益と言えるでしょう。ただし、アップロードファイルのスキャニングという点からは、あまり推奨できませんし、ハニーポット・モードを本来の目的以外に使用することもお勧めできません。デフォルト設定では無効です。`false`（偽） = Disabled（無効） 「Default（デフォルト）」； `true`（真） = Enabled（有効）。

"scan_cache_expiry" （スキャン・キャッシュ・エクスパイヤリー）
- phpMusselはスキャニング結果をどれくらいの期間キャッシュすべきか？秒単位で、デフォルトは２１，６００秒（６時間）となっています。０にするとキャッシュ無効になります。

"disable_cli" （ディスエイブル・シーエルアイ）
- CLIモードを無効にするか？CLIモード（シーエルアイ・モード）はデフォルトでは有効になっていますが、テストツール（PHPUnit等）やCLIベースのアプリケーションと干渉しあう可能性が無いとは言い切れません。CLIモードを無効にする必要がなければ、このデレクティブは無視してもらって結構です。 `false`（偽） = CLIモードを有効にします「Default（デフォルルト）」； `true`（真） = CLIモードを無効にします。

"disable_frontend" （ディスエイブル・フロントエンド）
- フロントエンドへのアクセスを無効にするか？フロントエンドへのアクセスは、phpMusselをより管理しやすくすることができます。前記、それはまた、潜在的なセキュリティリスクになる可能性があります。バックエンドを経由して管理することをお勧めします、しかし、これが不可能な場合、フロントエンドへのアクセスが提供され。あなたがそれを必要としない限り、それを無効にします。 `false`（偽） = フロントエンドへのアクセスを有効にします； `true`（真） = フロントエンドへのアクセスを無効にします「Default（デフォルルト）」。

####"signatures" （シグニチャーズ、カテゴリ）
署名（シグニチャ）の設定。
- %%%_clamav = ClamAV署名（メインとデイリーの両方）。
- %%%_custom = カスタム署名（作成した場合）。
- %%%_mussel = ClamAVからでなく、ユーザーの現在の署名に含まれるphpMussel署名。

スキャニング時にMD5署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

スキャニング時に一般署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "general_clamav"
- "general_custom"
- "general_mussel"

スキャニング時に正規ASCII署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

スキャニング時に正規HTML署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "html_clamav"
- "html_custom"
- "html_mussel"

スキャニング時にPE（ポータブル・エグゼキュータブル）ファイル（EXE, DLL等）をPEセクショナル署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

スキャニング時にPE（ポータブル・エグゼキュータブル）ファイル（EXE, DLL等）をPE拡張署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "pex_custom"
- "pex_mussel"

スキャニング時にPE（ポータブル・エグゼキュータブル）ファイル（EXE, DLL等）をPE署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

スキャニング時にELFファイルをELF署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

スキャニング時にMach-Oファイル（OSX、など）をMach-O署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

スキャニング時にグラフィックファイルをグラフィックベース署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

スキャニング時にアーカイブコンテンツをアーカイブメタデータ署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

スキャニング時にOLEオブジェクトをOLE署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

スキャニング時にファイル名をファイル名ベース署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

スキャンする際に、電子メール署名を使用しますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

ファイル特定ホワイトリストを有効にしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

スキャニング時にXML/XDPチャンクをXML/XDP署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

スキャニング時に複合拡張署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

スキャニング時にPDF署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

ショックウェーブ署名に対してチェックしますか？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

署名マッチング長さ制限オプション。理解の上、変更して下さい。SD = スタンダード署名、RX = PCRE（Perl適合正規表現、あるいは"Regex"）署名、FN =ファイル名署名。phpMusselがスキャンしようした時にPHPがクラッシュするようなら、最大値を下げてみて下さい。どのような状況で発生するか、何を試して結果どうだったか、お知らせ頂ければ幸いです。
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently" （フェイル・サイレントリー）
- 署名ファイルがない、あるいは破損している場合に、phpMusselがそれをリポートすべきか否か？`fail_silently`が無効ならば、問題はリポートされ、有効であれば、問題は無視されたスキャニングレポートが作成されます。クラッシュするというような害がなければ、デフォルト設定のままにしておくべきです。 `false`（偽） = Disabled（無効）; `true`（真） = Enabled（有効） 「Default（デフォルト）」

"fail_extensions_silently" （フェイル・エクステンションズ・サイレントリー）
- 拡張子がない場合にphpMusselがそれをレポートすべきか否か？`fail_extensions_silently`が無効の場合、拡張子なしはスキャニング時にレポートされ、有効の場合は無視され問題は報告されません。このディレクティブを無効にすることは、セキュリティーを向上させるかもしれませんが、誤検出も増加する恐れがあります。 `false`（偽） = Disabled（無効）; `true`（真） = Enabled（有効） 「Default（デフォルト）」

"detect_adware" （ディテクト・アドウェア）
- phpMusselはアドウェア検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

"detect_joke_hoax" （ディテクト・ジョーク・ホークス）
- phpMusselは悪戯／偽造やマルウェア／ウィルス検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

"detect_pua_pup" （ディテクト・PUA・PUP）
- phpMusselはPUAs/PUPs検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

"detect_packer_packed" （ディテクト・パッカー・パックト）
- phpMusselはパッカーやパックデータ検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

"detect_shell" （ディテクト・シェル）
- phpMusselはshellスクリプト検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

"detect_deface" （ディテクト・ディフェーサ）
- phpMusselは改ざんやディフェーサー検出のために署名を分析すべきか否か？ `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

####"files" （ファイルズ、カテゴリー）
ファイル取扱い設定。

"max_uploads" （マックス・アップローズ）
- 一度にスキャンできるアップロードファイル数の上限で、これを超えるとスキャンを中断し、ユーザーにその旨を知らせ、論理攻撃からの保護として機能します。システムやCMSがDDoS攻撃にあい、phpMusselがオーバーロードしてPHPプロセスに支障をきたすことがないようにするためです。推奨数は１０ですが、ハードウェアのスピードによっては、これ以上／以下がよいということもあるでしょう。この数は、アーカイブのコンテンツは含まないことを覚えておいて下さい。

"filesize_limit" （ファイルサイズ・リミット）
- ファイルサイズ上限の単位はKｂです。. 65536 = 64MB 「Default（デフォルト）」； 0 = リミットしません（上限なし、常にグレイリスト化）、正の数値であれば何でも構いません。PHPの設定でメモリーに制限があったり、アップロードファイルサイズの上限が設定されている場合に有効的です。

"filesize_response" （ファイルサイズ・レスポンス）
- 上限サイズを超えるファイルをどう処理するかについてです。 `false`（偽） = Whitelist（ホワイトリスト）; `true`（真） = Blacklist（ブラックリスト） 「Default（デフォルト）」

"filetype_whitelist" （ファイルタイプ・ホワイトリスト）、 "filetype_blacklist" （ファイルタイプ・ブラックリスト）、 "filetype_greylist" （ファイルタイプ・グレーリスト）
- システムが特定タイプのファイルのみアップロードを許可する、あるいは拒絶する場合は、ファイルタイプを適切にホワイトリスト、ブラックリスト、グレーリストにて分類しておくと、ファイルタイプによって弾かれるファイルはスキャンをスキップできるため、スピードアップに繋がります。フォーマットはCSV（カンマ区切り）です。リストによらず全てをスキャンしたい場合は、変数は空白のままとし、ホワイトリスト／ブラックリスト／グレーリストを無効にします。
- プロセスの論理的順序:
 - ファイルタイプがホワイトリストに記載されていれば、スキャンせず、ブロックせず、ブラックリストおよびグレイリストに対してチェックを行いません。
 - ファイルタイプがブラックリストに記載されていれば、スキャンすることなく、直ちににブロックし、グレーリストに対してチェックを行いません。
 - グレーリストが空、あるいはグレーリストが空でなくかつそのファイルタイプがあれば、通常通りスキャンしブロックするか否かを判断します。グレーリストが空でなくかつそのファイルタイプが含まれていなければ、ブラックリストと同様の扱いをすることになり、スキャンなしにブロックします。

"check_archives" （チェック・アーカイブズ）
- アーカイブのコンテンツに対してチェックを試みるか否かについてです。 `false`（偽） = チェックしない; `true`（真） = チェックする「Default（デフォルト）」
- 現在サポートしているのはBZ、GZ、 LZF、 ZIP形式です（RAR、CAB、7z等は対象外）。
- 本機能は万能ではありませんので、有効にしておくことを推奨していますが、必ず全てを検出することを保証するものではありません。
- また現在チェックのアーカイブはZIPに対して再帰的でないことに注意して下さい。

"filesize_archives" （ファイルサイズ・アーカイブズ）
- ファイルサイズのブラックリスト化／ホワイトリスト化をアーカイブのコンテンツに持ち込むか否か？ `false` = いいえ（ただグレーリストすべて）; `true` = はい 「Default（デフォルト設定）」。

"filetype_archives" （ファイルタイプ・アーカイブズ）
- ファイルタイプのブラックリスト化／ホワイトリスト化をアーカイブのコンテンツに持ち込むか否か？ `false` = いいえ（ただグレーリストすべて） 「Default（デフォルト設定）」; `true` = はい。

"max_recursion" （マックス・リカーション）
- アーカイブに対する最大再帰深さです。デフォルト＝１０

"block_encrypted_archives" （ブロック・エンクリプティッド・アーカイブズ）
- 暗号化されたアーカイブを検出しブロックするか否か？phpMusselは暗号化されたアーカイブをスキャンすることはできないので、アーカイブの暗号化によってphpMussel、アンチウィルススキャナー等をかいくぐろうとする攻撃者がいるかもしれません。暗号化されたアーカイブをブロックすることにより、このようなリスクを回避することができます。 `false`（偽） = いいえ; `true`（真） = はい 「Default（デフォルト）」

####"attack_specific" （アタック・スペシフィック、カテゴリー）
アタックースペシフィック　ディレクティブ。

キャメロンアタック検出。 `false`（偽） = オフ; `true`（真） = オン

"chameleon_from_php" （キャメロン・フロム・ピーエイチピー）
- ファイルでもなくPHPアーカイブとも認識できないファイル中のPHPヘッダーを探します。

"chameleon_from_exe" （キャメロン・フロム・エグゼ）
- 実行ファイルでもなく実行ファイルのアーカイブとも認識できないファイル中の実行ヘッダーや不正なヘッダーの実行ファイルを探します。

"chameleon_to_archive" （キャメロン・トゥ・アーカイブ）
- ヘッダーが正しくないアーカイブを探します（BZ、GZ、RAR、ZIP、RAR、GZをサポート）。

"chameleon_to_doc" （キャメロン・トゥ・ドク）
- ヘッダーが正しくないオフィスドキュメントを探します（DOC、DOT、PPS、PPT、XLA、XLS、WIZをサポート）。

"chameleon_to_img" （キャメロン・トゥ・アイエムジー）
- ヘッダーが正しくない画像ファイルを探します（BMP、DIB、PNG、GIF、JPEG、JPG、XCF、PSD、PDD、WEBPをサポート）。

"chameleon_to_pdf" （キャメロン・トゥ・ピーディーエフ）
- ヘッダーが正しくないPDFファイルを探します。

"archive_file_extensions" （アーカイブ・ファイル・エクステンション） と "archive_file_extensions_wc" （アーカイブ・ファイル・エクステンション・ダブリューシー）
- 認識可能なアーカイブファイルエクステンションです（フォーマットはCSV；問題があった場合にのみ追加あるいは取り除くべきです。不用意に取り除くと誤検出の原因となる可能性があります。反対に不用意に追加すると、アタックースペシフィック検出から追加したものをホワイトリスト化してしまいます。充分に注意に上、変更して下さい。なお、コンテントレベルにおいてアーカイブを分析することが出来るか否かには影響しません）。デフォルトでは最も一般なフォーマットをリストしていますが、意図的に包括的にはしていません。

"general_commands" （ジェネラル・コマンズ）
- `eval()`や`exec()`といった通常のコマンドがファイルに含まれていないか調べます。ブラウザを介してPHP、JavaScript、HTML、python、perlといったファイルをシステムおよびCMSにアップロードすることあるならば無効にして下さい。他にプロテクションがなく、かつ前述のファイルをアップロードすることがなければ有効にします。phpMusselをZB Blockなどと併せて用いセキュリティーの向上を目的としているなら、本オプション機能をオンにする必要はないでしょう。なぜなら、phpMusselが探すものは（この意味において）既に存在するプロテクションと同じ物であり、機能が重複するだけだからです。`false`（偽） = チェックしない「Default（デフォルト）」； `true`（真） = チェックする。

"block_control_characters" （ブロック・コントロール・キャラクターズ）
- 制御文字を含んだファイルをブロックするか否か（改行以外）？についてです（[\x00-\x08\x0b\x0c\x0e\x1f\x7f]）。もし、テキストのみをアップロードするなら、このオプションを有効にして、さらにプロテクションを強化できます。テキスト以外もアップロード対象であれば、有効にすると誤検出の原因になりえます。`false`（偽） = ブロックしない「Default（デフォルト）」； `true`（真） = ブロックする。

"corrupted_exe" （コラプティッド・エグゼ）
- 破損ファイルとエラー解析。`false`（偽） = 無視する； `true`（真） = ブロックする「Default（デフォルト）」。破損の可能性があるPEファイルをブロックし検出するか否か？についてです。PEファイルの一部が破損し、正しく分析できないことは珍しくなく、ウィルス感染をみるバロメーターになります。PEファイル内のウィルスを検出するアンチウィルスプログラムは、PEファイルの解析を行いますが、ウィルスを作る側では、ウィルスが検出されないようそれを避けようとするものだからです。

"decode_threshold" （デコード・スレッシュホールド）
- デコード・コマンドが検出されるべき生データの長さの制限あるいはしきい値（スキャニング中に顕著な問題がある場合に必要に応じて設定）。値はファイルサイズを示す整数値で単位はKB。デフォルト＝５１２（５１２KB）。ゼロあるいは値なし（null）はしきい値を無効化します（ファイルサイズによる制限を取り除きます）。

"scannable_threshold" （スキャナブル・スレッシュホールド）
- phpMusselが読みスキャンしてよい生データの長さの制限あるいはしきい値（スキャニング中に顕著な問題がある場合に必要に応じて設定）。値はファイルサイズを示す整数値で単位はKb。デフォルト＝32768（32MB）。ゼロあるいは値なし（null）はしきい値を無効化します。値は、サーバーやウェブサイトでアップロードされるファイルの平均ファイルサイズより大きく、filesize_limitディレクティブより小さく設定すべきです。またphp.ini設定によってPHPに割り当てられたメモリーのおおよそ5分の１を超えるべきではありません。このディレクティブはphpMusselがメモリーを使い過ぎないようにするためのものです。（一定のサイズ以上のファイルはスキャンできなくなることもあります）。

####"compatibility" （コンパーティブリティ、カテゴリ）
phpMusselの互換性ディレクティブ。

"ignore_upload_errors" （イグノア・アップロード・エラーズ）
- システム上でphpMusselの機能に修正が必要でない限りはこのディレクティブは通常無効です。無効に設定すると、`$_FILES` array()に要素の存在を検知したとき、その要素が表すファイルのスキャンが開始され、要素が空白か無であればphpMusselはエラーメッセージを返します。これは本来phpMusselがあるべき姿です。しかしCMSにおいては、$_FILESの空要素は普通に発生するものであり、正常なphpMusselの挙動が正常なCMSの挙動を阻害する恐れがあります。このような場合は、本オプションを有効にして、phpMusselが空要素をスキャンしてエラーメッセージを返すのを避け、要求のあったページへスムーズに進むことができるようにします。`false`（偽） = OFF （オフ）； `true`（真） = ON （オン）です。

"only_allow_images" （オンリー・アロウ・イメージ）
- システムあるいはCMSに画像ファイルのアップロードのみを許可するのであれば、このディレクティブは有効にすべきであり、そうでなければ無効とします。有効にすると、画像と特定できないファイルはスキャンすることなしにブロックしますので、プロセス時間の短縮とメモリーの節約が期待できます。`false`（偽） = OFF （オフ）； `true`（真） = ON （オン） です。

####"heuristic" （ヒューリスティック、カテゴリ）
ヒューリスティック・ディレクティブズ。

"threshold" （スレッシュホールド）
- phpMusselには、このファイルは疑わしく危険性が高いと判断する署名があります。しきい値は、アップロードされているファイルの危険性の最大値であり、これを超えるとマルウェアと判断されます。ここにおける危険性の定義とは、疑わしいと特定されたものの総数です。デフォルトでは３に設定されています。これより低いと誤検出の可能性が増え、大きすぎると、誤検出は減るものの危険性のあるファイルが検出されない可能性が増加してしまいます。特に問題がなければ、デフォルト値のままにしておくことお勧めします。

####"virustotal" （ウィルストータル、カテゴリ）
VirusTotal.comディレクティブズ。

"vt_public_api_key" （ヴィティ・パブリック・エイピーアイ・キー）
- オプションですが、phpMusselはVirus Total APIを使ってファイルをスキャンすることができます。ウィルス、トロイの木馬、マルウェア、その他の攻撃に対して非常に効果的に機能します。デフォルトではVirus Total APIを使ったスキャニングは無効になっています。有効にするには、Virus TotalのAPIキーが必要です。メリットが極めて大きいため、有効にすることを強く推奨します。Virus Total APIの使用にあたっては、Virus Totalのドキュメンテーションにある通り、利用規定ならびにガイドラインを遵守しなくてはなりません。この統合機能を使用するためには、
 - Virus TotalとAPIのサービス規定を読み同意すること。[サービス規定はこちらから](https://www.virustotal.com/en/about/terms-of-service/)。
 - 最低でもVirus Total Public APIドキュメンテーションの前文を読み理解すること（VirusTotalPublic API v2.0以降Contents（コンテンツ）前まで）Virus Total Public APIの[ドキュメンテーションはこちらから](https://www.virustotal.com/en/documentation/public-api/)。

注意：Virus Total API使用したスキャニングが無効になっている場合、このカテゴリー（`virustotal`）のディレクティブを参照する必要はありません。無効であれば、どれも機能しません。Virus Total APIキーを取得するには、Virus Totalのサイトのページ右上にあるリンク「コミュニティに参加」をクリックして、必要事項を記入しサインアップします。インストラクションに従ってパブリックAPIキーを取得した後、`config.ini`設定ファイルの`vt_public_api_key`ディレクティブのそれをコピー＆ペーストして下さい。

"vt_suspicion_level" （ヴィティ・サスピション・レベル）
- デフォルト設定では、phpMusselがVirus Total APIを使ってスキャンするファイル（疑がわしいもの）には制限があります。`vt_suspicion_level`ディレクティブを編集することのより、この制限を変更することが可能です。
- `0`： phpMusselの署名を使ってスキャンした結果、ヒューリスティックな重みがあると判断された場合にのみ、疑わしいファイルと結論付けられます。すなわちTotal APIは、phpMusselが危険性を察知はしたが完全にそうとは言い切れず、したがってブロックもせず、フラグを付けることもしなかった時のセカンドオピニオンです。
- `1`： phpMusselの署名を使ってスキャンした結果、実行ファイルと思われる（PEファイル、Mach-O ファイル、ELF/Linuxファイル等）、ないしは実行可能なデータを含んだフォーマット（マクロ、DOC/DOCXファイル、アーカイブRARs／ZIPSファイル等)があれば、ヒューリスティックな重みがあるとして疑わしいファイルと結論付けられます。これはデフォルト設定であり、推奨レベルでもあります。Virus Total APIは、phpMusselが危険性なしと判断し、したがってブロックもせず、フラグを付けることもしなかった時のセカンドオピニオンです。
- `2`： ファイルは全て疑わしいものとされ、Virus Total APIを使ってスキャンされます。API割り当てを使い切る恐れがあるため、推奨は控えますが、状況によっては適切と言えるでしょう（例えば、ウェブマスターやホストマスターがアップロードされる内容を信頼できない状況等）。この警戒レベルでは、通常ブロック／フラグも対象にならないファイルも全てVirus Total APIを使ってスキャンされます。したがって、Virus Total APIの割り当てを早々に消費してしまうこともあり得、またAPI割り当てを使い切れば、phpMusselはVirus Total APIの使用を中止します（警戒レベルに関係なく）。

注意：phpMusselによってブラックリスト化、ホワイトリスト化されたファイルはVirus Total APIを使ったスキャンの対象にはなりません。これらは既に善悪が結論付けられたものであり、Virus Total APIで再びスキャンする必要性はないためです。phpMusseがVirus Total APIを利用するのは、phpMusse自身が危険性の有無について判断しかねる状況においての補助と言えます。

"vt_weighting" （ヴィティ・ウェイティング）
- phpMusselがVirus Total APIを使ったスキャニング結果を検出として扱うか、検出の重み付けとして扱うべきか？複数のエンジン（Virus Totalのように）を使用したスキャニングは、検出率の向上（より多くのマルウェアが検出）をもたらす一方で誤検出の増加も招くため、このディレクティブが存在します。したがって、スキャニング結果は、決定的判断ではなく信頼スコアとして利用した方が適当なケースもあります。値が０の場合、Virus Total APIを使ったスキャンは検出として扱われ、Virus Totalのエンジンがマルウェアとフラグを付けたファイルは、phpMusselもマルウェアと判断します。その他の値の場合は結果は検出の重み付けとなり、スキャンされたファイルがマルウェアかどうかphpMusselが判断するための信頼スコア（あるいは検出の重み付け）となります（値はマルウェアと判断するための最小信頼スコア、あるいは重み）。デフォルト値は０です。

"vt_quota_rate" （ヴィティ・クォータ・レート） と "vt_quota_time" （ヴィティ・クォータ・タイム）
- Virus Total APIのドキュメンテーションによると「１分間のタイムフレームの間にリクエストは最大４回」の上限があります。ハニークライアントやハニーポット等のオートメーションを使用し、リポートを受け取るだけでなく、VirusTotal にリソースを提供していれば、上限は引き上げられます。phpMussel のデフォルトでは最大４回を遵守していますが、前述の事情から、この２つのディレクトリを準備し、状況に合わせて変更できるようになっています。制限に達してしまうといった不都合や問題がない限りデフォルト値を変更することは勧められませんが、値を小さくすることが適当なケースもあります。上限はタイムフレーム`vt_quota_time`（ヴィティ・クォータ・タイム）「 分内に」`vt_quota_rate`（ヴィティ・クォータ・レート）で設定します。

####"urlscanner" （ユーアールエルスキャナー、カテゴリ）
URLスキャナー設定。

"urlscanner" （ユーアールエルスキャナー）
- phpMusselにはURLスキャナーがビルトインされていて、スキャンされたファイルやデータ内の悪質なURLを検出することができます。URLスキャナーを有効にするには`urlscanner`（ユーアールエルスキャナー）ディレクティブを`true`（真）、無効にするには`false`（偽）にして下さい。

注意：URLスキャナーが無効の場合、このカテゴリー（`urlscanner`）を参照する必要はありません。

URLスキャナーAPIルックアップ設定。

"lookup_hphosts" （ルックアップ・エイチピーホスツ）
- Trueにすると、APIの[hpHosts](http://hosts-file.net/)ルックアップが有効になります。hpHostsはAPIルックアップを実行するのに API鍵を必要としません。

"google_api_key" （グーグル・エーピーアイ・キー）
- 必要なAPI鍵が定義されれば、APIのGoogle Safe Browsing APIルックアップが有効になります。Google Safe Browsing APIルックアップスに必要なAPI鍵は、[から取得することができます](https://console.developers.google.com/)。
- 注意：Google Safe Browsing APIルックアップはまだ完成していないので、将来的な利用を想定しています。

"maximum_api_lookups" （マクシマム・エーピーアイ・ルックアップス）
- スキャン反復におけるAPIルックアップの最大回数。APIルックアップの度にスキャン反復の時間が積み重なってしまうので、スキャン処理の速度向上のため、制限を設けたいと考えるかもしれません。０は制限なしを意味します。デフォルトは１０です。

"maximum_api_lookups_response" （マクシマム・エーピーアイ・ルックアップス・レスポンス）
- APIルックアップの回数制限を超えた時の対応です。`false`（偽） = 何もしない（処理を継続する）「Default（デフォルト）」;`true`（真） = ファイルにフラグを付ける／ブロックする。

"cache_time" （キャッシュ・タイム）
- APIルックアップの結果をどれくらいキャッシュするか（秒単位です）？デフォルトは３６００秒（一時間）。

####"template_data" （テンプレート・データ、カテゴリ）
テンプレートとテーマ用のディレクティブ／変数。

テンプレートのデータは、ユーザーに向けてアップロード拒否のメッセージをHTML形式でアウトプットする際に使用されます。カスタムテーマを使っている場合は`template_custom.html`を使用して、そうでない場合は`template.html`を使用してHTMLアウトプットが生成されます。設定ファイル内にあるこのセクション用の変数は、HTMLアウトプットのために解析され、で囲まれた変数名は対応する変数データに置き換えられます。例えば`foo="bar"`とすると、HTMLアウトプット内の`<p>{foo}</p>`は`<p>bar</p>`となります。

"css_url" （シーエスエス・ユーアールエル）
- カスタムテーマ用のテンプレートファイルは、外部CSSプロパティーを使っています。一方、デフォルトテーマは内部CSSです。カスタムテーマを適用するためには、CSSファイルのパブリック HTTPアドレスを"css_url"変数を使って指定して下さい。この変数が空白であれば、デフォルトテーマが適用されます。

---


###8. <a name="SECTION8"></a>署名（シグニチャ）フォーマット

####*ファイル名署名*
ファイル名署名のフォーマットは例外なく次のようになります。

`NAME:FNRX`

NAMEはその署名を指す名前でFNRXはファイル名（エンコードされていない）にマッチする正規表現パターンです。

####*MD5署名*
MD5署名のフォーマットは例外なく次のようになります。

`HASH:FILESIZE:NAME`

HASHは全ファイルのMD5 ハッシュ、FILESIZEはファイルの全サイズ、NAMEはその署名を指す名前です。

####*アーカイブ・メタデータ署名*
アーカイブ・メタデータ署名のフォーマットは例外なく次のようになります。

`NAME:FILESIZE:CRC32`

NAMEはその署名を指す名前、FILESIZEはアーカイブに含まれるファイルサイズ（解凍後）トータル、CRC32は含まれるファイルのCRC32チェックサムです。

####*PEセクショナル署名*
PEセクショナル署名のフォーマットは例外なく次のようになります。

`SIZE:HASH:NAME`

HASHはPEファイルのある部分のMD5ハッシュ、SIZEはその部分の全サイズ、NAMEは署名を指す名前です。

####*PE拡張署名*
PE拡張署名のフォーマットは例外なく次のようになります。

`$VAR:HASH:SIZE:NAME`

$VARはマッチするPE変数の名前、HASHはその変数のMD5ハッシュ、サイズは変数の全サイズ、NAMEはその署名を指す名前です。

####*ホワイトリスト署名*
ホワイトリスト署名のフォーマットは例外なく次のようになります。

`HASH:FILESIZE:TYPE`

HASHは全ファイルのMD5ハッシュ、FILESIZEはそのファイルの全サイズ、TYPEはホワイトリスト化されたファイルが攻撃を受ける恐れのないの署名タイプです。

####*複合拡張署名*
複合拡張署名は他の署名とは少し違い、何に適合するかはそれ自身の署名によって決まり、基準は一つではありません。適合基準は「;」により、適合タイプ、適合データは「:」によります。したがってフォーマットは、$変数１:何らかのデータ;$変数２:SOMEDATA;何らかのデータのようになります。

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

####*その他*
その他の署名のフォーマットです。

`NAME:HEX:FROM:TO`

NAMEはその署名を指す名前、HEXは与えられた署名により適合を見るファイルの１６進法にエンコードされたセグメントです。FROMとTOはオプション・パラメータで、データソースのどこからどこまでチェックするかを示します（メール機能ではサポートしていません）。

####*正規表現*
PHPが正規表現と判断し処理するフォーマットであれば、phpMusselと署名によって間違いなく処理されます。しかし念のため、署名を基礎とする正規表現を新規に作成する場合は細心の注意を払って下さい。絶対的な自信がない状況では、思いもしないエラーが発生しかねません。正規表現ステートメントが解析されているコンテキストを完全に理解していないならば、phpMusselのコードを見て下さい。パターンは全て（ファイル名、アーカイブ・メタデータ、MD5 パターンを除く）１６進法でエンコードされなければならない点に注意(上記のパターン構文も)です！

####*カスタム署名の場所*
カスタム署名は、カスタム署名があるべきファイルに置いて下さい。ファイル名は"_custom"を含むものとします。加えて、デフォルト署名ファイルを編集するのは可能な限り避けるべきで、一般的に推奨されるだけでなく、あるいは自身の署名とphpMusselのデフォルト署名の区別という観点だけなく、デフォルト署名ファイルの改ざんは、"maps"ファイルとの関係で正常な機能を阻害する恐れがあります。というのも、mapsファイルによりphpMusselは署名ファイルのどこを探すか判断するためです。改ざんによりmapsと関連署名ファイルの同期は破壊されかねません。構文さえ守れば、カスタム署名にはかなりの自由度がありますが、稼働環境では十分な注意が必要で、新しい署名は誤検出のテストを欠かさずに行って下さい。

####*署名詳細*
phpMusselが使う署名タイプの詳細です。
- "正規ASCII署名" (ascii_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツに対して使用されます。
- "複合拡張署名" (coex_*)　ミックスした署名タイプのマッチングです。
- "ELF署名" (elf_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツに対して使用され、 ELFフォーマットへの適合をみます。
- "ポータブル実行署名" (exe_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツに対して使用され、PEフォーマットへの適合をみます。
- "ファイル名署名" (filenames_*)　スキャン対象ファイルのファイル名に対して使用されます。
- "一般署名" (general_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツに対して使用されます。
- "グラフィック署名" (graphics_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツに対して使用され、既知のグラフィカルファイルフォーマットへの適合をみます。
- "一般コマンド" (hex_general_commands.csv)　スキャン対象ファイルがホワイトリスト化されていないファイルのコンテンツに対して使用されます。
- "正規ＨＴＭＬ署名" (html_*)　スキャン対象ファイルがホワイトリスト化されていないＨＴＭＬファイル場合、そのコンテンツに対して使用されます。
- "マッチＯ署名" (macho_*) スキャン対象ファイルがホワイトリスト化されていない場合、そのファイルのコンテンツに対して使用され、マッチＯフォーマットへの適合をみます。
- "Ｅメール署名" (mail_*)　スキャン対象ファイルがホワイトリスト化されていないEMLファイルの場合、そのコンテンツに対して使用されます。
- "MD5署名" (md5_*)　スキャン対象ファイルがホワイトリスト化されていない場合、そのコンテンツのMD5ハッシュ、ファイルサイズに対して使用されます。
- "アーカイブメタデータ署名" (metadata_*) スキャン対象ファイルがホワイトリスト化されていないアーカイブを含む場合、スキャン対象ファイルのCRC32ハッシュとファイルサイズに対して使用されます。
- "OLE署名" (ole_*) スキャン対象ファイルがホワイトリスト化されていないOLEオブジェクトの場合、そのコンテンツに対して使用されます。
- "PDF署名" (pdf_*)　スキャン対象ファイルがホワイトリスト化されていないPDFファイルの場合、そのコンテンツに対して使用されます。
- "ポータブル実行セクショナル署名" (pe_*)　スキャン対象ファイルがホワイトリスト化されていない場合、全てのPE部分のMD5ハッシュとファイルサイズに対して使用され、PEフォーマットへの適合をみます。
- "ポータブル実行拡張署名" (pex_*)　スキャン対象ファイルがホワイトリスト化されていない場合、ファイル内のMD5ハッシュと変数のサイズに対して使用され、PEフォーマットへの適合をみます。
- "SWF署名" (swf_*)　スキャン対象ファイルがホワイトリスト化されていないショックウェーブファイルの場合、そのコンテンツに対して使用されます。
- "ホワイトリスト署名" (whitelist_*)　スキャン対象ファイルのコンテンツのMD5ハッシュとファイルサイズに対して使用されます。適合ファイルは、ホワイトリスト・エントリー内に記載された署名タイプへの適合性を必要としません。
- "XML/XDP署名 " (xmlxdp_*)　スキャン対象ファイルがホワイトリスト化されていない場合、ファイル内で確認されたXML/XDPに対して使用されます。
（注意：これらの署名は`config.ini`において容易に無効設定できます）。

---


###9. <a name="SECTION9"></a>適合性問題

####PHPとPCRE
- phpMusselが正しく動作するためにはPHPとPCREが必要です。どちらか一方でも欠けると正常に機能しません。システムにPHPとPCREの両方がインストールされていることをphpMusselダウンロード前に確認して下さい。

####アンチウィルスソフトウェアとの互換性

phpMusselは大概のウィルススキャンソフトウェアに対して互換性があります。しかし、過去にはユーザーから非互換性の報告があったのも確かです。以下の情報はVirusTotal.comによるものであり、phpMusselに対しアンチウィルスプログラムによって報告された誤検出を記載しています。phpMusselと使用中のアンチウィルスソフトウェアの互換性問題が記載通りに必ず発生する、あるいは発生しないことを保証するものではありませんが、もしアンチウィルスソフトウェアとphpMusselの動作に顕著な矛盾が認められるようなら、使用にあたってどちらか一方を無効にするなどの対策を検討すべきでしょう。

以下の情報は、2016年8月29日にアップデートされ、本稿執筆時におけるphpMussel最新マイナーバージョン（v0.10.0-v1.0.0）の現況です。

| スキャナ | 結果 |
|----------------------|--------------------------------------|
| Ad-Aware | 問題は報告されていません |
| AegisLab | 問題は報告されていません |
| Agnitum | 問題は報告されていません |
| AhnLab-V3 | 問題は報告されていません |
| Alibaba | 問題は報告されていません |
| ALYac | 問題は報告されていません |
| AntiVir | 問題は報告されていません |
| Antiy-AVL | 問題は報告されていません |
| Arcabit | 問題は報告されていません |
| Avast | リポート "JS:ScriptSH-inf [Trj]" |
| AVG | 問題は報告されていません |
| Avira | 問題は報告されていません |
| AVware | 問題は報告されていません |
| Baidu | リポート "VBS.Trojan.VBSWG.a" |
| Baidu-International | 問題は報告されていません |
| BitDefender | 問題は報告されていません |
| Bkav | リポート "VEXC640.Webshell"、 "VEXD737.Webshell"、 "VEX5824.Webshell"、 "VEXEFFC.Webshell"|
| ByteHero | 問題は報告されていません |
| CAT-QuickHeal | 問題は報告されていません |
| ClamAV | 問題は報告されていません |
| CMC | 問題は報告されていません |
| Commtouch | 問題は報告されていません |
| Comodo | 問題は報告されていません |
| Cyren | 問題は報告されていません |
| DrWeb | 問題は報告されていません |
| Emsisoft | 問題は報告されていません |
| ESET-NOD32 | 問題は報告されていません |
| F-Prot | 問題は報告されていません |
| F-Secure | 問題は報告されていません |
| Fortinet | 問題は報告されていません |
| GData | 問題は報告されていません |
| Ikarus | 問題は報告されていません |
| Jiangmin | 問題は報告されていません |
| K7AntiVirus | 問題は報告されていません |
| K7GW | 問題は報告されていません |
| Kaspersky | 問題は報告されていません |
| Kingsoft | 問題は報告されていません |
| Malwarebytes | 問題は報告されていません |
| McAfee | リポート "New Script.c" |
| McAfee-GW-Edition | リポート "New Script.c" |
| Microsoft | 問題は報告されていません |
| MicroWorld-eScan | 問題は報告されていません |
| NANO-Antivirus | 問題は報告されていません |
| Norman | 問題は報告されていません |
| nProtect | 問題は報告されていません |
| Panda | 問題は報告されていません |
| Qihoo-360 | 問題は報告されていません |
| Rising | 問題は報告されていません |
| Sophos | 問題は報告されていません |
| SUPERAntiSpyware | 問題は報告されていません |
| Symantec | 問題は報告されていません |
| Tencent | 問題は報告されていません |
| TheHacker | 問題は報告されていません |
| TotalDefense | 問題は報告されていません |
| TrendMicro | 問題は報告されていません |
| TrendMicro-HouseCall | 問題は報告されていません |
| VBA32 | 問題は報告されていません |
| VIPRE | 問題は報告されていません |
| ViRobot | 問題は報告されていません |
| Zillya | 問題は報告されていません |
| Zoner | 問題は報告されていません |

---


###10. <a name="SECTION10"></a>よくある質問（FAQ）

####「偽陽性」とは何ですか？

用語「偽陽性」（*または：偽陽性のエラー、虚報；* 英語： *false positive*; *false positive error*; *false alarm*）、非常に簡単に説明し、一般化文脈で、is used when testing for a condition, to refer to the results of that test, when the results are 陽性（即ち、 the condition is determined to be 「陽性」、または、「真」), but are expected to be (or should have been) 陰性 （即ち、 the condition, in reality, is 「陰性」、または、「偽」）。 A 「偽陽性」 could be considered analogous to "crying wolf" （wherein the condition being tested is whether there's a wolf near the herd, the condition is 「偽」 in that there's no wolf near the herd, and the condition is reported as 「陽性」 by the shepherd by way of calling 「オオカミ、オオカミ」）、 or analogous to situations in medical testing wherein a patient is diagnosed as having some illness or disease, when in reality, they have no such illness or disease.

いくつかの関連する用語は、「真陽性」、「真陰性」、と「偽陰性」です。「真陽性」 refers to when the test results and the actual state of the condition are both 真 (or 「陽性」), and a 「真陰性」 refers to when the test results and the actual state of the condition are both 偽 (or 「陰性」); A 「真陽性」 or a 「真陰性」 is considered to be a 「正しい推論」. The antithesis of a 「偽陽性」 is a 「偽陰性」; A 「偽陰性」 refers to when the test results are 陰性 （即ち、 the condition is determined to be 「陰性」、または、「偽」), but are expected to be (or should have been) 陽性 （即ち、 the condition, in reality, is 「陽性」、または、「真」）。

In the context of phpMussel, these 用語 refer to the signatures of phpMussel and the files that they block. When phpMussel blocks a file due to bad, outdated or incorrect signatures, but shouldn't have done so, or when it does so for the wrong reasons, 我々はこのイベント「偽陽性」のを呼び出します。 When phpMussel fails to block a file that should have been blocked, due to unforeseen threats, missing signatures or shortfalls in its signatures, 我々はこのイベント「不在検出」のを呼び出します（「偽陰性」のアナログです）。

これは、以下の表に要約することができます。

&nbsp; | phpMusselは、ファイルをブロック必要がありません | phpMusselは、ファイルをブロック必要があります
---|---|---
phpMusselは、ファイルをブロックしません | 真陰性（正しい推論） | 不在検出 (それは「偽陰性」と同じです)
phpMusselは、ファイルをブロックします | __偽陽性__ | 真陽性（正しい推論）

---


最終アップデート： 2016年11月7日。
