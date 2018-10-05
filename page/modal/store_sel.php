<?php
include_once('../../common.php');
$id = $_REQUEST["id"];
$sql = sql_query("select * from `g5_write_main` where `mb_id` = '{$member["mb_id"]}' and wr_3 = 'N' and wr_is_comment = 0 and wr_file != 0");
while($row = sql_fetch_array($sql)){
    $list[] = $row;
}

?>
<style>
    li.item{padding:10px; font-size:16px;border:1px solid #ddd; border-radius: 4px;cursor: pointer;}
    li.item:hover{background:#cf1616;color:#fff;font-weight:bold;}
    li.disable{background:#eee;color:#ccc;cursor: auto;}
    li.disable:hover{background:#eee;color:#ccc;cursor: auto;font-weight: normal}
</style>
<div class="reserve_view">
        <div id="reserve_result">
            <div class="con">
                <h2>상점선택</h2>
                <div class="cart_add">
                    <a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn.png" alt=""></a>
                    <ul>
                        <?php
                        for($i=0;$i<count($list);$i++){
                        ?>
                        <li class="item"><?php echo $list[$i]["wr_subject"];?><input type="hidden" value="<?php echo $list[$i]['wr_id']?>" name="wr_id"></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <!--<div class="btn_group">
            <a href="#" onclick="return fncate();" class="btn">추가</a>
        </div>-->
</div>
<script type="text/javascript">
    $(".item").each(function () {
        $(this).click(function(){
            $(this).addClass("disable");
            var item = $(this).text();
            var item_id = $(this).children($("input")).val();
            $("#store_name").val(item);
            $("#wr_id").val(item_id);
            modal_close();
        })
    })
</script>