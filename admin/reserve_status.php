<?php
	include_once("../common.php");
	$reserve=sql_fetch("select * from `best_reserve` where id='".$id."'");
	$branch_data=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");
	$car=sql_fetch("select * from `best_car` where id='".$reserve['car']."'");
	if(!$is_admin && $branch_data['id']!=$car['branch'] && $branch_data['name']!=$reserve['rental_point']){
		alert("권한이 없습니다.");
	}
	if($s==2){
		if(!$reserve['end']){
			$end_sql=",`end`=now()";
		}
	}
	if($id){
		sql_query("update `best_reserve` set `status`='{$s}'{$end_sql} where id='{$id}';");
	}else{
		alert("잘못된 접근입니다.");
	}
	if($s==2 && $reserve['mb_id']){
		$point=($reserve['price']*0.01);
		sql_query("update `g5_member` set `mb_point`=`mb_point`+{$point} where mb_id='{$reserve['mb_id']}'");
		sql_query("insert into `point_log` (`mb_id`,`point`,`datetime`,`re_id`) values('{$reserve['mb_id']}','{$point}',now(),'{$id}')");
	}
	alert('수정 되었습니다.');
?>