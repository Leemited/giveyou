<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if($wr_id){
		$write=sql_fetch("select * from `g5_write_qna` where wr_id='".$wr_id."'");
	}

?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>고객만족센터</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_BBS_URL."/write_update.php"; ?>"id="notice_write" method="post" enctype="multipart/form-data">
				<input type="hidden" name="page" value="<?php echo $page; ?>" />
                <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
                <input type="hidden" name="w" value="<?php echo $w ?>">
                <input type="hidden" name="bo_table" value="qna">
                <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                <input type="hidden" name="stx" value="<?php echo $stx ?>">
                <input type="hidden" name="spt" value="<?php echo $spt ?>">
                <input type="hidden" name="sst" value="<?php echo $sst ?>">
                <input type="hidden" name="sod" value="<?php echo $sod ?>">
                
				<div class="adm-table02">
					<table>								
						<tr>
							<th>제목</th>
							<td><input type="text" name="wr_subject" id="wr_subject" required class="adm-input01 grid_100" value="<?php echo $write['wr_subject']; ?>" /></td>
						</tr>                                           
                        <tr>
							<th>내용</th>
							<td><textarea name="wr_content" id="wr_content" ><?php echo $write['wr_content'];?></textarea></td>
                        </tr>
					</table>
				</div>
				<div class="text-center mt20">
					<input type="submit" value="확인" class="adm-btn01"onclick="_onSubmit(this);" />
				</div>
			</form>
		</article>
	</section>
</div>
<script>

</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
