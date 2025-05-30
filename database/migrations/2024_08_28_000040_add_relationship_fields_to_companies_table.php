<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('regency_id')->nullable();
            $table->foreign('regency_id', 'regency_fk_10039974')->references('id')->on('regencies');
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->foreign('industry_id', 'industry_fk_9968128')->references('id')->on('industries');
        });
    }
}
