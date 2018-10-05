<?php
include_once('../../common.php');
$id = $_REQUEST["id"];
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
            <input type="hidden" name="type" value="cateadd">
            <div class="con">
                <h2><span>STEP.1 </span>분류 추가</h2>
                <p>메뉴의 분류를 입력해주세요~</p>
                <div class="cart_add">
                    <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn2.png" alt=""></a>
                    <dl>
                        <dt>분류명 :</dt><dd><input type="text" name="cate_name" id="cate_name" value="<?php echo $menu_name?>" class="input01 grid_100"placeholder="메뉴의 분류를 입력해주세요"></dd>
                    </dl>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="btn_group">
            <a href="#" onclick="modal_close();" class="btn" style="background: #474747">취소</a>
            <a href="#" onclick="return fncate('<?php echo $id; ?>');" class="btn">다음단계</a>
        </div>
    </form>
</div>
<script type="text/javascript">
    function fncate(id){
        var ca_name =$("#cate_name").val();
        if($("#cate_name").val() == ""){
            alert("분류명을 입력해야합니다.");
            $("#cate_name").focus();
            return false;
        }else{
            $.post(g5_url+"/page/modal/store_cate_add2.php",{id:id,ca_name:ca_name},function(data){
                modal_close();
                $(".modal").html(data);
                modal_active();
            });
        }
    }
</script>