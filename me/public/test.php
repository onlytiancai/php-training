<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="static/css/markdown.css">
    </head>
    <body class="markdown-body">

<h1>PHP 快速上手</h1>
    
<h2>输出信息</h2>
        
<pre>
// 打印字符串
echo 'Hello PHP !'; 

// 打印数字
echo 2018;

// 混合打印
echo 'Hello ' . 2018 . ' !';

// 输出复杂类型
var_dump(2018);

// 格式化输出
printf('hello %s ！', 2018);
</pre>

<?php
// 打印字符串
echo 'Hello PHP !'; 
echo "<br>";

// 打印数字
echo 2018;
echo "<br>";

// 混合打印
echo 'Hello ' . 2018 . ' !';
echo "<br>";

// 输出复杂类型
var_dump(2018);
echo "<br>";

// 格式化输出
printf('hello %s ！', 2018);
?>
 
<h2>数学运算</h2>

<pre>
echo 2 + 3;
echo 2 + 3 * 5;
echo (2 + 3) * 5;
</pre>       
<?php 
echo 2 + 3;
echo "<br>";
echo 2 + 3 * 5;
echo "<br>";
echo (2 + 3) * 5;
echo "<br>";
?>

<h2>关系运算</h2>
<pre>
var_dump(3 * 5 > 8);
var_dump(3 * 5 < 8);
var_dump(3 * 5 == 15);
var_dump(3 * 5 != 15);
</pre>
<?php
var_dump(3 * 5 > 8);
echo '<br>';

var_dump(3 * 5 < 8);
echo '<br>';

var_dump(3 * 5 == 15);
echo '<br>';

var_dump(3 * 5 != 15);
echo '<br>';

?>
<h2>逻辑运算</h2>

<?php
var_dump(1 + 2 > 3 && 2 + 3 == 5);
echo '<br>';

var_dump(1 + 2 > 3 || 2 + 3 == 5);
echo '<br>';

var_dump(1 + 2 > 3 || 2 + 3 == 5 && 3 - 2 > 1);
echo '<br>';

var_dump(!(3 + 2 == 5));
echo '<br>';
?>

<h2>变量和赋值</h2>

<pre>
$a = 10;
$b = 5;
$c = $a + $b;
echo $c;

$c += 2;
echo $c;

$c++;
echo $c;
</pre>

<?php
$a = 10;
$b = 5;
$c = $a + $b;
echo $c;
echo "<br>";

$c += 2;
echo $c;
echo "<br>";

$c++;
echo $c;
echo "<br>";
?>
        
<h2>字符串模版</h2>        

<pre>
$a = 'Hello';
$b = 'World';
echo "$a $b .";
</pre>

<?php
$a = 'Hello';
$b = 'World';
echo "$a $b .";
?>

<h2>条件语句和关系操作符：两个数谁最大</h2>

<pre>
$a = 8;
$b = 3;

if ($a > $b) {
    echo 'a 最大';
}

if ($a < $b) {
    echo 'b 最大';
}
</pre>

<?php
$a = 8;
$b = 3;

if ($a > $b) {
    echo 'a 最大';
}

if ($a < $b) {
    echo 'b 最大';
}
?>

<h2>多重条件语句和逻辑操作符：三个数谁最大</h2>
<pre>
$a = 5;
$b = 3;
$c = 9;

if ($a > $b && $a > $c) {
    echo 'a 最大';
} else if ($b > $c) {
    echo 'b 最大';
} else {
    echo 'c 最大';
}
</pre>
<?php
$a = 5;
$b = 3;
$c = 9;

if ($a > $b && $a > $c) {
    echo 'a 最大';
} else if ($b > $c) {
    echo 'b 最大';
} else {
    echo 'c 最大';
}
?>

<h2>循环语句：打印 5 次 Hello</h2>
<pre>
$n = 5;
while ($n > 0) {
    echo 'Hello';
    $n--;
}
</pre>
<?php
$n = 5;
while ($n > 0) {
    echo 'Hello' . '<br>';
    $n--;
}
?>

<h2>for 循环：打印 10 以内的偶数</h2>

<?php
for ($i = 0; $i < 10; $i++) {
    if ($i % 2 == 0) {
        echo $i . '<br>';
    }
}
?>

