<?php
include_once("../../common.php");
$wr_id=$member["mb_id"];
$wr_subject="고파 안내";
$back_url= G5_URL."?lat=".$lat."&lng=".$lng;
include_once(G5_PATH."/head.php");
?>
<div class="width-fixed view">
    <img src="<?php echo G5_IMG_URL?>/guide_bg.png" alt="이용방법">
</div>
<?php
include_once ("../../tail.php");
?>
