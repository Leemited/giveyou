<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
	if($best_tel['all']){
		$tel=$best_tel['accident'];
	}else if(strtotime($best_tel['time1']) < strtotime(date("H:i")) && strtotime($best_tel['time2']) > strtotime(date("H:i"))){
		$tel=$best_tel['accident'];
	}else{
		$tel=$best_tel['accident2'];
	}
?>
	<style type="text/css">
		#intro_page{position:relative;height:586px;width:100%;}
		#intro_page .img{position:absolute;overflow:hidden;width:44.7%;height:100%;background-image:url("../../img/intro_img.png");background-position:-210px 0;top:0;left:0;}
		#intro_page .img img{display:none;}
		#intro_page .txt{width:100%;height:100%;background-image:url("../../img/intro_bg.png");background-position:right bottom;padding-left:44.7%;box-sizing:border-box;}
		#intro_page .txt h1{padding:50px 0;}
		#intro_page .txt h1 span{display:block;width:521px;height:175px;background-image:url("../../img/intro_h1.png");background-position:top left;margin-left:46px;}
		#intro_page .txt p{font-size:16px;color:#fff;letter-spacing:-0.05em;line-height:26px;position:absolute;bottom:86px;margin-left:63px;}
		@media all and (max-width: 1120px){
			#intro_page{margin-top:-20px;}
			#intro_page .txt h1{padding:30px 0;}
			#intro_page .txt h1 span{width:440px;height:150px;background-size:100% 100%;margin:0 auto;}
			#intro_page .txt p{width:415px;position:relative;bottom:-50px;margin:0 auto;}
		}
		@media all and (max-width: 900px){
			#intro_page{height:auto;}
			#intro_page .img{position:relative;width:100%;background:none;}
			#intro_page .img img{display:block;}
			#intro_page .txt{padding:30px 20px 50px 20px;height:auto;}
			#intro_page .txt h1{padding:0;}
			#intro_page .txt h1 span{margin:0;}
			#intro_page .txt p{position:static;margin-top:10px;width:100%;padding:0 15px;box-sizing:border-box;}
		}
		@media all and (max-width: 768px){
			#intro_page .txt{padding:20px 15px 30px 15px;}
			#intro_page .txt h1 span{width:350px;height:119px;}
			#intro_page .txt p{padding:0 12px;font-size:14px;line-height:18px;}
		}
		@media all and (max-width: 480px){
			#intro_page .txt{padding:20px 10px 30px 10px;}
			#intro_page .txt h1 span{width:250px;height:85px;}
			#intro_page .txt p{padding:0 10px;font-size:13px;line-height:14px;}
		}
	</style>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>회사소개</h1>
				<h3 class="intro_head"></h3>
				<p>베스트렌터카에 대해 알려드립니다.</p>
			</header>
			<div class="section01_content">
				<div id="intro_page">
					<div class="img"><img src="<?php echo G5_IMG_URL."/intro_img.png"; ?>" alt="베스트렌트카" /></div>
					<div class="txt">
						<h1><span></span></h1>
						<p>
							안녕하십니까?<br />
							저희 베스트 렌트카 홈페이지를 방문해주셔서 감사합니다.<br />
							베스트렌트카는 24시간 예약 서비스와 사고대차 서비스를 실시하고 있습니다.<br />
							또한, 청주 최다 차량을 보유하고 있으며 고객이 가장 저렴하고 편안하게 <br />
							사용하실수 있도록 최선을 다하고있습니다.<br />
							고객의 입장을 최우선으로 저렴하고 안전한 서비스 제공에 최선을 다하겠습니다.
						</p>
					</div>
				</div>
			</div>
		</section>
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