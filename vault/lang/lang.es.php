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
 * This file: Spanish language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'No entiendo ese comando, lo siento.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Dejar CLI.\n - Alias: quit, exit.\n md5_file\n - Generar MD5 firmas de archivos [Sintaxis: md5_file nombre_de_archivo].\n - Alias: m.\n md5\n - Generar MD5 firma de string [Sintaxis: md5 string].\n hex_encode\n - Convertir binaria string a hexadecimal [Sintaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadecimal a binaria string [Sintaxis: hex_decode string].\n base64_encode\n - Convertir binaria string a base64 string [Sintaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string a binaria string [Sintaxis: base64_decode string].\n scan\n - Analizar archivo o directorio [Sintaxis: scan nombre_de_archivo].\n - Alias: s.\n update\n - Actualizar phpMussel.\n - Alias: u.\n c\n - Imprimir esta lista de comandos.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'No se pudo completar el proceso de escaneo';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' no es un archivo o directorio.';
$phpMussel['Config']['lang']['cli_ln2'] = " Gracias por usar phpMussel, un PHP script diseñado para detectar troyanos,\n virus, malware y otras amenazas en los archivos subidos en el sistema donde el\n script está adjunto, basado en las firmas de ClamAV y otros.\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " Corrientemente phpMussel en ejecución en modo CLI (comandos línea interfaz).\n\n Para analizar un archivo o directorio, escribir 'scan', seguido por el nombre\n del archivo o directorio que usted desea phpMussel para escanear y pulse Enter;\n Escribir 'c' y pulse Enter para obtener una lista de CLI modo comandos;\n Escribir 'q' y pulse Enter para salir:";
$phpMussel['Config']['lang']['cli_pe1'] = 'No es un válido PE archivo!';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE Secciones:';
$phpMussel['Config']['lang']['cli_update_restart'] = " Reinicio phpMussel puede ser requerido antes de las actualizaciones se hacen\n evidentes.";
$phpMussel['Config']['lang']['cli_working'] = 'En operación';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel controles bloqueos habilitadas.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Núcleo script archivo está ausente! Por favor, reinstalar phpMussel.';
$phpMussel['Config']['lang']['corrupted'] = 'Detectado corrompido PE';
$phpMussel['Config']['lang']['denied'] = 'Carga Negado!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Upload verweigert! Upload Geweigerd! Caricamento Negato! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'Intento de subida ha sido bloqueada por las razones que se indican a continuación / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Detectado {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Caracteres de control detectados';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Detectado archivo encriptado; Archivos encriptados no permitidos';
$phpMussel['Config']['lang']['failed_to_access'] = 'No se pudo acceso ';
$phpMussel['Config']['lang']['file'] = 'Archivo';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Excede el límite del archivo tamaño';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Tipo de archivo en la lista negra';
$phpMussel['Config']['lang']['finished'] = 'Terminado';
$phpMussel['Config']['lang']['generated_by'] = 'Generado por';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Greylist vaciado.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Greylist no actualizado.';
$phpMussel['Config']['lang']['greylist_updated'] = ' Greylist actualizado.';
$phpMussel['Config']['lang']['image'] = 'Imagen';
$phpMussel['Config']['lang']['instance_already_active'] = 'Instancia ya está activo! Por favor, compruebe sus ganchos.';
$phpMussel['Config']['lang']['invalid_file'] = 'Archivo no válido';
$phpMussel['Config']['lang']['invalid_url'] = 'URL no válido!';
$phpMussel['Config']['lang']['ok'] = 'OK';
$phpMussel['Config']['lang']['only_allow_images'] = 'Subir de archivos que no son imágenes no está permitido';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel desactivado.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel ya está desactivado.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel activado.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel ya está activado.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Directorio de plugins no existe!';
$phpMussel['Config']['lang']['recursive'] = 'Recursión profundidad límite excedido';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Variables requeridas no están definidos: No puede continuar.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Escaneo abortado!';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x} camaleón ataque detectado';
$phpMussel['Config']['lang']['scan_checking'] = 'Comprobando';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Éxito! Procediendo a comprobando las contenidos.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'Comandos inyección intento detectado';
$phpMussel['Config']['lang']['scan_complete'] = 'Completo';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Fracasado (desaparecido requeridos extensiones)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Manipulación del fichero nombre detectado';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Firma mapa corrompido';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Firma mapa desaparecido';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Nombre del archivo está ausente';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Fracasado (vacío o no es un archivo)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'No problemas encontrado.';
$phpMussel['Config']['lang']['scan_reading'] = 'Leyendo';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Firma archivo corrompido';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Firma archivo desaparecido';
$phpMussel['Config']['lang']['scan_tampering'] = 'Detectado potencialmente peligrosa archivo manipulación';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'No autorizado archivos manipulación detectado';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'No autorizado archivos manipulación o malo configuración detectado! ';
$phpMussel['Config']['lang']['started'] = 'Iniciado';
$phpMussel['Config']['lang']['too_many_urls'] = 'Demasiados URLs';
$phpMussel['Config']['lang']['update_'] = 'phpMussel ahora intentará actualización.';
$phpMussel['Config']['lang']['update_available'] = 'Una script actualización está disponible.';
$phpMussel['Config']['lang']['update_complete'] = 'Actualización verificación completada con éxito.';
$phpMussel['Config']['lang']['update_created'] = 'creado';
$phpMussel['Config']['lang']['update_deleted'] = 'borrado';
$phpMussel['Config']['lang']['update_err1'] = 'No actualizado: \'update.dat\' ausenta. Reinstalar o actualizar manualmente.';
$phpMussel['Config']['lang']['update_err2'] = 'No actualizado: \'update.dat\' no contiene cualquier válido fuente de actualización. Por favor, actualizar manualmente.';
$phpMussel['Config']['lang']['update_err3'] = 'Posible hackeo o falsificación detectada en las actualización instrucciones suministrados por la actualización fuente; Fuente ser posible comprometida. Por favor, notifique al autor de la script. Se recomienda actualizar manualmente.';
$phpMussel['Config']['lang']['update_err4'] = 'Checksum ausentas!';
$phpMussel['Config']['lang']['update_err5'] = 'Datos ausentas!';
$phpMussel['Config']['lang']['update_err6'] = 'Datos malos!';
$phpMussel['Config']['lang']['update_err7'] = 'Checksum malos!';
$phpMussel['Config']['lang']['update_failed'] = 'Fracasado.';
$phpMussel['Config']['lang']['update_fetch'] = 'Intentar para obtener la versión datos de {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Actualización bloqueo detectado: No puede continuar. Buscar para actualizaciones corruptas o inténtelo de nuevo más tarde.';
$phpMussel['Config']['lang']['update_not'] = 'NO {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'No script actualización está disponible en este momento.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Una script actualización está disponible, pero no puede ser completamente actualizada con esta versión de la script de actualización. Por favor, actualizar manualmente.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel ha fracasado de actualización porque no se pudo conectar a una válido actualización fuente. Se recomienda actualizar manualmente.';
$phpMussel['Config']['lang']['update_patched'] = 'parcheado';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Actualización script archivo faltan! Por favor, reinstalar phpMussel.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' segundos transcurridos';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Una actualización de firmas está disponible.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'ÚLTIMAS FIRMAS';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'No actualización de firmas está disponible en este momento.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'SUS FIRMAS';
$phpMussel['Config']['lang']['update_success'] = 'Éxito.';
$phpMussel['Config']['lang']['update_successfully'] = ' con éxito';
$phpMussel['Config']['lang']['update_version_latest'] = 'ÚLTIMA SCRIPT VERSIÓN';
$phpMussel['Config']['lang']['update_version_yours'] = 'SU SCRIPT VERSIÓN';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'firmas';
$phpMussel['Config']['lang']['upload_error_1'] = 'Fichero tamaño excede la directiva upload_max_filesize. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Fichero tamaño excede la forma especificada fichero tamaño límite. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Subir fracaso! Contacto el hostmaster para ayuda! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Subir directorio desaparecido! Contacto el hostmaster para ayuda! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Error en el disco contra escritura! Contacto el hostmaster para ayuda! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP mala configuración detectado! Contacto el hostmaster para ayuda! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Subir límite excedido';
$phpMussel['Config']['lang']['wrong_password'] = 'Contraseña incorrecta; Acción negada.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'no existe';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
