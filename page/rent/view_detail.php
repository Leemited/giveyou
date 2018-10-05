<?php
include_once("../../common.php");
$back_url=G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$wr_subject."&lat=".$lat."&lng=".$lng;
include_once(G5_PATH."/head.php");
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");

?>
    <style>
        img.info{
            position: absolute;
            width:30px;
            left:10px;
            top:6px;
        }
        #view_section_info h2.detail_title{padding-left:50px;}
    </style>
    <div class="width-fixed view">
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div ><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">매장정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>전화번호</dt>
                    <dd><?php echo ($view["store_hp"])?$view["store_hp"]:"전화번호 정보없음"?></dd>
                    <dt>주소</dt>
                    <dd><?php echo ($view["store_zip"])?"(".$view["store_zip"].")":""; ?> <?php echo ($view["store_addr1"])?$view["store_addr1"]." ".$view["store_addr2"]:"등록된 주소정보가 없습니다.";?></dd>
                    <dt>운영시간</dt>
                    <dd><?php echo ($view["open_time"] && $view["close_time"])?$view["open_time"]."~".$view["close_time"]:"등록된 운영시간 정보가 없습니다.";?></dd>
                    <dt>휴무</dt>
                    <dd><?php echo ($view["holiday"])?$view["holiday"]:"등록된 휴무정보가 없습니다.";?></dd>
                    <dt>소개</dt>
                    <dd><?php echo ($view["store_detail"])?$view["store_detail"]:"등록된 매장소개가 없습니다.";?></dd>
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
                    <dd><?php echo ($view["delivery_location"])?$view["delivery_location"]:"등록된 배달가능지역이 없습니다.";?></dd>
                    <dt>배달가능금액</dt>
                    <dd><?php echo ($view["delivery_price"])?number_format($view["delivery_price"])." 원":"등록된 배달가능금액이 없습니다.";?></dd>
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
                    <dd><?php echo ($view["order_type"])?$view["order_type"]:"등록된 결제수단이 없습니다.";?></dd>
                    <dt>포인트</dt>
                    <dd><?php echo ($view["point"])?$view["point"]:"등록된 포인트 정보가 없습니다.";?></dd>
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
                    <dd><?php echo ($view["other"])?$view["other"]:"등록된 예약/단체 정보가 없습니다.";?></dd>
                    <dt>홈페이지</dt>
                    <dd><?php echo ($view["store_homepage"])?$view["store_homepage"]:"등록된 홈페이지 정보가 없습니다.";?></dd>
                    <dt>흡연</dt>
                    <dd><?php echo $view["smoke_area"]?></dd>
                    <dt>주차장</dt>
                    <dd><?php echo $view["parking"]?></dd>
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
                </dl>
				<dl>
                    <dt>알레르기 유발정보</dt>
                    <dd><?php echo nl2br($view["etc1"]); ?></dd>
                </dl>
				<dl>
                    <dt>영양성분정보</dt>
                    <dd><?php echo nl2br($view["etc2"]); ?></dd>
                </dl>
                <!-- <div style="padding:10px 0; border-top:1px solid #ddd;width:90%;margin:0 5%;">
                    <div style="padding:5px 0px;">알레르기 유발정보 <a href="#" onclick="detailView('etc1','<?php echo $view[detail_id]?>');">자세히보기</a></div>
                    <div style="padding:5px 0px;">영양성분정보 <a href="#" onclick="detailView('etc2','<?php echo $view[detail_id]?>');">자세히보기</a></div>
                </div> -->
            </div>
        </section>
    </div>
    <script>
        function detailView(type,id){
            $.post(g5_url+"/page/modal/detail_etc.php",{id:id,type:type},function(data){
                $(".modal").html(data);
                modal_active();
            });
        }
    </script>
<?php
include_once(G5_PATH."/tail.php");
?>