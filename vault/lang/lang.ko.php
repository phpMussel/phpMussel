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
 * This file: Korean language data (last modified: 2017.10.15).
 */

/** Prevents execution from outside of phpMussel. */
if (!defined('phpMussel')) {
    die('[phpMussel] This should not be accessed directly.');
}

$phpMussel['lang']['bad_command'] = '미안 해요, 명령을 이해할 수 없습니다.';
$phpMussel['lang']['cli_failed_to_complete'] = '검색을 완료 할 수 없습니다';
$phpMussel['lang']['cli_is_not_a'] = '파일에서 디렉토리도 없습니다.';
$phpMussel['lang']['cli_ln2'] = " phpMussel을 이용해 주셔서 감사합니다. \n phpMussel는 ClamAV를 비롯한 서명을 이용하여 시스템에 업로드 된\n 파일을 대상하여 트로이 바이러스 나 악성 코드 등을 감지하도록 설계된\n PHP 스크립트입니다.\n\n phpMussel 저작권 2013 년 이후 Caleb M (Maikuolan)의 GNU/GPLv2.\n\n                                     ~ ~ ~\n\n";
$phpMussel['lang']['cli_ln3'] = " CLI 모드 (명령 줄 인터페이스)에서 phpMussel를 실행 중입니다.\n\n 파일 또는 디렉토리 – 스캔하려면 \"scan\"를 입력하고 계속 파일\n 또는 디렉터리 이름을 입력하고 엔터를 눌러주세요.\n CLI 모드 명령의 목록을 얻으려면 'c'를 입력하고 엔터를 눌러주세요;\n 종료는 \"q\"를 입력하고 엔터를 누릅니다. ";
$phpMussel['lang']['cli_pe1'] = '올바른 PE 파일이 없습니다!';
$phpMussel['lang']['cli_pe2'] = 'PE 섹션:';
$phpMussel['lang']['cli_signature_placeholder'] = '서명-이름';
$phpMussel['lang']['cli_working'] = '처리 중';
$phpMussel['lang']['corrupted'] = '손상 PE를 발견했습니다';
$phpMussel['lang']['data_not_available'] = '데이터를 사용할 수 없습니다.';
$phpMussel['lang']['denied'] = '업로드 거부!';
$phpMussel['lang']['denied_reason'] = '다음과 같은 이유로 업로드가 거부되었습니다:';
$phpMussel['lang']['detected'] = '{vn}을 발견했습니다';
$phpMussel['lang']['detected_control_characters'] = '제어 문자를 발견했습니다';
$phpMussel['lang']['encrypted_archive'] = '암호화 된 아카이브 검색 : 암호화 된 아카이브는 허용되지 않습니다';
$phpMussel['lang']['failed_to_access'] = '액세스에 실패했습니다';
$phpMussel['lang']['file'] = '파일';
$phpMussel['lang']['filesize_limit_exceeded'] = '용 범위를 벗어난 파일 크기입니다';
$phpMussel['lang']['filetype_blacklisted'] = '파일 형식이 블랙리스트입니다';
$phpMussel['lang']['finished'] = '완료';
$phpMussel['lang']['generated_by'] = '작성자';
$phpMussel['lang']['greylist_cleared'] = ' 회색 목록이 해제되었습니다.';
$phpMussel['lang']['greylist_not_updated'] = ' 회색 목록이 업데이트되어 있지 않습니다.';
$phpMussel['lang']['greylist_updated'] = ' 회색 목록이 업데이트되었습니다.';
$phpMussel['lang']['image'] = '이미지';
$phpMussel['lang']['instance_already_active'] = '인스턴스가 이미 활성화되어 있습니다! 후크를 다시 확인하십시오.';
$phpMussel['lang']['invalid_data'] = '유효하지 않은 데이터!';
$phpMussel['lang']['invalid_file'] = '유효하지 않은 파일';
$phpMussel['lang']['invalid_url'] = '유효하지 않은 URL!';
$phpMussel['lang']['ok'] = '괜찮아';
$phpMussel['lang']['only_allow_images'] = '이미지 이외의 파일을 업로드하는 것은 허용되지 않습니다';
$phpMussel['lang']['plugins_directory_nonexistent'] = '플러그인 디렉토리가 존재하지 않습니다!';
$phpMussel['lang']['quarantined_as'] = "\"/vault/quarantine/{QFU}.qfu\"로 격리.\n";
$phpMussel['lang']['recursive'] = '재귀 정의 호출의 반복 횟수를 초과했습니다';
$phpMussel['lang']['required_variables_not_defined'] = '요청이 있었던 변수가 정의되어 있지 않기 때문에 계속할 수 없습니다.';
$phpMussel['lang']['SafeBrowseLookup_200'] = '잠재적으로 유해한 URL이 감지되었습니다';
$phpMussel['lang']['SafeBrowseLookup_400'] = 'API 요청이 부정';
$phpMussel['lang']['SafeBrowseLookup_401'] = 'API 인증 오류';
$phpMussel['lang']['SafeBrowseLookup_503'] = 'API 서비스 이용 불가';
$phpMussel['lang']['SafeBrowseLookup_999'] = '알 수없는 API 오류';
$phpMussel['lang']['scan_aborted'] = '스캐닝 중단!';
$phpMussel['lang']['scan_chameleon'] = '{x} 카멜레온 공격이 감지되었습니다';
$phpMussel['lang']['scan_checking'] = '확인 중';
$phpMussel['lang']['scan_checking_contents'] = '성공! 내용을 확인하고 있습니다.';
$phpMussel['lang']['scan_command_injection'] = '명령 주입 공격이 감지되었습니다';
$phpMussel['lang']['scan_complete'] = '완료';
$phpMussel['lang']['scan_extensions_missing'] = '실패 (요청한 확장자가 없습니다)!';
$phpMussel['lang']['scan_filename_manipulation_detected'] = '파일 네이무 조작이 감지되었습니다';
$phpMussel['lang']['scan_missing_filename'] = '파일 이름이 존재하지 않습니다';
$phpMussel['lang']['scan_not_archive'] = '실패 (내용이 없거나 보관하지 않습니다)!';
$phpMussel['lang']['scan_no_problems_found'] = '문제는 발견되지 않았습니다.';
$phpMussel['lang']['scan_reading'] = '로드 중입니다';
$phpMussel['lang']['scan_signature_file_corrupted'] = '서명 파일이 오염되어 있습니다';
$phpMussel['lang']['scan_signature_file_missing'] = '서명 파일이 없습니다';
$phpMussel['lang']['scan_tampering'] = '검색된 잠재적으로 위험한 파일 변조';
$phpMussel['lang']['scan_unauthorised_upload'] = '불법 파일 업로드 변조가 감지되었습니다';
$phpMussel['lang']['scan_unauthorised_upload_or_misconfig'] = '불법 파일 업로드 변조 또는 미스 콘 피규 레이션이 감지되었습니다! ';
$phpMussel['lang']['started'] = '시작합니다';
$phpMussel['lang']['too_many_urls'] = 'URL이 너무 많습니다';
$phpMussel['lang']['upload_error_1'] = '지시 된 최대 업로드 파일 크기를 초과합니다. ';
$phpMussel['lang']['upload_error_2'] = '양식의 파일 크기 제한을 초과합니다. ';
$phpMussel['lang']['upload_error_34'] = '업로드 실패! 호스트 책임자와 상담하십시오! ';
$phpMussel['lang']['upload_error_6'] = '업로드 디렉토리가 없습니다! 호스트 책임자와 상담하십시오! ';
$phpMussel['lang']['upload_error_7'] = '디스크에 쓸 수 없습니다! 호스트 책임자와 상담하십시오! ';
$phpMussel['lang']['upload_error_8'] = '잘못된 PHP 설정이 감지되었습니다! 호스트 책임자와 상담하십시오! ';
$phpMussel['lang']['upload_limit_exceeded'] = '업로드 제한을 초과합니다.';
$phpMussel['lang']['wrong_password'] = '잘못된 암호; 액션은 부정되었다.';
$phpMussel['lang']['x_does_not_exist'] = '존재하지 않습니다';
$phpMussel['lang']['_exclamation'] = '! ';
$phpMussel['lang']['_exclamation_final'] = '!';
$phpMussel['lang']['_fullstop'] = '. ';
$phpMussel['lang']['_fullstop_final'] = '.';

