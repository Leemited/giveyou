<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class="width-fixed">
	<section class="section01">
		<header class="section01_header">
			<h1><?php echo $g5["title"]?></h1>
			<!--<h3 class="notice_head"></h3>-->
			<!--<p>고파의 주요 공지사항을 알려드립니다.</p>-->
		</header>
		<div class="section01_content wrap">
			<div class="form_list01">
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
                <input type="hidden" name="wr_1" value="<?php echo $_REQUEST["parent_id"]?>">
				<?php
				$option = '';
				$option_hidden = '';
				if ($is_notice || $is_html || $is_secret || $is_mail) {
					$option = '';
					if ($is_notice) {
						$option .='<input type="checkbox" id="notice" name="notice" class="check01" value="1" '.$notice_checked.'><label for="notice" class="check01_label"></label><label for="notice">공지</label>';
					}
				}
				echo $option_hidden;
				?>
					<ul>
						<?php if ($option) { ?>
						<li>
							<div class="grid_100">
								<label for="notice">옵션</label>
								<div><span class="option"><?php echo $option ?></span></div>
							</div>
						</li>
						<?php } ?>
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
						<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
						<li>
							<div class="grid_100">
								<label for="bf_file">파일 #<?php echo $i+1 ?></label>
								<div>
									<input type="file" name="bf_file[]" class="grid_100" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능">
									<?php if($w == 'u' && $file[$i]['file']) { ?>
									<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
									<?php } ?>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="write_btn_group">
					<input type="submit" value="작성완료" accesskey="s" class="btn">
				</div>
			</form>
		</div>
	</section>
	<?php
	//$best_tel=sql_fetch("select * from `best_tel`");
	?>
	<!--<div class="sub_call_pop">
		<div class="top">
			<i></i>
			<div>
				<h3>빠르고 간편한</h3>
				<h2>전화예약</h2>
			</div>
		</div>
		<div class="bottom">
			<h1><?php /*echo dot_hp_number($best_tel['tel']); */?></h1>
			<p><?php /*if(!$best_tel['all']){ */?><?php /*echo date("A h:i",strtotime($best_tel['time1'])); */?>&nbsp;&nbsp;~&nbsp;&nbsp;<?php /*echo date("A h:i",strtotime($best_tel['time2'])); */?><?php /*}else{ */?>연중무휴 24시간 영업<?php /*} */?></p>
		</div>
	</div>-->
</div>

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

function fwrite_submit(f)
{
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