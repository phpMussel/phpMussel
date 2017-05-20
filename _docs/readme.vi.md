## Tài liệu của phpMussel (Tiếng Việt).

### Nội dung
- 1. [LỜI GIỚI THIỆU](#SECTION1)
- 2. [CÁCH CÀI ĐẶT](#SECTION2)
- 3. [CÁCH SỬ DỤNG](#SECTION3)
- 4. [QUẢN LÝ FRONT-END](#SECTION4)
- 5. [CLI (LỆNH CHO DÒNG GIAO DIỆN)](#SECTION5)
- 6. [TẬP TIN BAO GỒM TRONG GÓI NÀY](#SECTION6)
- 7. [TÙY CHỌN CHO CẤU HÌNH](#SECTION7)
- 8. [ĐỊNH DẠNG CỦA CHỬ KÝ](#SECTION8)
- 9. [NHỮNG VẤN ĐỀ HỢP TƯƠNG TÍCH](#SECTION9)
- 10. [NHỮNG CÂU HỎI THƯỜNG GẶP (FAQ)](#SECTION10)

*Lưu ý về bản dịch: Trong trường hợp có sai sót (ví dụ, sự khác biệt giữa bản dịch, lỗi chính tả, vv), phiên bản tiếng Anh của README được coi là phiên bản gốc và có thẩm quyền. Nếu bạn tìm thấy bất kỳ lỗi, giúp đỡ của bạn trong việc điều chỉnh họ sẽ được hoan nghênh.*

---


### 1. <a name="SECTION1"></a>LỜI GIỚI THIỆU

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


### 2. <a name="SECTION2"></a>CÁCH CÀI ĐẶT

#### 2.0 CÀI ĐẶT THỦ CÔNG (CHO CÁC TRANG MẠNG)

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Từ đây, bạn sẽ muốn đặt nội dung ở một nơi trên máy chủ hoặc CMS của bạn. Một thư mục chẳng hạn như `/public_html/phpmussel/` hay tương tự (mặc dù sự lựa chọn của bạn không quan trọng, miễn là nó an toàn và bạn hài lòng với sự lựa chọn) sẽ đủ.. *Trước khi bạn bắt đầu tải lên, hảy tiếp tục đọc..*

2) Đổi tên `config.ini.RenameMe` đến `config.ini` (nằm bên trong `vault`), và nếu bạn muốn (đề nghị mạnh mẽ cho người dùng cao cấp, nhưng không đề nghị cho người mới bắt đầu hay cho người thiếu kinh nghiệm), mở nó (tập tin này bao gồm tất cả các tùy chọn có sẵn cho phpMussel; trên mỗi tùy chọn nên có một nhận xét ngắn gọn mô tả những gì nó làm và những gì nó cho). Điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho tập hợp cụ thể của bạn lên. Lưu tập tin, đóng.

3) Tải nội dung lên (phpMussel và tập tin của nó) vào thư mục bạn đã chọn trước (bạn không cần phải dùng tập tin `*.txt`/`*.md`, nhưng chủ yếu, bạn nên tải lên tất cả mọi thứ).

4) CHMOD thư mục `vault` thành "755" (nếu có vấn đề, bạn có thể thử "777", mặc dù này là kém an toàn). Các thư mục chính kho lưu trữ các nội dung (một trong những cái bạn đã chọn trước), bình thường, có thể riêng, nhưng tình hình CHMOD nên kiểm tra, nếu bạn đã có vấn đề cho phép trong quá khứ về hệ thống của bạn (theo mặc định, nên giống như "755").

5) Tiếp theo, bạn sẽ cần "nối" phpMussel vào hệ thống của bạn hay CMS. Có một số cách mà bạn có thể "nối" bản chẳng hạn như phpMussel vào hệ thống hoạc CMS, nhưng cách đơn giản nhất là cần có bản vào cốt lõi ở đầu của tập tin hoạc hệ thống hay CMS của bạn (một mà thường sẽ luôn luôn được nạp khi ai đó truy cập bất kỳ trang nào trên trang mạng của bạn) bằng cách sử dụng một lời chỉ thị `require` hoạc `include`. Thường, cái nàu sẽ được lưu trong một thư mục như `/includes`, `/assets` hoạc `/functions`, và sẽ thường được gọi là `init.php`, `common_functions.php`, `functions.php` hoạc tương tự. Bạn sẽ cần tiềm ra tập tin nào cho trường hợp của bạn; Nếu bạn gặp khó khăn trong việc này, hãy truy các trang issues (các vấn đề) của phpMussel hay cập diễn đàn hỗ trợ của phpMussel và cho chúng tôi biêt; Có thể là tôi họac các người dùng khác có có kinh nghiệm với các CMS mà bạn đang sử dụng (bạn phải biết mình đang sử dụng CMS nào), và như vậy, có thể cung cấp hỗ trợ trong trường hợp này. Để làm chuyện này [sử dụng `require` họac `include`], đánh các dòng mã sao đây vào đầu của cốt lõi của tập tin, thay thế các dây chứa bên trong các dấu ngoặc kép với địa chỉ chính xác của tập tin `loader.php` (địa chỉ địa phương, chứ không phải địa chỉ HTTP; nó sẽ nhình gióng địa chỉ kho nói ở trên).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Lưu tập tin, đóng lại, tải lên lại.

-- CÁCH KHÁC --

Nếu bạn đang sử dụng trang chủ Apache và nếu bạn có thể truy cập `php.ini`, bạn có thể sử dụng `auto_prepend_file` chỉ thị để thêm vào trước phpMussel bất cứ khi nào bất kỳ yêu cầu PHP được xin. Gióng như:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Hoạc cái này trong tập tin `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

6) Tại điểm này, bạn đã xong! Nhưng mà, bạn nên kiểm tra nó ra để đảm bảo nó hoạt động đúng. Để kiểm tra các tập tin tải lên bảo vệ, thử tải lên các tập tin thử nghiệm bao gồm trong gói dưới `_testfiles` vào trang mạng của bạn thông qua các phương pháp tải lên dựa trên trình duyệt thông thường của bạn. Nếu tất cả mọi thứ đang hoạt động, một tin nhắn sẽ xuất hiện từ phpMussel xác nhận là việc tải lên đã bị chặn thành công. Nếu không có gì xuất hiện, đây là điều biểu hiện cho một vấn đề với sự hoạt động. Nếu bạn đang sử dụng chức năng cao cấp, hay sử dụng các loại chức năng quét khác có thể với công cụ này, bạn nên thử nó ra với những điều đó để đảm bảo nó hoạt động như yêu cầu.

#### 2.1 CÀI ĐẶT THỦ CÔNG (CHO CLI)

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Một khi bạn đã hài lòng với vị trí của phpMussel, hày tiếp tục.

2) phpMussel cần PHP được cài đặt trên máy chủ để thực hiện. Nếu bạn không có PHP cài trên máy, xin hảy cài PHP, theo hướng dẫn được cung cấp bởi người cài đặt PHP.

3) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hay chưa có kinh nghiệm không nên chọn), hảy mở `config.ini` (nằm ớ trong `vault`) - Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

4) Tùy ý, bạn có thể sử dụng phpMussel trong chế độ CLI dể hơn với cách tạo ra tập tin lô để tự động tải PHP và phpMussel. Để làm điều này, mở một chương trình văn bản đơn giản như Notepad hoạc Notepad++, đánh vào đường dẫn đầy đủ cho tập tin `php.exe` trong thư mục cài đặt PHP của bạn, tiếp theo là một khoảng trống, theo sau là đường dẫn đầy đủ đến tập tin `loader.php` trong thư mục cài đặt phpMussel của bạn, lưu tập tin với tư bổ sung `.bat` một nơi nào bạn sẽ tìm thấy dễ dàng, và nhấn đúp vào vào tập tin đó để chạy phpMussel trong tương lai.

5) Tại thời điểm này, bạ đã xong! Nhưng mà, bạn nên kiểm tra nó để đảm bảo sự hoạt động. Để kiểm tra phpMussel, chạy phpMussel và thử quét `_testfiles` thư mục cung cấp trong gói.

#### 2.2 CÀI ĐẶT VỚI COMPOSER

[phpMussel được đăng ký với Packagist](https://packagist.org/packages/maikuolan/phpmussel), và như vậy, nếu bạn đã quen với Composer, bạn có thể sử dụng Composer để cài đặt phpMussel (bạn vẫn cần phải chuẩn bị cấu hình và kết nối; xem "cài đặt thủ công (cho các trang mạng)" bước 2 và 5).

`composer require maikuolan/phpmussel`

---


### 3. <a name="SECTION3"></a>CÁCH SỬ DỤNG

#### 3.0 CÁCH SỬ DỤNG (CHO CÁC TRANG MẠNG)

phpMussel sẽ có thể hoạt động một cách chính xác với yêu cầu tối thiểu từ bạn: Sau khi cài đặt nó, nó có thể được sử dụng ngay lập tức.

Quét tập tin tải lên là tự động và kích hoạt theo mặc định, như vậy không có gì là cần thiết từ bạn cho các chức năng đặc biệt này.

Tuy nhiên, bạn cũng có thể nói với phpMussel để quét tập tin cụ thể, thư mục hay kho lưu trữ. Để làm điều này, trước hết, bạn sẽ cần phải đảm bảo rằng các cấu hình thích hợp được thiết lập trong tập tin `config.ini` (`cleanup` phải được vô hiệu hóa), và khi thực hiện, trong một tập tin PHP được kết nối với phpMussel, sử dụng sau đây trong mã của bạn:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` có thể là một string, hoặc một hay nhiều của array, và chỉ ra đó tập tin hay thư mục để quét.
- `$output_type` là một boolean, và chỉ ra đó định dạng cho kết quả quét được trả về như. False hướng dẫn các chức năng để trả về kết quả là một số nguyên (trở lại kết quả của -3 chỉ ra rằng vấn đề gặp phải với các tập tin chữ ký hay tập tin chữ ký bản đồ và rằng họ có thể bị mất hay bị hỏng, -2 chỉ ra rằng dữ liệu bị hỏng đã được phát hiện trong quá trình quét và như vậy quét không hoàn thành, -1 chỉ ra rằng mở rộng hay bổ sung theo yêu cầu của PHP để thực hiện quá trình quét bị mất tích và như vậy quét không hoàn thành, 0 chỉ ra rằng mục tiêu quét không tồn tại và như vậy không có gì để quét, 1 chỉ ra rằng các mục tiêu đã được quét thành công và không có vấn đề đã được phát hiện, và 2 chỉ ra rằng các mục tiêu đã được quét thành công và vấn đề đã được phát hiện). True hướng dẫn các chức năng trả lại kết quả dưới dạng văn bản có thể đọc được con người. Ngoài ra, trong cả hai trường hợp, kết quả có thể được truy cập thông qua biến toàn cầu sau khi quét đã hoàn thành. Biến này là tùy chọn, mặc định là false.
- `$output_flatness` là một boolean, chỉ ra cho các chức năng liệu có nên trả lại kết quả quét (khi có nhiều mục tiêu quét) như là một array hoặc một string. False sẽ trả lại kết quả như là một array. True sẽ trả lại kết quả như là một string. Biến này là tùy chọn, mặc định là false.

Các ví dụ:

```PHP
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

Để vô hiệu hóa chữ ký đã bao gồm trong phpMussel (chẳng hạn như nếu bạn gặp một sai tích cực và bạn không thể loại bỏ nó), tham khảo các ghi chú cho các danh sách xám trong các phần QUẢN LÝ FRONT-END của tập tin README này.

#### 3.1 CÁCH SỬ DỤNG (CHO CLI)

Tham khảo phần "CÀI ĐẶT THỦ CÔNG (CHO CLI)" của tập tin README này.

Hãy nhận biết rằng, mặc dù các phiên bản tương lai của phpMussel nên hỗ trợ các hệ thống khác, tại thơi điểm nay, hỗ trợ cho chế độ CLI của phpMussel đã được tối ưu chỉ dành cho sử dụng trên các hệ thống Windows (bạn có thể, tất nhiên, thử nó trên các hệ thống khác, nhưng tôi không thể đảm bảo nó sẽ làm việc như dự định).

Ngoài ra, ý thức được rằng phpMussel là một máy quét *khi yêu cầu* (hay *on-demand*); Nó *KHÔNG PHẢI* là một máy quét *khi truy cập* (hay *on-access*; khác hơn cho tập tin tải lên, tại thời điểm tải lên), và không giống như chống vi rút thông thường, nó không theo dõi bộ nhớ hoạt động! Nó sẽ chỉ phát hiện vi rút chứa của tập tin tải lên, và bởi những tập tin cụ thể rằng bạn rõ ràng nói với nó để quét.

---


### 4. <a name="SECTION4"></a>QUẢN LÝ FRONT-END

#### 4.0 FRONT-END LÀ GÌ.

Các front-end cung cấp một cách thuận tiện và dễ dàng để duy trì, quản lý và cập nhật cài đặt phpMussel của bạn. Bạn có thể xem, chia sẻ và tải về các tập tin bản ghi thông qua các trang bản ghi, bạn có thể sửa đổi cấu hình thông qua các trang cấu hình, bạn có thể cài đặt và gỡ bỏ cài đặt các thành phần thông qua các trang cập nhật, và bạn có thể tải lên, tải về, và sửa đổi các tập tin trong vault của bạn thông qua các quản lý tập tin.

Các front-end được tắt theo mặc định để ngăn chặn truy cập trái phép (truy cập trái phép có thể có hậu quả đáng kể cho trang web của bạn và an ninh của mình). Hướng dẫn cho phép nó được bao gồm bên dưới đoạn này.

#### 4.1 LÀM THẾ NÀO ĐỂ KÍCH HOẠT FRONT-END.

1) Xác định vị trí các chỉ thị `disable_frontend` bên trong `config.ini`, và đặt nó vào `false` (nó sẽ là `true` bởi mặc định).

2) Truy cập `loader.php` từ trình duyệt của bạn (ví dụ, `http://localhost/phpmussel/loader.php`).

3) Đăng nhập với tên người dùng và mật khẩu mặc định (admin/password).

Chú thích: Sau khi bạn đã đăng nhập lần đầu tiên, để ngăn chặn truy cập trái phép vào các front-end, bạn phải ngay lập tức thay đổi tên người dùng và mật khẩu của bạn! Điều này là rất quan trọng, bởi vì nó có thể tải lên các mã PHP tùy ý để trang web của bạn thông qua các front-end.

#### 4.2 LÀM THẾ NÀO ĐỂ SỬ DỤNG FRONT-END.

Các hướng dẫn được cung cấp trên mỗi trang của front-end, để giải thích một cách chính xác để sử dụng nó và mục đích của nó. Nếu bạn cần giải thích thêm hay bất kỳ sự hỗ trợ đặc biệt, vui lòng liên hệ hỗ trợ. Cũng thế, có một số video trên YouTube có thể giúp bằng cách viện trợ trực quan.


---


### 5. <a name="SECTION5"></a>CLI (LỆNH CHO DÒNG GIAO DIỆN)

phpMussel có thể được chạy như một máy quét tập tin tương tác trong chế độ CLI theo các hệ thống dựa trên Windows. Tham khảo phần "CÁCH CÀI ĐẶT (CHO CLI)" của tập tin README này để biết thêm chi tiết.

Để xem một danh sách các lệnh CLI có sẵn, tại dấu nhắc CLI, đánh 'c', và bấm Enter.

Ngoài ra, cho những người quan tâm, một hướng dẫn video về cách sử dụng phpMussel trong chế độ CLI là có sẵn ở đây:
- <https://www.youtube.com/watch?v=H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>TẬP TIN BAO GỒM TRONG GÓI NÀY

Sau đây là một danh sách tất cả các tập tin mà cần phải có được bao gồm trong bản sao lưu của kịch bản này khi bạn tải về nó, bất kỳ tập tin mà có thể có lẽ được tạo ra là kết quả của bạn sử dụng kịch bản này, cùng với một mô tả ngắn cho những gì tất cả những tập tin này là dành cho.

Tập tin | Chi tiết
----|----
/_docs/ | Thư mực cho tài liệu.
/_docs/readme.ar.md | Tài liệu tiếng Ả Rập.
/_docs/readme.de.md | Tài liệu tiếng Đức.
/_docs/readme.en.md | Tài liệu tiếng Anh.
/_docs/readme.es.md | Tài liệu tiếng Tây Ban Nha.
/_docs/readme.fr.md | Tài liệu tiếng Pháp.
/_docs/readme.id.md | Tài liệu tiếng Indonesia.
/_docs/readme.it.md | Tài liệu tiếng Ý.
/_docs/readme.ja.md | Tài liệu tiếng Nhật.
/_docs/readme.ko.md | Tài liệu tiếng Hàn.
/_docs/readme.nl.md | Tài liệu tiếng Hà Lan.
/_docs/readme.pt.md | Tài liệu tiếng Bồ Đào Nha.
/_docs/readme.ru.md | Tài liệu tiếng Nga.
/_docs/readme.ur.md | Tài liệu tiếng Urdu.
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
/_testfiles/ole_testfile.ole | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký OLE.
/_testfiles/pdf_standard_testfile.pdf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký PDF.
/_testfiles/pe_sectional_testfile.exe | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký phần PE.
/_testfiles/swf_standard_testfile.swf | Kiểm tra tập tin cho xét nghiệm phpMussel chử ký Shockwave.
/vault/ | Vault thư mục (chứa các tập tin khác nhau).
/vault/cache/ | Cache thư mục (cho dữ liệu tạm thời).
/vault/cache/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/fe_assets/ | Các tài sản front-end.
/vault/fe_assets/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/fe_assets/_accounts.html | Một tập tin mẫu HTML cho các trang tài khoản của front-end.
/vault/fe_assets/_accounts_row.html | Một tập tin mẫu HTML cho các trang tài khoản của front-end.
/vault/fe_assets/_config.html | Một tập tin mẫu HTML cho các trang cấu hình của front-end.
/vault/fe_assets/_config_row.html | Một tập tin mẫu HTML cho các trang cấu hình của front-end.
/vault/fe_assets/_files.html | Một tập tin mẫu HTML cho các quản lý tập tin.
/vault/fe_assets/_files_edit.html | Một tập tin mẫu HTML cho các quản lý tập tin.
/vault/fe_assets/_files_rename.html | Một tập tin mẫu HTML cho các quản lý tập tin.
/vault/fe_assets/_files_row.html | Một tập tin mẫu HTML cho các quản lý tập tin.
/vault/fe_assets/_home.html | Một tập tin mẫu HTML cho các trang chủ của front-end.
/vault/fe_assets/_login.html | Một tập tin mẫu HTML cho các đăng nhập của front-end.
/vault/fe_assets/_logs.html | Một tập tin mẫu HTML cho các trang bản ghi của front-end.
/vault/fe_assets/_nav_complete_access.html | Một tập tin mẫu HTML cho các liên kết điều hướng của front-end, cho những người có quyền truy cập đầy đủ.
/vault/fe_assets/_nav_logs_access_only.html | Một tập tin mẫu HTML cho các liên kết điều hướng của front-end, cho những người có quyền bản ghi truy cập chỉ.
/vault/fe_assets/_updates.html | Một tập tin mẫu HTML cho các trang cập nhật của front-end.
/vault/fe_assets/_updates_row.html | Một tập tin mẫu HTML cho các trang cập nhật của front-end.
/vault/fe_assets/_upload_test.html | Một tập tin mẫu HTML cho các trang kiểm tra tải lên.
/vault/fe_assets/frontend.css | CSS định kiểu cho các front-end.
/vault/fe_assets/frontend.dat | Cơ sở dữ liệu cho các front-end (chứa thông tin tài khoản và phiên; chỉ tạo ra nếu front-end được kích hoạt và sử dụng).
/vault/fe_assets/frontend.html | Các chính tập tin mẫu HTML cho các front-end.
/vault/fe_assets/icons.php | Tập tin cho các biểu tượng (được sử dụng bởi các quản lý tập tin front-end).
/vault/fe_assets/pips.php | Tập tin cho các pip (được sử dụng bởi các quản lý tập tin front-end).
/vault/lang/ | Chứa dữ liệu tiếng cho phpMussel.
/vault/lang/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/lang/lang.ar.fe.php | Dữ liệu tiếng Ả Rập cho các front-end.
/vault/lang/lang.ar.php | Dữ liệu tiếng Ả Rập.
/vault/lang/lang.de.fe.php | Dữ liệu tiếng Đức cho các front-end.
/vault/lang/lang.de.php | Dữ liệu tiếng Đức.
/vault/lang/lang.en.fe.php | Dữ liệu tiếng Anh cho các front-end.
/vault/lang/lang.en.php | Dữ liệu tiếng Anh.
/vault/lang/lang.es.fe.php | Dữ liệu tiếng Tây Ban Nha cho các front-end.
/vault/lang/lang.es.php | Dữ liệu tiếng Tây Ban Nha.
/vault/lang/lang.fr.fe.php | Dữ liệu tiếng Pháp cho các front-end.
/vault/lang/lang.fr.php | Dữ liệu tiếng Pháp.
/vault/lang/lang.id.fe.php | Dữ liệu tiếng Indonesia cho các front-end.
/vault/lang/lang.id.php | Dữ liệu tiếng Indonesia.
/vault/lang/lang.it.fe.php | Dữ liệu tiếng Ý cho các front-end.
/vault/lang/lang.it.php | Dữ liệu tiếng Ý.
/vault/lang/lang.ja.fe.php | Dữ liệu tiếng Nhật cho các front-end.
/vault/lang/lang.ja.php | Dữ liệu tiếng Nhật.
/vault/lang/lang.ko.fe.php | Dữ liệu tiếng Hàn cho các front-end.
/vault/lang/lang.ko.php | Dữ liệu tiếng Hàn.
/vault/lang/lang.nl.fe.php | Dữ liệu tiếng Hà Lan cho các front-end.
/vault/lang/lang.nl.php | Dữ liệu tiếng Hà Lan.
/vault/lang/lang.pt.fe.php | Dữ liệu tiếng Bồ Đào Nha cho các front-end.
/vault/lang/lang.pt.php | Dữ liệu tiếng Bồ Đào Nha.
/vault/lang/lang.ru.fe.php | Dữ liệu tiếng Nga cho các front-end.
/vault/lang/lang.ru.php | Dữ liệu tiếng Nga.
/vault/lang/lang.th.fe.php | Dữ liệu tiếng Thái Lan cho các front-end.
/vault/lang/lang.th.php | Dữ liệu tiếng Thái Lan.
/vault/lang/lang.ur.fe.php | Dữ liệu tiếng Urdu cho các front-end.
/vault/lang/lang.ur.php | Dữ liệu tiếng Urdu.
/vault/lang/lang.vi.fe.php | Dữ liệu tiếng Việt cho các front-end.
/vault/lang/lang.vi.php | Dữ liệu tiếng Việt.
/vault/lang/lang.zh-tw.fe.php | Dữ liệu tiếng Trung Quốc (truyền thống) cho các front-end.
/vault/lang/lang.zh-tw.php | Dữ liệu tiếng Trung Quốc (truyền thống).
/vault/lang/lang.zh.fe.php | Dữ liệu tiếng Trung Quốc (giản thể) cho các front-end.
/vault/lang/lang.zh.php | Dữ liệu tiếng Trung Quốc (giản thể).
/vault/quarantine/ | Thư mục kiểm dịch (chứa các tập tin trong kiểm dịch).
/vault/quarantine/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/signatures/ | Thư mục cho chữ ký (chứa các tập tin cho chữ ký).
/vault/signatures/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/signatures/switch.dat | Điều khiển và định nghĩa biến.
/vault/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/cli.php | Tập tin cho xử lý CLI.
/vault/components.dat | Chứa thông tin liên quan đến các gói khác nhau của phpMussel; Được sử dụng bởi tính năng cập nhật được cung cấp bởi các front-end.
/vault/config.ini.RenameMe | Tập tin cho cấu hình; Chứa tất cả các tùy chọn cho cấu hình của phpMussel, nói cho nó biết phải làm gì và làm thế nào để hoạt động (đổi tên để kích hoạt).
/vault/config.php | Tập tin cho xử lý cấu hình.
/vault/config.yaml | Tập tin cho cấu hình mặc định; Chứa giá trị cấu hình mặc định cho phpMussel.
/vault/frontend.php | Tập tin cho xử lý các front-end.
/vault/functions.php | Tập tin cho chức năng.
/vault/greylist.csv | Tập tin CSV cho danh sách xám chử ký chỉ thị cho phpMussel cái nào chử ký nó phải được bỏ qua (tập tin tự động tạo lại nếu xóa).
/vault/lang.php | Dữ liệu tiếng.
/vault/php5.4.x.php | Polyfills cho PHP 5.4.X (cần cho khả năng tương thích ngược PHP 5.4.X; an toàn để xóa cho các phiên bản PHP mới hơn).
※ /vault/scan_kills.txt | Kỷ lục của mỗi tập tin tải lên từ chối/giết bởi phpMussel.
※ /vault/scan_log.txt | Kỷ lục của mỗi tập tin quét bởi phpMussel.
※ /vault/scan_log_serialized.txt | Kỷ lục của mỗi tập tin quét bởi phpMussel.
/vault/template_custom.html | Tập tin mẫu; Mẫu cho HTML sản xuất bởi phpMussel cho các thông điệp tải lên tập tin bị chặn (các thông điệp nhìn thấy bằng người tải lên).
/vault/template_default.html | Tập tin mẫu; Mẫu cho HTML sản xuất bởi phpMussel cho các thông điệp tải lên tập tin bị chặn (các thông điệp nhìn thấy bằng người tải lên).
/vault/themes.dat | Tập tin cho các chủ đề; Được sử dụng bởi tính năng cập nhật được cung cấp bởi các front-end.
/vault/upload.php | Tập tin cho xử lý tải lên.
/.gitattributes | Tập tin dự án cho GitHub (không cần thiết cho chức năng phù hợp của kịch bản).
/Changelog-v1.txt | Kỷ lục của những sự thay đổi được thực hiện cho các kịch bản khác nhau giữa các phiên bản (không cần thiết cho chức năng phù hợp của kịch bản).
/composer.json | Thông tin về dự án cho Composer/Packagist (không cần thiết cho chức năng phù hợp của kịch bản).
/CONTRIBUTING.md | Thông tin về làm thế nào để đóng góp cho dự án.
/LICENSE.txt | Bản sao của giấy phép GNU/GPLv2 (không cần thiết cho chức năng phù hợp của kịch bản).
/loader.php | Tập tin cho tải. Đây là điều bạn cần nối vào (cần thiết)!
/PEOPLE.md | Thông tin về những người trong dự án.
/README.md | Thông tin tóm tắt dự án.
/web.config | Tập tin cấu hình của ASP.NET (trong trường hợp này, để bảo vệ `/vault` thư mực khỏi bị truy cập bởi những nguồn không có quền trong trường hợp bản được cài trên serever chạy trên công nghệ ASP.NET).

※ Tên tập tin có thể thay đổi tuy theo các quy định của cấu hình (xem `config.ini`).

---


### 7. <a name="SECTION7"></a>TÙY CHỌN CHO CẤU HÌNH
Sau đây là danh sách các biến tìm thấy trong tập tin cấu hình cho phpMussel `config.ini`, cùng với một mô tả về mục đích và chức năng của chúng.

#### "general" (Thể loại)
Cấu hình chung cho phpMussel.

"cleanup"
- Hủy hoại biến và bộ nhớ được sử dụng bởi các kịch bản sau khi quét tải lên ban đầu? False = Không; True = Vâng [Mặc định]. Nếu bạn -không- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để `true` (vâng), để giảm thiểu sử dụng bộ nhớ. Nếu bạn -là- sử dụng các kịch bản vượt ra ngoài quét tải lên ban đầu, bạn nên đặt này để `false` (không), để tránh cần thiết tải lại dữ liệu trùng lặp vào bộ nhớ. Trong thực tế nói chung, nó thường nên được đặt để `true`, nhưng, nếu bạn làm điều này, bạn sẽ không thể sử dụng các kịch bản cho bất cứ điều gì khác hơn quét tải lên ban đầu.
- Không có ảnh hưởng trong CLI.

"scan_log"
- Tên của tập tin để ghi lại tất cả các kết quả quét. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_log_serialized"
- Tên của tập tin để ghi lại tất cả các kết quả quét (sử dụng một định dạng tuần tự). Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"scan_kills"
- Tên của tập tin để ghi lại tất cả hồ sơ của bị chặn hay bị giết tải lên. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

*Mẹo hữu ích: Nếu bạn muốn, bạn có thể bao gồm thông tin ngày/giờ trong tên các tập tin bản ghi (`scan_log`, `scan_log_serialized`, `scan_kills`, vv) của bạn bằng cách bao gồm những trong tên: `{yyyy}` cho năm hoàn thành, `{yy}` cho năm viết tắt, `{mm}` cho tháng, `{dd}` cho ngày, `{hh}` cho giờ.*

*Các ví dụ:*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- Dọn dẹp các bản ghi khi họ được một kích thước nhất định? Giá trị là kích thước tối đa bằng B/KB/MB/GB/TB mà một tập tin bản ghi có thể tăng lên trước khi bị dọn dẹp. Giá trị mặc định 0KB sẽ vô hiệu hoá dọn dẹp (các bản ghi có thể tăng lên vô hạn). Lưu ý: Áp dụng cho tập tin riêng biệt! Kích thước tập tin bản ghi không được coi là tập thể.

"timeOffset"
- Nếu thời gian máy chủ của bạn không phù hợp với thời gian địa phương của bạn, bạn có thể chỉ định một bù đắp đây để điều chỉnh thông tin ngày/giờ được tạo ra bởi phpMussel theo như yêu cầu của bạn. Nó nói chung được đề nghị điều chỉnh tùy chọn múi giờ trong `php.ini` tập tin của bạn, nhưng đôi khi (chẳng hạn như khi làm việc với dịch vụ lưu trữ mạng chia sẻ mà được giới hạn) đây không phải là luôn luôn có thể làm, và như vậy, tùy chọn này được cung cấp ở đây. Bù đắp là trong từ phút.
- Ví dụ (để thêm một giờ): `timeOffset=60`

"timeFormat"
- Định dạng ngày tháng sử dụng bởi phpMussel. Mặc định = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- Nơi để tìm thấy các địa chỉ IP của các yêu cầu kết nối? (Hữu ích cho các dịch vụ như thế Cloudflare và vv) Mặc định = REMOTE_ADDR. CẢNH BÁO: Không thay đổi này trừ khi bạn biết những gì bạn đang làm!

"enable_plugins"
- Cho phép hỗ trợ cho plugins của phpMussel? False = Không; True = Vâng [Mặc định].

"forbid_on_block"
- phpMussel nên gửi 403 Forbidden chúng với các thông điệp tải lên tập tin bị chặn, hoặc chỉ sử dụng 200 OK? False = Không (200); True = Vâng (403) [Mặc định].

"delete_on_sight"
- Bật tùy chọn này sẽ hướng dẫn các kịch bản để cố gắng xóa ngay lập tức bất kỳ đã quét tải lên tập tin mà phù hợp bất kỳ tiêu chí phát hiện, dù qua chữ ký hay thứ khác. Tập tin xác định là "sạch" sẽ không được bị chạm vào. Trong trường hợp kho lưu trữ, các toàn bộ kho lưu trữ sẽ bị xóa, bất kể nếu các tập tin vi phạm chỉ là một trong nhiều tập tin chứa trong các kho lưu trữ. Trong trường hợp quét tập tin tải lên, thông thường, nó không phải là cần thiết để kích hoạt tùy chọn này, bởi vì thông thường, PHP sẽ tự động tẩy các nội dung của bộ nhớ cache của nó khi thực hiện xong, điều đó có nghĩa là nó thường sẽ xóa bất kỳ tập tin tải lên thông qua nó đến máy chủ trừ khi họ đã được chuyển, sao chép hay xóa rồi. Tùy chọn này được thêm vào ở đây như một biện pháp bảo mật thêm cho những người có bản sao của PHP mà có thể không luôn luôn cư xử theo cách mong đợi. False = Sau khi quét, làm không có gì để các tập tin [Mặc định]; True = Sau khi quét, nếu không sạch, xóa ngay lập tức.

"lang"
- Xác định tiếng mặc định cho phpMussel.

"quarantine_key"
- phpMussel có thể kiểm dịch tải lên tập tin mà đã được đánh dấu trong sự cô lập trong vòng các vault của phpMussel, nếu đây là cái gì bạn muốn nó làm. Các người dùng bình thường của phpMussel mà chỉ đơn giản là muốn bảo vệ các môi trường kho lưu trữ hay trang mạng của họ, mà không có bất cứ quan tâm trong việc phân tích sâu sắc của bất kỳ tải lên tập tin mà đã được đánh dấu, nên để chức năng này bị vô hiệu hóa còn lại, nhưng bất kỳ người dùng quan tâm trong phân tích sâu hơn của tải lên tập tin mà đã được đánh dấu cho nghiên cứu phần mềm độc hại hay cho những thứ tương tự như vậy nên kích hoạt chức năng này. Các kiểm dịch của tải lên tập tin mà đã được đánh dấu đôi khi cũng có thể hỗ trợ trong việc gỡ lỗi sai tích cực, nếu đây là cái gì đó thường xuyên xảy ra đối với bạn. Để vô hiệu hóa chức năng kiểm dịch, chỉ đơn giản để lại tùy chọn `quarantine_key` trống rỗng, hay xóa nội dung của nó nếu nó không phải là đã trống rỗng. Để kích hoạt chức năng kiểm dịch, nhập một số giá trị vào các tùy chọn. `quarantine_key` là một tính năng bảo mật quan trọng của chức năng kiểm dịch yêu cầu như là một phương tiện cho ngăn chặn chức năng kiểm dịch được khai thác bởi kẻ tấn công tiềm năng và như một phương tiện ngăn chặn bất kỳ thực hiện tiềm năng của kho lưu trữ trong kiểm dịch. `quarantine_key` nên được đối xử theo cách tương tự như mật khẩu của bạn: Càng dài thì càng tốt, và cất giữ nó thật chặt. Đối với hiệu quả tốt nhất, sử dụng kết hợp với `delete_on_sight`.

"quarantine_max_filesize"
- Cho phép tối đa kích thước của tập tin để được kiểm dịch. Tập tin mà lớn hơn giá trị quy định sẽ KHÔNG được kiểm dịch. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Mặc định = 2MB.

"quarantine_max_usage"
- Cho phép tối đa sử dụng bộ nhớ cho kiểm dịch. Nếu tổng số sử dụng bộ nhớ bởi các kiểm dịch đạt giá trị này, các tập tin trong kiểm dịch cho dài nhất sẽ bị xóa cho đến khi các tổng bộ nhớ sử dụng không còn đạt giá trị này. Tùy chọn này là rất quan trọng như là một phương tiện làm cho nó khó khăn hơn cho bất kỳ kẻ tấn công tiềm năng lũ kiểm dịch của bạn với các dữ liệu không mong muốn, có khả năng gây ra việc sử dụng quá mức dữ liệu trên dịch vụ kho lưu trữ của bạn. Mặc định = 64MB.

"honeypot_mode"
- Khi chế độ honeypot được kích hoạt, phpMussel sẽ cố gắng kiểm dịch mỗi tập tin tải lên mà nó gặp, bất kể liệu tập tin được tải lên kích hoạt với bất kỳ chữ ký bao gồm, và không có quét hoặc phân tích của những tập tin tải lên thực sự sẽ xảy ra. Chức năng này sẽ hữu ích cho những ai muốn sử dụng phpMussel cho các mục đích của nghiên cứu cho vi rút hay phần mềm độc hại, nhưng nó không được khuyến khích để kích hoạt chức năng này nếu các mục đích sử dụng của phpMussel bởi người dùng là cho tải lên tập tin quét thực sự, cũng không được khuyến khích để sử dụng chức năng honeypot cho các mục đích khác hơn các honeypot. Theo mặc định, tùy chọn này bị vô hiệu hóa. False = Không cho phép [Mặc định]; True = Cho phép.

"scan_cache_expiry"
- Trong bao lâu phpMussel nên nhớ đệm kết quả quét? Giá trị là số giây để nhớ đệm các kết quả quét cho. Mặc định là 21600 giây (6 giờ); Giá trị 0 sẽ vô hiệu hóa bộ nhớ đệm kết quả quét.

"disable_cli"
- Vô hiệu hóa chế độ CLI? Chế độ CLI được kích hoạt theo mặc định, nhưng đôi khi có thể gây trở ngại cho công cụ kiểm tra nhất định (như PHPUnit, cho ví dụ) và khác ứng dụng mà CLI dựa trên. Nếu bạn không cần phải vô hiệu hóa chế độ CLI, bạn nên bỏ qua tùy chọn này. False = Kích hoạt chế độ CLI [Mặc định]; True = Vô hiệu hóa chế độ CLI.

"disable_frontend"
- Vô hiệu hóa truy cập front-end? Truy cập front-end có thể làm cho phpMussel dễ quản lý hơn, nhưng cũng có thể là một nguy cơ bảo mật tiềm năng. Đó là khuyến cáo để quản lý phpMussel từ các back-end bất cứ khi nào có thể, nhưng truy cập front-end là cung cấp khi nó không phải là có thể. Giữ nó vô hiệu hóa trừ khi bạn cần nó. False = Kích hoạt truy cập front-end; True = Vô hiệu hóa truy cập front-end [Mặc định].

"max_login_attempts"
- Số lượng tối đa cố gắng đăng nhập (front-end). Mặc định = 5.

"FrontEndLog"
- Tập tin cho ghi cố gắng đăng nhập front-end. Chỉ định một tên tập tin, hoặc để trống để vô hiệu hóa.

"disable_webfonts"
- Vô hiệu hóa webfonts? True = Vâng; False = Không [Mặc định].

#### "signatures" (Thể loại)
Cấu hình cho chữ ký.

"Active"
- Một danh sách các kích hoạt tập tin chữ ký, giới hạn bởi dấu phẩy.

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

#### "files" (Thể loại)
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

#### "attack_specific" (Thể loại)
Cấu hình chống lại tấn công cụ thể.

Phát hiện của tấn công tắc kè hoa: False = Tắt; True = Trên.

"chameleon_from_php"
- Tìm kiếm cho định danh PHP trong các tập tin mà không phải là PHP cũng không phải là kho lưu trữ được công nhận.

"chameleon_from_exe"
- Tìm kiếm cho định danh tập tin thực thi trong các tập tin mà không phải là tập tin thực thi cũng không phải là kho lưu trữ được công nhận, và cho tập tin thực thi tập tin mà có định danh sai.

"chameleon_to_archive"
- Tìm kiếm cho kho lưu trữ mà có định danh sai (Được hỗ trợ: BZ, GZ, RAR, ZIP, GZ).

"chameleon_to_doc"
- Tìm kiếm cho tài liệu văn phòng mà có định danh sai (Được hỗ trợ: DOC, DOT, PPS, PPT, XLA, XLS, WIZ).

"chameleon_to_img"
- Tìm kiếm cho hình ảnh mà có định danh sai (Được hỗ trợ: BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP).

"chameleon_to_pdf"
- Tìm kiếm cho tập tin PDF mà có định danh sai.

"archive_file_extensions"
- Được công nhận mở rộng cho tập tin kho lưu trữ (định dạng là CSV; chỉ nên thêm hay loại bỏ khi có vấn đề xảy ra; loại bỏ không cần thiết có thể gây ra sai tích cực để xuất hiện cho tập tin kho lưu trữ, trong khi thêm không cần thiết sẽ trong bản chất danh sách trắng những gì bạn đang thêm từ phát hiện cụ tấn công; sửa đổi với cách thận trọng; cũng lưu ý rằng điều này không có tác dụng liên quan đến những gì kho lưu trữ có thể và không thể được phân tích ở nội dung cấp). Danh sách này, như là mặc định, liệt kê các định dạng sử dụng phổ biến nhất trên phần lớn các hệ thống và CMS, nhưng là cố tình không nhất thiết phải toàn diện.

"block_control_characters"
- Chặn bất kỳ tập tin có chứa bất kỳ ký tự điều khiển (khác hơn so với dòng mới)? (`[\x00-\x08\x0b\x0c\x0e\x1f\x7f]`) Nếu bạn _**CHỈ**_ tải lên văn bản thô, thế thì bạn có thể kích hoạt tùy chọn này để cung cấp một số bảo vệ bổ sung để hệ thống của bạn. Tuy nhiên, nếu bạn tải lên bất cứ điều gì khác hơn văn bản thô, cho phép điều này có thể dẫn đến sai tích cực. False = Không chặn [Mặc định]; True = Chặn.

"corrupted_exe"
- Tập tin bị hỏng và phân tích lỗi. False = Bỏ qua; True = Chặn [Mặc định]. Phát hiện và chặn khả thi tập tin PE (portable executable / thực thi di động) bị hỏng? Thường (nhưng không phải lúc nào), khi khía cạnh cụ thể của một tập tin PE đang bị hỏng hay không thể được phân tích chính xác, nó có thể chỉ ra một nhiễm vi rút. Các quy trình được sử dụng bởi hầu hết các chương trình chống vi rút để phát hiện vi rút trong các tập tin PE đòi hỏi phải phân tích những tập tin theo một cách mà, nếu các lập trình viên của một vi rút là nhận thức của, cụ thể sẽ cố gắng để ngăn chặn, để cho phép vi rút của mình để không bị phát hiện.

"decode_threshold"
- Ngưỡng cho chiều dài của dữ liệu thô trong đó các lệnh giải mã nên được phát hiện (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Mặc định = 512KB. Số không hay số null vô hiệu hóa các ngưỡng (loại bỏ bất kỳ giới hạn dựa trên kích cỡ tập tin).

"scannable_threshold"
- Ngưỡng cho chiều dài của dữ liệu mà phpMussel được phép đọc và quét (trong trường hợp có bất kỳ vấn đề hiệu suất đáng chú ý trong khi quét). Mặc định = 32MB. Số không hay số null vô hiệu hóa các ngưỡng. Nói chung, giá trị này không nên được ít hơn kích thước trung bình của tải lên tập tin bạn muốn và mong đợi để nhận được đến máy chủ hay trang mạng của bạn, không nên được ít hơn tùy chọn filesize_limit, và không nên được ít hơn khoảng một phần năm tổng số cấp phát bộ nhớ cấp cho PHP thông qua tập tin cấu hình `php.ini`. Tùy chọn này tồn tại để cố gắng ngăn chặn phpMussel từ việc sử dụng quá nhiều bộ nhớ (mà sẽ ngăn chặn nó từ việc có thể quét các tập tin thành công trên một kích thước tập tin nhất định).

#### "compatibility" (Thể loại)
Cấu hình khả năng tương thích cho phpMussel.

"ignore_upload_errors"
- Nói chung, tùy chọn này nên bị vô hiệu hóa, trừ khi nó cần thiết cho chức năng đúng của phpMussel trên hệ thống cụ thể của bạn. Thông thường, khi bị vô hiệu, khi phpMussel phát hiện sự hiện diện của elements (yếu tố) trong array `$_FILES`, nó sẽ cố gắng để bắt đầu quét của các tập tin mà những yếu tố đại diện, và, nếu những yếu tố này là trống, phpMussel sẽ trả về thông báo lỗi. Đây là hành vi thích hợp cho phpMussel. Tuy nhiên, đối với một số CMS, phần tử rỗng trong `$_FILES` có thể xảy ra như là kết quả của các hành vi tự nhiên của những CMS, hay lỗi có thể được báo cáo khi không có bất kỳ, và trong trường hợp này, các hành vi tự nhiên cho phpMussel sẽ gây trở ngại với các hành vi bình thường của những CMS. Nếu một tình huống như vậy xảy ra cho bạn, bật tùy chọn này sẽ hướng dẫn phpMussel không cố gắng để bắt đầu quét cho phần tử rỗng, bỏ qua chúng khi tìm thấy và không trả lại bất kỳ thông báo lỗi liên quan, do đó cho phép tiếp tục của yêu cầu trang. False = TẮT; True = TRÊN.

"only_allow_images"
- Nếu bạn chỉ mong đợi hay chỉ có ý định để cho phép hình ảnh để được tải lên hệ thống hay CMS của bạn, và nếu bạn hoàn toàn không yêu cầu bất kỳ tập tin khác so với hình ảnh để được tải lên hệ thống hay CMS của bạn, tùy chọn này nên được kích hoạt, nhưng nếu không nên bị vô hiệu hóa. Nếu tùy chọn này được kích hoạt, nó sẽ hướng dẫn phpMussel để ngăn chặn bất kỳ tải lên bừa bãi xác định là các tập tin không phải hình ảnh, mà không cần quét chúng. Điều này có thể làm giảm thời gian xử lý và sử dụng bộ nhớ cho tải lên cố gắng của các tập tin không phải hình ảnh. False = TẮT; True = TRÊN.

#### "heuristic" (Thể loại)
Cấu hình cho "heuristic" (tìm kiếm / khám phá / tự học).

"threshold"
- Có một số chữ ký của phpMussel mà được dự định để xác định đáng ngờ và phẩm chất của các tập tin khả năng độc hại từ đang được tải lên mà không có trong tự xác định các tập tin đang được tải lên cụ thể như là độc hại. Giá trị "threshold" này nói với phpMussel tổng trọng lượng tối đa của đáng ngờ và phẩm chất của các tập tin khả năng độc hại đang được tải lên đó là phép trước những tập tin đang được gắn cờ là độc hại. Định nghĩa về trọng lượng trong bối cảnh này là tổng số đáng ngờ và phẩm chất tiềm ẩn độc hại được xác định. Theo mặc định, giá trị này sẽ được thiết lập để 3. Một giá trị thấp hơn nói chung sẽ cho kết quả trong một sự xuất hiện cao hơn của sai tích cực nhưng một số cao hơn các tập tin độc hại được gắn cờ, trong khi một giá trị cao hơn nói chung sẽ cho kết quả trong một sự xuất hiện thấp hơn của sai tích cực nhưng một số thấp hơn các tập tin độc hại được gắn cờ. Nói chung, nó là tốt nhất để có giá trị này tại mặc định của nó trừ khi bạn đang gặp phải các vấn đề liên quan đến nó.

#### "virustotal" (Thể loại)
Cấu hình cho VirusTotal.com.

"vt_public_api_key"
- Nếu bạn muốn, phpMussel có thể quét tập tin sử dụng các Virus Total API như một cách để cung cấp bảo vệ tăng cường rất nhiều chống lại vi rút, trojan, phần mềm độc hại và các mối đe dọa khác. Theo mặc định, quét của tập tin sử dụng các Virus Total API bị vô hiệu hóa. Để kích hoạt nó, một khóa API từ Virus Total là cần thiết. Do những lợi ích đáng kể rằng điều này có thể cung cấp cho bạn, nó là một cái gì đó mà tôi rất khuyên bạn nên cho phép. Xin hãy lưu ý, tuy nhiên, rằng để sử dụng các Virus Total API, bạn _**PHẢI**_ đồng ý với điều khoản dịch vụ của họ và bạn _**PHẢI**_ tuân theo tất cả các hướng dẫn như mô tả của các tài liệu của Virus Total! Bạn KHÔNG được phép để sử dụng tính năng hội nhập này TRỪ KHI:
  - Bạn đã đọc và đồng ý với các Điều khoản và Điều kiện của Virus Total và API của nó. Các Điều khoản và Điều kiện của Virus Total và API của nó có thể được tìm thấy [Ở ĐÂY](https://www.virustotal.com/en/about/terms-of-service/).
  - Bạn đã đọc và bạn hiểu, ở mức nhỏ nhất, lời mở đầu của các tài liệu API công cộng của Virus Total (mọi điều sau "VirusTotal Public API v2.0" nhưng trước "Contents"). Các tài liệu API công cộng của Virus Total có thể được tìm thấy [Ở ĐÂY](https://www.virustotal.com/en/documentation/public-api/).

Lưu ý: Nếu quét tập tin sử dụng các Virus Total API bị vô hiệu hóa, bạn sẽ không cần phải xem xét bất kỳ tùy chọn trong thể loại này (`virustotal`), bởi vì không ai trong số họ sẽ làm bất cứ điều gì nếu bị vô hiệu hóa này. Để có được một khóa API của Virus Total, từ bất cứ nơi nào trên trang mạng của họ, nhấp vào liên kết "Tham gia cộng đồng" nằm phía trên cùng bên phải của trang, nhập vào các thông tin yêu cầu, và nhấp vào "Đăng ký" khi thực hiện. Thực hiện theo các hướng dẫn được cung cấp, và khi bạn đã có khóa API công cộng của bạn, sao chép và dán khóa API công cộng của bạn vào tùy chọn `vt_public_api_key` của các tập tin cấu hình `config.ini`.

"vt_suspicion_level"
- Theo mặc định, phpMussel sẽ hạn chế các tập tin nó quét bằng cách sử dụng Virus Total API đến các tập tin mà nó coi như là "đáng ngờ". Bạn có thể tùy chọn điều chỉnh hạn chế này bằng cách thay đổi các giá trị của tùy chọn `vt_suspicion_level`.
- `0`: Các tập tin được chỉ được coi là đáng ngờ nếu, khi được quét bởi phpMussel sử dụng chữ ký riêng của mình, họ được coi là mang một trọng lượng dựa trên kinh nghiệm ("heuristic weight"). Điều này có hiệu quả có nghĩa sử dụng các Virus Total API sẽ là cho một ý kiến thứ cho khi phpMussel nghi ngờ rằng một tập tin khả năng có thể độc hại, nhưng không thể hoàn toàn loại trừ mà nó cũng có thể có khả năng là lành tính (không độc hại) và vì thế sẽ nói chung sẽ không chặn nó hay đánh dấu nó như được độc hại.
- `1`: Các tập tin được coi là đáng ngờ nếu, khi được quét bởi phpMussel sử dụng chữ ký riêng của mình, họ được coi là mang một trọng lượng dựa trên kinh nghiệm ("heuristic weight"), nếu họ đang được biết đến là thực thi (tập tin PE, Mach-O, ELF/Linux, vv), hay nếu họ đang được biết đến là một định dạng rằng có khả năng chứa dữ liệu thực thi (chẳng hạn như macro thực thi, tập tin DOC/DOCX, tập tin kho lưu trữ như thế RAR, ZIP và vv). Đây là mặc định và được đề nghị mức độ nghi ngờ để áp dụng, hiệu quả có nghĩa sử dụng các Virus Total API sẽ là cho một ý kiến thứ cho khi phpMussel ban đầu không tìm thấy bất cứ điều gì độc hại hay nguy hiểm với một tập tin mà nó cho là đáng ngờ và vì thế sẽ nói chung sẽ không chặn nó hay đánh dấu nó như được độc hại.
- `2`: Tất cả các tập tin được coi đáng ngờ và nên được quét bằng cách sử dụng các Virus Total API. Tôi không thường khuyên bạn nên áp dụng mức độ nghi ngờ này, bởi vì các nguy cơ của đạt hạn ngạch API của bạn nhanh hơn nhiều so với nếu không sẽ là trường tình huống, nhưng có những trường tình huống nhất định (chẳng hạn như khi các quản trị, quản trị web hay hostmaster có rất ít niềm tin hay lòng tin bất cứ điều gì trong bất kỳ nội dung tải lên của người dùng của họ) theo đó mức độ nghi ngờ này sẽ được thích hợp. Với mức độ nghi ngờ này, tất cả các tập tin mà không thường bị khoá hay bị đánh dấu như được độc hại sẽ được quét bằng cách sử dụng các Virus Total API. Chú thích, tuy nhiên, mà phpMussel sẽ ngừng sử dụng các Virus Total API khi hạn ngạch API của bạn đã đạt được (bất kể mức độ nghi ngờ), và mà hạn ngạch của bạn có khả năng sẽ đạt được nhanh hơn khi sử dụng mức độ nghi ngờ này.

Lưu ý: Bất kể mức độ nghi ngờ, bất kỳ tập tin được vào danh sách đen hoặc vào danh sách trắng bởi phpMussel sẽ không được quét bằng cách sử dụng các Virus Total API, bởi vì những tập tin như vậy đã có thể đã được công bố như độc hại hay vô hại bởi phpMussel bởi thời gian mà họ sẽ có cách khác được quét bởi các Virus Total API, và vì thế, quét bổ sung sẽ không được yêu cầu. Khả năng của phpMussel để quét các tập tin sử dụng các Virus Total API là nhằm xây dựng tự tin hơn nữa cho nếu một tập tin là độc hại hoặc vô hại trong những hoàn cảnh trong đó phpMussel chinh no là không hoàn toàn chắc chắn về việc liệu một tập tin là độc hại hoặc vô hại.

"vt_weighting"
- phpMussel nên áp dụng các kết quả quét từ sử dụng Virus Total API như các phát hiện hoặc như các cân nặng phát hiện? Tùy chọn này tồn tại, bởi vì, mặc dù quét một tập tin sử dụng nhiều công cụ (như Virus Total làm) nên dẫn đến một tỷ lệ phát hiện tăng (và do đó ở một số cao hơn các tập tin độc hại bị bắt), nó cũng có thể dẫn đến một số cao hơn của sai tích cực, và vì thế, trong một số trường hợp, các kết quả quét có thể là tốt hơn sử dụng như một điểm tự tin chứ không phải là một kết luận dứt khoát. Nếu giá trị 0 được sử dụng, các kết quả quét từ sử dụng Virus Total API sẽ được áp dụng như phát hiện, và vì thế, nếu bất kỳ công cụ được sử dụng bởi Virus Total đánh dấu các tập tin được quét như độc hại, phpMussel sẽ cân nhắc các tập tin đến được độc hại. Nếu bất kỳ giá trị nào khác được sử dụng, các kết quả quét từ sử dụng Virus Total API sẽ được áp dụng như cân nặng phát hiện, và vì thế, các số lượng động cơ được sử dụng bởi Virus Total mà đánh dấu các tập tin được quét như được độc hại sẽ phục vụ như là một điểm tin (hay cân nặng phát hiện) cho nếu các tập tin được quét nên được xem như độc hại bởi phpMussel (giá trị sử dụng sẽ đại diện cho số điểm tin cậy hay cân nặng tối thiểu mà là cần thiết để có thể được coi độc hại). Giá trị 0 được sử dụng bởi mặc định.

"vt_quota_rate" và "vt_quota_time"
- Theo tài liệu VirusTotal API, nó được giới hạn tối đa là 4 yêu cầu của bất kỳ chất trong bất kỳ khung thời gian 1 phút nào. Nếu bạn chạy một honeyclient, honeypot hay bất kỳ tự động hóa khác sẽ là cung cấp các nguồn lực để VirusTotal và không chỉ sẽ là lấy báo cáo bạn có quyền được một hạn ngạch có yêu cầu cao hơn. Theo mặc định, phpMussel nghiêm sẽ tuân thủ những hạn chế, nhưng do khả năng của các hạn ngạch yêu cầu đang được tăng lên, hai tùy chọn này được cung cấp như một phương tiện để bạn có thể hướng dẫn phpMussel như những gì giới hạn nó phải tuân thủ. Trừ khi bạn đã được hướng dẫn làm như vậy, nó không được khuyến khích cho bạn để tăng các giá trị, nhưng, nếu bạn đã gặp phải vấn đề liên quan đến hạn ngạch của bạn, giảm các giá trị _**CÓ THỂ**_ đôi khi giúp bạn trong việc đối phó với những vấn đề này. Hạn ngạch yêu cầu của bạn được xác định như `vt_quota_rate` yêu cầu của bất kỳ chất trong bất kỳ khung thời gian `vt_quota_time` phút nào.

#### "urlscanner" (Thể loại)
Một máy quét URL được bao gồm với phpMussel, khả năng phát hiện các URL độc hại từ bên trong bất kỳ dữ liệu hay tập tin được quét.

Lưu ý: Nếu máy quét URL bị vô hiệu hóa, bạn sẽ không cần phải xem xét bất kỳ tùy chọn trong phần này (`urlscanner`), bởi vì không một ai trong số họ sẽ làm bất cứ điều gì nếu bị vô hiệu hóa này.

Cấu hình cho tra cứu API của máy quét URL.

"lookup_hphosts"
- Cho phép tra cứu API đến API của [hpHosts](http://hosts-file.net/) khi xác định như true. hpHosts không yêu cầu một khóa API để thực hiện tra cứu API.

"google_api_key"
- Cho phép tra cứu API đến API của Google Safe Browsing khi khóa API cần thiết được xác định. Tra cứu đến API của Google Safe Browsing yêu cầu một khoá API, mà có thể thu được từ [Ở ĐÂY](https://console.developers.google.com/).
- Lưu ý: Phần mở rộng "cURL" là cần thiết để sử dụng tính năng này.

"maximum_api_lookups"
- Số lượng tối đa cho phép của tra cứu API để thực hiện mỗi quét lặp cá nhân. Bởi vì mỗi tra cứu API thêm sẽ thêm vào tổng thời gian cần thiết để hoàn thành mỗi quét lặp, bạn có thể muốn để quy định một giới hạn để đẩy nhanh các quá trình quét tổng thể. Khi thiết lập để 0, không số lượng tối đa cho phép sẽ được áp dụng. Đặt 10 theo mặc định.

"maximum_api_lookups_response"
- Phải làm gì nếu số lượng tối đa cho phép của tra cứu API được vượt quá? False = Không làm gì cả (tiếp tục chế biến) [Mặc định]; True = Dấu/Chặn các tập tin.

"cache_time"
- Kết quả tra cứu API nên được lưu trữ trong (trong giây) bao lâu? Mặc định là 3600 giây (1 giờ).

#### "template_data" (Thể loại)
Cấu hình cho mẫu thiết kế và chủ đề.

Dữ liệu mẫu thiết kế liên quan đến đầu ra HTML sử dụng để tạo ra các thông báo "Sự tải lên đã bị từ chối" hiển thị cho người dùng khi một tải lên tập tin bị chặn. Nếu bạn đang sử dụng chủ đề tùy chỉnh cho phpMussel, đầu ra HTML có nguồn gốc từ tập tin `template_custom.html`, và nếu không thì, đầu ra HTML có nguồn gốc từ tập tin `template.html`. Biến bằng văn bản cho phần này của tập tin cấu hình được xử lý để đầu ra HTML bằng cách thay thế bất kỳ tên biến được bao quanh bởi các dấu ngoặc nhọn tìm thấy trong đầu ra HTML với các dữ liệu biến tương ứng. Ví dụ, ở đâu `foo="bar"`, bất kỳ trường hợp `<p>{foo}</p>` tìm thấy trong đầu ra HTML sẽ trở thành `<p>bar</p>`.

"theme"
- Chủ đề mặc định để sử dụng cho phpMussel.

"css_url"
- Tập tin mẫu thiết kế cho chủ đề tùy chỉnh sử dụng thuộc tính CSS bên ngoài, trong khi các tập tin mẫu thiết kế cho các chủ đề mặc định sử dụng thuộc tính CSS nội bộ. Để hướng dẫn phpMussel để sử dụng các tập tin mẫu thiết kế cho chủ đề tùy chỉnh, xác định các địa chỉ HTTP cho các tập tin CSS chủ đề tùy chỉnh của bạn sử dụng các biến số `css_url`. Nếu bạn để cho biến số này chỗ trống, phpMussel sẽ sử dụng các tập tin mẫu thiết kế cho các chủ đề mặc định.

---


### 8. <a name="SECTION8"></a>ĐỊNH DẠNG CỦA CHỬ KÝ

#### *CHỮ KÝ CHO TÊN TẬP TIN*
Tất cả các chữ ký cho tên tập tin tuân theo các định dạng:

`NAME:FNRX`

NAME là tên cho các chữ ký và FNRX là mô hình biểu thức chính quy để kiểm tra tên tập tin (không mã hóa).

#### *CHỮ KÝ DỰA MD5*
Tất cả các chữ ký dựa MD5 tuân theo các định dạng:

`HASH:FILESIZE:NAME`

HASH là băm MD5 của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và NAME là tên cho các chữ ký.

#### *CHỮ KÝ PHẦN PE*
Tất cả các chữ ký phần PE tuân theo các định dạng:

`SIZE:HASH:NAME`

HASH là băm MD5 của một phần của một tập tin PE, SIZE là tổng kích thước của phần đó và NAME là tên cho các chữ ký.

#### *CHỮ KÝ KÉO DÀI PE*
Tất cả các chữ ký kéo dài PE tuân theo các định dạng:

`$VAR:HASH:SIZE:NAME`

$VAR là tên của các biến PE để kiểm tra, HASH là băm MD5 của biến đó, SIZE là tổng kích thước biến và NAME là tên cho các chữ ký.

#### *CHỮ KÝ DANH SÁCH TRẮNG*
Tất cả các chữ ký danh sách trắng tuân theo các định dạng:

`HASH:FILESIZE:TYPE`

HASH là băm MD5 của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và TYPE là các loại chữ ký các danh sách trắng tập tin là để được miễn dịch chống lại.

#### *CHỮ KÝ KÉO DÀI PHỨC TẠP*
Chữ ký kéo dài phức tạp là khá khác nhau với các loại khác của chữ ký có thể với phpMussel, trong ý nghĩa rằng những gì họ đang kiểm tra cho được quy định bởi những chữ ký tự và họ có thể kiểm tra cho nhiều tiêu chí. Các tiêu chí được giới hạn bởi ";" và các loại kiểm tra và dữ liệu kiểm tra cho từng tiêu chí được giới hạn bởi ":" như vậy mà định dạng cho những chữ ký trông hơi giống như:

`$Biến_Số1:Một_Số_Dữ_Liệu;$Biến_Số2:Một_Số_Dữ_Liệu;Tên_Chữ_Ký`

#### *MỌI THỨ KHÁC*
Tất cả các chữ ký khác làm theo các định dạng:

`NAME:HEX:FROM:TO`

NAME là tên cho các chữ ký và HEX là một phân khúc thập lục phân mã hóa của các tập tin dự định để được xuất hiện bởi các chữ ký. FROM và TO là thông số tùy chọn, cho thấy nơi trong nguồn dữ liệu, bắt đầu và kết thúc, để kiểm tra lại.

#### *BIỂU THỨC CHÍNH QUY*
Bất kỳ cách thức biểu thức chính quy hiểu và xử lý một cách chính xác qua PHP cũng nên được hiểu hiểu và xử lý một cách chính xác bởi phpMussel và chữ ký của nó. Tuy nhiên, tôi muốn đề nghị lấy hết sức thận trọng khi viết chữ ký biểu thức chính quy mới, bởi vì, nếu bạn không hoàn toàn chắc chắn bạn đang làm gì vậy, có thể có kết quả rất bất thường hay bất ngờ. Nhìn vào các mã nguồn nếu bạn không hoàn toàn về bối cảnh rằng họ đang phân tích cú pháp. Ngoài ra, nhớ lại rằng tất cả mọi thứ (ngoại trừ tên tập tin, cú pháp, siêu dữ liệu kho lưu trữ và mẫu MD5) phải được mã hóa hệ thập lục phân!

---


### 9. <a name="SECTION9"></a>NHỮNG VẤN ĐỀ HỢP TƯƠNG TÍCH

#### PHP và PCRE
- phpMussel cần PHP và PCRE để thực hiện và hoạt động. Nếu không có PHP, hoạc không có PCRE thêm của PHP, phpMussel sẽ không thực hiện và hoạt động bình thường. Bạn nên chắc chắc rằng hệ thống của bạn có PHP và PCRE cài vào và có sẵn trước khi tải và cài đặt phpMussel.

#### KHẢ NĂNG TƯƠNG THÍCH PHẦN MỀM CHỐNG VI RÚT

Cho hầu hết các phần, phpMussel sẽ tương hợp với hầu hết các phần mềm quét vi rút khác. Nhưng mà, có một số người dùng trong quá khứ đã báo cáo một số vấn đề. Thông tin dưới đây là từ VirusTotal.com, và nó miêu tả một số giả tích cực báo cáo bởi các chương trình chống vi rút khác nhau chống phpMussel. Mặc dù thông tin này không đảm bảo nếu bạn gặp phải vấn đề tương hợp giữa phpMussel và phần mềm chống vi rút của bạn, nếu phần mềm chống vi rút của bạn được ghi nhận là cách gắn cờ chống lại phpMussel, bạn nên tắt nó trước khi sử dụng phpMussel hoặc nên xét các lựa chọn khác cho một trong hai phần mềm chống vi rút của bạn hoặc phpMussel.

Thông tin này được cập nhật lần cứơi vào ngày 29 Tháng Tám 2016 và có thể áp dụng cho phpMussel công bố hai loại phiên bản nhỏ mới nhất (v0.10.0-v1.0.0) vào thời gian cái này được viết.

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
| Bkav                 |  Báo cáo "VEXC640.Webshell", "VEXD737.Webshell", "VEX5824.Webshell", "VEXEFFC.Webshell"|
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


### 10. <a name="SECTION10"></a>NHỮNG CÂU HỎI THƯỜNG GẶP (FAQ)

#### "Chữ ký" là gì?

In the context of phpMussel, a "signature" refers to data that acts as an indicator/identifier for something specific that we're looking for, usually in the form of some very small, distinct, innocuous segment of something larger and otherwise harmful, like a virus or trojan, or in the form of a file checksum, hash, or other similarly identifying indicator, and usually includes a label, and some other data to help provide additional context that can be used by phpMussel to determine the best way to proceed when it encounters what we're looking for.

#### "Sai tích cực" là gì?

Nghĩa của "sai tích cực" (*hay: "lỗi sai tích cực"; "báo động giả"*; Tiếng Anh: *false positive*; *false positive error*; *false alarm*), mô tả rất đơn giản, và trong một bối cảnh tổng quát, được sử dụng khi kiểm tra cho một điều kiện, để tham khảo các kết quả của bài kiểm tra, khi kết quả là tích cực (hay, điều kiện được xác định là "tích cực", hay "đúng"), nhưng dự kiến sẽ được (hay cần phải có được) tiêu cực (hay, điều kiện, thực tế, là "tiêu cực", hay "sai"). "Sai tích cực" có thể được coi là điều tương tự như "khóc sói" (theo đó các điều kiện đang được kiểm tra là liệu có con sói gần đàn, điều kiện là "sai" bởi vì không có con sói gần đàn, và điều kiện được báo cáo là "tích cực" bởi các người chăn bằng cách gọi "sói, sói"), hay tương tự như tình huống trong thử nghiệm y tế theo đó một bệnh nhân được chẩn đoán là có một số bệnh, trong khi thực tế, họ không có bất kỳ số bệnh.

Một số các từ ngữ khác sử dụng là "đúng tích cực", "đúng tiêu cực" và "sai tiêu cực". "Đúng tích cực" đề cập đến khi các kết quả kiểm tra và tình trạng thực tế của điều kiện là cả hai đúng (hay "tích cực"), và "đúng tiêu cực" đề cập đến khi các kết quả kiểm tra và tình trạng thực tế của điều kiện là cả hai sai (hay "tiêu cực"); "Đúng tích cực" hay "đúng tiêu cực" được coi là một "suy luận đúng". Các phản đề của "sai tích cực" là "sai tiêu cực"; "Sai tiêu cực" đề cập đến khi các kết quả kiểm tra là tiêu cực (hay, điều kiện được xác định là "tiêu cực", hay "sai"), nhưng dự kiến sẽ được (hay cần phải có được) tích cực (hay, điều kiện, thực tế, là "tích cực", hay "đúng").

Trong bối cảnh phpMussel, các từ ngữ đề cập đến chữ ký của phpMussel và các tập tin mà họ chặn. Khi phpMussel chặn một tập tin bởi vì chữ ký của nó là xấu, lỗi thời hay không chính xác, nhưng không nên làm như vậy, hay khi nó làm như vậy vì những lý do sai, chúng tôi đề cập đến sự kiện này như "sai tích cực". Khi phpMussel không chặn một tập tin đó nên đã bị chặn, bởi vì mối đe dọa khó lường, chữ ký mất tích hay thiếu sót trong chữ ký, chúng tôi đề cập đến sự kiện này như "phát hiện mất tích" (which is analogous to a "sai tiêu cực").

Điều này có thể được tóm tắt bằng bảng dưới đây:

&nbsp; | phpMussel *KHÔNG* nên chặn một tập tin | phpMussel *NÊN* chặn một tập tin
---|---|---
phpMussel *KHÔNG* chặn một tập tin | Đúng tiêu cực (suy luận đúng) | Phát hiện mất tích (điều tương tự như sai tiêu cực)
phpMussel chặn một tập tin | __Sai tích cực__ | Đúng tích cực (suy luận đúng)

#### Tần suất cập nhật chữ ký là bao nhiêu?

Tần suất cập nhật thay đổi tùy thuộc vào các tập tin chữ ký trong câu hỏi. Nói chung là, tất cả các người bảo trì cho các tất cả tập tin chữ ký cố gắng đảm bảo rằng chữ ký của họ được cập nhật càng nhiều càng tốt, nhưng bởi vì tất cả chúng ta đều có nhiều cam kết khác, cuộc sống của chúng ta bên ngoài dự án, và bởi vì không ai trong chúng ta được bồi thường tài chính (hay được thanh toán) cho các nỗ lực dự án của chúng tôi, Một lịch trình cập nhật chính xác không thể được đảm bảo. Nói chung là, chữ ký được cập nhật bất cứ khi nào có đủ thời gian để cập nhật chúng, và các người bảo trì cố gắng ưu tiên dựa trên sự cần thiết và dựa trên tần suất của thay đổi giữa các phạm vi. Trợ giúp luôn được đánh giá cao nếu bạn sẵn sàng cung cấp bất kỳ.

#### Tôi đã gặp một vấn đề trong khi sử dụng phpMussel và tôi không biết phải làm gì về nó! Hãy giúp tôi!

- Bạn đang sử dụng phiên bản mới nhất của phần mềm? Bạn đang sử dụng phiên bản mới nhất của tập tin chữ ký của bạn? Nếu câu trả lời cho một trong hai những câu hỏi này là không, cố gắng cập nhật mọi thứ đầu tiên, và kiểm tra nếu vấn đề vẫn còn. Nếu nó vẫn còn, tiếp tục đọc.
- Bạn đã kiểm tra tất cả các tài liệu chưa? Nếu không, xin hãy làm như vậy. Nếu vấn đề không thể giải quyết bằng cách sử dụng tài liệu, hãy tiếp tục đọc.
- Bạn đã kiểm tra các **[trang vấn đề](https://github.com/Maikuolan/phpMussel/issues)** chưa, để xem nếu vấn đề đã được đề cập trước đó? Nếu nó đã được đề cập trước đó, kiểm tra nếu có bất kỳ đề xuất, ý tưởng, hay giải pháp đã được cung cấp, và làm theo như là cần thiết để cố gắng giải quyết vấn đề.
- Bạn đã kiểm tra các **[diễn đàn hỗ trợ cho phpMussel cung cấp bởi Spambot Security](http://www.spambotsecurity.com/forum/viewforum.php?f=55)** chưa, để xem nếu vấn đề đã được đề cập trước đó? Nếu nó đã được đề cập trước đó, kiểm tra nếu có bất kỳ đề xuất, ý tưởng, hay giải pháp đã được cung cấp, và làm theo như là cần thiết để cố gắng giải quyết vấn đề.
- Nếu vấn đề vẫn còn, vui lòng nói cho chúng tôi bằng cách bắt đầu một cuộc thảo luận mới trên các trang vấn đề hoặc các diễn đàn hỗ trợ.

#### Tôi muốn sử dụng phpMussel với phiên bản PHP cũ hơn 5.4.0; Bạn có thể giúp?

Không. PHP 5.4.0 đạt EoL ("End of Life", hoặc sự kết thúc của cuộc sống) chính thức vào năm 2014, và hỗ trợ an ninh mở rộng đã được chấm dứt vào năm 2015. Khi viết này, nó là năm 2017, và PHP 7.1.0 đã có sẵn. Tại thời điểm này, hỗ trợ được cung cấp để sử dụng phpMussel với PHP 5.4.0 và tất cả các phiên bản PHP có sẵn mới hơn, nhưng nếu bạn cố gắng sử dụng phpMussel với bất kỳ phiên bản PHP lớn hơn, hỗ trợ sẽ không được cung cấp.

#### Tôi có thể sử dụng một cài đặt phpMussel để bảo vệ nhiều tên miền?

Vâng. Cài đặt phpMussel không bị khóa vào các tên miền cụ thể, và do đó có thể được sử dụng để bảo vệ nhiều tên miền. Nói chung là, chúng tôi đề cập đến cài đặt phpMussel chỉ bảo vệ một miền như "cài đặt miền đơn" ("single-domain installations"), và chúng tôi đề cập đến cài đặt phpMussel bảo vệ nhiều miền hay miền phụ như "cài đặt nhiều miền" ("multi-domain installations"). Nếu bạn sử dụng một cài đặt nhiều miền và cần phải sử dụng các bộ tập tin chữ ký khác nhau cho các miền khác nhau, hoặc cần phpMussel được cấu hình khác nhau cho các miền khác nhau, điều này có thể làm được. Sau khi tải tập tin cấu hình (`config.ini`), phpMussel sẽ kiểm tra sự tồn tại của một "tập tin ghi đè cấu hình" cụ thể cho miền được yêu cầu (`miền-được-yêu-cầu.tld.config.ini`), và nếu được tìm thấy, bất kỳ giá trị cấu hình nào được xác định bởi tập tin ghi đè cấu hình sẽ được sử dụng cho trường hợp thực hiện thay vì các giá trị cấu hình được định nghĩa bởi tệp tin cấu hình. Các tập tin ghi đè cấu hình giống với tập tin cấu hình, và tùy theo quyết định của bạn, có thể chứa toàn bộ các chỉ thị cấu hình sẵn có cho phpMussel, hoặc bất kỳ phần bắt buộc nào mà khác với các giá trị được xác định bởi tệp tin cấu hình. Các tập tin ghi đè cấu hình được đặt tên theo miền mà chúng được dự định (vì vậy, ví dụ, nếu bạn cần một tập tin ghi đè cấu hình cho miền, `http://www.some-domain.tld/`, các tập tin ghi đè cấu hình của nó nên được đặt tên là `some-domain.tld.config.ini`, và nên được đặt trong vault với tệp tin cấu hình, `config.ini`). Tên miền cho trường hợp thực hiện được bắt nguồn từ header (tiêu đề) `HTTP_HOST` của các yêu cầu; "www" bị bỏ qua.

---


Lần cuối cập nhật: 19 Tháng Năm 2017 (2017.05.19).