<pre>
// 打印数组
$arr = [2, 0, 1, 8];
print_r($arr);

// 获取数组长度
echo count($arr);

// 获取指定索引元素
echo $arr[1];

// 修改指定索引元素的值
$arr[3] = 9;
print_r($arr);

// 数组末尾增加元素
array_push($arr, 5);
print_r($arr);

// 某元素是否存在
echo in_array(2, $arr) ? 'true' : 'false';

// 遍历数组
foreach ($arr as $item) {
    echo $item;
}

// 删除指定索引元素
unset($arr[2]);
print_r($arr);

// 重排数组
array_splice($arr, 0, 0);
print_r($arr);

// 任意位置插入元素
array_splice($arr, 1, 1, 8);
print_r($arr);

// 连接成字符串
echo join(',', $arr);
</pre>

<h2>数组基本操作</h2>
<?php
// 打印数组
$arr = [2, 0, 1, 8];
print_r($arr);
echo '<br>';

// 获取数组长度
echo count($arr);
echo '<br>';

// 获取指定索引元素
echo $arr[1];
echo '<br>';

// 修改指定索引元素的值
$arr[3] = 9;
print_r($arr);
echo '<br>';

// 数组末尾增加元素
array_push($arr, 5);
print_r($arr);
echo '<br>';

// 某元素是否存在
echo in_array(2, $arr) ? 'true' : 'false';
echo '<br>';

// 遍历数组
foreach ($arr as $item) {
    echo $item . '<br>';
}

// 删除指定索引元素
unset($arr[2]);
print_r($arr);
echo '<br>';

// 重排数组
array_splice($arr, 0, 0);
print_r($arr);
echo '<br>';

// 任意位置插入元素
array_splice($arr, 1, 1, 8);
print_r($arr);
echo '<br>';

// 连接成字符串
echo join(',', $arr);
?>

<h2>练习</h2>
<ul>
    <li>找出一个数组中最大的数</li>
    <li>找出一个数组中最大的奇数</li>
    <li>求出数组中所有奇数的和</li>
</ul>

<h2>字符串基本操作</h2>
<pre>
// 字符串长度
echo strlen('abcde');
echo strlen('中国人');
echo mb_strlen('中国人');

// 字符串连接
echo 'hello' . ' world .';

// 转换大小写
echo strtoupper('abcd');
echo strtolower('abcd');
echo ucfirst('abcd');

// 去掉首尾指定字符
echo ltrim('   abc');
echo rtrim('abc   ');
echo trim('  abc  ');

// 用某字符在首尾填充    
echo str_pad('abc', 10, '--');

// 分割成数组
print_r(explode(', ', 'a, b, c, d'));

// 比较两个字符串
echo 'abcd' == 'ABCD' ? 'true' : 'false';
echo strcasecmp('abcd', 'ABCD') === 0 ? 'true' : 'false';


// 获取某子串的位置
echo strpos('abcd', 'cd');

// 是否存在某个子串
if (strpos('abcd', 'cde') === false) {
    echo 'not found';
}

// 替换某个子串
echo str_replace('111', '222', 'aaa111bbb');

// 获取子串
echo substr('aaa111bbb', 2, 5);

// 是否以某子串开头或结尾
echo strpos('aaa111bbb', 'aaa') === 0 ? 'true' : 'false';
echo strpos('aaa111bbb', 'bbb') === strlen('aaa111bbb') - strlen('bbb') ? 'true' : 'false';
</pre>
<?php
// 字符串长度
echo strlen('abcde');
echo '<br>';
echo strlen('中国人');
echo '<br>';
echo mb_strlen('中国人');
echo '<br>';

// 字符串连接
echo 'hello' . ' world .';
echo '<br>';

// 转换大小写
echo strtoupper('abcd');
echo '<br>';
echo strtolower('abcd');
echo '<br>';
echo ucfirst('abcd');
echo '<br>';

// 去掉首尾指定字符
echo ltrim('   abc');
echo '<br>';
echo rtrim('abc   ');
echo '<br>';
echo trim('  abc  ');
echo '<br>';


// 用某字符在首尾填充    
echo str_pad('abc', 10, '--');
echo '<br>';

// 分割成数组
print_r(explode(', ', 'a, b, c, d'));
echo '<br>';

