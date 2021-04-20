<?php

namespace App\Enums;

class ConfigType extends Base
{
    /**
     * 网站
     * 
     * @var string
     */
    const SITE = 'site';

    /**
     * 获得所有名称
     * 
     * @return array
     */
    public static function names()
    {
        return [];
    }
}