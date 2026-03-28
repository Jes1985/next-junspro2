<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            try {
                $table->dropUnique('formation_modules_slug_unique');
            } catch (\Throwable $e) {
                // Index déjà absent sur certains environnements.
            }
        });

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-01-je-me-rencontre')
            ->update(['slug' => '01-je-me-rencontre']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-02-je-reconnais-mes-blessures')
            ->update(['slug' => '02-je-reconnais-mes-blessures']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-03-je-decris-mon-bonheur')
            ->update(['slug' => '03-je-decris-mon-bonheur']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-04-j-ecoute-mon-souffle')
            ->update(['slug' => '04-j-ecoute-mon-souffle']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-05-je-decouvre-ma-mission')
            ->update(['slug' => '05-je-decouvre-ma-mission']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', 'formation-06-je-visualise-ma-vie')
            ->update(['slug' => '06-je-visualise-ma-vie']);

        Schema::table('formation_modules', function (Blueprint $table) {
            $table->unique(['track', 'slug'], 'formation_modules_track_slug_unique');
        });
    }

    public function down(): void
    {
        Schema::table('formation_modules', function (Blueprint $table) {
            try {
                $table->dropUnique('formation_modules_track_slug_unique');
            } catch (\Throwable $e) {
                // Index déjà absent sur certains environnements.
            }
        });

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '01-je-me-rencontre')
            ->update(['slug' => 'formation-01-je-me-rencontre']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '02-je-reconnais-mes-blessures')
            ->update(['slug' => 'formation-02-je-reconnais-mes-blessures']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '03-je-decris-mon-bonheur')
            ->update(['slug' => 'formation-03-je-decris-mon-bonheur']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '04-j-ecoute-mon-souffle')
            ->update(['slug' => 'formation-04-j-ecoute-mon-souffle']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '05-je-decouvre-ma-mission')
            ->update(['slug' => 'formation-05-je-decouvre-ma-mission']);

        DB::table('formation_modules')
            ->where('track', 'praticien')
            ->where('slug', '06-je-visualise-ma-vie')
            ->update(['slug' => 'formation-06-je-visualise-ma-vie']);

        Schema::table('formation_modules', function (Blueprint $table) {
            $table->unique('slug');
        });
    }
};
