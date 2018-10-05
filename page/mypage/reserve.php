<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
	$mb_name=$_POST['mb_name'];
	$mb_phone=$_POST['mb_phone'];
	$where="";
	if($is_member){
		$where="r.mb_id='{$member['mb_id']}'";
	}else{
		if(!$mb_name||!$mb_phone){
			goto_url(G5_URL."/page/mypage/reserve_nomember.php");
		}else{
			$where="r.mb_name='{$mb_name}' and r.mb_phone='{$mb_phone}'";
		}
	}
	$lim=date("Y-m-d H:i:s",strtotime("-7 days"));
	$where.="and ((r.status<>'2' and r.status<>'-1') or (r.status='2'and r.end>'{$lim}') or (r.datetime>'{$lim}' and r.status='-1'))";
	$query=sql_query("select r.*,m.name as model_name,r.datetime as datetime from `best_reserve` as r left join `best_model` as m on r.model=m.id where {$where} order by id desc");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
?>
	<style type="text/css">
		.reserve_list h1 span.cancle{background:#ce2027;}
		.reserve_list h1 span.ing{background:#F2D43F;}
		.reserve_list h1 span.end{background:#61C155;}
	</style>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>예약확인</h1>
				<h3 class="reserve_list_head"></h3>
				<p>고객님의 예약정보에 대해 상세히 알려드립니다.</p>
			</header>
			<div class="section01_content wrap">
				<div class="reserve_list">
					<ul>
					<?php
					for($i=0;$i<count($list);$i++){
						switch($list[$i]['status']){
							case"-1":$status="<span class='cancle'>예약취소</span>";break;
							case"0":$status="<span class='waiting'>예약대기</span>";break;
							case"1":$status="<span class='ing'>예약중</span>";break;
							case"2":$status="<span class='end'>예약완료</span>";break;
							default:$status="<span class='waiting'>예약대기</span>";break;
						}
					?>
						<li>
							<div onclick="reserve_view('<?php echo $list[$i]['id']; ?>');">
								<h1><?php echo $list[$i]['model_name']; ?><?php echo $status; ?></h1>
								<div>
									<p>예약일시 : <?php echo date("Y.m.d",strtotime($list[$i]['datetime'])); ?></p>
									<?php if($list[$i]['price']){ ?>
									<p>결제금액<span><?php echo number_format($list[$i]['price']); ?></span></p>
									<?php } ?>
									<?php if($list[$i]['type']=="short"){ ?>
									<p>대여 : <?php echo date("Y.m.d H:00",strtotime($list[$i]['start'])); ?></p>
									<p>반납 : <?php echo date("Y.m.d H:00",strtotime($list[$i]['end'])); ?></p>
									<?php
									}else{
									switch($list[$i]['range']){
										case"1":$range="1개월"; break;
										case"3":$range="3개월"; break;
										case"6":$range="6개월"; break;
										case"12":$range="1년"; break;
										case"36":$range="3년"; break;
									}
									?>
									<p>기간<span><?php echo $range; ?></span></p>
									<?php } ?>
								</div>
							</div>
							<a href="<?php echo G5_URL."/page/mypage/reserve_cancle.php?id=".$list[$i]['id']; ?>" class="btn">예약취소</a>
						</li>
					<?php } ?>
					</ul>
					<?php if(count($list)==0){ ?>
						<div class="text-center" style="padding:170px 0;font-size:14px;">예약된 차량이 없습니다.</div>
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
		function reserve_view(id){
			$.post(g5_url+"/page/modal/reserve_view.php",{id:id},function(data){
				$(".modal").html(data);
				modal_active();
			});
		}
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>