<?php
include_once("../../common.php");
$wr_id = $_REQUEST["wr_id"];
$catemenu=sql_query("select * from `store_category` where wr_id='{$wr_id}'");
while($row = sql_fetch_array($catemenu)){
    $view[] = $row;
}
$mainsql = sql_fetch("select * from `g5_write_main` where wr_id = '{$wr_id}'");
$wr_subject=$mainsql["wr_subject"];
$back_url=G5_URL."/page/shop/my_store_list.php";
include_once(G5_PATH."/head.php");
?>
    <style>
        .store_menu_title{padding:20px 10px;background:#fff;border-bottom:1px solid #ddd;border-top:1px solid #ddd;}
        .store_menu_title h2{font-size:33px;position: relative;display: inline-block}
        .store_menu_list{background:#fff;padding:10px;}
        .store_menu_list dd{padding:12px;font-size:21px;background:#474747;margin-top:10px;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;position:relative;color: #fff;text-align: center;cursor: pointer}
        .stroe_menu_list .store_menu span{color: #f17a40}
        .store_menu_list dd.first{margin-top:30px;}
        .store_menu_list dd img{height: auto;position: absolute;right:0;top:0;height:42px;}

        .select-align{line-height: 33px;color: #444;text-align: center;font-weight: bolder;font-size: 15px;position: relative;top: 5px}
        .select-align span.radio:after{background-color:#6e6e6e;left: -113px !important;height: 26px !important;width: 26px !important;}
        .select-align span.radio:before{left: -116px !important;width: 80px !important;content: "영업종료";text-align: right;padding: 0 20px;height: 30px !important;}
        .select-align input[type="radio"]:checked + label span.radio:before{content: "영업중";text-align: left;padding: 0 10px 0 30px}
        .select-align input[type="radio"]:checked + label span.radio:after{left: -25px !important;}
        div.img{margin: 30px 0 ;text-align: center}
    </style>
    <div class="width-fixed view">
        <form id="fregisterform" name="fregisterform" action="<?php echo G5_URL."/page/shop/my_store_add_update.php";?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="store_menu_title">
                <div>
                    <h2 class="detail_title"><?php echo $mainsql['wr_subject'] ?></h2>
                    <div class="select-align">
                        <input type="radio" name="align" id="hit" value="1" <?php if($mainsql["wr_5"]=="N"){echo "";}else{echo "checked";} ?> onclick="location.href='<?php echo G5_URL."/page/shop/store_open_update.php?wr_id=".$mainsql["wr_id"]."&state=".$mainsql["wr_5"];?>'">
                        <label for="hit"><span class="radio"></span></label>
                    </div>
                </div>

            </div>
            <div class="store_menu_list">
                <dl>
                    <?php
                    if(count($view) != 0){
                        for ($i = 0; $i < count($view); $i++) {
                        $count = sql_fetch("select COUNT(*) as cnt from `store_menu` where wr_id = '{$view[$i]["wr_id"]}' and ca_name = '{$view[$i]["ca_name"]}'")
                        ?>
                        <dd class="store_menu <?php if($i==0){?>first<?php }?>" onclick="location.href='<?php echo G5_URL ?>/page/shop/my_store_menu_2depth_edit.php?ca_name=<?php echo $view[$i]["ca_name"]; ?>&wr_id=<?php echo $wr_id ?>&ca_id=<?php echo $view[$i]["id"]?>'">
                            <span style="color:#f17a40;font-weight:bold "><?php echo $view[$i]["ca_name"]; ?></span> - 입력된 메뉴 총 <?php echo $count["cnt"]?> 개
                            <a href="<?php echo G5_URL?>/page/shop/my_store_menu_2depth_edit.php?ca_name=<?php echo $view[$i]["ca_name"]; ?>&wr_id=<?php echo $wr_id?>&ca_id=<?php echo $view[$i]["id"]?>"></a>
                        </dd>
                    <?php }
                    }else { ?>
                        <dd class="store_menu first" onclick="add_cate('<?php echo $mainsql["wr_id"]?>');">등록된 분류가 없습니다.</dd>
                        <dd class="store_menu " onclick="add_cate('<?php echo $mainsql["wr_id"]?>');">하단 추가 버튼을 통해 등록바랍니다.</dd>
                    <?php } ?>
                </dl>
                <div class="img"><img src="<?php echo G5_IMG_URL ?>/edti_txt.png" alt=""></div>
            </div>
        </form>
    </div>
<div class="store_btn_group">
    <input type="button" class="store_add_btn" value="" onclick="add_cate('<?php echo $mainsql["wr_id"]?>');"/>
</div>
<script>
    function add_cate(id){
        $.post(g5_url+"/page/modal/store_cate_add.php",{id:id},function(data){
            $(".modal").html(data);
            modal_active();
        });
    }
</script>
<?php
include_once(G5_PATH."/tail.php");
?>
