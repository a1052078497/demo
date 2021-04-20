<?php

namespace App\Http\Requests\Menu;

class SortRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sequence' => 'required|numeric|min:-255|max:255'
        ];
    }
}
