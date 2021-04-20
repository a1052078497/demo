<?php

namespace App\Http\Requests\Admin;

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
            'username' => '用户名',
            'password' => '密码',
            'identity_id' => '所属身份'
        ];
    }
}
