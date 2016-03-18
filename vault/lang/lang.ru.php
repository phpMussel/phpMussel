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
 * This file: Russian language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'Извините, команда непонятна.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Прекратить CLI.\n - Псевдонимы: quit, exit.\n md5_file\n - Создание MD5 подписи от файлы [Синтаксис: md5_file имя-файла].\n - Псевдоним: m.\n md5\n - Создание MD5 подпись от данные [Синтаксис: md5 данные].\n hex_encode\n - Преобразует двоичные данные из шестнадцатеричной [Синтаксис: hex_encode\n   данные].\n - Псевдоним: x.\n hex_decode\n - Преобразует шестнадцатеричные из двоичных данных [Синтаксис: hex_decode\n   данные].\n base64_encode\n - Преобразует двоичные данные из base64 данных [Синтаксис: base64_encode\n   данные].\n - Псевдоним: b.\n base64_decode\n - Преобразует base64 данные из двоичных данных [Синтаксис: base64_decode\n   данные].\n scan\n - Сканирует файл или каталог [Синтаксис: scan имя].\n - Псевдоним: s.\n update\n - Обновление phpMussel.\n - Псевдоним: u.\n c\n - Распечатать этот командный список.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'Не удалось завершить процесс сканирования';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' не файл или каталог.';
