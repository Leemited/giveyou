<?php
include_once ("../../common.php");
include_once (G5_EXTEND_PATH."/gcm.extend.php");

print_r2($_REQUEST);

if($mb_id==""){
    $mb_id = $_COOKIE["PHPSESSID"];
}

if($order_name && $deli_name == "" || !$deli_name){
    $deli_name = $order_name;
}

if($mb_zip1 && $deli_postcode == "" || !$deli_postcode){
    $deli_postcode = $mb_zip1;
}
if($mb_addr1 && $deli_addr1 == "" || !$deli_addr1 ){
    $deli_addr1 = $mb_addr1;
}
if($mb_addr2 && $deli_addr2 == "" || !$deli_addr2){
    $deli_addr2 = $mb_addr2;
}

if($order_phone && $deli_tel == "" || !$deli_tel){
    $deli_tel = $order_phone;
}

if($order_email && $deli_email == "" || !$deli_email){
    $deli_email = $order_email;
}

$order_number = "ORDER_".date("Ymdhms");

$year = date("Y");
$month = date("m");
$day = date("d");


$sql = "insert into `order_form` set 
            order_number = '{$order_number}',
            cart_id = '{$order["cart_id"]}',
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
            order_user_name='{$order_name}',
            order_user_phone='{$order_phone}',
            order_user_email='{$order_email}',
            order_recive_name='{$deli_name}',
            order_recive_phone='{$deli_tel}',
            order_recive_email='{$deli_email}',
            order_recive_zipcode='{$deli_postcode}',
            order_recive_addr1='{$deli_addr1}',
            order_recive_addr2='{$deli_addr2}',
            order_recive_message='{$delivery_msg}',
            order_type1='만나서결제',
            order_type2='{$order_type2}',
            order_state='1',
            delivery_state='0',
            order_total_price='{$total_prices}',
            use_point = '{$mb_point}'";
if(sql_query($sql)) {
    $sql = "update `cart` set cart_state = 1 where cart_id in ({$cart_id})";
    sql_query($sql);

    $store = sql_fetch("select m.*,s.* from `g5_write_main` as m left join `g5_member` as s on m.mb_id = s.mb_id where m.wr_id in ('{$wr_id}')");
    if($order["use_point"]==0) {
        $userpoint = $total_price * 1 / 100;
        insert_point($member["mb_id"],$userpoint);
    }
    $storepoint = $total_price * 4 / 100;
    //구매포인트
    insert_point($store["mb_id"],$storepoint);

    //주문정보 푸쉬보내기 (상점)
    $result = send_GCM($store["regid"],"기뷰 주문","주문요청이 들어왔습니다.","http://giveyou.kr/page/shop/index.php");
    goto_url(G5_URL."/page/mypage/order_complete.php?order_number=".$order_number);
}else{
    alert("잘못된 요청입니다.");
}

