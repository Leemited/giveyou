<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 상단 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_head'] && is_file(G5_PATH.'/'.$config['cf_include_head'])) {
    include_once(G5_PATH.'/'.$config['cf_include_head']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}
include_once(G5_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');


if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

//print_r2($_SESSION);

$lat = $_REQUEST["lat"];
$lng = $_REQUEST["lng"];

if(!$lat){
	$lat = $member["mb_3"];
}
if(!$lng){
	$lng = $member["mb_4"];
}

//print_r($lat."/".$lng);
$pageName = $_SERVER["REQUEST_URI"];
$view_chk = strpos($pageName,"view.php")===false;
$regist_chk = strpos($pageName,"register_form.php")===false;
$partner=sql_fetch("select * from `best_partner` where mb_id='".$member['mb_id']."'");
$branch=sql_fetch("select * from `best_branch` where mb_id='".$member['mb_id']."'");
$cart_count = sql_fetch("select count(*) as total from `cart` where (`mb_id` = '{$member[mb_id]}' or `mb_id` = '{$_COOKIE[PHPSESSID]}') and cart_date = CURRENT_DATE() and cart_state=0");
$cart_total = $cart_count["total"];
/*
if (empty($fr_date)) $fr_date = "2015-01-01";
if (empty($to_date)) $to_date = G5_TIME_YMD;

$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date;

$sql_common = " from {$g5['popular_table']} a ";
$sql_search = " where trim(pp_word) <> '' and pp_date between '{$fr_date}' and '{$to_date}' ";
$sql_group = " group by pp_word ";
$sql_order = " order by cnt desc ";

$sql = " select pp_word {$sql_common} {$sql_search} {$sql_group} ";
$result = sql_query($sql);
$total_count = mysql_num_rows($result);

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select pp_word, count(*) as cnt {$sql_common} {$sql_search} {$sql_group} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
while($row = sql_fetch_array($result)){
	$popular[] = $row;
}*/


?>
<!-- 헤더 시작 -->
<div class="logo <?php if($type=="shop" || $member["mb_level"] == 5){echo " shop_logo";}?>">
	<?php if($type=="shop" || $member["mb_level"] == 5){?>
	<a href="<?php echo G5_URL?>/page/shop/index.php?type=shop&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>">
		<img src="<?php echo G5_IMG_URL?>/shop_logo.png" alt="" >
	</a>
	<?php }else{ ?>
	<a href="<?php echo G5_URL?>/index.php?lat=<?php echo $lat;?>&lng=<?php echo $lng;?>">
		<img src="<?php echo G5_IMG_URL?>/logo.svg" alt="" >
	</a>
	<?php }?>
</div>
<header id="header" class="<?php echo $main?"":"sub_header"; echo ($wr_id || $w)?" whiteHeader":""; if($type=="shop" || $member["mb_level"] == 5){echo " shop_head";}?>">
	<div id="top_header">
		<div class="width-fixed">
			<?php if($is_member){ ?>
				<p><span></span><?php echo $member['mb_id']; ?> 님 (<?php echo number_format($member['mb_point']); ?>p)</p>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>">정보수정</a></li>
					<?php if($is_admin || $partner['id'] || $branch['id']){ ?>
					<li><a href="<?php echo G5_URL."/admin"; ?>">관리자</a></li>
					<?php } ?>
					<li class="last"><a href="<?php echo G5_BBS_URL."/logout.php"; ?>">로그아웃</a></li>
				</ul>
			<?php }else{ ?>
				<ul>
					<li><a href="<?php echo G5_BBS_URL."/login.php?type=user"; ?>">로그인</a></li>
					<li class="last"><a href="<?php echo G5_BBS_URL."/register_form.php"; ?>">회원가입</a></li>
				</ul>
			<?php } ?>
		</div>
	</div>
	<div id="main_header">
		<div class="width-fixed">
			<h1><a href="<?php echo G5_URL; ?>"></a></h1>
			<ul>
                <?php if($is_member && $member["mb_level"]!=5){ ?>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice&lat=".$lat."&lng=".$lng; ?>">공지사항 및 이벤트</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php?lat=".$lat."&lng=".$lng;; ?>">기뷰 안내</a></li>
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php?lat=".$lat."&lng=".$lng;; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng;; ?>">고객만족센터</a></li>
                <?php }else if($is_member && $member["mb_level"]==5 || $type=="shop"){?>
                    <li class="order"><a href="<?php echo G5_URL."/page/shop/index.php?lat=".$lat."&lng=".$lng; ?>">홈페이지로 돌아가기</a></li>
                    <li class="premium"><a href="<?php echo G5_URL."/page/shop/premium_form.php?lat=".$lat."&lng=".$lng;; ?>">프리미엄전환</a></li>
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php?lat=".$lat."&lng=".$lng;; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng;; ?>">고객만족센터</a></li>
                <?php }else{ ?>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice&lat=".$lat."&lng=".$lng;; ?>">공지사항 및 이벤트</a></li>
                    <li class="order"><a href="<?php echo G5_URL."/page/rent/order_find.php?lat=".$lat."&lng=".$lng; ?>">비회원 주문조회</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php?lat=".$lat."&lng=".$lng;; ?>">기뷰 안내</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng; ?>">고객만족센터</a></li>
                <?php } ?>
				<!--<li><a href="<?php /*echo G5_URL."/page/intro"; */?>">회사소개</a></li>
				<li><a href="<?php /*echo G5_URL."/page/rent/list.php"; */?>">단기대여</a></li>
				<li><a href="<?php /*echo G5_URL."/page/rent/long.php"; */?>">장기대여</a></li>
				<li><a href="<?php /*echo G5_URL."/page/accident"; */?>">사고대차</a></li>
				<li><a href="<?php /*echo G5_URL."/page/mypage/reserve.php"; */?>">예약확인</a></li>
				<li>
					<a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=notice"; */?>">커뮤니티</a>
					<ul>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=notice"; */?>">공지사항</a></li>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=event"; */?>">이벤트</a></li>
						<li><a href="<?php /*echo G5_BBS_URL."/board.php?bo_table=review"; */?>">고객리뷰</a></li>
					</ul>
				</li>
				<li class="last"><a href="<?php /*echo G5_URL."/page/partner"; */?>">제휴업체</a></li>-->
			</ul>
		</div>
	</div>
	<!-- 모바일 헤더 시작 -->

	<div id="mobile_header" class="<?php echo ($wr_id || $w)?"view_mode_off":"";?>">
		<form action="" method="post" name="searchFrom">
			<input type="hidden" name="cate" value="<?php echo $ca_name;?>">
			<span class="mobile_loc_btn" onclick="<?php if($is_member){?>fnLocation();<?php }else{?>alert('로그인이 필요합니다.');fnlogin2();<?php } ?>"></span>
			<span class="mobile_loc_btn" onclick="fnLocation()"></span>
			<span class="mobile_search_btn" onclick="fnSearch();"></span>
			<div class="schbox"><input type="text" name="searchTxt" placeholder="예) 청대 닭발" class="searchTxt" value="<?php echo $searchTxt;?>"></div>
			<span class="mobile_menu_btn"><a href="javascript:"></a></span>
		</form>
		<script>
			function fnSearch(){
				document.searchFrom.submit();
			}
		</script>
		<!-- 모바일 메뉴 시작 -->
		
		<div class="mobile_menu">
			<span></span>
			<div class="menu">
				<div class="user_box <?php if($member["mb_level"]==5){echo "seller";}?>">
                    <?php if($member["mb_level"]!=5){?>
					<span class="icon"></span>
					<p><?php echo $is_member?$member['mb_name']:"다양한 서비스를 이용하시려면<br class='headbr'> 로그인이 필요합니다."; ?></p>
					<div>
						<?php if($is_member){ ?>
						<a href="<?php echo G5_BBS_URL."/register_form.php?w=u"; ?>" class="bg_darkred color_white btn">정보수정</a>
						<a href="javascript:moveLink('cart','<?php echo $wr_id;?>');" class="bg_darkred color_white btn">장바구니</a>
						<a href="<?php echo G5_BBS_URL."/logout.php?lat=".$lat."&lng=".$lng; ?>" class="btn">로그아웃</a>
						<?php }else{ ?>
						<a href="#" onclick="fnlogin();" class="bg_darkred color_white btn">로그인</a>
						<a href="#" onclick="fnregister();" class="btn ml10">회원가입</a>
						<?php } ?>
					</div>
                    <?php }else{ ?>
                        <h2>오늘도 <?php echo $member["mb_name"];?>사장님의</h2>
                        <h1>성공을 응원합니다.</h1>
						<div style="margin-top:10px;">
							<a href="<?php echo G5_BBS_URL."/logout.php?lat=".$lat."&lng=".$lng; ?>" class="btn">로그아웃</a>
						</div>
                    <?php }?>
				</div>
				<ul>
					<?php if($type!="shop" ||  $member["mb_level"] < 5){?>
					<li onclick="location.href='<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice&lat=<?php echo $lat;?>&lng=<?php echo $lng; ?>'"><div><h2>공지사항</h2><p>기뷰이용에 대한 공지사항 및 최근 정보 수록</p></div></li>
					<li <?php if(!$is_member){?>onclick="fnlogin();" <?php }else{ ?>onclick="location.href='<?php echo G5_URL; ?>/page/guide/point.php?lat=<?php echo $lat;?>&lng=<?php echo $lng; ?>'" <?php }?>><div><h2>G포인트</h2><p>사용할 수 있는 포인트 안내</p></div></li>
					<li onclick="<?php if(!$is_member){?>location.href='<?php echo G5_URL."/page/rent/order_find.php?lat=".$lat."&lng=".$lng; ?>'<?php }else{?>location.href='<?php echo G5_URL."/page/mypage/order_list.php?lat=".$lat."&lng=".$lng; ?>'<?php }?>"><div><h2>주문조회</h2><p>최근 6개월 동안 이용한 주문 내역</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/mypage/point.php'"><div><h2>기부현황</h2><p>G포인트를 사용하여 기부한 내역</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/gives.php?mm=3'"><div><h2>기부천사</h2><p>기부를 가장 많이 한 매장 및 유저</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/guide/guide.php'"><div><h2>이용방법</h2><p>기뷰를 이용하는 방법</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/inquiry/'" class="last"><div><h2>입점신청</h2><p>기뷰에서 매장을 홍보하기 위한 가입신청</p></div></li>
					<?php }else if($type=="shop" || $member["mb_level"]==5){?>
					<li onclick="location.href='<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice&lat=<?php echo $lat;?>&lng=<?php echo $lng; ?>&type=shop'"><div><h2>공지사항</h2><p>기뷰이용에 대한 공지사항 및 최근 정보 수록</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/mypage/point.php"><div><h2>기부현황</h2><p>G포인트를 사용하여 기부한 내역</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/gives.php'"><div><h2>기부천사</h2><p>기부를 가장 많이 한 매장 및 유저</p></div></li>
					<li onclick="location.href='<?php echo G5_URL?>/page/shop/index.php?type=shop'" class="last"><div><h2>관리자 화면</h2><p>사장님 전용 입니다.</p></div></li>
					<?php } ?>
					<!-- <?php if($is_member && $member["mb_level"]!=5){ ?>
                    <li class="home"><a href="<?php echo G5_URL."?lat=".$lat."&lng=".$lng; ?>">홈으로 바로가기</a></li>
                    <li class="mypage"><a href="<?php echo G5_URL."/page/mypage/?lat=".$lat."&lng=".$lng; ?>">마이페이지</a></li>
					<li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php?lat=".$lat."&lng=".$lng; ?>">내포인트</a></li>
					<li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice&lat=".$lat."&lng=".$lng; ?>">공지사항 및 이벤트</a></li>
					<li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php?lat=".$lat."&lng=".$lng; ?>">기뷰 안내</a></li>
					<li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng; ?>">고객만족센터</a></li>
                    <?php if($app){?>
                    <li class="order"><a href="<?php echo G5_URL."/page/setting"; ?>">마케팅정보 푸시 설정</a></li>
                    <?php } ?>
                    <?php }else if($is_member && $member["mb_level"]==5 || $type=="shop"){?>
                    <li class="register"><a href="<?php echo G5_BBS_URL."/logout.php?type=shop&lat=".$lat."&lng=".$lng; ?>">로그아웃</a></li>
                    <li class="home"><a href="<?php echo G5_URL."/page/shop/index.php?lat=".$lat."&lng=".$lng; ?>">홈페이지로 돌아가기</a></li>
                    <!--<li class="order"><a href="<?php /*echo G5_URL."/page/shop/setting.php"; */?>">상점 오픈 설정</a></li>
                    <li class="point"><a href="<?php echo G5_URL."/page/mypage/point.php?lat=".$lat."&lng=".$lng; ?>">내포인트</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng; ?>">고객만족센터</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=error_board&parent_id=".$parent_id."&lat=".$lat."&lng=".$lng; ?>">수정요청게시판</a></li>
                    <?php if(!$is_mobile){?>
                    <li class="info"><a href="<?php echo G5_URL."/admin/"; ?>">PC관리 페이지</a></li>
                    <?php }?>
                    <?php }else{ ?>
                    <li class="home"><a href="<?php echo G5_URL."?lat=".$lat."&lng=".$lng; ?>">홈으로 바로가기</a></li>
                    <li class="register"><a href="<?php echo G5_BBS_URL."/register_form.php?lat=".$lat."&lng=".$lng; ?>">회원가입</a></li>
                    <li class="order"><a href="<?php echo G5_URL."/page/rent/order_find.php?lat=".$lat."&lng=".$lng; ?>">비회원 주문조회</a></li>
                    <li class="notice"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=notice&lat=".$lat."&lng".$lng; ?>">공지사항 및 이벤트</a></li>
                    <li class="info"><a href="<?php echo G5_URL."/page/guide/guide.php?lat=".$lat."&lng=".$lng; ?>">기뷰 안내</a></li>
                    <li class="inquiry"><a href="<?php echo G5_URL."/bbs/board.php?bo_table=qna&lat=".$lat."&lng=".$lng; ?>">고객만족센터</a></li>
                    <?php } ?> -->
					<!--<li><a href="<?php /*echo G5_URL."/page/guide/agree_registment.php"; */?>">이용약관</a></li>
					<li <?php /*if(!$is_admin && !$partner['id'] && !$branch['id']){ */?>class="last"<?/* } */?>><a href="<?php /*echo G5_URL."/page/guide/privacy.php"; */?>">개인정보취급방침</a></li>
					<?php /*if($is_admin || $partner['id'] || $branch['id']){ */?>
					<li class="last"><a href="<?php /*echo G5_URL."/admin"; */?>">관리자</a></li>
					-->
				</ul>
                <div class="copyright" style="">
					<img src="<?php echo G5_IMG_URL?>/mobile_menu_logo.png" alt="" >
                </div>
			</div>
			<div class="login">
				<div class="close">
					<a href="#" onclick="fnLoginClose();"><img src="<?php echo G5_IMG_URL?>/menu_close_icon.png" alt="" ></a>
				</div>
				<div class="user_box <?php if($member["mb_level"]==5){echo "seller";}?>">
					<span class="icon"></span>
					<h2>LOGIN</h2>
				</div>
				<div class="form">
					<form name="flogin" action="<?php echo G5_BBS_URL ?>/login_check.php" method="post">
					<input type="hidden" name="url" value="<?php echo $login_url ?>">
					<input type="hidden" name="regid" id="regid1" value="" >
					<input type="hidden" name="lat" id="lat" value="<?php echo $lat; ?>" >
					<input type="hidden" name="lng" id="lng" value="<?php echo $lng; ?>" >
					<ul>
						<li>
							<input type="text" name="mb_id" id="mb_id" class="login_input" required>
						</li>
						<li>
							<input type="password" name="mb_password" id="mb_password" class="login_input" required>
						</li>
						<li>
							<p>다양한 서비스를 이용하시려면 로그인이 필요합니다.</p>
						</li>
						<li>
							<input type="submit" value="로그인" id="" class="login_btn bg_darkred">
						</li>
						<li>
							<table>
								<tr>
									<td><a href="<?php echo G5_BBS_URL ?>/password_lost.php?lat=<?php echo $lat; ?>&lng=<?php echo $lng; ?>" class="link">이메일 찾기</a></td>
									<td><a href="<?php echo G5_BBS_URL ?>/password_lost.php?lat=<?php echo $lat; ?>&lng=<?php echo $lng; ?>" class="link">비밀번호찾기</a></td>
									<td class="last"><a href="javascript:fnregister();" class="link">회원가입</a></td>
								</tr>
							</table>
						</li>
					</ul>
					<!-- <ul class="sns_login">
						<li>
							<input type="button" name="mb_password" id="mb_password" class="login_btn kakao" value="카카오톡 로그인">
						</li>
						<li>
							<input type="button" name="mb_password" id="mb_password" class="login_btn naver" value="네이버 로그인">
						</li>
						<li>
							<input type="button" name="mb_password" id="mb_password" class="login_btn facebook" value="페이스북 로그인">
						</li>
					</ul> -->
					<?php
                    // 소셜로그인 버튼
                    include(G5_PLUGIN_PATH.'/oauth/login.skin.inc.php');
                    ?>
					</form>
				</div>
				<div class="copyright" style="">
					<img src="<?php echo G5_IMG_URL?>/mobile_menu_logo.png" alt="" >
                </div>
			</div>
			<div class="register_agee">
				<div class="close">
					<a href="#" onclick="fnRegisterClose();"><img src="<?php echo G5_IMG_URL?>/menu_close_icon.png" alt="" ></a>
				</div>
				<div class="user_box <?php if($member["mb_level"]==5){echo "seller";}?>">
					<span class="icon2"></span>
					<h2 class="text_white">회원가입</h2>
				</div>
				<div>
					<p>기뷰 회원가입을 하시려면 약관동의가 필요합니다.</p>
				</div>
				<div class="form">
					<div class="agree_regist_list">
						<div><label for="agree_regist1" class="lb1"><a href="<?php echo G5_URL?>/page/guide/privacy.php"><u>기뷰 이용약관 동의</u></a><input type="checkbox" name="agree_regist1" id="agree_regist1" class="agree_regist1" required></label></div>
						<div><label for="agree_regist2" class="lb2"><a href="<?php echo G5_URL?>/page/guide/financeagree.php
						"><u>전자금융거래 이용약관 동의</u></a><input type="checkbox" name="agree_regist2" id="agree_regist2" class="agree_regist2" required></label></div>
						<div><label for="agree_regist3" class="lb3"><a href="<?php echo G5_URL?>/page/guide/agreement.php"><u>개인정보 수집이용 동의</u></a><input type="checkbox" name="agree_regist3" id="agree_regist3" class="agree_regist3" required ></label></div>
						<div><label for="agree_regist4" class="lb4">마케팅 정보 메일 SMS 수신동의(선택)<input type="checkbox" name="agree_regist4" id="agree_regist4" class="agree_regist4"></label></div>
						<div><label for="agree_regist5" class="lb5">만14세 이상 고객만 가입 가능합니다.<a href="<?php echo G5_URL?>/page/guide/adultinfo.php"><u>내용보기</u></a><br ><span>기뷰는 만 14세 미만 아동의 회원가입을 제한하고 있습니다.</span><input type="checkbox" name="agree_regist5" id="agree_regist5" class="agree_regist5" required></label></div>
					</div>
					<div class="agree_regist_list">
						<div class="all"><label for="checkAll" class="Alllb">전체동의<input type="checkbox" name="checkAll" id="checkAll" class="checkAll" onclick=""></label></div>
					</div>
					<div class="agree_regist_next" >
						<a href="#" onclick="fnCheck();"><h2>다음단계 <img src="<?php echo G5_IMG_URL?>/register_next_btn.png" alt="" ></h2></a>
					</div>
				</div>
				<div class="copyright" style="">
					<img src="<?php echo G5_IMG_URL?>/mobile_menu_logo_2.png" alt="" >
                </div>
			</div>
			<div class="register_form">
				<div class="close">
					<a href="#" onclick="fnRegFromClose();"><img src="<?php echo G5_IMG_URL?>/menu_close_icon.png" alt="" ></a>
				</div>
				<div class="user_box <?php if($member["mb_level"]==5){echo "seller";}?>">
					<span class="icon2"></span>
					<h2 class="text_white">회원가입</h2>
				</div>
				<div class="form">
					<form name="flogin" action="<?php echo G5_URL ?>/page/mypage/register_form_update.php" onsubmit="return fregister(this);" method="post">
						<input type="hidden" name="regid" id="regid2" value="" >
						<input type='hidden' name="mb_mailing" id="mb_mailing" value="">
						<input type="hidden" name="mb_sms" id="mb_sms" value="" >
						<input type="hidden" name="chkids" id="chkids" value="N">
						<input type="hidden" name="chkhps" id="chkhps" value="N">
						<input type="hidden" name="reg_password_chk" id="reg_password_chk" value="N">
						<h4>정보 입력</h4>
						<ul>
							<li>
								<div><input type="text" name="join_mb_id" id="join_mb_id" placeholder="아이디(이메일)입력" class="login_input grid_70"><input type="button" class="login_btn grid_30 bg_darkgray" value="중복확인" onclick="chkId()"></div>
							</li>
							<li>
								<div><input type="password" placeholder="비밀번호 입력" name="reg_password" id="reg_password" class="login_input"></div>
							</li>
							<li>
								<div><input type="password" placeholder="비밀번호 확인" name="reg_password_confirm" id="reg_password_confirm" class="login_input"></div>
							</li>
							<li>
								<p>숫자,영문조합 8~12자리 입력</p>
							</li>
							<li>
								<div><input type="text" placeholder="전화번호 입력" name="reg_hp" id="reg_hp" class="login_input grid_70" onchange="phoneFomatter(this.value,1)"><input type="button" class="login_btn grid_30 bg_darkgray" value="중복확인" onclick="chkhp()"></div>
							</li>
						</ul>
						<!-- <h4>휴대폰 인증</h4> -->
						<ul>
							<!-- <li>
								<div><input type="text" placeholder="휴대폰번호" class="login_input grid_70"><input type="button" class="login_btn grid_30 bg_gray" value="인증" onclick=""></div>
							</li>
							<li>
								<div><input type="text" placeholder="인증번호" class="login_input grid_70"><input type="button" class="login_btn grid_30 bg_darkgray" value="확인" ></div>
							</li> -->
							<li class="submit_btn">
								<div><input type="submit" class="login_btn bg_darkgray" value="가입하기"></div>
							</li>
						</ul>
						</form>
						<!-- <h4>SNS로 가입하기</h4>
						<ul class="sns_login">
							<li>
								<input type="button" name="mb_password" id="mb_password" class="login_btn kakao" value="카카오톡으로 가입하기">
							</li>
							<li>
								<input type="button" name="mb_password" id="mb_password" class="login_btn naver" value="네이버 가입하기">
							</li>
							<li>
								<input type="button" name="mb_password" id="mb_password" class="login_btn facebook" value="페이스북 가입하기">
							</li>
						</ul> -->
						<?php
						// 소셜로그인 버튼
						include(G5_PLUGIN_PATH.'/oauth/register_form.skin.inc.php');
						?>
					
				</div>
				<div class="copyright" style="">
					<img src="<?php echo G5_IMG_URL?>/mobile_menu_logo_2.png" alt="" >
                </div>
			</div>
		</div>
		<!-- 모바일 메뉴 끝 -->
	</div>
	
    <div id="mobile_header" class="<?php echo ($wr_id || $w)?"view_mode_on":"view_mode_off";?>">
        <span class="mobile_back_btn" onclick="fnBack('<?php echo $back_url?>');" ><a href="javascript:"></a></span>
		<h1 class="sub_menu_title">뒤로</h1>
        <?php if(!$view_chk && $type!="shop"){?>
        <span class="mobile_favorite_btn" ></span>
        <span class="mobile_favorite_btn_on" ></span>
        <span class="mobile_cart_btn" onclick="moveLink('cart','<?php echo $wr_id;?>');" ><a href="javascript:"></a></span>
            <div class="cart_count"><?php echo $cart_total?></div>
        <?php }else{ ?>
        <?php }?>
    </div>
	<!-- 모바일 헤더 끝 -->
</header>
<script type="text/javascript">
function fnlogin2(){
	$(".mobile_menu").fadeIn(300,function(){
		$(".mobile_menu").addClass("active");
	});
	$(".login").addClass("active");
}

function fnlogin(){
	$(".login").addClass("active");
}

function fnLoginClose(){
	$(".login").removeClass("active");
}

function fnregister(){
	$(".register_agee").addClass("active");
}

function fnRegisterClose(){
	$(".register_agee").removeClass("active");
}

function fnLocation(){
	location.href=g5_url+"/page/setting/location.php";
}

function fnCheck(){
	if($("#agree_regist1").is(":checked") == false){
		alert("기뷰 이용약관에 동의 하셔야 합니다.");
	}else if($("#agree_regist2").is(":checked") == false){
		alert("전자금융거래 이용약관에 동의 하셔야 합니다.");
	}else if($("#agree_regist3").is(":checked") == false){
		alert("개인정보 수집이용에 동의 하셔야 합니다.");
	}else if($("#agree_regist5").is(":checked") == false){
		alert("만14세 이상 고객을 확인해야 합니다.");
	}else{
		$(".register_form").addClass("active");
	}
}

function fnRegFromClose(){
	$(".register_form").removeClass("active");
}


$(function(){
	//getRegid
	try{
		var regId = window.android.getRegid();
		console.log(regId);
		$("#regid1").val(regId);
		$("#regid2").val(regId);
	}catch(err){
		var regId = undefined;
		console.log(err);
	}
	$("label[class^=lb]").each(function(e){
		$(this).click(function(){
			if($("#agree_regist"+(e+1)).is(":checked")==true){
				$(this).addClass("active");
			}else{
				$(this).removeClass("active");
			}
			if($("#agree_regist4").is("checked")==true){
				$("#mb_mailing").val("1");
				$("#mb_sms").val("1");
			}else if($("#agree_regist4").is("checked")==false){
				$("#mb_mailing").val("");
				$("#mb_sms").val("");
			}
		});
	});

	$(".checkAll").click(function(){
		if($(this).is(":checked")==true){
			$(".Alllb").addClass("active");
			$("label[class^=lb]").each(function(e){
				$("#agree_regist"+(e+1)).prop("checked",true);
				$(this).addClass("active");
				$("#mb_mailing").val("1");
				$("#mb_sms").val("1");
			});
		}else if($(this).is(":checked")==false){
			$(".Alllb").removeClass("active");
			$("label[class^=lb]").each(function(e){
				$("#agree_regist"+(e+1)).prop("checked",false);
				$(this).removeClass("active");
				$("#mb_mailing").val("");
				$("#mb_sms").val("");
			});
		}
	});
	$("#agree_regist4").change(function(){
		if($(this).is(":checked")==true){
			$("#mb_mailing").val("1");
			$("#mb_sms").val("1");
		}
	});

	$("#reg_password").change(function(){
		var pass = $("#reg_password").val();
		var passconfirm = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,16}/;
		if(!passconfirm.test(pass)){
			alert("영문 대문자,소문자로 시작하며, 숫자, 특수문자가 한개 이상 포함 되어야 하며, \r\n최소 8글자 최대 16글자가 되어야 합니다.");
		}else{
			//alert("aa");
		}
	});
	$("#reg_password_confirm").change(function(){
		var pass = $("#reg_password").val();
		var pass_confirm = $("#reg_password_confirm").val();
		if(pass != "" || pass == "undefinded"){
			if(pass_confirm != pass ){
				alert("입력한 비밀번호와 확인번호가 다릅니다.b");
				$("#reg_password_chk").val("N");
			}else{
				$("#reg_password_chk").val("Y");
			}
		}
	});

});

