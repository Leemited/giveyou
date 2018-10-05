<?php
include_once("../../common.php");
$wr_id=$_REQUEST["wr_id"];

$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");


$wr_subject=$view["wr_subject"];
$back_url=G5_URL."/page/shop/my_store_list.php";
include_once(G5_PATH."/head.php");

?>
<style>
    img.info{
        position: absolute;
        width:30px;
        left:10px;
        top:6px;
    }
    #view_section_info h2.detail_title{padding-left:50px;}
    @media all and (max-width: 480px){
        #view_section_info .section01_content dt{width:100%}
        #view_section_info .section01_content dd{width:98%}
    }
</style>
<div class="width-fixed view">
    <form id="fregisterform" name="fregisterform" action="<?php echo G5_URL."/page/shop/my_store_add_update.php";?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
        <section class="section01" id="view_section_info">
            <div class="section01_header">
                <div ><img class="info" src="<?php echo G5_IMG_URL?>/store_detail_info_icon.png"><h2 class="detail_title">상점정보 입력</h2></div>
            </div>
            <div class="section01_content">
                <dl>
                    <dt>가맹점명</dt>
                    <dd><input type="text" name="shop_name" value="" id="shop_name" class="input01 grid_100" maxlength="100"></dd>
                    <dt>전화번호 <span>*</span> </dt>
                    <dd><input type="text" name="shop_hp" value="<?php echo isset($member['mb_hp'])?$member['mb_hp']:''; ?>" id="shop_hp" class="input01 grid_100" maxlength="100"></dd>
                    <dt>홈페이지</dt>
                    <dd><input type="text" name="store_open"  value="<?php echo $view["open_time"]?>" class="input01 grid_100"></dd>
                    <dt>주소</dt>
                    <dd>
                        <div id="search_addr" style="width:100%;"></div>
                        <input type="text" name="shop_zip1" class="input01 grid_50" value="<?php echo $member["mb_zip1"]?>" id="sample2_postcode" placeholder="우편번호" readonly <?php echo $required ?>>
                        <input type="button" value="주소찾기" class="btn grid_50 input01"   onclick="DaumPostcode()">
                        <input type="text" name="shop_addr1" id="sample2_address" value="<?php echo $member["mb_addr1"]?>" class="input01 grid_100" placeholder="기본주소" readonly <?php echo $required ?>>
                        <input type="text" name="shop_addr2" id="sample2_address2" value="<?php echo $member["mb_addr2"]?>" class="input01 grid_100" placeholder="나머지 상세주소" <?php echo $required ?>>
                    </dd>
                    <dt>업종선택</dt>
                    <dd><select name="shop_cate" id="shop_cate" class="input01 grid_100">
                            <option value="">선택하세요</option>
                            <option value="카페/디저트">카페/디저트</option>
                            <option value="한식/분식">한식/분식</option>
                            <option value="중식">중식</option>
                            <option value="고기/족발/보쌈">고기/족발/보쌈</option>
                            <option value="치킨/피자">치킨/피자</option>
                            <option value="패스트푸드">패스트푸드</option>
                            <option value="야식/찜/탕">야식/찜/탕</option>
                            <option value="도시락/죽/기타">도시락/죽/기타</option>
                            <option value="회/돈까스/일식">회/돈까스/일식</option>
                        </select></dd>
                    <dt>사업자번호</dt>
                    <dd><input type="text" name="shop_number" value="" id="shop_number" class="input01 grid_100" maxlength="100"></dd>
                    <dt>통장사본</dt>
                    <dd><input type="file" name="shop_bank" value="" id="shop_bank" class="input01 grid_100" maxlength="100"></dd>
                    <dt>전단지(확인용)</dt>
                    <dd><input type="file" name="shop_marketing" value="" id="shop_marketing" class="input01 grid_100" maxlength="100"></dd>
                </dl>
            </div>
        </section>
        <div class="shop_btn_group">
            <input type="button" value="등록" class="btn shop_img_add_btn bg_darkred grid_100">
        </div>
    </form>
</div>
<?php
include_once(G5_PATH."/tail.php");
?>


