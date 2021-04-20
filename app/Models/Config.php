<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Config extends Base
{
    /**
     * 表名
     * 
     * @var string
     */
    protected $table = 'config';

    /**
     * 允许批量赋值的字段
     * 
     * @var array
     */
    protected $fillable = ['type', 'value'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'array'
    ];

    /**
     * 筛选类型
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $parameters
     * @return void
     */
    public function scopeType(Builder $query, string $type)
    {
        $query->where('type', $type);
    }
}
