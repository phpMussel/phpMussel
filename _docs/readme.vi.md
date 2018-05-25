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
- 11. [THÔNG TIN HỢP PHÁP](#SECTION11)

*Lưu ý về bản dịch: Trong trường hợp có sai sót (ví dụ, sự khác biệt giữa bản dịch, lỗi chính tả, vv), phiên bản tiếng Anh của README được coi là phiên bản gốc và có thẩm quyền. Nếu bạn tìm thấy bất kỳ lỗi, giúp đỡ của bạn trong việc điều chỉnh họ sẽ được hoan nghênh.*

---


### 1. <a name="SECTION1"></a>LỜI GIỚI THIỆU

Cảm ơn bạn đã chọn phpMussel, một loại bản PHP được thiết kế để phát hiện trojan, vi rút, phần mềm đọc hại và những gì có thể gây nguy hiểm trong những các tập tin tài lên trên máy của bạn. Bất cứ nơi nào mà bản đã được nối, dưa trên chử ký của ClamAV và những người khác.

BẢN QUYỀN PHPMUSSEL 2013 và hơn GNU/GPLv2 by Caleb M (Maikuolan).

Bản này là chương trình miễn phí; bạn có thể phân phối lại hoạc sửa đổi dưới điều kiện của GNU Giấy Phép Công Cộng xuất bản bởi Free Software Foundation; một trong giấy phép phần hai, hoạc (tùy theo sự lựa chọn của bạn) bất kỳ phiên bản nào sau này. Bản này được phân phối với hy vọng rằng nó sẽ có hữu ích, nhưng mà KHÔNG CÓ BẢO HÀNH; ngay cả những bảo đảm ngụ ý KHẢ NĂNG BÁN HÀNG hoạc PHÙ HỢP VỚI MỤC ĐÍT VÀO. Hảy xem GNU Giấy Phép Công Cộng để biết them chi tiết, nằm trong tập tin `LICENSE.txt`, và kho chứa của tập tin này có thể tiềm đước tại:
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

Chân thành cám ơn [ClamAV](http://www.clamav.net/) cho cả hai nguồn cảm hứng cho chương trình này và những chữ ký kịch bản này sử dụng, mà nếu không, bản này sẽ không có cơ hội tồn tại, hoặc ít nhất, sẽ có giá trị rất nhỏ.

Chân thành cám ơn SourceForge và GitHub cho cung cấp một nơi cho các tập tin dự án, và những người cung cấp một số các chữ ký thêm mà được sử dụng bởi phpMussel: [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) vân vân, và chân thành cảm ơn những người đã ủng hộ chương trình này, và bất cứ ai khác mà tôi quên cảm ơn, và bạn, đã sử dụng bản này.

Tài liệu này và các gói liên quan của nó có thể được tải về miễn phí từ:
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>CÁCH CÀI ĐẶT

#### 2.0 CÀI ĐẶT THỦ CÔNG (CHO CÁC TRANG MẠNG)

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Từ đây, bạn sẽ muốn đặt nội dung ở một nơi trên máy chủ hoặc CMS của bạn. Một thư mục chẳng hạn như `/public_html/phpmussel/` hay tương tự (mặc dù sự lựa chọn của bạn không quan trọng, miễn là nó an toàn và bạn hài lòng với sự lựa chọn) sẽ đủ.. *Trước khi bạn bắt đầu tải lên, hảy tiếp tục đọc..*

2) Đổi tên `config.ini.RenameMe` đến `config.ini` (nằm bên trong `vault`), và nếu bạn muốn (đề nghị mạnh mẽ cho người dùng cao cấp, nhưng không đề nghị cho người mới bắt đầu hay cho người thiếu kinh nghiệm), mở nó (tập tin này bao gồm tất cả các tùy chọn có sẵn cho phpMussel; trên mỗi tùy chọn nên có một nhận xét ngắn gọn mô tả những gì nó làm và những gì nó cho). Điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho tập hợp cụ thể của bạn lên. Lưu tập tin, đóng.

3) Tải nội dung lên (phpMussel và tập tin của nó) vào thư mục bạn đã chọn trước (bạn không cần phải dùng tập tin `*.txt`/`*.md`, nhưng chủ yếu, bạn nên tải lên tất cả mọi thứ).

4) CHMOD thư mục `vault` thành "755" (nếu có vấn đề, bạn có thể thử "777", mặc dù này là kém an toàn). Các thư mục chính kho lưu trữ các nội dung (một trong những cái bạn đã chọn trước), bình thường, có thể riêng, nhưng tình hình CHMOD nên kiểm tra, nếu bạn đã có vấn đề cho phép trong quá khứ về hệ thống của bạn (theo mặc định, nên giống như "755").

5) Cài đặt bất kỳ chữ ký mà bạn sẽ cần. *Xem: [CÀI ĐẶT CHỮ KÝ](#INSTALLING_SIGNATURES).*

6) Tiếp theo, bạn sẽ cần "nối" phpMussel vào hệ thống của bạn hay CMS. Có một số cách mà bạn có thể "nối" bản chẳng hạn như phpMussel vào hệ thống hoạc CMS, nhưng cách đơn giản nhất là cần có bản vào cốt lõi ở đầu của tập tin hoạc hệ thống hay CMS của bạn (một mà thường sẽ luôn luôn được nạp khi ai đó truy cập bất kỳ trang nào trên trang mạng của bạn) bằng cách sử dụng một lời chỉ thị `require` hoạc `include`. Thường, cái nàu sẽ được lưu trong một thư mục như `/includes`, `/assets` hoạc `/functions`, và sẽ thường được gọi là `init.php`, `common_functions.php`, `functions.php` hoạc tương tự. Bạn sẽ cần tiềm ra tập tin nào cho trường hợp của bạn; Nếu bạn gặp khó khăn trong việc này, hãy truy các trang issues (các vấn đề) của phpMussel hay cập diễn đàn hỗ trợ của phpMussel và cho chúng tôi biêt; Có thể là tôi họac các người dùng khác có có kinh nghiệm với các CMS mà bạn đang sử dụng (bạn phải biết mình đang sử dụng CMS nào), và như vậy, có thể cung cấp hỗ trợ trong trường hợp này. Để làm chuyện này [sử dụng `require` họac `include`], đánh các dòng mã sao đây vào đầu của cốt lõi của tập tin, thay thế các dây chứa bên trong các dấu ngoặc kép với địa chỉ chính xác của tập tin `loader.php` (địa chỉ địa phương, chứ không phải địa chỉ HTTP; nó sẽ nhình gióng địa chỉ kho nói ở trên).

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

Lưu tập tin, đóng lại, tải lên lại.

-- CÁCH KHÁC --

Nếu bạn đang sử dụng trang chủ Apache và nếu bạn có thể truy cập `php.ini`, bạn có thể sử dụng `auto_prepend_file` chỉ thị để thêm vào trước phpMussel bất cứ khi nào bất kỳ yêu cầu PHP được xin. Gióng như:

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

Hoạc cái này trong tập tin `.htaccess`:

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) Tại điểm này, bạn đã xong! Nhưng mà, bạn nên kiểm tra nó ra để đảm bảo nó hoạt động đúng. Để kiểm tra các tập tin tải lên bảo vệ, thử tải lên các tập tin thử nghiệm bao gồm trong gói dưới `_testfiles` vào trang mạng của bạn thông qua các phương pháp tải lên dựa trên trình duyệt thông thường của bạn. Nếu tất cả mọi thứ đang hoạt động, một tin nhắn sẽ xuất hiện từ phpMussel xác nhận là việc tải lên đã bị chặn thành công. Nếu không có gì xuất hiện, đây là điều biểu hiện cho một vấn đề với sự hoạt động. Nếu bạn đang sử dụng chức năng cao cấp, hay sử dụng các loại chức năng quét khác có thể với công cụ này, bạn nên thử nó ra với những điều đó để đảm bảo nó hoạt động như yêu cầu.

#### 2.1 CÀI ĐẶT THỦ CÔNG (CHO CLI)

1) Nếu bạn đang đọc cái này thì tôi hy vọng là bạn đã tải về một bản sao kho lưu trữ của bản, giải nén nội dung của nó và nó đang nằm ở một nơi nào đó trên máy tính của bạn. Một khi bạn đã hài lòng với vị trí của phpMussel, hày tiếp tục.

2) phpMussel cần PHP được cài đặt trên máy chủ để thực hiện. Nếu bạn không có PHP cài trên máy, xin hảy cài PHP, theo hướng dẫn được cung cấp bởi người cài đặt PHP.

3) Theo tùy chọn (khuyến khích những người dùng cao cấp, nhưng những người mới bắt đầu hay chưa có kinh nghiệm không nên chọn), hảy mở `config.ini` (nằm ớ trong `vault`) – Tập tin này có chứa tất cả các chỉ thị sẵn cho phpMussel. Trên mỗi tùy chọn sẽ có chi tiết ngắn mô tả những gì nó làm. Hảy điều chỉnh các tùy chọn như bạn thấy phù hợp, theo bất cứ điều gì là thích hợp cho nhữn cài đặt của bạn. Lưu tập tin, đóng lại.

