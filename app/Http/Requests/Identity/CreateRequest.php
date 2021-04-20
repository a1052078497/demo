<?php

namespace App\Http\Requests\Identity;

use App\Models\Role;
use App\Models\Menu;
use App\Rules\Exists;
use App\Rules\Unique;
use App\Models\Identity;
use App\Enums\MenuMethod;

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
            'name' => ['required', 'string', 'min:2', 'max:20', new Unique(new Identity)],
            'description' => 'nullable|string|max:50',
            'menu_id' => [
                'required', 'integer',
                new Exists(new Menu, 'id', function ($query) {
                    $query->where('method', MenuMethod::GET);
                })
            ],
            'role_id' => [
                'required', 'array', new Exists(new Role)
            ]
        ];
    }
}
