<?php
include_once('../../common.php');

$menu_name = $_REQUEST["menu"];
$price = $_REQUEST["price"];
$id = $_REQUEST["id"];

$menu = sql_fetch("select * from `store_menu` where `id` = '{$id}'");
?>
<style>
    .con table{width:100%;}
    .con table tr th{width:30%;text-align: left;font-size:16px;}
    .con table tr td{width:70%;height:44px;text-align: right;font-size:16px;}
    @media all and (max-width: 480px){
        .con table tr th , .con table tr td{font-size:14px;}
    }
</style>
<div class="reserve_view">
    <div id="reserve_result">
        <input type="hidden" name="wr_id" value="<?php echo $menu["wr_id"]?>">
        <input type="hidden" name="menu_price" class="menu_price" value="<?php echo $price?>">
        <input type="hidden" name="menu_name" class="menu_name" value="<?php echo $menu_name?>">
        <div class="con">
            <h2>장바구니 추가</h2>
            <div class="cart_add">
                <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
                <table>
                    <tr>
                        <th class="cart_title">상품명 :</th>
                        <td><span id="menu_name"><?php echo $menu["menu_name"]?></span></td>
                    </tr>
                    <tr>
                        <th class="cart_title">가격(개당) :</th>                        
                        <td><span id="price"><?php echo $menu["menu_price"]?> 원</span></td>
                    </tr>
                    <tr>
                        <th class="cart_title">개수 :</th>
                        <td class="num_dd"><input type="button" value="-" id="minus"><input id="num" name="num" value="1" readonly><input type="button"value="+" id="plus"></td>
                    </tr>
            <?php
            if($menu["option"]){
            $options = explode("|" , $menu["option"]);
            $option_prices = explode("|" , $menu["option_price"]);
            ?>
                <tr>
                    <th>옵션 :</th>
                    <td class="option_dd">
                        <select name="option" id="option">
                            <option value="0/">추가 옵션</option>
                            <?php
                            for($i=0;$i<count($options);$i++){
                                ?>
                                <option value="<?php echo $options[$i]?>/<?php echo $option_prices[$i]?>"><?php echo $options[$i]?>(<?php echo $option_prices[$i]?> 원)</option>
                                <?php
                            }
                            ?> 
                        </select>
                    </td>
                </tr>
                <tr>
                    <th class="cart_title">총합계 :</th>
                    <td><span class="total_price" id="total_price"><?php echo $price;?> 원</span></td>
                    <input type="hidden" name="menu_total_price" class="menu_total_price" value="<?php echo $price; ?>">
                </tr>
            <?php }else{?>
                <tr>
                    <th class="cart_title">총합계 :</th>
                    <td><span class="total_price" id="total"><?php echo $price?> 원</span></td>
                </tr>
            <?php }?>
                </table>
            <div class="clear"></div>
            </div>
        </div>        
    </div>
    <div class="btn_group">
		<a href="javascript:fn_submit2();" class="btn">바로구매</a>
        <a href="javascript:fn_submit();" class="btn">추가</a>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $("#plus").click(function(){
            var num = Number($("#num").val())+1;
            $("#num").val(num);
            if($(".menu_total_price").val()){
                var price = (Number($(".menu_total_price").val()) ) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }else{
                var price = Number($(".menu_price").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }
        })
        $("#minus").click(function(){
            var num = Number($("#num").val());
            if(num > 1) {
                num=num-1;
                $("#num").val(num);
            }
            if($(".menu_total_price").val()){
                var price = Number($(".menu_total_price").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }else{
                var price = Number($(".menu_pri" +
                        "ce").val()) * num;
                $(".total_price").html(number_format(String(price)) + "원");
            }
        })
        $("#option").change(function(){
            var option_price = $(this).val().split("/");
            var num = Number($("#num").val());
            var price = Number($(".menu_price").val());
            $(".menu_total_price").val(Number(option_price[1])+price);
            var total_price = (price + Number(option_price[1])) * num;
            $(".total_price").html(number_format(String(total_price)) + "원");
        })
    })
    function fn_submit(){
        $.ajax({
            url:"<?php echo G5_URL?>/page/mypage/cart_update.php",
            method:"POST",
            data:{"wr_id":"<?php echo $menu["wr_id"]?>", "mb_id":"<?php echo $member['mb_id']?>","menu_name":$(".menu_name").val(),"menu_price":$(".menu_price").val(),"menu_option":$("#option").val(),"num":$("#num").val(),"type":"add"}
        }).done(function(data){
            if(data){
                alert("추가 되었습니다.");
            }
            $(".cart_count").html(data);
            modal_close();
        })
    }
	function fn_submit2(){
        $.ajax({
            url:"<?php echo G5_URL?>/page/mypage/cart_update2.php",
            method:"POST",
            data:{"wr_id":"<?php echo $menu["wr_id"]?>", "mb_id":"<?php echo $member['mb_id']?>","menu_name":$(".menu_name").val(),"menu_price":$(".menu_price").val(),"menu_option":$("#option").val(),"num":$("#num").val(),"type":"add"}
        }).done(function(data){
			if(data != ""){
				alert("구매페이지로 이동합니다.");
				location.href=g5_url+'/page/mypage/order_form.php?form_cart_id='+data;
			}else{
				alert("잘못된 요청입니다.");
				modal_close();
			}
        })
    }
</script>