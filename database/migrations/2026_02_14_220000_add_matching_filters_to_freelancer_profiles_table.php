<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'matching_filters')) {
                $table->json('matching_filters')->nullable()->after('onsite_city');
            }
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('freelancer_profiles', 'matching_filters')) {
                $table->dropColumn('matching_filters');
            }
        });
    }
};

