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
 * This file: Portuguese language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

/** Language plurality rule. */
$phpMussel['Plural-Rule'] = function($Num) {
    return ($Num >= 0 || $Num <= 1) ? 0 : 1;
};

$phpMussel['lang']['bad_command'] = 'Eu não entendo esse comando, desculpe.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Falha ao completar processo de verificação';
$phpMussel['lang']['cli_is_not_a'] = ' não é um arquivo ou diretório.';
$phpMussel['lang']['cli_ln2'] = " Obrigado por usando phpMussel, um PHP script projetado para detectar trojans,\n vírus, malware e outras ameaças dentro dos arquivos enviados para o seu\n sistema onde quer que o script é enganchado, baseado no assinaturas do ClamAV\n e outros.\n\n PHPMUSSEL COPYRIGHT 2013 e além GNU/GPL V.2 através do Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " Correntemente execução phpMussel em CLI modo (comando linha interface).\n\n Para analisar um arquivo ou diretório, digitá 'scan', seguido pelo nome do\n arquivo ou diretório que você deseja phpMussel para analisar e pressione\n Enter; Digitá 'c' e pressione Enter por uma lista de CLI modo comandos; Digitá\n 'q' e pressione Enter para sair:";
$phpMussel['lang']['cli_pe1'] = 'Não é um válido PE arquivo!';
$phpMussel['lang']['cli_pe2'] = 'PE Seções:';
$phpMussel['lang']['cli_signature_placeholder'] = 'O-NOME-DA-SUA-ASSINATURA';
$phpMussel['lang']['cli_working'] = 'Em processo';
$phpMussel['lang']['corrupted'] = 'Detectado corrompido PE';
$phpMussel['lang']['data_not_available'] = 'Dados não disponíveis.';
$phpMussel['lang']['denied'] = 'Carregar Negado!';
$phpMussel['lang']['denied_reason'] = 'Carregamento tentativa foi bloqueado pelos motivos a seguir indicados:';
$phpMussel['lang']['detected'] = 'Detectado {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Caracteres de controle detectado';
$phpMussel['lang']['encrypted_archive'] = 'Detectado compactado arquivo criptografado; Compactado arquivos criptografados não permitido';
$phpMussel['lang']['failed_to_access'] = 'Falha ao acesso ';
$phpMussel['lang']['file'] = 'Arquivo';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Arquivo tamanho limite excedido';
$phpMussel['lang']['filetype_blacklisted'] = 'Tipo de arquivo está na negra lista';
$phpMussel['lang']['finished'] = 'Terminado';
$phpMussel['lang']['generated_by'] = 'Gerado por';
$phpMussel['lang']['greylist_cleared'] = ' Greylist esvaziado.';
$phpMussel['lang']['greylist_not_updated'] = ' Greylist não atualizado.';
$phpMussel['lang']['greylist_updated'] = ' Greylist atualizado.';
$phpMussel['lang']['image'] = 'Imagem';
$phpMussel['lang']['instance_already_active'] = 'Instância já está ativo! Por favor, verifique seus ganchos.';
$phpMussel['lang']['invalid_data'] = 'Dados inválidos!';
$phpMussel['lang']['invalid_file'] = 'Arquivo inválido';
$phpMussel['lang']['invalid_url'] = 'URL inválido!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Carregar de arquivos que não são imagens não é permitida';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Diretório de plugins não existe!';
$phpMussel['lang']['quarantined_as'] = "Em quarentena como \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Recursão profundidade limite excedido';
$phpMussel['lang']['required_variables_not_defined'] = 'Variáveis necessárias não estão definidas: Não pode continuar.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL potencialmente perigoso detectado';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Erro de solicitação do API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Erro de autorização do API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Serviço do API está indisponível';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Erro do API desconhecida';
$phpMussel['lang']['scan_aborted'] = 'Verificação abortado!';
$phpMussel['lang']['scan_chameleon'] = '{x} camaleão ataque detectado';
$phpMussel['lang']['scan_checking'] = 'Verificação';
$phpMussel['lang']['scan_checking_contents'] = 'Sucesso! Prosseguindo para verificar o conteúdo.';
$phpMussel['lang']['scan_command_injection'] = 'Comando injeção tentativa detectado';
$phpMussel['lang']['scan_complete'] = 'Completo';
$phpMussel['lang']['scan_extensions_missing'] = 'Fracassado (faltando extensões necessárias)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Arquivo nome manipulação detectado';
$phpMussel['lang']['scan_missing_filename'] = 'Nome do arquivo está ausente';
$phpMussel['lang']['scan_not_archive'] = 'Fracassado (vazio ou não um arquivo)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Não problemas encontrados.';
$phpMussel['lang']['scan_reading'] = 'Lendo';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Assinatura arquivo corrompido';
$phpMussel['lang']['scan_signature_file_missing'] = 'Assinatura arquivo faltando';
$phpMussel['lang']['scan_tampering'] = 'Detectado potencialmente perigoso arquivo adulteração';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Não autorizada arquivo carregar manipulação detectado';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Não autorizada arquivo carregar manipulação ou mau configuração detectado! ';
$phpMussel['lang']['started'] = 'Começado';
$phpMussel['lang']['too_many_urls'] = 'Demasiados URLs';
$phpMussel['lang']['upload_error_1'] = 'Arquivo tamanho excede a directiva upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'Arquivo tamanho excede o formulário especificados arquivo tamanho limite. ';
$phpMussel['lang']['upload_error_34'] = 'Carregar falha! Contato o hostmaster para ajuda! ';
$phpMussel['lang']['upload_error_6'] = 'Carregar diretório faltando! Contato o hostmaster para ajuda! ';
$phpMussel['lang']['upload_error_7'] = 'Disco escrita erro! Contato o hostmaster para ajuda! ';
$phpMussel['lang']['upload_error_8'] = 'PHP mau configuração detectado! Contato o hostmaster para ajuda! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Carregar limite excedido';
$phpMussel['lang']['wrong_password'] = 'Contrasenha errada; Ação negado.';
$phpMussel['lang']['x_does_not_exist'] = 'não existe';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Deixar CLI.
 - Alias: quit, exit.
 md5_file
 - Gerar MD5 assinaturas de arquivos [Sintaxe: md5_file arquivo].
 - Alias: m.
 sha1_file
 - Gerar SHA1 assinaturas de arquivos [Sintaxe: sha1_file arquivo].
 md5
 - Gerar MD5 assinatura de string [Sintaxe: md5 string].
 sha1
 - Gerar SHA1 assinatura de string [Sintaxe: sha1 string].
 hex_encode
 - Converter binária string para hexadecimal [Sintaxe: hex_encode string].
 - Alias: x.
 hex_decode
 - Converter hexadecimal para binária string [Sintaxe: hex_decode string].
 base64_encode
 - Converter binária string para base64 string [Sintaxe: base64_encode string].
 - Alias: b.
 base64_decode
 - Converter base64 string para binária string [Sintaxe: base64_decode string].
 pe_meta
 - Extrair metadados de um arquivo PE [Sintaxe: pe_meta arquivo].
 url_sig
 - Gerar assinaturas do scanner de URL [Sintaxe: url_sig string].
 scan
 - Verificar arquivo ou diretório [Sintaxe: scan nome_do_arquivo].
 - Alias: s.
 c
 - Imprimir esta lista de comandos.
";
