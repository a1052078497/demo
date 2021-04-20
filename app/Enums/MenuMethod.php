<?php

namespace App\Enums;

class MenuMethod extends Base
{
    /**
     * GET请求
     * 
     * @var int
     */
    const GET = 1;

    /**
     * POST请求
     * 
     * @var int
     */
    const POST = 2;

    /**
     * PUT请求
     * 
     * @var int
     */
    const PUT = 3;

    /**
     * DELETE请求
     * 
     * @var int
     */
    const DELETE = 4;

    /**
     * 获得所有名称
     * 
     * @return array
     */
    public static function names()
    {
        return [
            self::GET => 'GET',
            self::POST => 'POST',
            self::PUT => 'PUT',
            self::DELETE => 'DELETE'
        ];
    }
}