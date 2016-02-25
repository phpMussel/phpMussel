## Documentación para phpMussel (Español).

### Contenidos
- 1. [PREÁMBULO](#SECTION1)
- 2A. [CÓMO INSTALAR (PARA NAVEGADORES)](#SECTION2A)
- 2B. [CÓMO INSTALAR (PARA CLI)](#SECTION2B)
- 3A. [CÓMO USO (PARA NAVEGADORES)](#SECTION3A)
- 3B. [CÓMO USO (PARA CLI)](#SECTION3B)
- 4A. [NAVEGADOR COMANDOS](#SECTION4A)
- 4B. [CLI (COMANDOS LÍNEA INTERFAZ)](#SECTION4B)
- 5. [ARCHIVOS INCLUIDOS EN ESTE PAQUETE](#SECTION5)
- 6. [CONFIGURACIÓN OPCIONES](#SECTION6)
- 7. [FIRMA FORMATOS](#SECTION7)
- 8. [CONOCIDOS PROBLEMAS DE COMPATIBILIDAD](#SECTION8)

---


###1. <a name="SECTION1"></a>PREÁMBULO

Gracias por usar phpMussel, un PHP script diseñado para detectar troyanos, virus, malware y otras amenazas en los archivos subidos en el sistema donde el script está adjunto, basado en las firmas de ClamAV y otros.

PHPMUSSEL COPYRIGHT 2013 y más allá GNU/GPLv2 por Caleb M (Maikuolan).

Este script es gratis software; puede redistribuirlo y/o modificarlo según los términos de la GNU General Pública Licencia como publicada por la Free Software Foundation; versión 2 de la licencia, o cualquier posterior versión. Este script se distribuye con la esperanza de que será útil, pero SIN NINGUNA GARANTÍA; también, sin ninguna implícita garantía de COMERCIALIZACIÓN o IDONEIDAD PARA UN PARTICULAR PROPÓSITO. Vea la GNU General Pública Licencia para más detalles, ubicado en el `LICENSE.txt` archivo y disponible también de:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Un especial agradecimiento a [ClamAV](http://www.clamav.net/) para la inspiración del proyecto y para las firmas que este script utiliza, sin la cual, la script probablemente no existiría, o en el mejor de, tendría un muy limitado valor.

Un especial agradecimiento a Sourceforge y GitHub para alojar los archivos de proyecto, a [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) para la phpMussel discusión foros, y a las adicionales fuentes de un número de las firmas utilizadas por phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) y otros, y agradecimiento especial a todos aquellos que apoyan el proyecto, a cualquier otra persona que yo haya olvidado de lo contrario mencionar, y a usted, por el uso de la script.

Este documento y asociado paquete pueden descargado de gratis desde:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>CÓMO INSTALAR (PARA NAVEGADORES)

Espero para agilizar este proceso al hacer un instalador en algún momento en un futuro no muy lejano, pero hasta entonces, siga estas instrucciones para ha phpMussel functione en *mayoría de sistemas y CMS:

1) Con tu leyendo esto, estoy asumiendo que usted ha descargado una copia de la script, descomprimido y tenerlo en algún lugar en su computer. Desde aquí, usted querrá averiguar dónde en el host o CMS que desea para colocar el contenido. Un directorio como `/public_html/phpmussel/` o similar (aunque, no importa que usted elija, a condición de que se algo que estés satisfecho con) será suficiente. *Antes usted enviar archivos a su host, seguir leyendo..*

2) Opcionalmente (muy recomendable para avanzados usuarios, pero no se recomienda para los principiantes o para los inexpertos), abrir `phpmussel.ini` (situado en el interior del `vault`) - Este archivo contiene todas las disponibles operativas opciones para phpMussel. Por encima de cada opción debe ser un breve comentario que describe lo que hace y para lo qué sirve. Ajuste estas opciones según sus necesidades, según lo que sea apropiado para su particular configuración. Guardar archivo, cerrar.

3) Cargar contenidos (phpMussel y sus archivos) al directorio que habías decidido sobre más temprano (los `*.txt`/`*.md` archivos no son necesarios, pero, en su mayoría, usted debe cargar todos).

4) CHMOD al `vault` directorio a "777". La principal directorio de almacenamiento de los contenidos (el uno decidió desde antes), en general, puede dejar solos, pero CHMOD estado debe ser comprobado si ha tenido problemas de permisos en el pasado en su sistema (predefinido, debería ser algo como "755").

5) Luego, tendrás que phpMussel "gancho" para el sistema o CMS. Hay varias maneras en que usted puede "gancho" scripts como phpMussel a su sistema o CMS, pero lo más fácil es simplemente incluir el script al principio de un núcleo archivo de su sistema o CMS (uno que va en general siempre sera cargado cuando alguien accede cualquier página a través de su website) utilizando un `require` o `include` declaración. Por lo general, esto sera algo almacenado en un directorio como `/includes`, `/assets` o `/functions`, y será menudo llamado algo así como `init.php`, `common_functions.php`, `functions.php` o similar. Vas a tener que averiguar qué archivo se por su situación; Si se encuentra con dificultades en la determinación de esto por ti mismo, visite los phpMussel foros de soporte y háganos saber; Es posible que sea yo u otro usuario puede tener experiencia con el CMS que está utilizando (que necesita para hacernos saber que CMS está utilizando), y por lo tanto, puede ser capaz de proporcionar alguna ayuda en esta área. Para ello [utilizar `require` o `include`], inserte la siguiente línea de código al principio de ese núcleo archivo, con sustitución de la string contenida dentro las comillas con la exacta dirección del `phpmussel.php` archivo (local dirección, no la HTTP dirección; que será similar a la `vault` dirección mencionó anteriormente).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Guardar archivo, cerrarla, resubir.

-- O ALTERNATIVAMENTE --

Si está utilizando un Apache web servidor y si usted tiene acceso a `php.ini`, puede utilizar la `auto_prepend_file` directiva para anteponer phpMussel cuando cualquier PHP solicitud se recibe. Algo como:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

O esto en el `.htaccess` archivo:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de que está funcionando correctamente. Para probar archivos subidos protecciones, probar subir los prueba archivos incluidos en el paquete dentro `_testfiles` a su website a través de sus habituales navegador basado subir métodos. Si todo funciona correctamente, un mensaje debe aparecer de phpMussel confirmando que la subido ha sido bloqueada con éxito. Si nada aparece, algo no está funcionando correctamente. Si está utilizando cualquiera de las avanzadas funciones o si está utilizandolos otros tipos de escaneo posible, Sugiero probarlo con aquellos a asegurarse de que funciona como se espera, también.

---


###2B. <a name="SECTION2B"></a>CÓMO INSTALAR (PARA CLI)

Espero para agilizar este proceso al hacer un instalador en algún momento en un futuro no muy lejano, pero hasta entonces, siga estas instrucciones para ha phpMussel listo para trabajar con CLI (ser conscientes de que en este momento, CLI apoyo sólo se aplica a los Windows basados sistemas; Linux y otros sistemas vendrán pronto a una posterior versión de phpMussel):

1) Con tu leyendo esto, estoy asumiendo que usted ha descargado una copia de la script, descomprimido y tenerlo en algún lugar en su computer. Cuando se ha determinado que usted es feliz con el lugar elegido para phpMussel, continuar.

2) phpMussel requiere PHP para ser instalado en la host máquina para ejecutar. Si usted no has PHP instalado en su máquina, por favor, instalar PHP en su máquina, siguiendo las instrucciones suministradas por el PHP instalador.

3) Opcionalmente (muy recomendable para avanzados usuarios, pero no se recomienda para los principiantes o para los inexpertos), abrir `phpmussel.ini` (situado en el interior del `vault`) - Este archivo contiene todas las disponibles operativas opciones para phpMussel. Por encima de cada opción debe ser un breve comentario que describe lo que hace y para lo qué sirve. Ajuste estas opciones según sus necesidades, según lo que sea apropiado para su particular configuración. Guardar archivo, cerrar.

4) Opcionalmente, usted puede hacer uso de phpMussel en CLI modo más fácil para ti mismo mediante la creación de un batch archivo para automáticamente cargar PHP y phpMussel. Para ello, abra un texto editor como Notepad o Notepad++, escriba la completa ruta al `php.exe` archivo dentro lo directorio de la PHP instalación, seguido de un espacio, seguido de la completa ruta al `phpmussel.php` archivo dentro lo directorio de su phpMussel instalación, guardar el archivo con la ".bat" extensión en alguna parte que usted lo encontrará fácilmente, y haga doble clic en ese archivo para ejecutar phpMussel en el futuro.

5) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de que está funcionando correctamente. Para probar phpMussel, ejecute phpMussel e probar escanear el directorio `_testfiles` suministrada con el paquete.

---


###3A. <a name="SECTION3A"></a>CÓMO USO (PARA NAVEGADORES)

phpMussel es un script diseñado para funcionar adecuadamente, inmediatamente, con mínimo nivel de requisitos en su nombre: Cuando se ha instalado, básicamente, lo simplemente debería funcionar.

Escaneo de archivos subidos es automatizado y activado como estándar, así, nada se requerida en su nombre por esta particular función.

Pero, también es capaz instruirá phpMussel para escanear específicos archivos, directorios y/o compactados archivos. Para ello, primeramente, usted tendrá asegurarse de que la adecuada configuración se establece el la `phpmussel.ini` archivo (`cleanup` debe estar desactivado), y cuando hecho, en un PHP archivo conectado a phpMussel, utilice la siguiente función en su código:

`phpMussel($what_to_scan,$output_type,$output_flatness);`

- `$what_to_scan` puede ser una cadena, una matriz o una matriz de matrices, e indica qué archivo, archivos, directorio y/o directorios a escanear.
- `$output_type` es un booleano, indicando el formato de los resultados del análisis para ser devueltos como. False instruye la función para devolver resultados como un entero (un resultado devuelto de -3 indica se encontraron problemas con el phpMussel firmas archivos o firmas mapas archivos y que sea posible pueden faltar o dañado, -2 indica que se ha corruptos datos detectados durante el escanear y por lo tanto el escanear no pudo completar, -1 indica que las extensiones o complementos requeridos por PHP para ejecutar el escaneo faltaban y por lo tanto el escanear no pudo completar, 0 indica que la escanear objetivo no existe y por lo tanto no había nada para escanear, 1 indica que el objetivo fue escaneado con éxito y no se detectaron problemas, y 2 indica que el objetivo fue escaneado con éxito y se detectaron problemas). True instruye la función para devolver resultados como texto legible por humanos. Además, en cualquier caso, los resultados pueden ser acceder a través de globales variables después escaneo ha completado. Esta variable es opcional, predefinido como false.
- `$output_flatness` es un booleano, indicando a la función si se deben devolver los resultados de la escaneo (cuando hay varios objetivos a escanear) como una matriz o una cadena. False devolverá los resultados como una matriz. True devolverá los resultados como una cadena. Esta variable es opcional, predefinido como false.

Ejemplos:

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

Devuelve algo como esto (como una cadena):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Iniciado.
 > Comprobando '/user_name/public_html/my_file.html':
 -> No problemas encontrado.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminado.
```

Para una descripción completa del tipo de firmas phpMussel utiliza durante el escanear y la forma en que maneja estas firmas, consulte la sección Firma Formatos de este README archivo.

Si se encuentra algún falsos positivos, si se encuentra con algo nuevo que crees que debería ser bloqueada, o para cualquier otra cosa en relación con las firmas, por favor contacto conmigo al respecto para que pueda hacer los cambios necesarios, para que, si no se comunica conmigo, posiblemente no necesariamente tener en cuenta.

Para desactivar las firmas que se incluyen con phpMussel (por ejemplo, si usted está experimentando un falso positivo específico para sus propósitos que normalmente no debería ser suprimido), consulte las notas de la Greylist en el Navegador Comandos sección de este README archivo.

Además del escaneo de archivos subidos y la opcional escaneo de otros archivos y/o directorios especificados a través de la función anterior, incluido en phpMussel es una función con el propósito para escanear el cuerpo de los email mensajes. Esta función se comporta de manera similar del estándar phpMussel() función, excepto centra únicamente contra las email basadas ClamAV firmas. No he conectada estas firmas en el estándar phpMussel() función, debido a que es improbable que usted encontrar el cuerpo de un entrante email mensaje en la necesidad el escaneo dentro un archivo subido dirigido a una página donde phpMussel está conectado, y por lo tanto, para conectar estas firmas en la phpMussel() función sería redundante. Pero, dicho esto, si tener una separada función contra estas firmas podría ser muy útil por algunos, especialmente por aquellos cuyos CMS o web sistema está conectado de alguna manera en su email sistema y para aquellos de los cuales analizar sus email mensajes a través de una PHP script de los que potencialmente podrían conectar en phpMussel. Configuración para esta función, como todos los demás, es controlado a través de `phpmussel.ini` archivo. Para utilizar esta función (va necesita para hacer su propia implementación), en una PHP archivo que está conectado a phpMussel, utilizar la siguiente función en el código:

`phpMussel_mail($cuerpo);`

Donde $cuerpo es el cuerpo del email mensaje que desea escanear (además, podría intentar escanear nuevos mensajes en su foro, los mensajes entrantes de su online contacto form o similar). Si se produce algún error que impide la función de completar su escanear, valor de -1 serán devueltos. Si la función completa su escanear y no encuentra nada, valor de 0 serán devueltos (que significa es limpio). Pero, si la función encontrar algo, una string será devuelta contiene un mensaje declarando lo que ha encontrado.

Además de lo anterior, si nos fijamos en el código fuente, es posible que observe las funciones phpMusselD() y phpMusselR(). Estas funciones son subfunciones de phpMussel(), y no debe ser llamado directamente fuera de esa madre función (no a causa de adversos efectos.. Más, porque no serviría cualquier propósito, y probablemente no será en realidad funcione correctamente).

Hay muchos otros controles y funciones disponibles dentro phpMussel para su uso, también. Para cualquier controles y funciones para los cuales, para el final de esta sección del README, todavía no se han documentado, por favor siga leyendo y se refieren a los Navegador Comandos sección de este README archivo.

---


###3B. <a name="SECTION3B"></a>CÓMO USO (PARA CLI)

Por favor, consulte la sección "CÓMO INSTALAR (PARA CLI)" de este README.

Tenga en cuenta que, aunque las futuras versiones de phpMussel deben apoyar otros sistemas, en este momento, phpMussel CLI modo compatibilidad sólo está optimizado para su uso en sistemas basados en Windows (por supuesto, usted puede probarlo en otros sistemas, pero no puedo garantizar que va funcionar como es debido).

También tenga en cuenta que phpMussel no es el funcional equivalente de una completa anti-virus suite, y no como convencionales anti-virus suites, no supervisa la memoria activa o detectar virus fuera del alcance de su acceso! Es sólo detecta virus contenidos en los archivos específicos explícitamente para escaneo.

---


###4A. <a name="SECTION4A"></a>NAVEGADOR COMANDOS

Cuando phpMussel está instalado y funciona correctamente en su sistema, si ha configurado las variables `script_password` y `logs_password` en la configuración archivo, usted será capaz de realizar un limitado número de administrativas funciones y entrar de un número de comandos a phpMussel través de su navegador. La razón que estas contraseñas deben definida a fin de que estos navegador controles es para garantizar adecuada seguridad, adecuada protección para estos navegador controles y para asegurar que existe una manera en que estos navegador controles puede estar desactivado en su totalidad si no se desean por usted y/o otros webmasters/administradores usando phpMussel. Por lo tanto, en otras palabras, para permitir estos controles, definir un contraseña, y para desactivar estos controles, no definir ninguna contraseña. Alternativamente, si usted decide para activar estos controles y luego optar para desactivar estos controles en una fecha posterior, hay un comando para hacerlo (tal puede ser útil si realiza algunas acciones que usted se sienta potencialmente podrían comprometer las contraseñas delegadas y necesitas de desactivar rápidamente estos controles sin modificar la configuración archivo).

Algunas de las razones por las que _**DEBE**_ permitir estos controles:
- Proporciona una fácil manera de greylist firmas en casos tales como cuando se descubre una firma que se produce un falso positivo mientras que subir archivos a su sistema y usted no tiene tiempo para editar manualmente y resubir su archivo de greylist firmas.
- Proporciona una fácil manera de usted permite que alguien no sea usted para controlar su copia de phpMussel sin el implícita necesidad de concederles acceso a FTP.
- Proporciona una fácil manera para proporcionar acceso controlado a los registros archivos.
- Proporciona una fácil manera para actualizar phpMussel cuando haya actualizaciones disponibles.
- Proporciona una fácil manera para monitorizar phpMussel cuando el FTP acceso u otros puntos de convencional acceso para el monitoreo de phpMussel no están disponibles.

Algunas de las razones por las que _**NO**_ debe permitir estos controles:
- Proporciona un vector para atacantes y indeseables para determinar si se o no que está utilizando phpMussel (aunque, esto podría ser una razón de apoyar y/o una razón contra, dependiendo de la perspectiva) por forma de enviar ciegas comandos a los servidores como una forma de sondear. Por un lado, esto podría desalentar atacantes de la focalización de su sistema si se enteran de que está utilizando phpMussel, suponiendo que se están sondando porque su método de ataque es ineficaz como resultado del uso de phpMussel. En el otro lado, si algún imprevisto y desconoce en la actualidad explotan dentro phpMussel o una versión futura del mismo sale a la luz, y si podría potencialmente proporcionar un vector de ataque, un resultado positivo de tal sondando podría alentar atacantes para la focalización de su sistema.
- Si sus contraseñas delegados fueron en alguna vez comprometidos, menos que se modifiquen, podría proporcionar una manera para que un atacante para eludir cualquier firmas puede ser de otra manera normalmente prevenir sus ataques tengan éxito, o potencialmente desactivar phpMussel enteramente, así proporcionando una manera de hacer que la eficacia de phpMussel nulo y sin efecto.

En cualquier manera, independientemente de lo que usted elija, la decisión es siempre tuyo. Por predefinido, estos controles se desactivado, pero tienen un pensar en ello, y si usted decide que los quiere, esta sección explica cómo activarlos y cómo usarlos.

Una lista de los comandos disponibles del navegador:

scan_log
- Contraseña necesario: `logs_password`
- Otros requisitos: scan_log necesario ser definido.
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?logspword=[logs_password]&phpmussel=scan_kills`
- Qué hace: Imprime el contenido de su scan_log archivo a la pantalla.

scan_kills
- Contraseña necesario: `logs_password`
- Otros requisitos: scan_kills necesario ser definido.
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?logspword=[logs_password]&phpmussel=scan_kills`
- Qué hace: Imprime el contenido de su scan_kills archivo a la pantalla.

controls_lockout
- Contraseña necesario: `logs_password` O `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Example 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Example 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Qué hace: Desactiva todos los controles del navegador. Esto se debe utilizar si sospecha que alguna de las contraseñas se han comprometido (esto puede ocurrir si usted está utilizando estos controles desde un computadora que no es de confianza y/o no es seguro). controls_lockout funciones mediante la creación de un archivo, `controls.lck`, en su vault, que phpMussel comprobará antes de realizar cualquier comandos de ningún tipo. Cuando esto sucede, para reactivar estos controles, tendrá que suprimir manualmente la `controls.lck` archivo a través de FTP o similar. Puede ser llamado usando cualquiera de las contraseñas.

disable
- Contraseña necesario: `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=disable`
- Qué hace: Desactivar phpMussel. Esto debe ser utilizar si usted está realizando cualquier actualizaciones o cambios en su sistema o si usted está instalar cualquier nuevo software o módulos para su sistema que potencialmente podrían o hacer desencadenar falsos positivos. Esto también debe usar si usted está teniendo problemas con phpMussel pero no desean eliminarlo de su sistema. Si esto sucede, para reactivar phpMussel, usar "enable".

enable
- Contraseña necesario: `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=enable`
- Qué hace: Activar phpMussel. Esto debe ser utilizar si usted ha desactivado anteriormente phpMussel usando "disable" y quiere reactivarla.

update
- Contraseña necesario: `script_password`
- Otros requisitos: `update.dat` y `update.inc` deben existir.
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=update`
- Qué hace: Comprobar por actualizaciones para ambos phpMussel y sus firmas. Si las actualizaciones comprobar tienen éxito y actualizaciones está encuentran, intentará descargar e instalar estas actualizaciones. Si las actualizaciones comprobar fallan, actualizaciones comprobar abortará. Los resultados de todo el proceso se imprimen en la pantalla. Recomiendo comprobar al menos una vez por mes para asegurar que sus firmas y su copia de phpMussel se mantienen actualizada (a menos que, naturalmente, usted está comprobando las actualizaciones e instalandolos manualmente, que, aun así sigo recomendando hacer al menos una vez por mes). Comprobar más de dos veces por mes es probablemente inútil, en consideración que estoy muy improbable de ser capaz de producir actualizaciones de cualquier tipo con más frecuencia que la (ni tengo particular quiero para hacerlo en la mayor parte).

greylist
- Contraseña necesario: `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: [Nombre de la firma para la greylist]
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=greylist&musselvar=[Firma]`
- Qué hace: Agregar una firma a la greylist.

greylist_clear
- Contraseña necesario: `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=greylist_clear`
- Qué hace: Borrar toda de la greylist.

greylist_show
- Contraseña necesario: `script_password`
- Otros requisitos: (nada)
- Parámetros necesarios: (nada)
- Parámetros opcionales: (nada)
- Ejemplo: `?pword=[script_password]&phpmussel=greylist_show`
- Qué hace: Imprime el contenido de la greylist a la pantalla.

---


###4B. <a name="SECTION4B"></a>CLI (COMANDOS LÍNEA INTERFAZ)

phpMussel se puede ejecutar como un interactivo archivos escáner en CLI modo dentro sistemas basados en Windows. Consulte el "CÓMO INSTALAR (PARA CLI)" sección de este README archivo para más detalles.

Para obtener una lista de los disponibles CLI comandos, para el CLI aviso, escribir 'c', y pulse Enter.

---


###5. <a name="SECTION5"></a>ARCHIVOS INCLUIDOS EN ESTE PAQUETE

La siguiente es una lista de todos los archivos que debería haberse incluido en la copia de este script cuando descargado, todos los archivos que pueden ser potencialmente creados como resultado de su uso de este script, junto con una breve descripción de lo que todos estos archivos son para.

Archivo | Descripción
----|----
/.gitattributes | Un archivo de la GitHub proyecto (no se requiere para usar la script).
/composer.json | Composer/Packagist información (no se requiere para usar la script).
/CONTRIBUTING.md | Información en respecto a cómo contribuir al proyecto.
/LICENSE.txt | Una copia de la GNU/GPLv2 licencia.
/PEOPLE.md | Información en respecto a las personas involucradas en el proyecto.
/phpmussel.php | Cargador (cargar el principal script, el actualizador, etcétera). Esto es lo que se supone debe enganchando (esencial)!
/README.md | Sumario información del proyecto.
/web.config | Un ASP.NET configuración archivo (en este caso, para proteger la `/vault` directorio contra el acceso de fuentes no autorizadas en el caso de que la script está instalado en un servidor basado en ASP.NET tecnologías).
/_docs/ | Documentación directorio (contiene varios archivos).
/_docs/change_log.txt | Un registro de los cambios realizados en la principal script entre las diferentes versiones (no se requiere para usar la script).
/_docs/readme.ar.md | Documentación Árabe.
/_docs/readme.de.md | Documentación Alemán.
/_docs/readme.de.txt | Documentación Alemán.
/_docs/readme.en.md | Documentación Inglés.
/_docs/readme.en.txt | Documentación Inglés.
/_docs/readme.es.md | Documentación Español.
/_docs/readme.es.txt | Documentación Español.
/_docs/readme.fr.md | Documentación Francés.
/_docs/readme.fr.txt | Documentación Francés.
/_docs/readme.id.md | Documentación Indonesio.
/_docs/readme.id.txt | Documentación Indonesio.
/_docs/readme.it.md | Documentación Italiano.
/_docs/readme.it.txt | Documentación Italiano.
/_docs/readme.nl.md | Documentación Holandés.
/_docs/readme.nl.txt | Documentación Holandés.
/_docs/readme.pt.md | Documentación Portugués.
/_docs/readme.pt.txt | Documentación Portugués.
/_docs/readme.ru.md | Documentación Ruso.
/_docs/readme.ru.txt | Documentación Ruso.
/_docs/readme.vi.md | Documentación Vietnamita.
/_docs/readme.vi.txt | Documentación Vietnamita.
/_docs/readme.zh-TW.md | Documentación Chino (Tradicional).
/_docs/readme.zh.md | Documentación Chino (Simplificado).
/_docs/signatures_tally.txt | Cifra neta de cambio de las incluidas firmas (no se requiere para usar la script).
/_testfiles/ | Prueba archivos directorio (contiene varios archivos). Todos los archivos contenidos son prueba archivos para probando si phpMussel ha sido instalado correctamente en su sistema, y que no es necesario subir este directorio o cualquiera de sus archivos excepto cuando haciendo tales pruebas.
/_testfiles/ascii_standard_testfile.txt | Prueba archivo para probando phpMussel normalizados ASCII firmas.
/_testfiles/coex_testfile.rtf | Prueba archivo para probando phpMussel complejos extendidas firmas.
/_testfiles/exe_standard_testfile.exe | Prueba archivo para probando phpMussel PE firmas.
/_testfiles/general_standard_testfile.txt | Prueba archivo para probando phpMussel generales firmas.
/_testfiles/graphics_standard_testfile.gif | Prueba archivo para probando phpMussel gráficas firmas.
/_testfiles/html_standard_testfile.html | Prueba archivo para probando phpMussel normalizados HTML firmas.
/_testfiles/md5_testfile.txt | Prueba archivo para probando phpMussel MD5 firmas.
/_testfiles/metadata_testfile.tar | Prueba archivo para probando phpMussel metadatos firmas y para probando TAR archivo apoyo en su sistema.
/_testfiles/metadata_testfile.txt.gz | Prueba archivo para probando phpMussel metadatos firmas y para probando GZ archivo apoyo en su sistema.
/_testfiles/metadata_testfile.zip | Prueba archivo para probando phpMussel metadatos firmas y para probando ZIP archivo apoyo en su sistema.
/_testfiles/ole_testfile.ole | Prueba archivo para probando phpMussel OLE firmas.
/_testfiles/pdf_standard_testfile.pdf | Prueba archivo para probando phpMussel PDF firmas.
/_testfiles/pe_sectional_testfile.exe | Prueba archivo para probando phpMussel PE Secciónal firmas.
/_testfiles/swf_standard_testfile.swf | Prueba archivo para probando phpMussel SWF firmas.
/_testfiles/xdp_standard_testfile.xdp | Prueba archivo para probando phpMussel XML/XDP firmas.
/vault/ | Vault directorio (contiene varios archivos).
/vault/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/cache/ | Cache directorio (para los datos temporal).
/vault/cache/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/cli.inc | Módulo de la CLI.
/vault/config.inc | Módulo de configuración.
/vault/controls.inc | Módulo de controles.
/vault/functions.inc | Archivo de funciones (esencial).
/vault/greylist.csv | CSV de las firmas en la Greylist indicando para phpMussel las firmas que deben ser ignorados (archivo será recreado automáticamente si eliminado).
/vault/lang.inc | Lingüísticos datos.
/vault/lang/ | Contiene lingüísticos datos.
/vault/lang/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/lang/lang.ar.inc | Lingüísticos datos Árabe.
/vault/lang/lang.de.inc | Lingüísticos datos Alemán.
/vault/lang/lang.en.inc | Lingüísticos datos Inglés.
/vault/lang/lang.es.inc | Lingüísticos datos Español.
/vault/lang/lang.fr.inc | Lingüísticos datos Francés.
/vault/lang/lang.id.inc | Lingüísticos datos Indonesio.
/vault/lang/lang.it.inc | Lingüísticos datos Italiano.
/vault/lang/lang.ja.inc | Lingüísticos datos Japonés.
/vault/lang/lang.nl.inc | Lingüísticos datos Holandés.
/vault/lang/lang.pt.inc | Lingüísticos datos Portugués.
/vault/lang/lang.ru.inc | Lingüísticos datos Ruso.
/vault/lang/lang.vi.inc | Lingüísticos datos Vietnamita.
/vault/lang/lang.zh-TW.inc | Lingüísticos datos Chino (Tradicional).
/vault/lang/lang.zh.inc | Lingüísticos datos Chino (Simplificado).
/vault/phpmussel.ini | Configuración archivo; Contiene todas las configuración opciones para phpMussel, instruyendo para qué hacer y cómo operar correctamente (esencial)!
/vault/quarantine/ | Directorio de cuarentena (contiene los cuarentenadas archivos).
/vault/quarantine/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
※ /vault/scan_kills.txt | Un registro de todos archivos subidos bloqueado/asesinado por phpMussel.
※ /vault/scan_log.txt | Un registro de todo escaneado por phpMussel.
※ /vault/scan_log_serialized.txt | Un registro de todo escaneado por phpMussel.
/vault/signatures/ | Directorio de firmas (contiene los archivos de firmas).
/vault/signatures/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/signatures/ascii_clamav_regex.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_clamav_regex.map | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_clamav_standard.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_clamav_standard.map | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_custom_regex.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_custom_standard.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_mussel_regex.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/ascii_mussel_standard.cvd | Archivo para normalizados ASCII firmas.
/vault/signatures/coex_clamav.cvd | Archivo para complejos extendidas firmas.
/vault/signatures/coex_custom.cvd | Archivo para complejos extendidas firmas.
/vault/signatures/coex_mussel.cvd | Archivo para complejos extendidas firmas.
/vault/signatures/elf_clamav_regex.cvd | Archivo para ELF firmas.
/vault/signatures/elf_clamav_regex.map | Archivo para ELF firmas.
/vault/signatures/elf_clamav_standard.cvd | Archivo para ELF firmas.
/vault/signatures/elf_clamav_standard.map | Archivo para ELF firmas.
/vault/signatures/elf_custom_regex.cvd | Archivo para ELF firmas.
/vault/signatures/elf_custom_standard.cvd | Archivo para ELF firmas.
/vault/signatures/elf_mussel_regex.cvd | Archivo para ELF firmas.
/vault/signatures/elf_mussel_standard.cvd | Archivo para ELF firmas.
/vault/signatures/exe_clamav_regex.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_clamav_regex.map | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_clamav_standard.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_clamav_standard.map | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_custom_regex.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_custom_standard.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_mussel_regex.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/exe_mussel_standard.cvd | Archivo para Portátil Ejecutable firmas.
/vault/signatures/filenames_clamav.cvd | Archivo para archivo nombre firmas.
/vault/signatures/filenames_custom.cvd | Archivo para archivo nombre firmas.
/vault/signatures/filenames_mussel.cvd | Archivo para archivo nombre firmas.
/vault/signatures/general_clamav_regex.cvd | Archivo para generales firmas.
/vault/signatures/general_clamav_regex.map | Archivo para generales firmas.
/vault/signatures/general_clamav_standard.cvd | Archivo para generales firmas.
/vault/signatures/general_clamav_standard.map | Archivo para generales firmas.
/vault/signatures/general_custom_regex.cvd | Archivo para generales firmas.
/vault/signatures/general_custom_standard.cvd | Archivo para generales firmas.
/vault/signatures/general_mussel_regex.cvd | Archivo para generales firmas.
/vault/signatures/general_mussel_standard.cvd | Archivo para generales firmas.
/vault/signatures/graphics_clamav_regex.cvd | Archivo para gráficas firmas.
/vault/signatures/graphics_clamav_regex.map | Archivo para gráficas firmas.
/vault/signatures/graphics_clamav_standard.cvd | Archivo para gráficas firmas.
/vault/signatures/graphics_clamav_standard.map | Archivo para gráficas firmas.
/vault/signatures/graphics_custom_regex.cvd | Archivo para gráficas firmas.
/vault/signatures/graphics_custom_standard.cvd | Archivo para gráficas firmas.
/vault/signatures/graphics_mussel_regex.cvd | Archivo para gráficas firmas.
/vault/signatures/graphics_mussel_standard.cvd | Archivo para gráficas firmas.
/vault/signatures/hex_general_commands.csv | Hex-codificado CSV de generales comandos detecciones opcionalmente utilizado por phpMussel.
/vault/signatures/html_clamav_regex.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/html_clamav_regex.map | Archivo para normalizados HTML firmas.
/vault/signatures/html_clamav_standard.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/html_clamav_standard.map | Archivo para normalizados HTML firmas.
/vault/signatures/html_custom_regex.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/html_custom_standard.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/html_mussel_regex.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/html_mussel_standard.cvd | Archivo para normalizados HTML firmas.
/vault/signatures/macho_clamav_regex.cvd | Archivo para Mach-O firmas.
/vault/signatures/macho_clamav_regex.map | Archivo para Mach-O firmas.
/vault/signatures/macho_clamav_standard.cvd | Archivo para Mach-O firmas.
/vault/signatures/macho_clamav_standard.map | Archivo para Mach-O firmas.
/vault/signatures/macho_custom_regex.cvd | Archivo para Mach-O firmas.
/vault/signatures/macho_custom_standard.cvd | Archivo para Mach-O firmas.
/vault/signatures/macho_mussel_regex.cvd | Archivo para Mach-O firmas.
/vault/signatures/macho_mussel_standard.cvd | Archivo para Mach-O firmas.
/vault/signatures/mail_clamav_regex.cvd | Archivo para mail firmas.
/vault/signatures/mail_clamav_regex.map | Archivo para mail firmas.
/vault/signatures/mail_clamav_standard.cvd | Archivo para mail firmas.
/vault/signatures/mail_clamav_standard.map | Archivo para mail firmas.
/vault/signatures/mail_custom_regex.cvd | Archivo para mail firmas.
/vault/signatures/mail_custom_standard.cvd | Archivo para mail firmas.
/vault/signatures/mail_mussel_regex.cvd | Archivo para mail firmas.
/vault/signatures/mail_mussel_standard.cvd | Archivo para mail firmas.
/vault/signatures/md5_clamav.cvd | Archivo para MD5 basadas firmas.
/vault/signatures/md5_custom.cvd | Archivo para MD5 basadas firmas.
/vault/signatures/md5_mussel.cvd | Archivo para MD5 basadas firmas.
/vault/signatures/metadata_clamav.cvd | Archivo para archivo metadatos firmas.
/vault/signatures/metadata_custom.cvd | Archivo para archivo metadatos firmas.
/vault/signatures/metadata_mussel.cvd | Archivo para archivo metadatos firmas.
/vault/signatures/ole_clamav_regex.cvd | Archivo para OLE firmas.
/vault/signatures/ole_clamav_regex.map | Archivo para OLE firmas.
/vault/signatures/ole_clamav_standard.cvd | Archivo para OLE firmas.
/vault/signatures/ole_clamav_standard.map | Archivo para OLE firmas.
/vault/signatures/ole_custom_regex.cvd | Archivo para OLE firmas.
/vault/signatures/ole_custom_standard.cvd | Archivo para OLE firmas.
/vault/signatures/ole_mussel_regex.cvd | Archivo para OLE firmas.
/vault/signatures/ole_mussel_standard.cvd | Archivo para OLE firmas.
/vault/signatures/pdf_clamav_regex.cvd | Archivo para PDF firmas.
/vault/signatures/pdf_clamav_regex.map | Archivo para PDF firmas.
/vault/signatures/pdf_clamav_standard.cvd | Archivo para PDF firmas.
/vault/signatures/pdf_clamav_standard.map | Archivo para PDF firmas.
/vault/signatures/pdf_custom_regex.cvd | Archivo para PDF firmas.
/vault/signatures/pdf_custom_standard.cvd | Archivo para PDF firmas.
/vault/signatures/pdf_mussel_regex.cvd | Archivo para PDF firmas.
/vault/signatures/pdf_mussel_standard.cvd | Archivo para PDF firmas.
/vault/signatures/pex_custom.cvd | Archivo para PE extendidas firmas.
/vault/signatures/pex_mussel.cvd | Archivo para PE extendidas firmas.
/vault/signatures/pe_clamav.cvd | Archivo para PE Secciónal firmas.
/vault/signatures/pe_custom.cvd | Archivo para PE Secciónal firmas.
/vault/signatures/pe_mussel.cvd | Archivo para PE Secciónal firmas.
/vault/signatures/swf_clamav_regex.cvd | Archivo para Shockwave firmas.
/vault/signatures/swf_clamav_regex.map | Archivo para Shockwave firmas.
/vault/signatures/swf_clamav_standard.cvd | Archivo para Shockwave firmas.
/vault/signatures/swf_clamav_standard.map | Archivo para Shockwave firmas.
/vault/signatures/swf_custom_regex.cvd | Archivo para Shockwave firmas.
/vault/signatures/swf_custom_standard.cvd | Archivo para Shockwave firmas.
/vault/signatures/swf_mussel_regex.cvd | Archivo para Shockwave firmas.
/vault/signatures/swf_mussel_standard.cvd | Archivo para Shockwave firmas.
/vault/signatures/switch.dat | Esto controla y establece ciertas variables.
/vault/signatures/urlscanner.cvd | Archivo para URL escáner firmas.
/vault/signatures/whitelist_clamav.cvd | Archivo específico whitelist.
/vault/signatures/whitelist_custom.cvd | Archivo específico whitelist.
/vault/signatures/whitelist_mussel.cvd | Archivo específico whitelist.
/vault/signatures/xmlxdp_clamav_regex.cvd | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_clamav_regex.map | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_clamav_standard.cvd | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_clamav_standard.map | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_custom_regex.cvd | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_custom_standard.cvd | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_mussel_regex.cvd | Archivo para XML/XDP firmas.
/vault/signatures/xmlxdp_mussel_standard.cvd | Archivo para XML/XDP firmas.
/vault/template.html | Plantilla archivo; Plantilla para HTML producida por phpMussel para sus bloqueados archivos subidos mensaje (el mensaje visto por el subidor).
/vault/template_custom.html | Plantilla archivo; Plantilla para HTML producida por phpMussel para sus bloqueados archivos subidos mensaje (el mensaje visto por el subidor).
/vault/update.dat | Archivo que contiene la versión información tanto para la phpMussel script y para la phpMussel firmas. Si alguna vez desea actualizar automáticamente phpMussel o desea actualizar phpMussel través de su navegador, este archivo es esencial.
/vault/update.inc | Actualización Script; Requerido para automáticas actualizaciones y para actualizando phpMussel través de su navegador, pero no es requerido por lo demás.
/vault/upload.inc | Módulo de carga.

※ Nombre del archivo puede variar basado de las estipulaciones de configuración (en `phpmussel.ini`).

####*RESPECTO A FIRMAS ARCHIVOS*
CVD es un acrónimo de "ClamAV Virus Definiciones", en referencia tanto a cómo ClamAV se refiere a sus propias firmas y al uso de esas firmas para phpMussel; Los archivos que terminan en "CVD" contienen firmas.

Los archivos que terminan en "MAP" instruyen phpMussel con respecto a las firmas que debe y no debe utilizarse para individuales escaneos; No todas las firmas se necesariamente requieren para cada individual escaneo, así, phpMussel utiliza mapas de los firmas archivos para acelerar el escaneo proceso (un proceso que, alternativamente, sería extremadamente lento y tedioso).

Firmas archivos marcados con "_regex" contienen firmas utilizando regulares expresiones patrones (regex).

Firmas archivos marcados con "_standard" contienen firmas que específicamente no utiliza ningún tipo de patrones.

Firmas archivos marcados con no "_regex" ni "_standard" será como uno o el otro, pero no ambos (consulte la FIRMA FORMATOS sección de este README archivo para la documentación y específicos detalles).

Firmas archivos marcados con "_clamav" contienen firmas que se obtenido enteramente de la base de datos de ClamAV (GNU/GPL).

Firmas archivos marcados con "_custom", por predefinido, no contienen cualquiera firmas; Existen estos dichos archivos para darle un lugar para colocar sus propios personalizadas firmas, si viene con cualquiera de su propia.

Firmas archivos marcados con "_mussel" contienen firmas que se obtenido específicamente no desde ClamAV, firmas que, en general, uno u otro, yo mismo he escrito y/o basado en la información obtenida de diversas fuentes.

---


###6. <a name="SECTION6"></a>CONFIGURACIÓN OPCIONES
La siguiente es una lista de variables encuentran en la `phpmussel.ini` configuración archivo de phpMussel, junto con una descripción de sus propósito y función.

####"general" (Categoría)
General configuración para phpMussel.

"script_password"
- Por la conveniencia, phpMussel permitirá ciertas funciones (incluyendo la capacidad de actualizar phpMussel) para ser desencadenado manualmente a través de POST, GET y QUERY. Pero dicho esto, como medida de seguridad, para hacer esto, phpMussel esperará una contraseña serán incluido con el comando, como para asegurarse de que usted es, y no otra persona, intentando desencadenar manualmente estas funciones. Definir `script_password` a cualquier contraseña que desea utilizar. Si no contraseña se define, desencadenando manualmente desactivará por predefinido. Utilice algo que recordará pero que se difícil de adivinar para otros.
- No tiene influencia en CLI modo.

"logs_password"
- El mismo como `script_password`, pero para ver el contenido de scan_log y scan_kills. Tener contraseñas separado puede ser útil si usted desea dar alguna otra persona acceso a un conjunto de funciones, pero no el otro. - No tiene influencia en CLI modo.

"cleanup"
- Despejar la variables y la caché de la script después la script ejecución? False = No; True = Sí [Predefinido]. Si usted no está utilizando la script más allá de inicial escaneando de archivos subidos, debe definir como `true` (sí), para minimizar el uso de memoria. Si usted está utilizando la script para propósitos más allá de inicial escaneando de archivos subidos, debe definir como `false` (no), para evitar recargar innecesariamente duplicados datos en la memoria. En general práctica, probablemente debería definirse como `true`, pero, si usted hace esto, usted no será capaz de utilizar la script para cualquier cosa otro que de escaneando archivos subidos.
- No tiene influencia en CLI modo.

"scan_log"
- Nombre del archivo para registrar todos los resultados de las escaneos. Especifique un archivo nombre, o dejar en blanco para desactivar.

"scan_log_serialized"
- Nombre del archivo para registrar todos los resultados de las escaneos (utilizando un formato serializado). Especifique un archivo nombre, o dejar en blanco para desactivar.

"scan_kills"
- Nombre del archivo para registrar todos bloqueados o matados subidos. Especifique un archivo nombre, o dejar en blanco para desactivar.

"ipaddr"
- Dónde encontrar el IP dirección de la conectando request? (Útil para servicios como Cloudflare y tales) Predefinido = REMOTE_ADDR. AVISO: No cambie esto a menos que sepas lo que estás haciendo!

"forbid_on_block"
- Debería phpMussel enviar 403 header con la bloqueados archivos subidos mensaje, o quedarse con los usual 200 OK? False = No (200) [Predefinido]; True = Sí (403).

"delete_on_sight"
- Activando esta directiva instruirá la script para intentar para eliminar inmediatamente cualquier escaneados intentados archivos subidos emparejando a los criterios de detección, si través de firmas o de otras maneras. Archivos determinados como limpia no serán tocados. En el caso de los compactados archivos, la totalidad del compactado archivo será eliminado (independientemente de si el emparejando archivo es sólo uno de muchos varios archivos contenida dentro del compactado archivo). Para el caso de archivo subir escaneo, en general, no es necesario activar esta directiva, porque en general, PHP purgará automáticamente el contenido de su caché cuando la ejecución ha terminado, significando que lo en general eliminará cualquier archivos subidos a través de él con el servidor a no ser que se han movido, copiado o eliminado ya. La directiva se añade aquí como una medida adicional de seguridad para aquellos cuyas copias de PHP no siempre se comportan de la manera esperada. False = Después escaneando, dejar el archivo solo [Predefinido]; True = Después escaneando, si no se limpia, eliminar inmediatamente.

"lang"
- Especifique la predefinido del lenguaje para phpMussel.

"lang_override"
- Especifique si phpMussel debería, cuando sea posible, reemplazar la especificación del lenguaje con el preferencia del lenguaje declarada por peticiones entrantes (HTTP_ACCEPT_LANGUAGE). False = No [Predefinido]; True = Sí.

"lang_acceptable"
- La `lang_acceptable` directiva instruye a phpMussel qué idiomas puede ser aceptada por el script de parte de `lang` o de parte de `HTTP_ACCEPT_LANGUAGE`. Esta directiva **SÓLO** debe ser modificada si va a añadir sus propios personalizados idiomas archivos o retirando por la fuerza los idiomas archivos. La directiva es una cadena separada por comas de los códigos utilizados por los idiomas aceptados por el script.

"quarantine_key"
- phpMussel es capaz de poner en cuarentena intentados archivos subidos en aisladamente dentro de la phpMussel vault, si esto es algo que usted quiere que haga. Usuarios casual de phpMussel de los cuales simplemente desean proteger sus website o hosting ambiente sin tener ningún interés con analizando profundamente cualquier marcados intentados archivos subidos debería dejar esta funcionalidad desactivado, pero cualquier usuarios interesados en más análisis de marcados intentados archivos subidos para la investigación de malware o para cosas similares debe activar esta funcionalidad. Cuarentenando de marcados intentados archivos subidos a veces puede también ayudar en la depuración de falsos positivos, si esto es algo que ocurre con frecuencia para usted. Para desactivar la cuarentena funcionalidad, simplemente dejar la directiva `quarantine_key` vacío, o borrar el contenidos de que directiva si no está ya vacío. Para activar la cuarentena funcionalidad, entrar algún valor en la directiva. La `quarantine_key` es un importante característica de seguridad de la cuarentena funcionalidad requiere como un medio para la prevención de la explotación de la cuarentena funcionalidad por potenciales atacantes y como un medio de evitar cualquier potencial ejecución de los datos almacenados dentro la cuarentena. La `quarantine_key` debería ser tratado de la misma manera que sus contraseñas: El más grande es el mejor, y guárdela bien. Para un mejor efecto, utilice conjuntamente con `delete_on_sight`.

"quarantine_max_filesize"
- El máximo archivo tamaño permitido para archivos para ser cuarentenada. Archivos que superen el valor especificado aquí NO serán cuarentenada. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su hosting servicio. Valor es en KB. Predefinido =2048 =2048KB =2MB.

"quarantine_max_usage"
- El máxima uso de memoria permitida para la cuarentena. Si la total memoria utilizada por la cuarentena alcanza este valor, los más antiguos cuarentenado archivos serán eliminado hasta que la total memoria utilizada ya no alcanza este valor. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su hosting servicio. Valor es en KB. Predefinido =2048 =2048KB =2MB.

"honeypot_mode"
- Cuando la honeypot modo está activado, phpMussel intentará cuarentenar cada archivos subidos que encuentra, independientemente de si o no el archivo que se está subido coincide con las firmas incluídas, y no real escanear o análisis de esos intentados archivos subidos van a ocurrir. Esta funcionalidad debe ser útil para aquellos que deseen utilizar phpMussel a los efectos del virus/malware investigación, pero no se recomendado activar esta funcionalidad si el uso de phpMussel por el usuario es para real archivo subido escaneando ni recomendado usar la honeypot funcionalidad para fines otro que de la honeypot. Por predefinido, esta opción está desactivada. False = Desactivado [Predefinido]; True = Activado.

"scan_cache_expiry"
- Por cuánto tiempo debe phpMussel caché de los resultados del escaneo? El valor es el número de segundos para almacenar en caché los resultados del escaneo. La predeterminado valor es 21600 segundos (6 horas); Un valor de 0 desactiva el almacenamiento en caché de los resultados del escaneo.

"disable_cli"
- Desactivar CLI modo? CLI modo está activado por predefinido, pero a veces puede interferir con ciertas herramientas de prueba (tal como PHPUnit, por ejemplo) y otras aplicaciones basadas en CLI. Si no es necesario desactivar CLI modo, usted debe ignorar esta directiva. False = Activar CLI modo [Predefinido]; True = Desactivar CLI modo.

####"signatures" (Categoría)
Configuración de firmas.
- %%%_clamav = ClamAV firmas (ambos mains y daily).
- %%%_custom = Sus personalizadas firmas (si usted ha escritos algunas).
- %%%_mussel = phpMussel firmas incluidos en su corriente firmas conjunto que no son de ClamAV.

Cotejar contra MD5 firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Cotejar contra genéricas firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "general_clamav"
- "general_custom"
- "general_mussel"

Cotejar contra normalizados ASCII firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Cotejar contra normalizados HTML firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "html_clamav"
- "html_custom"
- "html_mussel"

Cotejar PE (Portátil Ejecutable) archivos (EXE, DLL, etc) con PE Secciónal firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Cotejar PE (Portátil Ejecutable) archivos (EXE, DLL, etc) con PE extendidas firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "pex_custom"
- "pex_mussel"

Cotejar PE (Portátil Ejecutable) archivos (EXE, DLL, etc) con PE firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Cotejar ELF archivos con ELF firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Cotejar Mach-O archivos (OSX, etc) con Mach-O firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Cotejar gráficos archivos con firmas basado en gráficos cuando escaneando? False = No; True = Sí [Predefinido].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Cotejar contenidos de compactados archivos con compactados archivos metadatos firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Cotejar OLE objetos con OLE firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Cotejar nombres de archivos con firmas basado en nombres cuando escaneando? False = No; True = Sí [Predefinido].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Permitir escaneando con phpMussel_mail()? False = No; True = Sí [Predefinido].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Activar archivo específica whitelist? False = No; True = Sí [Predefinido].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Cotejar XML/XDP trozos con XML/XDP firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Cotejar contra complejos extendidas firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Cotejar contra PDF firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Cotejar contra Shockwave firmas cuando escaneando? False = No; True = Sí [Predefinido].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Firma cotejando longitud limitando opciones. Sólo cambiarlos si sabes lo que estás haciendo. SD = Estándar firmas. RX = PCRE (Perl Compatibles Regulares Expresiones, o "Regex") firmas. FN = Firmas basados en nombre de archivos. Si usted notar PHP estrellarse cuando phpMussel intentar escanear, intente reducir estos "max" valores. Si es posible y conveniente, avísame cuando esto ocurre y los resultados de lo que intentan.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Debe phpMussel informan cuando los firmas archivos están desaparecidos o dañados? Si fail_silently está desactivado, desaparecidos y dañados archivos será reportado cuando escaneando, y si fail_silently está activado, desaparecidos y dañados archivos será ignorado, con escaneando reportando para aquellos archivos que no hay cualquier problemas. Esto generalmente debe ser dejar sola a menos que usted está experimentando estrellarse o problemas similares. False = Desactivado; True = Activado [Predefinido].

"fail_extensions_silently"
- Debe phpMussel informan cuando extensiones están desaparecidos? Si fail_extensions_silently está desactivado, desaparecidos extensiones será reportado cuando escaneando, y si fail_extensions_silently está activado, desaparecidos extensiones será ignorado, with scanning reportando para aquellos archivos que no hay cualquier problemas. Desactivando esta directiva puede potencialmente aumentar su seguridad, pero también puede conducir a un aumento de falsos positivos. False = Desactivado; True = Activado [Predefinido].

"detect_adware"
- Debe phpMussel utilizar firmas para detectar adware? False = No; True = Sí [Predefinido].

"detect_joke_hoax"
- Debe phpMussel utilizar firmas para detectar broma/engaño malware/virus? False = No; True = Sí [Predefinido].

"detect_pua_pup"
- Debe phpMussel utilizar firmas para detectar PUAs/PUPs? False = No; True = Sí [Predefinido].

"detect_packer_packed"
- Debe phpMussel utilizar firmas para detectar empacadores y datos empaquetados? False = No; True = Sí [Predefinido].

"detect_shell"
- Debe phpMussel utilizar firmas para detectar shell scripts? False = No; True = Sí [Predefinido].

"detect_deface"
- Debe phpMussel utilizar firmas para detectar defacements y defacers? False = No; True = Sí [Predefinido].

####"files" (Categoría)
General configuración para el manejo de archivos.

"max_uploads"
- Máximo permitido número de archivos para escanear durante archivo subido escaneo antes de abortando la escaneo e informando al usuario están subir demasiado simultáneamente! Proporciona protección contra un teórico ataque por lo cual un atacante intenta DDoS su sistema o CMS por sobrecargando phpMussel para ralentizar el proceso de PHP a niveles inoperables. Recomendado: 10. Es posible que desee aumentar o reducir este número dependiendo de la velocidad de su hardware. Notar que este número no tiene en cuenta o incluir el contenidos de compactados archivos.

"filesize_limit"
- Límite del tamaño de archivos en KB. 65536 = 64MB [Predefinido]; 0 = Sin límite (siempre en la greylist), cualquier (positivo) numérico valor aceptado. Esto puede ser útil cuando su PHP configuración limita la cantidad de memoria un proceso puede contener o si su PHP configuración limita el tamaño de archivo subidos.

"filesize_response"
- Qué hacer con los archivos que superen el límite del tamaño de archivos (si existe). False = Whitelist; True = Blacklist [Predefinido].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Si su sistema sólo permite ciertos tipos de archivos para ser subido, o si su sistema niega explícitamente ciertos tipos de archivos, especificando los tipos de archivos en la whitelist, blacklist y/o greylist puede aumentar la velocidad a que escaneando se realizado por permitiendo la script para saltar sobre ciertos tipos de archivos. Formato es CSV (comas separados valores). Si desea escanear todo, en lugar de utilizando la whitelist, blacklist o greylist, dejar las variables en blanco; haciendo tal desactivará la whitelist/blacklist/greylist.
- Lógico orden de procesamiento es:
  - Si el tipo de archivo está en la whitelist, no escanear y no bloquear el archivo, y no cotejar el archivo con la blacklist o la greylist.
  - Si el tipo de archivo está en la blacklist, no escanear el archivo, pero bloquearlo en todo caso, y no cotejar el archivo con la greylist.
  - Si la greylist está vacía o si la greylist está no vacía y el tipo de archivo está en la greylist, escanearlo como normal y determinar si para bloquearlo basado en los resultados de la escaneo, pero si la greylist está no vacía y el tipo de archivo está no en la greylist, tratar el archivo como si está en la blacklist, por lo tanto no escanearlo pero bloquearlo en todo caso.

"check_archives"
- Intente comprobar el contenido de los compactados archivos? False = No (no comprobar); True = Sí (comprobar) [Predefinido].
- Corrientemente, sólo la comprobación de BZ, GZ, LZF y ZIP archivos está soportado (comprobación de RAR, CAB, 7z y etcétera no soportado en este momento).
- Esto no es infalible! Mientras yo altamente recomiendo mantener este activado, no puedo garantizar que siempre encontrará todo.
- También ser conscientes que la comprobación de compactados archivos corrientemente no es recursivo para ZIPs.

"filesize_archives"
- Heredar tamaño de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].

"filetype_archives"
- Heredar tipos de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].

"max_recursion"
- Máximo recursividad nivel límite para compactados archivos. Predefinido = 10.

"block_encrypted_archives"
- Detectar y bloquear compactados archivos encriptados? Debido phpMussel no es capaz de escanear el contenido de los compactados archivos encriptados, es posible que este puede ser empleado por un atacante como un medio de evitando phpMussel, antivirus escáneres y otras protecciones. Instruir phpMussel para bloquear cualquier compactado archivo que se descubre es encriptado potencialmente podría ayudar a reducir el riesgo asociado a estos tales posibilidades. False = No; True = Sí [Predefinido].

####"attack_specific" (Categoría)
Configuración para ataque específicas detecciones (no basado en CVDs).

Camaleón ataque detección: False = Desactivado; True = Activado.

"chameleon_from_php"
- Buscar para PHP código en archivos que no están PHP archivos ni reconocidos compactados archivos.

"chameleon_from_exe"
- Buscar para PE mágico número en archivos que no están ejecutables ni reconocidos compactados archivos y para ejecutables cuyo mágicos números son incorrectas.

"chameleon_to_archive"
- Buscar para compactados archivos cuyo mágicos números son incorrectas (Soportado: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Buscar para office documentos cuyo mágicos números son incorrectas (Soportado: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Buscar para imágenes cuyo mágicos números son incorrectas (Soportado: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Buscar para PDF archivos cuyo mágicos números son incorrectas.

"archive_file_extensions" y "archive_file_extensions_wc"
- Reconocido compactado archivo extensiones (formato es CSV; sólo debe agregar o eliminar cuando problemas ocurrir; eliminando innecesariamente puede causar falsos positivos a aparecer para compactados archivos, mientras añadiendo innecesariamente hará esencialmente whitelist que cuales eres añadiendo desde ataque específica detección; modificar con precaución; También notar que esto no tiene efecto en aquellos compactados archivos que pueden y no pueden ser analizado a contenido nivel). La lista, como es a predefinición, describe los formatos más comúnmente utilizados a través de la mayoría de sistemas y CMS, pero intencionalmente no es necesariamente exhaustiva.

"general_commands"
- Buscar contenidos de archivos para declaraciones y comandos generales como tal `eval()` y `exec()`? False = No (no buscar) [Predefinido]; True = Sí (buscar). Desactivar esta directiva si tiene intención de subir cualquiera de los siguientes para su sistema o CMS a través de su navegador: PHP, JavaScript, HTML, python, perl archivos y etcétera. Activar esta directiva si usted no tiene cualquier adicional protección en su sistema y no tiene intención de subir estos tipos de archivos. Si utiliza adicional seguridad junto con phpMussel (como tal ZB Block), no hay necesidad de activar esta directiva, porque la mayor parte de lo que phpMussel buscará (en el contexto de esta directiva) son duplicaciones de protecciones que probablemente ya está previsto.

"block_control_characters"
- Bloquear cualquier archivos que contenga cualquier caracteres de control (aparte de saltos de línea)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Si usted sólo subir texto sin cualquier formato, usted puede activar esta opción para proporcionar alguna adicional protección para su sistema. Pero, si usted subir cualquier cosa otro de texto sin cualquier formato, activando esto puede dar lugar a falsos positivos. False = No bloquear [Predefinido]; True = Bloquear.

"corrupted_exe"
- Corrompido archivos y procesamiento errores. False = Ignorar; True = Bloquear [Predefinido]. Detectar y bloquear potencialmente corrompido PE (Portátil Ejecutable) archivos? Frecuentemente (pero no siempre), cuando ciertos aspectos de un PE archivo están corrompido, dañados o no podrá ser analizado correctamente, lo puede ser indicativo de una infección viral. Los procesos utilizados por la mayoría de los antivirus programas para detectar un virus en PE archivos requerir analizando esos archivos en ciertas maneras, que, si el programador de un virus es consciente de, intentará específicamente para prevenir, con el fin de permitir su virus permanezca sin ser detectado.

"decode_threshold"
- Opcional limitación a la longitud de puros datos a que dentro de decodificación comandos deben ser detectados (en caso de que los hay notable rendimiento problemas mientras que escaneando). Valor es un entero número representando el tamaño de archivos en KB. Predefinido = 512 (512KB). Cero o nulo valor desactiva la limitación (eliminando cualquier tal limitación basado sobre la tamaño de archivos).

"scannable_threshold"
- Opcional limitación a la longitud de puros datos para que phpMussel se permitido leer y escanear (en caso de que los hay notable rendimiento problemas mientras que escaneando). Valor es un entero número representando el tamaño de archivos en KB. Predefinido = 32768 (32MB). Cero o nulo valor desactiva la limitación. En general, Este valor no debe ser inferior a la media tamaño de archivos subidos que desea y espera recibir a su servidor o website, no debe ser mayor que el filesize_limit directiva, y no debe ser más de aproximadamente una quinta parte de la total permisible memoria asignación concedida a PHP a través de la php.ini configuración archivo. Esta directiva existe para intratar prevenir phpMussel del uso de demasiada memoria (eso sería prevenir que sea capaz para escanear archivos con éxito encima de un cierto tamaño de archivos).

####"compatibility" (Categoría)
Compatibilidad directivas para phpMussel.

"ignore_upload_errors"
- Esta directiva, en general, debe ser desactivado, a menos que se requiere para la correcta funcionalidad de phpMussel en su específico sistema. Normalmente, cuando está desactivado, cuando phpMussel detecta la presencia de elementos en la `$_FILES` array(), intentará iniciar un escaneo de los archivos que esos elementos representan, y, si esos elementos están blanco o vacío, phpMussel devolverá un mensaje de error. Este es el comportamiento natural para phpMussel. Pero, para algunos CMS, vacíos elementos en `$_FILES` puede ocurrir como resultado del comportamiento natural de los CMS, o errores pueden ser reportados cuando no existe ninguna, en cuyo caso, el comportamiento natural para phpMussel será interfiriendo con el comportamiento natural de los CMS. Si tal situación ocurre para usted, activando esta opción instruirá phpMussel no intentar iniciar un escaneo para tales vacíos elementos, ignorarlos cuando encontrado y no devuelva cualquier relacionado mensaje de error, así permitiendo la continuación de la página cargando. False = DESACTIVADO; True = ACTIVADO.

"only_allow_images"
- Si usted sólo esperas o sólo quieren permitir imágenes para ser subido a su sistema o CMS, y si usted absolutamente no requiere cualquieres archivos otro que imágenes para subir a su sistema o CMS, esta directiva debe ser activado, pero por lo demás debe ser desactivado. Si esta directiva está activada, se instruirá phpMussel para indiscriminadamente bloquear cualquieres subidos identificado como archivos que no son imagen, sin escaneandolos. Esto puede reducir el tiempo de procesamiento y el uso de memoria para intentados subidos de archivos que no son imagen. False = DESACTIVADO; True = ACTIVADO.

####"heuristic" (Categoría)
Heurísticas directivas para phpMussel.

"threshold"
- Hay ciertas firmas de phpMussel eso tienen la intención de identificar sospechosas y potencialmente maliciosos cualidades de los archivos que se subido sin que en ellos la identificación de los archivos que se subido específicamente como malicioso. Este "threshold" (umbral) valor dice phpMussel qué lo máximo total peso de sospechosas y potencialmente maliciosos cualidades de los archivos que se subido eso es permisible es antes de que esos archivos han de ser señalado como malicioso. La definición de peso en este contexto es el número total de sospechosas y potencialmente maliciosos cualidades identificados. Por predefinido, este valor es 3. Un valor inferior generalmente resultará en una mayor incidencia de falsos positivos pero un mayor número de archivos maliciosos siendo identificado, mientras un valor mayor generalmente resultará en una inferior incidencia de falsos positivos pero un inferior número de archivos maliciosos siendo identificado. Generalmente es mejor dejar este valor en su predefinido a menos que usted está experimentando problemas relacionados con ella.

####"virustotal" (Categoría)
Configuración para Virus Total integración.

"vt_public_api_key"
- Opcionalmente, phpMussel es capaz de escanear archivos utilizando el Virus API total como una manera de proporcionar un mucho mayor nivel de protección contra virus, troyanos, malware y otras amenazas. Por predefinido, escanear archivos utilizando el Virus Total API está desactivado. Para activarlo, una API clave desde Virus Total se requiere. Debido a la significativo beneficio que esto podría proporcionar a usted, está algo que recomiendo. Tenga en cuenta, aunque, que para utilizar el Virus API total, es absolutamente necesario usted estar de acuerdo con sus Términos de Servicio y cumplan todas las directrices según descrito por el Virus Total documentación! Usted NO se permitido utilizar esta integración función A MENOS QUE:
  - Ha leído y está de acuerdo con los Términos de Servicio de Virus Total y sus API. Los Términos de Servicio de Virus Total y sus API puede estar fundar [Aquí](https://www.virustotal.com/en/about/terms-of-service/).
  - Ha leído y entender, en un mínimo, el preámbulo de la Virus Total Pública API Documentación (todo después "VirusTotal Public API v2.0" pero antes "Contents"). La Virus Total Pública API Documentación puede estar fundar [Aquí](https://www.virustotal.com/en/documentation/public-api/).

Notar: Si escanear archivos utilizar la Virus Total API está desactivado, usted no tendrá requiere revisar cualquiera de las directivas en esta categoría (`virustotal`), porque ninguno de ellos hacen cualquier cosa si está desactivado. Para obtener una Virus Total API clave, desde dondequiera en su website, haga clic en el "Únete a la comunidad" enlace situada hacia la parte superior derecha de la página, entrar la información solicitada, y haga clic "Registrarse" cuando has hecholo. Siga todas las instrucciones suministradas, y cuando usted tiene su pública API clave, copiar/empastar que pública API clave a la `vt_public_api_key` directiva de la `phpmussel.ini` configuración archivo.

"vt_suspicion_level"
- Por predefinido, phpMussel restringirá qué archivos se escaneado usando el Virus Total API a esos archivos que se considera "sospechosa". Opcionalmente, usted puede ajustar esta restricción por manera de cambiando el valor de la `vt_suspicion_level` directiva.
- `0`: Archivos sólo se consideran sospechoso si, cuando se escanear por phpMussel utilizando sus propias firmas, ellos se considera como que llevar un heurístico peso. Esto significaría efectivamente que uso del Virus Total API sería para una segunda opinión para cuando phpMussel sospecha que un archivo puede ser potencialmente malicioso, pero no pueden descartar completo que está puede también, potencialmente, ser benignos (no malicioso) y por lo tanto normalmente haría no bloquearlo o marcarlo como malicioso.
- `1`: Archivos se consideran sospechoso si, cuando se escanear por phpMussel utilizando sus propias firmas, ellos se considera como que llevar un heurístico peso, si son conocidos por ser ejecutable (PE archivos, Mach-O archivos, ELF/Linux archivos, etc), o si son conocidos por ser de un formato que podría contener ejecutable datos (tales como ejecutables macros, DOC/DOCX archivos, comprimidos archivos tales como RARs, ZIPS y etc). Este es el predeterminado valor y el nivel de sospecha recomienda para aplicar, significando efectivamente que el uso de la Virus Total API sería para una segunda opinión para cuando phpMussel no inicialmente encuentra cualquier cosa malicioso o mal con un archivo que se considera sospechoso y por lo tanto normalmente haría no bloquearlo o marcarlo como malicioso.
- `2`: Todos archivos son considerados sospechosos y deben ser escaneados utilizando el Virus Total API. Generalmente, está no se recomienda para aplicar esta nivel de sospecha, debido al riesgo de alcanzar su API cuota mucho más rápido que de normalmente haría ser es el caso, pero hay ciertas circunstancias (como cuando el webmaster o hostmaster tiene muy poca fe o confianza en absoluto en cualquiera de los contenidos subidos de sus usuarios) para donde que esta nivel sospecha podría ser apropiado. Con esta nivel de sospecha, todos archivos no normalmente bloqueados o marcados como malicioso haría ser escaneado utilizando el Virus Total API. Notar, aunque, que phpMussel cesará usando el Virus Total API cuando está ha alcanzado su API cuota (independientemente de sospecha nivel), y que su cuota será probablemente llegó mucho más rápido cuando utilizando esta nivel de sospecha.

Notar: Independientemente de sospecha nivel, cualquieres archivos que están en la blacklist o whitelist para phpMussel no hará ser escaneado usando el Virus Total API, porque esos dichos archivos podrían ya han sido declarados ya sea como malicioso o benigno por phpMussel por el momento en que ellos podría han sido escaneados por el Virus Total API, y por lo tanto, adicional escaneando no sería necesaria. La capacidad de phpMussel para escanear archivos utilizando el Virus Total API es destinado para construir mayor confianza como a si un archivo es malicioso o benigno en aquellos circunstancias en que phpMussel no es enteramente seguro de si un archivo es malicioso o benigno.

"vt_weighting"
- Debería phpMussel aplicar los resultados del escaneo utilizando el Virus Total API como detecciones o como detección peso? Esta directiva existe, por razón de que, aunque escanear un archivo usando múltiples motores (como Virus Total hacer) debería resultar en un aumento detección cuenta (y por lo tanto en un mayor número de maliciosos archivos ser atrapado), esta también puede resultar en un mayor número de falsos positivos, y por lo tanto, en algunas circunstancias, los resultados del escanear pueden ser mejor utilizados como una puntuación de confianza y no como una definitiva conclusión. Si un valor de 0 es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detecciones, y por lo tanto, si cualquier motor utilizado por Virus Total marca el archivo está escaneando como malicioso, phpMussel considerará el archivo a ser malicioso. Si cualquier otro valor es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detección peso, y por lo tanto, el número de motores utilizados por Virus Total que marca el archivo está escaneando como malicioso servirá como una puntuación de confianza (o detección peso) para si el archivo que ser escanear debe ser considerado malicioso por phpMussel (el valor utilizado representará el mínima puntuación de confianza o peso requerido con el fin de ser considerado malicioso). Un valor de 0 es utilizado por predefinido.

"vt_quota_rate" y "vt_quota_time"
- En acuerdo con la documentación de la Virus Total API, está limitado para un máximo de 4 solicitudes de cualquier naturaleza en cualquier 1 minuto período de tiempo. Si usted ejecuta un honeyclient, honeypot o cualquier otra automatización que va proporcionar recursos para Virus Total y no sólo recuperar los reportes usted tiene derecho a un más alta cuota. Por predefinido, phpMussel va adhiere estrictamente a estas limitaciones, pero debido a la posibilidad de estos limitaciones siendo aumentado, estas dos directivas son proporcionan como un manera para usted para indique para phpMussel en cuanto a qué limitaciones está debe adherirse a. A menos que usted ha estado indique que lo haga, está no es recomendable para usted para aumentar estos valores, pero, si ha tenido problemas relacionados con alcanzar su cuota, la disminución de estos valores _**PUEDE**_ a veces ayudarle para hacer frente a estos problemas. Su cuota es determinado como `vt_quota_rate` solicitudes de cualquier naturaleza en cualquier `vt_quota_time` minuto período de tiempo.

####"urlscanner" (Categoría)
URL escáner configuración.

"urlscanner"
- Construido dentro phpMussel es un URL escáner, capaz de detectar las maliciosas URL desde el interior de los datos o archivos escaneados. Para activar la URL escáner, definir `urlscanner` como true; Para desactivarlo, definir esta directiva como false.

Notar: Si la URL escáner está desactivado, usted no tendrá que revisar cualquiera de las directivas en esta categoría (`urlscanner`), porque ninguno de ellos hará cualquier cosa si desactiva.

URL escáner API configuración.

"lookup_hphosts"
- Permite API búsquedas al [hpHosts](http://hosts-file.net/) API cuando se define como true. hpHosts no requiere un API clave para llevar a cabo API búsquedas.

"google_api_key"
- Permite API búsquedas al Google Safe Browsing API cuando la necesario API clave es define. El uso de Google Safe Browsing API requiere un API clave, que puede ser obtenido a partir de [Aquí](https://console.developers.google.com/).
- Notar: Esta es una característica futuro! Google Safe Browsing API funcionalidad de búsqueda no aún ha completado!

"maximum_api_lookups"
- Máximo número permitido de API búsquedas para llevar a cabo por individuo escaneando iteración. Debido a que cada adicional API búsqueda se sumará al total tiempo requerido para completar cada escaneando iteración, es posible que usted desee estipular una limitación a fin de acelerar el proceso de escaneando. Cuando se define en 0, no tal máximo número permitido se aplicará. Se define como 10 por predefinido.

"maximum_api_lookups_response"
- Qué hacer si el máximo número de API búsquedas permitido es superadas? False = Hacer nada (continuar procesando) [Predefinido]; True = Marcar/bloquear el archivo.

"cache_time"
- Por cuánto tiempo (en segundos) debe los resultados de las API búsquedas ser almacenan en caché? Predefinido es 3600 segundos (1 horas).

####"template_data" (Categoría)
Directivas/Variables para las plantillas y temas.

Plantilla datos es relacionados a la HTML utilizado para generar el "Carga Negado" mensaje que muestra a los usuarios cuando una archivo subido está bloqueado. Si utiliza temas personalizados para phpMussel, HTML se obtiene a partir del `template_custom.html` archivo, y para de otra manera, HTML se obtiene a partir del `template.html` archivo. Variables escritas a esta sección de la configuración archivo se procesado para el HTML a través de la sustitución de los nombres de variables circunfijo por llaves que se encuentran dentro del HTML con el variable datos correspondiente. Por ejemplo, dónde `foo="bar"`, cualquier instancias de `<p>{foo}</p>` que se encuentran dentro del HTML se convertirá `<p>bar</p>`.

"css_url"
- El plantilla archivo para los temas personalizados utiliza externas CSS propiedades, mientras que el plantilla archivo para el predefinida tema utiliza internas CSS propiedades. Para instruir phpMussel de utilizar el plantilla archivo para temas personalizados, especificar el público HTTP dirección de sus temas personalizados CSS archivos utilizando la `css_url` variable. Si lo deja en blanco la variable, phpMussel utilizará el plantilla archivo para el predefinida tema.

---


###7. <a name="SECTION7"></a>FIRMA FORMATOS

####*FIRMAS BASADAS EN LAS NOMBRES DEL ARCHIVOS*
Todas firmas basadas en las nombres del archivos seguir el formato:

`NOMBRE:FNRX`

Donde NOMBRE es el nombre a citar para esa firma y FNRX es la regular expresión para cotejar nombres de archivos (sin codificar) con.

####*MD5 FIRMAS*
Todos MD5 firmas seguir el formato:

`HASH:TAMAÑO:NOMBRE`

Donde HASH es el MD5 hash de un entero archivo, TAMAÑO es el total tamaño de eso archivo y NOMBRE es el nombre a citar para esa firma.

####*COMPACTADOS ARCHIVOS METADATOS FIRMAS*
Donde compactados archivos metadatos firmas seguir el formato:

`NOMBRE:TAMAÑO:CRC32`

Donde NOMBRE es el nombre a citar para esa firma, TAMAÑO es el total tamaño (sin comprimir) de un archivo contenido dentro el compactado archivo y CRC32 es el CRC32 suma de comprobación de eso contenido archivo.

####*PE SECCIÓNAL FIRMAS*
Todos PE Secciónal firmas seguir el formato:

`TAMAÑO:HASH:NOMBRE`

Donde HASH es el MD5 hash de una sección del PE archivo, TAMAÑO es el total tamaño de esa sección y NOMBRE es el nombre a citar para esa firma.

####*PE EXTENDIDAS FIRMAS*
Todos PE extendidas firmas seguir el formato:

`$VAR:HASH:TAMAÑO:NOMBRE`

Donde $VAR es el nombre de la PE variable para comprobar contra, HASH es el MD5 hash de esa variable, TAMAÑO es el total tamaño de esa variable y NOMBRE es el nombre de citar para esa firma.

####*WHITELIST FIRMAS*
Todos Whitelist firmas seguir el formato:

`HASH:TAMAÑO:TIPO`

Donde HASH es el MD5 hash de un entero archivo, TAMAÑO es el total tamaño de eso archivo y TIPO es el tipo de firmas el archivo en la whitelist es estar inmune contra.

####*COMPLEJOS EXTENDIDAS FIRMAS*
Complejos extendidas firmas son bastante diferentes a los otros tipos de firmas posibles con phpMussel, en que qué ellos son cotejando contra se especificado por las firmas ellos mismos y que ellos pueden cotejar contra múltiples criterios. La cotejar criterios están delimitados por ";" y la cotejar tipo y cotejar datos de cada cotejar criterio es delimitado por ":" como tal que formato para estas firmas tiene tendencia a aparecer como:

`$variable1:SOMEDATA;$variable2:SOMEDATA;FirmaNombre`

####*TODO LO DEMÁS*
Todas las demás firmas seguir el formato:

`NOMBRE:HEX:DESDE:PARA`

Donde NOMBRE es el nombre a citar para esa firma y HEX es un hexadecimal codificado segmento del archivo propuesto para ser comprobado por la firma dado. DESDE y PARA son opcionales parámetros, indicando desde cual y para cual posiciones en los datos de origen a cotejar contra (no soportado por la mail función).

####*REGEX*
Cualquier forma de regex entendido y correctamente procesado por PHP también debe entenderse y procesado correctamente por phpMussel y sus firmas. Pero, yo sugeriría tomar mucho cuidado cuando escribiendo nuevas firmas basado en regex, porque, si no estás del todo seguro de lo que estás haciendo, puede haber altamente irregulares e/o inesperados resultados. Mirar el código fuente para phpMussel si no estás del todo seguro sobre el contexto de que las regex declaraciones son procesado. También, recordar que todos los patrones (con excepción para nombre de archivo, compactado archivo metadato y MD5 patrones) debe ser hexadecimal codificado (con excepción de la patrón sintaxis)!

####*DONDE PONER PERSONALIZADAS FIRMAS?*
Sólo poner personalizadas firmas en esos archivos destinados para personalizadas firmas. Estos archivos deben contener "_custom" en sus nombres. También debe evitar editando de los predefinidos firmas archivos que no son nombrado como tal, a menos que sepa exactamente lo que está haciendo, porque, además de ser una buena práctica en general y además de desde ayudando distinguir entre sus propias firmas y la predefinido firmas incluido con phpMussel, que es bueno para mantener para editando sólo los archivos destinados para editando, porque la manipulación de los predefinidos firmas archivos puede causarlos cesar funcionando correctamente, por razón del "maps" archivos: Los "maps" archivos instruir phpMussel donde en los firmas archivos para mirar por firmas requeridas por phpMussel como por cuando requerido, y estos mapas pueden convertirse fuera de sincronización con sus asociados firmas archivos si esos firmas archivos están manipulados. Usted puede poner más o menos lo que quieras en sus personalizadas firmas, siempre y cuando usted sigue la sintaxis correcta. Pero, tener cuidado para probar nuevas firmas para falsos positivos de antemano si tiene intención de compartirlas o utilizarlos en un real entorno.

####*FIRMA DESGLOSE*
El siguiente es el desglose de los tipos de firmas utilizado por phpMussel:
- "Normalizados ASCII Firmas" (ascii_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando.
- "Complejos Extendidas Firmas" (coex_*). Mixtas tipos de firmas para cotejar/comprobar.
- "ELF Firmas" (elf_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando y verificado como del ELF formato.
- "Portátil Ejecutable Firmas" (exe_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando y verificado como del PE formato.
- "Firmas Basadas En Las Nombres Del Archivos" (filenames_*). Cotejado contra los nombres de archivos destinado para escaneando.
- "Generales Firmas" (general_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando.
- "Gráficas Firmas" (graphics_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando y verificado como de un conocido gráficos formato.
- "Generales Comandos" (hex_general_commands.csv). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando.
- "Normalizados HTML Firmas" (html_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando y verificado como del HTML formato.
- "Mach-O Firmas" (macho_*). Cotejado contra los contenidos de cada archivo que no está en la whitelist que es destinado para escaneando y verificado como del Mach-O formato.
- "Email Firmas" (mail_*). Cotejado contra la $body variable procesada por la phpMussel_mail() función, que está destinado a ser el cuerpo de email mensajes o entidades similares (potencialmente, foro postes y etcétera).
- "MD5 Firmas" (md5_*). Cotejado contra el MD5 hash de los contenidos y el tamaño de cada archivo que no está en la whitelist que es destinado para escaneando.
- "Compactados Archivos Metadatos Firmas" (metadata_*). Cotejado contra el CRC32 hash y tamaño del inicial archivo contenido en el interior de cualquier que no está en la whitelist que es destinado para escaneando.
- "OLE Firmas" (ole_*). Cotejado contra los contenidos de cada OLE objeto que no está en la whitelist que es destinado para escaneando.
- "PDF Firmas" (pdf_*). Cotejado contra los contenidos de cada PDF archivo que no está en la whitelist que es destinado para escaneando.
- "Portátil Ejecutable Secciónal Firmas" (pe_*). Cotejado contra el MD5 hash y el tamaño de cada PE sección de cada archivo que no está en la whitelist que es destinado para escaneando.
- "Portátil Ejecutable Extendidas Firmas" (pex_*). Cotejado contra el MD5 hash y el tamaño de las variables de cada archivo que no está en la whitelist que es destinado para escaneando.
- "SWF Firmas" (swf_*). Cotejado contra los contenidos de cada Shockwave archivo que no está en la whitelist que es destinado para escaneando.
- "Whitelist Firmas" (whitelist_*). Cotejado contra el MD5 hash de los contenidos y el tamaño de cada archivo que es destinado para escaneando. Cotejados archivos será inmune de ser cotejado por el tipo de firma mencionado en su entrada de la whitelist.
- "XML/XDP Firmas" (xmlxdp_*). Cotejado contra cualquier XML/XDP trozos encontrado dentro de cualquier archivo que no está en la whitelist que es destinado para escaneando.
(Notar que cualquier de estas firmas pueden estar desactivado fácilmente a través de `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>CONOCIDOS PROBLEMAS DE COMPATIBILIDAD

####PHP y PCRE
- phpMussel requiere PHP y PCRE para ejecutar y funcionar correctamente. Sin PHP, o sin la PCRE extensión de PHP, phpMussel no ejecutará o funcionará correctamente. Debe asegurarse de que su sistema tiene tanto PHP y PCRE instalados y disponibles antes de descargar e instalar phpMussel.

####ANTI-VIRUS SOFTWARE COMPATIBILIDAD

En su mayor parte, phpMussel debe ser bastante compatible con la mayoría de anti-virus software. Aunque, conflictividades han sido reportados por un número de usuarios en el pasado. Esta información de abajo es de VirusTotal.com, y describe un número de falsos positivos reportados por diversos anti-virus programas contra phpMussel. Aunque esta información no es una garantía absoluta de si o no se encontrará con compatibilidad problemas entre phpMussel y su anti-virus software, se su anti-virus software se observa como marcar contra phpMussel, usted debe considerar desactivarlo antes de trabajar con phpMussel o debería considerar opciones alternativas a de su anti-virus software o phpMussel.

Esta información ha sido actualizado 25 Febrero 2016 y es a hoy para todas las phpMussel versiones de la dos más recientes menores versiones (v0.9.0-v0.10.0) al momento de escribir esto.

| Escáner              |  Resultados                          |
|----------------------|--------------------------------------|
| Ad-Aware             |  No hay conocidos problemas          |
| AegisLab             |  No hay conocidos problemas          |
| Agnitum              |  No hay conocidos problemas          |
| AhnLab-V3            |  No hay conocidos problemas          |
| Alibaba              |  No hay conocidos problemas          |
| ALYac                |  No hay conocidos problemas          |
| AntiVir              |  No hay conocidos problemas          |
| Antiy-AVL            |  No hay conocidos problemas          |
| Arcabit              |  No hay conocidos problemas          |
| Avast                |  Informa como "JS:ScriptSH-inf [Trj]"|
| AVG                  |  No hay conocidos problemas          |
| Avira                |  No hay conocidos problemas          |
| AVware               |  No hay conocidos problemas          |
| Baidu-International  |  No hay conocidos problemas          |
| BitDefender          |  No hay conocidos problemas          |
| Bkav                 |  Informa como "VEXC640.Webshell" y "VEXD737.Webshell"|
| ByteHero             |  No hay conocidos problemas          |
| CAT-QuickHeal        |  No hay conocidos problemas          |
| ClamAV               |  No hay conocidos problemas          |
| CMC                  |  No hay conocidos problemas          |
| Commtouch            |  No hay conocidos problemas          |
| Comodo               |  No hay conocidos problemas          |
| Cyren                |  No hay conocidos problemas          |
| DrWeb                |  No hay conocidos problemas          |
| Emsisoft             |  No hay conocidos problemas          |
| ESET-NOD32           |  No hay conocidos problemas          |
| F-Prot               |  No hay conocidos problemas          |
| F-Secure             |  No hay conocidos problemas          |
| Fortinet             |  No hay conocidos problemas          |
| GData                |  No hay conocidos problemas          |
| Ikarus               |  No hay conocidos problemas          |
| Jiangmin             |  No hay conocidos problemas          |
| K7AntiVirus          |  No hay conocidos problemas          |
| K7GW                 |  No hay conocidos problemas          |
| Kaspersky            |  No hay conocidos problemas          |
| Kingsoft             |  No hay conocidos problemas          |
| Malwarebytes         |  No hay conocidos problemas          |
| McAfee               |  Informa como "New Script.c"         |
| McAfee-GW-Edition    |  Informa como "New Script.c"         |
| Microsoft            |  No hay conocidos problemas          |
| MicroWorld-eScan     |  No hay conocidos problemas          |
| NANO-Antivirus       |  No hay conocidos problemas          |
| Norman               |  No hay conocidos problemas          |
| nProtect             |  No hay conocidos problemas          |
| Panda                |  No hay conocidos problemas          |
| Qihoo-360            |  No hay conocidos problemas          |
| Rising               |  No hay conocidos problemas          |
| Sophos               |  No hay conocidos problemas          |
| SUPERAntiSpyware     |  No hay conocidos problemas          |
| Symantec             |  No hay conocidos problemas          |
| Tencent              |  No hay conocidos problemas          |
| TheHacker            |  No hay conocidos problemas          |
| TotalDefense         |  No hay conocidos problemas          |
| TrendMicro           |  No hay conocidos problemas          |
| TrendMicro-HouseCall |  No hay conocidos problemas          |
| VBA32                |  No hay conocidos problemas          |
| VIPRE                |  No hay conocidos problemas          |
| ViRobot              |  No hay conocidos problemas          |
| Zillya               |  No hay conocidos problemas          |
| Zoner                |  No hay conocidos problemas          |

---


Última Actualización: 25 Febrero 2016 (2016.02.25).
