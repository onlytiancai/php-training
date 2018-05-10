<!DOCTYPE html>
<?php
// 打印某一行
function renderRow($w, $row, $level) {
?>
    <option value="<?= $w->e($row['id']) ?>"><?= indent($level) ?> <?= $w->e($row['name']) ?></option>   
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
        <a href="<?= $this->sitePrefix?>category">返回列表</a>
        </p>
        
        <h2>新增分类</h2>
        
        <form method="post" action="<?= $this->e($this->sitePrefix) ?>category/add" >            
            <p>父类别：
                <select name="pid">
                <option value="0">顶级分类</option>
                <?php renderRows($this, $data['rows'])?>
                </select>
            </p>
            
            <p>名称：<input type="text" name="name" value=""></p>
            
            <p><input type="submit" value="提交"> 
            <input type="reset" value="重新填写"></p>
        </form>        
    </body>
</html>