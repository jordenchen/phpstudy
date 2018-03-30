(PHP 4, PHP 5, PHP 7)
get_magic_quotes_gpc — 获取当前 magic_quotes_gpc 的配置选项设置

说明
bool get_magic_quotes_gpc ( void )
返回当前 magic_quotes_gpc 配置选项的设置
记住，尝试在运行时设置 magic_quotes_gpc 将不会生效。
更多关于 magic_quotes 的信息参见安全一章。

返回值
如果 magic_quotes_gpc 为关闭时返回 0，否则返回 1。在 PHP 5.4.O 起将始终返回 FALSE。
(5.4.0   始终返回 FALSE，因为这个魔术引号功能已经从 PHP 中移除了。)

<?php
// 如果启用了魔术引号
echo $_POST['lastname'];             // O\'reilly
echo addslashes($_POST['lastname']); // O\\\'reilly

// 适用各个 PHP 版本的用法
if (get_magic_quotes_gpc()) {
    $lastname = stripslashes($_POST['lastname']);
}
else {
    $lastname = $_POST['lastname'];
}

// 如果使用 MySQL
$lastname = mysql_real_escape_string($lastname);

echo $lastname; // O\'reilly
$sql = "INSERT INTO lastnames (lastname) VALUES ('$lastname')";
?>
