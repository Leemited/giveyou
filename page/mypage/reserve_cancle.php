<?php
	include_once("../../common.php");
	sql_query("update `best_reserve` set `status`='-1' where id='{$id}';");
	alert('취소 되었습니다.');