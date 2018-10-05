<?php
include_once('../../common.php');
$id=$_POST['id'];
$view=sql_fetch("select r.*,m.name as model_name from `best_reserve` as r left join `best_model` as m on r.model=m.id where r.id='{$id}'");
$day=floor((strtotime($view['end'])-strtotime($view['start']))/86400);
$hour=(strtotime($view['end'])-strtotime($view['start'])/3600)%24;
$time=$day."일 ".$hour."시간";
?>
<style type="text/css">
	.reserve_view{border:5px solid #ce2027;border-radius:3px;}
	.reserve_view .btn_group{text-align:center;padding:30px 0;font-size:18px;font-family:nbgr;font-weight:normal;}
	.reserve_view .btn_group .btn{background:#ce2027;color:#fff;width:104px;height:48px;padding:14px 0;box-sizing:border-box;}
	.reserve_view > div{width:100% !important;margin:0 !important;box-sizing:border-box;border:none !important;}
	#reserve_result .con h1 > span{position:relative;}
	#reserve_result .con h1 > span:after{content:"";width:1px;height:60px;background:#990000;position:absolute;right:0;top:50%;margin-top:-30px;border-right:1px solid #d64d52;}
	@media all and (max-width: 900px){
		#reserve_result .con h1 > span:after{height:30px;margin-top:-15px;}
	}
	@media all and (max-width: 768px){
		.reserve_view .btn_group{padding:20px 0;}
		.reserve_view .btn_group .btn{height:35px;width:80px;font-size:14px;padding:10px 0;}
	}
	@media all and (max-width: 480px){
		#reserve_result .con h1 > span:after{display:none;}
		.reserve_view .btn_group{padding:10px 0;}
		.reserve_view .btn_group .btn{height:30px;width:70px;font-size:13px;padding:7px 0;}
	}
</style>
<div class="reserve_view">
	<div id="reserve_result">
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
	</div>
	<div class="btn_group">
		<a href="javascript:modal_close();" class="btn">확인</a>
	</div>
</div>