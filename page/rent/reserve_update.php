<?php
	include_once("../../common.php");
	$page=$_POST['page'];
	$status=$_POST['status'];
	$type=$_POST['type'];
	$start_date=$_POST['start_date'];
	$start_hour=$_POST['start_hour'];
	$start_min=$_POST['start_min'];
	$start=$start_date." ".$start_hour.":00";
	$end_date=$_POST['end_date'];
	$end_hour=$_POST['end_hour'];
	$end_min=$_POST['end_min'];
	$end=$end_date." ".$end_hour.":00";
	$range=$_POST['range'];
	$pick=$_POST['pick'];
	$rental_point=$_POST['rental_point']=="픽업 서비스"?$_POST['rental_point']." ".$pick:$_POST['rental_point'];
	$return_point=$_POST['return_point'];
	$mb_id=$_POST['mb_id'];
	$mb_name=$_POST['mb_name'];
	$mb_email=$_POST['mb_email'];
	$mb_phone=$_POST['mb_phone'];
	$model=$_POST['model'];
	$etc=nl2br($_POST['etc']);
	$price=$_POST['price'];
	$mb_1=$_POST['mb_1'];
	if($is_member &&(!$member['mb_email'] && $mb_email) || (!$member['mb_name'] && $mb_name || $mb_1)){
		sql_query("update `best_member` set `mb_email`='{$mb_email}', `mb_name`='{$mb_name}', `mb_1`='{$mb_1}' where mb_id='{$member['mb_id']}'");
	}
	sql_query("insert into `best_reserve` (`type`,`start`,`end`,`range`,`rental_point`,`return_point`,`mb_id`,`mb_name`,`mb_email`,`mb_phone`,`etc`,`price`,`status`,`datetime`,`model`,`year`) values('{$type}','{$start}','{$end}','{$range}','{$rental_point}','{$return_point}','{$mb_id}','{$mb_name}','{$mb_email}','{$mb_phone}','{$etc}','{$price}','0',NOW(),'{$model}','{$mb_1}');");
	$id=mysql_insert_id();
	$model_data=sql_fetch("select * from best_model where `id`='{$model}'");
	send_reserve_GCM("베스트 렌트카 예약 요청","베스트 렌트카 예약 요청");
	if($member['regid'] && !$member['off_gcm']){
		send_GCM($member['regid'],"베스트 렌트카","예약 요청이 완료되었습니다. 1시간 이내에 연락드리겠습니다.");
	}
	alert('예약 되었습니다.',G5_URL."/page/rent/reserve_result.php?id=".$id);