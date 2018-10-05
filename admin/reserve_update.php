<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$page=$_POST['page'];
	$status=$_POST['status'];
	$type=$_POST['type'];
	$start_date=$_POST['start_date'];
	$start_hour=$_POST['start_hour'];
	$start_min=$_POST['start_min'];
	$start=$start_date." ".$start_hour.":".$start_min;
	$end_date=$_POST['end_date'];
	$end_hour=$_POST['end_hour'];
	$end_min=$_POST['end_min'];
	$end=$end_date." ".$end_hour.":".$end_min;
	$range=$_POST['range'];
	$pick=$_POST['pick'];
	$rental_point=$_POST['rental_point']=="픽업 서비스"?$_POST['rental_point']." ".$pick:$_POST['rental_point'];
	$return_point=$_POST['return_point'];
	$mb_id=$_POST['mb_id'];
	$mb_name=$_POST['mb_name'];
	$mb_phone=$_POST['mb_phone'];
	$model=$_POST['model'];
	$mb_email=$_POST['mb_email'];
	$etc=nl2br($_POST['etc']);
	$price=$_POST['price'];
	if($id){
		$reserve=sql_fetch("select * from `best_reserve` where id='".$id."'");
		$branch_data=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");
		$car=sql_fetch("select * from `best_car` where id='".$reserve['car']."'");
		if(!$is_admin && $branch_data['id']!=$car['branch'] && $branch_data['name']!=$rental_point){
			alert("권한이 없습니다.");
		}
	}
	if($id){
		sql_query("update `best_reserve` set `type`='{$type}',`start`='{$start}',`end`='{$end}',`range`='{$range}',`rental_point`='{$rental_point}',`return_point`='{$return_point}',`mb_id`='{$mb_id}',`mb_name`='{$mb_name}',`mb_email`='{$mb_email}',`mb_phone`='{$mb_phone}',`etc`='{$etc}',`price`='{$price}',`status`='{$status}',`model`='{$model}' where id='{$id}';");
	}else{
		sql_query("insert into `best_reserve` (`type`,`start`,`end`,`range`,`rental_point`,`return_point`,`mb_id`,`mb_name`,`mb_email`,`mb_phone`,`etc`,`price`,`status`,`datetime`,`model`) values('{$type}','{$start}','{$end}','{$range}','{$rental_point}','{$return_point}','{$mb_id}','{$mb_name}','{$mb_email}','{$mb_phone}','{$etc}','{$price}','{$status}',NOW(),'{$model}');");
		$id=mysql_insert_id();
	}
	if($status==2 && (!$reserve['status'] || $reserve['status']!=$status) && $mb_id){
		$point=$price/100;
		sql_query("update `g5_member` set `mb_point`=`mb_point`+{$point} where mb_id='{$mb_id}'");
		sql_query("insert into `point_log` (`mb_id`,`point`,`datetime`,`re_id`) values('{$mb_id}','{$point}',now(),'{$id}')");
	}
	alert('저장되었습니다.',G5_URL."/admin/reserve_list.php?page=".$page);