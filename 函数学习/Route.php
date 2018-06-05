<?php
/* 
* @Author: anchen
* @Date:   2018-06-05 09:56:47
* @Last Modified by:   anchen
* @Last Modified time: 2018-06-05 10:41:50
*/
class Route{

    private static function parseVar($rule){
        $var = [];
        foreach(explode($rule, "/") as $val){
            $optinal = false;
            if(false !==strpos($val, '<') && preg_match_all('/<(\w+(\??))/', $val, $matches)){
                foreach($matches as $name){
                    if(strpos($matches[1],'?')){
                            $optinal = true;
                            $name = substr($name,0,-1);                        
                      }else{
                            $optinal = false;
                    }
                    $var[$name] = $optinal ? 2 : 1 ;
                }
                
            }

            if (0 === strpos($val,'[:')) {
                    $optinal = true;
                    $val = substr($val, 1,-1);
            }

            }

            if (0 === strpos($val, ':')) {
                    $name = substr($val, 1);
                    $var[$name] = $optinal ? 2 : 1;
        }
        return $var;
    }
}


?>
