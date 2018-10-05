<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 회원수는 $row['mb_cnt'];

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$connect_skin_url.'/style.css">', 0);
?>
<section id="visit">
    <div>
        <dl>
		<dt>현재 접속자 수&nbsp;&nbsp;&nbsp;<?php echo $row['total_cnt'] ?></dt>
        </dl>
        <!-- <?php if ($is_admin == "super") {  ?><a href="<?php echo G5_ADMIN_URL ?>/visit_list.php">상세보기</a><?php } ?> -->   
	</div>
</section>