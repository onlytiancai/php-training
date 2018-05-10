<?php
// 初始化：加载 model 层和框架核心类
require_once(APP_ROOT . '/models/UserModel.php');

$user = new UserModel();
$w = new Wawa();

$w->get('index', function($w) use($user) {
    $w->render(
        'views/index.php', 
        ['rows' => $user->getAll()]
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