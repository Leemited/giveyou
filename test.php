<?php
include_once ("./common.php");
include_once (G5_EXTEND_PATH."/gcm.extend.php");

$regid = "eD8hbm2OLAc:APA91bEKCtOYl25cqT2NBnphNrkwLDH34CqCQEC627BM48QRoXBoNNXEq6IRoc-Wv4xYMg2HNCJkqS23ete6UC5H43eMtSfnL88s_550wzGsdkdbvU3kWXrQvjd4QuGQ7FtshQ3lxMUjtZMH8-8uZ3HzHmRweQh02w";

$result = send_GCM($regid,"기뷰 주문","주문요청이 들어왔습니다.","http://giveyou.kr/page/shop/index.php");

print_r2($result);

?>