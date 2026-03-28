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
        Schema::table('formation_enrollments', function (Blueprint $table) {
            // Niveau de certification atteint (1 = Éveil, 2 = Maître, null = pas encore)
            $table->tinyInteger('certification_level')->nullable()->default(null)->after('status');
            // Codes d'attestation distincts par niveau
            $table->string('attestation_code_lvl1')->nullable()->after('attestation_code');
            $table->string('attestation_code_lvl2')->nullable()->after('attestation_code_lvl1');
            // Timestamps d'émission par niveau
            $table->timestamp('attestation_lvl1_issued_at')->nullable()->after('attestation_issued_at');
            $table->timestamp('attestation_lvl2_issued_at')->nullable()->after('attestation_lvl1_issued_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formation_enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'certification_level',
                'attestation_code_lvl1',
                'attestation_code_lvl2',
                'attestation_lvl1_issued_at',
                'attestation_lvl2_issued_at',
            ]);
        });
    }
};
