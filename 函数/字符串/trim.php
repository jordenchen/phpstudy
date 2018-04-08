(PHP 4, PHP 5, PHP 7)
trim — 去除字符串首尾处的空白字符（或者其他字符）

说明
string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
此函数返回字符串 str 去除首尾空白字符后的结果。如果不指定第二个参数，trim() 将去除这些字符：
" " (ASCII 32 (0x20))，普通空格符。
"\t" (ASCII 9 (0x09))，制表符。
"\n" (ASCII 10 (0x0A))，换行符。
"\r" (ASCII 13 (0x0D))，回车符。
"\0" (ASCII 0 (0x00))，空字节符。
"\x0B" (ASCII 11 (0x0B))，垂直制表符。

参数
str
待处理的字符串。
character_mask
可选参数，过滤字符也可由 character_mask 参数指定。一般要列出所有希望过滤的字符，也可以使用 “..” 列出一个字符范围。

返回值
过滤后的字符串。

Example #1 trim() 使用范例

<?php

$text   = "\t\tThese are a few words :) ...  ";
$binary = "\x09Example string\x0A";
$hello  = "Hello World";
var_dump($text, $binary, $hello);

print "\n";

$trimmed = trim($text);
var_dump($trimmed);

$trimmed = trim($text, " \t.");
var_dump($trimmed);

$trimmed = trim($hello, "Hdle");
var_dump($trimmed);

// 清除 $binary 首位的 ASCII 控制字符
// （包括 0-31）
$clean = trim($binary, "\x00..\x1F");
var_dump($clean);

?>

以上例程会输出：

string(32) "        These are a few words :) ...  "
string(16) "    Example string
"
string(11) "Hello World"

string(28) "These are a few words :) ..."
string(24) "These are a few words :)"
string(5) "o Wor"
string(14) "Example string"

