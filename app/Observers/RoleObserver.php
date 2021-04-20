<?php

namespace App\Observers;

use DB;
use App\Models\Role;

class RoleObserver
{
    /**
     * Handle the role "deleting" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleting(Role $role)
    {
        DB::beginTransaction();
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param  \App\Models\Role  $role
     * @return void
     */
    public function deleted(Role $role)
    {
        $role->menus()->detach();
    	$role->identities()->detach();
        DB::commit();
    }
}
