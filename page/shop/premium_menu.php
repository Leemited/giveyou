<?php
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];

$wr_subject = "프리미엄 메뉴";
$back_url=G5_URL."/page/shop/";
include_once ("../../head.php");

$sql = "select * from `g5_write_main` where mb_id='{$member[mb_id]}'";
$res = sql_query($sql);
while($row = sql_fetch_array($res)){
	$store[] = $row;
}

$hp = explode("-",$member["mb_hp"]);
$email = explode("@",$member["mb_email"]);
?>

<div>
</div>
<div class="width-fixed">
	<?php include_once("./back_head.php");?>
    <section class="section01">
        <div class="section01_content">
			<h2 class="shop_titles">프리미엄 상점 신청</h2>
			<form action="<?php echo G5_URL?>/page/shop/premium_update.php" method="post" name="premium_form" class="premium_form">
            <div class="premium_info">
				<div>
					<label for="store_name">상&nbsp;&nbsp;점&nbsp;&nbsp;명 :</label><input type="text" class="premium_input" name="store_name" id="store_name" value="<?php echo $store[0]['wr_subject']?>" required>
				</div> 
				<div>
					<label for="user_name">담당자명 :</label><input type="text" class="premium_input" name="user_name" id="user_name" value="<?php echo $member["mb_name"];?>" required>
				</div>
				<div>
					<label for="emid">이&nbsp;&nbsp;메&nbsp;&nbsp;일 :</label><input type="text" class="premium_input emid" name="emid" id="emid" required value="<?php echo $email[0];?>"> @ 
					<select name="emdm" id="emdm" class="premium_sel_emdm" required>
						<option value="" >선택하세요</option>
						<option value="naver.com" <?php if($email[1]=="naver.com"){?>selected<?php }?>>naver.com</option>
						<option value="gmail.com" <?php if($email[1]=="gmail.com"){?>selected<?php }?>>gmail.com</option>
						<option value="hanmail.net" <?php if($email[1]=="hanmail.net"){?>selected<?php }?>>hanmail.net</option>
						<option value="nate.com" <?php if($email[1]=="nate.com"){?>selected<?php }?>>nate.com</option>
						<option value="cyworld.com" <?php if($email[1]=="cyworld.com"){?>selected<?php }?>>cyworld.com</option>
					</select>
				</div>
				<div>
					<label for="hp1">연&nbsp;&nbsp;락&nbsp;&nbsp;처 :</label>
					<select name="hp1" id="hp1" class="premium_sel_emdm hp" required>
						<option value="010" <?php if($hp[0]=="010"){?>selected<?php }?>>010</option>
						<!-- <option value="010" <?php if($hp[0]=="018"){?>selected<?php }?>>018</option>
						<option value="010" <?php if($hp[0]=="019"){?>selected<?php }?>>019</option> -->
						<option value="070" <?php if($hp[0]=="070"){?>selected<?php }?>>070</option>
						<option value="02" <?php if($hp[0]=="02"){?>selected<?php }?>>02</option>
						<option value="031" <?php if($hp[0]=="031"){?>selected<?php }?>>031</option>
						<option value="032" <?php if($hp[0]=="032"){?>selected<?php }?>>032</option>
						<option value="033" <?php if($hp[0]=="033"){?>selected<?php }?>>033</option>
						<option value="041" <?php if($hp[0]=="041"){?>selected<?php }?>>041</option>
						<option value="042" <?php if($hp[0]=="042"){?>selected<?php }?>>042</option>
						<option value="043" <?php if($hp[0]=="043"){?>selected<?php }?>>043</option>
						<option value="051" <?php if($hp[0]=="051"){?>selected<?php }?>>051</option>
						<option value="052" <?php if($hp[0]=="052"){?>selected<?php }?>>052</option>
						<option value="053" <?php if($hp[0]=="053"){?>selected<?php }?>>053</option>
						<option value="054" <?php if($hp[0]=="054"){?>selected<?php }?>>054</option>
						<option value="055" <?php if($hp[0]=="055"){?>selected<?php }?>>055</option>
						<option value="061" <?php if($hp[0]=="061"){?>selected<?php }?>>061</option>
						<option value="062" <?php if($hp[0]=="062"){?>selected<?php }?>>062</option>
						<option value="063" <?php if($hp[0]=="063"){?>selected<?php }?>>063</option>
						<option value="064" <?php if($hp[0]=="064"){?>selected<?php }?>>064</option>
					</select> - <input type="text" class="premium_input hp" name="hp2" required value="<?php echo $hp[1]?>" maxlength="4"> - <input type="text" class="premium_input hp" name="hp3" required value="<?php echo $hp[2]?>" maxlength="4">
				</div>
            </div>
			<div class="pre_choice">
				<div>
					<span>선택. 1</span><label for="main_slide"><span>착한가게 메인</span>화면 신청</label><input type="checkbox" name="main_slide" id="main_slide" value="1">
				</div>
				<div>
					<span>선택. 2</span><label for="list_ad">리스트 <span>틈새 광고</span> 신청</label><input type="checkbox" name="list_ad" id="list_ad" value="1">
				</div>
				<p>프리미엄과 더불어 내 상점의 노출 빈도수를 올려보세요!</p>
			</div>	
			<div class="pre_agree">
				<p>입력하신 정보로 상담 메일 또는 전화 연락이 이루어집니다.<br>상담 외에 별도로 개인정보를 활용 또는 공유 하지 않습니다.<br>상담이 완료 된 개인정보는 7일 이내 파기됩니다.</p>
				<label for="agree">개인정보제공 동의(필수)&nbsp;&nbsp;<input type="checkbox" required name="agree" id="agree"></label>
			</div>
			<div class="btn_group clear premium_btn_area" >
				<?php if($shop["wr_7"]==0){?>
					<div class="btn shop_btn" onclick="document.premium_form.submit()" ><span>프리미엄 상점</span>신청하기</div>
					<p>내 상점을 마음대로~ 더 나은 프리미엄 서비스를 맛보세요!</p>
				<?php }else{?>
					<!-- <input type="button" value="프리미엄 메뉴" class="btn shop_btn" onclick="location.href=g5_url+'/page/shop/premium_menu.php?wr_id=<?php echo $shop["wr_id"]?>'" > -->
				<?php } ?>
				<!-- <?php if(!$mobile){?>
					<br><br>
					<input type="button" value="PC 버전 관리자" class="btn grid_100 bg_darkred general_btn" onclick="location.href=g5_url+'/admin/'" >
				<?php }?> -->
			</div>
			</form>
            <!-- <div class="premium_list">
                <ul>
                    <li onclick="location.href=g5_url+'/page/shop/store_slide_list_regi.php?wr_id=<?php echo $wr_id?>'">업체 리스트 슬라이드 광고 신청</li>
                    <li onclick="location.href=g5_url+'/page/shop/store_top_list_regi.php?wr_id=<?php echo $wr_id?>'">업체 리스트 첫 페이지 노출 신청</li>
                </ul>
            </div> -->
        </div>
    </section>
</div>
<?php
include_once ("../../tail.php");
?>
