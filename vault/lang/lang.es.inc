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
 This File: phpMussel Spanish/Español Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.es.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='No entiendo ese comando, lo siento.';
$MusselConfig['lang']['cli_commands']=" q\n - Dejar CLI.\n - Alias: quit, exit.\n md5_file\n - Generar MD5 firmas de archivos [Sintaxis: md5_file nombre_de_archivo].\n - Alias: m.\n md5\n - Generar MD5 firma de string [Sintaxis: md5 string].\n hex_encode\n - Convertir binaria string a hexadecimal [Sintaxis: hex_encode string].\n - Alias: x.\n hex_decode\n - Convertir hexadecimal a binaria string [Sintaxis: hex_decode string].\n base64_encode\n - Convertir binaria string a base64 string [Sintaxis: base64_encode string].\n - Alias: b.\n base64_decode\n - Convertir base64 string a binaria string [Sintaxis: base64_decode string].\n scan\n - Analizar archivo o directorio [Sintaxis: scan nombre_de_archivo].\n - Alias: s.\n update\n - Actualizar phpMussel.\n - Alias: u.\n c\n - Imprimir esta lista de comandos.\n";
$MusselConfig['lang']['cli_failed_to_complete']='No se pudo completar el proceso de escaneo';
$MusselConfig['lang']['cli_is_not_a']=' no es un archivo o directorio.';
$MusselConfig['lang']['cli_ln2']=" Gracias por usar phpMussel, un PHP script diseñado para detectar troyanos,\n virus, malware y otras amenazas en los archivos subidos en el sistema donde el\n script está adjunto, basado en las firmas de ClamAV y otros.\n PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Corrientemente phpMussel en ejecución en modo CLI (Comandos línea interfaz).\n\n Para analizar un archivo o directorio, escribir 'scan', seguido por el nombre\n del archivo o directorio que usted desea phpMussel para escanear y pulse Enter;\n Escribir 'c' y pulse Enter para obtener una lista de CLI modo comandos;\n Escribir 'q' y pulse Enter para salir:";
$MusselConfig['lang']['cli_pe1']='No es un válido PE archivo!';
$MusselConfig['lang']['cli_pe2']='PE Secciones:';
$MusselConfig['lang']['cli_update_restart']=" Reinicio phpMussel puede ser requerido antes de las actualizaciones se hacen\n evidentes.";
$MusselConfig['lang']['cli_working']='En operación';
$MusselConfig['lang']['controls_lockout']='phpMussel controles bloqueos habilitadas.';
$MusselConfig['lang']['core_scriptfile_missing']='Núcleo script archivo está ausente! Por favor, reinstalar phpMussel.';
$MusselConfig['lang']['corrupted']='Detectado corrompido PE';
$MusselConfig['lang']['denied']='Carga Negado!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Upload verweigert! Upload Geweigerd! Caricamento Negato! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Intento de subida ha sido bloqueada por las razones que se indican a continuación / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Detectado {vn}';
$MusselConfig['lang']['detected_control_characters']='Detectado Control Caracteres';
$MusselConfig['lang']['encrypted_archive']='Detectado archivo encriptado; Archivos encriptados no permitidos';
$MusselConfig['lang']['failed_to_access']='No se pudo acceso ';
$MusselConfig['lang']['file']='Archivo';
$MusselConfig['lang']['filesize_limit_exceeded']='Excede el límite del archivo tamaño';
$MusselConfig['lang']['filetype_blacklisted']='Tipo de archivo en la lista negra';
$MusselConfig['lang']['finished']='Terminado';
$MusselConfig['lang']['generated_by']='Generado por';
$MusselConfig['lang']['greylist_cleared']=' Greylist vaciado.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist no actualizado.';
$MusselConfig['lang']['greylist_updated']=' Greylist actualizado.';
$MusselConfig['lang']['image']='Imagen';
$MusselConfig['lang']['instance_already_active']='Instancia ya está activo! Por favor, compruebe sus ganchos.';
$MusselConfig['lang']['invalid_file']='Archivo no válido';
$MusselConfig['lang']['ok']='OK';
$MusselConfig['lang']['only_allow_images']='Subir de archivos que no son imágenes no está permitido';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel desactivado.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel ya está desactivado.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel activado.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel ya está activado.';
$MusselConfig['lang']['recursive']='Recursión profundidad límite excedido';
$MusselConfig['lang']['refer_to_scan_kills']=' (referir a '.$MusselConfig['general']['scan_kills'].' para más detalles)';
$MusselConfig['lang']['required_variables_not_defined']='Variables requeridas no están definidos: No puede continuar.';
$MusselConfig['lang']['scan_aborted']='Escaneo abortado!';
$MusselConfig['lang']['scan_chameleon']='{x} camaleón ataque detectado';
$MusselConfig['lang']['scan_checking']='Comprobando';
$MusselConfig['lang']['scan_checking_contents']='Éxito! Procediendo a comprobando las contenidos.';
$MusselConfig['lang']['scan_command_injection']='Comandos inyección intento detectado';
$MusselConfig['lang']['scan_complete']='Completo';
$MusselConfig['lang']['scan_extensions_missing']='Fracasado (desaparecido requeridos extensiones)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Manipulación del fichero nombre detectado';
$MusselConfig['lang']['scan_map_corrupted']='Firma Mapa corrompido';
$MusselConfig['lang']['scan_map_missing']='Firma Mapa desaparecido';
$MusselConfig['lang']['scan_missing_filename']='Nombre del archivo está ausente';
$MusselConfig['lang']['scan_not_archive']='Fracasado (vacío o no es un archivo)!';
$MusselConfig['lang']['scan_no_problems_found']='No problemas encontrado.';
$MusselConfig['lang']['scan_reading']='Leyendo';
$MusselConfig['lang']['scan_signature_file_corrupted']='Firma archivo corrompido';
$MusselConfig['lang']['scan_signature_file_missing']='Firma archivo desaparecido';
$MusselConfig['lang']['scan_tampering']='Detectado potencialmente peligrosa archivo manipulación';
$MusselConfig['lang']['scan_unauthorised_upload']='No autorizado archivos manipulación detectado';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='No autorizado archivos manipulación o malo configuración detectado! ';
$MusselConfig['lang']['started']='Iniciado';
$MusselConfig['lang']['update_']='phpMussel ahora intentará actualización.';
$MusselConfig['lang']['update_available']='Una script actualización está disponible.';
$MusselConfig['lang']['update_complete']='Actualización verificación completada con éxito.';
$MusselConfig['lang']['update_created']='creado';
$MusselConfig['lang']['update_deleted']='borrado';
$MusselConfig['lang']['update_err1']='No actualizado: \'update.dat\' ausenta. Reinstalar o actualizar manualmente.';
$MusselConfig['lang']['update_err2']='No actualizado: \'update.dat\' no contiene cualquier válido fuente de actualización. Por favor, actualizar manualmente.';
$MusselConfig['lang']['update_err3']='Posible hackeo o falsificación detectada en las actualización instrucciones suministrados por la actualización fuente; Fuente ser posible comprometida. Por favor, notifique al autor de la script. Se recomienda actualizar manualmente.';
$MusselConfig['lang']['update_err4']='Checksum ausentas!';
$MusselConfig['lang']['update_err5']='Datos ausentas!';
$MusselConfig['lang']['update_err6']='Datos malos!';
$MusselConfig['lang']['update_err7']='Checksum malos!';
$MusselConfig['lang']['update_failed']='Fracasado.';
$MusselConfig['lang']['update_fetch']='Intentar para obtener la versión datos de';
$MusselConfig['lang']['update_lock_detected']='Actualización bloqueo detectado: No puede continuar. Buscar para actualizaciones corruptas o inténtelo de nuevo más tarde.';
$MusselConfig['lang']['update_not']='NO {x}';
$MusselConfig['lang']['update_not_available']='No script actualización está disponible en este momento.';
$MusselConfig['lang']['update_not_possible']='Una script actualización está disponible, pero no puede ser completamente actualizada con esta versión de la script de actualización. Por favor, actualizar manualmente.';
$MusselConfig['lang']['update_no_source']='phpMussel ha fracasado de actualización porque no se pudo conectar a una válido actualización fuente. Se recomienda actualizar manualmente.';
$MusselConfig['lang']['update_patched']='parcheado';
$MusselConfig['lang']['update_scriptfile_missing']=' Actualización script archivo faltan! Por favor, reinstalar phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' segundos transcurridos';
$MusselConfig['lang']['update_signatures_available']='Una actualización de firmas está disponible.';
$MusselConfig['lang']['update_signatures_latest']='ÚLTIMAS FIRMAS';
$MusselConfig['lang']['update_signatures_not_available']='No actualización de firmas está disponible en este momento.';
$MusselConfig['lang']['update_signatures_yours']='SUS FIRMAS';
$MusselConfig['lang']['update_success']='Éxito.';
$MusselConfig['lang']['update_successfully']=' con éxito';
$MusselConfig['lang']['update_version_latest']='ÚLTIMA SCRIPT VERSIÓN';
$MusselConfig['lang']['update_version_yours']='SU SCRIPT VERSIÓN';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='firmas';
$MusselConfig['lang']['upload_error_1']='Fichero tamaño excede MAX_FILE_SIZE directiva. ';
$MusselConfig['lang']['upload_error_2']='Fichero tamaño excede forma especificada fichero tamaño límite. ';
$MusselConfig['lang']['upload_error_34']='Subir fracaso! Contacto el hostmaster para ayuda! ';
$MusselConfig['lang']['upload_error_6']='Subir directorio desaparecido! Contacto el hostmaster para ayuda! ';
$MusselConfig['lang']['upload_error_7']='Error en el disco contra escritura! Contacto el hostmaster para ayuda! ';
$MusselConfig['lang']['upload_error_8']='PHP mala configuración detectado! Contacto el hostmaster para ayuda! ';
$MusselConfig['lang']['upload_limit_exceeded']='Subir límite excedido';
$MusselConfig['lang']['wrong_password']='Contraseña incorrecta; Acción negada.';
$MusselConfig['lang']['x_does_not_exist']='no existe';

?>