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
 * This file: phpMussel configuration handler (last modified: 2016.02.10).
 *
 * @package Maikuolan/phpMussel
 */

/** phpMussel version number (SemVer). */
$phpMussel['ScriptVersion'] = '0.10.0';

/** phpMussel version identifier (complete notation). */
$phpMussel['ScriptIdent'] = 'phpMussel v' . $phpMussel['ScriptVersion'];

/** phpMussel User Agent (for external requests). */
$phpMussel['ScriptUA'] = $phpMussel['ScriptIdent'] . ' (http://maikuolan.github.io/phpMussel/)';

/** Determine PHP path. */
$phpMussel['Mussel_PHP'] = defined('PHP_BINARY') ? PHP_BINARY : '';

/** Determine the operating system in use. */
$phpMussel['Mussel_OS'] = strtoupper(substr(PHP_OS, 0, 3));

/** Determine if operating in CLI. */
$phpMussel['Mussel_sapi'] = php_sapi_name();

/** Current time at script execution; Used for various purposes. */
$phpMussel['time']=time();

/** Parses the phpMussel configuration file. */
$phpMussel['Config'] =
    @(!file_exists($phpMussel['vault'] . 'phpmussel.ini')) ?
    false :
    parse_ini_file($phpMussel['vault'] . 'phpmussel.ini', true);

/** Kill the script if we fail to parse the configuration file. */
if (!is_array($phpMussel['Config'])) {
    header('Content-Type: text/plain');
    die(
        '[phpMussel] Could not read phpmussel.ini: Can\'t continue. Refer to '.
        'the documentation if this is a first-time run, and if problems '.
        'persist, seek assistance.'
    );
}

/** Fallback for missing "general" configuration category. */
if (!isset($phpMussel['Config']['general']) || !is_array($phpMussel['Config']['general'])) {
    $phpMussel['Config']['general'] = array();
}

/** Fallback for missing "script_password" configuration directive. */
if (!isset($phpMussel['Config']['general']['script_password'])) {
    $phpMussel['Config']['general']['script_password'] = '';
}

/** Fallback for missing "logs_password" configuration directive. */
if (!isset($phpMussel['Config']['general']['logs_password'])) {
    $phpMussel['Config']['general']['logs_password'] = '';
}

/** Fallback for missing "cleanup" configuration directive. */
if (!isset($phpMussel['Config']['general']['cleanup'])) {
    $phpMussel['Config']['general']['cleanup'] = true;
}

/** Fallback for missing "scan_log" configuration directive. */
if (!isset($phpMussel['Config']['general']['scan_log'])) {
    $phpMussel['Config']['general']['scan_log'] = 'scan_log.txt';
}

/** Fallback for missing "scan_log_serialized" configuration directive. */
if (!isset($phpMussel['Config']['general']['scan_log_serialized'])) {
    $phpMussel['Config']['general']['scan_log_serialized'] = 'scan_log_serialized.txt';
}

/** Fallback for missing "scan_kills" configuration directive. */
if (!isset($phpMussel['Config']['general']['scan_kills'])) {
    $phpMussel['Config']['general']['scan_log'] = 'scan_kills.txt';
}

/** Fallback for missing "ipaddr" configuration directive. */
if (!isset($phpMussel['Config']['general']['ipaddr'])) {
    $phpMussel['Config']['general']['ipaddr'] = 'REMOTE_ADDR';
}

/** Ensure we have an IP address variable to work with. */
if (!isset($_SERVER[$phpMussel['Config']['general']['ipaddr']])) {
    $_SERVER[$phpMussel['Config']['general']['ipaddr']] = '';
}

/** Fallback for missing "enable_plugins" configuration directive. */
if (!isset($phpMussel['Config']['general']['enable_plugins'])) {
    $phpMussel['Config']['general']['enable_plugins'] = true;
}

/** Fallback for missing "forbid_on_block" configuration directive. */
if (!isset($phpMussel['Config']['general']['forbid_on_block'])) {
    $phpMussel['Config']['general']['forbid_on_block'] = false;
}

