<?php
include_once("../../common.php");
if(!$tab) {
	$back_url = G5_URL . "/index.php";
}else{
	$back_url = G5_REFERER_URL;
}
$title="위치정보 수정";
include_once(G5_PATH."/head.etc.php");
?>
<div class="width-fixed">
	<div class="addrsearch" style="min-height:60vw">
		<form name="form" id="form" method="post" action="<?php echo G5_URL?>/page/setting/location.php">
			<input type="hidden" name="currentPage" value="1"/>
			<input type="hidden" name="countPerPage" value="5"/>
			<input type="hidden" name="confmKey" value="U01TX0FVVEgyMDE4MDYyODIwNTU0MTEwNzk3MTI="/>
			<input type="text" class="searchAddr" name="keyword" id="keyword" value="" required  onkeyup="getAddrDelay()" placeholder="예)가경동"/>
			<!-- <input type="button" onClick="getAddr();" class="searchBtn" value=""/> -->
			<?php if($member["mb_1"] != ''){ ?>
			<h2>현재 등록 위치</h2>
			<div id="list2" class="now_loc">
				<table>
					<tr>
						<td><img src='<?php echo G5_IMG_URL; ?>/ic_addr_list.png'> <?php echo $member["mb_1"];?></td>
					</tr>
				</table>
			</div>
			<?php } ?>
			<h2>검색결과</h2>
			<div id="list" >
				
			</div><!-- 검색 결과 리스트 출력 영역 -->
		</form>
		<!-- <div class="map_Addr" onclick="fnMap();">
			<img src="<?php echo G5_IMG_URL?>/ic_addr_list.png" alt=""> 서비스 지역 보기
		</div> -->
	</div>
</div>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=lJdKVDD2UykKU2mvfhch&submodules=geocoder"></script>

<script language="javascript">
var connect = true;
function getAddrDelay(){
	if(connect == true){
		setTimeout(getAddr,500);
	}
}

function getAddr(){
	if($("#keyword").val().length > 1){
		$.ajax({
			 url :"http://www.juso.go.kr/addrlink/addrLinkApiJsonp.do"  //인터넷망
			,type:"post"
			,data:$("#form").serialize()
			,dataType:"jsonp"
			,crossDomain:true
			,success:function(xmlStr){
				if(navigator.appName.indexOf("Microsoft") > -1){
					var xmlData = new ActiveXObject("Microsoft.XMLDOM");
					xmlData.loadXML(xmlStr.returnXml)
				}else{
					var xmlData = xmlStr.returnXml;
				}
				$("#list").html("");
				var errCode = $(xmlData).find("errorCode").text();
				var errDesc = $(xmlData).find("errorMessage").text();
				if(errCode != "0"){
					alert(errCode+"="+errDesc);
				}else{
					if(xmlStr != null){
						makeList(xmlData);
					}
				}
			}
			,error: function(xhr,status, error){
				alert("에러발생");
			}
		});
		connect = false;
		setTimeout(resetConnect,1000);
	}
}

function resetConnect(){
	connect = true;
}


function makeList(xmlStr){
	console.log(xmlStr);
	var htmlStr = "";
	htmlStr += "<table>";
	$(xmlStr).find("juso").each(function(){
		htmlStr += "<tr onclick=\"fnAddAdr(\'"+$(this).find('roadAddrPart1').text()+"\',\'"+$(this).find('emdNm').text()+"\');\">";
		htmlStr += "<td><img src='"+g5_url+"/img/ic_addr_list.png'> "+$(this).find('roadAddrPart1').text()+"</td>";
		htmlStr += "</tr>";
	});
	htmlStr += "</table>";
	$("#list").html(htmlStr);
}

function enterSearch() {
	var evt_code = (window.netscape) ? ev.which : event.keyCode;
	if (evt_code == 13) {    
		event.keyCode = 0;  
		getAddr(); //jsonp사용시 enter검색 
	} 
}

function fnAddAdr(addr,addr2){
	console.log(addr2);
	if(confirm("이 위치로 등록 하시겠습니까?")){
		Addlatlng(addr,addr2);
		/*$.ajax({
			url:g5_url+"/page/ajax/ajax.mb_addr_update.php",
			method:"POST",
			data:{addr:addr,mb_id:"<?php echo $member[mb_id];?>"}
		}).done(function(data){
			alert(data);
			location.href=g5_url;
		});*/
	}
}

function Addlatlng(addr,addr2){
	var myaddress = addr;// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)
	naver.maps.Service.geocode({address: myaddress}, function(status, response) {
		if (status !== naver.maps.Service.Status.OK) {
			return alert(myaddress + '의 검색 결과가 없거나 기타 네트워크 에러');
		}
		var result = response.result;
		// 검색 결과 갯수: result.total
		// 첫번째 결과 결과 주소: result.items[0].address
		// 첫번째 검색 결과 좌표: result.items[0].point.y, result.items[0].point.x
        console.log(result);
		
		$.ajax({
			url:g5_url+"/page/ajax/ajax.mb_latlng_update.php",
			method:"POST",
			data:{lat:result.items[0].point.y,lng:result.items[0].point.x,mb_id:"<?php echo $member[mb_id];?>",addr:addr,addr2:addr2}
		}).done(function(data){
			console.log(data);
			alert(data);
			location.href=g5_url;
		}).error(function(e){
			console.log(e);
		});
	});
}
</script>		
<?php
include_once(G5_PATH."/tail.php");
?>