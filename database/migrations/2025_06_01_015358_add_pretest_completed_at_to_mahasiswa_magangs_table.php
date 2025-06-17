<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            $table->timestamp('pretest_completed_at')->nullable()->after('pretest');
            $table->timestamp('posttest_completed_at')->nullable()->after('posttest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            $table->dropColumn(['pretest_completed_at', 'posttest_completed_at']);
        });
    }
};