$phpMussel['Config']['lang']['cli_ln2'] = " Спасибо за использование phpMussel, PHP сценария предназначенного для обнаружения троянов, вирусов, вредоносных программ и других угроз для файлов загруженных в вашу систему, на основе подписей ClamAV и\n других.\n\n PHPMUSSEL АВТОРСКИЕ ПРАВА 2013 и позже GNU/GPLv2 от Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " В настоящее время phpMussel работает в CLI режиме (командной строки интерфейс).\n\n Для сканирования файла или каталога, введите 'scan', а затем имя файла или\n каталога который вы хотите просканировать, и нажмите Enter; Введите 'c' и нажмите\n Enter для списка CLI режима команды; Введите 'q' и нажмите Enter для\n окончания:";
$phpMussel['Config']['lang']['cli_pe1'] = 'Не ПЭ Файл!';
$phpMussel['Config']['lang']['cli_pe2'] = 'ПЭ Разделы:';
$phpMussel['Config']['lang']['cli_update_restart'] = ' Прежде чем обновления станут очевидно требуется перезапуск phpMussel.';
$phpMussel['Config']['lang']['cli_working'] = 'В действии';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel контроль блокировки активен.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Файл основного сценария отсутствует! Пожалуйста инсталлируете phpMussel заново.';
$phpMussel['Config']['lang']['corrupted'] = 'Обнаружена поврежденная ПЭ';
$phpMussel['Config']['lang']['denied'] = 'Загрузка Отказана!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'Ваша загрузка была заблокирована по причинам перечисленным ниже / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Обнаружено {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Обнаружены символы управления';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Обнаружен зашифрованный архив; Зашифрованные архивы не допускаются';
$phpMussel['Config']['lang']['failed_to_access'] = 'Не удалось получить доступ ';
$phpMussel['Config']['lang']['file'] = 'файл';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Размер файла превышает лимит';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Тип файла находится в черном списке';
$phpMussel['Config']['lang']['finished'] = 'Готово';
$phpMussel['Config']['lang']['generated_by'] = 'Генерируется';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Серый список очищен.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Серый список не обновлён.';
$phpMussel['Config']['lang']['greylist_updated'] = ' Серый список обновлён.';
$phpMussel['Config']['lang']['image'] = 'Изображение';
$phpMussel['Config']['lang']['instance_already_active'] = 'Пример уже активен! Пожалуйста перепроверьте свои крючки.';
$phpMussel['Config']['lang']['invalid_file'] = 'Неверный файл';
$phpMussel['Config']['lang']['invalid_url'] = 'Неверный URL!';
$phpMussel['Config']['lang']['ok'] = 'Хорошо';
$phpMussel['Config']['lang']['only_allow_images'] = 'Загрузка файлов, которые не являются изображением, не допускается';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel неактивен.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel уже неактивен.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel активен.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel уже активен.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Каталог плагины не существует!';
$phpMussel['Config']['lang']['recursive'] = 'Лимит глубины рекурсии превышена';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Обязательные переменные не установлены: Продолжение невозможно.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Сканирование прерывается!';
$phpMussel['Config']['lang']['scan_chameleon'] = 'Обнаружена {x} хамелеон-атака';
$phpMussel['Config']['lang']['scan_checking'] = 'Проверить';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Сделано! Исходная проверка содержимого.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'Обнаружена попытка командной инъекции';
$phpMussel['Config']['lang']['scan_complete'] = 'Завершено';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Не удалось (отсутствуют необходимые расширения)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Обнаружена манипуляция имени файла';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Повреждена подпись карты';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Отсутствует подпись карты';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Отсутствует имя файла';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Не удалось (пуст или не архив)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'Проблемы не найдены.';
$phpMussel['Config']['lang']['scan_reading'] = 'Чтение';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Повреждена подпись файла';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Отсутствует подпись файла';
$phpMussel['Config']['lang']['scan_tampering'] = 'Обнаружена потенциально опасная модификация файла';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'Обнаружены несанкционированные загрузки манипуляции файла';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'Обнаружены несанкционированное загрузки манипуляции файла или неправильная конфигурация! ';
$phpMussel['Config']['lang']['started'] = 'Начало работы';
$phpMussel['Config']['lang']['too_many_urls'] = 'Слишком много URL';
$phpMussel['Config']['lang']['update_'] = 'phpMussel теперь попытается себя обновить.';
$phpMussel['Config']['lang']['update_available'] = 'Обновление сценария доступно.';
$phpMussel['Config']['lang']['update_complete'] = 'Проверка обновления успешно завершена.';
$phpMussel['Config']['lang']['update_created'] = 'создан';
$phpMussel['Config']['lang']['update_deleted'] = 'удален';
$phpMussel['Config']['lang']['update_err1'] = 'Не удалось обновить: Отсутствует \'update.dat\'! Инсталлируете снова или обновите вручную.';
$phpMussel['Config']['lang']['update_err2'] = 'Не удалось обновить: \'update.dat\' не содержит действующих обновлений источника. Пожалуйста обновите вручную.';
$phpMussel['Config']['lang']['update_err3'] = 'Потенциальный хак или подделка обнаружены в инструкции по обновлению; Источник возможно скомпрометирован. Пожалуйста, сообщите автору сценария. Обновление вручную рекомендуется.';
$phpMussel['Config']['lang']['update_err4'] = 'Отсутствует кэш!';
$phpMussel['Config']['lang']['update_err5'] = 'Отсутствуют данные!';
$phpMussel['Config']['lang']['update_err6'] = 'Неправильные данные!';
$phpMussel['Config']['lang']['update_err7'] = 'Неправильный кзш!';
$phpMussel['Config']['lang']['update_failed'] = 'Безуспешно.';
$phpMussel['Config']['lang']['update_fetch'] = 'Попытка получить версию данных от {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Обнаружено обновление блокировки: Продолжение невозможно. Проверьте на повреждение обновлений или повторите попытку позже.';
$phpMussel['Config']['lang']['update_not'] = 'НЕТ {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'В это время доступных обновлений сценария нет.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Обновление сценария доступно, но оно не может быть полностью обновлено с данной версией сценария обновления. Пожалуйста обновление вручную.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel не удалось обновить себя потому что он не может подключиться к действующему обновлению источника. Обновление вручную рекомендуется.';
$phpMussel['Config']['lang']['update_patched'] = 'исправлена';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Обновление сценарного файла не найдено! Пожалуйста переустановите phpMussel.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' секунд прошло';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Обновление подписей доступно.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'ПОСЛЕДНИЕ ПОДПИСИ';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'Доступных подписей обновления в это время нет.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'ВАШИ ПОДПИСИ';
$phpMussel['Config']['lang']['update_success'] = 'Успешно.';
$phpMussel['Config']['lang']['update_successfully'] = ' успешно';
$phpMussel['Config']['lang']['update_version_latest'] = 'ПОСЛЕДНЯЯ ВЕРСИЯ СЦЕНАРИЯ';
$phpMussel['Config']['lang']['update_version_yours'] = 'ВАША ВЕРСИЯ СЦЕНАРИЯ';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'подписи';
$phpMussel['Config']['lang']['upload_error_1'] = 'Файл превышает размер директивы upload_max_filesize. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Файл превышает размер заданных в директиве формы. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Загрузка Отказана! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Загрузка директорий отсутствует! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Ошибка диск-записи! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP реконфигурация обнаружена! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Лимит загрузки превышен';
$phpMussel['Config']['lang']['wrong_password'] = 'Неправильный пароль; Действие отказано.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'не существует';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
