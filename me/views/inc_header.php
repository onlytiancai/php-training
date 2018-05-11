<!DOCTYPE html>
<html>
    <head>
        <title>艾氪森 PHP 实训</title>
        <link href="<?= $_SERVER['CONTEXT_PREFIX'] ?>/static/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .navbar-action {
                background: #34AFED -webkit-gradient(linear,0% 0%, 0% 100%, from(#349AED), to(#34B5ED));
                box-shadow:2px 2px 10px #3333;
                color: #fff;
                border: none;
                border-radius: 0;
            }
            .navbar-action .navbar-brand:link,
            .navbar-action .navbar-brand:hover,
            .navbar-action .navbar-brand:active,
            .navbar-action .navbar-brand:visited  {
                color: #fff;
            }
            .navbar-action .navbar-nav>li>a {
                color: #fff;
            }
            .navbar-action .navbar-nav>li>a:hover {
                color: #eee;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-action">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">艾氪森 PHP 实训</a>
                </div>
                
                <ul class="nav navbar-nav">
                    <li><a href="<?= $_SERVER['CONTEXT_PREFIX'] . '/index'  ?>">用户管理</a></li>
                    <li><a href="<?= $_SERVER['CONTEXT_PREFIX'] . '/category'  ?>">分类管理</a></li>
                    <li><a href="<?= $_SERVER['CONTEXT_PREFIX'] . '/product'  ?>">商品管理</a></li>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">
                    <li><a  href="<?= $_SERVER['CONTEXT_PREFIX'] . '/test.php'  ?>">基本语法演示</a></li>
                    <li><a  href="<?= $_SERVER['CONTEXT_PREFIX'] . '/test2.php'  ?>">Web 及数据库演示</a></li>
                    <li><a  href="<?= $_SERVER['CONTEXT_PREFIX'] . '/test3.php'  ?>">注册和登录演示</a></li>
                </ul>
                
            </div>
        </nav>
        <div class="container">