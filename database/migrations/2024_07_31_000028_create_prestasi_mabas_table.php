<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiMabasTable extends Migration
{
    public function up()
    {
        Schema::create('prestasi_mabas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tingkat');
            $table->string('nama_kegiatan');
            $table->date('tanggal_awal')->nullable();
            $table->date('tanggal_akhir')->nullable();
            $table->string('jumlah_peserta');
            $table->string('perolehan_juara');
            $table->string('nama_penyelenggara');
            $table->string('tempat_penyelenggara');
            $table->string('keikutsertaan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
