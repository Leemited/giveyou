<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$long=sql_fetch("select * from best_long");
	$short=sql_fetch("select * from best_short");
?>
<style type="text/css">
	#long h1{font-size:18px;font-family:nbgr;margin-bottom:15px;}
	#long .adm-table02{margin-bottom:40px;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>가격관리</h1>
			<hr />
		</header>
		<article id="long">
			<form action="<?php echo G5_URL."/admin/long_update.php"; ?>" method="post">
				<h1>장기 대여 가격표</h1>
				<div class="adm-table02">
					<table>
						<tr>
							<th>&nbsp;</th>
							<th class="text-center">소형</th>
							<th class="text-center">중형</th>
							<th class="text-center">대형</th>
							<th class="text-center">승합</th>
							<th class="text-center">수입</th>
							<th class="text-center">SUV/RV</th>
						</tr>
						<tr>
							<th class="text-center">~1개월</th>
							<td><input type="text" name="s1" id="s1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['s1']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="m1" id="m1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['m1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="b1" id="b1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['b1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="v1" id="v1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['v1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="i1" id="i1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['i1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="r1" id="r1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['r1']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">~3개월</th>
							<td><input type="text" name="s3" id="s3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['s3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="m3" id="m3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['m3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="b3" id="b3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['b3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="v3" id="v3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['v3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="i3" id="i3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['i3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="r3" id="r3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['r3']; ?>" onkeyup="return number_only(this);" /></td>
						</tr>
						<tr>
							<th class="text-center">~6개월</th>
							<td><input type="text" name="s6" id="s6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['s6']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="m6" id="m6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['m6']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="b6" id="b6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['b6']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="v6" id="v6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['v6']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="i6" id="i6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['i6']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="r6" id="r6" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['r6']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">~1년</th>
							<td><input type="text" name="s12" id="s12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['s12']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="m12" id="m12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['m12']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="b12" id="b12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['b12']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="v12" id="v12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['v12']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="i12" id="i12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['i12']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="r12" id="r12" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['r12']; ?>" onkeyup="return number_only(this);" /></td>
						</tr>
						<tr>
							<th class="text-center">~3년</th>
							<td><input type="text" name="s36" id="s36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['s36']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="m36" id="m36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['m36']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="b36" id="b36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['b36']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="v36" id="v36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['v36']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="i36" id="i36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['i36']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="r36" id="r36" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $long['r36']; ?>" onkeyup="return number_only(this);" /></td>
						</tr>
					</table>
				</div>
				<h1>단기 대여 가격표</h1>
				<div class="adm-table02">
					<table>
						<tr>
							<th>&nbsp;</th>
							<th class="text-center">소형</th>
							<th class="text-center">중형</th>
							<th class="text-center">대형</th>
							<th class="text-center">승합</th>
							<th class="text-center">수입</th>
							<th class="text-center">SUV/RV</th>
						</tr>
						<tr>
							<th class="text-center">1~2일</th>
							<td><input type="text" name="ss1" id="ss1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['s1']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sm1" id="sm1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['m1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="sb1" id="sb1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['b1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="sv1" id="sv1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['v1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="si1" id="si1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['i1']; ?>" onkeyup="return number_only(this);"  /></td>
							<td><input type="text" name="sr1" id="sr1" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['r1']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">3~4일</th>
							<td><input type="text" name="ss3" id="ss3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['s3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sm3" id="sm3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['m3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sb3" id="sb3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['b3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sv3" id="sv3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['v3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="si3" id="si3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['i3']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sr3" id="sr3" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['r3']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">5~6일</th>
							<td><input type="text" name="ss5" id="ss5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['s5']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sm5" id="sm5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['m5']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sb5" id="sb5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['b5']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sv5" id="sv5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['v5']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="si5" id="si5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['i5']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sr5" id="sr5" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['r5']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">7일~</th>
							<td><input type="text" name="ss7" id="ss7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['s7']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sm7" id="sm7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['m7']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sb7" id="sb7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['b7']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sv7" id="sv7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['v7']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="si7" id="si7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['i7']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sr7" id="sr7" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['r7']; ?>" onkeyup="return number_only(this);"  /></td>
						</tr>
						<tr>
							<th class="text-center">시간당</th>
							<td><input type="text" name="ssh" id="ssh" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['sh']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="smh" id="smh" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['mh']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sbh" id="sbh" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['bh']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="svh" id="svh" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['vh']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="sih" id="sih" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['ih']; ?>" onkeyup="return number_only(this);" /></td>
							<td><input type="text" name="srh" id="srh" class="adm-input01 grid_100" required placeholder="최저가" value="<?php echo $short['rh']; ?>" onkeyup="return number_only(this);"  /></td>
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
