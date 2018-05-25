## Documentación para phpMussel (Español).

### Contenidos
- 1. [PREÁMBULO](#SECTION1)
- 2. [CÓMO INSTALAR](#SECTION2)
- 3. [CÓMO USAR](#SECTION3)
- 4. [GESTIÓN DE FRONT-END](#SECTION4)
- 5. [CLI (COMANDOS LÍNEA INTERFAZ)](#SECTION5)
- 6. [ARCHIVOS INCLUIDOS EN ESTE PAQUETE](#SECTION6)
- 7. [OPCIONES DE CONFIGURACIÓN](#SECTION7)
- 8. [FORMATOS DE FIRMAS](#SECTION8)
- 9. [CONOCIDOS PROBLEMAS DE COMPATIBILIDAD](#SECTION9)
- 10. [PREGUNTAS MÁS FRECUENTES (FAQ)](#SECTION10)
- 11. [INFORMACIÓN LEGAL](#SECTION11)

*Nota relativa a las traducciones: En caso de errores (por ejemplo, discrepancias entre traducciones, errores tipográficos, etc), la versión en Inglés del README se considera la versión original y autorizada. Si encuentra algún error, su ayuda para corregirlo sera bienvenida.*

---


### 1. <a name="SECTION1"></a>PREÁMBULO

Gracias por usar phpMussel, un PHP script diseñado para detectar troyanos, virus, malware y otras amenazas en los archivos subidos en el sistema donde la script está adjunto, basado en las firmas de ClamAV y otros.

PHPMUSSEL COPYRIGHT 2013 y más allá GNU/GPLv2 por Caleb M (Maikuolan).

Este script es un software gratuito; puede redistribuirlo y/o modificarlo según los términos de la GNU General Public License, publicada por la Free Software Foundation; tanto la versión 2 de la licencia como cualquier versión posterior. Este script es distribuido con la esperanza de que será útil, pero SIN NINGUNA GARANTÍA; también, sin ninguna garantía implícita de COMERCIALIZACIÓN o IDONEIDAD PARA UN PARTICULAR PROPÓSITO. Vea la GNU General Public License para más detalles, ubicada en el `LICENSE.txt` archivo también disponible en:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Un especial agradecimiento a [ClamAV](http://www.clamav.net/) para la inspiración del proyecto y para las firmas que este script utiliza, sin la cual, la script probablemente no existiría, o en el mejor de, tendría un muy limitado valor.

Un especial agradecimiento a SourceForge y GitHub para alojar los archivos de proyecto, y a las adicionales fuentes de un número de las firmas utilizadas por phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) y otros, y agradecimiento especial a todos aquellos que apoyan el proyecto, a cualquier otra persona que yo haya olvidado de lo contrario mencionar, y a usted, por el uso de la script.

Este documento y su paquete asociado puede ser descargado de forma gratuita desde:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>CÓMO INSTALAR

#### 2.0 INSTALACIÓN MANUAL (PARA NAVEGADORES)

1) Dado el hecho que estas leiendo esto, asumo que ya ha descargado y guardado una copia del script, descomprimido sus contenidos, teniendolo en algún lugar en su ordenador. Ahora, usted querrá averiguar en que parte del host o CMS desea colocar estos contenidos. Un directorio como `/public_html/phpmussel/` o similar (aunque, no importa el que usted elija, siempre y cuando sea algo seguro y con lo que estas satisfecho) será suficiente. *Antes de empezar a subir archivos, continue leyendo...*

2) Cambiar el nombre del archivo `config.ini.RenameMe` a `config.ini` (situado en el interior del `vault`), y opcionalmente (muy recomendable para usuarios avanzados, pero no recomendado para los usuarios principiantes o inexpertos), abre el archivo (este archivo contiene todas las directrizes disponibles para phpMussel; encima de cada opción debe haber un breve comentario que describe lo que hace y para lo qué sirve). Ajuste estas opciones según sus necesidades, según lo que sea apropiado para su particular configuración. Guardar archivo, cerrar.

3) Subir los contenidos (phpMussel y sus archivos) al directorio que habías decidido previamente (no necessitas incluir los archivos `*.txt`/`*.md` , pero deberias subir el resto).

4) CHMOD al `vault` directorio "755" (si tienes problemas, puede intentar "777"; aunque es menos seguro). El principal directorio de almacenamiento de los contenidos (el que escogio antes), en general, puede dejarlo solo, pero el estado del CHMOD deberia estar revisado si ha tenido problemas de permisos en su sistema en el pasado (predefinido, debería ser algo como "755").

5) Instale cualquier de las firmas que necesite. *Ver: [INSTALACIÓN DE FIRMAS](#INSTALLING_SIGNATURES).*

6) Luego, tendrás que "enganchar" phpMussel a tu sistema o CMS. Hay varias maneras en que usted puede "enganchar" scripts como phpMussel a su sistema o CMS, pero el más fácil es simplemente incluir el script al principio de un archivo central de su sistema o CMS (uno que en general siempre sea cargado cuando alguien accede a cualquier página a través de su web) utilizando un `require` o `include` declaración. Por lo general, esto sera algo almacenado en un directorio como `/includes`, `/assets` o `/functions`, y será menudo llamado algo así como `init.php`, `common_functions.php`, `functions.php` o similar. Vas a tener que averiguar qué archivo es por su situación; Si encuentra dificultades para resolver esto, visite la página de issues phpMussel en GitHub o los foros de soporte para phpMussel; Es posible que sea yo u otro usuario puede tener experiencia con el CMS que está utilizando (que necesita para hacernos saber que CMS está utilizando), y por lo tanto, puede ser capaz de proporcionar alguna ayuda en esta área. Para ello [utilizar `require` o `include`], inserte la siguiente línea de código al principio de ese núcleo archivo, reemplazando la cuerda contenida dentro de las comillas con la exacta dirección del `loader.php` archivo (dirección local, no la dirección HTTP; será similar a la dirreción `vault` mencionada anteriormente).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Guardar archivo, cerrarla, resubir.

-- O ALTERNATIVAMENTE --

Si está utilizando un servidor Apache y si usted tiene acceso a `php.ini`, puede utilizar la `auto_prepend_file` dirección para anteponer phpMussel cuando cualquier solicitud PHP sea realizada. Algo como:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

O esto en el archivo `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de que está funcionando correctamente. Para probar archivos subidos protecciones, probar subir los prueba archivos incluidos en el paquete dentro `_testfiles` a su website a través de sus habituales navegador basado subir métodos. Si todo funciona correctamente, un mensaje debe aparecer de phpMussel confirmando que la subido ha sido bloqueada con éxito. Si nada aparece, algo no está funcionando correctamente. Si está utilizando cualquiera de las avanzadas funciones o si está utilizandolos otros tipos de escaneo posible, Sugiero probarlo con aquellos a asegurarse de que funciona como se espera, también.

#### 2.1 INSTALACIÓN MANUAL (PARA CLI)

1) Con tu leyendo esto, estoy asumiendo que usted ha descargado una copia de la script, descomprimido y tenerlo en algún lugar en su computer. Cuando se ha determinado que usted es feliz con el lugar elegido para phpMussel, continuar.

2) phpMussel requiere PHP para ser instalado en la host máquina para ejecutar. Si usted no has PHP instalado en su máquina, por favor, instalar PHP en su máquina, siguiendo las instrucciones suministradas por el PHP instalador.

3) Opcionalmente (muy recomendable para avanzados usuarios, pero no se recomienda para los principiantes o para los inexpertos), abrir `config.ini` (situado en el interior del `vault`) – Este archivo contiene todas las disponibles operativas opciones para phpMussel. Por encima de cada opción debe ser un breve comentario que describe lo que hace y para lo qué sirve. Ajuste estas opciones según sus necesidades, según lo que sea apropiado para su particular configuración. Guardar archivo, cerrar.

4) Opcionalmente, usted puede hacer uso de phpMussel en CLI modo más fácil para ti mismo mediante la creación de un batch archivo para automáticamente cargar PHP y phpMussel. Para ello, abra un texto editor como Notepad o Notepad++, escriba la completa ruta al `php.exe` archivo dentro lo directorio de la PHP instalación, seguido de un espacio, seguido de la completa ruta al `loader.php` archivo dentro lo directorio de su phpMussel instalación, guardar el archivo con la `.bat` extensión en alguna parte que usted lo encontrará fácilmente, y haga doble clic en ese archivo para ejecutar phpMussel en el futuro.

5) Instale cualquier de las firmas que necesite. *Ver: [INSTALACIÓN DE FIRMAS](#INSTALLING_SIGNATURES).*

6) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de que está funcionando correctamente. Para probar phpMussel, ejecute phpMussel e probar escanear el directorio `_testfiles` suministrada con el paquete.

#### 2.2 INSTALACIÓN CON COMPOSER

[phpMussel está registrado con Packagist](https://packagist.org/packages/phpmussel/phpmussel), y por lo tanto, si está familiarizado con Composer, puede utilizar Composer para instalar phpMussel (sin embargo, usted todavía necesitará preparar la configuración y los ganchos; consulte "INSTALACIÓN MANUAL (PARA NAVEGADORES)" pasos 2 y 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 INSTALACIÓN DE FIRMAS

Desde v1.0.0, las firmas no están incluidas en el paquete phpMussel. Las firmas son requeridas por phpMussel para detectar amenazas específicas. Existen 3 métodos principales para instalar firmas:

1. Instalar automáticamente mediante el front-end página de actualizaciones.
2. Genere firmas usando "SigTool" e instale manualmente.
3. Descargue las firmas de "phpMussel/Signatures" e instálelas manualmente.

##### 2.3.1 Instalar automáticamente mediante el front-end página de actualizaciones.

Primeramente, necesitará asegurarse de que el front-end está habilitado. *Ver: [GESTIÓN DE FRONT-END](#SECTION4).*

Entonces, todo lo que necesitas hacer es ir a el front-end página de actualizaciones, encontrar los archivos de firma necesarios y usar las opciones que se proporcionan en la página, instalarlos y activarlos.

##### 2.3.2 Genere firmas usando "SigTool" e instale manualmente.

*Ver: [SigTool documentación](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Descargue las firmas de "phpMussel/Signatures" e instálelas manualmente.

Primeramente, ve a [phpMussel/Signatures](https://github.com/phpMussel/Signatures). El repositorio contiene varios archivos de firma que son comprimidos GZ. Descargue los archivos que necesita, descomprímalos y copie los archivos descomprimidos en el directorio `/vault/signatures` para instalarlos. Enumere los nombres de los archivos copiados a la directiva `Active` en su configuración de phpMussel para activarlos.

---


### 3. <a name="SECTION3"></a>CÓMO USAR

#### 3.0 CÓMO USAR (PARA NAVEGADORES)

phpMussel debe ser capaz de funcionar correctamente con requisitos mínimos de su parte: Después de instalarlo, que debería funcionar inmediatamente y ser inmediatamente utilizable.

Escaneo de archivos subidos es automatizado y activado como estándar, así, nada se requerida en su nombre por esta particular función.

Pero, también es capaz instruirá phpMussel para escanear específicos archivos, directorios y/o compactados archivos. Para ello, primeramente, usted tendrá asegurarse de que la adecuada configuración se establece el la `config.ini` archivo (`cleanup` debe estar desactivado), y cuando hecho, en un PHP archivo conectado a phpMussel, utilice la siguiente closure en su código:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` puede ser una cadena, una matriz o una matriz de matrices, e indica qué archivo, archivos, directorio y/o directorios a escanear.
- `$output_type` es un booleano, indicando el formato de los resultados del análisis para ser devueltos como. `false` instruye la función para devolver resultados como un entero. `true` instruye la función para devolver resultados como texto legible por humanos. Además, en cualquier caso, los resultados pueden ser acceder a través de globales variables después escaneo ha completado. Esta variable es opcional, predefinido como `false`. As siguientes se describen los números enteros:

| Resultados | Descripción |
|---|---|
| -3 | Indica se encontraron problemas con el phpMussel firmas archivos o firmas mapas archivos y que sea posible pueden faltar o dañado. |
| -2 | Indica que se ha corruptos datos detectados durante el escanear y por lo tanto el escanear no pudo completar. |
| -1 | Indica que las extensiones o complementos requeridos por PHP para ejecutar el escaneo faltaban y por lo tanto el escanear no pudo completar, 0 indica que la escanear objetivo no existe y por lo tanto no había nada para escanear. |
| 0 | Indica que la escanear objetivo no existe y por lo tanto no había nada para escanear. |
| 1 | Indica que el objetivo fue escaneado con éxito y no se detectaron problemas. |
| 2 | Indica que el objetivo fue escaneado con éxito y se detectaron problemas. |

- `$output_flatness` es un booleano, indicando a la función si se deben devolver los resultados de la escaneo (cuando hay varios objetivos a escanear) como una matriz o una cadena. `false` devolverá los resultados como una matriz. `true` devolverá los resultados como una cadena. Esta variable es opcional, predefinido como `false`.

Ejemplos:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Devuelve algo como esto (como una cadena):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Iniciado.
 > Comprobando '/user_name/public_html/my_file.html':
 -> No problemas encontrado.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminado.
```

Para una descripción completa del tipo de firmas phpMussel utiliza durante el escanear y la forma en que maneja estas firmas, consulte la sección [FORMATOS DE FIRMAS](#SECTION8) de este archivo README.

Si se encuentra algún falsos positivos, si se encuentra con algo nuevo que crees que debería ser bloqueada, o para cualquier otra cosa en relación con las firmas, por favor contacto conmigo al respecto para que pueda hacer los cambios necesarios, para que, si no se comunica conmigo, posiblemente no necesariamente tener en cuenta. *(Ver: [¿Qué es un "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)).*

Para desactivar las firmas que se incluyen con phpMussel (por ejemplo, si usted está experimentando un falso positivo específico para sus propósitos que normalmente no debería ser suprimido), agregue los nombres de las firmas específicas que deberían estar deshabilitados a la greylist de firmas (`/vault/greylist.csv`), separado por comas.

*Ver también: [¿Cómo acceder a detalles específicos sobre los archivos cuando se escanean?](#SCAN_DEBUGGING)*

#### 3.1 CÓMO USAR (PARA CLI)

Por favor, consulte la sección "INSTALACIÓN MANUAL (PARA CLI)" de este README.

También tenga en cuenta que phpMussel es un escáner *on-demand*; *NO* es un escáner en tiempo real / *on-access* (excepto para la carga de archivos, en el momento de carga), y no como antivirus suites convencionales, no supervisa la memoria activa! Es sólo detecta virus contenidas por las carga de archivos, y contenidos en los archivos específicos explícitamente para escaneo.

---


### 4. <a name="SECTION4"></a>GESTIÓN DE FRONT-END

#### 4.0 CUÁL ES EL FRONT-END.

El front-end proporciona una manera cómoda y fácil de mantener, administrar y actualizar la instalación de phpMussel. Puede ver, compartir y descargar archivos de registro a través de la página de registros, puede modificar la configuración a través de la página de configuración, puede instalar y desinstalar componentes a través de la página de actualizaciones, y puede cargar, descargar y modificar archivos en su vault a través del administración de archivos.

El front-end está desactivado de forma predeterminada para evitar el acceso no autorizado (el acceso no autorizado podría tener consecuencias significativas para su sitio web y su seguridad). Las instrucciones para habilitarlo se incluyen debajo de este párrafo.

#### 4.1 CÓMO HABILITAR EL FRONT-END.

1) Localizar la directiva `disable_frontend` dentro `config.ini`, y establézcalo en `false` (será predefinido como `true`).

2) Accesar `loader.php` desde tu navegador (p.ej., `http://localhost/phpmussel/loader.php`).

3) Inicie sesión con el nombre del usuario y la contraseña predeterminados (admin/password).

Nota: Después de iniciar la sesión por primera vez, con el fin de impedir el acceso no autorizado al front-end, usted debe cambiar inmediatamente su nombre de usuario y su contraseña! Esto es muy importante, ya que es posible subir código arbitrario de PHP a su sitio web a través del front-end.

#### 4.2 CÓMO UTILIZAR EL FRONT-END.

Las instrucciones se proporcionan en cada página del front-end, para explicar la manera correcta de usarlo y su propósito. Si necesita más explicaciones o cualquier ayuda especial, póngase en contacto con el soporte. Alternativamente, hay algunos videos disponibles en YouTube que podrían ayudar a modo de demostración.


---


### 5. <a name="SECTION5"></a>CLI (COMANDOS LÍNEA INTERFAZ)

phpMussel se puede ejecutar como un interactivo archivos escáner en CLI modo dentro sistemas basados en Windows. Consulte el "CÓMO INSTALAR (PARA CLI)" sección de este archivo README para más detalles.

Para obtener una lista de los CLI comandos disponibles, para el CLI aviso, escriba 'c', y pulse Enter.

Adicionalmente, para los interesados, un video tutorial de cómo utilizar phpMussel en el modo CLI está disponible aquí:
- <https://youtu.be/H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>ARCHIVOS INCLUIDOS EN ESTE PAQUETE

La siguiente es una lista de todos los archivos que debería haberse incluido en la copia de este script cuando descargado, todos los archivos que pueden ser potencialmente creados como resultado de su uso de este script, junto con una breve descripción de lo que todos estos archivos son para.

Archivo | Descripción
----|----
/_docs/ | Documentación directorio (contiene varios archivos).
/_docs/readme.ar.md | Documentación Árabe.
/_docs/readme.de.md | Documentación Alemán.
/_docs/readme.en.md | Documentación Inglés.
/_docs/readme.es.md | Documentación Español.
/_docs/readme.fr.md | Documentación Francés.
/_docs/readme.id.md | Documentación Indonesio.
/_docs/readme.it.md | Documentación Italiano.
/_docs/readme.ja.md | Documentación Japonés.
/_docs/readme.ko.md | Documentación Koreano.
/_docs/readme.nl.md | Documentación Holandés.
/_docs/readme.pt.md | Documentación Portugués.
/_docs/readme.ru.md | Documentación Ruso.
/_docs/readme.ur.md | Documentación Urdu.
/_docs/readme.vi.md | Documentación Vietnamita.
/_docs/readme.zh-TW.md | Documentación Chino (tradicional).
/_docs/readme.zh.md | Documentación Chino (simplificado).
/_testfiles/ | Prueba archivos directorio (contiene varios archivos). Todos los archivos contenidos son prueba archivos para probando si phpMussel ha sido instalado correctamente en su sistema, y que no es necesario subir este directorio o cualquiera de sus archivos excepto cuando haciendo tales pruebas.
/_testfiles/ascii_standard_testfile.txt | Prueba archivo para probando phpMussel normalizados ASCII firmas.
/_testfiles/coex_testfile.rtf | Prueba archivo para probando phpMussel complejos extendidas firmas.
/_testfiles/exe_standard_testfile.exe | Prueba archivo para probando phpMussel PE firmas.
/_testfiles/general_standard_testfile.txt | Prueba archivo para probando phpMussel generales firmas.
/_testfiles/graphics_standard_testfile.gif | Prueba archivo para probando phpMussel gráficas firmas.
/_testfiles/html_standard_testfile.html | Prueba archivo para probando phpMussel normalizados HTML firmas.
/_testfiles/md5_testfile.txt | Prueba archivo para probando phpMussel MD5 firmas.
/_testfiles/ole_testfile.ole | Prueba archivo para probando phpMussel OLE firmas.
/_testfiles/pdf_standard_testfile.pdf | Prueba archivo para probando phpMussel PDF firmas.
/_testfiles/pe_sectional_testfile.exe | Prueba archivo para probando phpMussel PE Secciónal firmas.
/_testfiles/swf_standard_testfile.swf | Prueba archivo para probando phpMussel SWF firmas.
/vault/ | Vault directorio (contiene varios archivos).
/vault/cache/ | Cache directorio (para los datos temporal).
/vault/cache/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/fe_assets/ | Archivos de front-end.
/vault/fe_assets/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/fe_assets/_accounts.html | Un archivo HTML para el front-end página de cuentas.
/vault/fe_assets/_accounts_row.html | Un archivo HTML para el front-end página de cuentas.
/vault/fe_assets/_cache.html | Un archivo HTML para el front-end página del datos de caché.
/vault/fe_assets/_config.html | Un archivo HTML para el front-end página de configuración.
/vault/fe_assets/_config_row.html | Un archivo HTML para el front-end página de configuración.
/vault/fe_assets/_files.html | Un archivo HTML para el administración de archivos.
/vault/fe_assets/_files_edit.html | Un archivo HTML para el administración de archivos.
/vault/fe_assets/_files_rename.html | Un archivo HTML para el administración de archivos.
/vault/fe_assets/_files_row.html | Un archivo HTML para el administración de archivos.
/vault/fe_assets/_home.html | Un archivo HTML para el front-end página principal.
/vault/fe_assets/_login.html | Un archivo HTML para el front-end página de login.
/vault/fe_assets/_logs.html | Un archivo HTML para el front-end página de los archivos de registro.
/vault/fe_assets/_nav_complete_access.html | Un archivo HTML para el menú de navegación de front-end, para aquellos con acceso completo.
/vault/fe_assets/_nav_logs_access_only.html | Un archivo HTML para el menú de navegación de front-end, para aquellos con acceso de registros solamente.
/vault/fe_assets/_quarantine.html | Un archivo HTML para el front-end página de cuarentena.
/vault/fe_assets/_quarantine_row.html | Un archivo HTML para el front-end página de cuarentena.
/vault/fe_assets/_statistics.html | Un archivo HTML para el front-end página de estadísticas.
/vault/fe_assets/_updates.html | Un archivo HTML para el front-end página de actualizaciones.
/vault/fe_assets/_updates_row.html | Un archivo HTML para el front-end página de actualizaciones.
/vault/fe_assets/_upload_test.html | Un archivo HTML para la subir prueba.
/vault/fe_assets/frontend.css | Hoja de estilo CSS para el front-end.
/vault/fe_assets/frontend.dat | Base de datos para el front-end (contiene información de las cuentas y las sesiones; sólo se genera si el front-end está activado y utilizado).
/vault/fe_assets/frontend.html | El archivo HTML principal para el front-end.
/vault/fe_assets/icons.php | Archivo de iconos (utilizado por el administración de archivos del front-end).
/vault/fe_assets/pips.php | Archivo de pips (utilizado por el administración de archivos del front-end).
/vault/fe_assets/scripts.js | Contiene datos de JavaScript del front-end.
/vault/lang/ | Contiene lingüísticos datos.
/vault/lang/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/lang/lang.ar.fe.php | Lingüísticos datos Árabe para el front-end.
/vault/lang/lang.ar.php | Lingüísticos datos Árabe.
/vault/lang/lang.bn.fe.php | Lingüísticos datos Bangla para el front-end.
/vault/lang/lang.bn.php | Lingüísticos datos Bangla.
/vault/lang/lang.de.fe.php | Lingüísticos datos Alemán para el front-end.
/vault/lang/lang.de.php | Lingüísticos datos Alemán.
/vault/lang/lang.en.fe.php | Lingüísticos datos Inglés para el front-end.
/vault/lang/lang.en.php | Lingüísticos datos Inglés.
/vault/lang/lang.es.fe.php | Lingüísticos datos Español para el front-end.
/vault/lang/lang.es.php | Lingüísticos datos Español.
/vault/lang/lang.fr.fe.php | Lingüísticos datos Francés para el front-end.
/vault/lang/lang.fr.php | Lingüísticos datos Francés.
/vault/lang/lang.hi.fe.php | Lingüísticos datos Hindi para el front-end.
/vault/lang/lang.hi.php | Lingüísticos datos Hindi.
/vault/lang/lang.id.fe.php | Lingüísticos datos Indonesio para el front-end.
/vault/lang/lang.id.php | Lingüísticos datos Indonesio.
/vault/lang/lang.it.fe.php | Lingüísticos datos Italiano para el front-end.
/vault/lang/lang.it.php | Lingüísticos datos Italiano.
/vault/lang/lang.ja.fe.php | Lingüísticos datos Japonés para el front-end.
/vault/lang/lang.ja.php | Lingüísticos datos Japonés.
/vault/lang/lang.ko.fe.php | Lingüísticos datos Koreano para el front-end.
/vault/lang/lang.ko.php | Lingüísticos datos Koreano.
/vault/lang/lang.nl.fe.php | Lingüísticos datos Holandés para el front-end.
/vault/lang/lang.nl.php | Lingüísticos datos Holandés.
/vault/lang/lang.pt.fe.php | Lingüísticos datos Portugués para el front-end.
/vault/lang/lang.pt.php | Lingüísticos datos Portugués.
/vault/lang/lang.ru.fe.php | Lingüísticos datos Ruso para el front-end.
/vault/lang/lang.ru.php | Lingüísticos datos Ruso.
/vault/lang/lang.th.fe.php | Lingüísticos datos Tailandés para el front-end.
/vault/lang/lang.th.php | Lingüísticos datos Tailandés.
/vault/lang/lang.tr.fe.php | Lingüísticos datos Turco para el front-end.
/vault/lang/lang.tr.php | Lingüísticos datos Turco.
/vault/lang/lang.ur.fe.php | Lingüísticos datos Urdi para el front-end.
/vault/lang/lang.ur.php | Lingüísticos datos Urdu.
/vault/lang/lang.vi.fe.php | Lingüísticos datos Vietnamita para el front-end.
/vault/lang/lang.vi.php | Lingüísticos datos Vietnamita.
/vault/lang/lang.zh-tw.fe.php | Lingüísticos datos Chino (tradicional) para el front-end.
/vault/lang/lang.zh-tw.php | Lingüísticos datos Chino (tradicional).
/vault/lang/lang.zh.fe.php | Lingüísticos datos Chino (simplificado) para el front-end.
/vault/lang/lang.zh.php | Lingüísticos datos Chino (simplificado).
/vault/quarantine/ | Directorio de cuarentena (contiene los cuarentenadas archivos).
/vault/quarantine/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/signatures/ | Directorio de firmas (contiene los archivos de firmas).
/vault/signatures/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/signatures/switch.dat | Esto controla y establece ciertas variables.
/vault/.htaccess | Un hipertexto acceso archivo (en este caso, para proteger confidenciales archivos perteneciente a la script contra el acceso de fuentes no autorizadas).
/vault/.travis.php | Utilizado por Travis CI para pruebas (no se requiere para usar la script).
/vault/.travis.yml | Utilizado por Travis CI para pruebas (no se requiere para usar la script).
/vault/cli.php | Módulo de la CLI.
/vault/components.dat | Contiene información relativa a los diversos componentes de phpMussel; Utilizado por la página de actualizaciones proporcionada por el front-end.
/vault/config.ini.RenameMe | Archivo de configuración; Contiene todas las opciones de configuración para phpMussel, instruyendo para qué hacer y cómo operar correctamente (cambiar el nombre para activar).
/vault/config.php | Módulo de configuración.
/vault/config.yaml | Archivo de valores predefinidos para la configuración; Contiene valores predefinidos para la configuración de phpMussel.
/vault/frontend.php | Módulo del front-end.
/vault/frontend_functions.php | Archivo de funciones del front-end.
/vault/functions.php | Archivo de funciones (esencial).
/vault/greylist.csv | CSV de las firmas en la greylist indicando para phpMussel las firmas que deben ser ignorados (archivo será recreado automáticamente si eliminado).
/vault/lang.php | Lingüísticos datos.
/vault/php5.4.x.php | Polyfills para PHP 5.4.X (necesario para la retrocompatibilidad de PHP 5.4.X; seguro para eliminar por versiones más recientes de PHP).
※ /vault/scan_kills.txt | Un registro de todos archivos subidos bloqueado/asesinado por phpMussel.
※ /vault/scan_log.txt | Un registro de todo escaneado por phpMussel.
※ /vault/scan_log_serialized.txt | Un registro de todo escaneado por phpMussel.
/vault/template_custom.html | Template archivo; Plantilla para HTML salida producida por phpMussel para sus bloqueados archivos subidos mensaje (el mensaje visto por el subidor).
/vault/template_default.html | Template archivo; Plantilla para HTML salida producida por phpMussel para sus bloqueados archivos subidos mensaje (el mensaje visto por el subidor).
/vault/themes.dat | Archivo de temas; Utilizado por la página de actualizaciones proporcionada por el front-end.
/vault/upload.php | Módulo de subida.
/.gitattributes | Un archivo de la GitHub proyecto (no se requiere para usar la script).
/.gitignore | Un archivo de la GitHub proyecto (no se requiere para usar la script).
/Changelog-v1.txt | Un registro de los cambios realizados en la principal script entre las diferentes versiones (no se requiere para usar la script).
/composer.json | Composer/Packagist información (no se requiere para usar la script).
/CONTRIBUTING.md | Información en respecto a cómo contribuir al proyecto.
/LICENSE.txt | Una copia de la GNU/GPLv2 licencia (no se requiere para usar la script).
/loader.php | El cargador. Esto es lo que se supone debe enganchando (esencial).
/PEOPLE.md | Información en respecto a las personas involucradas en el proyecto.
/README.md | Sumario información del proyecto.
/web.config | Un ASP.NET configuración archivo (en este caso, para proteger la `/vault` directorio contra el acceso de fuentes no autorizadas en el caso de que la script está instalado en un servidor basado en ASP.NET tecnologías).

※ Nombre del archivo puede variar basado de las estipulaciones de configuración (en `config.ini`).

---


### 7. <a name="SECTION7"></a>OPCIONES DE CONFIGURACIÓN
La siguiente es una lista de variables encuentran en la `config.ini` configuración archivo de phpMussel, junto con una descripción de sus propósito y función.

#### "general" (Categoría)
General configuración para phpMussel.

"cleanup"
- Despejar la variables y la caché de la script después la script ejecución? False = No; True = Sí [Predefinido]. Si usted no está utilizando la script más allá de inicial escaneando de archivos subidos, debe definir como `true` (sí), para minimizar el uso de memoria. Si usted está utilizando la script para propósitos más allá de inicial escaneando de archivos subidos, debe definir como `false` (no), para evitar recargar innecesariamente duplicados datos en la memoria. En general práctica, probablemente debería definirse como `true`, pero, si usted hace esto, usted no será capaz de utilizar la script para cualquier cosa otro que de escaneando archivos subidos.
- No tiene influencia en CLI modo.

"scan_log"
- Nombre del archivo para registrar todos los resultados de las escaneos. Especifique un archivo nombre, o dejar en blanco para desactivar.

"scan_log_serialized"
- Nombre del archivo para registrar todos los resultados de las escaneos (utilizando un formato serializado). Especifique un archivo nombre, o dejar en blanco para desactivar.

"scan_kills"
- Nombre del archivo para registrar todos bloqueados o matados subidos. Especifique un archivo nombre, o dejar en blanco para desactivar.

*Consejo útil: Si usted quieres, puede añadir información en fecha/hora a los nombres de los archivos de registro mediante la inclusión de éstos en el nombre: `{yyyy}` para el año completo, `{yy}` para el año abreviada, `{mm}` por mes, `{dd}` por día, `{hh}` para la hora.*

*Ejemplos:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- ¿Truncar archivos de registro cuando alcanzan cierto tamaño? Valor es el tamaño máximo en B/KB/MB/GB/TB que un archivo de registro puede crecer antes de ser truncado. El valor predeterminado de 0KB deshabilita el truncamiento (archivos de registro pueden crecer indefinidamente). Nota: ¡Se aplica a archivos de registro individuales! El tamaño de los archivos de registro no se considera colectivamente.

"log_rotation_limit"
- La rotación de registros limita la cantidad de archivos de registro que deberían existir al mismo tiempo. Cuando se crean nuevos archivos de registro, si la cantidad total de archivos de registro excede el límite especificado, se realizará la acción especificada. Puede especificar el límite deseado aquí. Un valor de 0 deshabilitará la rotación de registros.

"log_rotation_action"
- La rotación de registros limita la cantidad de archivos de registro que deberían existir al mismo tiempo. Cuando se crean nuevos archivos de registro, si la cantidad total de archivos de registro excede el límite especificado, se realizará la acción especificada. Puede especificar la acción deseada aquí. Delete = Eliminar los archivos de registro más antiguos, hasta que el límite ya no se exceda. Archive = Primero archiva, y luego eliminar los archivos de registro más antiguos, hasta que el límite ya no se exceda.

*Clarificacion tecnica: En este contexto, "más antiguo" significa modificado menos recientemente.*

"timeOffset"
- Si el tiempo del servidor no coincide con la hora local, se puede especificar un offset aquí para ajustar la información de fecha/hora generado por phpMussel de acuerdo a sus necesidades. Generalmente, se recomienda en lugar para ajustar la directiva de zona horaria en el archivo `php.ini`, pero a veces (por ejemplo, cuando se trabaja con proveedores de hosting compartido limitados) esto no siempre es posible hacer, y entonces, esta opción se proporciona aquí. El offset es en minutos.
- Ejemplo (para añadir una hora): `timeOffset=60`

"timeFormat"
- El formato de notación de fecha/hora usado por phpMussel. Predefinido = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Dónde encontrar el IP dirección de la conectando request? (Útil para servicios como Cloudflare y tales) Predefinido = REMOTE_ADDR. ¡AVISO: No cambie esto a menos que sepas lo que estás haciendo!

"enable_plugins"
- ¿Habilitar el soporte para los plugins de phpMussel? False = No; True = Sí [Predefinido].

"forbid_on_block"
- ¿Debería phpMussel enviar 403 header con la bloqueados archivos subidos mensaje, o quedarse con los usual 200 OK? False = No (200); True = Sí (403) [Predefinido].

"delete_on_sight"
- Activando esta directiva instruirá la script para intentar para eliminar inmediatamente cualquier escaneados intentados archivos subidos emparejando a los criterios de detección, si través de firmas o de otras maneras. Archivos determinados como limpia no serán tocados. En el caso de los compactados archivos, la totalidad del compactado archivo será eliminado (independientemente de si el emparejando archivo es sólo uno de muchos varios archivos contenida dentro del compactado archivo). Para el caso de archivo subir escaneo, en general, no es necesario activar esta directiva, porque en general, PHP purgará automáticamente el contenido de su caché cuando la ejecución ha terminado, significando que lo en general eliminará cualquier archivos subidos a través de él con el servidor a no ser que se han movido, copiado o eliminado ya. La directiva se añade aquí como una medida adicional de seguridad para aquellos cuyas copias de PHP no siempre se comportan de la manera esperada. False = Después escaneando, dejar el archivo solo [Predefinido]; True = Después escaneando, si no se limpia, eliminar inmediatamente.

"lang"
- Especifique la predefinido del lenguaje para phpMussel.

"numbers"
- Especifica cómo mostrar números.

"quarantine_key"
- phpMussel es capaz de poner en cuarentena intentados archivos subidos en aisladamente dentro de la phpMussel vault, si esto es algo que usted quiere que haga. Usuarios casual de phpMussel de los cuales simplemente desean proteger sus website o hosting ambiente sin tener ningún interés con analizando profundamente cualquier marcados intentados archivos subidos debería dejar esta funcionalidad desactivado, pero cualquier usuarios interesados en más análisis de marcados intentados archivos subidos para la investigación de malware o para cosas similares debe activar esta funcionalidad. Cuarentenando de marcados intentados archivos subidos a veces puede también ayudar en la depuración de falsos positivos, si esto es algo que ocurre con frecuencia para usted. Para desactivar la cuarentena funcionalidad, simplemente dejar la directiva `quarantine_key` vacío, o borrar el contenidos de que directiva si no está ya vacío. Para activar la cuarentena funcionalidad, entrar algún valor en la directiva. La `quarantine_key` es un importante característica de seguridad de la cuarentena funcionalidad requiere como un medio para la prevención de la explotación de la cuarentena funcionalidad por potenciales atacantes y como un medio de evitar cualquier potencial ejecución de los datos almacenados dentro la cuarentena. La `quarantine_key` debería ser tratado de la misma manera que sus contraseñas: El más grande es el mejor, y guárdela bien. Para un mejor efecto, utilice conjuntamente con `delete_on_sight`.

"quarantine_max_filesize"
- El archivo tamaño máximo permitido para archivos para ser cuarentenada. Archivos que superen el valor especificado aquí NO serán cuarentenada. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su servicio de hosting. Predefinido = 2MB.

"quarantine_max_usage"
- El uso máximo de memoria permitida para la cuarentena. Si la total memoria utilizada por la cuarentena alcanza este valor, los más antiguos cuarentenado archivos serán eliminado hasta que la total memoria utilizada ya no alcanza este valor. Esta directiva es importante como un medio de hacer que sea más difícil para cualquier potenciales atacantes a inundar su cuarentena con datos no deseados que puede causar el excesivo uso de datos en su servicio de hosting. Predefinido = 64M.

"honeypot_mode"
- Cuando la honeypot modo está activado, phpMussel intentará cuarentenar cada archivos subidos que encuentra, independientemente de si o no el archivo que se está subido coincide con las firmas incluídas, y no real escanear o análisis de esos intentados archivos subidos van a ocurrir. Esta funcionalidad debe ser útil para aquellos que deseen utilizar phpMussel a los efectos del virus/malware investigación, pero no se recomendado activar esta funcionalidad si el uso de phpMussel por el usuario es para real archivo subido escaneando ni recomendado usar la honeypot funcionalidad para fines otro que de la honeypot. Por predefinido, esta opción está desactivada. False = Desactivado [Predefinido]; True = Activado.

"scan_cache_expiry"
- Por cuánto tiempo debe phpMussel caché de los resultados del escaneo? El valor es el número de segundos para almacenar en caché los resultados del escaneo. La predeterminado valor es 21600 segundos (6 horas); Un valor de 0 desactiva el almacenamiento en caché de los resultados del escaneo.

"disable_cli"
- ¿Desactivar CLI modo? CLI modo está activado por predefinido, pero a veces puede interferir con ciertas herramientas de prueba (tal como PHPUnit, por ejemplo) y otras aplicaciones basadas en CLI. Si no es necesario desactivar CLI modo, usted debe ignorar esta directiva. False = Activar CLI modo [Predefinido]; True = Desactivar CLI modo.

"disable_frontend"
- ¿Desactivar el acceso front-end? El acceso front-end puede hacer phpMussel más manejable, pero también puede ser un riesgo de seguridad. Se recomienda administrar phpMussel a través del back-end cuando sea posible, pero el acceso front-end se proporciona para cuando no es posible. Mantenerlo desactivado a menos que lo necesite. False = Activar el acceso front-end; True = Desactivar el acceso front-end [Predefinido].

"max_login_attempts"
- Número máximo de intentos de login (front-end). Predefinido = 5.

"FrontEndLog"
- Archivo para registrar intentos de login al front-end. Especificar el nombre del archivo, o dejar en blanco para desactivar.

"disable_webfonts"
- ¿Desactivar webfonts? True = Sí [Predefinido]; False = No.

"maintenance_mode"
- ¿Activar modo de mantenimiento? True = Sí; False = No [Predefinido]. Desactiva todo lo que no sea el front-end. A veces útil para la actualización de su CMS, frameworks, etc.

"default_algo"
- Define qué algoritmo utilizar para todas las contraseñas y sesiones en el futuro. Opciones: PASSWORD_DEFAULT (predefinido), PASSWORD_BCRYPT, PASSWORD_ARGON2I (requiere PHP >= 7.2.0).

"statistics"
- ¿Seguir las estadísticas de uso de phpMussel? True = Sí; False = No [Predefinido].

"allow_symlinks"
- A veces, phpMussel no puede acceder a un archivo directamente cuando se nombra de cierta manera. Acceder al archivo indirectamente a través de symlinks a veces puede resolver este problema. Pero, esta no siempre es una solución viable, porque en algunos sistemas, el uso de symlinks puede estar prohibido, o puede requerir privilegios administrativos. Esta directiva se utiliza para determinar si phpMussel debe intentar usar symlinks para acceder a los archivos de forma indirecta, cuando acceder a ellos directamente no es posible. True = Habilitar symlinks; False = Deshabilitar symlinks [Predefinido].

#### "signatures" (Categoría)
Configuración de firmas.

"Active"
- Una lista de los archivos de firmas activa, delimitados por comas.

"fail_silently"
- ¿Debe phpMussel informan cuando los firmas archivos están desaparecidos o dañados? Si `fail_silently` está desactivado, desaparecidos y dañados archivos será reportado cuando escaneando, y si `fail_silently` está activado, desaparecidos y dañados archivos será ignorado, con escaneando reportando para aquellos archivos que no hay cualquier problemas. Esto generalmente debe ser dejar sola a menos que usted está experimentando estrellarse o problemas similares. False = Desactivado; True = Activado [Predefinido].

"fail_extensions_silently"
- ¿Debe phpMussel informan cuando extensiones están desaparecidos? Si `fail_extensions_silently` está desactivado, desaparecidos extensiones será reportado cuando escaneando, y si `fail_extensions_silently` está activado, desaparecidos extensiones será ignorado, with scanning reportando para aquellos archivos que no hay cualquier problemas. Desactivando esta directiva puede potencialmente aumentar su seguridad, pero también puede conducir a un aumento de falsos positivos. False = Desactivado; True = Activado [Predefinido].

"detect_adware"
- ¿Debe phpMussel utilizar firmas para detectar adware? False = No; True = Sí [Predefinido].

"detect_encryption"
- ¿Debe phpMussel detectar y bloquear archivos cifrados? False = No; True = Sí [Predefinido].

"detect_joke_hoax"
- ¿Debe phpMussel utilizar firmas para detectar broma/engaño malware/virus? False = No; True = Sí [Predefinido].

"detect_pua_pup"
- ¿Debe phpMussel utilizar firmas para detectar PUAs/PUPs? False = No; True = Sí [Predefinido].

"detect_packer_packed"
- ¿Debe phpMussel utilizar firmas para detectar empacadores y datos empaquetados? False = No; True = Sí [Predefinido].

"detect_shell"
- ¿Debe phpMussel utilizar firmas para detectar shell scripts? False = No; True = Sí [Predefinido].

"detect_deface"
- ¿Debe phpMussel utilizar firmas para detectar defacements y defacers? False = No; True = Sí [Predefinido].

#### "files" (Categoría)
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
- Corrientemente, los únicos formatos soportados son BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR y ZIP (los formatos RAR, CAB, 7z y etc. corrientemente no es soportados).
- Esto no es infalible! Mientras yo altamente recomiendo mantener este activado, no puedo garantizar que siempre encontrará todo.
- También ser conscientes que la comprobación de compactados archivos corrientemente no es recursivo para PHAR o ZIP formatos.

"filesize_archives"
- Heredar tamaño de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].

"filetype_archives"
- Heredar tipos de archivos blacklist/whitelist para los contenidos de compactados archivos? False = No (todo en la greylist); True = Sí [Predefinido].

"max_recursion"
- Máximo recursividad nivel límite para compactados archivos. Predefinido = 10.

"block_encrypted_archives"
- Detectar y bloquear compactados archivos encriptados? Debido phpMussel no es capaz de escanear el contenido de los compactados archivos encriptados, es posible que este puede ser empleado por un atacante como un medio de evitando phpMussel, antivirus escáneres y otras protecciones. Instruir phpMussel para bloquear cualquier compactado archivo que se descubre es encriptado potencialmente podría ayudar a reducir el riesgo asociado a estos tales posibilidades. False = No; True = Sí [Predefinido].

#### "attack_specific" (Categoría)
Configuración para ataque específicas detecciones.

Camaleón ataque detección: False = Desactivado; True = Activado.

"chameleon_from_php"
- Buscar para PHP código en archivos que no están PHP archivos ni reconocidos compactados archivos.

"chameleon_from_exe"
- Buscar para PE mágico número en archivos que no están ejecutables ni reconocidos compactados archivos y para ejecutables cuyo mágicos números son incorrectas.

"chameleon_to_archive"
- Buscar para compactados archivos cuyo mágicos números son incorrectas (Soportado: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Buscar para office documentos cuyo mágicos números son incorrectas (Soportado: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Buscar para imágenes cuyo mágicos números son incorrectas (Soportado: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Buscar para PDF archivos cuyo mágicos números son incorrectas.

"archive_file_extensions"
- Reconocido compactado archivo extensiones (formato es CSV; sólo debe agregar o eliminar cuando problemas ocurrir; eliminando innecesariamente puede causar falsos positivos a aparecer para compactados archivos, mientras añadiendo innecesariamente hará esencialmente whitelist que cuales eres añadiendo desde ataque específica detección; modificar con precaución; También notar que esto no tiene efecto en aquellos compactados archivos que pueden y no pueden ser analizado a contenido nivel). La lista, como es a predefinición, describe los formatos más comúnmente utilizados a través de la mayoría de sistemas y CMS, pero intencionalmente no es necesariamente exhaustiva.

"block_control_characters"
- Bloquear cualquier archivos que contenga cualquier caracteres de control (aparte de saltos de línea)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Si usted sólo subir texto sin cualquier formato, usted puede activar esta opción para proporcionar alguna adicional protección para su sistema. Pero, si usted subir cualquier cosa otro de texto sin cualquier formato, activando esto puede dar lugar a falsos positivos. False = No bloquear [Predefinido]; True = Bloquear.

"corrupted_exe"
- Corrompido archivos y procesamiento errores. False = Ignorar; True = Bloquear [Predefinido]. Detectar y bloquear potencialmente corrompido PE (Portátil Ejecutable) archivos? Frecuentemente (pero no siempre), cuando ciertos aspectos de un PE archivo están corrompido, dañados o no podrá ser analizado correctamente, lo puede ser indicativo de una infección viral. Los procesos utilizados por la mayoría de los antivirus programas para detectar un virus en PE archivos requerir analizando esos archivos en ciertas maneras, que, si el programador de un virus es consciente de, intentará específicamente para prevenir, con el fin de permitir su virus permanezca sin ser detectado.

"decode_threshold"
- Opcional limitación a la longitud de datos a que dentro de decodificación comandos deben ser detectados (en caso de que los hay notable rendimiento problemas mientras que escaneando). Predefinido = 512KB. Cero o nulo valor desactiva la limitación (eliminando cualquier tal limitación basado sobre la tamaño de archivos).

"scannable_threshold"
- Opcional limitación a la longitud de datos puros para que phpMussel se permitido leer y escanear (en caso de que los hay notable rendimiento problemas mientras que escaneando). Predefinido = 32MB. Cero o nulo valor desactiva la limitación. En general, Este valor no debe ser inferior a la media tamaño de archivos subidos que desea y espera recibir a su servidor o website, no debe ser mayor que el filesize_limit directiva, y no debe ser más de aproximadamente una quinta parte de la total permisible memoria asignación concedida a PHP a través de la `php.ini` configuración archivo. Esta directiva existe para intratar prevenir phpMussel del uso de demasiada memoria (eso sería prevenir que sea capaz para escanear archivos con éxito encima de un cierto tamaño de archivos).

#### "compatibility" (Categoría)
Compatibilidad directivas para phpMussel.

"ignore_upload_errors"
- Esta directiva, en general, debe ser desactivado, a menos que se requiere para la correcta funcionalidad de phpMussel en su específico sistema. Normalmente, cuando está desactivado, cuando phpMussel detecta la presencia de elementos en la `$_FILES` array(), intentará iniciar un escaneo de los archivos que esos elementos representan, y, si esos elementos están blanco o vacío, phpMussel devolverá un mensaje de error. Este es el comportamiento natural para phpMussel. Pero, para algunos CMS, vacíos elementos en `$_FILES` puede ocurrir como resultado del comportamiento natural de los CMS, o errores pueden ser reportados cuando no existe ninguna, en cuyo caso, el comportamiento natural para phpMussel será interfiriendo con el comportamiento natural de los CMS. Si tal situación ocurre para usted, activando esta opción instruirá phpMussel no intentar iniciar un escaneo para tales vacíos elementos, ignorarlos cuando encontrado y no devuelva cualquier relacionado mensaje de error, así permitiendo la continuación de la página cargando. False = DESACTIVADO; True = ACTIVADO.

"only_allow_images"
- Si usted sólo esperas o sólo quieren permitir imágenes para ser subido a su sistema o CMS, y si usted absolutamente no requiere cualquieres archivos otro que imágenes para subir a su sistema o CMS, esta directiva debe ser activado, pero por lo demás debe ser desactivado. Si esta directiva está activada, se instruirá phpMussel para indiscriminadamente bloquear cualquieres subidos identificado como archivos que no son imagen, sin escaneandolos. Esto puede reducir el tiempo de procesamiento y el uso de memoria para intentados subidos de archivos que no son imagen. False = DESACTIVADO; True = ACTIVADO.

#### "heuristic" (Categoría)
Heurísticas directivas para phpMussel.

"threshold"
- Hay ciertas firmas de phpMussel eso tienen la intención de identificar sospechosas y potencialmente maliciosos cualidades de los archivos que se subido sin que en ellos la identificación de los archivos que se subido específicamente como malicioso. Este "threshold" (umbral) valor dice phpMussel qué lo máximo total peso de sospechosas y potencialmente maliciosos cualidades de los archivos que se subido eso es permisible es antes de que esos archivos han de ser señalado como malicioso. La definición de peso en este contexto es el número total de sospechosas y potencialmente maliciosos cualidades identificados. Por predefinido, este valor es 3. Un valor inferior generalmente resultará en una mayor incidencia de falsos positivos pero un mayor número de archivos maliciosos siendo identificado, mientras un valor mayor generalmente resultará en una inferior incidencia de falsos positivos pero un inferior número de archivos maliciosos siendo identificado. Generalmente es mejor dejar este valor en su predefinido a menos que usted está experimentando problemas relacionados con ella.

#### "virustotal" (Categoría)
Configuración para Virus Total integración.

"vt_public_api_key"
- Opcionalmente, phpMussel es capaz de escanear archivos utilizando el Virus API total como una manera de proporcionar un mucho mayor nivel de protección contra virus, troyanos, malware y otras amenazas. Por predefinido, escanear archivos utilizando el Virus Total API está desactivado. Para activarlo, una API clave desde Virus Total se requiere. Debido a la significativo beneficio que esto podría proporcionar a usted, está algo que recomiendo. Tenga en cuenta, aunque, que para utilizar el Virus API total, es absolutamente necesario usted estar de acuerdo con sus Términos de Servicio y cumplan todas las directrices según descrito por el Virus Total documentación! Usted NO se permitido utilizar esta integración función A MENOS QUE:
  - Ha leído y está de acuerdo con los Términos de Servicio de Virus Total y sus API. Los Términos de Servicio de Virus Total y sus API puede estar fundar [Aquí](https://www.virustotal.com/en/about/terms-of-service/).
  - Ha leído y entender, en un mínimo, el preámbulo de la Virus Total Pública API Documentación (todo después "VirusTotal Public API v2.0" pero antes "Contents"). La Virus Total Pública API Documentación puede estar fundar [Aquí](https://www.virustotal.com/en/documentation/public-api/).

Notar: Si escanear archivos utilizar la Virus Total API está desactivado, usted no tendrá requiere revisar cualquiera de las directivas en esta categoría (`virustotal`), porque ninguno de ellos hacen cualquier cosa si está desactivado. Para obtener una Virus Total API clave, desde dondequiera en su website, haga clic en el "Únete a la comunidad" enlace situada hacia la parte superior derecha de la página, entrar la información solicitada, y haga clic "Registrarse" cuando has hecholo. Siga todas las instrucciones suministradas, y cuando usted tiene su pública API clave, copiar/empastar que pública API clave a la `vt_public_api_key` directiva de la `config.ini` configuración archivo.

"vt_suspicion_level"
- Por predefinido, phpMussel restringirá qué archivos se escaneado usando el Virus Total API a esos archivos que se considera "sospechosa". Opcionalmente, usted puede ajustar esta restricción por manera de cambiando el valor de la `vt_suspicion_level` directiva.
- `0`: Archivos sólo se consideran sospechoso si, cuando se escanear por phpMussel utilizando sus propias firmas, ellos se considera como que llevar un heurístico peso. Esto significaría efectivamente que uso del Virus Total API sería para una segunda opinión para cuando phpMussel sospecha que un archivo puede ser potencialmente malicioso, pero no pueden descartar completo que está puede también, potencialmente, ser benignos (no malicioso) y por lo tanto normalmente haría no bloquearlo o marcarlo como malicioso.
- `1`: Archivos se consideran sospechoso si, cuando se escanear por phpMussel utilizando sus propias firmas, ellos se considera como que llevar un heurístico peso, si son conocidos por ser ejecutable (PE archivos, Mach-O archivos, ELF/Linux archivos, etc), o si son conocidos por ser de un formato que podría contener ejecutable datos (tales como ejecutables macros, DOC/DOCX archivos, comprimidos archivos tales como RARs, ZIPS y etc). Este es el predeterminado valor y el nivel de sospecha recomienda para aplicar, significando efectivamente que el uso de la Virus Total API sería para una segunda opinión para cuando phpMussel no inicialmente encuentra cualquier cosa malicioso o mal con un archivo que se considera sospechoso y por lo tanto normalmente haría no bloquearlo o marcarlo como malicioso.
- `2`: Todos archivos son considerados sospechosos y deben ser escaneados utilizando el Virus Total API. Generalmente, está no se recomienda para aplicar esta nivel de sospecha, debido al riesgo de alcanzar su API cuota mucho más rápido que de normalmente haría ser es el caso, pero hay ciertas circunstancias (como cuando el webmaster o hostmaster tiene muy poca fe o confianza en absoluto en cualquiera de los contenidos subidos de sus usuarios) para donde que esta nivel sospecha podría ser apropiado. Con esta nivel de sospecha, todos archivos no normalmente bloqueados o marcados como malicioso haría ser escaneado utilizando el Virus Total API. Notar, aunque, que phpMussel cesará usando el Virus Total API cuando está ha alcanzado su API cuota (independientemente de sospecha nivel), y que su cuota será probablemente llegó mucho más rápido cuando utilizando esta nivel de sospecha.

Notar: Independientemente de sospecha nivel, cualquieres archivos que están en la blacklist o whitelist para phpMussel no hará ser escaneado usando el Virus Total API, porque esos dichos archivos podrían ya han sido declarados ya sea como malicioso o benigno por phpMussel por el momento en que ellos podría han sido escaneados por el Virus Total API, y por lo tanto, adicional escaneando no sería necesaria. La capacidad de phpMussel para escanear archivos utilizando el Virus Total API es destinado para construir mayor confianza como a si un archivo es malicioso o benigno en aquellos circunstancias en que phpMussel no es enteramente seguro de si un archivo es malicioso o benigno.

"vt_weighting"
- ¿Debería phpMussel aplicar los resultados del escaneo utilizando el Virus Total API como detecciones o como detección peso? Esta directiva existe, por razón de que, aunque escanear un archivo usando múltiples motores (como Virus Total hacer) debería resultar en un aumento detección cuenta (y por lo tanto en un mayor número de maliciosos archivos ser atrapado), esta también puede resultar en un mayor número de falsos positivos, y por lo tanto, en algunas circunstancias, los resultados del escanear pueden ser mejor utilizados como una puntuación de confianza y no como una definitiva conclusión. Si un valor de 0 es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detecciones, y por lo tanto, si cualquier motor utilizado por Virus Total marca el archivo está escaneando como malicioso, phpMussel considerará el archivo a ser malicioso. Si cualquier otro valor es utiliza, los resultados del escaneo utilizando el Virus Total API se aplicará como detección peso, y por lo tanto, el número de motores utilizados por Virus Total que marca el archivo está escaneando como malicioso servirá como una puntuación de confianza (o detección peso) para si el archivo que ser escanear debe ser considerado malicioso por phpMussel (el valor utilizado representará el mínima puntuación de confianza o peso requerido con el fin de ser considerado malicioso). Un valor de 0 es utilizado por predefinido.

"vt_quota_rate" y "vt_quota_time"
- En acuerdo con la documentación de la Virus Total API, está limitado para un máximo de 4 solicitudes de cualquier naturaleza en cualquier 1 minuto período de tiempo. Si usted ejecuta un honeyclient, honeypot o cualquier otra automatización que va proporcionar recursos para Virus Total y no sólo recuperar los reportes usted tiene derecho a un más alta cuota. Por predefinido, phpMussel va adhiere estrictamente a estas limitaciones, pero debido a la posibilidad de estos limitaciones siendo aumentado, estas dos directivas son proporcionan como un manera para usted para indique para phpMussel en cuanto a qué limitaciones está debe adherirse a. A menos que usted ha estado indique que lo haga, está no es recomendable para usted para aumentar estos valores, pero, si ha tenido problemas relacionados con alcanzar su cuota, la disminución de estos valores _**PUEDE**_ a veces ayudarle para hacer frente a estos problemas. Su cuota es determinado como `vt_quota_rate` solicitudes de cualquier naturaleza en cualquier `vt_quota_time` minuto período de tiempo.

#### "urlscanner" (Categoría)
Se incluye un escáner URL con phpMussel, capaz de detectar las maliciosas URL desde el interior de los datos o archivos escaneados.

Notar: Si la URL escáner está desactivado, usted no tendrá que revisar cualquiera de las directivas en esta categoría (`urlscanner`), porque ninguno de ellos hará cualquier cosa si desactiva.

URL escáner API configuración.

"lookup_hphosts"
- Permite API búsquedas al [hpHosts](http://hosts-file.net/) API cuando se define como true. hpHosts no requiere un API clave para llevar a cabo API búsquedas.

"google_api_key"
- Permite API búsquedas al Google Safe Browsing API cuando la necesario API clave es define. El uso de Google Safe Browsing API requiere un API clave, que puede ser obtenido a partir de [Aquí](https://console.developers.google.com/).
- Notar: Se requiere la extensión cURL con el fin de utilizar esta función.

"maximum_api_lookups"
- Máximo número permitido de API búsquedas para llevar a cabo por individuo escaneando iteración. Debido a que cada adicional API búsqueda se sumará al total tiempo requerido para completar cada escaneando iteración, es posible que usted desee estipular una limitación a fin de acelerar el proceso de escaneando. Cuando se define en 0, no tal máximo número permitido se aplicará. Se define como 10 por predefinido.

"maximum_api_lookups_response"
- Qué hacer si el máximo número de API búsquedas permitido es superadas? False = Hacer nada (continuar procesando) [Predefinido]; True = Marcar/bloquear el archivo.

"cache_time"
- Por cuánto tiempo (en segundos) debe los resultados de las API búsquedas ser almacenan en caché? Predefinido es 3600 segundos (1 horas).

#### "legal" (Categoría)
Configuración relacionada con los requisitos legales.

*Para obtener más información acerca de los requisitos legales y cómo esto podría afectar sus requisitos de configuración, consulte la sección "[INFORMACIÓN LEGAL](#SECTION11)" de la documentación.*

"pseudonymise_ip_addresses"
- ¿Seudonimizar las direcciones IP cuando al escribir archivos de registro? True = Sí; False = No [Predefinido].

"privacy_policy"
- La dirección de una política de privacidad relevante que se mostrará en el pie de página de cualquier página generada. Especificar una URL, o dejar en blanco para desactivar.

#### "template_data" (Categoría)
Directivas/Variables para las plantillas y temas.

Plantilla datos es relacionados a la HTML utilizado generar el "Subida Denegada" mensaje que muestra a los usuarios cuando una archivo subido está bloqueado. Si utiliza temas personalizados para phpMussel, HTML se obtiene a partir del `template_custom.html` archivo, y para de otra manera, HTML se obtiene a partir del `template.html` archivo. Variables escritas a esta sección de la configuración archivo se procesado para el HTML a través de la sustitución de los nombres de variables circunfijo por llaves que se encuentran dentro del HTML con el variable datos correspondiente. Por ejemplo, dónde `foo="bar"`, cualquier instancias de `<p>{foo}</p>` que se encuentran dentro del HTML se convertirá `<p>bar</p>`.

"theme"
- Tema predefinido a utilizar para phpMussel.

"Magnification"
- Ampliación de fuente. Predefinido = 1.

"css_url"
- El plantilla archivo para los temas personalizados utiliza externas CSS propiedades, mientras que el plantilla archivo para el predefinida tema utiliza internas CSS propiedades. Para instruir phpMussel de utilizar el plantilla archivo para temas personalizados, especificar el público HTTP dirección de sus temas personalizados CSS archivos utilizando la `css_url` variable. Si lo deja en blanco la variable, phpMussel utilizará el plantilla archivo para el predefinida tema.

---


### 8. <a name="SECTION8"></a>FORMATOS DE FIRMAS

*Ver también:*
- *[¿Qué es una "firma"?](#WHAT_IS_A_SIGNATURE)*

Los primeros 9 bytes `[x0-x8]` de un archivo de firmas para phpMussel son `phpMussel`, y actuar como un "número mágico" (magic number), para identificarlos como archivos de firmas (esto ayuda a evitar que phpMussel accidentalmente intente utilizar archivos que no son archivos de firmas). El siguiente byte `[x9]` identifica el tipo de archivo de firma, que phpMussel debe conocer para poder interpretar correctamente el archivo de firmas. Se reconocen los siguientes tipos de archivos de firmas:

Tipo | Byte | Descripción
---|---|---
`General_Command_Detections` | `0?` | Para archivos de firmas que usan CSV (valores separados por coma). Los valores (firmas) son cadenas codificadas hexadecimal para buscar dentro de los archivos. Las firmas aquí no tienen nombres ni otros detalles (sólo la cadena que se va a detectar).
`Filename` | `1?` | Para firmas de nombre de archivo.
`Hash` | `2?` | Para firmas hash.
`Standard` | `3?` | Para archivos de firmas que trabajan directamente con el contenido del archivos.
`Standard_RegEx` | `4?` | Para archivos de firmas que trabajan directamente con el contenido del archivos. Las firmas pueden contener expresiones regulares.
`Normalised` | `5?` | Para archivos de firmas que funcionan con el contenido de archivos normalizados ANSI.
`Normalised_RegEx` | `6?` | Para archivos de firmas que funcionan con el contenido de archivos normalizados ANSI. Las firmas pueden contener expresiones regulares.
`HTML` | `7?` | Para archivos de firmas que funcionan con el contenido de archivos normalizados HTML.
`HTML_RegEx` | `8?` | Para archivos de firmas que funcionan con el contenido de archivos normalizados HTML. Las firmas pueden contener expresiones regulares.
`PE_Extended` | `9?` | Para archivos de firmas que trabajan con metadatos PE (distintos de los metadatos PE seccionales).
`PE_Sectional` | `A?` | Para archivos de firmas que trabajan con metadatos PE seccionales.
`Complex_Extended` | `B?` | Para archivos de firmas que trabajan con varias reglas basadas en metadatos extendidos generados por phpMussel.
`URL_Scanner` | `C?` | Para archivos de firmas que trabajan con URLs.

El siguiente byte `[x10]` es una nueva línea `[0A]`, y concluye el encabezado del archivo de firmas de phpMussel.

Cada línea después de que no está vacía es una firma o regla. Cada firma o regla ocupa una línea. Los formatos de firmas soportados se describen a continuación.

#### *FIRMAS BASADAS EN LAS NOMBRES DEL ARCHIVOS*
Todas firmas basadas en las nombres del archivos seguir el formato:

`NOMBRE:FNRX`

Donde NOMBRE es el nombre a citar para esa firma y FNRX es la regular expresión para cotejar nombres de archivos (sin codificar) con.

#### *HASH FIRMAS*
Todos HASH firmas seguir el formato:

`HASH:TAMAÑO:NOMBRE`

Donde HASH es el hash (usualmente MD5) de un entero archivo, TAMAÑO es el total tamaño de eso archivo y NOMBRE es el nombre a citar para esa firma.

#### *PE SECCIÓNAL FIRMAS*
Todos PE Secciónal firmas seguir el formato:

`TAMAÑO:HASH:NOMBRE`

Donde HASH es el hash MD5 de una sección del PE archivo, TAMAÑO es el total tamaño de esa sección y NOMBRE es el nombre a citar para esa firma.

#### *PE EXTENDIDAS FIRMAS*
Todos PE extendidas firmas seguir el formato:

`$VAR:HASH:TAMAÑO:NOMBRE`

Donde $VAR es el nombre de la PE variable para comprobar contra, HASH es el hash MD5 de esa variable, TAMAÑO es el total tamaño de esa variable y NOMBRE es el nombre de citar para esa firma.

#### *COMPLEJOS EXTENDIDAS FIRMAS*
Complejos extendidas firmas son bastante diferentes a los otros tipos de firmas posibles con phpMussel, en que qué ellos son cotejando contra se especificado por las firmas ellos mismos y que ellos pueden cotejar contra múltiples criterios. La cotejar criterios están delimitados por ";" y la cotejar tipo y cotejar datos de cada cotejar criterio es delimitado por ":" como tal que formato para estas firmas tiene tendencia a aparecer como:

`$variable1:SOMEDATA;$variable2:SOMEDATA;FirmaNombre`

#### *TODO LO DEMÁS*
Todas las demás firmas seguir el formato:

`NOMBRE:HEX:DESDE:PARA`

Donde NOMBRE es el nombre a citar para esa firma y HEX es un hexadecimal codificado segmento del archivo propuesto para ser comprobado por la firma dado. DESDE y PARA son opcionales parámetros, indicando desde cual y para cual posiciones en los datos de origen a cotejar contra.

#### *REGEX (REGULAR EXPRESSIONS)*
Cualquier forma de regex entendido y correctamente procesado por PHP también debe entenderse y procesado correctamente por phpMussel y sus firmas. Pero, yo sugeriría tomar mucho cuidado cuando escribiendo nuevas firmas basado en regex, porque, si no estás del todo seguro de lo que estás haciendo, puede haber altamente irregulares e/o inesperados resultados. Mirar el código fuente para phpMussel si no estás del todo seguro sobre el contexto de que las regex declaraciones son procesado. También, recordar que todos los patrones (con excepción para nombre de archivo, compactado archivo metadato y MD5 patrones) debe ser hexadecimal codificado (con excepción de la patrón sintaxis)!

---


### 9. <a name="SECTION9"></a>CONOCIDOS PROBLEMAS DE COMPATIBILIDAD

#### PHP y PCRE
- phpMussel requiere PHP y PCRE para ejecutar y funcionar correctamente. Sin PHP, o sin la PCRE extensión de PHP, phpMussel no ejecutará o funcionará correctamente. Debe asegurarse de que su sistema tiene tanto PHP y PCRE instalados y disponibles antes de descargar e instalar phpMussel.

#### ANTI-VIRUS SOFTWARE COMPATIBILIDAD

En su mayor parte, phpMussel debe ser bastante compatible con la mayoría de anti-virus software. Aunque, conflictividades han sido reportados por un número de usuarios en el pasado. Esta información de abajo es de VirusTotal.com, y describe un número de falsos positivos reportados por diversos anti-virus programas contra phpMussel. Aunque esta información no es una garantía absoluta de si o no se encontrará con compatibilidad problemas entre phpMussel y su anti-virus software, se su anti-virus software se observa como marcar contra phpMussel, usted debe considerar desactivarlo antes de trabajar con phpMussel o debería considerar opciones alternativas a de su anti-virus software o phpMussel.

Esta información ha sido actualizado 2017.12.01 y es a hoy para todas las phpMussel versiones de la dos más recientes menores versiones (v1.0.0-v1.1.0) al momento de escribir esto.

*Esta información solo se aplica al paquete principal. Los resultados pueden variar según los archivos de firmas instalados, los complementos, y otros componentes periféricos.*

| Escáner | Resultados |
|---|---|
| AVware | Informa como "BPX.Shell.PHP" |
| Bkav | Informa como "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>PREGUNTAS MÁS FRECUENTES (FAQ)

- [¿Qué es una "firma"?](#WHAT_IS_A_SIGNATURE)
- [¿Qué es un "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)
- [¿Con qué frecuencia se actualizan las firmas?](#SIGNATURE_UPDATE_FREQUENCY)
- [¡He encontrado un problema mientras uso phpMussel y no sé qué hacer al respecto! ¡Por favor ayuda!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Quiero usar phpMussel con una versión de PHP más vieja que 5.4.0; ¿Puede usted ayudar?](#MINIMUM_PHP_VERSION)
- [¿Puedo usar una sola instalación de phpMussel para proteger múltiples dominios?](#PROTECT_MULTIPLE_DOMAINS)
- [No quiero molestarme con la instalación de este y conseguir que funcione con mi sitio web; ¿Puedo pagarte por hacer todo por mí?](#PAY_YOU_TO_DO_IT)
- [¿Puedo contratar a usted oa cualquiera de los desarrolladores de este proyecto para el trabajo privado?](#HIRE_FOR_PRIVATE_WORK)
- [Necesito modificaciones especiales, personalizaciones, etc; ¿Puede usted ayudar?](#SPECIALIST_MODIFICATIONS)
- [Soy desarrollador, diseñador de sitios web o programador. ¿Puedo aceptar u ofrecer trabajos relacionados con este proyecto?](#ACCEPT_OR_OFFER_WORK)
- [Quiero contribuir al proyecto; ¿Puedo hacer esto?](#WANT_TO_CONTRIBUTE)
- [Valores recomendados para "ipaddr".](#RECOMMENDED_VALUES_FOR_IPADDR)
- [¿Cómo acceder a detalles específicos sobre los archivos cuando se escanean?](#SCAN_DEBUGGING)
- [¿Puedo usar cron para actualizar automáticamente?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [¿Puede phpMussel escanear archivos con nombres que no sean ANSI?](#SCAN_NON_ANSI)
- [Listas negras – Listas blancas – Listas grises – ¿Qué son y cómo los uso?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>¿Qué es una "firma"?

En el contexto de phpMussel, una "firma" se refiere a datos que actúan como un indicador/identificador para algo específico que estamos buscando, generalmente en la forma de algún segmento muy pequeño, distinto e inocuo de algo más grande y de otra manera nocivo, como un virus o un troyano, o en la forma de una suma de comprobación de archivo, hash u otro indicador de identificación similar, and usually includes a label, y generalmente incluye una etiqueta, y algunos otros datos para ayudar a proporcionar algún contexto adicional que puede ser utilizado por phpMussel para determinar la mejor manera de proceder cuando se encuentra con lo que estamos buscando.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>¿Qué es un "falso positivo"?

El término "falso positivo" (*alternativamente: "error falso positivo"; "falsa alarma"*; Inglés: *false positive*; *false positive error*; *false alarm*), descrito muy simplemente, y en un contexto generalizado, se utiliza cuando se prueba para una condición, para referirse a los resultados de esa prueba, cuando los resultados son positivos (es decir, la condición se determina como "positivo", o "verdadero"), pero se espera que sean (o debería haber sido) negativo (es decir, la condición, en realidad, es "negativo", o "falso"). Un "falso positivo" podría considerarse análoga a "llorando lobo" (donde la condición que se está probando es si hay un lobo cerca de la manada, la condición es "falso" en el que no hay lobo cerca de la manada, y la condición se reporta como "positiva" por el pastor a modo de llamando "lobo, lobo"), o análogos a situaciones en las pruebas médicas donde un paciente es diagnosticado con alguna enfermedad o dolencia, cuando en realidad, no tienen tal enfermedad o dolencia.

Algunos términos relacionados para cuando se prueba para un condición son "verdadero positivo", "verdadero negativo" y "falso negativo". Un "verdadero positivo" se refiere a cuando los resultados de la prueba y el estado real de la condición son ambas verdaderas (o "positivas"), y un "verdadero negativo" se refiere a cuando los resultados de la prueba y el estado real de la condición son ambas falsas (o "negativas"); Un "verdadero positivo" o "negativo verdadero" se considera que es una "inferencia correcta". La antítesis de un "falso positivo" es un "falso negativo"; Un "falso negativo" se refiere a cuando los resultados de la prueba son negativos (es decir, la condición se determina como "negativo", o "falso"), pero se espera que sean (o debería haber sido) positivo (es decir, la condición, en realidad, es "positivo", o "verdadero").

En el contexto de phpMussel, estos términos se refieren a las firmas de phpMussel y los archivos que se bloquean. Cuando phpMussel se bloquean un archivo debido al mal, obsoleta o firmas incorrectas, pero no debería haber hecho, o cuando lo hace por las razones equivocadas, nos referimos a este evento como un "falso positivo". Cuando phpMussel no puede bloquear un archivo que debería haber sido bloqueado, debido a las amenazas imprevistas, firmas perdidas o déficit en sus firmas, nos referimos a este evento como una "detección perdida" o "missed detection" (que es análogo a un "falso negativo").

Esto se puede resumir en la siguiente tabla:

&nbsp; | phpMussel *NO* debe bloquear un archivo | phpMussel *DEBE* bloquear un archivo
---|---|---
phpMussel *NO* hace bloquear un archivo | Verdadero negativo (inferencia correcta) | Detección perdida (análogo a un falso negativo)
phpMussel *HACE* bloquear un archivo | __Falso positivo__ | Verdadero positivo (inferencia correcta)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>¿Con qué frecuencia se actualizan las firmas?

La frecuencia de actualización varía dependiendo de los archivos de firma en cuestión. Todos los mantenedores de los archivos de firma para phpMussel generalmente tratan de mantener sus firmas tan actualizadas como sea posible, pero como todos nosotros tenemos varios otros compromisos, nuestras vidas fuera del proyecto, y como ninguno de nosotros es financieramente compensado (o pagado) por nuestros esfuerzos en el proyecto, no se puede garantizar un calendario de actualización preciso. Generalmente, las firmas se actualizan siempre que haya suficiente tiempo para actualizarlas, y generalmente, los mantenedores tratan de priorizar basándose en la necesidad y en la frecuencia con la que ocurren cambios entre rangos. La ayuda siempre es apreciada si usted está dispuesto a ofrecer cualquiera.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>¡He encontrado un problema mientras uso phpMussel y no sé qué hacer al respecto! ¡Por favor ayuda!

- ¿Está utilizando la última versión del software? ¿Está utilizando las últimas versiones de sus archivos de firma? Si la respuesta a cualquiera de estas dos preguntas es no, intente actualizar todo primero, y compruebe si el problema persiste. Si persiste, continúe leyendo.
- ¿Ha revisado toda la documentación? Si no, por favor, hágalo. Si el problema no puede resolverse utilizando la documentación, continúe leyendo.
- ¿Ha revisado la **[página de issues](https://github.com/phpMussel/phpMussel/issues)**, para ver si el problema ha sido mencionado antes? Si se ha mencionado antes, compruebe si se han proporcionado sugerencias, ideas y/o soluciones, y siga según sea necesario para tratar de resolver el problema.
- Si el problema persiste, solicite ayuda al crear un nuevo issue en la página de issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Quiero usar phpMussel con una versión de PHP más vieja que 5.4.0; ¿Puede usted ayudar?

No. PHP 5.4.0 llegó a EoL oficial ("End of Life", o fin de la vida) en 2014, y el soporte extendido de la seguridad fue terminado en 2015. Al escribir esto, es 2017, y PHP 7.1.0 ya está disponible. En este momento, se proporciona soporte para el uso de phpMussel con PHP 5.4.0 y todas las nuevas versiones PHP disponibles, pero si intenta usar phpMussel con versiones anteriores de PHP, no se proporcionará soporte.

*Ver también: [Gráficos de Compatibilidad](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>¿Puedo usar una sola instalación de phpMussel para proteger múltiples dominios?

Sí. Las instalaciones de phpMussel no están ligados naturalmente en dominios específicos, y por lo tanto puede ser utilizado para proteger múltiples dominios. En general, nos referimos a las instalaciones de phpMussel que protegen solo un dominio como "instalaciones solo-dominio" ("single-domain installations"), y nos referimos a las instalaciones de phpMussel que protegen múltiples dominios y/o subdominios como "instalaciones multi-dominio" ("multi-domain installations"). Si utiliza una instalación multi-dominio y es necesario utilizar diferentes conjuntos de archivos de firmas para diferentes dominios, o si phpMussel debe configurarse de manera diferente para diferentes dominios, es posible hacer esto. Después de cargar el archivo de configuración (`config.ini`), phpMussel comprobará la existencia de un "archivo de sustitución para configuración" específico del dominio (o subdominio) que se solicita (`el-dominio-que-se-solicita.tld.config.ini`), y si se encuentra, cualquier valor de configuración definido por el archivo de sustitución para configuración se utilizará para la instancia de ejecución en lugar de los valores de configuración definidos por el archivo de configuración. Los archivos de sustitución para configuración son idénticos al archivo de configuración, ya su discreción, puede contener la totalidad de todas las directivas de configuración disponibles para phpMussel, o lo que sea subsección necesaria que difiera de los valores normalmente definidos por el archivo de configuración. Los archivos de sustitución para configuración se nombran de acuerdo con el dominio al que están destinados (así por ejemplo, si se requiere un archivo de sustitución para configuración para el dominio, `http://www.some-domain.tld/`, su archivo de sustitución para configuración debe ser nombrado como `some-domain.tld.config.ini`, y debe colocarse dentro de la vault junto con el archivo de configuración, `config.ini`). El nombre del dominio para la instancia de ejecución se deriva del encabezado `HTTP_HOST` de la solicitud; "www" se ignora.

#### <a name="PAY_YOU_TO_DO_IT"></a>No quiero molestarme con la instalación de este y conseguir que funcione con mi sitio web; ¿Puedo pagarte por hacer todo por mí?

Quizás. Esto se considera caso por caso. Háganos saber lo que necesita, lo que está ofreciendo y le diremos si podemos ayudar.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>¿Puedo contratar a usted oa cualquiera de los desarrolladores de este proyecto para el trabajo privado?

*Ver la respuesta anterior.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Necesito modificaciones especiales, personalizaciones, etc; ¿Puede usted ayudar?

*Ver la respuesta anterior.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Soy desarrollador, diseñador de sitios web o programador. ¿Puedo aceptar u ofrecer trabajos relacionados con este proyecto?

Sí. Nuestra licencia no lo prohíbe.

#### <a name="WANT_TO_CONTRIBUTE"></a>Quiero contribuir al proyecto; ¿Puedo hacer esto?

Sí. Las contribuciones al proyecto son muy bienvenidas. Consulte "CONTRIBUTING.md" para obtener más información.

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>Valores recomendados para "ipaddr".

Valor | Utilizando
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy inverso Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy inverso Cloudflare.
`CF-Connecting-IP` | Proxy inverso Cloudflare (alternativa; si lo anterior no funciona).
`HTTP_X_FORWARDED_FOR` | Proxy inverso Cloudbric.
`X-Forwarded-For` | [Proxy inverso Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Definido por la configuración del servidor.* | [Proxy inverso Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Sin proxy inverso (valor predefinido).

#### <a name="SCAN_DEBUGGING"></a>¿Cómo acceder a detalles específicos sobre los archivos cuando se escanean?

Puede acceder a detalles específicos sobre los archivos cuando se analizan por medio de asignando una matriz para utilizarla con este fin antes de instruir a phpMussel para que los escanee.

En el ejemplo siguiente, `$Foo` está asignado para este propósito. Después de escanear `/ruta/de/archivo/...`, `$Foo` contendrá información detallada sobre los archivos contenidos en `/ruta/de/archivo/...`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/ruta/de/archivo/...');

var_dump($Foo);
```

La matriz es una matriz multidimensional que consta de elementos que representan cada archivo que se está escaneando y subelementos que representan los detalles sobre estos archivos. Estos subelementos son los siguientes:

- Filename (`string`)
- FromCache (`bool`)
- Depth (`int`)
- Size (`int`)
- MD5 (`string`)
- SHA1 (`string`)
- CRC32B (`string`)
- 2CC (`string`)
- 4CC (`string`)
- ScanPhase (`string`)
- Container (`string`)
- † FileSwitch (`string`)
- † Is_ELF (`bool`)
- † Is_Graphics (`bool`)
- † Is_HTML (`bool`)
- † Is_Email (`bool`)
- † Is_MachO (`bool`)
- † Is_PDF (`bool`)
- † Is_SWF (`bool`)
- † Is_PE (`bool`)
- † Is_Not_HTML (`bool`)
- † Is_Not_PHP (`bool`)
- ‡ NumOfSections (`int`)
- ‡ PEFileDescription (`string`)
- ‡ PEFileVersion (`string`)
- ‡ PEProductName (`string`)
- ‡ PEProductVersion (`string`)
- ‡ PECopyright (`string`)
- ‡ PEOriginalFilename (`string`)
- ‡ PECompanyName (`string`)
- Results (`int`)
- Output (`string`)

*† - No se proporciona con resultados almacenados en caché (sólo se proporcionan para los nuevos resultados de escaneo).*

*‡ - Sólo se proporciona al escanear archivos PE.*

Opcionalmente, esta matriz se puede destruir utilizando lo siguiente:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>¿Puedo usar cron para actualizar automáticamente?

Sí. Una API está integrada en el front-end para interactuar con la página de actualizaciones a través de scripts externos. Un script separado, "[Cronable](https://github.com/Maikuolan/Cronable)", está disponible, y puede ser utilizado por su cron manager o cron scheduler para actualizar este y otros paquetes soportados automáticamente (este script proporciona su propia documentación).

#### <a name="SCAN_NON_ANSI"></a>¿Puede phpMussel escanear archivos con nombres que no sean ANSI?

Digamos que hay un directorio que quiere escanear. En este directorio, tiene algunos archivos con nombres que no son ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Supongamos que está utilizando el modo CLI o la API de phpMussel para escanear.

Al usar PHP < 7.1.0, en algunos sistemas, phpMussel no verá estos archivos cuando intente escanear el directorio y, por lo tanto, no podrá escanear estos archivos. Es probable que vea los mismos resultados que si escaneara un directorio vacío:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniciado.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

Además, al usar PHP < 7.1.0, el escaneo de los archivos individualmente produce resultados como estos:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniciado.
 > Comprobando 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> ¡Archivo no válido!
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

O estos:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniciado.
 > X:/directory/??????.txt no es un archivo o directorio.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

Esto se debe a la forma en que PHP manejó los nombres de archivo no ANSI antes de PHP 7.1.0. Si experimenta este problema, la solución es actualizar su instalación de PHP a 7.1.0 o más reciente. En PHP >= 7.1.0, los nombres de archivo no ANSI se manejan mejor, y phpMussel debería poder escanear los archivos correctamente.

A modo de comparación, los resultados al intentar escanear el directorio usando PHP >= 7.1.0:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniciado.
 -> Comprobando '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> No problemas encontrado.
 -> Comprobando '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> No problemas encontrado.
 -> Comprobando '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> No problemas encontrado.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

E intentando escanear los archivos individualmente:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Iniciado.
 > Comprobando 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> No problemas encontrado.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

#### <a name="BLACK_WHITE_GREY"></a>Listas negras – Listas blancas – Listas grises – ¿Qué son y cómo los uso?

Los términos transmiten diferentes significados en diferentes contextos. En phpMussel, hay tres contextos en los que se usan estos términos: Respuesta del tamaño de archivo, respuesta del tipo de archivo, y la lista gris de firmas.

Para lograr un resultado deseado con un costo mínimo de procesamiento, hay algunas cosas simples que phpMussel puede verificar antes de escanear archivos, como el tamaño, el nombre y la extensión de un archivo. Por ejemplo; Si un archivo es demasiado grande o si su extensión indica un tipo de archivo que de todos modos no queremos permitir en nuestros sitios web, podemos marcar el archivo inmediatamente y no es necesario que lo analice.

La respuesta del tamaño de archivo es la forma en que phpMussel responde cuando un archivo excede un límite especificado. Aunque no hay listas reales, un archivo se puede considerar efectivamente incluido en la lista negra, en la lista blanca o en la lista gris, según su tamaño. Existen dos directivas de configuración opcionales independientes para especificar un límite y la respuesta deseada, respectivamente.

La respuesta del tipo de archivo es la forma en que phpMussel responde a la extensión del archivo. Existen tres directivas de configuración opcionales independientes para especificar explícitamente qué extensiones deben incluirse en la lista negra, en la lista blanca, o en la lista gris. Un archivo puede considerarse efectivamente incluido en la lista negra, en la lista blanca, o en la lista gris si su extensión coincide con cualquiera de las extensiones especificadas, respectivamente.

En estos dos contextos, al ser incluido en la lista blanca significa que no debe escanearse ni marcarse; estar en la lista negra significa que debe estar marcado (y por lo tanto no es necesario escanearlo); y estar en la lista gris significa que se requiere un análisis adicional para determinar si debemos marcarlo (es decir, debe escanearse).

La lista gris de firmas es una lista de firmas que esencialmente deben ignorarse (esto se menciona brevemente anteriormente en la documentación). Cuando se desencadena una firma en la lista gris de la firma, phpMussel continúa trabajando a través de sus firmas y no toma ninguna medida particular con respecto a la firma desencadenada. No hay una lista negra de firmas, porque el comportamiento implícito es un comportamiento normal para las firmas desencadenadas de todos modos, y no hay una lista blanca de firmas, porque el comportamiento implícito no tendría sentido considerando el funcionamiento normal de phpMussel y las capacidades que ya posee.

La lista gris de firmas es útil si necesita resolver problemas causados por una firma particular sin deshabilitar o desinstalar todo el archivo de firmas.

---


### 11. <a name="SECTION11"></a>INFORMACIÓN LEGAL

#### 11.0 PREÁMBULO DE SECCIÓN

La intención de esta sección de la documentación es para describir posibles consideraciones legales con respecto al uso y la implementación del paquete, y para proporcionar cierta información básica relacionada. Esto puede ser importante para algunos usuarios como un medio para garantizar el cumplimiento de los requisitos legales que puedan existir en los países en los que operan, y algunos usuarios pueden necesitar ajustar las políticas de su sitio web de acuerdo con esta información.

Primero y ante todo, tenga en cuenta que yo (el autor del paquete) no soy un abogado, ni un profesional legal calificado de ningún tipo. Por lo tanto, no estoy legalmente calificado para brindar asesoramiento legal. Además, en algunos casos, los requisitos legales exactos pueden variar entre diferentes países y jurisdicciones, y estos diferentes requisitos legales pueden a veces entrar en conflicto (como, por ejemplo, en el caso de países que favorecen los [derechos de privacidad](https://es.wikipedia.org/wiki/Derecho_a_la_intimidad) y el [derecho a ser olvidado](https://es.wikipedia.org/wiki/Derecho_al_olvido), frente a los países que favorecen la [retención de datos extendida](https://es.wikipedia.org/wiki/Retenci%C3%B3n_de_datos_de_telecomunicaci%C3%B3n)). Considere también que el acceso al paquete no está restringido a países o jurisdicciones específicos, y por lo tanto, es probable que la base de usuarios del paquete sea geográficamente diversa. Considerados estos puntos, no estoy en condiciones de decir lo que significa ser "legalmente compatible" para todos los usuarios, en todos los aspectos. Sin embargo, espero que la información en este documento lo ayude a tomar una decisión sobre lo que debe hacer para cumplir con la ley en el contexto del paquete. Si tiene alguna duda o inquietud con respecto a la información aquí incluida, o si necesita ayuda y asesoramiento adicional desde una perspectiva legal, le recomiendo consultar a un profesional legal calificado.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Directivas de configuración relevantes:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Directivas de configuración relevantes:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Directivas de configuración relevantes:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 LOGGING

Logging is an important part of phpMussel for a number of reasons. Without logging, it may be difficult to diagnose false positives, to ascertain exactly how performant phpMussel is in any particular context, and to determine where its shortfalls may be, and what changes may be required to its configuration or signatures accordingly, in order for it to continue functioning as intended. Regardless, logging mightn't be desirable for all users, and remains entirely optional. In phpMussel, logging is disabled by default. To enable it, phpMussel must be configured accordingly.

Additionally, whether logging is legally permissible, and to the extent that it is legally permissible (e.g., the types of information that may logged, for how long, and under what circumstances), may vary, depending on jurisdiction and on the context where phpMussel is implemented (e.g., whether you're operating as an individual, as a corporate entity, and whether on a commercial or non-commercial basis). It may therefore be useful for you to read through this section carefully.

There are multiple types of logging that phpMussel can perform. Different types of logging involves different types of information, for different reasons.

##### 11.3.0 SCAN LOGS

When enabled in the package configuration, phpMussel keeps logs of the files it scans. This type of logging is available in two different formats:
- Human readable logfiles.
- Serialised logfiles.

Entries to a human readable logfile typically look something like this (as an example):

```
Mon, 21 May 2018 00:47:58 +0800 Started.
> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Detected phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Finished.
```

A scan log entry typically includes the following information:
- The date and time that the file was scanned.
- The name of the file scanned.
- CRC32b hashes of the name and contents of the file.
- What was detected in the file (if anything was detected).

*Directivas de configuración relevantes:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

When these directives are left empty, this type of logging will remain disabled.

##### 11.3.1 SCAN KILLS

When enabled in the package configuration, phpMussel keeps logs of the uploads that have been blocked.

Entries to a "scan kills" logfile typically look something like this (as an example):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Detected phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Quarantined as "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu".
```

A "scan kills" entry typically includes the following information:
- The date and time that the upload was blocked.
- The IP address where the upload originated from.
- The reason why the file was blocked (what was detected).
- The name of the file blocked.
- An MD5 and the size of the file blocked.
- Whether the file was quarantined, and under what internal name.

*Directivas de configuración relevantes:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Directivas de configuración relevantes:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Directivas de configuración relevantes:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Directivas de configuración relevantes:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Directivas de configuración relevantes:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Directivas de configuración relevantes:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Directivas de configuración relevantes:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Directivas de configuración relevantes:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

El Reglamento General de Protección de Datos (GDPR) es un reglamento de la Unión Europea, que entra en vigor el 25 Mayo de 2018. El objetivo principal de la regulación es dar control a los ciudadanos y residentes de la UE con respecto a sus propios datos personales, y unificar la regulación dentro de la UE con respecto a la privacidad y los datos personales.

El reglamento contiene disposiciones específicas relativas al procesamiento de [información de identificación personal](https://es.wikipedia.org/wiki/Informaci%C3%B3n_personal) de cualquier "sujeto de datos" (cualquier persona física identificada o identificable) de la UE o dentro de ella. Para cumplir con la regulación, las "empresas" (según lo definido por la regulación) y cualquier sistema y proceso relevante deben implementar "privacidad por diseño" como estándar, debe usar la configuración de privacidad más alta posible, debe implementar las salvaguardas necesarias para cualquier información almacenada o procesada (incluyendo, pero no limitado a, la implementación de seudonimización o anonimización completa de datos), debe declarar clara e inequívocamente los tipos de datos que recopilan, cómo lo procesan, por qué motivos, por cuánto tiempo lo retienen, y si comparten estos datos con terceros, los tipos de datos compartidos con terceros, cómo, por qué, y así sucesivamente.

Los datos no pueden procesarse a menos que haya una base legal para hacerlo, según lo definido por la regulación. Generalmente, esto significa que para procesar los datos de un sujeto de datos de manera legal, debe hacerse de conformidad con las obligaciones legales, o solo después de que se haya obtenido el consentimiento explícito, bien informado e inequívoco del sujeto de los datos.

Debido a que algunos aspectos de la regulación pueden evolucionar en el tiempo, para evitar la propagación de información desactualizada, puede ser mejor aprender sobre la regulación desde una fuente autorizada, en lugar de simplemente incluir la información relevante aquí en la documentación del paquete (que puede con el tiempo se volverá obsoleto a medida que la regulación evolucione).

[EUR-Lex](https://eur-lex.europa.eu/) (una parte del sitio web oficial de la Unión Europea que proporciona información sobre la legislación de la UE) proporciona amplia información sobre GDPR/DSGVO, disponible en 24 idiomas diferentes (al momento de escribir esto), y disponible para su descarga en formato PDF. Definitivamente recomendaría leer la información que proporcionan, para aprender más sobre GDPR/DSGVO:
- [REGLAMENTO (UE) 2016/679 DEL PARLAMENTO EUROPEO Y DEL CONSEJO](https://eur-lex.europa.eu/legal-content/ES/TXT/?uri=celex:32016R0679)

Alternativamente, hay una breve descripción (no autoritativa) de GDPR/DSGVO disponible en Wikipedia:
- [Reglamento General de Protección de Datos](https://es.wikipedia.org/wiki/Reglamento_General_de_Protecci%C3%B3n_de_Datos)

---


Última Actualización: 25 Mayo de 2018 (2018.05.25).
