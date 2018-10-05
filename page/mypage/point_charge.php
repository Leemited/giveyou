<?php
include_once ("../../common.php");
$wr_id=$member["mb_id"];
$wr_subject="내포인트";
$back_url= G5_URL;
include_once ("../../head.php");
$sql_common = " from {$g5['point_table']} ";

$stx =$member["mb_id"];
$sql_search = " where mb_id = '{$stx}'";
$sql_order = "order by po_id desc";
$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            ";
$result = sql_query($sql);
$mb = array();
if ($stx)
    $mb = get_member($stx);

//$g5['title'] = '포인트관리';
//include_once ('./admin.head.php');

$po_expire_term = '';
if($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id"))
    $mb_id = $stx;
else
    $mb_id = "";

while($row=sql_fetch_array($result)){
    $list[] = $row;
}

?>
<style>
    .total_point,.point_list {width:90%;padding:5%;}
    .total_point div{border:1px solid #ddd; background:#eee;padding:10px 5%;border-radius: 5px;width:90%;font-size: 17px}
    .point_list table{width:100%;}
    .point_list table th{text-align:center;padding:5px 0; font-size: 16px;font-weight: bold;background: #cf1616;color:#fff;}
    .point_list table td{border:1px solid #ddd;text-align:center;padding:5px 0; font-size: 14px;}
    .point_list h3{text-align: center;color: #cf1616;padding:15px 0;font-size:18px}
    .point_charge{width:90%;padding:5%;}
    .point_charge p{padding:10px 0;font-size:14px;}
    .point_charge p.right{text-align:right;width:100%;}
    .point_charge input{width:100%;padding:10px 5px;font-size:14px;}
    .point_charge input[type=submit]{background: #cf1616;color:#fff;border:none;}
    .point_charge ul{width:100%;display:-webkit-inline-box}
    .point_charge ul li{margin-right:3%;width:22%;text-align:center;border:1px solid #ddd;padding:6px 0;font-size:14px;cursor: pointer}
    .point_charge ul li.last{margin-right:0;}
    .point_charge ul li.active, .point_charge ul li:hover {background: #cf1616;color:#fff;border:1px solid #cf1616}
    .point_charge h3{text-align: center;color: #cf1616;padding:15px 0;font-size:18px}
    .point_tab{width:100%;border-top:1px solid #ddd}
    .point_tab li{float:left;width:50%;padding:10px 0;font-size:15px;background: #cf1616;color:#fff;border-bottom:2px solid #cf1616;text-align:center;cursor: pointer;}
    .point_tab li.active, .point_tab li:hover{font-weight:bold;background:#fff;color:#cf1616;}
</style>
<div class="width-fixed view">
    <div>
        <ul class="point_tab">
            <li onclick="location.href=g5_url+'/page/mypage/point.php'">내포인트</li>
            <li class="active">포인트충전</li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<section class="section01">
    <div class="section01_content">
        <div class="total_point">
            <div>총 포인트 : <?php echo number_format($mb['mb_point']);?> P</div>
        </div>
        <div class="point_charge">
            <form action="">
                <h3>포인트 충전</h3>
                <ul>
                    <li>신용카드</li>
                    <li>카카오페이</li>
                    <li>무통장입금</li>
                    <li class="last">휴대폰결제</li>
                </ul>
                <div>
                    <p>충전포인트</p>
                    <input type="text" name="charge_point" id="charge_point" class="input01" onkeyup="number_only(this)">
                    <input type="hidden" name="total_price" id="total_price">
                </div>
                <div>
                    <p class="right">총 결제 금액 : <span class="total_price">0</span> 원</p>
                </div>
                <div class="point_btn_group">
                    <input type="submit" value="충전하기" class="point_btn">
                </div>
            </form>
        </div>
        <div class="point_list">
            <h3>포인트 충전 내역</h3>
            <table>
                <tr>
                    <th>날짜</th>
                    <th>입금자</th>
                    <th>입금액</th>
                    <th>입금상태</th>
                </tr>
                <?php for($i=0;$i<count($list);$i++){?>
                    <tr>
                        <td><?php echo $list[$i]["po_datetime"];?></td>
                        <td><?php echo $i+1;?></td>                        
                        <td><?php echo number_format($list[$i]["po_point"])?></td>
                        <td><?php echo $list[$i]["po_content"];?></td>
                        
                    </tr>
                <?php }
                if(count($list)==0){?>
                    <tr><td colspan="4">포인트 사용내역이 없습니다.</td></tr>
                <?php }?>
            </table>
        </div>
    </div>
</section>
<script>
    $("#charge_point").change(function(){
        var point = $(this).val();
        var total = point * 100;
        $("#total_price").val(total);
        $(".total_price").html(total.format());
    })
</script>
<?php
include_once ("../../tail.php");
?>

