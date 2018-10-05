<?php 
include_once("../../common.php");

$mb_id = $_REQUEST["mb_id"];
$id_chk = "/^[a-z]/i";
$id_chk2 = "/[^a-z0-9-_]/i";
/*
if(strlen($mb_id)<5){
	echo "3";
}else if(!preg_match($id_chk,$mb_id)){
	echo "4";
}/*else if(preg_match($id_chk2,$mb_id)){
	echo "5";	
}*/
$sql = "select * from  `g5_member` where  mb_id = '{$mb_id}' or mb_email = '{$mb_id}'";
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