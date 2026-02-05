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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            // Champs de données du logement
            $table->string('homeswap_property_type')->nullable()->after('bank_account_holder')
                ->comment('room|studio|apartment|house|villa|penthouse');
            $table->unsignedTinyInteger('homeswap_bedrooms')->nullable()->after('homeswap_property_type');
            $table->unsignedTinyInteger('homeswap_beds_real')->nullable()->after('homeswap_bedrooms');
            $table->unsignedTinyInteger('homeswap_beds_extra')->nullable()->after('homeswap_beds_real');
            $table->string('homeswap_outdoor')->nullable()->after('homeswap_beds_extra')
                ->comment('none|balcony|terrace|garden|terrace_garden');
            $table->string('homeswap_parking')->nullable()->after('homeswap_outdoor')
                ->comment('none|nearby_easy|private_spot|garage');
            $table->string('homeswap_pool')->nullable()->after('homeswap_parking')
                ->comment('none|shared|private|private_heated');
            $table->string('homeswap_wifi_quality')->nullable()->after('homeswap_pool')
                ->comment('basic|good|excellent');
            $table->unsignedSmallInteger('homeswap_wifi_mbps')->nullable()->after('homeswap_wifi_quality');
            $table->string('homeswap_climate')->nullable()->after('homeswap_wifi_mbps')
                ->comment('temperate|heating|ac|both');
            $table->unsignedTinyInteger('homeswap_bathrooms')->nullable()->after('homeswap_climate');
            
            // Champs calculés (persistés pour performance et tri)
            $table->unsignedTinyInteger('homeswap_score')->nullable()->after('homeswap_bathrooms')
                ->comment('Score 0-100 calculé automatiquement');
            $table->unsignedSmallInteger('homeswap_points_per_night')->nullable()->after('homeswap_score')
                ->comment('Points/nuit estimés 25-100');
            
            // Index pour performance (non bloquants)
            $table->index('homeswap_score', 'idx_homeswap_score');
            $table->index('homeswap_points_per_night', 'idx_homeswap_points_per_night');
            $table->index('homeswap_property_type', 'idx_homeswap_property_type');
            $table->index('homeswap_bedrooms', 'idx_homeswap_bedrooms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropIndex('idx_homeswap_score');
            $table->dropIndex('idx_homeswap_points_per_night');
            $table->dropIndex('idx_homeswap_property_type');
            $table->dropIndex('idx_homeswap_bedrooms');
            
            $table->dropColumn([
                'homeswap_property_type',
                'homeswap_bedrooms',
                'homeswap_beds_real',
                'homeswap_beds_extra',
                'homeswap_outdoor',
                'homeswap_parking',
                'homeswap_pool',
                'homeswap_wifi_quality',
                'homeswap_wifi_mbps',
                'homeswap_climate',
                'homeswap_bathrooms',
                'homeswap_score',
                'homeswap_points_per_night',
            ]);
        });
    }
};
