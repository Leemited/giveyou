<?php
include_once('../../common.php');
$id = $_REQUEST["id"];
$wr_id = $_REQUEST["wr_id"];
$ca_name = $_REQUEST["ca_name"];
$ca_id = $_REQUEST["ca_id"];
$sql=sql_query("select * from `store_menu` where wr_id='{$wr_id}' and ca_name = '{$ca_name}'");
while($row = sql_fetch_array($sql)){
    $view[] = $row;
}
print_r2($view);
print_r2($_POST);
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


    .btn{border-radius: 4px;}
    #reserve_result .con .cart_add{margin: 40px 0}
    #reserve_result .con h2{font-weight: bolder;background: #fff;color: #000;font-size: 27px}
    #reserve_result .con h2 span{color: #f17a40;font-size: 31px}
    #reserve_result .con p{position: relative;padding: 30px 10px;font-size: 16px;font-weight: bolder;margin: 0;letter-spacing: -0.8px;}
</style>
<div class="reserve_view">
    <form action="<?php echo G5_URL."/page/shop/store_menu_update.php";?>" method="post" name="store_cate_from">
        <div id="reserve_result">
            <input type="hidden" name="wr_id" value="<?php echo $id?>">
            <input type="hidden" name="cate_name" value="<?php echo $ca_name; ?>">
            <input type="hidden" name="type" value="menuadd">
            <div class="con">
                <h2><span>STEP.3 </span>옵션추가</h2>
                <p>메뉴 추가옵션 정보를 입력해주세요~</p>
                <div class="cart_add">
                    <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn2.png" alt=""></a>
                    <dl>

                        <div class="option_area">
                            <?php if ($view[$i]["option"]) {
                                $option_detail = explode("|", $view[$i]["option"]);
                                $option_price_detail = explode("|", $view[$i]["option_price"]);
                                for ($j = 0; $j < count($option_detail); $j++) {
                                    ?>
                                    <div class="option" id="<?php echo $view[$i]["id"].$j?>">
                                        <dt class="menu_edit_title">옵션</dt>
                                        <dt class="menu_edit_title harf">옵션가격</dt>
                                        <div class="menu_edit_title harf edit">삭제</div>
                                        <dd><input type="text" name="menu_option[]" value="<?php echo $option_detail[$j]; ?>" class="input01 grid_100"></dd>
                                        <div class="harf"><input type="text" name="option_price[]" value="<?php echo $option_price_detail[$j]; ?>" class="input01 grid_100"></div>
                                        <div class="harf edit"><input type="button" value="X" class="btn grid_100 option_del_btn input01" onclick="option_del('<?php echo $j?>','<?php echo $view[$i]["id"]?>','<?php echo $ca_name?>');"></div>
                                    </div>
                                    <div class="clear"></div>
                                <?php }
                            } ?>
                        </div>
                        <input type="button" value="옵션 하나 더 추가하기" class="btn grid_100 menu_option_add_btn">
<!--                        <input type="submit" value="▲" class="btn menu_edit_btn" >-->
<!--                        <input type="button" value="X" class="btn menu_close_btn" onclick="location.href='--><?php //echo G5_URL;?>///page/shop/store_menu_update.php?type=menudel&menu_id=<?php //echo $view[$i]["id"];?>//&wr_id=<?//=$wr_id?>//&cate_name=<?//=$ca_name?>//'">
                        <dt>가격 :</dt><dd><input type="text" name="menu_price" id="menu_price" value="<?php echo $menu_price?>" class="input01 grid_100"placeholder="가격 정보를 입력해주세요."></dd>
                        <dt>현장할인 :</dt><dd><input type="text" name="menu_price_discount" id="menu_price_discount" value="<?php echo $menu_price_discount?>" class="input01 grid_100"placeholder="현장 할인으로 매장의 방문수를 높여보세요."></dd>

                    </dl>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="btn_group">
            <a href="#" onclick="javascript:modal_close();" class="btn" style="background: #474747">취소</a>
            <a href="#" onclick="return fncate();" class="btn">완료</a>
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
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var option = $(".option_clone").clone();
        $(".menu_option_add_btn").click(function(){
            $(this).parent().find(".option_area").append(option.html());
        })
    })
    function fncate(){
        if($("#cate_name").val() == ""){
            alert("분류명을 입력해야합니다.");
            $("#cate_name").focus();
            return false;
        }else{
            document.store_cate_from.submit();
            return true;
        }
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
</script>