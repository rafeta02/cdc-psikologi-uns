<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiMahasiswaDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('prestasi_mahasiswa_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim');
            $table->string('nama');
            $table->timestamps();
        });
    }
}
