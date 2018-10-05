<?php
include_once ("../common.php");
$latitude = $_REQUEST['lat'];
$longitude = $_REQUEST['lng'];
$wr_id = $_REQUEST["wr_id"];
$detail_id = $_REQUEST["detail_id"];
$store_hp = hyphen_hp_number($_REQUEST["store_hp"]);
$store_zip = $_REQUEST["store_zip"];
$store_addr1 = $_REQUEST["store_addr1"];
$store_addr2 = $_REQUEST["store_addr2"];
$jibun_addr1 = $_REQUEST["store_zip2"];
$jibun_addr2 = $_REQUEST["store_addr3"];
$open_time = $_REQUEST["open_t"].":".$_REQUEST["open_m"];
$close_time = $_REQUEST["close_t"].":".$_REQUEST["close_m"];
$store_holiday = $_REQUEST["store_holiy"];
$store_content = $_REQUEST["store_content"];
$delivery = $_REQUEST["store_delivery"];
$delivery_loc = $_REQUEST["store_delivery_location"];
$delivery_price = $_REQUEST["store_delivery_price"];
$order_type = $_REQUEST["order_type"];
$point = $_REQUEST["point"];
$other = $_REQUEST["store_reserve"];
$store_homepage = $_REQUEST["store_homepage"];
$store_smoke = $_REQUEST["store_smoke"];
$store_parking = $_REQUEST["store_parking"];
$store_oring = $_REQUEST["store_oring"];
$etc1 = $_REQUEST["etc1"];
$etc2 = $_REQUEST["etc2"];
$video_link= $_REQUEST["video_link"];

$etc3 = $_FILES["etc3"]["name"];
$ext = array_pop(explode(".",$etc3));

$sql = "select etc3 from `store_detail` where `detail_id` = '{$detail_id}'";
$etcchk = sql_fetch($sql);

$dir=G5_DATA_PATH."/shop";
@mkdir($dir, G5_DIR_PERMISSION);
@chmod($dir, G5_DIR_PERMISSION);
$filename1=time()."_etc3.".$ext;
$path1=$dir."/".$filename1;
if($_FILES['etc3']['tmp_name']){
    image_resize_update($_FILES['etc3']['tmp_name'],$_FILES['etc3']['name'], $path1, 1100);
    $photo=$filename1;
    $photo_sql=",`etc3`='".$filename1."'";
    if($detail_id){
        @unlink($dir."/".$etcchk['etc3']);
    }
}
if(!$detail_id) {
    $sql = "insert into `store_detail` set `store_percent` = '{$store_percent}', `give_percent`= '{$give_percent}',`delivery` = '{$delivery}', `delivery_location` = '{$delivery_loc}', `delivery_price` = '{$delivery_price}', `order_type` = '{$order_type}', `point` = '{$point}', `other` = '{$other}', `smoke_area` = '{$store_smoke}', `parking` = '{$store_parking}', `oring_mark` = '{$store_oring}', `etc1` = '{$etc1}', `etc2` = '{$etc2}', `open_time` = '{$open_time}', `close_time` = '{$close_time}', `holiday` = '{$store_holiday}', `store_hp` = '{$store_hp}', `store_zip` = '{$store_zip}', `store_addr1` = '{$store_addr1}', `store_addr2` = '{$store_addr2}', `store_detail` = '{$store_content}', `store_homepage` = '{$store_homepage}', `jibun_zip` = '{$jibun_addr1}', `jibun_address` = '{$jibun_addr2}' ,`latitude`='{$latitude}',`longitude`='{$longitude}', wr_id = '{$wr_id}' {$photo_sql}";
}else {
    $sql = "UPDATE `store_detail` SET `store_percent` = '{$store_percent}', `give_percent`= '{$give_percent}',`delivery` = '{$delivery}', `delivery_location` = '{$delivery_loc}', `delivery_price` = '{$delivery_price}', `order_type` = '{$order_type}', `point` = '{$point}', `other` = '{$other}', `smoke_area` = '{$store_smoke}', `parking` = '{$store_parking}', `oring_mark` = '{$store_oring}', `etc1` = '{$etc1}', `etc2` = '{$etc2}', `open_time` = '{$open_time}', `close_time` = '{$close_time}', `holiday` = '{$store_holiday}', `store_hp` = '{$store_hp}', `store_zip` = '{$store_zip}', `store_addr1` = '{$store_addr1}', `store_addr2` = '{$store_addr2}', `store_detail` = '{$store_content}', `store_homepage` = '{$store_homepage}', `jibun_zip` = '{$jibun_addr1}', `jibun_address` = '{$jibun_addr2}' ,`latitude`='{$latitude}',`longitude`='{$longitude}' {$photo_sql} WHERE `detail_id` = '{$detail_id}'";
}
sql_query($sql);

alert("수정되었습니다.", G5_URL."/admin/my_store_detail_form.php?wr_id=".$wr_id);