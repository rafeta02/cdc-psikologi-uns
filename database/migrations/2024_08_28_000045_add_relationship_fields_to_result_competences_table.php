<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToResultCompetencesTable extends Migration
{
    public function up()
    {
        Schema::table('result_competences', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10073346')->references('id')->on('users');
            $table->unsignedBigInteger('competence_id')->nullable();
            $table->foreign('competence_id', 'competence_fk_10073347')->references('id')->on('competences');
        });
    }
}
