<?php
include_once ("../../common.php");

$id = $_REQUEST["id"];

$sql = "update `g5_write_main` set wr_7 = 1 where wr_id = '{$id}'";

sql_query($sql);