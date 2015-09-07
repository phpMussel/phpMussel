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
 This File: phpMussel Vietnamese/Việt Language Data (30th August 2015).
 <%phpMussel%/vault/lang/lang.vi.inc>

*/

if(!defined('phpMussel'))die('[phpMussel] This should not be accessed directly.');

$MusselConfig['lang']['bad_command']='Xin lỗi, tôi không hiểu câu lệnh này.';
$MusselConfig['lang']['cli_commands']=" q\n – Thoát ra CLI.\n - Bí danh: quit, exit.\n md5_file\n - Phát ra MD5 chử ký từ tài liệu [Syntax: md5_file filename].\n – Bí danh: m.\n md5\n – Phát ra MD5 chử ký từ dây [Syntax: md5 string].\n hex_encode\n - Chuyển đổi dây nhị phân thành hệ thập lục phân [Syntax: hex_encode string].\n – Bí danh: x.\n hex_decode\n - Chuyển đổi hệ thập lục phân thành dây nhị phân [Syntax: hex_decode string].\n base64_encode\n – Chuyển đổi dây nhị phân thành dây base64 [Syntax: base64_encode string].\n – Bí danh: b.\n base64_decode\n – Chuyển đổi dây base64 thành dây nhị phân [Syntax: base64_decode string].\n scan\n – Xem tài liệu hoạc hồ sơ [Syntax: scan filename].\n – Bí danh: s.\n update\n – Cập nhật phpMussel.\n – Bí danh: u.\n c\n – In danh sách lệnh này.\n";
$MusselConfig['lang']['cli_failed_to_complete']='Quá trình quét chưa được hoàn thành';
$MusselConfig['lang']['cli_is_not_a']=' không phải là file hoạc thư mục.';
$MusselConfig['lang']['cli_ln2']=" Cảm ơn bạn đã chọn phpMussel, một loại bản PHP được thiết kế để phát hiện\n trojan, vi rút, phần mềm đọc hại và những gì có thể gây nguy hiểm trong những\n các tài liệu tài lên trên máy của bạn. Bất cứ nơi nào mà bản đã được nối, dưa\n trên chử ký của ClamAV và những người khác.\n\n BẢN QUYỀN PHPMUSSEL 2013 và hơn GNU/GPLv2 by Caleb M (Maikuolan).\n\n                                     ~ ~ ~\n\n";
$MusselConfig['lang']['cli_ln3']=" phpMussel đang chạy trong chế độ CLI (Command line interface).\n\n Đễ quét tài liệu hoạc thư mục, hảy đánh vào 'scan', sau đó tên của tài liệu\n hoạc thư mực mà bạn muốn phpMussel quét ròi bấm Enter; Đánh vào 'c' và bấm\n Enter đễ xem những loại chế độ CLI; Đánh 'q' và bấm Enter đế thoát ra:";
$MusselConfig['lang']['cli_pe1']='Tài liệu PE không hợp lệ!';
$MusselConfig['lang']['cli_pe2']='Các loại PE:';
$MusselConfig['lang']['cli_update_restart']=' Có thể phải bắt đầu lại phpMussel trước khi cập nhật hiện lên.';
$MusselConfig['lang']['cli_working']='Đang trong quá trình';
$MusselConfig['lang']['controls_lockout']='Cho phép các điều khiển khóa máy của phpMussel.';
$MusselConfig['lang']['core_scriptfile_missing']='Bản tài liệu chính đang thiểu! Xin hảy cài đặt lại phpMussel.';
$MusselConfig['lang']['corrupted']='Lối của PE đã được phát hiện ra';
$MusselConfig['lang']['denied']='Sự tải lên đã bị từ chối!';
$MusselConfig['lang']['denied_other']='Upload Denied! Téléchargement Refusé! Carga Negado! Caricamento Negato! Upload verweigert! Upload Geweigerd! アップロード拒否されました! 上传是否认! 上傳是否認! Uppladda Nekas! Загрузка Отказана! Augšupielādēt Liegta! 업로드 거부! تحميل نفى!';
$MusselConfig['lang']['denied_reason']='Sự tải lên của bạn đã bị từ chối bởi lý do dưới đây / 您的上传被拒绝由于这些原因:';
$MusselConfig['lang']['detected']='Đã được phát hiện {vn}';
$MusselConfig['lang']['detected_control_characters']='Ký tự điều khiển đã được phát hiện';
$MusselConfig['lang']['encrypted_archive']='Kho đã mã hóa đã được phát hiện; Kho đã mã hóa chưa có sự cho phép';
$MusselConfig['lang']['failed_to_access']='Truy cập bị thức bại ';
$MusselConfig['lang']['file']='Tài liệu';
$MusselConfig['lang']['filesize_limit_exceeded']='Cở của tài liệu đã bị quá giới hạn';
$MusselConfig['lang']['filetype_blacklisted']='Loại tài liệu đã vào danh sách đen';
$MusselConfig['lang']['finished']='Hoàn thành';
$MusselConfig['lang']['generated_by']='Được tạo bởi';
$MusselConfig['lang']['greylist_cleared']=' Danh sách xám đã được xóa.';
$MusselConfig['lang']['greylist_not_updated']=' Danh sách không được cập nhật.';
$MusselConfig['lang']['greylist_updated']=' Danh sách xám được cập nhật.';
$MusselConfig['lang']['image']='Hình ảnh';
$MusselConfig['lang']['instance_already_active']='Trường hợp đã hoạt động! Xin hảy kiểm tra giây nói.';
$MusselConfig['lang']['invalid_file']='Tài liệu không hợp lệ';
$MusselConfig['lang']['ok']='OK';
$MusselConfig['lang']['only_allow_images']='Ngoài ra hình ảnh, những tài liệu khác không được phép tải lên';
$MusselConfig['lang']['phpmussel_disabled']='phpMussel bị vô hiệu.';
$MusselConfig['lang']['phpmussel_disabled_already']='phpMussel đã bị tất.';
$MusselConfig['lang']['phpmussel_enabled']='phpMussel cho phép.';
$MusselConfig['lang']['phpmussel_enabled_already']='phpMussel đã được cho phép.';
$MusselConfig['lang']['recursive']='Độ sâu đệ quy bị quá giới hạn';
$MusselConfig['lang']['refer_to_scan_kills']=' (xem '.$MusselConfig['general']['scan_kills'].' để biết thêm chi tiết)';
$MusselConfig['lang']['required_variables_not_defined']='Các biến số cần thiết chưa có định nghĩa: Có thể không có thể tiếp tục.';
$MusselConfig['lang']['scan_aborted']='Hủy bỏ quét';
$MusselConfig['lang']['scan_chameleon']='{x} tấn công tắc kè hoa được phát hiện';
$MusselConfig['lang']['scan_checking']='Đang kiểm tra';
$MusselConfig['lang']['scan_checking_contents']='Thành công! Tiến hành sự kiểm tra nội dung.';
$MusselConfig['lang']['scan_command_injection']='Nỗ lực lệnh chích được phát hiện';
$MusselConfig['lang']['scan_complete']='Đã hoàn toàn';
$MusselConfig['lang']['scan_extensions_missing']='Thất bại (phần nối cần thiết bị thiểu)!';
$MusselConfig['lang']['scan_filename_manipulation_detected']='Sự thay đổi của tên tài liệu được phát hiện';
$MusselConfig['lang']['scan_map_corrupted']='Bản đồ biểu tượng bị lỗi';
$MusselConfig['lang']['scan_map_missing']='Bản đồ biểu tượng bị mất';
$MusselConfig['lang']['scan_missing_filename']='Tên tài liệu bị thiểu';
$MusselConfig['lang']['scan_not_archive']='Thất bại (tróng hoạc không phải trong kho lưu trữ)!';
$MusselConfig['lang']['scan_no_problems_found']='Không tiềm được vấn đề.';
$MusselConfig['lang']['scan_reading']='Đang đọc';
$MusselConfig['lang']['scan_signature_file_corrupted']='Tài liệu quan trọng bị lỗi';
$MusselConfig['lang']['scan_signature_file_missing']='Tài liệu quan trọng bị mất';
$MusselConfig['lang']['scan_tampering']='Tài liệu có khả năng gây nguy hiểm được phát hiện';
$MusselConfig['lang']['scan_unauthorised_upload']='Sự thay đỗi của tài liệu không được phép tải lên được phát hiện';
$MusselConfig['lang']['scan_unauthorised_upload_or_misconfig']='Sự thay đỗi của tài liệu không được phép tải lên được phát hiện! ';
$MusselConfig['lang']['started']='Đã bắt đầu';
$MusselConfig['lang']['update_']='phpMussel bây giờ sẽ tự cập nhật.';
$MusselConfig['lang']['update_available']='Cập nhật cho nguyên bản đã có.';
$MusselConfig['lang']['update_complete']='Kiểm tra cho bản cập nhật đã hoàn thành.';
$MusselConfig['lang']['update_created']='đã tạo ra';
$MusselConfig['lang']['update_deleted']='đã xóa';
$MusselConfig['lang']['update_err1']='Cập nhật bị thất bại: \'update.dat\' thiểu. Cài đặt lại hoặc cập nhật lại.';
$MusselConfig['lang']['update_err2']='Cập nhật bị thất bại: \'update.dat\' không có nguồn bản cập nhật hợp lệ. Xin hảy tự cập nhật.';
$MusselConfig['lang']['update_err3']='Hack hoạc sự giả mạo được phát hiện trong hướng dẫn cập nhật cung cấp bởi nguồn cập nhật; Nguồn có thể bị xâm nhập. Xin liên lạc với tác giả của kịch bản. Đề nghị hảy tự cập nhật.';
$MusselConfig['lang']['update_err4']='Tổng kiểm tra bị mất!';
$MusselConfig['lang']['update_err5']='Tài liệu bị mất!';
$MusselConfig['lang']['update_err6']='Tài liệu xấu!';
$MusselConfig['lang']['update_err7']='Tổng kiểm tra xấu!';
$MusselConfig['lang']['update_failed']='Thất bại.';
$MusselConfig['lang']['update_fetch']='Đang tìm cách để lấy phiên bản dữ liệu từ';
$MusselConfig['lang']['update_lock_detected']='Thông tin khóa được phát hiện: Có thể không có thể tiếp tục. Tiềm các bản cập nhật sai hoạc thử lại sau.';
$MusselConfig['lang']['update_not']='KHÔNG {x}';
$MusselConfig['lang']['update_not_available']='Chưa có cập nhật cho kịch bản vào thời điểm này.';
$MusselConfig['lang']['update_not_possible']='Cập nhật cho kịch bản đã có, nhưng không thề cập nhật đầy đủ với phiên bản này. Xin hảy tự cập nhật.';
$MusselConfig['lang']['update_no_source']='phpMussel đã thức bại trong sự cập nhật bởi vì không thể kết nối với nguồn cập nhật hợp lệ. Đề nghị hảy tự cập nhật.';
$MusselConfig['lang']['update_patched']='đã vá';
$MusselConfig['lang']['update_scriptfile_missing']=' Kịch bản cập nhật tài liệu bị mất! Xin hảy cài phpMussel lại.';
$MusselConfig['lang']['update_seconds_elapsed']=' giây trôi qua';
$MusselConfig['lang']['update_signatures_available']='Cập nhật chử ký.';
$MusselConfig['lang']['update_signatures_latest']='CHỬ KÝ MỚI NHẤT';
$MusselConfig['lang']['update_signatures_not_available']='Không thế cập nhật chử ký vào lúc này.';
$MusselConfig['lang']['update_signatures_yours']='CHỬ KÝ CỦA BẠN';
$MusselConfig['lang']['update_success']='Thành công.';
$MusselConfig['lang']['update_successfully']=' thành công';
$MusselConfig['lang']['update_version_latest']='PHIÊN BẢN MỚI NHẤT';
$MusselConfig['lang']['update_version_yours']='PHIÊN BẢN CỦA BẠN';
$MusselConfig['lang']['update_was']='{x}';
$MusselConfig['lang']['update_wrd1']='Những chữ ký';
$MusselConfig['lang']['upload_error_1']='Cỡ của tài liệu quá giới hạn MAX_FILE_SIZE chỉ dẫn. ';
$MusselConfig['lang']['upload_error_2']='Cỡ của tài liệu quá giới hạn của cỡ file chỉ định. ';
$MusselConfig['lang']['upload_error_34']='Sự tải lên đã bị lối! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$MusselConfig['lang']['upload_error_6']='Thư mục tải lên bị thiếu! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$MusselConfig['lang']['upload_error_7']='Đĩa ghi bị lỗi! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$MusselConfig['lang']['upload_error_8']='Phát hiện PHP sai! Xin vui lòng liên lạc với hostmaster để được giúp đỡ! ';
$MusselConfig['lang']['upload_limit_exceeded']='Đã quá giới hạn tải lên';
$MusselConfig['lang']['wrong_password']='Mật khẩu sai; Hành động bị từ chối.';
$MusselConfig['lang']['x_does_not_exist']='không tồn tại';

?>