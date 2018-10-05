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
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>사고대차</h1>
				<h3 class="accident_head"></h3>
				<p>친절과 정성을 다해 고객을 모시겠습니다.</p>
			</header>
			<div class="section01_content">
				<div id="accident">
					<div class="join">
						<div>
							<div>
								<i></i>
								<span class="txt"></span>
								<a href="<?php echo G5_BBS_URL."/register_form.php"; ?>" class="btn">회원가입</a>
							</div>
						</div>
					</div>
					<div class="call">
						<div>
							<div>
								<i></i>
								<span class="txt"></span>
								<a href="tel:<?php echo $tel; ?>" class="btn">전화연결</a>
								<p>
									<span>TEL</span><?php echo dot_hp_number($best_tel['accident']); ?>&nbsp;&nbsp;&nbsp;<span>영업시간 외 연결</span><?php echo dot_hp_number($best_tel['accident2']); ?><br />
									<span>영업시간</span><?php if(!$best_tel['all']){ echo date("A h:i",strtotime($best_tel['time1'])); ?> ~ <?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?>
								</p>
							</div>
						</div>
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
	<script type="text/javascript">
		$(function () {
			$(".tab_content").hide();
			$(".tab_content:first").show();

			$(".tab > div li").click(function () {
				$(".tab > div li").removeClass("active");
				$(this).addClass("active");
				$(".tab_content").hide()
				var activeTab = $(this).attr("rel");
				$("#" + activeTab).fadeIn()
			});
		});
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>