/** Fallback for missing "delete_on_sight" configuration directive. */
if (!isset($phpMussel['Config']['general']['delete_on_sight'])) {
    $phpMussel['Config']['general']['delete_on_sight'] = false;
}

/** Fallback for missing "lang" configuration directive. */
if (empty($phpMussel['Config']['general']['lang'])) {
    $phpMussel['Config']['general']['lang'] = 'en';
}

/** Fallback for missing "lang_override" configuration directive. */
if (!isset($phpMussel['Config']['general']['lang_override'])) {
    $phpMussel['Config']['general']['lang_override'] = false;
}

/** Fallback for missing "lang_acceptable" configuration directive. */
if (!isset($phpMussel['Config']['general']['lang_acceptable'])) {
    $phpMussel['Config']['general']['lang_acceptable'] = ',en,ar,de,es,fr,id,it,ja,nl,pt,ru,vi,zh,zh-TW,';
}

/** Fallback for missing "quarantine_key" configuration directive. */
if (!isset($phpMussel['Config']['general']['quarantine_key'])) {
    $phpMussel['Config']['general']['quarantine_key'] = '';
}

/** Fallback for missing "quarantine_max_filesize" configuration directive. */
if (!isset($phpMussel['Config']['general']['quarantine_max_filesize'])) {
    $phpMussel['Config']['general']['quarantine_max_filesize'] = 2048;
}

/** Fallback for missing "quarantine_max_usage" configuration directive. */
if (!isset($phpMussel['Config']['general']['quarantine_max_usage'])) {
    $phpMussel['Config']['general']['quarantine_max_usage'] = 65536;
}

/** Fallback for missing "honeypot_mode" configuration directive. */
if (!isset($phpMussel['Config']['general']['honeypot_mode'])) {
    $phpMussel['Config']['general']['honeypot_mode'] = false;
}

/** Fallback for missing "scan_cache_expiry" configuration directive. */
if (!isset($phpMussel['Config']['general']['scan_cache_expiry'])) {
    $phpMussel['Config']['general']['scan_cache_expiry'] = 21600;
}

/** Fallback for missing "disable_cli" configuration directive. */
if (!isset($phpMussel['Config']['general']['disable_cli'])) {
    $phpMussel['Config']['general']['disable_cli'] = false;
}

/** Fallback for missing "signatures" configuration category. */
if (!isset($phpMussel['Config']['signatures']) || !is_array($phpMussel['Config']['signatures'])) {
    $phpMussel['Config']['signatures'] = array();
}

/** Fallbacks for missing signatures directives (1/2). */
foreach (array(
    'md5_clamav',
    'md5_custom',
    'md5_mussel',
    'general_clamav',
    'general_custom',
    'general_mussel',
    'ascii_clamav',
    'ascii_custom',
    'ascii_mussel',
    'html_clamav',
    'html_custom',
    'html_mussel',
    'pe_clamav',
    'pe_custom',
    'pe_mussel',
    'pex_custom',
    'pex_mussel',
    'exe_clamav',
    'exe_custom',
    'exe_mussel',
    'elf_clamav',
    'elf_custom',
    'elf_mussel',
    'macho_clamav',
    'macho_custom',
    'macho_mussel',
    'graphics_clamav',
    'graphics_custom',
    'graphics_mussel',
    'metadata_clamav',
    'metadata_custom',
    'metadata_mussel',
    'ole_clamav',
    'ole_custom',
    'ole_mussel',
    'filenames_clamav',
    'filenames_custom',
    'filenames_mussel',
    'mail_clamav',
    'mail_custom',
    'mail_mussel',
    'whitelist_clamav',
    'whitelist_custom',
    'whitelist_mussel',
    'xmlxdp_clamav',
    'xmlxdp_custom',
    'xmlxdp_mussel',
    'coex_clamav',
    'coex_custom',
    'coex_mussel',
    'pdf_clamav',
    'pdf_custom',
    'pdf_mussel',
    'swf_clamav',
    'swf_custom',
    'swf_mussel'
) as $phpMussel['SigDir']) {
    if (!isset($phpMussel['Config']['signatures'][$phpMussel['SigDir']])) {
        $phpMussel['Config']['signatures'][$phpMussel['SigDir']] = true;
    }
}

