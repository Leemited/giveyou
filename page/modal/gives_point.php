<?php
include_once("../../common.php");

?>
<style>
.gives_pptop img{width:100%}
.gives_pp{padding:15px;background-color:#FFF;}
.gives_pp h2{font-size:26px;padding:5px 0 10px;}
.p_info{padding:10px 0; font-size:20px;}
.gpg{position:relative;}
.gp{font-size:26px;font-weight:bold;color:#f17a40;position:absolute;right:0;top:4px}
#lab{width:45%;font-size:18px;display:inline;font-weight:bold;}
#use_point{border:1px solid #ddd; border-radius:10px;width:64%;margin-left:10px;padding:8px;font-size:16px;text-align:right}
.msgs{margin-top:10px;}
.msgs p{padding-bottom:4px;}
.agree_txt{font-size:14px;padding:5px;background-color:#eee;margin:5px 0;text-align:center;word-break:keep-all;}
.chk_agree{text-align:right;}
.chk_agree input{margin-left:6px;}
#msg{border:1px solid #ddd; border-radius:10px;width:calc(100% - 20px);padding:10px;font-size:16px;}
.submit_btn{width:calc(100% - 20px);border-radius:10px;font-size:18px;padding:10px;background-color:#f17a40;border:none;text-align:center;margin-top:6px;color:#fff}
.submit_btn span{color:#141414}
@media all and (max-width:780px){
	.gives_pp h2{font-size:5vw}
	.submit_btn{font-size:5vw}
	#lab{font-size:4vw}
	.agree_txt{font-size:2vw}
	#use_point{width:50%}
}
</style>
<div style="background-color:transparent">
	<div style="position:absolute;top:0;left:0" onclick="modal_close();"><img src="<?php echo G5_IMG_URL?>/menu_close_icon_white.png" style="width:20%" alt=""></div>
	<div class="gives_pptop">
		<img src="<?php echo G5_IMG_URL?>/gives_top_ic.png" alt="">
		<img src="<?php echo G5_IMG_URL?>/gives_top_bg.png" alt="">
	</div>
	<div class="gives_pp">
		<h2>내 <span>G포인트</span> 기부 하기</h2>
		<form action="" method="post" name="use_give">
			<div class="gpg">
				<label for="use_point" id="lab">기부 가능 포인트</label>
				<input type="text" onkeyup="number_only(this);" name="use_point" id="use_point" class="" value="<?php echo $member["mb_point"];?>">
				<div class="gp">G</div>
			</div>	
			<div class="msgs">
				<p>따뜻한 한마디 남기기</p>
				<textarea name="msg" id="msg" cols="30" rows="3"></textarea>	
			</div>
			<div class="agree_txt">
				기부로 인한 포인트 제공 및 소멸에 대한 내용에 동의하며, 포인트 기부에 대한 내용은 [기부천사] 메뉴에서 기부 후 전체 공지 예정입니다. 좋은 일에 소중한 자산 소중히 쓰겠습니다. 감사합니다. 
			</div>
			<div class="chk_agree"><label for="agree">G포인트 제공 및 소멸 동의 (필수)<input type="checkbox" name="agree" id="agree"></label></div>
		</form>
	</div>
	<div onclick="fnUsePoint()" class="submit_btn" ><span>기뷰 G포인트</span> 기부하기</div>
</div>
<script>
function fnUsePoint(){
	var point = $("#use_point").val();
	if(point > Number("<?php echo $member[mb_point];?>")){
		alert("사용가능한 G포인트를 초과 하였습니다.");
		return false;
	}
	if($("#agree").prop("checked") == false){
		alert("G포인트 제공 및 소멸에 동의 하셔야 합니다.");
		return false;
	}

	if(confirm(point+"G포인트를 정말 기부하시겠습니까?\r기부하신 만큼 G포인트는 차감됩니다.")){
		document.use_give.submit();
		modal_close();
	}else{
		return false;
	}
}
</script>