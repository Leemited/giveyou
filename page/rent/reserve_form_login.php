<?php
	include_once("../../common.php");
	$back_url=G5_URL."/page/rent/view.php?model=".$model."&type=".$type;
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	if($is_member){
		goto_url(G5_URL."/page/rent/reserve_form.php?model=".$model."&type=".$type);
	}
?>
	<div class="width-fixed">
		<section class="login_section">
			<header class="login_header section01_header">
				<h1>예약하기</h1>
				<h3 class="reserve_head"></h3>
				<p>베스트렌터카의 회원서비스를 이용하시려면 로그인해 주세요.</p>
			</header>
			<div class="section01_content wrap">
				<div class="sub_call_banner">
					<h3>예약 후 <span>1시간 이내</span>에 연락드리겠습니다.</h3>
					<h2>영업시간 내 <span>빠른예약</span>을 원하신다면?</h2>
					<p><?php if(!$best_tel['all']){ ?>영업시간 <?php echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></p>
					<a href="tel:<?php echo $best_tel['tel']; ?>">
						<i></i>
						<div>
							전화예약<br />
							하러가기
						</div>
					</a>
				</div>
				<div id="login_form">
					<form name="flogin" action="<?php echo G5_BBS_URL."/login_check.php"; ?>" onsubmit="return flogin_submit(this);" method="post">
						<input type="hidden" name="url" value="<?php echo G5_URL."/page/rent/reserve_form.php?model=".$model."&type=".$type; ?>">
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
						<input type="submit" value="로그인" class="grid_100 btn">
						<a href="<?php echo G5_URL."/page/rent/reserve_form.php?model=".$model."&type=".$type; ?>" class="grid_100 btn" style="background:#424242;margin-top:10px;border:0;padding:13px 0;">비회원으로 예약하기</a>
					</form>
					<div class="login_link">
						<ul>
							<li>아이디/비밀번호를 잊어버리셨나요?<a href="<?php echo G5_BBS_URL ?>/password_lost.php" class="btn">아이디 / 비밀번호찾기</a></li>
							<li class="last">아직 회원이 아니신가요?<a href="<?php echo G5_BBS_URL ?>/register_form.php" class="btn">회원가입</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>