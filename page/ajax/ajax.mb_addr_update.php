<?php 
include_once("../../common.php");

$addr = $_REQUEST["addr"];
$mb_id = $_REQUEST["mb_id"];
$sql = "update `g5_member` set mb_addr1 = '{$addr}' where  mb_id='{$mb_id}'";
if(sql_query($sql)){
	echo "정상 등록되었습니다.";
}else{
	echo "잘못된 요청입니다.";
}
?>