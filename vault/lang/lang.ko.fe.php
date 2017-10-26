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
 * This file: Korean language data for the front-end (last modified: 2017.10.26).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bNav_home_logout'] = '<a href="?">홈</a> | <a href="?phpmussel-page=logout">로그 아웃</a>';
$phpMussel['lang']['bNav_logout'] = '<a href="?phpmussel-page=logout">로그 아웃</a>';
$phpMussel['lang']['config_attack_specific_archive_file_extensions'] = '인식 가능한 아카이브 파일 확장입니다 (CSV 형식; 문제가있을 경우에만 추가 또는 제거해야합니다. 실수로 제거하면 오진의 원인이 될 수 있습니다. 반대로 실수로 추가하면 어택 자 스페시 픽 검출에서 추가 된 화이트리스트 화되어 버립니다. 충분히주의 위 변경하십시오. 또한 컨텐트 수준에서 아카이브를 분석 할 수 있는지 여부에는 영향을주지 않습니다). 기본적으로 가장 일반적 형식을 나열하고 있지만 의도적으로 포괄적으로하지 않습니다.';
$phpMussel['lang']['config_attack_specific_block_control_characters'] = '제어 문자를 포함한 파일을 차단 여부 (줄 바꿈을 제외한)? 에 관한 것입니다 (<code>[\x00-\x08\x0b\x0c\x0e\x1f\x7f]</code>). 만약 텍스트를 업로드하는 경우,이 옵션을 사용하여 추가 보호를 강화할 수 있습니다. 텍스트 이외도 업로드 할 경우, 사용하면 오진의 원인이 될 수 있습니다. <code>false</code> = 차단하지 (Default / 기본 설정); <code>true</code> = 차단합니다.';
$phpMussel['lang']['config_attack_specific_chameleon_from_exe'] = '실행 파일없이 실행 파일의 아카이브도 인식 할 수없는 파일의 실행 헤더 및 악성 헤더의 실행 파일을 찾습니다. <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_chameleon_from_php'] = '파일도 아니고 PHP 아카이브도 인식 할 수없는 파일에서 PHP 헤더를 찾습니다. <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_chameleon_to_archive'] = '헤더가 잘못 보관을 찾습니다 (BZ, GZ, RAR, ZIP, RAR, GZ 지원). <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_chameleon_to_doc'] = '헤더가 잘못 오피스 문서를 찾습니다 (DOC, DOT, PPS, PPT, XLA XLS, WIZ 지원). <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_chameleon_to_img'] = '헤더가 잘못된 이미지 파일을 찾습니다 (BMP, DIB, PNG, GIF, JPEG, JPG, XCF, PSD, PDD, WEBP 지원). <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_chameleon_to_pdf'] = '헤더가 잘못 PDF 파일을 찾습니다. <code>false</code> = 해제; <code>true</code> = 온.';
$phpMussel['lang']['config_attack_specific_corrupted_exe'] = '손상된 파일과 오류 분석. <code>false</code> = 무시; <code>true</code> = 차단 (Default / 기본 설정). 손상의 가능성이있는 PE 파일을 차단 검출 여부? 관한 것입니다. PE 파일의 일부가 손상되어 제대로 분석 할 수없는 것은 드물지 않고, 바이러스 감염을 보는 바로미터가됩니다. PE 파일의 바이러스를 감지하는 안티 바이러스 프로그램은 PE 파일 분석을 실시 합니다만, 바이러스를 만드는 사람이 바이러스가 검출되지 않도록 그것을 피하려고 할 것이기 때문입니다.';
$phpMussel['lang']['config_attack_specific_decode_threshold'] = '디코드 명령이 감지 될 원시 데이터의 길이 제한 (스캐닝 중에 눈에 띄는 문제가있는 경우에는 필요에 따라 설정). 기본값 = 512KB. 제로 또는 값 없음 (null)은 임계 값을 비활성화합니다 (파일 크기의 제한을 제거합니다).';
$phpMussel['lang']['config_attack_specific_scannable_threshold'] = 'phpMussel이 읽고 스캔 할 수있는 원시 데이터의 길이에 대한 임계 값 (스캐닝 중에 눈에 띄는 문제가있는 경우에는 필요에 따라 설정). 기본값 = 32MB. 제로 또는 값 없음 (null)은 임계 값을 비활성화합니다. 값은 서버 나 웹 사이트에 업로드되는 파일의 평균 파일 크기보다 크고 filesize_limit 지시어보다 작게 설정해야합니다. 또한 "php.ini" 설정에 따라 PHP에 할당 된 메모리의 대략 5 분의 1을 초과해서는 없습니다. 이 지시문은 phpMussel가 메모리를 너무 많이 사용하지 않도록하기위한 것입니다. (일정 크기 이상의 파일은 스캔하지 못할 수도 있습니다).';
$phpMussel['lang']['config_compatibility_ignore_upload_errors'] = '시스템에서 phpMussel의 기능에 수정이 필요한 경우가 아니면이 지시문은 일반적으로 사용할 수 없습니다. 비활성화하면 <code>$_FILES</code> array()요소를 감지했을 때, 그 요소가 나타내는 파일의 스캔이 시작됩니다, 요소가 비어 있거나없는 경우 phpMussel는 오류 메시지를 반환합니다. 이것은 본래 phpMussel가 있어야 할 모습입니다. 그러나 CMS에서는 $_FILES 하늘 요소는 일반적으로 발생하는 것이며, 정상적인 phpMussel의 행동이 정상적인 CMS의 거동을 저해 할 우려가 있습니다. 이러한 경우에는 본 옵션을 사용하여 phpMussel 빈 요소를 검사하고 오류 메시지를 반환을 피하고 요청한 페이지로 원활하게 진행할 수 있도록합니다. <code>false</code> = OFF (해제입니다); <code>true</code> = ON (온입니다).';
$phpMussel['lang']['config_compatibility_only_allow_images'] = '시스템 또는 CMS에 이미지 파일의 업로드 만 허용한다면이 지시어가 동작해야하며, 그렇지 않으면 무효로합니다. 사용하면 이미지와 알 수없는 파일은 검사하지 않고 차단하기 때문에 프로세스 시간 단축 및 메모리 절약을 기대할 수 있습니다. <code>false</code> = OFF (해제입니다); <code>true</code> = ON (온입니다).';
$phpMussel['lang']['config_files_block_encrypted_archives'] = '암호화 된 아카이브를 감지하고 차단 여부? phpMussel은 암호화 된 아카이브를 검색 할 수 없기 때문에 아카이브의 암호화를 통해 phpMussel 안티 바이러스 스캐너 등을 かいくぐろ하려는 공격자가 있을지도 모릅니다. 암호화 된 아카이브를 차단함으로써 이러한 위험을 방지 할 수 있습니다. <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_files_check_archives'] = '아카이브의 컨텐츠에 대해 체크를 시도 여부에 대해서입니다. <code>false</code> = 체크하지 않는다; <code>true</code> = 확인 (Default / 기본 설정). 현재 지원하고있는 것은 BZ, GZ, LZF, ZIP 형식입니다 (RAR, CAB, 7z 등은 제외). 본 기능은 만능이 아니므로 활성화하는 것이 좋습니다 있지만 반드시 모두를 검출하는 것을 보증하는 것은 아닙니다. 또한 현재 체크 아카이브는 ZIP 대해 재귀 않는다는 점에 유의하십시오.';
$phpMussel['lang']['config_files_filesize_archives'] = '파일 크기 블랙리스트/화이트리스트 화를 아카이브의 컨텐츠에 반입 여부? <code>false</code> = 아니오 (단지 그레이리스트 모두); <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_files_filesize_limit'] = '파일 크기 제한의 단위는 KB입니다. 65536 = 64MB (Default / 기본 설정); 0 = 제한하지 않습니다 (제한없이 항상 그레이리스트 화) 양수이면 무엇이든 상관 없습니다. PHP 설정에서 메모리에 제한이 있고, 업로드 파일 크기 제한이 설정되어있는 경우에 효과적입니다.';
$phpMussel['lang']['config_files_filesize_response'] = '최대 크기보다 큰 파일을 처리하는 방법에 관한 것입니다. <code>false</code> = Whitelist/화이트리스트; <code>true</code> = Blacklist/블랙리스트 (Default / 기본 설정).';
$phpMussel['lang']['config_files_filetype_archives'] = '파일 타입 블랙리스트/화이트리스트 화를 아카이브의 컨텐츠에 반입 여부? <code>false</code> = 아니오 (단지 그레이리스트 모두) (Default / 기본 설정); <code>true</code> = 예.';
$phpMussel['lang']['config_files_filetype_blacklist'] = '파일 유형 블랙리스트 :';
$phpMussel['lang']['config_files_filetype_greylist'] = '파일 유형 그레이리스트 :';
$phpMussel['lang']['config_files_filetype_whitelist'] = '시스템이 특정 유형의 파일 만 업로드를 허용하거나 거절하는 경우 파일 유형을 적절히 화이트리스트, 블랙리스트, 그레이리스트로 분류 해두면 파일 유형에 튀겨 진 파일은 스캔을 건너 뛸 수 때문에 속도로 연결됩니다. 형식은 CSV (쉼표로 구분)입니다. 목록에 의하지 않고 모두를 검사 할 경우 변수는 빈 상태로 유지하고 화이트리스트 / 블랙리스트 / 그레이리스트를 해제합니다. 프로세스의 논리적 순서 : 파일 형식이 화이트리스트에 포함되어 있으면, 스캔하지 않고 블록하지 않고 블랙리스트 및 그레이리스트에 체크를하지 않습니다. 파일 형식이 블랙리스트에 있으면 스캔하지 않고 즉시 차단하고 그레이리스트에 체크를하지 않습니다. 회색 목록이 비어 또는 그레이리스트가 하늘이 아닌 한편 그 파일 타입이 있으면 정상적으로 스캔 차단 여부를 판단합니다. 그레이리스트가 하늘이 아닌 한편 그 파일 유형이 포함되어 있지 않으면 블랙리스트와 같은 취급을 할 수 있고 스캔없이 차단합니다. 파일 유형 화이트리스트 :';
$phpMussel['lang']['config_files_max_recursion'] = '아카이브에 대한 최대 재귀 깊이입니다. 기본 설정 = 10.';
$phpMussel['lang']['config_files_max_uploads'] = '한 번에 스캔 할 수있는 업로드 파일 수 제한으로이를 초과하면 스캔을 중단하고 사용자에게 그 사실을 알리고 논리적 공격으로부터 보호 역할을합니다. 시스템과 CMS가 DDoS 공격을 만나 phpMussel가 오버로드하여 PHP 프로세스에 지장을 초래하는 일이 없도록하기 위해서입니다. 권장 수는 10이지만, 하드웨어의 속도에 따라 더 이상 / 이하이 좋은 것도있을 것입니다. 이 숫자는 아카이브의 내용을 포함하지 않는 것을 기억하십시오.';
$phpMussel['lang']['config_general_cleanup'] = '처음 업로드 후 변수 및 캐시 설정을 클리어 여부에 대한 스크립트입니다. <code>false</code> (가짜) = 아니오;<code>true</code> (진정한) = 예 (Default / 기본 설정). 처음 업로드 스캐닝 이외로 사용할 수 없으면,<code>true</code> (참)로 메모리 사용량을 최소화합니다. 사용하는 경우,<code>false</code> (가짜)으로 메모리에 불필요한 중복 데이터를 다시로드하는 것을 방지합니다. 일반적으로<code>true</code> (진정한). 로 설정하고 있지만, 처음 업로드 스캐닝에 대해서만 사용할 수 없음을 기억하십시오. CLI 모드에서 영향을주지 않습니다.';
$phpMussel['lang']['config_general_default_algo'] = '향후 모든 암호와 세션에 사용할 알고리즘을 정의합니다. 옵션 : PASSWORD_DEFAULT (default / 기본 설정), PASSWORD_BCRYPT, PASSWORD_ARGON2I (PHP >= 7.2.0 가 필요합니다).';
$phpMussel['lang']['config_general_delete_on_sight'] = '이 지시문을 사용하면 감지 기준 (서명이든 뭐든)에 있던 업로드 파일은 즉시 삭제됩니다. 클린 판단 된 파일은 그대로입니다. 아카이브의 경우, 문제의 파일이 일부라도 아카이브 모든이 삭제 대상이됩니다. 업로드 파일 검사에서는 본 지시어를 활성화 할 필요는 없습니다. 왜냐하면 PHP는 스크립트 실행 후 자동으로 캐시의 내용을 파기하기 때문입니다. 즉, 파일이 이동되거나 복사되거나 삭제되지 않는 한, PHP는 서버에 업로드 한 파일을 남겨 두는 것은 보통 없습니다. 이 지시어는 보안에 공을들이는 목적으로 설치되어 있습니다. PHP는 드물게 예상치 못한 행동을 할 수 있기 때문입니다. <code>false</code> = 스캔 후 파일은 그대로 (기본 설정). <code>true</code> = 스캔 후 깨끗해야 즉시 삭제합니다.';
$phpMussel['lang']['config_general_disable_cli'] = 'CLI 모드를 해제 하는가? CLI 모드 (시에루아이 모드)는 기본적으로 활성화되어 있지만, 테스트 도구 (PHPUnit 등) 및 CLI 기반의 응용 프로그램과 간섭하는 가능성이 없다고는 단언 할 수 없습니다. CLI 모드를 해제 할 필요가 없으면이 데레쿠티부 무시 받고 괜찮습니다. <code>false</code> = CLI 모드를 활성화합니다 (Default / 기본 설정); <code>true</code> = CLI 모드를 해제합니다.';
$phpMussel['lang']['config_general_disable_frontend'] = '프론트 엔드에 대한 액세스를 비활성화하거나? 프론트 엔드에 대한 액세스는 phpMussel을 더 쉽게 관리 할 수 있습니다. 상기 그것은 또한 잠재적 인 보안 위험이 될 수 있습니다. 백엔드를 통해 관리하는 것이 좋습니다,하지만 이것이 불가능한 경우 프론트 엔드에 대한 액세스를 제공. 당신이 그것을 필요로하지 않는 한 그것을 해제합니다. <code>false</code> = 프론트 엔드에 대한 액세스를 활성화합니다; <code>true</code> = 프론트 엔드에 대한 액세스를 비활성화합니다 (Default / 기본 설정).';
$phpMussel['lang']['config_general_disable_webfonts'] = '웹 글꼴을 사용하지 않도록 설정 하시겠습니까? True = 예; False = 아니오 (Default / 기본 설정).';
$phpMussel['lang']['config_general_enable_plugins'] = '플러그인 지원을 활성화 하시겠습니까? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_general_forbid_on_block'] = '업로드 파일이 차단 된 메시지와 함께 phpMussel에서 403 헤더를 보내야하거나 일반 200 좋은지에 대해. <code>false</code> = 아니오 (200) Default / 기본 설정; <code>true</code> = 예 (403).';
$phpMussel['lang']['config_general_FrontEndLog'] = '프론트 엔드 로그인 시도를 기록하는 파일. 파일 이름 지정하거나, 해제하려면 비워하십시오.';
$phpMussel['lang']['config_general_honeypot_mode'] = '허니팟 모드가 활성화되어 있으면 phpMussel 업로드되어 온 모든 파일을 예외없이 검역합니다. 서명에 부합하는지 여부는 문제가되지 않습니다. 스캐닝 및 분석도 이루어지지 않습니다. phpMussel를 바이러스/악성 코드 리서치에 사용할 생각하는 사용자에게 유익 할 것입니다. 그러나 업로드 파일 스캐닝이라는 점에서는 그다지 권장되지 않으며, 허니 모드를 본래의 목적 이외에 사용하는 것이 좋습니다 수 없습니다. 그러나 업로드 파일 스캐닝이라는 점에서는 그다지 권장되지 않으며, 허니 모드를 본래의 목적 이외에 사용하는 것이 좋습니다 수 없습니다. 기본 설정은 무효입니다. <code>false</code> = Disabled/장애인 (Default / 기본 설정); <code>true</code> = Enabled/유효.';
$phpMussel['lang']['config_general_ipaddr'] = '연결 요청의 IP 주소를 어디에서 찾을 것인가에 대해 (Cloudflare 같은 서비스에 대해 유효). Default (기본 설정) = REMOTE_ADDR. 주의 : 당신이 무엇을하고 있는지 모르는 한이를 변경하지 마십시오.';
$phpMussel['lang']['config_general_lang'] = 'phpMussel의 기본 언어를 설정합니다.';
$phpMussel['lang']['config_general_maintenance_mode'] = '유지 관리 모드를 사용 하시겠습니까? True = 예; False = 아니오 (Default / 기본 설정). 프런트 엔드 이외의 모든 것을 비활성화합니다. CMS, 프레임 워크 등을 업데이트 할 때 유용합니다.';
$phpMussel['lang']['config_general_max_login_attempts'] = '로그인 시도 횟수 (프론트 엔드). Default / 기본 설정 = 5.';
$phpMussel['lang']['config_general_numbers'] = '어떻게 숫자를 표시하는 것을 선호합니까? 가장 정확한 것으로 보이는 예제를 선택하십시오.';
$phpMussel['lang']['config_general_quarantine_key'] = 'phpMussel은 필요하다면, phpMussel의 보루 토에서 독립적으로 플래그 첨부 파일의 업로드를 검역 할 수 있습니다. 일반적인 phpMussel 사용자는 웹 사이트 및 호스팅 환경 보호가 있으면 충분하다고 생각하고 플래그가있는 같은 것이 추가 분석을 가하려까지 요청이없는 것이므로 무효로 될 수 있습니다. 그렇지만 상세하게 분석하여 악성 코드에 대비하려는 사용자는 사용하면 좋습니다. 플래그 첨부 파일 업로드 격리 가양 디버깅에 도움이 될 수 있습니다. 격리 기능을 해제하려면<code>quarantine_key</code> 지시문을 비워 두거나 비어 있지 않은 경우 지시문의 내용을 삭제하십시오. 활성화하려면 데이레쿠티부에 어떤 값을 넣어주세요. <code>quarantine_key</code> 격리 기능의 중요한 보안 요소이며, 검역 기능에 저장된 데이터의 집행을 각종 공격으로부터 지키고 있습니다. <code>quarantine_key</code>는 암호처럼 생각하세요. 긴 것이 더 안전 할 수 있습니다. 가장 효과적인 사용법은<code>delete_on_sight</code>과 함께합니다.';
$phpMussel['lang']['config_general_quarantine_max_filesize'] = '격리 된 파일 크기 제한. 이 값보다 큰 파일은 격리되지 않습니다. 쿠오란팅의 용량을 초과 비정상적으로 큰 파일 크기 공격에서 메모리가 낭비되는 것을 방지하는 의미에서 중요합니다. 기본값은 2MB입니다.';
$phpMussel['lang']['config_general_quarantine_max_usage'] = '검역을 위해 사용할 최대 메모리 량. 전체 메모리 양이 사용되면이 범위에 맞게 오래된 파일이 삭제 대상이됩니다. 쿠오란팅의 용량을 초과 비정상적으로 큰 파일 크기 공격에서 메모리가 낭비되는 것을 방지하는 의미에서 중요합니다. 기본 설정은 64MB입니다.';
$phpMussel['lang']['config_general_scan_cache_expiry'] = 'phpMussel는 스캐닝 결과를 얼마 동안 캐시해야합니까? 초이며, 기본값은 21,600 초 (6 시간)로되어 있습니다. 0으로 설정하면 캐시 비활성화됩니다.';
$phpMussel['lang']['config_general_scan_kills'] = '차단되거나 삭제 된 업로드의 모든 것을 기록하는 파일의 파일 이름. 파일 이름 지정하거나, 해제하려면 비워하십시오.';
$phpMussel['lang']['config_general_scan_log'] = '전체 스캔 결과를 기록하는 파일의 파일 이름. 파일 이름 지정하거나, 해제하려면 비워하십시오.';
$phpMussel['lang']['config_general_scan_log_serialized'] = '전체 스캔 결과를 기록하는 파일의 파일 이름 (serialization 형식을 이용). 파일 이름 지정하거나, 해제하려면 비워하십시오.';
$phpMussel['lang']['config_general_statistics'] = 'phpMussel 사용 통계를 추적합니까? True = 예; False = 아니오 (Default / 기본 설정).';
$phpMussel['lang']['config_general_timeFormat'] = 'phpMussel에서 사용되는 날짜 형식. 추가 옵션이 요청에 따라 추가 될 수 있습니다.';
$phpMussel['lang']['config_general_timeOffset'] = '시간대 오프셋 (분).';
$phpMussel['lang']['config_general_timezone'] = '귀하의 시간대.';
$phpMussel['lang']['config_general_truncate'] = '로그 파일이 특정 크기에 도달하면 잘 있습니까? 값은 로그 파일이 잘 리기 전에 커질 가능성이있는 B/KB/MB/GB/TB 단위의 최대 크기입니다. 기본값 "0KB"은 절단을 해제합니다 (로그 파일은 무한정 확장 할 수 있습니다). 참고 : 개별 로그 파일에 적용됩니다! 로그 파일의 크기는 일괄 적으로 고려되지 않습니다.';
$phpMussel['lang']['config_heuristic_threshold'] = 'phpMussel이 파일은 의심 위험성이 높다고 판단하는 서명이 있습니다. 임계 값은 업로드 된 파일의 위험의 최대 값이며이를 초과하면 악성 코드로 판단됩니다. 여기에서 위험의 정의는 의심과 특정되었지만 수입니다. 기본적으로 3으로 설정되어 있습니다. 이보다 낮은 오진의 가능성이 증가하고, 너무 크면 오류 검출은 감소하지만 위험성이있는 파일이 검색되지 않을 수 증가하게됩니다. 특히 문제가 없으면 기본 설정을 유지하는 것이 좋습니다.';
$phpMussel['lang']['config_signatures_Active'] = '쉼표로 구분 된 활성 시그니처 파일의 목록입니다.';
$phpMussel['lang']['config_signatures_detect_adware'] = 'phpMussel 애드웨어 탐지를 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_deface'] = 'phpMussel를 위조 및 디훼사 탐지를 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_encryption'] = 'phpMussel이 암호화 된 파일을 탐지하고 차단해야합니까? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_joke_hoax'] = 'phpMussel 장난 / 위조 및 악성 코드 / 바이러스 탐지를 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_packer_packed'] = 'phpMussel는 패커와 팩 데이터 검출을 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_pua_pup'] = 'phpMussel는 PUAs/PUPs 탐지를 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_detect_shell'] = 'phpMussel는 shell 스크립트 탐지를 위해 서명을 분석해야하는지 여부? <code>false</code> = 아니오; <code>true</code> = 예 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_fail_extensions_silently'] = '확장자가없는 경우 phpMussel이 그것을보고해야하는지 여부? <code>fail_extensions_silently</code>이 잘못된 경우 확장자없이는 스캐닝시에보고되고 활성화되면 무시됩니다 문제는보고되지 않습니다. 이 지시어를 무효로하는 것은 보안을 향상시킬 수 있지만, 오진도 증가 할 수 있습니다. <code>false</code> = Disabled/장애인; <code>true</code> = Enabled/유효 (Default / 기본 설정).';
$phpMussel['lang']['config_signatures_fail_silently'] = '서명 파일이 없거나 손상된 경우 phpMussel 그것을 리포트 해야하는지 여부? <code>fail_silently</code>이 유효하지 않으면 문제가 리포트되어 유효하면 문제는 무시 된 스캔 보고서가 작성됩니다. 충돌하는 같은 피해가 없으면 기본 설정을 그대로 유지한다. <code>false</code> = Disabled/장애인; <code>true</code> = Enabled/유효 (Default / 기본 설정).';
$phpMussel['lang']['config_template_data_css_url'] = '사용자 지정 테마 템플릿 파일은 외부 CSS 속성을 사용하고 있습니다. 한편, 기본 테마는 내부 CSS입니다. 사용자 정의 테마를 적용하는 CSS 파일의 공개적 HTTP 주소를 "css_url"변수를 사용하여 지정하십시오. 이 변수가 공백이면 기본 테마가 적용됩니다.';
$phpMussel['lang']['config_template_data_Magnification'] = '글꼴 배율. Default (기본 설정) = 1.';
$phpMussel['lang']['config_template_data_theme'] = 'phpMussel에 사용할 기본 테마.';
$phpMussel['lang']['config_urlscanner_cache_time'] = 'API 조회의 결과를 얼마나 캐시할지 (초 단위)? 기본값은 3600 초 (한 시간).';
$phpMussel['lang']['config_urlscanner_google_api_key'] = '필요한 API 키가 정의되면, API는 Google Safe Browsing API 조회가 활성화됩니다.';
$phpMussel['lang']['config_urlscanner_lookup_hphosts'] = 'True로하면 API를 hpHosts 조회가 활성화됩니다.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups'] = '스캔 반복의 API 조회의 최대 수입니다. API 조회 때마다 스캔 반복의 시간이 쌓여 버리므로, 스캔 처리 속도 향상을 위해 제한을두고 싶다고 생각할지도 모릅니다. 0은 제한 없음을 의미합니다. 기본값은 10입니다.';
$phpMussel['lang']['config_urlscanner_maximum_api_lookups_response'] = 'API 조회 횟수 제한을 초과했을 때의 대응입니다. <code>false</code> = 아무것도 / 처리를 계속한다 (Default / 기본 설정); <code>true</code> = 파일에 플래그를 지정 / 차단한다.';
$phpMussel['lang']['config_virustotal_vt_public_api_key'] = '옵션이지만, phpMussel은 Virus Total API를 사용하여 파일을 검색 할 수 있습니다. 바이러스, 트로이 목마, 악성 코드 및 기타 공격에 매우 효과적으로 작동합니다. 기본적으로 Virus Total API를 사용한 스캐닝은 비활성화되어 있습니다. 활성화하려면 Virus Total의 API 키가 필요합니다. 이점이 매우 크기 때문에 사용하는 것이 좋습니다. Virus Total API의 사용에 있어서는 Virus Total 문서에있는대로 이용 규정 및 지침을 준수하지 않으면 안됩니다. 이 통합 기능을 사용하기 위해서는 : Virus Total와 API의 서비스 규정을 읽고 동의해야합니다. 최소 Virus Total Public API 문서의 전문을 읽고 이해하여 (VirusTotalPublic API v2.0 이후 Contents "콘텐츠"이전까지).';
$phpMussel['lang']['config_virustotal_vt_quota_rate'] = 'Virus Total API 문서에 따르면 "1 분간의 타임 프레임 사이에 요청 최대 4 회" 의 제한이 있습니다. 허니 클라이언트와 허니팟 등의 자동화를 사용하여 리포트를받을뿐만 아니라 VirusTotal 자원을 제공하는 경우, 상한은 올라갑니다. phpMussel 기본적으로 최대 4 번을 준수하고 있습니다 만, 위의 상황에서이 두 디렉토리를 준비하고 상황에 맞게 변경할 수 있도록되어 있습니다. 한계에 도달 버리는 등의 불편이나 문제가 없으면 기본값을 변경하는 것은 권장되지 않지만 값을 작게하는 것이 적절한 경우도 있습니다. 상한은 시간 프레임<code>vt_quota_time</code> (분 내에) <code>vt_quota_rate</code>로 설정합니다.';
$phpMussel['lang']['config_virustotal_vt_quota_time'] = '(위의 설명 참조).';
$phpMussel['lang']['config_virustotal_vt_suspicion_level'] = '기본 설정은 phpMussel이 Virus Total API를 사용하여 스캔 파일 (疑がわし 주물)에 제한이 있습니다. <code>vt_suspicion_level</code> 지시문을 편집 할 더, 이 제한을 변경할 수 있습니다.';
$phpMussel['lang']['config_virustotal_vt_weighting'] = 'phpMussel이 Virus Total API를 사용한 스캐닝 결과를 감지으로 대우하거나, 검색 가중치로 취급 할 것인가? 여러 엔진 (Virus Total처럼)을 사용한 스캐닝은 검색 속도 향상 (더 많은 악성 코드가 감지)을 가져다 한편 오진의 증가도 발생하므로이 지시어가 존재합니다. 따라서 스캐닝 결과는 결정적인 판단이 아니라 신뢰 점수로 사용하는 것이 적절한 경우도 있습니다. 값이 0이면 Virus Total API를 사용한 검색은 검색으로 처리되어 Virus Total 엔진이 악성 코드 및 플래그가 지정된 파일은 phpMussel도 악성 코드로 판단합니다. 다른 값의 경우 결과는 검출 가중되고, 스캔 된 파일이 악성 코드 여부 phpMussel가 결정하는 신뢰 점수 (또는 감지 가중치)입니다 (값은 악성이라고 판단하기위한 최소 신뢰 점수 또는 가중치). 기본값은 0입니다.';
$phpMussel['lang']['Extended Description: phpMussel'] = '메인 패키지 (서명, 문서, 구성, 은 포함되지 않습니다).';
$phpMussel['lang']['field_activate'] = '활성화';
$phpMussel['lang']['field_clear_all'] = '모두 취소';
$phpMussel['lang']['field_component'] = '구성 요소';
$phpMussel['lang']['field_create_new_account'] = '새로운 계정 만들기';
$phpMussel['lang']['field_deactivate'] = '비활성화';
$phpMussel['lang']['field_delete_account'] = '계정 삭제';
$phpMussel['lang']['field_delete_all'] = '모두 삭제';
$phpMussel['lang']['field_delete_file'] = '삭제';
$phpMussel['lang']['field_download_file'] = '다운로드';
$phpMussel['lang']['field_edit_file'] = '편집';
$phpMussel['lang']['field_false'] = 'False (거짓)';
$phpMussel['lang']['field_file'] = '파일';
$phpMussel['lang']['field_filename'] = '파일 이름 : ';
$phpMussel['lang']['field_filetype_directory'] = '디렉토리';
$phpMussel['lang']['field_filetype_info'] = '{EXT} 파일';
$phpMussel['lang']['field_filetype_unknown'] = '알 수없는';
$phpMussel['lang']['field_install'] = '설치';
$phpMussel['lang']['field_latest_version'] = '최신 버전';
$phpMussel['lang']['field_log_in'] = '로그인';
$phpMussel['lang']['field_more_fields'] = '필드를 추가합니다';
$phpMussel['lang']['field_new_name'] = '새 이름 :';
$phpMussel['lang']['field_ok'] = '승인';
$phpMussel['lang']['field_options'] = '옵션';
$phpMussel['lang']['field_password'] = '비밀번호';
$phpMussel['lang']['field_permissions'] = '권한';
$phpMussel['lang']['field_quarantine_key'] = '격리 키';
$phpMussel['lang']['field_rename_file'] = '이름을 변경하려면';
$phpMussel['lang']['field_reset'] = '재설정';
$phpMussel['lang']['field_restore_file'] = '복구';
$phpMussel['lang']['field_set_new_password'] = '새 암호를 설정합니다';
$phpMussel['lang']['field_size'] = '전체 크기 : ';
$phpMussel['lang']['field_size_bytes'] = '바이트';
$phpMussel['lang']['field_size_GB'] = 'GB';
$phpMussel['lang']['field_size_KB'] = 'KB';
$phpMussel['lang']['field_size_MB'] = 'MB';
$phpMussel['lang']['field_size_TB'] = 'TB';
$phpMussel['lang']['field_status'] = '상태';
$phpMussel['lang']['field_system_timezone'] = '시스템 기본 시간대를 사용하십시오.';
$phpMussel['lang']['field_true'] = 'True (참된)';
$phpMussel['lang']['field_uninstall'] = '제거';
$phpMussel['lang']['field_update'] = '업데이트';
$phpMussel['lang']['field_update_all'] = '모두 업데이트';
$phpMussel['lang']['field_upload_file'] = '새로운 파일을 업로드하기';
$phpMussel['lang']['field_username'] = '사용자 이름';
$phpMussel['lang']['field_your_version'] = '사용 버전';
$phpMussel['lang']['header_login'] = '계속하려면 로그인하십시오.';
$phpMussel['lang']['label_active_config_file'] = '활성 구성 파일 : ';
$phpMussel['lang']['label_blocked'] = '차단 된 업로드';
$phpMussel['lang']['label_branch'] = '분기 최신 안정 :';
$phpMussel['lang']['label_events'] = '스캔 이벤트';
$phpMussel['lang']['label_flagged'] = '신고 된 개체';
$phpMussel['lang']['label_fmgr_cache_data'] = '캐시 데이터 및 임시 파일 ';
$phpMussel['lang']['label_fmgr_disk_usage'] = 'phpMussel 디스크 사용 : ';
$phpMussel['lang']['label_fmgr_free_space'] = '사용 가능한 디스크 공간 : ';
$phpMussel['lang']['label_fmgr_total_disk_usage'] = '총 디스크 사용 : ';
$phpMussel['lang']['label_fmgr_total_space'] = '총 디스크 공간 : ';
$phpMussel['lang']['label_fmgr_updates_metadata'] = '구성 요소 업데이트 메타 데이터';
$phpMussel['lang']['label_hide'] = '숨기다';
$phpMussel['lang']['label_os'] = '사용 된 운영 체제 :';
$phpMussel['lang']['label_other'] = '다른';
$phpMussel['lang']['label_other-Active'] = '활성 서명 파일';
$phpMussel['lang']['label_other-Since'] = '시작일';
$phpMussel['lang']['label_php'] = '사용 된 PHP 버전 :';
$phpMussel['lang']['label_phpmussel'] = '사용 된 phpMussel 버전 :';
$phpMussel['lang']['label_quarantined'] = '격리 된 업로드';
$phpMussel['lang']['label_sapi'] = '사용 된 SAPI :';
$phpMussel['lang']['label_scanned_objects'] = '스캔 한 개체';
$phpMussel['lang']['label_scanned_uploads'] = '스캔 한 업로드';
$phpMussel['lang']['label_show'] = '보여';
$phpMussel['lang']['label_size_in_quarantine'] = '격리 크기 : ';
$phpMussel['lang']['label_stable'] = '최신 안정 :';
$phpMussel['lang']['label_sysinfo'] = '시스템 정보 :';
$phpMussel['lang']['label_tests'] = '테스트 :';
$phpMussel['lang']['label_unstable'] = '최신 불안정 :';
$phpMussel['lang']['label_upload_date'] = '업로드 날짜 : ';
$phpMussel['lang']['label_upload_hash'] = '업로드 해시 : ';
$phpMussel['lang']['label_upload_origin'] = '업로드 원점 : ';
$phpMussel['lang']['label_upload_size'] = '업로드 크기 : ';
$phpMussel['lang']['link_accounts'] = '계정';
$phpMussel['lang']['link_config'] = '구성';
$phpMussel['lang']['link_documentation'] = '문서';
$phpMussel['lang']['link_file_manager'] = '파일 관리자';
$phpMussel['lang']['link_home'] = '홈';
$phpMussel['lang']['link_logs'] = '로고스';
$phpMussel['lang']['link_quarantine'] = '격리';
$phpMussel['lang']['link_statistics'] = '통계';
$phpMussel['lang']['link_textmode'] = '텍스트 서식 지정 : <a href="%1$sfalse">단순한</a> – <a href="%1$strue">공상</a>';
$phpMussel['lang']['link_updates'] = '업데이트';
$phpMussel['lang']['link_upload_test'] = '업로드 테스트';
$phpMussel['lang']['logs_logfile_doesnt_exist'] = '선택한 로그는 존재하지 않습니다!';
$phpMussel['lang']['logs_no_logfiles_available'] = '아니 로그를 사용할 수 있습니다.';
$phpMussel['lang']['logs_no_logfile_selected'] = '로그가 선택되어 있지 않습니다.';
$phpMussel['lang']['max_login_attempts_exceeded'] = '로그인 시도 횟수를 초과했습니다; 액세스 거부.';
$phpMussel['lang']['previewer_days'] = '일';
$phpMussel['lang']['previewer_hours'] = '시간';
$phpMussel['lang']['previewer_minutes'] = '의사록';
$phpMussel['lang']['previewer_months'] = '개월';
$phpMussel['lang']['previewer_seconds'] = '초';
$phpMussel['lang']['previewer_weeks'] = '주';
$phpMussel['lang']['previewer_years'] = '연령';
$phpMussel['lang']['response_accounts_already_exists'] = '계정이 이미 존재합니다!';
$phpMussel['lang']['response_accounts_created'] = '계정 만들기에 성공했습니다!';
$phpMussel['lang']['response_accounts_deleted'] = '계정 삭제가 성공했습니다!';
$phpMussel['lang']['response_accounts_doesnt_exist'] = '계정이 존재하지 않습니다.';
$phpMussel['lang']['response_accounts_password_updated'] = '암호 업데이트가 성공했습니다!';
$phpMussel['lang']['response_activated'] = '활성화했습니다.';
$phpMussel['lang']['response_activation_failed'] = '활성화에 실패했습니다!';
$phpMussel['lang']['response_checksum_error'] = '체크섬 오류! 파일이 거부되었습니다!';
$phpMussel['lang']['response_component_successfully_installed'] = '구성 요소의 설치에 성공했습니다.';
$phpMussel['lang']['response_component_successfully_uninstalled'] = '구성 요소의 제거는 성공했습니다.';
$phpMussel['lang']['response_component_successfully_updated'] = '구성 요소의 업데이트에 성공했습니다!';
$phpMussel['lang']['response_component_uninstall_error'] = '구성 요소 제거하는 동안 오류가 발생했습니다.';
$phpMussel['lang']['response_configuration_updated'] = '구성 업데이트가 성공했습니다.';
$phpMussel['lang']['response_deactivated'] = '비활성화했습니다.';
$phpMussel['lang']['response_deactivation_failed'] = '비활성화에 실패했습니다!';
$phpMussel['lang']['response_delete_error'] = '삭제에 실패했습니다!';
$phpMussel['lang']['response_directory_deleted'] = '디렉토리가 성공적으로 삭제되었습니다!';
$phpMussel['lang']['response_directory_renamed'] = '디렉토리의 이름이 변경되었습니다!';
$phpMussel['lang']['response_error'] = '오류';
$phpMussel['lang']['response_failed_to_install'] = '설치하지 못했습니다!';
$phpMussel['lang']['response_failed_to_update'] = '업데이트하지 못했습니다!';
$phpMussel['lang']['response_file_deleted'] = '파일 삭제가 성공했습니다!';
$phpMussel['lang']['response_file_edited'] = '파일이 성공적으로 변경되었습니다!';
$phpMussel['lang']['response_file_renamed'] = '파일 이름이 변경되었습니다!';
$phpMussel['lang']['response_file_restored'] = '파일이 성공적으로 복원되었습니다!';
$phpMussel['lang']['response_file_uploaded'] = '파일이 성공적으로 업로드되었습니다!';
$phpMussel['lang']['response_login_invalid_password'] = '로그인 실패! 잘못된 암호!';
$phpMussel['lang']['response_login_invalid_username'] = '로그인 실패! 사용자 이름은 존재하지 않습니다!';
$phpMussel['lang']['response_login_password_field_empty'] = '암호가 비어 있습니다!';
$phpMussel['lang']['response_login_username_field_empty'] = '사용자 이름 입력이 비어 있습니다!';
$phpMussel['lang']['response_rename_error'] = '이름을 변경할 수 없습니다!';
$phpMussel['lang']['response_restore_error_1'] = '복원하지 못했습니다! 손상된 파일!';
$phpMussel['lang']['response_restore_error_2'] = '복원하지 못했습니다! 잘못된 격리 키!';
$phpMussel['lang']['response_statistics_cleared'] = '통계가 삭제되었습니다.';
$phpMussel['lang']['response_updates_already_up_to_date'] = '이미 최신 상태입니다.';
$phpMussel['lang']['response_updates_not_installed'] = '구성 요소 설치되어 있지 않습니다!';
$phpMussel['lang']['response_updates_not_installed_php'] = '구성 요소 설치되어 있지 않습니다 (PHP {V}가 필요합니다)!';
$phpMussel['lang']['response_updates_outdated'] = '구식입니다!';
$phpMussel['lang']['response_updates_outdated_manually'] = '구식입니다 (수동으로 업데이트하십시오)!';
$phpMussel['lang']['response_updates_outdated_php_version'] = '구식입니다 (PHP {V}가 필요합니다)!';
$phpMussel['lang']['response_updates_unable_to_determine'] = '결정 수 없습니다.';
$phpMussel['lang']['response_upload_error'] = '업로드에 실패했습니다!';
$phpMussel['lang']['state_complete_access'] = '전체 액세스';
$phpMussel['lang']['state_component_is_active'] = '구성 요소가 활성화됩니다.';
$phpMussel['lang']['state_component_is_inactive'] = '구성 요소가 비활성 상태입니다.';
$phpMussel['lang']['state_component_is_provisional'] = '구성 요소가 잠정입니다.';
$phpMussel['lang']['state_default_password'] = '경고 : 기본 암호를 사용하여!';
$phpMussel['lang']['state_logged_in'] = '로그인 있습니다.';
$phpMussel['lang']['state_logs_access_only'] = '로그에만 액세스';
$phpMussel['lang']['state_maintenance_mode'] = '경고 : 유지 관리 모드가 활성화되었습니다!';
$phpMussel['lang']['state_password_not_valid'] = '경고 : 이 계정은 올바른 암호를 사용하지 않습니다!';
$phpMussel['lang']['state_quarantine'] = '현재 %s 개의 파일이 격리 보관소에 있습니다.';
$phpMussel['lang']['switch-hide-non-outdated-set-false'] = '비 구형을 숨기지 않고';
$phpMussel['lang']['switch-hide-non-outdated-set-true'] = '비 구식 숨기기';
$phpMussel['lang']['switch-hide-unused-set-false'] = '미사용을 숨기지 않고';
$phpMussel['lang']['switch-hide-unused-set-true'] = '미사용 숨기기';
$phpMussel['lang']['tip_accounts'] = '안녕하세요, {username}.<br />계정 페이지는 phpMussel 프론트 엔드에 액세스 할 수있는 사용자를 제어 할 수 있습니다.';
$phpMussel['lang']['tip_config'] = '안녕하세요, {username}.<br />구성 페이지는 프론트 엔드에서 phpMussel의 설정을 변경할 수 있습니다.';
$phpMussel['lang']['tip_donate'] = 'phpMussel는 무료로 제공되고 있습니다, 하지만 당신이 원한다면 기부 버튼을 클릭하면 프로젝트에 기부 할 수 있습니다.';
$phpMussel['lang']['tip_file_manager'] = '안녕하세요, {username}.<br />파일 관리자를 사용하여 파일을 삭제, 편집, 업로드, 다운로드 할 수 있습니다. 신중하게 사용하는 (이것을 사용하여 설치를 끊을 수 있습니다).';
$phpMussel['lang']['tip_home'] = '안녕하세요, {username}.<br />이것은 phpMussel 프론트 엔드의 홈페이지입니다. 계속하려면 왼쪽 탐색 메뉴에서 링크를 선택합니다.';
$phpMussel['lang']['tip_login'] = '기본 사용자 이름 : <span class="txtRd">admin</span> – 기본 암호 : <span class="txtRd">password</span>';
$phpMussel['lang']['tip_logs'] = '안녕하세요, {username}.<br />로그의 내용을 보려면 다음 목록에서 로그를 선택합니다.';
$phpMussel['lang']['tip_quarantine'] = '안녕하세요, {username}.<br />관리를 용이하게하기 위해, 현재 격리 저장소에있는 모든 파일이이 페이지에 나열됩니다.';
$phpMussel['lang']['tip_quarantine_disabled'] = '노트 : 격리는 현재 비활성화되어 있지만 구성 페이지를 통해 활성화 할 수 있습니다.';
$phpMussel['lang']['tip_see_the_documentation'] = '설정 지시어에 대한 자세한 내용은 <a href="https://github.com/phpMussel/phpMussel/blob/master/_docs/readme.ko.md#SECTION7">문서를</a> 참조하십시오.';
$phpMussel['lang']['tip_statistics'] = '안녕하세요, {username}.<br />이 페이지는 phpMussel 설치와 관련된 몇 가지 기본 사용 통계를 보여줍니다.';
$phpMussel['lang']['tip_statistics_disabled'] = '노트 : 통계 추적은 현재 비활성화되어, 있지만 구성 페이지를 통해 활성화 할 수 있습니다.';
$phpMussel['lang']['tip_updates'] = '안녕하세요, {username}.<br />업데이트 페이지는 phpMussel의 다양한 구성 요소를 설치·제거·업데이트 할 수 있습니다 (코어 패키지·서명·L10N 파일 등).';
$phpMussel['lang']['tip_upload_test'] = '안녕하세요, {username}.<br />업로드 테스트 페이지 표준 파일 업로드 양식을 포함합니다 파일이 일반적 차단 여부를 테스트 할 수 있습니다.';
$phpMussel['lang']['title_accounts'] = 'phpMussel – 계정';
$phpMussel['lang']['title_config'] = 'phpMussel – 구성';
$phpMussel['lang']['title_file_manager'] = 'phpMussel – 파일 관리자';
$phpMussel['lang']['title_home'] = 'phpMussel – 홈';
$phpMussel['lang']['title_login'] = 'phpMussel – 로그인';
$phpMussel['lang']['title_logs'] = 'phpMussel – 로고스';
$phpMussel['lang']['title_quarantine'] = 'phpMussel – 격리';
$phpMussel['lang']['title_statistics'] = 'phpMussel – 통계';
$phpMussel['lang']['title_updates'] = 'phpMussel – 업데이트';
$phpMussel['lang']['title_upload_test'] = 'phpMussel – 업로드 테스트';
$phpMussel['lang']['warning'] = '경고 :';
$phpMussel['lang']['warning_php_1'] = '귀하의 PHP 버전은 더 이상 적극적으로 지원되지 않습니다! 업데이트하는 것이 좋습니다!';
$phpMussel['lang']['warning_php_2'] = '귀하의 PHP 버전이 심각하게 취약합니다! 업데이트하는 것이 좋습니다!';
$phpMussel['lang']['warning_signatures_1'] = '서명 파일이 활성화되어 있지 않습니다!';

