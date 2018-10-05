<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<style>
	.view01{border: 0}
	.view01 .con{padding:0;padding-bottom: 28px}
</style>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<div class="width-fixed">
	<section class="section01">
		<div class="section01_content ">
			<div class="view01">				
				<?php				
				if ($view['file']['count']) {
					$cnt = 0;
					for ($i=0; $i<count($view['file']); $i++) {
						if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
							$cnt++;
					}
				}
				 ?>
				<?php if($cnt) { ?>
				<!-- 첨부파일 시작 { -->
				<div class="file">
					<ul>
					<?php
					// 가변 파일
					for ($i=0; $i<count($view['file']); $i++) {
						if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
					 ?>
						<li>
							<a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download">
								file<?php echo $i+1; ?> : 
								<?php echo $view['file'][$i]['source'] ?><?php echo $view['file'][$i]['content'] ?> (<?php echo $view['file'][$i]['size'] ?>)
							</a>
						</li>
					<?php
						}
					}
					 ?>
					</ul>
				</div>
				<!-- } 첨부파일 끝 -->
				<?php
					} 
				?>
				<div class="con">
					<img src="<?php echo $view["file"][1]["path"];?>/<?php echo $view["file"][1]["file"];?>" alt="">
					<?php
						// 파일 출력
						/*$v_img_count = count($view['file']);
						if($v_img_count) {
							for ($i=0; $i<1; $i++) {
								if ($view['file'][$i]['view']) {
									echo $view['file'][$i]['view'];
									echo get_view_thumbnail($view['file'][$i]['view']);
									echo " <img src='".$view['file'][$i]['path']."/".$view['file'][$i]['file']."' alt='".$view['wr_subject']."' />";
								}
							}
						}*/
					?>
					<?php if($view["wr_id"]==1){?>
					<div class="give_btn_area">
						<div class="give_btn" onclick="location.href=g5_url+'/page/inquiry/'" style="background-color:#494949">
							<span>상점입점</span> 하러 가기
						</div>
						<p class="event_p">상점도 알리고 좋은일에 작은 실천부터 해보시는 것은 어떨까요?</p>
					</div>
					<img src="<?php echo G5_IMG_URL?>/event_ft.jpg" alt="" style="padding:10px;">
					<?php }?>
					<?php //echo $view['wr_content']; ?>
					<?php if($write_href || $update_href || $delete_href){ ?>
					<div class="writer_btn">
						<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn bg_white bd_gray">글쓰기</a><?php } ?>
						<?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="btn bg_black color_white">수정</a><?php } ?>
						<?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="btn bg_darkred color_white" onclick="del(this.href); return false;">삭제</a><?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="list01_btn_group text-center">
					<a href="<?php echo $list_href ?>" class="btn text-center">목록</a>
				</div>
			</div>
		</div>
	</section>
	
</div>

<script>
function fnBack(url) {
	location.href = url;
}
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->