<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menu', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->comment('角色主键');
            $table->unsignedBigInteger('menu_id')->comment('菜单主键');
            $table->engine = 'InnoDB';
        });
        DB::statement("ALTER TABLE role_menu COMMENT '角色菜单中间表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menu');
    }
}
