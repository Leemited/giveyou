<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	if($is_member){
		goto_url(G5_URL."/page/mypage/reserve.php");
	}
?>
<style type="text/css">
	.reserve_nomember_txt{display:none;}
	@media all and (max-width: 1120px){
		.reserve_nomember_txt{text-align:center;display:block;font-size:14px;width:100%;padding:30px 0;border:1px dashed #ce2027;margin-bottom:20px;}
	}
	@media all and (max-width: 480px){
		.reserve_nomember_txt{font-size:12px;padding:20px 0;margin-bottom:10px;}
	}
</style>
	<div class="width-fixed">
		<section class="login_section" id="reserve_nomember">
			<header class="login_header section01_header">
				<h1>비회원 예약확인</h1>
				<h3 class="reserve_nomember_head"></h3>
				<p>예약시 입력한 예약자명과 휴대폰번호를 입력해주세요.</p>
			</header>
			<div class="section01_content wrap">
				<div id="login_form">
					<p class="reserve_nomember_txt">예약시 입력한 예약자명과 휴대폰번호를 입력해주세요.</p>
					<form name="flogin" action="<?php echo G5_URL."/page/mypage/reserve.php"; ?>" onsubmit="return flogin_submit(this);" method="post">
						<input type="text" name="mb_name" id="mb_name" style="margin-bottom:4px;" required class="input02 grid_100" placeholder="예약자명">
						<input type="tel" name="mb_phone" id="mb_phone" style="margin-bottom:4px;" required class="input02 grid_100" placeholder="핸드폰 번호" onkeyup="return number_only(this);">
						<input type="submit" value="예약확인" class="grid_100 btn submit">
						<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="grid_100 btn" style="background:#424242;margin-top:10px;border:0;padding:13px 0;">회원가입</a>
					</form>
				</div>
			</div>
		</section>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>