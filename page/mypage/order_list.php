<?php
include_once("../../common.php");
$back_url=G5_URL;
$title = "주문목록";
include_once(G5_PATH."/head.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
if($member["mb_id"]){
    $mb_id = $member["mb_id"];
}else{
    $mb_id = $_COOKIE["PHPSESSID"];
}
$list_result = sql_query("select * from `order_form` as a left join `g5_write_main` as b on a.wr_id in (b.wr_id) where a.mb_id = '".$mb_id."' and order_date > date_add(now(), INTERVAL -6 MONTH) ");
while($row=sql_fetch_array($list_result)){
    $list[]=$row;
}
$rand = rand(0,4);
$favo_title = array("오늘은 쇼핑하기 좋은 날~ \r\n지금 바로 주문하러 가요!","오늘은 왠지 배달이 땡기는 날이야!","같은 메뉴 지겨워! 새로운 음식점 없을까?", "이제 색다른 메뉴가 필요해~" , "우리동네 인기 짱 맛집은?");
if(count($list) > 0){
?>
<div class="width-fixed">
    <section class="mypage">
        <!-- <div class="user_box user_box_s">
            <div class="userEdit" style="position: absolute;top:10px;right:10px;width:12%">
                <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>"><img src="<?php echo G5_IMG_URL?>/mypage_edit.png" alt="회원정보수정"></a>
            </div>
            <span class="<?php echo $member["mb_sex"]=="남"?"man":"woman";?>"></span>
            <p><?php echo $is_member?$member['mb_name']:"로그인해주세요"; ?></p>
        </div> -->
		<!-- <div class="section01_content">
            <ul class="mypage_tab">
                <li class="favorite_li <?php if($tab=="favorite" || $tab=="" || !$tab){?>active<?php }?>">찜목록</li>
                <li class="order_li <?php if($tab=="order"){?>active<?php }?>">주문목록</li>
                <li class="review_li <?php if($tab=="review"){?>active<?php }?>">리뷰</li>
            </ul>
            <div class="clear"></div>
        </div> -->
		<div class="section01_content">
			<div class="rent_list">
				<ul>
					<?php
					for($i=0;$i<count($list);$i++){
						switch($list[$i]["order_state"]){
							case "1":
								$order_state = "배달준비";
								break;
							case "2":
								$order_state = "배달중";
								break;
							case "3":
								$order_state = "배달완료";
								break;
							case "4":
								$order_state = "주문취소";
								break;
						}

						
					   $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
						if($thumb['src']) {
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
						}

						$link="javascript:location.href='".G5_URL."/page/mypage/order_view.php?order_id=".$list[$i]['order_id']."'";

						?>
						<li class="order_li" data-cate="<?php echo $list[$i]['type']; ?>">
							<div onclick="<?php echo $link; ?>">
								<div class="img">
									<div><?php echo $img_content; ?></div>
								</div>
								<div class="txt">
									<h3><?php echo $list[$i]['wr_subject']; ?> <!-- <span class="state"><?php echo $order_state;?></span> --></h3>
									<p>주문시간 : <?php echo $list[$i]["order_date"];?></p>
									<p>주문번호 : <?php echo $list[$i]["order_number"];?></p>
								</div>
							</div>
							<a href="javascript:fnDel(<?php echo $list[$i]['id'];?>);" class="btn call"></a>
						</li>
					<?php } ?>
				</ul>
				<?php }else if(count($list)==0){?>
					<div class="mypage_no_list">
						<p><?php echo $favo_title[$rand]?></p>
						<div class="mypage_btn_group">
							<input type="button" class="btn grid_30 btn_pink" value="주문 하러가기" onclick="moveLink('main','')">
						</div>
					</div>
				<?php }?>
			</div>
		</div>
        <!-- <div class="section01_content">
            <ul class="mypage_tab">
                <li class="favorite_li <?php if($tab=="favorite" || $tab=="" || !$tab){?>active<?php }?>">찜목록</li>
                <li class="order_li <?php if($tab=="order"){?>active<?php }?>">주문목록</li>
                <li class="review_li <?php if($tab=="review"){?>active<?php }?>">리뷰</li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="section01_content">
            <div class="rent_list"></div>
        </div> -->
    </section>
</div>

<script type="text/javascript">
    function fnDel(id){
        $.ajax({
            url: "<?php echo G5_URL?>/page/mypage/ajax.favorite_update.php",
            method:"POST",
            data:{"id":id}
        }).done(function(data){
            switch (data){
                case "2":
                    alert("삭제되었습니다.");
                    document.location.reload();
                    break;
                case "3":
                    alert("삭제오류입니다. \r\n관리자에게 문의하시기 바랍니다.");
                    break;
            }
        })
    }
</script>

<?php 
include_once(G5_PATH."/tail.php");
?>