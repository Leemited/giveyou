<?php
	include_once("../../common.php");
	$off=1;
	if($member['off_gcm']){
		$off=0;
	}
	sql_query("update `g5_member` set off_gcm='{$off}' where mb_no='{$member['mb_no']}'");
	alert("저장되었습니다.");
?>