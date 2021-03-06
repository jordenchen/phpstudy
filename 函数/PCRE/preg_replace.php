(PHP 4, PHP 5, PHP 7)
preg_replace — 执行一个正则表达式的搜索和替换

说明
mixed preg_replace ( mixed $pattern , mixed $replacement , mixed $subject [, int $limit = -1 [, int &$count ]] )
搜索subject中匹配pattern的部分， 以replacement进行替换。

参数
pattern
要搜索的模式。可以使一个字符串或字符串数组。
可以使用一些PCRE修饰符。

replacement
用于替换的字符串或字符串数组。如果这个参数是一个字符串，并且pattern 是一个数组，那么所有的模式都使用这个字符串进行替换。如果pattern和replacement 都是数组，每个pattern使用replacement中对应的 元素进行替换。如果replacement中的元素比pattern中的少， 多出来的pattern使用空字符串进行替换。
replacement中可以包含后向引用\\n 或$n，语法上首选后者。 每个 这样的引用将被匹配到的第n个捕获子组捕获到的文本替换。 n 可以是0-99，\\0和$0代表完整的模式匹配文本。 捕获子组的序号计数方式为：代表捕获子组的左括号从左到右， 从1开始数。如果要在replacement 中使用反斜线，必须使用4个("\\\\"，译注：因为这首先是php的字符串，经过转义后，是两个，再经过 正则表达式引擎后才被认为是一个原文反斜线)。

当在替换模式下工作并且后向引用后面紧跟着需要是另外一个数字(比如：在一个匹配模式后紧接着增加一个原文数字)， 不能使用\\1这样的语法来描述后向引用。比如， \\11将会使preg_replace() 不能理解你希望的是一个\\1后向引用紧跟一个原文1，还是 一个\\11后向引用后面不跟任何东西。 这种情况下解决方案是使用${1}1。 这创建了一个独立的$1后向引用, 一个独立的原文1。

当使用被弃用的 e 修饰符时, 这个函数会转义一些字符(即：'、"、 \ 和 NULL) 然后进行后向引用替换。当这些完成后请确保后向引用解析完后没有单引号或 双引号引起的语法错误(比如： 'strlen(\'$1\')+strlen("$2")')。确保符合PHP的 字符串语法，并且符合eval语法。因为在完成替换后， 引擎会将结果字符串作为php代码使用eval方式进行评估并将返回值作为最终参与替换的字符串。

subject
要进行搜索和替换的字符串或字符串数组。
如果subject是一个数组，搜索和替换回在subject 的每一个元素上进行, 并且返回值也会是一个数组。

limit
每个模式在每个subject上进行替换的最大次数。默认是 -1(无限)。

count
如果指定，将会被填充为完成的替换次数。

返回值
如果subject是一个数组， preg_replace()返回一个数组， 其他情况下返回一个字符串。
如果匹配被查找到，替换后的subject被返回，其他情况下 返回没有改变的 subject。如果发生错误，返回 NULL 。

错误／异常
PHP 5.5.0 起， 传入 "\e" 修饰符的时候，会产生一个 E_DEPRECATED 错误； PHP 7.0.0 起，会产生 E_WARNING 错误，同时 "\e" 也无法起效。

<?php
$string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string);
?>

<?php
$string = 'The quick brown fox jumps over the lazy dog.';
$patterns = array();
$patterns[0] = '/quick/';
$patterns[1] = '/brown/';
$patterns[2] = '/fox/';
$replacements = array();
$replacements[2] = 'bear';
$replacements[1] = 'black';
$replacements[0] = 'slow';
echo preg_replace($patterns, $replacements, $string);
?>

<?php
$patterns = array ('/(19|20)(\d{2})-(\d{1,2})-(\d{1,2})/',
                   '/^\s*{(\w+)}\s*=/');
$replace = array ('\3/\4/\1\2', '$\1 =');
echo preg_replace($patterns, $replace, '{startDate} = 1999-5-27');
?>

<?php
$str = 'foo   o';
$str = preg_replace('/\s\s+/', ' ', $str);
// 将会改变为'foo o'
echo $str;
?>

<?php
$count = 0;

echo preg_replace(array('/\d/', '/\s/'), '*', 'xp 4 to', -1 , $count);
echo $count; //3
?>
