<?php
/**
 * This file is a part of the phpMussel package, and can be downloaded for free
 * from {@link https://github.com/Maikuolan/phpMussel/ GitHub}.
 *
 * PHPMUSSEL COPYRIGHT 2013 AND BEYOND BY THE PHPMUSSEL TEAM.
 *
 * Authors:
 * @see PEOPLE.md
 *
 * License: GNU/GPLv2
 * @see LICENSE.txt
 *
 * This file: Portuguese language data (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

$phpMussel['Config']['lang']['bad_command'] = 'Eu não entendo esse comando, desculpe.';
$phpMussel['Config']['lang']['cli_commands'] = " q\n - Deixar CLI.\n - Alias: quit, exit.\n md5_file\n - Gerar MD5 assinaturas de arquivos [Sintaxe: md5_file nome_do_arquivo].\n - Alias: m.\n md5\n - Gerar MD5 assinatura de string [Sintaxe: md5 string].\n hex_encode\n - Converter binária string para hexadecimal [Sintaxe: hex_encode string].\n - Alias: x.\n hex_decode\n - Converter hexadecimal para binária string [Sintaxe: hex_decode string].\n base64_encode\n - Converter binária string para base64 string [Sintaxe: base64_encode string].\n - Alias: b.\n base64_decode\n - Converter base64 string para binária string [Sintaxe: base64_decode string].\n scan\n - Verificação arquivo ou diretório [Sintaxe: scan nome_do_arquivo].\n - Alias: s.\n update\n - Atualizar phpMussel.\n - Alias: u.\n c\n - Imprimir esta lista de comandos.\n";
$phpMussel['Config']['lang']['cli_failed_to_complete'] = 'Falha ao completar processo de verificação';
$phpMussel['Config']['lang']['cli_is_not_a'] = ' não é um arquivo ou diretório.';
$phpMussel['Config']['lang']['cli_ln2'] = " Obrigado por usando phpMussel, um PHP script projetado para detectar trojans,\n vírus, malware e outras ameaças dentro dos arquivos enviados para o seu\n sistema onde quer que o script é enganchado, baseado no assinaturas do ClamAV\n e outros.\n\n PHPMUSSEL COPYRIGHT 2013 e além GNU/GPL V.2 através do Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['Config']['lang']['cli_ln3'] = " Correntemente execução phpMussel em CLI modo (comando linha interface).\n\n Para analisar um arquivo ou diretório, digitá 'scan', seguido pelo nome do\n arquivo ou diretório que você deseja phpMussel para analisar e pressione\n Enter; Digitá 'c' e pressione Enter por uma lista de CLI modo comandos; Digitá\n 'q' e pressione Enter para sair:";
$phpMussel['Config']['lang']['cli_pe1'] = 'Não é um válido PE arquivo!';
$phpMussel['Config']['lang']['cli_pe2'] = 'PE Seções:';
$phpMussel['Config']['lang']['cli_update_restart'] = " Reiniciando phpMussel podem ser necessários antes que as atualizações se\n tornam aparentes.";
$phpMussel['Config']['lang']['cli_working'] = 'Em processo';
$phpMussel['Config']['lang']['controls_lockout'] = 'phpMussel controles bloqueios ativado.';
$phpMussel['Config']['lang']['core_scriptfile_missing'] = 'Núcleo script arquivo ausente! Por favor, reinstale phpMussel.';
$phpMussel['Config']['lang']['corrupted'] = 'Detectado corrompido PE';
$phpMussel['Config']['lang']['denied'] = 'Carregar Negado!';
$phpMussel['Config']['lang']['denied_other'] = 'Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! Sự tải lên đã bị từ chối!';
$phpMussel['Config']['lang']['denied_reason'] = 'Carregamento tentativa foi bloqueado pelos motivos a seguir indicados / Your upload was blocked for the reasons listed below:';
$phpMussel['Config']['lang']['detected'] = 'Detectado {vn}';
$phpMussel['Config']['lang']['detected_control_characters'] = 'Caracteres de controle detectado';
$phpMussel['Config']['lang']['encrypted_archive'] = 'Detectado compactado arquivo criptografado; Compactado arquivos criptografados não permitido';
$phpMussel['Config']['lang']['failed_to_access'] = 'Falha ao acesso ';
$phpMussel['Config']['lang']['file'] = 'Arquivo';
$phpMussel['Config']['lang']['filesize_limit_exceeded'] = 'Arquivo tamanho limite excedido';
$phpMussel['Config']['lang']['filetype_blacklisted'] = 'Tipo de arquivo está na negra lista';
$phpMussel['Config']['lang']['finished'] = 'Terminado';
$phpMussel['Config']['lang']['generated_by'] = 'Gerado por';
$phpMussel['Config']['lang']['greylist_cleared'] = ' Greylist esvaziado.';
$phpMussel['Config']['lang']['greylist_not_updated'] = ' Greylist não atualizado.';
$phpMussel['Config']['lang']['greylist_updated'] = ' Greylist atualizado.';
$phpMussel['Config']['lang']['image'] = 'Imagem';
$phpMussel['Config']['lang']['instance_already_active'] = 'Instância já está ativo! Por favor, verifique seus ganchos.';
$phpMussel['Config']['lang']['invalid_file'] = 'Inválido arquivo';
$phpMussel['Config']['lang']['invalid_url'] = 'Inválido URL!';
$phpMussel['Config']['lang']['ok'] = 'OK';
$phpMussel['Config']['lang']['only_allow_images'] = 'Carregar de arquivos que não são imagens não é permitida';
$phpMussel['Config']['lang']['phpmussel_disabled'] = 'phpMussel desativado.';
$phpMussel['Config']['lang']['phpmussel_disabled_already'] = 'phpMussel já desativado.';
$phpMussel['Config']['lang']['phpmussel_enabled'] = 'phpMussel ativado.';
$phpMussel['Config']['lang']['phpmussel_enabled_already'] = 'phpMussel já ativado.';
$phpMussel['Config']['lang']['plugins_directory_nonexistent'] = 'Diretório de plugins não existe!';
$phpMussel['Config']['lang']['recursive'] = 'Recursão profundidade limite excedido';
$phpMussel['Config']['lang']['required_variables_not_defined'] = 'Variáveis necessárias não estão definidas: Não pode continuar.';
$phpMussel['Config']['lang']['scan_aborted'] = 'Verificação abortado!';
$phpMussel['Config']['lang']['scan_chameleon'] = '{x} camaleão ataque detectado';
$phpMussel['Config']['lang']['scan_checking'] = 'Verificação';
$phpMussel['Config']['lang']['scan_checking_contents'] = 'Sucesso! Prosseguindo para verificar o conteúdo.';
$phpMussel['Config']['lang']['scan_command_injection'] = 'Comando injeção tentativa detectado';
$phpMussel['Config']['lang']['scan_complete'] = 'Completo';
$phpMussel['Config']['lang']['scan_extensions_missing'] = 'Fracassado (faltando extensões necessárias)!';
$phpMussel['Config']['lang']['scan_filename_manipulation_detected'] = 'Arquivo nome manipulação detectado';
$phpMussel['Config']['lang']['scan_map_corrupted'] = 'Assinatura mapa corrompido';
$phpMussel['Config']['lang']['scan_map_missing'] = 'Assinatura mapa faltando';
$phpMussel['Config']['lang']['scan_missing_filename'] = 'Nome do arquivo está ausente';
$phpMussel['Config']['lang']['scan_not_archive'] = 'Fracassado (vazio ou não um arquivo)!';
$phpMussel['Config']['lang']['scan_no_problems_found'] = 'Não problemas encontrados.';
$phpMussel['Config']['lang']['scan_reading'] = 'Lendo';
$phpMussel['Config']['lang']['scan_signature_file_corrupted'] = 'Assinatura arquivo corrompido';
$phpMussel['Config']['lang']['scan_signature_file_missing'] = 'Assinatura arquivo faltando';
$phpMussel['Config']['lang']['scan_tampering'] = 'Detectado potencialmente perigoso arquivo adulteração';
$phpMussel['Config']['lang']['scan_unauthorised_upload'] = 'Não autorizada arquivo carregar manipulação detectado';
$phpMussel['Config']['lang']['scan_unauthorised_upload_or_misconfig'] = 'Não autorizada arquivo carregar manipulação ou mau configuração detectado! ';
$phpMussel['Config']['lang']['started'] = 'Começado';
$phpMussel['Config']['lang']['too_many_urls'] = 'Demasiados URLs';
$phpMussel['Config']['lang']['update_'] = 'phpMussel agora tentará se atualizar.';
$phpMussel['Config']['lang']['update_available'] = 'Uma atualização de script está disponível.';
$phpMussel['Config']['lang']['update_complete'] = 'Verificação de atualização concluída com êxito.';
$phpMussel['Config']['lang']['update_created'] = 'criado';
$phpMussel['Config']['lang']['update_deleted'] = 'deletado';
$phpMussel['Config']['lang']['update_err1'] = 'Falha na atualização: \'update.dat\' não presente. Reinstalar ou atualizar manualmente.';
$phpMussel['Config']['lang']['update_err2'] = 'Falha na atualização: \'update.dat\' não contém quaisquer válidos fontes de atualização. Por favor, atualizar manualmente.';
$phpMussel['Config']['lang']['update_err3'] = 'Possível hack ou falsificação detectado nas instruções fornecidas pela fonte do atualização; A fonte pode possivelmente ser comprometida. Por favor, informe o autor. Atualizando manualmente é recomendado.';
$phpMussel['Config']['lang']['update_err4'] = 'Checksum não presente!';
$phpMussel['Config']['lang']['update_err5'] = 'Dados não presente!';
$phpMussel['Config']['lang']['update_err6'] = 'Dados inválidos!';
$phpMussel['Config']['lang']['update_err7'] = 'Checksum inválido!';
$phpMussel['Config']['lang']['update_failed'] = 'Fracassado.';
$phpMussel['Config']['lang']['update_fetch'] = 'Tentando buscar versão informação de {Location} ...';
$phpMussel['Config']['lang']['update_lock_detected'] = 'Atualização bloqueio detectado: Não pode continuar. Verificar por atualizações corruptos ou tente novamente mais tarde.';
$phpMussel['Config']['lang']['update_not'] = 'NÃO {x}';
$phpMussel['Config']['lang']['update_not_available'] = 'Nenhuma script atualização está disponível no momento.';
$phpMussel['Config']['lang']['update_not_possible'] = 'Uma script atualização está disponível, mas não pode ser totalmente atualizado com esta versão do atualização script. Por favor atualize manualmente.';
$phpMussel['Config']['lang']['update_no_source'] = 'phpMussel falhou a atualizar-se porque não pôde conectar a uma válido atualização fonte. Atualizando manualmente é recomendado.';
$phpMussel['Config']['lang']['update_patched'] = 'remendado';
$phpMussel['Config']['lang']['update_scriptfile_missing'] = ' Atualização script arquivo faltando! Por favor, reinstale phpMussel.';
$phpMussel['Config']['lang']['update_seconds_elapsed'] = ' segundos transcorridos';
$phpMussel['Config']['lang']['update_signatures_available'] = 'Uma atualização de assinaturas está disponível.';
$phpMussel['Config']['lang']['update_signatures_latest'] = 'ÚLTIMAS ASSINATURAS';
$phpMussel['Config']['lang']['update_signatures_not_available'] = 'Nenhuma atualização de assinaturas está disponível neste momento.';
$phpMussel['Config']['lang']['update_signatures_yours'] = 'SEUS ASSINATURAS';
$phpMussel['Config']['lang']['update_success'] = 'Sucesso.';
$phpMussel['Config']['lang']['update_successfully'] = ' com sucesso';
$phpMussel['Config']['lang']['update_version_latest'] = 'ÚLTIMA SCRIPT VERSÃO';
$phpMussel['Config']['lang']['update_version_yours'] = 'SEU SCRIPT VERSÃO';
$phpMussel['Config']['lang']['update_was'] = '{x}';
$phpMussel['Config']['lang']['update_wrd1'] = 'assinaturas';
$phpMussel['Config']['lang']['upload_error_1'] = 'Arquivo tamanho excede a directiva upload_max_filesize. ';
$phpMussel['Config']['lang']['upload_error_2'] = 'Arquivo tamanho excede o formulário especificados arquivo tamanho limite. ';
$phpMussel['Config']['lang']['upload_error_34'] = 'Carregar falha! Contato o hostmaster para ajuda! ';
$phpMussel['Config']['lang']['upload_error_6'] = 'Carregar diretório faltando! Contato o hostmaster para ajuda! ';
$phpMussel['Config']['lang']['upload_error_7'] = 'Disco escrita erro! Contato o hostmaster para ajuda! ';
$phpMussel['Config']['lang']['upload_error_8'] = 'PHP mau configuração detectado! Contato o hostmaster para ajuda! ';
$phpMussel['Config']['lang']['upload_limit_exceeded'] = 'Carregar limite excedido';
$phpMussel['Config']['lang']['wrong_password'] = 'Contrasenha errada; Ação negado.';
$phpMussel['Config']['lang']['x_does_not_exist'] = 'não existe';
$phpMussel['Config']['lang']['_exclamation'] = '! ';
$phpMussel['Config']['lang']['_exclamation_final'] = '!';
$phpMussel['Config']['lang']['_fullstop'] = '. ';
$phpMussel['Config']['lang']['_fullstop_final'] = '.';
