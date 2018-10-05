<?php
	include_once("../common.php");
	$id=$_POST['id'];
	$model=sql_fetch("select * from `best_partner` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];
	$name=$_POST['name'];
	$day_pay=$_POST['day_pay'];
	$hour_pay=$_POST['hour_pay'];
	$pick_pay=$_POST['pick_pay'];
	$fuel=$_POST['fuel'];
	$mileage=$_POST['mileage'];
	$seater=$_POST['seater'];
	$gear=$_POST['gear'];
	$year=$_POST['year'];
	$displacement=$_POST['displacement'];
	$color=$_POST['color'];
	$option=$_POST['option'];
	$type=$_POST['type'];
	$condition=$_POST['condition'];
	$content=nl2br($_POST['content']);
	$dir=G5_DATA_PATH."/model";
	@mkdir($dir, G5_DIR_PERMISSION);
	@chmod($dir, G5_DIR_PERMISSION);
	$filename1=time()."_model.jpg";
	$path1=$dir."/".$filename1;
	if($_FILES['photo']['tmp_name']){
		image_resize_update($_FILES['photo']['tmp_name'],$_FILES['photo']['name'], $path1, 1100);
		$photo=$filename1;
		$photo_sql=",`photo`='".$filename1."'";
		if($id){
			@unlink($dir."/".$model['photo']);
		}
	}
	if($id){
		sql_query("update `best_model` set `name`='{$name}',`day_pay`='{$day_pay}',`day_pay3`='{$day_pay3}',`day_pay5`='{$day_pay5}',`day_pay7`='{$day_pay7}',`hour_pay`='{$hour_pay}',`pick_pay`='{$pick_pay}',`fuel`='{$fuel}',`mileage`='{$mileage}',`seater`='{$seater}',`gear`='{$gear}',`year`='{$year}',`displacement`='{$displacement}',`option`='{$option}',`type`='{$type}',`condition`='{$condition}',`content`='{$content}',`color`='{$color}' {$photo_sql} where `id`='{$id}';");
	}else{
		sql_query("insert into `best_model` (`photo`,`name`,`day_pay`,`day_pay3`,`day_pay5`,`day_pay7`,`hour_pay`,`pick_pay`,`fuel`,`mileage`,`seater`,`gear`,`year`,`displacement`,`color`,`option`,`type`,`content`,`condition`) values('{$photo}','{$name}','{$day_pay}','{$day_pay3}','{$day_pay5}','{$day_pay7}','{$hour_pay}','{$pick_pay}','{$fuel}','{$mileage}','{$seater}','{$gear}','{$year}','{$displacement}','{$color}','{$option}','{$type}','{$content}','{$condition}');");
	}
	alert('저장되었습니다.',G5_URL."/admin/model_list.php?page=".$page);