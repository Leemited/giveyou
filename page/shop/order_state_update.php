<?php
include_once ("../../common.php");
include_once (G5_EXTEND_PATH."/gcm.extend.php");
require_once G5_PATH.'/vendor/mashape/unirest-php/src/Unirest.php';

$state = $_REQUEST["delivery_state"];
$order_id = $_REQUEST["order_id"];
$time = $_REQUEST["time"];

$shop= sql_fetch("select * from `order_form` where order_id='{$order_id}'");
$mem = sql_fetch("select * from `g5_member` where mb_id = '{$shop['mb_id']}'");
//배달처리
if($state == 10){
    $sql = "update `order_form` set delivery_state = 1 where order_id = '{$order_id}'";
    $push_msg = "주문하신 음식이 배달 출발하였습니다. ♬";
    send_GCM($mem["regid"],"기뷰 안내",$push_msg, G5_URL."/page/mypage/order_list.php");
}else if($state == 0){
    $sql = "update `order_form` set delivery_state = 1 where order_id = '{$order_id}'";
    $push_msg = "주문하신 음식이 배달 출발하였습니다. ♬";
    send_GCM($mem["regid"],"기뷰 안내",$push_msg,G5_URL."/page/mypage/order_list.php");

    $response = Unirest\Request::post("http://api.apistore.co.kr/kko/1/msg/tecooni",
        array(
            "x-waple-authorization" => "ODY2NC0xNTI5OTc4NzY1NjYzLTY5MDQ1ZjM3LTE2NzItNGM5YS04NDVmLTM3MTY3MmNjOWEyNA=="
        ),
        array(
            phone => $phone ,
            callback => $callback ,
            reqdate => "" ,
            msg => "주문하신 음식이 배송 출발하였습니다.
잠시만 기다리시면 맛있는 음식이 도착합니다.
최대한 신속하고 안전에 유의하여 배달해 드리겠습니다." ,
            template_code => "store2" ,
            failed_type => "LMS" ,
            url => "" ,
            url_button_txt => "" ,
            failed_subject => "기뷰알림톡" ,
            failed_msg => "알림톡실패" ,
            apiVersion => "1" ,
            client_id => "tecooni" ,
            btn_types => "" ,
            btn_txts => "" ,
            btn_urls1 => "" ,
            btn_urls2 => ""   )
    );
}else if($state == 1){//완료
    $sql = "update `order_form` set delivery_state = 2 where order_id = '{$order_id}'";
}else if($state == 2){//정산처리
    $sql = "update `order_form` set delivery_state = 3 where order_id = '{$order_id}'";
}

sql_query($sql);

alert("처리되었습니다." , G5_URL."/page/shop/");