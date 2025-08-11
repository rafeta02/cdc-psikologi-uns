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
            // Drop the existing string column
            $table->dropColumn('dosen_pembimbing');
        });

        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            // Add the new foreign key column
            $table->unsignedBigInteger('dosen_pembimbing')->nullable()->after('posttest_completed_at');
            $table->foreign('dosen_pembimbing', 'dosen_pembimbing_fk_magang')->references('id')->on('dospems');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            // Drop the foreign key constraint and column
            $table->dropForeign('dosen_pembimbing_fk_magang');
            $table->dropColumn('dosen_pembimbing');
        });

        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            // Add back the original string column
            $table->string('dosen_pembimbing')->nullable()->after('posttest_completed_at');
        });
    }
};
