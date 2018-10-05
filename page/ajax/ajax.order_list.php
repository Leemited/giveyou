<?php
include_once ("../../common.php");

$align_type = $_REQUEST["align_type"];
$wr_id = $_REQUEST["wr_id"];
$date = date("Y-m-d");
$order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and o.delivery_state = '{$align_type}' and o.delivery_state != 3 and o.order_date like '%{$date}%' order by order_date desc ");
while($row = sql_fetch_array($order)){
    $list[] = $row;
}
for($i=0;$i<count($list);$i++){
	$date = explode(" ", $list[$i]["order_date"]);
	$menu = explode(",", $list[$i]["order_menu"]);
	$menu_count = explode(",", $list[$i]["order_count"]);
	$option = explode(",", $list[$i]["order_option"]);
	$option_price = explode(",", $list[$i]["order_option_price"]);
	$nowTime = date("Y-m-d H:i:s");
	//주문 지연시간
	$delayTime = strtotime($nowTime) - strtotime($list[$i]["order_date"]) ;
	$delayDay = date("d일",$delayTime);
	$delay = date("H시 i분",$delayTime);
	$price = explode(",",$list[$i]["order_price"]);
	for($p=0;$p<count($price);$p++){
		$total += $price[$p];
	}
?>
    <li class="order_list_item" >
		<form action="<?php echo G5_URL?>/page/shop/order_state_update.php" method="post">
		<input type="hidden" value="<?php echo $list[$i]['order_id'];?>" name="order_id">
		<input type="hidden" value="<?php echo $wr_id ;?>" name="wr_id">
		<input type="hidden" value="<?php echo $list[$i]['delivery_state'];?>" name="delivery_state">
		<input type="hidden" value="<?php echo date("YmdHis",strtotime($list[$i]["order_date"]))?>" id="delay<?php echo $i;?>">
		<div class="order_date"><?php echo $date[0];?></div>
		<div class="order_number"><?php echo $list[$i]["order_number"];?></div>
		<div class="order_title">주문시간</div>
		<div class="order_time"><?php echo $date[1];?></div>
		<div class="delay_time" ><span class="delay_real_time<?php echo $i;?>"><?php echo $delay;?></span></div>
		<div class="order_addr"><?php echo $list[$i]["order_recive_addr1"];?></div>
		<!-- <?php for($j=0;$j<count($menu);$j++){?>
			<div class="order_menu <?php if($j==0){?>first<?php }?>" >
				<div class="menu_title"><?php echo $menu[$j];?><?php if($option[$j]!=""){ echo "(".$option[$j].")"; }?></div>
				<div class="menu_count"><?php echo $menu_count[$j];?> 개</div>
			</div>
		<?php }?> -->
		<!-- <div class="order_total">결제 금액 : <?php echo number_format($total);?> 원</div>
		<div class="order_total">기부 금액 : <?php echo number_format($total);?> 원</div>
		<div class="order_total">기뷰 수수료 : <?php echo number_format($total);?> 원</div>
		<div class="order_total">정산 금액 : <?php echo number_format($total);?> 원</div> -->
		<div class="btn_groups">
			<div class="detail">
				<input type="button" class="btn order_detail_btn" value="자세히보기" onclick="location.href=g5_url+'/page/shop/store_order_detail.php?wr_id=<?php echo $wr_id;?>&order_id=<?php echo $list[$i]["order_id"];?>'">
			</div>
			<div class="detail">
				<input type="button" class="btn order_detail_btn" value="주문접수" onclick="fnOrder('<?php echo $wr_id;?>','<?php echo $list[$i]["order_id"];?>')">
			</div>
            <div class="order_btn">
				<input type="submit" class="btn order_state_btn " value="배달시작">
			</div>
		</div>
		</form>
	</li>
<?php }
if(count($list)==0){?>
    <li class="no-order">검색된 주문이 없습니다.</li>
<?php }?>

<script>
    setInterval("dpTime()",1000);

</script>
