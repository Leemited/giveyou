<?php 
include_once("../../common.php");

$mb_hp = $_REQUEST["reg_hp"];

$sql = "select * from  `g5_member` where  mb_hp = '{$mb_hp}'";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
	$list[] = $row;
}
if(count($list)==0){
	echo "1";
}else{
	echo "2";
}

?>