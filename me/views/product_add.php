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
    <script src="https://cdn.bootcss.com/tinymce/4.7.12/tinymce.min.js"></script>
   
    <script language="javascript" type="text/javascript">
      tinyMCE.init({
        mode: "exact",
        elements : "description",
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
        + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
        + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
        +"undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3 : "",
        height:"350px",
        width:"600px"
    });

    </script>
    </head>
    <body>
        <h1><?= $this->config['site_name'] ?></h1>
        <p>
        <a href="<?= $this->sitePrefix?>product">返回列表</a>
        </p>
        
        <h2>新增产品</h2>
        
        <form method="post" action="<?= $this->e($this->sitePrefix) ?>product/add" >            
            <p>产品分类：
                <select name="category_id">                
                <?php renderRows($this, $data['categories'])?>
                </select>
            </p>
            
            <p>名称：<input type="text" name="name" value=""></p>
            
            <p>产品描述</p>
            <textarea id="description"  name="description" cols="100" rows="20"></textarea>
            
            <p><input type="submit" value="提交"> 
            <input type="reset" value="重新填写"></p>
        </form>        
    </body>
</html>