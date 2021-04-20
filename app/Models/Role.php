<?php

namespace App\Models;

class Role extends Base
{
    /**
     * 表名
     * 
     * @var string
     */
    protected $table = 'role';

    /**
     * 允许批量赋值的字段
     * 
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * 关联身份表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsToMany
     */
    public function identities()
    {
        return $this->belongsToMany(Identity::class, 'identity_role');
    }

    /**
     * 关联菜单表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu');
    }
}
