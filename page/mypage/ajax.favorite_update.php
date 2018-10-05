<?php
include_once("../../common.php");
$id = $_REQUEST["id"];
$wr_id = $_REQUEST["wr_id"];
$mb_id = $_REQUEST["mb_id"];
$mode = $_REQUEST["mode"];


if($id){
    $sql = "delete from `mypage_favorite` where id = {$id}";
}else if($mode=="del"){
    $sql = "delete from `mypage_favorite` where wr_id = {$wr_id} and mb_id = {$mb_id}";
}else if($mode=="add"){
    if(!$is_member){
        echo "0";
        return;
    }
    $favorite = sql_fetch("select * from `mypage_favorite` where wr_id = {$wr_id} and mb_id = {$mb_id}");
    if($favorite){
        echo "1";
        return;
    }
    $sql = "insert into `mypage_favorite`  (wr_id, mb_id) VALUES ({$wr_id},{$member[mb_no]})";
}
if(sql_query($sql)){
    echo "2";
}else{
    echo "3";
}
?>