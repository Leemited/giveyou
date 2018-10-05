<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($id){
		$write=sql_fetch("select * from `best_branch` where id='".$id."'");
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>지점관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/branch_update.php"; ?>" name="branch_form" id="branch_form" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
				<div class="adm-table02">
					<table>
						<tr>
							<th>지점명</th>
							<td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" value="<?php echo $write['tel']; ?>" /></td>
						</tr>
						<?php if($is_admin){ ?>
						<tr>
							<th>관리 아이디</th>
							<td><input type="text" name="mb_id" id="mb_id" required class="adm-input01 grid_100" value="<?php echo $write['mb_id']; ?>" /></td>
						</tr>
						<?php } ?>
						<tr>
							<th>주소</th>
							<td>
								<input type="text" name="addr1" id="addr1" required class="adm-input01 grid_40" value="<?php echo $write['addr1']; ?>" />
								<input type="text" name="addr2" id="addr2" class="adm-input01 grid_40" value="<?php echo $write['addr2']; ?>" />
								<button type="button" class="btn color_white bg_gray grid_20 lh30" onclick="win_zip('branch_form', 'mb_zip', 'addr1', 'addr2', 'addr3', 'mb_addr_jibeon');" style="border:0;">주소 검색</button>
								<input type="hidden" name="mb_zip" id="reg_mb_addr2" class="frm_input frm_address" size="50">
								<input type="hidden" name="addr3" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly">
								<input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>">
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
