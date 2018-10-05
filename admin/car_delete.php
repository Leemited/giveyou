<?php
	include_once("../common.php");
	$car=sql_fetch("select * from `best_car` where id='".$id."'");
	$branch_data=sql_fetch("select * from `best_branch` where id='".$car['branch']."'");
	if(!$is_admin && $branch_data['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	sql_query("delete from `best_car` where id='{$id}'");
	alert("삭제 되었습니다.");