/** Fallback for missing "fn_siglen_min" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['fn_siglen_min'])) {
    $phpMussel['Config']['signatures']['fn_siglen_min'] = 2;
}

/** Fallback for missing "fn_siglen_max" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['fn_siglen_max'])) {
    $phpMussel['Config']['signatures']['fn_siglen_max'] = 512;
}

/** Fallback for missing "rx_siglen_min" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['rx_siglen_min'])) {
    $phpMussel['Config']['signatures']['rx_siglen_min'] = 4;
}

/** Fallback for missing "rx_siglen_max" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['rx_siglen_max'])) {
    $phpMussel['Config']['signatures']['rx_siglen_max'] = 1024;
}

/** Fallback for missing "sd_siglen_min" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['sd_siglen_min'])) {
    $phpMussel['Config']['signatures']['sd_siglen_min'] = 4;
}

/** Fallback for missing "sd_siglen_max" configuration directive. */
if (!isset($phpMussel['Config']['signatures']['sd_siglen_max'])) {
    $phpMussel['Config']['signatures']['sd_siglen_max'] = 1024;
}

/** Fallbacks for missing signatures directives (2/2). */
foreach (array(
    'fail_silently',
    'fail_extensions_silently',
    'detect_adware',
    'detect_joke_hoax',
    'detect_pua_pup',
    'detect_packer_packed',
    'detect_shell',
    'detect_deface'
) as $phpMussel['SigDir']) {
    if (!isset($phpMussel['Config']['signatures'][$phpMussel['SigDir']])) {
        $phpMussel['Config']['signatures'][$phpMussel['SigDir']] = true;
    }
}

/** Fallback for missing "files" configuration category. */
if (!isset($phpMussel['Config']['files']) || !is_array($phpMussel['Config']['files'])) {
    $phpMussel['Config']['files'] = array();
}

/** Fallback for missing "max_uploads" configuration directive. */
if (!isset($phpMussel['Config']['files']['max_uploads'])) {
    $phpMussel['Config']['files']['max_uploads'] = 10;
}

/** Fallback for missing "filesize_limit" configuration directive. */
if (!isset($phpMussel['Config']['files']['filesize_limit'])) {
    $phpMussel['Config']['files']['filesize_limit'] = 65536;
}

/** Fallback for missing "filesize_response" configuration directive. */
if (!isset($phpMussel['Config']['files']['filesize_response'])) {
    $phpMussel['Config']['files']['filesize_response'] = true;
}

/** Fallback for missing "filetype_whitelist" configuration directive. */
if (!isset($phpMussel['Config']['files']['filetype_whitelist'])) {
    $phpMussel['Config']['files']['filetype_whitelist'] = '';
}

/** Fallback for missing "filetype_blacklist" configuration directive. */
if (!isset($phpMussel['Config']['files']['filetype_blacklist'])) {
    $phpMussel['Config']['files']['filetype_blacklist'] =
        '386,acc*,acm,act*,apk,app,ash*,asm*,asx*,ax,bat,bin,ccc,cgi,cmd,' .
        'com*,cpl,cpp,csh,dll,drv,elf,exe,fxp,gad*,hta*,htp*,ico,inf,ins,' .
        'inx,ipa,isu,job,js,jse,ksh,lnk,msc,msi,msp,mst,net,ocx,ops,org,osx,' .
        'out,paf,php*,pif,pl,prg,ps1,reg,rgs,rs,run,scr*,sct,shb,shs,sql*,' .
        'sys,u3p,url,vb,vbe,vbs*,wor*,ws,wsf,xsl';
}

