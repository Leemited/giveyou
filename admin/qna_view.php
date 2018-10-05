<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	if(!$id){
		alert("잘못된 정보입니다.");
	}
	$view=sql_fetch("select * from `g5_write_qna` where wr_id='".$id."'");
    $date = explode(" ", $view['wr_datetime'] );
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>고객만족센터</h1>
			<hr />
		</header>
		<article>
			<form action="<?php echo G5_URL."/admin/notice_update.php"; ?>" method="post" enctype="multipart/form-data">
				<div class="adm-table02">
					<table>
					    <tr>
							<th>등록일</th>
							<td><?php echo $date[0]; ?></td>
						</tr>
						<tr>
							<th>제목</th>
							<td><?php echo $view['wr_subject']; ?></td>
						</tr>
                   	   <tr>
							<th>작성자</th>
							<td><?php echo $view['wr_name']; ?></td>
						</tr>
					   <tr>
							<th>공지내용</th>
							<td><?php echo $view['wr_content']; ?></td>
						</tr>                   		
					</table>
				</div>
				<div class="text-center mt20" style="margin-bottom:20px;">					
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/notice_list.php?page=".$page; ?>" class="adm-btn01">목록으로</a><?php } ?>
					<?php if($is_admin){ ?><a href="<?php echo G5_URL."/admin/notice_write.php?wr_id=".$id."&page=".$page; ?>" class="adm-btn01">수정하기</a><?php } ?>
				</div>
			</form>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
