<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	if(!$type){
		$type="short";
	}
$gopa_tel=sql_fetch("select * from `gopa_tel`");
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>오시는 길</h1>
			</header>
		</section>
		<input type="hidden" name="addr1" id="addr1" value="<?php echo $branch_list[0]['addr1']; ?>" />
		<input type="hidden" name="name" id="name" value="<?php echo $branch_list[0]['name']; ?>" />
		<input type="hidden" name="tel" id="tel" value="<?php echo $branch_list[0]['tel']; ?>" />
        <div id="map" class="maps" style="height:500px;"></div>
		<div class="map_txt">
			<h4><div></div>기뷰</h4>
			<address><?php echo $gopa_tel['addr']; ?></address>
			<div class="contect">
				<div><span>TEL</span><?php echo ($gopa_tel['tel']); ?></div>
				<?php if($gopa_tel['fax']){ ?><div><span>FAX</span><?php echo $gopa_tel['fax']; ?></div><?php } ?>
			</div>
		</div>

	</div>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=lJdKVDD2UykKU2mvfhch&submodules=geocoder"></script>
    <script>
        $("#map").css("height", "500px");

        var map = new naver.maps.Map('map');
        var myaddress = '<?php echo $gopa_tel['addr']?>';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
        naver.maps.Service.geocode({address: myaddress}, function(status, response) {
            if (status !== naver.maps.Service.Status.OK) {
                return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
            }
            var result = response.result;
            // 검색 결과 갯수: result.total
            // 첫번째 결과 결과 주소: result.items[0].address
            // 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
            var myaddr = new naver.maps.Point(result.items[0].point.x, result.items[0].point.y);
            map.setCenter(myaddr); // 검색된 좌표로 지도 이동
            // 마커 표시
            map.setZoom(13);
            var marker = new naver.maps.Marker({
                position: myaddr,
                map: map,
            });
            // 마커 클릭 이벤트 처리
            naver.maps.Event.addListener(marker, "click", function(e) {
                if (infowindow.getMap()) {
                    infowindow.close();
                } else {
                    infowindow.open(map, marker);
                }
            });
        });
	</script>
<?php
	include_once(G5_PATH."/tail.php");
?>