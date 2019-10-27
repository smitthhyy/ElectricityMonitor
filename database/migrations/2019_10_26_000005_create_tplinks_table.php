<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTplinksTable extends Migration
{
    public function up()
    {
        Schema::create('tplinks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('mac')->unique();

            $table->integer('timestamp');

            $table->integer('voltage_mv')->nullable();

            $table->integer('current_ma')->nullable();

            $table->integer('power_mw')->nullable();

            $table->integer('total_wh')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
