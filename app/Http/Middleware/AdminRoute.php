<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Http\Response;
use App\Enums\MenuMethod;

class AdminRoute
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
        $key = MenuMethod::key($request->method());
        if (! verifyAccess($request->route()->uri, $key)) {
            return $this->error('你没有此操作权限', [], 403);
        }
        return $next($request);
    }
}
