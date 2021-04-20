<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\Request;

class BaseRequest extends Request
{
    /**
     * 基本字段别名
     *
     * @return array
     */
    protected function baseAttributes()
    {
        return [
            'name' => '菜单名称',
            'route' => '菜单路由',
            'method' => '请求方式',
            'icon' => '菜单图标',
            'is_show' => '是否显示',
            'is_verify' => '是否验证',
            'parent_id' => '所属上级',
            'sequence' => '排序'
        ];
    }
}
