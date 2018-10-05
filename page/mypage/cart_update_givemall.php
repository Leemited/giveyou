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
$num = $_REQUEST["num"];
$total_price = $menu_price * $num;
$cart_id = $_REQUEST["cart_id"];


$sql = "select * from `cart` where cart_date = CURRENT_DATE and (mb_id = '{$mb_id}' or mb_id = '{$_COOKIE[PHPSESSID]}')  and cart_state=0";
$result = sql_query($sql);
$cnt = mysql_num_rows($result);
if($cnt!=0) {
	for ($i = 0; $row = sql_fetch_array($result); $i++) {
		if ($menu_name == $row["menu_name"]) {
			if (!$row["menu_option"]) {
				$sql = "update `cart` set menu_count = menu_count + {$num} where cart_id = {$row["cart_id"]}";
			} else if ($row["menu_option"] && $row["menu_option"] == $menu_option[0]) {
				$sql = "update `cart` set menu_count = menu_count + {$num} where cart_id = {$row["cart_id"]}";
			}
		}else{
			$sql = "insert into `cart` (wr_id,mb_id,menu_name,menu_price,menu_count,menu_option,option_price,cart_date) VALUES ('{$wr_id}','{$mb_id}','{$menu_name}','{$menu_price}','{$num}','{$menu_option[0]}','{$menu_option[1]}',now())";
		}
	}
}else{
	$sql = "insert into `cart` (wr_id,mb_id,menu_name,menu_price,menu_count,menu_option,option_price,cart_date) VALUES ('{$wr_id}','{$mb_id}','{$menu_name}','{$menu_price}','{$num}','{$menu_option[0]}','{$menu_option[1]}',now())";
}
sql_query($sql);
$count = sql_fetch("select count(cart_id)as cnt from `cart` where cart_date = CURRENT_DATE and (mb_id = '{$mb_id}' or mb_id = '{$_COOKIE[PHPSESSID]}') and cart_state=0");
