<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangsTable extends Migration
{
    public function up()
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->date('open_date')->nullable();
            $table->boolean('close_date_exist')->default(0)->nullable();
            $table->date('close_date')->nullable();
            $table->longText('persyaratan')->nullable();
            $table->longText('registrasi')->nullable();
            $table->integer('needs')->nullable();
            $table->integer('filled')->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
