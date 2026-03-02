<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'timezone')) {
                $table->string('timezone', 64)->nullable()->default('Europe/Paris');
            }
            if (!Schema::hasColumn('users', 'time_format')) {
                $table->string('time_format', 10)->nullable()->default('24h');
            }
            if (!Schema::hasColumn('users', 'week_start')) {
                $table->string('week_start', 10)->nullable()->default('monday');
            }
            if (!Schema::hasColumn('users', 'default_view')) {
                $table->string('default_view', 10)->nullable()->default('week');
            }
            if (!Schema::hasColumn('users', 'auto_confirm_enabled')) {
                $table->boolean('auto_confirm_enabled')->default(true);
            }
            if (!Schema::hasColumn('users', 'auto_confirm_delay_hours')) {
                $table->unsignedInteger('auto_confirm_delay_hours')->default(48);
            }
            if (!Schema::hasColumn('users', 'reminder_before_hours')) {
                $table->unsignedInteger('reminder_before_hours')->default(24);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $cols = ['timezone','time_format','week_start','default_view',
                     'auto_confirm_enabled','auto_confirm_delay_hours','reminder_before_hours'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
