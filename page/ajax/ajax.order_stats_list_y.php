<?php
include_once ("../../common.php");
$align_type = $_REQUEST["align_type"];
$wr_id = $_REQUEST["wr_id"];

$order = sql_query("select *,COUNT(order_year)as cnt from `order_form` where wr_id = '{$wr_id}' GROUP by order_year order by order_date desc ");
$total = 0;
while($row = sql_fetch_array($order)){
    $list[] = $row;
    $total += $row["cnt"];
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
    #monthbar{width:0%;background:red; position: absolute;top:0;left:0;z-index:9;padding:5px 0;transition: all .8s cubic-bezier(0, 0, 0.13, 1.03);text-align: center;color:#fff;cursor: pointer;}
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

<div class="order_list">
    <table>
        <?php
        for($i=0;$i<count($list);$i++){
            ?>
            <tr>
                <th><?php echo $list[$i]["order_year"]?> 년</th>
                <td>
                    <div style="position: relative;">
                        <div id="monthbar" class="month<?php echo $i ?>" >&nbsp;</div>
                        <div style="width:100%;background:#ddd; transition: all .2s ease-in-out;text-align: center;padding:5px 0;"><?php echo $list[$i]["cnt"]?> 건</div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<div class="total">
    총 주 문 : <span><?php echo count($list)?> 건</span>
    <input type="button" value="이메일전송">
</div>
<script>
    $(document).ready(function(){

        })

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
    setTimeout(fnMonthStats(),9000);

    function fnMonthStats(cnt, i){
        <?php for($i=0;$i<count($list);$i++){?>
        var cnt = '<?php echo $list[$i]["cnt"]?>';
        var i = '<?php echo $i?>'
        var total = '<?php echo $total?>';
        if(cnt == 0)
            cnt == 1;
        var width = cnt / total * 100;
        if(width>60){
            $(".month" + i).css("width", width + "%");
            $(".month" + i).html(cnt+ " 건");
        }else {
            $(".month" + i).css("width", width + "%");
        }
        <?php }?>
    }
</script>
