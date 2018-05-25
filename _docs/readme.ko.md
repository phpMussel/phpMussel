## phpMussel 설명서 (한국어).

### 목차
- 1. [서문](#SECTION1)
- 2. [설치 방법](#SECTION2)
- 3. [사용 방법](#SECTION3)
- 4. [프론트 엔드 관리](#SECTION4)
- 5. [CLI (명령 줄 인터페이스)](#SECTION5)
- 6. [본 패키지에 포함 된 파일](#SECTION6)
- 7. [설정 옵션](#SECTION7)
- 8. [서명 포맷](#SECTION8)
- 9. [적합성 문제](#SECTION9)
- 10. [자주 묻는 질문 (FAQ)](#SECTION10)
- 11. [법률 정보](#SECTION11)

*번역에 노트 : 오류가 발생하는 경우 (예를 들어, 번역 사이의 불일치, 오타, 등등), README 의 영어 버전은 원본과 권위 버전이라고 생각됩니다. 오류를 발견하면이를 해결하려면 협력을 환영하는 것이다.*

---


### 1. <a name="SECTION1"></a>서문

phpMussel을 이용해 주셔서 감사합니다. phpMussel는 ClamAV를 비롯한 서명을 이용하여 시스템에 업로드 된 파일을 대상하여 트로이 바이러스 나 악성 코드 등을 감지하도록 설계된 PHP 스크립트입니다.

phpMussel 저작권 2013 년 이후 Caleb M (Maikuolan)의 GNU/GPLv2.

본 스크립트는 프리웨어입니다. 자유 소프트웨어 재단에서 발행 한 GNU 일반 공중 라이선스 버전 2 (또는 이후 버전)에 따라 재배포 및 가공이 가능합니다. 배포의 목적은 도움이되기를 바랍니다 것이지만 "보증 아니며 상품성 또는 특정 목적에 적합한 것을 시사하는 것이기도 없습니다." "LICENSE.txt"에있는 "GNU General Public License"(일반 라이선스)을 참조하십시오. 다음 URL에서도 볼 수 있습니다 :
- <http://www.gnu.org/licenses/>.
- <http://opensource.org/licenses/>.

창조의 영감이 스크립트를 이용하는 시그니처 [ClamAV](http://www.clamav.net/)에 감사의 뜻을 표하고자합니다. 이 2 개가 있어야이 스크립트는 존재할 수 없거나 극히 제한된 이용 가치만을 가지고이라고 말해도 좋을 것입니다.

본 프로젝트 파일의 호스트 처인 SourceForge와 GitHub, phpMussel이 이용하는 서명 제공처이다 : [SecuriteInfo.com](http://www.securiteinfo.com/), [PhishTank](http://www.phishtank.com/), [NLNetLabs](http://nlnetlabs.nl/) 다른 본 프로젝트를 지원 해주신 모든 분들에게 감사의 뜻을 표하고자합니다.

본 문서 및 관련 패키지는 다음 URL에서 다운로드 할 수 있습니다.
- [SourceForge](http://phpmussel.sourceforge.net/).
- [GitHub](https://github.com/phpMussel/phpMussel/).

---


### 2. <a name="SECTION2"></a>설치 방법

#### 2.0 수동 설치 (웹서버 편)

1) 이 항목을 읽고 있다는 점에서 아카이브 스크립트의 로컬 컴퓨터에 다운로드 및 압축 해제는 종료하고 있다고 생각합니다. 호스트 또는 CMS에 `/public_html/phpmussel/`와 같은 디렉토리를 만들고 로컬 컴퓨터에서 거기에 콘텐츠를 업로드하는 것이 다음 단계입니다. 파일 저장 디렉토리 이름과 위치는 안전하고 만 있으면 물론 제약 등은 없기 때문에 자유롭게 결정 해주세요.

2) `config.ini`에 `config.ini.RenameMe`의 이름을 변경합니다 (`vault`의 안쪽에 위치한다). 옵션 수정을 위해 (초보자는 권장하지 않지만, 경험이 풍부한 사용자는 좋습니다) 그것을여십시오 (이 파일은 phpMussel이 가능한 지시자를 포함하고 있으며, 각각의 옵션에 대해 기능과 목적에 관한 간단한 설명이 있습니다). 설치 환경에 따라 적절한 수정을하고 파일을 저장하십시오.

3) 콘텐츠 (phpMussel 본체와 파일)을 먼저 정한 디렉토리에 업로드합니다. (`*.txt`또는 `*.md`파일 업로드 필요는 없지만, 대개는 모든 업로드 해달라고해도됩니다).

4) `vault`디렉토리 "755"로 권한 변경 (문제가있는 경우 "777"을 시도 할 수 있습니다; 하지만 이것은 안전하지 않습니다). 콘텐츠를 업로드 한 디렉토리 자체는 보통 특히 아무것도 필요하지 않지만, 과거에 권한 문제가있을 경우 CHMOD의 상태는 확인하는 것이 좋습니다. (기본적으로 "755"가 일반적입니다).

5) 당신이 필요로하는 서명을 설치하십시오. *참조 : [서명 설치](#INSTALLING_SIGNATURES).*

6) 그 다음에 시스템 또는 CMS에 phpMussel를 연결합니다. 방법에는 여러 가지가 있지만 가장 쉬운 것은`require`과`include`에서 스크립트를 시스템 또는 CMS 코어 파일의 첫 부분에 기재하는 방법입니다. (코어 파일은 사이트의 어떤 페이지에 접근이 있어도 반드시로드되는 파일입니다). 일반적으로는 `/includes`또는 `/assets`또는 `/functions`같은 디렉토리에있는 파일에서 `init.php`, `common_functions.php`, `functions.php`라는 파일 이름을 붙일 수 있습니다. 실제로 어떤 파일인지는 찾아도 바닥입니다해야합니다. 잘 모르는 경우 phpMussel 지원 포럼을 참조하거나 GitHub 때문에 phpMussel 문제의 페이지 또는 알려주십시오 (CMS 정보 필수). 나 자신을 포함하여 사용자에 유사한 CMS를 다룬 경험이 있으면, 무엇인가의 지원을 제공 할 수 있습니다. 코어 파일이 발견 된 경우, (`require` 또는`include`을 사용하여) 다음 코드를 파일의 맨 위에 삽입하십시오. 그러나 따옴표로 둘러싸인 부분은`loader.php` 파일의 정확한 주소 (HTTP 주소가 아닌 로컬 주소 전술의 vault 주소와 유사)로 바꿉니다.

`<?php require '/user_name/public_html/phpmussel/loader.php'; ?>`

파일을 저장하고 닫은 다음 다시 업로드합니다.

-- 다른 방법 --

Apache 웹서버를 이용하고있어, 한편`php.ini`를 편집 할 수 있도록한다면, `auto_prepend_file` 지시어를 사용하여 PHP 요청이있을 경우에는 항상 phpMussel을 앞에 추가하도록 할 있습니다. 예를 들면 다음과 같습니다.

`auto_prepend_file = "/user_name/public_html/phpmussel/loader.php"`

또는 `.htaccess`에서 :

`php_value auto_prepend_file "/user_name/public_html/phpmussel/loader.php"`

7) 이제 설치가 완료되었습니다 만, 만약을 위해 테스트를 실시합시다. 불법 파일 업로드 보호 기능을 테스트하려면 패키지에 `_testfiles`에 포함 된 테스트 파일을 브라우저를 사용하는 일반적인 방법으로 업로드합니다. 문제가 없으면 phpMussel에서 업로드를 차단했다는 메시지가 표시되고 그렇지 않은 경우는 무언가가 제대로 작동하지 않습니다. 또한 만약 뭔가 특별한 기능을 사용하고, 혹은 다른 유형의 스캐닝도 사용하고있는 것 같으면 서로 영향을 걷지 않을지도 체크해 두는 것이 좋습니다.

#### 2.1 수동 설치 (CLI 편)

1) 이 항목을 읽고 있다는 점에서 아카이브 스크립트의 로컬 컴퓨터에 다운로드 및 압축 해제는 종료하고 있다고 생각합니다. phpMussel의 위치가 정해지면 다음으로 이동하세요.

2) phpMussel를 사용하려면 PHP가 호스트 컴퓨터에 설치되어 있어야합니다. 만약 아직이라면 각종 PHP 설치의 어느 것을 사용해도 상관하지 않으므로 설치하십시오.

3) 옵션 수정을 위해 (초보자는 권장하지 않지만, 경험이 풍부한 사용자는 좋습니다). `vault`의`config.ini`를 엽니 다. 이 파일은 phpMussel이 가능한 지시자를 포함하고 있으며, 각각의 옵션에 대한 기능과 목적에 관한 간단한 설명이 있습니다. 설치 환경에 따라 적절한 수정을하고 파일을 저장하십시오.

4) 옵션이지만, 배치 파일을 작성하여 phpMussel의 CLI 모드에서의 사용을 용이하게 할 수 있습니다. 배치 파일은 PHP와 phpMussel를 자동으로로드하는 것입니다. 먼저 Notepad 또는 Notepad ++과 같은 텍스트 편집기를 엽니 다. 그리고 설치 한 PHP의`php.exe`의 절대 경로 공백`loader.php`의 절대 경로를 입력하고 확장자 `.bat`파일을 눈에 띄는 곳에 저장합니다. 이 파일을 더블 클릭하여 phpMussel을 시작할 수 있습니다.

5) 당신이 필요로하는 서명을 설치하십시오. *참조 : [서명 설치](#INSTALLING_SIGNATURES).*

6) 테스트를합시다. 패키지의`_testfiles`을 phpMussel로 스캔 해보세요.

#### 2.2 COMPOSER를 사용하여 설치한다

[phpMussel는 Packagist에 등록되어 있습니다](https://packagist.org/packages/phpmussel/phpmussel). Composer를 익숙한 경우 Composer를 사용하여 phpMussel를 설치할 수 있습니다 (당신은 아직 설정과 후크를 준비해야합니다; "수동 설치 (웹서버 편)"의 2 단계와 6 단계를 참조하십시오).

`composer require phpmussel/phpmussel`

#### <a name="INSTALLING_SIGNATURES"></a>2.3 서명 설치

v1.0.0 이후 시그니처 phpMussel 패키지에는 포함되어 있지 않습니다. 특정 위협을 감지하기 위해서는, phpMussel 의해 서명이 필요합니다. 서명을 설치하는 주요 방법은 3 가지가 있습니다.

1. 프런트 엔드 업데이트 페이지를 사용하여 자동으로 설치합니다.
2. "SigTool"를 사용하여 서명을 생성하여 수동으로 설치합니다.
3. "phpMussel/Signatures"에서 서명을 다운로드하여 수동으로 설치합니다.

##### 2.3.1 프런트 엔드 업데이트 페이지를 사용하여 자동으로 설치합니다.

우선 프런트 엔드가 활성화되어 있는지 확인해야합니다. *참조 : [프론트 엔드 관리](#SECTION4).*

다음, 프런트 엔드 업데이트 페이지로 이동, 필요한 서명 파일을 찾을, 이후 페이지에서 제공되는 옵션을 사용하여, 설치하고 활성화합니다.

##### 2.3.2 "SigTool"를 사용하여 서명을 생성하여 수동으로 설치합니다.

*참조 : [SigTool 설명서](https://github.com/phpMussel/SigTool#documentation).*

##### 2.3.3 "phpMussel/Signatures"에서 서명을 다운로드하여 수동으로 설치합니다.

첫째, [phpMussel/Signatures](https://github.com/phpMussel/Signatures)간다. 저장소는 다양한 GZ 압축 서명 파일이 포함되어 있습니다. 그들을 설치하려면, 필요한 파일을 다운로드하여 압축을 풉니, 압축이 풀린 파일을 `/vault/signatures` 디렉토리에 복사합니다. 그들을 활성화하려면, 복사 한 파일의 이름을 phpMussel 설정 `Active` 지시문에 열거합니다.

---


### 3. <a name="SECTION3"></a>사용 방법

#### 3.0 사용 방법 (웹서버 편)

phpMussel은 특별한 환경을 필요로하지 않는 스크립트입니다. 일단 설치되면 잘 작동합니다.

기본적으로 업로드 된 파일의 스캔이 자동으로 실행하도록 설정되어 있습니다. 따라서 기본적으로 아무것도 할 수 없습니다.

하지만 특정 파일, 디렉토리, 아카이브를 검색하도록 설정할 수 있습니다. `config.ini`을 적절하게 다시 설정하십시오 (정리 무효 않으면 안됩니다). 그 phpMussel 후크되는 PHP 파일 내에서 다음 코드를 사용합니다.

`$phpMussel['Scan']($what_to_scan, $output_type, $output_flatness);`

- `$what_to_scan` 는 문자열 또는 (다차원) 배열을 할당 할 수 있습니다. 어떤 파일 (하나 혹은 여러) 또는 디렉토리 (하나 혹은 여러)를 스캔할지 지정합니다.
- `$output_type` 는 부레안에서 검색 결과의 형식을 지정할 수 있습니다. `false` 결과를 정수로 돌려줍니다. `true` (진정한)는 결과를 텍스트 형식으로 반환합니다. 어느 쪽을 선택하더라도 스캔 후에 글로벌 변수에 따라 결과에 액세스 할 수 있습니다. `$output_type` 는 옵션으로 디폴트 설정은`false` (가짜)되어 있습니다. 다음은 정수 결과를 설명합니다.

| 결과 | 기술 |
|---|---|
| -3 | phpMussel 시그니처 파일 또는 서명 맵이없는 또는 손상된 수 있음을 보여줍니다. |
| -2 | 스캔 중에 손상된 데이터를 검색하여 스캔 실패. |
| -1 | PHP를 검사하는 데 필요한 확장 또는 추가 기능이 없기 때문에 스캔 실패. |
| 0 | 검사 대상이 존재하지 않음. |
| 1 | 대상의 스캔을 완료하고 문제가 없는지. |
| 2 | 대상의 스캔을 완료하고 문제를 발견 한 것을 의미합니다. |

- `$output_flatness` 는 부레안에서 검색 결과를 배열로 반환하거나 문자열로 반환할지 여부를 지정합니다 (대상이 여러 경우). `false` (가짜)은 배열, `true` (진정한)은 문자열의 결과입니다. `$output_flatness` 는 옵션으로 디폴트 설정은`false` (가짜)입니다.

예 :

```PHP
 $results = $phpMussel['Scan']('/user_name/public_html/my_file.html', true, true);
 echo $results;
```

의 경우 반환 값은 :

```
 Wed, 16 Sep 2013 02:49:46 +0000 시작했다.
 > 현재 분석 중 : '/user_name/public_html/my_file.html':
 -> 문제는 발견되지 않았습니다.
 Wed, 16 Sep 2013 02:49:47 +0000 완료.
```

phpMussel 어떤 시그니처를 사용했는지 등의 자세한 정보는 본 파일의 "[서명 형식](#SECTION8)"을 참조하십시오.

오류 검출 및 신종 의심스러운 것으로 발생, 또는 서명에 관한 일에 대해서는 무엇이든 알려주세요. 그러면 즉시 대응할 수 있고, 필요한 수정을 할 수 있습니다. *(참조하십시오 : ["거짓 양성"는 무엇입니까?](#WHAT_IS_A_FALSE_POSITIVE)).*

phpMussel에 포함 된 서명을 해제하려면 (일반적으로 제외해서는 없다고 생각되는 것들 가 차단되어 버리는 경우), 그레이리스트 파일에 이름을 추가하십시오 (`/vault/greylist.csv`), 쉼표로 구분.

*꼭 참조하십시오 : [파일 검색시 특정 정보에 액세스하려면 어떻게해야합니까?](#SCAN_DEBUGGING)*

#### 3.1 사용 방법 (CLI 편)

본 README 파일의 "수동 설치 (CLI 편)"을 참조하십시오.

또한 phpMussel를 일반 바이러스 소프트웨어와 혼동하지 마십시오. 활성 메모리를 감시하여 바이러스를 즉시 감지하는 것은 아닙니다 (phpMussel 주문형 스캐너입니다; phpMussel는 온 액세스 스캐너는 없습니다). 지정된 파일 만 검사 (또한 파일 업로드) 포함 된 바이러스를 검색합니다.

---


### 4. <a name="SECTION4"></a>프론트 엔드 관리

#### 4.0 프론트 엔드는 무엇입니다.

프론트 엔드는 phpMussel 설치 유지 관리 업데이트하기위한 편리하고 쉬운 방법을 제공합니다. 로그 페이지를 사용하여 로그 파일을 공유, 다운로드 할 수있는 구성 페이지에서 구성을 변경할 수 있습니다, 업데이트 페이지를 사용하여 구성 요소를 설치 및 제거 할 수 있습니다, 그리고 파일 관리자를 사용하여 vault에 파일을 업로드, 다운로드 및 변경할 수 있습니다.

무단 액세스를 방지하기 위해 프론트 엔드는 기본적으로 비활성화되어 있습니다 (무단 액세스가 웹 사이트와 보안에 중대한 영향을 미칠 수 있습니다). 그것을 가능하게하기위한 지침이 절 아래에 포함되어 있습니다.

#### 4.1 프론트 엔드를 사용하는 방법.

1) `config.ini` 안에있는 `disable_frontend` 지시문을 찾습니다 그것을 "`false`"로 설정합니다 (기본값은 "`true`"입니다).

2) 브라우저에서`loader.php`에 액세스하십시오 (예를 들어, `http://localhost/phpmussel/loader.php`).

3) 기본 사용자 이름과 암호로 로그인 (admin/password).

주의 : 당신이 처음 로그인 한 후 프론트 엔드에 대한 무단 액세스를 방지하기 위해 신속하게 사용자 이름과 암호를 변경해야합니다! 이것은 매우 중요합니다, 왜냐하면 프론트 엔드에서 임의의 PHP 코드를 당신의 웹 사이트에 업로드 할 수 있기 때문입니다.

#### 4.2 프론트 엔드 사용.

프론트 엔드의 각 페이지에는 목적에 대한 설명과 사용 방법에 대한 설명이 있습니다. 전체 설명이나 특별한 지원이 필요한 경우 지원에 문의하십시오. 또한 데모를 제공 할 YouTube에서 사용 가능한 동영상도 있습니다.


---


### 5. <a name="SECTION5"></a>CLI (명령 줄 인터페이스)

phpMussel는 윈도우 기반 시스템에서는 CLI 모드에서 대화식 파일 스캐너 역할을합니다. 자세한 내용은 설치 방법 (CLI 편)을 참조하십시오.

CLI 프롬프트에서`c`를 입력하고 엔터를 누르면 사용 가능한 CLI 명령의 목록이 표시됩니다.

또한 관심있는 사람들을 위해, CLI 모드에서 phpMussel를 사용하는 방법에 대한 비디오 자습서는 여기에서 볼 수 있습니다 :
- <https://youtu.be/H-Pa740-utc>

---


### 6. <a name="SECTION6"></a>본 패키지에 포함 된 파일

다음은 아카이브에서 일괄 다운로드되는 파일의 목록 및 스크립트 사용에 의해 생성되는 파일과이 파일이 무엇 때문인지는 간단한 설명입니다.

파일 | 설명
----|----
/_docs/ | 문서의 디렉토리입니다 (다양한 파일을 포함합니다).
/_docs/readme.ar.md | 아랍어 문서.
/_docs/readme.de.md | 독일어 문서.
/_docs/readme.en.md | 영어 문서.
/_docs/readme.es.md | 스페인 문서.
/_docs/readme.fr.md | 프랑스어 문서.
/_docs/readme.id.md | 인도네시아어 문서.
/_docs/readme.it.md | 이탈리아 문서.
/_docs/readme.ja.md | 일본어 문서.
/_docs/readme.ko.md | 한국어 문서.
/_docs/readme.nl.md | 네덜란드어 문서.
/_docs/readme.pt.md | 포르투갈어 문서.
/_docs/readme.ru.md | 러시아어 문서.
/_docs/readme.ur.md | 우르두어 문서.
/_docs/readme.vi.md | 베트남어 문서.
/_docs/readme.zh-TW.md | 중국어 번체 문서.
/_docs/readme.zh.md | 중국어 간체 문서.
/_testfiles/ | 테스트 파일의 디렉토리입니다 (다양한 파일을 포함합니다). phpMussel가 시스템에 제대로 설치되었는지 여부를 테스트하는 파일입니다. 테스트 이외의 목적으로이 디렉토리를 업로드하는 것은 아닙니다.
/_testfiles/ascii_standard_testfile.txt | phpMussel 정규화 ASCII 서명 용 테스트 파일.
/_testfiles/coex_testfile.rtf | phpMussel 확장 콤플렉스 서명 용 테스트 파일.
/_testfiles/exe_standard_testfile.exe | phpMussel PE 시그니처 용 테스트 파일.
/_testfiles/general_standard_testfile.txt | phpMussel 일반 시그니처 용 테스트 파일.
/_testfiles/graphics_standard_testfile.gif | phpMussel 그래픽 시그니처 용 테스트 파일.
/_testfiles/html_standard_testfile.html | phpMussel 정규화 HTML 서명 테스트 파일.
/_testfiles/md5_testfile.txt | phpMussel MD5 서명 용 테스트 파일.
/_testfiles/ole_testfile.ole | phpMussel OLE 서명 용 테스트 파일.
/_testfiles/pdf_standard_testfile.pdf | phpMussel PDF 서명 용 테스트 파일.
/_testfiles/pe_sectional_testfile.exe | phpMussel PE 섹 셔널 서명 용 테스트 파일.
/_testfiles/swf_standard_testfile.swf | phpMussel SWF 서명 용 테스트 파일.
/vault/ | 보루 토 디렉토리 (다양한 파일을 포함합니다).
/vault/cache/ | 캐시 디렉토리 (임시 데이터 용).
/vault/cache/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/fe_assets/ | 프론트 엔드 자산.
/vault/fe_assets/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/fe_assets/_accounts.html | 프론트 엔드의 계정 페이지의 HTML 템플릿.
/vault/fe_assets/_accounts_row.html | 프론트 엔드의 계정 페이지의 HTML 템플릿.
/vault/fe_assets/_cache.html | 프론트 엔드 데이터 캐쉬 페이지의 HTML 템플릿.
/vault/fe_assets/_config.html | 프론트 엔드 구성 페이지의 HTML 템플릿.
/vault/fe_assets/_config_row.html | 프론트 엔드 구성 페이지의 HTML 템플릿.
/vault/fe_assets/_files.html | 파일 관리자의 HTML 템플릿.
/vault/fe_assets/_files_edit.html | 파일 관리자의 HTML 템플릿.
/vault/fe_assets/_files_rename.html | 파일 관리자의 HTML 템플릿.
/vault/fe_assets/_files_row.html | 파일 관리자의 HTML 템플릿.
/vault/fe_assets/_home.html | 프론트 엔드의 홈페이지의 HTML 템플릿.
/vault/fe_assets/_login.html | 프론트 엔드 로그인 페이지의 HTML 템플릿.
/vault/fe_assets/_logs.html | 프론트 엔드 로고스 페이지의 HTML 템플릿.
/vault/fe_assets/_nav_complete_access.html | 프론트 엔드의 탐색 링크의 HTML 템플릿, 완전한 액세스를위한 것입니다.
/vault/fe_assets/_nav_logs_access_only.html | 프론트 엔드의 탐색 링크의 HTML 템플릿은 로그에만 액세스를위한 것입니다.
/vault/fe_assets/_quarantine.html | 프론트 엔드 격리 페이지의 HTML 템플릿.
/vault/fe_assets/_quarantine_row.html | 프론트 엔드 격리 페이지의 HTML 템플릿.
/vault/fe_assets/_statistics.html | 프론트 엔드 통계 페이지의 HTML 템플릿.
/vault/fe_assets/_updates.html | 프론트 엔드 업데이트 페이지의 HTML 템플릿.
/vault/fe_assets/_updates_row.html | 프론트 엔드 업데이트 페이지의 HTML 템플릿.
/vault/fe_assets/_upload_test.html | 업로드 테스트 페이지의 HTML 템플릿.
/vault/fe_assets/frontend.css | 프론트 엔드 CSS 스타일 시트.
/vault/fe_assets/frontend.dat | 프론트 엔드 데이터베이스 (계정 정보와 세션 정보 및 캐시가 포함되어 있습니다; 프론트 엔드가 활성화되어있을 때 생성).
/vault/fe_assets/frontend.html | 프론트 엔드 메인 템플릿 파일.
/vault/fe_assets/icons.php | 아이콘 핸들러 (프론트 엔드 파일 관리자에 의해 사용된다).
/vault/fe_assets/pips.php | 핍 핸들러 (프론트 엔드 파일 관리자에 의해 사용된다).
/vault/fe_assets/scripts.js | 프런트 엔드 JavaScript 데이터가 들어 있습니다.
/vault/lang/ | phpMussel 언어 데이터가 포함되어 있습니다.
/vault/lang/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/lang/lang.ar.fe.php | 프론트 엔드 아랍어 언어 데이터.
/vault/lang/lang.ar.php | 아랍어 언어 데이터.
/vault/lang/lang.bn.fe.php | 프론트 엔드 벵골어 언어 데이터.
/vault/lang/lang.bn.php | CLI 벵골어 언어 데이터.
/vault/lang/lang.de.fe.php | 프론트 엔드 독일어 언어 데이터.
/vault/lang/lang.de.php | 독일어 언어 데이터.
/vault/lang/lang.en.fe.php | 프론트 엔드 영어 데이터.
/vault/lang/lang.en.php | 영어 데이터.
/vault/lang/lang.es.fe.php | 프론트 엔드 스페인어 언어 데이터.
/vault/lang/lang.es.php | 스페인어 언어 데이터.
/vault/lang/lang.fr.fe.php | 프론트 엔드 프랑스어 언어 데이터.
/vault/lang/lang.fr.php | 프랑스어 언어 데이터.
/vault/lang/lang.hi.fe.php | 프론트 엔드 힌디어 언어 데이터.
/vault/lang/lang.hi.php | 힌디어 언어 데이터.
/vault/lang/lang.id.fe.php | 프론트 엔드 인도네시아어 언어 데이터.
/vault/lang/lang.id.php | 인도네시아어 언어 데이터.
/vault/lang/lang.it.fe.php | 프론트 엔드 이탈리아 언어 데이터.
/vault/lang/lang.it.php | 이탈리아 언어 데이터.
/vault/lang/lang.ja.fe.php | 프론트 엔드 일본어 언어 데이터.
/vault/lang/lang.ja.php | 일본어 언어 데이터.
/vault/lang/lang.ko.fe.php | 프론트 엔드의 한국어 언어 데이터.
/vault/lang/lang.ko.php | 한국어 언어 데이터.
/vault/lang/lang.nl.fe.php | 프론트 엔드 네덜란드어 언어 데이터.
/vault/lang/lang.nl.php | 네덜란드어 언어 데이터.
/vault/lang/lang.pt.fe.php | 프론트 엔드 포르투갈어 언어 데이터.
/vault/lang/lang.pt.php | 포르투갈어 언어 데이터.
/vault/lang/lang.ru.fe.php | 프론트 엔드 러시아어 언어 데이터.
/vault/lang/lang.ru.php | 러시아어 언어 데이터.
/vault/lang/lang.th.fe.php | 프론트 엔드 태국어 언어 데이터.
/vault/lang/lang.th.php | 태국어 언어 데이터.
/vault/lang/lang.tr.fe.php | 프론트 엔드 터키어 언어 데이터.
/vault/lang/lang.tr.php | 터키어 언어 데이터.
/vault/lang/lang.ur.fe.php | 프론트 엔드 우르두어 언어 데이터.
/vault/lang/lang.ur.php | 우르두어 언어 데이터.
/vault/lang/lang.vi.fe.php | 프론트 엔드 베트남어 언어 데이터.
/vault/lang/lang.vi.php | 베트남어 언어 데이터.
/vault/lang/lang.zh-tw.fe.php | 프론트 엔드 중국어 번체 언어 데이터.
/vault/lang/lang.zh-tw.php | 중국어 번체 언어 데이터.
/vault/lang/lang.zh.fe.php | 프론트 엔드 중국어 간체 언어 데이터.
/vault/lang/lang.zh.php | 중국어 간체 언어 데이터.
/vault/quarantine/ | 검역 디렉토리 (격리 된 파일 포함합니다).
/vault/quarantine/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/signatures/ | 서명 디렉토리 (서명 파일이 포함되어 있습니다).
/vault/signatures/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/signatures/switch.dat | 변수를 컨트롤 세트합니다.
/vault/.htaccess | 하이퍼 텍스트 액세스 파일 (이 경우, 본 스크립트의 중요한 파일을 권한이없는 소스의 액세스로부터 보호하기위한 것입니다).
/vault/.travis.php | 테스트를 위해 Travis CI에서 사용됩니다. (기능에 관계없는 파일입니다).
/vault/.travis.yml | 테스트를 위해 Travis CI에서 사용됩니다. (기능에 관계없는 파일입니다).
/vault/cli.php | CLI 핸들러.
/vault/components.dat | phpMussel 구성 요소 정보가 포함되어 있습니다; 업데이트 기능 사용 (프론트 엔드를 제공합니다).
/vault/config.ini.RenameMe | phpMussel 설정 파일; phpMussel 모든 옵션 설정을 포함하고 있습니다. 각 옵션의 기능과 작동 방법에 대한 설명입니다 (활성화하기 위해 이름을 변경합니다).
/vault/config.php | 구성 핸들러.
/vault/config.yaml | 설정 기본값 스 파일; phpMussel의 기본 설정이 포함되어 있습니다.
/vault/frontend.php | 프론트 엔드 핸들러.
/vault/frontend_functions.php | 프론트 엔드 기능 파일.
/vault/functions.php | 기능 파일 (기본적으로 파일).
/vault/greylist.csv | 그레이리스트 된 서명 CSV에서 phpMussel이 어떤 서명을 무시해야하는지 알려줍니다 (삭제해도 자동으로 다시 만들어집니다).
/vault/lang.php | 언어 처리기.
/vault/php5.4.x.php | PHP 5.4.X 뽀리휘루 (PHP 5.4.X의 하위 호환성을 위해 필요합니다; 더 새로운 PHP 버전을 위해 삭제하는 것이 안전합니다).
※ /vault/scan_kills.txt | phpMussel 의해 차단/삭제 된 이미지 파일의 전체 기록.
※ /vault/scan_log.txt | phpMussel 의해 스캔 된 것의 전 기록.
※ /vault/scan_log_serialized.txt | phpMussel 의해 스캔 된 것의 전 기록.
/vault/template_custom.html | phpMussel 템플릿 파일; phpMussel가 파일 업로드를 차단했을 때 생성되는 메시지의 HTML 출력 템플릿 (업 로더를 표시하는 메시지).
/vault/template_default.html | phpMussel 템플릿 파일; phpMussel가 파일 업로드를 차단했을 때 생성되는 메시지의 HTML 출력 템플릿 (업 로더를 표시하는 메시지).
/vault/themes.dat | 테마 파일. 업데이트 기능 의해 사용됩니다 (프론트 엔드를 제공합니다).
/vault/upload.php | 업로드 핸들러.
/.gitattributes | GitHub 프로젝트 파일 (기능에 관계없는 파일입니다).
/.gitignore | GitHub 프로젝트 파일 (기능에 관계없는 파일입니다).
/Changelog-v1.txt | 버전에 따른 차이를 기록한 것입니다 (기능에 관계없는 파일입니다).
/composer.json | Composer/Packagist 정보 (기능에 관계없는 파일입니다).
/CONTRIBUTING.md | 프로젝트에 기여하는 방법.
/LICENSE.txt | GNU/GPLv2 라이센스 사본 (기능에 관계없는 파일입니다).
/loader.php | 로더 파일입니다. 주요 스크립트로드, 업로드 등을 실시합니다. 훅하는 것은 바로 이것입니다 (본질적 파일)!
/PEOPLE.md | 프로젝트에 참여하는 사람들에 대한 정보.
/README.md | 프로젝트 개요 정보.
/web.config | ASP.NET 설정 파일 (스크립트가 ASP.NET 기술을 기초로하는 서버에 설치된 때 `/vault` 디렉토리를 무단 소스에 의한 액세스로부터 보호하는 것입니다).

※ 파일 이름 설정 방법 (`config.ini` 내)에 따라 다를 수 있습니다.

---


### 7. <a name="SECTION7"></a>설정 옵션
다음은 `config.ini`설정 파일에있는 변수 및 그 목적과 기능의 목록입니다.

#### "general" (카테고리)
일반 설정.

"cleanup"
- 처음 업로드 후 변수 및 캐시 설정을 클리어 여부에 대한 스크립트입니다. `false` (가짜) = 아니오;`true` (진정한) = 예 (Default / 기본 설정). 처음 업로드 스캐닝 이외로 사용할 수 없으면,`true` (참)로 메모리 사용량을 최소화합니다. 사용하는 경우,`false` (가짜)으로 메모리에 불필요한 중복 데이터를 다시로드하는 것을 방지합니다. 일반적으로`true` (진정한). 로 설정하고 있지만, 처음 업로드 스캐닝에 대해서만 사용할 수 없음을 기억하십시오.
- CLI 모드에서 영향을주지 않습니다.

"scan_log"
- 전체 스캔 결과를 기록하는 파일의 파일 이름. 파일 이름 지정하거나, 해제하려면 비워하십시오.

"scan_log_serialized"
- 전체 스캔 결과를 기록하는 파일의 파일 이름 (serialization 형식을 이용). 파일 이름 지정하거나, 해제하려면 비워하십시오.

"scan_kills"
- 차단되거나 삭제 된 업로드의 모든 것을 기록하는 파일의 파일 이름. 파일 이름 지정하거나, 해제하려면 비워하십시오.

*유용한 팁 : 당신이 원하는 경우 로그 파일 이름에 날짜/시간 정보를 부가 할 수 있습니다 이름 이들을 포함하여 : 전체 연도에 대한 `{yyyy}`생략 된 년간 `{yy}`달 `{mm}`일 `{dd}`시간 `{hh}`.*

*예 :*
- *`scan_log='scan_log.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_log_serialized='scan_log_serialized.{yyyy}-{mm}-{dd}-{hh}.txt'`*
- *`scan_kills='scan_kills.{yyyy}-{mm}-{dd}-{hh}.txt'`*

"truncate"
- 로그 파일이 특정 크기에 도달하면 잘 있습니까? 값은 로그 파일이 잘 리기 전에 커질 가능성이있는 B/KB/MB/GB/TB 단위의 최대 크기입니다. 기본값 "0KB"은 절단을 해제합니다 (로그 파일은 무한정 확장 할 수 있습니다). 참고 : 개별 로그 파일에 적용됩니다! 로그 파일의 크기는 일괄 적으로 고려되지 않습니다.

"log_rotation_limit"
- 로그 회전은 한 번에 존재해야하는 로그 파일 수를 제한합니다. 새 로그 파일을 만들 때 총 로그, 파일 수가 지정된 제한을 초과하면, 지정된 작업이 수행됩니다. 여기서 원하는 한계를 지정할 수 있습니다. 값 0은 로그 회전을 비활성화합니다.

"log_rotation_action"
- 로그 회전은 한 번에 존재해야하는 로그 파일 수를 제한합니다. 새 로그 파일을 만들 때 총 로그, 파일 수가 지정된 제한을 초과하면, 지정된 작업이 수행됩니다. 여기서 원하는 동작을 지정할 수 있습니다. Delete = 제한이 더 이상 초과되지 않을 때까지, 가장 오래된 로그 파일을 삭제하십시오. Archive = 제한이 더 이상 초과되지 않을 때까지, 가장 오래된 로그 파일을 보관 한 다음 삭제하십시오.

*기술적 설명 : 이 문맥에서 "가장 오래된"은 "최근에 수정되지 않은"을 의미합니다.*

"timeOffset"
- 귀하의 서버 시간은 로컬 시간과 일치하지 않는 경우, 당신의 요구에 따라 시간을 조정하기 위해, 당신은 여기에 오프셋을 지정할 수 있습니다. 하지만 그 대신에 일반적으로 시간대 지시문 (당신의`php.ini` 파일)을 조정 る 것이 좋습니다,하지만 때때로 (같은 제한 공유 호스팅 제공 업체에서 작업 할 때) 이것은 무엇을하는 것이 항상 가능하지는 않습니다 따라서이 옵션은 여기에서 볼 수 있습니다. 오프셋 분이며 있습니다.
- 예 (1 시간을 추가합니다) : `timeOffset=60`

"timeFormat"
- phpMussel에서 사용되는 날짜 형식. Default (기본 설정) = `{Day}, {dd} {Mon} {yyyy} {hh}:{ii}:{ss} {tz}`.

"ipaddr"
- 연결 요청의 IP 주소를 어디에서 찾을 것인가에 대해 (Cloudflare 같은 서비스에 대해 유효). Default (기본 설정) = REMOTE_ADDR. 주의 : 당신이 무엇을하고 있는지 모르는 한이를 변경하지 마십시오.

"enable_plugins"
- 플러그인 지원을 활성화 하시겠습니까? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"forbid_on_block"
- 업로드 파일이 차단 된 메시지와 함께 phpMussel에서 403 헤더를 보내야하거나 일반 200 좋은지에 대해. `false` = 아니오 (200) Default / 기본 설정; `true` = 예 (403).

"delete_on_sight"
- 이 지시문을 사용하면 감지 기준 (서명이든 뭐든)에 있던 업로드 파일은 즉시 삭제됩니다. 클린 판단 된 파일은 그대로입니다. 아카이브의 경우, 문제의 파일이 일부라도 아카이브 모든이 삭제 대상이됩니다. 업로드 파일 검사에서는 본 지시어를 활성화 할 필요는 없습니다. 왜냐하면 PHP는 스크립트 실행 후 자동으로 캐시의 내용을 파기하기 때문입니다. 즉, 파일이 이동되거나 복사되거나 삭제되지 않는 한, PHP는 서버에 업로드 한 파일을 남겨 두는 것은 보통 없습니다. 이 지시어는 보안에 공을들이는 목적으로 설치되어 있습니다. PHP는 드물게 예상치 못한 행동을 할 수 있기 때문입니다. `false` = 스캔 후 파일은 그대로 (기본 설정). `true` = 스캔 후 깨끗해야 즉시 삭제합니다.

"lang"
- phpMussel의 기본 언어를 설정합니다.

"numbers"
- 숫자를 표시하는 방법을 지정합니다.

"quarantine_key"
- phpMussel은 필요하다면, phpMussel의 보루 토에서 독립적으로 플래그 첨부 파일의 업로드를 검역 할 수 있습니다. 일반적인 phpMussel 사용자는 웹 사이트 및 호스팅 환경 보호가 있으면 충분하다고 생각하고 플래그가있는 같은 것이 추가 분석을 가하려까지 요청이없는 것이므로 무효로 될 수 있습니다. 그렇지만 상세하게 분석하여 악성 코드에 대비하려는 사용자는 사용하면 좋습니다. 플래그 첨부 파일 업로드 격리 가양 디버깅에 도움이 될 수 있습니다. 격리 기능을 해제하려면`quarantine_key` 지시문을 비워 두거나 비어 있지 않은 경우 지시문의 내용을 삭제하십시오. 활성화하려면 데이레쿠티부에 어떤 값을 넣어주세요. `quarantine_key` 격리 기능의 중요한 보안 요소이며, 검역 기능에 저장된 데이터의 집행을 각종 공격으로부터 지키고 있습니다. `quarantine_key`는 암호처럼 생각하세요. 긴 것이 더 안전 할 수 있습니다. 가장 효과적인 사용법은`delete_on_sight`과 함께합니다.

"quarantine_max_filesize"
- 격리 된 파일 크기 제한. 이 값보다 큰 파일은 격리되지 않습니다. 쿠오란팅의 용량을 초과 비정상적으로 큰 파일 크기 공격에서 메모리가 낭비되는 것을 방지하는 의미에서 중요합니다. 기본값은 2MB입니다.

"quarantine_max_usage"
- 검역을 위해 사용할 최대 메모리 량. 전체 메모리 양이 사용되면이 범위에 맞게 오래된 파일이 삭제 대상이됩니다. 쿠오란팅의 용량을 초과 비정상적으로 큰 파일 크기 공격에서 메모리가 낭비되는 것을 방지하는 의미에서 중요합니다. 기본 설정은 64MB입니다.

"honeypot_mode"
- 허니팟 모드가 활성화되어 있으면 phpMussel 업로드되어 온 모든 파일을 예외없이 검역합니다. 서명에 부합하는지 여부는 문제가되지 않습니다. 스캐닝 및 분석도 이루어지지 않습니다. phpMussel를 바이러스/악성 코드 리서치에 사용할 생각하는 사용자에게 유익 할 것입니다. 그러나 업로드 파일 스캐닝이라는 점에서는 그다지 권장되지 않으며, 허니 모드를 본래의 목적 이외에 사용하는 것이 좋습니다 수 없습니다. 그러나 업로드 파일 스캐닝이라는 점에서는 그다지 권장되지 않으며, 허니 모드를 본래의 목적 이외에 사용하는 것이 좋습니다 수 없습니다. 기본 설정은 무효입니다. `false` = Disabled/장애인 (Default / 기본 설정); `true` = Enabled/유효.

"scan_cache_expiry"
- phpMussel는 스캐닝 결과를 얼마 동안 캐시해야합니까? 초이며, 기본값은 21,600 초 (6 시간)로되어 있습니다. 0으로 설정하면 캐시 비활성화됩니다.

"disable_cli"
- CLI 모드를 해제 하는가? CLI 모드 (시에루아이 모드)는 기본적으로 활성화되어 있지만, 테스트 도구 (PHPUnit 등) 및 CLI 기반의 응용 프로그램과 간섭하는 가능성이 없다고는 단언 할 수 없습니다. CLI 모드를 해제 할 필요가 없으면이 데레쿠티부 무시 받고 괜찮습니다. `false` = CLI 모드를 활성화합니다 (Default / 기본 설정); `true` = CLI 모드를 해제합니다.

"disable_frontend"
- 프론트 엔드에 대한 액세스를 비활성화하거나? 프론트 엔드에 대한 액세스는 phpMussel을 더 쉽게 관리 할 수 있습니다. 상기 그것은 또한 잠재적 인 보안 위험이 될 수 있습니다. 백엔드를 통해 관리하는 것이 좋습니다,하지만 이것이 불가능한 경우 프론트 엔드에 대한 액세스를 제공. 당신이 그것을 필요로하지 않는 한 그것을 해제합니다. `false` = 프론트 엔드에 대한 액세스를 활성화합니다; `true` = 프론트 엔드에 대한 액세스를 비활성화합니다 (Default / 기본 설정).

"max_login_attempts"
- 로그인 시도 횟수 (프론트 엔드). Default / 기본 설정 = 5.

"FrontEndLog"
- 프론트 엔드 로그인 시도를 기록하는 파일. 파일 이름 지정하거나, 해제하려면 비워하십시오.

"disable_webfonts"
- 웹 글꼴을 사용하지 않도록 설정 하시겠습니까? True = 예 (Default / 기본 설정); False = 아니오.

"maintenance_mode"
- 유지 관리 모드를 사용 하시겠습니까? True = 예; False = 아니오 (Default / 기본 설정). 프런트 엔드 이외의 모든 것을 비활성화합니다. CMS, 프레임 워크 등을 업데이트 할 때 유용합니다.

"default_algo"
- 향후 모든 암호와 세션에 사용할 알고리즘을 정의합니다. 옵션 : PASSWORD_DEFAULT (default / 기본 설정), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 가 필요합니다).

"statistics"
- phpMussel 사용 통계를 추적합니까? True = 예; False = 아니오 (Default / 기본 설정).

"allow_symlinks"
- 때로는 phpMussel이 특정 방식으로 이름을 지정할 때 파일에 직접 액세스 할 수없는 경우가 있습니다. 심볼릭 링크를(symlinks) 통해 간접적으로 파일에 액세스하면이 문제를 해결할 수 있습니다. 그러나, 일부 시스템에서는, 심볼릭 링크를(symlinks) 사용하는 것이 금지되거나 관리 권한이 필요할 수 있으므로 항상 유용한 해결책은 아닙니다. 직접 액세스 할 수없는 경우, 이 지시자는 phpMussel이 심볼릭 링크를(symlinks) 사용하여 파일에 간접적으로 액세스해야하는지 여부를 결정합니다. True = 심볼릭 링크 사용; False = 심볼릭 링크 비활성화 (Default / 기본 설정).

#### "signatures" (카테고리)
시그니처.

"Active"
- 쉼표로 구분 된 활성 시그니처 파일의 목록입니다.

"fail_silently"
- 서명 파일이 없거나 손상된 경우 phpMussel 그것을 리포트 해야하는지 여부? `fail_silently`이 유효하지 않으면 문제가 리포트되어 유효하면 문제는 무시 된 스캔 보고서가 작성됩니다. 충돌하는 같은 피해가 없으면 기본 설정을 그대로 유지한다. `false` = Disabled/장애인; `true` = Enabled/유효 (Default / 기본 설정).

"fail_extensions_silently"
- 확장자가없는 경우 phpMussel이 그것을보고해야하는지 여부? `fail_extensions_silently`이 잘못된 경우 확장자없이는 스캐닝시에보고되고 활성화되면 무시됩니다 문제는보고되지 않습니다. 이 지시어를 무효로하는 것은 보안을 향상시킬 수 있지만, 오진도 증가 할 수 있습니다. `false` = Disabled/장애인; `true` = Enabled/유효 (Default / 기본 설정).

"detect_adware"
- phpMussel 애드웨어 탐지를 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_encryption"
- phpMussel이 암호화 된 파일을 탐지하고 차단해야합니까? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_joke_hoax"
- phpMussel 장난 / 위조 및 악성 코드 / 바이러스 탐지를 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_pua_pup"
- phpMussel는 PUAs/PUPs 탐지를 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_packer_packed"
- phpMussel는 패커와 팩 데이터 검출을 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_shell"
- phpMussel는 shell 스크립트 탐지를 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

"detect_deface"
- phpMussel를 위조 및 디훼사 탐지를 위해 서명을 분석해야하는지 여부? `false` = 아니오; `true` = 예 (Default / 기본 설정).

#### "files" (카테고리)
파일 취급 설정.

"max_uploads"
- 한 번에 스캔 할 수있는 업로드 파일 수 제한으로이를 초과하면 스캔을 중단하고 사용자에게 그 사실을 알리고 논리적 공격으로부터 보호 역할을합니다. 시스템과 CMS가 DDoS 공격을 만나 phpMussel가 오버로드하여 PHP 프로세스에 지장을 초래하는 일이 없도록하기 위해서입니다. 권장 수는 10이지만, 하드웨어의 속도에 따라 더 이상 / 이하이 좋은 것도있을 것입니다. 이 숫자는 아카이브의 내용을 포함하지 않는 것을 기억하십시오.

"filesize_limit"
- 파일 크기 제한의 단위는 KB입니다. 65536 = 64MB (Default / 기본 설정); 0 = 제한하지 않습니다 (제한없이 항상 그레이리스트 화) 양수이면 무엇이든 상관 없습니다. PHP 설정에서 메모리에 제한이 있고, 업로드 파일 크기 제한이 설정되어있는 경우에 효과적입니다.

"filesize_response"
- 최대 크기보다 큰 파일을 처리하는 방법에 관한 것입니다. `false` = Whitelist/화이트리스트; `true` = Blacklist/블랙리스트 (Default / 기본 설정).

"filetype_whitelist", "filetype_blacklist", "filetype_greylist"
- 시스템이 특정 유형의 파일 만 업로드를 허용하거나 거절하는 경우 파일 유형을 적절히 화이트리스트, 블랙리스트, 그레이리스트로 분류 해두면 파일 유형에 튀겨 진 파일은 스캔을 건너 뛸 수 때문에 속도로 연결됩니다. 형식은 CSV (쉼표로 구분)입니다. 목록에 의하지 않고 모두를 검사 할 경우 변수는 빈 상태로 유지하고 화이트리스트 / 블랙리스트 / 그레이리스트를 해제합니다.
- 프로세스의 논리적 순서:
 - 파일 형식이 화이트리스트에 포함되어 있으면, 스캔하지 않고 블록하지 않고 블랙리스트 및 그레이리스트에 체크를하지 않습니다.
 - 파일 형식이 블랙리스트에 있으면 스캔하지 않고 즉시 차단하고 그레이리스트에 체크를하지 않습니다.
 - 회색 목록이 비어 또는 그레이리스트가 하늘이 아닌 한편 그 파일 타입이 있으면 정상적으로 스캔 차단 여부를 판단합니다. 그레이리스트가 하늘이 아닌 한편 그 파일 유형이 포함되어 있지 않으면 블랙리스트와 같은 취급을 할 수 있고 스캔없이 차단합니다.

"check_archives"
- 아카이브의 컨텐츠에 대해 체크를 시도 여부에 대해서입니다. `false` = 체크하지 않는다; `true` = 확인 (Default / 기본 설정).
- 현재 지원하고있는 것은 BZ, GZ, LZF, ZIP 형식입니다 (RAR, CAB, 7z 등은 제외).
- 본 기능은 만능이 아니므로 활성화하는 것이 좋습니다 있지만 반드시 모두를 검출하는 것을 보증하는 것은 아닙니다.
- 또한 현재 체크 아카이브는 ZIP 대해 재귀 않는다는 점에 유의하십시오.

"filesize_archives"
- 파일 크기 블랙리스트/화이트리스트 화를 아카이브의 컨텐츠에 반입 여부? `false` = 아니오 (단지 그레이리스트 모두); `true` = 예 (Default / 기본 설정).

"filetype_archives"
- 파일 타입 블랙리스트/화이트리스트 화를 아카이브의 컨텐츠에 반입 여부? `false` = 아니오 (단지 그레이리스트 모두) (Default / 기본 설정); `true` = 예.

"max_recursion"
- 아카이브에 대한 최대 재귀 깊이입니다. 기본 설정 = 10.

"block_encrypted_archives"
- 암호화 된 아카이브를 감지하고 차단 여부? phpMussel은 암호화 된 아카이브를 검색 할 수 없기 때문에 아카이브의 암호화를 통해 phpMussel 안티 바이러스 스캐너 등을 かいくぐろ하려는 공격자가 있을지도 모릅니다. 암호화 된 아카이브를 차단함으로써 이러한 위험을 방지 할 수 있습니다. `false` = 아니오; `true` = 예 (Default / 기본 설정).

#### "attack_specific" (카테고리)
어택 자 스페시 픽 지시어.

카메론 침입 탐지. `false` = 해제; `true` = 온.

"chameleon_from_php"
- 파일도 아니고 PHP 아카이브도 인식 할 수없는 파일에서 PHP 헤더를 찾습니다.

"chameleon_from_exe"
- 실행 파일없이 실행 파일의 아카이브도 인식 할 수없는 파일의 실행 헤더 및 악성 헤더의 실행 파일을 찾습니다.

"chameleon_to_archive"
- 헤더가 잘못 보관을 찾습니다 (BZ, GZ, RAR, ZIP, GZ 지원).

"chameleon_to_doc"
- 헤더가 잘못 오피스 문서를 찾습니다 (DOC, DOT, PPS, PPT, XLA XLS, WIZ 지원).

"chameleon_to_img"
- 헤더가 잘못된 이미지 파일을 찾습니다 (BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP 지원).

"chameleon_to_pdf"
- 헤더가 잘못 PDF 파일을 찾습니다.

"archive_file_extensions"
- 인식 가능한 아카이브 파일 확장입니다 (CSV 형식; 문제가있을 경우에만 추가 또는 제거해야합니다. 실수로 제거하면 오진의 원인이 될 수 있습니다. 반대로 실수로 추가하면 어택 자 스페시 픽 검출에서 추가 된 화이트리스트 화되어 버립니다. 충분히주의 위 변경하십시오. 또한 컨텐트 수준에서 아카이브를 분석 할 수 있는지 여부에는 영향을주지 않습니다). 기본적으로 가장 일반적 형식을 나열하고 있지만 의도적으로 포괄적으로하지 않습니다.

"block_control_characters"
- 제어 문자를 포함한 파일을 차단 여부 (줄 바꿈을 제외한)? 에 관한 것입니다 ([\x00-\x08\x0b\x0c\x0e\x1f\x7f]). 만약 텍스트를 업로드하는 경우,이 옵션을 사용하여 추가 보호를 강화할 수 있습니다. 텍스트 이외도 업로드 할 경우, 사용하면 오진의 원인이 될 수 있습니다. `false` = 차단하지 (Default / 기본 설정); `true` = 차단합니다.

"corrupted_exe"
- 손상된 파일과 오류 분석. `false` = 무시; `true` = 차단 (Default / 기본 설정). 손상의 가능성이있는 PE 파일을 차단 검출 여부? 관한 것입니다. PE 파일의 일부가 손상되어 제대로 분석 할 수없는 것은 드물지 않고, 바이러스 감염을 보는 바로미터가됩니다. PE 파일의 바이러스를 감지하는 안티 바이러스 프로그램은 PE 파일 분석을 실시 합니다만, 바이러스를 만드는 사람이 바이러스가 검출되지 않도록 그것을 피하려고 할 것이기 때문입니다.

"decode_threshold"
- 디코드 명령이 감지 될 원시 데이터의 길이 제한 (스캐닝 중에 눈에 띄는 문제가있는 경우에는 필요에 따라 설정). 기본값 = 512KB. 제로 또는 값 없음 (null)은 임계 값을 비활성화합니다 (파일 크기의 제한을 제거합니다).

"scannable_threshold"
- phpMussel이 읽고 스캔 할 수있는 원시 데이터의 길이에 대한 임계 값 (스캐닝 중에 눈에 띄는 문제가있는 경우에는 필요에 따라 설정). 기본값 = 32MB. 제로 또는 값 없음 (null)은 임계 값을 비활성화합니다. 값은 서버 나 웹 사이트에 업로드되는 파일의 평균 파일 크기보다 크고 filesize_limit 지시어보다 작게 설정해야합니다. 또한 `php.ini` 설정에 따라 PHP에 할당 된 메모리의 대략 5 분의 1을 초과해서는 없습니다. 이 지시문은 phpMussel가 메모리를 너무 많이 사용하지 않도록하기위한 것입니다. (일정 크기 이상의 파일은 스캔하지 못할 수도 있습니다).

#### "compatibility" (카테고리)
phpMussel 호환성 지시문.

"ignore_upload_errors"
- 시스템에서 phpMussel의 기능에 수정이 필요한 경우가 아니면이 지시문은 일반적으로 사용할 수 없습니다. 비활성화하면 `$_FILES` array()요소를 감지했을 때, 그 요소가 나타내는 파일의 스캔이 시작됩니다, 요소가 비어 있거나없는 경우 phpMussel는 오류 메시지를 반환합니다. 이것은 본래 phpMussel가 있어야 할 모습입니다. 그러나 CMS에서는 $_FILES 하늘 요소는 일반적으로 발생하는 것이며, 정상적인 phpMussel의 행동이 정상적인 CMS의 거동을 저해 할 우려가 있습니다. 이러한 경우에는 본 옵션을 사용하여 phpMussel 빈 요소를 검사하고 오류 메시지를 반환을 피하고 요청한 페이지로 원활하게 진행할 수 있도록합니다. `false` = OFF (해제입니다); `true` = ON (온입니다).

"only_allow_images"
- 시스템 또는 CMS에 이미지 파일의 업로드 만 허용한다면이 지시어가 동작해야하며, 그렇지 않으면 무효로합니다. 사용하면 이미지와 알 수없는 파일은 검사하지 않고 차단하기 때문에 프로세스 시간 단축 및 메모리 절약을 기대할 수 있습니다. `false` = OFF (해제입니다); `true` = ON (온입니다).

#### "heuristic"
경험적 지시문 그림.

"threshold"
- phpMussel이 파일은 의심 위험성이 높다고 판단하는 서명이 있습니다. 임계 값은 업로드 된 파일의 위험의 최대 값이며이를 초과하면 악성 코드로 판단됩니다. 여기에서 위험의 정의는 의심과 특정되었지만 수입니다. 기본적으로 3으로 설정되어 있습니다. 이보다 낮은 오진의 가능성이 증가하고, 너무 크면 오류 검출은 감소하지만 위험성이있는 파일이 검색되지 않을 수 증가하게됩니다. 특히 문제가 없으면 기본 설정을 유지하는 것이 좋습니다.

#### "virustotal" (카테고리)
VirusTotal.com 지시문 그림.

"vt_public_api_key"
- 옵션이지만, phpMussel은 Virus Total API를 사용하여 파일을 검색 할 수 있습니다. 바이러스, 트로이 목마, 악성 코드 및 기타 공격에 매우 효과적으로 작동합니다. 기본적으로 Virus Total API를 사용한 스캐닝은 비활성화되어 있습니다. 활성화하려면 Virus Total의 API 키가 필요합니다. 이점이 매우 크기 때문에 사용하는 것이 좋습니다. Virus Total API의 사용에 있어서는 Virus Total 문서에있는대로 이용 규정 및 지침을 준수하지 않으면 안됩니다. 이 통합 기능을 사용하기 위해서는 :
 - Virus Total와 API의 서비스 규정을 읽고 동의해야합니다. [서비스 규정은 여기에서](https://www.virustotal.com/en/about/terms-of-service/).
 - 최소 Virus Total Public API 문서의 전문을 읽고 이해하여 ("VirusTotal Public API v2.0"이후 "Contents"이전까지). Virus Total Public API [문서는 여기에서](https://www.virustotal.com/en/documentation/public-api/).

주의 : Virus Total API 사용한 스캐닝이 비활성화되어있는 경우, 이 카테고리 (`virustotal`) 지시문을 참조 할 필요가 없습니다. 무효이면, 모두 작동하지 않습니다. Virus Total API 키를 얻으려면, Virus Total 사이트의 페이지 오른쪽 상단에있는 링크 "커뮤니티에 가입"을 클릭하여 필요한 사항을 기입하여 가입합니다. 지침에 따라 공용 API 키를 취득한 후`config.ini` 설정 파일`vt_public_api_key` 지시문 그것을 복사 및 붙여 넣기하십시오.

"vt_suspicion_level"
- 기본 설정은 phpMussel이 Virus Total API를 사용하여 스캔 파일 (疑がわし 주물)에 제한이 있습니다. `vt_suspicion_level` 지시문을 편집 할 더, 이 제한을 변경할 수 있습니다.
- `0` : phpMussel의 시그니처를 사용하여 검사 한 결과 경험적 가중치가 있다고 판단 된 경우에만 의심스러운 파일 결론됩니다. 즉 Virus Total API는 phpMussel가 위험을 감지는했지만 완전히 그렇다고 단언하고, 따라서 블록도하지 않고 플래그를 붙이는 것도하지 않았을 때의 다른 의견입니다.
- `1` : phpMussel의 시그니처를 사용하여 검사 한 결과, 실행 파일과 같습니다 (PE 파일, Mach-O 파일은, ELF/Linux 파일 등), 혹은 실행 가능한 데이터를 포함한 포맷 (매크로, DOC/DOCX 파일 아카이브 RAR/ZIP 파일 등)이 있으면 경험적 가중치가 있다고 의심 파일과 결론됩니다. 이것은 기본 설정이며 권장 수준이기도합니다. Virus Total API는 phpMussel가 위험없이 판단하고 따라서 블록도하지 않고 플래그를 붙이는 것도하지 않았을 때의 다른 의견입니다.
- `2` : 파일은 모든 의심스러운 것으로되어 Virus Total API를 사용하여 스캔됩니다. API 할당을 고갈 우려가 있기 때문에 권장 앞두고 있지만 상황에 따라 적절하다고 말할 수 있습니다 (예를 들어, 웹 마스터 나 호스트 마스터가 업로드되는 내용을 신뢰할 수없는 상황 등). 이 경보 수준은 보통 블록 / 플래그도 대상이되지 않는 파일도 모두 Virus Total API를 사용하여 스캔됩니다. 따라서 Virus Total API의 할당을 서서히 소비 해 버리는 일도 얻고 또한 API 할당을 使い切れ하면 phpMussel은 Virus Total API의 사용을 중지합니다 (경계 수준에 관계없이).

주의 : phpMussel 의해 블랙리스트, 화이트리스트 된 파일은 Virus Total API를 사용한 스캔의 대상이되지 않습니다. 이들은 이미 선악이 결론 낸 것이며, Virus Total API에서 다시 스캔 할 필요는 없기 때문입니다. phpMussel가 Virus Total API를 사용하는 것은 phpMussel 자신이 위험 여부에 대해 판단하기 어려운 상황에서 보조 할 수 있습니다.

"vt_weighting"
- phpMussel이 Virus Total API를 사용한 스캐닝 결과를 감지으로 대우하거나, 검색 가중치로 취급 할 것인가? 여러 엔진 (Virus Total처럼)을 사용한 스캐닝은 검색 속도 향상 (더 많은 악성 코드가 감지)을 가져다 한편 오진의 증가도 발생하므로이 지시어가 존재합니다. 따라서 스캐닝 결과는 결정적인 판단이 아니라 신뢰 점수로 사용하는 것이 적절한 경우도 있습니다. 값이 0이면 Virus Total API를 사용한 검색은 검색으로 처리되어 Virus Total 엔진이 악성 코드 및 플래그가 지정된 파일은 phpMussel도 악성 코드로 판단합니다. 다른 값의 경우 결과는 검출 가중되고, 스캔 된 파일이 악성 코드 여부 phpMussel가 결정하는 신뢰 점수 (또는 감지 가중치)입니다 (값은 악성이라고 판단하기위한 최소 신뢰 점수 또는 가중치). 기본값은 0입니다.

"vt_quota_rate"와 "vt_quota_time"
- Virus Total API 문서에 따르면 "1 분간의 타임 프레임 사이에 요청 최대 4 회" 의 제한이 있습니다. 허니 클라이언트와 허니팟 등의 자동화를 사용하여 리포트를받을뿐만 아니라 VirusTotal 자원을 제공하는 경우, 상한은 올라갑니다. phpMussel 기본적으로 최대 4 번을 준수하고 있습니다 만, 위의 상황에서이 두 디렉토리를 준비하고 상황에 맞게 변경할 수 있도록되어 있습니다. 한계에 도달 버리는 등의 불편이나 문제가 없으면 기본값을 변경하는 것은 권장되지 않지만 값을 작게하는 것이 적절한 경우도 있습니다. 상한은 시간 프레임`vt_quota_time` (분 내에) `vt_quota_rate`로 설정합니다.

#### "urlscanner" (카테고리)
phpMussel에는 URL 스캐너가 내장되어 스캔 된 파일이나 데이터의 악의적 인 URL을 감지 할 수 있습니다.

주의 : URL 스캐너를 사용하지 않을 경우이 카테고리 (`urlscanner`)를 참조 할 필요가 없습니다.

URL 스캐너 API 조회 설정.

"lookup_hphosts"
- True로하면 API를 [hpHosts](http://hosts-file.net/) 조회가 활성화됩니다. hpHosts은 API 조회를 수행하기 위해 API 키가 필요하지 않습니다.

"google_api_key"
- 필요한 API 키가 정의되면, API는 Google Safe Browsing API 조회가 활성화됩니다. Google Safe Browsing API 룩 앱스에 필요한 API 키는에서 [얻을 수 있습니다](https://console.developers.google.com/).
- 참고 : Google Safe Browsing API 조회는 아직 완성되지 않기 때문에 미래의 이용을 상정하고 있습니다.

"maximum_api_lookups"
- 스캔 반복의 API 조회의 최대 수입니다. API 조회 때마다 스캔 반복의 시간이 쌓여 버리므로, 스캔 처리 속도 향상을 위해 제한을두고 싶다고 생각할지도 모릅니다. 0은 제한 없음을 의미합니다. 기본값은 10입니다.

"maximum_api_lookups_response"
- API 조회 횟수 제한을 초과했을 때의 대응입니다. `false` = 아무것도 / 처리를 계속한다 (Default / 기본 설정); `true` = 파일에 플래그를 지정 / 차단한다.

"cache_time"
- API 조회의 결과를 얼마나 캐시할지 (초 단위)? 기본값은 3600 초 (한 시간).

#### "legal" (카테고리)
법적 요구 사항과 관련된 구성.

*법적 요구 사항 및 이것이 구성 요구 사항에 미치는 영향에 대한 자세한 내용은 설명서의 "[법률 정보](#SECTION11)"절을 참조하십시오.*

"pseudonymise_ip_addresses"
- 로그 파일을 쓸 때 가명으로하다 IP 주소? True = 예; False = 아니오 (Default / 기본 설정).

"privacy_policy"
- 생성 된 페이지의 꼬리말에 표시 할 관련 개인 정보 정책 방침의 주소입니다. URL 지정, 또는 사용하지 않으려면 비워 두십시오.

#### "template_data" (카테고리)
템플릿과 테마 지시어 / 변수.

템플릿의 데이터는 사용자를 향해 업로드 거부 메시지를 HTML 형식으로 출력 할 때 사용됩니다. 사용자 지정 테마를 사용하는 경우는`template_custom.html`를 사용하고, 그렇지 않은 경우는`template.html`를 사용하여 HTML 출력이 생성됩니다. 설정 파일에서이 섹션의 변수는 HTML 출력에 대한 해석되어로 둘러싸인 변수 이름은 해당 변수 데이터로 대체합니다. 예를 들어`foo="bar"`하면 HTML 출력의`<p>{foo}</p>`는`<p>bar</p>`입니다.

"theme"
- phpMussel에 사용할 기본 테마.

"Magnification"
- 글꼴 배율. Default (기본 설정) = 1.

"css_url"
- 사용자 지정 테마 템플릿 파일은 외부 CSS 속성을 사용하고 있습니다. 한편, 기본 테마는 내부 CSS입니다. 사용자 정의 테마를 적용하는 CSS 파일의 공개적 HTTP 주소를 "css_url"변수를 사용하여 지정하십시오. 이 변수가 공백이면 기본 테마가 적용됩니다.

---


### 8. <a name="SECTION8"></a>서명 포맷

*참조 :*
- *["서명"이란 무엇입니까?](#WHAT_IS_A_SIGNATURE)*

phpMussel 서명 파일의 첫 번째 9 바이트 `[x0-x8]` 는`phpMussel`이며, "매직 넘버" (magic number)로 기능합니다 (그들을 서명 파일로 식별하기 위해). 서명 파일이 아닌 파일을 잘못 사용하는 것을 방지 할 수 있습니다. 다음 바이트는 `[x9]` 서명 파일의 유형을 식별합니다. 서명 파일을 올바르게 해석 할 수 있도록하기 위해 이것을 알고 있어야합니다. 다음 유형의 서명 파일이 인식됩니다.

유형 | 바이트 | 설명
---|---|---
`General_Command_Detections` | `0?` | CSV (쉼표로 구분 된 값)의 서명 파일. 서명은 16 진수로 인코딩 된 문자열입니다. 여기 서명에는 이름 및 기타 세부 사항은 없습니다 (검색 문자열 만).
`Filename` | `1?` | 파일 이름의 서명.
`Hash` | `2?` | 해시 서명.
`Standard` | `3?` | 파일 내용에서 직접 운영하는 서명 파일.
`Standard_RegEx` | `4?` | 파일 내용에서 직접 운영하는 서명 파일. 서명에 정규 표현식을 포함 할 수 있습니다.
`Normalised` | `5?` | ANSI 표준화 된 파일 내용에서 작동하는 서명 파일.
`Normalised_RegEx` | `6?` | ANSI 표준화 된 파일 내용에서 작동하는 서명 파일. 서명에 정규 표현식을 포함 할 수 있습니다.
`HTML` | `7?` | HTML 표준화 된 파일 내용에서 작동하는 서명 파일.
`HTML_RegEx` | `8?` | HTML 표준화 된 파일 내용에서 작동하는 서명 파일. 서명에 정규 표현식을 포함 할 수 있습니다.
`PE_Extended` | `9?` | PE 메타 데이터에서 작동하는 서명 파일 (PE 섹션 메타 데이터는 사용할 수 없습니다).
`PE_Sectional` | `A?` | PE 섹션 메타 데이터에서 작동하는 서명 파일.
`Complex_Extended` | `B?` | phpMussel 의해 생성 된 확장 메타 데이터를 기반으로 다양한 규칙에서 동작하는 서명 파일.
`URL_Scanner` | `C?` | URL에서 작동하는 서명 파일.

다음 바이트는 `[x10]` 개행이며 `[0A]`, phpMussel 서명 파일의 헤더를 끝냅니다.

이후 각 비어 있지 않은 행은 서명 또는 규칙입니다. 각 서명 또는 규칙은 한 줄을 차지합니다. 지원되는 서명 형식은 다음과 같습니다.

#### *파일 이름 서명*
파일 이름 서명의 형식은 예외없이 다음과 같이됩니다.

`NAME:FNRX`

NAME은 그 서명을 가리키는 이름으로 FNRX은 파일 이름 (인코딩되지 않은)에 일치하는 정규식 패턴입니다.

#### *해시 서명*
해시 서명의 형식은 예외없이 다음과 같이됩니다.

`HASH:FILESIZE:NAME`

HASH는 모든 파일의 해시 (보통 MD5), FILESIZE 파일의 전체 크기, NAME은 그 서명을 가리키는 이름입니다.

#### *PE 섹션 셔널 서명*
PE 섹션 셔널 서명의 형식은 예외없이 다음과 같이됩니다.

`SIZE:HASH:NAME`

HASH는 PE 파일이있는 부분의 MD5 해시, SIZE는 그 부분의 전체 크기, NAME은 서명을 가리키는 이름입니다.

#### *PE 확장 서명*
PE 확장 서명의 형식은 예외없이 다음과 같이됩니다.

`$VAR:HASH:SIZE:NAME`

$VAR는 일치하는 PE 변수의 이름, HASH은 그 변수의 MD5 해시 크기는 변수의 전체 크기, NAME은 그 서명을 가리키는 이름입니다.

#### *복합 확장 서명*
복합 확장 서명은 다른 시그니처와는 조금 달리 무엇에 적합한 지 그것이 자신의 서명에 의해 결정 기준은 하나가 아닙니다. 적합 기준은 ";"은 적합 타입 적합 데이터는 ":"에 따릅니다. 따라서 형식은 $variable1 : 어떤 데이터; $variable2 : SOMEDATA; 어떤 데이터 수 있습니다.

`$variable1:SOMEDATA;$variable2:SOMEDATA;SignatureName`

#### *기타*
기타 서명 형식입니다.

`NAME:HEX:FROM:TO`

NAME은 그 서명을 가리키는 이름, HEX는 주어진 서명에 의해 적합을 보는 파일의 16 진수로 인코딩 된 세그먼트입니다. FROM과 TO는 옵션 매개 변수 데이터 소스 어디서부터 어디까지 확인 여부를 나타냅니다 (메일 기능은 지원하지 않습니다).

#### *정규 표현식*
PHP는 정규 표현식 판단 처리하는 형식이면 phpMussel과 서명에 의해 확실히 처리됩니다. 그러나 만약을 위해 서명을 기초로하는 정규 표현식을 새로 만들려면 세심한주의를 기울이십시오. 절대적인 자신이없는 상황에서는 생각도 못한 오류가 발생 될 수 있습니다. 정규식 구문이 준비되어 문맥을 완전히 이해하지 않는다면 phpMussel 코드를 보라. 패턴은 모든 (파일 이름 아카이브 메타 데이터의 MD5 패턴 제외) 16 진수로 인코딩되어야한다는 점에주의 (위의 패턴 구문도)입니다!

---


### 9. <a name="SECTION9"></a>적합성 문제

#### PHP와 PCRE
- phpMussel가 제대로 작동하기 위해서는 PHP와 PCRE가 필요합니다. 어느 한쪽이라도 부족하면 제대로 작동하지 않습니다. 시스템에 PHP와 PCRE 모두 설치되어 있는지 phpMussel 다운로드 전에 확인하십시오.

#### 안티 바이러스 소프트웨어와의 호환성

phpMussel은 대개 바이러스 검사 소프트웨어에 호환성이 있습니다. 그러나 과거에는 고객이 비 호환성보고가 있었던 것도 사실입니다. 다음 정보는 VirusTotal.com 의한 것이며, phpMussel 대해 안티 바이러스 프로그램에 의해보고 된 오류 검출을 기재하고 있습니다. phpMussel와 사용중인 안티 바이러스 소프트웨어의 호환성 문제가 명시된 지시 사항을 반드시 발생하거나 발생하지 않도록 보장하는 것은 아니지만, 만약 안티 바이러스 소프트웨어와 phpMussel 동작에 현저한 모순이 인정한다면, 노트 둘 중 하나를 해제하는 등의 대책을 검토해야 할 것이다.

다음의 정보는 2017년 12월 1일에 업데이트 된 글을 작성시 phpMussel 최근 마이너 버전 (v1.0.0-v1.1.0) 현황입니다.

*이 정보는 기본 패키지에만 적용됩니다. 결과는 설치된 서명 파일, 플러그인 및 기타 주변 구성 요소에 따라 다를 수 있습니다.*

| 스캐너 | 결과 |
|---|---|
| AVware | 리포트 "BPX.Shell.PHP" |
| Bkav | 리포트 "VEXA3F5.Webshell" |

---


### 10. <a name="SECTION10"></a>자주 묻는 질문 (FAQ)

- ["서명"이란 무엇입니까?](#WHAT_IS_A_SIGNATURE)
- ["거짓 양성"는 무엇입니까?](#WHAT_IS_A_FALSE_POSITIVE)
- [서명은 얼마나 자주 업데이트됩니까?](#SIGNATURE_UPDATE_FREQUENCY)
- [phpMussel을 사용하는 데 문제가 발생했지만 무엇을 해야할지 모르겠어요! 도와주세요!](#ENCOUNTERED_PROBLEM_WHAT_TO_DO)
- [5.4.0보다 오래된 PHP 버전에서 phpMussel을 사용하고 싶습니다; 도울 수 있니?](#MINIMUM_PHP_VERSION)
- [단일 phpMussel 설치를 사용하여 여러 도메인을 보호 할 수 있습니까?](#PROTECT_MULTIPLE_DOMAINS)
- [나는 이것을 설치하거나 그것이 내 웹 사이트상에서 동작하는 것을 보장하는 시간을 보내고, 하고 싶지 않아; 그것을 할 수 있습니까? 나는 당신을 고용 할 수 있습니까?](#PAY_YOU_TO_DO_IT)
- [당신 또는 이 프로젝트의 모든 개발자는 고용 가능합니까?](#HIRE_FOR_PRIVATE_WORK)
- [나는 전문가의 변경 및 사용자 맞춤형 등이 필요합니다; 도울 수 있니?](#SPECIALIST_MODIFICATIONS)
- [나는 개발자, 웹 사이트 디자이너, 또는 프로그래머입니다. 이 프로젝트 관련 작업을 할 수 있습니까?](#ACCEPT_OR_OFFER_WORK)
- [나는 프로젝트에 공헌하고 싶다; 이것은 수 있습니까?](#WANT_TO_CONTRIBUTE)
- ["ipaddr"의 권장 값입니다.](#RECOMMENDED_VALUES_FOR_IPADDR)
- [파일 검색시 특정 정보에 액세스하려면 어떻게해야합니까?](#SCAN_DEBUGGING)
- [Cron을 사용하여 자동으로 업데이트 할 수 있습니까?](#CRON_TO_UPDATE_AUTOMATICALLY)
- [phpMussel은 ANSI가 아닌 이름으로 파일을 스캔 수 있습니까?](#SCAN_NON_ANSI)
- [블랙리스트 – 화이트리스트 – 그레이리스트 – 그들은 무엇이며 어떻게 사용합니까?](#BLACK_WHITE_GREY)

#### <a name="WHAT_IS_A_SIGNATURE"></a>"서명"이란 무엇입니까?

phpMussel의 맥락에서, "서명" 이라 함은 우리가 찾고있는 것을 식별하는 데이터를 의미합니다 (바이러스, 트로이 목마, 등). 이 데이터는 일반적으로 파일의 체크섬 해시 또는 기타 유사한 식별 표시합니다. 일반적으로 라벨이나 추가 컨텍스트를 제공하기위한 기타 데이터가 포함되어 있습니다.

#### <a name="WHAT_IS_A_FALSE_POSITIVE"></a>"거짓 양성"는 무엇입니까?

일반화 된 상황에서 쉽게 설명 조건의 상태를 테스트 할 때 결과를 참조 할 목적으로 용어 "거짓 양성"의 (*또는 : 위양성의 오류, 허위 보도;* 영어 : *false positive*; *false positive error*; *false alarm*) 의미는 결과는 "양성"의 것, 그러나 결과는 실수 (즉, 진실의 조건은 "양성/진실"로 간주됩니다, 그러나 정말 "음성/거짓"입니다). "거짓 양성"는 "우는 늑대"와 유사하다고 생각할 수 있습니다 (그 상태는 군 근처에 늑대가 있는지 여부이다, 진실 조건은 "거짓/음성"입니다 무리의 가까이에 늑대가 없기 때문입니다하지만 조건은 "진실/양성"로보고됩니다 목자가 "늑대! 늑대!"를 외쳤다 때문입니다) 또는 의료 검사와 유사 환자가 잘못 진단 된 경우.

몇 가지 관련 용어는 "진실 양성", "진실 음성"와 "거짓 음성"입니다. 이러한 용어가 나타내는 의미 : "진실 양성"의 의미는 테스트 결과와 진실 조건이 진실입니다 (즉, "양성"입니다). "진실 음성"의 의미는 테스트 결과와 진실 조건이 거짓 (즉, "음성"입니다). "진실 양성"과 "진실 음성"는 "올바른 추론"로 간주됩니다. "거짓 양성"의 반대는 "거짓 음성"입니다. "거짓 음성"의 의미는 테스트 결과가 거짓입니다 (즉, "음성"입니다) 하지만 진실의 조건이 정말 진실입니다 (즉, "양성"입니다); 두 테스트 결과와 진실 인 조건이 "진실/양성" 해야한다 것입니다.

phpMussel의 맥락에서 이러한 용어는 phpMussel 서명과 그들이 차단 된 파일을 말합니다. phpMussel가 실수로 파일을 차단하면 (예를 들어, 부정확 한 서명, 구식의 서명 등에 의한), 우리는이 이벤트 "틀린 확실성"을 호출합니다. phpMussel이 파일을 차단할 수없는 경우 (예를 들어, 예상치 못한 위협 서명 누락 등으로 인한), 우리는이 이벤트 "부재 감지"를 호출합니다 ("위음성"의 아날로그입니다).

이것은 다음 표에 요약 할 수 있습니다.

&nbsp; | phpMussel은 파일을 차단 필요가 없습니다 | phpMussel은 파일을 차단해야합니다
---|---|---
phpMussel은 파일을 차단하지 않습니다 | 진정한 네거티브 (올바른 추론) | 부재 검출 (그것은 "위음성"와 같습니다)
phpMussel은 파일을 차단합니다 | __위양성__ | 진정한 양성 (올바른 추론)

#### <a name="SIGNATURE_UPDATE_FREQUENCY"></a>서명은 얼마나 자주 업데이트됩니까?

업 데이트 빈도는 서명 파일에 따라 다릅니다. phpMussel 서명 파일의 모든 메인테이너가 자주 업 데이트를 시도하지만, 우리의 여러분에게는 그 밖에도 다양한 노력이있어, 우리는 프로젝트 외부에서 생활하고 있으며, 아무도 재정적으로 보상되지 않는, 따라서 정확한 업 데이트 일정은 보장되지 않습니다. 일반적으로 충분한 시간이 있으면 서명이 업 데이트됩니다. 메인테이너는 필요성과 범위 사이의 변화의 빈도에 따라 우선 순위를 내려고한다. 당신이 뭔가를 제공 할 수 있다면, 원조는 항상 높게 평가됩니다.

#### <a name="ENCOUNTERED_PROBLEM_WHAT_TO_DO"></a>phpMussel을 사용하는 데 문제가 발생했지만 무엇을 해야할지 모르겠어요! 도와주세요!

- 당신은 최신 소프트웨어 버전을 사용하고 있습니까? 당신은 최신 서명 파일 버전을 사용하고 있습니까? 그렇지 않은 경우, 먼저 업 데이트하십시오. 문제가 해결되지 여부를 확인하십시오. 그것이 계속되면 읽어보십시오.
- 당신은 문서를 확인 했습니까? 만약 그렇지 않으면, 그렇지하십시오. 문서를 사용하여 문제를 해결할 수없는 경우, 계속 읽어보십시오.
- **[이슈 페이지를](https://github.com/phpMussel/phpMussel/issues)** 확인 했습니까? 문제가 이전에 언급되어 있는지 확인하십시오. 제안, 아이디어, 솔루션이 제공되었는지 여부를 확인하십시오.
- 문제가 해결되지 않으면 알려 주시기 바랍니다. 이슈 페이지에서 토론을 창조한다.

#### <a name="MINIMUM_PHP_VERSION"></a>5.4.0보다 오래된 PHP 버전에서 phpMussel을 사용하고 싶습니다; 도울 수 있니?

아니오. PHP 5.4.0은 2014 년 공식 EoL에 ("End of Life" / 삶의 끝) 도달했습니다. 2015 년에 연장 된 보안 지원이 종료되었습니다. 현재는 2017이며 PHP 7.1.0을 이미 사용할 수 있습니다. 현재, PHP 5.4.0 및 모든 더 최신 PHP 버전 phpMussel를 사용하기위한 지원이 제공되고 있습니다. 더 오래된 PHP 버전에 대한 지원은 제공하지 않습니다.

*참조 : [호환성 차트](https://maikuolan.github.io/Compatibility-Charts/).*

#### <a name="PROTECT_MULTIPLE_DOMAINS"></a>단일 phpMussel 설치를 사용하여 여러 도메인을 보호 할 수 있습니까?

예. phpMussel 설치는 특정 도메인에 국한되지 않습니다, 따라서 여러 도메인을 보호하기 위해 사용할 수 있습니다. 일반적으로, 하나의 도메인 만 보호 설치 우리는 "단일 도메인 설치"이 라고 부릅니다에서 여러 도메인을 보호하는 설치 우리는 "멀티 도메인 설치"이 라고 있습니다. 다중 도메인 설치를 사용하는 경우 다른 도메인에 다른 서명 파일 세트를 사용할 필요가 있거나 다른 도메인에 phpMussel을 다른 설정해야합니다 이것을 할 수 있습니다. 설정 파일을로드 한 후 (`config.ini`), phpMussel 요청 된 도메인의 "구성 재정 파일"의 존재를 확인합니다 (`xn--hq1bngz0pl7nd2aqft27a.tld.config.ini`), 그리고 발견 된 경우, 구성 재정 파일에 의해 정의 된 구성 값은 설정 파일에 의해 정의 된 구성 값이 아니라 실행 인스턴스에 사용됩니다. 구성 재정 파일은 설정 파일과 동일합니다. 귀하의 재량에 따라 phpMussel에서 사용할 수있는 모든 구성 지시문 전체 또는 필요한 하위 섹션을 포함 할 수 있습니다. 구성 재정 파일은 그들이 의도하는 도메인에 따라 지정됩니다 (그래서 예를 들면, 도메인 `http://www.some-domain.tld/` 컨피규레이션 재정 파일이 필요한 경우, 구성 재정 파일의 이름은 `some-domain.tld.config.ini` 할 필요가 있습니다. 일반 구성 파일과 동일한 위치에 보관해야합니다). 도메인 이름은 `HTTP_HOST` 에서옵니다. "www"는 무시됩니다.

#### <a name="PAY_YOU_TO_DO_IT"></a>나는 이것을 설치하거나 그것이 내 웹 사이트상에서 동작하는 것을 보장하는 시간을 보내고, 하고 싶지 않아; 그것을 할 수 있습니까? 나는 당신을 고용 할 수 있습니까?

아마. 이는 사례별로 검토되고 있습니다. 당신의 요구로 제공할 수 있는 것을 가르쳐주세요. 우리가 도울 수 있는지를 가르쳐주고 있습니다.

#### <a name="HIRE_FOR_PRIVATE_WORK"></a>당신 또는 이 프로젝트의 모든 개발자는 고용 가능합니까?

*위를 참조하십시오.*

#### <a name="SPECIALIST_MODIFICATIONS"></a>나는 전문가의 변경 및 사용자 맞춤형 등이 필요합니다; 도울 수 있니?

*위를 참조하십시오.*

#### <a name="ACCEPT_OR_OFFER_WORK"></a>나는 개발자, 웹 사이트 디자이너, 또는 프로그래머입니다. 이 프로젝트 관련 작업을 할 수 있습니까?

예. 우리의 라이센스는이를 금지하지 않습니다.

#### <a name="WANT_TO_CONTRIBUTE"></a>나는 프로젝트에 공헌하고 싶다; 이것은 수 있습니까?

예. 프로젝트에 기여 환영합니다. 자세한 내용은 "CONTRIBUTING.md"를 참조하십시오.

#### <a name="RECOMMENDED_VALUES_FOR_IPADDR"></a>"ipaddr"의 권장 값입니다.

값 | 사용
---|---
`HTTP_INCAP_CLIENT_IP` | Incapsula 리버스 프록시.
`HTTP_CF_CONNECTING_IP` | Cloudflare 리버스 프록시.
`CF-Connecting-IP` | Cloudflare 리버스 프록시 (대체; 위가 잘되지 않는 경우).
`HTTP_X_FORWARDED_FOR` | Cloudbric 리버스 프록시.
`X-Forwarded-For` | [Squid 리버스 프록시](http://www.squid-cache.org/Doc/config/forwarded_for/).
*서버 구성에 의해 정의됩니다.* | [Nginx 리버스 프록시](https://www.nginx.com/resources/admin-guide/reverse-proxy/).
`REMOTE_ADDR` | 리버스 프록시는 없습니다 (기본값).

#### <a name="SCAN_DEBUGGING"></a>파일 검색시 특정 정보에 액세스하려면 어떻게해야합니까?

이것은 phpMussel 그들을 검사하도록 지시하기 전 에이 목적을 위해 사용하는 배열을 할당하여 수행할 수 있습니다.

다음 예제에서는이 목적을 위해 `$Foo` 가 할당되어 있습니다. `/file/path/...` 를 스캔 한 후 `/file/path/...` 파일에 대한 정보는 `$Foo` 에 있습니다.

```PHP
<?php
require 'phpmussel/loader.php';

$phpMussel['Set-Scan-Debug-Array']($Foo);

$Results = $phpMussel['Scan']('/file/path/...');

var_dump($Foo);
```

배열은 다차원입니다. 요소는 검사되는 각 파일을 나타냅니다. 하위 요소는 이러한 파일의 내용을 나타냅니다. 하위 요소는 다음과 같습니다.

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

*† - 캐시 된 결과는 제공되지 않습니다 (새로운 검색 결과 만 제공됩니다).*

*‡ - PE 파일을 스캔하는 경우에만 제공됩니다.*

필요한 경우, 이 배열은 다음을 사용하여 삭제합니다.

```PHP
$phpMussel['Destroy-Scan-Debug-Array']($Foo);
```

#### <a name="CRON_TO_UPDATE_AUTOMATICALLY"></a>Cron을 사용하여 자동으로 업데이트 할 수 있습니까?

예. 외부 스크립트를 통해 업데이트 페이지와 상호 작용하기위한 프런트 엔드에 API가 내장되어 있습니다. 별도의 스크립트 인 "[Cronable](https://github.com/Maikuolan/Cronable)"을 사용할 수 있습니다. Cron 관리자 또는 Cron 스케줄러가이 사용할 수 있습니다, 패키지 및 기타 지원되는 패키지를 자동으로 업데이트하는 데 사용할 수 있습니다 (이 스크립트는 자체 문서를 제공합니다.).

#### <a name="SCAN_NON_ANSI"></a>phpMussel은 ANSI가 아닌 이름으로 파일을 스캔 수 있습니까?

스캔하려는 디렉토리가 있다고 가정합니다. 이 디렉토리에는 비 ANSI 이름을 가진 일부 파일이 있습니다.
- `Пример.txt`
- `一个例子.txt`
- `例です.txt`

CLI 모드 나 phpMussel API를 사용하여 스캔한다고 가정 해보십시오.

일부 시스템에서 PHP를 사용할 때, phpMussel은 디렉토리를 스캔 할 때이 파일을 보거나 스캔 할 수 없습니다. 빈 디렉토리를 검색 할 때도 동일한 결과가 나타납니다 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 시작했다.
 Sun, 01 Apr 2018 22:27:41 +0800 완료.
```

또한, PHP < 7.1.0을 사용할 때 파일을 개별적으로 스캔하면 다음과 같은 결과가 생성됩니다 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 시작했다.
 > 현재 분석 중 : 'X:/directory/Пример.txt' (FN: b831eb8f):
 -> 유효하지 않은 파일!
 Sun, 01 Apr 2018 22:27:41 +0800 완료.
```

또는 다음과 같습니다 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 시작했다.
 > X:/directory/??????.txt는 파일 또는 디렉토리가 아닙니다.
 Sun, 01 Apr 2018 22:27:41 +0800 완료.
```

이는 PHP 7.1.0 이전에 ANSI가 아닌 파일 이름이 처리되는 방식 때문입니다. 이 문제가 발생하면 PHP 설치를 7.1.0 이상으로 업데이트하십시오. PHP >= 7.1.0에서는, ANSI가 아닌 파일 이름이 더 잘 처리되며 phpMussel은 파일을 제대로 검색 할 수 있어야합니다.

비교를 위해, PHP >= 7.1.0를 사용하여 디렉토리를 스캔하려고 할 때의 결과 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 시작했다.
 -> 현재 분석 중 : '\Пример.txt' (FN: b2ce2d31; FD: 27cbe813):
 --> 문제는 발견되지 않았습니다.
 -> 현재 분석 중 : '\一个例子.txt' (FN: 50debed5; FD: 27cbe813):
 --> 문제는 발견되지 않았습니다.
 -> 현재 분석 중 : '\例です.txt' (FN: ee20a2ae; FD: 27cbe813):
 --> 문제는 발견되지 않았습니다.
 Sun, 01 Apr 2018 22:27:41 +0800 완료.
```

개별적으로 파일을 검사하려고 시도하면 다음과 같습니다 :

```
 Sun, 01 Apr 2018 22:27:41 +0800 시작했다.
 > 현재 분석 중 : 'X:/directory/Пример.txt' (FN: b831eb8f; FD: 27cbe813):
 -> 문제는 발견되지 않았습니다.
 Sun, 01 Apr 2018 22:27:41 +0800 완료.
```

#### <a name="BLACK_WHITE_GREY"></a>블랙리스트 – 화이트리스트 – 그레이리스트 – 그들은 무엇이며 어떻게 사용합니까?

용어는 다른 맥락에서 다른 의미를 전달합니다. phpMussel에는, 이러한 용어가 사용되는 세 가지 상황이 있습니다 : 파일 크기 응답, 파일 형식 응답, 및 서명 그레이리스트.

최소한의 처리 비용으로 원하는 결과를 얻으려면, phpMussel이 파일을 실제로 스캔하기 전에 확인할 수있는 간단한 방법이 몇 가지 있습니다 (예를 들어, 파일의 크기, 이름, 및 확장자). 예를 들어; 파일이 너무 큰 경우 또는 확장자가 우리의 웹 사이트에 허용하지 않으려는 파일 유형을 나타내는 경우, 즉시 파일에 플래그를 세울 수 있으며, 스캔 할 필요가 없습니다.

파일 크기 응답 파일이 지정된 제한을 초과하면 phpMussel가 응답하는 방법입니다. 실제 목록은 포함되지 않지만, 파일은 그 크기에 따라 효과적으로 블랙리스트에있는 화이트리스트에있는 또는 그레이리스트에 있다고 생각합니다. 한계와 원하는 응답을 각각 지정하는 두 개의 별개의 구성 지시문이 있습니다.

파일 유형의 응답은 phpMussel 파일 확장명에 응답하는 방법입니다. 어떤 확장자가 어떤 목록에 있어야하는지 명시 적으로 지정하는 세 가지 별개의 구성 지시문이 있습니다. 확장자가 지정된 확장자와 각각 일치하면 파일이 효과적으로 나열된 것으로 간주 될 수 있습니다.

이 두 컨텍스트는 화이트리스트에있는 스캔 또는 플래그 지정해서는 없다는 것을 의미합니다, 블랙리스트에있는 플래그 지정해야합니다 것을 의미합니다 (따라서 스캔해야 아니다) 그리고, 그레이리스트에있는 플래그를 세울 필요가 있는지 여부를 판단하기 위해 추가 분석이 필요합니다 것을 의미합니다 (따라서 스캔해야합니다).

서명 그레이리스트는 본질적으로 무시해서는 시그니처 목록입니다 (이 내용은 위의 문서에서 쉽게 설명하고 있습니다). 서명은 회색 목록에 서명이 트리거되면 phpMussel 내가 일을 계속 회색 목록에 서명 관하여 특별한 조치를 취하지 않습니다. 무언의 동작은 트리거 된 서명의 정상적인 작동이기 때문에 시그니처 블랙리스트가 없습니다. 이러한 맥락에서 필요하지 않기 때문에 서명 화이트리스트가 없습니다.

서명 파일 전체를 비활성화하거나 제거하지 않고 특정 서명에 의해 발생한 문제를 해결해야하는 경우 서명 그레이리스트가 도움이됩니다.

---


### 11. <a name="SECTION11"></a>법률 정보

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


최종 업데이트 : 2018년 5월 25일.
