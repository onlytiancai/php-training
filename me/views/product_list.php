<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1><?= $this->config['site_name'] ?></h1>
        <p>
        <a href="<?= $this->sitePrefix?>product/new">新增产品</a>
        </p>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>分类</th>
                <th>名称</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            <?php foreach ($data['rows'] as $row): ?>
            <tr>
                <td><?= $this->e($row['id']) ?></td>
                <td><?= $this->e($row['category_id']) ?></td>
                <td><?= $this->e($row['name']) ?></td>
                <td><?= $this->e($row['created_at']) ?></td>
                <td>
                <a href="<?= $this->sitePrefix?>product/add_cart?id=<?= $this->e($row['id']) ?>">购买</a>
                <a href="<?= $this->sitePrefix?>product/view?id=<?= $this->e($row['id']) ?>">查看详情</a>
                </td>
            </tr>
            <?php endforeach?>
        </table>
        <p>
            <?php for ($i = 1; $i <= $data['maxPage']; $i++) :?>
                <a href="<?= $this->sitePrefix?>product?page=<?= $i ?>">第 <?= $i ?> 页</a>
            <?php endfor?>            
        </p>
        
        <h2>购物车</h2>
        <table border="1">
            <tr>
                <th>名称</th>
                <th>数量</th>
            </tr>            
            <?php if (isset($_SESSION['carts']) && is_array($_SESSION['carts'])):?>
                <?php foreach ($_SESSION['carts'] as $row): ?>
                    <tr>
                        <td><?= $this->e($row['name']) ?></td>
                        <td><?= $this->e($row['count']) ?></td>
                    </tr>
                <?php endforeach?>
            <?php endif ?>
        </table>
    </body>
</html>