<?php
/**
 * Created by PhpStorm.
 * User: leemited
 * Date: 2018-07-12
 * Time: 오후 1:22
 */
include_once("./common.php");
require_once G5_PATH.'/vendor/mashape/unirest-php/src/Unirest.php'; 
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
    phone => "01044409465" ,
    callback => "01044409465" , 
    reqdate => "" , 
    msg => "기뷰를 이용해 주셔서 감사합니다. 
언제나 행복하고 좋은일만 가득하길 바랍니다. 
주문하신 음식은 40분 소요 됩니다." , 
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
?>