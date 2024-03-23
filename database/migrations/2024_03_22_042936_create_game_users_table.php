<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pc_id')->nullable();
            $table->integer('ip_id')->nullable();
            $table->integer('account_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('character_base')->nullable();
            $table->integer('character_class')->nullable();
            $table->integer('level')->nullable();
            $table->integer('fame')->nullable();
            $table->integer('clear_dungeon_times')->nullable();
            $table->dateTime('last_online_time')->nullable();
            $table->dateTime('created_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_users');
    }
}
