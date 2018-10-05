<?php
include_once("../common.php");
$p=true;
include_once(G5_PATH."/admin/head.php");
if($id){
    $write=sql_fetch("select * from `banner_list` where id='".$id."'");
}

 $where = " m.wr_is_comment = 0 ";

	if($search){
		$where .="and m.wr_subject like '%{$search}%'";
	}
	$total=sql_fetch("select count(m.*) as cnt from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where 1 {$where}");
	if(!$page)
		$page=1;
	$total=$total['cnt'];
	$rows=10;
	$start=($page-1)*$rows;
	$total_page=ceil($total/$rows);
	$sql="select m.*,s.* from `g5_write_main` as m left join `store_detail` as s on m.wr_id = s.wr_id where {$where} and m.wr_6 = 'Y' order by m.`wr_id` desc limit {$start},{$rows}";
	$query=sql_query($sql);
	$j=0;
	while($data=sql_fetch_array($query)){
		$list[$j]=$data;
		$list[$j]['num']=$total-($start)-$j;
		$j++;
	}
?>
<script src="<?php echo G5_JS_URL ?>/jquery-1.8.3.min.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery-ui.js"></script>
<!--
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
-->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
        
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>리스트관리</h1>
            <hr />
        </header>
        <article>
            <form action="<?php echo G5_URL."/admin/list_update.php"; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="page" value="<?php echo $page; ?>" />
                <div class="adm-table02">
                    <table>
                        <tr>
                            <th>업체이름</th>
                            <td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
                        </tr>                        
                        <tr>
                            <th>전화번호</th>
                            <td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['tel']; ?>" /></td>
                        </tr>
                        <tr>
                            <th>배너</th>
                            <td><input type="file" name="banner" id="banner" class="adm-input01" /></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td><input type="file" name="content" id="content" <?php echo $id?"":"required"; ?> class="adm-input01" /></td>
                        </tr>
                        <tr>
                            <th>노출순서</th>
                            <td>
                            <select name="seq" id="seq" required class="adm-input01 grid_100">
                                    <option value="" selected>선택하세요(숫자가 작을수록 앞에 보여집니다)</option>
                                <?php for($i=0;count($list)>$i;$i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i+1; ?></option>
                                <?php } ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <th>노출날짜</th>
                            <td>
                            <input type="text" required name="seq_time" id="date" class="adm-input01 grid_30" style="cursor:pointer" placeholder="날짜를 선택하세요"/>
                            ~
                            <input type="text" required name="seq_time1" id="date2" class="adm-input01 grid_30" style="cursor:pointer" placeholder="날짜를 선택하세요"/>
                            * 중복될수 없습니다.
<!--
                            <select name="seq_time" id="date" required class="adm-input01 grid_100">
                                    <option value="" selected>선택하세요</option>
                                <?php for($i=1;11>$i;$i++){ ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i."년"; ?></option>
                                <?php } ?>
                            </select>
-->

                            </td>
                        </tr>
                        <tr>
                            <th>아이디</th>
                            <td><input type="text" name="mb_id" id="mb_id" required class="adm-input01 grid_100" value="<?php echo $write['mb_id']; ?>" /></td>
                        </tr>
                        <tr>
                            <th>배너보이기</th>
                            <td><input type="checkbox" name="show" id="show" class="adm-input01" <?php echo $write['show']?"checked":""; ?> /> <label for="show">배너보이기</label></td>                            
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
   
<script type="text/javascript">
       $(document).ready(function(){
             $("#date").datepicker({
                changeMonth:true,
                changeYear:true,
                 yearRange:"-10:+10",
                dateFormat:"yy-mm-dd"
             });
       });
       $(document).ready(function(){
             $("#date2").datepicker({
                changeMonth:true,
                changeYear:true,
                yearRange:"-10:+10",
                dateFormat:"yy-mm-dd"
             });
       });
</script>
<?php
include_once(G5_PATH."/admin/tail.php");
?>
