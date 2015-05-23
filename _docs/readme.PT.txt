      _____  _     _  _____  _______ _     _ _______ _______ _______
 <   |_____] |_____| |_____] |  |  | |     | |______ |______ |______ |        >
     |       |     | |       |  |  | |_____| ______| ______| |______ |_____

                           { ~ ~ ~ PORTUGUÊS ~ ~ ~ }
 CONTEÚDO
 1. PREÂMBULO
 2A. COMO INSTALAR (PARA WEB SERVIDORES)
 2B. COMO INSTALAR (PARA CLI)
 3A. COMO USAR (PARA WEB SERVIDORES)
 3B. COMO USAR (PARA CLI)
 4A. NAVEGADOR COMANDOS
 4B. CLI (COMANDO LINHA INTERFACE)
 5. ARQUIVOS INCLUÍDOS NESTE PACOTE
 6. CONFIGURAÇÃO OPÇÕES
 7. ASSINATURA FORMATO
 8. CONHECIDOS COMPATIBILIDADE PROBLEMAS

                                     ~ ~ ~


 1. PREÂMBULO

 Obrigado por usando phpMussel, um PHP script projetado para detectar trojans,
 vírus, malware e outras ameaças dentro dos arquivos enviados para o seu
 sistema onde quer que o script é enganchado, baseado no assinaturas do
 ClamAV e outros.

 PHPMUSSEL COPYRIGHT 2013 e além GNU/GPL V.2 através do Caleb M (Maikuolan).

 Este script é livre software; você pode redistribuí-lo e/ou modificá-lo de
 acordo com os termos da GNU General Public License como publicada pela Free
 Software Foundation; tanto a versão 2 da Licença, ou (em sua opção) qualquer
 versão posterior. Este script é distribuído na esperança que possa ser útil,
 mas SEM QUALQUER GARANTIA; sem mesmo a implícita garantia de COMERCIALIZAÇÃO
 ou ADEQUAÇÃO A UM DETERMINADO FIM. Consulte a GNU General Public License para
 obter mais detalhes <http://www.gnu.org/licenses/>
 <http://opensource.org/licenses/>.

 Um especial obrigado para ClamAV por o projeto inspiração e para as
 assinaturas que este script utiliza, sem que, o script provavelmente não
 existiria, ou no melhor, teria ser de muito limitado valor
 <http://www.clamav.net/>.

 Um especial obrigado para Sourceforge por hospedar os projeto arquivos,
 localizado na <http://sourceforge.net/projects/phpmussel/>, para Spambot
 Security por hospedar os phpMussel discussão fóruns, localizado na
 <http://www.spambotsecurity.com/forum/viewforum.php?f=55>, e para
 adicionais recursos de um número de o assinaturas utilizados através do
 phpMussel: SecuriteInfo.com <http://www.securiteinfo.com/>, PhishTank
 <http://www.phishtank.com/>, NLNetLabs <http://nlnetlabs.nl/> e outros, e
 um especial obrigado a todos aqueles que apoiam o projeto, a qualquer outra
 pessoa que eu possa ter esquecido de mencionar, e para você, por usando o
 script.

 Este documento e seu associado pacote pode ser baixado gratuitamente a partir
 do Sourceforge <http://sourceforge.net/projects/phpmussel/>.

                                     ~ ~ ~


 2A. COMO INSTALAR (PARA WEB SERVIDORES)

 Espero para agilizar este processo via fazendo um instalado em algum momento
 no não muito distante futuro, mas até então, siga estas instruções para
 trabalhar phpMussel na maioria dos sistemas e CMS:

 1) Por o seu lendo isso, eu estou supondo que você já tenha baixado uma cópia
    arquivada do script, descomprimido seu conteúdo e tê-lo sentado em algum
    lugar em sua máquina local. A partir daqui, você vai querer determinar onde
    no seu host ou CMS pretende colocar esses conteúdos. Um diretório como
    /public_html/phpmussel/ ou semelhante (porém, está não importa qual você
    escolher, assumindo que é seguro e algo você esteja feliz com) vai bastará.

 2) Abrir "phpmussel.php", procure a linha que começa com "$vault=", e
    substituir a string entre as seguintes aspas em nessa linha com a
    verdadeira exata localização do "vault" diretório de phpMussel. Você vai
    ter notado tal diretório no arquivo que você tenha baixado (a menos que
    você sentir-se a re-codificação de todo o script, você terá que manter a
    mesma estrutura de arquivos e diretórios como era no arquivo
    originalmente). Este diretório "vault" deve ser um nível além do diretório
    que o arquivo "phpmussel.php" vai existirá em. Salve o arquivo, feche.

 4) (Opcional; Fortemente recomendado para avançados usuários, mas não
    recomendado para iniciantes ou para os inexperientes): Abrir
    "phpmussel.ini" (localizado dentro "vault") - Este arquivo contém todas as
    directivas disponíveis para phpMussel. Acima de cada opção deve ser um
    breve comentário descrevendo o que faz e para que serve. Ajuste essas
    opções de como você vê o ajuste, conforme o que for apropriado para sua
    particular configuração. Salve o arquivo, feche.

 4) Carregar os conteúdos (phpMussel e seus arquivos) para o diretório que você
    tinha decidido anteriormente (você não precisa o readme.XX.txt ou
    change_log.txt arquivos incluído, mas principalmente, você deve carregar
    tudo).

 5) CMHOD o "vault" diretório para "777". O principal diretório armazenar o
    conteúdo (o que você escolheu anteriormente), geralmente, pode ser deixado
    sozinho, mas o CHMOD status deve ser verificado se você já teve problemas
    de permissões no passado no seu sistema (por padrão, deve ser algo como
    "755").

 6) Seguida, você vai precisar "enganchar" phpMussel ao seu sistema ou CMS.
    Existem várias diferentes maneiras em que você pode "enganchar" scripts
    como phpMussel ao seu sistema ou CMS, mas o mais fácil é simplesmente
    incluir o script no início de um núcleo arquivo de seu sistema ou CMS (uma
    que vai geralmente sempre ser carregado quando alguém acessa qualquer
    página através de seu site) utilizando um require ou include comando.
    Normalmente, isso vai ser algo armazenado em um diretório como "/includes",
    "/assets" ou "/functions", e muitas vezes, ser nomeado algo como
    "init.php", "common_functions.php", "functions.php" ou semelhante. Você
    precisará determinar qual arquivo isso é para a sua situação. Para fazer
    isso, insira a seguinte linha de código para o início desse núcleo arquivo,
    substituindo a string contida dentro das aspas com o exato endereço do
    "phpmussel.php" arquivo (endereço local, não o endereço HTTP; será
    semelhante ao vault endereço mencionado anteriormente).

    <?php require("/user_name/public_html/phpmussel/phpmussel.php"); ?>

    Salve o arquivo, fechar, recarregar-lo.

 7) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para
    garantir que ele está funcionando corretamente. Para testar as arquivo
    carregamento proteção, tentar carregar dos testes arquivos incluídos no
    pacote em "_testfiles" para seu site através de seus habitual navegador
    carregamentos métodos. Se tudo estiver funcionando, a mensagem deve
    aparecer a partir phpMussel confirmando que o carregamento foi bloqueado
    com sucesso. Se nada aparecer, algo está não funcionando corretamente. Se
    você estiver usando quaisquer avançados recursos ou se você estiver usando
    outros tipos de análisar possível com a ferramenta, Eu sugiro tentar isso
    com aqueles para certificar que ele funciona como esperado, também.

                                     ~ ~ ~


 2B. COMO INSTALAR (PARA CLI)

 Espero para agilizar este processo via fazendo um instalado em algum momento
 no não muito distante futuro, mas até então, siga estas instruções para obter
 phpMussel pronto para trabalhar com CLI (estar ciente, neste momento, CLI
 apoio só se aplica a sistemas baseados no Windows; Linux e outros sistemas
 será em breve para uma posterior versão do phpMussel):

 1) Por o seu lendo isso, eu estou supondo que você já tenha baixado uma cópia
    arquivada do script, descomprimido seu conteúdo e tê-lo sentado em algum
    lugar em sua máquina local. Quando você tiver determinado que você está
    feliz com o localização escolhido para phpMussel, continuar.

 2) phpMussel requer php para ser instalado na host máquina a fim de executar.
    Se você não ainda tno PHP instalado em sua máquina, por favor instalar o
    PHP em sua máquina, seguindo as instruções fornecidas pelo php instalador.

 2) Abrir "phpmussel.php", procure a linha que começa com "$vault=", e
    substituir a string entre as seguintes aspas em nessa linha com a
    verdadeira exata localização do "vault" diretório de phpMussel. Você vai
    ter notado tal diretório no arquivo que você tenha baixado (a menos que
    você sentir-se a re-codificação de todo o script, você terá que manter a
    mesma estrutura de arquivos e diretórios como era no arquivo
    originalmente). Este diretório "vault" deve ser um nível além do diretório
    que o arquivo "phpmussel.php" vai existirá em. Salve o arquivo, feche.

 4) (Opcional; Fortemente recomendado para avançados usuários, mas não
    recomendado para iniciantes ou para os inexperientes): Abrir
    "phpmussel.ini" (localizado dentro "vault") - Este arquivo contém todas as
    directivas disponíveis para phpMussel. Acima de cada opção deve ser um
    breve comentário descrevendo o que faz e para que serve. Ajuste essas
    opções de como você vê o ajuste, conforme o que for apropriado para sua
    particular configuração. Salve o arquivo, feche.

 5) (Opcional) Você pode fazer usando phpMussel no modo CLI mais fácil para si
    mesmo através da criação de um batch arquivo para carregar automaticamente
    php e phpMussel. Para fazer isso, abra um editor de simples texto como
    Notepad ou Notepad++, digite o completo caminho para o "php.exe" arquivo no
    php instalação diretório, seguido por um espaço, seguido pelo completo
    caminho para o "phpmussel.php" arquivo no diretório da sua phpMussel
    instalação, salvar o arquivo com a extensão ".bat" Em algum lugar que você
    vai encontrá-lo facilmente, e clique duas vezes nesse arquivo para executar
    phpMussel no futuro.

 6) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para
    garantir que ele está funcionando corretamente. Para testar phpMussel,
    executar phpMussel e tente análizar o diretório "_testfiles" fornecida com
    o pacote.

                                     ~ ~ ~


 3A. COMO USAR (PARA WEB SERVIDORES)

 phpMussel é um script destinado a funcionar de adequadamente, sem
 complicações, com um mínimo nível de requisitos por você: Após ter sido
 instalado, basicamente, ele simplesmente deve funcionar.

 Análise dos arquivos carregamentos é automatizado e ativado por padrão, por
 isso nada é exigido por você por essa particular função.

 Porém, você também é capaz de instruir phpMussel para analisar arquivos ou
 diretórios que você especificar implicitamente. Para fazer isso, em primeiro
 lugar, você vai precisar para assegurar que apropriada configuração é definida
 no phpmussel.ini arquivo (cleanup deve ser desativado), e quando feito, em um
 php arquivo que está enganchado ao phpMussel, usar a seguinte função no seu
 código:

 phpMussel($what_to_scan,$output_type,$output_flatness);

 Onde:
 - $what_to_scan é uma string ou um array, apontando para um alvo arquivo, um
   alvo diretório ou um array de alvo arquivos e/ou alvo diretórios.
 - $output_type é um integer, indicando o formato no qual os resultados da
   análise são regresso se. Um valor de 0 instrui a função para retornar
   resultados como um integer (um resultado retornado de -2 indica que corrupto
   dados foi detectado durante a análise, e portanto, a análise não foi
   concluída, -1 indica que extensões ou complementos necessários pelo php para
   executar a análise estavam faltando, e portanto, a análise não foi
   concluída, 0 indica que o alvo de análise não existe, e portanto, havia nada
   para analisar, 1 indica que o alvo foi analisado e não problemas foram
   detectados, e 2 indica que o alvo foi analisado e problemas foram
   detectados). Um valor de 1 instrui a função para retornar resultados como
   humano legível texto. Um valor de 2 instrui a função para retornar
   resultados como humano legível texto e para exportar os resultados para um
   global variável. Esta variável é opcional, padronizando a 0.
 - $output_flatness é um integer, indicando se a permitir que os resultados
   sejam retornados como uma array ou não. Normalmente, se o alvo de análise
   continha vários itens (tal como se um diretório ou array) os resultados
   serão retornados em uma array (padrão valor de 0). Um valor de 1 instrui a
   função a implodir qualquer array antes de entrada, resultando em uma
   achatada string contendo os resultados a serem retornados. Esta variável é
   opcional, padronizando a 0.

 Exemplos:

   $results=phpMussel("/user_name/public_html/my_file.html",1,1);
   echo $results;

   Retorna algo tal como esta (como uma string):
    Wed, 16 Sep 2013 02:49:46 +0000 Começado.
    > Verificação '/user_name/public_html/my_file.html':
    -> Não problemas encontrados.
    Wed, 16 Sep 2013 02:49:47 +0000 Terminado.

 Por completos detalhes sobre que tipo de assinaturas phpMussel usa durante a
 análise e como ele usa essas assinaturas, consulte a Assinatura Formato seção
 deste arquivo README.

 Se você encontrar quaisquer falsos positivos, se você encontrar algo novo que
 você acha deve ser bloqueado, ou para qualquer outra coisa com relação a
 assinatura, entre em contato comigo sobre isso para que eu possa fazer as
 mudanças necessárias, que, se você não entrar em contato comigo, eu posso não
 ser necessariamente conscientes de.

 Para desativar as assinaturas que estão incluídos com phpMussel (tal como se
 você está experimentando falsos positivos específico para seus fins que não
 deve normalmente ser removidos da agilize), consulte as notas sobre
 Greylisting dentro do Navegador Comandos seção deste README arquivo.

 Além da padrão arquivo carregamento análise e a opcional análise de outros
 arquivos e/ou diretórios especificado através da função acima, incluído no
 phpMussel é uma função destinada à análise do corpo das e-mail mensagens. Esta
 função funciona da mesma forma para a phpMussel() função, mas se concentra
 exclusivamente em fazer a comparação com as assinaturas de ClamAV baseiam
 e-mail. Eu tenho amarrei essas assinaturas para a padrão phpMussel() função,
 porque é muito pouco provável que você jamais encontrar o corpo de uma
 recebidos e-mail mensagem na necessidade de análise dentro um arquivo
 carregamento direcionado para uma página onde phpMussel é enganchada, e assim,
 para amarrar essas assinaturas para a phpMussel() função seria redundante.
 Mas, o que disse, tendo uma separada função para comparar contra essas
 assinaturas poderia revelar-se extremamente útil para alguns, especialmente
 para aqueles cuja CMS ou webfront sistema está de alguma modo enganchado em
 seu e-mail sistema e para aqueles de quem analisar seus e-mails através de um
 php script de que eles poderiam engancho para phpMussel. Configuração para
 esta função, como todos os outros, é controlado através do phpmussel.ini
 arquivo. Para utilizar esta função (você vai precisar para fazer a sua
 própria implementação) em um php arquivo que está enganchado ao phpMussel,
 usar a seguinte função no seu código:

 phpMussel_mail($body);

 Onde $body é o corpo da email mensagem que você deseja analisar (Além, você
 pode tentar analisar novos fórum posts, mensagens do seu on-line contato form
 ou similar). Se algum erro ocorrer impedindo a função de completar a sua
 análise, um valor de -1 será retornado. Se a função faz completa a sua análise
 e detecta nada, um valor de 0 será retornado (ou seja, limpo). Se, contudo, a
 função faz detectar algo, uma string será retornado contendo uma mensagem
 declarando o que foi detectado.

 Além do acima, se você olhar para o código-fonte, você pode notar a função
 phpMusselD() e phpMusselR(). Estas funções são sub-funções de phpMussel(), e
 não deve ser chamado diretamente fora dessa pai função (não por causa de
 adversos efeitos.. Mais-lo, simplesmente porque ele tinha nenhuma utilidade, e
 provavelmente não irá realmente funcionar corretamente qualquer maneira).

 Existem muitos outros controlos e funções disponíveis dentro phpMussel para
 seu uso, também. Para qualquer esses controlos e funções que, até o final
 desta seção do README, ainda não foram documentados, por favor, continue a
 leitura e consulte o Navegador Comandos seção deste README arquivo.

                                     ~ ~ ~


 3B. COMO USAR (PARA CLI)

 Por favor, consulte ao "COMO INSTALAR (PARA CLI)" seção deste README arquivo.

 Esteja ciente de que, embora futuras versões do phpMussel deve apoiar outros
 sistemas, at this time, phpMussel CLI modo suporte só é otimizado para uso em
 sistemas baseados no Windows (você pode, é claro, experimentá-lo em outros
 sistemas, mas eu não posso garantir que vai funcionar como pretendido).

 Também estar ciente de que phpMussel não é o funcional equivalente de um
 completa antivírus suíte, e contrário de convencionais antivírus suítes, não
 monitora ativa memória ou detectar vírus proativamente! Ele só irá detectar
 vírus contidos por esses específicos arquivos que você explicitamente diga a
 ele analisar.

                                     ~ ~ ~


 4A. NAVEGADOR COMANDOS

 Quando phpMussel é instalado e funcionando corretamente no seu sistema, se
 você tem configurá as variáveis script_password e logs_password no seu
 configuração arquivo, você será capaz de executar um limitado número de
 administrativas funções e entrada um algum número de comandos para phpMussel
 através de seu navegador. A razão pela qual essas senhas precisam ser
 definidas a fim de permitir que esses controles do navegador é tanto para
 garantir adequada segurança, adequada proteção desses navegador controles e
 para garantir que existe uma maneira por desses navegador controles para ser
 totalmente desativado se eles não são desejadas por você e/ou outros
 webmestres/administradores usando phpMussel. Portanto, em outras palavras,
 para ativar esses controles, definir uma senha, e para desativar esses
 controles, definir nenhum senha. Alternativamente, se você optar por ativar
 esses controles então optar por desativar esses controles em um posterior
 data, existe um comando para fazer isto (tal pode ser útil se você executar
 algumas ações que você sente poderia comprometer as senhas delegados e precisa
 para desativar rapidamente esses controles sem modificar o configuração
 arquivo).

 Algumas razões pelas quais você -deve- ativar esses controles:
 - Fornece uma maneira para greylist assinaturas em casos como quando você
   descobre uma assinatura que está produzindo um falso-positivo durante o
   carregar de arquivos para o seu sistema e você não tem tempo para
   manualmente editar e recarregar o greylist arquivo.
 - Fornece uma maneira por você para permitir alguém diferente de si mesmo para
   controlar a sua cópia do phpMussel sem a implícita necessidade a dar o
   acesso ao FTP.
 - Fornece uma maneira de fornecer controlado acesso aos seus log arquivos.
 - Fornece um fácil maneira para atualizar phpMussel quando atualizações são
   disponíveis.
 - Fornece uma maneira por você para monitorar phpMussel quando FTP acesso ou
   outras convencionais vias de acesso para monitoramento phpMussel não estão
   disponíveis.

 Algumas razões pelas quais você -não- deve ativar esses controles:
 - Fornece um vetor por potenciais atacantes e indesejáveis para determinar se
   ou não você está usando phpMussel (embora, este poderia ser tanto uma razão
   por e uma razão contra, dependendo em perspectiva) por cegamente envio de
   comandos para os servidores como meio para sondar. Por um lado, isso pode
   desencorajar os atacantes de testando seu sistema, se eles descobrem que
   você está usando phpMussel, assumindo que eles estão sondando por razões que
   o sua método de ataque é desprovido de efeito como resultado do seu uso de
   phpMussel. Mas, por outro lado, se algum imprevisto e presentemente
   desconhecidos vulnerabilidade dentro phpMussel ou um futuro versão dos
   mesmos trata de luz, e se ele poderia fornecer um vetor de ataque, um
   positivo resultado de tal sondando poderia incentivar os atacantes de
   testando seu sistema.
 - Se suas senhas delegados foram comprometidos, se não alterado, pode fornecer
   uma maneira para um atacante para ignorar o que quer assinaturas podem ser
   de outra forma normalmente prevenção sucesso de seus ataques, ou até mesmo
   potencialmente desativar phpMussel completamente, proporcionando uma forma
   de tornar a eficácia da phpMussel discutível.

 De qualquer maneira, independentemente do que você escolher, a escolha final é
 sua. Por padrão, esses controles serão desativados, mas ter um pensar sobre
 isso, e se você decidir que você quer eles, Nesta seção explica tanto como
 habilitá-los e como usá-los.

 A lista de disponíveis browser comandos:

 scan_log
   Senha necessária: logs_password
   Outros requisitos: scan_log deve ser definido.
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?logspword=[logs_password]&phpmussel=scan_log
   ~
   Que faz: Imprime o conteúdo de seu scan_log arquivo para a tela.
   ~
 scan_kills
   Senha necessária: logs_password
   Outros requisitos: scan_kills deve ser definido.
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?logspword=[logs_password]&phpmussel=scan_kills
   ~
   Que faz: Imprime o conteúdo de seu scan_kills arquivo para a tela.
   ~
 controls_lockout
   Senha necessária: logs_password OU script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo 1: ?logspword=[logs_password]&phpmussel=controls_lockout
   Exemplo 2: ?pword=[script_password]&phpmussel=controls_lockout
   ~
   Que faz: Desativa todos os navegador controles. Isso deve ser usado se você
            suspeitar que qualquer das senhas foram comprometidas (isso pode
            acontecer se você estiver usando esses controles a através de um
            computador que não é seguro ou não é confiável). controls_lockout
            funciona através de criando um arquivo, controls.lck, no seu vault,
            de que phpMussel irá olhar por antes de executar qualquer comando
            de qualquer variedade. Quando isso acontece, para reativar os
            controlos, você precisará manualmente deletar o controls.lck
            arquivo através de FTP ou semelhante. Pode ser chamado usando
            qualquer senha.
   ~
 disable
   Senha necessária: script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?pword=[script_password]&phpmussel=disable
   ~
   Que faz: Desativar phpMussel. Isso deve ser usado se você estiver executando
            quaisquer atualizações ou alterações no seu sistema ou se está
            instalando qualquer novo software ou módulos para seu sistema que
            fazer ou potencialmente poderiam desencadear falsos positivos. Isso
            também deve ser usado se você está tendo problemas com phpMussel
            mas não deseja removê-lo do sistema. Quando isso acontece, para
            reativar phpMussel, uso "enable".
   ~
 enable
   Senha necessária: script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?pword=[script_password]&phpmussel=enable
   ~
   Que faz: Ativar phpMussel. Este deve ser usado se você já desativado
            phpMussel usando "disable" e desejar para reativá-la.
   ~
 update
   Senha necessária: script_password
   Outros requisitos: update.dat and update.inc must exist.
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: forcedupdate
   Exemplo: ?pword=[script_password]&phpmussel=update&musselvar=forcedupdate
   ~
   Que faz: Verifica se há atualizações para ambos phpMussel e suas
            assinaturas. Se as atualização verificações suceder e atualizações
            são encontrados, tentará baixar e instalar essas atualizações. Se
            atualizações são verificados muito rapidamente, atualização
            verificação irá abortar. Se atualização verificação falha,
            atualização irá abortar. Se opcional parâmetro "forcedupdate" é
            fornecido, hora da última atualização será ignorada, e assim,
            atualizar verificação será continuará mesmo que está sendo
            verificado "muito rapidamente", mas ainda vai abortar se a
            atualização verificação falha. Os resultados de o inteiro processo
            são impressos na tela. Eu recomendo incluindo opcional parâmetro
            "forcedupdate" se você está manualmente acionando esse controle,
            mas por favor, não uso "forcedupdate" se você estiver automatizando
            o processo, tal como através de cron ou semelhante. Eu recomendo
            verificando pelo menos uma vez por mês para garantir que seus
            assinaturas e sua cópia do phpMussel são mantidos atualizados
            (A menos, claro, você está verificando se há atualizações e
            instalá-los manualmente, que, eu ainda recomendo fazer pelo menos
            um por mês). Verificando mais de que duas vezes por mês é
            provavelmente inútil, considerando que eu (no momento de escrever
            este) estou trabalhando neste projeto sozinho e eu estou muito
            improvável que seja capaz de produzir atualizações de qualquer
            variedade com mais freqüência do que (nem eu particularmente quero
            para a maior parte).
   ~
 greylist
   Senha necessária: script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: [Nome de assinatura a ser greylisted]
   Parâmetros opcionais: (nenhum)
   Exemplo: ?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]
   ~
   Que faz: Adicionar uma assinatura para o greylist.
   ~
 greylist_clear
   Senha necessária: script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?pword=[script_password]&phpmussel=greylist_clear
   ~
   Que faz: Limpo inteiro greylist.
   ~
 greylist_show
   Senha necessária: script_password
   Outros requisitos: (nenhum)
   Parâmetros necessários: (nenhum)
   Parâmetros opcionais: (nenhum)
   Exemplo: ?pword=[script_password]&phpmussel=greylist_show
   ~
   Que faz: Imprime o conteúdo da greylist para a tela.
   ~

                                     ~ ~ ~


 4B. CLI (COMANDO LINHA INTERFACE)

 phpMussel pode ser executado como um interativo arquivo analisador no CLI modo
 em sistemas baseados em Windows. Por favor, consulte ao
 "COMO INSTALAR (PARA CLI)" seção deste README arquivo por mais detalhes.

 Por uma lista de comandos disponíveis Em CLI, no CLI prompt, digite 'c', e
 pressione Enter.

                                     ~ ~ ~


 5. ARQUIVOS INCLUÍDOS NESTE PACOTE

 O seguinte está uma lista de todos os arquivos que deveria sido incluídos na
 arquivada cópia desse script quando você baixado-lo, todos os arquivos que
 podem ser potencialmente criados como resultado de seu uso deste script,
 juntamente com uma breve descrição do que todos esses arquivos são por.

 /phpmussel.php (Script, Incluído)
    phpMussel carregador arquivo. Carrega o principal script, atualizador, etc.
    Isto é o que você deveria ser enganchando em (essencial)!
    ~
 /web.config (Outro, Incluído)
    Um ASP.NET configuração arquivo (neste caso, para proteger o "vault"
    diretório contra serem acessado por fontes não autorizadas em caso que o
    script está instalado em um servidor baseado em ASP.NET tecnologias).
    ~
 /_docs/ (Diretório)
    Documentação diretório (contém vários arquivos).
    ~
 /_docs/change_log.txt (Documentação, Incluído)
    Um registro das mudanças feitas para o script entre o diferentes versões
    (não é necessário para o correto funcionamento do script).
    ~
 /_docs/readme.DE.txt (Documentação, Incluído); DEUTSCH
 /_docs/readme.EN.txt (Documentação, Incluído); ENGLISH
 /_docs/readme.ES.txt (Documentação, Incluído); ESPAÑOL
 /_docs/readme.FR.txt (Documentação, Incluído); FRANÇAIS
 /_docs/readme.ID.txt (Documentação, Incluído); BAHASA INDONESIA
 /_docs/readme.IT.txt (Documentação, Incluído); ITALIANO
 /_docs/readme.NL.txt (Documentação, Incluído); NEDERLANDSE
 /_docs/readme.PT.txt (Documentação, Incluído); PORTUGUÊS
    O README arquivos (por exemplo; o arquivo que você está lendo atualmente).
    ~
 /_docs/signatures_tally.txt (Documentação, Incluído)
    Contagem registro dos assinaturas incluídos (não é necessário para o
    correto funcionamento do script).
    ~
 /_testfiles/ (Diretório)
    Teste arquivo diretório (contém vários arquivos).
    Todos os arquivos contidos são teste arquivos para testar se phpMussel foi
    instalado corretamente no seu sistema, e você não precisa carregar desse
    diretório ou qualquer de seus arquivos, exceto ao fazer tais testando.
    ~
 /_testfiles/ascii_standard_testfile.txt (Test file, Incluído)
    Teste arquivo para testar phpMussel normalizada ASCII assinaturas.
    ~
 /_testfiles/coex_testfile.rtf (Test file, Incluído)
    Teste arquivo para testar phpMussel complexos estendidas assinaturas.
    ~
 /_testfiles/exe_standard_testfile.exe (Test file, Incluído)
    Teste arquivo para testar phpMussel PE assinaturas.
    ~
 /_testfiles/general_standard_testfile.txt (Test file, Incluído)
    Teste arquivo para testar phpMussel gerais assinaturas.
    ~
 /_testfiles/graphics_standard_testfile.gif (Test file, Incluído)
    Teste arquivo para testar phpMussel gráficas assinaturas.
    ~
 /_testfiles/html_standard_testfile.txt (Test file, Incluído)
    Teste arquivo para testar phpMussel normalizada HTML assinaturas.
    ~
 /_testfiles/md5_testfile.txt (Test file, Incluído)
    Teste arquivo para testar phpMussel MD5 assinaturas.
    ~
 /_testfiles/metadata_testfile.txt.gz (Test file, Incluído)
    Teste arquivo por testando phpMussel metadados assinaturas e por testando
    GZ arquivo suport no seu sistema.
    ~
 /_testfiles/metadata_testfile.zip (Test file, Incluído)
    Teste arquivo por testando phpMussel metadados assinaturas e por testando
    ZIP arquivo suport no seu sistema.
    ~
 /_testfiles/ole_testfile.ole (Test file, Incluído)
    Teste arquivo para testar phpMussel OLE assinaturas.
    ~
 /_testfiles/pdf_standard_testfile.pdf (Test file, Incluído)
    Teste arquivo para testar phpMussel PDF assinaturas.
    ~
 /_testfiles/pe_sectional_testfile.exe (Test file, Incluído)
    Teste arquivo para testar phpMussel PE Seccional assinaturas.
    ~
 /_testfiles/xdp_standard_testfile.xdp (Test file, Incluído)
    Teste arquivo para testar phpMussel XML/XDP-Pedaço assinaturas.
    ~
 /vault/ (Diretório)
    Vault diretório (contém vários arquivos).
    ~
 /vault/quarantine/ (Diretório)
    Quarentena diretório (contém os arquivos em quarentena).
    ~
 /vault/quarantine/.htaccess (Outro, Incluído)
    Um hipertexto acesso arquivo (neste caso, para proteger confidenciais
    arquivos pertencentes ao script contra serem acessados por fontes não
    autorizadas).
    ~
 /vault/.htaccess (Outro, Incluído)
    Um hipertexto acesso arquivo (neste caso, para proteger confidenciais
    arquivos pertencentes ao script contra serem acessados por fontes não
    autorizadas).
    ~
 /vault/ascii_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/ascii_clamav_regex.map (Assinaturas, Incluídos)
 /vault/ascii_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/ascii_clamav_standard.map (Assinaturas, Incluídos)
 /vault/ascii_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/ascii_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/ascii_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/ascii_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por normalizada ASCII assinaturas.
    Necessário se o normalizada ASCII assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/coex_clamav.cvd (Assinaturas, Incluídos)
 /vault/coex_custom.cvd (Assinaturas, Incluídos)
 /vault/coex_mussel.cvd (Assinaturas, Incluídos)
    Arquivos por o complexos estendidas assinaturas.
    Necessário se o complexos estendidas assinaturas opção em phpmussel.ini
    está ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/elf_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/elf_clamav_regex.map (Assinaturas, Incluídos)
 /vault/elf_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/elf_clamav_standard.map (Assinaturas, Incluídos)
 /vault/elf_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/elf_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/elf_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/elf_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por ELF assinaturas.
    Necessário se o ELF assinaturas opção em phpmussel.ini está ativado. Pode
    remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/exe_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/exe_clamav_regex.map (Assinaturas, Incluídos)
 /vault/exe_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/exe_clamav_standard.map (Assinaturas, Incluídos)
 /vault/exe_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/exe_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/exe_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/exe_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por Portátil Executável arquivo (EXE) assinaturas.
    Necessário se o EXE assinaturas opção em phpmussel.ini está ativado. Pode
    remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/filenames_clamav.cvd (Assinaturas, Incluídos)
 /vault/filenames_custom.cvd (Assinaturas, Incluídos)
 /vault/filenames_mussel.cvd (Assinaturas, Incluídos)
    Arquivos por arquivo nome assinaturas.
    Necessário se o arquivo nome assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/general_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/general_clamav_regex.map (Assinaturas, Incluídos)
 /vault/general_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/general_clamav_standard.map (Assinaturas, Incluídos)
 /vault/general_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/general_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/general_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/general_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por gerais assinaturas.
    Necessário se o gerais assinaturas opção em phpmussel.ini está ativado.
    Pode remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/graphics_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/graphics_clamav_regex.map (Assinaturas, Incluídos)
 /vault/graphics_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/graphics_clamav_standard.map (Assinaturas, Incluídos)
 /vault/graphics_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/graphics_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/graphics_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/graphics_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por gráficas assinaturas.
    Necessário se o gráficas assinaturas opção em phpmussel.ini está ativado.
    Pode remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/greylist.csv (Assinaturas, Incluídos/Criados)
    CSV de greylisted assinaturas indicando a phpMussel quais assinaturas deve
    ser ignorado (arquivo automaticamente recriado se deletado).
    ~
 /vault/hex_general_commands.csv (Assinaturas, Incluídos)
    Hex-codificado CSV de geral comando detecções opcionalmente usado por
    phpMussel. Necessário se o geral comando detecções opção em phpmussel.ini
    está ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/html_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/html_clamav_regex.map (Assinaturas, Incluídos)
 /vault/html_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/html_clamav_standard.map (Assinaturas, Incluídos)
 /vault/html_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/html_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/html_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/html_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por normalizada HTML assinaturas.
    Necessário se o normalizada HTML assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/lang.inc (Script, Incluído)
    phpMussel Linguagem Dados; Necessário por multilingues capacidades.
    ~
 /vault/macho_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/macho_clamav_regex.map (Assinaturas, Incluídos)
 /vault/macho_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/macho_clamav_standard.map (Assinaturas, Incluídos)
 /vault/macho_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/macho_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/macho_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/macho_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por Mach-O assinaturas.
    Necessário se o Mach-O assinaturas opção em phpmussel.ini está ativado.
    Pode remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/mail_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/mail_clamav_regex.map (Assinaturas, Incluídos)
 /vault/mail_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/mail_clamav_standard.map (Assinaturas, Incluídos)
 /vault/mail_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/mail_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/mail_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/mail_mussel_standard.cvd (Assinaturas, Incluídos)
 /vault/mail_mussel_standard.map (Assinaturas, Incluídos)
    Arquivos por assinaturas usado por a phpMussel_mail() função.
    Necessário se o phpMussel_mail() função é utilizado em qualquer forma.
    Pode remover se não usado (mas os arquivos serão recriados na atualização).
    ~
 /vault/md5_clamav.cvd (Assinaturas, Incluídos)
 /vault/md5_custom.cvd (Assinaturas, Incluídos)
 /vault/md5_mussel.cvd (Assinaturas, Incluídos)
    Arquivos por MD5 baseadas assinaturas.
    Necessário se o MD5 baseadas assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/metadata_clamav.cvd (Assinaturas, Incluídos)
 /vault/metadata_custom.cvd (Assinaturas, Incluídos)
 /vault/metadata_mussel.cvd (Assinaturas, Incluídos)
    Arquivos por metadados assinaturas.
    Necessário se o metadados assinaturas opção em phpmussel.ini está ativado.
    Pode remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/ole_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/ole_clamav_regex.map (Assinaturas, Incluídos)
 /vault/ole_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/ole_clamav_standard.map (Assinaturas, Incluídos)
 /vault/ole_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/ole_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/ole_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/ole_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por OLE assinaturas.
    Necessário se OLE assinaturas opção em phpmussel.ini está ativado. Pode
    remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/pdf_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/pdf_clamav_regex.map (Assinaturas, Incluídos)
 /vault/pdf_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/pdf_clamav_standard.map (Assinaturas, Incluídos)
 /vault/pdf_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/pdf_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/pdf_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/pdf_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por PDF assinaturas.
    Necessário se PDF assinaturas opção em phpmussel.ini está ativado. Pode
    remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/pe_clamav.cvd (Assinaturas, Incluídos)
 /vault/pe_custom.cvd (Assinaturas, Incluídos)
 /vault/pe_mussel.cvd (Assinaturas, Incluídos)
    Arquivos por PE Seccional assinaturas.
    Necessário se o PE Seccional assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/phpmussel.inc (Script, Incluído)
    phpMussel Núcleo Script; O principal corpo de phpMussel (essencial)!
    ~
 /vault/phpmussel.ini (Outro, Incluído)
    phpMussel configuração arquivo; Contém todas ao configuração opções de
    phpMussel, dizendo-lhe o que fazer e como operar corretamente (essencial)!
    ~
 /vault/scan_log.txt *(Logfile, Criado)
    Um registro de tudo analisado por phpMussel.
    ~
 /vault/scan_kills.txt *(Logfile, Criado)
    Um registro de tudos os arquivos carregamentos bloqueado ou matado por
    phpMussel.
    ~
 /vault/swf_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/swf_clamav_regex.map (Assinaturas, Incluídos)
 /vault/swf_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/swf_clamav_standard.map (Assinaturas, Incluídos)
 /vault/swf_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/swf_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/swf_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/swf_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por o Shockwave assinaturas.
    Necessário se o Shockwave assinaturas opção em phpmussel.ini está ativado.
    Pode remover se a opção é desativado (mas os arquivos serão recriados na
    atualização).
    ~
 /vault/template.html (Outro, Incluído)
    phpMussel template arquivo; Template por HTML produzido através do
    phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto
    por o carregador).
    ~
 /vault/update.dat (Outro, Incluído)
    Arquivo contendo informações sobre a versão por tanto script e assinaturas
    de phpMussel. Se você está tencionando automaticamente atualizar phpMussel
    ou deseja atualizar phpMusel através de seu navegador, este arquivo é
    essencial.
    ~
 /vault/update.inc (Script, Incluído)
    phpMussel Atualização Script; Necessário por automáticas atualizações e
    para atualizar phpMussel através de seu navegador, mas não é necessário
    contrário.
    ~
 /vault/whitelist_clamav.cvd (Assinaturas, Incluídos)
 /vault/whitelist_custom.cvd (Assinaturas, Incluídos)
 /vault/whitelist_mussel.cvd (Assinaturas, Incluídos)
    Arquivo específico whitelist.
    Necessário se o whitelist opção em phpmussel.ini está ativado e se você
    deseja ter específicos arquivos whitelisted. Pode remover se a opção é
    desativado ou se você não precisa whitelisting (mas os arquivos serão
    recriados na atualização).
    ~
 /vault/xmlxdp_clamav_regex.cvd (Assinaturas, Incluídos)
 /vault/xmlxdp_clamav_regex.map (Assinaturas, Incluídos)
 /vault/xmlxdp_clamav_standard.cvd (Assinaturas, Incluídos)
 /vault/xmlxdp_clamav_standard.map (Assinaturas, Incluídos)
 /vault/xmlxdp_custom_regex.cvd (Assinaturas, Incluídos)
 /vault/xmlxdp_custom_standard.cvd (Assinaturas, Incluídos)
 /vault/xmlxdp_mussel_regex.cvd (Assinaturas, Incluídos)
 /vault/xmlxdp_mussel_standard.cvd (Assinaturas, Incluídos)
    Arquivos por XML/XDP-Pedaço assinaturas.
    Necessário se XML/XDP-Pedaço assinaturas opção em phpmussel.ini está
    ativado. Pode remover se a opção é desativado (mas os arquivos serão
    recriados na atualização).
    ~

 * Arquivo nome podem variar baseado em configuração estipulação
   (referem-se a phpmussel.ini).

 = EM RELAÇÃO AOS ASSINATURAS ARQUIVOS =
    CVD é um acrônimo por "ClamAV Virus Definitions", em referência tanto à
    forma como ClamAV refere-se às suas próprias assinaturas e para o uso
    dessas assinaturas por phpMussel; Arquivos que terminam com "CVD" contêm
    assinaturas.
    ~
    Arquivos que terminam com "MAP", literalmente, mapa quais assinaturas
    phpMussel deve e não deve ser usado para análisar arquivos; Nem todas as
    assinaturas são necessariamente necessário por cada individual análise, e
    assim, phpMussel usa mapas dos assinatura arquivos para acelerar o processo
    de análise (um processo que de outro modo seria extremamente lento e
    tedioso).
    ~
    Assinatura arquivos marcados com "_regex" contêm assinaturas que utilizam
    regulares expressões (regex).
    ~
    Assinatura arquivos marcados com "_standard" contêm assinaturas que
    especificamente não utilizam qualquer forma de regulares expressões.
    ~
    Assinatura arquivos marcados com nenhum "_regex" nem "_standard" será como
    um ou outro, mas não tanto (consulte Assinatura Formato seção deste README
    arquivo por documentação e específicos detalhes).
    ~
    Assinatura arquivos marcados com "_clamav" contêm assinaturas, provenientes
    exclusivamente do ClamAV database (GNU/GPL).
    ~
    Assinatura arquivos marcados com "_custom", por padrão, não contêm qualquer
    assinatura; Esses arquivos existem para dar-lhe um lugar para colocar suas
    próprias personalizadas assinaturas, se você criar algum do seu próprio.
    ~
    Assinatura arquivos marcados com "_mussel" contêm assinaturas que são
    especificamente não provenientes de ClamAV, assinaturas que, em geral, eu
    criei pessoalmente ou baseado em informações obtidas através de várias
    fontes.
    ~

                                     ~ ~ ~


 6. CONFIGURAÇÃO OPÇÕES

 O seguinte é uma lista de variáveis encontradas no "phpmussel.ini"
 configuração arquivo de phpMussel, juntamente com uma descrição de sua
 propósito e função.

 "general" (Categoria)
 - Geral configuração por phpMussel.
    "script_password"
    - Como uma conveniência, phpMussel permitirás certas funções (incluindo a
      capacidade de atualizando phpMussel remotamente) ao ser acionado
      manualmente através de POST, GET e QUERY. Mas, como medida de segurança,
      para fazer isso, phpMussel esperam uma senha para ser incluída com o
      comando, forma a garantir que é você, e não outra pessoa, tentando de
      acionar manualmente essas funções. Definir script_password para qualquer
      senha que você desejá usar. Se nenhuma senha for definida, o manual
      acionamento será desativado por padrão. Uso algo que você vai se lembrar,
      mas que é difícil por outros adivinharem.
      * Não tem influência em CLI modo.
    "logs_password"
    - O mesmo como script_password, mas por visualizando conteúdo de scan_log e
      scan_kills. Tendo separadas senhas pode ser útil se você quiser dar
      alguém o acesso a um conjunto de funções mas não o outro.
      * Não tem influência em CLI modo.
    "cleanup"
    - Deletar script variáveis e cache após a execução. Se você não estiver
      usar o script além da inicial verificação de carregamentos, deve definir
      a sim/yes, para minimizar o uso de memória. Se você estiver usar o script
      por fins além da inicial verificação de carregamentos, deve definir a
      não/no, para evitar desnecessariamente duplicados dados recarregando em
      memória. Em prática geral, deve provavelmente ser definido como sim/yes,
      mas, se você fizer isso, você não será capaz de usando o script por
      qualquer outra fim além analisando arquivos carregamentos.
      * Não tem influência em CLI modo.
    "scan_log"
    - Arquivo nome do arquivo para registrar todos os análise resultados em.
      Especifique um arquivo nome, ou deixe branco para desativar.
    "scan_kills"
    - Arquivo nome do arquivo para registrar todos os bloqueados ou matados
      carregamentos em. Especifique um arquivo nome, ou deixe branco para
      desativar.
    "ipaddr"
    - Onde encontrar o IP endereço dos pedidos? (Útil por serviços como o
      Cloudflare e tal) Padrão = REMOTE_ADDR
      ATENÇÃO: Não mude isso a menos que você saiba o que está fazendo!
    "forbid_on_block"
    - Deve phpMussel enviar 403 header com a bloqueado arquivo carregamento
      mensagem, ou ficar com os habituais 200 OK?
      0 = Não (200) [Padrão], 1 Sim (403).
    "delete_on_sight"
    - Ativando esta opção irá instruir o script para tentar imediatamente
      deletando qualquer arquivo que ele encontra durante a análise que
      corresponde a qualquer critério de detecção, quer seja através de
      assinaturas ou de outra forma. Arquivos determinados para ser "limpo" não
      serão tocados. Em caso de compactados arquivos, o inteiro arquivo será
      deletado (independentemente de se o problemático arquivo é apenas um dos
      vários arquivos contidos dentro do compactado arquivo). Para o caso de
      arquivo carregamento análise, em geral, não é necessário ativar essa
      opção, porque normalmente, php irá automaticamente expurgar os conteúdos
      de o seu cache quando a execução foi concluída, significando que ele vai
      normalmente deletar todos os arquivos enviados através dele para o
      servidor a menos que tenha movido, copiado ou deletado já. A opção é
      adicionado aqui como uma medida de segurança para o extra paranóico e por
      aqueles cujas cópias de php nem sempre se comportam da forma esperado.
      0 - Após a análise, deixe o arquivo sozinho [Padrão],
      1 - Após a análise, se não limpo, deletar imediatamente.
    "lang"
    - Especifique o padrão língua por phpMussel.
    "quarantine_key"
    - phpMussel é capaz de colocar em quarentena marcados tentados arquivos
      carregamentos em isolamento dentro da phpMussel vault, se isso é algo que
      você quer que ele faça. Casuais usuários de phpMussel de que simplesmente
      desejam proteger seus sites ou hospedagem sem ter qualquer interesse em
      profundamente analisando qualquer marcados tentados arquivos
      carregamentos deve deixar esta funcionalidade desativada, mas qualquer
      usuário interessado em mais profundamente analisando marcados tentados
      arquivos carregamentos para pesquisa de malware ou de similares tais
      coisas deve ativada essa funcionalidade. Quarentena de marcados tentados
      arquivos carregamentos às vezes pode também ajudar em depuração de
      falso-positivos, se isso é algo que ocorre com freqüência para você. Por
      desativar a funcionalidade de quarentena, simplesmente deixar a directiva
      "quarantine_key" vazio, ou apagar o conteúdo do directivo, se ele não
      está já vazio. Por ativar a funcionalidade de quarentena, introduzir
      algum valor no directiva. O "quarantine_key" é um importante segurança
      característica do quarentena funcionalidade necessária como um meio de
      prevenir a funcionalidade de quarentena de ser explorada por potenciais
      atacantes e como meio de evitar qualquer potencial execução de dados
      armazenados dentro da quarentena. O "quarantine_key" devem ser tratados
      da mesma maneira como suas senhas: O mais longo o mais melhor, e
      guardá-lo com força. Por melhor efeito, usar em conjunto com
      "delete_on_sight".
    "quarantine_max_filesize"
    - O máximo permitido tamanho do arquivos serem colocados em quarentena.
      Arquivos maiores que este valor NÃO serão colocados em quarentena. Esta
      directiva é importante como um meio de torná-lo mais difícil por qualquer
      potenciais atacante para inundar sua quarentena com indesejados dados
      potencialmente causando excesso uso de dados no seu hospedagem serviço.
      O valor é em KB. Padrão =2048 =2048KB =2MB.
    "quarantine_max_usage"
    - O máximo uso de memória permitido através do quarentena. Se o total de
      memória utilizada pelo quarentena atingir este valor, os mais antigos
      arquivos em quarentena serão apagados até que a total memória utilizada
      já não atinge este valor. Esta directiva é importante como um meio de
      torná-lo mais difícil por qualquer potenciais atacante para inundar sua
      quarentena com indesejados dados potencialmente causando excesso uso de
      dados no seu hospedagem serviço. O valor é em KB.
      Padrão =65536 =65536KB =64MB.
    "honeypot_mode"
    - Quando o honeypot modo é ativada, phpMussel vai tenta coloca no
      quarentena todos os arquivos uploads que ele encontras, independentemente
      de se ou não o arquivo que está sendo carregado corresponde a qualquer
      incluídos assinaturas, e zero análise desses tentados arquivos
      carregamentos vai ocorrer. Esta funcionalidade deve ser útil por aqueles
      que desejam utilizar phpMussel por os fins de vírus/malware pesquisa, mas
      não é recomendado para ativar essa funcionalidade se o planejado uso de
      phpMussel pelo utilizador é por o real análise dos arquivos carregamentos
      nem recomendado para usar essa funcionalidade por fins outros que o uso
      do honeypot. Por padrão, essa opção está desativada.
      0 = Desativado [Padrão], 1 = Ativado.
 "Assinaturas" (Categoria)
 - Configuração por assinaturas.
   %%%_clamav = ClamAV assinaturas (ambos main e daily).
   %%%_custom = Suas personalizadas assinaturas (se você escrever alguma).
   %%%_mussel = phpMussel assinaturas incluído no seus atuais assinaturas
                conjunto que não são do ClamAV.
   - Verificar contra MD5 assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "md5_clamav"
     "md5_custom"
     "md5_mussel"
   - Verificar contra geral assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "general_clamav"
     "general_custom"
     "general_mussel"
   - Verificar contra normalizada ASCII assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "ascii_clamav"
     "ascii_custom"
     "ascii_mussel"
   - Verificar contra normalizada HTML assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "html_clamav"
     "html_custom"
     "html_mussel"
   - Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE
     Seccional assinaturas quando analisando? 0 = Não, 1 = Sim [Padrão].
     "pe_clamav"
     "pe_custom"
     "pe_mussel"
   - Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE
     assinaturas quando analisando? 0 = Não, 1 = Sim [Padrão].
     "exe_clamav"
     "exe_custom"
     "exe_mussel"
   - Verificar ELF arquivos contra ELF assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "elf_clamav"
     "elf_custom"
     "elf_mussel"
   - Verificar Mach-O arquivos (OSX, etc) contra Mach-O assinaturas quando
     analisando? 0 = Não, 1 = Sim [Padrão].
     "macho_clamav"
     "macho_custom"
     "macho_mussel"
   - Verificar gráficos arquivos contra gráficas assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "graphics_clamav"
     "graphics_custom"
     "graphics_mussel"
   - Verificar compactados arquivos conteúdo contra compactados arquivos
     metadados assinaturas quando analisando? 0 = Não, 1 = Sim [Padrão].
     "metadata_clamav"
     "metadata_custom"
     "metadata_mussel"
   - Verificar OLE objetos contra OLE assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "ole_clamav"
     "ole_custom"
     "ole_mussel"
   - Verificar arquivos nomes contra assinaturas arquivos nomes baseadas
     assinaturas quando analisando? 0 = Não, 1 = Sim [Padrão].
     "filenames_clamav"
     "filenames_custom"
     "filenames_mussel"
   - Permitir análise com phpMussel_mail()? 0 = Não, 1 = Sim [Padrão].
     "mail_clamav"
     "mail_custom"
     "mail_mussel"
   - Habilite arquivo-específico whitelist? 0 = Não, 1 = Sim [Padrão].
     "whitelist_clamav"
     "whitelist_custom"
     "whitelist_mussel"
   - Verificar XML/XDP pedaços contra XML/XDP-pedaço assinaturas quando
     analisando? 0 = Não, 1 = Sim [Padrão].
     "xmlxdp_clamav"
     "xmlxdp_custom"
     "xmlxdp_mussel"
   - Verificar contra Complexos Estendidos assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "coex_clamav"
     "coex_custom"
     "coex_mussel"
   - Verificar contra PDF assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "pdf_clamav"
     "pdf_custom"
     "pdf_mussel"
   - Verificar contra Shockwave assinaturas quando analisando?
     0 = Não, 1 = Sim [Padrão].
     "swf_clamav"
     "swf_custom"
     "swf_mussel"
   - Assinatura analisando comprimento limitando opções. Apenas alterar estes
     se você sabe que está fazendo. SD = Standard signatures (norma
     assinaturas). RX = PCRE (Perl Compatible Regular Expressions, ou "Regex")
     assinaturas. FN = Arquivo nome assinaturas. Se você notar php falhando
     quando phpMussel tenta analisar, tente diminuir o "max" valores. Se
     possível e conveniente, deixe-me saber quando isso acontece e os
     resultados de tudo o que você tentar.
     "fn_siglen_min"
     "fn_siglen_max"
     "rx_siglen_min"
     "rx_siglen_max"
     "sd_siglen_min"
     "sd_siglen_max"
   - Deve phpMussel reportar quando os assinaturas arquivos estão perdido ou
     corrompido? Se fail_silently está desativado, perdidos e corrompidos
     arquivos serão reportado sobre análise, e se fail_silently está ativado,
     perdidos e corrompidos arquivos serão ignoradas, com a análise reportado
     por estes arquivos em que não há problemas. Isso geralmente deve ser
     deixado sozinho a menos que você está experimentando php falhas ou
     semelhantes problemas. 0 = Desativado [Padrão], 1 = Ativado.
     "fail_silently"
 "files" (Categoria)
 - Geral configuração por a manipulação de arquivos.
   "max_uploads"
   - O máximo permitido número de arquivos para analisar durante os arquivos
     carregamentos análise antes de abortar a análise e informando ao usuário
     eles estão carregando demais muito de uma vez! Oferece proteção contra um
     teórico ataque pelo qual um atacante tenta DDoS o seu sistema ou CMS por
     meio de sobrecarregando phpMussel a fim de retardar o php processo para
     uma parada. Recomendado: 10. Você pode querer aumentar ou diminuir esse
     número, dependendo das atributos do seu hardware. Note-se que este número
     não lev. Em conta ou incluir o conteúdos dos compactados arquivos.
   "filesize_limit"
   - Arquivo tamanho limit. Em KB. 65536 = 64MB [Padrão]
     0 = Não limite (sempre greylisted), qualquer (positivo) numérico valor
     aceite. Isso pode ser útil quando sua PHP configuração limita a quantidade
     de memória que um processo pode ocupar ou se sua PHP configuração limita o
     arquivo tamanho de carregamentos.
   "filesize_response"
   - Que fazer com arquivos que excedam o limite de arquivo tamanho (se
     existir). 0 - Whitelist, 1 - Blacklist [Padrão].
   "filetype_whitelist", "filetype_blacklist", "filetype_greylist"
   - Se o seu sistema só permite certos tipos de arquivos sejam carregado, ou
     se o seu sistema explicitamente nega certos tipos de arquivos,
     especificando esses tipos de arquivos no whitelists, blacklists e
     greylists pode aumentar a velocidado em que a análise é realizada através
     de permitindo o script para ignorar certos tipos de arquivos. O formato
     CSV (Comma Separated Values). Se você quer analisar tudo, ao invés de
     fazendo whitelist, blacklist ou greylist, deixe as variáveis em branco;
     Isso irá desativar whitelist/blacklist/greylist).
     Lógico ordem de processamento é:
     - Se o tipo de arquivo está na whitelist, não verificar e não bloqueia o
       arquivo, e não verificar o arquivo contra o blacklist ou greylist.
     - Se o tipo de arquivo está na blacklist, não verificar o arquivo, mas
       bloqueá-lo de qualquer maneira, e não verificar o arquivo contra o
       greylist.
     - Se o greylist está vazia ou se o greylist não está vazia e o tipo de
       arquivo é no greylist, verificar o arquivo como por normal e determinar
       se a bloqueá-lo com base nos resultados do verificando, mas se o
       greylist não está vazia e o tipo de arquivo não é no greylist, tratar o
       arquivo da mesma maneira como está na blacklist, portanto não
       verificá-lo, mas bloqueá-lo de qualquer maneira.
   "check_archives"
   - Tentativa de verificar o conteúdos dos compactados arquivos?
     0 - Não (Não verificar), 1 - Sim (Verificar) [Padrão].
     * Neste momento, apenas a verificação de BZ, GZ, LZF e ZIP arquivos é
       suportados (verificação de RAR, CAB, 7z e etcetera suportados neste
       momento).
     * Este não é infalível! Embora eu recomendo mantê-lo ativado, eu não posso
       garantir que sempre vai encontrar tudo.
     * Também estar ciente de que a verificação do compactados arquivos, neste
       momento, não é recursiva por ZIP arquivos.
   "filesize_archives"
   - Herdar o arquivo tamanho blacklist/whitelist para o conteúdo de
     compactados arquivos? 0 - Não (greylist tudo), 1 - Sim [Padrão].
   "filetype_archives"
   - Herdar o arquivo tipo blacklist/whitelist para o conteúdo de compactados
     arquivos? 0 - Não (greylist tudo), 1 - Sim [Padrão].
   "max_recursion"
   - Máxima recursão profundidade limite por compactados arquivos. Padrão = 10.
 "attack_specific" (Categoria)
 - Configuração por específicas ataque detecções (não baseado em CVDs).
   * Chameleon ataque detecções: 0 = Ativo, 1 = Inativo.
   "chameleon_from_php"
   - Olha por php heade. Em arquivos que são não php arquivos nem
     reconhecidos compactados arquivos.
   "chameleon_from_exe"
   - Olha por executável headers em arquivos que são não executáveis nem
     reconhecidos compactados arquivos e por executáveis cujos headers estão
     incorretas.
   "chameleon_to_archive"
   - Olha por compactados arquivos cujos headers estão incorretas
     (Suportados: BZ, GZ, RAR, ZIP, RAR, GZ).
   "chameleon_to_doc"
   - Olha por office documentos cujos headers estão incorretas
     (Suportados: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).
   "chameleon_to_img"
   - Olha por imagens cujos headers estão incorretas (Suportados: BMP, DIB,
     PNG, GIF, JPEG, JPG, XCF, PSD, PDD).
   "chameleon_to_pdf"
   - Olha por PDF arquivos cujos headers estão incorretas.
   "archive_file_extensions" and "archive_file_extensions_wc"
   - Reconhecidos arquivos extensões (formato é CSV; só deve adicionar ou
     remover quando problemas ocorrem; desnecessariamente removendo pode causar
     falso-positivos para aparecer por compactados arquivos, enquanto
     desnecessariamente adicionando será essencialmente whitelist o que você
     está adicionando contra ataque específica detecção; modificar com cautela;
     Também notar que este não tem efeito em qual compactados arquivos podem e
     não podem ser analisados no escopo de conteúdo). A lista, como é padrão,
     é do formatos utilizados mais comumente através da maioria dos sistemas e
     CMS, mas intencionalmente não é necessariamente abrangente.
   "general_commands"
   - Olha por gerais comandos como tais eval(), exec() e include() em conteúdos
     de arquivos? 0 - Não (não olha por) [Padrão], 1 - Sim (olha por).
     Desativar essa opção se você são tencionando de carregando qualquer um do
     seguinte para o seu sistema ou CMS através do seu navegador: php,
     JavaScript, HTML, python, perl files e etcetera. Ativar essa opção se você
     não tem quaisquer adicionais proteções no seu sistema e não são
     tencionando de carregando desses tais arquivos. Se você usar adicional
     segurança em conjunto com phpMussel como ZB Block, não há necessidade de
     activar esta opção, porque a maioria dos que phpMussel irá olha por (no
     contexto desta opção) são duplicações de proteções que já estão fornecida.
   "block_control_characters"
   - Bloquear todos os arquivos que contenham quaisquer controle caracteres
     (exceto linha quebras) - [\x00-\x08\x0b\x0c\x0e\x1f\x7f]? Se você está
     -apenas- carregando simple texto, então você pode ativar essa opção para
     fornecer alguma adicional proteção para o seu sistema. Mas, se você
     carregar qualquer coisa que não seja de texto simples, ativando isso pode
     resultas em falso positivos. 0 - Não bloquear [Padrão], 1 - Bloquear.
   "corrupted_exe"
   - Corrompidos arquivos e erros de análise.
     0 = Ignorar, 1 = Bloquear [Padrão]. Detectar e bloquear potencialmente
     corrompidos PE (Portátil Executável) arquivos? Often (but not always),
     quando certos aspectos de um PE arquivo é corrompido ou não pode ser
     analisado corretamente, essa pode ser indicativo de uma viral infecção. Os
     processos utilizados pela maioria dos anti-vírus programas para detectar
     vírus em PE arquivos requerem analisando os arquivos de certas maneiras,
     que, se o programador de um vírus é consciente de, especificamente irá
     tentar impedir, a fim de permitir seu vírus para permanecer não detectado.
   "decode_threshold"
   - Opcional limitação para o comprimento dos brutos dados para que dentro de
     decodificar comandos devem ser detectados (em caso de existirem quaisquer
     notável problemas de desempenho enquanto analisando). Valor é um inteiro
     que representa tamanho do arquivo Em KB. Padrão = 512 (512KB). Zero ou
     nulo valor desativa o limitação (removendo qualquer limitação baseado em
     tamanho do arquivo).
   "scannable_threshold"
   - Opcional limitação para o comprimento dos brutos dados para que phpMussel
     é permitido a ler e analisar (em caso de existirem quaisquer notável
     problemas de desempenho enquanto analisando). Valor é um inteiro que
     representa tamanho do arquivo Em KB. Padrão = 32768 (32MB). Zero ou nulo
     valor desativa o limitação. Em geral, esse valor não deve ser menor que o
     médio arquivo tamanho de carregamentos que você quer e espera para receber
     no seu servidor ou website, não deve ser mais que o filesize_limit
     directivo, e não deve ser menor que aproximadamente um quinto do total
     permissível memória alocação concedido para php através do php.ini
     configuração arquivo. Esta directiva existe para tentar impedir phpMussel
     de usando demais memória (que seria impedir-lo de ser capaz de analisando
     arquivos acima de um certo tamanho com sucesso).
 "compatibility" (Categoria)
 - Compatibilidade directivas por phpMussel.
   "ignore_upload_errors"
   - Essa directiva deve ser geralmente desativada a menos que seja necessário
     por correta funcionalidade de phpMussel no seu específico sistema.
     Normalmente, quando desativado, quando phpMussel detecta a presença de
     elementos dentro a $_FILES array(), ele tentará iniciar uma análise dos
     arquivos que esses elementos representam, e, se esses elementos estão
     branco ou vazia, phpMussel irá retornar uma erro mensagem. Esse é um
     apropriado comportamento por phpMussel. Mas, por alguns CMS, vazios
     elementos podem ocorrer como resultado do natural comportamento dessas
     CMS, ou erros podem ser reportado quando não houver alguma, nesse caso, o
     normal comportamento por phpMussel será interferindo com o normal
     comportamento dessas CMS. Se tal situação ocorre por você, ativando esta
     opção irá instruir phpMussel para não tentar iniciar um análise por tais
     vazios elementos, ignorá-los quando encontrado e para não retornar
     qualquer relacionado erro mensagens, assim, permitindo a continuação da
     página carga. 0 - DESATIVADO, 1 - ATIVADO.
   "only_allow_images"
   - Se você apenas esperar ou apenas tencionar de permitir imagens a ser
     enviado para seu sistema ou CMS, e se você absolutamente não necessita
     quaisquer arquivos exceto imagens a ser enviado para seu sistema ou CMS,
     esta directiva devia ser ATIVADO, mas em outros casos devia ser
     DESATIVADO. Se esta diretiva é ATIVADO, ele irá instruir phpMussel
     indiscriminadamente bloquear qualquer arquivo carregamento identificado
     como não imagem, sem os analisar. Isto pode reduzir o tempo de
     processamento e uso de memória por tentados carregamentos de não imagem
     arquivos. 0 - DESATIVADO, 1 - ATIVADO.

                                     ~ ~ ~


 7. ASSINATURA FORMATO

 = ARQUIVO NOME ASSINATURAS =
   Todas as arquivo nome assinaturas seguir o formato:
    NAME:FNRX
   Onde NAME é o nome para citar por essa assinatura e FNRX é o regex para
   verificar arquivos nomes (não codificados) contra.

 = MD5 ASSINATURAS =
   Todas as MD5 assinaturas seguir o formato:
    HASH:FILESIZE:NAME
   Onde HASH é o MD5 hash de um inteiro arquivo, FILESIZE é o total tamanho do
   arquivo e NAME é o nome para citar por essa assinatura.

 = COMPACTADOS ARQUIVOS METADADOS ASSINATURAS =
   Todas as compactados arquivos metadados assinaturas seguir o formato:
    NAME:FILESIZE:CRC32
   Onde NAME é o nome para citar por essa assinatura, FILESIZE é o total
   tamanho (descompactado) de um arquivo contido dentro do compactado arquivo e
   CRC32 é o CRC32 checksum do contido arquivo.

 = PE SECCIONAL MD5 ASSINATURAS =
   Todas as PE Seccional MD5 assinaturas seguir o formato:
    FILESIZE:HASH:NAME
   Onde HASH é o MD5 hash de uma secção do PE arquivo, FILESIZE é o total
   tamanho do arquivo e NAME é o nome para citar por essa assinatura.

 = WHITELIST ASSINATURAS =
   Todas as Whitelist assinaturas seguir o formato:
    HASH:FILESIZE:TYPE
   Onde HASH é o MD5 hash de um inteiro arquivo, FILESIZE é o total tamanho do
   arquivo e NAME é o nome para citar por essa assinatura.
   Where HASH is the MD5 hash of an entire file, FILESIZE is the total size
   of that file and TYPE é o tipo de assinaturas do whitelist arquivo é ser
   imune contra.

 = COMPLEXOS ESTENDIDOS ASSINATURAS =
   Complexos Estendidos assinaturas são bastante diferente para os outros tipos
   de assinaturas possíveis com phpMussel em que o que eles estão verificando
   contra é especificado pelas assinaturas e eles podem verificar contra vários
   critérios. Os critérios de verificação são delimitados por ";" e o
   verificação tipo e os verificação dados de cada verificação critérios é
   delimitados por ":" como assim que o formato por estas assinaturas tende a
   olhar um pouco assim:
    $variável1:ALGUNSDADOS;$variável2:ALGUNSDADOS;AssinaturaNome

 = TODAS OUTRAS =
   Todas as outras assinaturas seguir o formato:
    NAME:HEX:FROM:TO
   Onde NAME é o nome para citar por essa assinatura e HEX é um hexadecimal
   codificado segmento do arquivo intentado a ser correspondido pela dado
   assinatura. TO e FROM são opcionais parâmetros, indicando de onde e para
   quais posições nos origem dados para verificar contra (não suportado pela
   mail função).

 = REGEX =
   Qualquer forma de regex compreendido e processado corretamente pelo php
   também deve ser correctamente compreendido e processado por phpMussel e suas
   assinaturas. Mas, eu sugiro tomar extremo cuidado quando escrevendo novas
   assinaturas baseadas regex, porque, se você não está inteiramente certo do
   que está fazendo, isto pode tem altamente irregulares e inesperadas
   resultados. Olha para o código-fonte de phpMussel Se você não está
   totalmente certo sobre o contexto em que as regex declarações são
   processada. Além, lembre-se que todos isso (com exceção para arquivo nome,
   compactado arquivo metadados, MD5 a sintaxe) deve ser codificado
   hexadecimalmente!

 = ONDE COLOCAR PERSONALIZADAS ASSINATURAS? =
   Colocar personalizadas assinaturas nos arquivos destinado por personalizadas
   assinaturas só. Esses arquivos devem conter "_custom" no seus nomes. Você
   também deve evitar editando padrão assinatura arquivos, a menos que você
   sabe exatamente o que você está fazendo, por razão que, além de sendo boa
   prática em geral e além de ajudá-lo distinguir entre suas próprias
   assinaturas e as padrãos assinaturas incluídos com phpMussel, é bom para
   manter para editando apenas os arquivos destinados por editando, por razão
   de que mexendo com os padrão assinatura arquivos pode causá-los a cessar
   funcionando corretamente, devido aos "mapas" arquivos: Os mapas arquivos
   instruir phpMussel onde nos assinatura arquivos para olhar por assinaturas
   necessário por phpMussel tal quando necessário, e esses mapas podem
   tornar-se fora de sincronia com seus associadas assinatura arquivos se esses
   assinatura arquivos são adulterado com. Você pode essencialmente colocar
   qualquer você quiser no seus personalizadas assinaturas, desde que você siga
   a correta sintaxe. Mas, cuidado para testar novas assinaturas por
   falso-positivos de antemão se você tencionar de compartilhá-los ou usá-los
   em um ambiente vivo.

 = ASSINATURA COMPOSIÇÃO =
   A seguir estão os diferentes tipos de assinaturas utilizadas por phpMussel:
   - "Normalizadas ASCII Assinaturas" (ascii_*). Verificado contra o conteúdo
      de cada arquivo não no whitelist e alvo por analisando.
   - "Estendidos Complexos Assinaturas" (coex_*). misto tipo de assinatura
      verificando.
   - "ELF Assinaturas" (elf_*). Verificado contra o conteúdo de cada arquivo
      não no whitelist e alvo por analisando e confirmados tal do formato ELF.
   - "Portátil Executável Assinaturas" (exe_*). Verificado contra o conteúdo de
      cada arquivo não no whitelist e alvo por analisando e confirmados tal do
      formato PE.
   - "Arquivo Nome Assinaturas" (filenames_*). Verificado contra os nomes de
      cada arquivo não no whitelist e alvo por analisando.
   - "Gerais Assinaturas" (general_*). Verificado contra o conteúdo de arquivo
      não no whitelist e alvo por analisando.
   - "Gráficas Assinaturas" (graphics_*). Verificado contra o conteúdo de cada
      arquivo não no whitelist e alvo por analisando e confirmado tal de um
      conhecidos gráficos arquivos formato.
   - "Gerais Comandos" (hex_general_commands.csv). Verificado contra o conteúdo
      de cada arquivo não no whitelist e alvo por analisando.
   - "Normalizadas HTML Assinaturas" (html_*). Verificado contra o conteúdo de
      cada arquivo não no whitelist e alvo por analisando.
   - "Mach-O Assinaturas" (macho_*). Verificado contra o conteúdo de cada
      arquivo não no whitelist e alvo por analisando e confirmados tal do
      formato Mach-O.
   - "E-mail Assinaturas" (mail_*). Verificado contra o $body variável
      alimentado para o phpMussel_mail() função, que se intencionado para ser o
      corpo das e-mail mensagens ou similares entidades (potencialmente fórum
      mensagens e etcetera).
   - "MD5 Assinaturas" (md5_*). Verificado contra o MD5 hash do conteúdo e
      contra o arquivo tamanho de cada arquivo não no whitelist e alvo por
      analisando.
   - "Compactado Arquivo Metadado Assinaturas" (metadata_*). Verificado contra
      o CRC32 hash eo arquivo tamanho do inicial arquivo contida dentro de cada
      compactado arquivo não no whitelist e alvo por analisando.
   - "OLE Assinaturas" (ole_*). Verificado contra o conteúdo de cada objeto não
      no whitelist e alvo por analisando.
   - "PDF Assinaturas" (pdf_*). Verificado contra o conteúdo de cada PDF
      arquivo não no whitelist.
   - "Portátil Executável Seccional Assinaturas" (pe_*). Verificado contra o
      tamanho eo MD5 hash de cada PE seção de cada arquivo não em o whitelist e
      alvo por analisando e confirmados tal do formato PE.
   - "SWF Assinaturas" (swf_*). Verificado contra o conteúdo de cada Shockwave
      arquivo não no whitelist.
   - "Whitelist Assinaturas" (whitelist_*). Verificado contra o MD5 hash do
      conteúdo e contra o arquivo tamanho de cada arquivo alvo por analisando.
      Verificados arquivos será imune de sendo verificado pelo tipo de
      assinatura mencionada no seu whitelist entrada.
   - "XML/XDP-Pedaço Assinaturas" (xmlxdp_*). Verificado contra quaisquer
      XML/XDP pedaços encontrados dentro cada arquivo não no whitelist e alvo
      por analisando.
     (Notar que qualquer uma destas assinaturas podem ser facilmente desativada
      através de phpmussel.ini).

                                     ~ ~ ~


 8. CONHECIDOS COMPATIBILIDADE PROBLEMAS

 PHP e PCRE
 - phpMussel requer PHP e PCRE para executar e funcionar corretamente. Sem PHP,
   ou sem a PCRE extensão do PHP, phpMussel não vai executará ou funcionar
   corretamente. Deve certificar-se de que seu sistema tenha PHP e PCRE
   instalado e disponível antes de baixar e instalar phpMussel.

 ANTI-VÍRUS SOFTWARE COMPATIBILIDADE

 Em geral, phpMussel deve ser bastante compatível com a maioria dos outros
 vírus detecção softwares. Embora, conflitos foram relatadas por um número de
 utilizadores no passado. Esta informação abaixo é de VirusTotal.com, e
 descreve um número de falso-positivos relatados por vários anti-vírus
 programas contra phpMussel. Embora esta informação não é um absoluta garantia
 de haver ou não você vai encontrar problemas de compatibilidade entre
 phpMussel e seu anti-vírus software, se o seu anti-vírus software é conhecido
 como sinalização contra phpMussel, você deve considerar desativá-lo antes de
 trabalhar com phpMussel ou deve considerar alternativas opções para o seu
 anti-vírus software ou phpMussel.

 Esta informação foi atualizada dia 4 Fevereiro 2015 e é corrente para todas
 phpMussel lançamentos das duas mais recentes menores versões (v0.5-v0.6) no
 momento de escrever este.

 Ad-Aware                Sem conhecidos problemas
 Agnitum                 Sem conhecidos problemas
 AhnLab-V3               Sem conhecidos problemas
 AntiVir                 Sem conhecidos problemas
 Antiy-AVL               Sem conhecidos problemas
 Avast                !  Reportar "JS:ScriptSH-inf [Trj]"
 AVG                     Sem conhecidos problemas
 Baidu-International     Sem conhecidos problemas
 BitDefender             Sem conhecidos problemas
 Bkav                    Sem conhecidos problemas
 ByteHero                Sem conhecidos problemas
 CAT-QuickHeal           Sem conhecidos problemas
 ClamAV                  Sem conhecidos problemas
 CMC                     Sem conhecidos problemas
 Commtouch               Sem conhecidos problemas
 Comodo                  Sem conhecidos problemas
 DrWeb                   Sem conhecidos problemas
 Emsisoft                Sem conhecidos problemas
 ESET-NOD32              Sem conhecidos problemas
 F-Prot                  Sem conhecidos problemas
 F-Secure                Sem conhecidos problemas
 Fortinet                Sem conhecidos problemas
 GData                   Sem conhecidos problemas
 Ikarus                  Sem conhecidos problemas
 Jiangmin                Sem conhecidos problemas
 K7AntiVirus             Sem conhecidos problemas
 K7GW                    Sem conhecidos problemas
 Kaspersky               Sem conhecidos problemas
 Kingsoft                Sem conhecidos problemas
 Malwarebytes            Sem conhecidos problemas
 McAfee               !  Reportar "New Script.c"
 McAfee-GW-Edition    !  Reportar "New Script.c"
 Microsoft               Sem conhecidos problemas
 MicroWorld-eScan        Sem conhecidos problemas
 NANO-Antivirus          Sem conhecidos problemas
 Norman               !  Reportar "Kryptik.BQS"
 nProtect                Sem conhecidos problemas
 Panda                   Sem conhecidos problemas
 Qihoo-360               Sem conhecidos problemas
 Rising                  Sem conhecidos problemas
 Sophos                  Sem conhecidos problemas
 SUPERAntiSpyware        Sem conhecidos problemas
 Symantec             !  Reportar "WS.Reputation.1"
 TheHacker               Sem conhecidos problemas
 TotalDefense            Sem conhecidos problemas
 TrendMicro              Sem conhecidos problemas
 TrendMicro-HouseCall    Sem conhecidos problemas
 VBA32                   Sem conhecidos problemas
 VIPRE                   Sem conhecidos problemas
 ViRobot                 Sem conhecidos problemas


                                     ~ ~ ~


Última Atualização: 3 Março 2015 (2015.03.03).
EOF