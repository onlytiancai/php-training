<!DOCTYPE html>
<?php
// 打印某一行
function renderRow($w, $row, $level) {
?>
    <tr>
        <td><?= $w->e($row['id']) ?></td>
        <td><?= indent($level) ?> <?= $w->e($row['name']) ?>
        </td>
        <td><?= $w->e($row['parent_name']) ?></td>                
        <td>
            <a href="<?= $w->e($w->sitePrefix . 
                'category/modify?id=' . $row['id']) ?>">修改</a>
            <a href="<?= $w->e($w->sitePrefix . 
                'category/remove?id=' . $row['id']) ?>">删除</a>
        </td>
    </tr>
<?php
}
?>

<?php
// 打印所有行
function renderRows($w, $rows, $pid=0, $level=0) {
    $founds = array_filter($rows, function($row) use ($pid){
        return intval($row['pid']) == intval($pid);
    });
    
    foreach ($founds as $row) {
        renderRow($w, $row, $level);
        renderRows($w, $rows, $row['id'], $level + 1);
    }
}
?>
<html>
    <head>
    </head>
    <body>
        <h1><?= $this->config['site_name'] ?></h1>
        <p>
        <a href="<?= $this->sitePrefix?>category/new">新增分类</a>
        </p>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>类别</th>
                <th>父类别</th>
                <th>操作</th>
            </tr>
            <?php renderRows($this, $data['rows'])?>
        </table>
    </body>
</html>