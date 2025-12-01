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
            $table->boolean('is_freelancer')->default(false)->after('password');
            $table->boolean('is_client')->default(false)->after('is_freelancer');
            $table->boolean('is_verified_freelancer')->default(false)->after('is_client');
            $table->boolean('is_super_freelancer')->default(false)->after('is_verified_freelancer');
            $table->boolean('is_responsive')->default(false)->after('is_super_freelancer');

            $table->unsignedInteger('freelancer_score')->default(0)->after('is_responsive');

            $table->string('country_code', 3)->nullable()->after('freelancer_score');
            $table->string('timezone', 64)->nullable()->after('country_code');

            $table->json('languages')->nullable()->after('timezone');
            $table->json('availability')->nullable()->after('languages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'is_freelancer',
                'is_client',
                'is_verified_freelancer',
                'is_super_freelancer',
                'is_responsive',
                'freelancer_score',
                'country_code',
                'timezone',
                'languages',
                'availability',
            ]);
        });
    }
};


