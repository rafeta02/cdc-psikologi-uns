<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestMagangsTable extends Migration
{
    public function up()
    {
        Schema::create('test_magangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('result')->nullable();
            $table->integer('q_1')->nullable();
            $table->string('q_2')->nullable();
            $table->integer('q_3')->nullable();
            $table->integer('q_4')->nullable();
            $table->integer('q_5')->nullable();
            $table->integer('q_6')->nullable();
            $table->integer('q_7')->nullable();
            $table->integer('q_8')->nullable();
            $table->integer('q_9')->nullable();
            $table->integer('q_10')->nullable();
            $table->integer('q_11')->nullable();
            $table->integer('q_12')->nullable();
            $table->integer('q_13')->nullable();
            $table->integer('q_14')->nullable();
            $table->integer('q_15')->nullable();
            $table->integer('q_16')->nullable();
            $table->integer('q_17')->nullable();
            $table->integer('q_18')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
