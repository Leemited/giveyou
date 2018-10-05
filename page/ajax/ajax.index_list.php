<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$rand = rand(0,4);
$index_title = array("죄송합니다. 아직 판매점이 많지 않네요.","지금은 준비중인 판매점이 없나봐요!!","판매 준비중입니다. 조금만 기다려주세요!", "지금 보는 화면이 현실일까요?" , "판매점을 불러오는 중... 로딩 0.00001%");

$loc = $_REQUEST["loc"];
$ca_name = $_REQUEST["ca_name"];
$order_type = $_REQUEST["order_type"];
$order = $_REQUEST["order"];
$searchTxt = $_REQUEST["searchTxt"];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
//print_r($lat."/".$lng."/");
//print_r($_REQUEST);
$where = " WHERE a.wr_is_comment=0 and wr_file != 0 and a.wr_6 = 'Y'";
if($loc){
    $where .= " and a.wr_10 like '%{$loc}%' or b.delivery_location like '%{$loc}%' or jibun_address like '%{$loc}%'";
}
if($ca_name){
    $where .= " and a.ca_name = '{$ca_name}'";
}
if($order_type){
    $where .= " and b.order_type like '%{$order_type}%'";
}
if($searchTxt){
    $where .= " and (a.wr_subject like '%{$searchTxt}%' or a.wr_content like '%{$searchTxt}%')";
}

if($order){
    switch ($order){
        case "1":
            $order = " order by a.wr_datetime";
            break;
        case "2":
            $order = " order by a.wr_hit";
            break;
        case "3":
            $order = " order by distance";
            break;
    }
}



if($lat && $lng){
	$sql = "select a.*, b.* ,  6371 * 2 * ATAN2(SQRT(POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat}))), SQRT(1 - POW(SIN(RADIANS({$lat} - b.latitude)/2), 2) + POW(SIN(RADIANS({$lng} - b.longitude)/2), 2) * COS(RADIANS(b.latitude)) * COS(RADIANS({$lat})))) AS distance  from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id {$where} {$order} ";
}else{
	$sql = "select a.*, b.* from g5_write_main as a left join store_detail as b on a.wr_id = b.wr_id {$where} {$order}";
}
$query=sql_query($sql);
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

for($i=0;$i<count($list);$i++){
    //$id=$list[$i]['model'];
    $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
    if($thumb['src']) {
        $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
    }
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

    $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");
    $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."&wr_subject=".$list[$i]['wr_subject']."'";
    
	$sqls = sql_query("select * from `store_menu` where wr_id=".$list[$i]['wr_id']);
	while($rows = sql_fetch_array($sqls)){
		$dis[] = $rows;
	}
	$discount = round(100- ($dis[0]["menu_price_discount"] / $dis[0]["menu_price"]) * 100);
	$discounttext = $discount."%";

	if($lat || $lng){
		$d_m = geoDistance($list[$i]["latitude"],$list[$i]["longitude"],$lat,$lng) * 1000;
	}
?> 
    <li data-cate="<?php echo $list[$i]['type']; ?>">
		<?php if($list[$i]["wr_7"]==1){?><img src="<?php echo G5_IMG_URL?>/ic_premium.png" alt="프리미엄" class="list_icon"><?php }?>
		<div <?php if($list[$i]["wr_5"]=="Y"){?>onclick="<?php echo $link; ?>"<?php }else{?>onclick="alert('영업준비중입니다.');"<?php }?> >
			<?php if($list[$i]['wr_5']=="N"){ ?>
				<div class="no_open"><div></div></div>
			<?php }?>
			<div class="img">
				<div class="icon"></div>
				<div class="gipoint" style=""><img src="<?php echo G5_IMG_URL?>/giview_point.png" alt="" class="giview"/>&nbsp;<span class="point">1,000</span></div>
				<div ><?php echo $img_content; ?></div>
			</div>
			<div class="txt">
				<h3><?php echo $list[$i]['wr_subject']; ?></h3>
				<?php if($discount != "0" && $discount != "100" ){?>
				<h4><span><strike><?php echo $dis[0]["menu_price"];?></strike></span>&nbsp;&nbsp;<img src="<?php echo G5_IMG_URL?>/list_arrow.png" alt="" class="arrow" />&nbsp;&nbsp;<span class="disc"><?php echo $dis[0]["menu_price_discount"];?></span></h4>
				<?php }else{?>
				<h4><span class="disc">가격정보 없음</span></h4>
				<?php }?>
				<!-- <h4><?php echo ($list[$i]['store_addr1'] && $list[$i]["store_add2"])?$list[$i]['store_addr1']." ".$list[$i]["store_add2"]:"주소정보 없음"; ?></h4> -->
				<!-- <p>영업시간  <?php echo ($list[$i]["open_time"] && $list[$i]["close_time"])?$list[$i]["open_time"]."~".$list[$i]["close_time"]:"영업시간 정보 없음"; ?></p> -->
				<p><?php echo ($list[$i]['delivery_price']!=0)?number_format($list[$i]['delivery_price'])."원 이상배달":"최소배달가격 정보없음"; ?></p>
				<p class="km"><span class="bg_yellow bold"><?php echo $rank?></span> | 거리 <?php echo distTran($d_m)?></p>
			</div>
		</div>
		<?php if($discount != "0" && $discount != "100" ){?>
			<a href="#"  class="discount"><?php echo $discounttext?></a>   
		<?php }?>
		<a href="tel:<?php echo $list[$i]['store_hp'];?>" class="btn call"></a>                               
	</li>  
<?php }if(count($list)==0){?>
    <li class="no-list" style=""><?php echo $index_title[$rand];?></li>
<?php }?>