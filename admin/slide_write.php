<?php
include_once("../common.php");
$p=true;
include_once(G5_PATH."/admin/head.php");
if($id){
    $write=sql_fetch("select * from `best_partner` where id='".$id."'");
}
?>
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>슬라이드 등록</h1>
            <hr />
        </header>
        <article>
            <form action="<?php echo G5_URL."/admin/slide_insert.php"; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="page" value="<?php echo $page; ?>" />
				<input type="hidden" name="mb_id" id="mb_id"  />
				<input type="hidden" name="store_name" id="store_name"/>
                <div class="adm-table02">
                    <table>
						<tr>
							<th>상점명</th>
							<td>
								<input type="button" value="선택하기" class="adm-btn01" onclick="fn_open();"/>
							</td>
						</tr>
                        <tr>
							<th>슬라이드 이미지</th>
							<td>
								<input type="file" name="image" />
							</td>
						</tr>
						<tr>
							<th>등록일</th>
							<td>
								<input type="text" name="wr_1"  /> ~ <input type="text" name="wr_2" />
							</td>
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
function fn_open(){
	window.open(g5_url+"/admin/slide_store_list.php", "store_list", "width=600,height=600,top=0;left=0");
}
</script>
<?php
include_once(G5_PATH."/admin/tail.php");
?>
