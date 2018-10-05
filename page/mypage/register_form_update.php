<?php
include_once("../../common.php");

$mb_id = $_REQUEST["join_mb_id"];
$mb_password = $_REQUEST["reg_password"];
$mb_sms = $_REQUEST["mb_sms"];
$mb_mailing = $_REQUEST["mb_mailing"];
$mb_hp = $_REQUEST["reg_hp"];

$m_pass = "select password('{$mb_password}') as p;";
$pass = sql_fetch($m_pass);
$sql = "insert into `g5_member` (mb_id,mp_password,mb_sms,mb_mailing,mb_datetime,mb_hp) values ('{$mb_id}','{$pass[p]}','{$mb_sms}','{$mb_mailing}',now(),'{$mb_hp}')";
echo $sql;
/*
sql_query($sql);

alert("회원가입 완료");*/
?>