/*
$sql = "insert into `order_form` set 
                  cart_id = '{$cart_id}', 
                  wr_id = '{$wr_id}', 
                  mb_id = '{$mb_id}',
                  order_number = '{$order_number}',
                  order_date = now(), 
                  order_menu = '{$menu_name}', 
                  order_count= '{$menu_count}', 
                  order_price = '{$menu_price}', 
                  order_option = '{$menu_option}', 
                  order_option_price = '{$menu_option_price}', 
                  order_user_name = '{$order_name}', 
                  order_user_phone = '{$order_phone}', 
                  order_recive_name = '{$delivery_name}', 
                  order_recive_phone = '{$delivery_phone}', 
                  order_recive_zipcode = '{$delivery_addr_code}', 
                  order_recive_addr1 = '{$delivery_addr_1}', 
                  order_recive_addr2 = '{$delivery_addr_2}', 
                  order_recive_message = '{$delivery_message}', 
                  order_type1 = '{$order_type}', 
                  order_type2 = '{$order_type1}', 
                  order_state = 1, 
                  order_total_price = '{$total_price}',
                  use_point = '{$use_point}',
                  order_pass = PASSWORD('{$order_pass}'),
                  order_year = '{$year}',
                  order_month = '{$month}',
                  order_day = '{$day}'
                  ";

if(sql_query($sql)){
    $sql = "update `cart` set cart_state = 1  where cart_id in ({$cart_id})";
    sql_query($sql);

    //상점 정보 가져오기
    $store = sql_fetch("select m.*,s.* from `g5_write_main` as m left join `g5_member` as s on m.mb_id = s.mb_id where m.wr_id = '{$wr_id}'");
    $userpoint = $total_price * 1 / 100;
    $storepoint = $total_price * 4 / 100;
    //구매포인트
    insert_point($member["mb_id"],$userpoint);
    insert_point($store["mb_id"],$storepoint);


    //주문정보 푸쉬보내기 (상점)
    send_GCM($store["regid"],"기뷰 주문","주문요청이 들어왔습니다.");

    echo "success";
    //goto_url(G5_URL."/page/mypage/order_complete.php?order_number=".$order_number);
}else{
    echo "error";
    //alert("주문처리 오류입니다.",G5_URL."/page/mypage/order_form.php");
}*/
/*

if($is_member){
    $mb_no = $member["mb_no"];
}

$order_number = "ORDER_".date("Y_m_d_h_m_s");

//결제모듈 완료후 저장
$wr_id = substr($_REQUEST["wr_id"],0,strlen($_REQUEST["wr_id"])-1);
$cart_id = $_REQUEST["cart_id"];
$order_type = $_REQUEST["order_type"];
$order_type1 = $_REQUEST["order_type1"];
$order_type2 = $_REQUEST["order_type2"];
$order_name = $_REQUEST["order_name"];
$order_phone = $_REQUEST["order_phone"];
$order_pass = $_REQUEST["order_pass"];
$delivery_name = $_REQUEST["delivery_name"];
$delivery_addr_code = $_REQUEST["delivery_addr_code"];
$delivery_addr_1 = $_REQUEST["delivery_addr_1"];
$delivery_addr_2 = $_REQUEST["delivery_addr_2"];
$delivery_phone = $_REQUEST["delivery_phone"];
if($delivery_name==""){
    $delivery_name=$_REQUEST["order_name"];
}
if($delivery_addr_code==""){
    $delivery_addr_code=$_REQUEST["mb_zip1"];
}
if($delivery_phone==""){
    $delivery_phone = $_REQUEST["order_phone"];
}
if($delivery_addr_1==""){
    $delivery_addr_1 = $_REQUEST["mb_addr1"];
}
if($delivery_addr_2==""){
    $delivery_addr_2 = $_REQUEST["mb_addr2"];
}
$delivery_message = $_REQUEST["delivery_msg"];
$bank_account_name = $_REQUEST["bank_account_name"];
$bank_name = $_REQUEST["bank_name"];
$mb_point=$_REQUEST["mb_point"];

$menu_name = substr($_REQUEST["menu_name"],0,strlen($_REQUEST["menu_name"])-1);
$menu_price = substr($_REQUEST["menu_price"],0,strlen($_REQUEST["menu_price"])-1);
$menu_count = substr($_REQUEST["menu_count"],0,strlen($_REQUEST["menu_count"])-1);
$menu_option = substr($_REQUEST["menu_option"],0,strlen($_REQUEST["menu_option"])-1);
$menu_option_price = substr($_REQUEST["menu_option_price"],0,strlen($_REQUEST["menu_option_price"])-1);

$menu_names = explode("," , $menu_name);
$menu_prices = explode("," , $menu_price);
$menu_counts = explode("," , $menu_count);
$menu_options = explode("," , $menu_option);
$menu_option_prices = explode("," , $menu_option_price);

$total_price = 0;
for($i= 0; $i< count($menu_names);$i++) {
    if (!$menu_options[$i]) {
        $total_price += $menu_prices[$i] * $menu_counts[$i];
    } else {
        $total_price += ($menu_prices[$i] + $menu_option_prices[$i]) * $menu_counts[$i];
    }
}

if($mb_point != 0){
    $total_price = $total_price - $mb_point;
}

$year = date("Y");
$month = date("m");
$day = date("d");

$sql = "insert into `order_form` set 
                  cart_id = '{$cart_id}', 
                  wr_id = '{$wr_id}', 
                  mb_no = '{$mb_no}',
                  order_number = '{$order_number}',
                  order_date = now(), 
                  order_menu = '{$menu_name}', 
                  order_count= '{$menu_count}', 
                  order_price = '{$menu_price}', 
                  order_option = '{$menu_option}', 
                  order_option_price = '{$menu_option_price}', 
                  order_user_name = '{$order_name}', 
                  order_user_phone = '{$order_phone}', 
                  order_recive_name = '{$delivery_name}', 
                  order_recive_phone = '{$delivery_phone}', 
                  order_recive_zipcode = '{$delivery_addr_code}', 
                  order_recive_addr1 = '{$delivery_addr_1}', 
                  order_recive_addr2 = '{$delivery_addr_2}', 
                  order_recive_message = '{$delivery_message}', 
                  order_type1 = '{$order_type}', 
                  order_type2 = '{$order_type1}', 
                  order_type3 = '{$order_type2}', 
                  bank_account_name = '{$bank_account_name}', 
                  bank_name = '{$bank_name}', 
                  order_state = 1, 
                  order_total_price = '{$total_price}', 
                  order_pass = PASSWORD('{$order_pass}'),
                  order_year = '{$year}',
                  order_month = '{$month}',
                  order_day = '{$day}'
                  ";

if(sql_query($sql)){
    $sql = "update `cart` set cart_state = 1  where cart_id in ({$cart_id})";
    sql_query($sql);
   
    //상점 정보 가져오기
    $store = sql_fetch("select m.*,s.* from `g5_write_main` as m left join `g5_member` as s on m.mb_id = s.mb_id where m.wr_id = '{$wr_id}'");
    $userpoint = $total_price * 1 / 100;
	$storepoint = $total_price * 4 / 100;
    //구매포인트
	//insert_point($member["mb_id"],$userpoint);
	//insert_point($store["mb_id"],$storepoint);


    //주문정보 푸쉬보내기 (상점)
    send_GCM($store["regid"],"기뷰 주문","주문요청이 들어왔습니다.");

    echo $order_number;

	//goto_url(G5_URL."/page/mypage/order_complete.php?order_number=".$order_number);
}else{
    echo "error";
    //alert("주문처리 오류입니다.",G5_URL."/page/mypage/order_form.php");
}*/