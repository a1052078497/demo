<?php

namespace App\Http\Requests\Config;

class UpdateSiteRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'nullable|mimes:ico|max:100',
            'logo' => 'nullable|image|max:1024',
            'name' => 'required|string|max:20',
            'title' => 'required|string|max:80',
            'keywords' => 'required|string|max:100',
            'description' => 'required|string|max:200',
            'icp' => 'required|string|max:50'
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
            'icon' => '网站图标',
            'logo' => '网站logo',
            'name' => '网站名称',
            'title' => '网站标题',
            'keywords' => '网站关键词',
            'description' => '网站描述',
            'icp' => '网站备案号'
        ];
    }
}
