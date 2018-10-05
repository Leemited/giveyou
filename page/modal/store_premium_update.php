<?php
include_once('../../common.php');
$id = $_REQUEST["id"];
?>
<style type="text/css">
    .reserve_view{border:5px solid #ce2027;border-radius:3px;}
    .reserve_view .btn_group{text-align:center;font-size:18px;font-family:nbgr;font-weight:normal;}
    .reserve_view .btn_group .btn{background:#ce2027;color:#fff;width:104px;height:48px;padding:14px 0;box-sizing:border-box;}
    .reserve_view > div{width:100% !important;margin:0 !important;box-sizing:border-box;border:none !important;}
    #reserve_result .con h1 > span{position:relative;}
    #reserve_result .con h1 > span:after{content:"";width:1px;height:60px;background:#990000;position:absolute;right:0;top:50%;margin-top:-30px;border-right:1px solid #d64d52;}
    @media all and (max-width: 900px){
        #reserve_result .con h1 > span:after{height:30px;margin-top:-15px;}
    }
    @media all and (max-width: 768px){
        .reserve_view .btn_group{padding:20px 0;}
        .reserve_view .btn_group .btn{height:35px;width:80px;font-size:14px;padding:10px 0;}
    }
    @media all and (max-width: 480px){
        #reserve_result .con h1 > span:after{display:none;}
        .reserve_view .btn_group{padding:10px 0;}
        .reserve_view .btn_group .btn{height:30px;width:70px;font-size:13px;padding:7px 0;}
    }
</style>
<div class="reserve_view">
    <div id="reserve_result">
        <div class="con">
            <h2>프리미엄전환</h2>
            <p>프리미엄 전환은 유료 서비스입니다.<br>프리미엄 전환 시 다음과 같은 서비를 이용할 수 있습니다.</p>
            <ul>
                <li>1. 매장사진의 이용 제한이 4개에서 무제한으로 변경 됩니다.</li>
                <li>2. 매장정보의 동영상 또는 사진을 올리실 수 있습니다.</li>
                <li>3. 메인화면에 배너 신청을 통한 정보노출 신청 및 등록이 가능합니다.(선착순)</li>
                <li>4. 첫화면 상단에 매장을 노출 시킬 수 있습니다.(선착순)</li>
                <li>5. 매뉴별 사진을 등록하실 수 있습니다.</li>
                <li>6. 기타 프리미엄 사용자들의 특권을 누릴 수 있습니다.</li>
            </ul>
        </div>
    </div>
    <div class="btn_group">
        <a href="javascript:modal_close();" class="btn">취소</a>
        <a href="#" onclick="premiumUpdate('<?php echo $id;?>');" class="btn">전환하기</a>
    </div>
</div>
<script>
    function premiumUpdate(id){
        //결제페이지 완료 후 업데이트
        $.ajax({
            url:g5_url+"/page/ajax/ajax_premium_update.php",
            method:"POST",
            data:{id:id}
        }).done(function(data){
            alert("프리미엄 전환이 완료 되었습니다.");
            modal_close();
            location.reload();
        })
    }
</script>