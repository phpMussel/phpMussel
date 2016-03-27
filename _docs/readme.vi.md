## Tài liệu của phpMussel (Tiếng Việt).

### Nội dung
- 1. [LỜI GIỚI THIỆU](#SECTION1)
- 2A. [CẢCH ĐỂCÀI ĐẶT (CHO CÁC TRANG WEB CHỦ)](#SECTION2A)
- 2B. [CẢCH CÀI ĐẶT (CHO CLI)](#SECTION2B)
- 3A. [CÁCH SỬ DỤNG (CHO CÁC TRANG WEB CHỦ)](#SECTION3A)
- 3B. [CÁCH SỬ DỤNG (CHO CLI)](#SECTION3B)
- 4A. [LỆNH CHO TRÌNH DUYỆT](#SECTION4A)
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

Chân thành cám ơn Sourceforge và GitHub đã lưu trữ các tập tin của chương trình này, và [Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55) đã lưu trữ diễn đàn thảo luận của phpMussel, và các chữ ký sử dụng bởi phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) vân vân, và chân thành cảm ơn những người đã ủng hộ chương trình này, và bất cứ ai khác mà tôi quên cảm ơn, và bạn, đã sử dụng bản này.

Tài liệu này và các gói liên quan của nó có thể được tải về miễn phí từ:
- [Sourceforge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/Maikuolan/phpMussel/).

---


###2A. <a name="SECTION2A"></a>CẢCH ĐỂCÀI ĐẶT (CHO CÁC TRANG WEB CHỦ)

Tôi hy vọng sẽ giản hóa quá trình này bằng cách thực hiện một cài đặt tại một thời điểm nào trong tương lai không quá xa, nhưng cho đến lúc đó, bạn hảy làm theo hướng dẫn để có thể cho phpMussel làm việc trên hầu hết các hệ thống và CMS:

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Từ đây, bạn sẽ muốn đặt nội dung ở một nơi trên máy chủ hoặc CMS của bạn. Một thư mục chẳng hạn như `/public_html/phpmussel/` hay tương tự (mặc dù sự lựa chọn của bạn không quan trọng, miễn là nó an toàn và bạn hài lòng với sự lựa chọn) sẽ đủ.. *Trước khi bạn bắt đầu tải lên, hảy tiếp tục đọc..*

2) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hoặc chưa có kinh nghiệm không nên chọn), hảy mở `phpmussel.ini` (nằm ớ trong `vault`) - Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

3) Tải nội dung lên (phpMussel và tập tin của nó) vào thư mục bạn đã chọn trước (bạn không cần phải dùng tập tin `*.txt`/`*.md`, nhưng chủ yếu, bạn nên tải lên tất cả mọi thứ).

4) CHMOD cái `vault` thư mục thành "777". Các thư mục chính lưu trữ các nội dung (một trong những cái bạn đã chọn trước), bình thường, có thể riêng, nhưng tình hình CHMOD nên kiểm tra, nếu bạn đã có vấn đề cho phép trong quá khứ về hệ thống của bạn (theo mặc định, nên giống như "755").

5) Tiếp theo, bạn sẽ cần "nối" phpMussel vào hệ thống của bạn hoặc CMS. Có một số cách mà bạn có thể "nối" bản chẳng hạn như phpMussel vào hệ thống hoạc CMS, nhưng cách đơn giản nhất là cần có bản vào cốt lõi ở đầu của tập tin hoạc hệ thống hoặc CMS của bạn (một mà thường sẽ luôn luôn được nạp khi ai đó truy cập bất kỳ trang nào trên trang web của bạn) bằng cách sử dụng một lời chỉ thị `require` hoạc `include`. Thường, cái nàu sẽ được lưu trong một thư mục như `/includes`, `/assets` hoạc `/functions`, và sẽ thường được gọi là `init.php`, `common_functions.php`, `functions.php` hoạc tương tự. Bạn sẽ cần tiềm ra tập tin nào cho trường hợp của bạn; Nếu bạn gặp khó khăn trong việc này, hãy truy cập diễn đàn hỗ trợ của phpMussel và cho chúng tôi biêt; Có thể là tôi họac các người dùng khác có có kinh nghiệm với các CMS mà bạn đang sử dụng (bạn phải biết mình đang sử dụng CMS nào), và như vậy, có thể cung cấp hỗ trợ trong trường hợp này. Để làm chuyện này [sử dụng `require` họac `include`], đánh các dòng mã sao đây vào đầu của cốt lõi của tập tin, thay thế các dây chứa bên trong các dấu ngoặc kép với địa chỉ chính xác của tập tin `phpmussel.php` (địa chỉ địa phương, chứ không phải địa chỉ HTTP; nó sẽ nhình gióng địa chỉ kho nói ở trên).

`<?php require '/user_name/public_html/phpmussel/phpmussel.php'; ?>`

Lưu tập tin, đóng lại, tải lên lại.

-- CÁCH KHÁC --

Nếu bạn đang sử dụng trang chủ Apache và nếu bạn có thể truy cập `php.ini`, bạn có thể sử dụng `auto_prepend_file` chỉ thị để thêm vào trước phpMussel bất cứ khi nào bất kỳ yêu cầu PHP được xin. Gióng như:

`auto_prepend_file = "/user_name/public_html/phpmussel/phpmussel.php"`

Hoạc cái này trong tập tin `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/phpmussel.php"`

6) Tại điểm này, bạn đã xong! Nhưng mà, bạn nên kiểm tra nó ra để đảm bảo nó hoạt động đúng. Để kiểm tra các tập tin tải lên bảo vệ, thử tải lên các tập tin thử nghiệm bao gồm trong gói dưới `_testfiles` vào trang web của bạn thông qua các phương pháp tải lên dựa trên trình duyệt thông thường của bạn. Nếu tất cả mọi thứ đang hoạt động, một tin nhắn sẽ xuất hiện từ phpMussel xác nhận là việc tải lên đã bị chặn thành công. Nếu không có gì xuất hiện, đây là điều biểu hiện cho một vấn đề với sự hoạt động. Nếu bạn đang sử dụng chức năng cao cấp, hoặc sử dụng các loại chức năng quét khác có thể với công cụ này, bạn nên thử nó ra với những điều đó để đảm bảo nó hoạt động như yêu cầu.

---


###2B. <a name="SECTION2B"></a>CẢCH CÀI ĐẶT (CHO CLI)

Tôi hy vọng sẽ giản hóa quá trình này bằng cách thực hiện một cài đặt tại một thời điểm nào trong tương lai không quá xa, nhưng cho đến lúc đó, bạn hảy làm theo hướng dẫn để có thể cho phpMussel hoạt động với CLI (hảy cẩn thận, vào lúc này hỗ trợ cho CLI chỉ áp dụng với hệ thống dựa trên Windows; Linux và các hệ thống khác sẽ sau trong phiên bản sau này của phpMussel):

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Một khi bạn đã hài lòng với vị trí của phpMussel, hày tiếp tục.

2) phpMussel cần PHP được cài đặt trên máy chủ để thực hiện. Nếu bạn không có PHP cài trên máy, xin hảy cài PHP, theo hướng dẫn được cung cấp bởi người cài đặt PHP.

3) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hoặc chưa có kinh nghiệm không nên chọn), hảy mở `phpmussel.ini` (nằm ớ trong `vault`) - Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

