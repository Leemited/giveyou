<?php
include_once("../common.php");
$mb_id = $_POST['mb_id'];
$point = number_format($_POST['po_mb_point']);
$po_content = $_POST['po_content'];
$str = explode(",",$mb_id);
if(count($str)>1){
    for($i=0;$i<count($str);$i++){
        insert_point($str[$i], $point, $po_content, $main, $member['mb_id'], $po_content);    
    }
}else{
    insert_point($mb_id, $point, $po_content, $main, $member['mb_id'], $po_content);    
}
alert('저장되었습니다.',G5_URL."/admin/point_shop.php?page=".$page);
?>