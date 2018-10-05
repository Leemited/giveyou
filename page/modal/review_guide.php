<?php
include_once('../../common.php');
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
        .reserve_view .btn_group{padding:20px 0;}
        .reserve_view .btn_group .btn{height:35px;width:80px;font-size:14px;padding:10px 0;}
    }
    @media all and (max-width: 480px){
        #reserve_result .con h1 > span:after{display:none;}
        .reserve_view .btn_group{padding:10px 0;}
        .reserve_view .btn_group .btn{height:30px;width:70px;font-size:13px;padding:7px 0;}
    }
</style>
<div class="reserve_view" style="border-radius:10px">
    <div id="reserve_result">
        <div class="con">
            <h2>블라인드 처리 기준</h2>
            <p>기뷰는 정확한 리뷰를 추구합니다.
                리뷰가 아래의 기준에 해당되지 않도록
                주의하여 작성해주세요!</p>
            <div class="table03">
                <ul>
                    <li>매우 간략한 리뷰</li>
                    <li>난해한 오타가 있는 리뷰</li>
                    <li>문자의 과도한 반복이 있는 리뷰</li>
                    <li>욕설, 비속어, 음란어를 사용한 리뷰</li>
                    <li>개인정보를 포함한 리뷰</li>
                    <li>명예훼손, 저작권 침해, 도용 등이 우려되는 리뷰</li>
                    <li>해당 매장이 아닌 다른 매장의 리뷰</li>
                    <li>도배되거나 중복된 리뷰</li>
                    <li>기타 에티켓을 위반한 리뷰</li>
                </ul>
            </div>
            <h3>위에 해당하는 리뷰들은 블라인드 처리됩니다.</h3>
        </div>
    </div>
    <div class="btn_group">
        <a href="javascript:modal_close();" class="btn">확인</a>
    </div>
</div>