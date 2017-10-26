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
 * This file: Spanish language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Página Principal</a> | <a href="?phpmussel-page=logout">Cerrar Sesión</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Cerrar Sesión</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Reconocido compactado archivo extensiones (formato es CSV; sólo debe agregar o eliminar cuando problemas ocurrir; eliminando innecesariamente puede causar falsos positivos a aparecer para compactados archivos, mientras añadiendo innecesariamente hará esencialmente whitelist que cuales eres añadiendo desde ataque específica detección; modificar con precaución; También notar que esto no tiene efecto en aquellos compactados archivos que pueden y no pueden ser analizado a contenido nivel). La lista, como es a predefinición, describe los formatos más comúnmente utilizados a través de la mayoría de sistemas y CMS, pero intencionalmente no es necesariamente exhaustiva.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Bloquear cualquier archivos que contenga cualquier caracteres de control (aparte de saltos de línea)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Si usted sólo subir texto sin cualquier formato, usted puede activar esta opción para proporcionar alguna adicional protección para su sistema. Pero, si usted subir cualquier cosa otro de texto sin cualquier formato, activando esto puede dar lugar a falsos positivos. False = No bloquear [Predefinido]; True = Bloquear.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Buscar para PE mágico número en archivos que no están ejecutables ni reconocidos compactados archivos y para ejecutables cuyo mágicos números son incorrectas. False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Buscar para PHP código en archivos que no están PHP archivos ni reconocidos compactados archivos. False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Buscar para compactados archivos cuyo mágicos números son incorrectas (Soportado: BZ, GZ, RAR, ZIP, RAR, GZ). False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Buscar para office documentos cuyo mágicos números son incorrectas (Soportado: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Buscar para imágenes cuyo mágicos números son incorrectas (Soportado: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Buscar para PDF archivos cuyo mágicos números son incorrectas. False = Desactivado; True = Activado.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Corrompido archivos y procesamiento errores. False = Ignorar; True = Bloquear [Predefinido]. Detectar y bloquear potencialmente corrompido PE (Portátil Ejecutable) archivos? Frecuentemente (pero no siempre), cuando ciertos aspectos de un PE archivo están corrompido, dañados o no podrá ser analizado correctamente, lo puede ser indicativo de una infección viral. Los procesos utilizados por la mayoría de los antivirus programas para detectar un virus en PE archivos requerir analizando esos archivos en ciertas maneras, que, si el programador de un virus es consciente de, intentará específicamente para prevenir, con el fin de permitir su virus permanezca sin ser detectado.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Opcional limitación a la longitud de datos a que dentro de decodificación comandos deben ser detectados (en caso de que los hay notable rendimiento problemas mientras que escaneando). Predefinido = 512KB. Cero o nulo valor desactiva la limitación (eliminando cualquier tal limitación basado sobre la tamaño de archivos).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Opcional limitación a la longitud de datos puros para que phpMussel se permitido leer y escanear (en caso de que los hay notable rendimiento problemas mientras que escaneando). Predefinido = 32MB. Cero o nulo valor desactiva la limitación. En general, Este valor no debe ser inferior a la media tamaño de archivos subidos que desea y espera recibir a su servidor o website, no debe ser mayor que el filesize_limit directiva, y no debe ser más de aproximadamente una quinta parte de la total permisible memoria asignación concedida a PHP a través de la "php.ini" configuración archivo. Esta directiva existe para intratar prevenir phpMussel del uso de demasiada memoria (eso sería prevenir que sea capaz para escanear archivos con éxito encima de un cierto tamaño de archivos).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Esta directiva, en general, debe ser desactivado, a menos que se requiere para la correcta funcionalidad de phpMussel en su específico sistema. Normalmente, cuando está desactivado, cuando phpMussel detecta la presencia de elementos en la <code>$_FILES</code> array(), intentará iniciar un escaneo de los archivos que esos elementos representan, y, si esos elementos están blanco o vacío, phpMussel devolverá un mensaje de error. Este es el comportamiento natural para phpMussel. Pero, para algunos CMS, vacíos elementos en <code>$_FILES</code> puede ocurrir como resultado del comportamiento natural de los CMS, o errores pueden ser reportados cuando no existe ninguna, en cuyo caso, el comportamiento natural para phpMussel será interfiriendo con el comportamiento natural de los CMS. Si tal situación ocurre para usted, activando esta opción instruirá phpMussel no intentar iniciar un escaneo para tales vacíos elementos, ignorarlos cuando encontrado y no devuelva cualquier relacionado mensaje de error, así permitiendo la continuación de la página cargando. False = DESACTIVADO; True = ACTIVADO.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Si usted sólo esperas o sólo quieren permitir imágenes para ser subido a su sistema o CMS, y si usted absolutamente no requiere cualquieres archivos otro que imágenes para subir a su sistema o CMS, esta directiva debe ser activado, pero por lo demás debe ser desactivado. Si esta directiva está activada, se instruirá phpMussel para indiscriminadamente bloquear cualquieres subidos identificado como archivos que no son imagen, sin escaneandolos. Esto puede reducir el tiempo de procesamiento y el uso de memoria para intentados subidos de archivos que no son imagen. False = DESACTIVADO; True = ACTIVADO.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Detectar y bloquear compactados archivos encriptados? Debido phpMussel no es capaz de escanear el contenido de los compactados archivos encriptados, es posible que este puede ser empleado por un atacante como un medio de evitando phpMussel, antivirus escáneres y otras protecciones. Instruir phpMussel para bloquear cualquier compactado archivo que se descubre es encriptado potencialmente podría ayudar a reducir el riesgo asociado a estos tales posibilidades. False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_files_check_archives'] = 'Intente comprobar el contenido de los compactados archivos? False = No (no comprobar); True = Sí (comprobar) [Predefinido]. Corrientemente, los únicos formatos soportados son BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR y ZIP (los formatos RAR, CAB, 7z y etc. corrientemente no es soportados). Esto no es infalible! Mientras yo altamente recomiendo mantener este activado, no puedo garantizar que siempre encontrará todo. También ser conscientes que la comprobación de compactados archivos corrientemente no es recursivo para PHAR o ZIP formatos.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Heredar tamaño de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Límite del tamaño de archivos en KB. 65536 = 64MB [Predefinido]; 0 = Sin límite (siempre en la greylist), cualquier (positivo) numérico valor aceptado. Esto puede ser útil cuando su PHP configuración limita la cantidad de memoria un proceso puede contener o si su PHP configuración limita el tamaño de archivo subidos.';
$phpMussel['lang']['config_files_filesize_response'] = 'Qué hacer con los archivos que superen el límite del tamaño de archivos (si existe). False = Whitelist; True = Blacklist [Predefinido].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Heredar tipos de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Si su sistema sólo permite ciertos tipos de archivos para ser subido, o si su sistema niega explícitamente ciertos tipos de archivos, especificando los tipos de archivos en la whitelist, blacklist y/o greylist puede aumentar la velocidad a que escaneando se realizado por permitiendo la script para saltar sobre ciertos tipos de archivos. Formato es CSV (comas separados valores). Si desea escanear todo, en lugar de utilizando la whitelist, blacklist o greylist, dejar las variables en blanco; haciendo tal desactivará la whitelist/blacklist/greylist. Lógico orden de procesamiento es: Si el tipo de archivo está en la whitelist, no escanear y no bloquear el archivo, y no cotejar el archivo con la blacklist o la greylist. Si el tipo de archivo está en la blacklist, no escanear el archivo, pero bloquearlo en todo caso, y no cotejar el archivo con la greylist. Si la greylist está vacía o si la greylist está no vacía y el tipo de archivo está en la greylist, escanearlo como normal y determinar si para bloquearlo basado en los resultados de la escaneo, pero si la greylist está no vacía y el tipo de archivo está no en la greylist, tratar el archivo como si está en la blacklist, por lo tanto no escanearlo pero bloquearlo en todo caso. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Máximo recursividad nivel límite para compactados archivos. Predefinido = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Máximo permitido número de archivos para escanear durante archivo subido escaneo antes de abortando la escaneo e informando al usuario están subir demasiado simultáneamente! Proporciona protección contra un teórico ataque por lo cual un atacante intenta DDoS su sistema o CMS por sobrecargando phpMussel para ralentizar el proceso de PHP a niveles inoperables. Recomendado: 10. Es posible que desee aumentar o reducir este número dependiendo de la velocidad de su hardware. Notar que este número no tiene en cuenta o incluir el contenidos de compactados archivos.';
$phpMussel['lang']['config_general_cleanup'] = 'Despejar la variables y la caché de la script después la script ejecución? False = No; True = Sí [Predefinido]. Si usted no está utilizando la script más allá de inicial escaneando de archivos subidos, debe definir como <code>true</code> (sí), para minimizar el uso de memoria. Si usted está utilizando la script para propósitos más allá de inicial escaneando de archivos subidos, debe definir como <code>false</code> (no), para evitar recargar innecesariamente duplicados datos en la memoria. En general práctica, probablemente debería definirse como <code>true</code>, pero, si usted hace esto, usted no será capaz de utilizar la script para cualquier cosa otro que de escaneando archivos subidos. No tiene influencia en CLI modo.';
$phpMussel['lang']['config_general_default_algo'] = 'Define qué algoritmo utilizar para todas las contraseñas y sesiones en el futuro. Opciones: PASSWORD_DEFAULT (predefinido), PASSWORD_BCRYPT, PASSWORD_ARGON2I (requiere PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Activando esta directiva instruirá la script para intentar para eliminar inmediatamente cualquier escaneados intentados archivos subidos emparejando a los criterios de detección, si través de firmas o de otras maneras. Archivos determinados como limpia no serán tocados. En el caso de los compactados archivos, la totalidad del compactado archivo será eliminado (independientemente de si el emparejando archivo es sólo uno de muchos varios archivos contenida dentro del compactado archivo). Para el caso de archivo subir escaneo, en general, no es necesario activar esta directiva, porque en general, PHP purgará automáticamente el contenido de su caché cuando la ejecución ha terminado, significando que lo en general eliminará cualquier archivos subidos a través de él con el servidor a no ser que se han movido, copiado o eliminado ya. La directiva se añade aquí como una medida adicional de seguridad para aquellos cuyas copias de PHP no siempre se comportan de la manera esperada. False = Después escaneando, dejar el archivo solo [Predefinido]; True = Después escaneando, si no se limpia, eliminar inmediatamente.';
$phpMussel['lang']['config_general_disable_cli'] = '¿Desactivar CLI modo? CLI modo está activado por predefinido, pero a veces puede interferir con ciertas herramientas de prueba (tal como PHPUnit, por ejemplo) y otras aplicaciones basadas en CLI. Si no es necesario desactivar CLI modo, usted debe ignorar esta directiva. False = Activar CLI modo [Predefinido]; True = Desactivar CLI modo.';
$phpMussel['lang']['config_general_disable_frontend'] = '¿Desactivar el acceso front-end? El acceso front-end puede hacer phpMussel más manejable, pero también puede ser un riesgo de seguridad. Se recomienda administrar phpMussel a través del back-end cuando sea posible, pero el acceso front-end se proporciona para cuando no es posible. Mantenerlo desactivado a menos que lo necesite. False = Activar el acceso front-end; True = Desactivar el acceso front-end [Predefinido].';
$phpMussel['lang']['config_general_disable_webfonts'] = '¿Desactivar webfonts? True = Sí; False = No [Predefinido].';
$phpMussel['lang']['config_general_enable_plugins'] = '¿Habilitar el soporte para los plugins de phpMussel? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_general_forbid_on_block'] = '¿Debería phpMussel enviar 403 header con la bloqueados archivos subidos mensaje, o quedarse con los usual 200 OK? False = No (200); True = Sí (403) [Predefinido].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Archivo para registrar intentos de login al front-end. Especificar el nombre del archivo, o dejar en blanco para desactivar.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Cuando la honeypot modo está activado, phpMussel intentará cuarentenar cada archivos subidos que encuentra, independientemente de si o no el archivo que se está subido coincide con las firmas incluídas, y no real escanear o análisis de esos intentados archivos subidos van a ocurrir. Esta funcionalidad debe ser útil para aquellos que deseen utilizar phpMussel a los efectos del virus/malware investigación, pero no se recomendado activar esta funcionalidad si el uso de phpMussel por el usuario es para real archivo subido escaneando ni recomendado usar la honeypot funcionalidad para fines otro que de la honeypot. Por predefinido, esta opción está desactivada. False = Desactivado [Predefinido]; True = Activado.';
$phpMussel['lang']['config_general_ipaddr'] = 'Dónde encontrar el IP dirección de la conectando request? (Útil para servicios como Cloudflare y tales) Predefinido = REMOTE_ADDR. AVISO: No cambie esto a menos que sepas lo que estás haciendo!';
$phpMussel['lang']['config_general_lang'] = 'Especifique la predefinido del lenguaje para phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = '¿Activar modo de mantenimiento? True = Sí; False = No [Predefinido]. Desactiva todo lo que no sea el front-end. A veces útil para la actualización de su CMS, frameworks, etc.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Número máximo de intentos de login (front-end). Predefinido = 5.';
$phpMussel['lang']['config_general_numbers'] = '¿Cómo prefieres los números que se muestran? Seleccione el ejemplo que le parezca más correcto.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel es capaz de poner en cuarentena intentados archivos subidos en aisladamente dentro de la phpMussel vault, si esto es algo que usted quiere que haga. Usuarios casual de phpMussel de los cuales simplemente desean proteger sus website o hosting ambiente sin tener ningún interés con analizando profundamente cualquier marcados intentados archivos subidos debería dejar esta funcionalidad desactivado, pero cualquier usuarios interesados en más análisis de marcados intentados archivos subidos para la investigación de malware o para cosas similares debe activar esta funcionalidad. Cuarentenando de marcados intentados archivos subidos a veces puede también ayudar en la depuración de falsos positivos, si esto es algo que ocurre con frecuencia para usted. Para desactivar la cuarentena funcionalidad, simplemente dejar la directiva <code>quarantine_key</code> vacío, o borrar el contenidos de que directiva si no está ya vacío. Para activar la cuarentena funcionalidad, entrar algún valor en la directiva. La <code>quarantine_key</code> es un importante característica de seguridad de la cuarentena funcionalidad requiere como un medio para la prevención de la explotación de la cuarentena funcionalidad por potenciales atacantes y como un medio de evitar cualquier potencial ejecución de los datos almacenados dentro la cuarentena. La <code>quarantine_key</code> debería ser tratado de la misma manera que sus contraseñas: El más grande es el mejor, y guárdela bien. Para un mejor efecto, utilice conjuntamente con <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'El archivo tamaño máximo permitido para archivos para ser cuarentenada. Archivos que superen el valor especificado aquí NO serán cuarentenada. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su servicio de hosting. Predefinido = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'El uso máximo de memoria permitida para la cuarentena. Si la total memoria utilizada por la cuarentena alcanza este valor, los más antiguos cuarentenado archivos serán eliminado hasta que la total memoria utilizada ya no alcanza este valor. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su servicio de hosting. Predefinido = 64M.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Por cuánto tiempo debe phpMussel caché de los resultados del escaneo? El valor es el número de segundos para almacenar en caché los resultados del escaneo. La predeterminado valor es 21600 segundos (6 horas); Un valor de 0 desactiva el almacenamiento en caché de los resultados del escaneo.';
$phpMussel['lang']['config_general_scan_kills'] = 'Nombre del archivo para registrar todos bloqueados o matados subidos. Especifique un archivo nombre, o dejar en blanco para desactivar.';
$phpMussel['lang']['config_general_scan_log'] = 'Nombre del archivo para registrar todos los resultados de las escaneos. Especifique un archivo nombre, o dejar en blanco para desactivar.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Nombre del archivo para registrar todos los resultados de las escaneos (utilizando un formato serializado). Especifique un archivo nombre, o dejar en blanco para desactivar.';
$phpMussel['lang']['config_general_statistics'] = '¿Seguir las estadísticas de uso de phpMussel? True = Sí; False = No [Predefinido].';
$phpMussel['lang']['config_general_timeFormat'] = 'El formato de notación de fecha/hora usado por phpMussel. Se pueden añadir opciones adicionales bajo petición.';
$phpMussel['lang']['config_general_timeOffset'] = 'Desplazamiento del huso horario en minutos.';
$phpMussel['lang']['config_general_timezone'] = 'Tu zona horaria.';
$phpMussel['lang']['config_general_truncate'] = '¿Truncar archivos de registro cuando alcanzan cierto tamaño? Valor es el tamaño máximo en B/KB/MB/GB/TB que un archivo de registro puede crecer antes de ser truncado. El valor predeterminado de 0KB deshabilita el truncamiento (archivos de registro pueden crecer indefinidamente). Nota: ¡Se aplica a archivos de registro individuales! El tamaño de los archivos de registro no se considera colectivamente.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Hay ciertas firmas de phpMussel eso tienen la intención de identificar sospechosas y potencialmente maliciosos cualidades de los archivos que se subido sin que en ellos la identificación de los archivos que se subido específicamente como malicioso. Este "threshold" (umbral) valor dice phpMussel qué lo máximo total peso de sospechosas y potencialmente maliciosos cualidades de los archivos que se subido eso es permisible es antes de que esos archivos han de ser señalado como malicioso. La definición de peso en este contexto es el número total de sospechosas y potencialmente maliciosos cualidades identificados. Por predefinido, este valor es 3. Un valor inferior generalmente resultará en una mayor incidencia de falsos positivos pero un mayor número de archivos maliciosos siendo identificado, mientras un valor mayor generalmente resultará en una inferior incidencia de falsos positivos pero un inferior número de archivos maliciosos siendo identificado. Generalmente es mejor dejar este valor en su predefinido a menos que usted está experimentando problemas relacionados con ella.';
$phpMussel['lang']['config_signatures_Active'] = 'Una lista de los archivos de firmas activa, delimitados por comas.';
$phpMussel['lang']['config_signatures_detect_adware'] = '¿Debe phpMussel utilizar firmas para detectar adware? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_deface'] = '¿Debe phpMussel utilizar firmas para detectar defacements y defacers? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_encryption'] = '¿Debe phpMussel detectar y bloquear archivos cifrados? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = '¿Debe phpMussel utilizar firmas para detectar broma/engaño malware/virus? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = '¿Debe phpMussel utilizar firmas para detectar empacadores y datos empaquetados? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = '¿Debe phpMussel utilizar firmas para detectar PUAs/PUPs? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_detect_shell'] = '¿Debe phpMussel utilizar firmas para detectar shell scripts? False = No; True = Sí [Predefinido].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = '¿Debe phpMussel informan cuando extensiones están desaparecidos? Si <code>fail_extensions_silently</code> está desactivado, desaparecidos extensiones será reportado cuando escaneando, y si <code>fail_extensions_silently</code> está activado, desaparecidos extensiones será ignorado, with scanning reportando para aquellos archivos que no hay cualquier problemas. Desactivando esta directiva puede potencialmente aumentar su seguridad, pero también puede conducir a un aumento de falsos positivos. False = Desactivado; True = Activado [Predefinido].';
$phpMussel['lang']['config_signatures_fail_silently'] = '¿Debe phpMussel informan cuando los firmas archivos están desaparecidos o dañados? Si <code>fail_silently</code> está desactivado, desaparecidos y dañados archivos será reportado cuando escaneando, y si <code>fail_silently</code> está activado, desaparecidos y dañados archivos será ignorado, con escaneando reportando para aquellos archivos que no hay cualquier problemas. Esto generalmente debe ser dejar sola a menos que usted está experimentando estrellarse o problemas similares. False = Desactivado; True = Activado [Predefinido].';
$phpMussel['lang']['config_template_data_css_url'] = 'El plantilla archivo para los temas personalizados utiliza externas CSS propiedades, mientras que el plantilla archivo para el predefinida tema utiliza internas CSS propiedades. Para instruir phpMussel de utilizar el plantilla archivo para temas personalizados, especificar el público HTTP dirección de sus temas personalizados CSS archivos utilizando la <code>css_url</code> variable. Si lo deja en blanco la variable, phpMussel utilizará el plantilla archivo para el predefinida tema.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Ampliación de fuente. Predefinido = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Tema predefinido a utilizar para phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Por cuánto tiempo (en segundos) debe los resultados de las API búsquedas ser almacenan en caché? Predefinido es 3600 segundos (1 horas).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Permite API búsquedas al Google Safe Browsing API cuando la necesario API clave es define.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Permite API búsquedas al hpHosts API cuando se define como true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Máximo número permitido de API búsquedas para llevar a cabo por individuo escaneando iteración. Debido a que cada adicional API búsqueda se sumará al total tiempo requerido para completar cada escaneando iteración, es posible que usted desee estipular una limitación a fin de acelerar el proceso de escaneando. Cuando se define en 0, no tal máximo número permitido se aplicará. Se define como 10 por predefinido.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Qué hacer si el máximo número de API búsquedas permitido es superadas? False = Hacer nada (continuar procesando) [Predefinido]; True = Marcar/bloquear el archivo.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Opcionalmente, phpMussel es capaz de escanear archivos utilizando el Virus API total como una manera de proporcionar un mucho mayor nivel de protección contra virus, troyanos, malware y otras amenazas. Por predefinido, escanear archivos utilizando el Virus Total API está desactivado. Para activarlo, una API clave desde Virus Total se requiere. Debido a la significativo beneficio que esto podría proporcionar a usted, está algo que recomiendo. Tenga en cuenta, aunque, que para utilizar el Virus API total, es absolutamente necesario usted estar de acuerdo con sus Términos de Servicio y cumplan todas las directrices según descrito por el Virus Total documentación! Usted NO se permitido utilizar esta integración función A MENOS QUE: Ha leído y está de acuerdo con los Términos de Servicio de Virus Total y sus API. Ha leído y entender, en un mínimo, el preámbulo de la Virus Total Pública API Documentación (todo después "VirusTotal Public API v2.0" pero antes "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'En acuerdo con la documentación de la Virus Total API, está limitado para un máximo de 4 solicitudes de cualquier naturaleza en cualquier 1 minuto período de tiempo. Si usted ejecuta un honeyclient, honeypot o cualquier otra automatización que va proporcionar recursos para Virus Total y no sólo recuperar los reportes usted tiene derecho a un más alta cuota. Por predefinido, phpMussel va adhiere estrictamente a estas limitaciones, pero debido a la posibilidad de estos limitaciones siendo aumentado, estas dos directivas son proporcionan como un manera para usted para indique para phpMussel en cuanto a qué limitaciones está debe adherirse a. A menos que usted ha estado indique que lo haga, está no es recomendable para usted para aumentar estos valores, pero, si ha tenido problemas relacionados con alcanzar su cuota, la disminución de estos valores <em><strong>PUEDE</strong></em> a veces ayudarle para hacer frente a estos problemas. Su cuota es determinado como <code>vt_quota_rate</code> solicitudes de cualquier naturaleza en cualquier <code>vt_quota_time</code> minuto período de tiempo.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Ver descripción arriba).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Por predefinido, phpMussel restringirá qué archivos se escaneado usando el Virus Total API a esos archivos que se considera "sospechosa". Opcionalmente, usted puede ajustar esta restricción por manera de cambiando el valor de la <code>vt_suspicion_level</code> directiva.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = '¿Debería phpMussel aplicar los resultados del escaneo utilizando el Virus Total API como detecciones o como detección peso? Esta directiva existe, por razón de que, aunque escanear un archivo usando múltiples motores (como Virus Total hacer) debería resultar en un aumento detección cuenta (y por lo tanto en un mayor número de maliciosos archivos ser atrapado), esta también puede resultar en un mayor número de falsos positivos, y por lo tanto, en algunas circunstancias, los resultados del escanear pueden ser mejor utilizados como una puntuación de confianza y no como una definitiva conclusión. Si un valor de 0 es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detecciones, y por lo tanto, si cualquier motor utilizado por Virus Total marca el archivo está escaneando como malicioso, phpMussel considerará el archivo a ser malicioso. Si cualquier otro valor es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detección peso, y por lo tanto, el número de motores utilizados por Virus Total que marca el archivo está escaneando como malicioso servirá como una puntuación de confianza (o detección peso) para si el archivo que ser escanear debe ser considerado malicioso por phpMussel (el valor utilizado representará el mínima puntuación de confianza o peso requerido con el fin de ser considerado malicioso). Un valor de 0 es utilizado por predefinido.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'El paquete principal (menos las firmas, la documentación, y la configuración).';
$phpMussel['lang']['field_activate'] = 'Activar';
$phpMussel['lang']['field_clear_all'] = 'Anular todo';
$phpMussel['lang']['field_component'] = 'Componente';
$phpMussel['lang']['field_create_new_account'] = 'Crear Nueva Cuenta';
$phpMussel['lang']['field_deactivate'] = 'Desactivar';
$phpMussel['lang']['field_delete_account'] = 'Eliminar Cuenta';
$phpMussel['lang']['field_delete_all'] = 'Eliminar todos';
$phpMussel['lang']['field_delete_file'] = 'Borrar';
$phpMussel['lang']['field_download_file'] = 'Descargar';
$phpMussel['lang']['field_edit_file'] = 'Editar';
$phpMussel['lang']['field_false'] = 'False (Falso)';
$phpMussel['lang']['field_file'] = 'Archivo';
$phpMussel['lang']['field_filename'] = 'Nombre del archivo: ';
$phpMussel['lang']['field_filetype_directory'] = 'Directorio';
$phpMussel['lang']['field_filetype_info'] = '{EXT} Archivo';
$phpMussel['lang']['field_filetype_unknown'] = 'Desconocido';
$phpMussel['lang']['field_install'] = 'Instalar';
$phpMussel['lang']['field_latest_version'] = 'Ultima Versión';
$phpMussel['lang']['field_log_in'] = 'Iniciar Sesión';
$phpMussel['lang']['field_more_fields'] = 'Más Campos';
$phpMussel['lang']['field_new_name'] = 'Nuevo nombre:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Opciones';
$phpMussel['lang']['field_password'] = 'Contraseña';
$phpMussel['lang']['field_permissions'] = 'Permisos';
$phpMussel['lang']['field_quarantine_key'] = 'Clave de cuarentena';
$phpMussel['lang']['field_rename_file'] = 'Cambiar el nombre';
$phpMussel['lang']['field_reset'] = 'Reiniciar';
$phpMussel['lang']['field_restore_file'] = 'Restaurar';
$phpMussel['lang']['field_set_new_password'] = 'Crear Nueva Contraseña';
$phpMussel['lang']['field_size'] = 'Tamaño Total: ';
$phpMussel['lang']['field_size_bytes'] = ['byte', 'bytes'];
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Estado';
$phpMussel['lang']['field_system_timezone'] = 'Usar la zona horaria predeterminada del sistema.';
$phpMussel['lang']['field_true'] = 'True (Verdadero)';
$phpMussel['lang']['field_uninstall'] = 'Desinstalar';
$phpMussel['lang']['field_update'] = 'Actualizar';
$phpMussel['lang']['field_update_all'] = 'Actualizar todo';
$phpMussel['lang']['field_upload_file'] = 'Subir un nuevo archivo';
$phpMussel['lang']['field_username'] = 'Usuario';
$phpMussel['lang']['field_your_version'] = 'Tu Versión';
$phpMussel['lang']['header_login'] = 'Por favor iniciar sesión para continuar.';
$phpMussel['lang']['label_active_config_file'] = 'Archivo de configuración activo: ';
$phpMussel['lang']['label_blocked'] = 'Subidas bloqueadas';
$phpMussel['lang']['label_branch'] = 'Branch más nuevo estable:';
$phpMussel['lang']['label_events'] = 'Escanear eventos';
$phpMussel['lang']['label_flagged'] = 'Objetos marcados';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Datos de caché y archivos temporales';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'Uso del disco por phpMussel: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Espacio en disco libre: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Uso del disco total: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Espacio en disco total: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Componente actualiza metadatos';
$phpMussel['lang']['label_hide'] = 'Esconder';
$phpMussel['lang']['label_os'] = 'Sistema operativo utilizada:';
$phpMussel['lang']['label_other'] = 'Otro';
$phpMussel['lang']['label_other-Active'] = 'Archivos de firmas activas';
$phpMussel['lang']['label_other-Since'] = 'Fecha de inicio';
$phpMussel['lang']['label_php'] = 'Versión PHP utilizada:';
$phpMussel['lang']['label_phpmussel'] = 'Versión phpMussel utilizada:';
$phpMussel['lang']['label_quarantined'] = 'Subidas en cuarentena';
$phpMussel['lang']['label_sapi'] = 'SAPI utilizada:';
$phpMussel['lang']['label_scanned_objects'] = 'Objetos escaneados';
$phpMussel['lang']['label_scanned_uploads'] = 'Subidas escaneadas';
$phpMussel['lang']['label_show'] = 'Mostrar';
$phpMussel['lang']['label_size_in_quarantine'] = 'Tamaño en cuarentena: ';
$phpMussel['lang']['label_stable'] = 'Más nuevo estable:';
$phpMussel['lang']['label_sysinfo'] = 'Información del sistema:';
$phpMussel['lang']['label_tests'] = 'Pruebas:';
$phpMussel['lang']['label_unstable'] = 'Más nuevo inestable:';
$phpMussel['lang']['label_upload_date'] = 'Fecha de subir: ';
$phpMussel['lang']['label_upload_hash'] = 'Hash de subir: ';
$phpMussel['lang']['label_upload_origin'] = 'Origen de subir: ';
$phpMussel['lang']['label_upload_size'] = 'Tamaño de subir: ';
$phpMussel['lang']['link_accounts'] = 'Cuentas';
$phpMussel['lang']['link_config'] = 'Configuración';
$phpMussel['lang']['link_documentation'] = 'Documentación';
$phpMussel['lang']['link_file_manager'] = 'Administración de Archivos';
$phpMussel['lang']['link_home'] = 'Página Principal';
$phpMussel['lang']['link_logs'] = 'Archivos de Registro';
$phpMussel['lang']['link_quarantine'] = 'Cuarentena';
$phpMussel['lang']['link_statistics'] = 'Estadística';
$phpMussel['lang']['link_textmode'] = 'Formato de texto: <a href="%1$sfalse">Simple</a> – <a href="%1$strue">Lujoso</a>';
$phpMussel['lang']['link_updates'] = 'Actualizaciones';
$phpMussel['lang']['link_upload_test'] = 'Subir Prueba';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = '¡Archivo de registro seleccionado no existe!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Ningún archivos de registro disponibles.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Ningún archivo de registro seleccionado.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Número máximo de intentos de login excedido; Acceso denegado.';
$phpMussel['lang']['previewer_days'] = 'Días';
$phpMussel['lang']['previewer_hours'] = 'Horas';
$phpMussel['lang']['previewer_minutes'] = 'Minutos';
$phpMussel['lang']['previewer_months'] = 'Meses';
$phpMussel['lang']['previewer_seconds'] = 'Segundos';
$phpMussel['lang']['previewer_weeks'] = 'Semanas';
$phpMussel['lang']['previewer_years'] = 'Años';
$phpMussel['lang']['response_accounts_already_exists'] = '¡Una cuenta con ese nombre ya existe!';
$phpMussel['lang']['response_accounts_created'] = '¡Cuenta creada con éxito!';
$phpMussel['lang']['response_accounts_deleted'] = '¡Cuenta eliminada con éxito!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Esa cuenta no existe.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Contraseña actualizado con éxito!';
$phpMussel['lang']['response_activated'] = 'Se ha activado correctamente.';
$phpMussel['lang']['response_activation_failed'] = '¡No se pudo activar!';
$phpMussel['lang']['response_checksum_error'] = 'Error de suma de comprobación! Archivo rechazado!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Componente instalado con éxito.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Componente desinstalado con éxito.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Componente actualizado con éxito.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Se ha producido un error al intentar desinstalar el componente.';
$phpMussel['lang']['response_configuration_updated'] = 'Configuración actualizado con éxito.';
$phpMussel['lang']['response_deactivated'] = 'Se ha desactivado correctamente.';
$phpMussel['lang']['response_deactivation_failed'] = '¡No se pudo desactivar!';
$phpMussel['lang']['response_delete_error'] = '¡No se pudo eliminar!';
$phpMussel['lang']['response_directory_deleted'] = '¡Directorio eliminado con éxito!';
$phpMussel['lang']['response_directory_renamed'] = '¡El nombre del directorio cambiado con éxito!';
$phpMussel['lang']['response_error'] = 'Error';
$phpMussel['lang']['response_failed_to_install'] = '¡No se pudo instalar!';
$phpMussel['lang']['response_failed_to_update'] = '¡No se pudo actualizar!';
$phpMussel['lang']['response_file_deleted'] = '¡Archivo eliminado con éxito!';
$phpMussel['lang']['response_file_edited'] = '¡Archivo modificado con éxito!';
$phpMussel['lang']['response_file_renamed'] = '¡El nombre del archivo cambiado con éxito!';
$phpMussel['lang']['response_file_restored'] = '¡Archivo restaurado con éxito!';
$phpMussel['lang']['response_file_uploaded'] = '¡Archivo subido con éxito!';
$phpMussel['lang']['response_login_invalid_password'] = '¡Error al iniciar sesión – Contraseña invalida!';
$phpMussel['lang']['response_login_invalid_username'] = '¡Error al iniciar sesión – El usuario no existe!';
$phpMussel['lang']['response_login_password_field_empty'] = '¡La entrada de contraseña estaba vacío!';
$phpMussel['lang']['response_login_username_field_empty'] = '¡La entrada de usuario estaba vacío!';
$phpMussel['lang']['response_rename_error'] = '¡No se pudo cambiar el nombre!';
$phpMussel['lang']['response_restore_error_1'] = '¡Error al restaurar! Archivo corrupto!';
$phpMussel['lang']['response_restore_error_2'] = '¡Error al restaurar! Clave de cuarentena incorrecta!';
$phpMussel['lang']['response_statistics_cleared'] = 'Estadística anulado.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Ya está actualizado.';
$phpMussel['lang']['response_updates_not_installed'] = '¡El componente no se instala!';
$phpMussel['lang']['response_updates_not_installed_php'] = '¡El componente no se instala (requiere PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = '¡Anticuado!';
$phpMussel['lang']['response_updates_outdated_manually'] = '¡Anticuado (por favor, actualizar manualmente)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = '¡Anticuado (requiere PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Incapaz de determinar.';
$phpMussel['lang']['response_upload_error'] = '¡No se pudo subir!';
$phpMussel['lang']['state_complete_access'] = 'Acceso completo';
$phpMussel['lang']['state_component_is_active'] = 'Componente está activo.';
$phpMussel['lang']['state_component_is_inactive'] = 'Componente está inactivo.';
$phpMussel['lang']['state_component_is_provisional'] = 'Componente está provisional.';
$phpMussel['lang']['state_default_password'] = '¡Advertencia: Usando la contraseña estándar!';
$phpMussel['lang']['state_logged_in'] = 'Conectado.';
$phpMussel['lang']['state_logs_access_only'] = 'Acceso de registros solamente';
$phpMussel['lang']['state_maintenance_mode'] = 'Advertencia: ¡El modo de mantenimiento está activado!';
$phpMussel['lang']['state_password_not_valid'] = '¡Advertencia: Esta cuenta no está utilizando una contraseña válida!';
$phpMussel['lang']['state_quarantine'] = ['Hay %s archivo actualmente en cuarentena.', 'Hay %s archivos actualmente en cuarentena.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'No ocultar no anticuado';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Ocultar no anticuado';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'No ocultar no utilizado';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Ocultar no utilizado';
$phpMussel['lang']['tip_accounts'] = 'Hola, {username}.<br />La página de cuentas permite controlar controlar quién puede acceder al phpMussel front-end.';
$phpMussel['lang']['tip_config'] = 'Hola, {username}.<br />La página de configuración permite modificar la configuración para phpMussel desde el front-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel se ofrece de forma gratuita, pero si quieres donar al proyecto, puede hacerlo haciendo clic en el botón donar.';
$phpMussel['lang']['tip_file_manager'] = 'Hola, {username}.<br />El administración de archivos permite eliminar, editar, subir y descargar de archivos. Utilizar con precaución (podría romper su instalación con esto).';
$phpMussel['lang']['tip_home'] = 'Hola, {username}.<br />Esta es la página principal para el front-end de phpMussel. Seleccione un enlace en el menú de navegación de la izquierda para continuar.';
$phpMussel['lang']['tip_login'] = 'El usuario estándar: <span class="txtRd">admin</span> – La contraseña estándar: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Hola, {username}.<br />Seleccionar un archivo de registro de la lista siguiente para ver el contenido de ese archivo de registro.';
$phpMussel['lang']['tip_quarantine'] = 'Hola, {username}.<br />Esta página enumera todos los archivos actualmente en cuarentena y facilita la administración de esos archivos.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Nota: La cuarentena está actualmente deshabilitada, pero puede habilitarse a través de la página de configuración.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Ver la <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.es.md#SECTION7">documentación</a> para obtener información sobre las distintas directivas de la configuración y sus propósitos.';
$phpMussel['lang']['tip_statistics'] = 'Hola, {username}.<br />Esta página muestra algunas estadísticas de uso básicas relacionadas con la instalación de phpMussel.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Nota: El seguimiento de estadísticas está actualmente deshabilitado, pero se puede habilitar a través de la página de configuración.';
$phpMussel['lang']['tip_updates'] = 'Hola, {username}.<br />La página de actualizaciones permite instalar, desinstalar y actualizar los diversos componentes de phpMussel (el paquete básico, firmas, plugins, archivos de L10N, etc).';
$phpMussel['lang']['tip_upload_test'] = 'Hola, {username}.<br />La página para subir pruebas contiene un formulario de subir de archivos estándar, permite probar si un archivo normalmente se bloquea por phpMussel cuando intentar subirlo.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Cuentas';
$phpMussel['lang']['title_config'] = 'phpMussel – Configuración';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Administración de Archivos';
$phpMussel['lang']['title_home'] = 'phpMussel – Página Principal';
$phpMussel['lang']['title_login'] = 'phpMussel – Login';
$phpMussel['lang']['title_logs'] = 'phpMussel – Archivos de Registro';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Cuarentena';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Estadística';
$phpMussel['lang']['title_updates'] = 'phpMussel – Actualizaciones';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Subir Prueba';
$phpMussel['lang']['warning'] = 'Advertencias:';
$phpMussel['lang']['warning_php_1'] = '¡Su versión de PHP no es apoyado activamente más! Se recomienda actualizar!';
$phpMussel['lang']['warning_php_2'] = '¡Su versión de PHP es muy vulnerable! Se recomienda encarecidamente actualizar!';
$phpMussel['lang']['warning_signatures_1'] = '¡No hay archivos de firma activos!';

$phpMussel['lang']['info_some_useful_links'] = 'Algunos enlaces útiles:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">Los problemas de phpMussel @ GitHub</a> – Página de problemas para phpMussel (apoyo, asistencia, etc).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Foro de discusión para phpMussel (apoyo, asistencia, etc).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Alternative download mirror for phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Una colección de sencillas herramientas de webmaster para proteger sitios web.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – Página principal de ClamAV (ClamAV® es un motor antivirus de código abierto para detectar troyanos, virus, malware y otras amenazas maliciosas).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Compañía de seguridad informática que ofrece firmas complementarias para ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Base de datos de phishing utilizada por el escáner URL de phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP recursos de aprendizaje y discusión.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP recursos de aprendizaje y discusión.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal es un servicio gratuito para analizar archivos y URL sospechosos.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis es un servicio gratuito para analizar malware proporcionado por <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Especialistas informáticos contra malware.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Útiles foros de discusión enfocados en el malware.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Listas de vulnerabilidades</a> – Lista las versiones seguras/inseguras de varios paquetes (PHP, HHVM, etc).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Listas de compatibilidades</a> – Lista información de compatibilidad para varios paquetes (CIDRAM, phpMussel, etc).</li>
        </ul>';
