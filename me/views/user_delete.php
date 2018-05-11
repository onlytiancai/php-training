<?php include('inc_header.php') ?>

<p><a href="<?= $this->sitePrefix?>index">返回列表</a></p>

<h2>删除用户</h2>

<form action="<?= $this->e($this->sitePrefix . 'index/remove')?>" method="post">
    <input type="hidden" name="id" value="<?= $this->e($data['user']['id'])?>">
    
    <p>用户名：<?= $this->e($data['user']['username']) ?></p>
    
    <p>昵称：<?= $this->e($data['user']['nickname']) ?> </p>     
    
    <p><input type="submit" value="确认删除"></p>
</form>

<?php include('inc_footer.php') ?>