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
            if (!Schema::hasColumn('users', 'auto_confirm_enabled')) {
                // Vérifier quelle colonne utiliser comme référence
                if (Schema::hasColumn('users', 'timezone')) {
                    $table->boolean('auto_confirm_enabled')->default(true)->after('timezone');
                } elseif (Schema::hasColumn('users', 'updated_at')) {
                    $table->boolean('auto_confirm_enabled')->default(true)->after('updated_at');
                } else {
                    $table->boolean('auto_confirm_enabled')->default(true);
                }
            }
            if (!Schema::hasColumn('users', 'auto_confirm_delay_hours')) {
                $table->integer('auto_confirm_delay_hours')->default(48)->after('auto_confirm_enabled');
            }
            if (!Schema::hasColumn('users', 'reminder_before_hours')) {
                $table->integer('reminder_before_hours')->default(24)->nullable()->after('auto_confirm_delay_hours');
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
                'auto_confirm_enabled',
                'auto_confirm_delay_hours',
                'reminder_before_hours',
            ]);
        });
    }
};

