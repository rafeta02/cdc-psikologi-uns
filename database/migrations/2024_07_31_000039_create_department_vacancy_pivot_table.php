<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentVacancyPivotTable extends Migration
{
    public function up()
    {
        Schema::create('department_vacancy', function (Blueprint $table) {
            $table->unsignedBigInteger('vacancy_id');
            $table->foreign('vacancy_id', 'vacancy_id_fk_9976919')->references('id')->on('vacancies')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_id_fk_9976919')->references('id')->on('departments')->onDelete('cascade');
        });
    }
}