$phpMussel['lang']['info_some_useful_links'] = '유용한 링크 :<ul>
            <li><a href="https://github.com/phpMussel/phpMussel/issues">phpMussel 문제 @ GitHub</a> – phpMussel 문제 페이지 (지원, 원조 등).</li>
            <li><a href="http://www.spambotsecurity.com/forum/viewforum.php?f=55">phpMussel @ Spambot Security</a> – phpMussel 토론 포럼 (지원, 원조 등).</li>
            <li><a href="https://sourceforge.net/projects/phpmussel/">phpMussel @ SourceForge</a> – phpMussel 대체 다운로드 거울.</li>
            <li><a href="https://websectools.com/">WebSecTools.com</a> – 웹 사이트를 보호하기 위해 간단한 웹 마스터 도구 모음.</li>
            <li><a href="https://www.clamav.net/">ClamavNet</a> – ClamAV 홈페이지 (ClamAV®는 트로이 목마, 바이러스, 악성 코드, 그리고 기타 위협을 탐지하기위한 오픈 소스 안티 바이러스 엔진입니다).</li>
            <li><a href="https://www.securiteinfo.com/">SecuriteInfo.com</a> – ClamAV의 추가적인 서명을 제공하는 컴퓨터 보안 회사.</li>
            <li><a href="http://www.phishtank.com/">PhishTank</a> – phpMussel URL 스캐너에 이용되는 피싱 데이터베이스.</li>
            <li><a href="https://www.facebook.com/groups/2204685680/">Global PHP Group @ Facebook</a> – PHP 학습 자원과 토론.</li>
            <li><a href="https://php.earth/">PHP.earth</a> – PHP 학습 자원과 토론.</li>
            <li><a href="https://www.virustotal.com/">VirusTotal</a> – VirusTotal은 의심스러운 파일이나 URL을 분석하는 무료 서비스입니다.</li>
            <li><a href="https://www.hybrid-analysis.com/">Hybrid Analysis</a> – Hybrid Analysis는 <a href="http://www.payload-security.com/">Payload Security</a>가 제공하는 무료 악성 코드 분석 서비스.</li>
            <li><a href="https://www.malwarebytes.com/">Malwarebytes</a> – 컴퓨터의 맬웨어 방지 전문가.</li>
            <li><a href="https://malwaretips.com/">MalwareTips</a> – 편리한 맬웨어 방지 토론 포럼.</li>
            <li><a href="https://maikuolan.github.io/Vulnerability-Charts/">취약점 차트</a> – 다양한 패키지의 안전하고 안전하지 않은 버전을 나열합니다 (PHP, HHVM, 기타).</li>
            <li><a href="https://maikuolan.github.io/Compatibility-Charts/">호환성 차트</a> – 다양한 패키지에 대한 호환성 정보를 나열합니다 (CIDRAM, phpMussel, 기타).</li>
        </ul>';
