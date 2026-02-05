<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convertir les données existantes de enum à JSON
        $intakes = DB::table('pause_souffle_intakes')->get();
        foreach ($intakes as $intake) {
            if ($intake->situation) {
                DB::table('pause_souffle_intakes')
                    ->where('id', $intake->id)
                    ->update(['situation' => json_encode([$intake->situation])]);
            }
        }

        Schema::table('pause_souffle_intakes', function (Blueprint $table) {
            $table->json('situation')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convertir les données existantes de JSON à enum (prendre le premier élément)
        $intakes = DB::table('pause_souffle_intakes')->get();
        foreach ($intakes as $intake) {
            if ($intake->situation) {
                $situations = json_decode($intake->situation, true);
                if (is_array($situations) && count($situations) > 0) {
                    DB::table('pause_souffle_intakes')
                        ->where('id', $intake->id)
                        ->update(['situation' => $situations[0]]);
                }
            }
        }

        Schema::table('pause_souffle_intakes', function (Blueprint $table) {
            $table->enum('situation', ['dirigeant', 'salarie', 'parent', 'freelance', 'etudiant', 'transition'])->change();
        });
    }
};
