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
        Schema::table('missions', function (Blueprint $table) {
            // Vérifier si les colonnes n'existent pas déjà avant de les ajouter
            if (!Schema::hasColumn('missions', 'univers_slug')) {
                $table->string('univers_slug')->nullable();
            }
            if (!Schema::hasColumn('missions', 'about_you')) {
                $table->text('about_you')->nullable();
            }
            if (!Schema::hasColumn('missions', 'details')) {
                $table->json('details')->nullable();
            }
            if (!Schema::hasColumn('missions', 'preferred_contact')) {
                $table->string('preferred_contact')->nullable();
            }
            if (!Schema::hasColumn('missions', 'language')) {
                $table->string('language')->nullable();
            }
            if (!Schema::hasColumn('missions', 'location_mode')) {
                $table->string('location_mode')->nullable();
            }
        });
        
        // Ajouter index sur univers_slug si la colonne existe et n'a pas déjà d'index
        if (Schema::hasColumn('missions', 'univers_slug')) {
            try {
                Schema::table('missions', function (Blueprint $table) {
                    $table->index('univers_slug');
                });
            } catch (\Exception $e) {
                // Index peut déjà exister, ignorer l'erreur
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('missions', function (Blueprint $table) {
            if (Schema::hasColumn('missions', 'univers_slug')) {
                $table->dropIndex(['univers_slug']);
                $table->dropColumn('univers_slug');
            }
            if (Schema::hasColumn('missions', 'about_you')) {
                $table->dropColumn('about_you');
            }
            if (Schema::hasColumn('missions', 'details')) {
                $table->dropColumn('details');
            }
            if (Schema::hasColumn('missions', 'preferred_contact')) {
                $table->dropColumn('preferred_contact');
            }
            if (Schema::hasColumn('missions', 'language')) {
                $table->dropColumn('language');
            }
            if (Schema::hasColumn('missions', 'location_mode')) {
                $table->dropColumn('location_mode');
            }
        });
    }
};
