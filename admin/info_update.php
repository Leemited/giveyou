<?php
	include_once("../common.php");
	$id=$_REQUEST['id'];
	//$partner=sql_fetch("select * from `best_partner` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];

    $name=$_POST['name'];
    $email=$_POST['email'];
    $addr=$_POST['addr1']." ".$_POST['addr2'];
    $tel=$_POST['tel'];
    $fax=$_POST['fax'];
   
    $sql = "update `gopa_tel` SET  name = '{$name}', addr = '{$addr}',email = '{$email}', tel = '{$tel}', fax = '{$fax}'";
    sql_query($sql);

//    $sql = "insert into `gopa_tel` (addr,email,tel,fax) VALUES ('{$addr}','{$email}','{$tel}','{$fax}')";
//    sql_query($sql);

	alert('저장되었습니다.',G5_URL."/admin/info_list.php?page=".$page);