<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	if($sel!="" && $search!=""){
		$where .= " and {$sel} like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `{$g5['point_table']}` as p inner join `g5_member` as m on p.mb_id=m.mb_id where m.mb_level = '5'");
	if(!$page)
		$page=1;
	$total=$total['cnt'];    
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
    $sql="select p.*,m.mb_level,m.mb_name,m.mb_no,s.store_name,s.store_cate from `{$g5['point_table']}` as p inner join `g5_member` as m on p.mb_id=m.mb_id inner join `store_temp` as s on m.mb_id=s.mb_id where m.mb_level = '5' {$where} order by `po_id` desc limit {$start},{$rows}";
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
			<h1>포인트관리(판매점)</h1>
			<hr />
		</header>
		<article>
            <div class="grid_100" style="margin-bottom:30px">
				<form action="" method="get">
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="p.mb_id" <?php echo $sel=="p.mb_id"?"selected":""; ?>>아이디</option>							
                            <option value="p.po_datetime" <?php echo $sel=="p.po_datetime"?"selected":""; ?>>적립일</option>0
                            <option value="s.store_name" <?php echo $sel=="s.store_name"?"selected":""; ?>>매장명</option>
                            <option value="s.store_cate" <?php echo $sel=="s.store_cate"?"selected":""; ?>>업종</option>					
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
                            <th>상점번호</th>
                            <th>날짜</th>
                            <th>아이디</th>
                            <th>매장명 / 업종</th>                            							                            
                            <th>적립내역</th>
                            <th>포인트</th>                            
							<th>관리</th>
						</tr>
					</thead>
					<tbody>		
					<?php for($i=0;$i<count($list);$i++){ ?>	
						<tr>
                            <td class="md_none"><?php echo $list[$i]["mb_no"]; ?></td>
                            <td><?php echo $list[$i]["po_datetime"]; ?></td>
                            <td><?php echo $list[$i]['mb_id']; ?></td>
                            <td><?php echo $list[$i]["store_name"]." / ".$list[$i]["store_cate"]; ?></td>                                                        
                            <td><?php echo $list[$i]["po_content"]; ?></td>
                            <td><?php echo number_format($list[$i]["po_point"])."P"; ?></td>
                            <td><a href="<?php echo G5_URL."/admin/point_delete.php?id=".$list[$i]['po_id']."&page=".$page; ?>" class="btn">삭제</a></td>
                        </tr>
					<?php
                                                        }
						if(count($list)==0){
					?>
						<tr>
							<td colspan="7" class="text-center" style="padding:50px 0;">포인트 이용내역이 없습니다.</td>
						</tr>
					<?php
						}
					?>					
					</tbody>
				</table>
				<div class="text-right mt20">
                        <a href="<?php echo G5_URL."/admin/point_shop_write.php?page=".$page; ?>" class="adm-btn01">추가하기</a>
                        <a href="<?php echo G5_URL."/admin/excel_shop.php?sel=".$sel."&search=".$search; ?>" class="adm-btn01">엑셀로저장</a>
                </div>
             		  
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/point_shop.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/point_shop.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/point_shop.php?page=".($page+1); ?>">&gt;</a></li>
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
