<?php
include_once('../../common.php');
$wr_id=$_POST['id'];
$view=sql_fetch("select a.*,b.* from `g5_write_main` as a left join `store_detail` as b on a.wr_id = b.wr_id where a.wr_id='{$wr_id}' ");
$file = get_file("main", $wr_id);
?>
<style>
	.share_view div{background-color:#fff;}
	#view_section{position: initial !important}
	#reserve_result .con h2{background: none;color: #000;font-weight: bold;text-align: center;font-size: 6vw}
	#reserve_result .con h2 span{color: #f17a40}
	.share_view ul li a#blog_link_btn{background: url(../../img/blog.png) no-repeat center;background-size: auto 90%;width: 100%;height: 80px;display: block;}
	.share_view ul li a#kakaostory{background: url(../../img/kakao.png) no-repeat center;background-size: auto 90%;width: 100%;height: 80px;display: block;}
	.share_view ul li a#insta{background: url(../../img/instat.png) no-repeat center;background-size: auto 90%;width: 100%;height: 80px;display: block;}
	#reserve_result {text-align:center;padding-top:20px !important;}
	#reserve_result h2{font-size:20px;}
	#reserve_result h2 span{color:#f17a40}
</style>
<div class="share_view reserve_view" style="background-color:transparent;">	
	<img src="<?php echo G5_IMG_URL?>/share_title.png" alt="" style="width: 60%;padding: 0 0 20px 0;">
	<div>
		<div id="reserve_result">
			<h2>착한가게 <span>SNS</span> 공유하기</h2>
			<div class="con">			
				<div class="cart_add" style="margin-top:0">
					<a href="javascript:modal_close();"><img src="<?php echo G5_IMG_URL?>/modal_close_btn.png" alt="" style="top:20px;right:20px;width:9%"></a>
				</div>
			</div>
		</div>
		<ul>
			<li><a id="kakao_link_btn" href="javascript:sendLink();"></a></li>        
			<li><a id="fb_link_btn" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']); ?>&title=<?php echo $view['wr_subject']; ?>&description=<?php echo $view['wr_content']; ?>&img=<?php echo G5_DATA_URL."/file/main/".$file[0]['file']; ?>"  ></a></li>
			<li><a id="band_link_btn" href='http://band.us/plugin/share?body=<?php echo $view['wr_subject']; ?>&route=<?php echo G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']; ?>' ></a></li>
			<li><a id="blog_link_btn" href="http://blog.naver.com/openapi/share?url='<?php echo G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']; ?>'"></a></li>
			<li><a id="kakaostory" href="https://story.kakao.com/share?url=<?php echo G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']; ?>" ></a></li>
			<!-- <li><a id="insta" href="https://www.instagram.com/sharer/sharer.php?u=<?php echo urlencode(G5_URL."/page/rent/view.php?wr_id=".$wr_id."&wr_subject=".$view['wr_subject']); ?>&title=<?php echo $view['wr_subject']; ?>&description=<?php echo $view['wr_content']; ?>&img=<?php echo G5_DATA_URL."/file/main/".$file[0]['file']; ?>"  target = "_blank" ></a></li> -->
		</ul>
		<div class="clear"></div>
	</div>
</div>


