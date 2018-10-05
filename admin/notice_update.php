<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$trainer=sql_fetch("select * from `g5_write_notice` where wr_id='".$id."'");
	if(!$is_admin && $trainer['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$wr_subject=$_POST['wr_subject'];
    $wr_content=$_POST['wr_content'];
    $wr_name=$member['mb_name'];
    $datetime = G5_TIME_YMDHIS;
    $wr_ip = $_SERVER['REMOTE_ADDR'];
    
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
        $wr_name=$member['mb_name'];
	}
    
	if($id){
		sql_query("update `g5_write_notice` set `wr_subject`='{$wr_subject}',`wr_content`='{$wr_content}',`wr_name`='{$wr_name}',`wr_last`= '{$datetime}' where `wr_id`='{$id}';");
	}else{
		sql_query("insert into `g5_write_notice` (`wr_subject`,`wr_content`,`wr_name`,`wr_parent`,`wr_datetime`,`mb_id`,`wr_ip`) values('{$wr_subject}','{$wr_content}','{$wr_name}','{$id}','{$datetime}','{$mb_id}','{$wr_ip}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/notice_list.php?page=".$page);
