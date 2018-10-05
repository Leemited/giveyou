<?php
	include_once("../../common.php");
	$back_url=G5_URL."/page/rent/list.php";
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
	$view=sql_fetch("select r.*,m.name as model_name from `best_reserve` as r left join `best_model` as m on r.model=m.id where r.id='{$id}'");
	$day=floor((strtotime($view['end'])-strtotime($view['start']))/86400);
	$hour=ceil(((strtotime($view['end'])-strtotime($view['start']))%86400)/3600);
	$time=$day."일 ".$hour."시간";
	
?>
	<div class="width-fixed">
		<section id="reserve_result">
			<header>
				<h1>예약완료</h1>
			</header>
			<div>
				<div class="top">
					<i></i>
					<h3 class="reserve_result_head"></h3>
					<p>
						다음과 같은 정보로 예약이 완료되었습니다. <br />
						예약정보 확인은 <span>HOME > 예약확인</span> 메뉴에서 가능합니다.
					</p>
				</div>
				<div class="con">
					<h2><?php echo $view['model_name']; ?></h2>
					<?php if($view['type']=="short"){ ?>
					<h1><span>결제금액</span><p><?php echo number_format($view['price']); ?><span>원</span></p></h1>
					<h3><?php echo date("Y.m.d H:00",strtotime($view['start'])); ?> ~ <?php echo date("Y.m.d H:00",strtotime($view['end'])); ?> <span>(<?php echo $time; ?>)</span></h3>
					<?php } ?>
					<div class="table03">
						<table>
							<?php
							if($view['type']=="long"){
								switch($view['range']){
									case"1":$range="1개월"; break;
									case"3":$range="3개월"; break;
									case"6":$range="6개월"; break;
									case"12":$range="1년"; break;
									case"36":$range="3년"; break;
								}
							?>
							<tr>
								<th>기간</th>
								<td>
									<?php echo $range; ?>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<th>대여지점</th>
								<td><?php echo $view['rental_point']; ?></td>
							</tr>
							<tr>
								<th>반납지점</th>
								<td><?php echo $view['return_point']; ?></td>
							</tr>
							<tr>
								<th>예약자명</th>
								<td><?php echo $view['mb_name']; ?></td>
							</tr>
							<tr>
								<th>이메일</th>
								<td><?php echo $view['mb_email']; ?></td>
							</tr>
							<tr>
								<th>휴대폰</th>
								<td><?php echo $view['mb_phone']; ?></td>
							</tr>
							<tr>
								<th>기타사항</th>
								<td><?php echo $view['etc']; ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="banner">
					<div class="left">
						<i></i>
						<p><?php echo dot_hp_number($best_tel['tel']); ?></p>
					</div>
					<p>예약된 차량에 대한 조회 후 <br />입력하신 연락처로 빠른 연락 드리겠습니다.</p>
				</div>
				<div class="btn_group">
					<a href="<?php echo G5_URL."/page/mypage/reserve.php"; ?>" class="btn">확인</a>
				</div>
			</div>
		</section>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>