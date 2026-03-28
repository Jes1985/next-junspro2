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
        Schema::table('formation_modules', function (Blueprint $table) {
            // 1 = Formation 1 "Se Retrouver" (ordres 1-9), 2 = Formation 2 "S'Ouvrir" (ordres 10-22)
            // null pour les modules TRACK_PRATICIEN (inchangés)
            $table->tinyInteger('part')->nullable()->default(null)->after('track');
        });

        // Assigner part=1 aux modules du parcours ordres 1-9
        DB::table('formation_modules')
            ->where('track', 'parcours')
            ->whereBetween('order', [1, 9])
            ->update(['part' => 1]);

        // Assigner part=2 aux modules du parcours ordres 10-22
        DB::table('formation_modules')
            ->where('track', 'parcours')
            ->whereBetween('order', [10, 22])
            ->update(['part' => 2]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            $table->dropColumn('part');
        });
    }
};
