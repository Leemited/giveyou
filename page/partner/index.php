<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
	$partner_sql="SELECT * FROM  `best_partner` order by `id`";
	$partner_query=sql_query($partner_sql);
	while($partner_data=sql_fetch_array($partner_query)){
		$partner_list[]=$partner_data;
	}
?>
	
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>제휴업체</h1>
				<h3 class="partner_head"></h3>
				<p>베스트 렌터카의 제휴 업체를 소개해드립니다.</p>
			</header>
			<div class="section01_content">
				<div id="partner">
					<?php for($i=0;$i<count($partner_list);$i++){ ?> 
					<div class="<?php echo $id==$partner_list[$i]['id']?"active":""; ?>">
						<h3><?php echo $partner_list[$i]['name'] ?></h3>
						<div<?php echo $id==$partner_list[$i]['id']?" style='display:block;'":""; ?>>
							<a href="tel:<?php echo $partner_list[$i]['tel']; ?>"><img src="<?php echo G5_DATA_URL."/partner/".$partner_list[$i]['content'] ?>" alt="<?php echo $partner_list[$i]['name'] ?>" /></a>
						</div>
					</div>
					<?php } ?>
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
			$("#partner > div > h3").click(function(){
				var p=$(this).parent();
				if(p.hasClass("active")){
					$("#partner > div").removeClass("active");
					p.find("div").slideToggle();
				}else{
					$("#partner > div > div").slideUp();
					$("#partner > div").removeClass("active");
					p.addClass("active");
					p.find("div").slideToggle();
				}
				
			});
		});
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>