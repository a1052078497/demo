<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use App\Models\Admin;
use App\Models\Identity;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateRequest;
use App\Http\Requests\Admin\UpdateRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;

class AdminController extends BaseController
{
	/**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $admins = Admin::with('identity:id,name')->ordinary()
            ->whenWhere($request->filled('keyword'), 'username', 'LIKE', "%{$request->query('keyword')}%")
            ->paginate(20, ['id', 'username', 'identity_id']);
        return view('admin.admin.index', compact('admins', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $identities = Identity::get(['id', 'name']);
        return view('admin.admin.create', compact('identities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\CreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->only('username', 'password', 'identity_id');
        $data['password'] = bcrypt($data['password']);
        Admin::create($data);
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
    	$admin = Admin::findOrFail($id, ['id', 'username', 'identity_id']);
        $identities = Identity::get(['id', 'name']);
        return view('admin.admin.edit', compact('admin', 'identities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\Admin\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateRequest $request)
    {
        $admin = Admin::findOrFail($id, ['id']);
        $data = $request->only('username', 'identity_id');
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->post('password'));
        }
        $admin->update($data);
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
        $admin = Admin::ordinary()->findOrFail($id, ['id']);
        $admin->delete();
        return $this->success('删除成功');
    }

    /**
     * 编辑密码视图
     *
     * @return \Illuminate\View\View
     */
    public function editPassword()
    {
        return view('admin.admin.editPassword');
    }

    /**
     * 编辑密码提交
     *
     * @param  \App\Http\Requests\Admin\UpdatePasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $admin = Auth::user();
        if (! Hash::check($request->post('old_password'), $admin->password)) {
            return $this->error('旧密码错误');
        }
        $admin->update(['password' => bcrypt($request->post('new_password'))]);
        return $this->success('修改成功');
    }

	/**
	 * 登录视图
	 *
	 * @return \Illuminate\View\View
	 */
	public function loginView()
	{
        return view('admin.admin.login');
	}

	/**
	 * 登录提交
	 *
     * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function login(Request $request)
	{
        $result = Auth::attempt($request->only('username', 'password'));
        if (! $result) {
            return $this->error('登录失败,请确认账号和密码是否正确');
        }
        $callback = '/';
        $admin = Auth::user();
        if (! $admin->isSuper()) {
            $admin->load('identity.menu:id,name,route');
            $callback = $admin->identity->menu->route;
        }
        return $this->success('登录成功', ['callback' => url($callback)]);
	}

    /**
     * 退出登录
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect(url('login'));
    }
}
