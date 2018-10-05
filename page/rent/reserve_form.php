<?php
	include_once("../../common.php");
	$back_url=G5_URL."/page/rent/view.php?model=".$model."&type=".$type;
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
	$best_tel=sql_fetch("select * from `best_tel`");
	$view=sql_fetch("select * from best_model where id='{$model}'");
	$query=sql_query("select * from best_model as m inner join best_car as c on m.id=c.model");
	while($data=sql_fetch_array($query)){
		$list[]=$data;
	}
	$branch_query=sql_query("select * from `best_branch`");
	while($branch_data=sql_fetch_array($branch_query)){
		$branch_list[]=$branch_data;
	}
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>예약하기</h1>
				<h3 class="reserve_head"></h3>
				<p>렌탈예약을 위한 필수정보를 입력해주세요.</p>
			</header>
			<div class="section01_content" id="reserve_form">
				<form action="<?php echo G5_URL."/page/rent/reserve_update.php"; ?>" method="post">
				<input type="hidden" name="type" value="<?php echo $type; ?>" />
				<input type="hidden" name="model" value="<?php echo $model; ?>" />
				<input type="hidden" name="price" id="price" value="0" />
				<input type="hidden" name="pick_pay" id="pick_pay" value="<?php echo $view['pick_pay']; ?>" />
				<input type="hidden" name="day_pay" id="day_pay" value="<?php echo $view['day_pay']; ?>" />
				<input type="hidden" name="day_pay3" id="day_pay3" value="<?php echo $view['day_pay3']; ?>" />
				<input type="hidden" name="day_pay5" id="day_pay5" value="<?php echo $view['day_pay5']; ?>" />
				<input type="hidden" name="day_pay7" id="day_pay7" value="<?php echo $view['day_pay7']; ?>" />
				<input type="hidden" name="hour_pay" id="hour_pay" value="<?php echo $view['hour_pay']; ?>" />
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id']; ?>" />
				<input type="hidden" name="type" value="<?php echo $type; ?>" />
				<div class="form_list01 wrap">
					<ul>
						<?php if($type=="short"){ ?>
						<li>
							<div class="grid_100">
								<label for="start_date">대여일<span>*</span></label>
								<div>
									<div class="date"><input type="text" name="start_date" id="start_date" onblur="javascript:time_change();" <?php echo $type=="short"?"required":"" ?> readonly class="input01" /></div>
									<select name="start_hour" id="start_hour" <?php echo $type=="short"?"required":"" ?>  onchange="javascript:time_change();" class="input01">
										<option value="">시간선택</option>
									<?php
										for($i=0;$i<24;$i++){
									?>
										<option value="<?php echo sprintf("%02d",$i); ?>"><?php echo sprintf("%02d",$i); ?>시</option>
									<?php
										}
									?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="end_date">반납일<span>*</span></label>
								<div>
									<div class="date"><input type="text" name="end_date" id="end_date" readonly <?php echo $type=="short"?"required":"" ?> onblur="time_change();" class="input01" /></div>
									<select name="end_hour" id="end_hour" <?php echo $type=="short"?"required":"" ?>  class="input01" onchange="time_change();">
										<option value="">시간선택</option>
									<?php
										for($i=0;$i<24;$i++){
									?>
										<option value="<?php echo sprintf("%02d",$i); ?>"><?php echo sprintf("%02d",$i); ?>시</option>
									<?php
										}
									?>
									</select>
								</div>
							</div>
						</li>
						<?php }else { ?>
						<li>
							<div class="grid_100">
								<label for="range">기간<span>*</span></label>
								<div>
									<select name="range" id="range" <?php echo $type=="short"?"required":"" ?>  class="input01">
										<option value="">선택</option>
										<option value="1">~1개월</option>
										<option value="3">~3개월</option>
										<option value="6">~6개월</option>
										<option value="12">~1년</option>
										<option value="36">~3년</option>
									</select>
								</div>
							</div>
						</li>
						<?php } ?>
						<li>
							<div class="grid_100">
								<label for="rental_point">대여지점<span>*</span></label>
								<div>
									<select name="rental_point" id="rental_point" class="input01" required onchange="time_change();">
										<option value="">선택</option>
										<?php
											for($i=0;$i<count($branch_list);$i++){
										?>
											<option value="<?php echo $branch_list[$i]['name']; ?>" <?php echo $write['rental_point']==$branch_list[$i]['name']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
										<?php
											}
										?>
										<?php if($type=="short"){ ?>
										<option value="픽업 서비스" <?php echo strpos($write['rental_point'], "픽업 서비스") !== false?"selected":""; ?>>픽업 서비스</option>
										<?php } ?>
									</select>
									<input type="text" name="pick" id="pick"  class="input01 grid_100" style="margin-top:5px;<?php echo strpos($write['rental_point'], "픽업 서비스") !== false?"":"display:none;"; ?>" value="<?php echo str_replace("픽업 서비스","",$write['rental_point']); ?>" />
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="return_point">반납지점<span>*</span></label>
								<div>
									<select name="return_point" id="return_point" class="input01" required>
										<option value="">선택</option>
										<?php
											for($i=0;$i<count($branch_list);$i++){
										?>
											<option value="<?php echo $branch_list[$i]['name']; ?>"><?php echo $branch_list[$i]['name']; ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="mb_name">예약자명<span>*</span></label>
								<div>
									<input type="text" name="mb_name" id="mb_name" class="input01" value="<?php echo $member['mb_name']; ?>" required />
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="mb_1">태어난 년도<span>*</span></label>
								<div>
									<select name="mb_1" id="mb_1" class="input01" required>
									<?php for($i=1996;$i>=1900;$i--){ ?>
										<option value="<?php echo $i; ?>" <?php echo $member['mb_1']==$i?"selected":""; ?>><?php echo $i; ?>년</option>
									<?php } ?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="mb_email">이메일</label>
								<div>
									<input type="text" name="mb_email" id="mb_email"  value="<?php echo $member['mb_email']; ?>" class="input01" />
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="mb_phone">휴대폰<span>*</span></label>
								<div>
									<input type="text" name="mb_phone" id="mb_phone" class="input01" onkeyup="return number_only(this);"  value="<?php echo $member['mb_hp']; ?>" required />
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="etc">기타사항</label>
								<div>
									<input type="text" name="etc" id="etc" class="input01 grid_100" />
								</div>
							</div>
						</li>
					</ul>
					<p style="margin-top:10px;"><span>*</span>는 필수입력사항입니다.</p>
				</div>
				<div class="reserve_price">
					<div class="wrap">
						<h4><span>렌탈자격요건</span><p><?php if($type=="long"){ echo $view['condition']?$view['condition']:"만21세.만26세 이상 / 면허취득 1년이상";}else{ echo $view['condition']?$view['condition']:"만21살 이상 / 면허 취득 1년 이상";} ?></p></h4>
					</div>
					<?php if($type=="short"){ ?>
					<div class="price_box">
						<h4 class="bdb">기간<span class="time">0일 0시간</span></h4>
						<h4>금액<span class="price">0</span></h4>
					</div>
					<?php }
					?>
					<div class="btn_group">
						<a href="tel:<?php echo $best_tel['tel']; ?>" class="btn bg_darkred color_white call">전화예약</a>
						<input type="submit" value="예약" class="btn bg_darkred color_white submit" />
						<a href="<?php echo G5_URL."/page/rent/list.php"; ?>" class="btn bg_lightgray">취소</a>
					</div>
				</div>
				</form>
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
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script type="text/javascript">
		$(function(){
			$( "#start_date" ).datepicker({
				dateFormat:"yy-mm-dd",
				minDate: 0,
				onSelect: function( selectedDate ) {
					$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
					var dateObject=new Date(selectedDate);
					dateObject.setDate(dateObject.getDate()+30);
					$('#end_date').datepicker("option", "maxDate",dateObject);
					time_change();
				}
			});
			$( "#end_date" ).datepicker({
				dateFormat:"yy-mm-dd",
				minDate: 0,
				onSelect: function( selectedDate ) {
					$( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
					var dateObject=new Date(selectedDate);
					dateObject.setDate(dateObject.getDate()-30);   
					var now=new Date();
					var todayAtMidn = new Date(now.getFullYear(), now.getMonth(), now.getDate());
					if(dateObject.getTime()>todayAtMidn.getTime()){
						$('#start_date').datepicker("option", "minDate",dateObject);
					}
					time_change();
				}
			});
		});
		function time_change(){
			var day_pay = $("#day_pay").val();  
			var day_pay1 = $("#day_pay1").val();  
			var day_pay3 = $("#day_pay3").val();  
			var day_pay5 = $("#day_pay5").val();  
			var day_pay7 = $("#day_pay7").val();  
			var hour_pay = $("#hour_pay").val();  
			var pick_pay = $("#pick_pay").val();  
			var rental_point = $("#rental_point").val();  
			var start_date_val = $("#start_date").val();  
			var start_hour = $("#start_hour").val();  
			var dpay=day_pay;
			var price_txt="";
			if(start_hour==""){
				start_hour=0;
			}
			var today = new Date();
			var start_date_arr = start_date_val.split("-"); 
			var start_date = new Date(start_date_arr[0], Number(start_date_arr[1])-1, start_date_arr[2],start_hour);  
			var end_date_val = $("#end_date").val();  
			var end_hour = $("#end_hour").val();
			if(end_hour==""){
				end_hour=0;
			}
			var end_date_arr = end_date_val.split("-");  
			var end_date = new Date(end_date_arr[0], Number(end_date_arr[1])-1, end_date_arr[2],end_hour);  
			var hour = (end_date.getTime() - start_date.getTime())/1000/60/60%24;
			var day=Math.floor((end_date.getTime() - start_date.getTime())/1000/60/60/24);
			if(end_date.getTime() - start_date.getTime()<0){
				alert("대여시간이 반납시간보다 클수 없습니다.");
				$("#start_hour").val("00");
				$('.time').html("0일 0시간");
				return false;
			}
			if((start_date.getTime()<=today.getTime() && start_hour!="") || (end_date.getTime()<=today.getTime() && end_hour!="")){
				alert("대여시간/반납시간이 현시간보다 작을수 없습니다.");
				$("#start_hour").val("");
				$("#end_hour").val("");
				$('.time').html("0일 0시간");
				return false;
			}
			if(rental_point=="픽업 서비스"){
				$("#pick").show();
				price=pick_pay+price;
			}else{
				$("#pick").hide();
			}
			if(!isNaN(hour) && !isNaN(day)){
				$('.time').html(day+"일 "+hour+"시간");
				if(hour>=12){
					day=day+1;
					hour=0;
				}
				var tday=day+1;
				if(day>=7){
					var dpay=day_pay7;
				}else if(day>=5){
					var dpay=day_pay5;
				}else if(day>=3){
					var dpay=day_pay3;
				}
				if(tday>=7){
					var tdpay=day_pay7;
				}else if(tday>=5){
					var tdpay=day_pay5;
				}else if(tday>=3){
					var tdpay=day_pay3;
				}
				var h_price=(dpay*day)+(hour_pay*hour);
				var d_price=((tdpay)*tday);
				var price=h_price;
				if(day==0 && hour){
					price=(dpay*1);
				}else if(d_price<h_price){
					if(hour!=0){
						price=d_price;
					}
				}
				if(price==0){
					price_txt="전화상담";
				}else{
					if(rental_point=="픽업 서비스"){
						price=parseInt(pick_pay)+parseInt(price);
					}
				}
				if(!isNaN(price)){
					$("#price").val(price);
				}
				if(price_txt){
					$('.price').html(price_txt);
				}else{
					$('.price').html(price.number_format(0));
				}
			}
			
		}
		Number.prototype.number_format = function(round_decimal) {
			return this.toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
		};
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>