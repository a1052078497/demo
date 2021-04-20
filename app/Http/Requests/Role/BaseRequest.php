<?php

namespace App\Http\Requests\Role;

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
            'name' => '角色名称',
            'description' => '角色描述',
            'menu_id' => '权限数据'
        ];
    }
}
