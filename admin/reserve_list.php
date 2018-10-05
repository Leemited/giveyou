<?php
	include_once("../common.php");
	$p=true;
	include_once(G5_PATH."/admin/head.php");
	$where="1";
	if(!$b && !$is_admin){
		goto_url(G5_URL."/admin/reserve_list.php?b=".$branch['id']);
	}
	if($m)
		$where.=" and r.`model`='{$m}'";
	if($b)
		$where.=" and (c.`branch`='{$b}' or (r.rental_point=(select name from best_branch where id='{$b}')))";
	if($s)
		$where.=" and r.`status`='{$s}'";
	if($sel!="" && $search!=""){
		$where.=" and `{$sel}` like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `best_reserve` as r left join `best_model` as m on r.model=m.id left join `best_car` as c on r.car=c.id where {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select *,r.type as rtype,m.name as model,c.number as car,r.id as id,r.year as ryear from `best_reserve` as r left join `best_model` as m on r.model=m.id left join `best_car` as c on r.car=c.id where {$where} order by r.`id` desc limit {$start},{$rows}";
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
<style type="text/css">
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
	.mt30{margin-top:30px;}
</style>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>예약관리</h1>
			<hr />
		</header>
		<article>
			<div class="text-right" >
				<select name="s" id="s" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s='+this.value+'m=".$m."&b=".$b; ?>'">
					<option value="">상태검색</option>
					<option value="-1" <?php echo isset($s)&&$s==-1?"selected":""; ?>>예약취소</option>
					<option value="0" <?php echo isset($s)&&$s!=""&&$s==0?"selected":""; ?>>예약대기</option>
					<option value="1" <?php echo isset($s)&&$s!=""&&$s==1?"selected":""; ?>>예약중</option>
					<option value="2" <?php echo isset($s)&&$s==2?"selected":""; ?>>예약완료</option>
				</select>
				<select name="m" id="m" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s=".$s."&m='+this.value+'&b=".$b; ?>'">
					<option value="">차종검색</option>
					<?php
						for($i=0;$i<count($model_list);$i++){
					?>
						<option value="<?php echo $model_list[$i]['id']; ?>" <?php echo $m==$model_list[$i]['id']?"selected":""; ?>><?php echo $model_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
				<select name="b" id="b" class="adm-input01" style="width:90px;" onchange="javascript:location.href='<?php echo G5_URL."/admin/reserve_list.php?s".$s."&m=".$m."&b='+this.value"; ?>;">
					<?php if($is_admin){ ?>
					<option value="">지점선택</option>
					<?php } ?>
					<?php
						for($i=0;$i<count($branch_list);$i++){
					?>
						<option value="<?php echo $branch_list[$i]['id']; ?>" <?php echo $b==$branch_list[$i]['id']?"selected":""; ?>><?php echo $branch_list[$i]['name']; ?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="grid_100 mt20">
				<form action="" method="get">
					<input type="hidden" name="s" />
					<input type="hidden" name="m" />
					<input type="hidden" name="b" />
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="mb_id" <?php echo $sel=="mb_id"?"selected":""; ?>>아이디</option>
							<option value="mb_name" <?php echo $sel=="mb_name"?"selected":""; ?>>이름</option>
						</select>
					</div>
					<div class="grid_60 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo $search; ?>" /></div>
					<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
				</form>
			</div>
			<div class="adm-table01 mt30">
				<table>
					<thead>
						<tr>
							<th class="md_none">일시</th>
							<th>구분</th>
							<th>차종</th>
							<th class="md_none">대여일</th>
							<th class="md_none">반납일</th>
							<th>예약자</th>
							<th>연락처</th>
							<th>생년</th>
							<th>상태</th>
							<th class="md_none">차량번호</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($list);$i++){
							switch($list[$i]['status']){
								case "-1":$status="예약취소";break;
								case "0":$status="예약대기";break;
								case "1":$status="예약중";break;
								case "2":$status="예약완료";break;
								default:$status="예약대기";break;
							}
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo date("Y-m-d",strtotime($list[$i]['datetime'])); ?><br /><?php echo date("H:i:s",strtotime($list[$i]['datetime'])); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['rtype']=="short"?"단기대여":"장기대여"; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['model']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'">
								<?php echo $list[$i]['start']!="0000-00-00 00:00:00"?date("Y-m-d",strtotime($list[$i]['start']))."<br />".date("H:i:s",strtotime($list[$i]['start'])):"-"; ?>
							</td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'">
								<?php echo $list[$i]['end']!="0000-00-00 00:00:00"?date("Y-m-d",strtotime($list[$i]['end']))."<br />".date("H:i:s",strtotime($list[$i]['end'])):"-"; ?>
							</td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['mb_name']; ?><?php echo $list[$i]['mb_id']?"<br />(".$list[$i]['mb_id'].")":""; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo hyphen_hp_number($list[$i]['mb_phone']); ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['ryear']?$list[$i]['ryear']:""; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $status; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/reserve_view.php?id=".$list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; ?>'"><?php echo $list[$i]['car']; ?><br /><?php echo $list[$i]['car_com']; ?></td>
							<td class="md_none"><a href="<?php echo G5_URL."/admin/reserve_write.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">수정</a><a href="<?php echo G5_URL."/admin/reserve_delete.php?id=".$list[$i]['id']."&page=".$page; ?>" class="btn">삭제</a></td>
						</tr>
					<?php
						}
						if(count($list)==0){
					?>
						<tr>
							<td colspan="9" class="text-center" style="padding:50px 0;">예약이 없습니다.</td>
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/reserve_list.php?b=".$b."&s=".$s."&m=".$m."&page=".($page+1); ?>">&gt;</a></li>
				<?php } ?>
				</ul>
			</div>
			<?php
			}
			?>
			<div class="text-right mt20">
				<a href="<?php echo G5_URL."/admin/reserve_write.php"; ?>" class="adm-btn01">예약추가</a>
			</div>
		</article>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
