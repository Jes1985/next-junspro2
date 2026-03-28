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
            if (!Schema::hasColumn('freelancer_profiles', 'mentor_domains')) {
                $table->json('mentor_domains')->nullable()->after('mentor_quality_score');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_bio')) {
                $table->text('mentor_bio')->nullable()->after('mentor_domains');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_motivation')) {
                $table->text('mentor_motivation')->nullable()->after('mentor_bio');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_years_experience')) {
                $table->unsignedSmallInteger('mentor_years_experience')->nullable()->after('mentor_motivation');
            }

            if (!Schema::hasColumn('freelancer_profiles', 'mentor_linkedin_url')) {
                $table->string('mentor_linkedin_url', 500)->nullable()->after('mentor_years_experience');
            }

            // Taux de compensation du mentor sur les projets co-réalisés
            // null = taux calculé automatiquement par MentorCompensationService
            if (!Schema::hasColumn('freelancer_profiles', 'mentor_rate_override')) {
                $table->unsignedTinyInteger('mentor_rate_override')->nullable()->after('mentor_linkedin_url');
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
                'mentor_domains',
                'mentor_bio',
                'mentor_motivation',
                'mentor_years_experience',
                'mentor_linkedin_url',
                'mentor_rate_override',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('freelancer_profiles', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
