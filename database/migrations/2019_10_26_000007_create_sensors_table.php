<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();

            $table->integer('id_field');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
