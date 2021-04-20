<?php

namespace App\Http\Requests\Config;

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
        return [];
    }
}
