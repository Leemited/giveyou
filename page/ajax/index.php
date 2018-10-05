<?php
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];
if($wr_id==""){
	$sql = "select wr_id from `g5_write_main` where mb_id ='{$member[mb_id]}'";
	$wr = sql_fetch($sql);
	$wr_id = $wr["wr_id"];
}
$date = date("Y-m-d");
$order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and o.delivery_state != 3 and o.order_date like '%{$date}%' order by order_date desc ");
while($row = sql_fetch_array($order)){
    $list[] = $row;
}
$wr_subject = "주문현황";
$back_url=G5_URL."/page/shop/";
include_once ("../../head.php");

?>
<style>
    .order_list{background: #eee;}
    .order_list li{padding:10px; display: block;background: #fff;position:relative;border-bottom:1px solid #ddd;}
	.order_list li .order_title{font-size:17px;text-align: center; color:#000;font-weight:bold;margin-top:20px;}
    .order_list li .order_time{font-size:28px;text-align: center; color:#000;font-weight:bold}
    .order_list li .delay_time{font-size:12px;text-align: center; color:#000;padding:4px;}
	.order_list li .order_addr{font-size:14px;text-align:center;color:#000;padding:2px 0;margin-bottom:20px;}
    .order_list li .order_number{position: absolute;right:10px;top:10px}
    .order_list li .order_menu.first{border-top: 1px dashed #ddd}
    .order_list li .order_menu{border-bottom:1px dashed #ddd;padding:10px;position: relative}
    .order_list li .order_menu .menu_title{font-size:18px;}
    .order_list li .order_menu .menu_count{font-size:18px;position:absolute;right:10px;bottom:10px;}
    .order_list li .order_state {position:absolute;left:0;top:0;width:8px;height:100%;margin:0;background:#ddd;float:left;-webkit-border-radius:8px 0 0 8px;-moz-border-radius:8px 0 0 8px;border-radius:8px 0 0 8px;}
    .order_list li .order_tip{float:left;width:20%;margin-right:10px;}
    .order_list li .order_tip label{display:}
    .order_list li .order_tip i{width:10px;height:10px;display: inline-block;margin-right:5px;}
    .order_list li .order_tip i.o1{background: #fbbc3d;}
    .order_list li .order_tip i.o2{background: #00b0a2;}
    .order_list li .order_tip i.o3{background: #1f9bff;}
    .order_list li .order_total {padding:6px 0;font-size:18px;font-weight: bold;color:#cf1616;text-align: center}
    .order_list li .order_state.order_1{background: #fbbc3d}
    .order_list li .order_state.order_2{background: #00b0a2}
    .order_list li .order_state.order_3{background: #1f9bff}
    .order_list li .order_btn{padding:15px 0 10px 0; text-align: center;display:inline-block;}
    .order_list li .order_btn .order_state_btn{padding:5px 10px; background:#f17b3f;color:#fff;font-size: 14px;font-weight: bold;width:100px;}
    .order_list li .detail{padding:15px 0 10px 0;text-align:center;display:inline-block;}
    .order_list li .detail .order_detail_btn{padding:5px 10px; background:#474747;color:#fff;font-size: 14px;font-weight: bold;width:100px;}
	.order_list li .btn_groups{display:inline-block;width:100%;text-align:center;border-top:1px dashed #ddd}
</style>
<div class="width-fixed">
    <!-- <div class="sel-align">
        <div class="select-align">
            <input type="radio" name="align" id="loc" value="2">
            <label for="loc"><span class="radio">배달완료</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="hit" value="1">
            <label for="hit"><span class="radio">배달중</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="new" value="0">
            <label for="new" ><span class="radio">주문요청</span></label>
        </div>
    </div> -->
	<ul class="shop_li">
		<li onclick="fnorderlist('0')" class="active">접수대기</li>
		<li onclick="fnorderlist('1')">배달중</li>
		<li onclick="fnorderlist('2')">완료</li>
		<li onclick="location.href=g5_url+'/page/shop/main.php'">설정</li>	
	</ul>
	<div class="clear"></div>
    <section class="section01">
        <div class="order_list">
            <ul>
                <?php for($i=0;$i<count($list);$i++){
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
                    <div class="delay_time" ><?php echo $delayDay?> <span class="delay_real_time<?php echo $i;?>"><?php echo $delay;?></span></div>
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
							<input type="button" class="btn order_detail_btn" value="자세히보기" onclick="orderdetail('<?php echo $wr_id;?>','<?php echo $list[$i]["order_id"];?>');">
						</div>
						<div class="detail">
							<input type="button" class="btn order_detail_btn" value="주문접수" onclick="location.href=g5_url+'/page/shop/store_order_detail.php?wr_id=<?php echo $wr_id;?>&order_id=<?php echo $list[$i]["order_id"];?>'">
						</div>
						<!-- <div class="order_state <?php if($list[$i]["delivery_state"]==0){?>order_1<?php }else if($list[$i]["delivery_state"]==1){?>order_2<?php }else if($list[$i]["delivery_state"]==2){?>order_3<?php }?>"></div>
	 -->                    <div class="order_btn">
							<input type="submit" class="btn order_state_btn " value="배달시작">
						</div>
					</div>
                    </form>
                </li>
                <?php }

                if(count($list)==0){?>
                    <li class="no-order">오늘은 주문이 없습니다.</li>
                <?php }?>
            </ul>
        </div>
    </section>
</div>
<script>
    setInterval("dpTime()",1000);
    function dpTime() {
        $("input[id^=delay]").each(function(e){
            var startTime =  $("#delay"+e).val();
            // 시작일시
            var startDate = new Date(parseInt(startTime.substring(0,4), 10),
                parseInt(startTime.substring(4,6), 10)-1,
                parseInt(startTime.substring(6,8), 10),
                parseInt(startTime.substring(8,10), 10),
                parseInt(startTime.substring(10,12), 10),
                parseInt(startTime.substring(12,14), 10)
            );

            var endDate   = new Date();

            var dateGap = endDate.getTime() - startDate.getTime();
            var timeGap = new Date(endDate - startDate);

            //var diffDay  = dateGap / (1000 * 60 * 60 * 24); // 일수
            var diffHour = timeGap.getHours();       // 시간
            var diffMin  = timeGap.getMinutes();      // 분
			var diffSec  = timeGap.getSeconds();      // 분
            if(diffHour < 10){
                diffHour = "0" + diffHour;
            }
            if(diffMin < 10){
                diffMin = "0" + diffMin;
            }
			if(diffSec < 10){
				diffSec = "0" + diffSec;
			}
            $(".delay_real_time"+e).html(diffHour + "시 " + diffMin + "분 " + diffSec +"초");
        })
    }
    $(document).ready(function(){
        //정렬
        $("input[type=radio]").change(function(){
            var align_type = $(this).val();
            $.ajax({
                url:g5_url+"/page/ajax/ajax.order_list.php",
                method:"POST",
                data:{wr_id:<?php echo $wr_id?>,align_type:align_type}
            }).done(function (data) {
                //alert(data);
                $(".order_list ul").html(data);
            })
        });
    })
function orderdetail(wr_id,order_id){
	$.post(g5_url+"/page/shop/store_order_detail.php",{wr_id:wr_id,order_id:order_id},function(data){
		$(".modal").html(data);
		modal_active();
	});
}
function fnorderlist(type){
	
	$(".shop_li li").eq(type).addClass("active");
	$(".shop_li li").not($(".shop_li li").eq(type)).removeClass("active");
	
	$.ajax({
		url:g5_url+"/page/ajax/ajax.order_list.php",
		method:"POST",
		data:{wr_id:<?php echo $wr_id?>,align_type:type}
	}).done(function (data) {
		//alert(data);
		$(".order_list ul").html(data);
	})
}
</script>
<?php
include_once ("../../tail.php");
?>
