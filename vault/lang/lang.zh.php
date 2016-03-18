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
 * This file: Chinese (simplified) language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = '我不明白的命令，对不起。';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - 戒烟CLI模式。\n - 别名：quit，exit。\n md5_file\n - 生成MD5签名从文件[语法：md5_file 文件名]。\n - 别名：m.\n md5\n - 生成MD5签名从数据[语法：md5 数据]。\n hex_encode\n - 兑换从二进制数据至十六进制[语法：hex_encode 数据]。\n - 别名：x.\n hex_decode\n - 兑换从十六进制二进制数据至[语法：hex_decode 数据]。\n base64_encode\n - 兑换从二进制数据至基地64数据[语法：base64_encode 数据]。\n - 别名：b.\n base64_decode\n - 兑换从基地64数据至二进制数据[语法：base64_decode 数据]。\n scan\n - 扫描文件或文件夹[语法：scan 文件名]。\n - 别名：s。\n update\n - 更新phpMussel。\n - 别名：u。\n c\n - 打印此命令列表。\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = '完成扫描过程失败';
$phpMussel['Config']['lang']['cli_is_not_a'] = '不是文件或文件夹。';
$phpMussel['Config']['lang']['cli_ln2'] = "谢谢对于使用phpMussel，一个PHP脚本旨在检测木马，病毒，恶意软件，和其他威胁在文件上传到您的系统随地这个脚本是叫，根据ClamAV的签名和其他签名。\n\n PHPMUSSEL版权2013和此后GNU/GPLv.2通过Caleb M （Maikuolan）。\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " 目前经营phpMussel在CLI模式（命令行界面）。\n\n 扫描一个文件或文件夹，键入“scan”，其次是名的文件或文件夹您想phpMussel扫描然后按Enter键；\n 键入“c”然后按Enter键对于CLI模式命令名单；键入“q”然后按Enter键对于戒烟：";
$phpMussel['Config']['lang']['cli_pe1'] = '不PE文件！';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE部分:';
$phpMussel['Config']['lang']['cli_update_restart'] = ' 重新启动phpMussel可能是需要之前的更新变得明显。';
$phpMussel['Config']['lang']['cli_working'] = '进行中';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel控制闭锁是启用。';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = '核心文件是丢失！请重新安装phpMussel。';
$phpMussel['Config']['lang']['corrupted'] = '检测损坏PE';
$phpMussel['Config']['lang']['denied'] = '上传是否认！';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = '您的上传被拒绝由于这些原因 / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = '检测{vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = '检测控制字符';
$phpMussel['Config']['lang']['encrypted_archive'] = '检测加密档案文件; 加密档案文件不允许';
$phpMussel['Config']['lang']['failed_to_access'] = '无法访问';
$phpMussel['Config']['lang']['file'] = '文件';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = '文件大小超过限制';
$phpMussel['Config']['lang']['filetype_blacklisted'] = '文件类型列入黑名单';
$phpMussel['Config']['lang']['finished'] = '完了';
$phpMussel['Config']['lang']['generated_by'] = '所产生通过';
$phpMussel['Config']['lang']['greylist_cleared'] = ' 灰名单清空。';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' 灰名单不更新。';
$phpMussel['Config']['lang']['greylist_updated'] = ' 灰名单更新。';
$phpMussel['Config']['lang']['image'] = '图像';
$phpMussel['Config']['lang']['instance_already_active'] = '脚本已激活！请仔细检查您的钩子。';
$phpMussel['Config']['lang']['invalid_file'] = '无效的文件';
$phpMussel['Config']['lang']['invalid_url'] = '无效的网址！';
$phpMussel['Config']['lang']['ok'] = '好';
$phpMussel['Config']['lang']['only_allow_images'] = '上传文件以外图片不允许';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel关闭。';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel已关闭。';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel激活。';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel已激活。';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = '插件文件夹不存在！';
$phpMussel['Config']['lang']['recursive'] = '递归深度超过是限制';
$phpMussel['Config']['lang']['required_variables_not_defined'] = '需要的变量是未定义：无法继续。';
$phpMussel['Config']['lang']['scan_aborted'] = '扫描中止！';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x}变色龙攻击检测';
$phpMussel['Config']['lang']['scan_checking'] = '检查';
$phpMussel['Config']['lang']['scan_checking_contents'] = '成功了！在进行检查的内容。';
$phpMussel['Config']['lang']['scan_command_injection'] = '命令注入尝试检测';
$phpMussel['Config']['lang']['scan_complete'] = '完成';
$phpMussel['Config']['lang']['scan_extensions_missing'] = '失败（失踪必需的扩展）！';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = '文件名操控检测';
$phpMussel['Config']['lang']['scan_map_corrupted'] = '签名地图是损坏';
$phpMussel['Config']['lang']['scan_map_missing'] = '签名地图是失踪';
$phpMussel['Config']['lang']['scan_missing_filename'] = '文件名是失踪';
$phpMussel['Config']['lang']['scan_not_archive'] = '失败（空或不是存档）！';
$phpMussel['Config']['lang']['scan_no_problems_found'] = '没有任何问题发现。';
$phpMussel['Config']['lang']['scan_reading'] = '阅读';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = '签名文件是损坏';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = '签名文件是失踪';
$phpMussel['Config']['lang']['scan_tampering'] = '检测潜在的危险文件篡改';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = '未经授权的文件上传操控是检测';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = '未经授权的文件上传操控或配置错误是检测！';
$phpMussel['Config']['lang']['started'] = '开始';
$phpMussel['Config']['lang']['too_many_urls'] = '太多的URL';
$phpMussel['Config']['lang']['update_'] = 'phpMussel现在将尝试进行自我更新。';
$phpMussel['Config']['lang']['update_available'] = '编程更新可用。';
$phpMussel['Config']['lang']['update_complete'] = '更新检查成功完成。';
$phpMussel['Config']['lang']['update_created'] = '创建';
$phpMussel['Config']['lang']['update_deleted'] = '删除';
$phpMussel['Config']['lang']['update_err1'] = '更新失败：“update.dat”失踪。重新安装或手动更新。';
$phpMussel['Config']['lang']['update_err2'] = '更新失败：“update.dat”不包含任何有效的更新源。请手动更新。';
$phpMussel['Config']['lang']['update_err3'] = '潜力黑客或伪造品是检测在更新命令提供通过更新来源；源可能是妥协。请通知编程作者。手动更新是推荐。';
$phpMussel['Config']['lang']['update_err4'] = '哈希码失踪！';
$phpMussel['Config']['lang']['update_err5'] = '数据失踪！';
$phpMussel['Config']['lang']['update_err6'] = '数据损坏！';
$phpMussel['Config']['lang']['update_err7'] = '哈希码损坏！';
$phpMussel['Config']['lang']['update_failed'] = '失败。';
$phpMussel['Config']['lang']['update_fetch'] = '试图获取版本数据从“{Location}”。。。';
$phpMussel['Config']['lang']['update_lock_detected'] = '更新锁检测：无法继续。检查是否有损坏的更新或稍后再试。';
$phpMussel['Config']['lang']['update_not'] = '不{x}';
$phpMussel['Config']['lang']['update_not_available'] = '没有可用编程更新这个时。';
$phpMussel['Config']['lang']['update_not_possible'] = '编程更新是可用的，但它不能完全更新使用此版本的更新编程。请手动更新。';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel失败自我更新因为无法连接至有效的更新源。手动更新是推荐。';
$phpMussel['Config']['lang']['update_patched'] = '修订';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = '更新编程文件是失踪！请重新安装phpMussel。';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = '秒过去';
$phpMussel['Config']['lang']['update_signatures_available'] = '签名更新是可用的。';
$phpMussel['Config']['lang']['update_signatures_latest'] = '最新签名';
$phpMussel['Config']['lang']['update_signatures_not_available'] = '没有签名更新可用这个时。';
$phpMussel['Config']['lang']['update_signatures_yours'] = '您的签名';
$phpMussel['Config']['lang']['update_success'] = '成功了。';
$phpMussel['Config']['lang']['update_successfully'] = '成功了';
$phpMussel['Config']['lang']['update_version_latest'] = '最新编程版本';
$phpMussel['Config']['lang']['update_version_yours'] = '您的编程版本';
$phpMussel['Config']['lang']['update_was'] = '是{x}';
$phpMussel['Config']['lang']['update_wrd1'] = '签名';
$phpMussel['Config']['lang']['upload_error_1'] = '文件大小超过upload_max_filesize指令。';
$phpMussel['Config']['lang']['upload_error_2'] = '文件大小超过文件大小限制指定由文件上传信息。';
$phpMussel['Config']['lang']['upload_error_34'] = '上传失败！请联系网站管理员或网站托管服务！';
$phpMussel['Config']['lang']['upload_error_6'] = '上传文件夹是失踪！请联系网站管理员或网站托管服务！';
$phpMussel['Config']['lang']['upload_error_7'] = '硬盘写入错误！请联系网站管理员或网站托管服务！';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP配置错误是检测！请联系网站管理员或网站托管服务！';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = '超过上传限制';
$phpMussel['Config']['lang']['wrong_password'] = '密码错误；行动拒绝。';
$phpMussel['Config']['lang']['x_does_not_exist'] = '不存在';
$phpMussel['Config']['lang']['_exclamation'] = '！';
$phpMussel['Config']['lang']['_exclamation_final'] = '！';
$phpMussel['Config']['lang']['_fullstop'] = '。';
$phpMussel['Config']['lang']['_fullstop_final'] = '。';
