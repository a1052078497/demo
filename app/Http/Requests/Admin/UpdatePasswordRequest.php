<?php

namespace App\Http\Requests\Admin;

class UpdatePasswordRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:6|max:15'
        ];
    }

    /**
     * 临时字段别名
     * 
     * @return array
     */
    protected function temporaryAttributes()
    {
        return [
            'old_password' => '旧密码',
            'new_password' => '新密码'
        ];
    }
}
