<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVpnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vpn', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->ipAddress('IP');
            $table->string('password')->default('');
            $table->integer('port')->default('22');
            $table->integer('pc_id')->nullable();
            $table->string('remark')->nullable();
            $table->string('vmess')->nullable();
            $table->string('area')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_web')->nullable();
            $table->string('price')->nullable();
            $table->string('payment_cycle')->nullable();
            $table->string('expiration_date')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vpn');
    }
}
