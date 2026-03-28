<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_enrollments', function (Blueprint $table) {
            $table->string('attestation_code_lvl3')->nullable()->after('attestation_code_lvl2');
            $table->timestamp('attestation_lvl3_issued_at')->nullable()->after('attestation_lvl2_issued_at');
        });
    }

    public function down(): void
    {
        Schema::table('formation_enrollments', function (Blueprint $table) {
            $table->dropColumn(['attestation_code_lvl3', 'attestation_lvl3_issued_at']);
        });
    }
};