4) Tùy ý, bạn có thể sử dụng phpMussel trong chế độ CLI dể hơn với cách tạo ra tập tin lô để tự động tải PHP và phpMussel. Để làm điều này, mở một chương trình văn bản đơn giản như Notepad hoạc Notepad++, đánh vào đường dẫn đầy đủ cho tập tin `php.exe` trong thư mục cài đặt PHP của bạn, tiếp theo là một khoảng trống, theo sau là đường dẫn đầy đủ đến tập tin `phpmussel.php` trong thư mục cài đặt phpMussel của bạn, lưu tập tin với tư bổ sung ".bat" một nơi nào bạn sẽ tìm thấy dễ dàng, và nhấn đúp vào vào tập tin đó để chạy phpMussel trong tương lai.

5) Tại thời điểm này, bạ đã xong! Nhưng mà, bạn nên kiểm tra nó để đảm bảo sự hoạt động. Để kiểm tra phpMussel, chạy phpMussel và thử quét `_testfiles` thư mục cung cấp trong gói.

---


###3A. <a name="SECTION3A"></a>CÁCH SỬ DỤNG (CHO CÁC TRANG WEB CHỦ)

phpMussel sẽ có thể hoạt động một cách chính xác với yêu cầu tối thiểu từ bạn: Sau khi cài đặt nó, nó có thể được sử dụng ngay lập tức.

Quét tập tin tải lên là tự động và kích hoạt theo mặc định, như vậy không có gì là cần thiết từ bạn cho các chức năng đặc biệt này.

Tuy nhiên, bạn cũng có thể nói với phpMussel để quét tập tin cụ thể, thư mục và/hoặc lưu trữ. Để làm điều này, trước hết, bạn sẽ cần phải đảm bảo rằng các cấu hình thích hợp được thiết lập trong tập tin `phpmussel.ini` (`cleanup` phải được vô hiệu hóa), và khi thực hiện, trong một tập tin PHP được kết nối với phpMussel, sử dụng sau đây trong mã của bạn:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` có thể một string, hoặc một hoặc nhiều của array, và chỉ ra đó tập tin và/hoặc thư mục để quét.
- `$output_type` có thể boolean, và chỉ ra đó định dạng cho kết quả quét được trả về như. False hướng dẫn các chức năng để trả về kết quả là một số nguyên (trở lại kết quả của -3 chỉ ra rằng vấn đề gặp phải với các tập tin chữ ký hoặc tập tin chữ ký bản đồ và rằng họ có thể bị mất hoặc bị hỏng, -2 chỉ ra rằng dữ liệu bị hỏng đã được phát hiện trong quá trình quét và như vậy quét không hoàn thành, -1 chỉ ra rằng mở rộng hoặc bổ sung theo yêu cầu của PHP để thực hiện quá trình quét bị mất tích và như vậy quét không hoàn thành, 0 chỉ ra rằng mục tiêu quét không tồn tại và như vậy không có gì để quét, 1 chỉ ra rằng các mục tiêu đã được quét thành công và không có vấn đề đã được phát hiện, và 2 chỉ ra rằng các mục tiêu đã được quét thành công và vấn đề đã được phát hiện). True hướng dẫn các chức năng trả lại kết quả dưới dạng văn bản có thể đọc được con người. Ngoài ra, trong cả hai trường hợp, kết quả có thể được truy cập thông qua biến toàn cầu sau khi quét đã hoàn thành. Biến này là tùy chọn, mặc định là false.
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

Nếu bạn gặp bất kỳ sai tích cực, nếu bạn gặp một số điều mới bạn nghĩ rằng nên bị chặn, hoặc cho bất cứ điều gì khác có liên quan đến chữ ký, xin vui lòng liên hệ với tôi vì vậy mà tôi có thể thực hiện các thay đổi cần thiết, mà, nếu bạn không liên hệ với tôi, tôi có thể không nhất thiết phải nhận thức được.

Để vô hiệu hóa chữ ký đã bao gồm trong phpMussel (chẳng hạn như nếu bạn gặp một sai tích cực và bạn không thể loại bỏ nó), tham khảo các ghi chú cho các danh sách xám trong các phần Lệnh Cho Trình Duyệt của tập tin README này.

---


###3B. <a name="SECTION3B"></a>CÁCH SỬ DỤNG (CHO CLI)

Tham khảo phần "CẢCH CÀI ĐẶT (CHO CLI)" của tập tin README này.

Hãy nhận biết rằng, mặc dù các phiên bản tương lai của phpMussel nên hỗ trợ các hệ thống khác, tại thơi điểm nay, hỗ trợ cho chế độ CLI của phpMussel đã được tối ưu chỉ dành cho sử dụng trên hệ thống Windows (bạn có thể, tất nhiên, thử nó trên các hệ thống khác, nhưng tôi không thể đảm bảo nó sẽ làm việc như dự định).

Ngoài ra, ý thức được rằng phpMussel không phải là chức năng tương đương của một bộ chống vi rút hoàn thiện, và không giống như chống vi rút thông thường, nó không theo dõi bộ nhớ hoạt động hoặc phát hiện vi rút với sự tự phát! Nó sẽ chỉ phát hiện vi rút chứa trong các tập tin mà bạn nói với nó để quét.

---


###4A. <a name="SECTION4A"></a>LỆNH CHO TRÌNH DUYỆT

Once phpMussel has been installed and is correctly functioning on your system, if you've set the `script_password` and `logs_password` variables in your tập tin cấu hình, you will be able to perform some limited number of administrative functions and input some number of commands to phpMussel via your browser. The reason these passwords need to be set in order to enable these browser-side controls is both to ensure proper security, proper protection of these browser-side controls and to ensure that there exists a way for these browser-side controls to be entirely disabled if they are not desired by you và/hoặc other webmasters/administrators using phpMussel. So, in other words, to enable these controls, set a password, and to disable these controls, set no password. Alternatively, if you choose to enable these controls and then choose to disable these controls at a later date, there is a command to do this (such can be useful if you perform some actions that you feel could potentially compromise the delegated passwords and need to quickly disable these controls without modifying your tập tin cấu hình).

A couple of reasons why you _**SHOULD**_ enable these controls:
- Provides a way to greylist signatures on-the-fly in instances such as when you discover a signature that is producing a false-positive while uploading files to your system and you don't have time to manually edit and reupload your greylist file.
- Provides a way for you to allow someone other than yourself to control your copy of phpMussel without the implicit need to grant them access to FTP.
- Provides a way to provide controlled access to your log files.
- Provides a way for you to monitor phpMussel when FTP access or other conventional access points for monitoring phpMussel are not available.

A couple of reasons why you should _**NOT**_ enable these controls:
- Provides a vector for potential attackers and undesirables to determine whether you're using phpMussel or not (although, this could be both a reason for and a reason against, depending on perspective) by way of blindly sending commands to servers as a means to probe. On one hand, this could discourage attackers from targeting your system if they learn that you're using phpMussel, assuming that they are probing because their attack method is rendered ineffective as a result of using phpMussel. Tuy nhiên, on the other hand, if some unforeseen and currently unknown exploit within phpMussel or a future version thereof comes to light, and if it could potentially provide an attack vector, a positive result from such probing could actually encourage attackers to target your system.
- If your delegated passwords were ever compromised, unless changed, could provide a way for an attacker to bypass whatever signatures may be otherwise normally preventing their attacks from succeeding, or even potentially disable phpMussel altogether, thus providing a way to render the effectiveness of phpMussel moot.

Either way, regardless of what you choose, the choice is ultimately yours. By default, these controls will be disabled, but have a think about it, and if you decide you want them, this section explains both how to enable them and how to use them.

Một danh sách của có sẵn lệnh cho trình duyệt:

scan_log
- Mật khẩu cần thiết: `logs_password`
- Các yêu cầu khác: scan_log cần phải được xác định.
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?logspword=[logs_password]&phpmussel=scan_log`
- Những gì nó làm: In nội dung tập tin scan_log của bạn vào màn hình.

