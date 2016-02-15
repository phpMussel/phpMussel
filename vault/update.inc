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
 * This file: phpMussel update handler (last modified: 2016.02.16).
 *
 * @package Maikuolan/phpMussel
 *
 * @todo Currently, no update server is defined by `update.dat` (because
 *      currently, none exist). This means that this entire update script, at
 *      this time, won't work. There aren't any coding problems or errors in
 *      the script (as far as I'm aware), but rather, I just don't currently
 *      have somewhere appropriate to host the update server. We'll probably
 *      rewrite this entire script in the near future anyhow, so, for now, it's
 *      best to just ignore this and not use it.
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$is_cli=@(isset($is_cli))?$is_cli:false;
while (true)
    {
    $phpMussel['ScriptIdent'] = array();
    if (!file_exists($phpMussel['vault'] . 'update.dat')) {
        if (!$is_cli) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['Config']['lang']['update_err1']);
        }
        echo wordwrap(' '.$phpMussel['Config']['lang']['update_err1'],79,"\n ",true);
        break;
        }
    $phpMussel['ScriptIdent']['raw']=implode(file($phpMussel['vault'] . 'update.dat'));
    $phpMussel['ScriptIdent']['current_time']=time();
    $phpMussel['ScriptIdent']['crc'] = array();
    $phpMussel['ScriptIdent']['fdata'] = array();
    $phpMussel['ScriptIdent']['update_addresses'] = array();
    $phpMussel['ScriptIdent']['update_addresses_count'] = 0;
    $phpMussel['ScriptIdent']['preupdate_instructions'] = substr($phpMussel['ScriptIdent']['raw'],64);
    $phpMussel['ScriptIdent']['preupdate_instructions']=@(substr_count($phpMussel['ScriptIdent']['preupdate_instructions'],';')>0)?explode(';', $phpMussel['ScriptIdent']['preupdate_instructions']):array(0=>$phpMussel['ScriptIdent']['preupdate_instructions']);
    $phpMussel['ScriptIdent']['preupdate_instructions_count'] = count($phpMussel['ScriptIdent']['preupdate_instructions']);
    for ($i = 0; $i < $phpMussel['ScriptIdent']['preupdate_instructions_count'];$i++)
        {
        $phpMussel['ScriptIdent']['preupdate_instructions'][$i]=@(substr_count($phpMussel['ScriptIdent']['preupdate_instructions'][$i],':')>0)?explode(':', $phpMussel['ScriptIdent']['preupdate_instructions'][$i]):array(0=>$phpMussel['ScriptIdent']['preupdate_instructions'][$i]);
        if ($phpMussel['ScriptIdent']['preupdate_instructions'][$i][0] == 'updates') {
            if ($phpMussel['ScriptIdent']['preupdate_instructions'][$i][2] > $phpMussel['ScriptIdent']['current_time']) {
                $phpMussel['ScriptIdent']['update_addresses'][$phpMussel['ScriptIdent']['update_addresses_count']] = $phpMussel['ScriptIdent']['preupdate_instructions'][$i][1];
                $phpMussel['ScriptIdent']['update_addresses_count']++;
                }
            }
        }
    if ($phpMussel['ScriptIdent']['update_addresses_count']<1) {
        if (!$is_cli) {
            header('Content-Type: text/plain');
            die('[phpMussel] ' . $phpMussel['Config']['lang']['update_err2']);
        }
        echo wordwrap(' '.$phpMussel['Config']['lang']['update_err2'],79,"\n ",true);
        break;
        }
    $phpMussel['ScriptIdent']['script_version']=trim(substr($phpMussel['ScriptIdent']['raw'],16,16));
    $phpMussel['ScriptIdent']['first_compatible']=trim(substr($phpMussel['ScriptIdent']['script_version'],strpos($phpMussel['ScriptIdent']['script_version'],' ')));
    $phpMussel['ScriptIdent']['script_version']=trim(substr($phpMussel['ScriptIdent']['script_version'],0,strpos($phpMussel['ScriptIdent']['script_version'],' ')));
    if (!$phpMussel['ScriptIdent']['server_addr'] = (isset($_SERVER['SERVER_ADDR']))?$_SERVER['SERVER_ADDR']:'::1')$phpMussel['ScriptIdent']['server_addr'] = '::1';
    if (!$phpMussel['ScriptIdent']['http_host'] = (isset($_SERVER['HTTP_HOST']))?$_SERVER['HTTP_HOST']:'localhost')$phpMussel['ScriptIdent']['http_host'] = 'localhost';
    $phpMussel['ScriptIdent']['phpmussel_ua']=@'phpMussel v'.$phpMussel['ScriptIdent']['script_version'].' ('.hash('crc32b',$phpMussel['ScriptIdent']['server_addr']).'-'.hash('crc32b',$phpMussel['ScriptIdent']['http_host']).')';
    if (!$is_cli) {
        header('Content-Type: text/plain');
        echo $phpMussel['Config']['lang']['cli_ln1'] . $phpMussel['Config']['lang']['cli_ln2'];
        }
    echo $phpMussel['Config']['lang']['update_'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n\n";
    $phpMussel['ScriptIdent']['request_status'] = false;
    $phpMussel['ScriptIdent']['gz'] = (!function_exists('gzinflate'))?'n':'y';
    $phpMussel['ScriptIdent']['request_content'] = 'gz='.$phpMussel['ScriptIdent']['gz'].'&files=';
    $phpMussel['ScriptIdent']['request_content'] .= 'phpmussel.inc%3A'.md5(phpMusselFile($phpMussel['vault'] . 'phpmussel.inc')).'%3B';
    $phpMussel['ScriptIdent']['request_content'] .= 'lang.inc%3A'.md5(phpMusselFile($phpMussel['vault'] . 'lang.inc')).'%3B';
    $phpMussel['ScriptIdent']['request_content'] .= 'update.inc%3A'.md5(phpMusselFile($phpMussel['vault'] . 'update.inc')).'%3B';
    $phpMussel['ScriptIdent']['request_content'] .= 'switch.dat%3A'.md5(phpMusselFile($phpMussel['vault'] . 'switch.dat')).'%3B';
    $phpMussel['ScriptIdent']['langCodes']=array('de','ar','en','es','fr','id','it','ja','nl','pt','ru','vi','zh-tw','zh');
    $c = count($phpMussel['ScriptIdent']['langCodes']);
    for ($i = 0; $i < $c; $i++)
        {
        $phpMussel['ScriptIdent']['request_content'] .= 'lang/lang.'.$phpMussel['ScriptIdent']['langCodes'][$i].'.inc%3A'.md5(phpMusselFile($phpMussel['vault'] . 'lang/lang.'.$phpMussel['ScriptIdent']['langCodes'][$i].'.inc')).'%3B';
        }
    $SigFileSet=array('ascii_clamav'=>array('ascii_clamav_regex.cvd','ascii_clamav_regex.map','ascii_clamav_standard.cvd','ascii_clamav_standard.map'),'ascii_mussel'=>array('ascii_mussel_regex.cvd','ascii_mussel_standard.cvd'),'coex_clamav'=>array('coex_clamav.cvd'),'coex_mussel'=>array('coex_mussel.cvd'),'elf_clamav'=>array('elf_clamav_regex.cvd','elf_clamav_regex.map','elf_clamav_standard.cvd','elf_clamav_standard.map'),'elf_mussel'=>array('elf_mussel_regex.cvd','elf_mussel_standard.cvd'),'exe_clamav'=>array('exe_clamav_regex.cvd','exe_clamav_regex.map','exe_clamav_standard.cvd','exe_clamav_standard.map'),'exe_mussel'=>array('exe_mussel_regex.cvd','exe_mussel_standard.cvd'),'filenames_clamav'=>array('filenames_clamav.cvd'),'filenames_mussel'=>array('filenames_mussel.cvd'),'general_clamav'=>array('general_clamav_regex.cvd','general_clamav_regex.map','general_clamav_standard.cvd','general_clamav_standard.map'),'general_mussel'=>array('general_mussel_regex.cvd','general_mussel_standard.cvd'),'graphics_clamav'=>array('graphics_clamav_regex.cvd','graphics_clamav_regex.map','graphics_clamav_standard.cvd','graphics_clamav_standard.map'),'graphics_mussel'=>array('graphics_mussel_regex.cvd','graphics_mussel_standard.cvd'),'html_clamav'=>array('html_clamav_regex.cvd','html_clamav_regex.map','html_clamav_standard.cvd','html_clamav_standard.map'),'html_mussel'=>array('html_mussel_regex.cvd','html_mussel_standard.cvd'),'macho_clamav'=>array('macho_clamav_regex.cvd','macho_clamav_regex.map','macho_clamav_standard.cvd','macho_clamav_standard.map'),'macho_mussel'=>array('macho_mussel_regex.cvd','macho_mussel_standard.cvd'),'mail_clamav'=>array('mail_clamav_regex.cvd','mail_clamav_regex.map','mail_clamav_standard.cvd','mail_clamav_standard.map'),'mail_mussel'=>array('mail_mussel_regex.cvd','mail_mussel_standard.cvd'),'md5_clamav'=>array('md5_clamav.cvd'),'md5_mussel'=>array('md5_mussel.cvd'),'metadata_clamav'=>array('metadata_clamav.cvd'),'metadata_mussel'=>array('metadata_mussel.cvd'),'ole_clamav'=>array('ole_clamav_regex.cvd','ole_clamav_regex.map','ole_clamav_standard.cvd','ole_clamav_standard.map'),'ole_mussel'=>array('ole_mussel_regex.cvd','ole_mussel_standard.cvd'),'pdf_clamav'=>array('pdf_clamav_regex.cvd','pdf_clamav_regex.map','pdf_clamav_standard.cvd','pdf_clamav_standard.map'),'pdf_mussel'=>array('pdf_mussel_regex.cvd','pdf_mussel_standard.cvd'),'pe_clamav'=>array('pe_clamav.cvd'),'pe_mussel'=>array('pe_mussel.cvd'),'urlscanner'=>array('urlscanner.cvd'),'swf_clamav'=>array('swf_clamav_regex.cvd','swf_clamav_regex.map','swf_clamav_standard.cvd','swf_clamav_standard.map'),'swf_mussel'=>array('swf_mussel_regex.cvd','swf_mussel_standard.cvd'),'whitelist_clamav'=>array('whitelist_clamav.cvd'),'whitelist_mussel'=>array('whitelist_mussel.cvd'),'xmlxdp_clamav'=>array('xmpxdp_clamav_regex.cvd','xmpxdp_clamav_regex.map','xmpxdp_clamav_standard.cvd','xmpxdp_clamav_standard.map'),'xmlxdp_mussel'=>array('xmpxdp_mussel_regex.cvd','xmpxdp_mussel_standard.cvd'));
    $c = count($SigFileSet);
    while ($c > 0) {
        if ($k=@key($SigFileSet))if (isset($phpMussel['Config']['signatures'][$k])) {
            if (!$phpMussel['Config']['signatures'][$k]) {
                foreach ($SigFileSet[$k] as $SigFile)$phpMussel['ScriptIdent']['request_content'] .= $SigFile.'%3AIGNORE%3B';
                }
            else foreach ($SigFileSet[$k] as $SigFile)$phpMussel['ScriptIdent']['request_content'] .= $SigFile.'%3A'.md5(phpMusselFile($phpMussel['sigPath'] . $SigFile)).'%3B';
            }
        next($SigFileSet);
        $c--;
        }
    $c = $k = $SigFile = $SigFileSet = false;
    if (isset($phpMussel['Config']['attack_specific']['general_commands'])) {
        if (!$phpMussel['Config']['attack_specific']['general_commands'])$phpMussel['ScriptIdent']['request_content'] .= 'hex_general_commands.csv%3AIGNORE%3B';
        else $phpMussel['ScriptIdent']['request_content'] .= 'hex_general_commands.csv%3A'.md5(phpMusselFile($phpMussel['vault'] . 'hex_general_commands.csv')).'%3B';
        }
    $phpMussel['ScriptIdent']['request_content'] .= 'update.dat%3A'.md5(phpMusselFile($phpMussel['vault'] . 'update.dat')).'%3B';
    for ($i = 0; $i < $phpMussel['ScriptIdent']['update_addresses_count'];$i++)
        {
        echo phpMusselV(array('Location'=>'http://'.substr($phpMussel['ScriptIdent']['update_addresses'][$i],0,(strlen($phpMussel['ScriptIdent']['update_addresses'][$i])-strpos($phpMussel['ScriptIdent']['update_addresses'][$i],'/'))*-1).'/'),$phpMussel['Config']['lang']['update_fetch']);
        $phpMussel['ScriptIdent']['stream']=stream_context_create(array('http'=>array('method'=>'POST','header'=>'Content-type: application/x-www-form-urlencoded; charset=iso-8859-1','user_agent'=>$phpMussel['ScriptIdent']['phpmussel_ua'],'content'=>$phpMussel['ScriptIdent']['request_content'],'timeout'=>8)));
        $phpMussel['ScriptIdent']['request']=file_get_contents('http://'.$phpMussel['ScriptIdent']['update_addresses'][$i],false, $phpMussel['ScriptIdent']['stream']);
        if (trim(substr($phpMussel['ScriptIdent']['request'],0,16))!=="\xA1phpMussel!") {
            echo $phpMussel['Config']['lang']['update_failed'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
            $phpMussel['ScriptIdent']['update_addresses'][$i] = '';
            continue;
            }
        $phpMussel['ScriptIdent']['request_status'] = true;
        echo $phpMussel['Config']['lang']['update_success'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
        break;
        }
    if (!$phpMussel['ScriptIdent']['request_status']) {
        echo $phpMussel['Config']['lang']['update_no_source'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
        break;
        }
    $phpMussel['ScriptIdent']['remote_script_version']=trim(substr($phpMussel['ScriptIdent']['request'],16,16));
    $phpMussel['ScriptIdent']['remote_first_compatible']=trim(substr($phpMussel['ScriptIdent']['remote_script_version'],strpos($phpMussel['ScriptIdent']['remote_script_version'],' ')));
    $phpMussel['ScriptIdent']['remote_script_version']=trim(substr($phpMussel['ScriptIdent']['remote_script_version'],0,strpos($phpMussel['ScriptIdent']['remote_script_version'],' ')));
    echo "\n\n===\n".$phpMussel['Config']['lang']['update_version_yours'].":\n   phpMussel v".$phpMussel['ScriptIdent']['script_version'].";\n".$phpMussel['Config']['lang']['update_version_latest'].":\n   phpMussel v".$phpMussel['ScriptIdent']['remote_script_version'].";\n";
    if ($phpMussel['ScriptIdent']['first_compatible'] === $phpMussel['ScriptIdent']['remote_first_compatible']) {
        echo ($phpMussel['ScriptIdent']['script_version'] === $phpMussel['ScriptIdent']['remote_script_version']) ? $phpMussel['Config']['lang']['update_not_available']."\n\n":$phpMussel['Config']['lang']['update_available']."\n\n";
        $phpMussel['ScriptIdent']['signatures_version']=trim(substr($phpMussel['ScriptIdent']['raw'],32,16));
        $phpMussel['ScriptIdent']['signatures_version_human'] = explode(' ',$phpMussel['ScriptIdent']['signatures_version']);
        $phpMussel['ScriptIdent']['signatures_version_human'] = '   ClamAV main '.$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['signatures_version_human'][0].",\n   ClamAV daily ".$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['signatures_version_human'][1].",\n   Non-ClamAV/phpMussel ".$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['signatures_version_human'][2] . $phpMussel['Config']['lang']['_fullstop_final'];
        $phpMussel['ScriptIdent']['remote_signatures_version']=trim(substr($phpMussel['ScriptIdent']['request'],32,16));
        $phpMussel['ScriptIdent']['remote_signatures_version_human'] = explode(' ',$phpMussel['ScriptIdent']['remote_signatures_version']);
        $phpMussel['ScriptIdent']['remote_signatures_version_human'] = '   ClamAV main '.$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['remote_signatures_version_human'][0].",\n   ClamAV daily ".$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['remote_signatures_version_human'][1].",\n   Non-ClamAV/phpMussel ".$phpMussel['Config']['lang']['update_wrd1'].' #'.$phpMussel['ScriptIdent']['remote_signatures_version_human'][2] . $phpMussel['Config']['lang']['_fullstop_final'];
        echo $phpMussel['Config']['lang']['update_signatures_yours'].":\n".$phpMussel['ScriptIdent']['signatures_version_human'] . "\n".$phpMussel['Config']['lang']['update_signatures_latest'].":\n".$phpMussel['ScriptIdent']['remote_signatures_version_human'] . "\n";
        echo ($phpMussel['ScriptIdent']['signatures_version'] === $phpMussel['ScriptIdent']['remote_signatures_version']) ? $phpMussel['Config']['lang']['update_signatures_not_available'] . "\n":$phpMussel['Config']['lang']['update_signatures_available'] . "\n";
        }
    else echo $phpMussel['Config']['lang']['update_not_possible'] . "\n";
    echo "===\n\n";
    if ($phpMussel['ScriptIdent']['remote_update_instructions']=@substr($phpMussel['ScriptIdent']['request'],64)) {
        $phpMussel['ScriptIdent']['remote_update_instructions']=@(substr_count($phpMussel['ScriptIdent']['remote_update_instructions'],';')>0)?explode(';', $phpMussel['ScriptIdent']['remote_update_instructions']):array(0=>$phpMussel['ScriptIdent']['remote_update_instructions']);
        $phpMussel['ScriptIdent']['remote_update_instructions_count'] = count($phpMussel['ScriptIdent']['remote_update_instructions']);
        $phpMussel['ScriptIdent']['remote_hack_detected'] = false;
        for ($i = 0; $i < $phpMussel['ScriptIdent']['remote_update_instructions_count'];$i++)
            {
            $phpMussel['ScriptIdent']['itype'] = substr($phpMussel['ScriptIdent']['remote_update_instructions'][$i],0,5);
            if ($phpMussel['ScriptIdent']['itype'] == 'delet'||$phpMussel['ScriptIdent']['itype'] == 'patch') {
                if (preg_match("/2e2e|2f2e|5c2e|2f2f|5c5c|2e(2e|2f|5c|62|646c|65|67|68|6a|70|73)/i",bin2hex(strtolower($phpMussel['ScriptIdent']['remote_update_instructions'][$i])))) {
                    $phpMussel['ScriptIdent']['remote_hack_detected'] = true;
                    break;
                    }
                }
            $phpMussel['ScriptIdent']['remote_update_instructions'][$i]=@(substr_count($phpMussel['ScriptIdent']['remote_update_instructions'][$i],':')>0)?explode(':', $phpMussel['ScriptIdent']['remote_update_instructions'][$i]):array(0=>$phpMussel['ScriptIdent']['remote_update_instructions'][$i]);
            }
        if ($phpMussel['ScriptIdent']['remote_hack_detected']) {
            echo (!$is_cli)?$phpMussel['Config']['lang']['update_err3'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n":wordwrap($phpMussel['Config']['lang']['update_err3'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n",79,"\n",true);
            break;
            }
        for ($i = 0; $i < $phpMussel['ScriptIdent']['remote_update_instructions_count'];$i++)
            {
            if ($phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'crc')$phpMussel['ScriptIdent']['crc'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]] = $phpMussel['ScriptIdent']['remote_update_instructions'][$i][2];
            elseif ($phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'fdata')$phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]=@base64_decode($phpMussel['ScriptIdent']['remote_update_instructions'][$i][2]);
            elseif ($phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'delete') {
                if (file_exists($phpMussel['vault'] . $phpMussel['ScriptIdent']['remote_update_instructions'][$i][1])) {
                    @unlink($phpMussel['vault'] . $phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]);
                    echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['Config']['lang']['update_deleted'] . $phpMussel['Config']['lang']['update_successfully']),$phpMussel['Config']['lang']['update_was']).'. ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                    }
                } elseif ($phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'patch'||$phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'patchgz') {
                $phpMussel['ScriptIdent']['adj_word'] = (file_exists($phpMussel['vault'] . $phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]))?$phpMussel['Config']['lang']['update_patched']:$phpMussel['Config']['lang']['update_created'];
                if (!isset($phpMussel['ScriptIdent']['crc'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]))echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['ScriptIdent']['adj_word']),$phpMussel['Config']['lang']['update_not']).': '.$phpMussel['Config']['lang']['update_err4'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                elseif (!isset($phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]))echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['ScriptIdent']['adj_word']),$phpMussel['Config']['lang']['update_not']).': '.$phpMussel['Config']['lang']['update_err5'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                elseif (!$phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]])echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['ScriptIdent']['adj_word']),$phpMussel['Config']['lang']['update_not']).': '.$phpMussel['Config']['lang']['update_err6'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                else {
                    if ($phpMussel['ScriptIdent']['remote_update_instructions'][$i][0] == 'patchgz')$phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]=@gzinflate($phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]);
                    if (@hash('crc32b',$phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]) != $phpMussel['ScriptIdent']['crc'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]])echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['ScriptIdent']['adj_word']),$phpMussel['Config']['lang']['update_not']).': '.$phpMussel['Config']['lang']['update_err7'].' ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                    else {
                        $phpMussel['ScriptIdent']['df']=fopen($phpMussel['vault'] . $phpMussel['ScriptIdent']['remote_update_instructions'][$i][1],'w');
                        fwrite($phpMussel['ScriptIdent']['df'],$phpMussel['ScriptIdent']['fdata'][$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1]]);
                        fclose($phpMussel['ScriptIdent']['df']);
                        echo $phpMussel['Config']['lang']['file'].' \''.$phpMussel['ScriptIdent']['remote_update_instructions'][$i][1].'\' '.phpMusselV(array('x'=>$phpMussel['ScriptIdent']['adj_word'] . $phpMussel['Config']['lang']['update_successfully']),$phpMussel['Config']['lang']['update_was']).'. ('.(time()-$phpMussel['ScriptIdent']['current_time']).$phpMussel['Config']['lang']['update_seconds_elapsed'].")\n";
                        }
                    }
                }
            $phpMussel['ScriptIdent']['remote_update_instructions'][$i] = '';
            }
        }
    if (isset($phpMussel['MusselPlugins']['hookcounts']['update']))if ($phpMussel['MusselPlugins']['hookcounts']['update'] > 0) {
        reset($phpMussel['MusselPlugins']['hooks']['update']);
        for ($phpMussel['MusselPlugins']['tempdata']['i'] = 0; $phpMussel['MusselPlugins']['tempdata']['i'] < $phpMussel['MusselPlugins']['hookcounts']['update'];$phpMussel['MusselPlugins']['tempdata']['i']++)
            {
            $phpMussel['MusselPlugins']['tempdata']['k'] = key($phpMussel['MusselPlugins']['hooks']['update']);
            if (!is_array($phpMussel['MusselPlugins']['hooks']['update'][$phpMussel['MusselPlugins']['tempdata']['k']]))$phpMussel['MusselPlugins']['hooks']['update'][$phpMussel['MusselPlugins']['tempdata']['k']]=array(0=>$phpMussel['MusselPlugins']['hooks']['update'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['kc'] = count($phpMussel['MusselPlugins']['hooks']['update'][$phpMussel['MusselPlugins']['tempdata']['k']]);
            $phpMussel['MusselPlugins']['tempdata']['varsfeed'] = array();
            for ($phpMussel['MusselPlugins']['tempdata']['ki'] = 0; $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['kc'];$phpMussel['MusselPlugins']['tempdata']['ki']++)
                {
                $x = $phpMussel['MusselPlugins']['hooks']['update'][$phpMussel['MusselPlugins']['tempdata']['k']][$phpMussel['MusselPlugins']['tempdata']['ki']];
                if ($x)$phpMussel['MusselPlugins']['tempdata']['varsfeed'][$phpMussel['MusselPlugins']['tempdata']['ki']] = (isset($$x))?$$x:$x;
                }
            $phpMussel['MusselPlugins']['tempdata']['out']=call_user_func($phpMussel['MusselPlugins']['tempdata']['k'],$phpMussel['MusselPlugins']['tempdata']['varsfeed']);
            if (is_array($phpMussel['MusselPlugins']['tempdata']['out'])) {
                $phpMussel['MusselPlugins']['tempdata']['outs'] = count($phpMussel['MusselPlugins']['tempdata']['out']);
                for ($phpMussel['MusselPlugins']['tempdata']['ki'] = 0; $phpMussel['MusselPlugins']['tempdata']['ki'] < $phpMussel['MusselPlugins']['tempdata']['outs'];$phpMussel['MusselPlugins']['tempdata']['ki']++)
                    {
                    $x = key($phpMussel['MusselPlugins']['tempdata']['out']);
                    $$x = $phpMussel['MusselPlugins']['tempdata']['out'][$x];
                    next($x);
                    }
                }
            next($phpMussel['MusselPlugins']['hooks']['update']);
            }
        $phpMussel['MusselPlugins']['tempdata'] = array();
        }
    echo $phpMussel['Config']['lang']['update_complete'];
    break;
    }

if (!$is_cli)die;
