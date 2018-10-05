<?php
include_once("../../common.php");
$addr = $_REQUEST["addr"];
if($addr){
	$back_url=G5_URL."/page/rent/view.php?wr_id={$wr_id}&wr_subject={$wr_subject}";
}else{
	$addr = $member["mb_addr1"];
	$back_url=G5_URL;
}
include_once(G5_PATH."/head.php");

?>
    <style>
        #map {
            position: absolute;
            top:0;
            width:100%;
            margin:0;
            padding:0;
        }
    </style>
    <div id="map"></div>
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=lJdKVDD2UykKU2mvfhch&submodules=geocoder"></script>
    <script>
        var height = window.innerHeight;
        var header = $("#header").height();
        $("#map").css("height", height-header);

        var map = new naver.maps.Map('map');
        var myaddress = '<?php echo $addr?>';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
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