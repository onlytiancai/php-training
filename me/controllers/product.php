<?php
require_once(APP_ROOT . '/models/CategoryModel.php');
require_once(APP_ROOT . '/models/ProductModel.php');
require_once(APP_ROOT . '/helpers/myhelper.php');

$category = new CategoryModel();
$product = new ProductModel();
$w = new Wawa();

$w->get('index', function($w) use($product) {
    
    // 1、初始化默认页大小和页码
    $pageSize = 5;
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 0;
    
    // 2、获取数据记录数，计算最大页码数
    $total = $product->getCount();
    $maxPage = ceil($total / $pageSize);
    
    // 3、校验输入，修正页码数，
    if ($page < 1) $page = 1;
    if ($page > $maxPage) $page = $maxPage;
    
    // 4、计算数据偏移量
    $offset = ($page - 1) * $pageSize;   
    
    $w->render(
        'views/product_list.php', 
        ['rows' => $product->getAll($pageSize, $offset), 'page' => $page, 'maxPage' => $maxPage]
    );
});

$w->get('new', function($w) use ($category){
    $w->render(
        'views/product_add.php',
        ['categories' => $category->getAll()]
    );
});

$w->get('modify', function($w) use($product, $category) {
    $id = $_GET['id'];
    
    $w->render(
        'views/user_modify.php',
        ['categories' => $category->getAll(), 
         'product' => $product->get($id)]
    );
});

$w->post('add', function($w) use($product) {   
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // 过滤富文本编辑器的危险标签
    $allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
    $allowedTags.='<li><ol><ul><span><div><br><ins><del>';
    $sContent = strip_tags(stripslashes($description),$allowedTags);
    
    $product->insert($category_id, $name, $description);
    $w->redirect('product');
});

$w->post('update', function($w) use($product){
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    $product->update($id, $category_id, $name, $description);
    
    $w->redirect('product');
});

$w->get('remove', function($w) use($product) {
    $id = $_GET['id'];
    
    $w->render(
        'views/product_delete.php', 
        ['product' => $product->get($id)]
    );
});

$w->post('remove', function($w) use($product){ 
    $id = $_POST['id'];
    $product->remove($id);
    $w->redirect('product');
});

$w->get('add_cart', function($w) use($product) {
    $product_id = $_GET['id'];
    $dbFound = $product->get($product_id);
    
    $carts = isset($_SESSION['carts']) && is_array($_SESSION['carts']) ? $_SESSION['carts'] : [];
    if (isset($carts[$product_id])) {
        $carts[$product_id]['count'] += 1;
    } else {
        $carts[$product_id] = ['name' => $dbFound['name'], 'count' => 1];
    }
    
    $_SESSION['carts'] = $carts;    
    $w->redirect('product');
});

$w->run();