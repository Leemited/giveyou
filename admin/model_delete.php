<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	if(!$wr_id){
		alert("잘못된 정보입니다.");
	}
	$dir=G5_DATA_PATH."/model";
	$model=sql_fetch("select * from `g5_write_main` where wr_id='".$wr_id."'");
	sql_query("delete from `g5_write_main` where wr_id='{$wr_id}'");
    sql_query("delete from `store_detail` where wr_id='{$wr_id}'");
	@unlink($dir."/".$model['photo']);
	alert("삭제 되었습니다.");