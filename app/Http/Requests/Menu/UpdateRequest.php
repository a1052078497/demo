<?php

namespace App\Http\Requests\Menu;

use App\Models\Menu;
use App\Rules\Exists;
use App\Rules\Unique;
use App\Enums\MenuMethod;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|min:2|max:10',
            'route' => [
                'nullable', 'required_with:method', 'string', 'max:50',
                new Unique(new Menu, 'route', $this->route('menu'), function ($query) {
                    $query->where('method', $this->post('method'));
                })
            ],
            'method' => 'nullable|required_with:route|string|in:' . MenuMethod::getStringKey(),
            'icon' => [
                'nullable',
                Rule::requiredIf(function () {
                    return ! $this->post('parent_id') && $this->post('is_show');
                }),
                'string'
            ],
            'is_show' => 'required|boolean',
            'is_verify' => 'required|boolean',
            'parent_id' => ['required', 'integer']
        ];

        if ($this->post('parent_id')) {
            $rules['parent_id'][] = new Exists(new Menu);
        }

        return $rules;
    }
}
