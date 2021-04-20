<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Identity;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdentityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\Identity  $identity
     * @return mixed
     */
    public function delete(Admin $user, Identity $identity)
    {
        if ($identity->admins()->exists()) {
            return Response::deny('已有管理员绑定该身份,不可删除');
        }
        return true;
    }
}
