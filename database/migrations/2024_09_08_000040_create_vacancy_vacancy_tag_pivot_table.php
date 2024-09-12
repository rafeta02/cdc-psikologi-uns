<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacancyVacancyTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('vacancy_vacancy_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('vacancy_id');
            $table->foreign('vacancy_id', 'vacancy_id_fk_10106453')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedBigInteger('vacancy_tag_id');
            $table->foreign('vacancy_tag_id', 'vacancy_tag_id_fk_10106453')->references('id')->on('vacancy_tags')->onDelete('cascade');
        });
    }
}
