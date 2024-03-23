<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('townlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('game_user_id');
            $table->string('level')->nullable();
            $table->string('fame')->nullable();
            $table->string('fatigue')->nullable();
            $table->dateTime('datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('townlogs');
    }
}
