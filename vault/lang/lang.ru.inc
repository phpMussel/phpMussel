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
 This File: phpMussel Russian/Русский Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.ru.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Извините, команда непонятна.';
$MusselConfig['lang']['cli_commands']=" q\n - Прекратить CLI.\n - Псевдонимы: quit, exit.\n md5_file\n - Создание MD5 подписи от файлы [Синтаксис: md5_file имя-файла].\n - Псевдоним: m.\n md5\n - Создание MD5 подпись от данные [Синтаксис: md5 данные].\n hex_encode\n - Преобразует двоичные данные из шестнадцатеричной [Синтаксис: hex_encode\n   данные].\n - Псевдоним: x.\n hex_decode\n - Преобразует шестнадцатеричные из двоичных данных [Синтаксис: hex_decode\n   данные].\n base64_encode\n - Преобразует двоичные данные из base64 данных [Синтаксис: base64_encode\n   данные].\n - Псевдоним: b.\n base64_decode\n - Преобразует base64 данные из двоичных данных [Синтаксис: base64_decode\n   данные].\n scan\n - Сканирует файл или каталог [Синтаксис: scan имя].\n - Псевдоним: s.\n update\n - Обновление phpMussel.\n - Псевдоним: u.\n c\n - Распечатать этот командный список.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Не удалось завершить процесс сканирования';
$MusselConfig['lang']['cli_is_not_a']=' не файл или каталог.';
$MusselConfig['lang']['cli_ln2']=" Спасибо за использование phpMussel, PHP сценария предназначенного для обнаружения троянов, вирусов, вредоносных программ и других угроз для файлов загруженных в вашу систему, на основе подписей ClamAV и\n других.\n\n PHPMUSSEL АВТОРСКИЕ ПРАВА 2013 и позже GNU/GPLv2 от Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" В настоящее время phpMussel работает в CLI режиме (командной строки интерфейс).\n\n Для сканирования файла или каталога, введите 'scan', а затем имя файла или\n каталога который вы хотите просканировать, и нажмите Enter; Введите 'c' и нажмите\n Enter для списка CLI режима команды; Введите 'q' и нажмите Enter для\n окончания:";
$MusselConfig['lang']['cli_pe1']='Не ПЭ Файл!';
$MusselConfig['lang']['cli_pe2']='ПЭ Разделы:';
$MusselConfig['lang']['cli_update_restart']=' Прежде чем обновления станут очевидно требуется перезапуск phpMussel.';
$MusselConfig['lang']['cli_working']='В действии';
$MusselConfig['lang']['controls_lockout']='phpMussel контроль блокировки активен.';
$MusselConfig['lang']['core_scriptfile_missing']='Файл основного сценария отсутствует! Пожалуйста инсталлируете phpMussel заново.';
$MusselConfig['lang']['corrupted']='Обнаружена поврежденная ПЭ';
$MusselConfig['lang']['denied']='Загрузка Отказана!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Ваша загрузка была заблокирована по причинам перечисленным ниже / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Обнаружено {vn}';
$MusselConfig['lang']['detected_control_characters']='Обнаружены символы управления';
$MusselConfig['lang']['encrypted_archive']='Обнаружен зашифрованный архив; Зашифрованные архивы не допускаются';
$MusselConfig['lang']['failed_to_access']='Не удалось получить доступ ';
$MusselConfig['lang']['file']='файл';
$MusselConfig['lang']['filesize_limit_exceeded']='Размер файла превышает лимит';
$MusselConfig['lang']['filetype_blacklisted']='Тип файла находится в черном списке';
$MusselConfig['lang']['finished']='Готово';
$MusselConfig['lang']['generated_by']='Генерируется';
$MusselConfig['lang']['greylist_cleared']=' Серый список очищен.';
$MusselConfig['lang']['greylist_not_updated']=' Серый список не обновлён.';
$MusselConfig['lang']['greylist_updated']=' Серый список обновлён.';
$MusselConfig['lang']['image']='изображение';
$MusselConfig['lang']['instance_already_active']='Пример уже активен! Пожалуйста перепроверьте свои крючки.';
$MusselConfig['lang']['invalid_file']='Неверный файл';
$MusselConfig['lang']['ok']='Хорошо';
$MusselConfig['lang']['only_allow_images']='Загрузка файлов, которые не являются изображением, не допускается';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel неактивен.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel уже неактивен.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel активен.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel уже активен.';
$MusselConfig['lang']['recursive']='Лимит глубины рекурсии превышена';
$MusselConfig['lang']['refer_to_scan_kills']=' (сослаться на '.$MusselConfig['general']['scan_kills'].' для деталей)';
$MusselConfig['lang']['required_variables_not_defined']='Обязательные переменные не установлены: Продолжение невозможно.';
$MusselConfig['lang']['scan_aborted']='Сканирование прерывается';
$MusselConfig['lang']['scan_chameleon']='Обнаружена {x} хамелеон-атака';
$MusselConfig['lang']['scan_checking']='Проверить';
$MusselConfig['lang']['scan_checking_contents']='Сделано! Исходная проверка содержимого.';
$MusselConfig['lang']['scan_command_injection']='Обнаружена попытка командной инъекции';
$MusselConfig['lang']['scan_complete']='Завершено';
$MusselConfig['lang']['scan_extensions_missing']='Не удалось (отсутствуют необходимые расширения)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Обнаружена манипуляция имени файла';
$MusselConfig['lang']['scan_map_corrupted']='Повреждена подпись карты';
$MusselConfig['lang']['scan_map_missing']='Отсутствует подпись карты';
$MusselConfig['lang']['scan_missing_filename']='Отсутствует имя файла';
$MusselConfig['lang']['scan_not_archive']='Не удалось (пуст или не архив)!';
$MusselConfig['lang']['scan_no_problems_found']='Проблемы не найдены.';
$MusselConfig['lang']['scan_reading']='Чтение';
$MusselConfig['lang']['scan_signature_file_corrupted']='Повреждена подпись файла';
$MusselConfig['lang']['scan_signature_file_missing']='Отсутствует подпись файла';
$MusselConfig['lang']['scan_tampering']='Обнаружена потенциально опасная модификация файла';
$MusselConfig['lang']['scan_unauthorised_upload']='Обнаружены несанкционированные загрузки манипуляции файла';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Обнаружены несанкционированное загрузки манипуляции файла или неправильная конфигурация! '; 
$MusselConfig['lang']['started']='Начало работы';
$MusselConfig['lang']['update_']='phpMussel теперь попытается себя обновить.';
$MusselConfig['lang']['update_available']='Обновление сценария доступно.';
$MusselConfig['lang']['update_complete']='Проверка обновления успешно завершена.';
$MusselConfig['lang']['update_created']='создан';
$MusselConfig['lang']['update_deleted']='удален';
$MusselConfig['lang']['update_err1']='Не удалось обновить: Отсутствует \'update.dat\'! Инсталлируете снова или обновите вручную.';
$MusselConfig['lang']['update_err2']='Не удалось обновить: \'update.dat\' не содержит действующих обновлений источника. Пожалуйста обновите вручную.';
$MusselConfig['lang']['update_err3']='Потенциальный хак или подделка обнаружены в инструкции по обновлению; Источник возможно скомпрометирован. Пожалуйста, сообщите автору сценария. Обновление вручную рекомендуется.';
$MusselConfig['lang']['update_err4']='Отсутствует кэш!';
$MusselConfig['lang']['update_err5']='Отсутствуют данные!';
$MusselConfig['lang']['update_err6']='Неправильные данные!';
$MusselConfig['lang']['update_err7']='Неправильный кзш!';
$MusselConfig['lang']['update_failed']='Безуспешно.';
$MusselConfig['lang']['update_fetch']='Попытка получить версию данных от';
$MusselConfig['lang']['update_lock_detected']='Обнаружено обновление блокировки: Продолжение невозможно. Проверьте на повреждение обновлений или повторите попытку позже.';
$MusselConfig['lang']['update_not']='НЕТ {x}';
$MusselConfig['lang']['update_not_available']='В это время доступных обновлений сценария нет.';
$MusselConfig['lang']['update_not_possible']='Обновление сценария доступно, но оно не может быть полностью обновлено с данной версией сценария обновления. Пожалуйста обновление вручную.';
$MusselConfig['lang']['update_no_source']='phpMussel не удалось обновить себя потому что он не может подключиться к действующему обновлению источника. Обновление вручную рекомендуется.';
$MusselConfig['lang']['update_patched']='исправлена';
$MusselConfig['lang']['update_scriptfile_missing']=' Обновление сценарного файла не найдено! Пожалуйста переустановите phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' секунд прошло';
$MusselConfig['lang']['update_signatures_available']='Обновление подписей доступно.';
$MusselConfig['lang']['update_signatures_latest']='ПОСЛЕДНИЕ ПОДПИСИ';
$MusselConfig['lang']['update_signatures_not_available']='Доступных подписей обновления в это время нет.';
$MusselConfig['lang']['update_signatures_yours']='ВАШИ ПОДПИСИ';
$MusselConfig['lang']['update_success']='Успешно.';
$MusselConfig['lang']['update_successfully']=' успешно';
$MusselConfig['lang']['update_version_latest']='ПОСЛЕДНЯЯ ВЕРСИЯ СЦЕНАРИЯ';
$MusselConfig['lang']['update_version_yours']='ВАША ВЕРСИЯ СЦЕНАРИЯ';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='подписи';
$MusselConfig['lang']['upload_error_1']='Файл превышает размер директивы MAX_FILE_SIZE. ';
$MusselConfig['lang']['upload_error_2']='Файл превышает размер заданных в директиве ФОРМЫ. ';
$MusselConfig['lang']['upload_error_34']='Загрузка Отказана! Пожалуйста свяжитесь с хостмастером о помощи! ';
$MusselConfig['lang']['upload_error_6']='Загрузка директорий отсутствует! Пожалуйста свяжитесь с хостмастером о помощи! ';
$MusselConfig['lang']['upload_error_7']='Ошибка диск-записи! Пожалуйста свяжитесь с хостмастером о помощи! ';
$MusselConfig['lang']['upload_error_8']='PHP реконфигурация обнаружена! Пожалуйста свяжитесь с хостмастером о помощи! ';
$MusselConfig['lang']['upload_limit_exceeded']='Лимит загрузки превышен';
$MusselConfig['lang']['wrong_password']='Неправильный пароль; Действие отказано.';
$MusselConfig['lang']['x_does_not_exist']='не существует';

?>