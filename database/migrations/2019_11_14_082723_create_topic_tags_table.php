<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topic_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('topic_id')->unsigned()->index()->comment('文章id');
            $table->integer('tag_id')->unsigned()->index()->comment('标签id');
            $table->integer('user_id')->unsigned()->index()->comment('用户id, 对应article->user_id');
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
        Schema::dropIfExists('topic_tags');
    }
}
