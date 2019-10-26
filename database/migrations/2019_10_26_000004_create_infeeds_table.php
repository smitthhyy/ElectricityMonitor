<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfeedsTable extends Migration
{
    public function up()
    {
        Schema::create('infeeds', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('timestamp');

            $table->integer('ch_1')->nullable();

            $table->integer('ch_2')->nullable();

            $table->integer('ch_3')->nullable();

            $table->integer('sensor');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
