<?php
include_once ("../../common.php");
include_once (G5_LIB_PATH."/thumbnail.lib.php");
$wr_id = $member;
$wr_subject = "상점관리";
$back_url=G5_URL."/page/shop/main.php";
include_once ("../../head.php");
include_once ("./back_head.php");
//내상점 불러오기
$store_r= sql_query("select * from `g5_write_main` where mb_id = '{$member["mb_id"]}'  ");
while($row = sql_fetch_array($store_r)){
    $list[] = $row;
}
//등롣대기 상점
$count = sql_query("select * from `store_temp` where mb_id = '{$member["mb_id"]}' and status = 0 ");
while($row = sql_fetch_array($count)){
    $temp[] = $row;
}
?>
<style>
    #store_view div.section01_header{border: 0;padding: 22px 0}
    .select-align{line-height: 33px;color: #444;text-align: center;font-weight: bolder;font-size: 15px;position: relative;top: -4px}
    .select-align span.radio:after{background-color:#6e6e6e;left: -113px !important;height: 26px !important;width: 26px !important;}
    .select-align span.radio:before{left: -116px !important;width: 80px !important;content: "영업종료";text-align: right;padding: 0 20px;height: 30px !important;}
    .select-align input[type="radio"]:checked + label span.radio:before{content: "영업중";text-align: left;padding: 0 10px 0 30px}
    .select-align input[type="radio"]:checked + label span.radio:after{left: -25px !important;}
    /*.select-align input[type="radio"]:checked + label span.radio:after*/
	.txt01{width: calc(100% - 20px);height: 30px;background: url(../../img/myshoplist_txt01.png) center no-repeat;padding: 10px;background-size: 68%;margin-bottom: 15px}
	.txt02{width: calc(100% - 20px);height: 30px;background: url(../../img/myshoplist_txt02.png) center no-repeat;padding: 10px;background-size: 90%;margin-bottom: 35px}
    .section01_content.no_list{text-align: center;margin:0 auto;padding:20px 0;}
</style>
<div class="width-fixed border-top">
    <?php
    for($i=0;$i<count($list);$i++){
        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'],"800","530");
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }
    ?>
    <section class="section01" id="store_view">
        <div class="section01_header store_title">
            <div>
                <h2 style="display: inline-block"><?php echo $list[$i]["wr_subject"];?></h2>
                <div class="select-align">
                    <input type="radio" name="align" id="hit" value="1" <?php if($list[$i]["wr_5"]=="N"){echo "";}else{echo "checked";} ?> onclick="location.href='<?php echo G5_URL."/page/shop/store_open_update.php?wr_id=".$list[$i]["wr_id"]."&state=".$list[$i]["wr_5"];?>'">
                    <label for="hit"><span class="radio"></span></label>
                </div>
            </div>
<!--
            <div class="store_edit">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_detail_form.php?w=cu&wr_id=<?php echo $list[$i]["wr_id"]?>"><i></i></a>
            </div>
            <div class="store_del">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_del.php"><i></i></a>
            </div>
-->
        </div>
        <div class="section01_content">
            <div style="text-align: center;background:#ddd;text-align: center;display: block">
                <a href="<?php echo G5_URL;?>/page/shop/my_store_view.php?wr_id=<?php echo $list[$i]["wr_id"];?>&type=shop">
                    <?php if($img_content) {echo $img_content;}else{?>
                    <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="no-image" style="text-align: center">
                    <?php }?>
                </a>
            </div>
        </div>
        <br>
        <div style="width:100%;cursor:pointer" class="btn shop_btn" onclick="location.href='<?php echo G5_URL;?>/page/shop/my_store_detail_form.php?w=cu&wr_id=<?php echo $list[$i]["wr_id"]?>'"><span>대표이미지</span> & 정보 수정하기
        </div>
        <p><span>나만의 상점</span>을 쉽고 편리하게 꾸며보세요~!</p>
<!--        <div class="txt01"></div>-->
        
        <div style="width:100%;cursor:pointer;margin:0" class="btn shop_btn" onclick="location.href='<?php echo G5_URL."/page/shop/my_store_menu_edit.php?wr_id=".$list[$i]["wr_id"]?>'"><span>메뉴</span> 수정하기
        </div>
        <p>자주 메뉴가 바뀐다고요? 메뉴만 따로 수정이 가능합니다~!</p>

        <!--        <div class="txt02"></div>-->
        
        <div style="width:100%;cursor:pointer;background:#8b8b8b;margin-bottom:30px" class="btn shop_btn" onclick="location.href='<?php echo G5_URL;?>/page/shop/my_store_del.php'"><span>착한가게</span> 탈퇴하기
        </div>
<!--
        <div class="list_btn_group">
            <input type="button" value="메뉴수정" class="btn bg_darkred grid_50 list_menu_edit_btn" onclick="location.href='<?php echo G5_URL."/page/shop/my_store_menu_edit.php?wr_id=".$list[$i]["wr_id"]?>'">
            <input type="button" value="<?php if($list[$i]["wr_5"]=="N"){?>상점오픈<?php }else{?>상점닫기<?php }?>" class="btn <?php if($list[$i]["wr_5"]=="N"){?>bg_gray<?php }else{?>bg_green<?php } ?> grid_50 list_menu_edit_btn" onclick="location.href='<?php echo G5_URL."/page/shop/store_open_update.php?wr_id=".$list[$i]["wr_id"]."&state=".$list[$i]["wr_5"];?>'">
        </div>
-->
    </section>
    <?php } if(count($list)==0 && count($temp)!=0){?>
    <section class="section01" id="store_view">
        <div class="section01_content no_list">
        <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
        <p>상점 심사 중입니다.<br>빠른 심사 등록은 고객만족센터에 문의바랍니다.</p>
        </div>
    </section>
    <?php } else if (count($list)==0 && count($temp)==0){?>
    <section class="section01" id="store_view">
        <div class="section01_content no_list">
            <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
            <p>등록된 상점이 없습니다.<br>상점을 등록해주세요.</p>
        </div>
    </section>
    <?php }?>
</div>
<div class="store_btn_group">
    <input type="button" class="store_add_btn" value="" onclick="location.href='<?php echo G5_URL;?>/page/shop/my_store_add.php?'"/>
</div>
<?php
include_once ("../../tail.php");
?>
