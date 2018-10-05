<?php
include_once("../common.php");
$id=$_POST['id'];
$partner=sql_fetch("select * from `banner_list` where id='".$id."'");
$banner_row=sql_query("select * from `banner_list` where `seq`='{$seq}'");
while($data1=sql_fetch_array($banner_row)){
    $check[] = $data1;    
}
if(!$is_admin && $partner['mb_id']!=$member['mb_id']){
    alert("권한이 없습니다.");
}
if(count($check)>=2){
    if( $check[1]['seq_time']<$check[0]['seq_time1'] ){
        alert('노출 날짜가 중복되었습니다.');
        return false;
    }
}
$page=$_POST['page'];
$name=$_POST['name'];
$tel=$_POST['tel'];
$seq=$_POST['seq'];
$datetime=date('Y-m-d');
$seq_time=$_POST['seq_time'];
$seq_time1=$_POST['seq_time1'];
$mb_id=$_POST['mb_id'];
$show=$_POST['show']?1:0;
$dir=G5_DATA_PATH."/partner";
@mkdir($dir, G5_DIR_PERMISSION);
@chmod($dir, G5_DIR_PERMISSION);
$filename1=time()."_partner_banner.jpg";
$filename2=time()."_partner_content.jpg";
$path1=$dir."/".$filename1;
$path2=$dir."/".$filename2;
if($_FILES['banner']['tmp_name']){
    image_resize_update($_FILES['banner']['tmp_name'],$_FILES['banner']['name'], $path1, 1100);
    $banner=$filename1;
    $banner_sql=",`banner`='".$filename1."'";
    @unlink($dir."/".$partner['banner']);
}
if($_FILES['content']['tmp_name']){
    image_resize_update($_FILES['content']['tmp_name'],$_FILES['content']['name'], $path2, 1100);
    $content=$filename2;
    $content_sql=",`content`='".$filename2."'";
    @unlink($dir."/".$partner['content']);
}
if($is_admin){
    $admin_sql=",`mb_id`='{$mb_id}' ,`show`='{$show}'";
}
if($id){
    sql_query("update `banner_list` set `seq`='{$seq}',`seq_time`='{$seq_time}',`seq_time1`='{$seq_time1}', `name`='{$name}',`tel`='{$tel}' {$admin_sql} {$content_sql} {$banner_sql} where `id`='{$id}';");
}else{
    sql_query("insert into `banner_list` (`seq`,`seq_time`,`seq_time1`,`name`,`tel`,`banner`,`content`,`mb_id`,`show`,`datetime`) values('{$seq}','{$seq_time}','{$seq_time1}','{$name}','{$tel}','{$banner}','{$content}','{$mb_id}','{$show}','{$datetime}');");
}
alert('저장되었습니다.',G5_URL."/admin/list_list.php?page=".$page);