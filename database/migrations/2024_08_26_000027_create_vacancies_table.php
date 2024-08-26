<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            $table->date('open_date')->nullable();
            $table->date('close_date')->nullable();
            $table->longText('persyaratan_umum')->nullable();
            $table->longText('persyaratan_khusus')->nullable();
            $table->longText('registration')->nullable();
            $table->longText('job_description')->nullable();
            $table->float('minimum_gpa', 4, 2)->nullable();
            $table->boolean('featured')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
