<?php
	include_once("../common.php");
	$id=$_REQUEST['id'];
	//$partner=sql_fetch("select * from `best_partner` where id='".$id."'");
	if(!$is_admin){
		alert("권한이 없습니다.");
	}
	$page=$_POST['page'];

	$sql = "select s.*,m.* from `store_temp` as s left join `g5_member` as m on s.mb_id = m.mb_id where s.id = ".$id;
    $store = sql_fetch($sql);

    $mb = get_member($store["mb_id"]);

    $addr = $store["store_addr1"]." ".$store["store_addr2"];
    $wr_num = get_next_num($write_table);
    $sql = "insert into `g5_write_main` SET 
                    wr_num = '{$wr_num}',
                    wr_subject = '{$store["store_name"]}',
                    mb_id = '{$store["mb_id"]}',
                    ca_name = '{$store["store_cate"]}',
                    wr_email = '{$mb["mb_email"]}',
                    wr_name = '{$mb["mb_name"]}',
                    wr_password = '".get_encrypt_string($store["mb_password"])."',
                    wr_homepage = '{$store["store_homepage"]}',
                    wr_10 = '{$addr}',
                    wr_9 = '{$store["store_hp"]}',
                    wr_5 = 'N',
                    wr_datetime = now(),
                    wr_ip = '{$_SERVER['REMOTE_ADDR']}'                
                    ";
    sql_query($sql);

    $sql = "update `store_temp` set status = 1 where id = ".$id;
    sql_query($sql);

    $id = sql_fetch("select wr_id from `g5_write_main` where mb_id = '{$store["mb_id"]}' and wr_email = '{$mb["mb_email"]}' and wr_subject = '{$store["store_name"]}'");

    $sql = "insert into `store_detail` (wr_id) VALUES ('{$id["wr_id"]}')";
    sql_query($sql);

	alert('저장되었습니다.',G5_URL."/admin/partner_list.php?page=".$page);