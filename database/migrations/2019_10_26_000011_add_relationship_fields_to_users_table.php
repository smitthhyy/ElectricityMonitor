<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('updated_by_id')->nullable();

            $table->foreign('updated_by_id', 'updated_by_fk_403977')->references('id')->on('users');
        });
    }
}
