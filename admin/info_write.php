<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	
	$write=sql_fetch("select * from `gopa_tel`");
	
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>기본정보</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/info_update.php"; ?>" method="post" enctype="multipart/form-data">				
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
					    <tr>
							<th>회사명</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
						</tr>
						<tr>
							<th>주소</th>
							<td>
							<input type="button" class="adm-btn01" id="postcodify_search_button" value="주소검색" style="background:#898989">
							<input type="text" name="addr1" id="addr1" required class="adm-input01 grid_100 postcodify_address" value="<?php echo $write['addr']; ?>" />
							<input type="text" name="addr2" id="addr2" required class="adm-input01 grid_100 postcodify_details" placeholder="상세주소" />
							</td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><input type="tel" name="email" id="email" required class="adm-input01 grid_100" value="<?php echo $write['email']; ?>" /></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['tel']; ?>" /></td>
						</tr>
						<tr>
							<th>팩스</th>
							<td><input type="tel" name="fax" id="fax" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['fax']; ?>" /></td>
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
<script>
    $(function(){ 
    $("#postcodify_search_button").postcodifyPopUp(); 
});
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
