<?php
include_once('../../common.php');
?>
<div>
	<header class="msg_head">아이디 찾기</header>
	<div class="msg_con">
<?php
if ($is_member) {
    $msg='이미 로그인중입니다.';
}

$hp = hyphen_hp_number($_POST['mb_hp']);

if (!$hp){
    $msg='휴대폰 번호 오류입니다.';
}

$sql = " select count(*) as cnt from {$g5['member_table']} where mb_email = '$hp' ";
$row = sql_fetch($sql);
if ($row['cnt'] > 1){
	$msg='동일한 휴대폰번호가 2개 이상 존재합니다.\\n\\n관리자에게 문의하여 주십시오.';
}

$sql = " select mb_no, mb_id, mb_name, mb_nick, mb_email, mb_datetime from {$g5['member_table']} where mb_hp = '$hp' ";
$mb = sql_fetch($sql);
if (!$mb['mb_id']){
   $msg='존재하지 않는 회원입니다.';
}else if (is_admin($mb['mb_id'])){
   $msg='관리자 아이디는 접근 불가합니다.';
}
if(!$msg){
	$mb_id=substr_replace ($mb['mb_id'], '***', 2, 3);
	$msg="회원님의 아이디는 '".$mb_id."'입니다.";
}
echo $msg;
?>
		<div class="msg_btn_group">
			<a href="javascript:msg_close();" class="btn bg_darkred color_white">확인</a>
		</div>
	</div>
</div>