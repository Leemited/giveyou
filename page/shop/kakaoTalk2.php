<?php
include_once("../common.php");
require_once G5_PATH.'/vendor/mashape/unirest-php/src/Unirest.php';

$phone = $_REQUEST["user_phone"];
$callback = $_REQUEST["store_phone"];
$delivery_time = $_REQUEST["deli_time"];

$response = Unirest\Request::post("http://api.apistore.co.kr/kko/1/msg/tecooni",
    array(
        "x-waple-authorization" => "ODY2NC0xNTI5OTc4NzY1NjYzLTY5MDQ1ZjM3LTE2NzItNGM5YS04NDVmLTM3MTY3MmNjOWEyNA=="
    ),/*
  array(
	"sendnumber" => "07088514868",
	"comment" => "기뷰",
	"pintype" => "SMS"
  ),*/
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

?>