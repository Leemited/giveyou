<?php
include_once ("../../common.php");
include_once ("../../head.php");
$order_number = $_REQUEST["order_number"];
?>
<div class="width-fixed">
    <section id="reserve_result">
        <div>
            <div class="top">
                <i></i>
                <h3 >주문 성공하였습니다.</h3>
                <p>
                    다음과 같은 정보로 주문 완료되었습니다. <br />
                    <?php echo $order_number?>
                    주문 확인은 <span>주문조회</span> 메뉴에서 가능합니다.
                </p>
            </div>
            <div class="btn_group">
                <?php if($is_member){?>
                    <a href="<?php echo G5_URL."/page/mypage/order_list.php"; ?>" class="btn" style="background: #7c7c7c">확인</a>
                    <a href="<?php echo G5_URL; ?>" class="btn" style="margin-top: 10px">홈으로</a>
                <?php }else{?>
                    <a href="<?php echo G5_URL."/page/rent/order_find.php"; ?>" class="btn" style="background: #7c7c7c">확인</a>
                    <a href="<?php echo G5_URL; ?>" class="btn" style="margin-top: 10px">홈으로</a>
                <?php }?>
            </div>
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>
