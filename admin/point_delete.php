<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	
	sql_query("delete from `{$g5['point_table']}` where po_id='{$id}'");	
	alert("삭제 되었습니다.");