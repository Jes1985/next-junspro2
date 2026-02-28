<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier la table existante pour ajouter le support des minutes
        Schema::table('calendar_slots', function (Blueprint $table) {
            // Vérifier si la colonne existe avant de l'ajouter
            if (!Schema::hasColumn('calendar_slots', 'minute')) {
                $table->integer('minute')->default(0)->comment('0, 30');
            }
        });
    }

    public function down(): void
    {
        Schema::table('calendar_slots', function (Blueprint $table) {
            if (Schema::hasColumn('calendar_slots', 'minute')) {
                $table->dropColumn('minute');
            }
        });
    }
};
