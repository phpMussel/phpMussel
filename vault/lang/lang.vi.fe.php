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
 * This file: Vietnamese language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">Trang Chủ</a> | <a href="?phpmussel-page=logout">Đăng Xuất</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">Đăng Xuất</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = 'Được công nhận mở rộng cho tập tin kho lưu trữ (định dạng là CSV; chỉ nên thêm hay loại bỏ khi có vấn đề xảy ra; loại bỏ không cần thiết có thể gây ra sai tích cực để xuất hiện cho tập tin kho lưu trữ, trong khi thêm không cần thiết sẽ trong bản chất danh sách trắng những gì bạn đang thêm từ phát hiện cụ tấn công; sửa đổi với cách thận trọng; cũng lưu ý rằng điều này không có tác dụng liên quan đến những gì kho lưu trữ có thể và không thể được phân tích ở nội dung cấp). Danh sách này, như là mặc định, liệt kê các định dạng sử dụng phổ biến nhất trên phần lớn các hệ thống và CMS, nhưng là cố tình không nhất thiết phải toàn diện.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = 'Chặn bất kỳ tập tin có chứa bất kỳ ký tự điều khiển (khác hơn so với dòng mới)? (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>) Nếu bạn <em><strong>CHỈ</strong></em> tải lên văn bản thô, thế thì bạn có thể kích hoạt tùy chọn này để cung cấp một số bảo vệ bổ sung để hệ thống của bạn. Tuy nhiên, nếu bạn tải lên bất cứ điều gì khác hơn văn bản thô, cho phép điều này có thể dẫn đến sai tích cực. False = Không chặn [Mặc định]; True = Chặn.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = 'Tìm kiếm cho định danh tập tin thực thi trong các tập tin mà không phải là tập tin thực thi cũng không phải là kho lưu trữ được công nhận, và cho tập tin thực thi tập tin mà có định danh sai. False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = 'Tìm kiếm cho định danh PHP trong các tập tin mà không phải là PHP cũng không phải là kho lưu trữ được công nhận. False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = 'Tìm kiếm cho kho lưu trữ mà có định danh sai (Được hỗ trợ: BZ, GZ, RAR, ZIP, RAR, GZ). False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = 'Tìm kiếm cho tài liệu văn phòng mà có định danh sai (Được hỗ trợ: DOC, DOT, PPS, PPT, XLA, XLS, WIZ). False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = 'Tìm kiếm cho hình ảnh mà có định danh sai (Được hỗ trợ: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP). False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = 'Tìm kiếm cho tập tin PDF mà có định danh sai. False = Tắt; True = Trên.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = 'Tập tin bị hỏng và phân tích lỗi. False = Bỏ qua; True = Chặn [Mặc định]. Phát hiện và chặn khả thi tập tin PE (portable executable / thực thi di động) bị hỏng? Thường (nhưng không phải lúc nào), khi khía cạnh cụ thể của một tập tin PE đang bị hỏng hay không thể được phân tích chính xác, nó có thể chỉ ra một nhiễm vi rút. Các quy trình được sử dụng bởi hầu hết các chương trình chống vi rút để phát hiện vi rút trong các tập tin PE đòi hỏi phải phân tích những tập tin theo một cách mà, nếu các lập trình viên của một vi rút là nhận thức của, cụ thể sẽ cố gắng để ngăn chặn, để cho phép vi rút của mình để không bị phát hiện.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = 'Ngưỡng cho chiều dài của dữ liệu thô trong đó các lệnh giải mã nên được phát hiện (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Mặc định = 512KB. Số không hay số null vô hiệu hóa các ngưỡng (loại bỏ bất kỳ giới hạn dựa trên kích cỡ tập tin).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'Ngưỡng cho chiều dài của dữ liệu mà phpMussel được phép đọc và quét (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Mặc định = 32MB. Số không hay số null vô hiệu hóa các ngưỡng. Nói chung, giá trị này không nên được ít hơn kích thước trung bình của tải lên tập tin bạn muốn và mong đợi để nhận được đến máy chủ hay trang mạng của bạn, không nên được ít hơn tùy chọn filesize_limit, và không nên được ít hơn khoảng một phần năm tổng số cấp phát bộ nhớ cấp cho PHP thông qua tập tin cấu hình "php.ini". Tùy chọn này tồn tại để cố gắng ngăn chặn phpMussel từ việc sử dụng quá nhiều bộ nhớ (mà sẽ ngăn chặn nó từ việc có thể quét các tập tin thành công trên một kích thước tập tin nhất định).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = 'Nói chung, tùy chọn này nên bị vô hiệu hóa, trừ khi nó cần thiết cho chức năng đúng của phpMussel trên hệ thống cụ thể của bạn. Thông thường, khi bị vô hiệu, khi phpMussel phát hiện sự hiện diện của elements (yếu tố) trong array <code>$_FILES</code>, nó sẽ cố gắng để bắt đầu quét của các tập tin mà những yếu tố đại diện, và, nếu những yếu tố này là trống, phpMussel sẽ trả về thông báo lỗi. Đây là hành vi thích hợp cho phpMussel. Tuy nhiên, đối với một số CMS, phần tử rỗng trong <code>$_FILES</code> có thể xảy ra như là kết quả của các hành vi tự nhiên của những CMS, hay lỗi có thể được báo cáo khi không có bất kỳ, và trong trường hợp này, các hành vi tự nhiên cho phpMussel sẽ gây trở ngại với các hành vi bình thường của những CMS. Nếu một tình huống như vậy xảy ra cho bạn, bật tùy chọn này sẽ hướng dẫn phpMussel không cố gắng để bắt đầu quét cho phần tử rỗng, bỏ qua chúng khi tìm thấy và không trả lại bất kỳ thông báo lỗi liên quan, do đó cho phép tiếp tục của yêu cầu trang. False = TẮT; True = TRÊN.';
$phpMussel['lang']['config_compatibility_only_allow_images'] = 'Nếu bạn chỉ mong đợi hay chỉ có ý định để cho phép hình ảnh để được tải lên hệ thống hay CMS của bạn, và nếu bạn hoàn toàn không yêu cầu bất kỳ tập tin khác so với hình ảnh để được tải lên hệ thống hay CMS của bạn, tùy chọn này nên được kích hoạt, nhưng nếu không nên bị vô hiệu hóa. Nếu tùy chọn này được kích hoạt, nó sẽ hướng dẫn phpMussel để ngăn chặn bất kỳ tải lên bừa bãi xác định là các tập tin không phải hình ảnh, mà không cần quét chúng. Điều này có thể làm giảm thời gian xử lý và sử dụng bộ nhớ cho tải lên cố gắng của các tập tin không phải hình ảnh. False = TẮT; True = TRÊN.';
$phpMussel['lang']['config_files_block_encrypted_archives'] = 'Phát hiện và chặn kho lưu trữ được mã hóa? Bởi vì phpMussel không thể quét các nội dung của kho lưu trữ được mã hóa, nó có thể mã hóa kho lưu trữ có thể được sử dụng bởi một kẻ tấn công như một phương tiện cố gắng để vượt qua phpMussel, máy quét chống vi rút và bảo vệ khác như. Hướng dẫn phpMussel để ngăn chặn bất kỳ kho lưu trữ mà nó phát hiện được mã hóa có thể giúp giảm nguy cơ nào liên kết với những khả năng này. False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_files_check_archives'] = 'Cố gắng để kiểm tra nội dung của kho lưu trữ? False = Không kiểm tra; True = Kiểm tra [Mặc định]. Tại thơi điểm nay, các chỉ định dạng kho lưu trữ và nén được hỗ trợ là BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR và ZIP (định dạng kho lưu trữ và nén RAR, CAB, 7z và vân vân không được hỗ trợ tại thơi điểm nay). Đây không phải là hoàn hảo! Trong khi tôi rất khuyên bạn nên giữ này được kích hoạt, tôi không thể đảm bảo nó sẽ luôn luôn tìm thấy tất cả mọi thứ. Cũng lưu ý kho lưu trữ kiểm tra là không đệ quy cho PHAR hay ZIP.';
$phpMussel['lang']['config_files_filesize_archives'] = 'Thừa kế danh sách đen/trắng cho kích thước của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều); True = Vâng [Mặc định].';
$phpMussel['lang']['config_files_filesize_limit'] = 'Giới hạn của kích thước tập tin trong KB. 65536 = 64MB [Mặc định]; 0 = Không giới hạn (luôn có trên danh sách xám), bất kỳ giá trị số dương chấp nhận. Điều này có thể hữu ích khi cấu hình PHP của bạn hạn chế số lượng bộ nhớ một quá trình có thể giữ hay nếu hình PHP của bạn giới hạn kích thước của tải lên tập tin.';
$phpMussel['lang']['config_files_filesize_response'] = 'Làm gì với tập tin mà vượt quá các giới hạn kích thước của tải lên (nếu tồn tại). False = Danh sách trắng; True = Danh sách đen [Mặc định].';
$phpMussel['lang']['config_files_filetype_archives'] = 'Thừa kế danh sách đen/trắng cho loại tệp của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều) [Mặc định]; True = Vâng.';
$phpMussel['lang']['config_files_filetype_blacklist'] = 'Danh sách đen:';
$phpMussel['lang']['config_files_filetype_greylist'] = 'Danh sách xám:';
$phpMussel['lang']['config_files_filetype_whitelist'] = 'Nếu hệ thống của bạn chỉ cho phép các loại tệp cụ thể được tải lên, hay nếu hệ thống của bạn từ chối một cách rõ ràng các loại tập tin cụ thể, xác định các loại tập tin trong danh sách trắng, danh sách đen và danh sách xám có thể tăng tốc độ quét được tiến hành bằng cách cho phép các kịch bản bỏ qua các loại tập tin nhất định. Định dạng là CSV (dấu phẩy ngăn cách giá trị). Nếu bạn muốn quét tất cả mọi thứ, thay vì sử dụng danh sách trắng, danh sách đen hay danh sách xám, để lại những biến trống; Làm như vậy sẽ vô hiệu hóa danh sách trắng/đen/xám. Thứ tự hợp lý của chế biến là: Nếu loại tệp là trên danh sách trắng, không quét và không chặn các tập tin, và không kiểm tra các tập tin chống lại danh sách đen hay danh sách xám. Nếu loại tệp là trên danh sách đen, không quét các tập tin nhưng chặn nó dù sao, và không kiểm tra các tập tin chống lại danh sách xám. Nếu danh sách xám là trống hay nếu danh sách xám không phải là trống và các loại tệp là danh sách xám, quét các tập tin như bình thường và xác định xem có chặn nó dựa trên kết quả của quá trình quét, nhưng nếu danh sách xám không phải là trống và các loại tệp không phải trên danh sách xám, điều trị các tập tin như thể nó là trên danh sách đen, vì thế không quét nó nhưng chặn nó dù sao. Danh sách trắng:';
$phpMussel['lang']['config_files_max_recursion'] = 'Tối đa đệ quy chiều sâu giới hạn cho kho lưu trữ. Mặc định = 10.';
$phpMussel['lang']['config_files_max_uploads'] = 'Số lượng tối đa của tập tin cho phép để quét trong khi quét tập tin tải lên trước khi hủy bỏ quá trình quét và thông báo cho người dùng rằng họ đang tải lên quá nhiều cùng một lúc! Trong lý thuyết, cung cấp bảo vệ chống lại một cuộc tấn công nhờ đó mà một kẻ tấn công cố gắng DDoS hệ thống hay CMS của bạn bằng cách quá tải phpMussel để làm chậm quá trình PHP đến khi nó dừng lại. Đề xuất: 10. Bạn có thể muốn tăng hoặc giảm số này tùy thuộc vào tốc độ của phần cứng của bạn. Chú ý rằng con số này không tính đến hoặc bao gồm các nội dung của kho lưu trữ.';
$phpMussel['lang']['config_general_cleanup'] = 'Hủy hoại biến và bộ nhớ được sử dụng bởi các kịch bản sau khi quét tải lên ban đầu? False = Không; True = Vâng [Mặc định]. Nếu bạn -không- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để <code>true</code> (vâng), để giảm thiểu sử dụng bộ nhớ. Nếu bạn -là- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để <code>false</code> (không), để tránh cần thiết tải lại dữ liệu trùng lặp vào bộ nhớ. Trong thực tế nói chung, nó thường nên được đặt để <code>true</code>, nhưng, nếu bạn làm điều này, bạn sẽ không thể sử dụng các kịch bản cho bất cứ điều gì khác hơn quét tải lên ban đầu. Không có ảnh hưởng trong CLI.';
$phpMussel['lang']['config_general_default_algo'] = 'Xác định thuật toán nào sẽ sử dụng cho tất cả các mật khẩu và phiên trong tương lai. Tùy chọn: PASSWORD_DEFAULT (mặc định), PASSWORD_BCRYPT, PASSWORD_ARGON2I (yêu cầu PHP >= 7.2.0).';
$phpMussel['lang']['config_general_delete_on_sight'] = 'Bật tùy chọn này sẽ hướng dẫn các kịch bản để cố gắng xóa ngay lập tức bất kỳ đã quét tải lên tập tin mà phù hợp bất kỳ tiêu chí phát hiện, dù qua chữ ký hay thứ khác. Tập tin xác định là "sạch" sẽ không được bị chạm vào. Trong trường hợp kho lưu trữ, các toàn bộ kho lưu trữ sẽ bị xóa, bất kể nếu các tập tin vi phạm chỉ là một trong nhiều tập tin chứa trong các kho lưu trữ. Trong trường hợp quét tập tin tải lên, thông thường, nó không phải là cần thiết để kích hoạt tùy chọn này, bởi vì thông thường, PHP sẽ tự động tẩy các nội dung của bộ nhớ cache của nó khi thực hiện xong, điều đó có nghĩa là nó thường sẽ xóa bất kỳ tập tin tải lên thông qua nó đến máy chủ trừ khi họ đã được chuyển, sao chép hay xóa rồi. Tùy chọn này được thêm vào ở đây như một biện pháp bảo mật thêm cho những người có bản sao của PHP mà có thể không luôn luôn cư xử theo cách mong đợi. False = Sau khi quét, làm không có gì để các tập tin [Mặc định]; True = Sau khi quét, nếu không sạch, xóa ngay lập tức.';
$phpMussel['lang']['config_general_disable_cli'] = 'Vô hiệu hóa chế độ CLI? Chế độ CLI được kích hoạt theo mặc định, nhưng đôi khi có thể gây trở ngại cho công cụ kiểm tra nhất định (như PHPUnit, cho ví dụ) và khác ứng dụng mà CLI dựa trên. Nếu bạn không cần phải vô hiệu hóa chế độ CLI, bạn nên bỏ qua tùy chọn này. False = Kích hoạt chế độ CLI [Mặc định]; True = Vô hiệu hóa chế độ CLI.';
$phpMussel['lang']['config_general_disable_frontend'] = 'Vô hiệu hóa truy cập front-end? Truy cập front-end có thể làm cho phpMussel dễ quản lý hơn, nhưng cũng có thể là một nguy cơ bảo mật tiềm năng. Đó là khuyến cáo để quản lý phpMussel từ các back-end bất cứ khi nào có thể, nhưng truy cập front-end là cung cấp khi nó không phải là có thể. Giữ nó vô hiệu hóa trừ khi bạn cần nó. False = Kích hoạt truy cập front-end; True = Vô hiệu hóa truy cập front-end [Mặc định].';
$phpMussel['lang']['config_general_disable_webfonts'] = 'Vô hiệu hóa các webfont? True = Vâng; False = Không [Mặc định].';
$phpMussel['lang']['config_general_enable_plugins'] = 'Cho phép hỗ trợ cho plugins của phpMussel? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_general_forbid_on_block'] = 'phpMussel nên gửi 403 Forbidden chúng với các thông điệp tải lên tập tin bị chặn, hoặc chỉ sử dụng 200 OK? False = Không (200); True = Vâng (403) [Mặc định].';
$phpMussel['lang']['config_general_FrontEndLog'] = 'Tập tin cho ghi cố gắng đăng nhập front-end. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.';
$phpMussel['lang']['config_general_honeypot_mode'] = 'Khi chế độ honeypot được kích hoạt, phpMussel sẽ cố gắng kiểm dịch mỗi tập tin tải lên mà nó gặp, bất kể liệu tập tin được tải lên kích hoạt với bất kỳ chữ ký bao gồm, và không có quét hoặc phân tích của những tập tin tải lên thực sự sẽ xảy ra. Chức năng này sẽ hữu ích cho những ai muốn sử dụng phpMussel cho các mục đích của nghiên cứu cho vi rút hay phần mềm độc hại, nhưng nó không được khuyến khích để kích hoạt chức năng này nếu các mục đích sử dụng của phpMussel bởi người dùng là cho tải lên tập tin quét thực sự, cũng không được khuyến khích để sử dụng chức năng honeypot cho các mục đích khác hơn các honeypot. Theo mặc định, tùy chọn này bị vô hiệu hóa. False = Không cho phép [Mặc định]; True = Cho phép.';
$phpMussel['lang']['config_general_ipaddr'] = 'Nơi để tìm thấy các địa chỉ IP của các yêu cầu kết nối? (Hữu ích cho các dịch vụ như thế Cloudflare và vv) Mặc định = REMOTE_ADDR. CẢNH BÁO: Không thay đổi này trừ khi bạn biết những gì bạn đang làm!';
$phpMussel['lang']['config_general_lang'] = 'Xác định tiếng mặc định cho phpMussel.';
$phpMussel['lang']['config_general_maintenance_mode'] = 'Bật chế độ bảo trì? True = Vâng; False = Không [Mặc định]. Vô hiệu hoá mọi thứ khác ngoài các front-end. Đôi khi hữu ích khi cập nhật CMS, framework của bạn, vv.';
$phpMussel['lang']['config_general_max_login_attempts'] = 'Số lượng tối đa cố gắng đăng nhập (front-end). Mặc định = 5.';
$phpMussel['lang']['config_general_numbers'] = 'Làm thế nào để bạn thích số được hiển thị? Chọn ví dụ có vẻ chính xác nhất cho bạn.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel có thể kiểm dịch tải lên tập tin mà đã được đánh dấu trong sự cô lập trong vòng các vault của phpMussel, nếu đây là cái gì bạn muốn nó làm. Các người dùng bình thường của phpMussel mà chỉ đơn giản là muốn bảo vệ các môi trường kho lưu trữ hay trang mạng của họ, mà không có bất cứ quan tâm trong việc phân tích sâu sắc của bất kỳ tải lên tập tin mà đã được đánh dấu, nên để chức năng này bị vô hiệu hóa còn lại, nhưng bất kỳ người dùng quan tâm trong phân tích sâu hơn của tải lên tập tin mà đã được đánh dấu cho nghiên cứu phần mềm độc hại hay cho những thứ tương tự như vậy nên kích hoạt chức năng này. Các kiểm dịch của tải lên tập tin mà đã được đánh dấu đôi khi cũng có thể hỗ trợ trong việc gỡ lỗi sai tích cực, nếu đây là cái gì đó thường xuyên xảy ra đối với bạn. Để vô hiệu hóa chức năng kiểm dịch, chỉ đơn giản để lại tùy chọn <code>quarantine_key</code> trống rỗng, hay xóa nội dung của nó nếu nó không phải là đã trống rỗng. Để kích hoạt chức năng kiểm dịch, nhập một số giá trị vào các tùy chọn. <code>quarantine_key</code> là một tính năng bảo mật quan trọng của chức năng kiểm dịch yêu cầu như là một phương tiện cho ngăn chặn chức năng kiểm dịch được khai thác bởi kẻ tấn công tiềm năng và như một phương tiện ngăn chặn bất kỳ thực hiện tiềm năng của kho lưu trữ trong kiểm dịch. <code>quarantine_key</code> nên được đối xử theo cách tương tự như mật khẩu của bạn: Càng dài thì càng tốt, và cất giữ nó thật chặt. Đối với hiệu quả tốt nhất, sử dụng kết hợp với <code>delete_on_sight</code>.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = 'Cho phép tối đa kích thước của tập tin để được kiểm dịch. Tập tin mà lớn hơn giá trị quy định sẽ KHÔNG được kiểm dịch. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Mặc định = 2MB.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = 'Cho phép tối đa sử dụng bộ nhớ cho kiểm dịch. Nếu tổng số sử dụng bộ nhớ bởi các kiểm dịch đạt giá trị này, các tập tin trong kiểm dịch cho dài nhất sẽ bị xóa cho đến khi các tổng bộ nhớ sử dụng không còn đạt giá trị này. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Mặc định = 64MB.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'Trong bao lâu phpMussel nên nhớ đệm kết quả quét? Giá trị là số giây để nhớ đệm các kết quả quét cho. Mặc định là 21600 giây (6 giờ); Giá trị 0 sẽ vô hiệu hóa bộ nhớ đệm kết quả quét.';
$phpMussel['lang']['config_general_scan_kills'] = 'Tên của tập tin để ghi lại tất cả hồ sơ của bị chặn hay bị giết tải lên. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.';
$phpMussel['lang']['config_general_scan_log'] = 'Tên của tập tin để ghi lại tất cả các kết quả quét. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.';
$phpMussel['lang']['config_general_scan_log_serialized'] = 'Tên của tập tin để ghi lại tất cả các kết quả quét (sử dụng một định dạng tuần tự). Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.';
$phpMussel['lang']['config_general_statistics'] = 'Giám sát thống kê sử dụng phpMussel? True = Vâng; False = Không [Mặc định].';
$phpMussel['lang']['config_general_timeFormat'] = 'Định dạng ngày tháng sử dụng bởi phpMussel. Các tùy chọn bổ sung có thể được bổ sung theo yêu cầu.';
$phpMussel['lang']['config_general_timeOffset'] = 'Múi giờ bù đắp trong phút.';
$phpMussel['lang']['config_general_timezone'] = 'Múi giờ của bạn.';
$phpMussel['lang']['config_general_truncate'] = 'Dọn dẹp các bản ghi khi họ được một kích thước nhất định? Giá trị là kích thước tối đa bằng B/KB/MB/GB/TB mà một tập tin bản ghi có thể tăng lên trước khi bị dọn dẹp. Giá trị mặc định 0KB sẽ vô hiệu hoá dọn dẹp (các bản ghi có thể tăng lên vô hạn). Lưu ý: Áp dụng cho tập tin riêng biệt! Kích thước tập tin bản ghi không được coi là tập thể.';
$phpMussel['lang']['config_heuristic_threshold'] = 'Có một số chữ ký của phpMussel mà được dự định để xác định đáng ngờ và phẩm chất của các tập tin khả năng độc hại từ đang được tải lên mà không có trong tự xác định các tập tin đang được tải lên cụ thể như là độc hại. Giá trị "threshold" này nói với phpMussel tổng trọng lượng tối đa của đáng ngờ và phẩm chất của các tập tin khả năng độc hại đang được tải lên đó là phép trước những tập tin đang được gắn cờ là độc hại. Định nghĩa về trọng lượng trong bối cảnh này là tổng số đáng ngờ và phẩm chất tiềm ẩn độc hại được xác định. Theo mặc định, giá trị này sẽ được thiết lập để 3. Một giá trị thấp hơn nói chung sẽ cho kết quả trong một sự xuất hiện cao hơn của sai tích cực nhưng một số cao hơn các tập tin độc hại được gắn cờ, trong khi một giá trị cao hơn nói chung sẽ cho kết quả trong một sự xuất hiện thấp hơn của sai tích cực nhưng một số thấp hơn các tập tin độc hại được gắn cờ. Nói chung, nó là tốt nhất để có giá trị này tại mặc định của nó trừ khi bạn đang gặp phải các vấn đề liên quan đến nó.';
$phpMussel['lang']['config_signatures_Active'] = 'Một danh sách các kích hoạt tập tin chữ ký, giới hạn bởi dấu phẩy.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel nên sử dụng chữ ký cho phát hiện adware? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel nên sử dụng chữ ký cho phát hiện deface và công cụ làm xấu? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel nên phát hiện và chặn các tập tin mật mã? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel nên sử dụng chữ ký cho phát hiện câu nói đùa và chơi khăm phần mềm độc hại và vi rút? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel nên sử dụng chữ ký cho phát hiện đóng gói tập tin và dữ liệu đã đóng gói? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel nên sử dụng chữ ký cho phát hiện các PUA/PUP? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel nên sử dụng chữ ký cho phát hiện shell script? False = Không; True = Vâng [Mặc định].';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = 'phpMussel nên báo cáo khi mở rộng bị mất? Nếu <code>fail_extensions_silently</code> được vô hiệu hóa, mở rộng bị mất sẽ được báo cáo khi quét, và nếu <code>fail_extensions_silently</code> được kích hoạt, mở rộng bị mất hay bị hỏng sẽ bị bỏ qua, với báo cáo quét cho những tập tin mà không có bất kỳ vấn đề. Vô hiệu hóa tùy chọn này có khả năng có thể làm tăng bảo mật của bạn, nhưng cũng có thể dẫn đến sự gia tăng giả tích cực. False = Không cho phép; True = Cho phép [Mặc định].';
$phpMussel['lang']['config_signatures_fail_silently'] = 'phpMussel nên báo cáo khi tập tin chữ ký bị mất hay bị hỏng? Nếu <code>fail_silently</code> được vô hiệu hóa, tập tin bị mất hay bị hỏng sẽ được báo cáo khi quét, và nếu <code>fail_silently</code> được kích hoạt, tập tin bị mất hay bị hỏng sẽ bị bỏ qua, với báo cáo quét cho những tập tin mà không có bất kỳ vấn đề. Điều này thường cần được ở một mình trừ khi bạn gặp sự cố hay vấn đề tương tự. False = Không cho phép; True = Cho phép [Mặc định].';
$phpMussel['lang']['config_template_data_css_url'] = 'Tập tin mẫu thiết kế cho chủ đề tùy chỉnh sử dụng thuộc tính CSS bên ngoài, trong khi các tập tin mẫu thiết kế cho các chủ đề mặc định sử dụng thuộc tính CSS nội bộ. Để hướng dẫn phpMussel để sử dụng các tập tin mẫu thiết kế cho chủ đề tùy chỉnh, xác định các địa chỉ HTTP cho các tập tin CSS chủ đề tùy chỉnh của bạn sử dụng các biến số <code>css_url</code>. Nếu bạn để cho biến số này chỗ trống, phpMussel sẽ sử dụng các tập tin mẫu thiết kế cho các chủ đề mặc định.';
$phpMussel['lang']['config_template_data_Magnification'] = 'Phóng to chữ. Mặc định = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'Chủ đề mặc định để sử dụng cho phpMussel.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'Kết quả tra cứu API nên được lưu trữ trong (trong giây) bao lâu? Mặc định là 3600 giây (1 giờ).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = 'Cho phép tra cứu API đến API của Google Safe Browsing khi khóa API cần thiết được xác định.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'Cho phép tra cứu API đến API của hpHosts khi xác định như true.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = 'Số lượng tối đa cho phép của tra cứu API để thực hiện mỗi quét lặp cá nhân. Bởi vì mỗi tra cứu API thêm sẽ thêm vào tổng thời gian cần thiết để hoàn thành mỗi quét lặp, bạn có thể muốn để quy định một giới hạn để đẩy nhanh các quá trình quét tổng thể. Khi thiết lập để 0, không số lượng tối đa cho phép sẽ được áp dụng. Đặt 10 theo mặc định.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'Phải làm gì nếu số lượng tối đa cho phép của tra cứu API được vượt quá? False = Không làm gì cả (tiếp tục chế biến) [Mặc định]; True = Dấu/Chặn các tập tin.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = 'Nếu bạn muốn, phpMussel có thể quét tập tin sử dụng các Virus Total API như một cách để cung cấp bảo vệ tăng cường rất nhiều chống lại vi rút, trojan, phần mềm độc hại và các mối đe dọa khác. Theo mặc định, quét của tập tin sử dụng các Virus Total API bị vô hiệu hóa. Để kích hoạt nó, một khóa API từ Virus Total là cần thiết. Do những lợi ích đáng kể rằng điều này có thể cung cấp cho bạn, nó là một cái gì đó mà tôi rất khuyên bạn nên cho phép. Xin hãy lưu ý, tuy nhiên, rằng để sử dụng các Virus Total API, bạn <em><strong>PHẢI</strong></em> đồng ý với điều khoản dịch vụ của họ và bạn <em><strong>PHẢI</strong></em> tuân theo tất cả các hướng dẫn như mô tả của các tài liệu của Virus Total! Bạn KHÔNG được phép để sử dụng tính năng hội nhập này TRỪ KHI: Bạn đã đọc và đồng ý với các Điều khoản và Điều kiện của Virus Total và API của nó. Bạn đã đọc và bạn hiểu, ở mức nhỏ nhất, lời mở đầu của các tài liệu API công cộng của Virus Total (mọi điều sau "VirusTotal Public API v2.0" nhưng trước "Contents").';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Theo tài liệu VirusTotal API, nó được giới hạn tối đa là 4 yêu cầu của bất kỳ chất trong bất kỳ khung thời gian 1 phút nào. Nếu bạn chạy một honeyclient, honeypot hay bất kỳ tự động hóa khác sẽ là cung cấp các nguồn lực để VirusTotal và không chỉ sẽ là lấy báo cáo bạn có quyền được một hạn ngạch có yêu cầu cao hơn. Theo mặc định, phpMussel nghiêm sẽ tuân thủ những hạn chế, nhưng do khả năng của các hạn ngạch yêu cầu đang được tăng lên, hai tùy chọn này được cung cấp như một phương tiện để bạn có thể hướng dẫn phpMussel như những gì giới hạn nó phải tuân thủ. Trừ khi bạn đã được hướng dẫn làm như vậy, nó không được khuyến khích cho bạn để tăng các giá trị, nhưng, nếu bạn đã gặp phải vấn đề liên quan đến hạn ngạch của bạn, giảm các giá trị <em><strong>CÓ THỂ</strong></em> đôi khi giúp bạn trong việc đối phó với những vấn đề này. Hạn ngạch yêu cầu của bạn được xác định như <code>vt_quota_rate</code> yêu cầu của bất kỳ chất trong bất kỳ khung thời gian <code>vt_quota_time</code> phút nào.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(Xem mô tả ở trên).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = 'Theo mặc định, phpMussel sẽ hạn chế các tập tin nó quét bằng cách sử dụng Virus Total API đến các tập tin mà nó coi như là "đáng ngờ". Bạn có thể tùy chọn điều chỉnh hạn chế này bằng cách thay đổi các giá trị của tùy chọn <code>vt_suspicion_level</code>.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMussel nên áp dụng các kết quả quét từ sử dụng Virus Total API như các phát hiện hoặc như các cân nặng phát hiện? Tùy chọn này tồn tại, bởi vì, mặc dù quét một tập tin sử dụng nhiều công cụ (như Virus Total làm) nên dẫn đến một tỷ lệ phát hiện tăng (và do đó ở một số cao hơn các tập tin độc hại bị bắt), nó cũng có thể dẫn đến một số cao hơn của sai tích cực, và vì thế, trong một số trường hợp, các kết quả quét có thể là tốt hơn sử dụng như một điểm tự tin chứ không phải là một kết luận dứt khoát. Nếu giá trị 0 được sử dụng, các kết quả quét từ sử dụng Virus Total API sẽ được áp dụng như phát hiện, và vì thế, nếu bất kỳ công cụ được sử dụng bởi Virus Total đánh dấu các tập tin được quét như độc hại, phpMussel sẽ cân nhắc các tập tin đến được độc hại. Nếu bất kỳ giá trị nào khác được sử dụng, các kết quả quét từ sử dụng Virus Total API sẽ được áp dụng như cân nặng phát hiện, và vì thế, các số lượng động cơ được sử dụng bởi Virus Total mà đánh dấu các tập tin được quét như được độc hại sẽ phục vụ như là một điểm tin (hay cân nặng phát hiện) cho nếu các tập tin được quét nên được xem như độc hại bởi phpMussel (giá trị sử dụng sẽ đại diện cho số điểm tin cậy hay cân nặng tối thiểu mà là cần thiết để có thể được coi độc hại). Giá trị 0 được sử dụng bởi mặc định.';
$phpMussel['lang']['Extended Description: phpMussel'] = 'Các gói thầu chính (mà không có các tập tin chữ ký, tài liệu, và cấu hình).';
$phpMussel['lang']['field_activate'] = 'Kích hoạt';
$phpMussel['lang']['field_clear_all'] = 'Hủy bỏ tất cả';
$phpMussel['lang']['field_component'] = 'Thành phần';
$phpMussel['lang']['field_create_new_account'] = 'Tạo ra tài khoản mới';
$phpMussel['lang']['field_deactivate'] = 'Vô hiệu hóa';
$phpMussel['lang']['field_delete_account'] = 'Xóa tài khoản';
$phpMussel['lang']['field_delete_all'] = 'Xóa bỏ tất cả';
$phpMussel['lang']['field_delete_file'] = 'Xóa bỏ';
$phpMussel['lang']['field_download_file'] = 'Tải về';
$phpMussel['lang']['field_edit_file'] = 'Chỉnh sửa';
$phpMussel['lang']['field_false'] = 'False (Sai)';
$phpMussel['lang']['field_file'] = 'Tập Tin';
$phpMussel['lang']['field_filename'] = 'Tên tập tin: ';
$phpMussel['lang']['field_filetype_directory'] = 'Thư Mục';
$phpMussel['lang']['field_filetype_info'] = 'Tập Tin {EXT}';
$phpMussel['lang']['field_filetype_unknown'] = 'Không Xác Định';
$phpMussel['lang']['field_install'] = 'Cài đặt';
$phpMussel['lang']['field_latest_version'] = 'Phiên bản mới nhất';
$phpMussel['lang']['field_log_in'] = 'Đăng Nhập';
$phpMussel['lang']['field_more_fields'] = 'Thêm Lĩnh Vực';
$phpMussel['lang']['field_new_name'] = 'Tên mới:';
$phpMussel['lang']['field_ok'] = 'OK';
$phpMussel['lang']['field_options'] = 'Tùy Chọn';
$phpMussel['lang']['field_password'] = 'Mật Khẩu';
$phpMussel['lang']['field_permissions'] = 'Quyền';
$phpMussel['lang']['field_quarantine_key'] = 'Khóa kiểm dịch';
$phpMussel['lang']['field_rename_file'] = 'Đổi tên';
$phpMussel['lang']['field_reset'] = 'Thiết Lập Lại';
$phpMussel['lang']['field_restore_file'] = 'Khôi phục';
$phpMussel['lang']['field_set_new_password'] = 'Đặt mật khẩu mới';
$phpMussel['lang']['field_size'] = 'Kích thước tổng: ';
$phpMussel['lang']['field_size_bytes'] = 'byte';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = 'Tình Trạng';
$phpMussel['lang']['field_system_timezone'] = 'Sử dụng múi giờ mặc định của hệ thống.';
$phpMussel['lang']['field_true'] = 'True (Đúng)';
$phpMussel['lang']['field_uninstall'] = 'Gỡ bỏ cài đặt';
$phpMussel['lang']['field_update'] = 'Cập nhật';
$phpMussel['lang']['field_update_all'] = 'Cập nhật tất cả';
$phpMussel['lang']['field_upload_file'] = 'Tải lên tập tin mới';
$phpMussel['lang']['field_username'] = 'Tên Người Dùng';
$phpMussel['lang']['field_your_version'] = 'Phiên bản của bạn';
$phpMussel['lang']['header_login'] = 'Vui lòng đăng nhập để tiếp tục.';
$phpMussel['lang']['label_active_config_file'] = 'Tập tin cấu hình kích hoạt: ';
$phpMussel['lang']['label_blocked'] = 'Tải lên bị chặn';
$phpMussel['lang']['label_branch'] = 'Chi nhánh ổn định mới nhất:';
$phpMussel['lang']['label_events'] = 'Sự kiện quét';
$phpMussel['lang']['label_flagged'] = 'Đối tượng bị gắn cờ';
$phpMussel['lang']['label_fmgr_cache_data'] = 'Dữ liệu bộ nhớ cache và các tập tin tạm thời';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'Số lượng sử dụng đĩa bởi phpMussel: ';
$phpMussel['lang']['label_fmgr_free_space'] = 'Không gian đĩa có sẵn: ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = 'Số lượng sử dụng đĩa trong tổng số: ';
$phpMussel['lang']['label_fmgr_total_space'] = 'Số lượng không gian đĩa trong tổng số: ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = 'Siêu dữ liệu cho cập nhật thành phần';
$phpMussel['lang']['label_hide'] = 'Che giấu';
$phpMussel['lang']['label_os'] = 'Hệ điều hành đang được dùng:';
$phpMussel['lang']['label_other'] = 'Khác';
$phpMussel['lang']['label_other-Active'] = 'Tập tin chữ ký kích hoạt';
$phpMussel['lang']['label_other-Since'] = 'Ngày bắt đầu';
$phpMussel['lang']['label_php'] = 'Phiên bản PHP đang được dùng:';
$phpMussel['lang']['label_phpmussel'] = 'Phiên bản phpMussel đang được dùng:';
$phpMussel['lang']['label_quarantined'] = 'Tải lên trong kiểm dịch';
$phpMussel['lang']['label_sapi'] = 'SAPI đang được dùng:';
$phpMussel['lang']['label_scanned_objects'] = 'Đối tượng được quét';
$phpMussel['lang']['label_scanned_uploads'] = 'Tải lên được quét';
$phpMussel['lang']['label_show'] = 'Hiển thị';
$phpMussel['lang']['label_size_in_quarantine'] = 'Kích thước trong kiểm dịch: ';
$phpMussel['lang']['label_stable'] = 'Ổn định mới nhất:';
$phpMussel['lang']['label_sysinfo'] = 'Thông tin hệ thống:';
$phpMussel['lang']['label_tests'] = 'Kiểm tra:';
$phpMussel['lang']['label_unstable'] = 'Không ổn định mới nhất:';
$phpMussel['lang']['label_upload_date'] = 'Ngày tải lên: ';
$phpMussel['lang']['label_upload_hash'] = 'Băm tải lên: ';
$phpMussel['lang']['label_upload_origin'] = 'Nguồn gốc tải lên: ';
$phpMussel['lang']['label_upload_size'] = 'Kích thước tải lên: ';
$phpMussel['lang']['link_accounts'] = 'Tài Khoản';
$phpMussel['lang']['link_config'] = 'Cấu Hình';
$phpMussel['lang']['link_documentation'] = 'Tài liệu';
$phpMussel['lang']['link_file_manager'] = 'Quản lý tập tin';
$phpMussel['lang']['link_home'] = 'Trang Chủ';
$phpMussel['lang']['link_logs'] = 'Bản Ghi';
$phpMussel['lang']['link_quarantine'] = 'Kiểm dịch';
$phpMussel['lang']['link_statistics'] = 'Số liệu thống kê';
$phpMussel['lang']['link_textmode'] = 'Định dạng văn bản: <a href="%1$sfalse">Đơn giản</a> – <a href="%1$strue">Đẹp</a>';
$phpMussel['lang']['link_updates'] = 'Cập Nhật';
$phpMussel['lang']['link_upload_test'] = 'Kiểm tra tải lên';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = 'Bản ghi đã chọn không tồn tại!';
$phpMussel['lang']['logs_no_logfiles_available'] = 'Không có bản ghi có sẵn.';
$phpMussel['lang']['logs_no_logfile_selected'] = 'Không có bản ghi được chọn.';
$phpMussel['lang']['max_login_attempts_exceeded'] = 'Số lượng tối đa cố gắng đăng nhập đã bị vượt quá; Truy cập bị từ chối.';
$phpMussel['lang']['previewer_days'] = 'Ngày';
$phpMussel['lang']['previewer_hours'] = 'Giờ';
$phpMussel['lang']['previewer_minutes'] = 'Phút';
$phpMussel['lang']['previewer_months'] = 'Tháng';
$phpMussel['lang']['previewer_seconds'] = 'Giây';
$phpMussel['lang']['previewer_weeks'] = 'Tuần';
$phpMussel['lang']['previewer_years'] = 'Năm';
$phpMussel['lang']['response_accounts_already_exists'] = 'Một tài khoản với tên người dùng này đã tồn tại!';
$phpMussel['lang']['response_accounts_created'] = 'Tài khoản tạo ra thành công!';
$phpMussel['lang']['response_accounts_deleted'] = 'Tài khoản xóa thành công!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = 'Tài khoản này không tồn tại.';
$phpMussel['lang']['response_accounts_password_updated'] = 'Mật khẩu cập nhật thành công!';
$phpMussel['lang']['response_activated'] = 'Kích hoạt thành công.';
$phpMussel['lang']['response_activation_failed'] = 'Không thể kích hoạt!';
$phpMussel['lang']['response_checksum_error'] = 'Kiểm tra lỗi! Tập tin bị từ chối!';
$phpMussel['lang']['response_component_successfully_installed'] = 'Thành phần cài đặt thành công.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = 'Thành phần gỡ bỏ cài đặt thành công.';
$phpMussel['lang']['response_component_successfully_updated'] = 'Thành phần cập nhật thành công.';
$phpMussel['lang']['response_component_uninstall_error'] = 'Có lỗi xảy ra trong khi cố gắng để gỡ bỏ cài đặt thành phần.';
$phpMussel['lang']['response_configuration_updated'] = 'Cấu hình cập nhật thành công.';
$phpMussel['lang']['response_deactivated'] = 'Vô hiệu hóa thành công.';
$phpMussel['lang']['response_deactivation_failed'] = 'Không thể vô hiệu hóa!';
$phpMussel['lang']['response_delete_error'] = 'Không thể xóa!';
$phpMussel['lang']['response_directory_deleted'] = 'Thư mục xóa thành công!';
$phpMussel['lang']['response_directory_renamed'] = 'Đổi tên thư mục thành công!';
$phpMussel['lang']['response_error'] = 'Lỗi';
$phpMussel['lang']['response_failed_to_install'] = 'Cài đặt không thành công!';
$phpMussel['lang']['response_failed_to_update'] = 'Cập nhật không thành công!';
$phpMussel['lang']['response_file_deleted'] = 'Tập tin xóa thành công!';
$phpMussel['lang']['response_file_edited'] = 'Tập tin sửa đổi thành công!';
$phpMussel['lang']['response_file_renamed'] = 'Đổi tên tập tin thành công!';
$phpMussel['lang']['response_file_restored'] = 'Tập tin khôi phục thành công!';
$phpMussel['lang']['response_file_uploaded'] = 'Tập tin tải lên thành công!';
$phpMussel['lang']['response_login_invalid_password'] = 'Thất bại đăng nhập! Mật khẩu không hợp lệ!';
$phpMussel['lang']['response_login_invalid_username'] = 'Thất bại đăng nhập! Tên người dùng không tồn tại!';
$phpMussel['lang']['response_login_password_field_empty'] = 'Mật khẩu là trống!';
$phpMussel['lang']['response_login_username_field_empty'] = 'Tên người dùng là trống!';
$phpMussel['lang']['response_rename_error'] = 'Không thể đổi tên!';
$phpMussel['lang']['response_restore_error_1'] = 'Không thể khôi phục! Tập tin bị hỏng!';
$phpMussel['lang']['response_restore_error_2'] = 'Không thể khôi phục! Khóa kiểm dịch sai rồi!';
$phpMussel['lang']['response_statistics_cleared'] = 'Thống kê đã được xóa.';
$phpMussel['lang']['response_updates_already_up_to_date'] = 'Đã cập nhật.';
$phpMussel['lang']['response_updates_not_installed'] = 'Gói không được cài đặt!';
$phpMussel['lang']['response_updates_not_installed_php'] = 'Gói không được cài đặt (đòi hỏi PHP {V})!';
$phpMussel['lang']['response_updates_outdated'] = 'Hết hạn!';
$phpMussel['lang']['response_updates_outdated_manually'] = 'Hết hạn (vui lòng cập nhật bằng tay)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = 'Hết hạn (đòi hỏi PHP {V})!';
$phpMussel['lang']['response_updates_unable_to_determine'] = 'Không thể xác định.';
$phpMussel['lang']['response_upload_error'] = 'Không thể tải lên!';
$phpMussel['lang']['state_complete_access'] = 'Truy cập đầy đủ';
$phpMussel['lang']['state_component_is_active'] = 'Thành phần này đang kích hoạt.';
$phpMussel['lang']['state_component_is_inactive'] = 'Thành phần này đang vô hiệu hóa.';
$phpMussel['lang']['state_component_is_provisional'] = 'Thành phần này đang thỉnh thoảng hoạt động.';
$phpMussel['lang']['state_default_password'] = 'Cảnh báo: Nó là sử dụng mật khẩu mặc định!';
$phpMussel['lang']['state_logged_in'] = 'Được đăng nhập.';
$phpMussel['lang']['state_logs_access_only'] = 'Bản ghi truy cập chỉ';
$phpMussel['lang']['state_maintenance_mode'] = 'Cảnh báo: Đã bật chế độ bảo trì!';
$phpMussel['lang']['state_password_not_valid'] = 'Cảnh báo: Tài khoản này không được sử dụng một mật khẩu hợp lệ!';
$phpMussel['lang']['state_quarantine'] = 'Kiểm dịch hiện có %s tập tin.';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = 'Đừng ẩn các không hết hạn';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = 'Ẩn các không hết hạn';
$phpMussel['lang']['switch-hide-unused-set-false'] = 'Đừng ẩn các không cài đặt';
$phpMussel['lang']['switch-hide-unused-set-true'] = 'Ẩn các không cài đặt';
$phpMussel['lang']['tip_accounts'] = 'Xin chào, {username}.<br />Trang tài khoản cho phép bạn kiểm soát những người có thể truy cập các front-end phpMussel.';
$phpMussel['lang']['tip_config'] = 'Xin chào, {username}.<br />Trang cấu hình cho phép bạn chỉnh sửa các cấu hình phpMussel từ các front-end.';
$phpMussel['lang']['tip_donate'] = 'phpMussel được cung cấp miễn phí, nhưng nếu bạn muốn đóng góp cho dự án, bạn có thể làm như vậy bằng cách nhấn vào nút tặng.';
$phpMussel['lang']['tip_file_manager'] = 'Xin chào, {username}.<br />Quản lý tập tin cho phép bạn xóa bỏ, chỉnh sửa, tải lên, và tải về các tập tin. Sử dụng thận trọng (bạn có thể phá vỡ cài đặt của bạn với điều này).';
$phpMussel['lang']['tip_home'] = 'Xin chào, {username}.<br />Đây là trang chủ cho các front-end phpMussel. Chọn một liên kết từ thực đơn bên trái để tiếp tục.';
$phpMussel['lang']['tip_login'] = 'Tên người dùng mặc định: <span class="txtRd">admin</span> – Mật khẩu mặc định: <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = 'Xin chào, {username}.<br />Chọn một bản ghi từ danh sách dưới đây để xem nội dung của bản ghi này.';
$phpMussel['lang']['tip_quarantine'] = 'Xin chào, {username}.<br />Trang này liệt kê tất cả các tập tin hiện đang được trong kiểm dịch và tạo thuận lợi cho việc quản lý các tập tin đó.';
$phpMussel['lang']['tip_quarantine_disabled'] = 'Lưu ý: Kiểm dịch hiện đang bị tắt, nhưng có thể được kích hoạt thông qua trang cấu hình.';
$phpMussel['lang']['tip_see_the_documentation'] = 'Xem <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.vi.md#SECTION7">tài liệu</a> để biết thông tin về các chỉ thị cấu hình khác nhau và mục đích của họ.';
$phpMussel['lang']['tip_statistics'] = 'Xin chào, {username}.<br />Trang này cho thấy một số thống kê của sử dụng cơ bản liên quan đến cài đặt phpMussel của bạn.';
$phpMussel['lang']['tip_statistics_disabled'] = 'Lưu ý: Giám sát thống kê hiện bị vô hiệu hóa, nhưng có thể được kích hoạt thông qua trang cấu hình.';
$phpMussel['lang']['tip_updates'] = 'Xin chào, {username}.<br />Trang cập nhật cho phép bạn cài đặt, gỡ bỏ cài đặt, và cập nhật các gói khác nhau cho phpMussel (các gói cốt lõi, chữ ký, bổ sung, các tập tin L10N, vv).';
$phpMussel['lang']['tip_upload_test'] = 'Xin chào, {username}.<br />Trang kiểm tra tải lên chứa một hình thức tải lên tập tin chuẩn, mà cho phép bạn để kiểm tra liệu một tập tin sẽ thường bị chặn bởi phpMussel khi cố gắng để tải nó lên.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – Tài khoản';
$phpMussel['lang']['title_config'] = 'phpMussel – Cấu hình';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – Quản lý tập tin';
$phpMussel['lang']['title_home'] = 'phpMussel – Trang Chủ';
$phpMussel['lang']['title_login'] = 'phpMussel – Đăng nhập';
$phpMussel['lang']['title_logs'] = 'phpMussel – Bản ghi';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – Kiểm dịch';
$phpMussel['lang']['title_statistics'] = 'phpMussel – Số liệu thống kê';
$phpMussel['lang']['title_updates'] = 'phpMussel – Cập nhật';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – Kiểm tra tải lên';
$phpMussel['lang']['warning'] = 'Cảnh báo:';
$phpMussel['lang']['warning_php_1'] = 'Phiên bản PHP của bạn không được hỗ trợ tích cực nữa! Đang cập nhật được khuyến khích!';
$phpMussel['lang']['warning_php_2'] = 'Phiên bản PHP của bạn rất dễ bị tổn thương! Đang cập nhật được khuyến khích mạnh mẽ!';
$phpMussel['lang']['warning_signatures_1'] = 'Không có tập tin chữ ký nào đang hoạt động!';

