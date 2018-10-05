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
            <h1>배너관리</h1>
            <hr />
        </header>
        <article>
            <form action="<?php echo G5_URL."/admin/banner_update.php"; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <input type="hidden" name="page" value="<?php echo $page; ?>" />
                <div class="adm-table02">
                    <table>
                        <tr>
                            <th>업체이름</th>
                            <td><input type="text" name="name" id="name" required class="adm-input01 grid_100" value="<?php echo $write['name']; ?>" /></td>
                        </tr>
                        <tr>
                            <th>링크 상점 번호</th>
                            <td><input type="tel" name="tel" id="tel" required class="adm-input01 grid_100" onkeyup="return number_only(this);" value="<?php echo $write['tel']; ?>" /></td>
                        </tr>
                        <tr>
                            <th>배너</th>
                            <td><input type="file" name="banner" id="banner" class="adm-input01" /></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td><input type="text" name="content" id="content" class="adm-input01 grid_100" value="<?php $write["content"];?>"/></td>
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
<?php
include_once(G5_PATH."/admin/tail.php");
?>
