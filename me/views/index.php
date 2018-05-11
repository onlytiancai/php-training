<?php include('inc_header.php') ?>
        
<p>
    <a class="btn btn-primary" href="<?= $this->e($this->sitePrefix . 'index/new' ) ?>" role="button">新增用户</a>            
</p>

<table class="table">
    <tr>
        <th>用户 ID</th>
        <th>用户名</th>
        <th>用户昵称</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($data['rows'] as $row): ?>
    <tr>
        <td><?= $this->e($row['id']) ?></td>
        <td><?= $this->e($row['username']) ?></td>
        <td><?= $this->e($row['nickname']) ?></td>
        <td><?= $this->e($row['created_at']) ?></td>
        <td>
            <a href="<?= $this->e($this->sitePrefix . 
                'index/modify?id=' . $row['id']) ?>">修改</a>
            <a href="<?= $this->e($this->sitePrefix . 
                'index/remove?id=' . $row['id']) ?>">删除</a>
        </td>
    </tr>
    <?php endforeach;?>
</table>

<?php include('inc_footer.php') ?>