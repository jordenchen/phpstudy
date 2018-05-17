<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

class Hook
{
    /**
     * @var array 标签
     */
    private static $tags = [];

    /**
     * 动态添加行为扩展到某个标签
     * @access public
     * @param  string $tag      标签名称
     * @param  mixed  $behavior 行为名称
     * @param  bool   $first    是否放到开头执行
     * @return void
     */
    public static function add($tag, $behavior, $first = false)
    {
        isset(self::$tags[$tag]) || self::$tags[$tag] = [];

        if (is_array($behavior) && !is_callable($behavior)) {  //is_callable — 检测参数是否为合法的可调用结构bool is_callable ( callable $name [, bool $syntax_only = false [, string &$callable_name ]] )
            if (!array_key_exists('_overlay', $behavior) || !$behavior['_overlay']) {  //bool array_key_exists ( mixed $key , array $array ) 不存在_overlay键，或者_overlay的值为false
                unset($behavior['_overlay']);
                self::$tags[$tag] = array_merge(self::$tags[$tag], $behavior);
            } else {
                unset($behavior['_overlay']);
                self::$tags[$tag] = $behavior;
            }
        } elseif ($first) {
            array_unshift(self::$tags[$tag], $behavior);
        } else {
            self::$tags[$tag][] = $behavior;
        }
    }

    /**
     * 批量导入插件
     * @access public
     * @param  array   $tags      插件信息
     * @param  boolean $recursive 是否递归合并
     * @return void
     */
    public static function import(array $tags, $recursive = true)
    {
        if ($recursive) {
            foreach ($tags as $tag => $behavior) {
                self::add($tag, $behavior);
            }
        } else {
            self::$tags = $tags + self::$tags;
        }
    }

    /**
     * 获取插件信息
     * @access public
     * @param  string $tag 插件位置(留空获取全部)
     * @return array
     */
    public static function get($tag = '')
    {
        if (empty($tag)) {
            return self::$tags;
        }

        return array_key_exists($tag, self::$tags) ? self::$tags[$tag] : [];
    }

    /**
     * 监听标签的行为
     * @access public
     * @param  string $tag    标签名称
     * @param  mixed  $params 传入参数
     * @param  mixed  $extra  额外参数
     * @param  bool   $once   只获取一个有效返回值
     * @return mixed
     */
    public static function listen($tag, &$params = null, $extra = null, $once = false)
    {
        $results = [];

        foreach (static::get($tag) as $key => $name) {
            $results[$key] = self::exec($name, $tag, $params, $extra);

            // 如果返回 false，或者仅获取一个有效返回则中断行为执行
            if (false === $results[$key] || (!is_null($results[$key]) && $once)) {
                break;
            }
        }

        return $once ? end($results) : $results;//mixed end ( array &$array )将数组的内部指针指向最后一个单元
    }

    /**
     * 执行某个行为
     * @access public
     * @param  mixed  $class  要执行的行为
     * @param  string $tag    方法名（标签名）
     * @param  mixed  $params 传人的参数
     * @param  mixed  $extra  额外参数
     * @return mixed
     */
    public static function exec($class, $tag = '', &$params = null, $extra = null)
    {
        App::$debug && Debug::remark('behavior_start', 'time');  //代码运行的开始时间

        $method = Loader::parseName($tag, 1, false); //将C风格的转化为JAVA风格的命名方式

        if ($class instanceof \Closure) {//instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例：
            $result = call_user_func_array($class, [ & $params, $extra]);//mixed call_user_func_array ( callable $callback , array $param_arr )调用回调函数，并把一个数组参数作为回调函数的参数  
            $class  = 'Closure';
        } elseif (is_array($class)) {  //如果是数组
            list($class, $method) = $class; //在操作中给一组变量赋值

            $result = (new $class())->$method($params, $extra);
            $class  = $class . '->' . $method;
        } elseif (is_object($class)) { //bool is_object ( mixed $var ) 检测变量是否是一个对象
            $result = $class->$method($params, $extra);
            $class  = get_class($class);//string get_class ([ object $object = NULL ] )返回对象实例 object 所属类的名字。
        } elseif (strpos($class, '::')) { //如果是包含::的string对象
            $result = call_user_func_array($class, [ & $params, $extra]);
        } else {  //如果是类
            $obj    = new $class();
            $method = ($tag && is_callable([$obj, $method])) ? $method : 'run';
            $result = $obj->$method($params, $extra);
        }

        if (App::$debug) {
            Debug::remark('behavior_end', 'time');
            Log::record('[ BEHAVIOR ] Run ' . $class . ' @' . $tag . ' [ RunTime:' . Debug::getRangeTime('behavior_start', 'behavior_end') . 's ]', 'info');
        }

        return $result;
    }

}