scan_kills
- Mật khẩu cần thiết: `logs_password`
- Các yêu cầu khác: scan_kills cần phải được xác định.
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?logspword=[logs_password]&phpmussel=scan_kills`
- Những gì nó làm: In nội dung tập tin scan_kills của bạn vào màn hình.

controls_lockout
- Mật khẩu cần thiết: `logs_password` HOẶC `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Example 1: `?logspword=[logs_password]&phpmussel=controls_lockout`
- Example 2: `?pword=[script_password]&phpmussel=controls_lockout`
- Những gì nó làm: Vô hiệu hóa (hoặc khóa) tất cả các điều khiển cho trình duyệt. Điều này nên được sử dụng nếu bạn nghi ngờ mà một hoặc cả hai của mật khẩu của bạn đã bị xâm nhập (điều này có thể xảy ra nếu bạn đang sử dụng các điều khiển từ một máy tính không là an toàn và/hoặc đáng tin cậy). controls_lockout hoạt động bằng cách tạo ra một tập tin, `controls.lck`, trong vault (kho tiền) của bạn, rằng phpMussel sẽ kiểm tra trước khi thực hiện bất lệnh của bất cứ loại nào. Khi điều này xảy ra, để lại cho phép điều khiển, bạn sẽ cần phải tự xóa các tập tin `controls.lck` thông qua FTP hoặc tương tự. Có thể được gọi qua sử dụng một trong hai mật khẩu.

disable
- Mật khẩu cần thiết: `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[script_password]&phpmussel=disable`
- Những gì nó làm: Vô hiệu hóa phpMussel. Điều này nên được sử dụng if you're performing any updates or changes to your system or if you're installing any new software or modules to your system that either does or potentially could trigger false positives. This should also be used if you're having any problems with phpMussel but don't wish to remove it from your system. Once this happens, to reenable phpMussel, use "enable".

enable
- Mật khẩu cần thiết: `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[script_password]&phpmussel=enable`
- Những gì nó làm: Cho phép phpMussel. Điều này nên được sử dụng if you've previously disabled phpMussel using "disable" and want to reenable it.

greylist
- Mật khẩu cần thiết: `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: [Name of signature to be greylisted]
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[script_password]&phpmussel=greylist&musselvar=[Signature]`
- Những gì nó làm: Add a signature to the greylist.

greylist_clear
- Mật khẩu cần thiết: `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[script_password]&phpmussel=greylist_clear`
- Những gì nó làm: Clears the entire greylist.

greylist_show
- Mật khẩu cần thiết: `script_password`
- Các yêu cầu khác: (không có gì)
- Thông số cần thiết: (không có gì)
- Thông số không bắt buộc: (không có gì)
- Thí dụ: `?pword=[script_password]&phpmussel=greylist_show`
- Những gì nó làm: Prints the contents of the greylist to the screen.

---


###4B. <a name="SECTION4B"></a>CLI (LỆNH CHO DÒNG GIAO DIỆN)

phpMussel can be run as an interactive tập tin scanner in CLI mode under Windows-based systems. Refer to the "CẢCH CÀI ĐẶT (CHO CLI)" section of this README tập tin for more details.

For a list of available CLI commands, at the CLI prompt, type 'c', and press Enter.

---


###5. <a name="SECTION5"></a>TẬP TIN BAO GỒM TRONG GÓI NÀY

Sau đây là một list of all of the files that should have been included in the archived copy of this script when you downloaded it, any files that may be potentially created as a result of your using this script, along with a short description of what all these files are for.

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
/_testfiles/ | Thư mục kiểm tra tập tin (chứa các tập tin khác nhau). Tất cả các tập tin chứa những tập tin thử nghiệm để thử nghiệm nếu phpMussel đã được cài đặt đúng trên hệ thống của bạn, và bạn không cần phải tải lên thư mục này hoặc bất kỳ các tập tin của mình trừ khi làm xét nghiệm như vậy.
/_testfiles/ascii_standard_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chữ ký ASCII bình thường.
/_testfiles/coex_testfile.rtf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký kéo dài phức tạp.
/_testfiles/exe_standard_testfile.exe | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký PE.
/_testfiles/general_standard_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký chung.
/_testfiles/graphics_standard_testfile.gif | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký đồ họa.
/_testfiles/html_standard_testfile.html | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký HTML bình thường.
/_testfiles/md5_testfile.txt | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký dựa MD5.
/_testfiles/metadata_testfile.tar | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu lưu trữ và cho xét nghiệm hỗ trợ tập tin TAR trên hệ thống của bạn.
/_testfiles/metadata_testfile.txt.gz | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu lưu trữ và cho xét nghiệm hỗ trợ tập tin GZ trên hệ thống của bạn.
/_testfiles/metadata_testfile.zip | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký siêu dữ liệu lưu trữ và cho xét nghiệm hỗ trợ tập tin ZIP trên hệ thống của bạn.
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
/vault/signatures/exe_clamav_regex.cvd | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_clamav_regex.map | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_clamav_standard.cvd | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_clamav_standard.map | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_custom_regex.cvd | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_custom_standard.cvd | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_mussel_regex.cvd | Tập tin cho chữ ký PE (Portable Executable).
/vault/signatures/exe_mussel_standard.cvd | Tập tin cho chữ ký PE (Portable Executable).
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
/vault/signatures/metadata_clamav.cvd | Tập tin cho chữ ký siêu dữ liệu lưu trữ.
/vault/signatures/metadata_custom.cvd | Tập tin cho chữ ký siêu dữ liệu lưu trữ.
/vault/signatures/metadata_mussel.cvd | Tập tin cho chữ ký siêu dữ liệu lưu trữ.
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
CVD là một từ viết tắt cho "ClamAV Virus Definitions", in reference to how ClamAV refers to its own signatures and to the use of those signatures for phpMussel; Files ending with "CVD" contain signatures.

Files ending with "MAP", quite literally, map which signatures phpMussel should and shouldn't use for individual scans; Not all signatures are necessarily required for every single scan, so, phpMussel uses maps of the signature files to speed up the scanning process (a process that would otherwise be extremely slow and tedious).

Signature files marked with "_regex" contain signatures that utilise regular expression pattern checking (regex).

Signature files marked with "_standard" contain signatures that specifically don't utilise any form of pattern checking.

Signature files marked with neither "_regex" nor "_standard" will be as one or the other, but not both (refer to the Signature Format section of this README tập tin for documentation and specific details).

Signature files marked with "_clamav" contain signatures that are sourced entirely from the ClamAV database (GNU/GPL).

Signature files marked with "_custom", by default, don't contain any signatures at all; These such files exist to give you somewhere to place your own custom signatures, if you come up with any of your own.

Signature files marked with "_mussel" contain signatures that specifically are not sourced from ClamAV, signatures which, generally, I've either come up with myself và/hoặc based on information gathered from various sources.

