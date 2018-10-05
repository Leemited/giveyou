<?php
include_once ("../../common.php");
include_once ("../../head.php");
$member_skin_url = G5_URL."/skin/member/basic";
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="width-fixed">
    <section class="section01" >
        <div class="section01_header">
            <div><h2>비회원 주문조회</h2></div>
        </div>
        <div class="section01_content wrap">
            <div id="register_form">
                <form action="<?php echo G5_URL?>/page/rent/order_find_chk.php" id="fregisterform" name="order_find" method="post">
                    <div class="form_list01">
                        <ul>
                            <li>
                                <div>
                                    <label>주문자명 <span>*</span></label>
                                    <div>
                                        <input type="text" class="input01" name="order_name" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label>주문번호 <span>*</span></label>
                                    <div>
                                        <input type="text" class="input01" name="order_number" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label>주문조회<br>비밀번호 <span>*</span></label>
                                    <div>
                                        <input type="password" class="input01" name="order_pass" required>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn_group01">
                        <input type="submit" value="조회하기" class="btn grid_100 bg_darkred color_white ">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>

