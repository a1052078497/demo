<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->char('username', 20)->comment('用户名');
            $table->char('password', 60)->comment('密码');
            $table->unsignedBigInteger('identity_id')->comment('身份主键');
            $table->timestamp('created_at')->nullable()->comment('添加时间');
            $table->timestamp('updated_at')->nullable()->comment('编辑时间');
            $table->engine = 'InnoDB';
        });
        DB::statement("ALTER TABLE admin comment '管理员表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
