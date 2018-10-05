<?php
include_once ("../common.php");

$wr_id = $_REQUEST['wr_id'];
$sql = "select * from `g5_write_main` where wr_id='{$wr_id}'";
$res = sql_fetch($sql);
$start_date = $res['wr_1'];
$end_date = $res['wr_2'];
// 등록된 배너 수 체크
$sql1 = "select * from `g5_write_main` where wr_1 BETWEEN '{$start_date}' and '{$end_date}' and wr_2 BETWEEN '{$start_date}' and '{$end_date}'";
$list = sql_query($sql);
$cnt = 0;
while($row = sql_fetch_array($list)){
    $cnt++;
}

// 등록된 배너 수 초과시 대기상태로
if($cnt < 5){
    sql_query("update `g5_write_main` set `wr_3`='Y' where `wr_id`='{$wr_id}';");      
    alert('승인되었습니다.',G5_URL."/admin/slide_list.php?page=".$page);
}else if($cnt >= 5){
    //$sql = "update `g5_write_main` set wr_1 = '{$start_date}', wr_2 = '{$end_date}', wr_3 = 'W' where wr_id = '{$wr_id}'";
    //sql_query($sql);
    alert("현재 등록 마감되었습니다.");
}
?>

