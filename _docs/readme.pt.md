## Documentação para phpMussel (Português).

### Conteúdo
- 1. [PREÂMBULO](#SECTION1)
- 2A. [COMO INSTALAR (PARA WEB SERVIDORES)](#SECTION2A)
- 2B. [COMO INSTALAR (PARA CLI)](#SECTION2B)
- 3A. [COMO USAR (PARA WEB SERVIDORES)](#SECTION3A)
- 3B. [COMO USAR (PARA CLI)](#SECTION3B)
- 4A. [NAVEGADOR COMANDOS](#SECTION4A)
- 4B. [CLI (COMANDO LINHA INTERFACE)](#SECTION4B)
- 5. [ARQUIVOS INCLUÍDOS NESTE PACOTE](#SECTION5)
- 6. [CONFIGURAÇÃO OPÇÕES](#SECTION6)
- 7. [ASSINATURA FORMATO](#SECTION7)
- 8. [CONHECIDOS COMPATIBILIDADE PROBLEMAS](#SECTION8)

---


###1. <a name="SECTION1"></a>PREÂMBULO

Obrigado por usando phpMussel, um PHP script projetado para detectar trojans, vírus, malware e outras ameaças dentro dos arquivos enviados para o seu sistema onde quer que o script é enganchado, baseado no assinaturas do ClamAV e outros.

PHPMUSSEL COPYRIGHT 2013 e além GNU/GPLv2 através do Caleb M (Maikuolan).

Este script é livre software; você pode redistribuí-lo e/ou modificá-lo de acordo com os termos da GNU General Public License como publicada pela Free Software Foundation; tanto a versão 2 da Licença, ou (em sua opção) qualquer versão posterior. Este script é distribuído na esperança que possa ser útil, mas SEM QUALQUER GARANTIA; sem mesmo a implícita garantia de COMERCIALIZAÇÃO ou ADEQUAÇÃO A UM DETERMINADO FIM. Consulte a GNU General Public License para obter mais detalhes, localizado no `LICENSE.txt` arquivo e disponível também desde:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Um especial obrigado para [ClamAV](http://www.clamav.net/) por o projeto inspiração e para as assinaturas que este script utiliza, sem que, o script provavelmente não existiria, ou no melhor, teria ser de muito limitado valor.

Um especial obrigado para Sourceforge e GitHub por hospedar os projeto arquivos, para [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) por hospedar os phpMussel discussão fóruns, e para adicionais recursos de um número de o assinaturas utilizados através do phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) e outros, e um especial obrigado a todos aqueles que apoiam o projeto, a qualquer outra pessoa que eu possa ter esquecido de mencionar, e para você, por usando o script.

Este documento e seu associado pacote pode ser baixado gratuitamente desde:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>COMO INSTALAR (PARA WEB SERVIDORES)

Espero para agilizar este processo via fazendo um instalado em algum momento no não muito distante futuro, mas até então, siga estas instruções para trabalhar phpMussel na maioria dos sistemas e CMS:

1) Por o seu lendo isso, eu estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo sentado em algum lugar em sua máquina local. A partir daqui, você vai querer determinar onde no seu host ou CMS pretende colocar esses conteúdos. Um diretório como `/public_html/phpmussel/` ou semelhante (porém, está não importa qual você escolher, assumindo que é seguro e algo você esteja feliz com) vai bastará.

2) Opcionalmente (fortemente recomendado para avançados usuários, mas não recomendado para iniciantes ou para os inexperientes), abrir `phpmussel.ini` (localizado dentro `vault`) - Este arquivo contém todas as directivas disponíveis para phpMussel. Acima de cada opção deve ser um breve comentário descrevendo o que faz e para que serve. Ajuste essas opções de como você vê o ajuste, conforme o que for apropriado para sua particular configuração. Salve o arquivo, fechar.

3) Carregar os conteúdos (phpMussel e seus arquivos) para o diretório que você tinha decidido anteriormente (você não requerer os `*.txt`/`*.md` arquivos incluídos, mas principalmente, você deve carregar tudo).

4) CHMOD o `vault` diretório para "777". O principal diretório armazenar o conteúdo (o que você escolheu anteriormente), geralmente, pode ser deixado sozinho, mas o CHMOD status deve ser verificado se você já teve problemas de permissões no passado no seu sistema (por padrão, deve ser algo como "755").

5) Seguida, você vai precisar "enganchar" phpMussel ao seu sistema ou CMS. Existem várias diferentes maneiras em que você pode "enganchar" scripts como phpMussel ao seu sistema ou CMS, mas o mais fácil é simplesmente incluir o script no início de um núcleo arquivo de seu sistema ou CMS (uma que vai geralmente sempre ser carregado quando alguém acessa qualquer página através de seu site) utilizando um `require` ou `include` comando. Normalmente, isso vai ser algo armazenado em um diretório como `/includes`, `/assets` ou `/functions`, e muitas vezes, ser nomeado algo como `init.php`, `common_functions.php`, `functions.php` ou semelhante. Você precisará determinar qual arquivo isso é para a sua situação; Se você encontrar dificuldades em determinar isso por si mesmo, visite os phpMussel suporte fóruns e deixe-nos saber; É possível que eu ou outro usuário podem ter experiência com o CMS que você está usando (você precisa deixar-nos saber qual CMS você está usando), e assim, pode ser capaz de prestar alguma assistência neste domínio. Para fazer isso [usar `require` ou `include`], insira a seguinte linha de código para o início desse núcleo arquivo, substituindo a string contida dentro das aspas com o exato endereço do `phpmussel.php` arquivo (endereço local, não o endereço HTTP; será semelhante ao vault endereço mencionado anteriormente).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Salve o arquivo, fechar, recarregar-lo.

-- OU ALTERNATIVAMENTE --

Se você é usando um Apache web servidor e se você tem acesso a `php.ini`, você pode usar o `auto_prepend_file` directiva para pré-carga phpMussel sempre que qualquer pedido de PHP é feito. Algo como:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

Ou isso no `.htaccess` arquivo:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar as arquivo carregamento proteção, tentar carregar dos testes arquivos incluídos no pacote em `_testfiles` para seu site através de seus habitual navegador carregamentos métodos. Se tudo estiver funcionando, a mensagem deve aparecer a partir phpMussel confirmando que o carregamento foi bloqueado com sucesso. Se nada aparecer, algo está não funcionando corretamente. Se você estiver usando quaisquer avançados recursos ou se você estiver usando outros tipos de análisar possível com a ferramenta, eu sugiro tentar isso com aqueles para certificar que ele funciona como esperado, também.

---


###2B. <a name="SECTION2B"></a>COMO INSTALAR (PARA CLI)

Espero para agilizar este processo via fazendo um instalado em algum momento no não muito distante futuro, mas até então, siga estas instruções para obter phpMussel pronto para trabalhar com CLI (estar ciente, neste momento, CLI apoio só se aplica a sistemas baseados no Windows; Linux e outros sistemas será em breve para uma posterior versão do phpMussel):

1) Por o seu lendo isso, eu estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo sentado em algum lugar em sua máquina local. Quando você tiver determinado que você está feliz com o localização escolhido para phpMussel, continuar.

2) phpMussel requer PHP para ser instalado na host máquina a fim de executar. Se você não ainda tno PHP instalado em sua máquina, por favor instalar o PHP em sua máquina, seguindo as instruções fornecidas pelo PHP instalador.

3) Opcionalmente (fortemente recomendado para avançados usuários, mas não recomendado para iniciantes ou para os inexperientes), abrir `phpmussel.ini` (localizado dentro `vault`) - Este arquivo contém todas as directivas disponíveis para phpMussel. Acima de cada opção deve ser um breve comentário descrevendo o que faz e para que serve. Ajuste essas opções de como você vê o ajuste, conforme o que for apropriado para sua particular configuração. Salve o arquivo, fechar.

4) Opcionalmente, você pode fazer usando phpMussel no modo CLI mais fácil para si mesmo através da criação de um batch arquivo para carregar automaticamente PHP e phpMussel. Para fazer isso, abra um editor de simples texto como Notepad ou Notepad++, digite o completo caminho para o `php.exe` arquivo no PHP instalação diretório, seguido por um espaço, seguido pelo completo caminho para o `phpmussel.php` arquivo no diretório da sua phpMussel instalação, salvar o arquivo com a extensão ".bat" Em algum lugar que você vai encontrá-lo facilmente, e clique duas vezes nesse arquivo para executar phpMussel no futuro.

5) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar phpMussel, executar phpMussel e tentar análizar o diretório `_testfiles` fornecida com o pacote.

---


###3A. <a name="SECTION3A"></a>COMO USAR (PARA WEB SERVIDORES)

phpMussel é um script destinado a funcionar de adequadamente, sem complicações, com um mínimo nível de requisitos por você: Após ter sido instalado, basicamente, ele simplesmente deve funcionar.

Análise dos arquivos carregamentos é automatizado e ativado por padrão, por isso nada é exigido por você por essa particular função.

Porém, você também é capaz de instruir phpMussel para verificar arquivos e/ou diretórios específicos. Para fazer isso, em primeiro lugar, você vai precisar para assegurar que configuração apropriada é definida no `phpmussel.ini` arquivo (`cleanup` deve ser desativado), e quando feito, em um PHP arquivo que está enganchado ao phpMussel, usar a seguinte função no seu código:

`phpMussel($what_to_scan,$output_type,$output_flatness);`

- `$what_to_scan` pode ser uma string, um matriz, ou um matriz de matrizes, e indica qual arquivo, arquivos, diretório e/ou diretórios para analisar.
- `$output_type` é um booleano, indicando o formato para os resultados da verificação a serem retornados como. False/Falso instrui a função para retornar resultados como um número inteiro (um resultado retornado de -3 indica problemas foram encontrados com o phpMussel assinaturas arquivos ou mapas assinaturas arquivos e que eles podem possível estar ausente ou corrompido, -2 indica que corrompido dados foi detectado durante a análise, e portanto, a análise não foi concluída, -1 indica que extensões ou complementos necessários pelo PHP para executar a análise estavam faltando, e portanto, a análise não foi concluída, 0 indica que o alvo de análise não existe, e portanto, havia nada para verificar, 1 indica que o alvo foi analisado e não problemas foram detectados, e 2 indica que o alvo foi analisado e problemas foram detectados). True/Verdadeiro instrui a função para retornar os resultados como texto legível. Adicionalmente, em ambos os casos, os resultados podem ser acessados através de variáveis globais após o análise já concluída. Esta variável é opcional, definida como false/falso por padrão.
- `$output_flatness` é um booleano, indicando para o função seja para retornar os resultados de análise (quando há vários alvos para analisando) como uma matriz ou uma string. False/Falso irá retornar os resultados como uma matriz. True/Verdadeiro irá retornar os resultados como uma string. Esta variável é opcional, definida como false/falso por padrão.

Exemplos:

```
 $results=phpMussel('/user_name/public_html/my_file.html',true,true);
 echo $results;
```

Retorna algo tal como esta (como uma string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Começado.
 > Verificação '/user_name/public_html/my_file.html':
 -> Não problemas encontrados.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminado.
```

Por completos detalhes sobre que tipo de assinaturas phpMussel usa durante a análise e como ele usa essas assinaturas, consulte a Assinatura Formato seção deste arquivo README.

Se você encontrar quaisquer falsos positivos, se você encontrar algo novo que você acha deve ser bloqueado, ou para qualquer outra coisa com relação a assinatura, entre em contato comigo sobre isso para que eu possa fazer as mudanças necessárias, que, se você não entrar em contato comigo, eu posso não ser necessariamente conscientes de.

Para desativar as assinaturas que estão incluídos com phpMussel (tal como se você está experimentando falsos positivos específico para seus fins que não deve normalmente ser removidos da agilize), consulte as notas sobre Greylisting dentro do Navegador Comandos seção deste README arquivo.

Além da padrão arquivo carregamento análise e a opcional análise de outros arquivos e/ou diretórios especificado através da função acima, incluído no phpMussel é uma função destinada à análise do corpo das e-mail mensagens. Esta função funciona da mesma forma para a phpMussel() função, mas se concentra exclusivamente em fazer a comparação com as assinaturas de ClamAV baseiam e-mail. Eu tenho amarrei essas assinaturas para a padrão phpMussel() função, porque é muito pouco provável que você jamais encontrar o corpo de uma recebidos e-mail mensagem na necessidade de análise dentro um arquivo carregamento direcionado para uma página onde phpMussel é enganchada, e assim, para amarrar essas assinaturas para a phpMussel() função seria redundante. Mas, o que disse, tendo uma separada função para comparar contra essas assinaturas poderia revelar-se extremamente útil para alguns, especialmente para aqueles cuja CMS ou webfront sistema está de alguma modo enganchado em seu e-mail sistema e para aqueles de quem verificar seus e-mails através de um PHP script de que eles poderiam engancho para phpMussel. Configuração para esta função, como todos os outros, é controlado através do `phpmussel.ini` arquivo. Para utilizar esta função (você vai precisar para fazer a sua própria implementação) em um PHP arquivo que está enganchado ao phpMussel, usar a seguinte função no seu código:

`phpMussel_mail($body);`

Onde $body é o corpo da email mensagem que você deseja verificar (Além, você pode tentar verificar novos fórum posts, mensagens do seu on-line contato form ou similar). Se algum erro ocorrer impedindo a função de completar a sua análise, um valor de -1 será retornado. Se a função faz completa a sua análise e detecta nada, um valor de 0 será retornado (ou seja, limpo). Se, contudo, a função faz detectar algo, uma string será retornado contendo uma mensagem declarando o que foi detectado.

Além do acima, se você olhar para o código-fonte, você pode notar a função phpMusselD() e phpMusselR(). Estas funções são sub-funções de phpMussel(), e não deve ser chamado diretamente fora dessa pai função (não por causa de adversos efeitos.. Mais-lo, simplesmente porque ele tinha nenhuma utilidade, e provavelmente não irá realmente funcionar corretamente qualquer maneira).

Existem muitos outros controlos e funções disponíveis dentro phpMussel para seu uso, também. Para qualquer esses controlos e funções que, até o final desta seção do README, ainda não foram documentados, por favor, continue a leitura e consulte o Navegador Comandos seção deste README arquivo.

---


###3B. <a name="SECTION3B"></a>COMO USAR (PARA CLI)

Por favor, consulte ao "COMO INSTALAR (PARA CLI)" seção deste README arquivo.

Esteja ciente de que, embora versões futuras do phpMussel deve apoiar sistemas outros, neste momento, phpMussel CLI modo suporte só é otimizado para uso em sistemas baseados no Windows (você pode, é claro, experimentá-lo em outros sistemas, mas eu não posso garantir que vai funcionar como pretendido).

Também estar ciente de que phpMussel não é o funcional equivalente de um completa antivírus suíte, e contrário de antivírus suítes convencionais, não monitora ativa memória ou detectar vírus proativamente! Ele só irá detectar vírus contidos por esses arquivos específicos que você explicitamente diga a ele analisar.

---


###4A. <a name="SECTION4A"></a>NAVEGADOR COMANDOS

Quando phpMussel é instalado e funcionando corretamente no seu sistema, se você tem configurá as variáveis `script_password` e `logs_password` no seu configuração arquivo, você será capaz de executar um limitado número de administrativas funções e entrada um algum número de comandos para phpMussel através de seu navegador. A razão pela qual essas senhas precisam ser definidas a fim de permitir que esses controles do navegador é tanto para garantir adequada segurança, adequada proteção desses navegador controles e para garantir que existe uma maneira por desses navegador controles para ser totalmente desativado se eles não são desejadas por você e/ou outros webmestres/administradores usando phpMussel. Portanto, em outras palavras, para ativar esses controles, definir uma senha, e para desativar esses controles, definir nenhum senha. Alternativamente, se você optar por ativar esses controles então optar por desativar esses controles em um posterior data, existe um comando para fazer isto (tal pode ser útil se você executar algumas ações que você sente poderia comprometer as senhas delegados e precisa para desativar rapidamente esses controles sem modificar o configuração arquivo).

Algumas razões pelas quais você _**DEVE**_ ativar esses controles:
- Fornece uma maneira para greylist assinaturas em casos como quando você descobre uma assinatura que está produzindo um falso-positivo durante o carregar de arquivos para o seu sistema e você não tem tempo para manualmente editar e recarregar o greylist arquivo.
- Fornece uma maneira por você para permitir alguém diferente de si mesmo para controlar a sua cópia do phpMussel sem a implícita necessidade a dar o acesso ao FTP.
- Fornece uma maneira de fornecer controlado acesso aos seus log arquivos.
- Fornece um fácil maneira para atualizar phpMussel quando atualizações são disponíveis.
- Fornece uma maneira por você para monitorar phpMussel quando FTP acesso ou outras convencionais vias de acesso para monitoramento phpMussel não estão disponíveis.

Algumas razões pelas quais você _**NÃO**_ deve ativar esses controles:
- Fornece um vetor por potenciais atacantes e indesejáveis para determinar se ou não você está usando phpMussel (embora, este poderia ser tanto uma razão por e uma razão contra, dependendo em perspectiva) por cegamente envio de comandos para os servidores como meio para sondar. Por um lado, isso pode desencorajar os atacantes de testando seu sistema, se eles descobrem que você está usando phpMussel, assumindo que eles estão sondando por razões que o sua método de ataque é desprovido de efeito como resultado do seu uso de phpMussel. Mas, por outro lado, se algum imprevisto e presentemente desconhecidos vulnerabilidade dentro phpMussel ou um futuro versão dos mesmos trata de luz, e se ele poderia fornecer um vetor de ataque, um positivo resultado de tal sondando poderia incentivar os atacantes de testando seu sistema.
- Se suas senhas delegados foram comprometidos, se não alterado, pode fornecer uma maneira para um atacante para ignorar o que quer assinaturas podem ser de outra forma normalmente prevenção sucesso de seus ataques, ou até mesmo potencialmente desativar phpMussel completamente, proporcionando uma forma de tornar a eficácia da phpMussel discutível.

De qualquer maneira, independentemente do que você escolher, a escolha final é sua. Por padrão, esses controles serão desativados, mas ter um pensar sobre isso, e se você decidir que você quer eles, Nesta seção explica tanto como ativá-los e como usá-los.

A lista de disponíveis browser comandos:

scan_log
- Senha necessária: `logs_password`
- Outros requisitos: scan_log deve ser definido.
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?logspword=[logs_password]&phpmussel=scan_kills`
- Que faz: Imprime o conteúdo de seu scan_log arquivo para a tela.

scan_kills
- Senha necessária: `logs_password`
- Outros requisitos: scan_kills deve ser definido.
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?logspword=[logs_password]&phpmussel=scan_kills`
- Que faz: Imprime o conteúdo de seu scan_kills arquivo para a tela.

controls_lockout
- Senha necessária: `logs_password` OU `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Exemplo 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Que faz: Desativa todos os navegador controles. Isso deve ser usado se você suspeitar que qualquer das senhas foram comprometidas (isso pode acontecer se você estiver usando esses controles a através de um computador que não é seguro ou não é confiável). controls_lockout funciona através de criando um arquivo, `controls.lck`, no seu vault, de que phpMussel irá olhar por antes de executar qualquer comando de qualquer variedade. Quando isso acontece, para reativar os controlos, você precisará manualmente deletar o `controls.lck` arquivo através de FTP ou semelhante. Pode ser chamado usando qualquer senha.

disable
- Senha necessária: `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=disable`
- Que faz: Desativar phpMussel. Isso deve ser usado se você estiver executando quaisquer atualizações ou alterações no seu sistema ou se está instalando qualquer novo software ou módulos para seu sistema que fazer ou potencialmente poderiam desencadear falsos positivos. Isso também deve ser usado se você está tendo problemas com phpMussel mas não deseja removê-lo do sistema. Quando isso acontece, para reativar phpMussel, uso "enable".

enable
- Senha necessária: `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=enable`
- Que faz: Ativar phpMussel. Este deve ser usado se você já desativado phpMussel usando "disable" e desejar para reativá-la.

update
- Senha necessária: `script_password`
- Outros requisitos: `update.dat` e `update.inc` devem existir.
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=update`
- Que faz: Verifica se há atualizações para ambos phpMussel e suas assinaturas. Se as atualização verificações suceder e atualizações são encontrados, tentará baixar e instalar essas atualizações. Se atualização verificação falha, atualização irá abortar. Os resultados de o inteiro processo são impressos na tela. Eu recomendo verificando pelo menos uma vez por mês para garantir que seus assinaturas e sua cópia do phpMussel são mantidos atualizados (a menos, claro, você está verificando se há atualizações e instalá-los manualmente, que, eu ainda recomendo fazer pelo menos uma vez por mês). Verificando mais que duas vezes por mês é provavelmente inútil, considerando que eu estou muito improvável que seja capaz de produzir atualizações de qualquer variedade com mais freqüência do que (nem eu particularmente quero para a maior parte).

greylist
- Senha necessária: `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: [Nome de assinatura a ser greylisted]
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=greylist&musselvar=[Assinatura]`
- Que faz: Adicionar uma assinatura para o greylist.

greylist_clear
- Senha necessária: `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=greylist_clear`
- Que faz: Limpo inteiro greylist.

greylist_show
- Senha necessária: `script_password`
- Outros requisitos: (nenhum)
- Parâmetros necessários: (nenhum)
- Parâmetros opcionais: (nenhum)
- Exemplo: `?pword=[script_password]&phpmussel=greylist_show`
- Que faz: Imprime o conteúdo da greylist para a tela.

---


###4B. <a name="SECTION4B"></a>CLI (COMANDO LINHA INTERFACE)

phpMussel pode ser executado como um interativo arquivo analisador no CLI modo em sistemas baseados em Windows. Por favor, consulte ao "COMO INSTALAR (PARA CLI)" seção deste README arquivo por mais detalhes.

Por uma lista de comandos disponíveis Em CLI, no CLI prompt, digite 'c', e pressione Enter.

---


###5. <a name="SECTION5"></a>ARQUIVOS INCLUÍDOS NESTE PACOTE

O seguinte está uma lista de todos os arquivos que deveria sido incluídos na arquivada cópia desse script quando você baixado-lo, todos os arquivos que podem ser potencialmente criados como resultado de seu uso deste script, juntamente com uma breve descrição do que todos esses arquivos são por.

Arquivo | Descrição
----|----
/.gitattributes | Um arquivo do GitHub projeto (não é necessário para o correto funcionamento do script).
/composer.json | Composer/Packagist informação (não é necessário para o correto funcionamento do script).
/CONTRIBUTING.md | Informações sobre como contribuir para o projeto.
/LICENSE.txt | Uma cópia da GNU/GPLv2 licença.
/PEOPLE.md | Informações sobre as pessoas envolvidas no projeto.
/phpmussel.php | Carregador (carrega o principal script, atualizador, etc). Isto é o que você deveria ser enganchando em (essencial)!
/README.md | Informações do projeto em sumário.
/web.config | Um ASP.NET configuração arquivo (neste caso, para proteger o `/vault` diretório contra serem acessado por fontes não autorizadas em caso que o script está instalado em um servidor baseado em ASP.NET tecnologias).
/_docs/ | Documentação diretório (contém vários arquivos).
/_docs/change_log.txt | Um registro das mudanças feitas para o script entre o diferentes versões (não é necessário para o correto funcionamento do script).
/_docs/readme.ar.md | Documentação Árabe.
/_docs/readme.de.md | Documentação Alemão.
/_docs/readme.de.txt | Documentação Alemão.
/_docs/readme.en.md | Documentação Inglês.
/_docs/readme.en.txt | Documentação Inglês.
/_docs/readme.es.md | Documentação Espanhol.
/_docs/readme.es.txt | Documentação Espanhol.
/_docs/readme.fr.md | Documentação Francesa.
/_docs/readme.fr.txt | Documentação Francesa.
/_docs/readme.id.md | Documentação Indonésio.
/_docs/readme.id.txt | Documentação Indonésio.
/_docs/readme.it.md | Documentação Italiano.
/_docs/readme.it.txt | Documentação Italiano.
/_docs/readme.nl.md | Documentação Holandês.
/_docs/readme.nl.txt | Documentação Holandês.
/_docs/readme.pt.md | Documentação Português.
/_docs/readme.pt.txt | Documentação Português.
/_docs/readme.ru.md | Documentação Russo.
/_docs/readme.ru.txt | Documentação Russo.
/_docs/readme.vi.md | Documentação Vietnamita.
/_docs/readme.vi.txt | Documentação Vietnamita.
/_docs/readme.zh-TW.md | Documentação Chinês (Tradicional).
/_docs/readme.zh.md | Documentação Chinês (Simplificado).
/_docs/signatures_tally.txt | Contagem registro dos assinaturas incluídos (não é necessário para o correto funcionamento do script).
/_testfiles/ | Teste arquivo diretório (contém vários arquivos). Todos os arquivos contidos são teste arquivos para testar se phpMussel foi instalado corretamente no seu sistema, e você não precisa carregar desse diretório ou qualquer de seus arquivos, exceto ao fazer tais testando.
/_testfiles/ascii_standard_testfile.txt | Teste arquivo para testar phpMussel normalizada ASCII assinaturas.
/_testfiles/coex_testfile.rtf | Teste arquivo para testar phpMussel complexos estendidas assinaturas.
/_testfiles/exe_standard_testfile.exe | Teste arquivo para testar phpMussel PE assinaturas.
/_testfiles/general_standard_testfile.txt | Teste arquivo para testar phpMussel gerais assinaturas.
/_testfiles/graphics_standard_testfile.gif | Teste arquivo para testar phpMussel gráficas assinaturas.
/_testfiles/html_standard_testfile.html | Teste arquivo para testar phpMussel normalizada HTML assinaturas.
/_testfiles/md5_testfile.txt | Teste arquivo para testar phpMussel MD5 assinaturas.
/_testfiles/metadata_testfile.tar | Teste arquivo por testando phpMussel metadados assinaturas e por testando TAR arquivo suport no seu sistema.
/_testfiles/metadata_testfile.txt.gz | Teste arquivo por testando phpMussel metadados assinaturas e por testando GZ arquivo suport no seu sistema.
/_testfiles/metadata_testfile.zip | Teste arquivo por testando phpMussel metadados assinaturas e por testando ZIP arquivo suport no seu sistema.
/_testfiles/ole_testfile.ole | Teste arquivo para testar phpMussel OLE assinaturas.
/_testfiles/pdf_standard_testfile.pdf | Teste arquivo para testar phpMussel PDF assinaturas.
/_testfiles/pe_sectional_testfile.exe | Teste arquivo para testar phpMussel PE Seccional assinaturas.
/_testfiles/swf_standard_testfile.swf | Teste arquivo para testar phpMussel SWF assinaturas.
/_testfiles/xdp_standard_testfile.xdp | Teste arquivo para testar phpMussel XML/XDP assinaturas.
/vault/ | Vault diretório (contém vários arquivos).
/vault/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/cache/ | Cache diretório (para dados temporários).
/vault/cache/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/cli.inc | Módulo de CLI.
/vault/config.inc | Módulo de configuração.
/vault/controls.inc | Módulo de controles.
/vault/functions.inc | Arquivo de funções.
/vault/greylist.csv | CSV de greylisted assinaturas indicando a phpMussel quais assinaturas deve ser ignorado (arquivo automaticamente recriado se deletado).
/vault/lang.inc | Linguagem dados.
/vault/lang/ | Contém linguagem dados.
/vault/lang/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/lang/lang.ar.inc | Linguagem dados Árabe.
/vault/lang/lang.de.inc | Linguagem dados Alemão.
/vault/lang/lang.en.inc | Linguagem dados Inglês.
/vault/lang/lang.es.inc | Linguagem dados Espanhol.
/vault/lang/lang.fr.inc | Linguagem dados Francesa.
/vault/lang/lang.id.inc | Linguagem dados Indonésio.
/vault/lang/lang.it.inc | Linguagem dados Italiano.
/vault/lang/lang.ja.inc | Linguagem dados Japonês.
/vault/lang/lang.nl.inc | Linguagem dados Holandês.
/vault/lang/lang.pt.inc | Linguagem dados Português.
/vault/lang/lang.ru.inc | Linguagem dados Russo.
/vault/lang/lang.vi.inc | Linguagem dados Vietnamita.
/vault/lang/lang.zh-TW.inc | Linguagem dados Chinês (Tradicional).
/vault/lang/lang.zh.inc | Linguagem dados Chinês (Simplificado).
/vault/phpmussel.ini | Configuração arquivo; Contém todas ao configuração opções de phpMussel, dizendo-lhe o que fazer e como operar corretamente (essencial)!
/vault/quarantine/ | Diretório de quarentena (contém os arquivos em quarentena).
/vault/quarantine/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
※ /vault/scan_kills.txt | Um registro de tudos os arquivos carregamentos bloqueado ou matado por phpMussel.
※ /vault/scan_log.txt | Um registro de tudo analisado por phpMussel.
※ /vault/scan_log_serialized.txt | Um registro de tudo analisado por phpMussel.
/vault/signatures/ | Diretório de assinaturas (contém ficheiros de assinaturas).
/vault/signatures/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/signatures/ascii_clamav_regex.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_clamav_regex.map | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_clamav_standard.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_clamav_standard.map | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_custom_regex.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_custom_standard.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_mussel_regex.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/ascii_mussel_standard.cvd | Arquivo por normalizada ASCII assinaturas.
/vault/signatures/coex_clamav.cvd | Arquivo por o complexos estendidas assinaturas.
/vault/signatures/coex_custom.cvd | Arquivo por o complexos estendidas assinaturas.
/vault/signatures/coex_mussel.cvd | Arquivo por o complexos estendidas assinaturas.
/vault/signatures/elf_clamav_regex.cvd | Arquivo por ELF assinaturas.
/vault/signatures/elf_clamav_regex.map | Arquivo por ELF assinaturas.
/vault/signatures/elf_clamav_standard.cvd | Arquivo por ELF assinaturas.
/vault/signatures/elf_clamav_standard.map | Arquivo por ELF assinaturas.
/vault/signatures/elf_custom_regex.cvd | Arquivo por ELF assinaturas.
/vault/signatures/elf_custom_standard.cvd | Arquivo por ELF assinaturas.
/vault/signatures/elf_mussel_regex.cvd | Arquivo por ELF assinaturas.
/vault/signatures/elf_mussel_standard.cvd | Arquivo por ELF assinaturas.
/vault/signatures/exe_clamav_regex.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_clamav_regex.map | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_clamav_standard.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_clamav_standard.map | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_custom_regex.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_custom_standard.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_mussel_regex.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/exe_mussel_standard.cvd | Arquivo por Portátil Executável arquivo (EXE) assinaturas.
/vault/signatures/filenames_clamav.cvd | Arquivo por arquivo nome assinaturas.
/vault/signatures/filenames_custom.cvd | Arquivo por arquivo nome assinaturas.
/vault/signatures/filenames_mussel.cvd | Arquivo por arquivo nome assinaturas.
/vault/signatures/general_clamav_regex.cvd | Arquivo por gerais assinaturas.
/vault/signatures/general_clamav_regex.map | Arquivo por gerais assinaturas.
/vault/signatures/general_clamav_standard.cvd | Arquivo por gerais assinaturas.
/vault/signatures/general_clamav_standard.map | Arquivo por gerais assinaturas.
/vault/signatures/general_custom_regex.cvd | Arquivo por gerais assinaturas.
/vault/signatures/general_custom_standard.cvd | Arquivo por gerais assinaturas.
/vault/signatures/general_mussel_regex.cvd | Arquivo por gerais assinaturas.
/vault/signatures/general_mussel_standard.cvd | Arquivo por gerais assinaturas.
/vault/signatures/graphics_clamav_regex.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_clamav_regex.map | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_clamav_standard.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_clamav_standard.map | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_custom_regex.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_custom_standard.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_mussel_regex.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/graphics_mussel_standard.cvd | Arquivo por gráficas assinaturas.
/vault/signatures/hex_general_commands.csv | Hex-codificado CSV de geral comando detecções opcionalmente usado por phpMussel.
/vault/signatures/html_clamav_regex.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_clamav_regex.map | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_clamav_standard.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_clamav_standard.map | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_custom_regex.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_custom_standard.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_mussel_regex.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/html_mussel_standard.cvd | Arquivo por normalizada HTML assinaturas.
/vault/signatures/macho_clamav_regex.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_clamav_regex.map | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_clamav_standard.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_clamav_standard.map | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_custom_regex.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_custom_standard.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_mussel_regex.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/macho_mussel_standard.cvd | Arquivo por Mach-O assinaturas.
/vault/signatures/mail_clamav_regex.cvd | Arquivo por mail assinaturas.
/vault/signatures/mail_clamav_regex.map | Arquivo por mail assinaturas.
/vault/signatures/mail_clamav_standard.cvd | Arquivo por mail assinaturas.
/vault/signatures/mail_clamav_standard.map | Arquivo por mail assinaturas.
/vault/signatures/mail_custom_regex.cvd | Arquivo por mail assinaturas.
/vault/signatures/mail_custom_standard.cvd | Arquivo por mail assinaturas.
/vault/signatures/mail_mussel_regex.cvd | Arquivo por mail assinaturas.
/vault/signatures/mail_mussel_standard.cvd | Arquivo por mail assinaturas.
/vault/signatures/md5_clamav.cvd | Arquivo por MD5 baseadas assinaturas.
/vault/signatures/md5_custom.cvd | Arquivo por MD5 baseadas assinaturas.
/vault/signatures/md5_mussel.cvd | Arquivo por MD5 baseadas assinaturas.
/vault/signatures/metadata_clamav.cvd | Arquivo por metadados assinaturas.
/vault/signatures/metadata_custom.cvd | Arquivo por metadados assinaturas.
/vault/signatures/metadata_mussel.cvd | Arquivo por metadados assinaturas.
/vault/signatures/ole_clamav_regex.cvd | Arquivo por OLE assinaturas.
/vault/signatures/ole_clamav_regex.map | Arquivo por OLE assinaturas.
/vault/signatures/ole_clamav_standard.cvd | Arquivo por OLE assinaturas.
/vault/signatures/ole_clamav_standard.map | Arquivo por OLE assinaturas.
/vault/signatures/ole_custom_regex.cvd | Arquivo por OLE assinaturas.
/vault/signatures/ole_custom_standard.cvd | Arquivo por OLE assinaturas.
/vault/signatures/ole_mussel_regex.cvd | Arquivo por OLE assinaturas.
/vault/signatures/ole_mussel_standard.cvd | Arquivo por OLE assinaturas.
/vault/signatures/pdf_clamav_regex.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pdf_clamav_regex.map | Arquivo por PDF assinaturas.
/vault/signatures/pdf_clamav_standard.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pdf_clamav_standard.map | Arquivo por PDF assinaturas.
/vault/signatures/pdf_custom_regex.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pdf_custom_standard.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pdf_mussel_regex.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pdf_mussel_standard.cvd | Arquivo por PDF assinaturas.
/vault/signatures/pex_custom.cvd | Arquivo por PE estendidas assinaturas.
/vault/signatures/pex_mussel.cvd | Arquivo por PE estendidas assinaturas.
/vault/signatures/pe_clamav.cvd | Arquivo por PE Seccional assinaturas.
/vault/signatures/pe_custom.cvd | Arquivo por PE Seccional assinaturas.
/vault/signatures/pe_mussel.cvd | Arquivo por PE Seccional assinaturas.
/vault/signatures/swf_clamav_regex.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_clamav_regex.map | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_clamav_standard.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_clamav_standard.map | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_custom_regex.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_custom_standard.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_mussel_regex.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/swf_mussel_standard.cvd | Arquivo por o Shockwave assinaturas.
/vault/signatures/switch.dat | Isto controla e define algumas variáveis.
/vault/signatures/urlscanner.cvd | Arquivo por URL analisador assinaturas.
/vault/signatures/whitelist_clamav.cvd | Arquivo específico whitelist.
/vault/signatures/whitelist_custom.cvd | Arquivo específico whitelist.
/vault/signatures/whitelist_mussel.cvd | Arquivo específico whitelist.
/vault/signatures/xmlxdp_clamav_regex.cvd | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_clamav_regex.map | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_clamav_standard.cvd | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_clamav_standard.map | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_custom_regex.cvd | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_custom_standard.cvd | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_mussel_regex.cvd | Arquivo por XML/XDP assinaturas.
/vault/signatures/xmlxdp_mussel_standard.cvd | Arquivo por XML/XDP assinaturas.
/vault/template.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/template_custom.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/update.dat | Arquivo contendo informações sobre a versão por tanto script e assinaturas de phpMussel. Se você está tencionando automaticamente atualizar phpMussel ou deseja atualizar phpMussel através de seu navegador, este arquivo é essencial.
/vault/update.inc | Atualização Script; Necessário por automáticas atualizações e para atualizar phpMussel através de seu navegador, mas não é necessário contrário.
/vault/upload.inc | Módulo de carregamento.

※ Arquivo nome podem variar baseado em configuração estipulação (referem-se a `phpmussel.ini`).

####*EM RELAÇÃO AOS ASSINATURAS ARQUIVOS*
CVD é um acrônimo por "ClamAV Virus Definitions", em referência tanto à forma como ClamAV refere-se às suas próprias assinaturas e para o uso dessas assinaturas por phpMussel; Arquivos que terminam com "CVD" contêm assinaturas.

Arquivos que terminam com "MAP", literalmente, mapa quais assinaturas phpMussel deve e não deve ser usado para análisar arquivos; Nem todas as assinaturas são necessariamente necessário por cada individual análise, e assim, phpMussel usa mapas dos assinatura arquivos para acelerar o processo de análise (um processo que de outro modo seria extremamente lento e tedioso).

Assinatura arquivos marcados com "_regex" contêm assinaturas que utilizam regulares expressões (regex).

Assinatura arquivos marcados com "_standard" contêm assinaturas que especificamente não utilizam qualquer forma de regulares expressões.

Assinatura arquivos marcados com nenhum "_regex" nem "_standard" será como um ou outro, mas não tanto (consulte Assinatura Formato seção deste README arquivo por documentação e específicos detalhes).

Assinatura arquivos marcados com "_clamav" contêm assinaturas, provenientes exclusivamente do ClamAV database (GNU/GPL).

Assinatura arquivos marcados com "_custom", por padrão, não contêm qualquer assinatura; Esses arquivos existem para dar-lhe um lugar para colocar suas próprias personalizadas assinaturas, se você criar algum do seu próprio.

Assinatura arquivos marcados com "_mussel" contêm assinaturas que são especificamente não provenientes de ClamAV, assinaturas que, em geral, eu criei pessoalmente ou baseado em informações obtidas através de várias fontes.

---


###6. <a name="SECTION6"></a>CONFIGURAÇÃO OPÇÕES
O seguinte é uma lista de variáveis encontradas no `phpmussel.ini` configuração arquivo de phpMussel, juntamente com uma descrição de sua propósito e função.

####"general" (Categoria)
Geral configuração por phpMussel.

"script_password"
- Como uma conveniência, phpMussel permitirás certas funções (incluindo a capacidade de atualizando phpMussel remotamente) ao ser acionado manualmente através de POST, GET e QUERY. Mas, como medida de segurança, para fazer isso, phpMussel esperam uma senha para ser incluída com o comando, forma a garantir que é você, e não outra pessoa, tentando de acionar manualmente essas funções. Definir `script_password` para qualquer senha que você desejá usar. Se nenhuma senha for definida, o manual acionamento será desativado por padrão. Uso algo que você vai se lembrar, mas que é difícil por outros adivinharem.
- Não tem influência em CLI modo.

"logs_password"
- O mesmo como `script_password`, mas por visualizando conteúdo de scan_log e scan_kills. Tendo separadas senhas pode ser útil se você quiser dar alguém o acesso a um conjunto de funções mas não o outro.
- Não tem influência em CLI modo.

"cleanup"
- Deletar script variáveis e cache após a execução? False = Não; True = Sim [Padrão]. Se você não estiver usar o script além da inicial verificação de carregamentos, deve definir a `true` (sim), para minimizar o uso de memória. Se você estiver usar o script por fins além da inicial verificação de carregamentos, deve definir a `false` (não), para evitar desnecessariamente duplicados dados recarregando em memória. Em prática geral, deve provavelmente ser definido como `true` (sim), mas, se você fizer isso, você não será capaz de usando o script por qualquer outra fim além analisando arquivos carregamentos.
- Não tem influência em CLI modo.

"scan_log"
- Nome do arquivo para registrar todos os resultados do análises. Especifique um arquivo nome, ou deixe branco para desativar.

"scan_log_serialized"
- Nome do arquivo para registrar todos os resultados do análises (formato é serializado). Especifique um arquivo nome, ou deixe branco para desativar.

"scan_kills"
- Nome do arquivo para registrar todos os bloqueados ou matados carregamentos. Especifique um arquivo nome, ou deixe branco para desativar.

"ipaddr"
- Onde encontrar o IP endereço dos pedidos? (Útil por serviços como o Cloudflare e tal) Padrão = REMOTE_ADDR. ATENÇÃO: Não mude isso a menos que você saiba o que está fazendo!

"forbid_on_block"
- Deve phpMussel enviar 403 header com a bloqueado arquivo carregamento mensagem, ou ficar com os habituais 200 OK? False = Não (200) [Padrão]; True = Sim (403).

"delete_on_sight"
- Ativando esta opção irá instruir o script para tentar imediatamente deletando qualquer arquivo que ele encontra durante a análise que corresponde a qualquer critério de detecção, quer seja através de assinaturas ou de outra forma. Arquivos determinados para ser "limpo" não serão tocados. Em caso de compactados arquivos, o inteiro arquivo será deletado (independentemente de se o problemático arquivo é apenas um dos vários arquivos contidos dentro do compactado arquivo). Para o caso de arquivo carregamento análise, em geral, não é necessário ativar essa opção, porque normalmente, PHP irá automaticamente expurgar os conteúdos de o seu cache quando a execução foi concluída, significando que ele vai normalmente deletar todos os arquivos enviados através dele para o servidor a menos que tenha movido, copiado ou deletado já. A opção é adicionado aqui como uma medida de segurança para aqueles cujas cópias de PHP nem sempre se comportam da forma esperada. False = Após a análise, deixe o arquivo sozinho [Padrão]; True = Após a análise, se não limpo, deletar imediatamente.

"lang"
- Especificar o padrão da linguagem por phpMussel.

"lang_override"
- Especificar se phpMussel deve, quando possível, substituir a especificação da linguagem com a preferência da linguagem declarada por solicitações de entrada (HTTP_ACCEPT_LANGUAGE). False = Não [Padrão]; True = Sim.

"lang_acceptable"
- A `lang_acceptable` directiva instrui phpMussel qual línguas pode ser aceito pelo script a partir de `lang` ou a partir de `HTTP_ACCEPT_LANGUAGE`. Esta directiva **SÓ** deve ser modificado se você estiver adicionando seus próprios customizados idiomas arquivos ou removendo forçadamente idiomas arquivos. A directiva é uma seqüência dos códigos utilizados por essas línguas aceites pelo script, delimitadas por vírgulas.

"quarantine_key"
- phpMussel é capaz de colocar em quarentena marcados tentados arquivos carregamentos em isolamento dentro da phpMussel vault, se isso é algo que você quer que ele faça. Casuais usuários de phpMussel de que simplesmente desejam proteger seus sites ou hospedagem sem ter qualquer interesse em profundamente analisando qualquer marcados tentados arquivos carregamentos deve deixar esta funcionalidade desativada, mas qualquer usuário interessado em mais profundamente analisando marcados tentados arquivos carregamentos para pesquisa de malware ou de similares tais coisas deve ativada essa funcionalidade. Quarentena de marcados tentados arquivos carregamentos às vezes pode também ajudar em depuração de falso-positivos, se isso é algo que ocorre com freqüência para você. Por desativar a funcionalidade de quarentena, simplesmente deixar a directiva `quarantine_key` vazio, ou apagar o conteúdo do directivo, se ele não está já vazio. Por ativar a funcionalidade de quarentena, introduzir algum valor no directiva. O `quarantine_key` é um importante segurança característica do quarentena funcionalidade necessária como um meio de prevenir a funcionalidade de quarentena de ser explorada por potenciais atacantes e como meio de evitar qualquer potencial execução de dados armazenados dentro da quarentena. O `quarantine_key` devem ser tratados da mesma maneira como suas senhas: O mais longo o mais melhor, e guardá-lo com força. Por melhor efeito, usar em conjunto com `delete_on_sight`.

"quarantine_max_filesize"
- O máximo permitido tamanho do arquivos serem colocados em quarentena. Arquivos maiores que este valor NÃO serão colocados em quarentena. Esta directiva é importante como um meio de torná-lo mais difícil por qualquer potenciais atacante para inundar sua quarentena com indesejados dados potencialmente causando excesso uso de dados no seu hospedagem serviço. O valor é em KB. Padrão =2048 =2048KB =2MB.

"quarantine_max_usage"
- O máximo uso de memória permitido através do quarentena. Se o total de memória utilizada pelo quarentena atingir este valor, os mais antigos arquivos em quarentena serão apagados até que a total memória utilizada já não atinge este valor. Esta directiva é importante como um meio de torná-lo mais difícil por qualquer potenciais atacante para inundar sua quarentena com indesejados dados potencialmente causando excesso uso de dados no seu hospedagem serviço. O valor é em KB. Padrão =65536 =65536KB =64MB.

"honeypot_mode"
- Quando o honeypot modo é ativada, phpMussel vai tenta coloca no quarentena todos os arquivos uploads que ele encontras, independentemente de se ou não o arquivo que está sendo carregado corresponde a qualquer incluídos assinaturas, e zero análise desses tentados arquivos carregamentos vai ocorrer. Esta funcionalidade deve ser útil por aqueles que desejam utilizar phpMussel por os fins de vírus/malware pesquisa, mas não é recomendado para ativar essa funcionalidade se o planejado uso de phpMussel pelo utilizador é por o real análise dos arquivos carregamentos nem recomendado para usar essa funcionalidade por fins outros que o uso do honeypot. Por padrão, essa opção está desativada. False = Desativado [Padrão]; True = Ativado.

"scan_cache_expiry"
- Por quanto tempo deve phpMussel cache os resultados da verificação? O valor é o número de segundos para armazenar em cache os resultados da verificação para. O padrão é 21600 segundo (6 horas); Um valor de 0 irá desativar o cache os resultados da verificação.

"disable_cli"
- Desativar o CLI modo? CLI modo é ativado por padrão, mas às vezes pode interferir com certas testes ferramentas (tal como PHPUnit, por exemplo) e outras aplicações baseadas em CLI. Se você não precisa desativar o CLI modo, você deve ignorar esta directiva. False = Ativar o CLI modo [Padrão]; True = Desativar o CLI modo.

####"signatures" (Categoria)
Configuração por assinaturas.
- %%%_clamav = ClamAV assinaturas (ambos main e daily).
- %%%_custom = Suas personalizadas assinaturas (se você escrever alguma).
- %%%_mussel = phpMussel assinaturas incluído no seus atuais assinaturas conjunto que não são do ClamAV.

Verificar contra MD5 assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Verificar contra geral assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "general_clamav"
- "general_custom"
- "general_mussel"

Verificar contra normalizada ASCII assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Verificar contra normalizada HTML assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "html_clamav"
- "html_custom"
- "html_mussel"

Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE Seccional assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE estendidas assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "pex_custom"
- "pex_mussel"

Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Verificar ELF arquivos contra ELF assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Verificar Mach-O arquivos (OSX, etc) contra Mach-O assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Verificar gráficos arquivos contra gráficas assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Verificar compactados arquivos conteúdo contra compactados arquivos metadados assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Verificar OLE objetos contra OLE assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Verificar arquivos nomes contra assinaturas arquivos nomes baseadas assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Permitir análise com phpMussel_mail()? False = Não; True = Sim [Padrão].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Ativar arquivo-específico whitelist? False = Não; True = Sim [Padrão].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Verificar XML/XDP pedaços contra XML/XDP assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Verificar contra complexos estendidas assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Verificar contra PDF assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Verificar contra Shockwave assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Assinatura analisando comprimento limitando opções. Apenas alterar estes se você sabe que está fazendo. SD = Padrão assinaturas (norma assinaturas). RX = PCRE (Perl Compatíveis Regulares Expressões, ou "Regex") assinaturas. FN = Arquivo nome assinaturas. Se você notar PHP falhando quando phpMussel verifica arquivos, tentar diminuir o "max" valores. Se possível e conveniente, deixe-me saber quando isso acontece e os resultados de tudo o que você tentar.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Deve phpMussel reportar quando os assinaturas arquivos estão perdido ou corrompido? Se fail_silently está desativado, perdidos e corrompidos arquivos serão reportado durante análise, e se fail_silently está ativado, perdidos e corrompidos arquivos serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Isso geralmente deve ser deixado sozinho a menos que você está experimentando PHP falhas ou semelhantes problemas. False = Desativado; True = Ativado [Padrão].

"fail_extensions_silently"
- Deve phpMussel reportar quando extensões não estão disponíveis? Se fail_extensions_silently está desativado, extensões indisponíveis serão reportado durante análise, e se fail_extensions_silently está ativado, extensões indisponíveis serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Desativando dessa directiva pode potencialmente aumentar a sua segurança, mas também pode levar a um aumento de falsos positivos. False = Desativado; True = Ativado [Padrão].

"detect_adware"
- Deve phpMussel usam assinaturas para detectar adware? False = Não; True = Sim [Padrão].

"detect_joke_hoax"
- Deve phpMussel usam assinaturas para detectar piada/engano malwares/vírus? False = Não; True = Sim [Padrão].

"detect_pua_pup"
- Deve phpMussel usam assinaturas para detectar PUAs/PUPs? False = Não; True = Sim [Padrão].

"detect_packer_packed"
- Deve phpMussel usam assinaturas para detectar embaladores e dados embaladas? False = Não; True = Sim [Padrão].

"detect_shell"
- Deve phpMussel usam assinaturas para detectar shell scripts? False = Não; True = Sim [Padrão].

"detect_deface"
- Deve phpMussel usam assinaturas para detectar vandalismo e vândalos? False = Não; True = Sim [Padrão].

####"files" (Categoria)
Geral configuração por a manipulação de arquivos.

"max_uploads"
- O máximo permitido número de arquivos para analisar durante os arquivos carregamentos análise antes de abortar a análise e informando ao usuário eles estão carregando demais muito de uma vez! Oferece proteção contra um teórico ataque pelo qual um atacante tenta DDoS o seu sistema ou CMS por meio de sobrecarregando phpMussel a fim de retardar o PHP processo para uma parada. Recomendado: 10. Você pode querer aumentar ou diminuir esse número, dependendo das atributos do seu hardware. Note-se que este número não lev. Em conta ou incluir o conteúdos dos compactados arquivos.

"filesize_limit"
- Arquivo tamanho limit. Em KB. 65536 = 64MB [Padrão] 0 = Não limite (sempre greylisted), qualquer (positivo) numérico valor aceite. Isso pode ser útil quando sua PHP configuração limita a quantidade de memória que um processo pode ocupar ou se sua PHP configuração limita o arquivo tamanho de carregamentos.

"filesize_response"
- Que fazer com arquivos que excedam o limite de arquivo tamanho (se existir). False = Whitelist; True = Blacklist [Padrão].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Se o seu sistema só permite certos tipos de arquivos sejam carregado, ou se o seu sistema explicitamente nega certos tipos de arquivos, especificando esses tipos de arquivos no whitelists, blacklists e greylists pode aumentar a velocidado em que a análise é realizada através de permitindo o script para ignorar certos tipos de arquivos. O formato CSV (Comma Separated Values). Se você quer analisar tudo, ao invés de fazendo whitelist, blacklist ou greylist, deixe as variáveis em branco; Isso irá desativar whitelist/blacklist/greylist).
- Lógico ordem de processamento é:
  - Se o tipo de arquivo está na whitelist, não verificar e não bloqueia o arquivo, e não verificar o arquivo contra o blacklist ou greylist.
  - Se o tipo de arquivo está na blacklist, não verificar o arquivo, mas bloqueá-lo de qualquer maneira, e não verificar o arquivo contra o greylist.
  - Se o greylist está vazia ou se o greylist não está vazia e o tipo de arquivo é no greylist, verificar o arquivo como por normal e determinar se a bloqueá-lo com base nos resultados do verificando, mas se o greylist não está vazia e o tipo de arquivo não é no greylist, tratar o arquivo da mesma maneira como está na blacklist, portanto não verificá-lo, mas bloqueá-lo de qualquer maneira.

"check_archives"
- Tentativa de verificar os conteúdos dos compactados arquivos? False = Não (Não verificar); True = Sim (Verificar) [Padrão].
- Neste momento, apenas a verificação de BZ, GZ, LZF e ZIP arquivos é suportados (verificação de RAR, CAB, 7z e etcetera suportados neste momento).
- Este não é infalível! Embora eu recomendo mantê-lo ativado, eu não posso garantir que sempre vai encontrar tudo.
- Também estar ciente de que a verificação do compactados arquivos, neste momento, não é recursiva por ZIP arquivos.

"filesize_archives"
- Herdar o arquivo tamanho blacklist/whitelist para o conteúdo de compactados arquivos? False = Não (greylist tudo); True = Sim [Padrão].

"filetype_archives"
- Herdar o arquivo tipo blacklist/whitelist para o conteúdo de compactados arquivos? False = Não (greylist tudo); True = Sim [Padrão].

"max_recursion"
- Máxima recursão profundidade limite por compactados arquivos. Padrão = 10.

"block_encrypted_archives"
- Detectar e bloquear compactados arquivos criptografados? Porque phpMussel não é capaz de analisar o conteúdo de arquivos criptografados, é possível que a criptografia de arquivo pode ser empregado por um atacante como meio de tentar contornar phpMussel, analisadores anti-vírus e outras dessas protecções. Instruindo phpMussel para bloquear quaisquer arquivos que ele descobrir a ser criptografada poderia ajudar a reduzir o risco associado a essas tais possibilidades. False = Não; True = Sim [Padrão].

####"attack_specific" (Categoria)
Configuração por específicas ataque detecções (não baseado em CVDs).

Chameleon ataque detecções: False = Inativo; True = Ativo.

"chameleon_from_php"
- Olha por PHP header em arquivos que são não PHP arquivos nem reconhecidos compactados arquivos.

"chameleon_from_exe"
- Olha por executável headers em arquivos que são não executáveis nem reconhecidos compactados arquivos e por executáveis cujos headers estão incorretas.

"chameleon_to_archive"
- Olha por compactados arquivos cujos headers estão incorretas (Suportados: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Olha por office documentos cujos headers estão incorretas (Suportados: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Olha por imagens cujos headers estão incorretas (Suportados: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Olha por PDF arquivos cujos headers estão incorretas.

"archive_file_extensions" and "archive_file_extensions_wc"
- Reconhecidos arquivos extensões (formato é CSV; só deve adicionar ou remover quando problemas ocorrem; desnecessariamente removendo pode causar falso-positivos para aparecer por compactados arquivos, enquanto desnecessariamente adicionando será essencialmente whitelist o que você está adicionando contra ataque específica detecção; modificar com cautela; Também notar que este não tem efeito em qual compactados arquivos podem e não podem ser analisados no escopo de conteúdo). A lista, como é padrão, é do formatos utilizados mais comumente através da maioria dos sistemas e CMS, mas intencionalmente não é necessariamente abrangente.

"general_commands"
- Olha por comandos gerais como tais `eval()` e `exec()` em conteúdos de arquivos? False = Não (não olha por) [Padrão]; True = Sim (olha por). Desativar essa directiva se você são tencionando de carregando qualquer um do seguinte para o seu sistema ou CMS através do seu navegador: PHP, JavaScript, HTML, python, perl arquivos e etcetera. Ativar essa directiva se você não tem quaisquer adicionais proteções no seu sistema e não são tencionando de carregando desses tais arquivos. Se você usar adicional segurança em conjunto com phpMussel (como ZB Block), não há necessidade de ativar esta directiva, porque a maioria dos que phpMussel irá olha por (no contexto desta directiva) são duplicações de proteções que já estão fornecida.

"block_control_characters"
- Bloquear todos os arquivos que contenham quaisquer caracteres de controle (exceto linha quebras) - `[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`? Se você está _**APENAS**_ carregando simple texto, então você pode ativar essa opção para fornecer alguma adicional proteção para o seu sistema. Mas, se você carregar qualquer coisa que não seja de texto simples, ativando isso pode resultas em falso positivos. False = Não bloquear [Padrão]; True = Bloquear.

"corrupted_exe"
- Corrompidos arquivos e erros de análise. False = Ignorar; True = Bloquear [Padrão]. Detectar e bloquear potencialmente corrompidos PE (Portátil Executável) arquivos? Frequentemente (mas não sempre), quando certos aspectos de um PE arquivo é corrompido ou não pode ser analisado corretamente, essa pode ser indicativo de uma viral infecção. Os processos utilizados pela maioria dos anti-vírus programas para detectar vírus em PE arquivos requerem analisando os arquivos de certas maneiras, que, se o programador de um vírus é consciente de, especificamente irá tentar impedir, a fim de permitir seu vírus para permanecer não detectado.

"decode_threshold"
- Opcional limitação para o comprimento dos brutos dados para que dentro de decodificar comandos devem ser detectados (em caso de existirem quaisquer notável problemas de desempenho enquanto analisando). Valor é um inteiro que representa tamanho do arquivo Em KB. Padrão = 512 (512KB). Zero ou nulo valor desativa o limitação (removendo qualquer limitação baseado em tamanho do arquivo).

"scannable_threshold"
- Opcional limitação para o comprimento dos brutos dados para que phpMussel é permitido a ler e analisar (em caso de existirem quaisquer notável problemas de desempenho enquanto analisando). Valor é um inteiro que representa tamanho do arquivo Em KB. Padrão = 32768 (32MB). Zero ou nulo valor desativa o limitação. Em geral, esse valor não deve ser menor que o médio arquivo tamanho de carregamentos que você quer e espera para receber no seu servidor ou website, não deve ser mais que o filesize_limit directivo, e não deve ser menor que aproximadamente um quinto do total permissível memória alocação concedido para PHP através do php.ini configuração arquivo. Esta directiva existe para tentar impedir phpMussel de usando demais memória (que seria impedir-lo de ser capaz de analisando arquivos acima de um certo tamanho com sucesso).

####"compatibility" (Categoria)
Compatibilidade directivas por phpMussel.

"ignore_upload_errors"
- Essa directiva deve ser geralmente desativada a menos que seja necessário por correta funcionalidade de phpMussel no seu específico sistema. Normalmente, quando desativado, quando phpMussel detecta a presença de elementos dentro a `$_FILES` array(), ele tentará iniciar uma análise dos arquivos que esses elementos representam, e, se esses elementos estão branco ou vazia, phpMussel irá retornar uma erro mensagem. Esse é um apropriado comportamento por phpMussel. Mas, por alguns CMS, vazios elementos podem ocorrer como resultado do natural comportamento dessas CMS, ou erros podem ser reportado quando não houver alguma, nesse caso, o normal comportamento por phpMussel será interferindo com o normal comportamento dessas CMS. Se tal situação ocorre por você, ativando esta opção irá instruir phpMussel para não tentar iniciar um análise por tais vazios elementos, ignorá-los quando encontrado e para não retornar qualquer relacionado erro mensagens, assim, permitindo a continuação da página carga. False = DESATIVADO; True = ATIVADO.

"only_allow_images"
- Se você apenas esperar ou apenas tencionar de permitir imagens a ser enviado para seu sistema ou CMS, e se você absolutamente não necessita quaisquer arquivos exceto imagens a ser enviado para seu sistema ou CMS, esta directiva devia ser ATIVADO, mas em outros casos devia ser DESATIVADO. Se esta directiva é ATIVADO, ele irá instruir phpMussel indiscriminadamente bloquear qualquer arquivo carregamento identificado como não imagem, sem os analisar. Isto pode reduzir o tempo de processamento e uso de memória por tentados carregamentos de não imagem arquivos. False = DESATIVADO; True = ATIVADO.

####"heuristic" (Categoria)
Heurísticos directivas para phpMussel.

"threshold"
- Existem assinaturas específicas de phpMussel para identificando suspeitas e qualidades potencialmente maliciosos dos arquivos que estão sendo carregados sem por si só identificando aqueles arquivos que estão sendo carregados especificamente como sendo maliciosos. Este "threshold" (limiar) valor instrui phpMussel o que o total máximo peso de suspeitas e qualidades potencialmente maliciosos dos arquivos que estão sendo carregados que é permitida é antes que esses arquivos devem ser sinalizada como maliciosos. A definição de peso neste contexto é o número total de suspeitas e qualidades potencialmente maliciosos identificado. Por padrão, este valor será definido como 3. Um menor valor geralmente resultará em uma maior ocorrência de falsos positivos mas um maior número de arquivos maliciosos sendo sinalizado, enquanto um maior valor geralmente resultará em uma menor ocorrência de falsos positivos mas um menor número de arquivos maliciosos sendo sinalizado. É geralmente melhor a deixar esse valor em seu padrão a menos que você está enfrentando problemas relacionados a ela.

####"virustotal" (Categoria)
Configuração para Virus Total integração.

"vt_public_api_key"
- Opcionalmente, phpMussel é capaz de verificar os arquivos usando o Virus Total API como uma maneira de fornecer um nível de proteção muito maior contra vírus, trojans, malware e outras ameaças. Por padrão, verificação de arquivos usando o Virus Total API está desativado. Para ativá-lo, um Virus Total API chave é necessária. Devido ao benefício significativo que isso poderia fornecer a você, é algo que eu recomendo ativar. Esteja ciente, porém, que para usar o Virus Total API, você _**DEVE**_ concordar com seus Termos de Uso e você _**DEVE**_ aderir a todas as orientações conforme descrito pelo da Virus Total documentação! Você NÃO tem permissão para usar este recurso de integração EXCETO SE:
  - Você leu e concorda com os Termos de Uso da Virus Total e sua API. Os Termos de Uso da Virus Total e sua API pode ser encontrada [Aqui](https://www.virustotal.com/en/about/terms-of-service/).
  - Você leu e você compreender, no mínimo, o preâmbulo da Virus Total Pública API documentação (tudo depois "VirusTotal Public API v2.0" mas antes "Contents"). Os Virus Total Pública API documentação pode ser encontrada [Aqui](https://www.virustotal.com/en/documentation/public-api/).

Notar: Se a verificação de arquivos usando o Virus Total de API está desativado, você não será necessitar de rever alguma das directivas nesta categoria (`virustotal`), porque eles não vão fazer nada se este é desativado. Para adquirir um Virus Total API chave, desde qualquer lugar em seu site, clique no "Junte-se à comunidade" link situado próximo ao superior direita da página, digitar as informações solicitadas, e clique em "Cadastrar" quando acabado. Siga todas as instruções fornecidas, e quando você tem a sua pública API chave, copiar/colar essa pública API chave ao `vt_public_api_key` directiva do `phpmussel.ini` configuração arquivo.

"vt_suspicion_level"
- Por padrão, phpMussel restringirá os arquivos que são verificado usando o Virus Total API a esses arquivos que considera "suspeito". Opcionalmente, você pode ajustar essa restrição via alterando o valor ao `vt_suspicion_level` directiva.
- `0`: Arquivos somente são considerados suspeitos se, quando ser verificado por phpMussel usando suas próprias assinaturas, eles são considerados para possuir um peso heurística. Isto eficazmente significa que a utilização da Virus Total API seria para um segundo opinião para quando phpMussel suspeita que um arquivo pode ser potencialmente malicioso, mas não pode afastar totalmente que podem também ser benigna (não malicioso) e por conseguinte normalmente em caso contrário não seria bloqueá-lo ou marcá-lo como malicioso.
- `1`: Arquivos são considerados suspeitos se, quando ser verificado por phpMussel usando suas próprias assinaturas, eles são considerados para possuir um peso heurística, se eles são conhecidos para ser executável (PE arquivos, Mach-O arquivos, ELF/Linux arquivos, etc), ou se eles são conhecidos para ser de um formato que pode potencialmente conter dados executável (tais como macros executáveis, DOC/DOCX arquivos, arquivos compactados tais como RARs, ZIPS e etc). Este é o padrão e recomendado nível de suspeita para aplicar, eficazmente significando que a utilização da Virus Total API seria para um segundo opinião para quando phpMussel inicialmente não encontrar qualquer coisa que é malicioso ou errado com um arquivo que ele considera ser suspeito e por conseguinte em caso contrário não seria bloqueá-lo ou marcá-lo como malicioso.
- `2`: Todos arquivos são considerados suspeitos e devem ser verificados usando o Virus Total API. Eu geralmente não recomendamos a aplicação desse nível de suspeita, devido ao risco de atingir sua API cota muito mais rápido do que de caso contrário seria o caso, mas existem certas circunstâncias (tal como quando o webmaster ou hostmaster tem muito pouca fé ou confiança em qualquer um dos conteúdos carregados por seus usuários) onde este nível suspeita pode ser adequado. Com este nível suspeita, todos arquivos normalmente não bloqueados ou marcados como sendo malicioso seria analisados usando o Virus Total API. Notar, porém, que phpMussel deixará usando o Virus Total API quando sua API cota foi atingido (independentemente do nível de suspeita), e que a sua cota será provavelmente ser alcançado muito mais rápido quando se usando este nível de suspeita.

Notar: Independentemente do nível de suspeita, todos os arquivos que estão na blacklist ou whitelisted por phpMussel não serão analisados usando o Virus Total API, porque esses tais arquivos que já foram declaradas como quer malicioso ou benigno por phpMussel no momento em que eles teriam sido de caso contrário analisada pelo Virus Total API, e por conseguinte, análise adicional não seria necessário. A capacidade de phpMussel para verificar arquivos usando o Virus Total API é destinado para construir confiança em relação a se um arquivo é malicioso ou benigno nas circunstâncias em que phpMussel não é totalmente certo se um arquivo é malicioso ou benigno.

"vt_weighting"
- Deve phpMussel aplicar os resultados de analisando usando o Virus Total API como detecções ou como detecção ponderação? Esta directiva existe, porque, embora verificando um arquivo usando múltiplos mecanismos (como Virus Total faz) deve resultar em um aumento da taxa de detecção (e por conseguinte em um maior número de arquivos maliciosos detectados), isto também pode resultar em um aumento número de falsos positivos, e por conseguinte, em algumas circunstâncias, os resultados de análise pode ser melhor utilizado como uma pontuação de confiança e não como uma conclusão definitiva. Se um valor de 0 é usado, os resultados de análise usando o Virus Total API será aplicado como detecções, e por conseguinte, Se qualquer mecanismo usado pelo Virus Total marca o arquivo que está sendo analisado como sendo malicioso, phpMussel considerará o arquivo a ser malicioso. Se qualquer outro valor é usado, os resultados de análise usando o Virus Total API será aplicado como detecção ponderação, e por conseguinte, o número de mecanismos utilizados pela Virus Total que marcar o arquivo que está sendo analisado como sendo malicioso servirá como uma pontuação de confiança (ou ponderação de detecção) para se ou não o arquivo que está sendo analisado deve ser considerado malicioso por phpMussel (o valor utilizado representará o mínima pontuação de confiança ou peso requerido a fim de ser considerado malicioso). Um valor de 0 é usado por padrão.

"vt_quota_rate" e "vt_quota_time"
- De acordo com o Virus Total API documentação, é limitada a, no máximo, 4 solicitações de qualquer natureza dentro qualquer 1 minuto período de tempo. Se você executar um honeyclient, honeypot ou qualquer outro automação que vai fornecer recursos para Virus Total e não só recuperar relatórios você tem direito a uma melhor solicitações cota. Por padrão, phpMussel vai aderir estritamente a estas limitações, mas, devido à possibilidade de essas cotas a ser aumentada, estas duas directivas são fornecidos como um meio para que você possa instruir phpMussel sobre o limite que deve aderir para. Excepto se tenha sido instruído a fazê-lo, não é recomendado para você aumentar esses valores, mas, se você encontrou problemas relacionados com a atingir sua cota, diminuir esses valores podem _**POR VEZES**_ ajudá-lo em lidar com estes problemas. Seu taxa limite é determinada como `vt_quota_rate` solicitações de qualquer natureza dentro qualquer `vt_quota_time` minuto período de tempo.

####"urlscanner" (Categoria)
URL analisador configuração.

"urlscanner"
- Construído em phpMussel é um URL analisador, capaz de detectar URLs maliciosos dentro de todos os dados ou arquivos analisados. Para habilitar o URL analisador, definir a diretiva `urlscanner` para true; Para desativá-lo, definir esta diretiva para false.

Notar: Se o URL analisador é desativado, você não terá que rever alguma das directivas nesta categoria (`urlscanner`), porque nenhum deles fará de tudo se este é desativado.

URL analisador API uso configuração.

"lookup_hphosts"
- Permite o uso do [hpHosts](http://hosts-file.net/) API quando definido para true. hpHosts não requer uma API chave para o uso de sua API.

"google_api_key"
- Permite o uso do Google Safe Browsing API quando a API chave necessária está definida. Para o uso de sua API, Google Safe Browsing API requerer uma API chave, que pode ser obtido a partir de [Aqui](https://console.developers.google.com/).
- Notar: Esta é uma função futuro! Google Safe Browsing API funcionalidade não está escrita neste momento!

"maximum_api_lookups"
- Número máximo admissível de API solicitações para executar por cada iteração de análise. Porque cada API solicitação adicional irá acrescentar ao tempo total necessário para completar cada iteração de análise, você pode querer estipular uma limitação a fim de acelerar o processo de análise. Quando definido para 0, nenhuma número máximo admissível será aplicada. Definido para 10 por padrão.

"maximum_api_lookups_response"
- Que fazer se o número máximo admissível de API solicitações está ultrapassado? False = Fazer nada (continuar o processamento) [Padrão]; True = Marcar/bloquear o arquivo.

"cache_time"
- Quanto tempo (em segundos) devem os resultados da API ser armazenados em cache? Padrão é 3600 segundos (1 hora).

####"template_data" (Categoria)
Directivas/Variáveis para modelos e temas.

Template dados está associada com o HTML usado para gerar a "Carregar Negado" mensagem exibido aos usuários quandos arquivo carregamentos são bloqueados. Se você estiver usando temas personalizados para phpMussel, HTML é originado a partir do `template_custom.html` arquivo, e caso contrário, HTML é originado a partir do `template.html` arquivo. Variáveis escritas para esta seção do configuração arquivo são processado ao HTML via substituição de quaisquer nomes de variáveis cercado por colchetes encontrado dentro do HTML com os variáveis dados correspondentes. Por exemplo, onde `foo="bar"`, qualquer instância de `<p>{foo}</p>` encontrado dentro do HTML tornará `<p>bar</p>`.

"css_url"
- O template arquivo para temas personalizados utiliza CSS propriedades externos, enquanto que o template arquivo para o padrão tema utiliza CSS propriedades internos. Para instruir phpMussel para usar o template arquivo para temas personalizados, especificar o endereço HTTP pública do seu temas personalizados CSS arquivos usando a `css_url` variável. Se você deixar essa variável em branco, phpMussel usará o template arquivo para o padrão tema.

---


###7. <a name="SECTION7"></a>ASSINATURA FORMATO

####*ARQUIVO NOME ASSINATURAS*
Todas as arquivo nome assinaturas seguir o formato:

`NOME:FNRX`

Onde NOME é o nome para citar por essa assinatura e FNRX é o regex para verificar arquivos nomes (não codificados) contra.

####*MD5 ASSINATURAS*
Todas as MD5 assinaturas seguir o formato:

`HASH:TAMANHO:NOME`

Onde HASH é o MD5 hash de um inteiro arquivo, TAMANHO é o total tamanho do arquivo e NOME é o nome para citar por essa assinatura.

####*COMPACTADOS ARQUIVOS METADADOS ASSINATURAS*
Todas as compactados arquivos metadados assinaturas seguir o formato:

`NOME:TAMANHO:CRC32`

Onde NOME é o nome para citar por essa assinatura, TAMANHO é o total tamanho (descompactado) de um arquivo contido dentro do compactado arquivo e CRC32 é o CRC32 checksum do contido arquivo.

####*PE SECCIONAL ASSINATURAS*
Todas as PE Seccional assinaturas seguir o formato:

`TAMANHO:HASH:NOME`

Onde HASH é o MD5 hash de uma secção do PE arquivo, TAMANHO é o total tamanho da secção e NOME é o nome para citar por essa assinatura.

####*PE ESTENDIDAS ASSINATURAS*
Todas as PE estendidas assinaturas seguir o formato:

`$VAR:HASH:TAMANHO:NOME`

Onde $VAR é o nome da PE variável para verificar contra, HASH é o MD5 dessa variável, TAMANHO é o tamanho total dessa variável e NOME é o nome para citar por essa assinatura.

####*WHITELIST ASSINATURAS*
Todas as Whitelist assinaturas seguir o formato:

`HASH:TAMANHO:TYPE`

Onde HASH é o MD5 hash de um inteiro arquivo, TAMANHO é o total tamanho do arquivo e TYPE é o tipo de assinaturas o arquivo é ser imune contra.

####*COMPLEXOS ESTENDIDAS ASSINATURAS*
Complexos estendidas assinaturas são bastante diferente para os outros tipos de assinaturas possíveis com phpMussel em que o que eles estão verificando contra é especificado pelas assinaturas e eles podem verificar contra vários critérios. Os critérios de verificação são delimitados por ";" e o verificação tipo e os verificação dados de cada verificação critérios é delimitados por ":" como assim que o formato por estas assinaturas tende a olhar um pouco assim:

`$variável1:ALGUNSDADOS;$variável2:ALGUNSDADOS;AssinaturaNome`

####*TODAS OUTRAS*
Todas as outras assinaturas seguir o formato:

`NOME:HEX:FROM:TO`

Onde NOME é o nome para citar por essa assinatura e HEX é um hexadecimal codificado segmento do arquivo intentado a ser correspondido pela dado assinatura. TO e FROM são opcionais parâmetros, indicando de onde e para quais posições nos origem dados para verificar contra (não suportado pela mail função).

####*REGEX*
Qualquer forma de regex compreendido e processado corretamente pelo PHP também deve ser correctamente compreendido e processado por phpMussel e suas assinaturas. Mas, eu sugiro tomar extremo cuidado quando escrevendo novas assinaturas baseadas regex, porque, se você não está inteiramente certo do que está fazendo, isto pode tem altamente irregulares e inesperadas resultados. Olha para o código-fonte de phpMussel Se você não está totalmente certo sobre o contexto em que as regex declarações são processada. Além, lembre-se que todos isso (com exceção para arquivo nome, compactado arquivo metadados, MD5 a sintaxe) deve ser codificado hexadecimalmente!

####*ONDE COLOCAR PERSONALIZADAS ASSINATURAS?*
Colocar personalizadas assinaturas nos arquivos destinado por personalizadas assinaturas só. Esses arquivos devem conter "_custom" no seus nomes. Você também deve evitar editando padrão assinatura arquivos, a menos que você sabe exatamente o que você está fazendo, por razão que, além de sendo boa prática em geral e além de ajudá-lo distinguir entre suas próprias assinaturas e as padrãos assinaturas incluídos com phpMussel, é bom para manter para editando apenas os arquivos destinados por editando, por razão de que mexendo com os padrão assinatura arquivos pode causá-los a cessar funcionando corretamente, devido aos "mapas" arquivos: Os mapas arquivos instruir phpMussel onde nos assinatura arquivos para olhar por assinaturas necessário por phpMussel tal quando necessário, e esses mapas podem tornar-se fora de sincronia com seus associadas assinatura arquivos se esses assinatura arquivos são adulterado com. Você pode essencialmente colocar qualquer você quiser no seus personalizadas assinaturas, desde que você siga a correta sintaxe. Mas, cuidado para testar novas assinaturas por falso-positivos de antemão se você tencionar de compartilhá-los ou usá-los em um ambiente vivo.

####*ASSINATURA COMPOSIÇÃO*
A seguir estão os diferentes tipos de assinaturas utilizadas por phpMussel:
- "Normalizadas ASCII Assinaturas" (ascii_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando.
- "Complexos Estendidas Assinaturas" (coex_*). Misto tipo de assinatura verificando.
- "ELF Assinaturas" (elf_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato ELF.
- "Portátil Executável Assinaturas" (exe_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato PE.
- "Arquivo Nome Assinaturas" (filenames_*). Verificado contra os nomes de cada arquivo não no whitelist e alvo por analisando.
- "Gerais Assinaturas" (general_*). Verificado contra o conteúdo de arquivo não no whitelist e alvo por analisando.
- "Gráficas Assinaturas" (graphics_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmado tal de um conhecidos gráficos arquivos formato.
- "Gerais Comandos" (hex_general_commands.csv). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando.
- "Normalizadas HTML Assinaturas" (html_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando.
- "Mach-O Assinaturas" (macho_*). Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato Mach-O.
- "E-mail Assinaturas" (mail_*). Verificado contra o $body variável alimentado para o phpMussel_mail() função, que se intencionado para ser o corpo das e-mail mensagens ou similares entidades (potencialmente fórum mensagens e etcetera).
- "MD5 Assinaturas" (md5_*). Verificado contra o MD5 hash do conteúdo e contra o arquivo tamanho de cada arquivo não no whitelist e alvo por analisando.
- "Compactado Arquivo Metadado Assinaturas" (metadata_*). Verificado contra o CRC32 hash eo arquivo tamanho do inicial arquivo contida dentro de cada compactado arquivo não no whitelist e alvo por analisando.
- "OLE Assinaturas" (ole_*). Verificado contra o conteúdo de cada objeto não no whitelist e alvo por analisando.
- "PDF Assinaturas" (pdf_*). Verificado contra o conteúdo de cada PDF arquivo não no whitelist.
- "Portátil Executável Seccional Assinaturas" (pe_*). Verificado contra o tamanho eo MD5 hash de cada PE seção de cada arquivo não em o whitelist e alvo por analisando e confirmados tal do formato PE.
- "Portátil Executável Estendidas Assinaturas" (pex_*). Verificado contra o tamanho eo MD5 hash de todas as variáveis de cada arquivo não em o whitelist e alvo por analisando e confirmados tal do formato PE.
- "SWF Assinaturas" (swf_*). Verificado contra o conteúdo de cada Shockwave arquivo não no whitelist.
- "Whitelist Assinaturas" (whitelist_*). Verificado contra o MD5 hash do conteúdo e contra o arquivo tamanho de cada arquivo alvo por analisando. Verificados arquivos será imune de sendo verificado pelo tipo de assinatura mencionada no seu whitelist entrada.
- "XML/XDP Assinaturas" (xmlxdp_*). Verificado contra quaisquer XML/XDP pedaços encontrados dentro cada arquivo não no whitelist e alvo por analisando.
(Notar que qualquer uma destas assinaturas podem ser desativada facilmente através de `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>CONHECIDOS COMPATIBILIDADE PROBLEMAS

####PHP e PCRE
- phpMussel requer PHP e PCRE para executar e funcionar corretamente. Sem PHP, ou sem a PCRE extensão do PHP, phpMussel não vai executará ou funcionar corretamente. Deve certificar-se de que seu sistema tenha PHP e PCRE instalado e disponível antes de baixar e instalar phpMussel.

####ANTI-VÍRUS SOFTWARE COMPATIBILIDADE

Em geral, phpMussel deve ser bastante compatível com a maioria dos outros vírus detecção softwares. Embora, conflitos foram relatadas por um número de utilizadores no passado. Esta informação abaixo é de VirusTotal.com, e descreve um número de falso-positivos relatados por vários anti-vírus programas contra phpMussel. Embora esta informação não é um absoluta garantia de haver ou não você vai encontrar problemas de compatibilidade entre phpMussel e seu anti-vírus software, se o seu anti-vírus software é conhecido como sinalização contra phpMussel, você deve considerar desativá-lo antes de trabalhar com phpMussel ou deve considerar alternativas opções para o seu anti-vírus software ou phpMussel.

Esta informação foi atualizada dia 25 Fevereiro 2016 e é corrente para todas phpMussel lançamentos das duas mais recentes menores versões (v0.9.0-v0.10.0) no momento de escrever este.

| Analisador           |  Resultados                          |
|----------------------|--------------------------------------|
| Ad-Aware             |  Não apresentou problemas            |
| AegisLab             |  Não apresentou problemas            |
| Agnitum              |  Não apresentou problemas            |
| AhnLab-V3            |  Não apresentou problemas            |
| Alibaba              |  Não apresentou problemas            |
| ALYac                |  Não apresentou problemas            |
| AntiVir              |  Não apresentou problemas            |
| Antiy-AVL            |  Não apresentou problemas            |
| Arcabit              |  Não apresentou problemas            |
| Avast                |  Reportar "JS:ScriptSH-inf [Trj]"    |
| AVG                  |  Não apresentou problemas            |
| Avira                |  Não apresentou problemas            |
| AVware               |  Não apresentou problemas            |
| Baidu-International  |  Não apresentou problemas            |
| BitDefender          |  Não apresentou problemas            |
| Bkav                 |  Reportar "VEXC640.Webshell" e "VEXD737.Webshell"|
| ByteHero             |  Não apresentou problemas            |
| CAT-QuickHeal        |  Não apresentou problemas            |
| ClamAV               |  Não apresentou problemas            |
| CMC                  |  Não apresentou problemas            |
| Commtouch            |  Não apresentou problemas            |
| Comodo               |  Não apresentou problemas            |
| Cyren                |  Não apresentou problemas            |
| DrWeb                |  Não apresentou problemas            |
| Emsisoft             |  Não apresentou problemas            |
| ESET-NOD32           |  Não apresentou problemas            |
| F-Prot               |  Não apresentou problemas            |
| F-Secure             |  Não apresentou problemas            |
| Fortinet             |  Não apresentou problemas            |
| GData                |  Não apresentou problemas            |
| Ikarus               |  Não apresentou problemas            |
| Jiangmin             |  Não apresentou problemas            |
| K7AntiVirus          |  Não apresentou problemas            |
| K7GW                 |  Não apresentou problemas            |
| Kaspersky            |  Não apresentou problemas            |
| Kingsoft             |  Não apresentou problemas            |
| Malwarebytes         |  Não apresentou problemas            |
| McAfee               |  Reportar "New Script.c"             |
| McAfee-GW-Edition    |  Reportar "New Script.c"             |
| Microsoft            |  Não apresentou problemas            |
| MicroWorld-eScan     |  Não apresentou problemas            |
| NANO-Antivirus       |  Não apresentou problemas            |
| Norman               |  Não apresentou problemas            |
| nProtect             |  Não apresentou problemas            |
| Panda                |  Não apresentou problemas            |
| Qihoo-360            |  Não apresentou problemas            |
| Rising               |  Não apresentou problemas            |
| Sophos               |  Não apresentou problemas            |
| SUPERAntiSpyware     |  Não apresentou problemas            |
| Symantec             |  Não apresentou problemas            |
| Tencent              |  Não apresentou problemas            |
| TheHacker            |  Não apresentou problemas            |
| TotalDefense         |  Não apresentou problemas            |
| TrendMicro           |  Não apresentou problemas            |
| TrendMicro-HouseCall |  Não apresentou problemas            |
| VBA32                |  Não apresentou problemas            |
| VIPRE                |  Não apresentou problemas            |
| ViRobot              |  Não apresentou problemas            |
| Zillya               |  Não apresentou problemas            |
| Zoner                |  Não apresentou problemas            |

---


Última Atualização: 25 Fevereiro 2016 (2016.02.25).
