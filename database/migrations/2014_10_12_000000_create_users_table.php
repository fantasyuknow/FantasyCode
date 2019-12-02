<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键');
            $table->string('name')->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->bigInteger('phone')->default(0)->index()->comment('手机号');
            $table->string('github_name')->nullable()->comment('GitHub Name');
            $table->string('real_name')->nullable()->comment('真实姓名');
            $table->integer('image_id')->default(0)->comment('头像id');
            $table->string('introduction')->nullable()->comment('个人简介');
            $table->string('city')->nullable()->comment('城市');
            $table->string('hobby')->nullable()->comment('爱好');
            $table->string('signature')->nullable()->comment('署名');
            $table->tinyInteger('sex')->default(0)->comment('性别:0 保密，1 男，2 女');
            $table->integer('topic_count')->default(0)->comment('发表文章数量');
            $table->integer('reply_count')->default(0)->comment('回复数量');
            $table->integer('score')->default(0)->comment('个人积分');
            $table->integer('fans_count')->default(0)->comment('粉丝数');
            $table->integer('follow_count')->default(0)->comment('关注数');
            $table->integer('notification_count')->default(0)->comment('未读消息数');
            $table->string('company')->nullable()->comment('公司或组织名称');
            $table->string('job_title')->nullable()->comment('职位头衔');
            $table->string('per_web')->nullable()->comment('个人网站');
            $table->string('github_site',100)->nullable()->comment('github地址');
            $table->string('weibo_site',100)->nullable()->comment('微博链接');
            $table->string('wc_qrcode')->nullable()->comment('微信账号二维码');
            $table->string('pay_qrcode')->nullable()->comment('支付二维码');
            $table->tinyInteger('is_admin')->default(0)->index()->comment('管理员 1:是 0：否');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
