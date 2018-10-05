<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$branch=sql_fetch("select * from `best_branch` where id='".$id."'");
	if(!$is_admin && $branch['mb_id']!=$member['mb_id']){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
	$tel=$_POST['tel'];
	$mb_id=$_POST['mb_id'];
	$addr1=$_POST['addr1'];
	$addr2=$_POST['addr2'];
	if($is_admin){
		$admin_sql=",`mb_id`='{$mb_id}'";
	}
	if($id){
		sql_query("update `best_branch` set `name`='{$name}',`tel`='{$tel}',`addr1`='{$addr1}',`addr2`='{$addr2}' {$admin_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `best_branch` (`name`,`tel`,`mb_id`,`addr1`,`addr2`) values('{$name}','{$tel}','{$mb_id}','{$addr1}','{$addr2}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/branch_list.php?page=".$page);