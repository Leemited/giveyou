<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
$member_id = get_cookie('ck_save_id');
?>
<div class="width-fixed">
    <section class="login_section">
        <header class="login_header section01_header">
            <h1>상점 로그인</h1>
            <h3 class="login_head"></h3>
            <p>고파의 상점서비스를 이용하시려면 로그인해 주세요.</p>
        </header>
        <div class="section01_content wrap">
            <div id="login_form">
                <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
                    <input type="hidden" name="url" value="<?php echo $login_url ?>">
                    <input type="hidden" name="regid" id="regid" value="" />
                    <div class="login_id">
                        <i></i>
                        <input type="text" name="mb_id" id="login_id" required class="input02 grid_100" size="20" maxLength="20" placeholder="아이디를 입력하세요." value="<?php echo $member_id; ?>">
                    </div>
                    <div class="login_pw">
                        <i></i>
                        <input type="password" name="mb_password" id="login_pw" required class="input02 grid_100" size="20" maxLength="20" placeholder="비밀번호를 입력하세요.">
                    </div>
                    <div class="login_chk">
                        <div class="bdr">
                            <input type="checkbox" name="auto_login" id="login_auto_login" class="check01">
                            <label for="login_auto_login" class="check01_label"></label>
                            <label for="login_auto_login">자동로그인</label>
                        </div>
                        <div>
                            <input type="checkbox" name="id_save" id="id_save_login" class="check01" <?php echo $member_id?"checked":""; ?>>
                            <label for="id_save_login" class="check01_label"></label>
                            <label for="id_save_login">아이디저장</label>
                        </div>
                    </div>
                    <input type="submit" value="로그인" class="grid_100 login_input bg_darkred">
                </form>

                <div class="login_link">
                    <ul>
                        <li>아이디/비밀번호를 잊어버리셨나요?<a href="<?php echo G5_BBS_URL ?>/password_lost.php?type=shop" class="btn">아이디 / 비밀번호찾기</a></li>
                        <li class="last">아직 회원이 아니신가요?<a href="<?php echo G5_BBS_URL ?>/register_form.php?type=shop" class="btn">판매자 회원가입</a></li>
                    </ul>
                </div>
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
    $(function(){
        $("#login_auto_login").click(function(){
            if (this.checked) {
                this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
            }
        });
    });

    function flogin_submit(f)
    {
        return true;
    }
</script>
<!-- } 로그인 끝 -->