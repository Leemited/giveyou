<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$view=sql_fetch("select *,r.mb_id as mb_id, m.name as model,r.year as ryear,r.type as type,m.id as model_id,c.number as car,b.name as company,r.id as id,r.car as car_id from `best_reserve` as r left join `best_model` as m on r.model=m.id left join `best_car` as c on r.car=c.id left join `best_branch` as b on b.id=c.branch where r.id='".$id."'");
		switch($view['status']){
			case "-1":$status="예약취소";break;
			case "0":$status="예약대기";break;
			case "1":$status="예약중";break;
			case "2":$status="예약완료";break;
			default:$status="예약대기";break;
		}
		switch($view['type']){
			case "long":$type="장기대여";break;
			case "short":$type="단기대여";break;
			default:$type="단기대여";break;
		}
		switch($view['range']){
			case "1":$range="~1개월";break;
			case "3":$range="~3개월";break;
			case "6":$range="~6개월";break;
			case "12":$range="~1년";break;
			case "36":$range="~3년";break;
			default:$range=floor((strtotime($view['end'])-strtotime($view['start']))/86400)."일".ceil(((strtotime($view['end'])-strtotime($view['start']))%86400)/3600)."시간";break;
		}
	}
	if(!$is_admin){
		$where.="and `branch`='{$branch['id']}'";
	}
	$car_sql="select *,b.name as company,c.id as id from `best_car` as c inner join `best_branch` as b on c.branch=b.id where `model`='{$view['model_id']}' and c.id not in (select car from `best_reserve` where ((`end`>='{$view['start']}' and `start`<='{$view['start']}') or (`end`>='{$view['end']}' and `start`<='{$view['end']}')) and `status`<>'-1') and `c_type`='{$type}' {$where}";
	$car_query=sql_query($car_sql);
	while($car_data=sql_fetch_array($car_query)){
		$car_list[]=$car_data;
	}
?>
<style type="text/css">
	.grid_90{width:90% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_10{width:10% !important;display:inline-block;float:left;box-sizing:border-box;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>예약관리</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table02">
				<table>
					<colgroup>
						<col width="160px" />
						<col width="*" />
					</colgroup>
					<tr>
						<th>상태</th>
						<td>
						<?php echo $status; ?>
						<?php
						if($view['status']<2 && $view['status']!=-1){
						?>
						<a href="<?php echo G5_URL."/admin/reserve_status.php?s=-1&id=".$id; ?>" style="background:#aaa;width:70px;text-align:center;height:25px;line-height:25px;color:#fff;display:inline-block">예약취소</a>
						<?php } ?>
						<?php
						if($view['status']==1){
						?>
						<a href="<?php echo G5_URL."/admin/reserve_status.php?s=2&id=".$id; ?>" style="background:#003;width:70px;text-align:center;height:25px;line-height:25px;color:#fff;display:inline-block">예약완료</a>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<th>타입</th>
						<td><?php echo $type; ?></td>
					</tr>
					<tr>
						<th>차종</th>
						<td>
							<?php echo $view['model']; ?>
						</td>
					</tr>
					<?php if($view['start']!="0000-00-00 00:00:00"){ ?>
					<tr>
						<th>대여일시</th>
						<td>
							<?php echo date("Y-m-d H:i",strtotime($view['start'])); ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($view['end']!="0000-00-00 00:00:00"){ ?>
					<tr>
						<th>반납일시</th>
						<td>
							<?php echo date("Y-m-d H:i",strtotime($view['end'])); ?>
						</td>
					</tr>
					<?php } ?>
					<?php if($range){ ?>
					<tr>
						<th>기간</th>
						<td>
							<?php echo $range; ?>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th>대여지점</th>
						<td>
							<?php echo $view['rental_point']; ?> 
						</td>
					</tr>
					<tr>
						<th>반납지점</th>
						<td>
							<?php echo $view['return_point']; ?>
						</td>
					</tr>
					<tr>
						<th>예약자명</th>
						<td>
							<?php echo $view['mb_name']; ?>
						</td>
					</tr>
					<tr>
						<th>아이디</th>
						<td>
							<?php echo $view['mb_id']; ?>
						</td>
					</tr>
					<tr>
						<th>태어난 년도</th>
						<td>
							<?php echo $view['ryear']; ?>
						</td>
					</tr>
					<tr>
						<th>이메일</th>
						<td>
							<?php echo $view['mb_email']; ?>
						</td>
					</tr>
					<tr>
						<th>휴대폰</th>
						<td>
							<?php echo $view['mb_phone']; ?>
						</td>
					</tr>
					<tr>
						<th>차량</th>
						<td>
							<form action="<?php echo G5_URL."/admin/reserve_car.php"; ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
								<input type="hidden" name="page" value="<?php echo $page; ?>" />
								<select name="car" id="car" class="adm-input01 grid_90" required>
									<option value="">선택</option>
									<?php if($view['car_id']){ ?>
									<option value="<?php echo $view['car_id']; ?>" selected><?php echo $view['car']; ?>(<?php echo $view['company']; ?>)</option>
									<?php } ?>
									<?php
										for($i=0;$i<count($car_list);$i++){
									?>
									<option value="<?php echo $car_list[$i]['id']; ?>" <?php echo $car_list[$i]['id']==$view['car_id']?"selected":""; ?>><?php echo $car_list[$i]['number']; ?>(<?php echo $car_list[$i]['company']; ?>/<?php echo $car_list[$i]['c_type']; ?>)</option>
									<?php
										}
									?>
								</select>
								<input type="submit" value="확인" class="btn grid_10" style="line-height:30px;height:30px;background:#666;color:#fff;border:0;" />
							</form>
						</td>
					</tr>
					<tr>
						<th>기타</th>
						<td>
							<?php echo $view['etc']; ?>
						</td>
					</tr>
					<tr>
						<th>가격</th>
						<td>
							<?php echo number_format($view['price']); ?>
						</td>
					</tr>
				</table>
			</div>
			<div class="text-center mt20">
				<a href="<?php echo G5_URL."/admin/reserve_list.php"; ?>" class="btn adm-btn01" style="background:#aaa;">취소</a>
				<a href="<?php echo G5_URL."/admin/reserve_write.php?id=".$id."&page=".$page."&b=".$b."&m=".$m."&s=".$s; ?>" class="btn adm-btn01">수정</a>
			</div>
		</article>
	</section>
</div>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
	$(function(){
		$( "#start_date" ).datepicker({
			dateFormat:"yy-mm-dd",
			minDate: 0,
			onSelect: function( selectedDate ) {
				$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
				/*var dateObject=new Date(selectedDate);
				dateObject.setDate(dateObject.getDate()+30);                                 
				$('#end_date').datepicker("option", "maxDate",dateObject);*/
			}
		});
		$( "#end_date" ).datepicker({
			dateFormat:"yy-mm-dd",
			minDate: 0,
			onSelect: function( selectedDate ) {
				$( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
				var dateObject=new Date(selectedDate);
				/*dateObject.setDate(dateObject.getDate()-30);   
				var now=new Date();
				var todayAtMidn = new Date(now.getFullYear(), now.getMonth(), now.getDate());
				if(dateObject.getTime()>todayAtMidn.getTime()){
					$('#start_date').datepicker("option", "minDate",dateObject);
				}*/
			}
		});
	});
	function rental_point_change(v){
		if(v=="픽업 서비스"){
			$("#pick").show();
		}
	}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
