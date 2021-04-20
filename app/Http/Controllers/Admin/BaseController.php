<?php

namespace App\Http\Controllers\Admin;

use Blade;
use App\Http\Response;
use App\Enums\MenuMethod;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
	use Response;

	/**
	 * 构造函数
	 *
	 * @return void
	 */
	public function __construct()
	{
		view()->share('method', MenuMethod::class);
        Blade::if('can', function ($route, $method) {
            return verifyAccess($route, $method);
        });
	}

	/**
	 * 错误视图
	 *
	 * @return \Illuminate\View\View
	 */
	public function errorView()
	{
		$error = session('error', ['message' => '页面走丢了', 'code' => 404]);
		return view('admin.public.error', compact('error'));
	}
}
