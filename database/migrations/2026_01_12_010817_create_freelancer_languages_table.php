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
        Schema::create('freelancer_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('freelancer_profiles')->onDelete('cascade');
            $table->string('language_code', 10)->comment('Code langue ISO (fr, en, ar, es, etc.)');
            $table->enum('level', ['native', 'c2', 'c1', 'b2', 'b1', 'a2', 'a1'])->default('b1')->comment('Niveau de maîtrise de la langue');
            $table->timestamps();

            // Index pour les requêtes de filtrage
            $table->index(['freelancer_id', 'language_code']);
            $table->index('language_code');
            $table->index('level');
            
            // Contrainte unique : un freelance ne peut avoir qu'une seule entrée par langue
            $table->unique(['freelancer_id', 'language_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_languages');
    }
};
