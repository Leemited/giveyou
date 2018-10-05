<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$branch=sql_fetch("select * from `best_branch` where id='".$id."'");
	sql_query("delete from `best_branch` where id='{$id}'");
	sql_query("delete from `best_car` where branch='{$id}'");
	alert("삭제 되었습니다.");