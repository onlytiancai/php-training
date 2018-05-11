<?php include('inc_header.php') ?>

<p>
    <a href="<?= $this->sitePrefix?>category">返回列表</a>
</p>

<h2>删除分类</h2>

<form action="<?= $this->e($this->sitePrefix . 'category/remove')?>" method="post">
    <input type="hidden" name="id" value="<?= $this->e($data['category']['id'])?>">
    
    <p>分类名：<?= $this->e($data['category']['name']) ?></p>   
    
    <p><input class="btn btn-primary" type="submit" value="确认删除"></p>
</form>
<?php include('inc_footer.php') ?>