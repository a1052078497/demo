<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

abstract class Base implements Rule
{
    /**
     * 提示信息
     *
     * @var string
     */
    protected $message;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validation($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }

    /**
     * 设置提示信息
     *
     * @param  string  $message
     * @return string
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * 验证数据
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    abstract protected function validation($attribute, $value);
}
