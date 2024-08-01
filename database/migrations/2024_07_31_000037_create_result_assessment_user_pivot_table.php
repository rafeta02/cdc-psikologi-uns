<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultAssessmentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('result_assessment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('result_assessment_id');
            $table->foreign('result_assessment_id', 'result_assessment_id_fk_9975807')->references('id')->on('result_assessments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_9975807')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
