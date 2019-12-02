<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTopicOperateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_topic_operate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('o_type')->index()->comment('类别 0:点赞 1:收藏');
            $table->integer('topic_id')->index()->comment('文章id');
            $table->integer('user_id')->index()->comment('用户id');
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
        Schema::dropIfExists('user_topic_operate');
    }
}
