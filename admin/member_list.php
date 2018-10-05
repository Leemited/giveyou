<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$where = " mb_id <> 'admin' ";
	if($sel!="" && $search!=""){
		$where .= " and `{$sel}` like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `g5_member` where {$where} ");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select * from `g5_member` where {$where} order by `mb_no` desc limit {$start},{$rows}";
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
			<h1>회원관리</h1>
			<hr />
		</header>
		<article>
			<div class="grid_100" style="margin-bottom:30px">
				<form action="" method="get">
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="mb_id" <?php echo $sel=="mb_id"?"selected":""; ?>>아이디</option>
							<option value="mb_name" <?php echo $sel=="mb_name"?"selected":""; ?>>이름</option>
							<option value="mb_hp" <?php echo $sel=="mb_hp"?"selected":""; ?>>휴대폰번호</option>
						</select>
					</div>
					<div class="grid_60 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" /></div>
					<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
				</form>
			</div>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th class="md_none">이메일</th>
							<th>휴대폰번호</th>
							<th>등급</th>
							<th class="md_none">가입일</th>
							<th class="md_none">최종접속일</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo abs($list[$i]['num']); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo $list[$i]['mb_level']==5?"상점":"일반"; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($list[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($list[$i]['mb_today_login'])); ?></td>
							<td>
								<a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$list[$i]['mb_no']; ?>"><?php echo $list[$i]['mb_intercept_date']||$list[$i]['mb_leave_date']?"활성":"정지"; ?></a>
								<a href="javascript:del_confirm('<?php echo G5_URL."/admin/member_delete.php?mb_no=".$list[$i]['mb_no']; ?>');">삭제</a>
							</td>
						</tr>
					<?php
						}
						if(count($list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/member_list.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/member_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/member_list.php?page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
		</article>
	</section>
</div>
<script type="text/javascript">
	function del_confirm(url){
		if(confirm('삭제시 회원정보는 돌릴 수 없습니다.\n삭제하시겠습니까?')){
			location.href=url;
		}else{
			return false;
		}
	}
</script>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
