<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('分类主键id');
            $table->string('name')->index()->comment('分类名称');
            $table->string('description')->nullable()->comment('描述');
            $table->integer('topic_count')->default(0)->comment('文章数');
            $table->tinyInteger('cascade')->default(0)->index()->comment('归类=> 0:顶级分类');
            $table->integer('user_id')->unsigned()->index()->comment('用户id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
