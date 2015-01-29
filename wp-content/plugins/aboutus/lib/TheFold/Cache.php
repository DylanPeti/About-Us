<?php 
namespace TheFold;

class Cache{

static $static_cache;

//static cache, pass value to set, otherwise will get
static function s($value = null){

    $trace = debug_backtrace(false,2);

    $function = $trace[1]['function'];
    $args = serialize($trace[1]['args']);

    if(!is_null($value))
        return static::$static_cache[$function][$args] = $value;

    if(isset(static::$static_cache[$function][$args])){
        return static::$static_cache[$function][$args];
    }

    return null;
}

}
