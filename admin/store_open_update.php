<?php
include_once ("../common.php");
$wr_id = $_REQUEST["wr_id"];
$state = $_REQUEST["state"];
$f = false;
if($state=="N") {
    $sql = "update `g5_write_main` set wr_5 = 'Y' where wr_id = '{$wr_id}'";
    $f = true;
}else {
    $sql = "update `g5_write_main` set wr_5 = 'N' where wr_id = '{$wr_id}'";
    $f = false;
}

sql_query($sql);

if($f == false){
    alert("오늘 하루도 고생하셨습니다.", G5_URL."/admin/my_store_list.php");
}else{
    alert("영업을 시작합니다.", G5_URL."/admin/my_store_list.php");
}
