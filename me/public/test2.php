<?php include('../views/inc_header.php') ?>

<style>
.result {
    padding: 10px;
}
</style>

<h1>PHP 快速上手：Web 编程及数据库编程</h1>
    
<h2>获取服务器变量</h2>
<pre>
$keys = ['SERVER_NAME', 'SERVER_PORT', 'REQUEST_METHOD', 'REQUEST_URI', 'PHP_SELF', 'SCRIPT_NAME', 'CONTEXT_PREFIX'];
foreach ($keys as $key) {
    printf('%s: %s', $key, $_SERVER[$key]);
}
</pre>
<a href="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>/aa/bb?id=1">测试</a><br>
<div class="bg-info result"><?php
$keys = ['SERVER_NAME', 'SERVER_PORT', 'REQUEST_METHOD', 'REQUEST_URI', 'PHP_SELF', 'SCRIPT_NAME', 'CONTEXT_PREFIX'];
foreach ($keys as $key) {
    printf('%s: %s <br>', $key, $_SERVER[$key]);
}
echo '<br>';
?></div>

<h2>获取 GET 数据</h2>
<pre>
print_r($_GET);
</pre>
<a href="<?= $_SERVER['SCRIPT_NAME']?>?user=你好&pass=我好">测试</a><br>
<div class="bg-info result"><?php
print_r($_GET);
?></div>

<h2>获取 POST 数据</h2>
<a id="test_post"></a>
<pre>
&ltform action="&lt?= $_SERVER['SCRIPT_NAME'] ?&gt;?id=3" method="post"&gt;
    &ltinput name="username" type="hidden" value="wawa"&gt;
    &ltinput name="password" type="hidden" value="123456"&gt;
    &ltinput type="submit" value="测试"&gt; 
&lt/form&gt;
&lt?php
print_r($_POST);
?&gt;
</pre>
<form action="<?= $_SERVER['SCRIPT_NAME'] ?>?id=3#test_post" method="post">
    <input name="username" type="hidden" value="wawa">
    <input name="password" type="hidden" value="123456">
    <input type="submit" value="测试"> 
</form>
<br>
<div class="bg-info result"><?php
print_r($_POST);
?></div>

<h2>使用 Cookie </h2>
<pre>
$views = 1;
if(isset($_COOKIE['views'])) $views = intval($_COOKIE['views']) + 1;
setcookie("views",  $views, time()+3600);   
echo "cookie 浏览量：$views &ltbr&gt;";
</pre>
<div class="bg-info result"><?php
$views = 1;
if(isset($_COOKIE['views'])) $views = intval($_COOKIE['views']) + 1;
setcookie("views",  $views, time()+3600);   
echo "cookie 浏览量：$views <br>";
?></div>


<h2>使用 Session </h2>
<pre>
$views = 1;
if(isset($_SESSION['views'])) $views = intval($_SESSION['views']) + 1;
$_SESSION['views'] = $views;
echo "session 浏览量：$views ";
</pre>
<div class="bg-info result"><?php
$views = 1;
if(isset($_SESSION['views'])) $views = intval($_SESSION['views']) + 1;
$_SESSION['views'] = $views;
echo "session 浏览量：$views <br>";
?></div>

<h2>魔术变量</h2>
<pre>
echo '这是第 " '  . __LINE__ . ' " 行&ltbr&gt;';
echo '该文件位于 " '  . __FILE__ . ' " &ltbr&gt;';
echo '该文件位于 " '  . __DIR__ . ' " &ltbr&gt;';

function test() {
    echo  '函数名为：' . __FUNCTION__ . '&ltbr&gt;';
}
test();

class MagicTest {
    function _print() {
        echo '类名为：'  . __CLASS__ . "&ltbr&gt;";
        echo  '函数名为：' . __FUNCTION__ ;
    }
}
$t = new MagicTest();
$t-&gt;_print();
</pre>
<div class="bg-info result"><?php
echo '这是第 " '  . __LINE__ . ' " 行<br>';
echo '该文件位于 " '  . __FILE__ . ' " <br>';
echo '该文件位于 " '  . __DIR__ . ' " <br>';

function test() {
    echo  '函数名为：' . __FUNCTION__ . '<br>';
}
test();

