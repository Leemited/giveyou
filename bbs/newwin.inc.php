<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
$now=date("Y-m-d H:i:s");
$sql = " select * from `g5_write_event`
          where `wr_1`<='{$now}' and `wr_2`>='{$now}'
            and `wr_5`<>''
          order by wr_id asc ";
$result = sql_query($sql, false);
?>
<style type="text/css">
	#hd_pop{width:auto;z-index:100;}
</style>
<!-- 팝업레이어 시작 { -->
<div id="hd_pop">
    <h2>팝업레이어 알림</h2>

<?php
for ($i=0; $nw=sql_fetch_array($result); $i++){
    // 이미 체크 되었다면 Continue
    if ($_COOKIE["hd_pops_{$nw['wr_id']}"])
        continue;
	if($nw['wr_file']==2){
		$file=sql_fetch("select * from `g5_board_file` where `bo_table`='event' and `bf_no`='1' and `wr_id`='{$nw['wr_id']}'");
?>

    <div id="hd_pops_<?php echo $nw['wr_id'] ?>" class="hd_pops" style="top:0px;left:0px;max-width:100%;">
        <div class="hd_pops_con" style="max-width:100%;">
			<a href="<?php echo G5_BBS_URL."/board.php?bo_table=event&wr_id=".$nw['wr_id']; ?>">
				<img src="<?php echo G5_DATA_URL."/file/event/".$file['bf_file']; ?>" alt="<?php echo $nw['wr_subject']; ?>" />
			</a>
        </div>
        <div class="hd_pops_footer">
            <button class="hd_pops_reject hd_pops_<?php echo $nw['wr_id']; ?> 24"><strong>24</strong>시간 동안 다시 열람하지 않습니다.</button>
            <button class="hd_pops_close hd_pops_<?php echo $nw['wr_id']; ?>">닫기</button>
        </div>
    </div>
<?php 
	}
}
if ($i == 0) echo '<span class="sound_only">팝업레이어 알림이 없습니다.</span>';
?>
</div>

<script>
$(function() {
    $(".hd_pops_reject").click(function() {
        var id = $(this).attr('class').split(' ');
        var ck_name = id[1];
        var exp_time = parseInt(id[2]);
        $("#"+id[1]).css("display", "none");
        set_cookie(ck_name, 1, exp_time, g5_cookie_domain);
    });
    $('.hd_pops_close').click(function() {
        var idb = $(this).attr('class').split(' ');
        $('#'+idb[1]).css('display','none');
    });
    $("#hd").css("z-index", 1000);
});
</script>
<!-- } 팝업레이어 끝 -->