<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetenceResultCompetencePivotTable extends Migration
{
    public function up()
    {
        Schema::create('competence_result_competence', function (Blueprint $table) {
            $table->unsignedBigInteger('result_competence_id');
            $table->foreign('result_competence_id', 'result_competence_id_fk_9975800')->references('id')->on('result_competences')->onDelete('cascade');
            $table->unsignedBigInteger('competence_id');
            $table->foreign('competence_id', 'competence_id_fk_9975800')->references('id')->on('competences')->onDelete('cascade');
        });
    }
}
