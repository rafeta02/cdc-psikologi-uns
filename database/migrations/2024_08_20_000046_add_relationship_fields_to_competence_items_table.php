<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompetenceItemsTable extends Migration
{
    public function up()
    {
        Schema::table('competence_items', function (Blueprint $table) {
            $table->unsignedBigInteger('competence_id')->nullable();
            $table->foreign('competence_id', 'competence_fk_9973433')->references('id')->on('competences');
        });
    }
}
