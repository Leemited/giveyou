<?php
	include_once("../common.php");
	$id = $_REQUEST["id"];
	$sql="delete from `g5_write_inquiry` where wr_id=".$id;
	echo $sql;
	sql_query($sql);
	alert("삭제 되었습니다.");