function phoneFomatter(num,type){
    var formatNum = '';
    
    if(num.length==11){
        if(type==0){
            formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-****-$3');
        }else{
            formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
        }
    }else if(num.length==8){
        formatNum = num.replace(/(\d{4})(\d{4})/, '$1-$2');
    }else{
        if(num.indexOf('02')==0){
            if(type==0){
                formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-****-$3');
            }else{
                formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
            }
        }else{
            if(type==0){
                formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-***-$3');
            }else{
                formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
            }
        }
    }
    $("#reg_hp").val(formatNum);
}


function chkId(){
	var mb_id = $("#join_mb_id").val();
	$.ajax({
		url:g5_url+"/page/ajax/ajax.mb_id_chk.php",
		method:"POST",
		data:{mb_id:mb_id}
	}).done(function(data){
	    console.log(data);
		if(data == "1"){
			alert("가입 가능한 아이디 입니다.");
			$("#chkids").val("Y");
		}else{
			/*if(data=="3"){
				alert("아이디는 4자 이상, 영문 숫자가 포함되어야 합니다.");
			}
			if(data=="4"){
				alert("반드시 영문으로 시작해 주시기 바랍니다.");
			}*/
			//if(data=="2"){
				alert("가입 불가능한 아이디 입니다.");
			//}
			$("#chkids").val("N");
		}
	});
}

