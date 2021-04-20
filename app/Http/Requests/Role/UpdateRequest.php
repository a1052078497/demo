<?php

namespace App\Http\Requests\Role;

use App\Models\Menu;
use App\Models\Role;
use App\Rules\Exists;
use App\Rules\Unique;

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
            'name' => [
                'required', 'string', 'min:2', 'max:20',
                new Unique(new Role, 'name', $this->route('role'))
            ],
            'description' => 'nullable|string|max:50',
            'menu_id' => [
                'required', 'array', new Exists(new Menu)
            ]
        ];
    }
}
