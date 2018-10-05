<?php
include_once('../common.php');
$id = $_REQUEST["id"];
$num = $_REQUEST["num"];
$ca_name = $_REQUEST["ca_name"];

$mainsql = sql_fetch("select * from `g5_write_main` where wr_id = '{$id}'");
include_once (G5_PATH."/admin/head.php");
?>
    <style>
        .store_menu{position:relative}
        .store_menu_title{padding:10px;background:#fff;border-bottom:1px solid #ddd;border-top:1px solid #ddd;}
        .store_menu_title h2{font-size:18px;}
        .store_menu_title a{height: auto;position: absolute;right:0;top:5px;height:35px;display: block}
        .store_menu_title a img{height:35px;}
        .store_menu_list{padding:10px 10px 20px 10px;height:100%;}
        .store_menu_list dd{padding:3%;font-size:16px;background:#fff;margin-top:10px;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;position:relative;display:inline-block;width:94%;}
        .store_menu_list dd.first{margin-top:15px;}
        .store_menu_list dd img{height: auto;position: absolute;right:0;top:0;height:42px;}
        .menu_area .menu_edit_title{font-weight: bold;font-size:16px;padding:5px 0;}
        .menu_area .option{padding:10px 0;position:relative;display: inline;}
        .menu_area .option div{width:42%;float:left;}
        .menu_area .option div.edit {width:12%;}
        .menu_area .option div.harf{margin-left:2%;}
        .menu_area .option div .option_del_btn{line-height:initial !important;min-width:30px;max-width: 80px;background:#cf1616;color:#fff;font-size:15px;border:none;}
        .menu_option_add_btn{padding:10px;background:#ffce31;color:#000;margin-top:15px;}
        .btn_group .add_menu_btn{width:100%;margin-top:20px; padding:10px 0 ; font-size:17px;color:#fff;background-color:#cf1616;border-radius: 8px;}
    </style>
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>메뉴추가 [<?php echo $ca_name;?>]</h1>
            <hr />
        </header>
    <form action="<?php echo G5_URL."/admin/store_menu_update.php";?>" method="post" name="store_cate_from" enctype="multipart/form-data">
        <input type="hidden" name="wr_id" value="<?php echo $id?>">
        <input type="hidden" name="type" value="menuadd">
        <input type="hidden" name="cate_name" value="<?php echo $ca_name?>">
        <div class="store_menu_list" >
            <dl>
                <dd class="store_menu">
                    <div class="menu_area">
                        <?php if ($mainsql["wr_7"] == 1) { ?>
                            <div class="menu_edit_title">사진</div>
                            <div><input type="file" name="menu_image" value="" class="input01 grid_100"></div>
                        <?php } ?>
                        <div class="menu_edit_title">상품명 <span>*</span></div>
                        <div><input type="text" name="menu_name" value="<?php echo $view[$i]["menu_name"]; ?>" class="input01 grid_100"></div>
                        <div class="menu_edit_title">상품설명</div>
                        <div><input type="text" name="menu_detail" value="<?php echo $view[$i]["menu_detail"]; ?>" class="input01 grid_100"></div>
                        <div class="menu_edit_title">가격 <span>*</span></div>
                        <div><input type="text" name="menu_price" value="<?php echo $view[$i]["menu_price"]; ?>" class="input01 grid_100" onkeyup="number_only(this);"></div>
                        <input type="button" value="옵션추가" class="btn grid_100 menu_option_add_btn">
                        <!--<input type="submit" value="V" class="btn menu_edit_btn">-->
                        <div class="option">
                        </div>
                    </div>

                </dd>
            </dl>

            <div class="clear"></div>
            <div class="btn_group">
                <a href="#" onclick="return fnmenu();" class="add_menu_btn grid_100 btn">추가</a>
            </div>
        </div>

    </form>
    </section>
</div>
    <div style="display:none" class="option_item">
        <div class="menu_edit_title">옵션</div>
        <div class="menu_edit_title harf">옵션가격</div>
        <div class="menu_edit_title harf edit">삭제</div>
        <div><input type="text" name="menu_option[]" value="" class="input01 grid_100"></div>
        <div class="harf"><input type="text" name="option_price[]" value="" class="input01 grid_100" onkeyup="number_only(this);"></div>
        <div class="harf edit"><input type="button" value="X" class="btn grid_100 option_del_btn input01"></div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var option_item = $(".option_item").clone();

            $(".menu_option_add_btn").click(function () {
                $(".option").append(option_item.html());
            })
        })
        function fnmenu(){
            if($("#menu_name").val() == ""){
                alert("메뉴명을 입력해야합니다.");
                $("#cate_name").focus();
                return false;
            }else if($("#menu_price").val() == ""){
                alert("메뉴 가격을 입력해야합니다.");
                $("#cate_name").focus();
                return false;
            }else{
                document.store_cate_from.submit();
                return true;
            }
        }
    </script>
<?php
include_once (G5_PATH."/admin/tail.php");