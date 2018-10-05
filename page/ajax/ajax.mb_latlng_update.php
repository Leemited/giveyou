<?php 
include_once("../../common.php");

$addr = $_GET["addr"];
$addr2 = $_GET["addr2"];
$lat = $_GET["lat"];
$lng = $_GET["lng"];
$mb_id = $_GET["mb_id"];
if($mb_id){
	$sql = "update `g5_member` set mb_1 = '{$addr}',mb_2 = '{$addr2}', mb_3 = '{$lat}',mb_4 = '{$lng}' where  mb_id='{$mb_id}'";
	if(sql_query($sql)){
		echo "정상 등록되었습니다.";
	}else{
		echo "잘못된 요청입니다.";
	}
}else{
	$ss_id = session_id();
	$_SESSION[$ss_id]["addr"] = $addr;
	$_SESSION[$ss_id]["mb_2"] = $addr2;
	$_SESSION[$ss_id]["lat"] = $lat;
	$_SESSION[$ss_id]["lng"] = $mb_id;
}
?>