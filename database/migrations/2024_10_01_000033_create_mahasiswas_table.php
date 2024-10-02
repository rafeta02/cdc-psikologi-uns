<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('jurusan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
