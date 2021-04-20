<?php

namespace App\Rules;

use Closure;
use Illuminate\Database\Eloquent\Model;

class Unique extends Base
{
    /**
     * 提示信息
     *
     * @var string
     */
    protected $message = '已有相同的:attribute';

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
     * 排除的主键
     * 
     * @var int
     */
    private $except;

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
     * @param  int       $except
     * @param  \Closure  $conditions
     * @return void
     */
    public function __construct(Model $model, string $column = null, $except = null, Closure $conditions = null)
    {
        $this->model = $model;
        $this->column = $column;
        $this->except = $except;
        $this->conditions = $conditions;
    }

    /**
     * 验证数据
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return bool
     */
    protected function validation($attribute, $value)
    {
        // 判断是否传入了验证字段
        $column = $this->column ?: $attribute;

        return $this->model->when(method_exists($this->model, 'getQualifiedDeletedAtColumn'), function ($query) {
                $query->whereNull($this->model->getQualifiedDeletedAtColumn());
            })
            ->where($column, $value)
            ->when($this->except, function ($query) {
                $query->where($this->model->getKeyName(), '<>', $this->except);
            })
            ->when($this->conditions instanceof Closure, $this->conditions)
            ->exists() != true;
    }
}
