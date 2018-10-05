<?php
include_once("../../common.php");
if(!$tab) {
    $back_url = G5_URL . "/index.php";
}else{
    $back_url = G5_REFERER_URL;
}

$bo_table="main";
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");

$banner_row=sql_query("select * from `best_partner`");

$cmt=sql_query("select a.*,b.*,a.wr_name as name from `g5_write_main` as a left join `g5_member` as b on a.wr_name = b.mb_name and a.mb_id = b.mb_id where a.wr_is_comment=1 and a.wr_parent ='{$wr_id}' ");

$fav=sql_fetch("select id from `mypage_favorite` where mb_id = st{$member['mb_no']} and wr_id = {$wr_id}");

$cate = sql_query("select ca_name from `store_menu` where wr_id = {$wr_id} GROUP by ca_name order by ca_name  ");
while($row = sql_fetch_array($cate)){
    $cate_name[] = $row;
}
$menu=sql_query("select * from `store_menu` where wr_id='{$wr_id}'");
while($row = sql_fetch_array($menu)){
    $menus[] = $row;
}

$file = get_file("main", $wr_id);
$even = $view['wr_comment'];
if($even==0){
    $rank_total = $view["wr_4"];
}else {
    $rank_total = ceil($view["wr_4"] / $even);
}
switch ( $rank_total){
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
}
$wr_subject=$view["wr_subject"];
include_once(G5_PATH."/head.php");

