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
print_r2($_REQUEST);
print_r2($_POST);
?>
<style>
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
            <input type="text" name="cate_name" id="cate_name" value="<?php echo $ca_name; ?>">
            <input type="hidden" name="type" value="menuadd">
            <div class="con">
                <h2><span>STEP.2 </span>상세내용 입력</h2>
                <p>메뉴의 자세한 정보를 입력해주세요~</p>
                <div class="cart_add">
                    <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn2.png" alt=""></a>
                    <dl>
                        <dt class="menu_edit_title">사진</dt>
                        <dd>
                            <?php if($view[$i]["menu_image"]){?>
                                <img src="<?php echo G5_DATA_URL;?>/shop/menu/<?php echo $view[$i]["menu_image"];?>" alt="<?php echo $view[$i]["menu_name"]; ?>" style="width:100%;height: auto;position: relative;">
                            <?php }?>
                            <input type="file" name="menu_image" id="menu_image" value="" class="input01 input_file" accept="image/*" onchange="$(this).next().val(this.value)">
                            <input type="text" readonly style="width:75%;" class="input01 file_text" value="<?php echo  $view[$i]['menu_image']; ?>">
                            <label for="menu_image" id="main_file_label" class="input01" style="width:25%;">+</label>
                        </dd>
                        <dt>메뉴명 :</dt><dd><input type="text" name="menu_name" id="menu_name" value="<?php echo $menu_name?>" class="input01 grid_100"placeholder="메뉴를 입력해주세요."></dd>
                        <dt>메뉴설명 :</dt><dd><input type="text" name="menu_detail" id="menu_detail" value="<?php echo $menu_detail?>" class="input01 grid_100"placeholder="메뉴의 대한 설명을 입력해주세요."></dd>
                        <dt>가격 :</dt><dd><input type="text" name="menu_price" id="menu_price" value="<?php echo $menu_price?>" class="input01 grid_100"placeholder="가격 정보를 입력해주세요."></dd>
                        <dt>현장할인 :</dt><dd><input type="text" name="menu_price_discount" id="menu_price_discount" value="<?php echo $menu_price_discount?>" class="input01 grid_100"placeholder="현장 할인으로 매장의 방문수를 높여보세요."></dd>

                    </dl>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="btn_group">
            <a href="#" onclick="javascript:modal_close();" class="btn" style="background: #474747">취소</a>
            <a href="#" onclick="return fncate(<?php echo $id; ?>);" class="btn">다음단계</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    function fncate(id){
        var ca_name =$("#cate_name").val();
        var menu_name = $("#menu_name").val();
        var menu_detail = $("#menu_detail").val();
        var menu_price = $("#menu_price").val();
        var menu_price_discount = $("#menu_price_discount").val();
        if($("#menu_name").val() == ""){
            alert("메뉴를 입력해주세요.");
            $("#menu_name").focus();
            return false;
        }else if($("#menu_detail").val() == ""){
            alert("메뉴의 대한 설명을 입력해주세요.");
            $("#menu_detail").focus();
            return false;
        }else if($("#menu_price").val() == ""){
            alert("가격 정보를 입력해주세요.");
            $("#menu_price").focus();
            return false;
        }
        else{
//            document.store_cate_from.submit();
//            return true;
            $.post(g5_url+"/page/modal/store_cate_add3.php",{id:id,ca_name:ca_name,menu_name:menu_name,menu_detail:menu_detail,menu_price:menu_price,menu_price_discount:menu_price_discount},function(data){
                modal_close();
                $(".modal").html(data);
                modal_active();
            });
        }
    }
</script>