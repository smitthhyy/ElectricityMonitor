<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTplinkDevicesTable extends Migration
{
    public function up()
    {
        Schema::create('tplink_devices', function (Blueprint $table) {
            $table->increments('id');

            $table->string('mac')->unique();

            $table->string('alias')->nullable();

            $table->string('ip')->nullable();

            $table->integer('port')->nullable();

            $table->string('online')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
