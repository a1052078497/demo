<?php

namespace App\Http\Controllers\Admin;

class HomeController extends BaseController
{
	/**
	 * 首页
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
        return view('admin.home.index');
	}
}
