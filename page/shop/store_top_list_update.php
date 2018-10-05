<?php
include_once ("../../common.php");

// 등록된 리스트 수 체크
// 등록된 리스트 수 초과시 대기상태로

$wr_id = $_REQUEST["wr_id"];
$start_date = $_REQUEST["start_date"];
$end_date = $_REQUEST["end_date"];

$sql = "select * from `g5_write_main` where wr_9 BETWEEN '{$start_date}' and '{$end_date}' and wr_10 BETWEEN '{$start_date}' and '{$end_date}'";

$res = sql_query($sql);
$cnt = 0;
while($row = sql_fetch_array($res)){
    $cnt++;
}

if($cnt < 5){
    $sql = "update `g5_write_main` set wr_9 = '{$start_date}', wr_10 = '{$end_date}', wr_6 = 'W' ,list_date = now() where wr_id = '{$wr_id}'";
    sql_query($sql);
    alert("등록되었습니다.");
}else if($cnt >= 5){
    //$sql = "update `g5_write_main` set wr_1 = '{$start_date}', wr_2 = '{$end_date}', wr_3 = 'W' where wr_id = '{$wr_id}'";
    //sql_query($sql);
    alert("현재 등록 마감되었습니다.");
}