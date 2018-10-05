<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1><?php echo $board['bo_subject']; ?></h1>
			<h3 class="<?php echo $bo_table; ?>_head"></h3>			
		</header>
		<div class="section01_content wrap">
			<div class="form_list01" id="event_form">
				<!-- 게시물 작성/수정 시작 { -->
				<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
				<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
				<input type="hidden" name="w" value="<?php echo $w ?>">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
				<input type="hidden" name="stx" value="<?php echo $stx ?>">
				<input type="hidden" name="spt" value="<?php echo $spt ?>">
				<input type="hidden" name="sst" value="<?php echo $sst ?>">
				<input type="hidden" name="sod" value="<?php echo $sod ?>">
				<input type="hidden" name="page" value="<?php echo $page ?>">
				<?php
//				$option = '';
//				$option_hidden = '';
//				if ($is_notice || $is_html || $is_secret || $is_mail) {
//					$option = '';
//					if ($is_notice) {http://m.cafe.daum.net/MangGo1210/3Np5/119522
//						$option .='<input type="checkbox" id="notice" name="notice" class="check01" value="1" '.$notice_checked.'><label for="notice" class="check01_label"></label><label for="notice">공지</label>';
//					}
//				}
//				echo $option_hidden;
				?>
					<ul>
<!--
						<?php if ($option) { ?>
						<li>
							<div class="grid_100">
								<label for="notice">옵션</label>
								<div><span class="option"><?php echo $option ?></span></div>
							</div>
						</li>
						<?php } ?>					
-->
						<li>
							<div class="bdr">
								<label for="wr_3">대표이미지</label>								
								<div>
									<div class="file01">
										<label for="file" class="input01"><span>파일을 선택해주세요</span><input type="file" name="bf_file[]" class="grid_100" title="대표이미지 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"></label>
									</div>
									<?php if($w == 'u' && $file[0]['file']) { ?>
									<input type="checkbox" id="bf_file_del0" name="bf_file_del[0]" value="1"><label for="bf_file_del0"><?php echo $file[0]['source'].'('.$file[0]['size'].')';  ?> 파일 삭제</label>
									<?php } ?>
								</div>
							</div>
							<div>
								<label for="wr_1">이미지</label>
								<div>
									<div class="file01">
										<label for="file" class="input01"><span>파일을 선택해주세요</span><input type="file" name="bf_file[]" class="grid_100" title="대표이미지 : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"></label>
									</div>
									<?php if($w == 'u' && $file[1]['file']) { ?>
									<input type="checkbox" id="bf_file_del1" name="bf_file_del[1]" value="1"> <label for="bf_file_del1 "><?php echo $file[1]['source'].'('.$file[1]['size'].')';  ?> 파일 삭제</label>
									<?php } ?>
								</div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="wr_subject">제목</label>
								<div><input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="input01 grid_100" size="50" maxlength="255"></div>
							</div>
						</li>
						<li>
							<div class="grid_100">
								<label for="wr_content">내용</label>
								<div>
									<?php if($write_min || $write_max) { ?>
									<!-- 최소/최대 글자 수 사용 시 -->
									<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
									<?php } ?>
									<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
									<?php if($write_min || $write_max) { ?>
									<!-- 최소/최대 글자 수 사용 시 -->
									<div id="char_count_wrap"><span id="char_count"></span>글자</div>
									<?php } ?>
								</div>
							</div>
						</li>						
					</ul>
				</div>
				<div class="write_btn_group">
					<input type="submit" value="작성완료" accesskey="s" class="btn">
				</div>
				<?php if ($is_checkbox) { ?>
				<div class="bo_fx">
					<?php if ($is_checkbox) { ?>
					<ul class="btn_bo_adm">
						<li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
					</ul>
					<?php } ?>
				</div>
				<?php } ?>

				<?php if ($list_href || $write_href || $write_pages) { ?>
				<div class="list01_num">
					<?php echo $write_pages;  ?>
				</div>
				<div class="list01_btn_group text-center">
					<?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="btn">목록</a><?php } ?>
					<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn">글쓰기</a><?php } ?>
				</div>
				<?php } ?>
			</form>
		</div>
	</section>
</div>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});

<?php } ?>
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}
function fwrite_submit(f){
	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});
	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}
	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}
	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}
	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
	document.getElementById("btn_submit").disabled = "disabled";
	return true;
}
</script>
<!-- } 게시물 작성/수정 끝 -->