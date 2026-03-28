<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ps_ambassadeurs', function (Blueprint $table) {
            // Nouveaux champs collectés au moment de l'inscription
            $table->string('phone', 30)->nullable()->after('notes');
            $table->text('motivation')->nullable()->after('phone');
        });
    }

    public function down(): void
    {
        Schema::table('ps_ambassadeurs', function (Blueprint $table) {
            $table->dropColumn(['phone', 'motivation']);
        });
    }
};
