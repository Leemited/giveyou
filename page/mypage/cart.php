<?php
include_once("../../common.php");
if(!$member['mb_id']){
    $mb_id = $_COOKIE["PHPSESSID"];
}else{
    $mb_id = $member["mb_id"];
}

if($wr_id) {
    $back_url = G5_URL . "/page/rent/view.php?wr_id=" . $_REQUEST["wr_id"];
}else{
    $back_url = G5_URL;
}
$wr_id=$mb_id;
$wr_subject="장바구니";
include_once(G5_PATH."/head.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$result = sql_query("select a.*,b.* from `cart` as a left join `g5_write_main` as b on a.wr_id = b.wr_id where (a.mb_id = '{$mb_id}' or a.mb_id = '{$_COOKIE[PHPSESSID]}' ) and a.cart_date = CURRENT_DATE() and cart_state=0");
while ($row = sql_fetch_array($result)){
    $list[] = $row;
}

if($is_member) {
    $cart_update = "update `cart` set mb_id = '{$mb_id}' where mb_id = '{$_COOKIE[PHPSESSID]}' and cart_state = 0 ";
    sql_query($cart_update);
}
?>
<style>

</style>
<div class="width-fixed view">
    <?php if(count($list)!=0){?>
    <section class="section01" id="view_section_info">
        <div class="section01_content">
            <input type="hidden" value="<?php echo count($list)?>" name="total_cart" id="total_cart">
            <div class="allchk"><label for="allchk"><input type="checkbox" name="allchk" id="allchk" checked>  전체선택 전체 <?php echo count($list)?>개 중 <span class="select_count"><?php echo count($list)?></span>개 선택</label> </div>
        </div>
    </section>
    <?php }?>
    <?php
    $order_total = 0;
    $cart_ids = "";
    for($i=0;$i<count($list);$i++){
        $cart_ids .= $list[$i]["cart_id"].",";
        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 300, 180);
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }
        $all_total_price = 0;
        if($list[$i]["menu_option"]){
            $all_total_price += ($list[$i]["menu_price"] + $list[$i]["option_price"]) * $list[$i]["menu_count"];
        }else {
            $all_total_price += $list[$i]["menu_price"] * $list[$i]["menu_count"];
        }
        $order_total += $all_total_price;
        $dp = sql_fetch("select delivery_price from `store_detail` where wr_id = '{$list[$i]['wr_id']}'");
    ?>
    <section class="section01" id="view_section">
        <div class="section01_content order_item" >
		    <form class="cart_forms">
					<input type="hidden" value="del" name="type">
					<input type="hidden" value="<?php echo $list[$i]["cart_id"]?>" name="cart_id" id="cart_id" readonly>
					<input type="hidden" value="<?php echo $list[$i]["wr_id"]?>" name="wr_id"  readonly>
					<input type="hidden" value="<?php echo $list[$i]["menu_price"]?>" name="price" class="menu_price"  readonly>
					<input type="hidden" value="<?php echo $list[$i]["option_price"]?>" name="option_price" class="option_price"  readonly>
					<input type="hidden" value="<?php echo $all_total_price;?>" name="total_price" id="total_price"  readonly>
					<input type="hidden" value="on" name="mode" id="mode"  readonly>
					<div class="close_btn"><a href="<?php echo G5_URL?>/page/mypage/cart_update.php?cart_id=<?php echo $list[$i]["cart_id"]?>&type=del"><img src="<?php echo G5_IMG_URL?>/cart_close_btn.png" alt="delete_btn"></a></div>
					<div class="store_name" onclick="fnLink('<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $list[$i]['wr_id']?>');">
                        <h2><?php echo $list[$i]["wr_subject"]?></h2>
                    </div>
					<dl>
						<dt>메뉴명</dt>
						<dd><?php echo $list[$i]["menu_name"]?></dd>
						<dt>메뉴가격</dt>
						<dd><?php echo number_format($list[$i]["menu_price"])?> 원</dd>
						<?php
						if($list[$i]["menu_option"]){
						?>
						<dt>옵션</dt>
						<dd><?php echo $list[$i]["menu_option"]?>(<?php echo number_format($list[$i]["option_price"])?> 원)</dd>
						<?php }?>
						<dt>수량</dt>
						<dd><input type="button" value="-" id="minus" onclick="fnMinus(this.form,'<?php echo $i?>');"><input id="num" name="num" value="<?php echo $list[$i]["menu_count"]?>" readonly style="text-align: center"><input type="button" value="+" id="plus" onclick="fnPlus(this.form,'<?php echo $i?>');"></dd>
					</dl>
					<dl class="last">
						<dt>주문금액</dt>
						<dd class="order_item_price" name="order_item_price" id="order_item_price<?php echo $i?>"><?php echo number_format($all_total_price);?> 원</dd>
					</dl>
				<div class="clear"></div>
                <div class="give_btn">
                    <input type="button" value="선택" class="btn grid_100 cart_choice on" onclick="fnChoise(this.form, this);">
                </div>
            </form>
		</div>
        <div class="clear"></div>
    </section>

    <?php }if(count($list)==0){?>
    <section class="section01" id="view_section" style="margin-bottom: 0;border:none;">
        <div class="section01_content">
            <div class="no_list">
                <p><img src="<?php echo G5_IMG_URL?>/cart_no_list_icon.png" alt="카트"><br>장바구니가 비었네요!<br>맘에 드는 상품을 골라 장바구니에 담아보세요!</p>
            </div>
        </div>
    </section>
    <?php }?>
    <section class="section01" id="view_section" style="margin-bottom:0;">
        <div class="section01_content">
            <?php if(count($list)!=0){?>
            <div class="order_info">
                <div>상품금액</div>
                <div class="price"><?php echo number_format($order_total)?> 원</div>
            </div>
            <div class="clear"></div>
            <div><label for="info_icon"></label><i id="info_icon"></i> 카트에 담긴 상품은 최대 30일까지 보관하며 종료되거나 매진일 경우 자동으로 삭제됩니다.</div>
        </div>
		<?php }?>
		<div class="give_btn">
			<form action="<?php echo G5_URL?>/page/mypage/order_form.php" method="post" name="order_action">
				<input type="hidden" name="type" value="order">
				<input type="hidden" value="<?php echo $cart_ids?>" name="form_cart_id" id="form_cart_id">
				<input type="button" value="계속쇼핑하기" class="btn grid_100 shop" onclick="location.href='<?php echo G5_URL?>';">
				<?php if(count($list)!=0){?>
				<input type="button" value="결제하기" class="btn grid_100 order" onclick="fnOrder('order');return false">
				<?php }?>
			</form>
			<?php if(count($list)!=0){?>
			<form action="<?php echo G5_URL?>/page/mypage/order_form.php" name="order_action2" method="post">
				<input type="hidden" name="type" value="reserve">
				<input type="hidden" value="<?php echo $cart_ids?>" name="form_cart_id" id="form_cart_id">
				<!--<input type="button" value="방문 예약하기" class="btn grid_100 reserve" onclick="fnOrder('reserve');return false">-->
			</form>
			<?php }?>
		</div>
    </section>
