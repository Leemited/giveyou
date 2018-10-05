<?php 
include_once("../common.php");
 header( "Content-type: application/vnd.ms-excel; charset=utf-8" ); 
 header( "Content-Disposition: attachment; filename=포인트관리(회원).xls" ); 
 header( "Content-Description: PHP4 Generated Data" ); 
 print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=utf-8\">");
    
    if($sel!="" && $search!=""){
		$where .= " and {$sel} like '%{$search}%'";
	}
	$total=sql_fetch("select count(*) as cnt from `{$g5['point_table']}` as p inner join `g5_member` as m on p.mb_id=m.mb_id where m.mb_level = '1'");
	if(!$page)
		$page=1;
	$total=$total['cnt'];    
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
    $sql="select p.*,m.mb_level,m.mb_no from `{$g5['point_table']}` as p inner join `g5_member` as m on p.mb_id=m.mb_id where m.mb_level = '1' {$where} order by `po_id` desc limit {$start},{$rows}";
    $query=sql_query($sql);
    $j=0;
    while($data=sql_fetch_array($query)){
        $list[$j]=$data;
        $list[$j]['num']=$total-($start)-$j;
        $j++;
    }    

?>
<!--<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"> -->
<table border="1" cellpadding="1" cellspacing="0"> 
<tr><td><b>회원번호</b></td><td><b>아이디</b></td><td><b>날짜</b></td><td><b>적립내역</b></td><td><b>포인트</b></td></tr> 
<?php 
for($i = 0; $i < count($list); $i++){ ?>
<tr><td><?php echo $list[$i]['mb_no'];?></td><td><?php echo $list[$i]['mb_id']; ?></td><td><?php echo $list[$i]['po_datetime'];?></td><td><?php echo $list[$i]['po_content']; ?></td><td><?php echo $list[$i]['po_point']."P"; ?></td></tr> 
<?php } ?> 
</table>