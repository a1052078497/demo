<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->id()->comment('主键');
            $table->char('name', 10)->comment('名称');
            $table->char('route', 50)->nullable()->comment('路由');
            $table->unsignedTinyInteger('method')->nullable()->comment('请求方式');
            $table->char('icon', 20)->nullable()->comment('图标');
            $table->smallInteger('sequence')->default(0)->comment('顺序');
            $table->unsignedTinyInteger('is_show')->comment('是否显示');
            $table->unsignedTinyInteger('is_verify')->comment('是否验证');
            $table->unsignedBigInteger('parent_id')->comment('父级主键');
            $table->timestamp('created_at')->nullable()->comment('添加时间');
            $table->timestamp('updated_at')->nullable()->comment('编辑时间');
            $table->engine = 'InnoDB';
        });
        DB::statement("ALTER TABLE menu COMMENT '菜单表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
