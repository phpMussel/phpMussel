## phpMusselのドキュメンテーション（日本語）。

### 目次
- 1. [序文](#SECTION1)
- 2A. [インストール方法（ウェブサーバー編）](#SECTION2A)
- 2B. [インストール方法（CLI編）](#SECTION2B)
- 3A. [使用方法（ウェーブサーバー編）](#SECTION3A)
- 3B. [使用方法（CLI編）](#SECTION3B)
- 4A. [ブラウザ・コマンド](#SECTION4A)
- 4B. [CLI （コマンドライン・インターフェイス）](#SECTION4B)
- 5. [本パッケージに含まれるファイル](#SECTION5)
- 6. [設定オプション](#SECTION6)
- 7. [署名（シグニチャ）フォーマット](#SECTION7)
- 8. [適合性問題](#SECTION8)

---


###1. <a name="SECTION1"></a>序文

phpMussel（ピー・エイチ・ピー・マッスル）をご利用頂き、ありがとうございます。phpMusselは、ClamAV をはじめとした署名（シグニチャ）を利用して、システムにアップロードされるファイルを対象して、トロイ型のウィルスやマルウェア等を検出するようデザインされたPHPスクリプトです。

PHPMUSSEL著作権2013とGNU一般公衆ライセンスv2を超える権利について: Caleb M (Maikuolan)著。

本スクリプトはフリーウェアです。フリーソフトウェア財団発行のGNU一般公衆ライセンス・バージョン２（またはそれ以降のバージョン）に従い、再配布ならびに加工が可能です。配布の目的は、役に立つことを願ってのものですが、『保証はなく、また商品性や特定の目的に適合するのを示唆するものでもありません』。"LICENSE.txt" にあるGNU General Public License（一般ライセンス）を参照して下さい。 以下のURLからも閲覧できます：
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

作成のインスピレーションと本スクリプトが利用する署名（シグニチャ）について[ClamAV](http://www.clamav.net/)に感謝の意を表したいと思います。この２つがなければ、本スクリプトは存在しえないか、あるいは極めて限られた利用価値しかもたないと言ってよいでしょう。

本プロジェクトファイルのホスト先であるSourceforgeとGitHub、 phpMusselのディスカッションフォーラムのホスト先である[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)、 phpMusselが利用する署名（シグニチャ）の提供先である: [SecuriteInfo.com](http://www.securiteinfo.com/)、 [PhishTank](http://www.phishtank.com/)、 [NLNetLabs](http://nlnetlabs.nl/) 他、 本プロジェクトを支援して下さった全ての方々に感謝の意を表したいと思います。

本ドキュメントならびに関連パッケージは以下のURLからダウンロードできます。
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>インストール方法（ウェブサーバー編）

近い将来にはインストーラーを作成しインストールの簡素化を図りたいと考えていますが、現状では以下のインストラクションに従ってphpMusselをインストールして下さい。少数の例外はあるものの、大多数*のシステムおよびCMSで機能します。

1) 本項を読んでいるということから、アーカイブ・スクリプトのローカルマシンへのダウンロードと解凍は終了していると考えます。ホストあるいはCMSに`/public_html/phpmussel/`のようなディレクトリを作り、ローカルマシンからそこにコンテンツをアップロードするのが次のステップです。アップロード先のディレクトリ名や場所については、安全でさえあれば、もちろん制約などはありませんので、自由に決めて下さい。

2) オプションの修正のため（初心者には推奨できませんが、経験が豊富なユーザーには強く推奨します。）`vault`内の`phpmussel.ini`を開いて下さい。本ファイルはphpMusselが利用可能なディレクティブを含んでおり、それぞれのオプションについての機能と目的に関した簡単な説明があります。セットアップ環境にあわせて、適当な修正を行いファイルを保存して下さい。

3) コンテンツ（phpMussel本体とファイル）を先に定めたディレクトリにアップロードします。（`*.txt`や`*.md`ファイルはアップロードの必要はありませんが、大抵は全てをアップロードしてもらって構いません。）

4) `vault`ディレクトリは`777`にアクセス権変更します。コンテンツをアップロードしたディレクトリそのものは、通常特に何もする必要ありませんが、過去にパーミッションで問題があった場合、CHMODのステータスは確認しておくと良いでしょう。（デフォルトでは`755`が一般的です。）

5) 次に、システム内あるいはCMSにphpMusselをフックします。方法はいくつかありますが、最も容易なのは、`require`や`include`でスクリプトをシステム内／CMCのコアファイルの最初の部分に記載する方法です。（コアファイルとは、サイト内のどのページにアクセスがあっても必ずロードされるファイルのことです。）一般的には、`/includes`や`/assets`や`/functions`のようなディレクトリ内のファイルで、`init.php`、`common_functions.php`、`functions.php`といったファイル名が付けられています。実際にどのファイルなのかは、見つけてもうらう必要があります。よく分からない場合は、phpMusselサポートフォーラムを参照するか、あるいはお知らせください（CMS情報必須）。私自身を含め、ユーザーの中に類似のCMSを扱った経験があれば、何かしらのサポートを提供できます。コアファイルが見つかったなら、[`require`か`include`を使って]以下のコードをファイルの先頭に挿入して下さい。ただし、クォーテーションマークで囲まれた部分は`phpmussel.php`ファイルの正確なアドレス（HTTPアドレスでなく、ローカルなアドレス。前述のvaultのアドレスに類似）に置き換えます。

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

ファイルを保存して閉じ、再アップロードします。

-- 他の手法 --

Apacheウェブサーバーを利用していて、かつ`php.ini`を編集できるようであれば、`auto_prepend_file`ディレクティブを使って、PHPリクエストがあった場合にはいつもphpMusselを先頭に追加するようにすることも可能です。以下に例を挙げます。

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

あるいは、`.htaccess` において：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) これでインストールは完了ですが、念のために、テストを行いましょう。不正ファイルアップロード保護機能をテストするには、パッケージ内の`_testfiles`に含まれているテストファイルをブラウザを使った通常の方法でアップロードします。問題がなければ、phpMusselからアップロードをブロックしたとのメッセージが表示され、そうでない場合は何かが正常に機能していません。また、もし何かしら特殊な機能を使っている、ないしは他のタイプのスキャニングも使っているようであれば、相互に影響があるかないかもチェックしておく方が良いでしょう。

---


###2B. <a name="SECTION2B"></a>インストール方法（CLI編）

近い将来にはインストーラーを作成しインストールの簡素化を図りたいと考えていますが、現状では以下のインストラクションに従ってphpMusselをインストールして下さい。（現段階ではウィンドウズベースのCLIのみサポートされています。Linuxおよび他のシステムは以降のバージョンにてサポートされる予定しています。）

1) 本項を読んでいるということから、アーカイブ・スクリプトのローカルマシンへのダウンロードと解凍は終了していると考えます。phpmusselの保存場所が決まったら、次へ進んで下さい。

2) phpMusselを使うには、PHPがホストマシンにインストールされている必要があります。もし、まだであれば、各種PHPインストーラーのどれを使っても構いませんので、インストールして下さい。

3) オプションの修正のため（初心者には推奨できませんが、経験が豊富なユーザーには強く推奨します。）`vault`内の`phpmussel.ini`を開いて下さい。本ファイルはphpMusselが利用可能なディレクティブを含んでおり、それぞれのオプションについての機能と目的に関した簡単な説明があります。セットアップ環境にあわせて、適当な修正を行いファイルを保存して下さい。

4) オプションですが、バッチファイルを作成することにより、phpMusselのCLIモードでの使用を容易にすることができます。バッチファイルはPHPとphpMusselを自動的にロードするものです。まず、Notepadか Notepad++のようなテキストエディタを開いて下さい。そして、インストールしたPHPの`php.exe`の絶対パス、半角スペース、`phpmussel.php`の絶対パスをタイプして、拡張子".bat"でファイルを目につくところに保存します。このファイルをダブルクリックすることでphpMusselを起動することができます。

5) テストを行いましょう。パッケージ内の`_testfiles`をphpMusselでスキャンしてみて下さい。

---


###3A. <a name="SECTION3A"></a>使用方法（ウェーブサーバー編）

phpMusselは特別な使用環境を必要としないスクリプトです。一度インストールされれば、充分に機能します。

デフォルトでは、アップロードされたファイルのスキャンは自動的に行うように設定されています。従って基本的に何もすることはありません。

ですが、特定のファイル、ディレクトリ、アーカイブをスキャンするよう設定することも可能です。`phpmussel.ini`を適切に設定し直して下さい（クリーンアップは無効でなくてはなりません）。その後phpMusselがフックされているPHPファイル内において、以下のコードを使用します。

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` には、文字列あるいは（多次元）配列を代入することができます。どのファイル（一つないしは複数）あるいはディレクトリ（一つないしは複数）をスキャンすべきか指定します。
- `$output_type` はブーレアンで、スキャン結果のフォーマットを指定できます。Falseは結果を整数型で返します（-3は、phpMusselの署名ファイルか署名マップがない、もしくは破損している可能性があることを示しています。-2はスキャン中に破損データを検出したためスキャン失敗、-1はPHPがスキャンに必要な拡張子あるいはアドオンがないためにスキャン失敗、0はスキャンの対象が存在しないこと、１は対象のスキャンを完了しかつ問題がないこと、２は対象のスキャンを完了しかつ問題を検出したことを意味します）。True（真）は結果をテキスト形式で返します。どちらを選択しても、スキャン後にグローバル変数によって結果にアクセスすることが可能です。$output_typeはオプションでデフォルト設定はFalse（偽）になっています。
- `$output_flatness` はブーレアンで、スキャン結果を配列で返すか、文字列で返すかを指定します（対象が複数の場合）。False（偽）は配列、True（真）は文字列での返り値となります。`$output_flatness`はオプションでデフォルト設定はFalse（偽）です。

例:

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

phpMusselに含まれる署名を無効にするには、本READMEファイルの 4A. ブラウザ・コマンド内にあるグレーリスティング・ノートを参照して下さい（通常除かれるべきではないと考えられるものがブロックされてしまうような場合）。

---


###3B. <a name="SECTION3B"></a>使用方法（CLI編）

本READMEファイルのインストール方法（CLI編）を参照して下さい。

将来的にはウィンドウズベース以外のシステムもサポートする予定ですが、現バージョンのphpMussel CLIモードではウィンドウズベースのみです。（試して頂いたくことに問題はありません。ただ期待通りの機能を保証することはできない旨ご了承下さい。）

なお、phpMusselを通常のウィルスソフトと混同しないで下さい。アクティブメモリーを監視してウィルスを即時検出するものではありません。指定されたファイルのみをスキャンし、含まれるウィルスを検出します。

---


###4A. <a name="SECTION4A"></a>ブラウザ・コマンド

phpMusselがシステムに適切にインストールされ機能し、かつ設定ファイル内に`script_password`（スクリプト＿パスワード）と`logs_password`（ログ＿パスワード）が設定されていれば、いくつかの管理機能、ならびにブラウザを介したコマンドを実行することができます。ブラウザでのコントロールにパスワードが必要な理由は、セキュリティー面は当然のこと、phpMusselのユーザー（ウェブマスターや管理者を含む）が、必要とあれば、この機能を無効にできるようにするためです。言い換えれば、これらのコントロールを有効にするためにはパスワードを設定する、無効にするにはパスワードを設定しないということです。また、当初は有効であったが後日無効にする場合には、コマンドから行うこともできます（パスワード保護の面から早急に無効にする必要性が生じた時などに、設定ファイルを編集することなく、無効に変更できます）。

このコントロールを有効にすべき理由としては:
- ファイルをアップロード中に誤検出の原因となる署名を発見したものの、グレーリスト・ファイルを編集し再アップロードするような時間がない場合でも、署名を迅速にグレーリスト化できる。
- 必要とあれば、FTPのアクセス権を与えることなく、第三者にphpMusselのコントロールを許可できる。
- ログファイルへのアクセスをコントロールできる。
- FTPやその他の従来的なアクセスポイントによるphpMusselのモニタリングが不可能な場合でも、モニタリングが可能である。

このコントロールを有効にすべきでない理由としては:
- 攻撃を試みようとする者に、phpMusselが使用されているか否かを見極めるヒントを与えてしまいます（見方によっては、攻撃者を退ける効果があるとも言えますが）。攻撃者はサーバーに盲目的にコマンドを送って、攻撃ポイントを探すという手法をとるものです。コマンドによる探索の結果、このシステムはphpMusselを使用しているので攻撃は無駄だと諦めるのが普通ですが、現状で弱点と認識されていない何か、あるいは将来のバージョンで明らかになる弱点があるかもしれません。そうなると、攻撃者に攻撃の糸口を与えるということもありえます。
- もしパスワードが流出した上に変更を怠れば、署名がどうあろうが攻撃者はかいくぐってきますし、phpMusselの正常な機能を阻害、無効にしかねません。

有効にするのかしないのかは、使用者の考え方次第です。デフォルトでは無効になっていますが、有効にすることのメリットが大きいと判断されたなら、その方法と使用方法は以下の通りです。

利用可能なブラウザ側コマンド:

scan_log
- 必須パスワード: `logs_password`（ログ＿パスワード）
- その他: `scan_log`は必須。
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?logspword=[logs_password]&phpmussel=scan_log`
- 機能: `scan_log`ファイルの内容がスクリーンに表示されます。

scan_log_serialized
- 必須パスワード: `logs_password`（ログ＿パスワード）
- その他: `scan_log_serialized`は必須。
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?logspword=[logs_password]&phpmussel=scan_log_serialized`
- 機能: `scan_log_serialized`ファイルの内容がスクリーンに表示されます。

scan_kills
- 必須パスワード: `logs_password`（ログ＿パスワード）
- その他: `scan_kills`は必須。
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?logspword=[logs_password]&phpmussel=scan_kills`
- 機能: `scan_kills`ファイルの内容がスクリーンに表示されます。

controls_lockout
- 必須パスワード: `logs_password`（ログ＿パスワード）または`script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例１: `?logspword=[logs_password]&phpmussel=controls_lockout`
- 例２: `?pword=[script_password]&phpmussel=controls_lockout`
- 機能: ブラウザからのコントロールを無効（ロックアウト）にします。パスワードの不正利用の疑い（セキュリティー面に問題があるコンピュータでブラウザコントロールを使用した場合に起こりえます。）がある時に使用して下さい。`controls_lockout`（コントロールズ＿ロックアウト）が機能すると、`vault`（ヴォルト）内に`controls.lck`ファイルが作成され、phpMusselはコマンドを実行する前に必ずそのファイルをチェックするようになります。コントロールを再び有効にするためには`controls.lck`ファイルをFTP類を介して削除しなければなりません。いずれのパスワードを使っても呼び出すことができます。

disable
- 必須パスワード: `script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?pword=[script_password]&phpmussel=disable`
- 機能: phpMusselを無効にします。システムアップデートや変更、新しいソフトウェアやモデュールのインストールなどは、誤検出を引き起こす危険性がありますので、一時的に無効にします。phpMusselが期待通りに機能しないものの、アンインストールはしたくない場合にも無効を使用するとよいでしょう。再び有効にするには、`enable`（有効）を使用します。

enable
- 必須パスワード: `script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?pword=[script_password]&phpmussel=enable`
- 機能: phpMusselを有効にします。無効の状態にあるphpMusselを再び有効に戻す時に使用します。

greylist （グレーリスト）
- 必須パスワード: `script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: [グレーリスト化される署名の名前]
- オプション・パラメータ: なし
- 例: `?pword=[script_password]&phpmussel=greylist&musselvar=[署名]`
- 機能: グレーリストに署名を追加します。

greylist_clear （グレーリストクリア）
- 必須パスワード: `script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?pword=[script_password]&phpmussel=greylist_clear`
- 機能: 全グレイリストをクリアします。

greylist_show （グレイリストショー）
- 必須パスワード: `script_password`（スクリプト＿パスワード）
- その他: なし
- 必須パラメータ: なし
- オプション・パラメータ: なし
- 例: `?pword=[script_password]&phpmussel=greylist_show`
- 機能: グレーリストの内容をスクリーンに表示します。

---


###4B. <a name="SECTION4B"></a>CLI （コマンドライン・インターフェイス）

phpMusselはウィンドウズベースのシステムでは、CLIモードで対話式のファイルスキャナーとしても機能します。詳細についてはインストール方法（CLI編）を参照して下さい。

CLIプロンプトにて`c`とタイプしエンターを押せば、利用可能なCLIコマンドのリストが表示されます。

---


###5. <a name="SECTION5"></a>本パッケージに含まれるファイル

以下はアーカイブから一括ダウンロードされるファイルのリスト、ならびにスクリプト使用により作成されるファイルとこれらのファイルが何のためかという簡単な説明です。

File | Description
----|----
/.gitattributes | A GitHub project file (not required for proper function of script).
/Changelog-v1.txt | A record of changes made to the script between different versions (not required for proper function of script).
/composer.json | Composer/Packagist information (not required for proper function of script).
/CONTRIBUTING.md | Information about how to contribute to the project.
/LICENSE.txt | A copy of the GNU/GPLv2 license.
/PEOPLE.md | Information about the people involved in the project.
/phpmussel.php | The loader. This is what you're supposed to be hooking into (essential)!
/README.md | Project summary information.
/web.config | An ASP.NET configuration file (in this instance, to protect the `/vault` directory from being accessed by non-authorised sources in the event that the script is installed on a server based upon ASP.NET technologies).
/_docs/ | Documentation directory (contains various files).
/_docs/readme.ar.md | Arabic documentation.
/_docs/readme.de.md | German documentation.
/_docs/readme.en.md | English documentation.
/_docs/readme.es.md | Spanish documentation.
/_docs/readme.fr.md | French documentation.
/_docs/readme.id.md | Indonesian documentation.
/_docs/readme.it.md | Italian documentation.
/_docs/readme.nl.md | Dutch documentation.
/_docs/readme.pt.md | Portuguese documentation.
/_docs/readme.ru.md | Russian documentation.
/_docs/readme.vi.md | Vietnamese documentation.
/_docs/readme.zh-TW.md | Chinese (traditional) documentation.
/_docs/readme.zh.md | Chinese (simplified) documentation.
/_testfiles/ | Testfiles directory (contains various files). All contained files are testfiles for testing if phpMussel was correctly installed on your system, and you don't need to upload this directory or any of its files except when doing such testing.
/_testfiles/ascii_standard_testfile.txt | Testfile for testing phpMussel normalised ASCII signatures.
/_testfiles/coex_testfile.rtf | Testfile for testing phpMussel Complex Extended signatures.
/_testfiles/exe_standard_testfile.exe | Testfile for testing phpMussel PE signatures.
/_testfiles/general_standard_testfile.txt | Testfile for testing phpMussel general signatures.
/_testfiles/graphics_standard_testfile.gif | Testfile for testing phpMussel graphics signatures.
/_testfiles/html_standard_testfile.html | Testfile for testing phpMussel normalised HTML signatures.
/_testfiles/md5_testfile.txt | Testfile for testing phpMussel MD5 signatures.
/_testfiles/metadata_testfile.tar | Testfile for testing phpMussel metadata signatures and for testing TAR file support on your system.
/_testfiles/metadata_testfile.txt.gz | Testfile for testing phpMussel metadata signatures and for testing GZ file support on your system.
/_testfiles/metadata_testfile.zip | Testfile for testing phpMussel metadata signatures and for testing ZIP file support on your system.
/_testfiles/ole_testfile.ole | Testfile for testing phpMussel OLE signatures.
/_testfiles/pdf_standard_testfile.pdf | Testfile for testing phpMussel PDF signatures.
/_testfiles/pe_sectional_testfile.exe | Testfile for testing phpMussel PE Sectional signatures.
/_testfiles/swf_standard_testfile.swf | Testfile for testing phpMussel SWF signatures.
/_testfiles/xdp_standard_testfile.xdp | Testfile for testing phpMussel XML/XDP signatures.
/vault/ | Vault directory (contains various files).
/vault/.htaccess | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/cache/ | Cache directory (for temporary data).
/vault/cache/.htaccess | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/cli.php | CLI handler.
/vault/config.php | Configuration handler.
/vault/controls.php | Controls handler.
/vault/functions.php | Functions file (essential).
/vault/greylist.csv | CSV of greylisted signatures indicating to phpMussel which signatures it should be ignoring (file automatically recreated if deleted).
/vault/lang.php | Language handler.
/vault/lang/ | Contains phpMussel language data.
/vault/lang/.htaccess | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/lang/lang.ar.php | Arabic language data.
/vault/lang/lang.de.php | German language data.
/vault/lang/lang.en.php | English language data.
/vault/lang/lang.es.php | Spanish language data.
/vault/lang/lang.fr.php | French language data.
/vault/lang/lang.id.php | Indonesian language data.
/vault/lang/lang.it.php | Italian language data.
/vault/lang/lang.ja.php | Japanese language data.
/vault/lang/lang.nl.php | Dutch language data.
/vault/lang/lang.pt.php | Portuguese language data.
/vault/lang/lang.ru.php | Russian language data.
/vault/lang/lang.vi.php | Vietnamese language data.
/vault/lang/lang.zh-TW.php | Chinese (traditional) language data.
/vault/lang/lang.zh.php | Chinese (simplified) language data.
/vault/phpmussel.ini | Configuration file; Contains all the 設定オプション of phpMussel, telling it what to do and how to operate correctly (essential)!
/vault/quarantine/ | Quarantine directory (contains quarantined files).
/vault/quarantine/.htaccess | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
※ /vault/scan_kills.txt | A record of every file upload blocked/killed by phpMussel.
※ /vault/scan_log.txt | A record of everything scanned by phpMussel.
※ /vault/scan_log_serialized.txt | A record of everything scanned by phpMussel.
/vault/signatures/ | Signatures directory (contains signature files).
/vault/signatures/.htaccess | A hypertext access file (in this instance, to protect sensitive files belonging to the script from being accessed by non-authorised sources).
/vault/signatures/ascii_clamav_regex.cvd | File for normalised ASCII signatures.
/vault/signatures/ascii_clamav_regex.map | File for normalised ASCII signatures.
/vault/signatures/ascii_clamav_standard.cvd | File for normalised ASCII signatures.
/vault/signatures/ascii_clamav_standard.map | File for normalised ASCII signatures.
/vault/signatures/ascii_custom_regex.cvd | File for normalised ASCII signatures.
/vault/signatures/ascii_custom_standard.cvd | File for normalised ASCII signatures.
/vault/signatures/ascii_mussel_regex.cvd | File for normalised ASCII signatures.
/vault/signatures/ascii_mussel_standard.cvd | File for normalised ASCII signatures.
/vault/signatures/coex_clamav.cvd | File for complex extended signatures.
/vault/signatures/coex_custom.cvd | File for complex extended signatures.
/vault/signatures/coex_mussel.cvd | File for complex extended signatures.
/vault/signatures/elf_clamav_regex.cvd | File for ELF signatures.
/vault/signatures/elf_clamav_regex.map | File for ELF signatures.
/vault/signatures/elf_clamav_standard.cvd | File for ELF signatures.
/vault/signatures/elf_clamav_standard.map | File for ELF signatures.
/vault/signatures/elf_custom_regex.cvd | File for ELF signatures.
/vault/signatures/elf_custom_standard.cvd | File for ELF signatures.
/vault/signatures/elf_mussel_regex.cvd | File for ELF signatures.
/vault/signatures/elf_mussel_standard.cvd | File for ELF signatures.
/vault/signatures/exe_clamav_regex.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_regex.map | File for PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_standard.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/exe_clamav_standard.map | File for PE (Portable Executable) signatures.
/vault/signatures/exe_custom_regex.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/exe_custom_standard.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/exe_mussel_regex.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/exe_mussel_standard.cvd | File for PE (Portable Executable) signatures.
/vault/signatures/filenames_clamav.cvd | File for filename signatures.
/vault/signatures/filenames_custom.cvd | File for filename signatures.
/vault/signatures/filenames_mussel.cvd | File for filename signatures.
/vault/signatures/general_clamav_regex.cvd | File for general signatures.
/vault/signatures/general_clamav_regex.map | File for general signatures.
/vault/signatures/general_clamav_standard.cvd | File for general signatures.
/vault/signatures/general_clamav_standard.map | File for general signatures.
/vault/signatures/general_custom_regex.cvd | File for general signatures.
/vault/signatures/general_custom_standard.cvd | File for general signatures.
/vault/signatures/general_mussel_regex.cvd | File for general signatures.
/vault/signatures/general_mussel_standard.cvd | File for general signatures.
/vault/signatures/graphics_clamav_regex.cvd | File for graphics signatures.
/vault/signatures/graphics_clamav_regex.map | File for graphics signatures.
/vault/signatures/graphics_clamav_standard.cvd | File for graphics signatures.
/vault/signatures/graphics_clamav_standard.map | File for graphics signatures.
/vault/signatures/graphics_custom_regex.cvd | File for graphics signatures.
/vault/signatures/graphics_custom_standard.cvd | File for graphics signatures.
/vault/signatures/graphics_mussel_regex.cvd | File for graphics signatures.
/vault/signatures/graphics_mussel_standard.cvd | File for graphics signatures.
/vault/signatures/hex_general_commands.csv | Hex-encoded CSV of general command detections optionally used by phpMussel.
/vault/signatures/html_clamav_regex.cvd | File for normalised HTML signatures.
/vault/signatures/html_clamav_regex.map | File for normalised HTML signatures.
/vault/signatures/html_clamav_standard.cvd | File for normalised HTML signatures.
/vault/signatures/html_clamav_standard.map | File for normalised HTML signatures.
/vault/signatures/html_custom_regex.cvd | File for normalised HTML signatures.
/vault/signatures/html_custom_standard.cvd | File for normalised HTML signatures.
/vault/signatures/html_mussel_regex.cvd | File for normalised HTML signatures.
/vault/signatures/html_mussel_standard.cvd | File for normalised HTML signatures.
/vault/signatures/macho_clamav_regex.cvd | File for Mach-O signatures.
/vault/signatures/macho_clamav_regex.map | File for Mach-O signatures.
/vault/signatures/macho_clamav_standard.cvd | File for Mach-O signatures.
/vault/signatures/macho_clamav_standard.map | File for Mach-O signatures.
/vault/signatures/macho_custom_regex.cvd | File for Mach-O signatures.
/vault/signatures/macho_custom_standard.cvd | File for Mach-O signatures.
/vault/signatures/macho_mussel_regex.cvd | File for Mach-O signatures.
/vault/signatures/macho_mussel_standard.cvd | File for Mach-O signatures.
/vault/signatures/mail_clamav_regex.cvd | File for mail signatures.
/vault/signatures/mail_clamav_regex.map | File for mail signatures.
/vault/signatures/mail_clamav_standard.cvd | File for mail signatures.
/vault/signatures/mail_clamav_standard.map | File for mail signatures.
/vault/signatures/mail_custom_regex.cvd | File for mail signatures.
/vault/signatures/mail_custom_standard.cvd | File for mail signatures.
/vault/signatures/mail_mussel_regex.cvd | File for mail signatures.
/vault/signatures/mail_mussel_standard.cvd | File for mail signatures.
/vault/signatures/md5_clamav.cvd | File for MD5 based signatures.
/vault/signatures/md5_custom.cvd | File for MD5 based signatures.
/vault/signatures/md5_mussel.cvd | File for MD5 based signatures.
/vault/signatures/metadata_clamav.cvd | File for archive metadata signatures.
/vault/signatures/metadata_custom.cvd | File for archive metadata signatures.
/vault/signatures/metadata_mussel.cvd | File for archive metadata signatures.
/vault/signatures/ole_clamav_regex.cvd | File for OLE signatures.
/vault/signatures/ole_clamav_regex.map | File for OLE signatures.
/vault/signatures/ole_clamav_standard.cvd | File for OLE signatures.
/vault/signatures/ole_clamav_standard.map | File for OLE signatures.
/vault/signatures/ole_custom_regex.cvd | File for OLE signatures.
/vault/signatures/ole_custom_standard.cvd | File for OLE signatures.
/vault/signatures/ole_mussel_regex.cvd | File for OLE signatures.
/vault/signatures/ole_mussel_standard.cvd | File for OLE signatures.
/vault/signatures/pdf_clamav_regex.cvd | File for PDF signatures.
/vault/signatures/pdf_clamav_regex.map | File for PDF signatures.
/vault/signatures/pdf_clamav_standard.cvd | File for PDF signatures.
/vault/signatures/pdf_clamav_standard.map | File for PDF signatures.
/vault/signatures/pdf_custom_regex.cvd | File for PDF signatures.
/vault/signatures/pdf_custom_standard.cvd | File for PDF signatures.
/vault/signatures/pdf_mussel_regex.cvd | File for PDF signatures.
/vault/signatures/pdf_mussel_standard.cvd | File for PDF signatures.
/vault/signatures/pex_custom.cvd | File for PE extended signatures.
/vault/signatures/pex_mussel.cvd | File for PE extended signatures.
/vault/signatures/pe_clamav.cvd | File for PE Sectional signatures.
/vault/signatures/pe_custom.cvd | File for PE Sectional signatures.
/vault/signatures/pe_mussel.cvd | File for PE Sectional signatures.
/vault/signatures/swf_clamav_regex.cvd | File for the Shockwave signatures.
/vault/signatures/swf_clamav_regex.map | File for the Shockwave signatures.
/vault/signatures/swf_clamav_standard.cvd | File for the Shockwave signatures.
/vault/signatures/swf_clamav_standard.map | File for the Shockwave signatures.
/vault/signatures/swf_custom_regex.cvd | File for the Shockwave signatures.
/vault/signatures/swf_custom_standard.cvd | File for the Shockwave signatures.
/vault/signatures/swf_mussel_regex.cvd | File for the Shockwave signatures.
/vault/signatures/swf_mussel_standard.cvd | File for the Shockwave signatures.
/vault/signatures/switch.dat | Controls and sets certain variables.
/vault/signatures/urlscanner.cvd | File for URL scanner signatures.
/vault/signatures/whitelist_clamav.cvd | File specific whitelist.
/vault/signatures/whitelist_custom.cvd | File specific whitelist.
/vault/signatures/whitelist_mussel.cvd | File specific whitelist.
/vault/signatures/xmlxdp_clamav_regex.cvd | File for XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_regex.map | File for XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_standard.cvd | File for XML/XDP signatures.
/vault/signatures/xmlxdp_clamav_standard.map | File for XML/XDP signatures.
/vault/signatures/xmlxdp_custom_regex.cvd | File for XML/XDP signatures.
/vault/signatures/xmlxdp_custom_standard.cvd | File for XML/XDP signatures.
/vault/signatures/xmlxdp_mussel_regex.cvd | File for XML/XDP signatures.
/vault/signatures/xmlxdp_mussel_standard.cvd | File for XML/XDP signatures.
/vault/template.html | Template file; Template for HTML output produced by phpMussel for its blocked file upload message (the message seen by the uploader).
/vault/template_custom.html | Template file; Template for HTML output produced by phpMussel for its blocked file upload message (the message seen by the uploader).
/vault/upload.php | Upload handler.

※ Filename may differ based on configuration stipulations (in `phpmussel.ini`).

####*REGARDING SIGNATURE FILES*
CVD is an acronym for "ClamAV Virus Definitions", in reference both to how ClamAV refers to its own signatures and to the use of those signatures for phpMussel; Files ending with "CVD" contain signatures.

Files ending with "MAP", quite literally, map which signatures phpMussel should and shouldn't use for individual scans; Not all signatures are necessarily required for every single scan, so, phpMussel uses maps of the signature files to speed up the scanning process (a process that would otherwise be extremely slow and tedious).

Signature files marked with "_regex" contain signatures that utilise regular expression pattern checking (regex).

Signature files marked with "_standard" contain signatures that specifically don't utilise any form of pattern checking.

Signature files marked with neither "_regex" nor "_standard" will be as one or the other, but not both (refer to the 署名（シグニチャ）フォーマット section of this README file for documentation and specific details).

Signature files marked with "_clamav" contain signatures that are sourced entirely from the ClamAV database (GNU/GPL).

Signature files marked with "_custom", by default, don't contain any signatures at all; These such files exist to give you somewhere to place your own custom signatures, if you come up with any of your own.

Signature files marked with "_mussel" contain signatures that specifically are not sourced from ClamAV, signatures which, generally, I've either come up with myself and/or based on information gathered from various sources.

---


###6. <a name="SECTION6"></a>設定オプション
The following is a list of variables found in the `phpmussel.ini` configuration file of phpMussel, along with a description of their purpose and function.

####"general" (Category)
General phpMussel configuration.

"script_password"
- As a convenience, phpMussel will allow certain functions to be manually triggered via POST, GET and QUERY. However, as a security precaution, to do this, phpMussel will expect a password to be included with the command, as to ensure that it's you, and not someone else, attempting to manually trigger these functions. Set `script_password` to whatever password you would like to use. If no password is set, manual triggering will be disabled by default. Use something you will remember but which is hard for others to guess.
- Has no influence in CLI mode.

"logs_password"
- The same as `script_password`, but for viewing the contents of `scan_log` and `scan_kills`. Having separate passwords can be useful if you want to give someone else access to one set of functions but not the other.
- Has no influence in CLI mode.

"cleanup"
- Unset variables and cache used by the script after the initial upload scanning? False = No; True = Yes [Default]. If you -aren't- using the script beyond the initial scanning of uploads, you should set this to `true` (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to `false` (no), to avoid unnecessarily reloading duplicate data into memory. In general practice, it should usually be set to `true`, but, if you do this, you won't be able to use the script for anything other than the initial file upload scanning.
- Has no influence in CLI mode.

"scan_log"
- Filename of file to log all scanning results to. Specify a filename, or leave blank to disable.

"scan_log_serialized"
- Filename of file to log all scanning results to (using a serialised format). Specify a filename, or leave blank to disable.

"scan_kills"
- Filename of file to log all records of blocked or killed uploads to. Specify a filename, or leave blank to disable.

*Useful tip: If you want, you can append date/time information to the names of your logfiles by including these in the name: `{yyyy}` for complete year, `{yy}` for abbreviated year, `{mm}` for month, `{dd}` for day, `{hh}` for hour.*

*例: *
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"timeOffset"
- If your server time doesn't match your local time, you can specify an offset here to adjust the date/time information generated by phpMussel according to your needs. It's generally recommended instead to adjust the timezone directive in your `php.ini` file, but sometimes (such as when working with limited shared hosting providers) this isn't always possible to do, and so, this option is provided here. Offset is in minutes.
- Example (to add one hour): `timeOffset=60`

"ipaddr"
- Where to find the IP address of connecting requests? (Useful for services such as Cloudflare and the likes) Default = REMOTE_ADDR. WARNING: Don't change this unless you know what you're doing!

"enable_plugins"
- Enable support for phpMussel plugins? False = No; True = Yes [Default].

"forbid_on_block"
- Should phpMussel send 403 headers with the file upload blocked message, or stick with the usual 200 OK? False = No (200); True = Yes (403) [Default].

"delete_on_sight"
- Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted file upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won't be touched. In the case of archives, the entire archive will be deleted, regardless of whether or not the offending file is only one of several files contained within the archive. For the case of file upload scanning, usually, it isn't necessary to enable this directive, because usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it'll usually delete any files uploaded through it to the server unless they've been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn't always behave in the manner expected. False = After scanning, leave the file alone [Default]; True = After scanning, if not clean, delete immediately.

"lang"
- Specify the default language for phpMussel.

"lang_override"
- Specify if phpMussel should, when possible, override the language specification with the language preference declared by inbound requests (HTTP_ACCEPT_LANGUAGE). False = No [Default]; True = Yes.

"lang_acceptable"
- The `lang_acceptable` directive tells phpMussel which languages may be accepted by the script from `lang` or from `HTTP_ACCEPT_LANGUAGE`. This directive should **ONLY** be modified if you're adding your own customised language files or forcibly removing language files. The directive is a comma delimited string of the codes used by those languages accepted by the script.

"quarantine_key"
- phpMussel is able to quarantine flagged attempted file uploads in isolation within the phpMussel vault, if this is something you want it to do. Casual users of phpMussel that simply wish to protect their websites or hosting environment without having any interest in deeply analysing any flagged attempted file uploads should leave this functionality disabled, but any users interested in further analysis of flagged attempted file uploads for malware research or for similar such things should enable this functionality. Quarantining of flagged attempted file uploads can sometimes also assist in debugging false-positives, if this is something that frequently occurs for you. To disable quarantine functionality, simply leave the `quarantine_key` directive empty, or erase the contents of that directive if it isn't already empty. To enable quarantine functionality, enter some value into the directive. The `quarantine_key` is an important security feature of the quarantine functionality required as a means of preventing the quarantine functionality from being exploited by potential attackers and as a means of preventing any potential execution of data stored within the quarantine. The `quarantine_key` should be treated in the same manner as your passwords: The longer the better, and guard it tightly. For best effect, use in conjunction with `delete_on_sight`.

"quarantine_max_filesize"
- The maximum allowable filesize of files to be quarantined. Files larger than the value specified will NOT be quarantined. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value is in KB. Default =2048 =2048KB =2MB.

"quarantine_max_usage"
- The maximum memory usage allowed for the quarantine. If the total memory used by the quarantine reaches this value, the oldest quarantined files will be deleted until the total memory used no longer reaches this value. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value is in KB. Default =65536 =65536KB =64MB.

"honeypot_mode"
- When honeypot mode is enabled, phpMussel will attempt to quarantine every single file upload that it encounters, regardless of whether or not the file being uploaded matches any included signatures, and no actual scanning or analysis of those attempted file uploads will actually occur. This functionality should be useful for those that wish to use phpMussel for the purposes of virus/malware research, but it's neither recommended to enable this functionality if the intended use of phpMussel by the user is for actual file upload scanning, nor recommended to use the honeypot functionality for purposes other than honeypotting. By default, this option is disabled. False = Disabled [Default]; True = Enabled.

"scan_cache_expiry"
- For how long should phpMussel cache the results of scanning? Value is the number of seconds to cache the results of scanning for. Default is 21600 seconds (6 hours); A value of 0 will disable caching the results of scanning.

"disable_cli"
- Disable CLI mode? CLI mode is enabled by default, but can sometimes interfere with certain testing tools (such as PHPUnit, for example) and other CLI-based applications. If you don't need to disable CLI mode, you should ignore this directive. False = Enable CLI mode [Default]; True = Disable CLI mode.

####"signatures" (Category)
Signatures configuration.
- %%%_clamav = ClamAV signatures (both mains and daily).
- %%%_custom = Your custom signatures (if you've written any).
- %%%_mussel = phpMussel signatures included in your current signatures set that aren't from ClamAV.

Check against MD5 signatures when scanning? False = No; True = Yes [Default].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Check against general signatures when scanning? False = No; True = Yes [Default].
- "general_clamav"
- "general_custom"
- "general_mussel"

Check against normalised ASCII signatures when scanning? False = No; True = Yes [Default].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Check against normalised HTML signatures when scanning? False = No; True = Yes [Default].
- "html_clamav"
- "html_custom"
- "html_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE Sectional signatures when scanning? False = No; True = Yes [Default].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE extended signatures when scanning? False = No; True = Yes [Default].
- "pex_custom"
- "pex_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE signatures when scanning? False = No; True = Yes [Default].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Check ELF files against ELF signatures when scanning? False = No; True = Yes [Default].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Check Mach-O files (OSX, etc) against Mach-O signatures when scanning? False = No; True = Yes [Default].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Check graphics files against graphics based signatures when scanning? False = No; True = Yes [Default].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Check archive contents against archive metadata signatures when scanning? False = No; True = Yes [Default].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Check OLE objects against OLE signatures when scanning? False = No; True = Yes [Default].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Check filenames against filename based signatures when scanning? False = No; True = Yes [Default].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Check against email signatures when scanning? False = No; True = Yes [Default].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Enable file specific whitelist? False = No; True = Yes [Default].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Check XML/XDP chunks against XML/XDP signatures when scanning? False = No; True = Yes [Default].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Check against complex extended signatures when scanning? False = No; True = Yes [Default].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Check against PDF signatures when scanning? False = No; True = Yes [Default].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Check against Shockwave signatures when scanning? False = No; True = Yes [Default].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Signature matching length limiting options. Only change these if you know what you're doing. SD = Standard signatures. RX = PCRE (Perl Compatible Regular Expressions, or "Regex") signatures. FN = Filename signatures. If you notice PHP crashing when phpMussel attempts to scan, try lowering these "max" values. If possible and convenient, let me know when this happens and the results of whatever you try.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Should phpMussel report when signatures files are missing or corrupted? If `fail_silently` is disabled, missing and corrupted files will be reported on scanning, and if `fail_silently` is enabled, missing and corrupted files will be ignored, with scanning reporting for those files that there aren't any problems. This should generally be left alone unless you're experiencing crashes or similar problems. False = Disabled; True = Enabled [Default].

"fail_extensions_silently"
- Should phpMussel report when extensions are missing? If `fail_extensions_silently` is disabled, missing extensions will be reported on scanning, and if `fail_extensions_silently` is enabled, missing extensions will be ignored, with scanning reporting for those files that there aren't any problems. Disabling this directive may potentially increase your security, but may also lead to an increase of false positives. False = Disabled; True = Enabled [Default].

"detect_adware"
- Should phpMussel parse signatures for detecting adware? False = No; True = Yes [Default].

"detect_joke_hoax"
- Should phpMussel parse signatures for detecting joke/hoax malware/viruses? False = No; True = Yes [Default].

"detect_pua_pup"
- Should phpMussel parse signatures for detecting PUAs/PUPs? False = No; True = Yes [Default].

"detect_packer_packed"
- Should phpMussel parse signatures for detecting packers and packed data? False = No; True = Yes [Default].

"detect_shell"
- Should phpMussel parse signatures for detecting shell scripts? False = No; True = Yes [Default].

"detect_deface"
- Should phpMussel parse signatures for detecting defacements and defacers? False = No; True = Yes [Default].

####"files" (Category)
File handling configuration.

"max_uploads"
- Maximum allowable number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn't account for or include the contents of archives.

"filesize_limit"
- Filesize limit in KB. 65536 = 64MB [Default]; 0 = No limit (always greylisted), any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.

"filesize_response"
- What to do with files that exceed the filesize limit (if one exists). False = Whitelist; True = Blacklist [Default].

"filetype_whitelist"、 "filetype_blacklist"、 "filetype_greylist"
- If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist.
- Logical order of processing is:
  - If the filetype is whitelisted, don't scan and don't block the file, and don't check the file against the blacklist or the greylist.
  - If the filetype is blacklisted, don't scan the file but block it anyway, and don't check the file against the greylist.
  - If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the file as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the file as blacklisted, therefore not scanning it but blocking it anyway.

"check_archives"
- Attempt to check the contents of archives? False = Don't check; True = Check [Default].
- Currently, the only archive and compression formats supported are BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR and ZIP (archive and compression formats RAR, CAB, 7z and etcetera not currently supported).
- This is not foolproof! While I highly recommend keeping this turned on, I can't guarantee it'll always find everything.
- Also be aware that archive checking currently is not recursive for PHARs or ZIPs.

"filesize_archives"
- Carry over filesize blacklisting/whitelisting to the contents of archives? False = No (just greylist everything); True = Yes [Default].

"filetype_archives"
- Carry over filetype blacklisting/whitelisting to the contents of archives? False = No (just greylist everything) [Default]; True = Yes.

"max_recursion"
- Maximum recursion depth limit for archives. Default = 10.

"block_encrypted_archives"
- Detect and block encrypted archives? Because phpMussel isn't able to scan the contents of encrypted archives, it's possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. False = No; True = Yes [Default].

####"attack_specific" (Category)
Attack-specific directives.

Chameleon attack detection: False = Off; True = On.

"chameleon_from_php"
- Search for PHP header in files that are neither PHP files nor recognised archives.

"chameleon_from_exe"
- Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect.

"chameleon_to_archive"
- Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Search for office documents whose headers are incorrect (Supported: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Search for images whose headers are incorrect (Supported: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Search for PDF files whose headers are incorrect.

"archive_file_extensions" and "archive_file_extensions_wc"
- Recognised archive file extensions (format is CSV; should only add or remove when problems occur; unnecessarily removing may cause false-positives to appear for archive files, whereas unnecessarily adding will essentially whitelist what you're adding from attack specific detection; modify with caution; also note that this has no effect on what archives can and can't be analysed at content-level). The list, as is at default, lists those formats used most commonly across the majority of systems and CMS, but intentionally isn't necessarily comprehensive.

"general_commands"
- Search the content of files for statements and general commands such as `eval()` and `exec()`? False = Don't check [Default]; True = Check. Disable this directive if you intend to upload any of the following to your system or CMS via your browser: PHP, JavaScript, HTML, python, perl files and etcetera. Enable this directive if you don't have any additional protections on your system and do not intend to upload such files. If you use additional security in conjunction with phpMussel (such as ZB Block), there's no need to enable this directive, because most of what phpMussel will look for (in the context of this directive) are duplications of protections that will most likely already be provided.

"block_control_characters"
- Block any files containing any control characters (other than newlines)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) If you're _**ONLY**_ uploading plain-text, then you can turn this option on to provide some additional protection to your system. However, if you upload anything other than plain-text, turning this on may result in false positives. False = Don't block [Default]; True = Block.

"corrupted_exe"
- Corrupted files and parse errors. False = Ignore; True = Block [Default]. Detect and block potentially corrupted PE (Portable Executable) files? Often (but not always), when certain aspects of a PE file are corrupted or can't be parsed correctly, it can be indicative of a viral infection. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.

"decode_threshold"
- Optional limitation or threshold to the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. Default = 512 (512KB). Zero or null value disables the threshold (removing any such limitation based on filesize).

"scannable_threshold"
- Optional limitation or threshold to the length of raw data that phpMussel is permitted to read and scan (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. Default = 32768 (32MB). Zero or null value disables the threshold. Generally, this value shouldn't be less than the average filesize of file uploads that you want and expect to receive to your server or website, shouldn't be more than the filesize_limit directive, and shouldn't be more than roughly one fifth of the total allowable memory allocation granted to PHP via the `php.ini` configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that'd prevent it from being able to successfully scan files above a certain filesize).

####"compatibility" (Category)
Compatibility directives for phpMussel.

"ignore_upload_errors"
- This directive should generally be disabled unless it's required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the `$_FILES` array(), it'll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. However, for some CMS, empty elements in `$_FILES` can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren't any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. False = OFF; True = ON.

"only_allow_images"
- If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don't require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it'll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. False = OFF; True = ON.

####"heuristic" (Category)
Heuristic directives.

"threshold"
- There are certain signatures of phpMussel that are intended to identify suspicious and potentially malicious qualities of files being uploaded without in themselves identifying those files being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious and potentially malicious qualities of files being uploaded that's allowable is before those files are to be flagged as malicious. The definition of weight in this context is the total number of suspicious and potentially malicious qualities identified. By default, this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious files being flagged, whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious files being flagged. It's generally best to leave this value at its default unless you're experiencing problems related to it.

####"virustotal" (Category)
VirusTotal.com directives.

"vt_public_api_key"
- Optionally, phpMussel is able to scan files using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses, trojans, malware and other threats. By default, scanning files using the Virus Total API is disabled. To enable it, an API key from Virus Total is required. Due to the significant benefit that this could provide to you, it's something that I highly recommend enabling. Please be aware, however, that to use the Virus Total API, you _**MUST**_ agree to their Terms of Service and you _**MUST**_ adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS:
  - You have read and agree to the Terms of Service of Virus Total and its API. The Terms of Service of Virus Total and its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/).
  - You have read and you understand, at a minimum, the 序文 of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). The Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/).

Note: If scanning files using the Virus Total API is disabled, you won't need to review any of the directives in this category (`virustotal`), because none of them will do anything if this is disabled. To acquire a Virus Total API key, from anywhere on their website, click the "Join our Community" link located towards the top-right of the page, enter in the information requested, and click "Sign up" when done. Follow all instructions supplied, and when you've got your public API key, copy/paste that public API key to the `vt_public_api_key` directive of the `phpmussel.ini` configuration file.

"vt_suspicion_level"
- By default, phpMussel will restrict which files it scans using the Virus Total API to those files that it considers "suspicious". You can optionally adjust this restriction by changing the value of the `vt_suspicion_level` directive.
- `0`: Files are only considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight. This would effectively mean that use of the Virus Total API would be for a second opinion for when phpMussel suspects that a file may potentially be malicious, but can't entirely rule out that it may also potentially be benign (non-malicious) and therefore would otherwise normally not block it or flag it as being malicious.
- `1`: Files are considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight, if they're known to be executable (PE files, Mach-O files, ELF/Linux files, etc), or if they're known to be of a format that could potentially contain executable data (such as executable macros, DOC/DOCX files, archive files such as RARs, ZIPS and etc). This is the default and recommended suspicion level to apply, effectively meaning that use of the Virus Total API would be for a second opinion for when phpMussel doesn't initially find anything malicious or wrong with a file that it considers to be suspicious and therefore would otherwise normally not block it or flag it as being malicious.
- `2`: All files are considered suspicious and should be scanned using the Virus Total API. I don't generally recommend applying this suspicion level, due to the risk of reaching your API quota much quicker than would otherwise be the case, but there are certain circumstances (such as when the webmaster or hostmaster has very little faith or trust whatsoever in any of the uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level, all files not normally blocked or flagged as being malicious would be scanned using the Virus Total API. Note, however, that phpMussel will cease using the Virus Total API when your API quota has been reached (regardless of suspicion level), and that your quota will likely be reached much faster when using this suspicion level.

Note: Regardless of suspicion level, any files that are either blacklisted or whitelisted by phpMussel won't be scanned using the Virus Total API, because those such files would've already been declared as either malicious or benign by phpMussel by the time that they would've otherwise been scanned by the Virus Total API, and therefore, additional scanning wouldn't be required. The ability of phpMussel to scan files using the Virus Total API is intended to build further confidence for whether a file is malicious or benign in those circumstances where phpMussel itself isn't entirely certain as to whether a file is malicious or benign.

"vt_weighting"
- Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists, because, although scanning a file using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious files being caught), it can also result in a higher number of false positives, and therefore, in some circumstances, the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0 is used, the results of scanning using the Virus Total API will be applied as detections, and therefore, if any engine used by Virus Total flags the file being scanned as being malicious, phpMussel will consider the file to be malicious. If any other value is used, the results of scanning using the Virus Total API will be applied as detection weighting, and therefore, the number of engines used by Virus Total that flag the file being scanned as being malicious will serve as a confidence score (or detection weighting) for whether or not the file being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0 is used by default.

