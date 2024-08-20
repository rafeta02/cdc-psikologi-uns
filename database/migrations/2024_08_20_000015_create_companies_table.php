<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('scale')->nullable();
            $table->integer('number_of_employee')->nullable();
            $table->string('ownership')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
