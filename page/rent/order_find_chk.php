<?php
include_once ("../../common.php");
$order_name = $_REQUEST["order_name"];
$order_number = $_REQUEST["order_number"];
$order_pass = $_REQUEST["order_pass"];

$chk = sql_fetch("select * from `order_form` where order_user_name = '{$order_name}' and order_number = '{$order_number}' and order_pass = PASSWORD('{$order_pass}')");

if(count($chk)==0){
    alert("주문정보를 다시 한 번 확인해 주세요!",G5_URL."/page/rent/order_find.php");
}else{
    goto_url(G5_URL."/page/mypage/order_view.php?order_id=".$chk["order_id"]);
}