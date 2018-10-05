<?php
include_once("../common.php");

if($member["mb_level"]==5 || $type=="shop"){
    goto_url(G5_URL."/page/shop/index.php?type=shop");
}

$ca_name = $_REQUEST["ca_name"];
$searchTxt = $_REQUEST["searchTxt"];

if($ca_name){
    $where .= " and a.ca_name = '{$ca_name}' ";
}
if($searchTxt){
    $where .= " and (a.wr_subject like '%{$searchTxt}%' or a.wr_content like '%{$searchTxt}%') or a.ca_name like '%{$searchTxt}%' ";
}
if($member["mb_2"]){
	$addr = $member["mb_2"];
	$where .= " and (b.delivery_location like '%{$addr}%' or a.wr_subject like '%{$addr}%')";
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/head.php");

$rand = rand(0,4);
$index_title = array("죄송합니다. 아직 판매점이 많지 않네요.","지금은 준비중인 판매점이 없나봐요!!","판매 준비중입니다. 조금만 기다려주세요!", "지금 보는 화면이 현실일까요?" , "판매점을 불러오는 중... 로딩 0.00001%");
if($is_member){
	if($lat && $lng){
		$sql = "select a.*,a.wr_id as id, b.* , 6371 * 2 * ATAN2(SQRT(POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat}))), SQRT(1 - POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat})))) AS distance from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.mb_id ='admin' and a.wr_is_comment=0 and a.wr_file != 0  {$where} order by a.wr_7 desc, a.wr_1 asc, a.wr_5 desc";
		$query=sql_query($sql);
	}else{
		$sql = "select a.*,a.wr_id as id, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.mb_id ='admin' and a.wr_is_comment=0 and a.wr_file != 0  {$where} order by a.wr_7 desc, a.wr_1 asc, a.wr_5 desc";
		$query=sql_query($sql);
	}
}else{
	$sql = "select a.*,a.wr_id as id, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.mb_id ='admin' and a.wr_is_comment=0 and a.wr_file != 0  {$where} order by a.wr_7 desc, a.wr_1 asc, a.wr_5 desc";
    $query=sql_query($sql);
}
while($data=sql_fetch_array($query)){
    $list[]=$data;
}
// gps 거리 계산 
function _deg2rad($deg) { 
	$radians = 0.0; 
	$radians = $deg * M_PI/180.0; 
	return($radians); 
} 

function geoDistance($lat1, $lon1, $lat2, $lon2, $unit="k") { 
	$theta = $lon1 - $lon2; 
	$dist = sin(_deg2rad($lat1)) * sin(_deg2rad($lat2)) + cos(_deg2rad($lat1)) * cos(_deg2rad($lat2)) * cos(_deg2rad($theta)); 
	$dist = acos($dist); 
	$dist = rad2deg($dist); 
	$miles = $dist * 60 * 1.1515; 
	$unit = strtolower($unit); 

	if ($unit == "k") { 
		return ($miles * 1.609344); 
	} else { 
		return $miles; 
	} 
} 
//단위변경
function distTran($dist){
	$dist = round($dist);
	if(strlen($dist) == 4){
		$dist = substr($dist,0,2);
		$dist = preg_split('//', $dist, -1, PREG_SPLIT_NO_EMPTY); 
		$dist = $dist[0].".".$dist[1]."km";
	}else if(strlen($dist) == 5){
		$dist = substr($dist,0,3);
		$dist = preg_split('//', $dist, 3, PREG_SPLIT_NO_EMPTY); 
		$dist = $dist[0].$dist[1].".".$dist[2]."km";
	}else if(strlen($dist) == 6){
		$dist = substr($dist,0,4);
		$dist = preg_split('//', $dist, 4, PREG_SPLIT_NO_EMPTY); 
		$dist = $dist[0].$dist[1].$dist[2].".".$dist[3]."km";
	}else if(strlen($dist) <= 3){
		$dist = $dist."m";
	}
	return $dist;
}


$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_main` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3` = 'Y' order by wr_1 , wr_2 limit 0, 5 ";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
    $event_list[]=$event_data;
}

$banner_row=sql_query("select * from `best_partner` where `show` = 1 group by id desc");
while($data1=sql_fetch_array($banner_row)){
    $banner[] = $data1;
}

