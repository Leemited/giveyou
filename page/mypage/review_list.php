<?php
include_once ("../../common.php");
$mb_id = $member["mb_id"];
$sql = "select a.wr_subject, b.wr_name, b.wr_content, b.wr_datetime, b.wr_4, b.wr_id, b.wr_parent from `g5_write_main` as a left join `g5_write_main` as b on a.wr_id = b.wr_parent where b.mb_id = '{$mb_id}' and b.`wr_is_comment` = 1 ";
$result = sql_query($sql);
while($row = sql_fetch_array($result)){
    $list[] = $row;
}
$rand = rand(0,4);
$favo_title = array("방문 매장에 발도장을 꾹꾹 찍어보세요! (포인트+100P)","간단한 리뷰 쓰고 100P 챙겨가자!","좋은 정보 서로서로 공유해요~", "언제까지 혼자만 알고 있을거야?" , "거기 완전 좋았지?");

?>
<style>
    .section01 .review_list h2{padding:0 0 10px 0;border-bottom:1px solid #ddd;}
    .section01 .review_list h2 > span {position: absolute;right: 10px;font-size: 15px;color:#ffce31;font-weight:bold;}
    .section01 .review_list li{padding: 10px;margin:10px;border:1px solid #ddd;cursor: auto}
    .section01 .review_list li p {padding:10px 0;font-size:18px;margin-bottom:40px;color:#000;word-break: break-all;white-space: normal;line-height:20px;}
    .section01 .review_list li div.review_date{position: relative;}
    .section01 .review_list li div.review_date > div{position: absolute;right:0; bottom:10px; font-size:13px;color:#666}
    .section01 .review_list li div.btn_group{text-align: right;display: block}
    .section01 .review_list li div.btn_group input {width:30px;height:30px;border:1px solid #ddd;}
    .section01 .review_list li div.btn_group input.review_del{background:url("../../img/cart_close_btn.png")no-repeat center; background-size: 100% 100%;}
    .section01 .review_list li div.btn_group input.review_detail{background:url("../../img/mobile_search_btn.png")no-repeat center; background-size: 140% 140%;}
</style>
<div class="width-fixed">
    <section class="section01">
        <?php if(count($list) > 0){?>
        <ul class="review_list">
        <?php for($i=0;$i<count($list);$i++){
            switch ($list[$i]["wr_4"]){
                case "5":
                    $rank = "★★★★★";
                    break;
                case "4":
                    $rank = "★★★★☆";
                    break;
                case "3":
                    $rank = "★★★☆☆";
                    break;
                case "2":
                    $rank = "★★☆☆☆";
                    break;
                case "1":
                    $rank = "★☆☆☆☆";
                    break;
                case "0":
                    $rank = "☆☆☆☆☆";
                    break;
            }
        ?>
            <li>
                <form action="<?php echo G5_URL."/page/mypage/review_update.php";?>" name="del" method="post">
                    <input type="hidden" value="<?php echo $list[$i]["wr_parent"];?>" name="wr_id">
                    <input type="hidden" value="<?php echo $list[$i]["wr_id"];?>" name="comment_id">
                    <input type="hidden" value="<?php echo $member["mb_id"];?>" name="mb_id">
                    <input type="hidden" value="main" name="bo_table">
                    <input type="hidden" value="cu" name="w">
                    <h2><?php echo $list[$i]["wr_subject"];?> <span class="right"><?php echo $rank;?></span></h2>
                    <!--<div class="user"><span class="<?php /*echo $member["mb_sex"]=="남"?"man":"woman"; */?>"></span><label for="icon"><?php /*echo $member["mb_name"];*/?></label></div>-->
                    <span class="rank"></span>
                    <p><?php echo $list[$i]["wr_content"];?></p>
                    <div class="review_date">
                        <div ><?php echo $list[$i]["wr_datetime"];?></div>
                    </div>
                    <div class="btn_group">
                        <input type="button" value="" class="btn review_detail" onclick="moveLink('view','<?php echo $list[$i]["wr_parent"];?>')">
                        <input type="submit" value="" class="btn review_del">
                    </div>
                </form>
            </li>
        <?php }?>
        </ul>
        <?php }
        if(count($list)==0){?>
            <div class="mypage_no_list">
                <p><?php echo $favo_title[$rand]?></p>
                <div class="mypage_btn_group">
                    <input type="button" class="btn grid_30 btn_pink" value="리뷰 하러가기" onclick="moveLink('main','')">
                </div>
            </div>
        <?php }?>
</div>
