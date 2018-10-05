<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$page=$_POST['page'];
	$model=$_POST['model'];
	$branch=$_POST['branch'];
	$number=$_POST['number'];
	$c_type=$_POST['c_type']?$_POST['c_type']:"단기대여";
	$branch_data=sql_fetch("select * from `best_branch` where id='".$branch."'");
	$car=sql_fetch("select * from `best_car` where id='".$id."'");
	if(!$is_admin && $branch_data['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	if($id){
		sql_query("update `best_car` set `model`='{$model}',`branch`='{$branch}',`number`='{$number}',`c_type`='{$c_type}' where `id`='{$id}';");
	}else{
		sql_query("insert into `best_car` (`model`,`branch`,`number`,`c_type`) values('{$model}','{$branch}','{$number}','{$c_type}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/car_list.php?page=".$page);