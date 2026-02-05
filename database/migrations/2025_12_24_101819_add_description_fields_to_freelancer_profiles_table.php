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
            $table->string('profile_title')->nullable()->after('bio');
            $table->text('introduction')->nullable()->after('profile_title');
            $table->text('experience')->nullable()->after('introduction');
            $table->text('motivation')->nullable()->after('experience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'profile_title',
                'introduction',
                'experience',
                'motivation',
            ]);
        });
    }
};
