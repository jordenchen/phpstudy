(PHP 4, PHP 5, PHP 7)
getenv — 获取一个环境变量的值

说明
string getenv ( string $varname )
获取一个环境变量的值。
使用 phpinfo() 你可以看到所有环境变量的列表。 这些变量很多都在 » RFC 3875 的范围之内， 尤其是章节4.1，"Request Meta-Variables"。

参数
varname
变量名。

返回值
返回环境变量 varname 的值， 如果环境变量 varname 不存在则返回 FALSE。

<?php
// getenv() 使用示例
$ip = getenv('REMOTE_ADDR');

// 或简单仅使用全局变量（$_SERVER 或 $_ENV）
$ip = $_SERVER['REMOTE_ADDR'];
?>