?>  

    <div class="width-fixed">
		<div class="cate">
			<ul>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=치킨&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_chiken.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=피자/돈까스&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_pizza.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=족발/보쌈&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_pork.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=한식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_korea.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=중식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_china.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=일식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_japan.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=패스트푸드&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_fastfood.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=디저트&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_desert.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=서비스&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_service.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=미용&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_buet.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=숙박&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_room.png" alt="" /></li>
				<li onclick="location.href='<?php echo G5_URL?>/page/matzip.php?ca_name=기타할인&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/mat_cate_etc.png" alt="" /></li>
			</ul>
		</div>
		<div class="clear"></div>
        <section class="section01">
            <div class="section01_content">
                <div class="rent_list">
                    <ul>
                        <?php
                        for($i=0;$i<count($list);$i++){
                            //$id=$list[$i]['model'];
                            $thumb = get_list_thumbnail("main", $list[$i]['id'], 800, 530);
                            if($thumb['src']) {
                                $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                            }

                            $link="javascript:location.href='".G5_URL."/page/rent/view2.php?wr_id=".$list[$i]['id']."&type=".$type."'";

                            $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['id']}'");

                            $even = $list[$i]['wr_comment'];
                            if($even==0){
                                $rank_total = $list[$i]["wr_4"];
								$rank = "★ 0";
                            }else {
                                $rank_total = ceil($list[$i]["wr_4"] / $list[$i]['wr_comment']);
								$rank = "★ ".cut_str($list[$i]["wr_4"] / $list[$i]['wr_comment'],3,'');
                            }
                            /*switch ($rank_total){
                                case "5":
                                    $rank = "★ ".cut_str($list[$i]["wr_4"] / $list[$i]['wr_comment'],3,'');
                                    break;
                                case "4":
                                    $rank = "★★★★☆";
                                    break;
                                case "3":
                                    $rank = "★★★☆☆";
                                    break;
                                case "2":
                                    $rank = "★★☆☆☆";
                                    break;
                                case "1":
                                    $rank = "★☆☆☆☆";
                                    break;
                                case "0":
                                    $rank = "☆☆☆☆☆";
                                    break;
								case "":
                                    $rank = "☆☆☆☆☆";
                                    break;
                            }*/

							/*$sqls = sql_query("select * from `store_menu` where wr_id=".$list[$i]['id']." order by id desc limit 0,2");
							while($rows = sql_fetch_array($sqls)){
								$dis[] = $rows;
							}*/
							$dis = explode("/",$list[$i]["wr_8"]);
							if($dis[1] > 0){
								$discount = round(100-($dis[1]/$dis[0]) * 100);
								$discounttext = $discount."%";
							}

							if($lat || $lng){
								$d_m = geoDistance($list[$i]["latitude"],$list[$i]["longitude"],$lat,$lng) * 1000;
							}
							$givePoint = sql_fetch("select mb_point from `g5_member` where mb_id='{$list[$i][mb_id]}'");
                            ?>
                            <li data-cate="<?php echo $list[$i]['type']; ?>">
                                <?php if($list[$i]["wr_7"]==1){?><img src="<?php echo G5_IMG_URL?>/ic_premium.png" alt="프리미엄" class="list_icon"><?php }?>
                                <div onclick="<?php echo $link;?>">
                                    <div class="img">
										<div class="icon"></div>
										<!-- <div class="gipoint" style=""><img src="<?php echo G5_IMG_URL?>/giview_point.png" alt="" class="giview"/>&nbsp;<span class="point"><?php echo number_format($givePoint);?></span></div> -->
                                        <div ><?php echo $img_content; ?></div>
                                    </div>
                                    <div class="txt">
                                        <h3><?php echo $list[$i]['wr_subject']; ?></h3>
										<?php if($discount){?>
										<h4><span><strike><?php echo "￦ ".number_format($dis[0]);?></strike></span>&nbsp;&nbsp;<img src="<?php echo G5_IMG_URL?>/list_arrow.png" alt="" class="arrow" />&nbsp;&nbsp;<?php if($dis[1]){?><span class="disc"><?php echo "￦ ".number_format($dis[1]);?></span><?php }else{?><span class="disc"><?php echo "￦ ".number_format($dis[0]);?></span><?php }?></h4>
										<?php }else{?>
											<h4><span class="disc"><?php echo "￦ ".number_format($dis[0]);?></span></h4>
										<?php }?>
                                        <h4><?php echo $list[$i]["subtitle"];?></h4>
