<?php

namespace App\Models;

class Identity extends Base
{
    /**
     * 表名
     * 
     * @var string
     */
    protected $table = 'identity';

    /**
     * 允许批量赋值的字段
     * 
     * @var array
     */
    protected $fillable = ['name', 'description', 'menu_id'];

    /**
     * 关联角色表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'identity_role');
    }

    /**
     * 关联管理员表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\HasMany
     */
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    /**
     * 关联菜单表
     * 
     * @return \Illuminate\Database\Eloquent\Relstions\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
