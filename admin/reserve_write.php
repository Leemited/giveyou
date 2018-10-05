<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `best_reserve` where id='".$id."'");
		$write['start_arr']=explode(" ",$write['start']);
		$write['start_date']=$write['start_arr'][0];
		$write['start_arr']=explode(":",$write['start_arr'][1]);
		$write['start_hour']=$write['start_arr'][0];
		$write['start_min']=$write['start_arr'][1];
		$write['end_arr']=explode(" ",$write['end']);
		$write['end_date']=$write['end_arr'][0];
		$write['end_arr']=explode(":",$write['end_arr'][1]);
		$write['end_hour']=$write['end_arr'][0];
		$write['end_min']=$write['end_arr'][1];
	}
	$where="1";
	if(!$is_admin){
		$where="`mb_id`='{$member['mb_id']}'";
	}
	$model_query=sql_query("select * from `best_model`");
	$branch_query=sql_query("select * from `best_branch` where {$where}");
	while($model_data=sql_fetch_array($model_query)){
		$model_list[]=$model_data;
	}
	while($branch_data=sql_fetch_array($branch_query)){
		$branch_list[]=$branch_data;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>예약관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/reserve_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<colgroup>
							<col width="160px" />
							<col width="*" />
						</colgroup>
						<tr>
							<th>상태</th>
							<td>
								<select name="status" id="status" class="adm-input01 grid_100" required>
									<option value="">선택</option>
									<option value="-1" <?php echo isset($write['status'])&&$write['status']=="-1"?"selected":""; ?>>예약취소</option>
									<option value="0" <?php echo isset($write['status'])&&$write['status']=="0"?"selected":""; ?>>예약대기</option>
									<option value="1" <?php echo isset($write['status'])&&$write['status']=="1"?"selected":""; ?>>예약중</option>
									<option value="2" <?php echo isset($write['status'])&&$write['status']=="2"?"selected":""; ?>>예약완료</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>타입</th>
							<td>
								<select name="type" id="type" class="adm-input01 grid_100" required>
									<option value="">선택</option>
									<option value="short" <?php echo $write['type']&&$write['type']=="short"?"selected":""; ?>>단기대여</option>
									<option value="long" <?php echo $write['type']&&$write['type']=="long"?"selected":""; ?>>장기대여</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>차종</th>
							<td>
								<select name="model" id="model" class="adm-input01 grid_100" required>
									<option value="">선택</option>
									<?php
										for($i=0;$i<count($model_list);$i++){
									?>
										<option value="<?php echo $model_list[$i]['id']; ?>" <?php echo $write['model']==$model_list[$i]['id']?"selected":""; ?>><?php echo $model_list[$i]['name']; ?></option>
									<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>대여일시</th>
							<td>
								<input type="text" name="start_date" id="start_date" class="adm-input01" value="<?php echo $write['start_date']; ?>" readonly />
								<select name="start_hour" id="start_hour" class="adm-input01">
								<?php
									for($i=0;$i<24;$i++){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $write['start_hour']==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<span>:</span>
								<select name="start_min" id="start_min" class="adm-input01">
								<?php
									for($i=0;$i<60;$i+=5){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $write['start_min']==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th>반납일시</th>
							<td>
								<input type="text" name="end_date" id="end_date" class="adm-input01"  value="<?php echo $write['end_date']; ?>" readonly />
								<select name="end_hour" id="end_hour" class="adm-input01">
								<?php
									for($i=0;$i<24;$i++){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $write['end_hour']==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<span>:</span>
								<select name="end_min" id="end_min" class="adm-input01">
								<?php
									for($i=0;$i<60;$i+=5){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $write['end_min']==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th>기간</th>
							<td>
								<select name="range" id="range" class="adm-input01 grid_100">
									<option value="">선택</option>
									<option value="1" <?php echo $write['range']&&$write['range']=="1"?"selected":""; ?>>~1개월</option>
									<option value="3" <?php echo $write['range']&&$write['range']=="3"?"selected":""; ?>>~3개월</option>
									<option value="6" <?php echo $write['range']&&$write['range']=="6"?"selected":""; ?>>~6개월</option>
									<option value="12" <?php echo $write['range']&&$write['range']=="12"?"selected":""; ?>>~1년</option>
									<option value="36" <?php echo $write['range']&&$write['range']=="36"?"selected":""; ?>>~3년</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>대여지점</th>
							<td>
								<select name="rental_point" id="rental_point" class="adm-input01 grid_100" required onchange="rental_point_change(this.value);">
									<option value="">선택</option>
									<?php
										for($i=0;$i<count($branch_list);$i++){
									?>
										<option value="<?php echo $branch_list[$i]['name']; ?>" <?php echo $write['rental_point']==$branch_list[$i]['name']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
									<?php
										}
									?>
									<?php if(!$id||strpos($write['rental_point'], "픽업 서비스") !== false || $is_admin){ ?><option value="픽업 서비스" <?php echo strpos($write['rental_point'], "픽업 서비스") !== false?"selected":""; ?>>픽업 서비스</option><?php } ?>
								</select>
								<input type="text" name="pick" id="pick"  class="adm-input01 grid_100" style="margin-top:5px;<?php echo strpos($write['rental_point'], "픽업 서비스") !== false?"":"display:none;"; ?>" value="<?php echo str_replace("픽업 서비스","",$write['rental_point']); ?>" />
							</td>
						</tr>
						<tr>
							<th>반납지점</th>
							<td>
								<select name="return_point" id="return_point" class="adm-input01 grid_100" required>
									<option value="">선택</option>
									<?php
										for($i=0;$i<count($branch_list);$i++){
									?>
										<option value="<?php echo $branch_list[$i]['name']; ?>" <?php echo $write['return_point']==$branch_list[$i]['name']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
									<?php
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<th>예약자명</th>
							<td>
								<input type="text" name="mb_name" id="mb_name" class="adm-input01 grid_100" value="<?php echo $write['mb_name']; ?>" required />
							</td>
						</tr>
						<tr>
							<th>아이디</th>
							<td>
								<input type="text" name="mb_id" id="mb_id" class="adm-input01 grid_100" value="<?php echo $write['mb_id']; ?>" />
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td>
								<input type="text" name="mb_email" id="mb_email" class="adm-input01 grid_100" value="<?php echo $write['mb_email']; ?>" />
							</td>
						</tr>
						<tr>
							<th>휴대폰</th>
							<td>
								<input type="tel" name="mb_phone" id="mb_phone" class="adm-input01 grid_100" value="<?php echo $write['mb_phone']; ?>" required />
							</td>
						</tr>
						<tr>
							<th>기타</th>
							<td>
								<textarea name="etc" id="etc" cols="30" rows="10" class="adm-input01 grid_100" style="height:150px"><?php echo strip_tags($write['etc']); ?></textarea>
							</td>
						</tr>
						<tr>
							<th>가격</th>
							<td>
								<input type="text" name="price" id="price" class="adm-input01 grid_100 text-right" value="<?php echo $write['price']; ?>" onkeyup="return number_only(this);" required />
							</td>
						</tr>
					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01" />
				</div>
			</form>
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
