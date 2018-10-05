<?php
include_once("../common.php");
$p=true;
include_once(G5_PATH."/admin/head.php");

$view=sql_fetch("select m.*,s.* from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where m.wr_id='".$wr_id."'");
$file = get_file("main", $wr_id);
?>
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>상점정보</h1>
            <hr />
        </header>
        <article>
            <form action="<?php echo G5_PATH."/admin/medel_update.php";?>">
            <input type="hidden" value="<?php echo $wr_id?>" name="wr_id">
            <div class="adm-table02">
                <table>
                    <tr>
                        <th>상점아이디</th>
                        <td><input type="text" name="mb_id" id="mb_id" class="adm-input01 grid_100" ></td>
                    </tr>
                    <tr>
                        <th>상점비밀번호</th>
                        <td><input type="password" name="mb_password" id="mb_password" class="adm-input01 grid_100" ></td>
                    </tr>
                    <tr>
                        <th>메인사진 *</th>
                        <td>
                            <?php
                            if($view["wr_file"]!=0){
                                if($file["count"]>1) {
                                    ?>
                                    <div id="view-slide" class="owl-carousel">
                                        <?php for ($i = 1; $i < count($file) - 1; $i++) { ?>
                                            <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[$i]['file']; ?>" alt=""></div>
                                        <?php }?>
                                    </div>
                                <?php }else{?>
                                    <div id="view-slide" style="height:auto;text-align: center">
                                        <div class="item"><img src="<?php echo G5_DATA_URL . "/file/main/" . $file[0]['file']; ?>" alt="" style="height:100%;"></div>
                                    </div>
                                <?php }
                            }?>
                            <input type="file" name="store_file" id="store_file"> 
                        </td>
                    </tr>
                    <tr>
                        <th>상점이름 *</th>
                        <td><input type="text" value="<?php echo $view['wr_subject']; ?>" name="wr_subject" id="wr_subject" class="adm-input01 grid_100"></td>
                    </tr>
                    <tr>
                        <th>프리미엄 *</th>
                        <td><label for="premium1">활성화</label> <input type="checkbox" value="1" name="premium" id="premium1" >&nbsp;&nbsp;&nbsp;<label for="premium2">비활성화</label> <input type="checkbox" value="0" name="premium" id="premium2" ></td>
                    </tr>
                    <tr>
                        <th>점주명 *</th>
                        <td><input type="text" value="<?php echo $view['wr_name']; ?>" name="wr_name" id="wr_name" class="adm-input01 grid_100"></td>
                    </tr>
                    <tr>
                        <th>전화번호</th>
                        <td><input type="text" value="<?php echo $view['store_hp']; ?>" name="store_hp" id="store_hp" class="adm-input01 grid_100"></td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td>
                            <input type="button" value="주소검색" onclick="DaumPostcode()" class="adm-btn02" style="width:150px;background:#000;color:#FFF;border:none;height:30px;padding:3px;">
                            <input type="text" value="<?php echo $view['store_zip']; ?>" name="store_zip" id="store_zip" class="adm-input01 grid_20">
                            <div id="search_addr" style="width:100%;"></div>
                            <input type="text" value="<?php echo $view['store_addr1']; ?>" name="store_addr1" id="store_addr1" class="adm-input01 grid_100">
                            <input type="text" value="<?php echo $view['store_addr2']; ?>" name="store_addr2" id="store_addr2" class="adm-input01 grid_100">
                        </td>
                    </tr>
                    <tr>
                        <th>운영시간</th>
                        <td><?php echo $view['open_time']." ~ ".$view["close_time"]; ?></td>
                    </tr>
                    <tr>
                        <th>휴무</th>
                        <td><?php echo $view['holiday']; ?></td>
                    </tr>
                    <tr>
                        <th>소개</th>
                        <td><?php echo $view['wr_content']; ?></td>
                    </tr>
                    <?php if($view["wr_7"]==1){?>
                        <tr>
                            <th>동영상</th>
                            <td>
                                <?php echo $view['video_link']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>추가이미지</th>
                            <td>
                                <img src="<?php echo G5_DATA_URL."/shop/".$view['etc3']; ?>" alt=""><?php echo $view['etc3']; ?>
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>배달정보 *</th>
                        <td><?php echo ($view['delivery']==1)?"가능":"불가능"; ?></td>
                    </tr>
                    <tr>
                        <th>배달가능지역 *</th>
                        <td><?php echo $view['delivery_location']; ?></td>
                    </tr>
                    <tr>
                        <th>배달가능금액 *</th>
                        <td><?php echo $view['delivery_price']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>결제수단 *</th>
                        <td><?php echo $view['order_type']; ?></td>
                    </tr>
                    <tr>
                        <th>포인트 *</th>
                        <td><?php echo $view['point']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>예약/단체 *</th>
                        <td><?php echo $view['other']; ?></td>
                    </tr>
                    <tr>
                        <th>홈페이지 *</th>
                        <td><?php echo $view['store_homepage']; ?></td>
                    </tr>
                    <tr>
                        <th>흡연 *</th>
                        <td><?php echo $view['smoke_area']; ?></td>
                    </tr>
                    <tr>
                        <th>주차장 *</th>
                        <td><?php echo $view['parking']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="adm-table02 mt20">
                <table>
                    <tr>
                        <th>원산지정보</th>
                        <td><?php echo $view['oring_mark']; ?></td>
                    </tr>
                    <tr>
                        <th>알레르기유발정보</th>
                        <td><?php echo $view['etc1']; ?></td>
                    </tr>
                    <tr>
                        <th>영양성분정보</th>
                        <td><?php echo $view['etc2']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="text-center mt20" style="margin-bottom:20px;">
                <input type="button" class="adm-btn01" value="<?php if($wr_id){?>수정하기<?php }else{?>등록하기<?php }?>">
                <a href="<?php echo G5_URL."/admin/model_list.php?page=".$page; ?>" class="adm-btn01">취소</a>
            </div>
            </form>
        </article>
    </section>
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
<?php
include_once(G5_PATH."/admin/tail.php");
?>
