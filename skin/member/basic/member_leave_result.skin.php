<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1>회원탈퇴 완료</h1>
			<h3 class="member_leave_head"></h3>
			<p>그동안 고파를 이용해주셔서 감사합니다.</p>
		</header>
		<div class="section01_content wrap" id="register_result">
			<i></i>
			<h1>회원탈퇴가 완료되었습니다!</h1>
			<p>
				그동안  고파를 이용해주셔서 감사하며<br />
				더 나은 서비스로 돌아오도록 하겠습니다.
			</p>
			<a href="<?php echo G5_URL; ?>" class="btn">HOME</a>
		</div>
	</section>
</div>
