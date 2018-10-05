<?php
include_once("../../common.php");
$type = $_REQUEST["type"];
$menu_name = $_REQUEST["menu_name"];
$wr_id = $_REQUEST["wr_id"];
$mb_id = $_REQUEST["mb_id"];
if(!$mb_id && $member["mb_id"]){
    $mb_id = $member["mb_id"];
}else if (!$mb_id && !$member["mb_id"]){
    $mb_id = $_COOKIE["PHPSESSID"];
}

$menu_price = $_REQUEST["menu_price"];
$menu_option = explode("/",$_REQUEST["menu_option"]);
$num = $_REQUEST["num"];


$sql = "insert into `cart` (wr_id,mb_id,menu_name,menu_price,menu_count,menu_option,option_price,cart_date) VALUES ('{$wr_id}','{$mb_id}','{$menu_name}','{$menu_price}','{$num}','{$menu_option[0]}','{$menu_option[1]}',now())";

sql_query($sql);

$sql = "select * from `cart` where mb_id = '{$mb_id}' and wr_id = '{$wr_id}' order by cart_date asc limit 0,1";

$cart_ids = sql_fetch($sql);

echo $cart_ids["cart_id"];