<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('category_id')->unsigned()->default(0)->index()->comment('分类id');
            $table->bigInteger('user_id')->unsigned()->default(0)->index()->comment('作者ID');
            $table->string('title')->default('')->index()->comment('标题');
            $table->text('excerpt')->nullable()->comment('文章摘要');
            $table->string('slug')->nullable()->comment('SEO友好的 URI');
            $table->mediumText('body')->comment('内容');
            $table->tinyInteger('w_type')->default(0)->comment('文章类型： 0:无图，1:单图，2:大图');
            $table->integer('image_id')->default(0)->comment('封面图ID');
            $table->integer('view_count')->unsigned()->default(0)->comment('浏览量');
            $table->integer('reply_count')->unsigned()->default(0)->comment('回复数');
            $table->integer('vote_count')->unsigned()->default(0)->comment('喜欢总数-赞');
            $table->integer('collect_count')->unsigned()->default(0)->comment('收藏数');
            $table->integer('order')->unsigned()->default(0)->comment('可用来做排序使用');
            $table->boolean('is_top')->default(0)->index()->comment('是否置顶 1是 0否');
            $table->tinyInteger('is_reply')->default(0)->index()->comment('评论: 0 开启且无需审核，1:开启需审核,2:关闭');
            $table->tinyInteger('is_secret')->default(0)->index()->comment('私密: 0:全部可见，1:仅自己可见,2:仅关注我的人可见');
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
        Schema::dropIfExists('topics');
    }
}