$phpMussel['lang']['info_some_useful_links'] = 'Một số liên kết hữu ích:<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">Vấn đề cho phpMussel @ GitHub</a> – Trang các vấn đề cho phpMussel (hỗ trợ, vv).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – Diễn đàn thảo luận cho phpMussel (hỗ trợ, vv).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – Tải về gương thay thế cho phpMussel.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – Một bộ sưu tập các công cụ quản trị trang web đơn giản để bảo vệ các trang web.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – Trang chủ cho ClamAV (ClamAV® là một công cụ chống vi rút mã nguồn mở để phát hiện trojan, vi rút, phần mềm độc hại và các mối đe dọa nguy hiểm khác).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – Công ty bảo mật máy tính mã cung cấp chữ ký bổ sung cho ClamAV.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – Cơ sở dữ liệu lừa đảo sử dụng bởi các máy quét URL phpMussel.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP tài nguyên học tập và thảo luận.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP tài nguyên học tập và thảo luận.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal là một dịch vụ miễn phí để phân tích các tập tin và URL đó là đáng ngờ.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis là một dịch vụ miễn phí để phân tích phần mềm độc hại được cung cấp bởi <a href="http://www.payload-security.com/">Payload Security</a>.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – Máy tính chống phần mềm độc hại chuyên gia.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – Diễn đàn thảo luận hữu ích tập trung vào phần mềm độc hại.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">Danh sách dễ bị tổn thương</a> – Liệt kê các phiên bản an toàn và không an toàn của các gói khác nhau (PHP, HHVM, vv).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">Danh sách tương thích</a> – Liệt kê thông tin tương thích cho các gói khác nhau (CIDRAM, phpMussel, vv).</li>
        </ul>';
