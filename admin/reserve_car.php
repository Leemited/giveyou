<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$page=$_POST['page'];
	$car=$_POST['car'];
	$car_view=sql_fetch("select * from `best_car` where id='{$car}'");
	$branch_data=sql_fetch("select * from `best_branch` where id='".$car_view['branch']."'");
	if(!$is_admin && $branch_data['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	if($id){
		sql_query("update `best_reserve` set `car`='{$car}',`status`='1' where id='{$id}';");
	}else{
		alert("잘못된 접근입니다.");
	}
	alert('수정 되었습니다.');