<?php
include_once ("../../common.php");


$regid = $_REQUEST["regid"];
$mb_id = $_REQUEST["mb_id"];

$result = sql_query("update `g5_member` set regid = '{$regid}' where mb_id = '{$mb_id}'");

?>