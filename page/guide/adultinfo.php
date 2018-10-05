<?php
	include_once("../../common.php");
	$back_url = G5_URL;
	$title = "만14세 미만 회원가입 안내";
	include_once(G5_PATH."/head.etc.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	$query=sql_query("select * from best_model as m inner join best_car as c on m.id=c.model");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
?>
	<div class="width-fixed">
		<!-- <section class="section01">
			<header class="section01_header">
				<h1>개인정보취급방침</h1>
				<h3 class="privacy_head"></h3>
				<p>기뷰의 개인정보취급정책에 대해 알려드립니다.</p>
			</header>
		</section> -->
		<div class="guide_top_txt">
		</div>
		<div class="guide_common_wrap">
			<div>
				<p class="list_title"></p>
				 <ol>
					<li>기뷰는 정보통신망 이용촉진 및 정보보호 등에 관한 법률을 준수하여 만 14세 미만의 아동으로부터 개인정보 수집ㆍ이용ㆍ제공 등의 동의를 받으려면 그 법정대리인의 동의를 받아야 합니다. 만 14세 미만의 아동이 회원가입을 할 경우 회원탈퇴 또는 서비스 이용이 제한될 수  있습니다.</li>
				 </ol>
			</div>
		</div>
	



		<div class="sub_call_pop">
			<div class="top">
				<i></i>
				<div>
					<h3>빠르고 간편한</h3>
					<h2>전화예약</h2>
				</div>
			</div>
			<div class="bottom">
				<h1><?php echo dot_hp_number($best_tel['tel']); ?></h1>
				<p><?php if(!$best_tel['all']){ echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></p>
			</div>
			




		</div>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>