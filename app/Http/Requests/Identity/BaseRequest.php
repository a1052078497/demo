<?php

namespace App\Http\Requests\Identity;

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
            'name' => '身份名称',
            'description' => '身份描述',
            'menu_id' => '默认菜单',
            'role_id' => '角色数据'
        ];
    }
}