---


###6. <a name="SECTION6"></a>SỰ LỰA CHỌN CỦA CẤU HÌNH
Sau đây là danh sách các biến tìm thấy trong tập tin cấu hình cho phpMussel `phpmussel.ini`, cùng với một mô tả về mục đích và chức năng của chúng.

####"general" (Thể loại)
Cấu hình chung cho phpMussel.

"script_password"
- As a convenience, phpMussel will allow certain functions to be manually triggered via POST, GET and QUERY. Tuy nhiên, as a security precaution, to do this, phpMussel will expect a password to be included with the command, as to ensure that it's you, and not someone else, attempting to manually trigger these functions. Set `script_password` to whatever password you would like to use. If no password is set, manual triggering will be disabled by default. Use something you will remember but which is hard for others to guess.
- Không có ảnh hưởng trong CLI.

"logs_password"
- The same as `script_password`, but for viewing the contents of scan_log and scan_kills. Having separate passwords can be useful if you want to give someone else access to one set of functions but not the other.
- Không có ảnh hưởng trong CLI.

"cleanup"
- Unset variables and cache used by the script after the initial upload scanning? False = Không; True = Vâng [Mặc định]. If you -aren't- using the script beyond the initial scanning of uploads, you should set this to `true` (yes), to minimize memory usage. If you -are- using the script beyond the initial scanning of uploads, should set to `false` (no), to avoid unnecessarily reloading duplicate dữ liệu into memory. In general practice, it should usually be set to `true`, but, if you do this, you won't be able to use the script for anything other than the initial tập tin upload scanning.
- Không có ảnh hưởng trong CLI.

"scan_log"
- Tên của tập tin để ghi lại tất cả các kết quả quét. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_log_serialized"
- Tên của tập tin để ghi lại tất cả các kết quả quét (sử dụng một định dạng tuần tự). Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_kills"
- Tên của tập tin để ghi lại tất cả hồ sơ của bị chặn hoặc bị giết tải lên. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"ipaddr"
- Where to find the IP address of connecting requests? (Useful for services such as Cloudflare and the likes) Mặc định = REMOTE_ADDR. WARNING: Don't change this unless you know what you're doing!

"forbid_on_block"
- Should phpMussel send 403 headers with the tập tin upload blocked message, or stick with the usual 200 OK? False = Không (200) [Mặc định]; True = Vâng (403).

"delete_on_sight"
- Enabling this directive will instruct the script to attempt to immediately delete any scanned attempted tập tin upload matching any detection criteria, whether via signatures or otherwise. Files determined to be "clean" won't be touched. In the case of archives, the entire lưu trữ will be deleted, regardless of whether or not the offending tập tin is only one of several files contained within the archive. For the case of tập tin upload scanning, usually, it isn't necessary to enable this directive, bởi vì usually, PHP will automatically purge the contents of its cache when execution has finished, meaning it'll usually delete any files uploaded through it to the server unless they've been moved, copied or deleted already. This directive is added here as an extra measure of security for those whose copies of PHP mightn't always behave in the manner expected. False = After scanning, leave the tập tin alone [Mặc định]; True = After scanning, if not clean, delete immediately.

"lang"
- Specify the default language for phpMussel.

"lang_override"
- Specify if phpMussel should, when possible, override the language specification with the language preference declared by inbound requests (HTTP_ACCEPT_LANGUAGE). False = Không [Mặc định]; True = Vâng.

"lang_acceptable"
- The `lang_acceptable` directive tells phpMussel which languages may be accepted by the script from `lang` or from `HTTP_ACCEPT_LANGUAGE`. This directive should **ONLY** be modified if you're adding your own customised language files or forcibly removing language files. The directive is a comma delimited string of the codes used by those languages accepted by the script.

"quarantine_key"
- phpMussel is able to quarantine flagged attempted tập tin uploads in isolation within the phpMussel vault, if this is something you want it to do. Casual users of phpMussel that simply wish to protect their websites or hosting environment without having any interest in deeply analysing any flagged attempted tập tin uploads should leave this functionality disabled, but any users interested in further analysis of flagged attempted tập tin uploads for malware research or for similar such things should enable this functionality. Quarantining of flagged attempted tập tin uploads can sometimes also assist in debugging false-positives, if this is something that frequently occurs for you. To disable quarantine functionality, simply leave the `quarantine_key` directive empty, or erase the contents of that directive if it isn't already empty. To enable quarantine functionality, enter some value into the directive. The `quarantine_key` is an important security feature of the quarantine functionality required as a means of preventing the quarantine functionality from being exploited by potential attackers and as a means of preventing any potential execution of dữ liệu stored within the quarantine. The `quarantine_key` should be treated in the same manner as your passwords: The longer the better, and guard it tightly. For best effect, use in conjunction with `delete_on_sight`.

"quarantine_max_filesize"
- The maximum allowable filesize of files to be quarantined. Files larger than the value specified will NOT be quarantined. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted dữ liệu potentially causing run-away dữ liệu usage on your hosting service. Value is in KB. Mặc định =2048 =2048KB =2MB.

"quarantine_max_usage"
- The maximum memory usage allowed for the quarantine. If the total memory used by the quarantine reaches this value, the oldest quarantined files will be deleted until the total memory used no longer reaches this value. This directive is important as a means of making it more difficult for any potential attackers to flood your quarantine with unwanted dữ liệu potentially causing run-away dữ liệu usage on your hosting service. Value is in KB. Mặc định =65536 =65536KB =64MB.

"honeypot_mode"
- When honeypot mode is enabled, phpMussel will attempt to quarantine every single tập tin upload that it encounters, regardless of whether or not the tập tin being uploaded matches any included signatures, and no actual scanning or analysis of those attempted tập tin uploads will actually occur. This functionality should be useful for those that wish to use phpMussel for the purposes of virus/malware research, but it's neither recommended to enable this functionality if the intended use of phpMussel by the user is for actual tập tin upload scanning, nor recommended to use the honeypot functionality for purposes other than honeypotting. By default, this option is disabled. False = Disabled [Mặc định]; True = Enabled.

"scan_cache_expiry"
- For how long should phpMussel cache the results of scanning? Value is the number of seconds to cache the results of scanning for. Default is 21600 seconds (6 hours); A value of 0 will disable caching the results of scanning.

"disable_cli"
- Disable CLI mode? CLI mode is enabled by default, but can sometimes interfere with certain testing tools (such as PHPUnit, for example) and other CLI-based applications. If you don't need to disable CLI mode, you should ignore this directive. False = Enable CLI mode [Mặc định]; True = Disable CLI mode.

