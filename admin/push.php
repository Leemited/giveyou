<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$page=1;
	if(!$page){
		$page=1;
	}
	$row=10;
	$start=$row*($page-1);
	$total=sql_fetch("SELECT count(*) as cnt FROM  `best_push`");
	$total=$total['cnt'];
	$total_page=ceil($total/$row);
	$sql="SELECT * FROM  `best_push` order by datetime desc limit {$start},{$row}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
?>
<style type="text/css">
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>이벤트 푸시 보내기</h1>
			<hr />
		</header>
		<article>
			<div class="grid_100" style="margin-bottom:30px">
				<form action="<?php echo G5_URL."/admin/push_update.php"; ?>" method="post" style="padding:10px;">
					<div class="grid_100"><input type="text" name="title" id="title" class="grid_100 adm-input01" placeholder="타이틀 입력" value="베스트 렌트카"/></div>
					<div class="grid_100 pl10"><input type="text" name="content" id="contents" class="grid_100 adm-input01"  placeholder="내용 입력" /></div>
					<div class="grid_100 pl10"><input type="text" name="content" id="contents" class="grid_100 adm-input01"  placeholder="이미지링크 입력" /></div>
					<div class="grid_100 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="보내기" /></div>
				</form>
			</div>
			<div class="adm-table01">
				<table>
					<colgroup>
						<col width="10%" />
						<col width="25%" />
						<col width="*" />
						<col width="*" />
						<col width="15%" />
					</colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>타이틀</th>
							<th>내용</th>
							<th>이미지링크</th>
							<th>시간</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
					?>
						<tr>
							<td><?php echo $list[$i]['num']; ?></td>
							<td><?php echo $list[$i]['title']; ?></td>
							<td><?php echo $list[$i]['content']; ?></td>
							<td><?php echo $list[$i]['imgurl']; ?></td>
							<td><?php echo date("Y.m-d H:i",strtotime($list[$i]['datetime'])); ?></td>
						</tr>
					<?php
						}
						if(count($list)==0){
							echo "<tr><td colspan='5' class='text-center' style='padding:100px 0;'>푸시 보낸 내역이 없습니다.</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
				if($total_page>1){
					$start_page=1;
					$end_page=$total_page;
					if($total_page>5){
						if($total_page<($page+2)){
							$start_page=$total_page-4;
							$end_page=$total_page;
						}else if($page>3){
							$start_page=$page-2;
							$end_page=$page+2;
						}else{
							$start_page=1;
							$end_page=5;
						}
					}
			?>
			<div class="num_list01">
				<ul>
				<?php if($page!=1){?>
					<li class="prev"><a href="<?php echo G5_URL."/admin/push.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/push.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/push.php?page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
