<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'bank_country')) {
                $table->string('bank_country', 2)->nullable();
            }
            if (!Schema::hasColumn('freelancer_profiles', 'bank_routing')) {
                $table->string('bank_routing', 60)->nullable();
            }
            if (!Schema::hasColumn('freelancer_profiles', 'bank_type')) {
                $table->string('bank_type', 20)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn(['bank_country', 'bank_routing', 'bank_type']);
        });
    }
};
