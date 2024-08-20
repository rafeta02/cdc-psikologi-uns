<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHollandTestsTable extends Migration
{
    public function up()
    {
        Schema::create('holland_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('r_1')->nullable();
            $table->integer('r_2')->nullable();
            $table->integer('r_3')->nullable();
            $table->integer('r_4')->nullable();
            $table->integer('r_5')->nullable();
            $table->integer('r_6')->nullable();
            $table->integer('r_7')->nullable();
            $table->integer('r_8')->nullable();
            $table->integer('i_1')->nullable();
            $table->integer('i_2')->nullable();
            $table->integer('i_3')->nullable();
            $table->integer('i_4')->nullable();
            $table->integer('i_5')->nullable();
            $table->integer('i_6')->nullable();
            $table->integer('i_7')->nullable();
            $table->integer('i_8')->nullable();
            $table->integer('a_1')->nullable();
            $table->integer('a_2')->nullable();
            $table->integer('a_3')->nullable();
            $table->integer('a_4')->nullable();
            $table->integer('a_5')->nullable();
            $table->integer('a_6')->nullable();
            $table->integer('a_7')->nullable();
            $table->integer('a_8')->nullable();
            $table->integer('s_1')->nullable();
            $table->integer('s_2')->nullable();
            $table->integer('s_3')->nullable();
            $table->integer('s_4')->nullable();
            $table->integer('s_5')->nullable();
            $table->integer('s_6')->nullable();
            $table->integer('s_7')->nullable();
            $table->integer('s_8')->nullable();
            $table->integer('e_1')->nullable();
            $table->integer('e_2')->nullable();
            $table->integer('e_3')->nullable();
            $table->integer('e_4')->nullable();
            $table->integer('e_5')->nullable();
            $table->integer('e_6')->nullable();
            $table->integer('e_7')->nullable();
            $table->integer('e_8')->nullable();
            $table->integer('c_1')->nullable();
            $table->integer('c_2')->nullable();
            $table->integer('c_3')->nullable();
            $table->integer('c_4')->nullable();
            $table->integer('c_5')->nullable();
            $table->integer('c_6')->nullable();
            $table->integer('c_7')->nullable();
            $table->integer('c_8')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
