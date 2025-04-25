<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaMagangsTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa_magangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim')->nullable();
            $table->string('nama')->nullable();
            $table->integer('semester')->nullable();
            $table->string('type')->nullable();
            $table->string('bidang')->nullable();
            $table->string('instansi')->nullable();
            $table->longText('alamat_instansi')->nullable();
            $table->string('approve')->nullable();
            $table->boolean('pretest')->default(0)->nullable();
            $table->boolean('posttest')->default(0)->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->string('verified')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
