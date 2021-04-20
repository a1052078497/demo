<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 默认消息提示
     * 
     * @return array
     */
    private function defaultMessages()
    {
        return [
            'string'   => ':attribute必须为字符串',
            'integer'  => ':attribute必须为整数',
            'array'    => ':attribute必须为数组',
            'unique'   => '已有相同的:attribute',
            'in'       => '请选择正确的:attribute',
            'boolean'  => '请选择正确的:attribute',
            'min'      => [
                'file'    => ':attribute最小为:max字节',
                'array'   => ':attribute最少为:min个',
                'string'  => ':attribute最少为:min个字符',
                'numeric' => ':attribute最小为:min'
            ],
            'max'      => [
                'file'    => ':attribute最大为:max字节',
                'array'   => ':attribute最多为:max个',
                'string'  => ':attribute最多为:max个字符',
                'numeric' => ':attribute最大为:max'
            ],
            'image' => ':attribute必须为图片',
            'mimes' => ':attribute格式必须为:values',
            'required' => ':attribute不能为空',
            'required_if' => ':attribute不能为空',
            'required_with' => ':attribute不能为空'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = $this->defaultMessages();

        // 合并自定义消息提示
        if (method_exists($this, 'customMessages')) {
            $messages = array_merge($messages, $this->customMessages());
        }

        // 合并临时消息提示
        if (method_exists($this, 'temporaryMessages')) {
            $messages = array_merge($messages, $this->temporaryMessages());
        }

        return $messages;
    }

    /**
     * 获得字段别名
     *
     * @return array
     */
    public function attributes()
    {
        $attributes = $this->baseAttributes();
        
        // 合并临时字段别名
        if (method_exists($this, 'temporaryAttributes')) {
            $attributes = array_merge($attributes, $this->temporaryAttributes());
        }
        
        return $attributes;
    }
}
