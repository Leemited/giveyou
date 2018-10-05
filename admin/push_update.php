<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$title=$_POST['title'];
	$content=$_POST['content'];
	sql_query("insert into `best_push` (`title`,`content`,`datetime`) values('{$title}','{$content}',now());");
	$msg=send_all_GCM($title,$content);
	@alert("푸시알람 보내기 완료 되었습니다.");
?>