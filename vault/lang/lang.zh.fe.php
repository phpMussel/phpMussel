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
 * This file: Chinese (simplified) language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">主页</a> | <a href="?phpmussel-page=logout">登出</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">登出</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = '认可存档文件扩展（格式是CSV；应该只添加或去掉当问题发生；不必要的去掉可能的可以导致假阳性出现为存档文件，​而不必要的增加将实质上白名单任何事您增加从专用攻击检测；修改有慎重；还请注这个无影响在什么存档可以和不能被分析在内容级）。​这个名单，​作为是作为标准，​名单那些格式使用最常见的横过多数的系统和CMS，​但有意是不全面。';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = '受阻任何文件包含任何控制字符吗（以外换行符）？​(<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) 如果您只上传纯文本，​您可以激活这个指令以提供某些另外保护在您的系统。​然而，​如果您上传任何事以外纯文本，​激活这个可能结果在假阳性。​False（假）=不受阻【默认】； True（真）=受阻。';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = '寻找可执行头在文件是不可执行文件也不认可存档文件和寻找可执行文件谁的头是不正确。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = '寻找PHP头在文件是不PHP文件也不认可存档文件。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = '寻找存档文件谁的头是不正确（已支持：BZ，​GZ，​RAR，​ZIP，​RAR，​GZ）。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = '寻找办公文档谁的头是不正确（已支持：DOC，​DOT，​PPS，​PPT，​XLA，​XLS，​WIZ）。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = '寻找图像谁的头是不正确（已支持：BMP，​DIB，​PNG，​GIF，​JPEG，​JPG，​XCF，​PSD，​PDD，​WEBP）。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = '寻找PDF文件谁的头是不正确。​False（假）=是关闭； True（真）=是激活。';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = '损坏文件和处理错误。​False（假）=忽略； True（真）=受阻【默认】。​检测和受阻潜在的损坏移植可执行【PE】文件吗？​时常（但不始终），​当某些零件的一个移植可执行【PE】文件是损坏或不能被正确处理，​它可以建议建议的一个病毒感染。​过程使用通过最杀毒程序以检测病毒在PE文件需要处理那些文件在某些方式，​哪里，​如果程序员的一个病毒是意识的，​将特别尝试防止，​以允许他们的病毒留不检测。';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = '在原始数据中解码命令的长度限制（如果有任何引人注目性能问题当扫描）。​默认 = 512KB。​零或空值将关闭门槛（去除任何这样的限基于文件大小）。';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = '原始数据读取和扫描的最大长度（如果有任何引人注目性能问题当扫描）。​默认 = 32MB。​零或空值将关闭门槛。​按说，​这个数值应不会少于平均文件大小的文件上传您想和期待收到您的服务器或网站，​应不会多于<code>filesize_limit</code>指令，​和应不会多于大致五分之一的总允许内存分配获授PHP通过"php.ini"配置文件。​这个指令存在为尝试防止phpMussel从用的太多内存（这个将防止它从能够顺利扫描文件以上的一个特别文件大小）。';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = '这个指令按说应会关闭除非它是需要为对功能的phpMussel在您的具体系统。​按说，​当是关闭，​当phpMussel检测存在元素在<code>$_FILES</code>数组，​它将尝试引发一个扫描的文件代表通过那些元素，​和，​如果他们是空或空白，​phpMussel将回报一个错误信息。​这个是正确行为为phpMussel。​然而，​为某些CMS，​空元素在<code>$_FILES</code>可以发生因之的自然的行为的那些CMS，​或错误可能会报告当没有任何，​在这种情况，​正常行为为phpMussel将会使干扰为正常行为的那些CMS。​如果这样的一个情况发生为您，​激活这个指令将指示phpMussel不尝试引发扫描为这样的空元素，​忽略他们当发现和不回报任何关联错误信息，​从而允许延续的页面请求。​False（假）=不忽略； True（真）=忽略。';