<?php
//include_once("../../common.php");
//include_once ("../../head.php");
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

    <!--<div class="width-fixed">
        <section class="section01">
            <div class="section01_content wrap">
                <div id="register_form">
                    <form id="fregisterform" name="fregisterform" action="<?php /*echo G5_URL."/page/shop/my_store_add_update.php";*/?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                        <div class="form_list01">
                            <div class="form_header">
                                <div><h2 style="padding:0;font-size: 1.5em;font-weight: bold;">상점정보입력</h2></div>
                            </div>
                            <ul>
                                <li>
                                    <div>
                                        <label for="shop_name">가맹점명 <span>*</span></label>
                                        <div>
                                            <input type="text" name="shop_name" value="" id="shop_name" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_hp">가맹점<br>전화번호 <span>*</span></label>
                                        <div>
                                            <input type="text" name="shop_hp" value="<?php /*echo isset($member['mb_hp'])?$member['mb_hp']:''; */?>" id="shop_hp" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_homepage">홈페이지 <span>*</span></label>
                                        <div>
                                            <input type="text" name="shop_homepage" value="<?php /*echo isset($member['mb_homepage'])?$member['mb_homepage']:''; */?>" id="shop_homepage" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="sample2_postcode">가맹점 주소<span>*</span></label>
                                        <div>
                                            <input type="text" name="shop_zip1" class="input01" value="<?php /*echo $member["mb_zip1"]*/?>" id="sample2_postcode" placeholder="우편번호" readonly <?php /*echo $required */?>>
                                        </div>
                                        <div class="btn_group">
                                            <input type="button" value="주소찾기" class="btn grid_100" style="padding:8px 10px;"  onclick="DaumPostcode()">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <dlv>
                                            <div id="search_addr" style="width:100%;"></div>
                                        </dlv>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="sample2_address"></label>
                                        <div>
                                            <input type="text" name="shop_addr1" id="sample2_address" value="<?php /*echo $member["mb_addr1"]*/?>" class="input01" placeholder="기본주소" readonly <?php /*echo $required */?>>
                                            <input type="text" name="shop_addr2" id="sample2_address2" value="<?php /*echo $member["mb_addr2"]*/?>" class="input01" placeholder="나머지 상세주소" <?php /*echo $required */?>>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_cate">업종선택 <span>*</span></label>
                                        <div>
                                            <select name="shop_cate" id="shop_cate" class="input01">
                                                <option value="">선택하세요</option>
                                                <option value="카페/디저트">카페/디저트</option>
                                                <option value="한식/분식">한식/분식</option>
                                                <option value="중식">중식</option>
                                                <option value="고기/족발/보쌈">고기/족발/보쌈</option>
                                                <option value="치킨/피자">치킨/피자</option>
                                                <option value="패스트푸드">패스트푸드</option>
                                                <option value="야식/찜/탕">야식/찜/탕</option>
                                                <option value="도시락/죽/기타">도시락/죽/기타</option>
                                                <option value="회/돈까스/일식">회/돈까스/일식</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_number">사업자번호 <span>*</span></label>
                                        <div>
                                            <input type="text" name="shop_number" value="" id="shop_number" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_bank">통장사본 <span>*</span></label>
                                        <div>
                                            <input type="file" name="shop_bank" value="" id="shop_bank" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <label for="shop_marketing">전단지 <span>*</span></label>
                                        <div>
                                            <input type="file" name="shop_marketing" value="" id="shop_marketing" class="input01" maxlength="100">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <p><span>*</span> 는 필수입력사항입니다.</p>
                        </div>
                        <?php /*//if($w=="cu"){*/?>
                        <!--<div id="setting">
                        <ul>
                            <li>
                                메일수신(이메일수집방침)
                                <a href="<?php /*echo G5_URL."/page/setting/push_update.php"; */?>" class="<?php /*echo $member['off_gcm']?"off":"on"; */?>"><span></span></a>
                            </li>
                            <li class="mt20">
                                마케팅정보 앱 푸시알림
                                <a href="<?php /*echo G5_URL."/page/setting/push_update.php"; */?>" class="<?php /*echo $member['off_gcm']?"off":"on"; */?>"><span></span></a>
                            </li>
                        </ul>
                    </div>
                        <?php /*//} */?>
                        <p><input type="checkbox" name="mb_mailing" id="agree2" class="check01" <?php /*if($member['mb_mailling']==1){ echo "checked";}*/?> /><label for="agree2" class="check01_label"></label><label for="agree2">(선택)<a href="<?php /*echo G5_URL."/page/guide/agreement.php"; */?>">메일수신(이메일수집방침)</a> 동의합니다.</label></p>
                        <p><input type="checkbox" name="off_gcm" id="agree3" class="check01" <?php /*if($member['mb_10']=="Y"){ echo "checked";}*/?>/><label for="agree3" class="check01_label"></label><label for="agree3">(선택)마케팅정보 앱 푸시알림 수신에 동의합니다.</label></p>
                        <div class="btn_group01">
                            <a href="<?php /*echo G5_BBS_URL */?>/page/shop/my_store_list.php" class="bg_lightgray btn color_white grid_50">취소</a>
                            <input type="submit" value="등록하기" class="bg_darkred btn color_white grid_50" accesskey="s">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>-->
    <!-- } 회원정보 입력/수정 끝 -->
<?php
//include_once ("../../tail.php");
?>