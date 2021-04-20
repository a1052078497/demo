<?php

use Illuminate\Database\Seeder;

use App\Models\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Admin::truncate();
        Admin::create(['username' => 'admin', 'password' => bcrypt(123), 'identity_id' => 0]);
    }
}
