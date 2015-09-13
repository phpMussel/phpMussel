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
 This File: phpMussel Chinese (Simplified) / 中文（简体） Language Data (9th September 2015).
 <%phpMussel%/vault/lang/lang.zh.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='我不明白的命令，对不起。';
$MusselConfig['lang']['cli_commands']=" q\n - 戒烟CLI模式。\n - 别名：quit，exit。\n md5_file\n - 生成MD5签名从文件[语法：md5_file 文件名]。\n - 别名：m.\n md5\n - 生成MD5签名从数据[语法：md5 数据]。\n hex_encode\n - 兑换从二进制数据至十六进制[语法：hex_encode 数据]。\n - 别名：x.\n hex_decode\n - 兑换从十六进制二进制数据至[语法：hex_decode 数据]。\n base64_encode\n - 兑换从二进制数据至基地64数据[语法：base64_encode 数据]。\n - 别名：b.\n base64_decode\n - 兑换从基地64数据至二进制数据[语法：base64_decode 数据]。\n scan\n - 扫描文件或文件夹[语法：scan 文件名]。\n - 别名：s。\n update\n - 更新phpMussel。\n - 别名：u。\n c\n - 打印此命令列表。\n";
$MusselConfig['lang']['cli_failed_to_complete']='完成扫描过程失败';
$MusselConfig['lang']['cli_is_not_a']='不是文件或文件夹。';
$MusselConfig['lang']['cli_ln2']="谢谢对于使用phpMussel，一个PHP脚本旨在检测木马，病毒，恶意软件，和其他威胁在文件上传到您的系统随地这个脚本是叫，根据ClamAV的签名和其他签名。\n\n PHPMUSSEL版权2013和此后GNU/GPLv.2通过Caleb M （Maikuolan）。\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" 目前经营phpMussel在CLI模式（命令行界面）。\n\n 扫描一个文件或文件夹，键入“scan”，其次是名的文件或文件夹您想phpMussel扫描然后按Enter键；\n 键入“c”然后按Enter键对于CLI模式命令名单；键入“q”然后按Enter键对于戒烟：";
$MusselConfig['lang']['cli_pe1']='不PE文件！';
$MusselConfig['lang']['cli_pe2']='PE部分:';
$MusselConfig['lang']['cli_update_restart']=' 重新启动phpMussel可能是需要之前的更新变得明显。';
$MusselConfig['lang']['cli_working']='进行中';
$MusselConfig['lang']['controls_lockout']='phpMussel控制闭锁是启用。';
$MusselConfig['lang']['core_scriptfile_missing']='核心文件是丢失！请重新安装phpMussel。';
$MusselConfig['lang']['corrupted']='检测损坏PE';
$MusselConfig['lang']['denied']='上传是否认！';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='您的上传被拒绝由于这些原因 / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='检测{vn}';
$MusselConfig['lang']['detected_control_characters']='检测控制字符';
$MusselConfig['lang']['encrypted_archive']='检测加密档案文件; 加密档案文件不允许';
$MusselConfig['lang']['failed_to_access']='无法访问';
$MusselConfig['lang']['file']='文件';
$MusselConfig['lang']['filesize_limit_exceeded']='文件大小超过限制';
$MusselConfig['lang']['filetype_blacklisted']='文件类型列入黑名单';
$MusselConfig['lang']['finished']='完了';
$MusselConfig['lang']['generated_by']='所产生通过';
$MusselConfig['lang']['greylist_cleared']=' 灰名单清空。';
$MusselConfig['lang']['greylist_not_updated']=' 灰名单不更新。';
$MusselConfig['lang']['greylist_updated']=' 灰名单更新。';
$MusselConfig['lang']['image']='图像';
$MusselConfig['lang']['instance_already_active']='脚本已激活！请仔细检查您的钩子。';
$MusselConfig['lang']['invalid_file']='无效文件';
$MusselConfig['lang']['ok']='好';
$MusselConfig['lang']['only_allow_images']='上传文件以外图片不允许';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel关闭。';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel已关闭。';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel激活。';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel已激活。';
$MusselConfig['lang']['recursive']='递归深度超过是限制';
$MusselConfig['lang']['refer_to_scan_kills']=' （参考'.$MusselConfig['general']['scan_kills'].'详细信息）';
$MusselConfig['lang']['required_variables_not_defined']='需要的变量是未定义：无法继续。';
$MusselConfig['lang']['scan_aborted']='扫描中止';
$MusselConfig['lang']['scan_chameleon']='{x}变色龙攻击检测';
$MusselConfig['lang']['scan_checking']='检查';
$MusselConfig['lang']['scan_checking_contents']='成功了！在进行检查的内容。';
$MusselConfig['lang']['scan_command_injection']='命令注入尝试检测';
$MusselConfig['lang']['scan_complete']='完成';
$MusselConfig['lang']['scan_extensions_missing']='失败（失踪必需的扩展）！';
$MusselConfig['lang']['scan_filename_manipulation_detected']='文件名操控检测';
$MusselConfig['lang']['scan_map_corrupted']='签名地图是损坏';
$MusselConfig['lang']['scan_map_missing']='签名地图是失踪';
$MusselConfig['lang']['scan_missing_filename']='文件名是失踪';
$MusselConfig['lang']['scan_not_archive']='失败（空或不是存档）！';
$MusselConfig['lang']['scan_no_problems_found']='没有任何问题发现。';
$MusselConfig['lang']['scan_reading']='阅读';
$MusselConfig['lang']['scan_signature_file_corrupted']='签名文件是损坏';
$MusselConfig['lang']['scan_signature_file_missing']='签名文件是失踪';
$MusselConfig['lang']['scan_tampering']='检测潜在的危险文件篡改';
$MusselConfig['lang']['scan_unauthorised_upload']='未经授权的文件上传操控是检测';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='未经授权的文件上传操控或配置错误是检测！';
$MusselConfig['lang']['started']='开始';
$MusselConfig['lang']['update_']='phpMussel现在将尝试进行自我更新。';
$MusselConfig['lang']['update_available']='编程更新可用。';
$MusselConfig['lang']['update_complete']='更新检查成功完成。';
$MusselConfig['lang']['update_created']='创建';
$MusselConfig['lang']['update_deleted']='删除';
$MusselConfig['lang']['update_err1']='更新失败：“update.dat”失踪。重新安装或手动更新。';
$MusselConfig['lang']['update_err2']='更新失败：“update.dat”不包含任何有效的更新源。请手动更新。';
$MusselConfig['lang']['update_err3']='潜力黑客或伪造品是检测在更新命令提供通过更新来源；源可能是妥协。请通知编程作者。手动更新是推荐。';
$MusselConfig['lang']['update_err4']='哈希码失踪！';
$MusselConfig['lang']['update_err5']='数据失踪！';
$MusselConfig['lang']['update_err6']='数据损坏！';
$MusselConfig['lang']['update_err7']='哈希码损坏！';
$MusselConfig['lang']['update_failed']='失败。';
$MusselConfig['lang']['update_fetch']='试图获取版本数据从';
$MusselConfig['lang']['update_lock_detected']='更新锁检测：无法继续。检查是否有损坏的更新或稍后再试。';
$MusselConfig['lang']['update_not']='不{x}';
$MusselConfig['lang']['update_not_available']='没有可用编程更新这个时。';
$MusselConfig['lang']['update_not_possible']='编程更新是可用的，但它不能完全更新使用此版本的更新编程。请手动更新。';
$MusselConfig['lang']['update_no_source']='phpMussel失败自我更新因为无法连接至有效的更新源。手动更新是推荐。';
$MusselConfig['lang']['update_patched']='修订';
$MusselConfig['lang']['update_scriptfile_missing']='更新编程文件是失踪！请重新安装phpMussel。';
$MusselConfig['lang']['update_seconds_elapsed']='秒过去';
$MusselConfig['lang']['update_signatures_available']='签名更新是可用的。';
$MusselConfig['lang']['update_signatures_latest']='最新签名';
$MusselConfig['lang']['update_signatures_not_available']='没有签名更新可用这个时。';
$MusselConfig['lang']['update_signatures_yours']='您的签名';
$MusselConfig['lang']['update_success']='成功了。';
$MusselConfig['lang']['update_successfully']='成功了';
$MusselConfig['lang']['update_version_latest']='最新编程版本';
$MusselConfig['lang']['update_version_yours']='您的编程版本';
$MusselConfig['lang']['update_was']='是{x}';
$MusselConfig['lang']['update_wrd1']='签名';
$MusselConfig['lang']['upload_error_1']='文件大小超过MAX_FILE_SIZE指令。';
$MusselConfig['lang']['upload_error_2']='文件大小超过文件大小限制指定由文件上传信息。';
$MusselConfig['lang']['upload_error_34']='上传失败！请联系网站管理员或网站托管服务！';
$MusselConfig['lang']['upload_error_6']='上传文件夹是失踪！请联系网站管理员或网站托管服务！';
$MusselConfig['lang']['upload_error_7']='硬盘写入错误！请联系网站管理员或网站托管服务！';
$MusselConfig['lang']['upload_error_8']='PHP配置错误是检测！请联系网站管理员或网站托管服务！';
$MusselConfig['lang']['upload_limit_exceeded']='超过上传限制';
$MusselConfig['lang']['wrong_password']='密码错误；行动拒绝。';
$MusselConfig['lang']['x_does_not_exist']='不存在';

?>