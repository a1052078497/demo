<?php

namespace App\Models;

class Menu extends Base
{
    /**
     * 表名
     * 
     * @var string
     */
    protected $table = 'menu';

    /**
     * 允许批量赋值的字段
     * 
     * @var array
     */
    protected $fillable = ['name', 'route', 'method', 'icon', 'is_show', 'is_verify', 'parent_id'];

    /**
     * 获得所有后代
     * 
     * @return array
     */
    public function getDescendants($id = null)
    {
        static $menus = null;
        static $result = [];

        // 初始化所有菜单数据
        if (is_null($menus)) {
            $menus = $this->all(['id', 'parent_id']);
        }

        $id = $id ?: $this->id;

        $result[] = $id;
        foreach ($menus as $key => $menu) {
            if ($menu['parent_id'] == $id) {
                $menus->forget($key);
                $this->getDescendants($menu->id);
            }
        }

        return $result;
    }

    /**
     * 关联角色表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu');
    }

    /**
     * 关联身份表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\HasMany
     */
    public function identities()
    {
        return $this->hasMany(Identity::class, 'menu_id');
    }

    /**
     * 关联子级
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\HasMany
     */
    public function sons()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
