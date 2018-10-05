<?php
include_once("../common.php");

include_once(G5_PATH."/head.php");

$use_point = $_REQUEST["use_point"];
$msg = $_REQUEST["msg"];

if($use_point){
	$sql = "update `g5_member` set mb_point = mb_point - ".$use_point." where mb_id = '{$member[mb_id]}'";
	sql_query($sql);

	$sql = "insert into `mb_point_log` (`mb_id`,`log_type`,`use_point`,`save_point`,`log_date`,`log_title`,`log_content`) values ('{$member[mb_id]}','기부천사','{$use_point}', 0, now(), '기부천사기부','{$msg}')";
	sql_query($sql);

	echo "<script>alert(정상 기부되었습니다.);</script><noscript></noscript>";
}
?>
<div class="width-fixed">
	<img src="<?php echo G5_IMG_URL?>/gives.png" alt="">	
	<div class="give_btn_area">
		<div class="give_btn" onclick="fnGives();">
			<span>G포인트</span> 기부하러 가기
		</div>
	</div>
	<img src="<?php echo G5_IMG_URL?>/gives_bottom.png" alt="">
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
?>