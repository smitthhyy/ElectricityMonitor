<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTplinksTable extends Migration
{
    public function up()
    {
        Schema::table('tplinks', function (Blueprint $table) {
            $table->unsignedInteger('updated_by_id')->nullable();

            $table->foreign('updated_by_id', 'updated_by_fk_404000')->references('id')->on('users');
        });
    }
}
