<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 사용자가 지정한 tail.sub.php 파일이 있다면 include
if(defined('G5_TAIL_SUB_FILE') && is_file(G5_PATH.'/'.G5_TAIL_SUB_FILE)) {
    include_once(G5_PATH.'/'.G5_TAIL_SUB_FILE);
    return;
}
?>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

<script type="text/javascript">
    var align_type="", loc = "", ca_name = "", order_type = "",searchTxt='';

    function fnBack(url) {
        location.href = url;
    }
    function moveLink(link,etc) {
        if(link=="map") {
            location.href = "<?php echo G5_URL?>" + "/page/rent/" + link + ".php?wr_id=<?php echo $view['wr_id']?>&addr=" + etc;
        }else if(link=="cart"){
            location.href = "<?php echo G5_URL?>" + "/page/mypage/cart.php?wr_id="+etc;
        }else if(link=="main"){
            location.href = "<?php echo G5_URL?>";
        }else if(link=="view"){
            location.href = "<?php echo G5_URL?>" + "/page/rent/view.php?wr_id=" + etc;
        }
    }
    function fnSearch(){
        searchTxt = $(".searchTxt").val();
        $.ajax({
            url:"<?php echo G5_URL?>/page/ajax/ajax.index_list.php",
            method:"POST",
            data:{"loc" : loc, "order":align_type , "ca_name": ca_name, "order_type" : order_type , "searchTxt" : searchTxt, "lat": lat,"lng":lng}
        }).done(function (data) {
            $(".rent_list ul").html(data);
        });
    }
    $(document).ready(function(){
        var headers = ["H1","H2","H3","H4","H5","H6","IMG"];

        $(".accordion").click(function(e) {
            var target = e.target,
                name = target.nodeName.toUpperCase();

            if($.inArray(name,headers) > -1) {
                if(name=="IMG"){
                    var subItem = $(target).parent().next();
                }else{
                    var subItem = $(target).next();
                }
                //slideUp all elements (except target) at current depth or greater
                if(subItem.attr("class") && subItem.attr("class")!= "line" && subItem.attr("class") != "price") {
                    var depth = $(subItem).parents().length;
                    var allAtDepth = $(".accordion p, .accordion div .accordion ul").filter(function () {
                        if ($(this).parents().length >= depth && this !== subItem.get(0)) {
                            return true;
                        }
                    });
                    $(allAtDepth).slideUp("fast");
                    //slideToggle target content and adjust bottom border if necessary
                    subItem.slideToggle("fast", function () {
                        //$(".accordion :visible:last").css("border-radius","0 0 10px 10px");
                    });
                }
            }
        });

        $(".loc.harf-first").click(function(){
            $(".opened-for-codepen.harf-first").slideUp("fast");
            $("#order_cate").slideUp("fast");
        });
        $(".harf-first.center-acc").click(function(){
            $(".opened-for-codepen.harf").slideUp("fast");
            $("#order_cate").slideUp("fast");
        });
        $("#ordertypes").click(function(){
            $("#location_cate").slideUp("fast");
            $(".opened-for-codepen.harf-first").slideUp("fast");
        });

    })

    Number.prototype.format = function(){
        if(this==0) return 0;

        var reg = /(^[+-]?\d+)(\d{3})/;
        var n = (this + '');

        while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');

        return n;
    };

    // 문자열 타입에서 쓸 수 있도록 format() 함수 추가
    String.prototype.format = function(){
        var num = parseFloat(this);
        if( isNaN(num) ) return "0";

        return num.format();
    };

    //주소검색 api

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

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample2_postcode').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('sample2_address').value = data.roadAddress;
                if(document.getElementById('sample2_postcode3')) {
                    document.getElementById('sample2_postcode3').value = data.postcode;
                    document.getElementById('sample2_address3').value = data.jibunAddress;
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

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다. ?>