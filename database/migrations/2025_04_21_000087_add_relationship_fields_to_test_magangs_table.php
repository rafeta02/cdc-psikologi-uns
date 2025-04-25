<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTestMagangsTable extends Migration
{
    public function up()
    {
        Schema::table('test_magangs', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreign('mahasiswa_id', 'mahasiswa_fk_10541659')->references('id')->on('users');
            $table->unsignedBigInteger('magang_id')->nullable();
            $table->foreign('magang_id', 'magang_fk_10541660')->references('id')->on('mahasiswa_magangs');
        });
    }
}
