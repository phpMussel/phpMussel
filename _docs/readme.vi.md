## Tài liệu của phpMussel (Tiếng Việt).

### Nội dung
- 1. [LỜI GIỚI THIỆU](#SECTION1)
- 2A. [CẢCH ĐỂCÀI ĐẶT (CHO CÁC TRANG WEB CHỦ)](#SECTION2A)
- 2B. [CẢCH CÀI ĐẶT (CHO CLI)](#SECTION2B)
- 3A. [CÁCH SỬ DỤNG (CHO CÁC TRANG WEB CHỦ)](#SECTION3A)
- 3B. [CÁCH SỬ DỤNG (CHO CLI)](#SECTION3B)
- 4A. [ĐIỀU KHIỂN TRÌNH DUYỆT](#SECTION4A)
- 4B. [CLI (LỆNH CHO DÒNG GIAO DIỆN)](#SECTION4B)
- 5. [TẬP TIN BAO GỒM TRONG GÓI NÀY](#SECTION5)
- 6. [SỰ LỰA CHỌN CỦA CẤU HÌNH](#SECTION6)
- 7. [ĐỊNH DẠNG CỦA CHỬ KÝ](#SECTION7)
- 8. [NHỮNG VẤN ĐỀ HỢP TƯƠNG TÍCH](#SECTION8)

---


###1. <a name="SECTION1"></a>LỜI GIỚI THIỆU

Cảm ơn bạn đã chọn phpMussel, một loại bản PHP được thiết kế để phát hiện trojan, vi rút, phần mềm đọc hại và những gì có thể gây nguy hiểm trong những các tập tin tài lên trên máy của bạn. Bất cứ nơi nào mà bản đã được nối, dưa trên chử ký của ClamAV và những người khác.

BẢN QUYỀN PHPMUSSEL 2013 và hơn GNU/GPLv2 by Caleb M (Maikuolan).

Bản này là chương trình miễn phí; bạn có thể phân phối lại hoạc sửa đổi dưới điều kiện của GNU Giấy Phép Công Cộng xuất bản bởi Free Software Foundation; một trong giấy phép phần hai, hoạc (tùy theo sự lựa chọn của bạn) bất kỳ phiên bản nào sau này. Bản này được phân phối với hy vọng rằng nó sẽ có hữu ích, nhưng mà KHÔNG CÓ BẢO HÀNH; ngay cả những bảo đảm ngụ ý KHẢ NĂNG BÁN HÀNG hoạc PHÙ HỢP VỚI MỤC ĐÍT VÀO. Hảy xem GNU Giấy Phép Công Cộng để biết them chi tiết, nằm trong tập tin `LICENSE.txt`, và kho chứa của tập tin này có thể tiềm đước tại:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Chân thành cám ơn [ClamAV](http://www.clamav.net/) cho cả hai nguồn cảm hứng cho chương trình này và những chữ ký kịch bản này sử dụng, mà nếu không, bản này sẽ không có cơ hội tồn tại, hoặc ít nhất, sẽ có giá trị rất nhỏ.

Chân thành cám ơn Sourceforge và GitHub cho cung cấp một nơi cho các tập tin dự án, và [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) cho cung cấp một diễn đàn thảo luận cho phpMussel, và và những người cung cấp một số các chữ ký thêm mà được sử dụng bởi phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) vân vân, và chân thành cảm ơn những người đã ủng hộ chương trình này, và bất cứ ai khác mà tôi quên cảm ơn, và bạn, đã sử dụng bản này.

Tài liệu này và các gói liên quan của nó có thể được tải về miễn phí từ:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>CẢCH ĐỂCÀI ĐẶT (CHO CÁC TRANG WEB CHỦ)

Tôi hy vọng sẽ giản hóa quá trình này bằng cách thực hiện một cài đặt tại một thời điểm nào trong tương lai không quá xa, nhưng cho đến lúc đó, bạn hảy làm theo hướng dẫn để có thể cho phpMussel làm việc trên hầu hết các hệ thống và CMS:

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Từ đây, bạn sẽ muốn đặt nội dung ở một nơi trên máy chủ hoặc CMS của bạn. Một thư mục chẳng hạn như `/public_html/phpmussel/` hay tương tự (mặc dù sự lựa chọn của bạn không quan trọng, miễn là nó an toàn và bạn hài lòng với sự lựa chọn) sẽ đủ.. *Trước khi bạn bắt đầu tải lên, hảy tiếp tục đọc..*

2) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hoặc chưa có kinh nghiệm không nên chọn), hảy mở `phpmussel.ini` (nằm ớ trong `vault`) - Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

3) Tải nội dung lên (phpMussel và tập tin của nó) vào thư mục bạn đã chọn trước (bạn không cần phải dùng tập tin `*.txt`/`*.md`, nhưng chủ yếu, bạn nên tải lên tất cả mọi thứ).

4) CHMOD cái `vault` thư mục thành "777". Các thư mục chính kho lưu trữ các nội dung (một trong những cái bạn đã chọn trước), bình thường, có thể riêng, nhưng tình hình CHMOD nên kiểm tra, nếu bạn đã có vấn đề cho phép trong quá khứ về hệ thống của bạn (theo mặc định, nên giống như "755").

5) Tiếp theo, bạn sẽ cần "nối" phpMussel vào hệ thống của bạn hay CMS. Có một số cách mà bạn có thể "nối" bản chẳng hạn như phpMussel vào hệ thống hoạc CMS, nhưng cách đơn giản nhất là cần có bản vào cốt lõi ở đầu của tập tin hoạc hệ thống hay CMS của bạn (một mà thường sẽ luôn luôn được nạp khi ai đó truy cập bất kỳ trang nào trên trang web của bạn) bằng cách sử dụng một lời chỉ thị `require` hoạc `include`. Thường, cái nàu sẽ được lưu trong một thư mục như `/includes`, `/assets` hoạc `/functions`, và sẽ thường được gọi là `init.php`, `common_functions.php`, `functions.php` hoạc tương tự. Bạn sẽ cần tiềm ra tập tin nào cho trường hợp của bạn; Nếu bạn gặp khó khăn trong việc này, hãy truy cập diễn đàn hỗ trợ của phpMussel và cho chúng tôi biêt; Có thể là tôi họac các người dùng khác có có kinh nghiệm với các CMS mà bạn đang sử dụng (bạn phải biết mình đang sử dụng CMS nào), và như vậy, có thể cung cấp hỗ trợ trong trường hợp này. Để làm chuyện này [sử dụng `require` họac `include`], đánh các dòng mã sao đây vào đầu của cốt lõi của tập tin, thay thế các dây chứa bên trong các dấu ngoặc kép với địa chỉ chính xác của tập tin `phpmussel.php` (địa chỉ địa phương, chứ không phải địa chỉ HTTP; nó sẽ nhình gióng địa chỉ kho nói ở trên).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Lưu tập tin, đóng lại, tải lên lại.

-- CÁCH KHÁC --

Nếu bạn đang sử dụng trang chủ Apache và nếu bạn có thể truy cập `php.ini`, bạn có thể sử dụng `auto_prepend_file` chỉ thị để thêm vào trước phpMussel bất cứ khi nào bất kỳ yêu cầu PHP được xin. Gióng như:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

Hoạc cái này trong tập tin `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) Tại điểm này, bạn đã xong! Nhưng mà, bạn nên kiểm tra nó ra để đảm bảo nó hoạt động đúng. Để kiểm tra các tập tin tải lên bảo vệ, thử tải lên các tập tin thử nghiệm bao gồm trong gói dưới `_testfiles` vào trang web của bạn thông qua các phương pháp tải lên dựa trên trình duyệt thông thường của bạn. Nếu tất cả mọi thứ đang hoạt động, một tin nhắn sẽ xuất hiện từ phpMussel xác nhận là việc tải lên đã bị chặn thành công. Nếu không có gì xuất hiện, đây là điều biểu hiện cho một vấn đề với sự hoạt động. Nếu bạn đang sử dụng chức năng cao cấp, hay sử dụng các loại chức năng quét khác có thể với công cụ này, bạn nên thử nó ra với những điều đó để đảm bảo nó hoạt động như yêu cầu.

---


###2B. <a name="SECTION2B"></a>CẢCH CÀI ĐẶT (CHO CLI)

Tôi hy vọng sẽ giản hóa quá trình này bằng cách thực hiện một cài đặt tại một thời điểm nào trong tương lai không quá xa, nhưng cho đến lúc đó, bạn hảy làm theo hướng dẫn để có thể cho phpMussel hoạt động với CLI (hảy cẩn thận, vào lúc này hỗ trợ cho CLI chỉ áp dụng với hệ thống dựa trên Windows; Linux và các hệ thống khác sẽ sau trong phiên bản sau này của phpMussel):

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Một khi bạn đã hài lòng với vị trí của phpMussel, hày tiếp tục.

2) phpMussel cần PHP được cài đặt trên máy chủ để thực hiện. Nếu bạn không có PHP cài trên máy, xin hảy cài PHP, theo hướng dẫn được cung cấp bởi người cài đặt PHP.

3) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hay chưa có kinh nghiệm không nên chọn), hảy mở `phpmussel.ini` (nằm ớ trong `vault`) - Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

4) Tùy ý, bạn có thể sử dụng phpMussel trong chế độ CLI dể hơn với cách tạo ra tập tin lô để tự động tải PHP và phpMussel. Để làm điều này, mở một chương trình văn bản đơn giản như Notepad hoạc Notepad++, đánh vào đường dẫn đầy đủ cho tập tin `php.exe` trong thư mục cài đặt PHP của bạn, tiếp theo là một khoảng trống, theo sau là đường dẫn đầy đủ đến tập tin `phpmussel.php` trong thư mục cài đặt phpMussel của bạn, lưu tập tin với tư bổ sung ".bat" một nơi nào bạn sẽ tìm thấy dễ dàng, và nhấn đúp vào vào tập tin đó để chạy phpMussel trong tương lai.

5) Tại thời điểm này, bạ đã xong! Nhưng mà, bạn nên kiểm tra nó để đảm bảo sự hoạt động. Để kiểm tra phpMussel, chạy phpMussel và thử quét `_testfiles` thư mục cung cấp trong gói.

---


###3A. <a name="SECTION3A"></a>CÁCH SỬ DỤNG (CHO CÁC TRANG WEB CHỦ)

phpMussel sẽ có thể hoạt động một cách chính xác với yêu cầu tối thiểu từ bạn: Sau khi cài đặt nó, nó có thể được sử dụng ngay lập tức.

Quét tập tin tải lên là tự động và kích hoạt theo mặc định, như vậy không có gì là cần thiết từ bạn cho các chức năng đặc biệt này.

Tuy nhiên, bạn cũng có thể nói với phpMussel để quét tập tin cụ thể, thư mục hay kho lưu trữ. Để làm điều này, trước hết, bạn sẽ cần phải đảm bảo rằng các cấu hình thích hợp được thiết lập trong tập tin `phpmussel.ini` (`cleanup` phải được vô hiệu hóa), và khi thực hiện, trong một tập tin PHP được kết nối với phpMussel, sử dụng sau đây trong mã của bạn:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` có thể là một string, hoặc một hay nhiều của array, và chỉ ra đó tập tin hay thư mục để quét.
- `$output_type` là một boolean, và chỉ ra đó định dạng cho kết quả quét được trả về như. False hướng dẫn các chức năng để trả về kết quả là một số nguyên (trở lại kết quả của -3 chỉ ra rằng vấn đề gặp phải với các tập tin chữ ký hay tập tin chữ ký bản đồ và rằng họ có thể bị mất hay bị hỏng, -2 chỉ ra rằng dữ liệu bị hỏng đã được phát hiện trong quá trình quét và như vậy quét không hoàn thành, -1 chỉ ra rằng mở rộng hay bổ sung theo yêu cầu của PHP để thực hiện quá trình quét bị mất tích và như vậy quét không hoàn thành, 0 chỉ ra rằng mục tiêu quét không tồn tại và như vậy không có gì để quét, 1 chỉ ra rằng các mục tiêu đã được quét thành công và không có vấn đề đã được phát hiện, và 2 chỉ ra rằng các mục tiêu đã được quét thành công và vấn đề đã được phát hiện). True hướng dẫn các chức năng trả lại kết quả dưới dạng văn bản có thể đọc được con người. Ngoài ra, trong cả hai trường hợp, kết quả có thể được truy cập thông qua biến toàn cầu sau khi quét đã hoàn thành. Biến này là tùy chọn, mặc định là false.
- `$output_flatness` là một boolean, chỉ ra cho các chức năng liệu có nên trả lại kết quả quét (khi có nhiều mục tiêu quét) như là một array hoặc một string. False sẽ trả lại kết quả như là một array. True sẽ trả lại kết quả như là một string. Biến này là tùy chọn, mặc định là false.

Các ví dụ:

```
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

Trả về một cái gì đó như thế này (như một string):

```
 Wed, 16 Sep 2013 02:49:46 +0000 Đã bắt đầu.
 > Đang kiểm tra '/user_name/public_html/my_file.html':
 -> Không tiềm được vấn đề.
 Wed, 16 Sep 2013 02:49:47 +0000 Hoàn thành.
```

Đối với một phân tích đầy đủ những gì sắp xếp của chữ ký phpMussel sử dụng trong quá trình quét của nó và cách nó xử lý chữ ký của nó, tham khảo các phần Định Dạng Của Chử Ký của tập tin README này.

Nếu bạn gặp bất kỳ sai tích cực, nếu bạn gặp một số điều mới bạn nghĩ rằng nên bị chặn, hay cho bất cứ điều gì khác có liên quan đến chữ ký, xin vui lòng liên hệ với tôi vì vậy mà tôi có thể thực hiện các thay đổi cần thiết, mà, nếu bạn không liên hệ với tôi, tôi có thể không nhất thiết phải nhận thức được.

Để vô hiệu hóa chữ ký đã bao gồm trong phpMussel (chẳng hạn như nếu bạn gặp một sai tích cực và bạn không thể loại bỏ nó), tham khảo các ghi chú cho các danh sách xám trong các phần Lệnh Cho Trình Duyệt của tập tin README này.

---


###3B. <a name="SECTION3B"></a>CÁCH SỬ DỤNG (CHO CLI)

Tham khảo phần "CẢCH CÀI ĐẶT (CHO CLI)" của tập tin README này.

Hãy nhận biết rằng, mặc dù các phiên bản tương lai của phpMussel nên hỗ trợ các hệ thống khác, tại thơi điểm nay, hỗ trợ cho chế độ CLI của phpMussel đã được tối ưu chỉ dành cho sử dụng trên hệ thống Windows (bạn có thể, tất nhiên, thử nó trên các hệ thống khác, nhưng tôi không thể đảm bảo nó sẽ làm việc như dự định).

Ngoài ra, ý thức được rằng phpMussel không phải là chức năng tương đương của một bộ chống vi rút hoàn thiện, và không giống như chống vi rút thông thường, nó không theo dõi bộ nhớ hoạt động hay phát hiện vi rút với sự tự phát! Nó sẽ chỉ phát hiện vi rút chứa trong các tập tin mà bạn nói với nó để quét.

---


###4A. <a name="SECTION4A"></a>ĐIỀU KHIỂN TRÌNH DUYỆT

Khi phpMussel đã được cài đặt và hoạt động đúng trên hệ thống của bạn, nếu bạn đã thiết lập biến `script_password` và `logs_password` trong tập tin cấu hình của bạn, bạn sẽ có thể thực hiện một số hạn chế số chức năng hành chính và đầu vào một số lệnh cho phpMussel thông qua trình duyệt của bạn. Lý do các mật khẩu này cần phải được thiết lập để cho phép điều khiển trình duyệt là để đảm bảo an ninh thích hợp, bảo vệ thích hợp cho các điều khiển trình duyệt và để đảm bảo rằng có tồn tại một cách cho điều khiển trình duyệt này để bị vô hiệu hoàn toàn nếu họ không mong muốn của bạn, quản trị web khác hay quản trị sử dụng phpMussel. Vì vậy, nói cách khác, để cho phép những điều khiển này, đặt một mật khẩu, và để vô hiệu hóa những điều khiển này, thiết lập không mật khẩu. Ngoài ra, nếu bạn chọn để cho phép những điều khiển này và chọn để vô hiệu hóa các điều khiển vào một ngày sau, có một lệnh để làm điều này (như vậy có thể có ích nếu bạn thực hiện một số hành động rằng bạn cảm thấy có khả năng có sự thỏa hiệp các mật khẩu giao và cần nhanh chóng vô hiệu hóa những điều khiển này mà không sửa đổi tập tin cấu hình của bạn).

Một số lý do tại sao bạn _**NÊN**_ cho phép những điều khiển này:
- Cung cấp một cách để đánh dấu chữ ký xám tự phát trong trường hợp như thế khi bạn phát hiện ra một chữ ký đó là sản xuất một sai tích cực trong khi tải lên các tập tin để hệ thống của bạn và bạn không có thời gian để tự chỉnh sửa và tải lên tập tin danh sách xám của bạn lần nữa.
- Cung cấp một cách cho bạn để cho phép một người nào khác để kiểm soát bản sao phpMussel của bạn mà không cần phải cấp cho họ truy cập vào FTP.
- Cung cấp một cách để cung cấp truy cập được kiểm soát vào các tập tin đăng nhập của bạn.
- Cung cấp một cách cho bạn để giám sát phpMussel khi truy cập FTP hay các điểm truy cập thông thường khác cho giám sát phpMussel không có sẵn.

Một số lý do tại sao bạn _**KHÔNG**_ nên cho phép những điều khiển này:
- Cung cấp một véc tơ cho kẻ tấn công tiềm năng và người không ai ưa để xác định xem bạn đang sử dụng phpMussel (mặc dù, điều này có thể là một lý do cho hay chống lại, tùy thuộc vào quan điểm) bằng cách mù quáng gửi lệnh đến máy chủ như một phương tiện để thăm dò. Một mặt, điều này có thể làm nản lòng kẻ tấn công nhắm mục tiêu hệ thống của bạn nếu họ biết rằng bạn đang sử dụng phpMussel, giả định rằng họ đang thăm dò bởi vì phương pháp tấn công của họ là ra không hiệu quả như là kết quả của việc sử dụng phpMussel. Tuy nhiên, mặt khác, nếu một số không lường trước và khai thác hiện hành không biết đến phpMussel hay một phiên bản tương lai của chúng trở nên được biết đến, và nếu nó có khả năng cung cấp một vec tơ tấn công, một kết quả tích cực từ thăm dò thực sự có thể khuyến khích kẻ tấn côngs để nhắm mục tiêu hệ thống của bạn.
- Nếu mật khẩu giao của bạn là bất cứ lúc nào bị thỏa hiệp, trừ khi thay đổi, có thể cung cấp một cách cho một kẻ tấn công để bỏ qua bất cứ chữ ký rằng thường có thể là ngăn chặn cuộc tấn công của họ từ thành công, hay thậm chí có khả năng vô hiệu hóa phpMussel hoàn toàn, do đó cung cấp một cách để làm cho phpMussel không hiệu quả.

Dù bằng cách nào, bất kể những gì bạn lựa chọn, các sự lựa chọn là của bạn. Theo mặc định, các điều khiển sẽ bị vô hiệu, nhưng suy nghĩ về nó, và nếu bạn quyết định bạn muốn họ, phần này giải thích làm thế nào để kích hoạt họ và làm thế nào để sử dụng họ.

Một danh sách của có sẵn điều khiển trình duyệt:

scan_log
- Mật khẩu cần thiết: `logs_password`
- Yêu cầu khác: `scan_log` cần phải được xác định.
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?logspword=[logs_password]&phpmussel=scan_log`
- Những gì nó làm: In nội dung tập tin `scan_log` của bạn vào màn hình.

scan_log_serialized
- Mật khẩu cần thiết: `logs_password`
- Yêu cầu khác: `scan_log_serialized` cần phải được xác định.
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?logspword=[logs_password]&phpmussel=scan_log_serialized`
- Những gì nó làm: In nội dung tập tin `scan_log_serialized` của bạn vào màn hình.

scan_kills
- Mật khẩu cần thiết: `logs_password`
- Yêu cầu khác: `scan_kills` cần phải được xác định.
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?logspword=[logs_password]&phpmussel=scan_kills`
- Những gì nó làm: In nội dung tập tin `scan_kills` của bạn vào màn hình.

controls_lockout
- Mật khẩu cần thiết: `logs_password` HAY `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Thí dụ 2: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=controls_lockout`
- Những gì nó làm: Vô hiệu hóa (hay khóa) tất cả các điều khiển cho trình duyệt. Điều này nên được sử dụng nếu bạn nghi ngờ mà một hay cả hai của mật khẩu của bạn đã bị xâm nhập (điều này có thể xảy ra nếu bạn đang sử dụng các điều khiển từ một máy tính không là an toàn hay đáng tin cậy). controls_lockout hoạt động bằng cách tạo ra một tập tin, `controls.lck`, trong vault (kho tiền) của bạn, rằng phpMussel sẽ kiểm tra trước khi thực hiện bất lệnh của bất cứ loại nào. Khi điều này xảy ra, để lại cho phép điều khiển, bạn sẽ cần phải tự xóa các tập tin `controls.lck` thông qua FTP hay tương tự. Có thể được gọi qua sử dụng một trong hai mật khẩu.

disable
- Mật khẩu cần thiết: `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=disable`
- Những gì nó làm: Vô hiệu hóa phpMussel. Điều này nên được sử dụng nếu bạn đang thực hiện bất kỳ bản cập nhật hay thay đổi cho hệ thống của bạn hay nếu bạn đang cài đặt bất kỳ phần mềm mới hay module cho hệ thống của bạn rằng làm hay khả năng có thể kích hoạt sai tích cực. Điều này nên được sử dụng nếu bạn đang gặp bất kỳ vấn đề với phpMussel nhưng không muốn loại bỏ nó khỏi hệ thống của bạn. Khi điều này xảy ra, để tái kích hoạt phpMussel, sử dụng "enable".

enable
- Mật khẩu cần thiết: `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=enable`
- Những gì nó làm: Cho phép phpMussel. Điều này nên được sử dụng nếu trước đó bạn đã bị vô hiệu hóa phpMussel sử dụng "disable" và muốn tái kích hoạt nó.

greylist
- Mật khẩu cần thiết: `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: [Tên của chữ ký để đưa vào danh sách xám]
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=greylist&musselvar=[Chữ_ký]`
- Những gì nó làm: Đặt một chữ ký vào danh sách xám.

greylist_clear
- Mật khẩu cần thiết: `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=greylist_clear`
- Những gì nó làm: Xóa toàn bộ danh sách xám.

greylist_show
- Mật khẩu cần thiết: `script_password`
- Yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[Mật_Khẩu_Kịch_Bản]&phpmussel=greylist_show`
- Những gì nó làm: In các nội dung của danh sách xám vào màn hình.

---


###4B. <a name="SECTION4B"></a>CLI (LỆNH CHO DÒNG GIAO DIỆN)

phpMussel có thể được chạy như một máy quét tập tin tương tác trong chế độ CLI theo các hệ thống dựa trên Windows. Tham khảo phần "CẢCH CÀI ĐẶT (CHO CLI)" của tập tin README này để biết thêm chi tiết.

Để xem một danh sách các lệnh CLI có sẵn, tại dấu nhắc CLI, đánh 'c', và bấm Enter.

---


###5. <a name="SECTION5"></a>TẬP TIN BAO GỒM TRONG GÓI NÀY

Sau đây là một danh sách tất cả các tập tin mà cần phải có được bao gồm trong bản sao lưu của kịch bản này khi bạn tải về nó, bất kỳ tập tin mà có thể có lẽ được tạo ra là kết quả của bạn sử dụng kịch bản này, cùng với một mô tả ngắn cho những gì tất cả những tập tin này là dành cho.

Tập tin | Chi tiết
----|----
/.gitattributes | Tập tin dự án cho GitHub (không cần thiết cho chức năng phù hợp của kịch bản).
/Changelog-v1.txt | Kỷ lục của những sự thay đổi được thực hiện cho các kịch bản khác nhau giữa các phiên bản (không cần thiết cho chức năng phù hợp của kịch bản).
/composer.json | Thông tin về dự án cho Composer/Packagist (không cần thiết cho chức năng phù hợp của kịch bản).
/CONTRIBUTING.md | Thông tin về làm thế nào để đóng góp cho dự án.
/LICENSE.txt | Bản sao của giấy phép GNU/GPLv2.
/PEOPLE.md | Thông tin về những người trong dự án.
/phpmussel.php | Tập tin cho tải. Đây là điều bạn cần nối vào (cần thiết)!
/README.md | Thông tin tóm tắt dự án.
/web.config | Tập tin cấu hình của ASP.NET (trong trường hợp này, để bảo vệ `/vault` thư mực khỏi bị truy cập bởi những nguồn không có quền trong trường hợp bản được cài trên serever chạy trên công nghệ ASP.NET).
/_docs/ | Thư mực cho tài liệu.
/_docs/readme.ar.md | Tài liệu tiếng Ả Rập.
/_docs/readme.de.md | Tài liệu tiếng Đức.
/_docs/readme.en.md | Tài liệu tiếng Anh.
/_docs/readme.es.md | Tài liệu tiếng Tây Ban Nha.
/_docs/readme.fr.md | Tài liệu tiếng Pháp.
/_docs/readme.id.md | Tài liệu tiếng Indonesia.
/_docs/readme.it.md | Tài liệu tiếng Ý.
/_docs/readme.nl.md | Tài liệu tiếng Hà Lan.
/_docs/readme.pt.md | Tài liệu tiếng Bồ Đào Nha.
/_docs/readme.ru.md | Tài liệu tiếng Nga.
/_docs/readme.vi.md | Tài liệu tiếng Việt.
/_docs/readme.zh-TW.md | Tài liệu tiếng Trung Quốc (truyền thống).
/_docs/readme.zh.md | Tài liệu tiếng Trung Quốc (giản thể).
/_testfiles/ | Thư mục kiểm tra tập tin (chứa các tập tin khác nhau). Tất cả các tập tin chứa những tập tin thử nghiệm để thử nghiệm nếu phpMussel đã được cài đặt đúng trên hệ thống của bạn, và bạn không cần phải tải lên thư mục này hay bất kỳ các tập tin của mình trừ khi làm xét nghiệm như vậy.
/_testfiles/ascii_standard_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chữ ký ASCII bình thường.
/_testfiles/coex_testfile.rtf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký kéo dài phức tạp.
/_testfiles/exe_standard_testfile.exe | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký PE.
/_testfiles/general_standard_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký chung.
/_testfiles/graphics_standard_testfile.gif | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký đồ họa.
/_testfiles/html_standard_testfile.html | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký HTML bình thường.
/_testfiles/md5_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký dựa MD5.
/_testfiles/metadata_testfile.tar | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu kho lưu trữ và cho xét nghiệm hỗ trợ tập tin TAR trên hệ thống của bạn.
/_testfiles/metadata_testfile.txt.gz | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu kho lưu trữ và cho xét nghiệm hỗ trợ tập tin GZ trên hệ thống của bạn.
/_testfiles/metadata_testfile.zip | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu kho lưu trữ và cho xét nghiệm hỗ trợ tập tin ZIP trên hệ thống của bạn.
/_testfiles/ole_testfile.ole | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký OLE.
/_testfiles/pdf_standard_testfile.pdf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký PDF.
/_testfiles/pe_sectional_testfile.exe | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký phần PE.
/_testfiles/swf_standard_testfile.swf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký Shockwave.
/_testfiles/xdp_standard_testfile.xdp | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký XML/XDP.
/vault/ | Vault thư mục (chứa các tập tin khác nhau).
/vault/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/cache/ | Cache thư mục (cho dữ liệu tạm thời).
/vault/cache/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/cli.php | Tập tin cho xử lý CLI.
/vault/config.php | Tập tin cho xử lý cấu hình.
/vault/controls.php | Tập tin cho xử lý lệnh cho.
/vault/functions.php | Tập tin cho chức năng.
/vault/greylist.csv | Tập tin CSV cho danh sách xám chử ký chỉ thị cho phpMussel cái nào chử ký nó phải được bỏ qua (tập tin tự động tạo lại nếu xóa).
/vault/lang.php | Dữ liệu tiếng.
/vault/lang/ | Chứa dữ liệu tiếng phpMussel.
/vault/lang/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/lang/lang.ar.php | Dữ liệu tiếng Ả Rập.
/vault/lang/lang.de.php | Dữ liệu tiếng Đức.
/vault/lang/lang.en.php | Dữ liệu tiếng Anh.
/vault/lang/lang.es.php | Dữ liệu tiếng Tây Ban Nha.
/vault/lang/lang.fr.php | Dữ liệu tiếng Pháp.
/vault/lang/lang.id.php | Dữ liệu tiếng Indonesia.
/vault/lang/lang.it.php | Dữ liệu tiếng Ý.
/vault/lang/lang.ja.php | Dữ liệu tiếng Nhật.
/vault/lang/lang.nl.php | Dữ liệu tiếng Hà Lan.
/vault/lang/lang.pt.php | Dữ liệu tiếng Bồ Đào Nha.
/vault/lang/lang.ru.php | Dữ liệu tiếng Nga.
/vault/lang/lang.vi.php | Dữ liệu tiếng Việt.
/vault/lang/lang.zh-TW.php | Dữ liệu tiếng Trung Quốc (Truyền Thống).
/vault/lang/lang.zh.php | Dữ liệu tiếng Trung Quốc (Giản Thể).
/vault/phpmussel.ini | Tập tin cho cấu hình; Chứa tất cả các sự lựa chọn của cấu hình của phpMussel (cần thiết)!
/vault/quarantine/ | Thư mục kiểm dịch (chứa các tập tin trong kiểm dịch).
/vault/quarantine/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
※ /vault/scan_kills.txt | Kỷ lục của mỗi tập tin tải lên từ chối/giết bởi phpMussel.
※ /vault/scan_log.txt | Kỷ lục của mỗi tập tin quét bởi phpMussel.
※ /vault/scan_log_serialized.txt | Kỷ lục của mỗi tập tin quét bởi phpMussel.
/vault/signatures/ | Thư mục cho chữ ký (chứa các tập tin cho chữ ký).
/vault/signatures/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/signatures/ascii_clamav_regex.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_clamav_regex.map | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_clamav_standard.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_clamav_standard.map | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_custom_regex.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_custom_standard.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_mussel_regex.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/ascii_mussel_standard.cvd | Tập tin cho chữ ký ASCII bình thường.
/vault/signatures/coex_clamav.cvd | Tập tin cho chữ ký kéo dài phức tạp.
/vault/signatures/coex_custom.cvd | Tập tin cho chữ ký kéo dài phức tạp.
/vault/signatures/coex_mussel.cvd | Tập tin cho chữ ký kéo dài phức tạp.
/vault/signatures/elf_clamav_regex.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/elf_clamav_regex.map | Tập tin cho chữ ký ELF.
/vault/signatures/elf_clamav_standard.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/elf_clamav_standard.map | Tập tin cho chữ ký ELF.
/vault/signatures/elf_custom_regex.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/elf_custom_standard.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/elf_mussel_regex.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/elf_mussel_standard.cvd | Tập tin cho chữ ký ELF.
/vault/signatures/exe_clamav_regex.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_clamav_regex.map | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_clamav_standard.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_clamav_standard.map | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_custom_regex.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_custom_standard.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_mussel_regex.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/exe_mussel_standard.cvd | Tập tin cho chữ ký PE (portable executable / thực thi di động).
/vault/signatures/filenames_clamav.cvd | Tập tin cho chữ ký tên tập tin.
/vault/signatures/filenames_custom.cvd | Tập tin cho chữ ký tên tập tin.
/vault/signatures/filenames_mussel.cvd | Tập tin cho chữ ký tên tập tin.
/vault/signatures/general_clamav_regex.cvd | Tập tin cho chữ ký chung.
/vault/signatures/general_clamav_regex.map | Tập tin cho chữ ký chung.
/vault/signatures/general_clamav_standard.cvd | Tập tin cho chữ ký chung.
/vault/signatures/general_clamav_standard.map | Tập tin cho chữ ký chung.
/vault/signatures/general_custom_regex.cvd | Tập tin cho chữ ký chung.
/vault/signatures/general_custom_standard.cvd | Tập tin cho chữ ký chung.
/vault/signatures/general_mussel_regex.cvd | Tập tin cho chữ ký chung.
/vault/signatures/general_mussel_standard.cvd | Tập tin cho chữ ký chung.
/vault/signatures/graphics_clamav_regex.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_clamav_regex.map | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_clamav_standard.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_clamav_standard.map | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_custom_regex.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_custom_standard.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_mussel_regex.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/graphics_mussel_standard.cvd | Tập tin cho chữ ký đồ họa.
/vault/signatures/hex_general_commands.csv | CSV (dấu phẩy tách giá trị) thập lục phân được mã hóa của phát hiện lệnh chung chung tùy chọn sử dụng qua phpMussel.
/vault/signatures/html_clamav_regex.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_clamav_regex.map | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_clamav_standard.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_clamav_standard.map | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_custom_regex.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_custom_standard.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_mussel_regex.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/html_mussel_standard.cvd | Tập tin cho chữ ký HTML bình thường.
/vault/signatures/macho_clamav_regex.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_clamav_regex.map | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_clamav_standard.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_clamav_standard.map | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_custom_regex.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_custom_standard.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_mussel_regex.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/macho_mussel_standard.cvd | Tập tin cho chữ ký Mach-O.
/vault/signatures/mail_clamav_regex.cvd | Tập tin cho chữ ký mail.
/vault/signatures/mail_clamav_regex.map | Tập tin cho chữ ký mail.
/vault/signatures/mail_clamav_standard.cvd | Tập tin cho chữ ký mail.
/vault/signatures/mail_clamav_standard.map | Tập tin cho chữ ký mail.
/vault/signatures/mail_custom_regex.cvd | Tập tin cho chữ ký mail.
/vault/signatures/mail_custom_standard.cvd | Tập tin cho chữ ký mail.
/vault/signatures/mail_mussel_regex.cvd | Tập tin cho chữ ký mail.
/vault/signatures/mail_mussel_standard.cvd | Tập tin cho chữ ký mail.
/vault/signatures/md5_clamav.cvd | Tập tin cho chữ ký dựa MD5.
/vault/signatures/md5_custom.cvd | Tập tin cho chữ ký dựa MD5.
/vault/signatures/md5_mussel.cvd | Tập tin cho chữ ký dựa MD5.
/vault/signatures/metadata_clamav.cvd | Tập tin cho chữ ký siêu dữ liệu kho lưu trữ.
/vault/signatures/metadata_custom.cvd | Tập tin cho chữ ký siêu dữ liệu kho lưu trữ.
/vault/signatures/metadata_mussel.cvd | Tập tin cho chữ ký siêu dữ liệu kho lưu trữ.
/vault/signatures/ole_clamav_regex.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/ole_clamav_regex.map | Tập tin cho chữ ký OLE.
/vault/signatures/ole_clamav_standard.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/ole_clamav_standard.map | Tập tin cho chữ ký OLE.
/vault/signatures/ole_custom_regex.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/ole_custom_standard.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/ole_mussel_regex.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/ole_mussel_standard.cvd | Tập tin cho chữ ký OLE.
/vault/signatures/pdf_clamav_regex.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_clamav_regex.map | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_clamav_standard.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_clamav_standard.map | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_custom_regex.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_custom_standard.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_mussel_regex.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pdf_mussel_standard.cvd | Tập tin cho chữ ký PDF.
/vault/signatures/pex_custom.cvd | Tập tin cho chữ ký kéo dài PE.
/vault/signatures/pex_mussel.cvd | Tập tin cho chữ ký kéo dài PE.
/vault/signatures/pe_clamav.cvd | Tập tin cho chữ ký phần PE.
/vault/signatures/pe_custom.cvd | Tập tin cho chữ ký phần PE.
/vault/signatures/pe_mussel.cvd | Tập tin cho chữ ký phần PE.
/vault/signatures/swf_clamav_regex.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_clamav_regex.map | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_clamav_standard.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_clamav_standard.map | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_custom_regex.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_custom_standard.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_mussel_regex.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/swf_mussel_standard.cvd | Tập tin cho chữ ký Shockwave.
/vault/signatures/switch.dat | Điều khiển và định nghĩa biến.
/vault/signatures/urlscanner.cvd | Tập tin cho chữ ký máy quét URL.
/vault/signatures/whitelist_clamav.cvd | Tập tin riêng cho danh sách trắng.
/vault/signatures/whitelist_custom.cvd | Tập tin riêng cho danh sách trắng.
/vault/signatures/whitelist_mussel.cvd | Tập tin riêng cho danh sách trắng.
/vault/signatures/xmlxdp_clamav_regex.cvd | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_clamav_regex.map | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_clamav_standard.cvd | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_clamav_standard.map | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_custom_regex.cvd | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_custom_standard.cvd | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_mussel_regex.cvd | Tập tin cho chữ ký XML/XDP.
/vault/signatures/xmlxdp_mussel_standard.cvd | Tập tin cho chữ ký XML/XDP.
/vault/template.html | Tập tin mẫu; Mẫu cho HTML sản xuất qua phpMussel cho các thông điệp tải lên tập tin bị chặn (các thông điệp nhìn thấy bằng người tải lên).
/vault/template_custom.html | Tập tin mẫu; Mẫu cho HTML sản xuất qua phpMussel cho các thông điệp tải lên tập tin bị chặn (các thông điệp nhìn thấy bằng người tải lên).
/vault/upload.php | Tập tin cho xử lý tải lên.

※ Tên tập tin có thể thay đổi tuy theo các quy định của cấu hình (xem `phpmussel.ini`).

####*LIÊN QUAN ĐẾN CÁC TẬP TIN CHỮ KÝ*
CVD là một từ viết tắt cho "ClamAV Virus Definitions" (định nghĩa vi rút ClamAV), như một tham khảo để cách mà ClamAV đề cập đến chữ ký riêng của mình và đến việc sử dụng những chữ ký cho phpMussel; Tập tin kết thúc với "CVD" chứa chữ ký.

Tập tin kết thúc với "MAP" đồ mà chữ ký phpMussel nên và không nên sử dụng cho quét cá nhân; Không phải tất cả các chữ ký được cần thiết cho mỗi lần quét, vì thế, phpMussel sử dụng bản đồ của các tập tin chữ ký để đẩy nhanh các quá trình quét (một quá trình mà nếu không sẽ là rất chậm và buồn chán).

Tập tin chữ ký đánh dấu với "_regex" chứa chữ ký mà sử dụng kiểm tra cho mẫu biểu thức chính quy (regex).

Tập tin chữ ký đánh dấu với "_standard" chứa chữ ký mà đặc biệt không sử dụng bất kỳ cách thức của kiểm tra cho mẫu biểu thức chính quy.

Tập tin chữ ký đánh dấu không với "_regex" cũng không với "_standard" sẽ là một hay khác, nhưng không cả hai (tham khảo các phần Định Dạng Của Chử Ký của tập tin README này cho tài liệu và chi tiết cụ thể).

Tập tin chữ ký đánh dấu với "_clamav" chứa chữ ký mà có nguồn gốc hoàn toàn từ các cơ sở dữ liệu của ClamAV (GNU/GPL).

Tập tin chữ ký đánh dấu với "_custom", theo mặc định, không chứa bất kỳ chữ ký ở tất cả; Những tập tin này tồn tại để cung cấp cho bạn một nơi nào đó để đặt chữ ký riêng của bạn, nếu bạn viết bất kỳ của riêng bạn.

Tập tin chữ ký đánh dấu với "_mussel" chứa chữ ký mà đặc biệt không có nguồn gốc từ ClamAV, chữ ký mà, nói chung, tôi đã viết bản thân mình hay dựa trên thông tin thu thập từ nhiều nguồn khác nhau.

---


###6. <a name="SECTION6"></a>SỰ LỰA CHỌN CỦA CẤU HÌNH
Sau đây là danh sách các biến tìm thấy trong tập tin cấu hình cho phpMussel `phpmussel.ini`, cùng với một mô tả về mục đích và chức năng của chúng.

####"general" (Thể loại)
Cấu hình chung cho phpMussel.

"script_password"
- Để tiện lợi, phpMussel sẽ cho phép các chức năng nhất định để được kích hoạt bằng tay thông qua POST, GET và QUERY. Tuy nhiên, như một biện pháp phòng ngừa an ninh, để làm điều này, phpMussel sẽ mong đợi một mật khẩu để được bao gồm với các lệnh, để đảm bảo rằng đó là bạn, và không một người nào khác, cố gắng để tự kích hoạt các chức năng này. Đặt `script_password` vào bất cứ mật khẩu mà bạn muốn sử dụng. Nếu không có mật khẩu được đặt, kích hoạt bằng tay sẽ bị vô hiệu hóa theo mặc định. Sử dụng một cái gì đó bạn sẽ nhớ nhưng đó là khó khăn cho người khác để đoán.
- Không có ảnh hưởng trong CLI.

"logs_password"
- Giống như `script_password`, nhưng để xem các nội dung của of `scan_log` và `scan_kills`. Có mật khẩu riêng biệt có thể có ích nếu bạn muốn cho một người nào khác truy cập để một tập các chức năng nhưng không để khác.
- Không có ảnh hưởng trong CLI.

"cleanup"
- Hủy hoại biến và bộ nhớ được sử dụng bởi các kịch bản sau khi quét tải lên ban đầu? False = Không; True = Vâng [Mặc định]. Nếu bạn -không- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để `true` (vâng), để giảm thiểu sử dụng bộ nhớ. Nếu bạn -là- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để `false` (không), để tránh cần thiết tải lại dữ liệu trùng lặp vào bộ nhớ. Trong thực tế nói chung, nó thường nên được đặt để `true`, nhưng, nếu bạn làm điều này, bạn sẽ không thể sử dụng các kịch bản cho bất cứ điều gì khác hơn quét tải lên ban đầu.
- Không có ảnh hưởng trong CLI.

"scan_log"
- Tên của tập tin để ghi lại tất cả các kết quả quét. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_log_serialized"
- Tên của tập tin để ghi lại tất cả các kết quả quét (sử dụng một định dạng tuần tự). Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_kills"
- Tên của tập tin để ghi lại tất cả hồ sơ của bị chặn hay bị giết tải lên. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

*Mẹo hữu ích: Nếu bạn muốn, bạn có thể bao gồm thông tin ngày/giờ trong tên các tập tin bản ghi (`scan_log`, `scan_log_serialized`, `scan_kills`, vv) của bạn bằng cách bao gồm những trong tên: `{yyyy}` cho năm hoàn thành, `{yy}` cho năm viết tắt, `{mm}` cho tháng, `{dd}` cho ngày, `{hh}` cho giờ.

*Các ví dụ:*
- *`logfile='logfile.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileApache='access.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`logfileSerialized='serial.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"timeOffset"
- Nếu thời gian máy chủ của bạn không phù hợp với thời gian địa phương của bạn, bạn có thể chỉ định một bù đắp đây để điều chỉnh thông tin ngày/giờ được tạo ra bởi CIDRAM theo như yêu cầu của bạn. Nó nói chung được đề nghị điều chỉnh tùy chọn múi giờ trong `php.ini` tập tin của bạn, nhưng đôi khi (chẳng hạn như khi làm việc với dịch vụ lưu trữ web chia sẻ mà được giới hạn) đây không phải là luôn luôn có thể làm, và như vậy, tùy chọn này được cung cấp ở đây. Bù đắp là trong từ phút.
- Ví dụ (để thêm một giờ): `timeOffset=60`

"ipaddr"
- Nơi để tìm thấy các địa chỉ IP của các yêu cầu kết nối? (Hữu ích cho các dịch vụ như thế Cloudflare và vv) Mặc định = REMOTE_ADDR. CẢNH BÁO: Không thay đổi này trừ khi bạn biết những gì bạn đang làm!

"enable_plugins"
- Cho phép hỗ trợ cho plugins của phpMussel? False = Không; True = Vâng [Mặc định].

"forbid_on_block"
- phpMussel nên gửi 403 Forbidden chúng với các thông điệp tải lên tập tin bị chặn, hoặc chỉ sử dụng 200 OK? False = Không (200) [Mặc định]; True = Vâng (403).

"delete_on_sight"
- Bật tùy chọn này sẽ hướng dẫn các kịch bản để cố gắng xóa ngay lập tức bất kỳ đã quét tải lên tập tin mà phù hợp bất kỳ tiêu chí phát hiện, dù qua chữ ký hay thứ khác. Tập tin xác định là "sạch" sẽ không được bị chạm vào. Trong trường hợp kho lưu trữ, các toàn bộ kho lưu trữ sẽ bị xóa, bất kể nếu các tập tin vi phạm chỉ là một trong nhiều tập tin chứa trong các kho lưu trữ. Trong trường hợp quét tập tin tải lên, thông thường, nó không phải là cần thiết để kích hoạt tùy chọn này, bởi vì thông thường, PHP sẽ tự động tẩy các nội dung của bộ nhớ cache của nó khi thực hiện xong, điều đó có nghĩa là nó thường sẽ xóa bất kỳ tập tin tải lên thông qua nó đến máy chủ trừ khi họ đã được chuyển, sao chép hay xóa rồi. Tùy chọn này được thêm vào ở đây như một biện pháp bảo mật thêm cho những người có bản sao của PHP mà có thể không luôn luôn cư xử theo cách mong đợi. False = Sau khi quét, làm không có gì để các tập tin [Mặc định]; True = Sau khi quét, nếu không sạch, xóa ngay lập tức.

"lang"
- Xác định tiếng mặc định cho phpMussel.

"lang_override"
- Xác định nếu phpMussel nên, khi có thể, ghi đè lên các xác định tiếng với các sự ưa thích tiếng tuyên bố bởi yêu cầu sắp tới (HTTP_ACCEPT_LANGUAGE). False = Không [Mặc định]; True = Vâng.

"lang_acceptable"
- Tùy chọn `lang_acceptable` nói phpMussel cái nào tiếng có thể được chấp nhận bởi các kịch bản từ `lang` hoặc từ `HTTP_ACCEPT_LANGUAGE`. Tùy chọn này chỉ **NÊN** được sửa đổi nếu bạn đang thêm tập tin tiếng tùy chỉnh của riêng bạn hay ép buộc gỡ bỏ tập tin tiếng. Các tùy chọn là một chuỗi dấu phẩy phân cách của mã sử dụng bởi các tiếng chấp nhận bởi các kịch bản.

"quarantine_key"
- phpMussel có thể kiểm dịch tải lên tập tin mà đã được đánh dấu trong sự cô lập trong vòng các vault của phpMussel, nếu đây là cái gì bạn muốn nó làm. Người dùng bình thường của phpMussel mà chỉ đơn giản là muốn bảo vệ các môi trường kho lưu trữ hay trang web của họ, mà không có bất cứ quan tâm trong việc phân tích sâu sắc của bất kỳ tải lên tập tin mà đã được đánh dấu, nên để chức năng này bị vô hiệu hóa còn lại, nhưng bất kỳ người dùng quan tâm trong phân tích sâu hơn của tải lên tập tin mà đã được đánh dấu cho nghiên cứu phần mềm độc hại hay cho những thứ tương tự như vậy nên kích hoạt chức năng này. Các kiểm dịch của tải lên tập tin mà đã được đánh dấu đôi khi cũng có thể hỗ trợ trong việc gỡ lỗi sai tích cực, nếu đây là cái gì đó thường xuyên xảy ra đối với bạn. Để vô hiệu hóa chức năng kiểm dịch, chỉ đơn giản để lại tùy chọn `quarantine_key` trống rỗng, hay xóa nội dung của nó nếu nó không phải là đã trống rỗng. Để kích hoạt chức năng kiểm dịch, nhập một số giá trị vào các tùy chọn. `quarantine_key` là một tính năng bảo mật quan trọng của chức năng kiểm dịch yêu cầu như là một phương tiện cho ngăn chặn chức năng kiểm dịch được khai thác bởi kẻ tấn công tiềm năng và như một phương tiện ngăn chặn bất kỳ thực hiện tiềm năng của kho lưu trữ trong kiểm dịch. `quarantine_key` nên được đối xử theo cách tương tự như mật khẩu của bạn: Càng dài thì càng tốt, và cất giữ nó thật chặt. Đối với hiệu quả tốt nhất, sử dụng kết hợp với `delete_on_sight`.

"quarantine_max_filesize"
- Cho phép tối đa kích thước của tập tin để được kiểm dịch. Tập tin mà lớn hơn giá trị quy định sẽ KHÔNG được kiểm dịch. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Giá trị là ở KB. Mặc định =2048 =2048KB =2MB.

"quarantine_max_usage"
- Cho phép tối đa sử dụng bộ nhớ cho kiểm dịch. Nếu tổng số sử dụng bộ nhớ bởi các kiểm dịch đạt giá trị này, các tập tin trong kiểm dịch cho dài nhất sẽ bị xóa cho đến khi các tổng bộ nhớ sử dụng không còn đạt giá trị này. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Giá trị là ở KB. Mặc định =65536 =65536KB =64MB.

"honeypot_mode"
- Khi chế độ honeypot được kích hoạt, phpMussel sẽ cố gắng kiểm dịch mỗi tập tin tải lên mà nó gặp, bất kể liệu tập tin được tải lên kích hoạt với bất kỳ chữ ký bao gồm, và không có quét hoặc phân tích của những tập tin tải lên thực sự sẽ xảy ra. Chức năng này sẽ hữu ích cho những ai muốn sử dụng phpMussel cho các mục đích của nghiên cứu cho vi rút hay phần mềm độc hại, nhưng nó không được khuyến khích để kích hoạt chức năng này nếu các mục đích sử dụng của phpMussel bởi người sử dụng là cho tải lên tập tin quét thực sự, cũng không được khuyến khích để sử dụng chức năng honeypot cho các mục đích khác hơn các honeypot. Theo mặc định, tùy chọn này bị vô hiệu hóa. False = Không cho phép [Mặc định]; True = Cho phép.

"scan_cache_expiry"
- Trong bao lâu phpMussel nên nhớ đệm kết quả quét? Giá trị là số giây để nhớ đệm các kết quả quét cho. Mặc định là 21600 giây (6 giờ); Giá trị 0 sẽ vô hiệu hóa bộ nhớ đệm kết quả quét.

"disable_cli"
- Vô hiệu hóa chế độ CLI? Chế độ CLI được kích hoạt theo mặc định, nhưng đôi khi có thể gây trở ngại cho công cụ kiểm tra nhất định (như PHPUnit, cho ví dụ) và khác ứng dụng mà CLI dựa trên. Nếu bạn không cần phải vô hiệu hóa chế độ CLI, bạn nên bỏ qua tùy chọn này. False = Kích hoạt chế độ CLI [Mặc định]; True = Vô hiệu hóa chế độ CLI.

####"signatures" (Thể loại)
Cấu hình cho chữ ký.
- %%%_clamav = Chữ ký ClamAV ("mains" và "daily" cả hai).
- %%%_custom = Chữ ký tùy chỉnh của bạn (nếu bạn đã viết bất kỳ).
- %%%_mussel = Chữ ký phpMussel bao gồm trong bộ chữ ký hiện tại của bạn mà không phải là từ ClamAV.

Kiểm tra chống lại chữ ký MD5 khi quét? False = Không; True = Vâng [Mặc định].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Kiểm tra chống lại chữ ký chung khi quét? False = Không; True = Vâng [Mặc định].
- "general_clamav"
- "general_custom"
- "general_mussel"

Kiểm tra chống lại chữ ký ASCII bình thường khi quét? False = Không; True = Vâng [Mặc định].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Kiểm tra chống lại chữ ký HTML bình thường khi quét? False = Không; True = Vâng [Mặc định].
- "html_clamav"
- "html_custom"
- "html_mussel"

Kiểm tra tập tin PE (portable executable / thực thi di động; EXE, DLL, vv) chống lại chữ ký phần PE khi quét? False = Không; True = Vâng [Mặc định].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Kiểm tra tập tin PE (portable executable / thực thi di động; EXE, DLL, vv) chống lại chữ ký kéo dài PE khi quét? False = Không; True = Vâng [Mặc định].
- "pex_custom"
- "pex_mussel"

Kiểm tra tập tin PE (portable executable / thực thi di động; EXE, DLL, vv) chống lại chữ ký PE khi quét? False = Không; True = Vâng [Mặc định].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Kiểm tra tập tin ELF chống lại chữ ký ELF khi quét? False = Không; True = Vâng [Mặc định].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Kiểm tra tập tin Mach-O (OSX, vv) chống lại chữ ký Mach-O khi quét? False = Không; True = Vâng [Mặc định].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Kiểm tra tập tin đồ họa chống lại chữ ký đồ họa khi quét? False = Không; True = Vâng [Mặc định].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Kiểm tra nội dung của kho lưu trữ chống lại siêu dữ liệu kho lưu trữ chữ ký khi quét? False = Không; True = Vâng [Mặc định].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Kiểm tra đối tượng OLE chống lại chữ ký OLE khi quét? False = Không; True = Vâng [Mặc định].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Kiểm tra tên tập tin chống lại chữ ký tên tập tin khi quét? False = Không; True = Vâng [Mặc định].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Kiểm tra chống lại chữ ký email khi quét? False = Không; True = Vâng [Mặc định].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Cho phép danh sách trắng cho tập tin cụ thể? False = Không; True = Vâng [Mặc định].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Kiểm tra khối XML/XDP chống lại chữ ký XML/XDP khi quét? False = Không; True = Vâng [Mặc định].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Kiểm tra chống lại chữ ký kéo dài phức tạp khi quét? False = Không; True = Vâng [Mặc định].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Kiểm tra chống lại chữ ký PDF khi quét? False = Không; True = Vâng [Mặc định].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Kiểm tra chống lại chữ ký Shockwave khi quét? False = Không; True = Vâng [Mặc định].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Tùy chọn cho chiều dài hạn chế chữ ký. Chỉ thay đổi này nếu bạn biết những gì bạn đang làm. SD = Chữ ký tiêu chuẩn. RX = Chữ ký cho PCRE (Perl Compatible Regular Expressions, hay "Regex"). FN = Chữ ký cho tên tập tin. Nếu bạn nhận thấy PHP vụ tai nạn khi phpMussel cố gắng để quét, cố gắng hạ thấp các giá trị "max". Nếu có thể và thuận tiện, cho tôi biết khi điều này xảy ra và các kết quả của bất cứ điều gì bạn cố gắng.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- phpMussel nên báo cáo khi tập tin chữ ký bị mất hay bị hỏng? Nếu `fail_silently` được vô hiệu hóa, tập tin bị mất hay bị hỏng sẽ được báo cáo khi quét, và nếu `fail_silently` được kích hoạt, tập tin bị mất hay bị hỏng sẽ bị bỏ qua, với báo cáo quét cho những tập tin mà không có bất kỳ vấn đề. Điều này thường cần được ở một mình trừ khi bạn gặp sự cố hay vấn đề tương tự. False = Không cho phép; True = Cho phép [Mặc định].

"fail_extensions_silently"
- phpMussel nên báo cáo khi mở rộng bị mất? Nếu `fail_extensions_silently` được vô hiệu hóa, mở rộng bị mất sẽ được báo cáo khi quét, và nếu `fail_extensions_silently` được kích hoạt, mở rộng bị mất hay bị hỏng sẽ bị bỏ qua, với báo cáo quét cho những tập tin mà không có bất kỳ vấn đề. Vô hiệu hóa tùy chọn này có khả năng có thể làm tăng bảo mật của bạn, nhưng cũng có thể dẫn đến sự gia tăng giả tích cực. False = Không cho phép; True = Cho phép [Mặc định].

"detect_adware"
- phpMussel nên sử dụng chữ ký cho phát hiện adware? False = Không; True = Vâng [Mặc định].

"detect_joke_hoax"
- phpMussel nên sử dụng chữ ký cho phát hiện câu nói đùa và chơi khăm phần mềm độc hại và vi rút? False = Không; True = Vâng [Mặc định].

"detect_pua_pup"
- phpMussel nên sử dụng chữ ký cho phát hiện PUAs/PUPs? False = Không; True = Vâng [Mặc định].

"detect_packer_packed"
- phpMussel nên sử dụng chữ ký cho phát hiện đóng gói tập tin và dữ liệu đã đóng gói? False = Không; True = Vâng [Mặc định].

"detect_shell"
- phpMussel nên sử dụng chữ ký cho phát hiện shell script? False = Không; True = Vâng [Mặc định].

"detect_deface"
- phpMussel nên sử dụng chữ ký cho phát hiện deface và công cụ làm xấu? False = Không; True = Vâng [Mặc định].

####"files" (Thể loại)
Cấu hình cho xử lý tập tin.

"max_uploads"
- Số lượng tối đa của tập tin cho phép để quét trong khi quét tập tin tải lên trước khi hủy bỏ quá trình quét và thông báo cho người dùng rằng họ đang tải lên quá nhiều cùng một lúc! Trong lý thuyết, cung cấp bảo vệ chống lại một cuộc tấn công nhờ đó mà một kẻ tấn công cố gắng DDoS hệ thống hay CMS của bạn bằng cách quá tải phpMussel để làm chậm quá trình PHP đến khi nó dừng lại. Đề xuất: 10. Bạn có thể muốn tăng hoặc giảm số này tùy thuộc vào tốc độ của phần cứng của bạn. Chú ý rằng con số này không tính đến hoặc bao gồm các nội dung của kho lưu trữ.

"filesize_limit"
- Giới hạn của kích thước tập tin trong KB. 65536 = 64MB [Mặc định]; 0 = Không giới hạn (luôn có trên danh sách xám), bất kỳ giá trị số dương chấp nhận. Điều này có thể hữu ích khi cấu hình PHP của bạn hạn chế số lượng bộ nhớ một quá trình có thể giữ hay nếu hình PHP của bạn giới hạn kích thước của tải lên tập tin.

"filesize_response"
- Làm gì với tập tin mà vượt quá các giới hạn kích thước của tải lên (nếu tồn tại). False = Danh sách trắng; True = Danh sách đen [Mặc định].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- Nếu hệ thống của bạn chỉ cho phép các loại tệp cụ thể được tải lên, hay nếu hệ thống của bạn từ chối một cách rõ ràng các loại tập tin cụ thể, xác định các loại tập tin trong danh sách trắng, danh sách đen và danh sách xám có thể tăng tốc độ quét được tiến hành bằng cách cho phép các kịch bản bỏ qua các loại tập tin nhất định. Định dạng là CSV (dấu phẩy ngăn cách giá trị). Nếu bạn muốn quét tất cả mọi thứ, thay vì sử dụng danh sách trắng, danh sách đen hay danh sách xám, để lại những biến trống; Làm như vậy sẽ vô hiệu hóa danh sách trắng/đen/xám.
- Thứ tự hợp lý của chế biến là:
  - Nếu loại tệp là trên danh sách trắng, không quét và không chặn các tập tin, và không kiểm tra các tập tin chống lại danh sách đen hay danh sách xám.
  - Nếu loại tệp là trên danh sách đen, không quét các tập tin nhưng chặn nó dù sao, và không kiểm tra các tập tin chống lại danh sách xám.
  - Nếu danh sách xám là trống hay nếu danh sách xám không phải là trống và các loại tệp là danh sách xám, quét các tập tin như bình thường và xác định xem có chặn nó dựa trên kết quả của quá trình quét, nhưng nếu danh sách xám không phải là trống và các loại tệp không phải trên danh sách xám, điều trị các tập tin như thể nó là trên danh sách đen, vì thế không quét nó nhưng chặn nó dù sao.

"check_archives"
- Cố gắng để kiểm tra nội dung của kho lưu trữ? False = Không kiểm tra; True = Kiểm tra [Mặc định].
- Tại thơi điểm nay, các chỉ định dạng kho lưu trữ và nén được hỗ trợ là BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR và ZIP (định dạng kho lưu trữ và nén RAR, CAB, 7z và vân vân không được hỗ trợ tại thơi điểm nay).
- Đây không phải là hoàn hảo! Trong khi tôi rất khuyên bạn nên giữ này được kích hoạt, tôi không thể đảm bảo nó sẽ luôn luôn tìm thấy tất cả mọi thứ.
- Cũng lưu ý kho lưu trữ kiểm tra là không đệ quy cho PHAR hay ZIP.

"filesize_archives"
- Thừa kế danh sách đen/trắng cho kích thước của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều); True = Vâng [Mặc định].

"filetype_archives"
- Thừa kế danh sách đen/trắng cho loại tệp của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều) [Mặc định]; True = Vâng.

"max_recursion"
- Tối đa đệ quy chiều sâu giới hạn cho kho lưu trữ. Mặc định = 10.

"block_encrypted_archives"
- Phát hiện và chặn kho lưu trữ được mã hóa? Bởi vì phpMussel không thể quét các nội dung của kho lưu trữ được mã hóa, nó có thể mã hóa kho lưu trữ có thể được sử dụng bởi một kẻ tấn công như một phương tiện cố gắng để vượt qua phpMussel, máy quét chống vi rút và bảo vệ khác như. Hướng dẫn phpMussel để ngăn chặn bất kỳ kho lưu trữ mà nó phát hiện được mã hóa có thể giúp giảm nguy cơ nào liên kết với những khả năng này. False = Không; True = Vâng [Mặc định].

####"attack_specific" (Thể loại)
Cấu hình chống lại tấn công cụ thể.

Phát hiện của tấn công tắc kè hoa: False = Tắt; True = Trên.

"chameleon_from_php"
- Tìm kiếm cho định danh PHP trong các tập tin mà không phải là PHP cũng không phải là kho lưu trữ được công nhận.

"chameleon_from_exe"
- Tìm kiếm cho định danh tập tin thực thi trong các tập tin mà không phải là tập tin thực thi cũng không phải là kho lưu trữ được công nhận, và cho tập tin thực thi tập tin mà có định danh sai.

"chameleon_to_archive"
- Tìm kiếm cho kho lưu trữ mà có định danh sai (Được hỗ trợ: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Tìm kiếm cho tài liệu văn phòng mà có định danh sai (Được hỗ trợ: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Tìm kiếm cho hình ảnh mà có định danh sai (Được hỗ trợ: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Tìm kiếm cho tập tin PDF mà có định danh sai.

"archive_file_extensions" và "archive_file_extensions_wc"
- Được công nhận mở rộng cho tập tin kho lưu trữ (định dạng là CSV; chỉ nên thêm hay loại bỏ khi có vấn đề xảy ra; loại bỏ không cần thiết có thể gây ra sai tích cực để xuất hiện cho tập tin kho lưu trữ, trong khi thêm không cần thiết sẽ trong bản chất danh sách trắng những gì bạn đang thêm từ phát hiện cụ tấn công; sửa đổi với cách thận trọng; cũng lưu ý rằng điều này không có tác dụng liên quan đến những gì kho lưu trữ có thể và không thể được phân tích ở nội dung cấp). Danh sách này, như là mặc định, liệt kê các định dạng sử dụng phổ biến nhất trên phần lớn các hệ thống và CMS, nhưng là cố tình không nhất thiết phải toàn diện.

"general_commands"
- Tìm kiếm nội dung của tập tin cho statement (báo cáo) và lệnh chung như thế `eval()` và `exec()`? False = Không kiểm tra [Mặc định]; True = Kiểm tra. Vô hiệu hóa tùy chọn này nếu bạn dự định tải lên những việc sau đây để một hệ thống hay CMS của bạn thông qua trình duyệt của bạn: PHP, JavaScript, HTML, python, perl, vân vân. Kích hoạt tùy chọn này nếu bạn không có bất kỳ sự bảo vệ thêm trên hệ thống của bạn và không có ý định để tải lên các tập tin đó. Nếu bạn sử dụng an ninh bổ sung kết hợp với phpMussel (như thế ZB Block), không cần phải kích hoạt tùy chọn này, bởi vì hầu hết những gì phpMussel sẽ tìm (trong bối cảnh các tùy chọn này) là sự trùng lặp của bảo vệ rằng sẽ rất có thể đã được cung cấp.

"block_control_characters"
- Chặn bất kỳ tập tin có chứa bất kỳ ký tự điều khiển (khác hơn so với dòng mới)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Nếu bạn _**CHỈ**_ tải lên văn bản thô, thế thì bạn có thể kích hoạt tùy chọn này để cung cấp một số bảo vệ bổ sung để hệ thống của bạn. Tuy nhiên, nếu bạn tải lên bất cứ điều gì khác hơn văn bản thô, cho phép điều này có thể dẫn đến sai tích cực. False = Không chặn [Mặc định]; True = Chặn.

"corrupted_exe"
- Tập tin bị hỏng và phân tích lỗi. False = Bỏ qua; True = Chặn [Mặc định]. Phát hiện và chặn khả thi tập tin PE (portable executable / thực thi di động) bị hỏng? Thường (nhưng không phải lúc nào), khi khía cạnh cụ thể của một tập tin PE đang bị hỏng hay không thể được phân tích chính xác, nó có thể chỉ ra một nhiễm vi rút. Các quy trình được sử dụng bởi hầu hết các chương trình chống vi rút để phát hiện vi rút trong các tập tin PE đòi hỏi phải phân tích những tập tin theo một cách mà, nếu các lập trình viên của một vi rút là nhận thức của, cụ thể sẽ cố gắng để ngăn chặn, để cho phép vi rút của mình để không bị phát hiện.

"decode_threshold"
- Giới hạn tùy chọn hay ngưỡng cho chiều dài của dữ liệu thô trong đó các lệnh giải mã nên được phát hiện (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Giá trị là một số nguyên đại diện cho kích thước tập tin trong KB. Mặc định = 512 (512KB). Số không hay số null vô hiệu hóa các ngưỡng (loại bỏ bất kỳ giới hạn dựa trên kích cỡ tập tin).

"scannable_threshold"
- Giới hạn tùy chọn hay ngưỡng cho chiều dài của dữ liệu mà phpMussel được phép đọc và quét (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Giá trị là một số nguyên đại diện cho kích thước tập tin trong KB. Mặc định = 32768 (32MB). Số không hay số null vô hiệu hóa các ngưỡng. Nói chung, giá trị này không nên được ít hơn kích thước trung bình của tải lên tập tin bạn muốn và mong đợi để nhận được đến máy chủ hay trang mạng của bạn, không nên được ít hơn tùy chọn filesize_limit, và không nên được ít hơn khoảng một phần năm tổng số cấp phát bộ nhớ cấp cho PHP thông qua tập tin cấu hình `php.ini`. Tùy chọn này tồn tại để cố gắng ngăn chặn phpMussel từ việc sử dụng quá nhiều bộ nhớ (mà sẽ ngăn chặn nó từ việc có thể quét các tập tin thành công trên một kích thước tập tin nhất định).

####"compatibility" (Thể loại)
Cấu hình khả năng tương thích cho phpMussel.

"ignore_upload_errors"
- Nói chung, tùy chọn này nên bị vô hiệu hóa, trừ khi nó cần thiết cho chức năng đúng của phpMussel trên hệ thống cụ thể của bạn. Thông thường, khi bị vô hiệu, khi phpMussel phát hiện sự hiện diện của elements (yếu tố) trong array `$_FILES`, nó sẽ cố gắng để bắt đầu quét của các tập tin mà những yếu tố đại diện, và, nếu những yếu tố này là trống, phpMussel sẽ trả về thông báo lỗi. Đây là hành vi thích hợp cho phpMussel. Tuy nhiên, đối với một số CMS, phần tử rỗng trong `$_FILES` có thể xảy ra như là kết quả của các hành vi tự nhiên của những CMS, hay lỗi có thể được báo cáo khi không có bất kỳ, và trong trường hợp này, các hành vi tự nhiên cho phpMussel sẽ gây trở ngại với các hành vi bình thường của những CMS. Nếu một tình huống như vậy xảy ra cho bạn, bật tùy chọn này sẽ hướng dẫn phpMussel không cố gắng để bắt đầu quét cho phần tử rỗng, bỏ qua chúng khi tìm thấy và không trả lại bất kỳ thông báo lỗi liên quan, do đó cho phép tiếp tục của yêu cầu trang. False = TẮT; True = TRÊN.

"only_allow_images"
- Nếu bạn chỉ mong đợi hay chỉ có ý định để cho phép hình ảnh để được tải lên hệ thống hay CMS của bạn, và nếu bạn hoàn toàn không yêu cầu bất kỳ tập tin khác so với hình ảnh để được tải lên hệ thống hay CMS của bạn, tùy chọn này nên được kích hoạt, nhưng nếu không nên bị vô hiệu hóa. Nếu tùy chọn này được kích hoạt, nó sẽ hướng dẫn phpMussel để ngăn chặn bất kỳ tải lên bừa bãi xác định là các tập tin không phải hình ảnh, mà không cần quét chúng. Điều này có thể làm giảm thời gian xử lý và sử dụng bộ nhớ cho tải lên cố gắng của các tập tin không phải hình ảnh. False = TẮT; True = TRÊN.

####"heuristic" (Thể loại)
Cấu hình cho "heuristic" (tìm kiếm / khám phá / tự học).

"threshold"
- Có một số chữ ký của phpMussel mà được dự định để xác định đáng ngờ và phẩm chất của các tập tin khả năng độc hại từ đang được tải lên mà không có trong tự xác định các tập tin đang được tải lên cụ thể như là độc hại. Giá trị "threshold" này nói với phpMussel tổng trọng lượng tối đa của đáng ngờ và phẩm chất của các tập tin khả năng độc hại đang được tải lên đó là phép trước những tập tin đang được gắn cờ là độc hại. Định nghĩa về trọng lượng trong bối cảnh này là tổng số đáng ngờ và phẩm chất tiềm ẩn độc hại được xác định. Theo mặc định, giá trị này sẽ được thiết lập để 3. Một giá trị thấp hơn nói chung sẽ cho kết quả trong một sự xuất hiện cao hơn của sai tích cực nhưng một số cao hơn các tập tin độc hại được gắn cờ, trong khi một giá trị cao hơn nói chung sẽ cho kết quả trong một sự xuất hiện thấp hơn của sai tích cực nhưng một số thấp hơn các tập tin độc hại được gắn cờ. Nói chung, nó là tốt nhất để có giá trị này tại mặc định của nó trừ khi bạn đang gặp phải các vấn đề liên quan đến nó.

####"virustotal" (Thể loại)
Cấu hình cho VirusTotal.com.

"vt_public_api_key"
- Nếu bạn muốn, phpMussel có thể quét tập tin sử dụng các Virus Total API như một cách để cung cấp bảo vệ tăng cường rất nhiều chống lại vi rút, trojan, phần mềm độc hại và các mối đe dọa khác. Theo mặc định, quét của tập tin sử dụng các Virus Total API bị vô hiệu hóa. Để kích hoạt nó, một khóa API từ Virus Total là cần thiết. Do những lợi ích đáng kể rằng điều này có thể cung cấp cho bạn, nó là một cái gì đó mà tôi rất khuyên bạn nên cho phép. Xin hãy lưu ý, tuy nhiên, rằng để sử dụng các Virus Total API, bạn _**PHẢI**_ đồng ý với điều khoản dịch vụ của họ và bạn _**PHẢI**_ tuân theo tất cả các hướng dẫn như mô tả của các tài liệu của Virus Total! Bạn KHÔNG được phép để sử dụng tính năng hội nhập này TRỪ KHI:
  - You have read và agree to các Terms of Service of Virus Total và its API. Các Terms of Service of Virus Total và its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/). @FROM HERE@
  - You have read và you understand, at a minimum, các preamble of các Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). Các Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/).

Lưu ý: Nếu scanning files using các Virus Total API is disabled, you won't need to review any of các options in this category (`virustotal`), bởi vì none of them will do anything nếu this is disabled. To acquire a Virus Total API key, from anywhere on their website, click các "Join our Community" link located towards các top-right of các page, enter in các information requested, và click "Sign up" when done. Follow all instructions supplied, và when you've got your public API key, copy/paste that public API key to các `vt_public_api_key` option of các `phpmussel.ini` tập tin cấu hình.

"vt_suspicion_level"
- Theo mặc định, phpMussel will restrict which files it scans using các Virus Total API to those files that it considers "suspicious". You can optionally adjust this restriction by changing các value of các `vt_suspicion_level` option.
- `0`: Files are only considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight. This would effectively mean that use of các Virus Total API would be cho một second opinion for when phpMussel suspects that a tập tin may potentially be malicious, but can't entirely rule out that it may also potentially be benign (non-malicious) và therefore would otherwise normally not block it hoặc flag it as being malicious.
- `1`: Files are considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight, nếu they're known to be executable (PE files, Mach-O files, ELF/Linux files, etc), hoặc nếu they're known to be of a format that could potentially contain executable dữ liệu (such as executable macros, DOC/DOCX files, kho lưu trữ files như thế RARs, ZIPS và etc). This is các default và recommended suspicion level to apply, effectively meaning that use of các Virus Total API would be cho một second opinion for when phpMussel doesn't initially find anything malicious hoặc wrong with a tập tin that it considers to be suspicious và therefore would otherwise normally not block it hoặc flag it as being malicious.
- `2`: All files are considered suspicious và should be scanned using các Virus Total API. I don't generally recommend applying this suspicion level, due to các risk of reaching your API quota much quicker than would otherwise be các case, but there are certain circumstances (such as when các webmaster hoặc hostmaster has very little faith hoặc trust whatsoever in any of các uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level, all files not normally blocked hoặc flagged as being malicious would be scanned using các Virus Total API. Note, however, that phpMussel will cease using các Virus Total API when your API quota has been reached (regardless of suspicion level), và that your quota will likely be reached much faster when using this suspicion level.

Lưu ý: Regardless of suspicion level, any files that are either blacklisted hoặc whitelisted by phpMussel won't be scanned using các Virus Total API, bởi vì those such files would've already been declared as either malicious hoặc benign by phpMussel by các time that they would've otherwise been scanned by các Virus Total API, và therefore, additional scanning wouldn't be required. Các ability of phpMussel to scan files using các Virus Total API is intended to build further confidence for whether a tập tin is malicious hoặc benign in those circumstances where phpMussel itself isn't entirely certain as to whether a tập tin is malicious hoặc benign.

"vt_weighting"
- phpMussel nên apply các results of scanning using các Virus Total API as detections hoặc as detection weighting? This option exists, bởi vì, although scanning a tập tin using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious files being caught), it can also result in a higher number of false positives, và therefore, in some circumstances, các results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. Nếu a value of 0 is used, các results of scanning using các Virus Total API will be applied as detections, và therefore, nếu any engine used by Virus Total flags các tập tin being scanned as being malicious, phpMussel will consider các tập tin to be malicious. Nếu any other value is used, các results of scanning using các Virus Total API will be applied as detection weighting, và therefore, các number of engines used by Virus Total that flag các tập tin being scanned as being malicious will serve as a confidence score (or detection weighting) for whether các tập tin being scanned should be considered malicious by phpMussel (the value used will represent các minimum confidence score hoặc weight required in order to be considered malicious). A value of 0 is used by default.

"vt_quota_rate" và "vt_quota_time"
- Theo tài liệu VirusTotal API, nó được giới hạn tối đa là 4 yêu cầu của bất kỳ chất trong bất kỳ khung thời gian 1 phút nào. Nếu bạn chạy một honeyclient, honeypot hay bất kỳ tự động hóa khác sẽ là cung cấp các nguồn lực để VirusTotal và không chỉ sẽ là lấy báo cáo bạn có quyền được một hạn ngạch có yêu cầu cao hơn. Theo mặc định, phpMussel nghiêm sẽ tuân thủ những hạn chế, nhưng do khả năng của các hạn ngạch yêu cầu đang được tăng lên, hai tùy chọn này được cung cấp như một phương tiện để bạn có thể hướng dẫn phpMussel như những gì giới hạn nó phải tuân thủ. Trừ khi bạn đã được hướng dẫn làm như vậy, nó không được khuyến khích cho bạn để tăng các giá trị, nhưng, nếu bạn đã gặp phải vấn đề liên quan đến hạn ngạch của bạn, giảm các giá trị _**CÓ THỂ**_ đôi khi giúp bạn trong việc đối phó với những vấn đề này. Hạn ngạch yêu cầu của bạn được xác định như `vt_quota_rate` yêu cầu của bất kỳ chất trong bất kỳ khung thời gian `vt_quota_time` phút nào.

####"urlscanner" (Thể loại)
Cấu hình cho máy quét URL.

"urlscanner"
- Built into phpMussel is a URL scanner, capable of detecting malicious URLs from within any dữ liệu hoặc files scanned. To enable các URL scanner, set các `urlscanner` option to true; To disable it, set this option to false.

Lưu ý: Nếu máy quét URL bị vô hiệu hóa, bạn sẽ không cần phải xem xét bất kỳ tùy chọn trong phần này (`urlscanner`), bởi vì không một ai trong số họ sẽ làm bất cứ điều gì nếu bị vô hiệu hóa này.

Cấu hình cho tra cứu API của máy quét URL.

"lookup_hphosts"
- Enables API lookups to các [hpHosts](http://hosts-file.net/) API when set to true. hpHosts doesn't require an API key for performing API lookups.

"google_api_key"
- Enables API lookups to các Google Safe Browsing API when các necessary API key is defined. Google Safe Browsing API lookups requires an API key, which can be obtained from [Here](https://console.developers.google.com/).
- Lưu ý: The cURL extension is required in order to use this feature.

"maximum_api_lookups"
- Số lượng tối đa cho phép của tra cứu API để thực hiện mỗi quét lặp cá nhân. Bởi vì mỗi tra cứu API thêm sẽ thêm vào tổng thời gian cần thiết để hoàn thành mỗi quét lặp, bạn có thể muốn để quy định một giới hạn để đẩy nhanh các quá trình quét tổng thể. Khi thiết lập để 0, không số lượng tối đa cho phép sẽ được áp dụng. Đặt 10 theo mặc định.

"maximum_api_lookups_response"
- Phải làm gì nếu số lượng tối đa cho phép của tra cứu API được vượt quá? False = Không làm gì cả (tiếp tục chế biến) [Mặc định]; True = Dấu/Chặn các tập tin.

"cache_time"
- Kết quả tra cứu API nên được lưu trữ trong (trong giây) bao lâu? Mặc định là 3600 giây (1 giờ).

####"template_data" (Thể loại)
Cấu hình cho mẫu thiết kế và chủ đề.

Dữ liệu mẫu thiết kế liên quan đến đầu ra HTML sử dụng để tạo ra các thông báo "Sự tải lên đã bị từ chối" hiển thị cho người dùng khi một tải lên tập tin bị chặn. Nếu bạn đang sử dụng chủ đề tùy chỉnh cho phpMussel, đầu ra HTML có nguồn gốc từ tập tin `template_custom.html`, và nếu không thì, đầu ra HTML có nguồn gốc từ tập tin `template.html`. Biến bằng văn bản cho phần này của tập tin cấu hình được xử lý để đầu ra HTML bằng cách thay thế bất kỳ tên biến được bao quanh bởi các dấu ngoặc nhọn tìm thấy trong đầu ra HTML với các dữ liệu biến tương ứng. Ví dụ, ở đâu `foo="bar"`, bất kỳ trường hợp `<p>{foo}</p>` tìm thấy trong đầu ra HTML sẽ trở thành `<p>bar</p>`.

"css_url"
- Tập tin mẫu thiết kế cho chủ đề tùy chỉnh sử dụng thuộc tính CSS bên ngoài, trong khi các tập tin mẫu thiết kế cho các chủ đề mặc định sử dụng thuộc tính CSS nội bộ. Để hướng dẫn phpMussel để sử dụng các tập tin mẫu thiết kế cho chủ đề tùy chỉnh, xác định các địa chỉ HTTP cho các tập tin CSS chủ đề tùy chỉnh của bạn sử dụng các biến số `css_url`. Nếu bạn để cho biến số này chỗ trống, phpMussel sẽ sử dụng các tập tin mẫu thiết kế cho các chủ đề mặc định.

---


###7. <a name="SECTION7"></a>ĐỊNH DẠNG CỦA CHỬ KÝ

####*CHỮ KÝ CHO TÊN TẬP TIN*
Tất cả các chữ ký cho tên tập tin tuân theo các định dạng:

`NAME:FNRX`

NAME là tên cho các chữ ký và FNRX là mô hình biểu thức chính quy để kiểm tra tên tập tin (không mã hóa).

####*CHỮ KÝ DỰA MD5*
Tất cả các chữ ký dựa MD5 tuân theo các định dạng:

`HASH:FILESIZE:NAME`

HASH là băm MD5 của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và NAME là tên cho các chữ ký.

####*CHỮ KÝ SIÊU DỮ LIỆU KHO LƯU TRỮ*
Tất cả các chữ ký siêu dữ liệu kho lưu trữ tuân theo các định dạng:

`NAME:FILESIZE:CRC32`

NAME là tên cho các chữ ký, FILESIZE là tổng dung lượng (không nén) của một tập tin chứa trong kho lưu trữ và CRC32 là băm CRC32 của tập tin đó.

####*CHỮ KÝ PHẦN PE*
Tất cả các chữ ký phần PE tuân theo các định dạng:

`SIZE:HASH:NAME`

HASH là băm MD5 của một phần của một tập tin PE, SIZE là tổng kích thước của phần đó và NAME là tên cho các chữ ký.

####*CHỮ KÝ KÉO DÀI PE*
Tất cả các chữ ký kéo dài PE tuân theo các định dạng:

`$VAR:HASH:SIZE:NAME`

$VAR là tên của các biến PE để kiểm tra, HASH là băm MD5 của biến đó, SIZE là tổng kích thước biến và NAME là tên cho các chữ ký.

####*CHỮ KÝ DANH SÁCH TRẮNG*
Tất cả các chữ ký danh sách trắng tuân theo các định dạng:

`HASH:FILESIZE:TYPE`

HASH là băm MD5 của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và TYPE là các loại chữ ký các danh sách trắng tập tin là để được miễn dịch chống lại.

####*CHỮ KÝ KÉO DÀI PHỨC TẠP*
Chữ ký kéo dài phức tạp là khá khác nhau với các loại khác của chữ ký có thể với phpMussel, trong ý nghĩa rằng những gì họ đang kiểm tra cho được quy định bởi những chữ ký tự và họ có thể kiểm tra cho nhiều tiêu chí. Các tiêu chí được giới hạn bởi ";" và các loại kiểm tra và dữ liệu kiểm tra cho từng tiêu chí được giới hạn bởi ":" như vậy mà định dạng cho những chữ ký trông hơi giống như:

`$Biến_Số1:Một_Số_Dữ_Liệu;$Biến_Số2:Một_Số_Dữ_Liệu;Tên_Chữ_Ký`

####*MỌI THỨ KHÁC*
Tất cả các chữ ký khác làm theo các định dạng:

`NAME:HEX:FROM:TO`

NAME là tên cho các chữ ký và HEX là một phân khúc thập lục phân mã hóa của các tập tin dự định để được xuất hiện bởi các chữ ký. FROM và TO là thông số tùy chọn, cho thấy nơi trong nguồn dữ liệu, bắt đầu và kết thúc, để kiểm tra lại.

####*BIỂU THỨC CHÍNH QUY*
Bất kỳ cách thức biểu thức chính quy hiểu và xử lý một cách chính xác qua PHP cũng nên được hiểu hiểu và xử lý một cách chính xác qua phpMussel và chữ ký của nó. Tuy nhiên, tôi muốn đề nghị lấy hết sức thận trọng khi viết chữ ký biểu thức chính quy mới, bởi vì, nếu bạn không hoàn toàn chắc chắn bạn đang làm gì vậy, có thể có kết quả rất bất thường hay bất ngờ. Nhìn vào các mã nguồn nếu bạn không hoàn toàn về bối cảnh rằng họ đang phân tích cú pháp. Ngoài ra, nhớ lại rằng tất cả mọi thứ (ngoại trừ tên tập tin, cú pháp, siêu dữ liệu kho lưu trữ và mẫu MD5) phải được mã hóa hệ thập lục phân!

####*NƠI ĐỂ ĐẶT CHỮ KÝ TÙY CHỈNH?*
Chỉ đặt chữ ký tùy chỉnh trong tập tin có nghĩa là cho ký tùy chỉnh trong. Chúng chứa "_custom" trong tên tập tin của họ. Bạn nên tránh chỉnh sửa các tập tin chữ ký mặc định, trừ khi bạn biết chính xác những gì bạn đang làm, bởi vì, ngoài việc thực hành tốt nói chung và ngoài việc giúp bạn phân biệt giữa chữ ký của riêng bạn và các tập tin chữ ký mặc định, rất tốt để chỉ chỉnh sửa các tập tin có nghĩa đó là cho chỉnh sửa, bởi vì giả mạo với các tập tin chữ ký mặc định có thể gây ra cho họ ngừng làm việc một cách chính xác, bởi vì các tập tin "map": Họ nói với phpMussel nơi để tìm trong các tập tin chữ ký cho chữ ký, và họ có thể trở thành không đồng bộ nếu giả mạo. Bạn có thể đặt hầu như bất cứ điều gì bạn muốn vào chữ ký tùy chỉnh của bạn,miễn là bạn làm theo cú pháp chính xác. Tuy nhiên, hãy cẩn thận để kiểm tra chữ ký mới cho giả tích cực trước nếu bạn có ý định chia sẻ hoặc sử dụng chúng trong một môi trường sống.

####*GIẢI THÍCH CHỮ KÝ*
Sau đây là một danh sách các loại chữ ký được sử dụng bởi phpMussel:
- "Chữ ký ASCII bình thường" (ascii_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ ký kéo dài phức tạp" (coex_*). Chữ ký của hỗn hợp kiểu.
- "Chữ ký ELF" (elf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin ELF.
- "Chữ ký PE" (exe_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác định như các định dạng PE.
- "Chữ ký cho tên tập tin" (filenames_*). Kiểm tra đối với các tên tập tin của mỗi tập tin dự định để quét.
- "Chữ ký chung" (general_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ ký đồ họa" (graphics_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin công nhận đồ họa.
- "Lệnh chung" (hex_general_commands.csv). Kiểm tra đối với các nội dung của mỗi tập tin không trong danh sách trắng và nhắm mục tiêu cho quét.
- "Chữ ký HTML bình thường" (html_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin HTML.
- "Chữ ký Mach-O" (macho_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin Mach-O.
- "Chữ ký email" (mail_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin EML.
- "Chữ ký dựa MD5" (md5_*). Kiểm tra đối với các băm MD5 của nội dung và các kích thước tập tin của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ ký siêu dữ liệu kho lưu trữ" (metadata_*). Kiểm tra đối với các băm CRC32 và kích thước của tập tin đầu tiên chứa bên trong mỗi kho lưu trữ không trong danh sách trắng và nhắm mục tiêu cho quét.
- "Chữ ký OLE" (ole_*). Kiểm tra đối với các nội dung của mỗi OLE không thuộc danh sách trắng và dự định để quét.
- "Chữ ký PDF" (pdf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin PDF.
- "Chữ ký phần PE" (pe_*). Kiểm tra đối với các băm MD5 và các kích thước của mỗi phần của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác định như các định dạng PE.
- "Chữ ký kéo dài PE" (pex_*). Kiểm tra đối với băm MD5 và kích thước của các biến trong mỗi tập tin không trong danh sách trắng, nhắm mục tiêu cho quét và xác định như các định dạng PE.
- "Chữ ký Shockwave" (swf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin Shockwave.
- "Chữ ký danh sách trắng" (whitelist_*). Kiểm tra đối với các băm MD5 các nội dung và kích thước tập tin của mỗi tập tin nhắm mục tiêu cho quét. Tập tin xác định sẽ được miễn dịch để được xác định bởi các loại chữ ký đề cập trong nhập danh sách trắng của họ.
- "Chữ ký XML/XDP" (xmlxdp_*). Kiểm tra đối với bất kỳ XML/XDP tìm thấy trong bất kỳ tập tin không trong danh sách trắng và nhắm mục tiêu cho quét.
(Hãy lưu ý bất kỳ của các chữ ký có thể bị vô hiệu hóa thông qua `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>NHỮNG VẤN ĐỀ HỢP TƯƠNG TÍCH

####PHP và PCRE
- phpMussel cần PHP và PCRE để thực hiện và hoạt động. Nếu không có PHP, hoạc không có PCRE thêm của PHP, phpMussel sẽ không thực hiện và hoạt động bình thường. Bạn nên chắc chắc rằng hệ thống của bạn có PHP và PCRE cài vào và có sẵn trước khi tải và cài đặt phpMussel.

####KHẢ NĂNG TƯƠNG THÍCH PHẦN MỀM CHỐNG VI RÚT

Cho hầu hết các phần, phpMussel sẽ tương hợp với hầu hết các phần mềm quét vi rút khác. Nhưng mà, có một số người sử dụng trong quá khứ đã báo cáo một số vấn đề. Thông tin dưới đây là từ VirusTotal.com, và nó miêu tả một số giả tích cực báo cáo bởi các chương trình chống vi rút khác nhau chống phpMussel. Mặc dù thông tin này không đảm bảo nếu bạn gặp phải vấn đề tương hợp giữa phpMussel và phần mềm chống vi rút của bạn, nếu phần mềm chống vi rút của bạn được ghi nhận là cách gắn cờ chống lại phpMussel, bạn nên tắt nó trước khi sử dụng phpMussel hoặc nên xét các lựa chọn khác cho một trong hai phần mềm chống vi rút của bạn hoặc phpMussel.

Thông tin này được cập nhật lần cứơi vào ngày 21 Tháng Tư 2016 và có thể áp dụng cho phpMussel công bố hai loại phiên bản nhỏ mới nhất (v0.10.0-v1.0.0) vào thời gian cái này được viết.

| Chương trình quét    |  Kết quả                             |
|----------------------|--------------------------------------|
| Ad-Aware             |  Không có vấn đề                     |
| AegisLab             |  Không có vấn đề                     |
| Agnitum              |  Không có vấn đề                     |
| AhnLab-V3            |  Không có vấn đề                     |
| Alibaba              |  Không có vấn đề                     |
| ALYac                |  Không có vấn đề                     |
| AntiVir              |  Không có vấn đề                     |
| Antiy-AVL            |  Không có vấn đề                     |
| Arcabit              |  Không có vấn đề                     |
| Avast                |  Báo cáo "JS:ScriptSH-inf [Trj]"     |
| AVG                  |  Không có vấn đề                     |
| Avira                |  Không có vấn đề                     |
| AVware               |  Không có vấn đề                     |
| Baidu                |  Báo cáo "VBS.Trojan.VBSWG.a"        |
| Baidu-International  |  Không có vấn đề                     |
| BitDefender          |  Không có vấn đề                     |
| Bkav                 |  Báo cáo "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell"|
| ByteHero             |  Không có vấn đề                     |
| CAT-QuickHeal        |  Không có vấn đề                     |
| ClamAV               |  Không có vấn đề                     |
| CMC                  |  Không có vấn đề                     |
| Commtouch            |  Không có vấn đề                     |
| Comodo               |  Không có vấn đề                     |
| Cyren                |  Không có vấn đề                     |
| DrWeb                |  Không có vấn đề                     |
| Emsisoft             |  Không có vấn đề                     |
| ESET-NOD32           |  Không có vấn đề                     |
| F-Prot               |  Không có vấn đề                     |
| F-Secure             |  Không có vấn đề                     |
| Fortinet             |  Không có vấn đề                     |
| GData                |  Không có vấn đề                     |
| Ikarus               |  Không có vấn đề                     |
| Jiangmin             |  Không có vấn đề                     |
| K7AntiVirus          |  Không có vấn đề                     |
| K7GW                 |  Không có vấn đề                     |
| Kaspersky            |  Không có vấn đề                     |
| Kingsoft             |  Không có vấn đề                     |
| Malwarebytes         |  Không có vấn đề                     |
| McAfee               |  Báo cáo "New Script.c"              |
| McAfee-GW-Edition    |  Báo cáo "New Script.c"              |
| Microsoft            |  Không có vấn đề                     |
| MicroWorld-eScan     |  Không có vấn đề                     |
| NANO-Antivirus       |  Không có vấn đề                     |
| Norman               |  Không có vấn đề                     |
| nProtect             |  Không có vấn đề                     |
| Panda                |  Không có vấn đề                     |
| Qihoo-360            |  Báo cáo "Script/Trojan.Script.393"  |
| Rising               |  Không có vấn đề                     |
| Sophos               |  Không có vấn đề                     |
| SUPERAntiSpyware     |  Không có vấn đề                     |
| Symantec             |  Không có vấn đề                     |
| Tencent              |  Không có vấn đề                     |
| TheHacker            |  Không có vấn đề                     |
| TotalDefense         |  Không có vấn đề                     |
| TrendMicro           |  Không có vấn đề                     |
| TrendMicro-HouseCall |  Không có vấn đề                     |
| VBA32                |  Không có vấn đề                     |
| VIPRE                |  Không có vấn đề                     |
| ViRobot              |  Không có vấn đề                     |
| Zillya               |  Không có vấn đề                     |
| Zoner                |  Không có vấn đề                     |

---


Lần cuối cập nhật: 3 Tháng Sáu 2016 (2016.06.03).
