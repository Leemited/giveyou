<?php
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];
$year = $_REQUEST["year"];
if(!$year){
    $year = date("Y");
}
$month = array(0,0,0,0,0,0,0,0,0,0,0,0);
$order = sql_query("select o.*, m.* from `order_form` as o left join `g5_write_main` as m on o.wr_id = m.wr_id where o.wr_id = '{$wr_id}' and o.order_year = '{$year}' order by o.order_date desc ");
while($row = sql_fetch_array($order)){
    $list[] = $row;
    $total += $row["order_total_price"];
    switch ($row["order_month"]){
        case "1":
            $month[0]+=$row["order_total_price"];
            break;
        case "2":
            $month[1]+=$row["order_total_price"];
            break;
        case "3":
            $month[2]+=$row["order_total_price"];
            break;
        case "4":
            $month[3]+=$row["order_total_price"];
            break;
        case "5":
            $month[4]+=$row["order_total_price"];
            break;
        case "6":
            $month[5]+=$row["order_total_price"];
            break;
        case "7":
            $month[6]+=$row["order_total_price"];
            break;
        case "8":
            $month[7]+=$row["order_total_price"];
            break;
        case "9":
            $month[8]+=$row["order_total_price"];
            break;
        case "10":
            $month[9]+=$row["order_total_price"];
            break;
        case "11":
            $month[10]+=$row["order_total_price"];
            break;
        case "12":
            $month[11]+=$row["order_total_price"];
            break;
    }
}
$years = date("Y-m-d", strtotime($year."-01-01"));
$preYear = date("Y", strtotime($years." -1 years"));
$nextYear = date("Y", strtotime($years." +1 years"));

