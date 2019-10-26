<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPermissionsTable extends Migration
{
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedInteger('updated_by_id')->nullable();

            $table->foreign('updated_by_id', 'updated_by_fk_403974')->references('id')->on('users');
        });
    }
}
