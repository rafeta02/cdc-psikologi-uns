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
            $table->text('verification_notes')->nullable();
            $table->text('approval_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_magangs', function (Blueprint $table) {
            $table->dropColumn('verification_notes');
            $table->dropColumn('approval_notes');
        });
    }
};
