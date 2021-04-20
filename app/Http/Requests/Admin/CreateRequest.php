<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use App\Rules\Exists;
use App\Rules\Unique;
use App\Models\Identity;

class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => [
                'required', 'string', 'min:4', 'max:20', new Unique(new Admin)
            ],
            'password' => 'required|string|min:6|max:15',
            'identity_id' => ['required', 'integer', new Exists(new Identity)]
        ];
    }
}
