<?php
include_once ("../../common.php");
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 2017-07-17
 * Time: 오전 10:32
 */
$mb_id          = isset($_member["mb_id"])          ? trim($_member["mb_id"])        : "";
$shop_name      = isset($_POST['shop_name'])        ? trim($_POST['shop_name'])      : "";
$shop_hp        = isset($_POST['shop_hp'])          ? trim($_POST['shop_hp'])        : "";
$shop_zip       = isset($_POST['shop_zip1'])         ? trim($_POST['shop_zip1'])       : "";
$shop_addr1     = isset($_POST['shop_addr1'])       ? trim($_POST['shop_addr1'])     : "";
$shop_addr2     = isset($_POST['shop_addr2'])       ? trim($_POST['shop_addr2'])     : "";
$shop_cate      = isset($_POST['shop_cate'])        ? trim($_POST['shop_cate'])      : "";
$shop_number    = isset($_POST['shop_number'])      ? trim($_POST['shop_number'])    : "";
$shop_homepage  = isset($_POST['shop_homepage'])      ? trim($_POST['shop_homepage'])    : "";
$shop_bank      = isset($_FILES['shop_bank'])       ? $_FILES['shop_bank']['tmp_name']           : "";
$shop_marketing = isset($_FILES['shop_marketing'])  ? $_FILES['shop_marketing']['tmp_name']      : "";

$mb_dir = G5_DATA_PATH.'/member/'.substr($mb_id,0,2);
@mkdir($mb_dir, G5_DIR_PERMISSION);
@chmod($mb_dir, G5_DIR_PERMISSION);
$filename1=time()."_store_bank.jpg";
$filename2=time()."_store_marketing.jpg";
$path1=$mb_dir."/".$filename1;
$path2=$mb_dir."/".$filename2;

if($_FILES['shop_bank']['tmp_name']){
    image_resize_update($_FILES['shop_bank']['tmp_name'],$_FILES['shop_bank']['name'], $path1, 1100);
    $banner_sql=",`store_bank`='".$filename1."'";
}
if($_FILES['shop_marketing']['tmp_name']){
    image_resize_update($_FILES['shop_marketing']['tmp_name'],$_FILES['shop_marketing']['name'], $path2, 1100);
    $content_sql=",`store_marketing`='".$filename2."'";
}

$store_sql = "insert into `store_temp` 
                              set mb_id = '{$mb_id}',
                                  store_name = '{$shop_name}',
                                  store_hp = '{$shop_hp}',
                                  store_zip = '{$shop_zip}',
                                  store_addr1 = '{$shop_addr1}',
                                  store_addr2 = '{$shop_addr2}',
                                  store_cate = '{$shop_cate}',
                                  store_number = '{$shop_number}',
                                  store_homepage = '{$shop_homepage}',
                                  store_date = now()
                                  {$banner_sql} {$content_sql}";
sql_query($store_sql);

