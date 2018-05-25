## Documentação para phpMussel (Português).

### Conteúdo
- 1. [PREÂMBULO](#SECTION1)
- 2. [COMO INSTALAR](#SECTION2)
- 3. [COMO USAR](#SECTION3)
- 4. [GESTÃO DE FRONT-END](#SECTION4)
- 5. [CLI (COMANDO LINHA INTERFACE)](#SECTION5)
- 6. [ARQUIVOS INCLUÍDOS NESTE PACOTE](#SECTION6)
- 7. [OPÇÕES DE CONFIGURAÇÃO](#SECTION7)
- 8. [FORMATOS DE ASSINATURAS](#SECTION8)
- 9. [PROBLEMAS DE COMPATIBILIDADE CONHECIDOS](#SECTION9)
- 10. [PERGUNTAS MAIS FREQUENTES (FAQ)](#SECTION10)
- 11. [INFORMAÇÃO LEGAL](#SECTION11)

*Nota relativa às traduções: Em caso de erros (por exemplo, discrepâncias entre as traduções, erros de digitação, etc), a versão em inglês do README é considerada a versão original e autorizada. Se você encontrar algum erro, a sua ajuda em corrigi-los seria bem-vinda.*

---


### 1. <a name="SECTION1"></a>PREÂMBULO

Obrigado por usar phpMussel, um PHP script projetado para detectar trojans, vírus, malware e outras ameaças dentro dos arquivos enviados para o seu sistema onde quer que o script é enganchado, baseado nas assinaturas do ClamAV e outros.

PHPMUSSEL COPYRIGHT 2013 e além GNU/GPLv2 através do Caleb M (Maikuolan).

Este script é um software livre; você pode redistribuí-lo e/ou modificá-lo de acordo com os termos da GNU General Public License como publicada pela Free Software Foundation; tanto a versão 2 da Licença, ou (a sua escolha) qualquer versão posterior. Este script é distribuído na esperança que possa ser útil, mas SEM QUALQUER GARANTIA; sem mesmo a implícita garantia de COMERCIALIZAÇÃO ou ADEQUAÇÃO A UM DETERMINADO FIM. Consulte a GNU General Public License para obter mais detalhes, localizado no arquivo `LICENSE.txt` e disponível também em:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Um especial obrigado para [ClamAV](http://www.clamav.net/) por o projeto inspiração e para as assinaturas que este script utiliza, sem o qual, o script provavelmente não existiria, ou no melhor, seria de utilidade muito limitada.

Um especial obrigado para SourceForge e GitHub por hospedar os arquivos do projeto, e para os recursos adicionais de um número de assinaturas utilizados através do phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) e outros, e um especial obrigado a todos aqueles que apoiam o projeto, a qualquer outra pessoa que eu possa ter esquecido de mencionar, e para você, por usar o script.

Este documento e seu pacote associado pode ser baixado gratuitamente de:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>COMO INSTALAR

#### 2.0 INSTALANDO MANUALMENTE (PARA WEB SERVIDORES)

1) Por estar lendo isso, estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo em algum lugar em sua máquina local. A partir daqui, você vai querer determinar onde no seu host ou CMS pretende colocar esses conteúdos. Um diretório como `/public_html/phpmussel/` ou semelhante (porém, não importa qual você escolher, assumindo que é seguro e algo você esteja satisfeito com) será o suficiente. Antes de começar o upload, continue lendo.

2) Renomear `config.ini.RenameMe` para `config.ini` (localizado dentro `vault`), e opcionalmente (fortemente recomendado para usuários avançados, mas não recomendado para iniciantes ou para os inexperientes), abra-o (este arquivo contém todas as diretivas disponíveis para phpMussel; acima de cada opção deve ser um breve comentário descrevendo o que faz e para que serve). Ajuste essas opções de como lhe serve, conforme o que for apropriado para sua configuração específica. Salve o arquivo e feche.

3) Carregar os conteúdos (phpMussel e seus arquivos) para o diretório que você tinha decidido anteriormente (você não precisa dos arquivos `*.txt`/`*.md` inclusos, mas principalmente, você deve carregar tudo).

4) CHMOD o diretório `vault` para "755" (se houver problemas, você pode tentar "777"; embora isto é o menos seguro). O diretório principal que armazena o conteúdo (o que você escolheu anteriormente), geralmente, não precisa ser mexido, mas o CHMOD status deve ser verificado se você já teve problemas de permissões no passado no seu sistema (por padrão, deve ser algo como "755").

5) Instale todas as assinaturas que você precisará. *Vejo: [INSTALANDO ASSINATURAS](#INSTALLING_SIGNATURES).*

6) Em seguida, você vai precisar "enganchar" o phpMussel ao seu sistema ou CMS. Existem várias diferentes maneiras em que você pode "enganchar" scripts como phpMussel ao seu sistema ou CMS, mas o mais fácil é simplesmente incluir o script no início de um núcleo arquivo de seu sistema ou CMS (uma que vai geralmente sempre ser carregado quando alguém acessa qualquer página através de seu site) utilizando um comando `require` ou `include`. Normalmente, isso vai ser algo armazenado em um diretório como `/includes`, `/assets` ou `/functions`, e muitas vezes, ser nomeado algo como `init.php`, `common_functions.php`, `functions.php` ou semelhante. Você precisará determinar qual arquivo é para a sua situação; Se você encontrar dificuldades em determinar isso por si mesmo, para assistência, visite a página de issues phpMussel no GitHub ou os fóruns de suporte para phpMussel; É possível que eu ou outro usuário podem ter experiência com o CMS que você está usando (você precisa deixar-nos saber qual CMS você está usando), e assim, pode ser capaz de prestar alguma assistência neste domínio. Para fazer isso [usar `require` ou `include`], insira a seguinte linha de código para o início desse núcleo arquivo, substituindo a string contida dentro das aspas com o exato endereço do arquivo `loader.php` (endereço local, não o endereço HTTP; será semelhante ao vault endereço mencionado anteriormente).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Salve o arquivo, fechar, recarrega-lo.

-- OU ALTERNATIVAMENTE --

Se você é usando um Apache webserver e se você tem acesso a `php.ini`, você pode usar a diretiva `auto_prepend_file` para pré-carga phpMussel sempre que qualquer solicitação para PHP é feito. Algo como:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Ou isso no `.htaccess` arquivo:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar a proteção de upload de arquivo, tente carregar dos arquivos testes incluídos no pacote em `_testfiles` para seu site através de seu método habitual de upload no navegador. Se tudo estiver funcionando, a mensagem deve aparecer a partir phpMussel confirmando que o carregamento foi bloqueado com sucesso. Se nada aparecer, algo está não funcionando corretamente. Se você estiver usando quaisquer recursos avançados ou se você estiver usando outros tipos de analise possível da ferramenta, eu sugiro tentar isso com aqueles para certificar que funciona como esperado, também.

#### 2.1 INSTALANDO MANUALMENTE (PARA CLI)

1) Por estar lendo isso, estou supondo que você já tenha baixado uma cópia arquivada do script, descomprimido seu conteúdo e tê-lo em algum lugar em sua máquina local. Quando você tiver determinado que você está feliz com a localização escolhida para o phpMussel, continue.

2) phpMussel requer PHP instalado na máquina host para poder executar. Se você não ainda tem PHP instalado em sua máquina, por favor instalar o PHP em sua máquina, seguindo as instruções fornecidas pelo instalador do PHP.

3) Opcionalmente (fortemente recomendado para avançados usuários, mas não recomendado para iniciantes ou para os inexperientes), abrir `config.ini` (localizado dentro `vault`) – Este arquivo contém todas as diretivas disponíveis para phpMussel. Acima de cada opção deve ter um breve comentário descrevendo o que faz e para que serve. Ajuste essas opções de como você vê o ajuste, conforme o que for apropriado para sua configuração específica. Salve o arquivo, feche.

4) Opcionalmente, você pode fazer usando phpMussel no modo CLI mais fácil para si mesmo através da criação de um batch arquivo para carregar automaticamente PHP e phpMussel. Para fazer isso, abra um editor de simples texto como Notepad ou Notepad++, digite o caminho completo para o arquivo `php.exe` no diretório de instalação do PHP, seguido por um espaço, seguido pelo caminho completo para o arquivo `loader.php` no diretório da sua instalação do phpMussel, salvar o arquivo com a extensão `.bat` Em algum lugar que você vai encontrá-lo facilmente, e clique duas vezes nesse arquivo para executar phpMussel no futuro.

5) Instale todas as assinaturas que você precisará. *Vejo: [INSTALANDO ASSINATURAS](#INSTALLING_SIGNATURES).*

6) Neste ponto, você está feito! Porém, você provavelmente deve testá-lo para garantir que ele está funcionando corretamente. Para testar phpMussel, executar phpMussel e tentar analisar o diretório `_testfiles` fornecida com o pacote.

#### 2.2 INSTALANDO COM COMPOSER

[phpMussel está registrado no Packagist](https://packagist.org/packages/phpmussel/phpmussel), e entao, se você estiver familiarizado com o Composer, poderá usar o Composer para instalar o phpMussel (você ainda precisará preparar a configuração e ganchos embora; consulte "instalando manualmente (para web servidores)" as etapas 2 e 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 INSTALANDO ASSINATURAS

Desde a v1.0.0, as assinaturas não estão incluídas no pacote phpMussel. As assinaturas são requeridas pela phpMussel para detectar ameaças específicas. Existem 3 métodos principais para instalar assinaturas:

1. Instale automaticamente usando o front-end página de atualizações.
2. Gerar assinaturas usando "SigTool" e instale-se manualmente.
3. Baixe as assinaturas de "phpMussel/Signatures" e instale-se manualmente.

##### 2.3.1 Instale automaticamente usando o front-end página de atualizações.

Primeiramente, você precisará certificar-se de que o front-end está habilitado. *Vejo: [GESTÃO DE FRONT-END](#SECTION4).*

Então, tudo o que você precisa fazer é ir para o front-end página de atualizações, encontre os arquivos de assinatura necessários e use as opções fornecidas na página, instale-as e ative-as.

##### 2.3.2 Gerar assinaturas usando "SigTool" e instale-se manualmente.

*Vejo: [Documentação SigTool](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Baixar as assinaturas de "phpMussel/Signatures" e instale-se manualmente.

Primeiramente, vá para [phpMussel/Signatures](https://github.com/phpMussel/Signatures). O repositório contém vários arquivos de assinatura compactados em GZ. Baixe os arquivos que você precisa, descomprime-os e copie os arquivos descomprimidos para o diretório `/vault/signatures` para instalá-los. Listar os nomes dos arquivos copiados para a diretiva `Active` na sua configuração phpMussel para ativá-los.

---


### 3. <a name="SECTION3"></a>COMO USAR

#### 3.0 COMO USAR (PARA WEB SERVIDORES)

phpMussel deve ser capaz de operar corretamente com requisitos mínimos sobre a sua parte: Após instalá-lo, ele deve funcionar imediatamente e ser imediatamente utilizável.

Análise dos arquivos carregados via upload é automatizado e ativado por padrão, por isso nada é exigido de você por essa função particular.

Porém, você também é capaz de instruir phpMussel para verificar arquivos e/ou diretórios específicos. Para fazer isso, em primeiro lugar, você vai precisar assegurar que a configuração apropriada é definida no arquivo `config.ini` (`cleanup` deve ser desativado), e quando feito, em um arquivo PHP que está enganchado ao phpMussel, usar a seguinte função no seu código:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` pode ser uma string, um matriz, ou um matriz de matrizes, e indica qual arquivo, arquivos, diretório e/ou diretórios para analisar.
- `$output_type` é um booleano, indicando o formato para os resultados da verificação a serem retornados. `false` instrui a função para retornar resultados como um número inteiro. `true` instrui a função para retornar os resultados como texto legível. Adicionalmente, em ambos os casos, os resultados podem ser acessados através de variáveis globais após o análise já concluída. Esta variável é opcional, definida como `false` por padrão. O seguinte descreve os resultados inteiros:

| Resultados | Descrição |
|---|---|
| -3 | Indica problemas foram encontrados com o phpMussel arquivos de assinaturas ou arquivos de mapas de assinaturas e que eles podem possívelmente estar ausente ou corrompido. |
| -2 | Indica que dados corrompidos foram detectados durante a análise, e portanto, a análise não foi concluída. |
| -1 | Indica que extensões ou complementos necessários pelo PHP para executar a análise estavam faltando, e portanto, a análise não foi concluída. |
| 0 | Indica que o alvo de análise não existe, e portanto, havia nada para verificar. |
| 1 | Indica que o alvo foi analisado e não foram detectados problemas. |
| 2 | Indica que o alvo foi analisado e problemas foram detectados. |

- `$output_flatness` é um booleano, indicando para a função ou retornar os resultados de análise (quando há vários alvos para analisando) como uma matriz ou uma string. `false` irá retornar os resultados como uma matriz. `true` irá retornar os resultados como uma string. Esta variável é opcional, definida como `false` por padrão.

Exemplos:

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Retorna algo tal como esta (como uma string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Começado.
 > Verificando '/user_name/public_html/my_file.html':
 -> Não problemas encontrados.
 Wed, 16 Sep 2013 02:49:47 +0000 Terminado.
```

Por completos detalhes sobre que tipo de assinaturas phpMussel usa durante a análise e como ele usa essas assinaturas, consulte a [FORMATOS DE ASSINATURAS](#SECTION8) seção deste arquivo README.

Se você encontrar quaisquer falsos positivos, se você encontrar algo novo que você acha deve ser bloqueado, ou para qualquer outra coisa com relação a assinatura, entre em contato comigo sobre isso para que eu possa fazer as mudanças necessárias, que, se você não entrar em contato comigo, eu posso não ser necessariamente conscientes de. *(Vejo: [O que é um "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)).*

Para desativar as assinaturas que estão incluídos com phpMussel (tal como se você está experimentando falsos positivos específico para seus fins que não deve normalmente ser removidos da agilize), adicione os nomes das assinaturas específicas a ser desabilitadas para o arquivo greyist das assinaturas (`/vault/greylist.csv`), separados por vírgulas.

*Veja também: [Como acessar detalhes específicos sobre os arquivos quando eles são analisados?](#SCAN_DEBUGGING)*

#### 3.1 COMO USAR (PARA CLI)

Por favor, consulte a seção "INSTALANDO MANUALMENTE (PARA CLI)" deste arquivo README.

Também estar ciente de que phpMussel é um scanner *on-demand*; *NÃO* é um scanner *on-access* (exceto para o carregamento de arquivos, no momento de carregamento), e ao contrário de antivírus suítes convencionais, não monitora memória ativa! Ele só vai detectar vírus contidos pelo carregamento de arquivos, e por esses arquivos específicos que você explicitamente diga a ele analisar.

---


### 4. <a name="SECTION4"></a>GESTÃO DE FRONT-END

#### 4.0 O QUE É O FRONT-END.

O front-end fornece uma maneira conveniente e fácil de manter, gerenciar e atualizar sua instalação phpMussel. Você pode visualizar, compartilhar e baixar arquivos de log através da página de logs, você pode modificar a configuração através da página de configuração, você pode instalar e desinstalar componentes através da página de atualizações, e você pode carregar, baixar e modificar arquivos no seu vault através do gerenciador de arquivos.

O front-end é desativado por padrão para evitar acesso não autorizado (acesso não autorizado pode ter consequências significativas para o seu site e para a sua segurança). Instruções para habilitá-lo estão incluídas abaixo deste parágrafo.

#### 4.1 COMO HABILITAR O FRONT-END.

1) Localize a directiva `disable_frontend` dentro `config.ini`, e defini-lo como `false` (ele será `true` por padrão).

2) Acesse o `loader.php` do seu navegador (p.e., `http://localhost/phpmussel/loader.php`).

3) Faça login com o nome de usuário e a senha padrão (admin/password).

Nota: Depois de efetuar login pela primeira vez, a fim de impedir o acesso não autorizado ao front-end, você deve imediatamente alterar seu nome de usuário e senha! Isto é muito importante, porque é possível fazer upload de código PHP arbitrário para o seu site através do front-end.

#### 4.2 COMO USAR O FRONT-END.

As instruções são fornecidas em cada página do front-end, para explicar a maneira correta de usá-lo e sua finalidade pretendida. Se precisar de mais explicações ou qualquer assistência especial, entre em contato com o suporte. Alternativamente, existem alguns vídeos disponíveis no YouTube que podem ajudar por meio de demonstração.


---


### 5. <a name="SECTION5"></a>CLI (COMANDO LINHA INTERFACE)

phpMussel pode ser executado como um interativo analisador de arquivo no modo CLI em sistemas baseados em Windows. Por favor, consulte a seção "COMO INSTALAR (PARA CLI)" deste arquivo README para mais detalhes.

Para uma lista de comandos disponíveis Em CLI, no CLI prompt, digite 'c', e pressione Enter.

Além disso, para os interessados, um tutorial em vídeo para saber como usar phpMussel no modo CLI está disponível aqui:
- <https://youtu.be/H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>ARQUIVOS INCLUÍDOS NESTE PACOTE

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
/_docs/readme.ko.md | Documentação Coreana.
/_docs/readme.nl.md | Documentação Holandês.
/_docs/readme.pt.md | Documentação Português.
/_docs/readme.ru.md | Documentação Russo.
/_docs/readme.ur.md | Documentação Urdu.
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
/vault/fe_assets/_cache.html | Um modelo HTML para o front-end página do dados de cache.
/vault/fe_assets/_config.html | Um modelo HTML para o front-end página de configuração.
/vault/fe_assets/_config_row.html | Um modelo HTML para o front-end página de configuração.
/vault/fe_assets/_files.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_edit.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_rename.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_files_row.html | Um modelo HTML para o gerenciador de arquivos.
/vault/fe_assets/_home.html | Um modelo HTML para o front-end página principal.
/vault/fe_assets/_login.html | Um modelo HTML para o front-end página login.
/vault/fe_assets/_logs.html | Um modelo HTML para o front-end página para os arquivos de registro.
/vault/fe_assets/_nav_complete_access.html | Um modelo HTML para os links de navegação para o front-end, para aqueles com acesso completo.
/vault/fe_assets/_nav_logs_access_only.html | Um modelo HTML para os links de navegação para o front-end, para aqueles com acesso aos arquivos de registro somente.
/vault/fe_assets/_quarantine.html | Um modelo HTML para o front-end página de quarentena.
/vault/fe_assets/_quarantine_row.html | Um modelo HTML para o front-end página de quarentena.
/vault/fe_assets/_statistics.html | Um modelo HTML para o front-end página de estatísticas.
/vault/fe_assets/_updates.html | Um modelo HTML para o front-end página de atualizações.
/vault/fe_assets/_updates_row.html | Um modelo HTML para o front-end página de atualizações.
/vault/fe_assets/_upload_test.html | Um modelo HTML para o página de carregar teste.
/vault/fe_assets/frontend.css | Folha de estilo CSS para o front-end.
/vault/fe_assets/frontend.dat | Banco de dados para o front-end (contém informações de contas e sessões; gerado só se o front-end está habilitado e usado).
/vault/fe_assets/frontend.html | O arquivo modelo HTML principal para o front-end.
/vault/fe_assets/icons.php | Módulo de ícones (usado pelo gerenciador de arquivos do front-end).
/vault/fe_assets/pips.php | Módulo de pips (usado pelo gerenciador de arquivos do front-end).
/vault/fe_assets/scripts.js | Contém dados de JavaScript do front-end.
/vault/lang/ | Contém dados lingüísticos.
/vault/lang/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/lang/lang.ar.fe.php | Dados lingüísticos Árabe para o front-end.
/vault/lang/lang.ar.php | Dados lingüísticos Árabe.
/vault/lang/lang.bn.fe.php | Dados lingüísticos Bangla para o front-end.
/vault/lang/lang.bn.php | Dados lingüísticos Bangla.
/vault/lang/lang.de.fe.php | Dados lingüísticos Alemão para o front-end.
/vault/lang/lang.de.php | Dados lingüísticos Alemão.
/vault/lang/lang.en.fe.php | Dados lingüísticos Inglês para o front-end.
/vault/lang/lang.en.php | Dados lingüísticos Inglês.
/vault/lang/lang.es.fe.php | Dados lingüísticos Espanhol para o front-end.
/vault/lang/lang.es.php | Dados lingüísticos Espanhol.
/vault/lang/lang.fr.fe.php | Dados lingüísticos Francesa para o front-end.
/vault/lang/lang.fr.php | Dados lingüísticos Francesa.
/vault/lang/lang.hi.fe.php | Dados lingüísticos Hindi para o front-end.
/vault/lang/lang.hi.php | Dados lingüísticos Hindi.
/vault/lang/lang.id.fe.php | Dados lingüísticos Indonésio para o front-end.
/vault/lang/lang.id.php | Dados lingüísticos Indonésio.
/vault/lang/lang.it.fe.php | Dados lingüísticos Italiano para o front-end.
/vault/lang/lang.it.php | Dados lingüísticos Italiano.
/vault/lang/lang.ja.fe.php | Dados lingüísticos Japonês para o front-end.
/vault/lang/lang.ja.php | Dados lingüísticos Japonês.
/vault/lang/lang.ko.fe.php | Dados lingüísticos Coreano para o front-end.
/vault/lang/lang.ko.php | Dados lingüísticos Coreano.
/vault/lang/lang.nl.fe.php | Dados lingüísticos Holandês para o front-end.
/vault/lang/lang.nl.php | Dados lingüísticos Holandês.
/vault/lang/lang.pt.fe.php | Dados lingüísticos Português para o front-end.
/vault/lang/lang.pt.php | Dados lingüísticos Português.
/vault/lang/lang.ru.fe.php | Dados lingüísticos Russo para o front-end.
/vault/lang/lang.ru.php | Dados lingüísticos Russo.
/vault/lang/lang.th.fe.php | Dados lingüísticos Tailandês para o front-end.
/vault/lang/lang.th.php | Dados lingüísticos Tailandês.
/vault/lang/lang.tr.fe.php | Dados lingüísticos Turco para o front-end.
/vault/lang/lang.tr.php | Dados lingüísticos Turco.
/vault/lang/lang.ur.fe.php | Dados lingüísticos Urdu para o front-end.
/vault/lang/lang.ur.php | Dados lingüísticos Urdu.
/vault/lang/lang.vi.fe.php | Dados lingüísticos Vietnamita para o front-end.
/vault/lang/lang.vi.php | Dados lingüísticos Vietnamita.
/vault/lang/lang.zh-tw.fe.php | Dados lingüísticos Chinês (tradicional) para o front-end.
/vault/lang/lang.zh-tw.php | Dados lingüísticos Chinês (tradicional).
/vault/lang/lang.zh.fe.php | Dados lingüísticos Chinês (simplificado) para o front-end.
/vault/lang/lang.zh.php | Dados lingüísticos Chinês (simplificado).
/vault/quarantine/ | Diretório de quarentena (contém os arquivos em quarentena).
/vault/quarantine/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/signatures/ | Diretório de assinaturas (contém arquivos de assinaturas).
/vault/signatures/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/signatures/switch.dat | Isto controla e define algumas variáveis.
/vault/.htaccess | Um hipertexto acesso arquivo (neste caso, para proteger confidenciais arquivos pertencentes ao script contra serem acessados por fontes não autorizadas).
/vault/.travis.php | Usado pela Travis CI para testes (não é necessário para o correto funcionamento do script).
/vault/.travis.yml | Usado pela Travis CI para testes (não é necessário para o correto funcionamento do script).
/vault/cli.php | Módulo de CLI.
/vault/components.dat | Contém informações relativas aos vários componentes de phpMussel; Usado pelo recurso atualizações fornecidas pelo front-end.
/vault/config.ini.RenameMe | Arquivo de configuração; Contém todas as opções de configuração para phpMussel, dizendo-lhe o que fazer e como operar corretamente (renomear para ativar).
/vault/config.php | Módulo de configuração.
/vault/config.yaml | Arquivo de valores padrão para a configuração; Contém valores padrão para a configuração de phpMussel.
/vault/frontend.php | Módulo do front-end.
/vault/frontend_functions.php | Arquivo de funções do front-end.
/vault/functions.php | Arquivo de funções.
/vault/greylist.csv | Um arquivo indicando a phpMussel quais assinaturas deve ser ignorado (arquivo automaticamente recriado se deletado).
/vault/lang.php | Dados lingüísticos.
/vault/php5.4.x.php | Polyfills para PHP 5.4.X (necessário para compatibilidade reversa com PHP 5.4.X; seguro para deletar por versões de PHP mais recentes).
※ /vault/scan_kills.txt | Um registro de tudos os arquivos carregamentos bloqueado ou matado por phpMussel.
※ /vault/scan_log.txt | Um registro de tudo analisado por phpMussel.
※ /vault/scan_log_serialized.txt | Um registro de tudo analisado por phpMussel.
/vault/template_custom.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/template_default.html | Template arquivo; Template por HTML produzido através do phpMussel por o bloqueado arquivo carregamento mensagem (a mensagem visto por o carregador).
/vault/themes.dat | Arquivo de temas; Usado pelo recurso atualizações fornecidas pelo front-end.
/vault/upload.php | Módulo de carregamento.
/.gitattributes | Um arquivo do GitHub projeto (não é necessário para o correto funcionamento do script).
/.gitignore | Um arquivo do GitHub projeto (não é necessário para o correto funcionamento do script).
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


### 7. <a name="SECTION7"></a>OPÇÕES DE CONFIGURAÇÃO
O seguinte é uma lista de variáveis encontradas no `config.ini` arquivo de configuração para phpMussel, juntamente com uma descrição de sua propósito e função.

#### "general" (Categoria)
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
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Truncar arquivos de log quando atingem um determinado tamanho? Valor é o tamanho máximo em B/KB/MB/GB/TB que um arquivo de log pode crescer antes de ser truncado. O valor padrão de 0KB desativa o truncamento (arquivos de log podem crescer indefinidamente). Nota: Aplica-se a arquivos de log individuais! O tamanho dos arquivos de log não é considerado coletivamente.

"log_rotation_limit"
- A rotação de log limita o número de arquivos de log que devem existir a qualquer momento. Quando novos arquivos de log são criados, se o número total de arquivos de log exceder o limite especificado, a ação especificada será executada. Você pode especificar o limite desejado aqui. Um valor de 0 desativará a rotação de log.

"log_rotation_action"
- A rotação de log limita o número de arquivos de log que devem existir a qualquer momento. Quando novos arquivos de log são criados, se o número total de arquivos de log exceder o limite especificado, a ação especificada será executada. Você pode especificar a ação desejada aqui. Delete = Deletar os arquivos de log mais antigos, até o limite não seja mais excedido. Archive = Primeiramente arquivar, e então deletar os arquivos de log mais antigos, até o limite não seja mais excedido.

*Esclarecimento técnico: Neste contexto, "mais antigo" significa modificado menos recentemente.*

"timeOffset"
- Se o tempo do servidor não coincide com sua hora local, você pode especificar aqui um offset para ajustar as informações de data/tempo gerado por phpMussel de acordo com as suas necessidades. É geralmente recomendado no lugar para ajustar a directiva fuso horário no seu arquivo `php.ini`, mas às vezes (tais como quando se trabalha com provedores de hospedagem compartilhada e limitados) isto não é sempre possível fazer, e entao, esta opção é fornecido aqui. Offset é em minutos.
- Exemplo (para adicionar uma hora): `timeOffset=60`

"timeFormat"
- O formato de notação de data/tempo utilizado pelo phpMussel. Padrão = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

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

"numbers"
- Especifica como exibir números.

"quarantine_key"
- phpMussel é capaz de colocar em quarentena marcados tentados arquivos carregamentos em isolamento dentro da phpMussel vault, se isso é algo que você quer que ele faça. Casuais usuários de phpMussel de que simplesmente desejam proteger seus sites ou hospedagem sem ter qualquer interesse em profundamente analisando qualquer marcados tentados arquivos carregamentos deve deixar esta funcionalidade desativada, mas qualquer usuário interessado em mais profundamente analisando marcados tentados arquivos carregamentos para pesquisa de malware ou de similares tais coisas deve ativada essa funcionalidade. Quarentena de marcados tentados arquivos carregamentos às vezes pode também ajudar em depuração de falso-positivos, se isso é algo que ocorre com frequência para você. Por desativar a funcionalidade de quarentena, simplesmente deixar a directiva `quarantine_key` vazio, ou apagar o conteúdo do directivo, se ele não está já vazio. Por ativar a funcionalidade de quarentena, introduzir algum valor no directiva. O `quarantine_key` é um importante segurança característica do quarentena funcionalidade necessária como um meio de prevenir a funcionalidade de quarentena de ser explorada por potenciais atacantes e como meio de evitar qualquer potencial execução de dados armazenados dentro da quarentena. O `quarantine_key` devem ser tratados da mesma maneira como suas senhas: O mais longo o mais melhor, e guardá-lo com força. Por melhor efeito, usar em conjunto com `delete_on_sight`.

"quarantine_max_filesize"
- O máximo permitido tamanho do arquivos serem colocados em quarentena. Arquivos maiores que este valor NÃO serão colocados em quarentena. Esta directiva é importante como um meio de torná-lo mais difícil por qualquer potenciais atacante para inundar sua quarentena com indesejados dados potencialmente causando excesso uso de dados no seu hospedagem serviço. Padrão = 2MB.

"quarantine_max_usage"
- O uso máximo de memória permitido através do quarentena. Se o total de memória utilizada pelo quarentena atingir este valor, os mais antigos arquivos em quarentena serão apagados até que a total memória utilizada já não atinge este valor. Esta directiva é importante como um meio de torná-lo mais difícil por qualquer potenciais atacante para inundar sua quarentena com indesejados dados potencialmente causando excesso uso de dados no seu hospedagem serviço. Padrão = 64MB.

"honeypot_mode"
- Quando o honeypot modo é ativada, phpMussel vai tente colocar no quarentena todos os uploads de arquivos que ele encontras, independentemente de se ou não o arquivo que está sendo carregado corresponde a qualquer incluídos assinaturas, e zero análise desses tentados arquivos carregamentos vai ocorrer. Esta funcionalidade deve ser útil por aqueles que desejam utilizar phpMussel por os fins de vírus/malware pesquisa, mas não é recomendado para ativar essa funcionalidade se o planejado uso de phpMussel pelo utilizador é por o real análise dos arquivos carregamentos nem recomendado para usar essa funcionalidade por fins outros que o uso do honeypot. Por padrão, essa opção está desativada. False = Desativado [Padrão]; True = Ativado.

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

"disable_webfonts"
- Desativar webfonts? True = Sim [Padrão]; False = Não.

"maintenance_mode"
- Ativar o modo de manutenção? True = Sim; False = Não [Padrão]. Desativa tudo além do front-end. Às vezes útil para quando atualiza seu CMS, frameworks, etc.

"default_algo"
- Define qual algoritmo usar para todas as futuras senhas e sessões. Opções: PASSWORD_DEFAULT (padrão), PASSWORD_BCRYPT, PASSWORD_ARGON2I (requer PHP >= 7.2.0).

"statistics"
- Monitorar as estatísticas de uso do phpMussel? True = Sim; False = Não [Padrão].

"allow_symlinks"
- Às vezes, o phpMussel não pode acessar um arquivo diretamente quando é nomeado de uma determinada maneira. Acessar o arquivo indiretamente via symlinks às vezes pode resolver esse problema. No entanto, isso nem sempre é uma solução viável, porque em alguns sistemas, o uso de symlinks pode ser proibido, ou pode exigir privilégios administrativos. Esta diretiva é usada para determinar se o phpMussel deve tentar usar symlinks para acessar arquivos indiretamente, quando acessá-los diretamente não é possível. True = Ativar symlinks; False = Desativar symlinks [Padrão].

#### "signatures" (Categoria)
Configuração por assinaturas.

"Active"
- Uma lista dos arquivos de assinaturas ativos, delimitados por vírgulas.

"fail_silently"
- Deve phpMussel reportar quando os assinaturas arquivos estão perdido ou corrompido? Se `fail_silently` está desativado, perdidos e corrompidos arquivos serão reportado durante análise, e se `fail_silently` está ativado, perdidos e corrompidos arquivos serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Isso geralmente deve ser deixado sozinho a menos que você está experimentando PHP falhas ou semelhantes problemas. False = Desativado; True = Ativado [Padrão].

"fail_extensions_silently"
- Deve phpMussel reportar quando extensões não estão disponíveis? Se `fail_extensions_silently` está desativado, extensões indisponíveis serão reportado durante análise, e se `fail_extensions_silently` está ativado, extensões indisponíveis serão ignoradas, com a análise reportando por estes arquivos em que não há problemas. Desativando dessa directiva pode potencialmente aumentar a sua segurança, mas também pode levar a um aumento de falsos positivos. False = Desativado; True = Ativado [Padrão].

"detect_adware"
- Deve phpMussel usam assinaturas para detectar adware? False = Não; True = Sim [Padrão].

"detect_encryption"
- Deve phpMussel detectar e bloquear arquivos criptografados? False = Não; True = Sim [Padrão].

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

#### "files" (Categoria)
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
- Detectar e bloquear compactados arquivos criptografados? Porque phpMussel não é capaz de analisar o conteúdo de arquivos criptografados, é possível que a criptografia de arquivo pode ser empregado por um atacante como meio de tentar contornar phpMussel, analisadores anti-vírus e outras dessas proteções. Instruindo phpMussel para bloquear quaisquer arquivos que ele descobrir a ser criptografada poderia ajudar a reduzir o risco associado a essas tais possibilidades. False = Não; True = Sim [Padrão].

#### "attack_specific" (Categoria)
Configuração por específicas ataque detecções.

Chameleon ataque detecções: False = Inativo; True = Ativo.

"chameleon_from_php"
- Olha por PHP header em arquivos que são não PHP arquivos nem reconhecidos compactados arquivos.

"chameleon_from_exe"
- Olha por executável headers em arquivos que são não executáveis nem reconhecidos compactados arquivos e por executáveis cujos headers estão incorretas.

"chameleon_to_archive"
- Olha por compactados arquivos cujos headers estão incorretas (Suportados: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Olha por office documentos cujos headers estão incorretas (Suportados: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Olha por imagens cujos headers estão incorretas (Suportados: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Olha por PDF arquivos cujos headers estão incorretas.

"archive_file_extensions"
- Reconhecidos arquivos extensões (formato é CSV; só deve adicionar ou remover quando problemas ocorrem; desnecessariamente removendo pode causar falso-positivos para aparecer por compactados arquivos, enquanto desnecessariamente adicionando será essencialmente whitelist o que você está adicionando contra ataque específica detecção; modificar com cautela; Também notar que este não tem efeito em qual compactados arquivos podem e não podem ser analisados no escopo de conteúdo). A lista, como é padrão, é do formatos utilizados mais comumente através da maioria dos sistemas e CMS, mas intencionalmente não é necessariamente abrangente.

"block_control_characters"
- Bloquear todos os arquivos que contenham quaisquer caracteres de controle, exceto linha quebras (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`)? Se você está _**APENAS**_ carregando simple texto, então você pode ativar essa opção para fornecer alguma adicional proteção para o seu sistema. Mas, se você carregar qualquer coisa que não seja de texto simples, ativando isso pode resultas em falso positivos. False = Não bloquear [Padrão]; True = Bloquear.

"corrupted_exe"
- Corrompidos arquivos e erros de análise. False = Ignorar; True = Bloquear [Padrão]. Detectar e bloquear potencialmente corrompidos PE (Portátil Executável) arquivos? Frequentemente (mas não sempre), quando certos aspectos de um PE arquivo é corrompido ou não pode ser analisado corretamente, essa pode ser indicativo de uma viral infecção. Os processos utilizados pela maioria dos anti-vírus programas para detectar vírus em PE arquivos requerem analisando os arquivos de certas maneiras, que, se o programador de um vírus é consciente de, especificamente irá tentar impedir, a fim de permitir seu vírus para permanecer não detectado.

"decode_threshold"
- Opcional limitação para o comprimento dos dados para que dentro de decodificar comandos devem ser detectados (em caso de existirem quaisquer notável problemas de desempenho enquanto analisando). Padrão = 512KB. Zero ou nulo valor desativa o limitação (removendo qualquer limitação baseado em tamanho do arquivo).

"scannable_threshold"
- Opcional limitação para o comprimento dos dados brutos para que phpMussel é permitido a ler e analisar (em caso de existirem quaisquer notável problemas de desempenho enquanto analisando). Padrão = 32MB. Zero ou nulo valor desativa o limitação. Em geral, esse valor não deve ser menor que o médio arquivo tamanho de carregamentos que você quer e espera para receber no seu servidor ou website, não deve ser mais que o filesize_limit directivo, e não deve ser menor que aproximadamente um quinto do total permissível memória alocação concedido para PHP através do `php.ini` configuração arquivo. Esta directiva existe para tentar impedir phpMussel de usando demais memória (que seria impedir-lo de ser capaz de analisando arquivos acima de um certo tamanho com sucesso).

#### "compatibility" (Categoria)
Compatibilidade directivas por phpMussel.

"ignore_upload_errors"
- Essa directiva deve ser geralmente desativada a menos que seja necessário por correta funcionalidade de phpMussel no seu específico sistema. Normalmente, quando desativado, quando phpMussel detecta a presença de elementos dentro a `$_FILES` array(), ele tentará iniciar uma análise dos arquivos que esses elementos representam, e, se esses elementos estão branco ou vazia, phpMussel irá retornar uma erro mensagem. Esse é um apropriado comportamento por phpMussel. Mas, por alguns CMS, vazios elementos podem ocorrer como resultado do natural comportamento dessas CMS, ou erros podem ser reportado quando não houver alguma, nesse caso, o normal comportamento por phpMussel será interferindo com o normal comportamento dessas CMS. Se tal situação ocorre por você, ativando esta opção irá instruir phpMussel para não tentar iniciar um análise por tais vazios elementos, ignorá-los quando encontrado e para não retornar qualquer relacionado erro mensagens, assim, permitindo a continuação da página carga. False = DESATIVADO; True = ATIVADO.

"only_allow_images"
- Se você apenas esperar ou apenas tencionar de permitir imagens a ser enviado para seu sistema ou CMS, e se você absolutamente não necessita quaisquer arquivos exceto imagens a ser enviado para seu sistema ou CMS, esta directiva devia ser ATIVADO, mas em outros casos devia ser DESATIVADO. Se esta directiva é ATIVADO, ele irá instruir phpMussel indiscriminadamente bloquear qualquer arquivo carregamento identificado como não imagem, sem os analisar. Isto pode reduzir o tempo de processamento e uso de memória por tentados carregamentos de não imagem arquivos. False = DESATIVADO; True = ATIVADO.

#### "heuristic" (Categoria)
Heurísticos directivas para phpMussel.

"threshold"
- Existem assinaturas específicas de phpMussel para identificando suspeitas e qualidades potencialmente maliciosos dos arquivos que estão sendo carregados sem por si só identificando aqueles arquivos que estão sendo carregados especificamente como sendo maliciosos. Este "threshold" (limiar) valor instrui phpMussel o que o total máximo peso de suspeitas e qualidades potencialmente maliciosos dos arquivos que estão sendo carregados que é permitida é antes que esses arquivos devem ser sinalizada como maliciosos. A definição de peso neste contexto é o número total de suspeitas e qualidades potencialmente maliciosos identificado. Por padrão, este valor será definido como 3. Um menor valor geralmente resultará em uma maior ocorrência de falsos positivos mas um maior número de arquivos maliciosos sendo sinalizado, enquanto um maior valor geralmente resultará em uma menor ocorrência de falsos positivos mas um menor número de arquivos maliciosos sendo sinalizado. É geralmente melhor a deixar esse valor em seu padrão a menos que você está enfrentando problemas relacionados a ela.

#### "virustotal" (Categoria)
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

#### "urlscanner" (Categoria)
Um URL analisador está incluído com phpMussel, capaz de detectar URLs maliciosos dentro de todos os dados ou arquivos analisados.

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

#### "legal" (Categoria)
Configuração relacionada aos requisitos legais.

*Para obter mais informações sobre requisitos legais e como isso pode afetar seus requisitos de configuração, consulte a seção "[INFORMAÇÃO LEGAL](#SECTION11)" da documentação.*

"pseudonymise_ip_addresses"
- Pseudonimiza endereços IP ao escrever os arquivos de log? True = Sim; False = Não [Padrão].

"privacy_policy"
- O endereço de uma política de privacidade relevante a ser exibida no rodapé de qualquer página gerada. Especifique um URL, ou deixe em branco para desabilitar.

#### "template_data" (Categoria)
Directivas/Variáveis para modelos e temas.

Template dados está associada com o HTML usado para gerar a "Carregar Negado" mensagem exibido aos usuários quandos arquivo carregamentos são bloqueados. Se você estiver usando temas personalizados para phpMussel, HTML é originado a partir do `template_custom.html` arquivo, e caso contrário, HTML é originado a partir do `template.html` arquivo. Variáveis escritas para esta seção do configuração arquivo são processado ao HTML via substituição de quaisquer nomes de variáveis cercado por colchetes encontrado dentro do HTML com os variáveis dados correspondentes. Por exemplo, onde `foo="bar"`, qualquer instância de `<p>{foo}</p>` encontrado dentro do HTML tornará `<p>bar</p>`.

"theme"
- Tema padrão a ser usado para phpMussel.

"Magnification"
- Ampliação de fonte. Padrão = 1.

"css_url"
- O template arquivo para temas personalizados utiliza CSS propriedades externos, enquanto que o template arquivo para o padrão tema utiliza CSS propriedades internos. Para instruir phpMussel para usar o template arquivo para temas personalizados, especificar o endereço HTTP pública do seu temas personalizados CSS arquivos usando a `css_url` variável. Se você deixar essa variável em branco, phpMussel usará o template arquivo para o padrão tema.

---


### 8. <a name="SECTION8"></a>FORMATOS DE ASSINATURAS

*Veja também:*
- *[O que é uma "assinatura"?](#WHAT_IS_A_SIGNATURE)*

Os primeiros 9 bytes `[x0-x8]` de um arquivo de assinaturas para phpMussel são `phpMussel`, e atua como um "número mágico" (magic number), para identificá-los como arquivos de assinaturas (isso ajuda a evitar que o phpMussel tente acidentalmente usar arquivos que não sejam arquivos de assinaturas). O próximo byte `[x9]` identifica o tipo de arquivo de assinaturas, que phpMussel deve saber para poder interpretar corretamente o arquivo de assinaturas. Os seguintes tipos de arquivos de assinaturas são reconhecidos:

Tipo | Byte | Descrição
---|---|---
`General_Command_Detections` | `0?` | Para arquivos de assinaturas usando CSV (valores separados por vírgula). Valores (assinaturas) são cadeias codificadas em hexadecimal para procurar dentro de arquivos. As assinaturas aqui não têm nenhum nome ou outros detalhes (apenas a cadeia a ser detectada).
`Filename` | `1?` | Para assinaturas do nomes de arquivos.
`Hash` | `2?` | Para assinaturas de hash.
`Standard` | `3?` | Para arquivos de assinaturas que funcionam diretamente com o conteúdos de arquivos.
`Standard_RegEx` | `4?` | Para arquivos de assinaturas que funcionam diretamente com o conteúdos de arquivos. As assinaturas podem conter expressões regulares.
`Normalised` | `5?` | Para arquivos de assinatura que funcionam com o conteúdos de arquivos normalizado para ANSI.
`Normalised_RegEx` | `6?` | Para arquivos de assinatura que funcionam com o conteúdos de arquivos normalizado para ANSI. As assinaturas podem conter expressões regulares.
`HTML` | `7?` | Para arquivos de assinatura que funcionam com o conteúdos de arquivos normalizado para HTML.
`HTML_RegEx` | `8?` | Para arquivos de assinatura que funcionam com o conteúdos de arquivos normalizado para HTML. As assinaturas podem conter expressões regulares.
`PE_Extended` | `9?` | Para arquivos de assinaturas que funcionam com os metadados de archivos PE (mas não com metadados seccionais PE).
`PE_Sectional` | `A?` | Para arquivos de assinaturas que funcionam com metadados seccionais PE.
`Complex_Extended` | `B?` | Para arquivos de assinaturas que funcionam com várias regras com base em metadados expandidos gerados pelo phpMussel.
`URL_Scanner` | `C?` | Para arquivos de assinaturas que funcionam com URLs.

O próximo byte `[x10]` é uma nova linha `[0A]`, e conclui o cabeçalho do arquivo de assinaturas para phpMussel.

Cada linha não vazia depois disso é uma assinatura ou regra. Cada assinatura ou regra ocupa uma linha. Os formatos de assinatura suportados são descritos abaixo.

#### *ASSINATURAS DE ARQUIVO NOME*
Todas as assinaturas de arquivo nome seguir o formato:

`NOME:FNRX`

Onde NOME é o nome para citar por essa assinatura e FNRX é o regex para verificar arquivos nomes (não codificados) contra.

#### *ASSINATURAS HASH*
Todas as assinaturas hash seguir o formato:

`HASH:TAMANHO:NOME`

Onde HASH é o hash (geralmente MD5) de um inteiro arquivo, TAMANHO é o total tamanho do arquivo e NOME é o nome para citar por essa assinatura.

#### *ASSINATURAS PE SECCIONAL*
Todas as assinaturas PE Seccional seguir o formato:

`TAMANHO:HASH:NOME`

Onde HASH é o hash MD5 de uma seção do PE arquivo, TAMANHO é o total tamanho da seção e NOME é o nome para citar por essa assinatura.

#### *ASSINATURAS PE ESTENDIDAS*
Todas as assinaturas PE estendidas seguir o formato:

`$VAR:HASH:TAMANHO:NOME`

Onde $VAR é o nome da PE variável para verificar contra, HASH é o MD5 dessa variável, TAMANHO é o tamanho total dessa variável e NOME é o nome para citar por essa assinatura.

#### *COMPLEXOS ESTENDIDAS ASSINATURAS*
Complexos estendidas assinaturas são bastante diferente para os outros tipos de assinaturas possíveis com phpMussel em que o que eles estão verificando contra é especificado pelas assinaturas e eles podem verificar contra vários critérios. Os critérios de verificação são delimitados por ";" e o verificação tipo e os verificação dados de cada verificação critérios é delimitados por ":" como assim que o formato por estas assinaturas tende a olhar um pouco assim:

`$variável1:ALGUNSDADOS;$variável2:ALGUNSDADOS;AssinaturaNome`

#### *TODAS OUTRAS*
Todas as outras assinaturas seguir o formato:

`NOME:HEX:FROM:TO`

Onde NOME é o nome para citar por essa assinatura e HEX é um hexadecimal codificado segmento do arquivo intentado a ser correspondido pela dado assinatura. TO e FROM são opcionais parâmetros, indicando de onde e para quais posições nos origem dados para verificar contra.

#### *REGEX (REGULAR EXPRESSIONS)*
Qualquer forma de regex compreendido e processado corretamente pelo PHP também deve ser correctamente compreendido e processado por phpMussel e suas assinaturas. Mas, eu sugiro tomar extremo cuidado quando escrevendo novas assinaturas baseadas regex, porque, se você não está inteiramente certo do que está fazendo, isto pode tem altamente irregulares e inesperadas resultados. Olha para o código-fonte de phpMussel Se você não está totalmente certo sobre o contexto em que as regex declarações são processada. Além, lembre-se que todos isso (com exceção para arquivo nome, compactado arquivo metadados, MD5 a sintaxe) deve ser codificado hexadecimalmente!

---


### 9. <a name="SECTION9"></a>CONHECIDOS COMPATIBILIDADE PROBLEMAS

#### PHP e PCRE
- phpMussel requer PHP e PCRE para executar e funcionar corretamente. Sem PHP, ou sem a PCRE extensão do PHP, phpMussel não vai executará ou funcionar corretamente. Deve certificar-se de que seu sistema tenha PHP e PCRE instalado e disponível antes de baixar e instalar phpMussel.

#### ANTI-VÍRUS SOFTWARE COMPATIBILIDADE

Em geral, phpMussel deve ser bastante compatível com a maioria dos outros vírus detecção softwares. Embora, conflitos foram relatadas por um número de utilizadores no passado. Esta informação abaixo é de VirusTotal.com, e descreve um número de falso-positivos relatados por vários anti-vírus programas contra phpMussel. Embora esta informação não é um absoluta garantia de haver ou não você vai encontrar problemas de compatibilidade entre phpMussel e seu anti-vírus software, se o seu anti-vírus software é conhecido como sinalização contra phpMussel, você deve considerar desativá-lo antes de trabalhar com phpMussel ou deve considerar alternativas opções para o seu anti-vírus software ou phpMussel.

Esta informação foi atualizada 2017.12.01 e é corrente para todas phpMussel lançamentos das duas mais recentes menores versões (v1.0.0-v1.1.0) no momento de escrever este.

*Esta informação aplica-se apenas ao pacote principal. Os resultados podem variar de acordo com arquivos de assinatura instalados, plugins, e outros componentes periféricos.*

| Analisador | Resultados |
|---|---|
| AVware | Reportar "BPX.Shell.PHP" |
| Bkav | Reportar "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>PERGUNTAS MAIS FREQUENTES (FAQ)

- [O que é uma "assinatura"?](#WHAT_IS_A_SIGNATURE)
- [O que é um "falso positivo"?](#WHAT_IS_A_FALSE_POSITIVE)
- [Com que frequência as assinaturas são atualizadas?](#SIGNATURE_UPDATE_FREQUENCY)
- [Eu encontrei um problema ao usar phpMussel e eu não sei o que fazer sobre isso! Ajude-me!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Eu quero usar phpMussel com uma versão PHP mais velha do que 5.4.0; Você pode ajudar?](#MINIMUM_PHP_VERSION)
- [Posso usar uma única instalação do phpMussel para proteger vários domínios?](#PROTECT_MULTIPLE_DOMAINS)
- [Eu não quero mexer com a instalação deste e fazê-lo funcionar com o meu site; Posso pagar-te para fazer tudo por mim?](#PAY_YOU_TO_DO_IT)
- [Posso contratar você ou qualquer um dos desenvolvedores deste projeto para o trabalho privado?](#HIRE_FOR_PRIVATE_WORK)
- [Preciso de modificações especializadas, customizações, etc; Você pode ajudar?](#SPECIALIST_MODIFICATIONS)
- [Eu sou um desenvolvedor, designer de site, ou programador. Posso aceitar ou oferecer trabalho relacionado a este projeto?](#ACCEPT_OR_OFFER_WORK)
- [Quero contribuir para o projeto; Posso fazer isso?](#WANT_TO_CONTRIBUTE)
- [Valores recomendados para "ipaddr".](#RECOMMENDED_VALUES_FOR_IPADDR)
- [Como acessar detalhes específicos sobre os arquivos quando eles são analisados?](#SCAN_DEBUGGING)
- [Posso usar o cron para atualizar automaticamente?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [O phpMussel pode analisar arquivos com nomes não-ANSI?](#SCAN_NON_ANSI)
- [Blacklists (listas negras) – Whitelists (listas brancas) – Greylists (listas cinzentas) – Quais são eles e como eu os uso?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>O que é uma "assinatura"?

No contexto do phpMussel, uma "assinatura" refere-se a dados que actuam como um indicador/identificador para algo específico que estamos procurando, geralmente sob a forma de um segmento muito pequeno, distinto e inócuo de algo maior e em caso contrário prejudiciais, como um vírus ou um trojan, ou na forma de um checksum de arquivo, hash, ou outro indicador de identificação semelhante, e geralmente inclui uma etiqueta, e alguns outros dados para ajudar a fornecer contexto adicional que pode ser usado por phpMussel para determinar a melhor maneira de proceder quando ele encontra o que estamos procurando.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>O que é um "falso positivo"?

O termo "falso positivo" (*alternativamente: "erro de falso positivo"; "alarme falso"*; Inglês: *false positive*; *false positive error*; *false alarm*), descrita de maneira muito simples, e num contexto generalizado, são usadas quando testando para uma condição, para se referir aos resultados desse teste, quando os resultados são positivos (isto é, a condição é determinada para ser "positivo", ou "verdadeiro"), mas espera-se que seja (ou deveria ter sido) negativo (isto é, a condição, na realidade, é "negativo", ou "falso"). Um "falso positivo" pode ser considerado análogo ao "chorando lobo" (em que a condição que está sendo testada é se existe um lobo perto do rebanho, a condição é "falso" em que não há nenhum lobo perto do rebanho, ea condição é relatada como "positivo" pelo pastor por meio de gritando "lobo, lobo"), ou análoga a situações em exames médicos em que um paciente é diagnosticado como tendo alguma doença quando, na realidade, eles não têm essa doença.

Os resultados relacionados a quando testando para uma condição pode ser descrito usando os termos "verdadeiro positivo", "verdadeiro negativo" e "falso negativo". Um "verdadeiro positivo" refere-se a quando os resultados do teste ea real situação da condição são ambos verdadeiros (ou "positivos"), e um "verdadeiro negativo" refere-se a quando os resultados do teste ea real situação da condição são ambos falsos (ou "negativos"); Um "verdadeiro positivo" ou um "verdadeiro negativo" é considerado como sendo uma "inferência correcta". A antítese de um "falso positivo" é um "falso negativo"; Um "falso negativo" refere-se a quando os resultados do teste are negativo (isto é, a condição é determinada para ser "negativo", ou "falso"), mas espera-se que seja (ou deveria ter sido) positivo (isto é, a condição, na realidade, é "positivo", ou "verdadeiro").

No contexto da phpMussel, estes termos referem-se as assinaturas de phpMussel e os arquivos que eles bloqueiam. Quando phpMussel bloquear um arquivo devido ao mau, desatualizados ou incorretos assinatura, mas não deveria ter feito isso, ou quando ele faz isso pelas razões erradas, nos referimos a este evento como um "falso positivo". Quando phpMussel não consegue bloquear um arquivo que deveria ter sido bloqueado, devido a ameaças imprevistas, assinaturas em falta ou déficits em suas assinaturas, nos referimos a este evento como um "detecção em falta" ou "missing detection" (que é análogo a um "falso negativo").

Isto pode ser resumido pela seguinte tabela:

&nbsp; | phpMussel *NÃO* deve bloquear um arquivo | phpMussel *DEVE* bloquear um arquivo
---|---|---
phpMussel *NÃO* bloquear um arquivo | Verdadeiro negativo (inferência correcta) | Detecção em falta (análogo a um falso negativo)
phpMussel *FAZ* bloquear um arquivo | __Falso positivo__ | Verdadeiro positivo (inferência correcta)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>Com que frequência as assinaturas são atualizadas?

A frequência das atualizações varia de acordo com os arquivos de assinatura em questão. Todos os mantenedores dos arquivos de assinatura de phpMussel geralmente tentam manter suas assinaturas atualizadas como é possível, mas devido a que todos nós temos vários outros compromissos, nossas vidas fora do projeto, e devido a que nenhum de nós é financeiramente compensado (ou pago) para nossos esforços no projeto, um cronograma de atualização preciso não pode ser garantido. Geralmente, as assinaturas são atualizadas sempre que há tempo suficiente para atualizá-las, e geralmente, os mantenedores tentam priorizar com base na necessidade e na frequência com que as mudanças ocorrem entre gamas. Assistência é sempre apreciada se você estiver disposto a oferecer qualquer.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>Eu encontrei um problema ao usar phpMussel e eu não sei o que fazer sobre isso! Ajude-me!

- Você está usando a versão mais recente do software? Você está usando as versões mais recentes de seus arquivos de assinatura? Se a resposta a qualquer destas duas perguntas é não, tente atualizar tudo primeiro, e verifique se o problema persiste. Se persistir, continue lendo.
- Você já examinou toda a documentação? Se não, por favor, faça isso. Se o problema não puder ser resolvido usando a documentação, continue lendo.
- Você já examinou a **[página de issues](https://github.com/phpMussel/phpMussel/issues)**, para ver se o problema foi mencionado antes? Se já foi mencionado antes, verificar se foram fornecidas sugestões, ideias e/ou soluções, e siga conforme necessário para tentar resolver o problema.
- Se o problema ainda persistir, por favor procure ajuda sobre isso através de criando um novo issue na página de issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Eu quero usar phpMussel com uma versão PHP mais velha do que 5.4.0; Você pode ajudar?

Não. PHP 5.4.0 chegou ao EoL ("End of Life", ou Fim da Vida) oficial em 2014, e suporte de segurança estendido foi terminado em 2015. Como de escrever isso, é 2017, e PHP 7.1.0 já está disponível. Neste momento, suporte é oferecido para o uso do phpMussel com PHP 5.4.0 e todas as versões PHP mais recentes disponíveis, mas se você tentar usar o phpMussel com versões mais antigas do PHP, o suporte não será fornecido.

*Veja também: [Gráficos de Compatibilidade](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Posso usar uma única instalação do phpMussel para proteger vários domínios?

Sim. As instalações do phpMussel não estão naturalmente atado com domínios específicos, e pode, portanto, ser usado para proteger vários domínios. Geralmente, referimo-nos a instalações do phpMussel que protegem apenas um domínio como "instalações de singular-domínio", e referimo-nos a instalações do phpMussel que protegem vários domínios e/ou subdomínios como "instalações multi-domínio". Se você operar uma instalação multi-domínio e precisa usar conjuntos diferentes de arquivos de assinaturas para domínios diferentes, ou precisam phpMussel para ser configurado de forma diferente para domínios diferentes, é possível fazer isso. Depois de carregar o arquivo de configuração (`config.ini`), o phpMussel verificará a existência de um "arquivo de sobreposição para a configuração" específico para o domínio (ou subdomínio) que está sendo solicitado (`o-domínio-que-está-sendo-solicitado.tld.config.ini`), e se encontrado, quaisquer valores de configuração definidos pelo arquivo de sobreposição para a configuração serão usados para a instância de execução em vez dos valores de configuração definidos pelo arquivo de configuração. Os arquivos de sobreposição para a configuração são idênticos ao arquivo de configuração, e a seu critério, pode conter a totalidade de todas as diretivas de configuração disponíveis para o phpMussel, ou qualquer subseção menor necessária que difere dos valores normalmente definidos pelo arquivo de configuração. Os arquivos de sobreposição para a configuração são nomeados de acordo com o domínio que eles são destinados para (por exemplo, se você precisar de um arquivo de sobreposição para a configuração para o domínio, `http://www.some-domain.tld/`, o seu arquivo de sobreposição para a configuração deve ser nomeado como `some-domain.tld.config.ini`, e deve ser colocado dentro da vault ao lado do arquivo de configuração, `config.ini`). O nome de domínio para a instância de execução é derivado do cabeçalho `HTTP_HOST` do pedido; "www" é ignorado.

#### <a name="PAY_YOU_TO_DO_IT"></a>Eu não quero mexer com a instalação deste e fazê-lo funcionar com o meu site; Posso pagar-te para fazer tudo por mim?

Talvez. Isso é considerado caso a caso. Deixe-nos saber do que você precisa, o que você está oferecendo, e nós vamos deixar você saber se podemos ajudar.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Posso contratar você ou qualquer um dos desenvolvedores deste projeto para o trabalho privado?

*Veja acima.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Preciso de modificações especializadas, customizações, etc; Você pode ajudar?

*Veja acima.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Eu sou um desenvolvedor, designer de site, ou programador. Posso aceitar ou oferecer trabalho relacionado a este projeto?

Sim. Nossa licença não proíbe isso.

#### <a name="WANT_TO_CONTRIBUTE"></a>Quero contribuir para o projeto; Posso fazer isso?

Sim. As contribuições para o projeto são muito bem-vindas. Consulte "CONTRIBUTING.md" para obter mais informações.

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>Valores recomendados para "ipaddr".

Valor | Usando
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy reverso Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy reverso Cloudflare.
`CF-Connecting-IP` | Proxy reverso Cloudflare (alternativa; se o acima não funcionar).
`HTTP_X_FORWARDED_FOR` | Proxy reverso Cloudbric.
`X-Forwarded-For` | [Proxy reverso Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Definido pela configuração do servidor.* | [Proxy reverso Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Nenhum proxy reverso (valor padrão).

#### <a name="SCAN_DEBUGGING"></a>Como acessar detalhes específicos sobre os arquivos quando eles são analisados?

Você pode acessar detalhes específicos sobre arquivos quando eles são analisados, atribuindo uma matriz para usar para esse propósito antes de instruir o phpMussel para analisá-los.

No exemplo abaixo, `$Foo` é atribuído para este propósito. Depois de analisar `/caminho/de/arquivo/...`, informações detalhadas sobre os arquivos contidos em `/caminho/de/arquivo/...` serão contidas por `$Foo`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/caminho/de/arquivo/...');

var_dump($Foo);
```

A matriz é uma matriz multidimensional consistindo em elementos que representam cada arquivo sendo analisado e subelementos que representam os detalhes sobre esses arquivos. Esses subelementos são os seguintes:

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

*† - Não fornecido com os resultados em cache (fornecido para novos resultados de análise apenas).*

*‡ - Fornecido ao analisar arquivos PE apenas.*

Opcionalmente, esta matriz pode ser destruída usando o seguinte:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Posso usar o cron para atualizar automaticamente?

Sim. Uma API é integrada no front-end para interagir com a página de atualizações por meio de scripts externos. Um script separado, "[Cronable](https://github.com/Maikuolan/Cronable)", está disponível, e pode ser usado pelo seu cron manager ou cron scheduler para atualizar este e outros pacotes suportados automaticamente (este script fornece sua própria documentação).

#### <a name="SCAN_NON_ANSI"></a>O phpMussel pode analisar arquivos com nomes não-ANSI?

Digamos que haja um diretório que você queira analisar. Neste diretório, você tem alguns arquivos com nomes não-ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Vamos supor que você esteja usando o modo CLI ou a API do phpMussel para fazer a análise.

Ao usar o PHP < 7.1.0, em alguns sistemas, o phpMussel não verá esses arquivos ao tentar analisar o diretório e, portanto, não conseguirá analisar esses arquivos. Você provavelmente verá os mesmos resultados como se fosse analisar um diretório vazio:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Começado.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

Além disso, ao usar o PHP < 7.1.0, analisando os arquivos individualmente produz resultados como estes:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Começado.
 > Verificando 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Arquivo inválido!
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

Ou estes:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Começado.
 > X:/directory/??????.txt não é um arquivo ou diretório.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

Isto é devido à maneira como o PHP lidou com nomes de arquivos não-ANSI antes do PHP 7.1.0. Se você tiver esse problema, a solução é atualizar sua instalação do PHP para 7.1.0 ou mais recente. No PHP >= 7.1.0, nomes de arquivos não-ANSI são tratados melhor, e o phpMussel deve ser capaz de analisar os arquivos corretamente.

Para comparação, os resultados ao tentar analisar o diretório usando PHP >= 7.1.0:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Começado.
 -> Verificando '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Não problemas encontrados.
 -> Verificando '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Não problemas encontrados.
 -> Verificando '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Não problemas encontrados.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

E tentando analisar os arquivos individualmente:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Começado.
 > Verificando 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Não problemas encontrados.
 Sun, 01 Apr 2018 22:27:41 +0800 Terminado.
```

#### <a name="BLACK_WHITE_GREY"></a>Blacklists (listas negras) – Whitelists (listas brancas) – Greylists (listas cinzentas) – Quais são eles e como eu os uso?

Os termos têm diferentes significados em diferentes contextos. No phpMussel, existem três contextos em que esses termos são usados: Resposta do tamanho do arquivo, resposta do tipo de arquivo, e a lista cinza das assinaturas.

A fim de alcançar um resultado desejado a um custo mínimo para o processamento, existem algumas coisas simples que o phpMussel pode verificar antes de realmente verificar os arquivos, como tamanho, nome e extensão de um arquivo. Por exemplo; Se um arquivo é muito grande, ou se sua extensão indicar um tipo de arquivo que não queremos permitir em nossos sites de qualquer maneira, podemos marcar o arquivo imediatamente e não há necessidade de analisá-lo.

A resposta do tamanho do arquivo é a maneira como o phpMussel responde quando um arquivo excede um limite especificado. Embora nenhuma lista real esteja envolvida, um arquivo pode ser considerado na lista negra, na lista branca, ou na lista cinza, com base em seu tamanho. Existem duas diretivas de configuração opcionais separadas para especificar um limite e uma resposta desejada, respectivamente.

A resposta do tipo de arquivo é a maneira como o phpMussel responde à extensão do arquivo. Existem três diretivas de configuração opcionais separadas para especificar explicitamente quais extensões devem ser colocadas na lista negra, na lista de branca, ou na lista cinza. Um arquivo pode ser considerado na lista negra, na lista de branca, ou na lista cinza, se sua extensão corresponder a qualquer uma das extensões especificadas, respectivamente.

Nestes dois contextos, a lista branca significa que não deve ser analisada ou marcada; estar na lista negra significa que deve ser marcada (e que, portanto, não precisamos analisá-lo); e estar na lista cinza significa uma análise mais aprofundada é necessária para determinar se devemos marcá-lo (isto é, deve ser analisado).

A lista cinza da assinaturas é uma lista de assinaturas que devem ser essencialmente ignoradas (isso é brevemente mencionado anteriormente na documentação). Quando uma assinatura na lista cinza é desencadeadas, o phpMussel continua a trabalhar através de suas assinaturas e não toma nenhuma ação específica em relação à assinatura na lista cinza. Não há lista negra da assinaturas, porque o comportamento implícito é o comportamento normal para assinaturas desencadeadas de qualquer maneira, e não há lista branca da assinaturas, porque o comportamento implícito não faria realmente sentido em relação ao funcionamento normal do phpMussel e aos recursos que ele já possui.

A lista de cinza da assinaturas é útil se você precisar resolver problemas causados por uma assinatura específica sem desabilitar ou desinstalar todo os arquivo do assinaturas.

---


### 11. <a name="SECTION11"></a>INFORMAÇÃO LEGAL

#### 11.0 SECTION PREAMBLE

This section of the documentation is intended to describe possible legal considerations regarding the use and implementation of the package, and to provide some basic related information. This may be important for some users as a means to ensure compliancy with any legal requirements that may exist in the countries that they operate in, and some users may need to adjust their website policies in accordance with this information.

First and foremost, please realise that I (the package author) am not a lawyer, nor a qualified legal professional of any kind. Therefore, I am not legally qualified to provide legal advice. Also, in some cases, exact legal requirements may vary between different countries and jurisdictions, and these varying legal requirements may sometimes conflict (such as, for example, in the case of countries that favour privacy rights and the right to be forgotten, versus countries that favour extended data retention). Consider also that access to the package is not restricted to specific countries or jurisdictions, and therefore, the package userbase is likely to the geographically diverse. These points considered, I'm not in a position to state what it means to be "legally compliant" for all users, in all regards. However, I hope that the information herein will help you to come to a decision yourself regarding what you must do in order to remain legally compliant in the context of the package. If you have any doubts or concerns regarding the information herein, or if you need additional help and advice from a legal perspective, I would recommend consulting a qualified legal professional.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Relevant configuration directives:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Relevant configuration directives:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevant configuration directives:*
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

*Relevant configuration directives:*
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

*Relevant configuration directives:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Relevant configuration directives:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Relevant configuration directives:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Relevant configuration directives:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Relevant configuration directives:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Relevant configuration directives:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Relevant configuration directives:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Relevant configuration directives:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

The General Data Protection Regulation (GDPR) is a regulation of the European Union, which comes into effect as of May 25, 2018. The primary goal of the regulation is to give control to EU citizens and residents regarding their own personal data, and to unify regulation within the EU concerning privacy and personal data.

The regulation contains specific provisions pertaining to the processing of "personally identifiable information" (PII) of any "data subjects" (any identified or identifiable natural person) either from or within the EU. To be compliant with the regulation, "enterprises" (as per defined by the regulation), and any relevant systems and processes must implement "privacy by design" by default, must use the highest possible privacy settings, must implement necessary safeguards for any stored or processed information (including, but not limited to, the implementation of pseudonymisation or full anonymisation of data), must clearly and unambiguously declare the types of data they collect, how they process it, for what reasons, for how long they retain it, and whether they share this data with any third parties, the types of data shared with third parties, how, why, and so on.

Data may not be processed unless there's a lawful basis for doing so, as per defined by the regulation. Generally, this means that in order to process a data subject's data on a lawful basis, it must be done in compliance with legal obligations, or done only after explicit, well-informed, unambiguous consent has been obtained from the data subject.

Because aspects of the regulation may evolve in time, in order to avoid the propagation of outdated information, it may be better to learn about the regulation from an authoritative source, as opposed to simply including the relevant information here in the package documentation (which may eventually become outdated as the regulation evolves).

[EUR-Lex](https://eur-lex.europa.eu/) (a part of the official website of the European Union that provides information about EU law) provides extensive information about GDPR/DSGVO, available in 24 different languages (at the time of writing this), and available for download in PDF format. I would definitely recommend reading the information that they provide, in order to learn more about GDPR/DSGVO:
- [REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679)

Alternatively, there's a brief (non-authoritative) overview of GDPR/DSGVO available at Wikipedia:
- [General Data Protection Regulation](https://en.wikipedia.org/wiki/General_Data_Protection_Regulation)

---


Última Atualização: 25 Maio de 2018 (2018.05.25).
