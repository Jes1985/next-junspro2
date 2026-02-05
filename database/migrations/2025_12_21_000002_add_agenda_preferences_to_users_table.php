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
        Schema::table('users', function (Blueprint $table) {
            // Format d'heure (24h ou 12h)
            if (!Schema::hasColumn('users', 'time_format')) {
                // Placer après timezone si elle existe, sinon après updated_at
                if (Schema::hasColumn('users', 'timezone')) {
                    $table->string('time_format', 10)->default('24h')->nullable()->after('timezone');
                } else {
                    $table->string('time_format', 10)->default('24h')->nullable()->after('updated_at');
                }
            }
            
            // Jour de début de semaine (monday ou sunday)
            if (!Schema::hasColumn('users', 'week_start')) {
                $table->string('week_start', 10)->default('monday')->nullable()->after('time_format');
            }
            
            // Vue par défaut de l'agenda (week ou month)
            if (!Schema::hasColumn('users', 'default_view')) {
                $table->string('default_view', 10)->default('week')->nullable()->after('week_start');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'time_format',
                'week_start',
                'default_view',
            ]);
        });
    }
};