class MagicTest {
    function _print() {
        echo '类名为：'  . __CLASS__ . "<br>";
        echo  '函数名为：' . __FUNCTION__ ;
    }
}
$t = new MagicTest();
$t->_print();

?></div>

<h2>包含文件</h2>
<pre>
include 'inc.php';
require 'inc.php';

// inc.php 
&lt?php
echo "I'm in " . __FILE__ . '&ltbr&gt';
echo 'Welcome study PHP. &ltbr&gt';

</pre>
<div class="bg-info result"><?php
include 'inc.php';
require 'inc.php';
?></div>

</pre>

<h2>数据过滤</h2>
<pre>

$errs = [];
// https://www.w3cschool.cn/php/php-ref-filter.html

// 确认输入不为空，且格式合法
if (filter_has_var(INPUT_GET, 'username')) {
    $username = filter_var($_GET['username'], FILTER_VALIDATE_REGEXP, ['options' =&gt ['regexp' =&gt '/^\w{5,}$/']]);
     if ($username !== false) {
        
        echo 'username = ' .$_GET['username'];
        echo '&ltbr&gt';
            
    } else {
        array_push($errs, 'username 格式不合法，必须为数字和字母，且最小 5 位。');       
    }

} else {
    array_push($errs, 'username 为空');    
}


// 确认输入为整数
if (filter_has_var(INPUT_GET, 'user_id')) {
    $user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
    if ($user_id !== false) {
        
        echo 'user_id = ' . $user_id;
        echo '&ltbr&gt';
        
    } else {
        array_push($errs, 'user_id 不为整数。');       
    }
  
} else {
    array_push($errs, 'user_id 为空');    
}

// 确认数字为整型，并在一定范围
if (filter_has_var(INPUT_GET, 'age')) {
    $user_id = filter_var($_GET['age'], FILTER_VALIDATE_INT, ['options' =&gt ['min_range' =&gt 18, 'max_range' =&gt 25]]);
    if ($user_id !== false) {
        
        echo 'age = ' . $user_id;
        echo '&ltbr&gt';
        
    } else {
        array_push($errs, 'age 不是整数或不在 18 - 25 之间');        
    }
  
} else {
    array_push($errs, 'age 为空');   
}


if (!empty($errs)) {
    foreach($errs as $err) {
        echo $err;
        echo '&ltbr&gt';
    }
}
</pre>
<a id='test_filter' href="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>#test_filter">测试1</a>
<a id='test_filter' href="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>?username=abc&user_id=abc&age=16#test_filter">测试2</a>
<a id='test_filter' href="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>?username=abcefg&user_id=100&age=21#test_filter">测试2</a>
<br>
<div class="bg-info result"><?php

$errs = [];
// https://www.w3cschool.cn/php/php-ref-filter.html

// 确认输入不为空，且格式合法
if (filter_has_var(INPUT_GET, 'username')) {
    $username = filter_var($_GET['username'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\w{5,}$/']]);
     if ($username !== false) {
        
        echo 'username = ' .$_GET['username'];
        echo '<br>';
            
    } else {
        array_push($errs, 'username 格式不合法，必须为数字和字母，且最小 5 位。');       
    }

} else {
    array_push($errs, 'username 为空');    
}


// 确认输入为整数
if (filter_has_var(INPUT_GET, 'user_id')) {
    $user_id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
    if ($user_id !== false) {
        
        echo 'user_id = ' . $user_id;
        echo '<br>';
        
    } else {
        array_push($errs, 'user_id 不为整数。');       
    }
  
} else {
    array_push($errs, 'user_id 为空');    
}

// 确认数字为整型，并在一定范围
if (filter_has_var(INPUT_GET, 'age')) {
    $user_id = filter_var($_GET['age'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 18, 'max_range' => 25]]);
    if ($user_id !== false) {
        
        echo 'age = ' . $user_id;
        echo '<br>';
        
    } else {
        array_push($errs, 'age 不是整数或不在 18 - 25 之间');        
    }
  
} else {
    array_push($errs, 'age 为空');   
}


if (!empty($errs)) {
    foreach($errs as $err) {
        echo $err;
        echo '<br>';
    }
}

?></div>

<h2>数据库操作：建表，初始化数据</h2>
<pre>
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `nickname` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`username`, `nickname`, `password`, `created_at`) VALUES
('abcde', '流川枫', '123456', '2018-05-05 16:48:01'),
('ddddd', '路飞', '123456', '2018-05-07 15:04:49'),
('onlykk', '纳米', '123456', '2018-05-07 15:04:56'),
('hello', '乌索普', '123456', '2018-05-07 15:05:04'),
('qiqiqi', '樱木花道', '123456', '2018-05-07 15:05:11'),
('hahaha', '翅目青紫', '666666', '2018-05-11 04:55:14');
</pre>

