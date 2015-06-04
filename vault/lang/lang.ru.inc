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
 This File: phpMussel Russian/Русский Language Data (4th June 2015).
 <%phpMussel%/vault/lang/lang.ru.inc> **INCOMPLETE!!!**

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['cli_commands']=" q\n - Quit CLI.\n - Aliases: quit, exit.\n md5_file\n - Generate MD5 signatures from files [Syntax: md5_file filename].\n - Alias: m.\n md5\n - Generate MD5 signature from string [Syntax: md5 string].\n hex_encode\n - Convert binary string to hexadecimal [Syntax: hex_encode string].\n - Alias: x.\n hex_decode\n - Convert hexadecimal to binary string [Syntax: hex_decode string].\n base64_encode\n - Convert binary string to base64 string [Syntax: base64_encode string].\n - Alias: b.\n base64_decode\n - Convert base64 string to binary string [Syntax: base64_decode string].\n scan\n - Scan file or directory [Syntax: scan filename].\n - Alias: s.\n update\n - Update phpMussel.\n - Alias: u.\n c\n - Print this command list.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Failed to complete scanning process';
$MusselConfig['lang']['cli_is_not_a']=' is not a file or directory.';
$MusselConfig['lang']['cli_ln2']=" Спасибо за использование phpMussel, PHP сценария предназначен с целью\n обнаружения трояны, вирусы, вредоносные программы и других угрозы в файлы\n загружены к вашей системе wherever the script is hooked, based on the signatures of ClamAV and others.\n\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Currently running phpMussel in CLI mode (Command line interface).\n\n To scan a file or directory, type 'scan', followed by the name of the file or\n directory that you want phpMussel to scan and press Enter; Type 'c' and press\n Enter for a list of CLI mode commands; Type 'q' and press Enter to quit:";
$MusselConfig['lang']['cli_update_restart']=' Restarting phpMussel may be required before updates become apparent.';
$MusselConfig['lang']['cli_working']='В действии';
$MusselConfig['lang']['corrupted']='Обнаружено поврежден PE';
$MusselConfig['lang']['denied']='Загрузить Отказано!';
$MusselConfig['lang']['denied_other']='Upload Denied! Télécharger Refusé! Carga Negado! Carica Negato! Upload verweigert! アップロード拒否されました! 上载是否认! 上載是否認! Uppladda Nekas! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Your upload was blocked for the reasons listed below / 你的上传被拒绝由于这些原因:';
$MusselConfig['lang']['detected']='Обнаружено {vn}';
$MusselConfig['lang']['detected_control_characters']='Обнаружено Управления Символов';
$MusselConfig['lang']['failed_to_access']='Failed to access ';
$MusselConfig['lang']['file']='Файл';
$MusselConfig['lang']['filesize_limit_exceeded']='Filesize limit exceeded';
$MusselConfig['lang']['filetype_blacklisted']='Filetype blacklisted';
$MusselConfig['lang']['finished']='Завершен';
$MusselConfig['lang']['generated_by']='Генерируется';
$MusselConfig['lang']['greylist_cleared']=' Greylist cleared.';
$MusselConfig['lang']['greylist_updated']=' Greylist updated.';
$MusselConfig['lang']['image']='изображение';
$MusselConfig['lang']['invalid_file']='Invalid file';
$MusselConfig['lang']['ok']='Хорошо';
$MusselConfig['lang']['only_allow_images']='Загрузить не-изображений файлы не допускается';
$MusselConfig['lang']['recursive']='Recursion depth limit exceeded';
$MusselConfig['lang']['refer_to_scan_kills']=' (refer to '.$MusselConfig['general']['scan_kills'].' for details)';
$MusselConfig['lang']['scan_aborted']='Scanning aborted';
$MusselConfig['lang']['scan_chameleon']='Обнаружены {x} хамелеон атака';
$MusselConfig['lang']['scan_checking']='Checking';
$MusselConfig['lang']['scan_checking_contents']='Success! Proceeding to check contents.';
$MusselConfig['lang']['scan_command_injection']='Command injection attempt detected';
$MusselConfig['lang']['scan_complete']='Complete';
$MusselConfig['lang']['scan_extensions_missing']='Failed (missing required extensions)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Filename manipulation detected';
$MusselConfig['lang']['scan_map_corrupted']='Signature map corrupted';
$MusselConfig['lang']['scan_map_missing']='Signature map missing';
$MusselConfig['lang']['scan_missing_filename']='Missing filename';
$MusselConfig['lang']['scan_not_archive']='Failed (empty or not an archive)!';
$MusselConfig['lang']['scan_no_problems_found']='Нет проблемы найден.';
$MusselConfig['lang']['scan_reading']='Reading';
$MusselConfig['lang']['scan_signature_file_corrupted']='Signature file corrupted';
$MusselConfig['lang']['scan_signature_file_missing']='Signature file missing';
$MusselConfig['lang']['scan_unauthorised_upload']='Unauthorised file upload manipulation detected';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Unauthorised file upload manipulation or misconfiguration detected! ';
$MusselConfig['lang']['started']='Начал';
$MusselConfig['lang']['update_']='phpMussel will now attempt to update itself.';
$MusselConfig['lang']['update_available']='Обновление сценария доступный.';
$MusselConfig['lang']['update_complete']='Проверить обновления успешно завершена.';
$MusselConfig['lang']['update_created']='создан';
$MusselConfig['lang']['update_deleted']='удален';
$MusselConfig['lang']['update_err1']='Failed to update: \'update.dat\' missing. Reinstall or update manually.';
$MusselConfig['lang']['update_err2']='Failed to update: \'update.dat\' does not contain any valid update sources. Please update manually.';
$MusselConfig['lang']['update_err3']='Possible hack or forgery detected in the update instructions supplied by the update source; Source may possibly be compromised. Please notify the script author. Updating manually is recommended.';
$MusselConfig['lang']['update_err4']='Отсутствует хэш!';
$MusselConfig['lang']['update_err5']='Отсутствует данные!';
$MusselConfig['lang']['update_err6']='Неправильный данные!';
$MusselConfig['lang']['update_err7']='Неправильный хеш!';
$MusselConfig['lang']['update_failed']='Безуспешными.';
$MusselConfig['lang']['update_fetch']='Попытка получить версия данные от';
$MusselConfig['lang']['update_not']='НЕ {x}';
$MusselConfig['lang']['update_not_available']='Нет обновление сценария доступный в это время.';
$MusselConfig['lang']['update_not_possible']='Обновление сценария доступный, но оно не может быть полностью обновлен с данной версией сценария обновления. Пожалуйста обновление вручную.';
$MusselConfig['lang']['update_no_source']='phpMussel не удалось обновить себя потому что он не может подключиться к действительной обновлений источника. Обновление вручную рекомендуется.';
$MusselConfig['lang']['update_patched']='исправлена';
$MusselConfig['lang']['update_scriptfile_missing']=' Обновление сценария файла не найден! Пожалуйста переустановите phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' секунд прошло';
$MusselConfig['lang']['update_signatures_available']='Подписей обновление доступный.';
$MusselConfig['lang']['update_signatures_latest']='ПОСЛЕДНИЕ ПОДПИСИ';
$MusselConfig['lang']['update_signatures_not_available']='Нет подписи обновление доступный в это время.';
$MusselConfig['lang']['update_signatures_yours']='ВАШИ ПОДПИСИ';
$MusselConfig['lang']['update_success']='Успешно.';
$MusselConfig['lang']['update_successfully']=' успешно';
$MusselConfig['lang']['update_version_latest']='ПОСЛЕДНЕЕ СЦЕНАРИЯ ВЕРСИЯ';
$MusselConfig['lang']['update_version_yours']='ВАША СЦЕНАРИЯ ВЕРСИЯ';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='подписи';
$MusselConfig['lang']['upload_error_1']='Размер файла директиву MAX_FILE_СИЦЕ превышает. ';
$MusselConfig['lang']['upload_error_2']='Размер файла директиву Форма-заданных размер файла лимит. ';
$MusselConfig['lang']['upload_error_34']='Загрузить отказ! Пожалуйста свяжитесь с хостмастеру о помощи! ';
$MusselConfig['lang']['upload_error_6']='Загрузить директорий отсутствует! Пожалуйста свяжитесь с хостмастеру о помощи! ';
$MusselConfig['lang']['upload_error_7']='Диск-записи ошибка! Пожалуйста свяжитесь с хостмастеру о помощи! ';
$MusselConfig['lang']['upload_error_8']='PHP расконфигурация обнаружено! Пожалуйста свяжитесь с хостмастеру о помощи! ';
$MusselConfig['lang']['upload_limit_exceeded']='Загрузить превышен лимит';
$MusselConfig['lang']['wrong_password']='Неправильный пароль; Действие отказано.';
$MusselConfig['lang']['x_does_not_exist']='не существует';

?>