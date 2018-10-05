<?php
include_once("../../common.php");
$wr_id=$_REQUEST["wr_id"];

$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");


$wr_subject=$view["wr_subject"];
$back_url=G5_URL."/page/shop/my_store_list.php";
include_once(G5_PATH."/head.php");
?>
    <style>
        img.info{
            position: absolute;
            width:30px;
            left:10px;
            top:6px;
        }
        #view_section_info h2.detail_title{padding-left:50px;}
        @media all and (max-width: 480px){
            #view_section_info .section01_content dt{width:100%;font-weight:bold}
            #view_section_info .section01_content dd{width:98%}
        }
    </style>
    <div class="width-fixed view">
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div ><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">매장정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>전화번호</dt>
                    <dd><?php echo $view["store_hp"]?></dd>
                    <dt>주소</dt>
                    <dd>(<?php echo $view["store_zip"]?>) <?php echo $view["store_addr1"]." ".$view["store_addr2"];?></dd>
                    <dt>OPEN</dt>
                    <dd><?php echo $view["open_time"]?></dd>
                    <dt>CLOSE</dt>
                    <dd><?php echo $view["close_time"]?></dd>
                    <dt>휴무</dt>
                    <dd><?php echo $view["holiday"]?></dd>
                    <dt>소개</dt>
                    <dd><?php echo $view["store_detail"]?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_delivery_icon.png"><h2 class="detail_title">배달정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>배달여부</dt>
                    <dd><?php echo $view["delivery"]==1?"가능":"불가능";?></dd>
                    <dt>배달가능지역</dt>
                    <dd><?php echo $view["delivery_location"];?></dd>
                    <dt>배달가능금액</dt>
                    <dd><?php echo number_format($view["delivery_price"]);?> 원</dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_order_icon.png"><h2 class="detail_title">결제정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>결제수단</dt>
                    <dd><?php echo $view["order_type"]?></dd>
                    <dt>포인트</dt>
                    <dd><?php echo $view["point"]?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_etc_icon.png"><h2 class="detail_title">부가정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>예약/단체</dt>
                    <dd><?php echo $view["other"];?></dd>
                    <dt>홈페이지</dt>
                    <dd><?php echo $view["store_homepage"];?></dd>
                    <dt>흡연</dt>
                    <dd><?php echo $view["smoke_area"];?></dd>
                    <dt>주차장</dt>
                    <dd><?php echo $view["parking"];?></dd>
                </dl>
            </div>
        </section>
        <section class="section01" id="view_section_info" style="padding-bottom: 0px;margin-bottom:0px;">
            <div class="section01_header">
                <div><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_oring_icon.png"><h2 class="detail_title">제품 표기</h2></div>
            </div>
            <div class="section01_content" >
                <dl>
                    <dt>원산지정보</dt>
                    <dd><?php echo nl2br($view["oring_mark"]); ?></dd>
                    <dt>알레르기유발정보</dt>
                    <dd><?php echo nl2br($view["etc1"]); ?></dd>
                    <dt>영양성분정보</dt>
                    <dd><?php echo nl2br($view["etc2"]); ?></dd>
                </dl>
            </div>
        </section>

    </div>
<?php
include_once(G5_PATH."/tail.php");
?>