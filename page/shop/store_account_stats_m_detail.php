<?php
include_once ("../../common.php");

$wr_id = $_REQUEST["wr_id"];
$month = $_REQUEST["month"];
$year = $_REQUEST["year"];
$category = $_REQUEST["category"];
$menu_name = $_REQUEST["menu"];
$state = $_REQUEST["state"];

$where = " o.wr_id = '{$wr_id}' and order_year = '{$year}' and order_month = '{$month}' ";

if($category){
    $where .= " and m.ca_name = '{$category}'";
}
if($menu_name){
    $where .= " and o.order_menu like '%{$menu_name}%'";
}
if($state){
    $where .= " and o.order_state = '{$state}'";
}

$order = sql_query("select o.*, m.* from `order_form` as o left join `store_category` as m on o.wr_id = m.wr_id where {$where} GROUP by order_number order by order_date desc ");
while($row = sql_fetch_array($order)){
    $list[] = $row;
    $total += $row["order_total_price"];
}

$cate = sql_query("select * from `store_category` where wr_id = '{$wr_id}'");
while($row = sql_fetch_array($cate)){
    $cates[] = $row;
}

$months = date("Y-m-d" , strtotime($year."-".$month."-01"));
$preMonth = date("m" , strtotime($months." -1 months"));
$nextMonth = date("m" , strtotime($months." +1 months"));

$wr_subject = "주문통계";
$back_url=G5_URL."/page/shop/";
include_once ("../../head.php");
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
    .order_list table th{text-align: left;padding:10px;width:30%;border-right:1px solid #ddd;}
    .order_list table td{text-align: left;padding:10px;}
    .order_list p{text-align: center;padding:50% 0;}
    .search, .select_date{border-top:1px solid #ddd;padding:10px 0;}
    .search .search_input{text-align:center;display: list-item;}
    .search select{width:28%; margin-right: 4%;}
    .search select.last{margin-right: 0;}
    .select_date .date_search{text-align: center;padding:0 10px;}
    .select_date .date_search input[type=button]{width:40px;}
    .select_date .date_search input[type=text]{width:60%;font-size:26px; font-weight: bold;text-align: center}
    .date_btn_group{padding:10px;text-align: center}
    .date_btn_group input[type=submit]{color:#fff;font-size:15px;width:96%;padding:2% 0;}
    .date_btn_group input[type=button]{color:#fff;font-size:15px;width:96%;padding:2% 0;}
    .bg_white{background: #fff !important;}
    .total{position:absolute;width:90%;padding:20px 5%;font-size:20px;color:#fff;background:#cf1616}
    .total span{text-align:center}
    .total input{position: absolute;right: 5%;padding: 10px;top: 14px;border: none;background: #fff;}
    #datepickers{width:100%}
    #monthbar{width:0%;background:red; position: absolute;top:0;left:0;z-index:9;padding:5px 0;transition: all .8s cubic-bezier(0, 0, 0.13, 1.03);text-align: center;color:#fff;cursor: pointer;}
    .year_left{position:absolute;top:0;left:10px}
    .year_right{position:absolute;top:0;right:10px}
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
        <div class="search">
            <form action="<?php echo G5_URL?>/page/shop/store_order_stats_m_detail.php" method="post" name="search">
                <div class="search_input">
                    <input type="hidden"  class="input01" value="<?php echo $wr_id?>" name="wr_id" >
                    <input type="hidden"  class="input01" value="<?php echo $year?>" name="year" >
                    <input type="hidden"  class="input01" value="<?php echo $month?>" name="month" >
                    <select type="text" class="input01" name="category" id="category" >
                        <option value="">대분류</option>
                        <?php for($i=0;$i<count($cates);$i++){?>
                            <option value="<?php echo $cates[$i]["ca_name"]?>" <?php if($category==$cates[$i]["ca_name"]){?>selected<?php }?>><?php echo $cates[$i]["ca_name"]?></option>
                        <?php }?>
                    </select>
                    <select type="text" class="input01" name="menu" id="menu">
                        <option value="">메뉴명</option>
                    </select>
                    <select type="text" class="input01 last" name="state" id="state">
                        <option value="">상태</option>
                        <option value="2" <?php if($state=="2"){?>selected<?php }?>>취소</option>
                        <option value="1" <?php if($state=="1"){?>selected<?php }?>>완료</option>
                        <option value="0" <?php if($state=="0"){?>selected<?php }?>>입금대기</option>
                    </select>
                </div>
                <div class="date_btn_group">
                    <input type="submit" class="btn bg_darkred grid_100" value="검색">
                </div>
            </form>
        </div>
        <div class="stats_con">
            <div class="select_date">
                <div class="date_search" style="position: relative;">
                    <input type="button" class="btn input01 bg_white year_left"  value=" < " onclick="fnYear('<?php echo $wr_id?>','<?php echo $preMonth;?>','<?php echo $year?>')" >
                    <input type="text"  class="input01" value="<?php echo (strlen($month)==1)?"0"+$month:$month;?> 월" id="datepickers" >
                    <input type="button" class="btn input01 bg_white year_right" value=" > " onclick="fnYear('<?php echo $wr_id?>','<?php echo $nextMonth;?>','<?php echo $year?>')">
                    <!--<div id="datepicker"></div>-->
                </div>
                <!--<div class="date_btn_group">
                    <input type="button" class="btn bg_darkred grid_100" value="검색">
                </div>-->
            </div>
            <div class="order_list">

                <?php for($i=0;$i<count($list);$i++){
                    $date = explode(" ", $list[$i]["order_date"]);
                    $menu = explode(",", $list[$i]["order_menu"]);
                    $menu_count = explode(",", $list[$i]["order_count"]);
                    $option = explode(",", $list[$i]["order_option"]);
                    ?>
                    <table>
                        <tr>
                            <th>주문일자</th>
                            <td>
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
                                <div class="order_total"><?php echo number_format($list[$i]["order_total_price"]);?> 원</div>
                            </td>
                        </tr>
                        </form>
                    </table>
                <?php }
                if(count($list)==0){?>
                    <p>주문정보가 없네요!</p>
                <?php }?>
            </div>
            <div class="date_btn_group" style="padding:10px;">
                <input type="button" class="btn bg_darkred grid_100" value="뒤로 가기" onclick="location.href=g5_url+'/page/shop/store_account_stats_m.php?wr_id=<?php echo $wr_id?>&year=<?php echo $year?>';">
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
        var cates = '<?php echo $category?>';
        $.ajax({
            url: g5_url+"/page/ajax/ajax.cate_menu.php",
            method:"POST",
            data:{cate:cates,wr_id:'<?php echo $wr_id;?>',menu:'<?php echo $menu_name?>'}
        }).done(function(data){
            $("#menu").html(data);
        })

        var align_type = "";
        var day = "<?php echo $day?>";
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

    })

    function fnYear(wr_id,month,year){
        location.href=g5_url + "/page/shop/store_account_stats_m_detail.php?wr_id="+wr_id+"&month="+month+"&year="+year;
    }

    function fnEmail(){
        location.href=g5_url+'/page/shop/email.php?type=month_detail&month=<?php echo $month?>&year=<?php echo $year;?>&wr_id=<?php echo $wr_id;?>&cate=<?php echo $category;?>&menu_name=<?php echo $menu_name;?>&state=<?php echo $state?>';
    }

</script>
<?php
include_once ("../../tail.php");
?>
