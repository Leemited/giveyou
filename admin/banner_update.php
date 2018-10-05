<?php
include_once("../common.php");
$id=$_POST['id'];
$partner=sql_fetch("select * from `best_partner` where id='".$id."'");
if(!$is_admin && $partner['mb_id']!=$member['mb_id']){
    alert("권한이 없습니다.");
}
$page=$_POST['page'];
$name=$_POST['name'];
$tel=$_POST['tel'];
$mb_id=$_POST['mb_id'];
$content=$_REQUEST['content'];
$show=$_POST['show']?1:0;
$dir=G5_DATA_PATH."/partner";
@mkdir($dir, G5_DIR_PERMISSION);
@chmod($dir, G5_DIR_PERMISSION);
$filename1=time()."_partner_banner.jpg";
//$filename2=time()."_partner_content.jpg";
$path1=$dir."/".$filename1;
//$path2=$dir."/".$filename2;
if($_FILES['banner']['tmp_name']){
    image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1, 1100);
    $banner=$filename1;
    $banner_sql=",`banner`='".$filename1."'";
    @unlink($dir."/".$partner['banner']);
}

if($is_admin){
    $admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
}
if($id){
	$sql = "update `best_partner` set `name`='{$name}',`tel`='{$tel}', `content`='{$content}' {$admin_sql} {$content_sql} {$banner_sql} where `id`='{$id}';";
	//echo $sql;
    sql_query($sql);
}else{
	$sql = "insert into `best_partner` (`name`,`tel`,`banner`,`content`,`mb_id`,`show`) values('{$name}','{$tel}','{$banner}','{$content}','{$mb_id}','{$show}');";
	//echo $sql;
    sql_query($sql);
}
alert('저장되었습니다.',G5_URL."/admin/banner_list.php?page=".$page);