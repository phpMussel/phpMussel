## Documentação para phpMussel (Português).

### Conteúdo
- 1. [PREÂMBULO](#SECTION1)
- 2A. [COMO INSTALAR (PARA WEB SERVIDORES)](#SECTION2A)
- 2B. [COMO INSTALAR (PARA CLI)](#SECTION2B)
- 3A. [COMO USAR (PARA WEB SERVIDORES)](#SECTION3A)
- 3B. [COMO USAR (PARA CLI)](#SECTION3B)
- 4. [GESTÃO DE FRONT-END](#SECTION4)
- 5. [CLI (COMANDO LINHA INTERFACE)](#SECTION5)
- 6. [ARQUIVOS INCLUÍDOS NESTE PACOTE](#SECTION6)
- 7. [OPÇÕES DE CONFIGURAÇÃO](#SECTION7)
- 8. [FORMATOS DE ASSINATURAS](#SECTION8)
- 9. [PROBLEMAS DE COMPATIBILIDADE CONHECIDOS](#SECTION9)
- 10. [PERGUNTAS MAIS FREQUENTES (FAQ)](#SECTION10)

*Nota relativa às traduções: Em caso de erros (por exemplo, discrepâncias entre as traduções, erros de digitação, etc), a versão em inglês do README é considerada a versão original e autorizada. Se você encontrar algum erro, sua ajuda em corrigi-los seria bem-vinda.*

---


###1. <a name="SECTION1"></a>PREÂMBULO

Obrigado por usar phpMussel, um PHP script projetado para detectar trojans, vírus, malware e outras ameaças dentro dos arquivos enviados para o seu sistema onde quer que o script é enganchado, baseado nas assinaturas do ClamAV e outros.

PHPMUSSEL COPYRIGHT 2013 e além GNU/GPLv2 através do Caleb M (Maikuolan).

Este script é um software livre; você pode redistribuí-lo e/ou modificá-lo de acordo com os termos da GNU General Public License como publicada pela Free Software Foundation; tanto a versão 2 da Licença, ou (a sua escolha) qualquer versão posterior. Este script é distribuído na esperança que possa ser útil, mas SEM QUALQUER GARANTIA; sem mesmo a implícita garantia de COMERCIALIZAÇÃO ou ADEQUAÇÃO A UM DETERMINADO FIM. Consulte a GNU General Public License para obter mais detalhes, localizado no arquivo `LICENSE.txt` e disponível também em:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Um especial obrigado para [ClamAV](http://www.clamav.net/) por o projeto inspiração e para as assinaturas que este script utiliza, sem o qual, o script provavelmente não existiria, ou no melhor, seria de utilidade muito limitada.

Um especial obrigado para Sourceforge e GitHub por hospedar os arquivos do projeto, para [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) por hospedar os fóruns de discussão do phpMussel, e para os recursos adicionais de um número de assinaturas utilizados através do phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) e outros, e um especial obrigado a todos aqueles que apoiam o projeto, a qualquer outra pessoa que eu possa ter esquecido de mencionar, e para você, por usar o script.

Este documento e seu pacote associado pode ser baixado gratuitamente de:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>COMO INSTALAR (PARA WEB SERVIDORES)

Espero para agilizar este processo fazendo um instalador em algum momento não muito distante no futuro, mas até então, siga estas instruções para trabalhar phpMussel na maioria dos sistemas e CMS:

1) Por estar lendo isso, estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo em algum lugar em sua máquina local. A partir daqui, você vai querer determinar onde no seu host ou CMS pretende colocar esses conteúdos. Um diretório como `/public_html/phpmussel/` ou semelhante (porém, não importa qual você escolher, assumindo que é seguro e algo você esteja satisfeito com) será o suficiente. Antes de começar o upload, continue lendo.

2) Renomear `config.ini.RenameMe` para `config.ini` (localizado dentro `vault`), e opcionalmente (fortemente recomendado para usuários avançados, mas não recomendado para iniciantes ou para os inexperientes), abra-o (este arquivo contém todas as diretivas disponíveis para phpMussel; acima de cada opção deve ser um breve comentário descrevendo o que faz e para que serve). Ajuste essas opções de como lhe serve, conforme o que for apropriado para sua configuração específica. Salve o arquivo e feche.

3) Carregar os conteúdos (phpMussel e seus arquivos) para o diretório que você tinha decidido anteriormente (você não precisa dos arquivos `*.txt`/`*.md` inclusos, mas principalmente, você deve carregar tudo).

4) CHMOD o diretório `vault` para "755" (se houver problemas, você pode tentar "777"; embora isto é o menos seguro). O diretório principal que armazena o conteúdo (o que você escolheu anteriormente), geralmente, não precisa ser mexido, mas o CHMOD status deve ser verificado se você já teve problemas de permissões no passado no seu sistema (por padrão, deve ser algo como "755").

5) Em seguida, você vai precisar "enganchar" o phpMussel ao seu sistema ou CMS. Existem várias diferentes maneiras em que você pode "enganchar" scripts como phpMussel ao seu sistema ou CMS, mas o mais fácil é simplesmente incluir o script no início de um núcleo arquivo de seu sistema ou CMS (uma que vai geralmente sempre ser carregado quando alguém acessa qualquer página através de seu site) utilizando um comando `require` ou `include`. Normalmente, isso vai ser algo armazenado em um diretório como `/includes`, `/assets` ou `/functions`, e muitas vezes, ser nomeado algo como `init.php`, `common_functions.php`, `functions.php` ou semelhante. Você precisará determinar qual arquivo é para a sua situação; Se você encontrar dificuldades em determinar isso por si mesmo, para assistência, visite a página de problemas/issues phpMussel no Github ou os fóruns de suporte para phpMussel; É possível que eu ou outro usuário podem ter experiência com o CMS que você está usando (você precisa deixar-nos saber qual CMS você está usando), e assim, pode ser capaz de prestar alguma assistência neste domínio. Para fazer isso [usar `require` ou `include`], insira a seguinte linha de código para o início desse núcleo arquivo, substituindo a string contida dentro das aspas com o exato endereço do arquivo `loader.php` (endereço local, não o endereço HTTP; será semelhante ao vault endereço mencionado anteriormente).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Salve o arquivo, fechar, recarrega-lo.

-- OU ALTERNATIVAMENTE --

Se você é usando um Apache webserver e se você tem acesso a `php.ini`, você pode usar a diretiva `auto_prepend_file` para pré-carga phpMussel sempre que qualquer solicitação para PHP é feito. Algo como:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Ou isso no `.htaccess` arquivo:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar a proteção de upload de arquivo, tente carregar dos arquivos testes incluídos no pacote em `_testfiles` para seu site através de seu método habitual de upload no navegador. Se tudo estiver funcionando, a mensagem deve aparecer a partir phpMussel confirmando que o carregamento foi bloqueado com sucesso. Se nada aparecer, algo está não funcionando corretamente. Se você estiver usando quaisquer recursos avançados ou se você estiver usando outros tipos de analise possível da ferramenta, eu sugiro tentar isso com aqueles para certificar que funciona como esperado, também.

---


###2B. <a name="SECTION2B"></a>COMO INSTALAR (PARA CLI)

Espero para agilizar este processo via fazendo um instalador em algum momento no não muito distante no futuro, mas até então, siga estas instruções para obter phpMussel pronto para trabalhar com CLI (estar ciente, neste momento, CLI apoio só se aplica a sistemas baseados em Windows; Linux e outros sistemas será em breve para uma versão posterior do phpMussel):

1) Por estar lendo isso, estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo em algum lugar em sua máquina local. Quando você tiver determinado que você está feliz com a localização escolhida para o phpMussel, continue.

2) phpMussel requer PHP instalado na máquina host para poder executar. Se você não ainda tem PHP instalado em sua máquina, por favor instalar o PHP em sua máquina, seguindo as instruções fornecidas pelo instalador do PHP.

3) Opcionalmente (fortemente recomendado para avançados usuários, mas não recomendado para iniciantes ou para os inexperientes), abrir `config.ini` (localizado dentro `vault`) - Este arquivo contém todas as diretivas disponíveis para phpMussel. Acima de cada opção deve ter um breve comentário descrevendo o que faz e para que serve. Ajuste essas opções de como você vê o ajuste, conforme o que for apropriado para sua configuração específica. Salve o arquivo, feche.

4) Opcionalmente, você pode fazer usando phpMussel no modo CLI mais fácil para si mesmo através da criação de um batch arquivo para carregar automaticamente PHP e phpMussel. Para fazer isso, abra um editor de simples texto como Notepad ou Notepad++, digite o caminho completo para o arquivo `php.exe` no diretório de instalação do PHP, seguido por um espaço, seguido pelo caminho completo para o arquivo `loader.php` no diretório da sua instalação do phpMussel, salvar o arquivo com a extensão ".bat" Em algum lugar que você vai encontrá-lo facilmente, e clique duas vezes nesse arquivo para executar phpMussel no futuro.

5) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar phpMussel, executar phpMussel e tentar analisar o diretório `_testfiles` fornecida com o pacote.

---


###3A. <a name="SECTION3A"></a>COMO USAR (PARA WEB SERVIDORES)

phpMussel deve ser capaz de operar corretamente com requisitos mínimos sobre a sua parte: Após instalá-lo, ele deve funcionar imediatamente e ser imediatamente utilizável.

Análise dos arquivos carregados via upload é automatizado e ativado por padrão, por isso nada é exigido de você por essa função particular.

Porém, você também é capaz de instruir phpMussel para verificar arquivos e/ou diretórios específicos. Para fazer isso, em primeiro lugar, você vai precisar assegurar que a configuração apropriada é definida no arquivo `config.ini` (`cleanup` deve ser desativado), e quando feito, em um arquivo PHP que está enganchado ao phpMussel, usar a seguinte função no seu código:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` pode ser uma string, um matriz, ou um matriz de matrizes, e indica qual arquivo, arquivos, diretório e/ou diretórios para analisar.
- `$output_type` é um booleano, indicando o formato para os resultados da verificação a serem retornados. False/Falso instrui a função para retornar resultados como um número inteiro (um resultado retornado de -3 indica problemas foram encontrados com o phpMussel arquivos de assinaturas ou arquivos de mapas de assinaturas e que eles podem possívelmente estar ausente ou corrompido, -2 indica que dados corrompidos foram detectados durante a análise, e portanto, a análise não foi concluída, -1 indica que extensões ou complementos necessários pelo PHP para executar a análise estavam faltando, e portanto, a análise não foi concluída, 0 indica que o alvo de análise não existe, e portanto, havia nada para verificar, 1 indica que o alvo foi analisado e não foram detectados problemas, e 2 indica que o alvo foi analisado e problemas foram detectados). True/Verdadeiro instrui a função para retornar os resultados como texto legível. Adicionalmente, em ambos os casos, os resultados podem ser acessados através de variáveis globais após o análise já concluída. Esta variável é opcional, definida como false/falso por padrão.
- `$output_flatness` é um booleano, indicando para a função ou retornar os resultados de análise (quando há vários alvos para analisando) como uma matriz ou uma string. False/Falso irá retornar os resultados como uma matriz. True/Verdadeiro irá retornar os resultados como uma string. Esta variável é opcional, definida como false/falso por padrão.

Exemplos:

```
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Retorna algo tal como esta (como uma string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Começado.
 > Verificação '/user_name/public_html/my_file.html':
 -> Não problemas encontrados.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminado.
```

Por completos detalhes sobre que tipo de assinaturas phpMussel usa durante a análise e como ele usa essas assinaturas, consulte a formatos de assinaturas seção deste arquivo README.

Se você encontrar quaisquer falsos positivos, se você encontrar algo novo que você acha deve ser bloqueado, ou para qualquer outra coisa com relação a assinatura, entre em contato comigo sobre isso para que eu possa fazer as mudanças necessárias, que, se você não entrar em contato comigo, eu posso não ser necessariamente conscientes de.

Para desativar as assinaturas que estão incluídos com phpMussel (tal como se você está experimentando falsos positivos específico para seus fins que não deve normalmente ser removidos da agilize), consulte as notas sobre Greylisting dentro de seção GESTÃO DE FRONT-END deste arquivo README.

---


###3B. <a name="SECTION3B"></a>COMO USAR (PARA CLI)

Por favor, consulte a seção "COMO INSTALAR (PARA CLI)" deste arquivo README.

Esteja ciente de que, embora versões futuras do phpMussel devem suportar outros sistemas, neste momento, phpMussel modo CLI o suporte só é otimizado para uso em sistemas baseados no Windows (você pode, é claro, experimentá-lo em outros sistemas, mas eu não posso garantir que vai funcionar como pretendido).

Também estar ciente de que phpMussel é um scanner *on-demand*; *NÃO* é um scanner *on-access* (exceto para o carregamento de arquivos, no momento de carregamento), e ao contrário de antivírus suítes convencionais, não monitora memória ativa! Ele só vai detectar vírus contidos pelo carregamento de arquivos, e por esses arquivos específicos que você explicitamente diga a ele analisar.

---


###4. <a name="SECTION4"></a>GESTÃO DE FRONT-END

@TODO@

---


###5. <a name="SECTION5"></a>CLI (COMANDO LINHA INTERFACE)

phpMussel pode ser executado como um interativo analisador de arquivo no modo CLI em sistemas baseados em Windows. Por favor, consulte a seção "COMO INSTALAR (PARA CLI)" deste arquivo README para mais detalhes.

Para uma lista de comandos disponíveis Em CLI, no CLI prompt, digite 'c', e pressione Enter.

Além disso, para os interessados, um tutorial em vídeo para saber como usar phpMussel no modo CLI está disponível aqui:
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


###6. <a name="SECTION6"></a>ARQUIVOS INCLUÍDOS NESTE PACOTE

A seguir está uma lista de todos os arquivos que deveriam ter sido incluídos na cópia arquivada desse script quando você baixá-lo, todos os arquivos que podem ser potencialmente criados como resultado de seu uso deste script, juntamente com uma breve descrição do que todos esses arquivos são.

Arquivo | Descrição
----|----
/_docs/ | Documentação diretório (contém vários arquivos).
/_docs/readme.ar.md | Documentação Árabe.
/_docs/readme.de.md | Documentação Alemão.
/_docs/readme.en.md | Documentação Inglês.
/_docs/readme.es.md | Documentação Espanhol.
/_docs/readme.fr.md | Documentação Francesa.
/_docs/readme.id.md | Documentação Indonésio.
/_docs/readme.it.md | Documentação Italiano.
/_docs/readme.ja.md | Documentação Japonesa.
/_docs/readme.nl.md | Documentação Holandês.
/_docs/readme.pt.md | Documentação Português.
/_docs/readme.ru.md | Documentação Russo.
/_docs/readme.vi.md | Documentação Vietnamita.
/_docs/readme.zh-TW.md | Documentação Chinês (tradicional).
/_docs/readme.zh.md | Documentação Chinês (simplificado).
/_testfiles/ | Diretório de arquivos de teste (contém vários arquivos). Todos os arquivos contidos são arquivos teste para testar se phpMussel foi instalado corretamente no seu sistema, e você não precisa carregar desse diretório ou quaisquer de seus arquivos, exceto ao fazer tais testes.
/_testfiles/ascii_standard_testfile.txt | Arquivo teste para testar phpMussel assinaturas normalizadas ASCII.
/_testfiles/coex_testfile.rtf | Arquivo teste para testar phpMussel assinaturas complexas estendidas.
/_testfiles/exe_standard_testfile.exe | Arquivo teste para testar phpMussel PE assinaturas.
/_testfiles/general_standard_testfile.txt | Arquivo teste para testar phpMussel gerais assinaturas.
/_testfiles/graphics_standard_testfile.gif | Arquivo teste para testar phpMussel gráficas assinaturas.
/_testfiles/html_standard_testfile.html | Arquivo teste para testar phpMussel normalizada HTML assinaturas.
/_testfiles/md5_testfile.txt | Arquivo teste para testar phpMussel MD5 assinaturas.
/_testfiles/ole_testfile.ole | Teste arquivo para testar phpMussel OLE assinaturas.
/_testfiles/pdf_standard_testfile.pdf | Arquivo teste para testar phpMussel PDF assinaturas.
/_testfiles/pe_sectional_testfile.exe | Arquivo teste para testar phpMussel PE Seccional assinaturas.
/_testfiles/swf_standard_testfile.swf | Arquivo teste para testar phpMussel SWF assinaturas.
/vault/ | Vault diretório (contém vários arquivos).
/vault/cache/ | Cache diretório (para dados temporários).
/vault/cache/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/fe_assets/ | Dados front-end.
/vault/fe_assets/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/fe_assets/_accounts.html | Um modelo HTML para o front-end página de contas.
/vault/fe_assets/_accounts_row.html | Um modelo HTML para o front-end página de contas.
/vault/fe_assets/_config.html | Um modelo HTML para o front-end página de configuração.
/vault/fe_assets/_files.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_edit.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_rename.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_row.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_home.html | Um modelo HTML para o front-end página principal.
/vault/fe_assets/_login.html | Um modelo HTML para o front-end página login.
/vault/fe_assets/_logs.html | Um modelo HTML para o front-end página para os arquivos de registro.
/vault/fe_assets/_nav_complete_access.html | Um modelo HTML para os links de navegação para o front-end, para aqueles com acesso completo.
/vault/fe_assets/_nav_logs_access_only.html | Um modelo HTML para os links de navegação para o front-end, para aqueles com acesso aos arquivos de registro somente.
/vault/fe_assets/_updates.html | Um modelo HTML para o front-end página de atualizações.
/vault/fe_assets/_updates_row.html | Um modelo HTML para o front-end página de atualizações.
/vault/fe_assets/_upload_test.html | Um modelo HTML para o página de carregar teste.
/vault/fe_assets/frontend.css | Folha de estilo CSS para o front-end.
/vault/fe_assets/frontend.dat | Banco de dados para o front-end (contém informações de contas e sessões; gerado só se o front-end está habilitado e usado).
/vault/fe_assets/frontend.html | O arquivo modelo HTML principal para o front-end.
/vault/lang/ | Contém linguagem dados.
/vault/lang/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/lang/lang.ar.fe.php | Linguagem dados Árabe para o front-end.
/vault/lang/lang.ar.php | Linguagem dados Árabe.
/vault/lang/lang.de.fe.php | Linguagem dados Alemão para o front-end.
/vault/lang/lang.de.php | Linguagem dados Alemão.
/vault/lang/lang.en.fe.php | Linguagem dados Inglês para o front-end.
/vault/lang/lang.en.php | Linguagem dados Inglês.
/vault/lang/lang.es.fe.php | Linguagem dados Espanhol para o front-end.
/vault/lang/lang.es.php | Linguagem dados Espanhol.
/vault/lang/lang.fr.fe.php | Linguagem dados Francesa para o front-end.
/vault/lang/lang.fr.php | Linguagem dados Francesa.
/vault/lang/lang.id.fe.php | Linguagem dados Indonésio para o front-end.
/vault/lang/lang.id.php | Linguagem dados Indonésio.
/vault/lang/lang.it.fe.php | Linguagem dados Italiano para o front-end.
/vault/lang/lang.it.php | Linguagem dados Italiano.
/vault/lang/lang.ja.fe.php | Linguagem dados Japonês para o front-end.
/vault/lang/lang.ja.php | Linguagem dados Japonês.
/vault/lang/lang.nl.fe.php | Linguagem dados Holandês para o front-end.
/vault/lang/lang.nl.php | Linguagem dados Holandês.
/vault/lang/lang.pt.fe.php | Linguagem dados Português para o front-end.
/vault/lang/lang.pt.php | Linguagem dados Português.
/vault/lang/lang.ru.fe.php | Linguagem dados Russo para o front-end.
/vault/lang/lang.ru.php | Linguagem dados Russo.
/vault/lang/lang.vi.fe.php | Linguagem dados Vietnamita para o front-end.
/vault/lang/lang.vi.php | Linguagem dados Vietnamita.
/vault/lang/lang.zh-tw.fe.php | Linguagem dados Chinês (tradicional) para o front-end.
/vault/lang/lang.zh-tw.php | Linguagem dados Chinês (tradicional).
/vault/lang/lang.zh.fe.php | Linguagem dados Chinês (simplificado) para o front-end.
/vault/lang/lang.zh.php | Linguagem dados Chinês (simplificado).
/vault/quarantine/ | Diretório de quarentena (contém os arquivos em quarentena).
/vault/quarantine/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/signatures/ | Diretório de assinaturas (contém ficheiros de assinaturas).
/vault/signatures/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/signatures/hex_general_commands.csv | Hex-codificado CSV de geral comando detecções opcionalmente usado por phpMussel.
/vault/signatures/switch.dat | Isto controla e define algumas variáveis.
/vault/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/cli.php | Módulo de CLI.
/vault/components.dat | Contém informações relativas aos vários componentes de phpMussel; Usado pelo recurso atualizações fornecidas pelo front-end.
/vault/config.ini.RenameMe | Arquivo de configuração; Contém todas as opções de configuração para phpMussel, dizendo-lhe o que fazer e como operar corretamente (renomear para ativar).
/vault/config.php | Módulo de configuração.
/vault/frontend.php | Módulo do front-end.
/vault/functions.php | Arquivo de funções.
/vault/greylist.csv | CSV de greylisted assinaturas indicando a phpMussel quais assinaturas deve ser ignorado (arquivo automaticamente recriado se deletado).
/vault/lang.php | Linguagem dados.
/vault/php5.4.x.php | Polyfills para PHP 5.4.X (necessário para compatibilidade reversa com PHP 5.4.X; seguro para deletar por versões de PHP mais recentes).
※ /vault/scan_kills.txt | Um registro de tudos os arquivos carregamentos bloqueado ou matado por phpMussel.
※ /vault/scan_log.txt | Um registro de tudo analisado por phpMussel.
※ /vault/scan_log_serialized.txt | Um registro de tudo analisado por phpMussel.
/vault/template.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/template_custom.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/upload.php | Módulo de carregamento.
/.gitattributes | Um arquivo do GitHub projeto (não é necessário para o correto funcionamento do script).
/Changelog-v1.txt | Um registro das mudanças feitas para o script entre o diferentes versões (não é necessário para o correto funcionamento do script).
/composer.json | Composer/Packagist informação (não é necessário para o correto funcionamento do script).
/CONTRIBUTING.md | Informações sobre como contribuir para o projeto.
/LICENSE.txt | Uma cópia da GNU/GPLv2 licença (não é necessário para o correto funcionamento do script).
/loader.php | O carregador. Isto é o que você deveria ser enganchando em (essencial)!
/PEOPLE.md | Informações sobre as pessoas envolvidas no projeto.
/README.md | Informações do projeto em sumário.
/web.config | Um arquivo de configuração para ASP.NET (neste caso, para protegendo o`/vault` diretório contra serem acessado por fontes não autorizadas em caso que o script está instalado em um servidor baseado em ASP.NET tecnologias).

※ Nome de arquivos podem variar baseado em estipulações de configuração (referem-se a `config.ini`).

---


###7. <a name="SECTION7"></a>OPÇÕES DE CONFIGURAÇÃO
O seguinte é uma lista de variáveis encontradas no `config.ini` arquivo de configuração para phpMussel, juntamente com uma descrição de sua propósito e função.

####"general" (Categoria)
Configuração geral por phpMussel.

"cleanup"
- Deletar script variáveis e cache após a execução? False = Não; True = Sim [Padrão]. Se você não estiver usar o script além da inicial verificação de carregamentos, deve definir a `true` (sim), para minimizar o uso de memória. Se você estiver usar o script por fins além da inicial verificação de carregamentos, deve definir a `false` (não), para evitar desnecessariamente duplicados dados recarregando em memória. Em prática geral, deve provavelmente ser definido como `true` (sim), mas, se você fizer isso, você não será capaz de usando o script por qualquer outra fim além analisando arquivos carregamentos.
- Não tem influência em CLI modo.

"scan_log"
- Nome do arquivo para registrar todos os resultados do análises. Especifique um arquivo nome, ou deixe branco para desativar.

"scan_log_serialized"
- Nome do arquivo para registrar todos os resultados do análises (formato é serializado). Especifique um arquivo nome, ou deixe branco para desativar.

"scan_kills"
- Nome do arquivo para registrar todos os bloqueados ou matados carregamentos. Especifique um arquivo nome, ou deixe branco para desativar.

*Dica útil: Se você quiser, você pode acrescentar informações tempo/hora aos nomes dos seus arquivos de registro através incluir estas em nome: `{yyyy}` para o ano completo, `{yy}` para o ano abreviado, `{mm}` por mês, `{dd}` por dia, `{hh}` por hora.*

*Exemplos:*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"timeOffset"
- Se o tempo do servidor não coincide com sua hora local, você pode especificar aqui um offset para ajustar as informações de data/tempo gerado por phpMussel de acordo com as suas necessidades. É geralmente recomendado no lugar para ajustar a directiva fuso horário no seu arquivo `php.ini`, mas às vezes (tais como quando se trabalha com provedores de hospedagem compartilhada e limitados) isto não é sempre possível fazer, e entao, esta opção é fornecido aqui. Offset é em minutos.
- Exemplo (para adicionar uma hora): `timeOffset=60`

"ipaddr"
- Onde encontrar o IP endereço das solicitações? (Útil por serviços como o Cloudflare e tal) Padrão = REMOTE_ADDR. ATENÇÃO: Não mude isso a menos que você saiba o que está fazendo!

"enable_plugins"
- Ativar o suporte para os plugins do phpMussel? False = Não; True = Sim [Padrão].

"forbid_on_block"
- Deve phpMussel enviar 403 header com a bloqueado arquivo carregamento mensagem, ou ficar com os habituais 200 OK? False = Não (200); True = Sim (403) [Padrão].

"delete_on_sight"
- Ativando esta opção irá instruir o script para tentar imediatamente deletando qualquer arquivo que ele encontra durante a análise que corresponde a qualquer critério de detecção, quer seja através de assinaturas ou de outra forma. Arquivos determinados para ser "limpo" não serão tocados. Em caso de compactados arquivos, o inteiro arquivo será deletado (independentemente de se o problemático arquivo é apenas um dos vários arquivos contidos dentro do compactado arquivo). Para o caso de arquivo carregamento análise, em geral, não é necessário ativar essa opção, porque normalmente, PHP irá automaticamente expurgar os conteúdos de o seu cache quando a execução foi concluída, significando que ele vai normalmente deletar todos os arquivos enviados através dele para o servidor a menos que tenha movido, copiado ou deletado já. A opção é adicionado aqui como uma medida de segurança para aqueles cujas cópias de PHP nem sempre se comportam da forma esperada. False = Após a análise, deixe o arquivo sozinho [Padrão]; True = Após a análise, se não limpo, deletar imediatamente.

"lang"
- Especificar o padrão da linguagem por phpMussel.

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

"disable_frontend"
- Desativar o acesso front-end? Acesso front-end pode fazer phpMussel mais manejável, mas também pode ser um risco de segurança potencial, também. É recomendado para gerenciar phpMussel através do back-end, sempre que possível, mas o acesso front-end é proporcionada para quando não é possível. Mantê-lo desativado, a menos que você precisar. False = Ativar o acesso front-end; True = Desativar o acesso front-end [Padrão].

"max_login_attempts"
- Número máximo de tentativas de login (front-end). Padrão = 5.

"FrontEndLog"
- Arquivo para registrar tentativas de login ao front-end. Especifique o nome de um arquivo, ou deixe em branco para desabilitar.

####"signatures" (Categoria)
Configuração por assinaturas.

"Filename"
- Verificar arquivos nomes contra assinaturas arquivos nomes baseadas assinaturas quando analisando? Nesse caso, especifique os nomes dos arquivos de assinaturas a serem utilizados, delimitados por vírgulas.

"MD5"
- Verificar contra MD5 assinaturas quando analisando? Nesse caso, especifique os nomes dos arquivos de assinaturas a serem utilizados, delimitados por vírgulas.

"PE_Sectional"
- Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE Seccional assinaturas quando analisando? Nesse caso, especifique os nomes dos arquivos de assinaturas a serem utilizados, delimitados por vírgulas.

"PE_Extended"
- Verificar PE (Portátil Executável) arquivos (EXE, DLL, etc) contra PE estendidas assinaturas quando analisando? Nesse caso, especifique os nomes dos arquivos de assinaturas a serem utilizados, delimitados por vírgulas.

Ativar arquivo-específico whitelist? False = Não; True = Sim [Padrão].
- "whitelist_clamav"
- "whitelist_mussel"

Verificar contra complexos estendidas assinaturas quando analisando? False = Não; True = Sim [Padrão].
- "coex_clamav"
- "coex_mussel"

"fail_silently"
- Deve phpMussel reportar quando os assinaturas arquivos estão perdido ou corrompido? Se `fail_silently` está desativado, perdidos e corrompidos arquivos serão reportado durante análise, e se `fail_silently` está ativado, perdidos e corrompidos arquivos serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Isso geralmente deve ser deixado sozinho a menos que você está experimentando PHP falhas ou semelhantes problemas. False = Desativado; True = Ativado [Padrão].

"fail_extensions_silently"
- Deve phpMussel reportar quando extensões não estão disponíveis? Se `fail_extensions_silently` está desativado, extensões indisponíveis serão reportado durante análise, e se `fail_extensions_silently` está ativado, extensões indisponíveis serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Desativando dessa directiva pode potencialmente aumentar a sua segurança, mas também pode levar a um aumento de falsos positivos. False = Desativado; True = Ativado [Padrão].

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
Configuração geral por a manipulação de arquivos.

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
- Neste momento, os únicos formatos suportados são BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR e ZIP (os formatos RAR, CAB, 7z e etc. não suportadas neste momento).
- Este não é infalível! Embora eu recomendo mantê-lo ativado, eu não posso garantir que sempre vai encontrar tudo.
- Também estar ciente de que a verificação do compactados arquivos, neste momento, não é recursiva por PHAR ou ZIP arquivos.

"filesize_archives"
- Herdar o arquivo tamanho blacklist/whitelist para o conteúdo de compactados arquivos? False = Não (greylist tudo); True = Sim [Padrão].

"filetype_archives"
- Herdar o arquivo tipo blacklist/whitelist para o conteúdo de compactados arquivos? False = Não (greylist tudo); True = Sim [Padrão].

"max_recursion"
- Máxima recursão profundidade limite por compactados arquivos. Padrão = 10.

"block_encrypted_archives"
- Detectar e bloquear compactados arquivos criptografados? Porque phpMussel não é capaz de analisar o conteúdo de arquivos criptografados, é possível que a criptografia de arquivo pode ser empregado por um atacante como meio de tentar contornar phpMussel, analisadores anti-vírus e outras dessas protecções. Instruindo phpMussel para bloquear quaisquer arquivos que ele descobrir a ser criptografada poderia ajudar a reduzir o risco associado a essas tais possibilidades. False = Não; True = Sim [Padrão].

####"attack_specific" (Categoria)
Configuração por específicas ataque detecções.

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

"archive_file_extensions"
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
- Opcional limitação para o comprimento dos brutos dados para que phpMussel é permitido a ler e analisar (em caso de existirem quaisquer notável problemas de desempenho enquanto analisando). Valor é um inteiro que representa tamanho do arquivo Em KB. Padrão = 32768 (32MB). Zero ou nulo valor desativa o limitação. Em geral, esse valor não deve ser menor que o médio arquivo tamanho de carregamentos que você quer e espera para receber no seu servidor ou website, não deve ser mais que o filesize_limit directivo, e não deve ser menor que aproximadamente um quinto do total permissível memória alocação concedido para PHP através do `php.ini` configuração arquivo. Esta directiva existe para tentar impedir phpMussel de usando demais memória (que seria impedir-lo de ser capaz de analisando arquivos acima de um certo tamanho com sucesso).

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

Notar: Se a verificação de arquivos usando o Virus Total de API está desativado, você não será necessitar de rever alguma das directivas nesta categoria (`virustotal`), porque eles não vão fazer nada se este é desativado. Para adquirir um Virus Total API chave, desde qualquer lugar em seu site, clique no "Junte-se à comunidade" link situado próximo ao superior direita da página, digitar as informações solicitadas, e clique em "Cadastrar" quando acabado. Siga todas as instruções fornecidas, e quando você tem a sua pública API chave, copiar/colar essa pública API chave ao `vt_public_api_key` directiva do `config.ini` configuração arquivo.

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
- Construído em phpMussel é um URL analisador, capaz de detectar URLs maliciosos dentro de todos os dados ou arquivos analisados. Para habilitar o URL analisador, especifique os nomes dos arquivos de assinaturas a serem utilizados, delimitados por vírgulas.

Notar: Se o URL analisador é desativado, você não terá que rever alguma das directivas nesta categoria (`urlscanner`), porque nenhum deles fará de tudo se este é desativado.

URL analisador API uso configuração.

"lookup_hphosts"
- Permite o uso do [hpHosts](http://hosts-file.net/) API quando definido para true. hpHosts não requer uma API chave para o uso de sua API.

"google_api_key"
- Permite o uso do Google Safe Browsing API quando a API chave necessária está definida. Para o uso de sua API, Google Safe Browsing API requerer uma API chave, que pode ser obtido a partir de [Aqui](https://console.developers.google.com/).
- Notar: A extensão cURL é necessária a fim de usar este recurso.

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


###8. <a name="SECTION8"></a>FORMATOS DE ASSINATURAS

####*ARQUIVO NOME ASSINATURAS*
Todas as arquivo nome assinaturas seguir o formato:

`NOME:FNRX`

Onde NOME é o nome para citar por essa assinatura e FNRX é o regex para verificar arquivos nomes (não codificados) contra.

####*MD5 ASSINATURAS*
Todas as MD5 assinaturas seguir o formato:

`HASH:TAMANHO:NOME`

Onde HASH é o hash MD5 de um inteiro arquivo, TAMANHO é o total tamanho do arquivo e NOME é o nome para citar por essa assinatura.

####*PE SECCIONAL ASSINATURAS*
Todas as PE Seccional assinaturas seguir o formato:

`TAMANHO:HASH:NOME`

Onde HASH é o hash MD5 de uma secção do PE arquivo, TAMANHO é o total tamanho da secção e NOME é o nome para citar por essa assinatura.

####*PE ESTENDIDAS ASSINATURAS*
Todas as PE estendidas assinaturas seguir o formato:

`$VAR:HASH:TAMANHO:NOME`

Onde $VAR é o nome da PE variável para verificar contra, HASH é o MD5 dessa variável, TAMANHO é o tamanho total dessa variável e NOME é o nome para citar por essa assinatura.

####*WHITELIST ASSINATURAS*
Todas as Whitelist assinaturas seguir o formato:

`HASH:TAMANHO:TYPE`

Onde HASH é o hash MD5 de um inteiro arquivo, TAMANHO é o total tamanho do arquivo e TYPE é o tipo de assinaturas o arquivo é ser imune contra.

####*COMPLEXOS ESTENDIDAS ASSINATURAS*
Complexos estendidas assinaturas são bastante diferente para os outros tipos de assinaturas possíveis com phpMussel em que o que eles estão verificando contra é especificado pelas assinaturas e eles podem verificar contra vários critérios. Os critérios de verificação são delimitados por ";" e o verificação tipo e os verificação dados de cada verificação critérios é delimitados por ":" como assim que o formato por estas assinaturas tende a olhar um pouco assim:

`$variável1:ALGUNSDADOS;$variável2:ALGUNSDADOS;AssinaturaNome`

####*TODAS OUTRAS*
Todas as outras assinaturas seguir o formato:

`NOME:HEX:FROM:TO`

Onde NOME é o nome para citar por essa assinatura e HEX é um hexadecimal codificado segmento do arquivo intentado a ser correspondido pela dado assinatura. TO e FROM são opcionais parâmetros, indicando de onde e para quais posições nos origem dados para verificar contra.

####*REGEX*
Qualquer forma de regex compreendido e processado corretamente pelo PHP também deve ser correctamente compreendido e processado por phpMussel e suas assinaturas. Mas, eu sugiro tomar extremo cuidado quando escrevendo novas assinaturas baseadas regex, porque, se você não está inteiramente certo do que está fazendo, isto pode tem altamente irregulares e inesperadas resultados. Olha para o código-fonte de phpMussel Se você não está totalmente certo sobre o contexto em que as regex declarações são processada. Além, lembre-se que todos isso (com exceção para arquivo nome, compactado arquivo metadados, MD5 a sintaxe) deve ser codificado hexadecimalmente!

####*ONDE COLOCAR PERSONALIZADAS ASSINATURAS?*

####*ASSINATURA COMPOSIÇÃO*
A seguir estão os diferentes tipos de assinaturas utilizadas por phpMussel:
- "Assinaturas ASCII normalizadas". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando.
- "Assinaturas estendidos complexos". Misto tipo de assinatura verificando.
- "Assinaturas ELF". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato ELF.
- "Assinaturas portátil executável". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato PE.
- "Assinaturas baseadas em nomes de arquivos". Verificado contra os nomes de cada arquivo não no whitelist e alvo por analisando.
- "Assinaturas gerais". Verificado contra o conteúdo de arquivo não no whitelist e alvo por analisando.
- "Assinaturas gráficas". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmado tal de um conhecidos gráficos arquivos formato.
- "Gerais comandos". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando.
- "Assinaturas HTML normalizadas". Verificado contra o conteúdo de cada arquivo HTML não no whitelist e alvo por analisando.
- "Assinaturas Mach-O". Verificado contra o conteúdo de cada arquivo não no whitelist e alvo por analisando e confirmados tal do formato Mach-O.
- "Assinaturas E-mail". Verificado contra o conteúdo de cada arquivo EML não no whitelist.
- "Assinaturas MD5". Verificado contra o hash MD5 do conteúdo e contra o arquivo tamanho de cada arquivo não no whitelist e alvo por analisando.
- "Assinaturas OLE". Verificado contra o conteúdo de cada objeto não no whitelist e alvo por analisando.
- "Assinaturas PDF". Verificado contra o conteúdo de cada arquivo PDF não no whitelist.
- "Assinaturas portátil executável seccional". Verificado contra o tamanho eo hash MD5 de cada PE seção de cada arquivo não em o whitelist e alvo por analisando e confirmados tal do formato PE.
- "Assinaturas portátil executável estendidas". Verificado contra o tamanho eo hash MD5 de todas as variáveis de cada arquivo não em o whitelist e alvo por analisando e confirmados tal do formato PE.
- "Assinaturas SWF". Verificado contra o conteúdo de cada Shockwave arquivo não no whitelist.
- "Assinaturas whitelist". Verificado contra o hash MD5 do conteúdo e contra o arquivo tamanho de cada arquivo alvo por analisando. Verificados arquivos será imune de sendo verificado pelo tipo de assinatura mencionada no seu whitelist entrada.
(Notar que qualquer uma destas assinaturas podem ser desativada facilmente através de `config.ini`).

---


###9. <a name="SECTION9"></a>CONHECIDOS COMPATIBILIDADE PROBLEMAS

####PHP e PCRE
- phpMussel requer PHP e PCRE para executar e funcionar corretamente. Sem PHP, ou sem a PCRE extensão do PHP, phpMussel não vai executará ou funcionar corretamente. Deve certificar-se de que seu sistema tenha PHP e PCRE instalado e disponível antes de baixar e instalar phpMussel.

####ANTI-VÍRUS SOFTWARE COMPATIBILIDADE

Em geral, phpMussel deve ser bastante compatível com a maioria dos outros vírus detecção softwares. Embora, conflitos foram relatadas por um número de utilizadores no passado. Esta informação abaixo é de VirusTotal.com, e descreve um número de falso-positivos relatados por vários anti-vírus programas contra phpMussel. Embora esta informação não é um absoluta garantia de haver ou não você vai encontrar problemas de compatibilidade entre phpMussel e seu anti-vírus software, se o seu anti-vírus software é conhecido como sinalização contra phpMussel, você deve considerar desativá-lo antes de trabalhar com phpMussel ou deve considerar alternativas opções para o seu anti-vírus software ou phpMussel.

Esta informação foi atualizada dia 29 Agosto 2016 e é corrente para todas phpMussel lançamentos das duas mais recentes menores versões (v0.10.0-v1.0.0) no momento de escrever este.

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
| Baidu                |  Reportar "VBS.Trojan.VBSWG.a"       |
| Baidu-International  |  Não apresentou problemas            |
| BitDefender          |  Não apresentou problemas            |
| Bkav                 |  Reportar "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell", "VEXEFFC.Webshell"|
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


###10. <a name="SECTION10"></a>PERGUNTAS MAIS FREQUENTES (FAQ)

####O que é um "falso positivo"?

O termo "falso positivo" (*alternativamente: "erro de falso positivo"; "alarme falso"*; Inglês: *false positive*; *false positive error*; *false alarm*), descrita de maneira muito simples, e num contexto generalizado, são usadas quando testando para uma condição, para se referir aos resultados desse teste, quando os resultados são positivos (isto é, a condição é determinada para ser "positivo", ou "verdadeiro"), mas espera-se que seja (ou deveria ter sido) negativo (isto é, a condição, na realidade, é "negativo", ou "falso"). Um "falso positivo" pode ser considerado análogo ao "chorando lobo" (em que a condição que está sendo testada é se existe um lobo perto do rebanho, a condição é "falso" em que não há nenhum lobo perto do rebanho, ea condição é relatada como "positivo" pelo pastor por meio de gritando "lobo, lobo"), ou análoga a situações em exames médicos em que um paciente é diagnosticado como tendo alguma doença quando, na realidade, eles não têm essa doença.

Os resultados relacionados a quando testando para uma condição pode ser descrito usando os termos "verdadeiro positivo", "verdadeiro negativo" e "falso negativo". Um "verdadeiro positivo" refere-se a quando os resultados do teste ea real situação da condição são ambos verdadeiros (ou "positivos"), e um "verdadeiro negativo" refere-se a quando os resultados do teste ea real situação da condição são ambos falsos (ou "negativos"); Um "verdadeiro positivo" ou um "verdadeiro negativo" é considerado como sendo uma "inferência correcta". A antítese de um "falso positivo" é um "falso negativo"; Um "falso negativo" refere-se a quando os resultados do teste are negativo (isto é, a condição é determinada para ser "negativo", ou "falso"), mas espera-se que seja (ou deveria ter sido) positivo (isto é, a condição, na realidade, é "positivo", ou "verdadeiro").

No contexto da phpMussel, estes termos referem-se as assinaturas de phpMussel e os arquivos que eles bloqueiam. Quando phpMussel bloquear um arquivo devido ao mau, desatualizados ou incorretos assinatura, mas não deveria ter feito isso, ou quando ele faz isso pelas razões erradas, nos referimos a este evento como um "falso positivo". Quando phpMussel não consegue bloquear um arquivo que deveria ter sido bloqueado, devido a ameaças imprevistas, assinaturas em falta ou déficits em suas assinaturas, nos referimos a este evento como um "detecção em falta" ou "missing detection" (que é análogo a um "falso negativo").

Isto pode ser resumido pela seguinte tabela:

&nbsp; | phpMussel *NÃO* deve bloquear um arquivo | phpMussel *DEVE* bloquear um arquivo
---|---|---
phpMussel *NÃO* bloquear um arquivo | Verdadeiro negativo (inferência correcta) | Detecção em falta (análogo a um falso negativo)
phpMussel *FAZ* bloquear um arquivo | __Falso positivo__ | Verdadeiro positivo (inferência correcta)

---


Última Atualização: 14 Fevereiro 2017 (2017.02.14).
