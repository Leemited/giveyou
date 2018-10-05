<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$mb_no = $_REQUEST["mb_no"];
$list_result = sql_query("select * from `mypage_favorite` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.mb_id = ".$mb_no);
while($row=sql_fetch_array($list_result)){
    $list[]=$row;
}
$rand = rand(0,4);
$favo_title = array("콕! 찜했어~ \r\n마음에드는 매장 찜하러 가기", "나만의 찜 목록을 만들어보세요! \r\n언제 어디서든 찾아볼 수 있답니다.", "내가 맘에드는 매장만 골라보자!", "언제 어디서든 찾아볼 수 있는 매장이 필요해~" , "콕콕콕! 원하는 매장만! 지금 바로~");
if(count($list) > 0){
?>
<ul>
    <?php
    for($i=0;$i<count($list);$i++){

        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 800, 530);
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }

        $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."&wr_subject=".$list[$i]['wr_subject']."'";
        $order = sql_fetch("select COUNT(*) as cnt from `order_form` where order_state > 0 and order_state < 4 and wr_id='{$list[$i]['wr_id']}'");
        $shop = sql_fetch("select * from `g5_write_main` where wr_id='{$list[$i]["wr_id"]}'");

        $even = $shop['wr_comment'];
        if($even==0){
            $rank_total = $shop["wr_4"];
        }else {
            $rank_total = ceil($shop["wr_4"] / $shop['wr_comment']);
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
        }
        ?>
        <li data-cate="<?php echo $list[$i]['type']; ?>">
            <div onclick="<?php echo $link; ?>">
                <div class="img">
                    <div><?php echo $img_content; ?></div>
                </div>
                <div class="txt">
                    <h3><?php echo $shop['wr_subject']; ?></h3>
                    <h4><?php echo "(".$list[$i]["store_zip"].")".$list[$i]['store_addr1']." ".$list[$i]["store_addr2"]; ?></h4>
                    <p>영업시간  <?php echo $list[$i]["open_time"]." ~ ".$list[$i]["close_time"]; ?></p>
                    <p>주문수  <?php echo $order["cnt"]; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo number_format($list[$i]['delivery_price']); ?>원 이상배달</p>
                    <p><span class="bg_yellow bold"><?php echo $rank?></span> | 거리</p>
                </div>
            </div>
            <a href="javascript:fnDel(<?php echo $list[$i]['id'];?>);" class="btn favorite_btn"></a>
        </li>
    <?php }?>
</ul>
<?php }else if(count($list)==0){ ?>
    <div class="mypage_no_list">
        <p><?php echo $favo_title[$rand]?></p>
        <div class="mypage_btn_group">
            <input type="button" class="btn grid_30 btn_pink" value="찜하러가기" onclick="moveLink('main','')">
        </div>
    </div>
<?php } ?>
<script type="text/javascript">
    function fnDel(id){
        $.ajax({
            url: "<?php echo G5_URL?>/page/mypage/ajax.favorite_update.php",
            method:"POST",
            data:{"id":id}
        }).done(function(data){
            switch (data){
                case "2":
                    alert("삭제되었습니다.");
                    document.location.reload();
                    break;
                case "3":
                    alert("삭제오류입니다. \r\n관리자에게 문의하시기 바랍니다.");
                    break;
            }
        })
    }
</script>