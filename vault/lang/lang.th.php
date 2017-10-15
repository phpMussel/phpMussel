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
 * This file: Thai language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'ฉันไม่เข้าใจคำสั่งนั้นขอโทษ.';
$phpMussel['lang']['cli_failed_to_complete'] = 'ไม่สามารถเสร็จสิ้นขั้นตอนการสแกน.';
$phpMussel['lang']['cli_is_not_a'] = ' ไม่ใช่ไฟล์หรือไดเรกทอรี.';
$phpMussel['lang']['cli_ln2'] = " ขอบคุณที่ใช้ phpMussel, สคริปต์ PHP ออกแบบมาเพื่อตรวจจับโทรจัน, ไวรัส,\n มัลแวร์, และภัยคุกคามอื่นภายในไฟล์ที่อัปโหลดไปยังระบบของคุณ,\n ที่ใดก็ตามที่สคริปต์ถูกตะขอ, ขึ้นอยู่กับลายเซ็นของ ClamAV และคนอื่น ๆ.\n\n PHPMUSSEL ลิขสิทธิ์ 2013 และอื่น GNU/GPLv2 โดย Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " กำลังรัน phpMussel ในโหมด CLI (ส่วนติดต่อบรรทัดคำสั่ง).\n\n เพื่อสแกนไฟล์หรือไดเรกทอรี, ป้อน scan, ตามด้วยชื่อของไฟล์หรือไดเรกทอรีที่\n คุณต้องการให้ phpMussel สแกนและกด Enter; ป้อน c และกด Enter สำหรับรายการคำสั่ง\n ในโหมด CLI; ป้อน q และกด Enter ที่จะเลิก:";
$phpMussel['lang']['cli_pe1'] = 'ไม่ใช่ไฟล์ PE ที่ถูกต้อง!';
$phpMussel['lang']['cli_pe2'] = 'ส่วน PE:';
$phpMussel['lang']['cli_signature_placeholder'] = 'ชื่อลายเซ็น';
$phpMussel['lang']['cli_working'] = 'กำลังดำเนินการ';
$phpMussel['lang']['corrupted'] = 'PE เสียหายถูกตรวจพบ';
$phpMussel['lang']['data_not_available'] = 'ไม่มีข้อมูล.';
$phpMussel['lang']['denied'] = 'อัปโหลดถูกปฏิเสธ!';
$phpMussel['lang']['denied_reason'] = 'การอัปโหลดของคุณถูกบล็อกด้วยเหตุผลด้านล่าง:';
$phpMussel['lang']['detected'] = 'ตรวจพบแล้ว {vn}';
$phpMussel['lang']['detected_control_characters'] = 'อักขระควบคุมถูกตรวจพบ';
$phpMussel['lang']['encrypted_archive'] = 'เก็บถาวรที่เข้ารหัสถูกตรวจพบ; เก็บถาวรที่เข้ารหัสไม่ได้รับอนุญาต';
$phpMussel['lang']['failed_to_access'] = 'ไม่สามารถเข้าถึง ';
$phpMussel['lang']['file'] = 'ไฟล์';
$phpMussel['lang']['filesize_limit_exceeded'] = 'จำกัดขนาดไฟล์เกินแล้ว';
$phpMussel['lang']['filetype_blacklisted'] = 'ประเภทไฟล์คือในรายการดำ';
$phpMussel['lang']['finished'] = 'เสร็จแล้ว';
$phpMussel['lang']['generated_by'] = 'สร้างขึ้นโดย';
$phpMussel['lang']['greylist_cleared'] = ' รายการเทาล้างแล้ว.';
$phpMussel['lang']['greylist_not_updated'] = ' รายการเทาไม่อัปเดตแล้ว.';
$phpMussel['lang']['greylist_updated'] = ' รายการเทาอัปเดตแล้ว.';
$phpMussel['lang']['image'] = 'ภาพ';
$phpMussel['lang']['instance_already_active'] = 'ตัวอย่างที่ใช้งานอยู่แล้ว! โปรดตรวจสอบตะขอของคุณอีกครั้ง.';
$phpMussel['lang']['invalid_data'] = 'ข้อมูลไม่ถูกต้อง!';
$phpMussel['lang']['invalid_file'] = 'ไฟล์ไม่ถูกต้อง';
$phpMussel['lang']['invalid_url'] = 'URL ไม่ถูกต้อง!';
$phpMussel['lang']['ok'] = 'ตกลง';
$phpMussel['lang']['only_allow_images'] = 'ไฟล์ที่ไม่ใช่ภาพไม่สามารถอัปโหลดได้';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'ไดเรกทอรีปลั๊กอินไม่มีอยู่!';
$phpMussel['lang']['quarantined_as'] = "เป็นกักกันที่ \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'จำกัดความลึกสำหรับการทับซ้ำเกินแล้ว';
$phpMussel['lang']['required_variables_not_defined'] = 'ตัวแปรที่จำเป็นไม่ได้กำหนดไว้: ไม่สามารถดำเนินการต่อได้.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL อาจเป็นอันตรายถูกตรวจพบ';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'ข้อผิดพลาดคำขอ API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'ข้อผิดพลาดอนุมัติ API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'ไม่สามารถให้บริการได้ API';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'ข้อผิดพลาดที่ไม่รู้จัก API';
$phpMussel['lang']['scan_aborted'] = 'สแกนยกเลิกการแล้ว!';
$phpMussel['lang']['scan_chameleon'] = 'กิ้งก่าโจมตี {x} ถูกตรวจพบ';
$phpMussel['lang']['scan_checking'] = 'การตรวจสอบ';
$phpMussel['lang']['scan_checking_contents'] = 'ความสำเร็จ! กำลังดำเนินการตรวจสอบเนื้อหา.';
$phpMussel['lang']['scan_command_injection'] = 'ความพยายามที่จะฉีดคำสั่งถูกตรวจพบ';
$phpMussel['lang']['scan_complete'] = 'เสร็จแล้ว';
$phpMussel['lang']['scan_extensions_missing'] = 'ล้มเหลว (ส่วนขยายที่จำเป็นหายไป)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'การปลอมแปลงชื่อไฟล์ถูกตรวจพบ';
$phpMussel['lang']['scan_missing_filename'] = 'ไม่มีชื่อไฟล์';
$phpMussel['lang']['scan_not_archive'] = 'ล้มเหลว (ว่างเปล่าหรือไม่ใช่ที่เก็บถาวร)!';
$phpMussel['lang']['scan_no_problems_found'] = 'ไม่พบปัญหาใด.';
$phpMussel['lang']['scan_reading'] = 'การอ่าน';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'ไฟล์ลายเซ็นเสียหาย';
$phpMussel['lang']['scan_signature_file_missing'] = 'ไฟล์ลายเซ็นหายไป';
$phpMussel['lang']['scan_tampering'] = 'การปลอมแปลงไฟล์ที่อาจเป็นอันตรายตรวจพบแล้ว';
$phpMussel['lang']['scan_unauthorised_upload'] = 'อัปโหลดไฟล์ที่ไม่ได้รับอนุญาตถูกตรวจพบ';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'อัปโหลดไฟล์ที่ไม่ได้รับอนุญาตหรือการกำหนดค่าที่ไม่ถูกต้องถูกตรวจพบ! ';
$phpMussel['lang']['started'] = 'เริ่มต้นแล้ว';
$phpMussel['lang']['too_many_urls'] = 'มี URL มากเกินไป';
$phpMussel['lang']['upload_error_1'] = 'ขนาดไฟล์เกินคำสั่ง upload_max_filesize. ';
$phpMussel['lang']['upload_error_2'] = 'ขนาดไฟล์เกินจำกัดขนาดไฟล์ที่ระบุโดยแบบฟอร์ม. ';
$phpMussel['lang']['upload_error_34'] = 'อัปโหลดล้มเหลว! โปรดติดต่อผู้ดูแลโฮสต์เพื่อขอความช่วยเหลือ! ';
$phpMussel['lang']['upload_error_6'] = 'อัปโหลดไดเรกทอรีหายแล้ว! โปรดติดต่อผู้ดูแลโฮสต์เพื่อขอความช่วยเหลือ! ';
$phpMussel['lang']['upload_error_7'] = 'ข้อผิดพลาดในการเขียนดิสก์! โปรดติดต่อผู้ดูแลโฮสต์เพื่อขอความช่วยเหลือ! ';
$phpMussel['lang']['upload_error_8'] = 'การกำหนดค่า PHP ที่ไม่ถูกต้องถูกตรวจพบ! โปรดติดต่อผู้ดูแลโฮสต์เพื่อขอความช่วยเหลือ! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'จำกัดการอัปโหลดเกินแล้วแล้ว';
$phpMussel['lang']['wrong_password'] = 'รหัสผ่านผิด; การกระทำถูกปฏิเสธ.';
$phpMussel['lang']['x_does_not_exist'] = 'ไม่ได้อยู่';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - ออกจาก CLI.
 - นามแฝง: quit, exit.
 md5_file
 - สร้างลายเซ็น MD5 จากไฟล์ [ไวยากรณ์: md5_file ชื่อไฟล์].
 - นามแฝง: m.
 sha1_file
 - สร้างลายเซ็น SHA1 จากไฟล์ [ไวยากรณ์: sha1_file ชื่อไฟล์].
 md5
 - สร้างลายเซ็น MD5 จากสตริง [ไวยากรณ์: md5 สตริง].
 sha1
 - สร้างลายเซ็น SHA1 จากสตริง [ไวยากรณ์: sha1 สตริง].
 hex_encode
 - แปลงสตริงไบนารีเป็นเลขฐานสิบหก [ไวยากรณ์: hex_encode สตริง].
 - นามแฝง: x.
 hex_decode
 - แปลงเลขฐานสิบหกเป็นสตริงไบนารี [ไวยากรณ์: hex_decode สตริง].
 base64_encode
 - แปลงสตริงไบนารีเป็นสตริง base64 [ไวยากรณ์: base64_encode สตริง].
 - นามแฝง: b.
 base64_decode
 - แปลงสตริง base64 เป็นสตริงไบนารี [ไวยากรณ์: base64_decode สตริง].
 pe_meta
 - ดึงข้อมูลเมตาดาต้าจากไฟล์ PE [ไวยากรณ์: pe_meta ชื่อไฟล์].
 url_sig
 - สร้างลายเซ็น URL สแกนเนอร์ [ไวยากรณ์: url_sig สตริง].
 scan
 - สแกนไฟล์หรือไดเรกทอรี [ไวยากรณ์: scan ชื่อไฟล์].
 - นามแฝง: s.
 c
 - พิมพ์รายการคำสั่งนี้.
";
