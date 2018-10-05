<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");

	$view=sql_fetch("select * from `gopa_tel`");	
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>기본정보</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/info_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
					    <tr>
                            <th>회사명</th>
							<td><?php echo $view['name']; ?></td>
						</tr>
						<tr>
                            <th>주소</th>
							<td><?php echo $view['addr']; ?></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td><?php echo $view['email']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['tel']; ?></td>
						</tr>
						<tr>
							<th>팩스</th>
							<td><?php echo $view['fax']; ?></td>
						</tr>						
						
						
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">					
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/info_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
