<?php
include_once ("../common.php");
$ca_id = $_REQUEST["ca_id"];
$wr_id = $_REQUEST["wr_id"];
$cate_name = $_REQUEST["cate_name"];
$type = $_REQUEST["type"];
if($type=="cateadd"){
    $chk = sql_fetch("select COUNT(*)as cnt from `store_category` where wr_id={$wr_id} and ca_name={$cate_name}");
    if($chk["cnt"]>0){
        alert("이미 등록되어 있는 메뉴분류 입니다.", G5_URL."/admin/my_store_menu_edit.php?wr_id=".$wr_id);
    }else{
        $sql = "insert into `store_category` (wr_id,ca_name) VALUES ('{$wr_id}','{$cate_name}')";
    }
    sql_query($sql);
    alert("등록 되었습니다.", G5_URL."/admin/my_store_menu_edit.php?wr_id=".$wr_id);
}else if($type=="catedel"){
    $chk = sql_fetch("select COUNT(*)as cnt from `store_menu` where wr_id={$wr_id} and ca_name='{$ca_name}'");
    if($chk["cnt"]>0){
        alert("해당 분류에 상품이 등록되어 있습니다.",G5_URL."/admin/my_store_menu_edit.php?wr_id=".$wr_id);
    }
    $sql = "delete from `store_category` where id = '{$ca_id}'";
    sql_query($sql);
    alert("삭제 되었습니다.", G5_URL."/admin/my_store_menu_edit.php?wr_id=".$wr_id);
}else if($type=='menuadd'){

    //파일 등록
    $etc3 = $_FILES["menu_image"]["name"];
    $ext = array_pop(explode(".",$etc3));

    $dir = G5_DATA_PATH . "/shop/menu";
    @mkdir($dir, G5_DIR_PERMISSION);
    @chmod($dir, G5_DIR_PERMISSION);
    $filename1 = time() . "_etc3." . $ext;
    $path1 = $dir . "/" . $filename1;
    if ($_FILES['menu_image']['tmp_name']) {
        $size = getimagesize($_FILES['menu_image']['tmp_name']);
        $width = $size[0];
        $height = $size[1];
        $ratio = ceil(9/6);
        $imgRatio = ceil($width/$height);
        if($imgRatio != $ratio){
            alert("이미지 비율은 9:6입니다.".'\r\n'."ex) 너비 / 높이 = 9 / 6 ");
        }

        image_resize_update($_FILES['menu_image']['tmp_name'], $_FILES['menu_image']['name'], $path1, 1100);
    }

    $menu_name = $_REQUEST["menu_name"];
    $menu_detail = $_REQUEST["menu_detail"];
    $menu_price = $_REQUEST["menu_price"];
    $op = $_REQUEST["menu_option"];
    $op_pr = $_REQUEST["option_price"];
    if(count($op) > 1) {
        $option = implode("|", $op);
        $option_price = implode("|", $op_pr);
    }else{
        $option = $op[0];
        $option_price = $op_pr[0];
    }

    $sql = "insert into `store_menu` (`wr_id`,`ca_name`,`menu_name`,`menu_detail`,`menu_price`,`menu_image`,`option`,`option_price`) VALUES  ('{$wr_id}','{$cate_name}','{$menu_name}','{$menu_detail}','{$menu_price}','{$filename1}','{$option}','{$option_price}')";
    sql_query($sql);
    alert("등록 되었습니다.",G5_URL."/admin/my_store_menu_2depth_edit.php?wr_id={$wr_id}&ca_name={$cate_name}");
}else if($type=="deloption"){
    $num = $_REQUEST["num"];
    $id = $_REQUEST["id"];

    $sql = "select `option` , `option_price` from `store_menu` where id = '{$id}'";
    $chk = sql_fetch($sql);
    $option = explode("|", $chk["option"]);
    $option_price = explode("|", $chk["option_price"]);
    unset($option[$num]);
    unset($option_price[$num]);
    $option_new = implode("|", $option);
    $option_price_new = implode("|", $option_price);
    $sql= "update `store_menu` set `option`='{$option_new}', `option_price`='{$option_price_new}' where id='{$id}'";

    if(sql_query($sql)){
        echo "0";
    }else{
        echo "1";
    }
}else if($type=="menudel"){

    $menu_id = $_REQUEST["menu_id"];
    $sql = "delete from `store_menu` where id = '{$menu_id}'";
    //파일 있을 시 파일도 삭제

    sql_query($sql);

    alert("삭제되었습니다.", G5_URL."/admin/my_store_menu_2depth_edit.php?wr_id={$wr_id}&ca_name={$cate_name}");
}else if($type=="menuupdate"){
    $menu_id = $_REQUEST["menu_id"];
    $menu_name = $_REQUEST["menu_name"];
    $menu_detail = $_REQUEST["menu_detail"];
    $menu_price = $_REQUEST["menu_price"];
    $op = $_REQUEST["menu_option"];
    $op_pr = $_REQUEST["option_price"];
    if(count($op) > 1) {
        $option = implode("|", $op);
        $option_price = implode("|", $op_pr);
    }else{
        $option = $op[0];
        $option_price = $op_pr[0];
    }

    $filechk = sql_fetch("select menu_image from `store_menu` where id = '{$menu_id}'");

    //이미지 수정 추가
    //파일 등록
    $etc3 = $_FILES["menu_image"]["name"];
    $ext = array_pop(explode(".",$etc3));

    $dir = G5_DATA_PATH . "/shop/menu";
    @mkdir($dir, G5_DIR_PERMISSION);
    @chmod($dir, G5_DIR_PERMISSION);
    $filename1 = time() . "_menu." . $ext;
    $path1 = $dir . "/" . $filename1;
    if ($_FILES['menu_image']['tmp_name']) {
        $size = getimagesize($_FILES['menu_image']['tmp_name']);
        $width = $size[0];
        $height = $size[1];
        $ratio = ceil(9/6);
        $imgRatio = ceil($width/$height);
        if($imgRatio != $ratio){
            alert("이미지 비율은 9:6입니다.".'\r\n'."ex) 너비 / 높이 = 9 / 6 ");
        }

        image_resize_update($_FILES['menu_image']['tmp_name'], $_FILES['menu_image']['name'], $path1, 1100);
        $photo = $filename1;
        $photo_sql = ",`menu_image`='" . $filename1 . "'";
        if($menu_id){
            @unlink($dir."/".$filechk['menu_image']);
        }
    }

    $sql = "update `store_menu` set menu_name = '{$menu_name}', menu_detail = '{$menu_detail}' , menu_price = '{$menu_price}', menu_image = '{$menu_image}', `option` = '{$option}' , `option_price` = '{$option_price}' {$photo_sql} where id ='{$menu_id}'";
    sql_query($sql);

    alert("수정되었습니다.", G5_URL."/admin/my_store_menu_2depth_edit.php?wr_id={$wr_id}&ca_name={$cate_name}");
}
