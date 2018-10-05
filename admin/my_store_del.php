<?php
include_once ("../common.php");
include_once (G5_PATH."/admin/head.php");
?>
<div class="width-fixed border-top">
    <section class="section01">
        <div class="section01_content">
            <form action="">
                <table>
                    <tr>
                        <th>점주이름</th>
                        <td><input type="text" class="input01" name="mb_name"></td>
                    </tr>
                    <tr>
                        <th>휴대폰번호</th>
                        <td><input type="text" class="input01" name="mb_hp"></td>
                    </tr>
                    <tr>
                        <th>삭제 신청 사유(선택)</th>
                        <td>
                            <textarea name="delete_con" id="delete_con" cols="30" rows="10"></textarea>
                        </td>
                    </tr>
                </table>
                <div class="">
                    <input type="button" value="삭제하기" class="btn grid_100 bg_darkred cart_add">
                </div>
            </form>
        </div>
    </section>
</div>
<?php
include_once (G5_PATH."/admin/tail.php");
?>
