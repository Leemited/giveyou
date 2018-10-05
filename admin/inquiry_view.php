<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	$id = $_REQUEST["id"];
	$page = $_REQUEST["page"];
	$view=sql_fetch("select * from `g5_write_inquiry` where wr_id = '{$id}'");	
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>신청정보</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/info_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
					    <tr>
                            <th>매장명</th>
							<td><?php echo $view['wr_name']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['wr_1']; ?></td>
						</tr>						
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">					
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/inquiry_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
