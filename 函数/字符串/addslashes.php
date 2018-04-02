(PHP 4, PHP 5, PHP 7)
addslashes — 使用反斜线引用字符串

说明
string addslashes ( string $str )
返回字符串，该字符串为了数据库查询语句等的需要在某些字符前加上了反斜线。这些字符是单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）。
一个使用 addslashes() 的例子是当你要往数据库中输入数据时。 例如，将名字 O'reilly 插入到数据库中，这就需要对其进行转义。 强烈建议使用 DBMS 指定的转义函数 （比如 MySQL 是 mysqli_real_escape_string()，PostgreSQL 是 pg_escape_string()），但是如果你使用的 DBMS 没有一个转义函数，并且使用 \ 来转义特殊字符，你可以使用这个函数。 仅仅是为了获取插入数据库的数据，额外的 \ 并不会插入。 当 PHP 指令 magic_quotes_sybase 被设置成 on 时，意味着插入 ' 时将使用 ' 进行转义。
PHP 5.4 之前 PHP 指令 magic_quotes_gpc 默认是 on， 实际上所有的 GET、POST 和 COOKIE 数据都用被 addslashes() 了。 不要对已经被 magic_quotes_gpc 转义过的字符串使用 addslashes()，因为这样会导致双层转义。 遇到这种情况时可以使用函数 get_magic_quotes_gpc() 进行检测。

参数
str
要转义的字符。

返回值
返回转义后的字符。

<?php
$str = "Is your name O'reilly?";

// 输出： Is your name O\'reilly?
echo addslashes($str);
?>

title:全国药材市场逢集时刻表、开市时间_康美中药城
keywords:中药材市场逢集时间，中药材市场开市时间，中药材市场
description:在这里，你可以查询到全国各地药材市场的逢集时间，主营产品，周边交通以及市场地址。