<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'universes')) {
                $table->json('universes')->nullable()->after('skills');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'domains')) {
                $table->json('domains')->nullable()->after('universes');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'can_online')) {
                $table->boolean('can_online')->default(true)->after('domains');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'can_onsite')) {
                $table->boolean('can_onsite')->default(false)->after('can_online');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'onsite_country')) {
                $table->string('onsite_country', 8)->nullable()->after('can_onsite');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'onsite_city')) {
                $table->string('onsite_city')->nullable()->after('onsite_country');
            }
        });
    }

    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $dropColumns = [];
            foreach (['universes', 'domains', 'can_online', 'can_onsite', 'onsite_country', 'onsite_city'] as $column) {
                if (Schema::hasColumn('freelancer_profiles', $column)) {
                    $dropColumns[] = $column;
                }
            }
            if (!empty($dropColumns)) {
                $table->dropColumn($dropColumns);
            }
        });
    }
};

