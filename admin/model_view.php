<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$wr_id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select m.*,s.* from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where m.wr_id='".$wr_id."'");
    $file = get_file("main", $wr_id);
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>상점정보</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table02">
				<table>
					<tr>
						<th>사진 *</th>
						<td>
                            <?php
                            if($view["wr_file"]!=0){
                                if($file["count"]>1) {
                                    ?>
                                    <div id="view-slide" class="owl-carousel">
                                        <?php for ($i = 1; $i < count($file) - 1; $i++) { ?>
                                            <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[$i]['file']; ?>" alt=""></div>
                                        <?php }?>
                                    </div>
                                <?php }else{?>
                                    <div id="view-slide" style="height:auto;text-align: center">
                                        <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[0]['file']; ?>" alt="" style="height:100%;"></div>
                                    </div>
                                <?php }
                            }?>
                        </td>
					</tr>
					<tr>
						<th>상점이름 *</th>
						<td><?php echo $view['wr_subject']; ?><?php if($view["wr_7"]==1){?>(프리미엄)<?php }?></td>
					</tr>
					<tr>
						<th>점주명 *</th>
						<td><?php echo $view['wr_name']; ?></td>
					</tr>
					<tr>
						<th>전화번호</th>
						<td><?php echo $view['store_hp']; ?></td>
					</tr>
                    <tr>
                        <th>주소</th>
                        <td><?php echo "(".$view['store_zip'].")".$view["store_addr1"]." ".$view["store_addr2"]; ?></td>
                    </tr>
                    <tr>
                        <th>운영시간</th>
                        <td><?php echo $view['open_time']." ~ ".$view["close_time"]; ?></td>
                    </tr>
                    <tr>
                        <th>휴무</th>
                        <td><?php echo $view['holiday']; ?></td>
                    </tr>
                    <tr>
                        <th>소개</th>
                        <td><?php echo $view['wr_content']; ?></td>
                    </tr>
                    <?php if($view["wr_7"]==1){?>
                    <tr>
                        <th>동영상</th>
                        <td>
                            <?php echo $view['video_link']; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>추가이미지</th>
                        <td>
                            <img src="<?php echo G5_DATA_URL."/shop/".$view['etc3']; ?>" alt=""><?php echo $view['etc3']; ?>
                        </td>
                    </tr>
                    <?php }?>
				</table>
			</div>
			<div class="adm-table02 mt20">
				<table>
					<tr>
						<th>배달정보 *</th>
						<td><?php echo ($view['delivery']==1)?"가능":"불가능"; ?></td>
					</tr>
					<tr>
						<th>배달가능지역 *</th>
						<td><?php echo $view['delivery_location']; ?></td>
					</tr>
					<tr>
						<th>배달가능금액 *</th>
						<td><?php echo $view['delivery_price']; ?></td>
					</tr>
				</table>
			</div>
			<div class="adm-table02 mt20">
				<table>
					<tr>
						<th>결제수단 *</th>
						<td><?php echo $view['order_type']; ?></td>
					</tr>
					<tr>
						<th>포인트 *</th>
						<td><?php echo $view['point']; ?></td>
					</tr>
				</table>
			</div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>예약/단체 *</th>
                        <td><?php echo $view['other']; ?></td>
                    </tr>
                    <tr>
                        <th>홈페이지 *</th>
                        <td><?php echo $view['store_homepage']; ?></td>
                    </tr>
                    <tr>
                        <th>흡연 *</th>
                        <td><?php echo $view['smoke_area']; ?></td>
                    </tr>
                    <tr>
                        <th>주차장 *</th>
                        <td><?php echo $view['parking']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>원산지정보</th>
                        <td><?php echo $view['oring_mark']; ?></td>
                    </tr>
                    <tr>
                        <th>알레르기유발정보</th>
                        <td><?php echo $view['etc1']; ?></td>
                    </tr>
                    <tr>
                        <th>영양성분정보</th>
                        <td><?php echo $view['etc2']; ?></td>
                    </tr>
                </table>
            </div>
			<div class="text-center mt20" style="margin-bottom:20px;">
				<a href="<?php echo G5_URL."/admin/model_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
				<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/model_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
			</div>
		</article>
	</section>
</div>
<script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
<script>
    $(".owl-carousel").owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        autoplaySpeed:2000,
        smartSpeed:2000,
        loop:true,
        dots:true,
        items:1
    });
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
