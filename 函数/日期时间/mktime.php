(PHP 4, PHP 5, PHP 7)
mktime — 取得一个日期的 Unix 时间戳

说明
int mktime ([ int $hour = date("H") [, int $minute = date("i") [, int $second = date("s") [, int $month = date("n") [, int $day = date("j") [, int $year = date("Y") [, int $is_dst = -1 ]]]]]]] )
根据给出的参数返回 Unix 时间戳。时间戳是一个长整数，包含了从 Unix 纪元（January 1 1970 00:00:00 GMT）到给定时间的秒数。
参数可以从右向左省略，任何省略的参数会被设置成本地日期和时间的当前值。

注释
Note:
As of PHP 5.1, when called with no arguments, mktime() throws an E_STRICT notice: use the time() function instead.

返回值
mktime() 根据给出的参数返回 Unix 时间戳。如果参数非法，本函数返回 FALSE（在 PHP 5.1 之前返回 -1）。

错误／异常
在每 次调用日期/时间函数时，如果时区无效则会引发 E_NOTICE 错误，如果使用系统设定值或 TZ 环境变量，则会引发 E_STRICT 或 E_WARNING 消息。参见 date_default_timezone_set()。

Example #1 基本例子

<?php
// Set the default timezone to use. Available as of PHP 5.1
date_default_timezone_set('UTC');

// Prints: July 1, 2000 is on a Saturday
echo "July 1, 2000 is on a " . date("l", mktime(0, 0, 0, 7, 1, 2000));

// Prints something like: 2006-04-05T01:02:03+00:00
echo date('c', mktime(1, 2, 3, 4, 5, 2006));
?>
Example #2 mktime() 例子

mktime() 在做日期计算和验证方面很有用，它会自动计算超出范围的输入的正确值。例如下面例子中每一行都会产生字符串 "Jan-01-1998"。

<?php
echo date("M-d-Y", mktime(0, 0, 0, 12, 32, 1997));
echo date("M-d-Y", mktime(0, 0, 0, 13, 1, 1997));
echo date("M-d-Y", mktime(0, 0, 0, 1, 1, 1998));
echo date("M-d-Y", mktime(0, 0, 0, 1, 1, 98));
?>
Example #3 下个月的最后一天

任何给定月份的最后一天都可以被表示为下个月的第 "0" 天，而不是 -1 天。下面两个例子都会产生字符串 "The last day in Feb 2000 is: 29"。

<?php
$lastday = mktime(0, 0, 0, 3, 0, 2000);
echo strftime("Last day in Feb 2000 is: %d", $lastday);
$lastday = mktime(0, 0, 0, 4, -31, 2000);
echo strftime("Last day in Feb 2000 is: %d", $lastday);
?>