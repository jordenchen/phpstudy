(PHP 4, PHP 5, PHP 7)
strpos — 查找字符串首次出现的位置

说明
int strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )
返回 needle 在 haystack 中首次出现的数字位置。

参数
haystack
在该字符串中进行查找。
needle
如果 needle 不是一个字符串，那么它将被转换为整型并被视为字符的顺序值。
offset
如果提供了此参数，搜索会从字符串该字符数的起始位置开始统计。 如果是负数，搜索会从字符串结尾指定字符数开始。

返回值
返回 needle 存在于 haystack 字符串起始的位置(独立于 offset)。同时注意字符串位置是从0开始，而不是从1开始的。
如果没找到 needle，将返回 FALSE。
Warning
此函数可能返回布尔值 FALSE，但也可能返回等同于 FALSE 的非布尔值。请阅读 布尔类型章节以获取更多信息。应使用 === 运算符来测试此函数的返回值。

Example #1 使用 ===
<?php
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// 注意这里使用的是 ===。简单的 == 不能像我们期待的那样工作，
// 因为 'a' 是第 0 位置上的（第一个）字符。
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$mystring'";
} else {
    echo "The string '$findme' was found in the string '$mystring'";
    echo " and exists at position $pos";
}
?>


Example #2 使用 !==
<?php
$mystring = 'abc';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// 使用 !== 操作符。使用 != 不能像我们期待的那样工作，
// 因为 'a' 的位置是 0。语句 (0 != false) 的结果是 false。
if ($pos !== false) {
     echo "The string '$findme' was found in the string '$mystring'";
         echo " and exists at position $pos";
} else {
     echo "The string '$findme' was not found in the string '$mystring'";
}
?>

Example #3 使用位置偏移量
<?php
// 忽视位置偏移量之前的字符进行查找
$newstring = 'abcdef abcdef';
$pos = strpos($newstring, 'a', 1); // $pos = 7, 不是 0
?>


