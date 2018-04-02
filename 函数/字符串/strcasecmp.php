(PHP 4, PHP 5, PHP 7)
strcasecmp — 二进制安全比较字符串（不区分大小写）

说明
int strcasecmp ( string $str1 , string $str2 )
二进制安全比较字符串（不区分大小写）。

参数
str1
第一个字符串。
str2
第二个字符串。

返回值
如果 str1 小于 str2 返回 < 0； 如果 str1 大于 str2 返回 > 0；如果两者相等，返回 0。

<?php
$var1 = "Hello";
$var2 = "hello";
if (strcasecmp($var1, $var2) == 0) {
    echo '$var1 is equal to $var2 in a case-insensitive string comparison';
}
?>