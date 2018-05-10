<?php
require_once(APP_ROOT . '/models/CategoryModel.php');

$category = new CategoryModel();
$w = new Wawa();

function indent($level) {
    $ret = '';
    for ($i = 0; $i < $level; $i++) {        
        $ret .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    return $ret;
}


$w->get('index', function($w) use($category) {
    $w->render(
        'views/category_list.php', 
        ['rows' => $category->getAll()]
    );   
});

$w->get('new', function($w) use($category) {
    $w->render(
        'views/category_add.php',
        ['rows' => $category->getAll()]        
    );   
});

$w->post('add', function($w) use($category) {   
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    
    $category->insert($pid, $name);
    $w->redirect('category');
});

$w->get('remove', function($w) use($category) {
    $id = $_GET['id'];
    
    $w->render(
        'views/category_delete.php', 
        ['category' => $category->get($id)]
    );
});

$w->post('remove', function($w) use($category){ 
    $id = $_POST['id'];
    $category->remove($id);
    $w->redirect('category');
});

$w->get('modify', function($w) use($category) {
    $id = $_GET['id'];
    
    $w->render(
        'views/category_modify.php',
        ['rows' => $category->getAll(), 'category' => $category->get($id)]
    );
});

$w->post('update', function($w) use($category){
    $id = $_POST['id'];
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    
    $category->update($id, $pid, $name);
    
    $w->redirect('category');
});

$w->run();