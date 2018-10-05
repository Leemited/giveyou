<?php
include_once ("../../common.php");

if($cart_id == ""){
    $result = array("msgs" => "주문할 상품이 없습니다. \\n다시 확인해 주세요.");
    echo $result;
    return false;
}

if($mb_id == ""){
    $mb_id = $_COOKIE["PHPSESSID"];
}


$year = date("Y");
$month = date("m");
$day = date("d");

$deli_addrs = explode(" ",$deli_addr);

/*$sql = "select count(*) as cnt from `order_form_temp` wher mb_id = '{$mb_id}' and cart_id = '{$cart_id}' and wr_id = '{$wr_id}' and order_menu = '{$menu_name}' and order_year = '{$year}' and order_month = '{$month}' and order_day = '{$day}'";
$chk_temp = sql_fetch($sql);*/

//if($chk_temp["cnt"] == 0){
$sql = "insert into `order_form_temp` set 
            order_number = '{$order_number}',
            cart_id = '{$cart_id}',
            wr_id='{$wr_id}',
            mb_id='{$mb_id}',
            order_date= now(),
            order_year='{$year}',
            order_month='{$month}',
            order_day='{$day}',
            order_menu='{$menu_name}',
            order_count='{$menu_count}',
            order_price='{$menu_price}',
            order_option='{$menu_option}',
            order_option_price='{$menu_option_price}',
            order_user_name='{$name}',
            order_user_phone='{$tel}',
            order_user_email='{$email}',
            order_recive_name='{$deli_name}',
            order_recive_phone='{$deli_tel}',
            order_recive_email='',
            order_recive_zipcode='{$deli_postcode}',
            order_recive_addr1='{$deli_addrs[0]}',
            order_recive_addr2='{$deli_addrs[1]}',
            order_recive_message='{$deli_msg}',
            order_type1='{$order_type}',
            order_type2='{$order_type2}',
            order_state='0',
            delivery_state='0',
            order_total_price='{$order_total}',
            use_point = '{$use_point}',
            order_pass=PASSWORD('{$order_pw}')";
//}
if(sql_query($sql)){
    $result = array("msg" => 1, "order_number" => $order_number);
    echo json_encode($result);
}else{
    $result = array("msg" => 2);
    echo json_encode($result);
}