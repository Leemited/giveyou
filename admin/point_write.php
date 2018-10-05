<?php
include_once("../common.php");
$p=true;
include_once(G5_PATH."/admin/head.php");
    if($search){
        $str=str_replace(",","','","$search");        
        $write=sql_fetch("select p.*,m.mb_level,m.mb_name from `g5_point` as p inner join `g5_member` as m on p.mb_id=m.mb_id where m.mb_level = '1' {$where} order by `po_id` desc");
        print_r($write);
    }
    if($sel!="" && $search!=""){
            $where .= " and {$sel} in ('{$str}')";
        }
    if($id){
        $where .=" and p.po_id='".$id."'";
    }
	
	$total=sql_fetch("select count(m.*) as cnt from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where 1 {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select p.*,m.mb_level,m.mb_name from `g5_point` as p inner join `g5_member` as m on p.mb_id=m.mb_id where m.mb_level = '1' {$where} order by `po_id` desc";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}

?>
<style type="text/css">
	.grid_25{width:25% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_60{width:60% !important;display:inline-block;float:left;box-sizing:border-box;}
	.grid_15{width:15% !important;display:inline-block;float:left;box-sizing:border-box;}
	.lh30{line-height:30px !important;}
</style>
<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery-ui.js"></script>

        
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>포인트관리(회원)</h1>
            <hr />
        </header>
        <article>
           	<div class="grid_100" style="margin-bottom:30px">
				<form action="" method="get">
					<div class="grid_25">
						<select name="sel" id="sel" class="grid_100 adm-input01">
							<option value="p.mb_id" <?php echo $sel=="mb_id"?"selected":""; ?>>아이디</option>
							<option value="m.mb_name" <?php echo $sel=="mb_name"?"selected":""; ?>>이름</option>
                            <option value="p.podatetime" <?php echo $sel=="mb_name"?"selected":""; ?>>적립일</option>
<!--							
							<option value="p.mb_hp" <?php echo $sel=="mb_hp"?"selected":""; ?>>휴대폰번호</option>
-->
						</select>
					</div>
					<div class="grid_60 pl10"><input type="text" name="search" id="search" class="grid_100 adm-input01" value="<?php echo ($search)?$search:$write['mb_id']; ?>" /></div>
					<div class="grid_15 pl10"><input type="submit" class="grid_100 color_white lh30 btn" style="background:#666;border:none;" value="검색" /></div>
				</form>
			</div>
            <form action="<?php echo G5_URL."/admin/point_update.php"; ?>" method="post" enctype="multipart/form-data">
               <input type="hidden" name="id" value="<?php echo $write['po_id']; ?>" />
                <input type="hidden" name="page" value="<?php echo $page; ?>" />
                <div class="adm-table02">
                    <table>
                        <tr>
                            <th>아이디</th>
                            <td><input type="text" name="mb_id" id="mb_id" required  class="adm-input01 grid_100" value="<?php echo ($search)?$search:$write['mb_id']; ?>" /></td>
                        </tr>
                        <tr>
                            <th>적용포인트</th>
                            <td><input type="text" name="po_mb_point" id="po_mb_point" required class="adm-input01 grid_100" value="<?php echo $write['po_point']; ?>" /></td>
                        </tr> 
                        <tr>
                            <th>내용</th>
                            <td><input type="text" name="po_content" id="po_content" required class="adm-input01 grid_100" value="<?php echo $write['po_content']; ?>" /> </td>
                        </tr>         
                    </table>
                </div>
                <div class="text-center mt20">
                    <input type="submit" value="확인" class="adm-btn01" />
                </div>
            </form>
        </article>
    </section>
</div>



<?php
include_once(G5_PATH."/admin/tail.php");
?>