// 比较两个字符串
echo 'abcd' == 'ABCD' ? 'true' : 'false';
echo '<br>';
echo strcasecmp('abcd', 'ABCD') === 0 ? 'true' : 'false';
echo '<br>';

// 获取某子串的位置
echo strpos('abcd', 'cd');
echo '<br>';

// 是否存在某个子串
if (strpos('abcd', 'cde') === false) {
    echo 'not found';
}
echo '<br>';

// 替换某个子串

echo str_replace('111', '222', 'aaa111bbb');
echo '<br>';

// 获取子串
echo substr('aaa111bbb', 2, 5);
echo '<br>';

// 是否以某子串开头或结尾
echo strpos('aaa111bbb', 'aaa') === 0 ? 'true' : 'false';
echo '<br>';
echo strpos('aaa111bbb', 'bbb') === strlen('aaa111bbb') - strlen('bbb') ? 'true' : 'false';
?>

<h2>练习</h2>
<ul>
    <li>判断某字符是否为大写</li>
    <li>把字符串中的每个单词首字母大写</li>
    <li>按大写字母分割字符串</li>
</ul>

<h2>字典：关联数组</h2>

<?php
$d = ['a' => 1, 'b' => 2];
//根据键获取值
echo $d['a'];
echo '<br>';

//添加键值对
$d['c'] = 3;
print_r($d);
echo '<br>';


//删除指定键
unset($d['b']);
print_r($d);
echo '<br>';

//某键是否存在
var_dump(isset($d['a']), isset($d['b']));
echo '<br>';

//遍历字典
foreach ($d as $k => $v) {
    echo "$k => $v";
    echo '<br>';
}

?>

<h2>时间操作：</h2>
<pre>
// 设置时区
date_default_timezone_set("PRC");

// 获取当前时间的时间戳。
echo time();

// 获取当前时间格式化字符串
echo date("Y-m-d H:i:s");
</pre>
<?php
// 设置时区
date_default_timezone_set("PRC");

// 获取当前时间的时间戳。
echo time();
echo '<br>';

// 获取当前时间格式化字符串
echo date("Y-m-d H:i:s");
echo '<br>'
?>

<h2>文件操作: 打开并逐行读取文件</h2>
<pre>
$filename = 'inc.php';
if(file_exists($filename)){
    $file = fopen($filename, "r") or exit("Unable to open file!");
    while(!feof($file)) {
        echo htmlspecialchars(fgets($file));
    }
    fclose($file);
}
</pre>
<?php
$filename = 'inc.php';
if(file_exists($filename)){
    $file = fopen($filename, "r") or exit("Unable to open file!");
    while(!feof($file)) {
        echo htmlspecialchars(fgets($file)) . "<br>";
    }
    fclose($file);
}
?>


<h2>类型判断</h2>
<pre>
// 是否为数字
var_dump(is_numeric('3'));
var_dump(is_numeric(3));
var_dump(is_numeric(3.3));
var_dump(is_numeric('3.3'));

// 是否为整型
var_dump(is_int(3));

// 是否为浮点数
var_dump(is_float(3.3));

// 是否为字符串
var_dump(is_string('abd'));

// 是否为 null
var_dump(is_null(null));

// 是否为 数组
var_dump(is_array([1, 2, 3]));

// 是否为空
var_dump(empty(0));
var_dump(empty(1));
var_dump(empty(true));
var_dump(empty(false));
var_dump(empty(''));
var_dump(empty('a'));
var_dump(empty('0'));
var_dump(empty('1'));
</pre>
<?php
// 是否为数字
var_dump(is_numeric('3'));
echo '<br>';
var_dump(is_numeric(3));
echo '<br>';
var_dump(is_numeric(3.3));
echo '<br>';
var_dump(is_numeric('3.3'));
echo '<br>';

// 是否为整型
var_dump(is_int(3));
echo '<br>';

// 是否为浮点数
var_dump(is_float(3.3));
echo '<br>';

// 是否为字符串
var_dump(is_string('abd'));
echo '<br>';

// 是否为 null
var_dump(is_null(null));
echo '<br>';

// 是否为 数组
var_dump(is_array([1, 2, 3]));
echo '<br>';

