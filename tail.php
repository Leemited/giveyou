<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 하단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_tail'] && is_file(G5_PATH.'/'.$config['cf_include_tail'])) {
    include_once(G5_PATH.'/'.$config['cf_include_tail']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
$test = $_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];

$give_tel=sql_fetch("select * from `gopa_tel`");
?>
<div class="clear"></div>
<?php //if($type=="shop" || $member["mb_level"]==5){?>
<footer id="footer" class="<?php echo $main?"":"sub_footer"; ?> " style="">
	<div class="width-fixed">
		<!-- <ul>
			<li><a href="<?php echo G5_URL."/page/guide/privacy.php"; ?>">개인정보취급방침</a></li>
			<li><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">이용약관</a></li>
			<li class="last"><a href="<?php echo G5_URL."/page/guide/direction.php"; ?>">오시는길</a></li>
		</ul> -->
		<p>
			<h2><?php echo "(주)엔조이라이프"; ?></h2>대표 : 문인규, 최인규<br><?php echo $give_tel['addr']; ?> <br>
			TEL : <?php echo hyphen_hp_number($give_tel['tel']); ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;fax :&nbsp;&nbsp;<?php echo hyphen_hp_number($give_tel['fax']); ?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;E-mail : <?php echo $give_tel['email']; ?><br>
            사업자번호 : 810-86-00925&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			통신판매신고번호 : 2018-충북청주-0838 <br>
			Copyrightⓒ 2018 GIVEYOU. All rights reserved.
		</p>
	</div>
</footer>
<?php //}?>
<script type="text/javascript">
var cunt = '<?php echo $test; ?>';
/*if(cunt.indexOf("tecooni.cafe24.com/main.php") < 0 && cunt.indexOf("tecooni.cafe24.com/index.php") < 0 && cunt.indexOf("tecooni.cafe24.com/page/rent/view.php") < 0 && cunt != "tecooni.cafe24.com"){
	$("#footer").css({"bottom":"0","height":"134px"});
}*/
</script>
<?php
include_once(G5_PATH."/tail.sub.php");
?>