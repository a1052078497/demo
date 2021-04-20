<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use App\Tools\FileTool;
use App\Tools\CacheTool;
use App\Enums\ConfigType;
use App\Http\Requests\Config\UpdateSiteRequest;

class ConfigController extends BaseController
{
    /**
     * 编辑网站配置视图
     *
     * @return \Illuminate\View\View
     */
    public function editSite()
    {
        $site = Config::type(ConfigType::SITE)->value('value');
        return view('admin.config.editSite', compact('site'));
    }

    /**
     * 编辑网站配置提交
     * 
     * @param  \App\Http\Requests\Config\UpdateSiteRequest  $request
     * @param  \App\Tools\FileTool  $fileTool
     * @return \Illuminate\Http\Response
     */
    public function updateSite(UpdateSiteRequest $request, FileTool $fileTool)
    {
        $site = Config::type(ConfigType::SITE)->value('value');
        $data = array_merge(['icon' => $site['icon'], 'logo' => $site['logo']], $request->only('name', 'title', 'keywords', 'description', 'icp'));
        if ($request->hasFile('icon')) {
            $data['icon'] = $fileTool->getUrl($fileTool->upload($request->file('icon')));
            if ($site['icon']) {
                $fileTool->delete($site['icon']);
            }
        }
        if ($request->hasFile('logo')) {
            $data['logo'] = $fileTool->getUrl($fileTool->upload($request->file('logo')));
            if ($site['logo']) {
                $fileTool->delete($site['logo']);
            }
        }
        CacheTool::forgetSite();
        Config::type(ConfigType::SITE)->update(['value' => json_encode($data)]);
        return $this->success('编辑成功');
    }
}