function chkhp(){
	var mb_hp = $("#reg_hp").val();
	$.ajax({
		url:g5_url+"/page/ajax/ajax.mb_hp_chk.php",
		method:"POST",
		data:{reg_hp:mb_hp}
	}).done(function(data){
		if(data == "1"){
			alert("가입 가능한 연락처 입니다.");
			$("#chkhps").val("Y");
		}else{
			$("#chkhps").val("N");
		}
	});
}


function fregister(){
	if($("#chkids").val()=="N"){
		alert("아이디 중복체크 바랍니다");
		return false;
	}
	if($("#join_mb_id").val()=="" || $("#chkids").val() == "N"){
		alert("아이디가 입력되지 않았거나 중복체크가 필요합니다.");
		return false;
	}
	if($("#reg_password").val()==""){
		alert("패스워드가 필요합니다.");
		return false;
	}
	if($("#reg_password_confrim").val()==""){
		alert("패스워드 확인이 필요합니다.");
		return false;
	}	
	if($("#chkhps").val()=="N"){
		alert("연락처 중복체크 바랍니다");
		return false;
	}
}
</script>
<?php if($popular){?>
<!-- <div class="popular" style="position:relative;width:100%;border-bottom:1px solid #ddd;padding:10px;">
	<span>인기검색어 : </span>
	<?php for($i=0;$i<count($popular);$i++){
		echo "<span style='border:1px solid #999;padding:3px;border-radius:3px;background:#ececec;margin-right:2px;'>".$popular[$i]["pp_word"]."</span>";	
	}?>
</div> -->
<?php }?>
<!-- 헤더끝 -->
<div class="msg"></div>
<div class="modal"></div>
<div class="container <?php echo $main?"main":"sub"; ?>">
	<?php
	$http_host = $_SERVER['HTTP_HOST'];
	$request_uri = $_SERVER['REQUEST_URI'];
	$url = 'http://' . $http_host . $request_uri;
	if(strpos($url,"shop")===false && $member["mb_level"] != 5 ){?>
	<div class="width-fixed">
		<div class="top_tap">
			<ul>
				<!-- <li onclick="location.href='<?php echo G5_URL?>/index.php?mm=1'" <?php if($mm == "1" || $mm==""){?>class="active"<?php } ?>>메인</li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?mm=2'" <?php if($mm == "2"){?>class="active"<?php } ?>>착한맛집</li>
				<li onclick="location.href='<?php echo G5_BBS_URL?>/board.php?bo_table=givemonth&mm=3'" <?php if($mm == "3"){?>class="active"<?php } ?>>기부천사</li>
				<li onclick="location.href='<?php echo G5_BBS_URL?>/board.php?bo_table=event&mm=4'"  <?php if($mm == "4"){?>class="active"<?php } ?>>이벤트</li>
				<li onclick="location.href='<?php echo G5_BBS_URL?>/board.php?bo_table=givemall&mm=5'"  <?php if($mm == "5"){?>class="active"<?php } ?>>기뷰몰</li> -->
				<li onclick="location.href='<?php echo G5_URL?>/page/deli_list.php?mm=1'" <?php if($mm == "1" && !$bo_table){?>class="active"<?php } ?>>착한배달</li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?mm=2'" <?php if($mm == "2"){?>class="active"<?php } ?>>즉시할인</li>
				<li onclick="location.href='<?php echo G5_URL?>/page/gives.php?mm=3'" <?php if($mm == "3"){?>class="active"<?php } ?>>기부천사</li>
				<li onclick="location.href='<?php echo G5_BBS_URL?>/board.php?bo_table=event&mm=4'"  <?php if($mm == "4" || $bo_table=="event"){?>class="active"<?php } ?>>이벤트</li>
				<li onclick="fnMall();">기뷰몰</li>
				<!-- <li onclick="location.href='<?php echo G5_BBS_URL?>/board.php?bo_table=givemall&mm=5'"  <?php if($mm == "5" || $bo_table=="givemall"){?>class="active"<?php } ?>>기뷰몰</li> -->
			</ul>
		</div>
        <div style="clear: both;"></div>
	</div>
	<?php }?>
<script>
function fnMall(){
	$.post(g5_url+"/page/modal/mall_alert.php",function(data){
		$(".modal").html(data);
		modal_active();
	});
}
</script>
<?php 
$noti_row = sql_fetch("select * from `g5_write_notice` order by wr_datetime desc limit 0, 1");
?>
<div class="width-fixed">
	<div class="notice_alarm">
		<ul>
			<li onclick="location.href=g5_bbs_url+'/board.php?wr_id=<?php echo $noti_row["wr_id"];?>&bo_table=notice'"><img src="<?php echo G5_IMG_URL?>/ic_alarm.svg" alt="" class="img1"><?php echo cut_str($noti_row["wr_subject"],22,"...");?><img src="<?php echo G5_IMG_URL?>/noti_alarm_arrow.png" alt="" class="img2"></li>
		</ul>
	</div>
</div>