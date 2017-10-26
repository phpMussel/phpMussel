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
 * This file: English language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Home</a> | <a href="?phpmussel-page=logout">Log Out</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Log Out</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Recognised archive file extensions (format is CSV; should only add or remove when problems occur; unnecessarily removing may cause false positives to appear for archive files, whereas unnecessarily adding will essentially whitelist what you\'re adding from attack specific detection; modify with caution; also note that this has no effect on what archives can and can\'t be analysed at content-level). The list, as is at default, lists those formats used most commonly across the majority of systems and CMS, but intentionally isn\'t necessarily comprehensive.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Block any files containing any control characters (other than newlines)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) If you\'re <em><strong>ONLY</strong></em> uploading plain-text, then you can turn this option on to provide some additional protection to your system. However, if you upload anything other than plain-text, turning this on may result in false positives. False = Don\'t block [Default]; True = Block.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Search for PHP header in files that are neither PHP files nor recognised archives. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR, ZIP, RAR, GZ). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Search for office documents whose headers are incorrect (Supported: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Search for images whose headers are incorrect (Supported: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Search for PDF files whose headers are incorrect. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Corrupted files and parse errors. False = Ignore; True = Block [Default]. Detect and block potentially corrupted PE (Portable Executable) files? Often (but not always), when certain aspects of a PE file are corrupted or can\'t be parsed correctly, it can be indicative of a viral infection. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Threshold for the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues while scanning). Default = 512KB. Zero or null disables the threshold (removing any such limitation based on filesize).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Threshold to the length of raw data that phpMussel is permitted to read and scan (in case there are any noticeable performance issues while scanning). Default = 32MB. Zero or null value disables the threshold. Generally, this value shouldn\'t be less than the average filesize of file uploads that you want and expect to receive to your server or website, shouldn\'t be more than the filesize_limit directive, and shouldn\'t be more than roughly one fifth of the total allowable memory allocation granted to PHP via the "php.ini" configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that\'d prevent it from being able to successfully scan files above a certain filesize).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'This directive should generally be disabled unless it\'s required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the <code>$_FILES</code> array(), it\'ll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. However, for some CMS, empty elements in <code>$_FILES</code> can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren\'t any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. False = OFF; True = ON.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don\'t require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it\'ll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. False = OFF; True = ON.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Detect and block encrypted archives? Because phpMussel isn\'t able to scan the contents of encrypted archives, it\'s possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. False = No; True = Yes [Default].';
$phpMussel['lang']['config_files_check_archives'] = 'Attempt to check the contents of archives? False = Don\'t check; True = Check [Default]. Currently, the only archive and compression formats supported are BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR and ZIP (archive and compression formats RAR, CAB, 7z and etcetera not currently supported). This is not foolproof! While I highly recommend keeping this turned on, I can\'t guarantee it\'ll always find everything. Also be aware that archive checking currently is not recursive for PHARs or ZIPs.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Carry over filesize blacklisting/whitelisting to the contents of archives? False = No (just greylist everything); True = Yes [Default].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Filesize limit in KB. 65536 = 64MB [Default]; 0 = No limit (always greylisted). Any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.';
$phpMussel['lang']['config_files_filesize_response'] = 'What to do with files that exceed the filesize limit (if one exists). False = Whitelist; True = Blacklist [Default].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Carry over filetype blacklisting/whitelisting to the contents of archives? False = No (just greylist everything) [Default]; True = Yes.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist. Logical order of processing is: If the filetype is whitelisted, don\'t scan and don\'t block the file, and don\'t check the file against the blacklist or the greylist. If the filetype is blacklisted, don\'t scan the file but block it anyway, and don\'t check the file against the greylist. If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the file as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the file as blacklisted, therefore not scanning it but blocking it anyway. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Maximum recursion depth limit for archives. Default = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximum allowable number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn\'t account for or include the contents of archives.';
$phpMussel['lang']['config_general_cleanup'] = 'Unset variables and cache used by the script after the initial upload scanning? False = No; True = Yes [Default]. If you -aren\'t- using the script beyond the initial scanning of uploads, you should set this to <code>true</code> (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to <code>false</code> (no), to avoid unnecessarily reloading duplicate data into memory. In general practice, it should usually be set to <code>true</code>, but, if you do this, you won\'t be able to use the script for anything other than the initial file upload scanning. Has no influence in CLI mode.';
$phpMussel['lang']['config_general_default_algo'] = 'Defines which algorithm to use for all future passwords and sessions. Options: PASSWORD_DEFAULT (default), PASSWORD_BCRYPT, PASSWORD_ARGON2I (requires PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted file upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won\'t be touched. In the case of archives, the entire archive will be deleted, regardless of whether or not the offending file is only one of several files contained within the archive. For the case of file upload scanning, usually, it isn\'t necessary to enable this directive, because usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it\'ll usually delete any files uploaded through it to the server unless they\'ve been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn\'t always behave in the manner expected. False = After scanning, leave the file alone [Default]; True = After scanning, if not clean, delete immediately.';
$phpMussel['lang']['config_general_disable_cli'] = 'Disable CLI mode? CLI mode is enabled by default, but can sometimes interfere with certain testing tools (such as PHPUnit, for example) and other CLI-based applications. If you don\'t need to disable CLI mode, you should ignore this directive. False = Enable CLI mode [Default]; True = Disable CLI mode.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Disable front-end access? Front-end access can make phpMussel more manageable, but can also be a potential security risk, too. It\'s recommended to manage phpMussel via the back-end whenever possible, but front-end access is provided for when it isn\'t possible. Keep it disabled unless you need it. False = Enable front-end access; True = Disable front-end access [Default].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Disable webfonts? True = Yes; False = No [Default].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Enable support for phpMussel plugins? False = No; True = Yes [Default].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'Should phpMussel send 403 headers with the file upload blocked message, or stick with the usual 200 OK? False = No (200); True = Yes (403) [Default].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'File for logging front-end login attempts. Specify a filename, or leave blank to disable.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'When honeypot mode is enabled, phpMussel will attempt to quarantine every single file upload that it encounters, regardless of whether or not the file being uploaded matches any included signatures, and no actual scanning or analysis of those attempted file uploads will actually occur. This functionality should be useful for those that wish to use phpMussel for the purposes of virus/malware research, but it\'s neither recommended to enable this functionality if the intended use of phpMussel by the user is for actual file upload scanning, nor recommended to use the honeypot functionality for purposes other than honeypotting. By default, this option is disabled. False = Disabled [Default]; True = Enabled.';
$phpMussel['lang']['config_general_ipaddr'] = 'Where to find the IP address of connecting requests? (Useful for services such as Cloudflare and the likes) Default = REMOTE_ADDR. WARNING: Don\'t change this unless you know what you\'re doing!';
$phpMussel['lang']['config_general_lang'] = 'Specify the default language for phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Enable maintenance mode? True = Yes; False = No [Default]. Disables everything other than the front-end. Sometimes useful for when updating your CMS, frameworks, etc.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Maximum number of login attempts (front-end). Default = 5.';
$phpMussel['lang']['config_general_numbers'] = 'How do you prefer numbers to be displayed? Select the example that looks the most correct to you.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel is able to quarantine flagged attempted file uploads in isolation within the phpMussel vault, if this is something you want it to do. Casual users of phpMussel that simply wish to protect their websites or hosting environment without having any interest in deeply analysing any flagged attempted file uploads should leave this functionality disabled, but any users interested in further analysis of flagged attempted file uploads for malware research or for similar such things should enable this functionality. Quarantining of flagged attempted file uploads can sometimes also assist in debugging false positives, if this is something that frequently occurs for you. To disable quarantine functionality, simply leave the <code>quarantine_key</code> directive empty, or erase the contents of that directive if it isn\'t already empty. To enable quarantine functionality, enter some value into the directive. The <code>quarantine_key</code> is an important security feature of the quarantine functionality required as a means of preventing the quarantine functionality from being exploited by potential attackers and as a means of preventing any potential execution of data stored within the quarantine. The <code>quarantine_key</code> should be treated in the same manner as your passwords: The longer the better, and guard it tightly. For best effect, use in conjunction with <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'The maximum filesize allowed for files to be quarantined. Files larger than the value specified will NOT be quarantined. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Default = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'The maximum memory usage allowed for the quarantine. If the total memory used by the quarantine reaches this value, the oldest quarantined files will be deleted until the total memory used no longer reaches this value. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted data potentially causing run-away data usage on your hosting service. Default = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'For how long should phpMussel cache the results of scanning? Value is the number of seconds to cache the results of scanning for. Default is 21600 seconds (6 hours); A value of 0 will disable caching the results of scanning.';
$phpMussel['lang']['config_general_scan_kills'] = 'Filename of file to log all records of blocked or killed uploads to. Specify a filename, or leave blank to disable.';
$phpMussel['lang']['config_general_scan_log'] = 'Filename of file to log all scanning results to. Specify a filename, or leave blank to disable.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Filename of file to log all scanning results to (using a serialised format). Specify a filename, or leave blank to disable.';
$phpMussel['lang']['config_general_statistics'] = 'Track phpMussel usage statistics? True = Yes; False = No [Default].';
$phpMussel['lang']['config_general_timeFormat'] = 'The date/time notation format used by phpMussel. Additional options may be added upon request.';
$phpMussel['lang']['config_general_timeOffset'] = 'Timezone offset in minutes.';
$phpMussel['lang']['config_general_timezone'] = 'Your timezone.';
$phpMussel['lang']['config_general_truncate'] = 'Truncate logfiles when they reach a certain size? Value is the maximum size in B/KB/MB/GB/TB that a logfile may grow to before being truncated. The default value of 0KB disables truncation (logfiles can grow indefinitely). Note: Applies to individual logfiles! The size of logfiles is not considered collectively.';
$phpMussel['lang']['config_heuristic_threshold'] = 'There are certain signatures of phpMussel that are intended to identify suspicious and potentially malicious qualities of files being uploaded without in themselves identifying those files being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious and potentially malicious qualities of files being uploaded that\'s allowable is before those files are to be flagged as malicious. The definition of weight in this context is the total number of suspicious and potentially malicious qualities identified. By default, this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious files being flagged, whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious files being flagged. It\'s generally best to leave this value at its default unless you\'re experiencing problems related to it.';
$phpMussel['lang']['config_signatures_Active'] = 'A list of the active signature files, delimited by commas.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'Should phpMussel parse signatures for detecting adware? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'Should phpMussel parse signatures for detecting defacements and defacers? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'Should phpMussel detect and block encrypted files? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'Should phpMussel parse signatures for detecting joke/hoax malware/viruses? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'Should phpMussel parse signatures for detecting packers and packed data? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'Should phpMussel parse signatures for detecting PUAs/PUPs? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'Should phpMussel parse signatures for detecting shell scripts? False = No; True = Yes [Default].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'Should phpMussel report when extensions are missing? If <code>fail_extensions_silently</code> is disabled, missing extensions will be reported on scanning, and if <code>fail_extensions_silently</code> is enabled, missing extensions will be ignored, with scanning reporting for those files that there aren\'t any problems. Disabling this directive may potentially increase your security, but may also lead to an increase of false positives. False = Disabled; True = Enabled [Default].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'Should phpMussel report when signatures files are missing or corrupted? If <code>fail_silently</code> is disabled, missing and corrupted files will be reported on scanning, and if <code>fail_silently</code> is enabled, missing and corrupted files will be ignored, with scanning reporting for those files that there aren\'t any problems. This should generally be left alone unless you\'re experiencing crashes or similar problems. False = Disabled; True = Enabled [Default].';
$phpMussel['lang']['config_template_data_css_url'] = 'The template file for custom themes utilises external CSS properties, whereas the template file for the default theme utilises internal CSS properties. To instruct phpMussel to use the template file for custom themes, specify the public HTTP address of your custom theme\'s CSS files using the <code>css_url</code> variable. If you leave this variable blank, phpMussel will use the template file for the default theme.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Font magnification. Default = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Default theme to use for phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'How long (in seconds) should the results of API lookups be cached for? Default is 3600 seconds (1 hour).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Enables API lookups to the Google Safe Browsing API when the necessary API key is defined.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Enables API lookups to the hpHosts API when set to true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Maximum allowable number of API lookups to perform per individual scan iteration. Because each additional API lookup will add to the total time required to complete each scan iteration, you may wish to stipulate a limitation in order to expedite the overall scan process. When set to 0, no such maximum allowable number will be applied. Set to 10 by default.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'What to do if the maximum allowable number of API lookups is exceeded? False = Do nothing (continue processing) [Default]; True = Flag/block the file.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Optionally, phpMussel is able to scan files using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses, trojans, malware and other threats. By default, scanning files using the Virus Total API is disabled. To enable it, an API key from Virus Total is required. Due to the significant benefit that this could provide to you, it\'s something that I highly recommend enabling. Please be aware, however, that to use the Virus Total API, you <em><strong>MUST</strong></em> agree to their Terms of Service and you <em><strong>MUST</strong></em> adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS: You have read and agree to the Terms of Service of Virus Total and its API. You have read and you understand, at a minimum, the preamble of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'According to the Virus Total API documentation, "it is limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient, honeypot or any other automation that is going to provide resources to VirusTotal and not only retrieve reports you are entitled to a higher request rate quota". By default, phpMussel will strictly adhere to these limitations, but due to the possibility of these rate quotas being increased, these two directives are provided as a means for you to instruct phpMussel as to what limit it should adhere to. Unless you\'ve been instructed to do so, it\'s not recommended for you to increase these values, but, if you\'ve encountered problems relating to reaching your rate quota, decreasing these values <em><strong>MAY</strong></em> sometimes help you in dealing with these problems. Your rate limit is determined as <code>vt_quota_rate</code> requests of any nature in any given <code>vt_quota_time</code> minute time frame.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(See description above).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'By default, phpMussel will restrict which files it scans using the Virus Total API to those files that it considers "suspicious". You can optionally adjust this restriction by changing the value of the <code>vt_suspicion_level</code> directive.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists, because, although scanning a file using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious files being caught), it can also result in a higher number of false positives, and therefore, in some circumstances, the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0 is used, the results of scanning using the Virus Total API will be applied as detections, and therefore, if any engine used by Virus Total flags the file being scanned as being malicious, phpMussel will consider the file to be malicious. If any other value is used, the results of scanning using the Virus Total API will be applied as detection weighting, and therefore, the number of engines used by Virus Total that flag the file being scanned as being malicious will serve as a confidence score (or detection weighting) for whether or not the file being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0 is used by default.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'The main package (minus the signatures, documentation, and configuration).';
$phpMussel['lang']['field_activate'] = 'Activate';
$phpMussel['lang']['field_clear_all'] = 'Clear all';
$phpMussel['lang']['field_component'] = 'Component';
$phpMussel['lang']['field_create_new_account'] = 'Create new account';
$phpMussel['lang']['field_deactivate'] = 'Deactivate';
$phpMussel['lang']['field_delete_account'] = 'Delete account';
$phpMussel['lang']['field_delete_all'] = 'Delete all';
$phpMussel['lang']['field_delete_file'] = 'Delete';
$phpMussel['lang']['field_download_file'] = 'Download';
$phpMussel['lang']['field_edit_file'] = 'Edit';
$phpMussel['lang']['field_false'] = 'False';
$phpMussel['lang']['field_file'] = 'File';
$phpMussel['lang']['field_filename'] = 'Filename: ';
$phpMussel['lang']['field_filetype_directory'] = 'Directory';
$phpMussel['lang']['field_filetype_info'] = '{EXT} File';
$phpMussel['lang']['field_filetype_unknown'] = 'Unknown';
$phpMussel['lang']['field_install'] = 'Install';
$phpMussel['lang']['field_latest_version'] = 'Latest Version';
$phpMussel['lang']['field_log_in'] = 'Log In';
$phpMussel['lang']['field_more_fields'] = 'More Fields';
$phpMussel['lang']['field_new_name'] = 'New name:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Options';
$phpMussel['lang']['field_password'] = 'Password';
$phpMussel['lang']['field_permissions'] = 'Permissions';
$phpMussel['lang']['field_quarantine_key'] = 'Quarantine key';
$phpMussel['lang']['field_rename_file'] = 'Rename';
$phpMussel['lang']['field_reset'] = 'Reset';
$phpMussel['lang']['field_restore_file'] = 'Restore';
$phpMussel['lang']['field_set_new_password'] = 'Set new password';
$phpMussel['lang']['field_size'] = 'Total Size: ';
$phpMussel['lang']['field_size_bytes'] = ['byte', 'bytes'];
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Status';
$phpMussel['lang']['field_system_timezone'] = 'Use system default timezone.';
$phpMussel['lang']['field_true'] = 'True';
$phpMussel['lang']['field_uninstall'] = 'Uninstall';
$phpMussel['lang']['field_update'] = 'Update';
$phpMussel['lang']['field_update_all'] = 'Update all';
$phpMussel['lang']['field_upload_file'] = 'Upload new file';
$phpMussel['lang']['field_username'] = 'Username';
$phpMussel['lang']['field_your_version'] = 'Your Version';
$phpMussel['lang']['header_login'] = 'Please log in to continue.';
$phpMussel['lang']['label_active_config_file'] = 'Active configuration file: ';
$phpMussel['lang']['label_blocked'] = 'Uploads blocked';
$phpMussel['lang']['label_branch'] = 'Branch latest stable:';
$phpMussel['lang']['label_events'] = 'Scan events';
$phpMussel['lang']['label_flagged'] = 'Objects flagged';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Cache data and temporary files';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel disk usage: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Free disk space: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Total disk usage: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Total disk space: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Component updates metadata';
$phpMussel['lang']['label_hide'] = 'Hide';
$phpMussel['lang']['label_os'] = 'Operating system used:';
$phpMussel['lang']['label_other'] = 'Other';
$phpMussel['lang']['label_other-Active'] = 'Active signature files';
$phpMussel['lang']['label_other-Since'] = 'Start date';
$phpMussel['lang']['label_php'] = 'PHP version used:';
$phpMussel['lang']['label_phpmussel'] = 'phpMussel version used:';
$phpMussel['lang']['label_quarantined'] = 'Uploads quarantined';
$phpMussel['lang']['label_sapi'] = 'SAPI used:';
$phpMussel['lang']['label_scanned_objects'] = 'Objects scanned';
$phpMussel['lang']['label_scanned_uploads'] = 'Uploads scanned';
$phpMussel['lang']['label_show'] = 'Show';
$phpMussel['lang']['label_size_in_quarantine'] = 'Size in quarantine: ';
$phpMussel['lang']['label_stable'] = 'Latest stable:';
$phpMussel['lang']['label_sysinfo'] = 'System information:';
$phpMussel['lang']['label_tests'] = 'Tests:';
$phpMussel['lang']['label_unstable'] = 'Latest unstable:';
$phpMussel['lang']['label_upload_date'] = 'Upload date: ';
$phpMussel['lang']['label_upload_hash'] = 'Upload hash: ';
$phpMussel['lang']['label_upload_origin'] = 'Upload origin: ';
$phpMussel['lang']['label_upload_size'] = 'Upload size: ';
$phpMussel['lang']['link_accounts'] = 'Accounts';
$phpMussel['lang']['link_config'] = 'Configuration';
$phpMussel['lang']['link_documentation'] = 'Documentation';
$phpMussel['lang']['link_file_manager'] = 'File Manager';
$phpMussel['lang']['link_home'] = 'Home';
$phpMussel['lang']['link_logs'] = 'Logs';
$phpMussel['lang']['link_quarantine'] = 'Quarantine';
$phpMussel['lang']['link_statistics'] = 'Statistics';
$phpMussel['lang']['link_textmode'] = 'Text formatting: <a href="%1$sfalse">Simple</a> – <a href="%1$strue">Fancy</a>';
$phpMussel['lang']['link_updates'] = 'Updates';
$phpMussel['lang']['link_upload_test'] = 'Upload Test';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Selected logfile doesn\'t exist!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'No logfiles available.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'No logfile selected.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Maximum number of login attempts exceeded; Access denied.';
$phpMussel['lang']['previewer_days'] = 'Days';
$phpMussel['lang']['previewer_hours'] = 'Hours';
$phpMussel['lang']['previewer_minutes'] = 'Minutes';
$phpMussel['lang']['previewer_months'] = 'Months';
$phpMussel['lang']['previewer_seconds'] = 'Seconds';
$phpMussel['lang']['previewer_weeks'] = 'Weeks';
$phpMussel['lang']['previewer_years'] = 'Years';
$phpMussel['lang']['response_accounts_already_exists'] = 'An account with that username already exists!';
$phpMussel['lang']['response_accounts_created'] = 'Account successfully created!';
$phpMussel['lang']['response_accounts_deleted'] = 'Account successfully deleted!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'That account doesn\'t exist.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Password successfully updated!';
$phpMussel['lang']['response_activated'] = 'Successfully activated.';
$phpMussel['lang']['response_activation_failed'] = 'Failed to activate!';
$phpMussel['lang']['response_checksum_error'] = 'Checksum error! File rejected!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Component successfully installed.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Component successfully uninstalled.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Component successfully updated.';
$phpMussel['lang']['response_component_uninstall_error'] = 'An error occurred while attempting to uninstall the component.';
$phpMussel['lang']['response_configuration_updated'] = 'Configuration successfully updated.';
$phpMussel['lang']['response_deactivated'] = 'Successfully deactivated.';
$phpMussel['lang']['response_deactivation_failed'] = 'Failed to deactivate!';
$phpMussel['lang']['response_delete_error'] = 'Failed to delete!';
$phpMussel['lang']['response_directory_deleted'] = 'Directory successfully deleted!';
$phpMussel['lang']['response_directory_renamed'] = 'Directory successfully renamed!';
$phpMussel['lang']['response_error'] = 'Error';
$phpMussel['lang']['response_failed_to_install'] = 'Failed to install!';
$phpMussel['lang']['response_failed_to_update'] = 'Failed to update!';
$phpMussel['lang']['response_file_deleted'] = 'File successfully deleted!';
$phpMussel['lang']['response_file_edited'] = 'File successfully modified!';
$phpMussel['lang']['response_file_renamed'] = 'File successfully renamed!';
$phpMussel['lang']['response_file_restored'] = 'File successfully restored!';
$phpMussel['lang']['response_file_uploaded'] = 'File successfully uploaded!';
$phpMussel['lang']['response_login_invalid_password'] = 'Login failure! Invalid password!';
$phpMussel['lang']['response_login_invalid_username'] = 'Login failure! Username doesn\'t exist!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Password field empty!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Username field empty!';
$phpMussel['lang']['response_rename_error'] = 'Failed to rename!';
$phpMussel['lang']['response_restore_error_1'] = 'Failed to restore! Corrupted file!';
$phpMussel['lang']['response_restore_error_2'] = 'Failed to restore! Incorrect quarantine key!';
$phpMussel['lang']['response_statistics_cleared'] = 'Statistics cleared.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Already up-to-date.';
$phpMussel['lang']['response_updates_not_installed'] = 'Component not installed!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Component not installed (requires PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Outdated!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Outdated (please update manually)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Outdated (requires PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Unable to determine.';
$phpMussel['lang']['response_upload_error'] = 'Failed to upload!';
$phpMussel['lang']['state_complete_access'] = 'Complete access';
$phpMussel['lang']['state_component_is_active'] = 'Component is active.';
$phpMussel['lang']['state_component_is_inactive'] = 'Component is inactive.';
$phpMussel['lang']['state_component_is_provisional'] = 'Component is provisional.';
$phpMussel['lang']['state_default_password'] = 'Warning: Using default password!';
$phpMussel['lang']['state_logged_in'] = 'Logged in.';
$phpMussel['lang']['state_logs_access_only'] = 'Logs access only';
$phpMussel['lang']['state_maintenance_mode'] = 'Warning: Maintenance mode is enabled!';
$phpMussel['lang']['state_password_not_valid'] = 'Warning: This account is not using a valid password!';
$phpMussel['lang']['state_quarantine'] = ['There is %s file currently in quarantine.', 'There are %s files currently in quarantine.'];
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Don\'t hide non-outdated';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Hide non-outdated';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Don\'t hide unused';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Hide unused';
$phpMussel['lang']['tip_accounts'] = 'Hello, {username}.<br />The accounts page allows you to control who can access the phpMussel front-end.';
$phpMussel['lang']['tip_config'] = 'Hello, {username}.<br />The configuration page allows you to modify the configuration for phpMussel from the front-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel is offered free of charge, but if you want to donate to the project, you can do so by clicking the donate button.';
$phpMussel['lang']['tip_file_manager'] = 'Hello, {username}.<br />The file manager allows you to delete, edit, upload, and download files. Use with caution (you could break your installation with this).';
$phpMussel['lang']['tip_home'] = 'Hello, {username}.<br />This is the homepage for the phpMussel front-end. Select a link from the navigation menu on the left to continue.';
$phpMussel['lang']['tip_login'] = 'Default username: <span class="txtRd">admin</span> – Default password: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Hello, {username}.<br />Select a logfile from the list below to view the contents of that logfile.';
$phpMussel['lang']['tip_quarantine'] = 'Hello, {username}.<br />This page lists all files currently in quarantine and facilitates management of those files.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Note: Quarantine is currently disabled, but can be enabled via the configuration page.';
$phpMussel['lang']['tip_see_the_documentation'] = 'See the <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION7">documentation</a> for information about the various configuration directives and their purposes.';
$phpMussel['lang']['tip_statistics'] = 'Hello, {username}.<br />This page shows some basic usage statistics regarding your phpMussel installation.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Note: Statistics tracking is currently disabled, but can be enabled via the configuration page.';
$phpMussel['lang']['tip_updates'] = 'Hello, {username}.<br />The updates page allows you to install, uninstall, and update the various components of phpMussel (the core package, signatures, plugins, L10N files, etc).';
$phpMussel['lang']['tip_upload_test'] = 'Hello, {username}.<br />The upload test page contains a standard file upload form, allowing you to test whether a file would normally be blocked by phpMussel when attempting to upload it.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Accounts';
$phpMussel['lang']['title_config'] = 'phpMussel – Configuration';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – File Manager';
$phpMussel['lang']['title_home'] = 'phpMussel – Home';
$phpMussel['lang']['title_login'] = 'phpMussel – Login';
$phpMussel['lang']['title_logs'] = 'phpMussel – Logs';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Quarantine';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Statistics';
$phpMussel['lang']['title_updates'] = 'phpMussel – Updates';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Upload Test';
$phpMussel['lang']['warning'] = 'Warnings:';
$phpMussel['lang']['warning_php_1'] = 'Your PHP version is not actively supported anymore! Updating is recommended!';
$phpMussel['lang']['warning_php_2'] = 'Your PHP version is severely vulnerable! Updating is strongly recommended!';
$phpMussel['lang']['warning_signatures_1'] = 'No signature files are active!';

$phpMussel['lang']['info_some_useful_links'] = 'Some useful links:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel Issues @ GitHub</a> – Issues page for phpMussel (support, assistance, etc).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Discussion forum for phpMussel (support, assistance, etc).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Alternative download mirror for phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – A collection of simple webmaster tools to secure websites.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV homepage (ClamAV® is an open source antivirus engine for detecting trojans, viruses, malware &amp; other malicious threats).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Computer security company that offers supplementary signatures for ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Phishing database utilised by the phpMussel URL scanner.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP learning resources and discussion.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP learning resources and discussion.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal is a free service for analysing suspicious files and URLs.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis is a free malware analysis service provided by <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Computer anti-malware specialists.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Useful malware focused discussion forums.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Vulnerability Charts</a> – Lists safe/unsafe versions of various packages (PHP, HHVM, etc).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Compatibility Charts</a> – Lists compatibility information for various packages (CIDRAM, phpMussel, etc).</li>
        </ul>';
