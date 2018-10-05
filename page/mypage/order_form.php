<?php
include_once("../../common.php");
$wr_id=$_COOKIE["PHPSESSID"];
$wr_subject="주문하기";
$back_url=G5_URL."/page/mypage/cart.php";
include_once(G5_PATH."/head.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$cart_id = $_REQUEST["form_cart_id"];
$type = $_REQUEST["type"];
$cart_id_len = explode(",",$cart_id);
if(count($cart_id_len) > 1){
	for($i=0;$i<count($cart_id_len);$i++){
		if($cart_id_len[$i]==""){
			continue;
		}
		if($i==0){
			$cart_id = $cart_id_len[$i];
		}else{
			$cart_id .= ",".$cart_id_len[$i];
		}
	}
}
/*switch ($type){
    case "order":
        $order_type = "직접결제";
        break;
    case "reserve":
        $order_type = "예약방문";
        break;
}*/
if($is_member){
    $cart_update = "update `cart` set mb_id = '{$mb_id}' where mb_id = '{$_COOKIE[PHPSESSID]}' " ;
    sql_query($cart_update);
    
    if($member["mb_addr1"]==""){
        alert("주소 정보를 입력해주세요",G5_BBS_URL."/register_form.php?w=u");
    }
}

$deli = sql_query("select SUM((a.menu_price+a.option_price)*a.menu_count) as total, b.delivery_price from `cart` as a left join `store_detail` as b on a.wr_id = b.wr_id where (a.mb_id = '{$member['mb_id']}' or a.mb_id = '{$_COOKIE[PHPSESSID]}' ) and cart_date = CURRENT_DATE() and cart_id in ({$cart_id})  group by a.wr_id");
while($deli_row = sql_fetch_array($deli)){
    $delis[] = $deli_row;
}


for($i=0; $i<count($delis); $i++){
    if( (int) $delis[$i]["total"] < (int) $delis[$i]["delivery_price"]){
        echo "<script>alert('주문하신 상품이 상점 최소배달 금액에 못미치네요..장바구니를 추가해 다시 주문해보세요!');location.href='{$back_url}';</script>";
    }
}

$result = sql_query("select a.*,b.* from `cart` as a left join `g5_write_main` as b on a.wr_id = b.wr_id where  a.cart_id in ({$cart_id}) and a.cart_state=0");
while ($row = sql_fetch_array($result)){
    $list[] = $row;
}


if($is_member) {
    $cart_update = "update `cart` set mb_id = '{$mb_id}' where mb_id = '{$_COOKIE[PHPSESSID]}' ";
    sql_query($cart_update);
}

if(!$login){
    //로그인 페이지로 한번이동
    //$back_url = G5_URL."/page/mypage/cart.php";
}

$mAgent = array("iPhone","iPod","Android","Blackberry", "Opera Mini", "Windows ce", "Nokia", "sony", "giveyou");
$chkMobile = false;
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        break;
    }
}


?>

