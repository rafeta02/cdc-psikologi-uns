<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTracerAlumnusTable extends Migration
{
    public function up()
    {
        Schema::table('tracer_alumnus', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10065543')->references('id')->on('users');
            $table->unsignedBigInteger('kota_asal_id')->nullable();
            $table->foreign('kota_asal_id', 'kota_asal_fk_9968330')->references('id')->on('regencies');
            $table->unsignedBigInteger('kota_domisili_id')->nullable();
            $table->foreign('kota_domisili_id', 'kota_domisili_fk_9968331')->references('id')->on('regencies');
        });
    }
}
