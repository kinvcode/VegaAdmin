<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleanDungeonLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clean_dungeon_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('game_user_id');
            $table->dateTime('entry_time')->nullable();
            $table->dateTime('clearance_time');
            $table->integer('time_cost')->nullable();
            $table->integer('start_gold')->nullable();
            $table->integer('end_gold')->nullable();
            $table->integer('gold_reward')->nullable();
            $table->integer('start_equipments')->nullable();
            $table->integer('end_equipments')->nullable();
            $table->integer('equipment_reward')->nullable();
            $table->integer('dungeon_id')->nullable();
            $table->integer('level')->nullable();
            $table->integer('fame')->nullable();
            $table->integer('fatigue')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clean_dungeon_logs');
    }
}
