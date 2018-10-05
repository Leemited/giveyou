<?php
include_once ("../../common.php");
$wr_parent = $_REQUEST["wr_id"];
$wr_id = $_REQUEST["comment_id"];
$mb_id = $member["mb_id"];

$sql = "select * from `g5_write_main` where wr_id = '{$wr_id}' and mb_id = '{$mb_id}'";
$cmt = sql_fetch($sql);

$sql = "delete from `g5_write_main` where wr_id = '{$wr_id}' and mb_id = '{$mb_id}'";
sql_query($sql);

// 원글 댓글 카운트 밑 별점 감소
$sql = "update `g5_write_main` set wr_4=wr_4-{$cmt['wr_4']} , wr_comment = wr_comment - 1 where wr_id = '{$wr_parent}'";
sql_query($sql);

$sql = "update `g5_borad` set bo_count_comment = bo_count_comment - 1 where bo_table = 'main'";
sql_query($sql);

goto_url(G5_URL."/page/mypage/index.php?tab=review");
?>