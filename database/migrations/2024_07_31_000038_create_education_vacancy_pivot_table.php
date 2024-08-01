<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationVacancyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('education_vacancy', function (Blueprint $table) {
            $table->unsignedBigInteger('vacancy_id');
            $table->foreign('vacancy_id', 'vacancy_id_fk_9976918')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedBigInteger('education_id');
            $table->foreign('education_id', 'education_id_fk_9976918')->references('id')->on('educations')->onDelete('cascade');
        });
    }
}
