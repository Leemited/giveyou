<?php
include_once ("../../common.php");

$store_name = $_REQUEST["store_name"];
$user_name = $_REQUEST["user_name"];
$email = $_REQUEST["emid"]."@".$_REQUEST["emdm"];
$hp = $_REQUEST["hp1"]."-".$_REQUEST["hp2"]."-".$_REQUEST["hp3"];
$main_slide = $_REQUEST["main_slide"];
$list_ad = $_REQUEST["list_ad"];

$sql = "insert into `premium_inquiry` (store_name, user_name, email, hp, main_slide, list_ad, regi_date) values ('{$store_name}','{$user_name}','{$email}','{$hp}','{$main_slide}','{$list_ad}',now())";

if(sql_query($sql)){
	alert("프리미엄 신청이 완료 되었습니다.");
}else{
	alert("잘못된 요청입니다. 다시시도해 주세요");
}

?>