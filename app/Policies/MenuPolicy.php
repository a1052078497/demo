<?php

namespace App\Policies;

use Request;
use App\Models\Menu;
use App\Models\Admin;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function update(Admin $user, Menu $menu)
    {
        $descendants = $menu->getDescendants();
        $parentKey = Request::post('parent_id');
        if (in_array($parentKey, $descendants)) {
            return Response::deny('所属上级不能为当前菜单的后代');
        }
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Menu  $menu
     * @return mixed
     */
    public function delete(Admin $user, Menu $menu)
    {
        if ($menu->sons()->exists()) {
            return Response::deny('该菜单下还有子级,不可删除');
        } elseif ($menu->identities()->exists()) {
            return Response::deny('已有身份绑定该菜单,不可删除');
        }
        return true;
    }
}
