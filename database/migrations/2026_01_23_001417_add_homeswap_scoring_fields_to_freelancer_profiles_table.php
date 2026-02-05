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
            // Vérifier si les colonnes n'existent pas déjà avant de les ajouter
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_housing_type')) {
                $table->string('homeswap_housing_type')->nullable()
                    ->comment('room|studio|apartment|house|villa|penthouse|other');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_bedrooms')) {
                $table->unsignedTinyInteger('homeswap_bedrooms')->nullable();
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_sleep_capacity')) {
                $table->unsignedTinyInteger('homeswap_sleep_capacity')->nullable()
                    ->comment('Nombre de couchages max');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_bathrooms')) {
                $table->unsignedTinyInteger('homeswap_bathrooms')->nullable();
            }
            
            // Extérieur (0/10 via features)
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_balcony')) {
                $table->boolean('homeswap_has_balcony')->default(false);
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_terrace')) {
                $table->boolean('homeswap_has_terrace')->default(false);
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_garden')) {
                $table->boolean('homeswap_has_garden')->default(false);
            }
            
            // Stationnement (0/5)
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_parking_type')) {
                $table->string('homeswap_parking_type')->nullable()
                    ->comment('none|street|private|garage');
            }
            
            // Piscine (0/5)
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_pool')) {
                $table->boolean('homeswap_has_pool')->default(false);
            }
            
            // Confort intérieur (0/25)
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_wifi')) {
                $table->boolean('homeswap_has_wifi')->default(false);
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_heating')) {
                $table->boolean('homeswap_has_heating')->default(false);
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_has_ac')) {
                $table->boolean('homeswap_has_ac')->default(false);
            }
            
            // Localisation déclarative (0-5 pts max)
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_near_transport')) {
                $table->boolean('homeswap_near_transport')->default(false)
                    ->comment('Transports à pied');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_near_shops')) {
                $table->boolean('homeswap_near_shops')->default(false)
                    ->comment('Commerces à pied');
            }
            if (!Schema::hasColumn('freelancer_profiles', 'homeswap_quiet_area')) {
                $table->boolean('homeswap_quiet_area')->default(false)
                    ->comment('Calme / résidentiel');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $columns = [
                'homeswap_housing_type',
                'homeswap_bedrooms',
                'homeswap_sleep_capacity',
                'homeswap_bathrooms',
                'homeswap_has_balcony',
                'homeswap_has_terrace',
                'homeswap_has_garden',
                'homeswap_parking_type',
                'homeswap_has_pool',
                'homeswap_has_wifi',
                'homeswap_has_heating',
                'homeswap_has_ac',
                'homeswap_near_transport',
                'homeswap_near_shops',
                'homeswap_quiet_area',
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('freelancer_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
