<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiMahasiswasTable extends Migration
{
    public function up()
    {
        Schema::create('prestasi_mahasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('skim');
            $table->string('tingkat');
            $table->string('nama_kegiatan');
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->string('jumlah_peserta');
            $table->string('perolehan_juara');
            $table->string('nama_penyelenggara');
            $table->string('tempat_penyelenggara');
            $table->string('keikutsertaan')->nullable();
            $table->string('url_publikasi')->nullable();
            $table->string('no_wa');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