<div class="width-fixed view">
    <section class="section01" id="view_section">
        <div class="section01_header">
            <div><h2>주문상품 정보</h2></div>
        </div>
    <?php
    $order_total = 0;
    $cart_ids = "";
    $wr_id = "";
    for($i=0;$i<count($list);$i++){
        $col = $i+1;
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
        if(strpos($wr_id,$list[$i]["wr_id"])===false){
            if($i==0){
                $wr_id = $list[$i]["wr_id"];
            }else {
                $wr_id .= ",".$list[$i]["wr_id"];
            }
        }
		if($i==0){
            $menu_name = $list[$i]["menu_name"];
			$menu_name_pay = $list[$i]["menu_name"];
            $menu_price = $list[$i]["menu_price"];
            $menu_count = $list[$i]["menu_count"];
            $menu_option = $list[$i]["menu_option"];
            $menu_option_price = $list[$i]["option_price"];
		}else{
            $menu_name .= ",".$list[$i]["menu_name"];
			$menu_name_pay = $list[0]["menu_name"]."외 ".$i."개";
            $menu_price .= ",".$list[$i]["menu_price"];
            $menu_count .= ",".$list[$i]["menu_count"];
            $menu_option .= "," . $list[$i]["menu_option"];
            $menu_option_price .= "," . $list[$i]["option_price"];
		}
        //$wr_id = substr($wr_id,0,strlen($wr_id)-1);
        ?>
        <div class="section01_content order_item <?php if(($col % 3) == 0){?>last<?php }?>">
            <?php
                if($i==0) {
                    $order_name1 .= "[" . $list[$i]["wr_subject"] . "]" . "-" . $list[$i]["menu_name"];
                }else{
                    $order_name1 .= ","."[" . $list[$i]["wr_subject"] . "]" . "-" . $list[$i]["menu_name"];
                }
                $order_name = explode(",",$order_name1);
            ?>
            <form>
                <div class="store_name" style="cursor: auto;"><h2><?php echo $list[$i]["wr_subject"]?></h2></div>
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
                    <dd><?php echo $list[$i]["menu_count"]?> 개</dd>
                </dl>
                <dl class="last">
                    <dt>금액</dt>
                    <dd class="order_item_price" name="order_item_price" id="order_item_price<?php echo $i?>"><?php echo number_format($all_total_price);?> 원</dd>
                </dl>
            </form>
        </div>
    <?php }?>
        <div class="clear"></div>
    </section>
    <form action="<?php echo G5_URL."/page/mypage/order_form_update.php"; ?>" method="post" name="frm_pay" id="frm_pay">
        <input type="hidden" name="order_type" id="order_type" value="">
        <input type="hidden" name="order_type2" id="order_type2">
        <input type="hidden" name="menu_name" id="menu_name" value="<?php echo $menu_name?>">
		<input type="hidden" name="menu_name_pay" id="menu_name_pay" value="<?php echo $menu_name_pay?>">
        <input type="hidden" name="menu_price" id="menu_price" value="<?php echo $menu_price?>">
        <input type="hidden" name="menu_count" id="menu_count" value="<?php echo $menu_count?>">
        <input type="hidden" name="menu_option" id="menu_option" value="<?php echo $menu_option?>">
        <input type="hidden" name="menu_option_price" id="menu_option_price" value="<?php echo $menu_option_price?>">
        <input type="hidden" name="mb_id" id="order_mb_id" value="<?php echo $member["mb_id"];?>">
        <?php if($is_member){?>
            <input type="hidden" name="other_addr" id="other_addr" value="N">
        <?php }?>
        <input type="hidden" name="wr_id" id="wr_id" value="<?php echo $wr_id?>">
        <input type="hidden" name="cart_id" id="cart_id" value="<?php echo $cart_id?>">
        <section class="section01" id="view_section_info" <?php if($is_member){echo "style='padding-bottom:0px;'";}?>>
        <div class="section01_header">
            <div><h2>주문자 정보</h2></div>
        </div>
        <div class="section01_content">
            <table>
                <tr>
                    <th>이름</th>
                    <td><input type="text" name="order_name" id="order_name" class="order_name" value="<?php echo $member["mb_name"]?>" placeholder="주문자이름" required <?php if($is_member){echo "readonly";}?>></td>
                </tr>
                <tr>
                    <th>휴대전화</th>
                    <td><input type="text" name="order_phone" id="order_phone" class="order_phone" value="<?php echo $member["mb_hp"]?>" placeholder="휴대전화" require ></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><input type="text" name="order_email" id="order_email" class="order_email" value="<?php echo $member["mb_email"]?>" placeholder="이메일입력" require ></td>
                </tr>

                <?php if($is_member){?>
                    <tr>
                    <th rowspan="2">주소</th>
                    <td>
                        <input type="text" name="mb_zip1" id="mb_zip1" value="<?php echo $member["mb_zip1"];?>" style="width:50%" readonly  >
                    </td>
                </tr>
                    <tr>
                    <td>
                        <input type="text" name="mb_addr1" id="mb_addr1" value="<?php echo $member["mb_addr1"]?>" readonly>
                        <input type="text" name="mb_addr2" id="mb_addr2" value="<?php echo $member["mb_addr2"]?>" <?php if($is_member){echo "readonly";}?>>
                    </td>
                </tr>
                <?php }?>
                <?php if(!$is_member){?>
                <tr>
                    <th>주문조회<br>비밀번호</th>
                    <td>
                        <input type="password" name="order_pass" id="order_pass" placeholder="비밀번호 입력" minlength="4">
                    </td>
                </tr>
                <?php }?>
                <?php if($is_member){?>
                    <tr>
                        <th>배송메시지</th>
                        <td><input type="text" name="delivery_msg" id="delivery_msg" placeholder="배송시 전달할 메시지 20자이내" maxlength="20"></td>
                    </tr>
                <?php } ?>
            </table>
            <?php if($is_member){?>
                <div class="edit_addr">
                <label for="order_addr_edit"><input type="checkbox" name="order_addr_edit" id="order_addr_edit">구매자와 배송지가 다릅니다.</label>
            </div>
            <?php }?>
        </div>
    </section>
    <section class="section01 <?php if($is_member){ echo "edit_addr_on";}?>" id="view_section_info" >
        <div class="section01_header">
            <div><h2>수령인 정보</h2></div>
        </div>
        <div class="section01_content">
            <table>
                <?php if(!$is_member){?>
                <tr>
                    <th>배송지선택</th>
                    <td class="deliverySelTd">
                        <?php if(!$is_member){?>
                        <label for="delivery_sel"><input type="radio" name="delivery_sel" id="delivery_sel" value="1"> 주문자와 동일</label>
                        <?php }?>
                        <?php if($is_member){?>
                            <!--<label for="delivery_sel2"><input type="radio" name="delivery_sel" id="delivery_sel2" value="2"> 신규주소</label>-->
                            <label for="delivery_sel3"><input type="radio" name="delivery_sel" id="delivery_sel3" value="3"> 등록주소</label>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
                <tr>
                    <th>이름</th>
                    <td><input type="text" name="delivery_name" class="delivery_name" placeholder="수령인 이름"></td>
                </tr>
                <tr>
                    <th rowspan="3">주소</th>
                    <td colspan="2">
                        <input type="text" name="delivery_addr_code" id="sample2_postcode" placeholder="우편번호" style="width:50%" readonly >
                        <input type="button" value="주소찾기" class="btn grid_10" style="width:20%;" onclick="DaumPostcode()">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><div id="search_addr"></div></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="text" name="delivery_addr_1" id="sample2_address" placeholder="기본주소" readonly>
                        <input type="text" name="delivery_addr_2" id="sample2_address2" placeholder="나머지 상세주소">
                    </td>
                </tr>
                <tr>
                    <th>휴대전화</th>
                    <td colspan="2"><input type="text" name="delivery_phone" class="delivery_phone" placeholder="수령인 휴대전화"></td>
                </tr>
                <?php if(!$is_member){?>
                <tr>
                    <th>배송메시지</th>
                    <td colspan="2"><input type="text" name="delivery_msg" id="delivery_msg" placeholder="배송시 전달할 메시지 20자이내" maxlength="20"></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </section>
    <section class="section01" id="view_section_info">
        <div class="section01_header">
            <div><h2>결제방법 선택</h2></div>
        </div>
        <?php if($is_member){?>
        <div class="section01_content">
            <div class="order_type">
                <div><i></i><label for="direct" class="direct"><input type="radio" value="1" name="order_type" id="direct">바로결제</label> <span>앱에서 바로결제</span></div>
                <div><i></i><label for="no-direct" class="no-direct"><input type="radio" value="2" name="order_type" id="no-direct">만나서결제</label> <span>배달원에게 직접 계산</span></div>
            </div>
        </div>
        <?php }?>
        <div class="section01_content">
            <div class="order_type_select <?php if($is_member){echo "order_type_sel";}?>">
                <ul>
                    <li>신용카드</li>
                    <!-- <li>네이버페이</li> -->
                    <li>계좌이체</li>
                    <li>휴대폰결제</li>
<!--					<li>간편결제</li>-->
                </ul>
                <div class="clear"></div>
            </div>
            <?php if($is_member){?>
            <div class="order_type_select <?php if($is_member){echo "order_type_sel_direct";}?>">
                <ul>
                    <li>신용카드</li>
                    <li>현금</li>
                </ul>
                <div class="clear"></div>
            </div>
            <?php }?>
<!--            <table class="bank_order">-->
<!--                <tr>-->
<!--                    <th>입금자명</th>-->
<!--                    <td><input type="text" name="bank_account_name" id="bank_account_name" ></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <th>입금은행</th>-->
<!--                    <td>-->
<!--                        <select name="bank_name" id="bank_name">-->
<!--                            <option value="">입금은행 선택</option>-->
<!--                            <option value='SC제일은행'>SC제일은행</option>-->
<!--                            <option value='경남은행'>경남은행</option>-->
<!--                            <option value='광주은행'>광주은행</option>-->
<!--                            <option value='국민은행'>국민은행</option>-->
<!--                            <option value='굿모닝신한증권'>굿모닝신한증권</option>-->
<!--                            <option value='기업은행'>기업은행</option>-->
<!--                            <option value='농협중앙회'>농협중앙회</option>-->
<!--                            <option value='농협회원조합'>농협회원조합</option>-->
<!--                            <option value='대구은행'>대구은행</option>-->
<!--                            <option value='대신증권'>대신증권</option>-->
<!--                            <option value='대우증권'>대우증권</option>-->
<!--                            <option value='동부증권'>동부증권</option>-->
<!--                            <option value='동양종합금융증권'>동양종합금융증권</option>-->
<!--                            <option value='메리츠증권'>메리츠증권</option>-->
<!--                            <option value='미래에셋증권'>미래에셋증권</option>-->
<!--                            <option value='뱅크오브아메리카(BOA)'>뱅크오브아메리카(BOA)</option>-->
<!--                            <option value='부국증권'>부국증권</option>-->
<!--                            <option value='부산은행'>부산은행</option>-->
<!--                            <option value='산림조합중앙회'>산림조합중앙회</option>-->
<!--                            <option value='산업은행'>산업은행</option>-->
<!--                            <option value='삼성증권'>삼성증권</option>-->
<!--                            <option value='상호신용금고'>상호신용금고</option>-->
<!--                            <option value='새마을금고'>새마을금고</option>-->
<!--                            <option value='수출입은행'>수출입은행</option>-->
<!--                            <option value='수협중앙회'>수협중앙회</option>-->
<!--                            <option value='신영증권'>신영증권</option>-->
<!--                            <option value='신한은행'>신한은행</option>-->
<!--                            <option value='신협중앙회'>신협중앙회</option>-->
<!--                            <option value='에스케이증권'>에스케이증권</option>-->
<!--                            <option value='에이치엠씨투자증권'>에이치엠씨투자증권</option>-->
<!--                            <option value='엔에이치투자증권'>엔에이치투자증권</option>-->
<!--                            <option value='엘아이지투자증권'>엘아이지투자증권</option>-->
<!--                            <option value='외환은행'>외환은행</option>-->
<!--                            <option value='우리은행'>우리은행</option>-->
<!--                            <option value='우리투자증권'>우리투자증권</option>-->
<!--                            <option value='우체국'>우체국</option>-->
<!--                            <option value='유진투자증권'>유진투자증권</option>-->
<!--                            <option value='전북은행'>전북은행</option>-->
<!--                            <option value='제주은행'>제주은행</option>-->
<!--                            <option value='키움증권'>키움증권</option>-->
<!--                            <option value='하나대투증권'>하나대투증권</option>-->
<!--                            <option value='하나은행'>하나은행</option>-->
<!--                            <option value='하이투자증권'>하이투자증권</option>-->
<!--                            <option value='한국씨티은행'>한국씨티은행</option>-->
<!--                            <option value='한국투자증권'>한국투자증권</option>-->
<!--                            <option value='한화증권'>한화증권</option>-->
<!--                            <option value='현대증권'>현대증권</option>-->
<!--                            <option value='홍콩상하이은행'>홍콩상하이은행</option>-->
<!--                        </select>-->
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->
            <?php if($is_member){?>
            <div class="point_edit">
                <p>사용가능 G포인트 : <span><?php echo number_format($member["mb_point"]);?>p</span></p>
                <input type="text" name="mb_point" class="mb_point" value="0">
                <label for="all_point"><input type="checkbox" id="all_point" class="all_point"> 전액사용</label>
                <p class="point_info">* G포인트란? <br> 포인트는 충전이나 구매 금액의 일부를 적립해 드리는 가상결제 수단입니다.<br> 배달 주문시 적립됩니다.</p>
            </div>
			 <div class="point_edit" id="used_point">
                <p>적립예정 G포인트 : <span><?php echo number_format($order_total*4/100);?>p</span></p>
                <label for="save_point"><input type="radio" name="used_point" id="save_point" value="save" class="" checked> 포인트 적립</label>
				<label for="give_point"><input type="radio" name="used_point" id="give_point" value="give" class=""> 포인트 기부하기</label>
                <p class="point_info">* 기뷰하기란? <br> 구매와 동시에 기부를 할 수 있는 수단입니다.<br>G포인트 사용시에는 적립 불가능합니다.</p>
            </div>
            <?php }?>
        </div>
    </section>
    <section class="section01" id="view_section">
        <div class="section01_content">
			<div class="order_agrees">
                <ul>                   
                    <li>아래사항에 모두 동의합니다. <input type="checkbox" name="agree1" id="agree1"><label for="agree1">전체동의</label></li>
                    <li>주문할 상품의 구매조건을 확인하였으며,<br>결제진행에 동의합니다. <input type="checkbox" name="agree2" id="agree2" ><label for="agree2">동의</label></li>
                    <li><a href="<?php echo G5_URL?>/page/guide/privacy.php"><u>개인정보 제3자 제공동의 ></u></a> <input type="checkbox" name="agree3" id="agree3"><label for="agree3">동의</label></li>
                    <?php if (!$is_member){?>
                    <li><a href="<?php echo G5_URL?>/page/guide/agreement.php" ><u>비회원 개인정보 취급방침 동의 ></u></a> <input type="checkbox" name="agree4" id="agree4"><label for="agree4">동의</label></li>
                    <?php }?>
                </ul>                
            </div>
            <div class="order_info_final">
                <div>총 주문금액</div>
                <div class="price"><?php echo number_format($order_total)?> 원</div>
            </div>
            <div class="clear"></div>
            <div class="order_info_final">
                <div>할인금액 금액</div>
                <div class="price discount"><?php echo number_format($discount_price)?> 원</div>
            </div>
            <div class="clear"></div>
            <div class="order_info_final">
                <div class="end_price">최종 결제 금액</div>
                <div class="price end_price" id="order_item_price1"><?php echo number_format($order_total-$discount_price)?> 원</div>
				<input type="hidden" value="<?php echo $order_total-$discount_price;?>" id="total_prices" name="total_prices">
				<input type="hidden" value="<?php echo $order_total;?>" id="no-dis" name="no-dis">
            </div>
            <div class="clear"></div>
        </div>
        <div class="section01_content">
            <div class="btn_group">
				<input type="button" value="결제하기" class="btn grid_100 order" onclick="tpay();">
				<input type="button" value="취소하기" class="btn grid_100 cancel" onclick="fnBack('<?php echo $back_url;?>');">
            </div>
        </div>
    </section>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script>
function tpay(){
    var order_chk = fn_submit();
    if(order_chk == false){
        return false;
    }

    var IMP = window.IMP;							// 생략가능
    IMP.init('imp30942372');						// 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

    //전달 정보
    var name, tel, addr, postcode,deli_name,deli_tel,deli_addr,deli_postcode;
    var order_addr = $("#other_addr").val();

    tel = $("#order_phone").val();
    name = $("#order_name").val();
    if(order_addr == "Y"){
        postcode = $("#mb_zip1").val();
        addr = $("#mb_addr1").val() + " " + $("#mb_addr2").val();
        deli_name = $(".delivery_name").val();
        deli_tel = $(".delivery_phone").val();
        deli_addr = $("#sample2_address").val() + " " + $("#sample2_address2").val();
        deli_postcode = $("#sample2_postcode").val();
    }else{
        postcode = $("#mb_zip1").val();
        addr = $("#mb_addr1").val() + " " + $("#mb_addr2").val();
        deli_name = name;
        deli_tel = tel;
        deli_addr = addr;
        deli_postcode = postcode;
    }
    var order_type = $("#order_type").val();
    var order_type2 = $("#order_type2").val();
    var menu_name = $("#menu_name").val();
    var menu_name_pay = $("#menu_name_pay").val();
    var menu_price = $("#menu_price").val();
    var menu_count = $("#menu_count").val();
    var menu_option = $("#menu_option").val();
    var menu_option_price = $("#menu_option_price").val();

    var cart_id = $("#cart_id").val();
    var wr_id = $("#wr_id").val();
    var order_total = $("#total_prices").val();

    var deli_msg = $("#delivery_msg").val();
    var email = $("#order_email").val();
    var mb_id = $("#order_mb_id").val();
    
    if(mb_id == ""){
        var order_pw = $("#order_pass").val();
        order_type = "비회원 구매";
        order_addr = '';
        postcode = $("#sample2_postcode").val();
        addr = $("#sample2_address").val() + " " + $("#sample2_address2").val();
        deli_name = $(".delivery_name").val();

        deli_tel = $(".delivery_phone").val();
        deli_addr = $("#sample2_address").val() + " " + $("#sample2_address2").val();
        deli_postcode = $("#sample2_postcode").val();

        //console.log("비회원구매 : " + name + "//" + tel + "//" + addr + "//" + postcode + "//" + order_addr + "//" + order_type + "//" + order_type2 + "//" + deli_name + "//" + deli_tel + "//" + deli_addr + "//" + deli_postcode + "//" + menu_name + "//" + menu_name_pay + "//" + menu_count + "//" + menu_option + "//" + menu_option_price + "//" + cart_id + "//" + wr_id + "//" + order_total + "//" + deli_msg+"//"+order_pw);
        $.ajax({
            url:g5_url+"/page/mypage/order_form_temp_update.php",
            method:"post",
            dataType:"json",
            data:{name:name,tel:tel,addr:addr,email:email,postcode:postcode,order_addr:order_addr,order_type:order_type,order_type2:order_type2,deli_name:deli_name,deli_tel:deli_tel,deli_addr:deli_addr,deli_postcode:deli_postcode,menu_name:menu_name,menu_count:menu_count,menu_price:menu_price,menu_option:menu_option,menu_option_price:menu_option_price,cart_id:cart_id,wr_id:wr_id,order_total:order_total,deli_msg:deli_msg,order_pw:order_pw}
        }).done(function(data) {
            console.log(data);
            if(data.msg=="1") {
                var od_number = data.order_number;
                IMP.request_pay({
                    pg: 'jtnet', 								// version 1.1.0부터 지원.
                    pay_method: pay_me,						// 'samsung':삼성페이, 'card':신용카드, 'trans':실시간계좌이체, 'vbank':가상계좌, 'phone':휴대폰소액결제
                    merchant_uid: 'merchant_' + new Date().getTime(),
                    name: menu_name_pay,
                    amount: order_total,
                    buyer_email: email,
                    buyer_name: name,
                    buyer_tel: tel,
                    buyer_addr: addr,
                    buyer_postcode: postcode
                }, function (rsp) {
                    if (rsp.success) {
                        var iap_id, merchant_id, paid_amount, apply_num;
                        imp_id = rsp.imp_uid;
                        merchant_id = rsp.merchant_uid;
                        paid_amount = rsp.paid_amount;
                        apply_num = rsp.apply_num;
                        $.ajax({
                            url: g5_url + "/page/mypage/order_form_update_pay.php",
                            method: "post",
                            dataType:"json",
                            data: {order_number:od_number,imp_uid:imp_id,merchant_uid:merchant_id,paid_amount:paid_amount,apply_num:apply_num}
                        }).done(function (data) {
                            console.log(data);
                            var msg = '결제가 완료되었습니다.';
                            msg += '고유ID : ' + rsp.imp_uid;
                            msg += '상점 거래ID : ' + rsp.merchant_uid;
                            msg += '결제 금액 : ' + rsp.paid_amount;
                            msg += '카드 승인번호 : ' + rsp.apply_num;
                        });
                    } else {
                        var msg = '결제에 실패하였습니다.';
                        msg += '에러내용 : ' + rsp.error_msg;
                    }
                    alert(msg);
                });
            }else if(data.msg == "2"){
                alert("시스템 장애로 인해 주문등록에 실패 하였습니다. \r\n다시 시도해주세요.");
                return false;
            }else{
                alert(data.msg);
                return false;
            }
        });
    }else {
        var use_point = $("#mb_point").val();
        if (order_type == "바로결제") {
            //console.log("바로결제 : " + name + "//" + tel + "//" + addr + "//" + postcode + "//" + order_addr + "//" + order_type + "//" + order_type2 + "//" + deli_name + "//" + deli_tel + "//" + deli_addr + "//" + deli_postcode + "//" + menu_name + "//" + menu_name_pay + "//" + menu_count + "//" + menu_option + "//" + menu_option_price + "//" + cart_id + "//" + wr_id + "//" + order_total + "//" + deli_msg);
            var pay_me = "";
            switch (order_type2) {
                case "신용카드":
                    pay_me = "card";
                    break;
                case "계좌이체":
                    pay_me = "trans";
                    break;
                case "휴대폰결제":
                    pay_me = "phone";
                    break;
            }

            $.ajax({
                url:g5_url+"/page/mypage/order_form_temp_update.php",
                method:"post",
                dataType:"json",
                data:{name:name,tel:tel,addr:addr,email:email,postcode:postcode,order_addr:order_addr,order_type:order_type,order_type2:order_type2,deli_name:deli_name,deli_tel:deli_tel,deli_addr:deli_addr,deli_postcode:deli_postcode,menu_name:menu_name,menu_count:menu_count,menu_price:menu_price,menu_option:menu_option,menu_option_price:menu_option_price,cart_id:cart_id,wr_id:wr_id,order_total:order_total,deli_msg:deli_msg,use_point:use_point,mb_id:mb_id}
            }).done(function(data){
                console.log(data);
                if(data.msg=="1") {
                    var od_number = data.order_number;
                    IMP.request_pay({
                        pg: 'jtnet', 								// version 1.1.0부터 지원.
                        pay_method: pay_me,						// 'samsung':삼성페이, 'card':신용카드, 'trans':실시간계좌이체, 'vbank':가상계좌, 'phone':휴대폰소액결제
                        merchant_uid: 'merchant_' + new Date().getTime(),
                        name: menu_name_pay,
                        amount: order_total,
                        buyer_email: email,
                        buyer_name: name,
                        buyer_tel: tel,
                        buyer_addr: addr,
                        buyer_postcode: postcode
                    }, function (rsp) {
                        var msg;
                        if (rsp.success) {
                            var imp_id, merchant_id, paid_amount, apply_num;
                            imp_id = rsp.imp_uid;
                            merchant_id = rsp.merchant_uid;
                            paid_amount = rsp.paid_amount;
                            apply_num = rsp.apply_num;
                            $.ajax({
                                url: g5_url + "/page/mypage/order_form_update_pay.php",
                                method: "post",
                                data: {order_number:od_number,imp_uid:imp_id,merchant_uid:merchant_id,paid_amount:paid_amount,apply_num:apply_num}
                            }).done(function (data2) {
                                console.log("결제완료"+data2);
                                msg = '결제가 완료되었습니다.';
                                msg += '고유ID : ' + rsp.imp_uid;
                                msg += '상점 거래ID : ' + rsp.merchant_uid;
                                msg += '결제 금액 : ' + rsp.paid_amount;
                                msg += '카드 승인번호 : ' + rsp.apply_num;
                            });
                        } else {
                            msg = '결제에 실패하였습니다.';
                            msg += '에러내용 : ' + rsp.error_msg;
                        }
                        //alert(msg);
                        location.href=g5_url+"/page/mypage/order_complete.php?order_number="+od_number;
                    });
                }else if(data.msg == "2"){
                    alert("시스템 장애로 인해 주문등록에 실패 하였습니다. \r\n다시 시도해주세요.");
                    return false;
                }else{
                    alert(data.msg);
                    return false;
                }
            });
        } else {
            //console.log("만나서결제 : " + name + "//" + tel + "//" + addr + "//" + postcode + "//" + order_addr + "//" + order_type + "//" + order_type2 + "//" + deli_name + "//" + deli_tel + "//" + deli_addr + "//" + deli_postcode + "//" + menu_name + "//" + menu_name_pay + "//" + menu_count + "//" + menu_option + "//" + menu_option_price + "//" + cart_id + "//" + wr_id + "//" + order_total + "//" + deli_msg);
            // 바로 폼 전달
            document.frm_pay.action = "order_form_update.php";
            document.frm_pay.submit();
        }
    }
}

var action_url = '';
var mobilechks = false;
var mobileArr = new Array("iPhone", "iPod", "BlackBerry", "Android", "Windows CE", "LG", "MOT", "SAMSUNG", "SonyEricsson");
for(var txt in mobileArr){
    if(navigator.userAgent.match(mobileArr[txt]) != null){
        // 작업
		mobilechks = true;
        break;
    }

}
    $(document).ready(function(){
		//f_init();
        $(".order_type_select li").click(function(){
            $(this).addClass("active");
            $(".order_type_select li").not($(this)).removeClass("active");
            // 'samsung':삼성페이, 'card':신용카드, 'trans':실시간계좌이체, 'vbank':가상계좌, 'phone':휴대폰소ㅅ
            /*if($(this).text() == "계좌이체"){
				//무통장입금
				$("#EP_pay_type").val("trans");
			}	
			if($(this).text() == "신용카드"){
				$("#EP_pay_type").val("card");
			}
			if($(this).text() == "휴대폰결제"){
				$("#EP_pay_type").val("phone");
			}
			if($(this).text() == "간편결제"){
				$("#EP_pay_type").val("60");
            }
			if(mobilechks == false){
				action_url = g5_url+"/page/mypage/easypay80_webpay_php/web/normal/order.php";
				frm_pay.EP_return_url.value = "http://tecooni.cafe24.com/page/mypage/easypay80_webpay_php/web/normal/order_res.php";
			}else{
				action_url = g5_url+"/page/mypage/easypay80_webpay_mobile_php/mobile/mobile/order.php";
				frm_pay.EP_return_url.value = "http://tecooni.cafe24.com/page/mypage/easypay80_webpay_mobile_php/mobile/mobile/order_res.php";
			}*/

            $("#order_type2").val($(this).text());
        })
        
        //포인트
        $(".mb_point").change("keyup",function(){
            $(".all_point").attr("checked",false);
            if(Number($(this).val()) < Number("<?php echo $member["mb_point"]?>")){
                var total = $("#no-dis").val();
                //total = total.replace(",","");
                $(".price.discount").html($(this).val().format()+ " 원");
                $(".price.end_price").html((Number(total)-Number($(this).val())).format()+" 원");
				$("#total_prices").val(Number(total)-Number($(this).val()));
				$("#save_point").attr("disabled","true");
				$("#give_point").attr("disabled","true");
				$("#used_point").css("display","none");
            }else if(Number($(this).val()) == Number("<?php echo $member["mb_point"]?>")){
                $(".all_point").prop("checked","checked");
                var total = $("#no-dis").val();
                //total = total.replace(",","");
                $(".price.discount").html($(this).val().format()+ " 원");
                $(".price.end_price").html((Number(total)-Number($(this).val())).format()+" 원");
                $("#total_prices").val(Number(total)-Number($(this).val()));
                $("#save_point").attr("disabled","true");
                $("#give_point").attr("disabled","true");
                $("#used_point").css("display","none");
            }else{
				$(this).val("<?php echo $member["mb_point"]?>");
				var total = $("#no-dis").val();
                //total = total.replace(",","");
				$(".price.discount").html(Number("<?php echo $member["mb_point"]?>").format()+ " 원");
                $(".price.end_price").html((Number(total)-Number("<?php echo $member["mb_point"]?>")).format()+" 원");
				$("#total_prices").val(Number(total)-Number("<?php echo $member["mb_point"]?>"));
                console.log(Number(total)-Number($(this).val()));
                alert("포인트가 부족합니다.");
            }

			if($(this).val()=="" || $(this).val() == 0){
				$("#save_point").removeAttr("disabled");
				$("#give_point").removeAttr("disabled");
				$("#used_point").css("display","block");
			}
        });
        
        //포인트 전체 사용
        $(".all_point").change(function(){
            var point = "<?php echo $member["mb_point"];?>";
            if($(this).is(":checked")==true) {
                $(".mb_point").val(point);
                var total = $("#no-dis").val();
                //total = total.replace(",", "");
                $(".price.discount").html(point.format() + " 원");
                $(".price.end_price").html((Number(total) - Number(point)).format() + " 원");
                $("#total_prices").val(Number(total)-Number(point));
				$("#save_point").attr("disabled","true");
				$("#give_point").attr("disabled","true");
				$("#used_point").css("display","none");
            }else{
                var total = $("#no-dis").val();
                //total = total.replace(",", "");
                $(".mb_point").val(0);
                $(".price.discount").html("0 원");
                $(".price.end_price").html((Number(total)).format() + " 원");
                $("#total_prices").val(Number(total));
				$("#save_point").removeAttr("disabled");
				$("#give_point").removeAttr("disabled");
				$("#used_point").css("display","block");
            }
        })

        //주문자와 동일
        $(".deliverySelTd input").click(function(){
            if($(this).val()==1){
                $(".delivery_name").val($(".order_name").val());
                $(".delivery_phone").val($(".order_phone").val());
                $("#sample2_postcode").val($("#mb_zip1").val());
                $("#sample2_address").val($("#mb_addr1").val());
                $("#sample2_address2 ").val($("#mb_addr2").val());
            }else if($(this).val()==2){
                $(".delivery_name").val("");
                $(".delivery_phone").val("");
                $("#sample2_postcode").val("");
                $("#sample2_address").val("");
                $("#sample2_address2 ").val("");
            }
        })

        //동의
        $(".order_agrees li input[type=checkbox]").click(function(){
            //$(this).addClass("active");
            if($(this).is(":checked")==true && $(this).text()=="전체동의"){
                //$(".order_agrees li label").addClass("active");
                $("input[id^=agree]").each(function(){
                    $(this).prop("checked",true);
                })
            }else if($(this).is(":checked")==false && $(this).text()=="전체동의"){
                //$(".order_agrees li label").removeClass("active");
                $("input[id^=agree]").each(function(){
                    $(this).prop("checked",false);
                })
            }
            //if($(this).)
        })
        
        //다른 주소
        $(".edit_addr > label").click(function(){
            $(".section01.edit_addr_on").toggle();
            if($("#order_addr_edit").is(":checked")==true){
                $(".edit_addr").addClass("active");
                $(".section01.edit_addr_on").css("display","block");
                $("#other_addr").val("Y");
            }else{
                $(".edit_addr").removeClass("active");
                $(".section01.edit_addr_on").css("display","none");
                $("#other_addr").val("N");
            }
        })
        
        //바로결제
        $(".order_type label.direct").click(function(event){
            if($(this).children("input").val()==1 && $(this).children("input").is(":checked")==true) {
                $(this).prev().css("background-color", "#888");
                $(".order_type label.no-direct").prev().css("background-color", "#eee");
                $(".order_type_sel").css("display","block");
                $(".order_type_sel_direct").css("display","none");
            }else{
                $(this).prev().css("background-color", "#eee");
            }
            $("#order_type").val($(this).text());
        })
        
        //만나서결제
        $(".order_type label.no-direct").click(function(event){
            if($(this).children("input").val()==2 && $(this).children("input").is(":checked")==true) {
                $(this).prev().css("background-color", "#888");
                $(".order_type label.direct").prev().css("background-color", "#eee");
                $(".order_type_sel").css("display","none");
                $(".order_type_sel_direct").css("display","block");
            }else{
                $(this).prev().css("background-color", "#eee");
            }
            $("#order_type").val($(this).text());
        })
                
    })

    function fn_submit(){
        <?php if($is_member){?>
        if($("#order_phone").val()==""){
            alert("주문자 휴대폰번호를 입력해 주세요.!");
            $(".direct").focus();
            return false;
        }
        <?php } ?>
        if($("#order_type").val()==""){
            alert("주문방법을 선택해 주세요.!");
            $(".").focus();
            return false;
        }
        if($("#order_type2").val()==""){
            alert("결제방법을 선택해 주세요.!");
            $(".order_type_select").focus();
            return false;
        }

        <?php if($is_member){?>

        <?php } else { ?>
        else if($("order_pass").val()==""){
            alert("주문조회 비밀번호를 입력해 주세요.!");
            $(".order_type_select ul li").focus();
            return false;
        }

        <?php }?>

        else if($("#other_addr").val()=="Y" && $(".delivery_name").val() == "") {
            alert("수령인 이름을 입력해 주세요.!");
            $(".delivery_name").focus();
            return false;
        }

        else if ($("#other_addr").val()=="Y" &&  $(".delivery_phone").val() == "") {
            alert("수령인 전화번호를 입력해 주세요.!");
            $(".delivery_name").focus();
            return false;
        }

        else if ($("#other_addr").val()=="Y" &&  ($("#sample2_postcode").val() == "" || $("#sample2_address").val() == "" || $("#sample2_address2").val() == "")) {
            alert("수령인 주소를 입력해 주세요.!");
            $(".delivery_name").focus();
            return false;
        }


        else if($("#agree2").is(":checked")==false){
            alert("결제진행에 동의를 하셔야 합니다.!");
            $("#agree2").parent().focus();
            return false;
        }
        else if($("#agree3").is(":checked")==false){
            alert("개인정보 제3자 제공동의를 하셔야 합니다.!");
            $("#agree3").parent().focus();
            return false;
        }
        <?php if(!$is_member) {?>
        else if($("#agree4").is(":checked")==false){
            alert("비회원 개인정보 취급방침에 동의를 하셔야 합니다.!");
            $("#agree4").parent().focus();
            return false;
        }
        <?php }?>

        else {
            return true;
        }
    }

</script>
<?php
include_once ("../../tail.php");
?>