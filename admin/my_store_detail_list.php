<?php
include_once ("../common.php");
include_once(G5_PATH."/admin/head.php");

include_once (G5_LIB_PATH."/thumbnail.lib.php");
if($is_admin){
    $store_r = sql_query("select * from `g5_write_main` where wr_is_comment = 0 ");
    while ($row = sql_fetch_array($store_r)) {
        $list[] = $row;
    }
    $count = sql_query("select * from `store_temp` where status = 0 ");
    while ($row = sql_fetch_array($count)) {
        $temp[] = $row;
    }
}else {
//내상점 불러오기
    $store_r = sql_query("select * from `g5_write_main` where mb_id = '{$member["mb_id"]}'  ");
    while ($row = sql_fetch_array($store_r)) {
        $list[] = $row;
    }
//등롣대기 상점
    $count = sql_query("select * from `store_temp` where mb_id = '{$member["mb_id"]}' and status = 0 ");
    while ($row = sql_fetch_array($count)) {
        $temp[] = $row;
    }
}
?>
<style>
    .store_list li{width:33%;background:#fff;float:left;margin-left:0.33%;margin-bottom:10px;}
</style>
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>상점관리</h1>
            <hr />
        </header>
        <article>
            <div class="store_list">
                <ul>
                    <?php
                    for($i=0;$i<count($list);$i++){
                        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'],"800","530");
                        if($thumb['src']) {
                            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
                        }
                        ?>
                        <li>
                            <div class="section01_header store_title">
                                <div><h2><?php echo $list[$i]["wr_subject"];?></h2></div>
                                <div class="store_edit">
                                    <a href="<?php echo G5_URL;?>/admin/my_store_detail_form.php?w=cu&wr_id=<?php echo $list[$i]["wr_id"]?>"><i></i></a>
                                </div>
                                <div class="store_del">
                                    <a href="<?php echo G5_URL;?>/admin/my_store_del.php"><i></i></a>
                                </div>
                            </div>
                            <div class="section01_content">
                                <div style="text-align: center;background:#ddd;text-align: center;display: block">
                                    <a href="<?php echo G5_URL;?>/admin/my_store_detail_view.php?wr_id=<?php echo $list[$i]["wr_id"];?>&type=shop">
                                        <?php if($img_content) {echo $img_content;}else{?>
                                            <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="no-image" style="text-align: center">
                                        <?php }?>
                                    </a>
                                </div>
                            </div>
                            <div class="list_btn_group">
                                <input type="button" value="정보수정" class="btn bg_darkred grid_100 list_menu_edit_btn" onclick="location.href='<?php echo G5_URL."/admin/my_store_detail_form.php?wr_id=".$list[$i]["wr_id"]?>'">
                            </div>
                        </li>

                    <?php } if(count($list)==0 && count($temp)!=0){?>
                        <li>
                            <div class="section01_content no_list">
                                <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
                                <p>상점 심사 중입니다.<br>빠른 심사 등록은 고객만족센터에 문의바랍니다.</p>
                            </div>
                        </li>
                    <?php } else if (count($list)==0 && count($temp)==0){?>
                        <li>
                            <div class="section01_content no_list">
                                <img src="<?php echo G5_IMG_URL?>/logo_sample.png" alt="심사대기">
                                <p>등록된 상점이 없습니다.<br>상점을 등록해주세요.</p>
                            </div>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </article>
    </section>
</div>
<?php
include_once (G5_PATH."/admin/tail.php")
?>
