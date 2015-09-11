## phpMussel 自述文件写在中文（简体）。

### 内容
- 1. [前言](#SECTION1)
- 2A. [如何安装（对于WEB服务器）](#SECTION2A)
- 2B. [如何安装（对于CLI）](#SECTION2B)
- 3A. [如何使用（对于WEB服务器）](#SECTION3A)
- 3B. [如何使用（对于CLI）](#SECTION3B)
- 4A. [浏览器命令](#SECTION4A)
- 4B. [CLI（命令行界面）](#SECTION4B)
- 5. [文件在包](#SECTION5)
- 6. [配置选项](#SECTION6)
- 7. [签名格式](#SECTION7)
- 8. [已知的兼容问题](#SECTION8)

---


###1. <a name="SECTION1"></a>前言

谢谢对于使用phpMussel，一个PHP脚本旨在检测木马，病毒，恶意软件，和其他威胁在文件上传到您的系统随地这个脚本是叫，根据ClamAV的签名和其他签名。

PHPMUSSEL版权2013和此后GNU/GPLv.2通过Caleb M （Maikuolan）。

这个脚本是免费软件;您可以重新分配它和/或修改它按照条款GNU通用公共许可证发表由自由软件基金会;或第2版本的许可证，或（根据您的选择）任何新版本。这个脚本是提供在希望将是有用，但不提供任何担保和不提供任何隐含担保的适销或适用于某一特定用途。见GNU通用公共许可证的更多细节，坐落于`LICENSE`文件于`_docs`文件夹的相关包和知识库的此文件和也可从：
- <http://www.gnu.org/licenses/>。
- <http://opensource.org/licenses/>。

谢谢[ClamAV](http://www.clamav.net/)为计划灵感和为签名这个脚本利用。没有它，这个脚本很可能不会存在，或充其量，将有非常有限的价值。

谢谢Sourceforge和GitHub为主办的计划文件，[Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)为主办的phpMussel讨论论坛，和其他来源的签名利用由phpMussel：[SecuriteInfo.com](http://www.securiteinfo.com/)，[PhishTank](http://www.phishtank.com/)，[NLNetLabs](http://nlnetlabs.nl/)和他人，和特别谢谢大家为支持的计划，和任何人我忘了提，和您，为您的运用的脚本。

这个文件和其关联包可以下载免费从：
- [Sourceforge](http://phpmussel.sourceforge.net/)。
- [GitHub](https://github.com/Maikuolan/phpMussel/)。

---


###2A. <a name="SECTION2A"></a>如何安装（对于WEB服务器）

我希望能够简化这过程通过创建的安装程序在某一点在近未来，但直到那个时候，遵循这些说明以经营phpMussel在多数系统和CMS：

1） 通过您的阅读这，我假设您已经下载一个存档的副本的脚本，已解压缩其内容和有它地方的某处上您的机器。从这里，您要决定在哪里在您的服务器您想放这些内容。一个文件夹例如`/public_html/phpmussel/`或类似（无论您选择，不要紧，只要它的安全和您是满意）会是足够了。*之前您开始上传，继续阅读。。*

2） 自选（强烈推荐为高级用户，但不推荐为业余用户或为用户没有经验），打开`phpmussel.ini`（位于内`vault`） - 这个文件包含所有指令可用的为phpMussel。以上的每指令应该有一个简评以说明它做什么和它的功能。调整这些指令您认为合适的，按照随您是适合为您的特定的设置。保存文件，关闭。

3） 上传内容（phpMussel和它的文件）至文件夹您决定在早期（不需要包括`*.txt`/`*.md`文件，但大多，您应该上传的一切）。

4） CMHOD的`vault`文件夹为“755”。主文件夹存储的内容（一个您先前选择），平时，可以单独留，但CHMOD状态应检查如果您有权限问题以往上您的系统（按说，应该是这样的“755”）。

5） 接下来，您需要｢钩子｣phpMussel为您的系统或CMS。有几种不同的方式在其中您可以｢钩子｣脚本例如phpMussel为您的系统或CMS，但最简单的是简单地包括的脚本在开头的核心文件为您的系统或CMS（这是一个是通常一直加载的当有人访问的任何页面在您的网站）使用`require()`或`include()`命令。平时，这将是存储的在文件夹例如`/includes`，`/assets`或`/functions`，和将经常被命名的某物例如`init.php`，`common_functions.php`，`functions.php`或类似。您需要确定哪些文件这是为您的情况；如果您遇到困难关于确定这为您自己，访问phpMussel支持论坛和让我​​​​们知；这是可能的我自己或其他用户可有经验的该CMS您正在使用（您需要让我们知哪些CMS您使用的），和从而，可能能够提供援助关于这。为了使用`require()`或`include()`，插入下面的代码行到最开始的该核心文件，更换里面的数据引号以确切的地址的`phpmussel.php`文件（本地地址，不HTTP地址；它会类似于vault地址前面提到的）。

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'；?>`

保存文件，关闭，重新上传。

-- 或交替 --

如果您使用Apache网络服务器和如果您可以访问`php.ini`，您可以使用该`auto_prepend_file`指令为附上的phpMussel每当任何PHP请求是创建。就像是：

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

或在该`.htaccess`文件：

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6） 从这里，您完成了！然，您应该测试它以确保它的正常运行。为了测试文件上传保护，尝试上传测试文件包括在包内`_testfiles`至您的网站通过您常用的基于浏览器的上传方法。如果一切正常，信息应该出现从phpMussel以确认上载已成功阻止了。如果出现什么，什么是不正常工作。如果您使用的任何先进的功能或如果您使用的其它类型的扫描可能的，我建议尝试它跟他们以确保其工作正常，也。

---


###2B. <a name="SECTION2B"></a>如何安装（对于CLI）

我希望能够简化这过程通过创建的安装程序在某一点在近未来，但直到那个时候，遵循这些说明为预备phpMussel于操作使用CLI模式（请注意，在这个时候，CLI支持仅适用于基于Windows系统；Linux和其他系统即将推出到更高版本的phpMussel）：

1） 通过您的阅读这，我假设您已经下载一个存档的副本的脚本，已解压缩其内容和有它地方的某处上您的机器。当您决定您满意与选择的位置为phpMussel，继续。

2） phpMussel需要PHP安装在主机以经营。如果您没有PHP已安装上您的机器，请安装PHP上您的机器，和跟随任何指令提供由PHP的安装程序。

3） 自选（强烈推荐为高级用户，但不推荐为业余用户或为用户没有经验），打开`phpmussel.ini`（位于内`vault`） - 这个文件包含所有指令可用的为phpMussel。以上的每指令应该有一个简评以说明它做什么和它的功能。调整这些指令您认为合适的，按照随您是适合为您的特定的设置。保存文件，关闭。

4） 自选，使用的phpMussel在CLI模式可能是更容易为您如果您创建一个批处理文件为自动加载的PHP和phpMussel。要做到这一点，打开一个纯文本编辑器例如Notepad或Notepad++，键入完整路径为`php.exe`文件在文件夹的您的PHP安装，其次是一个空格，然后完整路径为`phpmussel.php`文件在文件夹的您的phpMussel安装，最后，保存此文件使用一个".bat"扩展名在一个地方您会容易发现它；从这里，双击的文件以经营phpMussel在未来。

5） 从这里，您完成了！然，您应该测试它以确保它的正常运行。以测试phpMussel，经营phpMussel和尝试扫描`_testfiles`文件夹提供有包。

---


###3A. <a name="SECTION3A"></a>如何使用（对于WEB服务器）

phpMussel的目的是作为一个脚本这将将满意地和正确地执行｢从开箱｣有最小的要求为您完成：如果正确地安装的，简而言之，它应该正确地功能。

文件上传扫描是自动和按说已激活，所以，您不需要做任何事为这个功能。

然而，另外，您能指示phpMussel至扫描文件，文件夹或存档该您指示以做。要做到这一点，首先，您需要确保适当配置是确定在`phpmussel.ini`文件（`cleanup`｢清理｣必须关闭），和在做完，在任何一个PHP文件是钩子至phpMussel，使用下列功能在您的代码：

`phpMussel($what_to_scan，$output_type，$output_flatness);`

- `$what_to_scan`可以是字符串，数组，或多维数组，和表明什么文件，收集的文件，文件夹和／或文件夹至扫描。
- `$output_type`是布尔，和表明什么格式以回报扫描结果作为。False｢假／负｣指示关于功能以回报扫描结果作为整数（结果回报的-3表明问题是遇到关于phpMussel签名文件或签名MAP｢地图｣文件和表明他们可能是失踪或损坏，-2表明损坏数据是检测中扫描和因此扫描失败完成，-1表明扩展或插件需要通过PHP以经营扫描是失踪和因此扫描失败完成，0表明扫描目标不存在和因此没有任何事为扫描，1表明扫描目标是成功扫描和没有任何问题检测，和2表明扫描目标是成功扫描和至少一些问题是检测）。True｢真／正｣指示关于功能以回报扫描结果作为人类可读文本。此外，在任一情况下，结果可以访问通过全局变量后扫描是完成。变量是自选，确定作为False｢假／负｣由标准。
- `$output_flatness`是布尔，表明如果回报扫描结果（如果有多扫描目标）作为数组或字符串。False｢假／负｣指示回报结果作为数组。True｢真／正｣负｣指示回报结果作为字符串。变量是自选，确定作为False｢假／负｣由标准。

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

除了前述的文件上传扫描和自选扫描的其他文件和／或文件夹指定通过上述功能，包括在phpMussel是一个功能意为扫描入站电子邮件正文。这个功能行为类似至标准`phpMussel()`功能，但只考虑在对照的ClamAV基于电子邮件签名。我不链接这些签名在标准phpMussel()功能，因为它是不太可能您将会发现任何入站电子邮件正文在需要的扫描在一个文件上传目标的向一个网页其中phpMussel是钩子到，和从而，以链接这些签名在phpMussel()功能将会无意义。然而，这说，拥有一个单独功能以对照的这些签名可以证明是极有用为一些，特别为那些谁的CMS或系统是在任何方式链接在他们的电子邮件系统和为那些处理他们的电子邮件通过一个PHP脚本他们可以可能钩子在phpMussel。配置为这个功能，像所有其他，是控制通过`phpmussel.ini`文件。以使用这个功能（您需要做您的自己实施），在一个PHP文件是钩子在phpMussel，使用下列功能在您的代码：

`phpMussel_mail($body);`

`$body`是电子邮件正文您想扫描（还，您可以尝试扫描新论坛帖子，入站信息从您的在线联系方式页面或等等）。如果任何错误发生阻碍这个功能从完成它的扫描，一个数值的-1将会回报。如果这个功能完成它的扫描和它不发现任何问题，一个数值的0将会回报（表明它是良性）。如果，然而，这个功能发现某物，一个字符串将会回报包含一个信息声明什么它发现。

除了上述，如果您看源代码，您可能注意到这些功能`phpMusselD()`和`phpMusselR()`。这些功能是子功能的`phpMussel()`，和不应该叫直外的该父功能（不因为不利影响，但更使，因为它将会提供没有目的，和可能将不会正确执行无论如何）。

有许多其他控制和功能可用在phpMussel为您的，还。为了任何这样的控制和功能其中，由端的这个部分的自述，是还不说明，请继续阅读和参考｢浏览器命令｣部分的这个自述文件。

---


###3B. <a name="SECTION3B"></a>如何使用（对于CLI）

请参考｢如何安装（对于CLI）｣部分的这个自述文件。

请注意，虽说未来版本的phpMussel应该支持其他系统，在这个时候，phpMussel CLI模式支持是只优化为使用在基于Windows系统（您可以，当然，尝试它在其他系统，但我不能保证它会执行如预期）。

还注意，phpMussel是功能不相等的一个全杀毒套房，和违背了的常规杀毒套房，它不监控活动内存或检测病毒自发地！它将会只检测病毒从那些具体文件您明确地告诉它来扫描。

---


###4A. <a name="SECTION4A"></a>浏览器命令

之后phpMussel是安装和是正确地功能在您的系统，如果您已经设置`script_password`和`logs_password`变量（访问密码）在您的配置文件，您将会可以执行一些有限数的行政功能和输入一些有限数的命令在phpMussel通过您的浏览器。这些密码需要是设置以激活这些浏览器控制，以保证正确安全，正确保护的这些浏览器控制和以保证存在一个方法为这些浏览器控制成为完全关闭如果您和／或其他网站管理员使用phpMussel不想要他们。所以，换句话说，以激活这些控制，设置一个密码，和以关闭这些控制，设置没有密码。另外，如果您选择激活这些控制和然后选择关闭这些控制在稍后的日期，有一个命令以做这个（可以有用如果您执行一些行动您感觉可以可能妥协分配的密码和需要很快关闭这些控制没有修改您的配置文件）。

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
- 它的作用：关闭所有浏览器控制。这个应该使用如果您疑似任一您的密码已成为妥协（这个可以发生如果您使用这些控制从一个不安全和／或不信赖计算机）。`controls_lockout`执行途经创建一个文件，`controls.lck`，在您的安全／保险库｢Vault｣文件夹，其中phpMussel将寻找之前执行任何类型的命令。当这个发生，以重新激活控制，您需要手动删除`controls.lck`文件通过FTP或类似。可以使叫使用任一密码。

disable
- 密码需要：`script_password`
- 其他需要：（不任何）
- 需要参数：（不任何）
- 自选參數：（不任何）
- 例子：`?pword=[script_password]&phpmussel=disable`
- 它的作用：关闭phpMussel。这个应该使用如果您执行任何更新或修改在您的系统或如果您安装任何新软件或模块在您的系统其中可能可以扳机假阳性。这个还应该使用如果您遇到任何问题从phpMussel但您不想去掉它从您的系统。当这个发生，以重新激活phpMussel，使用“enable”。

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
- phpMussel应该发送`403`头随着文件上传受阻信息，或坚持标准`200 OK`？ 0 = 发送`200`【标准】，1 = 发送`403`。

“delete_on_sight”
- 激活的这个指令将指示脚本马上删除任何扫描文件上传匹配任何检测标准，是否通过签名或任何事其他。文件已确定是清洁将会忽略。如果是存档，全存档将会删除，不管如果违规文件是只有一个的几个文件包含在存档。为文件上传扫描，按说，它不必要为您激活这个指令，因为按说，PHP将自动清洗内容的它的缓存当执行是完，意思它将按说删除任何文件上传从它向服务器如果不已移动，复制或删除。这个指令是添加这里为额外安全为任何人谁的PHP副本可能不一直表现在预期方式。False｢假／负｣：之后扫描，忽略文件【标准】，True｢真／正｣：之后扫描，如果不清洁，马上删除。

“lang”
- 指定标准phpMussel语言。

“lang_override”
- 指定如果phpMussel应该，当可能，更换语言规范通过语言偏爱声明从入站请求（HTTP_ACCEPT_LANGUAGE）。 0：不更换【标准】，1：更换。

“lang_acceptable”
- `lang_acceptable`指令指示phpMussel什么语言可以公认在脚本从`lang`或从`HTTP_ACCEPT_LANGUAGE`。这个指令应该只会修改如果您添加您自己的个性化语言文件或强制去掉语言文件。指令是一个逗号分隔字符串的代码使用通过那些语言公认在脚本。

“quarantine_key”
- phpMussel可以检疫坏文件上传在隔离在phpMussel的安全／保险库｢Vault｣，如果这个是某物您想。普通用户的phpMussel简单地想保护他们的网站或宿主环境无任何兴趣在深深分析任何尝试文件上传应该离开这个功能关闭，但任何用户有兴趣在更深分析的尝试文件上传为目的恶意软件研究或为类似这样事情应该激活这个功能。检疫的尝试文件上传可以有时还助攻在调试假阳性，如果这个是某物经常发生为您。以关闭检疫功能，简单地离开`quarantine_key`指令空白，或抹去内容的这个指令如果它不已空白。以激活隔离功能，输入一些值在这个指令。`quarantine_key`是一个重要安全功能的隔离功能需要以预防检疫功能从成为利用通过潜在攻击者和以预防任何潜在执行的数据存储在检疫。`quarantine_key`应该被处理在同样方法作为您的密码：更长是更好，和紧紧保护它。为获得最佳效果，在结合使用`delete_on_sight`。

“quarantine_max_filesize”
- The maximum allowable filesize of文件to be quarantined.文件larger than the value specified will NOT be quarantined. This directive是important as a means of making it more difficult为any 潜在攻击者 to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value是in KB. Default =2048 =2048KB =2MB。

“quarantine_max_usage”
- The maximum memory usage allowed为the quarantine. If the total memory used by the quarantine reaches this value，the oldest quarantined文件will be deleted until the total memory used no longer reaches this value. This directive是important as a means of making it more difficult为any 潜在攻击者 to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Value是in KB. Default =65536 =65536KB =64MB。

“honeypot_mode”
- When honeypot mode是enabled，phpMussel will attempt to quarantine every single文件upload that it encounters，regardless of 如果 the文件being uploaded matches any included signatures，和no actual scanning or analysis of those attempted文件uploads will actually occur. This functionality should be useful为those that wish to use phpMussel为the purposes of virus/malware research，but it's neither recommended to enable this functionality if the intended use of phpMussel by the user is为actual文件upload scanning，nor recommended to use the honeypot functionality为purposes other than honeypotting. By default，this option是disabled. 0 = Disabled 【标准】，1 = Enabled。

“scan_cache_expiry”
-为how long should phpMussel cache the results of scanning? Value是the number of seconds to cache the results of scanning for. Default是21600 seconds (6 hours)；A value of 0 will disable caching the results of scanning。

“disable_cli”
- Disable CLI mode? CLI mode是enabled by default，but can sometimes interfere with certain testing tools (such as PHPUnit，为example)和other CLI-based applications. If you don't need to disable CLI mode，you should ignore this directive. 0 = Enable CLI mode 【标准】，1 = Disable CLI mode。

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

检查存档内容针对存档元数据签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “metadata_clamav”
- “metadata_custom”
- “metadata_mussel”

检查OLE对象针对OLE签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “ole_clamav”
- “ole_custom”
- “ole_mussel”

检查文件名针对基于文件名签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “filenames_clamav”
- “filenames_custom”
- “filenames_mussel”

允许扫描通过`phpMussel_mail()`吗？ False = 不检查， True = 检查【标准】。
- “mail_clamav”
- “mail_custom”
- “mail_mussel”

激活具体文件白名单吗？ False = 不检查， True = 检查【标准】。
- “whitelist_clamav”
- “whitelist_custom”
- “whitelist_mussel”

检查XML／XDP块针对XML／XDP块签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “xmlxdp_clamav”
- “xmlxdp_custom”
- “xmlxdp_mussel”

检查针对复杂扩展签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “coex_clamav”
- “coex_custom”
- “coex_mussel”

检查针对PDF签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “pdf_clamav”
- “pdf_custom”
- “pdf_mussel”

检查针对SWF签名当扫描吗？ False = 不检查， True = 检查【标准】。
- “swf_clamav”
- “swf_custom”
- “swf_mussel”

Signature matching length limiting options. Only change these if you know what you're doing. SD = Standard signatures. RX = PCRE (Perl Compatible Regular Expressions，or "Regex") signatures. FN = Filename signatures. If you notice PHP crashing when phpMussel attempts to scan，try lowering these "max" values. If possible和convenient，let me know when this happens和the results of whatever you try。
- “fn_siglen_min”
- “fn_siglen_max”
- “rx_siglen_min”
- “rx_siglen_max”
- “sd_siglen_min”
- “sd_siglen_max”

“fail_silently”
- Should phpMussel report when签名files are missing or corrupted? If fail_silently是disabled，missing和corrupted文件will be reported on scanning，和if fail_silently是enabled，missing和corrupted文件will be ignored，with scanning reporting为those文件that there aren't any problems. This should generally be left alone unless you're experiencing crashes或类似problems. 0 = Disabled，1 = Enabled 【标准】。

“fail_extensions_silently”
- Should phpMussel report when extensions are missing? If fail_extensions_silently是disabled，missing extensions will be reported on scanning，和if fail_extensions_silently是enabled，missing extensions will be ignored，with scanning reporting为those文件that there aren't any problems. Disabling this directive may potentially increase your security，but may also lead to an increase of false positives. 0 = Disabled，1 = Enabled 【标准】。

“detect_adware”
- phpMussel应该使用签名为广告软件检测吗？ False = 不检查， True = 检查【标准】。

“detect_joke_hoax”
- phpMussel应该使用签名为病毒／恶意软件笑话／恶作剧检测吗？ False = 不检查， True = 检查【标准】。

“detect_pua_pup”
- phpMussel应该使用签名为PUP/PUA（可能无用／非通缉程序／软件）检测吗？ False = 不检查， True = 检查【标准】。

“detect_packer_packed”
- phpMussel应该使用签名为打包机和打包数据检测吗？ False = 不检查， True = 检查【标准】。

“detect_shell”
- phpMussel应该使用签名为webshel​​l脚本检测吗？ False = 不检查， True = 检查【标准】。

“detect_deface”
- phpMussel应该使用签名为污损和污损软件检测吗？ False = 不检查， True = 检查【标准】。

####"files" （类别）
文件处理配置。

“max_uploads”
- Maximum allowable number of文件to scan during文件upload scan before aborting the scan和informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an 攻击者 attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn't account为or include the contents of archives。

“filesize_limit”
- Filesize limit in KB. 65536 = 64MB 【标准】，0 = No limit (always greylisted)，any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads。

“filesize_response”
- What to do with文件that exceed the filesize limit (if one exists). 0 - Whitelist，1 - Blacklist 【标准】。

“filetype_whitelist"，"filetype_blacklist"，"filetype_greylist”
- If your system only allows specific types of文件to be uploaded，or if your system explicitly denies certain types of files，specifying those filetypes in whitelists，blacklists和greylists can increase the speed at which scanning是performed by allowing the脚本to skip over certain filetypes. Format是CSV (comma separated values). If you want to scan everything，rather than whitelist，blacklist or greylist，leave the variable(/s) blank；Doing so will disable whitelist/blacklist/greylist。
- Logical order of processing is：
  - If the filetype是whitelisted，don't scan和don't block the file，和don't check the文件against the blacklist or the greylist。
  - If the filetype是blacklisted，don't scan the文件but block it anyway，和don't check the文件against the greylist。
  - If the greylist是empty or if the greylist是not empty和the filetype是greylisted，scan the文件as per normal和determine whether to block it based on the results of the scan，but if the greylist是not empty和the filetype是not greylisted，treat the文件as blacklisted，therefore not scanning it but blocking it anyway。

“check_archives”
- Attempt to check the contents of archives? 0 - No (do not check)，1 - Yes (check) 【标准】。
- Currently，only checking of BZ，GZ，LZF和ZIP文件is supported (checking of RAR，CAB，7z和etcetera not currently supported）。
- This是not foolproof! While I 很 recommend keeping this turned on，I can't guarantee it'll always find everything。
- Also be aware that archive checking currently是not recursive为ZIPs。

“filesize_archives”
- Carry over filesize blacklisting/whitelisting to the contents of archives? 0 - No (just greylist everything)，1 - Yes 【标准】。

“filetype_archives”
- Carry over filetype blacklisting/whitelisting to the contents of archives? 0 - No (just greylist everything) 【标准】，1 - Yes。

“max_recursion”
- Maximum recursion depth limit为archives. Default = 10。

“block_encrypted_archives”
- Detect和block encrypted archives? Because phpMussel isn't able to scan the contents of encrypted archives，it's possible that archive encryption may be employed by an 攻击者 as a means of attempting to bypass phpMussel，杀毒 scanners和other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. 0 - No，1 - Yes 【标准】。

####"attack_specific" （类别）
Attack-specific directives。

Chameleon attack detection: 0 = Off，1 = On。

“chameleon_from_php”
- Search为php header in文件that are neither php文件nor recognised archives。

“chameleon_from_exe”
- Search为executable headers in文件that are neither executables nor recognised archives和for executables 谁的 headers are incorrect。

“chameleon_to_archive”
- Search为archives 谁的 headers are incorrect (Supported: BZ，GZ，RAR，ZIP，RAR，GZ）。

“chameleon_to_doc”
- Search为office documents 谁的 headers are incorrect (Supported: DOC，DOT，PPS，PPT，XLA，XLS，WIZ）。

“chameleon_to_img”
- Search为images 谁的 headers are incorrect (Supported: BMP，DIB，PNG，GIF，JPEG，JPG，XCF，PSD，PDD，WEBP）。

“chameleon_to_pdf”
- Search为PDF文件谁的 headers are incorrect。

“archive_file_extensions"和"archive_file_extensions_wc”
- Recognised archive文件extensions (format是CSV；should only add or remove when problems occur；un一定 removing may cause false-positives to appear为archive files，whereas un一定 adding will essentially whitelist what you're adding from attack specific detection；modify with caution；also note that this has no effect on what archives can和can't be analysed at content-level). The list，as是at default，lists those formats used most commonly across the majority of systems和CMS，but intentionally isn't 一定 comprehensive。

“general_commands”
- Search content of files为general commands例如`eval()`，`exec()`和`include()`? 0 - No (do not check) 【标准】，1 - Yes (check). Disable this option if you intend to upload any of 下列在您的系统 or CMS via your browser: PHP，JavaScript，HTML，python，perl files和etcetera. Enable this option if you don't have any additional protections on your system和do not intend to upload such files. If you use additional security in conjunction with phpMussel例如ZB Block，there是no need to turn this option on，because most of what phpMussel will look为(in the context of this option) are duplications of protections that are already provided。

“block_control_characters”
- Block any文件containing any control characters (other than newlines)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) If you're _**ONLY**_ uploading plain-text，then you can turn this option on to provide some additional protection在您的系统. However，if you upload anything other than plain-text，turning this on may result in false positives. 0 - Don't block 【标准】，1 - Block。

“corrupted_exe”
- Corrupted files和parse errors. 0 = Ignore，1 = Block 【标准】. Detect和block potentially corrupted移植可执行｢PE｣ files? Often (but not always)，when certain aspects of a移植可执行｢PE｣file are corrupted or can't be parsed correctly，it can be indicative of a viral infection. The processes used by most 杀毒 programs to detect viruses in PE文件require 处理 those文件in certain ways，which，if the programmer of a virus是aware of，will specifically try to prevent，in order to allow their virus to remain undetected。

“decode_threshold”
- Optional limitation or threshold to the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues whilst scanning). Value是an integer representing filesize in KB. Default = 512 (512KB). Zero or null value disables the threshold (removing 任何这样的limitation based on filesize）。

“scannable_threshold”
- Optional limitation or threshold to the length of raw data that phpMussel是permitted to read和scan (in case there are any noticeable performance issues whilst scanning). Value是an integer representing filesize in KB. Default = 32768 (32MB). Zero or null value disables the threshold. Generally，this value shouldn't be less than the average filesize of文件uploads that you want和expect to receive to your server or website，shouldn't be more than the filesize_limit directive，和shouldn't be more than roughly one fifth of the total allowable memory allocation granted to PHP via the php.ini 配置文件. This directive exists to try to prevent phpMussel from using up too much memory (that'd prevent it from being able to successfully scan文件above a certain filesize）。

####"compatibility" （类别）
Compatibility directives为phpMussel。

“ignore_upload_errors”
- This directive should generally be disabled unless it's required为correct functionality of phpMussel on your specific system. Normally，when disabled，when phpMussel detects the presence of elements在`$_FILES` array()，it'll attempt to initiate a scan of the文件that those elements represent，and，if those elements are blank or empty，phpMussel will return an error message. This是proper behaviour为phpMussel。However，为some CMS，empty elements in `$_FILES` can occur as a result of the natural behaviour of those CMS，or errors may be reported when there aren't any，in which case，the normal behaviour为phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs为you，enabling this option will instruct phpMussel to not attempt to initiate scans为such empty elements，ignore them when found和to not return any related error messages，thus allowing continuation of the page request. 0 - OFF，1 - ON。

“only_allow_images”
- If you only expect or only intend to allow images to be uploaded在您的系统 or CMS，和if you absolutely don't require any文件other than images to be uploaded在您的系统 or CMS，this directive should be enabled，but should otherwise be disabled. If this directive是enabled，it'll instruct phpMussel to indiscriminately block any uploads identified as non-image files，without scanning them. This may reduce processing time和memory usage为attempted uploads of non-image files. 0 - OFF，1 - ON。

####"heuristic" （类别）
Heuristic directives。

“threshold”
- There are certain签名of phpMussel that are intended to identify suspicious和potentially malicious qualities of文件being uploaded without in themselves identifying those文件being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious和potentially malicious qualities of文件being uploaded that's allowable是before those文件are to be flagged as malicious. The definition of weight in this context是the total number of suspicious和potentially malicious qualities identified. By default，this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious文件being flagged，whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious文件being flagged. It's generally best to leave this value at its default unless you're experiencing problems related to it。

####"virustotal" （类别）
VirusTotal.com directives。

“vt_public_api_key”
- Optionally，phpMussel是able to scan文件using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses，trojans，malware和other threats. By default，scanning文件using the Virus Total API是disabled. To enable it，an API key from Virus Total是required. Due to the significant benefit that this could provide to you，it's something that I 很 recommend enabling. Please be aware，however，that to use the Virus Total API，you _**MUST**_ agree to their Terms of Service和you _**MUST**_ adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS：
  - You have read和agree to the Terms of Service of Virus Total和its API. The Terms of Service of Virus Total和its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/)。
  - You have read和you understand，at a minimum，the preamble of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). The Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/)。

Note: If scanning文件using the Virus Total API是disabled，you won't need to review any of the directives in this category (`virustotal`)，because none of them will do anything if this是disabled. To acquire a Virus Total API key，from anywhere on their website，click the "Join our Community" link located towards the top-right of the page，enter在information requested，和click "Sign up" 在做完. Follow all instructions supplied，和when you've got your public API key，copy/paste that public API key to the `vt_public_api_key` directive of the `phpmussel.ini` 配置文件。

“vt_suspicion_level”
- By default，phpMussel will restrict which文件it scans using the Virus Total API to those文件that it considers "suspicious". You can optionally adjust this restriction by changing the value of the `vt_suspicion_level` directive。
- `0`:文件are only considered suspicious if，upon being scanned by phpMussel using its own signatures，they are deemed to carry a heuristic weight. This would effectively mean that use of the Virus Total API 将会为a second opinion为when phpMussel suspects that a文件may potentially be malicious，but can't entirely rule out that it may also potentially be benign (non-malicious)和therefore would otherwise normally not block it or flag it as being malicious。
- `1`:文件are considered suspicious if，upon being scanned by phpMussel using its own signatures，they are deemed to carry a heuristic weight，if they're known to be executable (PE files，Mach-O files，ELF/Linux files，etc)，or if they're known to be of a format that could potentially contain executable data (such as executable macros，DOC/DOCX files，archive文件such as RARs，ZIPS和etc). This是the default和recommended suspicion level to apply，effectively meaning that use of the Virus Total API 将会为a second opinion为when phpMussel doesn't initially find anything malicious or wrong with a文件that it considers to be suspicious和therefore would otherwise normally not block it or flag it as being malicious。
- `2`: All文件are considered suspicious和should be scanned using the Virus Total API. I don't generally recommend applying this suspicion level，due to the risk of reaching your API quota much quicker than would otherwise be the case，but there are certain circumstances (such as when the webmaster or hostmaster has very little faith or trust whatsoever in any of the uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level，all文件not normally blocked or flagged as being malicious将会scanned using the Virus Total API. Note，however，that phpMussel will cease using the Virus Total API when your API quota has been reached (regardless of suspicion level)，和that your quota will likely be reached much faster when using this suspicion level。

Note: Regardless of suspicion level，any文件that are either blacklisted or whitelisted by phpMussel won't be scanned using the Virus Total API，because those such文件would've already been declared as either malicious or benign by phpMussel by the time that they would've otherwise been scanned by the Virus Total API，和therefore，additional scanning wouldn't be required. The ability of phpMussel to scan文件using the Virus Total API是intended to build further confidence为whether a file是malicious or benign in those circumstances where phpMussel itself isn't entirely certain as to whether a file是malicious or benign。

“vt_weighting”
- Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists，because，虽说 scanning a文件using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious文件being caught)，it can also result in a higher number of false positives，和therefore，in some circumstances，the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0是used，the results of scanning using the Virus Total API will be applied as detections，和therefore，if any engine used by Virus Total flags the文件being scanned as being malicious，phpMussel will consider the文件to be malicious. If any other value是used，the results of scanning using the Virus Total API will be applied as detection weighting，和therefore，the number of engines used by Virus Total that flag the文件being scanned as being malicious will serve as a confidence score (or detection weighting)为如果 the文件being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0是used by default。

“vt_quota_rate"和"vt_quota_time”
- According to the Virus Total API documentation，"it是limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient，honeypot or any other automation that是going to provide re来源 to VirusTotal和not only retrieve reports you are entitled to a higher request rate quota". By default，phpMussel will strictly adhere to these limitations，but due to the possibility of these rate quotas being increased，these two directives are provided as a means为you to instruct phpMussel as to what limit it should adhere to. Unless you've been instructed to do so，it's不推荐为you to increase these values，but，if you've encountered problems relating to reaching your rate quota，decreasing these values _**MAY**_ sometimes help you in dealing with these problems. Your rate limit是determined as `vt_quota_rate` requests of any nature in any given `vt_quota_time` minute time frame。

####"template_data" （类别）
Directives/Variables为templates和themes。

Template data relates to the HTML output used to generate the "Upload Denied" message displayed to users upon a文件upload being blocked. If you're using custom themes为phpMussel，HTML output是sourced from the `template_custom.html` file，和otherwise，HTML output是sourced from the `template.html` file. Variables written to this section of the 配置文件 are parsed to the HTML output by way of replacing any variable names circumfixed by curly brackets found within the HTML output with the corresponding variable data.为example，where `foo="bar"`，any instance of `<p>{foo}</p>` found within the HTML output will become `<p>bar</p>`。

“css_url”
- The 模板文件为custom themes utilises external CSS properties，whereas the 模板文件为the default theme utilises internal CSS properties. To instruct phpMussel to use the 模板文件为custom themes，specify the public HTTP address of your custom theme's CSS文件using the `css_url` variable. If you leave this variable blank，phpMussel will use the 模板文件为the default theme。

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

Where NAME是the name to cite为that signature和HEX是a hexadecimal-encoded segment of the文件intended to be matched by the given signature. FROM和TO are optional parameters，indicting from which和to which positions在source data to check against (not supported by the mail function）。

####*REGEX*
Any form of regex understood和correctly processed by PHP should also be correctly understood和processed by phpMussel和its signatures. However，I'd suggest taking extreme caution when writing new regex based signatures，because，if you're not entirely sure what you're doing，there can be 很 irregular 和／或 unexpected results. Take a look at the phpMussel source-code if you're not entirely sure about the context in which regex statements are parsed. Also，remember that all patterns (with exception to filename，archive metadata和MD5 patterns) must be hexadecimally encoded (foregoing pattern syntax，of course)!

####*WHERE TO PUT CUSTOM SIGNATURES?*
Only put custom签名in those文件意为custom signatures. Those文件should contain "_custom" in their filenames. You should also avoid editing the default signature files，unless you know exactly what you're doing，because，aside from being good practise in general和aside from helping you distinguish between your own signatures和the default签名included with phpMussel，it's good to stick to editing only the文件意为editing，because tampering with the default 签名文件can cause them to stop working correctly，due to the "maps" files: The maps文件tell phpMussel where在签名文件to look for签名required by phpMussel as per when required，和these maps can become out-of-sync with their associated 签名文件if those 签名文件are tampered with. You can put pretty much whatever you want into your custom signatures，so long as you follow the correct syntax. However，be careful to test new签名for false-positives beforehand if you intend to share them or use them in a live environment。

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

在大多数情况下，phpMussel应该相当兼容性与大多数杀毒软件。然，冲突已经报道由多个用户以往。下面这些信息是从VirusTotal.com，和它描述了一个数的假阳性报告的各种杀毒软件针对phpMussel。虽说这个信息是不绝对保证的如果您会遇到兼容性问题间phpMussel和您的杀毒软件，如果您的杀毒软件注意为冲突针对phpMussel，您应该考虑关闭它之前使用phpMussel或您应该考虑替代选项从您的杀毒软件或从phpMussel。

这个信息最后更新2015年9月7日和是准确为至少phpMussel的两个最近次要版本（v0.6-v0.7a）在这个现在时候的写作。

| 扫描器               |  结果                                 |
|----------------------|--------------------------------------|
| Ad-Aware             |  没有已知的问题                       |
| Agnitum              |  没有已知的问题                       |
| AhnLab-V3            |  没有已知的问题                       |
| AntiVir              |  没有已知的问题                       |
| Antiy-AVL            |  没有已知的问题                       |
| Avast                |  报告 "JS:ScriptSH-inf [Trj]"        |
| AVG                  |  没有已知的问题                       |
| Baidu-International  |  没有已知的问题                       |
| BitDefender          |  没有已知的问题                       |
| Bkav                 |  报告 "VEXDAD2.Webshell"             |
| ByteHero             |  没有已知的问题                       |
| CAT-QuickHeal        |  没有已知的问题                       |
| ClamAV               |  没有已知的问题                       |
| CMC                  |  没有已知的问题                       |
| Commtouch            |  没有已知的问题                       |
| Comodo               |  没有已知的问题                       |
| DrWeb                |  没有已知的问题                       |
| Emsisoft             |  没有已知的问题                       |
| ESET-NOD32           |  没有已知的问题                       |
| F-Prot               |  没有已知的问题                       |
| F-Secure             |  没有已知的问题                       |
| Fortinet             |  没有已知的问题                       |
| GData                |  没有已知的问题                       |
| Ikarus               |  没有已知的问题                       |
| Jiangmin             |  没有已知的问题                       |
| K7AntiVirus          |  没有已知的问题                       |
| K7GW                 |  没有已知的问题                       |
| Kaspersky            |  没有已知的问题                       |
| Kingsoft             |  没有已知的问题                       |
| Malwarebytes         |  没有已知的问题                       |
| McAfee               |  报告 "New Script.c"                 |
| McAfee-GW-Edition    |  报告 "New Script.c"                 |
| Microsoft            |  没有已知的问题                       |
| MicroWorld-eScan     |  没有已知的问题                       |
| NANO-Antivirus       |  没有已知的问题                       |
| Norman               |  没有已知的问题                       |
| nProtect             |  没有已知的问题                       |
| Panda                |  没有已知的问题                       |
| Qihoo-360            |  没有已知的问题                       |
| Rising               |  没有已知的问题                       |
| Sophos               |  没有已知的问题                       |
| SUPERAntiSpyware     |  没有已知的问题                       |
| Symantec             |  没有已知的问题                       |
| TheHacker            |  没有已知的问题                       |
| TotalDefense         |  没有已知的问题                       |
| TrendMicro           |  没有已知的问题                       |
| TrendMicro-HouseCall |  没有已知的问题                       |
| VBA32                |  没有已知的问题                       |
| VIPRE                |  没有已知的问题                       |
| ViRobot              |  没有已知的问题                       |


---


最后更新：2015年9月11日。
