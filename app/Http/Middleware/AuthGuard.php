<?php

namespace App\Http\Middleware;

use Closure;

class AuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, string $guard)
    {
        // 设置用户组
        config([
            'auth.defaults.guard' => $guard
        ]);
        return $next($request);
    }
}
