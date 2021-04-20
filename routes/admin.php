<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 你可以在这里定义任何有关于admin的路由
| 
| 注意事项
| 1、所有路由的命名空间前面都会加上"App\Http\Controllers\Admin"
| 2、所有路由都会运行web、auth.guard中间件
|
*/

// 需要登录验证
Route::group(['middleware' => 'admin.auth'], function () {
	// 需要路由验证
	Route::group(['middleware' => 'admin.route'], function () {
		// MenuController
		Route::group(['prefix' => 'menu'], function () {
		    // 菜单排序
		    Route::put('{menu}/sort', 'MenuController@sort');
		    // 更新文件
		    Route::put('file', 'MenuController@updateFile');
		});
		Route::resource('menu', 'MenuController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

		// AdminController
		Route::resource('admin', 'AdminController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

		// RoleController
		Route::resource('role', 'RoleController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

		// IdentityController
		Route::resource('identity', 'IdentityController')->only('index', 'create', 'store', 'edit', 'update', 'destroy');

		// ConfigController
		Route::group(['prefix' => 'config'], function () {
			// 编辑网站配置视图
			Route::get('site/edit', 'ConfigController@editSite');
			// 编辑网站配置提交
			Route::put('site', 'ConfigController@updateSite');
		});
	});
	
	// 首页
	Route::get('/', 'HomeController@index');
	// 退出登录
    Route::get('logout', 'AdminController@logout');
	// 编辑密码视图
    Route::get('password/edit', 'AdminController@editPassword');
    // 编辑密码提交
    Route::put('password', 'AdminController@updatePassword');
});

// 登录视图
Route::get('login', 'AdminController@loginView');
// 登录提交
Route::post('login', 'AdminController@login');
// 错误页面
Route::get('error', 'BaseController@errorView');