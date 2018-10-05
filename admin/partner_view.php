<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `store_temp` where id='".$id."'");
	echo $view["mb_id"];
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>협력업체관리</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/partner_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
						<tr>
							<th>업체이름</th>
							<td><?php echo $view['store_name']; ?></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><?php echo $view['store_hp']; ?></td>
						</tr>
						<tr>
							<th>홈페이지</th>
							<td><?php echo $view['store_homepage']; ?></td>
						</tr>
						<!--<tr>
							<th>배너</th>
							<td><img src="<?php /*echo G5_DATA_URL."/partner/".$view['banner']; */?>" alt="배너" /></td>
						</tr>
						<tr>
							<th>내용</th>
							<td><img src="<?php /*echo G5_DATA_URL."/partner/".$view['content']; */?>" alt="배너" /></td>
						</tr>-->
						<tr>
							<th>주소</th>
							<td>(<?php echo $view['store_zip']; ?>) <?php echo $view["store_addr1"];?> <?php echo $view["store_addr2"];?></td>
						</tr>
						<tr>
							<th>업종</th>
							<td><?php echo $view['store_cate']; ?></td>
						</tr>
						<tr>
							<th>사업자번호</th>
							<td><?php echo $view['store_number']; ?></td>
						</tr>
						<tr>
							<th>통장사본</th>
							<td><img src="<?php echo G5_DATA_URL."/member/".substr($view["mb_id"],0,2)."/".$view["store_bank"];?>" alt="통장사본"></td>
						</tr>
						<tr>
							<th>전단지</th>
							<td><img src="<?php echo G5_DATA_URL."/member/".substr($view["mb_id"],0,2)."/".$view["store_marketing"];?>" alt="전단지"></td>
						</tr>
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">
					<a href="<?php echo G5_URL."/admin/partner_update.php?id=".$id."&page=".$page; ?>" class="adm-btn01">승인</a>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/partner_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
