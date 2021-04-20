<?php

namespace App\Enums;

use ReflectionClass;

abstract class Base
{
    /**
     * 获得所有标识
     * 
     * @return array
     */
    public static function all()
    {
        return (new ReflectionClass(new static))->getConstants();
    }

    /**
     * 获得指定名称
     * 
     * @param  mixed  $key
     * @return mixed
     */
    public static function name($key)
    {
        $names = static::names();

        return $names[$key] ?? false;
    }

    /**
     * 获得keys
     * 
     * @return array
     */
    public static function keys()
    {
        return array_values(self::all());
    }

    /**
     * 获得指定key
     *
     * @param  mixed  $name
     * @return mixed
     */
    public static function key($name)
    {
        return self::all()[$name] ?? false;
    }

    /**
     * 获得字符串keys
     *
     * @param  string  $delimiter
     * @return string
     */
    public static function getStringKey($delimiter = ',')
    {
        return implode($delimiter, self::keys());
    }

    /**
     * 获得所有名称
     * 
     * @return array
     */
    abstract public static function names();
}