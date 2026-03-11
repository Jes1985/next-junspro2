<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->text('intro_text_en')->nullable()->after('intro_text');
            $table->json('activities_en')->nullable()->after('activities');
            $table->string('audio_path_en')->nullable()->after('audio_path');
        });
    }

    public function down(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'description_en', 'intro_text_en', 'activities_en', 'audio_path_en']);
        });
    }
};
