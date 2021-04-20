<?php

namespace App\Observers;

use DB;
use App\Models\Identity;

class IdentityObserver
{
    /**
     * Handle the identity "deleting" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function deleting(Identity $identity)
    {
        DB::beginTransaction();
    }

    /**
     * Handle the identity "deleted" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function deleted(Identity $identity)
    {
    	$identity->roles()->detach();
        DB::commit();
    }
}
