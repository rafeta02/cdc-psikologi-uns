<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkReadinessTestsTable extends Migration
{
    public function up()
    {
        Schema::create('work_readiness_tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cbs_1')->nullable();
            $table->integer('cbs_2')->nullable();
            $table->integer('cbs_3')->nullable();
            $table->integer('cbs_4')->nullable();
            $table->integer('cbs_5')->nullable();
            $table->integer('cbs_6')->nullable();
            $table->integer('cbs_7')->nullable();
            $table->integer('cbs_8')->nullable();
            $table->integer('cbs_9')->nullable();
            $table->integer('cbs_10')->nullable();
            $table->integer('cms_1')->nullable();
            $table->integer('cms_2')->nullable();
            $table->integer('cms_3')->nullable();
            $table->integer('cms_4')->nullable();
            $table->integer('cs_1')->nullable();
            $table->integer('cs_2')->nullable();
            $table->integer('cs_3')->nullable();
            $table->integer('cs_4')->nullable();
            $table->integer('cs_5')->nullable();
            $table->integer('cs_6')->nullable();
            $table->integer('cs_7')->nullable();
            $table->integer('cs_8')->nullable();
            $table->integer('cs_9')->nullable();
            $table->integer('fs_1')->nullable();
            $table->integer('fs_2')->nullable();
            $table->integer('fs_3')->nullable();
            $table->integer('ics_1')->nullable();
            $table->integer('ics_2')->nullable();
            $table->integer('ics_3')->nullable();
            $table->integer('ics_4')->nullable();
            $table->integer('ics_5')->nullable();
            $table->integer('its_1')->nullable();
            $table->integer('its_2')->nullable();
            $table->integer('its_3')->nullable();
            $table->integer('ls_1')->nullable();
            $table->integer('ls_2')->nullable();
            $table->integer('ls_3')->nullable();
            $table->integer('ls_4')->nullable();
            $table->integer('ls_5')->nullable();
            $table->integer('sms_1')->nullable();
            $table->integer('sms_3')->nullable();
            $table->integer('sms_4')->nullable();
            $table->integer('sms_5')->nullable();
            $table->integer('sms_7')->nullable();
            $table->integer('sms_9')->nullable();
            $table->integer('sts_1')->nullable();
            $table->integer('sts_2')->nullable();
            $table->integer('sts_3')->nullable();
            $table->integer('sts_4')->nullable();
            $table->integer('tps_2')->nullable();
            $table->integer('tps_4')->nullable();
            $table->integer('tps_5')->nullable();
            $table->integer('tps_6')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
