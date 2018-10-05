<meta http-equiv="refresh" content="0; http://flugtest.dothome.co.kr/page/rent/list.php" />
<?php
/*
define('_INDEX_', true);
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/index_old.php');
    return;
}
$main=true;
include_once('./_head.php');
$best_tel=sql_fetch("select * from `best_tel`");
$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now'";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
	$event_list[]=$event_data;
}
$notice_sql="SELECT * FROM  `g5_write_notice` order by wr_id desc limit 0,5";
$notice_query=sql_query($notice_sql);
while($notice_data=sql_fetch_array($notice_query)){
	$notice_list[]=$notice_data;
}
$best_short=sql_fetch("select * from `best_short`");
?>
<script type="text/javascript">
	$(function(){
		$(".beta a").click(function(){
			$(".beta").fadeOut(500);
		});
	})
</script>
<!-- <div class="beta">
	<div>
		<div>
			<img src="<?php echo G5_IMG_URL."/beta_img.png"; ?>" alt="image" />
			<a href="javascript:">확인</a>
		</div>
	</div>
</div> -->

<div class="width-fixed">
	<?php
	if(defined('_INDEX_')) { // index에서만 실행
		include_once(G5_BBS_PATH.'/newwin.inc.php'); // 팝업레이어
	}
	?>
	<div id="main_event" class="owl-carousel">
	<?php
		for($i=0;$i<count($event_list);$i++){
			$thumb = get_list_thumbnail("event", $event_list[$i]['wr_id'], 1100, 464);
			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
			}
			if($img_content){
	?>
		<div class="item"><a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$event_list[$i]['wr_id']; ?>"><?php echo $img_content; ?></a></div>
	<?php
			}
		}
		if(count($event_list)<=0){
	?>
		<div class="item"><a href="<?php echo G5_URL; ?>"><img src="<?php echo G5_IMG_URL."/main_slide.jpg"; ?>" alt="image" /></a></div>
	<?php
		}
	?>
	</div>
	<div class="wrap">
	<?php
		if(count($notice_list)>0){
	?>
		<div id="main_notice">
			<h3>공지::</h3>
			<ul>
			<?php
			for($i=0;$i<count($notice_list);$i++){
			?>
				<li><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice&wr_id=".$notice_list[$i]['wr_id']; ?>"><span><?php echo date("Y.m.d",strtotime($notice_list[$i]['wr_datetime'])); ?></span><?php echo $notice_list[$i]['wr_subject']; ?></a></li>
			<?php } ?>
			</ul>
			<span><a href="<?php echo G5_BBS_URL."/board.php?bo_table=notice"; ?>"></a></span>
		</div>
	<?php
	}
	$now=date("Y-m-d h:i:s");
	$menu1_event=sql_fetch("SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3`='단기대여' and `wr_6`<>''");
	$menu2_event=sql_fetch("SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3`='장기대여' and `wr_6`<>''");
	$menu3_event=sql_fetch("SELECT * FROM  `g5_write_event` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3`='사고대차' and `wr_6`<>''");
	?>
		<div id="main_banner">
			<div class="menu">
				<div>
					<div class="menu1"><div><a href="<?php echo G5_URL."/page/rent/list.php"; ?>"><?php if($menu1_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
					<div class="menu2"><div><a href="<?php echo G5_URL."/page/rent/long.php"; ?>"><?php if($menu2_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
					<div class="menu3"><div><a href="<?php echo G5_URL."/page/accident"; ?>"><?php if($menu3_event['wr_id']){ ?><i class="event"></i><?php } ?><span class="icon"></span><span class="txt"></span></a></div></div>
					<div class="menu4"><div><a href="<?php echo G5_URL."/page/mypage/reserve.php"; ?>"><span class="icon"></span><span class="txt"></span></a></div></div>
				</div>
			</div>
			<div class="call">
				<a href="tel:<?php echo $best_tel['tel']; ?>">
					<h3>빠르고 간편한 <span>전화예약</span></h3>
					<h1><?php echo dot_hp_number($best_tel['tel']); ?></h1>
					<h4><?php if(!$best_tel['all']){ ?>영업시간&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("A h:i",strtotime($best_tel['time1'])); ?>&nbsp;&nbsp;~&nbsp;&nbsp;<?php echo date("A h:i",strtotime($best_tel['time2'])); ?><?php }else{ ?>연중무휴 24시간 영업<?php } ?></h4>
					<i></i>
				</a>
			</div>
		</div>
		<div id="main_way">
			<a href="<?php echo G5_URL."/page/guide/direction.php"; ?>">
				<h3>베스트 렌트카 오프라인 지점</h3>
				<h1>오시는 길 안내</h1>
				<i></i>
			</a>
		</div>
		<div id="main_tab">
			<div class="menu">
				<ul>
					<li rel="small" class="active">소형</li>
					<li rel="middle">중형</li>
					<li rel="big">대형</li>
					<li rel="van">승합</li>
					<li rel="suvrv">SUV/RV</li>
					<li rel="imported">수입</li>
				</ul>
			</div>
			<div id="small" class="tab_content active">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo number_format($best_short['s1']); ?> ~</td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo number_format($best_short['s3']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo number_format($best_short['s5']); ?> ~</td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo number_format($best_short['s7']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo number_format($best_short['sh']); ?> ~</td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
			<div id="middle" class="tab_content">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo number_format($best_short['m1']); ?> ~</td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo number_format($best_short['m3']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo number_format($best_short['m5']); ?> ~</td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo number_format($best_short['m7']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo number_format($best_short['mh']); ?> ~</td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
			<div id="big" class="tab_content">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo number_format($best_short['b1']); ?> ~</td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo number_format($best_short['b3']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo number_format($best_short['b5']); ?> ~</td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo number_format($best_short['b7']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo number_format($best_short['bh']); ?> ~</td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
			<div id="van" class="tab_content">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo number_format($best_short['v1']); ?> ~</td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo number_format($best_short['v3']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo number_format($best_short['v5']); ?> ~</td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo number_format($best_short['v7']); ?> ~</td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo number_format($best_short['vh']); ?> ~</td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
			<div id="imported" class="tab_content">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo $best_short['i1']?number_format($best_short['i1'])." ~":"전화상담"; ?></td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo $best_short['i3']?number_format($best_short['i3'])." ~":"전화상담"; ?></td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo $best_short['i5']?number_format($best_short['i5'])." ~":"전화상담"; ?></td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo $best_short['i7']?number_format($best_short['i7'])." ~":"전화상담"; ?></td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo $best_short['ih']?number_format($best_short['ih'])." ~":"전화상담"; ?></td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
			<div id="suvrv" class="tab_content">
				<div class="table04">
					<table>
						<tr class="bg">
							<th>1 ~ 2일</th>
							<td><?php echo $best_short['r1']?number_format($best_short['r1'])." ~":"전화상담"; ?></td>
						</tr>
						<tr>
							<th>3 ~ 4일</th>
							<td><?php echo $best_short['r3']?number_format($best_short['r3'])." ~":"전화상담"; ?></td>
						</tr>
						<tr class="bg">
							<th>5 ~ 6일</th>
							<td><?php echo $best_short['r5']?number_format($best_short['r5'])." ~":"전화상담"; ?></td>
						</tr>
						<tr>
							<th>7일 ~</th>
							<td><?php echo $best_short['r7']?number_format($best_short['r7'])." ~":"전화상담"; ?></td>
						</tr>
						<tr class="bg">
							<th>시간당</th>
							<td><?php echo $best_short['rh']?number_format($best_short['rh'])." ~":"전화상담"; ?></td>
						</tr>
						<tr >
							<th colspan="2"><span style="font-size:12px">시간당 요금은 하루 이상 대여시 추가되는 금액입니다.</span></th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
		$partner_sql="SELECT * FROM  `best_partner` WHERE  `show` =  '1'";
		$partner_query=sql_query($partner_sql);
		while($partner_data=sql_fetch_array($partner_query)){
			$partner_list[]=$partner_data;
		}
		if(count($partner_list)>0){
	?>
	<div id="main_partner" class="owl-carousel">
	<?php
		for($i=0;$i<count($partner_list);$i++){
	?>
		<div class="item"><a href="<?php echo G5_URL."/page/partner?id=".$partner_list[$i]['id']; ?>"><img src="<?php echo G5_DATA_URL."/partner/".$partner_list[$i]['banner']; ?>" alt="<?php echo $partner_list[$i]['name']; ?>" /></a></div>
	<?php
		}
	?>
	</div>
	<?php } ?>
	
</div>
<script type="text/javascript">
	$(function () {
		$(".tab_content").hide();
		$(".tab_content:first").show();
		$("#main_tab > div li").click(function () {
			$("#main_tab > div li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		});
	});
	$(function(){
		var owl1=$("#main_event");
		var owl2=$("#main_partner");
		owl1.owlCarousel({
			animateOut: 'fadeOut',
			autoplay:true,
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			smartSpeed:2000,
			loop:true,
			dots:true,
			items:1
		});
		owl2.owlCarousel({
			autoplay:true,
			navText: [ '', '' ],
			autoplayTimeout:5000,
			autoplaySpeed:2000,
			smartSpeed:2000,
			loop:true,
			dots:false,
			nav:true,
			items:1
		});
		setTimeout(function(){main_notice_slide()},5000);
		var n=0;
		var main_notice_len=$("#main_notice li").length;
		/* 메인배너 슬라이드
		function main_notice_slide(act,roop){
			n++;
			if(n>=main_notice_len){
				n=0;
			}
			go=n * -46;
			$("#main_notice ul").animate(
				{'margin-top': go+'px'}
			);
			setTimeout(function(){main_notice_slide()},5000);
		}
	});
</script>
include_once('./_tail.php');*/
?>
