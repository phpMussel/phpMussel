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
 * This file: Thai language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">โฮมเพจ</a> | <a href="?phpmussel-page=logout">ออกจากระบบ</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">ออกจากระบบ</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'รู้จักส่วนขยายไฟล์ที่เก็บถาวร (รูปแบบเป็น CSV; ควรเพิ่มหรือลบเมื่อเกิดปัญหาขึ้นเท่านั้น; การลบโดยปราศจากเหตุผลอาจทำให้ false positive ปรากฏขึ้น. เพิ่มได้โดยไม่มีเหตุผลอาจป้องกันไม่ให้การป้องกันบางอย่างทำงานได้อย่างถูกต้อง; แก้ไขด้วยความระมัดระวัง; การสแกนระดับเนื้อหาไม่ได้รับผลกระทบ). รายการ, เป็นค่าเริ่มต้น, แสดงรูปแบบที่ใช้บ่อยที่สุดในระบบและ CMS ส่วนใหญ่, แต่ไม่รวมทุกอย่าง.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'บล็อกไฟล์ใด ๆ ที่มีอักขระควบคุมหรือไม่ (นอกเหนือจากบรรทัดใหม่)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) หากคุณกำลังอัปโหลดเฉพาะข้อความล้วน, จากนั้นคุณสามารถเปิดใช้งานตัวเลือกนี้ได้เพื่อให้การป้องกันเพิ่มเติมในระบบของคุณ. อย่างไรก็ตาม, หากคุณอัปโหลดรายการอื่น ๆ, การเปิดใช้งานอาจส่งผลให้เกิด false positive. False = อย่าปิดกั้น [ค่าเริ่มต้น]; True = ปิดกั้น.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'ค้นหาหัวเรื่องที่ปฏิบัติการได้ในไฟล์ที่ไม่ปฏิบัติการได้และในไฟล์ที่ไม่ได้เก็บถาวร, และค้นหาไฟล์ปฏิบัติการที่มีส่วนหัวไม่ถูกต้อง. False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'ค้นหาส่วนหัวของ PHP ในไฟล์ที่ไม่ใช่ไฟล์ PHP หรือที่เก็บถาวร. False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'ค้นหาที่เก็บที่มีส่วนหัวไม่ถูกต้อง (ได้รับการสนับสนุน: BZ, GZ, RAR, ZIP, RAR, GZ). False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'ค้นหาเอกสาร Office ที่มีส่วนหัวไม่ถูกต้อง (ได้รับการสนับสนุน: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'ค้นหาภาพที่มีส่วนหัวไม่ถูกต้อง (ได้รับการสนับสนุน: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'ค้นหาไฟล์ PDF ที่มีส่วนหัวไม่ถูกต้อง. False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'ไฟล์ที่เสียหายและข้อผิดพลาดในการประมวลผล. False = ไม่สนใจ; True = ปิดกั้น [ค่าเริ่มต้น]. ตรวจหาและปิดกั้นไฟล์ PE ที่เสียหายหรือไม่? บ่อยครั้ง (แต่ไม่เสมอไป), เมื่อส่วนของไฟล์ PE เสียหายหรือไม่สามารถอ่านได้, มันสามารถบ่งบอกถึงการติดเชื้อไวรัส. กระบวนการที่ใช้โดยโปรแกรมป้องกันไวรัสส่วนใหญ่สำหรับการตรวจจับไวรัสในไฟล์ PE, หากผู้เขียนไวรัสรู้, พวกเขาอาจพยายามหลีกเลี่ยง, เพื่อให้ไวรัสของพวกเขายังคงตรวจไม่พบ.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'ความยาวสูงสุดของข้อมูลดิบภายในที่ถอดรหัสคำสั่งควรถูกตรวจพบ (ในกรณีที่มีปัญหาเรื่องประสิทธิภาพการใช้งานที่เห็นได้ชัดขณะสแกน). ค่าเริ่มต้น = 512KB. ค่าเป็นศูนย์หรือค่า null จะปิดใช้งานขีด จำกัด (ลบข้อจำกัดที่ขึ้นกับขนาดไฟล์).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'ความยาวสูงสุดของข้อมูลดิบที่ phpMussel สามารถอ่านและสแกนได้ (ในกรณีที่มีปัญหาเรื่องประสิทธิภาพการใช้งานที่เห็นได้ชัดขณะสแกน). ค่าเริ่มต้น = 32MB. ค่าเป็นศูนย์หรือค่า null จะปิดใช้งานขีด จำกัด. โดยทั่วไป, นี้ไม่ควรน้อยกว่าค่าเฉลี่ยขนาดไฟล์ของการอัปโหลดที่คุณคาดว่าจะได้รับไปยังเซิร์ฟเวอร์หรือเว็บไซต์ของคุณ, ไม่ควรมากกว่าคำสั่ง filesize_limit, และไม่ควรเกินกว่าหนึ่งในห้าการจัดสรรหน่วยความจำทั้งหมดให้กับ PHP ผ่านไฟล์กำหนดค่า "php.ini". คำสั่งนี้มีอยู่เพื่อป้องกันไม่ให้ phpMussel ใช้หน่วยความจำมากเกินไป (การใช้หน่วยความจำมากเกินไปสามารถป้องกันไม่ให้ phpMussel สแกนไฟล์ทั้งหมด).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'โดยทั่วไป, คำสั่งนี้ควรถูกปิดใช้งานยกเว้นกรณีที่จำเป็นสำหรับฟังก์ชันการทำงานที่ถูกต้องของ phpMussel ในระบบเฉพาะของคุณ. โดยปกติ, เมื่อปิดใช้งาน, เมื่อ phpMussel ตรวจจับการปรากฏตัวของธาตุใน array() <code>$_FILES</code>, มันจะพยายามเพื่อสแกนไฟล์ที่องค์ประกอบเหล่านั้นเป็นตัวแทน, และ, หากองค์ประกอบเหล่านี้ว่างเปล่า, phpMussel จะแสดงข้อความแสดงข้อผิดพลาด. นี่เป็นพฤติกรรมที่เหมาะสมสำหรับ phpMussel. อย่างไรก็ตาม, สำหรับบาง CMS, องค์ประกอบว่างเปล่าใน <code>$_FILES</code> สามารถเกิดขึ้นเนื่องจากพฤติกรรมตามธรรมชาติของ CMS เหล่านี้, หรือข้อผิดพลาดอาจมีการรายงานเมื่อไม่มี, ในกรณีดังกล่าว, พฤติกรรมปกติของ phpMussel จะขัดขวางพฤติกรรมปกติของ CMS เหล่านี้. หากสถานการณ์ดังกล่าวเกิดขึ้นสำหรับคุณ, การเปิดใช้งานตัวเลือกนี้จะสั่งให้ phpMussel ไม่สแกนหาองค์ประกอบที่ว่างเปล่าเหล่านี้, ละเว้นเมื่อพบ, และไม่ส่งกลับข้อความผิดพลาดใด ๆ ที่เกี่ยวข้อง, จึงช่วยให้สามารถขอหน้าต่อไปได้. False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'ถ้าคุณคาดหวังหรือตั้งใจเท่านั้นเพื่ออนุญาตให้มีภาพสำหรับการอัปโหลดลงในระบบหรือ CMS ของคุณ, และถ้าคุณอย่างไม่จำเป็นต้องไฟล์ใด ๆ ที่ไม่ใช่ภาพจะถูกอัปโหลดไปยังระบบหรือ CMS ของคุณ, ควรเปิดใช้งานคำสั่งนี้, แต่ควรปิดใช้งานในกรณีอื่น ๆ. หากเปิดใช้งานคำสั่งนี้, จะสั่งให้ phpMussel ป้องกันการอัปโหลดใด ๆ โดยไม่เลือกปฏิบัติ, ที่เป็นระบุว่าไม่ใช่ไฟล์ภาพ, โดยไม่ต้องสแกน. ซึ่งอาจลดเวลาในการประมวลผลและการใช้หน่วยความจำสำหรับการอัปโหลดที่พยายามไฟล์ไม่ใช่ภาพ. False = ปิดใช้งาน; True = เปิดใช้งาน.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'ตรวจหาและบล็อกเก็บถาวรที่เข้ารหัสหรือไม่? เพราะ phpMussel ไม่สามารถสแกนได้เนื้อหาของเก็บถาวรที่เข้ารหัส, มันเป็นไปได้ที่เก็บถาวรที่เข้ารหัสอาจถูกใช้โดยผู้บุกรุกเป็นวิธีการพยายามหลีกเลี่ยง phpMussel, สแกนเนอร์ป้องกันไวรัส, และการคุ้มครองอื่น ๆ. สั่งให้ phpMussel บล็อกที่เก็บถาวรใด ๆ ที่ค้นพบถูกเข้ารหัสอาจช่วยได้ลดความเสี่ยงใด ๆ ที่เกี่ยวข้องกับความเป็นไปได้เหล่านี้. False = ไม่บล็อก; True = บล็อก [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_check_archives'] = 'พยายามตรวจสอบเนื้อหาของเก็บถาวรหรือไม่? False = ไม่ตรวจสอบ; True = ตรวจสอบ [ค่าเริ่มต้น]. ปัจจุบัน, รูปแบบสำหรับเก็บถาวรและการบีบอัดที่สนับสนุนเพียงคือ BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR และ ZIP (รูปแบบสำหรับเก็บถาวรและการบีบอัด RAR, CAB, 7z และอื่น, ปัจจุบันยังไม่ได้รับการสนับสนุน). นี้ไม่สมบูรณ์แบบ! ฉันขอแนะนำให้เปิดใช้งานนี้, แต่ฉันไม่สามารถรับประกันได้ที่มันมักจะพบทุกอย่าง. นอกจากนี้, โปรดทราบว่าการตรวจสอบเก็บถาวรปัจจุบันไม่ใช่ recursive สำหรับรูปแบบ PHAR หรือ ZIP.';
$phpMussel['lang']['config_files_filesize_archives'] = 'สืบทอดรายการดำ/รายการขาวสำหรับขนาดไฟล์ลงในเนื้อหาเก็บถาวรหรือไม่? False = ไม่สืบทอด (แค่รายการเทาทุกอย่าง); True = สืบทอด [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_filesize_limit'] = 'จำกัดของขนาดไฟล์ใน KB. 65536 = 64MB [ค่าเริ่มต้น]; 0 = ไม่มีขีดจำกัด (รายการเทาเสมอ), ค่าตัวเลขใด ๆ ที่เป็นบวกสามารถยอมรับได้. นี้จะมีประโยชน์เมื่อการกำหนดค่า PHP ของคุณจำกัดจำนวนหน่วยความจำที่กระบวนการสามารถครอบครองได้หรือหากการกำหนดค่า PHP ของคุณจำกัดขนาดไฟล์สำหรับอัปโหลด.';
$phpMussel['lang']['config_files_filesize_response'] = 'จะทำอย่างไรกับไฟล์ที่เกินขีดจำกัดของขนาดไฟล์ (ถ้ามีอยู่). False = รายการขาว; True = รายการดำ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_files_filetype_archives'] = 'สืบทอดรายการดำ/รายการขาวสำหรับประเภทไฟล์ลงในเนื้อหาเก็บถาวรหรือไม่? False = ไม่สืบทอด (แค่รายการเทาทุกอย่าง) [ค่าเริ่มต้น]; True = สืบทอด.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'รายการดำ:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'รายการเทา:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'หากระบบของคุณอนุญาตชนิดไฟล์ที่ระบุที่จะอัปโหลดเท่านั้น, หรือหากระบบของคุณปฏิเสธประเภทไฟล์บาง, ระบุพวกเขาในรายการขาว, รายการดำ, และรายการเทาสามารถเพิ่มความเร็วในการสแกนโดยการอนุญาตให้ใช้สคริปต์เพื่อข้ามไฟล์บาง. รูปแบบคือ CSV (ค่าที่คั่นด้วยเครื่องหมายจุลภาค). ถ้าคุณต้องการสแกนทุกอย่าง, แทนรายการขาว, รายการดำ, หรือรายการเทา, ปล่อยให้ตัวแปรว่างเปล่า; การทำเช่นนี้จะปิดใช้งานรายการขาว/รายการดำ/รายการเทา. ลำดับการประมวลผลคือ: หากไฟล์ประเภทนี้อยู่ในรายการขาว, ไม่สแกนและอย่าปิดกั้นไฟล์, และอย่าตรวจสอบไฟล์กับรายการดำหรือรายการเทา. หากไฟล์ประเภทนี้อยู่ในรายการดำ, ไม่สแกนไฟล์แต่บล็อกมันอย่างไรก็ตาม, และอย่าตรวจสอบไฟล์กับรายการเทา. ถ้ารายการเทาเป็นว่างเปล่าหรือถ้ารายการเทาไม่ว่างเปล่าและไฟล์ประเภทนี้อยู่ในรายการเทา, สแกนไฟล์ตามบรรทัดฐานและกำหนดว่าจะบล็อกหรือไม่ขึ้นอยู่กับผลการสแกน, แต่ถ้ารายการเทาไม่ว่างเปล่าและไฟล์ประเภทนี้ไม่อยู่ในรายการเทา, ถือว่าไฟล์เป็นอยู่ในรายการดำ, ดังนั้นไม่สแกนมันแต่บล็อกไว้อย่างไรก็ตาม. รายการขาว:';
$phpMussel['lang']['config_files_max_recursion'] = 'ความลึกสูงสุดของการเรียกซ้ำสำหรับเก็บถาวร. ค่าเริ่มต้น = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'จำนวนไฟล์สูงสุดที่อนุญาตเพื่อสแกนระหว่างการอัปโหลดไฟล์ก่อนที่จะยกเลิกการสแกนและแจ้งผู้ใช้ที่พวกเขากำลังอัปโหลดมากเกินไปในครั้งเดียว! ให้การป้องกันการโจมตีทางทฤษฎีโดยผู้บุกรุกพยายามที่จะ DDoS ระบบหรือ CMS ของคุณโดยใช้ phpMussel ที่มากเกินไปเพื่อชะลอกระบวนการ PHP เพื่อหยุดที่สมบูรณ์. แนะนำ: 10. คุณอาจต้องการเพิ่มหรือลดจำนวนนี้ขึ้นอยู่กับความเร็วของฮาร์ดแวร์ของคุณ. โปรดทราบว่าหมายเลขนี้ไม่ได้ระบุไว้หรือรวมเนื้อหาของที่เก็บถาวร.';
$phpMussel['lang']['config_general_cleanup'] = 'ทำลายตัวแปรและแคชใช้โดยสคริปต์หลังจากสแกนไฟล์หรือไม่? False = อย่าทำลาย; True = ทำลาย [ค่าเริ่มต้น]. หากคุณไม่ได้ใช้สคริปต์สำหรับเพื่อวัตถุประสงค์อื่น, คุณควรตั้งค่านี้เป็น <code>true</code>, เพื่อลดการใช้หน่วยความจำ. มิฉะนั้น, ถ้าคุณใช้มันสำหรับวัตถุประสงค์อื่น, คุณควรตั้งค่านี้เป็น <code>false</code>, เพื่อหลีกเลี่ยงการโหลดข้อมูลที่ซ้ำกันลงในหน่วยความจำโดยไม่จำเป็น. ในทางปฏิบัติทั่วไป, ควรตั้งค่าเป็น <code>true</code>, แต่ถ้าคุณทำเช่นนี้, คุณจะไม่สามารถใช้สคริปต์เพื่อวัตถุประสงค์นอกเหนือจากนี้การสแกนอัปโหลดไฟล์. ไม่มีอิทธิพลในโหมด CLI.';
$phpMussel['lang']['config_general_default_algo'] = 'กำหนดว่าจะใช้อัลกอริทึมใดสำหรับรหัสผ่านและเซสชันในอนาคต. ตัวเลือก: PASSWORD_DEFAULT (ค่าเริ่มต้น), PASSWORD_BCRYPT, PASSWORD_ARGON2I (ต้องการ PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'การเปิดใช้คำสั่งนี้จะบอกสคริปต์เพื่อพยายามลบอัปโหลดไฟล์ใด ๆ ที่สแกนแล้วทันทีที่จับคู่เกณฑ์การตรวจสอบใด, ไม่ว่าจะผ่านลายเซ็นหรืออื่น ๆ. ไฟล์ที่ถือว่า "สะอาด" จะไม่ได้รับการสัมผัส. ในกรณีที่เก็บถาวร, ที่เก็บถาวรทั้งหมดจะถูกลบ, ไม่ว่าจะเป็นหรือไม่ก็ตามไฟล์ที่กระทำผิดเป็นเพียงหนึ่งในหลายไฟล์มีอยู่ในเก็บถาวร. สำหรับกรณีของการสแกนอัปโหลดไฟล์, ปกติ, ไม่จำเป็นต้องใช้คำสั่งนี้, เพราะปกติ, PHP จะล้างเนื้อหาของแคชโดยอัตโนมัติเมื่อดำเนินการเสร็จสิ้น, หมายความว่ามักจะลบไฟล์ใด ๆ ที่อัปโหลดผ่านของมันไปยังเซิร์ฟเวอร์จนกว่าพวกเขาจะถูกย้าย, คัดลอกหรือลบแล้ว. คำสั่งนี้ถูกเพิ่มที่นี่เป็นมาตรการพิเศษในการรักษาความปลอดภัยสำหรับผู้ที่มีสำเนาของ PHP ที่อาจไม่ทำงานในลักษณะที่คาดหมายเสมอ. False = หลังการสแกน, ออกจากไฟล์เพียงอย่างเดียว [ค่าเริ่มต้น]; True = หลังการสแกน, ถ้าไม่สะอาด, ลบทันที.';
$phpMussel['lang']['config_general_disable_cli'] = 'ปิดใช้งานโหมด CLI หรือไม่? โหมด CLI ถูกเปิดใช้งานตามค่าเริ่มต้น, แต่บางครั้งอาจรบกวนการทำงานของเครื่องมือทดสอบบางอย่าง (เช่น PHPUnit) และแอพพลิเคชั่น CLI อื่น ๆ. ถ้าคุณไม่จำเป็นต้องปิดใช้งานโหมด CLI คุณควรละเว้นคำสั่งนี้. False = เปิดใช้งานโหมด CLI [ค่าเริ่มต้น]; True = ปิดใช้งานโหมด CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'ปิดใช้งานการเข้าถึง front-end หรือไม่? การเข้าถึง front-end ทำให้ phpMussel สามารถจัดการได้ดีขึ้น แต่ก็อาจเป็นความเสี่ยงด้านความปลอดภัยที่อาจเกิดขึ้นด้วย. ขอแนะนำให้จัดการ phpMussel ผ่านทางแบ็คเอนด์เมื่อใดก็ตามที่เป็นไปได้ แต่จะมีการเข้าถึง front-end เมื่อไม่สามารถทำได้. โปรดปิดใช้งานหากคุณไม่ต้องการ. False = เปิดใช้งานการเข้าถึง front-end; True = ปิดการใช้งานการเข้าถึง front-end [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'หยุดใช้ webfonts หรือไม่? True = หยุดใช้; False = ไม่หยุดใช้ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_enable_plugins'] = 'เปิดใช้งานการสนับสนุนปลั๊กอิน phpMussel หรือไม่? False = ไม่เปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'ควร phpMussel ส่งส่วนหัว 403 มีข้อความเกี่ยวกับอัปโหลดไฟล์ที่ถูกบล็อก, หรือเก็บไว้กับปกติ 200 OK? False = ส่ง 200; True = ส่ง 403 [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'ไฟล์สำหรับบันทึกพยายามเข้าสู่ระบบที่ front-end. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'เมื่อเปิดใช้งานโหมด honeypot, phpMussel จะพยายามกักกันการอัปโหลดไฟล์ทั้งหมดที่มันเจอ, ไม่ว่าจะเป็นหรือไม่ก็ตามไฟล์ตรงกับลายเซ็นที่รวมอยู่, และทั้งการสแกนและการวิเคราะห์สำหรับไฟล์เหล่านี้จะไม่เกิดขึ้นจริง. ฟังก์ชันนี้ควรมีประโยชน์สำหรับผู้ที่ต้องการใช้ phpMussel เพื่อวัตถุประสงค์ในการวิจัยไวรัส/มัลแวร์, แต่ไม่แนะนำเพื่อให้สามารถใช้งานฟังก์ชันนี้ได้ถ้าใช้ของ phpMussel ตั้งใจโดยผู้ใช้สำหรับการอัปโหลดไฟล์จริง, และไม่แนะนำสำหรับวัตถุประสงค์ที่ไม่เกี่ยวข้องกับฟังก์ชันการทำงานของ honeypot. โดยค่าเริ่มต้น, ตัวเลือกนี้ถูกปิดใช้งาน. False = เปิดใช้งาน [ค่าเริ่มต้น]; True = เปิดใช้งาน.';
$phpMussel['lang']['config_general_ipaddr'] = 'ตำแหน่งของที่อยู่ IP สำหรับคำขอการเชื่อมต่อ (เป็นประโยชน์สำหรับบริการเช่น Cloudflare, ฯลฯ). ค่าเริ่มต้น = REMOTE_ADDR. คำเตือน: อย่าเปลี่ยนสิ่งนี้จนกว่าคุณจะรู้ว่าคุณกำลังทำอะไร!';
$phpMussel['lang']['config_general_lang'] = 'ระบุภาษาค่าเริ่มต้นสำหรับ phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'เปิดใช้โหมดการบำรุงรักษาหรือไม่? True = เปิดใช้งานได้; False = ไม่เปิดใช้งาน [ค่าเริ่มต้น]. ปิดใช้งานทุกอย่างอื่นที่ไม่ใช่ front-end. บางครั้งมีประโยชน์สำหรับการอัปเดต CMS, framework, ฯลฯ.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'จำนวนสูงสุดความพยายามเข้าสู่ระบบ.';
$phpMussel['lang']['config_general_numbers'] = 'คุณต้องการตัวเลขที่จะแสดงอย่างไร? เลือกตัวอย่างที่ดูเหมือนถูกต้องที่สุด.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel สามารถกักกันไฟล์ที่ระบุได้ในการแยกภายใน vault ของ phpMussel, ถ้าคุณต้องการทำเช่นนี้. ผู้ใช้ที่ต้องการปกป้องเว็บไซต์หรือโฮสต์สภาพแวดล้อมของตนเท่านั้นไม่มีดอกเบี้ยในวิเคราะห์การอัปโหลดไฟล์อย่างละเอียดควรปล่อยให้ฟังก์ชันนี้ถูกปิดใช้งาน, แต่ผู้ใช้ใด ๆ ที่มีความสนใจเช่นกันควรเปิดใช้งานฟังก์ชันนี้. การกักกันของอัปโหลดไฟล์อาจช่วยในแก้จุดบกพร่อง false positive, ถ้านี่คือสิ่งที่เกิดขึ้นบ่อยๆสำหรับคุณ. ในการปิดใช้งานฟังก์ชันกักกัน, เพียงแค่ปล่อยให้คำสั่ง <code>quarantine_key</code> ว่างเปล่า, หรือลบเนื้อหาหากยังไม่ว่าง. เมื่อต้องการเปิดใช้งานฟังก์ชันกักกัน, ใส่ค่าลงในคำสั่ง. <code>quarantine_key</code> เป็นคุณลักษณะด้านความปลอดภัยที่สำคัญสำหรับฟังก์ชันการกักกันจำเป็นต้องใช้เพื่อป้องกันฟังก์ชันการกักกันจากถูกใช้ประโยชน์โดยผู้บุกรุกที่อาจเกิดขึ้นและเป็นวิธีการในการป้องกันการดำเนินการข้อมูลที่เก็บไว้ภายในเขตกักกัน. <code>quarantine_key</code> ควรได้รับการปฏิบัติเช่นเดียวกับรหัสผ่านของคุณ: อีกต่อไปจะดีกว่า, และระมัดระวังอย่างระมัดระวัง. เพื่อให้ได้ผลดีที่สุด, ใช้ร่วมกับ <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'ขนาดไฟล์สูงสุดที่อนุญาตสำหรับไฟล์ที่ถูกกักกัน. ไฟล์มีขนาดใหญ่กว่าค่าที่ระบุจะไม่ถูกกักกัน. คำสั่งนี้มีความสำคัญเป็นวิธีการทำให้ยากขึ้นสำหรับผู้บุกรุกที่อาจเกิดขึ้นจากน้ำท่วมกักกันของคุณด้วยข้อมูลที่ไม่พึงประสงค์ที่อาจทำให้เกิดการใช้ข้อมูลส่วนเกินเกี่ยวกับบริการพื้นที่ของคุณ. ค่าเริ่มต้น = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'ใช้หน่วยความจำสูงสุดสำหรับกักกัน. หากหน่วยความจำทั้งหมดใช้โดยกักกันถึงค่านี้, ไฟล์กักกันที่เก่าแก่ที่สุดจะถูกลบออกจนการใช้หน่วยความจำทั้งหมดไม่ถึงค่านี้อีกต่อไป. คำสั่งนี้มีความสำคัญเป็นวิธีการทำให้ยากขึ้นสำหรับผู้บุกรุกที่อาจเกิดขึ้นจากน้ำท่วมกักกันของคุณด้วยข้อมูลที่ไม่พึงประสงค์ที่อาจทำให้เกิดการใช้ข้อมูลส่วนเกินเกี่ยวกับบริการพื้นที่ของคุณ. ค่าเริ่มต้น = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'เวลาเท่าไรควร phpMussel แคชผลการสแกน? ค่าคือจำนวนวินาทีที่จะแคชผลการสแกน. ค่าเริ่มต้นคือ 21600 วินาที (6 ชั่วโมง); ค่า 0 จะปิดใช้งานแคชของผลการสแกน.';
$phpMussel['lang']['config_general_scan_kills'] = 'ชื่อไฟล์สำหรับบันทึกข้อมูลทั้งหมดสำหรับอัปโหลดที่ถูกบล็อกหรือถูกฆ่า. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_scan_log'] = 'ชื่อไฟล์สำหรับบันทึกผลการสแกนทั้งหมด. ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'ชื่อไฟล์สำหรับบันทึกผลการสแกนทั้งหมด (ใช้รูปแบบ serialized). ระบุชื่อไฟล์หรือเว้นว่างไว้เพื่อปิดใช้งาน.';
$phpMussel['lang']['config_general_statistics'] = 'ติดตามสถิติการใช้งาน phpMussel? True = ติดตาม; False = ไม่ติดตาม [ค่าเริ่มต้น].';
$phpMussel['lang']['config_general_timeFormat'] = 'รูปแบบสัญกรณ์สำหรับวันและเวลาใช้โดย phpMussel. ตัวเลือกเพิ่มเติมอาจเพิ่มเมื่อมีการร้องขอ.';
$phpMussel['lang']['config_general_timeOffset'] = 'เขตเวลาชดเชยในนาที.';
$phpMussel['lang']['config_general_timezone'] = 'โซนเวลาของคุณ.';
$phpMussel['lang']['config_general_truncate'] = 'ตัดทอนแฟ้มบันทึกเมื่อถึงขนาดที่กำหนดหรือไม่? ค่ามีขนาดสูงสุดในรูปแบบ B/KB/MB/GB/TB ที่แฟ้มบันทึกอาจโตขึ้นก่อนที่จะถูกตัดทอน. ค่าเริ่มต้นของ 0KB ปิดการตัดทอน (แฟ้มบันทึกสามารถเติบโตไปเรื่อย). หมายเหตุ: ถูกใช้ด้วยกับล็อกไฟล์แต่ละไฟล์! ขนาดของไฟล์บันทึกไม่ถือเป็นการรวมกัน.';
$phpMussel['lang']['config_heuristic_threshold'] = 'ลายเซ็น phpMussel บางตัวมีจุดมุ่งหมายเพื่อระบุลักษณะที่น่าสงสัยและอาจเป็นอันตรายในไฟล์ที่อัปโหลดไม่มีในตัวเองระบุไฟล์ที่อัปโหลดโดยเฉพาะอย่างยิ่งที่เป็นอันตราย. ค่านี้ "threshold" บอก phpMussel น้ำหนักรวมสูงสุดสำหรับคุณภาพที่น่าสงสัยและอาจเป็นอันตรายสำหรับไฟล์ที่อัปโหลดก่อนที่จะถูกระบุว่าเป็นอันตราย. ความหมายของน้ำหนักในบริบทนี้คือจำนวนรวมของคุณลักษณะที่น่าสงสัยและอาจเป็นอันตรายที่ระบุ. โดยค่าเริ่มต้น, ค่านี้จะถูกกำหนดเป็น 3. โดยทั่วไป, ค่าที่ต่ำกว่าจะส่งผลให้เกิดขึ้นมากขึ้น false positive แต่มีการระบุไฟล์ที่เป็นอันตรายจำนวนมากขึ้น, ในขณะที่ค่าที่สูงขึ้นโดยทั่วไปจะทำให้เกิดเหตุการณ์ที่ต่ำลงของ false positive แต่เป็นตัวเลขที่ต่ำกว่าของไฟล์ที่เป็นอันตรายถูกระบุ. เป็นการดีที่สุดที่จะปล่อยให้ค่านี้เป็นค่าเริ่มต้นจนกว่าคุณจะประสบปัญหา.';
$phpMussel['lang']['config_signatures_Active'] = 'รายการไฟล์ลายเซ็นที่ใช้งานอยู่, คั่นด้วยเครื่องหมายจุลภาค.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับแอดแวร์หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นเพื่อตรวจหา defacements และ defacers หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'ควร phpMussel ตรวจพบและบล็อกไฟล์ที่เข้ารหัสลับโดยหรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับการตรวจจับมัลแวร์และไวรัสที่ตหลอกลวงหรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับเครื่องบรรจุหีบห่อและข้อมูลที่บรรจุหรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับตรวจจับ PUA/PUP หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'ควร phpMussel แยกวิเคราะห์ลายเซ็นสำหรับการตรวจจับสคริปต์เชลล์หรือไม่? False = ไม่แยกวิเคราะห์; True = แยกวิเคราะห์ [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'ควร phpMussel รายงานเมื่อไม่มีส่วนขยายหรือไม่? ถ้า <code>fail_extensions_silently</code> ถูกปิดใช้งาน, ส่วนขยายที่ขาดหายไปจะมีการรายงานเมื่อทำการสแกน, และถ้า <code>fail_extensions_silently</code> เปิดใช้งาน, ส่วนขยายที่ขาดหายไปจะถูกละเลย, และจะมีรายงานว่าไม่มีปัญหา. การปิดใช้งานคำสั่งนี้อาจเพิ่มความปลอดภัยของคุณ, แต่ยังอาจนำไปสู่การเพิ่มขึ้น false positive. False = เปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'ควร phpMussel รายงานเมื่อไฟล์ลายเซ็นสูญหายหรือเสียหายหรือไม่? ถ้า <code>fail_silently</code> ถูกปิดใช้งาน, ไฟล์ที่ขาดหายไปและเสียหายจะรายงานเมื่อทำการสแกน, และถ้า <code>fail_silently</code> เปิดใช้งาน, ไฟล์ที่ขาดหายไปและเสียหายจะถูกละเลย, และจะมีรายงานว่าไม่มีปัญหา. โดยทั่วไปแล้วควรทิ้งไว้ตามลำพังจนกว่าคุณจะประสบปัญหา. False = ปิดใช้งาน; True = เปิดใช้งาน [ค่าเริ่มต้น].';
$phpMussel['lang']['config_template_data_css_url'] = 'ไฟล์เทมเพลตสำหรับธีมที่กำหนดเองใช้คุณสมบัติ CSS ภายนอก, ขณะที่ไฟล์เทมเพลตสำหรับธีมเริ่มต้นใช้คุณสมบัติ CSS ภายใน. เพื่อที่จะบอก phpMussel ใช้ไฟล์เทมเพลตสำหรับธีมที่กำหนดเอง, ระบุที่อยู่ HTTP สาธารณะของไฟล์ CSS ของธีมที่กำหนดเองโดยใช้ตัวแปร <code>css_url</code>. หากปล่อยตัวแปรนี้ไว้ว่าง, phpMussel จะใช้ไฟล์เทมเพลตสำหรับธีมเริ่มต้น.';
$phpMussel['lang']['config_template_data_Magnification'] = 'การขยายตัวอักษร. ค่าเริ่มต้น = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'ธีมเริ่มต้นที่จะใช้สำหรับ phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'จำนวนวินาทีที่จะแคชผลลัพธ์สำหรับการค้นหา API. ค่าเริ่มต้นคือ 3600 วินาที (1 ชั่วโมง).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'เปิดใช้งานการค้นหา API สำหรับ Google Safe Browsing API เมื่อมีการกำหนดคีย์ API ที่จำเป็นไว้.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'เปิดใช้งานการค้นหา API สำหรับ hpHosts API เมื่อตั้งค่าเป็น true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'จำนวนที่อนุญาตสูงสุดของการค้นหา API ทำต่อการทำซ้ำของการสแกนแต่ละครั้ง. เพราะการค้นหา API แต่ละครั้งจะเพิ่มเวลารวมที่ต้องการเพื่อทำซ้ำการสแกนแต่ละครั้ง, คุณอาจต้องการกำหนดข้อจำกัดเพื่อเร่งกระบวนการสแกนโดยรวม.เมื่อตั้งค่าเป็น 0, ไม่มีจำนวนที่อนุญาตสูงสุดดังกล่าวจะถูกนำมาใช้. ตั้งค่าเป็น 10 โดยค่าเริ่มต้น.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'จะทำอย่างไรถ้าจำนวนที่อนุญาตสูงสุดของการค้นหา API คือเกิน? False = ไม่ทำอะไร (ดำเนินการต่อ) [ค่าเริ่มต้น]; True = หยุดไฟล์.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'ถ้าคุณต้องการ, phpMussel สามารถสแกนไฟล์โดยใช้ Virus Total API เป็นวิธีการเพิ่มระดับการป้องกันไวรัส, โทรจัน, มัลแวร์, และภัยคุกคามอื่น ๆ. โดยค่าเริ่มต้น, การสแกนไฟล์ด้วย Virus Total API จะถูกปิดใช้งาน. ในการเปิดใช้งาน, จำเป็นต้องมีคีย์ API จาก Virus Total. เนื่องจากข้อดีที่สำคัญที่จะช่วยให้คุณได้, ฉันขอแนะนำให้เปิดใช้งานนี้. โปรดทราบว่า, เพื่อใช้ API Virus Total, คุณ<em><strong>ต้อง</strong></em>ยอมรับข้อกำหนดในการให้บริการและคุณ<em><strong>ต้อง</strong></em> ปฏิบัติตามหลักเกณฑ์ทั้งหมดที่อธิบายไว้ในเอกสารประกอบ! คุณไม่ได้รับอนุญาตให้ใช้คุณลักษณะนี้เว้นแต่: คุณได้อ่านและยอมรับข้อกำหนดในการให้บริการแล้วของ Virus Total และ API. คุณได้อ่านและเข้าใจแล้ว, อย่างน้อยที่สุด, คำนำของเอกสารของ Virus Total Public API (ทุกอย่างหลังจาก "VirusTotal Public API v2.0" แต่ก่อน "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'ตามเอกสารคู่มือ Virus Total API, มันคือจำกัด 4 คำขอของชนิดใดในกรอบเวลาใด 1 นาที. ถ้าคุณเรียกใช้ honeyclient, honeypot, หรือระบบอัตโนมัติอื่นที่จะให้ทรัพยากรสำหรับ VirusTotal และไม่เพียงแต่เรียกรายงานคุณมีสิทธิ์ได้รับโควต้าอัตราการร้องขอที่สูงขึ้น. โดยค่าเริ่มต้น, phpMussel จะปฏิบัติตามข้อจำกัดเหล่านี้อย่างเคร่งครัด, แต่เนื่องจากความเป็นไปได้ของโควต้าอัตราเหล่านี้เพิ่มขึ้น, ทั้งสองข้อนี้มีให้คุณสามารถสั่งสอน phpMussel เป็นสิ่งที่จำกัดที่ควรปฏิบัติตาม. ยกเว้นกรณีที่คุณได้รับคำสั่งให้ทำเช่นนั้น, มันไม่แนะนำสำหรับคุณเพื่อเพิ่มค่าเหล่านี้, แต่, ถ้าคุณพบปัญหาเกี่ยวกับการเข้าถึงโควต้าอัตรา, ลดค่าเหล่านี้<em><strong>อาจ</strong></em>บางครั้งช่วยให้คุณในการจัดการกับปัญหาเหล่านี้. ขีดจำกัดอัตราของคุณถูกกำหนดเป็น <code>vt_quota_rate</code> คำขอของชนิดใดในกรอบเวลาใด <code>vt_quota_time</code> นาที.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(ดูรายละเอียดข้างต้น).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'โดยค่าเริ่มต้น, phpMussel จะ จำกัดไฟล์ที่จะสแกนโดยใช้ Virus Total API ไปไฟล์เหล่านั้นที่ถือว่า "น่าสงสัย". คุณสามารถเลือกปรับข้อ จำกัด นี้ได้โดยการเปลี่ยนค่าของคำสั่ง <code>vt_suspicion_level</code>.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'ควร phpMussel ตีความผลการสแกนใช้ Virus Total API เป็นการตรวจจับหรือเป็นน้ำหนักการตรวจจับ? คำสั่งนี้มีอยู่, เพราะ, แม้ว่าการสแกนไฟล์ด้วยใช้เครื่องยนต์หลาย (ตามวิธี Virus Total ทำ) ควรผลในอัตราการตรวจจับเพิ่มขึ้น(และดังนั้นจึงในจำนวนที่สูงขึ้นของไฟล์ที่เป็นอันตรายถูกจับ), มันยังสามารถส่งผลให้มากกว่า false positive, และดังนั้นจึง, ในบางสถานการณ์, ผลการสแกนอาจใช้ประโยชน์ได้ดีกว่าเป็นคะแนนความเชื่อมั่นแทนที่จะเป็นข้อสรุปที่ชัดเจน. ถ้าใช้ค่าเป็น 0, ผลการสแกนจาก Virus Total API จะถูกใช้เป็นการตรวจจับ, และดังนั้นจึง, หากเครื่องมือใดใช้โดย Virus Total ระบุไฟล์ที่กำลังสแกนเป็นอันตราย, phpMussel จะพิจารณาว่าไฟล์เป็นอันตราย. หากใช้ค่าอื่น, ผลการสแกนจาก Virus Total API จะถูกใช้เป็นน้ำหนักการตรวจจับ, และดังนั้นจึง, จำนวนเครื่องที่ใช้โดย Virus Total ที่ระบุไฟล์ที่ถูกสแกนว่าเป็นอันตรายจะทำหน้าที่เป็นคะแนนความเชื่อมั่น (หรือน้ำหนักการตรวจจับ) สำหรับหรือไม่ไฟล์ที่ถูกสแกนควรได้รับการพิจารณาว่าเป็นอันตรายโดย phpMussel (ค่าที่ใช้จะแสดงคะแนนความเชื่อมั่นต่ำสุดหรือน้ำหนักการตรวจจับเพื่อที่จะได้รับการพิจารณาที่เป็นอันตราย). ค่าเริ่มต้นจะถูกใช้เป็นค่าเริ่มต้น 0.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'แพคเกจหลัก (ไม่รวมลายเซ็น, เอกสาร, และการกำหนดค่า).';
$phpMussel['lang']['field_activate'] = 'เปิดใช้งาน';
$phpMussel['lang']['field_clear_all'] = 'ล้างทั้งหมด';
$phpMussel['lang']['field_component'] = 'คอมโพเนนต์';
$phpMussel['lang']['field_create_new_account'] = 'สร้างบัญชีใหม่';
$phpMussel['lang']['field_deactivate'] = 'ปิดใช้งาน';
$phpMussel['lang']['field_delete_account'] = 'ลบบัญชี';
$phpMussel['lang']['field_delete_all'] = 'ลบทั้งหมด';
$phpMussel['lang']['field_delete_file'] = 'ลบ';
$phpMussel['lang']['field_download_file'] = 'ดาวน์โหลด';
$phpMussel['lang']['field_edit_file'] = 'เปลี่ยนแปลง';
$phpMussel['lang']['field_false'] = 'False (เท็จ)';
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
$phpMussel['lang']['field_quarantine_key'] = 'คีย์กักกัน';
$phpMussel['lang']['field_rename_file'] = 'เปลี่ยนชื่อ';
$phpMussel['lang']['field_reset'] = 'รีเซ็ต';
$phpMussel['lang']['field_restore_file'] = 'ฟื้นฟู';
$phpMussel['lang']['field_set_new_password'] = 'ตั้งรหัสผ่านใหม่';
$phpMussel['lang']['field_size'] = 'ขนาดรวม: ';
$phpMussel['lang']['field_size_bytes'] = 'ไบต์';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'สถานะ';
$phpMussel['lang']['field_system_timezone'] = 'ใช้เขตเวลาเริ่มต้นของระบบ.';
$phpMussel['lang']['field_true'] = 'True (จริง)';
$phpMussel['lang']['field_uninstall'] = 'ถอนการติดตั้ง';
$phpMussel['lang']['field_update'] = 'อัปเดต';
$phpMussel['lang']['field_update_all'] = 'อัพเดททั้งสิ้น';
$phpMussel['lang']['field_upload_file'] = 'อัปโหลดไฟล์ใหม่';
$phpMussel['lang']['field_username'] = 'ชื่อผู้ใช้';
$phpMussel['lang']['field_your_version'] = 'เวอร์ชั่นของคุณ';
$phpMussel['lang']['header_login'] = 'เข้าสู่ระบบเพื่อดำเนินการต่อ.';
$phpMussel['lang']['label_active_config_file'] = 'ไฟล์การกำหนดค่าที่ใช้งานอยู่: ';
$phpMussel['lang']['label_blocked'] = 'อัปโหลดถูกบล็อก';
$phpMussel['lang']['label_branch'] = 'สาขาเสถียรล่าสุด:';
$phpMussel['lang']['label_events'] = 'สแกนเหตุการณ์';
$phpMussel['lang']['label_flagged'] = 'วัตถุที่ถูกตั้งค่าสถานะ';
$phpMussel['lang']['label_fmgr_cache_data'] = 'ข้อมูลแคชและไฟล์ชั่วคราว';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'เนื้อที่ดิสก์ที่ phpMussel ใช้: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'พื้นที่ว่างในดิสก์: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'เนื้อที่ดิสก์ที่ใช้ทั้งหมด: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'เนื้อที่ดิสก์ทั้งหมด: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'เมตาดาต้าสำหรับอัพเดตคอมโพเนนต์';
$phpMussel['lang']['label_hide'] = 'ปิดบัง';
$phpMussel['lang']['label_os'] = 'ระบบปฏิบัติการในการใช้งาน:';
$phpMussel['lang']['label_other'] = 'อื่น ๆ';
$phpMussel['lang']['label_other-Active'] = 'ไฟล์ลายเซ็นที่ใช้งานอยู่';
$phpMussel['lang']['label_other-Since'] = 'วันที่เริ่มต้น';
$phpMussel['lang']['label_php'] = 'รุ่น PHP ในการใช้งาน:';
$phpMussel['lang']['label_phpmussel'] = 'รุ่น phpMussel ในการใช้งาน:';
$phpMussel['lang']['label_quarantined'] = 'อัปโหลดกักเก็บ';
$phpMussel['lang']['label_sapi'] = 'SAPI ในการใช้งาน:';
$phpMussel['lang']['label_scanned_objects'] = 'วัตถุถูกสแกน';
$phpMussel['lang']['label_scanned_uploads'] = 'อัปโหลดถูกสแกน';
$phpMussel['lang']['label_show'] = 'แสดง';
$phpMussel['lang']['label_size_in_quarantine'] = 'ขนาดในกักกัน: ';
$phpMussel['lang']['label_stable'] = 'เสถียรล่าสุด:';
$phpMussel['lang']['label_sysinfo'] = 'ข้อมูลระบบ:';
$phpMussel['lang']['label_tests'] = 'การทดสอบ:';
$phpMussel['lang']['label_unstable'] = 'ไม่เสถียรล่าสุด:';
$phpMussel['lang']['label_upload_date'] = 'อัปโหลดวันที่: ';
$phpMussel['lang']['label_upload_hash'] = 'อัปโหลดแฮช: ';
$phpMussel['lang']['label_upload_origin'] = 'อัปโหลดที่มา: ';
$phpMussel['lang']['label_upload_size'] = 'อัปโหลดขนาด: ';
$phpMussel['lang']['link_accounts'] = 'บัญชี';
$phpMussel['lang']['link_config'] = 'การกำหนดค่า';
$phpMussel['lang']['link_documentation'] = 'เอกสาร';
$phpMussel['lang']['link_file_manager'] = 'ตัวจัดการไฟล์';
$phpMussel['lang']['link_home'] = 'โฮมเพจ';
$phpMussel['lang']['link_logs'] = 'บันทึก';
$phpMussel['lang']['link_quarantine'] = 'กักกัน';
$phpMussel['lang']['link_statistics'] = 'สถิติ';
$phpMussel['lang']['link_textmode'] = 'การจัดรูปแบบข้อความ: <a href="%1$sfalse">ง่าย</a> – <a href="%1$strue">แฟนซี</a>';
$phpMussel['lang']['link_updates'] = 'อัปเดต';
$phpMussel['lang']['link_upload_test'] = 'ทดสอบการอัปโหลด';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'ไฟล์บันทึกเลือกไม่มีอยู่จริง!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'ไม่มีไฟล์บันทึกใช้ได้.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'ไม่มีไฟล์บันทึกเลือก.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'จำนวนสูงสุดความพยายามเข้าสู่ระบบเกิน; ปฏิเสธการเข้าใช้.';
$phpMussel['lang']['previewer_days'] = 'วัน';
$phpMussel['lang']['previewer_hours'] = 'ชั่วโมง';
$phpMussel['lang']['previewer_minutes'] = 'นาที';
$phpMussel['lang']['previewer_months'] = 'เดือน';
$phpMussel['lang']['previewer_seconds'] = 'วินาที';
$phpMussel['lang']['previewer_weeks'] = 'สัปดาห์';
$phpMussel['lang']['previewer_years'] = 'ปี';
$phpMussel['lang']['response_accounts_already_exists'] = 'บัญชีด้วยนั่นเองชื่อผู้ใช้มีอยู่แล้ว!';
$phpMussel['lang']['response_accounts_created'] = 'บัญชีสำเร็จแล้วสร้าง!';
$phpMussel['lang']['response_accounts_deleted'] = 'บัญชีสำเร็จแล้วลบ!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'บัญชีไม่มีอยู่จริง.';
$phpMussel['lang']['response_accounts_password_updated'] = 'รหัสผ่านสำเร็จแล้วอัปเดต!';
$phpMussel['lang']['response_activated'] = 'สำเร็จแล้วเปิดใช้งาน.';
$phpMussel['lang']['response_activation_failed'] = 'ล้มเหลวเปิดใช้งาน!';
$phpMussel['lang']['response_checksum_error'] = 'ข้อผิดพลาด checksum! ไฟล์ถูกปฏิเสธ!';
$phpMussel['lang']['response_component_successfully_installed'] = 'คอมโพเนนต์สำเร็จแล้วในการติดตั้ง.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'คอมโพเนนต์สำเร็จแล้วถอนการติดตั้ง.';
$phpMussel['lang']['response_component_successfully_updated'] = 'คอมโพเนนต์สำเร็จแล้วอัปเดต.';
$phpMussel['lang']['response_component_uninstall_error'] = 'เกิดขึ้นผิดพลาดขณะพยายามถอนการติดตั้งคอมโพเนนต์.';
$phpMussel['lang']['response_configuration_updated'] = 'การกำหนดค่าสำเร็จแล้วอัปเดต.';
$phpMussel['lang']['response_deactivated'] = 'สำเร็จแล้วปิดใช้งาน.';
$phpMussel['lang']['response_deactivation_failed'] = 'ล้มเหลวปิดใช้งาน!';
$phpMussel['lang']['response_delete_error'] = 'ล้มเหลวลบ!';
$phpMussel['lang']['response_directory_deleted'] = 'ไดเรกทอรีสำเร็จแล้วลบ!';
$phpMussel['lang']['response_directory_renamed'] = 'ไดเรกทอรีสำเร็จแล้วเปลี่ยนชื่อ!';
$phpMussel['lang']['response_error'] = 'ข้อผิดพลาด';
$phpMussel['lang']['response_failed_to_install'] = 'การติดตั้งล้มเหลว!';
$phpMussel['lang']['response_failed_to_update'] = 'การอัพเดทล้มเหลว!';
$phpMussel['lang']['response_file_deleted'] = 'ไฟล์สำเร็จแล้วลบ!';
$phpMussel['lang']['response_file_edited'] = 'ไฟล์สำเร็จแล้วเปลี่ยนแปลง!';
$phpMussel['lang']['response_file_renamed'] = 'ไฟล์สำเร็จแล้วเปลี่ยนชื่อ!';
$phpMussel['lang']['response_file_restored'] = 'ฟื้นฟูไฟล์สำเร็จแล้ว!';
$phpMussel['lang']['response_file_uploaded'] = 'ไฟล์สำเร็จแล้วอัปโหลด!';
$phpMussel['lang']['response_login_invalid_password'] = 'ความล้มเหลวในการเข้าสู่ระบบ! รหัสผ่านไม่ถูกต้อง!';
$phpMussel['lang']['response_login_invalid_username'] = 'ความล้มเหลวในการเข้าสู่ระบบ! ชื่อผู้ใช้ไม่มีอยู่จริง!';
$phpMussel['lang']['response_login_password_field_empty'] = 'รหัสผ่านฟิลด์ว่างเปล่า!';
$phpMussel['lang']['response_login_username_field_empty'] = 'ชื่อผู้ใช้ฟิลด์ว่างเปล่า!';
$phpMussel['lang']['response_rename_error'] = 'ล้มเหลวเปลี่ยนชื่อ!';
$phpMussel['lang']['response_restore_error_1'] = 'ไม่สามารถฟื้นฟู! ไฟล์ที่เสียหาย!';
$phpMussel['lang']['response_restore_error_2'] = 'ไม่สามารถฟื้นฟู! คีย์กักกันไม่ถูกต้อง!';
$phpMussel['lang']['response_statistics_cleared'] = 'สถิติลบแล้ว';
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
$phpMussel['lang']['state_maintenance_mode'] = 'คำเตือน: เปิดใช้งานโหมดการบำรุงรักษา!';
$phpMussel['lang']['state_password_not_valid'] = 'คำเตือน: บัญชีนี้ไม่ได้ใช้รหัสผ่านถูกต้อง!';
$phpMussel['lang']['state_quarantine'] = 'อยู่ในกักกัน %s ไฟล์.';
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
$phpMussel['lang']['tip_quarantine'] = 'สวัสดี, {username}.<br />หน้านี้แสดงรายการไฟล์ทั้งหมดที่อยู่ในกักกันและอำนวยความสะดวกในการจัดการไฟล์เหล่านี้.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'บันทึก: กักกันถูกปิดใช้งานอยู่ แต่สามารถเปิดใช้งานได้ผ่านทางหน้ากำหนดค่า.';
$phpMussel['lang']['tip_see_the_documentation'] = 'ดูที่<a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.en.md#SECTION7">เอกสาร</a>สำหรับข้อมูลเกี่ยวกับคำสั่งการกำหนดค่าต่างๆและวัตถุประสงค์ของพวกเขา.';
$phpMussel['lang']['tip_statistics'] = 'สวัสดี, {username}.<br />หน้านี้แสดงสถิติการใช้งานขั้นพื้นฐานเกี่ยวกับการติดตั้ง phpMussel ของคุณ.';
$phpMussel['lang']['tip_statistics_disabled'] = 'บันทึก: ขณะนี้การติดตามผลสถิติถูกปิดใช้งาน แต่สามารถเปิดใช้งานได้ผ่านทางหน้าการกำหนดค่า.';
$phpMussel['lang']['tip_updates'] = 'สวัสดี, {username}.<br />หน้าอัปเดตช่วยให้คุณสามารถติดตั้ง, ถอนการติดตั้ง, และอัปเดตคอมโพเนนต์ต่างๆของ phpMussel (แพคเกจหลัก, ลายเซ็น, ไฟล์การแปล, ฯลฯ).';
$phpMussel['lang']['tip_upload_test'] = 'สวัสดี, {username}.<br />หน้าทดสอบการอัปโหลดมีแบบฟอร์มอัปโหลดไฟล์มาตรฐาน, ช่วยให้คุณสามารถทดสอบถ้าไฟล์ปกติจะถูกบล็อกโดย phpMussel เมื่อพยายามอัปโหลด.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – บัญชี';
$phpMussel['lang']['title_config'] = 'phpMussel – การกำหนดค่า';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – ตัวจัดการไฟล์';
$phpMussel['lang']['title_home'] = 'phpMussel – โฮมเพจ';
$phpMussel['lang']['title_login'] = 'phpMussel – เข้าสู่ระบบ';
$phpMussel['lang']['title_logs'] = 'phpMussel – บันทึก';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – กักกัน';
$phpMussel['lang']['title_statistics'] = 'phpMussel – สถิติ';
$phpMussel['lang']['title_updates'] = 'phpMussel – อัปเดต';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – ทดสอบการอัปโหลด';
$phpMussel['lang']['warning'] = 'คำเตือน:';
$phpMussel['lang']['warning_php_1'] = 'เวอร์ชัน PHP ของคุณไม่ได้รับการสนับสนุนอีกต่อไป! ปรับปรุงขอแนะนำ!';
$phpMussel['lang']['warning_php_2'] = 'เวอร์ชัน PHP ของคุณมีความเสี่ยงสูง! ปรับปรุงขอแนะนำ!';
$phpMussel['lang']['warning_signatures_1'] = 'ไม่มีไฟล์ลายเซ็นที่ใช้งานอยู่!';

$phpMussel['lang']['info_some_useful_links'] = 'ลิงก์ที่เป็นประโยชน์:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">ปัญหา phpMussel @ GitHub</a> – หน้าปัญหาสำหรับ phpMussel (สนับสนุน, ความช่วยเหลือ, ฯลฯ).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – ฟอรั่มการอภิปรายสำหรับ phpMussel (สนับสนุน, ความช่วยเหลือ, ฯลฯ).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – สถานที่ดาวน์โหลดอื่นสำหรับ phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – คอลเลกชันเครื่องมือเว็บมาสเตอร์ง่ายสำหรับการรักษาความปลอดภัยเว็บไซต์.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – โฮมเพจ ClamAV (ClamAV® เป็นเครื่องมือป้องกันไวรัสแบบโอเพนซอร์สสำหรับการตรวจจับโทรจันไวรัสมัลแวร์และภัยคุกคามที่เป็นอันตรายอื่น).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – บริษัทรักษาความปลอดภัยคอมพิวเตอร์ที่เสนอลายเซ็นเสริมสำหรับ ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – ฐานข้อมูลฟิชชิ่งใช้โดยเครื่องสแกน URL phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – แหล่งเรียนรู้ PHP และการสนทนา.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – แหล่งเรียนรู้ PHP และการสนทนา.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal เป็นบริการฟรีสำหรับการวิเคราะห์ไฟล์และ URL ที่น่าสงสัย.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis เป็นบริการฟรีสำหรับการวิเคราะห์มัลแวร์ให้บริการโดย <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – ผู้เชี่ยวชาญด้านคอมพิวเตอร์ป้องกันมัลแวร์.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – ฟอรัมที่เป็นประโยชน์สำหรับการสนทนาเกี่ยวกับมัลแวร์.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Vulnerability Charts (ชาร์ตเสี่ยง)</a> – แสดงรายการเวอร์ชันต่างๆแพคเกจที่ปลอดภัย/ไม่ปลอดภัย (PHP, HHVM, ฯลฯ).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Compatibility Charts (ชาร์ตความเข้ากันได้)</a> – แสดงข้อมูลความเข้ากันได้ของแพคเกจต่างๆ (CIDRAM, phpMussel, ฯลฯ).</li>
        </ul>';
