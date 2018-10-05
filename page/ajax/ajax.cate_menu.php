<?php
include_once ("../../common.php");
$cate = $_REQUEST["cate"];
$wr_id = $_REQUEST["wr_id"];
$menu_name = $_REQUEST["menu"];
$menu = sql_query("select * from `store_menu` where wr_id = '{$wr_id}' and ca_name = '{$cate}'");
while ($row = sql_fetch_array($menu)){
    $m[] = $row;
}
?>
<option value="">메뉴명</option>
<?php 
for($i = 0; $i < count($m);$i++){
?>
    <option value="<?php echo $m[$i]["menu_name"]?>" <?php if($menu_name==$m[$i]["menu_name"]){?>selected<?php }?>><?php echo $m[$i]["menu_name"]?></option>
<?php }?>

