<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($member["mb_level"]==5){
	    goto_url(G5_URL."/admin/my_store_list.php");
    }
	$sql="select * from `g5_member` order by `mb_no` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$member_list[$j]=$data;
		$member_list[$j]['num']=$j+1;
		$j++;
	}
	$sql="select *,m.name as model,c.number as car,r.id as id from `best_reserve` as r left join `best_model` as m on r.model=m.id left join `best_car` as c on r.car=c.id order by r.`id` desc limit 0,5";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$reserve_list[$j]=$data;
		$reserve_list[$j]['num']=$j+1;
		$j++;
	}
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>관리자페이지</h1>
			<hr />
		</header>
        <?php if($member["mb_level"]>5){?>
		<article>
			<h1 style="font-size:24px;margin-bottom:20px;font-weight:normal">회원관리 <a href="<?php echo G5_URL."/admin/member_list.php"; ?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01">
				<table>
					<thead>
						<tr>
							<th class="md_none">번호</th>
							<th>아이디</th>
							<th>이름</th>
							<th class="md_none">이메일</th>
							<th>휴대폰번호</th>
							<th>포인트</th>
							<th class="md_none">가입일</th>
							<th class="md_none">최종접속일</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
						for($i=0;$i<count($member_list);$i++){
					?>
						<tr>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['num']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_id']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_name']; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_email']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_hp']; ?></td>
							<td onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo $member_list[$i]['mb_point']?number_format($member_list[$i]['mb_point']):0; ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_datetime'])); ?></td>
							<td class="md_none" onclick="location.href='<?php echo G5_URL."/admin/member_view.php?mb_no=".$member_list[$i]['mb_no']; ?>';"><?php echo date("Y.m.d H:i",strtotime($member_list[$i]['mb_today_login'])); ?></td>
							<td><a href="<?php echo G5_URL."/admin/member_stop.php?mb_no=".$member_list[$i]['mb_no']; ?>"><?php echo $member_list[$i]['mb_intercept_date']?"활성":"정지"; ?></a></td>
						</tr>
					<?php
						}
						if(count($member_list)==0){
							echo "<tr><td colspan='9' class='text-center' style='padding:100px 0;'>목록이 없습니다</td></tr>";
						}
					?>
					</tbody>
				</table>
			</div>
			<!--<h1 style="margin-top:20px;font-size:24px;margin-bottom:20px;font-weight:normal">주문관리 <a href="<?php /*echo G5_URL."/admin/reserve_list.php"; */?>" style="float:right;font-size:14px;vertical-align:bottom;margin-top:12px">더보기</a></h1>
			<div class="adm-table01 mt20">
				<table>
					<thead>
						<tr>
							<th class="md_none">일시</th>
							<th>차종</th>
							<th class="md_none">대여일</th>
							<th class="md_none">반납일</th>
							<th>예약자</th>
							<th>연락처</th>
							<th>상태</th>
							<th>차량번호</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>
					<?php
/*						for($i=0;$i<count($reserve_list);$i++){
							switch($reserve_list[$i]['status']){
								case "-1":$status="예약취소";break;
								case "0":$status="예약대기";break;
								case "1":$status="예약중";break;
								case "2":$status="예약완료";break;
								default:$status="예약대기";break;
							}
					*/?>
						<tr>
							<td class="md_none" onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo date("Y-m-d",strtotime($reserve_list[$i]['datetime'])); */?><br /><?php /*echo date("H:i:s",strtotime($reserve_list[$i]['datetime'])); */?></td>
							<td onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo $reserve_list[$i]['model']; */?></td>
							<td class="md_none" onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo date("Y-m-d",strtotime($reserve_list[$i]['start'])); */?><br /><?php /*echo date("H:i:s",strtotime($reserve_list[$i]['start'])); */?></td>
							<td class="md_none" onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo date("Y-m-d",strtotime($reserve_list[$i]['end'])); */?><br /><?php /*echo date("H:i:s",strtotime($reserve_list[$i]['end'])); */?></td>
							<td onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo $reserve_list[$i]['mb_name']; */?><?php /*echo $reserve_list[$i]['mb_id']?"<br />(".$reserve_list[$i]['mb_id'].")":""; */?></td>
							<td onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo hyphen_hp_number($reserve_list[$i]['mb_phone']); */?></td>
							<td onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo $status; */?></td>
							<td onclick="location.href='<?php /*echo G5_URL."/admin/reserve_view.php?id=".$reserve_list[$i]['id']."&page=".$page."&s=".$s."&m=".$m."&b".$b; */?>'"><?php /*echo $reserve_list[$i]['car']; */?><br /><?php /*echo $reserve_list[$i]['car_com']; */?></td>
							<td><a href="<?php /*echo G5_URL."/admin/reserve_write.php?id=".$reserve_list[$i]['id']."&page=".$page; */?>" class="btn">수정</a>
						</tr>
					<?php
/*						}
						if(count($reserve_list)==0){
					*/?>
						<tr>
							<td colspan="9" class="text-center" style="padding:50px 0;">예약이 없습니다.</td>
						</tr>
					<?php
/*						}
					*/?>
					</tbody>
				</table>
			</div>-->
		</article>
        <?php }?>
	</section>
</div>
<?php
	include_once(G5_PATH."/admin/tail.php");
?>
