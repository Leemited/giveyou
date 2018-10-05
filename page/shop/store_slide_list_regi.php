<?php
include_once("../../common.php");
$wr_id = $_REQUEST["wr_id"];

$sql = sql_query("select * from `g5_write_main` where `mb_id` = '{$member["mb_id"]}' and wr_3 = 'N' and wr_is_comment = 0 and wr_file != 0");
$cnt = 0;
while($row = sql_fetch_array($sql)){
    $cnt++;
}

$sql = "select * from `g5_write_main` where mb_id = '{$member["mb_id"]}'";

$res = sql_query($sql);
while($row = sql_fetch_array($res)){
    $list[] = $row;
}

$wr_subject="슬라이드 등록 신청";
$back_url=G5_URL."/page/shop/premium_menu.php?wr_id=".$wr_id;
include_once(G5_PATH."/head.php");
?>
<style>
    img.info{
        position: absolute;
        width:30px;
        left:10px;
        top:6px;
    }
    .add_img_group{padding:10px 0;width: 100%;text-align: center;display: block}
    .add_img_group > input{border:none;}
    #view_section_info h2.detail_title{padding-left:50px;}
    .store_sel_btn{padding:10px;font-size:15px;color:#FFF}
    .slide_ul li{padding:15px 3%;font-size: 16px;border-top:1px solid #ddd;vertical-align: middle;display: inline-block;width: 94%}
    .slide_ul li span{margin-left:10px;padding:4px; font-size:12px; background:#ffce31;color:#000}
    .slide_ul li input{margin-left:10px;padding:4px; font-size:12px; color:#FFF;float:right;}
    .slide_ul li.first{border-top:none;}
    @media all and (max-width: 480px){
        .add_img_group {width:100%;}
        #view_section_info .section01_content dt{width:100%}
        #view_section_info .section01_content dd{width:98%}
    }
</style>
<div class="width-fixed view">
    <section class="section01" id="view_section_info">
        <div class="section01_header">
            <div ><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">신청현황</h2></div>
        </div>
        <div class="section01_content">
            <ul class="slide_ul">
                <?php
                for($i=0;$i<count($list);$i++){
                    switch ($list[$i]["wr_3"]){
                        case "N":
                            $state = "신청대기";
                            break;
                        case "Y":
                            $state = "신청완료";
                            break;
                        case "W":
                            $state = "승인요청";
                            break;
                    }
                ?>
                <li class="<?php if($i==0){echo "first";}?>"><?php echo $list[$i]["wr_subject"]?><span><?php echo $state?></span><?php if($list[$i]["wr_3"]=="N"){?><input type="button" class="btn bg_darkred store_sel_btn" value="신청하기" onclick="fnSel('<?php echo $list[$i]["wr_subject"]?>','<?php echo $list[$i]["wr_id"];?>')"><?php }?></li>
                <?php }?>
            </ul>
        </div>
    </section>
    <form id="fregisterform" name="fregisterform" action="<?php echo G5_URL."/page/shop/store_slide_list_update.php";?>" method="post" enctype="multipart/form-data" autocomplete="off">
        <input type="hidden" name="wr_id" id="wr_id">
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div ><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">등록정보</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>등록상점</dt>
                    <dd><input type="text" name="store_name" id="store_name" class="input01" required readonly> <input type="button" value="상점선택" onclick="<?php if($cnt==0){?>alert('등록 가능한 상점이 없습니다.');<?php }else{?>fnSelectStore('<?php echo $member["mb_id"];?>')<?php }?>" class="btn bg_darkred store_sel_btn"></dd>
                    <dt>등록기간</dt>
                    <dd><input type="text" name="start_date" class="input01" id="datepicker1" required> ~ <input type="text" name="end_date" class="input01" id="datepicker2" required></dd>
                </dl>
            </div>
            <div>
                <input type="submit" class="btn bg_darkred grid_100 store_sel_btn" value="신청하기">
            </div>
        </section>
    </form>
    <section>

    </section>
</div>
<!--<div class="store_btn_group">
    <input type="button" class="store_add_btn" value="" onclick="add_cate('<?php /*echo $mainsql["wr_id"]*/?>');"/>
</div>-->
<script>
    function add_cate(id){
        $.post(g5_url+"/page/modal/store_cate_add.php",{id:id},function(data){
            $(".modal").html(data);
            modal_active();
        });
    }
    function fnSelectStore(id) {
        $.post(g5_url+"/page/modal/store_sel.php",{id:id},function(data){
            $(".modal").html(data);
            modal_active();
        });
    }
    $(function(){
        $("#datepicker1").datepicker({
            dateFormat:"yy-mm-dd",
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토']
        });
        $("#datepicker2").datepicker({
            dateFormat:"yy-mm-dd",
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토']
        });
        $("#datepicker1, #datepicker2").change(function(){
            var date1 = $("#datepicker1").val();
            var date2 = $("#datepicker2").val();
            if(date1 != "" && date2 != "") {
                if (date1 > date2) {
                    alert("시작일 보다 종료일이 적습니다.");
                    $("#datepicker2").val("");
                }
            }
        })
    })
    function fnSel(subject,id){
        $("#store_name").val(subject);
        $("#wr_id").val(id);
    }
</script>
<?php
include_once(G5_PATH."/tail.php");
?>
