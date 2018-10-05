<?php
include_once ("../../common.php");
include_once (G5_EXTEND_PATH."/gcm.extend.php");

if($order_number == ""){
    $msg = "주문정보가 잘못 되었습니다.";
    return false;
}

$sql = "select * from `order_form_temp`  where order_number = '{$order_number}' ";
$order = sql_fetch($sql);

$year = date("Y");
$month = date("m");
$day = date("d");

$sql = "insert into `order_form` set 
            order_number = '{$order_number}',
            cart_id = '{$order["cart_id"]}',
            wr_id='{$order["wr_id"]}',
            mb_id='{$order["mb_id"]}',
            order_date= now(),
            order_year='{$year}',
            order_month='{$month}',
            order_day='{$day}',
            order_menu='{$order["order_menu"]}',
            order_count='{$order["order_count"]}',
            order_price='{$order["order_price"]}',
            order_option='{$order["order_option"]}',
            order_option_price='{$order["order_option_price"]}',
            order_user_name='{$order["order_user_name"]}',
            order_user_phone='{$order["order_user_phone"]}',
            order_user_email='{$order["order_user_email"]}',
            order_recive_name='{$order["order_recive_name"]}',
            order_recive_phone='{$order["order_recive_phone"]}',
            order_recive_email='{$order["order_recive_email"]}',
            order_recive_zipcode='{$order["order_recive_zipcode"]}',
            order_recive_addr1='{$order["order_recive_addr1"]}',
            order_recive_addr2='{$order["order_recive_addr2"]}',
            order_recive_message='{$order["order_recive_message"]}',
            order_type1='{$order["order_type1"]}',
            order_type2='{$order["order_type2"]}',
            order_state='1',
            delivery_state='0',
            order_total_price='{$order["order_total_price"]}',
            use_point = '{$order["use_point"]}',
            order_pass='{$order["order_pass"]}',
            imp_uid = '{$iam_uid}',
            merchant_uid = '{$merchant_uid}',
            paid_amount = '{$paid_amount}',
            apply_num = '{$apply_num}'";
if(sql_query($sql)){
    $sql = "update `cart` set cart_state = 1 where cart_id in ({$order["cart_id"]})";
    sql_query($sql);

    $store = sql_fetch("select m.*,s.* from `g5_write_main` as m left join `g5_member` as s on m.mb_id = s.mb_id where m.wr_id in ('{$order["wr_id"]}')");
    if($order["use_point"]==0) {
        $userpoint = $total_price * 1 / 100;
        insert_point($member["mb_id"],$userpoint);
    }
    $storepoint = $total_price * 4 / 100;
    //구매포인트
    insert_point($store["mb_id"],$storepoint);

    //주문정보 푸쉬보내기 (상점)
    send_GCM($store["regid"],"기뷰 주문","주문요청이 들어왔습니다.","http://giveyou.kr/page/shop/index.php");

    echo "1";
}else{
    echo "2";
}


