<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1><?= $this->config['site_name'] ?></h1>
        <h2>删除分类</h2>
        <form action="<?= $this->e($this->sitePrefix . 'category/remove')?>" method="post">
            <input type="hidden" name="id" value="<?= $this->e($data['category']['id'])?>">
            
            <p>分类名：<?= $this->e($data['category']['name']) ?></p>   
            
            <p><input type="submit" value="确认删除"></p>
        </form>
    </body>
</html>