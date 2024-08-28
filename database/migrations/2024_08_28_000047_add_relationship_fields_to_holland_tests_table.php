<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHollandTestsTable extends Migration
{
    public function up()
    {
        Schema::table('holland_tests', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10074183')->references('id')->on('users');
            $table->unsignedBigInteger('result_id')->nullable();
            $table->foreign('result_id', 'result_fk_9976205')->references('id')->on('result_assessments');
        });
    }
}
