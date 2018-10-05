<?php
include_once ("../../common.php");
$wr_id=$member["mb_id"];
$title="기부현황";
$back_url= G5_URL."?lat=".$lat."&lng=".$lng;
include_once ("../../head.php");
$sql = "select * from `mb_point_log` where mb_id = '{$member[mb_id]}' and use_point != 0";
$result = sql_query($sql);
$mb = array();
if ($stx)
    $mb = get_member($stx);

//$g5['title'] = '포인트관리';
//include_once ('./admin.head.php');

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";
$n=0;
while($row=sql_fetch_array($result)){
    $list[$n] = $row;
	$date = explode(" ",$row["log_date"]);
	if($date[0]==date("Y-m-d")){
		$list[$n]["date1"] = "오늘";
	}else{
		$list[$n]["date1"] = $date[0]; 
	}
	$list[$n]["date2"] = $date[1]; 
	$n++;
}

?>
<style>
	.section01 .section01_content .point_area{background-color:#474747}
    .total_point,.point_list {width:calc(100% - 20px);padding:10px;background-color:#ddd;}
    .total_point div{border:1px solid #ddd; background:#eee;padding:10px 5%;border-radius: 5px;width:90%;font-size: 17px}
    .point_list table{width:100%;}
    .point_list table th{text-align:center;padding:5px 0; font-size: 16px;font-weight: bold;background: #eee;color:#000;}
    .point_list table td{border:1px dashed #eee;text-align:center;padding:5px 0; font-size: 14px;background-color:#fff}
    .point_tab{width:100%;border-top:1px solid #ddd}
    .point_tab li{float:left;width:50%;padding:10px 0;font-size:15px;background: #f17a40;color:#fff;border-bottom:2px solid #f17a40;text-align:center;cursor: pointer;}
    .point_tab li.active, .point_tab li:hover{font-weight:bold;background:#fff;color:#f17a40;}
</style>
<!-- <div class="width-fixed view">
    <!--<div class="sel-align">
        <div class="select-align">
            <input type="radio" name="align" id="new" value="2">
            <label for="new" ><span class="radio">포인트 충전</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="hit" value="1" checked>
            <label for="hit"><span class="radio">내포인트</span></label>
        </div>
    </div>--
    <div>
        <ul class="point_tab">
            <li class="active">내포인트</li>
            <li onclick="location.href=g5_url+'/page/mypage/point_charge.php'">포인트충전</li>
        </ul>
    </div>
    <div class="clear"></div>
</div> -->
<div class="width-fixed">
	<section class="section01">
		<div class="section01_content wrap">
			<div class="point_area">
				<h1><?php echo number_format($member["mb_point"]);?><span>Point</span></h1>
			</div>
			<div class="point_list">
				<table>
					<colgroup>
						<col width='10%'>
						<col width='20%'>
						<col width='50%'>
						<col width='20%'>
					</colgroup>
					<tr>
						<th>구분</th>
						<th>날짜</th>
						<th>항목</th>
						<th>G포인트</th>
					</tr>
				<?php for($i=0;$i<count($list);$i++){
					 
				?>
					<tr>
						<td><?php echo $list[$i]["log_type"];?></td>
						<td><?php echo $list[$i]["date1"];?></td>
						<td><?php echo $list[$i]["log_title"];?></td>
						<td><?php 
						if($list[$i]["use_point"]>0){ 
							echo number_format($list[$i]["use_point"]);
						} 
						 ?>
						</td>
					</tr>
				<?php }
				if(count($list)==0){?>
					<tr><td colspan="4">포인트 사용내역이 없습니다.</td></tr>
				<?php }?>
				</table>
			</div>
		</div>
	</section>
</div>
<script>
    /*$(document).ready(function () {
        $("input[type=radio]").change(function(){
            var align_type = $(this).val();
            if(align_type == 1){
                $.ajax({
                    url:g5_url+"/page/ajax/ajax.point.php",
                    method:"POST",
                    data:{}
                }).done(function(data){
                    console.log(data)
                    $(".point_list").html(data);
                })
            }else if(align_type==2){

            }
        })
    })*/
</script>
<?php
include_once ("../../tail.php");
?>

