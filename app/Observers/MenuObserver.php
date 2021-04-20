<?php

namespace App\Observers;

use DB;
use App\Models\Menu;

class MenuObserver
{
    /**
     * Handle the menu "deleting" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function deleting(Menu $menu)
    {
        DB::beginTransaction();
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param  \App\Models\Menu  $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
    	$menu->roles()->detach();
        DB::commit();
    }
}
