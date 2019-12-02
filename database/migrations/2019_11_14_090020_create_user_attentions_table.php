<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAttentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attentions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('f_uid')->index()->comment('粉丝uid');
            $table->integer('a_uid')->index()->comment('被关注人uid');
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
        Schema::dropIfExists('user_attentions');
    }
}
