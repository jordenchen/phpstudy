(PHP 4, PHP 5, PHP 7)
array_walk — 使用用户自定义函数对数组中的每个元素做回调处理

说明
bool array_walk ( array &$array , callable $callback [, mixed $userdata = NULL ] )
将用户自定义函数 funcname 应用到 array 数组中的每个单元。
array_walk() 不会受到 array 内部数组指针的影响。array_walk() 会遍历整个数组而不管指针的位置。

参数
array
输入的数组。
callback
典型情况下 callback 接受两个参数。array 参数的值作为第一个，键名作为第二个。
Note:
如果 callback 需要直接作用于数组中的值，则给 callback 的第一个参数指定为引用。这样任何对这些单元的改变也将会改变原始数组本身。
Note:
参数数量超过预期，传入内置函数 (例如 strtolower())， 将抛出警告，所以不适合当做 funcname。
只有 array 的值才可以被改变，用户不应在回调函数中改变该数组本身的结构。例如增加/删除单元，unset 单元等等。如果 array_walk() 作用的数组改变了，则此函数的的行为未经定义，且不可预期。
userdata
如果提供了可选参数 userdata，将被作为第三个参数传递给 callback funcname。

返回值
成功时返回 TRUE， 或者在失败时返回 FALSE。

错误／异常
如果 callback 函数需要的参数比给出的多，则每次 array_walk() 调用 callback 时都会产生一个 E_WARNING 级的错误。

<?php
$fruits = array("d" => "lemon", "a" => "orange", "b" => "banana", "c" => "apple");

function test_alter(&$item1, $key, $prefix)
{
    $item1 = "$prefix: $item1";
}

function test_print($item2, $key)
{
    echo "$key. $item2<br />\n";
}

echo "Before ...:\n";
array_walk($fruits, 'test_print');

array_walk($fruits, 'test_alter', 'fruit');
echo "... and after:\n";

array_walk($fruits, 'test_print');
?>

以上例程会输出：
Before ...:
d. lemon
a. orange
b. banana
c. apple
... and after:
d. fruit: lemon
a. fruit: orange
b. fruit: banana
c. fruit: apple