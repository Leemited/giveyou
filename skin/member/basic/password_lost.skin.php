<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style type="text/css">
	.section01_header .password_lost_head{width:100%;height:45px;background-image:url("../img/password_lost_head.png");background-repeat:no-repeat;background-position:top left;}
	#password_lost{display:table;width:100%;}
	#password_lost > div{float:left;width:100%;box-sizing:border-box;background:#fff;border:1px solid #ddd;border-radius:5px;}
	#password_lost > div.mr{margin-right:36px;}
	#password_lost > div header{padding:26px 22px;border-bottom:2px solid #474747;letter-spacing:-0.07em;}
	#password_lost > div header h2{font-size:24px;font-family:nbgr;font-weight:normal;margin-bottom:5px;}
	#password_lost > div header p{font-size:14px;color:#737373;}
	#password_lost > div > div{padding:40px 18px;}
	#password_lost > div > div .btn{margin-top:12px;font-size:20px;letter-spacing:-0.02em;font-family:nbgr;height:50px;border:none;background:#f17a40;color:#fff;border-radius:10px;}
	@media all and (max-width: 1120px){
		#password_lost{display:block;box-sizing:border-box;}
		#password_lost > div{float:none;width:100%;}
		#password_lost > div.mr{margin-right:0;margin-bottom:20px;}
	}
	@media all and (max-width: 786px){
		#password_lost > div header{padding:20px 15px;}
		#password_lost > div header h2{font-size:18px;margin-bottom:3px;}
		#password_lost > div > div{padding:20px 15px;}
		#password_lost > div > div .btn{height:40px;font-size:16px;}
	}
	@media all and (max-width: 480px){
		#password_lost > div header{padding:15px;}
		#password_lost > div header h2{font-size:16px;margin-bottom:0;}
		#password_lost > div header p{font-size:12px;}
		#password_lost > div > div{padding:15px;}
		#password_lost > div > div .btn{font-size:16px;margin-top:5px;}
	}
</style>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1>아이디/비밀번호 찾기</h1>
			<h3 class="password_lost_head"></h3>
			<p>회원가입 시 등록하신 정보로 아이디/비밀번호를 찾으실 수 있습니다.</p>
		</header>
		<div class="section01_content wrap" id="password_lost">
			<div class="mr">
				<header>
					<h2>아이디 찾기</h2>
					<p>회원가입 시 등록하신 휴대폰번호를 입력하세요.</p>
				</header>
				<div>
					<form name="idlost" action="#" onsubmit="return idlost_submit(this);" method="post" autocomplete="off">
						<input type="text" name="mb_hp" id="mb_hp" required class="input02 grid_100" onkeyup="return number_only(this);" placeholder="휴대폰번호(-없이 입력)" />
						<input type="submit" value="아이디 찾기" class="btn grid_100">
					</form>
				</div>
			</div>
			<div>
				<header>
					<h2>비밀번호 찾기</h2>
					<p>회원가입 시 등록하신 이메일을 입력하세요.</p>
				</header>
				<div>
					<form name="pwlost" action="#" onsubmit="return pwlost_submit(this);" method="post" autocomplete="off">
						<input type="text" name="mb_email" id="mb_email" required class="input02 grid_100" size="30"placeholder="이메일주소 입력" />
						<input type="submit" value="비밀번호 찾기" class="btn grid_100">
					</form>
				</div>
			</div>
		</div>
	</section>
</div>


<script>
function idlost_submit(f){
	var mb_hp=$("#mb_hp").val();
	$.post(g5_url+"/page/modal/idlost.php",{mb_hp:mb_hp},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}
function pwlost_submit(f){
	var mb_email=$("#mb_email").val();
	$.post(g5_bbs_url+"/password_lost2.php",{mb_email:mb_email},function(data){
		$(".msg").html(data);
		msg_active();
	});
    return false;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->