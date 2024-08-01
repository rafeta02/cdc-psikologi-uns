<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultAssessmentsTable extends Migration
{
    public function up()
    {
        Schema::create('result_assessments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('initial')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('field')->nullable();
            $table->string('test_name');
            $table->string('result_text')->nullable();
            $table->longText('result_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