$phpMussel['lang']['config_compatibility_only_allow_images'] = '如果您只期待或只意味到允许图像被上传在您的系统或CMS，​和如果您绝对不需要任何文件以外图像被上传在您的系统或CMS，​这个指令应会激活，​但其他应会关闭。​如果这个指令是激活，​它将指示phpMussel受阻而不例外任何上传确定为非图像文件，​而不扫描他们。​这个可能减少处理时间和内存使用为非图像文件上传尝试。​False（假）=还允许其他文件； True（真）=只允许图像文件。';
$phpMussel['lang']['config_files_block_encrypted_archives'] = '检测和受阻加密的存档吗？​因为phpMussel是不能够扫描加密的存档内容，​它是可能存档加密可能的可以使用通过一个攻击者作为一种手段尝试绕过phpMussel，​杀毒扫描仪和其他这样的保护。​指示phpMussel受阻任何存档它发现被加密可能的可以帮助减少任何风险有关联这些可能性。​False（假）=不受阻； True（真）=受阻【默认】。';
$phpMussel['lang']['config_files_check_archives'] = '尝试匹配存档内容吗？​False（假）=不匹配； True（真）=匹配【默认】。​目前，​只BZ/BZIP2，​GZ/GZIP，​LZF，​PHAR，​TAR和ZIP文件格式是支持（匹配的RAR，​CAB，​7z和等等不还支持）。​这个是不完美！​虽说我很推荐保持这个激活，​我不能保证它将始终发现一切。​还，​请注意存档匹配目前是不递归为PHAR或ZIP格式。';
$phpMussel['lang']['config_files_filesize_archives'] = '继承文件大小黑名单/白名单在存档内容吗？​False（假）=不继承（刚灰名单一切）； True（真）=继承【默认】。';
$phpMussel['lang']['config_files_filesize_limit'] = '文件大小限在KB。​65536 = 64MB【默认】，​0 = 没有限（始终灰名单），​任何正数值接受。​这个可以有用当您的PHP配置限内存量一个进程可以占据或如果您的PHP配置限文件大小的上传。';
$phpMussel['lang']['config_files_filesize_response'] = '如何处理文件超过文件大小限（如果存在）。​False（假）=白名单； True（真）=黑名单【默认】。';
$phpMussel['lang']['config_files_filetype_archives'] = '继承文件类型黑名单/白名单在存档内容吗？​False（假）=不继承（刚灰名单一切）； True（真）=继承【默认】。';
$phpMussel['lang']['config_files_filetype_blacklist'] = '黑名单：';
$phpMussel['lang']['config_files_filetype_greylist'] = '灰名单：';
$phpMussel['lang']['config_files_filetype_whitelist'] = '如果您的系统只允许具体文件类型被上传，​或如果您的系统明确地否认某些文件类型，​指定那些文件类型在白名单，​黑名单和灰名单可以增加扫描执行速度通过允许脚本跳过某些文件类型。​格式是CSV（逗号分隔变量）。​如果您想扫描一切，​而不是白名单，​黑名单或灰名单，​留变量空；这样做将关闭白名单/黑名单/灰名单。​进程逻辑顺序是：如果文件类型已白名单，​不扫描和不受阻文件，​和不匹配文件对照黑名单或灰名单。​如果文件类型已黑名单，​不扫描文件但阻止它无论如何，​和不匹配文件对照灰名单。​如果灰名单是空，​或如果灰名单不空和文件类型已灰名单，​扫描文件像正常和确定如果阻止它基于扫描结果，​但如果灰名单不空和文件类型不灰名单，​过程文件仿佛已黑名单，​因此不扫描它但阻止它无论如何。​白名单：';
$phpMussel['lang']['config_files_max_recursion'] = '最大存档递归深度限。​默认=10。';
$phpMussel['lang']['config_files_max_uploads'] = '最大允许数值的文件为扫描当文件上传扫描之前中止扫描和告诉用户他们是上传太多在同一时间！​提供保护针对一个理论攻击哪里一个攻击者尝试DDoS您的系统或CMS通过超载phpMussel以减速PHP进程到一个停止。​推荐：10。​您可能想增加或减少这个数值，​根据速度的您的硬件。​注意这个数值不交待为或包括存档内容。';
$phpMussel['lang']['config_general_cleanup'] = '【反设置/删除/清洁】脚本变量和缓存【Cache】之后执行吗？​如果您不使用脚本外初始上传扫描，​应该设置True【真/正】，​为了最小化内存使用。​如果您使用脚本为目的外初始上传扫描，​应该设置False【假/负】，​为了避免不必要重新加载复制数据在内存。​在一般的做法，​它应该设置True【真/正】，​但，​如果您做这样，​您将不能够使用脚本为任何目的以外文件上传扫描。​无影响在CLI模式。';
$phpMussel['lang']['config_general_default_algo'] = '定义要用于所有未来密码和会话的算法。​选项：​​PASSWORD_DEFAULT（标准），​PASSWORD_BCRYPT，​PASSWORD_ARGON2I（需要PHP >= 7.2.0）。';
$phpMussel['lang']['config_general_delete_on_sight'] = '激活的这个指令将指示脚本马上删除任何扫描文件上传匹配任何检测标准，​是否通过签名或任何事其他。​文件已确定是清洁将会忽略。​如果是存档，​全存档将会删除，​不管如果违规文件是只有一个的几个文件包含在存档。​为文件上传扫描，​按说，​它不必要为您激活这个指令，​因为按说，​PHP将自动清洗内容的它的缓存当执行是完，​意思它将按说删除任何文件上传从它向服务器如果不已移动，​复制或删除。​这个指令是添加这里为额外安全为任何人谁的PHP副本可能不始终表现在预期方式。​False【假/负】：之后扫描，​忽略文件【标准】，​True【真/正】：之后扫描，​如果不清洁，​马上删除。';
$phpMussel['lang']['config_general_disable_cli'] = '关闭CLI模式吗？​CLI模式是按说激活作为标准，​但可以有时干扰某些测试工具（例如PHPUnit，​为例子）和其他基于CLI应用。​如果您没有需要关闭CLI模式，​您应该忽略这个指令。​False（假）=激活CLI模式【标准】； True（真）=关闭CLI模式。';
$phpMussel['lang']['config_general_disable_frontend'] = '关闭前端访问吗？​前端访问可以使phpMussel更易于管理，​但也可能是潜在的安全风险。​建议管理phpMussel通过后端只要有可能，​但前端访问提供当不可能。​保持关闭除非您需要它。​False（假）=激活前端访问； True（真）=关闭前端访问【标准】。';
$phpMussel['lang']['config_general_disable_webfonts'] = '关闭网络字体吗？​True（真）=关闭； False（假）=不关闭【标准】。';
$phpMussel['lang']['config_general_enable_plugins'] = '启用phpMussel插件支持吗？​False（假）=不要启用； True（真）=要启用【标准】。';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel应该发送<code>403</code>头随着文件上传受阻信息，​或坚持标准<code>200 OK</code>？​False（假）=发送<code>200</code>； True（真）=发送<code>403</code>【标准】。';
$phpMussel['lang']['config_general_FrontEndLog'] = '前端登录尝试的录音文件。​指定一个文件名，​或留空以禁用。';
$phpMussel['lang']['config_general_honeypot_mode'] = '当这个指令（蜜罐模式）是激活，​phpMussel将尝试检疫所有文件上传它遇到，​无论的如果文件上传是匹配任何包括签名，​和没有扫描或分析的那些文件上传将发生。​这个功能应有用为那些想使用的phpMussel为目的病毒或恶意软件研究，​但它是不推荐激活这个功能如果预期的用的phpMussel通过用户是为标准文件上传扫描，​也不推荐使用蜜罐功能为目的以外蜜罐。​作为标准，​这个指令是关闭。​False（假）=是关闭【标准】； True（真）=是激活。';
$phpMussel['lang']['config_general_ipaddr'] = '在哪里可以找到连接请求IP地址？​（可以使用为服务例如Cloudflare和类似）标准是<code>REMOTE_ADDR</code>。​警告！​不要修改此除非您知道什么您做着！';
$phpMussel['lang']['config_general_lang'] = '指定标准phpMussel语言。';
$phpMussel['lang']['config_general_maintenance_mode'] = '启用维护模式？​True（真）=关闭；​False（假）=不关闭【标准】。​它停用一切以外前端。​有时候在更新CMS，框架，等时有用。';
$phpMussel['lang']['config_general_max_login_attempts'] = '最大登录尝试次数（前端）。​标准=5。';
$phpMussel['lang']['config_general_numbers'] = '您如何喜欢显示数字？​选择最适合示例。';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel可以检疫坏文件上传在隔离在phpMussel的安全/保险库【Vault】，​如果这个是某物您想。​普通用户的phpMussel简单地想保护他们的网站或宿主环境无任何兴趣在深深分析任何尝试文件上传应该离开这个功能关闭，​但任何用户有兴趣在更深分析的尝试文件上传为目的恶意软件研究或为类似这样事情应该激活这个功能。​检疫的尝试文件上传可以有时还助攻在调试假阳性，​如果这个是某物经常发生为您。​以关闭检疫功能，​简单地离开<code>quarantine_key</code>指令空白，​或抹去内容的这个指令如果它不已空白。​以激活隔离功能，​输入一些值在这个指令。​<code>quarantine_key</code>是一个重要安全功能的隔离功能需要以预防检疫功能从成为利用通过潜在攻击者和以预防任何潜在执行的数据存储在检疫。​<code>quarantine_key</code>应该被处理在同样方法作为您的密码：更长是更好，​和紧紧保护它。​为获得最佳效果，​在结合使用<code>delete_on_sight</code>。';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = '最大允许文件大小为文件在检疫。​文件大于这个指定数值将不成为检疫。​这个指令是重要为使它更难为任何潜在攻击者洪水您的检疫用非通缉数据潜在的造成过度数据用法在您的虚拟主机服务。​标准 = 2MB。';
$phpMussel['lang']['config_general_quarantine_max_usage'] = '最大内存使用允许为检疫。​如果总内存已用通过隔离到达这个数值，​最老检疫文件将会删除直到总内存已用不再到达这个数值。​这个指令是重要为使它更难为任何潜在攻击者洪水您的检疫用非通缉数据潜在的造成过度数据用法在您的虚拟主机服务。​标准 = 64MB。';
$phpMussel['lang']['config_general_scan_cache_expiry'] = '多长时间应该phpMussel维持扫描结果？​数值是秒数为维持扫描结果。​标准是21600秒（6小时）； 一个<code>0</code>数值将停止维持扫描结果。';
$phpMussel['lang']['config_general_scan_kills'] = '文件为记录在所有受阻或已杀上传。​指定一个文件名，​或留空以关闭。';
$phpMussel['lang']['config_general_scan_log'] = '文件为记录在所有扫描结果。​指定一个文件名，​或留空以关闭。';
$phpMussel['lang']['config_general_scan_log_serialized'] = '文件为记录在所有扫描结果（它采用序列化格式）。​指定一个文件名，​或留空以关闭。';
$phpMussel['lang']['config_general_statistics'] = '跟踪phpMussel使用情况统计？​True（真）=跟踪； False（假）=不跟踪【标准】。';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel使用的日期符号格式。​可根据要求增加附加选项。';
$phpMussel['lang']['config_general_timeOffset'] = '时区偏移量（分钟）。';
$phpMussel['lang']['config_general_timezone'] = '您的时区。';
$phpMussel['lang']['config_general_truncate'] = '截断日志文件当他们达到一定的大小吗？​值是在B/KB/MB/GB/TB，​是日志文件允许的最大大小直到它被截断。​默认值为“0KB”将禁用截断（日志文件可以无限成长）。​注意：适用于单个日志文件！​日志文件大小不被算集体的。';
$phpMussel['lang']['config_heuristic_threshold'] = '有某些签名的phpMussel意味为确定可疑和可能恶意文件零件被上传有不在他们自己确定那些文件被上传特别是作为恶意。​这个“threshold”数值告诉phpMussel什么是最大总重量的可疑和潜在恶意文件零件被上传允许之前那些文件是被识别作为恶意。​定义的重量在这个上下文是总数值的可疑和可能恶意文件零件确定。​作为默认，​这个数值将会设置作为3。​一个较低的值通常将结果在一个更高的发生的假阳性但一个更高的发生的恶意文件被确定，​而一个更高的数值将通常结果在一个较低的发生的假阳性但一个较低的数值的恶意文件被确定。​它是通常最好忽略这个数值除非您遇到关联问题。';
$phpMussel['lang']['config_signatures_Active'] = '活性签名文件的列表，​以逗号分隔。';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel应该使用签名为广告软件检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel应该使用签名为污损和污损软件检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel应该检测并阻止加密的文件吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel应该使用签名为病毒/恶意软件笑话/恶作剧检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel应该使用签名为打包机和打包数据检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel应该使用签名为PUP/PUA（可能无用/非通缉程序/软件）检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel应该使用签名为webshell脚本检测吗？​False（假）=不检查，​True（真）=检查【默认】。';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'phpMussel应该报告当扩展是失踪吗？​如果<code>fail_extensions_silently</code>是关闭，​失踪扩展将会报告当扫描，​和如果<code>fail_extensions_silently</code>是激活，​失踪扩展将会忽略，​有扫描报告为那些文件哪里没有任何问题。​关闭的这个指令可能的可以增加您的安全，​但可能还导致一个增加的假阳性。​False（假）=是关闭； True（真）=是激活【默认】。';
$phpMussel['lang']['config_signatures_fail_silently'] = 'phpMussel应该报告当签名文件是失踪或损坏吗？​如果<code>fail_silently</code>是关闭，​失踪和损坏文件将会报告当扫描，​和如果<code>fail_silently</code>是激活，​失踪和损坏文件将会忽略，​有扫描报告为那些文件哪里没有问题。​这个应该按说被留下除非您遇到失败或有其他类似问题。​False（假）=是关闭； True（真）=是激活【默认】。';
$phpMussel['lang']['config_template_data_css_url'] = '模板文件为个性化主题使用外部CSS属性，​而模板文件为t标准主题使用内部CSS属性。​以指示phpMussel使用模板文件为个性化主题，​指定公共HTTP地址的您的个性化主题的CSS文件使用<code>css_url</code>变量。​如果您离开这个变量空白，​phpMussel将使用模板文件为默认主题。';
$phpMussel['lang']['config_template_data_Magnification'] = '字体放大。​标准 = 1。';
$phpMussel['lang']['config_template_data_theme'] = '用于phpMussel的默认主题。';
$phpMussel['lang']['config_urlscanner_cache_time'] = '多长时间（以秒为单位）应API结果被缓存？​默认是3600秒（1小时）。';
$phpMussel['lang']['config_urlscanner_google_api_key'] = '激活Google Safe Browsing API当API密钥是设置。';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = '激活hpHosts API当设置<code>true</code>。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = '最大数值API请求来执行每个扫描迭代。​额外API请求将增加的总要求完成时间每扫描迭代，​所以，​您可能想来规定一个限以加快全扫描过程。​当设置<code>0</code>，​没有最大数值将会应用的。​设置<code>10</code>作为默认。';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = '该什么办如果最大数值API请求已超过？​False（假）=没做任何事（继续处理）【默认】； True（真）=标志/受阻文件。';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = '可选的，​phpMussel可以扫描文件使用【Virus Total API】作为一个方法提供一个显着的改善保护级别针对病毒，​木马，​恶意软件和其他威胁。​作为默认，​扫描文件使用【Virus Total API】是关闭。​以激活它，​一个API密钥从VirusTotal是需要。​因为的显着好处这个可以提供为您，​它是某物我很推荐激活。​请注意，​然而，​以使用的【Virus Total API】，​您必须同意他们的服务条款和您必须坚持所有方针按照说明通过VirusTotal阅读材料！​您是不允许使用这个积分功能除非：您已阅读和您同意服务条款的VirusTotal和它的API。​您已阅读和您了解至少序言的VirusTotal公共API阅读材料(一切之后“VirusTotal Public API v2.0”但之前“Contents”）。';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = '根据【Virus Total API】阅读材料，​它是限于最大的<code>4</code>请求的任何类型在任何<code>1</code>分钟大体时间。​如果您经营一个“honeyclient”，​蜜罐或任何其他自动化将会提供资源为VirusTotal和不只取回报告您是有权一个更高请求率配额。​作为标准，​phpMussel将严格的坚持这些限制，​但因为可能性的这些率配额被增加，​这些二指令是提供为您指示phpMussel为什么限它应坚持。​除非您是指示这样做，​它是不推荐为您增加这些数值，​但，​如果您遇到问题相关的到达您的率配额，​减少这些数值可能有时帮助您解析这些问题。​您的率限是决定作为<code>vt_quota_rate</code>请求的任何类型在任何<code>vt_quota_time</code>分钟大体时间。';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '（见上面的说明）。';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = '作为标准，​phpMussel将限制什么文件它扫描通过使用【Virus Total API】为那些文件它考虑作为“可疑”。​您可以可选调整这个局限性通过修改的<code>vt_suspicion_level</code>指令数值。';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMussel应使用扫描结果使用【Virus Total API】作为检测或作为检测重量吗？​这个指令存在，​因为，​虽说扫描一个文件使用多AV引擎（例如怎么样VirusTotal做） 应结果有一个增加检测率（和因此在一个更恶意文件被抓），​它可以还结果有更假阳性，​和因此，​为某些情况，​扫描结果可能被更好使用作为一个置信得分而不是作为一个明确结论。​如果一个数值的<code>0</code>是使用，​扫描结果使用【Virus Total API】将会适用作为检测，​和因此，​如果任何AV引擎使用通过VirusTotal标志文件被扫描作为恶意，​phpMussel将考虑文件作为恶意。​如果任何其他数值是使用，​扫描结果使用【Virus Total API】将会适用作为检测重量，​和因此，​数的AV引擎使用通过VirusTotal标志文件被扫描作为恶意将服务作为一个置信得分（或检测重量） 为如果文件被扫描应会考虑恶意通过phpMussel（数值使用将代表最低限度的置信得分或重量需要以被考虑恶意）。​一个数值的<code>0</code>是使用作为标准。';
$phpMussel['lang']['Extended Description: phpMussel'] = '主包（没有签名文件，文档，和配置）。';
$phpMussel['lang']['field_activate'] = '启用';
$phpMussel['lang']['field_clear_all'] = '撤销所有';
$phpMussel['lang']['field_component'] = '组件';
$phpMussel['lang']['field_create_new_account'] = '创建新账户';
$phpMussel['lang']['field_deactivate'] = '停用';
$phpMussel['lang']['field_delete_account'] = '删除账户';
$phpMussel['lang']['field_delete_all'] = '删除所有';
$phpMussel['lang']['field_delete_file'] = '删除';
$phpMussel['lang']['field_download_file'] = '下载';
$phpMussel['lang']['field_edit_file'] = '编辑';
$phpMussel['lang']['field_false'] = 'False（假）';
$phpMussel['lang']['field_file'] = '文件';
$phpMussel['lang']['field_filename'] = '文件名：';
$phpMussel['lang']['field_filetype_directory'] = '文件夹';
$phpMussel['lang']['field_filetype_info'] = '{EXT}文件';
$phpMussel['lang']['field_filetype_unknown'] = '未知';
$phpMussel['lang']['field_install'] = '安装';
$phpMussel['lang']['field_latest_version'] = '最新版本';
$phpMussel['lang']['field_log_in'] = '登录';
$phpMussel['lang']['field_more_fields'] = '更多字段';
$phpMussel['lang']['field_new_name'] = '新名称：';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = '选项';
$phpMussel['lang']['field_password'] = '密码';
$phpMussel['lang']['field_permissions'] = '权限';
$phpMussel['lang']['field_quarantine_key'] = '隔离钥匙';
$phpMussel['lang']['field_rename_file'] = '改名';
$phpMussel['lang']['field_reset'] = '重启';
$phpMussel['lang']['field_restore_file'] = '恢复';
$phpMussel['lang']['field_set_new_password'] = '保存新密码';
$phpMussel['lang']['field_size'] = '总大小：';
$phpMussel['lang']['field_size_bytes'] = '字节';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = '状态';
$phpMussel['lang']['field_system_timezone'] = '使用系统默认时区。';
$phpMussel['lang']['field_true'] = 'True（真）';
$phpMussel['lang']['field_uninstall'] = '卸载';
$phpMussel['lang']['field_update'] = '更新';
$phpMussel['lang']['field_update_all'] = '更新一切';
$phpMussel['lang']['field_upload_file'] = '上传新文件';
$phpMussel['lang']['field_username'] = '用户名';
$phpMussel['lang']['field_your_version'] = '您的版本';
$phpMussel['lang']['header_login'] = '请登录以继续。';
$phpMussel['lang']['label_active_config_file'] = '活动配置文件：';
$phpMussel['lang']['label_blocked'] = '上传已阻止';
$phpMussel['lang']['label_branch'] = '分支最新稳定：';
$phpMussel['lang']['label_events'] = '扫描事件';
$phpMussel['lang']['label_flagged'] = '对象已标记';
$phpMussel['lang']['label_fmgr_cache_data'] = '缓存数据和临时文件';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel使用的磁盘空间： ';
$phpMussel['lang']['label_fmgr_free_space'] = '可用磁盘空间： ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = '总共使用的磁盘空间： ';
$phpMussel['lang']['label_fmgr_total_space'] = '总磁盘空间： ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = '组件更新元数据';
$phpMussel['lang']['label_hide'] = '隐藏';
$phpMussel['lang']['label_os'] = '目前使用操作系统：';
$phpMussel['lang']['label_other'] = '其他';
$phpMussel['lang']['label_other-Active'] = '活动签名文件';
$phpMussel['lang']['label_other-Since'] = '开始日期';
$phpMussel['lang']['label_php'] = '目前使用PHP版本：';
$phpMussel['lang']['label_phpmussel'] = '目前使用phpMussel版本：';
$phpMussel['lang']['label_quarantined'] = '上传已隔离';
$phpMussel['lang']['label_sapi'] = '目前使用SAPI：';
$phpMussel['lang']['label_scanned_objects'] = '对象已扫描';
$phpMussel['lang']['label_scanned_uploads'] = '上传已扫描';
$phpMussel['lang']['label_show'] = '显示';
$phpMussel['lang']['label_size_in_quarantine'] = '大小在检疫：';
$phpMussel['lang']['label_stable'] = '最新稳定：';
$phpMussel['lang']['label_sysinfo'] = '系统信息：';
$phpMussel['lang']['label_tests'] = '测试：';
$phpMussel['lang']['label_unstable'] = '最新不稳定：';
$phpMussel['lang']['label_upload_date'] = '上传日期：';
$phpMussel['lang']['label_upload_hash'] = '上传哈希：';
$phpMussel['lang']['label_upload_origin'] = '上传原点：';
$phpMussel['lang']['label_upload_size'] = '上传大小：';
$phpMussel['lang']['link_accounts'] = '账户';
$phpMussel['lang']['link_config'] = '配置';
$phpMussel['lang']['link_documentation'] = '文档';
$phpMussel['lang']['link_file_manager'] = '文件管理器';
$phpMussel['lang']['link_home'] = '主页';
$phpMussel['lang']['link_logs'] = '日志';
$phpMussel['lang']['link_quarantine'] = '隔离';
$phpMussel['lang']['link_statistics'] = '统计';
$phpMussel['lang']['link_textmode'] = '文字格式： <a href="%1$sfalse">简单</a> – <a href="%1$strue">漂亮</a>';
$phpMussel['lang']['link_updates'] = '更新';
$phpMussel['lang']['link_upload_test'] = '上传测试';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = '选择的日志不存在！';
$phpMussel['lang']['logs_no_logfiles_available'] = '没有日志可用。';
$phpMussel['lang']['logs_no_logfile_selected'] = '没有选择的日志。';
$phpMussel['lang']['max_login_attempts_exceeded'] = '最大登录尝试次数已经超过；拒绝访问。';
$phpMussel['lang']['previewer_days'] = '天';
$phpMussel['lang']['previewer_hours'] = '小时';
$phpMussel['lang']['previewer_minutes'] = '分';
$phpMussel['lang']['previewer_months'] = '月';
$phpMussel['lang']['previewer_seconds'] = '秒';
$phpMussel['lang']['previewer_weeks'] = '周';
$phpMussel['lang']['previewer_years'] = '年';
$phpMussel['lang']['response_accounts_already_exists'] = '一个账户与那个用户名已经存在！';
$phpMussel['lang']['response_accounts_created'] = '账户成功创建！';
$phpMussel['lang']['response_accounts_deleted'] = '账户成功删除！';
$phpMussel['lang']['response_accounts_doesnt_exist'] = '那个账户不存在。';
$phpMussel['lang']['response_accounts_password_updated'] = '密码成功更新！';
$phpMussel['lang']['response_activated'] = '已成功启用。';
$phpMussel['lang']['response_activation_failed'] = '无法启用！';
$phpMussel['lang']['response_checksum_error'] = '校验和错误！​文件拒绝！';
$phpMussel['lang']['response_component_successfully_installed'] = '组件成功安装。';
$phpMussel['lang']['response_component_successfully_uninstalled'] = '组件成功卸载。';
$phpMussel['lang']['response_component_successfully_updated'] = '组件成功更新。';
$phpMussel['lang']['response_component_uninstall_error'] = '一个错误发生当尝试卸载组件。';
$phpMussel['lang']['response_configuration_updated'] = '配置成功更新。';
$phpMussel['lang']['response_deactivated'] = '已成功停用。';
$phpMussel['lang']['response_deactivation_failed'] = '无法停用！';
$phpMussel['lang']['response_delete_error'] = '无法删除！';
$phpMussel['lang']['response_directory_deleted'] = '文件夹成功删除！';
$phpMussel['lang']['response_directory_renamed'] = '文件夹成功改名！';
$phpMussel['lang']['response_error'] = '错误';
$phpMussel['lang']['response_failed_to_install'] = '无法安装！';
$phpMussel['lang']['response_failed_to_update'] = '无法更新！';
$phpMussel['lang']['response_file_deleted'] = '文件成功删除！';
$phpMussel['lang']['response_file_edited'] = '文件成功改性！';
$phpMussel['lang']['response_file_renamed'] = '文件成功改名！';
$phpMussel['lang']['response_file_restored'] = '文件成功恢复！';
$phpMussel['lang']['response_file_uploaded'] = '文件成功上传！';
$phpMussel['lang']['response_login_invalid_password'] = '登录失败！​密码无效！';
$phpMussel['lang']['response_login_invalid_username'] = '登录失败！​用户名不存在！';
$phpMussel['lang']['response_login_password_field_empty'] = '密码输入是空的！';
$phpMussel['lang']['response_login_username_field_empty'] = '用户名输入是空的！';
$phpMussel['lang']['response_rename_error'] = '无法改名！';
$phpMussel['lang']['response_restore_error_1'] = '无法恢复！损坏的文件！';
$phpMussel['lang']['response_restore_error_2'] = '无法恢复！不正确的隔离钥匙！';
$phpMussel['lang']['response_statistics_cleared'] = '统计删除。';
$phpMussel['lang']['response_updates_already_up_to_date'] = '已经更新。';
$phpMussel['lang']['response_updates_not_installed'] = '组件不安装！';
$phpMussel['lang']['response_updates_not_installed_php'] = '组件不安装（它需要PHP {V}）！';
$phpMussel['lang']['response_updates_outdated'] = '过时！';
$phpMussel['lang']['response_updates_outdated_manually'] = '过时（请更新手动）！';
$phpMussel['lang']['response_updates_outdated_php_version'] = '过时（它需要PHP {V}）！';
$phpMussel['lang']['response_updates_unable_to_determine'] = '无法确定。';
$phpMussel['lang']['response_upload_error'] = '无法上传！';
$phpMussel['lang']['state_complete_access'] = '完全访问';
$phpMussel['lang']['state_component_is_active'] = '组件是活性。';
$phpMussel['lang']['state_component_is_inactive'] = '组件是非活性。';
$phpMussel['lang']['state_component_is_provisional'] = '组件是有时活性。';
$phpMussel['lang']['state_default_password'] = '警告：它使用标准密码！';
$phpMussel['lang']['state_logged_in'] = '目前在线。';
$phpMussel['lang']['state_logs_access_only'] = '仅日志访问';
$phpMussel['lang']['state_maintenance_mode'] = '警告：维护模式是启用！';
$phpMussel['lang']['state_password_not_valid'] = '警告：此账户不​使用有效的密码！';
$phpMussel['lang']['state_quarantine'] = '目前有%s个文件在隔离区。';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = '不要隐藏非过时';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = '隐藏非过时';
$phpMussel['lang']['switch-hide-unused-set-false'] = '不要隐藏非用过';
$phpMussel['lang']['switch-hide-unused-set-true'] = '隐藏非用过';
$phpMussel['lang']['tip_accounts'] = '你好，​{username}。​<br />账户页面允许您控制谁可以访问phpMussel前端。';
$phpMussel['lang']['tip_config'] = '你好，​{username}。​<br />配置页面允许您修改phpMussel配置从前端。';
$phpMussel['lang']['tip_donate'] = 'phpMussel是免费提供的，​但如果您想捐赠给项目，​您可以通过点击捐赠按钮这样做。';
$phpMussel['lang']['tip_file_manager'] = '你好，​{username}。​<br />文件管理器允许您删除，​编辑，​上传和下载文件。​小心使用（您可以用这个破坏您的安装）。';
$phpMussel['lang']['tip_home'] = '你好，​{username}。​<br />这是phpMussel的前端主页。​从左侧的导航菜单中选择一个链接以继续。';
$phpMussel['lang']['tip_login'] = '标准用户名：<span class="txtRd">admin</span> – 标准密码：<span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = '你好，​{username}。​<br />选择一个日志从下面的列表以查看那个日志的内容。';
$phpMussel['lang']['tip_quarantine'] = '你好，​{username}。​<br />此页面列出当前在隔离中的所有文件，并可以用来管理这些文件。';
$phpMussel['lang']['tip_quarantine_disabled'] = '注意：隔离目前禁用，但可以通过配置页面启用。';
$phpMussel['lang']['tip_see_the_documentation'] = '请参阅<a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.zh.md#SECTION7">文档</a>以获取有关各种配置指令的信息和他们的目的。';
$phpMussel['lang']['tip_statistics'] = '你好，​{username}。​<br />此页面显示了有关phpMussel安装的一些基本使用统计信息。';
$phpMussel['lang']['tip_statistics_disabled'] = '注意：统计跟踪目前已被禁用，但可以通过配置页面启用。';
$phpMussel['lang']['tip_updates'] = '你好，​{username}。​<br />更新页面允许您安装，​卸载，​和更新phpMussel的各种组件（核心包，​签名，​插件，​L10N文件，​等等）。';
$phpMussel['lang']['tip_upload_test'] = '你好，​{username}。​<br />上传测试页面包含标准文件上传表单，​允许您测试是否文件通常会被阻止通过phpMussel当尝试上传他们。';
$phpMussel['lang']['title_accounts'] = 'phpMussel – 账户';
$phpMussel['lang']['title_config'] = 'phpMussel – 配置';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – 文件管理器';
$phpMussel['lang']['title_home'] = 'phpMussel – 主页';
$phpMussel['lang']['title_login'] = 'phpMussel – 登录';
$phpMussel['lang']['title_logs'] = 'phpMussel – 日志';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – 隔离';
$phpMussel['lang']['title_statistics'] = 'phpMussel – 统计';
$phpMussel['lang']['title_updates'] = 'phpMussel – 更新';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – 上传测试';
$phpMussel['lang']['warning'] = '警告：';
$phpMussel['lang']['warning_php_1'] = '您的PHP版本不再被积极支持！​推荐更新！';
$phpMussel['lang']['warning_php_2'] = '您的PHP版本非常脆弱！​强烈推荐更新！';
$phpMussel['lang']['warning_signatures_1'] = '没有签名文件是活动的！';

$phpMussel['lang']['info_some_useful_links'] = '一些有用的链接：<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel问题 ＠ GitHub</a> – phpMussel问题页面（支持，​协助，​等等）。​</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel ＠ Spambot Security</a> – phpMussel讨论论坛（支持，​协助，​等等）。​</li>
            <li><a href="https://www.oschina.net/p/phpMussel">phpMussel＠开源中国社区</a> – phpMussel页面托管在开源中国社区。​</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel ＠ SourceForge</a> – phpMussel替代下载镜像。​</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – 简单网站管理员工具集合为保护网站。​</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV主页（ClamAV®是一个开源的防病毒引擎用于检测木马，​病毒，​恶意软件和其他恶意威胁）。​</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – 一家计算机安全公司；为ClamAV提供补充签名。​</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – 网络钓鱼数据库；由phpMussel URL扫描器使用。​</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group ＠ Facebook</a> – PHP学习资源和讨论。​</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP学习资源和讨论。​</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal是一项免费服务，​用于分析可疑文件和URL。​</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis是由<a href="http://www.payload-security.com/">Payload Security</a>提供的免费恶意软件分析服务。​</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – 电脑反恶意软件专家。​</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – 有用的讨论论坛关于恶意软件。​</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">脆弱性图表</a> – 列出各种软件包的安全/不安全版本（PHP，HHVM，等等）。</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">兼容性图表</a> – 列出各种软件包的兼容性信息（CIDRAM，phpMussel，等等）。</li>
        </ul>';
