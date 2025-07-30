<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDospemsTable extends Migration
{
    public function up()
    {
        Schema::create('dospems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('whatshapp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
