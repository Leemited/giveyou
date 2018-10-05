<?php
	include_once("../common.php");
	include_once(G5_PATH."/admin/head.php");
	$total=sql_fetch("select count(*) as cnt from `gopa_tel`");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$list=sql_fetch("select * from `gopa_tel`");
 
?>
<!-- 본문 start -->
<div id="wrap">
	<section>
		<header id="admin-title">
			<h1>기본정보</h1>
			<hr />
		</header>
		<article>
			<div class="adm-table01">
				<table>
					<colgroup>
                            <col width="15%" />
							<col width="30%" />
							<col width="15%" />
							<col width="15%" />
							<col width="15%" />
							<col width="10%" />							
					</colgroup>
					<thead>
						<tr>
                            <th>회사명</th>							
                            <th>주소</th>
                            <th>이메일</th>
                            <th>전화번호</th>
                            <th>팩스</th>
							<th>관리</th>
						</tr>
					</thead>
					<tbody>				
						<tr>
						    <td onclick="location.href='<?php echo G5_URL."/admin/info_view.php?page=".$page; ?>'"><?php echo $list['name']; ?></td>							
							<td onclick="location.href='<?php echo G5_URL."/admin/info_view.php?page=".$page; ?>'"><?php echo $list['addr']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/info_view.php?page=".$page; ?>'"><?php echo $list['email']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/info_view.php?page=".$page; ?>'"><?php echo $list['tel']; ?></td>
                            <td onclick="location.href='<?php echo G5_URL."/admin/info_view.php?page=".$page; ?>'"><?php echo $list['fax']; ?></td>
							<td><a href="<?php echo G5_URL."/admin/info_write.php?page=".$page; ?>" class="btn01">수정</a></td>
						</tr>
					<?php
						 
						if(count($list)==0){
					?>
						<tr>
							<td colspan="5" class="text-center" style="padding:50px 0;">문의 내용이 없습니다.</td>
						</tr>
					<?php
						}
					?>					
					</tbody>
				</table>
<!--
				<div class="text-right mt20">
                        <a href="<?php echo G5_URL."/admin/info_write.php?page=".$page; ?>" class="adm-btn01">추가하기</a>
                    </div>				  
-->
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
					<li class="prev"><a href="<?php echo G5_URL."/admin/qna_list.php?page=".($page-1); ?>">&lt;</a></li>
				<?php } ?>
				<?php for($i=$start_page;$i<=$end_page;$i++){ ?>
					<li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/qna_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
				<?php } ?>
				<?php if($page<$total_page){?>
					<li class="next"><a href="<?php echo G5_URL."/admin/qna_list.php?page=".($page+1); ?>">&gt;</a></li>
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
