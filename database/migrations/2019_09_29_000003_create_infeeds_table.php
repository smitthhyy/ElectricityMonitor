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

            $table->integer('phase_1');

            $table->integer('phase_2')->nullable();

            $table->integer('phase_3')->nullable();

            $table->integer('total');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
