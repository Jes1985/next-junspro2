<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->string('audio_path')->nullable()->after('activities');
            $table->text('intro_text')->nullable()->after('audio_path');
        });
    }

    public function down(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->dropColumn(['audio_path', 'intro_text']);
        });
    }
};
