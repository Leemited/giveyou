<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `best_car` where id='".$id."'");
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
			<h1>차량관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/car_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
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
							<th>소유지점</th>
							<td>
								<select name="branch" id="branch" class="adm-input01 grid_100" required>
									<option value="">선택</option>
								<?php
									for($i=0;$i<count($branch_list);$i++){
								?>
									<option value="<?php echo $branch_list[$i]['id']; ?>" <?php echo $write['branch']==$branch_list[$i]['id']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
								<?php
									}
								?>
								</select>
							</td>
						</tr>
						<tr>
							<th>구분</th>
							<td>
								<select name="c_type" id="c_type" class="adm-input01 grid_100">
									<option value="">선택</option>
									<option value="단기대여" <?php echo $write['c_type']=="단기대여"?"selected":"";?> >단기대여</option>
									<option value="장기대여" <?php echo $write['c_type']=="장기대여"?"selected":"";?>>장기대여</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>차번호</th>
							<td>
								<input type="text" name="number" id="number" required class="adm-input01 grid_100" value="<?php echo $write['number']; ?>" />
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
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