$wr_subject = "정산현황";
$back_url=G5_URL."/page/shop/";
include_once ("../../head.php");
?>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
    .mt_b_30{margin-bottom:63px;}
    .ui-datepicker{width:98%;font-size:18px;padding:0 !important}
    .ui-state-highlight{border:none !important;background: #8fa4ff;font-weight: bold ;color: #fff }
    .ui-state-default{text-align: center !important;padding:5px !important;font-size:16px;}
    .ui-state-default:hover, .ui-state-active{background:#ff2959 !important;font-weight: bold !important;color: #fff !important}
    .order_list{background: #eee;padding:10px;}
    .order_list table{width:100%;margin-bottom:10px;}
    .order_list table tr{background: #fff;}
    .order_list table th{text-align: center;padding:5px;width:20%;border-right:1px solid #ddd;}
    .order_list table td{text-align: left;padding:5px;}
    .order_list p{text-align: center;padding:50% 0;}
    .search, .select_date{border-top:1px solid #ddd;padding:10px 0;}
    .search .search_input{text-align:center;display: list-item;}
    .search select{width:28%; margin-right: 4%;}
    .search select.last{margin-right: 0;}
    .select_date .date_search{text-align: center;padding:0 10px;position: relative;}
    .select_date .date_search input[type=button]{width:40px;}
    .select_date .date_search input[type=text]{width:60%;font-size:26px; font-weight: bold;text-align: center}
    .date_btn_group{padding:10px;text-align: center}
    .date_btn_group input[type=button]{color:#fff;font-size:15px;width:96%;padding:2% 0;}
    .bg_white{background: #fff !important;}
    .year_left{position:absolute;top:0;left:10px}
    .year_right{position:absolute;top:0;right:10px}
    .total{position:absolute;width:90%;padding:20px 5%;font-size:20px;color:#fff;background:#cf1616;z-index:90;}
    .total span{text-align:center}
    .total input{position: absolute;right: 5%;padding: 10px;top: 14px;border: none;background: #fff;}
    #datepickers{width:100%}
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
<div class="width-fixed mt_b_30">
    <div class="sel-align">
        <div class="select-align">
            <input type="radio" name="align" id="loc" value="2">
            <label for="loc"><span class="radio">총 주문현황</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="hit" value="1" checked>
            <label for="hit"><span class="radio">월별</span></label>
        </div>
        <div class="select-align">
            <input type="radio" name="align" id="new" value="0" >
            <label for="new" ><span class="radio">일별</span></label>
        </div>
    </div>
    <section class="section01">
        <!--<div class="search">
            <div class="search_input">
                <select type="text" class="input01" name="category" id="category" >
                    <option value="">대분류</option>
                    <?php /*for($i=0;$i<count($cates);$i++){*/?>
                        <option value="<?php /*echo $cates[$i]["ca_name"]*/?>"><?php /*echo $cates[$i]["ca_name"]*/?></option>
                    <?php /*}*/?>
                </select>
                <select type="text" class="input01" name="menu" id="menu">
                    <option value="">메뉴명</option>
                </select>
                <select type="text" class="input01 last" id="state">
                    <option value="">상태</option>
                    <option value="">취소</option>
                    <option value="">완료</option>
                </select>
            </div>
        </div>-->
        <div class="stats_con">
            <div class="select_date">
                <div class="date_search">
                    <input type="button" class="btn input01 bg_white year_left"  value=" < " onclick="fnYear('<?php echo $wr_id?>','<?php echo $preYear;?>')" >
                    <input type="text"  class="input01" value="<?php echo $year?>" id="datepickers" >
                    <input type="button" class="btn input01 bg_white year_right" value=" > " onclick="fnYear('<?php echo $wr_id?>','<?php echo $nextYear;?>' )">
                </div>
            </div>
            <div class="order_list">
                <table>
                    <?php
                    for ($i = 0; $i < count($month); $i++) {
                        $m = $i + 1;
                        $width = 1;
                        ?>
                        <tr>
                            <th><?php if ($m < 10) {
                                    echo "0" . $m;
                                } else {
                                    echo $m;
                                } ?> 월
                            </th>
                            <td>
                                <div style="position: relative;">
                                    <div id="monthbar" class="month<?php echo $i ?>" onclick="fnDay('<?php echo $wr_id?>','<?php echo ($i+1)?>','<?php echo $year?>')">&nbsp;</div>
                                    <div style="width:100%;background:#ddd; transition: all .2s ease-in-out;text-align: center;padding:5px 0;cursor: pointer;" onclick="fnDay('<?php echo $wr_id?>','<?php echo ($i+1)?>','<?php echo $year?>')"><?php echo $month[$i] ?> 원</div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="total">
                총 주 문 : <span><?php echo number_format($total)?> 원</span>
                <input type="button" value="이메일전송" onclick="fnEmail()">
            </div>
        </div>
    </section>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/i18n/datepicker-ko.js"></script>
<script>
    $(document).ready(function(){
        var align_type = "";
        var year = "<?php echo $year?>";
        var menu = "<?php echo $menu?>";
        //정렬
        $("input[type=radio]").change(function(){
            align_type = $(this).val();
            if(align_type==0) {
                location.href=g5_url + "/page/shop/store_account_stats.php?wr_id="+<?php echo $wr_id?>;
            }else if(align_type==1){
                location.href=g5_url + "/page/shop/store_account_stats_m.php?wr_id="+<?php echo $wr_id?>;
            }else if(align_type==2){
                location.href=g5_url + "/page/shop/store_account_stats_y.php?wr_id="+<?php echo $wr_id?>;
            }
        })

        $("#category").change(function(){
            var cate = $(this).val();
            $.ajax({
                url: g5_url+"/page/ajax/ajax.cate_menu.php",
                method:"POST",
                data:{cate:cate,wr_id:'<?php echo $wr_id;?>'}
            }).done(function(data){
                $("#menu").html(data);
            })
        })

        $("#state").change(function(){

        })

        setTimeout(fnMonthStats(),8000);

        function fnMonthStats(){
            <?php for($i=0;$i<count($month);$i++){?>
            var cnt = '<?php echo $month[$i]?>';
            var i = '<?php echo $i?>';
            var total = '<?php echo $total?>';
            if(cnt == 0)
                cnt == 1;
            var width = cnt / total * 100;
            if(width>60){
                $(".month" + i).css("width", width + "%");
                $(".month" + i).html(cnt.format()+ " 원");
            }else {
                $(".month" + i).css("width", width + "%");
            }
            <?php }?>
        }
    })
    function fnYear(wr_id,year){
        location.href=g5_url + "/page/shop/store_account_stats_m.php?wr_id="+wr_id+"&year="+year;
    }

    function fnDay(wr_id,month,year){
        location.href=g5_url + "/page/shop/store_account_stats_m_detail.php?wr_id="+wr_id+"&month="+month+"&year="+year;
    }

    function fnEmail(){
        location.href=g5_url+'/page/shop/email.php?type=month&year=<?php echo $year;?>&wr_id=<?php echo $wr_id;?>';
    }
</script>
<?php
include_once ("../../tail.php");
?>
