<?php
include_once('./_common.php');

$g5['title'] = '로그인';
include_once('./_head.php');

$url = $_GET['url'];

$lat = $_REQUEST["lat"];
$lng = $_REQUEST["lng"];
// url 체크
check_url_host($url);

// 이미 로그인 중이라면
if ($is_member) {
    if ($url)
        goto_url(G5_URL."?lat=".$lat."&lng=".$lng);
    else
        goto_url(G5_URL."?lat=".$lat."&lng=".$lng);
}

$login_url        = login_url($url);
$login_action_url = G5_HTTPS_BBS_URL."/login_check.php?lat=".$lat."&lng=".$lng;

// 로그인 스킨이 없는 경우 관리자 페이지 접속이 안되는 것을 막기 위하여 기본 스킨으로 대체
$login_file = $member_skin_path.'/login.skin.php';
if (!file_exists($login_file))
    $member_skin_path   = G5_SKIN_PATH.'/member/basic';

if($type=="user" || $type=="")
    include_once($member_skin_path.'/login.skin.php');
else if($type=="shop")
    include_once($member_skin_path.'/login.skin2.php');

include_once('./_tail.php');
?>
