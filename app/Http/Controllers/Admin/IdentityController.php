<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Identity;
use Illuminate\Http\Request;
use App\Http\Requests\Identity\CreateRequest;
use App\Http\Requests\Identity\UpdateRequest;

class IdentityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $identities = Identity::whenWhere($request->filled('keyword'), 'name', 'LIKE', "%{$request->query('keyword')}%")->paginate(20, ['id', 'name']);
        return view('admin.identity.index', compact('identities', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::get(['id', 'name']);
        $menus = Menu::get(['id', 'name', 'route', 'method', 'is_verify', 'parent_id']);
        return view('admin.identity.create', compact('roles', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Identity\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only('name', 'description', 'menu_id');
        $roleKeys = $request->post('role_id');
        DB::transaction(function () use ($data, $roleKeys) {
            $identity = Identity::create($data);
            $identity->roles()->attach($roleKeys);
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
        $identity = Identity::findOrFail($id, ['id', 'name', 'description', 'menu_id']);
        $checkedRoles = $identity->roles()->pluck('id');
        $menus = Menu::get(['id', 'name', 'route', 'method', 'is_verify', 'parent_id']);
        $roles = Role::with('menus:name')->get(['id', 'name', 'description']);
        return view('admin.identity.edit', compact('identity', 'checkedRoles', 'menus', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\Identity\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $identity = Identity::findOrFail($id, ['id']);
        $data = $request->only('name', 'description', 'menu_id');
        $roleKeys = $request->post('role_id');
        DB::transaction(function () use ($identity, $data, $roleKeys) {
            $identity->update($data);
            $identity->roles()->sync($roleKeys);
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
        $identity = Identity::findOrFail($id, ['id']);
        $this->authorize('delete', $identity);
        $identity->delete();
        return $this->success('删除成功');
    }
}
