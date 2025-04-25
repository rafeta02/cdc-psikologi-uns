<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringMagangsTable extends Migration
{
    public function up()
    {
        Schema::create('monitoring_magangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pembimbing')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->longText('hasil')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
