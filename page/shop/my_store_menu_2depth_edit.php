<?php
include_once("../../common.php");
$wr_id = $_REQUEST["wr_id"];
$num = $_REQUEST["num"];
$ca_name = $_REQUEST["ca_name"];
$ca_id = $_REQUEST["ca_id"];
$sql=sql_query("select * from `store_menu` where wr_id='{$wr_id}' and ca_name = '{$ca_name}'");
while($row = sql_fetch_array($sql)){
    $view[] = $row;
}

$mainsql = sql_fetch("select * from `g5_write_main` where wr_id='{$wr_id}'");
$wr_subject=$mainsql["wr_subject"];
$back_url=G5_URL."/page/shop/my_store_menu_edit.php?wr_id=".$wr_id;
include_once(G5_PATH."/head.php");
?>
<style>
    .store_menu{position:relative}
    .store_menu_title{padding:10px;background:#fff;border-bottom:1px solid #ddd;border-top:1px solid #ddd;}
    .store_menu_title h2{font-size:18px;}
    .store_menu_title a{height: auto;position: absolute;right:0;top:5px;height:35px;display: block}
    .store_menu_title a img{height:35px;}
    .store_menu_list{background:#ddd;padding:10px 10px 100px 10px;height:100%;}
    .store_menu_list dd{padding:12px;font-size:16px;background:#fff;margin-top:25px;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;position:relative}
    .store_menu_list dd.first{margin-top:15px;}
    .store_menu_list dd img{height: auto;position: absolute;right:0;top:0;height:42px;}
    .menu_area .menu_edit_title{font-weight: bold;font-size:16px;padding:5px 0;}
    .menu_area .option{padding:10px 0;position:relative;display: inline;}
    .menu_area .option div{width:42%;float:left;}
    .menu_area .option div.edit {width:12%;}
    .menu_area .option div.harf{margin-left:2%;}
    .menu_area .option div .option_del_btn{line-height:initial !important;min-width:30px;max-width: 80px;background:#cf1616;color:#fff;font-size:15px;border:none;}
    .menu_option_add_btn{padding:10px;background:#ffce31;color:#000;margin-top:15px;}
    .menu_edit_btn{position:absolute;top:-15px;right:55px;width:38px;height:38px;background:#18b54d;color:#fff;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;font-size:15px;}
    .menu_close_btn{position:absolute;top:-15px;right:12px;width:38px;height:38px;background:#cf1616;color:#fff;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px;font-size:15px;}
</style>
<div class="width-fixed view">
        <div class="store_menu_title">
            <div><h2 class="detail_title"><?php echo $ca_name;?></h2><a href="<?php echo G5_URL;?>/page/shop/store_menu_update.php?wr_id=<?php echo $wr_id?>&ca_id=<?php echo $ca_id?>&ca_name=<?php echo $ca_name?>&type=catedel" ><img src="<?php echo G5_IMG_URL;?>/cart_close_btn.png" alt=""></a></div>
        </div>
        <div class="store_menu_list" >
            <dl>
                <?php
                if(count($view)>0) {
                    for ($i = 0; $i < count($view); $i++) {
                        ?>
                        <dd class="store_menu <?php if ($i == 0) { ?>first<?php } ?>">
                            <form action="<?php echo G5_URL?>/page/shop/store_menu_update.php" enctype="multipart/form-data" method="post" onsubmit="fn_update();">
                                <input type="hidden" value="<?php echo $view[$i]["id"]?>" name="menu_id">
                                <input type="hidden" value="<?php echo $wr_id?>" name="wr_id">
                                <input type="hidden" value="<?php echo $ca_name?>" name="cate_name">
                                <input type="hidden" value="menuupdate" name="type">
                                <div class="menu_area">
                                    <?php if ($mainsql["wr_7"] == 1) { ?>
                                        <div class="menu_edit_title">사진</div>
                                        <div>
                                            <?php if($view[$i]["menu_image"]){?>
                                                <img src="<?php echo G5_DATA_URL;?>/shop/menu/<?php echo $view[$i]["menu_image"];?>" alt="<?php echo $view[$i]["menu_name"]; ?>" style="width:100%;height: auto;position: relative;">
                                            <?php }?>
                                            <input type="file" name="menu_image" id="menu_image" value="" class="input01 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
                                            <input type="text" readonly style="width:75%;" class="input01 file_text" value="<?php echo  $view[$i]['menu_image']; ?>">
                                            <label for="menu_image" id="main_file_label" class="input01" style="width:25%;">+</label>
                                        </div>
                                    <?php } ?>
                                    <div class="menu_edit_title">상품명 <span>*</span></div>
                                    <div><input type="text" name="menu_name" value="<?php echo $view[$i]["menu_name"]; ?>" class="input01 grid_100"></div>
                                    <div class="menu_edit_title">상품설명</div>
                                    <div><input type="text" name="menu_detail" value="<?php echo $view[$i]["menu_detail"]; ?>" class="input01 grid_100"></div>
                                    <div class="menu_edit_title">가격 <span>*</span></div>
                                    <div><input type="text" name="menu_price" value="<?php echo $view[$i]["menu_price"]; ?>" class="input01 grid_100"></div>
									 <div class="menu_edit_title">할인가격 <span>*</span></div>
                                    <div><input type="text" name="menu_price_discount" value="<?php echo $view[$i]["menu_price_discount"]; ?>" class="input01 grid_100"></div>
                                    <div class="option_area">
                                    <?php if ($view[$i]["option"]) {
                                        $option_detail = explode("|", $view[$i]["option"]);
                                        $option_price_detail = explode("|", $view[$i]["option_price"]);
                                        for ($j = 0; $j < count($option_detail); $j++) {
                                            ?>
                                            <div class="option" id="<?php echo $view[$i]["id"].$j?>">
                                                <div class="menu_edit_title">옵션</div>
                                                <div class="menu_edit_title harf">옵션가격</div>
                                                <div class="menu_edit_title harf edit">삭제</div>
                                                <div><input type="text" name="menu_option[]" value="<?php echo $option_detail[$j]; ?>" class="input01 grid_100"></div>
                                                <div class="harf"><input type="text" name="option_price[]" value="<?php echo $option_price_detail[$j]; ?>" class="input01 grid_100"></div>
                                                <div class="harf edit"><input type="button" value="X" class="btn grid_100 option_del_btn input01" onclick="option_del('<?php echo $j?>','<?php echo $view[$i]["id"]?>','<?php echo $ca_name?>');"></div>
                                            </div>
                                            <div class="clear"></div>
                                        <?php }
                                    } ?>
                                    </div>
                                    <input type="button" value="옵션추가" class="btn grid_100 menu_option_add_btn">
                                    <input type="submit" value="▲" class="btn menu_edit_btn" >
                                    <input type="button" value="X" class="btn menu_close_btn" onclick="location.href='<?php echo G5_URL;?>/page/shop/store_menu_update.php?type=menudel&menu_id=<?php echo $view[$i]["id"];?>&wr_id=<?php echo $wr_id?>&cate_name=<?php echo $ca_name?>'">
                                </div>
                            </form>
                        </dd>

                    <?php }
                }else{ ?>
                    <dd class="store_menu first">현재 등록된 메뉴가 없습니다.</dd>
                    <dd class="store_menu">메뉴는 하단 추가버튼으로 등록바랍니다.</dd>
                <?php }?>
                <dd class="store_menu">모바일에서 이상이 있을 경우 PC모드에서 등록 바랍니다.</dd>
            </dl>
        </div>
</div>
<div class="store_btn_group">
    <input type="button" class="store_add_btn" value="" onclick="add_menu('<?php echo $mainsql["wr_id"]?>','<?php echo $ca_name;?>');"/>
</div>
<div class="option_clone" style="display:none;">
    <div class="option">
        <div class="menu_edit_title">옵션</div>
        <div class="menu_edit_title harf">옵션가격</div>
        <div class="menu_edit_title harf edit">삭제</div>
        <div><input type="text" name="menu_option[]" value="" class="input01 grid_100"></div>
        <div class="harf"><input type="text" name="option_price[]" value="" class="input01 grid_100"></div>
        <div class="harf edit"><input type="button" value="X" class="btn grid_100 option_del_btn input01"onclick="fn_option_new(this)"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<script>
    $(document).ready(function(){
        var option = $(".option_clone").clone();
        $(".menu_option_add_btn").click(function(){
            $(this).parent().find(".option_area").append(option.html());
        })
    })
    function add_menu(id,ca_name){
        location.href=g5_url+'/page/shop/store_menu_add.php?id='+id+"&ca_name="+ca_name;
    }
    function option_del(num,id,ca_name){
        $.ajax({
            url:g5_url+"/page/shop/store_menu_update.php",
            method:"POST",
            data:{id:id,num:num,cate_name:ca_name,type:"deloption"}
        }).done(function(data){
            if(data==0){
                $("#"+id+""+num).remove();
            }else{
                alert("삭제에 실패했습니다.");
            }
        })
    }

    function  fn_option_new(obj) {
        obj.parentNode.parentNode.remove();
    }

    function fn_update(){
        /*$.ajax({
            url:g5_url+"/page/shop/store_menu_update.php",
            method:"POST",
            data:{id:id,num:num,cate_name:ca_name,type:"menuupdate"}
        }).done(function(data){

        })*/
    }

</script>
<?php
include_once(G5_PATH."/tail.php");
?>
