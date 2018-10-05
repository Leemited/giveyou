<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<style>
	.list02 li .img{width: 100% !important;cursor: pointer} 
</style>
<div class="width-fixed">
	<section class="section01">
		<!-- <header class="section01_header">
			<h1><?php echo $board['bo_subject']; ?></h1>
			<h3 class="<?php echo $bo_table; ?>_head"></h3>
		</header> -->
		<div class="section01_content wrap min-height">
			<!-- <div class="search01">
				<form name="fsearch" method="get">
					<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
					<input type="hidden" name="sca" value="<?php echo $sca ?>">
					<input type="hidden" name="sop" value="and">
					<label for="sfl" class="sound_only">검색대상</label>
					<div class="select">
						<select name="sfl" id="sfl">
							<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
							<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
							<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
							<option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
							<option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
							<option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
							<option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
						</select>
					</div>
					<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
					<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="input" size="15" maxlength="20">
					<input type="submit" value=" " class="btn">
				</form>
			</div> -->
			<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
				<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
				<input type="hidden" name="stx" value="<?php echo $stx; ?>">
				<input type="hidden" name="spt" value="<?php echo $spt; ?>">
				<input type="hidden" name="sca" value="<?php echo $sca; ?>">
				<input type="hidden" name="sst" value="<?php echo $sst; ?>">
				<input type="hidden" name="sod" value="<?php echo $sod; ?>">
				<input type="hidden" name="page" value="<?php echo $page; ?>">
				<input type="hidden" name="sw" value="">
				<?php if($is_checkbox){ ?><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><?php } ?>
				<div class="list02">
						<ul>
						<?php
							for($i=0; $i<count($list); $i++){
						?>
							<li>
								<?php if($is_checkbox) {?><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i; ?>"><?php  }?>
								<div class="img" onclick="location.href='<?php echo $list[$i]['href']; ?>'">
									<?php
									$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 686, 170);
									if($thumb['src']) {
										$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'">';
									} else {
										$img_content = '<img src="'.G5_IMG_URL.'/no_img.png" alt="'.$thumb['alt'].'">';
									}
									echo $img_content;
									?>
								</div>
							</li>
						<?php
							}
							if(count($list) == 0){
						?>
						<li class="no-list">게시물이 없습니다.</li>
						<?php
							}
						?>
						</ul>
				</div>
				<?php if($is_checkbox){ ?>
				<div class="bo_fx">
					<?php if($is_checkbox){ ?>
					<ul class="btn_bo_adm">
						<li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
						<li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>
					</ul>
					<?php } ?>
				</div>
				<?php } ?>

				<?php if($list_href || $write_href || $write_pages){ ?>
				<div class="list01_num">
					<?php echo $write_pages;  ?>
				</div>
				<div class="list01_btn_group text-center">
					<?php if($list_href){ ?><a href="<?php echo $list_href ?>" class="btn">목록</a><?php } ?>
					<?php if($write_href){ ?><a href="<?php echo $write_href ?>" class="btn">글쓰기</a><?php } ?>
				</div>
				<?php } ?>
			</form>
		</div>
	</section>
</div>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
