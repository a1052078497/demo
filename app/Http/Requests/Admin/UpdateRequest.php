<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin;
use App\Rules\Exists;
use App\Rules\Unique;
use App\Models\Identity;

class UpdateRequest extends BaseRequest
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
                'required', 'string', 'min:4', 'max:20',
                new Unique(new Admin, 'username', $this->route('admin'))
            ],
            'password' => 'nullable|string|min:6|max:15',
            'identity_id' => ['required', 'integer', new Exists(new Identity)]
        ];
    }
}
