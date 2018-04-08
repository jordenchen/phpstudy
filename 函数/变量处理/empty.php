(PHP 4, PHP 5, PHP 7)
empty — 检查一个变量是否为空

说明
bool empty ( mixed $var )
判断一个变量是否被认为是空的。当一个变量并不存在，或者它的值等同于FALSE，那么它会被认为不存在。如果变量不存在的话，empty()并不会产生警告。

var
待检查的变量
Note:
在 PHP 5.5 之前，empty() 仅支持变量；任何其他东西将会导致一个解析错误。换言之，下列代码不会生效： empty(trim($name))。 作为替代，应该使用trim($name) == false.

没有警告会产生，哪怕变量并不存在。 这意味着 empty() 本质上与 !isset($var) || $var == false 等价。

返回值
当var存在，并且是一个非空非零的值时返回 FALSE 否则返回 TRUE.

以下的东西被认为是空的：
"" (空字符串)
0 (作为整数的0)
0.0 (作为浮点数的0)
"0" (作为字符串的0)
NULL
FALSE
array() (一个空数组)
$var; (一个声明了，但是没有值的变量)

Example #1 一个简单的 empty() 与 isset() 的比较。
<?php
$var = 0;

// Evaluates to true because $var is empty
if (empty($var)) {
    echo '$var is either 0, empty, or not set at all';
}

// Evaluates as true because $var is set
if (isset($var)) {
    echo '$var is set even though it is empty';
}
?>

注释
Note: 因为是一个语言构造器而不是一个函数，不能被 可变函数 调用。
Note:当对一个不可见的对象属性使用 empty() 时， __isset() 方法如果存在的话，它将会被调用。

