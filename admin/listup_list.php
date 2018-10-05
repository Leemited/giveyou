<?php
include_once("../common.php");
include_once(G5_PATH."/admin/head.php");
$total=sql_fetch("select count(*) as cnt from `g5_write_main`");
if(!$page)
    $page=1;
$total=$total['cnt'];
$rows=10;
$start=($page-1)*$rows;
$total_page=ceil($total/$rows);
$sql="select * from `g5_write_main` where wr_3= 'Y' and wr_is_comment = 0 and wr_file != 0 order by `wr_1` asc limit {$start},{$rows}";

$query=sql_query($sql);
$j=0;
while($data=sql_fetch_array($query)){
    $list[$j]=$data;
    $list[$j]['num']=$total-($start)-$j;
    $j++;
}

$sqlY="select * from `g5_write_main` where wr_3= 'W' and wr_is_comment = 0 and wr_file != 0 order by `wr_1` asc  limit {$start},{$rows}";

$queryy=sql_query($sqlY);
$j=0;
while($data=sql_fetch_array($queryy)){
    $listY[$j]=$data;    
    $j++;
}

?>
<!-- 본문 start -->
<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>리스트노출 요청완료</h1>
            <hr />
        </header>
        <article>
            <div class="adm-table01">
                <table>
                    <thead>
                    <tr>
                        <th class="md_none">번호</th>
                        <th>상점이름</th>
                        <th>상점내용</th>
                        <th>시작날짜</th>
                        <th>종료날짜</th>
                        <!--<th>관리 id</th>-->
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i=0;$i<count($list);$i++){
                        ?>
                        <tr>
                            <td class="md_none"><?php echo $list[$i]['wr_id']; ?></td>
                            <td><?php echo $list[$i]['wr_subject']; ?></td>
                            <td><?php echo $list[$i]['wr_content']; ?></td>
                            <td><?php echo $list[$i]['wr_1']; ?></td>
                            <td><?php echo $list[$i]['wr_2']; ?></td>
                            <!--<td onclick="location.href='<?php /*echo G5_URL."/admin/partner_view.php?id=".$list[$i]['id']."&page=".$page; */?>'"><?php /*echo $list[$i]['mb_id']; */?></td>-->
                            <td><a href="" style="width:100px;font-size:14px;background:#333;color:#fff;padding:10px 12px">승인완료</a></td>
                        </tr>
                        <?php
                    }
                    if(count($list)==0){
                        ?>
                        <tr>
                            <td colspan="6" class="text-center" style="padding:50px 0;">완료 된 요청이 없습니다.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if($total_page>1){
                $start_page=1;
                $end_page=$total_page;
                if($total_page>5){
                    if($total_page<($page+2)){
                        $start_page=$total_page-4;
                        $end_page=$total_page;
                    }else if($page>3){
                        $start_page=$page-2;
                        $end_page=$page+2;
                    }else{
                        $start_page=1;
                        $end_page=5;
                    }
                }
                ?>
                <div class="num_list01">
                    <ul>
                        <?php if($page!=1){?>
                            <li class="prev"><a href="<?php echo G5_URL."/admin/listup_list.php?page=".($page-1); ?>">&lt;</a></li>
                        <?php } ?>
                        <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                            <li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/listup_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php if($page<$total_page){?>
                            <li class="next"><a href="<?php echo G5_URL."/admin/listup_list.php?page=".($page+1); ?>">&gt;</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
            }
            ?>
         
        </article>
    </section>
</div>

<div id="wrap">
    <section>
        <header id="admin-title">
            <h1>리스트노출 승인대기</h1>
            <hr />
        </header>
        <article>
            <div class="adm-table01">
                <table>
                    <thead>
                    <tr>
                        <th class="md_none">번호</th>
                        <th>상점이름</th>
                        <th>상점내용</th>
                        <th>시작날짜</th>
                        <th>종료날짜</th>
                        <!--<th>관리 id</th>-->
                        <th>관리</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for($i=0;$i<count($listY);$i++){
                        ?>
                        <tr>
                            <td class="md_none"><?php echo $listY[$i]['wr_id']; ?></td>
                            <td><?php echo $listY[$i]['wr_subject']; ?></td>
                            <td><?php echo $listY[$i]['wr_content']; ?></td>
                            <td><?php echo $listY[$i]['wr_1']; ?></td>
                            <td><?php echo $listY[$i]['wr_2']; ?></td>
                            <!--<td onclick="location.href='<?php /*echo G5_URL."/admin/partner_view.php?id=".$list[$i]['id']."&page=".$page; */?>'"><?php /*echo $list[$i]['mb_id']; */?></td>-->
                            
                             <td><a href="<?php echo G5_URL."/admin/listup_update.php?wr_id=".$listY[$i]['wr_id']."&page=".$page; ?>" style="width:100px;font-size:14px;background:#333;color:#fff;padding:10px 12px">승인</a></td>
                        </tr>
                        <?php
                    }
                    if(count($listY)==0){
                        ?>
                        <tr>
                            <td colspan="6" class="text-center" style="padding:50px 0;"> 승인 대기중인 요청이 없습니다.</td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if($total_page>1){
                $start_page=1;
                $end_page=$total_page;
                if($total_page>5){
                    if($total_page<($page+2)){
                        $start_page=$total_page-4;
                        $end_page=$total_page;
                    }else if($page>3){
                        $start_page=$page-2;
                        $end_page=$page+2;
                    }else{
                        $start_page=1;
                        $end_page=5;
                    }
                }
                ?>
                <div class="num_list01">
                    <ul>
                        <?php if($page!=1){?>
                            <li class="prev"><a href="<?php echo G5_URL."/admin/list_list.php?page=".($page-1); ?>">&lt;</a></li>
                        <?php } ?>
                        <?php for($i=$start_page;$i<=$end_page;$i++){ ?>
                            <li class="<?php echo $page==$i?"active":""; ?>"><a href="<?php echo G5_URL."/admin/member_list.php?page=".$i; ?>"><?php echo $i; ?></a></li>
                        <?php } ?>
                        <?php if($page<$total_page){?>
                            <li class="next"><a href="<?php echo G5_URL."/admin/list_list.php?page=".($page+1); ?>">&gt;</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php
            }
            ?>
<!--
            <div class="text-right mt20">
                <a href="<?php echo G5_URL."/admin/slide_update.php"; ?>" class="adm-btn01">리스트추가</a>
            </div>
-->
        </article>
    </section>
</div>
<?php
include_once(G5_PATH."/admin/tail.php");
?>
