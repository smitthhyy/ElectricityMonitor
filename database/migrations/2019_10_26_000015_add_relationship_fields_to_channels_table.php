<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChannelsTable extends Migration
{
    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->unsignedInteger('sensor_id');

            $table->foreign('sensor_id', 'sensor_fk_520384')->references('id')->on('sensors');
        });
    }
}
