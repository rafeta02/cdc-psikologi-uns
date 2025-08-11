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
        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            // Drop the existing string column
            $table->dropColumn('dosen_pembimbing');
        });

        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            // Add the new foreign key column
            $table->unsignedBigInteger('dosen_pembimbing')->nullable()->after('no_wa');
            $table->foreign('dosen_pembimbing', 'dosen_pembimbing_fk_prestasi')->references('id')->on('dospems');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            // Drop the foreign key constraint and column
            $table->dropForeign('dosen_pembimbing_fk_prestasi');
            $table->dropColumn('dosen_pembimbing');
        });

        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            // Add back the original string column
            $table->string('dosen_pembimbing')->nullable()->after('no_wa');
        });
    }
};
