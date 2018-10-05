<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
<?php } ?>
<div class="width-fixed">
    <section class="section01">
        <div class="section01_header">
            <div><h2><?php echo($w)?"회원정보수정":"판매자 회원가입";?></h2></div>
        </div>
        <div class="section01_content wrap">
            <div id="register_form">
                <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" name="w" value="<?php echo $w ?>">
                    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
                    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
                    <input type="hidden" name="cert_no" value="">
                    <input type="hidden" name="type" value="shop">
                    <input type="hidden" name="regid" id="regid" value="">
                    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
                        <input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
                        <input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
                        <input type="hidden" name="mb_sms" value="1" id="reg_mb_sms" />
                    <?php }  ?>
                    <div class="form_list01">
                        <ul>
                            <li>
                                <div>
                                    <label for="reg_mb_id">아이디<span>*</span></label>
                                    <div>
                                        <input type="text" name="mb_id" value="<?php echo isset($member['mb_id'])?$member['mb_id']:''; ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input01" >
                                        <span id="msg_mb_id"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="bdr">
                                    <label for="reg_mb_password">비밀번호<span>*</span></label>
                                    <div><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input01" minlength="3" maxlength="20"></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="reg_mb_password_re">비밀번호<br>확인<span>*</span></label>
                                    <div><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input01" minlength="3" maxlength="20"></div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="reg_mb_name">점주 이름<span>*</span></label>
                                    <div>
                                        <input type="text" name="mb_name" value="<?php echo $member['mb_name'] ?>" id="reg_mb_name" <?php echo $required ?> <?php echo $readonly ?> class="input01" minlength="3" maxlength="20">
                                        <span id="msg_mb_name"></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="bdr">
                                    <label for="reg_mb_hp">휴대폰번호<span>*</span></label>
                                    <div>
                                        <input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" <?php echo ($config['cf_req_hp'])?"required":""; ?> onkeyup="return number_only(this);" class="input01" maxlength="12" <?php echo $required ?>>
                                    </div>
                                    <?php //if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                                    <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">
                                    <?php //} ?>
                                    <div class="btn_group">
                                        <input type="button" value="본인인증" class="btn grid_100" style="padding:8px 10px;" id="win_hp_cert">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="">이메일 <span>*</span></label>
                                    <div>
                                        <input type="text" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" class="input01" maxlength="100">
                                        <input type="hidden" name="old_email" value="<?php echo $member['mb_email']; ?>">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="form_list01">
                        <div class="form_header">
                            <div><h2 style="padding:0;font-size: 1.5em;font-weight: bold;">상점정보입력</h2></div>
                        </div>
                        <ul>
                            <li>
                                <div>
                                    <label for="shop_name">가맹점명 <span>*</span></label>
                                    <div>
                                        <input type="text" name="shop_name" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="shop_name" class="input01" maxlength="100">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="shop_hp">가맹점 전화번호 <span>*</span></label>
                                    <div>
                                        <input type="text" name="shop_hp" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="shop_hp" class="input01" maxlength="100">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="shop_homepage">홈페이지 <span>*</span></label>
                                    <div>
                                        <input type="text" name="shop_homepage" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="shop_homepage" class="input01" maxlength="100">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label for="sample2_postcode">가맹점 주소<span>*</span></label>
                                    <div>
                                        <input type="text" name="shop_zip1" class="input01" value="<?php echo $member["mb_zip1"]?>" id="sample2_postcode" placeholder="우편번호" readonly <?php echo $required ?>>
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
                                        <input type="text" name="shop_addr1" id="sample2_address" value="<?php echo $member["mb_addr1"]?>" class="input01" placeholder="기본주소" readonly <?php echo $required ?>>
                                        <input type="text" name="shop_addr2" id="sample2_address2" value="<?php echo $member["mb_addr2"]?>" class="input01" placeholder="나머지 상세주소" <?php echo $required ?>>
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
                                    <label for="shop_marketing">사업증빙서류 <span>*</span></label>
                                    <div>
                                        <input type="file" name="shop_marketing" value="" id="shop_marketing" class="input01" maxlength="100">
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <p><span>*</span> 는 필수입력사항입니다.</p>
                    </div>
                    <?php if(!$w){ ?><p><input type="checkbox" name="agree" id="agree" class="check01" /><label for="agree" class="check01_label"></label><label for="agree"><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">이용약관</a>과 <a href="<?php echo G5_URL."/page/guide/privacy.php";?>">개인정보취급방침</a>에 동의합니다.</label></p><?php } ?>
                    <?php if(!$w){ ?><p><input type="checkbox" name="agree4" id="agree4" class="check01" /><label for="agree4" class="check01_label"></label><label for="agree4"><a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">위치기반서비스이용약관</a>에 동의합니다.</label></p><?php } ?>
                    <p><input type="checkbox" name="mb_mailing" id="agree2" class="check01" <?php if($member['mb_mailling']==1){ echo "checked";}?> /><label for="agree2" class="check01_label"></label><label for="agree2">(선택)<a href="<?php echo G5_URL."/page/guide/agreement.php"; ?>">메일수신(이메일수집방침)</a> 동의합니다.</label></p>
                    <p><input type="checkbox" name="off_gcm" id="agree3" class="check01" <?php if($member['mb_10']=="Y"){ echo "checked";}?>/><label for="agree3" class="check01_label"></label><label for="agree3">(선택)마케팅정보 앱 푸시알림 수신에 동의합니다.</label></p>
                    <div class="btn_group01">
                        <?php if(!$w){ ?><a href="<?php echo G5_BBS_URL ?>/login.php?type=shop" class="bg_lightgray btn color_white grid_50">취소</a><?php }else{ ?><a href="<?php echo G5_URL."/page/mypage/member_leave_form.php" ?>" class="bg_lightgray btn color_white grid_50">회원탈퇴</a><?php } ?>
                        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" class="bg_darkred btn color_white grid_50" accesskey="s">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    $(function(){
        //getRegid
        try{
            var regId = window.android.getRegid();
            console.log(regId);
            $("#regid").val(regId);
        }catch(err){
            var regId = undefined;
            console.log(err);
        }
    });
    $(function() {

        $("#reg_mb_id").change(function () {
            var email = $(this).val();
            $("#reg_mb_email").val(email);
        })

        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
        <?php } ?>
    });

    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
        return true;
    }
</script>
<!-- } 회원정보 입력/수정 끝 -->