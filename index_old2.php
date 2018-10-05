<?php
include_once("./common.php");

if($member["mb_level"]==5 || $type=="shop"){
    goto_url(G5_URL."/page/shop/index.php?type=shop");
}
$lat = $_REQUEST["lat"];
$lng = $_REQUEST["lng"];
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_PATH."/head.main.php");

$now=date("Y-m-d h:i:s");
$event_sql="SELECT * FROM  `g5_write_main` WHERE  `wr_1`<='$now' and `wr_2`>='$now' and `wr_3` = 'Y' order by wr_1 , wr_2 limit 0, 5 ";
$event_query=sql_query($event_sql);
while($event_data=sql_fetch_array($event_query)){
    $event_list[]=$event_data;
}

?>  
<script language="JavaScript">
  
function setCookie( name, value, expiredays ) { 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
}
function closePop(){ 
	//if ( document.pop_form.chkbox.checked ){ 
	setCookie( "maindiv", "done" , 1 ); 
	//} 
	modal_close();
}

window.onload = function(){
	if(getCookie("maindiv") == false){
		
	}else if(getCookie("maindiv") == "done"){
		
	}
}

function getCookie(cName) {
	cName = cName + '=';
	var cookieData = document.cookie;
	var start = cookieData.indexOf(cName);
	var cValue = '';
	if(start != -1){
	   start += cName.length;
	   var end = cookieData.indexOf(';', start);
	   if(end == -1)end = cookieData.length;
	   cValue = cookieData.substring(start, end);
	}
	return unescape(cValue);
}

  //-->  
</script>

<div class="width-fixed">
	<div class="owl-carousel" id="main_slide">
	<?php
	/*for($i=0;$i<count($event_list);$i++){
		$thumb = get_list_thumbnail("main", $event_list[$i]['wr_id'], 800, 530);
		if($thumb['src']) {
			$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
		}
		$even = $event_list[$i]['wr_comment'];
		if($even==0){
			$rank_total = $event_list[$i]["wr_4"];
		}else {
			$rank_total = ceil($event_list[$i]["wr_4"] / $event_list[$i]['wr_comment']);
		}
		
		if($img_content){*/
			?>
			<div class="item">
				<a href="<?php echo G5_URL."/page/rent/view.php?wr_id=".$event_list[$i]['wr_id']; ?>">
					<img src="<?php echo G5_IMG_URL?>/main_slide_sample.jpg" alt="">
				</a>
			</div>
			<div class="item">
				<a href="<?php echo G5_URL."/page/rent/view.php?wr_id=".$event_list[$i]['wr_id']; ?>">
					<img src="<?php echo G5_IMG_URL?>/main_slide_sample.jpg" alt="">
				</a>
			</div>
			<?php/*
		}
	}
	/*if(count($event_list)<=0){
		?>
		<div class="item"><img src="<?php echo G5_IMG_URL?>/no-image.jpg" alt="배너등록 유도 이미지"></div>
		<?php
	}*/
	?>
	</div>
	<div class="cate_grid">
		<ul>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=치킨&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_chiken.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=피자/돈까스&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_pizza.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=족발/보쌈&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_pork.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=한식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_korea.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=중식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_china.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=일식&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_japan.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=패스트푸드&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_fastfood.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=디저트&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_desert.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=서비스&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_service.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=미용&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_buet.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=숙박&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_room.png" alt="" /></li>
			<li onclick="location.href='<?php echo G5_URL?>/main.php?ca_name=기타할인&lat=<?php echo $lat;?>&lng=<?php echo $lng;?>'"><img src="<?php echo G5_IMG_URL?>/main_cate_etc.png" alt="" /></li>
		</ul>
	</div>
</div>

<script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
    <script>
	var owl1 = $("#main_slide");
    owl1.owlCarousel({
            autoplay:true,
            autoplayTimeout:5000,
            autoplaySpeed:2000,
            smartSpeed:2000,
			autoHeight:true,
            loop:true,
			navs:true,
            dots:true,
            items:1
        });
    </script>
<?php
include_once(G5_PATH."/tail.php");
?>