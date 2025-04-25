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
            $table->text('informasi_lomba')->nullable();
            $table->text('tips_trik')->nullable();
            $table->boolean('bersedia_mentoring')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['informasi_lomba', 'tips_trik', 'bersedia_mentoring']);
        });
    }
};
