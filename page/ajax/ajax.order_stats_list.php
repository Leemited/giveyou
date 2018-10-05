<?php
include_once ("../../common.php");
$align_type = $_REQUEST["align_type"];
$wr_id = $_REQUEST["wr_id"];
$day = $_REQUEST["day"];
$year = $_SERVER["year"];
$today = date("Y-m-d");
if(!$day){
    $day = $today;
}
if(!$year){
    $year = date("Y");
}

$order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and order_date like '%{$day}%' order by order_date desc ");

while($row = sql_fetch_array($order)){
    $list[] = $row;
}

$preDate = date("Y-m-d" , strtotime($day." -1 day"));
$nextDate = date("Y-m-d" , strtotime($day." +1 day"));

?>
<style>
    .mt_b_30{margin-bottom:63px;}
    .ui-datepicker{width:98%;font-size:18px;}
    .ui-state-highlight{border:none !important;background: #8fa4ff;font-weight: bold ;color: #fff }
    .ui-state-default{text-align: center !important;padding:5px !important;font-size:16px;}
    .ui-state-default:hover, .ui-state-active{background:#ff2959 !important;font-weight: bold !important;color: #fff !important}
    .order_list{background: #eee;padding:10px;}
    .order_list table{width:100%;margin-bottom:10px;}
    .order_list table tr{background: #fff;}
    .order_list table th{text-align: left;padding:5px;width:30%;border-right:1px solid #ddd;}
    .order_list table td{text-align: left;padding:5px;}
    .search, .select_date{border-top:1px solid #ddd;padding:10px 0;}
    .search .search_input{text-align:center;display: list-item;}
    .search select{width:28%; margin-right: 4%;}
    .search select.last{margin-right: 0;}
    .select_date .date_search{text-align: center;padding:0 10px;}
    .select_date .date_search input[type=button]{width:40px;}
    .select_date .date_search input[type=text]{width:60%;font-size:26px; font-weight: bold;text-align: center}
    .date_btn_group{padding:10px;text-align: center}
    .date_btn_group input[type=button]{color:#fff;font-size:15px;width:96%;padding:2% 0;}
    .bg_white{background: #fff !important;}
    .total{position:fixed;bottom:0;width:90%;padding:20px 5%;font-size:20px;color:#fff;background:#cf1616;z-index:90;}
    .total span{text-align:center}
    .total input{position: absolute;right: 5%;padding: 10px;top: 14px;border: none;background: #fff;}
    @media all and (max-width: 1120px){
        .ui-datepicker{width:30%;margin:0 auto}
    }
    @media all and (max-width: 900px){
        .ui-datepicker{width:40%;}
    }
    @media all and (max-width: 768px){
        .ui-datepicker{width:50%;}
    }
    @media all and (max-width: 540px){
        .ui-datepicker{width:98%;}
    }
</style>
<div class="select_date">
    <div class="date_search">
        <div id="datepicker"></div>
        <!--<input type="button" class="btn input01 bg_white"  value=" 이전 " onclick="location.href='<?php /*echo G5_URL."/page/shop/store_order_stats.php?day=".$preDate;*/?>'" >-->
        <input type="hidden"  class="input01" value="<?php echo $day?>" id="datepickers" onchange="fnStats(this.value, '<?php echo $wr_id ;?>')">
        <!--<input type="button" class="btn input01 bg_white" value=" 이후 " onclick="location.href='<?php /*echo G5_URL."/page/shop/store_order_stats.php?day=".$nextDate;*/?>'" >-->
    </div>
    <div class="date_btn_group">
        <input type="button" class="btn bg_darkred grid_100" value="검색">
    </div>
</div>
<div class="order_list">
    <?php
    for($i=0;$i<count($list);$i++){
        $date = explode(" ", $list[$i]["order_date"]);
        $menu = explode(",", $list[$i]["order_menu"]);
        $menu_count = explode(",", $list[$i]["order_count"]);
        $option = explode(",", $list[$i]["order_option"]);
        $option_price = explode(",", $list[$i]["order_option_price"]);
        $price = explode(",",$list[$i]["order_price"]);
        for($p=0;$p<count($price);$p++){
            $total += $price[$p];
        }
        ?>
        <table>
            <form action="<?php echo G5_URL?>/page/shop/order_state_update.php" method="post">
                <tr>
                    <th>주문일자</th>
                    <td>
                        <input type="hidden" value="<?php echo $list[$i]['order_id'];?>" name="order_id">
                        <input type="hidden" value="<?php echo $wr_id ;?>" name="wr_id">
                        <input type="hidden" value="<?php echo $list[$i]['delivery_state'];?>" name="delivery_state">
                        <input type="hidden" value="<?php echo date("YmdHis",strtotime($list[$i]["order_date"]))?>" id="delay<?php echo $i;?>">
                        <div class="order_date"><?php echo $date[0];?></div>
                    </td>
                </tr>
                <tr>
                    <th>주문시간</th>
                    <td>
                        <div class="order_time"><?php echo $date[1];?></div>
                    </td>
                </tr>
                <tr>
                    <th>주문번호</th>
                    <td>
                        <div class="order_number"><?php echo $list[$i]["order_number"];?></div>
                    </td>
                </tr>

                <?php for($j=0;$j<count($menu);$j++){?>
                    <tr>
                        <th>옵션정보</th>
                        <td>
                            <div class="order_menu <?php if($j==0){?>first<?php }?>" >
                                <div class="menu_title"><?php echo $menu[$j];?><?php if($option[$j]!=""){ echo "(".$option[$j].")"; }?></div>
                                <div class="menu_count"><?php echo $menu_count[$j];?> 개</div>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                <tr>
                    <th>총금액</th>
                    <td>
                        <div class="order_total"><?php echo number_format($total);?> 원</div>
                    </td>
                </tr>
            </form>
        </table>
    <?php
    }
    if(count($list)==0){?>
        <p>주문정보가 없네요!</p>
    <?php }?>
</div>
<div class="total">
    총 주 문 : <span><?php echo count($list)?> 건</span>
    <input type="button" value="이메일전송">
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/datepicker-ko.js"></script>
<script>
    $(document).ready(function(){

        $.datepicker.setDefaults($.datepicker.regional['ko']);

        $("#datepicker").datepicker({
            defaultDate:"<?php echo $day?>",
            dateFormat:"yy-mm-dd",
            prevText: '이전 달',
            nextText: '다음 달',
            monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
            dayNames: ['일','월','화','수','목','금','토'],
            dayNamesShort: ['일','월','화','수','목','금','토'],
            dayNamesMin: ['일','월','화','수','목','금','토'],
            onSelect:function(){
                var date = $(this).val();
                location.href=g5_url+'/page/shop/store_order_stats.php?day='+date+"&wr_id="+<?php echo $wr_id?>;
            }
        });
    })
</script>
