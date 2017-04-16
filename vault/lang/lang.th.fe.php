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
 * This file: Thai language data for the front-end (last modified: 2017.04.17).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">โฮมเพจ</a> | <a href="?phpmussel-page=logout">ออกจากระบบ</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">ออกจากระบบ</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Recognised archive file extensions (format is CSV; should only add or remove when problems occur; unnecessarily removing may cause false positive to appear for archive files, whereas unnecessarily adding will essentially whitelist what you\'re adding from attack specific detection; modify with caution; also note that this has no effect on what archives can and can\'t be analysed at content-level). The list, as is at default, lists those formats used most commonly across the majority of systems and CMS, but intentionally isn\'t necessarily comprehensive.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Block any files containing any control characters (other than newlines)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) If you\'re <em><strong>ONLY</strong></em> uploading plain-text, then you can turn this option on to provide some additional protection to your system. However, if you upload anything other than plain-text, turning this on may result in false positive. False = Don\'t block [ค่าเริ่มต้น]; True = Block.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Search for PHP header in files that are neither PHP files nor recognised archives. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR, ZIP, RAR, GZ). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Search for office documents whose headers are incorrect (Supported: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Search for images whose headers are incorrect (Supported: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Search for PDF files whose headers are incorrect. False = Off; True = On.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Corrupted files and parse errors. False = Ignore; True = Block [ค่าเริ่มต้น]. Detect and block potentially corrupted PE (Portable Executable) files? Often (but not always), when certain aspects of a PE file are corrupted or can\'t be parsed correctly, it can be indicative of a viral infection. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Optional limitation or threshold to the length of raw data within which decode commands should be detected (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. ค่าเริ่มต้น = 512 (512KB). Zero or null value disables the threshold (removing any such limitation based on filesize).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Optional limitation or threshold to the length of raw data that phpMussel is permitted to read and scan (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. ค่าเริ่มต้น = 32768 (32MB). Zero or null value disables the threshold. Generally, this value shouldn\'t be less than the average filesize of file uploads that you want and expect to receive to your server or website, shouldn\'t be more than the filesize_limit directive, and shouldn\'t be more than roughly one fifth of the total allowable memory allocation granted to PHP via the <code>php.ini</code> configuration file. This directive exists to try to prevent phpMussel from using up too much memory (that\'d prevent it from being able to successfully scan files above a certain filesize).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'This directive should generally be disabled unless it\'s required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the <code>$_FILES</code> array(), it\'ll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. However, for some CMS, empty elements in <code>$_FILES</code> can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren\'t any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. False = OFF; True = ON.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don\'t require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it\'ll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. False = OFF; True = ON.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Detect and block encrypted archives? Because phpMussel isn\'t able to scan the contents of encrypted archives, it\'s possible that archive encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. False = No; True = Yes [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_check_archives'] = 'Attempt to check the contents of archives? False = Don\'t check; True = Check [ค่าเริ่มต้น]. Currently, the only archive and compression formats supported are BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR and ZIP (archive and compression formats RAR, CAB, 7z and etcetera not currently supported). This is not foolproof! While I highly recommend keeping this turned on, I can\'t guarantee it\'ll always find everything. Also be aware that archive checking currently is not recursive for PHARs or ZIPs.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Carry over filesize blacklisting/whitelisting to the contents of archives? False = No (just greylist everything); True = Yes [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Filesize limit in KB. 65536 = 64MB [ค่าเริ่มต้น]; 0 = No limit (always greylisted), any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.';
