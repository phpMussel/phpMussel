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
 * This file: Vietnamese language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = 'Xin lỗi, tôi không hiểu câu lệnh này.';
$phpMussel['lang']['cli_failed_to_complete'] = 'Quá trình quét chưa được hoàn thành';
$phpMussel['lang']['cli_is_not_a'] = ' không phải là file hoạc thư mục.';
$phpMussel['lang']['cli_ln2'] = " Cảm ơn bạn đã chọn phpMussel, một loại bản PHP được thiết kế để phát hiện\n trojan, vi rút, phần mềm đọc hại và những gì có thể gây nguy hiểm trong những\n các tập tin tài lên trên máy của bạn. Bất cứ nơi nào mà bản đã được nối, dưa\n trên chử ký của ClamAV và những người khác.\n\n BẢN QUYỀN PHPMUSSEL 2013 và hơn GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " phpMussel đang chạy trong chế độ CLI (command line interface).\n\n Đễ quét tập tin hoạc thư mục, hảy đánh vào 'scan', sau đó tên của tập tin\n hoạc thư mực mà bạn muốn phpMussel quét ròi bấm Enter; Đánh vào 'c' và bấm\n Enter đễ xem những loại chế độ CLI; Đánh 'q' và bấm Enter đế thoát ra:";
$phpMussel['lang']['cli_pe1'] = 'Tập tin PE không hợp lệ!';
$phpMussel['lang']['cli_pe2'] = 'Các loại PE:';
$phpMussel['lang']['cli_signature_placeholder'] = 'TÊN-CHỮ-KÝ';
$phpMussel['lang']['cli_working'] = 'Đang trong quá trình';
$phpMussel['lang']['corrupted'] = 'Lối của PE đã được phát hiện ra';
$phpMussel['lang']['data_not_available'] = 'Dữ liệu không có sẵn.';
$phpMussel['lang']['denied'] = 'Sự tải lên đã bị từ chối!';
$phpMussel['lang']['denied_reason'] = 'Sự tải lên của bạn đã bị từ chối bởi lý do dưới đây:';
$phpMussel['lang']['detected'] = 'Đã được phát hiện {vn}';
$phpMussel['lang']['detected_control_characters'] = 'Ký tự điều khiển đã được phát hiện';
$phpMussel['lang']['encrypted_archive'] = 'Kho đã mã hóa đã được phát hiện; Kho đã mã hóa chưa có sự cho phép';
$phpMussel['lang']['failed_to_access'] = 'Truy cập bị thức bại ';
$phpMussel['lang']['file'] = 'Tập tin';
$phpMussel['lang']['filesize_limit_exceeded'] = 'Cở của tập tin đã bị quá giới hạn';
$phpMussel['lang']['filetype_blacklisted'] = 'Loại tập tin đã vào danh sách đen';
$phpMussel['lang']['finished'] = 'Hoàn thành';
$phpMussel['lang']['generated_by'] = 'Được tạo bởi';
$phpMussel['lang']['greylist_cleared'] = ' Danh sách xám đã được xóa.';
$phpMussel['lang']['greylist_not_updated'] = ' Danh sách không được cập nhật.';
$phpMussel['lang']['greylist_updated'] = ' Danh sách xám được cập nhật.';
$phpMussel['lang']['image'] = 'Hình ảnh';
$phpMussel['lang']['instance_already_active'] = 'Trường hợp đã hoạt động! Xin hảy kiểm tra giây nói.';
$phpMussel['lang']['invalid_data'] = 'Dữ liệu không hợp lệ!';
$phpMussel['lang']['invalid_file'] = 'Tập tin không hợp lệ';
$phpMussel['lang']['invalid_url'] = 'URL không hợp lệ!';
$phpMussel['lang']['ok'] = 'OK';
$phpMussel['lang']['only_allow_images'] = 'Ngoài ra hình ảnh, những tập tin khác không được phép tải lên';
$phpMussel['lang']['plugins_directory_nonexistent'] = 'Thư mực plugin không tồn tại!';
$phpMussel['lang']['quarantined_as'] = "Đã được kiểm dịch là \"/vault/quarantine/{QFU}.qfu\".\n";
$phpMussel['lang']['recursive'] = 'Độ sâu đệ quy bị quá giới hạn';
$phpMussel['lang']['required_variables_not_defined'] = 'Các biến số cần thiết chưa có định nghĩa: Có thể không có thể tiếp tục.';
$phpMussel['lang']['SafeBrowseLookup_200'] = 'URL đó là có khả năng có hại đã được phát hiện';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'Lỗi yêu cầu API';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'Lỗi ủy quyền API';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'Dịch vụ của API không có sẵn';
$phpMussel['lang']['SafeBrowseLookup_999'] = 'Lỗi API không xác định';
$phpMussel['lang']['scan_aborted'] = 'Hủy bỏ quét!';
$phpMussel['lang']['scan_chameleon'] = '{x} tấn công tắc kè hoa được phát hiện';
$phpMussel['lang']['scan_checking'] = 'Đang kiểm tra';
$phpMussel['lang']['scan_checking_contents'] = 'Thành công! Tiến hành sự kiểm tra nội dung.';
$phpMussel['lang']['scan_command_injection'] = 'Nỗ lực lệnh chích được phát hiện';
$phpMussel['lang']['scan_complete'] = 'Đã hoàn toàn';
$phpMussel['lang']['scan_extensions_missing'] = 'Thất bại (phần nối cần thiết bị thiểu)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = 'Sự thay đổi của tên tập tin được phát hiện';
$phpMussel['lang']['scan_missing_filename'] = 'Tên tập tin bị thiểu';
$phpMussel['lang']['scan_not_archive'] = 'Thất bại (tróng hoạc không phải trong kho lưu trữ)!';
$phpMussel['lang']['scan_no_problems_found'] = 'Không tiềm được vấn đề.';
$phpMussel['lang']['scan_reading'] = 'Đang đọc';
$phpMussel['lang']['scan_signature_file_corrupted'] = 'Tập tin quan trọng bị lỗi';
$phpMussel['lang']['scan_signature_file_missing'] = 'Tập tin quan trọng bị mất';
$phpMussel['lang']['scan_tampering'] = 'Tập tin có khả năng gây nguy hiểm được phát hiện';
$phpMussel['lang']['scan_unauthorised_upload'] = 'Sự thay đỗi của tập tin không được phép tải lên được phát hiện';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = 'Sự thay đỗi của tập tin không được phép tải lên được phát hiện! ';
$phpMussel['lang']['started'] = 'Đã bắt đầu';
$phpMussel['lang']['too_many_urls'] = 'Quá nhiều URL';
$phpMussel['lang']['upload_error_1'] = 'Cỡ của tập tin quá giới hạn upload_max_filesize chỉ dẫn. ';
$phpMussel['lang']['upload_error_2'] = 'Cỡ của tập tin quá giới hạn của cỡ file chỉ định. ';
$phpMussel['lang']['upload_error_34'] = 'Sự tải lên đã bị lối! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$phpMussel['lang']['upload_error_6'] = 'Thư mục tải lên bị thiếu! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$phpMussel['lang']['upload_error_7'] = 'Đĩa ghi bị lỗi! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$phpMussel['lang']['upload_error_8'] = 'Phát hiện PHP sai! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$phpMussel['lang']['upload_limit_exceeded'] = 'Đã quá giới hạn tải lên';
$phpMussel['lang']['wrong_password'] = 'Mật khẩu sai; Hành động bị từ chối.';
$phpMussel['lang']['x_does_not_exist'] = 'không tồn tại';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - Thoát ra CLI.
 - Bí danh: quit, exit.
 md5_file
 - Phát ra MD5 chử ký từ tập tin [Cú pháp: md5_file \"tên tập tin\"].
 - Bí danh: m.
 sha1_file
 - Phát ra SHA1 chử ký từ tập tin [Cú pháp: sha1_file \"tên tập tin\"].
 md5
 - Phát ra MD5 chử ký từ dây [Cú pháp: md5 dây].
 sha1
 - Phát ra SHA1 chử ký từ dây [Cú pháp: sha1 dây].
 hex_encode
 - Chuyển đổi dây nhị phân thành hệ thập lục phân [Cú pháp: hex_encode dây].
 - Bí danh: x.
 hex_decode
 - Chuyển đổi hệ thập lục phân thành dây nhị phân [Cú pháp: hex_decode dây].
 base64_encode
 - Chuyển đổi dây nhị phân thành dây base64 [Cú pháp: base64_encode dây].
 - Bí danh: b.
 base64_decode
 - Chuyển đổi dây base64 thành dây nhị phân [Cú pháp: base64_decode dây].
 pe_meta
 - Trích xuất siêu dữ liệu từ tập tin PE [Cú pháp: pe_meta \"tên tập tin\"].
 url_sig
 - Tạo chữ ký của trình quét URL [Cú pháp: url_sig dây].
 scan
 - Xem tập tin hoạc hồ sơ [Cú pháp: scan \"tên tập tin\"].
 - Bí danh: s.
 c
 - In danh sách lệnh này.
";
