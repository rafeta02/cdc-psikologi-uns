<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegencyVacancyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('regency_vacancy', function (Blueprint $table) {
            $table->unsignedBigInteger('vacancy_id');
            $table->foreign('vacancy_id', 'vacancy_id_fk_10106254')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedBigInteger('regency_id');
            $table->foreign('regency_id', 'regency_id_fk_10106254')->references('id')->on('regencies')->onDelete('cascade');
        });
    }
}
