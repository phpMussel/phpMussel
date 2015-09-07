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
 This File: phpMussel Portuguese/Português Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.pt.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Eu não entendo esse comando, desculpe.';
$MusselConfig['lang']['cli_commands']=" q\n - Deixar CLI.\n - Alias: quit, exit.\n md5_file\n - Gerar MD5 assinaturas de arquivos [Sintaxe: md5_file nome_do_arquivo].\n - Alias: m.\n md5\n - Gerar MD5 assinatura de string [Sintaxe: md5 string].\n hex_encode\n - Converter binária string para hexadecimal [Sintaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Converter hexadecimal para binária string [Sintaxe: hex_decode string].\n base64_encode\n - Converter binária string para base64 string [Sintaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Converter base64 string para binária string [Sintaxe: base64_decode string].\n scan\n - Verificação arquivo ou diretório [Sintaxe: scan nome_do_arquivo].\n - Alias: s.\n update\n - Atualizar phpMussel.\n - Alias: u.\n c\n - Imprimir esta lista de comandos.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Falha ao completar processo de verificação';
$MusselConfig['lang']['cli_is_not_a']=' não é um arquivo ou diretório.';
$MusselConfig['lang']['cli_ln2']=" Obrigado por usando phpMussel, um PHP script projetado para detectar trojans,\n vírus, malware e outras ameaças dentro dos arquivos enviados para o seu\n sistema onde quer que o script é enganchado, baseado no assinaturas do ClamAV\n e outros.\n\n PHPMUSSEL COPYRIGHT 2013 e além GNU/GPL V.2 através do Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" Correntemente execução phpMussel em CLI modo (Comando linha interface).\n\n Para analisar um arquivo ou diretório, digitá 'scan', seguido pelo nome do\n arquivo ou diretório que você deseja phpMussel para analisar e pressione\n Enter; Digitá 'c' e pressione Enter por uma lista de CLI modo comandos; Digitá\n 'q' e pressione Enter para sair:";
$MusselConfig['lang']['cli_pe1']='Não é um válido PE arquivo!';
$MusselConfig['lang']['cli_pe2']='PE Seções:';
$MusselConfig['lang']['cli_update_restart']=" Reiniciando phpMussel podem ser necessários antes que as atualizações se\n tornam aparentes.";
$MusselConfig['lang']['cli_working']='Em processo';
$MusselConfig['lang']['controls_lockout']='phpMussel controles bloqueios ativado.';
$MusselConfig['lang']['core_scriptfile_missing']='Núcleo script arquivo ausente! Por favor, reinstale phpMussel.';
$MusselConfig['lang']['corrupted']='Detectado corrompido PE';
$MusselConfig['lang']['denied']='Carregar Negado!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Carregamento tentativa foi bloqueado pelos motivos a seguir indicados / Your upload was blocked for the reasons listed below:';
$MusselConfig['lang']['detected']='Detectado {vn}';
$MusselConfig['lang']['detected_control_characters']='Detectados Controle Caracteres';
$MusselConfig['lang']['encrypted_archive']='Detectado compactado arquivo criptografado; Compactado arquivos criptografados não permitido';
$MusselConfig['lang']['failed_to_access']='Falha ao acesso ';
$MusselConfig['lang']['file']='Arquivo';
$MusselConfig['lang']['filesize_limit_exceeded']='Arquivo tamanho limite excedido';
$MusselConfig['lang']['filetype_blacklisted']='Tipo de arquivo está na negra lista';
$MusselConfig['lang']['finished']='Terminado';
$MusselConfig['lang']['generated_by']='Gerado por';
$MusselConfig['lang']['greylist_cleared']=' Greylist esvaziado.';
$MusselConfig['lang']['greylist_not_updated']=' Greylist não atualizado.';
$MusselConfig['lang']['greylist_updated']=' Greylist atualizado.';
$MusselConfig['lang']['image']='Imagem';
$MusselConfig['lang']['instance_already_active']='Instância já está ativo! Por favor, verifique seus ganchos.';
$MusselConfig['lang']['invalid_file']='Inválido arquivo';
$MusselConfig['lang']['ok']='OK';
$MusselConfig['lang']['only_allow_images']='Carregar de arquivos que não são imagens não é permitida';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel desativado.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel já desativado.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel ativado.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel já ativado.';
$MusselConfig['lang']['recursive']='Recursão profundidade limite excedido';
$MusselConfig['lang']['refer_to_scan_kills']=' (referem a '.$MusselConfig['general']['scan_kills'].' para detalhes)';
$MusselConfig['lang']['required_variables_not_defined']='Variáveis necessárias não estão definidas: Não pode continuar.';
$MusselConfig['lang']['scan_aborted']='Verificação abortado';
$MusselConfig['lang']['scan_chameleon']='{x} camaleão ataque detectado';
$MusselConfig['lang']['scan_checking']='Verificação';
$MusselConfig['lang']['scan_checking_contents']='Sucesso! Prosseguindo para verificar o conteúdo.';
$MusselConfig['lang']['scan_command_injection']='Comando injeção tentativa detectado';
$MusselConfig['lang']['scan_complete']='Completo';
$MusselConfig['lang']['scan_extensions_missing']='Fracassado (faltando extensões necessárias)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Arquivo nome manipulação detectado';
$MusselConfig['lang']['scan_map_corrupted']='Assinatura mapa corrompido';
$MusselConfig['lang']['scan_map_missing']='Assinatura mapa faltando';
$MusselConfig['lang']['scan_missing_filename']='Nome do arquivo está ausente';
$MusselConfig['lang']['scan_not_archive']='Fracassado (vazio ou não um arquivo)!';
$MusselConfig['lang']['scan_no_problems_found']='Não problemas encontrados.';
$MusselConfig['lang']['scan_reading']='Lendo';
$MusselConfig['lang']['scan_signature_file_corrupted']='Assinatura arquivo corrompido';
$MusselConfig['lang']['scan_signature_file_missing']='Assinatura arquivo faltando';
$MusselConfig['lang']['scan_tampering']='Detectado potencialmente perigoso arquivo adulteração';
$MusselConfig['lang']['scan_unauthorised_upload']='Não autorizada Arquivo carregar manipulação detectado';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Não autorizada Arquivo carregar manipulação ou mau configuração detectado! ';
$MusselConfig['lang']['started']='Começado';
$MusselConfig['lang']['update_']='phpMussel agora tentará se atualizar.';
$MusselConfig['lang']['update_available']='Uma atualização de script está disponível.';
$MusselConfig['lang']['update_complete']='Verificação de atualização concluída com êxito.';
$MusselConfig['lang']['update_created']='criado';
$MusselConfig['lang']['update_deleted']='deletado';
$MusselConfig['lang']['update_err1']='Falha na atualização: \'update.dat\' não presente. Reinstalar ou atualizar manualmente.';
$MusselConfig['lang']['update_err2']='Falha na atualização: \'update.dat\' não contém quaisquer válidos fontes de atualização. Por favor, atualizar manualmente.';
$MusselConfig['lang']['update_err3']='Possível hack ou falsificação detectado nas instruções fornecidas pela fonte do atualização; A fonte pode possivelmente ser comprometida. Por favor, informe o autor. Atualizando manualmente é recomendado.';
$MusselConfig['lang']['update_err4']='Checksum não presente!';
$MusselConfig['lang']['update_err5']='Dados não presente!';
$MusselConfig['lang']['update_err6']='Dados inválidos!';
$MusselConfig['lang']['update_err7']='Checksum inválido!';
$MusselConfig['lang']['update_failed']='Fracassado.';
$MusselConfig['lang']['update_fetch']='A tentativa de buscar dados de versão de';
$MusselConfig['lang']['update_lock_detected']='Atualização bloqueio detectado: Não pode continuar. Verificar por atualizações corruptos ou tente novamente mais tarde.';
$MusselConfig['lang']['update_not']='NÃO {x}';
$MusselConfig['lang']['update_not_available']='Nenhuma script atualização está disponível no momento.';
$MusselConfig['lang']['update_not_possible']='Uma script atualização está disponível, mas não pode ser totalmente atualizado com esta versão do atualização script. Por favor atualize manualmente.';
$MusselConfig['lang']['update_no_source']='phpMussel falhou a atualizar-se porque não pôde conectar a uma válido atualização fonte. Atualizando manualmente é recomendado.';
$MusselConfig['lang']['update_patched']='remendado';
$MusselConfig['lang']['update_scriptfile_missing']=' Atualização script arquivo faltando! Por favor, reinstale phpMussel.';
$MusselConfig['lang']['update_seconds_elapsed']=' segundos transcorridos';
$MusselConfig['lang']['update_signatures_available']='Uma atualização de assinaturas está disponível.';
$MusselConfig['lang']['update_signatures_latest']='ÚLTIMAS ASSINATURAS';
$MusselConfig['lang']['update_signatures_not_available']='Nenhuma atualização de assinaturas está disponível neste momento.';
$MusselConfig['lang']['update_signatures_yours']='SEUS ASSINATURAS';
$MusselConfig['lang']['update_success']='Sucesso.';
$MusselConfig['lang']['update_successfully']=' com sucesso';
$MusselConfig['lang']['update_version_latest']='ÚLTIMA SCRIPT VERSÃO';
$MusselConfig['lang']['update_version_yours']='SEU SCRIPT VERSÃO';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='assinaturas';
$MusselConfig['lang']['upload_error_1']='Arquivo tamanho excede MAX_FILE_SIZE directiva. ';
$MusselConfig['lang']['upload_error_2']='Arquivo tamanho excede formulário especificados arquivo tamanho limite. ';
$MusselConfig['lang']['upload_error_34']='Carregar falha! Contato o hostmaster para ajuda! ';
$MusselConfig['lang']['upload_error_6']='Carregar diretório faltando! Contato o hostmaster para ajuda! ';
$MusselConfig['lang']['upload_error_7']='Disco escrita erro! Contato o hostmaster para ajuda! ';
$MusselConfig['lang']['upload_error_8']='PHP mau configuração detectado! Contato o hostmaster para ajuda! ';
$MusselConfig['lang']['upload_limit_exceeded']='Carregar limite excedido';
$MusselConfig['lang']['wrong_password']='Contrasenha errada; Ação negado.';
$MusselConfig['lang']['x_does_not_exist']='não existe';

?>