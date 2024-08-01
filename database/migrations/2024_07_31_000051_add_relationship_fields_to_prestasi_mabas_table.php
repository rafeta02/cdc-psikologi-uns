<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrestasiMabasTable extends Migration
{
    public function up()
    {
        Schema::table('prestasi_mabas', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->foreign('kategori_id', 'kategori_fk_9976957')->references('id')->on('kategori_prestasis');
        });
    }
}
