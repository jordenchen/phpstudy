(PHP 4, PHP 5, PHP 7)
strstr — 查找字符串的首次出现

说明
string strstr ( string $haystack , mixed $needle [, bool $before_needle = FALSE ] )
返回 haystack 字符串从 needle 第一次出现的位置开始到 haystack 结尾的字符串。

Note:
该函数区分大小写。如果想要不区分大小写，请使用 stristr()。
Note:
如果你仅仅想确定 needle 是否存在于 haystack 中，请使用速度更快、耗费内存更少的 strpos() 函数。

参数
haystack
输入字符串。
needle
如果 needle 不是一个字符串，那么它将被转化为整型并且作为字符的序号来使用。
before_needle
若为 TRUE，strstr() 将返回 needle 在 haystack 中的位置之前的部分。

返回值
返回字符串的一部分或者 FALSE（如果未发现 needle）。

<?php
$email  = 'name@example.com';
$domain = strstr($email, '@');
echo $domain; // 打印 @example.com

$user = strstr($email, '@', true); // 从 PHP 5.3.0 起
echo $user; // 打印 name
?>