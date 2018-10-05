<?php 
include_once("../../common.php");
include_once(G5_PATH."/head.php");
if(!$is_member){
	alert("로그인이 필요합니다.",G5_BBS_URL."/login.php");
}
?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1><img src="<?php echo G5_IMG_URL?>/giview_point.png" alt="" />포인트</h1>
			<div class="desc">사용할 수 있는 포인트 안내</div>
		</header>
		<div class="section01_content wrap">
			<div class="point_area">
				<h1><?php echo number_format($member["mb_point"]);?><span>Point</span></h1>
			</div>

			<p>기부 시 제한 없이 사용가능하며, <br>배달 및 매장이용 시 <b>10,000</b> Point 이상 부터 사용이 가능합니다.</p>

			<div class="pointgive">
				<input type="button" value="좋은일 하러가기 :) [G포인트 기부]" class="btn point_btn bg_darkgray grid_100" onclick="fnGives()"/>
				<input type="button" value="G포인트 사용하러 가기" class="btn point_btn bg_darkgray bg_yellow grid_100" onclick="location.href='<?php echo G5_URL?>/page/givemall.php?mm=5'"/>
			</div>
		</div>
	</section>
</div>
<script>

function fnGives(){
	$.post(g5_url+"/page/modal/gives_point.php",function(data){
		$(".modal").html(data);
		modal_active();
	});
}
</script>
<?php 
include_once(G5_PATH."/tail.php");