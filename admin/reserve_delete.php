<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	sql_query("delete from best_reserve where id='{$id}'");
	alert('삭제 되었습니다.');