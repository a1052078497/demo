<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_role', function (Blueprint $table) {
            $table->unsignedBigInteger('identity_id')->comment('身份主键');
            $table->unsignedBigInteger('role_id')->comment('角色主键');
            $table->engine = 'InnoDB';
        });
        DB::statement("ALTER TABLE identity_role COMMENT '身份角色中间表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity_role');
    }
}
