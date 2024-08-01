<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRegenciesTable extends Migration
{
    public function up()
    {
        Schema::table('regencies', function (Blueprint $table) {
            $table->unsignedBigInteger('province_id')->nullable();
            $table->foreign('province_id', 'province_fk_9968113')->references('id')->on('provinces');
        });
    }
}
