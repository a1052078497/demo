<?php

namespace App\Tools;

use Cache;
use App\Models\Config;
use App\Enums\ConfigType;

class CacheTool
{
    /**
     * 有效时间
     *
     * @var int
     */
    private static $time = 604800;

    /**
     * 缓存键名
     *
     * @var array
     */
    private static $keys = [
        'site' => 'site'
    ];
    
    /**
     * 获得网站配置
     *
     * @param  string  $key
     * @return array
     */
    public static function getSite(string $key = null)
    {
        $site = Cache::remember(self::$keys['site'], self::$time, function () {
            return Config::type(ConfigType::SITE)->value('value');
        });
        return $key ? ($site[$key] ?? '') : $site;
    }

    /**
     * 删除网站配置
     *
     * @return void
     */
    public static function forgetSite()
    {
        Cache::forget(self::$keys['site']);
    }
}
