<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::whenWhere($request->filled('keyword'), 'name', 'LIKE', "%{$request->query('keyword')}%")->paginate(20, ['id', 'name']);
        return view('admin.role.index', compact('roles', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $menus = Menu::get(['id', 'name', 'is_verify', 'parent_id']);
        return view('admin.role.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Role\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only('name', 'description');
        $menuKeys = $request->post('menu_id');
        DB::transaction(function () use ($data, $menuKeys) {
            $role = Role::create($data);
            $role->menus()->attach($menuKeys);
        });
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
        $role = Role::findOrFail($id, ['id', 'name', 'description']);
        $selected = $role->menus()->pluck('id');
        $menus = Menu::get(['id', 'name', 'is_verify', 'parent_id']);
        return view('admin.role.edit', compact('role', 'selected', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\Role\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $role = Role::findOrFail($id, ['id']);
        $data = $request->only('name', 'description');
        $menuKeys = $request->post('menu_id');
        DB::transaction(function () use ($role, $data, $menuKeys) {
            $role->update($data);
            $role->menus()->sync($menuKeys);
        });
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
        $role = Role::findOrFail($id, ['id']);
        $role->delete();
        return $this->success('删除成功');
    }
}
