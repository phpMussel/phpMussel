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
 * This file: Spanish language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'No entiendo ese comando, lo siento.';
$phpMussel['lang']['cli_failed_to_complete'] = 'No se pudo completar el proceso de escaneo';
$phpMussel['lang']['cli_is_not_a'] = ' no es un archivo o directorio.';
$phpMussel['lang']['cli_ln2'] = " Gracias por usar phpMussel, un script PHP diseñado para detectar troyanos,\n virus, malware y otras amenazas en los archivos subidos al sistema dónde el\n script está adjunto, basado en las firmas de ClamAV y otros.\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Ud. está ejecutando phpMussel en modo CLI (interfaz de línea de comandos).\n\n Para analizar un archivo o directorio, escribir 'scan', seguido por el nombre\n del archivo o directorio que usted desea que phpMussel escanee y pulse Enter;\n Escriba 'c' y pulse Enter para obtener una lista de comandos;\n Escriba 'q' y pulse Enter para salir:";
$phpMussel['lang']['cli_pe1'] = 'No es un archivo PE válido!';
$phpMussel['lang']['cli_pe2'] = 'Secciones PE:';
$phpMussel['lang']['cli_signature_placeholder'] = 'NOMBRE-DE-FIRMA';
$phpMussel['lang']['cli_working'] = 'En operación';
$phpMussel['lang']['corrupted'] = 'PE corrompido detectado';
$phpMussel['lang']['data_not_available'] = 'Informacion no disponible.';
$phpMussel['lang']['denied'] = 'Subida Denegada!';
$phpMussel['lang']['denied_reason'] = 'La subida de archivo fue bloqueada por las razones que se indican a continuación:';
$phpMussel['lang']['detected'] = 'Detectado {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Caracteres control detectados';
$phpMussel['lang']['encrypted_archive'] = 'Archivo encriptado detectado; No se permiten archivos encriptados';
$phpMussel['lang']['failed_to_access'] = 'Falló el acceso ';
$phpMussel['lang']['file'] = 'Archivo';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Excede el límite del archivo tamaño';
$phpMussel['lang']['filetype_blacklisted'] = 'Tipo de archivo en la lista negra';
$phpMussel['lang']['finished'] = 'Terminado';
$phpMussel['lang']['generated_by'] = 'Generado por';
$phpMussel['lang']['greylist_cleared'] = ' Greylist vaciado.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist no actualizado.';
$phpMussel['lang']['greylist_updated'] = ' Greylist actualizado.';
$phpMussel['lang']['image'] = 'Imagen';
$phpMussel['lang']['instance_already_active'] = 'Instancia ya está activo! Por favor, compruebe sus ganchos.';
$phpMussel['lang']['invalid_data'] = '¡Datos no válidos!';
$phpMussel['lang']['invalid_file'] = 'Archivo no válido';
$phpMussel['lang']['invalid_url'] = '¡URL no válido!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Subir de archivos que no son imágenes no está permitido';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Directorio de plugins no existe!';
$phpMussel['lang']['quarantined_as'] = "En cuarentena como \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursión profundidad límite excedido';
$phpMussel['lang']['required_variables_not_defined'] = 'Variables requeridas no están definidos: No puede continuar.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL potencialmente dañino detectado';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Error de solicitud de la API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Error de autorización de la API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Servicio de la API no está disponible';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Error da la API desconocido';
$phpMussel['lang']['scan_aborted'] = 'Escaneo abortado!';
$phpMussel['lang']['scan_chameleon'] = '{x} camaleón ataque detectado';
$phpMussel['lang']['scan_checking'] = 'Comprobando';
$phpMussel['lang']['scan_checking_contents'] = 'Éxito! Procediendo a comprobando las contenidos.';
$phpMussel['lang']['scan_command_injection'] = 'Comandos inyección intento detectado';
$phpMussel['lang']['scan_complete'] = 'Completo';
$phpMussel['lang']['scan_extensions_missing'] = 'Fracasado (desaparecido requeridos extensiones)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Manipulación del fichero nombre detectado';
$phpMussel['lang']['scan_missing_filename'] = 'Nombre del archivo está ausente';
$phpMussel['lang']['scan_not_archive'] = 'Fracasado (vacío o no es un archivo)!';
$phpMussel['lang']['scan_no_problems_found'] = 'No problemas encontrado.';
$phpMussel['lang']['scan_reading'] = 'Leyendo';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Firma archivo corrompido';
$phpMussel['lang']['scan_signature_file_missing'] = 'Firma archivo desaparecido';
$phpMussel['lang']['scan_tampering'] = 'Detectado potencialmente peligrosa archivo manipulación';
$phpMussel['lang']['scan_unauthorised_upload'] = 'No autorizado archivos manipulación detectado';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'No autorizado archivos manipulación o malo configuración detectado! ';
$phpMussel['lang']['started'] = 'Iniciado';
$phpMussel['lang']['too_many_urls'] = 'Demasiados URLs';
$phpMussel['lang']['upload_error_1'] = 'Fichero tamaño excede la directiva upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'Fichero tamaño excede la forma especificada fichero tamaño límite. ';
$phpMussel['lang']['upload_error_34'] = 'Subir fracaso! Contacto el hostmaster para ayuda! ';
$phpMussel['lang']['upload_error_6'] = 'Subir directorio desaparecido! Contacto el hostmaster para ayuda! ';
$phpMussel['lang']['upload_error_7'] = 'Error en el disco contra escritura! Contacto el hostmaster para ayuda! ';
$phpMussel['lang']['upload_error_8'] = 'PHP mala configuración detectado! Contacto el hostmaster para ayuda! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Subir límite excedido';
$phpMussel['lang']['wrong_password'] = 'Contraseña incorrecta; Acción negada.';
$phpMussel['lang']['x_does_not_exist'] = 'no existe';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Dejar CLI.
 - Alias: quit, exit.
 md5_file
 - Generar firmas MD5 de archivos [Sintaxis: md5_file archivo].
 - Alias: m.
 sha1_file
 - Generar firmas SHA1 de archivos [Sintaxis: sha1_file archivo].
 md5
 - Generar firma MD5 de string [Sintaxis: md5 string].
 sha1
 - Generar firma SHA1 de string [Sintaxis: sha1 string].
 hex_encode
 - Convertir string binaria a hexadecimal [Sintaxis: hex_encode string].
 - Alias: x.
 hex_decode
 - Convertir hexadecimal a string binaria [Sintaxis: hex_decode string].
 base64_encode
 - Convertir string binaria a string base64 [Sintaxis: base64_encode string].
 - Alias: b.
 base64_decode
 - Convertir string base64 a string binaria [Sintaxis: base64_decode string].
 pe_meta
 - Extraer metadatos de un archivo PE [Sintaxis: pe_meta archivo].
 url_sig
 - Generar firmas de escáner de URL [Sintaxis: url_sig string].
 scan
 - Analizar archivo o directorio [Sintaxis: scan archivo].
 - Alias: s.
 c
 - Imprimir esta lista de comandos.
";
