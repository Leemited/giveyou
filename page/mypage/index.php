<?php
include_once("../../common.php");
include_once(G5_PATH."/head.php");
if(!$is_member){
    alert("로그인이 필요합니다.",G5_URL);
}
?>
<style>
    .user_box_s{height:auto !important;}
    .mypage{position: relative}
    .mypage .mypage_tab {width:100%;}
    .mypage .mypage_tab li{float:left;background-color: #cf1616;color:#fff;font-size:16px;width:33.33%;text-align:center;padding:16px 0;cursor: pointer;border-bottom:2px solid #cf1616;}
    .mypage .mypage_tab li div {background-color: #fff;}
    .mypage .mypage_tab li.active, .mypage .mypage_tab li:hover {border-bottom:2px solid #cf1616;background-color: #fff;color: #000;font-weight:bold;}
    .section01_point{background-color: #ddd;color:#000;font-size:14px;height:40px;position: fixed;bottom:0;width:100%;}
    .section01_point li{width:30%;float:left;padding:10px 0 10px 3.33%;}
</style>
<div class="width-fixed">
    <section class="mypage">

        <div class="user_box user_box_s">
            <div class="userEdit" style="position: absolute;top:10px;right:10px;width:12%">
                <a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>"><img src="<?php echo G5_IMG_URL?>/mypage_edit.png" alt="회원정보수정"></a>
            </div>
            <span class="<?php echo $member["mb_sex"]=="남"?"man":"woman";?>"></span>
            <p><?php echo $is_member?$member['mb_name']:"로그인해주세요"; ?></p>
        </div>

        <div class="section01_content">
            <ul class="mypage_tab">
                <li class="favorite_li <?php if($tab=="favorite" || $tab=="" || !$tab){?>active<?php }?>">찜목록</li>
                <li class="order_li <?php if($tab=="order"){?>active<?php }?>">주문목록</li>
                <li class="review_li <?php if($tab=="review"){?>active<?php }?>">리뷰</li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="section01_content">
            <div class="rent_list"></div>
        </div>

        <!--<div class="section01_point">
            <ul>
                <li><label>총 포인트 : <?php /*echo number_format($member["mb_point"])*/?> P</label></li>
                <li><label>추천포인트 : <?php /*echo number_format((int)$member["mb_7"])*/?> P</label></li>
                <li><label>단독포인트: <?php /*echo number_format((int)$member["mb_8"])*/?> P</label></li>
            </ul>
        </div>-->
    </section>
</div>
<script>
    <?php if($tab=="favorite" || !$tab){?>
    $.ajax({
        url:"<?php echo G5_URL?>/page/mypage/favorite.php",
        method:"POST",
        data:{"mb_no":"<?php echo $member["mb_no"]?>"}
    }).done(function(data){
        $(".rent_list").append(data);
    })
    <?php }else if($tab=="order"){?>
    $.ajax({
        url:"<?php echo G5_URL?>/page/mypage/order_list.php",
        method:"POST",
        data:{"mb_no":"<?php echo $member["mb_no"]?>"}
    }).done(function(data){
        $(".rent_list").html(data);
    })
    <?php }else if($tab=="review"){?>
    $.ajax({
        url:"<?php echo G5_URL?>/page/mypage/review_list.php",
        method:"POST",
        data:{"mb_id":"<?php echo $member["mb_id"]?>"}
    }).done(function(data){
        $(".rent_list").html(data);
    })
    <?php }?>
    $(document).ready(function(){
        $(".favorite_li").click(function () {
            $(this).addClass("active")
            $(".mypage_tab li").not($(this)).removeClass("active");
            $.ajax({
                url:"<?php echo G5_URL?>/page/mypage/favorite.php",
                method:"POST",
                data:{"mb_no":"<?php echo $member["mb_no"]?>"}
            }).done(function(data){
                $(".rent_list").html(data);
            })
        })
        $(".order_li").click(function () {
            $(this).addClass("active")
            $(".mypage_tab li").not($(this)).removeClass("active");
            $.ajax({
                url:"<?php echo G5_URL?>/page/mypage/order_list.php",
                method:"POST",
                data:{"mb_no":"<?php echo $member["mb_no"]?>"}
            }).done(function(data){
                $(".rent_list").html(data);
            })
        })
        $(".review_li").click(function () {
            $(this).addClass("active")
            $(".mypage_tab li").not($(this)).removeClass("active");
            $.ajax({
                url:"<?php echo G5_URL?>/page/mypage/review_list.php",
                method:"POST",
                data:{"mb_id":"<?php echo $member["mb_id"]?>"}
            }).done(function(data){
                $(".rent_list").html(data);
            })
        })
    })
</script>
<?php
include_once ("../../tail.php");
?>