<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->char('name', 20)->comment('名称');
            $table->char('description', 100)->nullable()->comment('描述');
            $table->unsignedBigInteger('menu_id')->comment('菜单主键 默认菜单');
            $table->timestamp('created_at')->nullable()->comment('添加时间');
            $table->timestamp('updated_at')->nullable()->comment('编辑时间');
            $table->engine = 'InnoDB';
        });
        DB::statement("ALTER TABLE identity COMMENT '身份表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('identity');
    }
}
