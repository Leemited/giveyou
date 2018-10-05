<!-- 본문 end -->
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

	<script type="text/javascript" src="<?php echo G5_JS_URL; ?>/jquery.accordion.js"></script><!--아코디언-->
	<script type="text/javascript">
		$('.accordion').accordion({
			"transitionSpeed": 400
		});
	</script>
	<script type="text/javascript" src="./smartEditor2/js/HuskyEZCreator.js" charset="utf-8"></script>
	<script type="text/javascript">
    var oEditors = [];
    $(document).ready(function(){
        nhn.husky.EZCreator.createInIFrame({
            oAppRef: oEditors,
            elPlaceHolder: "wr_content",
            sSkinURI: "./smartEditor2/SmartEditor2Skin.html",
            fCreator: "createSEditor2"
        });
    });
    function _onSubmit(elClicked){
    // 에디터의 내용을 에디터 생성시에 사용했던 textarea에 넣어 줍니다.
    oEditors.getById["wr_content"].exec("UPDATE_CONTENTS_FIELD", []);

    try{
        $("#notice_write").submit();
        }catch(e){
        alert(e);
        }  
    }

    // 우편번호 찾기 찾기 화면을 넣을 element
    var element_wrap = document.getElementById('search_addr');

    function foldDaumPostcode() {
        // iframe을 넣은 element를 안보이게 한다.
        element_wrap.style.display = 'none';
    }

    function DaumPostcode() {
        // 현재 scroll 위치를 저장해놓는다.
        var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
        new daum.Postcode({
            oncomplete: function(data) {
				console.log(data);
                // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullAddr = data.address; // 최종 주소 변수
                var extraAddr = ''; // 조합형 주소 변수

                // 기본 주소가 도로명 타입일때 조합한다.
                if(data.addressType === 'R'){
                    //법정동명이 있을 경우 추가한다.
                    if(data.bname !== ''){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있을 경우 추가한다.
                    if(data.buildingName !== ''){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
                    fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
                }
                var jibun="";
				if(data.autoJibunAddress!=""){
					jibun = data.autoJibunAddress;
				}else if(data.jibunAddress!=""){
					jibun = data.jibunAddress;
				}
				fnlatlng(jibun);

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
				if(data.zonecode){
					document.getElementById('sample2_postcode').value = data.zonecode; //5자리 새우편번호 사용
				}
				if(data.roadAddress){
					document.getElementById('sample2_address').value = data.roadAddress;
				}else{
					document.getElementById('sample2_postcode').value = data.postcode;
					document.getElementById('sample2_address').value = data.jibunAddress;
					if(document.getElementById('sample2_postcode3')) {
						document.getElementById('sample2_postcode3').value = data.postcode;
						document.getElementById('sample2_address3').value = data.jibunAddress;
					}
				}

                // iframe을 넣은 element를 안보이게 한다.
                // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                element_wrap.style.display = 'none';

                // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.
                document.body.scrollTop = currentScroll;
            },
            // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
            onresize : function(size) {
                element_wrap.style.height = size.height+'px';
            },
            width : '100%',
            height : '100%'
        }).embed(element_wrap);

        // iframe을 넣은 element를 보이게 한다.
        element_wrap.style.display = 'block';
    }
    </script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=c98e87699f92ad0673759ad55b12cc50&libraries=services"></script>

<script>
    /*
     $(function(){
     $("#postcodify_search_button").postcodifyPopUp();
     });
     */
    function fnlatlng(data){
        var geocoder = new daum.maps.services.Geocoder();

        // 주소로 좌표를 검색합니다
        geocoder.addressSearch(data, function(result, status) {

            // 정상적으로 검색이 완료됐으면
            if (status === daum.maps.services.Status.OK) {

                var coords = new daum.maps.LatLng(result[0].y, result[0].x);
                $("#lat").val(result[0].y.substr(0,9));
                $("#lng").val(result[0].x.substr(0,10));
            }
        });
    }
</script>