"vt_quota_rate" and "vt_quota_time"
- According to the Virus Total API documentation, "it is limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient, honeypot or any other automation that is going to provide resources to VirusTotal and not only retrieve reports you are entitled to a higher request rate quota". By default, phpMussel will strictly adhere to these limitations, but due to the possibility of these rate quotas being increased, these two directives are provided as a means for you to instruct phpMussel as to what limit it should adhere to. Unless you've been instructed to do so, it's not recommended for you to increase these values, but, if you've encountered problems relating to reaching your rate quota, decreasing these values _**MAY**_ sometimes help you in dealing with these problems. Your rate limit is determined as `vt_quota_rate` requests of any nature in any given `vt_quota_time` minute time frame.

####"urlscanner" (Category)
URL scanner configuration.

"urlscanner"
- Built into phpMussel is a URL scanner, capable of detecting malicious URLs from within any data or files scanned. To enable the URL scanner, set the `urlscanner` directive to true; To disable it, set this directive to false.

Note: If the URL scanner is disabled, you won't need to review any of the directives in this category (`urlscanner`), because none of them will do anything if this is disabled.

URL scanner API lookup configuration.

"lookup_hphosts"
- Enables API lookups to the [hpHosts](http://hosts-file.net/) API when set to true. hpHosts doesn't require an API key for performing API lookups.

"google_api_key"
- Enables API lookups to the Google Safe Browsing API when the necessary API key is defined. Google Safe Browsing API lookups requires an API key, which can be obtained from [Here](https://console.developers.google.com/).
- Note: The cURL extension is required in order to use this feature.

"maximum_api_lookups"
- Maximum allowable number of API lookups to perform per individual scan iteration. Because each additional API lookup will add to the total time required to complete each scan iteration, you may wish to stipulate a limitation in order to expedite the overall scan process. When set to 0, no such maximum allowable number will be applied. Set to 10 by default.

"maximum_api_lookups_response"
- What to do if the maximum allowable number of API lookups is exceeded? False = Do nothing (continue processing) [Default]; True = Flag/block the file.

"cache_time"
- How long (in seconds) should the results of API lookups be cached for? Default is 3600 seconds (1 hour).

####"template_data" (Category)
Directives/Variables for templates and themes.

Template data relates to the HTML output used to generate the "Upload Denied" message displayed to users upon a file upload being blocked. If you're using custom themes for phpMussel, HTML output is sourced from the `template_custom.html` file, and otherwise, HTML output is sourced from the `template.html` file. Variables written to this section of the configuration file are parsed to the HTML output by way of replacing any variable names circumfixed by curly brackets found within the HTML output with the corresponding variable data. For example, where `foo="bar"`, any instance of `<p>{foo}</p>` found within the HTML output will become `<p>bar</p>`.

"css_url"
- The template file for custom themes utilises external CSS properties, whereas the template file for the default theme utilises internal CSS properties. To instruct phpMussel to use the template file for custom themes, specify the public HTTP address of your custom theme's CSS files using the `css_url` variable. If you leave this variable blank, phpMussel will use the template file for the default theme.

---


###7. <a name="SECTION7"></a>署名（シグニチャ）フォーマット

####*FILENAME SIGNATURES*
All filename signatures follow the format:

`NAME:FNRX`

Where NAME is the name to cite for that signature and FNRX is the regex pattern to match filenames (unencoded) against.

####*MD5 SIGNATURES*
All MD5 signatures follow the format:

`HASH:FILESIZE:NAME`

Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of that file and NAME is the name to cite for that signature.

####*ARCHIVE METADATA SIGNATURES*
All archive metadata signatures follow the format:

`NAME:FILESIZE:CRC32`

Where NAME is the name to cite for that signature, FILESIZE is the total size (uncompressed) of a file contained within the archive and CRC32 is the CRC32 checksum of that contained file.

####*PE SECTIONAL SIGNATURES*
All PE Sectional signatures follow the format:

`SIZE:HASH:NAME`

Where HASH is the MD5 hash of a section of a PE file, SIZE is the total size of that section and NAME is the name to cite for that signature.

####*PE EXTENDED SIGNATURES*
All PE extended signatures follow the format:

`$VAR:HASH:SIZE:NAME`

Where $VAR is the name of the PE variable to match against, HASH is the MD5 hash of that variable, SIZE is the total size of that variable and NAME is the name to cite for that signature.

####*WHITELIST SIGNATURES*
All Whitelist signatures follow the format:

`HASH:FILESIZE:TYPE`

Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of that file and TYPE is the type of signatures the whitelisted file is to be immune against.

####*COMPLEX EXTENDED SIGNATURES*
Complex Extended signatures are rather different to the other types of signatures possible with phpMussel, in that what they are matching against is specified by the signatures themselves and they can match against multiple criteria. The match criterias are delimited by ";" and the match type and match data of each match criteria is delimited by ":" as so that format for these signatures tends to look a bit like:

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

####*EVERYTHING ELSE*
All other signatures follow the format:

`NAME:HEX:FROM:TO`

Where NAME is the name to cite for that signature and HEX is a hexadecimal-encoded segment of the file intended to be matched by the given signature. FROM and TO are optional parameters, indicating from which and to which positions in the source data to check against.

####*REGEX*
Any form of regex understood and correctly processed by PHP should also be correctly understood and processed by phpMussel and its signatures. However, I'd suggest taking extreme caution when writing new regex based signatures, because, if you're not entirely sure what you're doing, there can be highly irregular and/or unexpected results. Take a look at the phpMussel source-code if you're not entirely sure about the context in which regex statements are parsed. Also, remember that all patterns (with exception to filename, archive metadata and MD5 patterns) must be hexadecimally encoded (foregoing pattern syntax, of course)!

####*WHERE TO PUT CUSTOM SIGNATURES?*
Only put custom signatures in those files intended for custom signatures. Those files should contain "_custom" in their filenames. You should also avoid editing the default signature files, unless you know exactly what you're doing, because, aside from being good practise in general and aside from helping you distinguish between your own signatures and the default signatures included with phpMussel, it's good to stick to editing only the files intended for editing, because tampering with the default signature files can cause them to stop working correctly, due to the "maps" files: The maps files tell phpMussel where in the signature files to look for signatures required by phpMussel as per when required, and these maps can become out-of-sync with their associated signature files if those signature files are tampered with. You can put pretty much whatever you want into your custom signatures, so long as you follow the correct syntax. However, be careful to test new signatures for false-positives beforehand if you intend to share them or use them in a live environment.

####*SIGNATURE BREAKDOWN*
The following is a breakdown of the types of signatures used by phpMussel:
- "Normalised ASCII signatures" (ascii_*). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Complex Extended signatures" (coex_*). Mixed signature type matching.
- "ELF signatures" (elf_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to the ELF format.
- "Portable executable signatures" (exe_*). Checked against the contents of every non-whitelisted targeted for scanning and matched to the PE format.
- "Filename signatures" (filenames_*). Checked against the filenames of files targeted for scanning.
- "General signatures" (general_*). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Graphics signatures" (graphics_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to a known graphical file format.
- "General commands" (hex_general_commands.csv). Checked against the contents of every non-whitelisted file targeted for scanning.
- "Normalised HTML signatures" (html_*). Checked against the contents of every non-whitelisted HTML file targeted for scanning.
- "Mach-O signatures" (macho_*). Checked against the contents of every non-whitelisted file targeted for scanning and matched to the Mach-O format.
- "Email signatures" (mail_*). Checked against the contents of every non-whitelisted EML file targeted for scanning.
- "MD5 signatures" (md5_*). Checked against the MD5 hash of the contents and the filesize of every non-whitelisted file targeted for scanning.
- "Archive metadata signatures" (metadata_*). Checked against the CRC32 hash and filesize of the initial file contained inside of any non-whitelisted archive targeted for scanning.
- "OLE signatures" (ole_*). Checked against the contents of every non-whitelisted OLE object targeted for scanning.
- "PDF signatures" (pdf_*). Checked against the contents of every non-whitelisted PDF file targeted for scanning.
- "Portable executable sectional signatures" (pe_*). Checked against the MD5 hash and the size of each PE section of every non-whitelisted file targeted for scanning and matched to the PE format.
- "Portable executable extended signatures" (pex_*). Checked against the MD5 hash and the size of variables within every non-whitelisted file targeted for scanning and matched to the PE format.
- "SWF signatures" (swf_*). Checked against the contents of every non-whitelisted Shockwave file targeted for scanning.
- "Whitelist signatures" (whitelist_*). Checked against the MD5 hash of the contents and the filesize of every file targeted for scanning. Matched files will be immune to being matched by the type of signature mentioned in their whitelist entry.
- "XML/XDP signatures" (xmlxdp_*). Checked against any XML/XDP chunks found within any non-whitelisted files targeted for scanning.
(Note that any of these signatures may be easily disabled via `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>適合性問題

####PHPとPCRE
- phpMusselが正しく動作するためにはPHPとPCREが必要です。どちらか一方でも欠けると正常に機能しません。システムにPHPとPCREの両方がインストールされていることをphpMusselダウンロード前に確認して下さい。

####アンチウィルスソフトウェアとの互換性

phpMusselは大概のウィルススキャンソフトウェアに対して互換性があります。しかし、過去にはユーザーから非互換性の報告があったのも確かです。以下の情報はVirusTotal.comによるものであり、phpMusselに対しアンチウィルスプログラムによって報告された誤検出を記載しています。phpMusselと使用中のアンチウィルスソフトウェアの互換性問題が記載通りに必ず発生する、あるいは発生しないことを保証するものではありませんが、もしアンチウィルスソフトウェアとphpMusselの動作に顕著な矛盾が認められるようなら、使用にあたってどちらか一方を無効にするなどの対策を検討すべきでしょう。

以下の情報は、2016年07月04日にアップデートされ、本稿執筆時におけるphpMussel最新マイナーバージョン（v0.10.0-v1.0.0）の現況です。

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
| Qihoo-360 | リポート "Script/Trojan.Script.393" |
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


最終アップデート： 2016年08月02日。
