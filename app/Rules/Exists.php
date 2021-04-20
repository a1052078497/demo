<?php

namespace App\Rules;

use Closure;
use Illuminate\Database\Eloquent\Model;

class Exists extends Base
{
    /**
     * 提示信息
     *
     * @var string
     */
    protected $message = ':attribute不存在';
    
    /**
     * 操作的模型
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $model;

    /**
     * 验证字段
     * 
     * @var string
     */
    private $column;

    /**
     * 附加条件
     * 
     * @var \Closure
     */
    private $conditions;

    /**
     * Create a new rule instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string    $column
     * @param  \Closure  $conditions
     * @return void
     */
    public function __construct(Model $model, string $column = 'id', Closure $conditions = null)
    {
        $this->model = $model;
        $this->column = $column;
        $this->conditions = $conditions;
    }

    /**
     * 验证数据
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    protected function validation($attribute, $value)
    {
        return $this->model->when(method_exists($this->model, 'getQualifiedDeletedAtColumn'), function ($query) {
                $query->whereNull($this->model->getQualifiedDeletedAtColumn());
            })
            ->when(is_array($value), function ($query) use ($value) {
                $query->whereIn($this->column, $value);
            }, function ($query) use ($value) {
                $query->where($this->column, $value);
            })
            ->when($this->conditions instanceof Closure, $this->conditions)
            ->count() == (is_array($value) ? count($value) : 1);
    }
}
