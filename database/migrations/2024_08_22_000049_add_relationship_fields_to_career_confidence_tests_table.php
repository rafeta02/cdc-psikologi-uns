<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCareerConfidenceTestsTable extends Migration
{
    public function up()
    {
        Schema::table('career_confidence_tests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9976465')->references('id')->on('users');
            $table->unsignedBigInteger('result_id')->nullable();
            $table->foreign('result_id', 'result_fk_9976466')->references('id')->on('result_assessments');
        });
    }
}
