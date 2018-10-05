<?php 
include_once("../common.php");

include_once(G5_PATH."/head.sub.php");

$search = $_REQUEST["search"];
if($search){
	$txt = " and a.wr_subject like '%{$search}%'";
}
$query=sql_query("select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.wr_is_comment=0 and a.wr_file != 0 and a.wr_6 = 'Y' {$txt} order by a.wr_1 asc, a.wr_5 desc");

while($data=sql_fetch_array($query)){
    $list[]=$data;
}

?>
<style type="text/css">
	.store_list table{width:100%}
	.store_list table th{border-bottom:2px solid #000;border-top:3px solid #000;padding:10px;text-align:center;font-size:20px;}
	.store_list table td{border-bottom:1px solid #ddd;padding:10px;font-size:20px;}
</style>
<div id="wrap" class="store_list">
	<div class="search">
		<form action="" method="get">
			<input type="text"  name="search" class="input01" value="<?php echo $search;?>"/><input type="submit" value="검색" class="adm-btn01" />
		</form>
	</div>
	<div>
		<table>
			<tr>
				<th>상점명</th>
				<th>선택</th>
			</tr>
			<?php 
			for($i=0;$i<count($list);$i++){
			?>
				<tr>
					<td><?php echo $list[$i]["wr_subject"];?></td>
					<td style="text-align:center"><input type="button" value="선택하기" onclick="fn_add('<?php echo $list[$i]['mb_id']?>','<?php echo $list[$i]['wr_subject'];?>');"/></td>
				</tr>
			<?php }
			?>
		</table>
	</div>
</div>
<script type="text/javascript">
function fn_add(mb_id,subject){
	window.opener.document.getElementById('store_name').value = subject;
	window.opener.document.getElementById('mb_id').value = mb_id;
}
</script>