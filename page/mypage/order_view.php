<?php
include_once ("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$wr_id = $member["mb_id"];
$order_id = $_REQUEST["order_id"];
$view = sql_fetch("select * from `order_form` as a left join `g5_write_main` as b on a.wr_id=b.wr_id where order_id = '{$order_id}'");
$wr_subject="상세정보";
$back_url=G5_URL;
include_once ("../../head.php");

$menu_name = explode(",",$view["order_menu"]);
$menu_price = explode(",",$view["order_price"]);
$menu_count = explode(",",$view["order_count"]);
$menu_option = explode(",",$view["order_option"]);
$menu_option_price = explode(",",$view["order_option_price"]);
?>
    <style>
        .section01_header .order_header_store h2{text-align:left;padding:10px;}
        .section01_header .order_header h2{text-align:left;padding:10px;}
        .order_dl{border:none !important;padding:0 !important;}
        .btn_call{padding:15px; background-color: #cf1616;color:#fff;font-size:16px;margin-bottom:10px;}
        .btn_detail{padding:15px; font-size:16px;}
        .order_view_total dl{border:none !important;background:#777;color:#fff;font-weight: bold;margin:0 20px 5px 20px !important;}
    </style>
<div class="width-fixed view">
    <section class="section01" id="view_section">
        <div class="section01_header">
            <div class="order_header_store"><h2><?php echo $view["wr_subject"];?></h2></div>
            <div class="btn_group" style>
                <input type="button" class="grid_50 btn btn_detail" value="상세보기" onclick="location.href='<?php echo G5_URL."/page/rent/view.php?wr_id=".$view["wr_id"];?>';">
                <input type="button" class="grid_50 btn btn_call" value="전화걸기" onclick="location.href='tel:<?php echo $view['wr_9']?>';">
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <section class="section01" id="view_section">
        <div class="section01_header">
            <div class="order_header"><h2>주문정보</h2></div>
        </div>
        <div class="section01_content">
            <form>
            <dl class="order_dl">
                <dt>주문번호</dt>
                <dd><?php echo $view["order_number"]; ?></dd>
                <dt>주문시간</dt>
                <dd><?php echo $view["order_date"]; ?></dd>
                <dt>주문방법</dt>
                <dd><?php echo $view["order_type1"]; ?></dd>
                <dt>주문금액</dt>
                <dd><?php echo number_format($view["order_total_price"])." 원"; ?></dd>
            </dl>
            </form>
        </div>
    </section>
    <section class="section01" id="view_section">
        <div class="section01_header">
            <div class="order_header"><h2>배달정보</h2></div>
        </div>
        <div class="section01_content">
            <form>
            <dl class="order_dl">
                <dt>연락처</dt>
                <dd><?php echo $view["order_recive_phone"]; ?></dd>
                <dt>배달주소</dt>
                <dd><?php echo "(".$view["order_recive_zipcode"].") ".$view["order_recive_addr1"]." ".$view["order_recive_addr2"]; ?></dd>
                <dt>요청사항</dt>
                <dd><?php echo $view["order_recive_message"]; ?></dd>
            </dl>
            </form>
        </div>
    </section>
    <section class="section01" id="view_section">
        <div class="section01_header">
            <div class="order_header"><h2>주문내역</h2></div>
        </div>
        <div class="section01_content">
            <form>
            <?php for($i=0;$i<count($menu_name);$i++){
                if($menu_option[$i]){
                    $menu_total = ($menu_price[$i]+$menu_option_price[$i]) * $menu_count[$i];
                }else{
                    $menu_total = $menu_price[$i] * $menu_count[$i];
                }
                ?>
            <dl class="order_dl_produt">
                <dt><b><?php echo $menu_name[$i];?></b></dt>
                <dd><b><?php echo number_format($menu_total); ?> 원</b></dd>
                <dt>가격</dt>
                <dd><?php echo $menu_price[$i];?> 원</dd>
                <?php if($menu_option[$i]){?>
                    <dt>옵션</dt>
                    <dd><?php echo $menu_option[$i]."(".number_format($menu_option_price[$i])." 원)"; ?></dd>
                <?php }?>
                <dt>수량</dt>
                <dd><?php echo $menu_count[$i]; ?> 개</dd>
            </dl>
            <?php }?>
            </form>
            <form>
            <div class="order_view_total">
                <dl>
                    <dt>주문금액</dt>
                    <dd><?php echo number_format($view["order_total_price"]);?> 원</dd>
                    <dt>할인금액</dt>
                    <dd><?php echo number_format($view["order_discount_price"]);?> 원</dd>
                </dl>
                <dl>
                    <dt>결제수단</dt>
                    <dd><?php echo $view["order_type3"];?> </dd>
                    <dt>결제금액</dt>
                    <dd><?php echo number_format($view["order_total_price"]);?> 원</dd>
                </dl>
            </div>
            </form>
        </div>
    </section>
    <?php
    $date1 = strtotime(date("Y-m-d G:i:s"));
    $date2 = strtotime($view["order_date"]);
    $diff = ceil(($date1 - $date2) / 60);
    //보류
    if($diff < 30 || $view["status"] > 2){?>
        
       <section class="section01">
            <div class="section01_content">
                <div class="btn_group">
                <input type="button" value="결제취소" class="btn grid_100 btn_call">
                </div>
            </div>
        </section>
    <?php }?>
</div>

<?php
include_once ("../../tail.php");
?>