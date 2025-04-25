<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMonitoringMagangsTable extends Migration
{
    public function up()
    {
        Schema::table('monitoring_magangs', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreign('mahasiswa_id', 'mahasiswa_fk_10541835')->references('id')->on('users');
            $table->unsignedBigInteger('magang_id')->nullable();
            $table->foreign('magang_id', 'magang_fk_10541836')->references('id')->on('mahasiswa_magangs');
        });
    }
}