<h2>数据库基本操作</h2>
<pre>
$dbms = 'mysql';
$host = 'localhost';
$dbName = 'test';
$user = 'root';
$pass = 'password';
$port = 3307;
$dsn = "$dbms:host=$host;port=$port;dbname=$dbName;charset=utf8";


try {
    $dbh = new PDO($dsn, $user, $pass);
    echo '连接成功';
    echo '&lt;br&gt;';
    
    $sql = 'select * from users limit 10';
    $rows = $dbh-&gt;query($sql);
    foreach ($rows as $row) {
        printf('id=%s username=%s, nickname=%s, created_at=%s', $row['id'], $row['username'], $row['nickname'], $row['created_at']);
        echo '&lt;br&gt;';
    }
    
    $dbh = null;
} catch (PDOException $e) {
    die ("Error!: " . $e-&gt;getMessage() . "&lt;br/&gt;");
}
</pre>
<div class="bg-info result"><?php

$dbms = 'mysql';
$host = 'localhost';
$dbName = 'test';
$user = 'root';
$pass = 'password';
$port = 3307;
$dsn = "$dbms:host=$host;port=$port;dbname=$dbName;charset=utf8";


try {
    $dbh = new PDO($dsn, $user, $pass);
    echo '连接成功';
    echo '<br>';
    
    $sql = 'select * from users limit 10';
    $rows = $dbh->query($sql);
    foreach ($rows as $row) {
        printf('id=%s username=%s, nickname=%s, created_at=%s', $row['id'], $row['username'], $row['nickname'], $row['created_at']);
        echo '<br>';
    }
    
    $dbh = null;
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}
?></div>

<h2>数据库参数化查询</h2>
<pre>
$dbh = new PDO($dsn, $user, $pass); 
$sth = $dbh->prepare("select * from users where id > ? limit 10");
$sth->execute([5]);

$rows = $sth->fetchAll();
foreach ($rows as $row) {
    printf('id=%s username=%s, nickname=%s, created_at=%s', $row['id'], $row['username'], $row['nickname'], $row['created_at']);    
}

$dbh = null;
</pre>
<div class="bg-info result"><?php

$dbh = new PDO($dsn, $user, $pass); 
$sth = $dbh->prepare("select * from users where id > ? limit 10");
$sth->execute([5]);

$rows = $sth->fetchAll();
foreach ($rows as $row) {
    printf('id=%s username=%s, nickname=%s, created_at=%s', $row['id'], $row['username'], $row['nickname'], $row['created_at']);
    echo '<br>';
}

$dbh = null;

?></div>

<h2>数据库新增数据</h2>
<pre>
$dbh = new PDO($dsn, $user, $pass);
$sth = $dbh->prepare("insert into users(username, password, created_at) values(?, ?, ?)");
$sth->execute(['haha', '中国人', date('Y-m-d H:i:s')]);

echo '影响行数：' . $sth->rowCount() . ', 插入 ID：' . $dbh->lastInsertId ();

$dbh = null;
</pre>

<div class="bg-info result"><?php
$dbh = new PDO($dsn, $user, $pass);
$sth = $dbh->prepare("insert into users(username, password, created_at) values(?, ?, ?)");
$sth->execute(['haha', '中国人', date('Y-m-d H:i:s')]);

echo '影响行数：' . $sth->rowCount() . ', 插入 ID：' . $dbh->lastInsertId ();
echo '<br>';

$dbh = null;
?></div>

<?php include('../views/inc_footer.php') ?>