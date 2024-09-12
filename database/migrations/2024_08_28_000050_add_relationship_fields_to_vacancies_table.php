<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVacanciesTable extends Migration
{
    public function up()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_9976909')->references('id')->on('companies');
            $table->unsignedBigInteger('experience_id')->nullable();
            $table->foreign('experience_id', 'experience_fk_10065359')->references('id')->on('experiences');
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id', 'position_fk_9976921')->references('id')->on('positions');
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id', 'industry_fk_9976922')->references('id')->on('industries');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_9976927')->references('id')->on('users');
        });
    }
}
