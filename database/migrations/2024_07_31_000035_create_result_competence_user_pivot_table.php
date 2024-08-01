<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultCompetenceUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('result_competence_user', function (Blueprint $table) {
            $table->unsignedBigInteger('result_competence_id');
            $table->foreign('result_competence_id', 'result_competence_id_fk_9975799')->references('id')->on('result_competences')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9975799')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
