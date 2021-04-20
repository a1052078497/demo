<?php

/**
 * 验证权限
 * 
 * @param  string  $route
 * @param  int     $method
 * @return void
 */
function verifyAccess($route, $method)
{
    return Auth::user()->hasPermission($route, $method);
}