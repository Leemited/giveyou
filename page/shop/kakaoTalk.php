<?php
include_once("../../common.php");
include_once (G5_EXTEND_PATH."/gcm.extend.php");
require_once G5_PATH.'/vendor/mashape/unirest-php/src/Unirest.php';

$phone = $_REQUEST["user_phone"];
$callback = $_REQUEST["store_phone"];
$delivery_time = $_REQUEST["deli_time"];

$shop= sql_fetch("select * from `order_form` where order_id='{$order_id}'");
$mem = sql_fetch("select * from `g5_member` where mb_id = '{$shop['mb_id']}'");

if(!$phone){
    alert("연락처 정보가 없어 알림을 보낼 수 없습니다.");
    return false;
}
if(!$callback){
    $callback = "01044409465";
    /*alert("상점관리자 전화번호가 필요합니다.");
    return false;*/
}


$response = Unirest\Request::post("http://api.apistore.co.kr/kko/1/msg/tecooni",
    array(
        "x-waple-authorization" => "ODY2NC0xNTI5OTc4NzY1NjYzLTY5MDQ1ZjM3LTE2NzItNGM5YS04NDVmLTM3MTY3MmNjOWEyNA=="
    ),
    array(
        phone => $phone ,
        callback => $callback ,
        reqdate => "" ,
        msg => "기뷰를 이용해 주셔서 감사합니다. 
언제나 행복하고 좋은일만 가득하길 바랍니다. 
주문하신 음식은 {$delivery_time}분 소요 됩니다." ,
        template_code => "store" ,
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

send_GCM($mem["regid"],"기뷰 안내","주문하신 음식이 {$delivery_time} 후 도착 예정입니다.",G5_URL."/page/mypage/order_list.php");

alert("전송 완료 되었습니다.",G5_URL."/page/shop/");
?>