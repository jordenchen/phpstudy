(PHP 5 >= 5.1.0, PHP 7)
date_default_timezone_set — 设定用于一个脚本中所有日期时间函数的默认时区

说明
bool date_default_timezone_set ( string $timezone_identifier )
date_default_timezone_set() 设定用于所有日期时间函数的默认时区。
Note:
自 PHP 5.1.0 起（此版本日期时间函数被重写了），如果时区不合法则每个对日期时间函数的调用都会产生一条 E_NOTICE 级别的错误信息，如果使用系统设定或 TZ 环境变量则还会产生 E_STRICT 级别的信息。
除了用此函数，你还可以通过 INI 设置 date.timezone 来设置默认时区。

参数
timezone_identifier
时区标识符，例如 UTC 或 Europe/Lisbon。合法标识符列表见所支持的时区列表。

返回值
如果 timezone_identifier 参数无效则返回 FALSE，否则返回 TRUE。

<?php
//时区
if(function_exists('date_default_timezone_set'))
{
    @date_default_timezone_set("PRC");
}
?>

