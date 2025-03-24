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
            $table->string('validation_status')->default('pending')->after('is_draft');
            $table->text('validation_notes')->nullable()->after('validation_status');
            $table->timestamp('validated_at')->nullable()->after('validation_notes');
            $table->unsignedBigInteger('validated_by')->nullable()->after('validated_at');
            $table->foreign('validated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasi_mahasiswas', function (Blueprint $table) {
            $table->dropForeign(['validated_by']);
            $table->dropColumn(['validation_status', 'validation_notes', 'validated_at', 'validated_by']);
        });
    }
};
