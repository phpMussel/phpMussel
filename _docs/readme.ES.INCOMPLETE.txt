      _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

                            { ~ ~ ~ ESPAÑOL ~ ~ ~ }
 CONTENIDOS
 1. PREÁMBULO
 2A. CÓMO INSTALAR (PARA NAVEGADORES)
 2B. CÓMO INSTALAR (PARA CLI)
 3A. CÓMO USO (PARA NAVEGADORES)
 3B. CÓMO USO (PARA CLI)
 4A. NAVEGADOR COMANDOS
 4B. CLI (COMANDOS LÍNEA INTERFAZ)
 5. ARCHIVOS INCLUIDOS EN ESTE PAQUETE
 6. CONFIGURACIÓN OPCIONES
 7. FIRMA FORMATOS
 8. CONOCIDOS PROBLEMAS DE COMPATIBILIDAD

                                     ~ ~ ~


 1. PREÁMBULO

 Gracias por usar phpMussel, un PHP script diseñado para detectar troyanos,
 virus, malware y otras amenazas en los archivos cargados en el sistema donde
 el script está adjunto, basado en las firmas de ClamAV y otros.

 PHPMUSSEL COPYRIGHT 2013 and beyond GNU/GPL V.2 by Caleb M (Maikuolan).

 Este script es gratis software; puede redistribuirlo y/o modificarlo según los
 términos de la GNU General Pública Licencia como publicada por la Free
 Software Foundation; versión 2 de la licencia, o cualquier posterior versión.
 Este script se distribuye con la esperanza de que será útil, pero SIN NINGUNA
 GARANTÍA; también, sin ninguna implícita garantía de COMERCIALIZACIÓN o
 IDONEIDAD PARA UN PARTICULAR PROPÓSITO. Vea la GNU General Pública Licencia
 para más detalles. <http://www.gnu.org/licenses/>
 <http://opensource.org/licenses/>

 Un especial agradecimiento a ClamAV para la inspiración del proyecto y para
 las firmas que este script utiliza, sin la cual, el guión probablemente no
 existiría, o en el mejor de, tendría un muy limitado valor
 <http://www.clamav.net/>.

 Un especial agradecimiento a Sourceforge para alojar los archivos de proyecto,
 situado en <http://sourceforge.net/projects/phpmussel/>, a Spambot Security
 para la phpMussel discusión foros, situado en
 <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, y a las adicionales
 fuentes de un número de las firmas utilizadas por phpMussel: SecuriteInfo.com
 <http://www.securiteinfo.com/>, PhishTank <http://www.phishtank.com/>,
 NLNetLabs <http://nlnetlabs.nl/> y otros, y agradecimiento especial a todos
 aquellos que apoyan el proyecto, a cualquier otra persona que yo haya olvidado
 de lo contrario mencionar, y a usted, por el uso de la script.

 Este documento y asociado paquete pueden descargar de gratis desde
 Sourceforge <http://sourceforge.net/projects/phpmussel/>.

                                     ~ ~ ~


 2A. CÓMO INSTALAR (PARA NAVEGADORES)

 Espero para agilizar este proceso al hacer un instalador en algún momento en
 un futuro no muy lejano, pero hasta entonces, siga estas instrucciones para ha
 phpMussel functione en *mayoría de sistemas y CMS:

 1) Con tu leyendo esto, estoy asumiendo que usted ha descargado una archivada
    copia de la script, descomprimido y tenerlo en algún lugar en su computer.
    Desde aquí, usted querrá averiguar dónde en el host o CMS que desea para
    colocar el contenido. Un directorio como /public_html/phpmussel/ o similar
    (aunque, no importa que usted elija, a condición de que se algo que estés
    satisfecho con) será suficiente. Antes usted enviar archivos a su host,
    seguir leyendo..

 2) Abrir "phpmussel.php", busque la línea que comienza con "$vault=", y
    reemplazar la cadena entre las siguientes comillas en esa línea con la
    exacta verdadera ubicación del "vault" directorio de phpMussel. Usted verá
    tal un directorio en el archivado que ha descargado (asumiendo que no desea
    revolver todo el guión, mantener la misma estructura de archivos y
    directorios como lo fue el original). Este "vault" directorio normalmente
    es un directorio nivel más allá del directorio que existirá en el
    "phpmussel.php" archivo. Guardar el archivo, cerrar.

 3) (Opcional; Muy recomendable para avanzados usuarios, pero no se recomienda
    para los principiantes o para los inexpertos): Abrir "phpmussel.ini"
    (situado en el interior del "vault") - Este archivo contiene todas las
    disponibles operativas opciones para phpMussel. Por encima de cada opción
    debe ser un breve comentario que describe lo que hace y para lo qué sirve.
    Ajuste estas opciones según sus necesidades, según lo que sea apropiado
    para su particular configuración. Guardar archivo, cerrar.

 4) Cargar contenido (phpMussel y sus archivos) al directorio que habías
    decidido sobre más temprano (no es necesario el readme.XX.txt archivo o el
    change_log.txt archivo, pero, en su mayoría, usted debe cargar todos).

 5) CMHOD al "vault" directorio a "777". La principal directorio de
    almacenamiento de los contenidos (el uno decidió desde antes), en general,
    puede dejar solos, pero CHMOD estado debe comprobar si ha tenido problemas
    de permisos en el pasado en su sistema (por defecto, debe ser algo como
    "755").

 6) Luego, tendrás que phpMussel "gancho" para el sistema o CMS. Hay varias
    maneras en que usted puede "gancho" scripts como phpMussel a su sistema o
    CMS, pero lo más fácil es simplemente incluir el script al principio de un
    núcleo archivo de su sistema o CMS (uno que va por lo general siempre se va
    cargado cuando alguien accede cualquier página a través de su website)
    utilizando un require o include comando. Por lo general, esto va ser algo
    almacenado en un directorio como "/includes", "/assets" o "/functions", y
    será menudo llamado algo así como "init.php", "common_functions.php",
    "functions.php" o similar. Vas a tener que averiguar qué archivo se por su
    situación. Para ello, inserte la siguiente línea de código al principio de
    ese núcleo archivo, con sustitución de la string contenida dentro las
    comillas con la exacta dirección del "phpmussel.php" archivo (local
    dirección, no la HTTP dirección; que será similar a la "vault" dirección
    mencionó anteriormente).

    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>

    Guardar archivo, cerrarla, cargar de nuevo.

 7) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de
    que está funcionando correctamente. Para probar archivos carga
    protecciones, probar cargar los prueba archivos incluidos en el paquete
    dentro "_testfiles" a su website a través de sus habituales navegador
    basado cargar métodos. Si todo funciona correctamente, un mensaje debe
    aparecer de phpMussel confirmando que la carga ha sido bloqueada con éxito.
    Si nada aparece, algo no está funcionando correctamente. Si está utilizando
    cualquiera de las avanzadas funciones o si está utilizando los otros tipos
    de escaneo posible, Sugiero probarlo con aquellos a asegurarse de que
    funciona como se espera, también.

                                     ~ ~ ~


 2B. CÓMO INSTALAR (PARA CLI)

 Espero para agilizar este proceso al hacer un instalador en algún momento en
 un futuro no muy lejano, pero hasta entonces, siga estas instrucciones para ha
 phpMussel listo para trabajar con CLI (ser conscientes de que en este momento,
 CLI apoyo sólo se aplica a los Windows basados sistemas; Linux y otros
 sistemas vendrán pronto a una posterior versión de phpMussel):

 1) Con tu leyendo esto, estoy asumiendo que usted ha descargado una archivada
    copia de la script, descomprimido y tenerlo en algún lugar en su computer.
    Cuando se ha determinado que usted es feliz con el lugar elegido para
    phpMussel, continúe.

 2) phpMussel requiere php para ser instalado en la host máquina para ejecutar.
    Si usted no has php instalado en su máquina, por favor, instalar php en su
    máquina, siguiendo las instrucciones suministradas por el php instalador.

 3) Abrir "phpmussel.php", busque la línea que comienza con "$vault=", y
    reemplazar la cadena entre las siguientes comillas en esa línea con la
    exacta verdadera ubicación del "vault" directorio de phpMussel. Usted verá
    tal un directorio en el archivado que ha descargado (asumiendo que no desea
    revolver todo el guión, mantener la misma estructura de archivos y
    directorios como lo fue el original). Este "vault" directorio normalmente
    es un directorio nivel más allá del directorio que existirá en el
    "phpmussel.php" archivo. Guardar el archivo, cerrar.

 4) (Opcional; Muy recomendable para avanzados usuarios, pero no se recomienda
    para los principiantes o para los inexpertos): Abrir "phpmussel.ini"
    (situado en el interior del "vault") - Este archivo contiene todas las
    disponibles operativas opciones para phpMussel. Por encima de cada opción
    debe ser un breve comentario que describe lo que hace y para lo qué sirve.
    Ajuste estas opciones según sus necesidades, según lo que sea apropiado
    para su particular configuración. Guardar archivo, cerrar.

 5) (Opcional) Usted puede hacer uso de phpMussel en CLI modo más fácil para ti
    mismo mediante la creación de un batch archivo para automáticamente cargar
    php y phpMussel. Para ello, abra un texto editor como Notepad o Notepad++,
    escriba la completa ruta al "php.exe" archivo dentro lo directorio de la
    php instalación, seguido de un espacio, seguido de la completa ruta al
    "phpmussel.php" archivo dentro lo directorio de su phpMussel instalación,
    guardar el archivo con la ".bat" extensión en alguna parte que usted lo
    encontrará fácilmente, y haga doble clic en ese archivo para ejecutar
    phpMussel en el futuro.

 6) Con eso, ya está! Pero, probablemente deberías preubalo para asegurarse de
    que está funcionando correctamente. Para probar phpMussel, ejecute
    phpMussel e probar escanear el directorio "_testfiles" suministrada con el
    paquete.

                                     ~ ~ ~


 3A. CÓMO USO (PARA NAVEGADORES)

 phpMussel es un script diseñado para funcionar adecuadamente, inmediatamente,
 con mínimo nivel de requisitos en su nombre: Cuando se ha instalado,
 básicamente, que simplemente debería funcionar.

 Escaneo de archivos cargas es automatizado y activado como estándar, así, nada
 se requerida en su nombre por esta particular función.

 Pero, también es capaz instruirá phpMussel para escanear archivos, directorios
 o compactos archivos usted especifique implícitamente. Para ello,
 primeramente, usted tendrá asegurarse de que la adecuada configuración se
 establece el la phpmussel.ini archivo (cleanup debe estar desactivado), y
 cuando hecho, en un PHP archivo conectado a phpMussel, utilice la siguiente
 función en su código:

 phpMussel($what_to_scan,$output_type,$output_flatness);

 Dónde:
  - $what_to_scan es una cadena o una array, apuntando a un destino archivo, un
   destino directorio o un array de destinos archivos y/o destinos directorios.
 - $output_type es un entero, indicando el formato en el que los resultados son
   para estar de regreso como. Un valor de 0 indica a la función para devolver
   resultados como un entero (un resultado devuelto de -2 indica que se ha
   corruptos datos detectados durante el escanear y por lo tanto el escanear no
   pudo completar, -1 indica que las extensiones o complementos requeridos por
   php para ejecutar el escaneo faltaban y por lo tanto el escanear no pudo
   completar, 0 indica que la escanear objetivo no existe y por lo tanto no
   había nada para escanear, 1 indica que el objetivo fue escaneado con éxito
   y no se detectaron problemas, y 2 indica que el objetivo fue escaneado con
   éxito y se detectaron problemas). Un valor de 1 instruye la función a
   devuelva resultados como texto legible por humanos. Un valor de 2 instruye
   la función ambos a devuelva resultados como texto legible por humanos y a
   exportar los resultados a una global variable. Esta variable es opcional,
   predefinido como 0.
 - $output_flatness es un entero, indicando si se permite a los resultados que
   se devuelven como un array o no. Normalmente, si la escanear objetivo
   contenida varios artículos (por ejemplo, si un directorio o array) los
   resultados se devuelven en un array (valor predefinido de 0). Un valor de 1
   instruye la función implosionar cualquier array antes de la entrada,
   resultando en una aplanada cadena que contiene los resultados a devolver.
   Esta variable es opcional, predefinido como 0.

 Ejemplos:

   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;

   Devuelve algo como esto (como una cadena):
    Wed, 16 Sep 2013 02:49:46 +0000 Iniciado.
    > Verificando '/user_name/public_html/my_file.html':
    -> No problemas encontrado.
    Wed, 16 Sep 2013 02:49:47 +0000 Terminado.

 Para una descripción completa del tipo de firmas phpMussel utiliza durante el
 escanear y la forma en que maneja estas firmas, consulte la sección Firma
 Formatos de este README archivo.

 Si se encuentra algún falsos positivos, si se encuentra con algo nuevo que
 crees que debería ser bloqueada, o para cualquier otra cosa en relación con
 las firmas, por favor contacto conmigo al respecto para que pueda hacer los
 cambios necesarios, para que, si no se comunica conmigo, posiblemente no
 necesariamente tener en cuenta.

 Para desactivar las firmas que se incluyen con phpMussel (por ejemplo, si
 usted está experimentando un falso positivo específico para sus propósitos
 que normalmente no debería ser suprimido), consulte las notas de la Greylist
 en el Navegador Comandos sección de este README archivo.

 In addition to the default file upload scanning and the optional scanning
 of other files and/or directories specified via the above function, included
 in phpMussel is a function intended for scanning the body of email messages.
 This function behaves similarly to the standard phpMussel() function, but
 focuses solely on matching against the ClamAV email-based signatures. I have
 not tied these signatures into the standard phpMussel() function, because it
 is highly unlikely that you'd ever find the body of an incoming email message
 in need of scanning within a file upload targeted to a page where phpMussel is
 hooked, and thus, to tie these signatures into the phpMussel() function would
 be redundant. However, that said, having a separate function to match against
 these signatures could prove to be extremely useful for some, especially for
 those whose CMS or webfront system is somehow tied into their email system and
 for those of whom parse their emails via a php script of which they could
 potentially hook into phpMussel. Configuration for this function, like all
 others, is controlled via the phpmussel.ini file. To use this function (you'll
 need to do your own implementation), in a php file that is hooked to
 phpMussel, use the following function in your code:

 phpMussel_mail($body);

 Where $body is body of the email message you wish to scan (additionally, you
 could try scanning new forum posts, inbound messages from your online contact
 form or similar). If any error occurs preventing the function from completing
 its scan, a value of -1 will be returned. If the function completes its scan
 and does not match anything, a value of 0 will be returned (meaning clean).
 If, however, the function does match something, a string will be returned
 containing a message declaring what it has matched.

 In addition to the above, if you look at the source code, you may notice the
 function phpMusselD() and phpMusselR(). These functions are sub-functions of
 phpMussel(), and should not be called directly outside of that parent function
 (not because of adverse effects.. More-so, simply because it'd serve no
 purpose, and most probably won't actually work correctly anyhow).

 There are many other controls and functions available within phpMussel for
 your use, too. For any such controls and functions which, by the end of this
 section of the README, have not yet been documented, please continue reading
 and refer to the Browser Commands section of this README file.

                                     ~ ~ ~


 3B. CÓMO USO (PARA CLI)

 Please refer to the "HOW TO INSTALL (FOR CLI)" section of this readme file.

 Be aware that, although future versions of phpMussel should support other
 systems, at this time, phpMussel CLI mode support is only optimized for use on
 Windows-based system (you can, of course, try it on other systems, but I can't
 guarantee it'll work as intended).

 Also be aware that phpMussel is not the functional equivalent of a complete
 anti-virus suite, and unlike conventional anti-virus suites, does not monitor
 active memory or detect viruses on-the-fly! It will only detect viruses
 contained by those specific files that you explicitly tell it to scan.

                                     ~ ~ ~


 4A. NAVEGADOR COMANDOS

 Once phpMussel has been installed and is correctly functioning on your system,
 if you've set the script_password and logs_password variables in your
 configuration file, you will be able to perform some limited number of
 administrative functions and input some number of commands to phpMussel via
 your browser. The reason these passwords need to be set in order to enable
 these browser-side controls is both to ensure proper security, proper
 protection of these browser-side controls and to ensure that there exists
 a way for these browser-side controls to be entirely disabled if they are not
 desired by you and/or other webmasters/administrators using phpMussel. So, in
 other words, to enable these controls, set a pasword, and to disable these
 controls, set no password. Alternatively, if you choose to enable these
 controls and then choose to disable these controls at a later date, there is
 a command to do this (such can be useful if you perform some actions that you
 feel could potentially compromise the delegated passwords and need to quickly
 disable these controls without modifying your configuration file).

 A couple of reasons why you -should- enable these controls:
 - Provides a way to greylist signatures on-the-fly in instances such as when
   you discover a signature that is producing a false-positive while uploading
   files to your system and you don't have time to manually edit and reupload
   your greylist file.
 - Provides a way for you to allow someone other than yourself to control your
   copy of phpMussel without the implicit need to grant them access to FTP.
 - Provides a way to provide controlled access to your log files.
 - Provides an easy way to update phpMussel when updates are available.
 - Provides a way for you to monitor phpMussel when FTP access or other
   conventional access points for monitoring phpMussel are not available.

 A couple of reasons why you should -not- enable these controls:
 - Provides a vector for potential attackers and undesirables to determine
   whether you are using phpMussel or not (although, this could be both a
   reason for and a reason against, depending on perspective) by way of blindly
   sending commands to servers as a means to probe. On one hand, this could
   discourage attackers from targeting your system if they learn that you are
   using phpMussel, assuming that they are probing because their attack method
   is rendered ineffective as a result of using phpMussel. However, on the
   other hand, if some unforeseen and currently unknown exploit within
   phpMussel or a future version thereof comes to light, and if it could
   potentially provide an attack vector, a positive result from such probing
   could actually encourage attackers to target your system.
 - If your delegated passwords were ever compromised, unless changed, could
   provide a way for an attacker to bypass whatever signatures may be otherwise
   normally preventing their attacks from succeeding, or even potentially
   disable phpMussel altogether, thus providing a way to render the
   effectiveness of phpMussel moot.

 Either way, regardless of what you choose, the choice is ultimately yours. By
 default, these controls will be disabled, but have a think about it, and if
 you decide you want them, this section explains both how to enable them and
 how to use them.

 A list of available browser-side commands:

 scan_log
   Password required: logs_password
   Other requirements: scan_log must be set.
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   What it does: Prints the contents of your scan_log file to the screen.
   ~
 scan_kills
   Password required: logs_password
   Other requirements: scan_kills must be set.
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   What it does: Prints the contents of your scan_kills file to the screen.
   ~
 controls_lockout
   Password required: logs_password OR script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Example 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   What it does: Disables ("locks out") all browser-side controls. This should
                 be used if you suspect that either of your passwords have been
                 compromised (this can happen if you're using these controls
                 from a computer which is not secured and/or not trusted).
                 controls_lockout works by creating a file, controls.lck, in
                 your vault, which phpMussel will check for before performing
                 any commands of any kind. Once this happens, to reenable
                 controls, you'll need to manually delete the controls.lck file
                 via FTP or similar. Can be called using either password.
   ~
 disable
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=disable
   ~
   What it does: Disables phpMussel. This should be used if you're performing
                 any updates or changes to your system or if you're installing
                 any new software or modules to your system which either do or
                 potentially could trigger false positives. This should also be
                 used if you're having any problems with phpMussel but do not
                 wish to remove it from your system. Once this happens, to
                 reenable phpMussel, use "enable".
   ~
 enable
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=enable
   ~
   What it does: Enables phpMussel. This should be used if you've previously
                 disabled phpMussel using "disable" and want to reenable it.
   ~
 update
   Password required: script_password
   Other requirements: update.dat and update.inc must exist.
   Required parameters: (none)
   Optional parameters: forcedupdate
   Example: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   What it does: Checks for updates to both phpMussel and its signatures. If
                 update checks succeed and updates are found, will attempt
                 to download and install these updates. If updates are checked
                 too quickly, update check will abort. If update checks fail,
                 update will abort. If optional parameter "forcedupdate" is
                 supplied, time of last update will be ignored and thus update
                 check will continue even if it is being checked "too quickly",
                 but will still abort if update check fails. Results of the
                 entire process are printed to the screen. I recommend
                 including the optional parameter "forcedupdate" if you're
                 manually triggering this control, but please do not use
                 "forcedupdate" if you're automating the process, such as via
                 cron or similar. I recommend checking at least once per month
                 to ensure your signatures and your copy of phpMussel are kept
                 up to-date (unless, of course, you're checking for updates
                 and installing them manually, which, I'd still recommend
                 doing at least one per month). Checking more than twice per
                 month is probably pointless, considering I'm (at the time of
                 writing this) working on this project by myself and I'm very
                 unlikely to be able to produce updates of any kind more
                 frequently than that (nor do I particularly want to for the
                 most part).
   ~
 greylist
   Password required: script_password
   Other requirements: (none)
   Required parameters: [Name of signature to be greylisted]
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   What it does: Add a signature to the greylist.
   ~
 greylist_clear
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   What it does: Clears the entire greylist.
   ~
 greylist_show
   Password required: script_password
   Other requirements: (none)
   Required parameters: (none)
   Optional parameters: (none)
   Example: ?pword=[script_password]&phpmussel=greylist_show
   ~
   What it does: Prints the contents of the greylist to the screen.
   ~

                                     ~ ~ ~


 4B. CLI (COMMAND LINE INTERFACE)

 phpMussel can be run as an interactive file scanner in CLI mode under
 Windows-based systems. Refer to the "HOW TO INSTALL (FOR CLI)" section of this
 readme file for more details.

 For a list of available CLI commands, at the CLI prompt, type 'c', and press
 Enter.

                                     ~ ~ ~


 5. ARCHIVOS INCLUIDOS EN ESTE PAQUETE

 The following is a list of all of the files that should have been included
 in the archived copy of this script when you downloaded it, any files that may
 be potentially created as a result of your using this script, along with a
 short description of what all these files are for.

 /phpmussel.php (Script, Incluido)
    phpMussel Loader file. Loads the main script, updater, etcetera.
    This is what you're supposed to be hooking into (essential)!
    ~
 /web.config (Otro, Incluido)
    An ASP.NET configuration file (in this instance, to protect the "/vault"
    directory from being accessed by non-authorised sources in the event that
    the script is installed on a server based upon ASP.NET technologies).
    ~
 /_docs/ (Directory)
    Documentation directory (contains various files).
    ~
 /_docs/change_log.txt (Documentación, Incluido)
    A record of changes made to the script between different
    versions (not required for proper function of script).
    ~
 /_docs/readme.DE.txt (Documentación, Incluido); DEUTSCH
 /_docs/readme.EN.txt (Documentación, Incluido); ENGLISH
 /_docs/readme.ES.txt (Documentación, Incluido); ESPAÑOL
 /_docs/readme.FR.txt (Documentación, Incluido); FRANÇAIS
 /_docs/readme.ID.txt (Documentación, Incluido); BAHASA INDONESIA
 /_docs/readme.IT.txt (Documentación, Incluido); ITALIANO
 /_docs/readme.NL.txt (Documentación, Incluido); NEDERLANDSE
 /_docs/readme.PT.txt (Documentación, Incluido); PORTUGUÊS
    The README files (for example; the file you're currently reading).
    ~
 /_docs/signatures_tally.txt (Documentación, Incluido)
    Net-shift tally of included signatures (not required for proper function of
    script).
    ~
 /_testfiles/ (Directory)
    Test files directory (contains various files).
    All contained files are test files for testing if phpMussel was correctly
    installed on your system, and you do not need to upload this directory
    or any of its files except when doing such testing.
    ~
 /_testfiles/ascii_standard_testfile.txt (Prueba archivo, Incluido)
    Test file for testing phpMussel normalised ASCII signatures.
    ~
 /_testfiles/coex_testfile.rtf (Prueba archivo, Incluido)
    Test file for testing phpMussel Complex Extended signatures.
    ~
 /_testfiles/exe_standard_testfile.exe (Prueba archivo, Incluido)
    Test file for testing phpMussel PE signatures.
    ~
 /_testfiles/general_standard_testfile.txt (Prueba archivo, Incluido)
    Test file for testing phpMussel general signatures.
    ~
 /_testfiles/graphics_standard_testfile.gif (Prueba archivo, Incluido)
    Test file for testing phpMussel graphics signatures.
    ~
 /_testfiles/html_standard_testfile.txt (Prueba archivo, Incluido)
    Test file for testing phpMussel normalised HTML signatures.
    ~
 /_testfiles/md5_testfile.txt (Prueba archivo, Incluido)
    Test file for testing phpMussel MD5 signatures.
    ~
 /_testfiles/metadata_testfile.txt.gz (Prueba archivo, Incluido)
    Test file for testing phpMussel metadata signatures and for testing GZ file
    support on your system.
    ~
 /_testfiles/metadata_testfile.zip (Prueba archivo, Incluido)
    Test file for testing phpMussel metadata signatures and for testing ZIP
    file support on your system.
    ~
 /_testfiles/ole_testfile.ole (Prueba archivo, Incluido)
    Test file for testing phpMussel OLE signatures.
    ~
 /_testfiles/pdf_standard_testfile.pdf (Prueba archivo, Incluido)
    Test file for testing phpMussel PDF signatures.
    ~
 /_testfiles/pe_sectional_testfile.exe (Prueba archivo, Incluido)
    Test file for testing phpMussel PE Sectional signatures.
    ~
 /_testfiles/xdp_standard_testfile.xdp (Prueba archivo, Incluido)
    Test file for testing phpMussel XML/XDP-Chunk signatures.
    ~
 /vault/ (Directory)
    Vault directory (contains various files).
    ~
 /vault/quarantine/ (Directory)
    Quarantine directory (contains quarantined files).
    ~
 /vault/quarantine/.htaccess (Otro, Incluido)
    A hypertext access file (in this instance, to protect sensitive files
    belonging to the script from being accessed by non-authorised sources).
    ~
 /vault/.htaccess (Otro, Incluido)
    A hypertext access file (in this instance, to protect sensitive files
    belonging to the script from being accessed by non-authorised sources).
    ~
 /vault/ascii_clamav_regex.cvd (Firmas, Incluidos)
 /vault/ascii_clamav_regex.map (Firmas, Incluidos)
 /vault/ascii_clamav_standard.cvd (Firmas, Incluidos)
 /vault/ascii_clamav_standard.map (Firmas, Incluidos)
 /vault/ascii_custom_regex.cvd (Firmas, Incluidos)
 /vault/ascii_custom_standard.cvd (Firmas, Incluidos)
 /vault/ascii_mussel_regex.cvd (Firmas, Incluidos)
 /vault/ascii_mussel_standard.cvd (Firmas, Incluidos)
    Files for normalised ASCII signatures.
    Required if normalised ASCII signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/coex_clamav.cvd (Firmas, Incluidos)
 /vault/coex_custom.cvd (Firmas, Incluidos)
 /vault/coex_mussel.cvd (Firmas, Incluidos)
    Files for Complex Extended signatures.
    Required if the Complex Extended signatures option in phpmussel.ini is
    enabled. Can remove if the option is disabled (but files will be recreated
    on update).
    ~
 /vault/elf_clamav_regex.cvd (Firmas, Incluidos)
 /vault/elf_clamav_regex.map (Firmas, Incluidos)
 /vault/elf_clamav_standard.cvd (Firmas, Incluidos)
 /vault/elf_clamav_standard.map (Firmas, Incluidos)
 /vault/elf_custom_regex.cvd (Firmas, Incluidos)
 /vault/elf_custom_standard.cvd (Firmas, Incluidos)
 /vault/elf_mussel_regex.cvd (Firmas, Incluidos)
 /vault/elf_mussel_standard.cvd (Firmas, Incluidos)
    Files for ELF signatures.
    Required if ELF signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/exe_clamav_regex.cvd (Firmas, Incluidos)
 /vault/exe_clamav_regex.map (Firmas, Incluidos)
 /vault/exe_clamav_standard.cvd (Firmas, Incluidos)
 /vault/exe_clamav_standard.map (Firmas, Incluidos)
 /vault/exe_custom_regex.cvd (Firmas, Incluidos)
 /vault/exe_custom_standard.cvd (Firmas, Incluidos)
 /vault/exe_mussel_regex.cvd (Firmas, Incluidos)
 /vault/exe_mussel_standard.cvd (Firmas, Incluidos)
    Files for Portable Executable file (EXE) signatures.
    Required if EXE signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/filenames_clamav.cvd (Firmas, Incluidos)
 /vault/filenames_custom.cvd (Firmas, Incluidos)
 /vault/filenames_mussel.cvd (Firmas, Incluidos)
    Files for filename signatures.
    Required if filename signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/general_clamav_regex.cvd (Firmas, Incluidos)
 /vault/general_clamav_regex.map (Firmas, Incluidos)
 /vault/general_clamav_standard.cvd (Firmas, Incluidos)
 /vault/general_clamav_standard.map (Firmas, Incluidos)
 /vault/general_custom_regex.cvd (Firmas, Incluidos)
 /vault/general_custom_standard.cvd (Firmas, Incluidos)
 /vault/general_mussel_regex.cvd (Firmas, Incluidos)
 /vault/general_mussel_standard.cvd (Firmas, Incluidos)
    Files for general signatures.
    Required if general signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/graphics_clamav_regex.cvd (Firmas, Incluidos)
 /vault/graphics_clamav_regex.map (Firmas, Incluidos)
 /vault/graphics_clamav_standard.cvd (Firmas, Incluidos)
 /vault/graphics_clamav_standard.map (Firmas, Incluidos)
 /vault/graphics_custom_regex.cvd (Firmas, Incluidos)
 /vault/graphics_custom_standard.cvd (Firmas, Incluidos)
 /vault/graphics_mussel_regex.cvd (Firmas, Incluidos)
 /vault/graphics_mussel_standard.cvd (Firmas, Incluidos)
    Files for graphics signatures.
    Required if graphics signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/greylist.csv (Firmas, Incluidos/Creados)
    CSV of greylisted signatures indicating to phpMussel which signatures it
    should be ignoring (file automatically recreated if deleted).
    ~
 /vault/hex_general_commands.csv (Firmas, Incluidos)
    Hex-encoded CSV of general command detections optionally used by phpMussel.
    Required if general command detection option in phpmussel.ini is enabled.
    Can remove if option is disabled (but file will be recreated on update).
    ~
 /vault/html_clamav_regex.cvd (Firmas, Incluidos)
 /vault/html_clamav_regex.map (Firmas, Incluidos)
 /vault/html_clamav_standard.cvd (Firmas, Incluidos)
 /vault/html_clamav_standard.map (Firmas, Incluidos)
 /vault/html_custom_regex.cvd (Firmas, Incluidos)
 /vault/html_custom_standard.cvd (Firmas, Incluidos)
 /vault/html_mussel_regex.cvd (Firmas, Incluidos)
 /vault/html_mussel_standard.cvd (Firmas, Incluidos)
    Files for normalised HTML signatures.
    Required if normalised HTML signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/lang.inc (Script, Incluido)
    phpMussel Language Data; Required for multilingual capabilities.
    ~
 /vault/macho_clamav_regex.cvd (Firmas, Incluidos)
 /vault/macho_clamav_regex.map (Firmas, Incluidos)
 /vault/macho_clamav_standard.cvd (Firmas, Incluidos)
 /vault/macho_clamav_standard.map (Firmas, Incluidos)
 /vault/macho_custom_regex.cvd (Firmas, Incluidos)
 /vault/macho_custom_standard.cvd (Firmas, Incluidos)
 /vault/macho_mussel_regex.cvd (Firmas, Incluidos)
 /vault/macho_mussel_standard.cvd (Firmas, Incluidos)
    Files for Mach-O signatures.
    Required if Mach-O signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/mail_clamav_regex.cvd (Firmas, Incluidos)
 /vault/mail_clamav_regex.map (Firmas, Incluidos)
 /vault/mail_clamav_standard.cvd (Firmas, Incluidos)
 /vault/mail_clamav_standard.map (Firmas, Incluidos)
 /vault/mail_custom_regex.cvd (Firmas, Incluidos)
 /vault/mail_custom_standard.cvd (Firmas, Incluidos)
 /vault/mail_mussel_regex.cvd (Firmas, Incluidos)
 /vault/mail_mussel_standard.cvd (Firmas, Incluidos)
 /vault/mail_mussel_standard.map (Firmas, Incluidos)
    Files for signatures used by the phpMussel_mail() function.
    Required if the phpMussel_mail() function is used in any way.
    Can remove if it is not used (but files will be recreated on update).
    ~
 /vault/md5_clamav.cvd (Firmas, Incluidos)
 /vault/md5_custom.cvd (Firmas, Incluidos)
 /vault/md5_mussel.cvd (Firmas, Incluidos)
    Files for MD5 based signatures.
    Required if MD5 based signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/metadata_clamav.cvd (Firmas, Incluidos)
 /vault/metadata_custom.cvd (Firmas, Incluidos)
 /vault/metadata_mussel.cvd (Firmas, Incluidos)
    Files for archive metadata signatures.
    Required if archive metadata signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/ole_clamav_regex.cvd (Firmas, Incluidos)
 /vault/ole_clamav_regex.map (Firmas, Incluidos)
 /vault/ole_clamav_standard.cvd (Firmas, Incluidos)
 /vault/ole_clamav_standard.map (Firmas, Incluidos)
 /vault/ole_custom_regex.cvd (Firmas, Incluidos)
 /vault/ole_custom_standard.cvd (Firmas, Incluidos)
 /vault/ole_mussel_regex.cvd (Firmas, Incluidos)
 /vault/ole_mussel_standard.cvd (Firmas, Incluidos)
    Files for OLE signatures.
    Required if OLE signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/pdf_clamav_regex.cvd (Firmas, Incluidos)
 /vault/pdf_clamav_regex.map (Firmas, Incluidos)
 /vault/pdf_clamav_standard.cvd (Firmas, Incluidos)
 /vault/pdf_clamav_standard.map (Firmas, Incluidos)
 /vault/pdf_custom_regex.cvd (Firmas, Incluidos)
 /vault/pdf_custom_standard.cvd (Firmas, Incluidos)
 /vault/pdf_mussel_regex.cvd (Firmas, Incluidos)
 /vault/pdf_mussel_standard.cvd (Firmas, Incluidos)
    Files for PDF signatures.
    Required if PDF signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/pe_clamav.cvd (Firmas, Incluidos)
 /vault/pe_custom.cvd (Firmas, Incluidos)
 /vault/pe_mussel.cvd (Firmas, Incluidos)
    Files for PE Sectional signatures.
    Required if PE Sectional signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/phpmussel.inc (Script, Incluido)
    phpMussel Core Script; The main body and guts of phpMussel (essential)!
    ~
 /vault/phpmussel.ini (Otro, Incluido)
    phpMussel Configuration file; Contains all the configuration options of
    phpMussel, telling it what to do and how to operate correctly (essential)!
    ~
 /vault/scan_log.txt *(Log archivo, Creado)
    A record of everything scanned by phpMussel.
    ~
 /vault/scan_kills.txt *(Log archivo, Creado)
    A record of every file upload blocked/killed by phpMussel.
    ~
 /vault/swf_clamav_regex.cvd (Firmas, Incluidos)
 /vault/swf_clamav_regex.map (Firmas, Incluidos)
 /vault/swf_clamav_standard.cvd (Firmas, Incluidos)
 /vault/swf_clamav_standard.map (Firmas, Incluidos)
 /vault/swf_custom_regex.cvd (Firmas, Incluidos)
 /vault/swf_custom_standard.cvd (Firmas, Incluidos)
 /vault/swf_mussel_regex.cvd (Firmas, Incluidos)
 /vault/swf_mussel_standard.cvd (Firmas, Incluidos)
    Files for the Shockwave signatures.
    Required if the Shockwave signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~
 /vault/template.html (Otro, Incluido)
    phpMussel Template file; Template for HTML output produced by phpMussel for
    its blocked file upload message (the message seen by the uploader).
    ~
 /vault/update.dat (Otro, Incluido)
    File containing version information for both the phpMussel script and the
    phpMussel signatures. If you ever want to automatically update phpMussel or
    want to update phpMusel via your browser, this file is essential.
    ~
 /vault/update.inc (Script, Incluido)
    phpMussel Update Script; Required for automatic updates and for updating
    phpMussel via your browser, but not required otherwise.
    ~
 /vault/whitelist_clamav.cvd (Firmas, Incluidos)
 /vault/whitelist_custom.cvd (Firmas, Incluidos)
 /vault/whitelist_mussel.cvd (Firmas, Incluidos)
    File specific whitelist.
    Required if whitelisting option in phpmussel.ini is enabled and if you wish
    to have specific files whitelisted. Can remove if option is disabled or if
    you don't require whitelisting (but files will be recreated on update).
    ~
 /vault/xmlxdp_clamav_regex.cvd (Firmas, Incluidos)
 /vault/xmlxdp_clamav_regex.map (Firmas, Incluidos)
 /vault/xmlxdp_clamav_standard.cvd (Firmas, Incluidos)
 /vault/xmlxdp_clamav_standard.map (Firmas, Incluidos)
 /vault/xmlxdp_custom_regex.cvd (Firmas, Incluidos)
 /vault/xmlxdp_custom_standard.cvd (Firmas, Incluidos)
 /vault/xmlxdp_mussel_regex.cvd (Firmas, Incluidos)
 /vault/xmlxdp_mussel_standard.cvd (Firmas, Incluidos)
    Files for XML/XDP-Chunk signatures.
    Required if XML/XDP-Chunk signatures option in phpmussel.ini is enabled.
    Can remove if option is disabled (but files will be recreated on update).
    ~

 * Filename may differ based on configuration stipulations (in phpmussel.ini).

 = REGARDING SIGNATURE FILES =
    CVD is an acronym for "ClamAV Virus Definitions", in reference both to
    how ClamAV refers to its own signatures and to the use of those signatures
    for phpMussel; Files ending with "CVD" contain signatures.
    ~
    Files ending with "MAP", quite literally, map which signatures phpMussel
    should and shouldn't use for individual scans; Not all signatures are
    necessarily required for every single scan, so, phpMussel uses maps of the
    signature files to speed up the scanning process (a process which would
    otherwise be extremely slow and tedious).
    ~
    Signature files marked with "_regex" contain signatures which utilise
    regular expression pattern checking (regex).
    ~
    Signature files marked with "_standard" contain signatures which
    specifically do not utilise any form of pattern checking.
    ~
    Signature files marked with neither "_regex" nor "_standard" will be as one
    or the other, but not both (refer to the Signature Format section of this
    README file for documentation and specific details).
    ~
    Signature files marked with "_clamav" contain signatures that are sourced
    entirely from the ClamAV database (GNU/GPL).
    ~
    Signature files marked with "_custom", by default, do not contain any
    signatures at all; These such files exist to give you somewhere to place
    your own custom signatures, if you come up with any of your own.
    ~
    Signature files marked with "_mussel" contain signatures that specifically
    are not sourced from ClamAV, signatures which, generally, I've either come
    up with myself and/or based on information gathered from various sources.
    ~

                                     ~ ~ ~


 6. CONFIGURACIÓN OPCIONES

 The following is a list of variables found in the "phpmussel.ini"
 configuration file of phpMussel, along with a description of their purpose and
 function.

 "general" (Category)
 - General configuration for phpMussel.
    "script_password"
    - As a convenience, phpMussel will allow certain functions (including the
      ability to update phpMussel on-the-fly) to be manually triggered via
      POST, GET and QUERY. However, as a security precaution, to do this,
      phpMussel will expect a password to be included with the command, as to
      ensure that it is you, and not someone else, attempting to manually
      trigger these functions. Set script_password to whatever password you
      would like to use. If no password is set, manual triggering will be
      disabled by default. Use something you will remember but which is hard
      for others to guess.
      * Has no influence in CLI mode.
    "logs_password"
    - The same as script_password, but for viewing the contents of scan_log
      and scan_kills. Having separate passwords can be useful if you want to
      give someone else access to one set of functions but not the other.
      * Has no influence in CLI mode.
    "cleanup"
    - Unset script variables and cache after execution. If you aren't using
      the script beyond the initial scanning of uploads, should set to yes, to
      minimize memory usage. If you are using the script for purposes beyond
      the initial scanning of uploads, should set to no, to avoid unnecessarily
      reloading duplicate data into memory. In general practise, it should
      probably be set to yes, but, if you do this, you won't be able to use the
      script for anything other than scanning file uploads.
      * Has no influence in CLI mode.
    "scan_log"
    - Filename of file to log all scanning results to. Specify a filename, or
      leave blank to disable.
    "scan_kills"
    - Filename of file to log all records of blocked or killed uploads to.
      Specify a filename, or leave blank to disable.
    "ipaddr"
    - Where to find IP address of connecting request? (Useful for services
      such as Cloudflare and the likes) Default = REMOTE_ADDR
      WARNING: Don't change this unless you know what you're doing!
    "forbid_on_block"
    - Should phpMussel send 403 headers with the file upload blocked message,
      or stick with the usual 200 OK? 0 = No (200) [Default], 1 Yes (403).
    "delete_on_sight"
    - Enabling this directive will instruct the script to attempt to
      immediately delete any scanned attempted file upload matching any
      detection criteria, whether via signatures or otherwise. Files determined
      to be "clean" will not be touched. In the case of archives, the entire
      archive will be deleted (regardless of if the offending file is only one
      of several files contained within the archive). For the case of file
      upload scanning, usually, it isn't necessary to turn this option on,
      because usually, php will automatically purge the contents of its cache
      when execution has finished, meaning that it'll usually delete any files
      uploaded through it to the server unless they've moved, copied or deleted
      already. The option is added here as an extra measure of security for the
      extra paranoid and for those whose copies of php may not always behave in
      the manner intended.
      0 - After scanning, leave the file alone [Default],
      1 - After scanning, if not clean, delete immediately.
    "lang"
    - Specify the default language for phpMussel.
    "quarantine_key"
    - phpMussel is able to quarantine flagged attempted file uploads in
      isolation within the phpMussel vault, if this is something you want it to
      do. Casual users of phpMussel of which simply wish to protect their
      websites or hosting environment without having any interest in deeply
      analysing any flagged attempted file uploads should leave this
      functionality disabled, but any users interested in further analysis of
      flagged attempted file uploads for malware research or for similar such
      things should enable this functionality. Quarantining of flagged
      attempted file uploads can sometimes also assist in debugging
      false-positives, if this is something that frequently occurs for you. To
      disable quarantine functionality, simply leave the "quarantine_key"
      directive empty, or erase the contents of that directive if it isn't
      already empty. To enable quarantine functionality, enter some value into
      the directive. The "quarantine_key" is an important security feature of
      the quarantine functionality required as a means of preventing the
      quarantine functionality from being exploited by potential attackers and
      as a means of preventing any potential execution of data stored within
      the quarantine. The "quarantine_key" should be treated in the same manner
      as your passwords: The longer the better, and guard it tightly. For best
      effect, use in conjunction with "delete_on_sight".
    "quarantine_max_filesize"
    - The maximum allowable filesize of files to be quarantined. Files larger
      than the value specified below will NOT be quarantined. This directive is
      important as a means of making it more difficult for any potential
      attackers to flood your quarantine with unwanted data potentially causing
      run-away data usage on your hosting service. Value is in KB.
      Default =2048 =2048KB =2MB.
    "quarantine_max_usage"
    - The maximum memory usage allowed for the quarantine. If the total memory
      used by the quarantine reaches this value, the oldest quarantined files
      will be deleted until the total memory used no longer reaches this value.
      This directive is important as a means of making it more difficult for
      any potential attackers to flood your quarantine with unwanted data
      potentially causing run-away data usage on your hosting service.
      Value is in KB. Default =65536 =65536KB =64MB.
    "honeypot_mode"
    - When honeypot mode is enabled, phpMussel will attempt to quarantine every
      single file upload that it encounters, regardless of whether or not the
      file being uploaded matches any included signatures, and no actual
      scanning or analysis of those attempted file uploads will actually occur.
      This functionality should be useful for those that wish to use phpMussel
      for the purposes of virus/malware research, but it is neither recommended
      to enable this functionality if the intended use of phpMussel by the user
      is for actual file upload scanning nor is it recommended to use the
      honeypot functionality for purposes other than honeypotting. By default,
      this option is disabled. 0 = Disabled [Default], 1 = Enabled.
 "signatures" (Category)
 - Configuration for signatures.
   %%%_clamav = ClamAV signatures (both mains and daily).
   %%%_custom = Your custom signatures (if you've written any).
   %%%_mussel = phpMussel signatures included in your current signatures set
                which aren't from ClamAV.
   - Check against MD5 signatures when scanning? 0 = No, 1 = Yes [Default].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Check against general signatures when scanning? 0 = No, 1 = Yes [Default].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Check against normalised ASCII signatures when scanning?
     0 = No, 1 = Yes [Default].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Check against normalised HTML signatures when scanning?
     0 = No, 1 = Yes [Default].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Check PE (Portable Executable) files (EXE, DLL, etc) against PE Sectional
     signatures when scanning? 0 = No, 1 = Yes [Default].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Check PE (Portable Executable) files (EXE, DLL, etc) against PE signatures
     when scanning? 0 = No, 1 = Yes [Default].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Check ELF files against ELF signatures when scanning?
     0 = No, 1 = Yes [Default].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Check Mach-O files (OSX, etc) against Mach-O signatures when scanning?
     0 = No, 1 = Yes [Default].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Check graphics files against graphics based signatures when scanning?
     0 = No, 1 = Yes [Default].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Check archive contents against archive metadata signatures when scanning?
     0 = No, 1 = Yes [Default].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Check OLE objects against OLE signatures when scanning?
     0 = No, 1 = Yes [Default].
     "ole_clamav"
     "ole_custom"
     "ole_mussel"
   - Check filenames against filename based signatures when scanning?
     0 = No, 1 = Yes [Default].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Allow scanning with phpMussel_mail()? 0 = No, 1 = Yes [Default].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Enable file specific whitelist? 0 = No, 1 = Yes [Default].
     "whitelist_clamav"
     "whitelist_custom"
     "whitelist_mussel"
   - Check XML/XDP chunks against XML/XDP-chunk signatures when scanning?
     0 = No, 1 = Yes [Default].
     "xmlxdp_clamav"
     "xmlxdp_custom"
     "xmlxdp_mussel"
   - Check against Complex Extended signatures when scanning?
     0 = No, 1 = Yes [Default].
     "coex_clamav"
     "coex_custom"
     "coex_mussel"
   - Check against PDF signatures when scanning?
     0 = No, 1 = Yes [Default].
     "pdf_clamav"
     "pdf_custom"
     "pdf_mussel"
   - Check against Shockwave signatures when scanning?
     0 = No, 1 = Yes [Default].
     "swf_clamav"
     "swf_custom"
     "swf_mussel"
   - Signature matching length limiting options. Only change these if you
     know what you're doing. SD = Standard signatures. RX = PCRE (Perl
     Compatible Regular Expressions, or "Regex") signatures. FN = Filename
     signatures. If you notice php crashing when phpMussel attempts to scan,
     try lowering these "max" values. If possible and convenient, let me know
     when this happens and the results of whatever you try.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   - Should phpMussel report when signatures files are missing or corrupted?
     If fail_silently is disabled, missing and corrupted files will be reported
     on scanning, and if fail_silently is enabled, missing and corrupted files
     will be ignored, with scanning reported for those files that there are no
     problems. This should generally be left alone unless you're experiencing
     crashes or similar problems. 0 = Disabled [Default], 1 = Enabled.
     "fail_silently"
 "files" (Category)
 - General configuration for handling of files.
   "max_uploads"
   - Maximum allowable number of files to scan during files upload scan before
     aborting the scan and informing the user they are uploading too much at
     once! Provides protection against a theoretical attack whereby an attacker
     attempts to DDoS your system or CMS by overloading phpMussel to slow down
     the php process to a grinding halt. Recommended: 10. You may wish to raise
     or lower this number depending on the speed of your hardware. Note that
     this number does not account for or include the contents of archives.
   "filesize_limit"
   - Filesize limit in KB. 65536 = 64MB [Default], 0 = No limit (always
     greylisted), any (positive) numeric value accepted. This can be useful
     when your php configuration limits the amount of memory a process can hold
     or if your php configuration limits filesize of uploads.
   "filesize_response"
   - What to do with files that exceed the filesize limit (if one exists).
     0 - Whitelist, 1 - Blacklist [Default].
   "filetype_whitelist", "filetype_blacklist", "filetype_greylist"
   - If your system only allows specific types of files to be uploaded, or if
     your system explicitly denies certain types of files, specifying those
     filetypes in whitelists, blacklists and greylists can increase the speed
     at which scanning is performed by allowing the script to skip over certain
     filetypes. Format is CSV (comma separated values). If you want to scan
     everything, rather than whitelist, blacklist or greylist, leave the
     variable(/s) blank; Doing so will disable whitelist/blacklist/greylist.
     Logical order of processing is:
     - If the filetype is whitelisted, don't scan and don't block the file, and
       don't check the file against the blacklist or the greylist.
     - If the filetype is blacklisted, don't scan the file but block it anyway,
       and don't check the file against the greylist.
     - If the greylist is empty or if the greylist is not empty and the
       filetype is greylisted, scan the file as per normal and determine
       whether to block it based on the results of the scan, but if the
       greylist is not empty and the filetype is not greylisted, treat the file
       as blacklisted, therefore not scanning it but blocking it anyway.
   "check_archives"
   - Attempt to check the contents of archives?
     0 - No (do not check), 1 - Yes (check) [Default].
     * Currently, only checking of BZ, GZ, LZF and ZIP files is supported
       (checking of RAR, CAB, 7z and etcetera not currently supported).
     * This is not foolproof! While I highly recommend keeping this turned on,
       I can't guarantee it'll always find everything.
     * Also be aware that archive checking currently is not recursive for ZIPs.
   "filesize_archives"
   - Carry over filesize blacklisting/whitelisting to the contents of archives?
     0 - No (just greylist everything), 1 - Yes [Default].
   "filetype_archives"
   - Carry over filetype blacklisting/whitelisting to the contents of archives?
     0 - No (just greylist everything) [Default], 1 - Yes.
   "max_recursion"
   - Maximum recursion depth limit for archives. Default = 10.
 "attack_specific" (Category)
 - Configuration for specific attack detections (not based on CVDs).
   * Chameleon attack detection: 0 = Off, 1 = On.
   "chameleon_from_php"
   - Search for php header in files that are neither php files nor recognised
     archives.
   "chameleon_from_exe"
   - Search for executable headers in files that are neither executables nor
     recognised archives and for executables whose headers are incorrect.
   "chameleon_to_archive"
   - Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR,
     ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Search for office documents whose headers are incorrect (Supported: DOC,
     DOT, PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Search for images whose headers are incorrect (Supported: BMP, DIB, PNG,
     GIF, JPEG, JPG, XCF, PSD, PDD).
   "chameleon_to_pdf"
   - Search for PDF files whose headers are incorrect.
   "archive_file_extensions" and "archive_file_extensions_wc"
   - Recognised archive file extensions (format is CSV; should only add or
     remove when problems occur; unnecessarily removing may cause
     false-positives to appear for archive files, whereas unnecessarily adding
     will essentially whitelist what you are adding from attack specific
     detection; modify with caution; also note that this has no effect on what
     archives can and can't be analysed at content-level). The list, as is at
     default, lists those formats used most commonly across the majority of
     systems and CMS, but intentionally isn't necessarily comprehensive.
   "general_commands"
   - Search content of files for general commands such as eval(), exec() and
     include()? 0 - No (do not check) [Default], 1 - Yes (check). Disable this
     option if you intend to upload any of the following to your system or CMS
     via your browser: php, JavaScript, HTML, python, perl files and etcetera.
     Enable this option if you do not have any additional protections on your
     system and do not intend to upload such files. If you use additional
     security in conjunction with phpMussel such as ZB Block, there is no need
     to turn this option on, because most of what phpMussel will look for (in
     the context of this option) are duplications of protections that are
     already provided.
   "block_control_characters"
   - Block any files containing any control characters (other than newlines)?
     ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]) If you are -only- uploading plain-text,
     then you can turn this option on to provide some additional protection to
     your system. However, if you upload anything other than plain-text,
     turning this on may result in false positives.
     0 - Don't block [Default], 1 - Block.
   "corrupted_exe"
   - Corrupted files and parse errors. 0 = Ignore, 1 = Block [Default].
     Detect and block potentially corrupted PE (Portable Executable) files?
     Often (but not always), when certain aspects of a PE file are corrupted or
     can't be parsed correctly, it can be indicative of a viral infection. The
     processes used by most anti-virus programs to detect viruses in PE files
     require parsing those files in certain ways, which, if the programmer of a
     virus is aware of, will specifically try to prevent, in order to allow
     their virus to remain undetected.
   "decode_threshold"
   - Optional limitation or threshold to the length of raw data to which within
     decode commands should be detected (in case there are any noticeable
     performance issues whilst scanning). Value is an integer representing
     filesize in KB. Default = 512 (512KB). Zero or null value disables the
     threshold (removing any such limitation based on filesize).
   "scannable_threshold"
   - Optional limitation or threshold to the length of raw data to which
     phpMussel is permitted to read and scan (in case there are any noticeable
     performance issues whilst scanning). Value is an integer representing
     filesize in KB. Default = 32768 (32MB). Zero or null value disables the
     threshold. Generally, this value shouldn't be less than the average
     filesize of file uploads that you want and expect to receive to your
     server or website, shouldn't be more than the filesize_limit directive,
     and shouldn't be more than roughly one fifth of the total allowable memory
     allocation granted to php via the php.ini configuration file. This
     directive exists to try to prevent phpMussel from using up too much memory
     (which would prevent it from being able to successfully scan files above a
     certain filesize).
 "compatibility" (Category)
 - Compatibility directives for phpMussel.
    "ignore_upload_errors"
    - This directive should generally be disabled unless it is required for
      correct functionality of phpMussel on your specific system. Normally,
      when disabled, when phpMussel detects the presence of elements in the
      $_FILES array(), it will attempt to initiate a scan of the files that
      those elements represent, and, if those elements are blank or empty,
      phpMussel will return an error message. This is proper behaviour for
      phpMussel. However, for some CMS, empty elements in $_FILES can occur as
      a result of the natural behaviour of those CMS, or errors may be reported
      when there aren't any, in which case, the normal behaviour for phpMussel
      will be interfering with the normal behaviour of those CMS. If such a
      situation occurs for you, enabling this option will instruct phpMussel to
      not attempt to initiate scans for such empty elements, ignore them when
      found and to not return any related error messages, thus allowing
      continuation of the page request. 0 - OFF, 1 - ON.
    "only_allow_images"
    - If you only expect or only intend to allow images to be uploaded to your
      system or CMS, and if you absolutely do not require any files other than
      images to be uploaded to your system or CMS, this directive should be
      enabled, but should otherwise be disabled. If this directive is enabled,
      it will instruct phpMussel to indiscriminately block any uploads
      identified as non-image files, without scanning them. This may reduce
      processing time and memory usage for attempted uploads of non-image
      files. 0 - OFF, 1 - ON.

                                     ~ ~ ~


 7. FIRMA FORMATOS

 = FILENAME SIGNATURES =
   All filename signatures follow the format:
    NAME:FNRX
   Where NAME is the name to cite for that signature and FNRX is the regex
   pattern to match filenames (unencoded) against.

 = MD5 SIGNATURES =
   All MD5 signatures follow the format:
    HASH:FILESIZE:NAME
   Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of
   that file and NAME is the name to cite for that signature.

 = ARCHIVE METADATA SIGNATURES =
   All archive metadata signatures follow the format:
    NAME:FILESIZE:CRC32
   Where NAME is the name to cite for that signature, FILESIZE is the total
   size (uncompressed) of a file contained within the archive and CRC32 is the
   crc32 checksum of that contained file.

 = PE SECTIONAL MD5 SIGNATURES =
   All PE Sectional MD5 signatures follow the format:
    FILESIZE:HASH:NAME
   Where HASH is the MD5 hash of a section of the PE file, FILESIZE is the
   total size of that file and NAME is the name to cite for that signature.

 = WHITELIST SIGNATURES =
   All Whitelist signatures follow the format:
    HASH:FILESIZE:TYPE
   Where HASH is the MD5 hash of an entire file, FILESIZE is the total size of
   that file and TYPE is the type of signatures the whitelisted file is to be
   immune against.

 = COMPLEX EXTENDED SIGNATURES =
   Complex Extended signatures are rather different to the other types of
   signatures possible with phpMussel, in that what they are matching against
   is specified by the signatures themselves and they can match against
   multiple criteria. The match criterias are delimited by ";" and the match
   type and match data of each match criteria is delimited by ":" as so that
   format for these signatures tends to look a bit like:
    $variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName

 = EVERYTHING ELSE =
   All other signatures follow the format:
    NAME:HEX:FROM:TO
   Where NAME is the name to cite for that signature and HEX is a
   hexadecimal-encoded segment of the file intended to be matched by the given
   signature. FROM and TO are optional parameters, indicting from which and to
   which positions in the source data to check against (not supported by the
   mail function).

 = REGEX =
   Any form of regex understood and correctly processed by php should also be
   correctly understood and processed by phpMussel and its signatures. However,
   I'd suggest taking extreme caution when writing new regex based signatures,
   because, if you're not entirely sure what you're doing, there can be highly
   irregular and/or unexpected results. Take a look at the phpMussel
   source-code if you're not entirely sure about the context in which regex
   statements are parsed. Also, remember that all patterns (with exception to
   filename, archive metadata and MD5 patterns) must be hexadecimally encoded
   (foregoing pattern syntax, of course)!

 = WHERE TO PUT CUSTOM SIGNATURES? =
   Only put custom signatures in those files intended for custom signatures.
   Those files should contain "_custom" in their filenames. You should also
   avoid editing the default signature files, unless you know exactly what
   you're doing, because, aside from being good practise in general and aside
   from helping you distinguish between your own signatures and the default
   signatures included with phpMussel, it is good to stick to editing only the
   files intended for editing, because tampering with the default signature
   files can cause them to stop working correctly, due to the "maps" files: The
   maps files tell phpMussel where in the signature files to look for
   signatures required by phpMussel as per when required, and these maps can
   become out-of-sync with their associated signature files if those signature
   files are tampered with. You can put pretty much whatever you want into your
   custom signatures, so long as you follow the correct syntax. However, be
   careful to test new signatures for false-positives beforehand if you intend
   to share them or use them in a live environment.

 = SIGNATURE BREAKDOWN =
   The following is a breakdown of the types of signatures used by phpMussel:
   - "Normalised ASCII Signatures" (ascii_*). Checked against the contents of
      every non-whitelisted file targeted for scanning.
   - "Complex Extended Signatures" (coex_*). Mixed signature type matching.
   - "ELF Signatures" (elf_*). Checked against the contents of every
      non-whitelisted file targeted for scanning and matched to the ELF format.
   - "Portable Executable Signatures" (exe_*). Checked against the contents of
      every non-whitelisted targeted for scanning and matched to the PE format.
   - "Filename Signatures" (filenames_*). Checked against the filenames of
      files targeted for scanning.
   - "General Signatures" (general_*). Checked against the contents of every
      non-whitelisted file targeted for scanning.
   - "Graphics Signatures" (graphics_*). Checked against the contents of every
      non-whitelisted file targeted for scanning and matched to a known
      graphical file format.
   - "General Commands" (hex_general_commands.csv). Checked against the
      contents of every non-whitelisted file targeted for scanning.
   - "Normalised HTML Signatures" (html_*). Checked against the contents of
      every non-whitelisted HTML file targeted for scanning.
   - "Mach-O Signatures" (macho_*). Checked against the contents of every
      non-whitelisted file targeted for scanning and matched to the Mach-O
      format.
   - "Email Signatures" (mail_*). Checked against the $body variable parsed to
      the phpMussel_mail() function, which is intended to be the body of email
      messages or similar entities (potentially forum posts and etcetera).
   - "MD5 Signatures" (md5_*). Checked against the MD5 hash of the contents and
      the filesize of every non-whitelisted file targeted for scanning.
   - "Archive Metadata Signatures" (metadata_*). Checked against the CRC32 hash
      and filesize of the initial file contained inside of any non-whitelisted
      archive targeted for scanning.
   - "OLE Signatures" (ole_*). Checked against the contents of every
      non-whitelisted OLE object targeted for scanning.
   - "PDF Signatures" (pdf_*). Checked against the contents of every
      non-whitelisted PDF file targeted for scanning.
   - "Portable Executable Sectional Signatures" (pe_*). Checked against the MD5
      hash of each PE section and the filesize of every non-whitelisted file
      targeted for scanning and matched to the PE format.
   - "SWF Signatures" (swf_*). Checked against the contents of every
      non-whitelisted Shockwave file targeted for scanning.
   - "Whitelist Signatures" (whitelist_*). Checked against the MD5 hash of the
      contents and the filesize of every file targeted for scanning. Matched
      files will be immune to being matched by the type of signature mentioned
      in their whitelist entry.
   - "XML/XDP-Chunk Signatures" (xmlxdp_*). Checked against any XML/XDP chunks
      found within any non-whitelisted files targeted for scanning.
     (Note that any of these signatures may be easily disabled via
      phpmussel.ini).

                                     ~ ~ ~


 8. CONOCIDOS PROBLEMAS DE COMPATIBILIDAD

 PHP y PCRE
 - phpMussel requiere PHP y PCRE para ejecutar y funcionar correctamente. Sin
   PHP, o sin la PCRE extensión de PHP, phpMussel no ejecutará o funcionará
   correctamente. Debe asegurarse de que su sistema tiene tanto PHP y PCRE
   instalados y disponibles antes de descargar e instalar phpMussel.

 ANTI-VIRUS SOFTWARE COMPATIBILIDAD

 En su mayor parte, phpMussel debe ser bastante compatible con la mayoría de
 anti-virus software. Aunque, conflictividades han sido reportados por un
 número de usuarios en el pasado. Esta información de abajo es de
 VirusTotal.com, y describe un número de falsos positivos reportados por
 diversos anti-virus programas contra phpMussel. Aunque esta información no es
 una garantía absoluta de si o no se encontrará con compatibilidad problemas
 entre phpMussel y su anti-virus software, se su anti-virus software se observa
 como marcar contra phpMussel, usted debe considerar desactivarlo antes de
 trabajar con phpMussel o debería considerar opciones alternativas a de su
 anti-virus software o phpMussel.

 Esta información ha sido actualizado 25 Diciembre 2014 y es a hoy para todas
 las phpMussel versiones de la dos más recientes menores versiones (v0.5-v0.6)
 al momento de escribir esto.

 Ad-Aware                No hay conocidos problemas
 Agnitum                 No hay conocidos problemas
 AhnLab-V3               No hay conocidos problemas
 AntiVir                 No hay conocidos problemas
 Antiy-AVL               No hay conocidos problemas
 Avast                !  Informes "JS:ScriptSH-inf [Trj]"
 AVG                     No hay conocidos problemas
 Baidu-International     No hay conocidos problemas
 BitDefender             No hay conocidos problemas
 Bkav                    No hay conocidos problemas
 ByteHero                No hay conocidos problemas
 CAT-QuickHeal           No hay conocidos problemas
 ClamAV                  No hay conocidos problemas
 CMC                     No hay conocidos problemas
 Commtouch               No hay conocidos problemas
 Comodo                  No hay conocidos problemas
 DrWeb                   No hay conocidos problemas
 Emsisoft                No hay conocidos problemas
 ESET-NOD32              No hay conocidos problemas
 F-Prot                  No hay conocidos problemas
 F-Secure                No hay conocidos problemas
 Fortinet                No hay conocidos problemas
 GData                   No hay conocidos problemas
 Ikarus               !  Informes "Trojan.JS.Agent"
 Jiangmin                No hay conocidos problemas
 K7AntiVirus             No hay conocidos problemas
 K7GW                    No hay conocidos problemas
 Kaspersky               No hay conocidos problemas
 Kingsoft                No hay conocidos problemas
 Malwarebytes            No hay conocidos problemas
 McAfee                  No hay conocidos problemas
 McAfee-GW-Edition       No hay conocidos problemas
 Microsoft               No hay conocidos problemas
 MicroWorld-eScan        No hay conocidos problemas
 NANO-Antivirus          No hay conocidos problemas
 Norman               !  Informes "Kryptik.BQS"
 nProtect                No hay conocidos problemas
 Panda                   No hay conocidos problemas
 Qihoo-360               No hay conocidos problemas
 Rising                  No hay conocidos problemas
 Sophos                  No hay conocidos problemas
 SUPERAntiSpyware        No hay conocidos problemas
 Symantec             !  Informes "WS.Reputation.1"
 TheHacker               No hay conocidos problemas
 TotalDefense            No hay conocidos problemas
 TrendMicro              No hay conocidos problemas
 TrendMicro-HouseCall !  Informes "Suspici.450F5936"
 VBA32                   No hay conocidos problemas
 VIPRE                   No hay conocidos problemas
 ViRobot                 No hay conocidos problemas


                                     ~ ~ ~


Última Actualización: 27 Diciembre 2014 (2014.12.27).
EOF