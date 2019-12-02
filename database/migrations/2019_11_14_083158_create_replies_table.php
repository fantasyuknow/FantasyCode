<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('topic_id')->unsigned()->default(0)->comment('文章id');
            $table->integer('user_id')->unsigned()->default(0)->comment('评论用户id');
            $table->boolean('type')->default(1)->comment('1：文章评论 2:回复评论');
            $table->integer('pid')->unsigned()->default(0)->comment('父级id');
            $table->text('body')->comment('内容');
            $table->tinyInteger('verify')->default(0)->comment('审核 0：待审核，1:通过，2:不通过');
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
        Schema::dropIfExists('replies');
    }
}
