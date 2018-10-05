<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	$where="1";
	if($m)
		$where.=" and `model`='{$m}'";
	if($b)
		$where.=" and `branch`='{$b}'";
	$total=sql_fetch("select count(*) as cnt from `best_car` where {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select *,b.name as branch,m.name as model,a.id as id from `best_car` as a inner join `best_branch` as b on a.branch=b.id inner join `best_model` as m on a.model=m.id where {$where} order by a.`id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
	$where="1";
	if(!$is_admin){
		$where="`mb_id`='{$member['mb_id']}'";
	}
	$model_query=sql_query("select * from `best_model`");
	$branch_query=sql_query("select * from `best_branch` where {$where}");
	while($model_data=sql_fetch_array($model_query)){
		$model_list[]=$model_data;
	}
	while($branch_data=sql_fetch_array($branch_query)){
		$branch_list[]=$branch_data;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>차량관리</h1>
			<hr />
		</header>
		<article>
			<div class="text-right">
				<select name="model" id="model" class="adm-input01" style="width:100px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/car_list.php?m='+this.value+'&b=".$b; ?>'">
					<option value="">전체보기</option>
					<?php
						for($i=0;$i<count($model_list);$i++){
					?>
						<option value="<?php echo $model_list[$i]['id']; ?>" <?php echo $m==$model_list[$i]['id']?"selected":""; ?>><?php echo $model_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
				<select name="branch" id="branch" class="adm-input01" style="width:100px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/car_list.php?m=".$m."&b='+this.value"; ?>;">
					<option value="">전체보기</option>
					<?php
						for($i=0;$i<count($branch_list);$i++){
					?>
						<option value="<?php echo $branch_list[$i]['id']; ?>" <?php echo $b==$branch_list[$i]['id']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="adm-table01 mt20">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>차종</th>
							<th>차번호</th>
							<th>소유지점</th>
							<th>구분</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
					?>
						<tr>
							<td class="md_none"><?php echo $list[$i]['num']; ?></td>
							<td><?php echo $list[$i]['model']; ?></td>
							<td><?php echo $list[$i]['number']; ?></td>
							<td><?php echo $list[$i]['branch']; ?></td>
							<td><?php echo $list[$i]['c_type']; ?></td>
							<td><a href="<?php echo G5_URL."/admin/car_write.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">수정</a> <a href="<?php echo G5_URL."/admin/car_delete.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">삭제</a></td>
						</tr>
					<?php
						}
						if(count($list)==0){
					?>
						<tr>
							<td colspan="5" class="text-center" style="padding:50px 0;">차량이 없습니다.</td>
						</tr>
					<?php
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/car_list.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/car_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/car_list.php?page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/car_write.php"; ?>" class="adm-btn01">차량추가</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
