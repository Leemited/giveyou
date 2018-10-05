<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `best_branch` where id='".$id."'");
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>지점관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/partner_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
						<tr>
							<th>지점명</th>
							<td><?php echo $view['name']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['tel']; ?></td>
						</tr>
						<?php if($is_admin){ ?>
						<tr>
							<th>관리 아이디</th>
							<td><?php echo $view['mb_id']; ?></td>
						</tr>
						<?php } ?>
						<tr>
							<th>주소</th>
							<td><?php echo $view['addr1'].$view['addr2']; ?></td>
						</tr>
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/branch_write.php?id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/branch_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
