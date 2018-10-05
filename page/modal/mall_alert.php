<?php
include_once('../../common.php');

$msg = $_REQUEST["message"];
?>
<style type="text/css">
    .reserve_view{border:5px solid #f17a40;border-radius:3px;}
    .reserve_view .btn_group{text-align:center;font-size:18px;font-family:nbgr;font-weight:normal;}
    .reserve_view .btn_group .btn{background:#f17a40;color:#fff;width:104px;height:48px;padding:14px 0;box-sizing:border-box;}
    .reserve_view > div{width:100% !important;margin:0 !important;box-sizing:border-box;border:none !important;}
    #reserve_result .con h1 > span{position:relative;}
    #reserve_result .con h1 > span:after{content:"";width:1px;height:60px;background:#990000;position:absolute;right:0;top:50%;margin-top:-30px;border-right:1px solid #d64d52;}
    @media all and (max-width: 900px){
        #reserve_result .con h1 > span:after{height:30px;margin-top:-15px;}
    }
    @media all and (max-width: 768px){
		#reserve_result .con p{font-size:3vw}
        .reserve_view .btn_group{padding:20px 0;}
        .reserve_view .btn_group .btn{height:35px;width:80px;font-size:14px;padding:10px 0;}
    }
    @media all and (max-width: 480px){
        #reserve_result .con h1 > span:after{display:none;}
        .reserve_view .btn_group{padding:10px 0;}
        .reserve_view .btn_group .btn{height:30px;width:70px;font-size:13px;padding:7px 0;}
    }
	#reserve_result .con p{text-align:center;font-size:20px;}
</style>
<div class="reserve_view" style="border-radius:10px">
    <div id="reserve_result">
        <div class="con">
            <h2>기뷰 알림</h2>
			<?php if($msg){?>
			<p><?php echo $msg;?></p>
			<?php }else{ ?>
            <p>기뷰몰은 준비중이에요!</p>
			<?php }?>
        </div>
    </div>
    <div class="btn_group">
        <a href="javascript:modal_close();" class="btn">확인</a>
    </div>
</div>