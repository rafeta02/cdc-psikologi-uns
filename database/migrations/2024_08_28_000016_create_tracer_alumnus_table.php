<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracerAlumnusTable extends Migration
{
    public function up()
    {
        Schema::create('tracer_alumnus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim');
            $table->string('nama');
            $table->string('telephone');
            $table->string('email');
            $table->string('angkatan');
            $table->string('partisipasi')->nullable();
            $table->string('kesibukan')->nullable();
            $table->string('nama_instansi')->nullable();
            $table->string('jabatan_instansi')->nullable();
            $table->string('pendapatan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
