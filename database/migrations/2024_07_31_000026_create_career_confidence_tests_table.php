<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerConfidenceTestsTable extends Migration
{
    public function up()
    {
        Schema::create('career_confidence_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('r_1')->nullable();
            $table->integer('r_2')->nullable();
            $table->integer('r_3')->nullable();
            $table->integer('r_4')->nullable();
            $table->integer('i_1')->nullable();
            $table->integer('i_2')->nullable();
            $table->integer('i_3')->nullable();
            $table->integer('i_4')->nullable();
            $table->integer('a_1')->nullable();
            $table->integer('a_2')->nullable();
            $table->integer('a_3')->nullable();
            $table->integer('a_4')->nullable();
            $table->integer('s_1')->nullable();
            $table->integer('s_2')->nullable();
            $table->integer('s_3')->nullable();
            $table->integer('s_4')->nullable();
            $table->integer('e_1')->nullable();
            $table->integer('e_2')->nullable();
            $table->integer('e_3')->nullable();
            $table->integer('e_4')->nullable();
            $table->integer('c_1')->nullable();
            $table->integer('c_2')->nullable();
            $table->integer('c_3')->nullable();
            $table->integer('c_4')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
