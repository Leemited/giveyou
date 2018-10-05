<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1>회원가입</h1>
			<h3 class="register_result_head"></h3>
			<p>모든 회원가입절차가 완료되었습니다.</p>
		</header>
		<div class="section01_content wrap" id="register_result">
			<i></i>
			<h1>회원가입이 완료되었습니다!</h1>
			<p>
				고파에서 제공하는 <br />
				모든 서비스를 이용하실 수 있습니다.
			</p>
			<a href="<?php echo G5_URL; ?>" class="btn">HOME</a>
		</div>
	</section>
</div>
