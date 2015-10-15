## phpMussel 中文（简体）文档。

### 内容
- 1. [前言](#SECTION1)
- 2A. [如何安装（WEB服务器）](#SECTION2A)
- 2B. [如何安装（CLI）](#SECTION2B)
- 3A. [如何使用（WEB服务器）](#SECTION3A)
- 3B. [如何使用（CLI）](#SECTION3B)
- 4A. [浏览器命令](#SECTION4A)
- 4B. [CLI（命令行界面）](#SECTION4B)
- 5. [文件在包](#SECTION5)
- 6. [配置选项](#SECTION6)
- 7. [签名格式](#SECTION7)
- 8. [已知的兼容问题](#SECTION8)

---


###1. <a name="SECTION1"></a>前言

谢谢使用phpMussel，这是一个根据ClamAV的签名和其他签名在上传完成后来自动检测木马/病毒/恶意软件和其他可能威胁到您系统安全的文件的PHP脚本。

PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan)。

本脚本是基于GNU通用许可V2.0版许可协议发布的，您可以在许可协议的允许范围内自行修改和发布，但请遵守GNU通用许可协议。使用脚本的过程中，作者不提供任何担保和任何隐含担保。更多的细节请参见GNU通用公共许可证，位于`_docs`文件夹下的`LICENSE`文件也可从访问：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

谢谢[ClamAV](http://www.clamav.net/)为本脚本提供文件签名库访问许可。没有它，这个脚本很可能不会存在，或者其价值有限。

谢谢Sourceforge和GitHub开通了，[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)phpMussel的讨论论坛，谢谢为phpMussel提供签名文件的：[SecuriteInfo.com](http://www.securiteinfo.com/)，[PhishTank](http://www.phishtank.com/)，[NLNetLabs](http://nlnetlabs.nl/)，还有更多的我忘了提及的人（抱歉，语文水平有限，这句话实在不知道怎么翻译才通顺）。

现在phpMussel的代码文件和关联包可以从以下地址免费下载下载免费：
- [Sourceforge](http://phpmussel.sourceforge.net/)。
- [GitHub](https://github.com/Maikuolan/phpMussel/)。

---


###2A. <a name="SECTION2A"></a>如何安装（对于WEB服务器）

我希望能够简化这过程通过创建的安装程序在某一点在近未来，但直到那个时候，遵循这些说明以经营phpMussel在多数系统和CMS：

1） 通过您的阅读这，我假设您已经下载一个存档的副本的脚本，已解压缩其内容和有它地方的某处上您的机器。从这里，您要决定在哪里在您的服务器您想放这些内容。一个文件夹例如`/public_html/phpmussel/`或类似（无论您选择，不要紧，只要它的安全和您是满意）会是足够了。*之前您开始上传，继续阅读。。*

2） 自选（强烈推荐为高级用户，但不推荐为业余用户或为用户没有经验），打开`phpmussel.ini`（位于内`vault`） - 这个文件包含所有指令可用的为phpMussel。以上的每指令应有一个简评以说明它做什么和它的功能。调整这些指令您认为合适的，按照随您是适合为您的特定的设置。保存文件，关闭。

3） 上传内容（phpMussel和它的文件）至文件夹您决定在早期（不需要包括`*.txt`/`*.md`文件，但大多，您应上传一切）。

4） CMHOD的`vault`文件夹为“755”。主文件夹存储的内容（一个您先前选择），平时，可以单独留，但CHMOD状态应检查如果您有权限问题以往上您的系统（按说，应被某物似“755”）。

5） 接下来，您需要｢钩子｣phpMussel为您的系统或CMS。有几种不同的方式在哪里您可以｢钩子｣脚本例如phpMussel为您的系统或CMS，但最简单的是简单地包括的脚本在开头的核心文件为您的系统或CMS（这是一个是通常始终加载的当有人访问的任何页面在您的网站）使用`require()`或`include()`命令。平时，这将是存储的在文件夹例如`/includes`，`/assets`或`/functions`，和将经常被命名的某物例如`init.php`，`common_functions.php`，`functions.php`或类似。您需要确定哪些文件这是为您的情况；如果您遇到困难关于确定这为您自己，访问phpMussel支持论坛和让我​​​​们知；这是可能的我自己或其他用户可有经验的该CMS您正在使用（您需要让我们知哪些CMS您使用的），和从而，可能能够提供援助关于这。为了使用`require()`或`include()`，插入下面的代码行到最开始的该核心文件，更换里面的数据引号以确切的地址的`phpmussel.php`文件（本地地址，不HTTP地址；它会类似于vault地址前面提到的）。

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'；?>`

保存文件，关闭，重新上传。

-- 或交替 --

如果您使用Apache网络服务器和如果您可以访问`php.ini`，您可以使用该`auto_prepend_file`指令为附上的phpMussel每当任何PHP请求是创建。就像是：

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

或在该`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6） 从这里，您完成了！然，您应测试它以确保它的正常运行。为了测试文件上传保护，尝试上传测试文件包括在包内`_testfiles`至您的网站通过您常用的基于浏览器的上传方法。如果一切正常，信息应出现从phpMussel以确认上载已成功阻止了。如果出现什么，什么是不正常工作。如果您使用的任何先进的功能或如果您使用的其它类型的扫描可能的，我建议尝试它跟他们以确保其工作正常，也。

---


###2B. <a name="SECTION2B"></a>如何安装（对于CLI）

我希望能够简化这过程通过创建的安装程序在某一点在近未来，但直到那个时候，遵循这些说明为预备phpMussel于操作使用CLI模式（请注意，在这个时候，CLI支持仅适用于基于Windows系统；Linux和其他系统即将推出到更高版本的phpMussel）：

1） 通过您的阅读这，我假设您已经下载一个存档的副本的脚本，已解压缩其内容和有它地方的某处上您的机器。当您决定您满意与选择的位置为phpMussel，继续。

2） phpMussel需要PHP被安装在主机以经营。如果您没有PHP已安装上您的机器，请安装PHP上您的机器，和跟随任何指令提供由PHP的安装程序。

3） 自选（强烈推荐为高级用户，但不推荐为业余用户或为用户没有经验），打开`phpmussel.ini`（位于内`vault`） - 这个文件包含所有指令可用的为phpMussel。以上的每指令应有一个简评以说明它做什么和它的功能。调整这些指令您认为合适的，按照随您是适合为您的特定的设置。保存文件，关闭。

4） 自选，使用的phpMussel在CLI模式可能是更容易为您如果您创建一个批处理文件为自动加载的PHP和phpMussel。要做到这一点，打开一个纯文本编辑器例如Notepad或Notepad++，键入完整路径为`php.exe`文件在文件夹的您的PHP安装，其次是一个空格，然后完整路径为`phpmussel.php`文件在文件夹的您的phpMussel安装，最后，保存此文件使用一个".bat"扩展名在一个地方您会容易发现它；从这里，双击的文件以经营phpMussel在未来。

5） 从这里，您完成了！然，您应测试它以确保它的正常运行。以测试phpMussel，经营phpMussel和尝试扫描`_testfiles`文件夹提供有包。

---


###3A. <a name="SECTION3A"></a>如何使用（对于WEB服务器）

phpMussel的目的是作为一个脚本这将将满意地和正确地执行｢从开箱｣有最小的要求为您完成：如果正确地安装的，简而言之，它应正确地功能。

文件上传扫描是自动和按说已激活，所以，您不需要做任何事为这个功能。

然而，另外，您能指示phpMussel至扫描文件，文件夹或存档该您指示以做。要做到这一点，首先，您需要确保适当配置是确定在`phpmussel.ini`文件（`cleanup`｢清理｣必须关闭），和在做完，在任何一个PHP文件是钩子至phpMussel，使用下列功能在您的代码：

`phpMussel($what_to_scan，$output_type，$output_flatness);`

- `$what_to_scan`可以是字符串，数组，或多维数组，和表明什么文件，收集的文件，文件夹和／或文件夹至扫描。
- `$output_type`是布尔，和表明什么格式到回报扫描结果作为。False｢假／负｣指示关于功能以回报扫描结果作为整数（结果回报的-3表明问题是遇到关于phpMussel签名文件或签名MAP｢地图｣文件和表明他们可能是失踪或损坏，-2表明损坏数据是检测中扫描和因此扫描失败完成，-1表明扩展或插件需要通过PHP以经营扫描是失踪和因此扫描失败完成，0表明扫描目标不存在和因此没有任何事为扫描，1表明扫描目标是成功扫描和没有任何问题检测，和2表明扫描目标是成功扫描和至少一些问题是检测）。True｢真／正｣指示关于功能以回报扫描结果作为人类可读文本。此外，在任一情况下，结果可以访问通过全局变量后扫描是完成。变量是自选，确定作为False｢假／负｣作为标准。
- `$output_flatness`是布尔，表明如果回报扫描结果（如果有多扫描目标）作为数组或字符串。False｢假／负｣指示回报结果作为数组。True｢真／正｣负｣指示回报结果作为字符串。变量是自选，确定作为False｢假／负｣作为标准。

例子：

```
 $results=phpMussel('/user_name/public_html/my_file.html'，true，true);
 echo $results;
```

回报这样的事情或类似（作为字符串）：

```
 Wed, 16 Sep 2013 02:49:46 +0000 开始.
 > 检查 '/user_name/public_html/my_file.html'：
 -> 没有任何问题发现。
 Wed, 16 Sep 2013 02:49:47 +0000 完了.
```

为一个全说明的什么类型的签名phpMussel使用中它的扫描和怎么它手柄这些签名，参考｢签名格式｣部分的这个自述文件。

如果您遇到任何假阳性，如果您遇到某物新您想应该受阻，或为任何其他题关于签名，请联系我关于它为使我可以使需要变化，该，如果您不联系我，我可能不一定知关于。

以关闭签名包括在phpMussel（例如如果您遇到假阳性具体至您的目的该不应该按说去掉），参考灰名单笔记在｢浏览器命令｣部分的这个自述文件。

除了前述的文件上传扫描和自选扫描的其他文件和／或文件夹指定通过上述功能，包括在phpMussel是一个功能意为扫描入站电子邮件正文。这个功能行为类似至标准`phpMussel()`功能，但只考虑在对照的ClamAV基于电子邮件签名。我不链接这些签名在标准phpMussel()功能，因为它是不太可能您将会发现任何入站电子邮件正文在需要的扫描在一个文件上传目标的向一个网页哪里phpMussel是钩子到，和从而，以链接这些签名在phpMussel()功能将会无意义。然而，这说，拥有一个单独功能以对照的这些签名可以证明是极有用为一些，特别为那些谁的CMS或系统是在任何方式链接在他们的电子邮件系统和为那些处理他们的电子邮件通过一个PHP脚本他们可以可能钩子在phpMussel。配置为这个功能，像所有其他，是控制通过`phpmussel.ini`文件。以使用这个功能（您需要做您的自己实施），在一个PHP文件是钩子在phpMussel，使用下列功能在您的代码：

`phpMussel_mail($body);`

`$body`是电子邮件正文您想扫描（还，您可以尝试扫描新论坛帖子，入站信息从您的在线联系方式页面或等等）。如果任何错误发生阻碍这个功能从完成它的扫描，一个数值的-1将会回报。如果这个功能完成它的扫描和它不发现任何问题，一个数值的0将会回报（表明它是良性）。如果，然而，这个功能发现某物，一个字符串将会回报包含一个信息声明什么它发现。

除了上述，如果您看源代码，您可能注意到这些功能`phpMusselD()`和`phpMusselR()`。这些功能是子功能的`phpMussel()`，和不应该叫直外的该父功能（不因为不利影响，但更使，因为它将会提供没有目的，和可能将不会正确执行无论如何）。

有许多其他控制和功能可用在phpMussel为您的，还。为了任何这样的控制和功能哪里，由端的这个部分的自述，是还不说明，请继续阅读和参考｢浏览器命令｣部分的这个自述文件。

---


###3B. <a name="SECTION3B"></a>如何使用（对于CLI）

请参考｢如何安装（对于CLI）｣部分的这个自述文件。

请注意，虽说未来版本的phpMussel应该支持其他系统，在这个时候，phpMussel CLI模式支持是只优化为使用在基于Windows系统（您可以，当然，尝试它在其他系统，但我不能保证它会执行如预期）。

还注意，phpMussel是功能不相等的一个全杀毒套房，和违背了的常规杀毒套房，它不监控活动内存或检测病毒自发地！它将会只检测病毒从那些具体文件您明确地告诉它来扫描。

---


###4A. <a name="SECTION4A"></a>浏览器命令

之后phpMussel是安装和是正确地功能在您的系统，如果您已经设置`script_password`和`logs_password`变量（访问密码）在您的配置文件，您将会可以执行一些有限数的行政功能和输入一些有限数的命令在phpMussel通过您的浏览器。这些密码需要被设置以激活这些浏览器控制，以保证正确安全，正确保护的这些浏览器控制和以保证存在一个方法为这些浏览器控制被完全关闭如果您和／或其他网站管理员使用phpMussel不想要他们。所以，换句话说，以激活这些控制，设置一个密码，和以关闭这些控制，设置没有密码。另外，如果您选择激活这些控制和然后选择关闭这些控制在稍后的日期，有一个命令以做这个（可以有用如果您执行一些行动您感觉可以可能妥协分配的密码和需要很快关闭这些控制没有修改您的配置文件）。

有些原因为什么您应该激活这些控制：
- 提供一个办法的灰名单签名自发地在情况例如当您发现一个签名产生一个假阳性中文件上传到您的系统和您没有时间为手动编辑和重新上传您的灰名单文件。
- 提供一个办法为您允许有人除了您自己控制您的副本的phpMussel没有含蓄需要发放他们访问在FTP。
- 提供一个办法的提供控制的访问办您的日志文件。
- 提供一个简易办法的更新phpMussel当更新是可用的。
- 提供一个办法为您监控phpMussel当FTP访问或其他常规访问点为监控phpMussel是不可用的。

有些原因为什么您不应该激活这些控制：
- 提供一个向量为潜力攻击者和不受欢迎的人查明如果您使用phpMussel（虽说，这个可以二者一个目的赞成和一个目的反对，根据透视)通过盲目地发送命令向服务器作为一种手段来探测。这个可以阻碍攻击者从目标您的系统如果他们学习您使用phpMussel，在假设他们是探测因为他们的攻击方法是使不有力因之的使用phpMussel。然，如果一些意外和目前未知漏洞在phpMussel或一个未来版本其被曝光，和如果它可以的可能提供一个攻击向量，一个正面结果从这探测可以可能鼓励攻击者目标您的系统。
- 如果您的分配密码成为妥协，如果不变，可以提供一个方法为一个攻击者为旁路任何签名按说防止他们的攻击成功，或潜在共关闭phpMussel，从而提供一个方法为使phpMussel的效用无实际意义。

无论哪种方式，无论您选择什么样，选择最终是您的。标准，这些控制将会已关闭，但思考关于它，和如果您决定您想他们，这个部分说明如何激活他们和如何使用他们。

可用浏览器命令列表：

scan_log
- 密码需要：`logs_password`
- 其他需要：您需要确定`scan_log`指令。
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?logspword=[logs_password]&phpmussel=scan_log`
- 它的作用：打印您的`scan_log`文件内容到屏幕。

scan_kills
- 密码需要：`logs_password`
- 其他需要：您需要确定`scan_kills`指令。
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?logspword=[logs_password]&phpmussel=scan_kills`
- 它的作用：打印您的`scan_kills`文件内容到屏幕。

controls_lockout
- 密码需要：`logs_password`或`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子1：`?logspword=[logs_password]&phpmussel=controls_lockout`
- 例子2：`?pword=[script_password]&phpmussel=controls_lockout`
- 它的作用：关闭所有浏览器控制。这个应该使用如果您疑似任一您的密码已成为妥协（这个可以发生如果您使用这些控制从一个不安全和／或不信赖计算机）。`controls_lockout`执行途经创建一个文件，`controls.lck`，在您的安全／保险库｢Vault｣文件夹，哪里phpMussel将寻找之前执行任何类型的命令。当这个发生，以重新激活控制，您需要手动删除`controls.lck`文件通过FTP或类似。可以使叫使用任一密码。

disable
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=disable`
- 它的作用：关闭phpMussel。这个应该使用如果您执行任何更新或修改在您的系统或如果您安装任何新软件或模块在您的系统哪里可能的可以扳机假阳性。这个还应该使用如果您遇到任何问题从phpMussel但您不想去掉它从您的系统。当这个发生，以重新激活phpMussel，使用“enable”。

enable
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=enable`
- 它的作用：激活phpMussel。这个应该使用如果您先前关闭phpMussel通过“disable”和想重新激活它。

update
- 密码需要：`script_password`
- 其他需要：`update.dat`和`update.inc`必须存在。
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=update`
- 它的作用：查找更新的phpMussel和它的签名。如果更新是发现，这个命令将尝试下载和安装这些更新。如果更新不发现或失败，更新将退出。整个过程结果是印刷到屏幕。我推荐检查至少一次每月以确保您的签名和您的phpMussel是最新（除非，当然，您手动更新一切，但我依然推荐更新至少一次每月）。更新更频繁是可能毫无意义，考虑到我不太可能有能力的产生任何类型更新更频繁比这（也不我实在想）。

greylist
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：【名的签名为灰名单】
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist&musselvar=[签名]`
- 它的作用：添加一个签名在灰名单。

greylist_clear
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist_clear`
- 它的作用：抹去整个灰名单。

greylist_show
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=greylist_show`
- 它的作用：打印内容的灰名单到屏幕。

---


###4B. <a name="SECTION4B"></a>CLI（命令行界面）

phpMussel可以执行作为一个互动文件扫描在CLI模式在基于Windows系统。参考｢如何安装（对于CLI）｣部分的这个自述文件为更信息。

为一个列表的可用CLI命令，在CLI提示，键入【c】，和按Enter键。

---


###5. <a name="SECTION5"></a>文件在包

下面是一个列表的所有的文件该应该是存在在您的存档在下载时间，任何文件该可能创建因之的您的使用这个脚本，包括一个简短说明的他们的目的。

文件                                       | 说明
-------------------------------------------|--------------------------------------
/phpmussel.php                             | 加载文件。它加载主脚本，更新文件，和等等。这个是文件您应该｢钩子｣（必不可少）!
/web.config                                | 一个ASP.NET配置文件（在这种情况，以保护`/vault`文件夹从被访问由非授权来源在事件的脚本是安装在服务器根据ASP.NET技术）。
/_docs/                                    | 笔记文件夹（包含若干文件）。
/_docs/change_log.txt                      | 记录的变化做出至脚本间不同版本（不需要为正确经营脚本）。
/_docs/readme.de.md                        | 自述文件：DEUTSCH
/_docs/readme.de.txt                       | 自述文件：DEUTSCH
/_docs/readme.en.md                        | 自述文件：ENGLISH
/_docs/readme.en.txt                       | 自述文件：ENGLISH
/_docs/readme.es.md                        | 自述文件：ESPAÑOL
/_docs/readme.es.txt                       | 自述文件：ESPAÑOL
/_docs/readme.fr.md                        | 自述文件：FRANÇAIS
/_docs/readme.fr.txt                       | 自述文件：FRANÇAIS
/_docs/readme.id.md                        | 自述文件：BAHASA INDONESIA
/_docs/readme.id.txt                       | 自述文件：BAHASA INDONESIA
/_docs/readme.it.md                        | 自述文件：ITALIANO
/_docs/readme.it.txt                       | 自述文件：ITALIANO
/_docs/readme.nl.md                        | 自述文件：NEDERLANDSE
/_docs/readme.nl.txt                       | 自述文件：NEDERLANDSE
/_docs/readme.pt.md                        | 自述文件：PORTUGUÊS
/_docs/readme.pt.txt                       | 自述文件：PORTUGUÊS
/_docs/readme.ru.md                        | 自述文件：РУССКИЙ
/_docs/readme.ru.txt                       | 自述文件：РУССКИЙ
/_docs/readme.vi.md                        | 自述文件：TIẾNG VIỆT
/_docs/readme.vi.txt                       | 自述文件：TIẾNG VIỆT
/_docs/readme.zh.md                        | 自述文件：中文（简体）
/_docs/readme.zh-TW.md                     | 自述文件：中文（傳統）
/_docs/signatures_tally.txt                | 文件为数量追踪的为包含的签名（不需要为正确经营脚本）。
/_testfiles/                               | 测试文件文件夹（包含若干文件）。所有包含文件是测试文件为测试如果phpMussel是正确地安装上您的系统，和您不需要上传这个文件夹或任何其文件除为上传测试。
/_testfiles/ascii_standard_testfile.txt    | 测试文件以测试phpMussel标准化ASCII签名。
/_testfiles/coex_testfile.rtf              | 测试文件以测试phpMussel复杂扩展签名。
/_testfiles/exe_standard_testfile.exe      | 测试文件以测试phpMussel移植可执行｢PE｣签名。
/_testfiles/general_standard_testfile.txt  | 测试文件以测试phpMussel通用签名。
/_testfiles/graphics_standard_testfile.gif | 测试文件以测试phpMussel图像签名。
/_testfiles/html_standard_testfile.txt     | 测试文件以测试phpMussel标准化HTML签名。
/_testfiles/md5_testfile.txt               | 测试文件以测试phpMussel MD5签名。
/_testfiles/metadata_testfile.tar          | 测试文件以测试phpMussel元数据签名和以测试TAR文件支持在您的系统。
/_testfiles/metadata_testfile.txt.gz       | 测试文件以测试phpMussel元数据签名和以测试GZ文件支持在您的系统。
/_testfiles/metadata_testfile.zip          | 测试文件以测试phpMussel元数据签名和以测试ZIP文件支持在您的系统。
/_testfiles/ole_testfile.ole               | 测试文件以测试phpMussel OLE签名。
/_testfiles/pdf_standard_testfile.pdf      | 测试文件以测试phpMussel PDF签名。
/_testfiles/pe_sectional_testfile.exe      | 测试文件以测试phpMussel移植可执行｢PE｣部分签名。
/_testfiles/swf_standard_testfile.swf      | 测试文件以测试phpMussel SWF签名。
/_testfiles/xdp_standard_testfile.xdp      | 测试文件以测试phpMussel XML／XDP块签名。
/vault/                                    | 安全／保险库｢Vault｣文件夹（包含若干文件）。
/vault/cache/                              | 缓存｢Cache｣文件夹（为临时数据）。
/vault/cache/.htaccess                     | 超文本访问文件（在这种情况，以保护敏感文件属于脚本从被访问由非授权来源）。
/vault/lang/                               | 包含phpMussel语言数据。
/vault/lang/.htaccess                      | 超文本访问文件（在这种情况，以保护敏感文件属于脚本从被访问由非授权来源）。
/vault/lang/lang.de.inc                    | 语言数据：DEUTSCH
/vault/lang/lang.en.inc                    | 语言数据：ENGLISH
/vault/lang/lang.es.inc                    | 语言数据：ESPAÑOL
/vault/lang/lang.fr.inc                    | 语言数据：FRANÇAIS
/vault/lang/lang.id.inc                    | 语言数据：BAHASA INDONESIA
/vault/lang/lang.it.inc                    | 语言数据：ITALIANO
/vault/lang/lang.ja.inc                    | 语言数据：日本語
/vault/lang/lang.nl.inc                    | 语言数据：NEDERLANDSE
/vault/lang/lang.pt.inc                    | 语言数据：PORTUGUÊS
/vault/lang/lang.ru.inc                    | 语言数据：РУССКИЙ
/vault/lang/lang.vi.inc                    | 语言数据：TIẾNG VIỆT
/vault/lang/lang.zh.inc                    | 语言数据：中文（简体）
/vault/lang/lang.zh-TW.inc                 | 语言数据：中文（傳統）
/vault/quarantine/                         | 隔离文件夹（包含隔离文件）。
/vault/quarantine/.htaccess                | 超文本访问文件（在这种情况，以保护敏感文件属于脚本从被访问由非授权来源）。
/vault/.htaccess                           | 超文本访问文件（在这种情况，以保护敏感文件属于脚本从被访问由非授权来源）。
/vault/ascii_clamav_regex.cvd              | 标准化ASCII签名文件。
/vault/ascii_clamav_regex.map              | 标准化ASCII签名文件。
/vault/ascii_clamav_standard.cvd           | 标准化ASCII签名文件。
/vault/ascii_clamav_standard.map           | 标准化ASCII签名文件。
/vault/ascii_custom_regex.cvd              | 标准化ASCII签名文件。
/vault/ascii_custom_standard.cvd           | 标准化ASCII签名文件。
/vault/ascii_mussel_regex.cvd              | 标准化ASCII签名文件。
/vault/ascii_mussel_standard.cvd           | 标准化ASCII签名文件。
/vault/coex_clamav.cvd                     | 复杂扩展签名文件。
/vault/coex_custom.cvd                     | 复杂扩展签名文件。
/vault/coex_mussel.cvd                     | 复杂扩展签名文件。
/vault/elf_clamav_regex.cvd                | ELF签名文件。
/vault/elf_clamav_regex.map                | ELF签名文件。
/vault/elf_clamav_standard.cvd             | ELF签名文件。
/vault/elf_clamav_standard.map             | ELF签名文件。
/vault/elf_custom_regex.cvd                | ELF签名文件。
/vault/elf_custom_standard.cvd             | ELF签名文件。
/vault/elf_mussel_regex.cvd                | ELF签名文件。
/vault/elf_mussel_standard.cvd             | ELF签名文件。
/vault/exe_clamav_regex.cvd                | 移植可执行｢PE｣签名文件。
/vault/exe_clamav_regex.map                | 移植可执行｢PE｣签名文件。
/vault/exe_clamav_standard.cvd             | 移植可执行｢PE｣签名文件。
/vault/exe_clamav_standard.map             | 移植可执行｢PE｣签名文件。
/vault/exe_custom_regex.cvd                | 移植可执行｢PE｣签名文件。
/vault/exe_custom_standard.cvd             | 移植可执行｢PE｣签名文件。
/vault/exe_mussel_regex.cvd                | 移植可执行｢PE｣签名文件。
/vault/exe_mussel_standard.cvd             | 移植可执行｢PE｣签名文件。
/vault/filenames_clamav.cvd                | 文件名签名文件。
/vault/filenames_custom.cvd                | 文件名签名文件。
/vault/filenames_mussel.cvd                | 文件名签名文件。
/vault/general_clamav_regex.cvd            | 通用签名文件。
/vault/general_clamav_regex.map            | 通用签名文件。
/vault/general_clamav_standard.cvd         | 通用签名文件。
/vault/general_clamav_standard.map         | 通用签名文件。
/vault/general_custom_regex.cvd            | 通用签名文件。
/vault/general_custom_standard.cvd         | 通用签名文件。
/vault/general_mussel_regex.cvd            | 通用签名文件。
/vault/general_mussel_standard.cvd         | 通用签名文件。
/vault/graphics_clamav_regex.cvd           | 图像签名文件。
/vault/graphics_clamav_regex.map           | 图像签名文件。
/vault/graphics_clamav_standard.cvd        | 图像签名文件。
/vault/graphics_clamav_standard.map        | 图像签名文件。
/vault/graphics_custom_regex.cvd           | 图像签名文件。
/vault/graphics_custom_standard.cvd        | 图像签名文件。
/vault/graphics_mussel_regex.cvd           | 图像签名文件。
/vault/graphics_mussel_standard.cvd        | 图像签名文件。
/vault/greylist.csv                        | 灰名单签名CSV（逗号分隔变量）文件说明为phpMussel什么签名它应该忽略（文件自动重新创建如果删除）。
/vault/hex_general_commands.csv            | 十六进制编码的CSV（逗号分隔变量）为通用命令检测，使用可选通过phpMussel。
/vault/html_clamav_regex.cvd               | 标准化HTML签名文件。
/vault/html_clamav_regex.map               | 标准化HTML签名文件。
/vault/html_clamav_standard.cvd            | 标准化HTML签名文件。
/vault/html_clamav_standard.map            | 标准化HTML签名文件。
/vault/html_custom_regex.cvd               | 标准化HTML签名文件。
/vault/html_custom_standard.cvd            | 标准化HTML签名文件。
/vault/html_mussel_regex.cvd               | 标准化HTML签名文件。
/vault/html_mussel_standard.cvd            | 标准化HTML签名文件。
/vault/lang.inc                            | 语言数据。
/vault/macho_clamav_regex.cvd              | Mach-O签名文件。
/vault/macho_clamav_regex.map              | Mach-O签名文件。
/vault/macho_clamav_standard.cvd           | Mach-O签名文件。
/vault/macho_clamav_standard.map           | Mach-O签名文件。
/vault/macho_custom_regex.cvd              | Mach-O签名文件。
/vault/macho_custom_standard.cvd           | Mach-O签名文件。
/vault/macho_mussel_regex.cvd              | Mach-O签名文件。
/vault/macho_mussel_standard.cvd           | Mach-O签名文件。
/vault/mail_clamav_regex.cvd               | 电子邮件签名文件。
/vault/mail_clamav_regex.map               | 电子邮件签名文件。
/vault/mail_clamav_standard.cvd            | 电子邮件签名文件。
/vault/mail_clamav_standard.map            | 电子邮件签名文件。
/vault/mail_custom_regex.cvd               | 电子邮件签名文件。
/vault/mail_custom_standard.cvd            | 电子邮件签名文件。
/vault/mail_mussel_regex.cvd               | 电子邮件签名文件。
/vault/mail_mussel_standard.cvd            | 电子邮件签名文件。
/vault/mail_mussel_standard.map            | 电子邮件签名文件。
/vault/md5_clamav.cvd                      | 基于MD5签名文件。
/vault/md5_custom.cvd                      | 基于MD5签名文件。
/vault/md5_mussel.cvd                      | 基于MD5签名文件。
/vault/metadata_clamav.cvd                 | 存档元数据签名文件。
/vault/metadata_custom.cvd                 | 存档元数据签名文件。
/vault/metadata_mussel.cvd                 | 存档元数据签名文件。
/vault/ole_clamav_regex.cvd                | OLE签名文件。
/vault/ole_clamav_regex.map                | OLE签名文件。
/vault/ole_clamav_standard.cvd             | OLE签名文件。
/vault/ole_clamav_standard.map             | OLE签名文件。
/vault/ole_custom_regex.cvd                | OLE签名文件。
/vault/ole_custom_standard.cvd             | OLE签名文件。
/vault/ole_mussel_regex.cvd                | OLE签名文件。
/vault/ole_mussel_standard.cvd             | OLE签名文件。
/vault/pdf_clamav_regex.cvd                | PDF签名文件。
/vault/pdf_clamav_regex.map                | PDF签名文件。
/vault/pdf_clamav_standard.cvd             | PDF签名文件。
/vault/pdf_clamav_standard.map             | PDF签名文件。
/vault/pdf_custom_regex.cvd                | PDF签名文件。
/vault/pdf_custom_standard.cvd             | PDF签名文件。
/vault/pdf_mussel_regex.cvd                | PDF签名文件。
/vault/pdf_mussel_standard.cvd             | PDF签名文件。
/vault/pe_clamav.cvd                       | 移植可执行｢PE｣部分签名文件。
/vault/pe_custom.cvd                       | 移植可执行｢PE｣部分签名文件。
/vault/pe_mussel.cvd                       | 移植可执行｢PE｣部分签名文件。
/vault/pex_custom.cvd                      | 移植可执行｢PE｣扩展签名文件。
/vault/pex_mussel.cvd                      | 移植可执行｢PE｣扩展签名文件。
/vault/phpmussel.inc                       | 主脚本；主体和机制的phpMussel（必不可少）！
/vault/phpmussel.ini                       | 配置文件;包含所有配置指令为phpMussel，告诉它什么做和怎么正确地经营（必不可少）!
※ /vault/scan_log.txt                     | 记录的一切phpMussel扫描。
※ /vault/scan_kills.txt                   | 记录的所有上传文件phpMussel受阻／杀。
/vault/swf_clamav_regex.cvd                | SWF签名文件。
/vault/swf_clamav_regex.map                | SWF签名文件。
/vault/swf_clamav_standard.cvd             | SWF签名文件。
/vault/swf_clamav_standard.map             | SWF签名文件。
/vault/swf_custom_regex.cvd                | SWF签名文件。
/vault/swf_custom_standard.cvd             | SWF签名文件。
/vault/swf_mussel_regex.cvd                | SWF签名文件。
/vault/swf_mussel_standard.cvd             | SWF签名文件。
/vault/switch.dat                          | 控制和确定某些变量。
/vault/template.html                       | 模板文件；模板为HTML产量产生通过phpMussel为它的受阻文件上传信息（信息可见向上传者）。
/vault/template_custom.html                | 模板文件；模板为HTML产量产生通过phpMussel为它的受阻文件上传信息（信息可见向上传者）。
/vault/update.dat                          | 文件包含版本信息为phpMussel的脚本和phpMussel的签名。如果您随时需要自动更新phpMussel或需要更新phpMussel通过您的浏览器，这个文件是必不可少。
/vault/update.inc                          | 更新脚本；需要为自动更新和为更新phpMussel通过您的浏览器，但不否则需要。
/vault/whitelist_clamav.cvd                | 文件具体白名单。
/vault/whitelist_custom.cvd                | 文件具体白名单。
/vault/whitelist_mussel.cvd                | 文件具体白名单。
/vault/xmlxdp_clamav_regex.cvd             | XML／XDP块签名文件。
/vault/xmlxdp_clamav_regex.map             | XML／XDP块签名文件。
/vault/xmlxdp_clamav_standard.cvd          | XML／XDP块签名文件。
/vault/xmlxdp_clamav_standard.map          | XML／XDP块签名文件。
/vault/xmlxdp_custom_regex.cvd             | XML／XDP块签名文件。
/vault/xmlxdp_custom_standard.cvd          | XML／XDP块签名文件。
/vault/xmlxdp_mussel_regex.cvd             | XML／XDP块签名文件。
/vault/xmlxdp_mussel_standard.cvd          | XML／XDP块签名文件。

※ 文件名可能不同基于配置规定（在`phpmussel.ini`）。

####*关于签名文件*
CVD是一个acronym为｢ClamAV Virus Definitions｣，在参照如何ClamAV参考它自己的签名和在参的用法的那些签名在phpMussel;文件名结尾有｢CVD｣包含签名。

文件名结尾有｢MAP｣绘制该签名phpMussel应该和不应该使用为独特扫描；不所有签名是一定需要为所有独特扫描，所以，phpMussel使用签名地图文件以加快扫描过程（一个过程该否则将会极其缓慢和乏味）。

签名文件标有“_regex”包含签名使用正则表达式｢REGEX｣扫描。

签名文件标有“_standard”包含签名特别是不使用任何类型的特殊式或正则表达式扫描。

签名文件标有不"_regex"也不"_standard"将会作为一个或其他，但不二者（参考｢签名格式｣部分的这个自述文件为详细信息）。

签名文件标有“_clamav”包含签名完全从ClamAV的数据库（GNU/GPL）。

签名文件标有“_custom”按说不包含任何签名；这些文件存在以给您某处为放置您自己的个性化签名，如果您创建任何您自己的。

签名文件标有“_mussel”包含签名特别是不从ClamAV，签名该大体，我亲自创建和／或基于信息云集从杂项来源。


---


###6. <a name="SECTION6"></a>配置选项
下列是一个列表的变量发现在`phpmussel.ini`配置文件的phpMussel，以及一个说明的他们的目的和功能。

####"general" （类别）
基本phpMussel配置。

“script_password”
- 为方便，phpMussel将允许某些功能（包括phpMussel的更新能力）成为手动引发通过POST，GET和QUERY。然而，作为一种安全措施，要做到这一点，phpMussel将期待一个密码是包括随着命令，以确保它是您，和不其他人，尝试手动引发这些功能。设置`script_password`到什么密码您将想用。如果没有密码是设置，手动引发将会关闭作为标准。使用某物您将记得但某物难为其他人猜测。
- 无影响在CLI模式。

“logs_password”
- 相同作为`script_password`，但为查看`scan_log`内容和`scan_kills`。分离的密码可以有用如果您想给其他人访问在一套的功能但不其他套。
- 无影响在CLI模式。

“cleanup”
- ｢反设置／删除／清洁｣脚本变量和缓存｢Cache｣之后执行吗？如果您不使用脚本外初始上传扫描，应该设置true｢真／正｣，为了最小化内存使用。如果您使用脚本为目的外初始上传扫描，应该设置false｢假／负｣，为了避免不必要重新加载复制数据在内存。在一般的做法，它应该设置true｢真／正｣，但，如果您做这样，您将不能够使用脚本为任何目的以外文件上传扫描。
- 无影响在CLI模式。

“scan_log”
- 文件为记录在所有扫描结果。指定一个文件名，或留空以关闭。

“scan_kills”
- 文件为记录在所有受阻或已杀上传。指定一个文件名，或留空以关闭。

“ipaddr”
- 在哪里可以找到连接请求IP地址？（可以使用为服务例如Cloudflare和类似）标准是`REMOTE_ADDR`。警告！不要修改此除非您知道什么您做着！

“forbid_on_block”
- phpMussel应该发送`403`头随着文件上传受阻信息，或坚持标准`200 OK`？ False = 发送`200`【标准】； True = 发送`403`。

“delete_on_sight”
- 激活的这个指令将指示脚本马上删除任何扫描文件上传匹配任何检测标准，是否通过签名或任何事其他。文件已确定是清洁将会忽略。如果是存档，全存档将会删除，不管如果违规文件是只有一个的几个文件包含在存档。为文件上传扫描，按说，它不必要为您激活这个指令，因为按说，PHP将自动清洗内容的它的缓存当执行是完，意思它将按说删除任何文件上传从它向服务器如果不已移动，复制或删除。这个指令是添加这里为额外安全为任何人谁的PHP副本可能不始终表现在预期方式。False｢假／负｣：之后扫描，忽略文件【标准】，True｢真／正｣：之后扫描，如果不清洁，马上删除。

“lang”
- 指定标准phpMussel语言。

“lang_override”
- 指定如果phpMussel应该，当可能，更换语言规范通过语言偏爱声明从入站请求（HTTP_ACCEPT_LANGUAGE）。 False：不更换【标准】； True：更换。

“lang_acceptable”
- `lang_acceptable`指令指示phpMussel什么语言可以接受在脚本从`lang`或从`HTTP_ACCEPT_LANGUAGE`。这个指令应该只会修改如果您添加您自己的个性化语言文件或强制去掉语言文件。指令是一个逗号分隔字符串的代码使用通过那些语言接受在脚本。

“quarantine_key”
- phpMussel可以检疫坏文件上传在隔离在phpMussel的安全／保险库｢Vault｣，如果这个是某物您想。普通用户的phpMussel简单地想保护他们的网站或宿主环境无任何兴趣在深深分析任何尝试文件上传应该离开这个功能关闭，但任何用户有兴趣在更深分析的尝试文件上传为目的恶意软件研究或为类似这样事情应该激活这个功能。检疫的尝试文件上传可以有时还助攻在调试假阳性，如果这个是某物经常发生为您。以关闭检疫功能，简单地离开`quarantine_key`指令空白，或抹去内容的这个指令如果它不已空白。以激活隔离功能，输入一些值在这个指令。`quarantine_key`是一个重要安全功能的隔离功能需要以预防检疫功能从成为利用通过潜在攻击者和以预防任何潜在执行的数据存储在检疫。`quarantine_key`应该被处理在同样方法作为您的密码：更长是更好，和紧紧保护它。为获得最佳效果，在结合使用`delete_on_sight`。

“quarantine_max_filesize”
- 最大允许文件大小为文件在检疫。文件大于这个指定数值将不成为检疫。这个指令是重要为使它更难为任何潜在攻击者洪水您的检疫用非通缉数据潜在的造成过度数据用法在您的虚拟主机服务。数值是在KB。 标准 =2048 =2048KB =2MB。

“quarantine_max_usage”
- 最大内存使用允许为检疫。如果总内存已用通过隔离到达这个数值，最老检疫文件将会删除直到总内存已用不再到达这个数值。这个指令是重要为使它更难为任何潜在攻击者洪水您的检疫用非通缉数据潜在的造成过度数据用法在您的虚拟主机服务。数值是在KB。 标准 =65536 =65536KB =64MB。

“honeypot_mode”
- 当这个指令（蜜罐模式）是激活，phpMussel将尝试检疫所有文件上传它遇到，无论的如果文件上传是匹配任何包括签名，和没有扫描或分析的那些文件上传将发生。这个功能应有用为那些想使用的phpMussel为目的病毒或恶意软件研究，但它是不推荐激活这个功能如果预期的用的phpMussel通过用户是为标准文件上传扫描，也不推荐使用蜜罐功能为目的以外蜜罐。作为标准，这个指令是关闭。 False = 是关闭【标准】； True = 是激活。

“scan_cache_expiry”
- 多长时间应该phpMussel维持扫描结果？数值是秒数为维持扫描结果。标准是21600秒（6小时）；一个`0`数值将停止维持扫描结果。

“disable_cli”
- 关闭CLI模式吗？CLI模式是按说激活作为标准，但可以有时干扰某些测试工具（例如PHPUnit，为例子）和其他基于CLI应用。如果您没有需要关闭CLI模式，您应该忽略这个指令。 False = 激活CLI模式【标准】； True = 关闭CLI模式。

####"signatures" （类别）
签名配置。
- %%%_clamav = ClamAV签名（二者mains和daily）。
- %%%_custom = 您的个性化签名（如果您写任何）。
- %%%_mussel = phpMussel签名已包括在您的当前签名文件不从ClamAV。

检查针对MD5签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “md5_clamav”
- “md5_custom”
- “md5_mussel”

检查针对通用签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “general_clamav”
- “general_custom”
- “general_mussel”

检查针对标准化ASCII签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “ascii_clamav”
- “ascii_custom”
- “ascii_mussel”

检查针对标准化HTML签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “html_clamav”
- “html_custom”
- “html_mussel”

检查移植可执行｢PE｣文件（EXE文件，DLL文件，等等）针对移植可执行｢PE｣部分签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “pe_clamav”
- “pe_custom”
- “pe_mussel”

检查移植可执行｢PE｣文件（EXE文件，DLL文件，等等）针对移植可执行｢PE｣扩展签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “pex_custom”
- “pex_mussel”

检查移植可执行｢PE｣文件（EXE文件，DLL文件，等等）针对移植可执行｢PE｣签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “exe_clamav”
- “exe_custom”
- “exe_mussel”

检查ELF文件针对ELF签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “elf_clamav”
- “elf_custom”
- “elf_mussel”

检查Mach-O文件（OSX文件，等等）针对Mach-O签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “macho_clamav”
- “macho_custom”
- “macho_mussel”

检查图像文件针对基于图像签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “graphics_clamav”
- “graphics_custom”
- “graphics_mussel”

检查存档内容针对存档元数据签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “metadata_clamav”
- “metadata_custom”
- “metadata_mussel”

检查OLE对象针对OLE签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “ole_clamav”
- “ole_custom”
- “ole_mussel”

检查文件名针对基于文件名签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “filenames_clamav”
- “filenames_custom”
- “filenames_mussel”

允许扫描通过`phpMussel_mail()`吗？ False = 不检查， True = 检查【默认】。
- “mail_clamav”
- “mail_custom”
- “mail_mussel”

激活具体文件白名单吗？ False = 不检查， True = 检查【默认】。
- “whitelist_clamav”
- “whitelist_custom”
- “whitelist_mussel”

检查XML／XDP块针对XML／XDP块签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “xmlxdp_clamav”
- “xmlxdp_custom”
- “xmlxdp_mussel”

检查针对复杂扩展签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “coex_clamav”
- “coex_custom”
- “coex_mussel”

检查针对PDF签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “pdf_clamav”
- “pdf_custom”
- “pdf_mussel”

检查针对SWF签名当扫描吗？ False = 不检查， True = 检查【默认】。
- “swf_clamav”
- “swf_custom”
- “swf_mussel”

签名匹配长度限制选项。只修改这些如果您知道什么您做。 SD = 标准签名。 RX = PCRE（Perl兼容的正则表达式，或"Regex"）签名。 FN = 文件名签名。 如果您通知PHP失败当phpMussel尝试扫描，尝试降低这些"max"数值。如果可能和方便，让我知道当这个发生和结果的什么您尝试。
- “fn_siglen_min”
- “fn_siglen_max”
- “rx_siglen_min”
- “rx_siglen_max”
- “sd_siglen_min”
- “sd_siglen_max”

“fail_silently”
- phpMussel应该报告当签名文件是失踪或损坏吗？如果`fail_silently`是关闭，失踪和损坏文件将会报告当扫描，和如果`fail_silently`是激活，失踪和损坏文件将会忽略，有扫描报告为那些文件哪里没有问题。这个应该按说被留下除非您遇到失败或有其他类似问题。 False = 是关闭； True = 是激活【默认】。

“fail_extensions_silently”
- phpMussel应该报告当扩展是失踪吗？如果`fail_extensions_silently`是关闭，失踪扩展将会报告当扫描，和如果`fail_extensions_silently`是激活，失踪扩展将会忽略，有扫描报告为那些文件哪里没有任何问题。关闭的这个指令可能的可以增加您的安全，但可能还导致一个增加的假阳性。 False = 是关闭； True = 是激活【默认】。

“detect_adware”
- phpMussel应该使用签名为广告软件检测吗？ False = 不检查， True = 检查【默认】。

“detect_joke_hoax”
- phpMussel应该使用签名为病毒／恶意软件笑话／恶作剧检测吗？ False = 不检查， True = 检查【默认】。

“detect_pua_pup”
- phpMussel应该使用签名为PUP/PUA（可能无用／非通缉程序／软件）检测吗？ False = 不检查， True = 检查【默认】。

“detect_packer_packed”
- phpMussel应该使用签名为打包机和打包数据检测吗？ False = 不检查， True = 检查【默认】。

“detect_shell”
- phpMussel应该使用签名为webshel​​l脚本检测吗？ False = 不检查， True = 检查【默认】。

“detect_deface”
- phpMussel应该使用签名为污损和污损软件检测吗？ False = 不检查， True = 检查【默认】。

####"files" （类别）
文件处理配置。

“max_uploads”
- 最大允许数值的文件为扫描当文件上传扫描之前中止扫描和告诉用户他们是上传太多在同一时间！提供保护针对一个理论攻击哪里一个攻击者尝试DDoS您的系统或CMS通过超载phpMussel以减速PHP进程到一个停止。推荐：10。您可能想增加或减少这个数值，根据速度的您的硬件。注意这个数值不交待为或包括存档内容。

“filesize_limit”
- 文件大小限在KB。 65536 = 64MB 【默认】，0 = 没有限（始终灰名单），任何正数值接受。这个可以有用当您的PHP配置限内存量一个进程可以占据或如果您的PHP配置限文件大小的上传。

“filesize_response”
- 如何处理文件超过文件大小限（如果存在）。 False = 白名单； True = 黑名单【默认】。

“filetype_whitelist”, “filetype_blacklist”, “filetype_greylist”
- 如果您的系统只允许具体文件类型被上传，或如果您的系统明确地否认某些文件类型，指定那些文件类型在白名单，黑名单和灰名单可以增加扫描执行速度通过允许脚本跳过某些文件类型。格式是CSV（逗号分隔变量）。如果您想扫描一切，而不是白名单，黑名单或灰名单，留变量空；这样做将关闭白名单／黑名单／灰名单。
- 进程逻辑顺序是：
  - 如果文件类型已白名单，不扫描和不受阻文件，和不匹配文件对照黑名单或灰名单。
  - 如果文件类型已黑名单，不扫描文件但阻止它无论如何，和不匹配文件对照灰名单。
  - 如果灰名单是空，或如果灰名单不空和文件类型已灰名单，扫描文件像正常和确定如果阻止它基于扫描结果，但如果灰名单不空和文件类型不灰名单，过程文件仿佛已黑名单，因此不扫描它但阻止它无论如何。

“check_archives”
- 尝试匹配存档内容吗？ False = 不匹配； True = 匹配【默认】。
- 目前，只BZ，GZ，LZF和ZIP文件匹配是支持（匹配的RAR，CAB，7z和等等不还支持）。
- 这个是不完美！虽说我很推荐保持这个激活，我不能保证它将始终发现一切。
- 还，请注意存档匹配目前是不递归为ZIP格式。

“filesize_archives”
- 继承文件大小黑名单／白名单在存档内容吗？ False = 不继承（刚灰名单一切）； True = 继承【默认】。

“filetype_archives”
- 继承文件类型黑名单／白名单在存档内容吗？ False = 不继承（刚灰名单一切）； True = 继承【默认】。

“max_recursion”
- 最大存档递归深度限。 默认 = 10。

“block_encrypted_archives”
- 检测和受阻加密的存档吗？因为phpMussel是不能够扫描加密的存档内容，它是可能存档加密可能的可以使用通过一个攻击者作为一种手段尝试绕过phpMussel，杀毒扫描仪和其他这样的保护。指示phpMussel受阻任何存档它发现被加密可能的可以帮助减少任何风险有关联这些可能性。 False = 不受阻； True = 受阻【默认】。

####"attack_specific" （类别）
专用攻击指令。

蜴攻击检测： False = 是关闭； True = 是激活。

“chameleon_from_php”
- 寻找PHP头在文件是不PHP文件也不认可存档文件。

“chameleon_from_exe”
- 寻找可执行头在文件是不可执行文件也不认可存档文件和寻找可执行文件谁的头是不正确。

“chameleon_to_archive”
- 寻找存档文件谁的头是不正确（已支持：BZ，GZ，RAR，ZIP，RAR，GZ）。

“chameleon_to_doc”
- 寻找办公文档谁的头是不正确（已支持：DOC，DOT，PPS，PPT，XLA，XLS，WIZ）。

“chameleon_to_img”
- 寻找图像谁的头是不正确（已支持：BMP，DIB，PNG，GIF，JPEG，JPG，XCF，PSD，PDD，WEBP）。

“chameleon_to_pdf”
- 寻找PDF文件谁的头是不正确。

“archive_file_extensions”和“archive_file_extensions_wc”
- 认可存档文件扩展（格式是CSV；应该只添加或去掉当问题发生；不必要的去掉可能的可以导致假阳性出现为存档文件，而不必要的增加将实质上白名单任何事您增加从专用攻击检测；修改有慎重；还请注这个无影响在什么存档可以和不能被分析在内容级）。这个名单，作为是作为标准，名单那些格式使用最常见的横过多数的系统和CMS，但有意是不全面。

“general_commands”
- 搜索文件内容为通用命令例如`eval()`，`exec()`和`include()`？ False = 不搜索【默认】； True = 搜索。 关闭这个指令如果您打算上传任何的下列在您的系统或CMS通过您的浏览器：PHP，JavaScript，HTML，python，perl文件和等等。激活这个指令如果您不有任何另外保护在您的系统和不打算上传这些文件。如果您使用另外安全在连词的phpMussel例如ZB Block，没有任何需要激活这个指令，因为最的什么phpMussel将寻找（在上下文这个指令）是重复的保护已提供。

“block_control_characters”
- 受阻任何文件包含任何控制字符吗（以外换行符）？ (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) 如果您只上传纯文本，您可以激活这个指令以提供某些另外保护在您的系统。然而，如果您上传任何事以外纯文本，激活这个可能结果在假阳性。 False = 不受阻【默认】； True = 受阻。

“corrupted_exe”
- 损坏文件和处理错误。 False = 忽略； True = 受阻【默认】。 检测和受阻潜在的损坏移植可执行｢PE｣文件吗？时常（但不始终），当某些零件的一个移植可执行｢PE｣文件是损坏或不能被正确处理，它可以建议建议的一个病毒感染。过程使用通过最杀毒程序以检测病毒在PE文件需要处理那些文件在某些​​方式，哪里，如果程序员的一个病毒是意识的，将特别尝试防止，以允许他们的病毒留不检测。

“decode_threshold”
- 可选限或门槛​​的长度的原始数据在其中解码命令应该被检测（如果有任何引人注目性能问题当扫描）。值是一个整数代表文件大小在KB。 默认 = 512 （512KB）。 零或空值将关闭门槛（去除任何这样的限基于文件大小）。

“scannable_threshold”
- 可选限或门槛​​为原始数据长度phpMussel是允许为阅读和扫描（如果有任何引人注目性能问题当扫描）。值是一个整数代表文件大小在KB。 默认 = 32768 （32MB）。 零或空值将关闭门槛。按说，这个数值应不会少于平均文件大小的文件上传您想和期待收到您的服务器或网站，应不会多于`filesize_limit`指令，和应不会多于大致五分之一的总允许内存分配获授PHP通过`php.ini`配置文件。这个指令存在为尝试防止phpMussel从用的太多内存（这个将防止它从能够顺利扫描文件以上的一个特别文件大小）。

####"compatibility" （类别）
phpMussel兼容性指令。

“ignore_upload_errors”
- 这个指令按说应会关闭除非它是需要为对功能的phpMussel在您的具体系统。按说，当是关闭，当phpMussel检测存在元素在`$_FILES`数组，它将尝试引发一个扫描的文件代表通过那些元素，和，如果他们是空或空白，phpMussel将回报一个错误信息。这个是正确行为为phpMussel。然而，为某些CMS，空元素在`$_FILES`可以发生因之的自然的行为的那些CMS，或错误可能会报告当没有任何，在这种情况，正常行为为phpMussel将会使干扰为正常行为的那些CMS。如果这样的一个情况发生为您，激活这个指令将指示phpMussel不尝试引发扫描为这样的空元素，忽略他们当发现和不回报任何关联错误信息，从而允许延续的页面请求。 False = 不忽略； True = 忽略。

“only_allow_images”
- 如果您只期待或只意味到允许图像被上传在您的系统或CMS，和如果您绝对不需要任何文件以外图像被上传在您的系统或CMS，这个指令应会激活，但其他应会关闭。如果这个指令是激活，它将指示phpMussel受阻而不例外任何上传确定为非图像文件，而不扫描他们。这个可能减少处理时间和内存使用为非图像文件上传尝试。 False = 还允许其他文件； True = 只允许图像文件。

####"heuristic" （类别）
启发式指令。

“threshold”
- 有某些签名的phpMussel意味为确定可疑和可能恶意文件零件被上传有不在他们自己确定那些文件被上传特别是作为恶意。这个“threshold”数值告诉phpMussel什么是最大总重量的可疑和潜在恶意文件零件被上传允许之前那些文件是被识别作为恶意。定义的重量在这个上下文是总数值的可疑和可能恶意文件零件确定。作为默认，这个数值将会设置作为3。一个较低的值通常将结果在一个更高的发生的假阳性但一个更高的发生的恶意文件被确定，而一个更高的数值将通常结果在一个较低的发生的假阳性但一个较低的数值的恶意文件被确定。它是通常最好忽略这个数值除非您遇到关联问题。

####"virustotal" （类别）
VirusTotal.com指令。

“vt_public_api_key”
- 可选的，phpMussel可以扫描文件使用｢Virus Total API｣作为一个方法提供一个显着的改善保护级别针对病毒，木马，恶意软件和其他威胁。作为默认，扫描文件使用｢Virus Total API｣是关闭。以激活它，一个API密钥从VirusTotal是需要。因为的显着好处这个可以提供为您，它是某物我很推荐激活。请注意，然而，以使用的｢Virus Total API｣，您必须同意他们的服务条款和您必须坚持所有方针按照说明通过VirusTotal阅读材料！您是不允许使用这个积分功能除非：
  - 您已阅读和您同意服务条款的VirusTotal和它的API。服务条款的VirusTotal和它的API可以发现[这里](https://www.virustotal.com/en/about/terms-of-service/)。
  - 您已阅读和您了解至少序言的VirusTotal公共API阅读材料(一切之后“VirusTotal Public API v2.0”但之前“Contents”）。VirusTotal公共API阅读材料可以发现[这里](https://www.virustotal.com/en/documentation/public-api/)。

请注意：如果扫描文件使用｢Virus Total API｣是关闭，您不需要修改任何指令在这个类别（`virustotal`），因为没有人将做任何事如果这个是关闭。以获得一个VirusTotalAPI密钥，从随地在他们的网站，点击“加入我们的社区”链接位于朝向右上方的页面，输入在信息请求，和点击“注册”在做完。跟随所有指令提供，和当您有您的公共API密钥，复制／粘贴您的公共API密钥到`vt_public_api_key`指令的`phpmussel.ini`配置文件。

“vt_suspicion_level”
- 作为标准，phpMussel将限制什么文件它扫描通过使用｢Virus Total API｣为那些文件它考虑作为“可疑”。您可以可选调整这个局限性通过修改的`vt_suspicion_level`指令数值。
- `0`:文件是只考虑可疑如果，当被扫描通过phpMussel使用它自己的签名，他们是认为有一个启发式重量。这个将有效意味使用的｢Virus Total API｣将会为一个第二个意见为当phpMussel怀疑一个文件可能的是恶意，但不能完全排除它可能还可能的被良性（非恶意）和因此将否则按说不受阻它或标志它作为被恶意。
- `1`:文件是考虑可疑如果，当被扫描通过phpMussel使用它自己的签名，他们是认为有一个启发式重量，如果他们是已知被可执行（PE文件，Mach-O文件，ELF/Linux文件，等等），或如果他们是已知被的一个格式潜在的包含可执行数据（例如可执行宏，DOC/DOCX文件，存档文件例如RAR格式，ZIP格式和等等）。这个是标准和推荐可疑级别到使用，有效意味使用的｢Virus Total API｣将会为一个第二个意见为当phpMussel不原来发现任何事恶意或错在一个文件它考虑被可疑和因此将否则按说不受阻它或标志它作为被恶意。
- `2`:所有文件是考虑可疑和应会扫描使用｢Virus Total API｣。我通常不推荐应用这个可疑级别，因为风险的到达您的API配额更快，但存在某些情况（例如当网站管理员或主机管理员有很少信仰或信任在任何的内容上传从他们的用户）哪里这个可疑级别可以被适当。有使用的这个可疑级别，所有文件不按说受阻或标志是作为被恶意将会扫描使用｢Virus Total API｣。请注意，然而，phpMussel将停止使用｢Virus Total API｣当您的API配额是到达（无论的可疑级别），和您的配额将会容易更快当使用这个可疑级别。

请注意：无论的可疑级别，任何文件任一已黑名单或已白名单通过phpMussel不会扫描使用｢Virus Total API｣，因为那些文件将会已标志作为恶意或良性通过phpMussel到的时候他们将会否则扫描通过｢Virus Total API｣，和因此，另外扫描不会需要。能力的phpMussel扫描文件使用｢Virus Total API｣是意味为建更置信为如果一个文件是恶意或良性在那些情况哪里phpMussel是不完全确定如果一个文件是恶意或良性。

“vt_weighting”
- phpMussel应使用扫描结果使用｢Virus Total API｣作为检测或作为检测重量吗？这个指令存在，因为，虽说扫描一个文件使用多AV引擎（例如怎么样VirusTotal做）应结果有一个增加检测率（和因此在一个更恶意文件被抓），它可以还结果有更假阳性，和因此，为某些情况，扫描结果可能被更好使用作为一个置信得分而不是作为一个明确结论。如果一个数值的`0`是使用，扫描结果使用｢Virus Total API｣将会适用作为检测，和因此，如果任何AV引擎使用通过VirusTotal标志文件被扫描作为恶意，phpMussel将考虑文件作为恶意。如果任何其他数值是使用，扫描结果使用｢Virus Total API｣将会适用作为检测重量，和因此，数的AV引擎使用通过VirusTotal标志文件被扫描作为恶意将服务作为一个置信得分（或检测重量）为如果文件被扫描应会考虑恶意通过phpMussel（数值使用将代表最低限度的置信得分或重量需要以被考虑恶意）。一个数值的`0`是使用作为标准。

“vt_quota_rate”和“vt_quota_time”
- 根据｢Virus Total API｣阅读材料，它是限于最大的`4`请求的任何类型在任​​何`1`分钟大体时间。如果您经营一个“honeyclient”，蜜罐或任何其他自动化将会提供资源为VirusTotal和不只取回报告您是有权一个更高请求率配额。作为标准，phpMussel将严格的坚持这些限制，但因为可能性的这些率配额被增加，这些二指令是提供为您指示phpMussel为什么限它应坚持。除非您是指示这样做，它是不推荐为您增加这些数值，但，如果您遇到问题相关的到达您的率配额，减少这些数值可能有时帮助您解析这些问题。您的率限是决定作为`vt_quota_rate`请求的任何类型在任​​何`vt_quota_time`分钟大体时间。

####"urlscanner" （类别）
URL scanner configuration.

"urlscanner"
- Built into phpMussel is a URL scanner, capable of detecting malicious URLs from within any data or files scanned. To enable the URL scanner, set the `urlscanner` directive to true; To disable it, set this directive to false.

Note: If the URL scanner is disabled, you won't need to review any of the directives in this category (`urlscanner`), because none of them will do anything if this is disabled.

URL scanner API lookup configuration.

"lookup_hphosts"
- Enables API lookups to the [hpHosts](http://hosts-file.net/) API when set to true. hpHosts doesn't require an API key for performing API lookups.

"google_api_key"
- Enables API lookups to the Google Safe Browsing API when the necessary API key is defined. Google Safe Browsing API lookups requires an API key, which can be obtained from [Here](https://console.developers.google.com/).

"maximum_api_lookups"
- Maximum allowable number of API lookups to perform per individual scan iteration. Because each additional API lookup will add to the total time required to complete each scan iteration, you may wish to stipulate a limitation in order to expediate the overall scan process. When set to 0, no such maximum allowable number will be applied. Set to 10 by default.

"maximum_api_lookups_response"
- What to do if the maximum allowable number of API lookups is exceeded? False = Do nothing (continue processing) [Default]; True = Flag/block the file.

"cache_time"
- How long (in seconds) should the results of API lookups be cached for? Default is 3600 seconds (1 hour).

####"template_data" （类别）
指令和变量为模板和主题。

模板数据涉及到HTML产量使用以生成“上传是否认”信息显示为用户当一个文件上传是受阻。如果您使用个性化主题为phpMussel，HTML产量资源是从`template_cu​​stom.html`文件，和否则，HTML产量资源是从`template.html`文件。变量书面在这个配置文件部分是喂在HTML产量通过更换任何变量名包围在大括号发现在HTML产量使用相应变量数据。为例子，哪里`foo="bar"`，任何发生的`<p>{foo}</p>`发现在HTML产量将成为`<p>bar</p>`。

“css_url”
- 模板文件为个性化主题使用外部CSS属性，而模板文件为t标准主题使用内部CSS属性。以指示phpMussel使用模板文件为个性化主题，指定公共HTTP地址的您的个性化主题的CSS文件使用`css_url`变量。如果您离开这个变量空白，phpMussel将使用模板文件为默认主题。

---


###7. <a name="SECTION7"></a>签名格式

####*文件名签名*
所有文件名签名跟随格式：

`NAME:FNRX`

`NAME`是名援引为签名和`FNRX`是正则表达式匹配文件名（未编码）为。

####*MD5签名*
所有MD5签名跟随格式：

`HASH:FILESIZE:NAME`

`HASH`是一个MD5哈希的一个全文件，`FILESIZE`是总文件大小和`NAME`是名援引为签名。

####*存档元数据签名*
所有存档元数据签名跟随格式：

`NAME:FILESIZE:CRC32`

`NAME`是名援引为签名，`FILESIZE`是总大小（非压缩）的一个文件包含在存档和`CRC32`是一个CRC32哈希的这个文件。

####*移植可执行｢PE｣部分签名*
所有移植可执行｢PE｣部分签名跟随格式：

`SIZE:HASH:NAME`

`HASH`是一个MD5哈希的一个部分的一个移植可执行｢PE｣文件，`SIZE`是总大小的该部分和`NAME`是名援引为签名。

####*移植可执行｢PE｣扩展签名*
所有移植可执行｢PE｣扩展签名跟随格式：

`$VAR:HASH:SIZE:NAME`

`$VAR`是移植可执行｢PE｣变量名匹配为，`HASH`是一个MD5哈希的该变量，`SIZE`是总大小的该变量和`NAME`是名援引为签名。

####*白名单签名*
所有白名单签名跟随格式：

`HASH:FILESIZE:TYPE`

`HASH`是MD5哈希的一个全文件，`FILESIZE`是总文件大小和`TYPE`是签名类型为白名单文件成为免疫的针对。

####*复杂扩展签名*
复杂扩展签名是宁不同从其他可能phpMussel签名类型，在某种意义上说，什么他们匹配针对是指定通过这些签名他们自己和他们可以匹配针对多重标准。多重标准是分隔通过【;】和匹配类型和匹配数据的每多重标准是分隔通过【:】以确保格式为这些签名往往看起来有点像：

`$变量1:某些数据;$变量2:某些数据;签名等等`

####*一切其他*
所有其他签名跟随格式：

`NAME:HEX:FROM:TO`

`NAME`是名援引为签名和`HEX`是一个十六进制编码分割的文件意味被匹配通过有关签名。`FROM`和`TO`是可选参数，说明从哪里和向哪里在源数据匹配针对（不支持通过电子邮件功能）。

####*正则表达式／REGEX*
任何形式的正则表达式了解和正确地处理通过PHP应还会正确地了解和处理通过phpMussel和它的签名。然而，我将建议采取极端谨慎当写作新正则表达式为基础的签名，因为，如果您不完全肯定什么您被做，可以有很不规则和／或意外结果。看一眼的phpMussel源代码如果您不完全肯定的上下文其中正则表达式语句被处理。还，记得，所有语句（除外为文件名，存档元数据和MD5语句）必须是十六进制编码（和除外为语句句法，还，当然）！

####*哪里放个性化签名*
放个性化签名只在那些文件意味为个性化签名。那些文件应包含`_custom`在他们的文件名。您应还避免修改的标准签名文件，除非您确切地知什么您被做，因为，除了大体被好习惯和除了帮助您区分间您自己的签名和标准签名包括在phpMussel，它是好依照只修改文件意味为修改，因为篡改标准签名文件可以导致他们停止正确地运作，因为MAP｢地图｣（`.map`）文件：这些文件告诉phpMussel哪里在签名文件到定位签名需要通过phpMussel按照当需要，和这些MAP｢地图｣文件可以成为不同步从他们的关联签名文件如果那些签名文件是篡改。您可以放几乎任何您想在您的个性化签名，只要您跟随对句法。然而，当心和测试新签名为假阳性预如果您意味共享他们或使用他们在一个活环境。

####*签名说明*
下列是说明的签名类型使用phpMussel：
- “标准化ASCII签名” （ascii_*）。匹配针对内容的所有非白名单文件目标为扫描。
- “复杂扩展签名” （coex_*）。杂签名类型匹配。
- “ELF签名” （elf_*）。匹配针对内容的所有非白名单文件目标为扫描识别的ELF文件。
- “移植可执行｢PE｣签名” （exe_*）。匹配针对内容的所有非白名单扫描目标识别的移植可执行｢PE｣文件。
- “文件名签名” （filenames_*）。匹配针对文件名的文件目标为扫描。
- “通用签名” （general_*）。匹配针对内容的所有非白名单文件目标为扫描。
- “图像签名” （graphics_*）。匹配针对内容的所有非白名单文件目标为扫描识别的一个已知图像文件格式。
- “通用命令” （hex_general_commands.csv）。匹配针对内容的所有非白名单文件目标为扫描。
- “标准化HTML签名” （html_*）。匹配针对内容的所有非白名单HTML文件目标为扫描。
- “Mach-O签名” （macho_*）。匹配针对内容的所有非白名单文件目标为扫描识别的Mach-O文件。
- “电子邮件签名” （mail_*）。匹配针对`$body`变量在`phpMussel_mail()`功能（`$body`变量是为电子邮件正文或类似实体，可能论坛帖子和等等）。
- “MD5签名” （md5_*）。匹配针对MD5哈希的内容和文件大小的所有非白名单文件目标为扫描。
- “存档元数据签名” （metadata_*）。匹配针对CRC32哈希和文件大小的第一文件包含在任何非白名单存档目标为扫描。
- “OLE签名” （ole_*）。匹配针对内容的所有非白名单OLE对象目标为扫描。
- “PDF签名” （pdf_*）。匹配针对内容的所有非白名单PDF文件目标为扫描。
- “移植可执行｢PE｣部分签名” （pe_*）。匹配针对MD5哈希和大小的每移植可执行｢PE｣部分的所有非白名单文件目标为扫描识别的移植可执行｢PE｣文件。
- “移植可执行｢PE｣扩展签名” （pex_*）。匹配针对MD5哈希和大小的变量在所有非白名单文件目标为扫描识别的移植可执行｢PE｣文件。
- “SWF签名” （swf_*）。匹配针对内容的所有非白名单SWF文件目标为扫描。
- “白名单签名” （whitelist_*）。匹配针对MD5哈希的内容和文件大小的所有文件目标为扫描。识别文件将会免疫的成为匹配通过签名类型提到从他们的白名单项。
- “XML／XDP块签名” （xmlxdp_*）。匹配针对任何XML／XDP块发现从任何非白名单文件目标为扫描。
(请注意任何的这些签名可以很容易地关闭通过`phpmussel.ini`）。

---


###8. <a name="SECTION8"></a>已知的兼容问题

####PHP和PCRE
- phpMussel需要PHP和PCRE以正确地执行和功能。如果没有PHP，或如果没有PCRE扩展的PHP，phpMussel不会正确地执行和功能。应该确保您的系统有PHP和PCRE安装和可用之前下载和安装phpMussel。

####杀毒软件兼容性

在大多数情况下，phpMussel应该相当兼容性与大多数杀毒软件。然，冲突已经报道由多个用户以往。下面这些信息是从VirusTotal.com，和它描述了一个数的假阳性报告的各种杀毒软件针对phpMussel。虽说这个信息是不绝对保证的如果您会遇到兼容性问题间phpMussel和您的杀毒软件，如果您的杀毒软件注意冲突针对phpMussel，您应该考虑关闭它之前使用phpMussel或您应该考虑替代选项从您的杀毒软件或从phpMussel。

这个信息最后更新2015年9月7日和是准确为至少phpMussel的两个最近次要版本（v0.6-v0.7a）在这个现在时候的写作。

| 扫描器               |  结果                                 |
|----------------------|--------------------------------------|
| Ad-Aware             |  无冲突 |
| Agnitum              |  无冲突 |
| AhnLab-V3            |  无冲突 |
| AntiVir              |  无冲突 |
| Antiy-AVL            |  无冲突 |
| Avast                |  报告 "JS:ScriptSH-inf [Trj]" |
| AVG                  |  无冲突 |
| Baidu-International  |  无冲突 |
| BitDefender          |  无冲突 |
| Bkav                 |  报告 "VEXDAD2.Webshell" |
| ByteHero             |  无冲突 |
| CAT-QuickHeal        |  无冲突 |
| ClamAV               |  无冲突 |
| CMC                  |  无冲突 |
| Commtouch            |  无冲突 |
| Comodo               |  无冲突 |
| DrWeb                |  无冲突 |
| Emsisoft             |  无冲突 |
| ESET-NOD32           |  无冲突 |
| F-Prot               |  无冲突 |
| F-Secure             |  无冲突 |
| Fortinet             |  无冲突 |
| GData                |  无冲突 |
| Ikarus               |  无冲突 |
| Jiangmin             |  无冲突 |
| K7AntiVirus          |  无冲突 |
| K7GW                 |  无冲突 |
| Kaspersky            |  无冲突 |
| Kingsoft             |  无冲突 |
| Malwarebytes         |  无冲突 |
| McAfee               |  报告 "New Script.c" |
| McAfee-GW-Edition    |  报告 "New Script.c" |
| Microsoft            |  无冲突 |
| MicroWorld-eScan     |  无冲突 |
| NANO-Antivirus       |  无冲突 |
| Norman               |  无冲突 |
| nProtect             |  无冲突 |
| Panda                |  无冲突 |
| Qihoo-360            |  无冲突 |
| Rising               |  无冲突 |
| Sophos               |  无冲突 |
| SUPERAntiSpyware     |  无冲突 |
| Symantec             |  无冲突 |
| TheHacker            |  无冲突 |
| TotalDefense         |  无冲突 |
| TrendMicro           |  无冲突 |
| TrendMicro-HouseCall |  无冲突 |
| VBA32                |  无冲突 |
| VIPRE                |  无冲突 |
| ViRobot              |  无冲突 |


---


最后更新：2015年10月16日。

翻译声明：本文档翻译基于英文原始文档，但由于本人水平有限，且非php程序员，对其中某些字词的翻译可能不是很准确，故如果出现错误，请指出并联系原作者予以更正，另外，本翻译仅简体中文，与繁体中文无关亦未参考繁体中文的译文！！