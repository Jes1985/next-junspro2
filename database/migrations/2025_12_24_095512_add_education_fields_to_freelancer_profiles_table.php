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
            $table->string('university')->nullable()->after('certificate_files');
            $table->string('degree')->nullable()->after('university');
            $table->string('degree_type')->nullable()->after('degree');
            $table->string('specialization')->nullable()->after('degree_type');
            $table->integer('study_start_year')->nullable()->after('specialization');
            $table->integer('study_end_year')->nullable()->after('study_start_year');
            $table->boolean('no_degree')->default(false)->after('study_end_year');
            $table->json('diploma_files')->nullable()->after('no_degree');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'university',
                'degree',
                'degree_type',
                'specialization',
                'study_start_year',
                'study_end_year',
                'no_degree',
                'diploma_files',
            ]);
        });
    }
};
