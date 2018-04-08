(PHP 4, PHP 5, PHP 7)
explode — 使用一个字符串分割另一个字符串

说明
array explode ( string $delimiter , string $string [, int $limit ] )
此函数返回由字符串组成的数组，每个元素都是 string 的一个子串，它们被字符串 delimiter 作为边界点分割出来。

参数
delimiter 边界上的分隔字符。
string 输入的字符串。
limit 如果设置了 limit 参数并且是正数，则返回的数组包含最多 limit 个元素，而最后那个元素将包含 string 的剩余部分。
如果 limit 参数是负数，则返回除了最后的 -limit 个元素外的所有元素。
如果 limit 是 0，则会被当做 1。
由于历史原因，虽然 implode() 可以接收两种参数顺序，但是 explode() 不行。你必须保证 separator 参数在 string 参数之前才行。

返回值
此函数返回由字符串组成的 array，每个元素都是 string 的一个子串，它们被字符串 delimiter 作为边界点分割出来。
如果 delimiter 为空字符串（""），explode() 将返回 FALSE。 如果 delimiter 所包含的值在 string 中找不到，并且使用了负数的 limit ， 那么会返回空的 array， 否则返回包含 string 单个元素的数组。

Example #1 explode() 例子
<?php
// 示例 1
$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; // piece1
echo $pieces[1]; // piece2

// 示例 2
$data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // *

?>

limit 参数的例子
<?php
$str = 'one|two|three|four';

// 正数的 limit
print_r(explode('|', $str, 2));

// 负数的 limit（自 PHP 5.1 起）
print_r(explode('|', $str, -1));
?>
以上例程会输出：
Array
(
    [0] => one
    [1] => two|three|four
)
Array
(
    [0] => one
    [1] => two
    [2] => three
)


注释
Note: 此函数可安全用于二进制对象。

