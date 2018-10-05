<?php
include_once("../../common.php");
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$mb_no = $_REQUEST["mb_no"];
$list_result = sql_query("select * from `mypage_favorite` as a left join `g5_write_main` as b on a.wr_id = b.wr_id where a.mb_id = ".$mb_no." and a.wr_is_comment = 1");
while($row=sql_fetch_array($list_result)){
    $list[]=$row;
}
?>
<ul>
    <?php
    for($i=0;$i<count($list);$i++){

        $thumb = get_list_thumbnail("main", $list[$i]['wr_id'], 1100, 464);
        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
        }

        $link="javascript:location.href='".G5_URL."/page/rent/view.php?wr_id=".$list[$i]['wr_id']."&type=".$type."&wr_subject=".$list[$i]['wr_subject']."'";

        $time = explode("|",$list[$i]['wr_5']);
        $point = explode("|",$list[$i]['wr_8']);
        ?>
        <li data-cate="<?php echo $list[$i]['type']; ?>">
            <div onclick="<?php echo $link; ?>">
                <div class="img">
                    <div><?php echo $img_content; ?></div>
                </div>
                <div class="txt">
                    <h3><?php echo $list[$i]['wr_subject']; ?></h3>
                    <h4><?php echo $list[$i]['wr_10']; ?></h4>
                    <p>영업시간  <?php echo $time[0]."~".$time[1]; ?></p>
                    <p>주문수  <?php echo $list[$i]['wr_6']; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $list[$i]['delivery_price']; ?></p>
                    <p>적립&nbsp;&nbsp;현금&nbsp;<?php echo $point[0]." | ".$point[1] ;?></p>
                </div>
            </div>
            <a href="javascript:fnDel(<?php echo $list[$i]['id'];?>);" class="btn">삭제</a>
        </li>
    <?php } ?>
</ul>
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