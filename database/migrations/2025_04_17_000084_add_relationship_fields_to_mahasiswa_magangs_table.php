<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMahasiswaMagangsTable extends Migration
{
    public function up()
    {
        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->foreign('mahasiswa_id', 'mahasiswa_fk_10536784')->references('id')->on('users');
            $table->unsignedBigInteger('magang_id')->nullable();
            $table->foreign('magang_id', 'magang_fk_10536790')->references('id')->on('magangs');
            $table->unsignedBigInteger('approved_by_id')->nullable();
            $table->foreign('approved_by_id', 'approved_by_fk_10536794')->references('id')->on('users');
            $table->unsignedBigInteger('verified_by_id')->nullable();
            $table->foreign('verified_by_id', 'verified_by_fk_10536809')->references('id')->on('users');
        });
    }
}