// 是否为空
var_dump(empty(0));
var_dump(empty(1));
var_dump(empty(false));
var_dump(empty(true));
var_dump(empty(''));
var_dump(empty('a'));
var_dump(empty('0'));
var_dump(empty('1'));
var_dump(empty([]));
var_dump(empty([1]));
?>

<h2>类型转换</h2>
<pre>
// 数字转字符串
var_dump(strval(333));

// 字符串转数字
var_dump(intval('3333'));
</pre>
<?php
// 数字转字符串
var_dump(strval(333));
echo '<br>';

// 字符串转数字
var_dump(intval('3333'));
echo '<br>';
?>

<h2>函数定义和调用</h2>
<pre>
function add($a, $b) {
    return intval($a) + intval($b);
}

echo add(2, 3);
</pre>
<?php
function add($a, $b) {
    return intval($a) + intval($b);
}

echo add(2, 3);
echo '<br>';
?>

<h2>匿名方法和闭包</h2>
<pre>
$arr = [1, 8, 3, 5, 7, 2, 4, 0, 9, 4];
$max = 5;
$filterArr = array_filter($arr, function ($item) use($max) {
    return $item <= $max;
});
print_r($filterArr);
</pre>
<?php

$arr = [1, 8, 3, 5, 7, 2, 4, 0, 9, 4];
$max = 5;
$filterArr = array_filter($arr, function ($item) use($max) {
    return $item <= $max;
});
print_r($filterArr);

?>

<h2>返回函数的函数</h2>
<pre>
function addFactory($a){
    return function($b) use($a) {
        return $a + $b;
    };
}
$add2 = addFactory(2);
echo $add2(3);
</pre>
<?php
function addFactory($a){
    return function($b) use($a) {
        return $a + $b;
    };
}
$add2 = addFactory(2);
echo $add2(3);
?>

<h2>参数为函数的函数</h2>
<pre>
function testFunc($func) {
    return $func(3, 3);
}

function mult($a, $b) {
    return intval($a) * intval($b);
}

echo testFunc('add');
echo testFunc('mult');
</pre>
<?php
function testFunc($func) {
    return $func(3, 3);
}

function mult($a, $b) {
    return intval($a) * intval($b);
}

echo testFunc('add');
echo '<br>';
echo testFunc('mult');
echo '<br>';
?>

<h2>函数的递归</h2>
<pre>
function fib($n) {
    if ($n == 1 || $n == 2) return 1;
    return fib($n - 2) + fib($n - 1);
}
echo fib(12);
</pre>
<?php
function fib($n) {
    if ($n == 1 || $n == 2) return 1;
    return fib($n - 2) + fib($n - 1);
}
echo fib(12);
?>

<h2>类: 方法，字段，静态字段</h2>
<pre>
class User {
    private static $showcount = 0;
    private $age;
    private $username;
    
    public function __construct($username, $age) {
        $this->username = $username;
        $this->age = $age;
    }
    
    public function show() {
        self::$showcount++;
        $count = self::$showcount;
        echo "show($count):I'm {$this->username}, {$this->age} years old.";
    }
}

$user = new User('bob', 19);
$user->show();

$user = new User('alice', 17);
$user->show();
</pre>
<?php
class User {
    private static $showcount = 0;
    private $age;
    private $username;
    
    public function __construct($username, $age) {
        $this->username = $username;
        $this->age = $age;
    }
    
    public function show() {
        self::$showcount++;
        $count = self::$showcount;
        echo "show($count):I'm {$this->username}, {$this->age} years old. ";
    }
}

$user = new User('bob', 19);
$user->show();
echo '<br>';

$user = new User('alice', 17);
$user->show();

?>

<h2>子类父类</h2>
<pre>
class Girl extends User {
    public function __construct($username, $age) {
        parent::__construct($username, $age);
    }
    public function show() {
        parent::show();
        echo 'I am a girl. ';
    }
}
$girl = new Girl('Alic', 19);
$girl->show();
</pre>
<?php
class Girl extends User {
    public function __construct($username, $age) {
        parent::__construct($username, $age);
    }
    public function show() {
        parent::show();
        echo 'I am a girl.';
    }
}
$girl = new Girl('Alic', 19);
$girl->show();
?>
    </body>
</html>