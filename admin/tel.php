<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$best_tel=sql_fetch("select * from best_tel");
	$hour1=date("H",strtotime($best_tel['time1']));
	$hour2=date("H",strtotime($best_tel['time2']));
	$min1=date("m",strtotime($best_tel['time1']));
	$min2=date("m",strtotime($best_tel['time2']));
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>전화번호관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/tel_update.php"; ?>" method="post">
				<div class="adm-table02">
					<table>
						<tr>
							<th>영업시간</th>
							<td>
								<select name="hour1" id="hour1" class="adm-input01">
								<?php
									for($i=0;$i<24;$i++){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $hour1==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<span>:</span>
								<select name="min1" id="min1" class="adm-input01">
								<?php
									for($i=0;$i<60;$i+=5){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $min1==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<span>~</span>
								<select name="hour2" id="hour2" class="adm-input01">
								<?php
									for($i=0;$i<24;$i++){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $hour2==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<span>:</span>
								<select name="min2" id="min2" class="adm-input01">
								<?php
									for($i=0;$i<60;$i+=5){
								?>
									<option value="<?php echo sprintf("%02d",$i); ?>" <?php echo $min2==sprintf("%02d",$i)?"selected":""; ?>><?php echo sprintf("%02d",$i); ?></option>
								<?php
									}
								?>
								</select>
								<br />
								<input type="checkbox" name="all" id="all" <?php echo $best_tel['all']?"checked":""; ?> />
								<label for="all">24시간 연중무휴</label>
							</td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><input type="tel" name="tel" id="tel" placeholder="'-'을 제외하고 번호만 작성해주세요" class="adm-input01 grid_100" required onkeyup="return number_only(this);" value="<?php echo $best_tel['tel']; ?>" /></td>
						</tr>
						<tr>
							<th>사고대차 전화번호</th>
							<td><input type="accident" name="accident" id="tel_accident" placeholder="'-'을 제외하고 번호만 작성해주세요" class="adm-input01 grid_100" required onkeyup="return number_only(this);" value="<?php echo $best_tel['accident']; ?>" /></td>
						</tr>
						<tr>
							<th>사고대차 영업시간 외<br />전화번호</th>
							<td><input type="accident2" name="accident2" id="accident2" placeholder="'-'을 제외하고 번호만 작성해주세요" class="adm-input01 grid_100" required onkeyup="return number_only(this);" value="<?php echo $best_tel['accident2']; ?>" /></td>
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
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
