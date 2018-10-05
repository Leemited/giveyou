<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if((defined('G5_NAVER_OAUTH_CLIENT_ID') && G5_NAVER_OAUTH_CLIENT_ID) || (defined('G5_KAKAO_OAUTH_REST_API_KEY') && G5_KAKAO_OAUTH_REST_API_KEY) || (defined('G5_FACEBOOK_CLIENT_ID') && G5_FACEBOOK_CLIENT_ID) || (defined('G5_GOOGLE_CLIENT_ID') && G5_GOOGLE_CLIENT_ID)) {

//add_stylesheet('<link rel="stylesheet" href="'.G5_PLUGIN_URL.'/oauth/style.css">', 10);
add_javascript('<script src="'.G5_PLUGIN_URL.'/oauth/jquery.oauth.login.js"></script>', 10);

$social_oauth_url = G5_PLUGIN_URL.'/oauth/login.php?service=';

if (preg_match('/(iPhone|Android|iPod|BlackBerry|IEMobile|HTC|Server_KO_SKT|SonyEricssonX1|SKT)/',
    $_SERVER['HTTP_USER_AGENT']) ) {
    define('BROWSER_TYPE', 'M'); // mobile
} else {
    define('BROWSER_TYPE', 'W'); // web (iPad 는 웹으로 간주)
}
$mobile=false;
if(BROWSER_TYPE == "M")
{
   $mobile=true;
}
?>
<div class="<?php echo (G5_IS_MOBILE ? 'm-' : ''); ?>login-sns sns-wrap-32 sns-wrap-over">
    <div class="sns-wrap">
        <?php if(defined('G5_NAVER_OAUTH_CLIENT_ID') && G5_NAVER_OAUTH_CLIENT_ID) { ?>
				<input type="button" value="네이버 로그인" onclick="location.href='<?php echo $social_oauth_url.'naver'; ?>'" class="sns-icon social_oauth sns-naver naver login_btn btn">
        <?php } ?>
        <?php if(defined('G5_KAKAO_OAUTH_REST_API_KEY') && G5_KAKAO_OAUTH_REST_API_KEY) { ?>
                <input type="button" class=" btn kakao login_btn" value="카카오톡 로그인" onclick="location.href='<?php echo $social_oauth_url."kakao";?>'">
        <?php } ?>
        <?php /*if(defined('G5_FACEBOOK_CLIENT_ID') && G5_FACEBOOK_CLIENT_ID) { */?><!--
                <input type="button" class=" btn facebook login_btn" value="페이스북 로그인" onclick="location.href='<?php /*echo $social_oauth_url . "facebook"; */?>'">
        --><?php /*}*/?>
        <?php if(defined('G5_GOOGLE_CLIENT_ID') && G5_GOOGLE_CLIENT_ID) { ?>
				<input type="button" value="구글 로그인" onclick="location.href='<?php echo $social_oauth_url.'google'; ?>'" target="_blank" class="sns-icon social_oauth sns-gg google login_btn btn">
        <?php } ?>
    </div>
</div>
<?php
}
?>