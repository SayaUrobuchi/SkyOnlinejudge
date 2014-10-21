<?php
if(!defined('IN_TEMPLATE'))
{
  exit('Access denied');
}
?>
<script>
$(document).ready(function()
{
    $('#b_add').tooltip();
})
</script>
<div class="container">
    <div class="row">
        <div class="page-header">
            <h1>解題統計<small>網羅各大OJ資訊</small></h1>
        </div>
    </div>
    <div class="row">
        <table class = "table">
        <thead>
            <tr>
                <th class="col-md-1 text-center">編號</th>
                <th class="col-md-4">名稱</th>
                <th class="col-md-4 text-right">
                <?php if($_G['uid']): ?>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="新增記分板" id="b_add" onclick="location.href='rank.php?mod=cbedit'">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
                <?php endif;?>
                </th>
                <th class="col-md-2">創立者</th>
                <th class="col-md-1">狀態</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($_E['template']['row'] as $row){ ?>
            <tr>
                <td class="text-center"><?=$row['id'];?></td>
                <td><a style="color:white" href="rank.php?mod=commonboard&id=<?=$row['id'];?>"><?=$row['name'];?></a></td>
                <td class="text-right">
                    <?php if($_G['uid']): ?>
                        <span class="glyphicon glyphicon-plus-sign" style="color:green"></span>
                        <span class="glyphicon glyphicon-remove" style="color:red"></span>
                        <?php if($row['owner'] == $_G['uid']): ?>
                        <span class="glyphicon glyphicon-pencil" onclick="location.href='rank.php?mod=cbedit&id=<?=$row['id'];?>'"></span>
                        <span class="glyphicon glyphicon-lock"   style="color:yellow"></span>
                        <span class="glyphicon glyphicon-trash"  style="color:red"></span>
                        <?php endif;?>
                    <?php endif;?>
                </td>
                <td><?=$_E['template']['nickname'][$row['owner']]?></td>
                <td>
                    <span class="glyphicon glyphicon-thumbs-up" style="color:green"></span>
                    Join
                </td>
            </tr>
        <?php }?>
        </tbody>
        </table>
    </div>
    <div class="row text-center">
        <ul class="pagination">
            <?php
                $_L = max($_E['template']['pagerange']['0'],$_E['template']['pagerange']['1']-1);
                $_R = max($_E['template']['pagerange']['2'],$_E['template']['pagerange']['1']+1);
            ?>
            <li><a href="rank.php?mod=list&page=<?=$_L ?>">&laquo;</a></li>
            <?php for($i=$_E['template']['pagerange']['0'];$i<=$_E['template']['pagerange']['2'];$i++){ ?>
                <?php if($i==$_E['template']['pagerange']['1']): ?>
                    <li class="active"><a href="rank.php?mod=list&page=<?=$i?>"><?=$i?></a></li>
                <?php else:?>
                    <li><a href="rank.php?mod=list&page=<?=$i?>"><?=$i?></a></li>
                <?php endif;?>
            <?php }?>
            <li><a href="rank.php?mod=list&page=<?=$_R ?>">&raquo;</a></li>
        </ul>
    </div>
</div>