/** Fallback for missing "filetype_greylist" configuration directive. */
if (!isset($phpMussel['Config']['files']['filetype_greylist'])) {
    $phpMussel['Config']['files']['filetype_greylist'] = '';
}

/** Fallback for missing "check_archives" configuration directive. */
if (!isset($phpMussel['Config']['files']['check_archives'])) {
    $phpMussel['Config']['files']['check_archives'] = true;
}

/** Fallback for missing "filesize_archives" configuration directive. */
if (!isset($phpMussel['Config']['files']['filesize_archives'])) {
    $phpMussel['Config']['files']['filesize_archives'] = true;
}

/** Fallback for missing "filetype_archives" configuration directive. */
if (!isset($phpMussel['Config']['files']['filetype_archives'])) {
    $phpMussel['Config']['files']['filetype_archives'] = false;
}

/** Fallback for missing "max_recursion" configuration directive. */
if (!isset($phpMussel['Config']['files']['max_recursion'])) {
    $phpMussel['Config']['files']['max_recursion'] = 10;
}

/** Fallback for missing "block_encrypted_archives" configuration directive. */
if (!isset($phpMussel['Config']['files']['block_encrypted_archives'])) {
    $phpMussel['Config']['files']['block_encrypted_archives'] = true;
}

/** Fallback for missing "attack_specific" configuration category. */
if (!isset($phpMussel['Config']['attack_specific']) || !is_array($phpMussel['Config']['attack_specific'])) {
    $phpMussel['Config']['attack_specific'] = array();
}

/** Fallbacks for missing chameleon attack directives. */
foreach (array(
    'chameleon_from_php',
    'chameleon_from_exe',
    'chameleon_to_archive',
    'chameleon_to_doc',
    'chameleon_to_img',
    'chameleon_to_pdf'
) as $phpMussel['SigDir']) {
    if (!isset($phpMussel['Config']['attack_specific'][$phpMussel['SigDir']])) {
        $phpMussel['Config']['attack_specific'][$phpMussel['SigDir']] = true;
    }
}

/** Fallback for missing "archive_file_extensions" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['archive_file_extensions'])) {
    $phpMussel['Config']['attack_specific']['archive_file_extensions'] =
        '7z,a,ace,alz,apk,app,ar,arc,arj,ba,bh,bz,bz2,dmg,gz,ice,iso,lha,lz,' .
        'lzh,lzo,lzw,lzx,mar,pak,pck,pea,phar,rar,rz,s7z,sea,sen,sfx,shar,' .
        'sqx,tar,tgz,tlz,xar,xp3,xz,yz1,z,zz';
}

/** Fallback for missing "archive_file_extensions_wc" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['archive_file_extensions_wc'])) {
    $phpMussel['Config']['attack_specific']['archive_file_extensions_wc'] =
        'paq*,sit*,tbz*,zip*';
}

/** Fallback for missing "general_commands" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['general_commands'])) {
    $phpMussel['Config']['attack_specific']['general_commands'] = false;
}

/** Fallback for missing "block_control_characters" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['block_control_characters'])) {
    $phpMussel['Config']['attack_specific']['block_control_characters'] = false;
}

/** Fallback for missing "corrupted_exe" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['corrupted_exe'])) {
    $phpMussel['Config']['attack_specific']['corrupted_exe'] = true;
}

/** Fallback for missing "decode_threshold" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['decode_threshold'])) {
    $phpMussel['Config']['attack_specific']['decode_threshold'] = 512;
}

/** Fallback for missing "scannable_threshold" configuration directive. */
if (!isset($phpMussel['Config']['attack_specific']['scannable_threshold'])) {
    $phpMussel['Config']['attack_specific']['scannable_threshold'] = 32768;
}

/** Fallback for missing "compatibility" configuration category. */
if (!isset($phpMussel['Config']['compatibility']) || !is_array($phpMussel['Config']['compatibility'])) {
    $phpMussel['Config']['compatibility'] = array();
}