$phpMussel['lang']['config_files_filesize_response'] = 'What to do with files that exceed the filesize limit (if one exists). False = Whitelist; True = Blacklist [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Carry over filetype blacklisting/whitelisting to the contents of archives? False = No (just greylist everything) [ค่าเริ่มต้น]; True = Yes.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Blacklist:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Greylist:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist. Logical order of processing is: If the filetype is whitelisted, don\'t scan and don\'t block the file, and don\'t check the file against the blacklist or the greylist. If the filetype is blacklisted, don\'t scan the file but block it anyway, and don\'t check the file against the greylist. If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the file as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the file as blacklisted, therefore not scanning it but blocking it anyway. Whitelist:';
$phpMussel['lang']['config_files_max_recursion'] = 'Maximum recursion depth limit for archives. ค่าเริ่มต้น = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Maximum allowable number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn\'t account for or include the contents of archives.';
$phpMussel['lang']['config_general_cleanup'] = 'Unset variables and cache used by the script after the initial upload scanning? False = No; True = Yes [ค่าเริ่มต้น]. If you -aren\'t- using the script beyond the initial scanning of uploads, you should set this to <code>true</code> (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to <code>false</code> (no), to avoid unnecessarily reloading duplicate data into memory. In general practice, it should usually be set to <code>true</code>, but, if you do this, you won\'t be able to use the script for anything other than the initial file upload scanning. Has no influence in CLI mode.';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted file upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won\'t be touched. In the case of archives, the entire archive will be deleted, regardless of whether or not the offending file is only one of several files contained within the archive. For the case of file upload scanning, usually, it isn\'t necessary to enable this directive, because usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it\'ll usually delete any files uploaded through it to the server unless they\'ve been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn\'t always behave in the manner expected. False = After scanning, leave the file alone [ค่าเริ่มต้น]; True = After scanning, if not clean, delete immediately.';
$phpMussel['lang']['config_general_disable_cli'] = 'ปิดใช้งานโหมด CLI หรือไม่?';
$phpMussel['lang']['config_general_disable_frontend'] = 'ปิดใช้งานการเข้าถึง front-end หรือไม่?';
$phpMussel['lang']['config_general_disable_webfonts'] = 'หยุดใช้ webfonts หรือไม่? True = หยุดใช้; False = ไม่หยุดใช้ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_enable_plugins'] = 'เปิดใช้งานการสนับสนุนปลั๊กอิน phpMussel หรือไม่? False = ไม่เปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'ควร phpMussel ส่งส่วนหัว 403 มีข้อความเกี่ยวกับอัปโหลดไฟล์ที่ถูกบล็อก, หรือเก็บไว้กับปกติ 200 OK? False = ส่ง 200; True = ส่ง 403 [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'ไฟล์สำหรับบันทึกพยายามเข้าสู่ระบบที่ front-end. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'เมื่อเปิดใช้งานโหมด honeypot, phpMussel จะพยายามกักกันการอัปโหลดไฟล์ทั้งหมดที่มันเจอ, ไม่ว่าจะเป็นหรือไม่ก็ตามไฟล์ตรงกับลายเซ็นที่รวมอยู่, และทั้งการสแกนและการวิเคราะห์สำหรับไฟล์เหล่านี้จะไม่เกิดขึ้นจริง. ฟังก์ชันนี้ควรมีประโยชน์สำหรับผู้ที่ต้องการใช้ phpMussel เพื่อวัตถุประสงค์ในการวิจัยไวรัส/มัลแวร์, แต่ไม่แนะนำเพื่อให้สามารถใช้งานฟังก์ชันนี้ได้ถ้าใช้ของ phpMussel ตั้งใจโดยผู้ใช้สำหรับการอัปโหลดไฟล์จริง, และไม่แนะนำสำหรับวัตถุประสงค์ที่ไม่เกี่ยวข้องกับฟังก์ชันการทำงานของ honeypot. โดยค่าเริ่มต้น, ตัวเลือกนี้ถูกปิดใช้งาน. False = เปิดใช้งาน [ค่าเริ่มต้น]; True = เปิดใช้งาน.';
$phpMussel['lang']['config_general_ipaddr'] = 'ตำแหน่งของที่อยู่ IP สำหรับคำขอการเชื่อมต่อ (เป็นประโยชน์สำหรับบริการเช่น Cloudflare, ฯลฯ). ค่าเริ่มต้น = REMOTE_ADDR. คำเตือน: อย่าเปลี่ยนสิ่งนี้จนกว่าคุณจะรู้ว่าคุณกำลังทำอะไร!';
$phpMussel['lang']['config_general_lang'] = 'ระบุภาษาค่าเริ่มต้นสำหรับ phpMussel.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'จำนวนสูงสุดความพยายามเข้าสู่ระบบ.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel สามารถกักกันไฟล์ที่ระบุได้ในการแยกภายใน vault ของ phpMussel, ถ้าคุณต้องการทำเช่นนี้. ผู้ใช้ที่ต้องการปกป้องเว็บไซต์หรือโฮสต์สภาพแวดล้อมของตนเท่านั้นไม่มีดอกเบี้ยในวิเคราะห์การอัปโหลดไฟล์อย่างละเอียดควรปล่อยให้ฟังก์ชันนี้ถูกปิดใช้งาน, แต่ผู้ใช้ใดที่มีความสนใจเช่นกันควรเปิดใช้งานฟังก์ชันนี้. การกักกันของอัปโหลดไฟล์อาจช่วยในแก้จุดบกพร่อง false positive, ถ้านี่คือสิ่งที่เกิดขึ้นบ่อยๆสำหรับคุณ. ในการปิดใช้งานฟังก์ชันกักกัน, เพียงแค่ปล่อยให้คำสั่ง <code>quarantine_key</code> ว่างเปล่า, หรือลบเนื้อหาหากยังไม่ว่าง. เมื่อต้องการเปิดใช้งานฟังก์ชันกักกัน, ใส่ค่าลงในคำสั่ง. <code>quarantine_key</code> เป็นคุณลักษณะด้านความปลอดภัยที่สำคัญสำหรับฟังก์ชันการกักกันจำเป็นต้องใช้เพื่อป้องกันฟังก์ชันการกักกันจากถูกใช้ประโยชน์โดยผู้บุกรุกที่อาจเกิดขึ้นและเป็นวิธีการในการป้องกันการดำเนินการข้อมูลที่เก็บไว้ภายในเขตกักกัน. <code>quarantine_key</code> ควรได้รับการปฏิบัติเช่นเดียวกับรหัสผ่านของคุณ: อีกต่อไปจะดีกว่า, และระมัดระวังอย่างระมัดระวัง. เพื่อให้ได้ผลดีที่สุด, ใช้ร่วมกับ <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'ขนาดไฟล์สูงสุดที่อนุญาตสำหรับไฟล์ที่ถูกกักกัน. ไฟล์มีขนาดใหญ่กว่าค่าที่ระบุจะไม่ถูกกักกัน. คำสั่งนี้มีความสำคัญเป็นวิธีการทำให้ยากขึ้นสำหรับผู้บุกรุกที่อาจเกิดขึ้นจากน้ำท่วมกักกันของคุณด้วยข้อมูลที่ไม่พึงประสงค์ที่อาจทำให้เกิดการใช้ข้อมูลส่วนเกินเกี่ยวกับบริการพื้นที่ของคุณ. ค่าเป็น KB. ค่าเริ่มต้น =2048 =2048KB =2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'การใช้หน่วยความจำสูงสุดอนุญาตให้มีการกักกัน. หากหน่วยความจำทั้งหมดใช้โดยกักกันถึงค่านี้, ไฟล์กักกันที่เก่าแก่ที่สุดจะถูกลบออกจนการใช้หน่วยความจำทั้งหมดไม่ถึงค่านี้อีกต่อไป. คำสั่งนี้มีความสำคัญเป็นวิธีการทำให้ยากขึ้นสำหรับผู้บุกรุกที่อาจเกิดขึ้นจากน้ำท่วมกักกันของคุณด้วยข้อมูลที่ไม่พึงประสงค์ที่อาจทำให้เกิดการใช้ข้อมูลส่วนเกินเกี่ยวกับบริการพื้นที่ของคุณ. ค่าเป็น KB. ค่าเริ่มต้น =65536 =65536KB =64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'เวลาเท่าไรควร phpMussel แคชผลการสแกน? ค่าคือจำนวนวินาทีที่จะแคชผลการสแกน. ค่าเริ่มต้นคือ 21600 วินาที (6 ชั่วโมง); ค่า 0 จะปิดใช้งานแคชของผลการสแกน.';
$phpMussel['lang']['config_general_scan_kills'] = 'ชื่อไฟล์สำหรับบันทึกข้อมูลทั้งหมดสำหรับอัปโหลดที่ถูกบล็อกหรือถูกฆ่า. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_scan_log'] = 'ชื่อไฟล์สำหรับบันทึกผลการสแกนทั้งหมด. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'ชื่อไฟล์สำหรับบันทึกผลการสแกนทั้งหมด (ใช้รูปแบบ serialized). ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_timeFormat'] = 'รูปแบบสัญกรณ์สำหรับวันและเวลาใช้โดย phpMussel. เลือกตัวเลือกจากรายการด้านล่าง. ตัวเลือกเพิ่มเติมอาจเพิ่มเมื่อมีการร้องขอ.';
$phpMussel['lang']['config_general_timeOffset'] = 'เขตเวลาชดเชยในนาที.';
$phpMussel['lang']['config_heuristic_threshold'] = 'ลายเซ็น phpMussel บางตัวมีจุดมุ่งหมายเพื่อระบุลักษณะที่น่าสงสัยและอาจเป็นอันตรายในไฟล์ที่อัปโหลดไม่มีในตัวเองระบุไฟล์ที่อัปโหลดโดยเฉพาะอย่างยิ่งที่เป็นอันตราย. ค่านี้ "threshold" บอก phpMussel น้ำหนักรวมสูงสุดสำหรับคุณภาพที่น่าสงสัยและอาจเป็นอันตรายสำหรับไฟล์ที่อัปโหลดก่อนที่จะถูกระบุว่าเป็นอันตราย. ความหมายของน้ำหนักในบริบทนี้คือจำนวนรวมของคุณลักษณะที่น่าสงสัยและอาจเป็นอันตรายที่ระบุ. โดยค่าเริ่มต้น, ค่านี้จะถูกกำหนดเป็น 3. โดยทั่วไป, ค่าที่ต่ำกว่าจะส่งผลให้เกิดขึ้นมากขึ้น false positive แต่มีการระบุไฟล์ที่เป็นอันตรายจำนวนมากขึ้น, ในขณะที่ค่าที่สูงขึ้นโดยทั่วไปจะทำให้เกิดเหตุการณ์ที่ต่ำลงของ false positive แต่เป็นตัวเลขที่ต่ำกว่าของไฟล์ที่เป็นอันตรายถูกระบุ. เป็นการดีที่สุดที่จะปล่อยให้ค่านี้เป็นค่าเริ่มต้นจนกว่าคุณจะประสบปัญหา.';
$phpMussel['lang']['config_signatures_Active'] = 'รายการไฟล์ลายเซ็นที่ใช้งานอยู่, คั่นด้วยเครื่องหมายจุลภาค.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับแอดแวร์หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นเพื่อตรวจหา defacements และ defacers หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับการตรวจจับมัลแวร์และไวรัสที่ตหลอกลวงหรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับเครื่องบรรจุหีบห่อและข้อมูลที่บรรจุหรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับ PUA/PUP หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับการตรวจจับสคริปต์เชลล์หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'ควร phpMussel รายงานเมื่อไม่มีส่วนขยายหรือไม่? ถ้า <code>fail_extensions_silently</code> ถูกปิดใช้งาน, ส่วนขยายที่ขาดหายไปจะมีการรายงานเมื่อทำการสแกน, และถ้า <code>fail_extensions_silently</code> เปิดใช้งาน, ส่วนขยายที่ขาดหายไปจะถูกละเลย, และจะมีรายงานว่าไม่มีปัญหา. การปิดใช้งานคำสั่งนี้อาจเพิ่มความปลอดภัยของคุณ, แต่ยังอาจนำไปสู่การเพิ่มขึ้น false positive. False = เปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'ควร phpMussel รายงานเมื่อไฟล์ลายเซ็นสูญหายหรือเสียหายหรือไม่? ถ้า <code>fail_silently</code> ถูกปิดใช้งาน, ไฟล์ที่ขาดหายไปและเสียหายจะรายงานเมื่อทำการสแกน, และถ้า <code>fail_silently</code> เปิดใช้งาน, ไฟล์ที่ขาดหายไปและเสียหายจะถูกละเลย, และจะมีรายงานว่าไม่มีปัญหา. โดยทั่วไปแล้วควรทิ้งไว้ตามลำพังจนกว่าคุณจะประสบปัญหา. False = ปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_template_data_css_url'] = 'ไฟล์เทมเพลตสำหรับธีมที่กำหนดเองใช้คุณสมบัติ CSS ภายนอก, ขณะที่ไฟล์เทมเพลตสำหรับธีมเริ่มต้นใช้คุณสมบัติ CSS ภายใน. เพื่อที่จะบอก phpMussel ใช้ไฟล์เทมเพลตสำหรับธีมที่กำหนดเอง, ระบุที่อยู่ HTTP สาธารณะของไฟล์ CSS ของธีมที่กำหนดเองโดยใช้ตัวแปร <code>css_url</code>. หากปล่อยตัวแปรนี้ไว้ว่าง, phpMussel จะใช้ไฟล์เทมเพลตสำหรับธีมเริ่มต้น.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'จำนวนวินาทีที่จะแคชผลลัพธ์สำหรับการค้นหา API. ค่าเริ่มต้นคือ 3600 วินาที (1 ชั่วโมง).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'เปิดใช้งานการค้นหา API สำหรับ Google Safe Browsing API เมื่อมีการกำหนดคีย์ API ที่จำเป็นไว้.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'เปิดใช้งานการค้นหา API สำหรับ hpHosts API เมื่อตั้งค่าเป็น true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'จำนวนที่อนุญาตสูงสุดของการค้นหา API ทำต่อการทำซ้ำของการสแกนแต่ละครั้ง. เพราะการค้นหา API แต่ละครั้งจะเพิ่มเวลารวมที่ต้องการเพื่อทำซ้ำการสแกนแต่ละครั้ง, คุณอาจต้องการกำหนดข้อจำกัดเพื่อเร่งกระบวนการสแกนโดยรวม.เมื่อตั้งค่าเป็น 0, ไม่มีจำนวนที่อนุญาตสูงสุดดังกล่าวจะถูกนำมาใช้. ตั้งค่าเป็น 10 โดยค่าเริ่มต้น.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'จะทำอย่างไรถ้าจำนวนที่อนุญาตสูงสุดของการค้นหา API คือเกิน? False = ไม่ทำอะไร (ดำเนินการต่อ) [ค่าเริ่มต้น]; True = หยุดไฟล์.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'ถ้าคุณต้องการ, phpMussel สามารถสแกนไฟล์โดยใช้ Virus Total API เป็นวิธีการเพิ่มระดับการป้องกันไวรัส, โทรจัน, มัลแวร์, และภัยคุกคามอื่น. โดยค่าเริ่มต้น, การสแกนไฟล์ด้วย Virus Total API จะถูกปิดใช้งาน. ในการเปิดใช้งาน, จำเป็นต้องมีคีย์ API จาก Virus Total. เนื่องจากข้อดีที่สำคัญที่จะช่วยให้คุณได้, ฉันขอแนะนำให้เปิดใช้งานนี้. โปรดทราบว่า, เพื่อใช้ API Virus Total, คุณ<em><strong>ต้อง</strong></em>ยอมรับข้อกำหนดในการให้บริการและคุณ<em><strong>ต้อง</strong></em> ปฏิบัติตามหลักเกณฑ์ทั้งหมดที่อธิบายไว้ในเอกสารประกอบ! คุณไม่ได้รับอนุญาตให้ใช้คุณลักษณะนี้เว้นแต่: คุณได้อ่านและยอมรับข้อกำหนดในการให้บริการแล้วของ Virus Total และ API. คุณได้อ่านและเข้าใจแล้ว, อย่างน้อยที่สุด, คำนำของเอกสารของ Virus Total Public API (ทุกอย่างหลังจาก "VirusTotal Public API v2.0" แต่ก่อน "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'ตามเอกสารคู่มือ Virus Total API, มันคือจำกัด 4 คำขอของชนิดใดในกรอบเวลาใด 1 นาที. ถ้าคุณเรียกใช้ honeyclient, honeypot, หรือระบบอัตโนมัติอื่นที่จะให้ทรัพยากรสำหรับ VirusTotal และไม่เพียงแต่เรียกรายงานคุณมีสิทธิ์ได้รับโควต้าอัตราการร้องขอที่สูงขึ้น. โดยค่าเริ่มต้น, phpMussel จะปฏิบัติตามข้อจำกัดเหล่านี้อย่างเคร่งครัด, แต่เนื่องจากความเป็นไปได้ของโควต้าอัตราเหล่านี้เพิ่มขึ้น, ทั้งสองข้อนี้มีให้คุณสามารถสั่งสอน phpMussel เป็นสิ่งที่จำกัดที่ควรปฏิบัติตาม. ยกเว้นกรณีที่คุณได้รับคำสั่งให้ทำเช่นนั้น, มันไม่แนะนำสำหรับคุณเพื่อเพิ่มค่าเหล่านี้, แต่, ถ้าคุณพบปัญหาเกี่ยวกับการเข้าถึงโควต้าอัตรา, ลดค่าเหล่านี้<em><strong>อาจ</strong></em>บางครั้งช่วยให้คุณในการจัดการกับปัญหาเหล่านี้. ขีดจำกัดอัตราของคุณถูกกำหนดเป็น <code>vt_quota_rate</code> คำขอของชนิดใดในกรอบเวลาใด <code>vt_quota_time</code> นาที.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(ดูรายละเอียดข้างต้น).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'โดยค่าเริ่มต้น, phpMussel จะ จำกัดไฟล์ที่จะสแกนโดยใช้ Virus Total API ไปไฟล์เหล่านั้นที่ถือว่า "น่าสงสัย". คุณสามารถเลือกปรับข้อ จำกัด นี้ได้โดยการเปลี่ยนค่าของคำสั่ง <code>vt_suspicion_level</code>.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'ควร phpMussel ตีความผลการสแกนใช้ Virus Total API เป็นการตรวจจับหรือเป็นน้ำหนักการตรวจจับ? คำสั่งนี้มีอยู่, เพราะ, แม้ว่าการสแกนไฟล์ด้วยใช้เครื่องยนต์หลาย (ตามวิธี Virus Total ทำ) ควรผลในอัตราการตรวจจับเพิ่มขึ้น(และดังนั้นจึงในจำนวนที่สูงขึ้นของไฟล์ที่เป็นอันตรายถูกจับ), มันยังสามารถส่งผลให้มากกว่า false positive, และดังนั้นจึง, ในบางสถานการณ์, ผลการสแกนอาจใช้ประโยชน์ได้ดีกว่าเป็นคะแนนความเชื่อมั่นแทนที่จะเป็นข้อสรุปที่ชัดเจน. ถ้าใช้ค่าเป็น 0, ผลการสแกนจาก Virus Total API จะถูกใช้เป็นการตรวจจับ, และดังนั้นจึง, หากเครื่องมือใดใช้โดย Virus Total ระบุไฟล์ที่กำลังสแกนเป็นอันตราย, phpMussel จะพิจารณาว่าไฟล์เป็นอันตราย. หากใช้ค่าอื่น, ผลการสแกนจาก Virus Total API จะถูกใช้เป็นน้ำหนักการตรวจจับ, และดังนั้นจึง, จำนวนเครื่องที่ใช้โดย Virus Total ที่ระบุไฟล์ที่ถูกสแกนว่าเป็นอันตรายจะทำหน้าที่เป็นคะแนนความเชื่อมั่น (หรือน้ำหนักการตรวจจับ) สำหรับหรือไม่ไฟล์ที่ถูกสแกนควรได้รับการพิจารณาว่าเป็นอันตรายโดย phpMussel (ค่าที่ใช้จะแสดงคะแนนความเชื่อมั่นต่ำสุดหรือน้ำหนักการตรวจจับเพื่อที่จะได้รับการพิจารณาที่เป็นอันตราย). ค่าเริ่มต้นจะถูกใช้เป็นค่าเริ่มต้น 0.';
$phpMussel['lang']['field_activate'] = 'เปิดใช้งาน';
$phpMussel['lang']['field_component'] = 'คอมโพเนนต์';
$phpMussel['lang']['field_create_new_account'] = 'สร้างบัญชีใหม่';
$phpMussel['lang']['field_deactivate'] = 'ปิดใช้งาน';
$phpMussel['lang']['field_delete_account'] = 'ลบบัญชี';
$phpMussel['lang']['field_delete_file'] = 'ลบ';
$phpMussel['lang']['field_download_file'] = 'ดาวน์โหลด';
$phpMussel['lang']['field_edit_file'] = 'เปลี่ยนแปลง';
$phpMussel['lang']['field_file'] = 'ไฟล์';
$phpMussel['lang']['field_filename'] = 'ชื่อไฟล์: ';
$phpMussel['lang']['field_filetype_directory'] = 'ไดเรกทอรี';
$phpMussel['lang']['field_filetype_info'] = 'ไฟล์ {EXT}';
$phpMussel['lang']['field_filetype_unknown'] = 'ไม่รู้จัก';
$phpMussel['lang']['field_install'] = 'ติดตั้ง';
$phpMussel['lang']['field_latest_version'] = 'รุ่นล่าสุด';
$phpMussel['lang']['field_log_in'] = 'เข้าสู่ระบบ';
$phpMussel['lang']['field_more_fields'] = 'รับฟิลด์เพิ่มเติม';
$phpMussel['lang']['field_new_name'] = 'ชื่อใหม่:';
$phpMussel['lang']['field_ok'] = 'ตกลง';
$phpMussel['lang']['field_options'] = 'ตัวเลือก';
$phpMussel['lang']['field_password'] = 'รหัสผ่าน';
$phpMussel['lang']['field_permissions'] = 'สิทธิ์';
$phpMussel['lang']['field_rename_file'] = 'เปลี่ยนชื่อ';
$phpMussel['lang']['field_reset'] = 'รีเซ็ต';
$phpMussel['lang']['field_set_new_password'] = 'ตั้งรหัสผ่านใหม่';
$phpMussel['lang']['field_size'] = 'ขนาดรวม: ';
$phpMussel['lang']['field_size_bytes'] = 'ไบต์';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'สถานะ';
$phpMussel['lang']['field_uninstall'] = 'ถอนการติดตั้ง';
$phpMussel['lang']['field_update'] = 'อัปเดต';
$phpMussel['lang']['field_update_all'] = 'อัพเดททั้งสิ้น';
$phpMussel['lang']['field_upload_file'] = 'อัปโหลดไฟล์ใหม่';
$phpMussel['lang']['field_username'] = 'ชื่อผู้ใช้';
$phpMussel['lang']['field_your_version'] = 'เวอร์ชั่นของคุณ';
$phpMussel['lang']['header_login'] = 'เข้าสู่ระบบเพื่อดำเนินการต่อ.';
$phpMussel['lang']['link_accounts'] = 'บัญชี';
$phpMussel['lang']['link_config'] = 'การกำหนดค่า';
$phpMussel['lang']['link_documentation'] = 'เอกสาร';
$phpMussel['lang']['link_file_manager'] = 'ตัวจัดการไฟล์';
$phpMussel['lang']['link_home'] = 'โฮมเพจ';
$phpMussel['lang']['link_logs'] = 'บันทึก';
$phpMussel['lang']['link_updates'] = 'อัปเดต';
$phpMussel['lang']['link_upload_test'] = 'ทดสอบการอัปโหลด';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'ไฟล์บันทึกเลือกไม่มีอยู่จริง!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'ไม่มีไฟล์บันทึกใช้ได้.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'ไม่มีไฟล์บันทึกเลือก.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'จำนวนสูงสุดความพยายามเข้าสู่ระบบเกิน; ปฏิเสธการเข้าใช้.';
$phpMussel['lang']['response_accounts_already_exists'] = 'บัญชีด้วยนั่นเองชื่อผู้ใช้มีอยู่แล้ว!';
$phpMussel['lang']['response_accounts_created'] = 'บัญชีสำเร็จแล้วสร้าง!';
$phpMussel['lang']['response_accounts_deleted'] = 'บัญชีสำเร็จแล้วลบ!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'บัญชีไม่มีอยู่จริง.';
$phpMussel['lang']['response_accounts_password_updated'] = 'รหัสผ่านสำเร็จแล้วอัปเดต!';
$phpMussel['lang']['response_activated'] = 'สำเร็จแล้วเปิดใช้งาน.';
$phpMussel['lang']['response_activation_failed'] = 'ล้มเหลวเปิดใช้งาน!';
$phpMussel['lang']['response_component_successfully_installed'] = 'คอมโพเนนต์สำเร็จแล้วในการติดตั้ง.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'คอมโพเนนต์สำเร็จแล้วถอนการติดตั้ง.';
$phpMussel['lang']['response_component_successfully_updated'] = 'คอมโพเนนต์สำเร็จแล้วอัปเดต.';
$phpMussel['lang']['response_component_uninstall_error'] = 'เกิดขึ้นผิดพลาดขณะพยายามถอนการติดตั้งคอมโพเนนต์.';
$phpMussel['lang']['response_component_update_error'] = 'เกิดขึ้นผิดพลาดขณะพยายามอัปเดตคอมโพเนนต์.';
$phpMussel['lang']['response_configuration_updated'] = 'การกำหนดค่าสำเร็จแล้วอัปเดต.';
$phpMussel['lang']['response_deactivated'] = 'สำเร็จแล้วปิดใช้งาน.';
$phpMussel['lang']['response_deactivation_failed'] = 'ล้มเหลวปิดใช้งาน!';
$phpMussel['lang']['response_delete_error'] = 'ล้มเหลวลบ!';
$phpMussel['lang']['response_directory_deleted'] = 'ไดเรกทอรีสำเร็จแล้วลบ!';
$phpMussel['lang']['response_directory_renamed'] = 'ไดเรกทอรีสำเร็จแล้วเปลี่ยนชื่อ!';
$phpMussel['lang']['response_error'] = 'ข้อผิดพลาด';
$phpMussel['lang']['response_file_deleted'] = 'ไฟล์สำเร็จแล้วลบ!';
$phpMussel['lang']['response_file_edited'] = 'ไฟล์สำเร็จแล้วเปลี่ยนแปลง!';
$phpMussel['lang']['response_file_renamed'] = 'ไฟล์สำเร็จแล้วเปลี่ยนชื่อ!';
$phpMussel['lang']['response_file_uploaded'] = 'ไฟล์สำเร็จแล้วอัปโหลด!';
$phpMussel['lang']['response_login_invalid_password'] = 'ความล้มเหลวในการเข้าสู่ระบบ! รหัสผ่านไม่ถูกต้อง!';
$phpMussel['lang']['response_login_invalid_username'] = 'ความล้มเหลวในการเข้าสู่ระบบ! ชื่อผู้ใช้ไม่มีอยู่จริง!';
$phpMussel['lang']['response_login_password_field_empty'] = 'รหัสผ่านฟิลด์ว่างเปล่า!';
$phpMussel['lang']['response_login_username_field_empty'] = 'ชื่อผู้ใช้ฟิลด์ว่างเปล่า!';
$phpMussel['lang']['response_rename_error'] = 'ล้มเหลวเปลี่ยนชื่อ!';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'อัปเดตแล้ว.';
$phpMussel['lang']['response_updates_not_installed'] = 'คอมโพเนนต์ไม่ได้ติดตั้ง!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'คอมโพเนนต์ไม่ได้ติดตั้ง (ต้องการ PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'ล้าสมัยแล้ว!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'ล้าสมัยแล้ว (โปรดอัปเดตด้วยตนเอง)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'ล้าสมัยแล้ว (ต้องการ PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'ไม่สามารถกำหนดได้.';
$phpMussel['lang']['response_upload_error'] = 'ล้มเหลวอัปโหลด!';
$phpMussel['lang']['state_complete_access'] = 'เข้าถึงได้อย่างสมบูรณ์';
$phpMussel['lang']['state_component_is_active'] = 'คอมโพเนนต์ใช้งานอยู่.';
$phpMussel['lang']['state_component_is_inactive'] = 'คอมโพเนนต์ไม่ใช้งาน.';
$phpMussel['lang']['state_component_is_provisional'] = 'คอมโพเนนต์เป็นครั้งคราว.';
$phpMussel['lang']['state_default_password'] = 'คำเตือน: ใช้ค่าเริ่มต้นรหัสผ่าน!';
$phpMussel['lang']['state_logged_in'] = 'เข้าสู่ระบบ.';
$phpMussel['lang']['state_logs_access_only'] = 'เข้าถึงบันทึกเท่านั้น';
$phpMussel['lang']['state_password_not_valid'] = 'คำเตือน: บัญชีนี้ไม่ได้ใช้รหัสผ่านถูกต้อง!';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'อย่าซ่อนไม่ใช่ล้าสมัย';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'ซ่อนไม่ใช่ล้าสมัย';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'อย่าซ่อนไม่ได้ใช้';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'ซ่อนไม่ได้ใช้';
$phpMussel['lang']['tip_accounts'] = 'สวัสดี, {username}.<br />หน้าบัญชีช่วยให้คุณสามารถควบคุมผู้ที่สามารถเข้าถึง front-end ของ phpMussel.';
$phpMussel['lang']['tip_config'] = 'สวัสดี, {username}.<br />หน้าการกำหนดค่าช่วยให้คุณสามารถแก้ไขการกำหนดค่าสำหรับ phpMussel จาก front-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel ให้บริการฟรี, แต่ถ้าคุณต้องการบริจาคให้กับโครงการ, คุณสามารถทำได้โดยคลิกที่ปุ่มบริจาค.';
$phpMussel['lang']['tip_file_manager'] = 'สวัสดี, {username}.<br />ตัวจัดการไฟล์ ช่วยให้คุณสามารถลบบัญชี, แก้ไข, อัปโหลด, และดาวน์โหลดไฟล์. ใช้ด้วยความระมัดระวัง (คุณสามารถทำลายการติดตั้งของคุณด้วยนี้).';
$phpMussel['lang']['tip_home'] = 'สวัสดี, {username}.<br />นี่คือโฮมเพจสำหรับ front-end ของ phpMussel. เลือกลิงค์จากเมนูนำทางด้านซ้ายเพื่อดำเนินการต่อ.';
$phpMussel['lang']['tip_login'] = 'ค่าเริ่มต้นชื่อผู้ใช้: <span class="txtRd">admin</span> – ค่าเริ่มต้นรหัสผ่าน: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'สวัสดี, {username}.<br />เลือกไฟล์บันทึกจากรายการด้านล่างเพื่อดูเนื้อหาของไฟล์บันทึกนั้น.';
$phpMussel['lang']['tip_see_the_documentation'] = 'ดูที่<a href="https://github.com/Maikuolan/phpMussel/blob/master/_docs/readme.en.md#SECTION6">เอกสาร</a>สำหรับข้อมูลเกี่ยวกับคำสั่งการกำหนดค่าต่างๆและวัตถุประสงค์ของพวกเขา.';
$phpMussel['lang']['tip_updates'] = 'สวัสดี, {username}.<br />หน้าอัปเดตช่วยให้คุณสามารถติดตั้ง, ถอนการติดตั้ง, และอัปเดตคอมโพเนนต์ต่างๆของ phpMussel (แพคเกจหลัก, ลายเซ็น, ไฟล์การแปล, ฯลฯ).';
$phpMussel['lang']['tip_upload_test'] = 'สวัสดี, {username}.<br />หน้าทดสอบการอัปโหลดมีแบบฟอร์มอัปโหลดไฟล์มาตรฐาน, ช่วยให้คุณสามารถทดสอบถ้าไฟล์ปกติจะถูกบล็อกโดย phpMussel เมื่อพยายามอัปโหลด.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – บัญชี';
$phpMussel['lang']['title_config'] = 'phpMussel – การกำหนดค่า';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – ตัวจัดการไฟล์';
$phpMussel['lang']['title_home'] = 'phpMussel – โฮมเพจ';
$phpMussel['lang']['title_login'] = 'phpMussel – เข้าสู่ระบบ';
$phpMussel['lang']['title_logs'] = 'phpMussel – บันทึก';
$phpMussel['lang']['title_updates'] = 'phpMussel – อัปเดต';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – ทดสอบการอัปโหลด';

$phpMussel['lang']['info_some_useful_links'] = 'ลิงก์ที่เป็นประโยชน์:<ul>
            <li><a href="https://github.com/Maikuolan/phpMussel/issues">phpMussel Issues @ GitHub</a> – หน้าปัญหาสำหรับ phpMussel (สนับสนุน, ความช่วยเหลือ, ฯลฯ).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – ฟอรั่มการอภิปรายสำหรับ phpMussel (สนับสนุน, ความช่วยเหลือ, ฯลฯ).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – สถานที่ดาวน์โหลดอื่นสำหรับ phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – คอลเลกชันเครื่องมือเว็บมาสเตอร์ง่ายสำหรับการรักษาความปลอดภัยเว็บไซต์.</li>
            <li><a href="http://www.clamav.net/">ClamavNet</a> – โฮมเพจ ClamAV (ClamAV® เป็นเครื่องมือป้องกันไวรัสแบบโอเพนซอร์สสำหรับการตรวจจับโทรจันไวรัสมัลแวร์และภัยคุกคามที่เป็นอันตรายอื่น).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – บริษัทรักษาความปลอดภัยคอมพิวเตอร์ที่เสนอลายเซ็นเสริมสำหรับ ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – ฐานข้อมูลฟิชชิ่งใช้โดยเครื่องสแกน URL phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">International PHP Group @ Facebook</a> – แหล่งเรียนรู้ PHP และการสนทนา.</li>
            <li><a href="https://wwphp-fb.github.io/">International PHP Group @ GitHub</a> – แหล่งเรียนรู้ PHP และการสนทนา.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal เป็นบริการฟรีสำหรับการวิเคราะห์ไฟล์และ URL ที่น่าสงสัย.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis เป็นบริการฟรีสำหรับการวิเคราะห์มัลแวร์ให้บริการโดย <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – ผู้เชี่ยวชาญด้านคอมพิวเตอร์ป้องกันมัลแวร์.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – ฟอรัมที่เป็นประโยชน์สำหรับการสนทนาเกี่ยวกับมัลแวร์.</li>
        </ul>';
