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
 * This file: Russian language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Language plurality rule. */
$phpMussel['Plural-Rule'] = function($Num) {
    if ($Num % 10 === 1 && $Num % 100 !== 11) {
        return 0;
    }
    return $Num % 10 >= 2 && $Num % 10 <= 4 && ($Num % 100 < 10 || $Num % 100 >= 20) ? 1 : 2;
};

$phpMussel['lang']['bad_command'] = 'Извините, команда непонятна.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Не удалось завершить процесс сканирования';
$phpMussel['lang']['cli_is_not_a'] = ' не файл или каталог.';
$phpMussel['lang']['cli_ln2'] = " Спасибо за использование phpMussel, PHP сценария предназначенного для\n обнаружения троянов, вирусов, вредоносных программ и других угроз для файлов\n загруженных в вашу систему, на основе подписей ClamAV и других.\n\n PHPMUSSEL АВТОРСКИЕ ПРАВА 2013 и позже GNU/GPLv2 от Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " В настоящее время phpMussel работает в CLI режиме (командной строки интерфейс).\n\n Для сканирования файла или каталога, введите 'scan', а затем имя файла или\n каталога который вы хотите просканировать, и нажмите Enter; Введите 'c' и\n нажмите Enter для списка CLI режима команды; Введите 'q' и нажмите Enter для\n окончания:";
$phpMussel['lang']['cli_pe1'] = 'Не ПЭ Файл!';
$phpMussel['lang']['cli_pe2'] = 'ПЭ Разделы:';
$phpMussel['lang']['cli_signature_placeholder'] = 'ВАШЕ-ИМЯ-СИГНАТУР';
$phpMussel['lang']['cli_working'] = 'В действии';
$phpMussel['lang']['corrupted'] = 'Обнаружена поврежденная ПЭ';
$phpMussel['lang']['data_not_available'] = 'Данные недоступны.';
$phpMussel['lang']['denied'] = 'Загрузка Отказана!';
$phpMussel['lang']['denied_reason'] = 'Ваша загрузка была заблокирована по причинам перечисленным ниже:';
$phpMussel['lang']['detected'] = 'Обнаружено {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Обнаружены символы управления';
$phpMussel['lang']['encrypted_archive'] = 'Обнаружен зашифрованный архив; Зашифрованные архивы не допускаются';
$phpMussel['lang']['failed_to_access'] = 'Не удалось получить доступ ';
$phpMussel['lang']['file'] = 'файл';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Размер файла превышает лимит';
$phpMussel['lang']['filetype_blacklisted'] = 'Тип файла находится в черном списке';
$phpMussel['lang']['finished'] = 'Готово';
$phpMussel['lang']['generated_by'] = 'Генерируется от';
$phpMussel['lang']['greylist_cleared'] = ' Серый список очищен.';
$phpMussel['lang']['greylist_not_updated'] = ' Серый список не обновлён.';
$phpMussel['lang']['greylist_updated'] = ' Серый список обновлён.';
$phpMussel['lang']['image'] = 'Изображение';
$phpMussel['lang']['instance_already_active'] = 'Пример уже активен! Пожалуйста перепроверьте свои крючки.';
$phpMussel['lang']['invalid_data'] = 'Неверные данные!';
$phpMussel['lang']['invalid_file'] = 'Неверный файл';
$phpMussel['lang']['invalid_url'] = 'Неверный URL!';
$phpMussel['lang']['ok'] = 'Хорошо';
$phpMussel['lang']['only_allow_images'] = 'Загрузка файлов, которые не являются изображением, не допускается';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Каталог плагины не существует!';
$phpMussel['lang']['quarantined_as'] = "Помещен на карантин в \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Лимит глубины рекурсии превышена';
$phpMussel['lang']['required_variables_not_defined'] = 'Обязательные переменные не установлены: Продолжение невозможно.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'Потенциально вредное URL обнаружено';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Ошибка запроса API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Ошибка авторизации API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Сервис недоступен API';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Неизвестная API ошибка';
$phpMussel['lang']['scan_aborted'] = 'Сканирование прерывается!';
$phpMussel['lang']['scan_chameleon'] = 'Обнаружена {x} хамелеон-атака';
$phpMussel['lang']['scan_checking'] = 'Проверить';
$phpMussel['lang']['scan_checking_contents'] = 'Сделано! Исходная проверка содержимого.';
$phpMussel['lang']['scan_command_injection'] = 'Обнаружена попытка командной инъекции';
$phpMussel['lang']['scan_complete'] = 'Завершено';
$phpMussel['lang']['scan_extensions_missing'] = 'Не удалось (отсутствуют необходимые расширения)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Обнаружена манипуляция имени файла';
$phpMussel['lang']['scan_missing_filename'] = 'Отсутствует имя файла';
$phpMussel['lang']['scan_not_archive'] = 'Не удалось (пуст или не архив)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Проблемы не найдены.';
$phpMussel['lang']['scan_reading'] = 'Чтение';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Повреждена подпись файла';
$phpMussel['lang']['scan_signature_file_missing'] = 'Отсутствует подпись файла';
$phpMussel['lang']['scan_tampering'] = 'Обнаружена потенциально опасная модификация файла';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Обнаружены несанкционированные загрузки манипуляции файла';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Обнаружены несанкционированное загрузки манипуляции файла или неправильная конфигурация! ';
$phpMussel['lang']['started'] = 'Начало работы';
$phpMussel['lang']['too_many_urls'] = 'Слишком много URL';
$phpMussel['lang']['upload_error_1'] = 'Файл превышает размер директивы upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'Файл превышает размер заданных в директиве формы. ';
$phpMussel['lang']['upload_error_34'] = 'Загрузка Отказана! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['lang']['upload_error_6'] = 'Загрузка директорий отсутствует! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['lang']['upload_error_7'] = 'Ошибка диск-записи! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['lang']['upload_error_8'] = 'PHP реконфигурация обнаружена! Пожалуйста свяжитесь с хостмастером о помощи! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Лимит загрузки превышен';
$phpMussel['lang']['wrong_password'] = 'Неправильный пароль; Действие отказано.';
$phpMussel['lang']['x_does_not_exist'] = 'не существует';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Прекратить CLI.
 - Псевдонимы: quit, exit.
 md5_file
 - Создание MD5 подписи от файлы [Синтаксис: md5_file имя-файла].
 - Псевдоним: m.
 sha1_file
 - Создание SHA1 подписи от файлы [Синтаксис: sha1_file имя-файла].
 md5
 - Создание MD5 подпись от данные [Синтаксис: md5 данные].
 sha1
 - Создание SHA1 подпись от данные [Синтаксис: sha1 данные].
 hex_encode
 - Преобразует двоичные данные из шестнадцатеричной
   [Синтаксис: hex_encode данные].
 - Псевдоним: x.
 hex_decode
 - Преобразует шестнадцатеричные из двоичных данных
   [Синтаксис: hex_decode данные].
 base64_encode
 - Преобразует двоичные данные из base64 данных
   [Синтаксис: base64_encode данные].
 - Псевдоним: b.
 base64_decode
 - Преобразует base64 данные из двоичных данных
   [Синтаксис: base64_decode данные].
 pe_meta
 - Извлечение метаданных из PE-файла [Синтаксис: pe_meta имя-файла].
 url_sig
 - Создание сигнатуры сканера URL [Синтаксис: url_sig данные].
 scan
 - Сканирует файл или каталог [Синтаксис: scan имя].
 - Псевдоним: s.
 c
 - Распечатать этот командный список.
";
