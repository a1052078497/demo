<?php

namespace App\Http\Middleware;

use Auth;
use View;
use Closure;
use App\Http\Response;
use App\Enums\MenuMethod;

class AdminAuth
{
    use Response;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Auth::check()) {
            return $request->ajax() ? $this->error('请先登录后再进行操作', [], 401) : redirect(url('login?back=' . $request->getUri()));
        }
        // 分配菜单数据
        View::composer('admin.public.template', function ($view) {
            $allMenus = Auth::user()->getPermissions()->filter(function ($menu) {
                return $menu->method == MenuMethod::GET || ! $menu->route;
            });
            $asideMenus = $allMenus->filter(function ($menu) {
                return $menu->is_show && ! $menu->parent_id;
            })->each(function ($item) use ($allMenus) {
                $item->sons = $allMenus->where('parent_id', $item->id);
                // 组装最后一级菜单
                $item->sons = $item->sons->each(function ($item) use ($allMenus) {
                    $item->sons = $allMenus->where('parent_id', $item->id);
                });
            });
            $view->with(compact('allMenus', 'asideMenus'));
        });
        return $next($request);
    }
}
