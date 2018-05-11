<?php include('inc_header.php') ?>

<?php
// 打印某一行
function renderRow($current_pid, $w, $row, $level) {
    
?>
    <!-- 自动选中当前的父类 -->
    <option 
        
        <?= intval($row['id']) == intval($current_pid) ? 'selected' : '' ?>  
        value="<?= $w->e($row['id']) ?>"
    >
        <?= indent($level) ?> <?= $w->e($row['name']) ?>
    </option>   
<?php
}
?>

<?php
// 打印所有行
function renderRows($current_id, $current_pid, $w, $rows, $pid=0, $level=0) {
    $founds = array_filter($rows, function($row) use ($pid){
        return intval($row['pid']) == intval($pid);
    });
    
    foreach ($founds as $row) {
        // 父类里不能显示自己，自己不能是自己的父类
        if (intval($current_id) === intval($row['id'])) continue;
        
        renderRow($current_pid, $w, $row, $level);
        renderRows($current_id, $current_pid, $w, $rows, $row['id'], $level + 1);
    }
}
?>


<p>
    <a href="<?= $this->sitePrefix?>category">返回列表</a>
</p>

<h2>修改分类</h2>

<form method="post" action="<?= $this->e($this->sitePrefix) ?>category/update" >  
    <input type="hidden" name="id" value="<?= $data['category']['id']?>">    
    
    <p>父类别：
        <select name="pid">
        <option value="0">顶级分类</option>
        <?php renderRows($data['category']['id'], $data['category']['pid'], $this, $data['rows'])?>
        </select>
    </p>
    
    <p>名称：<input type="text" name="name" value="<?= $data['category']['name'] ?>"></p>
    
    <p><input class="btn btn-primary" type="submit" value="提交"> 
    <input class="btn btn-default" type="reset" value="重新填写"></p>
</form>        

<?php include('inc_footer.php') ?>