/** Fallback for missing "ignore_upload_errors" configuration directive. */
if (!isset($phpMussel['Config']['compatibility']['ignore_upload_errors'])) {
    $phpMussel['Config']['compatibility']['ignore_upload_errors'] = false;
}

/** Fallback for missing "only_allow_images" configuration directive. */
if (!isset($phpMussel['Config']['compatibility']['only_allow_images'])) {
    $phpMussel['Config']['compatibility']['only_allow_images'] = false;
}

/** Fallback for missing "heuristic" configuration category. */
if (!isset($phpMussel['Config']['heuristic']) || !is_array($phpMussel['Config']['heuristic'])) {
    $phpMussel['Config']['heuristic'] = array();
}

/** Fallback for missing "threshold" configuration directive. */
if (!isset($phpMussel['Config']['heuristic']['threshold'])) {
    $phpMussel['Config']['heuristic']['threshold'] = 3;
}

/** Fallback for missing "virustotal" configuration category. */
if (!isset($phpMussel['Config']['virustotal']) || !is_array($phpMussel['Config']['virustotal'])) {
    $phpMussel['Config']['virustotal'] = array();
}

/** Fallback for missing "vt_public_api_key" configuration directive. */
if (!isset($phpMussel['Config']['virustotal']['vt_public_api_key'])) {
    $phpMussel['Config']['virustotal']['vt_public_api_key'] = '';
}

/** Fallback for missing "vt_suspicion_level" configuration directive. */
if (!isset($phpMussel['Config']['virustotal']['vt_suspicion_level'])) {
    $phpMussel['Config']['virustotal']['vt_suspicion_level'] = 1;
}

/** Fallback for missing "vt_weighting" configuration directive. */
if (!isset($phpMussel['Config']['virustotal']['vt_weighting'])) {
    $phpMussel['Config']['virustotal']['vt_weighting'] = 0;
}

/** Fallback for missing "vt_quota_rate" configuration directive. */
if (!isset($phpMussel['Config']['virustotal']['vt_quota_rate'])) {
    $phpMussel['Config']['virustotal']['vt_quota_rate'] = 4;
}

/** Fallback for missing "vt_quota_time" configuration directive. */
if (!isset($phpMussel['Config']['virustotal']['vt_quota_time'])) {
    $phpMussel['Config']['virustotal']['vt_quota_time'] = 1;
}

/** Fallback for missing "urlscanner" configuration category. */
if (!isset($phpMussel['Config']['urlscanner']) || !is_array($phpMussel['Config']['urlscanner'])) {
    $phpMussel['Config']['urlscanner'] = array();
}

/** Fallback for missing "urlscanner" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['urlscanner'])) {
    $phpMussel['Config']['urlscanner']['urlscanner'] = true;
}

/** Fallback for missing "lookup_hphosts" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['lookup_hphosts'])) {
    $phpMussel['Config']['urlscanner']['lookup_hphosts'] = true;
}

/** Fallback for missing "google_api_key" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['google_api_key'])) {
    $phpMussel['Config']['urlscanner']['google_api_key'] = '';
}

/** Fallback for missing "maximum_api_lookups" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['maximum_api_lookups'])) {
    $phpMussel['Config']['urlscanner']['maximum_api_lookups'] = 10;
}

/** Fallback for missing "maximum_api_lookups_response" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['maximum_api_lookups_response'])) {
    $phpMussel['Config']['urlscanner']['maximum_api_lookups_response'] = false;
}

/** Fallback for missing "cache_time" configuration directive. */
if (!isset($phpMussel['Config']['urlscanner']['cache_time'])) {
    $phpMussel['Config']['urlscanner']['cache_time'] = 3600;
}

/** Fallback for missing "template_data" configuration category. */
if (!isset($phpMussel['Config']['template_data']) || !is_array($phpMussel['Config']['template_data'])) {
    $phpMussel['Config']['template_data'] = array();
}

/** Fallback for missing "css_url" configuration directive. */
if (!isset($phpMussel['Config']['template_data']['css_url'])) {
    $phpMussel['Config']['template_data']['css_url'] = '';
}