####"signatures" (Thể loại)
Signatures configuration.
- %%%_clamav = ClamAV signatures (both mains and daily).
- %%%_custom = Your custom signatures (if you've written any).
- %%%_mussel = phpMussel signatures included in your current signatures set that aren't from ClamAV.

Check against MD5 signatures when scanning? False = Không; True = Vâng [Mặc định].
- "md5_clamav"
- "md5_custom"
- "md5_mussel"

Check against general signatures when scanning? False = Không; True = Vâng [Mặc định].
- "general_clamav"
- "general_custom"
- "general_mussel"

Check against normalised ASCII signatures when scanning? False = Không; True = Vâng [Mặc định].
- "ascii_clamav"
- "ascii_custom"
- "ascii_mussel"

Check against normalised HTML signatures when scanning? False = Không; True = Vâng [Mặc định].
- "html_clamav"
- "html_custom"
- "html_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE Sectional signatures when scanning? False = Không; True = Vâng [Mặc định].
- "pe_clamav"
- "pe_custom"
- "pe_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE extended signatures when scanning? False = Không; True = Vâng [Mặc định].
- "pex_custom"
- "pex_mussel"

Check PE (Portable Executable) files (EXE, DLL, etc) against PE signatures when scanning? False = Không; True = Vâng [Mặc định].
- "exe_clamav"
- "exe_custom"
- "exe_mussel"

Check ELF files against ELF signatures when scanning? False = Không; True = Vâng [Mặc định].
- "elf_clamav"
- "elf_custom"
- "elf_mussel"

Check Mach-O files (OSX, etc) against Mach-O signatures when scanning? False = Không; True = Vâng [Mặc định].
- "macho_clamav"
- "macho_custom"
- "macho_mussel"

Check graphics files against graphics based signatures when scanning? False = Không; True = Vâng [Mặc định].
- "graphics_clamav"
- "graphics_custom"
- "graphics_mussel"

Check lưu trữ contents against siêu dữ liệu lưu trữ signatures when scanning? False = Không; True = Vâng [Mặc định].
- "metadata_clamav"
- "metadata_custom"
- "metadata_mussel"

Check OLE objects against OLE signatures when scanning? False = Không; True = Vâng [Mặc định].
- "ole_clamav"
- "ole_custom"
- "ole_mussel"

Check filenames against filename based signatures when scanning? False = Không; True = Vâng [Mặc định].
- "filenames_clamav"
- "filenames_custom"
- "filenames_mussel"

Allow scanning with phpMussel_mail()? False = Không; True = Vâng [Mặc định].
- "mail_clamav"
- "mail_custom"
- "mail_mussel"

Enable tập tin specific whitelist? False = Không; True = Vâng [Mặc định].
- "whitelist_clamav"
- "whitelist_custom"
- "whitelist_mussel"

Check XML/XDP chunks against XML/XDP signatures when scanning? False = Không; True = Vâng [Mặc định].
- "xmlxdp_clamav"
- "xmlxdp_custom"
- "xmlxdp_mussel"

Check against complex extended signatures when scanning? False = Không; True = Vâng [Mặc định].
- "coex_clamav"
- "coex_custom"
- "coex_mussel"

Check against PDF signatures when scanning? False = Không; True = Vâng [Mặc định].
- "pdf_clamav"
- "pdf_custom"
- "pdf_mussel"

Check against Shockwave signatures when scanning? False = Không; True = Vâng [Mặc định].
- "swf_clamav"
- "swf_custom"
- "swf_mussel"

Signature matching length limiting options. Only change these if you know what you're doing. SD = Standard signatures. RX = PCRE (Perl Compatible Regular Expressions, or "Regex") signatures. FN = Filename signatures. If you notice PHP crashing when phpMussel attempts to scan, try lowering these "max" values. If possible and convenient, let me know when this happens and the results of whatever you try.
- "fn_siglen_min"
- "fn_siglen_max"
- "rx_siglen_min"
- "rx_siglen_max"
- "sd_siglen_min"
- "sd_siglen_max"

"fail_silently"
- Should phpMussel report when signatures files are missing or corrupted? If fail_silently is disabled, missing and corrupted files will be reported on scanning, and if fail_silently is enabled, missing and corrupted files will be ignored, with scanning reporting for those files that there aren't any problems. This should generally be left alone unless you're experiencing crashes or similar problems. False = Disabled; True = Enabled [Mặc định].

"fail_extensions_silently"
- Should phpMussel report when extensions are missing? If fail_extensions_silently is disabled, missing extensions will be reported on scanning, and if fail_extensions_silently is enabled, missing extensions will be ignored, with scanning reporting for those files that there aren't any problems. Disabling this directive may potentially increase your security, but may also lead to an increase of false positives. False = Disabled; True = Enabled [Mặc định].

"detect_adware"
- Should phpMussel parse signatures for detecting adware? False = Không; True = Vâng [Mặc định].

"detect_joke_hoax"
- Should phpMussel parse signatures for detecting joke/hoax malware/viruses? False = Không; True = Vâng [Mặc định].

"detect_pua_pup"
- Should phpMussel parse signatures for detecting PUAs/PUPs? False = Không; True = Vâng [Mặc định].

"detect_packer_packed"
- Should phpMussel parse signatures for detecting packers and packed data? False = Không; True = Vâng [Mặc định].

"detect_shell"
- Should phpMussel parse signatures for detecting shell scripts? False = Không; True = Vâng [Mặc định].

"detect_deface"
- Should phpMussel parse signatures for detecting defacements and defacers? False = Không; True = Vâng [Mặc định].

####"files" (Thể loại)
File handling configuration.

"max_uploads"
- Maximum allowable number of files to scan during files upload scan before aborting the scan and informing the user they are uploading too much at once! Provides protection against a theoretical attack whereby an attacker attempts to DDoS your system or CMS by overloading phpMussel to slow down the PHP process to a grinding halt. Recommended: 10. You may wish to raise or lower this number depending on the speed of your hardware. Note that this number doesn't account for or include the contents of archives.

"filesize_limit"
- Filesize limit in KB. 65536 = 64MB [Mặc định]; 0 = No limit (always greylisted), any (positive) numeric value accepted. This can be useful when your PHP configuration limits the amount of memory a process can hold or if your PHP configuration limits filesize of uploads.

"filesize_response"
- What to do with files that exceed the filesize limit (if one exists). False = Whitelist; True = Blacklist [Mặc định].

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- If your system only allows specific types of files to be uploaded, or if your system explicitly denies certain types of files, specifying those filetypes in whitelists, blacklists and greylists can increase the speed at which scanning is performed by allowing the script to skip over certain filetypes. Format is CSV (comma separated values). If you want to scan everything, rather than whitelist, blacklist or greylist, leave the variable(/s) blank; Doing so will disable whitelist/blacklist/greylist.
- Logical order of processing is:
  - If the filetype is whitelisted, don't scan and don't block the file, and don't check the tập tin against the blacklist or the greylist.
  - If the filetype is blacklisted, don't scan the tập tin but block it anyway, and don't check the tập tin against the greylist.
  - If the greylist is empty or if the greylist is not empty and the filetype is greylisted, scan the tập tin as per normal and determine whether to block it based on the results of the scan, but if the greylist is not empty and the filetype is not greylisted, treat the tập tin as blacklisted, therefore not scanning it but blocking it anyway.

"check_archives"
- Attempt to check the contents of archives? False = Don't check; True = Check [Mặc định].
- Currently, only checking of BZ, GZ, LZF and ZIP files is supported (checking of RAR, CAB, 7z and etcetera not currently supported).
- This is not foolproof! While I highly recommend keeping this turned on, I can't guarantee it'll always find everything.
- Also be aware that lưu trữ checking currently is not recursive for ZIPs.

"filesize_archives"
- Carry over filesize blacklisting/whitelisting to the contents of archives? False = Không (just greylist everything); True = Vâng [Mặc định].

"filetype_archives"
- Carry over filetype blacklisting/whitelisting to the contents of archives? False = Không (just greylist everything) [Mặc định]; True = Vâng.

"max_recursion"
- Maximum recursion depth limit for archives. Mặc định = 10.

"block_encrypted_archives"
- Detect and block encrypted archives? Because phpMussel isn't able to scan the contents of encrypted archives, it's possible that lưu trữ encryption may be employed by an attacker as a means of attempting to bypass phpMussel, anti-virus scanners and other such protections. Instructing phpMussel to block any archives that it discovers to be encrypted could potentially help reduce any risk associated with these such possibilities. False = Không; True = Vâng [Mặc định].

####"attack_specific" (Thể loại)
Attack-specific directives.

Chameleon attack detection: False = Off; True = On.

"chameleon_from_php"
- Search for PHP header in files that are neither PHP files nor recognised archives.

"chameleon_from_exe"
- Search for executable headers in files that are neither executables nor recognised archives and for executables whose headers are incorrect.

"chameleon_to_archive"
- Search for archives whose headers are incorrect (Supported: BZ, GZ, RAR, ZIP, RAR, GZ).

"chameleon_to_doc"
- Search for office documents whose headers are incorrect (Supported: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Search for images whose headers are incorrect (Supported: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Search for PDF files whose headers are incorrect.

"archive_file_extensions" and "archive_file_extensions_wc"
- Recognised lưu trữ tập tin extensions (format is CSV; should only add or remove when problems occur; unnecessarily removing may cause false-positives to appear for lưu trữ files, whereas unnecessarily adding will essentially whitelist what you're adding from attack specific detection; modify with caution; also note that this has no effect on what archives can and can't be analysed at content-level). The list, as is at default, lists those formats used most commonly across the majority of systems and CMS, but intentionally isn't necessarily comprehensive.

"general_commands"
- Search the content of files for statements and general commands such as `eval()` and `exec()`? False = Don't check [Mặc định]; True = Check. Disable this directive if you intend to upload any of the following to your system or CMS via your browser: PHP, JavaScript, HTML, python, perl files and etcetera. Enable this directive if you don't have any additional protections on your system and do not intend to upload such files. If you use additional security in conjunction with phpMussel (such as ZB Block), there's no need to enable this directive, bởi vì most of what phpMussel will look for (in the context of this directive) are duplications of protections that will most likely already be provided.

"block_control_characters"
- Block any files containing any control characters (other than newlines)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) If you're _**ONLY**_ uploading plain-text, then you can turn this option on to provide some additional protection to your system. Tuy nhiên, if you upload anything other than plain-text, turning this on may result in false positives. False = Don't block [Mặc định]; True = Block.

"corrupted_exe"
- Corrupted files and parse errors. False = Ignore; True = Block [Mặc định]. Detect and block potentially corrupted PE (Portable Executable) files? Often (but not always), when certain aspects of a PE tập tin are corrupted or can't be parsed correctly, it can be indicative of a viral infection. The processes used by most anti-virus programs to detect viruses in PE files require parsing those files in certain ways, which, if the programmer of a virus is aware of, will specifically try to prevent, in order to allow their virus to remain undetected.

"decode_threshold"
- Optional limitation or threshold to the length of raw dữ liệu within which decode commands should be detected (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. Default = 512 (512KB). Zero or null value disables the threshold (removing any such limitation based on filesize).

"scannable_threshold"
- Optional limitation or threshold to the length of raw dữ liệu that phpMussel is permitted to read and scan (in case there are any noticeable performance issues while scanning). Value is an integer representing filesize in KB. Default = 32768 (32MB). Zero or null value disables the threshold. Generally, this value shouldn't be less than the average filesize of tập tin uploads that you want and expect to receive to your server or website, shouldn't be more than the filesize_limit directive, and shouldn't be more than roughly one fifth of the total allowable memory allocation granted to PHP via the tập tin cấu hình `php.ini`. This directive exists to try to prevent phpMussel from using up too much memory (that'd prevent it from being able to successfully scan files above a certain filesize).

####"compatibility" (Thể loại)
Compatibility directives for phpMussel.

"ignore_upload_errors"
- This directive should generally be disabled unless it's required for correct functionality of phpMussel on your specific system. Normally, when disabled, when phpMussel detects the presence of elements in the `$_FILES` array(), it'll attempt to initiate a scan of the files that those elements represent, and, if those elements are blank or empty, phpMussel will return an error message. This is proper behaviour for phpMussel. Tuy nhiên, for some CMS, empty elements in `$_FILES` can occur as a result of the natural behaviour of those CMS, or errors may be reported when there aren't any, in which case, the normal behaviour for phpMussel will be interfering with the normal behaviour of those CMS. If such a situation occurs for you, enabling this option will instruct phpMussel to not attempt to initiate scans for such empty elements, ignore them when found and to not return any related error messages, thus allowing continuation of the page request. False = OFF; True = ON.

"only_allow_images"
- If you only expect or only intend to allow images to be uploaded to your system or CMS, and if you absolutely don't require any files other than images to be uploaded to your system or CMS, this directive should be enabled, but should otherwise be disabled. If this directive is enabled, it'll instruct phpMussel to indiscriminately block any uploads identified as non-image files, without scanning them. This may reduce processing time and memory usage for attempted uploads of non-image files. False = OFF; True = ON.

####"heuristic" (Thể loại)
Heuristic directives.

"threshold"
- There are certain signatures of phpMussel that are intended to identify suspicious and potentially malicious qualities of files being uploaded without in themselves identifying those files being uploaded specifically as being malicious. This "threshold" value tells phpMussel what the maximum total weight of suspicious and potentially malicious qualities of files being uploaded that's allowable is before those files are to be flagged as malicious. The definition of weight in this context is the total number of suspicious and potentially malicious qualities identified. By default, this value will be set to 3. A lower value generally will result in a higher occurrence of false positives but a higher number of malicious files being flagged, whereas a higher value generally will result in a lower occurrence of false positives but a lower number of malicious files being flagged. It's generally best to leave this value at its default unless you're experiencing problems related to it.

####"virustotal" (Thể loại)
VirusTotal.com directives.

"vt_public_api_key"
- Optionally, phpMussel is able to scan files using the Virus Total API as a way to provide a greatly enhanced level of protection against viruses, trojans, malware and other threats. By default, scanning files using the Virus Total API is disabled. To enable it, an API key from Virus Total is required. Due to the significant benefit that this could provide to you, it's something that I highly recommend enabling. Please be aware, however, that to use the Virus Total API, you _**MUST**_ agree to their Terms of Service and you _**MUST**_ adhere to all guidelines as per described by the Virus Total documentation! You are NOT permitted to use this integration feature UNLESS:
  - You have read and agree to the Terms of Service of Virus Total and its API. The Terms of Service of Virus Total and its API can be found [Here](https://www.virustotal.com/en/about/terms-of-service/).
  - You have read and you understand, at a minimum, the preamble of the Virus Total Public API documentation (everything after "VirusTotal Public API v2.0" but before "Contents"). The Virus Total Public API documentation can be found [Here](https://www.virustotal.com/en/documentation/public-api/).

Note: If scanning files using the Virus Total API is disabled, you won't need to review any of the directives in this category (`virustotal`), bởi vì none of them will do anything if this is disabled. To acquire a Virus Total API key, from anywhere on their website, click the "Join our Community" link located towards the top-right of the page, enter in the information requested, and click "Sign up" when done. Follow all instructions supplied, and when you've got your public API key, copy/paste that public API key to the `vt_public_api_key` directive of the `phpmussel.ini` tập tin cấu hình.

"vt_suspicion_level"
- By default, phpMussel will restrict which files it scans using the Virus Total API to those files that it considers "suspicious". You can optionally adjust this restriction by changing the value of the `vt_suspicion_level` directive.
- `0`: Files are only considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight. This would effectively mean that use of the Virus Total API would be for a second opinion for when phpMussel suspects that a tập tin may potentially be malicious, but can't entirely rule out that it may also potentially be benign (non-malicious) and therefore would otherwise normally not block it or flag it as being malicious.
- `1`: Files are considered suspicious if, upon being scanned by phpMussel using its own signatures, they are deemed to carry a heuristic weight, if they're known to be executable (PE files, Mach-O files, ELF/Linux files, etc), or if they're known to be of a format that could potentially contain executable dữ liệu (such as executable macros, DOC/DOCX files, lưu trữ files such as RARs, ZIPS and etc). This is the default and recommended suspicion level to apply, effectively meaning that use of the Virus Total API would be for a second opinion for when phpMussel doesn't initially find anything malicious or wrong with a tập tin that it considers to be suspicious and therefore would otherwise normally not block it or flag it as being malicious.
- `2`: All files are considered suspicious and should be scanned using the Virus Total API. I don't generally recommend applying this suspicion level, due to the risk of reaching your API quota much quicker than would otherwise be the case, but there are certain circumstances (such as when the webmaster or hostmaster has very little faith or trust whatsoever in any of the uploaded content of their users) where this suspicion level could be appropriate. With this suspicion level, all files not normally blocked or flagged as being malicious would be scanned using the Virus Total API. Note, however, that phpMussel will cease using the Virus Total API when your API quota has been reached (regardless of suspicion level), and that your quota will likely be reached much faster when using this suspicion level.

Note: Regardless of suspicion level, any files that are either blacklisted or whitelisted by phpMussel won't be scanned using the Virus Total API, bởi vì those such files would've already been declared as either malicious or benign by phpMussel by the time that they would've otherwise been scanned by the Virus Total API, and therefore, additional scanning wouldn't be required. The ability of phpMussel to scan files using the Virus Total API is intended to build further confidence for whether a tập tin is malicious or benign in those circumstances where phpMussel itself isn't entirely certain as to whether a tập tin is malicious or benign.

"vt_weighting"
- Should phpMussel apply the results of scanning using the Virus Total API as detections or as detection weighting? This directive exists, bởi vì, although scanning a tập tin using multiple engines (as Virus Total does) should result in an increased detection rate (and therefore in a higher number of malicious files being caught), it can also result in a higher number of false positives, and therefore, in some circumstances, the results of scanning may be better utilised as a confidence score rather than as a definitive conclusion. If a value of 0 is used, the results of scanning using the Virus Total API will be applied as detections, and therefore, if any engine used by Virus Total flags the tập tin being scanned as being malicious, phpMussel will consider the tập tin to be malicious. If any other value is used, the results of scanning using the Virus Total API will be applied as detection weighting, and therefore, the number of engines used by Virus Total that flag the tập tin being scanned as being malicious will serve as a confidence score (or detection weighting) for whether or not the tập tin being scanned should be considered malicious by phpMussel (the value used will represent the minimum confidence score or weight required in order to be considered malicious). A value of 0 is used by default.

"vt_quota_rate" and "vt_quota_time"
- According to the Virus Total API documentation, "it is limited to at most 4 requests of any nature in any given 1 minute time frame. If you run a honeyclient, honeypot or any other automation that is going to provide resources to VirusTotal and not only retrieve reports you are entitled to a higher request rate quota". By default, phpMussel will strictly adhere to these limitations, but due to the possibility of these rate quotas being increased, these two directives are provided as a means for you to instruct phpMussel as to what limit it should adhere to. Unless you've been instructed to do so, it's not recommended for you to increase these values, but, if you've encountered problems relating to reaching your rate quota, decreasing these values _**MAY**_ sometimes help you in dealing with these problems. Your rate limit is determined as `vt_quota_rate` requests of any nature in any given `vt_quota_time` minute time frame.

####"urlscanner" (Thể loại)
URL scanner configuration.

"urlscanner"
- Built into phpMussel is a URL scanner, capable of detecting malicious URLs from within any dữ liệu or files scanned. To enable the URL scanner, set the `urlscanner` directive to true; To disable it, set this directive to false.

Note: If the URL scanner is disabled, you won't need to review any of the directives in this category (`urlscanner`), bởi vì none of them will do anything if this is disabled.

URL scanner API lookup configuration.

"lookup_hphosts"
- Enables API lookups to the [hpHosts](http://hosts-file.net/) API when set to true. hpHosts doesn't require an API key for performing API lookups.

"google_api_key"
- Enables API lookups to the Google Safe Browsing API when the necessary API key is defined. Google Safe Browsing API lookups requires an API key, which can be obtained from [Here](https://console.developers.google.com/).
- Note: This is a future feature! Google Safe Browsing API lookup functionality not yet completed!

"maximum_api_lookups"
- Maximum allowable number of API lookups to perform per individual scan iteration. Because each additional API lookup will add to the total time required to complete each scan iteration, you may wish to stipulate a limitation in order to expedite the overall scan process. When set to 0, no such maximum allowable number will be applied. Set to 10 by default.

"maximum_api_lookups_response"
- What to do if the maximum allowable number of API lookups is exceeded? False = Do nothing (continue processing) [Mặc định]; True = Flag/block the file.

"cache_time"
- How long (in seconds) should the results of API lookups be cached for? Default is 3600 seconds (1 hour).

####"template_data" (Thể loại)
Directives/Variables for templates and themes.

Template dữ liệu relates to the HTML output used to generate the "Upload Denied" message displayed to users upon a tập tin upload being blocked. If you're using custom themes for phpMussel, HTML output is sourced from the `template_custom.html` file, and otherwise, HTML output is sourced from the `template.html` file. Variables written to this section of the configuration tập tin are parsed to the HTML output by way of replacing any variable names circumfixed by curly brackets found within the HTML output with the corresponding variable data. For example, where `foo="bar"`, any instance of `<p>{foo}</p>` found within the HTML output will become `<p>bar</p>`.

"css_url"
- The template tập tin for custom themes utilises external CSS properties, whereas the template tập tin for the default theme utilises internal CSS properties. To instruct phpMussel to use the template tập tin for custom themes, specify the public HTTP address of your custom theme's CSS files using the `css_url` variable. If you leave this variable blank, phpMussel will use the template tập tin for the default theme.

---


###7. <a name="SECTION7"></a>ĐỊNH DẠNG CỦA CHỬ KÝ

####*CHỮ KÝ TÊN TẬP TIN*
Tất cả các chữ ký tên tập tin tuân theo các định dạng:

`NAME:FNRX`

NAME là tên cho các chữ ký và FNRX là mô hình biểu thức chính quy để kiểm tra tên tập tin (không mã hóa).

####*CHỮ KÝ DỰA MD5*
Tất cả các chữ ký dựa MD5 tuân theo các định dạng:

`HASH:FILESIZE:NAME`

HASH là băm MD5 của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và NAME là tên cho các chữ ký.

####*CHỮ KÝ SIÊU DỮ LIỆU LƯU TRỮ*
Tất cả các chữ ký siêu dữ liệu lưu trữ tuân theo các định dạng:

`NAME:FILESIZE:CRC32`

NAME là tên cho các chữ ký, FILESIZE là tổng dung lượng (không nén) của một tập tin chứa trong lưu trữ và CRC32 là băm CRC32 của tập tin đó.

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
Bất kỳ cách thức biểu thức chính quy hiểu và xử lý một cách chính xác qua PHP cũng nên được hiểu hiểu và xử lý một cách chính xác qua phpMussel và chữ ký của nó. Tuy nhiên, tôi muốn đề nghị lấy hết sức thận trọng khi viết chữ ký biểu thức chính quy mới, bởi vì, nếu bạn không hoàn toàn chắc chắn bạn đang làm gì vậy, có thể có kết quả rất bất thường và/hoặc bất ngờ. Nhìn vào các mã nguồn nếu bạn không hoàn toàn về bối cảnh rằng họ đang phân tích cú pháp. Ngoài ra, nhớ lại rằng tất cả mọi thứ (ngoại trừ tên tập tin, cú pháp, siêu dữ liệu lưu trữ và mẫu MD5) phải được mã hóa hệ thập lục phân!

####*NƠI ĐỂ ĐẶT CHỮ KÝ TÙY CHỈNH?*
Chỉ đặt chữ ký tùy chỉnh trong tập tin có nghĩa là cho ký tùy chỉnh trong. Chúng chứa "_custom" trong tên tập tin của họ. Bạn nên tránh chỉnh sửa các tập tin chữ ký mặc định, trừ khi bạn biết chính xác những gì bạn đang làm, bởi vì, ngoài việc thực hành tốt nói chung và ngoài việc giúp bạn phân biệt giữa chữ ký của riêng bạn và các tập tin chữ ký mặc định, rất tốt để chỉ chỉnh sửa các tập tin có nghĩa đó là cho chỉnh sửa, bởi vì giả mạo với các tập tin chữ ký mặc định có thể gây ra cho họ ngừng làm việc một cách chính xác, bởi vì các tập tin "map": Họ nói với phpMussel nơi để tìm trong các tập tin chữ ký cho chữ ký, và họ có thể trở thành không đồng bộ nếu giả mạo. Bạn có thể đặt hầu như bất cứ điều gì bạn muốn vào chữ ký tùy chỉnh của bạn,miễn là bạn làm theo cú pháp chính xác. Tuy nhiên, hãy cẩn thận để kiểm tra chữ ký mới cho giả tích cực trước nếu bạn có ý định chia sẻ hoặc sử dụng chúng trong một môi trường sống.

####*GIẢI THÍCH CHỮ KÝ*
Sau đây là một danh sách các loại chữ ký được sử dụng bởi phpMussel:
- "Chữ Ký ASCII Bình Thường" (ascii_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ Ký Kéo Dài Phức Tạp" (coex_*). Chữ ký của hỗn hợp kiểu.
- "Chữ Ký ELF" (elf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin ELF.
- "Chữ Ký PE" (exe_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác định như các định dạng PE.
- "Chữ Ký Tên Tập Tin" (filenames_*). Kiểm tra đối với các tên tập tin của mỗi tập tin dự định để quét.
- "Chữ Ký Chung" (general_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ Ký Đồ Họa" (graphics_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin công nhận đồ họa.
- "General Commands" (hex_general_commands.csv). Kiểm tra đối với các nội dung của mỗi tập tin không trong danh sách trắng và nhắm mục tiêu cho quét.
- "Chữ Ký HTML Bình Thường" (html_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin HTML.
- "Chữ Ký Mach-O" (macho_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin Mach-O.
- "Chữ Ký Email" (mail_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin EML.
- "Chữ Ký Dựa MD5" (md5_*). Kiểm tra đối với các băm MD5 của nội dung và các kích thước tập tin của mỗi tập tin không thuộc danh sách trắng và dự định để quét.
- "Chữ Ký Siêu Dữ Liệu Lưu Trữ" (metadata_*). Kiểm tra đối với the băm CRC32 và kích thước của tập tin đầu tiên chứa bên trong mỗi lưu trữ không trong danh sách trắng và nhắm mục tiêu cho quét.
- "Chữ Ký OLE" (ole_*). Kiểm tra đối với các nội dung của mỗi OLE không thuộc danh sách trắng và dự định để quét.
- "Chữ Ký PDF" (pdf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin PDF.
- "Chữ Ký Phần PE" (pe_*). Kiểm tra đối với các băm MD5 và các kích thước của mỗi phần của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác định như các định dạng PE.
- "Chữ Ký Kéo Dài PE" (pex_*). Kiểm tra đối với băm MD5 và kích thước của các biến trong mỗi tập tin không trong danh sách trắng, nhắm mục tiêu cho quét và xác định như các định dạng PE.
- "Chữ Ký Shockwave" (swf_*). Kiểm tra đối với các nội dung của mỗi tập tin không thuộc danh sách trắng và dự định để quét và xác nhận là tập tin Shockwave.
- "Chữ Ký Danh Sách Trắng" (whitelist_*). Kiểm tra đối với các băm MD5 các nội dung và kích thước tập tin của mỗi tập tin nhắm mục tiêu cho quét. Tập tin xác định sẽ được miễn dịch để được xác định bởi các loại chữ ký đề cập trong nhập danh sách trắng của họ.
- "Chữ Ký XML/XDP" (xmlxdp_*). Kiểm tra đối với bất kỳ XML/XDP tìm thấy trong bất kỳ tập tin không trong danh sách trắng và nhắm mục tiêu cho quét.
(Hãy lưu ý bất kỳ của các chữ ký có thể bị vô hiệu hóa thông qua `phpmussel.ini`).

---


###8. <a name="SECTION8"></a>NHỮNG VẤN ĐỀ HỢP TƯƠNG TÍCH

####PHP và PCRE
- phpMussel cần PHP và PCRE để thực hiện và hoạt động. Nếu không có PHP, hoạc không có PCRE thêm của PHP, phpMussel sẽ không thực hiện và hoạt động bình thường. Bạn nên chắc chắc rằng hệ thống của bạn có PHP và PCRE cài vào và có sẵn trước khi tải và cài đặt phpMussel.

####KHẢ NĂNG TƯƠNG THÍCH PHẦN MỀM CHỐNG VI RÚT

Cho hầu hết các phần, phpMussel sẽ tương hợp với hầu hết các phần mềm quét vi rút khác. Nhưng mà, có một số người sử dụng trong quá khứ đã báo cáo một số vấn đề. Thông tin dưới đây là từ VirusTotal.com, và nó miêu tả một số giả tích cực báo cáo bởi các chương trình chống vi rút khác nhau chống phpMussel. Mặc dù thông tin này không đảm bảo nếu bạn gặp phải vấn đề tương hợp giữa phpMussel và phần mềm chống vi rút của bạn, nếu phần mềm chống vi rút của bạn được ghi nhận là cách gắn cờ chống lại phpMussel, bạn nên tắt nó trước khi sử dụng phpMussel hoặc nên xét các lựa chọn khác cho một trong hai phần mềm chống vi rút của bạn hoặc phpMussel.

Thông tin này được cập nhật lần cứơi vào ngày 27 Tháng Ba 2016 và có thể áp dụng cho phpMussel công bố hai loại phiên bản nhỏ mới nhất (v0.10.0-v1.0.0) vào thời gian cái này được viết.

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
| Qihoo-360            |  Không có vấn đề                     |
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


Lần cuối cập nhật: 27 Tháng Ba 2016 (2016.03.27).
