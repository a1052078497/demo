<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Admin extends Auth
{
    /**
     * 表名
     * 
     * @var string
     */
    protected $table = 'admin';

    /**
     * 允许批量赋值的字段
     * 
     * @var array
     */
    protected $fillable = ['username', 'password', 'identity_id'];

    /**
     * 所有权限
     * 
     * @var \Illuminate\Support\Collection
     */
    private $permissions;

    /**
     * 简单的权限
     * 
     * @var \Illuminate\Support\Collection
     */
    private $simplePermissions;

    /**
     * 判断是否有指定权限
     * 
     * @param  string  $route
     * @param  int     $method
     * @return bool
     */
    public function hasPermission(string $route, $method)
    {
        if ($this->isSuper()) {
            return true;
        }

        $route = preg_replace('/\{[\S\s]+\}/', '*', $route);
        return $this->getSimplePermissions()->contains($route . $method);
    }

    /**
     * 获得权限
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPermissions()
    {
        if (is_null($this->permissions)) {
            if ($this->isSuper()) {
                $this->permissions = Menu::latest('sequence')->get(['id', 'name', 'icon', 'route', 'method', 'is_show', 'parent_id']);
            } else {
                $this->identity->load('roles.menus');

                // 合并不需验证的
                $notVerifyMenus = Menu::latest('sequence')->where('is_verify', 0)
                    ->get(['id', 'name', 'icon', 'route', 'method', 'is_show', 'parent_id']);
                $this->permissions = $this->identity->roles
                    ->pluck('menus')
                    ->flatten()
                    ->merge($notVerifyMenus)
                    ->unique(function ($item) {
                        return $item->route . $item->method ?: $item->name;
                    });
            }
        }

        return $this->permissions;
    }

    /**
     * 获得简单的权限
     * 
     * @return \Illuminate\Support\Collection
     */
    private function getSimplePermissions()
    {
        if (is_null($this->simplePermissions)) {
            // 获得对应权限后查询是否有权限
            $permissions = $this->getPermissions();
            $this->simplePermissions = $permissions->map(function ($item) {
                return $item->route . $item->method;
            });
        }
        return $this->simplePermissions;
    }

    /**
     * 判断是否为超级管理员
     * 
     * @return bool
     */
    public function isSuper()
    {
        return $this->id == 1;
    }

    /**
     * 筛选普通用户
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeOrdinary(Builder $query)
    {
        $query->where('id', '>', 1);
    }

    /**
     * 关联身份表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
