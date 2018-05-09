<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?= $_SERVER['CONTEXT_PREFIX']?>/static/css/markdown.css">
    </head>
    <body class="markdown-body">

<h1>PHP 快速上手(三)</h1>

<!-- 登录后显示欢迎信息 -->
<?php if (!empty($_SESSION['username'])): ?>

欢迎你 <?= htmlspecialchars($_SESSION['username']) ?>;
<a href="<?= $_SERVER['SCRIPT_NAME']?>?action=logout">退出登录</a>

<?php else: ?>

<a href="<?= $_SERVER['SCRIPT_NAME']?>?action=register">用户注册</a>
<a href="<?= $_SERVER['SCRIPT_NAME']?>?action=login">用户登录</a>

<?php endif ?>
<br>


<!-- 处理退出登录 -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'logout') {
    if (!empty($_SESSION['username'])) unset($_SESSION['username']);
    header('Location: ' . $_SERVER['SCRIPT_NAME']);
    die();
}
?>

<?php
// 定义数据库连接字符串
$dbms = 'mysql';
$host = 'localhost';
$dbName = 'test';
$user = 'root';
$pass = 'password';
$port = 3307;
$dsn = "$dbms:host=$host;port=$port;dbname=$dbName;charset=utf8";

?>

<!-- 显示用户注册界面 -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'register'):?>    
<h2>用户注册</h2>

<form action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>?action=register" method="post">
    <p>用户名：<input name="username" type="text"></p>
    <p>密码：<input name="password" type="password"></p>
    <p><input type="submit" value="注册"></p>
</form>

<?php endif ?>

<!-- 处理用户注册请求 -->
<?php
// https://stackoverflow.com/questions/401656/secure-hash-and-salt-for-php-passwords
// https://jonsuh.com/blog/securely-hash-passwords-with-php/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'register') {
    
    // 1、检查用户名和密码是否有效: 用户名只允许数字字母，最少 5 位，密码至少 6 位 任意字符
    $errs = [];
    $username = null;
    $password = null;
    
    if (filter_has_var(INPUT_POST, 'username')) {
        $username = filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\w{5,}$/']]);
        if ($username === false) array_push($errs, '用户名格式不合法，必须为数字和字母，且最小 5 位。'); 
    } else {
        array_push($errs, '用户名不能为空');    
    }
    
    if (filter_has_var(INPUT_POST, 'password')) {
        $password = $_POST['password'];
        if (strlen($password) < 6) array_push($errs, '密码长度太短，至少 6 位。'); 
    } else {
        array_push($errs, '密码不能为空');    
    }
    
    // 2、如果输入有误，则打印错误信息并退出
    if (!empty($errs)) {
        foreach ($errs as $err) {
            echo $err . '<br>';
        }
        die();
    }
    
    // 3、检测用户名是否已存在
    
    $username = strtolower($username); // 用户名不区分大小写
    
    $dbh = new PDO($dsn, $user, $pass); 
    $sth = $dbh->prepare("select * from users where username = ?");
    $sth->execute([$username]);
    $rows = $sth->fetchAll();
    if (!empty($rows)) {
        echo "$username 用户已存在<br>";
        die();
    }
    
    // 4、使用慢速 hash 和 随机 salt 生成密码摘要并写库  
    $password = password_hash($password, PASSWORD_BCRYPT);    
    
    $dbh = new PDO($dsn, $user, $pass);
    $sth = $dbh->prepare("insert into users(username, password, created_at) values(?, ?, ?)");
    $sth->execute([$username, $password, date('Y-m-d H:i:s')]);
    
    echo "恭喜你，$username, 注册成功<br>";    
}

?>

<!-- 显示用户登录界面 -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'login'):?>    
<h2>用户登录</h2>

<form action="<?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>?action=login" method="post">
    <p>用户名：<input name="username" type="text"></p>
    <p>密码：<input name="password" type="password"></p>
    <p><input type="submit" value="登录"></p>
</form>
<?php endif ?>

<!-- 处理用户登录请求 -->
<?php
// https://stackoverflow.com/questions/401656/secure-hash-and-salt-for-php-passwords
// https://jonsuh.com/blog/securely-hash-passwords-with-php/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'login') {
    
    // 1、检查用户名和密码是否有效: 用户名只允许数字字母，最少 5 位，密码至少 6 位 任意字符
    $errs = [];
    $username = null;
    $password = null;
    
    if (filter_has_var(INPUT_POST, 'username')) {
        $username = filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\w{5,}$/']]);
        if ($username === false) array_push($errs, '用户名格式不合法，必须为数字和字母，且最小 5 位。'); 
    } else {
        array_push($errs, '用户名不能为空');    
    }
    
    if (filter_has_var(INPUT_POST, 'password')) {
        $password = $_POST['password'];
        if (strlen($password) < 6) array_push($errs, '密码长度太短，至少 6 位。'); 
    } else {
        array_push($errs, '密码不能为空');    
    }
    
    // 2、如果输入有误，则打印错误信息并退出
    if (!empty($errs)) {
        foreach ($errs as $err) {
            echo $err . '<br>';
        }
        die();
    }
    
    // 3、检测用户名是否已存在
    
    $username = strtolower($username); // 用户名不区分大小写
    
    $dbh = new PDO($dsn, $user, $pass); 
    $sth = $dbh->prepare("select * from users where username = ?");
    $sth->execute([$username]);
    $rows = $sth->fetchAll();
    if (empty($rows)) {
        echo "$username 用户不存在<br>";
        die();
    }
    
    // 4、校验密码，登录成功，设置 session，跳到首页
    $password_hash = $rows[0]['password'];
    if (password_verify($password, $password_hash)) {
       $_SESSION['username'] = $username;
       header('Location: ' . $_SERVER['SCRIPT_NAME']);
    } else {
       echo '用户名密码错误<br>';
    }        
}

?>
</body>
</html>