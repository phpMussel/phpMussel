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
 This File: phpMussel Russian/Русский Language Data (24th June 2015).
 <%phpMussel%/vault/lang/lang.ru.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['cli_commands']=" q\n - Прекратить CLI.\n - Псевдонимы: quit, exit.\n md5_file\n - Создание MD5 подписи от файлы [Синтаксис: md5_file имя-файла].\n - Псевдоним: m.\n md5\n - Создание MD5 подпись от данные [Синтаксис: md5 данные].\n hex_encode\n - Преобразование двоичный данные от шестнадцатеричной [Синтаксис: hex_encode\n   данные].\n - Псевдоним: x.\n hex_decode\n - Преобразование шестнадцатеричной от двоичный данные [Синтаксис: hex_decode\n   данные].\n base64_encode\n - Преобразование двоичный данные от base64 данные [Синтаксис: base64_encode\n   данные].\n - Псевдоним: b.\n base64_decode\n - Преобразование base64 данные от двоичный данные [Синтаксис: base64_decode\n   данные].\n scan\n - Сканирование файла или каталога [Синтаксис: scan имя].\n - Псевдоним: s.\n update\n - Обновление phpMussel.\n - Псевдоним: u.\n c\n - Распечатать этот команды список.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Не удалось завершить процесс сканирования';
$MusselConfig['lang']['cli_is_not_a']=' не файл или каталог.';
$MusselConfig['lang']['cli_ln2']=" Спасибо за использование phpMussel, PHP сценария предназначен с целью\n обнаружения трояны, вирусы, вредоносные программы и других угрозы в файлы\n загружены к вашей системе где скрипт это включено, на основе подписи ClamAV и\n другие.\n\n PHPMUSSEL АВТОРСКИЕ ПРАВА 2013 и после этого GNU/GPLv2 от Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" В настоящее время phpMussel работает в CLI режиме (командной строки интерфейс).\n\n Для сканирования файла или каталога, введите 'scan', а затем имя файла или\n каталога который вы хотите сканирование, и нажмите Enter; Введите 'c' и нажмите\n Enter для списка CLI режиме команды; Введите 'q' и нажмите Enter для\n прекратить:";
$MusselConfig['lang']['cli_update_restart']=' Перезапуск из phpMussel может потребоваться прежде обновления становятся очевидными.';
$MusselConfig['lang']['cli_working']='В действии';
$MusselConfig['lang']['corrupted']='Обнаружено поврежден PE';
$MusselConfig['lang']['denied']='Загрузить Отказано!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento negato! Upload verweigert! アップロード拒否されました! 上载是否认! 上載是否認! Uppladda Nekas! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Ваше загружать был заблокирован по причинам перечисленным ниже / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Обнаружено {vn}';
$MusselConfig['lang']['detected_control_characters']='Обнаружено Управления Символов';
$MusselConfig['lang']['failed_to_access']='Не удалось получить доступ ';
$MusselConfig['lang']['file']='файл';
$MusselConfig['lang']['filesize_limit_exceeded']='Размер файла лимит превысил';
$MusselConfig['lang']['filetype_blacklisted']='Тип файла на черный список';
$MusselConfig['lang']['finished']='Завершено';
$MusselConfig['lang']['generated_by']='Генерируется';
$MusselConfig['lang']['greylist_cleared']=' Серого списка очищается.';
$MusselConfig['lang']['greylist_updated']=' Серого списка обновляется.';
$MusselConfig['lang']['image']='изображение';
$MusselConfig['lang']['invalid_file']='Неверный файл';
$MusselConfig['lang']['ok']='Хорошо';
$MusselConfig['lang']['only_allow_images']='Загрузить не-изображений файлы не допускается';
$MusselConfig['lang']['recursive']='Рекурсия лимит глубины превысил';
$MusselConfig['lang']['refer_to_scan_kills']=' (сослаться '.$MusselConfig['general']['scan_kills'].' для деталей)';
$MusselConfig['lang']['scan_aborted']='Сканирование прерывается';
$MusselConfig['lang']['scan_chameleon']='Обнаружены {x} хамелеон атака';
$MusselConfig['lang']['scan_checking']='Проверить';
$MusselConfig['lang']['scan_checking_contents']='Сделано! Исходя проверить содержимое.';
$MusselConfig['lang']['scan_command_injection']='Командования инъекции попытка обнаружено';
$MusselConfig['lang']['scan_complete']='Завершено';
$MusselConfig['lang']['scan_extensions_missing']='Не удалось (отсутствует необходимые расширения)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Имя файла манипуляции обнаружено';
$MusselConfig['lang']['scan_map_corrupted']='Поврежден подпись карте';
$MusselConfig['lang']['scan_map_missing']='Отсутствует подпись карте';
$MusselConfig['lang']['scan_missing_filename']='Отсутствует имя файла';
$MusselConfig['lang']['scan_not_archive']='Не удалось (пуст или не архив)!';
$MusselConfig['lang']['scan_no_problems_found']='Нет проблемы найден.';
$MusselConfig['lang']['scan_reading']='Чтение';
$MusselConfig['lang']['scan_signature_file_corrupted']='Поврежден подпись файла';
$MusselConfig['lang']['scan_signature_file_missing']='Отсутствует подпись файла';
$MusselConfig['lang']['scan_unauthorised_upload']='Несанкционированное файла загрузить манипуляции обнаружены';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Несанкционированное файла загрузить манипуляции или неправильная конфигурация обнаружены! ';
$MusselConfig['lang']['started']='Начал';
$MusselConfig['lang']['update_']='Теперь phpMussel будет пытаться обновить себя.';
$MusselConfig['lang']['update_available']='Обновление сценария доступный.';
$MusselConfig['lang']['update_complete']='Проверить обновления успешно завершено.';
$MusselConfig['lang']['update_created']='создан';
$MusselConfig['lang']['update_deleted']='удален';
$MusselConfig['lang']['update_err1']='Не удалось обновить: Отсутствует \'update.dat\'! Переустановите или обновление вручную.';
$MusselConfig['lang']['update_err2']='Не удалось обновить: \'update.dat\' не содержит действительных обновлений источника. Пожалуйста обновление вручную.';
$MusselConfig['lang']['update_err3']='Потенциал хака или подделка обнаружены в инструкции по обновлению поставляется с источника обновлений; Источник возможно нарушена. Пожалуйста, сообщите автору сценария. Обновление вручную рекомендуется.';
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
$MusselConfig['lang']['update_scriptfile_missing']=' Обновление сценария файл не найден! Пожалуйста переустановите phpMussel.';
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
$MusselConfig['lang']['upload_limit_exceeded']='Загрузить лимит превысил';
$MusselConfig['lang']['wrong_password']='Неправильный пароль; Действие отказано.';
$MusselConfig['lang']['x_does_not_exist']='не существует';

?>