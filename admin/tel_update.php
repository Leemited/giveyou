<?php
	include_once("../common.php");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$hour1=$_POST['hour1'];
	$min1=$_POST['min1'];
	$time1=$hour1.":".$min1;
	$hour2=$_POST['hour2'];
	$min2=$_POST['min2'];
	$time2=$hour2.":".$min2;
	$all=$_POST['all']?1:0;
	$tel=$_POST['tel'];
	$accident=$_POST['accident'];
	$accident2=$_POST['accident2'];
	sql_query("update `best_tel` set `time1`='{$time1}',`time2`='{$time2}',`all`='{$all}',`tel`='{$tel}',`accident`='{$accident}',`accident2`='{$accident2}';");
	alert('저장되었습니다.');