$phpMussel['lang']['cli_commands'] = " q
 - CLI 종료.
 - 별칭 : quit, exit.
 md5_file
 - 파일 MD5 서명을 작성 [구문 : md5_file 파일].
 - 별칭 : m.
 sha1_file
 - 파일 SHA1 서명을 작성 [구문 : sha1_file 파일].
 md5
 - 문자열에서 MD5 서명을 작성 [구문 : md5 문자열].
 sha1
 - 문자열에서 SHA1 서명을 작성 [구문 : sha1 문자열].
 hex_encode
 - 2 진수 문자열을 16 진수 문자열로 변환 [구문 : hex_encode 문자열].
 - 별칭 : x.
 hex_decode
 - 16 진수 문자열을 2 진수 문자열로 변환 [구문 : hex_decode 문자열].
 base64_encode
 - 2 진수 문자열을 BASE64 문자열로 변환 [구문 : base64_encode 문자열].
 - 별칭 : b.
 base64_decode
 - BASE64 문자열을 2 진수 문자열로 변환 [구문 : base64_decode 문자열].
 pe_meta
 - PE 파일에서 메타 데이터 추출 [구문 : pe_meta 파일].
 url_sig
 - URL 스캐너 서명 생성 [구문 : url_sig 문자열].
 scan
 - 파일 또는 디렉터리를 검색 [구문 : scan 파일].
 - 별칭 : s.
 c
 - 명령 목록 프린트.
";
