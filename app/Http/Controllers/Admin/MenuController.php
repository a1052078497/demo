<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\SortRequest;
use App\Http\Requests\Menu\CreateRequest;
use App\Http\Requests\Menu\UpdateRequest;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $menus = Menu::latest('sequence')->get(['id', 'name', 'route', 'method', 'parent_id', 'sequence', 'is_show', 'is_verify']);
        $menus = $this->formatIndexData($menus);
        return view('admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $menus = Menu::latest('sequence')->get(['id', 'name', 'parent_id'])->prepend(['id' => 0, 'name' => '顶级']);
        $parent = $request->query('parent_id', 0);
        return view('admin.menu.create', compact('menus', 'parent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Menu\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only('name', 'route', 'method', 'icon', 'is_show', 'is_verify', 'parent_id');
        Menu::create($data);
        return $this->success('添加成功');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id, ['id', 'name', 'route', 'method', 'icon', 'is_show', 'is_verify', 'parent_id']);
        // 排除后代
        $descendants = $menu->getDescendants();
        $menus = Menu::whereNotIn('id', $descendants)->latest('sequence')->get(['id', 'name', 'parent_id'])->prepend(['id' => 0, 'name' => '顶级']);
        return view('admin.menu.edit', compact('menu', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\Menu\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $menu = Menu::findOrFail($id, ['id']);
        $this->authorize('update', $menu);
        $data = $request->only('name', 'route', 'method', 'icon', 'is_show', 'is_verify', 'parent_id');
        $menu->update($data);
        return $this->success('编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id, ['id']);
        $this->authorize('delete', $menu);
        $menu->delete();
        return $this->success('删除成功');
    }

    /**
     * 菜单排序
     * 
     * @param  int  $id
     * @param  \App\Http\Requests\Menu\SortRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sort($id, SortRequest $request)
    {
        $menu = Menu::findOrFail($id, ['id']);
        $menu->sequence = $request->post('sequence');
        $menu->save();
        return $this->success('操作成功');
    }

    /**
     * 更新文件
     *
     * @return \Illuminate\Http\Response
     */
    public function updateFile()
    {
        $menus = Menu::withoutGlobalScopes()->latest('sequence')->get(['id', 'name', 'route', 'method', 'icon', 'sequence', 'is_show', 'is_verify', 'parent_id']);
        Storage::disk('local')->put('seeds/menus.json', $menus->toJson());
        return $this->success('更新成功');
    }

    /**
     * 格式化首页数据
     *
     * @param  \Illuminate\Database\Eloquent\Collection  $menus
     * @param  int  $parentKey
     * @return array
     */
    private function formatIndexData($menus, $parentKey = 0)
    {
        static $result = [];
        foreach ($menus as $index => $menu) {
            if ($menu->parent_id == $parentKey) {
                $result[] = $menu;
                $menus->forget($index);
                $this->formatIndexData($menus, $menu->id);
            }
        }
        return $result;
    }
}
