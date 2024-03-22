<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_account', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->default('');
            $table->string('email_password')->default('');
            $table->string('account')->nullable();
            $table->string('password')->nullable();
            $table->integer('game_status')->default('0')->nullable();
            $table->integer('user_nums')->default('0')->nullable();
            $table->string('bind_email')->nullable();
            $table->dateTime('account_created')->nullable();
            $table->dateTime('user_created')->nullable();
            $table->integer('restriction_times')->default('0')->nullable();
            $table->dateTime('restriction_time')->nullable();
            $table->integer('blocked_times')->default('0')->nullable();
            $table->dateTime('blocked_time')->nullable();
            $table->integer('pc_id')->nullable();
            $table->integer('ip_id')->nullable();
            $table->dateTime('last_game_time')->nullable();
            $table->integer('plan')->nullable();
            $table->string('remark')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_account');
    }
}