4) Tùy ý, bạn có thể sử dụng phpMussel trong chế độ CLI dể hơn với cách tạo ra tập tin lô để tự động tải PHP và phpMussel. Để làm điều này, mở một chương trình văn bản đơn giản như Notepad hoạc Notepad++, đánh vào đường dẫn đầy đủ cho tập tin `php.exe` trong thư mục cài đặt PHP của bạn, tiếp theo là một khoảng trống, theo sau là đường dẫn đầy đủ đến tập tin `loader.php` trong thư mục cài đặt phpMussel của bạn, lưu tập tin với tư bổ sung `.bat` một nơi nào bạn sẽ tìm thấy dễ dàng, và nhấn đúp vào vào tập tin đó để chạy phpMussel trong tương lai.

5) Cài đặt bất kỳ chữ ký mà bạn sẽ cần. *Xem: [CÀI ĐẶT CHỮ KÝ](#INSTALLING_SIGNATURES).*

6) Tại thời điểm này, bạ đã xong! Nhưng mà, bạn nên kiểm tra nó để đảm bảo sự hoạt động. Để kiểm tra phpMussel, chạy phpMussel và thử quét `_testfiles` thư mục cung cấp trong gói.

#### 2.2 CÀI ĐẶT VỚI COMPOSER

[phpMussel được đăng ký với Packagist](https://packagist.org/packages/phpmussel/phpmussel), và như vậy, nếu bạn đã quen với Composer, bạn có thể sử dụng Composer để cài đặt phpMussel (bạn vẫn cần phải chuẩn bị cấu hình và kết nối; xem "cài đặt thủ công (cho các trang mạng)" bước 2 và 6).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 CÀI ĐẶT CHỮ KÝ

Kể từ v1.0.0, chữ ký không được bao gồm trong gói phpMussel. Chữ ký được yêu cầu bởi phpMussel để phát hiện các mối đe dọa cụ thể. Có 3 phương pháp chính để cài đặt chữ ký:

1. Cài đặt tự động bằng cách sử dụng trang cập nhật của front-end.
2. Tạo chữ ký bằng cách sử dụng "SigTool" và cài đặt thủ công.
3. Tải xuống chữ ký từ "phpMussel/Signatures" và cài đặt thủ công.

##### 2.3.1 Cài đặt tự động bằng cách sử dụng trang cập nhật của front-end.

Thứ nhất, bạn sẽ cần đảm bảo rằng front-end được kích hoạt. *Xem: [QUẢN LÝ FRONT-END](#SECTION4).*

Sau đó, tất cả những gì bạn cần làm là vào trang cập nhật của front-end, tìm các tập tin chữ ký cần thiết, và bằng cách sử dụng các tùy chọn được cung cấp trên trang, cài đặt chúng, và kích hoạt chúng.

##### 2.3.2 Tạo chữ ký bằng cách sử dụng "SigTool" và cài đặt thủ công.

*Xem: [Tài liệu SigTool](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 Tải xuống chữ ký từ "phpMussel/Signatures" và cài đặt thủ công.

Thứ nhất, đi đến [phpMussel/Signatures](https://github.com/phpMussel/Signatures). Kho chứa các tập tin chữ ký nén GZ khác nhau. tải về các tập tin mà bạn cần, giải nén chúng, và sao chép các tập tin giải nén vào thư mục `/vault/signatures` để cài đặt chúng. Liệt kê tên của các tập tin sao chép vào chỉ thị `Active` trong cấu hình phpMussel của bạn để kích hoạt chúng.

---


### 3. <a name="SECTION3"></a>CÁCH SỬ DỤNG

#### 3.0 CÁCH SỬ DỤNG (CHO CÁC TRANG MẠNG)

phpMussel sẽ có thể hoạt động một cách chính xác với yêu cầu tối thiểu từ bạn: Sau khi cài đặt nó, nó có thể được sử dụng ngay lập tức.

Quét tập tin tải lên là tự động và kích hoạt theo mặc định, như vậy không có gì là cần thiết từ bạn cho các chức năng đặc biệt này.

Tuy nhiên, bạn cũng có thể nói với phpMussel để quét tập tin cụ thể, thư mục hay kho lưu trữ. Để làm điều này, trước hết, bạn sẽ cần phải đảm bảo rằng các cấu hình thích hợp được thiết lập trong tập tin `config.ini` (`cleanup` phải được vô hiệu hóa), và khi thực hiện, trong một tập tin PHP được kết nối với phpMussel, sử dụng sau đây trong mã của bạn:

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` có thể là một string, hoặc một hay nhiều của array, và chỉ ra đó tập tin hay thư mục để quét.
- `$output_type` là một boolean, và chỉ ra đó định dạng cho kết quả quét được trả về như. `false` hướng dẫn các chức năng để trả về kết quả là một số nguyên. `true` hướng dẫn các chức năng trả lại kết quả dưới dạng văn bản có thể đọc được con người. Ngoài ra, trong cả hai trường hợp, kết quả có thể được truy cập thông qua biến toàn cầu sau khi quét đã hoàn thành. Biến này là tùy chọn, mặc định là `false`. Sau đây mô tả các kết quả số nguyên:

| Các kết quả | Sự miêu tả |
|---|---|
| -3 | Chỉ ra rằng vấn đề gặp phải với các tập tin chữ ký hay tập tin chữ ký bản đồ và rằng họ có thể bị mất hay bị hỏng. |
| -2 | Chỉ ra rằng dữ liệu bị hỏng đã được phát hiện trong quá trình quét và như vậy quét không hoàn thành. |
| -1 | Chỉ ra rằng mở rộng hay bổ sung theo yêu cầu của PHP để thực hiện quá trình quét bị mất tích và như vậy quét không hoàn thành. |
| 0 | Chỉ ra rằng mục tiêu quét không tồn tại và như vậy không có gì để quét. |
| 1 | Chỉ ra rằng các mục tiêu đã được quét thành công và không có vấn đề đã được phát hiện. |
| 2 | Chỉ ra rằng các mục tiêu đã được quét thành công và vấn đề đã được phát hiện. |

- `$output_flatness` là một boolean, chỉ ra cho các chức năng liệu có nên trả lại kết quả quét (khi có nhiều mục tiêu quét) như là một array hoặc một string. `false` sẽ trả lại kết quả như là một array. `true` sẽ trả lại kết quả như là một string. Biến này là tùy chọn, mặc định là `false`.

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

Đối với một phân tích đầy đủ những gì sắp xếp của chữ ký phpMussel sử dụng trong quá trình quét của nó và cách nó xử lý chữ ký của nó, tham khảo các phần [ĐỊNH DẠNG CỦA CHỬ KÝ](#SECTION8) của tập tin README này.

Nếu bạn gặp bất kỳ sai tích cực, nếu bạn gặp một số điều mới bạn nghĩ rằng nên bị chặn, hay cho bất cứ điều gì khác có liên quan đến chữ ký, xin vui lòng liên hệ với tôi vì vậy mà tôi có thể thực hiện các thay đổi cần thiết, mà, nếu bạn không liên hệ với tôi, tôi có thể không nhất thiết phải nhận thức được. *(Xem: ["Sai tích cực" là gì?](#WHAT_IS_A_FALSE_POSITIVE)).*

Để vô hiệu hóa chữ ký đã bao gồm trong phpMussel (chẳng hạn như nếu bạn gặp một sai tích cực và bạn không thể loại bỏ nó), đặt tên của chữ ký cụ thể để được vô hiệu hóa vào tập tin danh sách xám chữ ký (`/vault/greylist.csv`), được phân cách bằng dấu phẩy.

*Xem thêm: [Làm thế nào để truy cập chi tiết cụ thể về các tập tin khi chúng được quét?](#SCAN_DEBUGGING)*

#### 3.1 CÁCH SỬ DỤNG (CHO CLI)

Tham khảo phần "CÀI ĐẶT THỦ CÔNG (CHO CLI)" của tập tin README này.

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
- <https://youtu.be/H-Pa740-utc>

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
/vault/fe_assets/_cache.html | Một tập tin mẫu HTML cho các trang dữ liệu cache của front-end.
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
/vault/fe_assets/_quarantine.html | Một tập tin mẫu HTML cho các trang kiểm dịch của front-end.
/vault/fe_assets/_quarantine_row.html | Một tập tin mẫu HTML cho các trang kiểm dịch của front-end.
/vault/fe_assets/_statistics.html | Một tập tin mẫu HTML cho các trang thống kê của front-end.
/vault/fe_assets/_updates.html | Một tập tin mẫu HTML cho các trang cập nhật của front-end.
/vault/fe_assets/_updates_row.html | Một tập tin mẫu HTML cho các trang cập nhật của front-end.
/vault/fe_assets/_upload_test.html | Một tập tin mẫu HTML cho các trang kiểm tra tải lên.
/vault/fe_assets/frontend.css | CSS định kiểu cho các front-end.
/vault/fe_assets/frontend.dat | Cơ sở dữ liệu cho các front-end (chứa thông tin tài khoản và phiên; chỉ tạo ra nếu front-end được kích hoạt và sử dụng).
/vault/fe_assets/frontend.html | Các chính tập tin mẫu HTML cho các front-end.
/vault/fe_assets/icons.php | Tập tin cho các biểu tượng (được sử dụng bởi các quản lý tập tin front-end).
/vault/fe_assets/pips.php | Tập tin cho các pip (được sử dụng bởi các quản lý tập tin front-end).
/vault/fe_assets/scripts.js | Chứa dữ liệu JavaScript cho front-end.
/vault/lang/ | Chứa dữ liệu tiếng cho phpMussel.
/vault/lang/.htaccess | Tập tin "hypertext access" / tập tin truy cập siêu văn bản (bảo vệ tập tin bí mật khỏi bị truy cập bởi nguồn không được ủy quyền).
/vault/lang/lang.ar.fe.php | Dữ liệu tiếng Ả Rập cho các front-end.
/vault/lang/lang.ar.php | Dữ liệu tiếng Ả Rập.
/vault/lang/lang.bn.fe.php | Dữ liệu tiếng Bengal cho các front-end.
/vault/lang/lang.bn.php | Dữ liệu tiếng Bengal.
/vault/lang/lang.de.fe.php | Dữ liệu tiếng Đức cho các front-end.
/vault/lang/lang.de.php | Dữ liệu tiếng Đức.
/vault/lang/lang.en.fe.php | Dữ liệu tiếng Anh cho các front-end.
/vault/lang/lang.en.php | Dữ liệu tiếng Anh.
/vault/lang/lang.es.fe.php | Dữ liệu tiếng Tây Ban Nha cho các front-end.
/vault/lang/lang.es.php | Dữ liệu tiếng Tây Ban Nha.
/vault/lang/lang.fr.fe.php | Dữ liệu tiếng Pháp cho các front-end.
/vault/lang/lang.fr.php | Dữ liệu tiếng Pháp.
/vault/lang/lang.hi.fe.php | Dữ liệu tiếng Hindi cho các front-end.
/vault/lang/lang.hi.php | Dữ liệu tiếng Hindi.
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
/vault/lang/lang.tr.fe.php | Dữ liệu tiếng Thổ Nhĩ Kỳ cho các front-end.
/vault/lang/lang.tr.php | Dữ liệu tiếng Thổ Nhĩ Kỳ.
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
/vault/.travis.php | Được sử dụng bởi Travis CI để thử nghiệm (không cần thiết cho chức năng phù hợp của kịch bản).
/vault/.travis.yml | Được sử dụng bởi Travis CI để thử nghiệm (không cần thiết cho chức năng phù hợp của kịch bản).
/vault/cli.php | Tập tin cho xử lý CLI.
/vault/components.dat | Chứa thông tin liên quan đến các gói khác nhau của phpMussel; Được sử dụng bởi tính năng cập nhật được cung cấp bởi các front-end.
/vault/config.ini.RenameMe | Tập tin cho cấu hình; Chứa tất cả các tùy chọn cho cấu hình của phpMussel, nói cho nó biết phải làm gì và làm thế nào để hoạt động (đổi tên để kích hoạt).
/vault/config.php | Tập tin cho xử lý cấu hình.
/vault/config.yaml | Tập tin cho cấu hình mặc định; Chứa giá trị cấu hình mặc định cho phpMussel.
/vault/frontend.php | Tập tin cho xử lý front-end.
/vault/frontend_functions.php | Tập tin cho chức năng front-end.
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
/.gitignore | Tập tin dự án cho GitHub (không cần thiết cho chức năng phù hợp của kịch bản).
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

"log_rotation_limit"
- Xoay vòng nhật ký giới hạn số lượng của tập tin nhật ký có cần tồn tại cùng một lúc. Khi các tập tin nhật ký mới được tạo, nếu tổng số lượng tập tin nhật ký vượt quá giới hạn được chỉ định, hành động được chỉ định sẽ được thực hiện. Bạn có thể chỉ định giới hạn mong muốn tại đây. Giá trị 0 sẽ vô hiệu hóa xoay vòng nhật ký.

"log_rotation_action"
- Xoay vòng nhật ký giới hạn số lượng của tập tin nhật ký có cần tồn tại cùng một lúc. Khi các tập tin nhật ký mới được tạo, nếu tổng số lượng tập tin nhật ký vượt quá giới hạn được chỉ định, hành động được chỉ định sẽ được thực hiện. Bạn có thể chỉ định hành động mong muốn tại đây. Delete = Xóa các tập tin nhật ký cũ nhất, cho đến khi giới hạn không còn vượt quá. Archive = Trước tiên lưu trữ, và sau đó xóa các tập tin nhật ký cũ nhất, cho đến khi giới hạn không còn vượt quá.

*Làm rõ kỹ thuật: Trong ngữ cảnh này, "cũ nhất" có nghĩa là không được sửa đổi gần đây.*

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

"numbers"
- Chỉ định cách hiển thị số.

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
- Vô hiệu hóa các webfont? True = Vâng [Mặc định]; False = Không.

"maintenance_mode"
- Bật chế độ bảo trì? True = Vâng; False = Không [Mặc định]. Vô hiệu hoá mọi thứ khác ngoài các front-end. Đôi khi hữu ích khi cập nhật CMS, framework của bạn, vv.

"default_algo"
- Xác định thuật toán nào sẽ sử dụng cho tất cả các mật khẩu và phiên trong tương lai. Tùy chọn: PASSWORD_DEFAULT (mặc định), PASSWORD_BCRYPT, PASSWORD_ARGON2I (yêu cầu PHP >= 7.2.0).

"statistics"
- Giám sát thống kê sử dụng phpMussel? True = Vâng; False = Không [Mặc định].

"allow_symlinks"
- Đôi khi phpMussel không thể truy cập tập tin trực tiếp khi nó được đặt tên theo một cách nhất định. Việc truy cập tập tin gián tiếp thông qua các symlink (liên kết tượng trưng) đôi khi có thể giải quyết vấn đề này. Tuy nhiên, đây không phải lúc nào cũng là một giải pháp khả thi, bởi vì trên một số hệ thống, sử dụng các symlink (liên kết tượng trưng) có thể bị cấm, hoặc có thể cần đặc quyền hành chính. Chỉ thị này được sử dụng để xác định liệu phpMussel nên cố gắng sử dụng các symlink (liên kết tượng trưng) để truy cập các tập tin gián tiếp, khi truy cập trực tiếp vào chúng thì không thể. True = Cho phép các symlink; False = Không cho phép các symlink [Mặc định].

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

"detect_encryption"
- phpMussel nên phát hiện và chặn các tập tin mật mã? False = Không; True = Vâng [Mặc định].

"detect_joke_hoax"
- phpMussel nên sử dụng chữ ký cho phát hiện câu nói đùa và chơi khăm phần mềm độc hại và vi rút? False = Không; True = Vâng [Mặc định].

"detect_pua_pup"
- phpMussel nên sử dụng chữ ký cho phát hiện các PUA/PUP? False = Không; True = Vâng [Mặc định].

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
- Nếu hệ thống của bạn chỉ cho phép các loại tập tin cụ thể được tải lên, hay nếu hệ thống của bạn từ chối một cách rõ ràng các loại tập tin cụ thể, xác định các loại tập tin trong danh sách trắng, danh sách đen và danh sách xám có thể tăng tốc độ quét được tiến hành bằng cách cho phép các kịch bản bỏ qua các loại tập tin nhất định. Định dạng là CSV (dấu phẩy ngăn cách giá trị). Nếu bạn muốn quét tất cả mọi thứ, thay vì sử dụng danh sách trắng, danh sách đen hay danh sách xám, để lại những biến trống; Làm như vậy sẽ vô hiệu hóa danh sách trắng/đen/xám.
- Thứ tự hợp lý của chế biến là:
  - Nếu loại tập tin là trên danh sách trắng, không quét và không chặn các tập tin, và không kiểm tra các tập tin chống lại danh sách đen hay danh sách xám.
  - Nếu loại tập tin là trên danh sách đen, không quét các tập tin nhưng chặn nó dù sao, và không kiểm tra các tập tin chống lại danh sách xám.
  - Nếu danh sách xám là trống hay nếu danh sách xám không phải là trống và các loại tập tin là danh sách xám, quét các tập tin như bình thường và xác định xem có chặn nó dựa trên kết quả của quá trình quét, nhưng nếu danh sách xám không phải là trống và các loại tập tin không phải trên danh sách xám, điều trị các tập tin như thể nó là trên danh sách đen, vì thế không quét nó nhưng chặn nó dù sao.

"check_archives"
- Cố gắng để kiểm tra nội dung của kho lưu trữ? False = Không kiểm tra; True = Kiểm tra [Mặc định].
- Tại thơi điểm nay, các chỉ định dạng kho lưu trữ và nén được hỗ trợ là BZ/BZIP2, GZ/GZIP, LZF, PHAR, TAR và ZIP (định dạng kho lưu trữ và nén RAR, CAB, 7z và vân vân không được hỗ trợ tại thơi điểm nay).
- Đây không phải là hoàn hảo! Trong khi tôi rất khuyên bạn nên giữ này được kích hoạt, tôi không thể đảm bảo nó sẽ luôn luôn tìm thấy tất cả mọi thứ.
- Cũng lưu ý kho lưu trữ kiểm tra là không đệ quy cho PHAR hay ZIP.

"filesize_archives"
- Thừa kế danh sách đen/trắng cho kích thước của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều); True = Vâng [Mặc định].

"filetype_archives"
- Thừa kế danh sách đen/trắng cho loại tập tin của tập tin trong kho lưu trữ? False = Không (chỉ danh sách xám mọi điều) [Mặc định]; True = Vâng.

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

#### "legal" (Thể loại)
Cấu hình mà liên quan đến các nghĩa vụ hợp pháp.

*Để biết thêm thông tin về các nghĩa vụ hợp pháp và cách nó có thể ảnh hưởng đến các nghĩa vụ cấu hình của bạn, vui lòng tham khảo phần "[THÔNG TIN HỢP PHÁP](#SECTION11)" của các tài liệu.*

"pseudonymise_ip_addresses"
- Pseudonymise địa chỉ IP khi viết các tập tin nhật ký? True = Vâng; False = Không [Mặc định].

"privacy_policy"
- Địa chỉ của chính sách bảo mật liên quan được hiển thị ở chân trang của bất kỳ trang nào được tạo. Chỉ định URL, hoặc để trống để vô hiệu hóa.

#### "template_data" (Thể loại)
Cấu hình cho mẫu thiết kế và chủ đề.

Dữ liệu mẫu thiết kế liên quan đến đầu ra HTML sử dụng để tạo ra các thông báo "Sự tải lên đã bị từ chối" hiển thị cho người dùng khi một tải lên tập tin bị chặn. Nếu bạn đang sử dụng chủ đề tùy chỉnh cho phpMussel, đầu ra HTML có nguồn gốc từ tập tin `template_custom.html`, và nếu không thì, đầu ra HTML có nguồn gốc từ tập tin `template.html`. Biến bằng văn bản cho phần này của tập tin cấu hình được xử lý để đầu ra HTML bằng cách thay thế bất kỳ tên biến được bao quanh bởi các dấu ngoặc nhọn tìm thấy trong đầu ra HTML với các dữ liệu biến tương ứng. Ví dụ, ở đâu `foo="bar"`, bất kỳ trường hợp `<p>{foo}</p>` tìm thấy trong đầu ra HTML sẽ trở thành `<p>bar</p>`.

"theme"
- Chủ đề mặc định để sử dụng cho phpMussel.

"Magnification"
- Phóng to chữ. Mặc định = 1.

"css_url"
- Tập tin mẫu thiết kế cho chủ đề tùy chỉnh sử dụng thuộc tính CSS bên ngoài, trong khi các tập tin mẫu thiết kế cho các chủ đề mặc định sử dụng thuộc tính CSS nội bộ. Để hướng dẫn phpMussel để sử dụng các tập tin mẫu thiết kế cho chủ đề tùy chỉnh, xác định các địa chỉ HTTP cho các tập tin CSS chủ đề tùy chỉnh của bạn sử dụng các biến số `css_url`. Nếu bạn để cho biến số này chỗ trống, phpMussel sẽ sử dụng các tập tin mẫu thiết kế cho các chủ đề mặc định.

---


### 8. <a name="SECTION8"></a>ĐỊNH DẠNG CỦA CHỬ KÝ

*Xem thêm:*
- *["Chữ ký" là gì?](#WHAT_IS_A_SIGNATURE)*

9 byte đầu tiên `[x0-x8]` của một tập tin chữ ký cho phpMussel là `phpMussel`, và hoạt động như một "số ma thuật" (magic number), để xác định chúng như tập tin chữ ký (điều này giúp ngăn ngừa phpMussel vô tình cố gắng sử dụng các tập tin mà không phải là tập tin chữ ký). Byte tiếp theo `[x9]` xác định loại tập tin chữ ký, mà phpMussel phải biết để có thể giải thích chính xác các tập tin chữ ký. Các loại tập tin chữ ký sau đây được nhận dạng:

Loại | Byte | Sự miêu tả
---|---|---
`General_Command_Detections` | `0?` | Cho các tập tin chữ ký CSV (giá trị được phân cách bằng dấu phẩy). Giá trị (chữ ký) là các chuỗi được mã hoá bằng hệ thập lục phân để tìm kiếm trong các tệp. Chữ ký ở đây không có bất kỳ tên hoặc các chi tiết khác (chỉ có các chuỗi để phát hiện).
`Filename` | `1?` | Cho các chữ ký tên tập tin.
`Hash` | `2?` | Cho các chữ ký băm.
`Standard` | `3?` | Cho các tập tin chữ ký mà làm việc trực tiếp với nội dung tập tin.
`Standard_RegEx` | `4?` | Cho các tập tin chữ ký mà làm việc trực tiếp với nội dung tập tin. Chữ ký có thể chứa các biểu thức chính quy.
`Normalised` | `5?` | Cho các tập tin chữ ký mà làm việc với nội dung tập tin bình thường hóa ANSI.
`Normalised_RegEx` | `6?` | Cho các tập tin chữ ký mà làm việc với nội dung tập tin bình thường hóa ANSI. Chữ ký có thể chứa các biểu thức chính quy.
`HTML` | `7?` | Cho các tập tin chữ ký mà làm việc với nội dung tập tin bình thường hóa HTML.
`HTML_RegEx` | `8?` | Cho các tập tin chữ ký mà làm việc với nội dung tập tin bình thường hóa HTML. Chữ ký có thể chứa các biểu thức chính quy.
`PE_Extended` | `9?` | Cho các tập tin chữ ký mà làm việc với siêu dữ liệu PE (nhưng không phải siêu dữ liệu PE phần).
`PE_Sectional` | `A?` | Cho các tập tin chữ ký mà làm việc với siêu dữ liệu PE phần.
`Complex_Extended` | `B?` | Cho các tập tin chữ ký mà làm việc với các quy tắc khác nhau dựa trên siêu dữ liệu mở rộng tạo bởi phpMussel.
`URL_Scanner` | `C?` | Cho các tập tin chữ ký mà làm việc với các URL.

Byte kế tiếp `[x10]` là một dòng mới `[0A]`, và kết luận tiêu đề của tập tin chữ ký cho phpMussel.

Mỗi dòng không rỗng sau đó là một chữ ký hoặc quy tắc. Mỗi chữ ký hoặc quy tắc chiếm một dòng. Các định dạng chữ ký được hỗ trợ được mô tả dưới đây.

#### *CHỮ KÝ CHO TÊN TẬP TIN*
Tất cả các chữ ký cho tên tập tin tuân theo các định dạng:

`NAME:FNRX`

NAME là tên cho các chữ ký và FNRX là mô hình biểu thức chính quy để kiểm tra tên tập tin (không mã hóa).

#### *CHỮ KÝ BĂM*
Tất cả các chữ ký băm tuân theo các định dạng:

`HASH:FILESIZE:NAME`

HASH là băm (thường là MD5) của toàn bộ tập tin, FILESIZE là tổng dung lượng tập tin và NAME là tên cho các chữ ký.

#### *CHỮ KÝ PHẦN PE*
Tất cả các chữ ký phần PE tuân theo các định dạng:

`SIZE:HASH:NAME`

HASH là băm MD5 của một phần của một tập tin PE, SIZE là tổng kích thước của phần đó và NAME là tên cho các chữ ký.

#### *CHỮ KÝ KÉO DÀI PE*
Tất cả các chữ ký kéo dài PE tuân theo các định dạng:

`$VAR:HASH:SIZE:NAME`

$VAR là tên của các biến PE để kiểm tra, HASH là băm MD5 của biến đó, SIZE là tổng kích thước biến và NAME là tên cho các chữ ký.

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

Thông tin này được cập nhật lần cứơi vào ngày 2017.12.01 và có thể áp dụng cho phpMussel công bố hai loại phiên bản nhỏ mới nhất (v1.0.0-v1.1.0) vào thời gian cái này được viết.

*Thông tin này chỉ áp dụng cho gói chính. Kết quả có thể khác nhau dựa trên tập tin chữ ký đã cài đặt, plugin, và các thành phần ngoại vi khác.*

| Chương trình quét | Kết quả |
|---|---|
| AVware | Báo cáo "BPX.Shell.PHP" |
| Bkav | Báo cáo "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>NHỮNG CÂU HỎI THƯỜNG GẶP (FAQ)

- ["Chữ ký" là gì?](#WHAT_IS_A_SIGNATURE)
- ["Sai tích cực" là gì?](#WHAT_IS_A_FALSE_POSITIVE)
- [Tần suất cập nhật chữ ký là bao nhiêu?](#SIGNATURE_UPDATE_FREQUENCY)
- [Tôi đã gặp một vấn đề trong khi sử dụng phpMussel và tôi không biết phải làm gì về nó! Hãy giúp tôi!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [Tôi muốn sử dụng phpMussel với phiên bản PHP cũ hơn 5.4.0; Bạn có thể giúp?](#MINIMUM_PHP_VERSION)
- [Tôi có thể sử dụng một cài đặt phpMussel để bảo vệ nhiều tên miền?](#PROTECT_MULTIPLE_DOMAINS)
- [Tôi không muốn lãng phí thời gian bằng cách cài đặt này và đảm bảo rằng nó hoạt động với trang web của tôi; Tôi có thể trả tiền cho bạn để làm điều đó cho tôi?](#PAY_YOU_TO_DO_IT)
- [Tôi có thể thuê bạn hay bất kỳ nhà phát triển nào của dự án này cho công việc riêng tư?](#HIRE_FOR_PRIVATE_WORK)
- [Tôi cần sửa đổi chuyên môn, tuỳ chỉnh, vv; Bạn có thể giúp?](#SPECIALIST_MODIFICATIONS)
- [Tôi là nhà phát triển, nhà thiết kế trang web, hay lập trình viên. Tôi có thể chấp nhận hay cung cấp các công việc liên quan đến dự án này không?](#ACCEPT_OR_OFFER_WORK)
- [Tôi muốn đóng góp cho dự án; Tôi có thể làm được điều này?](#WANT_TO_CONTRIBUTE)
- [Giá trị được đề xuất cho "ipaddr".](#RECOMMENDED_VALUES_FOR_IPADDR)
- [Làm thế nào để truy cập chi tiết cụ thể về các tập tin khi chúng được quét?](#SCAN_DEBUGGING)
- [Tôi có thể sử dụng cron để cập nhật tự động không?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [Có thể phpMussel quét các tập tin có tên không ANSI?](#SCAN_NON_ANSI)
- [Danh sách đen – Danh sách trắng – Danh sách xám – Họ là gì, và làm cách nào để sử dụng chúng?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>"Chữ ký" là gì?

Trong bối cảnh của phpMussel, "chữ ký" đề cập đến dữ liệu hoạt động như một chỉ thị hay cơ chế định danh cho một cái gì đó cụ thể mà chúng tôi đang tìm kiếm, thường là một đoạn nhỏ và không nguy hiểm của một cái gì đó lớn hơn và có hại, chẳng hạn như vi rút hoặc trojan, hoặc, một tập tin băm, hoặc các chỉ số nhận dạng tương tự khác, và nó thường bao gồm một nhãn, và một số dữ liệu khác để giúp cung cấp bối cảnh bổ sung mà có thể được sử dụng bởi phpMussel để xác định cách tốt nhất để tiến hành khi nó gặp những gì chúng ta đang tìm kiếm.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>"Sai tích cực" là gì?

Nghĩa của "sai tích cực" (*hay: "lỗi sai tích cực"; "báo động giả"*; Tiếng Anh: *false positive*; *false positive error*; *false alarm*), mô tả rất đơn giản, và trong một bối cảnh tổng quát, được sử dụng khi kiểm tra cho một điều kiện, để tham khảo các kết quả của bài kiểm tra, khi kết quả là tích cực (hay, điều kiện được xác định là "tích cực", hay "đúng"), nhưng dự kiến sẽ được (hay cần phải có được) tiêu cực (hay, điều kiện, thực tế, là "tiêu cực", hay "sai"). "Sai tích cực" có thể được coi là điều tương tự như "khóc sói" (theo đó các điều kiện đang được kiểm tra là liệu có con sói gần đàn, điều kiện là "sai" bởi vì không có con sói gần đàn, và điều kiện được báo cáo là "tích cực" bởi các người chăn bằng cách gọi "sói, sói"), hay tương tự như tình huống trong thử nghiệm y tế theo đó một bệnh nhân được chẩn đoán là có một số bệnh, trong khi thực tế, họ không có bất kỳ số bệnh.

Một số các từ ngữ khác sử dụng là "đúng tích cực", "đúng tiêu cực" và "sai tiêu cực". "Đúng tích cực" đề cập đến khi các kết quả kiểm tra và tình trạng thực tế của điều kiện là cả hai đúng (hay "tích cực"), và "đúng tiêu cực" đề cập đến khi các kết quả kiểm tra và tình trạng thực tế của điều kiện là cả hai sai (hay "tiêu cực"); "Đúng tích cực" hay "đúng tiêu cực" được coi là một "suy luận đúng". Các phản đề của "sai tích cực" là "sai tiêu cực"; "Sai tiêu cực" đề cập đến khi các kết quả kiểm tra là tiêu cực (hay, điều kiện được xác định là "tiêu cực", hay "sai"), nhưng dự kiến sẽ được (hay cần phải có được) tích cực (hay, điều kiện, thực tế, là "tích cực", hay "đúng").

Trong bối cảnh phpMussel, các từ ngữ đề cập đến chữ ký của phpMussel và các tập tin mà họ chặn. Khi phpMussel chặn một tập tin bởi vì chữ ký của nó là xấu, lỗi thời hay không chính xác, nhưng không nên làm như vậy, hay khi nó làm như vậy vì những lý do sai, chúng tôi đề cập đến sự kiện này như "sai tích cực". Khi phpMussel không chặn một tập tin đó nên đã bị chặn, bởi vì mối đe dọa khó lường, chữ ký mất tích hay thiếu sót trong chữ ký, chúng tôi đề cập đến sự kiện này như "phát hiện mất tích" (which is analogous to a "sai tiêu cực").

Điều này có thể được tóm tắt bằng bảng dưới đây:

&nbsp; | phpMussel *KHÔNG* nên chặn một tập tin | phpMussel *NÊN* chặn một tập tin
---|---|---
phpMussel *KHÔNG* chặn một tập tin | Đúng tiêu cực (suy luận đúng) | Phát hiện mất tích (điều tương tự như sai tiêu cực)
phpMussel chặn một tập tin | __Sai tích cực__ | Đúng tích cực (suy luận đúng)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>Tần suất cập nhật chữ ký là bao nhiêu?

Tần suất cập nhật thay đổi tùy thuộc vào các tập tin chữ ký trong câu hỏi. Nói chung là, tất cả các người bảo trì cho các tất cả tập tin chữ ký cố gắng đảm bảo rằng chữ ký của họ được cập nhật càng nhiều càng tốt, nhưng bởi vì tất cả chúng ta đều có nhiều cam kết khác, cuộc sống của chúng ta bên ngoài dự án, và bởi vì không ai trong chúng ta được bồi thường tài chính (hay được thanh toán) cho các nỗ lực dự án của chúng tôi, Một lịch trình cập nhật chính xác không thể được đảm bảo. Nói chung là, chữ ký được cập nhật bất cứ khi nào có đủ thời gian để cập nhật chúng, và các người bảo trì cố gắng ưu tiên dựa trên sự cần thiết và dựa trên tần suất của thay đổi giữa các phạm vi. Trợ giúp luôn được đánh giá cao nếu bạn sẵn sàng cung cấp bất kỳ.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>Tôi đã gặp một vấn đề trong khi sử dụng phpMussel và tôi không biết phải làm gì về nó! Hãy giúp tôi!

- Bạn đang sử dụng phiên bản mới nhất của phần mềm? Bạn đang sử dụng phiên bản mới nhất của tập tin chữ ký của bạn? Nếu câu trả lời cho một trong hai những câu hỏi này là không, cố gắng cập nhật mọi thứ đầu tiên, và kiểm tra nếu vấn đề vẫn còn. Nếu nó vẫn còn, tiếp tục đọc.
- Bạn đã kiểm tra tất cả các tài liệu chưa? Nếu không, xin hãy làm như vậy. Nếu vấn đề không thể giải quyết bằng cách sử dụng tài liệu, hãy tiếp tục đọc.
- Bạn đã kiểm tra các **[trang issues](https://github.com/phpMussel/phpMussel/issues)** chưa, để xem nếu vấn đề đã được đề cập trước đó? Nếu nó đã được đề cập trước đó, kiểm tra nếu có bất kỳ đề xuất, ý tưởng, hay giải pháp đã được cung cấp, và làm theo như là cần thiết để cố gắng giải quyết vấn đề.
- Nếu vấn đề vẫn còn, vui lòng hãy tìm sự giúp đỡ về nó bằng cách tạo ra một issue mới trên trang issues.

#### <a name="MINIMUM_PHP_VERSION"></a>Tôi muốn sử dụng phpMussel với phiên bản PHP cũ hơn 5.4.0; Bạn có thể giúp?

Không. PHP 5.4.0 đạt EoL ("End of Life", hoặc sự kết thúc của cuộc sống) chính thức vào năm 2014, và hỗ trợ an ninh mở rộng đã được chấm dứt vào năm 2015. Khi viết này, nó là năm 2017, và PHP 7.1.0 đã có sẵn. Tại thời điểm này, hỗ trợ được cung cấp để sử dụng phpMussel với PHP 5.4.0 và tất cả các phiên bản PHP có sẵn mới hơn, nhưng nếu bạn cố gắng sử dụng phpMussel với bất kỳ phiên bản PHP lớn hơn, hỗ trợ sẽ không được cung cấp.

*Xem thêm: [Biểu đồ tương thích](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>Tôi có thể sử dụng một cài đặt phpMussel để bảo vệ nhiều tên miền?

Vâng. Cài đặt phpMussel không bị khóa vào các tên miền cụ thể, và do đó có thể được sử dụng để bảo vệ nhiều tên miền. Nói chung là, chúng tôi đề cập đến cài đặt phpMussel chỉ bảo vệ một miền như "cài đặt miền đơn" ("single-domain installations"), và chúng tôi đề cập đến cài đặt phpMussel bảo vệ nhiều miền hay miền phụ như "cài đặt nhiều miền" ("multi-domain installations"). Nếu bạn sử dụng một cài đặt nhiều miền và cần phải sử dụng các bộ tập tin chữ ký khác nhau cho các miền khác nhau, hoặc cần phpMussel được cấu hình khác nhau cho các miền khác nhau, điều này có thể làm được. Sau khi tải tập tin cấu hình (`config.ini`), phpMussel sẽ kiểm tra sự tồn tại của một "tập tin ghi đè cấu hình" cụ thể cho miền được yêu cầu (`miền-được-yêu-cầu.tld.config.ini`), và nếu được tìm thấy, bất kỳ giá trị cấu hình nào được xác định bởi tập tin ghi đè cấu hình sẽ được sử dụng cho trường hợp thực hiện thay vì các giá trị cấu hình được định nghĩa bởi tập tin cấu hình. Các tập tin ghi đè cấu hình giống với tập tin cấu hình, và tùy theo quyết định của bạn, có thể chứa toàn bộ các chỉ thị cấu hình sẵn có cho phpMussel, hoặc bất kỳ phần bắt buộc nào mà khác với các giá trị được xác định bởi tập tin cấu hình. Các tập tin ghi đè cấu hình được đặt tên theo miền mà chúng được dự định (vì vậy, ví dụ, nếu bạn cần một tập tin ghi đè cấu hình cho miền, `http://www.some-domain.tld/`, các tập tin ghi đè cấu hình của nó nên được đặt tên là `some-domain.tld.config.ini`, và nên được đặt trong vault với tập tin cấu hình, `config.ini`). Tên miền cho trường hợp thực hiện được bắt nguồn từ header (tiêu đề) `HTTP_HOST` của các yêu cầu; "www" bị bỏ qua.

#### <a name="PAY_YOU_TO_DO_IT"></a>Tôi không muốn lãng phí thời gian bằng cách cài đặt này và đảm bảo rằng nó hoạt động với trang web của tôi; Tôi có thể trả tiền cho bạn để làm điều đó cho tôi?

Có lẽ. Điều này được xem xét theo từng trường hợp cụ thể. Cho chúng tôi biết những gì bạn cần, những gì bạn đang cung cấp, và chúng tôi sẽ cho bạn biết liệu chúng tôi có thể giúp đỡ hay không.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>Tôi có thể thuê bạn hay bất kỳ nhà phát triển nào của dự án này cho công việc riêng tư?

*Xem ở trên.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>Tôi cần sửa đổi chuyên môn, tuỳ chỉnh, vv; Bạn có thể giúp?

*Xem ở trên.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>Tôi là nhà phát triển, nhà thiết kế trang web, hay lập trình viên. Tôi có thể chấp nhận hay cung cấp các công việc liên quan đến dự án này không?

Vâng. Giấy phép của chúng tôi không cấm điều này.

#### <a name="WANT_TO_CONTRIBUTE"></a>Tôi muốn đóng góp cho dự án; Tôi có thể làm được điều này?

Vâng. Đóng góp cho dự án rất được hoan nghênh. Vui lòng xem "CONTRIBUTING.md" để biết thêm thông tin.

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>Giá trị được đề xuất cho "ipaddr".

Giá trị | Sử dụng
---|---
`HTTP_INCAP_CLIENT_IP` | Proxy reverse Incapsula.
`HTTP_CF_CONNECTING_IP` | Proxy reverse Cloudflare.
`CF-Connecting-IP` | Proxy reverse Cloudflare (một sự thay thế; nếu ở trên không hoạt động).
`HTTP_X_FORWARDED_FOR` | Proxy reverse Cloudbric.
`X-Forwarded-For` | [Proxy reverse Squid](http://www.squid-cache.org/Doc/config/forwarded_for/).
*Xác định bởi cấu hình máy chủ.* | [Proxy reverse Nginx](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | Không có proxy reverse (giá trị mặc định).

#### <a name="SCAN_DEBUGGING"></a>Làm thế nào để truy cập chi tiết cụ thể về các tập tin khi chúng được quét?

Bạn có thể truy cập chi tiết cụ thể về các tập tin khi chúng được quét bằng cách gán một mảng để sử dụng cho mục đích này trước khi hướng dẫn phpMussel để quét chúng.

Trong ví dụ dưới đây, `$Foo` được gán cho mục đích này. Sau khi quét `/đường/dẫn/tập/tin/...`, thông tin chi tiết về các tập tin chứa bởi `/đường/dẫn/tập/tin/...` sẽ được chứa bởi `$Foo`.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/đường/dẫn/tập/tin/...');

var_dump($Foo);
```

Mảng này là đa chiều. Các phần tử đại diện cho các tập tin được quét và các phần tử con đại diện cho các chi tiết về các tập tin này. Các phần tử con này như sau:

- Filename (`string`)
- FromCache (`bool`)
- Depth (`int`)
- Size (`int`)
- MD5 (`string`)
- SHA1 (`string`)
- CRC32B (`string`)
- 2CC (`string`)
- 4CC (`string`)
- ScanPhase (`string`)
- Container (`string`)
- † FileSwitch (`string`)
- † Is_ELF (`bool`)
- † Is_Graphics (`bool`)
- † Is_HTML (`bool`)
- † Is_Email (`bool`)
- † Is_MachO (`bool`)
- † Is_PDF (`bool`)
- † Is_SWF (`bool`)
- † Is_PE (`bool`)
- † Is_Not_HTML (`bool`)
- † Is_Not_PHP (`bool`)
- ‡ NumOfSections (`int`)
- ‡ PEFileDescription (`string`)
- ‡ PEFileVersion (`string`)
- ‡ PEProductName (`string`)
- ‡ PEProductVersion (`string`)
- ‡ PECopyright (`string`)
- ‡ PEOriginalFilename (`string`)
- ‡ PECompanyName (`string`)
- Results (`int`)
- Output (`string`)

*† - Không được cung cấp với kết quả lưu trữ (chỉ cung cấp cho các kết quả quét mới).*

*‡ - Chỉ cung cấp khi quét tập tin PE.*

Nếu bạn muốn, mảng này có thể bị phá hủy bằng cách sử dụng sau:

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Tôi có thể sử dụng cron để cập nhật tự động không?

Vâng. API được tích hợp trong front-end để tương tác với trang cập nhật thông qua các kịch bản bên ngoài. Một kịch bản riêng biệt, "[Cronable](https://github.com/Maikuolan/Cronable)", là có sẵn, và có thể được sử dụng bởi cron manager hay cron scheduler để tự động cập nhật gói này và gói hỗ trợ khác (kịch bản này cung cấp tài liệu riêng của nó).

#### <a name="SCAN_NON_ANSI"></a>Có thể phpMussel quét các tập tin có tên không ANSI?

Giả sử có một thư mục bạn muốn quét. Trong thư mục này, bạn có một số tập tin có tên không ANSI.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

Giả sử rằng bạn đang sử dụng chế độ CLI hoặc phpMussel API để quét.

Khi sử dụng PHP < 7.1.0, trên một số hệ thống, phpMussel sẽ không thấy các tập tin này khi cố gắng quét thư mục, và do đó, sẽ không thể quét các tập tin này. Bạn có thể sẽ thấy kết quả tương tự như khi bạn quét một thư mục rỗng:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Đã bắt đầu.
 Sun, 01 Apr 2018 22:27:41 +0800 Hoàn thành.
```

Ngoài ra, khi sử dụng PHP < 7.1.0, quét các tập tin riêng lẻ tạo kết quả như sau:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Đã bắt đầu.
 > Đang kiểm tra 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> Tập tin không hợp lệ!
 Sun, 01 Apr 2018 22:27:41 +0800 Hoàn thành.
```

Hoặc những điều sau:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Đã bắt đầu.
 > X:/directory/??????.txt không phải là file hoạc thư mục.
 Sun, 01 Apr 2018 22:27:41 +0800 Hoàn thành.
```

Điều này là do cách mà PHP xử lý các tên tập tin không phải ANSI trước PHP 7.1.0. Nếu bạn gặp vấn đề này, giải pháp là cập nhật cài đặt PHP lên phiên bản 7.1.0 trở lên. Trong PHP >= 7.1.0, tên tập tin không phải ANSI được xử lý tốt hơn, và phpMussel sẽ có thể quét các tập tin đúng cách.

Để so sánh, kết quả khi cố gắng quét các thư mục bằng cách sử dụng PHP >= 7.1.0:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Đã bắt đầu.
 -> Đang kiểm tra '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> Không tiềm được vấn đề.
 -> Đang kiểm tra '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> Không tiềm được vấn đề.
 -> Đang kiểm tra '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> Không tiềm được vấn đề.
 Sun, 01 Apr 2018 22:27:41 +0800 Hoàn thành.
```

Và cố gắng để quét các tập tin riêng biệt:

```
 Sun, 01 Apr 2018 22:27:41 +0800 Đã bắt đầu.
 > Đang kiểm tra 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> Không tiềm được vấn đề.
 Sun, 01 Apr 2018 22:27:41 +0800 Hoàn thành.
```

#### <a name="BLACK_WHITE_GREY"></a>Danh sách đen – Danh sách trắng – Danh sách xám – Họ là gì, và làm cách nào để sử dụng chúng?

Các thuật ngữ mang ý nghĩa khác nhau trong các ngữ cảnh khác nhau. Trong phpMussel, có ba ngữ cảnh mà các thuật ngữ này được sử dụng: Đáp ứng kích thước tập tin, đáp ứng loại tập tin, và danh sách xám cho chữ ký.

Để đạt được một kết quả mong muốn với chi phí tối thiểu để xử lý, có một số điều đơn giản mà phpMussel có thể kiểm tra trước khi thực sự quét các tập tin, chẳng hạn như các kích thước, các tên, và các phần mở rộng của tập tin. Ví dụ; Nếu một tập tin quá lớn, hay nếu phần mở rộng của tập tin đó cho biết loại tập tin mà chúng tôi không muốn cho phép trên các trang web của chúng tôi, chúng tôi có thể đánh dấu tập tin ngay lập tức, và không cần quét nó.

Đáp ứng kích thước tập tin là cách mà phpMussel đáp ứng khi tập tin vượt quá giới hạn được chỉ định. Mặc dù không có danh sách thực tế, một tập tin có thể được xem là có hiệu quả trong danh sách đen, danh sách trắng hoặc danh sách xám, dựa trên kích thước của tập tin. Hai chỉ thị cấu hình khác biệt tồn tại để chỉ định một giới hạn và đáp ứng mong muốn tương ứng.

Đáp ứng loại tập tin là cách mà phpMussel đáp ứng với phần mở rộng của tập tin. Có ba chỉ thị cấu hình khác biệt tồn tại để chỉ định các phần mở rộng nào sẽ nằm trong danh sách đen, danh sách trắng hoặc danh sách xám. Một tập tin có thể được xem xét có hiệu quả trên danh sách đen, danh sách trắng hoặc danh sách xám nếu phần mở rộng của nó khớp với bất kỳ phần mở rộng được chỉ định tương ứng.

Trong hai ngữ cảnh này, nằm trong danh sách trắng có nghĩa là không được quét hoặc gắn cờ; nằm trong danh sách đen có nghĩa là nó phải được gắn cờ (và do đó không cần phải quét nó); và nằm trong danh sách xám có nghĩa là phân tích thêm là cần thiết để xác định xem chúng ta nên gắn cờ nó (và như vậy, nó nên được quét).

Danh sách xám cho chữ ký là một danh sách các chữ ký mà về cơ bản sẽ được bỏ qua (điều này đã được đề cập trước đó trong tài liệu). Khi một chữ ký trên danh sách xám được kích hoạt, phpMussel tiếp tục làm việc thông qua các chữ ký của nó và không có hành động cụ thể liên quan đến chữ ký trên danh sách xám. Không có danh sách đen chữ ký, bởi vì hành vi ngụ ý là hành vi bình thường cho chữ ký kích hoạt, và không có danh sách trắng chữ ký, bởi vì hành vi ngụ ý sẽ không thực sự có ý nghĩa trong việc xem xét như thế nào phpMussel hoạt động bình thường và những điều đã có thể đã làm.

Danh sách xám chữ ký rất hữu ích nếu bạn cần giải quyết các vấn đề gây ra bởi một chữ ký cụ thể mà không cần vô hiệu hoặc gỡ cài đặt toàn bộ tập tin chữ ký.

---


### 11. <a name="SECTION11"></a>THÔNG TIN HỢP PHÁP

#### 11.0 SECTION PREAMBLE

This section of the documentation is intended to describe possible legal considerations regarding the use and implementation of the package, and to provide some basic related information. This may be important for some users as a means to ensure compliancy with any legal requirements that may exist in the countries that they operate in, and some users may need to adjust their website policies in accordance with this information.

First and foremost, please realise that I (the package author) am not a lawyer, nor a qualified legal professional of any kind. Therefore, I am not legally qualified to provide legal advice. Also, in some cases, exact legal requirements may vary between different countries and jurisdictions, and these varying legal requirements may sometimes conflict (such as, for example, in the case of countries that favour privacy rights and the right to be forgotten, versus countries that favour extended data retention). Consider also that access to the package is not restricted to specific countries or jurisdictions, and therefore, the package userbase is likely to the geographically diverse. These points considered, I'm not in a position to state what it means to be "legally compliant" for all users, in all regards. However, I hope that the information herein will help you to come to a decision yourself regarding what you must do in order to remain legally compliant in the context of the package. If you have any doubts or concerns regarding the information herein, or if you need additional help and advice from a legal perspective, I would recommend consulting a qualified legal professional.

#### 11.1 LIABILITY AND RESPONSIBILITY

As per already stated by the package license, the package is provided without any warranty. This includes (but is not limited to) all scope of liability. The package is provided to you for your convenience, in the hope that it will be useful, and that it will provide some benefit for you. However, whether you use or implement the package, is your own choice. You are not forced to use or implement the package, but when you do so, you are responsible for that decision. Neither I, nor any other contributors to the package, are legally responsible for the consequences of the decisions that you make, regardless of whether direct, indirect, implied, or otherwise.

#### 11.2 THIRD PARTIES

Depending on its exact configuration and implementation, the package may communicate and share information with third parties in some cases. This information may be defined as "personally identifiable information" (PII) in some contexts, by some jurisdictions.

How this information may be used by these third parties, is subject to the various policies set forth by these third parties, and is outside the scope of this documentation. However, in all such cases, sharing of information with these third parties can be disabled. In all such cases, if you choose to enable it, it is your responsibility to research any concerns that you may have regarding the privacy, security, and usage of PII by these third parties. If any doubts exist, or if you're unsatisfied with the conduct of these third parties in regards to PII, it may be best to disable all sharing of information with these third parties.

For the purpose of transparency, the type of information shared, and with whom, is described below.

##### 11.2.0 WEBFONTS

Some custom themes, as well as the the standard UI ("user interface") for the phpMussel front-end and the "Upload Denied" page, may use webfonts for aesthetic reasons. Webfonts are disabled by default, but when enabled, direct communication between the user's browser and the service hosting the webfonts occurs. This may potentially involve communicating information such as the user's IP address, user agent, operating system, and other details available to the request. Most of these webfonts are hosted by the Google Fonts service.

*Relevant configuration directives:*
- `general` -> `disable_webfonts`

##### 11.2.1 URL SCANNER

URLs found within file uploads may be shared with the hpHosts API or the Google Safe Browsing API, depending on how the package is configured. In the case of the hpHosts API, this behaviour is enabled by default. The Google Safe Browsing API requires API keys in order to work correctly, and is therefore disabled by default.

*Relevant configuration directives:*
- `urlscanner` -> `lookup_hphosts`
- `urlscanner` -> `google_api_key`

##### 11.2.2 VIRUS TOTAL

When phpMussel scans a file upload, the hashes of those files may be shared with the Virus Total API, depending on how the package is configured. There are plans to be able to share entire files at some point in the future too, but this feature isn't supported by the package at this time. The Virus Total API requires an API key in order to work correctly, and is therefore disabled by default.

Information (including files and related file metadata) shared with Virus Total, may also be shared with their partners, affiliates, and various others for research purposes. This is described in more detail by their privacy policy.

*See: [Privacy Policy &ndash; VirusTotal](https://support.virustotal.com/hc/en-us/articles/115002168385-Privacy-Policy).*

*Relevant configuration directives:*
- `virustotal` -> `vt_public_api_key`

#### 11.3 LOGGING

Logging is an important part of phpMussel for a number of reasons. Without logging, it may be difficult to diagnose false positives, to ascertain exactly how performant phpMussel is in any particular context, and to determine where its shortfalls may be, and what changes may be required to its configuration or signatures accordingly, in order for it to continue functioning as intended. Regardless, logging mightn't be desirable for all users, and remains entirely optional. In phpMussel, logging is disabled by default. To enable it, phpMussel must be configured accordingly.

Additionally, whether logging is legally permissible, and to the extent that it is legally permissible (e.g., the types of information that may logged, for how long, and under what circumstances), may vary, depending on jurisdiction and on the context where phpMussel is implemented (e.g., whether you're operating as an individual, as a corporate entity, and whether on a commercial or non-commercial basis). It may therefore be useful for you to read through this section carefully.

There are multiple types of logging that phpMussel can perform. Different types of logging involves different types of information, for different reasons.

##### 11.3.0 SCAN LOGS

When enabled in the package configuration, phpMussel keeps logs of the files it scans. This type of logging is available in two different formats:
- Human readable logfiles.
- Serialised logfiles.

Entries to a human readable logfile typically look something like this (as an example):

```
Mon, 21 May 2018 00:47:58 +0800 Started.
> Checking 'ascii_standard_testfile.txt' (FN: ce76ae7a; FD: 7b9bfed5):
-> Detected phpMussel-Testfile.ASCII.Standard!
Mon, 21 May 2018 00:48:04 +0800 Finished.
```

A scan log entry typically includes the following information:
- The date and time that the file was scanned.
- The name of the file scanned.
- CRC32b hashes of the name and contents of the file.
- What was detected in the file (if anything was detected).

*Relevant configuration directives:*
- `general` -> `scan_log`
- `general` -> `scan_log_serialized`

When these directives are left empty, this type of logging will remain disabled.

##### 11.3.1 SCAN KILLS

When enabled in the package configuration, phpMussel keeps logs of the uploads that have been blocked.

Entries to a "scan kills" logfile typically look something like this (as an example):

```
DATE: Mon, 21 May 2018 00:47:56 +0800
IP ADDRESS: 127.0.0.1
== SCAN RESULTS / WHY FLAGGED ==
Detected phpMussel-Testfile.ASCII.Standard (ascii_standard_testfile.txt)!
== MD5 SIGNATURE RECONSTRUCTION (FILE-HASH:FILE-SIZE:FILE-NAME) ==
3ed8a00c6c498a96a44d56533806153c:666:ascii_standard_testfile.txt
Quarantined as "/vault/quarantine/0000000000-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx.qfu".
```

A "scan kills" entry typically includes the following information:
- The date and time that the upload was blocked.
- The IP address where the upload originated from.
- The reason why the file was blocked (what was detected).
- The name of the file blocked.
- An MD5 and the size of the file blocked.
- Whether the file was quarantined, and under what internal name.

*Relevant configuration directives:*
- `general` -> `scan_kills`

##### 11.3.2 FRONT-END LOGGING

This type of logging relates front-end login attempts, and occurs only when a user attempts to log into the front-end (assuming front-end access is enabled).

A front-end log entry contains the IP address of the user attempting to log in, the date and time that the attempt occurred, and the results of the attempt (successfully logged in, or failed to log in). A front-end log entry typically looks something like this (as an example):

```
x.x.x.x - Day, dd Mon 20xx hh:ii:ss +0000 - "admin" - Logged in.
```

*Relevant configuration directives:*
- `general` -> `FrontEndLog`

##### 11.3.3 LOG ROTATION

You may want to purge logs after a period of time, or may be required to do so by law (i.e., the amount of time that it's legally permissible for you to retain logs may be limited by law). You can achieve this by including date/time markers in the names of your logfiles as per specified by your package configuration (e.g., `{yyyy}-{mm}-{dd}.log`), and then enabling log rotation (log rotation allows you to perform some action on logfiles when specified limits are exceeded).

For example: If I was legally required to delete logs after 30 days, I could specify `{dd}.log` in the names of my logfiles (`{dd}` represents days), set the value of `log_rotation_limit` to 30, and set the value of `log_rotation_action` to `Delete`.

Conversely, if you're required to retain logs for an extended period of time, you could either not use log rotation at all, or you could set the value of `log_rotation_action` to `Archive`, to compress logfiles, thereby reducing the total amount of disk space that they occupy.

*Relevant configuration directives:*
- `general` -> `log_rotation_limit`
- `general` -> `log_rotation_action`

##### 11.3.4 LOG TRUNCATION

It's also possible to truncate individual logfiles when they exceed a certain size, if this is something you might need or want to do.

*Relevant configuration directives:*
- `general` -> `truncate`

##### 11.3.5 IP ADDRESS PSEUDONYMISATION

Firstly, if you're not familiar with the term "pseudonymisation", the following resources can help explain it in some detail:
- [[trust-hub.com] What is pseudonymisation?](https://www.trust-hub.com/news/what-is-pseudonymisation/)
- [[Wikipedia] Pseudonymization](https://en.wikipedia.org/wiki/Pseudonymization)

In some circumstances, you may be legally required to anonymise or pseudonymise any PII collected, processed, or stored. Although this concept has existed for quite some time now, GDPR/DSGVO notably mentions, and specifically encourages "pseudonymisation".

phpMussel is able to pseudonymise IP addresses when logging them, if this is something you might need or want to do. When phpMussel pseudonymises IP addresses, when logged, the final octet of IPv4 addresses, and everything after the second part of IPv6 addresses is represented by an "x" (effectively rounding IPv4 addresses to the initial address of the 24th subnet they factor into, and IPv6 addresses to the initial address of the 32nd subnet they factor into).

*Relevant configuration directives:*
- `legal` -> `pseudonymise_ip_addresses`

##### 11.3.6 STATISTICS

phpMussel is optionally able to track statistics such as the total number of file scanned and blocked since some particular point in time. This feature is disabled by default, but can be enabled via the package configuration. The type of information tracked shouldn't be regarded as PII.

*Relevant configuration directives:*
- `general` -> `statistics`

##### 11.3.7 ENCRYPTION

phpMussel doesn't encrypt its cache or any log information. Cache and log encryption may be introduced in the future, but there aren't any specific plans for it currently. If you're concerned about unauthorised third parties gaining access to parts of phpMussel that may contain PII or sensitive information such as its cache or logs, I would recommend that phpMussel not be installed at a publicly accessible location (e.g., install phpMussel outside the standard `public_html` directory or equivalent thereof available to most standard webservers) and that appropriately restrictive permissions be enforced for the directory where it resides (in particular, for the vault directory). If that isn't sufficient to address your concerns, then configure phpMussel as such that the types of information causing your concerns won't be collected or logged in the first place (such as, by disabling logging).

#### 11.4 COOKIES

When a user successfully logs into the front-end, phpMussel sets a cookie in order to be able to remember the user for subsequent requests (i.e., cookies are used for authenticate the user to a login session). On the login page, a cookie warning is displayed prominently, warning the user that a cookie will be set if they engage in the relevant action. Cookies aren't set at any other points in the codebase.

*Relevant configuration directives:*
- `general` -> `disable_frontend`

#### 11.5 MARKETING AND ADVERTISING

phpMussel doesn't collect or process any information for marketing or advertising purposes, and neither sells nor profits from any collected or logged information. phpMussel is not a commercial enterprise, nor is related to any commercial interests, so doing these things wouldn't make any sense. This has been the case since the beginning of the project, and continues to be the case today. Additionally, doing these things would be counter-productive to the spirit and intended purpose of the project as a whole, and for as long as I continue to maintain the project, will never happen.

#### 11.6 PRIVACY POLICY

In some circumstances, you may be legally required to clearly display a link to your privacy policy on all pages and sections of your website. This may be important as a means to ensure that users and well-informed of your exact privacy practices, the types of PII you collect, and how you intend to use it. In order to be able to include such a link on phpMussel's "Upload Denied" page, a configuration directive is provided to specify the URL to your privacy policy.

*Relevant configuration directives:*
- `legal` -> `privacy_policy`

#### 11.7 GDPR/DSGVO

The General Data Protection Regulation (GDPR) is a regulation of the European Union, which comes into effect as of May 25, 2018. The primary goal of the regulation is to give control to EU citizens and residents regarding their own personal data, and to unify regulation within the EU concerning privacy and personal data.

The regulation contains specific provisions pertaining to the processing of "personally identifiable information" (PII) of any "data subjects" (any identified or identifiable natural person) either from or within the EU. To be compliant with the regulation, "enterprises" (as per defined by the regulation), and any relevant systems and processes must implement "privacy by design" by default, must use the highest possible privacy settings, must implement necessary safeguards for any stored or processed information (including, but not limited to, the implementation of pseudonymisation or full anonymisation of data), must clearly and unambiguously declare the types of data they collect, how they process it, for what reasons, for how long they retain it, and whether they share this data with any third parties, the types of data shared with third parties, how, why, and so on.

Data may not be processed unless there's a lawful basis for doing so, as per defined by the regulation. Generally, this means that in order to process a data subject's data on a lawful basis, it must be done in compliance with legal obligations, or done only after explicit, well-informed, unambiguous consent has been obtained from the data subject.

Because aspects of the regulation may evolve in time, in order to avoid the propagation of outdated information, it may be better to learn about the regulation from an authoritative source, as opposed to simply including the relevant information here in the package documentation (which may eventually become outdated as the regulation evolves).

[EUR-Lex](https://eur-lex.europa.eu/) (a part of the official website of the European Union that provides information about EU law) provides extensive information about GDPR/DSGVO, available in 24 different languages (at the time of writing this), and available for download in PDF format. I would definitely recommend reading the information that they provide, in order to learn more about GDPR/DSGVO:
- [REGULATION (EU) 2016/679 OF THE EUROPEAN PARLIAMENT AND OF THE COUNCIL](https://eur-lex.europa.eu/legal-content/EN/TXT/?uri=celex:32016R0679)

Alternatively, there's a brief (non-authoritative) overview of GDPR/DSGVO available at Wikipedia:
- [General Data Protection Regulation](https://en.wikipedia.org/wiki/General_Data_Protection_Regulation)

---


Lần cuối cập nhật: 25 Tháng Năm 2018 (2018.05.25).
