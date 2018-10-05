<?php
include_once ("../../common.php");

$sql = "select * from `order_form` where order_id = '{$order_id}'";
$orders = sql_fetch($sql);

$sql = "select * from ";

?>
<div class="shop_modal">
    <div class="title">
        <h2>예상 소요시간</h2>
        <p>고객과 신뢰를 쌓기위해 정확한 시간을 선택해주세요!</p>
    </div>
    <div class="content">
        <form action="<?php echo G5_URL;?>/page/shop/kakaoTalk.php" method="post" >
            <input type="hidden" value="<?php echo $wr_id;?>" name="wr_id" id="wr_id">
            <input type="hidden" value="<?php echo $order_id;?>" name="order_id" id="order_id">
            <input type="hidden" value="<?php echo $orders["order_user_phone"];?>" name="user_phone">
            <input type="hidden" value="<?php echo $orders["order_recive_phone"];?>" name="delivery_phone">
            <input type="hidden" value="<?php echo $member["mb_hp"];?>" name="store_phone">
            <ul>
                <select name="deli_time" id="deli_time">
                    <option value="10">10분</option>
                    <option value="20">20분</option>
                    <option value="30">30분</option>
                    <option value="40">40분</option>
                    <option value="50">50분</option>
                    <option value="">기타</option>
                </select>
                <input type="text" style="display:none" name="order_time" id="order_time" placeholder="예상시간을 입력해주세요. ex) 1시간">
            </ul>
            <div class="btns">
                <input type="submit" value="확인" class="btn">
                <input type="button" value="취소" class="btn" onclick="modal_close()">
            </div>
        </form>
    </div>

</div>
<script>
    $(function(){
        $("#deli_time").change(function(){
           if($(this).val()==""){
               $("#order_time").css("display","block");
           } else{
               $("#order_time").css("display","none");
           }
        });
    })
</script>