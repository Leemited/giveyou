<?php
include_once('../../common.php');
$id = $_REQUEST["id"];
?>

<div class="reserve_view">
    <form action="<?php echo G5_URL."/page/shop/store_menu_update.php";?>" method="post" name="store_cate_from">
        <div id="reserve_result">
            <input type="hidden" name="wr_id" value="<?php echo $id?>">
            <input type="hidden" name="type" value="cateadd">
            <div class="con">
                <h2>분류 추가</h2>
                <div class="cart_add">
                    <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
                    <dl>
                        <dt>분류명 :</dt><dd><input type="text" name="cate_name" id="cate_name" value="<?php echo $menu_name?>" class="input01 grid_100"></dd>
                    </dl>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="btn_group">
            <a href="#" onclick="return fncate();" class="btn">추가</a>
        </div>
    </form>
</div>
<script type="text/javascript">
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
</script>