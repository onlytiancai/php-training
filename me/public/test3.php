<?php include('../views/inc_header.php') ?>

<?php session_start(); ?>

<h1>PHP 快速上手：用户注册与登录</h1>

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

<hr>

<h2>确保开启 SESSION</h2>

<pre>
&lt;?php session_start(); ?&gt;
</pre>

<h2>已登录和未登录显示不同界面</h2>

<pre>
&lt;?php if (!empty($_SESSION['username'])): ?&gt;

欢迎你 &lt;?= htmlspecialchars($_SESSION['username']) ?&gt;;
&lt;a href="&lt;?= $_SERVER['SCRIPT_NAME']?&gt;?action=logout"&gt;退出登录&lt;/a&gt;

&lt;?php else: ?&gt;
&lt;a href="&lt;?= $_SERVER['SCRIPT_NAME']?&gt;?action=register"&gt;用户注册&lt;/a&gt;
&lt;a href="&lt;?= $_SERVER['SCRIPT_NAME']?&gt;?action=login"&gt;用户登录&lt;/a&gt;

&lt;?php endif ?&gt;
</pre>

<h2>用户注册表单</h2>
<pre>
&lt;form action="&lt;?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?&gt;?action=register" method="post"&gt;
    &lt;p&gt;用户名：&lt;input name="username" type="text"&gt;&lt;/p&gt;
    &lt;p&gt;密码：&lt;input name="password" type="password"&gt;&lt;/p&gt;
    &lt;p&gt;&lt;input type="submit" value="注册"&gt;&lt;/p&gt;
&lt;/form&gt;
</pre>

<h2>处理用户注册请求</h2>
<pre>
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'register') {
    
    // 1、检查用户名和密码是否有效: 用户名只允许数字字母，最少 5 位，密码至少 6 位 任意字符
    $errs = [];
    $username = null;
    $password = null;
    
    if (filter_has_var(INPUT_POST, 'username')) {
        $username = filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, ['options' =&gt; ['regexp' =&gt; '/^\w{5,}$/']]);
        if ($username === false) array_push($errs, '用户名格式不合法，必须为数字和字母，且最小 5 位。'); 
    } else {
        array_push($errs, '用户名不能为空');    
    }
    
    if (filter_has_var(INPUT_POST, 'password')) {
        $password = $_POST['password'];
        if (strlen($password) &lt; 6) array_push($errs, '密码长度太短，至少 6 位。'); 
    } else {
        array_push($errs, '密码不能为空');    
    }
    
    // 2、如果输入有误，则打印错误信息并退出
    if (!empty($errs)) {
        foreach ($errs as $err) {
            echo $err . '&lt;br&gt;';
        }
        die();
    }
    
    // 3、检测用户名是否已存在
    
    $username = strtolower($username); // 用户名不区分大小写
    
    $dbh = new PDO($dsn, $user, $pass); 
    $sth = $dbh-&gt;prepare("select * from users where username = ?");
    $sth-&gt;execute([$username]);
    $rows = $sth-&gt;fetchAll();
    if (!empty($rows)) {
        echo "$username 用户已存在&lt;br&gt;";
        die();
    }
    
    // 4、使用慢速 hash 和 随机 salt 生成密码摘要并写库  
    $password = password_hash($password, PASSWORD_BCRYPT);    
    
    $dbh = new PDO($dsn, $user, $pass);
    $sth = $dbh-&gt;prepare("insert into users(username, password, created_at) values(?, ?, ?)");
    $sth-&gt;execute([$username, $password, date('Y-m-d H:i:s')]);
    
    echo "恭喜你，$username, 注册成功&lt;br&gt;";
}    
</pre>

<h2>用户登录表单</h2>
<pre>
&lt;form action="&lt;?= htmlspecialchars($_SERVER['SCRIPT_NAME']) ?&gt;?action=login" method="post"&gt;
    &lt;p&gt;用户名：&lt;input name="username" type="text"&gt;&lt;/p&gt;
    &lt;p&gt;密码：&lt;input name="password" type="password"&gt;&lt;/p&gt;
    &lt;p&gt;&lt;input type="submit" value="登录"&gt;&lt;/p&gt;
&lt;/form&gt;
</pre>

<h2>处理用户登录请求</h2>
<pre>
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'login') {
    
    // 1、检查用户名和密码是否有效: 用户名只允许数字字母，最少 5 位，密码至少 6 位 任意字符
    $errs = [];
    $username = null;
    $password = null;
    
    if (filter_has_var(INPUT_POST, 'username')) {
        $username = filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, ['options' =&gt; ['regexp' =&gt; '/^\w{5,}$/']]);
        if ($username === false) array_push($errs, '用户名格式不合法，必须为数字和字母，且最小 5 位。'); 
    } else {
        array_push($errs, '用户名不能为空');    
    }
    
    if (filter_has_var(INPUT_POST, 'password')) {
        $password = $_POST['password'];
        if (strlen($password) &lt; 6) array_push($errs, '密码长度太短，至少 6 位。'); 
    } else {
        array_push($errs, '密码不能为空');    
    }
    
    // 2、如果输入有误，则打印错误信息并退出
    if (!empty($errs)) {
        foreach ($errs as $err) {
            echo $err . '&lt;br&gt;';
        }
        die();
    }
    
    // 3、检测用户名是否已存在
    
    $username = strtolower($username); // 用户名不区分大小写
    
    $dbh = new PDO($dsn, $user, $pass); 
    $sth = $dbh-&gt;prepare("select * from users where username = ?");
    $sth-&gt;execute([$username]);
    $rows = $sth-&gt;fetchAll();
    if (empty($rows)) {
        echo "$username 用户不存在&lt;br&gt;";
        die();
    }
    
    // 4、校验密码，登录成功，设置 session，跳到首页
    $password_hash = $rows[0]['password'];
    if (password_verify($password, $password_hash)) {
       $_SESSION['username'] = $username;
       header('Location: ' . $_SERVER['SCRIPT_NAME']);
    } else {
       echo '用户名密码错误&lt;br&gt;';
    }        
}
</pre>
<?php include('../views/inc_footer.php') ?>