<?php
include_once("./common.php");

if($member["mb_level"] == 5 || $type=="shop"){
    goto_url(G5_URL."/page/shop/index.php?type=shop");
}

$ca_name = $_REQUEST["ca_name"];
$searchTxt = $_REQUEST["searchTxt"];
//착한가게 필터

if($ca_name){
    $where .= " and a.ca_name = '{$ca_name}' ";
}
if($searchTxt){
    $where .= " and (a.wr_subject like '%{$searchTxt}%' or a.wr_content like '%{$searchTxt}%') or a.ca_name like '%{$searchTxt}%' ";
}
if($member["mb_addr1"]){
	$addr = explode(" ",$member["mb_addr1"]);
	//$where .= " and a.wr_subject like '%{$addr[2]}%' ";
}

include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/head.php");

$rand = rand(0,4);
$index_title = array("죄송합니다. 아직 판매점이 많지 않네요.","지금은 준비중인 판매점이 없나봐요!!","판매 준비중입니다. 조금만 기다려주세요!", "지금 보는 화면이 현실일까요?" , "판매점을 불러오는 중... 로딩 0.00001%");
if($lat && $lng){
	$sql = "select a.*, b.* , 6371 * 2 * ATAN2(SQRT(POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat}))), SQRT(1 - POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat})))) AS distance from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.mb_id !='admin' and a.wr_is_comment=0 and a.wr_file != 0 and a.wr_6 = 'Y' {$where} order by a.wr_7 desc, a.wr_1 asc, a.wr_5 desc";
    $query=sql_query($sql);
}else{
	$sql = "select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id where a.mb_id !='admin' and a.wr_is_comment=0 and a.wr_file != 0 and a.wr_6 = 'Y' {$where} order by a.wr_7 desc, a.wr_1 asc, a.wr_5 desc";
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
		<div class="clear"></div>
        <div class="kind">
            <div class="owl-carousel">
            <?php
            for($i=0;$i<count($banner);$i++){
				$link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$banner[$i]['tel']."&type=".$type."'";
                if($banner[$i]["banner"]){
                    ?>
                    <div class="item" onclick="<?php echo $link;?>">
						<div class="title">착한가게</div>
						<div class="con">
							<h2><?php echo $banner[$i]["name"];?></h2>
							<p><?php echo $banner[$i]["content"];?></p>
						</div>

							<img src="<?php echo G5_DATA_URL."/partner/".$banner[$i]["banner"]; ?>" alt="" />
                            <!-- <div class="rank-block" >
                                <p class="rank"><?php echo $rank?><span style="float: right;"><?php echo $event_list[$i]["wr_subject"]?></span></p>
                            </div> -->

                    </div>
                    <?php
                }
            }
            if(count($banner)<=0){
                ?>
                <div class="item"><img src="<?php echo G5_IMG_URL?>/no-image.jpg" alt="배너등록 유도 이미지"></div>
                <?php
            }
            ?>
            </div>
        </div>

        <div class="give">
            <div class="">
                <?
                $sql = "select * from `g5_write_givemonth` order by wr_datetime desc limit 0, 1";
                $angel = sql_fetch($sql);
                //$angelimg = get_file("givemonth",$angel["wr_id"]);
                ?>
                <div class="item" onclick="location.href='<?php echo G5_URL?>/page/gives.php?mm=3'">
                    <div class="title">기부천사</div>
                    <div class="con">
                        <h2><?php echo $angel["wr_subject"];?></h2>
                        <p><?php echo $angel["wr_content"];?></p>
                    </div>
                    <img src="<?php echo G5_IMG_URL; ?>/angel_sample.jpg" alt="">
                </div>
            </div>
        </div>
        
        <div class="clear"></div>
		<div class="event">
			<ul>
				<li class="active">이벤트</li>
				<li >기뷰몰</li>
			</ul>
			<div class="events">
				<div class="item" onclick="location.href=g5_url+'/page/inquiry/'"><img src="<?php echo G5_IMG_URL?>/sample_event.jpg" alt=""></div>
			</div>
			<div class="givemalls">
				<div class="item"><img src="<?php echo G5_IMG_URL?>/sample_event2.jpg" alt=""></div>
			</div>
		</div>
        <section class="section01">
            <div class="section01_content">
                <div class="rent_list index_rent_list">
                    <ul>
                        <?php
                        for($i=0;$i<count($list);$i++){
                            //$id=$list[$i]['model'];
                            $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
                            if($thumb['src']!="") {
                                $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                            }else{
								$img_content = '<img src="'.G5_IMG_URL.'/no-img.jpg" alt="'.$thumb['alt'].'">';
							}
							if($list[$i]["wr_9"]=="1"){
								$link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."'";
							}else{
								$link="javascript:location.href='".G5_URL."/page/rent/view2.php?wr_id=".$list[$i]['wr_id']."&type=".$type."'";
							}

                            $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");

                            $even = $list[$i]['wr_comment'];
                            if($even==0){
                                $rank_total = $list[$i]["wr_4"];
                            }else {
                                $rank_total = ceil($list[$i]["wr_4"] / $list[$i]['wr_comment']);
                            }
                            switch ($rank_total){
                                case "5":
                                    $rank = "★★★★★";
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
                            }

							$sqls = sql_query("select * from `store_menu` where wr_id=".$list[$i]['wr_id']." order by id desc limit 0,2");
							while($rows = sql_fetch_array($sqls)){
								$dis[] = $rows;
							}
							if($dis[0]["menu_price_discount"]>0){
								$discount = round(100- ($dis[0]["menu_price_discount"] / $dis[0]["menu_price"]) * 100);
								$discounttext = $discount."%";
							}

							if($lat && $lng && $list[$i]["latitude"] && $list[$i]["longitude"]){
								$d_m = geoDistance($list[$i]["latitude"],$list[$i]["longitude"],$lat,$lng) * 1000;
							}else{
								$d_m = "거리정보 없음";
							}

							$givePoint = sql_fetch("select mb_point from `g5_member` where mb_id='{$list[$i][mb_id]}'");
                            ?>
                            <li data-cate="<?php echo $list[$i]['type']; ?>">
                                <?php if($list[$i]["wr_7"]==1){ ?><img src="<?php echo G5_IMG_URL; ?>/ic_premium.png" alt="프리미엄" class="list_icon"><?php } ?>
                                <div <?php if($list[$i]["wr_5"]=="Y"){?>onclick="<?php echo $link; ?>"<?php }else{?>onclick="alert('영업준비중입니다.');"<?php } ?> >
                                    <?php if($list[$i]['wr_5']=="N"){ ?>
                                        <div class="no_open"><div></div></div>
                                    <?php }?>
                                    <div class="img">
										<div class="icon"></div>
										<div class="gipoint" style=""><img src="<?php echo G5_IMG_URL?>/giview_point.png" alt="" class="giview"/>&nbsp;<span class="point"><?php echo number_format($givePoint["mb_point"]);?></span></div>
                                        <div ><?php echo $img_content; ?></div>
                                    </div>
                                    <div class="txt">
                                        <h3><?php echo $list[$i]['wr_subject']; ?></h3>
										<?php if($discount){										?>
										<h4><span><strike><?php echo "￦ ".number_format($dis[0]["menu_price"]);?></strike></span>&nbsp;&nbsp;<img src="<?php echo G5_IMG_URL?>/list_arrow.png" alt="" class="arrow" />&nbsp;&nbsp;<?php if($dis[0]["menu_price_discount"]){?><span class="disc"><?php echo "￦ ".number_format($dis[0]["menu_price_discount"]);?></span><?php }else{?><span class="disc"><?php echo "￦ ".number_format($dis[0]["menu_price"]);?></span><?php }?></h4>
										<?php }else{?>
										<h4><span class="disc"><?php echo "￦ ".number_format($dis[0]["menu_price"]);?></span></h4>
										<?php }?>
                                        <!-- <h4><?php echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?></h4> -->
                                        <!-- <p>영업시간  <?php echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"영업시간 정보 없음"; ?></p> -->
                                        <p><?php echo ($list[$i]['delivery_price']!=0)?number_format($list[$i]['delivery_price'])."원 이상배달":"최소배달가격 정보없음"; ?></p>
                                        <p class="km"><span class="bg_yellow bold"><?php echo $rank?></span>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;거리 <?php echo distTran($d_m); ?> </p>
                                    </div>
                                </div>
								<!-- <a href="#"  class="discount"><?php if($discount != "0" && $discount != "100" ){ echo $discounttext; }else{ echo "0%";} ?></a>
                                <a href="tel:<?php echo $list[$i]['store_hp'];?>" class="btn call"></a> -->
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

                        <?php $discount='';unset($dis);
							$thumb = "";
						}
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