</div>
<script>
    function fnLink(url){
        location.href=url;
    }

    function fnOrder(form){
        if($("#form_cart_id").val()=="") {
            alert("결제할 상품을 선택해주세요.");
            return false;
        }else{
            if(form=="order")
                document.order_action.submit();
            else
                document.order_action2.submit();
        }
    }
    function fnPlus(formData,i) {
        var count = formData.num;
        var num = count.value;
        count.value = Number(count.value) + 1;
        num++;
        var cart_id = formData.cart_id.value;
        $.ajax({
            url:"<?php echo G5_URL?>/page/mypage/cart_update.php",
            method:"POST",
            data:{'cart_id':cart_id,"num": num,"type":"update"}
        }).done(function(){
            if(formData.option_price.value != 0) {
                var number = (Number(formData.price.value)+Number(formData.option_price.value)) * num;
                number = number.format();
                formData.total_price.value = (Number(formData.price.value)+Number(formData.option_price.value)) * num;
                $("#order_item_price"+i).html(number + " 원");
            }else {
                var number = Number(formData.price.value) * num;
                number = number.format();
                formData.total_price.value = Number(formData.price.value) * num;
                $("#order_item_price"+i).html(number + " 원");
            }
            if(formData.mode.value == "on"){
                var total_p = 0;
                $("dd[id^=order_item_price]").each(function(e){
                    var price = $(this).text().replace(" 원","");
                    price = price.replace(",","");
                    total_p = total_p + Number(price);
                    $(".price").html(total_p.format() + " 원");
                })
            }
        })
    }
    function fnMinus(formData,i) {
        var count = formData.num;
        var num = count.value;
        if(num > 1) {
            count.value = Number(count.value) - 1;
            num--;
        }
        var cart_id = formData.cart_id.value;
        $.ajax({
            url:"<?php echo G5_URL?>/page/mypage/cart_update.php",
            method:"POST",
            data:{'cart_id':cart_id,"num": num,"type":"update"}
        }).done(function(data){
            if(formData.option_price.value) {
                var number = (Number(formData.price.value)+Number(formData.option_price.value)) * num;
                number = number.format();
                formData.total_price.value = (Number(formData.price.value)+Number(formData.option_price.value)) * num;
                $("#order_item_price"+i).html(number + " 원");
            }else {
                var number = Number(formData.price.value) * num;
                number = number.format();
                formData.total_price.value = Number(formData.price.value) * num;
                $("#order_item_price"+i).html(number + " 원");
            }
            if(formData.mode.value == "on"){
                var total_p = 0;
                $("dd[id^=order_item_price]").each(function(e){
                    var price = $(this).text().replace(" 원","");
                    price = price.replace(",","");
                    total_p = total_p + Number(price);
                    $(".price").html(total_p.format() + " 원");
                })
            }
        })
    }
    function fnChoise(choise, btn){
        var price = choise.total_price.value;
        var mode = choise.mode.value;
        var sel_id = choise.cart_id.value;
        var cart_id = $("#form_cart_id").val();
        if(mode=="on"){
            $(".select_count").html(Number($(".select_count").text())-1);
            $("#total_cart").val(Number($("#total_cart").val())-1);
            var prices = $(".price").text().replace(" 원","");
            if(Number(prices.replace(",","")) > Number(price)) {
                prices = Number(prices.replace(",", "")) - Number(price);
            }else{
                prices = Number(price) - Number(prices.replace(",", ""));
            }
            $(".price").html(prices.format() + " 원");
            choise.mode.value = "off";
            $("#allchk").attr("checked",false);
            btn.className = "btn grid_100 cart_choice";
            cart_id = cart_id.replace(sel_id+",","");
            $("#form_cart_id").val(cart_id);
        }else{
            $(".select_count").html(Number($(".select_count").text())+1);
            $("#total_cart").val(Number($("#total_cart").val())+1);
            var prices = $(".price").text().replace(" 원","");
            prices = Number(prices.replace(",",""))+Number(price)
            $(".price").html(prices.format() + " 원");
            choise.mode.value = "on";
            if($("#total_cart").val() == Number("<?php echo count($list)?>")){
                $("#allchk").attr("checked",true);
            }
            btn.className = "btn grid_100 cart_choice on";
            cart_id += sel_id+",";
            $("#form_cart_id").val(cart_id);
        }
    }
    $(function(){
        $("#allchk").click(function(){
            var cnt = 0;
            if($(this).is(":checked")==true){
                var cart_id ="";
                $(".cart_choice").each(function(){
                    $(this).removeClass("on");
                    $(this).addClass("on");
                    $(this).parent().parent().find("input[id=mode]").val("on");
                    var price = $(this).parent().parent().find("input[id=total_price]").val();
                    var prices = $(".price").text().replace(" 원","");
                    cart_id += $(this).parent().parent().find("input[id^=cart_id]").val()+",";
                    prices = Number(prices.replace(",", "")) + Number(price);

                    $(".price").html(prices.format() + " 원");
                    $("#total_cart").val(cnt++);
                    $(".select_count").html(cnt);
                })
                $("#form_cart_id").val(cart_id);
            }else{
                $(".cart_choice").each(function(){
                    $(this).removeClass("on");
                    $(this).parent().parent().find("input[id=mode]").val("off");
                })
                $("#total_cart").val(0);
                $(".select_count").html("0");
                $(".price").html("0 원");
                $("#form_cart_id").val("");
            }
        })
    })
</script>
<?php
include_once ("../../tail.php");
?>