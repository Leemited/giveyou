<?php
define('_INDEX_', true);
include_once('./_common.php');

// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index_old.php');
    return;
}

include_once('./head.sub.php');
?>
<div id="intro">
	<div class="con">
		<h1><img src="<?php echo G5_IMG_URL."/intro_logo.png"; ?>" alt="페이지 준비중 입니다." /></h1>
		<h3>Thank you for your attention.</h3>
		<p>Thank you for visiting Best Rent car website.<br />We are currently under construction for the better service.<br />Please look forward to good website.</p>
	</div>
	<div class="footer">
		Address : 충청북도 청주시 흥덕구 봉명동 2499번지 파비뇽아울렛A 1004호<br />
		Tel : 010-8829-3832&nbsp;&nbsp;|&nbsp;&nbsp;Email: idlove38@naver.com<br />
		<p>&copy; 2016 BEST RANTCAR All Rights Reserved</p>
	</div>
</div>
<?php
include_once('./tail.sub.php');
?>
