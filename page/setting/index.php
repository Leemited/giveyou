<?php
	include_once("../../common.php");
	include_once(G5_PATH."/head.php");
	$best_tel=sql_fetch("select * from `best_tel`");
?>
	<div class="width-fixed">
		<section class="section01">
			<header class="section01_header">
				<h1>설정</h1>
			</header>
			<div class="section01_content wrap">
				<div id="setting">
					<ul>
						<li>
							이벤트 푸쉬알림
							<a href="<?php echo G5_URL."/page/setting/push_update.php"; ?>" class="<?php echo $member['off_gcm']?"off":"on"; ?>"><span></span></a>
						</li>
					</ul>
				</div>
			</div>
		</section>
	</div>
<?php
	include_once(G5_PATH."/tail.php");
?>