<!--                                         <h4>--><?php //echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?><!--</h4> -->
<!--                                         <p>영업시간  --><?php //echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"영업시간 정보 없음"; ?><!--</p> -->
<!--                                        <p>--><?php //echo ($list[$i]['delivery_price']!=0)?number_format($list[$i]['delivery_price'])."원 이상배달":"최소배달가격 정보없음"; ?><!--</p>-->
                                        <p class="km"><span class="bg_yellow bold"><?php echo $rank?></span><?php if($mobile){?>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;거리 <?php echo distTran($d_m); }?> </p>
                                    </div>
                                </div>
								<?php if($discount){?>
								<a href="#"  class="discount" style="margin-top:4%"><?php if($discount != "0" && $discount != "100" ){ echo $discounttext; }else{ echo "0%";} ?></a>
								<?php }?>
<!--                                <a href="tel:--><?php //echo $list[$i]['store_hp'];?><!--" class="btn call"></a>-->
                            </li>                            
                            <?php 
							if($i % 10 == 0){
							?>
							<!-- <li class="video">
								<span>AD</span>
								<iframe src="https://player.vimeo.com/video/277395621?autoplay=1" width="640" height="480" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							</li> -->
							<?php
							}
							for($j=0;$j<count($banner);$j++){
								 $now_time = date('Y-m-d');
								$time_check = strtotime($now_time) - strtotime($banner[$j]['seq_time1']); //종료날짜 계산
								$total_time = $time_check; 
								$days = floor($total_time/86400);
								
								$time_check1 = strtotime($now_time) - strtotime($banner[$j]['seq_time']); //시작날짜 계산
								$total_time1 = $time_check1; 
								$days1 = floor($total_time1/86400); 

								if($banner[$j]['seq']-1 == $i && $banner[$j]['show']==1){ 
									if($days<=0 && $days1>=0){ ?>
										<div class="item"><img src="<?php echo G5_DATA_URL."/partner/".$banner[$j]['banner']; ?>" alt=""></div>
                            <?php	}else if($days>=0){                
										sql_query("update `banner_list` set `seq`='-1' where `id`='{$banner[$i]['id']}';");
									}
								}
							}?>
                            
                        <?php $discount='';unset($dis);}
                        if(count($list)==0){?>
                            <li class="no-list" style=""><?php echo $index_title[$rand];?></li>
                        <?php }?>
                    </ul>
                                     
                </div>
            </div>
        </section>
		<div class="top" style="position:fixed;bottom:10px;right:10px;z-index:90000" onclick="$('html, body').stop().animate( { scrollTop : 0 } ); ">
			
		</div>
    </div>
</div>
<script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
<script>
$(".owl-carousel").owlCarousel({
		autoplay:true,
		autoplayTimeout:5000,
		autoplaySpeed:2000,
		smartSpeed:2000,
		loop:true,
		dots:true,
		items:1
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".event ul li").each(function(e){
			$(this).click(function(){
				$(this).addClass("active");
				$(".event ul li").not($(this)).removeClass("active");
				if(e == 0){
					$(".events").css("display","block");
					$(".givemalls").css("display","none");
				}else if(e==1){
					$(".events").css("display","none");
					$(".givemalls").css("display","block");
				}
			});
		});

		//정렬
		$("input[type=radio]").change(function(){
			align_type = $(this).val();
			var lat = '<?php echo $lat; ?>';
			var lng = '<?php echo $lng; ?>'; 
			$.ajax({
				url:"<?php echo G5_URL?>/page/ajax/ajax.index_list.php",
				method:"POST",
				data: ({"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt,lat: lat, lng: lng}),
			}).done(function (data) {
					console.log(data);
				$(".rent_list ul").html(data);
				
			})
		})
	   
		try {
			var regId = window.android.getRegid();
			$.ajax({
				url: '<?php echo G5_URL?>/page/mypage/ajax.regId_insert.php',
				method: 'POST',
				data: {'regid': regId , 'mb_id':'<?php echo $member[mb_id]?>'}
			});
		} catch (err) {
			var regId = undefined;
			console.log(err);
		}
	});
</script>
<script type="text/javascript">
$(window).on("scroll",function(){
	var height = $(document).height();
	var scrollbar = $(this).height();
	var elryheight = height - scrollbar;
	
	if($(this).scrollTop() > 107){
		$("#header").css({"position":"relative","top":"0","max-width":"800px"});
		$("#footer").css({"bottom":"0"});
	}else if($(this).scrollTop() < 107){
		$("#header").css({"position":"relative","top":"initial"});
		$("#footer").css("bottom","-137px");
	}
	/*if(elryheight == $(this).scrollTop()){
		$("#footer").css({"height":"0","bottom":"-134px"});
	}else{
		$("#footer").css({"height":"134px"});
	}*/
	
});

$(document).ready(function(){
	$(".menu_r, .menu_l").css("opacity","0");
});
</script>
<?php
include_once(G5_PATH."/tail.php");
?>