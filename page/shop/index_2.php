<?php
include_once ("../../common.php");
if(!$is_member){
    goto_url(G5_BBS_URL."/login.php?type=shop");
}
if( $member["mb_level"] != 5){
    alert("판매자만 접근 할 수 있습니다.",G5_URL);
}


$main_check = "select wr_id, wr_subject from `g5_write_main` where mb_id = '{$member["mb_id"]}' and wr_file = 0 and wr_is_comment = 0";
$cnt = sql_query($main_check);
while($row = sql_fetch_array($cnt)){
    $check_shop[] = $row;
}

if(count($check_shop) > 0){
    for($i=0;$i<count($check_shop);$i++) {
        if ($i + 1 == count($check_shop)) {
            $title .= $check_shop[$i]["wr_subject"];
        } else {
            $title .= $check_shop[$i]["wr_subject"] . " / ";
        }
        alert($title . " 상점의 사진을 등록해주세요.", G5_URL . "/page/shop/my_store_detail_form.php?wr_id=" . $check_shop[$i]["wr_id"]);
    }
}
$shop = sql_fetch("select wr_id,wr_7 from `g5_write_main` where mb_id = '{$member["mb_id"]}' ");


$year = date("Y");
$month = date("m");
$day = date("d");

$stat_y = sql_fetch("select SUM(order_total_price) as `year` , count(*) as cnt from `order_form` where wr_id = '{$shop["wr_id"]}' and order_state = 1 and delivery_state = 3 and order_year = '{$year}'");
$stat_m =  sql_fetch("select SUM(order_total_price) as `month`, count(*) as cnt from `order_form` where wr_id = '{$shop["wr_id"]}' and order_state = 1 and delivery_state = 3 and order_month = '{$month}'");
$stat_d =  sql_fetch("select SUM(order_total_price) as `day`, count(*) as cnt from `order_form` where wr_id = '{$shop["wr_id"]}' and order_state = 1 and delivery_state = 3 and order_day = '{$day}'");

$parent_id=$shop["wr_id"];
include_once ("../../head.php");



function rtn_mobile_chk() {
    $ary_m = array("iPhone","iPod","IPad","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini","Windows CE","Nokia","Sony","Samsung","LGTelecom","SKT","Mobile","Phone");
    for($i=0; $i<count($ary_m); $i++){
        if(preg_match("/$ary_m[$i]/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
            break;
        }
    }
    return false;
}


$mobile = rtn_mobile_chk();
?>
<style>
    .section_seller{display: block;width:100%;}
    .section_seller_order_info ul li{width:94%;padding:3%;font-size:14px;}
    .section_seller_order_info ul.harf {float:left;width:50%;border-bottom:1px solid #ddd}
    .section_seller_order_info ul.harf li{position: relative;width:90%;padding:12px 5%;font-size:14px;}
    .section_seller_order_info ul.harf li span{position: absolute;right:3%;}
    .section_seller_order_info ul.harf li.p{text-align:right}
    .section_seller_order_info li.t{background:#cf1616;color:#fff;font-weight:bold;}
    .seller_main {clear:both}
    .seller_main div {width:100%}
    .seller_main div  > div{float:left;width:40%;padding:5%;text-align:center;}
    .premium_btn_area p{padding:3%;font-size:16px;}
</style>
<div class="width-fixed">
    <section class="section_seller">
        <div class="section_seller_order_info">
            <ul>
                <li class="t"><?php echo date("Y");?>년 매출</li>
                <li><?php echo number_format($stat_y["year"])?> 원</li>
            </ul>
            <ul class="harf">
                <li class="t"><?php echo date("m"); ?>월간 <span><?php echo $stat_m["cnt"]?> 건</span></li>
                <li class="p"><?php echo number_format($stat_m["month"])?> 원</li>
            </ul>
            <ul class="harf">
                <li class="t"><?php echo date("d"); ?>일 <span><?php echo $stat_d["cnt"]?> 건</span></li>
                <li class="p"><?php echo number_format($stat_d["day"])?> 원</li>
            </ul>
        </div>
        <div class="seller_main">
            <div>
                <div>
                    <a href="<?php echo G5_URL?>/page/shop/my_store_list.php"><img src="<?php echo G5_IMG_URL; ?>/.png" alt="매장정보"></a>
                </div>
                <div>
                    <a href="<?php echo G5_URL?>/page/shop/store_order_list.php?wr_id=<?php echo $shop["wr_id"]?>"><img src="<?php echo G5_IMG_URL; ?>/.png" alt="주문현황"></a>
                </div>
            </div>
            <div>
                <div>
                    <a href="<?php echo G5_URL?>/page/shop/store_order_stats.php?wr_id=<?php echo $shop["wr_id"]?>"><img src="<?php echo G5_IMG_URL; ?>/.png" alt="주문통계"></a>
                </div>
                <div>
                    <a href="<?php echo G5_URL?>/page/shop/store_account_stats.php?wr_id=<?php echo $shop["wr_id"]?>"><img src="<?php echo G5_IMG_URL; ?>/.png" alt="정산현황"></a>
                </div>
            </div>
        </div>
        <div class="btn_group clear premium_btn_area" >
            <?php if($shop["wr_7"]==0){?>
            <p>매장의 상위 노출을 원하세요?</p>
                <input type="button" value="프리미엄전환" class="btn grid_100 bg_darkred general_btn" onclick="fnPremium('<?php echo $shop ["wr_id"]?>')" >
            <?php }else{?>
                <input type="button" value="프리미엄메뉴" class="btn grid_100 bg_darkred general_btn" onclick="location.href=g5_url+'/page/shop/premium_menu.php?wr_id=<?php echo $shop["wr_id"]?>'" >
            <?php } ?>
            <!-- <?php if(!$mobile){?>
                <br><br>
                <input type="button" value="PC 버전 관리자" class="btn grid_100 bg_darkred general_btn" onclick="location.href=g5_url+'/admin/'" >
            <?php }?> -->
        </div>
    </section>
</div>
<script>
    function  fnPremium(id) {
        $.post(g5_url+"/page/modal/store_premium_update.php",{id:id},function(data){
            $(".modal").html(data);
            modal_active();
        });
    }
</script>
<?php
include_once ("../../tail.php");
?>
