<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrestasiMahasiswaDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('prestasi_mahasiswa_details', function (Blueprint $table) {
            $table->unsignedBigInteger('prestasi_mahasiswa_id')->nullable();
            $table->foreign('prestasi_mahasiswa_id', 'prestasi_mahasiswa_fk_9970529')->references('id')->on('prestasi_mahasiswas');
        });
    }
}
