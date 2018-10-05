<?php
include_once ("../../common.php");
include_once ("../../head.php");
$member_skin_url = G5_URL."/skin/member/basic";
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
    .leave_title{text-align: center;padding:20px 0;}
    .leave_title h2{font-size:30px;color:#cf1616}
    .leave_title p{margin:20px 0;white-space: normal;word-break: break-all;font-size:18px;}
    @media screen and (max-width: 768px){
        .leave_title h2{font-size:22px;}
        .leave_title p{font-size: 16px}
    }
    @media screen and (max-width: 540px){
        .leave_title h2{font-size:20px;}
        .leave_title p{font-size: 15px}
    }
    @media screen and (max-width: 480px){
        .leave_title h2{font-size:18px;}
        .leave_title p{font-size: 14px}
    }
    @media screen and (max-width: 400px){
        .leave_title h2{font-size:16px;}
        .leave_title p{font-size: 12px}
    }
</style>
<div class="width-fixed">
    <section class="section01" >
        <div class="section01_content wrap">
            <div class="leave_title">
                <h2>회원탈퇴를 하시면..</h2>
                <p>회원님이 그동안 받으신 포인트가 모두 소멸 됩니다. <br>그동안 등록해 놓은 정보는 물론 누릴 수 있는 서비스도 이용하실 수 없습니다. <br>지금이라도 다시 생각해 보세요.</p>
            </div>
            <div id="register_form">
                <form action="<?php echo G5_BBS_URL?>/member_leave.php" id="fregisterform" method="post">
                    <div class="form_list01">
                        <ul>
                            <li>
                                <div>
                                    <label>아이디 <span>*</span></label>
                                    <div>
                                        <input type="text" class="input01" name="mb_id" value="<?php echo $member["mb_id"]?>" readonly >
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label>비밀번호 <span>*</span></label>
                                    <div>
                                        <input type="password" class="input01" name="mb_password" required>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <label>탈퇴사유 <span>*</span></label>
                                    <div>
                                        <select name="mb_leave_type" id="mb_leave_type" class="input01" required>
                                            <option value="">탈퇴사유</option>
                                            <option value="단순변심">단순변심</option>
                                            <option value="서비스불만족">서비스불만족</option>
                                            <option value="컨텐츠부족">컨텐츠부족</option>
                                            <option value="기타">기타</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <div>
                                        <textarea name="mb_leave_content" id="" cols="40" rows="20" class="input01 grid_100" required></textarea>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="btn_group01">
                        <input type="submit" value="탈퇴하기" class="btn grid_100 bg_darkred color_white ">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>

