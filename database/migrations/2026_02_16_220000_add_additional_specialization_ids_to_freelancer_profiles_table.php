<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'additional_specialization_ids')) {
                $table->json('additional_specialization_ids')->nullable()->after('specialization');
            }
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('freelancer_profiles', 'additional_specialization_ids')) {
                $table->dropColumn('additional_specialization_ids');
            }
        });
    }
};