?>

    <div class="width-fixed view">
        <section class="section01 <?php if($view['wr_7']!=1){?> padding_b_30 <?php }else{?> padding_b_10<?php }?>" id="view_section">
            <?php if($file["count"]>1) {?>
                <div id="view-slide" class="owl-carousel">
                    <?php for ($i = 1; $i < count($file) - 1; $i++) { ?>
                        <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[$i]['file']; ?>" alt=""></div>
                    <?php }?>
                </div>
            <?php }else{?>
                <div id="view-slide" style="height:auto;text-align: center">
                    <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[0]['file']; ?>" alt="" ></div>
                </div>
            <?php }?>
            <div class="section01_content">
                <div>
                    <h1><?php echo $view["wr_subject"];?></h1>
                    <p><?php echo $view["ca_name"];?></p>
                    <span><?php echo $rank;?></span><span class="score"></span>
                </div>

            </div>
        </section>

        <?php if($view['wr_7']!=1){?>
            <section class="section01" id="view_section_menu">
                <div class="accordion">
                    <?php
                    for($i=0; $i < count($cate_name); $i++){
                        ?>
                        <h1><?php echo $cate_name[$i]["ca_name"]?> <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                        <ul class="opened-for-codepen" >
                            <?php
                            for($j=0;$j<count($menus);$j++){
                                if($cate_name[$i]["ca_name"]==$menus[$j]["ca_name"]){
                                    ?>
                                    <li class="item" style="background-color:#fff;text-align: left;position:relative;padding:5px 0;">
                                        <input type="hidden" id="menu_id" value="<?php echo $menus[$j]["id"]?>">
                                        <h2 style="text-align:left;border-bottom:none;padding-left:10px;" id="menu_title"><?php echo $menus[$j]["menu_name"]?></h2>
                                        <?php if($menus[$j]["menu_detail"]){ echo "<label style='font-size: 12px;color: #555;font-weight: normal;position: relative;left: 10px;top: -13px;'>".$menus[$j]["menu_detail"]."</label>" ; }?>
                                        <label for="menu_title" style="position: absolute;right:10px;top:19px;" class="price"><?php echo number_format($menus[$j]["menu_price"])?> 원</label>
                                    </li>
                                <?php }
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </section>
        <?php }else{ ?>
        <section class="section01" id="view_section_menu">
            <ul class="accordion">
                <?php
                for($i=0; $i < count($cate_name); $i++){
                    ?>
                    <h1><?php echo $cate_name[$i]["ca_name"]?> <img src="<?php echo G5_IMG_URL; ?>/arrow.png" alt="select-arrow"></h1>
                    <ul class="opened-for-codepen" style="display:block;">
                        <?php

                        for($j=0;$j<count($menus);$j++){
                            if($cate_name[$i]["ca_name"]==$menus[$j]["ca_name"]){
                                ?>
                                <li class="item" style="background-color:#fff;text-align: left;position:relative;padding:5px 0;min-height:60px">
                                    <input type="hidden" id="menu_id" value="<?php echo $menus[$j]["id"]?>">
                                    <div style="width:90px;padding:0 5px;position: absolute;left:0;height:60px;display: block">
                                        <?php if($menus[$j]["menu_image"]==""){?>
                                            <img src="../../img/no-img.jpg" alt="" style="height: 100%;text-align: center;display: block;">
                                        <?php }else{ ?>
                                            <img src="<?php echo G5_DATA_URL?>/shop/menu/<?php echo $menus[$j]["menu_image"];?>" alt="<?php echo $menus[$j]["menu_name"]?>" style="height: 100%;text-align: center;display: block;">
                                        <?php }?>
                                    </div>
                                    <h2 style="text-align:left;border-bottom:none;padding:9px 0px 9px 100px;" id="menu_title"><?php echo $menus[$j]["menu_name"]?></h2>
                                    <?php if($menus[$j]["menu_detail"]){ echo "<span style='font-size: 12px;color: #555;font-weight: normal;position: relative;left: 100px;top: -6px;'>".$menus[$j]["menu_detail"]."</span>" ; }?>
                                    <label for="menu_title" style="position: absolute;right:10px;top:14px;" class="price"><?php echo number_format($menus[$j]["menu_price"])?> 원</label>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
    </div>
    <div class="clear"></div>
    </section>
<?php } ?>

    <section class="section01" id="view_section">

        <div class="section01_header">
            <div><h2>리뷰</h2></div>
        </div>
        <div class="section01_content">
            <input type="button" value="리뷰 블라인드 처리 기준을 확인해주세요" class="review_info_btn" onclick="fnReviewGuide();">
            <?php if($is_member){?>
                <div class="user">
                    <img src="<?php if($member["mb_sex"] == "남"){ echo G5_IMG_URL."/mypage_man_icon.png";}else{ echo G5_IMG_URL."/mypage_woman_icon.png";} ?>" alt="" id="userIcon"><label for="userIcon"><?php echo $member["mb_name"];?></label>
                </div>
                <div id="bo_vc_w">
                    <form name="fviewcomment" action="<?php echo G5_BBS_URL."/write_comment_update.php";?>" onsubmit="return fviewcomment_submit(this);" method="post" autocomplete="off">
                        <input type="hidden" name="w" value="c" id="w">
                        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
                        <input type="hidden" name="comment_id" value="<?php echo $c_id ?>" id="comment_id">
                        <input type="hidden" name="sca" value="<?php echo $sca ?>">
                        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
                        <input type="hidden" name="stx" value="<?php echo $stx ?>">
                        <input type="hidden" name="spt" value="<?php echo $spt ?>">
                        <input type="hidden" name="page" value="<?php echo $page ?>">
                        <input type="hidden" name="is_good" value="">
                        <input type="hidden" name="wr_name" value="<?php echo $member["mb_name"];?>">
                        <div class="rank">
                            <select name="wr_4" id="wr_4" >
                                <option value="5">★★★★★</option>
                                <option value="4">★★★★☆</option>
                                <option value="3">★★★☆☆</option>
                                <option value="2">★★☆☆☆</option>
                                <option value="1">★☆☆☆☆</option>
                                <option value="0">☆☆☆☆☆</option>
                            </select>
                        </div>
                        <div class="tbl_frm01 tbl_wrap">
                            <table>
                                <tbody>
                                <tr>
                                    <td>
                                        <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
                                        <textarea id="wr_content" name="wr_content" maxlength="10000" required class="required" title="내용"
                                                  <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content;  ?></textarea>
                                        <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
                                        <script>
                                            $("textarea#wr_content[maxlength]").live("keyup change", function() {
                                                var str = $(this).val()
                                                var mx = parseInt($(this).attr("maxlength"))
                                                if (str.length > mx) {
                                                    $(this).val(str.substr(0, mx));
                                                    return false;
                                                }
                                            });
                                        </script>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="btn_confirm">
                            <input type="submit" id="btn_submit" class="btn_submit" value="리뷰작성">
                        </div>
                    </form>
                </div>
            <?php }?>
            <div class="reply_view">
                <?php
                for($i=0;$row=sql_fetch_array($cmt);$i++){
                    switch ($row["wr_4"]){
                        case "5":
                            $reply_rank = "★★★★★";
                            break;
                        case "4":
                            $reply_rank = "★★★★☆";
                            break;
                        case "3":
                            $reply_rank = "★★★☆☆";
                            break;
                        case "2":
                            $reply_rank = "★★☆☆☆";
                            break;
                        case "1":
                            $reply_rank = "★☆☆☆☆";
                            break;
                        case "0":
                            $reply_rank = "☆☆☆☆☆";
                            break;
                    }

                    ?>
                    <div class="reply <?php if($i==0){ echo "first";}?>">
                        <div class="reply_content">
                            <img src="<?php if($row["mb_sex"] == "남"){ echo G5_IMG_URL."/mypage_man_icon.png";}else{ echo G5_IMG_URL."/mypage_woman_icon.png";} ?>" alt="" id="userIcon"><label
                                    for="userIcon"><?php echo $row["name"]?></label>
                            <div><span><?php echo $reply_rank;?></span></div>
                            <p><?php echo $row['wr_content']; ?></p>
                            <!--<div class="reply_edit">
                                    <a href="<?/*=G5_URL*/?>/page/rent/view.php?bo_table=main&wr_id=<?/*=$wr_id*/?>&c_id=<?/*=$cmt['wr_id']*/?>&w=cu#bo_vc_w" onclick="comment_box('<?/*=$wr_id*/?>', 'cu')">수정</a> | 삭제
                                </div>-->
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <section class="section01" id="view_section_info">
        <div class="section01_header">
            <div><h2>찾아오는길</h2><span><a href="javascript:moveLink('map','<?php echo $view['store_addr1']?>')">크게보기 ></a></span></div>
        </div>
        <div class="section01_content">
            <div id="map" class="maps"></div>
        </div>
        <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=lJdKVDD2UykKU2mvfhch&submodules=geocoder"></script>
        <script>
            $("#map").css("height", "200px");

            var map = new naver.maps.Map('map');
            var myaddress = '<?php echo $view['store_addr1']?>';// 도로명 주소나 지번 주소만 가능 (건물명 불가!!!!)

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

                map.setOptions({ //지도 인터랙션 끄기
                    draggable: false,
                    pinchZoom: false,
                    scrollWheel: false,
                    keyboardShortcuts: false,
                    disableDoubleTapZoom: true,
                    disableDoubleClickZoom: true,
                    disableTwoFingerTapZoom: true
                });

                var marker = new naver.maps.Marker({
                    position: myaddr,
                    map: map,
                });

                // 마커 클릭 이벤트 처리
                /*naver.maps.Event.addListener(marker, "click", function(e) {
                 if (infowindow.getMap()) {
                 infowindow.close();
                 } else {
                 infowindow.open(map, marker);
                 }
                 }); */

            });

        </script>
    </section>
    <section class="section01" id="view_section_info">
        <div class="section01_header">
            <div><h2>매장정보</h2><span><a href="<?php echo G5_URL?>/page/rent/view_detail.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $wr_subject?>">더보기 ></a></span></div>
        </div>
        <div class="section01_content">
            <?php if($view['wr_7']==1) {

                if ($view["video_link"] != "") {
                    ?>
                    <div class='embed-container'>
                        <?php echo $view["video_link"];?>
                    </div>
                <?php }
                if ($view["etc3"] != "") { ?>
                    <img src="<?php echo G5_DATA_URL ?>/shop/<?php echo $view["etc3"]; ?>" alt="이미지">
                <?php }
            }?>
            <dl>
                <dt>전화번호</dt>
                <dd><?php echo ($view["store_hp"])?$view["store_hp"]:"전화번호 정보없음"?></dd>
                <dt>주소</dt>
                <dd><?php echo ($view["store_zip"])?"(".$view["store_zip"].")":""; ?> <?php echo ($view["store_addr1"])?$view["store_addr1"]." ".$view["store_addr2"]:"등록된 주소정보가 없습니다.";?></dd>
                <dt>운영시간</dt>
                <dd><?php echo ($view["open_time"] && $view["close_time"])?$view["open_time"]."~".$view["close_time"]:"등록된 운영시간 정보가 없습니다.";?></dd>
                <dt>휴무</dt>
                <dd><?php echo ($view["holiday"])?$view["holiday"]:"등록된 휴무정보가 없습니다.";?></dd>
                <dt>소개</dt>
                <dd><?php echo ($view["store_detail"])?$view["store_detail"]:"등록된 매장소개가 없습니다.";?></dd>
            </dl>
        </div>
    </section>
    <section class="section01" id="view_section" style="margin-bottom:60px;">
        <div class="error_info" style="padding:10px 0;text-align:center;font-size:14px;color: #333;margin:5px 5px;border:2px solid #ddd;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"><span></span>잘못된정보가 있나요? <a href="<?php echo G5_BBS_URL;?>/write.php?bo_table=error_board&parent_id=<?php echo $wr_id; ?>">수정요청</a></div>
    </section>
    <section class="section01" id="view_section" style="position:fixed;bottom:0;margin-bottom:0;z-index:99999;max-width:800px">
        <div class="section01_content">
            <ul class="premium">
                <li class="first" onclick="location.href='tel:<?php echo $view["wr_9"];?>'">전화</li>
                <!--<li onclick="fnShare('<?php /*echo $wr_id*/?>')">공유</li>-->
                <li onclick="location.href=g5_url+'/page/mypage/cart.php'">장바구니</li>
            </ul>
        </div>
    </section>


    </div>
    <script src="<?php echo G5_JS_URL ?>/owl.carousel.js"></script>
    <!-- Swiper JS -->
    <!--<script src="<?/*=G5_JS_URL*/?>/swiper.min.js"></script>-->
    <script>
        /*var swiper = new Swiper('.swiper-container', {
         zoom:true,
         pagination: '.swiper-pagination',
         nextButton: '.swiper-button-next',
         prevButton: '.swiper-button-prev'
         });*/
        $(".owl-carousel").owlCarousel({
            autoplay:true,
            autoplayTimeout:5000,
            autoplaySpeed:2000,
            smartSpeed:2000,
            loop:true,
            dots:true,
            items:1
        });

        function fnShare(id){
            $.post(g5_url+"/page/modal/share.php",{id:id},function(data){
                $(".modal").html(data);
                modal_active();
            });
        }
        function fnReviewGuide(){
            $.post(g5_url+"/page/modal/review_guide.php",function(data){
                $(".modal").html(data);
                modal_active();
            });
        }
        $(document).ready(function(){
            $("li.item").click(function(){
                var menu = $(this).find($("h2")).text();
                var id = $(this).find($("input[type=hidden]")).val();
                var price = $(this).find($("label.price")).text().replace(" 원","");
                price = price.replace(",","");
                $.post(g5_url+"/page/modal/cart_add.php",{"menu":menu,"price":price,"id":id},function(data){
                    $(".modal").html(data);
                    modal_active();
                });
            });
            var check_id = "<?php echo $fav['id']?>";
            if(check_id != ""){
                $("span[class^=mobile_favorite_btn]").toggle();
            }
            $("span[class^=mobile_favorite_btn]").click(function(){
                $("span[class^=mobile_favorite_btn]").toggle();
                var name = $(this).attr("class");
                if(name == "mobile_favorite_btn"){
                    $.ajax({
                        url:"<?php echo G5_URL?>/page/mypage/ajax.favorite_update.php",
                        method:"POST",
                        data:{"wr_id":'<?php echo $wr_id?>',"mode":"add","mb_id":'<?php echo $member["mb_no"]?>'}
                    }).done(function(data){
                        switch (data){
                            case "0":
                                alert("로그인 회원만 사용 할 수 있습니다.\r\n로그인 후 이용바랍니다.");
                                $("span[class^=mobile_favorite_btn]").toggle();
                                fnlogin();
                                break;
                            case "1":
                                alert("이미 추가 되어 있습니다.");
                                break;
                            case "2":
                                alert('추가 되었습니다.');
                                break;
                            case "3":
                                alert("추가 오류입니다. \r\n관리자에게 문의하시기 바랍니다.");
                                break;
                        }
                    })
                }else{
                    $.ajax({
                        url:"<?php echo G5_URL?>/page/mypage/ajax.favorite_update.php",
                        method:"POST",
                        data:{"wr_id":'<?php echo $wr_id?>',"mode":"del","mb_id":'<?php echo $member["mb_no"]?>'}
                    }).done(function(data){
                        switch (data){
                            case "2":
                                alert('취소 되었습니다.');
                                break;
                            case "3":
                                alert("취소 오류입니다. \r\n관리자에게 문의하시기 바랍니다.");
                                break;
                        }
                    })
                }
            });

        })

    </script>
    <script>
        var save_before = '';
        var save_html = document.getElementById('bo_vc_w').innerHTML;

        function good_and_write()
        {
            var f = document.fviewcomment;
            if (fviewcomment_submit(f)) {
                f.is_good.value = 1;
                f.submit();
            } else {
                f.is_good.value = 0;
            }
        }

        function fviewcomment_submit(f)
        {
            var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

            f.is_good.value = 0;

            var subject = "";
            var content = "";
            $.ajax({
                url: g5_bbs_url+"/ajax.filter.php",
                type: "POST",
                data: {
                    "subject": "",
                    "content": f.wr_content.value
                },
                dataType: "json",
                async: false,
                cache: false,
                success: function(data, textStatus) {
                    subject = data.subject;
                    content = data.content;
                }
            });

            if (content) {
                alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
                f.wr_content.focus();
                return false;
            }

            // 양쪽 공백 없애기
            var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
            document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
            if (char_min > 0 || char_max > 0)
            {
                check_byte('wr_content', 'char_count');
                var cnt = parseInt(document.getElementById('char_count').innerHTML);
                if (char_min > 0 && char_min > cnt)
                {
                    alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                } else if (char_max > 0 && char_max < cnt)
                {
                    alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
            else if (!document.getElementById('wr_content').value)
            {
                alert("댓글을 입력하여 주십시오.");
                return false;
            }

            if (typeof(f.wr_name) != 'undefined')
            {
                f.wr_name.value = f.wr_name.value.replace(pattern, "");
                if (f.wr_name.value == '')
                {
                    alert('이름이 입력되지 않았습니다.');
                    f.wr_name.focus();
                    return false;
                }
            }

            if (typeof(f.wr_password) != 'undefined')
            {
                f.wr_password.value = f.wr_password.value.replace(pattern, "");
                if (f.wr_password.value == '')
                {
                    alert('비밀번호가 입력되지 않았습니다.');
                    f.wr_password.focus();
                    return false;
                }
            }
            document.getElementById("btn_submit").disabled = "disabled";
            return true;
        }

        function comment_box(comment_id, work)
        {
            var el_id;
            // 댓글 아이디가 넘어오면 답변, 수정
            if (comment_id)
            {
                if (work == 'c')
                    el_id = 'reply_' + comment_id;
                else
                    el_id = 'edit_' + comment_id;
            }
            else
                el_id = 'bo_vc_w';

            if (save_before != el_id)
            {
                if (save_before)
                {
                    document.getElementById(save_before).style.display = 'none';
                    document.getElementById(save_before).innerHTML = '';
                }

                document.getElementById(el_id).style.display = '';
                document.getElementById(el_id).innerHTML = save_html;
                // 댓글 수정
                if (work == 'cu')
                {
                    document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
                    if (typeof char_count != 'undefined')
                        check_byte('wr_content', 'char_count');
                    if (document.getElementById('secret_comment_'+comment_id).value)
                        document.getElementById('wr_secret').checked = true;
                    else
                        document.getElementById('wr_secret').checked = false;
                }

                document.getElementById('comment_id').value = comment_id;
                document.getElementById('w').value = work;

                if(save_before)
                    $("#captcha_reload").trigger("click");

                save_before = el_id;
            }
        }

        function comment_delete()
        {
            return confirm("이 댓글을 삭제하시겠습니까?");
        }

        comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

        <?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
        // sns 등록
        $(function() {
            $("#bo_vc_send_sns").load(
                "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
                function() {
                    save_html = document.getElementById('bo_vc_w').innerHTML;
                }
            );
        });
        <?php } ?>
    </script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
    <script type='text/javascript'>
        //<![CDATA[
        // // 사용할 앱의 JavaScript 키를 설정해 주세요.
        Kakao.init('c98e87699f92ad0673759ad55b12cc50');
        // // 카카오링크 버튼을 생성합니다. 처음 한번만 호출하면 됩니다.
        function sendLink() {
            Kakao.Link.sendDefault({
                objectType: 'feed',
                content: {
                    title: '<?php echo $view['wr_subject']?>',
                    imageUrl: '<?php echo G5_DATA_URL?>/file/main/<?php echo $file[0]['file']?>',
                    link: {
                        mobileWebUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>',
                        webUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>'
                    }
                },
                buttons: [
                    {
                        title: '웹으로 보기',
                        link: {
                            mobileWebUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>',
                            webUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>'
                        }
                    },
                    {
                        title: '앱으로 보기',
                        link: {
                            mobileWebUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>',
                            webUrl: '<?php echo G5_URL?>/page/rent/view.php?wr_id=<?php echo $wr_id?>&wr_subject=<?php echo $view["wr_subject"]?>'
                        }
                    }
                ]
            });
        }
        //]]>
    </script>
<?php
include_once(G5_PATH."/tail.sub.php");
?>