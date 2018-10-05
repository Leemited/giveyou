<?php
include_once ("../../common.php");
include_once(G5_LIB_PATH.'/mailer.lib.php');
$type = $_REQUEST["type"];

if($type=="day"){
    $wr_id = $_REQUEST["wr_id"];
    $day = $_REQUEST["day"];
    $category = $_REQUEST["category"];
    $menu_name = $_REQUEST["menu_name"];
    $state = $_REQUEST["state"];
    $today = date("Y-m-d");
    if(!$day){
        $day = $today;
    }

    $where = " o.wr_id = '{$wr_id}' and order_date like '%{$day}%' ";

    if($category){
        $where .= " and m.ca_name = '{$category}'";
    }
    if($menu_name){
        $where .= " and o.order_menu like '%{$menu_name}%'";
    }
    if($state){
        $where .= " and o.order_state = '{$state}'";
    }

    $order = sql_query("select o.*, m.* from `order_form` as o left join `store_category` as m on o.wr_id = m.wr_id where {$where} GROUP by order_number order by order_date desc ");
    while($row = sql_fetch_array($order)){
        $list[] = $row;
    }

    if(count($list)>0) {
        $subject = $member["mb_name"] . "님의 주문정보 [{$day}]";

        $content = "";

        $content .= '<div style="margin:30px auto;width:800px;border:10px solid #f7f7f7">';
        $content .= '<div style="border:1px solid #dedede;position:relative;">';
        $content .= '<h1 style="padding:10px 5%;background:#f7f7f7;color:#555;font-size:1.4em">';
        $content .= '주문정보 - ' . $day;
        $content .= '</h1>';
        //$content .= '<div style="position:absolute;top:28px;right:30px;">';
        //$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
        //$content .= '</div>';
        $content .= '<table style="border:none;width:90%;margin:5%;" cellspacing="0" cellpadding="4px">';
        $content .= '<tr><th colspan="6" style="text-align: right;font-size:12px"> 총' . count($list) . ' 건</th>';
        $content .= '<tr><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문일자</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문시간</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문번호</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문상품</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">수량</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">총금액</th></tr>';
        for ($i = 0; $i < count($list); $i++) {
            $date = explode(" ", $list[$i]["order_date"]);
            $menus = explode(",", $list[$i]["order_menu"]);
            $options = explode(",", $list[$i]["order_option"]);
            $content .= '<tr><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $date[0] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $date[1] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $list[$i]["order_number"] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">';
            for ($j = 0; $j < count($menus); $j++) {
                $content .= $menus[$j];
                if ($options[$j]) {
                    $content .= " (" . $options[$j] . ")";
                }
            }
            $content .= '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $list[$i]['order_count'] . ' 개</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . number_format($list[$i]['order_total_price']) . ' 원</td></tr>';
        }
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $member['mb_email'], $subject, $content, 1);
        alert("고객님의 등록된 이메일 주소로 메일을 전송했습니다.");
    }else{
        alert("현재 선택하신 날짜의 주문정보가 없습니다.");
    }
}else if($type=="month"){
    $wr_id = $_REQUEST["wr_id"];
    $year = $_REQUEST["year"];
    if(!$year){
        $year = date("Y");
    }
    $month = array(0,0,0,0,0,0,0,0,0,0,0,0);

    $order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and o.order_year = '{$year}' order by o.order_date desc ");

    while($row = sql_fetch_array($order)){
        $list[] = $row;
        switch ($row["order_month"]){
            case "1":
                $month[0]++;
                break;
            case "2":
                $month[1]++;
                break;
            case "3":
                $month[2]++;
                break;
            case "4":
                $month[3]++;
                break;
            case "5":
                $month[4]++;
                break;
            case "6":
                $month[5]++;
                break;
            case "7":
                $month[6]++;
                break;
            case "8":
                $month[7]++;
                break;
            case "9":
                $month[8]++;
                break;
            case "10":
                $month[9]++;
                break;
            case "11":
                $month[10]++;
                break;
            case "12":
                $month[11]++;
                break;
        }
    }
    if(count($list)>0) {
        $subject = $member["mb_name"] . "님의 주문정보 [" . $year . "년]";

        $content = "";

        $content .= '<div style="margin:30px auto;width:800px;border:10px solid #f7f7f7">';
        $content .= '<div style="border:1px solid #dedede;position:relative;">';
        $content .= '<h1 style="padding:10px 5%;background:#f7f7f7;color:#555;font-size:1.4em">';
        $content .= '주문정보 - ' . $year . "년";
        $content .= '</h1>';
        //$content .= '<div style="position:absolute;top:28px;right:30px;">';
        //$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
        //$content .= '</div>';
        $content .= '<table style="border:none;width:90%;margin:5%;" cellspacing="0" cellpadding="4px">';
        for ($i = 0; $i < count($month); $i++) {
            $m = $i + 1;
            $width = 1;
            if ($m < 10) {
                $m = "0" . $m;
            }
            $width = $month[$i] / count($list) * 100;
            if($width==0){
                $width = 1;
            }
            $content .= '<tr>';
            $content .= '<th style="border:1px solid #ddd;background: #333;color:#fff;padding: 5px;width:10%">' . $m . ' 월';
            $content .= '</th>';
            $content .= '<td style="border-bottom:1px solid #ddd;text-align: center;padding:0 5px;width:20%">'. $month[$i] . ' 건</td>';
            $content .= '<td style="border-bottom:1px solid #ddd;text-align: center;padding:0 8px;width:70%;position: relative; background: url('.G5_IMG_URL.'/email_line_bg.png) repeat-y left;background-size: '.$width.'% 100%;">';
            //$content .= '       <div style="width: '.$width.'%;background: #cf1616;text-align: center;padding: 5px 0;cursor: pointer;position: absolute;top: 0;left: 0;margin: 1px;height:100%" >&nbsp;</div>';
            $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $member['mb_email'], $subject, $content, 1);
        alert("고객님의 등록된 이메일 주소로 메일을 전송했습니다.");
    }else{
        alert("현재 선택한 연도의 주문정보가 없습니다.");
    }
}else if($type=="month_detail"){
    $wr_id = $_REQUEST["wr_id"];
    $month = $_REQUEST["month"];
    $year = $_REQUEST["year"];
    $category = $_REQUEST["category"];
    $menu_name = $_REQUEST["menu_name"];
    $state = $_REQUEST["state"];

    $where = " o.wr_id = '{$wr_id}' and order_year = '{$year}' and order_month = '{$month}' ";

    if($category){
        $where .= " and m.ca_name = '{$category}'";
    }
    if($menu_name){
        $where .= " and o.order_menu like '%{$menu_name}%'";
    }
    if($state){
        $where .= " and o.order_state = '{$state}'";
    }

    $order = sql_query("select o.*, m.* from `order_form` as o left join `store_category` as m on o.wr_id = m.wr_id where {$where} GROUP by order_number order by order_date ");
    while($row = sql_fetch_array($order)){
        $list[] = $row;
    }

    if(count($list)>0) {
        $m = (strlen($month)<10)?"0".$month:$month;
        $subject = $member["mb_name"] . "님의 주문정보 [".$year."년 ".$m."월]";

        $content = "";

        $content .= '<div style="margin:30px auto;width:800px;border:10px solid #f7f7f7">';
        $content .= '<div style="border:1px solid #dedede;position:relative;">';
        $content .= '<h1 style="padding:10px 5%;background:#f7f7f7;color:#555;font-size:1.4em">';
        $content .= '주문정보 - ' .$year."년 ".$m."월";
        $content .= '</h1>';
        //$content .= '<div style="position:absolute;top:28px;right:30px;">';
        //$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
        //$content .= '</div>';
        $content .= '<table style="border:none;width:90%;margin:5%;" cellspacing="0" cellpadding="4px">';
        $content .= '<tr><th colspan="6" style="text-align: right;font-size:12px"> 총' . count($list) . ' 건</th>';
        $content .= '<tr><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문일자</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문시간</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문번호</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">주문상품</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">수량</th><th style="border:1px solid #ddd;background: #333;color:#fff;padding:4px;">총금액</th></tr>';
        for ($i = 0; $i < count($list); $i++) {
            $date = explode(" ", $list[$i]["order_date"]);
            $menus = explode(",", $list[$i]["order_menu"]);
            $options = explode(",", $list[$i]["order_option"]);
            $content .= '<tr><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $date[0] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $date[1] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $list[$i]["order_number"] . '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">';
            for ($j = 0; $j < count($menus); $j++) {
                $content .= $menus[$j];
                if ($options[$j]) {
                    $content .= " (" . $options[$j] . ")";
                }
            }
            $content .= '</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . $list[$i]['order_count'] . ' 개</td><td style="border-bottom:1px solid #ddd;text-align: center;padding:4px;">' . number_format($list[$i]['order_total_price']) . ' 원</td></tr>';
        }
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $member['mb_email'], $subject, $content, 1);
        alert("고객님의 등록된 이메일 주소로 메일을 전송했습니다.");
    }else{
        alert("현재 선택하신 달의 주문정보가 없습니다.");
    }
}else if($type=="year"){
    $wr_id = $_REQUEST["wr_id"];
    $year = $_REQUEST["year"];
    if(!$year){
        $year = date("Y");
    }
    $order = sql_query("select *,COUNT(order_year) as cnt from `order_form` where wr_id = '{$wr_id}' GROUP by order_year order by order_date desc ");
    $total = 0;
    while($row = sql_fetch_array($order)){
        $list[] = $row;
        $total += $row["cnt"];
    }
    if(count($list)>0) {
        $subject = $member["mb_name"] . "님의 총 주문현황";

        $content = "";

        $content .= '<div style="margin:30px auto;width:800px;border:10px solid #f7f7f7">';
        $content .= '<div style="border:1px solid #dedede;position:relative;">';
        $content .= '<h1 style="padding:10px 5%;background:#f7f7f7;color:#555;font-size:1.4em">';
        $content .= '총 주문현황';
        $content .= '</h1>';
        //$content .= '<div style="position:absolute;top:28px;right:30px;">';
        //$content .= '<a href="'.G5_URL.'" target="_blank">'.$config['cf_title'].'</a>';
        //$content .= '</div>';
        $content .= '<table style="border:none;width:90%;margin:5%;" cellspacing="0" cellpadding="4px">';
        for ($i = 0; $i < count($list); $i++) {
            $m = $i + 1;
            $width = 1;
            if ($m < 10) {
                $m = "0" . $m;
            }
            $width = $list[$i]['cnt'] / $total * 100;
            if($width==0){
                $width = 1;
            }
            $content .= '<tr>';
            $content .= '<th style="border:1px solid #ddd;background: #333;color:#fff;padding: 5px;width:10%">' . $list[$i]['order_year'] . ' 년';
            $content .= '</th>';
            $content .= '<td style="border-bottom:1px solid #ddd;text-align: center;padding:0 5px;width:20%">'. $list[$i]['cnt'] . ' 건</td>';
            $content .= '<td style="border-bottom:1px solid #ddd;text-align: center;padding:0 8px;width:70%;position: relative; background: url('.G5_IMG_URL.'/email_line_bg.png) repeat-y left;background-size: '.$width.'% 100%;">';
            //$content .= '       <div style="width: '.$width.'%;background: #cf1616;text-align: center;padding: 5px 0;cursor: pointer;position: absolute;top: 0;left: 0;margin: 1px;height:100%" >&nbsp;</div>';
            $content .= '</td>';
            $content .= '</tr>';
        }
        $content .= '</table>';
        $content .= '</div>';
        $content .= '</div>';

        echo $content;
        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $member['mb_email'], $subject, $content, 1);
        alert("고객님의 등록된 이메일 주소로 메일을 전송했습니다.");
    }else{
        alert("현재 고객님의 주문정보가 없습니다.");
    }
}
