<?php
/* 
* @Author: anchen
* @Date:   2018-04-26 11:18:55
* @Last Modified by:   anchen
* @Last Modified time: 2018-04-26 16:36:57
*/
// require 'auto2.php';
    
$ob = new auto2();

function __autoload($classname){
    require_once($classname.'.php');
}

?>

<!---
    当PHP5加载一个类时，如果发现这个类没有被定义，就会自动运行__autoload($cl)方法，在这个
    函数中我们可以加载我们所有的类文件。在这个简单的例子中，只是简单的类名+扩展名构成了
    类文件名，然后使用request_one方法将其加载。
    在这简单的步骤中autoload至少做了三件事：
    1、根据类名确定类文件
    2、自动调用__autoload方法
    3、通过request_one加载类文件


PHP自动加载的原理



-->