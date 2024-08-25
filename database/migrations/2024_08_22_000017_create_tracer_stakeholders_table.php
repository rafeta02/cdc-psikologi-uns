<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracerStakeholdersTable extends Migration
{
    public function up()
    {
        Schema::create('tracer_stakeholders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nama_instansi');
            $table->string('nama_alumni');
            $table->integer('tahun_lulus');
            $table->integer('waktu_tunggu');
            $table->string('tingkat_instansi')->nullable();
            $table->string('kesesuaian_bidang')->nullable();
            $table->string('kompetensi_integritas')->nullable();
            $table->string('kompetensi_profesionalisme')->nullable();
            $table->string('kompetensi_inggris')->nullable();
            $table->string('kompetensi_it')->nullable();
            $table->string('kompetensi_komunikasi')->nullable();
            $table->string('kompetensi_kerjasama')->nullable();
            $table->string('kompetensi_pengembangan')->nullable();
            $table->longText('kepuasan_alumni')->nullable();
            $table->longText('saran')->nullable();
            $table->string('ketersediaan_campus_hiring')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
