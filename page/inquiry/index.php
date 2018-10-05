<?php
include_once("../../common.php");
include_once(G5_PATH."/head.php");

$token = get_write_token("inquiry");

?>
<style type="text/css">
	.agree{margin-top:2%;}
</style>	
<div class="width-fixed">
	<section class="login_section">
		<header class="section01_header">
			<h1>입점 신청</h1>
			<h3 class="partner_head"></h3>
			<p>베스트 렌터카의 제휴 업체를 소개해드립니다.</p>
		</header>
		<div class="clear"></div>
		<div class="event">
			<div class="events">
				<div class="item" ><img src="<?php echo G5_IMG_URL?>/sample_event.jpg" alt=""></div>
				<?php //echo latest("basic2","event",5);?>
			</div>
		</div>
		<div class="container wrap" id="password_lost">
			<div class="mr">
				<header>
					<h2>신청정보 입력</h2>
					<p>자세한 상담을 위해 정보를 입력해 주세요.</p>
				</header>
				<div>
					<form action="<?php echo G5_BBS_URL?>/write_update.php" method="post" name="inquiry_form">
						<input type="hidden" name="w" value="<?php echo $w ?>">
						<input type="hidden" name="bo_table" value="inquiry">
						<input type="hidden" name="token" value="<?php echo $token; ?>">
						<input type="hidden" name="wr_subject" id="wr_subject" />
						<input type="hidden" name="wr_content" id="wr_content" />
						<div class="login_id">
							<input type="text" placeholder="업체명" name="wr_name" id="wr_name" required class="input02 grid_100"/>
						</div>
						<div class="login_id" style="margin-top:1%;">
							<input type="text" placeholder="연락처" name="wr_1" id="wr_1" required class="input02 grid_100"/>
						</div>
						<div class="agree">
							<input type="checkbox" name="garee" id="agree" required/><label for="agree"><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">&nbsp;&nbsp;<u>개인정보 취급방침</u></a>에 동의합니다.</label>
						</div>
						<input type="submit" value="신청하기" class="btn grid_100">
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#wr_name").keyup(function(){
		$("#wr_subject").val("["+$("#wr_name").val()+"]님의 입점 신청입니다.");
		$("#wr_content").val("이름 : "+$("#wr_name").val() + "\r\n연락처 : " + $("#wr_1").val());
	});
	$("#wr_1").keyup(function(){
		$("#wr_subject").val("["+$("#wr_name").val()+"]님의 입점 신청입니다.");
		$("#wr_content").val("이름 : "+$("#wr_name").val() + "\r\n연락처 : " + $("#wr_1").val());
	});
})
</script>
<?php
	include_once(G5_PATH."/tail.php");
?>