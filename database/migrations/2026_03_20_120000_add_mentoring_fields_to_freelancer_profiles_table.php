<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('freelancer_profiles')) {
            return;
        }

        Schema::table('freelancer_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('freelancer_profiles', 'is_mentor')) {
                $table->boolean('is_mentor')->default(false)->after('is_verified');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_capacity')) {
                $table->unsignedTinyInteger('mentor_capacity')->default(1)->after('is_mentor');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_status')) {
                $table->enum('mentor_status', ['inactive', 'pending', 'active', 'paused'])->default('inactive')->after('mentor_capacity');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_quality_score')) {
                $table->unsignedTinyInteger('mentor_quality_score')->default(0)->after('mentor_status');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('freelancer_profiles')) {
            return;
        }

        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $columns = [
                'is_mentor',
                'mentor_capacity',
                'mentor_status',
                'mentor_quality_score',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('freelancer_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
