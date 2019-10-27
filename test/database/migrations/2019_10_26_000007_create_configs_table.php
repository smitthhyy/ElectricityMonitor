<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();

            $table->string('value')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
