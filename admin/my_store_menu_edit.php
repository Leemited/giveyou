<?php
include_once("../common.php");
$wr_id = $_REQUEST["wr_id"];
$catemenu=sql_query("select * from `store_category` where wr_id='{$wr_id}'");
while($row = sql_fetch_array($catemenu)){
    $view[] = $row;
}
$mainsql = sql_fetch("select * from `g5_write_main` where wr_id = '{$wr_id}'");
include_once(G5_PATH."/admin/head.php");
?>
<style>
    .store_menu_title{padding:10px;background:#fff;border-bottom:1px solid #ddd;border-top:1px solid #ddd;}
    .store_menu_title h2{font-size:18px;}
    .store_menu_list{padding:10px;}
    .store_menu_list dd{padding:12px;font-size:16px;background:#fff;margin-top:10px;-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;position:relative}
    .store_menu_list dd.first{margin-top:0;}
    .store_menu_list dd img{height: auto;position: absolute;right:0;top:0;height:42px;}
</style>
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>메뉴분류</h1>
            <hr />
        </header>
        <form id="fregisterform" name="fregisterform" action="<?php echo G5_URL."/admin/my_store_add_update.php";?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <div class="store_menu_list">
                <dl>
                    <?php
                    if(count($view) != 0) {
                        for ($i = 0; $i < count($view); $i++) {
                            $count = sql_fetch("select COUNT(*) as cnt from `store_menu` where wr_id = '{$view[$i]["wr_id"]}' and ca_name = '{$view[$i]["ca_name"]}'")
                            ?>
                            <dd class="store_menu <?php if($i==0){?>first<?php }?>" ><?php echo $view[$i]["ca_name"]; ?> - <?php echo $count["cnt"]?> 개 <a href="<?php echo G5_URL?>/admin/my_store_menu_2depth_edit.php?ca_name=<?php echo $view[$i]["ca_name"];?>&wr_id=<?php echo $wr_id?>&ca_id=<?php echo $view[$i]["id"]?>"><img src="<?php echo G5_IMG_URL?>/mypage_edit.png" class="menu_list_edit"></a></dd>
                        <?php }
                    }else{ ?>
                        <dd class="store_menu first">등록된 분류가 없습니다.</dd>
                        <dd class="store_menu ">하단 추가 버튼을 통해 등록바랍니다.</dd>
                    <?php }?>
                </dl>
            </div>
        </form>
        <div class="text-right mt20">
            <a href="#" onclick="add_cate('<?php echo $mainsql["wr_id"]?>');" class="adm-btn01">추가하기</a>
        </div>
    </section>
</div>
<script>
    function add_cate(id){
        $.post(g5_url+"/page/modal/store_cate_add_admin.php",{id:id},function(data){
            $(".modal").html(data);
            modal_active();
        });
    }
</script>
<?php
include_once(G5_PATH."/admin/tail.php");
?>
