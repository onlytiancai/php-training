<?php
// 初始化：加载 model 层和框架核心类
require_once(APP_ROOT . '/models/UserModel.php');

$user = new UserModel();
$w = new Wawa();

$w->get('index', function($w) use($user) {
    // 1、初始化默认页大小和页码
    $pageSize = 10;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 0;
    
    // 2、获取数据记录数，计算最大页码数
    $total = $user->getCount();
    $maxPage = ceil($total / $pageSize);
    
    // 3、校验输入，修正页码数，
    if ($page < 1) $page = 1;
    if ($page > $maxPage) $page = $maxPage;
    
    // 4、计算数据偏移量
    $offset = ($page - 1) * $pageSize; 
    
    $w->render(
        'views/index.php', 
        ['rows' => $user->getAll($pageSize, $offset), 'page' => $page, 'maxPage' => $maxPage]
    );   
});

$w->get('new', function($w) {
    $w->render(
        'views/user_form.php',
        ['action' => 'new']
    );
});

$w->get('modify', function($w) use($user) {
    $id = $_GET['id'];
    
    $w->render(
        'views/user_form.php',
        ['action' => 'modify', 'user' => $user->get($id)]
    );
});

$w->post('add', function($w) use($user) {   
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    
    $user->insert($username, $nickname, $password);
    $w->redirect('index');
});

$w->post('update', function($w) use($user){
    $id = $_POST['id'];
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    
    $user->update($id, $nickname, $password);
    
    $w->redirect('index');
});

$w->get('remove', function($w) use($user) {
    $id = $_GET['id'];
    
    $w->render(
        'views/user_delete.php', 
        ['user' => $user->get($id)]
    );
});

$w->post('remove', function($w) use($user){ 
    $id = $_POST['id'];
    $user->remove($id);
    $w->redirect('index');
});

$w->run();